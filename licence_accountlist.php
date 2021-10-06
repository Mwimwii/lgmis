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
$licence_account_list = new licence_account_list();

// Run the page
$licence_account_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$licence_account_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$licence_account_list->isExport()) { ?>
<script>
var flicence_accountlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	flicence_accountlist = currentForm = new ew.Form("flicence_accountlist", "list");
	flicence_accountlist.formKeyCountName = '<?php echo $licence_account_list->FormKeyCountName ?>';
	loadjs.done("flicence_accountlist");
});
var flicence_accountlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	flicence_accountlistsrch = currentSearchForm = new ew.Form("flicence_accountlistsrch");

	// Dynamic selection lists
	// Filters

	flicence_accountlistsrch.filterList = <?php echo $licence_account_list->getFilterList() ?>;

	// Init search panel as collapsed
	flicence_accountlistsrch.initSearchPanel = true;
	loadjs.done("flicence_accountlistsrch");
});
</script>
<script>
ew.ready("head", "js/ewfixedheadertable.js", "fixedheadertable");
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
<?php if (!$licence_account_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($licence_account_list->TotalRecords > 0 && $licence_account_list->ExportOptions->visible()) { ?>
<?php $licence_account_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($licence_account_list->ImportOptions->visible()) { ?>
<?php $licence_account_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($licence_account_list->SearchOptions->visible()) { ?>
<?php $licence_account_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($licence_account_list->FilterOptions->visible()) { ?>
<?php $licence_account_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$licence_account_list->isExport() || Config("EXPORT_MASTER_RECORD") && $licence_account_list->isExport("print")) { ?>
<?php
if ($licence_account_list->DbMasterFilter != "" && $licence_account->getCurrentMasterTable() == "business") {
	if ($licence_account_list->MasterRecordExists) {
		include_once "businessmaster.php";
	}
}
?>
<?php } ?>
<?php
$licence_account_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$licence_account_list->isExport() && !$licence_account->CurrentAction) { ?>
<form name="flicence_accountlistsrch" id="flicence_accountlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="flicence_accountlistsrch-search-panel" class="<?php echo $licence_account_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="licence_account">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $licence_account_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($licence_account_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($licence_account_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $licence_account_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($licence_account_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($licence_account_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($licence_account_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($licence_account_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $licence_account_list->showPageHeader(); ?>
<?php
$licence_account_list->showMessage();
?>
<?php if ($licence_account_list->TotalRecords > 0 || $licence_account->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($licence_account_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> licence_account">
<?php if (!$licence_account_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$licence_account_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $licence_account_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $licence_account_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="flicence_accountlist" id="flicence_accountlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="licence_account">
<?php if ($licence_account->getCurrentMasterTable() == "business" && $licence_account->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="business">
<input type="hidden" name="fk_BusinessID" value="<?php echo HtmlEncode($licence_account_list->BusinessNo->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_licence_account" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($licence_account_list->TotalRecords > 0 || $licence_account_list->isGridEdit()) { ?>
<table id="tbl_licence_accountlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$licence_account->RowType = ROWTYPE_HEADER;

// Render list options
$licence_account_list->renderListOptions();

// Render list options (header, left)
$licence_account_list->ListOptions->render("header", "left");
?>
<?php if ($licence_account_list->LicenceNo->Visible) { // LicenceNo ?>
	<?php if ($licence_account_list->SortUrl($licence_account_list->LicenceNo) == "") { ?>
		<th data-name="LicenceNo" class="<?php echo $licence_account_list->LicenceNo->headerCellClass() ?>"><div id="elh_licence_account_LicenceNo" class="licence_account_LicenceNo"><div class="ew-table-header-caption"><?php echo $licence_account_list->LicenceNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LicenceNo" class="<?php echo $licence_account_list->LicenceNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $licence_account_list->SortUrl($licence_account_list->LicenceNo) ?>', 1);"><div id="elh_licence_account_LicenceNo" class="licence_account_LicenceNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_list->LicenceNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_list->LicenceNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_list->LicenceNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_list->BusinessNo->Visible) { // BusinessNo ?>
	<?php if ($licence_account_list->SortUrl($licence_account_list->BusinessNo) == "") { ?>
		<th data-name="BusinessNo" class="<?php echo $licence_account_list->BusinessNo->headerCellClass() ?>"><div id="elh_licence_account_BusinessNo" class="licence_account_BusinessNo"><div class="ew-table-header-caption"><?php echo $licence_account_list->BusinessNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BusinessNo" class="<?php echo $licence_account_list->BusinessNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $licence_account_list->SortUrl($licence_account_list->BusinessNo) ?>', 1);"><div id="elh_licence_account_BusinessNo" class="licence_account_BusinessNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_list->BusinessNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_list->BusinessNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_list->BusinessNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_list->ClientID->Visible) { // ClientID ?>
	<?php if ($licence_account_list->SortUrl($licence_account_list->ClientID) == "") { ?>
		<th data-name="ClientID" class="<?php echo $licence_account_list->ClientID->headerCellClass() ?>"><div id="elh_licence_account_ClientID" class="licence_account_ClientID"><div class="ew-table-header-caption"><?php echo $licence_account_list->ClientID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientID" class="<?php echo $licence_account_list->ClientID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $licence_account_list->SortUrl($licence_account_list->ClientID) ?>', 1);"><div id="elh_licence_account_ClientID" class="licence_account_ClientID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_list->ClientID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($licence_account_list->ClientID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_list->ClientID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_list->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($licence_account_list->SortUrl($licence_account_list->ChargeCode) == "") { ?>
		<th data-name="ChargeCode" class="<?php echo $licence_account_list->ChargeCode->headerCellClass() ?>"><div id="elh_licence_account_ChargeCode" class="licence_account_ChargeCode"><div class="ew-table-header-caption"><?php echo $licence_account_list->ChargeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeCode" class="<?php echo $licence_account_list->ChargeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $licence_account_list->SortUrl($licence_account_list->ChargeCode) ?>', 1);"><div id="elh_licence_account_ChargeCode" class="licence_account_ChargeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_list->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_list->ChargeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_list->ChargeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_list->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($licence_account_list->SortUrl($licence_account_list->ChargeGroup) == "") { ?>
		<th data-name="ChargeGroup" class="<?php echo $licence_account_list->ChargeGroup->headerCellClass() ?>"><div id="elh_licence_account_ChargeGroup" class="licence_account_ChargeGroup"><div class="ew-table-header-caption"><?php echo $licence_account_list->ChargeGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroup" class="<?php echo $licence_account_list->ChargeGroup->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $licence_account_list->SortUrl($licence_account_list->ChargeGroup) ?>', 1);"><div id="elh_licence_account_ChargeGroup" class="licence_account_ChargeGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_list->ChargeGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_list->ChargeGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_list->ChargeGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_list->BalanceBF->Visible) { // BalanceBF ?>
	<?php if ($licence_account_list->SortUrl($licence_account_list->BalanceBF) == "") { ?>
		<th data-name="BalanceBF" class="<?php echo $licence_account_list->BalanceBF->headerCellClass() ?>"><div id="elh_licence_account_BalanceBF" class="licence_account_BalanceBF"><div class="ew-table-header-caption"><?php echo $licence_account_list->BalanceBF->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BalanceBF" class="<?php echo $licence_account_list->BalanceBF->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $licence_account_list->SortUrl($licence_account_list->BalanceBF) ?>', 1);"><div id="elh_licence_account_BalanceBF" class="licence_account_BalanceBF">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_list->BalanceBF->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_list->BalanceBF->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_list->BalanceBF->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_list->CurrentDemand->Visible) { // CurrentDemand ?>
	<?php if ($licence_account_list->SortUrl($licence_account_list->CurrentDemand) == "") { ?>
		<th data-name="CurrentDemand" class="<?php echo $licence_account_list->CurrentDemand->headerCellClass() ?>"><div id="elh_licence_account_CurrentDemand" class="licence_account_CurrentDemand"><div class="ew-table-header-caption"><?php echo $licence_account_list->CurrentDemand->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrentDemand" class="<?php echo $licence_account_list->CurrentDemand->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $licence_account_list->SortUrl($licence_account_list->CurrentDemand) ?>', 1);"><div id="elh_licence_account_CurrentDemand" class="licence_account_CurrentDemand">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_list->CurrentDemand->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_list->CurrentDemand->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_list->CurrentDemand->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_list->VAT->Visible) { // VAT ?>
	<?php if ($licence_account_list->SortUrl($licence_account_list->VAT) == "") { ?>
		<th data-name="VAT" class="<?php echo $licence_account_list->VAT->headerCellClass() ?>"><div id="elh_licence_account_VAT" class="licence_account_VAT"><div class="ew-table-header-caption"><?php echo $licence_account_list->VAT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VAT" class="<?php echo $licence_account_list->VAT->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $licence_account_list->SortUrl($licence_account_list->VAT) ?>', 1);"><div id="elh_licence_account_VAT" class="licence_account_VAT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_list->VAT->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_list->VAT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_list->VAT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_list->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($licence_account_list->SortUrl($licence_account_list->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $licence_account_list->AmountPaid->headerCellClass() ?>"><div id="elh_licence_account_AmountPaid" class="licence_account_AmountPaid"><div class="ew-table-header-caption"><?php echo $licence_account_list->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $licence_account_list->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $licence_account_list->SortUrl($licence_account_list->AmountPaid) ?>', 1);"><div id="elh_licence_account_AmountPaid" class="licence_account_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_list->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_list->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_list->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_list->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($licence_account_list->SortUrl($licence_account_list->BillPeriod) == "") { ?>
		<th data-name="BillPeriod" class="<?php echo $licence_account_list->BillPeriod->headerCellClass() ?>"><div id="elh_licence_account_BillPeriod" class="licence_account_BillPeriod"><div class="ew-table-header-caption"><?php echo $licence_account_list->BillPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillPeriod" class="<?php echo $licence_account_list->BillPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $licence_account_list->SortUrl($licence_account_list->BillPeriod) ?>', 1);"><div id="elh_licence_account_BillPeriod" class="licence_account_BillPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_list->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_list->BillPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_list->BillPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_list->PeriodType->Visible) { // PeriodType ?>
	<?php if ($licence_account_list->SortUrl($licence_account_list->PeriodType) == "") { ?>
		<th data-name="PeriodType" class="<?php echo $licence_account_list->PeriodType->headerCellClass() ?>"><div id="elh_licence_account_PeriodType" class="licence_account_PeriodType"><div class="ew-table-header-caption"><?php echo $licence_account_list->PeriodType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodType" class="<?php echo $licence_account_list->PeriodType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $licence_account_list->SortUrl($licence_account_list->PeriodType) ?>', 1);"><div id="elh_licence_account_PeriodType" class="licence_account_PeriodType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_list->PeriodType->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_list->PeriodType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_list->PeriodType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_list->BillYear->Visible) { // BillYear ?>
	<?php if ($licence_account_list->SortUrl($licence_account_list->BillYear) == "") { ?>
		<th data-name="BillYear" class="<?php echo $licence_account_list->BillYear->headerCellClass() ?>"><div id="elh_licence_account_BillYear" class="licence_account_BillYear"><div class="ew-table-header-caption"><?php echo $licence_account_list->BillYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillYear" class="<?php echo $licence_account_list->BillYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $licence_account_list->SortUrl($licence_account_list->BillYear) ?>', 1);"><div id="elh_licence_account_BillYear" class="licence_account_BillYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_list->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_list->BillYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_list->BillYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_list->StartDate->Visible) { // StartDate ?>
	<?php if ($licence_account_list->SortUrl($licence_account_list->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $licence_account_list->StartDate->headerCellClass() ?>"><div id="elh_licence_account_StartDate" class="licence_account_StartDate"><div class="ew-table-header-caption"><?php echo $licence_account_list->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $licence_account_list->StartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $licence_account_list->SortUrl($licence_account_list->StartDate) ?>', 1);"><div id="elh_licence_account_StartDate" class="licence_account_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_list->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_list->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_list->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_list->EndDate->Visible) { // EndDate ?>
	<?php if ($licence_account_list->SortUrl($licence_account_list->EndDate) == "") { ?>
		<th data-name="EndDate" class="<?php echo $licence_account_list->EndDate->headerCellClass() ?>"><div id="elh_licence_account_EndDate" class="licence_account_EndDate"><div class="ew-table-header-caption"><?php echo $licence_account_list->EndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EndDate" class="<?php echo $licence_account_list->EndDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $licence_account_list->SortUrl($licence_account_list->EndDate) ?>', 1);"><div id="elh_licence_account_EndDate" class="licence_account_EndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_list->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_list->EndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_list->EndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_list->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($licence_account_list->SortUrl($licence_account_list->LastUpdatedBy) == "") { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $licence_account_list->LastUpdatedBy->headerCellClass() ?>"><div id="elh_licence_account_LastUpdatedBy" class="licence_account_LastUpdatedBy"><div class="ew-table-header-caption"><?php echo $licence_account_list->LastUpdatedBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $licence_account_list->LastUpdatedBy->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $licence_account_list->SortUrl($licence_account_list->LastUpdatedBy) ?>', 1);"><div id="elh_licence_account_LastUpdatedBy" class="licence_account_LastUpdatedBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_list->LastUpdatedBy->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($licence_account_list->LastUpdatedBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_list->LastUpdatedBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_list->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<?php if ($licence_account_list->SortUrl($licence_account_list->LastUpdateDate) == "") { ?>
		<th data-name="LastUpdateDate" class="<?php echo $licence_account_list->LastUpdateDate->headerCellClass() ?>"><div id="elh_licence_account_LastUpdateDate" class="licence_account_LastUpdateDate"><div class="ew-table-header-caption"><?php echo $licence_account_list->LastUpdateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdateDate" class="<?php echo $licence_account_list->LastUpdateDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $licence_account_list->SortUrl($licence_account_list->LastUpdateDate) ?>', 1);"><div id="elh_licence_account_LastUpdateDate" class="licence_account_LastUpdateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_list->LastUpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_list->LastUpdateDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_list->LastUpdateDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$licence_account_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($licence_account_list->ExportAll && $licence_account_list->isExport()) {
	$licence_account_list->StopRecord = $licence_account_list->TotalRecords;
} else {

	// Set the last record to display
	if ($licence_account_list->TotalRecords > $licence_account_list->StartRecord + $licence_account_list->DisplayRecords - 1)
		$licence_account_list->StopRecord = $licence_account_list->StartRecord + $licence_account_list->DisplayRecords - 1;
	else
		$licence_account_list->StopRecord = $licence_account_list->TotalRecords;
}
$licence_account_list->RecordCount = $licence_account_list->StartRecord - 1;
if ($licence_account_list->Recordset && !$licence_account_list->Recordset->EOF) {
	$licence_account_list->Recordset->moveFirst();
	$selectLimit = $licence_account_list->UseSelectLimit;
	if (!$selectLimit && $licence_account_list->StartRecord > 1)
		$licence_account_list->Recordset->move($licence_account_list->StartRecord - 1);
} elseif (!$licence_account->AllowAddDeleteRow && $licence_account_list->StopRecord == 0) {
	$licence_account_list->StopRecord = $licence_account->GridAddRowCount;
}

// Initialize aggregate
$licence_account->RowType = ROWTYPE_AGGREGATEINIT;
$licence_account->resetAttributes();
$licence_account_list->renderRow();
while ($licence_account_list->RecordCount < $licence_account_list->StopRecord) {
	$licence_account_list->RecordCount++;
	if ($licence_account_list->RecordCount >= $licence_account_list->StartRecord) {
		$licence_account_list->RowCount++;

		// Set up key count
		$licence_account_list->KeyCount = $licence_account_list->RowIndex;

		// Init row class and style
		$licence_account->resetAttributes();
		$licence_account->CssClass = "";
		if ($licence_account_list->isGridAdd()) {
		} else {
			$licence_account_list->loadRowValues($licence_account_list->Recordset); // Load row values
		}
		$licence_account->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$licence_account->RowAttrs->merge(["data-rowindex" => $licence_account_list->RowCount, "id" => "r" . $licence_account_list->RowCount . "_licence_account", "data-rowtype" => $licence_account->RowType]);

		// Render row
		$licence_account_list->renderRow();

		// Render list options
		$licence_account_list->renderListOptions();
?>
	<tr <?php echo $licence_account->rowAttributes() ?>>
<?php

// Render list options (body, left)
$licence_account_list->ListOptions->render("body", "left", $licence_account_list->RowCount);
?>
	<?php if ($licence_account_list->LicenceNo->Visible) { // LicenceNo ?>
		<td data-name="LicenceNo" <?php echo $licence_account_list->LicenceNo->cellAttributes() ?>>
<span id="el<?php echo $licence_account_list->RowCount ?>_licence_account_LicenceNo">
<span<?php echo $licence_account_list->LicenceNo->viewAttributes() ?>><?php echo $licence_account_list->LicenceNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($licence_account_list->BusinessNo->Visible) { // BusinessNo ?>
		<td data-name="BusinessNo" <?php echo $licence_account_list->BusinessNo->cellAttributes() ?>>
<span id="el<?php echo $licence_account_list->RowCount ?>_licence_account_BusinessNo">
<span<?php echo $licence_account_list->BusinessNo->viewAttributes() ?>><?php echo $licence_account_list->BusinessNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($licence_account_list->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID" <?php echo $licence_account_list->ClientID->cellAttributes() ?>>
<span id="el<?php echo $licence_account_list->RowCount ?>_licence_account_ClientID">
<span<?php echo $licence_account_list->ClientID->viewAttributes() ?>><?php echo $licence_account_list->ClientID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($licence_account_list->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" <?php echo $licence_account_list->ChargeCode->cellAttributes() ?>>
<span id="el<?php echo $licence_account_list->RowCount ?>_licence_account_ChargeCode">
<span<?php echo $licence_account_list->ChargeCode->viewAttributes() ?>><?php echo $licence_account_list->ChargeCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($licence_account_list->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" <?php echo $licence_account_list->ChargeGroup->cellAttributes() ?>>
<span id="el<?php echo $licence_account_list->RowCount ?>_licence_account_ChargeGroup">
<span<?php echo $licence_account_list->ChargeGroup->viewAttributes() ?>><?php echo $licence_account_list->ChargeGroup->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($licence_account_list->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF" <?php echo $licence_account_list->BalanceBF->cellAttributes() ?>>
<span id="el<?php echo $licence_account_list->RowCount ?>_licence_account_BalanceBF">
<span<?php echo $licence_account_list->BalanceBF->viewAttributes() ?>><?php echo $licence_account_list->BalanceBF->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($licence_account_list->CurrentDemand->Visible) { // CurrentDemand ?>
		<td data-name="CurrentDemand" <?php echo $licence_account_list->CurrentDemand->cellAttributes() ?>>
<span id="el<?php echo $licence_account_list->RowCount ?>_licence_account_CurrentDemand">
<span<?php echo $licence_account_list->CurrentDemand->viewAttributes() ?>><?php echo $licence_account_list->CurrentDemand->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($licence_account_list->VAT->Visible) { // VAT ?>
		<td data-name="VAT" <?php echo $licence_account_list->VAT->cellAttributes() ?>>
<span id="el<?php echo $licence_account_list->RowCount ?>_licence_account_VAT">
<span<?php echo $licence_account_list->VAT->viewAttributes() ?>><?php echo $licence_account_list->VAT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($licence_account_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $licence_account_list->AmountPaid->cellAttributes() ?>>
<span id="el<?php echo $licence_account_list->RowCount ?>_licence_account_AmountPaid">
<span<?php echo $licence_account_list->AmountPaid->viewAttributes() ?>><?php echo $licence_account_list->AmountPaid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($licence_account_list->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" <?php echo $licence_account_list->BillPeriod->cellAttributes() ?>>
<span id="el<?php echo $licence_account_list->RowCount ?>_licence_account_BillPeriod">
<span<?php echo $licence_account_list->BillPeriod->viewAttributes() ?>><?php echo $licence_account_list->BillPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($licence_account_list->PeriodType->Visible) { // PeriodType ?>
		<td data-name="PeriodType" <?php echo $licence_account_list->PeriodType->cellAttributes() ?>>
<span id="el<?php echo $licence_account_list->RowCount ?>_licence_account_PeriodType">
<span<?php echo $licence_account_list->PeriodType->viewAttributes() ?>><?php echo $licence_account_list->PeriodType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($licence_account_list->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" <?php echo $licence_account_list->BillYear->cellAttributes() ?>>
<span id="el<?php echo $licence_account_list->RowCount ?>_licence_account_BillYear">
<span<?php echo $licence_account_list->BillYear->viewAttributes() ?>><?php echo $licence_account_list->BillYear->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($licence_account_list->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $licence_account_list->StartDate->cellAttributes() ?>>
<span id="el<?php echo $licence_account_list->RowCount ?>_licence_account_StartDate">
<span<?php echo $licence_account_list->StartDate->viewAttributes() ?>><?php echo $licence_account_list->StartDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($licence_account_list->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate" <?php echo $licence_account_list->EndDate->cellAttributes() ?>>
<span id="el<?php echo $licence_account_list->RowCount ?>_licence_account_EndDate">
<span<?php echo $licence_account_list->EndDate->viewAttributes() ?>><?php echo $licence_account_list->EndDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($licence_account_list->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td data-name="LastUpdatedBy" <?php echo $licence_account_list->LastUpdatedBy->cellAttributes() ?>>
<span id="el<?php echo $licence_account_list->RowCount ?>_licence_account_LastUpdatedBy">
<span<?php echo $licence_account_list->LastUpdatedBy->viewAttributes() ?>><?php echo $licence_account_list->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($licence_account_list->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td data-name="LastUpdateDate" <?php echo $licence_account_list->LastUpdateDate->cellAttributes() ?>>
<span id="el<?php echo $licence_account_list->RowCount ?>_licence_account_LastUpdateDate">
<span<?php echo $licence_account_list->LastUpdateDate->viewAttributes() ?>><?php echo $licence_account_list->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$licence_account_list->ListOptions->render("body", "right", $licence_account_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$licence_account_list->isGridAdd())
		$licence_account_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$licence_account->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($licence_account_list->Recordset)
	$licence_account_list->Recordset->Close();
?>
<?php if (!$licence_account_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$licence_account_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $licence_account_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $licence_account_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($licence_account_list->TotalRecords == 0 && !$licence_account->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $licence_account_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$licence_account_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$licence_account_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php if (!$licence_account->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_licence_account",
		width: "",
		height: ""
	});
});
</script>
<?php } ?>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$licence_account_list->terminate();
?>