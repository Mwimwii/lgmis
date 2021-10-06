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
$contract_type_delete = new contract_type_delete();

// Run the page
$contract_type_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contract_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcontract_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcontract_typedelete = currentForm = new ew.Form("fcontract_typedelete", "delete");
	loadjs.done("fcontract_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $contract_type_delete->showPageHeader(); ?>
<?php
$contract_type_delete->showMessage();
?>
<form name="fcontract_typedelete" id="fcontract_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contract_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($contract_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($contract_type_delete->ContractType->Visible) { // ContractType ?>
		<th class="<?php echo $contract_type_delete->ContractType->headerCellClass() ?>"><span id="elh_contract_type_ContractType" class="contract_type_ContractType"><?php echo $contract_type_delete->ContractType->caption() ?></span></th>
<?php } ?>
<?php if ($contract_type_delete->ContractTypeDesc->Visible) { // ContractTypeDesc ?>
		<th class="<?php echo $contract_type_delete->ContractTypeDesc->headerCellClass() ?>"><span id="elh_contract_type_ContractTypeDesc" class="contract_type_ContractTypeDesc"><?php echo $contract_type_delete->ContractTypeDesc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$contract_type_delete->RecordCount = 0;
$i = 0;
while (!$contract_type_delete->Recordset->EOF) {
	$contract_type_delete->RecordCount++;
	$contract_type_delete->RowCount++;

	// Set row properties
	$contract_type->resetAttributes();
	$contract_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$contract_type_delete->loadRowValues($contract_type_delete->Recordset);

	// Render row
	$contract_type_delete->renderRow();
?>
	<tr <?php echo $contract_type->rowAttributes() ?>>
<?php if ($contract_type_delete->ContractType->Visible) { // ContractType ?>
		<td <?php echo $contract_type_delete->ContractType->cellAttributes() ?>>
<span id="el<?php echo $contract_type_delete->RowCount ?>_contract_type_ContractType" class="contract_type_ContractType">
<span<?php echo $contract_type_delete->ContractType->viewAttributes() ?>><?php echo $contract_type_delete->ContractType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_type_delete->ContractTypeDesc->Visible) { // ContractTypeDesc ?>
		<td <?php echo $contract_type_delete->ContractTypeDesc->cellAttributes() ?>>
<span id="el<?php echo $contract_type_delete->RowCount ?>_contract_type_ContractTypeDesc" class="contract_type_ContractTypeDesc">
<span<?php echo $contract_type_delete->ContractTypeDesc->viewAttributes() ?>><?php echo $contract_type_delete->ContractTypeDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$contract_type_delete->Recordset->moveNext();
}
$contract_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contract_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$contract_type_delete->showPageFooter();
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
$contract_type_delete->terminate();
?>