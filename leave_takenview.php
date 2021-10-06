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
$leave_taken_view = new leave_taken_view();

// Run the page
$leave_taken_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_taken_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$leave_taken_view->isExport()) { ?>
<script>
var fleave_takenview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fleave_takenview = currentForm = new ew.Form("fleave_takenview", "view");
	loadjs.done("fleave_takenview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$leave_taken_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $leave_taken_view->ExportOptions->render("body") ?>
<?php $leave_taken_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $leave_taken_view->showPageHeader(); ?>
<?php
$leave_taken_view->showMessage();
?>
<?php if (!$leave_taken_view->IsModal) { ?>
<?php if (!$leave_taken_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $leave_taken_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fleave_takenview" id="fleave_takenview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_taken">
<input type="hidden" name="modal" value="<?php echo (int)$leave_taken_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($leave_taken_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $leave_taken_view->TableLeftColumnClass ?>"><span id="elh_leave_taken_EmployeeID"><?php echo $leave_taken_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $leave_taken_view->EmployeeID->cellAttributes() ?>>
<span id="el_leave_taken_EmployeeID">
<span<?php echo $leave_taken_view->EmployeeID->viewAttributes() ?>><?php echo $leave_taken_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_taken_view->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<tr id="r_LeaveTypeCode">
		<td class="<?php echo $leave_taken_view->TableLeftColumnClass ?>"><span id="elh_leave_taken_LeaveTypeCode"><?php echo $leave_taken_view->LeaveTypeCode->caption() ?></span></td>
		<td data-name="LeaveTypeCode" <?php echo $leave_taken_view->LeaveTypeCode->cellAttributes() ?>>
<span id="el_leave_taken_LeaveTypeCode">
<span<?php echo $leave_taken_view->LeaveTypeCode->viewAttributes() ?>><?php echo $leave_taken_view->LeaveTypeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_taken_view->StartDate->Visible) { // StartDate ?>
	<tr id="r_StartDate">
		<td class="<?php echo $leave_taken_view->TableLeftColumnClass ?>"><span id="elh_leave_taken_StartDate"><?php echo $leave_taken_view->StartDate->caption() ?></span></td>
		<td data-name="StartDate" <?php echo $leave_taken_view->StartDate->cellAttributes() ?>>
<span id="el_leave_taken_StartDate">
<span<?php echo $leave_taken_view->StartDate->viewAttributes() ?>><?php echo $leave_taken_view->StartDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_taken_view->EndDate->Visible) { // EndDate ?>
	<tr id="r_EndDate">
		<td class="<?php echo $leave_taken_view->TableLeftColumnClass ?>"><span id="elh_leave_taken_EndDate"><?php echo $leave_taken_view->EndDate->caption() ?></span></td>
		<td data-name="EndDate" <?php echo $leave_taken_view->EndDate->cellAttributes() ?>>
<span id="el_leave_taken_EndDate">
<span<?php echo $leave_taken_view->EndDate->viewAttributes() ?>><?php echo $leave_taken_view->EndDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_taken_view->Commuted->Visible) { // Commuted ?>
	<tr id="r_Commuted">
		<td class="<?php echo $leave_taken_view->TableLeftColumnClass ?>"><span id="elh_leave_taken_Commuted"><?php echo $leave_taken_view->Commuted->caption() ?></span></td>
		<td data-name="Commuted" <?php echo $leave_taken_view->Commuted->cellAttributes() ?>>
<span id="el_leave_taken_Commuted">
<span<?php echo $leave_taken_view->Commuted->viewAttributes() ?>><?php echo $leave_taken_view->Commuted->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_taken_view->LeaveDays->Visible) { // LeaveDays ?>
	<tr id="r_LeaveDays">
		<td class="<?php echo $leave_taken_view->TableLeftColumnClass ?>"><span id="elh_leave_taken_LeaveDays"><?php echo $leave_taken_view->LeaveDays->caption() ?></span></td>
		<td data-name="LeaveDays" <?php echo $leave_taken_view->LeaveDays->cellAttributes() ?>>
<span id="el_leave_taken_LeaveDays">
<span<?php echo $leave_taken_view->LeaveDays->viewAttributes() ?>><?php echo $leave_taken_view->LeaveDays->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_taken_view->Location->Visible) { // Location ?>
	<tr id="r_Location">
		<td class="<?php echo $leave_taken_view->TableLeftColumnClass ?>"><span id="elh_leave_taken_Location"><?php echo $leave_taken_view->Location->caption() ?></span></td>
		<td data-name="Location" <?php echo $leave_taken_view->Location->cellAttributes() ?>>
<span id="el_leave_taken_Location">
<span<?php echo $leave_taken_view->Location->viewAttributes() ?>><?php echo $leave_taken_view->Location->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_taken_view->Remarks->Visible) { // Remarks ?>
	<tr id="r_Remarks">
		<td class="<?php echo $leave_taken_view->TableLeftColumnClass ?>"><span id="elh_leave_taken_Remarks"><?php echo $leave_taken_view->Remarks->caption() ?></span></td>
		<td data-name="Remarks" <?php echo $leave_taken_view->Remarks->cellAttributes() ?>>
<span id="el_leave_taken_Remarks">
<span<?php echo $leave_taken_view->Remarks->viewAttributes() ?>><?php echo $leave_taken_view->Remarks->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$leave_taken_view->IsModal) { ?>
<?php if (!$leave_taken_view->isExport()) { ?>
<?php echo $leave_taken_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$leave_taken_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$leave_taken_view->isExport()) { ?>
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
$leave_taken_view->terminate();
?>