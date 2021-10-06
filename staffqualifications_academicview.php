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
$staffqualifications_academic_view = new staffqualifications_academic_view();

// Run the page
$staffqualifications_academic_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffqualifications_academic_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$staffqualifications_academic_view->isExport()) { ?>
<script>
var fstaffqualifications_academicview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fstaffqualifications_academicview = currentForm = new ew.Form("fstaffqualifications_academicview", "view");
	loadjs.done("fstaffqualifications_academicview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$staffqualifications_academic_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $staffqualifications_academic_view->ExportOptions->render("body") ?>
<?php $staffqualifications_academic_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $staffqualifications_academic_view->showPageHeader(); ?>
<?php
$staffqualifications_academic_view->showMessage();
?>
<?php if (!$staffqualifications_academic_view->IsModal) { ?>
<?php if (!$staffqualifications_academic_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffqualifications_academic_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fstaffqualifications_academicview" id="fstaffqualifications_academicview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffqualifications_academic">
<input type="hidden" name="modal" value="<?php echo (int)$staffqualifications_academic_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($staffqualifications_academic_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $staffqualifications_academic_view->TableLeftColumnClass ?>"><span id="elh_staffqualifications_academic_EmployeeID"><?php echo $staffqualifications_academic_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $staffqualifications_academic_view->EmployeeID->cellAttributes() ?>>
<span id="el_staffqualifications_academic_EmployeeID">
<span<?php echo $staffqualifications_academic_view->EmployeeID->viewAttributes() ?>><?php echo $staffqualifications_academic_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffqualifications_academic_view->QualificationLevel->Visible) { // QualificationLevel ?>
	<tr id="r_QualificationLevel">
		<td class="<?php echo $staffqualifications_academic_view->TableLeftColumnClass ?>"><span id="elh_staffqualifications_academic_QualificationLevel"><?php echo $staffqualifications_academic_view->QualificationLevel->caption() ?></span></td>
		<td data-name="QualificationLevel" <?php echo $staffqualifications_academic_view->QualificationLevel->cellAttributes() ?>>
<span id="el_staffqualifications_academic_QualificationLevel">
<span<?php echo $staffqualifications_academic_view->QualificationLevel->viewAttributes() ?>><?php echo $staffqualifications_academic_view->QualificationLevel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffqualifications_academic_view->QualificationRemarks->Visible) { // QualificationRemarks ?>
	<tr id="r_QualificationRemarks">
		<td class="<?php echo $staffqualifications_academic_view->TableLeftColumnClass ?>"><span id="elh_staffqualifications_academic_QualificationRemarks"><?php echo $staffqualifications_academic_view->QualificationRemarks->caption() ?></span></td>
		<td data-name="QualificationRemarks" <?php echo $staffqualifications_academic_view->QualificationRemarks->cellAttributes() ?>>
<span id="el_staffqualifications_academic_QualificationRemarks">
<span<?php echo $staffqualifications_academic_view->QualificationRemarks->viewAttributes() ?>><?php echo $staffqualifications_academic_view->QualificationRemarks->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffqualifications_academic_view->AwardingInstitution->Visible) { // AwardingInstitution ?>
	<tr id="r_AwardingInstitution">
		<td class="<?php echo $staffqualifications_academic_view->TableLeftColumnClass ?>"><span id="elh_staffqualifications_academic_AwardingInstitution"><?php echo $staffqualifications_academic_view->AwardingInstitution->caption() ?></span></td>
		<td data-name="AwardingInstitution" <?php echo $staffqualifications_academic_view->AwardingInstitution->cellAttributes() ?>>
<span id="el_staffqualifications_academic_AwardingInstitution">
<span<?php echo $staffqualifications_academic_view->AwardingInstitution->viewAttributes() ?>><?php echo $staffqualifications_academic_view->AwardingInstitution->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffqualifications_academic_view->FromYear->Visible) { // FromYear ?>
	<tr id="r_FromYear">
		<td class="<?php echo $staffqualifications_academic_view->TableLeftColumnClass ?>"><span id="elh_staffqualifications_academic_FromYear"><?php echo $staffqualifications_academic_view->FromYear->caption() ?></span></td>
		<td data-name="FromYear" <?php echo $staffqualifications_academic_view->FromYear->cellAttributes() ?>>
<span id="el_staffqualifications_academic_FromYear">
<span<?php echo $staffqualifications_academic_view->FromYear->viewAttributes() ?>><?php echo $staffqualifications_academic_view->FromYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffqualifications_academic_view->YearObtained->Visible) { // YearObtained ?>
	<tr id="r_YearObtained">
		<td class="<?php echo $staffqualifications_academic_view->TableLeftColumnClass ?>"><span id="elh_staffqualifications_academic_YearObtained"><?php echo $staffqualifications_academic_view->YearObtained->caption() ?></span></td>
		<td data-name="YearObtained" <?php echo $staffqualifications_academic_view->YearObtained->cellAttributes() ?>>
<span id="el_staffqualifications_academic_YearObtained">
<span<?php echo $staffqualifications_academic_view->YearObtained->viewAttributes() ?>><?php echo $staffqualifications_academic_view->YearObtained->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffqualifications_academic_view->AcademicCertificate->Visible) { // AcademicCertificate ?>
	<tr id="r_AcademicCertificate">
		<td class="<?php echo $staffqualifications_academic_view->TableLeftColumnClass ?>"><span id="elh_staffqualifications_academic_AcademicCertificate"><?php echo $staffqualifications_academic_view->AcademicCertificate->caption() ?></span></td>
		<td data-name="AcademicCertificate" <?php echo $staffqualifications_academic_view->AcademicCertificate->cellAttributes() ?>>
<span id="el_staffqualifications_academic_AcademicCertificate">
<span<?php echo $staffqualifications_academic_view->AcademicCertificate->viewAttributes() ?>><?php echo GetFileViewTag($staffqualifications_academic_view->AcademicCertificate, $staffqualifications_academic_view->AcademicCertificate->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$staffqualifications_academic_view->IsModal) { ?>
<?php if (!$staffqualifications_academic_view->isExport()) { ?>
<?php echo $staffqualifications_academic_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$staffqualifications_academic_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$staffqualifications_academic_view->isExport()) { ?>
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
$staffqualifications_academic_view->terminate();
?>