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
$_monthly_payroll_summary_view_list = new _monthly_payroll_summary_view_list();

// Run the page
$_monthly_payroll_summary_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_monthly_payroll_summary_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$_monthly_payroll_summary_view_list->isExport()) { ?>
<script>
var f_monthly_payroll_summary_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	f_monthly_payroll_summary_viewlist = currentForm = new ew.Form("f_monthly_payroll_summary_viewlist", "list");
	f_monthly_payroll_summary_viewlist.formKeyCountName = '<?php echo $_monthly_payroll_summary_view_list->FormKeyCountName ?>';
	loadjs.done("f_monthly_payroll_summary_viewlist");
});
var f_monthly_payroll_summary_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	f_monthly_payroll_summary_viewlistsrch = currentSearchForm = new ew.Form("f_monthly_payroll_summary_viewlistsrch");

	// Dynamic selection lists
	// Filters

	f_monthly_payroll_summary_viewlistsrch.filterList = <?php echo $_monthly_payroll_summary_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	f_monthly_payroll_summary_viewlistsrch.initSearchPanel = true;
	loadjs.done("f_monthly_payroll_summary_viewlistsrch");
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
<?php if (!$_monthly_payroll_summary_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($_monthly_payroll_summary_view_list->TotalRecords > 0 && $_monthly_payroll_summary_view_list->ExportOptions->visible()) { ?>
<?php $_monthly_payroll_summary_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->ImportOptions->visible()) { ?>
<?php $_monthly_payroll_summary_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->SearchOptions->visible()) { ?>
<?php $_monthly_payroll_summary_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->FilterOptions->visible()) { ?>
<?php $_monthly_payroll_summary_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$_monthly_payroll_summary_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$_monthly_payroll_summary_view_list->isExport() && !$_monthly_payroll_summary_view->CurrentAction) { ?>
<form name="f_monthly_payroll_summary_viewlistsrch" id="f_monthly_payroll_summary_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="f_monthly_payroll_summary_viewlistsrch-search-panel" class="<?php echo $_monthly_payroll_summary_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="_monthly_payroll_summary_view">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $_monthly_payroll_summary_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($_monthly_payroll_summary_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($_monthly_payroll_summary_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $_monthly_payroll_summary_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($_monthly_payroll_summary_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($_monthly_payroll_summary_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($_monthly_payroll_summary_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($_monthly_payroll_summary_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $_monthly_payroll_summary_view_list->showPageHeader(); ?>
<?php
$_monthly_payroll_summary_view_list->showMessage();
?>
<?php if ($_monthly_payroll_summary_view_list->TotalRecords > 0 || $_monthly_payroll_summary_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($_monthly_payroll_summary_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> _monthly_payroll_summary_view">
<?php if (!$_monthly_payroll_summary_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$_monthly_payroll_summary_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $_monthly_payroll_summary_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $_monthly_payroll_summary_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="f_monthly_payroll_summary_viewlist" id="f_monthly_payroll_summary_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_monthly_payroll_summary_view">
<div id="gmp__monthly_payroll_summary_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($_monthly_payroll_summary_view_list->TotalRecords > 0 || $_monthly_payroll_summary_view_list->isGridEdit()) { ?>
<table id="tbl__monthly_payroll_summary_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$_monthly_payroll_summary_view->RowType = ROWTYPE_HEADER;

// Render list options
$_monthly_payroll_summary_view_list->renderListOptions();

// Render list options (header, left)
$_monthly_payroll_summary_view_list->ListOptions->render("header", "left");
?>
<?php if ($_monthly_payroll_summary_view_list->LocalAuthority->Visible) { // LocalAuthority ?>
	<?php if ($_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->LocalAuthority) == "") { ?>
		<th data-name="LocalAuthority" class="<?php echo $_monthly_payroll_summary_view_list->LocalAuthority->headerCellClass() ?>"><div id="elh__monthly_payroll_summary_view_LocalAuthority" class="_monthly_payroll_summary_view_LocalAuthority"><div class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->LocalAuthority->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LocalAuthority" class="<?php echo $_monthly_payroll_summary_view_list->LocalAuthority->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->LocalAuthority) ?>', 1);"><div id="elh__monthly_payroll_summary_view_LocalAuthority" class="_monthly_payroll_summary_view_LocalAuthority">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->LocalAuthority->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_monthly_payroll_summary_view_list->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_monthly_payroll_summary_view_list->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->DepartmentName->Visible) { // DepartmentName ?>
	<?php if ($_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->DepartmentName) == "") { ?>
		<th data-name="DepartmentName" class="<?php echo $_monthly_payroll_summary_view_list->DepartmentName->headerCellClass() ?>"><div id="elh__monthly_payroll_summary_view_DepartmentName" class="_monthly_payroll_summary_view_DepartmentName"><div class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->DepartmentName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentName" class="<?php echo $_monthly_payroll_summary_view_list->DepartmentName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->DepartmentName) ?>', 1);"><div id="elh__monthly_payroll_summary_view_DepartmentName" class="_monthly_payroll_summary_view_DepartmentName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->DepartmentName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_monthly_payroll_summary_view_list->DepartmentName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_monthly_payroll_summary_view_list->DepartmentName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->SectionName->Visible) { // SectionName ?>
	<?php if ($_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->SectionName) == "") { ?>
		<th data-name="SectionName" class="<?php echo $_monthly_payroll_summary_view_list->SectionName->headerCellClass() ?>"><div id="elh__monthly_payroll_summary_view_SectionName" class="_monthly_payroll_summary_view_SectionName"><div class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->SectionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionName" class="<?php echo $_monthly_payroll_summary_view_list->SectionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->SectionName) ?>', 1);"><div id="elh__monthly_payroll_summary_view_SectionName" class="_monthly_payroll_summary_view_SectionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->SectionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_monthly_payroll_summary_view_list->SectionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_monthly_payroll_summary_view_list->SectionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $_monthly_payroll_summary_view_list->EmployeeID->headerCellClass() ?>"><div id="elh__monthly_payroll_summary_view_EmployeeID" class="_monthly_payroll_summary_view_EmployeeID"><div class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $_monthly_payroll_summary_view_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->EmployeeID) ?>', 1);"><div id="elh__monthly_payroll_summary_view_EmployeeID" class="_monthly_payroll_summary_view_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($_monthly_payroll_summary_view_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_monthly_payroll_summary_view_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->Title->Visible) { // Title ?>
	<?php if ($_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->Title) == "") { ?>
		<th data-name="Title" class="<?php echo $_monthly_payroll_summary_view_list->Title->headerCellClass() ?>"><div id="elh__monthly_payroll_summary_view_Title" class="_monthly_payroll_summary_view_Title"><div class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->Title->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Title" class="<?php echo $_monthly_payroll_summary_view_list->Title->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->Title) ?>', 1);"><div id="elh__monthly_payroll_summary_view_Title" class="_monthly_payroll_summary_view_Title">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->Title->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_monthly_payroll_summary_view_list->Title->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_monthly_payroll_summary_view_list->Title->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->Surname->Visible) { // Surname ?>
	<?php if ($_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $_monthly_payroll_summary_view_list->Surname->headerCellClass() ?>"><div id="elh__monthly_payroll_summary_view_Surname" class="_monthly_payroll_summary_view_Surname"><div class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $_monthly_payroll_summary_view_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->Surname) ?>', 1);"><div id="elh__monthly_payroll_summary_view_Surname" class="_monthly_payroll_summary_view_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_monthly_payroll_summary_view_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_monthly_payroll_summary_view_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->FirstName->Visible) { // FirstName ?>
	<?php if ($_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $_monthly_payroll_summary_view_list->FirstName->headerCellClass() ?>"><div id="elh__monthly_payroll_summary_view_FirstName" class="_monthly_payroll_summary_view_FirstName"><div class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $_monthly_payroll_summary_view_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->FirstName) ?>', 1);"><div id="elh__monthly_payroll_summary_view_FirstName" class="_monthly_payroll_summary_view_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_monthly_payroll_summary_view_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_monthly_payroll_summary_view_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->MiddleName->Visible) { // MiddleName ?>
	<?php if ($_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $_monthly_payroll_summary_view_list->MiddleName->headerCellClass() ?>"><div id="elh__monthly_payroll_summary_view_MiddleName" class="_monthly_payroll_summary_view_MiddleName"><div class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $_monthly_payroll_summary_view_list->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->MiddleName) ?>', 1);"><div id="elh__monthly_payroll_summary_view_MiddleName" class="_monthly_payroll_summary_view_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->MiddleName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_monthly_payroll_summary_view_list->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_monthly_payroll_summary_view_list->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->Sex->Visible) { // Sex ?>
	<?php if ($_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->Sex) == "") { ?>
		<th data-name="Sex" class="<?php echo $_monthly_payroll_summary_view_list->Sex->headerCellClass() ?>"><div id="elh__monthly_payroll_summary_view_Sex" class="_monthly_payroll_summary_view_Sex"><div class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->Sex->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sex" class="<?php echo $_monthly_payroll_summary_view_list->Sex->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->Sex) ?>', 1);"><div id="elh__monthly_payroll_summary_view_Sex" class="_monthly_payroll_summary_view_Sex">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->Sex->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_monthly_payroll_summary_view_list->Sex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_monthly_payroll_summary_view_list->Sex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->NRC->Visible) { // NRC ?>
	<?php if ($_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->NRC) == "") { ?>
		<th data-name="NRC" class="<?php echo $_monthly_payroll_summary_view_list->NRC->headerCellClass() ?>"><div id="elh__monthly_payroll_summary_view_NRC" class="_monthly_payroll_summary_view_NRC"><div class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->NRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC" class="<?php echo $_monthly_payroll_summary_view_list->NRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->NRC) ?>', 1);"><div id="elh__monthly_payroll_summary_view_NRC" class="_monthly_payroll_summary_view_NRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->NRC->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_monthly_payroll_summary_view_list->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_monthly_payroll_summary_view_list->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->SalaryScale->Visible) { // SalaryScale ?>
	<?php if ($_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->SalaryScale) == "") { ?>
		<th data-name="SalaryScale" class="<?php echo $_monthly_payroll_summary_view_list->SalaryScale->headerCellClass() ?>"><div id="elh__monthly_payroll_summary_view_SalaryScale" class="_monthly_payroll_summary_view_SalaryScale"><div class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->SalaryScale->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SalaryScale" class="<?php echo $_monthly_payroll_summary_view_list->SalaryScale->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->SalaryScale) ?>', 1);"><div id="elh__monthly_payroll_summary_view_SalaryScale" class="_monthly_payroll_summary_view_SalaryScale">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->SalaryScale->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_monthly_payroll_summary_view_list->SalaryScale->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_monthly_payroll_summary_view_list->SalaryScale->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->Division->Visible) { // Division ?>
	<?php if ($_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->Division) == "") { ?>
		<th data-name="Division" class="<?php echo $_monthly_payroll_summary_view_list->Division->headerCellClass() ?>"><div id="elh__monthly_payroll_summary_view_Division" class="_monthly_payroll_summary_view_Division"><div class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->Division->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Division" class="<?php echo $_monthly_payroll_summary_view_list->Division->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->Division) ?>', 1);"><div id="elh__monthly_payroll_summary_view_Division" class="_monthly_payroll_summary_view_Division">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->Division->caption() ?></span><span class="ew-table-header-sort"><?php if ($_monthly_payroll_summary_view_list->Division->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_monthly_payroll_summary_view_list->Division->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->PositionName->Visible) { // PositionName ?>
	<?php if ($_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->PositionName) == "") { ?>
		<th data-name="PositionName" class="<?php echo $_monthly_payroll_summary_view_list->PositionName->headerCellClass() ?>"><div id="elh__monthly_payroll_summary_view_PositionName" class="_monthly_payroll_summary_view_PositionName"><div class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionName" class="<?php echo $_monthly_payroll_summary_view_list->PositionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->PositionName) ?>', 1);"><div id="elh__monthly_payroll_summary_view_PositionName" class="_monthly_payroll_summary_view_PositionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->PositionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_monthly_payroll_summary_view_list->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_monthly_payroll_summary_view_list->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->PaymentMethod->Visible) { // PaymentMethod ?>
	<?php if ($_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->PaymentMethod) == "") { ?>
		<th data-name="PaymentMethod" class="<?php echo $_monthly_payroll_summary_view_list->PaymentMethod->headerCellClass() ?>"><div id="elh__monthly_payroll_summary_view_PaymentMethod" class="_monthly_payroll_summary_view_PaymentMethod"><div class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->PaymentMethod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaymentMethod" class="<?php echo $_monthly_payroll_summary_view_list->PaymentMethod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->PaymentMethod) ?>', 1);"><div id="elh__monthly_payroll_summary_view_PaymentMethod" class="_monthly_payroll_summary_view_PaymentMethod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->PaymentMethod->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_monthly_payroll_summary_view_list->PaymentMethod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_monthly_payroll_summary_view_list->PaymentMethod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->BankBranchCode->Visible) { // BankBranchCode ?>
	<?php if ($_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->BankBranchCode) == "") { ?>
		<th data-name="BankBranchCode" class="<?php echo $_monthly_payroll_summary_view_list->BankBranchCode->headerCellClass() ?>"><div id="elh__monthly_payroll_summary_view_BankBranchCode" class="_monthly_payroll_summary_view_BankBranchCode"><div class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->BankBranchCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankBranchCode" class="<?php echo $_monthly_payroll_summary_view_list->BankBranchCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->BankBranchCode) ?>', 1);"><div id="elh__monthly_payroll_summary_view_BankBranchCode" class="_monthly_payroll_summary_view_BankBranchCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->BankBranchCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_monthly_payroll_summary_view_list->BankBranchCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_monthly_payroll_summary_view_list->BankBranchCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->BankAccountNo->Visible) { // BankAccountNo ?>
	<?php if ($_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->BankAccountNo) == "") { ?>
		<th data-name="BankAccountNo" class="<?php echo $_monthly_payroll_summary_view_list->BankAccountNo->headerCellClass() ?>"><div id="elh__monthly_payroll_summary_view_BankAccountNo" class="_monthly_payroll_summary_view_BankAccountNo"><div class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->BankAccountNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankAccountNo" class="<?php echo $_monthly_payroll_summary_view_list->BankAccountNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->BankAccountNo) ?>', 1);"><div id="elh__monthly_payroll_summary_view_BankAccountNo" class="_monthly_payroll_summary_view_BankAccountNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->BankAccountNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_monthly_payroll_summary_view_list->BankAccountNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_monthly_payroll_summary_view_list->BankAccountNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->PaidPosition->Visible) { // PaidPosition ?>
	<?php if ($_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->PaidPosition) == "") { ?>
		<th data-name="PaidPosition" class="<?php echo $_monthly_payroll_summary_view_list->PaidPosition->headerCellClass() ?>"><div id="elh__monthly_payroll_summary_view_PaidPosition" class="_monthly_payroll_summary_view_PaidPosition"><div class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->PaidPosition->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaidPosition" class="<?php echo $_monthly_payroll_summary_view_list->PaidPosition->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->PaidPosition) ?>', 1);"><div id="elh__monthly_payroll_summary_view_PaidPosition" class="_monthly_payroll_summary_view_PaidPosition">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->PaidPosition->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_monthly_payroll_summary_view_list->PaidPosition->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_monthly_payroll_summary_view_list->PaidPosition->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->PayrollPeriod) == "") { ?>
		<th data-name="PayrollPeriod" class="<?php echo $_monthly_payroll_summary_view_list->PayrollPeriod->headerCellClass() ?>"><div id="elh__monthly_payroll_summary_view_PayrollPeriod" class="_monthly_payroll_summary_view_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollPeriod" class="<?php echo $_monthly_payroll_summary_view_list->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->PayrollPeriod) ?>', 1);"><div id="elh__monthly_payroll_summary_view_PayrollPeriod" class="_monthly_payroll_summary_view_PayrollPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($_monthly_payroll_summary_view_list->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_monthly_payroll_summary_view_list->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->AmtType->Visible) { // AmtType ?>
	<?php if ($_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->AmtType) == "") { ?>
		<th data-name="AmtType" class="<?php echo $_monthly_payroll_summary_view_list->AmtType->headerCellClass() ?>"><div id="elh__monthly_payroll_summary_view_AmtType" class="_monthly_payroll_summary_view_AmtType"><div class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->AmtType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmtType" class="<?php echo $_monthly_payroll_summary_view_list->AmtType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->AmtType) ?>', 1);"><div id="elh__monthly_payroll_summary_view_AmtType" class="_monthly_payroll_summary_view_AmtType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->AmtType->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_monthly_payroll_summary_view_list->AmtType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_monthly_payroll_summary_view_list->AmtType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->PCode->Visible) { // PCode ?>
	<?php if ($_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->PCode) == "") { ?>
		<th data-name="PCode" class="<?php echo $_monthly_payroll_summary_view_list->PCode->headerCellClass() ?>"><div id="elh__monthly_payroll_summary_view_PCode" class="_monthly_payroll_summary_view_PCode"><div class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->PCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCode" class="<?php echo $_monthly_payroll_summary_view_list->PCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->PCode) ?>', 1);"><div id="elh__monthly_payroll_summary_view_PCode" class="_monthly_payroll_summary_view_PCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->PCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_monthly_payroll_summary_view_list->PCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_monthly_payroll_summary_view_list->PCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->Amount->Visible) { // Amount ?>
	<?php if ($_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->Amount) == "") { ?>
		<th data-name="Amount" class="<?php echo $_monthly_payroll_summary_view_list->Amount->headerCellClass() ?>"><div id="elh__monthly_payroll_summary_view_Amount" class="_monthly_payroll_summary_view_Amount"><div class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->Amount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Amount" class="<?php echo $_monthly_payroll_summary_view_list->Amount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->Amount) ?>', 1);"><div id="elh__monthly_payroll_summary_view_Amount" class="_monthly_payroll_summary_view_Amount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->Amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($_monthly_payroll_summary_view_list->Amount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_monthly_payroll_summary_view_list->Amount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->Period->Visible) { // Period ?>
	<?php if ($_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->Period) == "") { ?>
		<th data-name="Period" class="<?php echo $_monthly_payroll_summary_view_list->Period->headerCellClass() ?>"><div id="elh__monthly_payroll_summary_view_Period" class="_monthly_payroll_summary_view_Period"><div class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->Period->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Period" class="<?php echo $_monthly_payroll_summary_view_list->Period->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->Period) ?>', 1);"><div id="elh__monthly_payroll_summary_view_Period" class="_monthly_payroll_summary_view_Period">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->Period->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_monthly_payroll_summary_view_list->Period->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_monthly_payroll_summary_view_list->Period->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->PayCode->Visible) { // PayCode ?>
	<?php if ($_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->PayCode) == "") { ?>
		<th data-name="PayCode" class="<?php echo $_monthly_payroll_summary_view_list->PayCode->headerCellClass() ?>"><div id="elh__monthly_payroll_summary_view_PayCode" class="_monthly_payroll_summary_view_PayCode"><div class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->PayCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayCode" class="<?php echo $_monthly_payroll_summary_view_list->PayCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_monthly_payroll_summary_view_list->SortUrl($_monthly_payroll_summary_view_list->PayCode) ?>', 1);"><div id="elh__monthly_payroll_summary_view_PayCode" class="_monthly_payroll_summary_view_PayCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_monthly_payroll_summary_view_list->PayCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_monthly_payroll_summary_view_list->PayCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_monthly_payroll_summary_view_list->PayCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$_monthly_payroll_summary_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($_monthly_payroll_summary_view_list->ExportAll && $_monthly_payroll_summary_view_list->isExport()) {
	$_monthly_payroll_summary_view_list->StopRecord = $_monthly_payroll_summary_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($_monthly_payroll_summary_view_list->TotalRecords > $_monthly_payroll_summary_view_list->StartRecord + $_monthly_payroll_summary_view_list->DisplayRecords - 1)
		$_monthly_payroll_summary_view_list->StopRecord = $_monthly_payroll_summary_view_list->StartRecord + $_monthly_payroll_summary_view_list->DisplayRecords - 1;
	else
		$_monthly_payroll_summary_view_list->StopRecord = $_monthly_payroll_summary_view_list->TotalRecords;
}
$_monthly_payroll_summary_view_list->RecordCount = $_monthly_payroll_summary_view_list->StartRecord - 1;
if ($_monthly_payroll_summary_view_list->Recordset && !$_monthly_payroll_summary_view_list->Recordset->EOF) {
	$_monthly_payroll_summary_view_list->Recordset->moveFirst();
	$selectLimit = $_monthly_payroll_summary_view_list->UseSelectLimit;
	if (!$selectLimit && $_monthly_payroll_summary_view_list->StartRecord > 1)
		$_monthly_payroll_summary_view_list->Recordset->move($_monthly_payroll_summary_view_list->StartRecord - 1);
} elseif (!$_monthly_payroll_summary_view->AllowAddDeleteRow && $_monthly_payroll_summary_view_list->StopRecord == 0) {
	$_monthly_payroll_summary_view_list->StopRecord = $_monthly_payroll_summary_view->GridAddRowCount;
}

