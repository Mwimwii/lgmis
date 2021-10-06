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
$leave_type_delete = new leave_type_delete();

// Run the page
$leave_type_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fleave_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fleave_typedelete = currentForm = new ew.Form("fleave_typedelete", "delete");
	loadjs.done("fleave_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $leave_type_delete->showPageHeader(); ?>
<?php
$leave_type_delete->showMessage();
?>
<form name="fleave_typedelete" id="fleave_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($leave_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($leave_type_delete->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<th class="<?php echo $leave_type_delete->LeaveTypeCode->headerCellClass() ?>"><span id="elh_leave_type_LeaveTypeCode" class="leave_type_LeaveTypeCode"><?php echo $leave_type_delete->LeaveTypeCode->caption() ?></span></th>
<?php } ?>
<?php if ($leave_type_delete->LeaveTypeName->Visible) { // LeaveTypeName ?>
		<th class="<?php echo $leave_type_delete->LeaveTypeName->headerCellClass() ?>"><span id="elh_leave_type_LeaveTypeName" class="leave_type_LeaveTypeName"><?php echo $leave_type_delete->LeaveTypeName->caption() ?></span></th>
<?php } ?>
<?php if ($leave_type_delete->Accrued->Visible) { // Accrued ?>
		<th class="<?php echo $leave_type_delete->Accrued->headerCellClass() ?>"><span id="elh_leave_type_Accrued" class="leave_type_Accrued"><?php echo $leave_type_delete->Accrued->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$leave_type_delete->RecordCount = 0;
$i = 0;
while (!$leave_type_delete->Recordset->EOF) {
	$leave_type_delete->RecordCount++;
	$leave_type_delete->RowCount++;

	// Set row properties
	$leave_type->resetAttributes();
	$leave_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$leave_type_delete->loadRowValues($leave_type_delete->Recordset);

	// Render row
	$leave_type_delete->renderRow();
?>
	<tr <?php echo $leave_type->rowAttributes() ?>>
<?php if ($leave_type_delete->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<td <?php echo $leave_type_delete->LeaveTypeCode->cellAttributes() ?>>
<span id="el<?php echo $leave_type_delete->RowCount ?>_leave_type_LeaveTypeCode" class="leave_type_LeaveTypeCode">
<span<?php echo $leave_type_delete->LeaveTypeCode->viewAttributes() ?>><?php echo $leave_type_delete->LeaveTypeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_type_delete->LeaveTypeName->Visible) { // LeaveTypeName ?>
		<td <?php echo $leave_type_delete->LeaveTypeName->cellAttributes() ?>>
<span id="el<?php echo $leave_type_delete->RowCount ?>_leave_type_LeaveTypeName" class="leave_type_LeaveTypeName">
<span<?php echo $leave_type_delete->LeaveTypeName->viewAttributes() ?>><?php echo $leave_type_delete->LeaveTypeName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($leave_type_delete->Accrued->Visible) { // Accrued ?>
		<td <?php echo $leave_type_delete->Accrued->cellAttributes() ?>>
<span id="el<?php echo $leave_type_delete->RowCount ?>_leave_type_Accrued" class="leave_type_Accrued">
<span<?php echo $leave_type_delete->Accrued->viewAttributes() ?>><?php echo $leave_type_delete->Accrued->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$leave_type_delete->Recordset->moveNext();
}
$leave_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $leave_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$leave_type_delete->showPageFooter();
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
$leave_type_delete->terminate();
?>