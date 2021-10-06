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
$property_delete = new property_delete();

// Run the page
$property_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpropertydelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpropertydelete = currentForm = new ew.Form("fpropertydelete", "delete");
	loadjs.done("fpropertydelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $property_delete->showPageHeader(); ?>
<?php
$property_delete->showMessage();
?>
<form name="fpropertydelete" id="fpropertydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($property_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($property_delete->PropertyNo->Visible) { // PropertyNo ?>
		<th class="<?php echo $property_delete->PropertyNo->headerCellClass() ?>"><span id="elh_property_PropertyNo" class="property_PropertyNo"><?php echo $property_delete->PropertyNo->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->ClientSerNo->Visible) { // ClientSerNo ?>
		<th class="<?php echo $property_delete->ClientSerNo->headerCellClass() ?>"><span id="elh_property_ClientSerNo" class="property_ClientSerNo"><?php echo $property_delete->ClientSerNo->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->ClientID->Visible) { // ClientID ?>
		<th class="<?php echo $property_delete->ClientID->headerCellClass() ?>"><span id="elh_property_ClientID" class="property_ClientID"><?php echo $property_delete->ClientID->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->PropertyGroup->Visible) { // PropertyGroup ?>
		<th class="<?php echo $property_delete->PropertyGroup->headerCellClass() ?>"><span id="elh_property_PropertyGroup" class="property_PropertyGroup"><?php echo $property_delete->PropertyGroup->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->PropertyType->Visible) { // PropertyType ?>
		<th class="<?php echo $property_delete->PropertyType->headerCellClass() ?>"><span id="elh_property_PropertyType" class="property_PropertyType"><?php echo $property_delete->PropertyType->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->Location->Visible) { // Location ?>
		<th class="<?php echo $property_delete->Location->headerCellClass() ?>"><span id="elh_property_Location" class="property_Location"><?php echo $property_delete->Location->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->PropertyStatus->Visible) { // PropertyStatus ?>
		<th class="<?php echo $property_delete->PropertyStatus->headerCellClass() ?>"><span id="elh_property_PropertyStatus" class="property_PropertyStatus"><?php echo $property_delete->PropertyStatus->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->PropertyUse->Visible) { // PropertyUse ?>
		<th class="<?php echo $property_delete->PropertyUse->headerCellClass() ?>"><span id="elh_property_PropertyUse" class="property_PropertyUse"><?php echo $property_delete->PropertyUse->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->LandExtentInHA->Visible) { // LandExtentInHA ?>
		<th class="<?php echo $property_delete->LandExtentInHA->headerCellClass() ?>"><span id="elh_property_LandExtentInHA" class="property_LandExtentInHA"><?php echo $property_delete->LandExtentInHA->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->RateableValue->Visible) { // RateableValue ?>
		<th class="<?php echo $property_delete->RateableValue->headerCellClass() ?>"><span id="elh_property_RateableValue" class="property_RateableValue"><?php echo $property_delete->RateableValue->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->SupplementaryValue->Visible) { // SupplementaryValue ?>
		<th class="<?php echo $property_delete->SupplementaryValue->headerCellClass() ?>"><span id="elh_property_SupplementaryValue" class="property_SupplementaryValue"><?php echo $property_delete->SupplementaryValue->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->ExemptCode->Visible) { // ExemptCode ?>
		<th class="<?php echo $property_delete->ExemptCode->headerCellClass() ?>"><span id="elh_property_ExemptCode" class="property_ExemptCode"><?php echo $property_delete->ExemptCode->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->Improvements->Visible) { // Improvements ?>
		<th class="<?php echo $property_delete->Improvements->headerCellClass() ?>"><span id="elh_property_Improvements" class="property_Improvements"><?php echo $property_delete->Improvements->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->StreetAddress->Visible) { // StreetAddress ?>
		<th class="<?php echo $property_delete->StreetAddress->headerCellClass() ?>"><span id="elh_property_StreetAddress" class="property_StreetAddress"><?php echo $property_delete->StreetAddress->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->Longitude->Visible) { // Longitude ?>
		<th class="<?php echo $property_delete->Longitude->headerCellClass() ?>"><span id="elh_property_Longitude" class="property_Longitude"><?php echo $property_delete->Longitude->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->Latitude->Visible) { // Latitude ?>
		<th class="<?php echo $property_delete->Latitude->headerCellClass() ?>"><span id="elh_property_Latitude" class="property_Latitude"><?php echo $property_delete->Latitude->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->Incumberance->Visible) { // Incumberance ?>
		<th class="<?php echo $property_delete->Incumberance->headerCellClass() ?>"><span id="elh_property_Incumberance" class="property_Incumberance"><?php echo $property_delete->Incumberance->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->SubDivisionOf->Visible) { // SubDivisionOf ?>
		<th class="<?php echo $property_delete->SubDivisionOf->headerCellClass() ?>"><span id="elh_property_SubDivisionOf" class="property_SubDivisionOf"><?php echo $property_delete->SubDivisionOf->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<th class="<?php echo $property_delete->LastUpdatedBy->headerCellClass() ?>"><span id="elh_property_LastUpdatedBy" class="property_LastUpdatedBy"><?php echo $property_delete->LastUpdatedBy->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<th class="<?php echo $property_delete->LastUpdateDate->headerCellClass() ?>"><span id="elh_property_LastUpdateDate" class="property_LastUpdateDate"><?php echo $property_delete->LastUpdateDate->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->ValuationNo->Visible) { // ValuationNo ?>
		<th class="<?php echo $property_delete->ValuationNo->headerCellClass() ?>"><span id="elh_property_ValuationNo" class="property_ValuationNo"><?php echo $property_delete->ValuationNo->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->LandValue->Visible) { // LandValue ?>
		<th class="<?php echo $property_delete->LandValue->headerCellClass() ?>"><span id="elh_property_LandValue" class="property_LandValue"><?php echo $property_delete->LandValue->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->ImprovementsValue->Visible) { // ImprovementsValue ?>
		<th class="<?php echo $property_delete->ImprovementsValue->headerCellClass() ?>"><span id="elh_property_ImprovementsValue" class="property_ImprovementsValue"><?php echo $property_delete->ImprovementsValue->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$property_delete->RecordCount = 0;
$i = 0;
while (!$property_delete->Recordset->EOF) {
	$property_delete->RecordCount++;
	$property_delete->RowCount++;

	// Set row properties
	$property->resetAttributes();
	$property->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$property_delete->loadRowValues($property_delete->Recordset);

	// Render row
	$property_delete->renderRow();
?>
	<tr <?php echo $property->rowAttributes() ?>>
<?php if ($property_delete->PropertyNo->Visible) { // PropertyNo ?>
		<td <?php echo $property_delete->PropertyNo->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_PropertyNo" class="property_PropertyNo">
<span<?php echo $property_delete->PropertyNo->viewAttributes() ?>><?php echo $property_delete->PropertyNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->ClientSerNo->Visible) { // ClientSerNo ?>
		<td <?php echo $property_delete->ClientSerNo->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_ClientSerNo" class="property_ClientSerNo">
<span<?php echo $property_delete->ClientSerNo->viewAttributes() ?>><?php echo $property_delete->ClientSerNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->ClientID->Visible) { // ClientID ?>
		<td <?php echo $property_delete->ClientID->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_ClientID" class="property_ClientID">
<span<?php echo $property_delete->ClientID->viewAttributes() ?>><?php echo $property_delete->ClientID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->PropertyGroup->Visible) { // PropertyGroup ?>
		<td <?php echo $property_delete->PropertyGroup->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_PropertyGroup" class="property_PropertyGroup">
<span<?php echo $property_delete->PropertyGroup->viewAttributes() ?>><?php echo $property_delete->PropertyGroup->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->PropertyType->Visible) { // PropertyType ?>
		<td <?php echo $property_delete->PropertyType->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_PropertyType" class="property_PropertyType">
<span<?php echo $property_delete->PropertyType->viewAttributes() ?>><?php echo $property_delete->PropertyType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->Location->Visible) { // Location ?>
		<td <?php echo $property_delete->Location->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_Location" class="property_Location">
<span<?php echo $property_delete->Location->viewAttributes() ?>><?php echo $property_delete->Location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->PropertyStatus->Visible) { // PropertyStatus ?>
		<td <?php echo $property_delete->PropertyStatus->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_PropertyStatus" class="property_PropertyStatus">
<span<?php echo $property_delete->PropertyStatus->viewAttributes() ?>><?php echo $property_delete->PropertyStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->PropertyUse->Visible) { // PropertyUse ?>
		<td <?php echo $property_delete->PropertyUse->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_PropertyUse" class="property_PropertyUse">
<span<?php echo $property_delete->PropertyUse->viewAttributes() ?>><?php echo $property_delete->PropertyUse->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->LandExtentInHA->Visible) { // LandExtentInHA ?>
		<td <?php echo $property_delete->LandExtentInHA->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_LandExtentInHA" class="property_LandExtentInHA">
<span<?php echo $property_delete->LandExtentInHA->viewAttributes() ?>><?php echo $property_delete->LandExtentInHA->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->RateableValue->Visible) { // RateableValue ?>
		<td <?php echo $property_delete->RateableValue->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_RateableValue" class="property_RateableValue">
<span<?php echo $property_delete->RateableValue->viewAttributes() ?>><?php echo $property_delete->RateableValue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->SupplementaryValue->Visible) { // SupplementaryValue ?>
		<td <?php echo $property_delete->SupplementaryValue->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_SupplementaryValue" class="property_SupplementaryValue">
<span<?php echo $property_delete->SupplementaryValue->viewAttributes() ?>><?php echo $property_delete->SupplementaryValue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->ExemptCode->Visible) { // ExemptCode ?>
		<td <?php echo $property_delete->ExemptCode->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_ExemptCode" class="property_ExemptCode">
<span<?php echo $property_delete->ExemptCode->viewAttributes() ?>><?php echo $property_delete->ExemptCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->Improvements->Visible) { // Improvements ?>
		<td <?php echo $property_delete->Improvements->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_Improvements" class="property_Improvements">
<span<?php echo $property_delete->Improvements->viewAttributes() ?>><?php echo $property_delete->Improvements->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->StreetAddress->Visible) { // StreetAddress ?>
		<td <?php echo $property_delete->StreetAddress->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_StreetAddress" class="property_StreetAddress">
<span<?php echo $property_delete->StreetAddress->viewAttributes() ?>><?php echo $property_delete->StreetAddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->Longitude->Visible) { // Longitude ?>
		<td <?php echo $property_delete->Longitude->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_Longitude" class="property_Longitude">
<span<?php echo $property_delete->Longitude->viewAttributes() ?>><?php echo $property_delete->Longitude->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->Latitude->Visible) { // Latitude ?>
		<td <?php echo $property_delete->Latitude->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_Latitude" class="property_Latitude">
<span<?php echo $property_delete->Latitude->viewAttributes() ?>><?php echo $property_delete->Latitude->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->Incumberance->Visible) { // Incumberance ?>
		<td <?php echo $property_delete->Incumberance->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_Incumberance" class="property_Incumberance">
<span<?php echo $property_delete->Incumberance->viewAttributes() ?>><?php echo $property_delete->Incumberance->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->SubDivisionOf->Visible) { // SubDivisionOf ?>
		<td <?php echo $property_delete->SubDivisionOf->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_SubDivisionOf" class="property_SubDivisionOf">
<span<?php echo $property_delete->SubDivisionOf->viewAttributes() ?>><?php echo $property_delete->SubDivisionOf->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td <?php echo $property_delete->LastUpdatedBy->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_LastUpdatedBy" class="property_LastUpdatedBy">
<span<?php echo $property_delete->LastUpdatedBy->viewAttributes() ?>><?php echo $property_delete->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td <?php echo $property_delete->LastUpdateDate->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_LastUpdateDate" class="property_LastUpdateDate">
<span<?php echo $property_delete->LastUpdateDate->viewAttributes() ?>><?php echo $property_delete->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->ValuationNo->Visible) { // ValuationNo ?>
		<td <?php echo $property_delete->ValuationNo->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_ValuationNo" class="property_ValuationNo">
<span<?php echo $property_delete->ValuationNo->viewAttributes() ?>><?php echo $property_delete->ValuationNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->LandValue->Visible) { // LandValue ?>
		<td <?php echo $property_delete->LandValue->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_LandValue" class="property_LandValue">
<span<?php echo $property_delete->LandValue->viewAttributes() ?>><?php echo $property_delete->LandValue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->ImprovementsValue->Visible) { // ImprovementsValue ?>
		<td <?php echo $property_delete->ImprovementsValue->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_ImprovementsValue" class="property_ImprovementsValue">
<span<?php echo $property_delete->ImprovementsValue->viewAttributes() ?>><?php echo $property_delete->ImprovementsValue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$property_delete->Recordset->moveNext();
}
$property_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$property_delete->showPageFooter();
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
$property_delete->terminate();
?>