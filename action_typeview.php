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
$action_type_view = new action_type_view();

// Run the page
$action_type_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$action_type_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$action_type_view->isExport()) { ?>
<script>
var faction_typeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	faction_typeview = currentForm = new ew.Form("faction_typeview", "view");
	loadjs.done("faction_typeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$action_type_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $action_type_view->ExportOptions->render("body") ?>
<?php $action_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $action_type_view->showPageHeader(); ?>
<?php
$action_type_view->showMessage();
?>
<?php if (!$action_type_view->IsModal) { ?>
<?php if (!$action_type_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $action_type_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="faction_typeview" id="faction_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="action_type">
<input type="hidden" name="modal" value="<?php echo (int)$action_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($action_type_view->ActionType->Visible) { // ActionType ?>
	<tr id="r_ActionType">
		<td class="<?php echo $action_type_view->TableLeftColumnClass ?>"><span id="elh_action_type_ActionType"><?php echo $action_type_view->ActionType->caption() ?></span></td>
		<td data-name="ActionType" <?php echo $action_type_view->ActionType->cellAttributes() ?>>
<span id="el_action_type_ActionType">
<span<?php echo $action_type_view->ActionType->viewAttributes() ?>><?php echo $action_type_view->ActionType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$action_type_view->IsModal) { ?>
<?php if (!$action_type_view->isExport()) { ?>
<?php echo $action_type_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$action_type_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$action_type_view->isExport()) { ?>
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
$action_type_view->terminate();
?>