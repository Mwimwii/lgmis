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
$training_record_view = new training_record_view();

// Run the page
$training_record_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$training_record_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$training_record_view->isExport()) { ?>
<script>
var ftraining_recordview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftraining_recordview = currentForm = new ew.Form("ftraining_recordview", "view");
	loadjs.done("ftraining_recordview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$training_record_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $training_record_view->ExportOptions->render("body") ?>
<?php $training_record_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $training_record_view->showPageHeader(); ?>
<?php
$training_record_view->showMessage();
?>
<?php if (!$training_record_view->IsModal) { ?>
<?php if (!$training_record_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $training_record_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="ftraining_recordview" id="ftraining_recordview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="training_record">
<input type="hidden" name="modal" value="<?php echo (int)$training_record_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($training_record_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $training_record_view->TableLeftColumnClass ?>"><span id="elh_training_record_EmployeeID"><?php echo $training_record_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $training_record_view->EmployeeID->cellAttributes() ?>>
<span id="el_training_record_EmployeeID">
<span<?php echo $training_record_view->EmployeeID->viewAttributes() ?>><?php echo $training_record_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($training_record_view->TrainingIndex->Visible) { // TrainingIndex ?>
	<tr id="r_TrainingIndex">
		<td class="<?php echo $training_record_view->TableLeftColumnClass ?>"><span id="elh_training_record_TrainingIndex"><?php echo $training_record_view->TrainingIndex->caption() ?></span></td>
		<td data-name="TrainingIndex" <?php echo $training_record_view->TrainingIndex->cellAttributes() ?>>
<span id="el_training_record_TrainingIndex">
<span<?php echo $training_record_view->TrainingIndex->viewAttributes() ?>><?php echo $training_record_view->TrainingIndex->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($training_record_view->FieldOfTraining->Visible) { // FieldOfTraining ?>
	<tr id="r_FieldOfTraining">
		<td class="<?php echo $training_record_view->TableLeftColumnClass ?>"><span id="elh_training_record_FieldOfTraining"><?php echo $training_record_view->FieldOfTraining->caption() ?></span></td>
		<td data-name="FieldOfTraining" <?php echo $training_record_view->FieldOfTraining->cellAttributes() ?>>
<span id="el_training_record_FieldOfTraining">
<span<?php echo $training_record_view->FieldOfTraining->viewAttributes() ?>><?php echo $training_record_view->FieldOfTraining->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($training_record_view->TrainingType->Visible) { // TrainingType ?>
	<tr id="r_TrainingType">
		<td class="<?php echo $training_record_view->TableLeftColumnClass ?>"><span id="elh_training_record_TrainingType"><?php echo $training_record_view->TrainingType->caption() ?></span></td>
		<td data-name="TrainingType" <?php echo $training_record_view->TrainingType->cellAttributes() ?>>
<span id="el_training_record_TrainingType">
<span<?php echo $training_record_view->TrainingType->viewAttributes() ?>><?php echo $training_record_view->TrainingType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($training_record_view->PlannedStartDate->Visible) { // PlannedStartDate ?>
	<tr id="r_PlannedStartDate">
		<td class="<?php echo $training_record_view->TableLeftColumnClass ?>"><span id="elh_training_record_PlannedStartDate"><?php echo $training_record_view->PlannedStartDate->caption() ?></span></td>
		<td data-name="PlannedStartDate" <?php echo $training_record_view->PlannedStartDate->cellAttributes() ?>>
<span id="el_training_record_PlannedStartDate">
<span<?php echo $training_record_view->PlannedStartDate->viewAttributes() ?>><?php echo $training_record_view->PlannedStartDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($training_record_view->PlannedEndDate->Visible) { // PlannedEndDate ?>
	<tr id="r_PlannedEndDate">
		<td class="<?php echo $training_record_view->TableLeftColumnClass ?>"><span id="elh_training_record_PlannedEndDate"><?php echo $training_record_view->PlannedEndDate->caption() ?></span></td>
		<td data-name="PlannedEndDate" <?php echo $training_record_view->PlannedEndDate->cellAttributes() ?>>
<span id="el_training_record_PlannedEndDate">
<span<?php echo $training_record_view->PlannedEndDate->viewAttributes() ?>><?php echo $training_record_view->PlannedEndDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($training_record_view->ActualStartDate->Visible) { // ActualStartDate ?>
	<tr id="r_ActualStartDate">
		<td class="<?php echo $training_record_view->TableLeftColumnClass ?>"><span id="elh_training_record_ActualStartDate"><?php echo $training_record_view->ActualStartDate->caption() ?></span></td>
		<td data-name="ActualStartDate" <?php echo $training_record_view->ActualStartDate->cellAttributes() ?>>
<span id="el_training_record_ActualStartDate">
<span<?php echo $training_record_view->ActualStartDate->viewAttributes() ?>><?php echo $training_record_view->ActualStartDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($training_record_view->ActualEnddate->Visible) { // ActualEnddate ?>
	<tr id="r_ActualEnddate">
		<td class="<?php echo $training_record_view->TableLeftColumnClass ?>"><span id="elh_training_record_ActualEnddate"><?php echo $training_record_view->ActualEnddate->caption() ?></span></td>
		<td data-name="ActualEnddate" <?php echo $training_record_view->ActualEnddate->cellAttributes() ?>>
<span id="el_training_record_ActualEnddate">
<span<?php echo $training_record_view->ActualEnddate->viewAttributes() ?>><?php echo $training_record_view->ActualEnddate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($training_record_view->QualificationLevelObtained->Visible) { // QualificationLevelObtained ?>
	<tr id="r_QualificationLevelObtained">
		<td class="<?php echo $training_record_view->TableLeftColumnClass ?>"><span id="elh_training_record_QualificationLevelObtained"><?php echo $training_record_view->QualificationLevelObtained->caption() ?></span></td>
		<td data-name="QualificationLevelObtained" <?php echo $training_record_view->QualificationLevelObtained->cellAttributes() ?>>
<span id="el_training_record_QualificationLevelObtained">
<span<?php echo $training_record_view->QualificationLevelObtained->viewAttributes() ?>><?php echo $training_record_view->QualificationLevelObtained->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($training_record_view->AwardingInstitution->Visible) { // AwardingInstitution ?>
	<tr id="r_AwardingInstitution">
		<td class="<?php echo $training_record_view->TableLeftColumnClass ?>"><span id="elh_training_record_AwardingInstitution"><?php echo $training_record_view->AwardingInstitution->caption() ?></span></td>
		<td data-name="AwardingInstitution" <?php echo $training_record_view->AwardingInstitution->cellAttributes() ?>>
<span id="el_training_record_AwardingInstitution">
<span<?php echo $training_record_view->AwardingInstitution->viewAttributes() ?>><?php echo $training_record_view->AwardingInstitution->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($training_record_view->Certificate->Visible) { // Certificate ?>
	<tr id="r_Certificate">
		<td class="<?php echo $training_record_view->TableLeftColumnClass ?>"><span id="elh_training_record_Certificate"><?php echo $training_record_view->Certificate->caption() ?></span></td>
		<td data-name="Certificate" <?php echo $training_record_view->Certificate->cellAttributes() ?>>
<span id="el_training_record_Certificate">
<span<?php echo $training_record_view->Certificate->viewAttributes() ?>><?php echo GetFileViewTag($training_record_view->Certificate, $training_record_view->Certificate->getViewValue(), FALSE) ?><div id="tt_training_record_x_Certificate" class="d-none">
<?php echo $training_record_view->Certificate->TooltipValue ?>
</div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($training_record_view->FundingSource->Visible) { // FundingSource ?>
	<tr id="r_FundingSource">
		<td class="<?php echo $training_record_view->TableLeftColumnClass ?>"><span id="elh_training_record_FundingSource"><?php echo $training_record_view->FundingSource->caption() ?></span></td>
		<td data-name="FundingSource" <?php echo $training_record_view->FundingSource->cellAttributes() ?>>
<span id="el_training_record_FundingSource">
<span<?php echo $training_record_view->FundingSource->viewAttributes() ?>><?php echo $training_record_view->FundingSource->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($training_record_view->TrainingCost->Visible) { // TrainingCost ?>
	<tr id="r_TrainingCost">
		<td class="<?php echo $training_record_view->TableLeftColumnClass ?>"><span id="elh_training_record_TrainingCost"><?php echo $training_record_view->TrainingCost->caption() ?></span></td>
		<td data-name="TrainingCost" <?php echo $training_record_view->TrainingCost->cellAttributes() ?>>
<span id="el_training_record_TrainingCost">
<span<?php echo $training_record_view->TrainingCost->viewAttributes() ?>><?php echo $training_record_view->TrainingCost->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$training_record_view->IsModal) { ?>
<?php if (!$training_record_view->isExport()) { ?>
<?php echo $training_record_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$training_record_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$training_record_view->isExport()) { ?>
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
$training_record_view->terminate();
?>