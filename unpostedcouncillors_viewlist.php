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
$unpostedcouncillors_view_list = new unpostedcouncillors_view_list();

// Run the page
$unpostedcouncillors_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$unpostedcouncillors_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$unpostedcouncillors_view_list->isExport()) { ?>
<script>
var funpostedcouncillors_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	funpostedcouncillors_viewlist = currentForm = new ew.Form("funpostedcouncillors_viewlist", "list");
	funpostedcouncillors_viewlist.formKeyCountName = '<?php echo $unpostedcouncillors_view_list->FormKeyCountName ?>';
	loadjs.done("funpostedcouncillors_viewlist");
});
var funpostedcouncillors_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	funpostedcouncillors_viewlistsrch = currentSearchForm = new ew.Form("funpostedcouncillors_viewlistsrch");

	// Dynamic selection lists
	// Filters

	funpostedcouncillors_viewlistsrch.filterList = <?php echo $unpostedcouncillors_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	funpostedcouncillors_viewlistsrch.initSearchPanel = true;
	loadjs.done("funpostedcouncillors_viewlistsrch");
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
<?php if (!$unpostedcouncillors_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($unpostedcouncillors_view_list->TotalRecords > 0 && $unpostedcouncillors_view_list->ExportOptions->visible()) { ?>
<?php $unpostedcouncillors_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($unpostedcouncillors_view_list->ImportOptions->visible()) { ?>
<?php $unpostedcouncillors_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($unpostedcouncillors_view_list->SearchOptions->visible()) { ?>
<?php $unpostedcouncillors_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($unpostedcouncillors_view_list->FilterOptions->visible()) { ?>
<?php $unpostedcouncillors_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$unpostedcouncillors_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$unpostedcouncillors_view_list->isExport() && !$unpostedcouncillors_view->CurrentAction) { ?>
<form name="funpostedcouncillors_viewlistsrch" id="funpostedcouncillors_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="funpostedcouncillors_viewlistsrch-search-panel" class="<?php echo $unpostedcouncillors_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="unpostedcouncillors_view">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $unpostedcouncillors_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($unpostedcouncillors_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($unpostedcouncillors_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $unpostedcouncillors_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($unpostedcouncillors_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($unpostedcouncillors_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($unpostedcouncillors_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($unpostedcouncillors_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $unpostedcouncillors_view_list->showPageHeader(); ?>
<?php
$unpostedcouncillors_view_list->showMessage();
?>
<?php if ($unpostedcouncillors_view_list->TotalRecords > 0 || $unpostedcouncillors_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($unpostedcouncillors_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> unpostedcouncillors_view">
<?php if (!$unpostedcouncillors_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$unpostedcouncillors_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $unpostedcouncillors_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $unpostedcouncillors_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="funpostedcouncillors_viewlist" id="funpostedcouncillors_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="unpostedcouncillors_view">
<div id="gmp_unpostedcouncillors_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($unpostedcouncillors_view_list->TotalRecords > 0 || $unpostedcouncillors_view_list->isGridEdit()) { ?>
<table id="tbl_unpostedcouncillors_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$unpostedcouncillors_view->RowType = ROWTYPE_HEADER;

// Render list options
$unpostedcouncillors_view_list->renderListOptions();

// Render list options (header, left)
$unpostedcouncillors_view_list->ListOptions->render("header", "left");
?>
<?php if ($unpostedcouncillors_view_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $unpostedcouncillors_view_list->EmployeeID->headerCellClass() ?>"><div id="elh_unpostedcouncillors_view_EmployeeID" class="unpostedcouncillors_view_EmployeeID"><div class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $unpostedcouncillors_view_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->EmployeeID) ?>', 1);"><div id="elh_unpostedcouncillors_view_EmployeeID" class="unpostedcouncillors_view_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($unpostedcouncillors_view_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($unpostedcouncillors_view_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($unpostedcouncillors_view_list->LACode->Visible) { // LACode ?>
	<?php if ($unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $unpostedcouncillors_view_list->LACode->headerCellClass() ?>"><div id="elh_unpostedcouncillors_view_LACode" class="unpostedcouncillors_view_LACode"><div class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $unpostedcouncillors_view_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->LACode) ?>', 1);"><div id="elh_unpostedcouncillors_view_LACode" class="unpostedcouncillors_view_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->LACode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($unpostedcouncillors_view_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($unpostedcouncillors_view_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($unpostedcouncillors_view_list->NRC->Visible) { // NRC ?>
	<?php if ($unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->NRC) == "") { ?>
		<th data-name="NRC" class="<?php echo $unpostedcouncillors_view_list->NRC->headerCellClass() ?>"><div id="elh_unpostedcouncillors_view_NRC" class="unpostedcouncillors_view_NRC"><div class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->NRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC" class="<?php echo $unpostedcouncillors_view_list->NRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->NRC) ?>', 1);"><div id="elh_unpostedcouncillors_view_NRC" class="unpostedcouncillors_view_NRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->NRC->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($unpostedcouncillors_view_list->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($unpostedcouncillors_view_list->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($unpostedcouncillors_view_list->Title->Visible) { // Title ?>
	<?php if ($unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->Title) == "") { ?>
		<th data-name="Title" class="<?php echo $unpostedcouncillors_view_list->Title->headerCellClass() ?>"><div id="elh_unpostedcouncillors_view_Title" class="unpostedcouncillors_view_Title"><div class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->Title->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Title" class="<?php echo $unpostedcouncillors_view_list->Title->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->Title) ?>', 1);"><div id="elh_unpostedcouncillors_view_Title" class="unpostedcouncillors_view_Title">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->Title->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($unpostedcouncillors_view_list->Title->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($unpostedcouncillors_view_list->Title->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($unpostedcouncillors_view_list->Surname->Visible) { // Surname ?>
	<?php if ($unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $unpostedcouncillors_view_list->Surname->headerCellClass() ?>"><div id="elh_unpostedcouncillors_view_Surname" class="unpostedcouncillors_view_Surname"><div class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $unpostedcouncillors_view_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->Surname) ?>', 1);"><div id="elh_unpostedcouncillors_view_Surname" class="unpostedcouncillors_view_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($unpostedcouncillors_view_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($unpostedcouncillors_view_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($unpostedcouncillors_view_list->FirstName->Visible) { // FirstName ?>
	<?php if ($unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $unpostedcouncillors_view_list->FirstName->headerCellClass() ?>"><div id="elh_unpostedcouncillors_view_FirstName" class="unpostedcouncillors_view_FirstName"><div class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $unpostedcouncillors_view_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->FirstName) ?>', 1);"><div id="elh_unpostedcouncillors_view_FirstName" class="unpostedcouncillors_view_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($unpostedcouncillors_view_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($unpostedcouncillors_view_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($unpostedcouncillors_view_list->MiddleName->Visible) { // MiddleName ?>
	<?php if ($unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $unpostedcouncillors_view_list->MiddleName->headerCellClass() ?>"><div id="elh_unpostedcouncillors_view_MiddleName" class="unpostedcouncillors_view_MiddleName"><div class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $unpostedcouncillors_view_list->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->MiddleName) ?>', 1);"><div id="elh_unpostedcouncillors_view_MiddleName" class="unpostedcouncillors_view_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->MiddleName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($unpostedcouncillors_view_list->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($unpostedcouncillors_view_list->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($unpostedcouncillors_view_list->Sex->Visible) { // Sex ?>
	<?php if ($unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->Sex) == "") { ?>
		<th data-name="Sex" class="<?php echo $unpostedcouncillors_view_list->Sex->headerCellClass() ?>"><div id="elh_unpostedcouncillors_view_Sex" class="unpostedcouncillors_view_Sex"><div class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->Sex->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sex" class="<?php echo $unpostedcouncillors_view_list->Sex->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->Sex) ?>', 1);"><div id="elh_unpostedcouncillors_view_Sex" class="unpostedcouncillors_view_Sex">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->Sex->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($unpostedcouncillors_view_list->Sex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($unpostedcouncillors_view_list->Sex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($unpostedcouncillors_view_list->MaritalStatus->Visible) { // MaritalStatus ?>
	<?php if ($unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->MaritalStatus) == "") { ?>
		<th data-name="MaritalStatus" class="<?php echo $unpostedcouncillors_view_list->MaritalStatus->headerCellClass() ?>"><div id="elh_unpostedcouncillors_view_MaritalStatus" class="unpostedcouncillors_view_MaritalStatus"><div class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->MaritalStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MaritalStatus" class="<?php echo $unpostedcouncillors_view_list->MaritalStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->MaritalStatus) ?>', 1);"><div id="elh_unpostedcouncillors_view_MaritalStatus" class="unpostedcouncillors_view_MaritalStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->MaritalStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($unpostedcouncillors_view_list->MaritalStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($unpostedcouncillors_view_list->MaritalStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($unpostedcouncillors_view_list->DateOfBirth->Visible) { // DateOfBirth ?>
	<?php if ($unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->DateOfBirth) == "") { ?>
		<th data-name="DateOfBirth" class="<?php echo $unpostedcouncillors_view_list->DateOfBirth->headerCellClass() ?>"><div id="elh_unpostedcouncillors_view_DateOfBirth" class="unpostedcouncillors_view_DateOfBirth"><div class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->DateOfBirth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfBirth" class="<?php echo $unpostedcouncillors_view_list->DateOfBirth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->DateOfBirth) ?>', 1);"><div id="elh_unpostedcouncillors_view_DateOfBirth" class="unpostedcouncillors_view_DateOfBirth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->DateOfBirth->caption() ?></span><span class="ew-table-header-sort"><?php if ($unpostedcouncillors_view_list->DateOfBirth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($unpostedcouncillors_view_list->DateOfBirth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($unpostedcouncillors_view_list->Telephone->Visible) { // Telephone ?>
	<?php if ($unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->Telephone) == "") { ?>
		<th data-name="Telephone" class="<?php echo $unpostedcouncillors_view_list->Telephone->headerCellClass() ?>"><div id="elh_unpostedcouncillors_view_Telephone" class="unpostedcouncillors_view_Telephone"><div class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->Telephone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Telephone" class="<?php echo $unpostedcouncillors_view_list->Telephone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->Telephone) ?>', 1);"><div id="elh_unpostedcouncillors_view_Telephone" class="unpostedcouncillors_view_Telephone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->Telephone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($unpostedcouncillors_view_list->Telephone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($unpostedcouncillors_view_list->Telephone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($unpostedcouncillors_view_list->Mobile->Visible) { // Mobile ?>
	<?php if ($unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->Mobile) == "") { ?>
		<th data-name="Mobile" class="<?php echo $unpostedcouncillors_view_list->Mobile->headerCellClass() ?>"><div id="elh_unpostedcouncillors_view_Mobile" class="unpostedcouncillors_view_Mobile"><div class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->Mobile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Mobile" class="<?php echo $unpostedcouncillors_view_list->Mobile->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->Mobile) ?>', 1);"><div id="elh_unpostedcouncillors_view_Mobile" class="unpostedcouncillors_view_Mobile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->Mobile->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($unpostedcouncillors_view_list->Mobile->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($unpostedcouncillors_view_list->Mobile->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($unpostedcouncillors_view_list->_Email->Visible) { // Email ?>
	<?php if ($unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->_Email) == "") { ?>
		<th data-name="_Email" class="<?php echo $unpostedcouncillors_view_list->_Email->headerCellClass() ?>"><div id="elh_unpostedcouncillors_view__Email" class="unpostedcouncillors_view__Email"><div class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->_Email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_Email" class="<?php echo $unpostedcouncillors_view_list->_Email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->_Email) ?>', 1);"><div id="elh_unpostedcouncillors_view__Email" class="unpostedcouncillors_view__Email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->_Email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($unpostedcouncillors_view_list->_Email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($unpostedcouncillors_view_list->_Email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($unpostedcouncillors_view_list->CouncilServed->Visible) { // CouncilServed ?>
	<?php if ($unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->CouncilServed) == "") { ?>
		<th data-name="CouncilServed" class="<?php echo $unpostedcouncillors_view_list->CouncilServed->headerCellClass() ?>"><div id="elh_unpostedcouncillors_view_CouncilServed" class="unpostedcouncillors_view_CouncilServed"><div class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->CouncilServed->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CouncilServed" class="<?php echo $unpostedcouncillors_view_list->CouncilServed->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->CouncilServed) ?>', 1);"><div id="elh_unpostedcouncillors_view_CouncilServed" class="unpostedcouncillors_view_CouncilServed">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->CouncilServed->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($unpostedcouncillors_view_list->CouncilServed->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($unpostedcouncillors_view_list->CouncilServed->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($unpostedcouncillors_view_list->PoliticalParty->Visible) { // PoliticalParty ?>
	<?php if ($unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->PoliticalParty) == "") { ?>
		<th data-name="PoliticalParty" class="<?php echo $unpostedcouncillors_view_list->PoliticalParty->headerCellClass() ?>"><div id="elh_unpostedcouncillors_view_PoliticalParty" class="unpostedcouncillors_view_PoliticalParty"><div class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->PoliticalParty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PoliticalParty" class="<?php echo $unpostedcouncillors_view_list->PoliticalParty->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->PoliticalParty) ?>', 1);"><div id="elh_unpostedcouncillors_view_PoliticalParty" class="unpostedcouncillors_view_PoliticalParty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->PoliticalParty->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($unpostedcouncillors_view_list->PoliticalParty->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($unpostedcouncillors_view_list->PoliticalParty->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($unpostedcouncillors_view_list->Occupation->Visible) { // Occupation ?>
	<?php if ($unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->Occupation) == "") { ?>
		<th data-name="Occupation" class="<?php echo $unpostedcouncillors_view_list->Occupation->headerCellClass() ?>"><div id="elh_unpostedcouncillors_view_Occupation" class="unpostedcouncillors_view_Occupation"><div class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->Occupation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Occupation" class="<?php echo $unpostedcouncillors_view_list->Occupation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->Occupation) ?>', 1);"><div id="elh_unpostedcouncillors_view_Occupation" class="unpostedcouncillors_view_Occupation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->Occupation->caption() ?></span><span class="ew-table-header-sort"><?php if ($unpostedcouncillors_view_list->Occupation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($unpostedcouncillors_view_list->Occupation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($unpostedcouncillors_view_list->PositionInCouncil->Visible) { // PositionInCouncil ?>
	<?php if ($unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->PositionInCouncil) == "") { ?>
		<th data-name="PositionInCouncil" class="<?php echo $unpostedcouncillors_view_list->PositionInCouncil->headerCellClass() ?>"><div id="elh_unpostedcouncillors_view_PositionInCouncil" class="unpostedcouncillors_view_PositionInCouncil"><div class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->PositionInCouncil->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionInCouncil" class="<?php echo $unpostedcouncillors_view_list->PositionInCouncil->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->PositionInCouncil) ?>', 1);"><div id="elh_unpostedcouncillors_view_PositionInCouncil" class="unpostedcouncillors_view_PositionInCouncil">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->PositionInCouncil->caption() ?></span><span class="ew-table-header-sort"><?php if ($unpostedcouncillors_view_list->PositionInCouncil->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($unpostedcouncillors_view_list->PositionInCouncil->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($unpostedcouncillors_view_list->Committee->Visible) { // Committee ?>
	<?php if ($unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->Committee) == "") { ?>
		<th data-name="Committee" class="<?php echo $unpostedcouncillors_view_list->Committee->headerCellClass() ?>"><div id="elh_unpostedcouncillors_view_Committee" class="unpostedcouncillors_view_Committee"><div class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->Committee->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Committee" class="<?php echo $unpostedcouncillors_view_list->Committee->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->Committee) ?>', 1);"><div id="elh_unpostedcouncillors_view_Committee" class="unpostedcouncillors_view_Committee">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->Committee->caption() ?></span><span class="ew-table-header-sort"><?php if ($unpostedcouncillors_view_list->Committee->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($unpostedcouncillors_view_list->Committee->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($unpostedcouncillors_view_list->CommitteeRole->Visible) { // CommitteeRole ?>
	<?php if ($unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->CommitteeRole) == "") { ?>
		<th data-name="CommitteeRole" class="<?php echo $unpostedcouncillors_view_list->CommitteeRole->headerCellClass() ?>"><div id="elh_unpostedcouncillors_view_CommitteeRole" class="unpostedcouncillors_view_CommitteeRole"><div class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->CommitteeRole->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CommitteeRole" class="<?php echo $unpostedcouncillors_view_list->CommitteeRole->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->CommitteeRole) ?>', 1);"><div id="elh_unpostedcouncillors_view_CommitteeRole" class="unpostedcouncillors_view_CommitteeRole">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->CommitteeRole->caption() ?></span><span class="ew-table-header-sort"><?php if ($unpostedcouncillors_view_list->CommitteeRole->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($unpostedcouncillors_view_list->CommitteeRole->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($unpostedcouncillors_view_list->CouncilTerm->Visible) { // CouncilTerm ?>
	<?php if ($unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->CouncilTerm) == "") { ?>
		<th data-name="CouncilTerm" class="<?php echo $unpostedcouncillors_view_list->CouncilTerm->headerCellClass() ?>"><div id="elh_unpostedcouncillors_view_CouncilTerm" class="unpostedcouncillors_view_CouncilTerm"><div class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->CouncilTerm->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CouncilTerm" class="<?php echo $unpostedcouncillors_view_list->CouncilTerm->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->CouncilTerm) ?>', 1);"><div id="elh_unpostedcouncillors_view_CouncilTerm" class="unpostedcouncillors_view_CouncilTerm">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->CouncilTerm->caption() ?></span><span class="ew-table-header-sort"><?php if ($unpostedcouncillors_view_list->CouncilTerm->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($unpostedcouncillors_view_list->CouncilTerm->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($unpostedcouncillors_view_list->DateOfExit->Visible) { // DateOfExit ?>
	<?php if ($unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->DateOfExit) == "") { ?>
		<th data-name="DateOfExit" class="<?php echo $unpostedcouncillors_view_list->DateOfExit->headerCellClass() ?>"><div id="elh_unpostedcouncillors_view_DateOfExit" class="unpostedcouncillors_view_DateOfExit"><div class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->DateOfExit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfExit" class="<?php echo $unpostedcouncillors_view_list->DateOfExit->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $unpostedcouncillors_view_list->SortUrl($unpostedcouncillors_view_list->DateOfExit) ?>', 1);"><div id="elh_unpostedcouncillors_view_DateOfExit" class="unpostedcouncillors_view_DateOfExit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $unpostedcouncillors_view_list->DateOfExit->caption() ?></span><span class="ew-table-header-sort"><?php if ($unpostedcouncillors_view_list->DateOfExit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($unpostedcouncillors_view_list->DateOfExit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$unpostedcouncillors_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($unpostedcouncillors_view_list->ExportAll && $unpostedcouncillors_view_list->isExport()) {
	$unpostedcouncillors_view_list->StopRecord = $unpostedcouncillors_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($unpostedcouncillors_view_list->TotalRecords > $unpostedcouncillors_view_list->StartRecord + $unpostedcouncillors_view_list->DisplayRecords - 1)
		$unpostedcouncillors_view_list->StopRecord = $unpostedcouncillors_view_list->StartRecord + $unpostedcouncillors_view_list->DisplayRecords - 1;
	else
		$unpostedcouncillors_view_list->StopRecord = $unpostedcouncillors_view_list->TotalRecords;
}
$unpostedcouncillors_view_list->RecordCount = $unpostedcouncillors_view_list->StartRecord - 1;
if ($unpostedcouncillors_view_list->Recordset && !$unpostedcouncillors_view_list->Recordset->EOF) {
	$unpostedcouncillors_view_list->Recordset->moveFirst();
	$selectLimit = $unpostedcouncillors_view_list->UseSelectLimit;
	if (!$selectLimit && $unpostedcouncillors_view_list->StartRecord > 1)
		$unpostedcouncillors_view_list->Recordset->move($unpostedcouncillors_view_list->StartRecord - 1);
} elseif (!$unpostedcouncillors_view->AllowAddDeleteRow && $unpostedcouncillors_view_list->StopRecord == 0) {
	$unpostedcouncillors_view_list->StopRecord = $unpostedcouncillors_view->GridAddRowCount;
}

// Initialize aggregate
$unpostedcouncillors_view->RowType = ROWTYPE_AGGREGATEINIT;
$unpostedcouncillors_view->resetAttributes();
$unpostedcouncillors_view_list->renderRow();
while ($unpostedcouncillors_view_list->RecordCount < $unpostedcouncillors_view_list->StopRecord) {
	$unpostedcouncillors_view_list->RecordCount++;
	if ($unpostedcouncillors_view_list->RecordCount >= $unpostedcouncillors_view_list->StartRecord) {
		$unpostedcouncillors_view_list->RowCount++;

		// Set up key count
		$unpostedcouncillors_view_list->KeyCount = $unpostedcouncillors_view_list->RowIndex;

		// Init row class and style
		$unpostedcouncillors_view->resetAttributes();
		$unpostedcouncillors_view->CssClass = "";
		if ($unpostedcouncillors_view_list->isGridAdd()) {
		} else {
			$unpostedcouncillors_view_list->loadRowValues($unpostedcouncillors_view_list->Recordset); // Load row values
		}
		$unpostedcouncillors_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$unpostedcouncillors_view->RowAttrs->merge(["data-rowindex" => $unpostedcouncillors_view_list->RowCount, "id" => "r" . $unpostedcouncillors_view_list->RowCount . "_unpostedcouncillors_view", "data-rowtype" => $unpostedcouncillors_view->RowType]);

		// Render row
		$unpostedcouncillors_view_list->renderRow();

		// Render list options
		$unpostedcouncillors_view_list->renderListOptions();
?>
	<tr <?php echo $unpostedcouncillors_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$unpostedcouncillors_view_list->ListOptions->render("body", "left", $unpostedcouncillors_view_list->RowCount);
?>
	<?php if ($unpostedcouncillors_view_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $unpostedcouncillors_view_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $unpostedcouncillors_view_list->RowCount ?>_unpostedcouncillors_view_EmployeeID">
<span<?php echo $unpostedcouncillors_view_list->EmployeeID->viewAttributes() ?>><?php echo $unpostedcouncillors_view_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($unpostedcouncillors_view_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $unpostedcouncillors_view_list->LACode->cellAttributes() ?>>
<span id="el<?php echo $unpostedcouncillors_view_list->RowCount ?>_unpostedcouncillors_view_LACode">
<span<?php echo $unpostedcouncillors_view_list->LACode->viewAttributes() ?>><?php echo $unpostedcouncillors_view_list->LACode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($unpostedcouncillors_view_list->NRC->Visible) { // NRC ?>
		<td data-name="NRC" <?php echo $unpostedcouncillors_view_list->NRC->cellAttributes() ?>>
<span id="el<?php echo $unpostedcouncillors_view_list->RowCount ?>_unpostedcouncillors_view_NRC">
<span<?php echo $unpostedcouncillors_view_list->NRC->viewAttributes() ?>><?php echo $unpostedcouncillors_view_list->NRC->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($unpostedcouncillors_view_list->Title->Visible) { // Title ?>
		<td data-name="Title" <?php echo $unpostedcouncillors_view_list->Title->cellAttributes() ?>>
<span id="el<?php echo $unpostedcouncillors_view_list->RowCount ?>_unpostedcouncillors_view_Title">
<span<?php echo $unpostedcouncillors_view_list->Title->viewAttributes() ?>><?php echo $unpostedcouncillors_view_list->Title->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($unpostedcouncillors_view_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $unpostedcouncillors_view_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $unpostedcouncillors_view_list->RowCount ?>_unpostedcouncillors_view_Surname">
<span<?php echo $unpostedcouncillors_view_list->Surname->viewAttributes() ?>><?php echo $unpostedcouncillors_view_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($unpostedcouncillors_view_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $unpostedcouncillors_view_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $unpostedcouncillors_view_list->RowCount ?>_unpostedcouncillors_view_FirstName">
<span<?php echo $unpostedcouncillors_view_list->FirstName->viewAttributes() ?>><?php echo $unpostedcouncillors_view_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($unpostedcouncillors_view_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $unpostedcouncillors_view_list->MiddleName->cellAttributes() ?>>
<span id="el<?php echo $unpostedcouncillors_view_list->RowCount ?>_unpostedcouncillors_view_MiddleName">
<span<?php echo $unpostedcouncillors_view_list->MiddleName->viewAttributes() ?>><?php echo $unpostedcouncillors_view_list->MiddleName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($unpostedcouncillors_view_list->Sex->Visible) { // Sex ?>
		<td data-name="Sex" <?php echo $unpostedcouncillors_view_list->Sex->cellAttributes() ?>>
<span id="el<?php echo $unpostedcouncillors_view_list->RowCount ?>_unpostedcouncillors_view_Sex">
<span<?php echo $unpostedcouncillors_view_list->Sex->viewAttributes() ?>><?php echo $unpostedcouncillors_view_list->Sex->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($unpostedcouncillors_view_list->MaritalStatus->Visible) { // MaritalStatus ?>
		<td data-name="MaritalStatus" <?php echo $unpostedcouncillors_view_list->MaritalStatus->cellAttributes() ?>>
<span id="el<?php echo $unpostedcouncillors_view_list->RowCount ?>_unpostedcouncillors_view_MaritalStatus">
<span<?php echo $unpostedcouncillors_view_list->MaritalStatus->viewAttributes() ?>><?php echo $unpostedcouncillors_view_list->MaritalStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($unpostedcouncillors_view_list->DateOfBirth->Visible) { // DateOfBirth ?>
		<td data-name="DateOfBirth" <?php echo $unpostedcouncillors_view_list->DateOfBirth->cellAttributes() ?>>
<span id="el<?php echo $unpostedcouncillors_view_list->RowCount ?>_unpostedcouncillors_view_DateOfBirth">
<span<?php echo $unpostedcouncillors_view_list->DateOfBirth->viewAttributes() ?>><?php echo $unpostedcouncillors_view_list->DateOfBirth->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($unpostedcouncillors_view_list->Telephone->Visible) { // Telephone ?>
		<td data-name="Telephone" <?php echo $unpostedcouncillors_view_list->Telephone->cellAttributes() ?>>
<span id="el<?php echo $unpostedcouncillors_view_list->RowCount ?>_unpostedcouncillors_view_Telephone">
<span<?php echo $unpostedcouncillors_view_list->Telephone->viewAttributes() ?>><?php echo $unpostedcouncillors_view_list->Telephone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($unpostedcouncillors_view_list->Mobile->Visible) { // Mobile ?>
		<td data-name="Mobile" <?php echo $unpostedcouncillors_view_list->Mobile->cellAttributes() ?>>
<span id="el<?php echo $unpostedcouncillors_view_list->RowCount ?>_unpostedcouncillors_view_Mobile">
<span<?php echo $unpostedcouncillors_view_list->Mobile->viewAttributes() ?>><?php echo $unpostedcouncillors_view_list->Mobile->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($unpostedcouncillors_view_list->_Email->Visible) { // Email ?>
		<td data-name="_Email" <?php echo $unpostedcouncillors_view_list->_Email->cellAttributes() ?>>
<span id="el<?php echo $unpostedcouncillors_view_list->RowCount ?>_unpostedcouncillors_view__Email">
<span<?php echo $unpostedcouncillors_view_list->_Email->viewAttributes() ?>><?php echo $unpostedcouncillors_view_list->_Email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($unpostedcouncillors_view_list->CouncilServed->Visible) { // CouncilServed ?>
		<td data-name="CouncilServed" <?php echo $unpostedcouncillors_view_list->CouncilServed->cellAttributes() ?>>
<span id="el<?php echo $unpostedcouncillors_view_list->RowCount ?>_unpostedcouncillors_view_CouncilServed">
<span<?php echo $unpostedcouncillors_view_list->CouncilServed->viewAttributes() ?>><?php echo $unpostedcouncillors_view_list->CouncilServed->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($unpostedcouncillors_view_list->PoliticalParty->Visible) { // PoliticalParty ?>
		<td data-name="PoliticalParty" <?php echo $unpostedcouncillors_view_list->PoliticalParty->cellAttributes() ?>>
<span id="el<?php echo $unpostedcouncillors_view_list->RowCount ?>_unpostedcouncillors_view_PoliticalParty">
<span<?php echo $unpostedcouncillors_view_list->PoliticalParty->viewAttributes() ?>><?php echo $unpostedcouncillors_view_list->PoliticalParty->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($unpostedcouncillors_view_list->Occupation->Visible) { // Occupation ?>
		<td data-name="Occupation" <?php echo $unpostedcouncillors_view_list->Occupation->cellAttributes() ?>>
<span id="el<?php echo $unpostedcouncillors_view_list->RowCount ?>_unpostedcouncillors_view_Occupation">
<span<?php echo $unpostedcouncillors_view_list->Occupation->viewAttributes() ?>><?php echo $unpostedcouncillors_view_list->Occupation->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($unpostedcouncillors_view_list->PositionInCouncil->Visible) { // PositionInCouncil ?>
		<td data-name="PositionInCouncil" <?php echo $unpostedcouncillors_view_list->PositionInCouncil->cellAttributes() ?>>
<span id="el<?php echo $unpostedcouncillors_view_list->RowCount ?>_unpostedcouncillors_view_PositionInCouncil">
<span<?php echo $unpostedcouncillors_view_list->PositionInCouncil->viewAttributes() ?>><?php echo $unpostedcouncillors_view_list->PositionInCouncil->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($unpostedcouncillors_view_list->Committee->Visible) { // Committee ?>
		<td data-name="Committee" <?php echo $unpostedcouncillors_view_list->Committee->cellAttributes() ?>>
<span id="el<?php echo $unpostedcouncillors_view_list->RowCount ?>_unpostedcouncillors_view_Committee">
<span<?php echo $unpostedcouncillors_view_list->Committee->viewAttributes() ?>><?php echo $unpostedcouncillors_view_list->Committee->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($unpostedcouncillors_view_list->CommitteeRole->Visible) { // CommitteeRole ?>
		<td data-name="CommitteeRole" <?php echo $unpostedcouncillors_view_list->CommitteeRole->cellAttributes() ?>>
<span id="el<?php echo $unpostedcouncillors_view_list->RowCount ?>_unpostedcouncillors_view_CommitteeRole">
<span<?php echo $unpostedcouncillors_view_list->CommitteeRole->viewAttributes() ?>><?php echo $unpostedcouncillors_view_list->CommitteeRole->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($unpostedcouncillors_view_list->CouncilTerm->Visible) { // CouncilTerm ?>
		<td data-name="CouncilTerm" <?php echo $unpostedcouncillors_view_list->CouncilTerm->cellAttributes() ?>>
<span id="el<?php echo $unpostedcouncillors_view_list->RowCount ?>_unpostedcouncillors_view_CouncilTerm">
<span<?php echo $unpostedcouncillors_view_list->CouncilTerm->viewAttributes() ?>><?php echo $unpostedcouncillors_view_list->CouncilTerm->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($unpostedcouncillors_view_list->DateOfExit->Visible) { // DateOfExit ?>
		<td data-name="DateOfExit" <?php echo $unpostedcouncillors_view_list->DateOfExit->cellAttributes() ?>>
<span id="el<?php echo $unpostedcouncillors_view_list->RowCount ?>_unpostedcouncillors_view_DateOfExit">
<span<?php echo $unpostedcouncillors_view_list->DateOfExit->viewAttributes() ?>><?php echo $unpostedcouncillors_view_list->DateOfExit->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$unpostedcouncillors_view_list->ListOptions->render("body", "right", $unpostedcouncillors_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$unpostedcouncillors_view_list->isGridAdd())
		$unpostedcouncillors_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$unpostedcouncillors_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($unpostedcouncillors_view_list->Recordset)
	$unpostedcouncillors_view_list->Recordset->Close();
?>
<?php if (!$unpostedcouncillors_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$unpostedcouncillors_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $unpostedcouncillors_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $unpostedcouncillors_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($unpostedcouncillors_view_list->TotalRecords == 0 && !$unpostedcouncillors_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $unpostedcouncillors_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$unpostedcouncillors_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$unpostedcouncillors_view_list->isExport()) { ?>
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
$unpostedcouncillors_view_list->terminate();
?>