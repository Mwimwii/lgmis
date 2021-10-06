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
$staffqualifications_prof_view = new staffqualifications_prof_view();

// Run the page
$staffqualifications_prof_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffqualifications_prof_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$staffqualifications_prof_view->isExport()) { ?>
<script>
var fstaffqualifications_profview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fstaffqualifications_profview = currentForm = new ew.Form("fstaffqualifications_profview", "view");
	loadjs.done("fstaffqualifications_profview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$staffqualifications_prof_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $staffqualifications_prof_view->ExportOptions->render("body") ?>
<?php $staffqualifications_prof_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $staffqualifications_prof_view->showPageHeader(); ?>
<?php
$staffqualifications_prof_view->showMessage();
?>
<?php if (!$staffqualifications_prof_view->IsModal) { ?>
<?php if (!$staffqualifications_prof_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffqualifications_prof_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fstaffqualifications_profview" id="fstaffqualifications_profview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffqualifications_prof">
<input type="hidden" name="modal" value="<?php echo (int)$staffqualifications_prof_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($staffqualifications_prof_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $staffqualifications_prof_view->TableLeftColumnClass ?>"><span id="elh_staffqualifications_prof_EmployeeID"><?php echo $staffqualifications_prof_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $staffqualifications_prof_view->EmployeeID->cellAttributes() ?>>
<span id="el_staffqualifications_prof_EmployeeID">
<span<?php echo $staffqualifications_prof_view->EmployeeID->viewAttributes() ?>><?php echo $staffqualifications_prof_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffqualifications_prof_view->ProfQualificationLevel->Visible) { // ProfQualificationLevel ?>
	<tr id="r_ProfQualificationLevel">
		<td class="<?php echo $staffqualifications_prof_view->TableLeftColumnClass ?>"><span id="elh_staffqualifications_prof_ProfQualificationLevel"><?php echo $staffqualifications_prof_view->ProfQualificationLevel->caption() ?></span></td>
		<td data-name="ProfQualificationLevel" <?php echo $staffqualifications_prof_view->ProfQualificationLevel->cellAttributes() ?>>
<span id="el_staffqualifications_prof_ProfQualificationLevel">
<span<?php echo $staffqualifications_prof_view->ProfQualificationLevel->viewAttributes() ?>><?php echo $staffqualifications_prof_view->ProfQualificationLevel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffqualifications_prof_view->QualificationCode->Visible) { // QualificationCode ?>
	<tr id="r_QualificationCode">
		<td class="<?php echo $staffqualifications_prof_view->TableLeftColumnClass ?>"><span id="elh_staffqualifications_prof_QualificationCode"><?php echo $staffqualifications_prof_view->QualificationCode->caption() ?></span></td>
		<td data-name="QualificationCode" <?php echo $staffqualifications_prof_view->QualificationCode->cellAttributes() ?>>
<span id="el_staffqualifications_prof_QualificationCode">
<span<?php echo $staffqualifications_prof_view->QualificationCode->viewAttributes() ?>><?php echo $staffqualifications_prof_view->QualificationCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffqualifications_prof_view->QualificationRemarks->Visible) { // QualificationRemarks ?>
	<tr id="r_QualificationRemarks">
		<td class="<?php echo $staffqualifications_prof_view->TableLeftColumnClass ?>"><span id="elh_staffqualifications_prof_QualificationRemarks"><?php echo $staffqualifications_prof_view->QualificationRemarks->caption() ?></span></td>
		<td data-name="QualificationRemarks" <?php echo $staffqualifications_prof_view->QualificationRemarks->cellAttributes() ?>>
<span id="el_staffqualifications_prof_QualificationRemarks">
<span<?php echo $staffqualifications_prof_view->QualificationRemarks->viewAttributes() ?>><?php echo $staffqualifications_prof_view->QualificationRemarks->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffqualifications_prof_view->AwardingInstitution->Visible) { // AwardingInstitution ?>
	<tr id="r_AwardingInstitution">
		<td class="<?php echo $staffqualifications_prof_view->TableLeftColumnClass ?>"><span id="elh_staffqualifications_prof_AwardingInstitution"><?php echo $staffqualifications_prof_view->AwardingInstitution->caption() ?></span></td>
		<td data-name="AwardingInstitution" <?php echo $staffqualifications_prof_view->AwardingInstitution->cellAttributes() ?>>
<span id="el_staffqualifications_prof_AwardingInstitution">
<span<?php echo $staffqualifications_prof_view->AwardingInstitution->viewAttributes() ?>><?php echo $staffqualifications_prof_view->AwardingInstitution->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffqualifications_prof_view->FromYear->Visible) { // FromYear ?>
	<tr id="r_FromYear">
		<td class="<?php echo $staffqualifications_prof_view->TableLeftColumnClass ?>"><span id="elh_staffqualifications_prof_FromYear"><?php echo $staffqualifications_prof_view->FromYear->caption() ?></span></td>
		<td data-name="FromYear" <?php echo $staffqualifications_prof_view->FromYear->cellAttributes() ?>>
<span id="el_staffqualifications_prof_FromYear">
<span<?php echo $staffqualifications_prof_view->FromYear->viewAttributes() ?>><?php echo $staffqualifications_prof_view->FromYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffqualifications_prof_view->YearObtained->Visible) { // YearObtained ?>
	<tr id="r_YearObtained">
		<td class="<?php echo $staffqualifications_prof_view->TableLeftColumnClass ?>"><span id="elh_staffqualifications_prof_YearObtained"><?php echo $staffqualifications_prof_view->YearObtained->caption() ?></span></td>
		<td data-name="YearObtained" <?php echo $staffqualifications_prof_view->YearObtained->cellAttributes() ?>>
<span id="el_staffqualifications_prof_YearObtained">
<span<?php echo $staffqualifications_prof_view->YearObtained->viewAttributes() ?>><?php echo $staffqualifications_prof_view->YearObtained->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffqualifications_prof_view->ProfessionalCertificate->Visible) { // ProfessionalCertificate ?>
	<tr id="r_ProfessionalCertificate">
		<td class="<?php echo $staffqualifications_prof_view->TableLeftColumnClass ?>"><span id="elh_staffqualifications_prof_ProfessionalCertificate"><?php echo $staffqualifications_prof_view->ProfessionalCertificate->caption() ?></span></td>
		<td data-name="ProfessionalCertificate" <?php echo $staffqualifications_prof_view->ProfessionalCertificate->cellAttributes() ?>>
<span id="el_staffqualifications_prof_ProfessionalCertificate">
<span<?php echo $staffqualifications_prof_view->ProfessionalCertificate->viewAttributes() ?>><?php echo GetFileViewTag($staffqualifications_prof_view->ProfessionalCertificate, $staffqualifications_prof_view->ProfessionalCertificate->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$staffqualifications_prof_view->IsModal) { ?>
<?php if (!$staffqualifications_prof_view->isExport()) { ?>
<?php echo $staffqualifications_prof_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$staffqualifications_prof_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$staffqualifications_prof_view->isExport()) { ?>
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
$staffqualifications_prof_view->terminate();
?>