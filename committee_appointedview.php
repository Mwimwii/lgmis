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
$committee_appointed_view = new committee_appointed_view();

// Run the page
$committee_appointed_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$committee_appointed_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$committee_appointed_view->isExport()) { ?>
<script>
var fcommittee_appointedview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcommittee_appointedview = currentForm = new ew.Form("fcommittee_appointedview", "view");
	loadjs.done("fcommittee_appointedview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$committee_appointed_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $committee_appointed_view->ExportOptions->render("body") ?>
<?php $committee_appointed_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $committee_appointed_view->showPageHeader(); ?>
<?php
$committee_appointed_view->showMessage();
?>
<?php if (!$committee_appointed_view->IsModal) { ?>
<?php if (!$committee_appointed_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $committee_appointed_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcommittee_appointedview" id="fcommittee_appointedview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="committee_appointed">
<input type="hidden" name="modal" value="<?php echo (int)$committee_appointed_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($committee_appointed_view->CommitteCode->Visible) { // CommitteCode ?>
	<tr id="r_CommitteCode">
		<td class="<?php echo $committee_appointed_view->TableLeftColumnClass ?>"><span id="elh_committee_appointed_CommitteCode"><?php echo $committee_appointed_view->CommitteCode->caption() ?></span></td>
		<td data-name="CommitteCode" <?php echo $committee_appointed_view->CommitteCode->cellAttributes() ?>>
<span id="el_committee_appointed_CommitteCode">
<span<?php echo $committee_appointed_view->CommitteCode->viewAttributes() ?>><?php echo $committee_appointed_view->CommitteCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($committee_appointed_view->CommitteeRole->Visible) { // CommitteeRole ?>
	<tr id="r_CommitteeRole">
		<td class="<?php echo $committee_appointed_view->TableLeftColumnClass ?>"><span id="elh_committee_appointed_CommitteeRole"><?php echo $committee_appointed_view->CommitteeRole->caption() ?></span></td>
		<td data-name="CommitteeRole" <?php echo $committee_appointed_view->CommitteeRole->cellAttributes() ?>>
<span id="el_committee_appointed_CommitteeRole">
<span<?php echo $committee_appointed_view->CommitteeRole->viewAttributes() ?>><?php echo $committee_appointed_view->CommitteeRole->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$committee_appointed_view->IsModal) { ?>
<?php if (!$committee_appointed_view->isExport()) { ?>
<?php echo $committee_appointed_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$committee_appointed_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$committee_appointed_view->isExport()) { ?>
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
$committee_appointed_view->terminate();
?>