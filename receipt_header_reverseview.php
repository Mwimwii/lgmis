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
$receipt_header_reverse_view = new receipt_header_reverse_view();

// Run the page
$receipt_header_reverse_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$receipt_header_reverse_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$receipt_header_reverse_view->isExport()) { ?>
<script>
var freceipt_header_reverseview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	freceipt_header_reverseview = currentForm = new ew.Form("freceipt_header_reverseview", "view");
	loadjs.done("freceipt_header_reverseview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$receipt_header_reverse_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $receipt_header_reverse_view->ExportOptions->render("body") ?>
<?php $receipt_header_reverse_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $receipt_header_reverse_view->showPageHeader(); ?>
<?php
$receipt_header_reverse_view->showMessage();
?>
<?php if (!$receipt_header_reverse_view->IsModal) { ?>
<?php if (!$receipt_header_reverse_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $receipt_header_reverse_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="freceipt_header_reverseview" id="freceipt_header_reverseview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="receipt_header_reverse">
<input type="hidden" name="modal" value="<?php echo (int)$receipt_header_reverse_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($receipt_header_reverse_view->ReceiptNo->Visible) { // ReceiptNo ?>
	<tr id="r_ReceiptNo">
		<td class="<?php echo $receipt_header_reverse_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_reverse_ReceiptNo"><?php echo $receipt_header_reverse_view->ReceiptNo->caption() ?></span></td>
		<td data-name="ReceiptNo" <?php echo $receipt_header_reverse_view->ReceiptNo->cellAttributes() ?>>
<span id="el_receipt_header_reverse_ReceiptNo">
<span<?php echo $receipt_header_reverse_view->ReceiptNo->viewAttributes() ?>><?php echo $receipt_header_reverse_view->ReceiptNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_reverse_view->ClientSerNo->Visible) { // ClientSerNo ?>
	<tr id="r_ClientSerNo">
		<td class="<?php echo $receipt_header_reverse_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_reverse_ClientSerNo"><?php echo $receipt_header_reverse_view->ClientSerNo->caption() ?></span></td>
		<td data-name="ClientSerNo" <?php echo $receipt_header_reverse_view->ClientSerNo->cellAttributes() ?>>
<span id="el_receipt_header_reverse_ClientSerNo">
<span<?php echo $receipt_header_reverse_view->ClientSerNo->viewAttributes() ?>><?php echo $receipt_header_reverse_view->ClientSerNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_reverse_view->ClientID->Visible) { // ClientID ?>
	<tr id="r_ClientID">
		<td class="<?php echo $receipt_header_reverse_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_reverse_ClientID"><?php echo $receipt_header_reverse_view->ClientID->caption() ?></span></td>
		<td data-name="ClientID" <?php echo $receipt_header_reverse_view->ClientID->cellAttributes() ?>>
<span id="el_receipt_header_reverse_ClientID">
<span<?php echo $receipt_header_reverse_view->ClientID->viewAttributes() ?>><?php echo $receipt_header_reverse_view->ClientID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_reverse_view->PaidBy->Visible) { // PaidBy ?>
	<tr id="r_PaidBy">
		<td class="<?php echo $receipt_header_reverse_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_reverse_PaidBy"><?php echo $receipt_header_reverse_view->PaidBy->caption() ?></span></td>
		<td data-name="PaidBy" <?php echo $receipt_header_reverse_view->PaidBy->cellAttributes() ?>>
<span id="el_receipt_header_reverse_PaidBy">
<span<?php echo $receipt_header_reverse_view->PaidBy->viewAttributes() ?>><?php echo $receipt_header_reverse_view->PaidBy->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_reverse_view->ClientPostalAddress->Visible) { // ClientPostalAddress ?>
	<tr id="r_ClientPostalAddress">
		<td class="<?php echo $receipt_header_reverse_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_reverse_ClientPostalAddress"><?php echo $receipt_header_reverse_view->ClientPostalAddress->caption() ?></span></td>
		<td data-name="ClientPostalAddress" <?php echo $receipt_header_reverse_view->ClientPostalAddress->cellAttributes() ?>>
<span id="el_receipt_header_reverse_ClientPostalAddress">
<span<?php echo $receipt_header_reverse_view->ClientPostalAddress->viewAttributes() ?>><?php echo $receipt_header_reverse_view->ClientPostalAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_reverse_view->ClientPhysicalAddress->Visible) { // ClientPhysicalAddress ?>
	<tr id="r_ClientPhysicalAddress">
		<td class="<?php echo $receipt_header_reverse_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_reverse_ClientPhysicalAddress"><?php echo $receipt_header_reverse_view->ClientPhysicalAddress->caption() ?></span></td>
		<td data-name="ClientPhysicalAddress" <?php echo $receipt_header_reverse_view->ClientPhysicalAddress->cellAttributes() ?>>
<span id="el_receipt_header_reverse_ClientPhysicalAddress">
<span<?php echo $receipt_header_reverse_view->ClientPhysicalAddress->viewAttributes() ?>><?php echo $receipt_header_reverse_view->ClientPhysicalAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_reverse_view->ClientEmail->Visible) { // ClientEmail ?>
	<tr id="r_ClientEmail">
		<td class="<?php echo $receipt_header_reverse_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_reverse_ClientEmail"><?php echo $receipt_header_reverse_view->ClientEmail->caption() ?></span></td>
		<td data-name="ClientEmail" <?php echo $receipt_header_reverse_view->ClientEmail->cellAttributes() ?>>
<span id="el_receipt_header_reverse_ClientEmail">
<span<?php echo $receipt_header_reverse_view->ClientEmail->viewAttributes() ?>><?php echo $receipt_header_reverse_view->ClientEmail->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_reverse_view->ChargeGroup->Visible) { // ChargeGroup ?>
	<tr id="r_ChargeGroup">
		<td class="<?php echo $receipt_header_reverse_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_reverse_ChargeGroup"><?php echo $receipt_header_reverse_view->ChargeGroup->caption() ?></span></td>
		<td data-name="ChargeGroup" <?php echo $receipt_header_reverse_view->ChargeGroup->cellAttributes() ?>>
<span id="el_receipt_header_reverse_ChargeGroup">
<span<?php echo $receipt_header_reverse_view->ChargeGroup->viewAttributes() ?>><?php echo $receipt_header_reverse_view->ChargeGroup->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_reverse_view->ReceiptPrefix->Visible) { // ReceiptPrefix ?>
	<tr id="r_ReceiptPrefix">
		<td class="<?php echo $receipt_header_reverse_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_reverse_ReceiptPrefix"><?php echo $receipt_header_reverse_view->ReceiptPrefix->caption() ?></span></td>
		<td data-name="ReceiptPrefix" <?php echo $receipt_header_reverse_view->ReceiptPrefix->cellAttributes() ?>>
<span id="el_receipt_header_reverse_ReceiptPrefix">
<span<?php echo $receipt_header_reverse_view->ReceiptPrefix->viewAttributes() ?>><?php echo $receipt_header_reverse_view->ReceiptPrefix->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_reverse_view->AccountBased->Visible) { // AccountBased ?>
	<tr id="r_AccountBased">
		<td class="<?php echo $receipt_header_reverse_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_reverse_AccountBased"><?php echo $receipt_header_reverse_view->AccountBased->caption() ?></span></td>
		<td data-name="AccountBased" <?php echo $receipt_header_reverse_view->AccountBased->cellAttributes() ?>>
<span id="el_receipt_header_reverse_AccountBased">
<span<?php echo $receipt_header_reverse_view->AccountBased->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AccountBased" class="custom-control-input" value="<?php echo $receipt_header_reverse_view->AccountBased->getViewValue() ?>" disabled<?php if (ConvertToBool($receipt_header_reverse_view->AccountBased->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AccountBased"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_reverse_view->Cashier->Visible) { // Cashier ?>
	<tr id="r_Cashier">
		<td class="<?php echo $receipt_header_reverse_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_reverse_Cashier"><?php echo $receipt_header_reverse_view->Cashier->caption() ?></span></td>
		<td data-name="Cashier" <?php echo $receipt_header_reverse_view->Cashier->cellAttributes() ?>>
<span id="el_receipt_header_reverse_Cashier">
<span<?php echo $receipt_header_reverse_view->Cashier->viewAttributes() ?>><?php echo $receipt_header_reverse_view->Cashier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_reverse_view->ReceiptDate->Visible) { // ReceiptDate ?>
	<tr id="r_ReceiptDate">
		<td class="<?php echo $receipt_header_reverse_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_reverse_ReceiptDate"><?php echo $receipt_header_reverse_view->ReceiptDate->caption() ?></span></td>
		<td data-name="ReceiptDate" <?php echo $receipt_header_reverse_view->ReceiptDate->cellAttributes() ?>>
<span id="el_receipt_header_reverse_ReceiptDate">
<span<?php echo $receipt_header_reverse_view->ReceiptDate->viewAttributes() ?>><?php echo $receipt_header_reverse_view->ReceiptDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_reverse_view->PaymentMethod->Visible) { // PaymentMethod ?>
	<tr id="r_PaymentMethod">
		<td class="<?php echo $receipt_header_reverse_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_reverse_PaymentMethod"><?php echo $receipt_header_reverse_view->PaymentMethod->caption() ?></span></td>
		<td data-name="PaymentMethod" <?php echo $receipt_header_reverse_view->PaymentMethod->cellAttributes() ?>>
<span id="el_receipt_header_reverse_PaymentMethod">
<span<?php echo $receipt_header_reverse_view->PaymentMethod->viewAttributes() ?>><?php echo $receipt_header_reverse_view->PaymentMethod->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_reverse_view->TotalDue->Visible) { // TotalDue ?>
	<tr id="r_TotalDue">
		<td class="<?php echo $receipt_header_reverse_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_reverse_TotalDue"><?php echo $receipt_header_reverse_view->TotalDue->caption() ?></span></td>
		<td data-name="TotalDue" <?php echo $receipt_header_reverse_view->TotalDue->cellAttributes() ?>>
<span id="el_receipt_header_reverse_TotalDue">
<span<?php echo $receipt_header_reverse_view->TotalDue->viewAttributes() ?>><?php echo $receipt_header_reverse_view->TotalDue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_reverse_view->AmountTendered->Visible) { // AmountTendered ?>
	<tr id="r_AmountTendered">
		<td class="<?php echo $receipt_header_reverse_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_reverse_AmountTendered"><?php echo $receipt_header_reverse_view->AmountTendered->caption() ?></span></td>
		<td data-name="AmountTendered" <?php echo $receipt_header_reverse_view->AmountTendered->cellAttributes() ?>>
<span id="el_receipt_header_reverse_AmountTendered">
<span<?php echo $receipt_header_reverse_view->AmountTendered->viewAttributes() ?>><?php echo $receipt_header_reverse_view->AmountTendered->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_reverse_view->Change->Visible) { // Change ?>
	<tr id="r_Change">
		<td class="<?php echo $receipt_header_reverse_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_reverse_Change"><?php echo $receipt_header_reverse_view->Change->caption() ?></span></td>
		<td data-name="Change" <?php echo $receipt_header_reverse_view->Change->cellAttributes() ?>>
<span id="el_receipt_header_reverse_Change">
<span<?php echo $receipt_header_reverse_view->Change->viewAttributes() ?>><?php echo $receipt_header_reverse_view->Change->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_reverse_view->ClientMessage->Visible) { // ClientMessage ?>
	<tr id="r_ClientMessage">
		<td class="<?php echo $receipt_header_reverse_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_reverse_ClientMessage"><?php echo $receipt_header_reverse_view->ClientMessage->caption() ?></span></td>
		<td data-name="ClientMessage" <?php echo $receipt_header_reverse_view->ClientMessage->cellAttributes() ?>>
<span id="el_receipt_header_reverse_ClientMessage">
<span<?php echo $receipt_header_reverse_view->ClientMessage->viewAttributes() ?>><?php echo $receipt_header_reverse_view->ClientMessage->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_reverse_view->Reasons->Visible) { // Reasons ?>
	<tr id="r_Reasons">
		<td class="<?php echo $receipt_header_reverse_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_reverse_Reasons"><?php echo $receipt_header_reverse_view->Reasons->caption() ?></span></td>
		<td data-name="Reasons" <?php echo $receipt_header_reverse_view->Reasons->cellAttributes() ?>>
<span id="el_receipt_header_reverse_Reasons">
<span<?php echo $receipt_header_reverse_view->Reasons->viewAttributes() ?>><?php echo $receipt_header_reverse_view->Reasons->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_reverse_view->ReversalRef->Visible) { // ReversalRef ?>
	<tr id="r_ReversalRef">
		<td class="<?php echo $receipt_header_reverse_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_reverse_ReversalRef"><?php echo $receipt_header_reverse_view->ReversalRef->caption() ?></span></td>
		<td data-name="ReversalRef" <?php echo $receipt_header_reverse_view->ReversalRef->cellAttributes() ?>>
<span id="el_receipt_header_reverse_ReversalRef">
<span<?php echo $receipt_header_reverse_view->ReversalRef->viewAttributes() ?>><?php echo $receipt_header_reverse_view->ReversalRef->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$receipt_header_reverse_view->IsModal) { ?>
<?php if (!$receipt_header_reverse_view->isExport()) { ?>
<?php echo $receipt_header_reverse_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$receipt_header_reverse_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$receipt_header_reverse_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$receipt_header_reverse_view->terminate();
?>