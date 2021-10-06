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
$condition_view = new condition_view();

// Run the page
$condition_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$condition_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$condition_view->isExport()) { ?>
<script>
var fconditionview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fconditionview = currentForm = new ew.Form("fconditionview", "view");
	loadjs.done("fconditionview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$condition_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $condition_view->ExportOptions->render("body") ?>
<?php $condition_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $condition_view->showPageHeader(); ?>
<?php
$condition_view->showMessage();
?>
<?php if (!$condition_view->IsModal) { ?>
<?php if (!$condition_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $condition_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fconditionview" id="fconditionview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="condition">
<input type="hidden" name="modal" value="<?php echo (int)$condition_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($condition_view->ConditionCode->Visible) { // ConditionCode ?>
	<tr id="r_ConditionCode">
		<td class="<?php echo $condition_view->TableLeftColumnClass ?>"><span id="elh_condition_ConditionCode"><?php echo $condition_view->ConditionCode->caption() ?></span></td>
		<td data-name="ConditionCode" <?php echo $condition_view->ConditionCode->cellAttributes() ?>>
<span id="el_condition_ConditionCode">
<span<?php echo $condition_view->ConditionCode->viewAttributes() ?>><?php echo $condition_view->ConditionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($condition_view->ConditionDesc->Visible) { // ConditionDesc ?>
	<tr id="r_ConditionDesc">
		<td class="<?php echo $condition_view->TableLeftColumnClass ?>"><span id="elh_condition_ConditionDesc"><?php echo $condition_view->ConditionDesc->caption() ?></span></td>
		<td data-name="ConditionDesc" <?php echo $condition_view->ConditionDesc->cellAttributes() ?>>
<span id="el_condition_ConditionDesc">
<span<?php echo $condition_view->ConditionDesc->viewAttributes() ?>><?php echo $condition_view->ConditionDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($condition_view->AcceptableIndicator->Visible) { // AcceptableIndicator ?>
	<tr id="r_AcceptableIndicator">
		<td class="<?php echo $condition_view->TableLeftColumnClass ?>"><span id="elh_condition_AcceptableIndicator"><?php echo $condition_view->AcceptableIndicator->caption() ?></span></td>
		<td data-name="AcceptableIndicator" <?php echo $condition_view->AcceptableIndicator->cellAttributes() ?>>
<span id="el_condition_AcceptableIndicator">
<span<?php echo $condition_view->AcceptableIndicator->viewAttributes() ?>><?php echo $condition_view->AcceptableIndicator->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$condition_view->IsModal) { ?>
<?php if (!$condition_view->isExport()) { ?>
<?php echo $condition_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$condition_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$condition_view->isExport()) { ?>
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
$condition_view->terminate();
?>