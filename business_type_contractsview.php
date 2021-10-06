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
$business_type_contracts_view = new business_type_contracts_view();

// Run the page
$business_type_contracts_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_type_contracts_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$business_type_contracts_view->isExport()) { ?>
<script>
var fbusiness_type_contractsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fbusiness_type_contractsview = currentForm = new ew.Form("fbusiness_type_contractsview", "view");
	loadjs.done("fbusiness_type_contractsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$business_type_contracts_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $business_type_contracts_view->ExportOptions->render("body") ?>
<?php $business_type_contracts_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $business_type_contracts_view->showPageHeader(); ?>
<?php
$business_type_contracts_view->showMessage();
?>
<?php if (!$business_type_contracts_view->IsModal) { ?>
<?php if (!$business_type_contracts_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $business_type_contracts_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fbusiness_type_contractsview" id="fbusiness_type_contractsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business_type_contracts">
<input type="hidden" name="modal" value="<?php echo (int)$business_type_contracts_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($business_type_contracts_view->business_type_code->Visible) { // business_type_code ?>
	<tr id="r_business_type_code">
		<td class="<?php echo $business_type_contracts_view->TableLeftColumnClass ?>"><span id="elh_business_type_contracts_business_type_code"><?php echo $business_type_contracts_view->business_type_code->caption() ?></span></td>
		<td data-name="business_type_code" <?php echo $business_type_contracts_view->business_type_code->cellAttributes() ?>>
<span id="el_business_type_contracts_business_type_code">
<span<?php echo $business_type_contracts_view->business_type_code->viewAttributes() ?>><?php echo $business_type_contracts_view->business_type_code->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_type_contracts_view->business_type_name->Visible) { // business_type_name ?>
	<tr id="r_business_type_name">
		<td class="<?php echo $business_type_contracts_view->TableLeftColumnClass ?>"><span id="elh_business_type_contracts_business_type_name"><?php echo $business_type_contracts_view->business_type_name->caption() ?></span></td>
		<td data-name="business_type_name" <?php echo $business_type_contracts_view->business_type_name->cellAttributes() ?>>
<span id="el_business_type_contracts_business_type_name">
<span<?php echo $business_type_contracts_view->business_type_name->viewAttributes() ?>><?php echo $business_type_contracts_view->business_type_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_type_contracts_view->business_type_desc->Visible) { // business_type_desc ?>
	<tr id="r_business_type_desc">
		<td class="<?php echo $business_type_contracts_view->TableLeftColumnClass ?>"><span id="elh_business_type_contracts_business_type_desc"><?php echo $business_type_contracts_view->business_type_desc->caption() ?></span></td>
		<td data-name="business_type_desc" <?php echo $business_type_contracts_view->business_type_desc->cellAttributes() ?>>
<span id="el_business_type_contracts_business_type_desc">
<span<?php echo $business_type_contracts_view->business_type_desc->viewAttributes() ?>><?php echo $business_type_contracts_view->business_type_desc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$business_type_contracts_view->IsModal) { ?>
<?php if (!$business_type_contracts_view->isExport()) { ?>
<?php echo $business_type_contracts_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$business_type_contracts_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$business_type_contracts_view->isExport()) { ?>
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
$business_type_contracts_view->terminate();
?>