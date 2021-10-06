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
$leave_accrual_ref_view = new leave_accrual_ref_view();

// Run the page
$leave_accrual_ref_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_accrual_ref_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$leave_accrual_ref_view->isExport()) { ?>
<script>
var fleave_accrual_refview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fleave_accrual_refview = currentForm = new ew.Form("fleave_accrual_refview", "view");
	loadjs.done("fleave_accrual_refview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$leave_accrual_ref_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $leave_accrual_ref_view->ExportOptions->render("body") ?>
<?php $leave_accrual_ref_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $leave_accrual_ref_view->showPageHeader(); ?>
<?php
$leave_accrual_ref_view->showMessage();
?>
<?php if (!$leave_accrual_ref_view->IsModal) { ?>
<?php if (!$leave_accrual_ref_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $leave_accrual_ref_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fleave_accrual_refview" id="fleave_accrual_refview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_accrual_ref">
<input type="hidden" name="modal" value="<?php echo (int)$leave_accrual_ref_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($leave_accrual_ref_view->Division->Visible) { // Division ?>
	<tr id="r_Division">
		<td class="<?php echo $leave_accrual_ref_view->TableLeftColumnClass ?>"><span id="elh_leave_accrual_ref_Division"><?php echo $leave_accrual_ref_view->Division->caption() ?></span></td>
		<td data-name="Division" <?php echo $leave_accrual_ref_view->Division->cellAttributes() ?>>
<span id="el_leave_accrual_ref_Division">
<span<?php echo $leave_accrual_ref_view->Division->viewAttributes() ?>><?php echo $leave_accrual_ref_view->Division->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_accrual_ref_view->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<tr id="r_LeaveTypeCode">
		<td class="<?php echo $leave_accrual_ref_view->TableLeftColumnClass ?>"><span id="elh_leave_accrual_ref_LeaveTypeCode"><?php echo $leave_accrual_ref_view->LeaveTypeCode->caption() ?></span></td>
		<td data-name="LeaveTypeCode" <?php echo $leave_accrual_ref_view->LeaveTypeCode->cellAttributes() ?>>
<span id="el_leave_accrual_ref_LeaveTypeCode">
<span<?php echo $leave_accrual_ref_view->LeaveTypeCode->viewAttributes() ?>><?php echo $leave_accrual_ref_view->LeaveTypeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_accrual_ref_view->AnnualEntitled->Visible) { // AnnualEntitled ?>
	<tr id="r_AnnualEntitled">
		<td class="<?php echo $leave_accrual_ref_view->TableLeftColumnClass ?>"><span id="elh_leave_accrual_ref_AnnualEntitled"><?php echo $leave_accrual_ref_view->AnnualEntitled->caption() ?></span></td>
		<td data-name="AnnualEntitled" <?php echo $leave_accrual_ref_view->AnnualEntitled->cellAttributes() ?>>
<span id="el_leave_accrual_ref_AnnualEntitled">
<span<?php echo $leave_accrual_ref_view->AnnualEntitled->viewAttributes() ?>><?php echo $leave_accrual_ref_view->AnnualEntitled->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_accrual_ref_view->AnnualCarryover->Visible) { // AnnualCarryover ?>
	<tr id="r_AnnualCarryover">
		<td class="<?php echo $leave_accrual_ref_view->TableLeftColumnClass ?>"><span id="elh_leave_accrual_ref_AnnualCarryover"><?php echo $leave_accrual_ref_view->AnnualCarryover->caption() ?></span></td>
		<td data-name="AnnualCarryover" <?php echo $leave_accrual_ref_view->AnnualCarryover->cellAttributes() ?>>
<span id="el_leave_accrual_ref_AnnualCarryover">
<span<?php echo $leave_accrual_ref_view->AnnualCarryover->viewAttributes() ?>><?php echo $leave_accrual_ref_view->AnnualCarryover->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_accrual_ref_view->MaxLeaveTaken->Visible) { // MaxLeaveTaken ?>
	<tr id="r_MaxLeaveTaken">
		<td class="<?php echo $leave_accrual_ref_view->TableLeftColumnClass ?>"><span id="elh_leave_accrual_ref_MaxLeaveTaken"><?php echo $leave_accrual_ref_view->MaxLeaveTaken->caption() ?></span></td>
		<td data-name="MaxLeaveTaken" <?php echo $leave_accrual_ref_view->MaxLeaveTaken->cellAttributes() ?>>
<span id="el_leave_accrual_ref_MaxLeaveTaken">
<span<?php echo $leave_accrual_ref_view->MaxLeaveTaken->viewAttributes() ?>><?php echo $leave_accrual_ref_view->MaxLeaveTaken->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$leave_accrual_ref_view->IsModal) { ?>
<?php if (!$leave_accrual_ref_view->isExport()) { ?>
<?php echo $leave_accrual_ref_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$leave_accrual_ref_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$leave_accrual_ref_view->isExport()) { ?>
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
$leave_accrual_ref_view->terminate();
?>