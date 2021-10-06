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
$indicator_measure_list = new indicator_measure_list();

// Run the page
$indicator_measure_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$indicator_measure_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$indicator_measure_list->isExport()) { ?>
<script>
var findicator_measurelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	findicator_measurelist = currentForm = new ew.Form("findicator_measurelist", "list");
	findicator_measurelist.formKeyCountName = '<?php echo $indicator_measure_list->FormKeyCountName ?>';
	loadjs.done("findicator_measurelist");
});
var findicator_measurelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	findicator_measurelistsrch = currentSearchForm = new ew.Form("findicator_measurelistsrch");

	// Dynamic selection lists
	// Filters

	findicator_measurelistsrch.filterList = <?php echo $indicator_measure_list->getFilterList() ?>;

	// Init search panel as collapsed
	findicator_measurelistsrch.initSearchPanel = true;
	loadjs.done("findicator_measurelistsrch");
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
<?php if (!$indicator_measure_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($indicator_measure_list->TotalRecords > 0 && $indicator_measure_list->ExportOptions->visible()) { ?>
<?php $indicator_measure_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($indicator_measure_list->ImportOptions->visible()) { ?>
<?php $indicator_measure_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($indicator_measure_list->SearchOptions->visible()) { ?>
<?php $indicator_measure_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($indicator_measure_list->FilterOptions->visible()) { ?>
<?php $indicator_measure_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$indicator_measure_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$indicator_measure_list->isExport() && !$indicator_measure->CurrentAction) { ?>
<form name="findicator_measurelistsrch" id="findicator_measurelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="findicator_measurelistsrch-search-panel" class="<?php echo $indicator_measure_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="indicator_measure">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $indicator_measure_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($indicator_measure_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($indicator_measure_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $indicator_measure_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($indicator_measure_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($indicator_measure_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($indicator_measure_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($indicator_measure_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $indicator_measure_list->showPageHeader(); ?>
<?php
$indicator_measure_list->showMessage();
?>
<?php if ($indicator_measure_list->TotalRecords > 0 || $indicator_measure->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($indicator_measure_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> indicator_measure">
<?php if (!$indicator_measure_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$indicator_measure_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $indicator_measure_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $indicator_measure_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="findicator_measurelist" id="findicator_measurelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="indicator_measure">
<div id="gmp_indicator_measure" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($indicator_measure_list->TotalRecords > 0 || $indicator_measure_list->isGridEdit()) { ?>
<table id="tbl_indicator_measurelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$indicator_measure->RowType = ROWTYPE_HEADER;

// Render list options
$indicator_measure_list->renderListOptions();

// Render list options (header, left)
$indicator_measure_list->ListOptions->render("header", "left");
?>
<?php if ($indicator_measure_list->Indicator_measure->Visible) { // Indicator_measure ?>
	<?php if ($indicator_measure_list->SortUrl($indicator_measure_list->Indicator_measure) == "") { ?>
		<th data-name="Indicator_measure" class="<?php echo $indicator_measure_list->Indicator_measure->headerCellClass() ?>"><div id="elh_indicator_measure_Indicator_measure" class="indicator_measure_Indicator_measure"><div class="ew-table-header-caption"><?php echo $indicator_measure_list->Indicator_measure->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Indicator_measure" class="<?php echo $indicator_measure_list->Indicator_measure->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $indicator_measure_list->SortUrl($indicator_measure_list->Indicator_measure) ?>', 1);"><div id="elh_indicator_measure_Indicator_measure" class="indicator_measure_Indicator_measure">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $indicator_measure_list->Indicator_measure->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($indicator_measure_list->Indicator_measure->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($indicator_measure_list->Indicator_measure->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($indicator_measure_list->measure_desc->Visible) { // measure_desc ?>
	<?php if ($indicator_measure_list->SortUrl($indicator_measure_list->measure_desc) == "") { ?>
		<th data-name="measure_desc" class="<?php echo $indicator_measure_list->measure_desc->headerCellClass() ?>"><div id="elh_indicator_measure_measure_desc" class="indicator_measure_measure_desc"><div class="ew-table-header-caption"><?php echo $indicator_measure_list->measure_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="measure_desc" class="<?php echo $indicator_measure_list->measure_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $indicator_measure_list->SortUrl($indicator_measure_list->measure_desc) ?>', 1);"><div id="elh_indicator_measure_measure_desc" class="indicator_measure_measure_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $indicator_measure_list->measure_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($indicator_measure_list->measure_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($indicator_measure_list->measure_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$indicator_measure_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($indicator_measure_list->ExportAll && $indicator_measure_list->isExport()) {
	$indicator_measure_list->StopRecord = $indicator_measure_list->TotalRecords;
} else {

	// Set the last record to display
	if ($indicator_measure_list->TotalRecords > $indicator_measure_list->StartRecord + $indicator_measure_list->DisplayRecords - 1)
		$indicator_measure_list->StopRecord = $indicator_measure_list->StartRecord + $indicator_measure_list->DisplayRecords - 1;
	else
		$indicator_measure_list->StopRecord = $indicator_measure_list->TotalRecords;
}
$indicator_measure_list->RecordCount = $indicator_measure_list->StartRecord - 1;
if ($indicator_measure_list->Recordset && !$indicator_measure_list->Recordset->EOF) {
	$indicator_measure_list->Recordset->moveFirst();
	$selectLimit = $indicator_measure_list->UseSelectLimit;
	if (!$selectLimit && $indicator_measure_list->StartRecord > 1)
		$indicator_measure_list->Recordset->move($indicator_measure_list->StartRecord - 1);
} elseif (!$indicator_measure->AllowAddDeleteRow && $indicator_measure_list->StopRecord == 0) {
	$indicator_measure_list->StopRecord = $indicator_measure->GridAddRowCount;
}

// Initialize aggregate
$indicator_measure->RowType = ROWTYPE_AGGREGATEINIT;
$indicator_measure->resetAttributes();
$indicator_measure_list->renderRow();
while ($indicator_measure_list->RecordCount < $indicator_measure_list->StopRecord) {
	$indicator_measure_list->RecordCount++;
	if ($indicator_measure_list->RecordCount >= $indicator_measure_list->StartRecord) {
		$indicator_measure_list->RowCount++;

		// Set up key count
		$indicator_measure_list->KeyCount = $indicator_measure_list->RowIndex;

		// Init row class and style
		$indicator_measure->resetAttributes();
		$indicator_measure->CssClass = "";
		if ($indicator_measure_list->isGridAdd()) {
		} else {
			$indicator_measure_list->loadRowValues($indicator_measure_list->Recordset); // Load row values
		}
		$indicator_measure->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$indicator_measure->RowAttrs->merge(["data-rowindex" => $indicator_measure_list->RowCount, "id" => "r" . $indicator_measure_list->RowCount . "_indicator_measure", "data-rowtype" => $indicator_measure->RowType]);

		// Render row
		$indicator_measure_list->renderRow();

		// Render list options
		$indicator_measure_list->renderListOptions();
?>
	<tr <?php echo $indicator_measure->rowAttributes() ?>>
<?php

// Render list options (body, left)
$indicator_measure_list->ListOptions->render("body", "left", $indicator_measure_list->RowCount);
?>
	<?php if ($indicator_measure_list->Indicator_measure->Visible) { // Indicator_measure ?>
		<td data-name="Indicator_measure" <?php echo $indicator_measure_list->Indicator_measure->cellAttributes() ?>>
<span id="el<?php echo $indicator_measure_list->RowCount ?>_indicator_measure_Indicator_measure">
<span<?php echo $indicator_measure_list->Indicator_measure->viewAttributes() ?>><?php echo $indicator_measure_list->Indicator_measure->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($indicator_measure_list->measure_desc->Visible) { // measure_desc ?>
		<td data-name="measure_desc" <?php echo $indicator_measure_list->measure_desc->cellAttributes() ?>>
<span id="el<?php echo $indicator_measure_list->RowCount ?>_indicator_measure_measure_desc">
<span<?php echo $indicator_measure_list->measure_desc->viewAttributes() ?>><?php echo $indicator_measure_list->measure_desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$indicator_measure_list->ListOptions->render("body", "right", $indicator_measure_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$indicator_measure_list->isGridAdd())
		$indicator_measure_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$indicator_measure->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($indicator_measure_list->Recordset)
	$indicator_measure_list->Recordset->Close();
?>
<?php if (!$indicator_measure_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$indicator_measure_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $indicator_measure_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $indicator_measure_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($indicator_measure_list->TotalRecords == 0 && !$indicator_measure->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $indicator_measure_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$indicator_measure_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$indicator_measure_list->isExport()) { ?>
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
$indicator_measure_list->terminate();
?>