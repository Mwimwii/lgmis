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
$equipment_type_delete = new equipment_type_delete();

// Run the page
$equipment_type_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$equipment_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fequipment_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fequipment_typedelete = currentForm = new ew.Form("fequipment_typedelete", "delete");
	loadjs.done("fequipment_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $equipment_type_delete->showPageHeader(); ?>
<?php
$equipment_type_delete->showMessage();
?>
<form name="fequipment_typedelete" id="fequipment_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="equipment_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($equipment_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($equipment_type_delete->EquipmentType->Visible) { // EquipmentType ?>
		<th class="<?php echo $equipment_type_delete->EquipmentType->headerCellClass() ?>"><span id="elh_equipment_type_EquipmentType" class="equipment_type_EquipmentType"><?php echo $equipment_type_delete->EquipmentType->caption() ?></span></th>
<?php } ?>
<?php if ($equipment_type_delete->EquipmentName->Visible) { // EquipmentName ?>
		<th class="<?php echo $equipment_type_delete->EquipmentName->headerCellClass() ?>"><span id="elh_equipment_type_EquipmentName" class="equipment_type_EquipmentName"><?php echo $equipment_type_delete->EquipmentName->caption() ?></span></th>
<?php } ?>
<?php if ($equipment_type_delete->EquipmentDesc->Visible) { // EquipmentDesc ?>
		<th class="<?php echo $equipment_type_delete->EquipmentDesc->headerCellClass() ?>"><span id="elh_equipment_type_EquipmentDesc" class="equipment_type_EquipmentDesc"><?php echo $equipment_type_delete->EquipmentDesc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$equipment_type_delete->RecordCount = 0;
$i = 0;
while (!$equipment_type_delete->Recordset->EOF) {
	$equipment_type_delete->RecordCount++;
	$equipment_type_delete->RowCount++;

	// Set row properties
	$equipment_type->resetAttributes();
	$equipment_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$equipment_type_delete->loadRowValues($equipment_type_delete->Recordset);

	// Render row
	$equipment_type_delete->renderRow();
?>
	<tr <?php echo $equipment_type->rowAttributes() ?>>
<?php if ($equipment_type_delete->EquipmentType->Visible) { // EquipmentType ?>
		<td <?php echo $equipment_type_delete->EquipmentType->cellAttributes() ?>>
<span id="el<?php echo $equipment_type_delete->RowCount ?>_equipment_type_EquipmentType" class="equipment_type_EquipmentType">
<span<?php echo $equipment_type_delete->EquipmentType->viewAttributes() ?>><?php echo $equipment_type_delete->EquipmentType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($equipment_type_delete->EquipmentName->Visible) { // EquipmentName ?>
		<td <?php echo $equipment_type_delete->EquipmentName->cellAttributes() ?>>
<span id="el<?php echo $equipment_type_delete->RowCount ?>_equipment_type_EquipmentName" class="equipment_type_EquipmentName">
<span<?php echo $equipment_type_delete->EquipmentName->viewAttributes() ?>><?php echo $equipment_type_delete->EquipmentName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($equipment_type_delete->EquipmentDesc->Visible) { // EquipmentDesc ?>
		<td <?php echo $equipment_type_delete->EquipmentDesc->cellAttributes() ?>>
<span id="el<?php echo $equipment_type_delete->RowCount ?>_equipment_type_EquipmentDesc" class="equipment_type_EquipmentDesc">
<span<?php echo $equipment_type_delete->EquipmentDesc->viewAttributes() ?>><?php echo $equipment_type_delete->EquipmentDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$equipment_type_delete->Recordset->moveNext();
}
$equipment_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $equipment_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$equipment_type_delete->showPageFooter();
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
$equipment_type_delete->terminate();
?>