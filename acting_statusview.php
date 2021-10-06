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
$acting_status_view = new acting_status_view();

// Run the page
$acting_status_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acting_status_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$acting_status_view->isExport()) { ?>
<script>
var facting_statusview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	facting_statusview = currentForm = new ew.Form("facting_statusview", "view");
	loadjs.done("facting_statusview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$acting_status_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $acting_status_view->ExportOptions->render("body") ?>
<?php $acting_status_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $acting_status_view->showPageHeader(); ?>
<?php
$acting_status_view->showMessage();
?>
<?php if (!$acting_status_view->IsModal) { ?>
<?php if (!$acting_status_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $acting_status_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="facting_statusview" id="facting_statusview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acting_status">
<input type="hidden" name="modal" value="<?php echo (int)$acting_status_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($acting_status_view->ActingStatus->Visible) { // ActingStatus ?>
	<tr id="r_ActingStatus">
		<td class="<?php echo $acting_status_view->TableLeftColumnClass ?>"><span id="elh_acting_status_ActingStatus"><?php echo $acting_status_view->ActingStatus->caption() ?></span></td>
		<td data-name="ActingStatus" <?php echo $acting_status_view->ActingStatus->cellAttributes() ?>>
<span id="el_acting_status_ActingStatus">
<span<?php echo $acting_status_view->ActingStatus->viewAttributes() ?>><?php echo $acting_status_view->ActingStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($acting_status_view->ActingStatusDesc->Visible) { // ActingStatusDesc ?>
	<tr id="r_ActingStatusDesc">
		<td class="<?php echo $acting_status_view->TableLeftColumnClass ?>"><span id="elh_acting_status_ActingStatusDesc"><?php echo $acting_status_view->ActingStatusDesc->caption() ?></span></td>
		<td data-name="ActingStatusDesc" <?php echo $acting_status_view->ActingStatusDesc->cellAttributes() ?>>
<span id="el_acting_status_ActingStatusDesc">
<span<?php echo $acting_status_view->ActingStatusDesc->viewAttributes() ?>><?php echo $acting_status_view->ActingStatusDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$acting_status_view->IsModal) { ?>
<?php if (!$acting_status_view->isExport()) { ?>
<?php echo $acting_status_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$acting_status_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$acting_status_view->isExport()) { ?>
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
$acting_status_view->terminate();
?>