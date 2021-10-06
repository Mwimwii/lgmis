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
$budget_actual_view = new budget_actual_view();

// Run the page
$budget_actual_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$budget_actual_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$budget_actual_view->isExport()) { ?>
<script>
var fbudget_actualview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fbudget_actualview = currentForm = new ew.Form("fbudget_actualview", "view");
	loadjs.done("fbudget_actualview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$budget_actual_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $budget_actual_view->ExportOptions->render("body") ?>
<?php $budget_actual_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $budget_actual_view->showPageHeader(); ?>
<?php
$budget_actual_view->showMessage();
?>
<?php if (!$budget_actual_view->IsModal) { ?>
<?php if (!$budget_actual_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $budget_actual_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fbudget_actualview" id="fbudget_actualview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="budget_actual">
<input type="hidden" name="modal" value="<?php echo (int)$budget_actual_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($budget_actual_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $budget_actual_view->TableLeftColumnClass ?>"><span id="elh_budget_actual_LACode"><?php echo $budget_actual_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $budget_actual_view->LACode->cellAttributes() ?>>
<span id="el_budget_actual_LACode">
<span<?php echo $budget_actual_view->LACode->viewAttributes() ?>><?php echo $budget_actual_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_actual_view->DepartmentCode->Visible) { // DepartmentCode ?>
	<tr id="r_DepartmentCode">
		<td class="<?php echo $budget_actual_view->TableLeftColumnClass ?>"><span id="elh_budget_actual_DepartmentCode"><?php echo $budget_actual_view->DepartmentCode->caption() ?></span></td>
		<td data-name="DepartmentCode" <?php echo $budget_actual_view->DepartmentCode->cellAttributes() ?>>
<span id="el_budget_actual_DepartmentCode">
<span<?php echo $budget_actual_view->DepartmentCode->viewAttributes() ?>><?php echo $budget_actual_view->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_actual_view->SectionCode->Visible) { // SectionCode ?>
	<tr id="r_SectionCode">
		<td class="<?php echo $budget_actual_view->TableLeftColumnClass ?>"><span id="elh_budget_actual_SectionCode"><?php echo $budget_actual_view->SectionCode->caption() ?></span></td>
		<td data-name="SectionCode" <?php echo $budget_actual_view->SectionCode->cellAttributes() ?>>
<span id="el_budget_actual_SectionCode">
<span<?php echo $budget_actual_view->SectionCode->viewAttributes() ?>><?php echo $budget_actual_view->SectionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_actual_view->AccountCode->Visible) { // AccountCode ?>
	<tr id="r_AccountCode">
		<td class="<?php echo $budget_actual_view->TableLeftColumnClass ?>"><span id="elh_budget_actual_AccountCode"><?php echo $budget_actual_view->AccountCode->caption() ?></span></td>
		<td data-name="AccountCode" <?php echo $budget_actual_view->AccountCode->cellAttributes() ?>>
<span id="el_budget_actual_AccountCode">
<span<?php echo $budget_actual_view->AccountCode->viewAttributes() ?>><?php echo $budget_actual_view->AccountCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_actual_view->PostingDate->Visible) { // PostingDate ?>
	<tr id="r_PostingDate">
		<td class="<?php echo $budget_actual_view->TableLeftColumnClass ?>"><span id="elh_budget_actual_PostingDate"><?php echo $budget_actual_view->PostingDate->caption() ?></span></td>
		<td data-name="PostingDate" <?php echo $budget_actual_view->PostingDate->cellAttributes() ?>>
<span id="el_budget_actual_PostingDate">
<span<?php echo $budget_actual_view->PostingDate->viewAttributes() ?>><?php echo $budget_actual_view->PostingDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_actual_view->AccountMonth->Visible) { // AccountMonth ?>
	<tr id="r_AccountMonth">
		<td class="<?php echo $budget_actual_view->TableLeftColumnClass ?>"><span id="elh_budget_actual_AccountMonth"><?php echo $budget_actual_view->AccountMonth->caption() ?></span></td>
		<td data-name="AccountMonth" <?php echo $budget_actual_view->AccountMonth->cellAttributes() ?>>
<span id="el_budget_actual_AccountMonth">
<span<?php echo $budget_actual_view->AccountMonth->viewAttributes() ?>><?php echo $budget_actual_view->AccountMonth->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_actual_view->AccountYear->Visible) { // AccountYear ?>
	<tr id="r_AccountYear">
		<td class="<?php echo $budget_actual_view->TableLeftColumnClass ?>"><span id="elh_budget_actual_AccountYear"><?php echo $budget_actual_view->AccountYear->caption() ?></span></td>
		<td data-name="AccountYear" <?php echo $budget_actual_view->AccountYear->cellAttributes() ?>>
<span id="el_budget_actual_AccountYear">
<span<?php echo $budget_actual_view->AccountYear->viewAttributes() ?>><?php echo $budget_actual_view->AccountYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_actual_view->BudgetEstimate->Visible) { // BudgetEstimate ?>
	<tr id="r_BudgetEstimate">
		<td class="<?php echo $budget_actual_view->TableLeftColumnClass ?>"><span id="elh_budget_actual_BudgetEstimate"><?php echo $budget_actual_view->BudgetEstimate->caption() ?></span></td>
		<td data-name="BudgetEstimate" <?php echo $budget_actual_view->BudgetEstimate->cellAttributes() ?>>
<span id="el_budget_actual_BudgetEstimate">
<span<?php echo $budget_actual_view->BudgetEstimate->viewAttributes() ?>><?php echo $budget_actual_view->BudgetEstimate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_actual_view->ActualAmount->Visible) { // ActualAmount ?>
	<tr id="r_ActualAmount">
		<td class="<?php echo $budget_actual_view->TableLeftColumnClass ?>"><span id="elh_budget_actual_ActualAmount"><?php echo $budget_actual_view->ActualAmount->caption() ?></span></td>
		<td data-name="ActualAmount" <?php echo $budget_actual_view->ActualAmount->cellAttributes() ?>>
<span id="el_budget_actual_ActualAmount">
<span<?php echo $budget_actual_view->ActualAmount->viewAttributes() ?>><?php echo $budget_actual_view->ActualAmount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($budget_actual_view->ForecastAmount->Visible) { // ForecastAmount ?>
	<tr id="r_ForecastAmount">
		<td class="<?php echo $budget_actual_view->TableLeftColumnClass ?>"><span id="elh_budget_actual_ForecastAmount"><?php echo $budget_actual_view->ForecastAmount->caption() ?></span></td>
		<td data-name="ForecastAmount" <?php echo $budget_actual_view->ForecastAmount->cellAttributes() ?>>
<span id="el_budget_actual_ForecastAmount">
<span<?php echo $budget_actual_view->ForecastAmount->viewAttributes() ?>><?php echo $budget_actual_view->ForecastAmount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$budget_actual_view->IsModal) { ?>
<?php if (!$budget_actual_view->isExport()) { ?>
<?php echo $budget_actual_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$budget_actual_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$budget_actual_view->isExport()) { ?>
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
$budget_actual_view->terminate();
?>