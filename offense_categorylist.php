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
$offense_category_list = new offense_category_list();

// Run the page
$offense_category_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$offense_category_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$offense_category_list->isExport()) { ?>
<script>
var foffense_categorylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	foffense_categorylist = currentForm = new ew.Form("foffense_categorylist", "list");
	foffense_categorylist.formKeyCountName = '<?php echo $offense_category_list->FormKeyCountName ?>';
	loadjs.done("foffense_categorylist");
});
var foffense_categorylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	foffense_categorylistsrch = currentSearchForm = new ew.Form("foffense_categorylistsrch");

	// Dynamic selection lists
	// Filters

	foffense_categorylistsrch.filterList = <?php echo $offense_category_list->getFilterList() ?>;

	// Init search panel as collapsed
	foffense_categorylistsrch.initSearchPanel = true;
	loadjs.done("foffense_categorylistsrch");
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
<?php if (!$offense_category_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($offense_category_list->TotalRecords > 0 && $offense_category_list->ExportOptions->visible()) { ?>
<?php $offense_category_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($offense_category_list->ImportOptions->visible()) { ?>
<?php $offense_category_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($offense_category_list->SearchOptions->visible()) { ?>
<?php $offense_category_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($offense_category_list->FilterOptions->visible()) { ?>
<?php $offense_category_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$offense_category_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$offense_category_list->isExport() && !$offense_category->CurrentAction) { ?>
<form name="foffense_categorylistsrch" id="foffense_categorylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="foffense_categorylistsrch-search-panel" class="<?php echo $offense_category_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="offense_category">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $offense_category_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($offense_category_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($offense_category_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $offense_category_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($offense_category_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($offense_category_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($offense_category_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($offense_category_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $offense_category_list->showPageHeader(); ?>
<?php
$offense_category_list->showMessage();
?>
<?php if ($offense_category_list->TotalRecords > 0 || $offense_category->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($offense_category_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> offense_category">
<?php if (!$offense_category_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$offense_category_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $offense_category_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $offense_category_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="foffense_categorylist" id="foffense_categorylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="offense_category">
<div id="gmp_offense_category" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($offense_category_list->TotalRecords > 0 || $offense_category_list->isGridEdit()) { ?>
<table id="tbl_offense_categorylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$offense_category->RowType = ROWTYPE_HEADER;

// Render list options
$offense_category_list->renderListOptions();

// Render list options (header, left)
$offense_category_list->ListOptions->render("header", "left");
?>
<?php if ($offense_category_list->OffenseCategory->Visible) { // OffenseCategory ?>
	<?php if ($offense_category_list->SortUrl($offense_category_list->OffenseCategory) == "") { ?>
		<th data-name="OffenseCategory" class="<?php echo $offense_category_list->OffenseCategory->headerCellClass() ?>"><div id="elh_offense_category_OffenseCategory" class="offense_category_OffenseCategory"><div class="ew-table-header-caption"><?php echo $offense_category_list->OffenseCategory->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OffenseCategory" class="<?php echo $offense_category_list->OffenseCategory->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $offense_category_list->SortUrl($offense_category_list->OffenseCategory) ?>', 1);"><div id="elh_offense_category_OffenseCategory" class="offense_category_OffenseCategory">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $offense_category_list->OffenseCategory->caption() ?></span><span class="ew-table-header-sort"><?php if ($offense_category_list->OffenseCategory->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($offense_category_list->OffenseCategory->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($offense_category_list->OffenseCategoryName->Visible) { // OffenseCategoryName ?>
	<?php if ($offense_category_list->SortUrl($offense_category_list->OffenseCategoryName) == "") { ?>
		<th data-name="OffenseCategoryName" class="<?php echo $offense_category_list->OffenseCategoryName->headerCellClass() ?>"><div id="elh_offense_category_OffenseCategoryName" class="offense_category_OffenseCategoryName"><div class="ew-table-header-caption"><?php echo $offense_category_list->OffenseCategoryName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OffenseCategoryName" class="<?php echo $offense_category_list->OffenseCategoryName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $offense_category_list->SortUrl($offense_category_list->OffenseCategoryName) ?>', 1);"><div id="elh_offense_category_OffenseCategoryName" class="offense_category_OffenseCategoryName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $offense_category_list->OffenseCategoryName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($offense_category_list->OffenseCategoryName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($offense_category_list->OffenseCategoryName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$offense_category_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($offense_category_list->ExportAll && $offense_category_list->isExport()) {
	$offense_category_list->StopRecord = $offense_category_list->TotalRecords;
} else {

	// Set the last record to display
	if ($offense_category_list->TotalRecords > $offense_category_list->StartRecord + $offense_category_list->DisplayRecords - 1)
		$offense_category_list->StopRecord = $offense_category_list->StartRecord + $offense_category_list->DisplayRecords - 1;
	else
		$offense_category_list->StopRecord = $offense_category_list->TotalRecords;
}
$offense_category_list->RecordCount = $offense_category_list->StartRecord - 1;
if ($offense_category_list->Recordset && !$offense_category_list->Recordset->EOF) {
	$offense_category_list->Recordset->moveFirst();
	$selectLimit = $offense_category_list->UseSelectLimit;
	if (!$selectLimit && $offense_category_list->StartRecord > 1)
		$offense_category_list->Recordset->move($offense_category_list->StartRecord - 1);
} elseif (!$offense_category->AllowAddDeleteRow && $offense_category_list->StopRecord == 0) {
	$offense_category_list->StopRecord = $offense_category->GridAddRowCount;
}

// Initialize aggregate
$offense_category->RowType = ROWTYPE_AGGREGATEINIT;
$offense_category->resetAttributes();
$offense_category_list->renderRow();
while ($offense_category_list->RecordCount < $offense_category_list->StopRecord) {
	$offense_category_list->RecordCount++;
	if ($offense_category_list->RecordCount >= $offense_category_list->StartRecord) {
		$offense_category_list->RowCount++;

		// Set up key count
		$offense_category_list->KeyCount = $offense_category_list->RowIndex;

		// Init row class and style
		$offense_category->resetAttributes();
		$offense_category->CssClass = "";
		if ($offense_category_list->isGridAdd()) {
		} else {
			$offense_category_list->loadRowValues($offense_category_list->Recordset); // Load row values
		}
		$offense_category->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$offense_category->RowAttrs->merge(["data-rowindex" => $offense_category_list->RowCount, "id" => "r" . $offense_category_list->RowCount . "_offense_category", "data-rowtype" => $offense_category->RowType]);

		// Render row
		$offense_category_list->renderRow();

		// Render list options
		$offense_category_list->renderListOptions();
?>
	<tr <?php echo $offense_category->rowAttributes() ?>>
<?php

// Render list options (body, left)
$offense_category_list->ListOptions->render("body", "left", $offense_category_list->RowCount);
?>
	<?php if ($offense_category_list->OffenseCategory->Visible) { // OffenseCategory ?>
		<td data-name="OffenseCategory" <?php echo $offense_category_list->OffenseCategory->cellAttributes() ?>>
<span id="el<?php echo $offense_category_list->RowCount ?>_offense_category_OffenseCategory">
<span<?php echo $offense_category_list->OffenseCategory->viewAttributes() ?>><?php echo $offense_category_list->OffenseCategory->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($offense_category_list->OffenseCategoryName->Visible) { // OffenseCategoryName ?>
		<td data-name="OffenseCategoryName" <?php echo $offense_category_list->OffenseCategoryName->cellAttributes() ?>>
<span id="el<?php echo $offense_category_list->RowCount ?>_offense_category_OffenseCategoryName">
<span<?php echo $offense_category_list->OffenseCategoryName->viewAttributes() ?>><?php echo $offense_category_list->OffenseCategoryName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$offense_category_list->ListOptions->render("body", "right", $offense_category_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$offense_category_list->isGridAdd())
		$offense_category_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$offense_category->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($offense_category_list->Recordset)
	$offense_category_list->Recordset->Close();
?>
<?php if (!$offense_category_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$offense_category_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $offense_category_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $offense_category_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($offense_category_list->TotalRecords == 0 && !$offense_category->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $offense_category_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$offense_category_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$offense_category_list->isExport()) { ?>
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
$offense_category_list->terminate();
?>