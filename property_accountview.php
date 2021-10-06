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
$property_account_view = new property_account_view();

// Run the page
$property_account_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_account_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$property_account_view->isExport()) { ?>
<script>
var fproperty_accountview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fproperty_accountview = currentForm = new ew.Form("fproperty_accountview", "view");
	loadjs.done("fproperty_accountview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$property_account_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $property_account_view->ExportOptions->render("body") ?>
<?php $property_account_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $property_account_view->showPageHeader(); ?>
<?php
$property_account_view->showMessage();
?>
<?php if (!$property_account_view->IsModal) { ?>
<?php if (!$property_account_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_account_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fproperty_accountview" id="fproperty_accountview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_account">
<input type="hidden" name="modal" value="<?php echo (int)$property_account_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($property_account_view->AccountNo->Visible) { // AccountNo ?>
	<tr id="r_AccountNo">
		<td class="<?php echo $property_account_view->TableLeftColumnClass ?>"><span id="elh_property_account_AccountNo"><?php echo $property_account_view->AccountNo->caption() ?></span></td>
		<td data-name="AccountNo" <?php echo $property_account_view->AccountNo->cellAttributes() ?>>
<span id="el_property_account_AccountNo">
<span<?php echo $property_account_view->AccountNo->viewAttributes() ?>><?php echo $property_account_view->AccountNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_view->ValuationNo->Visible) { // ValuationNo ?>
	<tr id="r_ValuationNo">
		<td class="<?php echo $property_account_view->TableLeftColumnClass ?>"><span id="elh_property_account_ValuationNo"><?php echo $property_account_view->ValuationNo->caption() ?></span></td>
		<td data-name="ValuationNo" <?php echo $property_account_view->ValuationNo->cellAttributes() ?>>
<span id="el_property_account_ValuationNo">
<span<?php echo $property_account_view->ValuationNo->viewAttributes() ?>><?php echo $property_account_view->ValuationNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_view->ChargeCode->Visible) { // ChargeCode ?>
	<tr id="r_ChargeCode">
		<td class="<?php echo $property_account_view->TableLeftColumnClass ?>"><span id="elh_property_account_ChargeCode"><?php echo $property_account_view->ChargeCode->caption() ?></span></td>
		<td data-name="ChargeCode" <?php echo $property_account_view->ChargeCode->cellAttributes() ?>>
<span id="el_property_account_ChargeCode">
<span<?php echo $property_account_view->ChargeCode->viewAttributes() ?>><?php echo $property_account_view->ChargeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_view->BalanceBF->Visible) { // BalanceBF ?>
	<tr id="r_BalanceBF">
		<td class="<?php echo $property_account_view->TableLeftColumnClass ?>"><span id="elh_property_account_BalanceBF"><?php echo $property_account_view->BalanceBF->caption() ?></span></td>
		<td data-name="BalanceBF" <?php echo $property_account_view->BalanceBF->cellAttributes() ?>>
<span id="el_property_account_BalanceBF">
<span<?php echo $property_account_view->BalanceBF->viewAttributes() ?>><?php echo $property_account_view->BalanceBF->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_view->CurrentDemand->Visible) { // CurrentDemand ?>
	<tr id="r_CurrentDemand">
		<td class="<?php echo $property_account_view->TableLeftColumnClass ?>"><span id="elh_property_account_CurrentDemand"><?php echo $property_account_view->CurrentDemand->caption() ?></span></td>
		<td data-name="CurrentDemand" <?php echo $property_account_view->CurrentDemand->cellAttributes() ?>>
<span id="el_property_account_CurrentDemand">
<span<?php echo $property_account_view->CurrentDemand->viewAttributes() ?>><?php echo $property_account_view->CurrentDemand->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_view->VAT->Visible) { // VAT ?>
	<tr id="r_VAT">
		<td class="<?php echo $property_account_view->TableLeftColumnClass ?>"><span id="elh_property_account_VAT"><?php echo $property_account_view->VAT->caption() ?></span></td>
		<td data-name="VAT" <?php echo $property_account_view->VAT->cellAttributes() ?>>
<span id="el_property_account_VAT">
<span<?php echo $property_account_view->VAT->viewAttributes() ?>><?php echo $property_account_view->VAT->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_view->AmountPaid->Visible) { // AmountPaid ?>
	<tr id="r_AmountPaid">
		<td class="<?php echo $property_account_view->TableLeftColumnClass ?>"><span id="elh_property_account_AmountPaid"><?php echo $property_account_view->AmountPaid->caption() ?></span></td>
		<td data-name="AmountPaid" <?php echo $property_account_view->AmountPaid->cellAttributes() ?>>
<span id="el_property_account_AmountPaid">
<span<?php echo $property_account_view->AmountPaid->viewAttributes() ?>><?php echo $property_account_view->AmountPaid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_view->BillPeriod->Visible) { // BillPeriod ?>
	<tr id="r_BillPeriod">
		<td class="<?php echo $property_account_view->TableLeftColumnClass ?>"><span id="elh_property_account_BillPeriod"><?php echo $property_account_view->BillPeriod->caption() ?></span></td>
		<td data-name="BillPeriod" <?php echo $property_account_view->BillPeriod->cellAttributes() ?>>
<span id="el_property_account_BillPeriod">
<span<?php echo $property_account_view->BillPeriod->viewAttributes() ?>><?php echo $property_account_view->BillPeriod->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_view->PeriodType->Visible) { // PeriodType ?>
	<tr id="r_PeriodType">
		<td class="<?php echo $property_account_view->TableLeftColumnClass ?>"><span id="elh_property_account_PeriodType"><?php echo $property_account_view->PeriodType->caption() ?></span></td>
		<td data-name="PeriodType" <?php echo $property_account_view->PeriodType->cellAttributes() ?>>
<span id="el_property_account_PeriodType">
<span<?php echo $property_account_view->PeriodType->viewAttributes() ?>><?php echo $property_account_view->PeriodType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_view->BillYear->Visible) { // BillYear ?>
	<tr id="r_BillYear">
		<td class="<?php echo $property_account_view->TableLeftColumnClass ?>"><span id="elh_property_account_BillYear"><?php echo $property_account_view->BillYear->caption() ?></span></td>
		<td data-name="BillYear" <?php echo $property_account_view->BillYear->cellAttributes() ?>>
<span id="el_property_account_BillYear">
<span<?php echo $property_account_view->BillYear->viewAttributes() ?>><?php echo $property_account_view->BillYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_view->StartDate->Visible) { // StartDate ?>
	<tr id="r_StartDate">
		<td class="<?php echo $property_account_view->TableLeftColumnClass ?>"><span id="elh_property_account_StartDate"><?php echo $property_account_view->StartDate->caption() ?></span></td>
		<td data-name="StartDate" <?php echo $property_account_view->StartDate->cellAttributes() ?>>
<span id="el_property_account_StartDate">
<span<?php echo $property_account_view->StartDate->viewAttributes() ?>><?php echo $property_account_view->StartDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_view->EndDate->Visible) { // EndDate ?>
	<tr id="r_EndDate">
		<td class="<?php echo $property_account_view->TableLeftColumnClass ?>"><span id="elh_property_account_EndDate"><?php echo $property_account_view->EndDate->caption() ?></span></td>
		<td data-name="EndDate" <?php echo $property_account_view->EndDate->cellAttributes() ?>>
<span id="el_property_account_EndDate">
<span<?php echo $property_account_view->EndDate->viewAttributes() ?>><?php echo $property_account_view->EndDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_view->ClientSerNo->Visible) { // ClientSerNo ?>
	<tr id="r_ClientSerNo">
		<td class="<?php echo $property_account_view->TableLeftColumnClass ?>"><span id="elh_property_account_ClientSerNo"><?php echo $property_account_view->ClientSerNo->caption() ?></span></td>
		<td data-name="ClientSerNo" <?php echo $property_account_view->ClientSerNo->cellAttributes() ?>>
<span id="el_property_account_ClientSerNo">
<span<?php echo $property_account_view->ClientSerNo->viewAttributes() ?>><?php echo $property_account_view->ClientSerNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_view->AmountDue->Visible) { // AmountDue ?>
	<tr id="r_AmountDue">
		<td class="<?php echo $property_account_view->TableLeftColumnClass ?>"><span id="elh_property_account_AmountDue"><?php echo $property_account_view->AmountDue->caption() ?></span></td>
		<td data-name="AmountDue" <?php echo $property_account_view->AmountDue->cellAttributes() ?>>
<span id="el_property_account_AmountDue">
<span<?php echo $property_account_view->AmountDue->viewAttributes() ?>><?php echo $property_account_view->AmountDue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_view->AmountBeingPaid->Visible) { // AmountBeingPaid ?>
	<tr id="r_AmountBeingPaid">
		<td class="<?php echo $property_account_view->TableLeftColumnClass ?>"><span id="elh_property_account_AmountBeingPaid"><?php echo $property_account_view->AmountBeingPaid->caption() ?></span></td>
		<td data-name="AmountBeingPaid" <?php echo $property_account_view->AmountBeingPaid->cellAttributes() ?>>
<span id="el_property_account_AmountBeingPaid">
<span<?php echo $property_account_view->AmountBeingPaid->viewAttributes() ?>><?php echo $property_account_view->AmountBeingPaid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_view->PayIndicator->Visible) { // PayIndicator ?>
	<tr id="r_PayIndicator">
		<td class="<?php echo $property_account_view->TableLeftColumnClass ?>"><span id="elh_property_account_PayIndicator"><?php echo $property_account_view->PayIndicator->caption() ?></span></td>
		<td data-name="PayIndicator" <?php echo $property_account_view->PayIndicator->cellAttributes() ?>>
<span id="el_property_account_PayIndicator">
<span<?php echo $property_account_view->PayIndicator->viewAttributes() ?>><?php echo $property_account_view->PayIndicator->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$property_account_view->IsModal) { ?>
<?php if (!$property_account_view->isExport()) { ?>
<?php echo $property_account_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$property_account_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$property_account_view->isExport()) { ?>
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
$property_account_view->terminate();
?>