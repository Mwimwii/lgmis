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
$leave_booked_delete = new leave_booked_delete();

// Run the page
$leave_booked_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_booked_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fleave_bookeddelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fleave_bookeddelete = currentForm = new ew.Form("fleave_bookeddelete", "delete");
	loadjs.done("fleave_bookeddelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $leave_booked_delete->showPageHeader(); ?>
<?php
$leave_booked_delete->showMessage();
?>
<form name="fleave_bookeddelete" id="fleave_bookeddelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_booked">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($leave_booked_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($leave_booked_delete->EmployeeID->Visible) { // EmployeeID ?>
		<th class="<?php echo $leave_booked_delete->EmployeeID->headerCellClass() ?>"><span id="elh_leave_booked_EmployeeID" class="leave_booked_EmployeeID"><?php echo $leave_booked_delete->EmployeeID->caption() ?></span></th>
<?php } ?>
<?php if ($leave_booked_delete->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<th class="<?php echo $leave_booked_delete->LeaveTypeCode->headerCellClass() ?>"><span id="elh_leave_booked_LeaveTypeCode" class="leave_booked_LeaveTypeCode"><?php echo $leave_booked_delete->LeaveTypeCode->caption() ?></span></th>
<?php } ?>
<?php if ($leave_booked_delete->StartDate->Visible) { // StartDate ?>
		<th class="<?php echo $leave_booked_delete->StartDate->headerCellClass() ?>"><span id="elh_leave_booked_StartDate" class="leave_booked_StartDate"><?php echo $leave_booked_delete->StartDate->caption() ?></span></th>
<?php } ?>
<?php if ($leave_booked_delete->EndDate->Visible) { // EndDate ?>
		<th class="<?php echo $leave_booked_delete->EndDate->headerCellClass() ?>"><span id="elh_leave_booked_EndDate" class="leave_booked_EndDate"><?php echo $leave_booked_delete->EndDate->caption() ?></span></th>
<?php } ?>
<?php if ($leave_booked_delete->Location->Visible) { // Location ?>
		<th class="<?php echo $leave_booked_delete->Location->headerCellClass() ?>"><span id="elh_leave_booked_Location" class="leave_booked_Location"><?php echo $leave_booked_delete->Location->caption() ?></span></th>
<?php } ?>
<?php if ($leave_booked_delete->Remarks->Visible) { // Remarks ?>
		<th class="<?php echo $leave_booked_delete->Remarks->headerCellClass() ?>"><span id="elh_leave_booked_Remarks" class="leave_booked_Remarks"><?php echo $leave_booked_delete->Remarks->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$leave_booked_delete->RecordCount = 0;
$i = 0;
while (!$leave_booked_delete->Recordset->EOF) {
	$leave_booked_delete->RecordCount++;
	$leave_booked_delete->RowCount++;

	// Set row properties
	$leave_booked->resetAttributes();
	$leave_booked->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$leave_booked_delete->loadRowValues($leave_booked_delete->Recordset);

	// Render row
	$leave_booked_delete->renderRow();
?>
	<tr <?php echo $leave_booked->rowAttributes() ?>>
<?php if ($leave_booked_delete->EmployeeID->Visible) { // EmployeeID ?>
		<td <?php echo $leave_booked_delete->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $leave_booked_delete->RowCount ?>_leave_booked_EmployeeID" class="leave_booked_EmployeeID">
<span<?php echo $leave_booked_delete->EmployeeID->viewAttributes() ?>><?php echo $leave_booked_delete->EmployeeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_booked_delete->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<td <?php echo $leave_booked_delete->LeaveTypeCode->cellAttributes() ?>>
<span id="el<?php echo $leave_booked_delete->RowCount ?>_leave_booked_LeaveTypeCode" class="leave_booked_LeaveTypeCode">
<span<?php echo $leave_booked_delete->LeaveTypeCode->viewAttributes() ?>><?php echo $leave_booked_delete->LeaveTypeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_booked_delete->StartDate->Visible) { // StartDate ?>
		<td <?php echo $leave_booked_delete->StartDate->cellAttributes() ?>>
<span id="el<?php echo $leave_booked_delete->RowCount ?>_leave_booked_StartDate" class="leave_booked_StartDate">
<span<?php echo $leave_booked_delete->StartDate->viewAttributes() ?>><?php echo $leave_booked_delete->StartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_booked_delete->EndDate->Visible) { // EndDate ?>
		<td <?php echo $leave_booked_delete->EndDate->cellAttributes() ?>>
<span id="el<?php echo $leave_booked_delete->RowCount ?>_leave_booked_EndDate" class="leave_booked_EndDate">
<span<?php echo $leave_booked_delete->EndDate->viewAttributes() ?>><?php echo $leave_booked_delete->EndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_booked_delete->Location->Visible) { // Location ?>
		<td <?php echo $leave_booked_delete->Location->cellAttributes() ?>>
<span id="el<?php echo $leave_booked_delete->RowCount ?>_leave_booked_Location" class="leave_booked_Location">
<span<?php echo $leave_booked_delete->Location->viewAttributes() ?>><?php echo $leave_booked_delete->Location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_booked_delete->Remarks->Visible) { // Remarks ?>
		<td <?php echo $leave_booked_delete->Remarks->cellAttributes() ?>>
<span id="el<?php echo $leave_booked_delete->RowCount ?>_leave_booked_Remarks" class="leave_booked_Remarks">
<span<?php echo $leave_booked_delete->Remarks->viewAttributes() ?>><?php echo $leave_booked_delete->Remarks->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$leave_booked_delete->Recordset->moveNext();
}
$leave_booked_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $leave_booked_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$leave_booked_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$leave_booked_delete->terminate();
?>