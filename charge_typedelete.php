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
$charge_type_delete = new charge_type_delete();

// Run the page
$charge_type_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$charge_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcharge_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcharge_typedelete = currentForm = new ew.Form("fcharge_typedelete", "delete");
	loadjs.done("fcharge_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $charge_type_delete->showPageHeader(); ?>
<?php
$charge_type_delete->showMessage();
?>
<form name="fcharge_typedelete" id="fcharge_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="charge_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($charge_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($charge_type_delete->ChargeType->Visible) { // ChargeType ?>
		<th class="<?php echo $charge_type_delete->ChargeType->headerCellClass() ?>"><span id="elh_charge_type_ChargeType" class="charge_type_ChargeType"><?php echo $charge_type_delete->ChargeType->caption() ?></span></th>
<?php } ?>
<?php if ($charge_type_delete->ChargeTypeDesc->Visible) { // ChargeTypeDesc ?>
		<th class="<?php echo $charge_type_delete->ChargeTypeDesc->headerCellClass() ?>"><span id="elh_charge_type_ChargeTypeDesc" class="charge_type_ChargeTypeDesc"><?php echo $charge_type_delete->ChargeTypeDesc->caption() ?></span></th>
<?php } ?>
<?php if ($charge_type_delete->IncomeType->Visible) { // IncomeType ?>
		<th class="<?php echo $charge_type_delete->IncomeType->headerCellClass() ?>"><span id="elh_charge_type_IncomeType" class="charge_type_IncomeType"><?php echo $charge_type_delete->IncomeType->caption() ?></span></th>
<?php } ?>
<?php if ($charge_type_delete->BankCode->Visible) { // BankCode ?>
		<th class="<?php echo $charge_type_delete->BankCode->headerCellClass() ?>"><span id="elh_charge_type_BankCode" class="charge_type_BankCode"><?php echo $charge_type_delete->BankCode->caption() ?></span></th>
<?php } ?>
<?php if ($charge_type_delete->BankAccount->Visible) { // BankAccount ?>
		<th class="<?php echo $charge_type_delete->BankAccount->headerCellClass() ?>"><span id="elh_charge_type_BankAccount" class="charge_type_BankAccount"><?php echo $charge_type_delete->BankAccount->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$charge_type_delete->RecordCount = 0;
$i = 0;
while (!$charge_type_delete->Recordset->EOF) {
	$charge_type_delete->RecordCount++;
	$charge_type_delete->RowCount++;

	// Set row properties
	$charge_type->resetAttributes();
	$charge_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$charge_type_delete->loadRowValues($charge_type_delete->Recordset);

	// Render row
	$charge_type_delete->renderRow();
?>
	<tr <?php echo $charge_type->rowAttributes() ?>>
<?php if ($charge_type_delete->ChargeType->Visible) { // ChargeType ?>
		<td <?php echo $charge_type_delete->ChargeType->cellAttributes() ?>>
<span id="el<?php echo $charge_type_delete->RowCount ?>_charge_type_ChargeType" class="charge_type_ChargeType">
<span<?php echo $charge_type_delete->ChargeType->viewAttributes() ?>><?php echo $charge_type_delete->ChargeType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($charge_type_delete->ChargeTypeDesc->Visible) { // ChargeTypeDesc ?>
		<td <?php echo $charge_type_delete->ChargeTypeDesc->cellAttributes() ?>>
<span id="el<?php echo $charge_type_delete->RowCount ?>_charge_type_ChargeTypeDesc" class="charge_type_ChargeTypeDesc">
<span<?php echo $charge_type_delete->ChargeTypeDesc->viewAttributes() ?>><?php echo $charge_type_delete->ChargeTypeDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($charge_type_delete->IncomeType->Visible) { // IncomeType ?>
		<td <?php echo $charge_type_delete->IncomeType->cellAttributes() ?>>
<span id="el<?php echo $charge_type_delete->RowCount ?>_charge_type_IncomeType" class="charge_type_IncomeType">
<span<?php echo $charge_type_delete->IncomeType->viewAttributes() ?>><?php echo $charge_type_delete->IncomeType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($charge_type_delete->BankCode->Visible) { // BankCode ?>
		<td <?php echo $charge_type_delete->BankCode->cellAttributes() ?>>
<span id="el<?php echo $charge_type_delete->RowCount ?>_charge_type_BankCode" class="charge_type_BankCode">
<span<?php echo $charge_type_delete->BankCode->viewAttributes() ?>><?php echo $charge_type_delete->BankCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($charge_type_delete->BankAccount->Visible) { // BankAccount ?>
		<td <?php echo $charge_type_delete->BankAccount->cellAttributes() ?>>
<span id="el<?php echo $charge_type_delete->RowCount ?>_charge_type_BankAccount" class="charge_type_BankAccount">
<span<?php echo $charge_type_delete->BankAccount->viewAttributes() ?>><?php echo $charge_type_delete->BankAccount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$charge_type_delete->Recordset->moveNext();
}
$charge_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $charge_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$charge_type_delete->showPageFooter();
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
$charge_type_delete->terminate();
?>