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
$employment_view = new employment_view();

// Run the page
$employment_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$employment_view->isExport()) { ?>
<script>
var femploymentview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	femploymentview = currentForm = new ew.Form("femploymentview", "view");
	loadjs.done("femploymentview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$employment_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $employment_view->ExportOptions->render("body") ?>
<?php $employment_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $employment_view->showPageHeader(); ?>
<?php
$employment_view->showMessage();
?>
<?php if (!$employment_view->IsModal) { ?>
<?php if (!$employment_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employment_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="femploymentview" id="femploymentview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employment">
<input type="hidden" name="modal" value="<?php echo (int)$employment_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($employment_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $employment_view->TableLeftColumnClass ?>"><span id="elh_employment_EmployeeID"><?php echo $employment_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $employment_view->EmployeeID->cellAttributes() ?>>
<span id="el_employment_EmployeeID">
<span<?php echo $employment_view->EmployeeID->viewAttributes() ?>><?php echo $employment_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_view->ProvinceCode->Visible) { // ProvinceCode ?>
	<tr id="r_ProvinceCode">
		<td class="<?php echo $employment_view->TableLeftColumnClass ?>"><span id="elh_employment_ProvinceCode"><?php echo $employment_view->ProvinceCode->caption() ?></span></td>
		<td data-name="ProvinceCode" <?php echo $employment_view->ProvinceCode->cellAttributes() ?>>
<span id="el_employment_ProvinceCode">
<span<?php echo $employment_view->ProvinceCode->viewAttributes() ?>><?php echo $employment_view->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $employment_view->TableLeftColumnClass ?>"><span id="elh_employment_LACode"><?php echo $employment_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $employment_view->LACode->cellAttributes() ?>>
<span id="el_employment_LACode">
<span<?php echo $employment_view->LACode->viewAttributes() ?>><?php echo $employment_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_view->DepartmentCode->Visible) { // DepartmentCode ?>
	<tr id="r_DepartmentCode">
		<td class="<?php echo $employment_view->TableLeftColumnClass ?>"><span id="elh_employment_DepartmentCode"><?php echo $employment_view->DepartmentCode->caption() ?></span></td>
		<td data-name="DepartmentCode" <?php echo $employment_view->DepartmentCode->cellAttributes() ?>>
<span id="el_employment_DepartmentCode">
<span<?php echo $employment_view->DepartmentCode->viewAttributes() ?>><?php echo $employment_view->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_view->SectionCode->Visible) { // SectionCode ?>
	<tr id="r_SectionCode">
		<td class="<?php echo $employment_view->TableLeftColumnClass ?>"><span id="elh_employment_SectionCode"><?php echo $employment_view->SectionCode->caption() ?></span></td>
		<td data-name="SectionCode" <?php echo $employment_view->SectionCode->cellAttributes() ?>>
<span id="el_employment_SectionCode">
<span<?php echo $employment_view->SectionCode->viewAttributes() ?>><?php echo $employment_view->SectionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_view->SubstantivePosition->Visible) { // SubstantivePosition ?>
	<tr id="r_SubstantivePosition">
		<td class="<?php echo $employment_view->TableLeftColumnClass ?>"><span id="elh_employment_SubstantivePosition"><?php echo $employment_view->SubstantivePosition->caption() ?></span></td>
		<td data-name="SubstantivePosition" <?php echo $employment_view->SubstantivePosition->cellAttributes() ?>>
<span id="el_employment_SubstantivePosition">
<span<?php echo $employment_view->SubstantivePosition->viewAttributes() ?>><?php echo $employment_view->SubstantivePosition->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_view->DateOfCurrentAppointment->Visible) { // DateOfCurrentAppointment ?>
	<tr id="r_DateOfCurrentAppointment">
		<td class="<?php echo $employment_view->TableLeftColumnClass ?>"><span id="elh_employment_DateOfCurrentAppointment"><?php echo $employment_view->DateOfCurrentAppointment->caption() ?></span></td>
		<td data-name="DateOfCurrentAppointment" <?php echo $employment_view->DateOfCurrentAppointment->cellAttributes() ?>>
<span id="el_employment_DateOfCurrentAppointment">
<span<?php echo $employment_view->DateOfCurrentAppointment->viewAttributes() ?>><?php echo $employment_view->DateOfCurrentAppointment->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_view->LastAppraisalDate->Visible) { // LastAppraisalDate ?>
	<tr id="r_LastAppraisalDate">
		<td class="<?php echo $employment_view->TableLeftColumnClass ?>"><span id="elh_employment_LastAppraisalDate"><?php echo $employment_view->LastAppraisalDate->caption() ?></span></td>
		<td data-name="LastAppraisalDate" <?php echo $employment_view->LastAppraisalDate->cellAttributes() ?>>
<span id="el_employment_LastAppraisalDate">
<span<?php echo $employment_view->LastAppraisalDate->viewAttributes() ?>><?php echo $employment_view->LastAppraisalDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_view->AppraisalStatus->Visible) { // AppraisalStatus ?>
	<tr id="r_AppraisalStatus">
		<td class="<?php echo $employment_view->TableLeftColumnClass ?>"><span id="elh_employment_AppraisalStatus"><?php echo $employment_view->AppraisalStatus->caption() ?></span></td>
		<td data-name="AppraisalStatus" <?php echo $employment_view->AppraisalStatus->cellAttributes() ?>>
<span id="el_employment_AppraisalStatus">
<span<?php echo $employment_view->AppraisalStatus->viewAttributes() ?>><?php echo $employment_view->AppraisalStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_view->DateOfExit->Visible) { // DateOfExit ?>
	<tr id="r_DateOfExit">
		<td class="<?php echo $employment_view->TableLeftColumnClass ?>"><span id="elh_employment_DateOfExit"><?php echo $employment_view->DateOfExit->caption() ?></span></td>
		<td data-name="DateOfExit" <?php echo $employment_view->DateOfExit->cellAttributes() ?>>
<span id="el_employment_DateOfExit">
<span<?php echo $employment_view->DateOfExit->viewAttributes() ?>><?php echo $employment_view->DateOfExit->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_view->SalaryScale->Visible) { // SalaryScale ?>
	<tr id="r_SalaryScale">
		<td class="<?php echo $employment_view->TableLeftColumnClass ?>"><span id="elh_employment_SalaryScale"><?php echo $employment_view->SalaryScale->caption() ?></span></td>
		<td data-name="SalaryScale" <?php echo $employment_view->SalaryScale->cellAttributes() ?>>
<span id="el_employment_SalaryScale">
<span<?php echo $employment_view->SalaryScale->viewAttributes() ?>><?php echo $employment_view->SalaryScale->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_view->EmploymentType->Visible) { // EmploymentType ?>
	<tr id="r_EmploymentType">
		<td class="<?php echo $employment_view->TableLeftColumnClass ?>"><span id="elh_employment_EmploymentType"><?php echo $employment_view->EmploymentType->caption() ?></span></td>
		<td data-name="EmploymentType" <?php echo $employment_view->EmploymentType->cellAttributes() ?>>
<span id="el_employment_EmploymentType">
<span<?php echo $employment_view->EmploymentType->viewAttributes() ?>><?php echo $employment_view->EmploymentType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_view->EmploymentStatus->Visible) { // EmploymentStatus ?>
	<tr id="r_EmploymentStatus">
		<td class="<?php echo $employment_view->TableLeftColumnClass ?>"><span id="elh_employment_EmploymentStatus"><?php echo $employment_view->EmploymentStatus->caption() ?></span></td>
		<td data-name="EmploymentStatus" <?php echo $employment_view->EmploymentStatus->cellAttributes() ?>>
<span id="el_employment_EmploymentStatus">
<span<?php echo $employment_view->EmploymentStatus->viewAttributes() ?>><?php echo $employment_view->EmploymentStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_view->EmployeeNumber->Visible) { // EmployeeNumber ?>
	<tr id="r_EmployeeNumber">
		<td class="<?php echo $employment_view->TableLeftColumnClass ?>"><span id="elh_employment_EmployeeNumber"><?php echo $employment_view->EmployeeNumber->caption() ?></span></td>
		<td data-name="EmployeeNumber" <?php echo $employment_view->EmployeeNumber->cellAttributes() ?>>
<span id="el_employment_EmployeeNumber">
<span<?php echo $employment_view->EmployeeNumber->viewAttributes() ?>><?php echo $employment_view->EmployeeNumber->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_view->SalaryNotch->Visible) { // SalaryNotch ?>
	<tr id="r_SalaryNotch">
		<td class="<?php echo $employment_view->TableLeftColumnClass ?>"><span id="elh_employment_SalaryNotch"><?php echo $employment_view->SalaryNotch->caption() ?></span></td>
		<td data-name="SalaryNotch" <?php echo $employment_view->SalaryNotch->cellAttributes() ?>>
<span id="el_employment_SalaryNotch">
<span<?php echo $employment_view->SalaryNotch->viewAttributes() ?>><?php echo $employment_view->SalaryNotch->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_view->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
	<tr id="r_BasicMonthlySalary">
		<td class="<?php echo $employment_view->TableLeftColumnClass ?>"><span id="elh_employment_BasicMonthlySalary"><?php echo $employment_view->BasicMonthlySalary->caption() ?></span></td>
		<td data-name="BasicMonthlySalary" <?php echo $employment_view->BasicMonthlySalary->cellAttributes() ?>>
<span id="el_employment_BasicMonthlySalary">
<span<?php echo $employment_view->BasicMonthlySalary->viewAttributes() ?>><?php echo $employment_view->BasicMonthlySalary->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_view->ThirdParties->Visible) { // ThirdParties ?>
	<tr id="r_ThirdParties">
		<td class="<?php echo $employment_view->TableLeftColumnClass ?>"><span id="elh_employment_ThirdParties"><?php echo $employment_view->ThirdParties->caption() ?></span></td>
		<td data-name="ThirdParties" <?php echo $employment_view->ThirdParties->cellAttributes() ?>>
<span id="el_employment_ThirdParties">
<span<?php echo $employment_view->ThirdParties->viewAttributes() ?>><?php echo $employment_view->ThirdParties->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_view->PayrollCode->Visible) { // PayrollCode ?>
	<tr id="r_PayrollCode">
		<td class="<?php echo $employment_view->TableLeftColumnClass ?>"><span id="elh_employment_PayrollCode"><?php echo $employment_view->PayrollCode->caption() ?></span></td>
		<td data-name="PayrollCode" <?php echo $employment_view->PayrollCode->cellAttributes() ?>>
<span id="el_employment_PayrollCode">
<span<?php echo $employment_view->PayrollCode->viewAttributes() ?>><?php echo $employment_view->PayrollCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_view->DateOfConfirmation->Visible) { // DateOfConfirmation ?>
	<tr id="r_DateOfConfirmation">
		<td class="<?php echo $employment_view->TableLeftColumnClass ?>"><span id="elh_employment_DateOfConfirmation"><?php echo $employment_view->DateOfConfirmation->caption() ?></span></td>
		<td data-name="DateOfConfirmation" <?php echo $employment_view->DateOfConfirmation->cellAttributes() ?>>
<span id="el_employment_DateOfConfirmation">
<span<?php echo $employment_view->DateOfConfirmation->viewAttributes() ?>><?php echo $employment_view->DateOfConfirmation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$employment_view->IsModal) { ?>
<?php if (!$employment_view->isExport()) { ?>
<?php echo $employment_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("leave_record", explode(",", $employment->getCurrentDetailTable())) && $leave_record->DetailView) {
?>
<?php if ($employment->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("leave_record", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "leave_recordgrid.php" ?>
<?php } ?>
<?php
	if (in_array("leave_taken", explode(",", $employment->getCurrentDetailTable())) && $leave_taken->DetailView) {
?>
<?php if ($employment->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("leave_taken", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "leave_takengrid.php" ?>
<?php } ?>
<?php
	if (in_array("employee_obligation", explode(",", $employment->getCurrentDetailTable())) && $employee_obligation->DetailView) {
?>
<?php if ($employment->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("employee_obligation", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "employee_obligationgrid.php" ?>
<?php } ?>
<?php
	if (in_array("employee_income", explode(",", $employment->getCurrentDetailTable())) && $employee_income->DetailView) {
?>
<?php if ($employment->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("employee_income", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "employee_incomegrid.php" ?>
<?php } ?>
</form>
<?php
$employment_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$employment_view->isExport()) { ?>
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
$employment_view->terminate();
?>