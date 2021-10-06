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
$ipc_tracking_view = new ipc_tracking_view();

// Run the page
$ipc_tracking_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ipc_tracking_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ipc_tracking_view->isExport()) { ?>
<script>
var fipc_trackingview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fipc_trackingview = currentForm = new ew.Form("fipc_trackingview", "view");
	loadjs.done("fipc_trackingview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ipc_tracking_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ipc_tracking_view->ExportOptions->render("body") ?>
<?php $ipc_tracking_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ipc_tracking_view->showPageHeader(); ?>
<?php
$ipc_tracking_view->showMessage();
?>
<?php if (!$ipc_tracking_view->IsModal) { ?>
<?php if (!$ipc_tracking_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ipc_tracking_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fipc_trackingview" id="fipc_trackingview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ipc_tracking">
<input type="hidden" name="modal" value="<?php echo (int)$ipc_tracking_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ipc_tracking_view->IPCNo->Visible) { // IPCNo ?>
	<tr id="r_IPCNo">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_IPCNo"><?php echo $ipc_tracking_view->IPCNo->caption() ?></span></td>
		<td data-name="IPCNo" <?php echo $ipc_tracking_view->IPCNo->cellAttributes() ?>>
<span id="el_ipc_tracking_IPCNo">
<span<?php echo $ipc_tracking_view->IPCNo->viewAttributes() ?>><?php echo $ipc_tracking_view->IPCNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->ContractNo->Visible) { // ContractNo ?>
	<tr id="r_ContractNo">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_ContractNo"><?php echo $ipc_tracking_view->ContractNo->caption() ?></span></td>
		<td data-name="ContractNo" <?php echo $ipc_tracking_view->ContractNo->cellAttributes() ?>>
<span id="el_ipc_tracking_ContractNo">
<span<?php echo $ipc_tracking_view->ContractNo->viewAttributes() ?>><?php echo $ipc_tracking_view->ContractNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->ContractAuthorizedByAG->Visible) { // ContractAuthorizedByAG ?>
	<tr id="r_ContractAuthorizedByAG">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_ContractAuthorizedByAG"><?php echo $ipc_tracking_view->ContractAuthorizedByAG->caption() ?></span></td>
		<td data-name="ContractAuthorizedByAG" <?php echo $ipc_tracking_view->ContractAuthorizedByAG->cellAttributes() ?>>
<span id="el_ipc_tracking_ContractAuthorizedByAG">
<span<?php echo $ipc_tracking_view->ContractAuthorizedByAG->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ContractAuthorizedByAG" class="custom-control-input" value="<?php echo $ipc_tracking_view->ContractAuthorizedByAG->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_view->ContractAuthorizedByAG->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ContractAuthorizedByAG"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->VATApplied->Visible) { // VATApplied ?>
	<tr id="r_VATApplied">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_VATApplied"><?php echo $ipc_tracking_view->VATApplied->caption() ?></span></td>
		<td data-name="VATApplied" <?php echo $ipc_tracking_view->VATApplied->cellAttributes() ?>>
<span id="el_ipc_tracking_VATApplied">
<span<?php echo $ipc_tracking_view->VATApplied->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_VATApplied" class="custom-control-input" value="<?php echo $ipc_tracking_view->VATApplied->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_view->VATApplied->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_VATApplied"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->ArithmeticCheckDone->Visible) { // ArithmeticCheckDone ?>
	<tr id="r_ArithmeticCheckDone">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_ArithmeticCheckDone"><?php echo $ipc_tracking_view->ArithmeticCheckDone->caption() ?></span></td>
		<td data-name="ArithmeticCheckDone" <?php echo $ipc_tracking_view->ArithmeticCheckDone->cellAttributes() ?>>
<span id="el_ipc_tracking_ArithmeticCheckDone">
<span<?php echo $ipc_tracking_view->ArithmeticCheckDone->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ArithmeticCheckDone" class="custom-control-input" value="<?php echo $ipc_tracking_view->ArithmeticCheckDone->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_view->ArithmeticCheckDone->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ArithmeticCheckDone"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->VariationsApproved->Visible) { // VariationsApproved ?>
	<tr id="r_VariationsApproved">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_VariationsApproved"><?php echo $ipc_tracking_view->VariationsApproved->caption() ?></span></td>
		<td data-name="VariationsApproved" <?php echo $ipc_tracking_view->VariationsApproved->cellAttributes() ?>>
<span id="el_ipc_tracking_VariationsApproved">
<span<?php echo $ipc_tracking_view->VariationsApproved->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_VariationsApproved" class="custom-control-input" value="<?php echo $ipc_tracking_view->VariationsApproved->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_view->VariationsApproved->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_VariationsApproved"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->PerformanceBondValidUntil->Visible) { // PerformanceBondValidUntil ?>
	<tr id="r_PerformanceBondValidUntil">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_PerformanceBondValidUntil"><?php echo $ipc_tracking_view->PerformanceBondValidUntil->caption() ?></span></td>
		<td data-name="PerformanceBondValidUntil" <?php echo $ipc_tracking_view->PerformanceBondValidUntil->cellAttributes() ?>>
<span id="el_ipc_tracking_PerformanceBondValidUntil">
<span<?php echo $ipc_tracking_view->PerformanceBondValidUntil->viewAttributes() ?>><?php echo $ipc_tracking_view->PerformanceBondValidUntil->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->AdvancePaymentBondValidUntil->Visible) { // AdvancePaymentBondValidUntil ?>
	<tr id="r_AdvancePaymentBondValidUntil">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_AdvancePaymentBondValidUntil"><?php echo $ipc_tracking_view->AdvancePaymentBondValidUntil->caption() ?></span></td>
		<td data-name="AdvancePaymentBondValidUntil" <?php echo $ipc_tracking_view->AdvancePaymentBondValidUntil->cellAttributes() ?>>
<span id="el_ipc_tracking_AdvancePaymentBondValidUntil">
<span<?php echo $ipc_tracking_view->AdvancePaymentBondValidUntil->viewAttributes() ?>><?php echo $ipc_tracking_view->AdvancePaymentBondValidUntil->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->RetentionDeductionClause->Visible) { // RetentionDeductionClause ?>
	<tr id="r_RetentionDeductionClause">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_RetentionDeductionClause"><?php echo $ipc_tracking_view->RetentionDeductionClause->caption() ?></span></td>
		<td data-name="RetentionDeductionClause" <?php echo $ipc_tracking_view->RetentionDeductionClause->cellAttributes() ?>>
<span id="el_ipc_tracking_RetentionDeductionClause">
<span<?php echo $ipc_tracking_view->RetentionDeductionClause->viewAttributes() ?>><?php echo $ipc_tracking_view->RetentionDeductionClause->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->RetentionDeducted->Visible) { // RetentionDeducted ?>
	<tr id="r_RetentionDeducted">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_RetentionDeducted"><?php echo $ipc_tracking_view->RetentionDeducted->caption() ?></span></td>
		<td data-name="RetentionDeducted" <?php echo $ipc_tracking_view->RetentionDeducted->cellAttributes() ?>>
<span id="el_ipc_tracking_RetentionDeducted">
<span<?php echo $ipc_tracking_view->RetentionDeducted->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_RetentionDeducted" class="custom-control-input" value="<?php echo $ipc_tracking_view->RetentionDeducted->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_view->RetentionDeducted->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_RetentionDeducted"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->LiquidatedDamagesDeducted->Visible) { // LiquidatedDamagesDeducted ?>
	<tr id="r_LiquidatedDamagesDeducted">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_LiquidatedDamagesDeducted"><?php echo $ipc_tracking_view->LiquidatedDamagesDeducted->caption() ?></span></td>
		<td data-name="LiquidatedDamagesDeducted" <?php echo $ipc_tracking_view->LiquidatedDamagesDeducted->cellAttributes() ?>>
<span id="el_ipc_tracking_LiquidatedDamagesDeducted">
<span<?php echo $ipc_tracking_view->LiquidatedDamagesDeducted->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_LiquidatedDamagesDeducted" class="custom-control-input" value="<?php echo $ipc_tracking_view->LiquidatedDamagesDeducted->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_view->LiquidatedDamagesDeducted->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_LiquidatedDamagesDeducted"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->AdvancedPaymentDeducted->Visible) { // AdvancedPaymentDeducted ?>
	<tr id="r_AdvancedPaymentDeducted">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_AdvancedPaymentDeducted"><?php echo $ipc_tracking_view->AdvancedPaymentDeducted->caption() ?></span></td>
		<td data-name="AdvancedPaymentDeducted" <?php echo $ipc_tracking_view->AdvancedPaymentDeducted->cellAttributes() ?>>
<span id="el_ipc_tracking_AdvancedPaymentDeducted">
<span<?php echo $ipc_tracking_view->AdvancedPaymentDeducted->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AdvancedPaymentDeducted" class="custom-control-input" value="<?php echo $ipc_tracking_view->AdvancedPaymentDeducted->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_view->AdvancedPaymentDeducted->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AdvancedPaymentDeducted"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->CurrentProgressReportAttached->Visible) { // CurrentProgressReportAttached ?>
	<tr id="r_CurrentProgressReportAttached">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_CurrentProgressReportAttached"><?php echo $ipc_tracking_view->CurrentProgressReportAttached->caption() ?></span></td>
		<td data-name="CurrentProgressReportAttached" <?php echo $ipc_tracking_view->CurrentProgressReportAttached->cellAttributes() ?>>
<span id="el_ipc_tracking_CurrentProgressReportAttached">
<span<?php echo $ipc_tracking_view->CurrentProgressReportAttached->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_CurrentProgressReportAttached" class="custom-control-input" value="<?php echo $ipc_tracking_view->CurrentProgressReportAttached->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_view->CurrentProgressReportAttached->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_CurrentProgressReportAttached"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->CurrentProgressReport->Visible) { // CurrentProgressReport ?>
	<tr id="r_CurrentProgressReport">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_CurrentProgressReport"><?php echo $ipc_tracking_view->CurrentProgressReport->caption() ?></span></td>
		<td data-name="CurrentProgressReport" <?php echo $ipc_tracking_view->CurrentProgressReport->cellAttributes() ?>>
<span id="el_ipc_tracking_CurrentProgressReport">
<span<?php echo $ipc_tracking_view->CurrentProgressReport->viewAttributes() ?>><?php echo GetFileViewTag($ipc_tracking_view->CurrentProgressReport, $ipc_tracking_view->CurrentProgressReport->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->DateOfSiteInspection->Visible) { // DateOfSiteInspection ?>
	<tr id="r_DateOfSiteInspection">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_DateOfSiteInspection"><?php echo $ipc_tracking_view->DateOfSiteInspection->caption() ?></span></td>
		<td data-name="DateOfSiteInspection" <?php echo $ipc_tracking_view->DateOfSiteInspection->cellAttributes() ?>>
<span id="el_ipc_tracking_DateOfSiteInspection">
<span<?php echo $ipc_tracking_view->DateOfSiteInspection->viewAttributes() ?>><?php echo $ipc_tracking_view->DateOfSiteInspection->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->TimeExtensionAuthorized->Visible) { // TimeExtensionAuthorized ?>
	<tr id="r_TimeExtensionAuthorized">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_TimeExtensionAuthorized"><?php echo $ipc_tracking_view->TimeExtensionAuthorized->caption() ?></span></td>
		<td data-name="TimeExtensionAuthorized" <?php echo $ipc_tracking_view->TimeExtensionAuthorized->cellAttributes() ?>>
<span id="el_ipc_tracking_TimeExtensionAuthorized">
<span<?php echo $ipc_tracking_view->TimeExtensionAuthorized->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_TimeExtensionAuthorized" class="custom-control-input" value="<?php echo $ipc_tracking_view->TimeExtensionAuthorized->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_view->TimeExtensionAuthorized->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_TimeExtensionAuthorized"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->LabResultsChecked->Visible) { // LabResultsChecked ?>
	<tr id="r_LabResultsChecked">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_LabResultsChecked"><?php echo $ipc_tracking_view->LabResultsChecked->caption() ?></span></td>
		<td data-name="LabResultsChecked" <?php echo $ipc_tracking_view->LabResultsChecked->cellAttributes() ?>>
<span id="el_ipc_tracking_LabResultsChecked">
<span<?php echo $ipc_tracking_view->LabResultsChecked->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_LabResultsChecked" class="custom-control-input" value="<?php echo $ipc_tracking_view->LabResultsChecked->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_view->LabResultsChecked->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_LabResultsChecked"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->LabResults->Visible) { // LabResults ?>
	<tr id="r_LabResults">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_LabResults"><?php echo $ipc_tracking_view->LabResults->caption() ?></span></td>
		<td data-name="LabResults" <?php echo $ipc_tracking_view->LabResults->cellAttributes() ?>>
<span id="el_ipc_tracking_LabResults">
<span<?php echo $ipc_tracking_view->LabResults->viewAttributes() ?>><?php echo GetFileViewTag($ipc_tracking_view->LabResults, $ipc_tracking_view->LabResults->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->TerminationNoticeGiven->Visible) { // TerminationNoticeGiven ?>
	<tr id="r_TerminationNoticeGiven">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_TerminationNoticeGiven"><?php echo $ipc_tracking_view->TerminationNoticeGiven->caption() ?></span></td>
		<td data-name="TerminationNoticeGiven" <?php echo $ipc_tracking_view->TerminationNoticeGiven->cellAttributes() ?>>
<span id="el_ipc_tracking_TerminationNoticeGiven">
<span<?php echo $ipc_tracking_view->TerminationNoticeGiven->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_TerminationNoticeGiven" class="custom-control-input" value="<?php echo $ipc_tracking_view->TerminationNoticeGiven->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_view->TerminationNoticeGiven->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_TerminationNoticeGiven"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->CopiesEmailedToMLG->Visible) { // CopiesEmailedToMLG ?>
	<tr id="r_CopiesEmailedToMLG">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_CopiesEmailedToMLG"><?php echo $ipc_tracking_view->CopiesEmailedToMLG->caption() ?></span></td>
		<td data-name="CopiesEmailedToMLG" <?php echo $ipc_tracking_view->CopiesEmailedToMLG->cellAttributes() ?>>
<span id="el_ipc_tracking_CopiesEmailedToMLG">
<span<?php echo $ipc_tracking_view->CopiesEmailedToMLG->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_CopiesEmailedToMLG" class="custom-control-input" value="<?php echo $ipc_tracking_view->CopiesEmailedToMLG->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_view->CopiesEmailedToMLG->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_CopiesEmailedToMLG"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->ContractStillValid->Visible) { // ContractStillValid ?>
	<tr id="r_ContractStillValid">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_ContractStillValid"><?php echo $ipc_tracking_view->ContractStillValid->caption() ?></span></td>
		<td data-name="ContractStillValid" <?php echo $ipc_tracking_view->ContractStillValid->cellAttributes() ?>>
<span id="el_ipc_tracking_ContractStillValid">
<span<?php echo $ipc_tracking_view->ContractStillValid->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ContractStillValid" class="custom-control-input" value="<?php echo $ipc_tracking_view->ContractStillValid->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_view->ContractStillValid->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ContractStillValid"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->DeskOfficer->Visible) { // DeskOfficer ?>
	<tr id="r_DeskOfficer">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_DeskOfficer"><?php echo $ipc_tracking_view->DeskOfficer->caption() ?></span></td>
		<td data-name="DeskOfficer" <?php echo $ipc_tracking_view->DeskOfficer->cellAttributes() ?>>
<span id="el_ipc_tracking_DeskOfficer">
<span<?php echo $ipc_tracking_view->DeskOfficer->viewAttributes() ?>><?php echo $ipc_tracking_view->DeskOfficer->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->DeskOfficerDate->Visible) { // DeskOfficerDate ?>
	<tr id="r_DeskOfficerDate">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_DeskOfficerDate"><?php echo $ipc_tracking_view->DeskOfficerDate->caption() ?></span></td>
		<td data-name="DeskOfficerDate" <?php echo $ipc_tracking_view->DeskOfficerDate->cellAttributes() ?>>
<span id="el_ipc_tracking_DeskOfficerDate">
<span<?php echo $ipc_tracking_view->DeskOfficerDate->viewAttributes() ?>><?php echo $ipc_tracking_view->DeskOfficerDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->SupervisingEngineer->Visible) { // SupervisingEngineer ?>
	<tr id="r_SupervisingEngineer">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_SupervisingEngineer"><?php echo $ipc_tracking_view->SupervisingEngineer->caption() ?></span></td>
		<td data-name="SupervisingEngineer" <?php echo $ipc_tracking_view->SupervisingEngineer->cellAttributes() ?>>
<span id="el_ipc_tracking_SupervisingEngineer">
<span<?php echo $ipc_tracking_view->SupervisingEngineer->viewAttributes() ?>><?php echo $ipc_tracking_view->SupervisingEngineer->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->EngineerDate->Visible) { // EngineerDate ?>
	<tr id="r_EngineerDate">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_EngineerDate"><?php echo $ipc_tracking_view->EngineerDate->caption() ?></span></td>
		<td data-name="EngineerDate" <?php echo $ipc_tracking_view->EngineerDate->cellAttributes() ?>>
<span id="el_ipc_tracking_EngineerDate">
<span<?php echo $ipc_tracking_view->EngineerDate->viewAttributes() ?>><?php echo $ipc_tracking_view->EngineerDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->CouncilSecretary->Visible) { // CouncilSecretary ?>
	<tr id="r_CouncilSecretary">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_CouncilSecretary"><?php echo $ipc_tracking_view->CouncilSecretary->caption() ?></span></td>
		<td data-name="CouncilSecretary" <?php echo $ipc_tracking_view->CouncilSecretary->cellAttributes() ?>>
<span id="el_ipc_tracking_CouncilSecretary">
<span<?php echo $ipc_tracking_view->CouncilSecretary->viewAttributes() ?>><?php echo $ipc_tracking_view->CouncilSecretary->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->CSDate->Visible) { // CSDate ?>
	<tr id="r_CSDate">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_CSDate"><?php echo $ipc_tracking_view->CSDate->caption() ?></span></td>
		<td data-name="CSDate" <?php echo $ipc_tracking_view->CSDate->cellAttributes() ?>>
<span id="el_ipc_tracking_CSDate">
<span<?php echo $ipc_tracking_view->CSDate->viewAttributes() ?>><?php echo $ipc_tracking_view->CSDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->MLGComments->Visible) { // MLGComments ?>
	<tr id="r_MLGComments">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_MLGComments"><?php echo $ipc_tracking_view->MLGComments->caption() ?></span></td>
		<td data-name="MLGComments" <?php echo $ipc_tracking_view->MLGComments->cellAttributes() ?>>
<span id="el_ipc_tracking_MLGComments">
<span<?php echo $ipc_tracking_view->MLGComments->viewAttributes() ?>><?php echo $ipc_tracking_view->MLGComments->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ipc_tracking_view->ContractType->Visible) { // ContractType ?>
	<tr id="r_ContractType">
		<td class="<?php echo $ipc_tracking_view->TableLeftColumnClass ?>"><span id="elh_ipc_tracking_ContractType"><?php echo $ipc_tracking_view->ContractType->caption() ?></span></td>
		<td data-name="ContractType" <?php echo $ipc_tracking_view->ContractType->cellAttributes() ?>>
<span id="el_ipc_tracking_ContractType">
<span<?php echo $ipc_tracking_view->ContractType->viewAttributes() ?>><?php echo $ipc_tracking_view->ContractType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$ipc_tracking_view->IsModal) { ?>
<?php if (!$ipc_tracking_view->isExport()) { ?>
<?php echo $ipc_tracking_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$ipc_tracking_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ipc_tracking_view->isExport()) { ?>
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
$ipc_tracking_view->terminate();
?>