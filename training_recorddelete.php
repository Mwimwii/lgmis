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
$training_record_delete = new training_record_delete();

// Run the page
$training_record_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$training_record_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftraining_recorddelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftraining_recorddelete = currentForm = new ew.Form("ftraining_recorddelete", "delete");
	loadjs.done("ftraining_recorddelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $training_record_delete->showPageHeader(); ?>
<?php
$training_record_delete->showMessage();
?>
<form name="ftraining_recorddelete" id="ftraining_recorddelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="training_record">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($training_record_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($training_record_delete->EmployeeID->Visible) { // EmployeeID ?>
		<th class="<?php echo $training_record_delete->EmployeeID->headerCellClass() ?>"><span id="elh_training_record_EmployeeID" class="training_record_EmployeeID"><?php echo $training_record_delete->EmployeeID->caption() ?></span></th>
<?php } ?>
<?php if ($training_record_delete->FieldOfTraining->Visible) { // FieldOfTraining ?>
		<th class="<?php echo $training_record_delete->FieldOfTraining->headerCellClass() ?>"><span id="elh_training_record_FieldOfTraining" class="training_record_FieldOfTraining"><?php echo $training_record_delete->FieldOfTraining->caption() ?></span></th>
<?php } ?>
<?php if ($training_record_delete->TrainingType->Visible) { // TrainingType ?>
		<th class="<?php echo $training_record_delete->TrainingType->headerCellClass() ?>"><span id="elh_training_record_TrainingType" class="training_record_TrainingType"><?php echo $training_record_delete->TrainingType->caption() ?></span></th>
<?php } ?>
<?php if ($training_record_delete->PlannedStartDate->Visible) { // PlannedStartDate ?>
		<th class="<?php echo $training_record_delete->PlannedStartDate->headerCellClass() ?>"><span id="elh_training_record_PlannedStartDate" class="training_record_PlannedStartDate"><?php echo $training_record_delete->PlannedStartDate->caption() ?></span></th>
<?php } ?>
<?php if ($training_record_delete->PlannedEndDate->Visible) { // PlannedEndDate ?>
		<th class="<?php echo $training_record_delete->PlannedEndDate->headerCellClass() ?>"><span id="elh_training_record_PlannedEndDate" class="training_record_PlannedEndDate"><?php echo $training_record_delete->PlannedEndDate->caption() ?></span></th>
<?php } ?>
<?php if ($training_record_delete->ActualStartDate->Visible) { // ActualStartDate ?>
		<th class="<?php echo $training_record_delete->ActualStartDate->headerCellClass() ?>"><span id="elh_training_record_ActualStartDate" class="training_record_ActualStartDate"><?php echo $training_record_delete->ActualStartDate->caption() ?></span></th>
<?php } ?>
<?php if ($training_record_delete->ActualEnddate->Visible) { // ActualEnddate ?>
		<th class="<?php echo $training_record_delete->ActualEnddate->headerCellClass() ?>"><span id="elh_training_record_ActualEnddate" class="training_record_ActualEnddate"><?php echo $training_record_delete->ActualEnddate->caption() ?></span></th>
<?php } ?>
<?php if ($training_record_delete->QualificationLevelObtained->Visible) { // QualificationLevelObtained ?>
		<th class="<?php echo $training_record_delete->QualificationLevelObtained->headerCellClass() ?>"><span id="elh_training_record_QualificationLevelObtained" class="training_record_QualificationLevelObtained"><?php echo $training_record_delete->QualificationLevelObtained->caption() ?></span></th>
<?php } ?>
<?php if ($training_record_delete->AwardingInstitution->Visible) { // AwardingInstitution ?>
		<th class="<?php echo $training_record_delete->AwardingInstitution->headerCellClass() ?>"><span id="elh_training_record_AwardingInstitution" class="training_record_AwardingInstitution"><?php echo $training_record_delete->AwardingInstitution->caption() ?></span></th>
<?php } ?>
<?php if ($training_record_delete->FundingSource->Visible) { // FundingSource ?>
		<th class="<?php echo $training_record_delete->FundingSource->headerCellClass() ?>"><span id="elh_training_record_FundingSource" class="training_record_FundingSource"><?php echo $training_record_delete->FundingSource->caption() ?></span></th>
<?php } ?>
<?php if ($training_record_delete->TrainingCost->Visible) { // TrainingCost ?>
		<th class="<?php echo $training_record_delete->TrainingCost->headerCellClass() ?>"><span id="elh_training_record_TrainingCost" class="training_record_TrainingCost"><?php echo $training_record_delete->TrainingCost->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$training_record_delete->RecordCount = 0;
$i = 0;
while (!$training_record_delete->Recordset->EOF) {
	$training_record_delete->RecordCount++;
	$training_record_delete->RowCount++;

	// Set row properties
	$training_record->resetAttributes();
	$training_record->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$training_record_delete->loadRowValues($training_record_delete->Recordset);

	// Render row
	$training_record_delete->renderRow();
?>
	<tr <?php echo $training_record->rowAttributes() ?>>
<?php if ($training_record_delete->EmployeeID->Visible) { // EmployeeID ?>
		<td <?php echo $training_record_delete->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $training_record_delete->RowCount ?>_training_record_EmployeeID" class="training_record_EmployeeID">
<span<?php echo $training_record_delete->EmployeeID->viewAttributes() ?>><?php echo $training_record_delete->EmployeeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($training_record_delete->FieldOfTraining->Visible) { // FieldOfTraining ?>
		<td <?php echo $training_record_delete->FieldOfTraining->cellAttributes() ?>>
<span id="el<?php echo $training_record_delete->RowCount ?>_training_record_FieldOfTraining" class="training_record_FieldOfTraining">
<span<?php echo $training_record_delete->FieldOfTraining->viewAttributes() ?>><?php echo $training_record_delete->FieldOfTraining->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($training_record_delete->TrainingType->Visible) { // TrainingType ?>
		<td <?php echo $training_record_delete->TrainingType->cellAttributes() ?>>
<span id="el<?php echo $training_record_delete->RowCount ?>_training_record_TrainingType" class="training_record_TrainingType">
<span<?php echo $training_record_delete->TrainingType->viewAttributes() ?>><?php echo $training_record_delete->TrainingType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($training_record_delete->PlannedStartDate->Visible) { // PlannedStartDate ?>
		<td <?php echo $training_record_delete->PlannedStartDate->cellAttributes() ?>>
<span id="el<?php echo $training_record_delete->RowCount ?>_training_record_PlannedStartDate" class="training_record_PlannedStartDate">
<span<?php echo $training_record_delete->PlannedStartDate->viewAttributes() ?>><?php echo $training_record_delete->PlannedStartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($training_record_delete->PlannedEndDate->Visible) { // PlannedEndDate ?>
		<td <?php echo $training_record_delete->PlannedEndDate->cellAttributes() ?>>
<span id="el<?php echo $training_record_delete->RowCount ?>_training_record_PlannedEndDate" class="training_record_PlannedEndDate">
<span<?php echo $training_record_delete->PlannedEndDate->viewAttributes() ?>><?php echo $training_record_delete->PlannedEndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($training_record_delete->ActualStartDate->Visible) { // ActualStartDate ?>
		<td <?php echo $training_record_delete->ActualStartDate->cellAttributes() ?>>
<span id="el<?php echo $training_record_delete->RowCount ?>_training_record_ActualStartDate" class="training_record_ActualStartDate">
<span<?php echo $training_record_delete->ActualStartDate->viewAttributes() ?>><?php echo $training_record_delete->ActualStartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($training_record_delete->ActualEnddate->Visible) { // ActualEnddate ?>
		<td <?php echo $training_record_delete->ActualEnddate->cellAttributes() ?>>
<span id="el<?php echo $training_record_delete->RowCount ?>_training_record_ActualEnddate" class="training_record_ActualEnddate">
<span<?php echo $training_record_delete->ActualEnddate->viewAttributes() ?>><?php echo $training_record_delete->ActualEnddate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($training_record_delete->QualificationLevelObtained->Visible) { // QualificationLevelObtained ?>
		<td <?php echo $training_record_delete->QualificationLevelObtained->cellAttributes() ?>>
<span id="el<?php echo $training_record_delete->RowCount ?>_training_record_QualificationLevelObtained" class="training_record_QualificationLevelObtained">
<span<?php echo $training_record_delete->QualificationLevelObtained->viewAttributes() ?>><?php echo $training_record_delete->QualificationLevelObtained->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($training_record_delete->AwardingInstitution->Visible) { // AwardingInstitution ?>
		<td <?php echo $training_record_delete->AwardingInstitution->cellAttributes() ?>>
<span id="el<?php echo $training_record_delete->RowCount ?>_training_record_AwardingInstitution" class="training_record_AwardingInstitution">
<span<?php echo $training_record_delete->AwardingInstitution->viewAttributes() ?>><?php echo $training_record_delete->AwardingInstitution->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($training_record_delete->FundingSource->Visible) { // FundingSource ?>
		<td <?php echo $training_record_delete->FundingSource->cellAttributes() ?>>
<span id="el<?php echo $training_record_delete->RowCount ?>_training_record_FundingSource" class="training_record_FundingSource">
<span<?php echo $training_record_delete->FundingSource->viewAttributes() ?>><?php echo $training_record_delete->FundingSource->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($training_record_delete->TrainingCost->Visible) { // TrainingCost ?>
		<td <?php echo $training_record_delete->TrainingCost->cellAttributes() ?>>
<span id="el<?php echo $training_record_delete->RowCount ?>_training_record_TrainingCost" class="training_record_TrainingCost">
<span<?php echo $training_record_delete->TrainingCost->viewAttributes() ?>><?php echo $training_record_delete->TrainingCost->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$training_record_delete->Recordset->moveNext();
}
$training_record_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $training_record_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$training_record_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$training_record_delete->terminate();
?>