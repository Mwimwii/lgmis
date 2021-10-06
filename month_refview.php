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
$month_ref_view = new month_ref_view();

// Run the page
$month_ref_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$month_ref_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$month_ref_view->isExport()) { ?>
<script>
var fmonth_refview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fmonth_refview = currentForm = new ew.Form("fmonth_refview", "view");
	loadjs.done("fmonth_refview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$month_ref_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $month_ref_view->ExportOptions->render("body") ?>
<?php $month_ref_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $month_ref_view->showPageHeader(); ?>
<?php
$month_ref_view->showMessage();
?>
<?php if (!$month_ref_view->IsModal) { ?>
<?php if (!$month_ref_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $month_ref_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fmonth_refview" id="fmonth_refview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="month_ref">
<input type="hidden" name="modal" value="<?php echo (int)$month_ref_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($month_ref_view->MonthCode->Visible) { // MonthCode ?>
	<tr id="r_MonthCode">
		<td class="<?php echo $month_ref_view->TableLeftColumnClass ?>"><span id="elh_month_ref_MonthCode"><?php echo $month_ref_view->MonthCode->caption() ?></span></td>
		<td data-name="MonthCode" <?php echo $month_ref_view->MonthCode->cellAttributes() ?>>
<span id="el_month_ref_MonthCode">
<span<?php echo $month_ref_view->MonthCode->viewAttributes() ?>><?php echo $month_ref_view->MonthCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($month_ref_view->MonthName->Visible) { // MonthName ?>
	<tr id="r_MonthName">
		<td class="<?php echo $month_ref_view->TableLeftColumnClass ?>"><span id="elh_month_ref_MonthName"><?php echo $month_ref_view->MonthName->caption() ?></span></td>
		<td data-name="MonthName" <?php echo $month_ref_view->MonthName->cellAttributes() ?>>
<span id="el_month_ref_MonthName">
<span<?php echo $month_ref_view->MonthName->viewAttributes() ?>><?php echo $month_ref_view->MonthName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($month_ref_view->MonthShort->Visible) { // MonthShort ?>
	<tr id="r_MonthShort">
		<td class="<?php echo $month_ref_view->TableLeftColumnClass ?>"><span id="elh_month_ref_MonthShort"><?php echo $month_ref_view->MonthShort->caption() ?></span></td>
		<td data-name="MonthShort" <?php echo $month_ref_view->MonthShort->cellAttributes() ?>>
<span id="el_month_ref_MonthShort">
<span<?php echo $month_ref_view->MonthShort->viewAttributes() ?>><?php echo $month_ref_view->MonthShort->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$month_ref_view->IsModal) { ?>
<?php if (!$month_ref_view->isExport()) { ?>
<?php echo $month_ref_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$month_ref_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$month_ref_view->isExport()) { ?>
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
$month_ref_view->terminate();
?>