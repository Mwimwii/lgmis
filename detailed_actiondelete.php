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
$detailed_action_delete = new detailed_action_delete();

// Run the page
$detailed_action_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailed_action_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailed_actiondelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdetailed_actiondelete = currentForm = new ew.Form("fdetailed_actiondelete", "delete");
	loadjs.done("fdetailed_actiondelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailed_action_delete->showPageHeader(); ?>
<?php
$detailed_action_delete->showMessage();
?>
<form name="fdetailed_actiondelete" id="fdetailed_actiondelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailed_action">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($detailed_action_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($detailed_action_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $detailed_action_delete->LACode->headerCellClass() ?>"><span id="elh_detailed_action_LACode" class="detailed_action_LACode"><?php echo $detailed_action_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($detailed_action_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<th class="<?php echo $detailed_action_delete->DepartmentCode->headerCellClass() ?>"><span id="elh_detailed_action_DepartmentCode" class="detailed_action_DepartmentCode"><?php echo $detailed_action_delete->DepartmentCode->caption() ?></span></th>
<?php } ?>
<?php if ($detailed_action_delete->SectionCode->Visible) { // SectionCode ?>
		<th class="<?php echo $detailed_action_delete->SectionCode->headerCellClass() ?>"><span id="elh_detailed_action_SectionCode" class="detailed_action_SectionCode"><?php echo $detailed_action_delete->SectionCode->caption() ?></span></th>
<?php } ?>
<?php if ($detailed_action_delete->ProgramCode->Visible) { // ProgramCode ?>
		<th class="<?php echo $detailed_action_delete->ProgramCode->headerCellClass() ?>"><span id="elh_detailed_action_ProgramCode" class="detailed_action_ProgramCode"><?php echo $detailed_action_delete->ProgramCode->caption() ?></span></th>
<?php } ?>
<?php if ($detailed_action_delete->SubProgramCode->Visible) { // SubProgramCode ?>
		<th class="<?php echo $detailed_action_delete->SubProgramCode->headerCellClass() ?>"><span id="elh_detailed_action_SubProgramCode" class="detailed_action_SubProgramCode"><?php echo $detailed_action_delete->SubProgramCode->caption() ?></span></th>
<?php } ?>
<?php if ($detailed_action_delete->OutcomeCode->Visible) { // OutcomeCode ?>
		<th class="<?php echo $detailed_action_delete->OutcomeCode->headerCellClass() ?>"><span id="elh_detailed_action_OutcomeCode" class="detailed_action_OutcomeCode"><?php echo $detailed_action_delete->OutcomeCode->caption() ?></span></th>
<?php } ?>
<?php if ($detailed_action_delete->OutputCode->Visible) { // OutputCode ?>
		<th class="<?php echo $detailed_action_delete->OutputCode->headerCellClass() ?>"><span id="elh_detailed_action_OutputCode" class="detailed_action_OutputCode"><?php echo $detailed_action_delete->OutputCode->caption() ?></span></th>
<?php } ?>
<?php if ($detailed_action_delete->ActionCode->Visible) { // ActionCode ?>
		<th class="<?php echo $detailed_action_delete->ActionCode->headerCellClass() ?>"><span id="elh_detailed_action_ActionCode" class="detailed_action_ActionCode"><?php echo $detailed_action_delete->ActionCode->caption() ?></span></th>
<?php } ?>
<?php if ($detailed_action_delete->FinancialYear->Visible) { // FinancialYear ?>
		<th class="<?php echo $detailed_action_delete->FinancialYear->headerCellClass() ?>"><span id="elh_detailed_action_FinancialYear" class="detailed_action_FinancialYear"><?php echo $detailed_action_delete->FinancialYear->caption() ?></span></th>
<?php } ?>
<?php if ($detailed_action_delete->DetailedActionCode->Visible) { // DetailedActionCode ?>
		<th class="<?php echo $detailed_action_delete->DetailedActionCode->headerCellClass() ?>"><span id="elh_detailed_action_DetailedActionCode" class="detailed_action_DetailedActionCode"><?php echo $detailed_action_delete->DetailedActionCode->caption() ?></span></th>
<?php } ?>
<?php if ($detailed_action_delete->DetailedActionName->Visible) { // DetailedActionName ?>
		<th class="<?php echo $detailed_action_delete->DetailedActionName->headerCellClass() ?>"><span id="elh_detailed_action_DetailedActionName" class="detailed_action_DetailedActionName"><?php echo $detailed_action_delete->DetailedActionName->caption() ?></span></th>
<?php } ?>
<?php if ($detailed_action_delete->DetailedActionLocation->Visible) { // DetailedActionLocation ?>
		<th class="<?php echo $detailed_action_delete->DetailedActionLocation->headerCellClass() ?>"><span id="elh_detailed_action_DetailedActionLocation" class="detailed_action_DetailedActionLocation"><?php echo $detailed_action_delete->DetailedActionLocation->caption() ?></span></th>
<?php } ?>
<?php if ($detailed_action_delete->PlannedStartDate->Visible) { // PlannedStartDate ?>
		<th class="<?php echo $detailed_action_delete->PlannedStartDate->headerCellClass() ?>"><span id="elh_detailed_action_PlannedStartDate" class="detailed_action_PlannedStartDate"><?php echo $detailed_action_delete->PlannedStartDate->caption() ?></span></th>
<?php } ?>
<?php if ($detailed_action_delete->PlannedEndDate->Visible) { // PlannedEndDate ?>
		<th class="<?php echo $detailed_action_delete->PlannedEndDate->headerCellClass() ?>"><span id="elh_detailed_action_PlannedEndDate" class="detailed_action_PlannedEndDate"><?php echo $detailed_action_delete->PlannedEndDate->caption() ?></span></th>
<?php } ?>
<?php if ($detailed_action_delete->ActualStartDate->Visible) { // ActualStartDate ?>
		<th class="<?php echo $detailed_action_delete->ActualStartDate->headerCellClass() ?>"><span id="elh_detailed_action_ActualStartDate" class="detailed_action_ActualStartDate"><?php echo $detailed_action_delete->ActualStartDate->caption() ?></span></th>
<?php } ?>
<?php if ($detailed_action_delete->ActualEndDate->Visible) { // ActualEndDate ?>
		<th class="<?php echo $detailed_action_delete->ActualEndDate->headerCellClass() ?>"><span id="elh_detailed_action_ActualEndDate" class="detailed_action_ActualEndDate"><?php echo $detailed_action_delete->ActualEndDate->caption() ?></span></th>
<?php } ?>
<?php if ($detailed_action_delete->Ward->Visible) { // Ward ?>
		<th class="<?php echo $detailed_action_delete->Ward->headerCellClass() ?>"><span id="elh_detailed_action_Ward" class="detailed_action_Ward"><?php echo $detailed_action_delete->Ward->caption() ?></span></th>
<?php } ?>
<?php if ($detailed_action_delete->ExpectedResult->Visible) { // ExpectedResult ?>
		<th class="<?php echo $detailed_action_delete->ExpectedResult->headerCellClass() ?>"><span id="elh_detailed_action_ExpectedResult" class="detailed_action_ExpectedResult"><?php echo $detailed_action_delete->ExpectedResult->caption() ?></span></th>
<?php } ?>
<?php if ($detailed_action_delete->Comments->Visible) { // Comments ?>
		<th class="<?php echo $detailed_action_delete->Comments->headerCellClass() ?>"><span id="elh_detailed_action_Comments" class="detailed_action_Comments"><?php echo $detailed_action_delete->Comments->caption() ?></span></th>
<?php } ?>
<?php if ($detailed_action_delete->ProgressStatus->Visible) { // ProgressStatus ?>
		<th class="<?php echo $detailed_action_delete->ProgressStatus->headerCellClass() ?>"><span id="elh_detailed_action_ProgressStatus" class="detailed_action_ProgressStatus"><?php echo $detailed_action_delete->ProgressStatus->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$detailed_action_delete->RecordCount = 0;
$i = 0;
while (!$detailed_action_delete->Recordset->EOF) {
	$detailed_action_delete->RecordCount++;
	$detailed_action_delete->RowCount++;

	// Set row properties
	$detailed_action->resetAttributes();
	$detailed_action->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$detailed_action_delete->loadRowValues($detailed_action_delete->Recordset);

	// Render row
	$detailed_action_delete->renderRow();
?>
	<tr <?php echo $detailed_action->rowAttributes() ?>>
<?php if ($detailed_action_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $detailed_action_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $detailed_action_delete->RowCount ?>_detailed_action_LACode" class="detailed_action_LACode">
<span<?php echo $detailed_action_delete->LACode->viewAttributes() ?>><?php echo $detailed_action_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<td <?php echo $detailed_action_delete->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $detailed_action_delete->RowCount ?>_detailed_action_DepartmentCode" class="detailed_action_DepartmentCode">
<span<?php echo $detailed_action_delete->DepartmentCode->viewAttributes() ?>><?php echo $detailed_action_delete->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action_delete->SectionCode->Visible) { // SectionCode ?>
		<td <?php echo $detailed_action_delete->SectionCode->cellAttributes() ?>>
<span id="el<?php echo $detailed_action_delete->RowCount ?>_detailed_action_SectionCode" class="detailed_action_SectionCode">
<span<?php echo $detailed_action_delete->SectionCode->viewAttributes() ?>><?php echo $detailed_action_delete->SectionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action_delete->ProgramCode->Visible) { // ProgramCode ?>
		<td <?php echo $detailed_action_delete->ProgramCode->cellAttributes() ?>>
<span id="el<?php echo $detailed_action_delete->RowCount ?>_detailed_action_ProgramCode" class="detailed_action_ProgramCode">
<span<?php echo $detailed_action_delete->ProgramCode->viewAttributes() ?>><?php echo $detailed_action_delete->ProgramCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action_delete->SubProgramCode->Visible) { // SubProgramCode ?>
		<td <?php echo $detailed_action_delete->SubProgramCode->cellAttributes() ?>>
<span id="el<?php echo $detailed_action_delete->RowCount ?>_detailed_action_SubProgramCode" class="detailed_action_SubProgramCode">
<span<?php echo $detailed_action_delete->SubProgramCode->viewAttributes() ?>><?php echo $detailed_action_delete->SubProgramCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action_delete->OutcomeCode->Visible) { // OutcomeCode ?>
		<td <?php echo $detailed_action_delete->OutcomeCode->cellAttributes() ?>>
<span id="el<?php echo $detailed_action_delete->RowCount ?>_detailed_action_OutcomeCode" class="detailed_action_OutcomeCode">
<span<?php echo $detailed_action_delete->OutcomeCode->viewAttributes() ?>><?php echo $detailed_action_delete->OutcomeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action_delete->OutputCode->Visible) { // OutputCode ?>
		<td <?php echo $detailed_action_delete->OutputCode->cellAttributes() ?>>
<span id="el<?php echo $detailed_action_delete->RowCount ?>_detailed_action_OutputCode" class="detailed_action_OutputCode">
<span<?php echo $detailed_action_delete->OutputCode->viewAttributes() ?>><?php echo $detailed_action_delete->OutputCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action_delete->ActionCode->Visible) { // ActionCode ?>
		<td <?php echo $detailed_action_delete->ActionCode->cellAttributes() ?>>
<span id="el<?php echo $detailed_action_delete->RowCount ?>_detailed_action_ActionCode" class="detailed_action_ActionCode">
<span<?php echo $detailed_action_delete->ActionCode->viewAttributes() ?>><?php echo $detailed_action_delete->ActionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action_delete->FinancialYear->Visible) { // FinancialYear ?>
		<td <?php echo $detailed_action_delete->FinancialYear->cellAttributes() ?>>
<span id="el<?php echo $detailed_action_delete->RowCount ?>_detailed_action_FinancialYear" class="detailed_action_FinancialYear">
<span<?php echo $detailed_action_delete->FinancialYear->viewAttributes() ?>><?php echo $detailed_action_delete->FinancialYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action_delete->DetailedActionCode->Visible) { // DetailedActionCode ?>
		<td <?php echo $detailed_action_delete->DetailedActionCode->cellAttributes() ?>>
<span id="el<?php echo $detailed_action_delete->RowCount ?>_detailed_action_DetailedActionCode" class="detailed_action_DetailedActionCode">
<span<?php echo $detailed_action_delete->DetailedActionCode->viewAttributes() ?>><?php echo $detailed_action_delete->DetailedActionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action_delete->DetailedActionName->Visible) { // DetailedActionName ?>
		<td <?php echo $detailed_action_delete->DetailedActionName->cellAttributes() ?>>
<span id="el<?php echo $detailed_action_delete->RowCount ?>_detailed_action_DetailedActionName" class="detailed_action_DetailedActionName">
<span<?php echo $detailed_action_delete->DetailedActionName->viewAttributes() ?>><?php echo $detailed_action_delete->DetailedActionName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action_delete->DetailedActionLocation->Visible) { // DetailedActionLocation ?>
		<td <?php echo $detailed_action_delete->DetailedActionLocation->cellAttributes() ?>>
<span id="el<?php echo $detailed_action_delete->RowCount ?>_detailed_action_DetailedActionLocation" class="detailed_action_DetailedActionLocation">
<span<?php echo $detailed_action_delete->DetailedActionLocation->viewAttributes() ?>><?php echo $detailed_action_delete->DetailedActionLocation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action_delete->PlannedStartDate->Visible) { // PlannedStartDate ?>
		<td <?php echo $detailed_action_delete->PlannedStartDate->cellAttributes() ?>>
<span id="el<?php echo $detailed_action_delete->RowCount ?>_detailed_action_PlannedStartDate" class="detailed_action_PlannedStartDate">
<span<?php echo $detailed_action_delete->PlannedStartDate->viewAttributes() ?>><?php echo $detailed_action_delete->PlannedStartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action_delete->PlannedEndDate->Visible) { // PlannedEndDate ?>
		<td <?php echo $detailed_action_delete->PlannedEndDate->cellAttributes() ?>>
<span id="el<?php echo $detailed_action_delete->RowCount ?>_detailed_action_PlannedEndDate" class="detailed_action_PlannedEndDate">
<span<?php echo $detailed_action_delete->PlannedEndDate->viewAttributes() ?>><?php echo $detailed_action_delete->PlannedEndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action_delete->ActualStartDate->Visible) { // ActualStartDate ?>
		<td <?php echo $detailed_action_delete->ActualStartDate->cellAttributes() ?>>
<span id="el<?php echo $detailed_action_delete->RowCount ?>_detailed_action_ActualStartDate" class="detailed_action_ActualStartDate">
<span<?php echo $detailed_action_delete->ActualStartDate->viewAttributes() ?>><?php echo $detailed_action_delete->ActualStartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action_delete->ActualEndDate->Visible) { // ActualEndDate ?>
		<td <?php echo $detailed_action_delete->ActualEndDate->cellAttributes() ?>>
<span id="el<?php echo $detailed_action_delete->RowCount ?>_detailed_action_ActualEndDate" class="detailed_action_ActualEndDate">
<span<?php echo $detailed_action_delete->ActualEndDate->viewAttributes() ?>><?php echo $detailed_action_delete->ActualEndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action_delete->Ward->Visible) { // Ward ?>
		<td <?php echo $detailed_action_delete->Ward->cellAttributes() ?>>
<span id="el<?php echo $detailed_action_delete->RowCount ?>_detailed_action_Ward" class="detailed_action_Ward">
<span<?php echo $detailed_action_delete->Ward->viewAttributes() ?>><?php echo $detailed_action_delete->Ward->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action_delete->ExpectedResult->Visible) { // ExpectedResult ?>
		<td <?php echo $detailed_action_delete->ExpectedResult->cellAttributes() ?>>
<span id="el<?php echo $detailed_action_delete->RowCount ?>_detailed_action_ExpectedResult" class="detailed_action_ExpectedResult">
<span<?php echo $detailed_action_delete->ExpectedResult->viewAttributes() ?>><?php echo $detailed_action_delete->ExpectedResult->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action_delete->Comments->Visible) { // Comments ?>
		<td <?php echo $detailed_action_delete->Comments->cellAttributes() ?>>
<span id="el<?php echo $detailed_action_delete->RowCount ?>_detailed_action_Comments" class="detailed_action_Comments">
<span<?php echo $detailed_action_delete->Comments->viewAttributes() ?>><?php echo $detailed_action_delete->Comments->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action_delete->ProgressStatus->Visible) { // ProgressStatus ?>
		<td <?php echo $detailed_action_delete->ProgressStatus->cellAttributes() ?>>
<span id="el<?php echo $detailed_action_delete->RowCount ?>_detailed_action_ProgressStatus" class="detailed_action_ProgressStatus">
<span<?php echo $detailed_action_delete->ProgressStatus->viewAttributes() ?>><?php echo $detailed_action_delete->ProgressStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$detailed_action_delete->Recordset->moveNext();
}
$detailed_action_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailed_action_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$detailed_action_delete->showPageFooter();
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
$detailed_action_delete->terminate();
?>