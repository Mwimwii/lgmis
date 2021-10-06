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
$appraisal_status_view = new appraisal_status_view();

// Run the page
$appraisal_status_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$appraisal_status_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$appraisal_status_view->isExport()) { ?>
<script>
var fappraisal_statusview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fappraisal_statusview = currentForm = new ew.Form("fappraisal_statusview", "view");
	loadjs.done("fappraisal_statusview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$appraisal_status_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $appraisal_status_view->ExportOptions->render("body") ?>
<?php $appraisal_status_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $appraisal_status_view->showPageHeader(); ?>
<?php
$appraisal_status_view->showMessage();
?>
<?php if (!$appraisal_status_view->IsModal) { ?>
<?php if (!$appraisal_status_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $appraisal_status_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fappraisal_statusview" id="fappraisal_statusview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="appraisal_status">
<input type="hidden" name="modal" value="<?php echo (int)$appraisal_status_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($appraisal_status_view->AppraisalStatus->Visible) { // AppraisalStatus ?>
	<tr id="r_AppraisalStatus">
		<td class="<?php echo $appraisal_status_view->TableLeftColumnClass ?>"><span id="elh_appraisal_status_AppraisalStatus"><?php echo $appraisal_status_view->AppraisalStatus->caption() ?></span></td>
		<td data-name="AppraisalStatus" <?php echo $appraisal_status_view->AppraisalStatus->cellAttributes() ?>>
<span id="el_appraisal_status_AppraisalStatus">
<span<?php echo $appraisal_status_view->AppraisalStatus->viewAttributes() ?>><?php echo $appraisal_status_view->AppraisalStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($appraisal_status_view->AppraisalStatusDesc->Visible) { // AppraisalStatusDesc ?>
	<tr id="r_AppraisalStatusDesc">
		<td class="<?php echo $appraisal_status_view->TableLeftColumnClass ?>"><span id="elh_appraisal_status_AppraisalStatusDesc"><?php echo $appraisal_status_view->AppraisalStatusDesc->caption() ?></span></td>
		<td data-name="AppraisalStatusDesc" <?php echo $appraisal_status_view->AppraisalStatusDesc->cellAttributes() ?>>
<span id="el_appraisal_status_AppraisalStatusDesc">
<span<?php echo $appraisal_status_view->AppraisalStatusDesc->viewAttributes() ?>><?php echo $appraisal_status_view->AppraisalStatusDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$appraisal_status_view->IsModal) { ?>
<?php if (!$appraisal_status_view->isExport()) { ?>
<?php echo $appraisal_status_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$appraisal_status_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$appraisal_status_view->isExport()) { ?>
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
$appraisal_status_view->terminate();
?>