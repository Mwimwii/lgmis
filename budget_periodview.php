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
$budget_period_view = new budget_period_view();

// Run the page
$budget_period_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$budget_period_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$budget_period_view->isExport()) { ?>
<script>
var fbudget_periodview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fbudget_periodview = currentForm = new ew.Form("fbudget_periodview", "view");
	loadjs.done("fbudget_periodview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$budget_period_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $budget_period_view->ExportOptions->render("body") ?>
<?php $budget_period_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $budget_period_view->showPageHeader(); ?>
<?php
$budget_period_view->showMessage();
?>
<?php if (!$budget_period_view->IsModal) { ?>
<?php if (!$budget_period_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $budget_period_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fbudget_periodview" id="fbudget_periodview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="budget_period">
<input type="hidden" name="modal" value="<?php echo (int)$budget_period_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($budget_period_view->FiscalYear->Visible) { // FiscalYear ?>
	<tr id="r_FiscalYear">
		<td class="<?php echo $budget_period_view->TableLeftColumnClass ?>"><span id="elh_budget_period_FiscalYear"><?php echo $budget_period_view->FiscalYear->caption() ?></span></td>
		<td data-name="FiscalYear" <?php echo $budget_period_view->FiscalYear->cellAttributes() ?>>
<span id="el_budget_period_FiscalYear">
<span<?php echo $budget_period_view->FiscalYear->viewAttributes() ?>><?php echo $budget_period_view->FiscalYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_period_view->StartDate->Visible) { // StartDate ?>
	<tr id="r_StartDate">
		<td class="<?php echo $budget_period_view->TableLeftColumnClass ?>"><span id="elh_budget_period_StartDate"><?php echo $budget_period_view->StartDate->caption() ?></span></td>
		<td data-name="StartDate" <?php echo $budget_period_view->StartDate->cellAttributes() ?>>
<span id="el_budget_period_StartDate">
<span<?php echo $budget_period_view->StartDate->viewAttributes() ?>><?php echo $budget_period_view->StartDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_period_view->EndDate->Visible) { // EndDate ?>
	<tr id="r_EndDate">
		<td class="<?php echo $budget_period_view->TableLeftColumnClass ?>"><span id="elh_budget_period_EndDate"><?php echo $budget_period_view->EndDate->caption() ?></span></td>
		<td data-name="EndDate" <?php echo $budget_period_view->EndDate->cellAttributes() ?>>
<span id="el_budget_period_EndDate">
<span<?php echo $budget_period_view->EndDate->viewAttributes() ?>><?php echo $budget_period_view->EndDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_period_view->CurrentPeriod->Visible) { // CurrentPeriod ?>
	<tr id="r_CurrentPeriod">
		<td class="<?php echo $budget_period_view->TableLeftColumnClass ?>"><span id="elh_budget_period_CurrentPeriod"><?php echo $budget_period_view->CurrentPeriod->caption() ?></span></td>
		<td data-name="CurrentPeriod" <?php echo $budget_period_view->CurrentPeriod->cellAttributes() ?>>
<span id="el_budget_period_CurrentPeriod">
<span<?php echo $budget_period_view->CurrentPeriod->viewAttributes() ?>><?php echo $budget_period_view->CurrentPeriod->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_period_view->PeriodDescription->Visible) { // PeriodDescription ?>
	<tr id="r_PeriodDescription">
		<td class="<?php echo $budget_period_view->TableLeftColumnClass ?>"><span id="elh_budget_period_PeriodDescription"><?php echo $budget_period_view->PeriodDescription->caption() ?></span></td>
		<td data-name="PeriodDescription" <?php echo $budget_period_view->PeriodDescription->cellAttributes() ?>>
<span id="el_budget_period_PeriodDescription">
<span<?php echo $budget_period_view->PeriodDescription->viewAttributes() ?>><?php echo $budget_period_view->PeriodDescription->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$budget_period_view->IsModal) { ?>
<?php if (!$budget_period_view->isExport()) { ?>
<?php echo $budget_period_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$budget_period_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$budget_period_view->isExport()) { ?>
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
$budget_period_view->terminate();
?>