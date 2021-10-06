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
$council_meeting_view = new council_meeting_view();

// Run the page
$council_meeting_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$council_meeting_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$council_meeting_view->isExport()) { ?>
<script>
var fcouncil_meetingview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcouncil_meetingview = currentForm = new ew.Form("fcouncil_meetingview", "view");
	loadjs.done("fcouncil_meetingview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$council_meeting_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $council_meeting_view->ExportOptions->render("body") ?>
<?php $council_meeting_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $council_meeting_view->showPageHeader(); ?>
<?php
$council_meeting_view->showMessage();
?>
<?php if (!$council_meeting_view->IsModal) { ?>
<?php if (!$council_meeting_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $council_meeting_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcouncil_meetingview" id="fcouncil_meetingview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="council_meeting">
<input type="hidden" name="modal" value="<?php echo (int)$council_meeting_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($council_meeting_view->MeetingNo->Visible) { // MeetingNo ?>
	<tr id="r_MeetingNo">
		<td class="<?php echo $council_meeting_view->TableLeftColumnClass ?>"><span id="elh_council_meeting_MeetingNo"><?php echo $council_meeting_view->MeetingNo->caption() ?></span></td>
		<td data-name="MeetingNo" <?php echo $council_meeting_view->MeetingNo->cellAttributes() ?>>
<span id="el_council_meeting_MeetingNo">
<span<?php echo $council_meeting_view->MeetingNo->viewAttributes() ?>><?php echo $council_meeting_view->MeetingNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($council_meeting_view->MeetingRef->Visible) { // MeetingRef ?>
	<tr id="r_MeetingRef">
		<td class="<?php echo $council_meeting_view->TableLeftColumnClass ?>"><span id="elh_council_meeting_MeetingRef"><?php echo $council_meeting_view->MeetingRef->caption() ?></span></td>
		<td data-name="MeetingRef" <?php echo $council_meeting_view->MeetingRef->cellAttributes() ?>>
<span id="el_council_meeting_MeetingRef">
<span<?php echo $council_meeting_view->MeetingRef->viewAttributes() ?>><?php echo $council_meeting_view->MeetingRef->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($council_meeting_view->MeetingType->Visible) { // MeetingType ?>
	<tr id="r_MeetingType">
		<td class="<?php echo $council_meeting_view->TableLeftColumnClass ?>"><span id="elh_council_meeting_MeetingType"><?php echo $council_meeting_view->MeetingType->caption() ?></span></td>
		<td data-name="MeetingType" <?php echo $council_meeting_view->MeetingType->cellAttributes() ?>>
<span id="el_council_meeting_MeetingType">
<span<?php echo $council_meeting_view->MeetingType->viewAttributes() ?>><?php echo $council_meeting_view->MeetingType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($council_meeting_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $council_meeting_view->TableLeftColumnClass ?>"><span id="elh_council_meeting_LACode"><?php echo $council_meeting_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $council_meeting_view->LACode->cellAttributes() ?>>
<span id="el_council_meeting_LACode">
<span<?php echo $council_meeting_view->LACode->viewAttributes() ?>><?php echo $council_meeting_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($council_meeting_view->PlannedDate->Visible) { // PlannedDate ?>
	<tr id="r_PlannedDate">
		<td class="<?php echo $council_meeting_view->TableLeftColumnClass ?>"><span id="elh_council_meeting_PlannedDate"><?php echo $council_meeting_view->PlannedDate->caption() ?></span></td>
		<td data-name="PlannedDate" <?php echo $council_meeting_view->PlannedDate->cellAttributes() ?>>
<span id="el_council_meeting_PlannedDate">
<span<?php echo $council_meeting_view->PlannedDate->viewAttributes() ?>><?php echo $council_meeting_view->PlannedDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($council_meeting_view->ActualDate->Visible) { // ActualDate ?>
	<tr id="r_ActualDate">
		<td class="<?php echo $council_meeting_view->TableLeftColumnClass ?>"><span id="elh_council_meeting_ActualDate"><?php echo $council_meeting_view->ActualDate->caption() ?></span></td>
		<td data-name="ActualDate" <?php echo $council_meeting_view->ActualDate->cellAttributes() ?>>
<span id="el_council_meeting_ActualDate">
<span<?php echo $council_meeting_view->ActualDate->viewAttributes() ?>><?php echo $council_meeting_view->ActualDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($council_meeting_view->Attendance->Visible) { // Attendance ?>
	<tr id="r_Attendance">
		<td class="<?php echo $council_meeting_view->TableLeftColumnClass ?>"><span id="elh_council_meeting_Attendance"><?php echo $council_meeting_view->Attendance->caption() ?></span></td>
		<td data-name="Attendance" <?php echo $council_meeting_view->Attendance->cellAttributes() ?>>
<span id="el_council_meeting_Attendance">
<span<?php echo $council_meeting_view->Attendance->viewAttributes() ?>><?php echo $council_meeting_view->Attendance->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($council_meeting_view->ChairedBy->Visible) { // ChairedBy ?>
	<tr id="r_ChairedBy">
		<td class="<?php echo $council_meeting_view->TableLeftColumnClass ?>"><span id="elh_council_meeting_ChairedBy"><?php echo $council_meeting_view->ChairedBy->caption() ?></span></td>
		<td data-name="ChairedBy" <?php echo $council_meeting_view->ChairedBy->cellAttributes() ?>>
<span id="el_council_meeting_ChairedBy">
<span<?php echo $council_meeting_view->ChairedBy->viewAttributes() ?>><?php echo $council_meeting_view->ChairedBy->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($council_meeting_view->Minutes->Visible) { // Minutes ?>
	<tr id="r_Minutes">
		<td class="<?php echo $council_meeting_view->TableLeftColumnClass ?>"><span id="elh_council_meeting_Minutes"><?php echo $council_meeting_view->Minutes->caption() ?></span></td>
		<td data-name="Minutes" <?php echo $council_meeting_view->Minutes->cellAttributes() ?>>
<span id="el_council_meeting_Minutes">
<span<?php echo $council_meeting_view->Minutes->viewAttributes() ?>><?php echo $council_meeting_view->Minutes->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($council_meeting_view->MinutesUploaded->Visible) { // MinutesUploaded ?>
	<tr id="r_MinutesUploaded">
		<td class="<?php echo $council_meeting_view->TableLeftColumnClass ?>"><span id="elh_council_meeting_MinutesUploaded"><?php echo $council_meeting_view->MinutesUploaded->caption() ?></span></td>
		<td data-name="MinutesUploaded" <?php echo $council_meeting_view->MinutesUploaded->cellAttributes() ?>>
<span id="el_council_meeting_MinutesUploaded">
<span<?php echo $council_meeting_view->MinutesUploaded->viewAttributes() ?>><?php echo GetFileViewTag($council_meeting_view->MinutesUploaded, $council_meeting_view->MinutesUploaded->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$council_meeting_view->IsModal) { ?>
<?php if (!$council_meeting_view->isExport()) { ?>
<?php echo $council_meeting_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("council_resolution", explode(",", $council_meeting->getCurrentDetailTable())) && $council_resolution->DetailView) {
?>
<?php if ($council_meeting->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("council_resolution", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "council_resolutiongrid.php" ?>
<?php } ?>
</form>
<?php
$council_meeting_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$council_meeting_view->isExport()) { ?>
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
$council_meeting_view->terminate();
?>