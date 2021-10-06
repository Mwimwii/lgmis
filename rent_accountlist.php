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
$rent_account_list = new rent_account_list();

// Run the page
$rent_account_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rent_account_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$rent_account_list->isExport()) { ?>
<script>
var frent_accountlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	frent_accountlist = currentForm = new ew.Form("frent_accountlist", "list");
	frent_accountlist.formKeyCountName = '<?php echo $rent_account_list->FormKeyCountName ?>';
	loadjs.done("frent_accountlist");
});
var frent_accountlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	frent_accountlistsrch = currentSearchForm = new ew.Form("frent_accountlistsrch");

	// Dynamic selection lists
	// Filters

	frent_accountlistsrch.filterList = <?php echo $rent_account_list->getFilterList() ?>;

	// Init search panel as collapsed
	frent_accountlistsrch.initSearchPanel = true;
	loadjs.done("frent_accountlistsrch");
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
<?php if (!$rent_account_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($rent_account_list->TotalRecords > 0 && $rent_account_list->ExportOptions->visible()) { ?>
<?php $rent_account_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($rent_account_list->ImportOptions->visible()) { ?>
<?php $rent_account_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($rent_account_list->SearchOptions->visible()) { ?>
<?php $rent_account_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($rent_account_list->FilterOptions->visible()) { ?>
<?php $rent_account_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$rent_account_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$rent_account_list->isExport() && !$rent_account->CurrentAction) { ?>
<form name="frent_accountlistsrch" id="frent_accountlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="frent_accountlistsrch-search-panel" class="<?php echo $rent_account_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="rent_account">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $rent_account_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($rent_account_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($rent_account_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $rent_account_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($rent_account_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($rent_account_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($rent_account_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($rent_account_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $rent_account_list->showPageHeader(); ?>
<?php
$rent_account_list->showMessage();
?>
<?php if ($rent_account_list->TotalRecords > 0 || $rent_account->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($rent_account_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> rent_account">
<?php if (!$rent_account_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$rent_account_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $rent_account_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $rent_account_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="frent_accountlist" id="frent_accountlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rent_account">
<div id="gmp_rent_account" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($rent_account_list->TotalRecords > 0 || $rent_account_list->isGridEdit()) { ?>
<table id="tbl_rent_accountlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$rent_account->RowType = ROWTYPE_HEADER;

// Render list options
$rent_account_list->renderListOptions();

// Render list options (header, left)
$rent_account_list->ListOptions->render("header", "left");
?>
<?php if ($rent_account_list->AccountNo->Visible) { // AccountNo ?>
	<?php if ($rent_account_list->SortUrl($rent_account_list->AccountNo) == "") { ?>
		<th data-name="AccountNo" class="<?php echo $rent_account_list->AccountNo->headerCellClass() ?>"><div id="elh_rent_account_AccountNo" class="rent_account_AccountNo"><div class="ew-table-header-caption"><?php echo $rent_account_list->AccountNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountNo" class="<?php echo $rent_account_list->AccountNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rent_account_list->SortUrl($rent_account_list->AccountNo) ?>', 1);"><div id="elh_rent_account_AccountNo" class="rent_account_AccountNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rent_account_list->AccountNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($rent_account_list->AccountNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rent_account_list->AccountNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_account_list->PropertyNo->Visible) { // PropertyNo ?>
	<?php if ($rent_account_list->SortUrl($rent_account_list->PropertyNo) == "") { ?>
		<th data-name="PropertyNo" class="<?php echo $rent_account_list->PropertyNo->headerCellClass() ?>"><div id="elh_rent_account_PropertyNo" class="rent_account_PropertyNo"><div class="ew-table-header-caption"><?php echo $rent_account_list->PropertyNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyNo" class="<?php echo $rent_account_list->PropertyNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rent_account_list->SortUrl($rent_account_list->PropertyNo) ?>', 1);"><div id="elh_rent_account_PropertyNo" class="rent_account_PropertyNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rent_account_list->PropertyNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($rent_account_list->PropertyNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rent_account_list->PropertyNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_account_list->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php if ($rent_account_list->SortUrl($rent_account_list->ClientSerNo) == "") { ?>
		<th data-name="ClientSerNo" class="<?php echo $rent_account_list->ClientSerNo->headerCellClass() ?>"><div id="elh_rent_account_ClientSerNo" class="rent_account_ClientSerNo"><div class="ew-table-header-caption"><?php echo $rent_account_list->ClientSerNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientSerNo" class="<?php echo $rent_account_list->ClientSerNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rent_account_list->SortUrl($rent_account_list->ClientSerNo) ?>', 1);"><div id="elh_rent_account_ClientSerNo" class="rent_account_ClientSerNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rent_account_list->ClientSerNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($rent_account_list->ClientSerNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rent_account_list->ClientSerNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_account_list->ClientID->Visible) { // ClientID ?>
	<?php if ($rent_account_list->SortUrl($rent_account_list->ClientID) == "") { ?>
		<th data-name="ClientID" class="<?php echo $rent_account_list->ClientID->headerCellClass() ?>"><div id="elh_rent_account_ClientID" class="rent_account_ClientID"><div class="ew-table-header-caption"><?php echo $rent_account_list->ClientID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientID" class="<?php echo $rent_account_list->ClientID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rent_account_list->SortUrl($rent_account_list->ClientID) ?>', 1);"><div id="elh_rent_account_ClientID" class="rent_account_ClientID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rent_account_list->ClientID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($rent_account_list->ClientID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rent_account_list->ClientID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_account_list->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($rent_account_list->SortUrl($rent_account_list->ChargeCode) == "") { ?>
		<th data-name="ChargeCode" class="<?php echo $rent_account_list->ChargeCode->headerCellClass() ?>"><div id="elh_rent_account_ChargeCode" class="rent_account_ChargeCode"><div class="ew-table-header-caption"><?php echo $rent_account_list->ChargeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeCode" class="<?php echo $rent_account_list->ChargeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rent_account_list->SortUrl($rent_account_list->ChargeCode) ?>', 1);"><div id="elh_rent_account_ChargeCode" class="rent_account_ChargeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rent_account_list->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($rent_account_list->ChargeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rent_account_list->ChargeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_account_list->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($rent_account_list->SortUrl($rent_account_list->ChargeGroup) == "") { ?>
		<th data-name="ChargeGroup" class="<?php echo $rent_account_list->ChargeGroup->headerCellClass() ?>"><div id="elh_rent_account_ChargeGroup" class="rent_account_ChargeGroup"><div class="ew-table-header-caption"><?php echo $rent_account_list->ChargeGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroup" class="<?php echo $rent_account_list->ChargeGroup->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rent_account_list->SortUrl($rent_account_list->ChargeGroup) ?>', 1);"><div id="elh_rent_account_ChargeGroup" class="rent_account_ChargeGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rent_account_list->ChargeGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($rent_account_list->ChargeGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rent_account_list->ChargeGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_account_list->Securitydeposit->Visible) { // Securitydeposit ?>
	<?php if ($rent_account_list->SortUrl($rent_account_list->Securitydeposit) == "") { ?>
		<th data-name="Securitydeposit" class="<?php echo $rent_account_list->Securitydeposit->headerCellClass() ?>"><div id="elh_rent_account_Securitydeposit" class="rent_account_Securitydeposit"><div class="ew-table-header-caption"><?php echo $rent_account_list->Securitydeposit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Securitydeposit" class="<?php echo $rent_account_list->Securitydeposit->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rent_account_list->SortUrl($rent_account_list->Securitydeposit) ?>', 1);"><div id="elh_rent_account_Securitydeposit" class="rent_account_Securitydeposit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rent_account_list->Securitydeposit->caption() ?></span><span class="ew-table-header-sort"><?php if ($rent_account_list->Securitydeposit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rent_account_list->Securitydeposit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_account_list->BalanceBF->Visible) { // BalanceBF ?>
	<?php if ($rent_account_list->SortUrl($rent_account_list->BalanceBF) == "") { ?>
		<th data-name="BalanceBF" class="<?php echo $rent_account_list->BalanceBF->headerCellClass() ?>"><div id="elh_rent_account_BalanceBF" class="rent_account_BalanceBF"><div class="ew-table-header-caption"><?php echo $rent_account_list->BalanceBF->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BalanceBF" class="<?php echo $rent_account_list->BalanceBF->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rent_account_list->SortUrl($rent_account_list->BalanceBF) ?>', 1);"><div id="elh_rent_account_BalanceBF" class="rent_account_BalanceBF">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rent_account_list->BalanceBF->caption() ?></span><span class="ew-table-header-sort"><?php if ($rent_account_list->BalanceBF->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rent_account_list->BalanceBF->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_account_list->CurrentDemand->Visible) { // CurrentDemand ?>
	<?php if ($rent_account_list->SortUrl($rent_account_list->CurrentDemand) == "") { ?>
		<th data-name="CurrentDemand" class="<?php echo $rent_account_list->CurrentDemand->headerCellClass() ?>"><div id="elh_rent_account_CurrentDemand" class="rent_account_CurrentDemand"><div class="ew-table-header-caption"><?php echo $rent_account_list->CurrentDemand->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrentDemand" class="<?php echo $rent_account_list->CurrentDemand->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rent_account_list->SortUrl($rent_account_list->CurrentDemand) ?>', 1);"><div id="elh_rent_account_CurrentDemand" class="rent_account_CurrentDemand">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rent_account_list->CurrentDemand->caption() ?></span><span class="ew-table-header-sort"><?php if ($rent_account_list->CurrentDemand->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rent_account_list->CurrentDemand->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_account_list->VAT->Visible) { // VAT ?>
	<?php if ($rent_account_list->SortUrl($rent_account_list->VAT) == "") { ?>
		<th data-name="VAT" class="<?php echo $rent_account_list->VAT->headerCellClass() ?>"><div id="elh_rent_account_VAT" class="rent_account_VAT"><div class="ew-table-header-caption"><?php echo $rent_account_list->VAT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VAT" class="<?php echo $rent_account_list->VAT->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rent_account_list->SortUrl($rent_account_list->VAT) ?>', 1);"><div id="elh_rent_account_VAT" class="rent_account_VAT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rent_account_list->VAT->caption() ?></span><span class="ew-table-header-sort"><?php if ($rent_account_list->VAT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rent_account_list->VAT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_account_list->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($rent_account_list->SortUrl($rent_account_list->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $rent_account_list->AmountPaid->headerCellClass() ?>"><div id="elh_rent_account_AmountPaid" class="rent_account_AmountPaid"><div class="ew-table-header-caption"><?php echo $rent_account_list->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $rent_account_list->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rent_account_list->SortUrl($rent_account_list->AmountPaid) ?>', 1);"><div id="elh_rent_account_AmountPaid" class="rent_account_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rent_account_list->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($rent_account_list->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rent_account_list->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_account_list->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($rent_account_list->SortUrl($rent_account_list->BillPeriod) == "") { ?>
		<th data-name="BillPeriod" class="<?php echo $rent_account_list->BillPeriod->headerCellClass() ?>"><div id="elh_rent_account_BillPeriod" class="rent_account_BillPeriod"><div class="ew-table-header-caption"><?php echo $rent_account_list->BillPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillPeriod" class="<?php echo $rent_account_list->BillPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rent_account_list->SortUrl($rent_account_list->BillPeriod) ?>', 1);"><div id="elh_rent_account_BillPeriod" class="rent_account_BillPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rent_account_list->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($rent_account_list->BillPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rent_account_list->BillPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_account_list->PeriodType->Visible) { // PeriodType ?>
	<?php if ($rent_account_list->SortUrl($rent_account_list->PeriodType) == "") { ?>
		<th data-name="PeriodType" class="<?php echo $rent_account_list->PeriodType->headerCellClass() ?>"><div id="elh_rent_account_PeriodType" class="rent_account_PeriodType"><div class="ew-table-header-caption"><?php echo $rent_account_list->PeriodType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodType" class="<?php echo $rent_account_list->PeriodType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rent_account_list->SortUrl($rent_account_list->PeriodType) ?>', 1);"><div id="elh_rent_account_PeriodType" class="rent_account_PeriodType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rent_account_list->PeriodType->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($rent_account_list->PeriodType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rent_account_list->PeriodType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_account_list->BillYear->Visible) { // BillYear ?>
	<?php if ($rent_account_list->SortUrl($rent_account_list->BillYear) == "") { ?>
		<th data-name="BillYear" class="<?php echo $rent_account_list->BillYear->headerCellClass() ?>"><div id="elh_rent_account_BillYear" class="rent_account_BillYear"><div class="ew-table-header-caption"><?php echo $rent_account_list->BillYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillYear" class="<?php echo $rent_account_list->BillYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rent_account_list->SortUrl($rent_account_list->BillYear) ?>', 1);"><div id="elh_rent_account_BillYear" class="rent_account_BillYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rent_account_list->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($rent_account_list->BillYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rent_account_list->BillYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_account_list->StartDate->Visible) { // StartDate ?>
	<?php if ($rent_account_list->SortUrl($rent_account_list->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $rent_account_list->StartDate->headerCellClass() ?>"><div id="elh_rent_account_StartDate" class="rent_account_StartDate"><div class="ew-table-header-caption"><?php echo $rent_account_list->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $rent_account_list->StartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rent_account_list->SortUrl($rent_account_list->StartDate) ?>', 1);"><div id="elh_rent_account_StartDate" class="rent_account_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rent_account_list->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($rent_account_list->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rent_account_list->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_account_list->EndDate->Visible) { // EndDate ?>
	<?php if ($rent_account_list->SortUrl($rent_account_list->EndDate) == "") { ?>
		<th data-name="EndDate" class="<?php echo $rent_account_list->EndDate->headerCellClass() ?>"><div id="elh_rent_account_EndDate" class="rent_account_EndDate"><div class="ew-table-header-caption"><?php echo $rent_account_list->EndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EndDate" class="<?php echo $rent_account_list->EndDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rent_account_list->SortUrl($rent_account_list->EndDate) ?>', 1);"><div id="elh_rent_account_EndDate" class="rent_account_EndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rent_account_list->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($rent_account_list->EndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rent_account_list->EndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_account_list->LeaseDesc->Visible) { // LeaseDesc ?>
	<?php if ($rent_account_list->SortUrl($rent_account_list->LeaseDesc) == "") { ?>
		<th data-name="LeaseDesc" class="<?php echo $rent_account_list->LeaseDesc->headerCellClass() ?>"><div id="elh_rent_account_LeaseDesc" class="rent_account_LeaseDesc"><div class="ew-table-header-caption"><?php echo $rent_account_list->LeaseDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeaseDesc" class="<?php echo $rent_account_list->LeaseDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rent_account_list->SortUrl($rent_account_list->LeaseDesc) ?>', 1);"><div id="elh_rent_account_LeaseDesc" class="rent_account_LeaseDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rent_account_list->LeaseDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($rent_account_list->LeaseDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rent_account_list->LeaseDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_account_list->Rent->Visible) { // Rent ?>
	<?php if ($rent_account_list->SortUrl($rent_account_list->Rent) == "") { ?>
		<th data-name="Rent" class="<?php echo $rent_account_list->Rent->headerCellClass() ?>"><div id="elh_rent_account_Rent" class="rent_account_Rent"><div class="ew-table-header-caption"><?php echo $rent_account_list->Rent->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rent" class="<?php echo $rent_account_list->Rent->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rent_account_list->SortUrl($rent_account_list->Rent) ?>', 1);"><div id="elh_rent_account_Rent" class="rent_account_Rent">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rent_account_list->Rent->caption() ?></span><span class="ew-table-header-sort"><?php if ($rent_account_list->Rent->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rent_account_list->Rent->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_account_list->Period_type->Visible) { // Period_type ?>
	<?php if ($rent_account_list->SortUrl($rent_account_list->Period_type) == "") { ?>
		<th data-name="Period_type" class="<?php echo $rent_account_list->Period_type->headerCellClass() ?>"><div id="elh_rent_account_Period_type" class="rent_account_Period_type"><div class="ew-table-header-caption"><?php echo $rent_account_list->Period_type->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Period_type" class="<?php echo $rent_account_list->Period_type->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rent_account_list->SortUrl($rent_account_list->Period_type) ?>', 1);"><div id="elh_rent_account_Period_type" class="rent_account_Period_type">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rent_account_list->Period_type->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($rent_account_list->Period_type->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rent_account_list->Period_type->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_account_list->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($rent_account_list->SortUrl($rent_account_list->LastUpdatedBy) == "") { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $rent_account_list->LastUpdatedBy->headerCellClass() ?>"><div id="elh_rent_account_LastUpdatedBy" class="rent_account_LastUpdatedBy"><div class="ew-table-header-caption"><?php echo $rent_account_list->LastUpdatedBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $rent_account_list->LastUpdatedBy->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rent_account_list->SortUrl($rent_account_list->LastUpdatedBy) ?>', 1);"><div id="elh_rent_account_LastUpdatedBy" class="rent_account_LastUpdatedBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rent_account_list->LastUpdatedBy->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($rent_account_list->LastUpdatedBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rent_account_list->LastUpdatedBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rent_account_list->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<?php if ($rent_account_list->SortUrl($rent_account_list->LastUpdateDate) == "") { ?>
		<th data-name="LastUpdateDate" class="<?php echo $rent_account_list->LastUpdateDate->headerCellClass() ?>"><div id="elh_rent_account_LastUpdateDate" class="rent_account_LastUpdateDate"><div class="ew-table-header-caption"><?php echo $rent_account_list->LastUpdateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdateDate" class="<?php echo $rent_account_list->LastUpdateDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rent_account_list->SortUrl($rent_account_list->LastUpdateDate) ?>', 1);"><div id="elh_rent_account_LastUpdateDate" class="rent_account_LastUpdateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rent_account_list->LastUpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($rent_account_list->LastUpdateDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rent_account_list->LastUpdateDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$rent_account_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($rent_account_list->ExportAll && $rent_account_list->isExport()) {
	$rent_account_list->StopRecord = $rent_account_list->TotalRecords;
} else {

	// Set the last record to display
	if ($rent_account_list->TotalRecords > $rent_account_list->StartRecord + $rent_account_list->DisplayRecords - 1)
		$rent_account_list->StopRecord = $rent_account_list->StartRecord + $rent_account_list->DisplayRecords - 1;
	else
		$rent_account_list->StopRecord = $rent_account_list->TotalRecords;
}
$rent_account_list->RecordCount = $rent_account_list->StartRecord - 1;
if ($rent_account_list->Recordset && !$rent_account_list->Recordset->EOF) {
	$rent_account_list->Recordset->moveFirst();
	$selectLimit = $rent_account_list->UseSelectLimit;
	if (!$selectLimit && $rent_account_list->StartRecord > 1)
		$rent_account_list->Recordset->move($rent_account_list->StartRecord - 1);
} elseif (!$rent_account->AllowAddDeleteRow && $rent_account_list->StopRecord == 0) {
	$rent_account_list->StopRecord = $rent_account->GridAddRowCount;
}

// Initialize aggregate
$rent_account->RowType = ROWTYPE_AGGREGATEINIT;
$rent_account->resetAttributes();
$rent_account_list->renderRow();
while ($rent_account_list->RecordCount < $rent_account_list->StopRecord) {
	$rent_account_list->RecordCount++;
	if ($rent_account_list->RecordCount >= $rent_account_list->StartRecord) {
		$rent_account_list->RowCount++;

		// Set up key count
		$rent_account_list->KeyCount = $rent_account_list->RowIndex;

		// Init row class and style
		$rent_account->resetAttributes();
		$rent_account->CssClass = "";
		if ($rent_account_list->isGridAdd()) {
		} else {
			$rent_account_list->loadRowValues($rent_account_list->Recordset); // Load row values
		}
		$rent_account->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$rent_account->RowAttrs->merge(["data-rowindex" => $rent_account_list->RowCount, "id" => "r" . $rent_account_list->RowCount . "_rent_account", "data-rowtype" => $rent_account->RowType]);

		// Render row
		$rent_account_list->renderRow();

		// Render list options
		$rent_account_list->renderListOptions();
?>
	<tr <?php echo $rent_account->rowAttributes() ?>>
<?php

// Render list options (body, left)
$rent_account_list->ListOptions->render("body", "left", $rent_account_list->RowCount);
?>
	<?php if ($rent_account_list->AccountNo->Visible) { // AccountNo ?>
		<td data-name="AccountNo" <?php echo $rent_account_list->AccountNo->cellAttributes() ?>>
<span id="el<?php echo $rent_account_list->RowCount ?>_rent_account_AccountNo">
<span<?php echo $rent_account_list->AccountNo->viewAttributes() ?>><?php echo $rent_account_list->AccountNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_account_list->PropertyNo->Visible) { // PropertyNo ?>
		<td data-name="PropertyNo" <?php echo $rent_account_list->PropertyNo->cellAttributes() ?>>
<span id="el<?php echo $rent_account_list->RowCount ?>_rent_account_PropertyNo">
<span<?php echo $rent_account_list->PropertyNo->viewAttributes() ?>><?php echo $rent_account_list->PropertyNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_account_list->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo" <?php echo $rent_account_list->ClientSerNo->cellAttributes() ?>>
<span id="el<?php echo $rent_account_list->RowCount ?>_rent_account_ClientSerNo">
<span<?php echo $rent_account_list->ClientSerNo->viewAttributes() ?>><?php echo $rent_account_list->ClientSerNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_account_list->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID" <?php echo $rent_account_list->ClientID->cellAttributes() ?>>
<span id="el<?php echo $rent_account_list->RowCount ?>_rent_account_ClientID">
<span<?php echo $rent_account_list->ClientID->viewAttributes() ?>><?php echo $rent_account_list->ClientID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_account_list->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" <?php echo $rent_account_list->ChargeCode->cellAttributes() ?>>
<span id="el<?php echo $rent_account_list->RowCount ?>_rent_account_ChargeCode">
<span<?php echo $rent_account_list->ChargeCode->viewAttributes() ?>><?php echo $rent_account_list->ChargeCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_account_list->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" <?php echo $rent_account_list->ChargeGroup->cellAttributes() ?>>
<span id="el<?php echo $rent_account_list->RowCount ?>_rent_account_ChargeGroup">
<span<?php echo $rent_account_list->ChargeGroup->viewAttributes() ?>><?php echo $rent_account_list->ChargeGroup->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_account_list->Securitydeposit->Visible) { // Securitydeposit ?>
		<td data-name="Securitydeposit" <?php echo $rent_account_list->Securitydeposit->cellAttributes() ?>>
<span id="el<?php echo $rent_account_list->RowCount ?>_rent_account_Securitydeposit">
<span<?php echo $rent_account_list->Securitydeposit->viewAttributes() ?>><?php echo $rent_account_list->Securitydeposit->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_account_list->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF" <?php echo $rent_account_list->BalanceBF->cellAttributes() ?>>
<span id="el<?php echo $rent_account_list->RowCount ?>_rent_account_BalanceBF">
<span<?php echo $rent_account_list->BalanceBF->viewAttributes() ?>><?php echo $rent_account_list->BalanceBF->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_account_list->CurrentDemand->Visible) { // CurrentDemand ?>
		<td data-name="CurrentDemand" <?php echo $rent_account_list->CurrentDemand->cellAttributes() ?>>
<span id="el<?php echo $rent_account_list->RowCount ?>_rent_account_CurrentDemand">
<span<?php echo $rent_account_list->CurrentDemand->viewAttributes() ?>><?php echo $rent_account_list->CurrentDemand->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_account_list->VAT->Visible) { // VAT ?>
		<td data-name="VAT" <?php echo $rent_account_list->VAT->cellAttributes() ?>>
<span id="el<?php echo $rent_account_list->RowCount ?>_rent_account_VAT">
<span<?php echo $rent_account_list->VAT->viewAttributes() ?>><?php echo $rent_account_list->VAT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_account_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $rent_account_list->AmountPaid->cellAttributes() ?>>
<span id="el<?php echo $rent_account_list->RowCount ?>_rent_account_AmountPaid">
<span<?php echo $rent_account_list->AmountPaid->viewAttributes() ?>><?php echo $rent_account_list->AmountPaid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_account_list->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" <?php echo $rent_account_list->BillPeriod->cellAttributes() ?>>
<span id="el<?php echo $rent_account_list->RowCount ?>_rent_account_BillPeriod">
<span<?php echo $rent_account_list->BillPeriod->viewAttributes() ?>><?php echo $rent_account_list->BillPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_account_list->PeriodType->Visible) { // PeriodType ?>
		<td data-name="PeriodType" <?php echo $rent_account_list->PeriodType->cellAttributes() ?>>
<span id="el<?php echo $rent_account_list->RowCount ?>_rent_account_PeriodType">
<span<?php echo $rent_account_list->PeriodType->viewAttributes() ?>><?php echo $rent_account_list->PeriodType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_account_list->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" <?php echo $rent_account_list->BillYear->cellAttributes() ?>>
<span id="el<?php echo $rent_account_list->RowCount ?>_rent_account_BillYear">
<span<?php echo $rent_account_list->BillYear->viewAttributes() ?>><?php echo $rent_account_list->BillYear->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_account_list->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $rent_account_list->StartDate->cellAttributes() ?>>
<span id="el<?php echo $rent_account_list->RowCount ?>_rent_account_StartDate">
<span<?php echo $rent_account_list->StartDate->viewAttributes() ?>><?php echo $rent_account_list->StartDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_account_list->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate" <?php echo $rent_account_list->EndDate->cellAttributes() ?>>
<span id="el<?php echo $rent_account_list->RowCount ?>_rent_account_EndDate">
<span<?php echo $rent_account_list->EndDate->viewAttributes() ?>><?php echo $rent_account_list->EndDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_account_list->LeaseDesc->Visible) { // LeaseDesc ?>
		<td data-name="LeaseDesc" <?php echo $rent_account_list->LeaseDesc->cellAttributes() ?>>
<span id="el<?php echo $rent_account_list->RowCount ?>_rent_account_LeaseDesc">
<span<?php echo $rent_account_list->LeaseDesc->viewAttributes() ?>><?php echo $rent_account_list->LeaseDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_account_list->Rent->Visible) { // Rent ?>
		<td data-name="Rent" <?php echo $rent_account_list->Rent->cellAttributes() ?>>
<span id="el<?php echo $rent_account_list->RowCount ?>_rent_account_Rent">
<span<?php echo $rent_account_list->Rent->viewAttributes() ?>><?php echo $rent_account_list->Rent->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_account_list->Period_type->Visible) { // Period_type ?>
		<td data-name="Period_type" <?php echo $rent_account_list->Period_type->cellAttributes() ?>>
<span id="el<?php echo $rent_account_list->RowCount ?>_rent_account_Period_type">
<span<?php echo $rent_account_list->Period_type->viewAttributes() ?>><?php echo $rent_account_list->Period_type->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_account_list->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td data-name="LastUpdatedBy" <?php echo $rent_account_list->LastUpdatedBy->cellAttributes() ?>>
<span id="el<?php echo $rent_account_list->RowCount ?>_rent_account_LastUpdatedBy">
<span<?php echo $rent_account_list->LastUpdatedBy->viewAttributes() ?>><?php echo $rent_account_list->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rent_account_list->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td data-name="LastUpdateDate" <?php echo $rent_account_list->LastUpdateDate->cellAttributes() ?>>
<span id="el<?php echo $rent_account_list->RowCount ?>_rent_account_LastUpdateDate">
<span<?php echo $rent_account_list->LastUpdateDate->viewAttributes() ?>><?php echo $rent_account_list->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rent_account_list->ListOptions->render("body", "right", $rent_account_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$rent_account_list->isGridAdd())
		$rent_account_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$rent_account->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($rent_account_list->Recordset)
	$rent_account_list->Recordset->Close();
?>
<?php if (!$rent_account_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$rent_account_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $rent_account_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $rent_account_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($rent_account_list->TotalRecords == 0 && !$rent_account->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $rent_account_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$rent_account_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$rent_account_list->isExport()) { ?>
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
$rent_account_list->terminate();
?>