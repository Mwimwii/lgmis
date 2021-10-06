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
$payroll_period_view = new payroll_period_view();

// Run the page
$payroll_period_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payroll_period_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$payroll_period_view->isExport()) { ?>
<script>
var fpayroll_periodview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpayroll_periodview = currentForm = new ew.Form("fpayroll_periodview", "view");
	loadjs.done("fpayroll_periodview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$payroll_period_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $payroll_period_view->ExportOptions->render("body") ?>
<?php $payroll_period_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $payroll_period_view->showPageHeader(); ?>
<?php
$payroll_period_view->showMessage();
?>
<?php if (!$payroll_period_view->IsModal) { ?>
<?php if (!$payroll_period_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payroll_period_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fpayroll_periodview" id="fpayroll_periodview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payroll_period">
<input type="hidden" name="modal" value="<?php echo (int)$payroll_period_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($payroll_period_view->PeriodCode->Visible) { // PeriodCode ?>
	<tr id="r_PeriodCode">
		<td class="<?php echo $payroll_period_view->TableLeftColumnClass ?>"><span id="elh_payroll_period_PeriodCode"><?php echo $payroll_period_view->PeriodCode->caption() ?></span></td>
		<td data-name="PeriodCode" <?php echo $payroll_period_view->PeriodCode->cellAttributes() ?>>
<span id="el_payroll_period_PeriodCode">
<span<?php echo $payroll_period_view->PeriodCode->viewAttributes() ?>><?php echo $payroll_period_view->PeriodCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payroll_period_view->FiscalYear->Visible) { // FiscalYear ?>
	<tr id="r_FiscalYear">
		<td class="<?php echo $payroll_period_view->TableLeftColumnClass ?>"><span id="elh_payroll_period_FiscalYear"><?php echo $payroll_period_view->FiscalYear->caption() ?></span></td>
		<td data-name="FiscalYear" <?php echo $payroll_period_view->FiscalYear->cellAttributes() ?>>
<span id="el_payroll_period_FiscalYear">
<span<?php echo $payroll_period_view->FiscalYear->viewAttributes() ?>><?php echo $payroll_period_view->FiscalYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payroll_period_view->RunMonth->Visible) { // RunMonth ?>
	<tr id="r_RunMonth">
		<td class="<?php echo $payroll_period_view->TableLeftColumnClass ?>"><span id="elh_payroll_period_RunMonth"><?php echo $payroll_period_view->RunMonth->caption() ?></span></td>
		<td data-name="RunMonth" <?php echo $payroll_period_view->RunMonth->cellAttributes() ?>>
<span id="el_payroll_period_RunMonth">
<span<?php echo $payroll_period_view->RunMonth->viewAttributes() ?>><?php echo $payroll_period_view->RunMonth->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payroll_period_view->RunDescription->Visible) { // RunDescription ?>
	<tr id="r_RunDescription">
		<td class="<?php echo $payroll_period_view->TableLeftColumnClass ?>"><span id="elh_payroll_period_RunDescription"><?php echo $payroll_period_view->RunDescription->caption() ?></span></td>
		<td data-name="RunDescription" <?php echo $payroll_period_view->RunDescription->cellAttributes() ?>>
<span id="el_payroll_period_RunDescription">
<span<?php echo $payroll_period_view->RunDescription->viewAttributes() ?>><?php echo $payroll_period_view->RunDescription->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payroll_period_view->CurrentPeriod->Visible) { // CurrentPeriod ?>
	<tr id="r_CurrentPeriod">
		<td class="<?php echo $payroll_period_view->TableLeftColumnClass ?>"><span id="elh_payroll_period_CurrentPeriod"><?php echo $payroll_period_view->CurrentPeriod->caption() ?></span></td>
		<td data-name="CurrentPeriod" <?php echo $payroll_period_view->CurrentPeriod->cellAttributes() ?>>
<span id="el_payroll_period_CurrentPeriod">
<span<?php echo $payroll_period_view->CurrentPeriod->viewAttributes() ?>><?php echo $payroll_period_view->CurrentPeriod->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$payroll_period_view->IsModal) { ?>
<?php if (!$payroll_period_view->isExport()) { ?>
<?php echo $payroll_period_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("employee_employer_schedule_view", explode(",", $payroll_period->getCurrentDetailTable())) && $employee_employer_schedule_view->DetailView) {
?>
<?php if ($payroll_period->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("employee_employer_schedule_view", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $payroll_period_view->employee_employer_schedule_view_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "employee_employer_schedule_viewgrid.php" ?>
<?php } ?>
<?php
	if (in_array("obligation_schedule_view", explode(",", $payroll_period->getCurrentDetailTable())) && $obligation_schedule_view->DetailView) {
?>
<?php if ($payroll_period->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("obligation_schedule_view", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $payroll_period_view->obligation_schedule_view_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "obligation_schedule_viewgrid.php" ?>
<?php } ?>
<?php
	if (in_array("deduction_schedule_view", explode(",", $payroll_period->getCurrentDetailTable())) && $deduction_schedule_view->DetailView) {
?>
<?php if ($payroll_period->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("deduction_schedule_view", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $payroll_period_view->deduction_schedule_view_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "deduction_schedule_viewgrid.php" ?>
<?php } ?>
<?php
	if (in_array("income_schedule_view", explode(",", $payroll_period->getCurrentDetailTable())) && $income_schedule_view->DetailView) {
?>
<?php if ($payroll_period->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("income_schedule_view", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $payroll_period_view->income_schedule_view_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "income_schedule_viewgrid.php" ?>
<?php } ?>
<?php
	if (in_array("monthly_run", explode(",", $payroll_period->getCurrentDetailTable())) && $monthly_run->DetailView) {
?>
<?php if ($payroll_period->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("monthly_run", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $payroll_period_view->monthly_run_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "monthly_rungrid.php" ?>
<?php } ?>
<?php
	if (in_array("payroll_summary_view", explode(",", $payroll_period->getCurrentDetailTable())) && $payroll_summary_view->DetailView) {
?>
<?php if ($payroll_period->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("payroll_summary_view", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $payroll_period_view->payroll_summary_view_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "payroll_summary_viewgrid.php" ?>
<?php } ?>
</form>
<?php
$payroll_period_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$payroll_period_view->isExport()) { ?>
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
$payroll_period_view->terminate();
?>