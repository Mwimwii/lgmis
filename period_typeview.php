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
$period_type_view = new period_type_view();

// Run the page
$period_type_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$period_type_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$period_type_view->isExport()) { ?>
<script>
var fperiod_typeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fperiod_typeview = currentForm = new ew.Form("fperiod_typeview", "view");
	loadjs.done("fperiod_typeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$period_type_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $period_type_view->ExportOptions->render("body") ?>
<?php $period_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $period_type_view->showPageHeader(); ?>
<?php
$period_type_view->showMessage();
?>
<?php if (!$period_type_view->IsModal) { ?>
<?php if (!$period_type_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $period_type_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fperiod_typeview" id="fperiod_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="period_type">
<input type="hidden" name="modal" value="<?php echo (int)$period_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($period_type_view->Period_Type->Visible) { // Period_Type ?>
	<tr id="r_Period_Type">
		<td class="<?php echo $period_type_view->TableLeftColumnClass ?>"><span id="elh_period_type_Period_Type"><?php echo $period_type_view->Period_Type->caption() ?></span></td>
		<td data-name="Period_Type" <?php echo $period_type_view->Period_Type->cellAttributes() ?>>
<span id="el_period_type_Period_Type">
<span<?php echo $period_type_view->Period_Type->viewAttributes() ?>><?php echo $period_type_view->Period_Type->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($period_type_view->PeriodTypeName->Visible) { // PeriodTypeName ?>
	<tr id="r_PeriodTypeName">
		<td class="<?php echo $period_type_view->TableLeftColumnClass ?>"><span id="elh_period_type_PeriodTypeName"><?php echo $period_type_view->PeriodTypeName->caption() ?></span></td>
		<td data-name="PeriodTypeName" <?php echo $period_type_view->PeriodTypeName->cellAttributes() ?>>
<span id="el_period_type_PeriodTypeName">
<span<?php echo $period_type_view->PeriodTypeName->viewAttributes() ?>><?php echo $period_type_view->PeriodTypeName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($period_type_view->PeriodLength->Visible) { // PeriodLength ?>
	<tr id="r_PeriodLength">
		<td class="<?php echo $period_type_view->TableLeftColumnClass ?>"><span id="elh_period_type_PeriodLength"><?php echo $period_type_view->PeriodLength->caption() ?></span></td>
		<td data-name="PeriodLength" <?php echo $period_type_view->PeriodLength->cellAttributes() ?>>
<span id="el_period_type_PeriodLength">
<span<?php echo $period_type_view->PeriodLength->viewAttributes() ?>><?php echo $period_type_view->PeriodLength->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($period_type_view->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<tr id="r_UnitOfMeasure">
		<td class="<?php echo $period_type_view->TableLeftColumnClass ?>"><span id="elh_period_type_UnitOfMeasure"><?php echo $period_type_view->UnitOfMeasure->caption() ?></span></td>
		<td data-name="UnitOfMeasure" <?php echo $period_type_view->UnitOfMeasure->cellAttributes() ?>>
<span id="el_period_type_UnitOfMeasure">
<span<?php echo $period_type_view->UnitOfMeasure->viewAttributes() ?>><?php echo $period_type_view->UnitOfMeasure->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$period_type_view->IsModal) { ?>
<?php if (!$period_type_view->isExport()) { ?>
<?php echo $period_type_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$period_type_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$period_type_view->isExport()) { ?>
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
$period_type_view->terminate();
?>