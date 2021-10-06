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
$employment_acting_view = new employment_acting_view();

// Run the page
$employment_acting_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_acting_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$employment_acting_view->isExport()) { ?>
<script>
var femployment_actingview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	femployment_actingview = currentForm = new ew.Form("femployment_actingview", "view");
	loadjs.done("femployment_actingview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$employment_acting_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $employment_acting_view->ExportOptions->render("body") ?>
<?php $employment_acting_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $employment_acting_view->showPageHeader(); ?>
<?php
$employment_acting_view->showMessage();
?>
<?php if (!$employment_acting_view->IsModal) { ?>
<?php if (!$employment_acting_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employment_acting_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="femployment_actingview" id="femployment_actingview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employment_acting">
<input type="hidden" name="modal" value="<?php echo (int)$employment_acting_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($employment_acting_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $employment_acting_view->TableLeftColumnClass ?>"><span id="elh_employment_acting_EmployeeID"><?php echo $employment_acting_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $employment_acting_view->EmployeeID->cellAttributes() ?>>
<span id="el_employment_acting_EmployeeID">
<span<?php echo $employment_acting_view->EmployeeID->viewAttributes() ?>><?php echo $employment_acting_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_acting_view->ProvinceCode->Visible) { // ProvinceCode ?>
	<tr id="r_ProvinceCode">
		<td class="<?php echo $employment_acting_view->TableLeftColumnClass ?>"><span id="elh_employment_acting_ProvinceCode"><?php echo $employment_acting_view->ProvinceCode->caption() ?></span></td>
		<td data-name="ProvinceCode" <?php echo $employment_acting_view->ProvinceCode->cellAttributes() ?>>
<span id="el_employment_acting_ProvinceCode">
<span<?php echo $employment_acting_view->ProvinceCode->viewAttributes() ?>><?php echo $employment_acting_view->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_acting_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $employment_acting_view->TableLeftColumnClass ?>"><span id="elh_employment_acting_LACode"><?php echo $employment_acting_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $employment_acting_view->LACode->cellAttributes() ?>>
<span id="el_employment_acting_LACode">
<span<?php echo $employment_acting_view->LACode->viewAttributes() ?>><?php echo $employment_acting_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_acting_view->DepartmentCode->Visible) { // DepartmentCode ?>
	<tr id="r_DepartmentCode">
		<td class="<?php echo $employment_acting_view->TableLeftColumnClass ?>"><span id="elh_employment_acting_DepartmentCode"><?php echo $employment_acting_view->DepartmentCode->caption() ?></span></td>
		<td data-name="DepartmentCode" <?php echo $employment_acting_view->DepartmentCode->cellAttributes() ?>>
<span id="el_employment_acting_DepartmentCode">
<span<?php echo $employment_acting_view->DepartmentCode->viewAttributes() ?>><?php echo $employment_acting_view->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_acting_view->SectionCode->Visible) { // SectionCode ?>
	<tr id="r_SectionCode">
		<td class="<?php echo $employment_acting_view->TableLeftColumnClass ?>"><span id="elh_employment_acting_SectionCode"><?php echo $employment_acting_view->SectionCode->caption() ?></span></td>
		<td data-name="SectionCode" <?php echo $employment_acting_view->SectionCode->cellAttributes() ?>>
<span id="el_employment_acting_SectionCode">
<span<?php echo $employment_acting_view->SectionCode->viewAttributes() ?>><?php echo $employment_acting_view->SectionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_acting_view->ActingPosition->Visible) { // ActingPosition ?>
	<tr id="r_ActingPosition">
		<td class="<?php echo $employment_acting_view->TableLeftColumnClass ?>"><span id="elh_employment_acting_ActingPosition"><?php echo $employment_acting_view->ActingPosition->caption() ?></span></td>
		<td data-name="ActingPosition" <?php echo $employment_acting_view->ActingPosition->cellAttributes() ?>>
<span id="el_employment_acting_ActingPosition">
<span<?php echo $employment_acting_view->ActingPosition->viewAttributes() ?>><?php echo $employment_acting_view->ActingPosition->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_acting_view->DateOfActingAppointment->Visible) { // DateOfActingAppointment ?>
	<tr id="r_DateOfActingAppointment">
		<td class="<?php echo $employment_acting_view->TableLeftColumnClass ?>"><span id="elh_employment_acting_DateOfActingAppointment"><?php echo $employment_acting_view->DateOfActingAppointment->caption() ?></span></td>
		<td data-name="DateOfActingAppointment" <?php echo $employment_acting_view->DateOfActingAppointment->cellAttributes() ?>>
<span id="el_employment_acting_DateOfActingAppointment">
<span<?php echo $employment_acting_view->DateOfActingAppointment->viewAttributes() ?>><?php echo $employment_acting_view->DateOfActingAppointment->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_acting_view->EndDateOfActingPeriod->Visible) { // EndDateOfActingPeriod ?>
	<tr id="r_EndDateOfActingPeriod">
		<td class="<?php echo $employment_acting_view->TableLeftColumnClass ?>"><span id="elh_employment_acting_EndDateOfActingPeriod"><?php echo $employment_acting_view->EndDateOfActingPeriod->caption() ?></span></td>
		<td data-name="EndDateOfActingPeriod" <?php echo $employment_acting_view->EndDateOfActingPeriod->cellAttributes() ?>>
<span id="el_employment_acting_EndDateOfActingPeriod">
<span<?php echo $employment_acting_view->EndDateOfActingPeriod->viewAttributes() ?>><?php echo $employment_acting_view->EndDateOfActingPeriod->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_acting_view->SalaryScale->Visible) { // SalaryScale ?>
	<tr id="r_SalaryScale">
		<td class="<?php echo $employment_acting_view->TableLeftColumnClass ?>"><span id="elh_employment_acting_SalaryScale"><?php echo $employment_acting_view->SalaryScale->caption() ?></span></td>
		<td data-name="SalaryScale" <?php echo $employment_acting_view->SalaryScale->cellAttributes() ?>>
<span id="el_employment_acting_SalaryScale">
<span<?php echo $employment_acting_view->SalaryScale->viewAttributes() ?>><?php echo $employment_acting_view->SalaryScale->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_acting_view->ActingType->Visible) { // ActingType ?>
	<tr id="r_ActingType">
		<td class="<?php echo $employment_acting_view->TableLeftColumnClass ?>"><span id="elh_employment_acting_ActingType"><?php echo $employment_acting_view->ActingType->caption() ?></span></td>
		<td data-name="ActingType" <?php echo $employment_acting_view->ActingType->cellAttributes() ?>>
<span id="el_employment_acting_ActingType">
<span<?php echo $employment_acting_view->ActingType->viewAttributes() ?>><?php echo $employment_acting_view->ActingType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_acting_view->ActingStatus->Visible) { // ActingStatus ?>
	<tr id="r_ActingStatus">
		<td class="<?php echo $employment_acting_view->TableLeftColumnClass ?>"><span id="elh_employment_acting_ActingStatus"><?php echo $employment_acting_view->ActingStatus->caption() ?></span></td>
		<td data-name="ActingStatus" <?php echo $employment_acting_view->ActingStatus->cellAttributes() ?>>
<span id="el_employment_acting_ActingStatus">
<span<?php echo $employment_acting_view->ActingStatus->viewAttributes() ?>><?php echo $employment_acting_view->ActingStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_acting_view->ActingReason->Visible) { // ActingReason ?>
	<tr id="r_ActingReason">
		<td class="<?php echo $employment_acting_view->TableLeftColumnClass ?>"><span id="elh_employment_acting_ActingReason"><?php echo $employment_acting_view->ActingReason->caption() ?></span></td>
		<td data-name="ActingReason" <?php echo $employment_acting_view->ActingReason->cellAttributes() ?>>
<span id="el_employment_acting_ActingReason">
<span<?php echo $employment_acting_view->ActingReason->viewAttributes() ?>><?php echo $employment_acting_view->ActingReason->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$employment_acting_view->IsModal) { ?>
<?php if (!$employment_acting_view->isExport()) { ?>
<?php echo $employment_acting_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$employment_acting_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$employment_acting_view->isExport()) { ?>
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
$employment_acting_view->terminate();
?>