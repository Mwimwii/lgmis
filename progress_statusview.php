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
$progress_status_view = new progress_status_view();

// Run the page
$progress_status_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$progress_status_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$progress_status_view->isExport()) { ?>
<script>
var fprogress_statusview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fprogress_statusview = currentForm = new ew.Form("fprogress_statusview", "view");
	loadjs.done("fprogress_statusview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$progress_status_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $progress_status_view->ExportOptions->render("body") ?>
<?php $progress_status_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $progress_status_view->showPageHeader(); ?>
<?php
$progress_status_view->showMessage();
?>
<?php if (!$progress_status_view->IsModal) { ?>
<?php if (!$progress_status_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $progress_status_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fprogress_statusview" id="fprogress_statusview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="progress_status">
<input type="hidden" name="modal" value="<?php echo (int)$progress_status_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($progress_status_view->ProgressCode->Visible) { // ProgressCode ?>
	<tr id="r_ProgressCode">
		<td class="<?php echo $progress_status_view->TableLeftColumnClass ?>"><span id="elh_progress_status_ProgressCode"><?php echo $progress_status_view->ProgressCode->caption() ?></span></td>
		<td data-name="ProgressCode" <?php echo $progress_status_view->ProgressCode->cellAttributes() ?>>
<span id="el_progress_status_ProgressCode">
<span<?php echo $progress_status_view->ProgressCode->viewAttributes() ?>><?php echo $progress_status_view->ProgressCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($progress_status_view->ProgressDescription->Visible) { // ProgressDescription ?>
	<tr id="r_ProgressDescription">
		<td class="<?php echo $progress_status_view->TableLeftColumnClass ?>"><span id="elh_progress_status_ProgressDescription"><?php echo $progress_status_view->ProgressDescription->caption() ?></span></td>
		<td data-name="ProgressDescription" <?php echo $progress_status_view->ProgressDescription->cellAttributes() ?>>
<span id="el_progress_status_ProgressDescription">
<span<?php echo $progress_status_view->ProgressDescription->viewAttributes() ?>><?php echo $progress_status_view->ProgressDescription->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$progress_status_view->IsModal) { ?>
<?php if (!$progress_status_view->isExport()) { ?>
<?php echo $progress_status_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$progress_status_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$progress_status_view->isExport()) { ?>
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
$progress_status_view->terminate();
?>