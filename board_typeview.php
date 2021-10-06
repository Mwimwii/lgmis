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
$board_type_view = new board_type_view();

// Run the page
$board_type_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$board_type_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$board_type_view->isExport()) { ?>
<script>
var fboard_typeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fboard_typeview = currentForm = new ew.Form("fboard_typeview", "view");
	loadjs.done("fboard_typeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$board_type_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $board_type_view->ExportOptions->render("body") ?>
<?php $board_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $board_type_view->showPageHeader(); ?>
<?php
$board_type_view->showMessage();
?>
<?php if (!$board_type_view->IsModal) { ?>
<?php if (!$board_type_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $board_type_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fboard_typeview" id="fboard_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="board_type">
<input type="hidden" name="modal" value="<?php echo (int)$board_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($board_type_view->BoardType->Visible) { // BoardType ?>
	<tr id="r_BoardType">
		<td class="<?php echo $board_type_view->TableLeftColumnClass ?>"><span id="elh_board_type_BoardType"><?php echo $board_type_view->BoardType->caption() ?></span></td>
		<td data-name="BoardType" <?php echo $board_type_view->BoardType->cellAttributes() ?>>
<span id="el_board_type_BoardType">
<span<?php echo $board_type_view->BoardType->viewAttributes() ?>><?php echo $board_type_view->BoardType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($board_type_view->BoardTypeDesc->Visible) { // BoardTypeDesc ?>
	<tr id="r_BoardTypeDesc">
		<td class="<?php echo $board_type_view->TableLeftColumnClass ?>"><span id="elh_board_type_BoardTypeDesc"><?php echo $board_type_view->BoardTypeDesc->caption() ?></span></td>
		<td data-name="BoardTypeDesc" <?php echo $board_type_view->BoardTypeDesc->cellAttributes() ?>>
<span id="el_board_type_BoardTypeDesc">
<span<?php echo $board_type_view->BoardTypeDesc->viewAttributes() ?>><?php echo $board_type_view->BoardTypeDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$board_type_view->IsModal) { ?>
<?php if (!$board_type_view->isExport()) { ?>
<?php echo $board_type_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$board_type_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$board_type_view->isExport()) { ?>
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
$board_type_view->terminate();
?>