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
$acting_status_delete = new acting_status_delete();

// Run the page
$acting_status_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acting_status_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var facting_statusdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	facting_statusdelete = currentForm = new ew.Form("facting_statusdelete", "delete");
	loadjs.done("facting_statusdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $acting_status_delete->showPageHeader(); ?>
<?php
$acting_status_delete->showMessage();
?>
<form name="facting_statusdelete" id="facting_statusdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acting_status">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($acting_status_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($acting_status_delete->ActingStatus->Visible) { // ActingStatus ?>
		<th class="<?php echo $acting_status_delete->ActingStatus->headerCellClass() ?>"><span id="elh_acting_status_ActingStatus" class="acting_status_ActingStatus"><?php echo $acting_status_delete->ActingStatus->caption() ?></span></th>
<?php } ?>
<?php if ($acting_status_delete->ActingStatusDesc->Visible) { // ActingStatusDesc ?>
		<th class="<?php echo $acting_status_delete->ActingStatusDesc->headerCellClass() ?>"><span id="elh_acting_status_ActingStatusDesc" class="acting_status_ActingStatusDesc"><?php echo $acting_status_delete->ActingStatusDesc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$acting_status_delete->RecordCount = 0;
$i = 0;
while (!$acting_status_delete->Recordset->EOF) {
	$acting_status_delete->RecordCount++;
	$acting_status_delete->RowCount++;

	// Set row properties
	$acting_status->resetAttributes();
	$acting_status->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$acting_status_delete->loadRowValues($acting_status_delete->Recordset);

	// Render row
	$acting_status_delete->renderRow();
?>
	<tr <?php echo $acting_status->rowAttributes() ?>>
<?php if ($acting_status_delete->ActingStatus->Visible) { // ActingStatus ?>
		<td <?php echo $acting_status_delete->ActingStatus->cellAttributes() ?>>
<span id="el<?php echo $acting_status_delete->RowCount ?>_acting_status_ActingStatus" class="acting_status_ActingStatus">
<span<?php echo $acting_status_delete->ActingStatus->viewAttributes() ?>><?php echo $acting_status_delete->ActingStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($acting_status_delete->ActingStatusDesc->Visible) { // ActingStatusDesc ?>
		<td <?php echo $acting_status_delete->ActingStatusDesc->cellAttributes() ?>>
<span id="el<?php echo $acting_status_delete->RowCount ?>_acting_status_ActingStatusDesc" class="acting_status_ActingStatusDesc">
<span<?php echo $acting_status_delete->ActingStatusDesc->viewAttributes() ?>><?php echo $acting_status_delete->ActingStatusDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$acting_status_delete->Recordset->moveNext();
}
$acting_status_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $acting_status_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$acting_status_delete->showPageFooter();
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
$acting_status_delete->terminate();
?>