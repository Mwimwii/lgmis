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
$qualificationds_academic_view = new qualificationds_academic_view();

// Run the page
$qualificationds_academic_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$qualificationds_academic_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$qualificationds_academic_view->isExport()) { ?>
<script>
var fqualificationds_academicview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fqualificationds_academicview = currentForm = new ew.Form("fqualificationds_academicview", "view");
	loadjs.done("fqualificationds_academicview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$qualificationds_academic_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $qualificationds_academic_view->ExportOptions->render("body") ?>
<?php $qualificationds_academic_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $qualificationds_academic_view->showPageHeader(); ?>
<?php
$qualificationds_academic_view->showMessage();
?>
<?php if (!$qualificationds_academic_view->IsModal) { ?>
<?php if (!$qualificationds_academic_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $qualificationds_academic_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fqualificationds_academicview" id="fqualificationds_academicview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="qualificationds_academic">
<input type="hidden" name="modal" value="<?php echo (int)$qualificationds_academic_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($qualificationds_academic_view->AcademicQualifications->Visible) { // AcademicQualifications ?>
	<tr id="r_AcademicQualifications">
		<td class="<?php echo $qualificationds_academic_view->TableLeftColumnClass ?>"><span id="elh_qualificationds_academic_AcademicQualifications"><?php echo $qualificationds_academic_view->AcademicQualifications->caption() ?></span></td>
		<td data-name="AcademicQualifications" <?php echo $qualificationds_academic_view->AcademicQualifications->cellAttributes() ?>>
<span id="el_qualificationds_academic_AcademicQualifications">
<span<?php echo $qualificationds_academic_view->AcademicQualifications->viewAttributes() ?>><?php echo $qualificationds_academic_view->AcademicQualifications->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$qualificationds_academic_view->IsModal) { ?>
<?php if (!$qualificationds_academic_view->isExport()) { ?>
<?php echo $qualificationds_academic_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$qualificationds_academic_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$qualificationds_academic_view->isExport()) { ?>
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
$qualificationds_academic_view->terminate();
?>