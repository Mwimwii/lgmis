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
$programme_ref_view = new programme_ref_view();

// Run the page
$programme_ref_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$programme_ref_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$programme_ref_view->isExport()) { ?>
<script>
var fprogramme_refview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fprogramme_refview = currentForm = new ew.Form("fprogramme_refview", "view");
	loadjs.done("fprogramme_refview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$programme_ref_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $programme_ref_view->ExportOptions->render("body") ?>
<?php $programme_ref_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $programme_ref_view->showPageHeader(); ?>
<?php
$programme_ref_view->showMessage();
?>
<?php if (!$programme_ref_view->IsModal) { ?>
<?php if (!$programme_ref_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $programme_ref_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fprogramme_refview" id="fprogramme_refview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="programme_ref">
<input type="hidden" name="modal" value="<?php echo (int)$programme_ref_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($programme_ref_view->ProgRefCode->Visible) { // ProgRefCode ?>
	<tr id="r_ProgRefCode">
		<td class="<?php echo $programme_ref_view->TableLeftColumnClass ?>"><span id="elh_programme_ref_ProgRefCode"><?php echo $programme_ref_view->ProgRefCode->caption() ?></span></td>
		<td data-name="ProgRefCode" <?php echo $programme_ref_view->ProgRefCode->cellAttributes() ?>>
<span id="el_programme_ref_ProgRefCode">
<span<?php echo $programme_ref_view->ProgRefCode->viewAttributes() ?>><?php echo $programme_ref_view->ProgRefCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($programme_ref_view->FunctionCode->Visible) { // FunctionCode ?>
	<tr id="r_FunctionCode">
		<td class="<?php echo $programme_ref_view->TableLeftColumnClass ?>"><span id="elh_programme_ref_FunctionCode"><?php echo $programme_ref_view->FunctionCode->caption() ?></span></td>
		<td data-name="FunctionCode" <?php echo $programme_ref_view->FunctionCode->cellAttributes() ?>>
<span id="el_programme_ref_FunctionCode">
<span<?php echo $programme_ref_view->FunctionCode->viewAttributes() ?>><?php echo $programme_ref_view->FunctionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($programme_ref_view->ProgrammeCode->Visible) { // ProgrammeCode ?>
	<tr id="r_ProgrammeCode">
		<td class="<?php echo $programme_ref_view->TableLeftColumnClass ?>"><span id="elh_programme_ref_ProgrammeCode"><?php echo $programme_ref_view->ProgrammeCode->caption() ?></span></td>
		<td data-name="ProgrammeCode" <?php echo $programme_ref_view->ProgrammeCode->cellAttributes() ?>>
<span id="el_programme_ref_ProgrammeCode">
<span<?php echo $programme_ref_view->ProgrammeCode->viewAttributes() ?>><?php echo $programme_ref_view->ProgrammeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($programme_ref_view->ProgrammeName->Visible) { // ProgrammeName ?>
	<tr id="r_ProgrammeName">
		<td class="<?php echo $programme_ref_view->TableLeftColumnClass ?>"><span id="elh_programme_ref_ProgrammeName"><?php echo $programme_ref_view->ProgrammeName->caption() ?></span></td>
		<td data-name="ProgrammeName" <?php echo $programme_ref_view->ProgrammeName->cellAttributes() ?>>
<span id="el_programme_ref_ProgrammeName">
<span<?php echo $programme_ref_view->ProgrammeName->viewAttributes() ?>><?php echo $programme_ref_view->ProgrammeName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$programme_ref_view->IsModal) { ?>
<?php if (!$programme_ref_view->isExport()) { ?>
<?php echo $programme_ref_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$programme_ref_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$programme_ref_view->isExport()) { ?>
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
$programme_ref_view->terminate();
?>