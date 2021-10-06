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
$asset_status_view = new asset_status_view();

// Run the page
$asset_status_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$asset_status_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$asset_status_view->isExport()) { ?>
<script>
var fasset_statusview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fasset_statusview = currentForm = new ew.Form("fasset_statusview", "view");
	loadjs.done("fasset_statusview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$asset_status_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $asset_status_view->ExportOptions->render("body") ?>
<?php $asset_status_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $asset_status_view->showPageHeader(); ?>
<?php
$asset_status_view->showMessage();
?>
<?php if (!$asset_status_view->IsModal) { ?>
<?php if (!$asset_status_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $asset_status_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fasset_statusview" id="fasset_statusview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="asset_status">
<input type="hidden" name="modal" value="<?php echo (int)$asset_status_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($asset_status_view->AssetStatusCode->Visible) { // AssetStatusCode ?>
	<tr id="r_AssetStatusCode">
		<td class="<?php echo $asset_status_view->TableLeftColumnClass ?>"><span id="elh_asset_status_AssetStatusCode"><?php echo $asset_status_view->AssetStatusCode->caption() ?></span></td>
		<td data-name="AssetStatusCode" <?php echo $asset_status_view->AssetStatusCode->cellAttributes() ?>>
<span id="el_asset_status_AssetStatusCode">
<span<?php echo $asset_status_view->AssetStatusCode->viewAttributes() ?>><?php echo $asset_status_view->AssetStatusCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_status_view->AssetStatus->Visible) { // AssetStatus ?>
	<tr id="r_AssetStatus">
		<td class="<?php echo $asset_status_view->TableLeftColumnClass ?>"><span id="elh_asset_status_AssetStatus"><?php echo $asset_status_view->AssetStatus->caption() ?></span></td>
		<td data-name="AssetStatus" <?php echo $asset_status_view->AssetStatus->cellAttributes() ?>>
<span id="el_asset_status_AssetStatus">
<span<?php echo $asset_status_view->AssetStatus->viewAttributes() ?>><?php echo $asset_status_view->AssetStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$asset_status_view->IsModal) { ?>
<?php if (!$asset_status_view->isExport()) { ?>
<?php echo $asset_status_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$asset_status_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$asset_status_view->isExport()) { ?>
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
$asset_status_view->terminate();
?>