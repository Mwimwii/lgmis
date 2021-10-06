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
$physical_challenge_view = new physical_challenge_view();

// Run the page
$physical_challenge_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$physical_challenge_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$physical_challenge_view->isExport()) { ?>
<script>
var fphysical_challengeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fphysical_challengeview = currentForm = new ew.Form("fphysical_challengeview", "view");
	loadjs.done("fphysical_challengeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$physical_challenge_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $physical_challenge_view->ExportOptions->render("body") ?>
<?php $physical_challenge_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $physical_challenge_view->showPageHeader(); ?>
<?php
$physical_challenge_view->showMessage();
?>
<?php if (!$physical_challenge_view->IsModal) { ?>
<?php if (!$physical_challenge_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $physical_challenge_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fphysical_challengeview" id="fphysical_challengeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="physical_challenge">
<input type="hidden" name="modal" value="<?php echo (int)$physical_challenge_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($physical_challenge_view->PhysicalChallenge->Visible) { // PhysicalChallenge ?>
	<tr id="r_PhysicalChallenge">
		<td class="<?php echo $physical_challenge_view->TableLeftColumnClass ?>"><span id="elh_physical_challenge_PhysicalChallenge"><?php echo $physical_challenge_view->PhysicalChallenge->caption() ?></span></td>
		<td data-name="PhysicalChallenge" <?php echo $physical_challenge_view->PhysicalChallenge->cellAttributes() ?>>
<span id="el_physical_challenge_PhysicalChallenge">
<span<?php echo $physical_challenge_view->PhysicalChallenge->viewAttributes() ?>><?php echo $physical_challenge_view->PhysicalChallenge->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$physical_challenge_view->IsModal) { ?>
<?php if (!$physical_challenge_view->isExport()) { ?>
<?php echo $physical_challenge_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$physical_challenge_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$physical_challenge_view->isExport()) { ?>
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
$physical_challenge_view->terminate();
?>