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
$property_account_position_view_view = new property_account_position_view_view();

// Run the page
$property_account_position_view_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_account_position_view_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$property_account_position_view_view->isExport()) { ?>
<script>
var fproperty_account_position_viewview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fproperty_account_position_viewview = currentForm = new ew.Form("fproperty_account_position_viewview", "view");
	loadjs.done("fproperty_account_position_viewview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$property_account_position_view_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $property_account_position_view_view->ExportOptions->render("body") ?>
<?php $property_account_position_view_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $property_account_position_view_view->showPageHeader(); ?>
<?php
$property_account_position_view_view->showMessage();
?>
<?php if (!$property_account_position_view_view->IsModal) { ?>
<?php if (!$property_account_position_view_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_account_position_view_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fproperty_account_position_viewview" id="fproperty_account_position_viewview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_account_position_view">
<input type="hidden" name="modal" value="<?php echo (int)$property_account_position_view_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($property_account_position_view_view->BillPeriod->Visible) { // BillPeriod ?>
	<tr id="r_BillPeriod">
		<td class="<?php echo $property_account_position_view_view->TableLeftColumnClass ?>"><span id="elh_property_account_position_view_BillPeriod"><?php echo $property_account_position_view_view->BillPeriod->caption() ?></span></td>
		<td data-name="BillPeriod" <?php echo $property_account_position_view_view->BillPeriod->cellAttributes() ?>>
<span id="el_property_account_position_view_BillPeriod">
<span<?php echo $property_account_position_view_view->BillPeriod->viewAttributes() ?>><?php echo $property_account_position_view_view->BillPeriod->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_position_view_view->BillYear->Visible) { // BillYear ?>
	<tr id="r_BillYear">
		<td class="<?php echo $property_account_position_view_view->TableLeftColumnClass ?>"><span id="elh_property_account_position_view_BillYear"><?php echo $property_account_position_view_view->BillYear->caption() ?></span></td>
		<td data-name="BillYear" <?php echo $property_account_position_view_view->BillYear->cellAttributes() ?>>
<span id="el_property_account_position_view_BillYear">
<span<?php echo $property_account_position_view_view->BillYear->viewAttributes() ?>><?php echo $property_account_position_view_view->BillYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_position_view_view->ClientSerNo->Visible) { // ClientSerNo ?>
	<tr id="r_ClientSerNo">
		<td class="<?php echo $property_account_position_view_view->TableLeftColumnClass ?>"><span id="elh_property_account_position_view_ClientSerNo"><?php echo $property_account_position_view_view->ClientSerNo->caption() ?></span></td>
		<td data-name="ClientSerNo" <?php echo $property_account_position_view_view->ClientSerNo->cellAttributes() ?>>
<span id="el_property_account_position_view_ClientSerNo">
<span<?php echo $property_account_position_view_view->ClientSerNo->viewAttributes() ?>><?php echo $property_account_position_view_view->ClientSerNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_position_view_view->ClientName->Visible) { // ClientName ?>
	<tr id="r_ClientName">
		<td class="<?php echo $property_account_position_view_view->TableLeftColumnClass ?>"><span id="elh_property_account_position_view_ClientName"><?php echo $property_account_position_view_view->ClientName->caption() ?></span></td>
		<td data-name="ClientName" <?php echo $property_account_position_view_view->ClientName->cellAttributes() ?>>
<span id="el_property_account_position_view_ClientName">
<span<?php echo $property_account_position_view_view->ClientName->viewAttributes() ?>><?php echo $property_account_position_view_view->ClientName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_position_view_view->PostalAddress->Visible) { // PostalAddress ?>
	<tr id="r_PostalAddress">
		<td class="<?php echo $property_account_position_view_view->TableLeftColumnClass ?>"><span id="elh_property_account_position_view_PostalAddress"><?php echo $property_account_position_view_view->PostalAddress->caption() ?></span></td>
		<td data-name="PostalAddress" <?php echo $property_account_position_view_view->PostalAddress->cellAttributes() ?>>
<span id="el_property_account_position_view_PostalAddress">
<span<?php echo $property_account_position_view_view->PostalAddress->viewAttributes() ?>><?php echo $property_account_position_view_view->PostalAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_position_view_view->PhysicalAddress->Visible) { // PhysicalAddress ?>
	<tr id="r_PhysicalAddress">
		<td class="<?php echo $property_account_position_view_view->TableLeftColumnClass ?>"><span id="elh_property_account_position_view_PhysicalAddress"><?php echo $property_account_position_view_view->PhysicalAddress->caption() ?></span></td>
		<td data-name="PhysicalAddress" <?php echo $property_account_position_view_view->PhysicalAddress->cellAttributes() ?>>
<span id="el_property_account_position_view_PhysicalAddress">
<span<?php echo $property_account_position_view_view->PhysicalAddress->viewAttributes() ?>><?php echo $property_account_position_view_view->PhysicalAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_position_view_view->Mobile->Visible) { // Mobile ?>
	<tr id="r_Mobile">
		<td class="<?php echo $property_account_position_view_view->TableLeftColumnClass ?>"><span id="elh_property_account_position_view_Mobile"><?php echo $property_account_position_view_view->Mobile->caption() ?></span></td>
		<td data-name="Mobile" <?php echo $property_account_position_view_view->Mobile->cellAttributes() ?>>
<span id="el_property_account_position_view_Mobile">
<span<?php echo $property_account_position_view_view->Mobile->viewAttributes() ?>><?php echo $property_account_position_view_view->Mobile->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_position_view_view->ValuationNo->Visible) { // ValuationNo ?>
	<tr id="r_ValuationNo">
		<td class="<?php echo $property_account_position_view_view->TableLeftColumnClass ?>"><span id="elh_property_account_position_view_ValuationNo"><?php echo $property_account_position_view_view->ValuationNo->caption() ?></span></td>
		<td data-name="ValuationNo" <?php echo $property_account_position_view_view->ValuationNo->cellAttributes() ?>>
<span id="el_property_account_position_view_ValuationNo">
<span<?php echo $property_account_position_view_view->ValuationNo->viewAttributes() ?>><?php echo $property_account_position_view_view->ValuationNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_position_view_view->PropertyNo->Visible) { // PropertyNo ?>
	<tr id="r_PropertyNo">
		<td class="<?php echo $property_account_position_view_view->TableLeftColumnClass ?>"><span id="elh_property_account_position_view_PropertyNo"><?php echo $property_account_position_view_view->PropertyNo->caption() ?></span></td>
		<td data-name="PropertyNo" <?php echo $property_account_position_view_view->PropertyNo->cellAttributes() ?>>
<span id="el_property_account_position_view_PropertyNo">
<span<?php echo $property_account_position_view_view->PropertyNo->viewAttributes() ?>><?php echo $property_account_position_view_view->PropertyNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_position_view_view->Location->Visible) { // Location ?>
	<tr id="r_Location">
		<td class="<?php echo $property_account_position_view_view->TableLeftColumnClass ?>"><span id="elh_property_account_position_view_Location"><?php echo $property_account_position_view_view->Location->caption() ?></span></td>
		<td data-name="Location" <?php echo $property_account_position_view_view->Location->cellAttributes() ?>>
<span id="el_property_account_position_view_Location">
<span<?php echo $property_account_position_view_view->Location->viewAttributes() ?>><?php echo $property_account_position_view_view->Location->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_position_view_view->LandValue->Visible) { // LandValue ?>
	<tr id="r_LandValue">
		<td class="<?php echo $property_account_position_view_view->TableLeftColumnClass ?>"><span id="elh_property_account_position_view_LandValue"><?php echo $property_account_position_view_view->LandValue->caption() ?></span></td>
		<td data-name="LandValue" <?php echo $property_account_position_view_view->LandValue->cellAttributes() ?>>
<span id="el_property_account_position_view_LandValue">
<span<?php echo $property_account_position_view_view->LandValue->viewAttributes() ?>><?php echo $property_account_position_view_view->LandValue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_position_view_view->ImprovementsValue->Visible) { // ImprovementsValue ?>
	<tr id="r_ImprovementsValue">
		<td class="<?php echo $property_account_position_view_view->TableLeftColumnClass ?>"><span id="elh_property_account_position_view_ImprovementsValue"><?php echo $property_account_position_view_view->ImprovementsValue->caption() ?></span></td>
		<td data-name="ImprovementsValue" <?php echo $property_account_position_view_view->ImprovementsValue->cellAttributes() ?>>
<span id="el_property_account_position_view_ImprovementsValue">
<span<?php echo $property_account_position_view_view->ImprovementsValue->viewAttributes() ?>><?php echo $property_account_position_view_view->ImprovementsValue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_position_view_view->RateableValue->Visible) { // RateableValue ?>
	<tr id="r_RateableValue">
		<td class="<?php echo $property_account_position_view_view->TableLeftColumnClass ?>"><span id="elh_property_account_position_view_RateableValue"><?php echo $property_account_position_view_view->RateableValue->caption() ?></span></td>
		<td data-name="RateableValue" <?php echo $property_account_position_view_view->RateableValue->cellAttributes() ?>>
<span id="el_property_account_position_view_RateableValue">
<span<?php echo $property_account_position_view_view->RateableValue->viewAttributes() ?>><?php echo $property_account_position_view_view->RateableValue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_position_view_view->SupplementaryValue->Visible) { // SupplementaryValue ?>
	<tr id="r_SupplementaryValue">
		<td class="<?php echo $property_account_position_view_view->TableLeftColumnClass ?>"><span id="elh_property_account_position_view_SupplementaryValue"><?php echo $property_account_position_view_view->SupplementaryValue->caption() ?></span></td>
		<td data-name="SupplementaryValue" <?php echo $property_account_position_view_view->SupplementaryValue->cellAttributes() ?>>
<span id="el_property_account_position_view_SupplementaryValue">
<span<?php echo $property_account_position_view_view->SupplementaryValue->viewAttributes() ?>><?php echo $property_account_position_view_view->SupplementaryValue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_position_view_view->Improvements->Visible) { // Improvements ?>
	<tr id="r_Improvements">
		<td class="<?php echo $property_account_position_view_view->TableLeftColumnClass ?>"><span id="elh_property_account_position_view_Improvements"><?php echo $property_account_position_view_view->Improvements->caption() ?></span></td>
		<td data-name="Improvements" <?php echo $property_account_position_view_view->Improvements->cellAttributes() ?>>
<span id="el_property_account_position_view_Improvements">
<span<?php echo $property_account_position_view_view->Improvements->viewAttributes() ?>><?php echo $property_account_position_view_view->Improvements->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_position_view_view->LandExtentInHA->Visible) { // LandExtentInHA ?>
	<tr id="r_LandExtentInHA">
		<td class="<?php echo $property_account_position_view_view->TableLeftColumnClass ?>"><span id="elh_property_account_position_view_LandExtentInHA"><?php echo $property_account_position_view_view->LandExtentInHA->caption() ?></span></td>
		<td data-name="LandExtentInHA" <?php echo $property_account_position_view_view->LandExtentInHA->cellAttributes() ?>>
<span id="el_property_account_position_view_LandExtentInHA">
<span<?php echo $property_account_position_view_view->LandExtentInHA->viewAttributes() ?>><?php echo $property_account_position_view_view->LandExtentInHA->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_position_view_view->BalanceBF->Visible) { // BalanceBF ?>
	<tr id="r_BalanceBF">
		<td class="<?php echo $property_account_position_view_view->TableLeftColumnClass ?>"><span id="elh_property_account_position_view_BalanceBF"><?php echo $property_account_position_view_view->BalanceBF->caption() ?></span></td>
		<td data-name="BalanceBF" <?php echo $property_account_position_view_view->BalanceBF->cellAttributes() ?>>
<span id="el_property_account_position_view_BalanceBF">
<span<?php echo $property_account_position_view_view->BalanceBF->viewAttributes() ?>><?php echo $property_account_position_view_view->BalanceBF->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_position_view_view->CurrentDemand->Visible) { // CurrentDemand ?>
	<tr id="r_CurrentDemand">
		<td class="<?php echo $property_account_position_view_view->TableLeftColumnClass ?>"><span id="elh_property_account_position_view_CurrentDemand"><?php echo $property_account_position_view_view->CurrentDemand->caption() ?></span></td>
		<td data-name="CurrentDemand" <?php echo $property_account_position_view_view->CurrentDemand->cellAttributes() ?>>
<span id="el_property_account_position_view_CurrentDemand">
<span<?php echo $property_account_position_view_view->CurrentDemand->viewAttributes() ?>><?php echo $property_account_position_view_view->CurrentDemand->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_position_view_view->VAT->Visible) { // VAT ?>
	<tr id="r_VAT">
		<td class="<?php echo $property_account_position_view_view->TableLeftColumnClass ?>"><span id="elh_property_account_position_view_VAT"><?php echo $property_account_position_view_view->VAT->caption() ?></span></td>
		<td data-name="VAT" <?php echo $property_account_position_view_view->VAT->cellAttributes() ?>>
<span id="el_property_account_position_view_VAT">
<span<?php echo $property_account_position_view_view->VAT->viewAttributes() ?>><?php echo $property_account_position_view_view->VAT->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_position_view_view->AmountPaid->Visible) { // AmountPaid ?>
	<tr id="r_AmountPaid">
		<td class="<?php echo $property_account_position_view_view->TableLeftColumnClass ?>"><span id="elh_property_account_position_view_AmountPaid"><?php echo $property_account_position_view_view->AmountPaid->caption() ?></span></td>
		<td data-name="AmountPaid" <?php echo $property_account_position_view_view->AmountPaid->cellAttributes() ?>>
<span id="el_property_account_position_view_AmountPaid">
<span<?php echo $property_account_position_view_view->AmountPaid->viewAttributes() ?>><?php echo $property_account_position_view_view->AmountPaid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_position_view_view->AmountDue->Visible) { // AmountDue ?>
	<tr id="r_AmountDue">
		<td class="<?php echo $property_account_position_view_view->TableLeftColumnClass ?>"><span id="elh_property_account_position_view_AmountDue"><?php echo $property_account_position_view_view->AmountDue->caption() ?></span></td>
		<td data-name="AmountDue" <?php echo $property_account_position_view_view->AmountDue->cellAttributes() ?>>
<span id="el_property_account_position_view_AmountDue">
<span<?php echo $property_account_position_view_view->AmountDue->viewAttributes() ?>><?php echo $property_account_position_view_view->AmountDue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_account_position_view_view->ChargeCode->Visible) { // ChargeCode ?>
	<tr id="r_ChargeCode">
		<td class="<?php echo $property_account_position_view_view->TableLeftColumnClass ?>"><span id="elh_property_account_position_view_ChargeCode"><?php echo $property_account_position_view_view->ChargeCode->caption() ?></span></td>
		<td data-name="ChargeCode" <?php echo $property_account_position_view_view->ChargeCode->cellAttributes() ?>>
<span id="el_property_account_position_view_ChargeCode">
<span<?php echo $property_account_position_view_view->ChargeCode->viewAttributes() ?>><?php echo $property_account_position_view_view->ChargeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$property_account_position_view_view->IsModal) { ?>
<?php if (!$property_account_position_view_view->isExport()) { ?>
<?php echo $property_account_position_view_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$property_account_position_view_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$property_account_position_view_view->isExport()) { ?>
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
$property_account_position_view_view->terminate();
?>