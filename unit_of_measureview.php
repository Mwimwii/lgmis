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
$unit_of_measure_view = new unit_of_measure_view();

// Run the page
$unit_of_measure_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$unit_of_measure_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$unit_of_measure_view->isExport()) { ?>
<script>
var funit_of_measureview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	funit_of_measureview = currentForm = new ew.Form("funit_of_measureview", "view");
	loadjs.done("funit_of_measureview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$unit_of_measure_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $unit_of_measure_view->ExportOptions->render("body") ?>
<?php $unit_of_measure_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $unit_of_measure_view->showPageHeader(); ?>
<?php
$unit_of_measure_view->showMessage();
?>
<?php if (!$unit_of_measure_view->IsModal) { ?>
<?php if (!$unit_of_measure_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $unit_of_measure_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="funit_of_measureview" id="funit_of_measureview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="unit_of_measure">
<input type="hidden" name="modal" value="<?php echo (int)$unit_of_measure_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($unit_of_measure_view->Unit_of_measure->Visible) { // Unit_of_measure ?>
	<tr id="r_Unit_of_measure">
		<td class="<?php echo $unit_of_measure_view->TableLeftColumnClass ?>"><span id="elh_unit_of_measure_Unit_of_measure"><?php echo $unit_of_measure_view->Unit_of_measure->caption() ?></span></td>
		<td data-name="Unit_of_measure" <?php echo $unit_of_measure_view->Unit_of_measure->cellAttributes() ?>>
<span id="el_unit_of_measure_Unit_of_measure">
<span<?php echo $unit_of_measure_view->Unit_of_measure->viewAttributes() ?>><?php echo $unit_of_measure_view->Unit_of_measure->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$unit_of_measure_view->IsModal) { ?>
<?php if (!$unit_of_measure_view->isExport()) { ?>
<?php echo $unit_of_measure_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$unit_of_measure_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$unit_of_measure_view->isExport()) { ?>
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
$unit_of_measure_view->terminate();
?>