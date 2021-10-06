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
$obligation_schedule_view_list = new obligation_schedule_view_list();

// Run the page
$obligation_schedule_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$obligation_schedule_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$obligation_schedule_view_list->isExport()) { ?>
<script>
var fobligation_schedule_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fobligation_schedule_viewlist = currentForm = new ew.Form("fobligation_schedule_viewlist", "list");
	fobligation_schedule_viewlist.formKeyCountName = '<?php echo $obligation_schedule_view_list->FormKeyCountName ?>';
	loadjs.done("fobligation_schedule_viewlist");
});
var fobligation_schedule_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fobligation_schedule_viewlistsrch = currentSearchForm = new ew.Form("fobligation_schedule_viewlistsrch");

	// Dynamic selection lists
	// Filters

	fobligation_schedule_viewlistsrch.filterList = <?php echo $obligation_schedule_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	fobligation_schedule_viewlistsrch.initSearchPanel = true;
	loadjs.done("fobligation_schedule_viewlistsrch");
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
<?php if (!$obligation_schedule_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($obligation_schedule_view_list->TotalRecords > 0 && $obligation_schedule_view_list->ExportOptions->visible()) { ?>
<?php $obligation_schedule_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($obligation_schedule_view_list->ImportOptions->visible()) { ?>
<?php $obligation_schedule_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($obligation_schedule_view_list->SearchOptions->visible()) { ?>
<?php $obligation_schedule_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($obligation_schedule_view_list->FilterOptions->visible()) { ?>
<?php $obligation_schedule_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$obligation_schedule_view_list->isExport() || Config("EXPORT_MASTER_RECORD") && $obligation_schedule_view_list->isExport("print")) { ?>
<?php
if ($obligation_schedule_view_list->DbMasterFilter != "" && $obligation_schedule_view->getCurrentMasterTable() == "payroll_period") {
	if ($obligation_schedule_view_list->MasterRecordExists) {
		include_once "payroll_periodmaster.php";
	}
}
?>
<?php } ?>
<?php
$obligation_schedule_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$obligation_schedule_view_list->isExport() && !$obligation_schedule_view->CurrentAction) { ?>
<form name="fobligation_schedule_viewlistsrch" id="fobligation_schedule_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fobligation_schedule_viewlistsrch-search-panel" class="<?php echo $obligation_schedule_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="obligation_schedule_view">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $obligation_schedule_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($obligation_schedule_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($obligation_schedule_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $obligation_schedule_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($obligation_schedule_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($obligation_schedule_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($obligation_schedule_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($obligation_schedule_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $obligation_schedule_view_list->showPageHeader(); ?>
<?php
$obligation_schedule_view_list->showMessage();
?>
<?php if ($obligation_schedule_view_list->TotalRecords > 0 || $obligation_schedule_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($obligation_schedule_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> obligation_schedule_view">
<?php if (!$obligation_schedule_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$obligation_schedule_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $obligation_schedule_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $obligation_schedule_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fobligation_schedule_viewlist" id="fobligation_schedule_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="obligation_schedule_view">
<?php if ($obligation_schedule_view->getCurrentMasterTable() == "payroll_period" && $obligation_schedule_view->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="payroll_period">
<input type="hidden" name="fk_PeriodCode" value="<?php echo HtmlEncode($obligation_schedule_view_list->PeriodCode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_obligation_schedule_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($obligation_schedule_view_list->TotalRecords > 0 || $obligation_schedule_view_list->isGridEdit()) { ?>
<table id="tbl_obligation_schedule_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$obligation_schedule_view->RowType = ROWTYPE_HEADER;

// Render list options
$obligation_schedule_view_list->renderListOptions();

// Render list options (header, left)
$obligation_schedule_view_list->ListOptions->render("header", "left");
?>
<?php if ($obligation_schedule_view_list->LAName->Visible) { // LAName ?>
	<?php if ($obligation_schedule_view_list->SortUrl($obligation_schedule_view_list->LAName) == "") { ?>
		<th data-name="LAName" class="<?php echo $obligation_schedule_view_list->LAName->headerCellClass() ?>"><div id="elh_obligation_schedule_view_LAName" class="obligation_schedule_view_LAName"><div class="ew-table-header-caption"><?php echo $obligation_schedule_view_list->LAName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LAName" class="<?php echo $obligation_schedule_view_list->LAName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $obligation_schedule_view_list->SortUrl($obligation_schedule_view_list->LAName) ?>', 1);"><div id="elh_obligation_schedule_view_LAName" class="obligation_schedule_view_LAName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_list->LAName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_list->LAName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_list->LAName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_list->NRC->Visible) { // NRC ?>
	<?php if ($obligation_schedule_view_list->SortUrl($obligation_schedule_view_list->NRC) == "") { ?>
		<th data-name="NRC" class="<?php echo $obligation_schedule_view_list->NRC->headerCellClass() ?>"><div id="elh_obligation_schedule_view_NRC" class="obligation_schedule_view_NRC"><div class="ew-table-header-caption"><?php echo $obligation_schedule_view_list->NRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC" class="<?php echo $obligation_schedule_view_list->NRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $obligation_schedule_view_list->SortUrl($obligation_schedule_view_list->NRC) ?>', 1);"><div id="elh_obligation_schedule_view_NRC" class="obligation_schedule_view_NRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_list->NRC->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_list->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_list->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_list->Surname->Visible) { // Surname ?>
	<?php if ($obligation_schedule_view_list->SortUrl($obligation_schedule_view_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $obligation_schedule_view_list->Surname->headerCellClass() ?>"><div id="elh_obligation_schedule_view_Surname" class="obligation_schedule_view_Surname"><div class="ew-table-header-caption"><?php echo $obligation_schedule_view_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $obligation_schedule_view_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $obligation_schedule_view_list->SortUrl($obligation_schedule_view_list->Surname) ?>', 1);"><div id="elh_obligation_schedule_view_Surname" class="obligation_schedule_view_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_list->MiddleName->Visible) { // MiddleName ?>
	<?php if ($obligation_schedule_view_list->SortUrl($obligation_schedule_view_list->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $obligation_schedule_view_list->MiddleName->headerCellClass() ?>"><div id="elh_obligation_schedule_view_MiddleName" class="obligation_schedule_view_MiddleName"><div class="ew-table-header-caption"><?php echo $obligation_schedule_view_list->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $obligation_schedule_view_list->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $obligation_schedule_view_list->SortUrl($obligation_schedule_view_list->MiddleName) ?>', 1);"><div id="elh_obligation_schedule_view_MiddleName" class="obligation_schedule_view_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_list->MiddleName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_list->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_list->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_list->FirstName->Visible) { // FirstName ?>
	<?php if ($obligation_schedule_view_list->SortUrl($obligation_schedule_view_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $obligation_schedule_view_list->FirstName->headerCellClass() ?>"><div id="elh_obligation_schedule_view_FirstName" class="obligation_schedule_view_FirstName"><div class="ew-table-header-caption"><?php echo $obligation_schedule_view_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $obligation_schedule_view_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $obligation_schedule_view_list->SortUrl($obligation_schedule_view_list->FirstName) ?>', 1);"><div id="elh_obligation_schedule_view_FirstName" class="obligation_schedule_view_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_list->PositionName->Visible) { // PositionName ?>
	<?php if ($obligation_schedule_view_list->SortUrl($obligation_schedule_view_list->PositionName) == "") { ?>
		<th data-name="PositionName" class="<?php echo $obligation_schedule_view_list->PositionName->headerCellClass() ?>"><div id="elh_obligation_schedule_view_PositionName" class="obligation_schedule_view_PositionName"><div class="ew-table-header-caption"><?php echo $obligation_schedule_view_list->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionName" class="<?php echo $obligation_schedule_view_list->PositionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $obligation_schedule_view_list->SortUrl($obligation_schedule_view_list->PositionName) ?>', 1);"><div id="elh_obligation_schedule_view_PositionName" class="obligation_schedule_view_PositionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_list->PositionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_list->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_list->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($obligation_schedule_view_list->SortUrl($obligation_schedule_view_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $obligation_schedule_view_list->EmployeeID->headerCellClass() ?>"><div id="elh_obligation_schedule_view_EmployeeID" class="obligation_schedule_view_EmployeeID"><div class="ew-table-header-caption"><?php echo $obligation_schedule_view_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $obligation_schedule_view_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $obligation_schedule_view_list->SortUrl($obligation_schedule_view_list->EmployeeID) ?>', 1);"><div id="elh_obligation_schedule_view_EmployeeID" class="obligation_schedule_view_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_list->PayrollDate->Visible) { // PayrollDate ?>
	<?php if ($obligation_schedule_view_list->SortUrl($obligation_schedule_view_list->PayrollDate) == "") { ?>
		<th data-name="PayrollDate" class="<?php echo $obligation_schedule_view_list->PayrollDate->headerCellClass() ?>"><div id="elh_obligation_schedule_view_PayrollDate" class="obligation_schedule_view_PayrollDate"><div class="ew-table-header-caption"><?php echo $obligation_schedule_view_list->PayrollDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollDate" class="<?php echo $obligation_schedule_view_list->PayrollDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $obligation_schedule_view_list->SortUrl($obligation_schedule_view_list->PayrollDate) ?>', 1);"><div id="elh_obligation_schedule_view_PayrollDate" class="obligation_schedule_view_PayrollDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_list->PayrollDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_list->PayrollDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_list->PayrollDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_list->ObligationAmount->Visible) { // ObligationAmount ?>
	<?php if ($obligation_schedule_view_list->SortUrl($obligation_schedule_view_list->ObligationAmount) == "") { ?>
		<th data-name="ObligationAmount" class="<?php echo $obligation_schedule_view_list->ObligationAmount->headerCellClass() ?>"><div id="elh_obligation_schedule_view_ObligationAmount" class="obligation_schedule_view_ObligationAmount"><div class="ew-table-header-caption"><?php echo $obligation_schedule_view_list->ObligationAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ObligationAmount" class="<?php echo $obligation_schedule_view_list->ObligationAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $obligation_schedule_view_list->SortUrl($obligation_schedule_view_list->ObligationAmount) ?>', 1);"><div id="elh_obligation_schedule_view_ObligationAmount" class="obligation_schedule_view_ObligationAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_list->ObligationAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_list->ObligationAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_list->ObligationAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_list->DeductionName->Visible) { // DeductionName ?>
	<?php if ($obligation_schedule_view_list->SortUrl($obligation_schedule_view_list->DeductionName) == "") { ?>
		<th data-name="DeductionName" class="<?php echo $obligation_schedule_view_list->DeductionName->headerCellClass() ?>"><div id="elh_obligation_schedule_view_DeductionName" class="obligation_schedule_view_DeductionName"><div class="ew-table-header-caption"><?php echo $obligation_schedule_view_list->DeductionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionName" class="<?php echo $obligation_schedule_view_list->DeductionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $obligation_schedule_view_list->SortUrl($obligation_schedule_view_list->DeductionName) ?>', 1);"><div id="elh_obligation_schedule_view_DeductionName" class="obligation_schedule_view_DeductionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_list->DeductionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_list->DeductionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_list->DeductionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_list->PeriodCode->Visible) { // PeriodCode ?>
	<?php if ($obligation_schedule_view_list->SortUrl($obligation_schedule_view_list->PeriodCode) == "") { ?>
		<th data-name="PeriodCode" class="<?php echo $obligation_schedule_view_list->PeriodCode->headerCellClass() ?>"><div id="elh_obligation_schedule_view_PeriodCode" class="obligation_schedule_view_PeriodCode"><div class="ew-table-header-caption"><?php echo $obligation_schedule_view_list->PeriodCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodCode" class="<?php echo $obligation_schedule_view_list->PeriodCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $obligation_schedule_view_list->SortUrl($obligation_schedule_view_list->PeriodCode) ?>', 1);"><div id="elh_obligation_schedule_view_PeriodCode" class="obligation_schedule_view_PeriodCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_list->PeriodCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_list->PeriodCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_list->PeriodCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$obligation_schedule_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($obligation_schedule_view_list->ExportAll && $obligation_schedule_view_list->isExport()) {
	$obligation_schedule_view_list->StopRecord = $obligation_schedule_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($obligation_schedule_view_list->TotalRecords > $obligation_schedule_view_list->StartRecord + $obligation_schedule_view_list->DisplayRecords - 1)
		$obligation_schedule_view_list->StopRecord = $obligation_schedule_view_list->StartRecord + $obligation_schedule_view_list->DisplayRecords - 1;
	else
		$obligation_schedule_view_list->StopRecord = $obligation_schedule_view_list->TotalRecords;
}
$obligation_schedule_view_list->RecordCount = $obligation_schedule_view_list->StartRecord - 1;
if ($obligation_schedule_view_list->Recordset && !$obligation_schedule_view_list->Recordset->EOF) {
	$obligation_schedule_view_list->Recordset->moveFirst();
	$selectLimit = $obligation_schedule_view_list->UseSelectLimit;
	if (!$selectLimit && $obligation_schedule_view_list->StartRecord > 1)
		$obligation_schedule_view_list->Recordset->move($obligation_schedule_view_list->StartRecord - 1);
} elseif (!$obligation_schedule_view->AllowAddDeleteRow && $obligation_schedule_view_list->StopRecord == 0) {
	$obligation_schedule_view_list->StopRecord = $obligation_schedule_view->GridAddRowCount;
}

// Initialize aggregate
$obligation_schedule_view->RowType = ROWTYPE_AGGREGATEINIT;
$obligation_schedule_view->resetAttributes();
$obligation_schedule_view_list->renderRow();
while ($obligation_schedule_view_list->RecordCount < $obligation_schedule_view_list->StopRecord) {
	$obligation_schedule_view_list->RecordCount++;
	if ($obligation_schedule_view_list->RecordCount >= $obligation_schedule_view_list->StartRecord) {
		$obligation_schedule_view_list->RowCount++;

		// Set up key count
		$obligation_schedule_view_list->KeyCount = $obligation_schedule_view_list->RowIndex;

		// Init row class and style
		$obligation_schedule_view->resetAttributes();
		$obligation_schedule_view->CssClass = "";
		if ($obligation_schedule_view_list->isGridAdd()) {
		} else {
			$obligation_schedule_view_list->loadRowValues($obligation_schedule_view_list->Recordset); // Load row values
		}
		$obligation_schedule_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$obligation_schedule_view->RowAttrs->merge(["data-rowindex" => $obligation_schedule_view_list->RowCount, "id" => "r" . $obligation_schedule_view_list->RowCount . "_obligation_schedule_view", "data-rowtype" => $obligation_schedule_view->RowType]);

		// Render row
		$obligation_schedule_view_list->renderRow();

		// Render list options
		$obligation_schedule_view_list->renderListOptions();
?>
	<tr <?php echo $obligation_schedule_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$obligation_schedule_view_list->ListOptions->render("body", "left", $obligation_schedule_view_list->RowCount);
?>
	<?php if ($obligation_schedule_view_list->LAName->Visible) { // LAName ?>
		<td data-name="LAName" <?php echo $obligation_schedule_view_list->LAName->cellAttributes() ?>>
<span id="el<?php echo $obligation_schedule_view_list->RowCount ?>_obligation_schedule_view_LAName">
<span<?php echo $obligation_schedule_view_list->LAName->viewAttributes() ?>><?php echo $obligation_schedule_view_list->LAName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_list->NRC->Visible) { // NRC ?>
		<td data-name="NRC" <?php echo $obligation_schedule_view_list->NRC->cellAttributes() ?>>
<span id="el<?php echo $obligation_schedule_view_list->RowCount ?>_obligation_schedule_view_NRC">
<span<?php echo $obligation_schedule_view_list->NRC->viewAttributes() ?>><?php echo $obligation_schedule_view_list->NRC->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $obligation_schedule_view_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $obligation_schedule_view_list->RowCount ?>_obligation_schedule_view_Surname">
<span<?php echo $obligation_schedule_view_list->Surname->viewAttributes() ?>><?php echo $obligation_schedule_view_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $obligation_schedule_view_list->MiddleName->cellAttributes() ?>>
<span id="el<?php echo $obligation_schedule_view_list->RowCount ?>_obligation_schedule_view_MiddleName">
<span<?php echo $obligation_schedule_view_list->MiddleName->viewAttributes() ?>><?php echo $obligation_schedule_view_list->MiddleName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $obligation_schedule_view_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $obligation_schedule_view_list->RowCount ?>_obligation_schedule_view_FirstName">
<span<?php echo $obligation_schedule_view_list->FirstName->viewAttributes() ?>><?php echo $obligation_schedule_view_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_list->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName" <?php echo $obligation_schedule_view_list->PositionName->cellAttributes() ?>>
<span id="el<?php echo $obligation_schedule_view_list->RowCount ?>_obligation_schedule_view_PositionName">
<span<?php echo $obligation_schedule_view_list->PositionName->viewAttributes() ?>><?php echo $obligation_schedule_view_list->PositionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $obligation_schedule_view_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $obligation_schedule_view_list->RowCount ?>_obligation_schedule_view_EmployeeID">
<span<?php echo $obligation_schedule_view_list->EmployeeID->viewAttributes() ?>><?php echo $obligation_schedule_view_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_list->PayrollDate->Visible) { // PayrollDate ?>
		<td data-name="PayrollDate" <?php echo $obligation_schedule_view_list->PayrollDate->cellAttributes() ?>>
<span id="el<?php echo $obligation_schedule_view_list->RowCount ?>_obligation_schedule_view_PayrollDate">
<span<?php echo $obligation_schedule_view_list->PayrollDate->viewAttributes() ?>><?php echo $obligation_schedule_view_list->PayrollDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_list->ObligationAmount->Visible) { // ObligationAmount ?>
		<td data-name="ObligationAmount" <?php echo $obligation_schedule_view_list->ObligationAmount->cellAttributes() ?>>
<span id="el<?php echo $obligation_schedule_view_list->RowCount ?>_obligation_schedule_view_ObligationAmount">
<span<?php echo $obligation_schedule_view_list->ObligationAmount->viewAttributes() ?>><?php echo $obligation_schedule_view_list->ObligationAmount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_list->DeductionName->Visible) { // DeductionName ?>
		<td data-name="DeductionName" <?php echo $obligation_schedule_view_list->DeductionName->cellAttributes() ?>>
<span id="el<?php echo $obligation_schedule_view_list->RowCount ?>_obligation_schedule_view_DeductionName">
<span<?php echo $obligation_schedule_view_list->DeductionName->viewAttributes() ?>><?php echo $obligation_schedule_view_list->DeductionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_list->PeriodCode->Visible) { // PeriodCode ?>
		<td data-name="PeriodCode" <?php echo $obligation_schedule_view_list->PeriodCode->cellAttributes() ?>>
<span id="el<?php echo $obligation_schedule_view_list->RowCount ?>_obligation_schedule_view_PeriodCode">
<span<?php echo $obligation_schedule_view_list->PeriodCode->viewAttributes() ?>><?php echo $obligation_schedule_view_list->PeriodCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$obligation_schedule_view_list->ListOptions->render("body", "right", $obligation_schedule_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$obligation_schedule_view_list->isGridAdd())
		$obligation_schedule_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$obligation_schedule_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($obligation_schedule_view_list->Recordset)
	$obligation_schedule_view_list->Recordset->Close();
?>
<?php if (!$obligation_schedule_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$obligation_schedule_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $obligation_schedule_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $obligation_schedule_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($obligation_schedule_view_list->TotalRecords == 0 && !$obligation_schedule_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $obligation_schedule_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$obligation_schedule_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$obligation_schedule_view_list->isExport()) { ?>
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
$obligation_schedule_view_list->terminate();
?>