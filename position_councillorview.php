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
$position_councillor_view = new position_councillor_view();

// Run the page
$position_councillor_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$position_councillor_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$position_councillor_view->isExport()) { ?>
<script>
var fposition_councillorview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fposition_councillorview = currentForm = new ew.Form("fposition_councillorview", "view");
	loadjs.done("fposition_councillorview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$position_councillor_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $position_councillor_view->ExportOptions->render("body") ?>
<?php $position_councillor_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $position_councillor_view->showPageHeader(); ?>
<?php
$position_councillor_view->showMessage();
?>
<?php if (!$position_councillor_view->IsModal) { ?>
<?php if (!$position_councillor_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $position_councillor_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fposition_councillorview" id="fposition_councillorview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="position_councillor">
<input type="hidden" name="modal" value="<?php echo (int)$position_councillor_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($position_councillor_view->PositionCode->Visible) { // PositionCode ?>
	<tr id="r_PositionCode">
		<td class="<?php echo $position_councillor_view->TableLeftColumnClass ?>"><span id="elh_position_councillor_PositionCode"><?php echo $position_councillor_view->PositionCode->caption() ?></span></td>
		<td data-name="PositionCode" <?php echo $position_councillor_view->PositionCode->cellAttributes() ?>>
<span id="el_position_councillor_PositionCode">
<span<?php echo $position_councillor_view->PositionCode->viewAttributes() ?>><?php echo $position_councillor_view->PositionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($position_councillor_view->PositionName->Visible) { // PositionName ?>
	<tr id="r_PositionName">
		<td class="<?php echo $position_councillor_view->TableLeftColumnClass ?>"><span id="elh_position_councillor_PositionName"><?php echo $position_councillor_view->PositionName->caption() ?></span></td>
		<td data-name="PositionName" <?php echo $position_councillor_view->PositionName->cellAttributes() ?>>
<span id="el_position_councillor_PositionName">
<span<?php echo $position_councillor_view->PositionName->viewAttributes() ?>><?php echo $position_councillor_view->PositionName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$position_councillor_view->IsModal) { ?>
<?php if (!$position_councillor_view->isExport()) { ?>
<?php echo $position_councillor_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$position_councillor_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$position_councillor_view->isExport()) { ?>
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
$position_councillor_view->terminate();
?>