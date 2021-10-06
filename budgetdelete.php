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
$budget_delete = new budget_delete();

// Run the page
$budget_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$budget_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbudgetdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fbudgetdelete = currentForm = new ew.Form("fbudgetdelete", "delete");
	loadjs.done("fbudgetdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $budget_delete->showPageHeader(); ?>
<?php
$budget_delete->showMessage();
?>
<form name="fbudgetdelete" id="fbudgetdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="budget">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($budget_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($budget_delete->OutcomeCode->Visible) { // OutcomeCode ?>
		<th class="<?php echo $budget_delete->OutcomeCode->headerCellClass() ?>"><span id="elh_budget_OutcomeCode" class="budget_OutcomeCode"><?php echo $budget_delete->OutcomeCode->caption() ?></span></th>
<?php } ?>
<?php if ($budget_delete->OutputCode->Visible) { // OutputCode ?>
		<th class="<?php echo $budget_delete->OutputCode->headerCellClass() ?>"><span id="elh_budget_OutputCode" class="budget_OutputCode"><?php echo $budget_delete->OutputCode->caption() ?></span></th>
<?php } ?>
<?php if ($budget_delete->ActionCode->Visible) { // ActionCode ?>
		<th class="<?php echo $budget_delete->ActionCode->headerCellClass() ?>"><span id="elh_budget_ActionCode" class="budget_ActionCode"><?php echo $budget_delete->ActionCode->caption() ?></span></th>
<?php } ?>
<?php if ($budget_delete->DetailedActionCode->Visible) { // DetailedActionCode ?>
		<th class="<?php echo $budget_delete->DetailedActionCode->headerCellClass() ?>"><span id="elh_budget_DetailedActionCode" class="budget_DetailedActionCode"><?php echo $budget_delete->DetailedActionCode->caption() ?></span></th>
<?php } ?>
<?php if ($budget_delete->FinancialYear->Visible) { // FinancialYear ?>
		<th class="<?php echo $budget_delete->FinancialYear->headerCellClass() ?>"><span id="elh_budget_FinancialYear" class="budget_FinancialYear"><?php echo $budget_delete->FinancialYear->caption() ?></span></th>
<?php } ?>
<?php if ($budget_delete->AccountCode->Visible) { // AccountCode ?>
		<th class="<?php echo $budget_delete->AccountCode->headerCellClass() ?>"><span id="elh_budget_AccountCode" class="budget_AccountCode"><?php echo $budget_delete->AccountCode->caption() ?></span></th>
<?php } ?>
<?php if ($budget_delete->MeansOfImplementation->Visible) { // MeansOfImplementation ?>
		<th class="<?php echo $budget_delete->MeansOfImplementation->headerCellClass() ?>"><span id="elh_budget_MeansOfImplementation" class="budget_MeansOfImplementation"><?php echo $budget_delete->MeansOfImplementation->caption() ?></span></th>
<?php } ?>
<?php if ($budget_delete->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<th class="<?php echo $budget_delete->UnitOfMeasure->headerCellClass() ?>"><span id="elh_budget_UnitOfMeasure" class="budget_UnitOfMeasure"><?php echo $budget_delete->UnitOfMeasure->caption() ?></span></th>
<?php } ?>
<?php if ($budget_delete->Quantity->Visible) { // Quantity ?>
		<th class="<?php echo $budget_delete->Quantity->headerCellClass() ?>"><span id="elh_budget_Quantity" class="budget_Quantity"><?php echo $budget_delete->Quantity->caption() ?></span></th>
<?php } ?>
<?php if ($budget_delete->Frequency->Visible) { // Frequency ?>
		<th class="<?php echo $budget_delete->Frequency->headerCellClass() ?>"><span id="elh_budget_Frequency" class="budget_Frequency"><?php echo $budget_delete->Frequency->caption() ?></span></th>
<?php } ?>
<?php if ($budget_delete->UnitCost->Visible) { // UnitCost ?>
		<th class="<?php echo $budget_delete->UnitCost->headerCellClass() ?>"><span id="elh_budget_UnitCost" class="budget_UnitCost"><?php echo $budget_delete->UnitCost->caption() ?></span></th>
<?php } ?>
<?php if ($budget_delete->BudgetEstimate->Visible) { // BudgetEstimate ?>
		<th class="<?php echo $budget_delete->BudgetEstimate->headerCellClass() ?>"><span id="elh_budget_BudgetEstimate" class="budget_BudgetEstimate"><?php echo $budget_delete->BudgetEstimate->caption() ?></span></th>
<?php } ?>
<?php if ($budget_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $budget_delete->LACode->headerCellClass() ?>"><span id="elh_budget_LACode" class="budget_LACode"><?php echo $budget_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($budget_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<th class="<?php echo $budget_delete->DepartmentCode->headerCellClass() ?>"><span id="elh_budget_DepartmentCode" class="budget_DepartmentCode"><?php echo $budget_delete->DepartmentCode->caption() ?></span></th>
<?php } ?>
<?php if ($budget_delete->SectionCode->Visible) { // SectionCode ?>
		<th class="<?php echo $budget_delete->SectionCode->headerCellClass() ?>"><span id="elh_budget_SectionCode" class="budget_SectionCode"><?php echo $budget_delete->SectionCode->caption() ?></span></th>
<?php } ?>
<?php if ($budget_delete->BudgetLine->Visible) { // BudgetLine ?>
		<th class="<?php echo $budget_delete->BudgetLine->headerCellClass() ?>"><span id="elh_budget_BudgetLine" class="budget_BudgetLine"><?php echo $budget_delete->BudgetLine->caption() ?></span></th>
<?php } ?>
<?php if ($budget_delete->ProgramCode->Visible) { // ProgramCode ?>
		<th class="<?php echo $budget_delete->ProgramCode->headerCellClass() ?>"><span id="elh_budget_ProgramCode" class="budget_ProgramCode"><?php echo $budget_delete->ProgramCode->caption() ?></span></th>
<?php } ?>
<?php if ($budget_delete->SubProgramCode->Visible) { // SubProgramCode ?>
		<th class="<?php echo $budget_delete->SubProgramCode->headerCellClass() ?>"><span id="elh_budget_SubProgramCode" class="budget_SubProgramCode"><?php echo $budget_delete->SubProgramCode->caption() ?></span></th>
<?php } ?>
<?php if ($budget_delete->ApprovedBudget->Visible) { // ApprovedBudget ?>
		<th class="<?php echo $budget_delete->ApprovedBudget->headerCellClass() ?>"><span id="elh_budget_ApprovedBudget" class="budget_ApprovedBudget"><?php echo $budget_delete->ApprovedBudget->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$budget_delete->RecordCount = 0;
$i = 0;
while (!$budget_delete->Recordset->EOF) {
	$budget_delete->RecordCount++;
	$budget_delete->RowCount++;

	// Set row properties
	$budget->resetAttributes();
	$budget->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$budget_delete->loadRowValues($budget_delete->Recordset);

	// Render row
	$budget_delete->renderRow();
?>
	<tr <?php echo $budget->rowAttributes() ?>>
<?php if ($budget_delete->OutcomeCode->Visible) { // OutcomeCode ?>
		<td <?php echo $budget_delete->OutcomeCode->cellAttributes() ?>>
<span id="el<?php echo $budget_delete->RowCount ?>_budget_OutcomeCode" class="budget_OutcomeCode">
<span<?php echo $budget_delete->OutcomeCode->viewAttributes() ?>><?php echo $budget_delete->OutcomeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_delete->OutputCode->Visible) { // OutputCode ?>
		<td <?php echo $budget_delete->OutputCode->cellAttributes() ?>>
<span id="el<?php echo $budget_delete->RowCount ?>_budget_OutputCode" class="budget_OutputCode">
<span<?php echo $budget_delete->OutputCode->viewAttributes() ?>><?php echo $budget_delete->OutputCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_delete->ActionCode->Visible) { // ActionCode ?>
		<td <?php echo $budget_delete->ActionCode->cellAttributes() ?>>
<span id="el<?php echo $budget_delete->RowCount ?>_budget_ActionCode" class="budget_ActionCode">
<span<?php echo $budget_delete->ActionCode->viewAttributes() ?>><?php echo $budget_delete->ActionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_delete->DetailedActionCode->Visible) { // DetailedActionCode ?>
		<td <?php echo $budget_delete->DetailedActionCode->cellAttributes() ?>>
<span id="el<?php echo $budget_delete->RowCount ?>_budget_DetailedActionCode" class="budget_DetailedActionCode">
<span<?php echo $budget_delete->DetailedActionCode->viewAttributes() ?>><?php echo $budget_delete->DetailedActionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_delete->FinancialYear->Visible) { // FinancialYear ?>
		<td <?php echo $budget_delete->FinancialYear->cellAttributes() ?>>
<span id="el<?php echo $budget_delete->RowCount ?>_budget_FinancialYear" class="budget_FinancialYear">
<span<?php echo $budget_delete->FinancialYear->viewAttributes() ?>><?php echo $budget_delete->FinancialYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_delete->AccountCode->Visible) { // AccountCode ?>
		<td <?php echo $budget_delete->AccountCode->cellAttributes() ?>>
<span id="el<?php echo $budget_delete->RowCount ?>_budget_AccountCode" class="budget_AccountCode">
<span<?php echo $budget_delete->AccountCode->viewAttributes() ?>><?php echo $budget_delete->AccountCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_delete->MeansOfImplementation->Visible) { // MeansOfImplementation ?>
		<td <?php echo $budget_delete->MeansOfImplementation->cellAttributes() ?>>
<span id="el<?php echo $budget_delete->RowCount ?>_budget_MeansOfImplementation" class="budget_MeansOfImplementation">
<span<?php echo $budget_delete->MeansOfImplementation->viewAttributes() ?>><?php echo $budget_delete->MeansOfImplementation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_delete->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td <?php echo $budget_delete->UnitOfMeasure->cellAttributes() ?>>
<span id="el<?php echo $budget_delete->RowCount ?>_budget_UnitOfMeasure" class="budget_UnitOfMeasure">
<span<?php echo $budget_delete->UnitOfMeasure->viewAttributes() ?>><?php echo $budget_delete->UnitOfMeasure->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_delete->Quantity->Visible) { // Quantity ?>
		<td <?php echo $budget_delete->Quantity->cellAttributes() ?>>
<span id="el<?php echo $budget_delete->RowCount ?>_budget_Quantity" class="budget_Quantity">
<span<?php echo $budget_delete->Quantity->viewAttributes() ?>><?php echo $budget_delete->Quantity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_delete->Frequency->Visible) { // Frequency ?>
		<td <?php echo $budget_delete->Frequency->cellAttributes() ?>>
<span id="el<?php echo $budget_delete->RowCount ?>_budget_Frequency" class="budget_Frequency">
<span<?php echo $budget_delete->Frequency->viewAttributes() ?>><?php echo $budget_delete->Frequency->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_delete->UnitCost->Visible) { // UnitCost ?>
		<td <?php echo $budget_delete->UnitCost->cellAttributes() ?>>
<span id="el<?php echo $budget_delete->RowCount ?>_budget_UnitCost" class="budget_UnitCost">
<span<?php echo $budget_delete->UnitCost->viewAttributes() ?>><?php echo $budget_delete->UnitCost->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_delete->BudgetEstimate->Visible) { // BudgetEstimate ?>
		<td <?php echo $budget_delete->BudgetEstimate->cellAttributes() ?>>
<span id="el<?php echo $budget_delete->RowCount ?>_budget_BudgetEstimate" class="budget_BudgetEstimate">
<span<?php echo $budget_delete->BudgetEstimate->viewAttributes() ?>><?php echo $budget_delete->BudgetEstimate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $budget_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $budget_delete->RowCount ?>_budget_LACode" class="budget_LACode">
<span<?php echo $budget_delete->LACode->viewAttributes() ?>><?php echo $budget_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<td <?php echo $budget_delete->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $budget_delete->RowCount ?>_budget_DepartmentCode" class="budget_DepartmentCode">
<span<?php echo $budget_delete->DepartmentCode->viewAttributes() ?>><?php echo $budget_delete->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_delete->SectionCode->Visible) { // SectionCode ?>
		<td <?php echo $budget_delete->SectionCode->cellAttributes() ?>>
<span id="el<?php echo $budget_delete->RowCount ?>_budget_SectionCode" class="budget_SectionCode">
<span<?php echo $budget_delete->SectionCode->viewAttributes() ?>><?php echo $budget_delete->SectionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_delete->BudgetLine->Visible) { // BudgetLine ?>
		<td <?php echo $budget_delete->BudgetLine->cellAttributes() ?>>
<span id="el<?php echo $budget_delete->RowCount ?>_budget_BudgetLine" class="budget_BudgetLine">
<span<?php echo $budget_delete->BudgetLine->viewAttributes() ?>><?php echo $budget_delete->BudgetLine->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_delete->ProgramCode->Visible) { // ProgramCode ?>
		<td <?php echo $budget_delete->ProgramCode->cellAttributes() ?>>
<span id="el<?php echo $budget_delete->RowCount ?>_budget_ProgramCode" class="budget_ProgramCode">
<span<?php echo $budget_delete->ProgramCode->viewAttributes() ?>><?php echo $budget_delete->ProgramCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_delete->SubProgramCode->Visible) { // SubProgramCode ?>
		<td <?php echo $budget_delete->SubProgramCode->cellAttributes() ?>>
<span id="el<?php echo $budget_delete->RowCount ?>_budget_SubProgramCode" class="budget_SubProgramCode">
<span<?php echo $budget_delete->SubProgramCode->viewAttributes() ?>><?php echo $budget_delete->SubProgramCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_delete->ApprovedBudget->Visible) { // ApprovedBudget ?>
		<td <?php echo $budget_delete->ApprovedBudget->cellAttributes() ?>>
<span id="el<?php echo $budget_delete->RowCount ?>_budget_ApprovedBudget" class="budget_ApprovedBudget">
<span<?php echo $budget_delete->ApprovedBudget->viewAttributes() ?>><?php echo $budget_delete->ApprovedBudget->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$budget_delete->Recordset->moveNext();
}
$budget_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $budget_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$budget_delete->showPageFooter();
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
$budget_delete->terminate();
?>