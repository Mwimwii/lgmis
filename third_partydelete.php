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
$third_party_delete = new third_party_delete();

// Run the page
$third_party_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$third_party_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fthird_partydelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fthird_partydelete = currentForm = new ew.Form("fthird_partydelete", "delete");
	loadjs.done("fthird_partydelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $third_party_delete->showPageHeader(); ?>
<?php
$third_party_delete->showMessage();
?>
<form name="fthird_partydelete" id="fthird_partydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="third_party">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($third_party_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($third_party_delete->ThirdPartyName->Visible) { // ThirdPartyName ?>
		<th class="<?php echo $third_party_delete->ThirdPartyName->headerCellClass() ?>"><span id="elh_third_party_ThirdPartyName" class="third_party_ThirdPartyName"><?php echo $third_party_delete->ThirdPartyName->caption() ?></span></th>
<?php } ?>
<?php if ($third_party_delete->DateOfEngagement->Visible) { // DateOfEngagement ?>
		<th class="<?php echo $third_party_delete->DateOfEngagement->headerCellClass() ?>"><span id="elh_third_party_DateOfEngagement" class="third_party_DateOfEngagement"><?php echo $third_party_delete->DateOfEngagement->caption() ?></span></th>
<?php } ?>
<?php if ($third_party_delete->DeductionCode->Visible) { // DeductionCode ?>
		<th class="<?php echo $third_party_delete->DeductionCode->headerCellClass() ?>"><span id="elh_third_party_DeductionCode" class="third_party_DeductionCode"><?php echo $third_party_delete->DeductionCode->caption() ?></span></th>
<?php } ?>
<?php if ($third_party_delete->DeductionRate->Visible) { // DeductionRate ?>
		<th class="<?php echo $third_party_delete->DeductionRate->headerCellClass() ?>"><span id="elh_third_party_DeductionRate" class="third_party_DeductionRate"><?php echo $third_party_delete->DeductionRate->caption() ?></span></th>
<?php } ?>
<?php if ($third_party_delete->DeductionAmount->Visible) { // DeductionAmount ?>
		<th class="<?php echo $third_party_delete->DeductionAmount->headerCellClass() ?>"><span id="elh_third_party_DeductionAmount" class="third_party_DeductionAmount"><?php echo $third_party_delete->DeductionAmount->caption() ?></span></th>
<?php } ?>
<?php if ($third_party_delete->DeductionLimit->Visible) { // DeductionLimit ?>
		<th class="<?php echo $third_party_delete->DeductionLimit->headerCellClass() ?>"><span id="elh_third_party_DeductionLimit" class="third_party_DeductionLimit"><?php echo $third_party_delete->DeductionLimit->caption() ?></span></th>
<?php } ?>
<?php if ($third_party_delete->EmployerContribution->Visible) { // EmployerContribution ?>
		<th class="<?php echo $third_party_delete->EmployerContribution->headerCellClass() ?>"><span id="elh_third_party_EmployerContribution" class="third_party_EmployerContribution"><?php echo $third_party_delete->EmployerContribution->caption() ?></span></th>
<?php } ?>
<?php if ($third_party_delete->DeductionDescription->Visible) { // DeductionDescription ?>
		<th class="<?php echo $third_party_delete->DeductionDescription->headerCellClass() ?>"><span id="elh_third_party_DeductionDescription" class="third_party_DeductionDescription"><?php echo $third_party_delete->DeductionDescription->caption() ?></span></th>
<?php } ?>
<?php if ($third_party_delete->PostalAddress->Visible) { // PostalAddress ?>
		<th class="<?php echo $third_party_delete->PostalAddress->headerCellClass() ?>"><span id="elh_third_party_PostalAddress" class="third_party_PostalAddress"><?php echo $third_party_delete->PostalAddress->caption() ?></span></th>
<?php } ?>
<?php if ($third_party_delete->PhysicalAddress->Visible) { // PhysicalAddress ?>
		<th class="<?php echo $third_party_delete->PhysicalAddress->headerCellClass() ?>"><span id="elh_third_party_PhysicalAddress" class="third_party_PhysicalAddress"><?php echo $third_party_delete->PhysicalAddress->caption() ?></span></th>
<?php } ?>
<?php if ($third_party_delete->TownOrVillage->Visible) { // TownOrVillage ?>
		<th class="<?php echo $third_party_delete->TownOrVillage->headerCellClass() ?>"><span id="elh_third_party_TownOrVillage" class="third_party_TownOrVillage"><?php echo $third_party_delete->TownOrVillage->caption() ?></span></th>
<?php } ?>
<?php if ($third_party_delete->Telephone->Visible) { // Telephone ?>
		<th class="<?php echo $third_party_delete->Telephone->headerCellClass() ?>"><span id="elh_third_party_Telephone" class="third_party_Telephone"><?php echo $third_party_delete->Telephone->caption() ?></span></th>
<?php } ?>
<?php if ($third_party_delete->Mobile->Visible) { // Mobile ?>
		<th class="<?php echo $third_party_delete->Mobile->headerCellClass() ?>"><span id="elh_third_party_Mobile" class="third_party_Mobile"><?php echo $third_party_delete->Mobile->caption() ?></span></th>
<?php } ?>
<?php if ($third_party_delete->Fax->Visible) { // Fax ?>
		<th class="<?php echo $third_party_delete->Fax->headerCellClass() ?>"><span id="elh_third_party_Fax" class="third_party_Fax"><?php echo $third_party_delete->Fax->caption() ?></span></th>
<?php } ?>
<?php if ($third_party_delete->_Email->Visible) { // Email ?>
		<th class="<?php echo $third_party_delete->_Email->headerCellClass() ?>"><span id="elh_third_party__Email" class="third_party__Email"><?php echo $third_party_delete->_Email->caption() ?></span></th>
<?php } ?>
<?php if ($third_party_delete->BankBranchCode->Visible) { // BankBranchCode ?>
		<th class="<?php echo $third_party_delete->BankBranchCode->headerCellClass() ?>"><span id="elh_third_party_BankBranchCode" class="third_party_BankBranchCode"><?php echo $third_party_delete->BankBranchCode->caption() ?></span></th>
<?php } ?>
<?php if ($third_party_delete->BankAccountNo->Visible) { // BankAccountNo ?>
		<th class="<?php echo $third_party_delete->BankAccountNo->headerCellClass() ?>"><span id="elh_third_party_BankAccountNo" class="third_party_BankAccountNo"><?php echo $third_party_delete->BankAccountNo->caption() ?></span></th>
<?php } ?>
<?php if ($third_party_delete->PaymentMethod->Visible) { // PaymentMethod ?>
		<th class="<?php echo $third_party_delete->PaymentMethod->headerCellClass() ?>"><span id="elh_third_party_PaymentMethod" class="third_party_PaymentMethod"><?php echo $third_party_delete->PaymentMethod->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$third_party_delete->RecordCount = 0;
$i = 0;
while (!$third_party_delete->Recordset->EOF) {
	$third_party_delete->RecordCount++;
	$third_party_delete->RowCount++;

	// Set row properties
	$third_party->resetAttributes();
	$third_party->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$third_party_delete->loadRowValues($third_party_delete->Recordset);

	// Render row
	$third_party_delete->renderRow();
?>
	<tr <?php echo $third_party->rowAttributes() ?>>
<?php if ($third_party_delete->ThirdPartyName->Visible) { // ThirdPartyName ?>
		<td <?php echo $third_party_delete->ThirdPartyName->cellAttributes() ?>>
<span id="el<?php echo $third_party_delete->RowCount ?>_third_party_ThirdPartyName" class="third_party_ThirdPartyName">
<span<?php echo $third_party_delete->ThirdPartyName->viewAttributes() ?>><?php echo $third_party_delete->ThirdPartyName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($third_party_delete->DateOfEngagement->Visible) { // DateOfEngagement ?>
		<td <?php echo $third_party_delete->DateOfEngagement->cellAttributes() ?>>
<span id="el<?php echo $third_party_delete->RowCount ?>_third_party_DateOfEngagement" class="third_party_DateOfEngagement">
<span<?php echo $third_party_delete->DateOfEngagement->viewAttributes() ?>><?php echo $third_party_delete->DateOfEngagement->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($third_party_delete->DeductionCode->Visible) { // DeductionCode ?>
		<td <?php echo $third_party_delete->DeductionCode->cellAttributes() ?>>
<span id="el<?php echo $third_party_delete->RowCount ?>_third_party_DeductionCode" class="third_party_DeductionCode">
<span<?php echo $third_party_delete->DeductionCode->viewAttributes() ?>><?php echo $third_party_delete->DeductionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($third_party_delete->DeductionRate->Visible) { // DeductionRate ?>
		<td <?php echo $third_party_delete->DeductionRate->cellAttributes() ?>>
<span id="el<?php echo $third_party_delete->RowCount ?>_third_party_DeductionRate" class="third_party_DeductionRate">
<span<?php echo $third_party_delete->DeductionRate->viewAttributes() ?>><?php echo $third_party_delete->DeductionRate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($third_party_delete->DeductionAmount->Visible) { // DeductionAmount ?>
		<td <?php echo $third_party_delete->DeductionAmount->cellAttributes() ?>>
<span id="el<?php echo $third_party_delete->RowCount ?>_third_party_DeductionAmount" class="third_party_DeductionAmount">
<span<?php echo $third_party_delete->DeductionAmount->viewAttributes() ?>><?php echo $third_party_delete->DeductionAmount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($third_party_delete->DeductionLimit->Visible) { // DeductionLimit ?>
		<td <?php echo $third_party_delete->DeductionLimit->cellAttributes() ?>>
<span id="el<?php echo $third_party_delete->RowCount ?>_third_party_DeductionLimit" class="third_party_DeductionLimit">
<span<?php echo $third_party_delete->DeductionLimit->viewAttributes() ?>><?php echo $third_party_delete->DeductionLimit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($third_party_delete->EmployerContribution->Visible) { // EmployerContribution ?>
		<td <?php echo $third_party_delete->EmployerContribution->cellAttributes() ?>>
<span id="el<?php echo $third_party_delete->RowCount ?>_third_party_EmployerContribution" class="third_party_EmployerContribution">
<span<?php echo $third_party_delete->EmployerContribution->viewAttributes() ?>><?php echo $third_party_delete->EmployerContribution->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($third_party_delete->DeductionDescription->Visible) { // DeductionDescription ?>
		<td <?php echo $third_party_delete->DeductionDescription->cellAttributes() ?>>
<span id="el<?php echo $third_party_delete->RowCount ?>_third_party_DeductionDescription" class="third_party_DeductionDescription">
<span<?php echo $third_party_delete->DeductionDescription->viewAttributes() ?>><?php echo $third_party_delete->DeductionDescription->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($third_party_delete->PostalAddress->Visible) { // PostalAddress ?>
		<td <?php echo $third_party_delete->PostalAddress->cellAttributes() ?>>
<span id="el<?php echo $third_party_delete->RowCount ?>_third_party_PostalAddress" class="third_party_PostalAddress">
<span<?php echo $third_party_delete->PostalAddress->viewAttributes() ?>><?php echo $third_party_delete->PostalAddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($third_party_delete->PhysicalAddress->Visible) { // PhysicalAddress ?>
		<td <?php echo $third_party_delete->PhysicalAddress->cellAttributes() ?>>
<span id="el<?php echo $third_party_delete->RowCount ?>_third_party_PhysicalAddress" class="third_party_PhysicalAddress">
<span<?php echo $third_party_delete->PhysicalAddress->viewAttributes() ?>><?php echo $third_party_delete->PhysicalAddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($third_party_delete->TownOrVillage->Visible) { // TownOrVillage ?>
		<td <?php echo $third_party_delete->TownOrVillage->cellAttributes() ?>>
<span id="el<?php echo $third_party_delete->RowCount ?>_third_party_TownOrVillage" class="third_party_TownOrVillage">
<span<?php echo $third_party_delete->TownOrVillage->viewAttributes() ?>><?php echo $third_party_delete->TownOrVillage->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($third_party_delete->Telephone->Visible) { // Telephone ?>
		<td <?php echo $third_party_delete->Telephone->cellAttributes() ?>>
<span id="el<?php echo $third_party_delete->RowCount ?>_third_party_Telephone" class="third_party_Telephone">
<span<?php echo $third_party_delete->Telephone->viewAttributes() ?>><?php echo $third_party_delete->Telephone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($third_party_delete->Mobile->Visible) { // Mobile ?>
		<td <?php echo $third_party_delete->Mobile->cellAttributes() ?>>
<span id="el<?php echo $third_party_delete->RowCount ?>_third_party_Mobile" class="third_party_Mobile">
<span<?php echo $third_party_delete->Mobile->viewAttributes() ?>><?php echo $third_party_delete->Mobile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($third_party_delete->Fax->Visible) { // Fax ?>
		<td <?php echo $third_party_delete->Fax->cellAttributes() ?>>
<span id="el<?php echo $third_party_delete->RowCount ?>_third_party_Fax" class="third_party_Fax">
<span<?php echo $third_party_delete->Fax->viewAttributes() ?>><?php echo $third_party_delete->Fax->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($third_party_delete->_Email->Visible) { // Email ?>
		<td <?php echo $third_party_delete->_Email->cellAttributes() ?>>
<span id="el<?php echo $third_party_delete->RowCount ?>_third_party__Email" class="third_party__Email">
<span<?php echo $third_party_delete->_Email->viewAttributes() ?>><?php echo $third_party_delete->_Email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($third_party_delete->BankBranchCode->Visible) { // BankBranchCode ?>
		<td <?php echo $third_party_delete->BankBranchCode->cellAttributes() ?>>
<span id="el<?php echo $third_party_delete->RowCount ?>_third_party_BankBranchCode" class="third_party_BankBranchCode">
<span<?php echo $third_party_delete->BankBranchCode->viewAttributes() ?>><?php echo $third_party_delete->BankBranchCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($third_party_delete->BankAccountNo->Visible) { // BankAccountNo ?>
		<td <?php echo $third_party_delete->BankAccountNo->cellAttributes() ?>>
<span id="el<?php echo $third_party_delete->RowCount ?>_third_party_BankAccountNo" class="third_party_BankAccountNo">
<span<?php echo $third_party_delete->BankAccountNo->viewAttributes() ?>><?php echo $third_party_delete->BankAccountNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($third_party_delete->PaymentMethod->Visible) { // PaymentMethod ?>
		<td <?php echo $third_party_delete->PaymentMethod->cellAttributes() ?>>
<span id="el<?php echo $third_party_delete->RowCount ?>_third_party_PaymentMethod" class="third_party_PaymentMethod">
<span<?php echo $third_party_delete->PaymentMethod->viewAttributes() ?>><?php echo $third_party_delete->PaymentMethod->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$third_party_delete->Recordset->moveNext();
}
$third_party_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $third_party_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$third_party_delete->showPageFooter();
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
$third_party_delete->terminate();
?>