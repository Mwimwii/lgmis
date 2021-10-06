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
$health_certificate_list = new health_certificate_list();

// Run the page
$health_certificate_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$health_certificate_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$health_certificate_list->isExport()) { ?>
<script>
var fhealth_certificatelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fhealth_certificatelist = currentForm = new ew.Form("fhealth_certificatelist", "list");
	fhealth_certificatelist.formKeyCountName = '<?php echo $health_certificate_list->FormKeyCountName ?>';
	loadjs.done("fhealth_certificatelist");
});
var fhealth_certificatelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fhealth_certificatelistsrch = currentSearchForm = new ew.Form("fhealth_certificatelistsrch");

	// Dynamic selection lists
	// Filters

	fhealth_certificatelistsrch.filterList = <?php echo $health_certificate_list->getFilterList() ?>;

	// Init search panel as collapsed
	fhealth_certificatelistsrch.initSearchPanel = true;
	loadjs.done("fhealth_certificatelistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$health_certificate_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($health_certificate_list->TotalRecords > 0 && $health_certificate_list->ExportOptions->visible()) { ?>
<?php $health_certificate_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($health_certificate_list->ImportOptions->visible()) { ?>
<?php $health_certificate_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($health_certificate_list->SearchOptions->visible()) { ?>
<?php $health_certificate_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($health_certificate_list->FilterOptions->visible()) { ?>
<?php $health_certificate_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$health_certificate_list->isExport() || Config("EXPORT_MASTER_RECORD") && $health_certificate_list->isExport("print")) { ?>
<?php
if ($health_certificate_list->DbMasterFilter != "" && $health_certificate->getCurrentMasterTable() == "licence_account") {
	if ($health_certificate_list->MasterRecordExists) {
		include_once "licence_accountmaster.php";
	}
}
?>
<?php } ?>
<?php
$health_certificate_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$health_certificate_list->isExport() && !$health_certificate->CurrentAction) { ?>
<form name="fhealth_certificatelistsrch" id="fhealth_certificatelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fhealth_certificatelistsrch-search-panel" class="<?php echo $health_certificate_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="health_certificate">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $health_certificate_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($health_certificate_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($health_certificate_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $health_certificate_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($health_certificate_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($health_certificate_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($health_certificate_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($health_certificate_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $health_certificate_list->showPageHeader(); ?>
<?php
$health_certificate_list->showMessage();
?>
<?php if ($health_certificate_list->TotalRecords > 0 || $health_certificate->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($health_certificate_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> health_certificate">
<?php if (!$health_certificate_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$health_certificate_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $health_certificate_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $health_certificate_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fhealth_certificatelist" id="fhealth_certificatelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="health_certificate">
<?php if ($health_certificate->getCurrentMasterTable() == "licence_account" && $health_certificate->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="licence_account">
<input type="hidden" name="fk_LicenceNo" value="<?php echo HtmlEncode($health_certificate_list->LicenceNo->getSessionValue()) ?>">
<input type="hidden" name="fk_BusinessNo" value="<?php echo HtmlEncode($health_certificate_list->BusinessNo->getSessionValue()) ?>">
<input type="hidden" name="fk_BillPeriod" value="<?php echo HtmlEncode($health_certificate_list->BillPeriod->getSessionValue()) ?>">
<input type="hidden" name="fk_PeriodType" value="<?php echo HtmlEncode($health_certificate_list->PeriodType->getSessionValue()) ?>">
<input type="hidden" name="fk_BillYear" value="<?php echo HtmlEncode($health_certificate_list->BillYear->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_health_certificate" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($health_certificate_list->TotalRecords > 0 || $health_certificate_list->isGridEdit()) { ?>
<table id="tbl_health_certificatelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$health_certificate->RowType = ROWTYPE_HEADER;

// Render list options
$health_certificate_list->renderListOptions();

// Render list options (header, left)
$health_certificate_list->ListOptions->render("header", "left");
?>
<?php if ($health_certificate_list->HealthCertificateNo->Visible) { // HealthCertificateNo ?>
	<?php if ($health_certificate_list->SortUrl($health_certificate_list->HealthCertificateNo) == "") { ?>
		<th data-name="HealthCertificateNo" class="<?php echo $health_certificate_list->HealthCertificateNo->headerCellClass() ?>"><div id="elh_health_certificate_HealthCertificateNo" class="health_certificate_HealthCertificateNo"><div class="ew-table-header-caption"><?php echo $health_certificate_list->HealthCertificateNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="HealthCertificateNo" class="<?php echo $health_certificate_list->HealthCertificateNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $health_certificate_list->SortUrl($health_certificate_list->HealthCertificateNo) ?>', 1);"><div id="elh_health_certificate_HealthCertificateNo" class="health_certificate_HealthCertificateNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_list->HealthCertificateNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_list->HealthCertificateNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_list->HealthCertificateNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_list->LicenceNo->Visible) { // LicenceNo ?>
	<?php if ($health_certificate_list->SortUrl($health_certificate_list->LicenceNo) == "") { ?>
		<th data-name="LicenceNo" class="<?php echo $health_certificate_list->LicenceNo->headerCellClass() ?>"><div id="elh_health_certificate_LicenceNo" class="health_certificate_LicenceNo"><div class="ew-table-header-caption"><?php echo $health_certificate_list->LicenceNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LicenceNo" class="<?php echo $health_certificate_list->LicenceNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $health_certificate_list->SortUrl($health_certificate_list->LicenceNo) ?>', 1);"><div id="elh_health_certificate_LicenceNo" class="health_certificate_LicenceNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_list->LicenceNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_list->LicenceNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_list->LicenceNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_list->BusinessNo->Visible) { // BusinessNo ?>
	<?php if ($health_certificate_list->SortUrl($health_certificate_list->BusinessNo) == "") { ?>
		<th data-name="BusinessNo" class="<?php echo $health_certificate_list->BusinessNo->headerCellClass() ?>"><div id="elh_health_certificate_BusinessNo" class="health_certificate_BusinessNo"><div class="ew-table-header-caption"><?php echo $health_certificate_list->BusinessNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BusinessNo" class="<?php echo $health_certificate_list->BusinessNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $health_certificate_list->SortUrl($health_certificate_list->BusinessNo) ?>', 1);"><div id="elh_health_certificate_BusinessNo" class="health_certificate_BusinessNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_list->BusinessNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_list->BusinessNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_list->BusinessNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_list->InspectionDate->Visible) { // InspectionDate ?>
	<?php if ($health_certificate_list->SortUrl($health_certificate_list->InspectionDate) == "") { ?>
		<th data-name="InspectionDate" class="<?php echo $health_certificate_list->InspectionDate->headerCellClass() ?>"><div id="elh_health_certificate_InspectionDate" class="health_certificate_InspectionDate"><div class="ew-table-header-caption"><?php echo $health_certificate_list->InspectionDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="InspectionDate" class="<?php echo $health_certificate_list->InspectionDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $health_certificate_list->SortUrl($health_certificate_list->InspectionDate) ?>', 1);"><div id="elh_health_certificate_InspectionDate" class="health_certificate_InspectionDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_list->InspectionDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_list->InspectionDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_list->InspectionDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_list->InspectedBy->Visible) { // InspectedBy ?>
	<?php if ($health_certificate_list->SortUrl($health_certificate_list->InspectedBy) == "") { ?>
		<th data-name="InspectedBy" class="<?php echo $health_certificate_list->InspectedBy->headerCellClass() ?>"><div id="elh_health_certificate_InspectedBy" class="health_certificate_InspectedBy"><div class="ew-table-header-caption"><?php echo $health_certificate_list->InspectedBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="InspectedBy" class="<?php echo $health_certificate_list->InspectedBy->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $health_certificate_list->SortUrl($health_certificate_list->InspectedBy) ?>', 1);"><div id="elh_health_certificate_InspectedBy" class="health_certificate_InspectedBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_list->InspectedBy->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_list->InspectedBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_list->InspectedBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_list->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($health_certificate_list->SortUrl($health_certificate_list->ChargeCode) == "") { ?>
		<th data-name="ChargeCode" class="<?php echo $health_certificate_list->ChargeCode->headerCellClass() ?>"><div id="elh_health_certificate_ChargeCode" class="health_certificate_ChargeCode"><div class="ew-table-header-caption"><?php echo $health_certificate_list->ChargeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeCode" class="<?php echo $health_certificate_list->ChargeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $health_certificate_list->SortUrl($health_certificate_list->ChargeCode) ?>', 1);"><div id="elh_health_certificate_ChargeCode" class="health_certificate_ChargeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_list->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_list->ChargeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_list->ChargeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_list->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($health_certificate_list->SortUrl($health_certificate_list->ChargeGroup) == "") { ?>
		<th data-name="ChargeGroup" class="<?php echo $health_certificate_list->ChargeGroup->headerCellClass() ?>"><div id="elh_health_certificate_ChargeGroup" class="health_certificate_ChargeGroup"><div class="ew-table-header-caption"><?php echo $health_certificate_list->ChargeGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroup" class="<?php echo $health_certificate_list->ChargeGroup->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $health_certificate_list->SortUrl($health_certificate_list->ChargeGroup) ?>', 1);"><div id="elh_health_certificate_ChargeGroup" class="health_certificate_ChargeGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_list->ChargeGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_list->ChargeGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_list->ChargeGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_list->BalanceBF->Visible) { // BalanceBF ?>
	<?php if ($health_certificate_list->SortUrl($health_certificate_list->BalanceBF) == "") { ?>
		<th data-name="BalanceBF" class="<?php echo $health_certificate_list->BalanceBF->headerCellClass() ?>"><div id="elh_health_certificate_BalanceBF" class="health_certificate_BalanceBF"><div class="ew-table-header-caption"><?php echo $health_certificate_list->BalanceBF->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BalanceBF" class="<?php echo $health_certificate_list->BalanceBF->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $health_certificate_list->SortUrl($health_certificate_list->BalanceBF) ?>', 1);"><div id="elh_health_certificate_BalanceBF" class="health_certificate_BalanceBF">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_list->BalanceBF->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_list->BalanceBF->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_list->BalanceBF->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_list->CurrentDemand->Visible) { // CurrentDemand ?>
	<?php if ($health_certificate_list->SortUrl($health_certificate_list->CurrentDemand) == "") { ?>
		<th data-name="CurrentDemand" class="<?php echo $health_certificate_list->CurrentDemand->headerCellClass() ?>"><div id="elh_health_certificate_CurrentDemand" class="health_certificate_CurrentDemand"><div class="ew-table-header-caption"><?php echo $health_certificate_list->CurrentDemand->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrentDemand" class="<?php echo $health_certificate_list->CurrentDemand->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $health_certificate_list->SortUrl($health_certificate_list->CurrentDemand) ?>', 1);"><div id="elh_health_certificate_CurrentDemand" class="health_certificate_CurrentDemand">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_list->CurrentDemand->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_list->CurrentDemand->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_list->CurrentDemand->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_list->VAT->Visible) { // VAT ?>
	<?php if ($health_certificate_list->SortUrl($health_certificate_list->VAT) == "") { ?>
		<th data-name="VAT" class="<?php echo $health_certificate_list->VAT->headerCellClass() ?>"><div id="elh_health_certificate_VAT" class="health_certificate_VAT"><div class="ew-table-header-caption"><?php echo $health_certificate_list->VAT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VAT" class="<?php echo $health_certificate_list->VAT->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $health_certificate_list->SortUrl($health_certificate_list->VAT) ?>', 1);"><div id="elh_health_certificate_VAT" class="health_certificate_VAT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_list->VAT->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_list->VAT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_list->VAT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_list->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($health_certificate_list->SortUrl($health_certificate_list->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $health_certificate_list->AmountPaid->headerCellClass() ?>"><div id="elh_health_certificate_AmountPaid" class="health_certificate_AmountPaid"><div class="ew-table-header-caption"><?php echo $health_certificate_list->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $health_certificate_list->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $health_certificate_list->SortUrl($health_certificate_list->AmountPaid) ?>', 1);"><div id="elh_health_certificate_AmountPaid" class="health_certificate_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_list->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_list->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_list->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_list->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($health_certificate_list->SortUrl($health_certificate_list->BillPeriod) == "") { ?>
		<th data-name="BillPeriod" class="<?php echo $health_certificate_list->BillPeriod->headerCellClass() ?>"><div id="elh_health_certificate_BillPeriod" class="health_certificate_BillPeriod"><div class="ew-table-header-caption"><?php echo $health_certificate_list->BillPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillPeriod" class="<?php echo $health_certificate_list->BillPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $health_certificate_list->SortUrl($health_certificate_list->BillPeriod) ?>', 1);"><div id="elh_health_certificate_BillPeriod" class="health_certificate_BillPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_list->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_list->BillPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_list->BillPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_list->PeriodType->Visible) { // PeriodType ?>
	<?php if ($health_certificate_list->SortUrl($health_certificate_list->PeriodType) == "") { ?>
		<th data-name="PeriodType" class="<?php echo $health_certificate_list->PeriodType->headerCellClass() ?>"><div id="elh_health_certificate_PeriodType" class="health_certificate_PeriodType"><div class="ew-table-header-caption"><?php echo $health_certificate_list->PeriodType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodType" class="<?php echo $health_certificate_list->PeriodType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $health_certificate_list->SortUrl($health_certificate_list->PeriodType) ?>', 1);"><div id="elh_health_certificate_PeriodType" class="health_certificate_PeriodType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_list->PeriodType->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_list->PeriodType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_list->PeriodType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_list->BillYear->Visible) { // BillYear ?>
	<?php if ($health_certificate_list->SortUrl($health_certificate_list->BillYear) == "") { ?>
		<th data-name="BillYear" class="<?php echo $health_certificate_list->BillYear->headerCellClass() ?>"><div id="elh_health_certificate_BillYear" class="health_certificate_BillYear"><div class="ew-table-header-caption"><?php echo $health_certificate_list->BillYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillYear" class="<?php echo $health_certificate_list->BillYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $health_certificate_list->SortUrl($health_certificate_list->BillYear) ?>', 1);"><div id="elh_health_certificate_BillYear" class="health_certificate_BillYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_list->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_list->BillYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_list->BillYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_list->StartDate->Visible) { // StartDate ?>
	<?php if ($health_certificate_list->SortUrl($health_certificate_list->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $health_certificate_list->StartDate->headerCellClass() ?>"><div id="elh_health_certificate_StartDate" class="health_certificate_StartDate"><div class="ew-table-header-caption"><?php echo $health_certificate_list->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $health_certificate_list->StartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $health_certificate_list->SortUrl($health_certificate_list->StartDate) ?>', 1);"><div id="elh_health_certificate_StartDate" class="health_certificate_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_list->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_list->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_list->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_list->EndDate->Visible) { // EndDate ?>
	<?php if ($health_certificate_list->SortUrl($health_certificate_list->EndDate) == "") { ?>
		<th data-name="EndDate" class="<?php echo $health_certificate_list->EndDate->headerCellClass() ?>"><div id="elh_health_certificate_EndDate" class="health_certificate_EndDate"><div class="ew-table-header-caption"><?php echo $health_certificate_list->EndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EndDate" class="<?php echo $health_certificate_list->EndDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $health_certificate_list->SortUrl($health_certificate_list->EndDate) ?>', 1);"><div id="elh_health_certificate_EndDate" class="health_certificate_EndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_list->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_list->EndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_list->EndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_list->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($health_certificate_list->SortUrl($health_certificate_list->LastUpdatedBy) == "") { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $health_certificate_list->LastUpdatedBy->headerCellClass() ?>"><div id="elh_health_certificate_LastUpdatedBy" class="health_certificate_LastUpdatedBy"><div class="ew-table-header-caption"><?php echo $health_certificate_list->LastUpdatedBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $health_certificate_list->LastUpdatedBy->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $health_certificate_list->SortUrl($health_certificate_list->LastUpdatedBy) ?>', 1);"><div id="elh_health_certificate_LastUpdatedBy" class="health_certificate_LastUpdatedBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_list->LastUpdatedBy->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_list->LastUpdatedBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_list->LastUpdatedBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_list->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<?php if ($health_certificate_list->SortUrl($health_certificate_list->LastUpdateDate) == "") { ?>
		<th data-name="LastUpdateDate" class="<?php echo $health_certificate_list->LastUpdateDate->headerCellClass() ?>"><div id="elh_health_certificate_LastUpdateDate" class="health_certificate_LastUpdateDate"><div class="ew-table-header-caption"><?php echo $health_certificate_list->LastUpdateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdateDate" class="<?php echo $health_certificate_list->LastUpdateDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $health_certificate_list->SortUrl($health_certificate_list->LastUpdateDate) ?>', 1);"><div id="elh_health_certificate_LastUpdateDate" class="health_certificate_LastUpdateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_list->LastUpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_list->LastUpdateDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_list->LastUpdateDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$health_certificate_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($health_certificate_list->ExportAll && $health_certificate_list->isExport()) {
	$health_certificate_list->StopRecord = $health_certificate_list->TotalRecords;
} else {

	// Set the last record to display
	if ($health_certificate_list->TotalRecords > $health_certificate_list->StartRecord + $health_certificate_list->DisplayRecords - 1)
		$health_certificate_list->StopRecord = $health_certificate_list->StartRecord + $health_certificate_list->DisplayRecords - 1;
	else
		$health_certificate_list->StopRecord = $health_certificate_list->TotalRecords;
}
$health_certificate_list->RecordCount = $health_certificate_list->StartRecord - 1;
if ($health_certificate_list->Recordset && !$health_certificate_list->Recordset->EOF) {
	$health_certificate_list->Recordset->moveFirst();
	$selectLimit = $health_certificate_list->UseSelectLimit;
	if (!$selectLimit && $health_certificate_list->StartRecord > 1)
		$health_certificate_list->Recordset->move($health_certificate_list->StartRecord - 1);
} elseif (!$health_certificate->AllowAddDeleteRow && $health_certificate_list->StopRecord == 0) {
	$health_certificate_list->StopRecord = $health_certificate->GridAddRowCount;
}

// Initialize aggregate
$health_certificate->RowType = ROWTYPE_AGGREGATEINIT;
$health_certificate->resetAttributes();
$health_certificate_list->renderRow();
while ($health_certificate_list->RecordCount < $health_certificate_list->StopRecord) {
	$health_certificate_list->RecordCount++;
	if ($health_certificate_list->RecordCount >= $health_certificate_list->StartRecord) {
		$health_certificate_list->RowCount++;

		// Set up key count
		$health_certificate_list->KeyCount = $health_certificate_list->RowIndex;

		// Init row class and style
		$health_certificate->resetAttributes();
		$health_certificate->CssClass = "";
		if ($health_certificate_list->isGridAdd()) {
		} else {
			$health_certificate_list->loadRowValues($health_certificate_list->Recordset); // Load row values
		}
		$health_certificate->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$health_certificate->RowAttrs->merge(["data-rowindex" => $health_certificate_list->RowCount, "id" => "r" . $health_certificate_list->RowCount . "_health_certificate", "data-rowtype" => $health_certificate->RowType]);

		// Render row
		$health_certificate_list->renderRow();

		// Render list options
		$health_certificate_list->renderListOptions();
?>
	<tr <?php echo $health_certificate->rowAttributes() ?>>
<?php

// Render list options (body, left)
$health_certificate_list->ListOptions->render("body", "left", $health_certificate_list->RowCount);
?>
	<?php if ($health_certificate_list->HealthCertificateNo->Visible) { // HealthCertificateNo ?>
		<td data-name="HealthCertificateNo" <?php echo $health_certificate_list->HealthCertificateNo->cellAttributes() ?>>
<span id="el<?php echo $health_certificate_list->RowCount ?>_health_certificate_HealthCertificateNo">
<span<?php echo $health_certificate_list->HealthCertificateNo->viewAttributes() ?>><?php echo $health_certificate_list->HealthCertificateNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($health_certificate_list->LicenceNo->Visible) { // LicenceNo ?>
		<td data-name="LicenceNo" <?php echo $health_certificate_list->LicenceNo->cellAttributes() ?>>
<span id="el<?php echo $health_certificate_list->RowCount ?>_health_certificate_LicenceNo">
<span<?php echo $health_certificate_list->LicenceNo->viewAttributes() ?>><?php echo $health_certificate_list->LicenceNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($health_certificate_list->BusinessNo->Visible) { // BusinessNo ?>
		<td data-name="BusinessNo" <?php echo $health_certificate_list->BusinessNo->cellAttributes() ?>>
<span id="el<?php echo $health_certificate_list->RowCount ?>_health_certificate_BusinessNo">
<span<?php echo $health_certificate_list->BusinessNo->viewAttributes() ?>><?php echo $health_certificate_list->BusinessNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($health_certificate_list->InspectionDate->Visible) { // InspectionDate ?>
		<td data-name="InspectionDate" <?php echo $health_certificate_list->InspectionDate->cellAttributes() ?>>
<span id="el<?php echo $health_certificate_list->RowCount ?>_health_certificate_InspectionDate">
<span<?php echo $health_certificate_list->InspectionDate->viewAttributes() ?>><?php echo $health_certificate_list->InspectionDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($health_certificate_list->InspectedBy->Visible) { // InspectedBy ?>
		<td data-name="InspectedBy" <?php echo $health_certificate_list->InspectedBy->cellAttributes() ?>>
<span id="el<?php echo $health_certificate_list->RowCount ?>_health_certificate_InspectedBy">
<span<?php echo $health_certificate_list->InspectedBy->viewAttributes() ?>><?php echo $health_certificate_list->InspectedBy->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($health_certificate_list->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" <?php echo $health_certificate_list->ChargeCode->cellAttributes() ?>>
<span id="el<?php echo $health_certificate_list->RowCount ?>_health_certificate_ChargeCode">
<span<?php echo $health_certificate_list->ChargeCode->viewAttributes() ?>><?php echo $health_certificate_list->ChargeCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($health_certificate_list->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" <?php echo $health_certificate_list->ChargeGroup->cellAttributes() ?>>
<span id="el<?php echo $health_certificate_list->RowCount ?>_health_certificate_ChargeGroup">
<span<?php echo $health_certificate_list->ChargeGroup->viewAttributes() ?>><?php echo $health_certificate_list->ChargeGroup->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($health_certificate_list->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF" <?php echo $health_certificate_list->BalanceBF->cellAttributes() ?>>
<span id="el<?php echo $health_certificate_list->RowCount ?>_health_certificate_BalanceBF">
<span<?php echo $health_certificate_list->BalanceBF->viewAttributes() ?>><?php echo $health_certificate_list->BalanceBF->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($health_certificate_list->CurrentDemand->Visible) { // CurrentDemand ?>
		<td data-name="CurrentDemand" <?php echo $health_certificate_list->CurrentDemand->cellAttributes() ?>>
<span id="el<?php echo $health_certificate_list->RowCount ?>_health_certificate_CurrentDemand">
<span<?php echo $health_certificate_list->CurrentDemand->viewAttributes() ?>><?php echo $health_certificate_list->CurrentDemand->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($health_certificate_list->VAT->Visible) { // VAT ?>
		<td data-name="VAT" <?php echo $health_certificate_list->VAT->cellAttributes() ?>>
<span id="el<?php echo $health_certificate_list->RowCount ?>_health_certificate_VAT">
<span<?php echo $health_certificate_list->VAT->viewAttributes() ?>><?php echo $health_certificate_list->VAT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($health_certificate_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $health_certificate_list->AmountPaid->cellAttributes() ?>>
<span id="el<?php echo $health_certificate_list->RowCount ?>_health_certificate_AmountPaid">
<span<?php echo $health_certificate_list->AmountPaid->viewAttributes() ?>><?php echo $health_certificate_list->AmountPaid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($health_certificate_list->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" <?php echo $health_certificate_list->BillPeriod->cellAttributes() ?>>
<span id="el<?php echo $health_certificate_list->RowCount ?>_health_certificate_BillPeriod">
<span<?php echo $health_certificate_list->BillPeriod->viewAttributes() ?>><?php echo $health_certificate_list->BillPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($health_certificate_list->PeriodType->Visible) { // PeriodType ?>
		<td data-name="PeriodType" <?php echo $health_certificate_list->PeriodType->cellAttributes() ?>>
<span id="el<?php echo $health_certificate_list->RowCount ?>_health_certificate_PeriodType">
<span<?php echo $health_certificate_list->PeriodType->viewAttributes() ?>><?php echo $health_certificate_list->PeriodType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($health_certificate_list->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" <?php echo $health_certificate_list->BillYear->cellAttributes() ?>>
<span id="el<?php echo $health_certificate_list->RowCount ?>_health_certificate_BillYear">
<span<?php echo $health_certificate_list->BillYear->viewAttributes() ?>><?php echo $health_certificate_list->BillYear->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($health_certificate_list->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $health_certificate_list->StartDate->cellAttributes() ?>>
<span id="el<?php echo $health_certificate_list->RowCount ?>_health_certificate_StartDate">
<span<?php echo $health_certificate_list->StartDate->viewAttributes() ?>><?php echo $health_certificate_list->StartDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($health_certificate_list->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate" <?php echo $health_certificate_list->EndDate->cellAttributes() ?>>
<span id="el<?php echo $health_certificate_list->RowCount ?>_health_certificate_EndDate">
<span<?php echo $health_certificate_list->EndDate->viewAttributes() ?>><?php echo $health_certificate_list->EndDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($health_certificate_list->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td data-name="LastUpdatedBy" <?php echo $health_certificate_list->LastUpdatedBy->cellAttributes() ?>>
<span id="el<?php echo $health_certificate_list->RowCount ?>_health_certificate_LastUpdatedBy">
<span<?php echo $health_certificate_list->LastUpdatedBy->viewAttributes() ?>><?php echo $health_certificate_list->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($health_certificate_list->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td data-name="LastUpdateDate" <?php echo $health_certificate_list->LastUpdateDate->cellAttributes() ?>>
<span id="el<?php echo $health_certificate_list->RowCount ?>_health_certificate_LastUpdateDate">
<span<?php echo $health_certificate_list->LastUpdateDate->viewAttributes() ?>><?php echo $health_certificate_list->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$health_certificate_list->ListOptions->render("body", "right", $health_certificate_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$health_certificate_list->isGridAdd())
		$health_certificate_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$health_certificate->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($health_certificate_list->Recordset)
	$health_certificate_list->Recordset->Close();
?>
<?php if (!$health_certificate_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$health_certificate_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $health_certificate_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $health_certificate_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($health_certificate_list->TotalRecords == 0 && !$health_certificate->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $health_certificate_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$health_certificate_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$health_certificate_list->isExport()) { ?>
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
$health_certificate_list->terminate();
?>