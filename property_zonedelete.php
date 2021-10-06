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
$property_zone_delete = new property_zone_delete();

// Run the page
$property_zone_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_zone_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproperty_zonedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fproperty_zonedelete = currentForm = new ew.Form("fproperty_zonedelete", "delete");
	loadjs.done("fproperty_zonedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $property_zone_delete->showPageHeader(); ?>
<?php
$property_zone_delete->showMessage();
?>
<form name="fproperty_zonedelete" id="fproperty_zonedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_zone">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($property_zone_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($property_zone_delete->AreaCode->Visible) { // AreaCode ?>
		<th class="<?php echo $property_zone_delete->AreaCode->headerCellClass() ?>"><span id="elh_property_zone_AreaCode" class="property_zone_AreaCode"><?php echo $property_zone_delete->AreaCode->caption() ?></span></th>
<?php } ?>
<?php if ($property_zone_delete->AreaName->Visible) { // AreaName ?>
		<th class="<?php echo $property_zone_delete->AreaName->headerCellClass() ?>"><span id="elh_property_zone_AreaName" class="property_zone_AreaName"><?php echo $property_zone_delete->AreaName->caption() ?></span></th>
<?php } ?>
<?php if ($property_zone_delete->AreaType->Visible) { // AreaType ?>
		<th class="<?php echo $property_zone_delete->AreaType->headerCellClass() ?>"><span id="elh_property_zone_AreaType" class="property_zone_AreaType"><?php echo $property_zone_delete->AreaType->caption() ?></span></th>
<?php } ?>
<?php if ($property_zone_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $property_zone_delete->LACode->headerCellClass() ?>"><span id="elh_property_zone_LACode" class="property_zone_LACode"><?php echo $property_zone_delete->LACode->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$property_zone_delete->RecordCount = 0;
$i = 0;
while (!$property_zone_delete->Recordset->EOF) {
	$property_zone_delete->RecordCount++;
	$property_zone_delete->RowCount++;

	// Set row properties
	$property_zone->resetAttributes();
	$property_zone->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$property_zone_delete->loadRowValues($property_zone_delete->Recordset);

	// Render row
	$property_zone_delete->renderRow();
?>
	<tr <?php echo $property_zone->rowAttributes() ?>>
<?php if ($property_zone_delete->AreaCode->Visible) { // AreaCode ?>
		<td <?php echo $property_zone_delete->AreaCode->cellAttributes() ?>>
<span id="el<?php echo $property_zone_delete->RowCount ?>_property_zone_AreaCode" class="property_zone_AreaCode">
<span<?php echo $property_zone_delete->AreaCode->viewAttributes() ?>><?php echo $property_zone_delete->AreaCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_zone_delete->AreaName->Visible) { // AreaName ?>
		<td <?php echo $property_zone_delete->AreaName->cellAttributes() ?>>
<span id="el<?php echo $property_zone_delete->RowCount ?>_property_zone_AreaName" class="property_zone_AreaName">
<span<?php echo $property_zone_delete->AreaName->viewAttributes() ?>><?php echo $property_zone_delete->AreaName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_zone_delete->AreaType->Visible) { // AreaType ?>
		<td <?php echo $property_zone_delete->AreaType->cellAttributes() ?>>
<span id="el<?php echo $property_zone_delete->RowCount ?>_property_zone_AreaType" class="property_zone_AreaType">
<span<?php echo $property_zone_delete->AreaType->viewAttributes() ?>><?php echo $property_zone_delete->AreaType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_zone_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $property_zone_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $property_zone_delete->RowCount ?>_property_zone_LACode" class="property_zone_LACode">
<span<?php echo $property_zone_delete->LACode->viewAttributes() ?>><?php echo $property_zone_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$property_zone_delete->Recordset->moveNext();
}
$property_zone_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_zone_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$property_zone_delete->showPageFooter();
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
$property_zone_delete->terminate();
?>