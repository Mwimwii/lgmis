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
$service_provider_view = new service_provider_view();

// Run the page
$service_provider_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$service_provider_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$service_provider_view->isExport()) { ?>
<script>
var fservice_providerview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fservice_providerview = currentForm = new ew.Form("fservice_providerview", "view");
	loadjs.done("fservice_providerview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$service_provider_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $service_provider_view->ExportOptions->render("body") ?>
<?php $service_provider_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $service_provider_view->showPageHeader(); ?>
<?php
$service_provider_view->showMessage();
?>
<?php if (!$service_provider_view->IsModal) { ?>
<?php if (!$service_provider_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $service_provider_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fservice_providerview" id="fservice_providerview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="service_provider">
<input type="hidden" name="modal" value="<?php echo (int)$service_provider_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($service_provider_view->ServiceProviderID->Visible) { // ServiceProviderID ?>
	<tr id="r_ServiceProviderID">
		<td class="<?php echo $service_provider_view->TableLeftColumnClass ?>"><span id="elh_service_provider_ServiceProviderID"><?php echo $service_provider_view->ServiceProviderID->caption() ?></span></td>
		<td data-name="ServiceProviderID" <?php echo $service_provider_view->ServiceProviderID->cellAttributes() ?>>
<span id="el_service_provider_ServiceProviderID">
<span<?php echo $service_provider_view->ServiceProviderID->viewAttributes() ?>><?php echo $service_provider_view->ServiceProviderID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($service_provider_view->SPName->Visible) { // SPName ?>
	<tr id="r_SPName">
		<td class="<?php echo $service_provider_view->TableLeftColumnClass ?>"><span id="elh_service_provider_SPName"><?php echo $service_provider_view->SPName->caption() ?></span></td>
		<td data-name="SPName" <?php echo $service_provider_view->SPName->cellAttributes() ?>>
<span id="el_service_provider_SPName">
<span<?php echo $service_provider_view->SPName->viewAttributes() ?>><?php echo $service_provider_view->SPName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($service_provider_view->SPType->Visible) { // SPType ?>
	<tr id="r_SPType">
		<td class="<?php echo $service_provider_view->TableLeftColumnClass ?>"><span id="elh_service_provider_SPType"><?php echo $service_provider_view->SPType->caption() ?></span></td>
		<td data-name="SPType" <?php echo $service_provider_view->SPType->cellAttributes() ?>>
<span id="el_service_provider_SPType">
<span<?php echo $service_provider_view->SPType->viewAttributes() ?>><?php echo $service_provider_view->SPType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$service_provider_view->IsModal) { ?>
<?php if (!$service_provider_view->isExport()) { ?>
<?php echo $service_provider_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$service_provider_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$service_provider_view->isExport()) { ?>
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
$service_provider_view->terminate();
?>