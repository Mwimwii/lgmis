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
$contract_status_delete = new contract_status_delete();

// Run the page
$contract_status_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contract_status_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcontract_statusdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcontract_statusdelete = currentForm = new ew.Form("fcontract_statusdelete", "delete");
	loadjs.done("fcontract_statusdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $contract_status_delete->showPageHeader(); ?>
<?php
$contract_status_delete->showMessage();
?>
<form name="fcontract_statusdelete" id="fcontract_statusdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contract_status">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($contract_status_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($contract_status_delete->ContractStatus->Visible) { // ContractStatus ?>
		<th class="<?php echo $contract_status_delete->ContractStatus->headerCellClass() ?>"><span id="elh_contract_status_ContractStatus" class="contract_status_ContractStatus"><?php echo $contract_status_delete->ContractStatus->caption() ?></span></th>
<?php } ?>
<?php if ($contract_status_delete->ContractStatusDesc->Visible) { // ContractStatusDesc ?>
		<th class="<?php echo $contract_status_delete->ContractStatusDesc->headerCellClass() ?>"><span id="elh_contract_status_ContractStatusDesc" class="contract_status_ContractStatusDesc"><?php echo $contract_status_delete->ContractStatusDesc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$contract_status_delete->RecordCount = 0;
$i = 0;
while (!$contract_status_delete->Recordset->EOF) {
	$contract_status_delete->RecordCount++;
	$contract_status_delete->RowCount++;

	// Set row properties
	$contract_status->resetAttributes();
	$contract_status->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$contract_status_delete->loadRowValues($contract_status_delete->Recordset);

	// Render row
	$contract_status_delete->renderRow();
?>
	<tr <?php echo $contract_status->rowAttributes() ?>>
<?php if ($contract_status_delete->ContractStatus->Visible) { // ContractStatus ?>
		<td <?php echo $contract_status_delete->ContractStatus->cellAttributes() ?>>
<span id="el<?php echo $contract_status_delete->RowCount ?>_contract_status_ContractStatus" class="contract_status_ContractStatus">
<span<?php echo $contract_status_delete->ContractStatus->viewAttributes() ?>><?php echo $contract_status_delete->ContractStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_status_delete->ContractStatusDesc->Visible) { // ContractStatusDesc ?>
		<td <?php echo $contract_status_delete->ContractStatusDesc->cellAttributes() ?>>
<span id="el<?php echo $contract_status_delete->RowCount ?>_contract_status_ContractStatusDesc" class="contract_status_ContractStatusDesc">
<span<?php echo $contract_status_delete->ContractStatusDesc->viewAttributes() ?>><?php echo $contract_status_delete->ContractStatusDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$contract_status_delete->Recordset->moveNext();
}
$contract_status_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contract_status_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$contract_status_delete->showPageFooter();
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
$contract_status_delete->terminate();
?>