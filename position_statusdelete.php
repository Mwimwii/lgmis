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
$position_status_delete = new position_status_delete();

// Run the page
$position_status_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$position_status_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fposition_statusdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fposition_statusdelete = currentForm = new ew.Form("fposition_statusdelete", "delete");
	loadjs.done("fposition_statusdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $position_status_delete->showPageHeader(); ?>
<?php
$position_status_delete->showMessage();
?>
<form name="fposition_statusdelete" id="fposition_statusdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="position_status">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($position_status_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($position_status_delete->PositionStatus->Visible) { // PositionStatus ?>
		<th class="<?php echo $position_status_delete->PositionStatus->headerCellClass() ?>"><span id="elh_position_status_PositionStatus" class="position_status_PositionStatus"><?php echo $position_status_delete->PositionStatus->caption() ?></span></th>
<?php } ?>
<?php if ($position_status_delete->PositionStatusDesc->Visible) { // PositionStatusDesc ?>
		<th class="<?php echo $position_status_delete->PositionStatusDesc->headerCellClass() ?>"><span id="elh_position_status_PositionStatusDesc" class="position_status_PositionStatusDesc"><?php echo $position_status_delete->PositionStatusDesc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$position_status_delete->RecordCount = 0;
$i = 0;
while (!$position_status_delete->Recordset->EOF) {
	$position_status_delete->RecordCount++;
	$position_status_delete->RowCount++;

	// Set row properties
	$position_status->resetAttributes();
	$position_status->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$position_status_delete->loadRowValues($position_status_delete->Recordset);

	// Render row
	$position_status_delete->renderRow();
?>
	<tr <?php echo $position_status->rowAttributes() ?>>
<?php if ($position_status_delete->PositionStatus->Visible) { // PositionStatus ?>
		<td <?php echo $position_status_delete->PositionStatus->cellAttributes() ?>>
<span id="el<?php echo $position_status_delete->RowCount ?>_position_status_PositionStatus" class="position_status_PositionStatus">
<span<?php echo $position_status_delete->PositionStatus->viewAttributes() ?>><?php echo $position_status_delete->PositionStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($position_status_delete->PositionStatusDesc->Visible) { // PositionStatusDesc ?>
		<td <?php echo $position_status_delete->PositionStatusDesc->cellAttributes() ?>>
<span id="el<?php echo $position_status_delete->RowCount ?>_position_status_PositionStatusDesc" class="position_status_PositionStatusDesc">
<span<?php echo $position_status_delete->PositionStatusDesc->viewAttributes() ?>><?php echo $position_status_delete->PositionStatusDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$position_status_delete->Recordset->moveNext();
}
$position_status_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $position_status_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$position_status_delete->showPageFooter();
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
$position_status_delete->terminate();
?>