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
$asset_status_delete = new asset_status_delete();

// Run the page
$asset_status_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$asset_status_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fasset_statusdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fasset_statusdelete = currentForm = new ew.Form("fasset_statusdelete", "delete");
	loadjs.done("fasset_statusdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $asset_status_delete->showPageHeader(); ?>
<?php
$asset_status_delete->showMessage();
?>
<form name="fasset_statusdelete" id="fasset_statusdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="asset_status">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($asset_status_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($asset_status_delete->AssetStatusCode->Visible) { // AssetStatusCode ?>
		<th class="<?php echo $asset_status_delete->AssetStatusCode->headerCellClass() ?>"><span id="elh_asset_status_AssetStatusCode" class="asset_status_AssetStatusCode"><?php echo $asset_status_delete->AssetStatusCode->caption() ?></span></th>
<?php } ?>
<?php if ($asset_status_delete->AssetStatus->Visible) { // AssetStatus ?>
		<th class="<?php echo $asset_status_delete->AssetStatus->headerCellClass() ?>"><span id="elh_asset_status_AssetStatus" class="asset_status_AssetStatus"><?php echo $asset_status_delete->AssetStatus->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$asset_status_delete->RecordCount = 0;
$i = 0;
while (!$asset_status_delete->Recordset->EOF) {
	$asset_status_delete->RecordCount++;
	$asset_status_delete->RowCount++;

	// Set row properties
	$asset_status->resetAttributes();
	$asset_status->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$asset_status_delete->loadRowValues($asset_status_delete->Recordset);

	// Render row
	$asset_status_delete->renderRow();
?>
	<tr <?php echo $asset_status->rowAttributes() ?>>
<?php if ($asset_status_delete->AssetStatusCode->Visible) { // AssetStatusCode ?>
		<td <?php echo $asset_status_delete->AssetStatusCode->cellAttributes() ?>>
<span id="el<?php echo $asset_status_delete->RowCount ?>_asset_status_AssetStatusCode" class="asset_status_AssetStatusCode">
<span<?php echo $asset_status_delete->AssetStatusCode->viewAttributes() ?>><?php echo $asset_status_delete->AssetStatusCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_status_delete->AssetStatus->Visible) { // AssetStatus ?>
		<td <?php echo $asset_status_delete->AssetStatus->cellAttributes() ?>>
<span id="el<?php echo $asset_status_delete->RowCount ?>_asset_status_AssetStatus" class="asset_status_AssetStatus">
<span<?php echo $asset_status_delete->AssetStatus->viewAttributes() ?>><?php echo $asset_status_delete->AssetStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$asset_status_delete->Recordset->moveNext();
}
$asset_status_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $asset_status_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$asset_status_delete->showPageFooter();
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
$asset_status_delete->terminate();
?>