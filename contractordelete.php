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
$contractor_delete = new contractor_delete();

// Run the page
$contractor_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contractor_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcontractordelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcontractordelete = currentForm = new ew.Form("fcontractordelete", "delete");
	loadjs.done("fcontractordelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $contractor_delete->showPageHeader(); ?>
<?php
$contractor_delete->showMessage();
?>
<form name="fcontractordelete" id="fcontractordelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contractor">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($contractor_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($contractor_delete->ContractorRef->Visible) { // ContractorRef ?>
		<th class="<?php echo $contractor_delete->ContractorRef->headerCellClass() ?>"><span id="elh_contractor_ContractorRef" class="contractor_ContractorRef"><?php echo $contractor_delete->ContractorRef->caption() ?></span></th>
<?php } ?>
<?php if ($contractor_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<th class="<?php echo $contractor_delete->ProvinceCode->headerCellClass() ?>"><span id="elh_contractor_ProvinceCode" class="contractor_ProvinceCode"><?php echo $contractor_delete->ProvinceCode->caption() ?></span></th>
<?php } ?>
<?php if ($contractor_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $contractor_delete->LACode->headerCellClass() ?>"><span id="elh_contractor_LACode" class="contractor_LACode"><?php echo $contractor_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($contractor_delete->ContractorName->Visible) { // ContractorName ?>
		<th class="<?php echo $contractor_delete->ContractorName->headerCellClass() ?>"><span id="elh_contractor_ContractorName" class="contractor_ContractorName"><?php echo $contractor_delete->ContractorName->caption() ?></span></th>
<?php } ?>
<?php if ($contractor_delete->TradingName->Visible) { // TradingName ?>
		<th class="<?php echo $contractor_delete->TradingName->headerCellClass() ?>"><span id="elh_contractor_TradingName" class="contractor_TradingName"><?php echo $contractor_delete->TradingName->caption() ?></span></th>
<?php } ?>
<?php if ($contractor_delete->ZambianContrator->Visible) { // ZambianContrator ?>
		<th class="<?php echo $contractor_delete->ZambianContrator->headerCellClass() ?>"><span id="elh_contractor_ZambianContrator" class="contractor_ZambianContrator"><?php echo $contractor_delete->ZambianContrator->caption() ?></span></th>
<?php } ?>
<?php if ($contractor_delete->ContractorType->Visible) { // ContractorType ?>
		<th class="<?php echo $contractor_delete->ContractorType->headerCellClass() ?>"><span id="elh_contractor_ContractorType" class="contractor_ContractorType"><?php echo $contractor_delete->ContractorType->caption() ?></span></th>
<?php } ?>
<?php if ($contractor_delete->BusinessType->Visible) { // BusinessType ?>
		<th class="<?php echo $contractor_delete->BusinessType->headerCellClass() ?>"><span id="elh_contractor_BusinessType" class="contractor_BusinessType"><?php echo $contractor_delete->BusinessType->caption() ?></span></th>
<?php } ?>
<?php if ($contractor_delete->BusinessSector->Visible) { // BusinessSector ?>
		<th class="<?php echo $contractor_delete->BusinessSector->headerCellClass() ?>"><span id="elh_contractor_BusinessSector" class="contractor_BusinessSector"><?php echo $contractor_delete->BusinessSector->caption() ?></span></th>
<?php } ?>
<?php if ($contractor_delete->BusinessDesc->Visible) { // BusinessDesc ?>
		<th class="<?php echo $contractor_delete->BusinessDesc->headerCellClass() ?>"><span id="elh_contractor_BusinessDesc" class="contractor_BusinessDesc"><?php echo $contractor_delete->BusinessDesc->caption() ?></span></th>
<?php } ?>
<?php if ($contractor_delete->PostalAddress->Visible) { // PostalAddress ?>
		<th class="<?php echo $contractor_delete->PostalAddress->headerCellClass() ?>"><span id="elh_contractor_PostalAddress" class="contractor_PostalAddress"><?php echo $contractor_delete->PostalAddress->caption() ?></span></th>
<?php } ?>
<?php if ($contractor_delete->Town->Visible) { // Town ?>
		<th class="<?php echo $contractor_delete->Town->headerCellClass() ?>"><span id="elh_contractor_Town" class="contractor_Town"><?php echo $contractor_delete->Town->caption() ?></span></th>
<?php } ?>
<?php if ($contractor_delete->PhysicaAddress->Visible) { // PhysicaAddress ?>
		<th class="<?php echo $contractor_delete->PhysicaAddress->headerCellClass() ?>"><span id="elh_contractor_PhysicaAddress" class="contractor_PhysicaAddress"><?php echo $contractor_delete->PhysicaAddress->caption() ?></span></th>
<?php } ?>
<?php if ($contractor_delete->_Email->Visible) { // Email ?>
		<th class="<?php echo $contractor_delete->_Email->headerCellClass() ?>"><span id="elh_contractor__Email" class="contractor__Email"><?php echo $contractor_delete->_Email->caption() ?></span></th>
<?php } ?>
<?php if ($contractor_delete->Telephone->Visible) { // Telephone ?>
		<th class="<?php echo $contractor_delete->Telephone->headerCellClass() ?>"><span id="elh_contractor_Telephone" class="contractor_Telephone"><?php echo $contractor_delete->Telephone->caption() ?></span></th>
<?php } ?>
<?php if ($contractor_delete->Mobile->Visible) { // Mobile ?>
		<th class="<?php echo $contractor_delete->Mobile->headerCellClass() ?>"><span id="elh_contractor_Mobile" class="contractor_Mobile"><?php echo $contractor_delete->Mobile->caption() ?></span></th>
<?php } ?>
<?php if ($contractor_delete->Fax->Visible) { // Fax ?>
		<th class="<?php echo $contractor_delete->Fax->headerCellClass() ?>"><span id="elh_contractor_Fax" class="contractor_Fax"><?php echo $contractor_delete->Fax->caption() ?></span></th>
<?php } ?>
<?php if ($contractor_delete->Country->Visible) { // Country ?>
		<th class="<?php echo $contractor_delete->Country->headerCellClass() ?>"><span id="elh_contractor_Country" class="contractor_Country"><?php echo $contractor_delete->Country->caption() ?></span></th>
<?php } ?>
<?php if ($contractor_delete->ContactPerson->Visible) { // ContactPerson ?>
		<th class="<?php echo $contractor_delete->ContactPerson->headerCellClass() ?>"><span id="elh_contractor_ContactPerson" class="contractor_ContactPerson"><?php echo $contractor_delete->ContactPerson->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$contractor_delete->RecordCount = 0;
$i = 0;
while (!$contractor_delete->Recordset->EOF) {
	$contractor_delete->RecordCount++;
	$contractor_delete->RowCount++;

	// Set row properties
	$contractor->resetAttributes();
	$contractor->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$contractor_delete->loadRowValues($contractor_delete->Recordset);

	// Render row
	$contractor_delete->renderRow();
?>
	<tr <?php echo $contractor->rowAttributes() ?>>
<?php if ($contractor_delete->ContractorRef->Visible) { // ContractorRef ?>
		<td <?php echo $contractor_delete->ContractorRef->cellAttributes() ?>>
<span id="el<?php echo $contractor_delete->RowCount ?>_contractor_ContractorRef" class="contractor_ContractorRef">
<span<?php echo $contractor_delete->ContractorRef->viewAttributes() ?>><?php echo $contractor_delete->ContractorRef->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contractor_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<td <?php echo $contractor_delete->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $contractor_delete->RowCount ?>_contractor_ProvinceCode" class="contractor_ProvinceCode">
<span<?php echo $contractor_delete->ProvinceCode->viewAttributes() ?>><?php echo $contractor_delete->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contractor_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $contractor_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $contractor_delete->RowCount ?>_contractor_LACode" class="contractor_LACode">
<span<?php echo $contractor_delete->LACode->viewAttributes() ?>><?php echo $contractor_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contractor_delete->ContractorName->Visible) { // ContractorName ?>
		<td <?php echo $contractor_delete->ContractorName->cellAttributes() ?>>
<span id="el<?php echo $contractor_delete->RowCount ?>_contractor_ContractorName" class="contractor_ContractorName">
<span<?php echo $contractor_delete->ContractorName->viewAttributes() ?>><?php echo $contractor_delete->ContractorName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contractor_delete->TradingName->Visible) { // TradingName ?>
		<td <?php echo $contractor_delete->TradingName->cellAttributes() ?>>
<span id="el<?php echo $contractor_delete->RowCount ?>_contractor_TradingName" class="contractor_TradingName">
<span<?php echo $contractor_delete->TradingName->viewAttributes() ?>><?php echo $contractor_delete->TradingName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contractor_delete->ZambianContrator->Visible) { // ZambianContrator ?>
		<td <?php echo $contractor_delete->ZambianContrator->cellAttributes() ?>>
<span id="el<?php echo $contractor_delete->RowCount ?>_contractor_ZambianContrator" class="contractor_ZambianContrator">
<span<?php echo $contractor_delete->ZambianContrator->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ZambianContrator" class="custom-control-input" value="<?php echo $contractor_delete->ZambianContrator->getViewValue() ?>" disabled<?php if (ConvertToBool($contractor_delete->ZambianContrator->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ZambianContrator"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($contractor_delete->ContractorType->Visible) { // ContractorType ?>
		<td <?php echo $contractor_delete->ContractorType->cellAttributes() ?>>
<span id="el<?php echo $contractor_delete->RowCount ?>_contractor_ContractorType" class="contractor_ContractorType">
<span<?php echo $contractor_delete->ContractorType->viewAttributes() ?>><?php echo $contractor_delete->ContractorType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contractor_delete->BusinessType->Visible) { // BusinessType ?>
		<td <?php echo $contractor_delete->BusinessType->cellAttributes() ?>>
<span id="el<?php echo $contractor_delete->RowCount ?>_contractor_BusinessType" class="contractor_BusinessType">
<span<?php echo $contractor_delete->BusinessType->viewAttributes() ?>><?php echo $contractor_delete->BusinessType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contractor_delete->BusinessSector->Visible) { // BusinessSector ?>
		<td <?php echo $contractor_delete->BusinessSector->cellAttributes() ?>>
<span id="el<?php echo $contractor_delete->RowCount ?>_contractor_BusinessSector" class="contractor_BusinessSector">
<span<?php echo $contractor_delete->BusinessSector->viewAttributes() ?>><?php echo $contractor_delete->BusinessSector->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contractor_delete->BusinessDesc->Visible) { // BusinessDesc ?>
		<td <?php echo $contractor_delete->BusinessDesc->cellAttributes() ?>>
<span id="el<?php echo $contractor_delete->RowCount ?>_contractor_BusinessDesc" class="contractor_BusinessDesc">
<span<?php echo $contractor_delete->BusinessDesc->viewAttributes() ?>><?php echo $contractor_delete->BusinessDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contractor_delete->PostalAddress->Visible) { // PostalAddress ?>
		<td <?php echo $contractor_delete->PostalAddress->cellAttributes() ?>>
<span id="el<?php echo $contractor_delete->RowCount ?>_contractor_PostalAddress" class="contractor_PostalAddress">
<span<?php echo $contractor_delete->PostalAddress->viewAttributes() ?>><?php echo $contractor_delete->PostalAddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contractor_delete->Town->Visible) { // Town ?>
		<td <?php echo $contractor_delete->Town->cellAttributes() ?>>
<span id="el<?php echo $contractor_delete->RowCount ?>_contractor_Town" class="contractor_Town">
<span<?php echo $contractor_delete->Town->viewAttributes() ?>><?php echo $contractor_delete->Town->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contractor_delete->PhysicaAddress->Visible) { // PhysicaAddress ?>
		<td <?php echo $contractor_delete->PhysicaAddress->cellAttributes() ?>>
<span id="el<?php echo $contractor_delete->RowCount ?>_contractor_PhysicaAddress" class="contractor_PhysicaAddress">
<span<?php echo $contractor_delete->PhysicaAddress->viewAttributes() ?>><?php echo $contractor_delete->PhysicaAddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contractor_delete->_Email->Visible) { // Email ?>
		<td <?php echo $contractor_delete->_Email->cellAttributes() ?>>
<span id="el<?php echo $contractor_delete->RowCount ?>_contractor__Email" class="contractor__Email">
<span<?php echo $contractor_delete->_Email->viewAttributes() ?>><?php echo $contractor_delete->_Email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contractor_delete->Telephone->Visible) { // Telephone ?>
		<td <?php echo $contractor_delete->Telephone->cellAttributes() ?>>
<span id="el<?php echo $contractor_delete->RowCount ?>_contractor_Telephone" class="contractor_Telephone">
<span<?php echo $contractor_delete->Telephone->viewAttributes() ?>><?php echo $contractor_delete->Telephone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contractor_delete->Mobile->Visible) { // Mobile ?>
		<td <?php echo $contractor_delete->Mobile->cellAttributes() ?>>
<span id="el<?php echo $contractor_delete->RowCount ?>_contractor_Mobile" class="contractor_Mobile">
<span<?php echo $contractor_delete->Mobile->viewAttributes() ?>><?php echo $contractor_delete->Mobile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contractor_delete->Fax->Visible) { // Fax ?>
		<td <?php echo $contractor_delete->Fax->cellAttributes() ?>>
<span id="el<?php echo $contractor_delete->RowCount ?>_contractor_Fax" class="contractor_Fax">
<span<?php echo $contractor_delete->Fax->viewAttributes() ?>><?php echo $contractor_delete->Fax->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contractor_delete->Country->Visible) { // Country ?>
		<td <?php echo $contractor_delete->Country->cellAttributes() ?>>
<span id="el<?php echo $contractor_delete->RowCount ?>_contractor_Country" class="contractor_Country">
<span<?php echo $contractor_delete->Country->viewAttributes() ?>><?php echo $contractor_delete->Country->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contractor_delete->ContactPerson->Visible) { // ContactPerson ?>
		<td <?php echo $contractor_delete->ContactPerson->cellAttributes() ?>>
<span id="el<?php echo $contractor_delete->RowCount ?>_contractor_ContactPerson" class="contractor_ContactPerson">
<span<?php echo $contractor_delete->ContactPerson->viewAttributes() ?>><?php echo $contractor_delete->ContactPerson->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$contractor_delete->Recordset->moveNext();
}
$contractor_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contractor_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$contractor_delete->showPageFooter();
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
$contractor_delete->terminate();
?>