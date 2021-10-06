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
$asset_type_delete = new asset_type_delete();

// Run the page
$asset_type_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$asset_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fasset_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fasset_typedelete = currentForm = new ew.Form("fasset_typedelete", "delete");
	loadjs.done("fasset_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $asset_type_delete->showPageHeader(); ?>
<?php
$asset_type_delete->showMessage();
?>
<form name="fasset_typedelete" id="fasset_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="asset_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($asset_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($asset_type_delete->AssetTypeCode->Visible) { // AssetTypeCode ?>
		<th class="<?php echo $asset_type_delete->AssetTypeCode->headerCellClass() ?>"><span id="elh_asset_type_AssetTypeCode" class="asset_type_AssetTypeCode"><?php echo $asset_type_delete->AssetTypeCode->caption() ?></span></th>
<?php } ?>
<?php if ($asset_type_delete->AssetTypeName->Visible) { // AssetTypeName ?>
		<th class="<?php echo $asset_type_delete->AssetTypeName->headerCellClass() ?>"><span id="elh_asset_type_AssetTypeName" class="asset_type_AssetTypeName"><?php echo $asset_type_delete->AssetTypeName->caption() ?></span></th>
<?php } ?>
<?php if ($asset_type_delete->AssetsTypeDesc->Visible) { // AssetsTypeDesc ?>
		<th class="<?php echo $asset_type_delete->AssetsTypeDesc->headerCellClass() ?>"><span id="elh_asset_type_AssetsTypeDesc" class="asset_type_AssetsTypeDesc"><?php echo $asset_type_delete->AssetsTypeDesc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$asset_type_delete->RecordCount = 0;
$i = 0;
while (!$asset_type_delete->Recordset->EOF) {
	$asset_type_delete->RecordCount++;
	$asset_type_delete->RowCount++;

	// Set row properties
	$asset_type->resetAttributes();
	$asset_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$asset_type_delete->loadRowValues($asset_type_delete->Recordset);

	// Render row
	$asset_type_delete->renderRow();
?>
	<tr <?php echo $asset_type->rowAttributes() ?>>
<?php if ($asset_type_delete->AssetTypeCode->Visible) { // AssetTypeCode ?>
		<td <?php echo $asset_type_delete->AssetTypeCode->cellAttributes() ?>>
<span id="el<?php echo $asset_type_delete->RowCount ?>_asset_type_AssetTypeCode" class="asset_type_AssetTypeCode">
<span<?php echo $asset_type_delete->AssetTypeCode->viewAttributes() ?>><?php echo $asset_type_delete->AssetTypeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_type_delete->AssetTypeName->Visible) { // AssetTypeName ?>
		<td <?php echo $asset_type_delete->AssetTypeName->cellAttributes() ?>>
<span id="el<?php echo $asset_type_delete->RowCount ?>_asset_type_AssetTypeName" class="asset_type_AssetTypeName">
<span<?php echo $asset_type_delete->AssetTypeName->viewAttributes() ?>><?php echo $asset_type_delete->AssetTypeName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_type_delete->AssetsTypeDesc->Visible) { // AssetsTypeDesc ?>
		<td <?php echo $asset_type_delete->AssetsTypeDesc->cellAttributes() ?>>
<span id="el<?php echo $asset_type_delete->RowCount ?>_asset_type_AssetsTypeDesc" class="asset_type_AssetsTypeDesc">
<span<?php echo $asset_type_delete->AssetsTypeDesc->viewAttributes() ?>><?php echo $asset_type_delete->AssetsTypeDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$asset_type_delete->Recordset->moveNext();
}
$asset_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $asset_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$asset_type_delete->showPageFooter();
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
$asset_type_delete->terminate();
?>