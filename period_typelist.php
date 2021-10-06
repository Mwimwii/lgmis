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
$period_type_list = new period_type_list();

// Run the page
$period_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$period_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$period_type_list->isExport()) { ?>
<script>
var fperiod_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fperiod_typelist = currentForm = new ew.Form("fperiod_typelist", "list");
	fperiod_typelist.formKeyCountName = '<?php echo $period_type_list->FormKeyCountName ?>';
	loadjs.done("fperiod_typelist");
});
var fperiod_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fperiod_typelistsrch = currentSearchForm = new ew.Form("fperiod_typelistsrch");

	// Dynamic selection lists
	// Filters

	fperiod_typelistsrch.filterList = <?php echo $period_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	fperiod_typelistsrch.initSearchPanel = true;
	loadjs.done("fperiod_typelistsrch");
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
<?php if (!$period_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($period_type_list->TotalRecords > 0 && $period_type_list->ExportOptions->visible()) { ?>
<?php $period_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($period_type_list->ImportOptions->visible()) { ?>
<?php $period_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($period_type_list->SearchOptions->visible()) { ?>
<?php $period_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($period_type_list->FilterOptions->visible()) { ?>
<?php $period_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$period_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$period_type_list->isExport() && !$period_type->CurrentAction) { ?>
<form name="fperiod_typelistsrch" id="fperiod_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fperiod_typelistsrch-search-panel" class="<?php echo $period_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="period_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $period_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($period_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($period_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $period_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($period_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($period_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($period_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($period_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $period_type_list->showPageHeader(); ?>
<?php
$period_type_list->showMessage();
?>
<?php if ($period_type_list->TotalRecords > 0 || $period_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($period_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> period_type">
<?php if (!$period_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$period_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $period_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $period_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fperiod_typelist" id="fperiod_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="period_type">
<div id="gmp_period_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($period_type_list->TotalRecords > 0 || $period_type_list->isGridEdit()) { ?>
<table id="tbl_period_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$period_type->RowType = ROWTYPE_HEADER;

// Render list options
$period_type_list->renderListOptions();

// Render list options (header, left)
$period_type_list->ListOptions->render("header", "left");
?>
<?php if ($period_type_list->Period_Type->Visible) { // Period_Type ?>
	<?php if ($period_type_list->SortUrl($period_type_list->Period_Type) == "") { ?>
		<th data-name="Period_Type" class="<?php echo $period_type_list->Period_Type->headerCellClass() ?>"><div id="elh_period_type_Period_Type" class="period_type_Period_Type"><div class="ew-table-header-caption"><?php echo $period_type_list->Period_Type->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Period_Type" class="<?php echo $period_type_list->Period_Type->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $period_type_list->SortUrl($period_type_list->Period_Type) ?>', 1);"><div id="elh_period_type_Period_Type" class="period_type_Period_Type">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $period_type_list->Period_Type->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($period_type_list->Period_Type->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($period_type_list->Period_Type->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($period_type_list->PeriodTypeName->Visible) { // PeriodTypeName ?>
	<?php if ($period_type_list->SortUrl($period_type_list->PeriodTypeName) == "") { ?>
		<th data-name="PeriodTypeName" class="<?php echo $period_type_list->PeriodTypeName->headerCellClass() ?>"><div id="elh_period_type_PeriodTypeName" class="period_type_PeriodTypeName"><div class="ew-table-header-caption"><?php echo $period_type_list->PeriodTypeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodTypeName" class="<?php echo $period_type_list->PeriodTypeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $period_type_list->SortUrl($period_type_list->PeriodTypeName) ?>', 1);"><div id="elh_period_type_PeriodTypeName" class="period_type_PeriodTypeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $period_type_list->PeriodTypeName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($period_type_list->PeriodTypeName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($period_type_list->PeriodTypeName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($period_type_list->PeriodLength->Visible) { // PeriodLength ?>
	<?php if ($period_type_list->SortUrl($period_type_list->PeriodLength) == "") { ?>
		<th data-name="PeriodLength" class="<?php echo $period_type_list->PeriodLength->headerCellClass() ?>"><div id="elh_period_type_PeriodLength" class="period_type_PeriodLength"><div class="ew-table-header-caption"><?php echo $period_type_list->PeriodLength->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodLength" class="<?php echo $period_type_list->PeriodLength->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $period_type_list->SortUrl($period_type_list->PeriodLength) ?>', 1);"><div id="elh_period_type_PeriodLength" class="period_type_PeriodLength">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $period_type_list->PeriodLength->caption() ?></span><span class="ew-table-header-sort"><?php if ($period_type_list->PeriodLength->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($period_type_list->PeriodLength->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($period_type_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<?php if ($period_type_list->SortUrl($period_type_list->UnitOfMeasure) == "") { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $period_type_list->UnitOfMeasure->headerCellClass() ?>"><div id="elh_period_type_UnitOfMeasure" class="period_type_UnitOfMeasure"><div class="ew-table-header-caption"><?php echo $period_type_list->UnitOfMeasure->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $period_type_list->UnitOfMeasure->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $period_type_list->SortUrl($period_type_list->UnitOfMeasure) ?>', 1);"><div id="elh_period_type_UnitOfMeasure" class="period_type_UnitOfMeasure">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $period_type_list->UnitOfMeasure->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($period_type_list->UnitOfMeasure->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($period_type_list->UnitOfMeasure->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$period_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($period_type_list->ExportAll && $period_type_list->isExport()) {
	$period_type_list->StopRecord = $period_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($period_type_list->TotalRecords > $period_type_list->StartRecord + $period_type_list->DisplayRecords - 1)
		$period_type_list->StopRecord = $period_type_list->StartRecord + $period_type_list->DisplayRecords - 1;
	else
		$period_type_list->StopRecord = $period_type_list->TotalRecords;
}
$period_type_list->RecordCount = $period_type_list->StartRecord - 1;
if ($period_type_list->Recordset && !$period_type_list->Recordset->EOF) {
	$period_type_list->Recordset->moveFirst();
	$selectLimit = $period_type_list->UseSelectLimit;
	if (!$selectLimit && $period_type_list->StartRecord > 1)
		$period_type_list->Recordset->move($period_type_list->StartRecord - 1);
} elseif (!$period_type->AllowAddDeleteRow && $period_type_list->StopRecord == 0) {
	$period_type_list->StopRecord = $period_type->GridAddRowCount;
}

// Initialize aggregate
$period_type->RowType = ROWTYPE_AGGREGATEINIT;
$period_type->resetAttributes();
$period_type_list->renderRow();
while ($period_type_list->RecordCount < $period_type_list->StopRecord) {
	$period_type_list->RecordCount++;
	if ($period_type_list->RecordCount >= $period_type_list->StartRecord) {
		$period_type_list->RowCount++;

		// Set up key count
		$period_type_list->KeyCount = $period_type_list->RowIndex;

		// Init row class and style
		$period_type->resetAttributes();
		$period_type->CssClass = "";
		if ($period_type_list->isGridAdd()) {
		} else {
			$period_type_list->loadRowValues($period_type_list->Recordset); // Load row values
		}
		$period_type->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$period_type->RowAttrs->merge(["data-rowindex" => $period_type_list->RowCount, "id" => "r" . $period_type_list->RowCount . "_period_type", "data-rowtype" => $period_type->RowType]);

		// Render row
		$period_type_list->renderRow();

		// Render list options
		$period_type_list->renderListOptions();
?>
	<tr <?php echo $period_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$period_type_list->ListOptions->render("body", "left", $period_type_list->RowCount);
?>
	<?php if ($period_type_list->Period_Type->Visible) { // Period_Type ?>
		<td data-name="Period_Type" <?php echo $period_type_list->Period_Type->cellAttributes() ?>>
<span id="el<?php echo $period_type_list->RowCount ?>_period_type_Period_Type">
<span<?php echo $period_type_list->Period_Type->viewAttributes() ?>><?php echo $period_type_list->Period_Type->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($period_type_list->PeriodTypeName->Visible) { // PeriodTypeName ?>
		<td data-name="PeriodTypeName" <?php echo $period_type_list->PeriodTypeName->cellAttributes() ?>>
<span id="el<?php echo $period_type_list->RowCount ?>_period_type_PeriodTypeName">
<span<?php echo $period_type_list->PeriodTypeName->viewAttributes() ?>><?php echo $period_type_list->PeriodTypeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($period_type_list->PeriodLength->Visible) { // PeriodLength ?>
		<td data-name="PeriodLength" <?php echo $period_type_list->PeriodLength->cellAttributes() ?>>
<span id="el<?php echo $period_type_list->RowCount ?>_period_type_PeriodLength">
<span<?php echo $period_type_list->PeriodLength->viewAttributes() ?>><?php echo $period_type_list->PeriodLength->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($period_type_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" <?php echo $period_type_list->UnitOfMeasure->cellAttributes() ?>>
<span id="el<?php echo $period_type_list->RowCount ?>_period_type_UnitOfMeasure">
<span<?php echo $period_type_list->UnitOfMeasure->viewAttributes() ?>><?php echo $period_type_list->UnitOfMeasure->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$period_type_list->ListOptions->render("body", "right", $period_type_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$period_type_list->isGridAdd())
		$period_type_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$period_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($period_type_list->Recordset)
	$period_type_list->Recordset->Close();
?>
<?php if (!$period_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$period_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $period_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $period_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($period_type_list->TotalRecords == 0 && !$period_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $period_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$period_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$period_type_list->isExport()) { ?>
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
$period_type_list->terminate();
?>