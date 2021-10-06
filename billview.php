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
$bill_view = new bill_view();

// Run the page
$bill_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bill_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$bill_view->isExport()) { ?>
<script>
var fbillview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fbillview = currentForm = new ew.Form("fbillview", "view");
	loadjs.done("fbillview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$bill_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $bill_view->ExportOptions->render("body") ?>
<?php $bill_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $bill_view->showPageHeader(); ?>
<?php
$bill_view->showMessage();
?>
<?php if (!$bill_view->IsModal) { ?>
<?php if (!$bill_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $bill_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fbillview" id="fbillview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bill">
<input type="hidden" name="modal" value="<?php echo (int)$bill_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($bill_view->ClientSerNo->Visible) { // ClientSerNo ?>
	<tr id="r_ClientSerNo">
		<td class="<?php echo $bill_view->TableLeftColumnClass ?>"><span id="elh_bill_ClientSerNo"><?php echo $bill_view->ClientSerNo->caption() ?></span></td>
		<td data-name="ClientSerNo" <?php echo $bill_view->ClientSerNo->cellAttributes() ?>>
<span id="el_bill_ClientSerNo">
<span<?php echo $bill_view->ClientSerNo->viewAttributes() ?>><?php echo $bill_view->ClientSerNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_view->ChargeCode->Visible) { // ChargeCode ?>
	<tr id="r_ChargeCode">
		<td class="<?php echo $bill_view->TableLeftColumnClass ?>"><span id="elh_bill_ChargeCode"><?php echo $bill_view->ChargeCode->caption() ?></span></td>
		<td data-name="ChargeCode" <?php echo $bill_view->ChargeCode->cellAttributes() ?>>
<span id="el_bill_ChargeCode">
<span<?php echo $bill_view->ChargeCode->viewAttributes() ?>><?php echo $bill_view->ChargeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_view->ChargeGroup->Visible) { // ChargeGroup ?>
	<tr id="r_ChargeGroup">
		<td class="<?php echo $bill_view->TableLeftColumnClass ?>"><span id="elh_bill_ChargeGroup"><?php echo $bill_view->ChargeGroup->caption() ?></span></td>
		<td data-name="ChargeGroup" <?php echo $bill_view->ChargeGroup->cellAttributes() ?>>
<span id="el_bill_ChargeGroup">
<span<?php echo $bill_view->ChargeGroup->viewAttributes() ?>><?php echo $bill_view->ChargeGroup->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_view->ClientID->Visible) { // ClientID ?>
	<tr id="r_ClientID">
		<td class="<?php echo $bill_view->TableLeftColumnClass ?>"><span id="elh_bill_ClientID"><?php echo $bill_view->ClientID->caption() ?></span></td>
		<td data-name="ClientID" <?php echo $bill_view->ClientID->cellAttributes() ?>>
<span id="el_bill_ClientID">
<span<?php echo $bill_view->ClientID->viewAttributes() ?>><?php echo $bill_view->ClientID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_view->AccountNo->Visible) { // AccountNo ?>
	<tr id="r_AccountNo">
		<td class="<?php echo $bill_view->TableLeftColumnClass ?>"><span id="elh_bill_AccountNo"><?php echo $bill_view->AccountNo->caption() ?></span></td>
		<td data-name="AccountNo" <?php echo $bill_view->AccountNo->cellAttributes() ?>>
<span id="el_bill_AccountNo">
<span<?php echo $bill_view->AccountNo->viewAttributes() ?>><?php echo $bill_view->AccountNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_view->ChargeRef->Visible) { // ChargeRef ?>
	<tr id="r_ChargeRef">
		<td class="<?php echo $bill_view->TableLeftColumnClass ?>"><span id="elh_bill_ChargeRef"><?php echo $bill_view->ChargeRef->caption() ?></span></td>
		<td data-name="ChargeRef" <?php echo $bill_view->ChargeRef->cellAttributes() ?>>
<span id="el_bill_ChargeRef">
<span<?php echo $bill_view->ChargeRef->viewAttributes() ?>><?php echo $bill_view->ChargeRef->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_view->BillYear->Visible) { // BillYear ?>
	<tr id="r_BillYear">
		<td class="<?php echo $bill_view->TableLeftColumnClass ?>"><span id="elh_bill_BillYear"><?php echo $bill_view->BillYear->caption() ?></span></td>
		<td data-name="BillYear" <?php echo $bill_view->BillYear->cellAttributes() ?>>
<span id="el_bill_BillYear">
<span<?php echo $bill_view->BillYear->viewAttributes() ?>><?php echo $bill_view->BillYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_view->BillPeriod->Visible) { // BillPeriod ?>
	<tr id="r_BillPeriod">
		<td class="<?php echo $bill_view->TableLeftColumnClass ?>"><span id="elh_bill_BillPeriod"><?php echo $bill_view->BillPeriod->caption() ?></span></td>
		<td data-name="BillPeriod" <?php echo $bill_view->BillPeriod->cellAttributes() ?>>
<span id="el_bill_BillPeriod">
<span<?php echo $bill_view->BillPeriod->viewAttributes() ?>><?php echo $bill_view->BillPeriod->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_view->StartDate->Visible) { // StartDate ?>
	<tr id="r_StartDate">
		<td class="<?php echo $bill_view->TableLeftColumnClass ?>"><span id="elh_bill_StartDate"><?php echo $bill_view->StartDate->caption() ?></span></td>
		<td data-name="StartDate" <?php echo $bill_view->StartDate->cellAttributes() ?>>
<span id="el_bill_StartDate">
<span<?php echo $bill_view->StartDate->viewAttributes() ?>><?php echo $bill_view->StartDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_view->EndDate->Visible) { // EndDate ?>
	<tr id="r_EndDate">
		<td class="<?php echo $bill_view->TableLeftColumnClass ?>"><span id="elh_bill_EndDate"><?php echo $bill_view->EndDate->caption() ?></span></td>
		<td data-name="EndDate" <?php echo $bill_view->EndDate->cellAttributes() ?>>
<span id="el_bill_EndDate">
<span<?php echo $bill_view->EndDate->viewAttributes() ?>><?php echo $bill_view->EndDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_view->BalanceBF->Visible) { // BalanceBF ?>
	<tr id="r_BalanceBF">
		<td class="<?php echo $bill_view->TableLeftColumnClass ?>"><span id="elh_bill_BalanceBF"><?php echo $bill_view->BalanceBF->caption() ?></span></td>
		<td data-name="BalanceBF" <?php echo $bill_view->BalanceBF->cellAttributes() ?>>
<span id="el_bill_BalanceBF">
<span<?php echo $bill_view->BalanceBF->viewAttributes() ?>><?php echo $bill_view->BalanceBF->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_view->AmountDue->Visible) { // AmountDue ?>
	<tr id="r_AmountDue">
		<td class="<?php echo $bill_view->TableLeftColumnClass ?>"><span id="elh_bill_AmountDue"><?php echo $bill_view->AmountDue->caption() ?></span></td>
		<td data-name="AmountDue" <?php echo $bill_view->AmountDue->cellAttributes() ?>>
<span id="el_bill_AmountDue">
<span<?php echo $bill_view->AmountDue->viewAttributes() ?>><?php echo $bill_view->AmountDue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_view->VAT->Visible) { // VAT ?>
	<tr id="r_VAT">
		<td class="<?php echo $bill_view->TableLeftColumnClass ?>"><span id="elh_bill_VAT"><?php echo $bill_view->VAT->caption() ?></span></td>
		<td data-name="VAT" <?php echo $bill_view->VAT->cellAttributes() ?>>
<span id="el_bill_VAT">
<span<?php echo $bill_view->VAT->viewAttributes() ?>><?php echo $bill_view->VAT->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_view->SalesTax->Visible) { // SalesTax ?>
	<tr id="r_SalesTax">
		<td class="<?php echo $bill_view->TableLeftColumnClass ?>"><span id="elh_bill_SalesTax"><?php echo $bill_view->SalesTax->caption() ?></span></td>
		<td data-name="SalesTax" <?php echo $bill_view->SalesTax->cellAttributes() ?>>
<span id="el_bill_SalesTax">
<span<?php echo $bill_view->SalesTax->viewAttributes() ?>><?php echo $bill_view->SalesTax->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_view->AmountPaid->Visible) { // AmountPaid ?>
	<tr id="r_AmountPaid">
		<td class="<?php echo $bill_view->TableLeftColumnClass ?>"><span id="elh_bill_AmountPaid"><?php echo $bill_view->AmountPaid->caption() ?></span></td>
		<td data-name="AmountPaid" <?php echo $bill_view->AmountPaid->cellAttributes() ?>>
<span id="el_bill_AmountPaid">
<span<?php echo $bill_view->AmountPaid->viewAttributes() ?>><?php echo $bill_view->AmountPaid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_view->ReferenceNo->Visible) { // ReferenceNo ?>
	<tr id="r_ReferenceNo">
		<td class="<?php echo $bill_view->TableLeftColumnClass ?>"><span id="elh_bill_ReferenceNo"><?php echo $bill_view->ReferenceNo->caption() ?></span></td>
		<td data-name="ReferenceNo" <?php echo $bill_view->ReferenceNo->cellAttributes() ?>>
<span id="el_bill_ReferenceNo">
<span<?php echo $bill_view->ReferenceNo->viewAttributes() ?>><?php echo $bill_view->ReferenceNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$bill_view->IsModal) { ?>
<?php if (!$bill_view->isExport()) { ?>
<?php echo $bill_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$bill_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$bill_view->isExport()) { ?>
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
$bill_view->terminate();
?>