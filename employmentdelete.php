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
$employment_delete = new employment_delete();

// Run the page
$employment_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femploymentdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	femploymentdelete = currentForm = new ew.Form("femploymentdelete", "delete");
	loadjs.done("femploymentdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employment_delete->showPageHeader(); ?>
<?php
$employment_delete->showMessage();
?>
<form name="femploymentdelete" id="femploymentdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employment">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($employment_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($employment_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<th class="<?php echo $employment_delete->ProvinceCode->headerCellClass() ?>"><span id="elh_employment_ProvinceCode" class="employment_ProvinceCode"><?php echo $employment_delete->ProvinceCode->caption() ?></span></th>
<?php } ?>
<?php if ($employment_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $employment_delete->LACode->headerCellClass() ?>"><span id="elh_employment_LACode" class="employment_LACode"><?php echo $employment_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($employment_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<th class="<?php echo $employment_delete->DepartmentCode->headerCellClass() ?>"><span id="elh_employment_DepartmentCode" class="employment_DepartmentCode"><?php echo $employment_delete->DepartmentCode->caption() ?></span></th>
<?php } ?>
<?php if ($employment_delete->SectionCode->Visible) { // SectionCode ?>
		<th class="<?php echo $employment_delete->SectionCode->headerCellClass() ?>"><span id="elh_employment_SectionCode" class="employment_SectionCode"><?php echo $employment_delete->SectionCode->caption() ?></span></th>
<?php } ?>
<?php if ($employment_delete->SubstantivePosition->Visible) { // SubstantivePosition ?>
		<th class="<?php echo $employment_delete->SubstantivePosition->headerCellClass() ?>"><span id="elh_employment_SubstantivePosition" class="employment_SubstantivePosition"><?php echo $employment_delete->SubstantivePosition->caption() ?></span></th>
<?php } ?>
<?php if ($employment_delete->DateOfCurrentAppointment->Visible) { // DateOfCurrentAppointment ?>
		<th class="<?php echo $employment_delete->DateOfCurrentAppointment->headerCellClass() ?>"><span id="elh_employment_DateOfCurrentAppointment" class="employment_DateOfCurrentAppointment"><?php echo $employment_delete->DateOfCurrentAppointment->caption() ?></span></th>
<?php } ?>
<?php if ($employment_delete->LastAppraisalDate->Visible) { // LastAppraisalDate ?>
		<th class="<?php echo $employment_delete->LastAppraisalDate->headerCellClass() ?>"><span id="elh_employment_LastAppraisalDate" class="employment_LastAppraisalDate"><?php echo $employment_delete->LastAppraisalDate->caption() ?></span></th>
<?php } ?>
<?php if ($employment_delete->AppraisalStatus->Visible) { // AppraisalStatus ?>
		<th class="<?php echo $employment_delete->AppraisalStatus->headerCellClass() ?>"><span id="elh_employment_AppraisalStatus" class="employment_AppraisalStatus"><?php echo $employment_delete->AppraisalStatus->caption() ?></span></th>
<?php } ?>
<?php if ($employment_delete->DateOfExit->Visible) { // DateOfExit ?>
		<th class="<?php echo $employment_delete->DateOfExit->headerCellClass() ?>"><span id="elh_employment_DateOfExit" class="employment_DateOfExit"><?php echo $employment_delete->DateOfExit->caption() ?></span></th>
<?php } ?>
<?php if ($employment_delete->EmploymentType->Visible) { // EmploymentType ?>
		<th class="<?php echo $employment_delete->EmploymentType->headerCellClass() ?>"><span id="elh_employment_EmploymentType" class="employment_EmploymentType"><?php echo $employment_delete->EmploymentType->caption() ?></span></th>
<?php } ?>
<?php if ($employment_delete->EmploymentStatus->Visible) { // EmploymentStatus ?>
		<th class="<?php echo $employment_delete->EmploymentStatus->headerCellClass() ?>"><span id="elh_employment_EmploymentStatus" class="employment_EmploymentStatus"><?php echo $employment_delete->EmploymentStatus->caption() ?></span></th>
<?php } ?>
<?php if ($employment_delete->EmployeeNumber->Visible) { // EmployeeNumber ?>
		<th class="<?php echo $employment_delete->EmployeeNumber->headerCellClass() ?>"><span id="elh_employment_EmployeeNumber" class="employment_EmployeeNumber"><?php echo $employment_delete->EmployeeNumber->caption() ?></span></th>
<?php } ?>
<?php if ($employment_delete->SalaryNotch->Visible) { // SalaryNotch ?>
		<th class="<?php echo $employment_delete->SalaryNotch->headerCellClass() ?>"><span id="elh_employment_SalaryNotch" class="employment_SalaryNotch"><?php echo $employment_delete->SalaryNotch->caption() ?></span></th>
<?php } ?>
<?php if ($employment_delete->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
		<th class="<?php echo $employment_delete->BasicMonthlySalary->headerCellClass() ?>"><span id="elh_employment_BasicMonthlySalary" class="employment_BasicMonthlySalary"><?php echo $employment_delete->BasicMonthlySalary->caption() ?></span></th>
<?php } ?>
<?php if ($employment_delete->ThirdParties->Visible) { // ThirdParties ?>
		<th class="<?php echo $employment_delete->ThirdParties->headerCellClass() ?>"><span id="elh_employment_ThirdParties" class="employment_ThirdParties"><?php echo $employment_delete->ThirdParties->caption() ?></span></th>
<?php } ?>
<?php if ($employment_delete->PayrollCode->Visible) { // PayrollCode ?>
		<th class="<?php echo $employment_delete->PayrollCode->headerCellClass() ?>"><span id="elh_employment_PayrollCode" class="employment_PayrollCode"><?php echo $employment_delete->PayrollCode->caption() ?></span></th>
<?php } ?>
<?php if ($employment_delete->DateOfConfirmation->Visible) { // DateOfConfirmation ?>
		<th class="<?php echo $employment_delete->DateOfConfirmation->headerCellClass() ?>"><span id="elh_employment_DateOfConfirmation" class="employment_DateOfConfirmation"><?php echo $employment_delete->DateOfConfirmation->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$employment_delete->RecordCount = 0;
$i = 0;
while (!$employment_delete->Recordset->EOF) {
	$employment_delete->RecordCount++;
	$employment_delete->RowCount++;

	// Set row properties
	$employment->resetAttributes();
	$employment->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$employment_delete->loadRowValues($employment_delete->Recordset);

	// Render row
	$employment_delete->renderRow();
?>
	<tr <?php echo $employment->rowAttributes() ?>>
<?php if ($employment_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<td <?php echo $employment_delete->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $employment_delete->RowCount ?>_employment_ProvinceCode" class="employment_ProvinceCode">
<span<?php echo $employment_delete->ProvinceCode->viewAttributes() ?>><?php echo $employment_delete->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $employment_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $employment_delete->RowCount ?>_employment_LACode" class="employment_LACode">
<span<?php echo $employment_delete->LACode->viewAttributes() ?>><?php echo $employment_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<td <?php echo $employment_delete->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $employment_delete->RowCount ?>_employment_DepartmentCode" class="employment_DepartmentCode">
<span<?php echo $employment_delete->DepartmentCode->viewAttributes() ?>><?php echo $employment_delete->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_delete->SectionCode->Visible) { // SectionCode ?>
		<td <?php echo $employment_delete->SectionCode->cellAttributes() ?>>
<span id="el<?php echo $employment_delete->RowCount ?>_employment_SectionCode" class="employment_SectionCode">
<span<?php echo $employment_delete->SectionCode->viewAttributes() ?>><?php echo $employment_delete->SectionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_delete->SubstantivePosition->Visible) { // SubstantivePosition ?>
		<td <?php echo $employment_delete->SubstantivePosition->cellAttributes() ?>>
<span id="el<?php echo $employment_delete->RowCount ?>_employment_SubstantivePosition" class="employment_SubstantivePosition">
<span<?php echo $employment_delete->SubstantivePosition->viewAttributes() ?>><?php echo $employment_delete->SubstantivePosition->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_delete->DateOfCurrentAppointment->Visible) { // DateOfCurrentAppointment ?>
		<td <?php echo $employment_delete->DateOfCurrentAppointment->cellAttributes() ?>>
<span id="el<?php echo $employment_delete->RowCount ?>_employment_DateOfCurrentAppointment" class="employment_DateOfCurrentAppointment">
<span<?php echo $employment_delete->DateOfCurrentAppointment->viewAttributes() ?>><?php echo $employment_delete->DateOfCurrentAppointment->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_delete->LastAppraisalDate->Visible) { // LastAppraisalDate ?>
		<td <?php echo $employment_delete->LastAppraisalDate->cellAttributes() ?>>
<span id="el<?php echo $employment_delete->RowCount ?>_employment_LastAppraisalDate" class="employment_LastAppraisalDate">
<span<?php echo $employment_delete->LastAppraisalDate->viewAttributes() ?>><?php echo $employment_delete->LastAppraisalDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_delete->AppraisalStatus->Visible) { // AppraisalStatus ?>
		<td <?php echo $employment_delete->AppraisalStatus->cellAttributes() ?>>
<span id="el<?php echo $employment_delete->RowCount ?>_employment_AppraisalStatus" class="employment_AppraisalStatus">
<span<?php echo $employment_delete->AppraisalStatus->viewAttributes() ?>><?php echo $employment_delete->AppraisalStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_delete->DateOfExit->Visible) { // DateOfExit ?>
		<td <?php echo $employment_delete->DateOfExit->cellAttributes() ?>>
<span id="el<?php echo $employment_delete->RowCount ?>_employment_DateOfExit" class="employment_DateOfExit">
<span<?php echo $employment_delete->DateOfExit->viewAttributes() ?>><?php echo $employment_delete->DateOfExit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_delete->EmploymentType->Visible) { // EmploymentType ?>
		<td <?php echo $employment_delete->EmploymentType->cellAttributes() ?>>
<span id="el<?php echo $employment_delete->RowCount ?>_employment_EmploymentType" class="employment_EmploymentType">
<span<?php echo $employment_delete->EmploymentType->viewAttributes() ?>><?php echo $employment_delete->EmploymentType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_delete->EmploymentStatus->Visible) { // EmploymentStatus ?>
		<td <?php echo $employment_delete->EmploymentStatus->cellAttributes() ?>>
<span id="el<?php echo $employment_delete->RowCount ?>_employment_EmploymentStatus" class="employment_EmploymentStatus">
<span<?php echo $employment_delete->EmploymentStatus->viewAttributes() ?>><?php echo $employment_delete->EmploymentStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_delete->EmployeeNumber->Visible) { // EmployeeNumber ?>
		<td <?php echo $employment_delete->EmployeeNumber->cellAttributes() ?>>
<span id="el<?php echo $employment_delete->RowCount ?>_employment_EmployeeNumber" class="employment_EmployeeNumber">
<span<?php echo $employment_delete->EmployeeNumber->viewAttributes() ?>><?php echo $employment_delete->EmployeeNumber->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_delete->SalaryNotch->Visible) { // SalaryNotch ?>
		<td <?php echo $employment_delete->SalaryNotch->cellAttributes() ?>>
<span id="el<?php echo $employment_delete->RowCount ?>_employment_SalaryNotch" class="employment_SalaryNotch">
<span<?php echo $employment_delete->SalaryNotch->viewAttributes() ?>><?php echo $employment_delete->SalaryNotch->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_delete->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
		<td <?php echo $employment_delete->BasicMonthlySalary->cellAttributes() ?>>
<span id="el<?php echo $employment_delete->RowCount ?>_employment_BasicMonthlySalary" class="employment_BasicMonthlySalary">
<span<?php echo $employment_delete->BasicMonthlySalary->viewAttributes() ?>><?php echo $employment_delete->BasicMonthlySalary->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_delete->ThirdParties->Visible) { // ThirdParties ?>
		<td <?php echo $employment_delete->ThirdParties->cellAttributes() ?>>
<span id="el<?php echo $employment_delete->RowCount ?>_employment_ThirdParties" class="employment_ThirdParties">
<span<?php echo $employment_delete->ThirdParties->viewAttributes() ?>><?php echo $employment_delete->ThirdParties->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_delete->PayrollCode->Visible) { // PayrollCode ?>
		<td <?php echo $employment_delete->PayrollCode->cellAttributes() ?>>
<span id="el<?php echo $employment_delete->RowCount ?>_employment_PayrollCode" class="employment_PayrollCode">
<span<?php echo $employment_delete->PayrollCode->viewAttributes() ?>><?php echo $employment_delete->PayrollCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_delete->DateOfConfirmation->Visible) { // DateOfConfirmation ?>
		<td <?php echo $employment_delete->DateOfConfirmation->cellAttributes() ?>>
<span id="el<?php echo $employment_delete->RowCount ?>_employment_DateOfConfirmation" class="employment_DateOfConfirmation">
<span<?php echo $employment_delete->DateOfConfirmation->viewAttributes() ?>><?php echo $employment_delete->DateOfConfirmation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$employment_delete->Recordset->moveNext();
}
$employment_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employment_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$employment_delete->showPageFooter();
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
$employment_delete->terminate();
?>