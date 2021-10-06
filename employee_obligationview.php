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
$employee_obligation_view = new employee_obligation_view();

// Run the page
$employee_obligation_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_obligation_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$employee_obligation_view->isExport()) { ?>
<script>
var femployee_obligationview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	femployee_obligationview = currentForm = new ew.Form("femployee_obligationview", "view");
	loadjs.done("femployee_obligationview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$employee_obligation_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $employee_obligation_view->ExportOptions->render("body") ?>
<?php $employee_obligation_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $employee_obligation_view->showPageHeader(); ?>
<?php
$employee_obligation_view->showMessage();
?>
<?php if (!$employee_obligation_view->IsModal) { ?>
<?php if (!$employee_obligation_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employee_obligation_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="femployee_obligationview" id="femployee_obligationview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employee_obligation">
<input type="hidden" name="modal" value="<?php echo (int)$employee_obligation_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($employee_obligation_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $employee_obligation_view->TableLeftColumnClass ?>"><span id="elh_employee_obligation_EmployeeID"><?php echo $employee_obligation_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $employee_obligation_view->EmployeeID->cellAttributes() ?>>
<span id="el_employee_obligation_EmployeeID">
<span<?php echo $employee_obligation_view->EmployeeID->viewAttributes() ?>><?php echo $employee_obligation_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_obligation_view->PaidPosition->Visible) { // PaidPosition ?>
	<tr id="r_PaidPosition">
		<td class="<?php echo $employee_obligation_view->TableLeftColumnClass ?>"><span id="elh_employee_obligation_PaidPosition"><?php echo $employee_obligation_view->PaidPosition->caption() ?></span></td>
		<td data-name="PaidPosition" <?php echo $employee_obligation_view->PaidPosition->cellAttributes() ?>>
<span id="el_employee_obligation_PaidPosition">
<span<?php echo $employee_obligation_view->PaidPosition->viewAttributes() ?>><?php echo $employee_obligation_view->PaidPosition->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_obligation_view->PayrollDate->Visible) { // PayrollDate ?>
	<tr id="r_PayrollDate">
		<td class="<?php echo $employee_obligation_view->TableLeftColumnClass ?>"><span id="elh_employee_obligation_PayrollDate"><?php echo $employee_obligation_view->PayrollDate->caption() ?></span></td>
		<td data-name="PayrollDate" <?php echo $employee_obligation_view->PayrollDate->cellAttributes() ?>>
<span id="el_employee_obligation_PayrollDate">
<span<?php echo $employee_obligation_view->PayrollDate->viewAttributes() ?>><?php echo $employee_obligation_view->PayrollDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_obligation_view->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<tr id="r_PayrollPeriod">
		<td class="<?php echo $employee_obligation_view->TableLeftColumnClass ?>"><span id="elh_employee_obligation_PayrollPeriod"><?php echo $employee_obligation_view->PayrollPeriod->caption() ?></span></td>
		<td data-name="PayrollPeriod" <?php echo $employee_obligation_view->PayrollPeriod->cellAttributes() ?>>
<span id="el_employee_obligation_PayrollPeriod">
<span<?php echo $employee_obligation_view->PayrollPeriod->viewAttributes() ?>><?php echo $employee_obligation_view->PayrollPeriod->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_obligation_view->StartDate->Visible) { // StartDate ?>
	<tr id="r_StartDate">
		<td class="<?php echo $employee_obligation_view->TableLeftColumnClass ?>"><span id="elh_employee_obligation_StartDate"><?php echo $employee_obligation_view->StartDate->caption() ?></span></td>
		<td data-name="StartDate" <?php echo $employee_obligation_view->StartDate->cellAttributes() ?>>
<span id="el_employee_obligation_StartDate">
<span<?php echo $employee_obligation_view->StartDate->viewAttributes() ?>><?php echo $employee_obligation_view->StartDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_obligation_view->Enddate->Visible) { // Enddate ?>
	<tr id="r_Enddate">
		<td class="<?php echo $employee_obligation_view->TableLeftColumnClass ?>"><span id="elh_employee_obligation_Enddate"><?php echo $employee_obligation_view->Enddate->caption() ?></span></td>
		<td data-name="Enddate" <?php echo $employee_obligation_view->Enddate->cellAttributes() ?>>
<span id="el_employee_obligation_Enddate">
<span<?php echo $employee_obligation_view->Enddate->viewAttributes() ?>><?php echo $employee_obligation_view->Enddate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_obligation_view->ObligationCode->Visible) { // ObligationCode ?>
	<tr id="r_ObligationCode">
		<td class="<?php echo $employee_obligation_view->TableLeftColumnClass ?>"><span id="elh_employee_obligation_ObligationCode"><?php echo $employee_obligation_view->ObligationCode->caption() ?></span></td>
		<td data-name="ObligationCode" <?php echo $employee_obligation_view->ObligationCode->cellAttributes() ?>>
<span id="el_employee_obligation_ObligationCode">
<span<?php echo $employee_obligation_view->ObligationCode->viewAttributes() ?>><?php echo $employee_obligation_view->ObligationCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_obligation_view->ObligationAmount->Visible) { // ObligationAmount ?>
	<tr id="r_ObligationAmount">
		<td class="<?php echo $employee_obligation_view->TableLeftColumnClass ?>"><span id="elh_employee_obligation_ObligationAmount"><?php echo $employee_obligation_view->ObligationAmount->caption() ?></span></td>
		<td data-name="ObligationAmount" <?php echo $employee_obligation_view->ObligationAmount->cellAttributes() ?>>
<span id="el_employee_obligation_ObligationAmount">
<span<?php echo $employee_obligation_view->ObligationAmount->viewAttributes() ?>><?php echo $employee_obligation_view->ObligationAmount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_obligation_view->Remarks->Visible) { // Remarks ?>
	<tr id="r_Remarks">
		<td class="<?php echo $employee_obligation_view->TableLeftColumnClass ?>"><span id="elh_employee_obligation_Remarks"><?php echo $employee_obligation_view->Remarks->caption() ?></span></td>
		<td data-name="Remarks" <?php echo $employee_obligation_view->Remarks->cellAttributes() ?>>
<span id="el_employee_obligation_Remarks">
<span<?php echo $employee_obligation_view->Remarks->viewAttributes() ?>><?php echo $employee_obligation_view->Remarks->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$employee_obligation_view->IsModal) { ?>
<?php if (!$employee_obligation_view->isExport()) { ?>
<?php echo $employee_obligation_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$employee_obligation_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$employee_obligation_view->isExport()) { ?>
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
$employee_obligation_view->terminate();
?>