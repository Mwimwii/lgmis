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
$council_resolution_delete = new council_resolution_delete();

// Run the page
$council_resolution_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$council_resolution_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncil_resolutiondelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcouncil_resolutiondelete = currentForm = new ew.Form("fcouncil_resolutiondelete", "delete");
	loadjs.done("fcouncil_resolutiondelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $council_resolution_delete->showPageHeader(); ?>
<?php
$council_resolution_delete->showMessage();
?>
<form name="fcouncil_resolutiondelete" id="fcouncil_resolutiondelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="council_resolution">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($council_resolution_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($council_resolution_delete->MeetingNo->Visible) { // MeetingNo ?>
		<th class="<?php echo $council_resolution_delete->MeetingNo->headerCellClass() ?>"><span id="elh_council_resolution_MeetingNo" class="council_resolution_MeetingNo"><?php echo $council_resolution_delete->MeetingNo->caption() ?></span></th>
<?php } ?>
<?php if ($council_resolution_delete->MinuteNumber->Visible) { // MinuteNumber ?>
		<th class="<?php echo $council_resolution_delete->MinuteNumber->headerCellClass() ?>"><span id="elh_council_resolution_MinuteNumber" class="council_resolution_MinuteNumber"><?php echo $council_resolution_delete->MinuteNumber->caption() ?></span></th>
<?php } ?>
<?php if ($council_resolution_delete->Resolutionccategory->Visible) { // Resolutionccategory ?>
		<th class="<?php echo $council_resolution_delete->Resolutionccategory->headerCellClass() ?>"><span id="elh_council_resolution_Resolutionccategory" class="council_resolution_Resolutionccategory"><?php echo $council_resolution_delete->Resolutionccategory->caption() ?></span></th>
<?php } ?>
<?php if ($council_resolution_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $council_resolution_delete->LACode->headerCellClass() ?>"><span id="elh_council_resolution_LACode" class="council_resolution_LACode"><?php echo $council_resolution_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($council_resolution_delete->ResolutionNo->Visible) { // ResolutionNo ?>
		<th class="<?php echo $council_resolution_delete->ResolutionNo->headerCellClass() ?>"><span id="elh_council_resolution_ResolutionNo" class="council_resolution_ResolutionNo"><?php echo $council_resolution_delete->ResolutionNo->caption() ?></span></th>
<?php } ?>
<?php if ($council_resolution_delete->Responsibility->Visible) { // Responsibility ?>
		<th class="<?php echo $council_resolution_delete->Responsibility->headerCellClass() ?>"><span id="elh_council_resolution_Responsibility" class="council_resolution_Responsibility"><?php echo $council_resolution_delete->Responsibility->caption() ?></span></th>
<?php } ?>
<?php if ($council_resolution_delete->ActionDate->Visible) { // ActionDate ?>
		<th class="<?php echo $council_resolution_delete->ActionDate->headerCellClass() ?>"><span id="elh_council_resolution_ActionDate" class="council_resolution_ActionDate"><?php echo $council_resolution_delete->ActionDate->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$council_resolution_delete->RecordCount = 0;
$i = 0;
while (!$council_resolution_delete->Recordset->EOF) {
	$council_resolution_delete->RecordCount++;
	$council_resolution_delete->RowCount++;

	// Set row properties
	$council_resolution->resetAttributes();
	$council_resolution->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$council_resolution_delete->loadRowValues($council_resolution_delete->Recordset);

	// Render row
	$council_resolution_delete->renderRow();
?>
	<tr <?php echo $council_resolution->rowAttributes() ?>>
<?php if ($council_resolution_delete->MeetingNo->Visible) { // MeetingNo ?>
		<td <?php echo $council_resolution_delete->MeetingNo->cellAttributes() ?>>
<span id="el<?php echo $council_resolution_delete->RowCount ?>_council_resolution_MeetingNo" class="council_resolution_MeetingNo">
<span<?php echo $council_resolution_delete->MeetingNo->viewAttributes() ?>><?php echo $council_resolution_delete->MeetingNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($council_resolution_delete->MinuteNumber->Visible) { // MinuteNumber ?>
		<td <?php echo $council_resolution_delete->MinuteNumber->cellAttributes() ?>>
<span id="el<?php echo $council_resolution_delete->RowCount ?>_council_resolution_MinuteNumber" class="council_resolution_MinuteNumber">
<span<?php echo $council_resolution_delete->MinuteNumber->viewAttributes() ?>><?php echo $council_resolution_delete->MinuteNumber->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($council_resolution_delete->Resolutionccategory->Visible) { // Resolutionccategory ?>
		<td <?php echo $council_resolution_delete->Resolutionccategory->cellAttributes() ?>>
<span id="el<?php echo $council_resolution_delete->RowCount ?>_council_resolution_Resolutionccategory" class="council_resolution_Resolutionccategory">
<span<?php echo $council_resolution_delete->Resolutionccategory->viewAttributes() ?>><?php echo $council_resolution_delete->Resolutionccategory->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($council_resolution_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $council_resolution_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $council_resolution_delete->RowCount ?>_council_resolution_LACode" class="council_resolution_LACode">
<span<?php echo $council_resolution_delete->LACode->viewAttributes() ?>><?php echo $council_resolution_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($council_resolution_delete->ResolutionNo->Visible) { // ResolutionNo ?>
		<td <?php echo $council_resolution_delete->ResolutionNo->cellAttributes() ?>>
<span id="el<?php echo $council_resolution_delete->RowCount ?>_council_resolution_ResolutionNo" class="council_resolution_ResolutionNo">
<span<?php echo $council_resolution_delete->ResolutionNo->viewAttributes() ?>><?php echo $council_resolution_delete->ResolutionNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($council_resolution_delete->Responsibility->Visible) { // Responsibility ?>
		<td <?php echo $council_resolution_delete->Responsibility->cellAttributes() ?>>
<span id="el<?php echo $council_resolution_delete->RowCount ?>_council_resolution_Responsibility" class="council_resolution_Responsibility">
<span<?php echo $council_resolution_delete->Responsibility->viewAttributes() ?>><?php echo $council_resolution_delete->Responsibility->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($council_resolution_delete->ActionDate->Visible) { // ActionDate ?>
		<td <?php echo $council_resolution_delete->ActionDate->cellAttributes() ?>>
<span id="el<?php echo $council_resolution_delete->RowCount ?>_council_resolution_ActionDate" class="council_resolution_ActionDate">
<span<?php echo $council_resolution_delete->ActionDate->viewAttributes() ?>><?php echo $council_resolution_delete->ActionDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$council_resolution_delete->Recordset->moveNext();
}
$council_resolution_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $council_resolution_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$council_resolution_delete->showPageFooter();
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
$council_resolution_delete->terminate();
?>