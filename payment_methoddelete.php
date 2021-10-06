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
$payment_method_delete = new payment_method_delete();

// Run the page
$payment_method_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payment_method_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpayment_methoddelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpayment_methoddelete = currentForm = new ew.Form("fpayment_methoddelete", "delete");
	loadjs.done("fpayment_methoddelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $payment_method_delete->showPageHeader(); ?>
<?php
$payment_method_delete->showMessage();
?>
<form name="fpayment_methoddelete" id="fpayment_methoddelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payment_method">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($payment_method_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($payment_method_delete->PaymentMethod->Visible) { // PaymentMethod ?>
		<th class="<?php echo $payment_method_delete->PaymentMethod->headerCellClass() ?>"><span id="elh_payment_method_PaymentMethod" class="payment_method_PaymentMethod"><?php echo $payment_method_delete->PaymentMethod->caption() ?></span></th>
<?php } ?>
<?php if ($payment_method_delete->PaymentDesc->Visible) { // PaymentDesc ?>
		<th class="<?php echo $payment_method_delete->PaymentDesc->headerCellClass() ?>"><span id="elh_payment_method_PaymentDesc" class="payment_method_PaymentDesc"><?php echo $payment_method_delete->PaymentDesc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$payment_method_delete->RecordCount = 0;
$i = 0;
while (!$payment_method_delete->Recordset->EOF) {
	$payment_method_delete->RecordCount++;
	$payment_method_delete->RowCount++;

	// Set row properties
	$payment_method->resetAttributes();
	$payment_method->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$payment_method_delete->loadRowValues($payment_method_delete->Recordset);

	// Render row
	$payment_method_delete->renderRow();
?>
	<tr <?php echo $payment_method->rowAttributes() ?>>
<?php if ($payment_method_delete->PaymentMethod->Visible) { // PaymentMethod ?>
		<td <?php echo $payment_method_delete->PaymentMethod->cellAttributes() ?>>
<span id="el<?php echo $payment_method_delete->RowCount ?>_payment_method_PaymentMethod" class="payment_method_PaymentMethod">
<span<?php echo $payment_method_delete->PaymentMethod->viewAttributes() ?>><?php echo $payment_method_delete->PaymentMethod->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payment_method_delete->PaymentDesc->Visible) { // PaymentDesc ?>
		<td <?php echo $payment_method_delete->PaymentDesc->cellAttributes() ?>>
<span id="el<?php echo $payment_method_delete->RowCount ?>_payment_method_PaymentDesc" class="payment_method_PaymentDesc">
<span<?php echo $payment_method_delete->PaymentDesc->viewAttributes() ?>><?php echo $payment_method_delete->PaymentDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$payment_method_delete->Recordset->moveNext();
}
$payment_method_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $payment_method_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$payment_method_delete->showPageFooter();
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
$payment_method_delete->terminate();
?>