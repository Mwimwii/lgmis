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
$staff_copy_list = new staff_copy_list();

// Run the page
$staff_copy_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staff_copy_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$staff_copy_list->isExport()) { ?>
<script>
var fstaff_copylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fstaff_copylist = currentForm = new ew.Form("fstaff_copylist", "list");
	fstaff_copylist.formKeyCountName = '<?php echo $staff_copy_list->FormKeyCountName ?>';
	loadjs.done("fstaff_copylist");
});
var fstaff_copylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fstaff_copylistsrch = currentSearchForm = new ew.Form("fstaff_copylistsrch");

	// Dynamic selection lists
	// Filters

	fstaff_copylistsrch.filterList = <?php echo $staff_copy_list->getFilterList() ?>;

	// Init search panel as collapsed
	fstaff_copylistsrch.initSearchPanel = true;
	loadjs.done("fstaff_copylistsrch");
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
<?php if (!$staff_copy_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($staff_copy_list->TotalRecords > 0 && $staff_copy_list->ExportOptions->visible()) { ?>
<?php $staff_copy_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($staff_copy_list->ImportOptions->visible()) { ?>
<?php $staff_copy_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($staff_copy_list->SearchOptions->visible()) { ?>
<?php $staff_copy_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($staff_copy_list->FilterOptions->visible()) { ?>
<?php $staff_copy_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$staff_copy_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$staff_copy_list->isExport() && !$staff_copy->CurrentAction) { ?>
<form name="fstaff_copylistsrch" id="fstaff_copylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fstaff_copylistsrch-search-panel" class="<?php echo $staff_copy_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="staff_copy">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $staff_copy_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($staff_copy_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($staff_copy_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $staff_copy_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($staff_copy_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($staff_copy_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($staff_copy_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($staff_copy_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $staff_copy_list->showPageHeader(); ?>
<?php
$staff_copy_list->showMessage();
?>
<?php if ($staff_copy_list->TotalRecords > 0 || $staff_copy->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($staff_copy_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> staff_copy">
<?php if (!$staff_copy_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$staff_copy_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staff_copy_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $staff_copy_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fstaff_copylist" id="fstaff_copylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staff_copy">
<div id="gmp_staff_copy" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($staff_copy_list->TotalRecords > 0 || $staff_copy_list->isGridEdit()) { ?>
<table id="tbl_staff_copylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$staff_copy->RowType = ROWTYPE_HEADER;

// Render list options
$staff_copy_list->renderListOptions();

// Render list options (header, left)
$staff_copy_list->ListOptions->render("header", "left");
?>
<?php if ($staff_copy_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $staff_copy_list->EmployeeID->headerCellClass() ?>"><div id="elh_staff_copy_EmployeeID" class="staff_copy_EmployeeID"><div class="ew-table-header-caption"><?php echo $staff_copy_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $staff_copy_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->EmployeeID) ?>', 1);"><div id="elh_staff_copy_EmployeeID" class="staff_copy_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->LACode->Visible) { // LACode ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $staff_copy_list->LACode->headerCellClass() ?>"><div id="elh_staff_copy_LACode" class="staff_copy_LACode"><div class="ew-table-header-caption"><?php echo $staff_copy_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $staff_copy_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->LACode) ?>', 1);"><div id="elh_staff_copy_LACode" class="staff_copy_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->LACode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->FormerFileNumber->Visible) { // FormerFileNumber ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->FormerFileNumber) == "") { ?>
		<th data-name="FormerFileNumber" class="<?php echo $staff_copy_list->FormerFileNumber->headerCellClass() ?>"><div id="elh_staff_copy_FormerFileNumber" class="staff_copy_FormerFileNumber"><div class="ew-table-header-caption"><?php echo $staff_copy_list->FormerFileNumber->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FormerFileNumber" class="<?php echo $staff_copy_list->FormerFileNumber->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->FormerFileNumber) ?>', 1);"><div id="elh_staff_copy_FormerFileNumber" class="staff_copy_FormerFileNumber">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->FormerFileNumber->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->FormerFileNumber->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->FormerFileNumber->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->NRC->Visible) { // NRC ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->NRC) == "") { ?>
		<th data-name="NRC" class="<?php echo $staff_copy_list->NRC->headerCellClass() ?>"><div id="elh_staff_copy_NRC" class="staff_copy_NRC"><div class="ew-table-header-caption"><?php echo $staff_copy_list->NRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC" class="<?php echo $staff_copy_list->NRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->NRC) ?>', 1);"><div id="elh_staff_copy_NRC" class="staff_copy_NRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->NRC->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->Title->Visible) { // Title ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->Title) == "") { ?>
		<th data-name="Title" class="<?php echo $staff_copy_list->Title->headerCellClass() ?>"><div id="elh_staff_copy_Title" class="staff_copy_Title"><div class="ew-table-header-caption"><?php echo $staff_copy_list->Title->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Title" class="<?php echo $staff_copy_list->Title->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->Title) ?>', 1);"><div id="elh_staff_copy_Title" class="staff_copy_Title">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->Title->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->Title->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->Title->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->Surname->Visible) { // Surname ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $staff_copy_list->Surname->headerCellClass() ?>"><div id="elh_staff_copy_Surname" class="staff_copy_Surname"><div class="ew-table-header-caption"><?php echo $staff_copy_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $staff_copy_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->Surname) ?>', 1);"><div id="elh_staff_copy_Surname" class="staff_copy_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->FirstName->Visible) { // FirstName ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $staff_copy_list->FirstName->headerCellClass() ?>"><div id="elh_staff_copy_FirstName" class="staff_copy_FirstName"><div class="ew-table-header-caption"><?php echo $staff_copy_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $staff_copy_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->FirstName) ?>', 1);"><div id="elh_staff_copy_FirstName" class="staff_copy_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->MiddleName->Visible) { // MiddleName ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $staff_copy_list->MiddleName->headerCellClass() ?>"><div id="elh_staff_copy_MiddleName" class="staff_copy_MiddleName"><div class="ew-table-header-caption"><?php echo $staff_copy_list->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $staff_copy_list->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->MiddleName) ?>', 1);"><div id="elh_staff_copy_MiddleName" class="staff_copy_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->MiddleName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->Sex->Visible) { // Sex ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->Sex) == "") { ?>
		<th data-name="Sex" class="<?php echo $staff_copy_list->Sex->headerCellClass() ?>"><div id="elh_staff_copy_Sex" class="staff_copy_Sex"><div class="ew-table-header-caption"><?php echo $staff_copy_list->Sex->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sex" class="<?php echo $staff_copy_list->Sex->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->Sex) ?>', 1);"><div id="elh_staff_copy_Sex" class="staff_copy_Sex">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->Sex->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->Sex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->Sex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->MaritalStatus->Visible) { // MaritalStatus ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->MaritalStatus) == "") { ?>
		<th data-name="MaritalStatus" class="<?php echo $staff_copy_list->MaritalStatus->headerCellClass() ?>"><div id="elh_staff_copy_MaritalStatus" class="staff_copy_MaritalStatus"><div class="ew-table-header-caption"><?php echo $staff_copy_list->MaritalStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MaritalStatus" class="<?php echo $staff_copy_list->MaritalStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->MaritalStatus) ?>', 1);"><div id="elh_staff_copy_MaritalStatus" class="staff_copy_MaritalStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->MaritalStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->MaritalStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->MaritalStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->MaidenName->Visible) { // MaidenName ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->MaidenName) == "") { ?>
		<th data-name="MaidenName" class="<?php echo $staff_copy_list->MaidenName->headerCellClass() ?>"><div id="elh_staff_copy_MaidenName" class="staff_copy_MaidenName"><div class="ew-table-header-caption"><?php echo $staff_copy_list->MaidenName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MaidenName" class="<?php echo $staff_copy_list->MaidenName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->MaidenName) ?>', 1);"><div id="elh_staff_copy_MaidenName" class="staff_copy_MaidenName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->MaidenName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->MaidenName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->MaidenName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->DateOfBirth->Visible) { // DateOfBirth ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->DateOfBirth) == "") { ?>
		<th data-name="DateOfBirth" class="<?php echo $staff_copy_list->DateOfBirth->headerCellClass() ?>"><div id="elh_staff_copy_DateOfBirth" class="staff_copy_DateOfBirth"><div class="ew-table-header-caption"><?php echo $staff_copy_list->DateOfBirth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfBirth" class="<?php echo $staff_copy_list->DateOfBirth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->DateOfBirth) ?>', 1);"><div id="elh_staff_copy_DateOfBirth" class="staff_copy_DateOfBirth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->DateOfBirth->caption() ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->DateOfBirth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->DateOfBirth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->AcademicQualification->Visible) { // AcademicQualification ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->AcademicQualification) == "") { ?>
		<th data-name="AcademicQualification" class="<?php echo $staff_copy_list->AcademicQualification->headerCellClass() ?>"><div id="elh_staff_copy_AcademicQualification" class="staff_copy_AcademicQualification"><div class="ew-table-header-caption"><?php echo $staff_copy_list->AcademicQualification->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AcademicQualification" class="<?php echo $staff_copy_list->AcademicQualification->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->AcademicQualification) ?>', 1);"><div id="elh_staff_copy_AcademicQualification" class="staff_copy_AcademicQualification">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->AcademicQualification->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->AcademicQualification->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->AcademicQualification->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->ProfessionalQualification->Visible) { // ProfessionalQualification ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->ProfessionalQualification) == "") { ?>
		<th data-name="ProfessionalQualification" class="<?php echo $staff_copy_list->ProfessionalQualification->headerCellClass() ?>"><div id="elh_staff_copy_ProfessionalQualification" class="staff_copy_ProfessionalQualification"><div class="ew-table-header-caption"><?php echo $staff_copy_list->ProfessionalQualification->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProfessionalQualification" class="<?php echo $staff_copy_list->ProfessionalQualification->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->ProfessionalQualification) ?>', 1);"><div id="elh_staff_copy_ProfessionalQualification" class="staff_copy_ProfessionalQualification">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->ProfessionalQualification->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->ProfessionalQualification->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->ProfessionalQualification->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->MedicalCondition->Visible) { // MedicalCondition ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->MedicalCondition) == "") { ?>
		<th data-name="MedicalCondition" class="<?php echo $staff_copy_list->MedicalCondition->headerCellClass() ?>"><div id="elh_staff_copy_MedicalCondition" class="staff_copy_MedicalCondition"><div class="ew-table-header-caption"><?php echo $staff_copy_list->MedicalCondition->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MedicalCondition" class="<?php echo $staff_copy_list->MedicalCondition->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->MedicalCondition) ?>', 1);"><div id="elh_staff_copy_MedicalCondition" class="staff_copy_MedicalCondition">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->MedicalCondition->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->MedicalCondition->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->MedicalCondition->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->OtherMedicalConditions->Visible) { // OtherMedicalConditions ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->OtherMedicalConditions) == "") { ?>
		<th data-name="OtherMedicalConditions" class="<?php echo $staff_copy_list->OtherMedicalConditions->headerCellClass() ?>"><div id="elh_staff_copy_OtherMedicalConditions" class="staff_copy_OtherMedicalConditions"><div class="ew-table-header-caption"><?php echo $staff_copy_list->OtherMedicalConditions->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OtherMedicalConditions" class="<?php echo $staff_copy_list->OtherMedicalConditions->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->OtherMedicalConditions) ?>', 1);"><div id="elh_staff_copy_OtherMedicalConditions" class="staff_copy_OtherMedicalConditions">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->OtherMedicalConditions->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->OtherMedicalConditions->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->OtherMedicalConditions->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->PhysicalChallenge->Visible) { // PhysicalChallenge ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->PhysicalChallenge) == "") { ?>
		<th data-name="PhysicalChallenge" class="<?php echo $staff_copy_list->PhysicalChallenge->headerCellClass() ?>"><div id="elh_staff_copy_PhysicalChallenge" class="staff_copy_PhysicalChallenge"><div class="ew-table-header-caption"><?php echo $staff_copy_list->PhysicalChallenge->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PhysicalChallenge" class="<?php echo $staff_copy_list->PhysicalChallenge->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->PhysicalChallenge) ?>', 1);"><div id="elh_staff_copy_PhysicalChallenge" class="staff_copy_PhysicalChallenge">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->PhysicalChallenge->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->PhysicalChallenge->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->PhysicalChallenge->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->PostalAddress->Visible) { // PostalAddress ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->PostalAddress) == "") { ?>
		<th data-name="PostalAddress" class="<?php echo $staff_copy_list->PostalAddress->headerCellClass() ?>"><div id="elh_staff_copy_PostalAddress" class="staff_copy_PostalAddress"><div class="ew-table-header-caption"><?php echo $staff_copy_list->PostalAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PostalAddress" class="<?php echo $staff_copy_list->PostalAddress->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->PostalAddress) ?>', 1);"><div id="elh_staff_copy_PostalAddress" class="staff_copy_PostalAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->PostalAddress->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->PostalAddress->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->PostalAddress->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->PhysicalAddress->Visible) { // PhysicalAddress ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->PhysicalAddress) == "") { ?>
		<th data-name="PhysicalAddress" class="<?php echo $staff_copy_list->PhysicalAddress->headerCellClass() ?>"><div id="elh_staff_copy_PhysicalAddress" class="staff_copy_PhysicalAddress"><div class="ew-table-header-caption"><?php echo $staff_copy_list->PhysicalAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PhysicalAddress" class="<?php echo $staff_copy_list->PhysicalAddress->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->PhysicalAddress) ?>', 1);"><div id="elh_staff_copy_PhysicalAddress" class="staff_copy_PhysicalAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->PhysicalAddress->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->PhysicalAddress->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->PhysicalAddress->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->TownOrVillage->Visible) { // TownOrVillage ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->TownOrVillage) == "") { ?>
		<th data-name="TownOrVillage" class="<?php echo $staff_copy_list->TownOrVillage->headerCellClass() ?>"><div id="elh_staff_copy_TownOrVillage" class="staff_copy_TownOrVillage"><div class="ew-table-header-caption"><?php echo $staff_copy_list->TownOrVillage->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TownOrVillage" class="<?php echo $staff_copy_list->TownOrVillage->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->TownOrVillage) ?>', 1);"><div id="elh_staff_copy_TownOrVillage" class="staff_copy_TownOrVillage">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->TownOrVillage->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->TownOrVillage->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->TownOrVillage->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->Telephone->Visible) { // Telephone ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->Telephone) == "") { ?>
		<th data-name="Telephone" class="<?php echo $staff_copy_list->Telephone->headerCellClass() ?>"><div id="elh_staff_copy_Telephone" class="staff_copy_Telephone"><div class="ew-table-header-caption"><?php echo $staff_copy_list->Telephone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Telephone" class="<?php echo $staff_copy_list->Telephone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->Telephone) ?>', 1);"><div id="elh_staff_copy_Telephone" class="staff_copy_Telephone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->Telephone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->Telephone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->Telephone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->Mobile->Visible) { // Mobile ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->Mobile) == "") { ?>
		<th data-name="Mobile" class="<?php echo $staff_copy_list->Mobile->headerCellClass() ?>"><div id="elh_staff_copy_Mobile" class="staff_copy_Mobile"><div class="ew-table-header-caption"><?php echo $staff_copy_list->Mobile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Mobile" class="<?php echo $staff_copy_list->Mobile->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->Mobile) ?>', 1);"><div id="elh_staff_copy_Mobile" class="staff_copy_Mobile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->Mobile->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->Mobile->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->Mobile->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->Fax->Visible) { // Fax ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->Fax) == "") { ?>
		<th data-name="Fax" class="<?php echo $staff_copy_list->Fax->headerCellClass() ?>"><div id="elh_staff_copy_Fax" class="staff_copy_Fax"><div class="ew-table-header-caption"><?php echo $staff_copy_list->Fax->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Fax" class="<?php echo $staff_copy_list->Fax->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->Fax) ?>', 1);"><div id="elh_staff_copy_Fax" class="staff_copy_Fax">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->Fax->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->Fax->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->Fax->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->_Email->Visible) { // Email ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->_Email) == "") { ?>
		<th data-name="_Email" class="<?php echo $staff_copy_list->_Email->headerCellClass() ?>"><div id="elh_staff_copy__Email" class="staff_copy__Email"><div class="ew-table-header-caption"><?php echo $staff_copy_list->_Email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_Email" class="<?php echo $staff_copy_list->_Email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->_Email) ?>', 1);"><div id="elh_staff_copy__Email" class="staff_copy__Email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->_Email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->_Email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->_Email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->NumberOfBiologicalChildren->Visible) { // NumberOfBiologicalChildren ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->NumberOfBiologicalChildren) == "") { ?>
		<th data-name="NumberOfBiologicalChildren" class="<?php echo $staff_copy_list->NumberOfBiologicalChildren->headerCellClass() ?>"><div id="elh_staff_copy_NumberOfBiologicalChildren" class="staff_copy_NumberOfBiologicalChildren"><div class="ew-table-header-caption"><?php echo $staff_copy_list->NumberOfBiologicalChildren->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NumberOfBiologicalChildren" class="<?php echo $staff_copy_list->NumberOfBiologicalChildren->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->NumberOfBiologicalChildren) ?>', 1);"><div id="elh_staff_copy_NumberOfBiologicalChildren" class="staff_copy_NumberOfBiologicalChildren">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->NumberOfBiologicalChildren->caption() ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->NumberOfBiologicalChildren->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->NumberOfBiologicalChildren->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->NumberOfDependants->Visible) { // NumberOfDependants ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->NumberOfDependants) == "") { ?>
		<th data-name="NumberOfDependants" class="<?php echo $staff_copy_list->NumberOfDependants->headerCellClass() ?>"><div id="elh_staff_copy_NumberOfDependants" class="staff_copy_NumberOfDependants"><div class="ew-table-header-caption"><?php echo $staff_copy_list->NumberOfDependants->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NumberOfDependants" class="<?php echo $staff_copy_list->NumberOfDependants->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->NumberOfDependants) ?>', 1);"><div id="elh_staff_copy_NumberOfDependants" class="staff_copy_NumberOfDependants">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->NumberOfDependants->caption() ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->NumberOfDependants->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->NumberOfDependants->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->NextOfKin->Visible) { // NextOfKin ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->NextOfKin) == "") { ?>
		<th data-name="NextOfKin" class="<?php echo $staff_copy_list->NextOfKin->headerCellClass() ?>"><div id="elh_staff_copy_NextOfKin" class="staff_copy_NextOfKin"><div class="ew-table-header-caption"><?php echo $staff_copy_list->NextOfKin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NextOfKin" class="<?php echo $staff_copy_list->NextOfKin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->NextOfKin) ?>', 1);"><div id="elh_staff_copy_NextOfKin" class="staff_copy_NextOfKin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->NextOfKin->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->NextOfKin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->NextOfKin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->RelationshipCode->Visible) { // RelationshipCode ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->RelationshipCode) == "") { ?>
		<th data-name="RelationshipCode" class="<?php echo $staff_copy_list->RelationshipCode->headerCellClass() ?>"><div id="elh_staff_copy_RelationshipCode" class="staff_copy_RelationshipCode"><div class="ew-table-header-caption"><?php echo $staff_copy_list->RelationshipCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RelationshipCode" class="<?php echo $staff_copy_list->RelationshipCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->RelationshipCode) ?>', 1);"><div id="elh_staff_copy_RelationshipCode" class="staff_copy_RelationshipCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->RelationshipCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->RelationshipCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->RelationshipCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->NextOfKinMobile) == "") { ?>
		<th data-name="NextOfKinMobile" class="<?php echo $staff_copy_list->NextOfKinMobile->headerCellClass() ?>"><div id="elh_staff_copy_NextOfKinMobile" class="staff_copy_NextOfKinMobile"><div class="ew-table-header-caption"><?php echo $staff_copy_list->NextOfKinMobile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NextOfKinMobile" class="<?php echo $staff_copy_list->NextOfKinMobile->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->NextOfKinMobile) ?>', 1);"><div id="elh_staff_copy_NextOfKinMobile" class="staff_copy_NextOfKinMobile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->NextOfKinMobile->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->NextOfKinMobile->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->NextOfKinMobile->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->NextOfKinEmail) == "") { ?>
		<th data-name="NextOfKinEmail" class="<?php echo $staff_copy_list->NextOfKinEmail->headerCellClass() ?>"><div id="elh_staff_copy_NextOfKinEmail" class="staff_copy_NextOfKinEmail"><div class="ew-table-header-caption"><?php echo $staff_copy_list->NextOfKinEmail->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NextOfKinEmail" class="<?php echo $staff_copy_list->NextOfKinEmail->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->NextOfKinEmail) ?>', 1);"><div id="elh_staff_copy_NextOfKinEmail" class="staff_copy_NextOfKinEmail">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->NextOfKinEmail->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->NextOfKinEmail->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->NextOfKinEmail->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->SpouseName->Visible) { // SpouseName ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->SpouseName) == "") { ?>
		<th data-name="SpouseName" class="<?php echo $staff_copy_list->SpouseName->headerCellClass() ?>"><div id="elh_staff_copy_SpouseName" class="staff_copy_SpouseName"><div class="ew-table-header-caption"><?php echo $staff_copy_list->SpouseName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SpouseName" class="<?php echo $staff_copy_list->SpouseName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->SpouseName) ?>', 1);"><div id="elh_staff_copy_SpouseName" class="staff_copy_SpouseName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->SpouseName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->SpouseName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->SpouseName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->SpouseNRC->Visible) { // SpouseNRC ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->SpouseNRC) == "") { ?>
		<th data-name="SpouseNRC" class="<?php echo $staff_copy_list->SpouseNRC->headerCellClass() ?>"><div id="elh_staff_copy_SpouseNRC" class="staff_copy_SpouseNRC"><div class="ew-table-header-caption"><?php echo $staff_copy_list->SpouseNRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SpouseNRC" class="<?php echo $staff_copy_list->SpouseNRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->SpouseNRC) ?>', 1);"><div id="elh_staff_copy_SpouseNRC" class="staff_copy_SpouseNRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->SpouseNRC->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->SpouseNRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->SpouseNRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->SpouseMobile->Visible) { // SpouseMobile ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->SpouseMobile) == "") { ?>
		<th data-name="SpouseMobile" class="<?php echo $staff_copy_list->SpouseMobile->headerCellClass() ?>"><div id="elh_staff_copy_SpouseMobile" class="staff_copy_SpouseMobile"><div class="ew-table-header-caption"><?php echo $staff_copy_list->SpouseMobile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SpouseMobile" class="<?php echo $staff_copy_list->SpouseMobile->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->SpouseMobile) ?>', 1);"><div id="elh_staff_copy_SpouseMobile" class="staff_copy_SpouseMobile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->SpouseMobile->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->SpouseMobile->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->SpouseMobile->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->SpouseEmail->Visible) { // SpouseEmail ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->SpouseEmail) == "") { ?>
		<th data-name="SpouseEmail" class="<?php echo $staff_copy_list->SpouseEmail->headerCellClass() ?>"><div id="elh_staff_copy_SpouseEmail" class="staff_copy_SpouseEmail"><div class="ew-table-header-caption"><?php echo $staff_copy_list->SpouseEmail->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SpouseEmail" class="<?php echo $staff_copy_list->SpouseEmail->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->SpouseEmail) ?>', 1);"><div id="elh_staff_copy_SpouseEmail" class="staff_copy_SpouseEmail">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->SpouseEmail->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->SpouseEmail->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->SpouseEmail->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->SpouseResidentialAddress->Visible) { // SpouseResidentialAddress ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->SpouseResidentialAddress) == "") { ?>
		<th data-name="SpouseResidentialAddress" class="<?php echo $staff_copy_list->SpouseResidentialAddress->headerCellClass() ?>"><div id="elh_staff_copy_SpouseResidentialAddress" class="staff_copy_SpouseResidentialAddress"><div class="ew-table-header-caption"><?php echo $staff_copy_list->SpouseResidentialAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SpouseResidentialAddress" class="<?php echo $staff_copy_list->SpouseResidentialAddress->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->SpouseResidentialAddress) ?>', 1);"><div id="elh_staff_copy_SpouseResidentialAddress" class="staff_copy_SpouseResidentialAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->SpouseResidentialAddress->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->SpouseResidentialAddress->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->SpouseResidentialAddress->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->LastUserID->Visible) { // LastUserID ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->LastUserID) == "") { ?>
		<th data-name="LastUserID" class="<?php echo $staff_copy_list->LastUserID->headerCellClass() ?>"><div id="elh_staff_copy_LastUserID" class="staff_copy_LastUserID"><div class="ew-table-header-caption"><?php echo $staff_copy_list->LastUserID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUserID" class="<?php echo $staff_copy_list->LastUserID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->LastUserID) ?>', 1);"><div id="elh_staff_copy_LastUserID" class="staff_copy_LastUserID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->LastUserID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->LastUserID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->LastUserID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->LastUpdated->Visible) { // LastUpdated ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->LastUpdated) == "") { ?>
		<th data-name="LastUpdated" class="<?php echo $staff_copy_list->LastUpdated->headerCellClass() ?>"><div id="elh_staff_copy_LastUpdated" class="staff_copy_LastUpdated"><div class="ew-table-header-caption"><?php echo $staff_copy_list->LastUpdated->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdated" class="<?php echo $staff_copy_list->LastUpdated->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->LastUpdated) ?>', 1);"><div id="elh_staff_copy_LastUpdated" class="staff_copy_LastUpdated">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->LastUpdated->caption() ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->LastUpdated->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->LastUpdated->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->BankBranchCode->Visible) { // BankBranchCode ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->BankBranchCode) == "") { ?>
		<th data-name="BankBranchCode" class="<?php echo $staff_copy_list->BankBranchCode->headerCellClass() ?>"><div id="elh_staff_copy_BankBranchCode" class="staff_copy_BankBranchCode"><div class="ew-table-header-caption"><?php echo $staff_copy_list->BankBranchCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankBranchCode" class="<?php echo $staff_copy_list->BankBranchCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->BankBranchCode) ?>', 1);"><div id="elh_staff_copy_BankBranchCode" class="staff_copy_BankBranchCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->BankBranchCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->BankBranchCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->BankBranchCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->BankAccountNo->Visible) { // BankAccountNo ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->BankAccountNo) == "") { ?>
		<th data-name="BankAccountNo" class="<?php echo $staff_copy_list->BankAccountNo->headerCellClass() ?>"><div id="elh_staff_copy_BankAccountNo" class="staff_copy_BankAccountNo"><div class="ew-table-header-caption"><?php echo $staff_copy_list->BankAccountNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankAccountNo" class="<?php echo $staff_copy_list->BankAccountNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->BankAccountNo) ?>', 1);"><div id="elh_staff_copy_BankAccountNo" class="staff_copy_BankAccountNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->BankAccountNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->BankAccountNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->BankAccountNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->PaymentMethod->Visible) { // PaymentMethod ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->PaymentMethod) == "") { ?>
		<th data-name="PaymentMethod" class="<?php echo $staff_copy_list->PaymentMethod->headerCellClass() ?>"><div id="elh_staff_copy_PaymentMethod" class="staff_copy_PaymentMethod"><div class="ew-table-header-caption"><?php echo $staff_copy_list->PaymentMethod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaymentMethod" class="<?php echo $staff_copy_list->PaymentMethod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->PaymentMethod) ?>', 1);"><div id="elh_staff_copy_PaymentMethod" class="staff_copy_PaymentMethod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->PaymentMethod->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->PaymentMethod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->PaymentMethod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->TaxNumber->Visible) { // TaxNumber ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->TaxNumber) == "") { ?>
		<th data-name="TaxNumber" class="<?php echo $staff_copy_list->TaxNumber->headerCellClass() ?>"><div id="elh_staff_copy_TaxNumber" class="staff_copy_TaxNumber"><div class="ew-table-header-caption"><?php echo $staff_copy_list->TaxNumber->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TaxNumber" class="<?php echo $staff_copy_list->TaxNumber->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->TaxNumber) ?>', 1);"><div id="elh_staff_copy_TaxNumber" class="staff_copy_TaxNumber">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->TaxNumber->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->TaxNumber->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->TaxNumber->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->PensionNumber->Visible) { // PensionNumber ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->PensionNumber) == "") { ?>
		<th data-name="PensionNumber" class="<?php echo $staff_copy_list->PensionNumber->headerCellClass() ?>"><div id="elh_staff_copy_PensionNumber" class="staff_copy_PensionNumber"><div class="ew-table-header-caption"><?php echo $staff_copy_list->PensionNumber->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PensionNumber" class="<?php echo $staff_copy_list->PensionNumber->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->PensionNumber) ?>', 1);"><div id="elh_staff_copy_PensionNumber" class="staff_copy_PensionNumber">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->PensionNumber->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->PensionNumber->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->PensionNumber->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->SocialSecurityNo) == "") { ?>
		<th data-name="SocialSecurityNo" class="<?php echo $staff_copy_list->SocialSecurityNo->headerCellClass() ?>"><div id="elh_staff_copy_SocialSecurityNo" class="staff_copy_SocialSecurityNo"><div class="ew-table-header-caption"><?php echo $staff_copy_list->SocialSecurityNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SocialSecurityNo" class="<?php echo $staff_copy_list->SocialSecurityNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->SocialSecurityNo) ?>', 1);"><div id="elh_staff_copy_SocialSecurityNo" class="staff_copy_SocialSecurityNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->SocialSecurityNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->SocialSecurityNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->SocialSecurityNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_copy_list->ThirdParties->Visible) { // ThirdParties ?>
	<?php if ($staff_copy_list->SortUrl($staff_copy_list->ThirdParties) == "") { ?>
		<th data-name="ThirdParties" class="<?php echo $staff_copy_list->ThirdParties->headerCellClass() ?>"><div id="elh_staff_copy_ThirdParties" class="staff_copy_ThirdParties"><div class="ew-table-header-caption"><?php echo $staff_copy_list->ThirdParties->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ThirdParties" class="<?php echo $staff_copy_list->ThirdParties->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_copy_list->SortUrl($staff_copy_list->ThirdParties) ?>', 1);"><div id="elh_staff_copy_ThirdParties" class="staff_copy_ThirdParties">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_copy_list->ThirdParties->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_copy_list->ThirdParties->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_copy_list->ThirdParties->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$staff_copy_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($staff_copy_list->ExportAll && $staff_copy_list->isExport()) {
	$staff_copy_list->StopRecord = $staff_copy_list->TotalRecords;
} else {

	// Set the last record to display
	if ($staff_copy_list->TotalRecords > $staff_copy_list->StartRecord + $staff_copy_list->DisplayRecords - 1)
		$staff_copy_list->StopRecord = $staff_copy_list->StartRecord + $staff_copy_list->DisplayRecords - 1;
	else
		$staff_copy_list->StopRecord = $staff_copy_list->TotalRecords;
}
$staff_copy_list->RecordCount = $staff_copy_list->StartRecord - 1;
if ($staff_copy_list->Recordset && !$staff_copy_list->Recordset->EOF) {
	$staff_copy_list->Recordset->moveFirst();
	$selectLimit = $staff_copy_list->UseSelectLimit;
	if (!$selectLimit && $staff_copy_list->StartRecord > 1)
		$staff_copy_list->Recordset->move($staff_copy_list->StartRecord - 1);
} elseif (!$staff_copy->AllowAddDeleteRow && $staff_copy_list->StopRecord == 0) {
	$staff_copy_list->StopRecord = $staff_copy->GridAddRowCount;
}

