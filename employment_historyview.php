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
$employment_history_view = new employment_history_view();

// Run the page
$employment_history_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_history_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$employment_history_view->isExport()) { ?>
<script>
var femployment_historyview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	femployment_historyview = currentForm = new ew.Form("femployment_historyview", "view");
	loadjs.done("femployment_historyview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$employment_history_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $employment_history_view->ExportOptions->render("body") ?>
<?php $employment_history_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $employment_history_view->showPageHeader(); ?>
<?php
$employment_history_view->showMessage();
?>
<?php if (!$employment_history_view->IsModal) { ?>
<?php if (!$employment_history_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employment_history_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="femployment_historyview" id="femployment_historyview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employment_history">
<input type="hidden" name="modal" value="<?php echo (int)$employment_history_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($employment_history_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $employment_history_view->TableLeftColumnClass ?>"><span id="elh_employment_history_EmployeeID"><?php echo $employment_history_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $employment_history_view->EmployeeID->cellAttributes() ?>>
<span id="el_employment_history_EmployeeID">
<span<?php echo $employment_history_view->EmployeeID->viewAttributes() ?>><?php echo $employment_history_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_history_view->Position->Visible) { // Position ?>
	<tr id="r_Position">
		<td class="<?php echo $employment_history_view->TableLeftColumnClass ?>"><span id="elh_employment_history_Position"><?php echo $employment_history_view->Position->caption() ?></span></td>
		<td data-name="Position" <?php echo $employment_history_view->Position->cellAttributes() ?>>
<span id="el_employment_history_Position">
<span<?php echo $employment_history_view->Position->viewAttributes() ?>><?php echo $employment_history_view->Position->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_history_view->DateOfAppointment->Visible) { // DateOfAppointment ?>
	<tr id="r_DateOfAppointment">
		<td class="<?php echo $employment_history_view->TableLeftColumnClass ?>"><span id="elh_employment_history_DateOfAppointment"><?php echo $employment_history_view->DateOfAppointment->caption() ?></span></td>
		<td data-name="DateOfAppointment" <?php echo $employment_history_view->DateOfAppointment->cellAttributes() ?>>
<span id="el_employment_history_DateOfAppointment">
<span<?php echo $employment_history_view->DateOfAppointment->viewAttributes() ?>><?php echo $employment_history_view->DateOfAppointment->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_history_view->DateOfExit->Visible) { // DateOfExit ?>
	<tr id="r_DateOfExit">
		<td class="<?php echo $employment_history_view->TableLeftColumnClass ?>"><span id="elh_employment_history_DateOfExit"><?php echo $employment_history_view->DateOfExit->caption() ?></span></td>
		<td data-name="DateOfExit" <?php echo $employment_history_view->DateOfExit->cellAttributes() ?>>
<span id="el_employment_history_DateOfExit">
<span<?php echo $employment_history_view->DateOfExit->viewAttributes() ?>><?php echo $employment_history_view->DateOfExit->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_history_view->SalaryScale->Visible) { // SalaryScale ?>
	<tr id="r_SalaryScale">
		<td class="<?php echo $employment_history_view->TableLeftColumnClass ?>"><span id="elh_employment_history_SalaryScale"><?php echo $employment_history_view->SalaryScale->caption() ?></span></td>
		<td data-name="SalaryScale" <?php echo $employment_history_view->SalaryScale->cellAttributes() ?>>
<span id="el_employment_history_SalaryScale">
<span<?php echo $employment_history_view->SalaryScale->viewAttributes() ?>><?php echo $employment_history_view->SalaryScale->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_history_view->EmploymentType->Visible) { // EmploymentType ?>
	<tr id="r_EmploymentType">
		<td class="<?php echo $employment_history_view->TableLeftColumnClass ?>"><span id="elh_employment_history_EmploymentType"><?php echo $employment_history_view->EmploymentType->caption() ?></span></td>
		<td data-name="EmploymentType" <?php echo $employment_history_view->EmploymentType->cellAttributes() ?>>
<span id="el_employment_history_EmploymentType">
<span<?php echo $employment_history_view->EmploymentType->viewAttributes() ?>><?php echo $employment_history_view->EmploymentType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_history_view->EmploymentStatus->Visible) { // EmploymentStatus ?>
	<tr id="r_EmploymentStatus">
		<td class="<?php echo $employment_history_view->TableLeftColumnClass ?>"><span id="elh_employment_history_EmploymentStatus"><?php echo $employment_history_view->EmploymentStatus->caption() ?></span></td>
		<td data-name="EmploymentStatus" <?php echo $employment_history_view->EmploymentStatus->cellAttributes() ?>>
<span id="el_employment_history_EmploymentStatus">
<span<?php echo $employment_history_view->EmploymentStatus->viewAttributes() ?>><?php echo $employment_history_view->EmploymentStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_history_view->ExitReason->Visible) { // ExitReason ?>
	<tr id="r_ExitReason">
		<td class="<?php echo $employment_history_view->TableLeftColumnClass ?>"><span id="elh_employment_history_ExitReason"><?php echo $employment_history_view->ExitReason->caption() ?></span></td>
		<td data-name="ExitReason" <?php echo $employment_history_view->ExitReason->cellAttributes() ?>>
<span id="el_employment_history_ExitReason">
<span<?php echo $employment_history_view->ExitReason->viewAttributes() ?>><?php echo $employment_history_view->ExitReason->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employment_history_view->RetirementType->Visible) { // RetirementType ?>
	<tr id="r_RetirementType">
		<td class="<?php echo $employment_history_view->TableLeftColumnClass ?>"><span id="elh_employment_history_RetirementType"><?php echo $employment_history_view->RetirementType->caption() ?></span></td>
		<td data-name="RetirementType" <?php echo $employment_history_view->RetirementType->cellAttributes() ?>>
<span id="el_employment_history_RetirementType">
<span<?php echo $employment_history_view->RetirementType->viewAttributes() ?>><?php echo $employment_history_view->RetirementType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$employment_history_view->IsModal) { ?>
<?php if (!$employment_history_view->isExport()) { ?>
<?php echo $employment_history_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$employment_history_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$employment_history_view->isExport()) { ?>
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
$employment_history_view->terminate();
?>