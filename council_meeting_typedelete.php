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
$council_meeting_type_delete = new council_meeting_type_delete();

// Run the page
$council_meeting_type_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$council_meeting_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncil_meeting_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcouncil_meeting_typedelete = currentForm = new ew.Form("fcouncil_meeting_typedelete", "delete");
	loadjs.done("fcouncil_meeting_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $council_meeting_type_delete->showPageHeader(); ?>
<?php
$council_meeting_type_delete->showMessage();
?>
<form name="fcouncil_meeting_typedelete" id="fcouncil_meeting_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="council_meeting_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($council_meeting_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($council_meeting_type_delete->MeetingType->Visible) { // MeetingType ?>
		<th class="<?php echo $council_meeting_type_delete->MeetingType->headerCellClass() ?>"><span id="elh_council_meeting_type_MeetingType" class="council_meeting_type_MeetingType"><?php echo $council_meeting_type_delete->MeetingType->caption() ?></span></th>
<?php } ?>
<?php if ($council_meeting_type_delete->MeetingTypeName->Visible) { // MeetingTypeName ?>
		<th class="<?php echo $council_meeting_type_delete->MeetingTypeName->headerCellClass() ?>"><span id="elh_council_meeting_type_MeetingTypeName" class="council_meeting_type_MeetingTypeName"><?php echo $council_meeting_type_delete->MeetingTypeName->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$council_meeting_type_delete->RecordCount = 0;
$i = 0;
while (!$council_meeting_type_delete->Recordset->EOF) {
	$council_meeting_type_delete->RecordCount++;
	$council_meeting_type_delete->RowCount++;

	// Set row properties
	$council_meeting_type->resetAttributes();
	$council_meeting_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$council_meeting_type_delete->loadRowValues($council_meeting_type_delete->Recordset);

	// Render row
	$council_meeting_type_delete->renderRow();
?>
	<tr <?php echo $council_meeting_type->rowAttributes() ?>>
<?php if ($council_meeting_type_delete->MeetingType->Visible) { // MeetingType ?>
		<td <?php echo $council_meeting_type_delete->MeetingType->cellAttributes() ?>>
<span id="el<?php echo $council_meeting_type_delete->RowCount ?>_council_meeting_type_MeetingType" class="council_meeting_type_MeetingType">
<span<?php echo $council_meeting_type_delete->MeetingType->viewAttributes() ?>><?php echo $council_meeting_type_delete->MeetingType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($council_meeting_type_delete->MeetingTypeName->Visible) { // MeetingTypeName ?>
		<td <?php echo $council_meeting_type_delete->MeetingTypeName->cellAttributes() ?>>
<span id="el<?php echo $council_meeting_type_delete->RowCount ?>_council_meeting_type_MeetingTypeName" class="council_meeting_type_MeetingTypeName">
<span<?php echo $council_meeting_type_delete->MeetingTypeName->viewAttributes() ?>><?php echo $council_meeting_type_delete->MeetingTypeName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$council_meeting_type_delete->Recordset->moveNext();
}
$council_meeting_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $council_meeting_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$council_meeting_type_delete->showPageFooter();
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
$council_meeting_type_delete->terminate();
?>