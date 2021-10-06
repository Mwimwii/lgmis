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
$_paye_view_list = new _paye_view_list();

// Run the page
$_paye_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_paye_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$_paye_view_list->isExport()) { ?>
<script>
var f_paye_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	f_paye_viewlist = currentForm = new ew.Form("f_paye_viewlist", "list");
	f_paye_viewlist.formKeyCountName = '<?php echo $_paye_view_list->FormKeyCountName ?>';
	loadjs.done("f_paye_viewlist");
});
var f_paye_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	f_paye_viewlistsrch = currentSearchForm = new ew.Form("f_paye_viewlistsrch");

	// Dynamic selection lists
	// Filters

	f_paye_viewlistsrch.filterList = <?php echo $_paye_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	f_paye_viewlistsrch.initSearchPanel = true;
	loadjs.done("f_paye_viewlistsrch");
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
<?php if (!$_paye_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($_paye_view_list->TotalRecords > 0 && $_paye_view_list->ExportOptions->visible()) { ?>
<?php $_paye_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($_paye_view_list->ImportOptions->visible()) { ?>
<?php $_paye_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($_paye_view_list->SearchOptions->visible()) { ?>
<?php $_paye_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($_paye_view_list->FilterOptions->visible()) { ?>
<?php $_paye_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$_paye_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$_paye_view_list->isExport() && !$_paye_view->CurrentAction) { ?>
<form name="f_paye_viewlistsrch" id="f_paye_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="f_paye_viewlistsrch-search-panel" class="<?php echo $_paye_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="_paye_view">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $_paye_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($_paye_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($_paye_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $_paye_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($_paye_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($_paye_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($_paye_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($_paye_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $_paye_view_list->showPageHeader(); ?>
<?php
$_paye_view_list->showMessage();
?>
<?php if ($_paye_view_list->TotalRecords > 0 || $_paye_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($_paye_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> _paye_view">
<?php if (!$_paye_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$_paye_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $_paye_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $_paye_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="f_paye_viewlist" id="f_paye_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_paye_view">
<div id="gmp__paye_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($_paye_view_list->TotalRecords > 0 || $_paye_view_list->isGridEdit()) { ?>
<table id="tbl__paye_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$_paye_view->RowType = ROWTYPE_HEADER;

// Render list options
$_paye_view_list->renderListOptions();

// Render list options (header, left)
$_paye_view_list->ListOptions->render("header", "left");
?>
<?php if ($_paye_view_list->LocalAuthority->Visible) { // LocalAuthority ?>
	<?php if ($_paye_view_list->SortUrl($_paye_view_list->LocalAuthority) == "") { ?>
		<th data-name="LocalAuthority" class="<?php echo $_paye_view_list->LocalAuthority->headerCellClass() ?>"><div id="elh__paye_view_LocalAuthority" class="_paye_view_LocalAuthority"><div class="ew-table-header-caption"><?php echo $_paye_view_list->LocalAuthority->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LocalAuthority" class="<?php echo $_paye_view_list->LocalAuthority->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_paye_view_list->SortUrl($_paye_view_list->LocalAuthority) ?>', 1);"><div id="elh__paye_view_LocalAuthority" class="_paye_view_LocalAuthority">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_paye_view_list->LocalAuthority->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_paye_view_list->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_paye_view_list->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_paye_view_list->DepartmentName->Visible) { // DepartmentName ?>
	<?php if ($_paye_view_list->SortUrl($_paye_view_list->DepartmentName) == "") { ?>
		<th data-name="DepartmentName" class="<?php echo $_paye_view_list->DepartmentName->headerCellClass() ?>"><div id="elh__paye_view_DepartmentName" class="_paye_view_DepartmentName"><div class="ew-table-header-caption"><?php echo $_paye_view_list->DepartmentName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentName" class="<?php echo $_paye_view_list->DepartmentName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_paye_view_list->SortUrl($_paye_view_list->DepartmentName) ?>', 1);"><div id="elh__paye_view_DepartmentName" class="_paye_view_DepartmentName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_paye_view_list->DepartmentName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_paye_view_list->DepartmentName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_paye_view_list->DepartmentName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_paye_view_list->SectionName->Visible) { // SectionName ?>
	<?php if ($_paye_view_list->SortUrl($_paye_view_list->SectionName) == "") { ?>
		<th data-name="SectionName" class="<?php echo $_paye_view_list->SectionName->headerCellClass() ?>"><div id="elh__paye_view_SectionName" class="_paye_view_SectionName"><div class="ew-table-header-caption"><?php echo $_paye_view_list->SectionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionName" class="<?php echo $_paye_view_list->SectionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_paye_view_list->SortUrl($_paye_view_list->SectionName) ?>', 1);"><div id="elh__paye_view_SectionName" class="_paye_view_SectionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_paye_view_list->SectionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_paye_view_list->SectionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_paye_view_list->SectionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_paye_view_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($_paye_view_list->SortUrl($_paye_view_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $_paye_view_list->EmployeeID->headerCellClass() ?>"><div id="elh__paye_view_EmployeeID" class="_paye_view_EmployeeID"><div class="ew-table-header-caption"><?php echo $_paye_view_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $_paye_view_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_paye_view_list->SortUrl($_paye_view_list->EmployeeID) ?>', 1);"><div id="elh__paye_view_EmployeeID" class="_paye_view_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_paye_view_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($_paye_view_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_paye_view_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_paye_view_list->NRC->Visible) { // NRC ?>
	<?php if ($_paye_view_list->SortUrl($_paye_view_list->NRC) == "") { ?>
		<th data-name="NRC" class="<?php echo $_paye_view_list->NRC->headerCellClass() ?>"><div id="elh__paye_view_NRC" class="_paye_view_NRC"><div class="ew-table-header-caption"><?php echo $_paye_view_list->NRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC" class="<?php echo $_paye_view_list->NRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_paye_view_list->SortUrl($_paye_view_list->NRC) ?>', 1);"><div id="elh__paye_view_NRC" class="_paye_view_NRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_paye_view_list->NRC->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_paye_view_list->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_paye_view_list->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_paye_view_list->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
	<?php if ($_paye_view_list->SortUrl($_paye_view_list->SocialSecurityNo) == "") { ?>
		<th data-name="SocialSecurityNo" class="<?php echo $_paye_view_list->SocialSecurityNo->headerCellClass() ?>"><div id="elh__paye_view_SocialSecurityNo" class="_paye_view_SocialSecurityNo"><div class="ew-table-header-caption"><?php echo $_paye_view_list->SocialSecurityNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SocialSecurityNo" class="<?php echo $_paye_view_list->SocialSecurityNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_paye_view_list->SortUrl($_paye_view_list->SocialSecurityNo) ?>', 1);"><div id="elh__paye_view_SocialSecurityNo" class="_paye_view_SocialSecurityNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_paye_view_list->SocialSecurityNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_paye_view_list->SocialSecurityNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_paye_view_list->SocialSecurityNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_paye_view_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($_paye_view_list->SortUrl($_paye_view_list->PayrollPeriod) == "") { ?>
		<th data-name="PayrollPeriod" class="<?php echo $_paye_view_list->PayrollPeriod->headerCellClass() ?>"><div id="elh__paye_view_PayrollPeriod" class="_paye_view_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $_paye_view_list->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollPeriod" class="<?php echo $_paye_view_list->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_paye_view_list->SortUrl($_paye_view_list->PayrollPeriod) ?>', 1);"><div id="elh__paye_view_PayrollPeriod" class="_paye_view_PayrollPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_paye_view_list->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($_paye_view_list->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_paye_view_list->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_paye_view_list->MonthShort->Visible) { // MonthShort ?>
	<?php if ($_paye_view_list->SortUrl($_paye_view_list->MonthShort) == "") { ?>
		<th data-name="MonthShort" class="<?php echo $_paye_view_list->MonthShort->headerCellClass() ?>"><div id="elh__paye_view_MonthShort" class="_paye_view_MonthShort"><div class="ew-table-header-caption"><?php echo $_paye_view_list->MonthShort->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MonthShort" class="<?php echo $_paye_view_list->MonthShort->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_paye_view_list->SortUrl($_paye_view_list->MonthShort) ?>', 1);"><div id="elh__paye_view_MonthShort" class="_paye_view_MonthShort">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_paye_view_list->MonthShort->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_paye_view_list->MonthShort->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_paye_view_list->MonthShort->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_paye_view_list->Year->Visible) { // Year ?>
	<?php if ($_paye_view_list->SortUrl($_paye_view_list->Year) == "") { ?>
		<th data-name="Year" class="<?php echo $_paye_view_list->Year->headerCellClass() ?>"><div id="elh__paye_view_Year" class="_paye_view_Year"><div class="ew-table-header-caption"><?php echo $_paye_view_list->Year->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Year" class="<?php echo $_paye_view_list->Year->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_paye_view_list->SortUrl($_paye_view_list->Year) ?>', 1);"><div id="elh__paye_view_Year" class="_paye_view_Year">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_paye_view_list->Year->caption() ?></span><span class="ew-table-header-sort"><?php if ($_paye_view_list->Year->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_paye_view_list->Year->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_paye_view_list->TaxableIncome->Visible) { // TaxableIncome ?>
	<?php if ($_paye_view_list->SortUrl($_paye_view_list->TaxableIncome) == "") { ?>
		<th data-name="TaxableIncome" class="<?php echo $_paye_view_list->TaxableIncome->headerCellClass() ?>"><div id="elh__paye_view_TaxableIncome" class="_paye_view_TaxableIncome"><div class="ew-table-header-caption"><?php echo $_paye_view_list->TaxableIncome->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TaxableIncome" class="<?php echo $_paye_view_list->TaxableIncome->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_paye_view_list->SortUrl($_paye_view_list->TaxableIncome) ?>', 1);"><div id="elh__paye_view_TaxableIncome" class="_paye_view_TaxableIncome">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_paye_view_list->TaxableIncome->caption() ?></span><span class="ew-table-header-sort"><?php if ($_paye_view_list->TaxableIncome->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_paye_view_list->TaxableIncome->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_paye_view_list->GrossIncome->Visible) { // GrossIncome ?>
	<?php if ($_paye_view_list->SortUrl($_paye_view_list->GrossIncome) == "") { ?>
		<th data-name="GrossIncome" class="<?php echo $_paye_view_list->GrossIncome->headerCellClass() ?>"><div id="elh__paye_view_GrossIncome" class="_paye_view_GrossIncome"><div class="ew-table-header-caption"><?php echo $_paye_view_list->GrossIncome->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="GrossIncome" class="<?php echo $_paye_view_list->GrossIncome->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_paye_view_list->SortUrl($_paye_view_list->GrossIncome) ?>', 1);"><div id="elh__paye_view_GrossIncome" class="_paye_view_GrossIncome">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_paye_view_list->GrossIncome->caption() ?></span><span class="ew-table-header-sort"><?php if ($_paye_view_list->GrossIncome->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_paye_view_list->GrossIncome->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_paye_view_list->PAYE->Visible) { // PAYE ?>
	<?php if ($_paye_view_list->SortUrl($_paye_view_list->PAYE) == "") { ?>
		<th data-name="PAYE" class="<?php echo $_paye_view_list->PAYE->headerCellClass() ?>"><div id="elh__paye_view_PAYE" class="_paye_view_PAYE"><div class="ew-table-header-caption"><?php echo $_paye_view_list->PAYE->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PAYE" class="<?php echo $_paye_view_list->PAYE->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_paye_view_list->SortUrl($_paye_view_list->PAYE) ?>', 1);"><div id="elh__paye_view_PAYE" class="_paye_view_PAYE">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_paye_view_list->PAYE->caption() ?></span><span class="ew-table-header-sort"><?php if ($_paye_view_list->PAYE->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_paye_view_list->PAYE->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_paye_view_list->EmploymentType->Visible) { // EmploymentType ?>
	<?php if ($_paye_view_list->SortUrl($_paye_view_list->EmploymentType) == "") { ?>
		<th data-name="EmploymentType" class="<?php echo $_paye_view_list->EmploymentType->headerCellClass() ?>"><div id="elh__paye_view_EmploymentType" class="_paye_view_EmploymentType"><div class="ew-table-header-caption"><?php echo $_paye_view_list->EmploymentType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmploymentType" class="<?php echo $_paye_view_list->EmploymentType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_paye_view_list->SortUrl($_paye_view_list->EmploymentType) ?>', 1);"><div id="elh__paye_view_EmploymentType" class="_paye_view_EmploymentType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_paye_view_list->EmploymentType->caption() ?></span><span class="ew-table-header-sort"><?php if ($_paye_view_list->EmploymentType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_paye_view_list->EmploymentType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$_paye_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($_paye_view_list->ExportAll && $_paye_view_list->isExport()) {
	$_paye_view_list->StopRecord = $_paye_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($_paye_view_list->TotalRecords > $_paye_view_list->StartRecord + $_paye_view_list->DisplayRecords - 1)
		$_paye_view_list->StopRecord = $_paye_view_list->StartRecord + $_paye_view_list->DisplayRecords - 1;
	else
		$_paye_view_list->StopRecord = $_paye_view_list->TotalRecords;
}
$_paye_view_list->RecordCount = $_paye_view_list->StartRecord - 1;
if ($_paye_view_list->Recordset && !$_paye_view_list->Recordset->EOF) {
	$_paye_view_list->Recordset->moveFirst();
	$selectLimit = $_paye_view_list->UseSelectLimit;
	if (!$selectLimit && $_paye_view_list->StartRecord > 1)
		$_paye_view_list->Recordset->move($_paye_view_list->StartRecord - 1);
} elseif (!$_paye_view->AllowAddDeleteRow && $_paye_view_list->StopRecord == 0) {
	$_paye_view_list->StopRecord = $_paye_view->GridAddRowCount;
}

// Initialize aggregate
$_paye_view->RowType = ROWTYPE_AGGREGATEINIT;
$_paye_view->resetAttributes();
$_paye_view_list->renderRow();
while ($_paye_view_list->RecordCount < $_paye_view_list->StopRecord) {
	$_paye_view_list->RecordCount++;
	if ($_paye_view_list->RecordCount >= $_paye_view_list->StartRecord) {
		$_paye_view_list->RowCount++;

		// Set up key count
		$_paye_view_list->KeyCount = $_paye_view_list->RowIndex;

		// Init row class and style
		$_paye_view->resetAttributes();
		$_paye_view->CssClass = "";
		if ($_paye_view_list->isGridAdd()) {
		} else {
			$_paye_view_list->loadRowValues($_paye_view_list->Recordset); // Load row values
		}
		$_paye_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$_paye_view->RowAttrs->merge(["data-rowindex" => $_paye_view_list->RowCount, "id" => "r" . $_paye_view_list->RowCount . "__paye_view", "data-rowtype" => $_paye_view->RowType]);

		// Render row
		$_paye_view_list->renderRow();

		// Render list options
		$_paye_view_list->renderListOptions();
?>
	<tr <?php echo $_paye_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$_paye_view_list->ListOptions->render("body", "left", $_paye_view_list->RowCount);
?>
	<?php if ($_paye_view_list->LocalAuthority->Visible) { // LocalAuthority ?>
		<td data-name="LocalAuthority" <?php echo $_paye_view_list->LocalAuthority->cellAttributes() ?>>
<span id="el<?php echo $_paye_view_list->RowCount ?>__paye_view_LocalAuthority">
<span<?php echo $_paye_view_list->LocalAuthority->viewAttributes() ?>><?php echo $_paye_view_list->LocalAuthority->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_paye_view_list->DepartmentName->Visible) { // DepartmentName ?>
		<td data-name="DepartmentName" <?php echo $_paye_view_list->DepartmentName->cellAttributes() ?>>
<span id="el<?php echo $_paye_view_list->RowCount ?>__paye_view_DepartmentName">
<span<?php echo $_paye_view_list->DepartmentName->viewAttributes() ?>><?php echo $_paye_view_list->DepartmentName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_paye_view_list->SectionName->Visible) { // SectionName ?>
		<td data-name="SectionName" <?php echo $_paye_view_list->SectionName->cellAttributes() ?>>
<span id="el<?php echo $_paye_view_list->RowCount ?>__paye_view_SectionName">
<span<?php echo $_paye_view_list->SectionName->viewAttributes() ?>><?php echo $_paye_view_list->SectionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_paye_view_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $_paye_view_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $_paye_view_list->RowCount ?>__paye_view_EmployeeID">
<span<?php echo $_paye_view_list->EmployeeID->viewAttributes() ?>><?php echo $_paye_view_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_paye_view_list->NRC->Visible) { // NRC ?>
		<td data-name="NRC" <?php echo $_paye_view_list->NRC->cellAttributes() ?>>
<span id="el<?php echo $_paye_view_list->RowCount ?>__paye_view_NRC">
<span<?php echo $_paye_view_list->NRC->viewAttributes() ?>><?php echo $_paye_view_list->NRC->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_paye_view_list->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
		<td data-name="SocialSecurityNo" <?php echo $_paye_view_list->SocialSecurityNo->cellAttributes() ?>>
<span id="el<?php echo $_paye_view_list->RowCount ?>__paye_view_SocialSecurityNo">
<span<?php echo $_paye_view_list->SocialSecurityNo->viewAttributes() ?>><?php echo $_paye_view_list->SocialSecurityNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_paye_view_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod" <?php echo $_paye_view_list->PayrollPeriod->cellAttributes() ?>>
<span id="el<?php echo $_paye_view_list->RowCount ?>__paye_view_PayrollPeriod">
<span<?php echo $_paye_view_list->PayrollPeriod->viewAttributes() ?>><?php echo $_paye_view_list->PayrollPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_paye_view_list->MonthShort->Visible) { // MonthShort ?>
		<td data-name="MonthShort" <?php echo $_paye_view_list->MonthShort->cellAttributes() ?>>
<span id="el<?php echo $_paye_view_list->RowCount ?>__paye_view_MonthShort">
<span<?php echo $_paye_view_list->MonthShort->viewAttributes() ?>><?php echo $_paye_view_list->MonthShort->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_paye_view_list->Year->Visible) { // Year ?>
		<td data-name="Year" <?php echo $_paye_view_list->Year->cellAttributes() ?>>
<span id="el<?php echo $_paye_view_list->RowCount ?>__paye_view_Year">
<span<?php echo $_paye_view_list->Year->viewAttributes() ?>><?php echo $_paye_view_list->Year->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_paye_view_list->TaxableIncome->Visible) { // TaxableIncome ?>
		<td data-name="TaxableIncome" <?php echo $_paye_view_list->TaxableIncome->cellAttributes() ?>>
<span id="el<?php echo $_paye_view_list->RowCount ?>__paye_view_TaxableIncome">
<span<?php echo $_paye_view_list->TaxableIncome->viewAttributes() ?>><?php echo $_paye_view_list->TaxableIncome->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_paye_view_list->GrossIncome->Visible) { // GrossIncome ?>
		<td data-name="GrossIncome" <?php echo $_paye_view_list->GrossIncome->cellAttributes() ?>>
<span id="el<?php echo $_paye_view_list->RowCount ?>__paye_view_GrossIncome">
<span<?php echo $_paye_view_list->GrossIncome->viewAttributes() ?>><?php echo $_paye_view_list->GrossIncome->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_paye_view_list->PAYE->Visible) { // PAYE ?>
		<td data-name="PAYE" <?php echo $_paye_view_list->PAYE->cellAttributes() ?>>
<span id="el<?php echo $_paye_view_list->RowCount ?>__paye_view_PAYE">
<span<?php echo $_paye_view_list->PAYE->viewAttributes() ?>><?php echo $_paye_view_list->PAYE->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_paye_view_list->EmploymentType->Visible) { // EmploymentType ?>
		<td data-name="EmploymentType" <?php echo $_paye_view_list->EmploymentType->cellAttributes() ?>>
<span id="el<?php echo $_paye_view_list->RowCount ?>__paye_view_EmploymentType">
<span<?php echo $_paye_view_list->EmploymentType->viewAttributes() ?>><?php echo $_paye_view_list->EmploymentType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$_paye_view_list->ListOptions->render("body", "right", $_paye_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$_paye_view_list->isGridAdd())
		$_paye_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$_paye_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($_paye_view_list->Recordset)
	$_paye_view_list->Recordset->Close();
?>
<?php if (!$_paye_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$_paye_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $_paye_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $_paye_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($_paye_view_list->TotalRecords == 0 && !$_paye_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $_paye_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$_paye_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$_paye_view_list->isExport()) { ?>
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
$_paye_view_list->terminate();
?>