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
$payflexi_netpay_schedule_list = new payflexi_netpay_schedule_list();

// Run the page
$payflexi_netpay_schedule_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payflexi_netpay_schedule_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$payflexi_netpay_schedule_list->isExport()) { ?>
<script>
var fpayflexi_netpay_schedulelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpayflexi_netpay_schedulelist = currentForm = new ew.Form("fpayflexi_netpay_schedulelist", "list");
	fpayflexi_netpay_schedulelist.formKeyCountName = '<?php echo $payflexi_netpay_schedule_list->FormKeyCountName ?>';
	loadjs.done("fpayflexi_netpay_schedulelist");
});
var fpayflexi_netpay_schedulelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpayflexi_netpay_schedulelistsrch = currentSearchForm = new ew.Form("fpayflexi_netpay_schedulelistsrch");

	// Dynamic selection lists
	// Filters

	fpayflexi_netpay_schedulelistsrch.filterList = <?php echo $payflexi_netpay_schedule_list->getFilterList() ?>;

	// Init search panel as collapsed
	fpayflexi_netpay_schedulelistsrch.initSearchPanel = true;
	loadjs.done("fpayflexi_netpay_schedulelistsrch");
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
<?php if (!$payflexi_netpay_schedule_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($payflexi_netpay_schedule_list->TotalRecords > 0 && $payflexi_netpay_schedule_list->ExportOptions->visible()) { ?>
<?php $payflexi_netpay_schedule_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_list->ImportOptions->visible()) { ?>
<?php $payflexi_netpay_schedule_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_list->SearchOptions->visible()) { ?>
<?php $payflexi_netpay_schedule_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_list->FilterOptions->visible()) { ?>
<?php $payflexi_netpay_schedule_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$payflexi_netpay_schedule_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$payflexi_netpay_schedule_list->isExport() && !$payflexi_netpay_schedule->CurrentAction) { ?>
<form name="fpayflexi_netpay_schedulelistsrch" id="fpayflexi_netpay_schedulelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpayflexi_netpay_schedulelistsrch-search-panel" class="<?php echo $payflexi_netpay_schedule_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="payflexi_netpay_schedule">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $payflexi_netpay_schedule_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($payflexi_netpay_schedule_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($payflexi_netpay_schedule_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $payflexi_netpay_schedule_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($payflexi_netpay_schedule_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($payflexi_netpay_schedule_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($payflexi_netpay_schedule_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($payflexi_netpay_schedule_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $payflexi_netpay_schedule_list->showPageHeader(); ?>
<?php
$payflexi_netpay_schedule_list->showMessage();
?>
<?php if ($payflexi_netpay_schedule_list->TotalRecords > 0 || $payflexi_netpay_schedule->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($payflexi_netpay_schedule_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> payflexi_netpay_schedule">
<?php if (!$payflexi_netpay_schedule_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$payflexi_netpay_schedule_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payflexi_netpay_schedule_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $payflexi_netpay_schedule_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpayflexi_netpay_schedulelist" id="fpayflexi_netpay_schedulelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payflexi_netpay_schedule">
<div id="gmp_payflexi_netpay_schedule" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($payflexi_netpay_schedule_list->TotalRecords > 0 || $payflexi_netpay_schedule_list->isGridEdit()) { ?>
<table id="tbl_payflexi_netpay_schedulelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$payflexi_netpay_schedule->RowType = ROWTYPE_HEADER;

// Render list options
$payflexi_netpay_schedule_list->renderListOptions();

// Render list options (header, left)
$payflexi_netpay_schedule_list->ListOptions->render("header", "left");
?>
<?php if ($payflexi_netpay_schedule_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($payflexi_netpay_schedule_list->SortUrl($payflexi_netpay_schedule_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $payflexi_netpay_schedule_list->EmployeeID->headerCellClass() ?>"><div id="elh_payflexi_netpay_schedule_EmployeeID" class="payflexi_netpay_schedule_EmployeeID"><div class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $payflexi_netpay_schedule_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payflexi_netpay_schedule_list->SortUrl($payflexi_netpay_schedule_list->EmployeeID) ?>', 1);"><div id="elh_payflexi_netpay_schedule_EmployeeID" class="payflexi_netpay_schedule_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($payflexi_netpay_schedule_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payflexi_netpay_schedule_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_list->FirstName->Visible) { // FirstName ?>
	<?php if ($payflexi_netpay_schedule_list->SortUrl($payflexi_netpay_schedule_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $payflexi_netpay_schedule_list->FirstName->headerCellClass() ?>"><div id="elh_payflexi_netpay_schedule_FirstName" class="payflexi_netpay_schedule_FirstName"><div class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $payflexi_netpay_schedule_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payflexi_netpay_schedule_list->SortUrl($payflexi_netpay_schedule_list->FirstName) ?>', 1);"><div id="elh_payflexi_netpay_schedule_FirstName" class="payflexi_netpay_schedule_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payflexi_netpay_schedule_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payflexi_netpay_schedule_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_list->Surname->Visible) { // Surname ?>
	<?php if ($payflexi_netpay_schedule_list->SortUrl($payflexi_netpay_schedule_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $payflexi_netpay_schedule_list->Surname->headerCellClass() ?>"><div id="elh_payflexi_netpay_schedule_Surname" class="payflexi_netpay_schedule_Surname"><div class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $payflexi_netpay_schedule_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payflexi_netpay_schedule_list->SortUrl($payflexi_netpay_schedule_list->Surname) ?>', 1);"><div id="elh_payflexi_netpay_schedule_Surname" class="payflexi_netpay_schedule_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payflexi_netpay_schedule_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payflexi_netpay_schedule_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_list->NAME_OF_BENEFICIARY->Visible) { // NAME OF BENEFICIARY ?>
	<?php if ($payflexi_netpay_schedule_list->SortUrl($payflexi_netpay_schedule_list->NAME_OF_BENEFICIARY) == "") { ?>
		<th data-name="NAME_OF_BENEFICIARY" class="<?php echo $payflexi_netpay_schedule_list->NAME_OF_BENEFICIARY->headerCellClass() ?>"><div id="elh_payflexi_netpay_schedule_NAME_OF_BENEFICIARY" class="payflexi_netpay_schedule_NAME_OF_BENEFICIARY"><div class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_list->NAME_OF_BENEFICIARY->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NAME_OF_BENEFICIARY" class="<?php echo $payflexi_netpay_schedule_list->NAME_OF_BENEFICIARY->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payflexi_netpay_schedule_list->SortUrl($payflexi_netpay_schedule_list->NAME_OF_BENEFICIARY) ?>', 1);"><div id="elh_payflexi_netpay_schedule_NAME_OF_BENEFICIARY" class="payflexi_netpay_schedule_NAME_OF_BENEFICIARY">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_list->NAME_OF_BENEFICIARY->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payflexi_netpay_schedule_list->NAME_OF_BENEFICIARY->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payflexi_netpay_schedule_list->NAME_OF_BENEFICIARY->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_list->ACCOUNT_NUMBER->Visible) { // ACCOUNT NUMBER ?>
	<?php if ($payflexi_netpay_schedule_list->SortUrl($payflexi_netpay_schedule_list->ACCOUNT_NUMBER) == "") { ?>
		<th data-name="ACCOUNT_NUMBER" class="<?php echo $payflexi_netpay_schedule_list->ACCOUNT_NUMBER->headerCellClass() ?>"><div id="elh_payflexi_netpay_schedule_ACCOUNT_NUMBER" class="payflexi_netpay_schedule_ACCOUNT_NUMBER"><div class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_list->ACCOUNT_NUMBER->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ACCOUNT_NUMBER" class="<?php echo $payflexi_netpay_schedule_list->ACCOUNT_NUMBER->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payflexi_netpay_schedule_list->SortUrl($payflexi_netpay_schedule_list->ACCOUNT_NUMBER) ?>', 1);"><div id="elh_payflexi_netpay_schedule_ACCOUNT_NUMBER" class="payflexi_netpay_schedule_ACCOUNT_NUMBER">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_list->ACCOUNT_NUMBER->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payflexi_netpay_schedule_list->ACCOUNT_NUMBER->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payflexi_netpay_schedule_list->ACCOUNT_NUMBER->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_list->SORT_CODE->Visible) { // SORT CODE ?>
	<?php if ($payflexi_netpay_schedule_list->SortUrl($payflexi_netpay_schedule_list->SORT_CODE) == "") { ?>
		<th data-name="SORT_CODE" class="<?php echo $payflexi_netpay_schedule_list->SORT_CODE->headerCellClass() ?>"><div id="elh_payflexi_netpay_schedule_SORT_CODE" class="payflexi_netpay_schedule_SORT_CODE"><div class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_list->SORT_CODE->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SORT_CODE" class="<?php echo $payflexi_netpay_schedule_list->SORT_CODE->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payflexi_netpay_schedule_list->SortUrl($payflexi_netpay_schedule_list->SORT_CODE) ?>', 1);"><div id="elh_payflexi_netpay_schedule_SORT_CODE" class="payflexi_netpay_schedule_SORT_CODE">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_list->SORT_CODE->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payflexi_netpay_schedule_list->SORT_CODE->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payflexi_netpay_schedule_list->SORT_CODE->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_list->GrossPay->Visible) { // GrossPay ?>
	<?php if ($payflexi_netpay_schedule_list->SortUrl($payflexi_netpay_schedule_list->GrossPay) == "") { ?>
		<th data-name="GrossPay" class="<?php echo $payflexi_netpay_schedule_list->GrossPay->headerCellClass() ?>"><div id="elh_payflexi_netpay_schedule_GrossPay" class="payflexi_netpay_schedule_GrossPay"><div class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_list->GrossPay->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="GrossPay" class="<?php echo $payflexi_netpay_schedule_list->GrossPay->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payflexi_netpay_schedule_list->SortUrl($payflexi_netpay_schedule_list->GrossPay) ?>', 1);"><div id="elh_payflexi_netpay_schedule_GrossPay" class="payflexi_netpay_schedule_GrossPay">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_list->GrossPay->caption() ?></span><span class="ew-table-header-sort"><?php if ($payflexi_netpay_schedule_list->GrossPay->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payflexi_netpay_schedule_list->GrossPay->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_list->TotalDeductions->Visible) { // TotalDeductions ?>
	<?php if ($payflexi_netpay_schedule_list->SortUrl($payflexi_netpay_schedule_list->TotalDeductions) == "") { ?>
		<th data-name="TotalDeductions" class="<?php echo $payflexi_netpay_schedule_list->TotalDeductions->headerCellClass() ?>"><div id="elh_payflexi_netpay_schedule_TotalDeductions" class="payflexi_netpay_schedule_TotalDeductions"><div class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_list->TotalDeductions->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TotalDeductions" class="<?php echo $payflexi_netpay_schedule_list->TotalDeductions->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payflexi_netpay_schedule_list->SortUrl($payflexi_netpay_schedule_list->TotalDeductions) ?>', 1);"><div id="elh_payflexi_netpay_schedule_TotalDeductions" class="payflexi_netpay_schedule_TotalDeductions">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_list->TotalDeductions->caption() ?></span><span class="ew-table-header-sort"><?php if ($payflexi_netpay_schedule_list->TotalDeductions->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payflexi_netpay_schedule_list->TotalDeductions->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_list->AMOUNT->Visible) { // AMOUNT ?>
	<?php if ($payflexi_netpay_schedule_list->SortUrl($payflexi_netpay_schedule_list->AMOUNT) == "") { ?>
		<th data-name="AMOUNT" class="<?php echo $payflexi_netpay_schedule_list->AMOUNT->headerCellClass() ?>"><div id="elh_payflexi_netpay_schedule_AMOUNT" class="payflexi_netpay_schedule_AMOUNT"><div class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_list->AMOUNT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AMOUNT" class="<?php echo $payflexi_netpay_schedule_list->AMOUNT->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payflexi_netpay_schedule_list->SortUrl($payflexi_netpay_schedule_list->AMOUNT) ?>', 1);"><div id="elh_payflexi_netpay_schedule_AMOUNT" class="payflexi_netpay_schedule_AMOUNT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_list->AMOUNT->caption() ?></span><span class="ew-table-header-sort"><?php if ($payflexi_netpay_schedule_list->AMOUNT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payflexi_netpay_schedule_list->AMOUNT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_list->REFERENCE->Visible) { // REFERENCE ?>
	<?php if ($payflexi_netpay_schedule_list->SortUrl($payflexi_netpay_schedule_list->REFERENCE) == "") { ?>
		<th data-name="REFERENCE" class="<?php echo $payflexi_netpay_schedule_list->REFERENCE->headerCellClass() ?>"><div id="elh_payflexi_netpay_schedule_REFERENCE" class="payflexi_netpay_schedule_REFERENCE"><div class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_list->REFERENCE->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="REFERENCE" class="<?php echo $payflexi_netpay_schedule_list->REFERENCE->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payflexi_netpay_schedule_list->SortUrl($payflexi_netpay_schedule_list->REFERENCE) ?>', 1);"><div id="elh_payflexi_netpay_schedule_REFERENCE" class="payflexi_netpay_schedule_REFERENCE">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_list->REFERENCE->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payflexi_netpay_schedule_list->REFERENCE->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payflexi_netpay_schedule_list->REFERENCE->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$payflexi_netpay_schedule_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($payflexi_netpay_schedule_list->ExportAll && $payflexi_netpay_schedule_list->isExport()) {
	$payflexi_netpay_schedule_list->StopRecord = $payflexi_netpay_schedule_list->TotalRecords;
} else {

	// Set the last record to display
	if ($payflexi_netpay_schedule_list->TotalRecords > $payflexi_netpay_schedule_list->StartRecord + $payflexi_netpay_schedule_list->DisplayRecords - 1)
		$payflexi_netpay_schedule_list->StopRecord = $payflexi_netpay_schedule_list->StartRecord + $payflexi_netpay_schedule_list->DisplayRecords - 1;
	else
		$payflexi_netpay_schedule_list->StopRecord = $payflexi_netpay_schedule_list->TotalRecords;
}
$payflexi_netpay_schedule_list->RecordCount = $payflexi_netpay_schedule_list->StartRecord - 1;
if ($payflexi_netpay_schedule_list->Recordset && !$payflexi_netpay_schedule_list->Recordset->EOF) {
	$payflexi_netpay_schedule_list->Recordset->moveFirst();
	$selectLimit = $payflexi_netpay_schedule_list->UseSelectLimit;
	if (!$selectLimit && $payflexi_netpay_schedule_list->StartRecord > 1)
		$payflexi_netpay_schedule_list->Recordset->move($payflexi_netpay_schedule_list->StartRecord - 1);
} elseif (!$payflexi_netpay_schedule->AllowAddDeleteRow && $payflexi_netpay_schedule_list->StopRecord == 0) {
	$payflexi_netpay_schedule_list->StopRecord = $payflexi_netpay_schedule->GridAddRowCount;
}

// Initialize aggregate
$payflexi_netpay_schedule->RowType = ROWTYPE_AGGREGATEINIT;
$payflexi_netpay_schedule->resetAttributes();
$payflexi_netpay_schedule_list->renderRow();
while ($payflexi_netpay_schedule_list->RecordCount < $payflexi_netpay_schedule_list->StopRecord) {
	$payflexi_netpay_schedule_list->RecordCount++;
	if ($payflexi_netpay_schedule_list->RecordCount >= $payflexi_netpay_schedule_list->StartRecord) {
		$payflexi_netpay_schedule_list->RowCount++;

		// Set up key count
		$payflexi_netpay_schedule_list->KeyCount = $payflexi_netpay_schedule_list->RowIndex;

		// Init row class and style
		$payflexi_netpay_schedule->resetAttributes();
		$payflexi_netpay_schedule->CssClass = "";
		if ($payflexi_netpay_schedule_list->isGridAdd()) {
		} else {
			$payflexi_netpay_schedule_list->loadRowValues($payflexi_netpay_schedule_list->Recordset); // Load row values
		}
		$payflexi_netpay_schedule->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$payflexi_netpay_schedule->RowAttrs->merge(["data-rowindex" => $payflexi_netpay_schedule_list->RowCount, "id" => "r" . $payflexi_netpay_schedule_list->RowCount . "_payflexi_netpay_schedule", "data-rowtype" => $payflexi_netpay_schedule->RowType]);

		// Render row
		$payflexi_netpay_schedule_list->renderRow();

		// Render list options
		$payflexi_netpay_schedule_list->renderListOptions();
?>
	<tr <?php echo $payflexi_netpay_schedule->rowAttributes() ?>>
<?php

// Render list options (body, left)
$payflexi_netpay_schedule_list->ListOptions->render("body", "left", $payflexi_netpay_schedule_list->RowCount);
?>
	<?php if ($payflexi_netpay_schedule_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $payflexi_netpay_schedule_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $payflexi_netpay_schedule_list->RowCount ?>_payflexi_netpay_schedule_EmployeeID">
<span<?php echo $payflexi_netpay_schedule_list->EmployeeID->viewAttributes() ?>><?php echo $payflexi_netpay_schedule_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payflexi_netpay_schedule_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $payflexi_netpay_schedule_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $payflexi_netpay_schedule_list->RowCount ?>_payflexi_netpay_schedule_FirstName">
<span<?php echo $payflexi_netpay_schedule_list->FirstName->viewAttributes() ?>><?php echo $payflexi_netpay_schedule_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payflexi_netpay_schedule_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $payflexi_netpay_schedule_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $payflexi_netpay_schedule_list->RowCount ?>_payflexi_netpay_schedule_Surname">
<span<?php echo $payflexi_netpay_schedule_list->Surname->viewAttributes() ?>><?php echo $payflexi_netpay_schedule_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payflexi_netpay_schedule_list->NAME_OF_BENEFICIARY->Visible) { // NAME OF BENEFICIARY ?>
		<td data-name="NAME_OF_BENEFICIARY" <?php echo $payflexi_netpay_schedule_list->NAME_OF_BENEFICIARY->cellAttributes() ?>>
<span id="el<?php echo $payflexi_netpay_schedule_list->RowCount ?>_payflexi_netpay_schedule_NAME_OF_BENEFICIARY">
<span<?php echo $payflexi_netpay_schedule_list->NAME_OF_BENEFICIARY->viewAttributes() ?>><?php echo $payflexi_netpay_schedule_list->NAME_OF_BENEFICIARY->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payflexi_netpay_schedule_list->ACCOUNT_NUMBER->Visible) { // ACCOUNT NUMBER ?>
		<td data-name="ACCOUNT_NUMBER" <?php echo $payflexi_netpay_schedule_list->ACCOUNT_NUMBER->cellAttributes() ?>>
<span id="el<?php echo $payflexi_netpay_schedule_list->RowCount ?>_payflexi_netpay_schedule_ACCOUNT_NUMBER">
<span<?php echo $payflexi_netpay_schedule_list->ACCOUNT_NUMBER->viewAttributes() ?>><?php echo $payflexi_netpay_schedule_list->ACCOUNT_NUMBER->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payflexi_netpay_schedule_list->SORT_CODE->Visible) { // SORT CODE ?>
		<td data-name="SORT_CODE" <?php echo $payflexi_netpay_schedule_list->SORT_CODE->cellAttributes() ?>>
<span id="el<?php echo $payflexi_netpay_schedule_list->RowCount ?>_payflexi_netpay_schedule_SORT_CODE">
<span<?php echo $payflexi_netpay_schedule_list->SORT_CODE->viewAttributes() ?>><?php echo $payflexi_netpay_schedule_list->SORT_CODE->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payflexi_netpay_schedule_list->GrossPay->Visible) { // GrossPay ?>
		<td data-name="GrossPay" <?php echo $payflexi_netpay_schedule_list->GrossPay->cellAttributes() ?>>
<span id="el<?php echo $payflexi_netpay_schedule_list->RowCount ?>_payflexi_netpay_schedule_GrossPay">
<span<?php echo $payflexi_netpay_schedule_list->GrossPay->viewAttributes() ?>><?php echo $payflexi_netpay_schedule_list->GrossPay->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payflexi_netpay_schedule_list->TotalDeductions->Visible) { // TotalDeductions ?>
		<td data-name="TotalDeductions" <?php echo $payflexi_netpay_schedule_list->TotalDeductions->cellAttributes() ?>>
<span id="el<?php echo $payflexi_netpay_schedule_list->RowCount ?>_payflexi_netpay_schedule_TotalDeductions">
<span<?php echo $payflexi_netpay_schedule_list->TotalDeductions->viewAttributes() ?>><?php echo $payflexi_netpay_schedule_list->TotalDeductions->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payflexi_netpay_schedule_list->AMOUNT->Visible) { // AMOUNT ?>
		<td data-name="AMOUNT" <?php echo $payflexi_netpay_schedule_list->AMOUNT->cellAttributes() ?>>
<span id="el<?php echo $payflexi_netpay_schedule_list->RowCount ?>_payflexi_netpay_schedule_AMOUNT">
<span<?php echo $payflexi_netpay_schedule_list->AMOUNT->viewAttributes() ?>><?php echo $payflexi_netpay_schedule_list->AMOUNT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payflexi_netpay_schedule_list->REFERENCE->Visible) { // REFERENCE ?>
		<td data-name="REFERENCE" <?php echo $payflexi_netpay_schedule_list->REFERENCE->cellAttributes() ?>>
<span id="el<?php echo $payflexi_netpay_schedule_list->RowCount ?>_payflexi_netpay_schedule_REFERENCE">
<span<?php echo $payflexi_netpay_schedule_list->REFERENCE->viewAttributes() ?>><?php echo $payflexi_netpay_schedule_list->REFERENCE->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$payflexi_netpay_schedule_list->ListOptions->render("body", "right", $payflexi_netpay_schedule_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$payflexi_netpay_schedule_list->isGridAdd())
		$payflexi_netpay_schedule_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$payflexi_netpay_schedule->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($payflexi_netpay_schedule_list->Recordset)
	$payflexi_netpay_schedule_list->Recordset->Close();
?>
<?php if (!$payflexi_netpay_schedule_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$payflexi_netpay_schedule_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payflexi_netpay_schedule_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $payflexi_netpay_schedule_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($payflexi_netpay_schedule_list->TotalRecords == 0 && !$payflexi_netpay_schedule->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $payflexi_netpay_schedule_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$payflexi_netpay_schedule_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$payflexi_netpay_schedule_list->isExport()) { ?>
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
$payflexi_netpay_schedule_list->terminate();
?>