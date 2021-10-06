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
$property_view = new property_view();

// Run the page
$property_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$property_view->isExport()) { ?>
<script>
var fpropertyview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpropertyview = currentForm = new ew.Form("fpropertyview", "view");
	loadjs.done("fpropertyview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$property_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $property_view->ExportOptions->render("body") ?>
<?php $property_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $property_view->showPageHeader(); ?>
<?php
$property_view->showMessage();
?>
<?php if (!$property_view->IsModal) { ?>
<?php if (!$property_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fpropertyview" id="fpropertyview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property">
<input type="hidden" name="modal" value="<?php echo (int)$property_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($property_view->PropertyNo->Visible) { // PropertyNo ?>
	<tr id="r_PropertyNo">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_PropertyNo"><?php echo $property_view->PropertyNo->caption() ?></span></td>
		<td data-name="PropertyNo" <?php echo $property_view->PropertyNo->cellAttributes() ?>>
<span id="el_property_PropertyNo">
<span<?php echo $property_view->PropertyNo->viewAttributes() ?>><?php echo $property_view->PropertyNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->ClientSerNo->Visible) { // ClientSerNo ?>
	<tr id="r_ClientSerNo">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_ClientSerNo"><?php echo $property_view->ClientSerNo->caption() ?></span></td>
		<td data-name="ClientSerNo" <?php echo $property_view->ClientSerNo->cellAttributes() ?>>
<span id="el_property_ClientSerNo">
<span<?php echo $property_view->ClientSerNo->viewAttributes() ?>><?php echo $property_view->ClientSerNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->ClientID->Visible) { // ClientID ?>
	<tr id="r_ClientID">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_ClientID"><?php echo $property_view->ClientID->caption() ?></span></td>
		<td data-name="ClientID" <?php echo $property_view->ClientID->cellAttributes() ?>>
<span id="el_property_ClientID">
<span<?php echo $property_view->ClientID->viewAttributes() ?>><?php echo $property_view->ClientID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->PropertyGroup->Visible) { // PropertyGroup ?>
	<tr id="r_PropertyGroup">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_PropertyGroup"><?php echo $property_view->PropertyGroup->caption() ?></span></td>
		<td data-name="PropertyGroup" <?php echo $property_view->PropertyGroup->cellAttributes() ?>>
<span id="el_property_PropertyGroup">
<span<?php echo $property_view->PropertyGroup->viewAttributes() ?>><?php echo $property_view->PropertyGroup->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->PropertyType->Visible) { // PropertyType ?>
	<tr id="r_PropertyType">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_PropertyType"><?php echo $property_view->PropertyType->caption() ?></span></td>
		<td data-name="PropertyType" <?php echo $property_view->PropertyType->cellAttributes() ?>>
<span id="el_property_PropertyType">
<span<?php echo $property_view->PropertyType->viewAttributes() ?>><?php echo $property_view->PropertyType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->Location->Visible) { // Location ?>
	<tr id="r_Location">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_Location"><?php echo $property_view->Location->caption() ?></span></td>
		<td data-name="Location" <?php echo $property_view->Location->cellAttributes() ?>>
<span id="el_property_Location">
<span<?php echo $property_view->Location->viewAttributes() ?>><?php echo $property_view->Location->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->PropertyStatus->Visible) { // PropertyStatus ?>
	<tr id="r_PropertyStatus">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_PropertyStatus"><?php echo $property_view->PropertyStatus->caption() ?></span></td>
		<td data-name="PropertyStatus" <?php echo $property_view->PropertyStatus->cellAttributes() ?>>
<span id="el_property_PropertyStatus">
<span<?php echo $property_view->PropertyStatus->viewAttributes() ?>><?php echo $property_view->PropertyStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->PropertyUse->Visible) { // PropertyUse ?>
	<tr id="r_PropertyUse">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_PropertyUse"><?php echo $property_view->PropertyUse->caption() ?></span></td>
		<td data-name="PropertyUse" <?php echo $property_view->PropertyUse->cellAttributes() ?>>
<span id="el_property_PropertyUse">
<span<?php echo $property_view->PropertyUse->viewAttributes() ?>><?php echo $property_view->PropertyUse->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->LandExtentInHA->Visible) { // LandExtentInHA ?>
	<tr id="r_LandExtentInHA">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_LandExtentInHA"><?php echo $property_view->LandExtentInHA->caption() ?></span></td>
		<td data-name="LandExtentInHA" <?php echo $property_view->LandExtentInHA->cellAttributes() ?>>
<span id="el_property_LandExtentInHA">
<span<?php echo $property_view->LandExtentInHA->viewAttributes() ?>><?php echo $property_view->LandExtentInHA->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->RateableValue->Visible) { // RateableValue ?>
	<tr id="r_RateableValue">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_RateableValue"><?php echo $property_view->RateableValue->caption() ?></span></td>
		<td data-name="RateableValue" <?php echo $property_view->RateableValue->cellAttributes() ?>>
<span id="el_property_RateableValue">
<span<?php echo $property_view->RateableValue->viewAttributes() ?>><?php echo $property_view->RateableValue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->SupplementaryValue->Visible) { // SupplementaryValue ?>
	<tr id="r_SupplementaryValue">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_SupplementaryValue"><?php echo $property_view->SupplementaryValue->caption() ?></span></td>
		<td data-name="SupplementaryValue" <?php echo $property_view->SupplementaryValue->cellAttributes() ?>>
<span id="el_property_SupplementaryValue">
<span<?php echo $property_view->SupplementaryValue->viewAttributes() ?>><?php echo $property_view->SupplementaryValue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->ExemptCode->Visible) { // ExemptCode ?>
	<tr id="r_ExemptCode">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_ExemptCode"><?php echo $property_view->ExemptCode->caption() ?></span></td>
		<td data-name="ExemptCode" <?php echo $property_view->ExemptCode->cellAttributes() ?>>
<span id="el_property_ExemptCode">
<span<?php echo $property_view->ExemptCode->viewAttributes() ?>><?php echo $property_view->ExemptCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->Improvements->Visible) { // Improvements ?>
	<tr id="r_Improvements">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_Improvements"><?php echo $property_view->Improvements->caption() ?></span></td>
		<td data-name="Improvements" <?php echo $property_view->Improvements->cellAttributes() ?>>
<span id="el_property_Improvements">
<span<?php echo $property_view->Improvements->viewAttributes() ?>><?php echo $property_view->Improvements->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->StreetAddress->Visible) { // StreetAddress ?>
	<tr id="r_StreetAddress">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_StreetAddress"><?php echo $property_view->StreetAddress->caption() ?></span></td>
		<td data-name="StreetAddress" <?php echo $property_view->StreetAddress->cellAttributes() ?>>
<span id="el_property_StreetAddress">
<span<?php echo $property_view->StreetAddress->viewAttributes() ?>><?php echo $property_view->StreetAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->Longitude->Visible) { // Longitude ?>
	<tr id="r_Longitude">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_Longitude"><?php echo $property_view->Longitude->caption() ?></span></td>
		<td data-name="Longitude" <?php echo $property_view->Longitude->cellAttributes() ?>>
<span id="el_property_Longitude">
<span<?php echo $property_view->Longitude->viewAttributes() ?>><?php echo $property_view->Longitude->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->Latitude->Visible) { // Latitude ?>
	<tr id="r_Latitude">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_Latitude"><?php echo $property_view->Latitude->caption() ?></span></td>
		<td data-name="Latitude" <?php echo $property_view->Latitude->cellAttributes() ?>>
<span id="el_property_Latitude">
<span<?php echo $property_view->Latitude->viewAttributes() ?>><?php echo $property_view->Latitude->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->Incumberance->Visible) { // Incumberance ?>
	<tr id="r_Incumberance">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_Incumberance"><?php echo $property_view->Incumberance->caption() ?></span></td>
		<td data-name="Incumberance" <?php echo $property_view->Incumberance->cellAttributes() ?>>
<span id="el_property_Incumberance">
<span<?php echo $property_view->Incumberance->viewAttributes() ?>><?php echo $property_view->Incumberance->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->SubDivisionOf->Visible) { // SubDivisionOf ?>
	<tr id="r_SubDivisionOf">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_SubDivisionOf"><?php echo $property_view->SubDivisionOf->caption() ?></span></td>
		<td data-name="SubDivisionOf" <?php echo $property_view->SubDivisionOf->cellAttributes() ?>>
<span id="el_property_SubDivisionOf">
<span<?php echo $property_view->SubDivisionOf->viewAttributes() ?>><?php echo $property_view->SubDivisionOf->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<tr id="r_LastUpdatedBy">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_LastUpdatedBy"><?php echo $property_view->LastUpdatedBy->caption() ?></span></td>
		<td data-name="LastUpdatedBy" <?php echo $property_view->LastUpdatedBy->cellAttributes() ?>>
<span id="el_property_LastUpdatedBy">
<span<?php echo $property_view->LastUpdatedBy->viewAttributes() ?>><?php echo $property_view->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<tr id="r_LastUpdateDate">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_LastUpdateDate"><?php echo $property_view->LastUpdateDate->caption() ?></span></td>
		<td data-name="LastUpdateDate" <?php echo $property_view->LastUpdateDate->cellAttributes() ?>>
<span id="el_property_LastUpdateDate">
<span<?php echo $property_view->LastUpdateDate->viewAttributes() ?>><?php echo $property_view->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->ValuationNo->Visible) { // ValuationNo ?>
	<tr id="r_ValuationNo">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_ValuationNo"><?php echo $property_view->ValuationNo->caption() ?></span></td>
		<td data-name="ValuationNo" <?php echo $property_view->ValuationNo->cellAttributes() ?>>
<span id="el_property_ValuationNo">
<span<?php echo $property_view->ValuationNo->viewAttributes() ?>><?php echo $property_view->ValuationNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->LandValue->Visible) { // LandValue ?>
	<tr id="r_LandValue">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_LandValue"><?php echo $property_view->LandValue->caption() ?></span></td>
		<td data-name="LandValue" <?php echo $property_view->LandValue->cellAttributes() ?>>
<span id="el_property_LandValue">
<span<?php echo $property_view->LandValue->viewAttributes() ?>><?php echo $property_view->LandValue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->ImprovementsValue->Visible) { // ImprovementsValue ?>
	<tr id="r_ImprovementsValue">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_ImprovementsValue"><?php echo $property_view->ImprovementsValue->caption() ?></span></td>
		<td data-name="ImprovementsValue" <?php echo $property_view->ImprovementsValue->cellAttributes() ?>>
<span id="el_property_ImprovementsValue">
<span<?php echo $property_view->ImprovementsValue->viewAttributes() ?>><?php echo $property_view->ImprovementsValue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$property_view->IsModal) { ?>
<?php if (!$property_view->isExport()) { ?>
<?php echo $property_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$property_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$property_view->isExport()) { ?>
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
$property_view->terminate();
?>