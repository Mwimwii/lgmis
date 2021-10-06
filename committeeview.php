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
$committee_view = new committee_view();

// Run the page
$committee_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$committee_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$committee_view->isExport()) { ?>
<script>
var fcommitteeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcommitteeview = currentForm = new ew.Form("fcommitteeview", "view");
	loadjs.done("fcommitteeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$committee_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $committee_view->ExportOptions->render("body") ?>
<?php $committee_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $committee_view->showPageHeader(); ?>
<?php
$committee_view->showMessage();
?>
<?php if (!$committee_view->IsModal) { ?>
<?php if (!$committee_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $committee_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcommitteeview" id="fcommitteeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="committee">
<input type="hidden" name="modal" value="<?php echo (int)$committee_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($committee_view->CommitteCode->Visible) { // CommitteCode ?>
	<tr id="r_CommitteCode">
		<td class="<?php echo $committee_view->TableLeftColumnClass ?>"><span id="elh_committee_CommitteCode"><?php echo $committee_view->CommitteCode->caption() ?></span></td>
		<td data-name="CommitteCode" <?php echo $committee_view->CommitteCode->cellAttributes() ?>>
<span id="el_committee_CommitteCode">
<span<?php echo $committee_view->CommitteCode->viewAttributes() ?>><?php echo $committee_view->CommitteCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($committee_view->CommitteeName->Visible) { // CommitteeName ?>
	<tr id="r_CommitteeName">
		<td class="<?php echo $committee_view->TableLeftColumnClass ?>"><span id="elh_committee_CommitteeName"><?php echo $committee_view->CommitteeName->caption() ?></span></td>
		<td data-name="CommitteeName" <?php echo $committee_view->CommitteeName->cellAttributes() ?>>
<span id="el_committee_CommitteeName">
<span<?php echo $committee_view->CommitteeName->viewAttributes() ?>><?php echo $committee_view->CommitteeName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$committee_view->IsModal) { ?>
<?php if (!$committee_view->isExport()) { ?>
<?php echo $committee_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$committee_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$committee_view->isExport()) { ?>
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
$committee_view->terminate();
?>