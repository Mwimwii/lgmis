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
$leave_taken_delete = new leave_taken_delete();

// Run the page
$leave_taken_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_taken_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fleave_takendelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fleave_takendelete = currentForm = new ew.Form("fleave_takendelete", "delete");
	loadjs.done("fleave_takendelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $leave_taken_delete->showPageHeader(); ?>
<?php
$leave_taken_delete->showMessage();
?>
<form name="fleave_takendelete" id="fleave_takendelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_taken">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($leave_taken_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($leave_taken_delete->EmployeeID->Visible) { // EmployeeID ?>
		<th class="<?php echo $leave_taken_delete->EmployeeID->headerCellClass() ?>"><span id="elh_leave_taken_EmployeeID" class="leave_taken_EmployeeID"><?php echo $leave_taken_delete->EmployeeID->caption() ?></span></th>
<?php } ?>
<?php if ($leave_taken_delete->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<th class="<?php echo $leave_taken_delete->LeaveTypeCode->headerCellClass() ?>"><span id="elh_leave_taken_LeaveTypeCode" class="leave_taken_LeaveTypeCode"><?php echo $leave_taken_delete->LeaveTypeCode->caption() ?></span></th>
<?php } ?>
<?php if ($leave_taken_delete->StartDate->Visible) { // StartDate ?>
		<th class="<?php echo $leave_taken_delete->StartDate->headerCellClass() ?>"><span id="elh_leave_taken_StartDate" class="leave_taken_StartDate"><?php echo $leave_taken_delete->StartDate->caption() ?></span></th>
<?php } ?>
<?php if ($leave_taken_delete->EndDate->Visible) { // EndDate ?>
		<th class="<?php echo $leave_taken_delete->EndDate->headerCellClass() ?>"><span id="elh_leave_taken_EndDate" class="leave_taken_EndDate"><?php echo $leave_taken_delete->EndDate->caption() ?></span></th>
<?php } ?>
<?php if ($leave_taken_delete->Commuted->Visible) { // Commuted ?>
		<th class="<?php echo $leave_taken_delete->Commuted->headerCellClass() ?>"><span id="elh_leave_taken_Commuted" class="leave_taken_Commuted"><?php echo $leave_taken_delete->Commuted->caption() ?></span></th>
<?php } ?>
<?php if ($leave_taken_delete->LeaveDays->Visible) { // LeaveDays ?>
		<th class="<?php echo $leave_taken_delete->LeaveDays->headerCellClass() ?>"><span id="elh_leave_taken_LeaveDays" class="leave_taken_LeaveDays"><?php echo $leave_taken_delete->LeaveDays->caption() ?></span></th>
<?php } ?>
<?php if ($leave_taken_delete->Location->Visible) { // Location ?>
		<th class="<?php echo $leave_taken_delete->Location->headerCellClass() ?>"><span id="elh_leave_taken_Location" class="leave_taken_Location"><?php echo $leave_taken_delete->Location->caption() ?></span></th>
<?php } ?>
<?php if ($leave_taken_delete->Remarks->Visible) { // Remarks ?>
		<th class="<?php echo $leave_taken_delete->Remarks->headerCellClass() ?>"><span id="elh_leave_taken_Remarks" class="leave_taken_Remarks"><?php echo $leave_taken_delete->Remarks->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$leave_taken_delete->RecordCount = 0;
$i = 0;
while (!$leave_taken_delete->Recordset->EOF) {
	$leave_taken_delete->RecordCount++;
	$leave_taken_delete->RowCount++;

	// Set row properties
	$leave_taken->resetAttributes();
	$leave_taken->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$leave_taken_delete->loadRowValues($leave_taken_delete->Recordset);

	// Render row
	$leave_taken_delete->renderRow();
?>
	<tr <?php echo $leave_taken->rowAttributes() ?>>
<?php if ($leave_taken_delete->EmployeeID->Visible) { // EmployeeID ?>
		<td <?php echo $leave_taken_delete->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $leave_taken_delete->RowCount ?>_leave_taken_EmployeeID" class="leave_taken_EmployeeID">
<span<?php echo $leave_taken_delete->EmployeeID->viewAttributes() ?>><?php echo $leave_taken_delete->EmployeeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_taken_delete->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<td <?php echo $leave_taken_delete->LeaveTypeCode->cellAttributes() ?>>
<span id="el<?php echo $leave_taken_delete->RowCount ?>_leave_taken_LeaveTypeCode" class="leave_taken_LeaveTypeCode">
<span<?php echo $leave_taken_delete->LeaveTypeCode->viewAttributes() ?>><?php echo $leave_taken_delete->LeaveTypeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_taken_delete->StartDate->Visible) { // StartDate ?>
		<td <?php echo $leave_taken_delete->StartDate->cellAttributes() ?>>
<span id="el<?php echo $leave_taken_delete->RowCount ?>_leave_taken_StartDate" class="leave_taken_StartDate">
<span<?php echo $leave_taken_delete->StartDate->viewAttributes() ?>><?php echo $leave_taken_delete->StartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_taken_delete->EndDate->Visible) { // EndDate ?>
		<td <?php echo $leave_taken_delete->EndDate->cellAttributes() ?>>
<span id="el<?php echo $leave_taken_delete->RowCount ?>_leave_taken_EndDate" class="leave_taken_EndDate">
<span<?php echo $leave_taken_delete->EndDate->viewAttributes() ?>><?php echo $leave_taken_delete->EndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_taken_delete->Commuted->Visible) { // Commuted ?>
		<td <?php echo $leave_taken_delete->Commuted->cellAttributes() ?>>
<span id="el<?php echo $leave_taken_delete->RowCount ?>_leave_taken_Commuted" class="leave_taken_Commuted">
<span<?php echo $leave_taken_delete->Commuted->viewAttributes() ?>><?php echo $leave_taken_delete->Commuted->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_taken_delete->LeaveDays->Visible) { // LeaveDays ?>
		<td <?php echo $leave_taken_delete->LeaveDays->cellAttributes() ?>>
<span id="el<?php echo $leave_taken_delete->RowCount ?>_leave_taken_LeaveDays" class="leave_taken_LeaveDays">
<span<?php echo $leave_taken_delete->LeaveDays->viewAttributes() ?>><?php echo $leave_taken_delete->LeaveDays->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_taken_delete->Location->Visible) { // Location ?>
		<td <?php echo $leave_taken_delete->Location->cellAttributes() ?>>
<span id="el<?php echo $leave_taken_delete->RowCount ?>_leave_taken_Location" class="leave_taken_Location">
<span<?php echo $leave_taken_delete->Location->viewAttributes() ?>><?php echo $leave_taken_delete->Location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_taken_delete->Remarks->Visible) { // Remarks ?>
		<td <?php echo $leave_taken_delete->Remarks->cellAttributes() ?>>
<span id="el<?php echo $leave_taken_delete->RowCount ?>_leave_taken_Remarks" class="leave_taken_Remarks">
<span<?php echo $leave_taken_delete->Remarks->viewAttributes() ?>><?php echo $leave_taken_delete->Remarks->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$leave_taken_delete->Recordset->moveNext();
}
$leave_taken_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $leave_taken_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$leave_taken_delete->showPageFooter();
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
$leave_taken_delete->terminate();
?>