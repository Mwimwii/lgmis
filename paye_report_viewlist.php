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
$paye_report_view_list = new paye_report_view_list();

// Run the page
$paye_report_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$paye_report_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$paye_report_view_list->isExport()) { ?>
<script>
var fpaye_report_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpaye_report_viewlist = currentForm = new ew.Form("fpaye_report_viewlist", "list");
	fpaye_report_viewlist.formKeyCountName = '<?php echo $paye_report_view_list->FormKeyCountName ?>';
	loadjs.done("fpaye_report_viewlist");
});
var fpaye_report_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpaye_report_viewlistsrch = currentSearchForm = new ew.Form("fpaye_report_viewlistsrch");

	// Dynamic selection lists
	// Filters

	fpaye_report_viewlistsrch.filterList = <?php echo $paye_report_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	fpaye_report_viewlistsrch.initSearchPanel = true;
	loadjs.done("fpaye_report_viewlistsrch");
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
<?php if (!$paye_report_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($paye_report_view_list->TotalRecords > 0 && $paye_report_view_list->ExportOptions->visible()) { ?>
<?php $paye_report_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($paye_report_view_list->ImportOptions->visible()) { ?>
<?php $paye_report_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($paye_report_view_list->SearchOptions->visible()) { ?>
<?php $paye_report_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($paye_report_view_list->FilterOptions->visible()) { ?>
<?php $paye_report_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$paye_report_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$paye_report_view_list->isExport() && !$paye_report_view->CurrentAction) { ?>
<form name="fpaye_report_viewlistsrch" id="fpaye_report_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpaye_report_viewlistsrch-search-panel" class="<?php echo $paye_report_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="paye_report_view">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $paye_report_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($paye_report_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($paye_report_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $paye_report_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($paye_report_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($paye_report_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($paye_report_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($paye_report_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $paye_report_view_list->showPageHeader(); ?>
<?php
$paye_report_view_list->showMessage();
?>
<?php if ($paye_report_view_list->TotalRecords > 0 || $paye_report_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($paye_report_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> paye_report_view">
<?php if (!$paye_report_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$paye_report_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $paye_report_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $paye_report_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpaye_report_viewlist" id="fpaye_report_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="paye_report_view">
<div id="gmp_paye_report_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($paye_report_view_list->TotalRecords > 0 || $paye_report_view_list->isGridEdit()) { ?>
<table id="tbl_paye_report_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$paye_report_view->RowType = ROWTYPE_HEADER;

// Render list options
$paye_report_view_list->renderListOptions();

// Render list options (header, left)
$paye_report_view_list->ListOptions->render("header", "left");
?>
<?php if ($paye_report_view_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($paye_report_view_list->SortUrl($paye_report_view_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $paye_report_view_list->EmployeeID->headerCellClass() ?>"><div id="elh_paye_report_view_EmployeeID" class="paye_report_view_EmployeeID"><div class="ew-table-header-caption"><?php echo $paye_report_view_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $paye_report_view_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_report_view_list->SortUrl($paye_report_view_list->EmployeeID) ?>', 1);"><div id="elh_paye_report_view_EmployeeID" class="paye_report_view_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_report_view_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_report_view_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_report_view_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_report_view_list->FirstName->Visible) { // FirstName ?>
	<?php if ($paye_report_view_list->SortUrl($paye_report_view_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $paye_report_view_list->FirstName->headerCellClass() ?>"><div id="elh_paye_report_view_FirstName" class="paye_report_view_FirstName"><div class="ew-table-header-caption"><?php echo $paye_report_view_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $paye_report_view_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_report_view_list->SortUrl($paye_report_view_list->FirstName) ?>', 1);"><div id="elh_paye_report_view_FirstName" class="paye_report_view_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_report_view_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_report_view_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_report_view_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_report_view_list->MiddleName->Visible) { // MiddleName ?>
	<?php if ($paye_report_view_list->SortUrl($paye_report_view_list->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $paye_report_view_list->MiddleName->headerCellClass() ?>"><div id="elh_paye_report_view_MiddleName" class="paye_report_view_MiddleName"><div class="ew-table-header-caption"><?php echo $paye_report_view_list->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $paye_report_view_list->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_report_view_list->SortUrl($paye_report_view_list->MiddleName) ?>', 1);"><div id="elh_paye_report_view_MiddleName" class="paye_report_view_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_report_view_list->MiddleName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_report_view_list->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_report_view_list->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_report_view_list->Surname->Visible) { // Surname ?>
	<?php if ($paye_report_view_list->SortUrl($paye_report_view_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $paye_report_view_list->Surname->headerCellClass() ?>"><div id="elh_paye_report_view_Surname" class="paye_report_view_Surname"><div class="ew-table-header-caption"><?php echo $paye_report_view_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $paye_report_view_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_report_view_list->SortUrl($paye_report_view_list->Surname) ?>', 1);"><div id="elh_paye_report_view_Surname" class="paye_report_view_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_report_view_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_report_view_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_report_view_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_report_view_list->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
	<?php if ($paye_report_view_list->SortUrl($paye_report_view_list->SocialSecurityNo) == "") { ?>
		<th data-name="SocialSecurityNo" class="<?php echo $paye_report_view_list->SocialSecurityNo->headerCellClass() ?>"><div id="elh_paye_report_view_SocialSecurityNo" class="paye_report_view_SocialSecurityNo"><div class="ew-table-header-caption"><?php echo $paye_report_view_list->SocialSecurityNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SocialSecurityNo" class="<?php echo $paye_report_view_list->SocialSecurityNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_report_view_list->SortUrl($paye_report_view_list->SocialSecurityNo) ?>', 1);"><div id="elh_paye_report_view_SocialSecurityNo" class="paye_report_view_SocialSecurityNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_report_view_list->SocialSecurityNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_report_view_list->SocialSecurityNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_report_view_list->SocialSecurityNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_report_view_list->RunDescription->Visible) { // RunDescription ?>
	<?php if ($paye_report_view_list->SortUrl($paye_report_view_list->RunDescription) == "") { ?>
		<th data-name="RunDescription" class="<?php echo $paye_report_view_list->RunDescription->headerCellClass() ?>"><div id="elh_paye_report_view_RunDescription" class="paye_report_view_RunDescription"><div class="ew-table-header-caption"><?php echo $paye_report_view_list->RunDescription->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RunDescription" class="<?php echo $paye_report_view_list->RunDescription->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_report_view_list->SortUrl($paye_report_view_list->RunDescription) ?>', 1);"><div id="elh_paye_report_view_RunDescription" class="paye_report_view_RunDescription">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_report_view_list->RunDescription->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_report_view_list->RunDescription->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_report_view_list->RunDescription->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_report_view_list->DeductionCode->Visible) { // DeductionCode ?>
	<?php if ($paye_report_view_list->SortUrl($paye_report_view_list->DeductionCode) == "") { ?>
		<th data-name="DeductionCode" class="<?php echo $paye_report_view_list->DeductionCode->headerCellClass() ?>"><div id="elh_paye_report_view_DeductionCode" class="paye_report_view_DeductionCode"><div class="ew-table-header-caption"><?php echo $paye_report_view_list->DeductionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionCode" class="<?php echo $paye_report_view_list->DeductionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_report_view_list->SortUrl($paye_report_view_list->DeductionCode) ?>', 1);"><div id="elh_paye_report_view_DeductionCode" class="paye_report_view_DeductionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_report_view_list->DeductionCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_report_view_list->DeductionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_report_view_list->DeductionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_report_view_list->DeductionName->Visible) { // DeductionName ?>
	<?php if ($paye_report_view_list->SortUrl($paye_report_view_list->DeductionName) == "") { ?>
		<th data-name="DeductionName" class="<?php echo $paye_report_view_list->DeductionName->headerCellClass() ?>"><div id="elh_paye_report_view_DeductionName" class="paye_report_view_DeductionName"><div class="ew-table-header-caption"><?php echo $paye_report_view_list->DeductionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionName" class="<?php echo $paye_report_view_list->DeductionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_report_view_list->SortUrl($paye_report_view_list->DeductionName) ?>', 1);"><div id="elh_paye_report_view_DeductionName" class="paye_report_view_DeductionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_report_view_list->DeductionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_report_view_list->DeductionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_report_view_list->DeductionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_report_view_list->DeductionAmount->Visible) { // DeductionAmount ?>
	<?php if ($paye_report_view_list->SortUrl($paye_report_view_list->DeductionAmount) == "") { ?>
		<th data-name="DeductionAmount" class="<?php echo $paye_report_view_list->DeductionAmount->headerCellClass() ?>"><div id="elh_paye_report_view_DeductionAmount" class="paye_report_view_DeductionAmount"><div class="ew-table-header-caption"><?php echo $paye_report_view_list->DeductionAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionAmount" class="<?php echo $paye_report_view_list->DeductionAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_report_view_list->SortUrl($paye_report_view_list->DeductionAmount) ?>', 1);"><div id="elh_paye_report_view_DeductionAmount" class="paye_report_view_DeductionAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_report_view_list->DeductionAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_report_view_list->DeductionAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_report_view_list->DeductionAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_report_view_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($paye_report_view_list->SortUrl($paye_report_view_list->PayrollPeriod) == "") { ?>
		<th data-name="PayrollPeriod" class="<?php echo $paye_report_view_list->PayrollPeriod->headerCellClass() ?>"><div id="elh_paye_report_view_PayrollPeriod" class="paye_report_view_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $paye_report_view_list->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollPeriod" class="<?php echo $paye_report_view_list->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_report_view_list->SortUrl($paye_report_view_list->PayrollPeriod) ?>', 1);"><div id="elh_paye_report_view_PayrollPeriod" class="paye_report_view_PayrollPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_report_view_list->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_report_view_list->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_report_view_list->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_report_view_list->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
	<?php if ($paye_report_view_list->SortUrl($paye_report_view_list->BasicMonthlySalary) == "") { ?>
		<th data-name="BasicMonthlySalary" class="<?php echo $paye_report_view_list->BasicMonthlySalary->headerCellClass() ?>"><div id="elh_paye_report_view_BasicMonthlySalary" class="paye_report_view_BasicMonthlySalary"><div class="ew-table-header-caption"><?php echo $paye_report_view_list->BasicMonthlySalary->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BasicMonthlySalary" class="<?php echo $paye_report_view_list->BasicMonthlySalary->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_report_view_list->SortUrl($paye_report_view_list->BasicMonthlySalary) ?>', 1);"><div id="elh_paye_report_view_BasicMonthlySalary" class="paye_report_view_BasicMonthlySalary">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_report_view_list->BasicMonthlySalary->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_report_view_list->BasicMonthlySalary->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_report_view_list->BasicMonthlySalary->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_report_view_list->NRC->Visible) { // NRC ?>
	<?php if ($paye_report_view_list->SortUrl($paye_report_view_list->NRC) == "") { ?>
		<th data-name="NRC" class="<?php echo $paye_report_view_list->NRC->headerCellClass() ?>"><div id="elh_paye_report_view_NRC" class="paye_report_view_NRC"><div class="ew-table-header-caption"><?php echo $paye_report_view_list->NRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC" class="<?php echo $paye_report_view_list->NRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_report_view_list->SortUrl($paye_report_view_list->NRC) ?>', 1);"><div id="elh_paye_report_view_NRC" class="paye_report_view_NRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_report_view_list->NRC->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_report_view_list->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_report_view_list->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_report_view_list->PositionName->Visible) { // PositionName ?>
	<?php if ($paye_report_view_list->SortUrl($paye_report_view_list->PositionName) == "") { ?>
		<th data-name="PositionName" class="<?php echo $paye_report_view_list->PositionName->headerCellClass() ?>"><div id="elh_paye_report_view_PositionName" class="paye_report_view_PositionName"><div class="ew-table-header-caption"><?php echo $paye_report_view_list->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionName" class="<?php echo $paye_report_view_list->PositionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_report_view_list->SortUrl($paye_report_view_list->PositionName) ?>', 1);"><div id="elh_paye_report_view_PositionName" class="paye_report_view_PositionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_report_view_list->PositionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_report_view_list->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_report_view_list->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_report_view_list->EmploymentTypeDesc->Visible) { // EmploymentTypeDesc ?>
	<?php if ($paye_report_view_list->SortUrl($paye_report_view_list->EmploymentTypeDesc) == "") { ?>
		<th data-name="EmploymentTypeDesc" class="<?php echo $paye_report_view_list->EmploymentTypeDesc->headerCellClass() ?>"><div id="elh_paye_report_view_EmploymentTypeDesc" class="paye_report_view_EmploymentTypeDesc"><div class="ew-table-header-caption"><?php echo $paye_report_view_list->EmploymentTypeDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmploymentTypeDesc" class="<?php echo $paye_report_view_list->EmploymentTypeDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_report_view_list->SortUrl($paye_report_view_list->EmploymentTypeDesc) ?>', 1);"><div id="elh_paye_report_view_EmploymentTypeDesc" class="paye_report_view_EmploymentTypeDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_report_view_list->EmploymentTypeDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_report_view_list->EmploymentTypeDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_report_view_list->EmploymentTypeDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$paye_report_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($paye_report_view_list->ExportAll && $paye_report_view_list->isExport()) {
	$paye_report_view_list->StopRecord = $paye_report_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($paye_report_view_list->TotalRecords > $paye_report_view_list->StartRecord + $paye_report_view_list->DisplayRecords - 1)
		$paye_report_view_list->StopRecord = $paye_report_view_list->StartRecord + $paye_report_view_list->DisplayRecords - 1;
	else
		$paye_report_view_list->StopRecord = $paye_report_view_list->TotalRecords;
}
$paye_report_view_list->RecordCount = $paye_report_view_list->StartRecord - 1;
if ($paye_report_view_list->Recordset && !$paye_report_view_list->Recordset->EOF) {
	$paye_report_view_list->Recordset->moveFirst();
	$selectLimit = $paye_report_view_list->UseSelectLimit;
	if (!$selectLimit && $paye_report_view_list->StartRecord > 1)
		$paye_report_view_list->Recordset->move($paye_report_view_list->StartRecord - 1);
} elseif (!$paye_report_view->AllowAddDeleteRow && $paye_report_view_list->StopRecord == 0) {
	$paye_report_view_list->StopRecord = $paye_report_view->GridAddRowCount;
}

// Initialize aggregate
$paye_report_view->RowType = ROWTYPE_AGGREGATEINIT;
$paye_report_view->resetAttributes();
$paye_report_view_list->renderRow();
while ($paye_report_view_list->RecordCount < $paye_report_view_list->StopRecord) {
	$paye_report_view_list->RecordCount++;
	if ($paye_report_view_list->RecordCount >= $paye_report_view_list->StartRecord) {
		$paye_report_view_list->RowCount++;

		// Set up key count
		$paye_report_view_list->KeyCount = $paye_report_view_list->RowIndex;

		// Init row class and style
		$paye_report_view->resetAttributes();
		$paye_report_view->CssClass = "";
		if ($paye_report_view_list->isGridAdd()) {
		} else {
			$paye_report_view_list->loadRowValues($paye_report_view_list->Recordset); // Load row values
		}
		$paye_report_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$paye_report_view->RowAttrs->merge(["data-rowindex" => $paye_report_view_list->RowCount, "id" => "r" . $paye_report_view_list->RowCount . "_paye_report_view", "data-rowtype" => $paye_report_view->RowType]);

		// Render row
		$paye_report_view_list->renderRow();

		// Render list options
		$paye_report_view_list->renderListOptions();
?>
	<tr <?php echo $paye_report_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$paye_report_view_list->ListOptions->render("body", "left", $paye_report_view_list->RowCount);
?>
	<?php if ($paye_report_view_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $paye_report_view_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $paye_report_view_list->RowCount ?>_paye_report_view_EmployeeID">
<span<?php echo $paye_report_view_list->EmployeeID->viewAttributes() ?>><?php echo $paye_report_view_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_report_view_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $paye_report_view_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $paye_report_view_list->RowCount ?>_paye_report_view_FirstName">
<span<?php echo $paye_report_view_list->FirstName->viewAttributes() ?>><?php echo $paye_report_view_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_report_view_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $paye_report_view_list->MiddleName->cellAttributes() ?>>
<span id="el<?php echo $paye_report_view_list->RowCount ?>_paye_report_view_MiddleName">
<span<?php echo $paye_report_view_list->MiddleName->viewAttributes() ?>><?php echo $paye_report_view_list->MiddleName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_report_view_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $paye_report_view_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $paye_report_view_list->RowCount ?>_paye_report_view_Surname">
<span<?php echo $paye_report_view_list->Surname->viewAttributes() ?>><?php echo $paye_report_view_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_report_view_list->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
		<td data-name="SocialSecurityNo" <?php echo $paye_report_view_list->SocialSecurityNo->cellAttributes() ?>>
<span id="el<?php echo $paye_report_view_list->RowCount ?>_paye_report_view_SocialSecurityNo">
<span<?php echo $paye_report_view_list->SocialSecurityNo->viewAttributes() ?>><?php echo $paye_report_view_list->SocialSecurityNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_report_view_list->RunDescription->Visible) { // RunDescription ?>
		<td data-name="RunDescription" <?php echo $paye_report_view_list->RunDescription->cellAttributes() ?>>
<span id="el<?php echo $paye_report_view_list->RowCount ?>_paye_report_view_RunDescription">
<span<?php echo $paye_report_view_list->RunDescription->viewAttributes() ?>><?php echo $paye_report_view_list->RunDescription->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_report_view_list->DeductionCode->Visible) { // DeductionCode ?>
		<td data-name="DeductionCode" <?php echo $paye_report_view_list->DeductionCode->cellAttributes() ?>>
<span id="el<?php echo $paye_report_view_list->RowCount ?>_paye_report_view_DeductionCode">
<span<?php echo $paye_report_view_list->DeductionCode->viewAttributes() ?>><?php echo $paye_report_view_list->DeductionCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_report_view_list->DeductionName->Visible) { // DeductionName ?>
		<td data-name="DeductionName" <?php echo $paye_report_view_list->DeductionName->cellAttributes() ?>>
<span id="el<?php echo $paye_report_view_list->RowCount ?>_paye_report_view_DeductionName">
<span<?php echo $paye_report_view_list->DeductionName->viewAttributes() ?>><?php echo $paye_report_view_list->DeductionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_report_view_list->DeductionAmount->Visible) { // DeductionAmount ?>
		<td data-name="DeductionAmount" <?php echo $paye_report_view_list->DeductionAmount->cellAttributes() ?>>
<span id="el<?php echo $paye_report_view_list->RowCount ?>_paye_report_view_DeductionAmount">
<span<?php echo $paye_report_view_list->DeductionAmount->viewAttributes() ?>><?php echo $paye_report_view_list->DeductionAmount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_report_view_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod" <?php echo $paye_report_view_list->PayrollPeriod->cellAttributes() ?>>
<span id="el<?php echo $paye_report_view_list->RowCount ?>_paye_report_view_PayrollPeriod">
<span<?php echo $paye_report_view_list->PayrollPeriod->viewAttributes() ?>><?php echo $paye_report_view_list->PayrollPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_report_view_list->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
		<td data-name="BasicMonthlySalary" <?php echo $paye_report_view_list->BasicMonthlySalary->cellAttributes() ?>>
<span id="el<?php echo $paye_report_view_list->RowCount ?>_paye_report_view_BasicMonthlySalary">
<span<?php echo $paye_report_view_list->BasicMonthlySalary->viewAttributes() ?>><?php echo $paye_report_view_list->BasicMonthlySalary->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_report_view_list->NRC->Visible) { // NRC ?>
		<td data-name="NRC" <?php echo $paye_report_view_list->NRC->cellAttributes() ?>>
<span id="el<?php echo $paye_report_view_list->RowCount ?>_paye_report_view_NRC">
<span<?php echo $paye_report_view_list->NRC->viewAttributes() ?>><?php echo $paye_report_view_list->NRC->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_report_view_list->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName" <?php echo $paye_report_view_list->PositionName->cellAttributes() ?>>
<span id="el<?php echo $paye_report_view_list->RowCount ?>_paye_report_view_PositionName">
<span<?php echo $paye_report_view_list->PositionName->viewAttributes() ?>><?php echo $paye_report_view_list->PositionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_report_view_list->EmploymentTypeDesc->Visible) { // EmploymentTypeDesc ?>
		<td data-name="EmploymentTypeDesc" <?php echo $paye_report_view_list->EmploymentTypeDesc->cellAttributes() ?>>
<span id="el<?php echo $paye_report_view_list->RowCount ?>_paye_report_view_EmploymentTypeDesc">
<span<?php echo $paye_report_view_list->EmploymentTypeDesc->viewAttributes() ?>><?php echo $paye_report_view_list->EmploymentTypeDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$paye_report_view_list->ListOptions->render("body", "right", $paye_report_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$paye_report_view_list->isGridAdd())
		$paye_report_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$paye_report_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($paye_report_view_list->Recordset)
	$paye_report_view_list->Recordset->Close();
?>
<?php if (!$paye_report_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$paye_report_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $paye_report_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $paye_report_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($paye_report_view_list->TotalRecords == 0 && !$paye_report_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $paye_report_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$paye_report_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$paye_report_view_list->isExport()) { ?>
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
$paye_report_view_list->terminate();
?>