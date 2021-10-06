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
$fire_certificate_view = new fire_certificate_view();

// Run the page
$fire_certificate_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$fire_certificate_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$fire_certificate_view->isExport()) { ?>
<script>
var ffire_certificateview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ffire_certificateview = currentForm = new ew.Form("ffire_certificateview", "view");
	loadjs.done("ffire_certificateview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$fire_certificate_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $fire_certificate_view->ExportOptions->render("body") ?>
<?php $fire_certificate_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $fire_certificate_view->showPageHeader(); ?>
<?php
$fire_certificate_view->showMessage();
?>
<?php if (!$fire_certificate_view->IsModal) { ?>
<?php if (!$fire_certificate_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $fire_certificate_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="ffire_certificateview" id="ffire_certificateview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="fire_certificate">
<input type="hidden" name="modal" value="<?php echo (int)$fire_certificate_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($fire_certificate_view->FireCertificateNo->Visible) { // FireCertificateNo ?>
	<tr id="r_FireCertificateNo">
		<td class="<?php echo $fire_certificate_view->TableLeftColumnClass ?>"><span id="elh_fire_certificate_FireCertificateNo"><?php echo $fire_certificate_view->FireCertificateNo->caption() ?></span></td>
		<td data-name="FireCertificateNo" <?php echo $fire_certificate_view->FireCertificateNo->cellAttributes() ?>>
<span id="el_fire_certificate_FireCertificateNo">
<span<?php echo $fire_certificate_view->FireCertificateNo->viewAttributes() ?>><?php echo $fire_certificate_view->FireCertificateNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fire_certificate_view->LicenceNo->Visible) { // LicenceNo ?>
	<tr id="r_LicenceNo">
		<td class="<?php echo $fire_certificate_view->TableLeftColumnClass ?>"><span id="elh_fire_certificate_LicenceNo"><?php echo $fire_certificate_view->LicenceNo->caption() ?></span></td>
		<td data-name="LicenceNo" <?php echo $fire_certificate_view->LicenceNo->cellAttributes() ?>>
<span id="el_fire_certificate_LicenceNo">
<span<?php echo $fire_certificate_view->LicenceNo->viewAttributes() ?>><?php echo $fire_certificate_view->LicenceNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fire_certificate_view->BusinessNo->Visible) { // BusinessNo ?>
	<tr id="r_BusinessNo">
		<td class="<?php echo $fire_certificate_view->TableLeftColumnClass ?>"><span id="elh_fire_certificate_BusinessNo"><?php echo $fire_certificate_view->BusinessNo->caption() ?></span></td>
		<td data-name="BusinessNo" <?php echo $fire_certificate_view->BusinessNo->cellAttributes() ?>>
<span id="el_fire_certificate_BusinessNo">
<span<?php echo $fire_certificate_view->BusinessNo->viewAttributes() ?>><?php echo $fire_certificate_view->BusinessNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fire_certificate_view->InspectionReport->Visible) { // InspectionReport ?>
	<tr id="r_InspectionReport">
		<td class="<?php echo $fire_certificate_view->TableLeftColumnClass ?>"><span id="elh_fire_certificate_InspectionReport"><?php echo $fire_certificate_view->InspectionReport->caption() ?></span></td>
		<td data-name="InspectionReport" <?php echo $fire_certificate_view->InspectionReport->cellAttributes() ?>>
<span id="el_fire_certificate_InspectionReport">
<span<?php echo $fire_certificate_view->InspectionReport->viewAttributes() ?>><?php echo $fire_certificate_view->InspectionReport->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fire_certificate_view->InspectionDate->Visible) { // InspectionDate ?>
	<tr id="r_InspectionDate">
		<td class="<?php echo $fire_certificate_view->TableLeftColumnClass ?>"><span id="elh_fire_certificate_InspectionDate"><?php echo $fire_certificate_view->InspectionDate->caption() ?></span></td>
		<td data-name="InspectionDate" <?php echo $fire_certificate_view->InspectionDate->cellAttributes() ?>>
<span id="el_fire_certificate_InspectionDate">
<span<?php echo $fire_certificate_view->InspectionDate->viewAttributes() ?>><?php echo $fire_certificate_view->InspectionDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fire_certificate_view->InspectedBy->Visible) { // InspectedBy ?>
	<tr id="r_InspectedBy">
		<td class="<?php echo $fire_certificate_view->TableLeftColumnClass ?>"><span id="elh_fire_certificate_InspectedBy"><?php echo $fire_certificate_view->InspectedBy->caption() ?></span></td>
		<td data-name="InspectedBy" <?php echo $fire_certificate_view->InspectedBy->cellAttributes() ?>>
<span id="el_fire_certificate_InspectedBy">
<span<?php echo $fire_certificate_view->InspectedBy->viewAttributes() ?>><?php echo $fire_certificate_view->InspectedBy->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fire_certificate_view->ChargeCode->Visible) { // ChargeCode ?>
	<tr id="r_ChargeCode">
		<td class="<?php echo $fire_certificate_view->TableLeftColumnClass ?>"><span id="elh_fire_certificate_ChargeCode"><?php echo $fire_certificate_view->ChargeCode->caption() ?></span></td>
		<td data-name="ChargeCode" <?php echo $fire_certificate_view->ChargeCode->cellAttributes() ?>>
<span id="el_fire_certificate_ChargeCode">
<span<?php echo $fire_certificate_view->ChargeCode->viewAttributes() ?>><?php echo $fire_certificate_view->ChargeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fire_certificate_view->ChargeGroup->Visible) { // ChargeGroup ?>
	<tr id="r_ChargeGroup">
		<td class="<?php echo $fire_certificate_view->TableLeftColumnClass ?>"><span id="elh_fire_certificate_ChargeGroup"><?php echo $fire_certificate_view->ChargeGroup->caption() ?></span></td>
		<td data-name="ChargeGroup" <?php echo $fire_certificate_view->ChargeGroup->cellAttributes() ?>>
<span id="el_fire_certificate_ChargeGroup">
<span<?php echo $fire_certificate_view->ChargeGroup->viewAttributes() ?>><?php echo $fire_certificate_view->ChargeGroup->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fire_certificate_view->BalanceBF->Visible) { // BalanceBF ?>
	<tr id="r_BalanceBF">
		<td class="<?php echo $fire_certificate_view->TableLeftColumnClass ?>"><span id="elh_fire_certificate_BalanceBF"><?php echo $fire_certificate_view->BalanceBF->caption() ?></span></td>
		<td data-name="BalanceBF" <?php echo $fire_certificate_view->BalanceBF->cellAttributes() ?>>
<span id="el_fire_certificate_BalanceBF">
<span<?php echo $fire_certificate_view->BalanceBF->viewAttributes() ?>><?php echo $fire_certificate_view->BalanceBF->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fire_certificate_view->CurrentDemand->Visible) { // CurrentDemand ?>
	<tr id="r_CurrentDemand">
		<td class="<?php echo $fire_certificate_view->TableLeftColumnClass ?>"><span id="elh_fire_certificate_CurrentDemand"><?php echo $fire_certificate_view->CurrentDemand->caption() ?></span></td>
		<td data-name="CurrentDemand" <?php echo $fire_certificate_view->CurrentDemand->cellAttributes() ?>>
<span id="el_fire_certificate_CurrentDemand">
<span<?php echo $fire_certificate_view->CurrentDemand->viewAttributes() ?>><?php echo $fire_certificate_view->CurrentDemand->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fire_certificate_view->VAT->Visible) { // VAT ?>
	<tr id="r_VAT">
		<td class="<?php echo $fire_certificate_view->TableLeftColumnClass ?>"><span id="elh_fire_certificate_VAT"><?php echo $fire_certificate_view->VAT->caption() ?></span></td>
		<td data-name="VAT" <?php echo $fire_certificate_view->VAT->cellAttributes() ?>>
<span id="el_fire_certificate_VAT">
<span<?php echo $fire_certificate_view->VAT->viewAttributes() ?>><?php echo $fire_certificate_view->VAT->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fire_certificate_view->AmountPaid->Visible) { // AmountPaid ?>
	<tr id="r_AmountPaid">
		<td class="<?php echo $fire_certificate_view->TableLeftColumnClass ?>"><span id="elh_fire_certificate_AmountPaid"><?php echo $fire_certificate_view->AmountPaid->caption() ?></span></td>
		<td data-name="AmountPaid" <?php echo $fire_certificate_view->AmountPaid->cellAttributes() ?>>
<span id="el_fire_certificate_AmountPaid">
<span<?php echo $fire_certificate_view->AmountPaid->viewAttributes() ?>><?php echo $fire_certificate_view->AmountPaid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fire_certificate_view->BillPeriod->Visible) { // BillPeriod ?>
	<tr id="r_BillPeriod">
		<td class="<?php echo $fire_certificate_view->TableLeftColumnClass ?>"><span id="elh_fire_certificate_BillPeriod"><?php echo $fire_certificate_view->BillPeriod->caption() ?></span></td>
		<td data-name="BillPeriod" <?php echo $fire_certificate_view->BillPeriod->cellAttributes() ?>>
<span id="el_fire_certificate_BillPeriod">
<span<?php echo $fire_certificate_view->BillPeriod->viewAttributes() ?>><?php echo $fire_certificate_view->BillPeriod->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fire_certificate_view->PeriodType->Visible) { // PeriodType ?>
	<tr id="r_PeriodType">
		<td class="<?php echo $fire_certificate_view->TableLeftColumnClass ?>"><span id="elh_fire_certificate_PeriodType"><?php echo $fire_certificate_view->PeriodType->caption() ?></span></td>
		<td data-name="PeriodType" <?php echo $fire_certificate_view->PeriodType->cellAttributes() ?>>
<span id="el_fire_certificate_PeriodType">
<span<?php echo $fire_certificate_view->PeriodType->viewAttributes() ?>><?php echo $fire_certificate_view->PeriodType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fire_certificate_view->BillYear->Visible) { // BillYear ?>
	<tr id="r_BillYear">
		<td class="<?php echo $fire_certificate_view->TableLeftColumnClass ?>"><span id="elh_fire_certificate_BillYear"><?php echo $fire_certificate_view->BillYear->caption() ?></span></td>
		<td data-name="BillYear" <?php echo $fire_certificate_view->BillYear->cellAttributes() ?>>
<span id="el_fire_certificate_BillYear">
<span<?php echo $fire_certificate_view->BillYear->viewAttributes() ?>><?php echo $fire_certificate_view->BillYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fire_certificate_view->StartDate->Visible) { // StartDate ?>
	<tr id="r_StartDate">
		<td class="<?php echo $fire_certificate_view->TableLeftColumnClass ?>"><span id="elh_fire_certificate_StartDate"><?php echo $fire_certificate_view->StartDate->caption() ?></span></td>
		<td data-name="StartDate" <?php echo $fire_certificate_view->StartDate->cellAttributes() ?>>
<span id="el_fire_certificate_StartDate">
<span<?php echo $fire_certificate_view->StartDate->viewAttributes() ?>><?php echo $fire_certificate_view->StartDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fire_certificate_view->EndDate->Visible) { // EndDate ?>
	<tr id="r_EndDate">
		<td class="<?php echo $fire_certificate_view->TableLeftColumnClass ?>"><span id="elh_fire_certificate_EndDate"><?php echo $fire_certificate_view->EndDate->caption() ?></span></td>
		<td data-name="EndDate" <?php echo $fire_certificate_view->EndDate->cellAttributes() ?>>
<span id="el_fire_certificate_EndDate">
<span<?php echo $fire_certificate_view->EndDate->viewAttributes() ?>><?php echo $fire_certificate_view->EndDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fire_certificate_view->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<tr id="r_LastUpdatedBy">
		<td class="<?php echo $fire_certificate_view->TableLeftColumnClass ?>"><span id="elh_fire_certificate_LastUpdatedBy"><?php echo $fire_certificate_view->LastUpdatedBy->caption() ?></span></td>
		<td data-name="LastUpdatedBy" <?php echo $fire_certificate_view->LastUpdatedBy->cellAttributes() ?>>
<span id="el_fire_certificate_LastUpdatedBy">
<span<?php echo $fire_certificate_view->LastUpdatedBy->viewAttributes() ?>><?php echo $fire_certificate_view->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fire_certificate_view->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<tr id="r_LastUpdateDate">
		<td class="<?php echo $fire_certificate_view->TableLeftColumnClass ?>"><span id="elh_fire_certificate_LastUpdateDate"><?php echo $fire_certificate_view->LastUpdateDate->caption() ?></span></td>
		<td data-name="LastUpdateDate" <?php echo $fire_certificate_view->LastUpdateDate->cellAttributes() ?>>
<span id="el_fire_certificate_LastUpdateDate">
<span<?php echo $fire_certificate_view->LastUpdateDate->viewAttributes() ?>><?php echo $fire_certificate_view->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$fire_certificate_view->IsModal) { ?>
<?php if (!$fire_certificate_view->isExport()) { ?>
<?php echo $fire_certificate_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$fire_certificate_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$fire_certificate_view->isExport()) { ?>
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
$fire_certificate_view->terminate();
?>