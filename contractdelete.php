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
$contract_delete = new contract_delete();

// Run the page
$contract_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contract_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcontractdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcontractdelete = currentForm = new ew.Form("fcontractdelete", "delete");
	loadjs.done("fcontractdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $contract_delete->showPageHeader(); ?>
<?php
$contract_delete->showMessage();
?>
<form name="fcontractdelete" id="fcontractdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contract">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($contract_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($contract_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $contract_delete->LACode->headerCellClass() ?>"><span id="elh_contract_LACode" class="contract_LACode"><?php echo $contract_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($contract_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<th class="<?php echo $contract_delete->DepartmentCode->headerCellClass() ?>"><span id="elh_contract_DepartmentCode" class="contract_DepartmentCode"><?php echo $contract_delete->DepartmentCode->caption() ?></span></th>
<?php } ?>
<?php if ($contract_delete->SectionCode->Visible) { // SectionCode ?>
		<th class="<?php echo $contract_delete->SectionCode->headerCellClass() ?>"><span id="elh_contract_SectionCode" class="contract_SectionCode"><?php echo $contract_delete->SectionCode->caption() ?></span></th>
<?php } ?>
<?php if ($contract_delete->ProjectCode->Visible) { // ProjectCode ?>
		<th class="<?php echo $contract_delete->ProjectCode->headerCellClass() ?>"><span id="elh_contract_ProjectCode" class="contract_ProjectCode"><?php echo $contract_delete->ProjectCode->caption() ?></span></th>
<?php } ?>
<?php if ($contract_delete->ContractNo->Visible) { // ContractNo ?>
		<th class="<?php echo $contract_delete->ContractNo->headerCellClass() ?>"><span id="elh_contract_ContractNo" class="contract_ContractNo"><?php echo $contract_delete->ContractNo->caption() ?></span></th>
<?php } ?>
<?php if ($contract_delete->ContractName->Visible) { // ContractName ?>
		<th class="<?php echo $contract_delete->ContractName->headerCellClass() ?>"><span id="elh_contract_ContractName" class="contract_ContractName"><?php echo $contract_delete->ContractName->caption() ?></span></th>
<?php } ?>
<?php if ($contract_delete->ContractType->Visible) { // ContractType ?>
		<th class="<?php echo $contract_delete->ContractType->headerCellClass() ?>"><span id="elh_contract_ContractType" class="contract_ContractType"><?php echo $contract_delete->ContractType->caption() ?></span></th>
<?php } ?>
<?php if ($contract_delete->ContractSum->Visible) { // ContractSum ?>
		<th class="<?php echo $contract_delete->ContractSum->headerCellClass() ?>"><span id="elh_contract_ContractSum" class="contract_ContractSum"><?php echo $contract_delete->ContractSum->caption() ?></span></th>
<?php } ?>
<?php if ($contract_delete->RevisedContractSum->Visible) { // RevisedContractSum ?>
		<th class="<?php echo $contract_delete->RevisedContractSum->headerCellClass() ?>"><span id="elh_contract_RevisedContractSum" class="contract_RevisedContractSum"><?php echo $contract_delete->RevisedContractSum->caption() ?></span></th>
<?php } ?>
<?php if ($contract_delete->ContractorRef->Visible) { // ContractorRef ?>
		<th class="<?php echo $contract_delete->ContractorRef->headerCellClass() ?>"><span id="elh_contract_ContractorRef" class="contract_ContractorRef"><?php echo $contract_delete->ContractorRef->caption() ?></span></th>
<?php } ?>
<?php if ($contract_delete->SigningDate->Visible) { // SigningDate ?>
		<th class="<?php echo $contract_delete->SigningDate->headerCellClass() ?>"><span id="elh_contract_SigningDate" class="contract_SigningDate"><?php echo $contract_delete->SigningDate->caption() ?></span></th>
<?php } ?>
<?php if ($contract_delete->PlannedStartDate->Visible) { // PlannedStartDate ?>
		<th class="<?php echo $contract_delete->PlannedStartDate->headerCellClass() ?>"><span id="elh_contract_PlannedStartDate" class="contract_PlannedStartDate"><?php echo $contract_delete->PlannedStartDate->caption() ?></span></th>
<?php } ?>
<?php if ($contract_delete->PlannedEndDate->Visible) { // PlannedEndDate ?>
		<th class="<?php echo $contract_delete->PlannedEndDate->headerCellClass() ?>"><span id="elh_contract_PlannedEndDate" class="contract_PlannedEndDate"><?php echo $contract_delete->PlannedEndDate->caption() ?></span></th>
<?php } ?>
<?php if ($contract_delete->ActualStartDate->Visible) { // ActualStartDate ?>
		<th class="<?php echo $contract_delete->ActualStartDate->headerCellClass() ?>"><span id="elh_contract_ActualStartDate" class="contract_ActualStartDate"><?php echo $contract_delete->ActualStartDate->caption() ?></span></th>
<?php } ?>
<?php if ($contract_delete->ActualEndDate->Visible) { // ActualEndDate ?>
		<th class="<?php echo $contract_delete->ActualEndDate->headerCellClass() ?>"><span id="elh_contract_ActualEndDate" class="contract_ActualEndDate"><?php echo $contract_delete->ActualEndDate->caption() ?></span></th>
<?php } ?>
<?php if ($contract_delete->Duration->Visible) { // Duration ?>
		<th class="<?php echo $contract_delete->Duration->headerCellClass() ?>"><span id="elh_contract_Duration" class="contract_Duration"><?php echo $contract_delete->Duration->caption() ?></span></th>
<?php } ?>
<?php if ($contract_delete->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<th class="<?php echo $contract_delete->UnitOfMeasure->headerCellClass() ?>"><span id="elh_contract_UnitOfMeasure" class="contract_UnitOfMeasure"><?php echo $contract_delete->UnitOfMeasure->caption() ?></span></th>
<?php } ?>
<?php if ($contract_delete->AdvancePaymentAmount->Visible) { // AdvancePaymentAmount ?>
		<th class="<?php echo $contract_delete->AdvancePaymentAmount->headerCellClass() ?>"><span id="elh_contract_AdvancePaymentAmount" class="contract_AdvancePaymentAmount"><?php echo $contract_delete->AdvancePaymentAmount->caption() ?></span></th>
<?php } ?>
<?php if ($contract_delete->AdvancePaymentdate->Visible) { // AdvancePaymentdate ?>
		<th class="<?php echo $contract_delete->AdvancePaymentdate->headerCellClass() ?>"><span id="elh_contract_AdvancePaymentdate" class="contract_AdvancePaymentdate"><?php echo $contract_delete->AdvancePaymentdate->caption() ?></span></th>
<?php } ?>
<?php if ($contract_delete->ContractStatus->Visible) { // ContractStatus ?>
		<th class="<?php echo $contract_delete->ContractStatus->headerCellClass() ?>"><span id="elh_contract_ContractStatus" class="contract_ContractStatus"><?php echo $contract_delete->ContractStatus->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$contract_delete->RecordCount = 0;
$i = 0;
while (!$contract_delete->Recordset->EOF) {
	$contract_delete->RecordCount++;
	$contract_delete->RowCount++;

	// Set row properties
	$contract->resetAttributes();
	$contract->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$contract_delete->loadRowValues($contract_delete->Recordset);

	// Render row
	$contract_delete->renderRow();
?>
	<tr <?php echo $contract->rowAttributes() ?>>
<?php if ($contract_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $contract_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $contract_delete->RowCount ?>_contract_LACode" class="contract_LACode">
<span<?php echo $contract_delete->LACode->viewAttributes() ?>><?php echo $contract_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<td <?php echo $contract_delete->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $contract_delete->RowCount ?>_contract_DepartmentCode" class="contract_DepartmentCode">
<span<?php echo $contract_delete->DepartmentCode->viewAttributes() ?>><?php echo $contract_delete->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_delete->SectionCode->Visible) { // SectionCode ?>
		<td <?php echo $contract_delete->SectionCode->cellAttributes() ?>>
<span id="el<?php echo $contract_delete->RowCount ?>_contract_SectionCode" class="contract_SectionCode">
<span<?php echo $contract_delete->SectionCode->viewAttributes() ?>><?php echo $contract_delete->SectionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_delete->ProjectCode->Visible) { // ProjectCode ?>
		<td <?php echo $contract_delete->ProjectCode->cellAttributes() ?>>
<span id="el<?php echo $contract_delete->RowCount ?>_contract_ProjectCode" class="contract_ProjectCode">
<span<?php echo $contract_delete->ProjectCode->viewAttributes() ?>><?php echo $contract_delete->ProjectCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_delete->ContractNo->Visible) { // ContractNo ?>
		<td <?php echo $contract_delete->ContractNo->cellAttributes() ?>>
<span id="el<?php echo $contract_delete->RowCount ?>_contract_ContractNo" class="contract_ContractNo">
<span<?php echo $contract_delete->ContractNo->viewAttributes() ?>><?php echo $contract_delete->ContractNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_delete->ContractName->Visible) { // ContractName ?>
		<td <?php echo $contract_delete->ContractName->cellAttributes() ?>>
<span id="el<?php echo $contract_delete->RowCount ?>_contract_ContractName" class="contract_ContractName">
<span<?php echo $contract_delete->ContractName->viewAttributes() ?>><?php echo $contract_delete->ContractName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_delete->ContractType->Visible) { // ContractType ?>
		<td <?php echo $contract_delete->ContractType->cellAttributes() ?>>
<span id="el<?php echo $contract_delete->RowCount ?>_contract_ContractType" class="contract_ContractType">
<span<?php echo $contract_delete->ContractType->viewAttributes() ?>><?php echo $contract_delete->ContractType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_delete->ContractSum->Visible) { // ContractSum ?>
		<td <?php echo $contract_delete->ContractSum->cellAttributes() ?>>
<span id="el<?php echo $contract_delete->RowCount ?>_contract_ContractSum" class="contract_ContractSum">
<span<?php echo $contract_delete->ContractSum->viewAttributes() ?>><?php echo $contract_delete->ContractSum->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_delete->RevisedContractSum->Visible) { // RevisedContractSum ?>
		<td <?php echo $contract_delete->RevisedContractSum->cellAttributes() ?>>
<span id="el<?php echo $contract_delete->RowCount ?>_contract_RevisedContractSum" class="contract_RevisedContractSum">
<span<?php echo $contract_delete->RevisedContractSum->viewAttributes() ?>><?php echo $contract_delete->RevisedContractSum->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_delete->ContractorRef->Visible) { // ContractorRef ?>
		<td <?php echo $contract_delete->ContractorRef->cellAttributes() ?>>
<span id="el<?php echo $contract_delete->RowCount ?>_contract_ContractorRef" class="contract_ContractorRef">
<span<?php echo $contract_delete->ContractorRef->viewAttributes() ?>><?php echo $contract_delete->ContractorRef->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_delete->SigningDate->Visible) { // SigningDate ?>
		<td <?php echo $contract_delete->SigningDate->cellAttributes() ?>>
<span id="el<?php echo $contract_delete->RowCount ?>_contract_SigningDate" class="contract_SigningDate">
<span<?php echo $contract_delete->SigningDate->viewAttributes() ?>><?php echo $contract_delete->SigningDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_delete->PlannedStartDate->Visible) { // PlannedStartDate ?>
		<td <?php echo $contract_delete->PlannedStartDate->cellAttributes() ?>>
<span id="el<?php echo $contract_delete->RowCount ?>_contract_PlannedStartDate" class="contract_PlannedStartDate">
<span<?php echo $contract_delete->PlannedStartDate->viewAttributes() ?>><?php echo $contract_delete->PlannedStartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_delete->PlannedEndDate->Visible) { // PlannedEndDate ?>
		<td <?php echo $contract_delete->PlannedEndDate->cellAttributes() ?>>
<span id="el<?php echo $contract_delete->RowCount ?>_contract_PlannedEndDate" class="contract_PlannedEndDate">
<span<?php echo $contract_delete->PlannedEndDate->viewAttributes() ?>><?php echo $contract_delete->PlannedEndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_delete->ActualStartDate->Visible) { // ActualStartDate ?>
		<td <?php echo $contract_delete->ActualStartDate->cellAttributes() ?>>
<span id="el<?php echo $contract_delete->RowCount ?>_contract_ActualStartDate" class="contract_ActualStartDate">
<span<?php echo $contract_delete->ActualStartDate->viewAttributes() ?>><?php echo $contract_delete->ActualStartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_delete->ActualEndDate->Visible) { // ActualEndDate ?>
		<td <?php echo $contract_delete->ActualEndDate->cellAttributes() ?>>
<span id="el<?php echo $contract_delete->RowCount ?>_contract_ActualEndDate" class="contract_ActualEndDate">
<span<?php echo $contract_delete->ActualEndDate->viewAttributes() ?>><?php echo $contract_delete->ActualEndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_delete->Duration->Visible) { // Duration ?>
		<td <?php echo $contract_delete->Duration->cellAttributes() ?>>
<span id="el<?php echo $contract_delete->RowCount ?>_contract_Duration" class="contract_Duration">
<span<?php echo $contract_delete->Duration->viewAttributes() ?>><?php echo $contract_delete->Duration->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_delete->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td <?php echo $contract_delete->UnitOfMeasure->cellAttributes() ?>>
<span id="el<?php echo $contract_delete->RowCount ?>_contract_UnitOfMeasure" class="contract_UnitOfMeasure">
<span<?php echo $contract_delete->UnitOfMeasure->viewAttributes() ?>><?php echo $contract_delete->UnitOfMeasure->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_delete->AdvancePaymentAmount->Visible) { // AdvancePaymentAmount ?>
		<td <?php echo $contract_delete->AdvancePaymentAmount->cellAttributes() ?>>
<span id="el<?php echo $contract_delete->RowCount ?>_contract_AdvancePaymentAmount" class="contract_AdvancePaymentAmount">
<span<?php echo $contract_delete->AdvancePaymentAmount->viewAttributes() ?>><?php echo $contract_delete->AdvancePaymentAmount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_delete->AdvancePaymentdate->Visible) { // AdvancePaymentdate ?>
		<td <?php echo $contract_delete->AdvancePaymentdate->cellAttributes() ?>>
<span id="el<?php echo $contract_delete->RowCount ?>_contract_AdvancePaymentdate" class="contract_AdvancePaymentdate">
<span<?php echo $contract_delete->AdvancePaymentdate->viewAttributes() ?>><?php echo $contract_delete->AdvancePaymentdate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_delete->ContractStatus->Visible) { // ContractStatus ?>
		<td <?php echo $contract_delete->ContractStatus->cellAttributes() ?>>
<span id="el<?php echo $contract_delete->RowCount ?>_contract_ContractStatus" class="contract_ContractStatus">
<span<?php echo $contract_delete->ContractStatus->viewAttributes() ?>><?php echo $contract_delete->ContractStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$contract_delete->Recordset->moveNext();
}
$contract_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contract_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$contract_delete->showPageFooter();
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
$contract_delete->terminate();
?>