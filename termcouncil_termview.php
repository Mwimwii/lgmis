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
$termcouncil_term_view = new termcouncil_term_view();

// Run the page
$termcouncil_term_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$termcouncil_term_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$termcouncil_term_view->isExport()) { ?>
<script>
var ftermcouncil_termview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftermcouncil_termview = currentForm = new ew.Form("ftermcouncil_termview", "view");
	loadjs.done("ftermcouncil_termview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$termcouncil_term_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $termcouncil_term_view->ExportOptions->render("body") ?>
<?php $termcouncil_term_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $termcouncil_term_view->showPageHeader(); ?>
<?php
$termcouncil_term_view->showMessage();
?>
<?php if (!$termcouncil_term_view->IsModal) { ?>
<?php if (!$termcouncil_term_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $termcouncil_term_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="ftermcouncil_termview" id="ftermcouncil_termview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="termcouncil_term">
<input type="hidden" name="modal" value="<?php echo (int)$termcouncil_term_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($termcouncil_term_view->TermStartYear->Visible) { // TermStartYear ?>
	<tr id="r_TermStartYear">
		<td class="<?php echo $termcouncil_term_view->TableLeftColumnClass ?>"><span id="elh_termcouncil_term_TermStartYear"><?php echo $termcouncil_term_view->TermStartYear->caption() ?></span></td>
		<td data-name="TermStartYear" <?php echo $termcouncil_term_view->TermStartYear->cellAttributes() ?>>
<span id="el_termcouncil_term_TermStartYear">
<span<?php echo $termcouncil_term_view->TermStartYear->viewAttributes() ?>><?php echo $termcouncil_term_view->TermStartYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($termcouncil_term_view->TermYears->Visible) { // TermYears ?>
	<tr id="r_TermYears">
		<td class="<?php echo $termcouncil_term_view->TableLeftColumnClass ?>"><span id="elh_termcouncil_term_TermYears"><?php echo $termcouncil_term_view->TermYears->caption() ?></span></td>
		<td data-name="TermYears" <?php echo $termcouncil_term_view->TermYears->cellAttributes() ?>>
<span id="el_termcouncil_term_TermYears">
<span<?php echo $termcouncil_term_view->TermYears->viewAttributes() ?>><?php echo $termcouncil_term_view->TermYears->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$termcouncil_term_view->IsModal) { ?>
<?php if (!$termcouncil_term_view->isExport()) { ?>
<?php echo $termcouncil_term_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$termcouncil_term_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$termcouncil_term_view->isExport()) { ?>
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
$termcouncil_term_view->terminate();
?>