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
$business_view = new business_view();

// Run the page
$business_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$business_view->isExport()) { ?>
<script>
var fbusinessview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fbusinessview = currentForm = new ew.Form("fbusinessview", "view");
	loadjs.done("fbusinessview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$business_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $business_view->ExportOptions->render("body") ?>
<?php $business_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $business_view->showPageHeader(); ?>
<?php
$business_view->showMessage();
?>
<?php if (!$business_view->IsModal) { ?>
<?php if (!$business_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $business_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fbusinessview" id="fbusinessview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business">
<input type="hidden" name="modal" value="<?php echo (int)$business_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($business_view->BusinessID->Visible) { // BusinessID ?>
	<tr id="r_BusinessID">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_BusinessID"><?php echo $business_view->BusinessID->caption() ?></span></td>
		<td data-name="BusinessID" <?php echo $business_view->BusinessID->cellAttributes() ?>>
<span id="el_business_BusinessID">
<span<?php echo $business_view->BusinessID->viewAttributes() ?>><?php echo $business_view->BusinessID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->PACRANo->Visible) { // PACRANo ?>
	<tr id="r_PACRANo">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_PACRANo"><?php echo $business_view->PACRANo->caption() ?></span></td>
		<td data-name="PACRANo" <?php echo $business_view->PACRANo->cellAttributes() ?>>
<span id="el_business_PACRANo">
<span<?php echo $business_view->PACRANo->viewAttributes() ?>><?php echo $business_view->PACRANo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->TPIN->Visible) { // TPIN ?>
	<tr id="r_TPIN">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_TPIN"><?php echo $business_view->TPIN->caption() ?></span></td>
		<td data-name="TPIN" <?php echo $business_view->TPIN->cellAttributes() ?>>
<span id="el_business_TPIN">
<span<?php echo $business_view->TPIN->viewAttributes() ?>><?php echo $business_view->TPIN->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->BusinessName->Visible) { // BusinessName ?>
	<tr id="r_BusinessName">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_BusinessName"><?php echo $business_view->BusinessName->caption() ?></span></td>
		<td data-name="BusinessName" <?php echo $business_view->BusinessName->cellAttributes() ?>>
<span id="el_business_BusinessName">
<span<?php echo $business_view->BusinessName->viewAttributes() ?>><?php echo $business_view->BusinessName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->ClientID->Visible) { // ClientID ?>
	<tr id="r_ClientID">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_ClientID"><?php echo $business_view->ClientID->caption() ?></span></td>
		<td data-name="ClientID" <?php echo $business_view->ClientID->cellAttributes() ?>>
<span id="el_business_ClientID">
<span<?php echo $business_view->ClientID->viewAttributes() ?>><?php echo $business_view->ClientID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->BusinessSector->Visible) { // BusinessSector ?>
	<tr id="r_BusinessSector">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_BusinessSector"><?php echo $business_view->BusinessSector->caption() ?></span></td>
		<td data-name="BusinessSector" <?php echo $business_view->BusinessSector->cellAttributes() ?>>
<span id="el_business_BusinessSector">
<span<?php echo $business_view->BusinessSector->viewAttributes() ?>><?php echo $business_view->BusinessSector->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->BusinessType->Visible) { // BusinessType ?>
	<tr id="r_BusinessType">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_BusinessType"><?php echo $business_view->BusinessType->caption() ?></span></td>
		<td data-name="BusinessType" <?php echo $business_view->BusinessType->cellAttributes() ?>>
<span id="el_business_BusinessType">
<span<?php echo $business_view->BusinessType->viewAttributes() ?>><?php echo $business_view->BusinessType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->Location->Visible) { // Location ?>
	<tr id="r_Location">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_Location"><?php echo $business_view->Location->caption() ?></span></td>
		<td data-name="Location" <?php echo $business_view->Location->cellAttributes() ?>>
<span id="el_business_Location">
<span<?php echo $business_view->Location->viewAttributes() ?>><?php echo $business_view->Location->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->Turnover->Visible) { // Turnover ?>
	<tr id="r_Turnover">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_Turnover"><?php echo $business_view->Turnover->caption() ?></span></td>
		<td data-name="Turnover" <?php echo $business_view->Turnover->cellAttributes() ?>>
<span id="el_business_Turnover">
<span<?php echo $business_view->Turnover->viewAttributes() ?>><?php echo $business_view->Turnover->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->Branches->Visible) { // Branches ?>
	<tr id="r_Branches">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_Branches"><?php echo $business_view->Branches->caption() ?></span></td>
		<td data-name="Branches" <?php echo $business_view->Branches->cellAttributes() ?>>
<span id="el_business_Branches">
<span<?php echo $business_view->Branches->viewAttributes() ?>><?php echo $business_view->Branches->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->NewImprovements->Visible) { // NewImprovements ?>
	<tr id="r_NewImprovements">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_NewImprovements"><?php echo $business_view->NewImprovements->caption() ?></span></td>
		<td data-name="NewImprovements" <?php echo $business_view->NewImprovements->cellAttributes() ?>>
<span id="el_business_NewImprovements">
<span<?php echo $business_view->NewImprovements->viewAttributes() ?>><?php echo $business_view->NewImprovements->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->Longitude->Visible) { // Longitude ?>
	<tr id="r_Longitude">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_Longitude"><?php echo $business_view->Longitude->caption() ?></span></td>
		<td data-name="Longitude" <?php echo $business_view->Longitude->cellAttributes() ?>>
<span id="el_business_Longitude">
<span<?php echo $business_view->Longitude->viewAttributes() ?>><?php echo $business_view->Longitude->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->Latitude->Visible) { // Latitude ?>
	<tr id="r_Latitude">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_Latitude"><?php echo $business_view->Latitude->caption() ?></span></td>
		<td data-name="Latitude" <?php echo $business_view->Latitude->cellAttributes() ?>>
<span id="el_business_Latitude">
<span<?php echo $business_view->Latitude->viewAttributes() ?>><?php echo $business_view->Latitude->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->DateOpened->Visible) { // DateOpened ?>
	<tr id="r_DateOpened">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_DateOpened"><?php echo $business_view->DateOpened->caption() ?></span></td>
		<td data-name="DateOpened" <?php echo $business_view->DateOpened->cellAttributes() ?>>
<span id="el_business_DateOpened">
<span<?php echo $business_view->DateOpened->viewAttributes() ?>><?php echo $business_view->DateOpened->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->BusinessDesc->Visible) { // BusinessDesc ?>
	<tr id="r_BusinessDesc">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_BusinessDesc"><?php echo $business_view->BusinessDesc->caption() ?></span></td>
		<td data-name="BusinessDesc" <?php echo $business_view->BusinessDesc->cellAttributes() ?>>
<span id="el_business_BusinessDesc">
<span<?php echo $business_view->BusinessDesc->viewAttributes() ?>><?php echo $business_view->BusinessDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<tr id="r_LastUpdatedBy">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_LastUpdatedBy"><?php echo $business_view->LastUpdatedBy->caption() ?></span></td>
		<td data-name="LastUpdatedBy" <?php echo $business_view->LastUpdatedBy->cellAttributes() ?>>
<span id="el_business_LastUpdatedBy">
<span<?php echo $business_view->LastUpdatedBy->viewAttributes() ?>><?php echo $business_view->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_view->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<tr id="r_LastUpdateDate">
		<td class="<?php echo $business_view->TableLeftColumnClass ?>"><span id="elh_business_LastUpdateDate"><?php echo $business_view->LastUpdateDate->caption() ?></span></td>
		<td data-name="LastUpdateDate" <?php echo $business_view->LastUpdateDate->cellAttributes() ?>>
<span id="el_business_LastUpdateDate">
<span<?php echo $business_view->LastUpdateDate->viewAttributes() ?>><?php echo $business_view->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$business_view->IsModal) { ?>
<?php if (!$business_view->isExport()) { ?>
<?php echo $business_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("licence_account", explode(",", $business->getCurrentDetailTable())) && $licence_account->DetailView) {
?>
<?php if ($business->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("licence_account", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "licence_accountgrid.php" ?>
<?php } ?>
</form>
<?php
$business_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$business_view->isExport()) { ?>
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
$business_view->terminate();
?>