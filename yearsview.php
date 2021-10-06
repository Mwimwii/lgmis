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
$years_view = new years_view();

// Run the page
$years_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$years_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$years_view->isExport()) { ?>
<script>
var fyearsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fyearsview = currentForm = new ew.Form("fyearsview", "view");
	loadjs.done("fyearsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$years_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $years_view->ExportOptions->render("body") ?>
<?php $years_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $years_view->showPageHeader(); ?>
<?php
$years_view->showMessage();
?>
<?php if (!$years_view->IsModal) { ?>
<?php if (!$years_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $years_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fyearsview" id="fyearsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="years">
<input type="hidden" name="modal" value="<?php echo (int)$years_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($years_view->Year->Visible) { // Year ?>
	<tr id="r_Year">
		<td class="<?php echo $years_view->TableLeftColumnClass ?>"><span id="elh_years_Year"><?php echo $years_view->Year->caption() ?></span></td>
		<td data-name="Year" <?php echo $years_view->Year->cellAttributes() ?>>
<span id="el_years_Year">
<span<?php echo $years_view->Year->viewAttributes() ?>><?php echo $years_view->Year->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$years_view->IsModal) { ?>
<?php if (!$years_view->isExport()) { ?>
<?php echo $years_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$years_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$years_view->isExport()) { ?>
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
$years_view->terminate();
?>