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
$employee_income_delete = new employee_income_delete();

// Run the page
$employee_income_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_income_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployee_incomedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	femployee_incomedelete = currentForm = new ew.Form("femployee_incomedelete", "delete");
	loadjs.done("femployee_incomedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employee_income_delete->showPageHeader(); ?>
<?php
$employee_income_delete->showMessage();
?>
<form name="femployee_incomedelete" id="femployee_incomedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employee_income">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($employee_income_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($employee_income_delete->EmployeeID->Visible) { // EmployeeID ?>
		<th class="<?php echo $employee_income_delete->EmployeeID->headerCellClass() ?>"><span id="elh_employee_income_EmployeeID" class="employee_income_EmployeeID"><?php echo $employee_income_delete->EmployeeID->caption() ?></span></th>
<?php } ?>
<?php if ($employee_income_delete->PaidPosition->Visible) { // PaidPosition ?>
		<th class="<?php echo $employee_income_delete->PaidPosition->headerCellClass() ?>"><span id="elh_employee_income_PaidPosition" class="employee_income_PaidPosition"><?php echo $employee_income_delete->PaidPosition->caption() ?></span></th>
<?php } ?>
<?php if ($employee_income_delete->PayrollDate->Visible) { // PayrollDate ?>
		<th class="<?php echo $employee_income_delete->PayrollDate->headerCellClass() ?>"><span id="elh_employee_income_PayrollDate" class="employee_income_PayrollDate"><?php echo $employee_income_delete->PayrollDate->caption() ?></span></th>
<?php } ?>
<?php if ($employee_income_delete->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<th class="<?php echo $employee_income_delete->PayrollPeriod->headerCellClass() ?>"><span id="elh_employee_income_PayrollPeriod" class="employee_income_PayrollPeriod"><?php echo $employee_income_delete->PayrollPeriod->caption() ?></span></th>
<?php } ?>
<?php if ($employee_income_delete->StartDate->Visible) { // StartDate ?>
		<th class="<?php echo $employee_income_delete->StartDate->headerCellClass() ?>"><span id="elh_employee_income_StartDate" class="employee_income_StartDate"><?php echo $employee_income_delete->StartDate->caption() ?></span></th>
<?php } ?>
<?php if ($employee_income_delete->EndDate->Visible) { // EndDate ?>
		<th class="<?php echo $employee_income_delete->EndDate->headerCellClass() ?>"><span id="elh_employee_income_EndDate" class="employee_income_EndDate"><?php echo $employee_income_delete->EndDate->caption() ?></span></th>
<?php } ?>
<?php if ($employee_income_delete->IncomeCode->Visible) { // IncomeCode ?>
		<th class="<?php echo $employee_income_delete->IncomeCode->headerCellClass() ?>"><span id="elh_employee_income_IncomeCode" class="employee_income_IncomeCode"><?php echo $employee_income_delete->IncomeCode->caption() ?></span></th>
<?php } ?>
<?php if ($employee_income_delete->Income->Visible) { // Income ?>
		<th class="<?php echo $employee_income_delete->Income->headerCellClass() ?>"><span id="elh_employee_income_Income" class="employee_income_Income"><?php echo $employee_income_delete->Income->caption() ?></span></th>
<?php } ?>
<?php if ($employee_income_delete->Remarks->Visible) { // Remarks ?>
		<th class="<?php echo $employee_income_delete->Remarks->headerCellClass() ?>"><span id="elh_employee_income_Remarks" class="employee_income_Remarks"><?php echo $employee_income_delete->Remarks->caption() ?></span></th>
<?php } ?>
<?php if ($employee_income_delete->Taxable->Visible) { // Taxable ?>
		<th class="<?php echo $employee_income_delete->Taxable->headerCellClass() ?>"><span id="elh_employee_income_Taxable" class="employee_income_Taxable"><?php echo $employee_income_delete->Taxable->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$employee_income_delete->RecordCount = 0;
$i = 0;
while (!$employee_income_delete->Recordset->EOF) {
	$employee_income_delete->RecordCount++;
	$employee_income_delete->RowCount++;

	// Set row properties
	$employee_income->resetAttributes();
	$employee_income->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$employee_income_delete->loadRowValues($employee_income_delete->Recordset);

	// Render row
	$employee_income_delete->renderRow();
?>
	<tr <?php echo $employee_income->rowAttributes() ?>>
<?php if ($employee_income_delete->EmployeeID->Visible) { // EmployeeID ?>
		<td <?php echo $employee_income_delete->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $employee_income_delete->RowCount ?>_employee_income_EmployeeID" class="employee_income_EmployeeID">
<span<?php echo $employee_income_delete->EmployeeID->viewAttributes() ?>><?php echo $employee_income_delete->EmployeeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_income_delete->PaidPosition->Visible) { // PaidPosition ?>
		<td <?php echo $employee_income_delete->PaidPosition->cellAttributes() ?>>
<span id="el<?php echo $employee_income_delete->RowCount ?>_employee_income_PaidPosition" class="employee_income_PaidPosition">
<span<?php echo $employee_income_delete->PaidPosition->viewAttributes() ?>><?php echo $employee_income_delete->PaidPosition->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_income_delete->PayrollDate->Visible) { // PayrollDate ?>
		<td <?php echo $employee_income_delete->PayrollDate->cellAttributes() ?>>
<span id="el<?php echo $employee_income_delete->RowCount ?>_employee_income_PayrollDate" class="employee_income_PayrollDate">
<span<?php echo $employee_income_delete->PayrollDate->viewAttributes() ?>><?php echo $employee_income_delete->PayrollDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_income_delete->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td <?php echo $employee_income_delete->PayrollPeriod->cellAttributes() ?>>
<span id="el<?php echo $employee_income_delete->RowCount ?>_employee_income_PayrollPeriod" class="employee_income_PayrollPeriod">
<span<?php echo $employee_income_delete->PayrollPeriod->viewAttributes() ?>><?php echo $employee_income_delete->PayrollPeriod->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_income_delete->StartDate->Visible) { // StartDate ?>
		<td <?php echo $employee_income_delete->StartDate->cellAttributes() ?>>
<span id="el<?php echo $employee_income_delete->RowCount ?>_employee_income_StartDate" class="employee_income_StartDate">
<span<?php echo $employee_income_delete->StartDate->viewAttributes() ?>><?php echo $employee_income_delete->StartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_income_delete->EndDate->Visible) { // EndDate ?>
		<td <?php echo $employee_income_delete->EndDate->cellAttributes() ?>>
<span id="el<?php echo $employee_income_delete->RowCount ?>_employee_income_EndDate" class="employee_income_EndDate">
<span<?php echo $employee_income_delete->EndDate->viewAttributes() ?>><?php echo $employee_income_delete->EndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_income_delete->IncomeCode->Visible) { // IncomeCode ?>
		<td <?php echo $employee_income_delete->IncomeCode->cellAttributes() ?>>
<span id="el<?php echo $employee_income_delete->RowCount ?>_employee_income_IncomeCode" class="employee_income_IncomeCode">
<span<?php echo $employee_income_delete->IncomeCode->viewAttributes() ?>><?php echo $employee_income_delete->IncomeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_income_delete->Income->Visible) { // Income ?>
		<td <?php echo $employee_income_delete->Income->cellAttributes() ?>>
<span id="el<?php echo $employee_income_delete->RowCount ?>_employee_income_Income" class="employee_income_Income">
<span<?php echo $employee_income_delete->Income->viewAttributes() ?>><?php echo $employee_income_delete->Income->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_income_delete->Remarks->Visible) { // Remarks ?>
		<td <?php echo $employee_income_delete->Remarks->cellAttributes() ?>>
<span id="el<?php echo $employee_income_delete->RowCount ?>_employee_income_Remarks" class="employee_income_Remarks">
<span<?php echo $employee_income_delete->Remarks->viewAttributes() ?>><?php echo $employee_income_delete->Remarks->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_income_delete->Taxable->Visible) { // Taxable ?>
		<td <?php echo $employee_income_delete->Taxable->cellAttributes() ?>>
<span id="el<?php echo $employee_income_delete->RowCount ?>_employee_income_Taxable" class="employee_income_Taxable">
<span<?php echo $employee_income_delete->Taxable->viewAttributes() ?>><?php echo $employee_income_delete->Taxable->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$employee_income_delete->Recordset->moveNext();
}
$employee_income_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employee_income_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$employee_income_delete->showPageFooter();
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
$employee_income_delete->terminate();
?>