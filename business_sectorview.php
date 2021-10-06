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
$business_sector_view = new business_sector_view();

// Run the page
$business_sector_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_sector_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$business_sector_view->isExport()) { ?>
<script>
var fbusiness_sectorview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fbusiness_sectorview = currentForm = new ew.Form("fbusiness_sectorview", "view");
	loadjs.done("fbusiness_sectorview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$business_sector_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $business_sector_view->ExportOptions->render("body") ?>
<?php $business_sector_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $business_sector_view->showPageHeader(); ?>
<?php
$business_sector_view->showMessage();
?>
<?php if (!$business_sector_view->IsModal) { ?>
<?php if (!$business_sector_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $business_sector_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fbusiness_sectorview" id="fbusiness_sectorview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business_sector">
<input type="hidden" name="modal" value="<?php echo (int)$business_sector_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($business_sector_view->business_sector_code->Visible) { // business_sector_code ?>
	<tr id="r_business_sector_code">
		<td class="<?php echo $business_sector_view->TableLeftColumnClass ?>"><span id="elh_business_sector_business_sector_code"><?php echo $business_sector_view->business_sector_code->caption() ?></span></td>
		<td data-name="business_sector_code" <?php echo $business_sector_view->business_sector_code->cellAttributes() ?>>
<span id="el_business_sector_business_sector_code">
<span<?php echo $business_sector_view->business_sector_code->viewAttributes() ?>><?php echo $business_sector_view->business_sector_code->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_sector_view->business_sector_name->Visible) { // business_sector_name ?>
	<tr id="r_business_sector_name">
		<td class="<?php echo $business_sector_view->TableLeftColumnClass ?>"><span id="elh_business_sector_business_sector_name"><?php echo $business_sector_view->business_sector_name->caption() ?></span></td>
		<td data-name="business_sector_name" <?php echo $business_sector_view->business_sector_name->cellAttributes() ?>>
<span id="el_business_sector_business_sector_name">
<span<?php echo $business_sector_view->business_sector_name->viewAttributes() ?>><?php echo $business_sector_view->business_sector_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($business_sector_view->business_sector_desc->Visible) { // business_sector_desc ?>
	<tr id="r_business_sector_desc">
		<td class="<?php echo $business_sector_view->TableLeftColumnClass ?>"><span id="elh_business_sector_business_sector_desc"><?php echo $business_sector_view->business_sector_desc->caption() ?></span></td>
		<td data-name="business_sector_desc" <?php echo $business_sector_view->business_sector_desc->cellAttributes() ?>>
<span id="el_business_sector_business_sector_desc">
<span<?php echo $business_sector_view->business_sector_desc->viewAttributes() ?>><?php echo $business_sector_view->business_sector_desc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$business_sector_view->IsModal) { ?>
<?php if (!$business_sector_view->isExport()) { ?>
<?php echo $business_sector_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$business_sector_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$business_sector_view->isExport()) { ?>
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
$business_sector_view->terminate();
?>