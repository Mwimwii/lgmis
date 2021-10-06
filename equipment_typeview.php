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
$equipment_type_view = new equipment_type_view();

// Run the page
$equipment_type_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$equipment_type_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$equipment_type_view->isExport()) { ?>
<script>
var fequipment_typeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fequipment_typeview = currentForm = new ew.Form("fequipment_typeview", "view");
	loadjs.done("fequipment_typeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$equipment_type_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $equipment_type_view->ExportOptions->render("body") ?>
<?php $equipment_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $equipment_type_view->showPageHeader(); ?>
<?php
$equipment_type_view->showMessage();
?>
<?php if (!$equipment_type_view->IsModal) { ?>
<?php if (!$equipment_type_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $equipment_type_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fequipment_typeview" id="fequipment_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="equipment_type">
<input type="hidden" name="modal" value="<?php echo (int)$equipment_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($equipment_type_view->EquipmentType->Visible) { // EquipmentType ?>
	<tr id="r_EquipmentType">
		<td class="<?php echo $equipment_type_view->TableLeftColumnClass ?>"><span id="elh_equipment_type_EquipmentType"><?php echo $equipment_type_view->EquipmentType->caption() ?></span></td>
		<td data-name="EquipmentType" <?php echo $equipment_type_view->EquipmentType->cellAttributes() ?>>
<span id="el_equipment_type_EquipmentType">
<span<?php echo $equipment_type_view->EquipmentType->viewAttributes() ?>><?php echo $equipment_type_view->EquipmentType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($equipment_type_view->EquipmentName->Visible) { // EquipmentName ?>
	<tr id="r_EquipmentName">
		<td class="<?php echo $equipment_type_view->TableLeftColumnClass ?>"><span id="elh_equipment_type_EquipmentName"><?php echo $equipment_type_view->EquipmentName->caption() ?></span></td>
		<td data-name="EquipmentName" <?php echo $equipment_type_view->EquipmentName->cellAttributes() ?>>
<span id="el_equipment_type_EquipmentName">
<span<?php echo $equipment_type_view->EquipmentName->viewAttributes() ?>><?php echo $equipment_type_view->EquipmentName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($equipment_type_view->EquipmentDesc->Visible) { // EquipmentDesc ?>
	<tr id="r_EquipmentDesc">
		<td class="<?php echo $equipment_type_view->TableLeftColumnClass ?>"><span id="elh_equipment_type_EquipmentDesc"><?php echo $equipment_type_view->EquipmentDesc->caption() ?></span></td>
		<td data-name="EquipmentDesc" <?php echo $equipment_type_view->EquipmentDesc->cellAttributes() ?>>
<span id="el_equipment_type_EquipmentDesc">
<span<?php echo $equipment_type_view->EquipmentDesc->viewAttributes() ?>><?php echo $equipment_type_view->EquipmentDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$equipment_type_view->IsModal) { ?>
<?php if (!$equipment_type_view->isExport()) { ?>
<?php echo $equipment_type_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$equipment_type_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$equipment_type_view->isExport()) { ?>
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
$equipment_type_view->terminate();
?>