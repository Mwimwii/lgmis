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
$licence_account_view = new licence_account_view();

// Run the page
$licence_account_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$licence_account_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$licence_account_view->isExport()) { ?>
<script>
var flicence_accountview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	flicence_accountview = currentForm = new ew.Form("flicence_accountview", "view");
	loadjs.done("flicence_accountview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$licence_account_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $licence_account_view->ExportOptions->render("body") ?>
<?php $licence_account_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $licence_account_view->showPageHeader(); ?>
<?php
$licence_account_view->showMessage();
?>
<?php if (!$licence_account_view->IsModal) { ?>
<?php if (!$licence_account_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $licence_account_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="flicence_accountview" id="flicence_accountview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="licence_account">
<input type="hidden" name="modal" value="<?php echo (int)$licence_account_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($licence_account_view->LicenceNo->Visible) { // LicenceNo ?>
	<tr id="r_LicenceNo">
		<td class="<?php echo $licence_account_view->TableLeftColumnClass ?>"><span id="elh_licence_account_LicenceNo"><?php echo $licence_account_view->LicenceNo->caption() ?></span></td>
		<td data-name="LicenceNo" <?php echo $licence_account_view->LicenceNo->cellAttributes() ?>>
<span id="el_licence_account_LicenceNo">
<span<?php echo $licence_account_view->LicenceNo->viewAttributes() ?>><?php echo $licence_account_view->LicenceNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($licence_account_view->BusinessNo->Visible) { // BusinessNo ?>
	<tr id="r_BusinessNo">
		<td class="<?php echo $licence_account_view->TableLeftColumnClass ?>"><span id="elh_licence_account_BusinessNo"><?php echo $licence_account_view->BusinessNo->caption() ?></span></td>
		<td data-name="BusinessNo" <?php echo $licence_account_view->BusinessNo->cellAttributes() ?>>
<span id="el_licence_account_BusinessNo">
<span<?php echo $licence_account_view->BusinessNo->viewAttributes() ?>><?php echo $licence_account_view->BusinessNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($licence_account_view->ClientID->Visible) { // ClientID ?>
	<tr id="r_ClientID">
		<td class="<?php echo $licence_account_view->TableLeftColumnClass ?>"><span id="elh_licence_account_ClientID"><?php echo $licence_account_view->ClientID->caption() ?></span></td>
		<td data-name="ClientID" <?php echo $licence_account_view->ClientID->cellAttributes() ?>>
<span id="el_licence_account_ClientID">
<span<?php echo $licence_account_view->ClientID->viewAttributes() ?>><?php echo $licence_account_view->ClientID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($licence_account_view->ChargeCode->Visible) { // ChargeCode ?>
	<tr id="r_ChargeCode">
		<td class="<?php echo $licence_account_view->TableLeftColumnClass ?>"><span id="elh_licence_account_ChargeCode"><?php echo $licence_account_view->ChargeCode->caption() ?></span></td>
		<td data-name="ChargeCode" <?php echo $licence_account_view->ChargeCode->cellAttributes() ?>>
<span id="el_licence_account_ChargeCode">
<span<?php echo $licence_account_view->ChargeCode->viewAttributes() ?>><?php echo $licence_account_view->ChargeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($licence_account_view->ChargeGroup->Visible) { // ChargeGroup ?>
	<tr id="r_ChargeGroup">
		<td class="<?php echo $licence_account_view->TableLeftColumnClass ?>"><span id="elh_licence_account_ChargeGroup"><?php echo $licence_account_view->ChargeGroup->caption() ?></span></td>
		<td data-name="ChargeGroup" <?php echo $licence_account_view->ChargeGroup->cellAttributes() ?>>
<span id="el_licence_account_ChargeGroup">
<span<?php echo $licence_account_view->ChargeGroup->viewAttributes() ?>><?php echo $licence_account_view->ChargeGroup->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($licence_account_view->BalanceBF->Visible) { // BalanceBF ?>
	<tr id="r_BalanceBF">
		<td class="<?php echo $licence_account_view->TableLeftColumnClass ?>"><span id="elh_licence_account_BalanceBF"><?php echo $licence_account_view->BalanceBF->caption() ?></span></td>
		<td data-name="BalanceBF" <?php echo $licence_account_view->BalanceBF->cellAttributes() ?>>
<span id="el_licence_account_BalanceBF">
<span<?php echo $licence_account_view->BalanceBF->viewAttributes() ?>><?php echo $licence_account_view->BalanceBF->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($licence_account_view->CurrentDemand->Visible) { // CurrentDemand ?>
	<tr id="r_CurrentDemand">
		<td class="<?php echo $licence_account_view->TableLeftColumnClass ?>"><span id="elh_licence_account_CurrentDemand"><?php echo $licence_account_view->CurrentDemand->caption() ?></span></td>
		<td data-name="CurrentDemand" <?php echo $licence_account_view->CurrentDemand->cellAttributes() ?>>
<span id="el_licence_account_CurrentDemand">
<span<?php echo $licence_account_view->CurrentDemand->viewAttributes() ?>><?php echo $licence_account_view->CurrentDemand->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($licence_account_view->VAT->Visible) { // VAT ?>
	<tr id="r_VAT">
		<td class="<?php echo $licence_account_view->TableLeftColumnClass ?>"><span id="elh_licence_account_VAT"><?php echo $licence_account_view->VAT->caption() ?></span></td>
		<td data-name="VAT" <?php echo $licence_account_view->VAT->cellAttributes() ?>>
<span id="el_licence_account_VAT">
<span<?php echo $licence_account_view->VAT->viewAttributes() ?>><?php echo $licence_account_view->VAT->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($licence_account_view->AmountPaid->Visible) { // AmountPaid ?>
	<tr id="r_AmountPaid">
		<td class="<?php echo $licence_account_view->TableLeftColumnClass ?>"><span id="elh_licence_account_AmountPaid"><?php echo $licence_account_view->AmountPaid->caption() ?></span></td>
		<td data-name="AmountPaid" <?php echo $licence_account_view->AmountPaid->cellAttributes() ?>>
<span id="el_licence_account_AmountPaid">
<span<?php echo $licence_account_view->AmountPaid->viewAttributes() ?>><?php echo $licence_account_view->AmountPaid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($licence_account_view->BillPeriod->Visible) { // BillPeriod ?>
	<tr id="r_BillPeriod">
		<td class="<?php echo $licence_account_view->TableLeftColumnClass ?>"><span id="elh_licence_account_BillPeriod"><?php echo $licence_account_view->BillPeriod->caption() ?></span></td>
		<td data-name="BillPeriod" <?php echo $licence_account_view->BillPeriod->cellAttributes() ?>>
<span id="el_licence_account_BillPeriod">
<span<?php echo $licence_account_view->BillPeriod->viewAttributes() ?>><?php echo $licence_account_view->BillPeriod->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($licence_account_view->PeriodType->Visible) { // PeriodType ?>
	<tr id="r_PeriodType">
		<td class="<?php echo $licence_account_view->TableLeftColumnClass ?>"><span id="elh_licence_account_PeriodType"><?php echo $licence_account_view->PeriodType->caption() ?></span></td>
		<td data-name="PeriodType" <?php echo $licence_account_view->PeriodType->cellAttributes() ?>>
<span id="el_licence_account_PeriodType">
<span<?php echo $licence_account_view->PeriodType->viewAttributes() ?>><?php echo $licence_account_view->PeriodType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($licence_account_view->BillYear->Visible) { // BillYear ?>
	<tr id="r_BillYear">
		<td class="<?php echo $licence_account_view->TableLeftColumnClass ?>"><span id="elh_licence_account_BillYear"><?php echo $licence_account_view->BillYear->caption() ?></span></td>
		<td data-name="BillYear" <?php echo $licence_account_view->BillYear->cellAttributes() ?>>
<span id="el_licence_account_BillYear">
<span<?php echo $licence_account_view->BillYear->viewAttributes() ?>><?php echo $licence_account_view->BillYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($licence_account_view->StartDate->Visible) { // StartDate ?>
	<tr id="r_StartDate">
		<td class="<?php echo $licence_account_view->TableLeftColumnClass ?>"><span id="elh_licence_account_StartDate"><?php echo $licence_account_view->StartDate->caption() ?></span></td>
		<td data-name="StartDate" <?php echo $licence_account_view->StartDate->cellAttributes() ?>>
<span id="el_licence_account_StartDate">
<span<?php echo $licence_account_view->StartDate->viewAttributes() ?>><?php echo $licence_account_view->StartDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($licence_account_view->EndDate->Visible) { // EndDate ?>
	<tr id="r_EndDate">
		<td class="<?php echo $licence_account_view->TableLeftColumnClass ?>"><span id="elh_licence_account_EndDate"><?php echo $licence_account_view->EndDate->caption() ?></span></td>
		<td data-name="EndDate" <?php echo $licence_account_view->EndDate->cellAttributes() ?>>
<span id="el_licence_account_EndDate">
<span<?php echo $licence_account_view->EndDate->viewAttributes() ?>><?php echo $licence_account_view->EndDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($licence_account_view->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<tr id="r_LastUpdatedBy">
		<td class="<?php echo $licence_account_view->TableLeftColumnClass ?>"><span id="elh_licence_account_LastUpdatedBy"><?php echo $licence_account_view->LastUpdatedBy->caption() ?></span></td>
		<td data-name="LastUpdatedBy" <?php echo $licence_account_view->LastUpdatedBy->cellAttributes() ?>>
<span id="el_licence_account_LastUpdatedBy">
<span<?php echo $licence_account_view->LastUpdatedBy->viewAttributes() ?>><?php echo $licence_account_view->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($licence_account_view->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<tr id="r_LastUpdateDate">
		<td class="<?php echo $licence_account_view->TableLeftColumnClass ?>"><span id="elh_licence_account_LastUpdateDate"><?php echo $licence_account_view->LastUpdateDate->caption() ?></span></td>
		<td data-name="LastUpdateDate" <?php echo $licence_account_view->LastUpdateDate->cellAttributes() ?>>
<span id="el_licence_account_LastUpdateDate">
<span<?php echo $licence_account_view->LastUpdateDate->viewAttributes() ?>><?php echo $licence_account_view->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$licence_account_view->IsModal) { ?>
<?php if (!$licence_account_view->isExport()) { ?>
<?php echo $licence_account_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php if ($licence_account->getCurrentDetailTable() != "") { ?>
<?php
	$licence_account_view->DetailPages->ValidKeys = explode(",", $licence_account->getCurrentDetailTable());
	$firstActiveDetailTable = $licence_account_view->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="licence_account_view_details"><!-- tabs -->
	<ul class="<?php echo $licence_account_view->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("health_certificate", explode(",", $licence_account->getCurrentDetailTable())) && $health_certificate->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "health_certificate") {
			$firstActiveDetailTable = "health_certificate";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $licence_account_view->DetailPages->pageStyle("health_certificate") ?>" href="#tab_health_certificate" data-toggle="tab"><?php echo $Language->tablePhrase("health_certificate", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("fire_certificate", explode(",", $licence_account->getCurrentDetailTable())) && $fire_certificate->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "fire_certificate") {
			$firstActiveDetailTable = "fire_certificate";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $licence_account_view->DetailPages->pageStyle("fire_certificate") ?>" href="#tab_fire_certificate" data-toggle="tab"><?php echo $Language->tablePhrase("fire_certificate", "TblCaption") ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("health_certificate", explode(",", $licence_account->getCurrentDetailTable())) && $health_certificate->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "health_certificate")
			$firstActiveDetailTable = "health_certificate";
?>
		<div class="tab-pane <?php echo $licence_account_view->DetailPages->pageStyle("health_certificate") ?>" id="tab_health_certificate"><!-- page* -->
<?php include_once "health_certificategrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("fire_certificate", explode(",", $licence_account->getCurrentDetailTable())) && $fire_certificate->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "fire_certificate")
			$firstActiveDetailTable = "fire_certificate";
?>
		<div class="tab-pane <?php echo $licence_account_view->DetailPages->pageStyle("fire_certificate") ?>" id="tab_fire_certificate"><!-- page* -->
<?php include_once "fire_certificategrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
</form>
<?php
$licence_account_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$licence_account_view->isExport()) { ?>
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
$licence_account_view->terminate();
?>