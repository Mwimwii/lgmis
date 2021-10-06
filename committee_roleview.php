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
$committee_role_view = new committee_role_view();

// Run the page
$committee_role_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$committee_role_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$committee_role_view->isExport()) { ?>
<script>
var fcommittee_roleview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcommittee_roleview = currentForm = new ew.Form("fcommittee_roleview", "view");
	loadjs.done("fcommittee_roleview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$committee_role_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $committee_role_view->ExportOptions->render("body") ?>
<?php $committee_role_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $committee_role_view->showPageHeader(); ?>
<?php
$committee_role_view->showMessage();
?>
<?php if (!$committee_role_view->IsModal) { ?>
<?php if (!$committee_role_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $committee_role_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcommittee_roleview" id="fcommittee_roleview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="committee_role">
<input type="hidden" name="modal" value="<?php echo (int)$committee_role_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($committee_role_view->CommitteeRole->Visible) { // CommitteeRole ?>
	<tr id="r_CommitteeRole">
		<td class="<?php echo $committee_role_view->TableLeftColumnClass ?>"><span id="elh_committee_role_CommitteeRole"><?php echo $committee_role_view->CommitteeRole->caption() ?></span></td>
		<td data-name="CommitteeRole" <?php echo $committee_role_view->CommitteeRole->cellAttributes() ?>>
<span id="el_committee_role_CommitteeRole">
<span<?php echo $committee_role_view->CommitteeRole->viewAttributes() ?>><?php echo $committee_role_view->CommitteeRole->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($committee_role_view->CommitteeRoleDesc->Visible) { // CommitteeRoleDesc ?>
	<tr id="r_CommitteeRoleDesc">
		<td class="<?php echo $committee_role_view->TableLeftColumnClass ?>"><span id="elh_committee_role_CommitteeRoleDesc"><?php echo $committee_role_view->CommitteeRoleDesc->caption() ?></span></td>
		<td data-name="CommitteeRoleDesc" <?php echo $committee_role_view->CommitteeRoleDesc->cellAttributes() ?>>
<span id="el_committee_role_CommitteeRoleDesc">
<span<?php echo $committee_role_view->CommitteeRoleDesc->viewAttributes() ?>><?php echo $committee_role_view->CommitteeRoleDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$committee_role_view->IsModal) { ?>
<?php if (!$committee_role_view->isExport()) { ?>
<?php echo $committee_role_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$committee_role_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$committee_role_view->isExport()) { ?>
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
$committee_role_view->terminate();
?>