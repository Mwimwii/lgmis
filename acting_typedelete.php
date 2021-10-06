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
$acting_type_delete = new acting_type_delete();

// Run the page
$acting_type_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acting_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var facting_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	facting_typedelete = currentForm = new ew.Form("facting_typedelete", "delete");
	loadjs.done("facting_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $acting_type_delete->showPageHeader(); ?>
<?php
$acting_type_delete->showMessage();
?>
<form name="facting_typedelete" id="facting_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acting_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($acting_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($acting_type_delete->ActingType->Visible) { // ActingType ?>
		<th class="<?php echo $acting_type_delete->ActingType->headerCellClass() ?>"><span id="elh_acting_type_ActingType" class="acting_type_ActingType"><?php echo $acting_type_delete->ActingType->caption() ?></span></th>
<?php } ?>
<?php if ($acting_type_delete->ActingTypeDesc->Visible) { // ActingTypeDesc ?>
		<th class="<?php echo $acting_type_delete->ActingTypeDesc->headerCellClass() ?>"><span id="elh_acting_type_ActingTypeDesc" class="acting_type_ActingTypeDesc"><?php echo $acting_type_delete->ActingTypeDesc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$acting_type_delete->RecordCount = 0;
$i = 0;
while (!$acting_type_delete->Recordset->EOF) {
	$acting_type_delete->RecordCount++;
	$acting_type_delete->RowCount++;

	// Set row properties
	$acting_type->resetAttributes();
	$acting_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$acting_type_delete->loadRowValues($acting_type_delete->Recordset);

	// Render row
	$acting_type_delete->renderRow();
?>
	<tr <?php echo $acting_type->rowAttributes() ?>>
<?php if ($acting_type_delete->ActingType->Visible) { // ActingType ?>
		<td <?php echo $acting_type_delete->ActingType->cellAttributes() ?>>
<span id="el<?php echo $acting_type_delete->RowCount ?>_acting_type_ActingType" class="acting_type_ActingType">
<span<?php echo $acting_type_delete->ActingType->viewAttributes() ?>><?php echo $acting_type_delete->ActingType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($acting_type_delete->ActingTypeDesc->Visible) { // ActingTypeDesc ?>
		<td <?php echo $acting_type_delete->ActingTypeDesc->cellAttributes() ?>>
<span id="el<?php echo $acting_type_delete->RowCount ?>_acting_type_ActingTypeDesc" class="acting_type_ActingTypeDesc">
<span<?php echo $acting_type_delete->ActingTypeDesc->viewAttributes() ?>><?php echo $acting_type_delete->ActingTypeDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$acting_type_delete->Recordset->moveNext();
}
$acting_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $acting_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$acting_type_delete->showPageFooter();
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
$acting_type_delete->terminate();
?>