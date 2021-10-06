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
$leave_record_delete = new leave_record_delete();

// Run the page
$leave_record_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_record_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fleave_recorddelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fleave_recorddelete = currentForm = new ew.Form("fleave_recorddelete", "delete");
	loadjs.done("fleave_recorddelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $leave_record_delete->showPageHeader(); ?>
<?php
$leave_record_delete->showMessage();
?>
<form name="fleave_recorddelete" id="fleave_recorddelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_record">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($leave_record_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($leave_record_delete->EmployeeID->Visible) { // EmployeeID ?>
		<th class="<?php echo $leave_record_delete->EmployeeID->headerCellClass() ?>"><span id="elh_leave_record_EmployeeID" class="leave_record_EmployeeID"><?php echo $leave_record_delete->EmployeeID->caption() ?></span></th>
<?php } ?>
<?php if ($leave_record_delete->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<th class="<?php echo $leave_record_delete->LeaveTypeCode->headerCellClass() ?>"><span id="elh_leave_record_LeaveTypeCode" class="leave_record_LeaveTypeCode"><?php echo $leave_record_delete->LeaveTypeCode->caption() ?></span></th>
<?php } ?>
<?php if ($leave_record_delete->EffectiveDate->Visible) { // EffectiveDate ?>
		<th class="<?php echo $leave_record_delete->EffectiveDate->headerCellClass() ?>"><span id="elh_leave_record_EffectiveDate" class="leave_record_EffectiveDate"><?php echo $leave_record_delete->EffectiveDate->caption() ?></span></th>
<?php } ?>
<?php if ($leave_record_delete->OpeningBalance->Visible) { // OpeningBalance ?>
		<th class="<?php echo $leave_record_delete->OpeningBalance->headerCellClass() ?>"><span id="elh_leave_record_OpeningBalance" class="leave_record_OpeningBalance"><?php echo $leave_record_delete->OpeningBalance->caption() ?></span></th>
<?php } ?>
<?php if ($leave_record_delete->LeaveAccrued->Visible) { // LeaveAccrued ?>
		<th class="<?php echo $leave_record_delete->LeaveAccrued->headerCellClass() ?>"><span id="elh_leave_record_LeaveAccrued" class="leave_record_LeaveAccrued"><?php echo $leave_record_delete->LeaveAccrued->caption() ?></span></th>
<?php } ?>
<?php if ($leave_record_delete->LastAccrualDate->Visible) { // LastAccrualDate ?>
		<th class="<?php echo $leave_record_delete->LastAccrualDate->headerCellClass() ?>"><span id="elh_leave_record_LastAccrualDate" class="leave_record_LastAccrualDate"><?php echo $leave_record_delete->LastAccrualDate->caption() ?></span></th>
<?php } ?>
<?php if ($leave_record_delete->LeaveTaken->Visible) { // LeaveTaken ?>
		<th class="<?php echo $leave_record_delete->LeaveTaken->headerCellClass() ?>"><span id="elh_leave_record_LeaveTaken" class="leave_record_LeaveTaken"><?php echo $leave_record_delete->LeaveTaken->caption() ?></span></th>
<?php } ?>
<?php if ($leave_record_delete->LeaveCommuted->Visible) { // LeaveCommuted ?>
		<th class="<?php echo $leave_record_delete->LeaveCommuted->headerCellClass() ?>"><span id="elh_leave_record_LeaveCommuted" class="leave_record_LeaveCommuted"><?php echo $leave_record_delete->LeaveCommuted->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$leave_record_delete->RecordCount = 0;
$i = 0;
while (!$leave_record_delete->Recordset->EOF) {
	$leave_record_delete->RecordCount++;
	$leave_record_delete->RowCount++;

	// Set row properties
	$leave_record->resetAttributes();
	$leave_record->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$leave_record_delete->loadRowValues($leave_record_delete->Recordset);

	// Render row
	$leave_record_delete->renderRow();
?>
	<tr <?php echo $leave_record->rowAttributes() ?>>
<?php if ($leave_record_delete->EmployeeID->Visible) { // EmployeeID ?>
		<td <?php echo $leave_record_delete->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $leave_record_delete->RowCount ?>_leave_record_EmployeeID" class="leave_record_EmployeeID">
<span<?php echo $leave_record_delete->EmployeeID->viewAttributes() ?>><?php echo $leave_record_delete->EmployeeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_record_delete->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<td <?php echo $leave_record_delete->LeaveTypeCode->cellAttributes() ?>>
<span id="el<?php echo $leave_record_delete->RowCount ?>_leave_record_LeaveTypeCode" class="leave_record_LeaveTypeCode">
<span<?php echo $leave_record_delete->LeaveTypeCode->viewAttributes() ?>><?php echo $leave_record_delete->LeaveTypeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_record_delete->EffectiveDate->Visible) { // EffectiveDate ?>
		<td <?php echo $leave_record_delete->EffectiveDate->cellAttributes() ?>>
<span id="el<?php echo $leave_record_delete->RowCount ?>_leave_record_EffectiveDate" class="leave_record_EffectiveDate">
<span<?php echo $leave_record_delete->EffectiveDate->viewAttributes() ?>><?php echo $leave_record_delete->EffectiveDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_record_delete->OpeningBalance->Visible) { // OpeningBalance ?>
		<td <?php echo $leave_record_delete->OpeningBalance->cellAttributes() ?>>
<span id="el<?php echo $leave_record_delete->RowCount ?>_leave_record_OpeningBalance" class="leave_record_OpeningBalance">
<span<?php echo $leave_record_delete->OpeningBalance->viewAttributes() ?>><?php echo $leave_record_delete->OpeningBalance->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_record_delete->LeaveAccrued->Visible) { // LeaveAccrued ?>
		<td <?php echo $leave_record_delete->LeaveAccrued->cellAttributes() ?>>
<span id="el<?php echo $leave_record_delete->RowCount ?>_leave_record_LeaveAccrued" class="leave_record_LeaveAccrued">
<span<?php echo $leave_record_delete->LeaveAccrued->viewAttributes() ?>><?php echo $leave_record_delete->LeaveAccrued->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_record_delete->LastAccrualDate->Visible) { // LastAccrualDate ?>
		<td <?php echo $leave_record_delete->LastAccrualDate->cellAttributes() ?>>
<span id="el<?php echo $leave_record_delete->RowCount ?>_leave_record_LastAccrualDate" class="leave_record_LastAccrualDate">
<span<?php echo $leave_record_delete->LastAccrualDate->viewAttributes() ?>><?php echo $leave_record_delete->LastAccrualDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_record_delete->LeaveTaken->Visible) { // LeaveTaken ?>
		<td <?php echo $leave_record_delete->LeaveTaken->cellAttributes() ?>>
<span id="el<?php echo $leave_record_delete->RowCount ?>_leave_record_LeaveTaken" class="leave_record_LeaveTaken">
<span<?php echo $leave_record_delete->LeaveTaken->viewAttributes() ?>><?php echo $leave_record_delete->LeaveTaken->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_record_delete->LeaveCommuted->Visible) { // LeaveCommuted ?>
		<td <?php echo $leave_record_delete->LeaveCommuted->cellAttributes() ?>>
<span id="el<?php echo $leave_record_delete->RowCount ?>_leave_record_LeaveCommuted" class="leave_record_LeaveCommuted">
<span<?php echo $leave_record_delete->LeaveCommuted->viewAttributes() ?>><?php echo $leave_record_delete->LeaveCommuted->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$leave_record_delete->Recordset->moveNext();
}
$leave_record_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $leave_record_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$leave_record_delete->showPageFooter();
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
$leave_record_delete->terminate();
?>