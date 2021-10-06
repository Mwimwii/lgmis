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
$employment_acting_delete = new employment_acting_delete();

// Run the page
$employment_acting_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_acting_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployment_actingdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	femployment_actingdelete = currentForm = new ew.Form("femployment_actingdelete", "delete");
	loadjs.done("femployment_actingdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employment_acting_delete->showPageHeader(); ?>
<?php
$employment_acting_delete->showMessage();
?>
<form name="femployment_actingdelete" id="femployment_actingdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employment_acting">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($employment_acting_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($employment_acting_delete->EmployeeID->Visible) { // EmployeeID ?>
		<th class="<?php echo $employment_acting_delete->EmployeeID->headerCellClass() ?>"><span id="elh_employment_acting_EmployeeID" class="employment_acting_EmployeeID"><?php echo $employment_acting_delete->EmployeeID->caption() ?></span></th>
<?php } ?>
<?php if ($employment_acting_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<th class="<?php echo $employment_acting_delete->ProvinceCode->headerCellClass() ?>"><span id="elh_employment_acting_ProvinceCode" class="employment_acting_ProvinceCode"><?php echo $employment_acting_delete->ProvinceCode->caption() ?></span></th>
<?php } ?>
<?php if ($employment_acting_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $employment_acting_delete->LACode->headerCellClass() ?>"><span id="elh_employment_acting_LACode" class="employment_acting_LACode"><?php echo $employment_acting_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($employment_acting_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<th class="<?php echo $employment_acting_delete->DepartmentCode->headerCellClass() ?>"><span id="elh_employment_acting_DepartmentCode" class="employment_acting_DepartmentCode"><?php echo $employment_acting_delete->DepartmentCode->caption() ?></span></th>
<?php } ?>
<?php if ($employment_acting_delete->SectionCode->Visible) { // SectionCode ?>
		<th class="<?php echo $employment_acting_delete->SectionCode->headerCellClass() ?>"><span id="elh_employment_acting_SectionCode" class="employment_acting_SectionCode"><?php echo $employment_acting_delete->SectionCode->caption() ?></span></th>
<?php } ?>
<?php if ($employment_acting_delete->ActingPosition->Visible) { // ActingPosition ?>
		<th class="<?php echo $employment_acting_delete->ActingPosition->headerCellClass() ?>"><span id="elh_employment_acting_ActingPosition" class="employment_acting_ActingPosition"><?php echo $employment_acting_delete->ActingPosition->caption() ?></span></th>
<?php } ?>
<?php if ($employment_acting_delete->DateOfActingAppointment->Visible) { // DateOfActingAppointment ?>
		<th class="<?php echo $employment_acting_delete->DateOfActingAppointment->headerCellClass() ?>"><span id="elh_employment_acting_DateOfActingAppointment" class="employment_acting_DateOfActingAppointment"><?php echo $employment_acting_delete->DateOfActingAppointment->caption() ?></span></th>
<?php } ?>
<?php if ($employment_acting_delete->EndDateOfActingPeriod->Visible) { // EndDateOfActingPeriod ?>
		<th class="<?php echo $employment_acting_delete->EndDateOfActingPeriod->headerCellClass() ?>"><span id="elh_employment_acting_EndDateOfActingPeriod" class="employment_acting_EndDateOfActingPeriod"><?php echo $employment_acting_delete->EndDateOfActingPeriod->caption() ?></span></th>
<?php } ?>
<?php if ($employment_acting_delete->SalaryScale->Visible) { // SalaryScale ?>
		<th class="<?php echo $employment_acting_delete->SalaryScale->headerCellClass() ?>"><span id="elh_employment_acting_SalaryScale" class="employment_acting_SalaryScale"><?php echo $employment_acting_delete->SalaryScale->caption() ?></span></th>
<?php } ?>
<?php if ($employment_acting_delete->ActingType->Visible) { // ActingType ?>
		<th class="<?php echo $employment_acting_delete->ActingType->headerCellClass() ?>"><span id="elh_employment_acting_ActingType" class="employment_acting_ActingType"><?php echo $employment_acting_delete->ActingType->caption() ?></span></th>
<?php } ?>
<?php if ($employment_acting_delete->ActingStatus->Visible) { // ActingStatus ?>
		<th class="<?php echo $employment_acting_delete->ActingStatus->headerCellClass() ?>"><span id="elh_employment_acting_ActingStatus" class="employment_acting_ActingStatus"><?php echo $employment_acting_delete->ActingStatus->caption() ?></span></th>
<?php } ?>
<?php if ($employment_acting_delete->ActingReason->Visible) { // ActingReason ?>
		<th class="<?php echo $employment_acting_delete->ActingReason->headerCellClass() ?>"><span id="elh_employment_acting_ActingReason" class="employment_acting_ActingReason"><?php echo $employment_acting_delete->ActingReason->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$employment_acting_delete->RecordCount = 0;
$i = 0;
while (!$employment_acting_delete->Recordset->EOF) {
	$employment_acting_delete->RecordCount++;
	$employment_acting_delete->RowCount++;

	// Set row properties
	$employment_acting->resetAttributes();
	$employment_acting->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$employment_acting_delete->loadRowValues($employment_acting_delete->Recordset);

	// Render row
	$employment_acting_delete->renderRow();
?>
	<tr <?php echo $employment_acting->rowAttributes() ?>>
<?php if ($employment_acting_delete->EmployeeID->Visible) { // EmployeeID ?>
		<td <?php echo $employment_acting_delete->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $employment_acting_delete->RowCount ?>_employment_acting_EmployeeID" class="employment_acting_EmployeeID">
<span<?php echo $employment_acting_delete->EmployeeID->viewAttributes() ?>><?php echo $employment_acting_delete->EmployeeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_acting_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<td <?php echo $employment_acting_delete->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $employment_acting_delete->RowCount ?>_employment_acting_ProvinceCode" class="employment_acting_ProvinceCode">
<span<?php echo $employment_acting_delete->ProvinceCode->viewAttributes() ?>><?php echo $employment_acting_delete->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_acting_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $employment_acting_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $employment_acting_delete->RowCount ?>_employment_acting_LACode" class="employment_acting_LACode">
<span<?php echo $employment_acting_delete->LACode->viewAttributes() ?>><?php echo $employment_acting_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_acting_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<td <?php echo $employment_acting_delete->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $employment_acting_delete->RowCount ?>_employment_acting_DepartmentCode" class="employment_acting_DepartmentCode">
<span<?php echo $employment_acting_delete->DepartmentCode->viewAttributes() ?>><?php echo $employment_acting_delete->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_acting_delete->SectionCode->Visible) { // SectionCode ?>
		<td <?php echo $employment_acting_delete->SectionCode->cellAttributes() ?>>
<span id="el<?php echo $employment_acting_delete->RowCount ?>_employment_acting_SectionCode" class="employment_acting_SectionCode">
<span<?php echo $employment_acting_delete->SectionCode->viewAttributes() ?>><?php echo $employment_acting_delete->SectionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_acting_delete->ActingPosition->Visible) { // ActingPosition ?>
		<td <?php echo $employment_acting_delete->ActingPosition->cellAttributes() ?>>
<span id="el<?php echo $employment_acting_delete->RowCount ?>_employment_acting_ActingPosition" class="employment_acting_ActingPosition">
<span<?php echo $employment_acting_delete->ActingPosition->viewAttributes() ?>><?php echo $employment_acting_delete->ActingPosition->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_acting_delete->DateOfActingAppointment->Visible) { // DateOfActingAppointment ?>
		<td <?php echo $employment_acting_delete->DateOfActingAppointment->cellAttributes() ?>>
<span id="el<?php echo $employment_acting_delete->RowCount ?>_employment_acting_DateOfActingAppointment" class="employment_acting_DateOfActingAppointment">
<span<?php echo $employment_acting_delete->DateOfActingAppointment->viewAttributes() ?>><?php echo $employment_acting_delete->DateOfActingAppointment->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_acting_delete->EndDateOfActingPeriod->Visible) { // EndDateOfActingPeriod ?>
		<td <?php echo $employment_acting_delete->EndDateOfActingPeriod->cellAttributes() ?>>
<span id="el<?php echo $employment_acting_delete->RowCount ?>_employment_acting_EndDateOfActingPeriod" class="employment_acting_EndDateOfActingPeriod">
<span<?php echo $employment_acting_delete->EndDateOfActingPeriod->viewAttributes() ?>><?php echo $employment_acting_delete->EndDateOfActingPeriod->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_acting_delete->SalaryScale->Visible) { // SalaryScale ?>
		<td <?php echo $employment_acting_delete->SalaryScale->cellAttributes() ?>>
<span id="el<?php echo $employment_acting_delete->RowCount ?>_employment_acting_SalaryScale" class="employment_acting_SalaryScale">
<span<?php echo $employment_acting_delete->SalaryScale->viewAttributes() ?>><?php echo $employment_acting_delete->SalaryScale->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_acting_delete->ActingType->Visible) { // ActingType ?>
		<td <?php echo $employment_acting_delete->ActingType->cellAttributes() ?>>
<span id="el<?php echo $employment_acting_delete->RowCount ?>_employment_acting_ActingType" class="employment_acting_ActingType">
<span<?php echo $employment_acting_delete->ActingType->viewAttributes() ?>><?php echo $employment_acting_delete->ActingType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_acting_delete->ActingStatus->Visible) { // ActingStatus ?>
		<td <?php echo $employment_acting_delete->ActingStatus->cellAttributes() ?>>
<span id="el<?php echo $employment_acting_delete->RowCount ?>_employment_acting_ActingStatus" class="employment_acting_ActingStatus">
<span<?php echo $employment_acting_delete->ActingStatus->viewAttributes() ?>><?php echo $employment_acting_delete->ActingStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_acting_delete->ActingReason->Visible) { // ActingReason ?>
		<td <?php echo $employment_acting_delete->ActingReason->cellAttributes() ?>>
<span id="el<?php echo $employment_acting_delete->RowCount ?>_employment_acting_ActingReason" class="employment_acting_ActingReason">
<span<?php echo $employment_acting_delete->ActingReason->viewAttributes() ?>><?php echo $employment_acting_delete->ActingReason->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$employment_acting_delete->Recordset->moveNext();
}
$employment_acting_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employment_acting_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$employment_acting_delete->showPageFooter();
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
$employment_acting_delete->terminate();
?>