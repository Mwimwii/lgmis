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
$employee_income_view = new employee_income_view();

// Run the page
$employee_income_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_income_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$employee_income_view->isExport()) { ?>
<script>
var femployee_incomeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	femployee_incomeview = currentForm = new ew.Form("femployee_incomeview", "view");
	loadjs.done("femployee_incomeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$employee_income_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $employee_income_view->ExportOptions->render("body") ?>
<?php $employee_income_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $employee_income_view->showPageHeader(); ?>
<?php
$employee_income_view->showMessage();
?>
<?php if (!$employee_income_view->IsModal) { ?>
<?php if (!$employee_income_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employee_income_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="femployee_incomeview" id="femployee_incomeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employee_income">
<input type="hidden" name="modal" value="<?php echo (int)$employee_income_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($employee_income_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $employee_income_view->TableLeftColumnClass ?>"><span id="elh_employee_income_EmployeeID"><?php echo $employee_income_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $employee_income_view->EmployeeID->cellAttributes() ?>>
<span id="el_employee_income_EmployeeID">
<span<?php echo $employee_income_view->EmployeeID->viewAttributes() ?>><?php echo $employee_income_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_income_view->PaidPosition->Visible) { // PaidPosition ?>
	<tr id="r_PaidPosition">
		<td class="<?php echo $employee_income_view->TableLeftColumnClass ?>"><span id="elh_employee_income_PaidPosition"><?php echo $employee_income_view->PaidPosition->caption() ?></span></td>
		<td data-name="PaidPosition" <?php echo $employee_income_view->PaidPosition->cellAttributes() ?>>
<span id="el_employee_income_PaidPosition">
<span<?php echo $employee_income_view->PaidPosition->viewAttributes() ?>><?php echo $employee_income_view->PaidPosition->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_income_view->PayrollDate->Visible) { // PayrollDate ?>
	<tr id="r_PayrollDate">
		<td class="<?php echo $employee_income_view->TableLeftColumnClass ?>"><span id="elh_employee_income_PayrollDate"><?php echo $employee_income_view->PayrollDate->caption() ?></span></td>
		<td data-name="PayrollDate" <?php echo $employee_income_view->PayrollDate->cellAttributes() ?>>
<span id="el_employee_income_PayrollDate">
<span<?php echo $employee_income_view->PayrollDate->viewAttributes() ?>><?php echo $employee_income_view->PayrollDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_income_view->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<tr id="r_PayrollPeriod">
		<td class="<?php echo $employee_income_view->TableLeftColumnClass ?>"><span id="elh_employee_income_PayrollPeriod"><?php echo $employee_income_view->PayrollPeriod->caption() ?></span></td>
		<td data-name="PayrollPeriod" <?php echo $employee_income_view->PayrollPeriod->cellAttributes() ?>>
<span id="el_employee_income_PayrollPeriod">
<span<?php echo $employee_income_view->PayrollPeriod->viewAttributes() ?>><?php echo $employee_income_view->PayrollPeriod->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_income_view->StartDate->Visible) { // StartDate ?>
	<tr id="r_StartDate">
		<td class="<?php echo $employee_income_view->TableLeftColumnClass ?>"><span id="elh_employee_income_StartDate"><?php echo $employee_income_view->StartDate->caption() ?></span></td>
		<td data-name="StartDate" <?php echo $employee_income_view->StartDate->cellAttributes() ?>>
<span id="el_employee_income_StartDate">
<span<?php echo $employee_income_view->StartDate->viewAttributes() ?>><?php echo $employee_income_view->StartDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_income_view->EndDate->Visible) { // EndDate ?>
	<tr id="r_EndDate">
		<td class="<?php echo $employee_income_view->TableLeftColumnClass ?>"><span id="elh_employee_income_EndDate"><?php echo $employee_income_view->EndDate->caption() ?></span></td>
		<td data-name="EndDate" <?php echo $employee_income_view->EndDate->cellAttributes() ?>>
<span id="el_employee_income_EndDate">
<span<?php echo $employee_income_view->EndDate->viewAttributes() ?>><?php echo $employee_income_view->EndDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_income_view->IncomeCode->Visible) { // IncomeCode ?>
	<tr id="r_IncomeCode">
		<td class="<?php echo $employee_income_view->TableLeftColumnClass ?>"><span id="elh_employee_income_IncomeCode"><?php echo $employee_income_view->IncomeCode->caption() ?></span></td>
		<td data-name="IncomeCode" <?php echo $employee_income_view->IncomeCode->cellAttributes() ?>>
<span id="el_employee_income_IncomeCode">
<span<?php echo $employee_income_view->IncomeCode->viewAttributes() ?>><?php echo $employee_income_view->IncomeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_income_view->Income->Visible) { // Income ?>
	<tr id="r_Income">
		<td class="<?php echo $employee_income_view->TableLeftColumnClass ?>"><span id="elh_employee_income_Income"><?php echo $employee_income_view->Income->caption() ?></span></td>
		<td data-name="Income" <?php echo $employee_income_view->Income->cellAttributes() ?>>
<span id="el_employee_income_Income">
<span<?php echo $employee_income_view->Income->viewAttributes() ?>><?php echo $employee_income_view->Income->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_income_view->Remarks->Visible) { // Remarks ?>
	<tr id="r_Remarks">
		<td class="<?php echo $employee_income_view->TableLeftColumnClass ?>"><span id="elh_employee_income_Remarks"><?php echo $employee_income_view->Remarks->caption() ?></span></td>
		<td data-name="Remarks" <?php echo $employee_income_view->Remarks->cellAttributes() ?>>
<span id="el_employee_income_Remarks">
<span<?php echo $employee_income_view->Remarks->viewAttributes() ?>><?php echo $employee_income_view->Remarks->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employee_income_view->Taxable->Visible) { // Taxable ?>
	<tr id="r_Taxable">
		<td class="<?php echo $employee_income_view->TableLeftColumnClass ?>"><span id="elh_employee_income_Taxable"><?php echo $employee_income_view->Taxable->caption() ?></span></td>
		<td data-name="Taxable" <?php echo $employee_income_view->Taxable->cellAttributes() ?>>
<span id="el_employee_income_Taxable">
<span<?php echo $employee_income_view->Taxable->viewAttributes() ?>><?php echo $employee_income_view->Taxable->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$employee_income_view->IsModal) { ?>
<?php if (!$employee_income_view->isExport()) { ?>
<?php echo $employee_income_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$employee_income_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$employee_income_view->isExport()) { ?>
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
$employee_income_view->terminate();
?>