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
$contract_variation_delete = new contract_variation_delete();

// Run the page
$contract_variation_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contract_variation_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcontract_variationdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcontract_variationdelete = currentForm = new ew.Form("fcontract_variationdelete", "delete");
	loadjs.done("fcontract_variationdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $contract_variation_delete->showPageHeader(); ?>
<?php
$contract_variation_delete->showMessage();
?>
<form name="fcontract_variationdelete" id="fcontract_variationdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contract_variation">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($contract_variation_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($contract_variation_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $contract_variation_delete->LACode->headerCellClass() ?>"><span id="elh_contract_variation_LACode" class="contract_variation_LACode"><?php echo $contract_variation_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($contract_variation_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<th class="<?php echo $contract_variation_delete->DepartmentCode->headerCellClass() ?>"><span id="elh_contract_variation_DepartmentCode" class="contract_variation_DepartmentCode"><?php echo $contract_variation_delete->DepartmentCode->caption() ?></span></th>
<?php } ?>
<?php if ($contract_variation_delete->SectionCode->Visible) { // SectionCode ?>
		<th class="<?php echo $contract_variation_delete->SectionCode->headerCellClass() ?>"><span id="elh_contract_variation_SectionCode" class="contract_variation_SectionCode"><?php echo $contract_variation_delete->SectionCode->caption() ?></span></th>
<?php } ?>
<?php if ($contract_variation_delete->ContractNo->Visible) { // ContractNo ?>
		<th class="<?php echo $contract_variation_delete->ContractNo->headerCellClass() ?>"><span id="elh_contract_variation_ContractNo" class="contract_variation_ContractNo"><?php echo $contract_variation_delete->ContractNo->caption() ?></span></th>
<?php } ?>
<?php if ($contract_variation_delete->VariationAmount->Visible) { // VariationAmount ?>
		<th class="<?php echo $contract_variation_delete->VariationAmount->headerCellClass() ?>"><span id="elh_contract_variation_VariationAmount" class="contract_variation_VariationAmount"><?php echo $contract_variation_delete->VariationAmount->caption() ?></span></th>
<?php } ?>
<?php if ($contract_variation_delete->VariationNo->Visible) { // VariationNo ?>
		<th class="<?php echo $contract_variation_delete->VariationNo->headerCellClass() ?>"><span id="elh_contract_variation_VariationNo" class="contract_variation_VariationNo"><?php echo $contract_variation_delete->VariationNo->caption() ?></span></th>
<?php } ?>
<?php if ($contract_variation_delete->VariationDate->Visible) { // VariationDate ?>
		<th class="<?php echo $contract_variation_delete->VariationDate->headerCellClass() ?>"><span id="elh_contract_variation_VariationDate" class="contract_variation_VariationDate"><?php echo $contract_variation_delete->VariationDate->caption() ?></span></th>
<?php } ?>
<?php if ($contract_variation_delete->VariationJustification->Visible) { // VariationJustification ?>
		<th class="<?php echo $contract_variation_delete->VariationJustification->headerCellClass() ?>"><span id="elh_contract_variation_VariationJustification" class="contract_variation_VariationJustification"><?php echo $contract_variation_delete->VariationJustification->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$contract_variation_delete->RecordCount = 0;
$i = 0;
while (!$contract_variation_delete->Recordset->EOF) {
	$contract_variation_delete->RecordCount++;
	$contract_variation_delete->RowCount++;

	// Set row properties
	$contract_variation->resetAttributes();
	$contract_variation->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$contract_variation_delete->loadRowValues($contract_variation_delete->Recordset);

	// Render row
	$contract_variation_delete->renderRow();
?>
	<tr <?php echo $contract_variation->rowAttributes() ?>>
<?php if ($contract_variation_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $contract_variation_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $contract_variation_delete->RowCount ?>_contract_variation_LACode" class="contract_variation_LACode">
<span<?php echo $contract_variation_delete->LACode->viewAttributes() ?>><?php echo $contract_variation_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_variation_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<td <?php echo $contract_variation_delete->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $contract_variation_delete->RowCount ?>_contract_variation_DepartmentCode" class="contract_variation_DepartmentCode">
<span<?php echo $contract_variation_delete->DepartmentCode->viewAttributes() ?>><?php echo $contract_variation_delete->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_variation_delete->SectionCode->Visible) { // SectionCode ?>
		<td <?php echo $contract_variation_delete->SectionCode->cellAttributes() ?>>
<span id="el<?php echo $contract_variation_delete->RowCount ?>_contract_variation_SectionCode" class="contract_variation_SectionCode">
<span<?php echo $contract_variation_delete->SectionCode->viewAttributes() ?>><?php echo $contract_variation_delete->SectionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_variation_delete->ContractNo->Visible) { // ContractNo ?>
		<td <?php echo $contract_variation_delete->ContractNo->cellAttributes() ?>>
<span id="el<?php echo $contract_variation_delete->RowCount ?>_contract_variation_ContractNo" class="contract_variation_ContractNo">
<span<?php echo $contract_variation_delete->ContractNo->viewAttributes() ?>><?php echo $contract_variation_delete->ContractNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_variation_delete->VariationAmount->Visible) { // VariationAmount ?>
		<td <?php echo $contract_variation_delete->VariationAmount->cellAttributes() ?>>
<span id="el<?php echo $contract_variation_delete->RowCount ?>_contract_variation_VariationAmount" class="contract_variation_VariationAmount">
<span<?php echo $contract_variation_delete->VariationAmount->viewAttributes() ?>><?php echo $contract_variation_delete->VariationAmount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_variation_delete->VariationNo->Visible) { // VariationNo ?>
		<td <?php echo $contract_variation_delete->VariationNo->cellAttributes() ?>>
<span id="el<?php echo $contract_variation_delete->RowCount ?>_contract_variation_VariationNo" class="contract_variation_VariationNo">
<span<?php echo $contract_variation_delete->VariationNo->viewAttributes() ?>><?php echo $contract_variation_delete->VariationNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_variation_delete->VariationDate->Visible) { // VariationDate ?>
		<td <?php echo $contract_variation_delete->VariationDate->cellAttributes() ?>>
<span id="el<?php echo $contract_variation_delete->RowCount ?>_contract_variation_VariationDate" class="contract_variation_VariationDate">
<span<?php echo $contract_variation_delete->VariationDate->viewAttributes() ?>><?php echo $contract_variation_delete->VariationDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract_variation_delete->VariationJustification->Visible) { // VariationJustification ?>
		<td <?php echo $contract_variation_delete->VariationJustification->cellAttributes() ?>>
<span id="el<?php echo $contract_variation_delete->RowCount ?>_contract_variation_VariationJustification" class="contract_variation_VariationJustification">
<span<?php echo $contract_variation_delete->VariationJustification->viewAttributes() ?>><?php echo $contract_variation_delete->VariationJustification->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$contract_variation_delete->Recordset->moveNext();
}
$contract_variation_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contract_variation_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$contract_variation_delete->showPageFooter();
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
$contract_variation_delete->terminate();
?>