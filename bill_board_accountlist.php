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
$bill_board_account_list = new bill_board_account_list();

// Run the page
$bill_board_account_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bill_board_account_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$bill_board_account_list->isExport()) { ?>
<script>
var fbill_board_accountlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fbill_board_accountlist = currentForm = new ew.Form("fbill_board_accountlist", "list");
	fbill_board_accountlist.formKeyCountName = '<?php echo $bill_board_account_list->FormKeyCountName ?>';
	loadjs.done("fbill_board_accountlist");
});
var fbill_board_accountlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fbill_board_accountlistsrch = currentSearchForm = new ew.Form("fbill_board_accountlistsrch");

	// Dynamic selection lists
	// Filters

	fbill_board_accountlistsrch.filterList = <?php echo $bill_board_account_list->getFilterList() ?>;

	// Init search panel as collapsed
	fbill_board_accountlistsrch.initSearchPanel = true;
	loadjs.done("fbill_board_accountlistsrch");
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
<?php if (!$bill_board_account_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($bill_board_account_list->TotalRecords > 0 && $bill_board_account_list->ExportOptions->visible()) { ?>
<?php $bill_board_account_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($bill_board_account_list->ImportOptions->visible()) { ?>
<?php $bill_board_account_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($bill_board_account_list->SearchOptions->visible()) { ?>
<?php $bill_board_account_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($bill_board_account_list->FilterOptions->visible()) { ?>
<?php $bill_board_account_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$bill_board_account_list->isExport() || Config("EXPORT_MASTER_RECORD") && $bill_board_account_list->isExport("print")) { ?>
<?php
if ($bill_board_account_list->DbMasterFilter != "" && $bill_board_account->getCurrentMasterTable() == "bill_board") {
	if ($bill_board_account_list->MasterRecordExists) {
		include_once "bill_boardmaster.php";
	}
}
?>
<?php } ?>
<?php
$bill_board_account_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$bill_board_account_list->isExport() && !$bill_board_account->CurrentAction) { ?>
<form name="fbill_board_accountlistsrch" id="fbill_board_accountlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fbill_board_accountlistsrch-search-panel" class="<?php echo $bill_board_account_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="bill_board_account">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $bill_board_account_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($bill_board_account_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($bill_board_account_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $bill_board_account_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($bill_board_account_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($bill_board_account_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($bill_board_account_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($bill_board_account_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $bill_board_account_list->showPageHeader(); ?>
<?php
$bill_board_account_list->showMessage();
?>
<?php if ($bill_board_account_list->TotalRecords > 0 || $bill_board_account->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($bill_board_account_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> bill_board_account">
<?php if (!$bill_board_account_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$bill_board_account_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $bill_board_account_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $bill_board_account_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fbill_board_accountlist" id="fbill_board_accountlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bill_board_account">
<?php if ($bill_board_account->getCurrentMasterTable() == "bill_board" && $bill_board_account->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="bill_board">
<input type="hidden" name="fk_BillBoardNo" value="<?php echo HtmlEncode($bill_board_account_list->BillBoardNo->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_bill_board_account" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($bill_board_account_list->TotalRecords > 0 || $bill_board_account_list->isGridEdit()) { ?>
<table id="tbl_bill_board_accountlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$bill_board_account->RowType = ROWTYPE_HEADER;

// Render list options
$bill_board_account_list->renderListOptions();

// Render list options (header, left)
$bill_board_account_list->ListOptions->render("header", "left");
?>
<?php if ($bill_board_account_list->AccountNo->Visible) { // AccountNo ?>
	<?php if ($bill_board_account_list->SortUrl($bill_board_account_list->AccountNo) == "") { ?>
		<th data-name="AccountNo" class="<?php echo $bill_board_account_list->AccountNo->headerCellClass() ?>"><div id="elh_bill_board_account_AccountNo" class="bill_board_account_AccountNo"><div class="ew-table-header-caption"><?php echo $bill_board_account_list->AccountNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountNo" class="<?php echo $bill_board_account_list->AccountNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_account_list->SortUrl($bill_board_account_list->AccountNo) ?>', 1);"><div id="elh_bill_board_account_AccountNo" class="bill_board_account_AccountNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_list->AccountNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_list->AccountNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_list->AccountNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_list->BillBoardNo->Visible) { // BillBoardNo ?>
	<?php if ($bill_board_account_list->SortUrl($bill_board_account_list->BillBoardNo) == "") { ?>
		<th data-name="BillBoardNo" class="<?php echo $bill_board_account_list->BillBoardNo->headerCellClass() ?>"><div id="elh_bill_board_account_BillBoardNo" class="bill_board_account_BillBoardNo"><div class="ew-table-header-caption"><?php echo $bill_board_account_list->BillBoardNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillBoardNo" class="<?php echo $bill_board_account_list->BillBoardNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_account_list->SortUrl($bill_board_account_list->BillBoardNo) ?>', 1);"><div id="elh_bill_board_account_BillBoardNo" class="bill_board_account_BillBoardNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_list->BillBoardNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_list->BillBoardNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_list->BillBoardNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_list->ClientID->Visible) { // ClientID ?>
	<?php if ($bill_board_account_list->SortUrl($bill_board_account_list->ClientID) == "") { ?>
		<th data-name="ClientID" class="<?php echo $bill_board_account_list->ClientID->headerCellClass() ?>"><div id="elh_bill_board_account_ClientID" class="bill_board_account_ClientID"><div class="ew-table-header-caption"><?php echo $bill_board_account_list->ClientID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientID" class="<?php echo $bill_board_account_list->ClientID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_account_list->SortUrl($bill_board_account_list->ClientID) ?>', 1);"><div id="elh_bill_board_account_ClientID" class="bill_board_account_ClientID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_list->ClientID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_list->ClientID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_list->ClientID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_list->BalanceBF->Visible) { // BalanceBF ?>
	<?php if ($bill_board_account_list->SortUrl($bill_board_account_list->BalanceBF) == "") { ?>
		<th data-name="BalanceBF" class="<?php echo $bill_board_account_list->BalanceBF->headerCellClass() ?>"><div id="elh_bill_board_account_BalanceBF" class="bill_board_account_BalanceBF"><div class="ew-table-header-caption"><?php echo $bill_board_account_list->BalanceBF->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BalanceBF" class="<?php echo $bill_board_account_list->BalanceBF->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_account_list->SortUrl($bill_board_account_list->BalanceBF) ?>', 1);"><div id="elh_bill_board_account_BalanceBF" class="bill_board_account_BalanceBF">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_list->BalanceBF->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_list->BalanceBF->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_list->BalanceBF->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_list->CurrentDemand->Visible) { // CurrentDemand ?>
	<?php if ($bill_board_account_list->SortUrl($bill_board_account_list->CurrentDemand) == "") { ?>
		<th data-name="CurrentDemand" class="<?php echo $bill_board_account_list->CurrentDemand->headerCellClass() ?>"><div id="elh_bill_board_account_CurrentDemand" class="bill_board_account_CurrentDemand"><div class="ew-table-header-caption"><?php echo $bill_board_account_list->CurrentDemand->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrentDemand" class="<?php echo $bill_board_account_list->CurrentDemand->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_account_list->SortUrl($bill_board_account_list->CurrentDemand) ?>', 1);"><div id="elh_bill_board_account_CurrentDemand" class="bill_board_account_CurrentDemand">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_list->CurrentDemand->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_list->CurrentDemand->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_list->CurrentDemand->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_list->VAT->Visible) { // VAT ?>
	<?php if ($bill_board_account_list->SortUrl($bill_board_account_list->VAT) == "") { ?>
		<th data-name="VAT" class="<?php echo $bill_board_account_list->VAT->headerCellClass() ?>"><div id="elh_bill_board_account_VAT" class="bill_board_account_VAT"><div class="ew-table-header-caption"><?php echo $bill_board_account_list->VAT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VAT" class="<?php echo $bill_board_account_list->VAT->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_account_list->SortUrl($bill_board_account_list->VAT) ?>', 1);"><div id="elh_bill_board_account_VAT" class="bill_board_account_VAT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_list->VAT->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_list->VAT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_list->VAT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_list->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($bill_board_account_list->SortUrl($bill_board_account_list->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $bill_board_account_list->AmountPaid->headerCellClass() ?>"><div id="elh_bill_board_account_AmountPaid" class="bill_board_account_AmountPaid"><div class="ew-table-header-caption"><?php echo $bill_board_account_list->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $bill_board_account_list->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_account_list->SortUrl($bill_board_account_list->AmountPaid) ?>', 1);"><div id="elh_bill_board_account_AmountPaid" class="bill_board_account_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_list->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_list->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_list->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_list->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($bill_board_account_list->SortUrl($bill_board_account_list->BillPeriod) == "") { ?>
		<th data-name="BillPeriod" class="<?php echo $bill_board_account_list->BillPeriod->headerCellClass() ?>"><div id="elh_bill_board_account_BillPeriod" class="bill_board_account_BillPeriod"><div class="ew-table-header-caption"><?php echo $bill_board_account_list->BillPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillPeriod" class="<?php echo $bill_board_account_list->BillPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_account_list->SortUrl($bill_board_account_list->BillPeriod) ?>', 1);"><div id="elh_bill_board_account_BillPeriod" class="bill_board_account_BillPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_list->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_list->BillPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_list->BillPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_list->PeriodType->Visible) { // PeriodType ?>
	<?php if ($bill_board_account_list->SortUrl($bill_board_account_list->PeriodType) == "") { ?>
		<th data-name="PeriodType" class="<?php echo $bill_board_account_list->PeriodType->headerCellClass() ?>"><div id="elh_bill_board_account_PeriodType" class="bill_board_account_PeriodType"><div class="ew-table-header-caption"><?php echo $bill_board_account_list->PeriodType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodType" class="<?php echo $bill_board_account_list->PeriodType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_account_list->SortUrl($bill_board_account_list->PeriodType) ?>', 1);"><div id="elh_bill_board_account_PeriodType" class="bill_board_account_PeriodType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_list->PeriodType->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_list->PeriodType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_list->PeriodType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_list->BillYear->Visible) { // BillYear ?>
	<?php if ($bill_board_account_list->SortUrl($bill_board_account_list->BillYear) == "") { ?>
		<th data-name="BillYear" class="<?php echo $bill_board_account_list->BillYear->headerCellClass() ?>"><div id="elh_bill_board_account_BillYear" class="bill_board_account_BillYear"><div class="ew-table-header-caption"><?php echo $bill_board_account_list->BillYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillYear" class="<?php echo $bill_board_account_list->BillYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_account_list->SortUrl($bill_board_account_list->BillYear) ?>', 1);"><div id="elh_bill_board_account_BillYear" class="bill_board_account_BillYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_list->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_list->BillYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_list->BillYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_list->StartDate->Visible) { // StartDate ?>
	<?php if ($bill_board_account_list->SortUrl($bill_board_account_list->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $bill_board_account_list->StartDate->headerCellClass() ?>"><div id="elh_bill_board_account_StartDate" class="bill_board_account_StartDate"><div class="ew-table-header-caption"><?php echo $bill_board_account_list->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $bill_board_account_list->StartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_account_list->SortUrl($bill_board_account_list->StartDate) ?>', 1);"><div id="elh_bill_board_account_StartDate" class="bill_board_account_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_list->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_list->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_list->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_list->EndDate->Visible) { // EndDate ?>
	<?php if ($bill_board_account_list->SortUrl($bill_board_account_list->EndDate) == "") { ?>
		<th data-name="EndDate" class="<?php echo $bill_board_account_list->EndDate->headerCellClass() ?>"><div id="elh_bill_board_account_EndDate" class="bill_board_account_EndDate"><div class="ew-table-header-caption"><?php echo $bill_board_account_list->EndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EndDate" class="<?php echo $bill_board_account_list->EndDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_account_list->SortUrl($bill_board_account_list->EndDate) ?>', 1);"><div id="elh_bill_board_account_EndDate" class="bill_board_account_EndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_list->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_list->EndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_list->EndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_list->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($bill_board_account_list->SortUrl($bill_board_account_list->LastUpdatedBy) == "") { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $bill_board_account_list->LastUpdatedBy->headerCellClass() ?>"><div id="elh_bill_board_account_LastUpdatedBy" class="bill_board_account_LastUpdatedBy"><div class="ew-table-header-caption"><?php echo $bill_board_account_list->LastUpdatedBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $bill_board_account_list->LastUpdatedBy->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_account_list->SortUrl($bill_board_account_list->LastUpdatedBy) ?>', 1);"><div id="elh_bill_board_account_LastUpdatedBy" class="bill_board_account_LastUpdatedBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_list->LastUpdatedBy->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_list->LastUpdatedBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_list->LastUpdatedBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$bill_board_account_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($bill_board_account_list->ExportAll && $bill_board_account_list->isExport()) {
	$bill_board_account_list->StopRecord = $bill_board_account_list->TotalRecords;
} else {

	// Set the last record to display
	if ($bill_board_account_list->TotalRecords > $bill_board_account_list->StartRecord + $bill_board_account_list->DisplayRecords - 1)
		$bill_board_account_list->StopRecord = $bill_board_account_list->StartRecord + $bill_board_account_list->DisplayRecords - 1;
	else
		$bill_board_account_list->StopRecord = $bill_board_account_list->TotalRecords;
}
$bill_board_account_list->RecordCount = $bill_board_account_list->StartRecord - 1;
if ($bill_board_account_list->Recordset && !$bill_board_account_list->Recordset->EOF) {
	$bill_board_account_list->Recordset->moveFirst();
	$selectLimit = $bill_board_account_list->UseSelectLimit;
	if (!$selectLimit && $bill_board_account_list->StartRecord > 1)
		$bill_board_account_list->Recordset->move($bill_board_account_list->StartRecord - 1);
} elseif (!$bill_board_account->AllowAddDeleteRow && $bill_board_account_list->StopRecord == 0) {
	$bill_board_account_list->StopRecord = $bill_board_account->GridAddRowCount;
}

// Initialize aggregate
$bill_board_account->RowType = ROWTYPE_AGGREGATEINIT;
$bill_board_account->resetAttributes();
$bill_board_account_list->renderRow();
while ($bill_board_account_list->RecordCount < $bill_board_account_list->StopRecord) {
	$bill_board_account_list->RecordCount++;
	if ($bill_board_account_list->RecordCount >= $bill_board_account_list->StartRecord) {
		$bill_board_account_list->RowCount++;

		// Set up key count
		$bill_board_account_list->KeyCount = $bill_board_account_list->RowIndex;

		// Init row class and style
		$bill_board_account->resetAttributes();
		$bill_board_account->CssClass = "";
		if ($bill_board_account_list->isGridAdd()) {
		} else {
			$bill_board_account_list->loadRowValues($bill_board_account_list->Recordset); // Load row values
		}
		$bill_board_account->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$bill_board_account->RowAttrs->merge(["data-rowindex" => $bill_board_account_list->RowCount, "id" => "r" . $bill_board_account_list->RowCount . "_bill_board_account", "data-rowtype" => $bill_board_account->RowType]);

		// Render row
		$bill_board_account_list->renderRow();

		// Render list options
		$bill_board_account_list->renderListOptions();
?>
	<tr <?php echo $bill_board_account->rowAttributes() ?>>
<?php

// Render list options (body, left)
$bill_board_account_list->ListOptions->render("body", "left", $bill_board_account_list->RowCount);
?>
	<?php if ($bill_board_account_list->AccountNo->Visible) { // AccountNo ?>
		<td data-name="AccountNo" <?php echo $bill_board_account_list->AccountNo->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_list->RowCount ?>_bill_board_account_AccountNo">
<span<?php echo $bill_board_account_list->AccountNo->viewAttributes() ?>><?php echo $bill_board_account_list->AccountNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_account_list->BillBoardNo->Visible) { // BillBoardNo ?>
		<td data-name="BillBoardNo" <?php echo $bill_board_account_list->BillBoardNo->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_list->RowCount ?>_bill_board_account_BillBoardNo">
<span<?php echo $bill_board_account_list->BillBoardNo->viewAttributes() ?>><?php echo $bill_board_account_list->BillBoardNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_account_list->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID" <?php echo $bill_board_account_list->ClientID->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_list->RowCount ?>_bill_board_account_ClientID">
<span<?php echo $bill_board_account_list->ClientID->viewAttributes() ?>><?php echo $bill_board_account_list->ClientID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_account_list->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF" <?php echo $bill_board_account_list->BalanceBF->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_list->RowCount ?>_bill_board_account_BalanceBF">
<span<?php echo $bill_board_account_list->BalanceBF->viewAttributes() ?>><?php echo $bill_board_account_list->BalanceBF->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_account_list->CurrentDemand->Visible) { // CurrentDemand ?>
		<td data-name="CurrentDemand" <?php echo $bill_board_account_list->CurrentDemand->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_list->RowCount ?>_bill_board_account_CurrentDemand">
<span<?php echo $bill_board_account_list->CurrentDemand->viewAttributes() ?>><?php echo $bill_board_account_list->CurrentDemand->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_account_list->VAT->Visible) { // VAT ?>
		<td data-name="VAT" <?php echo $bill_board_account_list->VAT->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_list->RowCount ?>_bill_board_account_VAT">
<span<?php echo $bill_board_account_list->VAT->viewAttributes() ?>><?php echo $bill_board_account_list->VAT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_account_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $bill_board_account_list->AmountPaid->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_list->RowCount ?>_bill_board_account_AmountPaid">
<span<?php echo $bill_board_account_list->AmountPaid->viewAttributes() ?>><?php echo $bill_board_account_list->AmountPaid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_account_list->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" <?php echo $bill_board_account_list->BillPeriod->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_list->RowCount ?>_bill_board_account_BillPeriod">
<span<?php echo $bill_board_account_list->BillPeriod->viewAttributes() ?>><?php echo $bill_board_account_list->BillPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_account_list->PeriodType->Visible) { // PeriodType ?>
		<td data-name="PeriodType" <?php echo $bill_board_account_list->PeriodType->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_list->RowCount ?>_bill_board_account_PeriodType">
<span<?php echo $bill_board_account_list->PeriodType->viewAttributes() ?>><?php echo $bill_board_account_list->PeriodType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_account_list->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" <?php echo $bill_board_account_list->BillYear->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_list->RowCount ?>_bill_board_account_BillYear">
<span<?php echo $bill_board_account_list->BillYear->viewAttributes() ?>><?php echo $bill_board_account_list->BillYear->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_account_list->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $bill_board_account_list->StartDate->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_list->RowCount ?>_bill_board_account_StartDate">
<span<?php echo $bill_board_account_list->StartDate->viewAttributes() ?>><?php echo $bill_board_account_list->StartDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_account_list->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate" <?php echo $bill_board_account_list->EndDate->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_list->RowCount ?>_bill_board_account_EndDate">
<span<?php echo $bill_board_account_list->EndDate->viewAttributes() ?>><?php echo $bill_board_account_list->EndDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_account_list->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td data-name="LastUpdatedBy" <?php echo $bill_board_account_list->LastUpdatedBy->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_list->RowCount ?>_bill_board_account_LastUpdatedBy">
<span<?php echo $bill_board_account_list->LastUpdatedBy->viewAttributes() ?>><?php echo $bill_board_account_list->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$bill_board_account_list->ListOptions->render("body", "right", $bill_board_account_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$bill_board_account_list->isGridAdd())
		$bill_board_account_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$bill_board_account->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($bill_board_account_list->Recordset)
	$bill_board_account_list->Recordset->Close();
?>
<?php if (!$bill_board_account_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$bill_board_account_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $bill_board_account_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $bill_board_account_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($bill_board_account_list->TotalRecords == 0 && !$bill_board_account->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $bill_board_account_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$bill_board_account_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$bill_board_account_list->isExport()) { ?>
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
$bill_board_account_list->terminate();
?>