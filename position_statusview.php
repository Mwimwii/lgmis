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
$position_status_view = new position_status_view();

// Run the page
$position_status_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$position_status_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$position_status_view->isExport()) { ?>
<script>
var fposition_statusview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fposition_statusview = currentForm = new ew.Form("fposition_statusview", "view");
	loadjs.done("fposition_statusview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$position_status_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $position_status_view->ExportOptions->render("body") ?>
<?php $position_status_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $position_status_view->showPageHeader(); ?>
<?php
$position_status_view->showMessage();
?>
<?php if (!$position_status_view->IsModal) { ?>
<?php if (!$position_status_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $position_status_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fposition_statusview" id="fposition_statusview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="position_status">
<input type="hidden" name="modal" value="<?php echo (int)$position_status_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($position_status_view->PositionStatus->Visible) { // PositionStatus ?>
	<tr id="r_PositionStatus">
		<td class="<?php echo $position_status_view->TableLeftColumnClass ?>"><span id="elh_position_status_PositionStatus"><?php echo $position_status_view->PositionStatus->caption() ?></span></td>
		<td data-name="PositionStatus" <?php echo $position_status_view->PositionStatus->cellAttributes() ?>>
<span id="el_position_status_PositionStatus">
<span<?php echo $position_status_view->PositionStatus->viewAttributes() ?>><?php echo $position_status_view->PositionStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($position_status_view->PositionStatusDesc->Visible) { // PositionStatusDesc ?>
	<tr id="r_PositionStatusDesc">
		<td class="<?php echo $position_status_view->TableLeftColumnClass ?>"><span id="elh_position_status_PositionStatusDesc"><?php echo $position_status_view->PositionStatusDesc->caption() ?></span></td>
		<td data-name="PositionStatusDesc" <?php echo $position_status_view->PositionStatusDesc->cellAttributes() ?>>
<span id="el_position_status_PositionStatusDesc">
<span<?php echo $position_status_view->PositionStatusDesc->viewAttributes() ?>><?php echo $position_status_view->PositionStatusDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$position_status_view->IsModal) { ?>
<?php if (!$position_status_view->isExport()) { ?>
<?php echo $position_status_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$position_status_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$position_status_view->isExport()) { ?>
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
$position_status_view->terminate();
?>