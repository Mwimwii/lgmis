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
$property_group_delete = new property_group_delete();

// Run the page
$property_group_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_group_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproperty_groupdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fproperty_groupdelete = currentForm = new ew.Form("fproperty_groupdelete", "delete");
	loadjs.done("fproperty_groupdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $property_group_delete->showPageHeader(); ?>
<?php
$property_group_delete->showMessage();
?>
<form name="fproperty_groupdelete" id="fproperty_groupdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_group">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($property_group_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($property_group_delete->PropertyGroup->Visible) { // PropertyGroup ?>
		<th class="<?php echo $property_group_delete->PropertyGroup->headerCellClass() ?>"><span id="elh_property_group_PropertyGroup" class="property_group_PropertyGroup"><?php echo $property_group_delete->PropertyGroup->caption() ?></span></th>
<?php } ?>
<?php if ($property_group_delete->PropertyGroupDesc->Visible) { // PropertyGroupDesc ?>
		<th class="<?php echo $property_group_delete->PropertyGroupDesc->headerCellClass() ?>"><span id="elh_property_group_PropertyGroupDesc" class="property_group_PropertyGroupDesc"><?php echo $property_group_delete->PropertyGroupDesc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$property_group_delete->RecordCount = 0;
$i = 0;
while (!$property_group_delete->Recordset->EOF) {
	$property_group_delete->RecordCount++;
	$property_group_delete->RowCount++;

	// Set row properties
	$property_group->resetAttributes();
	$property_group->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$property_group_delete->loadRowValues($property_group_delete->Recordset);

	// Render row
	$property_group_delete->renderRow();
?>
	<tr <?php echo $property_group->rowAttributes() ?>>
<?php if ($property_group_delete->PropertyGroup->Visible) { // PropertyGroup ?>
		<td <?php echo $property_group_delete->PropertyGroup->cellAttributes() ?>>
<span id="el<?php echo $property_group_delete->RowCount ?>_property_group_PropertyGroup" class="property_group_PropertyGroup">
<span<?php echo $property_group_delete->PropertyGroup->viewAttributes() ?>><?php echo $property_group_delete->PropertyGroup->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_group_delete->PropertyGroupDesc->Visible) { // PropertyGroupDesc ?>
		<td <?php echo $property_group_delete->PropertyGroupDesc->cellAttributes() ?>>
<span id="el<?php echo $property_group_delete->RowCount ?>_property_group_PropertyGroupDesc" class="property_group_PropertyGroupDesc">
<span<?php echo $property_group_delete->PropertyGroupDesc->viewAttributes() ?>><?php echo $property_group_delete->PropertyGroupDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$property_group_delete->Recordset->moveNext();
}
$property_group_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_group_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$property_group_delete->showPageFooter();
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
$property_group_delete->terminate();
?>