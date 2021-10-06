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
$paye_summary_view_list = new paye_summary_view_list();

// Run the page
$paye_summary_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$paye_summary_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$paye_summary_view_list->isExport()) { ?>
<script>
var fpaye_summary_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpaye_summary_viewlist = currentForm = new ew.Form("fpaye_summary_viewlist", "list");
	fpaye_summary_viewlist.formKeyCountName = '<?php echo $paye_summary_view_list->FormKeyCountName ?>';
	loadjs.done("fpaye_summary_viewlist");
});
var fpaye_summary_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpaye_summary_viewlistsrch = currentSearchForm = new ew.Form("fpaye_summary_viewlistsrch");

	// Dynamic selection lists
	// Filters

	fpaye_summary_viewlistsrch.filterList = <?php echo $paye_summary_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	fpaye_summary_viewlistsrch.initSearchPanel = true;
	loadjs.done("fpaye_summary_viewlistsrch");
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
<?php if (!$paye_summary_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($paye_summary_view_list->TotalRecords > 0 && $paye_summary_view_list->ExportOptions->visible()) { ?>
<?php $paye_summary_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($paye_summary_view_list->ImportOptions->visible()) { ?>
<?php $paye_summary_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($paye_summary_view_list->SearchOptions->visible()) { ?>
<?php $paye_summary_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($paye_summary_view_list->FilterOptions->visible()) { ?>
<?php $paye_summary_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$paye_summary_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$paye_summary_view_list->isExport() && !$paye_summary_view->CurrentAction) { ?>
<form name="fpaye_summary_viewlistsrch" id="fpaye_summary_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpaye_summary_viewlistsrch-search-panel" class="<?php echo $paye_summary_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="paye_summary_view">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $paye_summary_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($paye_summary_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($paye_summary_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $paye_summary_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($paye_summary_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($paye_summary_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($paye_summary_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($paye_summary_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $paye_summary_view_list->showPageHeader(); ?>
<?php
$paye_summary_view_list->showMessage();
?>
<?php if ($paye_summary_view_list->TotalRecords > 0 || $paye_summary_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($paye_summary_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> paye_summary_view">
<?php if (!$paye_summary_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$paye_summary_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $paye_summary_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $paye_summary_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpaye_summary_viewlist" id="fpaye_summary_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="paye_summary_view">
<div id="gmp_paye_summary_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($paye_summary_view_list->TotalRecords > 0 || $paye_summary_view_list->isGridEdit()) { ?>
<table id="tbl_paye_summary_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$paye_summary_view->RowType = ROWTYPE_HEADER;

// Render list options
$paye_summary_view_list->renderListOptions();

// Render list options (header, left)
$paye_summary_view_list->ListOptions->render("header", "left");
?>
<?php if ($paye_summary_view_list->LocalAuthority->Visible) { // LocalAuthority ?>
	<?php if ($paye_summary_view_list->SortUrl($paye_summary_view_list->LocalAuthority) == "") { ?>
		<th data-name="LocalAuthority" class="<?php echo $paye_summary_view_list->LocalAuthority->headerCellClass() ?>"><div id="elh_paye_summary_view_LocalAuthority" class="paye_summary_view_LocalAuthority"><div class="ew-table-header-caption"><?php echo $paye_summary_view_list->LocalAuthority->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LocalAuthority" class="<?php echo $paye_summary_view_list->LocalAuthority->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_summary_view_list->SortUrl($paye_summary_view_list->LocalAuthority) ?>', 1);"><div id="elh_paye_summary_view_LocalAuthority" class="paye_summary_view_LocalAuthority">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_summary_view_list->LocalAuthority->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_summary_view_list->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_summary_view_list->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_summary_view_list->DepartmentName->Visible) { // DepartmentName ?>
	<?php if ($paye_summary_view_list->SortUrl($paye_summary_view_list->DepartmentName) == "") { ?>
		<th data-name="DepartmentName" class="<?php echo $paye_summary_view_list->DepartmentName->headerCellClass() ?>"><div id="elh_paye_summary_view_DepartmentName" class="paye_summary_view_DepartmentName"><div class="ew-table-header-caption"><?php echo $paye_summary_view_list->DepartmentName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentName" class="<?php echo $paye_summary_view_list->DepartmentName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_summary_view_list->SortUrl($paye_summary_view_list->DepartmentName) ?>', 1);"><div id="elh_paye_summary_view_DepartmentName" class="paye_summary_view_DepartmentName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_summary_view_list->DepartmentName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_summary_view_list->DepartmentName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_summary_view_list->DepartmentName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_summary_view_list->SectionName->Visible) { // SectionName ?>
	<?php if ($paye_summary_view_list->SortUrl($paye_summary_view_list->SectionName) == "") { ?>
		<th data-name="SectionName" class="<?php echo $paye_summary_view_list->SectionName->headerCellClass() ?>"><div id="elh_paye_summary_view_SectionName" class="paye_summary_view_SectionName"><div class="ew-table-header-caption"><?php echo $paye_summary_view_list->SectionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionName" class="<?php echo $paye_summary_view_list->SectionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_summary_view_list->SortUrl($paye_summary_view_list->SectionName) ?>', 1);"><div id="elh_paye_summary_view_SectionName" class="paye_summary_view_SectionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_summary_view_list->SectionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_summary_view_list->SectionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_summary_view_list->SectionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_summary_view_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($paye_summary_view_list->SortUrl($paye_summary_view_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $paye_summary_view_list->EmployeeID->headerCellClass() ?>"><div id="elh_paye_summary_view_EmployeeID" class="paye_summary_view_EmployeeID"><div class="ew-table-header-caption"><?php echo $paye_summary_view_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $paye_summary_view_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_summary_view_list->SortUrl($paye_summary_view_list->EmployeeID) ?>', 1);"><div id="elh_paye_summary_view_EmployeeID" class="paye_summary_view_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_summary_view_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_summary_view_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_summary_view_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_summary_view_list->NRC->Visible) { // NRC ?>
	<?php if ($paye_summary_view_list->SortUrl($paye_summary_view_list->NRC) == "") { ?>
		<th data-name="NRC" class="<?php echo $paye_summary_view_list->NRC->headerCellClass() ?>"><div id="elh_paye_summary_view_NRC" class="paye_summary_view_NRC"><div class="ew-table-header-caption"><?php echo $paye_summary_view_list->NRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC" class="<?php echo $paye_summary_view_list->NRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_summary_view_list->SortUrl($paye_summary_view_list->NRC) ?>', 1);"><div id="elh_paye_summary_view_NRC" class="paye_summary_view_NRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_summary_view_list->NRC->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_summary_view_list->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_summary_view_list->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_summary_view_list->EmploymentTypeDesc->Visible) { // EmploymentTypeDesc ?>
	<?php if ($paye_summary_view_list->SortUrl($paye_summary_view_list->EmploymentTypeDesc) == "") { ?>
		<th data-name="EmploymentTypeDesc" class="<?php echo $paye_summary_view_list->EmploymentTypeDesc->headerCellClass() ?>"><div id="elh_paye_summary_view_EmploymentTypeDesc" class="paye_summary_view_EmploymentTypeDesc"><div class="ew-table-header-caption"><?php echo $paye_summary_view_list->EmploymentTypeDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmploymentTypeDesc" class="<?php echo $paye_summary_view_list->EmploymentTypeDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_summary_view_list->SortUrl($paye_summary_view_list->EmploymentTypeDesc) ?>', 1);"><div id="elh_paye_summary_view_EmploymentTypeDesc" class="paye_summary_view_EmploymentTypeDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_summary_view_list->EmploymentTypeDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_summary_view_list->EmploymentTypeDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_summary_view_list->EmploymentTypeDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_summary_view_list->Year->Visible) { // Year ?>
	<?php if ($paye_summary_view_list->SortUrl($paye_summary_view_list->Year) == "") { ?>
		<th data-name="Year" class="<?php echo $paye_summary_view_list->Year->headerCellClass() ?>"><div id="elh_paye_summary_view_Year" class="paye_summary_view_Year"><div class="ew-table-header-caption"><?php echo $paye_summary_view_list->Year->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Year" class="<?php echo $paye_summary_view_list->Year->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_summary_view_list->SortUrl($paye_summary_view_list->Year) ?>', 1);"><div id="elh_paye_summary_view_Year" class="paye_summary_view_Year">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_summary_view_list->Year->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_summary_view_list->Year->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_summary_view_list->Year->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_summary_view_list->MonthShort->Visible) { // MonthShort ?>
	<?php if ($paye_summary_view_list->SortUrl($paye_summary_view_list->MonthShort) == "") { ?>
		<th data-name="MonthShort" class="<?php echo $paye_summary_view_list->MonthShort->headerCellClass() ?>"><div id="elh_paye_summary_view_MonthShort" class="paye_summary_view_MonthShort"><div class="ew-table-header-caption"><?php echo $paye_summary_view_list->MonthShort->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MonthShort" class="<?php echo $paye_summary_view_list->MonthShort->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_summary_view_list->SortUrl($paye_summary_view_list->MonthShort) ?>', 1);"><div id="elh_paye_summary_view_MonthShort" class="paye_summary_view_MonthShort">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_summary_view_list->MonthShort->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_summary_view_list->MonthShort->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_summary_view_list->MonthShort->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_summary_view_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($paye_summary_view_list->SortUrl($paye_summary_view_list->PayrollPeriod) == "") { ?>
		<th data-name="PayrollPeriod" class="<?php echo $paye_summary_view_list->PayrollPeriod->headerCellClass() ?>"><div id="elh_paye_summary_view_PayrollPeriod" class="paye_summary_view_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $paye_summary_view_list->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollPeriod" class="<?php echo $paye_summary_view_list->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_summary_view_list->SortUrl($paye_summary_view_list->PayrollPeriod) ?>', 1);"><div id="elh_paye_summary_view_PayrollPeriod" class="paye_summary_view_PayrollPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_summary_view_list->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_summary_view_list->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_summary_view_list->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_summary_view_list->GrossIncome->Visible) { // GrossIncome ?>
	<?php if ($paye_summary_view_list->SortUrl($paye_summary_view_list->GrossIncome) == "") { ?>
		<th data-name="GrossIncome" class="<?php echo $paye_summary_view_list->GrossIncome->headerCellClass() ?>"><div id="elh_paye_summary_view_GrossIncome" class="paye_summary_view_GrossIncome"><div class="ew-table-header-caption"><?php echo $paye_summary_view_list->GrossIncome->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="GrossIncome" class="<?php echo $paye_summary_view_list->GrossIncome->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_summary_view_list->SortUrl($paye_summary_view_list->GrossIncome) ?>', 1);"><div id="elh_paye_summary_view_GrossIncome" class="paye_summary_view_GrossIncome">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_summary_view_list->GrossIncome->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_summary_view_list->GrossIncome->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_summary_view_list->GrossIncome->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_summary_view_list->TaxableIncome->Visible) { // TaxableIncome ?>
	<?php if ($paye_summary_view_list->SortUrl($paye_summary_view_list->TaxableIncome) == "") { ?>
		<th data-name="TaxableIncome" class="<?php echo $paye_summary_view_list->TaxableIncome->headerCellClass() ?>"><div id="elh_paye_summary_view_TaxableIncome" class="paye_summary_view_TaxableIncome"><div class="ew-table-header-caption"><?php echo $paye_summary_view_list->TaxableIncome->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TaxableIncome" class="<?php echo $paye_summary_view_list->TaxableIncome->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_summary_view_list->SortUrl($paye_summary_view_list->TaxableIncome) ?>', 1);"><div id="elh_paye_summary_view_TaxableIncome" class="paye_summary_view_TaxableIncome">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_summary_view_list->TaxableIncome->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_summary_view_list->TaxableIncome->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_summary_view_list->TaxableIncome->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_summary_view_list->PAYE->Visible) { // PAYE ?>
	<?php if ($paye_summary_view_list->SortUrl($paye_summary_view_list->PAYE) == "") { ?>
		<th data-name="PAYE" class="<?php echo $paye_summary_view_list->PAYE->headerCellClass() ?>"><div id="elh_paye_summary_view_PAYE" class="paye_summary_view_PAYE"><div class="ew-table-header-caption"><?php echo $paye_summary_view_list->PAYE->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PAYE" class="<?php echo $paye_summary_view_list->PAYE->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_summary_view_list->SortUrl($paye_summary_view_list->PAYE) ?>', 1);"><div id="elh_paye_summary_view_PAYE" class="paye_summary_view_PAYE">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_summary_view_list->PAYE->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_summary_view_list->PAYE->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_summary_view_list->PAYE->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_summary_view_list->TaxCredit->Visible) { // TaxCredit ?>
	<?php if ($paye_summary_view_list->SortUrl($paye_summary_view_list->TaxCredit) == "") { ?>
		<th data-name="TaxCredit" class="<?php echo $paye_summary_view_list->TaxCredit->headerCellClass() ?>"><div id="elh_paye_summary_view_TaxCredit" class="paye_summary_view_TaxCredit"><div class="ew-table-header-caption"><?php echo $paye_summary_view_list->TaxCredit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TaxCredit" class="<?php echo $paye_summary_view_list->TaxCredit->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_summary_view_list->SortUrl($paye_summary_view_list->TaxCredit) ?>', 1);"><div id="elh_paye_summary_view_TaxCredit" class="paye_summary_view_TaxCredit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_summary_view_list->TaxCredit->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_summary_view_list->TaxCredit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_summary_view_list->TaxCredit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_summary_view_list->Adjustment->Visible) { // Adjustment ?>
	<?php if ($paye_summary_view_list->SortUrl($paye_summary_view_list->Adjustment) == "") { ?>
		<th data-name="Adjustment" class="<?php echo $paye_summary_view_list->Adjustment->headerCellClass() ?>"><div id="elh_paye_summary_view_Adjustment" class="paye_summary_view_Adjustment"><div class="ew-table-header-caption"><?php echo $paye_summary_view_list->Adjustment->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Adjustment" class="<?php echo $paye_summary_view_list->Adjustment->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_summary_view_list->SortUrl($paye_summary_view_list->Adjustment) ?>', 1);"><div id="elh_paye_summary_view_Adjustment" class="paye_summary_view_Adjustment">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_summary_view_list->Adjustment->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_summary_view_list->Adjustment->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_summary_view_list->Adjustment->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$paye_summary_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($paye_summary_view_list->ExportAll && $paye_summary_view_list->isExport()) {
	$paye_summary_view_list->StopRecord = $paye_summary_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($paye_summary_view_list->TotalRecords > $paye_summary_view_list->StartRecord + $paye_summary_view_list->DisplayRecords - 1)
		$paye_summary_view_list->StopRecord = $paye_summary_view_list->StartRecord + $paye_summary_view_list->DisplayRecords - 1;
	else
		$paye_summary_view_list->StopRecord = $paye_summary_view_list->TotalRecords;
}
$paye_summary_view_list->RecordCount = $paye_summary_view_list->StartRecord - 1;
if ($paye_summary_view_list->Recordset && !$paye_summary_view_list->Recordset->EOF) {
	$paye_summary_view_list->Recordset->moveFirst();
	$selectLimit = $paye_summary_view_list->UseSelectLimit;
	if (!$selectLimit && $paye_summary_view_list->StartRecord > 1)
		$paye_summary_view_list->Recordset->move($paye_summary_view_list->StartRecord - 1);
} elseif (!$paye_summary_view->AllowAddDeleteRow && $paye_summary_view_list->StopRecord == 0) {
	$paye_summary_view_list->StopRecord = $paye_summary_view->GridAddRowCount;
}

// Initialize aggregate
$paye_summary_view->RowType = ROWTYPE_AGGREGATEINIT;
$paye_summary_view->resetAttributes();
$paye_summary_view_list->renderRow();
while ($paye_summary_view_list->RecordCount < $paye_summary_view_list->StopRecord) {
	$paye_summary_view_list->RecordCount++;
	if ($paye_summary_view_list->RecordCount >= $paye_summary_view_list->StartRecord) {
		$paye_summary_view_list->RowCount++;

		// Set up key count
		$paye_summary_view_list->KeyCount = $paye_summary_view_list->RowIndex;

		// Init row class and style
		$paye_summary_view->resetAttributes();
		$paye_summary_view->CssClass = "";
		if ($paye_summary_view_list->isGridAdd()) {
		} else {
			$paye_summary_view_list->loadRowValues($paye_summary_view_list->Recordset); // Load row values
		}
		$paye_summary_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$paye_summary_view->RowAttrs->merge(["data-rowindex" => $paye_summary_view_list->RowCount, "id" => "r" . $paye_summary_view_list->RowCount . "_paye_summary_view", "data-rowtype" => $paye_summary_view->RowType]);

		// Render row
		$paye_summary_view_list->renderRow();

		// Render list options
		$paye_summary_view_list->renderListOptions();
?>
	<tr <?php echo $paye_summary_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$paye_summary_view_list->ListOptions->render("body", "left", $paye_summary_view_list->RowCount);
?>
	<?php if ($paye_summary_view_list->LocalAuthority->Visible) { // LocalAuthority ?>
		<td data-name="LocalAuthority" <?php echo $paye_summary_view_list->LocalAuthority->cellAttributes() ?>>
<span id="el<?php echo $paye_summary_view_list->RowCount ?>_paye_summary_view_LocalAuthority">
<span<?php echo $paye_summary_view_list->LocalAuthority->viewAttributes() ?>><?php echo $paye_summary_view_list->LocalAuthority->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_summary_view_list->DepartmentName->Visible) { // DepartmentName ?>
		<td data-name="DepartmentName" <?php echo $paye_summary_view_list->DepartmentName->cellAttributes() ?>>
<span id="el<?php echo $paye_summary_view_list->RowCount ?>_paye_summary_view_DepartmentName">
<span<?php echo $paye_summary_view_list->DepartmentName->viewAttributes() ?>><?php echo $paye_summary_view_list->DepartmentName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_summary_view_list->SectionName->Visible) { // SectionName ?>
		<td data-name="SectionName" <?php echo $paye_summary_view_list->SectionName->cellAttributes() ?>>
<span id="el<?php echo $paye_summary_view_list->RowCount ?>_paye_summary_view_SectionName">
<span<?php echo $paye_summary_view_list->SectionName->viewAttributes() ?>><?php echo $paye_summary_view_list->SectionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_summary_view_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $paye_summary_view_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $paye_summary_view_list->RowCount ?>_paye_summary_view_EmployeeID">
<span<?php echo $paye_summary_view_list->EmployeeID->viewAttributes() ?>><?php echo $paye_summary_view_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_summary_view_list->NRC->Visible) { // NRC ?>
		<td data-name="NRC" <?php echo $paye_summary_view_list->NRC->cellAttributes() ?>>
<span id="el<?php echo $paye_summary_view_list->RowCount ?>_paye_summary_view_NRC">
<span<?php echo $paye_summary_view_list->NRC->viewAttributes() ?>><?php echo $paye_summary_view_list->NRC->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_summary_view_list->EmploymentTypeDesc->Visible) { // EmploymentTypeDesc ?>
		<td data-name="EmploymentTypeDesc" <?php echo $paye_summary_view_list->EmploymentTypeDesc->cellAttributes() ?>>
<span id="el<?php echo $paye_summary_view_list->RowCount ?>_paye_summary_view_EmploymentTypeDesc">
<span<?php echo $paye_summary_view_list->EmploymentTypeDesc->viewAttributes() ?>><?php echo $paye_summary_view_list->EmploymentTypeDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_summary_view_list->Year->Visible) { // Year ?>
		<td data-name="Year" <?php echo $paye_summary_view_list->Year->cellAttributes() ?>>
<span id="el<?php echo $paye_summary_view_list->RowCount ?>_paye_summary_view_Year">
<span<?php echo $paye_summary_view_list->Year->viewAttributes() ?>><?php echo $paye_summary_view_list->Year->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_summary_view_list->MonthShort->Visible) { // MonthShort ?>
		<td data-name="MonthShort" <?php echo $paye_summary_view_list->MonthShort->cellAttributes() ?>>
<span id="el<?php echo $paye_summary_view_list->RowCount ?>_paye_summary_view_MonthShort">
<span<?php echo $paye_summary_view_list->MonthShort->viewAttributes() ?>><?php echo $paye_summary_view_list->MonthShort->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_summary_view_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod" <?php echo $paye_summary_view_list->PayrollPeriod->cellAttributes() ?>>
<span id="el<?php echo $paye_summary_view_list->RowCount ?>_paye_summary_view_PayrollPeriod">
<span<?php echo $paye_summary_view_list->PayrollPeriod->viewAttributes() ?>><?php echo $paye_summary_view_list->PayrollPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_summary_view_list->GrossIncome->Visible) { // GrossIncome ?>
		<td data-name="GrossIncome" <?php echo $paye_summary_view_list->GrossIncome->cellAttributes() ?>>
<span id="el<?php echo $paye_summary_view_list->RowCount ?>_paye_summary_view_GrossIncome">
<span<?php echo $paye_summary_view_list->GrossIncome->viewAttributes() ?>><?php echo $paye_summary_view_list->GrossIncome->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_summary_view_list->TaxableIncome->Visible) { // TaxableIncome ?>
		<td data-name="TaxableIncome" <?php echo $paye_summary_view_list->TaxableIncome->cellAttributes() ?>>
<span id="el<?php echo $paye_summary_view_list->RowCount ?>_paye_summary_view_TaxableIncome">
<span<?php echo $paye_summary_view_list->TaxableIncome->viewAttributes() ?>><?php echo $paye_summary_view_list->TaxableIncome->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_summary_view_list->PAYE->Visible) { // PAYE ?>
		<td data-name="PAYE" <?php echo $paye_summary_view_list->PAYE->cellAttributes() ?>>
<span id="el<?php echo $paye_summary_view_list->RowCount ?>_paye_summary_view_PAYE">
<span<?php echo $paye_summary_view_list->PAYE->viewAttributes() ?>><?php echo $paye_summary_view_list->PAYE->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_summary_view_list->TaxCredit->Visible) { // TaxCredit ?>
		<td data-name="TaxCredit" <?php echo $paye_summary_view_list->TaxCredit->cellAttributes() ?>>
<span id="el<?php echo $paye_summary_view_list->RowCount ?>_paye_summary_view_TaxCredit">
<span<?php echo $paye_summary_view_list->TaxCredit->viewAttributes() ?>><?php echo $paye_summary_view_list->TaxCredit->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_summary_view_list->Adjustment->Visible) { // Adjustment ?>
		<td data-name="Adjustment" <?php echo $paye_summary_view_list->Adjustment->cellAttributes() ?>>
<span id="el<?php echo $paye_summary_view_list->RowCount ?>_paye_summary_view_Adjustment">
<span<?php echo $paye_summary_view_list->Adjustment->viewAttributes() ?>><?php echo $paye_summary_view_list->Adjustment->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$paye_summary_view_list->ListOptions->render("body", "right", $paye_summary_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$paye_summary_view_list->isGridAdd())
		$paye_summary_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$paye_summary_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($paye_summary_view_list->Recordset)
	$paye_summary_view_list->Recordset->Close();
?>
<?php if (!$paye_summary_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$paye_summary_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $paye_summary_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $paye_summary_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($paye_summary_view_list->TotalRecords == 0 && !$paye_summary_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $paye_summary_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$paye_summary_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$paye_summary_view_list->isExport()) { ?>
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
$paye_summary_view_list->terminate();
?>