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
$property_valuation_roll_view = new property_valuation_roll_view();

// Run the page
$property_valuation_roll_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_valuation_roll_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$property_valuation_roll_view->isExport()) { ?>
<script>
var fproperty_valuation_rollview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fproperty_valuation_rollview = currentForm = new ew.Form("fproperty_valuation_rollview", "view");
	loadjs.done("fproperty_valuation_rollview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$property_valuation_roll_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $property_valuation_roll_view->ExportOptions->render("body") ?>
<?php $property_valuation_roll_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $property_valuation_roll_view->showPageHeader(); ?>
<?php
$property_valuation_roll_view->showMessage();
?>
<?php if (!$property_valuation_roll_view->IsModal) { ?>
<?php if (!$property_valuation_roll_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_valuation_roll_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fproperty_valuation_rollview" id="fproperty_valuation_rollview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_valuation_roll">
<input type="hidden" name="modal" value="<?php echo (int)$property_valuation_roll_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($property_valuation_roll_view->ValuationNo->Visible) { // ValuationNo ?>
	<tr id="r_ValuationNo">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_ValuationNo"><?php echo $property_valuation_roll_view->ValuationNo->caption() ?></span></td>
		<td data-name="ValuationNo" <?php echo $property_valuation_roll_view->ValuationNo->cellAttributes() ?>>
<span id="el_property_valuation_roll_ValuationNo">
<span<?php echo $property_valuation_roll_view->ValuationNo->viewAttributes() ?>><?php echo $property_valuation_roll_view->ValuationNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_valuation_roll_view->PropertyNo->Visible) { // PropertyNo ?>
	<tr id="r_PropertyNo">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_PropertyNo"><?php echo $property_valuation_roll_view->PropertyNo->caption() ?></span></td>
		<td data-name="PropertyNo" <?php echo $property_valuation_roll_view->PropertyNo->cellAttributes() ?>>
<span id="el_property_valuation_roll_PropertyNo">
<span<?php echo $property_valuation_roll_view->PropertyNo->viewAttributes() ?>><?php echo $property_valuation_roll_view->PropertyNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_valuation_roll_view->StandNo->Visible) { // StandNo ?>
	<tr id="r_StandNo">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_StandNo"><?php echo $property_valuation_roll_view->StandNo->caption() ?></span></td>
		<td data-name="StandNo" <?php echo $property_valuation_roll_view->StandNo->cellAttributes() ?>>
<span id="el_property_valuation_roll_StandNo">
<span<?php echo $property_valuation_roll_view->StandNo->viewAttributes() ?>><?php echo $property_valuation_roll_view->StandNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_valuation_roll_view->ClientID->Visible) { // ClientID ?>
	<tr id="r_ClientID">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_ClientID"><?php echo $property_valuation_roll_view->ClientID->caption() ?></span></td>
		<td data-name="ClientID" <?php echo $property_valuation_roll_view->ClientID->cellAttributes() ?>>
<span id="el_property_valuation_roll_ClientID">
<span<?php echo $property_valuation_roll_view->ClientID->viewAttributes() ?>><?php echo $property_valuation_roll_view->ClientID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_valuation_roll_view->PropertyGroup->Visible) { // PropertyGroup ?>
	<tr id="r_PropertyGroup">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_PropertyGroup"><?php echo $property_valuation_roll_view->PropertyGroup->caption() ?></span></td>
		<td data-name="PropertyGroup" <?php echo $property_valuation_roll_view->PropertyGroup->cellAttributes() ?>>
<span id="el_property_valuation_roll_PropertyGroup">
<span<?php echo $property_valuation_roll_view->PropertyGroup->viewAttributes() ?>><?php echo $property_valuation_roll_view->PropertyGroup->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_valuation_roll_view->PropertyType->Visible) { // PropertyType ?>
	<tr id="r_PropertyType">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_PropertyType"><?php echo $property_valuation_roll_view->PropertyType->caption() ?></span></td>
		<td data-name="PropertyType" <?php echo $property_valuation_roll_view->PropertyType->cellAttributes() ?>>
<span id="el_property_valuation_roll_PropertyType">
<span<?php echo $property_valuation_roll_view->PropertyType->viewAttributes() ?>><?php echo $property_valuation_roll_view->PropertyType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_valuation_roll_view->Location->Visible) { // Location ?>
	<tr id="r_Location">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_Location"><?php echo $property_valuation_roll_view->Location->caption() ?></span></td>
		<td data-name="Location" <?php echo $property_valuation_roll_view->Location->cellAttributes() ?>>
<span id="el_property_valuation_roll_Location">
<span<?php echo $property_valuation_roll_view->Location->viewAttributes() ?>><?php echo $property_valuation_roll_view->Location->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_valuation_roll_view->RollStatus->Visible) { // RollStatus ?>
	<tr id="r_RollStatus">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_RollStatus"><?php echo $property_valuation_roll_view->RollStatus->caption() ?></span></td>
		<td data-name="RollStatus" <?php echo $property_valuation_roll_view->RollStatus->cellAttributes() ?>>
<span id="el_property_valuation_roll_RollStatus">
<span<?php echo $property_valuation_roll_view->RollStatus->viewAttributes() ?>><?php echo $property_valuation_roll_view->RollStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_valuation_roll_view->UseCode->Visible) { // UseCode ?>
	<tr id="r_UseCode">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_UseCode"><?php echo $property_valuation_roll_view->UseCode->caption() ?></span></td>
		<td data-name="UseCode" <?php echo $property_valuation_roll_view->UseCode->cellAttributes() ?>>
<span id="el_property_valuation_roll_UseCode">
<span<?php echo $property_valuation_roll_view->UseCode->viewAttributes() ?>><?php echo $property_valuation_roll_view->UseCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_valuation_roll_view->AreaOfLand->Visible) { // AreaOfLand ?>
	<tr id="r_AreaOfLand">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_AreaOfLand"><?php echo $property_valuation_roll_view->AreaOfLand->caption() ?></span></td>
		<td data-name="AreaOfLand" <?php echo $property_valuation_roll_view->AreaOfLand->cellAttributes() ?>>
<span id="el_property_valuation_roll_AreaOfLand">
<span<?php echo $property_valuation_roll_view->AreaOfLand->viewAttributes() ?>><?php echo $property_valuation_roll_view->AreaOfLand->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_valuation_roll_view->AreaCode->Visible) { // AreaCode ?>
	<tr id="r_AreaCode">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_AreaCode"><?php echo $property_valuation_roll_view->AreaCode->caption() ?></span></td>
		<td data-name="AreaCode" <?php echo $property_valuation_roll_view->AreaCode->cellAttributes() ?>>
<span id="el_property_valuation_roll_AreaCode">
<span<?php echo $property_valuation_roll_view->AreaCode->viewAttributes() ?>><?php echo $property_valuation_roll_view->AreaCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_valuation_roll_view->SiteNumber->Visible) { // SiteNumber ?>
	<tr id="r_SiteNumber">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_SiteNumber"><?php echo $property_valuation_roll_view->SiteNumber->caption() ?></span></td>
		<td data-name="SiteNumber" <?php echo $property_valuation_roll_view->SiteNumber->cellAttributes() ?>>
<span id="el_property_valuation_roll_SiteNumber">
<span<?php echo $property_valuation_roll_view->SiteNumber->viewAttributes() ?>><?php echo $property_valuation_roll_view->SiteNumber->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_valuation_roll_view->RateableValue->Visible) { // RateableValue ?>
	<tr id="r_RateableValue">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_RateableValue"><?php echo $property_valuation_roll_view->RateableValue->caption() ?></span></td>
		<td data-name="RateableValue" <?php echo $property_valuation_roll_view->RateableValue->cellAttributes() ?>>
<span id="el_property_valuation_roll_RateableValue">
<span<?php echo $property_valuation_roll_view->RateableValue->viewAttributes() ?>><?php echo $property_valuation_roll_view->RateableValue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_valuation_roll_view->NewRateableValue->Visible) { // NewRateableValue ?>
	<tr id="r_NewRateableValue">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_NewRateableValue"><?php echo $property_valuation_roll_view->NewRateableValue->caption() ?></span></td>
		<td data-name="NewRateableValue" <?php echo $property_valuation_roll_view->NewRateableValue->cellAttributes() ?>>
<span id="el_property_valuation_roll_NewRateableValue">
<span<?php echo $property_valuation_roll_view->NewRateableValue->viewAttributes() ?>><?php echo $property_valuation_roll_view->NewRateableValue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_valuation_roll_view->ExemptCode->Visible) { // ExemptCode ?>
	<tr id="r_ExemptCode">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_ExemptCode"><?php echo $property_valuation_roll_view->ExemptCode->caption() ?></span></td>
		<td data-name="ExemptCode" <?php echo $property_valuation_roll_view->ExemptCode->cellAttributes() ?>>
<span id="el_property_valuation_roll_ExemptCode">
<span<?php echo $property_valuation_roll_view->ExemptCode->viewAttributes() ?>><?php echo $property_valuation_roll_view->ExemptCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_valuation_roll_view->Improvements->Visible) { // Improvements ?>
	<tr id="r_Improvements">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_Improvements"><?php echo $property_valuation_roll_view->Improvements->caption() ?></span></td>
		<td data-name="Improvements" <?php echo $property_valuation_roll_view->Improvements->cellAttributes() ?>>
<span id="el_property_valuation_roll_Improvements">
<span<?php echo $property_valuation_roll_view->Improvements->viewAttributes() ?>><?php echo $property_valuation_roll_view->Improvements->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_valuation_roll_view->NewImprovements->Visible) { // NewImprovements ?>
	<tr id="r_NewImprovements">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_NewImprovements"><?php echo $property_valuation_roll_view->NewImprovements->caption() ?></span></td>
		<td data-name="NewImprovements" <?php echo $property_valuation_roll_view->NewImprovements->cellAttributes() ?>>
<span id="el_property_valuation_roll_NewImprovements">
<span<?php echo $property_valuation_roll_view->NewImprovements->viewAttributes() ?>><?php echo $property_valuation_roll_view->NewImprovements->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_valuation_roll_view->Longitude->Visible) { // Longitude ?>
	<tr id="r_Longitude">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_Longitude"><?php echo $property_valuation_roll_view->Longitude->caption() ?></span></td>
		<td data-name="Longitude" <?php echo $property_valuation_roll_view->Longitude->cellAttributes() ?>>
<span id="el_property_valuation_roll_Longitude">
<span<?php echo $property_valuation_roll_view->Longitude->viewAttributes() ?>><?php echo $property_valuation_roll_view->Longitude->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_valuation_roll_view->Latitude->Visible) { // Latitude ?>
	<tr id="r_Latitude">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_Latitude"><?php echo $property_valuation_roll_view->Latitude->caption() ?></span></td>
		<td data-name="Latitude" <?php echo $property_valuation_roll_view->Latitude->cellAttributes() ?>>
<span id="el_property_valuation_roll_Latitude">
<span<?php echo $property_valuation_roll_view->Latitude->viewAttributes() ?>><?php echo $property_valuation_roll_view->Latitude->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_valuation_roll_view->PropertyPhoto->Visible) { // PropertyPhoto ?>
	<tr id="r_PropertyPhoto">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_PropertyPhoto"><?php echo $property_valuation_roll_view->PropertyPhoto->caption() ?></span></td>
		<td data-name="PropertyPhoto" <?php echo $property_valuation_roll_view->PropertyPhoto->cellAttributes() ?>>
<span id="el_property_valuation_roll_PropertyPhoto">
<span<?php echo $property_valuation_roll_view->PropertyPhoto->viewAttributes() ?>><?php echo GetFileViewTag($property_valuation_roll_view->PropertyPhoto, $property_valuation_roll_view->PropertyPhoto->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_valuation_roll_view->DateEvaluated->Visible) { // DateEvaluated ?>
	<tr id="r_DateEvaluated">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_DateEvaluated"><?php echo $property_valuation_roll_view->DateEvaluated->caption() ?></span></td>
		<td data-name="DateEvaluated" <?php echo $property_valuation_roll_view->DateEvaluated->cellAttributes() ?>>
<span id="el_property_valuation_roll_DateEvaluated">
<span<?php echo $property_valuation_roll_view->DateEvaluated->viewAttributes() ?>><?php echo $property_valuation_roll_view->DateEvaluated->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_valuation_roll_view->Objections->Visible) { // Objections ?>
	<tr id="r_Objections">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_Objections"><?php echo $property_valuation_roll_view->Objections->caption() ?></span></td>
		<td data-name="Objections" <?php echo $property_valuation_roll_view->Objections->cellAttributes() ?>>
<span id="el_property_valuation_roll_Objections">
<span<?php echo $property_valuation_roll_view->Objections->viewAttributes() ?>><?php echo $property_valuation_roll_view->Objections->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_valuation_roll_view->DateEntered->Visible) { // DateEntered ?>
	<tr id="r_DateEntered">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_DateEntered"><?php echo $property_valuation_roll_view->DateEntered->caption() ?></span></td>
		<td data-name="DateEntered" <?php echo $property_valuation_roll_view->DateEntered->cellAttributes() ?>>
<span id="el_property_valuation_roll_DateEntered">
<span<?php echo $property_valuation_roll_view->DateEntered->viewAttributes() ?>><?php echo $property_valuation_roll_view->DateEntered->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_valuation_roll_view->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<tr id="r_LastUpdatedBy">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_LastUpdatedBy"><?php echo $property_valuation_roll_view->LastUpdatedBy->caption() ?></span></td>
		<td data-name="LastUpdatedBy" <?php echo $property_valuation_roll_view->LastUpdatedBy->cellAttributes() ?>>
<span id="el_property_valuation_roll_LastUpdatedBy">
<span<?php echo $property_valuation_roll_view->LastUpdatedBy->viewAttributes() ?>><?php echo $property_valuation_roll_view->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_valuation_roll_view->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<tr id="r_LastUpdateDate">
		<td class="<?php echo $property_valuation_roll_view->TableLeftColumnClass ?>"><span id="elh_property_valuation_roll_LastUpdateDate"><?php echo $property_valuation_roll_view->LastUpdateDate->caption() ?></span></td>
		<td data-name="LastUpdateDate" <?php echo $property_valuation_roll_view->LastUpdateDate->cellAttributes() ?>>
<span id="el_property_valuation_roll_LastUpdateDate">
<span<?php echo $property_valuation_roll_view->LastUpdateDate->viewAttributes() ?>><?php echo $property_valuation_roll_view->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$property_valuation_roll_view->IsModal) { ?>
<?php if (!$property_valuation_roll_view->isExport()) { ?>
<?php echo $property_valuation_roll_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$property_valuation_roll_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$property_valuation_roll_view->isExport()) { ?>
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
$property_valuation_roll_view->terminate();
?>