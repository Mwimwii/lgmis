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
$serviceprovidertype_view = new serviceprovidertype_view();

// Run the page
$serviceprovidertype_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$serviceprovidertype_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$serviceprovidertype_view->isExport()) { ?>
<script>
var fserviceprovidertypeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fserviceprovidertypeview = currentForm = new ew.Form("fserviceprovidertypeview", "view");
	loadjs.done("fserviceprovidertypeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$serviceprovidertype_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $serviceprovidertype_view->ExportOptions->render("body") ?>
<?php $serviceprovidertype_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $serviceprovidertype_view->showPageHeader(); ?>
<?php
$serviceprovidertype_view->showMessage();
?>
<?php if (!$serviceprovidertype_view->IsModal) { ?>
<?php if (!$serviceprovidertype_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $serviceprovidertype_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fserviceprovidertypeview" id="fserviceprovidertypeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="serviceprovidertype">
<input type="hidden" name="modal" value="<?php echo (int)$serviceprovidertype_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($serviceprovidertype_view->ServiceProviderType->Visible) { // ServiceProviderType ?>
	<tr id="r_ServiceProviderType">
		<td class="<?php echo $serviceprovidertype_view->TableLeftColumnClass ?>"><span id="elh_serviceprovidertype_ServiceProviderType"><?php echo $serviceprovidertype_view->ServiceProviderType->caption() ?></span></td>
		<td data-name="ServiceProviderType" <?php echo $serviceprovidertype_view->ServiceProviderType->cellAttributes() ?>>
<span id="el_serviceprovidertype_ServiceProviderType">
<span<?php echo $serviceprovidertype_view->ServiceProviderType->viewAttributes() ?>><?php echo $serviceprovidertype_view->ServiceProviderType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($serviceprovidertype_view->SPTypeDesc->Visible) { // SPTypeDesc ?>
	<tr id="r_SPTypeDesc">
		<td class="<?php echo $serviceprovidertype_view->TableLeftColumnClass ?>"><span id="elh_serviceprovidertype_SPTypeDesc"><?php echo $serviceprovidertype_view->SPTypeDesc->caption() ?></span></td>
		<td data-name="SPTypeDesc" <?php echo $serviceprovidertype_view->SPTypeDesc->cellAttributes() ?>>
<span id="el_serviceprovidertype_SPTypeDesc">
<span<?php echo $serviceprovidertype_view->SPTypeDesc->viewAttributes() ?>><?php echo $serviceprovidertype_view->SPTypeDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$serviceprovidertype_view->IsModal) { ?>
<?php if (!$serviceprovidertype_view->isExport()) { ?>
<?php echo $serviceprovidertype_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$serviceprovidertype_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$serviceprovidertype_view->isExport()) { ?>
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
$serviceprovidertype_view->terminate();
?>