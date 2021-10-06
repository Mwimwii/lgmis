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
$unit_of_measure_list = new unit_of_measure_list();

// Run the page
$unit_of_measure_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$unit_of_measure_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$unit_of_measure_list->isExport()) { ?>
<script>
var funit_of_measurelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	funit_of_measurelist = currentForm = new ew.Form("funit_of_measurelist", "list");
	funit_of_measurelist.formKeyCountName = '<?php echo $unit_of_measure_list->FormKeyCountName ?>';
	loadjs.done("funit_of_measurelist");
});
var funit_of_measurelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	funit_of_measurelistsrch = currentSearchForm = new ew.Form("funit_of_measurelistsrch");

	// Dynamic selection lists
	// Filters

	funit_of_measurelistsrch.filterList = <?php echo $unit_of_measure_list->getFilterList() ?>;

	// Init search panel as collapsed
	funit_of_measurelistsrch.initSearchPanel = true;
	loadjs.done("funit_of_measurelistsrch");
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
<?php if (!$unit_of_measure_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($unit_of_measure_list->TotalRecords > 0 && $unit_of_measure_list->ExportOptions->visible()) { ?>
<?php $unit_of_measure_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($unit_of_measure_list->ImportOptions->visible()) { ?>
<?php $unit_of_measure_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($unit_of_measure_list->SearchOptions->visible()) { ?>
<?php $unit_of_measure_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($unit_of_measure_list->FilterOptions->visible()) { ?>
<?php $unit_of_measure_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$unit_of_measure_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$unit_of_measure_list->isExport() && !$unit_of_measure->CurrentAction) { ?>
<form name="funit_of_measurelistsrch" id="funit_of_measurelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="funit_of_measurelistsrch-search-panel" class="<?php echo $unit_of_measure_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="unit_of_measure">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $unit_of_measure_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($unit_of_measure_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($unit_of_measure_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $unit_of_measure_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($unit_of_measure_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($unit_of_measure_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($unit_of_measure_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($unit_of_measure_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $unit_of_measure_list->showPageHeader(); ?>
<?php
$unit_of_measure_list->showMessage();
?>
<?php if ($unit_of_measure_list->TotalRecords > 0 || $unit_of_measure->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($unit_of_measure_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> unit_of_measure">
<?php if (!$unit_of_measure_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$unit_of_measure_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $unit_of_measure_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $unit_of_measure_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="funit_of_measurelist" id="funit_of_measurelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="unit_of_measure">
<div id="gmp_unit_of_measure" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($unit_of_measure_list->TotalRecords > 0 || $unit_of_measure_list->isGridEdit()) { ?>
<table id="tbl_unit_of_measurelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$unit_of_measure->RowType = ROWTYPE_HEADER;

// Render list options
$unit_of_measure_list->renderListOptions();

// Render list options (header, left)
$unit_of_measure_list->ListOptions->render("header", "left");
?>
<?php if ($unit_of_measure_list->Unit_of_measure->Visible) { // Unit_of_measure ?>
	<?php if ($unit_of_measure_list->SortUrl($unit_of_measure_list->Unit_of_measure) == "") { ?>
		<th data-name="Unit_of_measure" class="<?php echo $unit_of_measure_list->Unit_of_measure->headerCellClass() ?>"><div id="elh_unit_of_measure_Unit_of_measure" class="unit_of_measure_Unit_of_measure"><div class="ew-table-header-caption"><?php echo $unit_of_measure_list->Unit_of_measure->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Unit_of_measure" class="<?php echo $unit_of_measure_list->Unit_of_measure->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $unit_of_measure_list->SortUrl($unit_of_measure_list->Unit_of_measure) ?>', 1);"><div id="elh_unit_of_measure_Unit_of_measure" class="unit_of_measure_Unit_of_measure">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $unit_of_measure_list->Unit_of_measure->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($unit_of_measure_list->Unit_of_measure->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($unit_of_measure_list->Unit_of_measure->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$unit_of_measure_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($unit_of_measure_list->ExportAll && $unit_of_measure_list->isExport()) {
	$unit_of_measure_list->StopRecord = $unit_of_measure_list->TotalRecords;
} else {

	// Set the last record to display
	if ($unit_of_measure_list->TotalRecords > $unit_of_measure_list->StartRecord + $unit_of_measure_list->DisplayRecords - 1)
		$unit_of_measure_list->StopRecord = $unit_of_measure_list->StartRecord + $unit_of_measure_list->DisplayRecords - 1;
	else
		$unit_of_measure_list->StopRecord = $unit_of_measure_list->TotalRecords;
}
$unit_of_measure_list->RecordCount = $unit_of_measure_list->StartRecord - 1;
if ($unit_of_measure_list->Recordset && !$unit_of_measure_list->Recordset->EOF) {
	$unit_of_measure_list->Recordset->moveFirst();
	$selectLimit = $unit_of_measure_list->UseSelectLimit;
	if (!$selectLimit && $unit_of_measure_list->StartRecord > 1)
		$unit_of_measure_list->Recordset->move($unit_of_measure_list->StartRecord - 1);
} elseif (!$unit_of_measure->AllowAddDeleteRow && $unit_of_measure_list->StopRecord == 0) {
	$unit_of_measure_list->StopRecord = $unit_of_measure->GridAddRowCount;
}

// Initialize aggregate
$unit_of_measure->RowType = ROWTYPE_AGGREGATEINIT;
$unit_of_measure->resetAttributes();
$unit_of_measure_list->renderRow();
while ($unit_of_measure_list->RecordCount < $unit_of_measure_list->StopRecord) {
	$unit_of_measure_list->RecordCount++;
	if ($unit_of_measure_list->RecordCount >= $unit_of_measure_list->StartRecord) {
		$unit_of_measure_list->RowCount++;

		// Set up key count
		$unit_of_measure_list->KeyCount = $unit_of_measure_list->RowIndex;

		// Init row class and style
		$unit_of_measure->resetAttributes();
		$unit_of_measure->CssClass = "";
		if ($unit_of_measure_list->isGridAdd()) {
		} else {
			$unit_of_measure_list->loadRowValues($unit_of_measure_list->Recordset); // Load row values
		}
		$unit_of_measure->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$unit_of_measure->RowAttrs->merge(["data-rowindex" => $unit_of_measure_list->RowCount, "id" => "r" . $unit_of_measure_list->RowCount . "_unit_of_measure", "data-rowtype" => $unit_of_measure->RowType]);

		// Render row
		$unit_of_measure_list->renderRow();

		// Render list options
		$unit_of_measure_list->renderListOptions();
?>
	<tr <?php echo $unit_of_measure->rowAttributes() ?>>
<?php

// Render list options (body, left)
$unit_of_measure_list->ListOptions->render("body", "left", $unit_of_measure_list->RowCount);
?>
	<?php if ($unit_of_measure_list->Unit_of_measure->Visible) { // Unit_of_measure ?>
		<td data-name="Unit_of_measure" <?php echo $unit_of_measure_list->Unit_of_measure->cellAttributes() ?>>
<span id="el<?php echo $unit_of_measure_list->RowCount ?>_unit_of_measure_Unit_of_measure">
<span<?php echo $unit_of_measure_list->Unit_of_measure->viewAttributes() ?>><?php echo $unit_of_measure_list->Unit_of_measure->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$unit_of_measure_list->ListOptions->render("body", "right", $unit_of_measure_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$unit_of_measure_list->isGridAdd())
		$unit_of_measure_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$unit_of_measure->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($unit_of_measure_list->Recordset)
	$unit_of_measure_list->Recordset->Close();
?>
<?php if (!$unit_of_measure_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$unit_of_measure_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $unit_of_measure_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $unit_of_measure_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($unit_of_measure_list->TotalRecords == 0 && !$unit_of_measure->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $unit_of_measure_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$unit_of_measure_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$unit_of_measure_list->isExport()) { ?>
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
$unit_of_measure_list->terminate();
?>