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
$employee_obligation_delete = new employee_obligation_delete();

// Run the page
$employee_obligation_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_obligation_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployee_obligationdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	femployee_obligationdelete = currentForm = new ew.Form("femployee_obligationdelete", "delete");
	loadjs.done("femployee_obligationdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employee_obligation_delete->showPageHeader(); ?>
<?php
$employee_obligation_delete->showMessage();
?>
<form name="femployee_obligationdelete" id="femployee_obligationdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employee_obligation">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($employee_obligation_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($employee_obligation_delete->EmployeeID->Visible) { // EmployeeID ?>
		<th class="<?php echo $employee_obligation_delete->EmployeeID->headerCellClass() ?>"><span id="elh_employee_obligation_EmployeeID" class="employee_obligation_EmployeeID"><?php echo $employee_obligation_delete->EmployeeID->caption() ?></span></th>
<?php } ?>
<?php if ($employee_obligation_delete->PaidPosition->Visible) { // PaidPosition ?>
		<th class="<?php echo $employee_obligation_delete->PaidPosition->headerCellClass() ?>"><span id="elh_employee_obligation_PaidPosition" class="employee_obligation_PaidPosition"><?php echo $employee_obligation_delete->PaidPosition->caption() ?></span></th>
<?php } ?>
<?php if ($employee_obligation_delete->PayrollDate->Visible) { // PayrollDate ?>
		<th class="<?php echo $employee_obligation_delete->PayrollDate->headerCellClass() ?>"><span id="elh_employee_obligation_PayrollDate" class="employee_obligation_PayrollDate"><?php echo $employee_obligation_delete->PayrollDate->caption() ?></span></th>
<?php } ?>
<?php if ($employee_obligation_delete->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<th class="<?php echo $employee_obligation_delete->PayrollPeriod->headerCellClass() ?>"><span id="elh_employee_obligation_PayrollPeriod" class="employee_obligation_PayrollPeriod"><?php echo $employee_obligation_delete->PayrollPeriod->caption() ?></span></th>
<?php } ?>
<?php if ($employee_obligation_delete->StartDate->Visible) { // StartDate ?>
		<th class="<?php echo $employee_obligation_delete->StartDate->headerCellClass() ?>"><span id="elh_employee_obligation_StartDate" class="employee_obligation_StartDate"><?php echo $employee_obligation_delete->StartDate->caption() ?></span></th>
<?php } ?>
<?php if ($employee_obligation_delete->Enddate->Visible) { // Enddate ?>
		<th class="<?php echo $employee_obligation_delete->Enddate->headerCellClass() ?>"><span id="elh_employee_obligation_Enddate" class="employee_obligation_Enddate"><?php echo $employee_obligation_delete->Enddate->caption() ?></span></th>
<?php } ?>
<?php if ($employee_obligation_delete->ObligationCode->Visible) { // ObligationCode ?>
		<th class="<?php echo $employee_obligation_delete->ObligationCode->headerCellClass() ?>"><span id="elh_employee_obligation_ObligationCode" class="employee_obligation_ObligationCode"><?php echo $employee_obligation_delete->ObligationCode->caption() ?></span></th>
<?php } ?>
<?php if ($employee_obligation_delete->ObligationAmount->Visible) { // ObligationAmount ?>
		<th class="<?php echo $employee_obligation_delete->ObligationAmount->headerCellClass() ?>"><span id="elh_employee_obligation_ObligationAmount" class="employee_obligation_ObligationAmount"><?php echo $employee_obligation_delete->ObligationAmount->caption() ?></span></th>
<?php } ?>
<?php if ($employee_obligation_delete->Remarks->Visible) { // Remarks ?>
		<th class="<?php echo $employee_obligation_delete->Remarks->headerCellClass() ?>"><span id="elh_employee_obligation_Remarks" class="employee_obligation_Remarks"><?php echo $employee_obligation_delete->Remarks->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$employee_obligation_delete->RecordCount = 0;
$i = 0;
while (!$employee_obligation_delete->Recordset->EOF) {
	$employee_obligation_delete->RecordCount++;
	$employee_obligation_delete->RowCount++;

	// Set row properties
	$employee_obligation->resetAttributes();
	$employee_obligation->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$employee_obligation_delete->loadRowValues($employee_obligation_delete->Recordset);

	// Render row
	$employee_obligation_delete->renderRow();
?>
	<tr <?php echo $employee_obligation->rowAttributes() ?>>
<?php if ($employee_obligation_delete->EmployeeID->Visible) { // EmployeeID ?>
		<td <?php echo $employee_obligation_delete->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $employee_obligation_delete->RowCount ?>_employee_obligation_EmployeeID" class="employee_obligation_EmployeeID">
<span<?php echo $employee_obligation_delete->EmployeeID->viewAttributes() ?>><?php echo $employee_obligation_delete->EmployeeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_obligation_delete->PaidPosition->Visible) { // PaidPosition ?>
		<td <?php echo $employee_obligation_delete->PaidPosition->cellAttributes() ?>>
<span id="el<?php echo $employee_obligation_delete->RowCount ?>_employee_obligation_PaidPosition" class="employee_obligation_PaidPosition">
<span<?php echo $employee_obligation_delete->PaidPosition->viewAttributes() ?>><?php echo $employee_obligation_delete->PaidPosition->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_obligation_delete->PayrollDate->Visible) { // PayrollDate ?>
		<td <?php echo $employee_obligation_delete->PayrollDate->cellAttributes() ?>>
<span id="el<?php echo $employee_obligation_delete->RowCount ?>_employee_obligation_PayrollDate" class="employee_obligation_PayrollDate">
<span<?php echo $employee_obligation_delete->PayrollDate->viewAttributes() ?>><?php echo $employee_obligation_delete->PayrollDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_obligation_delete->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td <?php echo $employee_obligation_delete->PayrollPeriod->cellAttributes() ?>>
<span id="el<?php echo $employee_obligation_delete->RowCount ?>_employee_obligation_PayrollPeriod" class="employee_obligation_PayrollPeriod">
<span<?php echo $employee_obligation_delete->PayrollPeriod->viewAttributes() ?>><?php echo $employee_obligation_delete->PayrollPeriod->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_obligation_delete->StartDate->Visible) { // StartDate ?>
		<td <?php echo $employee_obligation_delete->StartDate->cellAttributes() ?>>
<span id="el<?php echo $employee_obligation_delete->RowCount ?>_employee_obligation_StartDate" class="employee_obligation_StartDate">
<span<?php echo $employee_obligation_delete->StartDate->viewAttributes() ?>><?php echo $employee_obligation_delete->StartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_obligation_delete->Enddate->Visible) { // Enddate ?>
		<td <?php echo $employee_obligation_delete->Enddate->cellAttributes() ?>>
<span id="el<?php echo $employee_obligation_delete->RowCount ?>_employee_obligation_Enddate" class="employee_obligation_Enddate">
<span<?php echo $employee_obligation_delete->Enddate->viewAttributes() ?>><?php echo $employee_obligation_delete->Enddate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_obligation_delete->ObligationCode->Visible) { // ObligationCode ?>
		<td <?php echo $employee_obligation_delete->ObligationCode->cellAttributes() ?>>
<span id="el<?php echo $employee_obligation_delete->RowCount ?>_employee_obligation_ObligationCode" class="employee_obligation_ObligationCode">
<span<?php echo $employee_obligation_delete->ObligationCode->viewAttributes() ?>><?php echo $employee_obligation_delete->ObligationCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_obligation_delete->ObligationAmount->Visible) { // ObligationAmount ?>
		<td <?php echo $employee_obligation_delete->ObligationAmount->cellAttributes() ?>>
<span id="el<?php echo $employee_obligation_delete->RowCount ?>_employee_obligation_ObligationAmount" class="employee_obligation_ObligationAmount">
<span<?php echo $employee_obligation_delete->ObligationAmount->viewAttributes() ?>><?php echo $employee_obligation_delete->ObligationAmount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employee_obligation_delete->Remarks->Visible) { // Remarks ?>
		<td <?php echo $employee_obligation_delete->Remarks->cellAttributes() ?>>
<span id="el<?php echo $employee_obligation_delete->RowCount ?>_employee_obligation_Remarks" class="employee_obligation_Remarks">
<span<?php echo $employee_obligation_delete->Remarks->viewAttributes() ?>><?php echo $employee_obligation_delete->Remarks->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$employee_obligation_delete->Recordset->moveNext();
}
$employee_obligation_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employee_obligation_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$employee_obligation_delete->showPageFooter();
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
$employee_obligation_delete->terminate();
?>