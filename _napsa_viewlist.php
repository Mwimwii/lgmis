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
$_napsa_view_list = new _napsa_view_list();

// Run the page
$_napsa_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_napsa_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$_napsa_view_list->isExport()) { ?>
<script>
var f_napsa_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	f_napsa_viewlist = currentForm = new ew.Form("f_napsa_viewlist", "list");
	f_napsa_viewlist.formKeyCountName = '<?php echo $_napsa_view_list->FormKeyCountName ?>';
	loadjs.done("f_napsa_viewlist");
});
var f_napsa_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	f_napsa_viewlistsrch = currentSearchForm = new ew.Form("f_napsa_viewlistsrch");

	// Dynamic selection lists
	// Filters

	f_napsa_viewlistsrch.filterList = <?php echo $_napsa_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	f_napsa_viewlistsrch.initSearchPanel = true;
	loadjs.done("f_napsa_viewlistsrch");
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
<?php if (!$_napsa_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($_napsa_view_list->TotalRecords > 0 && $_napsa_view_list->ExportOptions->visible()) { ?>
<?php $_napsa_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($_napsa_view_list->ImportOptions->visible()) { ?>
<?php $_napsa_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($_napsa_view_list->SearchOptions->visible()) { ?>
<?php $_napsa_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($_napsa_view_list->FilterOptions->visible()) { ?>
<?php $_napsa_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$_napsa_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$_napsa_view_list->isExport() && !$_napsa_view->CurrentAction) { ?>
<form name="f_napsa_viewlistsrch" id="f_napsa_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="f_napsa_viewlistsrch-search-panel" class="<?php echo $_napsa_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="_napsa_view">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $_napsa_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($_napsa_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($_napsa_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $_napsa_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($_napsa_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($_napsa_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($_napsa_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($_napsa_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $_napsa_view_list->showPageHeader(); ?>
<?php
$_napsa_view_list->showMessage();
?>
<?php if ($_napsa_view_list->TotalRecords > 0 || $_napsa_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($_napsa_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> _napsa_view">
<?php if (!$_napsa_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$_napsa_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $_napsa_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $_napsa_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="f_napsa_viewlist" id="f_napsa_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_napsa_view">
<div id="gmp__napsa_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($_napsa_view_list->TotalRecords > 0 || $_napsa_view_list->isGridEdit()) { ?>
<table id="tbl__napsa_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$_napsa_view->RowType = ROWTYPE_HEADER;

// Render list options
$_napsa_view_list->renderListOptions();

// Render list options (header, left)
$_napsa_view_list->ListOptions->render("header", "left");
?>
<?php if ($_napsa_view_list->LocalAuthority->Visible) { // LocalAuthority ?>
	<?php if ($_napsa_view_list->SortUrl($_napsa_view_list->LocalAuthority) == "") { ?>
		<th data-name="LocalAuthority" class="<?php echo $_napsa_view_list->LocalAuthority->headerCellClass() ?>"><div id="elh__napsa_view_LocalAuthority" class="_napsa_view_LocalAuthority"><div class="ew-table-header-caption"><?php echo $_napsa_view_list->LocalAuthority->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LocalAuthority" class="<?php echo $_napsa_view_list->LocalAuthority->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_napsa_view_list->SortUrl($_napsa_view_list->LocalAuthority) ?>', 1);"><div id="elh__napsa_view_LocalAuthority" class="_napsa_view_LocalAuthority">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_napsa_view_list->LocalAuthority->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_napsa_view_list->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_napsa_view_list->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_napsa_view_list->DepartmentName->Visible) { // DepartmentName ?>
	<?php if ($_napsa_view_list->SortUrl($_napsa_view_list->DepartmentName) == "") { ?>
		<th data-name="DepartmentName" class="<?php echo $_napsa_view_list->DepartmentName->headerCellClass() ?>"><div id="elh__napsa_view_DepartmentName" class="_napsa_view_DepartmentName"><div class="ew-table-header-caption"><?php echo $_napsa_view_list->DepartmentName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentName" class="<?php echo $_napsa_view_list->DepartmentName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_napsa_view_list->SortUrl($_napsa_view_list->DepartmentName) ?>', 1);"><div id="elh__napsa_view_DepartmentName" class="_napsa_view_DepartmentName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_napsa_view_list->DepartmentName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_napsa_view_list->DepartmentName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_napsa_view_list->DepartmentName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_napsa_view_list->SectionName->Visible) { // SectionName ?>
	<?php if ($_napsa_view_list->SortUrl($_napsa_view_list->SectionName) == "") { ?>
		<th data-name="SectionName" class="<?php echo $_napsa_view_list->SectionName->headerCellClass() ?>"><div id="elh__napsa_view_SectionName" class="_napsa_view_SectionName"><div class="ew-table-header-caption"><?php echo $_napsa_view_list->SectionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionName" class="<?php echo $_napsa_view_list->SectionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_napsa_view_list->SortUrl($_napsa_view_list->SectionName) ?>', 1);"><div id="elh__napsa_view_SectionName" class="_napsa_view_SectionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_napsa_view_list->SectionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_napsa_view_list->SectionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_napsa_view_list->SectionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_napsa_view_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($_napsa_view_list->SortUrl($_napsa_view_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $_napsa_view_list->EmployeeID->headerCellClass() ?>"><div id="elh__napsa_view_EmployeeID" class="_napsa_view_EmployeeID"><div class="ew-table-header-caption"><?php echo $_napsa_view_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $_napsa_view_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_napsa_view_list->SortUrl($_napsa_view_list->EmployeeID) ?>', 1);"><div id="elh__napsa_view_EmployeeID" class="_napsa_view_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_napsa_view_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($_napsa_view_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_napsa_view_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_napsa_view_list->Surname->Visible) { // Surname ?>
	<?php if ($_napsa_view_list->SortUrl($_napsa_view_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $_napsa_view_list->Surname->headerCellClass() ?>"><div id="elh__napsa_view_Surname" class="_napsa_view_Surname"><div class="ew-table-header-caption"><?php echo $_napsa_view_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $_napsa_view_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_napsa_view_list->SortUrl($_napsa_view_list->Surname) ?>', 1);"><div id="elh__napsa_view_Surname" class="_napsa_view_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_napsa_view_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_napsa_view_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_napsa_view_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_napsa_view_list->FirstName->Visible) { // FirstName ?>
	<?php if ($_napsa_view_list->SortUrl($_napsa_view_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $_napsa_view_list->FirstName->headerCellClass() ?>"><div id="elh__napsa_view_FirstName" class="_napsa_view_FirstName"><div class="ew-table-header-caption"><?php echo $_napsa_view_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $_napsa_view_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_napsa_view_list->SortUrl($_napsa_view_list->FirstName) ?>', 1);"><div id="elh__napsa_view_FirstName" class="_napsa_view_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_napsa_view_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_napsa_view_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_napsa_view_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_napsa_view_list->MiddleName->Visible) { // MiddleName ?>
	<?php if ($_napsa_view_list->SortUrl($_napsa_view_list->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $_napsa_view_list->MiddleName->headerCellClass() ?>"><div id="elh__napsa_view_MiddleName" class="_napsa_view_MiddleName"><div class="ew-table-header-caption"><?php echo $_napsa_view_list->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $_napsa_view_list->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_napsa_view_list->SortUrl($_napsa_view_list->MiddleName) ?>', 1);"><div id="elh__napsa_view_MiddleName" class="_napsa_view_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_napsa_view_list->MiddleName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_napsa_view_list->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_napsa_view_list->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_napsa_view_list->NRC->Visible) { // NRC ?>
	<?php if ($_napsa_view_list->SortUrl($_napsa_view_list->NRC) == "") { ?>
		<th data-name="NRC" class="<?php echo $_napsa_view_list->NRC->headerCellClass() ?>"><div id="elh__napsa_view_NRC" class="_napsa_view_NRC"><div class="ew-table-header-caption"><?php echo $_napsa_view_list->NRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC" class="<?php echo $_napsa_view_list->NRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_napsa_view_list->SortUrl($_napsa_view_list->NRC) ?>', 1);"><div id="elh__napsa_view_NRC" class="_napsa_view_NRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_napsa_view_list->NRC->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_napsa_view_list->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_napsa_view_list->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_napsa_view_list->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
	<?php if ($_napsa_view_list->SortUrl($_napsa_view_list->SocialSecurityNo) == "") { ?>
		<th data-name="SocialSecurityNo" class="<?php echo $_napsa_view_list->SocialSecurityNo->headerCellClass() ?>"><div id="elh__napsa_view_SocialSecurityNo" class="_napsa_view_SocialSecurityNo"><div class="ew-table-header-caption"><?php echo $_napsa_view_list->SocialSecurityNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SocialSecurityNo" class="<?php echo $_napsa_view_list->SocialSecurityNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_napsa_view_list->SortUrl($_napsa_view_list->SocialSecurityNo) ?>', 1);"><div id="elh__napsa_view_SocialSecurityNo" class="_napsa_view_SocialSecurityNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_napsa_view_list->SocialSecurityNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_napsa_view_list->SocialSecurityNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_napsa_view_list->SocialSecurityNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_napsa_view_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($_napsa_view_list->SortUrl($_napsa_view_list->PayrollPeriod) == "") { ?>
		<th data-name="PayrollPeriod" class="<?php echo $_napsa_view_list->PayrollPeriod->headerCellClass() ?>"><div id="elh__napsa_view_PayrollPeriod" class="_napsa_view_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $_napsa_view_list->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollPeriod" class="<?php echo $_napsa_view_list->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_napsa_view_list->SortUrl($_napsa_view_list->PayrollPeriod) ?>', 1);"><div id="elh__napsa_view_PayrollPeriod" class="_napsa_view_PayrollPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_napsa_view_list->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($_napsa_view_list->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_napsa_view_list->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_napsa_view_list->MonthShort->Visible) { // MonthShort ?>
	<?php if ($_napsa_view_list->SortUrl($_napsa_view_list->MonthShort) == "") { ?>
		<th data-name="MonthShort" class="<?php echo $_napsa_view_list->MonthShort->headerCellClass() ?>"><div id="elh__napsa_view_MonthShort" class="_napsa_view_MonthShort"><div class="ew-table-header-caption"><?php echo $_napsa_view_list->MonthShort->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MonthShort" class="<?php echo $_napsa_view_list->MonthShort->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_napsa_view_list->SortUrl($_napsa_view_list->MonthShort) ?>', 1);"><div id="elh__napsa_view_MonthShort" class="_napsa_view_MonthShort">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_napsa_view_list->MonthShort->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_napsa_view_list->MonthShort->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_napsa_view_list->MonthShort->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_napsa_view_list->Year->Visible) { // Year ?>
	<?php if ($_napsa_view_list->SortUrl($_napsa_view_list->Year) == "") { ?>
		<th data-name="Year" class="<?php echo $_napsa_view_list->Year->headerCellClass() ?>"><div id="elh__napsa_view_Year" class="_napsa_view_Year"><div class="ew-table-header-caption"><?php echo $_napsa_view_list->Year->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Year" class="<?php echo $_napsa_view_list->Year->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_napsa_view_list->SortUrl($_napsa_view_list->Year) ?>', 1);"><div id="elh__napsa_view_Year" class="_napsa_view_Year">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_napsa_view_list->Year->caption() ?></span><span class="ew-table-header-sort"><?php if ($_napsa_view_list->Year->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_napsa_view_list->Year->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_napsa_view_list->pName->Visible) { // pName ?>
	<?php if ($_napsa_view_list->SortUrl($_napsa_view_list->pName) == "") { ?>
		<th data-name="pName" class="<?php echo $_napsa_view_list->pName->headerCellClass() ?>"><div id="elh__napsa_view_pName" class="_napsa_view_pName"><div class="ew-table-header-caption"><?php echo $_napsa_view_list->pName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pName" class="<?php echo $_napsa_view_list->pName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_napsa_view_list->SortUrl($_napsa_view_list->pName) ?>', 1);"><div id="elh__napsa_view_pName" class="_napsa_view_pName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_napsa_view_list->pName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_napsa_view_list->pName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_napsa_view_list->pName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_napsa_view_list->GrossPay->Visible) { // GrossPay ?>
	<?php if ($_napsa_view_list->SortUrl($_napsa_view_list->GrossPay) == "") { ?>
		<th data-name="GrossPay" class="<?php echo $_napsa_view_list->GrossPay->headerCellClass() ?>"><div id="elh__napsa_view_GrossPay" class="_napsa_view_GrossPay"><div class="ew-table-header-caption"><?php echo $_napsa_view_list->GrossPay->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="GrossPay" class="<?php echo $_napsa_view_list->GrossPay->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_napsa_view_list->SortUrl($_napsa_view_list->GrossPay) ?>', 1);"><div id="elh__napsa_view_GrossPay" class="_napsa_view_GrossPay">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_napsa_view_list->GrossPay->caption() ?></span><span class="ew-table-header-sort"><?php if ($_napsa_view_list->GrossPay->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_napsa_view_list->GrossPay->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_napsa_view_list->EmployeeContribution->Visible) { // EmployeeContribution ?>
	<?php if ($_napsa_view_list->SortUrl($_napsa_view_list->EmployeeContribution) == "") { ?>
		<th data-name="EmployeeContribution" class="<?php echo $_napsa_view_list->EmployeeContribution->headerCellClass() ?>"><div id="elh__napsa_view_EmployeeContribution" class="_napsa_view_EmployeeContribution"><div class="ew-table-header-caption"><?php echo $_napsa_view_list->EmployeeContribution->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeContribution" class="<?php echo $_napsa_view_list->EmployeeContribution->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_napsa_view_list->SortUrl($_napsa_view_list->EmployeeContribution) ?>', 1);"><div id="elh__napsa_view_EmployeeContribution" class="_napsa_view_EmployeeContribution">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_napsa_view_list->EmployeeContribution->caption() ?></span><span class="ew-table-header-sort"><?php if ($_napsa_view_list->EmployeeContribution->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_napsa_view_list->EmployeeContribution->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_napsa_view_list->EmployerContribution->Visible) { // EmployerContribution ?>
	<?php if ($_napsa_view_list->SortUrl($_napsa_view_list->EmployerContribution) == "") { ?>
		<th data-name="EmployerContribution" class="<?php echo $_napsa_view_list->EmployerContribution->headerCellClass() ?>"><div id="elh__napsa_view_EmployerContribution" class="_napsa_view_EmployerContribution"><div class="ew-table-header-caption"><?php echo $_napsa_view_list->EmployerContribution->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployerContribution" class="<?php echo $_napsa_view_list->EmployerContribution->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_napsa_view_list->SortUrl($_napsa_view_list->EmployerContribution) ?>', 1);"><div id="elh__napsa_view_EmployerContribution" class="_napsa_view_EmployerContribution">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_napsa_view_list->EmployerContribution->caption() ?></span><span class="ew-table-header-sort"><?php if ($_napsa_view_list->EmployerContribution->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_napsa_view_list->EmployerContribution->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_napsa_view_list->DateOfBirth->Visible) { // DateOfBirth ?>
	<?php if ($_napsa_view_list->SortUrl($_napsa_view_list->DateOfBirth) == "") { ?>
		<th data-name="DateOfBirth" class="<?php echo $_napsa_view_list->DateOfBirth->headerCellClass() ?>"><div id="elh__napsa_view_DateOfBirth" class="_napsa_view_DateOfBirth"><div class="ew-table-header-caption"><?php echo $_napsa_view_list->DateOfBirth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfBirth" class="<?php echo $_napsa_view_list->DateOfBirth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_napsa_view_list->SortUrl($_napsa_view_list->DateOfBirth) ?>', 1);"><div id="elh__napsa_view_DateOfBirth" class="_napsa_view_DateOfBirth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_napsa_view_list->DateOfBirth->caption() ?></span><span class="ew-table-header-sort"><?php if ($_napsa_view_list->DateOfBirth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_napsa_view_list->DateOfBirth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$_napsa_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($_napsa_view_list->ExportAll && $_napsa_view_list->isExport()) {
	$_napsa_view_list->StopRecord = $_napsa_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($_napsa_view_list->TotalRecords > $_napsa_view_list->StartRecord + $_napsa_view_list->DisplayRecords - 1)
		$_napsa_view_list->StopRecord = $_napsa_view_list->StartRecord + $_napsa_view_list->DisplayRecords - 1;
	else
		$_napsa_view_list->StopRecord = $_napsa_view_list->TotalRecords;
}
$_napsa_view_list->RecordCount = $_napsa_view_list->StartRecord - 1;
if ($_napsa_view_list->Recordset && !$_napsa_view_list->Recordset->EOF) {
	$_napsa_view_list->Recordset->moveFirst();
	$selectLimit = $_napsa_view_list->UseSelectLimit;
	if (!$selectLimit && $_napsa_view_list->StartRecord > 1)
		$_napsa_view_list->Recordset->move($_napsa_view_list->StartRecord - 1);
} elseif (!$_napsa_view->AllowAddDeleteRow && $_napsa_view_list->StopRecord == 0) {
	$_napsa_view_list->StopRecord = $_napsa_view->GridAddRowCount;
}

// Initialize aggregate
$_napsa_view->RowType = ROWTYPE_AGGREGATEINIT;
$_napsa_view->resetAttributes();
$_napsa_view_list->renderRow();
while ($_napsa_view_list->RecordCount < $_napsa_view_list->StopRecord) {
	$_napsa_view_list->RecordCount++;
	if ($_napsa_view_list->RecordCount >= $_napsa_view_list->StartRecord) {
		$_napsa_view_list->RowCount++;

		// Set up key count
		$_napsa_view_list->KeyCount = $_napsa_view_list->RowIndex;

		// Init row class and style
		$_napsa_view->resetAttributes();
		$_napsa_view->CssClass = "";
		if ($_napsa_view_list->isGridAdd()) {
		} else {
			$_napsa_view_list->loadRowValues($_napsa_view_list->Recordset); // Load row values
		}
		$_napsa_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$_napsa_view->RowAttrs->merge(["data-rowindex" => $_napsa_view_list->RowCount, "id" => "r" . $_napsa_view_list->RowCount . "__napsa_view", "data-rowtype" => $_napsa_view->RowType]);

		// Render row
		$_napsa_view_list->renderRow();

		// Render list options
		$_napsa_view_list->renderListOptions();
?>
	<tr <?php echo $_napsa_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$_napsa_view_list->ListOptions->render("body", "left", $_napsa_view_list->RowCount);
?>
	<?php if ($_napsa_view_list->LocalAuthority->Visible) { // LocalAuthority ?>
		<td data-name="LocalAuthority" <?php echo $_napsa_view_list->LocalAuthority->cellAttributes() ?>>
<span id="el<?php echo $_napsa_view_list->RowCount ?>__napsa_view_LocalAuthority">
<span<?php echo $_napsa_view_list->LocalAuthority->viewAttributes() ?>><?php echo $_napsa_view_list->LocalAuthority->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_napsa_view_list->DepartmentName->Visible) { // DepartmentName ?>
		<td data-name="DepartmentName" <?php echo $_napsa_view_list->DepartmentName->cellAttributes() ?>>
<span id="el<?php echo $_napsa_view_list->RowCount ?>__napsa_view_DepartmentName">
<span<?php echo $_napsa_view_list->DepartmentName->viewAttributes() ?>><?php echo $_napsa_view_list->DepartmentName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_napsa_view_list->SectionName->Visible) { // SectionName ?>
		<td data-name="SectionName" <?php echo $_napsa_view_list->SectionName->cellAttributes() ?>>
<span id="el<?php echo $_napsa_view_list->RowCount ?>__napsa_view_SectionName">
<span<?php echo $_napsa_view_list->SectionName->viewAttributes() ?>><?php echo $_napsa_view_list->SectionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_napsa_view_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $_napsa_view_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $_napsa_view_list->RowCount ?>__napsa_view_EmployeeID">
<span<?php echo $_napsa_view_list->EmployeeID->viewAttributes() ?>><?php echo $_napsa_view_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_napsa_view_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $_napsa_view_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $_napsa_view_list->RowCount ?>__napsa_view_Surname">
<span<?php echo $_napsa_view_list->Surname->viewAttributes() ?>><?php echo $_napsa_view_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_napsa_view_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $_napsa_view_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $_napsa_view_list->RowCount ?>__napsa_view_FirstName">
<span<?php echo $_napsa_view_list->FirstName->viewAttributes() ?>><?php echo $_napsa_view_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_napsa_view_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $_napsa_view_list->MiddleName->cellAttributes() ?>>
<span id="el<?php echo $_napsa_view_list->RowCount ?>__napsa_view_MiddleName">
<span<?php echo $_napsa_view_list->MiddleName->viewAttributes() ?>><?php echo $_napsa_view_list->MiddleName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_napsa_view_list->NRC->Visible) { // NRC ?>
		<td data-name="NRC" <?php echo $_napsa_view_list->NRC->cellAttributes() ?>>
<span id="el<?php echo $_napsa_view_list->RowCount ?>__napsa_view_NRC">
<span<?php echo $_napsa_view_list->NRC->viewAttributes() ?>><?php echo $_napsa_view_list->NRC->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_napsa_view_list->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
		<td data-name="SocialSecurityNo" <?php echo $_napsa_view_list->SocialSecurityNo->cellAttributes() ?>>
<span id="el<?php echo $_napsa_view_list->RowCount ?>__napsa_view_SocialSecurityNo">
<span<?php echo $_napsa_view_list->SocialSecurityNo->viewAttributes() ?>><?php echo $_napsa_view_list->SocialSecurityNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_napsa_view_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod" <?php echo $_napsa_view_list->PayrollPeriod->cellAttributes() ?>>
<span id="el<?php echo $_napsa_view_list->RowCount ?>__napsa_view_PayrollPeriod">
<span<?php echo $_napsa_view_list->PayrollPeriod->viewAttributes() ?>><?php echo $_napsa_view_list->PayrollPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_napsa_view_list->MonthShort->Visible) { // MonthShort ?>
		<td data-name="MonthShort" <?php echo $_napsa_view_list->MonthShort->cellAttributes() ?>>
<span id="el<?php echo $_napsa_view_list->RowCount ?>__napsa_view_MonthShort">
<span<?php echo $_napsa_view_list->MonthShort->viewAttributes() ?>><?php echo $_napsa_view_list->MonthShort->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_napsa_view_list->Year->Visible) { // Year ?>
		<td data-name="Year" <?php echo $_napsa_view_list->Year->cellAttributes() ?>>
<span id="el<?php echo $_napsa_view_list->RowCount ?>__napsa_view_Year">
<span<?php echo $_napsa_view_list->Year->viewAttributes() ?>><?php echo $_napsa_view_list->Year->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_napsa_view_list->pName->Visible) { // pName ?>
		<td data-name="pName" <?php echo $_napsa_view_list->pName->cellAttributes() ?>>
<span id="el<?php echo $_napsa_view_list->RowCount ?>__napsa_view_pName">
<span<?php echo $_napsa_view_list->pName->viewAttributes() ?>><?php echo $_napsa_view_list->pName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_napsa_view_list->GrossPay->Visible) { // GrossPay ?>
		<td data-name="GrossPay" <?php echo $_napsa_view_list->GrossPay->cellAttributes() ?>>
<span id="el<?php echo $_napsa_view_list->RowCount ?>__napsa_view_GrossPay">
<span<?php echo $_napsa_view_list->GrossPay->viewAttributes() ?>><?php echo $_napsa_view_list->GrossPay->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_napsa_view_list->EmployeeContribution->Visible) { // EmployeeContribution ?>
		<td data-name="EmployeeContribution" <?php echo $_napsa_view_list->EmployeeContribution->cellAttributes() ?>>
<span id="el<?php echo $_napsa_view_list->RowCount ?>__napsa_view_EmployeeContribution">
<span<?php echo $_napsa_view_list->EmployeeContribution->viewAttributes() ?>><?php echo $_napsa_view_list->EmployeeContribution->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_napsa_view_list->EmployerContribution->Visible) { // EmployerContribution ?>
		<td data-name="EmployerContribution" <?php echo $_napsa_view_list->EmployerContribution->cellAttributes() ?>>
<span id="el<?php echo $_napsa_view_list->RowCount ?>__napsa_view_EmployerContribution">
<span<?php echo $_napsa_view_list->EmployerContribution->viewAttributes() ?>><?php echo $_napsa_view_list->EmployerContribution->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_napsa_view_list->DateOfBirth->Visible) { // DateOfBirth ?>
		<td data-name="DateOfBirth" <?php echo $_napsa_view_list->DateOfBirth->cellAttributes() ?>>
<span id="el<?php echo $_napsa_view_list->RowCount ?>__napsa_view_DateOfBirth">
<span<?php echo $_napsa_view_list->DateOfBirth->viewAttributes() ?>><?php echo $_napsa_view_list->DateOfBirth->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$_napsa_view_list->ListOptions->render("body", "right", $_napsa_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$_napsa_view_list->isGridAdd())
		$_napsa_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$_napsa_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($_napsa_view_list->Recordset)
	$_napsa_view_list->Recordset->Close();
?>
<?php if (!$_napsa_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$_napsa_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $_napsa_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $_napsa_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($_napsa_view_list->TotalRecords == 0 && !$_napsa_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $_napsa_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$_napsa_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$_napsa_view_list->isExport()) { ?>
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
$_napsa_view_list->terminate();
?>