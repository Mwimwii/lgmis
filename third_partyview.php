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
$third_party_view = new third_party_view();

// Run the page
$third_party_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$third_party_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$third_party_view->isExport()) { ?>
<script>
var fthird_partyview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fthird_partyview = currentForm = new ew.Form("fthird_partyview", "view");
	loadjs.done("fthird_partyview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$third_party_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $third_party_view->ExportOptions->render("body") ?>
<?php $third_party_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $third_party_view->showPageHeader(); ?>
<?php
$third_party_view->showMessage();
?>
<?php if (!$third_party_view->IsModal) { ?>
<?php if (!$third_party_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $third_party_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fthird_partyview" id="fthird_partyview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="third_party">
<input type="hidden" name="modal" value="<?php echo (int)$third_party_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($third_party_view->ThirdPartyName->Visible) { // ThirdPartyName ?>
	<tr id="r_ThirdPartyName">
		<td class="<?php echo $third_party_view->TableLeftColumnClass ?>"><span id="elh_third_party_ThirdPartyName"><?php echo $third_party_view->ThirdPartyName->caption() ?></span></td>
		<td data-name="ThirdPartyName" <?php echo $third_party_view->ThirdPartyName->cellAttributes() ?>>
<span id="el_third_party_ThirdPartyName">
<span<?php echo $third_party_view->ThirdPartyName->viewAttributes() ?>><?php echo $third_party_view->ThirdPartyName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($third_party_view->DateOfEngagement->Visible) { // DateOfEngagement ?>
	<tr id="r_DateOfEngagement">
		<td class="<?php echo $third_party_view->TableLeftColumnClass ?>"><span id="elh_third_party_DateOfEngagement"><?php echo $third_party_view->DateOfEngagement->caption() ?></span></td>
		<td data-name="DateOfEngagement" <?php echo $third_party_view->DateOfEngagement->cellAttributes() ?>>
<span id="el_third_party_DateOfEngagement">
<span<?php echo $third_party_view->DateOfEngagement->viewAttributes() ?>><?php echo $third_party_view->DateOfEngagement->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($third_party_view->DeductionCode->Visible) { // DeductionCode ?>
	<tr id="r_DeductionCode">
		<td class="<?php echo $third_party_view->TableLeftColumnClass ?>"><span id="elh_third_party_DeductionCode"><?php echo $third_party_view->DeductionCode->caption() ?></span></td>
		<td data-name="DeductionCode" <?php echo $third_party_view->DeductionCode->cellAttributes() ?>>
<span id="el_third_party_DeductionCode">
<span<?php echo $third_party_view->DeductionCode->viewAttributes() ?>><?php echo $third_party_view->DeductionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($third_party_view->DeductionRate->Visible) { // DeductionRate ?>
	<tr id="r_DeductionRate">
		<td class="<?php echo $third_party_view->TableLeftColumnClass ?>"><span id="elh_third_party_DeductionRate"><?php echo $third_party_view->DeductionRate->caption() ?></span></td>
		<td data-name="DeductionRate" <?php echo $third_party_view->DeductionRate->cellAttributes() ?>>
<span id="el_third_party_DeductionRate">
<span<?php echo $third_party_view->DeductionRate->viewAttributes() ?>><?php echo $third_party_view->DeductionRate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($third_party_view->DeductionAmount->Visible) { // DeductionAmount ?>
	<tr id="r_DeductionAmount">
		<td class="<?php echo $third_party_view->TableLeftColumnClass ?>"><span id="elh_third_party_DeductionAmount"><?php echo $third_party_view->DeductionAmount->caption() ?></span></td>
		<td data-name="DeductionAmount" <?php echo $third_party_view->DeductionAmount->cellAttributes() ?>>
<span id="el_third_party_DeductionAmount">
<span<?php echo $third_party_view->DeductionAmount->viewAttributes() ?>><?php echo $third_party_view->DeductionAmount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($third_party_view->DeductionLimit->Visible) { // DeductionLimit ?>
	<tr id="r_DeductionLimit">
		<td class="<?php echo $third_party_view->TableLeftColumnClass ?>"><span id="elh_third_party_DeductionLimit"><?php echo $third_party_view->DeductionLimit->caption() ?></span></td>
		<td data-name="DeductionLimit" <?php echo $third_party_view->DeductionLimit->cellAttributes() ?>>
<span id="el_third_party_DeductionLimit">
<span<?php echo $third_party_view->DeductionLimit->viewAttributes() ?>><?php echo $third_party_view->DeductionLimit->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($third_party_view->EmployerContribution->Visible) { // EmployerContribution ?>
	<tr id="r_EmployerContribution">
		<td class="<?php echo $third_party_view->TableLeftColumnClass ?>"><span id="elh_third_party_EmployerContribution"><?php echo $third_party_view->EmployerContribution->caption() ?></span></td>
		<td data-name="EmployerContribution" <?php echo $third_party_view->EmployerContribution->cellAttributes() ?>>
<span id="el_third_party_EmployerContribution">
<span<?php echo $third_party_view->EmployerContribution->viewAttributes() ?>><?php echo $third_party_view->EmployerContribution->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($third_party_view->DeductionDescription->Visible) { // DeductionDescription ?>
	<tr id="r_DeductionDescription">
		<td class="<?php echo $third_party_view->TableLeftColumnClass ?>"><span id="elh_third_party_DeductionDescription"><?php echo $third_party_view->DeductionDescription->caption() ?></span></td>
		<td data-name="DeductionDescription" <?php echo $third_party_view->DeductionDescription->cellAttributes() ?>>
<span id="el_third_party_DeductionDescription">
<span<?php echo $third_party_view->DeductionDescription->viewAttributes() ?>><?php echo $third_party_view->DeductionDescription->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($third_party_view->PostalAddress->Visible) { // PostalAddress ?>
	<tr id="r_PostalAddress">
		<td class="<?php echo $third_party_view->TableLeftColumnClass ?>"><span id="elh_third_party_PostalAddress"><?php echo $third_party_view->PostalAddress->caption() ?></span></td>
		<td data-name="PostalAddress" <?php echo $third_party_view->PostalAddress->cellAttributes() ?>>
<span id="el_third_party_PostalAddress">
<span<?php echo $third_party_view->PostalAddress->viewAttributes() ?>><?php echo $third_party_view->PostalAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($third_party_view->PhysicalAddress->Visible) { // PhysicalAddress ?>
	<tr id="r_PhysicalAddress">
		<td class="<?php echo $third_party_view->TableLeftColumnClass ?>"><span id="elh_third_party_PhysicalAddress"><?php echo $third_party_view->PhysicalAddress->caption() ?></span></td>
		<td data-name="PhysicalAddress" <?php echo $third_party_view->PhysicalAddress->cellAttributes() ?>>
<span id="el_third_party_PhysicalAddress">
<span<?php echo $third_party_view->PhysicalAddress->viewAttributes() ?>><?php echo $third_party_view->PhysicalAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($third_party_view->TownOrVillage->Visible) { // TownOrVillage ?>
	<tr id="r_TownOrVillage">
		<td class="<?php echo $third_party_view->TableLeftColumnClass ?>"><span id="elh_third_party_TownOrVillage"><?php echo $third_party_view->TownOrVillage->caption() ?></span></td>
		<td data-name="TownOrVillage" <?php echo $third_party_view->TownOrVillage->cellAttributes() ?>>
<span id="el_third_party_TownOrVillage">
<span<?php echo $third_party_view->TownOrVillage->viewAttributes() ?>><?php echo $third_party_view->TownOrVillage->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($third_party_view->Telephone->Visible) { // Telephone ?>
	<tr id="r_Telephone">
		<td class="<?php echo $third_party_view->TableLeftColumnClass ?>"><span id="elh_third_party_Telephone"><?php echo $third_party_view->Telephone->caption() ?></span></td>
		<td data-name="Telephone" <?php echo $third_party_view->Telephone->cellAttributes() ?>>
<span id="el_third_party_Telephone">
<span<?php echo $third_party_view->Telephone->viewAttributes() ?>><?php echo $third_party_view->Telephone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($third_party_view->Mobile->Visible) { // Mobile ?>
	<tr id="r_Mobile">
		<td class="<?php echo $third_party_view->TableLeftColumnClass ?>"><span id="elh_third_party_Mobile"><?php echo $third_party_view->Mobile->caption() ?></span></td>
		<td data-name="Mobile" <?php echo $third_party_view->Mobile->cellAttributes() ?>>
<span id="el_third_party_Mobile">
<span<?php echo $third_party_view->Mobile->viewAttributes() ?>><?php echo $third_party_view->Mobile->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($third_party_view->Fax->Visible) { // Fax ?>
	<tr id="r_Fax">
		<td class="<?php echo $third_party_view->TableLeftColumnClass ?>"><span id="elh_third_party_Fax"><?php echo $third_party_view->Fax->caption() ?></span></td>
		<td data-name="Fax" <?php echo $third_party_view->Fax->cellAttributes() ?>>
<span id="el_third_party_Fax">
<span<?php echo $third_party_view->Fax->viewAttributes() ?>><?php echo $third_party_view->Fax->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($third_party_view->_Email->Visible) { // Email ?>
	<tr id="r__Email">
		<td class="<?php echo $third_party_view->TableLeftColumnClass ?>"><span id="elh_third_party__Email"><?php echo $third_party_view->_Email->caption() ?></span></td>
		<td data-name="_Email" <?php echo $third_party_view->_Email->cellAttributes() ?>>
<span id="el_third_party__Email">
<span<?php echo $third_party_view->_Email->viewAttributes() ?>><?php echo $third_party_view->_Email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($third_party_view->BankBranchCode->Visible) { // BankBranchCode ?>
	<tr id="r_BankBranchCode">
		<td class="<?php echo $third_party_view->TableLeftColumnClass ?>"><span id="elh_third_party_BankBranchCode"><?php echo $third_party_view->BankBranchCode->caption() ?></span></td>
		<td data-name="BankBranchCode" <?php echo $third_party_view->BankBranchCode->cellAttributes() ?>>
<span id="el_third_party_BankBranchCode">
<span<?php echo $third_party_view->BankBranchCode->viewAttributes() ?>><?php echo $third_party_view->BankBranchCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($third_party_view->BankAccountNo->Visible) { // BankAccountNo ?>
	<tr id="r_BankAccountNo">
		<td class="<?php echo $third_party_view->TableLeftColumnClass ?>"><span id="elh_third_party_BankAccountNo"><?php echo $third_party_view->BankAccountNo->caption() ?></span></td>
		<td data-name="BankAccountNo" <?php echo $third_party_view->BankAccountNo->cellAttributes() ?>>
<span id="el_third_party_BankAccountNo">
<span<?php echo $third_party_view->BankAccountNo->viewAttributes() ?>><?php echo $third_party_view->BankAccountNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($third_party_view->PaymentMethod->Visible) { // PaymentMethod ?>
	<tr id="r_PaymentMethod">
		<td class="<?php echo $third_party_view->TableLeftColumnClass ?>"><span id="elh_third_party_PaymentMethod"><?php echo $third_party_view->PaymentMethod->caption() ?></span></td>
		<td data-name="PaymentMethod" <?php echo $third_party_view->PaymentMethod->cellAttributes() ?>>
<span id="el_third_party_PaymentMethod">
<span<?php echo $third_party_view->PaymentMethod->viewAttributes() ?>><?php echo $third_party_view->PaymentMethod->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$third_party_view->IsModal) { ?>
<?php if (!$third_party_view->isExport()) { ?>
<?php echo $third_party_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$third_party_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$third_party_view->isExport()) { ?>
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
$third_party_view->terminate();
?>