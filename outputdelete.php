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
$output_delete = new output_delete();

// Run the page
$output_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$output_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var foutputdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	foutputdelete = currentForm = new ew.Form("foutputdelete", "delete");
	loadjs.done("foutputdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $output_delete->showPageHeader(); ?>
<?php
$output_delete->showMessage();
?>
<form name="foutputdelete" id="foutputdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="output">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($output_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($output_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $output_delete->LACode->headerCellClass() ?>"><span id="elh_output_LACode" class="output_LACode"><?php echo $output_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($output_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<th class="<?php echo $output_delete->DepartmentCode->headerCellClass() ?>"><span id="elh_output_DepartmentCode" class="output_DepartmentCode"><?php echo $output_delete->DepartmentCode->caption() ?></span></th>
<?php } ?>
<?php if ($output_delete->SectionCode->Visible) { // SectionCode ?>
		<th class="<?php echo $output_delete->SectionCode->headerCellClass() ?>"><span id="elh_output_SectionCode" class="output_SectionCode"><?php echo $output_delete->SectionCode->caption() ?></span></th>
<?php } ?>
<?php if ($output_delete->OutcomeCode->Visible) { // OutcomeCode ?>
		<th class="<?php echo $output_delete->OutcomeCode->headerCellClass() ?>"><span id="elh_output_OutcomeCode" class="output_OutcomeCode"><?php echo $output_delete->OutcomeCode->caption() ?></span></th>
<?php } ?>
<?php if ($output_delete->ProgramCode->Visible) { // ProgramCode ?>
		<th class="<?php echo $output_delete->ProgramCode->headerCellClass() ?>"><span id="elh_output_ProgramCode" class="output_ProgramCode"><?php echo $output_delete->ProgramCode->caption() ?></span></th>
<?php } ?>
<?php if ($output_delete->SubProgramCode->Visible) { // SubProgramCode ?>
		<th class="<?php echo $output_delete->SubProgramCode->headerCellClass() ?>"><span id="elh_output_SubProgramCode" class="output_SubProgramCode"><?php echo $output_delete->SubProgramCode->caption() ?></span></th>
<?php } ?>
<?php if ($output_delete->OutputCode->Visible) { // OutputCode ?>
		<th class="<?php echo $output_delete->OutputCode->headerCellClass() ?>"><span id="elh_output_OutputCode" class="output_OutputCode"><?php echo $output_delete->OutputCode->caption() ?></span></th>
<?php } ?>
<?php if ($output_delete->OutputType->Visible) { // OutputType ?>
		<th class="<?php echo $output_delete->OutputType->headerCellClass() ?>"><span id="elh_output_OutputType" class="output_OutputType"><?php echo $output_delete->OutputType->caption() ?></span></th>
<?php } ?>
<?php if ($output_delete->OutputName->Visible) { // OutputName ?>
		<th class="<?php echo $output_delete->OutputName->headerCellClass() ?>"><span id="elh_output_OutputName" class="output_OutputName"><?php echo $output_delete->OutputName->caption() ?></span></th>
<?php } ?>
<?php if ($output_delete->DeliveryDate->Visible) { // DeliveryDate ?>
		<th class="<?php echo $output_delete->DeliveryDate->headerCellClass() ?>"><span id="elh_output_DeliveryDate" class="output_DeliveryDate"><?php echo $output_delete->DeliveryDate->caption() ?></span></th>
<?php } ?>
<?php if ($output_delete->FinancialYear->Visible) { // FinancialYear ?>
		<th class="<?php echo $output_delete->FinancialYear->headerCellClass() ?>"><span id="elh_output_FinancialYear" class="output_FinancialYear"><?php echo $output_delete->FinancialYear->caption() ?></span></th>
<?php } ?>
<?php if ($output_delete->OutputDescription->Visible) { // OutputDescription ?>
		<th class="<?php echo $output_delete->OutputDescription->headerCellClass() ?>"><span id="elh_output_OutputDescription" class="output_OutputDescription"><?php echo $output_delete->OutputDescription->caption() ?></span></th>
<?php } ?>
<?php if ($output_delete->OutputMeansOfVerification->Visible) { // OutputMeansOfVerification ?>
		<th class="<?php echo $output_delete->OutputMeansOfVerification->headerCellClass() ?>"><span id="elh_output_OutputMeansOfVerification" class="output_OutputMeansOfVerification"><?php echo $output_delete->OutputMeansOfVerification->caption() ?></span></th>
<?php } ?>
<?php if ($output_delete->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
		<th class="<?php echo $output_delete->ResponsibleOfficer->headerCellClass() ?>"><span id="elh_output_ResponsibleOfficer" class="output_ResponsibleOfficer"><?php echo $output_delete->ResponsibleOfficer->caption() ?></span></th>
<?php } ?>
<?php if ($output_delete->Clients->Visible) { // Clients ?>
		<th class="<?php echo $output_delete->Clients->headerCellClass() ?>"><span id="elh_output_Clients" class="output_Clients"><?php echo $output_delete->Clients->caption() ?></span></th>
<?php } ?>
<?php if ($output_delete->Beneficiaries->Visible) { // Beneficiaries ?>
		<th class="<?php echo $output_delete->Beneficiaries->headerCellClass() ?>"><span id="elh_output_Beneficiaries" class="output_Beneficiaries"><?php echo $output_delete->Beneficiaries->caption() ?></span></th>
<?php } ?>
<?php if ($output_delete->OutputStatus->Visible) { // OutputStatus ?>
		<th class="<?php echo $output_delete->OutputStatus->headerCellClass() ?>"><span id="elh_output_OutputStatus" class="output_OutputStatus"><?php echo $output_delete->OutputStatus->caption() ?></span></th>
<?php } ?>
<?php if ($output_delete->TargetAmount->Visible) { // TargetAmount ?>
		<th class="<?php echo $output_delete->TargetAmount->headerCellClass() ?>"><span id="elh_output_TargetAmount" class="output_TargetAmount"><?php echo $output_delete->TargetAmount->caption() ?></span></th>
<?php } ?>
<?php if ($output_delete->ActualAmount->Visible) { // ActualAmount ?>
		<th class="<?php echo $output_delete->ActualAmount->headerCellClass() ?>"><span id="elh_output_ActualAmount" class="output_ActualAmount"><?php echo $output_delete->ActualAmount->caption() ?></span></th>
<?php } ?>
<?php if ($output_delete->PercentAchieved->Visible) { // PercentAchieved ?>
		<th class="<?php echo $output_delete->PercentAchieved->headerCellClass() ?>"><span id="elh_output_PercentAchieved" class="output_PercentAchieved"><?php echo $output_delete->PercentAchieved->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$output_delete->RecordCount = 0;
$i = 0;
while (!$output_delete->Recordset->EOF) {
	$output_delete->RecordCount++;
	$output_delete->RowCount++;

	// Set row properties
	$output->resetAttributes();
	$output->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$output_delete->loadRowValues($output_delete->Recordset);

	// Render row
	$output_delete->renderRow();
?>
	<tr <?php echo $output->rowAttributes() ?>>
<?php if ($output_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $output_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $output_delete->RowCount ?>_output_LACode" class="output_LACode">
<span<?php echo $output_delete->LACode->viewAttributes() ?>><?php echo $output_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<td <?php echo $output_delete->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $output_delete->RowCount ?>_output_DepartmentCode" class="output_DepartmentCode">
<span<?php echo $output_delete->DepartmentCode->viewAttributes() ?>><?php echo $output_delete->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_delete->SectionCode->Visible) { // SectionCode ?>
		<td <?php echo $output_delete->SectionCode->cellAttributes() ?>>
<span id="el<?php echo $output_delete->RowCount ?>_output_SectionCode" class="output_SectionCode">
<span<?php echo $output_delete->SectionCode->viewAttributes() ?>><?php echo $output_delete->SectionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_delete->OutcomeCode->Visible) { // OutcomeCode ?>
		<td <?php echo $output_delete->OutcomeCode->cellAttributes() ?>>
<span id="el<?php echo $output_delete->RowCount ?>_output_OutcomeCode" class="output_OutcomeCode">
<span<?php echo $output_delete->OutcomeCode->viewAttributes() ?>><?php echo $output_delete->OutcomeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_delete->ProgramCode->Visible) { // ProgramCode ?>
		<td <?php echo $output_delete->ProgramCode->cellAttributes() ?>>
<span id="el<?php echo $output_delete->RowCount ?>_output_ProgramCode" class="output_ProgramCode">
<span<?php echo $output_delete->ProgramCode->viewAttributes() ?>><?php echo $output_delete->ProgramCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_delete->SubProgramCode->Visible) { // SubProgramCode ?>
		<td <?php echo $output_delete->SubProgramCode->cellAttributes() ?>>
<span id="el<?php echo $output_delete->RowCount ?>_output_SubProgramCode" class="output_SubProgramCode">
<span<?php echo $output_delete->SubProgramCode->viewAttributes() ?>><?php echo $output_delete->SubProgramCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_delete->OutputCode->Visible) { // OutputCode ?>
		<td <?php echo $output_delete->OutputCode->cellAttributes() ?>>
<span id="el<?php echo $output_delete->RowCount ?>_output_OutputCode" class="output_OutputCode">
<span<?php echo $output_delete->OutputCode->viewAttributes() ?>><?php echo $output_delete->OutputCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_delete->OutputType->Visible) { // OutputType ?>
		<td <?php echo $output_delete->OutputType->cellAttributes() ?>>
<span id="el<?php echo $output_delete->RowCount ?>_output_OutputType" class="output_OutputType">
<span<?php echo $output_delete->OutputType->viewAttributes() ?>><?php echo $output_delete->OutputType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_delete->OutputName->Visible) { // OutputName ?>
		<td <?php echo $output_delete->OutputName->cellAttributes() ?>>
<span id="el<?php echo $output_delete->RowCount ?>_output_OutputName" class="output_OutputName">
<span<?php echo $output_delete->OutputName->viewAttributes() ?>><?php echo $output_delete->OutputName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_delete->DeliveryDate->Visible) { // DeliveryDate ?>
		<td <?php echo $output_delete->DeliveryDate->cellAttributes() ?>>
<span id="el<?php echo $output_delete->RowCount ?>_output_DeliveryDate" class="output_DeliveryDate">
<span<?php echo $output_delete->DeliveryDate->viewAttributes() ?>><?php echo $output_delete->DeliveryDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_delete->FinancialYear->Visible) { // FinancialYear ?>
		<td <?php echo $output_delete->FinancialYear->cellAttributes() ?>>
<span id="el<?php echo $output_delete->RowCount ?>_output_FinancialYear" class="output_FinancialYear">
<span<?php echo $output_delete->FinancialYear->viewAttributes() ?>><?php echo $output_delete->FinancialYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_delete->OutputDescription->Visible) { // OutputDescription ?>
		<td <?php echo $output_delete->OutputDescription->cellAttributes() ?>>
<span id="el<?php echo $output_delete->RowCount ?>_output_OutputDescription" class="output_OutputDescription">
<span<?php echo $output_delete->OutputDescription->viewAttributes() ?>><?php echo $output_delete->OutputDescription->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_delete->OutputMeansOfVerification->Visible) { // OutputMeansOfVerification ?>
		<td <?php echo $output_delete->OutputMeansOfVerification->cellAttributes() ?>>
<span id="el<?php echo $output_delete->RowCount ?>_output_OutputMeansOfVerification" class="output_OutputMeansOfVerification">
<span<?php echo $output_delete->OutputMeansOfVerification->viewAttributes() ?>><?php echo $output_delete->OutputMeansOfVerification->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_delete->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
		<td <?php echo $output_delete->ResponsibleOfficer->cellAttributes() ?>>
<span id="el<?php echo $output_delete->RowCount ?>_output_ResponsibleOfficer" class="output_ResponsibleOfficer">
<span<?php echo $output_delete->ResponsibleOfficer->viewAttributes() ?>><?php echo $output_delete->ResponsibleOfficer->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_delete->Clients->Visible) { // Clients ?>
		<td <?php echo $output_delete->Clients->cellAttributes() ?>>
<span id="el<?php echo $output_delete->RowCount ?>_output_Clients" class="output_Clients">
<span<?php echo $output_delete->Clients->viewAttributes() ?>><?php echo $output_delete->Clients->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_delete->Beneficiaries->Visible) { // Beneficiaries ?>
		<td <?php echo $output_delete->Beneficiaries->cellAttributes() ?>>
<span id="el<?php echo $output_delete->RowCount ?>_output_Beneficiaries" class="output_Beneficiaries">
<span<?php echo $output_delete->Beneficiaries->viewAttributes() ?>><?php echo $output_delete->Beneficiaries->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_delete->OutputStatus->Visible) { // OutputStatus ?>
		<td <?php echo $output_delete->OutputStatus->cellAttributes() ?>>
<span id="el<?php echo $output_delete->RowCount ?>_output_OutputStatus" class="output_OutputStatus">
<span<?php echo $output_delete->OutputStatus->viewAttributes() ?>><?php echo $output_delete->OutputStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_delete->TargetAmount->Visible) { // TargetAmount ?>
		<td <?php echo $output_delete->TargetAmount->cellAttributes() ?>>
<span id="el<?php echo $output_delete->RowCount ?>_output_TargetAmount" class="output_TargetAmount">
<span<?php echo $output_delete->TargetAmount->viewAttributes() ?>><?php echo $output_delete->TargetAmount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_delete->ActualAmount->Visible) { // ActualAmount ?>
		<td <?php echo $output_delete->ActualAmount->cellAttributes() ?>>
<span id="el<?php echo $output_delete->RowCount ?>_output_ActualAmount" class="output_ActualAmount">
<span<?php echo $output_delete->ActualAmount->viewAttributes() ?>><?php echo $output_delete->ActualAmount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_delete->PercentAchieved->Visible) { // PercentAchieved ?>
		<td <?php echo $output_delete->PercentAchieved->cellAttributes() ?>>
<span id="el<?php echo $output_delete->RowCount ?>_output_PercentAchieved" class="output_PercentAchieved">
<span<?php echo $output_delete->PercentAchieved->viewAttributes() ?>><?php echo $output_delete->PercentAchieved->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$output_delete->Recordset->moveNext();
}
$output_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $output_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$output_delete->showPageFooter();
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
$output_delete->terminate();
?>