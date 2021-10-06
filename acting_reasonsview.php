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
$acting_reasons_view = new acting_reasons_view();

// Run the page
$acting_reasons_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acting_reasons_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$acting_reasons_view->isExport()) { ?>
<script>
var facting_reasonsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	facting_reasonsview = currentForm = new ew.Form("facting_reasonsview", "view");
	loadjs.done("facting_reasonsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$acting_reasons_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $acting_reasons_view->ExportOptions->render("body") ?>
<?php $acting_reasons_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $acting_reasons_view->showPageHeader(); ?>
<?php
$acting_reasons_view->showMessage();
?>
<?php if (!$acting_reasons_view->IsModal) { ?>
<?php if (!$acting_reasons_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $acting_reasons_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="facting_reasonsview" id="facting_reasonsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acting_reasons">
<input type="hidden" name="modal" value="<?php echo (int)$acting_reasons_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($acting_reasons_view->ActingReasons->Visible) { // ActingReasons ?>
	<tr id="r_ActingReasons">
		<td class="<?php echo $acting_reasons_view->TableLeftColumnClass ?>"><span id="elh_acting_reasons_ActingReasons"><?php echo $acting_reasons_view->ActingReasons->caption() ?></span></td>
		<td data-name="ActingReasons" <?php echo $acting_reasons_view->ActingReasons->cellAttributes() ?>>
<span id="el_acting_reasons_ActingReasons">
<span<?php echo $acting_reasons_view->ActingReasons->viewAttributes() ?>><?php echo $acting_reasons_view->ActingReasons->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$acting_reasons_view->IsModal) { ?>
<?php if (!$acting_reasons_view->isExport()) { ?>
<?php echo $acting_reasons_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$acting_reasons_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$acting_reasons_view->isExport()) { ?>
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
$acting_reasons_view->terminate();
?>