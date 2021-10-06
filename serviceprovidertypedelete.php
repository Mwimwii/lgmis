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
$serviceprovidertype_delete = new serviceprovidertype_delete();

// Run the page
$serviceprovidertype_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$serviceprovidertype_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fserviceprovidertypedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fserviceprovidertypedelete = currentForm = new ew.Form("fserviceprovidertypedelete", "delete");
	loadjs.done("fserviceprovidertypedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $serviceprovidertype_delete->showPageHeader(); ?>
<?php
$serviceprovidertype_delete->showMessage();
?>
<form name="fserviceprovidertypedelete" id="fserviceprovidertypedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="serviceprovidertype">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($serviceprovidertype_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($serviceprovidertype_delete->ServiceProviderType->Visible) { // ServiceProviderType ?>
		<th class="<?php echo $serviceprovidertype_delete->ServiceProviderType->headerCellClass() ?>"><span id="elh_serviceprovidertype_ServiceProviderType" class="serviceprovidertype_ServiceProviderType"><?php echo $serviceprovidertype_delete->ServiceProviderType->caption() ?></span></th>
<?php } ?>
<?php if ($serviceprovidertype_delete->SPTypeDesc->Visible) { // SPTypeDesc ?>
		<th class="<?php echo $serviceprovidertype_delete->SPTypeDesc->headerCellClass() ?>"><span id="elh_serviceprovidertype_SPTypeDesc" class="serviceprovidertype_SPTypeDesc"><?php echo $serviceprovidertype_delete->SPTypeDesc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$serviceprovidertype_delete->RecordCount = 0;
$i = 0;
while (!$serviceprovidertype_delete->Recordset->EOF) {
	$serviceprovidertype_delete->RecordCount++;
	$serviceprovidertype_delete->RowCount++;

	// Set row properties
	$serviceprovidertype->resetAttributes();
	$serviceprovidertype->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$serviceprovidertype_delete->loadRowValues($serviceprovidertype_delete->Recordset);

	// Render row
	$serviceprovidertype_delete->renderRow();
?>
	<tr <?php echo $serviceprovidertype->rowAttributes() ?>>
<?php if ($serviceprovidertype_delete->ServiceProviderType->Visible) { // ServiceProviderType ?>
		<td <?php echo $serviceprovidertype_delete->ServiceProviderType->cellAttributes() ?>>
<span id="el<?php echo $serviceprovidertype_delete->RowCount ?>_serviceprovidertype_ServiceProviderType" class="serviceprovidertype_ServiceProviderType">
<span<?php echo $serviceprovidertype_delete->ServiceProviderType->viewAttributes() ?>><?php echo $serviceprovidertype_delete->ServiceProviderType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($serviceprovidertype_delete->SPTypeDesc->Visible) { // SPTypeDesc ?>
		<td <?php echo $serviceprovidertype_delete->SPTypeDesc->cellAttributes() ?>>
<span id="el<?php echo $serviceprovidertype_delete->RowCount ?>_serviceprovidertype_SPTypeDesc" class="serviceprovidertype_SPTypeDesc">
<span<?php echo $serviceprovidertype_delete->SPTypeDesc->viewAttributes() ?>><?php echo $serviceprovidertype_delete->SPTypeDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$serviceprovidertype_delete->Recordset->moveNext();
}
$serviceprovidertype_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $serviceprovidertype_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$serviceprovidertype_delete->showPageFooter();
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
$serviceprovidertype_delete->terminate();
?>