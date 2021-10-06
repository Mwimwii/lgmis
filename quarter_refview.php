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
$quarter_ref_view = new quarter_ref_view();

// Run the page
$quarter_ref_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$quarter_ref_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$quarter_ref_view->isExport()) { ?>
<script>
var fquarter_refview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fquarter_refview = currentForm = new ew.Form("fquarter_refview", "view");
	loadjs.done("fquarter_refview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$quarter_ref_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $quarter_ref_view->ExportOptions->render("body") ?>
<?php $quarter_ref_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $quarter_ref_view->showPageHeader(); ?>
<?php
$quarter_ref_view->showMessage();
?>
<?php if (!$quarter_ref_view->IsModal) { ?>
<?php if (!$quarter_ref_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $quarter_ref_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fquarter_refview" id="fquarter_refview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="quarter_ref">
<input type="hidden" name="modal" value="<?php echo (int)$quarter_ref_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($quarter_ref_view->Quarter->Visible) { // Quarter ?>
	<tr id="r_Quarter">
		<td class="<?php echo $quarter_ref_view->TableLeftColumnClass ?>"><span id="elh_quarter_ref_Quarter"><?php echo $quarter_ref_view->Quarter->caption() ?></span></td>
		<td data-name="Quarter" <?php echo $quarter_ref_view->Quarter->cellAttributes() ?>>
<span id="el_quarter_ref_Quarter">
<span<?php echo $quarter_ref_view->Quarter->viewAttributes() ?>><?php echo $quarter_ref_view->Quarter->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($quarter_ref_view->BillYear->Visible) { // BillYear ?>
	<tr id="r_BillYear">
		<td class="<?php echo $quarter_ref_view->TableLeftColumnClass ?>"><span id="elh_quarter_ref_BillYear"><?php echo $quarter_ref_view->BillYear->caption() ?></span></td>
		<td data-name="BillYear" <?php echo $quarter_ref_view->BillYear->cellAttributes() ?>>
<span id="el_quarter_ref_BillYear">
<span<?php echo $quarter_ref_view->BillYear->viewAttributes() ?>><?php echo $quarter_ref_view->BillYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($quarter_ref_view->StartDate->Visible) { // StartDate ?>
	<tr id="r_StartDate">
		<td class="<?php echo $quarter_ref_view->TableLeftColumnClass ?>"><span id="elh_quarter_ref_StartDate"><?php echo $quarter_ref_view->StartDate->caption() ?></span></td>
		<td data-name="StartDate" <?php echo $quarter_ref_view->StartDate->cellAttributes() ?>>
<span id="el_quarter_ref_StartDate">
<span<?php echo $quarter_ref_view->StartDate->viewAttributes() ?>><?php echo $quarter_ref_view->StartDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($quarter_ref_view->Enddate->Visible) { // Enddate ?>
	<tr id="r_Enddate">
		<td class="<?php echo $quarter_ref_view->TableLeftColumnClass ?>"><span id="elh_quarter_ref_Enddate"><?php echo $quarter_ref_view->Enddate->caption() ?></span></td>
		<td data-name="Enddate" <?php echo $quarter_ref_view->Enddate->cellAttributes() ?>>
<span id="el_quarter_ref_Enddate">
<span<?php echo $quarter_ref_view->Enddate->viewAttributes() ?>><?php echo $quarter_ref_view->Enddate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$quarter_ref_view->IsModal) { ?>
<?php if (!$quarter_ref_view->isExport()) { ?>
<?php echo $quarter_ref_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$quarter_ref_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$quarter_ref_view->isExport()) { ?>
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
$quarter_ref_view->terminate();
?>