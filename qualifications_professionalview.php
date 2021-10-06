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
$qualifications_professional_view = new qualifications_professional_view();

// Run the page
$qualifications_professional_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$qualifications_professional_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$qualifications_professional_view->isExport()) { ?>
<script>
var fqualifications_professionalview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fqualifications_professionalview = currentForm = new ew.Form("fqualifications_professionalview", "view");
	loadjs.done("fqualifications_professionalview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$qualifications_professional_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $qualifications_professional_view->ExportOptions->render("body") ?>
<?php $qualifications_professional_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $qualifications_professional_view->showPageHeader(); ?>
<?php
$qualifications_professional_view->showMessage();
?>
<?php if (!$qualifications_professional_view->IsModal) { ?>
<?php if (!$qualifications_professional_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $qualifications_professional_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fqualifications_professionalview" id="fqualifications_professionalview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="qualifications_professional">
<input type="hidden" name="modal" value="<?php echo (int)$qualifications_professional_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($qualifications_professional_view->ProfessionalQualifications->Visible) { // ProfessionalQualifications ?>
	<tr id="r_ProfessionalQualifications">
		<td class="<?php echo $qualifications_professional_view->TableLeftColumnClass ?>"><span id="elh_qualifications_professional_ProfessionalQualifications"><?php echo $qualifications_professional_view->ProfessionalQualifications->caption() ?></span></td>
		<td data-name="ProfessionalQualifications" <?php echo $qualifications_professional_view->ProfessionalQualifications->cellAttributes() ?>>
<span id="el_qualifications_professional_ProfessionalQualifications">
<span<?php echo $qualifications_professional_view->ProfessionalQualifications->viewAttributes() ?>><?php echo $qualifications_professional_view->ProfessionalQualifications->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$qualifications_professional_view->IsModal) { ?>
<?php if (!$qualifications_professional_view->isExport()) { ?>
<?php echo $qualifications_professional_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$qualifications_professional_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$qualifications_professional_view->isExport()) { ?>
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
$qualifications_professional_view->terminate();
?>