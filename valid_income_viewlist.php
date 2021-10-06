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
$valid_income_view_list = new valid_income_view_list();

// Run the page
$valid_income_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$valid_income_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$valid_income_view_list->isExport()) { ?>
<script>
var fvalid_income_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fvalid_income_viewlist = currentForm = new ew.Form("fvalid_income_viewlist", "list");
	fvalid_income_viewlist.formKeyCountName = '<?php echo $valid_income_view_list->FormKeyCountName ?>';
	loadjs.done("fvalid_income_viewlist");
});
var fvalid_income_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fvalid_income_viewlistsrch = currentSearchForm = new ew.Form("fvalid_income_viewlistsrch");

	// Dynamic selection lists
	// Filters

	fvalid_income_viewlistsrch.filterList = <?php echo $valid_income_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	fvalid_income_viewlistsrch.initSearchPanel = true;
	loadjs.done("fvalid_income_viewlistsrch");
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
<?php if (!$valid_income_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($valid_income_view_list->TotalRecords > 0 && $valid_income_view_list->ExportOptions->visible()) { ?>
<?php $valid_income_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($valid_income_view_list->ImportOptions->visible()) { ?>
<?php $valid_income_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($valid_income_view_list->SearchOptions->visible()) { ?>
<?php $valid_income_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($valid_income_view_list->FilterOptions->visible()) { ?>
<?php $valid_income_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$valid_income_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$valid_income_view_list->isExport() && !$valid_income_view->CurrentAction) { ?>
<form name="fvalid_income_viewlistsrch" id="fvalid_income_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fvalid_income_viewlistsrch-search-panel" class="<?php echo $valid_income_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="valid_income_view">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $valid_income_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($valid_income_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($valid_income_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $valid_income_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($valid_income_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($valid_income_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($valid_income_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($valid_income_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $valid_income_view_list->showPageHeader(); ?>
<?php
$valid_income_view_list->showMessage();
?>
<?php if ($valid_income_view_list->TotalRecords > 0 || $valid_income_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($valid_income_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> valid_income_view">
<?php if (!$valid_income_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$valid_income_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $valid_income_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $valid_income_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvalid_income_viewlist" id="fvalid_income_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="valid_income_view">
<div id="gmp_valid_income_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($valid_income_view_list->TotalRecords > 0 || $valid_income_view_list->isGridEdit()) { ?>
<table id="tbl_valid_income_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$valid_income_view->RowType = ROWTYPE_HEADER;

// Render list options
$valid_income_view_list->renderListOptions();

// Render list options (header, left)
$valid_income_view_list->ListOptions->render("header", "left");
?>
<?php if ($valid_income_view_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($valid_income_view_list->SortUrl($valid_income_view_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $valid_income_view_list->EmployeeID->headerCellClass() ?>"><div id="elh_valid_income_view_EmployeeID" class="valid_income_view_EmployeeID"><div class="ew-table-header-caption"><?php echo $valid_income_view_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $valid_income_view_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $valid_income_view_list->SortUrl($valid_income_view_list->EmployeeID) ?>', 1);"><div id="elh_valid_income_view_EmployeeID" class="valid_income_view_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $valid_income_view_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($valid_income_view_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($valid_income_view_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($valid_income_view_list->SubstantivePosition->Visible) { // SubstantivePosition ?>
	<?php if ($valid_income_view_list->SortUrl($valid_income_view_list->SubstantivePosition) == "") { ?>
		<th data-name="SubstantivePosition" class="<?php echo $valid_income_view_list->SubstantivePosition->headerCellClass() ?>"><div id="elh_valid_income_view_SubstantivePosition" class="valid_income_view_SubstantivePosition"><div class="ew-table-header-caption"><?php echo $valid_income_view_list->SubstantivePosition->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubstantivePosition" class="<?php echo $valid_income_view_list->SubstantivePosition->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $valid_income_view_list->SortUrl($valid_income_view_list->SubstantivePosition) ?>', 1);"><div id="elh_valid_income_view_SubstantivePosition" class="valid_income_view_SubstantivePosition">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $valid_income_view_list->SubstantivePosition->caption() ?></span><span class="ew-table-header-sort"><?php if ($valid_income_view_list->SubstantivePosition->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($valid_income_view_list->SubstantivePosition->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($valid_income_view_list->PositionName->Visible) { // PositionName ?>
	<?php if ($valid_income_view_list->SortUrl($valid_income_view_list->PositionName) == "") { ?>
		<th data-name="PositionName" class="<?php echo $valid_income_view_list->PositionName->headerCellClass() ?>"><div id="elh_valid_income_view_PositionName" class="valid_income_view_PositionName"><div class="ew-table-header-caption"><?php echo $valid_income_view_list->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionName" class="<?php echo $valid_income_view_list->PositionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $valid_income_view_list->SortUrl($valid_income_view_list->PositionName) ?>', 1);"><div id="elh_valid_income_view_PositionName" class="valid_income_view_PositionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $valid_income_view_list->PositionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($valid_income_view_list->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($valid_income_view_list->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($valid_income_view_list->DateOfCurrentAppointment->Visible) { // DateOfCurrentAppointment ?>
	<?php if ($valid_income_view_list->SortUrl($valid_income_view_list->DateOfCurrentAppointment) == "") { ?>
		<th data-name="DateOfCurrentAppointment" class="<?php echo $valid_income_view_list->DateOfCurrentAppointment->headerCellClass() ?>"><div id="elh_valid_income_view_DateOfCurrentAppointment" class="valid_income_view_DateOfCurrentAppointment"><div class="ew-table-header-caption"><?php echo $valid_income_view_list->DateOfCurrentAppointment->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfCurrentAppointment" class="<?php echo $valid_income_view_list->DateOfCurrentAppointment->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $valid_income_view_list->SortUrl($valid_income_view_list->DateOfCurrentAppointment) ?>', 1);"><div id="elh_valid_income_view_DateOfCurrentAppointment" class="valid_income_view_DateOfCurrentAppointment">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $valid_income_view_list->DateOfCurrentAppointment->caption() ?></span><span class="ew-table-header-sort"><?php if ($valid_income_view_list->DateOfCurrentAppointment->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($valid_income_view_list->DateOfCurrentAppointment->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($valid_income_view_list->DateOfExit->Visible) { // DateOfExit ?>
	<?php if ($valid_income_view_list->SortUrl($valid_income_view_list->DateOfExit) == "") { ?>
		<th data-name="DateOfExit" class="<?php echo $valid_income_view_list->DateOfExit->headerCellClass() ?>"><div id="elh_valid_income_view_DateOfExit" class="valid_income_view_DateOfExit"><div class="ew-table-header-caption"><?php echo $valid_income_view_list->DateOfExit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfExit" class="<?php echo $valid_income_view_list->DateOfExit->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $valid_income_view_list->SortUrl($valid_income_view_list->DateOfExit) ?>', 1);"><div id="elh_valid_income_view_DateOfExit" class="valid_income_view_DateOfExit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $valid_income_view_list->DateOfExit->caption() ?></span><span class="ew-table-header-sort"><?php if ($valid_income_view_list->DateOfExit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($valid_income_view_list->DateOfExit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($valid_income_view_list->IncomeCode->Visible) { // IncomeCode ?>
	<?php if ($valid_income_view_list->SortUrl($valid_income_view_list->IncomeCode) == "") { ?>
		<th data-name="IncomeCode" class="<?php echo $valid_income_view_list->IncomeCode->headerCellClass() ?>"><div id="elh_valid_income_view_IncomeCode" class="valid_income_view_IncomeCode"><div class="ew-table-header-caption"><?php echo $valid_income_view_list->IncomeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IncomeCode" class="<?php echo $valid_income_view_list->IncomeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $valid_income_view_list->SortUrl($valid_income_view_list->IncomeCode) ?>', 1);"><div id="elh_valid_income_view_IncomeCode" class="valid_income_view_IncomeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $valid_income_view_list->IncomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($valid_income_view_list->IncomeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($valid_income_view_list->IncomeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($valid_income_view_list->IncomeName->Visible) { // IncomeName ?>
	<?php if ($valid_income_view_list->SortUrl($valid_income_view_list->IncomeName) == "") { ?>
		<th data-name="IncomeName" class="<?php echo $valid_income_view_list->IncomeName->headerCellClass() ?>"><div id="elh_valid_income_view_IncomeName" class="valid_income_view_IncomeName"><div class="ew-table-header-caption"><?php echo $valid_income_view_list->IncomeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IncomeName" class="<?php echo $valid_income_view_list->IncomeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $valid_income_view_list->SortUrl($valid_income_view_list->IncomeName) ?>', 1);"><div id="elh_valid_income_view_IncomeName" class="valid_income_view_IncomeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $valid_income_view_list->IncomeName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($valid_income_view_list->IncomeName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($valid_income_view_list->IncomeName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($valid_income_view_list->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
	<?php if ($valid_income_view_list->SortUrl($valid_income_view_list->BasicMonthlySalary) == "") { ?>
		<th data-name="BasicMonthlySalary" class="<?php echo $valid_income_view_list->BasicMonthlySalary->headerCellClass() ?>"><div id="elh_valid_income_view_BasicMonthlySalary" class="valid_income_view_BasicMonthlySalary"><div class="ew-table-header-caption"><?php echo $valid_income_view_list->BasicMonthlySalary->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BasicMonthlySalary" class="<?php echo $valid_income_view_list->BasicMonthlySalary->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $valid_income_view_list->SortUrl($valid_income_view_list->BasicMonthlySalary) ?>', 1);"><div id="elh_valid_income_view_BasicMonthlySalary" class="valid_income_view_BasicMonthlySalary">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $valid_income_view_list->BasicMonthlySalary->caption() ?></span><span class="ew-table-header-sort"><?php if ($valid_income_view_list->BasicMonthlySalary->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($valid_income_view_list->BasicMonthlySalary->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($valid_income_view_list->incomeAmount->Visible) { // incomeAmount ?>
	<?php if ($valid_income_view_list->SortUrl($valid_income_view_list->incomeAmount) == "") { ?>
		<th data-name="incomeAmount" class="<?php echo $valid_income_view_list->incomeAmount->headerCellClass() ?>"><div id="elh_valid_income_view_incomeAmount" class="valid_income_view_incomeAmount"><div class="ew-table-header-caption"><?php echo $valid_income_view_list->incomeAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="incomeAmount" class="<?php echo $valid_income_view_list->incomeAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $valid_income_view_list->SortUrl($valid_income_view_list->incomeAmount) ?>', 1);"><div id="elh_valid_income_view_incomeAmount" class="valid_income_view_incomeAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $valid_income_view_list->incomeAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($valid_income_view_list->incomeAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($valid_income_view_list->incomeAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($valid_income_view_list->Division->Visible) { // Division ?>
	<?php if ($valid_income_view_list->SortUrl($valid_income_view_list->Division) == "") { ?>
		<th data-name="Division" class="<?php echo $valid_income_view_list->Division->headerCellClass() ?>"><div id="elh_valid_income_view_Division" class="valid_income_view_Division"><div class="ew-table-header-caption"><?php echo $valid_income_view_list->Division->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Division" class="<?php echo $valid_income_view_list->Division->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $valid_income_view_list->SortUrl($valid_income_view_list->Division) ?>', 1);"><div id="elh_valid_income_view_Division" class="valid_income_view_Division">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $valid_income_view_list->Division->caption() ?></span><span class="ew-table-header-sort"><?php if ($valid_income_view_list->Division->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($valid_income_view_list->Division->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$valid_income_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($valid_income_view_list->ExportAll && $valid_income_view_list->isExport()) {
	$valid_income_view_list->StopRecord = $valid_income_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($valid_income_view_list->TotalRecords > $valid_income_view_list->StartRecord + $valid_income_view_list->DisplayRecords - 1)
		$valid_income_view_list->StopRecord = $valid_income_view_list->StartRecord + $valid_income_view_list->DisplayRecords - 1;
	else
		$valid_income_view_list->StopRecord = $valid_income_view_list->TotalRecords;
}
$valid_income_view_list->RecordCount = $valid_income_view_list->StartRecord - 1;
if ($valid_income_view_list->Recordset && !$valid_income_view_list->Recordset->EOF) {
	$valid_income_view_list->Recordset->moveFirst();
	$selectLimit = $valid_income_view_list->UseSelectLimit;
	if (!$selectLimit && $valid_income_view_list->StartRecord > 1)
		$valid_income_view_list->Recordset->move($valid_income_view_list->StartRecord - 1);
} elseif (!$valid_income_view->AllowAddDeleteRow && $valid_income_view_list->StopRecord == 0) {
	$valid_income_view_list->StopRecord = $valid_income_view->GridAddRowCount;
}

// Initialize aggregate
$valid_income_view->RowType = ROWTYPE_AGGREGATEINIT;
$valid_income_view->resetAttributes();
$valid_income_view_list->renderRow();
while ($valid_income_view_list->RecordCount < $valid_income_view_list->StopRecord) {
	$valid_income_view_list->RecordCount++;
	if ($valid_income_view_list->RecordCount >= $valid_income_view_list->StartRecord) {
		$valid_income_view_list->RowCount++;

		// Set up key count
		$valid_income_view_list->KeyCount = $valid_income_view_list->RowIndex;

		// Init row class and style
		$valid_income_view->resetAttributes();
		$valid_income_view->CssClass = "";
		if ($valid_income_view_list->isGridAdd()) {
		} else {
			$valid_income_view_list->loadRowValues($valid_income_view_list->Recordset); // Load row values
		}
		$valid_income_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$valid_income_view->RowAttrs->merge(["data-rowindex" => $valid_income_view_list->RowCount, "id" => "r" . $valid_income_view_list->RowCount . "_valid_income_view", "data-rowtype" => $valid_income_view->RowType]);

		// Render row
		$valid_income_view_list->renderRow();

		// Render list options
		$valid_income_view_list->renderListOptions();
?>
	<tr <?php echo $valid_income_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$valid_income_view_list->ListOptions->render("body", "left", $valid_income_view_list->RowCount);
?>
	<?php if ($valid_income_view_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $valid_income_view_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $valid_income_view_list->RowCount ?>_valid_income_view_EmployeeID">
<span<?php echo $valid_income_view_list->EmployeeID->viewAttributes() ?>><?php echo $valid_income_view_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($valid_income_view_list->SubstantivePosition->Visible) { // SubstantivePosition ?>
		<td data-name="SubstantivePosition" <?php echo $valid_income_view_list->SubstantivePosition->cellAttributes() ?>>
<span id="el<?php echo $valid_income_view_list->RowCount ?>_valid_income_view_SubstantivePosition">
<span<?php echo $valid_income_view_list->SubstantivePosition->viewAttributes() ?>><?php echo $valid_income_view_list->SubstantivePosition->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($valid_income_view_list->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName" <?php echo $valid_income_view_list->PositionName->cellAttributes() ?>>
<span id="el<?php echo $valid_income_view_list->RowCount ?>_valid_income_view_PositionName">
<span<?php echo $valid_income_view_list->PositionName->viewAttributes() ?>><?php echo $valid_income_view_list->PositionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($valid_income_view_list->DateOfCurrentAppointment->Visible) { // DateOfCurrentAppointment ?>
		<td data-name="DateOfCurrentAppointment" <?php echo $valid_income_view_list->DateOfCurrentAppointment->cellAttributes() ?>>
<span id="el<?php echo $valid_income_view_list->RowCount ?>_valid_income_view_DateOfCurrentAppointment">
<span<?php echo $valid_income_view_list->DateOfCurrentAppointment->viewAttributes() ?>><?php echo $valid_income_view_list->DateOfCurrentAppointment->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($valid_income_view_list->DateOfExit->Visible) { // DateOfExit ?>
		<td data-name="DateOfExit" <?php echo $valid_income_view_list->DateOfExit->cellAttributes() ?>>
<span id="el<?php echo $valid_income_view_list->RowCount ?>_valid_income_view_DateOfExit">
<span<?php echo $valid_income_view_list->DateOfExit->viewAttributes() ?>><?php echo $valid_income_view_list->DateOfExit->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($valid_income_view_list->IncomeCode->Visible) { // IncomeCode ?>
		<td data-name="IncomeCode" <?php echo $valid_income_view_list->IncomeCode->cellAttributes() ?>>
<span id="el<?php echo $valid_income_view_list->RowCount ?>_valid_income_view_IncomeCode">
<span<?php echo $valid_income_view_list->IncomeCode->viewAttributes() ?>><?php echo $valid_income_view_list->IncomeCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($valid_income_view_list->IncomeName->Visible) { // IncomeName ?>
		<td data-name="IncomeName" <?php echo $valid_income_view_list->IncomeName->cellAttributes() ?>>
<span id="el<?php echo $valid_income_view_list->RowCount ?>_valid_income_view_IncomeName">
<span<?php echo $valid_income_view_list->IncomeName->viewAttributes() ?>><?php echo $valid_income_view_list->IncomeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($valid_income_view_list->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
		<td data-name="BasicMonthlySalary" <?php echo $valid_income_view_list->BasicMonthlySalary->cellAttributes() ?>>
<span id="el<?php echo $valid_income_view_list->RowCount ?>_valid_income_view_BasicMonthlySalary">
<span<?php echo $valid_income_view_list->BasicMonthlySalary->viewAttributes() ?>><?php echo $valid_income_view_list->BasicMonthlySalary->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($valid_income_view_list->incomeAmount->Visible) { // incomeAmount ?>
		<td data-name="incomeAmount" <?php echo $valid_income_view_list->incomeAmount->cellAttributes() ?>>
<span id="el<?php echo $valid_income_view_list->RowCount ?>_valid_income_view_incomeAmount">
<span<?php echo $valid_income_view_list->incomeAmount->viewAttributes() ?>><?php echo $valid_income_view_list->incomeAmount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($valid_income_view_list->Division->Visible) { // Division ?>
		<td data-name="Division" <?php echo $valid_income_view_list->Division->cellAttributes() ?>>
<span id="el<?php echo $valid_income_view_list->RowCount ?>_valid_income_view_Division">
<span<?php echo $valid_income_view_list->Division->viewAttributes() ?>><?php echo $valid_income_view_list->Division->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$valid_income_view_list->ListOptions->render("body", "right", $valid_income_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$valid_income_view_list->isGridAdd())
		$valid_income_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$valid_income_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($valid_income_view_list->Recordset)
	$valid_income_view_list->Recordset->Close();
?>
<?php if (!$valid_income_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$valid_income_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $valid_income_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $valid_income_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($valid_income_view_list->TotalRecords == 0 && !$valid_income_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $valid_income_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$valid_income_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$valid_income_view_list->isExport()) { ?>
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
$valid_income_view_list->terminate();
?>