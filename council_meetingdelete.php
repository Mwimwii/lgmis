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
$council_meeting_delete = new council_meeting_delete();

// Run the page
$council_meeting_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$council_meeting_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncil_meetingdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcouncil_meetingdelete = currentForm = new ew.Form("fcouncil_meetingdelete", "delete");
	loadjs.done("fcouncil_meetingdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $council_meeting_delete->showPageHeader(); ?>
<?php
$council_meeting_delete->showMessage();
?>
<form name="fcouncil_meetingdelete" id="fcouncil_meetingdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="council_meeting">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($council_meeting_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($council_meeting_delete->MeetingNo->Visible) { // MeetingNo ?>
		<th class="<?php echo $council_meeting_delete->MeetingNo->headerCellClass() ?>"><span id="elh_council_meeting_MeetingNo" class="council_meeting_MeetingNo"><?php echo $council_meeting_delete->MeetingNo->caption() ?></span></th>
<?php } ?>
<?php if ($council_meeting_delete->MeetingRef->Visible) { // MeetingRef ?>
		<th class="<?php echo $council_meeting_delete->MeetingRef->headerCellClass() ?>"><span id="elh_council_meeting_MeetingRef" class="council_meeting_MeetingRef"><?php echo $council_meeting_delete->MeetingRef->caption() ?></span></th>
<?php } ?>
<?php if ($council_meeting_delete->MeetingType->Visible) { // MeetingType ?>
		<th class="<?php echo $council_meeting_delete->MeetingType->headerCellClass() ?>"><span id="elh_council_meeting_MeetingType" class="council_meeting_MeetingType"><?php echo $council_meeting_delete->MeetingType->caption() ?></span></th>
<?php } ?>
<?php if ($council_meeting_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $council_meeting_delete->LACode->headerCellClass() ?>"><span id="elh_council_meeting_LACode" class="council_meeting_LACode"><?php echo $council_meeting_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($council_meeting_delete->PlannedDate->Visible) { // PlannedDate ?>
		<th class="<?php echo $council_meeting_delete->PlannedDate->headerCellClass() ?>"><span id="elh_council_meeting_PlannedDate" class="council_meeting_PlannedDate"><?php echo $council_meeting_delete->PlannedDate->caption() ?></span></th>
<?php } ?>
<?php if ($council_meeting_delete->ActualDate->Visible) { // ActualDate ?>
		<th class="<?php echo $council_meeting_delete->ActualDate->headerCellClass() ?>"><span id="elh_council_meeting_ActualDate" class="council_meeting_ActualDate"><?php echo $council_meeting_delete->ActualDate->caption() ?></span></th>
<?php } ?>
<?php if ($council_meeting_delete->Attendance->Visible) { // Attendance ?>
		<th class="<?php echo $council_meeting_delete->Attendance->headerCellClass() ?>"><span id="elh_council_meeting_Attendance" class="council_meeting_Attendance"><?php echo $council_meeting_delete->Attendance->caption() ?></span></th>
<?php } ?>
<?php if ($council_meeting_delete->ChairedBy->Visible) { // ChairedBy ?>
		<th class="<?php echo $council_meeting_delete->ChairedBy->headerCellClass() ?>"><span id="elh_council_meeting_ChairedBy" class="council_meeting_ChairedBy"><?php echo $council_meeting_delete->ChairedBy->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$council_meeting_delete->RecordCount = 0;
$i = 0;
while (!$council_meeting_delete->Recordset->EOF) {
	$council_meeting_delete->RecordCount++;
	$council_meeting_delete->RowCount++;

	// Set row properties
	$council_meeting->resetAttributes();
	$council_meeting->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$council_meeting_delete->loadRowValues($council_meeting_delete->Recordset);

	// Render row
	$council_meeting_delete->renderRow();
?>
	<tr <?php echo $council_meeting->rowAttributes() ?>>
<?php if ($council_meeting_delete->MeetingNo->Visible) { // MeetingNo ?>
		<td <?php echo $council_meeting_delete->MeetingNo->cellAttributes() ?>>
<span id="el<?php echo $council_meeting_delete->RowCount ?>_council_meeting_MeetingNo" class="council_meeting_MeetingNo">
<span<?php echo $council_meeting_delete->MeetingNo->viewAttributes() ?>><?php echo $council_meeting_delete->MeetingNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($council_meeting_delete->MeetingRef->Visible) { // MeetingRef ?>
		<td <?php echo $council_meeting_delete->MeetingRef->cellAttributes() ?>>
<span id="el<?php echo $council_meeting_delete->RowCount ?>_council_meeting_MeetingRef" class="council_meeting_MeetingRef">
<span<?php echo $council_meeting_delete->MeetingRef->viewAttributes() ?>><?php echo $council_meeting_delete->MeetingRef->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($council_meeting_delete->MeetingType->Visible) { // MeetingType ?>
		<td <?php echo $council_meeting_delete->MeetingType->cellAttributes() ?>>
<span id="el<?php echo $council_meeting_delete->RowCount ?>_council_meeting_MeetingType" class="council_meeting_MeetingType">
<span<?php echo $council_meeting_delete->MeetingType->viewAttributes() ?>><?php echo $council_meeting_delete->MeetingType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($council_meeting_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $council_meeting_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $council_meeting_delete->RowCount ?>_council_meeting_LACode" class="council_meeting_LACode">
<span<?php echo $council_meeting_delete->LACode->viewAttributes() ?>><?php echo $council_meeting_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($council_meeting_delete->PlannedDate->Visible) { // PlannedDate ?>
		<td <?php echo $council_meeting_delete->PlannedDate->cellAttributes() ?>>
<span id="el<?php echo $council_meeting_delete->RowCount ?>_council_meeting_PlannedDate" class="council_meeting_PlannedDate">
<span<?php echo $council_meeting_delete->PlannedDate->viewAttributes() ?>><?php echo $council_meeting_delete->PlannedDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($council_meeting_delete->ActualDate->Visible) { // ActualDate ?>
		<td <?php echo $council_meeting_delete->ActualDate->cellAttributes() ?>>
<span id="el<?php echo $council_meeting_delete->RowCount ?>_council_meeting_ActualDate" class="council_meeting_ActualDate">
<span<?php echo $council_meeting_delete->ActualDate->viewAttributes() ?>><?php echo $council_meeting_delete->ActualDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($council_meeting_delete->Attendance->Visible) { // Attendance ?>
		<td <?php echo $council_meeting_delete->Attendance->cellAttributes() ?>>
<span id="el<?php echo $council_meeting_delete->RowCount ?>_council_meeting_Attendance" class="council_meeting_Attendance">
<span<?php echo $council_meeting_delete->Attendance->viewAttributes() ?>><?php echo $council_meeting_delete->Attendance->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($council_meeting_delete->ChairedBy->Visible) { // ChairedBy ?>
		<td <?php echo $council_meeting_delete->ChairedBy->cellAttributes() ?>>
<span id="el<?php echo $council_meeting_delete->RowCount ?>_council_meeting_ChairedBy" class="council_meeting_ChairedBy">
<span<?php echo $council_meeting_delete->ChairedBy->viewAttributes() ?>><?php echo $council_meeting_delete->ChairedBy->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$council_meeting_delete->Recordset->moveNext();
}
$council_meeting_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $council_meeting_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$council_meeting_delete->showPageFooter();
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
$council_meeting_delete->terminate();
?>