// Initialize aggregate
$staff_copy->RowType = ROWTYPE_AGGREGATEINIT;
$staff_copy->resetAttributes();
$staff_copy_list->renderRow();
while ($staff_copy_list->RecordCount < $staff_copy_list->StopRecord) {
	$staff_copy_list->RecordCount++;
	if ($staff_copy_list->RecordCount >= $staff_copy_list->StartRecord) {
		$staff_copy_list->RowCount++;

		// Set up key count
		$staff_copy_list->KeyCount = $staff_copy_list->RowIndex;

		// Init row class and style
		$staff_copy->resetAttributes();
		$staff_copy->CssClass = "";
		if ($staff_copy_list->isGridAdd()) {
		} else {
			$staff_copy_list->loadRowValues($staff_copy_list->Recordset); // Load row values
		}
		$staff_copy->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$staff_copy->RowAttrs->merge(["data-rowindex" => $staff_copy_list->RowCount, "id" => "r" . $staff_copy_list->RowCount . "_staff_copy", "data-rowtype" => $staff_copy->RowType]);

		// Render row
		$staff_copy_list->renderRow();

		// Render list options
		$staff_copy_list->renderListOptions();
?>
	<tr <?php echo $staff_copy->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staff_copy_list->ListOptions->render("body", "left", $staff_copy_list->RowCount);
?>
	<?php if ($staff_copy_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $staff_copy_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_EmployeeID">
<span<?php echo $staff_copy_list->EmployeeID->viewAttributes() ?>><?php echo $staff_copy_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $staff_copy_list->LACode->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_LACode">
<span<?php echo $staff_copy_list->LACode->viewAttributes() ?>><?php echo $staff_copy_list->LACode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->FormerFileNumber->Visible) { // FormerFileNumber ?>
		<td data-name="FormerFileNumber" <?php echo $staff_copy_list->FormerFileNumber->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_FormerFileNumber">
<span<?php echo $staff_copy_list->FormerFileNumber->viewAttributes() ?>><?php echo $staff_copy_list->FormerFileNumber->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->NRC->Visible) { // NRC ?>
		<td data-name="NRC" <?php echo $staff_copy_list->NRC->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_NRC">
<span<?php echo $staff_copy_list->NRC->viewAttributes() ?>><?php echo $staff_copy_list->NRC->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->Title->Visible) { // Title ?>
		<td data-name="Title" <?php echo $staff_copy_list->Title->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_Title">
<span<?php echo $staff_copy_list->Title->viewAttributes() ?>><?php echo $staff_copy_list->Title->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $staff_copy_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_Surname">
<span<?php echo $staff_copy_list->Surname->viewAttributes() ?>><?php echo $staff_copy_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $staff_copy_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_FirstName">
<span<?php echo $staff_copy_list->FirstName->viewAttributes() ?>><?php echo $staff_copy_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $staff_copy_list->MiddleName->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_MiddleName">
<span<?php echo $staff_copy_list->MiddleName->viewAttributes() ?>><?php echo $staff_copy_list->MiddleName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->Sex->Visible) { // Sex ?>
		<td data-name="Sex" <?php echo $staff_copy_list->Sex->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_Sex">
<span<?php echo $staff_copy_list->Sex->viewAttributes() ?>><?php echo $staff_copy_list->Sex->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->MaritalStatus->Visible) { // MaritalStatus ?>
		<td data-name="MaritalStatus" <?php echo $staff_copy_list->MaritalStatus->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_MaritalStatus">
<span<?php echo $staff_copy_list->MaritalStatus->viewAttributes() ?>><?php echo $staff_copy_list->MaritalStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->MaidenName->Visible) { // MaidenName ?>
		<td data-name="MaidenName" <?php echo $staff_copy_list->MaidenName->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_MaidenName">
<span<?php echo $staff_copy_list->MaidenName->viewAttributes() ?>><?php echo $staff_copy_list->MaidenName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->DateOfBirth->Visible) { // DateOfBirth ?>
		<td data-name="DateOfBirth" <?php echo $staff_copy_list->DateOfBirth->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_DateOfBirth">
<span<?php echo $staff_copy_list->DateOfBirth->viewAttributes() ?>><?php echo $staff_copy_list->DateOfBirth->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->AcademicQualification->Visible) { // AcademicQualification ?>
		<td data-name="AcademicQualification" <?php echo $staff_copy_list->AcademicQualification->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_AcademicQualification">
<span<?php echo $staff_copy_list->AcademicQualification->viewAttributes() ?>><?php echo $staff_copy_list->AcademicQualification->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->ProfessionalQualification->Visible) { // ProfessionalQualification ?>
		<td data-name="ProfessionalQualification" <?php echo $staff_copy_list->ProfessionalQualification->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_ProfessionalQualification">
<span<?php echo $staff_copy_list->ProfessionalQualification->viewAttributes() ?>><?php echo $staff_copy_list->ProfessionalQualification->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->MedicalCondition->Visible) { // MedicalCondition ?>
		<td data-name="MedicalCondition" <?php echo $staff_copy_list->MedicalCondition->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_MedicalCondition">
<span<?php echo $staff_copy_list->MedicalCondition->viewAttributes() ?>><?php echo $staff_copy_list->MedicalCondition->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->OtherMedicalConditions->Visible) { // OtherMedicalConditions ?>
		<td data-name="OtherMedicalConditions" <?php echo $staff_copy_list->OtherMedicalConditions->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_OtherMedicalConditions">
<span<?php echo $staff_copy_list->OtherMedicalConditions->viewAttributes() ?>><?php echo $staff_copy_list->OtherMedicalConditions->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->PhysicalChallenge->Visible) { // PhysicalChallenge ?>
		<td data-name="PhysicalChallenge" <?php echo $staff_copy_list->PhysicalChallenge->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_PhysicalChallenge">
<span<?php echo $staff_copy_list->PhysicalChallenge->viewAttributes() ?>><?php echo $staff_copy_list->PhysicalChallenge->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->PostalAddress->Visible) { // PostalAddress ?>
		<td data-name="PostalAddress" <?php echo $staff_copy_list->PostalAddress->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_PostalAddress">
<span<?php echo $staff_copy_list->PostalAddress->viewAttributes() ?>><?php echo $staff_copy_list->PostalAddress->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->PhysicalAddress->Visible) { // PhysicalAddress ?>
		<td data-name="PhysicalAddress" <?php echo $staff_copy_list->PhysicalAddress->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_PhysicalAddress">
<span<?php echo $staff_copy_list->PhysicalAddress->viewAttributes() ?>><?php echo $staff_copy_list->PhysicalAddress->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->TownOrVillage->Visible) { // TownOrVillage ?>
		<td data-name="TownOrVillage" <?php echo $staff_copy_list->TownOrVillage->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_TownOrVillage">
<span<?php echo $staff_copy_list->TownOrVillage->viewAttributes() ?>><?php echo $staff_copy_list->TownOrVillage->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->Telephone->Visible) { // Telephone ?>
		<td data-name="Telephone" <?php echo $staff_copy_list->Telephone->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_Telephone">
<span<?php echo $staff_copy_list->Telephone->viewAttributes() ?>><?php echo $staff_copy_list->Telephone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->Mobile->Visible) { // Mobile ?>
		<td data-name="Mobile" <?php echo $staff_copy_list->Mobile->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_Mobile">
<span<?php echo $staff_copy_list->Mobile->viewAttributes() ?>><?php echo $staff_copy_list->Mobile->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->Fax->Visible) { // Fax ?>
		<td data-name="Fax" <?php echo $staff_copy_list->Fax->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_Fax">
<span<?php echo $staff_copy_list->Fax->viewAttributes() ?>><?php echo $staff_copy_list->Fax->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->_Email->Visible) { // Email ?>
		<td data-name="_Email" <?php echo $staff_copy_list->_Email->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy__Email">
<span<?php echo $staff_copy_list->_Email->viewAttributes() ?>><?php echo $staff_copy_list->_Email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->NumberOfBiologicalChildren->Visible) { // NumberOfBiologicalChildren ?>
		<td data-name="NumberOfBiologicalChildren" <?php echo $staff_copy_list->NumberOfBiologicalChildren->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_NumberOfBiologicalChildren">
<span<?php echo $staff_copy_list->NumberOfBiologicalChildren->viewAttributes() ?>><?php echo $staff_copy_list->NumberOfBiologicalChildren->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->NumberOfDependants->Visible) { // NumberOfDependants ?>
		<td data-name="NumberOfDependants" <?php echo $staff_copy_list->NumberOfDependants->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_NumberOfDependants">
<span<?php echo $staff_copy_list->NumberOfDependants->viewAttributes() ?>><?php echo $staff_copy_list->NumberOfDependants->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->NextOfKin->Visible) { // NextOfKin ?>
		<td data-name="NextOfKin" <?php echo $staff_copy_list->NextOfKin->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_NextOfKin">
<span<?php echo $staff_copy_list->NextOfKin->viewAttributes() ?>><?php echo $staff_copy_list->NextOfKin->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->RelationshipCode->Visible) { // RelationshipCode ?>
		<td data-name="RelationshipCode" <?php echo $staff_copy_list->RelationshipCode->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_RelationshipCode">
<span<?php echo $staff_copy_list->RelationshipCode->viewAttributes() ?>><?php echo $staff_copy_list->RelationshipCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
		<td data-name="NextOfKinMobile" <?php echo $staff_copy_list->NextOfKinMobile->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_NextOfKinMobile">
<span<?php echo $staff_copy_list->NextOfKinMobile->viewAttributes() ?>><?php echo $staff_copy_list->NextOfKinMobile->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
		<td data-name="NextOfKinEmail" <?php echo $staff_copy_list->NextOfKinEmail->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_NextOfKinEmail">
<span<?php echo $staff_copy_list->NextOfKinEmail->viewAttributes() ?>><?php echo $staff_copy_list->NextOfKinEmail->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->SpouseName->Visible) { // SpouseName ?>
		<td data-name="SpouseName" <?php echo $staff_copy_list->SpouseName->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_SpouseName">
<span<?php echo $staff_copy_list->SpouseName->viewAttributes() ?>><?php echo $staff_copy_list->SpouseName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->SpouseNRC->Visible) { // SpouseNRC ?>
		<td data-name="SpouseNRC" <?php echo $staff_copy_list->SpouseNRC->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_SpouseNRC">
<span<?php echo $staff_copy_list->SpouseNRC->viewAttributes() ?>><?php echo $staff_copy_list->SpouseNRC->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->SpouseMobile->Visible) { // SpouseMobile ?>
		<td data-name="SpouseMobile" <?php echo $staff_copy_list->SpouseMobile->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_SpouseMobile">
<span<?php echo $staff_copy_list->SpouseMobile->viewAttributes() ?>><?php echo $staff_copy_list->SpouseMobile->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->SpouseEmail->Visible) { // SpouseEmail ?>
		<td data-name="SpouseEmail" <?php echo $staff_copy_list->SpouseEmail->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_SpouseEmail">
<span<?php echo $staff_copy_list->SpouseEmail->viewAttributes() ?>><?php echo $staff_copy_list->SpouseEmail->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->SpouseResidentialAddress->Visible) { // SpouseResidentialAddress ?>
		<td data-name="SpouseResidentialAddress" <?php echo $staff_copy_list->SpouseResidentialAddress->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_SpouseResidentialAddress">
<span<?php echo $staff_copy_list->SpouseResidentialAddress->viewAttributes() ?>><?php echo $staff_copy_list->SpouseResidentialAddress->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->LastUserID->Visible) { // LastUserID ?>
		<td data-name="LastUserID" <?php echo $staff_copy_list->LastUserID->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_LastUserID">
<span<?php echo $staff_copy_list->LastUserID->viewAttributes() ?>><?php echo $staff_copy_list->LastUserID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->LastUpdated->Visible) { // LastUpdated ?>
		<td data-name="LastUpdated" <?php echo $staff_copy_list->LastUpdated->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_LastUpdated">
<span<?php echo $staff_copy_list->LastUpdated->viewAttributes() ?>><?php echo $staff_copy_list->LastUpdated->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->BankBranchCode->Visible) { // BankBranchCode ?>
		<td data-name="BankBranchCode" <?php echo $staff_copy_list->BankBranchCode->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_BankBranchCode">
<span<?php echo $staff_copy_list->BankBranchCode->viewAttributes() ?>><?php echo $staff_copy_list->BankBranchCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->BankAccountNo->Visible) { // BankAccountNo ?>
		<td data-name="BankAccountNo" <?php echo $staff_copy_list->BankAccountNo->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_BankAccountNo">
<span<?php echo $staff_copy_list->BankAccountNo->viewAttributes() ?>><?php echo $staff_copy_list->BankAccountNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->PaymentMethod->Visible) { // PaymentMethod ?>
		<td data-name="PaymentMethod" <?php echo $staff_copy_list->PaymentMethod->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_PaymentMethod">
<span<?php echo $staff_copy_list->PaymentMethod->viewAttributes() ?>><?php echo $staff_copy_list->PaymentMethod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->TaxNumber->Visible) { // TaxNumber ?>
		<td data-name="TaxNumber" <?php echo $staff_copy_list->TaxNumber->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_TaxNumber">
<span<?php echo $staff_copy_list->TaxNumber->viewAttributes() ?>><?php echo $staff_copy_list->TaxNumber->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->PensionNumber->Visible) { // PensionNumber ?>
		<td data-name="PensionNumber" <?php echo $staff_copy_list->PensionNumber->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_PensionNumber">
<span<?php echo $staff_copy_list->PensionNumber->viewAttributes() ?>><?php echo $staff_copy_list->PensionNumber->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
		<td data-name="SocialSecurityNo" <?php echo $staff_copy_list->SocialSecurityNo->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_SocialSecurityNo">
<span<?php echo $staff_copy_list->SocialSecurityNo->viewAttributes() ?>><?php echo $staff_copy_list->SocialSecurityNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staff_copy_list->ThirdParties->Visible) { // ThirdParties ?>
		<td data-name="ThirdParties" <?php echo $staff_copy_list->ThirdParties->cellAttributes() ?>>
<span id="el<?php echo $staff_copy_list->RowCount ?>_staff_copy_ThirdParties">
<span<?php echo $staff_copy_list->ThirdParties->viewAttributes() ?>><?php echo $staff_copy_list->ThirdParties->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staff_copy_list->ListOptions->render("body", "right", $staff_copy_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$staff_copy_list->isGridAdd())
		$staff_copy_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$staff_copy->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($staff_copy_list->Recordset)
	$staff_copy_list->Recordset->Close();
?>
<?php if (!$staff_copy_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$staff_copy_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staff_copy_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $staff_copy_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($staff_copy_list->TotalRecords == 0 && !$staff_copy->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $staff_copy_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$staff_copy_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$staff_copy_list->isExport()) { ?>
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
$staff_copy_list->terminate();
?>