<?php
namespace PHPMaker2020\lgmis20;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$category_list = new category_list();

// Run the page
$category_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$category_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$category_list->isExport()) { ?>
<script>
var fcategorylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcategorylist = currentForm = new ew.Form("fcategorylist", "list");
	fcategorylist.formKeyCountName = '<?php echo $category_list->FormKeyCountName ?>';
	loadjs.done("fcategorylist");
});
var fcategorylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcategorylistsrch = currentSearchForm = new ew.Form("fcategorylistsrch");

	// Dynamic selection lists
	// Filters

	fcategorylistsrch.filterList = <?php echo $category_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcategorylistsrch.initSearchPanel = true;
	loadjs.done("fcategorylistsrch");
});
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
	display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
	<div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade active show"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script>
loadjs.ready("head", function() {
	ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "left" : "right";
	ew.PREVIEW_SINGLE_ROW = false;
	ew.PREVIEW_OVERLAY = false;
	loadjs("js/ewpreview.js", "preview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$category_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($category_list->TotalRecords > 0 && $category_list->ExportOptions->visible()) { ?>
<?php $category_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($category_list->ImportOptions->visible()) { ?>
<?php $category_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($category_list->SearchOptions->visible()) { ?>
<?php $category_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($category_list->FilterOptions->visible()) { ?>
<?php $category_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$category_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$category_list->isExport() && !$category->CurrentAction) { ?>
<form name="fcategorylistsrch" id="fcategorylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcategorylistsrch-search-panel" class="<?php echo $category_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="category">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $category_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($category_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($category_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $category_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($category_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($category_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($category_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($category_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $category_list->showPageHeader(); ?>
<?php
$category_list->showMessage();
?>
<?php if ($category_list->TotalRecords > 0 || $category->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($category_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> category">
<?php if (!$category_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$category_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $category_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $category_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcategorylist" id="fcategorylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="category">
<div id="gmp_category" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($category_list->TotalRecords > 0 || $category_list->isGridEdit()) { ?>
<table id="tbl_categorylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$category->RowType = ROWTYPE_HEADER;

// Render list options
$category_list->renderListOptions();

// Render list options (header, left)
$category_list->ListOptions->render("header", "left");
?>
<?php if ($category_list->CategoryCode->Visible) { // CategoryCode ?>
	<?php if ($category_list->SortUrl($category_list->CategoryCode) == "") { ?>
		<th data-name="CategoryCode" class="<?php echo $category_list->CategoryCode->headerCellClass() ?>"><div id="elh_category_CategoryCode" class="category_CategoryCode"><div class="ew-table-header-caption"><?php echo $category_list->CategoryCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CategoryCode" class="<?php echo $category_list->CategoryCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $category_list->SortUrl($category_list->CategoryCode) ?>', 1);"><div id="elh_category_CategoryCode" class="category_CategoryCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $category_list->CategoryCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($category_list->CategoryCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($category_list->CategoryCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($category_list->CategoryName->Visible) { // CategoryName ?>
	<?php if ($category_list->SortUrl($category_list->CategoryName) == "") { ?>
		<th data-name="CategoryName" class="<?php echo $category_list->CategoryName->headerCellClass() ?>"><div id="elh_category_CategoryName" class="category_CategoryName"><div class="ew-table-header-caption"><?php echo $category_list->CategoryName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CategoryName" class="<?php echo $category_list->CategoryName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $category_list->SortUrl($category_list->CategoryName) ?>', 1);"><div id="elh_category_CategoryName" class="category_CategoryName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $category_list->CategoryName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($category_list->CategoryName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($category_list->CategoryName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($category_list->CategoryDesc->Visible) { // CategoryDesc ?>
	<?php if ($category_list->SortUrl($category_list->CategoryDesc) == "") { ?>
		<th data-name="CategoryDesc" class="<?php echo $category_list->CategoryDesc->headerCellClass() ?>"><div id="elh_category_CategoryDesc" class="category_CategoryDesc"><div class="ew-table-header-caption"><?php echo $category_list->CategoryDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CategoryDesc" class="<?php echo $category_list->CategoryDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $category_list->SortUrl($category_list->CategoryDesc) ?>', 1);"><div id="elh_category_CategoryDesc" class="category_CategoryDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $category_list->CategoryDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($category_list->CategoryDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($category_list->CategoryDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$category_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($category_list->ExportAll && $category_list->isExport()) {
	$category_list->StopRecord = $category_list->TotalRecords;
} else {

	// Set the last record to display
	if ($category_list->TotalRecords > $category_list->StartRecord + $category_list->DisplayRecords - 1)
		$category_list->StopRecord = $category_list->StartRecord + $category_list->DisplayRecords - 1;
	else
		$category_list->StopRecord = $category_list->TotalRecords;
}
$category_list->RecordCount = $category_list->StartRecord - 1;
if ($category_list->Recordset && !$category_list->Recordset->EOF) {
	$category_list->Recordset->moveFirst();
	$selectLimit = $category_list->UseSelectLimit;
	if (!$selectLimit && $category_list->StartRecord > 1)
		$category_list->Recordset->move($category_list->StartRecord - 1);
} elseif (!$category->AllowAddDeleteRow && $category_list->StopRecord == 0) {
	$category_list->StopRecord = $category->GridAddRowCount;
}

// Initialize aggregate
$category->RowType = ROWTYPE_AGGREGATEINIT;
$category->resetAttributes();
$category_list->renderRow();
while ($category_list->RecordCount < $category_list->StopRecord) {
	$category_list->RecordCount++;
	if ($category_list->RecordCount >= $category_list->StartRecord) {
		$category_list->RowCount++;

		// Set up key count
		$category_list->KeyCount = $category_list->RowIndex;

		// Init row class and style
		$category->resetAttributes();
		$category->CssClass = "";
		if ($category_list->isGridAdd()) {
		} else {
			$category_list->loadRowValues($category_list->Recordset); // Load row values
		}
		$category->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$category->RowAttrs->merge(["data-rowindex" => $category_list->RowCount, "id" => "r" . $category_list->RowCount . "_category", "data-rowtype" => $category->RowType]);

		// Render row
		$category_list->renderRow();

		// Render list options
		$category_list->renderListOptions();
?>
	<tr <?php echo $category->rowAttributes() ?>>
<?php

// Render list options (body, left)
$category_list->ListOptions->render("body", "left", $category_list->RowCount);
?>
	<?php if ($category_list->CategoryCode->Visible) { // CategoryCode ?>
		<td data-name="CategoryCode" <?php echo $category_list->CategoryCode->cellAttributes() ?>>
<span id="el<?php echo $category_list->RowCount ?>_category_CategoryCode">
<span<?php echo $category_list->CategoryCode->viewAttributes() ?>><?php echo $category_list->CategoryCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($category_list->CategoryName->Visible) { // CategoryName ?>
		<td data-name="CategoryName" <?php echo $category_list->CategoryName->cellAttributes() ?>>
<span id="el<?php echo $category_list->RowCount ?>_category_CategoryName">
<span<?php echo $category_list->CategoryName->viewAttributes() ?>><?php echo $category_list->CategoryName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($category_list->CategoryDesc->Visible) { // CategoryDesc ?>
		<td data-name="CategoryDesc" <?php echo $category_list->CategoryDesc->cellAttributes() ?>>
<span id="el<?php echo $category_list->RowCount ?>_category_CategoryDesc">
<span<?php echo $category_list->CategoryDesc->viewAttributes() ?>><?php echo $category_list->CategoryDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$category_list->ListOptions->render("body", "right", $category_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$category_list->isGridAdd())
		$category_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$category->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($category_list->Recordset)
	$category_list->Recordset->Close();
?>
<?php if (!$category_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$category_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $category_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $category_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($category_list->TotalRecords == 0 && !$category->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $category_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$category_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$category_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$category_list->terminate();
?>