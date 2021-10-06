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
$receipt_header_view = new receipt_header_view();

// Run the page
$receipt_header_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$receipt_header_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$receipt_header_view->isExport()) { ?>
<script>
var freceipt_headerview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	freceipt_headerview = currentForm = new ew.Form("freceipt_headerview", "view");
	loadjs.done("freceipt_headerview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$receipt_header_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $receipt_header_view->ExportOptions->render("body") ?>
<?php $receipt_header_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $receipt_header_view->showPageHeader(); ?>
<?php
$receipt_header_view->showMessage();
?>
<?php if (!$receipt_header_view->IsModal) { ?>
<?php if (!$receipt_header_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $receipt_header_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="freceipt_headerview" id="freceipt_headerview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="receipt_header">
<input type="hidden" name="modal" value="<?php echo (int)$receipt_header_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($receipt_header_view->ChargeGroup->Visible) { // ChargeGroup ?>
	<tr id="r_ChargeGroup">
		<td class="<?php echo $receipt_header_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_ChargeGroup"><?php echo $receipt_header_view->ChargeGroup->caption() ?></span></td>
		<td data-name="ChargeGroup" <?php echo $receipt_header_view->ChargeGroup->cellAttributes() ?>>
<span id="el_receipt_header_ChargeGroup">
<span<?php echo $receipt_header_view->ChargeGroup->viewAttributes() ?>><?php echo $receipt_header_view->ChargeGroup->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_view->ClientSerNo->Visible) { // ClientSerNo ?>
	<tr id="r_ClientSerNo">
		<td class="<?php echo $receipt_header_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_ClientSerNo"><?php echo $receipt_header_view->ClientSerNo->caption() ?></span></td>
		<td data-name="ClientSerNo" <?php echo $receipt_header_view->ClientSerNo->cellAttributes() ?>>
<span id="el_receipt_header_ClientSerNo">
<span<?php echo $receipt_header_view->ClientSerNo->viewAttributes() ?>><?php echo $receipt_header_view->ClientSerNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_view->ClientID->Visible) { // ClientID ?>
	<tr id="r_ClientID">
		<td class="<?php echo $receipt_header_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_ClientID"><?php echo $receipt_header_view->ClientID->caption() ?></span></td>
		<td data-name="ClientID" <?php echo $receipt_header_view->ClientID->cellAttributes() ?>>
<span id="el_receipt_header_ClientID">
<span<?php echo $receipt_header_view->ClientID->viewAttributes() ?>><?php echo $receipt_header_view->ClientID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_view->ClientPostalAddress->Visible) { // ClientPostalAddress ?>
	<tr id="r_ClientPostalAddress">
		<td class="<?php echo $receipt_header_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_ClientPostalAddress"><?php echo $receipt_header_view->ClientPostalAddress->caption() ?></span></td>
		<td data-name="ClientPostalAddress" <?php echo $receipt_header_view->ClientPostalAddress->cellAttributes() ?>>
<span id="el_receipt_header_ClientPostalAddress">
<span<?php echo $receipt_header_view->ClientPostalAddress->viewAttributes() ?>><?php echo $receipt_header_view->ClientPostalAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_view->ClientPhysicalAddress->Visible) { // ClientPhysicalAddress ?>
	<tr id="r_ClientPhysicalAddress">
		<td class="<?php echo $receipt_header_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_ClientPhysicalAddress"><?php echo $receipt_header_view->ClientPhysicalAddress->caption() ?></span></td>
		<td data-name="ClientPhysicalAddress" <?php echo $receipt_header_view->ClientPhysicalAddress->cellAttributes() ?>>
<span id="el_receipt_header_ClientPhysicalAddress">
<span<?php echo $receipt_header_view->ClientPhysicalAddress->viewAttributes() ?>><?php echo $receipt_header_view->ClientPhysicalAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_view->ClientEmail->Visible) { // ClientEmail ?>
	<tr id="r_ClientEmail">
		<td class="<?php echo $receipt_header_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_ClientEmail"><?php echo $receipt_header_view->ClientEmail->caption() ?></span></td>
		<td data-name="ClientEmail" <?php echo $receipt_header_view->ClientEmail->cellAttributes() ?>>
<span id="el_receipt_header_ClientEmail">
<span<?php echo $receipt_header_view->ClientEmail->viewAttributes() ?>><?php echo $receipt_header_view->ClientEmail->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_view->ReceiptPrefix->Visible) { // ReceiptPrefix ?>
	<tr id="r_ReceiptPrefix">
		<td class="<?php echo $receipt_header_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_ReceiptPrefix"><?php echo $receipt_header_view->ReceiptPrefix->caption() ?></span></td>
		<td data-name="ReceiptPrefix" <?php echo $receipt_header_view->ReceiptPrefix->cellAttributes() ?>>
<span id="el_receipt_header_ReceiptPrefix">
<span<?php echo $receipt_header_view->ReceiptPrefix->viewAttributes() ?>><?php echo $receipt_header_view->ReceiptPrefix->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_view->AccountBased->Visible) { // AccountBased ?>
	<tr id="r_AccountBased">
		<td class="<?php echo $receipt_header_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_AccountBased"><?php echo $receipt_header_view->AccountBased->caption() ?></span></td>
		<td data-name="AccountBased" <?php echo $receipt_header_view->AccountBased->cellAttributes() ?>>
<span id="el_receipt_header_AccountBased">
<span<?php echo $receipt_header_view->AccountBased->viewAttributes() ?>><?php echo $receipt_header_view->AccountBased->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_view->Cashier->Visible) { // Cashier ?>
	<tr id="r_Cashier">
		<td class="<?php echo $receipt_header_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_Cashier"><?php echo $receipt_header_view->Cashier->caption() ?></span></td>
		<td data-name="Cashier" <?php echo $receipt_header_view->Cashier->cellAttributes() ?>>
<span id="el_receipt_header_Cashier">
<span<?php echo $receipt_header_view->Cashier->viewAttributes() ?>><?php echo $receipt_header_view->Cashier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_view->ReceiptNo->Visible) { // ReceiptNo ?>
	<tr id="r_ReceiptNo">
		<td class="<?php echo $receipt_header_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_ReceiptNo"><?php echo $receipt_header_view->ReceiptNo->caption() ?></span></td>
		<td data-name="ReceiptNo" <?php echo $receipt_header_view->ReceiptNo->cellAttributes() ?>>
<span id="el_receipt_header_ReceiptNo">
<span<?php echo $receipt_header_view->ReceiptNo->viewAttributes() ?>><?php echo $receipt_header_view->ReceiptNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_view->ReceiptDate->Visible) { // ReceiptDate ?>
	<tr id="r_ReceiptDate">
		<td class="<?php echo $receipt_header_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_ReceiptDate"><?php echo $receipt_header_view->ReceiptDate->caption() ?></span></td>
		<td data-name="ReceiptDate" <?php echo $receipt_header_view->ReceiptDate->cellAttributes() ?>>
<span id="el_receipt_header_ReceiptDate">
<span<?php echo $receipt_header_view->ReceiptDate->viewAttributes() ?>><?php echo $receipt_header_view->ReceiptDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_view->PaymentMethod->Visible) { // PaymentMethod ?>
	<tr id="r_PaymentMethod">
		<td class="<?php echo $receipt_header_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_PaymentMethod"><?php echo $receipt_header_view->PaymentMethod->caption() ?></span></td>
		<td data-name="PaymentMethod" <?php echo $receipt_header_view->PaymentMethod->cellAttributes() ?>>
<span id="el_receipt_header_PaymentMethod">
<span<?php echo $receipt_header_view->PaymentMethod->viewAttributes() ?>><?php echo $receipt_header_view->PaymentMethod->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_view->PaidBy->Visible) { // PaidBy ?>
	<tr id="r_PaidBy">
		<td class="<?php echo $receipt_header_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_PaidBy"><?php echo $receipt_header_view->PaidBy->caption() ?></span></td>
		<td data-name="PaidBy" <?php echo $receipt_header_view->PaidBy->cellAttributes() ?>>
<span id="el_receipt_header_PaidBy">
<span<?php echo $receipt_header_view->PaidBy->viewAttributes() ?>><?php echo $receipt_header_view->PaidBy->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_view->TotalDue->Visible) { // TotalDue ?>
	<tr id="r_TotalDue">
		<td class="<?php echo $receipt_header_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_TotalDue"><?php echo $receipt_header_view->TotalDue->caption() ?></span></td>
		<td data-name="TotalDue" <?php echo $receipt_header_view->TotalDue->cellAttributes() ?>>
<span id="el_receipt_header_TotalDue">
<span<?php echo $receipt_header_view->TotalDue->viewAttributes() ?>><?php echo $receipt_header_view->TotalDue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_view->AmountTendered->Visible) { // AmountTendered ?>
	<tr id="r_AmountTendered">
		<td class="<?php echo $receipt_header_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_AmountTendered"><?php echo $receipt_header_view->AmountTendered->caption() ?></span></td>
		<td data-name="AmountTendered" <?php echo $receipt_header_view->AmountTendered->cellAttributes() ?>>
<span id="el_receipt_header_AmountTendered">
<span<?php echo $receipt_header_view->AmountTendered->viewAttributes() ?>><?php echo $receipt_header_view->AmountTendered->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_view->Change->Visible) { // Change ?>
	<tr id="r_Change">
		<td class="<?php echo $receipt_header_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_Change"><?php echo $receipt_header_view->Change->caption() ?></span></td>
		<td data-name="Change" <?php echo $receipt_header_view->Change->cellAttributes() ?>>
<span id="el_receipt_header_Change">
<span<?php echo $receipt_header_view->Change->viewAttributes() ?>><?php echo $receipt_header_view->Change->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($receipt_header_view->ClientMessage->Visible) { // ClientMessage ?>
	<tr id="r_ClientMessage">
		<td class="<?php echo $receipt_header_view->TableLeftColumnClass ?>"><span id="elh_receipt_header_ClientMessage"><?php echo $receipt_header_view->ClientMessage->caption() ?></span></td>
		<td data-name="ClientMessage" <?php echo $receipt_header_view->ClientMessage->cellAttributes() ?>>
<span id="el_receipt_header_ClientMessage">
<span<?php echo $receipt_header_view->ClientMessage->viewAttributes() ?>><?php echo $receipt_header_view->ClientMessage->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$receipt_header_view->IsModal) { ?>
<?php if (!$receipt_header_view->isExport()) { ?>
<?php echo $receipt_header_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("receipt", explode(",", $receipt_header->getCurrentDetailTable())) && $receipt->DetailView) {
?>
<?php if ($receipt_header->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("receipt", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $receipt_header_view->receipt_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "receiptgrid.php" ?>
<?php } ?>
</form>
<?php
$receipt_header_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$receipt_header_view->isExport()) { ?>
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
$receipt_header_view->terminate();
?>