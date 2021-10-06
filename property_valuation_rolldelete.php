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
$property_valuation_roll_delete = new property_valuation_roll_delete();

// Run the page
$property_valuation_roll_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_valuation_roll_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproperty_valuation_rolldelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fproperty_valuation_rolldelete = currentForm = new ew.Form("fproperty_valuation_rolldelete", "delete");
	loadjs.done("fproperty_valuation_rolldelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $property_valuation_roll_delete->showPageHeader(); ?>
<?php
$property_valuation_roll_delete->showMessage();
?>
<form name="fproperty_valuation_rolldelete" id="fproperty_valuation_rolldelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_valuation_roll">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($property_valuation_roll_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($property_valuation_roll_delete->ValuationNo->Visible) { // ValuationNo ?>
		<th class="<?php echo $property_valuation_roll_delete->ValuationNo->headerCellClass() ?>"><span id="elh_property_valuation_roll_ValuationNo" class="property_valuation_roll_ValuationNo"><?php echo $property_valuation_roll_delete->ValuationNo->caption() ?></span></th>
<?php } ?>
<?php if ($property_valuation_roll_delete->PropertyNo->Visible) { // PropertyNo ?>
		<th class="<?php echo $property_valuation_roll_delete->PropertyNo->headerCellClass() ?>"><span id="elh_property_valuation_roll_PropertyNo" class="property_valuation_roll_PropertyNo"><?php echo $property_valuation_roll_delete->PropertyNo->caption() ?></span></th>
<?php } ?>
<?php if ($property_valuation_roll_delete->StandNo->Visible) { // StandNo ?>
		<th class="<?php echo $property_valuation_roll_delete->StandNo->headerCellClass() ?>"><span id="elh_property_valuation_roll_StandNo" class="property_valuation_roll_StandNo"><?php echo $property_valuation_roll_delete->StandNo->caption() ?></span></th>
<?php } ?>
<?php if ($property_valuation_roll_delete->ClientID->Visible) { // ClientID ?>
		<th class="<?php echo $property_valuation_roll_delete->ClientID->headerCellClass() ?>"><span id="elh_property_valuation_roll_ClientID" class="property_valuation_roll_ClientID"><?php echo $property_valuation_roll_delete->ClientID->caption() ?></span></th>
<?php } ?>
<?php if ($property_valuation_roll_delete->PropertyGroup->Visible) { // PropertyGroup ?>
		<th class="<?php echo $property_valuation_roll_delete->PropertyGroup->headerCellClass() ?>"><span id="elh_property_valuation_roll_PropertyGroup" class="property_valuation_roll_PropertyGroup"><?php echo $property_valuation_roll_delete->PropertyGroup->caption() ?></span></th>
<?php } ?>
<?php if ($property_valuation_roll_delete->PropertyType->Visible) { // PropertyType ?>
		<th class="<?php echo $property_valuation_roll_delete->PropertyType->headerCellClass() ?>"><span id="elh_property_valuation_roll_PropertyType" class="property_valuation_roll_PropertyType"><?php echo $property_valuation_roll_delete->PropertyType->caption() ?></span></th>
<?php } ?>
<?php if ($property_valuation_roll_delete->Location->Visible) { // Location ?>
		<th class="<?php echo $property_valuation_roll_delete->Location->headerCellClass() ?>"><span id="elh_property_valuation_roll_Location" class="property_valuation_roll_Location"><?php echo $property_valuation_roll_delete->Location->caption() ?></span></th>
<?php } ?>
<?php if ($property_valuation_roll_delete->RollStatus->Visible) { // RollStatus ?>
		<th class="<?php echo $property_valuation_roll_delete->RollStatus->headerCellClass() ?>"><span id="elh_property_valuation_roll_RollStatus" class="property_valuation_roll_RollStatus"><?php echo $property_valuation_roll_delete->RollStatus->caption() ?></span></th>
<?php } ?>
<?php if ($property_valuation_roll_delete->UseCode->Visible) { // UseCode ?>
		<th class="<?php echo $property_valuation_roll_delete->UseCode->headerCellClass() ?>"><span id="elh_property_valuation_roll_UseCode" class="property_valuation_roll_UseCode"><?php echo $property_valuation_roll_delete->UseCode->caption() ?></span></th>
<?php } ?>
<?php if ($property_valuation_roll_delete->AreaOfLand->Visible) { // AreaOfLand ?>
		<th class="<?php echo $property_valuation_roll_delete->AreaOfLand->headerCellClass() ?>"><span id="elh_property_valuation_roll_AreaOfLand" class="property_valuation_roll_AreaOfLand"><?php echo $property_valuation_roll_delete->AreaOfLand->caption() ?></span></th>
<?php } ?>
<?php if ($property_valuation_roll_delete->AreaCode->Visible) { // AreaCode ?>
		<th class="<?php echo $property_valuation_roll_delete->AreaCode->headerCellClass() ?>"><span id="elh_property_valuation_roll_AreaCode" class="property_valuation_roll_AreaCode"><?php echo $property_valuation_roll_delete->AreaCode->caption() ?></span></th>
<?php } ?>
<?php if ($property_valuation_roll_delete->SiteNumber->Visible) { // SiteNumber ?>
		<th class="<?php echo $property_valuation_roll_delete->SiteNumber->headerCellClass() ?>"><span id="elh_property_valuation_roll_SiteNumber" class="property_valuation_roll_SiteNumber"><?php echo $property_valuation_roll_delete->SiteNumber->caption() ?></span></th>
<?php } ?>
<?php if ($property_valuation_roll_delete->RateableValue->Visible) { // RateableValue ?>
		<th class="<?php echo $property_valuation_roll_delete->RateableValue->headerCellClass() ?>"><span id="elh_property_valuation_roll_RateableValue" class="property_valuation_roll_RateableValue"><?php echo $property_valuation_roll_delete->RateableValue->caption() ?></span></th>
<?php } ?>
<?php if ($property_valuation_roll_delete->NewRateableValue->Visible) { // NewRateableValue ?>
		<th class="<?php echo $property_valuation_roll_delete->NewRateableValue->headerCellClass() ?>"><span id="elh_property_valuation_roll_NewRateableValue" class="property_valuation_roll_NewRateableValue"><?php echo $property_valuation_roll_delete->NewRateableValue->caption() ?></span></th>
<?php } ?>
<?php if ($property_valuation_roll_delete->ExemptCode->Visible) { // ExemptCode ?>
		<th class="<?php echo $property_valuation_roll_delete->ExemptCode->headerCellClass() ?>"><span id="elh_property_valuation_roll_ExemptCode" class="property_valuation_roll_ExemptCode"><?php echo $property_valuation_roll_delete->ExemptCode->caption() ?></span></th>
<?php } ?>
<?php if ($property_valuation_roll_delete->Improvements->Visible) { // Improvements ?>
		<th class="<?php echo $property_valuation_roll_delete->Improvements->headerCellClass() ?>"><span id="elh_property_valuation_roll_Improvements" class="property_valuation_roll_Improvements"><?php echo $property_valuation_roll_delete->Improvements->caption() ?></span></th>
<?php } ?>
<?php if ($property_valuation_roll_delete->NewImprovements->Visible) { // NewImprovements ?>
		<th class="<?php echo $property_valuation_roll_delete->NewImprovements->headerCellClass() ?>"><span id="elh_property_valuation_roll_NewImprovements" class="property_valuation_roll_NewImprovements"><?php echo $property_valuation_roll_delete->NewImprovements->caption() ?></span></th>
<?php } ?>
<?php if ($property_valuation_roll_delete->Longitude->Visible) { // Longitude ?>
		<th class="<?php echo $property_valuation_roll_delete->Longitude->headerCellClass() ?>"><span id="elh_property_valuation_roll_Longitude" class="property_valuation_roll_Longitude"><?php echo $property_valuation_roll_delete->Longitude->caption() ?></span></th>
<?php } ?>
<?php if ($property_valuation_roll_delete->Latitude->Visible) { // Latitude ?>
		<th class="<?php echo $property_valuation_roll_delete->Latitude->headerCellClass() ?>"><span id="elh_property_valuation_roll_Latitude" class="property_valuation_roll_Latitude"><?php echo $property_valuation_roll_delete->Latitude->caption() ?></span></th>
<?php } ?>
<?php if ($property_valuation_roll_delete->DateEvaluated->Visible) { // DateEvaluated ?>
		<th class="<?php echo $property_valuation_roll_delete->DateEvaluated->headerCellClass() ?>"><span id="elh_property_valuation_roll_DateEvaluated" class="property_valuation_roll_DateEvaluated"><?php echo $property_valuation_roll_delete->DateEvaluated->caption() ?></span></th>
<?php } ?>
<?php if ($property_valuation_roll_delete->DateEntered->Visible) { // DateEntered ?>
		<th class="<?php echo $property_valuation_roll_delete->DateEntered->headerCellClass() ?>"><span id="elh_property_valuation_roll_DateEntered" class="property_valuation_roll_DateEntered"><?php echo $property_valuation_roll_delete->DateEntered->caption() ?></span></th>
<?php } ?>
<?php if ($property_valuation_roll_delete->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<th class="<?php echo $property_valuation_roll_delete->LastUpdatedBy->headerCellClass() ?>"><span id="elh_property_valuation_roll_LastUpdatedBy" class="property_valuation_roll_LastUpdatedBy"><?php echo $property_valuation_roll_delete->LastUpdatedBy->caption() ?></span></th>
<?php } ?>
<?php if ($property_valuation_roll_delete->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<th class="<?php echo $property_valuation_roll_delete->LastUpdateDate->headerCellClass() ?>"><span id="elh_property_valuation_roll_LastUpdateDate" class="property_valuation_roll_LastUpdateDate"><?php echo $property_valuation_roll_delete->LastUpdateDate->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$property_valuation_roll_delete->RecordCount = 0;
$i = 0;
while (!$property_valuation_roll_delete->Recordset->EOF) {
	$property_valuation_roll_delete->RecordCount++;
	$property_valuation_roll_delete->RowCount++;

	// Set row properties
	$property_valuation_roll->resetAttributes();
	$property_valuation_roll->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$property_valuation_roll_delete->loadRowValues($property_valuation_roll_delete->Recordset);

	// Render row
	$property_valuation_roll_delete->renderRow();
?>
	<tr <?php echo $property_valuation_roll->rowAttributes() ?>>
<?php if ($property_valuation_roll_delete->ValuationNo->Visible) { // ValuationNo ?>
		<td <?php echo $property_valuation_roll_delete->ValuationNo->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_delete->RowCount ?>_property_valuation_roll_ValuationNo" class="property_valuation_roll_ValuationNo">
<span<?php echo $property_valuation_roll_delete->ValuationNo->viewAttributes() ?>><?php echo $property_valuation_roll_delete->ValuationNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_valuation_roll_delete->PropertyNo->Visible) { // PropertyNo ?>
		<td <?php echo $property_valuation_roll_delete->PropertyNo->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_delete->RowCount ?>_property_valuation_roll_PropertyNo" class="property_valuation_roll_PropertyNo">
<span<?php echo $property_valuation_roll_delete->PropertyNo->viewAttributes() ?>><?php echo $property_valuation_roll_delete->PropertyNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_valuation_roll_delete->StandNo->Visible) { // StandNo ?>
		<td <?php echo $property_valuation_roll_delete->StandNo->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_delete->RowCount ?>_property_valuation_roll_StandNo" class="property_valuation_roll_StandNo">
<span<?php echo $property_valuation_roll_delete->StandNo->viewAttributes() ?>><?php echo $property_valuation_roll_delete->StandNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_valuation_roll_delete->ClientID->Visible) { // ClientID ?>
		<td <?php echo $property_valuation_roll_delete->ClientID->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_delete->RowCount ?>_property_valuation_roll_ClientID" class="property_valuation_roll_ClientID">
<span<?php echo $property_valuation_roll_delete->ClientID->viewAttributes() ?>><?php echo $property_valuation_roll_delete->ClientID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_valuation_roll_delete->PropertyGroup->Visible) { // PropertyGroup ?>
		<td <?php echo $property_valuation_roll_delete->PropertyGroup->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_delete->RowCount ?>_property_valuation_roll_PropertyGroup" class="property_valuation_roll_PropertyGroup">
<span<?php echo $property_valuation_roll_delete->PropertyGroup->viewAttributes() ?>><?php echo $property_valuation_roll_delete->PropertyGroup->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_valuation_roll_delete->PropertyType->Visible) { // PropertyType ?>
		<td <?php echo $property_valuation_roll_delete->PropertyType->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_delete->RowCount ?>_property_valuation_roll_PropertyType" class="property_valuation_roll_PropertyType">
<span<?php echo $property_valuation_roll_delete->PropertyType->viewAttributes() ?>><?php echo $property_valuation_roll_delete->PropertyType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_valuation_roll_delete->Location->Visible) { // Location ?>
		<td <?php echo $property_valuation_roll_delete->Location->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_delete->RowCount ?>_property_valuation_roll_Location" class="property_valuation_roll_Location">
<span<?php echo $property_valuation_roll_delete->Location->viewAttributes() ?>><?php echo $property_valuation_roll_delete->Location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_valuation_roll_delete->RollStatus->Visible) { // RollStatus ?>
		<td <?php echo $property_valuation_roll_delete->RollStatus->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_delete->RowCount ?>_property_valuation_roll_RollStatus" class="property_valuation_roll_RollStatus">
<span<?php echo $property_valuation_roll_delete->RollStatus->viewAttributes() ?>><?php echo $property_valuation_roll_delete->RollStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_valuation_roll_delete->UseCode->Visible) { // UseCode ?>
		<td <?php echo $property_valuation_roll_delete->UseCode->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_delete->RowCount ?>_property_valuation_roll_UseCode" class="property_valuation_roll_UseCode">
<span<?php echo $property_valuation_roll_delete->UseCode->viewAttributes() ?>><?php echo $property_valuation_roll_delete->UseCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_valuation_roll_delete->AreaOfLand->Visible) { // AreaOfLand ?>
		<td <?php echo $property_valuation_roll_delete->AreaOfLand->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_delete->RowCount ?>_property_valuation_roll_AreaOfLand" class="property_valuation_roll_AreaOfLand">
<span<?php echo $property_valuation_roll_delete->AreaOfLand->viewAttributes() ?>><?php echo $property_valuation_roll_delete->AreaOfLand->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_valuation_roll_delete->AreaCode->Visible) { // AreaCode ?>
		<td <?php echo $property_valuation_roll_delete->AreaCode->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_delete->RowCount ?>_property_valuation_roll_AreaCode" class="property_valuation_roll_AreaCode">
<span<?php echo $property_valuation_roll_delete->AreaCode->viewAttributes() ?>><?php echo $property_valuation_roll_delete->AreaCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_valuation_roll_delete->SiteNumber->Visible) { // SiteNumber ?>
		<td <?php echo $property_valuation_roll_delete->SiteNumber->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_delete->RowCount ?>_property_valuation_roll_SiteNumber" class="property_valuation_roll_SiteNumber">
<span<?php echo $property_valuation_roll_delete->SiteNumber->viewAttributes() ?>><?php echo $property_valuation_roll_delete->SiteNumber->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_valuation_roll_delete->RateableValue->Visible) { // RateableValue ?>
		<td <?php echo $property_valuation_roll_delete->RateableValue->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_delete->RowCount ?>_property_valuation_roll_RateableValue" class="property_valuation_roll_RateableValue">
<span<?php echo $property_valuation_roll_delete->RateableValue->viewAttributes() ?>><?php echo $property_valuation_roll_delete->RateableValue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_valuation_roll_delete->NewRateableValue->Visible) { // NewRateableValue ?>
		<td <?php echo $property_valuation_roll_delete->NewRateableValue->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_delete->RowCount ?>_property_valuation_roll_NewRateableValue" class="property_valuation_roll_NewRateableValue">
<span<?php echo $property_valuation_roll_delete->NewRateableValue->viewAttributes() ?>><?php echo $property_valuation_roll_delete->NewRateableValue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_valuation_roll_delete->ExemptCode->Visible) { // ExemptCode ?>
		<td <?php echo $property_valuation_roll_delete->ExemptCode->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_delete->RowCount ?>_property_valuation_roll_ExemptCode" class="property_valuation_roll_ExemptCode">
<span<?php echo $property_valuation_roll_delete->ExemptCode->viewAttributes() ?>><?php echo $property_valuation_roll_delete->ExemptCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_valuation_roll_delete->Improvements->Visible) { // Improvements ?>
		<td <?php echo $property_valuation_roll_delete->Improvements->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_delete->RowCount ?>_property_valuation_roll_Improvements" class="property_valuation_roll_Improvements">
<span<?php echo $property_valuation_roll_delete->Improvements->viewAttributes() ?>><?php echo $property_valuation_roll_delete->Improvements->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_valuation_roll_delete->NewImprovements->Visible) { // NewImprovements ?>
		<td <?php echo $property_valuation_roll_delete->NewImprovements->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_delete->RowCount ?>_property_valuation_roll_NewImprovements" class="property_valuation_roll_NewImprovements">
<span<?php echo $property_valuation_roll_delete->NewImprovements->viewAttributes() ?>><?php echo $property_valuation_roll_delete->NewImprovements->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_valuation_roll_delete->Longitude->Visible) { // Longitude ?>
		<td <?php echo $property_valuation_roll_delete->Longitude->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_delete->RowCount ?>_property_valuation_roll_Longitude" class="property_valuation_roll_Longitude">
<span<?php echo $property_valuation_roll_delete->Longitude->viewAttributes() ?>><?php echo $property_valuation_roll_delete->Longitude->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_valuation_roll_delete->Latitude->Visible) { // Latitude ?>
		<td <?php echo $property_valuation_roll_delete->Latitude->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_delete->RowCount ?>_property_valuation_roll_Latitude" class="property_valuation_roll_Latitude">
<span<?php echo $property_valuation_roll_delete->Latitude->viewAttributes() ?>><?php echo $property_valuation_roll_delete->Latitude->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_valuation_roll_delete->DateEvaluated->Visible) { // DateEvaluated ?>
		<td <?php echo $property_valuation_roll_delete->DateEvaluated->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_delete->RowCount ?>_property_valuation_roll_DateEvaluated" class="property_valuation_roll_DateEvaluated">
<span<?php echo $property_valuation_roll_delete->DateEvaluated->viewAttributes() ?>><?php echo $property_valuation_roll_delete->DateEvaluated->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_valuation_roll_delete->DateEntered->Visible) { // DateEntered ?>
		<td <?php echo $property_valuation_roll_delete->DateEntered->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_delete->RowCount ?>_property_valuation_roll_DateEntered" class="property_valuation_roll_DateEntered">
<span<?php echo $property_valuation_roll_delete->DateEntered->viewAttributes() ?>><?php echo $property_valuation_roll_delete->DateEntered->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_valuation_roll_delete->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td <?php echo $property_valuation_roll_delete->LastUpdatedBy->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_delete->RowCount ?>_property_valuation_roll_LastUpdatedBy" class="property_valuation_roll_LastUpdatedBy">
<span<?php echo $property_valuation_roll_delete->LastUpdatedBy->viewAttributes() ?>><?php echo $property_valuation_roll_delete->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_valuation_roll_delete->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td <?php echo $property_valuation_roll_delete->LastUpdateDate->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_delete->RowCount ?>_property_valuation_roll_LastUpdateDate" class="property_valuation_roll_LastUpdateDate">
<span<?php echo $property_valuation_roll_delete->LastUpdateDate->viewAttributes() ?>><?php echo $property_valuation_roll_delete->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$property_valuation_roll_delete->Recordset->moveNext();
}
$property_valuation_roll_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_valuation_roll_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$property_valuation_roll_delete->showPageFooter();
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
$property_valuation_roll_delete->terminate();
?>