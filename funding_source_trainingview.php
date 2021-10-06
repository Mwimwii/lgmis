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
$funding_source_training_view = new funding_source_training_view();

// Run the page
$funding_source_training_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$funding_source_training_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$funding_source_training_view->isExport()) { ?>
<script>
var ffunding_source_trainingview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ffunding_source_trainingview = currentForm = new ew.Form("ffunding_source_trainingview", "view");
	loadjs.done("ffunding_source_trainingview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$funding_source_training_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $funding_source_training_view->ExportOptions->render("body") ?>
<?php $funding_source_training_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $funding_source_training_view->showPageHeader(); ?>
<?php
$funding_source_training_view->showMessage();
?>
<?php if (!$funding_source_training_view->IsModal) { ?>
<?php if (!$funding_source_training_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $funding_source_training_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="ffunding_source_trainingview" id="ffunding_source_trainingview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="funding_source_training">
<input type="hidden" name="modal" value="<?php echo (int)$funding_source_training_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($funding_source_training_view->FundingSource->Visible) { // FundingSource ?>
	<tr id="r_FundingSource">
		<td class="<?php echo $funding_source_training_view->TableLeftColumnClass ?>"><span id="elh_funding_source_training_FundingSource"><?php echo $funding_source_training_view->FundingSource->caption() ?></span></td>
		<td data-name="FundingSource" <?php echo $funding_source_training_view->FundingSource->cellAttributes() ?>>
<span id="el_funding_source_training_FundingSource">
<span<?php echo $funding_source_training_view->FundingSource->viewAttributes() ?>><?php echo $funding_source_training_view->FundingSource->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$funding_source_training_view->IsModal) { ?>
<?php if (!$funding_source_training_view->isExport()) { ?>
<?php echo $funding_source_training_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$funding_source_training_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$funding_source_training_view->isExport()) { ?>
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
$funding_source_training_view->terminate();
?>