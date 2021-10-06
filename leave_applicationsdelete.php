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
$leave_applications_delete = new leave_applications_delete();

// Run the page
$leave_applications_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_applications_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fleave_applicationsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fleave_applicationsdelete = currentForm = new ew.Form("fleave_applicationsdelete", "delete");
	loadjs.done("fleave_applicationsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $leave_applications_delete->showPageHeader(); ?>
<?php
$leave_applications_delete->showMessage();
?>
<form name="fleave_applicationsdelete" id="fleave_applicationsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_applications">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($leave_applications_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($leave_applications_delete->LeaveApplicationID->Visible) { // LeaveApplicationID ?>
		<th class="<?php echo $leave_applications_delete->LeaveApplicationID->headerCellClass() ?>"><span id="elh_leave_applications_LeaveApplicationID" class="leave_applications_LeaveApplicationID"><?php echo $leave_applications_delete->LeaveApplicationID->caption() ?></span></th>
<?php } ?>
<?php if ($leave_applications_delete->EmployeeID->Visible) { // EmployeeID ?>
		<th class="<?php echo $leave_applications_delete->EmployeeID->headerCellClass() ?>"><span id="elh_leave_applications_EmployeeID" class="leave_applications_EmployeeID"><?php echo $leave_applications_delete->EmployeeID->caption() ?></span></th>
<?php } ?>
<?php if ($leave_applications_delete->StartDate->Visible) { // StartDate ?>
		<th class="<?php echo $leave_applications_delete->StartDate->headerCellClass() ?>"><span id="elh_leave_applications_StartDate" class="leave_applications_StartDate"><?php echo $leave_applications_delete->StartDate->caption() ?></span></th>
<?php } ?>
<?php if ($leave_applications_delete->EndDate->Visible) { // EndDate ?>
		<th class="<?php echo $leave_applications_delete->EndDate->headerCellClass() ?>"><span id="elh_leave_applications_EndDate" class="leave_applications_EndDate"><?php echo $leave_applications_delete->EndDate->caption() ?></span></th>
<?php } ?>
<?php if ($leave_applications_delete->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<th class="<?php echo $leave_applications_delete->LeaveTypeCode->headerCellClass() ?>"><span id="elh_leave_applications_LeaveTypeCode" class="leave_applications_LeaveTypeCode"><?php echo $leave_applications_delete->LeaveTypeCode->caption() ?></span></th>
<?php } ?>
<?php if ($leave_applications_delete->Location->Visible) { // Location ?>
		<th class="<?php echo $leave_applications_delete->Location->headerCellClass() ?>"><span id="elh_leave_applications_Location" class="leave_applications_Location"><?php echo $leave_applications_delete->Location->caption() ?></span></th>
<?php } ?>
<?php if ($leave_applications_delete->Status->Visible) { // Status ?>
		<th class="<?php echo $leave_applications_delete->Status->headerCellClass() ?>"><span id="elh_leave_applications_Status" class="leave_applications_Status"><?php echo $leave_applications_delete->Status->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$leave_applications_delete->RecordCount = 0;
$i = 0;
while (!$leave_applications_delete->Recordset->EOF) {
	$leave_applications_delete->RecordCount++;
	$leave_applications_delete->RowCount++;

	// Set row properties
	$leave_applications->resetAttributes();
	$leave_applications->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$leave_applications_delete->loadRowValues($leave_applications_delete->Recordset);

	// Render row
	$leave_applications_delete->renderRow();
?>
	<tr <?php echo $leave_applications->rowAttributes() ?>>
<?php if ($leave_applications_delete->LeaveApplicationID->Visible) { // LeaveApplicationID ?>
		<td <?php echo $leave_applications_delete->LeaveApplicationID->cellAttributes() ?>>
<span id="el<?php echo $leave_applications_delete->RowCount ?>_leave_applications_LeaveApplicationID" class="leave_applications_LeaveApplicationID">
<span<?php echo $leave_applications_delete->LeaveApplicationID->viewAttributes() ?>><?php echo $leave_applications_delete->LeaveApplicationID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_applications_delete->EmployeeID->Visible) { // EmployeeID ?>
		<td <?php echo $leave_applications_delete->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $leave_applications_delete->RowCount ?>_leave_applications_EmployeeID" class="leave_applications_EmployeeID">
<span<?php echo $leave_applications_delete->EmployeeID->viewAttributes() ?>><?php echo $leave_applications_delete->EmployeeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_applications_delete->StartDate->Visible) { // StartDate ?>
		<td <?php echo $leave_applications_delete->StartDate->cellAttributes() ?>>
<span id="el<?php echo $leave_applications_delete->RowCount ?>_leave_applications_StartDate" class="leave_applications_StartDate">
<span<?php echo $leave_applications_delete->StartDate->viewAttributes() ?>><?php echo $leave_applications_delete->StartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_applications_delete->EndDate->Visible) { // EndDate ?>
		<td <?php echo $leave_applications_delete->EndDate->cellAttributes() ?>>
<span id="el<?php echo $leave_applications_delete->RowCount ?>_leave_applications_EndDate" class="leave_applications_EndDate">
<span<?php echo $leave_applications_delete->EndDate->viewAttributes() ?>><?php echo $leave_applications_delete->EndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_applications_delete->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<td <?php echo $leave_applications_delete->LeaveTypeCode->cellAttributes() ?>>
<span id="el<?php echo $leave_applications_delete->RowCount ?>_leave_applications_LeaveTypeCode" class="leave_applications_LeaveTypeCode">
<span<?php echo $leave_applications_delete->LeaveTypeCode->viewAttributes() ?>><?php echo $leave_applications_delete->LeaveTypeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_applications_delete->Location->Visible) { // Location ?>
		<td <?php echo $leave_applications_delete->Location->cellAttributes() ?>>
<span id="el<?php echo $leave_applications_delete->RowCount ?>_leave_applications_Location" class="leave_applications_Location">
<span<?php echo $leave_applications_delete->Location->viewAttributes() ?>><?php echo $leave_applications_delete->Location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_applications_delete->Status->Visible) { // Status ?>
		<td <?php echo $leave_applications_delete->Status->cellAttributes() ?>>
<span id="el<?php echo $leave_applications_delete->RowCount ?>_leave_applications_Status" class="leave_applications_Status">
<span<?php echo $leave_applications_delete->Status->viewAttributes() ?>><?php echo $leave_applications_delete->Status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$leave_applications_delete->Recordset->moveNext();
}
$leave_applications_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $leave_applications_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$leave_applications_delete->showPageFooter();
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
$leave_applications_delete->terminate();
?>