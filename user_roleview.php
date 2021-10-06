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
$user_role_view = new user_role_view();

// Run the page
$user_role_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_role_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$user_role_view->isExport()) { ?>
<script>
var fuser_roleview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fuser_roleview = currentForm = new ew.Form("fuser_roleview", "view");
	loadjs.done("fuser_roleview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$user_role_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $user_role_view->ExportOptions->render("body") ?>
<?php $user_role_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $user_role_view->showPageHeader(); ?>
<?php
$user_role_view->showMessage();
?>
<?php if (!$user_role_view->IsModal) { ?>
<?php if (!$user_role_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $user_role_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fuser_roleview" id="fuser_roleview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user_role">
<input type="hidden" name="modal" value="<?php echo (int)$user_role_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($user_role_view->Role->Visible) { // Role ?>
	<tr id="r_Role">
		<td class="<?php echo $user_role_view->TableLeftColumnClass ?>"><span id="elh_user_role_Role"><?php echo $user_role_view->Role->caption() ?></span></td>
		<td data-name="Role" <?php echo $user_role_view->Role->cellAttributes() ?>>
<span id="el_user_role_Role">
<span<?php echo $user_role_view->Role->viewAttributes() ?>><?php echo $user_role_view->Role->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user_role_view->RoleDescription->Visible) { // RoleDescription ?>
	<tr id="r_RoleDescription">
		<td class="<?php echo $user_role_view->TableLeftColumnClass ?>"><span id="elh_user_role_RoleDescription"><?php echo $user_role_view->RoleDescription->caption() ?></span></td>
		<td data-name="RoleDescription" <?php echo $user_role_view->RoleDescription->cellAttributes() ?>>
<span id="el_user_role_RoleDescription">
<span<?php echo $user_role_view->RoleDescription->viewAttributes() ?>><?php echo $user_role_view->RoleDescription->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$user_role_view->IsModal) { ?>
<?php if (!$user_role_view->isExport()) { ?>
<?php echo $user_role_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$user_role_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$user_role_view->isExport()) { ?>
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
$user_role_view->terminate();
?>