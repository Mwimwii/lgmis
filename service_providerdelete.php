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
$service_provider_delete = new service_provider_delete();

// Run the page
$service_provider_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$service_provider_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fservice_providerdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fservice_providerdelete = currentForm = new ew.Form("fservice_providerdelete", "delete");
	loadjs.done("fservice_providerdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $service_provider_delete->showPageHeader(); ?>
<?php
$service_provider_delete->showMessage();
?>
<form name="fservice_providerdelete" id="fservice_providerdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="service_provider">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($service_provider_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($service_provider_delete->ServiceProviderID->Visible) { // ServiceProviderID ?>
		<th class="<?php echo $service_provider_delete->ServiceProviderID->headerCellClass() ?>"><span id="elh_service_provider_ServiceProviderID" class="service_provider_ServiceProviderID"><?php echo $service_provider_delete->ServiceProviderID->caption() ?></span></th>
<?php } ?>
<?php if ($service_provider_delete->SPName->Visible) { // SPName ?>
		<th class="<?php echo $service_provider_delete->SPName->headerCellClass() ?>"><span id="elh_service_provider_SPName" class="service_provider_SPName"><?php echo $service_provider_delete->SPName->caption() ?></span></th>
<?php } ?>
<?php if ($service_provider_delete->SPType->Visible) { // SPType ?>
		<th class="<?php echo $service_provider_delete->SPType->headerCellClass() ?>"><span id="elh_service_provider_SPType" class="service_provider_SPType"><?php echo $service_provider_delete->SPType->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$service_provider_delete->RecordCount = 0;
$i = 0;
while (!$service_provider_delete->Recordset->EOF) {
	$service_provider_delete->RecordCount++;
	$service_provider_delete->RowCount++;

	// Set row properties
	$service_provider->resetAttributes();
	$service_provider->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$service_provider_delete->loadRowValues($service_provider_delete->Recordset);

	// Render row
	$service_provider_delete->renderRow();
?>
	<tr <?php echo $service_provider->rowAttributes() ?>>
<?php if ($service_provider_delete->ServiceProviderID->Visible) { // ServiceProviderID ?>
		<td <?php echo $service_provider_delete->ServiceProviderID->cellAttributes() ?>>
<span id="el<?php echo $service_provider_delete->RowCount ?>_service_provider_ServiceProviderID" class="service_provider_ServiceProviderID">
<span<?php echo $service_provider_delete->ServiceProviderID->viewAttributes() ?>><?php echo $service_provider_delete->ServiceProviderID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($service_provider_delete->SPName->Visible) { // SPName ?>
		<td <?php echo $service_provider_delete->SPName->cellAttributes() ?>>
<span id="el<?php echo $service_provider_delete->RowCount ?>_service_provider_SPName" class="service_provider_SPName">
<span<?php echo $service_provider_delete->SPName->viewAttributes() ?>><?php echo $service_provider_delete->SPName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($service_provider_delete->SPType->Visible) { // SPType ?>
		<td <?php echo $service_provider_delete->SPType->cellAttributes() ?>>
<span id="el<?php echo $service_provider_delete->RowCount ?>_service_provider_SPType" class="service_provider_SPType">
<span<?php echo $service_provider_delete->SPType->viewAttributes() ?>><?php echo $service_provider_delete->SPType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$service_provider_delete->Recordset->moveNext();
}
$service_provider_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $service_provider_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$service_provider_delete->showPageFooter();
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
$service_provider_delete->terminate();
?>