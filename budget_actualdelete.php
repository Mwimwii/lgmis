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
$budget_actual_delete = new budget_actual_delete();

// Run the page
$budget_actual_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$budget_actual_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbudget_actualdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fbudget_actualdelete = currentForm = new ew.Form("fbudget_actualdelete", "delete");
	loadjs.done("fbudget_actualdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $budget_actual_delete->showPageHeader(); ?>
<?php
$budget_actual_delete->showMessage();
?>
<form name="fbudget_actualdelete" id="fbudget_actualdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="budget_actual">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($budget_actual_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($budget_actual_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $budget_actual_delete->LACode->headerCellClass() ?>"><span id="elh_budget_actual_LACode" class="budget_actual_LACode"><?php echo $budget_actual_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($budget_actual_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<th class="<?php echo $budget_actual_delete->DepartmentCode->headerCellClass() ?>"><span id="elh_budget_actual_DepartmentCode" class="budget_actual_DepartmentCode"><?php echo $budget_actual_delete->DepartmentCode->caption() ?></span></th>
<?php } ?>
<?php if ($budget_actual_delete->SectionCode->Visible) { // SectionCode ?>
		<th class="<?php echo $budget_actual_delete->SectionCode->headerCellClass() ?>"><span id="elh_budget_actual_SectionCode" class="budget_actual_SectionCode"><?php echo $budget_actual_delete->SectionCode->caption() ?></span></th>
<?php } ?>
<?php if ($budget_actual_delete->AccountCode->Visible) { // AccountCode ?>
		<th class="<?php echo $budget_actual_delete->AccountCode->headerCellClass() ?>"><span id="elh_budget_actual_AccountCode" class="budget_actual_AccountCode"><?php echo $budget_actual_delete->AccountCode->caption() ?></span></th>
<?php } ?>
<?php if ($budget_actual_delete->PostingDate->Visible) { // PostingDate ?>
		<th class="<?php echo $budget_actual_delete->PostingDate->headerCellClass() ?>"><span id="elh_budget_actual_PostingDate" class="budget_actual_PostingDate"><?php echo $budget_actual_delete->PostingDate->caption() ?></span></th>
<?php } ?>
<?php if ($budget_actual_delete->AccountMonth->Visible) { // AccountMonth ?>
		<th class="<?php echo $budget_actual_delete->AccountMonth->headerCellClass() ?>"><span id="elh_budget_actual_AccountMonth" class="budget_actual_AccountMonth"><?php echo $budget_actual_delete->AccountMonth->caption() ?></span></th>
<?php } ?>
<?php if ($budget_actual_delete->AccountYear->Visible) { // AccountYear ?>
		<th class="<?php echo $budget_actual_delete->AccountYear->headerCellClass() ?>"><span id="elh_budget_actual_AccountYear" class="budget_actual_AccountYear"><?php echo $budget_actual_delete->AccountYear->caption() ?></span></th>
<?php } ?>
<?php if ($budget_actual_delete->BudgetEstimate->Visible) { // BudgetEstimate ?>
		<th class="<?php echo $budget_actual_delete->BudgetEstimate->headerCellClass() ?>"><span id="elh_budget_actual_BudgetEstimate" class="budget_actual_BudgetEstimate"><?php echo $budget_actual_delete->BudgetEstimate->caption() ?></span></th>
<?php } ?>
<?php if ($budget_actual_delete->ActualAmount->Visible) { // ActualAmount ?>
		<th class="<?php echo $budget_actual_delete->ActualAmount->headerCellClass() ?>"><span id="elh_budget_actual_ActualAmount" class="budget_actual_ActualAmount"><?php echo $budget_actual_delete->ActualAmount->caption() ?></span></th>
<?php } ?>
<?php if ($budget_actual_delete->ForecastAmount->Visible) { // ForecastAmount ?>
		<th class="<?php echo $budget_actual_delete->ForecastAmount->headerCellClass() ?>"><span id="elh_budget_actual_ForecastAmount" class="budget_actual_ForecastAmount"><?php echo $budget_actual_delete->ForecastAmount->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$budget_actual_delete->RecordCount = 0;
$i = 0;
while (!$budget_actual_delete->Recordset->EOF) {
	$budget_actual_delete->RecordCount++;
	$budget_actual_delete->RowCount++;

	// Set row properties
	$budget_actual->resetAttributes();
	$budget_actual->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$budget_actual_delete->loadRowValues($budget_actual_delete->Recordset);

	// Render row
	$budget_actual_delete->renderRow();
?>
	<tr <?php echo $budget_actual->rowAttributes() ?>>
<?php if ($budget_actual_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $budget_actual_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $budget_actual_delete->RowCount ?>_budget_actual_LACode" class="budget_actual_LACode">
<span<?php echo $budget_actual_delete->LACode->viewAttributes() ?>><?php echo $budget_actual_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_actual_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<td <?php echo $budget_actual_delete->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $budget_actual_delete->RowCount ?>_budget_actual_DepartmentCode" class="budget_actual_DepartmentCode">
<span<?php echo $budget_actual_delete->DepartmentCode->viewAttributes() ?>><?php echo $budget_actual_delete->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_actual_delete->SectionCode->Visible) { // SectionCode ?>
		<td <?php echo $budget_actual_delete->SectionCode->cellAttributes() ?>>
<span id="el<?php echo $budget_actual_delete->RowCount ?>_budget_actual_SectionCode" class="budget_actual_SectionCode">
<span<?php echo $budget_actual_delete->SectionCode->viewAttributes() ?>><?php echo $budget_actual_delete->SectionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_actual_delete->AccountCode->Visible) { // AccountCode ?>
		<td <?php echo $budget_actual_delete->AccountCode->cellAttributes() ?>>
<span id="el<?php echo $budget_actual_delete->RowCount ?>_budget_actual_AccountCode" class="budget_actual_AccountCode">
<span<?php echo $budget_actual_delete->AccountCode->viewAttributes() ?>><?php echo $budget_actual_delete->AccountCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_actual_delete->PostingDate->Visible) { // PostingDate ?>
		<td <?php echo $budget_actual_delete->PostingDate->cellAttributes() ?>>
<span id="el<?php echo $budget_actual_delete->RowCount ?>_budget_actual_PostingDate" class="budget_actual_PostingDate">
<span<?php echo $budget_actual_delete->PostingDate->viewAttributes() ?>><?php echo $budget_actual_delete->PostingDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_actual_delete->AccountMonth->Visible) { // AccountMonth ?>
		<td <?php echo $budget_actual_delete->AccountMonth->cellAttributes() ?>>
<span id="el<?php echo $budget_actual_delete->RowCount ?>_budget_actual_AccountMonth" class="budget_actual_AccountMonth">
<span<?php echo $budget_actual_delete->AccountMonth->viewAttributes() ?>><?php echo $budget_actual_delete->AccountMonth->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_actual_delete->AccountYear->Visible) { // AccountYear ?>
		<td <?php echo $budget_actual_delete->AccountYear->cellAttributes() ?>>
<span id="el<?php echo $budget_actual_delete->RowCount ?>_budget_actual_AccountYear" class="budget_actual_AccountYear">
<span<?php echo $budget_actual_delete->AccountYear->viewAttributes() ?>><?php echo $budget_actual_delete->AccountYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_actual_delete->BudgetEstimate->Visible) { // BudgetEstimate ?>
		<td <?php echo $budget_actual_delete->BudgetEstimate->cellAttributes() ?>>
<span id="el<?php echo $budget_actual_delete->RowCount ?>_budget_actual_BudgetEstimate" class="budget_actual_BudgetEstimate">
<span<?php echo $budget_actual_delete->BudgetEstimate->viewAttributes() ?>><?php echo $budget_actual_delete->BudgetEstimate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_actual_delete->ActualAmount->Visible) { // ActualAmount ?>
		<td <?php echo $budget_actual_delete->ActualAmount->cellAttributes() ?>>
<span id="el<?php echo $budget_actual_delete->RowCount ?>_budget_actual_ActualAmount" class="budget_actual_ActualAmount">
<span<?php echo $budget_actual_delete->ActualAmount->viewAttributes() ?>><?php echo $budget_actual_delete->ActualAmount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($budget_actual_delete->ForecastAmount->Visible) { // ForecastAmount ?>
		<td <?php echo $budget_actual_delete->ForecastAmount->cellAttributes() ?>>
<span id="el<?php echo $budget_actual_delete->RowCount ?>_budget_actual_ForecastAmount" class="budget_actual_ForecastAmount">
<span<?php echo $budget_actual_delete->ForecastAmount->viewAttributes() ?>><?php echo $budget_actual_delete->ForecastAmount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$budget_actual_delete->Recordset->moveNext();
}
$budget_actual_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $budget_actual_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$budget_actual_delete->showPageFooter();
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
$budget_actual_delete->terminate();
?>