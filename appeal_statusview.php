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
$appeal_status_view = new appeal_status_view();

// Run the page
$appeal_status_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$appeal_status_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$appeal_status_view->isExport()) { ?>
<script>
var fappeal_statusview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fappeal_statusview = currentForm = new ew.Form("fappeal_statusview", "view");
	loadjs.done("fappeal_statusview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$appeal_status_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $appeal_status_view->ExportOptions->render("body") ?>
<?php $appeal_status_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $appeal_status_view->showPageHeader(); ?>
<?php
$appeal_status_view->showMessage();
?>
<?php if (!$appeal_status_view->IsModal) { ?>
<?php if (!$appeal_status_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $appeal_status_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fappeal_statusview" id="fappeal_statusview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="appeal_status">
<input type="hidden" name="modal" value="<?php echo (int)$appeal_status_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($appeal_status_view->AppealStatusCode->Visible) { // AppealStatusCode ?>
	<tr id="r_AppealStatusCode">
		<td class="<?php echo $appeal_status_view->TableLeftColumnClass ?>"><span id="elh_appeal_status_AppealStatusCode"><?php echo $appeal_status_view->AppealStatusCode->caption() ?></span></td>
		<td data-name="AppealStatusCode" <?php echo $appeal_status_view->AppealStatusCode->cellAttributes() ?>>
<span id="el_appeal_status_AppealStatusCode">
<span<?php echo $appeal_status_view->AppealStatusCode->viewAttributes() ?>><?php echo $appeal_status_view->AppealStatusCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($appeal_status_view->AppealStatus->Visible) { // AppealStatus ?>
	<tr id="r_AppealStatus">
		<td class="<?php echo $appeal_status_view->TableLeftColumnClass ?>"><span id="elh_appeal_status_AppealStatus"><?php echo $appeal_status_view->AppealStatus->caption() ?></span></td>
		<td data-name="AppealStatus" <?php echo $appeal_status_view->AppealStatus->cellAttributes() ?>>
<span id="el_appeal_status_AppealStatus">
<span<?php echo $appeal_status_view->AppealStatus->viewAttributes() ?>><?php echo $appeal_status_view->AppealStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$appeal_status_view->IsModal) { ?>
<?php if (!$appeal_status_view->isExport()) { ?>
<?php echo $appeal_status_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$appeal_status_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$appeal_status_view->isExport()) { ?>
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
$appeal_status_view->terminate();
?>