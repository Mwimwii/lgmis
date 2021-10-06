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
$property_zone_view = new property_zone_view();

// Run the page
$property_zone_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_zone_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$property_zone_view->isExport()) { ?>
<script>
var fproperty_zoneview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fproperty_zoneview = currentForm = new ew.Form("fproperty_zoneview", "view");
	loadjs.done("fproperty_zoneview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$property_zone_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $property_zone_view->ExportOptions->render("body") ?>
<?php $property_zone_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $property_zone_view->showPageHeader(); ?>
<?php
$property_zone_view->showMessage();
?>
<?php if (!$property_zone_view->IsModal) { ?>
<?php if (!$property_zone_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_zone_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fproperty_zoneview" id="fproperty_zoneview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_zone">
<input type="hidden" name="modal" value="<?php echo (int)$property_zone_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($property_zone_view->AreaCode->Visible) { // AreaCode ?>
	<tr id="r_AreaCode">
		<td class="<?php echo $property_zone_view->TableLeftColumnClass ?>"><span id="elh_property_zone_AreaCode"><?php echo $property_zone_view->AreaCode->caption() ?></span></td>
		<td data-name="AreaCode" <?php echo $property_zone_view->AreaCode->cellAttributes() ?>>
<span id="el_property_zone_AreaCode">
<span<?php echo $property_zone_view->AreaCode->viewAttributes() ?>><?php echo $property_zone_view->AreaCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_zone_view->AreaName->Visible) { // AreaName ?>
	<tr id="r_AreaName">
		<td class="<?php echo $property_zone_view->TableLeftColumnClass ?>"><span id="elh_property_zone_AreaName"><?php echo $property_zone_view->AreaName->caption() ?></span></td>
		<td data-name="AreaName" <?php echo $property_zone_view->AreaName->cellAttributes() ?>>
<span id="el_property_zone_AreaName">
<span<?php echo $property_zone_view->AreaName->viewAttributes() ?>><?php echo $property_zone_view->AreaName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_zone_view->AreaType->Visible) { // AreaType ?>
	<tr id="r_AreaType">
		<td class="<?php echo $property_zone_view->TableLeftColumnClass ?>"><span id="elh_property_zone_AreaType"><?php echo $property_zone_view->AreaType->caption() ?></span></td>
		<td data-name="AreaType" <?php echo $property_zone_view->AreaType->cellAttributes() ?>>
<span id="el_property_zone_AreaType">
<span<?php echo $property_zone_view->AreaType->viewAttributes() ?>><?php echo $property_zone_view->AreaType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_zone_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $property_zone_view->TableLeftColumnClass ?>"><span id="elh_property_zone_LACode"><?php echo $property_zone_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $property_zone_view->LACode->cellAttributes() ?>>
<span id="el_property_zone_LACode">
<span<?php echo $property_zone_view->LACode->viewAttributes() ?>><?php echo $property_zone_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$property_zone_view->IsModal) { ?>
<?php if (!$property_zone_view->isExport()) { ?>
<?php echo $property_zone_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$property_zone_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$property_zone_view->isExport()) { ?>
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
$property_zone_view->terminate();
?>