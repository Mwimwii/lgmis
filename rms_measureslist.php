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
$rms_measures_list = new rms_measures_list();

// Run the page
$rms_measures_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rms_measures_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$rms_measures_list->isExport()) { ?>
<script>
var frms_measureslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	frms_measureslist = currentForm = new ew.Form("frms_measureslist", "list");
	frms_measureslist.formKeyCountName = '<?php echo $rms_measures_list->FormKeyCountName ?>';
	loadjs.done("frms_measureslist");
});
var frms_measureslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	frms_measureslistsrch = currentSearchForm = new ew.Form("frms_measureslistsrch");

	// Dynamic selection lists
	// Filters

	frms_measureslistsrch.filterList = <?php echo $rms_measures_list->getFilterList() ?>;

	// Init search panel as collapsed
	frms_measureslistsrch.initSearchPanel = true;
	loadjs.done("frms_measureslistsrch");
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
<?php if (!$rms_measures_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($rms_measures_list->TotalRecords > 0 && $rms_measures_list->ExportOptions->visible()) { ?>
<?php $rms_measures_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($rms_measures_list->ImportOptions->visible()) { ?>
<?php $rms_measures_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($rms_measures_list->SearchOptions->visible()) { ?>
<?php $rms_measures_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($rms_measures_list->FilterOptions->visible()) { ?>
<?php $rms_measures_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$rms_measures_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$rms_measures_list->isExport() && !$rms_measures->CurrentAction) { ?>
<form name="frms_measureslistsrch" id="frms_measureslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="frms_measureslistsrch-search-panel" class="<?php echo $rms_measures_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="rms_measures">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $rms_measures_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($rms_measures_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($rms_measures_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $rms_measures_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($rms_measures_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($rms_measures_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($rms_measures_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($rms_measures_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $rms_measures_list->showPageHeader(); ?>
<?php
$rms_measures_list->showMessage();
?>
<?php if ($rms_measures_list->TotalRecords > 0 || $rms_measures->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($rms_measures_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> rms_measures">
<?php if (!$rms_measures_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$rms_measures_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $rms_measures_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $rms_measures_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="frms_measureslist" id="frms_measureslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rms_measures">
<div id="gmp_rms_measures" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($rms_measures_list->TotalRecords > 0 || $rms_measures_list->isGridEdit()) { ?>
<table id="tbl_rms_measureslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$rms_measures->RowType = ROWTYPE_HEADER;

// Render list options
$rms_measures_list->renderListOptions();

// Render list options (header, left)
$rms_measures_list->ListOptions->render("header", "left");
?>
<?php if ($rms_measures_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<?php if ($rms_measures_list->SortUrl($rms_measures_list->UnitOfMeasure) == "") { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $rms_measures_list->UnitOfMeasure->headerCellClass() ?>"><div id="elh_rms_measures_UnitOfMeasure" class="rms_measures_UnitOfMeasure"><div class="ew-table-header-caption"><?php echo $rms_measures_list->UnitOfMeasure->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $rms_measures_list->UnitOfMeasure->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rms_measures_list->SortUrl($rms_measures_list->UnitOfMeasure) ?>', 1);"><div id="elh_rms_measures_UnitOfMeasure" class="rms_measures_UnitOfMeasure">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rms_measures_list->UnitOfMeasure->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($rms_measures_list->UnitOfMeasure->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rms_measures_list->UnitOfMeasure->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$rms_measures_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($rms_measures_list->ExportAll && $rms_measures_list->isExport()) {
	$rms_measures_list->StopRecord = $rms_measures_list->TotalRecords;
} else {

	// Set the last record to display
	if ($rms_measures_list->TotalRecords > $rms_measures_list->StartRecord + $rms_measures_list->DisplayRecords - 1)
		$rms_measures_list->StopRecord = $rms_measures_list->StartRecord + $rms_measures_list->DisplayRecords - 1;
	else
		$rms_measures_list->StopRecord = $rms_measures_list->TotalRecords;
}
$rms_measures_list->RecordCount = $rms_measures_list->StartRecord - 1;
if ($rms_measures_list->Recordset && !$rms_measures_list->Recordset->EOF) {
	$rms_measures_list->Recordset->moveFirst();
	$selectLimit = $rms_measures_list->UseSelectLimit;
	if (!$selectLimit && $rms_measures_list->StartRecord > 1)
		$rms_measures_list->Recordset->move($rms_measures_list->StartRecord - 1);
} elseif (!$rms_measures->AllowAddDeleteRow && $rms_measures_list->StopRecord == 0) {
	$rms_measures_list->StopRecord = $rms_measures->GridAddRowCount;
}

// Initialize aggregate
$rms_measures->RowType = ROWTYPE_AGGREGATEINIT;
$rms_measures->resetAttributes();
$rms_measures_list->renderRow();
while ($rms_measures_list->RecordCount < $rms_measures_list->StopRecord) {
	$rms_measures_list->RecordCount++;
	if ($rms_measures_list->RecordCount >= $rms_measures_list->StartRecord) {
		$rms_measures_list->RowCount++;

		// Set up key count
		$rms_measures_list->KeyCount = $rms_measures_list->RowIndex;

		// Init row class and style
		$rms_measures->resetAttributes();
		$rms_measures->CssClass = "";
		if ($rms_measures_list->isGridAdd()) {
		} else {
			$rms_measures_list->loadRowValues($rms_measures_list->Recordset); // Load row values
		}
		$rms_measures->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$rms_measures->RowAttrs->merge(["data-rowindex" => $rms_measures_list->RowCount, "id" => "r" . $rms_measures_list->RowCount . "_rms_measures", "data-rowtype" => $rms_measures->RowType]);

		// Render row
		$rms_measures_list->renderRow();

		// Render list options
		$rms_measures_list->renderListOptions();
?>
	<tr <?php echo $rms_measures->rowAttributes() ?>>
<?php

// Render list options (body, left)
$rms_measures_list->ListOptions->render("body", "left", $rms_measures_list->RowCount);
?>
	<?php if ($rms_measures_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" <?php echo $rms_measures_list->UnitOfMeasure->cellAttributes() ?>>
<span id="el<?php echo $rms_measures_list->RowCount ?>_rms_measures_UnitOfMeasure">
<span<?php echo $rms_measures_list->UnitOfMeasure->viewAttributes() ?>><?php echo $rms_measures_list->UnitOfMeasure->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rms_measures_list->ListOptions->render("body", "right", $rms_measures_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$rms_measures_list->isGridAdd())
		$rms_measures_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$rms_measures->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($rms_measures_list->Recordset)
	$rms_measures_list->Recordset->Close();
?>
<?php if (!$rms_measures_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$rms_measures_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $rms_measures_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $rms_measures_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($rms_measures_list->TotalRecords == 0 && !$rms_measures->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $rms_measures_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$rms_measures_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$rms_measures_list->isExport()) { ?>
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
$rms_measures_list->terminate();
?>