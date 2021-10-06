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
$leave_accrual_ref_delete = new leave_accrual_ref_delete();

// Run the page
$leave_accrual_ref_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_accrual_ref_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fleave_accrual_refdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fleave_accrual_refdelete = currentForm = new ew.Form("fleave_accrual_refdelete", "delete");
	loadjs.done("fleave_accrual_refdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $leave_accrual_ref_delete->showPageHeader(); ?>
<?php
$leave_accrual_ref_delete->showMessage();
?>
<form name="fleave_accrual_refdelete" id="fleave_accrual_refdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_accrual_ref">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($leave_accrual_ref_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($leave_accrual_ref_delete->Division->Visible) { // Division ?>
		<th class="<?php echo $leave_accrual_ref_delete->Division->headerCellClass() ?>"><span id="elh_leave_accrual_ref_Division" class="leave_accrual_ref_Division"><?php echo $leave_accrual_ref_delete->Division->caption() ?></span></th>
<?php } ?>
<?php if ($leave_accrual_ref_delete->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<th class="<?php echo $leave_accrual_ref_delete->LeaveTypeCode->headerCellClass() ?>"><span id="elh_leave_accrual_ref_LeaveTypeCode" class="leave_accrual_ref_LeaveTypeCode"><?php echo $leave_accrual_ref_delete->LeaveTypeCode->caption() ?></span></th>
<?php } ?>
<?php if ($leave_accrual_ref_delete->AnnualEntitled->Visible) { // AnnualEntitled ?>
		<th class="<?php echo $leave_accrual_ref_delete->AnnualEntitled->headerCellClass() ?>"><span id="elh_leave_accrual_ref_AnnualEntitled" class="leave_accrual_ref_AnnualEntitled"><?php echo $leave_accrual_ref_delete->AnnualEntitled->caption() ?></span></th>
<?php } ?>
<?php if ($leave_accrual_ref_delete->AnnualCarryover->Visible) { // AnnualCarryover ?>
		<th class="<?php echo $leave_accrual_ref_delete->AnnualCarryover->headerCellClass() ?>"><span id="elh_leave_accrual_ref_AnnualCarryover" class="leave_accrual_ref_AnnualCarryover"><?php echo $leave_accrual_ref_delete->AnnualCarryover->caption() ?></span></th>
<?php } ?>
<?php if ($leave_accrual_ref_delete->MaxLeaveTaken->Visible) { // MaxLeaveTaken ?>
		<th class="<?php echo $leave_accrual_ref_delete->MaxLeaveTaken->headerCellClass() ?>"><span id="elh_leave_accrual_ref_MaxLeaveTaken" class="leave_accrual_ref_MaxLeaveTaken"><?php echo $leave_accrual_ref_delete->MaxLeaveTaken->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$leave_accrual_ref_delete->RecordCount = 0;
$i = 0;
while (!$leave_accrual_ref_delete->Recordset->EOF) {
	$leave_accrual_ref_delete->RecordCount++;
	$leave_accrual_ref_delete->RowCount++;

	// Set row properties
	$leave_accrual_ref->resetAttributes();
	$leave_accrual_ref->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$leave_accrual_ref_delete->loadRowValues($leave_accrual_ref_delete->Recordset);

	// Render row
	$leave_accrual_ref_delete->renderRow();
?>
	<tr <?php echo $leave_accrual_ref->rowAttributes() ?>>
<?php if ($leave_accrual_ref_delete->Division->Visible) { // Division ?>
		<td <?php echo $leave_accrual_ref_delete->Division->cellAttributes() ?>>
<span id="el<?php echo $leave_accrual_ref_delete->RowCount ?>_leave_accrual_ref_Division" class="leave_accrual_ref_Division">
<span<?php echo $leave_accrual_ref_delete->Division->viewAttributes() ?>><?php echo $leave_accrual_ref_delete->Division->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_accrual_ref_delete->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<td <?php echo $leave_accrual_ref_delete->LeaveTypeCode->cellAttributes() ?>>
<span id="el<?php echo $leave_accrual_ref_delete->RowCount ?>_leave_accrual_ref_LeaveTypeCode" class="leave_accrual_ref_LeaveTypeCode">
<span<?php echo $leave_accrual_ref_delete->LeaveTypeCode->viewAttributes() ?>><?php echo $leave_accrual_ref_delete->LeaveTypeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_accrual_ref_delete->AnnualEntitled->Visible) { // AnnualEntitled ?>
		<td <?php echo $leave_accrual_ref_delete->AnnualEntitled->cellAttributes() ?>>
<span id="el<?php echo $leave_accrual_ref_delete->RowCount ?>_leave_accrual_ref_AnnualEntitled" class="leave_accrual_ref_AnnualEntitled">
<span<?php echo $leave_accrual_ref_delete->AnnualEntitled->viewAttributes() ?>><?php echo $leave_accrual_ref_delete->AnnualEntitled->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_accrual_ref_delete->AnnualCarryover->Visible) { // AnnualCarryover ?>
		<td <?php echo $leave_accrual_ref_delete->AnnualCarryover->cellAttributes() ?>>
<span id="el<?php echo $leave_accrual_ref_delete->RowCount ?>_leave_accrual_ref_AnnualCarryover" class="leave_accrual_ref_AnnualCarryover">
<span<?php echo $leave_accrual_ref_delete->AnnualCarryover->viewAttributes() ?>><?php echo $leave_accrual_ref_delete->AnnualCarryover->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_accrual_ref_delete->MaxLeaveTaken->Visible) { // MaxLeaveTaken ?>
		<td <?php echo $leave_accrual_ref_delete->MaxLeaveTaken->cellAttributes() ?>>
<span id="el<?php echo $leave_accrual_ref_delete->RowCount ?>_leave_accrual_ref_MaxLeaveTaken" class="leave_accrual_ref_MaxLeaveTaken">
<span<?php echo $leave_accrual_ref_delete->MaxLeaveTaken->viewAttributes() ?>><?php echo $leave_accrual_ref_delete->MaxLeaveTaken->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$leave_accrual_ref_delete->Recordset->moveNext();
}
$leave_accrual_ref_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $leave_accrual_ref_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$leave_accrual_ref_delete->showPageFooter();
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
$leave_accrual_ref_delete->terminate();
?>