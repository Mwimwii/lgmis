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
$leave_type_view = new leave_type_view();

// Run the page
$leave_type_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_type_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$leave_type_view->isExport()) { ?>
<script>
var fleave_typeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fleave_typeview = currentForm = new ew.Form("fleave_typeview", "view");
	loadjs.done("fleave_typeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$leave_type_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $leave_type_view->ExportOptions->render("body") ?>
<?php $leave_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $leave_type_view->showPageHeader(); ?>
<?php
$leave_type_view->showMessage();
?>
<?php if (!$leave_type_view->IsModal) { ?>
<?php if (!$leave_type_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $leave_type_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fleave_typeview" id="fleave_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_type">
<input type="hidden" name="modal" value="<?php echo (int)$leave_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($leave_type_view->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<tr id="r_LeaveTypeCode">
		<td class="<?php echo $leave_type_view->TableLeftColumnClass ?>"><span id="elh_leave_type_LeaveTypeCode"><?php echo $leave_type_view->LeaveTypeCode->caption() ?></span></td>
		<td data-name="LeaveTypeCode" <?php echo $leave_type_view->LeaveTypeCode->cellAttributes() ?>>
<span id="el_leave_type_LeaveTypeCode">
<span<?php echo $leave_type_view->LeaveTypeCode->viewAttributes() ?>><?php echo $leave_type_view->LeaveTypeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_type_view->LeaveTypeName->Visible) { // LeaveTypeName ?>
	<tr id="r_LeaveTypeName">
		<td class="<?php echo $leave_type_view->TableLeftColumnClass ?>"><span id="elh_leave_type_LeaveTypeName"><?php echo $leave_type_view->LeaveTypeName->caption() ?></span></td>
		<td data-name="LeaveTypeName" <?php echo $leave_type_view->LeaveTypeName->cellAttributes() ?>>
<span id="el_leave_type_LeaveTypeName">
<span<?php echo $leave_type_view->LeaveTypeName->viewAttributes() ?>><?php echo $leave_type_view->LeaveTypeName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($leave_type_view->Accrued->Visible) { // Accrued ?>
	<tr id="r_Accrued">
		<td class="<?php echo $leave_type_view->TableLeftColumnClass ?>"><span id="elh_leave_type_Accrued"><?php echo $leave_type_view->Accrued->caption() ?></span></td>
		<td data-name="Accrued" <?php echo $leave_type_view->Accrued->cellAttributes() ?>>
<span id="el_leave_type_Accrued">
<span<?php echo $leave_type_view->Accrued->viewAttributes() ?>><?php echo $leave_type_view->Accrued->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$leave_type_view->IsModal) { ?>
<?php if (!$leave_type_view->isExport()) { ?>
<?php echo $leave_type_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$leave_type_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$leave_type_view->isExport()) { ?>
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
$leave_type_view->terminate();
?>