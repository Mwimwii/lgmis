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
$contractor_view = new contractor_view();

// Run the page
$contractor_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contractor_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$contractor_view->isExport()) { ?>
<script>
var fcontractorview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcontractorview = currentForm = new ew.Form("fcontractorview", "view");
	loadjs.done("fcontractorview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$contractor_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $contractor_view->ExportOptions->render("body") ?>
<?php $contractor_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $contractor_view->showPageHeader(); ?>
<?php
$contractor_view->showMessage();
?>
<?php if (!$contractor_view->IsModal) { ?>
<?php if (!$contractor_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contractor_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcontractorview" id="fcontractorview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contractor">
<input type="hidden" name="modal" value="<?php echo (int)$contractor_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($contractor_view->ContractorRef->Visible) { // ContractorRef ?>
	<tr id="r_ContractorRef">
		<td class="<?php echo $contractor_view->TableLeftColumnClass ?>"><span id="elh_contractor_ContractorRef"><?php echo $contractor_view->ContractorRef->caption() ?></span></td>
		<td data-name="ContractorRef" <?php echo $contractor_view->ContractorRef->cellAttributes() ?>>
<span id="el_contractor_ContractorRef">
<span<?php echo $contractor_view->ContractorRef->viewAttributes() ?>><?php echo $contractor_view->ContractorRef->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contractor_view->ProvinceCode->Visible) { // ProvinceCode ?>
	<tr id="r_ProvinceCode">
		<td class="<?php echo $contractor_view->TableLeftColumnClass ?>"><span id="elh_contractor_ProvinceCode"><?php echo $contractor_view->ProvinceCode->caption() ?></span></td>
		<td data-name="ProvinceCode" <?php echo $contractor_view->ProvinceCode->cellAttributes() ?>>
<span id="el_contractor_ProvinceCode">
<span<?php echo $contractor_view->ProvinceCode->viewAttributes() ?>><?php echo $contractor_view->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contractor_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $contractor_view->TableLeftColumnClass ?>"><span id="elh_contractor_LACode"><?php echo $contractor_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $contractor_view->LACode->cellAttributes() ?>>
<span id="el_contractor_LACode">
<span<?php echo $contractor_view->LACode->viewAttributes() ?>><?php echo $contractor_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contractor_view->ContractorName->Visible) { // ContractorName ?>
	<tr id="r_ContractorName">
		<td class="<?php echo $contractor_view->TableLeftColumnClass ?>"><span id="elh_contractor_ContractorName"><?php echo $contractor_view->ContractorName->caption() ?></span></td>
		<td data-name="ContractorName" <?php echo $contractor_view->ContractorName->cellAttributes() ?>>
<span id="el_contractor_ContractorName">
<span<?php echo $contractor_view->ContractorName->viewAttributes() ?>><?php echo $contractor_view->ContractorName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contractor_view->TradingName->Visible) { // TradingName ?>
	<tr id="r_TradingName">
		<td class="<?php echo $contractor_view->TableLeftColumnClass ?>"><span id="elh_contractor_TradingName"><?php echo $contractor_view->TradingName->caption() ?></span></td>
		<td data-name="TradingName" <?php echo $contractor_view->TradingName->cellAttributes() ?>>
<span id="el_contractor_TradingName">
<span<?php echo $contractor_view->TradingName->viewAttributes() ?>><?php echo $contractor_view->TradingName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contractor_view->ZambianContrator->Visible) { // ZambianContrator ?>
	<tr id="r_ZambianContrator">
		<td class="<?php echo $contractor_view->TableLeftColumnClass ?>"><span id="elh_contractor_ZambianContrator"><?php echo $contractor_view->ZambianContrator->caption() ?></span></td>
		<td data-name="ZambianContrator" <?php echo $contractor_view->ZambianContrator->cellAttributes() ?>>
<span id="el_contractor_ZambianContrator">
<span<?php echo $contractor_view->ZambianContrator->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ZambianContrator" class="custom-control-input" value="<?php echo $contractor_view->ZambianContrator->getViewValue() ?>" disabled<?php if (ConvertToBool($contractor_view->ZambianContrator->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ZambianContrator"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contractor_view->ContractorType->Visible) { // ContractorType ?>
	<tr id="r_ContractorType">
		<td class="<?php echo $contractor_view->TableLeftColumnClass ?>"><span id="elh_contractor_ContractorType"><?php echo $contractor_view->ContractorType->caption() ?></span></td>
		<td data-name="ContractorType" <?php echo $contractor_view->ContractorType->cellAttributes() ?>>
<span id="el_contractor_ContractorType">
<span<?php echo $contractor_view->ContractorType->viewAttributes() ?>><?php echo $contractor_view->ContractorType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contractor_view->BusinessType->Visible) { // BusinessType ?>
	<tr id="r_BusinessType">
		<td class="<?php echo $contractor_view->TableLeftColumnClass ?>"><span id="elh_contractor_BusinessType"><?php echo $contractor_view->BusinessType->caption() ?></span></td>
		<td data-name="BusinessType" <?php echo $contractor_view->BusinessType->cellAttributes() ?>>
<span id="el_contractor_BusinessType">
<span<?php echo $contractor_view->BusinessType->viewAttributes() ?>><?php echo $contractor_view->BusinessType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contractor_view->BusinessSector->Visible) { // BusinessSector ?>
	<tr id="r_BusinessSector">
		<td class="<?php echo $contractor_view->TableLeftColumnClass ?>"><span id="elh_contractor_BusinessSector"><?php echo $contractor_view->BusinessSector->caption() ?></span></td>
		<td data-name="BusinessSector" <?php echo $contractor_view->BusinessSector->cellAttributes() ?>>
<span id="el_contractor_BusinessSector">
<span<?php echo $contractor_view->BusinessSector->viewAttributes() ?>><?php echo $contractor_view->BusinessSector->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contractor_view->BusinessDesc->Visible) { // BusinessDesc ?>
	<tr id="r_BusinessDesc">
		<td class="<?php echo $contractor_view->TableLeftColumnClass ?>"><span id="elh_contractor_BusinessDesc"><?php echo $contractor_view->BusinessDesc->caption() ?></span></td>
		<td data-name="BusinessDesc" <?php echo $contractor_view->BusinessDesc->cellAttributes() ?>>
<span id="el_contractor_BusinessDesc">
<span<?php echo $contractor_view->BusinessDesc->viewAttributes() ?>><?php echo $contractor_view->BusinessDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contractor_view->PostalAddress->Visible) { // PostalAddress ?>
	<tr id="r_PostalAddress">
		<td class="<?php echo $contractor_view->TableLeftColumnClass ?>"><span id="elh_contractor_PostalAddress"><?php echo $contractor_view->PostalAddress->caption() ?></span></td>
		<td data-name="PostalAddress" <?php echo $contractor_view->PostalAddress->cellAttributes() ?>>
<span id="el_contractor_PostalAddress">
<span<?php echo $contractor_view->PostalAddress->viewAttributes() ?>><?php echo $contractor_view->PostalAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contractor_view->Town->Visible) { // Town ?>
	<tr id="r_Town">
		<td class="<?php echo $contractor_view->TableLeftColumnClass ?>"><span id="elh_contractor_Town"><?php echo $contractor_view->Town->caption() ?></span></td>
		<td data-name="Town" <?php echo $contractor_view->Town->cellAttributes() ?>>
<span id="el_contractor_Town">
<span<?php echo $contractor_view->Town->viewAttributes() ?>><?php echo $contractor_view->Town->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contractor_view->PhysicaAddress->Visible) { // PhysicaAddress ?>
	<tr id="r_PhysicaAddress">
		<td class="<?php echo $contractor_view->TableLeftColumnClass ?>"><span id="elh_contractor_PhysicaAddress"><?php echo $contractor_view->PhysicaAddress->caption() ?></span></td>
		<td data-name="PhysicaAddress" <?php echo $contractor_view->PhysicaAddress->cellAttributes() ?>>
<span id="el_contractor_PhysicaAddress">
<span<?php echo $contractor_view->PhysicaAddress->viewAttributes() ?>><?php echo $contractor_view->PhysicaAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contractor_view->_Email->Visible) { // Email ?>
	<tr id="r__Email">
		<td class="<?php echo $contractor_view->TableLeftColumnClass ?>"><span id="elh_contractor__Email"><?php echo $contractor_view->_Email->caption() ?></span></td>
		<td data-name="_Email" <?php echo $contractor_view->_Email->cellAttributes() ?>>
<span id="el_contractor__Email">
<span<?php echo $contractor_view->_Email->viewAttributes() ?>><?php echo $contractor_view->_Email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contractor_view->Telephone->Visible) { // Telephone ?>
	<tr id="r_Telephone">
		<td class="<?php echo $contractor_view->TableLeftColumnClass ?>"><span id="elh_contractor_Telephone"><?php echo $contractor_view->Telephone->caption() ?></span></td>
		<td data-name="Telephone" <?php echo $contractor_view->Telephone->cellAttributes() ?>>
<span id="el_contractor_Telephone">
<span<?php echo $contractor_view->Telephone->viewAttributes() ?>><?php echo $contractor_view->Telephone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contractor_view->Mobile->Visible) { // Mobile ?>
	<tr id="r_Mobile">
		<td class="<?php echo $contractor_view->TableLeftColumnClass ?>"><span id="elh_contractor_Mobile"><?php echo $contractor_view->Mobile->caption() ?></span></td>
		<td data-name="Mobile" <?php echo $contractor_view->Mobile->cellAttributes() ?>>
<span id="el_contractor_Mobile">
<span<?php echo $contractor_view->Mobile->viewAttributes() ?>><?php echo $contractor_view->Mobile->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contractor_view->Fax->Visible) { // Fax ?>
	<tr id="r_Fax">
		<td class="<?php echo $contractor_view->TableLeftColumnClass ?>"><span id="elh_contractor_Fax"><?php echo $contractor_view->Fax->caption() ?></span></td>
		<td data-name="Fax" <?php echo $contractor_view->Fax->cellAttributes() ?>>
<span id="el_contractor_Fax">
<span<?php echo $contractor_view->Fax->viewAttributes() ?>><?php echo $contractor_view->Fax->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contractor_view->Country->Visible) { // Country ?>
	<tr id="r_Country">
		<td class="<?php echo $contractor_view->TableLeftColumnClass ?>"><span id="elh_contractor_Country"><?php echo $contractor_view->Country->caption() ?></span></td>
		<td data-name="Country" <?php echo $contractor_view->Country->cellAttributes() ?>>
<span id="el_contractor_Country">
<span<?php echo $contractor_view->Country->viewAttributes() ?>><?php echo $contractor_view->Country->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contractor_view->ContactPerson->Visible) { // ContactPerson ?>
	<tr id="r_ContactPerson">
		<td class="<?php echo $contractor_view->TableLeftColumnClass ?>"><span id="elh_contractor_ContactPerson"><?php echo $contractor_view->ContactPerson->caption() ?></span></td>
		<td data-name="ContactPerson" <?php echo $contractor_view->ContactPerson->cellAttributes() ?>>
<span id="el_contractor_ContactPerson">
<span<?php echo $contractor_view->ContactPerson->viewAttributes() ?>><?php echo $contractor_view->ContactPerson->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$contractor_view->IsModal) { ?>
<?php if (!$contractor_view->isExport()) { ?>
<?php echo $contractor_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$contractor_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$contractor_view->isExport()) { ?>
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
$contractor_view->terminate();
?>