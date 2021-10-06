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
$salary_notch_view = new salary_notch_view();

// Run the page
$salary_notch_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$salary_notch_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$salary_notch_view->isExport()) { ?>
<script>
var fsalary_notchview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fsalary_notchview = currentForm = new ew.Form("fsalary_notchview", "view");
	loadjs.done("fsalary_notchview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$salary_notch_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $salary_notch_view->ExportOptions->render("body") ?>
<?php $salary_notch_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $salary_notch_view->showPageHeader(); ?>
<?php
$salary_notch_view->showMessage();
?>
<?php if (!$salary_notch_view->IsModal) { ?>
<?php if (!$salary_notch_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $salary_notch_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fsalary_notchview" id="fsalary_notchview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="salary_notch">
<input type="hidden" name="modal" value="<?php echo (int)$salary_notch_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($salary_notch_view->SalaryScale->Visible) { // SalaryScale ?>
	<tr id="r_SalaryScale">
		<td class="<?php echo $salary_notch_view->TableLeftColumnClass ?>"><span id="elh_salary_notch_SalaryScale"><?php echo $salary_notch_view->SalaryScale->caption() ?></span></td>
		<td data-name="SalaryScale" <?php echo $salary_notch_view->SalaryScale->cellAttributes() ?>>
<span id="el_salary_notch_SalaryScale">
<span<?php echo $salary_notch_view->SalaryScale->viewAttributes() ?>><?php echo $salary_notch_view->SalaryScale->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($salary_notch_view->Notch->Visible) { // Notch ?>
	<tr id="r_Notch">
		<td class="<?php echo $salary_notch_view->TableLeftColumnClass ?>"><span id="elh_salary_notch_Notch"><?php echo $salary_notch_view->Notch->caption() ?></span></td>
		<td data-name="Notch" <?php echo $salary_notch_view->Notch->cellAttributes() ?>>
<span id="el_salary_notch_Notch">
<span<?php echo $salary_notch_view->Notch->viewAttributes() ?>><?php echo $salary_notch_view->Notch->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($salary_notch_view->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
	<tr id="r_BasicMonthlySalary">
		<td class="<?php echo $salary_notch_view->TableLeftColumnClass ?>"><span id="elh_salary_notch_BasicMonthlySalary"><?php echo $salary_notch_view->BasicMonthlySalary->caption() ?></span></td>
		<td data-name="BasicMonthlySalary" <?php echo $salary_notch_view->BasicMonthlySalary->cellAttributes() ?>>
<span id="el_salary_notch_BasicMonthlySalary">
<span<?php echo $salary_notch_view->BasicMonthlySalary->viewAttributes() ?>><?php echo $salary_notch_view->BasicMonthlySalary->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($salary_notch_view->AnnualSalary->Visible) { // AnnualSalary ?>
	<tr id="r_AnnualSalary">
		<td class="<?php echo $salary_notch_view->TableLeftColumnClass ?>"><span id="elh_salary_notch_AnnualSalary"><?php echo $salary_notch_view->AnnualSalary->caption() ?></span></td>
		<td data-name="AnnualSalary" <?php echo $salary_notch_view->AnnualSalary->cellAttributes() ?>>
<span id="el_salary_notch_AnnualSalary">
<span<?php echo $salary_notch_view->AnnualSalary->viewAttributes() ?>><?php echo $salary_notch_view->AnnualSalary->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$salary_notch_view->IsModal) { ?>
<?php if (!$salary_notch_view->isExport()) { ?>
<?php echo $salary_notch_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$salary_notch_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$salary_notch_view->isExport()) { ?>
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
$salary_notch_view->terminate();
?>