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
$resolution_category_list = new resolution_category_list();

// Run the page
$resolution_category_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$resolution_category_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$resolution_category_list->isExport()) { ?>
<script>
var fresolution_categorylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fresolution_categorylist = currentForm = new ew.Form("fresolution_categorylist", "list");
	fresolution_categorylist.formKeyCountName = '<?php echo $resolution_category_list->FormKeyCountName ?>';
	loadjs.done("fresolution_categorylist");
});
var fresolution_categorylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fresolution_categorylistsrch = currentSearchForm = new ew.Form("fresolution_categorylistsrch");

	// Dynamic selection lists
	// Filters

	fresolution_categorylistsrch.filterList = <?php echo $resolution_category_list->getFilterList() ?>;

	// Init search panel as collapsed
	fresolution_categorylistsrch.initSearchPanel = true;
	loadjs.done("fresolution_categorylistsrch");
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
<?php if (!$resolution_category_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($resolution_category_list->TotalRecords > 0 && $resolution_category_list->ExportOptions->visible()) { ?>
<?php $resolution_category_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($resolution_category_list->ImportOptions->visible()) { ?>
<?php $resolution_category_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($resolution_category_list->SearchOptions->visible()) { ?>
<?php $resolution_category_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($resolution_category_list->FilterOptions->visible()) { ?>
<?php $resolution_category_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$resolution_category_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$resolution_category_list->isExport() && !$resolution_category->CurrentAction) { ?>
<form name="fresolution_categorylistsrch" id="fresolution_categorylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fresolution_categorylistsrch-search-panel" class="<?php echo $resolution_category_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="resolution_category">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $resolution_category_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($resolution_category_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($resolution_category_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $resolution_category_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($resolution_category_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($resolution_category_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($resolution_category_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($resolution_category_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $resolution_category_list->showPageHeader(); ?>
<?php
$resolution_category_list->showMessage();
?>
<?php if ($resolution_category_list->TotalRecords > 0 || $resolution_category->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($resolution_category_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> resolution_category">
<?php if (!$resolution_category_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$resolution_category_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $resolution_category_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $resolution_category_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fresolution_categorylist" id="fresolution_categorylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="resolution_category">
<div id="gmp_resolution_category" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($resolution_category_list->TotalRecords > 0 || $resolution_category_list->isGridEdit()) { ?>
<table id="tbl_resolution_categorylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$resolution_category->RowType = ROWTYPE_HEADER;

// Render list options
$resolution_category_list->renderListOptions();

// Render list options (header, left)
$resolution_category_list->ListOptions->render("header", "left");
?>
<?php if ($resolution_category_list->ResolutionCategoryCode->Visible) { // ResolutionCategoryCode ?>
	<?php if ($resolution_category_list->SortUrl($resolution_category_list->ResolutionCategoryCode) == "") { ?>
		<th data-name="ResolutionCategoryCode" class="<?php echo $resolution_category_list->ResolutionCategoryCode->headerCellClass() ?>"><div id="elh_resolution_category_ResolutionCategoryCode" class="resolution_category_ResolutionCategoryCode"><div class="ew-table-header-caption"><?php echo $resolution_category_list->ResolutionCategoryCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ResolutionCategoryCode" class="<?php echo $resolution_category_list->ResolutionCategoryCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $resolution_category_list->SortUrl($resolution_category_list->ResolutionCategoryCode) ?>', 1);"><div id="elh_resolution_category_ResolutionCategoryCode" class="resolution_category_ResolutionCategoryCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $resolution_category_list->ResolutionCategoryCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($resolution_category_list->ResolutionCategoryCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($resolution_category_list->ResolutionCategoryCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($resolution_category_list->ResolutionCategoryName->Visible) { // ResolutionCategoryName ?>
	<?php if ($resolution_category_list->SortUrl($resolution_category_list->ResolutionCategoryName) == "") { ?>
		<th data-name="ResolutionCategoryName" class="<?php echo $resolution_category_list->ResolutionCategoryName->headerCellClass() ?>"><div id="elh_resolution_category_ResolutionCategoryName" class="resolution_category_ResolutionCategoryName"><div class="ew-table-header-caption"><?php echo $resolution_category_list->ResolutionCategoryName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ResolutionCategoryName" class="<?php echo $resolution_category_list->ResolutionCategoryName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $resolution_category_list->SortUrl($resolution_category_list->ResolutionCategoryName) ?>', 1);"><div id="elh_resolution_category_ResolutionCategoryName" class="resolution_category_ResolutionCategoryName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $resolution_category_list->ResolutionCategoryName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($resolution_category_list->ResolutionCategoryName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($resolution_category_list->ResolutionCategoryName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$resolution_category_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($resolution_category_list->ExportAll && $resolution_category_list->isExport()) {
	$resolution_category_list->StopRecord = $resolution_category_list->TotalRecords;
} else {

	// Set the last record to display
	if ($resolution_category_list->TotalRecords > $resolution_category_list->StartRecord + $resolution_category_list->DisplayRecords - 1)
		$resolution_category_list->StopRecord = $resolution_category_list->StartRecord + $resolution_category_list->DisplayRecords - 1;
	else
		$resolution_category_list->StopRecord = $resolution_category_list->TotalRecords;
}
$resolution_category_list->RecordCount = $resolution_category_list->StartRecord - 1;
if ($resolution_category_list->Recordset && !$resolution_category_list->Recordset->EOF) {
	$resolution_category_list->Recordset->moveFirst();
	$selectLimit = $resolution_category_list->UseSelectLimit;
	if (!$selectLimit && $resolution_category_list->StartRecord > 1)
		$resolution_category_list->Recordset->move($resolution_category_list->StartRecord - 1);
} elseif (!$resolution_category->AllowAddDeleteRow && $resolution_category_list->StopRecord == 0) {
	$resolution_category_list->StopRecord = $resolution_category->GridAddRowCount;
}

// Initialize aggregate
$resolution_category->RowType = ROWTYPE_AGGREGATEINIT;
$resolution_category->resetAttributes();
$resolution_category_list->renderRow();
while ($resolution_category_list->RecordCount < $resolution_category_list->StopRecord) {
	$resolution_category_list->RecordCount++;
	if ($resolution_category_list->RecordCount >= $resolution_category_list->StartRecord) {
		$resolution_category_list->RowCount++;

		// Set up key count
		$resolution_category_list->KeyCount = $resolution_category_list->RowIndex;

		// Init row class and style
		$resolution_category->resetAttributes();
		$resolution_category->CssClass = "";
		if ($resolution_category_list->isGridAdd()) {
		} else {
			$resolution_category_list->loadRowValues($resolution_category_list->Recordset); // Load row values
		}
		$resolution_category->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$resolution_category->RowAttrs->merge(["data-rowindex" => $resolution_category_list->RowCount, "id" => "r" . $resolution_category_list->RowCount . "_resolution_category", "data-rowtype" => $resolution_category->RowType]);

		// Render row
		$resolution_category_list->renderRow();

		// Render list options
		$resolution_category_list->renderListOptions();
?>
	<tr <?php echo $resolution_category->rowAttributes() ?>>
<?php

// Render list options (body, left)
$resolution_category_list->ListOptions->render("body", "left", $resolution_category_list->RowCount);
?>
	<?php if ($resolution_category_list->ResolutionCategoryCode->Visible) { // ResolutionCategoryCode ?>
		<td data-name="ResolutionCategoryCode" <?php echo $resolution_category_list->ResolutionCategoryCode->cellAttributes() ?>>
<span id="el<?php echo $resolution_category_list->RowCount ?>_resolution_category_ResolutionCategoryCode">
<span<?php echo $resolution_category_list->ResolutionCategoryCode->viewAttributes() ?>><?php echo $resolution_category_list->ResolutionCategoryCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($resolution_category_list->ResolutionCategoryName->Visible) { // ResolutionCategoryName ?>
		<td data-name="ResolutionCategoryName" <?php echo $resolution_category_list->ResolutionCategoryName->cellAttributes() ?>>
<span id="el<?php echo $resolution_category_list->RowCount ?>_resolution_category_ResolutionCategoryName">
<span<?php echo $resolution_category_list->ResolutionCategoryName->viewAttributes() ?>><?php echo $resolution_category_list->ResolutionCategoryName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$resolution_category_list->ListOptions->render("body", "right", $resolution_category_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$resolution_category_list->isGridAdd())
		$resolution_category_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$resolution_category->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($resolution_category_list->Recordset)
	$resolution_category_list->Recordset->Close();
?>
<?php if (!$resolution_category_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$resolution_category_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $resolution_category_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $resolution_category_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($resolution_category_list->TotalRecords == 0 && !$resolution_category->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $resolution_category_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$resolution_category_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$resolution_category_list->isExport()) { ?>
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
$resolution_category_list->terminate();
?>