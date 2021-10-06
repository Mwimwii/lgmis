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
$budget_view = new budget_view();

// Run the page
$budget_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$budget_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$budget_view->isExport()) { ?>
<script>
var fbudgetview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fbudgetview = currentForm = new ew.Form("fbudgetview", "view");
	loadjs.done("fbudgetview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$budget_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $budget_view->ExportOptions->render("body") ?>
<?php $budget_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $budget_view->showPageHeader(); ?>
<?php
$budget_view->showMessage();
?>
<?php if (!$budget_view->IsModal) { ?>
<?php if (!$budget_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $budget_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fbudgetview" id="fbudgetview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="budget">
<input type="hidden" name="modal" value="<?php echo (int)$budget_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($budget_view->OutcomeCode->Visible) { // OutcomeCode ?>
	<tr id="r_OutcomeCode">
		<td class="<?php echo $budget_view->TableLeftColumnClass ?>"><span id="elh_budget_OutcomeCode"><?php echo $budget_view->OutcomeCode->caption() ?></span></td>
		<td data-name="OutcomeCode" <?php echo $budget_view->OutcomeCode->cellAttributes() ?>>
<span id="el_budget_OutcomeCode">
<span<?php echo $budget_view->OutcomeCode->viewAttributes() ?>><?php echo $budget_view->OutcomeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_view->OutputCode->Visible) { // OutputCode ?>
	<tr id="r_OutputCode">
		<td class="<?php echo $budget_view->TableLeftColumnClass ?>"><span id="elh_budget_OutputCode"><?php echo $budget_view->OutputCode->caption() ?></span></td>
		<td data-name="OutputCode" <?php echo $budget_view->OutputCode->cellAttributes() ?>>
<span id="el_budget_OutputCode">
<span<?php echo $budget_view->OutputCode->viewAttributes() ?>><?php echo $budget_view->OutputCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_view->ActionCode->Visible) { // ActionCode ?>
	<tr id="r_ActionCode">
		<td class="<?php echo $budget_view->TableLeftColumnClass ?>"><span id="elh_budget_ActionCode"><?php echo $budget_view->ActionCode->caption() ?></span></td>
		<td data-name="ActionCode" <?php echo $budget_view->ActionCode->cellAttributes() ?>>
<span id="el_budget_ActionCode">
<span<?php echo $budget_view->ActionCode->viewAttributes() ?>><?php echo $budget_view->ActionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_view->DetailedActionCode->Visible) { // DetailedActionCode ?>
	<tr id="r_DetailedActionCode">
		<td class="<?php echo $budget_view->TableLeftColumnClass ?>"><span id="elh_budget_DetailedActionCode"><?php echo $budget_view->DetailedActionCode->caption() ?></span></td>
		<td data-name="DetailedActionCode" <?php echo $budget_view->DetailedActionCode->cellAttributes() ?>>
<span id="el_budget_DetailedActionCode">
<span<?php echo $budget_view->DetailedActionCode->viewAttributes() ?>><?php echo $budget_view->DetailedActionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_view->FinancialYear->Visible) { // FinancialYear ?>
	<tr id="r_FinancialYear">
		<td class="<?php echo $budget_view->TableLeftColumnClass ?>"><span id="elh_budget_FinancialYear"><?php echo $budget_view->FinancialYear->caption() ?></span></td>
		<td data-name="FinancialYear" <?php echo $budget_view->FinancialYear->cellAttributes() ?>>
<span id="el_budget_FinancialYear">
<span<?php echo $budget_view->FinancialYear->viewAttributes() ?>><?php echo $budget_view->FinancialYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_view->AccountCode->Visible) { // AccountCode ?>
	<tr id="r_AccountCode">
		<td class="<?php echo $budget_view->TableLeftColumnClass ?>"><span id="elh_budget_AccountCode"><?php echo $budget_view->AccountCode->caption() ?></span></td>
		<td data-name="AccountCode" <?php echo $budget_view->AccountCode->cellAttributes() ?>>
<span id="el_budget_AccountCode">
<span<?php echo $budget_view->AccountCode->viewAttributes() ?>><?php echo $budget_view->AccountCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_view->MeansOfImplementation->Visible) { // MeansOfImplementation ?>
	<tr id="r_MeansOfImplementation">
		<td class="<?php echo $budget_view->TableLeftColumnClass ?>"><span id="elh_budget_MeansOfImplementation"><?php echo $budget_view->MeansOfImplementation->caption() ?></span></td>
		<td data-name="MeansOfImplementation" <?php echo $budget_view->MeansOfImplementation->cellAttributes() ?>>
<span id="el_budget_MeansOfImplementation">
<span<?php echo $budget_view->MeansOfImplementation->viewAttributes() ?>><?php echo $budget_view->MeansOfImplementation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_view->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<tr id="r_UnitOfMeasure">
		<td class="<?php echo $budget_view->TableLeftColumnClass ?>"><span id="elh_budget_UnitOfMeasure"><?php echo $budget_view->UnitOfMeasure->caption() ?></span></td>
		<td data-name="UnitOfMeasure" <?php echo $budget_view->UnitOfMeasure->cellAttributes() ?>>
<span id="el_budget_UnitOfMeasure">
<span<?php echo $budget_view->UnitOfMeasure->viewAttributes() ?>><?php echo $budget_view->UnitOfMeasure->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_view->Quantity->Visible) { // Quantity ?>
	<tr id="r_Quantity">
		<td class="<?php echo $budget_view->TableLeftColumnClass ?>"><span id="elh_budget_Quantity"><?php echo $budget_view->Quantity->caption() ?></span></td>
		<td data-name="Quantity" <?php echo $budget_view->Quantity->cellAttributes() ?>>
<span id="el_budget_Quantity">
<span<?php echo $budget_view->Quantity->viewAttributes() ?>><?php echo $budget_view->Quantity->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_view->Frequency->Visible) { // Frequency ?>
	<tr id="r_Frequency">
		<td class="<?php echo $budget_view->TableLeftColumnClass ?>"><span id="elh_budget_Frequency"><?php echo $budget_view->Frequency->caption() ?></span></td>
		<td data-name="Frequency" <?php echo $budget_view->Frequency->cellAttributes() ?>>
<span id="el_budget_Frequency">
<span<?php echo $budget_view->Frequency->viewAttributes() ?>><?php echo $budget_view->Frequency->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_view->UnitCost->Visible) { // UnitCost ?>
	<tr id="r_UnitCost">
		<td class="<?php echo $budget_view->TableLeftColumnClass ?>"><span id="elh_budget_UnitCost"><?php echo $budget_view->UnitCost->caption() ?></span></td>
		<td data-name="UnitCost" <?php echo $budget_view->UnitCost->cellAttributes() ?>>
<span id="el_budget_UnitCost">
<span<?php echo $budget_view->UnitCost->viewAttributes() ?>><?php echo $budget_view->UnitCost->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_view->BudgetEstimate->Visible) { // BudgetEstimate ?>
	<tr id="r_BudgetEstimate">
		<td class="<?php echo $budget_view->TableLeftColumnClass ?>"><span id="elh_budget_BudgetEstimate"><?php echo $budget_view->BudgetEstimate->caption() ?></span></td>
		<td data-name="BudgetEstimate" <?php echo $budget_view->BudgetEstimate->cellAttributes() ?>>
<span id="el_budget_BudgetEstimate">
<span<?php echo $budget_view->BudgetEstimate->viewAttributes() ?>><?php echo $budget_view->BudgetEstimate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_view->ActualAmount->Visible) { // ActualAmount ?>
	<tr id="r_ActualAmount">
		<td class="<?php echo $budget_view->TableLeftColumnClass ?>"><span id="elh_budget_ActualAmount"><?php echo $budget_view->ActualAmount->caption() ?></span></td>
		<td data-name="ActualAmount" <?php echo $budget_view->ActualAmount->cellAttributes() ?>>
<span id="el_budget_ActualAmount">
<span<?php echo $budget_view->ActualAmount->viewAttributes() ?>><?php echo $budget_view->ActualAmount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_view->Status->Visible) { // Status ?>
	<tr id="r_Status">
		<td class="<?php echo $budget_view->TableLeftColumnClass ?>"><span id="elh_budget_Status"><?php echo $budget_view->Status->caption() ?></span></td>
		<td data-name="Status" <?php echo $budget_view->Status->cellAttributes() ?>>
<span id="el_budget_Status">
<span<?php echo $budget_view->Status->viewAttributes() ?>><?php echo $budget_view->Status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $budget_view->TableLeftColumnClass ?>"><span id="elh_budget_LACode"><?php echo $budget_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $budget_view->LACode->cellAttributes() ?>>
<span id="el_budget_LACode">
<span<?php echo $budget_view->LACode->viewAttributes() ?>><?php echo $budget_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_view->DepartmentCode->Visible) { // DepartmentCode ?>
	<tr id="r_DepartmentCode">
		<td class="<?php echo $budget_view->TableLeftColumnClass ?>"><span id="elh_budget_DepartmentCode"><?php echo $budget_view->DepartmentCode->caption() ?></span></td>
		<td data-name="DepartmentCode" <?php echo $budget_view->DepartmentCode->cellAttributes() ?>>
<span id="el_budget_DepartmentCode">
<span<?php echo $budget_view->DepartmentCode->viewAttributes() ?>><?php echo $budget_view->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_view->SectionCode->Visible) { // SectionCode ?>
	<tr id="r_SectionCode">
		<td class="<?php echo $budget_view->TableLeftColumnClass ?>"><span id="elh_budget_SectionCode"><?php echo $budget_view->SectionCode->caption() ?></span></td>
		<td data-name="SectionCode" <?php echo $budget_view->SectionCode->cellAttributes() ?>>
<span id="el_budget_SectionCode">
<span<?php echo $budget_view->SectionCode->viewAttributes() ?>><?php echo $budget_view->SectionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_view->BudgetLine->Visible) { // BudgetLine ?>
	<tr id="r_BudgetLine">
		<td class="<?php echo $budget_view->TableLeftColumnClass ?>"><span id="elh_budget_BudgetLine"><?php echo $budget_view->BudgetLine->caption() ?></span></td>
		<td data-name="BudgetLine" <?php echo $budget_view->BudgetLine->cellAttributes() ?>>
<span id="el_budget_BudgetLine">
<span<?php echo $budget_view->BudgetLine->viewAttributes() ?>><?php echo $budget_view->BudgetLine->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_view->ProgramCode->Visible) { // ProgramCode ?>
	<tr id="r_ProgramCode">
		<td class="<?php echo $budget_view->TableLeftColumnClass ?>"><span id="elh_budget_ProgramCode"><?php echo $budget_view->ProgramCode->caption() ?></span></td>
		<td data-name="ProgramCode" <?php echo $budget_view->ProgramCode->cellAttributes() ?>>
<span id="el_budget_ProgramCode">
<span<?php echo $budget_view->ProgramCode->viewAttributes() ?>><?php echo $budget_view->ProgramCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_view->SubProgramCode->Visible) { // SubProgramCode ?>
	<tr id="r_SubProgramCode">
		<td class="<?php echo $budget_view->TableLeftColumnClass ?>"><span id="elh_budget_SubProgramCode"><?php echo $budget_view->SubProgramCode->caption() ?></span></td>
		<td data-name="SubProgramCode" <?php echo $budget_view->SubProgramCode->cellAttributes() ?>>
<span id="el_budget_SubProgramCode">
<span<?php echo $budget_view->SubProgramCode->viewAttributes() ?>><?php echo $budget_view->SubProgramCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_view->ApprovedBudget->Visible) { // ApprovedBudget ?>
	<tr id="r_ApprovedBudget">
		<td class="<?php echo $budget_view->TableLeftColumnClass ?>"><span id="elh_budget_ApprovedBudget"><?php echo $budget_view->ApprovedBudget->caption() ?></span></td>
		<td data-name="ApprovedBudget" <?php echo $budget_view->ApprovedBudget->cellAttributes() ?>>
<span id="el_budget_ApprovedBudget">
<span<?php echo $budget_view->ApprovedBudget->viewAttributes() ?>><?php echo $budget_view->ApprovedBudget->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$budget_view->IsModal) { ?>
<?php if (!$budget_view->isExport()) { ?>
<?php echo $budget_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$budget_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$budget_view->isExport()) { ?>
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
$budget_view->terminate();
?>