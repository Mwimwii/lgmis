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
$monthly_run_view = new monthly_run_view();

// Run the page
$monthly_run_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$monthly_run_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$monthly_run_view->isExport()) { ?>
<script>
var fmonthly_runview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fmonthly_runview = currentForm = new ew.Form("fmonthly_runview", "view");
	loadjs.done("fmonthly_runview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$monthly_run_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $monthly_run_view->ExportOptions->render("body") ?>
<?php $monthly_run_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $monthly_run_view->showPageHeader(); ?>
<?php
$monthly_run_view->showMessage();
?>
<?php if (!$monthly_run_view->IsModal) { ?>
<?php if (!$monthly_run_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $monthly_run_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fmonthly_runview" id="fmonthly_runview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="monthly_run">
<input type="hidden" name="modal" value="<?php echo (int)$monthly_run_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($monthly_run_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $monthly_run_view->TableLeftColumnClass ?>"><span id="elh_monthly_run_LACode"><?php echo $monthly_run_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $monthly_run_view->LACode->cellAttributes() ?>>
<span id="el_monthly_run_LACode">
<span<?php echo $monthly_run_view->LACode->viewAttributes() ?>><?php echo $monthly_run_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($monthly_run_view->PeriodCode->Visible) { // PeriodCode ?>
	<tr id="r_PeriodCode">
		<td class="<?php echo $monthly_run_view->TableLeftColumnClass ?>"><span id="elh_monthly_run_PeriodCode"><?php echo $monthly_run_view->PeriodCode->caption() ?></span></td>
		<td data-name="PeriodCode" <?php echo $monthly_run_view->PeriodCode->cellAttributes() ?>>
<span id="el_monthly_run_PeriodCode">
<span<?php echo $monthly_run_view->PeriodCode->viewAttributes() ?>><?php echo $monthly_run_view->PeriodCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($monthly_run_view->RunDate->Visible) { // RunDate ?>
	<tr id="r_RunDate">
		<td class="<?php echo $monthly_run_view->TableLeftColumnClass ?>"><span id="elh_monthly_run_RunDate"><?php echo $monthly_run_view->RunDate->caption() ?></span></td>
		<td data-name="RunDate" <?php echo $monthly_run_view->RunDate->cellAttributes() ?>>
<span id="el_monthly_run_RunDate">
<span<?php echo $monthly_run_view->RunDate->viewAttributes() ?>><?php echo $monthly_run_view->RunDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($monthly_run_view->Description->Visible) { // Description ?>
	<tr id="r_Description">
		<td class="<?php echo $monthly_run_view->TableLeftColumnClass ?>"><span id="elh_monthly_run_Description"><?php echo $monthly_run_view->Description->caption() ?></span></td>
		<td data-name="Description" <?php echo $monthly_run_view->Description->cellAttributes() ?>>
<span id="el_monthly_run_Description">
<span<?php echo $monthly_run_view->Description->viewAttributes() ?>><?php echo $monthly_run_view->Description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($monthly_run_view->Year->Visible) { // Year ?>
	<tr id="r_Year">
		<td class="<?php echo $monthly_run_view->TableLeftColumnClass ?>"><span id="elh_monthly_run_Year"><?php echo $monthly_run_view->Year->caption() ?></span></td>
		<td data-name="Year" <?php echo $monthly_run_view->Year->cellAttributes() ?>>
<span id="el_monthly_run_Year">
<span<?php echo $monthly_run_view->Year->viewAttributes() ?>><?php echo $monthly_run_view->Year->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($monthly_run_view->RunMonth->Visible) { // RunMonth ?>
	<tr id="r_RunMonth">
		<td class="<?php echo $monthly_run_view->TableLeftColumnClass ?>"><span id="elh_monthly_run_RunMonth"><?php echo $monthly_run_view->RunMonth->caption() ?></span></td>
		<td data-name="RunMonth" <?php echo $monthly_run_view->RunMonth->cellAttributes() ?>>
<span id="el_monthly_run_RunMonth">
<span<?php echo $monthly_run_view->RunMonth->viewAttributes() ?>><?php echo $monthly_run_view->RunMonth->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($monthly_run_view->PayrollCode->Visible) { // PayrollCode ?>
	<tr id="r_PayrollCode">
		<td class="<?php echo $monthly_run_view->TableLeftColumnClass ?>"><span id="elh_monthly_run_PayrollCode"><?php echo $monthly_run_view->PayrollCode->caption() ?></span></td>
		<td data-name="PayrollCode" <?php echo $monthly_run_view->PayrollCode->cellAttributes() ?>>
<span id="el_monthly_run_PayrollCode">
<span<?php echo $monthly_run_view->PayrollCode->viewAttributes() ?>><?php echo $monthly_run_view->PayrollCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$monthly_run_view->IsModal) { ?>
<?php if (!$monthly_run_view->isExport()) { ?>
<?php echo $monthly_run_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$monthly_run_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$monthly_run_view->isExport()) { ?>
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
$monthly_run_view->terminate();
?>