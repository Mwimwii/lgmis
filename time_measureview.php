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
$time_measure_view = new time_measure_view();

// Run the page
$time_measure_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$time_measure_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$time_measure_view->isExport()) { ?>
<script>
var ftime_measureview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftime_measureview = currentForm = new ew.Form("ftime_measureview", "view");
	loadjs.done("ftime_measureview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$time_measure_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $time_measure_view->ExportOptions->render("body") ?>
<?php $time_measure_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $time_measure_view->showPageHeader(); ?>
<?php
$time_measure_view->showMessage();
?>
<?php if (!$time_measure_view->IsModal) { ?>
<?php if (!$time_measure_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $time_measure_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="ftime_measureview" id="ftime_measureview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="time_measure">
<input type="hidden" name="modal" value="<?php echo (int)$time_measure_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($time_measure_view->Unit_of_measure->Visible) { // Unit_of_measure ?>
	<tr id="r_Unit_of_measure">
		<td class="<?php echo $time_measure_view->TableLeftColumnClass ?>"><span id="elh_time_measure_Unit_of_measure"><?php echo $time_measure_view->Unit_of_measure->caption() ?></span></td>
		<td data-name="Unit_of_measure" <?php echo $time_measure_view->Unit_of_measure->cellAttributes() ?>>
<span id="el_time_measure_Unit_of_measure">
<span<?php echo $time_measure_view->Unit_of_measure->viewAttributes() ?>><?php echo $time_measure_view->Unit_of_measure->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$time_measure_view->IsModal) { ?>
<?php if (!$time_measure_view->isExport()) { ?>
<?php echo $time_measure_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$time_measure_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$time_measure_view->isExport()) { ?>
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
$time_measure_view->terminate();
?>