// Initialize aggregate
$_monthly_payroll_summary_view->RowType = ROWTYPE_AGGREGATEINIT;
$_monthly_payroll_summary_view->resetAttributes();
$_monthly_payroll_summary_view_list->renderRow();
while ($_monthly_payroll_summary_view_list->RecordCount < $_monthly_payroll_summary_view_list->StopRecord) {
	$_monthly_payroll_summary_view_list->RecordCount++;
	if ($_monthly_payroll_summary_view_list->RecordCount >= $_monthly_payroll_summary_view_list->StartRecord) {
		$_monthly_payroll_summary_view_list->RowCount++;

		// Set up key count
		$_monthly_payroll_summary_view_list->KeyCount = $_monthly_payroll_summary_view_list->RowIndex;

		// Init row class and style
		$_monthly_payroll_summary_view->resetAttributes();
		$_monthly_payroll_summary_view->CssClass = "";
		if ($_monthly_payroll_summary_view_list->isGridAdd()) {
		} else {
			$_monthly_payroll_summary_view_list->loadRowValues($_monthly_payroll_summary_view_list->Recordset); // Load row values
		}
		$_monthly_payroll_summary_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$_monthly_payroll_summary_view->RowAttrs->merge(["data-rowindex" => $_monthly_payroll_summary_view_list->RowCount, "id" => "r" . $_monthly_payroll_summary_view_list->RowCount . "__monthly_payroll_summary_view", "data-rowtype" => $_monthly_payroll_summary_view->RowType]);

		// Render row
		$_monthly_payroll_summary_view_list->renderRow();

		// Render list options
		$_monthly_payroll_summary_view_list->renderListOptions();
?>
	<tr <?php echo $_monthly_payroll_summary_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$_monthly_payroll_summary_view_list->ListOptions->render("body", "left", $_monthly_payroll_summary_view_list->RowCount);
?>
	<?php if ($_monthly_payroll_summary_view_list->LocalAuthority->Visible) { // LocalAuthority ?>
		<td data-name="LocalAuthority" <?php echo $_monthly_payroll_summary_view_list->LocalAuthority->cellAttributes() ?>>
<span id="el<?php echo $_monthly_payroll_summary_view_list->RowCount ?>__monthly_payroll_summary_view_LocalAuthority">
<span<?php echo $_monthly_payroll_summary_view_list->LocalAuthority->viewAttributes() ?>><?php echo $_monthly_payroll_summary_view_list->LocalAuthority->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_monthly_payroll_summary_view_list->DepartmentName->Visible) { // DepartmentName ?>
		<td data-name="DepartmentName" <?php echo $_monthly_payroll_summary_view_list->DepartmentName->cellAttributes() ?>>
<span id="el<?php echo $_monthly_payroll_summary_view_list->RowCount ?>__monthly_payroll_summary_view_DepartmentName">
<span<?php echo $_monthly_payroll_summary_view_list->DepartmentName->viewAttributes() ?>><?php echo $_monthly_payroll_summary_view_list->DepartmentName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_monthly_payroll_summary_view_list->SectionName->Visible) { // SectionName ?>
		<td data-name="SectionName" <?php echo $_monthly_payroll_summary_view_list->SectionName->cellAttributes() ?>>
<span id="el<?php echo $_monthly_payroll_summary_view_list->RowCount ?>__monthly_payroll_summary_view_SectionName">
<span<?php echo $_monthly_payroll_summary_view_list->SectionName->viewAttributes() ?>><?php echo $_monthly_payroll_summary_view_list->SectionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_monthly_payroll_summary_view_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $_monthly_payroll_summary_view_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $_monthly_payroll_summary_view_list->RowCount ?>__monthly_payroll_summary_view_EmployeeID">
<span<?php echo $_monthly_payroll_summary_view_list->EmployeeID->viewAttributes() ?>><?php echo $_monthly_payroll_summary_view_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_monthly_payroll_summary_view_list->Title->Visible) { // Title ?>
		<td data-name="Title" <?php echo $_monthly_payroll_summary_view_list->Title->cellAttributes() ?>>
<span id="el<?php echo $_monthly_payroll_summary_view_list->RowCount ?>__monthly_payroll_summary_view_Title">
<span<?php echo $_monthly_payroll_summary_view_list->Title->viewAttributes() ?>><?php echo $_monthly_payroll_summary_view_list->Title->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_monthly_payroll_summary_view_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $_monthly_payroll_summary_view_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $_monthly_payroll_summary_view_list->RowCount ?>__monthly_payroll_summary_view_Surname">
<span<?php echo $_monthly_payroll_summary_view_list->Surname->viewAttributes() ?>><?php echo $_monthly_payroll_summary_view_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_monthly_payroll_summary_view_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $_monthly_payroll_summary_view_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $_monthly_payroll_summary_view_list->RowCount ?>__monthly_payroll_summary_view_FirstName">
<span<?php echo $_monthly_payroll_summary_view_list->FirstName->viewAttributes() ?>><?php echo $_monthly_payroll_summary_view_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_monthly_payroll_summary_view_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $_monthly_payroll_summary_view_list->MiddleName->cellAttributes() ?>>
<span id="el<?php echo $_monthly_payroll_summary_view_list->RowCount ?>__monthly_payroll_summary_view_MiddleName">
<span<?php echo $_monthly_payroll_summary_view_list->MiddleName->viewAttributes() ?>><?php echo $_monthly_payroll_summary_view_list->MiddleName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_monthly_payroll_summary_view_list->Sex->Visible) { // Sex ?>
		<td data-name="Sex" <?php echo $_monthly_payroll_summary_view_list->Sex->cellAttributes() ?>>
<span id="el<?php echo $_monthly_payroll_summary_view_list->RowCount ?>__monthly_payroll_summary_view_Sex">
<span<?php echo $_monthly_payroll_summary_view_list->Sex->viewAttributes() ?>><?php echo $_monthly_payroll_summary_view_list->Sex->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_monthly_payroll_summary_view_list->NRC->Visible) { // NRC ?>
		<td data-name="NRC" <?php echo $_monthly_payroll_summary_view_list->NRC->cellAttributes() ?>>
<span id="el<?php echo $_monthly_payroll_summary_view_list->RowCount ?>__monthly_payroll_summary_view_NRC">
<span<?php echo $_monthly_payroll_summary_view_list->NRC->viewAttributes() ?>><?php echo $_monthly_payroll_summary_view_list->NRC->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_monthly_payroll_summary_view_list->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale" <?php echo $_monthly_payroll_summary_view_list->SalaryScale->cellAttributes() ?>>
<span id="el<?php echo $_monthly_payroll_summary_view_list->RowCount ?>__monthly_payroll_summary_view_SalaryScale">
<span<?php echo $_monthly_payroll_summary_view_list->SalaryScale->viewAttributes() ?>><?php echo $_monthly_payroll_summary_view_list->SalaryScale->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_monthly_payroll_summary_view_list->Division->Visible) { // Division ?>
		<td data-name="Division" <?php echo $_monthly_payroll_summary_view_list->Division->cellAttributes() ?>>
<span id="el<?php echo $_monthly_payroll_summary_view_list->RowCount ?>__monthly_payroll_summary_view_Division">
<span<?php echo $_monthly_payroll_summary_view_list->Division->viewAttributes() ?>><?php echo $_monthly_payroll_summary_view_list->Division->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_monthly_payroll_summary_view_list->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName" <?php echo $_monthly_payroll_summary_view_list->PositionName->cellAttributes() ?>>
<span id="el<?php echo $_monthly_payroll_summary_view_list->RowCount ?>__monthly_payroll_summary_view_PositionName">
<span<?php echo $_monthly_payroll_summary_view_list->PositionName->viewAttributes() ?>><?php echo $_monthly_payroll_summary_view_list->PositionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_monthly_payroll_summary_view_list->PaymentMethod->Visible) { // PaymentMethod ?>
		<td data-name="PaymentMethod" <?php echo $_monthly_payroll_summary_view_list->PaymentMethod->cellAttributes() ?>>
<span id="el<?php echo $_monthly_payroll_summary_view_list->RowCount ?>__monthly_payroll_summary_view_PaymentMethod">
<span<?php echo $_monthly_payroll_summary_view_list->PaymentMethod->viewAttributes() ?>><?php echo $_monthly_payroll_summary_view_list->PaymentMethod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_monthly_payroll_summary_view_list->BankBranchCode->Visible) { // BankBranchCode ?>
		<td data-name="BankBranchCode" <?php echo $_monthly_payroll_summary_view_list->BankBranchCode->cellAttributes() ?>>
<span id="el<?php echo $_monthly_payroll_summary_view_list->RowCount ?>__monthly_payroll_summary_view_BankBranchCode">
<span<?php echo $_monthly_payroll_summary_view_list->BankBranchCode->viewAttributes() ?>><?php echo $_monthly_payroll_summary_view_list->BankBranchCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_monthly_payroll_summary_view_list->BankAccountNo->Visible) { // BankAccountNo ?>
		<td data-name="BankAccountNo" <?php echo $_monthly_payroll_summary_view_list->BankAccountNo->cellAttributes() ?>>
<span id="el<?php echo $_monthly_payroll_summary_view_list->RowCount ?>__monthly_payroll_summary_view_BankAccountNo">
<span<?php echo $_monthly_payroll_summary_view_list->BankAccountNo->viewAttributes() ?>><?php echo $_monthly_payroll_summary_view_list->BankAccountNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_monthly_payroll_summary_view_list->PaidPosition->Visible) { // PaidPosition ?>
		<td data-name="PaidPosition" <?php echo $_monthly_payroll_summary_view_list->PaidPosition->cellAttributes() ?>>
<span id="el<?php echo $_monthly_payroll_summary_view_list->RowCount ?>__monthly_payroll_summary_view_PaidPosition">
<span<?php echo $_monthly_payroll_summary_view_list->PaidPosition->viewAttributes() ?>><?php echo $_monthly_payroll_summary_view_list->PaidPosition->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_monthly_payroll_summary_view_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod" <?php echo $_monthly_payroll_summary_view_list->PayrollPeriod->cellAttributes() ?>>
<span id="el<?php echo $_monthly_payroll_summary_view_list->RowCount ?>__monthly_payroll_summary_view_PayrollPeriod">
<span<?php echo $_monthly_payroll_summary_view_list->PayrollPeriod->viewAttributes() ?>><?php echo $_monthly_payroll_summary_view_list->PayrollPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_monthly_payroll_summary_view_list->AmtType->Visible) { // AmtType ?>
		<td data-name="AmtType" <?php echo $_monthly_payroll_summary_view_list->AmtType->cellAttributes() ?>>
<span id="el<?php echo $_monthly_payroll_summary_view_list->RowCount ?>__monthly_payroll_summary_view_AmtType">
<span<?php echo $_monthly_payroll_summary_view_list->AmtType->viewAttributes() ?>><?php echo $_monthly_payroll_summary_view_list->AmtType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_monthly_payroll_summary_view_list->PCode->Visible) { // PCode ?>
		<td data-name="PCode" <?php echo $_monthly_payroll_summary_view_list->PCode->cellAttributes() ?>>
<span id="el<?php echo $_monthly_payroll_summary_view_list->RowCount ?>__monthly_payroll_summary_view_PCode">
<span<?php echo $_monthly_payroll_summary_view_list->PCode->viewAttributes() ?>><?php echo $_monthly_payroll_summary_view_list->PCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_monthly_payroll_summary_view_list->Amount->Visible) { // Amount ?>
		<td data-name="Amount" <?php echo $_monthly_payroll_summary_view_list->Amount->cellAttributes() ?>>
<span id="el<?php echo $_monthly_payroll_summary_view_list->RowCount ?>__monthly_payroll_summary_view_Amount">
<span<?php echo $_monthly_payroll_summary_view_list->Amount->viewAttributes() ?>><?php echo $_monthly_payroll_summary_view_list->Amount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_monthly_payroll_summary_view_list->Period->Visible) { // Period ?>
		<td data-name="Period" <?php echo $_monthly_payroll_summary_view_list->Period->cellAttributes() ?>>
<span id="el<?php echo $_monthly_payroll_summary_view_list->RowCount ?>__monthly_payroll_summary_view_Period">
<span<?php echo $_monthly_payroll_summary_view_list->Period->viewAttributes() ?>><?php echo $_monthly_payroll_summary_view_list->Period->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_monthly_payroll_summary_view_list->PayCode->Visible) { // PayCode ?>
		<td data-name="PayCode" <?php echo $_monthly_payroll_summary_view_list->PayCode->cellAttributes() ?>>
<span id="el<?php echo $_monthly_payroll_summary_view_list->RowCount ?>__monthly_payroll_summary_view_PayCode">
<span<?php echo $_monthly_payroll_summary_view_list->PayCode->viewAttributes() ?>><?php echo $_monthly_payroll_summary_view_list->PayCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$_monthly_payroll_summary_view_list->ListOptions->render("body", "right", $_monthly_payroll_summary_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$_monthly_payroll_summary_view_list->isGridAdd())
		$_monthly_payroll_summary_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$_monthly_payroll_summary_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($_monthly_payroll_summary_view_list->Recordset)
	$_monthly_payroll_summary_view_list->Recordset->Close();
?>
<?php if (!$_monthly_payroll_summary_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$_monthly_payroll_summary_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $_monthly_payroll_summary_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $_monthly_payroll_summary_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($_monthly_payroll_summary_view_list->TotalRecords == 0 && !$_monthly_payroll_summary_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $_monthly_payroll_summary_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$_monthly_payroll_summary_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$_monthly_payroll_summary_view_list->isExport()) { ?>
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
$_monthly_payroll_summary_view_list->terminate();
?>