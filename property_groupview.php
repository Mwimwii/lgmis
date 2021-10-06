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
$property_group_view = new property_group_view();

// Run the page
$property_group_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_group_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$property_group_view->isExport()) { ?>
<script>
var fproperty_groupview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fproperty_groupview = currentForm = new ew.Form("fproperty_groupview", "view");
	loadjs.done("fproperty_groupview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$property_group_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $property_group_view->ExportOptions->render("body") ?>
<?php $property_group_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $property_group_view->showPageHeader(); ?>
<?php
$property_group_view->showMessage();
?>
<?php if (!$property_group_view->IsModal) { ?>
<?php if (!$property_group_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_group_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fproperty_groupview" id="fproperty_groupview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_group">
<input type="hidden" name="modal" value="<?php echo (int)$property_group_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($property_group_view->PropertyGroup->Visible) { // PropertyGroup ?>
	<tr id="r_PropertyGroup">
		<td class="<?php echo $property_group_view->TableLeftColumnClass ?>"><span id="elh_property_group_PropertyGroup"><?php echo $property_group_view->PropertyGroup->caption() ?></span></td>
		<td data-name="PropertyGroup" <?php echo $property_group_view->PropertyGroup->cellAttributes() ?>>
<span id="el_property_group_PropertyGroup">
<span<?php echo $property_group_view->PropertyGroup->viewAttributes() ?>><?php echo $property_group_view->PropertyGroup->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_group_view->PropertyGroupDesc->Visible) { // PropertyGroupDesc ?>
	<tr id="r_PropertyGroupDesc">
		<td class="<?php echo $property_group_view->TableLeftColumnClass ?>"><span id="elh_property_group_PropertyGroupDesc"><?php echo $property_group_view->PropertyGroupDesc->caption() ?></span></td>
		<td data-name="PropertyGroupDesc" <?php echo $property_group_view->PropertyGroupDesc->cellAttributes() ?>>
<span id="el_property_group_PropertyGroupDesc">
<span<?php echo $property_group_view->PropertyGroupDesc->viewAttributes() ?>><?php echo $property_group_view->PropertyGroupDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$property_group_view->IsModal) { ?>
<?php if (!$property_group_view->isExport()) { ?>
<?php echo $property_group_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$property_group_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$property_group_view->isExport()) { ?>
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
$property_group_view->terminate();
?>