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
$asset_type_view = new asset_type_view();

// Run the page
$asset_type_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$asset_type_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$asset_type_view->isExport()) { ?>
<script>
var fasset_typeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fasset_typeview = currentForm = new ew.Form("fasset_typeview", "view");
	loadjs.done("fasset_typeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$asset_type_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $asset_type_view->ExportOptions->render("body") ?>
<?php $asset_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $asset_type_view->showPageHeader(); ?>
<?php
$asset_type_view->showMessage();
?>
<?php if (!$asset_type_view->IsModal) { ?>
<?php if (!$asset_type_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $asset_type_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fasset_typeview" id="fasset_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="asset_type">
<input type="hidden" name="modal" value="<?php echo (int)$asset_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($asset_type_view->AssetTypeCode->Visible) { // AssetTypeCode ?>
	<tr id="r_AssetTypeCode">
		<td class="<?php echo $asset_type_view->TableLeftColumnClass ?>"><span id="elh_asset_type_AssetTypeCode"><?php echo $asset_type_view->AssetTypeCode->caption() ?></span></td>
		<td data-name="AssetTypeCode" <?php echo $asset_type_view->AssetTypeCode->cellAttributes() ?>>
<span id="el_asset_type_AssetTypeCode">
<span<?php echo $asset_type_view->AssetTypeCode->viewAttributes() ?>><?php echo $asset_type_view->AssetTypeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_type_view->AssetTypeName->Visible) { // AssetTypeName ?>
	<tr id="r_AssetTypeName">
		<td class="<?php echo $asset_type_view->TableLeftColumnClass ?>"><span id="elh_asset_type_AssetTypeName"><?php echo $asset_type_view->AssetTypeName->caption() ?></span></td>
		<td data-name="AssetTypeName" <?php echo $asset_type_view->AssetTypeName->cellAttributes() ?>>
<span id="el_asset_type_AssetTypeName">
<span<?php echo $asset_type_view->AssetTypeName->viewAttributes() ?>><?php echo $asset_type_view->AssetTypeName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_type_view->AssetsTypeDesc->Visible) { // AssetsTypeDesc ?>
	<tr id="r_AssetsTypeDesc">
		<td class="<?php echo $asset_type_view->TableLeftColumnClass ?>"><span id="elh_asset_type_AssetsTypeDesc"><?php echo $asset_type_view->AssetsTypeDesc->caption() ?></span></td>
		<td data-name="AssetsTypeDesc" <?php echo $asset_type_view->AssetsTypeDesc->cellAttributes() ?>>
<span id="el_asset_type_AssetsTypeDesc">
<span<?php echo $asset_type_view->AssetsTypeDesc->viewAttributes() ?>><?php echo $asset_type_view->AssetsTypeDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$asset_type_view->IsModal) { ?>
<?php if (!$asset_type_view->isExport()) { ?>
<?php echo $asset_type_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$asset_type_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$asset_type_view->isExport()) { ?>
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
$asset_type_view->terminate();
?>