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
$allowance_view = new allowance_view();

// Run the page
$allowance_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$allowance_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$allowance_view->isExport()) { ?>
<script>
var fallowanceview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fallowanceview = currentForm = new ew.Form("fallowanceview", "view");
	loadjs.done("fallowanceview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$allowance_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $allowance_view->ExportOptions->render("body") ?>
<?php $allowance_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $allowance_view->showPageHeader(); ?>
<?php
$allowance_view->showMessage();
?>
<?php if (!$allowance_view->IsModal) { ?>
<?php if (!$allowance_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $allowance_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fallowanceview" id="fallowanceview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="allowance">
<input type="hidden" name="modal" value="<?php echo (int)$allowance_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($allowance_view->AllowanceCode->Visible) { // AllowanceCode ?>
	<tr id="r_AllowanceCode">
		<td class="<?php echo $allowance_view->TableLeftColumnClass ?>"><span id="elh_allowance_AllowanceCode"><?php echo $allowance_view->AllowanceCode->caption() ?></span></td>
		<td data-name="AllowanceCode" <?php echo $allowance_view->AllowanceCode->cellAttributes() ?>>
<span id="el_allowance_AllowanceCode">
<span<?php echo $allowance_view->AllowanceCode->viewAttributes() ?>><?php echo $allowance_view->AllowanceCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($allowance_view->AllowanceName->Visible) { // AllowanceName ?>
	<tr id="r_AllowanceName">
		<td class="<?php echo $allowance_view->TableLeftColumnClass ?>"><span id="elh_allowance_AllowanceName"><?php echo $allowance_view->AllowanceName->caption() ?></span></td>
		<td data-name="AllowanceName" <?php echo $allowance_view->AllowanceName->cellAttributes() ?>>
<span id="el_allowance_AllowanceName">
<span<?php echo $allowance_view->AllowanceName->viewAttributes() ?>><?php echo $allowance_view->AllowanceName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($allowance_view->AllowanceAmount->Visible) { // AllowanceAmount ?>
	<tr id="r_AllowanceAmount">
		<td class="<?php echo $allowance_view->TableLeftColumnClass ?>"><span id="elh_allowance_AllowanceAmount"><?php echo $allowance_view->AllowanceAmount->caption() ?></span></td>
		<td data-name="AllowanceAmount" <?php echo $allowance_view->AllowanceAmount->cellAttributes() ?>>
<span id="el_allowance_AllowanceAmount">
<span<?php echo $allowance_view->AllowanceAmount->viewAttributes() ?>><?php echo $allowance_view->AllowanceAmount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$allowance_view->IsModal) { ?>
<?php if (!$allowance_view->isExport()) { ?>
<?php echo $allowance_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$allowance_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$allowance_view->isExport()) { ?>
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
$allowance_view->terminate();
?>