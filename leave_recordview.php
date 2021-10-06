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
$leave_record_view = new leave_record_view();

// Run the page
$leave_record_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_record_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$leave_record_view->isExport()) { ?>
<script>
var fleave_recordview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fleave_recordview = currentForm = new ew.Form("fleave_recordview", "view");
	loadjs.done("fleave_recordview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$leave_record_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $leave_record_view->ExportOptions->render("body") ?>
<?php $leave_record_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $leave_record_view->showPageHeader(); ?>
<?php
$leave_record_view->showMessage();
?>
<?php if (!$leave_record_view->IsModal) { ?>
<?php if (!$leave_record_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $leave_record_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fleave_recordview" id="fleave_recordview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_record">
<input type="hidden" name="modal" value="<?php echo (int)$leave_record_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($leave_record_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $leave_record_view->TableLeftColumnClass ?>"><span id="elh_leave_record_EmployeeID"><?php echo $leave_record_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $leave_record_view->EmployeeID->cellAttributes() ?>>
<span id="el_leave_record_EmployeeID">
<span<?php echo $leave_record_view->EmployeeID->viewAttributes() ?>><?php echo $leave_record_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_record_view->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<tr id="r_LeaveTypeCode">
		<td class="<?php echo $leave_record_view->TableLeftColumnClass ?>"><span id="elh_leave_record_LeaveTypeCode"><?php echo $leave_record_view->LeaveTypeCode->caption() ?></span></td>
		<td data-name="LeaveTypeCode" <?php echo $leave_record_view->LeaveTypeCode->cellAttributes() ?>>
<span id="el_leave_record_LeaveTypeCode">
<span<?php echo $leave_record_view->LeaveTypeCode->viewAttributes() ?>><?php echo $leave_record_view->LeaveTypeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_record_view->EffectiveDate->Visible) { // EffectiveDate ?>
	<tr id="r_EffectiveDate">
		<td class="<?php echo $leave_record_view->TableLeftColumnClass ?>"><span id="elh_leave_record_EffectiveDate"><?php echo $leave_record_view->EffectiveDate->caption() ?></span></td>
		<td data-name="EffectiveDate" <?php echo $leave_record_view->EffectiveDate->cellAttributes() ?>>
<span id="el_leave_record_EffectiveDate">
<span<?php echo $leave_record_view->EffectiveDate->viewAttributes() ?>><?php echo $leave_record_view->EffectiveDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_record_view->OpeningBalance->Visible) { // OpeningBalance ?>
	<tr id="r_OpeningBalance">
		<td class="<?php echo $leave_record_view->TableLeftColumnClass ?>"><span id="elh_leave_record_OpeningBalance"><?php echo $leave_record_view->OpeningBalance->caption() ?></span></td>
		<td data-name="OpeningBalance" <?php echo $leave_record_view->OpeningBalance->cellAttributes() ?>>
<span id="el_leave_record_OpeningBalance">
<span<?php echo $leave_record_view->OpeningBalance->viewAttributes() ?>><?php echo $leave_record_view->OpeningBalance->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_record_view->LeaveAccrued->Visible) { // LeaveAccrued ?>
	<tr id="r_LeaveAccrued">
		<td class="<?php echo $leave_record_view->TableLeftColumnClass ?>"><span id="elh_leave_record_LeaveAccrued"><?php echo $leave_record_view->LeaveAccrued->caption() ?></span></td>
		<td data-name="LeaveAccrued" <?php echo $leave_record_view->LeaveAccrued->cellAttributes() ?>>
<span id="el_leave_record_LeaveAccrued">
<span<?php echo $leave_record_view->LeaveAccrued->viewAttributes() ?>><?php echo $leave_record_view->LeaveAccrued->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_record_view->LastAccrualDate->Visible) { // LastAccrualDate ?>
	<tr id="r_LastAccrualDate">
		<td class="<?php echo $leave_record_view->TableLeftColumnClass ?>"><span id="elh_leave_record_LastAccrualDate"><?php echo $leave_record_view->LastAccrualDate->caption() ?></span></td>
		<td data-name="LastAccrualDate" <?php echo $leave_record_view->LastAccrualDate->cellAttributes() ?>>
<span id="el_leave_record_LastAccrualDate">
<span<?php echo $leave_record_view->LastAccrualDate->viewAttributes() ?>><?php echo $leave_record_view->LastAccrualDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_record_view->LeaveTaken->Visible) { // LeaveTaken ?>
	<tr id="r_LeaveTaken">
		<td class="<?php echo $leave_record_view->TableLeftColumnClass ?>"><span id="elh_leave_record_LeaveTaken"><?php echo $leave_record_view->LeaveTaken->caption() ?></span></td>
		<td data-name="LeaveTaken" <?php echo $leave_record_view->LeaveTaken->cellAttributes() ?>>
<span id="el_leave_record_LeaveTaken">
<span<?php echo $leave_record_view->LeaveTaken->viewAttributes() ?>><?php echo $leave_record_view->LeaveTaken->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_record_view->LeaveCommuted->Visible) { // LeaveCommuted ?>
	<tr id="r_LeaveCommuted">
		<td class="<?php echo $leave_record_view->TableLeftColumnClass ?>"><span id="elh_leave_record_LeaveCommuted"><?php echo $leave_record_view->LeaveCommuted->caption() ?></span></td>
		<td data-name="LeaveCommuted" <?php echo $leave_record_view->LeaveCommuted->cellAttributes() ?>>
<span id="el_leave_record_LeaveCommuted">
<span<?php echo $leave_record_view->LeaveCommuted->viewAttributes() ?>><?php echo $leave_record_view->LeaveCommuted->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$leave_record_view->IsModal) { ?>
<?php if (!$leave_record_view->isExport()) { ?>
<?php echo $leave_record_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$leave_record_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$leave_record_view->isExport()) { ?>
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
$leave_record_view->terminate();
?>