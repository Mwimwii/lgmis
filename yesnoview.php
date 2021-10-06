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
$yesno_view = new yesno_view();

// Run the page
$yesno_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$yesno_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$yesno_view->isExport()) { ?>
<script>
var fyesnoview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fyesnoview = currentForm = new ew.Form("fyesnoview", "view");
	loadjs.done("fyesnoview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$yesno_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $yesno_view->ExportOptions->render("body") ?>
<?php $yesno_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $yesno_view->showPageHeader(); ?>
<?php
$yesno_view->showMessage();
?>
<?php if (!$yesno_view->IsModal) { ?>
<?php if (!$yesno_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $yesno_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fyesnoview" id="fyesnoview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="yesno">
<input type="hidden" name="modal" value="<?php echo (int)$yesno_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($yesno_view->ChoiceCode->Visible) { // ChoiceCode ?>
	<tr id="r_ChoiceCode">
		<td class="<?php echo $yesno_view->TableLeftColumnClass ?>"><span id="elh_yesno_ChoiceCode"><?php echo $yesno_view->ChoiceCode->caption() ?></span></td>
		<td data-name="ChoiceCode" <?php echo $yesno_view->ChoiceCode->cellAttributes() ?>>
<span id="el_yesno_ChoiceCode">
<span<?php echo $yesno_view->ChoiceCode->viewAttributes() ?>><?php echo $yesno_view->ChoiceCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($yesno_view->YesNo->Visible) { // YesNo ?>
	<tr id="r_YesNo">
		<td class="<?php echo $yesno_view->TableLeftColumnClass ?>"><span id="elh_yesno_YesNo"><?php echo $yesno_view->YesNo->caption() ?></span></td>
		<td data-name="YesNo" <?php echo $yesno_view->YesNo->cellAttributes() ?>>
<span id="el_yesno_YesNo">
<span<?php echo $yesno_view->YesNo->viewAttributes() ?>><?php echo $yesno_view->YesNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$yesno_view->IsModal) { ?>
<?php if (!$yesno_view->isExport()) { ?>
<?php echo $yesno_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$yesno_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$yesno_view->isExport()) { ?>
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
$yesno_view->terminate();
?>