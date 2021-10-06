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
$payflexi_netpay_schedule_2_list = new payflexi_netpay_schedule_2_list();

// Run the page
$payflexi_netpay_schedule_2_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payflexi_netpay_schedule_2_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$payflexi_netpay_schedule_2_list->isExport()) { ?>
<script>
var fpayflexi_netpay_schedule_2list, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpayflexi_netpay_schedule_2list = currentForm = new ew.Form("fpayflexi_netpay_schedule_2list", "list");
	fpayflexi_netpay_schedule_2list.formKeyCountName = '<?php echo $payflexi_netpay_schedule_2_list->FormKeyCountName ?>';
	loadjs.done("fpayflexi_netpay_schedule_2list");
});
var fpayflexi_netpay_schedule_2listsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpayflexi_netpay_schedule_2listsrch = currentSearchForm = new ew.Form("fpayflexi_netpay_schedule_2listsrch");

	// Dynamic selection lists
	// Filters

	fpayflexi_netpay_schedule_2listsrch.filterList = <?php echo $payflexi_netpay_schedule_2_list->getFilterList() ?>;

	// Init search panel as collapsed
	fpayflexi_netpay_schedule_2listsrch.initSearchPanel = true;
	loadjs.done("fpayflexi_netpay_schedule_2listsrch");
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
<?php if (!$payflexi_netpay_schedule_2_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($payflexi_netpay_schedule_2_list->TotalRecords > 0 && $payflexi_netpay_schedule_2_list->ExportOptions->visible()) { ?>
<?php $payflexi_netpay_schedule_2_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_2_list->ImportOptions->visible()) { ?>
<?php $payflexi_netpay_schedule_2_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_2_list->SearchOptions->visible()) { ?>
<?php $payflexi_netpay_schedule_2_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_2_list->FilterOptions->visible()) { ?>
<?php $payflexi_netpay_schedule_2_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$payflexi_netpay_schedule_2_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$payflexi_netpay_schedule_2_list->isExport() && !$payflexi_netpay_schedule_2->CurrentAction) { ?>
<form name="fpayflexi_netpay_schedule_2listsrch" id="fpayflexi_netpay_schedule_2listsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpayflexi_netpay_schedule_2listsrch-search-panel" class="<?php echo $payflexi_netpay_schedule_2_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="payflexi_netpay_schedule_2">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $payflexi_netpay_schedule_2_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($payflexi_netpay_schedule_2_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($payflexi_netpay_schedule_2_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $payflexi_netpay_schedule_2_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($payflexi_netpay_schedule_2_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($payflexi_netpay_schedule_2_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($payflexi_netpay_schedule_2_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($payflexi_netpay_schedule_2_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $payflexi_netpay_schedule_2_list->showPageHeader(); ?>
<?php
$payflexi_netpay_schedule_2_list->showMessage();
?>
<?php if ($payflexi_netpay_schedule_2_list->TotalRecords > 0 || $payflexi_netpay_schedule_2->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($payflexi_netpay_schedule_2_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> payflexi_netpay_schedule_2">
<?php if (!$payflexi_netpay_schedule_2_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$payflexi_netpay_schedule_2_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payflexi_netpay_schedule_2_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $payflexi_netpay_schedule_2_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpayflexi_netpay_schedule_2list" id="fpayflexi_netpay_schedule_2list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payflexi_netpay_schedule_2">
<div id="gmp_payflexi_netpay_schedule_2" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($payflexi_netpay_schedule_2_list->TotalRecords > 0 || $payflexi_netpay_schedule_2_list->isGridEdit()) { ?>
<table id="tbl_payflexi_netpay_schedule_2list" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$payflexi_netpay_schedule_2->RowType = ROWTYPE_HEADER;

// Render list options
$payflexi_netpay_schedule_2_list->renderListOptions();

// Render list options (header, left)
$payflexi_netpay_schedule_2_list->ListOptions->render("header", "left");
?>
<?php if ($payflexi_netpay_schedule_2_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($payflexi_netpay_schedule_2_list->SortUrl($payflexi_netpay_schedule_2_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $payflexi_netpay_schedule_2_list->EmployeeID->headerCellClass() ?>"><div id="elh_payflexi_netpay_schedule_2_EmployeeID" class="payflexi_netpay_schedule_2_EmployeeID"><div class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_2_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $payflexi_netpay_schedule_2_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payflexi_netpay_schedule_2_list->SortUrl($payflexi_netpay_schedule_2_list->EmployeeID) ?>', 1);"><div id="elh_payflexi_netpay_schedule_2_EmployeeID" class="payflexi_netpay_schedule_2_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_2_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($payflexi_netpay_schedule_2_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payflexi_netpay_schedule_2_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_2_list->FirstName->Visible) { // FirstName ?>
	<?php if ($payflexi_netpay_schedule_2_list->SortUrl($payflexi_netpay_schedule_2_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $payflexi_netpay_schedule_2_list->FirstName->headerCellClass() ?>"><div id="elh_payflexi_netpay_schedule_2_FirstName" class="payflexi_netpay_schedule_2_FirstName"><div class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_2_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $payflexi_netpay_schedule_2_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payflexi_netpay_schedule_2_list->SortUrl($payflexi_netpay_schedule_2_list->FirstName) ?>', 1);"><div id="elh_payflexi_netpay_schedule_2_FirstName" class="payflexi_netpay_schedule_2_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_2_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payflexi_netpay_schedule_2_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payflexi_netpay_schedule_2_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_2_list->Middle_Name->Visible) { // Middle Name ?>
	<?php if ($payflexi_netpay_schedule_2_list->SortUrl($payflexi_netpay_schedule_2_list->Middle_Name) == "") { ?>
		<th data-name="Middle_Name" class="<?php echo $payflexi_netpay_schedule_2_list->Middle_Name->headerCellClass() ?>"><div id="elh_payflexi_netpay_schedule_2_Middle_Name" class="payflexi_netpay_schedule_2_Middle_Name"><div class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_2_list->Middle_Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Middle_Name" class="<?php echo $payflexi_netpay_schedule_2_list->Middle_Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payflexi_netpay_schedule_2_list->SortUrl($payflexi_netpay_schedule_2_list->Middle_Name) ?>', 1);"><div id="elh_payflexi_netpay_schedule_2_Middle_Name" class="payflexi_netpay_schedule_2_Middle_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_2_list->Middle_Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payflexi_netpay_schedule_2_list->Middle_Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payflexi_netpay_schedule_2_list->Middle_Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_2_list->Surname->Visible) { // Surname ?>
	<?php if ($payflexi_netpay_schedule_2_list->SortUrl($payflexi_netpay_schedule_2_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $payflexi_netpay_schedule_2_list->Surname->headerCellClass() ?>"><div id="elh_payflexi_netpay_schedule_2_Surname" class="payflexi_netpay_schedule_2_Surname"><div class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_2_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $payflexi_netpay_schedule_2_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payflexi_netpay_schedule_2_list->SortUrl($payflexi_netpay_schedule_2_list->Surname) ?>', 1);"><div id="elh_payflexi_netpay_schedule_2_Surname" class="payflexi_netpay_schedule_2_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_2_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payflexi_netpay_schedule_2_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payflexi_netpay_schedule_2_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_2_list->ORIGINATING_ACCT_NO->Visible) { // ORIGINATING ACCT NO ?>
	<?php if ($payflexi_netpay_schedule_2_list->SortUrl($payflexi_netpay_schedule_2_list->ORIGINATING_ACCT_NO) == "") { ?>
		<th data-name="ORIGINATING_ACCT_NO" class="<?php echo $payflexi_netpay_schedule_2_list->ORIGINATING_ACCT_NO->headerCellClass() ?>"><div id="elh_payflexi_netpay_schedule_2_ORIGINATING_ACCT_NO" class="payflexi_netpay_schedule_2_ORIGINATING_ACCT_NO"><div class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_2_list->ORIGINATING_ACCT_NO->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ORIGINATING_ACCT_NO" class="<?php echo $payflexi_netpay_schedule_2_list->ORIGINATING_ACCT_NO->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payflexi_netpay_schedule_2_list->SortUrl($payflexi_netpay_schedule_2_list->ORIGINATING_ACCT_NO) ?>', 1);"><div id="elh_payflexi_netpay_schedule_2_ORIGINATING_ACCT_NO" class="payflexi_netpay_schedule_2_ORIGINATING_ACCT_NO">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_2_list->ORIGINATING_ACCT_NO->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payflexi_netpay_schedule_2_list->ORIGINATING_ACCT_NO->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payflexi_netpay_schedule_2_list->ORIGINATING_ACCT_NO->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_2_list->DEST_SORT_CODE->Visible) { // DEST SORT CODE ?>
	<?php if ($payflexi_netpay_schedule_2_list->SortUrl($payflexi_netpay_schedule_2_list->DEST_SORT_CODE) == "") { ?>
		<th data-name="DEST_SORT_CODE" class="<?php echo $payflexi_netpay_schedule_2_list->DEST_SORT_CODE->headerCellClass() ?>"><div id="elh_payflexi_netpay_schedule_2_DEST_SORT_CODE" class="payflexi_netpay_schedule_2_DEST_SORT_CODE"><div class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_2_list->DEST_SORT_CODE->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DEST_SORT_CODE" class="<?php echo $payflexi_netpay_schedule_2_list->DEST_SORT_CODE->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payflexi_netpay_schedule_2_list->SortUrl($payflexi_netpay_schedule_2_list->DEST_SORT_CODE) ?>', 1);"><div id="elh_payflexi_netpay_schedule_2_DEST_SORT_CODE" class="payflexi_netpay_schedule_2_DEST_SORT_CODE">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_2_list->DEST_SORT_CODE->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payflexi_netpay_schedule_2_list->DEST_SORT_CODE->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payflexi_netpay_schedule_2_list->DEST_SORT_CODE->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_2_list->DEST_ACCT_NO->Visible) { // DEST ACCT NO ?>
	<?php if ($payflexi_netpay_schedule_2_list->SortUrl($payflexi_netpay_schedule_2_list->DEST_ACCT_NO) == "") { ?>
		<th data-name="DEST_ACCT_NO" class="<?php echo $payflexi_netpay_schedule_2_list->DEST_ACCT_NO->headerCellClass() ?>"><div id="elh_payflexi_netpay_schedule_2_DEST_ACCT_NO" class="payflexi_netpay_schedule_2_DEST_ACCT_NO"><div class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_2_list->DEST_ACCT_NO->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DEST_ACCT_NO" class="<?php echo $payflexi_netpay_schedule_2_list->DEST_ACCT_NO->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payflexi_netpay_schedule_2_list->SortUrl($payflexi_netpay_schedule_2_list->DEST_ACCT_NO) ?>', 1);"><div id="elh_payflexi_netpay_schedule_2_DEST_ACCT_NO" class="payflexi_netpay_schedule_2_DEST_ACCT_NO">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_2_list->DEST_ACCT_NO->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payflexi_netpay_schedule_2_list->DEST_ACCT_NO->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payflexi_netpay_schedule_2_list->DEST_ACCT_NO->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_2_list->GrossPay->Visible) { // GrossPay ?>
	<?php if ($payflexi_netpay_schedule_2_list->SortUrl($payflexi_netpay_schedule_2_list->GrossPay) == "") { ?>
		<th data-name="GrossPay" class="<?php echo $payflexi_netpay_schedule_2_list->GrossPay->headerCellClass() ?>"><div id="elh_payflexi_netpay_schedule_2_GrossPay" class="payflexi_netpay_schedule_2_GrossPay"><div class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_2_list->GrossPay->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="GrossPay" class="<?php echo $payflexi_netpay_schedule_2_list->GrossPay->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payflexi_netpay_schedule_2_list->SortUrl($payflexi_netpay_schedule_2_list->GrossPay) ?>', 1);"><div id="elh_payflexi_netpay_schedule_2_GrossPay" class="payflexi_netpay_schedule_2_GrossPay">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_2_list->GrossPay->caption() ?></span><span class="ew-table-header-sort"><?php if ($payflexi_netpay_schedule_2_list->GrossPay->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payflexi_netpay_schedule_2_list->GrossPay->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_2_list->TotalDeductions->Visible) { // TotalDeductions ?>
	<?php if ($payflexi_netpay_schedule_2_list->SortUrl($payflexi_netpay_schedule_2_list->TotalDeductions) == "") { ?>
		<th data-name="TotalDeductions" class="<?php echo $payflexi_netpay_schedule_2_list->TotalDeductions->headerCellClass() ?>"><div id="elh_payflexi_netpay_schedule_2_TotalDeductions" class="payflexi_netpay_schedule_2_TotalDeductions"><div class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_2_list->TotalDeductions->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TotalDeductions" class="<?php echo $payflexi_netpay_schedule_2_list->TotalDeductions->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payflexi_netpay_schedule_2_list->SortUrl($payflexi_netpay_schedule_2_list->TotalDeductions) ?>', 1);"><div id="elh_payflexi_netpay_schedule_2_TotalDeductions" class="payflexi_netpay_schedule_2_TotalDeductions">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_2_list->TotalDeductions->caption() ?></span><span class="ew-table-header-sort"><?php if ($payflexi_netpay_schedule_2_list->TotalDeductions->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payflexi_netpay_schedule_2_list->TotalDeductions->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_2_list->NARRATION->Visible) { // NARRATION ?>
	<?php if ($payflexi_netpay_schedule_2_list->SortUrl($payflexi_netpay_schedule_2_list->NARRATION) == "") { ?>
		<th data-name="NARRATION" class="<?php echo $payflexi_netpay_schedule_2_list->NARRATION->headerCellClass() ?>"><div id="elh_payflexi_netpay_schedule_2_NARRATION" class="payflexi_netpay_schedule_2_NARRATION"><div class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_2_list->NARRATION->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NARRATION" class="<?php echo $payflexi_netpay_schedule_2_list->NARRATION->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payflexi_netpay_schedule_2_list->SortUrl($payflexi_netpay_schedule_2_list->NARRATION) ?>', 1);"><div id="elh_payflexi_netpay_schedule_2_NARRATION" class="payflexi_netpay_schedule_2_NARRATION">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_2_list->NARRATION->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payflexi_netpay_schedule_2_list->NARRATION->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payflexi_netpay_schedule_2_list->NARRATION->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_2_list->REF->Visible) { // REF ?>
	<?php if ($payflexi_netpay_schedule_2_list->SortUrl($payflexi_netpay_schedule_2_list->REF) == "") { ?>
		<th data-name="REF" class="<?php echo $payflexi_netpay_schedule_2_list->REF->headerCellClass() ?>"><div id="elh_payflexi_netpay_schedule_2_REF" class="payflexi_netpay_schedule_2_REF"><div class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_2_list->REF->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="REF" class="<?php echo $payflexi_netpay_schedule_2_list->REF->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payflexi_netpay_schedule_2_list->SortUrl($payflexi_netpay_schedule_2_list->REF) ?>', 1);"><div id="elh_payflexi_netpay_schedule_2_REF" class="payflexi_netpay_schedule_2_REF">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_2_list->REF->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payflexi_netpay_schedule_2_list->REF->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payflexi_netpay_schedule_2_list->REF->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payflexi_netpay_schedule_2_list->AMOUNT->Visible) { // AMOUNT ?>
	<?php if ($payflexi_netpay_schedule_2_list->SortUrl($payflexi_netpay_schedule_2_list->AMOUNT) == "") { ?>
		<th data-name="AMOUNT" class="<?php echo $payflexi_netpay_schedule_2_list->AMOUNT->headerCellClass() ?>"><div id="elh_payflexi_netpay_schedule_2_AMOUNT" class="payflexi_netpay_schedule_2_AMOUNT"><div class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_2_list->AMOUNT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AMOUNT" class="<?php echo $payflexi_netpay_schedule_2_list->AMOUNT->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payflexi_netpay_schedule_2_list->SortUrl($payflexi_netpay_schedule_2_list->AMOUNT) ?>', 1);"><div id="elh_payflexi_netpay_schedule_2_AMOUNT" class="payflexi_netpay_schedule_2_AMOUNT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payflexi_netpay_schedule_2_list->AMOUNT->caption() ?></span><span class="ew-table-header-sort"><?php if ($payflexi_netpay_schedule_2_list->AMOUNT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payflexi_netpay_schedule_2_list->AMOUNT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$payflexi_netpay_schedule_2_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($payflexi_netpay_schedule_2_list->ExportAll && $payflexi_netpay_schedule_2_list->isExport()) {
	$payflexi_netpay_schedule_2_list->StopRecord = $payflexi_netpay_schedule_2_list->TotalRecords;
} else {

	// Set the last record to display
	if ($payflexi_netpay_schedule_2_list->TotalRecords > $payflexi_netpay_schedule_2_list->StartRecord + $payflexi_netpay_schedule_2_list->DisplayRecords - 1)
		$payflexi_netpay_schedule_2_list->StopRecord = $payflexi_netpay_schedule_2_list->StartRecord + $payflexi_netpay_schedule_2_list->DisplayRecords - 1;
	else
		$payflexi_netpay_schedule_2_list->StopRecord = $payflexi_netpay_schedule_2_list->TotalRecords;
}
$payflexi_netpay_schedule_2_list->RecordCount = $payflexi_netpay_schedule_2_list->StartRecord - 1;
if ($payflexi_netpay_schedule_2_list->Recordset && !$payflexi_netpay_schedule_2_list->Recordset->EOF) {
	$payflexi_netpay_schedule_2_list->Recordset->moveFirst();
	$selectLimit = $payflexi_netpay_schedule_2_list->UseSelectLimit;
	if (!$selectLimit && $payflexi_netpay_schedule_2_list->StartRecord > 1)
		$payflexi_netpay_schedule_2_list->Recordset->move($payflexi_netpay_schedule_2_list->StartRecord - 1);
} elseif (!$payflexi_netpay_schedule_2->AllowAddDeleteRow && $payflexi_netpay_schedule_2_list->StopRecord == 0) {
	$payflexi_netpay_schedule_2_list->StopRecord = $payflexi_netpay_schedule_2->GridAddRowCount;
}

// Initialize aggregate
$payflexi_netpay_schedule_2->RowType = ROWTYPE_AGGREGATEINIT;
$payflexi_netpay_schedule_2->resetAttributes();
$payflexi_netpay_schedule_2_list->renderRow();
while ($payflexi_netpay_schedule_2_list->RecordCount < $payflexi_netpay_schedule_2_list->StopRecord) {
	$payflexi_netpay_schedule_2_list->RecordCount++;
	if ($payflexi_netpay_schedule_2_list->RecordCount >= $payflexi_netpay_schedule_2_list->StartRecord) {
		$payflexi_netpay_schedule_2_list->RowCount++;

		// Set up key count
		$payflexi_netpay_schedule_2_list->KeyCount = $payflexi_netpay_schedule_2_list->RowIndex;

		// Init row class and style
		$payflexi_netpay_schedule_2->resetAttributes();
		$payflexi_netpay_schedule_2->CssClass = "";
		if ($payflexi_netpay_schedule_2_list->isGridAdd()) {
		} else {
			$payflexi_netpay_schedule_2_list->loadRowValues($payflexi_netpay_schedule_2_list->Recordset); // Load row values
		}
		$payflexi_netpay_schedule_2->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$payflexi_netpay_schedule_2->RowAttrs->merge(["data-rowindex" => $payflexi_netpay_schedule_2_list->RowCount, "id" => "r" . $payflexi_netpay_schedule_2_list->RowCount . "_payflexi_netpay_schedule_2", "data-rowtype" => $payflexi_netpay_schedule_2->RowType]);

		// Render row
		$payflexi_netpay_schedule_2_list->renderRow();

		// Render list options
		$payflexi_netpay_schedule_2_list->renderListOptions();
?>
	<tr <?php echo $payflexi_netpay_schedule_2->rowAttributes() ?>>
<?php

// Render list options (body, left)
$payflexi_netpay_schedule_2_list->ListOptions->render("body", "left", $payflexi_netpay_schedule_2_list->RowCount);
?>
	<?php if ($payflexi_netpay_schedule_2_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $payflexi_netpay_schedule_2_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $payflexi_netpay_schedule_2_list->RowCount ?>_payflexi_netpay_schedule_2_EmployeeID">
<span<?php echo $payflexi_netpay_schedule_2_list->EmployeeID->viewAttributes() ?>><?php echo $payflexi_netpay_schedule_2_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payflexi_netpay_schedule_2_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $payflexi_netpay_schedule_2_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $payflexi_netpay_schedule_2_list->RowCount ?>_payflexi_netpay_schedule_2_FirstName">
<span<?php echo $payflexi_netpay_schedule_2_list->FirstName->viewAttributes() ?>><?php echo $payflexi_netpay_schedule_2_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payflexi_netpay_schedule_2_list->Middle_Name->Visible) { // Middle Name ?>
		<td data-name="Middle_Name" <?php echo $payflexi_netpay_schedule_2_list->Middle_Name->cellAttributes() ?>>
<span id="el<?php echo $payflexi_netpay_schedule_2_list->RowCount ?>_payflexi_netpay_schedule_2_Middle_Name">
<span<?php echo $payflexi_netpay_schedule_2_list->Middle_Name->viewAttributes() ?>><?php echo $payflexi_netpay_schedule_2_list->Middle_Name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payflexi_netpay_schedule_2_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $payflexi_netpay_schedule_2_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $payflexi_netpay_schedule_2_list->RowCount ?>_payflexi_netpay_schedule_2_Surname">
<span<?php echo $payflexi_netpay_schedule_2_list->Surname->viewAttributes() ?>><?php echo $payflexi_netpay_schedule_2_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payflexi_netpay_schedule_2_list->ORIGINATING_ACCT_NO->Visible) { // ORIGINATING ACCT NO ?>
		<td data-name="ORIGINATING_ACCT_NO" <?php echo $payflexi_netpay_schedule_2_list->ORIGINATING_ACCT_NO->cellAttributes() ?>>
<span id="el<?php echo $payflexi_netpay_schedule_2_list->RowCount ?>_payflexi_netpay_schedule_2_ORIGINATING_ACCT_NO">
<span<?php echo $payflexi_netpay_schedule_2_list->ORIGINATING_ACCT_NO->viewAttributes() ?>><?php echo $payflexi_netpay_schedule_2_list->ORIGINATING_ACCT_NO->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payflexi_netpay_schedule_2_list->DEST_SORT_CODE->Visible) { // DEST SORT CODE ?>
		<td data-name="DEST_SORT_CODE" <?php echo $payflexi_netpay_schedule_2_list->DEST_SORT_CODE->cellAttributes() ?>>
<span id="el<?php echo $payflexi_netpay_schedule_2_list->RowCount ?>_payflexi_netpay_schedule_2_DEST_SORT_CODE">
<span<?php echo $payflexi_netpay_schedule_2_list->DEST_SORT_CODE->viewAttributes() ?>><?php echo $payflexi_netpay_schedule_2_list->DEST_SORT_CODE->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payflexi_netpay_schedule_2_list->DEST_ACCT_NO->Visible) { // DEST ACCT NO ?>
		<td data-name="DEST_ACCT_NO" <?php echo $payflexi_netpay_schedule_2_list->DEST_ACCT_NO->cellAttributes() ?>>
<span id="el<?php echo $payflexi_netpay_schedule_2_list->RowCount ?>_payflexi_netpay_schedule_2_DEST_ACCT_NO">
<span<?php echo $payflexi_netpay_schedule_2_list->DEST_ACCT_NO->viewAttributes() ?>><?php echo $payflexi_netpay_schedule_2_list->DEST_ACCT_NO->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payflexi_netpay_schedule_2_list->GrossPay->Visible) { // GrossPay ?>
		<td data-name="GrossPay" <?php echo $payflexi_netpay_schedule_2_list->GrossPay->cellAttributes() ?>>
<span id="el<?php echo $payflexi_netpay_schedule_2_list->RowCount ?>_payflexi_netpay_schedule_2_GrossPay">
<span<?php echo $payflexi_netpay_schedule_2_list->GrossPay->viewAttributes() ?>><?php echo $payflexi_netpay_schedule_2_list->GrossPay->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payflexi_netpay_schedule_2_list->TotalDeductions->Visible) { // TotalDeductions ?>
		<td data-name="TotalDeductions" <?php echo $payflexi_netpay_schedule_2_list->TotalDeductions->cellAttributes() ?>>
<span id="el<?php echo $payflexi_netpay_schedule_2_list->RowCount ?>_payflexi_netpay_schedule_2_TotalDeductions">
<span<?php echo $payflexi_netpay_schedule_2_list->TotalDeductions->viewAttributes() ?>><?php echo $payflexi_netpay_schedule_2_list->TotalDeductions->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payflexi_netpay_schedule_2_list->NARRATION->Visible) { // NARRATION ?>
		<td data-name="NARRATION" <?php echo $payflexi_netpay_schedule_2_list->NARRATION->cellAttributes() ?>>
<span id="el<?php echo $payflexi_netpay_schedule_2_list->RowCount ?>_payflexi_netpay_schedule_2_NARRATION">
<span<?php echo $payflexi_netpay_schedule_2_list->NARRATION->viewAttributes() ?>><?php echo $payflexi_netpay_schedule_2_list->NARRATION->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payflexi_netpay_schedule_2_list->REF->Visible) { // REF ?>
		<td data-name="REF" <?php echo $payflexi_netpay_schedule_2_list->REF->cellAttributes() ?>>
<span id="el<?php echo $payflexi_netpay_schedule_2_list->RowCount ?>_payflexi_netpay_schedule_2_REF">
<span<?php echo $payflexi_netpay_schedule_2_list->REF->viewAttributes() ?>><?php echo $payflexi_netpay_schedule_2_list->REF->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payflexi_netpay_schedule_2_list->AMOUNT->Visible) { // AMOUNT ?>
		<td data-name="AMOUNT" <?php echo $payflexi_netpay_schedule_2_list->AMOUNT->cellAttributes() ?>>
<span id="el<?php echo $payflexi_netpay_schedule_2_list->RowCount ?>_payflexi_netpay_schedule_2_AMOUNT">
<span<?php echo $payflexi_netpay_schedule_2_list->AMOUNT->viewAttributes() ?>><?php echo $payflexi_netpay_schedule_2_list->AMOUNT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$payflexi_netpay_schedule_2_list->ListOptions->render("body", "right", $payflexi_netpay_schedule_2_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$payflexi_netpay_schedule_2_list->isGridAdd())
		$payflexi_netpay_schedule_2_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$payflexi_netpay_schedule_2->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($payflexi_netpay_schedule_2_list->Recordset)
	$payflexi_netpay_schedule_2_list->Recordset->Close();
?>
<?php if (!$payflexi_netpay_schedule_2_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$payflexi_netpay_schedule_2_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payflexi_netpay_schedule_2_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $payflexi_netpay_schedule_2_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($payflexi_netpay_schedule_2_list->TotalRecords == 0 && !$payflexi_netpay_schedule_2->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $payflexi_netpay_schedule_2_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$payflexi_netpay_schedule_2_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$payflexi_netpay_schedule_2_list->isExport()) { ?>
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
$payflexi_netpay_schedule_2_list->terminate();
?>