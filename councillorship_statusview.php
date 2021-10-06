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
$councillorship_status_view = new councillorship_status_view();

// Run the page
$councillorship_status_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillorship_status_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$councillorship_status_view->isExport()) { ?>
<script>
var fcouncillorship_statusview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcouncillorship_statusview = currentForm = new ew.Form("fcouncillorship_statusview", "view");
	loadjs.done("fcouncillorship_statusview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$councillorship_status_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $councillorship_status_view->ExportOptions->render("body") ?>
<?php $councillorship_status_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $councillorship_status_view->showPageHeader(); ?>
<?php
$councillorship_status_view->showMessage();
?>
<?php if (!$councillorship_status_view->IsModal) { ?>
<?php if (!$councillorship_status_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $councillorship_status_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcouncillorship_statusview" id="fcouncillorship_statusview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillorship_status">
<input type="hidden" name="modal" value="<?php echo (int)$councillorship_status_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($councillorship_status_view->CouncillorsipStatus->Visible) { // CouncillorsipStatus ?>
	<tr id="r_CouncillorsipStatus">
		<td class="<?php echo $councillorship_status_view->TableLeftColumnClass ?>"><span id="elh_councillorship_status_CouncillorsipStatus"><?php echo $councillorship_status_view->CouncillorsipStatus->caption() ?></span></td>
		<td data-name="CouncillorsipStatus" <?php echo $councillorship_status_view->CouncillorsipStatus->cellAttributes() ?>>
<span id="el_councillorship_status_CouncillorsipStatus">
<span<?php echo $councillorship_status_view->CouncillorsipStatus->viewAttributes() ?>><?php echo $councillorship_status_view->CouncillorsipStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_status_view->CouncillorshipStatusDesc->Visible) { // CouncillorshipStatusDesc ?>
	<tr id="r_CouncillorshipStatusDesc">
		<td class="<?php echo $councillorship_status_view->TableLeftColumnClass ?>"><span id="elh_councillorship_status_CouncillorshipStatusDesc"><?php echo $councillorship_status_view->CouncillorshipStatusDesc->caption() ?></span></td>
		<td data-name="CouncillorshipStatusDesc" <?php echo $councillorship_status_view->CouncillorshipStatusDesc->cellAttributes() ?>>
<span id="el_councillorship_status_CouncillorshipStatusDesc">
<span<?php echo $councillorship_status_view->CouncillorshipStatusDesc->viewAttributes() ?>><?php echo $councillorship_status_view->CouncillorshipStatusDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$councillorship_status_view->IsModal) { ?>
<?php if (!$councillorship_status_view->isExport()) { ?>
<?php echo $councillorship_status_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$councillorship_status_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$councillorship_status_view->isExport()) { ?>
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
$councillorship_status_view->terminate();
?>