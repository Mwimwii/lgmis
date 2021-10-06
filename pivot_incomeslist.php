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
$pivot_incomes_list = new pivot_incomes_list();

// Run the page
$pivot_incomes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pivot_incomes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$pivot_incomes_list->isExport()) { ?>
<script>
var fpivot_incomeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpivot_incomeslist = currentForm = new ew.Form("fpivot_incomeslist", "list");
	fpivot_incomeslist.formKeyCountName = '<?php echo $pivot_incomes_list->FormKeyCountName ?>';
	loadjs.done("fpivot_incomeslist");
});
var fpivot_incomeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpivot_incomeslistsrch = currentSearchForm = new ew.Form("fpivot_incomeslistsrch");

	// Dynamic selection lists
	// Filters

	fpivot_incomeslistsrch.filterList = <?php echo $pivot_incomes_list->getFilterList() ?>;

	// Init search panel as collapsed
	fpivot_incomeslistsrch.initSearchPanel = true;
	loadjs.done("fpivot_incomeslistsrch");
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
<?php if (!$pivot_incomes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($pivot_incomes_list->TotalRecords > 0 && $pivot_incomes_list->ExportOptions->visible()) { ?>
<?php $pivot_incomes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($pivot_incomes_list->ImportOptions->visible()) { ?>
<?php $pivot_incomes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($pivot_incomes_list->SearchOptions->visible()) { ?>
<?php $pivot_incomes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($pivot_incomes_list->FilterOptions->visible()) { ?>
<?php $pivot_incomes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$pivot_incomes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$pivot_incomes_list->isExport() && !$pivot_incomes->CurrentAction) { ?>
<form name="fpivot_incomeslistsrch" id="fpivot_incomeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpivot_incomeslistsrch-search-panel" class="<?php echo $pivot_incomes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="pivot_incomes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $pivot_incomes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($pivot_incomes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($pivot_incomes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $pivot_incomes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($pivot_incomes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($pivot_incomes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($pivot_incomes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($pivot_incomes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $pivot_incomes_list->showPageHeader(); ?>
<?php
$pivot_incomes_list->showMessage();
?>
<?php if ($pivot_incomes_list->TotalRecords > 0 || $pivot_incomes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($pivot_incomes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> pivot_incomes">
<?php if (!$pivot_incomes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$pivot_incomes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $pivot_incomes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $pivot_incomes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpivot_incomeslist" id="fpivot_incomeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pivot_incomes">
<div id="gmp_pivot_incomes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($pivot_incomes_list->TotalRecords > 0 || $pivot_incomes_list->isGridEdit()) { ?>
<table id="tbl_pivot_incomeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$pivot_incomes->RowType = ROWTYPE_HEADER;

// Render list options
$pivot_incomes_list->renderListOptions();

// Render list options (header, left)
$pivot_incomes_list->ListOptions->render("header", "left");
?>
<?php if ($pivot_incomes_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($pivot_incomes_list->SortUrl($pivot_incomes_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $pivot_incomes_list->EmployeeID->headerCellClass() ?>"><div id="elh_pivot_incomes_EmployeeID" class="pivot_incomes_EmployeeID"><div class="ew-table-header-caption"><?php echo $pivot_incomes_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $pivot_incomes_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_incomes_list->SortUrl($pivot_incomes_list->EmployeeID) ?>', 1);"><div id="elh_pivot_incomes_EmployeeID" class="pivot_incomes_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_incomes_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_incomes_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_incomes_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_incomes_list->FirstName->Visible) { // FirstName ?>
	<?php if ($pivot_incomes_list->SortUrl($pivot_incomes_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $pivot_incomes_list->FirstName->headerCellClass() ?>"><div id="elh_pivot_incomes_FirstName" class="pivot_incomes_FirstName"><div class="ew-table-header-caption"><?php echo $pivot_incomes_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $pivot_incomes_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_incomes_list->SortUrl($pivot_incomes_list->FirstName) ?>', 1);"><div id="elh_pivot_incomes_FirstName" class="pivot_incomes_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_incomes_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pivot_incomes_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_incomes_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_incomes_list->MiddleName->Visible) { // MiddleName ?>
	<?php if ($pivot_incomes_list->SortUrl($pivot_incomes_list->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $pivot_incomes_list->MiddleName->headerCellClass() ?>"><div id="elh_pivot_incomes_MiddleName" class="pivot_incomes_MiddleName"><div class="ew-table-header-caption"><?php echo $pivot_incomes_list->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $pivot_incomes_list->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_incomes_list->SortUrl($pivot_incomes_list->MiddleName) ?>', 1);"><div id="elh_pivot_incomes_MiddleName" class="pivot_incomes_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_incomes_list->MiddleName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pivot_incomes_list->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_incomes_list->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_incomes_list->Surname->Visible) { // Surname ?>
	<?php if ($pivot_incomes_list->SortUrl($pivot_incomes_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $pivot_incomes_list->Surname->headerCellClass() ?>"><div id="elh_pivot_incomes_Surname" class="pivot_incomes_Surname"><div class="ew-table-header-caption"><?php echo $pivot_incomes_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $pivot_incomes_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_incomes_list->SortUrl($pivot_incomes_list->Surname) ?>', 1);"><div id="elh_pivot_incomes_Surname" class="pivot_incomes_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_incomes_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pivot_incomes_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_incomes_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_incomes_list->NRC->Visible) { // NRC ?>
	<?php if ($pivot_incomes_list->SortUrl($pivot_incomes_list->NRC) == "") { ?>
		<th data-name="NRC" class="<?php echo $pivot_incomes_list->NRC->headerCellClass() ?>"><div id="elh_pivot_incomes_NRC" class="pivot_incomes_NRC"><div class="ew-table-header-caption"><?php echo $pivot_incomes_list->NRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC" class="<?php echo $pivot_incomes_list->NRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_incomes_list->SortUrl($pivot_incomes_list->NRC) ?>', 1);"><div id="elh_pivot_incomes_NRC" class="pivot_incomes_NRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_incomes_list->NRC->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pivot_incomes_list->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_incomes_list->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_incomes_list->Basic_Salary->Visible) { // Basic Salary ?>
	<?php if ($pivot_incomes_list->SortUrl($pivot_incomes_list->Basic_Salary) == "") { ?>
		<th data-name="Basic_Salary" class="<?php echo $pivot_incomes_list->Basic_Salary->headerCellClass() ?>"><div id="elh_pivot_incomes_Basic_Salary" class="pivot_incomes_Basic_Salary"><div class="ew-table-header-caption"><?php echo $pivot_incomes_list->Basic_Salary->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Basic_Salary" class="<?php echo $pivot_incomes_list->Basic_Salary->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_incomes_list->SortUrl($pivot_incomes_list->Basic_Salary) ?>', 1);"><div id="elh_pivot_incomes_Basic_Salary" class="pivot_incomes_Basic_Salary">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_incomes_list->Basic_Salary->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_incomes_list->Basic_Salary->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_incomes_list->Basic_Salary->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_incomes_list->Housing_Allowance->Visible) { // Housing Allowance ?>
	<?php if ($pivot_incomes_list->SortUrl($pivot_incomes_list->Housing_Allowance) == "") { ?>
		<th data-name="Housing_Allowance" class="<?php echo $pivot_incomes_list->Housing_Allowance->headerCellClass() ?>"><div id="elh_pivot_incomes_Housing_Allowance" class="pivot_incomes_Housing_Allowance"><div class="ew-table-header-caption"><?php echo $pivot_incomes_list->Housing_Allowance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Housing_Allowance" class="<?php echo $pivot_incomes_list->Housing_Allowance->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_incomes_list->SortUrl($pivot_incomes_list->Housing_Allowance) ?>', 1);"><div id="elh_pivot_incomes_Housing_Allowance" class="pivot_incomes_Housing_Allowance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_incomes_list->Housing_Allowance->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_incomes_list->Housing_Allowance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_incomes_list->Housing_Allowance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_incomes_list->Transport_Allowance->Visible) { // Transport Allowance ?>
	<?php if ($pivot_incomes_list->SortUrl($pivot_incomes_list->Transport_Allowance) == "") { ?>
		<th data-name="Transport_Allowance" class="<?php echo $pivot_incomes_list->Transport_Allowance->headerCellClass() ?>"><div id="elh_pivot_incomes_Transport_Allowance" class="pivot_incomes_Transport_Allowance"><div class="ew-table-header-caption"><?php echo $pivot_incomes_list->Transport_Allowance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Transport_Allowance" class="<?php echo $pivot_incomes_list->Transport_Allowance->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_incomes_list->SortUrl($pivot_incomes_list->Transport_Allowance) ?>', 1);"><div id="elh_pivot_incomes_Transport_Allowance" class="pivot_incomes_Transport_Allowance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_incomes_list->Transport_Allowance->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_incomes_list->Transport_Allowance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_incomes_list->Transport_Allowance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_incomes_list->Education_Allowance->Visible) { // Education Allowance ?>
	<?php if ($pivot_incomes_list->SortUrl($pivot_incomes_list->Education_Allowance) == "") { ?>
		<th data-name="Education_Allowance" class="<?php echo $pivot_incomes_list->Education_Allowance->headerCellClass() ?>"><div id="elh_pivot_incomes_Education_Allowance" class="pivot_incomes_Education_Allowance"><div class="ew-table-header-caption"><?php echo $pivot_incomes_list->Education_Allowance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Education_Allowance" class="<?php echo $pivot_incomes_list->Education_Allowance->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_incomes_list->SortUrl($pivot_incomes_list->Education_Allowance) ?>', 1);"><div id="elh_pivot_incomes_Education_Allowance" class="pivot_incomes_Education_Allowance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_incomes_list->Education_Allowance->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_incomes_list->Education_Allowance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_incomes_list->Education_Allowance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_incomes_list->Rural_Hardship_Allowance->Visible) { // Rural Hardship Allowance ?>
	<?php if ($pivot_incomes_list->SortUrl($pivot_incomes_list->Rural_Hardship_Allowance) == "") { ?>
		<th data-name="Rural_Hardship_Allowance" class="<?php echo $pivot_incomes_list->Rural_Hardship_Allowance->headerCellClass() ?>"><div id="elh_pivot_incomes_Rural_Hardship_Allowance" class="pivot_incomes_Rural_Hardship_Allowance"><div class="ew-table-header-caption"><?php echo $pivot_incomes_list->Rural_Hardship_Allowance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rural_Hardship_Allowance" class="<?php echo $pivot_incomes_list->Rural_Hardship_Allowance->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_incomes_list->SortUrl($pivot_incomes_list->Rural_Hardship_Allowance) ?>', 1);"><div id="elh_pivot_incomes_Rural_Hardship_Allowance" class="pivot_incomes_Rural_Hardship_Allowance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_incomes_list->Rural_Hardship_Allowance->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_incomes_list->Rural_Hardship_Allowance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_incomes_list->Rural_Hardship_Allowance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_incomes_list->Acting_Allowance->Visible) { // Acting Allowance ?>
	<?php if ($pivot_incomes_list->SortUrl($pivot_incomes_list->Acting_Allowance) == "") { ?>
		<th data-name="Acting_Allowance" class="<?php echo $pivot_incomes_list->Acting_Allowance->headerCellClass() ?>"><div id="elh_pivot_incomes_Acting_Allowance" class="pivot_incomes_Acting_Allowance"><div class="ew-table-header-caption"><?php echo $pivot_incomes_list->Acting_Allowance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Acting_Allowance" class="<?php echo $pivot_incomes_list->Acting_Allowance->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_incomes_list->SortUrl($pivot_incomes_list->Acting_Allowance) ?>', 1);"><div id="elh_pivot_incomes_Acting_Allowance" class="pivot_incomes_Acting_Allowance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_incomes_list->Acting_Allowance->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_incomes_list->Acting_Allowance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_incomes_list->Acting_Allowance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_incomes_list->Ration_Allowance->Visible) { // Ration Allowance ?>
	<?php if ($pivot_incomes_list->SortUrl($pivot_incomes_list->Ration_Allowance) == "") { ?>
		<th data-name="Ration_Allowance" class="<?php echo $pivot_incomes_list->Ration_Allowance->headerCellClass() ?>"><div id="elh_pivot_incomes_Ration_Allowance" class="pivot_incomes_Ration_Allowance"><div class="ew-table-header-caption"><?php echo $pivot_incomes_list->Ration_Allowance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Ration_Allowance" class="<?php echo $pivot_incomes_list->Ration_Allowance->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_incomes_list->SortUrl($pivot_incomes_list->Ration_Allowance) ?>', 1);"><div id="elh_pivot_incomes_Ration_Allowance" class="pivot_incomes_Ration_Allowance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_incomes_list->Ration_Allowance->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_incomes_list->Ration_Allowance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_incomes_list->Ration_Allowance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_incomes_list->StandBy_Allowance->Visible) { // StandBy Allowance ?>
	<?php if ($pivot_incomes_list->SortUrl($pivot_incomes_list->StandBy_Allowance) == "") { ?>
		<th data-name="StandBy_Allowance" class="<?php echo $pivot_incomes_list->StandBy_Allowance->headerCellClass() ?>"><div id="elh_pivot_incomes_StandBy_Allowance" class="pivot_incomes_StandBy_Allowance"><div class="ew-table-header-caption"><?php echo $pivot_incomes_list->StandBy_Allowance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StandBy_Allowance" class="<?php echo $pivot_incomes_list->StandBy_Allowance->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_incomes_list->SortUrl($pivot_incomes_list->StandBy_Allowance) ?>', 1);"><div id="elh_pivot_incomes_StandBy_Allowance" class="pivot_incomes_StandBy_Allowance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_incomes_list->StandBy_Allowance->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_incomes_list->StandBy_Allowance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_incomes_list->StandBy_Allowance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_incomes_list->In_Leu_of_Excess_hours_Allowance->Visible) { // In Leu of Excess hours Allowance ?>
	<?php if ($pivot_incomes_list->SortUrl($pivot_incomes_list->In_Leu_of_Excess_hours_Allowance) == "") { ?>
		<th data-name="In_Leu_of_Excess_hours_Allowance" class="<?php echo $pivot_incomes_list->In_Leu_of_Excess_hours_Allowance->headerCellClass() ?>"><div id="elh_pivot_incomes_In_Leu_of_Excess_hours_Allowance" class="pivot_incomes_In_Leu_of_Excess_hours_Allowance"><div class="ew-table-header-caption"><?php echo $pivot_incomes_list->In_Leu_of_Excess_hours_Allowance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="In_Leu_of_Excess_hours_Allowance" class="<?php echo $pivot_incomes_list->In_Leu_of_Excess_hours_Allowance->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_incomes_list->SortUrl($pivot_incomes_list->In_Leu_of_Excess_hours_Allowance) ?>', 1);"><div id="elh_pivot_incomes_In_Leu_of_Excess_hours_Allowance" class="pivot_incomes_In_Leu_of_Excess_hours_Allowance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_incomes_list->In_Leu_of_Excess_hours_Allowance->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_incomes_list->In_Leu_of_Excess_hours_Allowance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_incomes_list->In_Leu_of_Excess_hours_Allowance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_incomes_list->Overtime->Visible) { // Overtime ?>
	<?php if ($pivot_incomes_list->SortUrl($pivot_incomes_list->Overtime) == "") { ?>
		<th data-name="Overtime" class="<?php echo $pivot_incomes_list->Overtime->headerCellClass() ?>"><div id="elh_pivot_incomes_Overtime" class="pivot_incomes_Overtime"><div class="ew-table-header-caption"><?php echo $pivot_incomes_list->Overtime->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Overtime" class="<?php echo $pivot_incomes_list->Overtime->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_incomes_list->SortUrl($pivot_incomes_list->Overtime) ?>', 1);"><div id="elh_pivot_incomes_Overtime" class="pivot_incomes_Overtime">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_incomes_list->Overtime->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_incomes_list->Overtime->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_incomes_list->Overtime->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_incomes_list->Settling_in_allowance->Visible) { // Settling in allowance ?>
	<?php if ($pivot_incomes_list->SortUrl($pivot_incomes_list->Settling_in_allowance) == "") { ?>
		<th data-name="Settling_in_allowance" class="<?php echo $pivot_incomes_list->Settling_in_allowance->headerCellClass() ?>"><div id="elh_pivot_incomes_Settling_in_allowance" class="pivot_incomes_Settling_in_allowance"><div class="ew-table-header-caption"><?php echo $pivot_incomes_list->Settling_in_allowance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Settling_in_allowance" class="<?php echo $pivot_incomes_list->Settling_in_allowance->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_incomes_list->SortUrl($pivot_incomes_list->Settling_in_allowance) ?>', 1);"><div id="elh_pivot_incomes_Settling_in_allowance" class="pivot_incomes_Settling_in_allowance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_incomes_list->Settling_in_allowance->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_incomes_list->Settling_in_allowance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_incomes_list->Settling_in_allowance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$pivot_incomes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($pivot_incomes_list->ExportAll && $pivot_incomes_list->isExport()) {
	$pivot_incomes_list->StopRecord = $pivot_incomes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($pivot_incomes_list->TotalRecords > $pivot_incomes_list->StartRecord + $pivot_incomes_list->DisplayRecords - 1)
		$pivot_incomes_list->StopRecord = $pivot_incomes_list->StartRecord + $pivot_incomes_list->DisplayRecords - 1;
	else
		$pivot_incomes_list->StopRecord = $pivot_incomes_list->TotalRecords;
}
$pivot_incomes_list->RecordCount = $pivot_incomes_list->StartRecord - 1;
if ($pivot_incomes_list->Recordset && !$pivot_incomes_list->Recordset->EOF) {
	$pivot_incomes_list->Recordset->moveFirst();
	$selectLimit = $pivot_incomes_list->UseSelectLimit;
	if (!$selectLimit && $pivot_incomes_list->StartRecord > 1)
		$pivot_incomes_list->Recordset->move($pivot_incomes_list->StartRecord - 1);
} elseif (!$pivot_incomes->AllowAddDeleteRow && $pivot_incomes_list->StopRecord == 0) {
	$pivot_incomes_list->StopRecord = $pivot_incomes->GridAddRowCount;
}

// Initialize aggregate
$pivot_incomes->RowType = ROWTYPE_AGGREGATEINIT;
$pivot_incomes->resetAttributes();
$pivot_incomes_list->renderRow();
while ($pivot_incomes_list->RecordCount < $pivot_incomes_list->StopRecord) {
	$pivot_incomes_list->RecordCount++;
	if ($pivot_incomes_list->RecordCount >= $pivot_incomes_list->StartRecord) {
		$pivot_incomes_list->RowCount++;

		// Set up key count
		$pivot_incomes_list->KeyCount = $pivot_incomes_list->RowIndex;

		// Init row class and style
		$pivot_incomes->resetAttributes();
		$pivot_incomes->CssClass = "";
		if ($pivot_incomes_list->isGridAdd()) {
		} else {
			$pivot_incomes_list->loadRowValues($pivot_incomes_list->Recordset); // Load row values
		}
		$pivot_incomes->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$pivot_incomes->RowAttrs->merge(["data-rowindex" => $pivot_incomes_list->RowCount, "id" => "r" . $pivot_incomes_list->RowCount . "_pivot_incomes", "data-rowtype" => $pivot_incomes->RowType]);

		// Render row
		$pivot_incomes_list->renderRow();

		// Render list options
		$pivot_incomes_list->renderListOptions();
?>
	<tr <?php echo $pivot_incomes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$pivot_incomes_list->ListOptions->render("body", "left", $pivot_incomes_list->RowCount);
?>
	<?php if ($pivot_incomes_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $pivot_incomes_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $pivot_incomes_list->RowCount ?>_pivot_incomes_EmployeeID">
<span<?php echo $pivot_incomes_list->EmployeeID->viewAttributes() ?>><?php echo $pivot_incomes_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_incomes_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $pivot_incomes_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $pivot_incomes_list->RowCount ?>_pivot_incomes_FirstName">
<span<?php echo $pivot_incomes_list->FirstName->viewAttributes() ?>><?php echo $pivot_incomes_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_incomes_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $pivot_incomes_list->MiddleName->cellAttributes() ?>>
<span id="el<?php echo $pivot_incomes_list->RowCount ?>_pivot_incomes_MiddleName">
<span<?php echo $pivot_incomes_list->MiddleName->viewAttributes() ?>><?php echo $pivot_incomes_list->MiddleName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_incomes_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $pivot_incomes_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $pivot_incomes_list->RowCount ?>_pivot_incomes_Surname">
<span<?php echo $pivot_incomes_list->Surname->viewAttributes() ?>><?php echo $pivot_incomes_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_incomes_list->NRC->Visible) { // NRC ?>
		<td data-name="NRC" <?php echo $pivot_incomes_list->NRC->cellAttributes() ?>>
<span id="el<?php echo $pivot_incomes_list->RowCount ?>_pivot_incomes_NRC">
<span<?php echo $pivot_incomes_list->NRC->viewAttributes() ?>><?php echo $pivot_incomes_list->NRC->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_incomes_list->Basic_Salary->Visible) { // Basic Salary ?>
		<td data-name="Basic_Salary" <?php echo $pivot_incomes_list->Basic_Salary->cellAttributes() ?>>
<span id="el<?php echo $pivot_incomes_list->RowCount ?>_pivot_incomes_Basic_Salary">
<span<?php echo $pivot_incomes_list->Basic_Salary->viewAttributes() ?>><?php echo $pivot_incomes_list->Basic_Salary->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_incomes_list->Housing_Allowance->Visible) { // Housing Allowance ?>
		<td data-name="Housing_Allowance" <?php echo $pivot_incomes_list->Housing_Allowance->cellAttributes() ?>>
<span id="el<?php echo $pivot_incomes_list->RowCount ?>_pivot_incomes_Housing_Allowance">
<span<?php echo $pivot_incomes_list->Housing_Allowance->viewAttributes() ?>><?php echo $pivot_incomes_list->Housing_Allowance->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_incomes_list->Transport_Allowance->Visible) { // Transport Allowance ?>
		<td data-name="Transport_Allowance" <?php echo $pivot_incomes_list->Transport_Allowance->cellAttributes() ?>>
<span id="el<?php echo $pivot_incomes_list->RowCount ?>_pivot_incomes_Transport_Allowance">
<span<?php echo $pivot_incomes_list->Transport_Allowance->viewAttributes() ?>><?php echo $pivot_incomes_list->Transport_Allowance->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_incomes_list->Education_Allowance->Visible) { // Education Allowance ?>
		<td data-name="Education_Allowance" <?php echo $pivot_incomes_list->Education_Allowance->cellAttributes() ?>>
<span id="el<?php echo $pivot_incomes_list->RowCount ?>_pivot_incomes_Education_Allowance">
<span<?php echo $pivot_incomes_list->Education_Allowance->viewAttributes() ?>><?php echo $pivot_incomes_list->Education_Allowance->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_incomes_list->Rural_Hardship_Allowance->Visible) { // Rural Hardship Allowance ?>
		<td data-name="Rural_Hardship_Allowance" <?php echo $pivot_incomes_list->Rural_Hardship_Allowance->cellAttributes() ?>>
<span id="el<?php echo $pivot_incomes_list->RowCount ?>_pivot_incomes_Rural_Hardship_Allowance">
<span<?php echo $pivot_incomes_list->Rural_Hardship_Allowance->viewAttributes() ?>><?php echo $pivot_incomes_list->Rural_Hardship_Allowance->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_incomes_list->Acting_Allowance->Visible) { // Acting Allowance ?>
		<td data-name="Acting_Allowance" <?php echo $pivot_incomes_list->Acting_Allowance->cellAttributes() ?>>
<span id="el<?php echo $pivot_incomes_list->RowCount ?>_pivot_incomes_Acting_Allowance">
<span<?php echo $pivot_incomes_list->Acting_Allowance->viewAttributes() ?>><?php echo $pivot_incomes_list->Acting_Allowance->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_incomes_list->Ration_Allowance->Visible) { // Ration Allowance ?>
		<td data-name="Ration_Allowance" <?php echo $pivot_incomes_list->Ration_Allowance->cellAttributes() ?>>
<span id="el<?php echo $pivot_incomes_list->RowCount ?>_pivot_incomes_Ration_Allowance">
<span<?php echo $pivot_incomes_list->Ration_Allowance->viewAttributes() ?>><?php echo $pivot_incomes_list->Ration_Allowance->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_incomes_list->StandBy_Allowance->Visible) { // StandBy Allowance ?>
		<td data-name="StandBy_Allowance" <?php echo $pivot_incomes_list->StandBy_Allowance->cellAttributes() ?>>
<span id="el<?php echo $pivot_incomes_list->RowCount ?>_pivot_incomes_StandBy_Allowance">
<span<?php echo $pivot_incomes_list->StandBy_Allowance->viewAttributes() ?>><?php echo $pivot_incomes_list->StandBy_Allowance->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_incomes_list->In_Leu_of_Excess_hours_Allowance->Visible) { // In Leu of Excess hours Allowance ?>
		<td data-name="In_Leu_of_Excess_hours_Allowance" <?php echo $pivot_incomes_list->In_Leu_of_Excess_hours_Allowance->cellAttributes() ?>>
<span id="el<?php echo $pivot_incomes_list->RowCount ?>_pivot_incomes_In_Leu_of_Excess_hours_Allowance">
<span<?php echo $pivot_incomes_list->In_Leu_of_Excess_hours_Allowance->viewAttributes() ?>><?php echo $pivot_incomes_list->In_Leu_of_Excess_hours_Allowance->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_incomes_list->Overtime->Visible) { // Overtime ?>
		<td data-name="Overtime" <?php echo $pivot_incomes_list->Overtime->cellAttributes() ?>>
<span id="el<?php echo $pivot_incomes_list->RowCount ?>_pivot_incomes_Overtime">
<span<?php echo $pivot_incomes_list->Overtime->viewAttributes() ?>><?php echo $pivot_incomes_list->Overtime->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_incomes_list->Settling_in_allowance->Visible) { // Settling in allowance ?>
		<td data-name="Settling_in_allowance" <?php echo $pivot_incomes_list->Settling_in_allowance->cellAttributes() ?>>
<span id="el<?php echo $pivot_incomes_list->RowCount ?>_pivot_incomes_Settling_in_allowance">
<span<?php echo $pivot_incomes_list->Settling_in_allowance->viewAttributes() ?>><?php echo $pivot_incomes_list->Settling_in_allowance->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pivot_incomes_list->ListOptions->render("body", "right", $pivot_incomes_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$pivot_incomes_list->isGridAdd())
		$pivot_incomes_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$pivot_incomes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($pivot_incomes_list->Recordset)
	$pivot_incomes_list->Recordset->Close();
?>
<?php if (!$pivot_incomes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$pivot_incomes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $pivot_incomes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $pivot_incomes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($pivot_incomes_list->TotalRecords == 0 && !$pivot_incomes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $pivot_incomes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$pivot_incomes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$pivot_incomes_list->isExport()) { ?>
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
$pivot_incomes_list->terminate();
?>