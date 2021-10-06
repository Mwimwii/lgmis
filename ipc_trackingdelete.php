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
$ipc_tracking_delete = new ipc_tracking_delete();

// Run the page
$ipc_tracking_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ipc_tracking_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fipc_trackingdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fipc_trackingdelete = currentForm = new ew.Form("fipc_trackingdelete", "delete");
	loadjs.done("fipc_trackingdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ipc_tracking_delete->showPageHeader(); ?>
<?php
$ipc_tracking_delete->showMessage();
?>
<form name="fipc_trackingdelete" id="fipc_trackingdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ipc_tracking">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ipc_tracking_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ipc_tracking_delete->IPCNo->Visible) { // IPCNo ?>
		<th class="<?php echo $ipc_tracking_delete->IPCNo->headerCellClass() ?>"><span id="elh_ipc_tracking_IPCNo" class="ipc_tracking_IPCNo"><?php echo $ipc_tracking_delete->IPCNo->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->ContractNo->Visible) { // ContractNo ?>
		<th class="<?php echo $ipc_tracking_delete->ContractNo->headerCellClass() ?>"><span id="elh_ipc_tracking_ContractNo" class="ipc_tracking_ContractNo"><?php echo $ipc_tracking_delete->ContractNo->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->ContractAuthorizedByAG->Visible) { // ContractAuthorizedByAG ?>
		<th class="<?php echo $ipc_tracking_delete->ContractAuthorizedByAG->headerCellClass() ?>"><span id="elh_ipc_tracking_ContractAuthorizedByAG" class="ipc_tracking_ContractAuthorizedByAG"><?php echo $ipc_tracking_delete->ContractAuthorizedByAG->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->VATApplied->Visible) { // VATApplied ?>
		<th class="<?php echo $ipc_tracking_delete->VATApplied->headerCellClass() ?>"><span id="elh_ipc_tracking_VATApplied" class="ipc_tracking_VATApplied"><?php echo $ipc_tracking_delete->VATApplied->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->ArithmeticCheckDone->Visible) { // ArithmeticCheckDone ?>
		<th class="<?php echo $ipc_tracking_delete->ArithmeticCheckDone->headerCellClass() ?>"><span id="elh_ipc_tracking_ArithmeticCheckDone" class="ipc_tracking_ArithmeticCheckDone"><?php echo $ipc_tracking_delete->ArithmeticCheckDone->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->VariationsApproved->Visible) { // VariationsApproved ?>
		<th class="<?php echo $ipc_tracking_delete->VariationsApproved->headerCellClass() ?>"><span id="elh_ipc_tracking_VariationsApproved" class="ipc_tracking_VariationsApproved"><?php echo $ipc_tracking_delete->VariationsApproved->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->PerformanceBondValidUntil->Visible) { // PerformanceBondValidUntil ?>
		<th class="<?php echo $ipc_tracking_delete->PerformanceBondValidUntil->headerCellClass() ?>"><span id="elh_ipc_tracking_PerformanceBondValidUntil" class="ipc_tracking_PerformanceBondValidUntil"><?php echo $ipc_tracking_delete->PerformanceBondValidUntil->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->AdvancePaymentBondValidUntil->Visible) { // AdvancePaymentBondValidUntil ?>
		<th class="<?php echo $ipc_tracking_delete->AdvancePaymentBondValidUntil->headerCellClass() ?>"><span id="elh_ipc_tracking_AdvancePaymentBondValidUntil" class="ipc_tracking_AdvancePaymentBondValidUntil"><?php echo $ipc_tracking_delete->AdvancePaymentBondValidUntil->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->RetentionDeductionClause->Visible) { // RetentionDeductionClause ?>
		<th class="<?php echo $ipc_tracking_delete->RetentionDeductionClause->headerCellClass() ?>"><span id="elh_ipc_tracking_RetentionDeductionClause" class="ipc_tracking_RetentionDeductionClause"><?php echo $ipc_tracking_delete->RetentionDeductionClause->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->RetentionDeducted->Visible) { // RetentionDeducted ?>
		<th class="<?php echo $ipc_tracking_delete->RetentionDeducted->headerCellClass() ?>"><span id="elh_ipc_tracking_RetentionDeducted" class="ipc_tracking_RetentionDeducted"><?php echo $ipc_tracking_delete->RetentionDeducted->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->LiquidatedDamagesDeducted->Visible) { // LiquidatedDamagesDeducted ?>
		<th class="<?php echo $ipc_tracking_delete->LiquidatedDamagesDeducted->headerCellClass() ?>"><span id="elh_ipc_tracking_LiquidatedDamagesDeducted" class="ipc_tracking_LiquidatedDamagesDeducted"><?php echo $ipc_tracking_delete->LiquidatedDamagesDeducted->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->AdvancedPaymentDeducted->Visible) { // AdvancedPaymentDeducted ?>
		<th class="<?php echo $ipc_tracking_delete->AdvancedPaymentDeducted->headerCellClass() ?>"><span id="elh_ipc_tracking_AdvancedPaymentDeducted" class="ipc_tracking_AdvancedPaymentDeducted"><?php echo $ipc_tracking_delete->AdvancedPaymentDeducted->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->CurrentProgressReportAttached->Visible) { // CurrentProgressReportAttached ?>
		<th class="<?php echo $ipc_tracking_delete->CurrentProgressReportAttached->headerCellClass() ?>"><span id="elh_ipc_tracking_CurrentProgressReportAttached" class="ipc_tracking_CurrentProgressReportAttached"><?php echo $ipc_tracking_delete->CurrentProgressReportAttached->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->DateOfSiteInspection->Visible) { // DateOfSiteInspection ?>
		<th class="<?php echo $ipc_tracking_delete->DateOfSiteInspection->headerCellClass() ?>"><span id="elh_ipc_tracking_DateOfSiteInspection" class="ipc_tracking_DateOfSiteInspection"><?php echo $ipc_tracking_delete->DateOfSiteInspection->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->TimeExtensionAuthorized->Visible) { // TimeExtensionAuthorized ?>
		<th class="<?php echo $ipc_tracking_delete->TimeExtensionAuthorized->headerCellClass() ?>"><span id="elh_ipc_tracking_TimeExtensionAuthorized" class="ipc_tracking_TimeExtensionAuthorized"><?php echo $ipc_tracking_delete->TimeExtensionAuthorized->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->LabResultsChecked->Visible) { // LabResultsChecked ?>
		<th class="<?php echo $ipc_tracking_delete->LabResultsChecked->headerCellClass() ?>"><span id="elh_ipc_tracking_LabResultsChecked" class="ipc_tracking_LabResultsChecked"><?php echo $ipc_tracking_delete->LabResultsChecked->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->TerminationNoticeGiven->Visible) { // TerminationNoticeGiven ?>
		<th class="<?php echo $ipc_tracking_delete->TerminationNoticeGiven->headerCellClass() ?>"><span id="elh_ipc_tracking_TerminationNoticeGiven" class="ipc_tracking_TerminationNoticeGiven"><?php echo $ipc_tracking_delete->TerminationNoticeGiven->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->CopiesEmailedToMLG->Visible) { // CopiesEmailedToMLG ?>
		<th class="<?php echo $ipc_tracking_delete->CopiesEmailedToMLG->headerCellClass() ?>"><span id="elh_ipc_tracking_CopiesEmailedToMLG" class="ipc_tracking_CopiesEmailedToMLG"><?php echo $ipc_tracking_delete->CopiesEmailedToMLG->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->ContractStillValid->Visible) { // ContractStillValid ?>
		<th class="<?php echo $ipc_tracking_delete->ContractStillValid->headerCellClass() ?>"><span id="elh_ipc_tracking_ContractStillValid" class="ipc_tracking_ContractStillValid"><?php echo $ipc_tracking_delete->ContractStillValid->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->DeskOfficer->Visible) { // DeskOfficer ?>
		<th class="<?php echo $ipc_tracking_delete->DeskOfficer->headerCellClass() ?>"><span id="elh_ipc_tracking_DeskOfficer" class="ipc_tracking_DeskOfficer"><?php echo $ipc_tracking_delete->DeskOfficer->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->DeskOfficerDate->Visible) { // DeskOfficerDate ?>
		<th class="<?php echo $ipc_tracking_delete->DeskOfficerDate->headerCellClass() ?>"><span id="elh_ipc_tracking_DeskOfficerDate" class="ipc_tracking_DeskOfficerDate"><?php echo $ipc_tracking_delete->DeskOfficerDate->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->SupervisingEngineer->Visible) { // SupervisingEngineer ?>
		<th class="<?php echo $ipc_tracking_delete->SupervisingEngineer->headerCellClass() ?>"><span id="elh_ipc_tracking_SupervisingEngineer" class="ipc_tracking_SupervisingEngineer"><?php echo $ipc_tracking_delete->SupervisingEngineer->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->EngineerDate->Visible) { // EngineerDate ?>
		<th class="<?php echo $ipc_tracking_delete->EngineerDate->headerCellClass() ?>"><span id="elh_ipc_tracking_EngineerDate" class="ipc_tracking_EngineerDate"><?php echo $ipc_tracking_delete->EngineerDate->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->CouncilSecretary->Visible) { // CouncilSecretary ?>
		<th class="<?php echo $ipc_tracking_delete->CouncilSecretary->headerCellClass() ?>"><span id="elh_ipc_tracking_CouncilSecretary" class="ipc_tracking_CouncilSecretary"><?php echo $ipc_tracking_delete->CouncilSecretary->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->CSDate->Visible) { // CSDate ?>
		<th class="<?php echo $ipc_tracking_delete->CSDate->headerCellClass() ?>"><span id="elh_ipc_tracking_CSDate" class="ipc_tracking_CSDate"><?php echo $ipc_tracking_delete->CSDate->caption() ?></span></th>
<?php } ?>
<?php if ($ipc_tracking_delete->ContractType->Visible) { // ContractType ?>
		<th class="<?php echo $ipc_tracking_delete->ContractType->headerCellClass() ?>"><span id="elh_ipc_tracking_ContractType" class="ipc_tracking_ContractType"><?php echo $ipc_tracking_delete->ContractType->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ipc_tracking_delete->RecordCount = 0;
$i = 0;
while (!$ipc_tracking_delete->Recordset->EOF) {
	$ipc_tracking_delete->RecordCount++;
	$ipc_tracking_delete->RowCount++;

	// Set row properties
	$ipc_tracking->resetAttributes();
	$ipc_tracking->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ipc_tracking_delete->loadRowValues($ipc_tracking_delete->Recordset);

	// Render row
	$ipc_tracking_delete->renderRow();
?>
	<tr <?php echo $ipc_tracking->rowAttributes() ?>>
<?php if ($ipc_tracking_delete->IPCNo->Visible) { // IPCNo ?>
		<td <?php echo $ipc_tracking_delete->IPCNo->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_IPCNo" class="ipc_tracking_IPCNo">
<span<?php echo $ipc_tracking_delete->IPCNo->viewAttributes() ?>><?php echo $ipc_tracking_delete->IPCNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->ContractNo->Visible) { // ContractNo ?>
		<td <?php echo $ipc_tracking_delete->ContractNo->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_ContractNo" class="ipc_tracking_ContractNo">
<span<?php echo $ipc_tracking_delete->ContractNo->viewAttributes() ?>><?php echo $ipc_tracking_delete->ContractNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->ContractAuthorizedByAG->Visible) { // ContractAuthorizedByAG ?>
		<td <?php echo $ipc_tracking_delete->ContractAuthorizedByAG->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_ContractAuthorizedByAG" class="ipc_tracking_ContractAuthorizedByAG">
<span<?php echo $ipc_tracking_delete->ContractAuthorizedByAG->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ContractAuthorizedByAG" class="custom-control-input" value="<?php echo $ipc_tracking_delete->ContractAuthorizedByAG->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_delete->ContractAuthorizedByAG->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ContractAuthorizedByAG"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->VATApplied->Visible) { // VATApplied ?>
		<td <?php echo $ipc_tracking_delete->VATApplied->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_VATApplied" class="ipc_tracking_VATApplied">
<span<?php echo $ipc_tracking_delete->VATApplied->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_VATApplied" class="custom-control-input" value="<?php echo $ipc_tracking_delete->VATApplied->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_delete->VATApplied->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_VATApplied"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->ArithmeticCheckDone->Visible) { // ArithmeticCheckDone ?>
		<td <?php echo $ipc_tracking_delete->ArithmeticCheckDone->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_ArithmeticCheckDone" class="ipc_tracking_ArithmeticCheckDone">
<span<?php echo $ipc_tracking_delete->ArithmeticCheckDone->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ArithmeticCheckDone" class="custom-control-input" value="<?php echo $ipc_tracking_delete->ArithmeticCheckDone->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_delete->ArithmeticCheckDone->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ArithmeticCheckDone"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->VariationsApproved->Visible) { // VariationsApproved ?>
		<td <?php echo $ipc_tracking_delete->VariationsApproved->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_VariationsApproved" class="ipc_tracking_VariationsApproved">
<span<?php echo $ipc_tracking_delete->VariationsApproved->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_VariationsApproved" class="custom-control-input" value="<?php echo $ipc_tracking_delete->VariationsApproved->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_delete->VariationsApproved->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_VariationsApproved"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->PerformanceBondValidUntil->Visible) { // PerformanceBondValidUntil ?>
		<td <?php echo $ipc_tracking_delete->PerformanceBondValidUntil->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_PerformanceBondValidUntil" class="ipc_tracking_PerformanceBondValidUntil">
<span<?php echo $ipc_tracking_delete->PerformanceBondValidUntil->viewAttributes() ?>><?php echo $ipc_tracking_delete->PerformanceBondValidUntil->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->AdvancePaymentBondValidUntil->Visible) { // AdvancePaymentBondValidUntil ?>
		<td <?php echo $ipc_tracking_delete->AdvancePaymentBondValidUntil->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_AdvancePaymentBondValidUntil" class="ipc_tracking_AdvancePaymentBondValidUntil">
<span<?php echo $ipc_tracking_delete->AdvancePaymentBondValidUntil->viewAttributes() ?>><?php echo $ipc_tracking_delete->AdvancePaymentBondValidUntil->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->RetentionDeductionClause->Visible) { // RetentionDeductionClause ?>
		<td <?php echo $ipc_tracking_delete->RetentionDeductionClause->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_RetentionDeductionClause" class="ipc_tracking_RetentionDeductionClause">
<span<?php echo $ipc_tracking_delete->RetentionDeductionClause->viewAttributes() ?>><?php echo $ipc_tracking_delete->RetentionDeductionClause->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->RetentionDeducted->Visible) { // RetentionDeducted ?>
		<td <?php echo $ipc_tracking_delete->RetentionDeducted->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_RetentionDeducted" class="ipc_tracking_RetentionDeducted">
<span<?php echo $ipc_tracking_delete->RetentionDeducted->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_RetentionDeducted" class="custom-control-input" value="<?php echo $ipc_tracking_delete->RetentionDeducted->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_delete->RetentionDeducted->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_RetentionDeducted"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->LiquidatedDamagesDeducted->Visible) { // LiquidatedDamagesDeducted ?>
		<td <?php echo $ipc_tracking_delete->LiquidatedDamagesDeducted->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_LiquidatedDamagesDeducted" class="ipc_tracking_LiquidatedDamagesDeducted">
<span<?php echo $ipc_tracking_delete->LiquidatedDamagesDeducted->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_LiquidatedDamagesDeducted" class="custom-control-input" value="<?php echo $ipc_tracking_delete->LiquidatedDamagesDeducted->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_delete->LiquidatedDamagesDeducted->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_LiquidatedDamagesDeducted"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->AdvancedPaymentDeducted->Visible) { // AdvancedPaymentDeducted ?>
		<td <?php echo $ipc_tracking_delete->AdvancedPaymentDeducted->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_AdvancedPaymentDeducted" class="ipc_tracking_AdvancedPaymentDeducted">
<span<?php echo $ipc_tracking_delete->AdvancedPaymentDeducted->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AdvancedPaymentDeducted" class="custom-control-input" value="<?php echo $ipc_tracking_delete->AdvancedPaymentDeducted->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_delete->AdvancedPaymentDeducted->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AdvancedPaymentDeducted"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->CurrentProgressReportAttached->Visible) { // CurrentProgressReportAttached ?>
		<td <?php echo $ipc_tracking_delete->CurrentProgressReportAttached->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_CurrentProgressReportAttached" class="ipc_tracking_CurrentProgressReportAttached">
<span<?php echo $ipc_tracking_delete->CurrentProgressReportAttached->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_CurrentProgressReportAttached" class="custom-control-input" value="<?php echo $ipc_tracking_delete->CurrentProgressReportAttached->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_delete->CurrentProgressReportAttached->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_CurrentProgressReportAttached"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->DateOfSiteInspection->Visible) { // DateOfSiteInspection ?>
		<td <?php echo $ipc_tracking_delete->DateOfSiteInspection->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_DateOfSiteInspection" class="ipc_tracking_DateOfSiteInspection">
<span<?php echo $ipc_tracking_delete->DateOfSiteInspection->viewAttributes() ?>><?php echo $ipc_tracking_delete->DateOfSiteInspection->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->TimeExtensionAuthorized->Visible) { // TimeExtensionAuthorized ?>
		<td <?php echo $ipc_tracking_delete->TimeExtensionAuthorized->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_TimeExtensionAuthorized" class="ipc_tracking_TimeExtensionAuthorized">
<span<?php echo $ipc_tracking_delete->TimeExtensionAuthorized->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_TimeExtensionAuthorized" class="custom-control-input" value="<?php echo $ipc_tracking_delete->TimeExtensionAuthorized->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_delete->TimeExtensionAuthorized->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_TimeExtensionAuthorized"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->LabResultsChecked->Visible) { // LabResultsChecked ?>
		<td <?php echo $ipc_tracking_delete->LabResultsChecked->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_LabResultsChecked" class="ipc_tracking_LabResultsChecked">
<span<?php echo $ipc_tracking_delete->LabResultsChecked->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_LabResultsChecked" class="custom-control-input" value="<?php echo $ipc_tracking_delete->LabResultsChecked->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_delete->LabResultsChecked->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_LabResultsChecked"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->TerminationNoticeGiven->Visible) { // TerminationNoticeGiven ?>
		<td <?php echo $ipc_tracking_delete->TerminationNoticeGiven->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_TerminationNoticeGiven" class="ipc_tracking_TerminationNoticeGiven">
<span<?php echo $ipc_tracking_delete->TerminationNoticeGiven->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_TerminationNoticeGiven" class="custom-control-input" value="<?php echo $ipc_tracking_delete->TerminationNoticeGiven->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_delete->TerminationNoticeGiven->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_TerminationNoticeGiven"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->CopiesEmailedToMLG->Visible) { // CopiesEmailedToMLG ?>
		<td <?php echo $ipc_tracking_delete->CopiesEmailedToMLG->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_CopiesEmailedToMLG" class="ipc_tracking_CopiesEmailedToMLG">
<span<?php echo $ipc_tracking_delete->CopiesEmailedToMLG->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_CopiesEmailedToMLG" class="custom-control-input" value="<?php echo $ipc_tracking_delete->CopiesEmailedToMLG->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_delete->CopiesEmailedToMLG->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_CopiesEmailedToMLG"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->ContractStillValid->Visible) { // ContractStillValid ?>
		<td <?php echo $ipc_tracking_delete->ContractStillValid->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_ContractStillValid" class="ipc_tracking_ContractStillValid">
<span<?php echo $ipc_tracking_delete->ContractStillValid->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ContractStillValid" class="custom-control-input" value="<?php echo $ipc_tracking_delete->ContractStillValid->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_delete->ContractStillValid->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ContractStillValid"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->DeskOfficer->Visible) { // DeskOfficer ?>
		<td <?php echo $ipc_tracking_delete->DeskOfficer->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_DeskOfficer" class="ipc_tracking_DeskOfficer">
<span<?php echo $ipc_tracking_delete->DeskOfficer->viewAttributes() ?>><?php echo $ipc_tracking_delete->DeskOfficer->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->DeskOfficerDate->Visible) { // DeskOfficerDate ?>
		<td <?php echo $ipc_tracking_delete->DeskOfficerDate->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_DeskOfficerDate" class="ipc_tracking_DeskOfficerDate">
<span<?php echo $ipc_tracking_delete->DeskOfficerDate->viewAttributes() ?>><?php echo $ipc_tracking_delete->DeskOfficerDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->SupervisingEngineer->Visible) { // SupervisingEngineer ?>
		<td <?php echo $ipc_tracking_delete->SupervisingEngineer->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_SupervisingEngineer" class="ipc_tracking_SupervisingEngineer">
<span<?php echo $ipc_tracking_delete->SupervisingEngineer->viewAttributes() ?>><?php echo $ipc_tracking_delete->SupervisingEngineer->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->EngineerDate->Visible) { // EngineerDate ?>
		<td <?php echo $ipc_tracking_delete->EngineerDate->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_EngineerDate" class="ipc_tracking_EngineerDate">
<span<?php echo $ipc_tracking_delete->EngineerDate->viewAttributes() ?>><?php echo $ipc_tracking_delete->EngineerDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->CouncilSecretary->Visible) { // CouncilSecretary ?>
		<td <?php echo $ipc_tracking_delete->CouncilSecretary->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_CouncilSecretary" class="ipc_tracking_CouncilSecretary">
<span<?php echo $ipc_tracking_delete->CouncilSecretary->viewAttributes() ?>><?php echo $ipc_tracking_delete->CouncilSecretary->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->CSDate->Visible) { // CSDate ?>
		<td <?php echo $ipc_tracking_delete->CSDate->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_CSDate" class="ipc_tracking_CSDate">
<span<?php echo $ipc_tracking_delete->CSDate->viewAttributes() ?>><?php echo $ipc_tracking_delete->CSDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ipc_tracking_delete->ContractType->Visible) { // ContractType ?>
		<td <?php echo $ipc_tracking_delete->ContractType->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_delete->RowCount ?>_ipc_tracking_ContractType" class="ipc_tracking_ContractType">
<span<?php echo $ipc_tracking_delete->ContractType->viewAttributes() ?>><?php echo $ipc_tracking_delete->ContractType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ipc_tracking_delete->Recordset->moveNext();
}
$ipc_tracking_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ipc_tracking_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ipc_tracking_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$ipc_tracking_delete->terminate();
?>