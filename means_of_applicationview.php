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
$means_of_application_view = new means_of_application_view();

// Run the page
$means_of_application_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$means_of_application_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$means_of_application_view->isExport()) { ?>
<script>
var fmeans_of_applicationview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fmeans_of_applicationview = currentForm = new ew.Form("fmeans_of_applicationview", "view");
	loadjs.done("fmeans_of_applicationview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$means_of_application_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $means_of_application_view->ExportOptions->render("body") ?>
<?php $means_of_application_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $means_of_application_view->showPageHeader(); ?>
<?php
$means_of_application_view->showMessage();
?>
<?php if (!$means_of_application_view->IsModal) { ?>
<?php if (!$means_of_application_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $means_of_application_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fmeans_of_applicationview" id="fmeans_of_applicationview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="means_of_application">
<input type="hidden" name="modal" value="<?php echo (int)$means_of_application_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($means_of_application_view->ChoiceCode->Visible) { // ChoiceCode ?>
	<tr id="r_ChoiceCode">
		<td class="<?php echo $means_of_application_view->TableLeftColumnClass ?>"><span id="elh_means_of_application_ChoiceCode"><?php echo $means_of_application_view->ChoiceCode->caption() ?></span></td>
		<td data-name="ChoiceCode" <?php echo $means_of_application_view->ChoiceCode->cellAttributes() ?>>
<span id="el_means_of_application_ChoiceCode">
<span<?php echo $means_of_application_view->ChoiceCode->viewAttributes() ?>><?php echo $means_of_application_view->ChoiceCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($means_of_application_view->Application->Visible) { // Application ?>
	<tr id="r_Application">
		<td class="<?php echo $means_of_application_view->TableLeftColumnClass ?>"><span id="elh_means_of_application_Application"><?php echo $means_of_application_view->Application->caption() ?></span></td>
		<td data-name="Application" <?php echo $means_of_application_view->Application->cellAttributes() ?>>
<span id="el_means_of_application_Application">
<span<?php echo $means_of_application_view->Application->viewAttributes() ?>><?php echo $means_of_application_view->Application->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$means_of_application_view->IsModal) { ?>
<?php if (!$means_of_application_view->isExport()) { ?>
<?php echo $means_of_application_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$means_of_application_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$means_of_application_view->isExport()) { ?>
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
$means_of_application_view->terminate();
?>