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
$leave_applications_view = new leave_applications_view();

// Run the page
$leave_applications_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_applications_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$leave_applications_view->isExport()) { ?>
<script>
var fleave_applicationsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fleave_applicationsview = currentForm = new ew.Form("fleave_applicationsview", "view");
	loadjs.done("fleave_applicationsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$leave_applications_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $leave_applications_view->ExportOptions->render("body") ?>
<?php $leave_applications_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $leave_applications_view->showPageHeader(); ?>
<?php
$leave_applications_view->showMessage();
?>
<?php if (!$leave_applications_view->IsModal) { ?>
<?php if (!$leave_applications_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $leave_applications_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fleave_applicationsview" id="fleave_applicationsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_applications">
<input type="hidden" name="modal" value="<?php echo (int)$leave_applications_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($leave_applications_view->LeaveApplicationID->Visible) { // LeaveApplicationID ?>
	<tr id="r_LeaveApplicationID">
		<td class="<?php echo $leave_applications_view->TableLeftColumnClass ?>"><span id="elh_leave_applications_LeaveApplicationID"><?php echo $leave_applications_view->LeaveApplicationID->caption() ?></span></td>
		<td data-name="LeaveApplicationID" <?php echo $leave_applications_view->LeaveApplicationID->cellAttributes() ?>>
<span id="el_leave_applications_LeaveApplicationID">
<span<?php echo $leave_applications_view->LeaveApplicationID->viewAttributes() ?>><?php echo $leave_applications_view->LeaveApplicationID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_applications_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $leave_applications_view->TableLeftColumnClass ?>"><span id="elh_leave_applications_EmployeeID"><?php echo $leave_applications_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $leave_applications_view->EmployeeID->cellAttributes() ?>>
<span id="el_leave_applications_EmployeeID">
<span<?php echo $leave_applications_view->EmployeeID->viewAttributes() ?>><?php echo $leave_applications_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_applications_view->StartDate->Visible) { // StartDate ?>
	<tr id="r_StartDate">
		<td class="<?php echo $leave_applications_view->TableLeftColumnClass ?>"><span id="elh_leave_applications_StartDate"><?php echo $leave_applications_view->StartDate->caption() ?></span></td>
		<td data-name="StartDate" <?php echo $leave_applications_view->StartDate->cellAttributes() ?>>
<span id="el_leave_applications_StartDate">
<span<?php echo $leave_applications_view->StartDate->viewAttributes() ?>><?php echo $leave_applications_view->StartDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_applications_view->EndDate->Visible) { // EndDate ?>
	<tr id="r_EndDate">
		<td class="<?php echo $leave_applications_view->TableLeftColumnClass ?>"><span id="elh_leave_applications_EndDate"><?php echo $leave_applications_view->EndDate->caption() ?></span></td>
		<td data-name="EndDate" <?php echo $leave_applications_view->EndDate->cellAttributes() ?>>
<span id="el_leave_applications_EndDate">
<span<?php echo $leave_applications_view->EndDate->viewAttributes() ?>><?php echo $leave_applications_view->EndDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_applications_view->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<tr id="r_LeaveTypeCode">
		<td class="<?php echo $leave_applications_view->TableLeftColumnClass ?>"><span id="elh_leave_applications_LeaveTypeCode"><?php echo $leave_applications_view->LeaveTypeCode->caption() ?></span></td>
		<td data-name="LeaveTypeCode" <?php echo $leave_applications_view->LeaveTypeCode->cellAttributes() ?>>
<span id="el_leave_applications_LeaveTypeCode">
<span<?php echo $leave_applications_view->LeaveTypeCode->viewAttributes() ?>><?php echo $leave_applications_view->LeaveTypeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_applications_view->Location->Visible) { // Location ?>
	<tr id="r_Location">
		<td class="<?php echo $leave_applications_view->TableLeftColumnClass ?>"><span id="elh_leave_applications_Location"><?php echo $leave_applications_view->Location->caption() ?></span></td>
		<td data-name="Location" <?php echo $leave_applications_view->Location->cellAttributes() ?>>
<span id="el_leave_applications_Location">
<span<?php echo $leave_applications_view->Location->viewAttributes() ?>><?php echo $leave_applications_view->Location->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_applications_view->Status->Visible) { // Status ?>
	<tr id="r_Status">
		<td class="<?php echo $leave_applications_view->TableLeftColumnClass ?>"><span id="elh_leave_applications_Status"><?php echo $leave_applications_view->Status->caption() ?></span></td>
		<td data-name="Status" <?php echo $leave_applications_view->Status->cellAttributes() ?>>
<span id="el_leave_applications_Status">
<span<?php echo $leave_applications_view->Status->viewAttributes() ?>><?php echo $leave_applications_view->Status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$leave_applications_view->IsModal) { ?>
<?php if (!$leave_applications_view->isExport()) { ?>
<?php echo $leave_applications_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$leave_applications_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$leave_applications_view->isExport()) { ?>
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
$leave_applications_view->terminate();
?>