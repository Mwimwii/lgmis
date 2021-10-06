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
$detailed_action_view = new detailed_action_view();

// Run the page
$detailed_action_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailed_action_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailed_action_view->isExport()) { ?>
<script>
var fdetailed_actionview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdetailed_actionview = currentForm = new ew.Form("fdetailed_actionview", "view");
	loadjs.done("fdetailed_actionview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$detailed_action_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $detailed_action_view->ExportOptions->render("body") ?>
<?php $detailed_action_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $detailed_action_view->showPageHeader(); ?>
<?php
$detailed_action_view->showMessage();
?>
<?php if (!$detailed_action_view->IsModal) { ?>
<?php if (!$detailed_action_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailed_action_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fdetailed_actionview" id="fdetailed_actionview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailed_action">
<input type="hidden" name="modal" value="<?php echo (int)$detailed_action_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($detailed_action_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $detailed_action_view->TableLeftColumnClass ?>"><span id="elh_detailed_action_LACode"><?php echo $detailed_action_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $detailed_action_view->LACode->cellAttributes() ?>>
<span id="el_detailed_action_LACode">
<span<?php echo $detailed_action_view->LACode->viewAttributes() ?>><?php echo $detailed_action_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailed_action_view->DepartmentCode->Visible) { // DepartmentCode ?>
	<tr id="r_DepartmentCode">
		<td class="<?php echo $detailed_action_view->TableLeftColumnClass ?>"><span id="elh_detailed_action_DepartmentCode"><?php echo $detailed_action_view->DepartmentCode->caption() ?></span></td>
		<td data-name="DepartmentCode" <?php echo $detailed_action_view->DepartmentCode->cellAttributes() ?>>
<span id="el_detailed_action_DepartmentCode">
<span<?php echo $detailed_action_view->DepartmentCode->viewAttributes() ?>><?php echo $detailed_action_view->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailed_action_view->SectionCode->Visible) { // SectionCode ?>
	<tr id="r_SectionCode">
		<td class="<?php echo $detailed_action_view->TableLeftColumnClass ?>"><span id="elh_detailed_action_SectionCode"><?php echo $detailed_action_view->SectionCode->caption() ?></span></td>
		<td data-name="SectionCode" <?php echo $detailed_action_view->SectionCode->cellAttributes() ?>>
<span id="el_detailed_action_SectionCode">
<span<?php echo $detailed_action_view->SectionCode->viewAttributes() ?>><?php echo $detailed_action_view->SectionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailed_action_view->ProgramCode->Visible) { // ProgramCode ?>
	<tr id="r_ProgramCode">
		<td class="<?php echo $detailed_action_view->TableLeftColumnClass ?>"><span id="elh_detailed_action_ProgramCode"><?php echo $detailed_action_view->ProgramCode->caption() ?></span></td>
		<td data-name="ProgramCode" <?php echo $detailed_action_view->ProgramCode->cellAttributes() ?>>
<span id="el_detailed_action_ProgramCode">
<span<?php echo $detailed_action_view->ProgramCode->viewAttributes() ?>><?php echo $detailed_action_view->ProgramCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailed_action_view->SubProgramCode->Visible) { // SubProgramCode ?>
	<tr id="r_SubProgramCode">
		<td class="<?php echo $detailed_action_view->TableLeftColumnClass ?>"><span id="elh_detailed_action_SubProgramCode"><?php echo $detailed_action_view->SubProgramCode->caption() ?></span></td>
		<td data-name="SubProgramCode" <?php echo $detailed_action_view->SubProgramCode->cellAttributes() ?>>
<span id="el_detailed_action_SubProgramCode">
<span<?php echo $detailed_action_view->SubProgramCode->viewAttributes() ?>><?php echo $detailed_action_view->SubProgramCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailed_action_view->OutcomeCode->Visible) { // OutcomeCode ?>
	<tr id="r_OutcomeCode">
		<td class="<?php echo $detailed_action_view->TableLeftColumnClass ?>"><span id="elh_detailed_action_OutcomeCode"><?php echo $detailed_action_view->OutcomeCode->caption() ?></span></td>
		<td data-name="OutcomeCode" <?php echo $detailed_action_view->OutcomeCode->cellAttributes() ?>>
<span id="el_detailed_action_OutcomeCode">
<span<?php echo $detailed_action_view->OutcomeCode->viewAttributes() ?>><?php echo $detailed_action_view->OutcomeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailed_action_view->OutputCode->Visible) { // OutputCode ?>
	<tr id="r_OutputCode">
		<td class="<?php echo $detailed_action_view->TableLeftColumnClass ?>"><span id="elh_detailed_action_OutputCode"><?php echo $detailed_action_view->OutputCode->caption() ?></span></td>
		<td data-name="OutputCode" <?php echo $detailed_action_view->OutputCode->cellAttributes() ?>>
<span id="el_detailed_action_OutputCode">
<span<?php echo $detailed_action_view->OutputCode->viewAttributes() ?>><?php echo $detailed_action_view->OutputCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailed_action_view->ActionCode->Visible) { // ActionCode ?>
	<tr id="r_ActionCode">
		<td class="<?php echo $detailed_action_view->TableLeftColumnClass ?>"><span id="elh_detailed_action_ActionCode"><?php echo $detailed_action_view->ActionCode->caption() ?></span></td>
		<td data-name="ActionCode" <?php echo $detailed_action_view->ActionCode->cellAttributes() ?>>
<span id="el_detailed_action_ActionCode">
<span<?php echo $detailed_action_view->ActionCode->viewAttributes() ?>><?php echo $detailed_action_view->ActionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailed_action_view->FinancialYear->Visible) { // FinancialYear ?>
	<tr id="r_FinancialYear">
		<td class="<?php echo $detailed_action_view->TableLeftColumnClass ?>"><span id="elh_detailed_action_FinancialYear"><?php echo $detailed_action_view->FinancialYear->caption() ?></span></td>
		<td data-name="FinancialYear" <?php echo $detailed_action_view->FinancialYear->cellAttributes() ?>>
<span id="el_detailed_action_FinancialYear">
<span<?php echo $detailed_action_view->FinancialYear->viewAttributes() ?>><?php echo $detailed_action_view->FinancialYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailed_action_view->DetailedActionCode->Visible) { // DetailedActionCode ?>
	<tr id="r_DetailedActionCode">
		<td class="<?php echo $detailed_action_view->TableLeftColumnClass ?>"><span id="elh_detailed_action_DetailedActionCode"><?php echo $detailed_action_view->DetailedActionCode->caption() ?></span></td>
		<td data-name="DetailedActionCode" <?php echo $detailed_action_view->DetailedActionCode->cellAttributes() ?>>
<span id="el_detailed_action_DetailedActionCode">
<span<?php echo $detailed_action_view->DetailedActionCode->viewAttributes() ?>><?php echo $detailed_action_view->DetailedActionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailed_action_view->DetailedActionName->Visible) { // DetailedActionName ?>
	<tr id="r_DetailedActionName">
		<td class="<?php echo $detailed_action_view->TableLeftColumnClass ?>"><span id="elh_detailed_action_DetailedActionName"><?php echo $detailed_action_view->DetailedActionName->caption() ?></span></td>
		<td data-name="DetailedActionName" <?php echo $detailed_action_view->DetailedActionName->cellAttributes() ?>>
<span id="el_detailed_action_DetailedActionName">
<span<?php echo $detailed_action_view->DetailedActionName->viewAttributes() ?>><?php echo $detailed_action_view->DetailedActionName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailed_action_view->DetailedActionLocation->Visible) { // DetailedActionLocation ?>
	<tr id="r_DetailedActionLocation">
		<td class="<?php echo $detailed_action_view->TableLeftColumnClass ?>"><span id="elh_detailed_action_DetailedActionLocation"><?php echo $detailed_action_view->DetailedActionLocation->caption() ?></span></td>
		<td data-name="DetailedActionLocation" <?php echo $detailed_action_view->DetailedActionLocation->cellAttributes() ?>>
<span id="el_detailed_action_DetailedActionLocation">
<span<?php echo $detailed_action_view->DetailedActionLocation->viewAttributes() ?>><?php echo $detailed_action_view->DetailedActionLocation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailed_action_view->PlannedStartDate->Visible) { // PlannedStartDate ?>
	<tr id="r_PlannedStartDate">
		<td class="<?php echo $detailed_action_view->TableLeftColumnClass ?>"><span id="elh_detailed_action_PlannedStartDate"><?php echo $detailed_action_view->PlannedStartDate->caption() ?></span></td>
		<td data-name="PlannedStartDate" <?php echo $detailed_action_view->PlannedStartDate->cellAttributes() ?>>
<span id="el_detailed_action_PlannedStartDate">
<span<?php echo $detailed_action_view->PlannedStartDate->viewAttributes() ?>><?php echo $detailed_action_view->PlannedStartDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailed_action_view->PlannedEndDate->Visible) { // PlannedEndDate ?>
	<tr id="r_PlannedEndDate">
		<td class="<?php echo $detailed_action_view->TableLeftColumnClass ?>"><span id="elh_detailed_action_PlannedEndDate"><?php echo $detailed_action_view->PlannedEndDate->caption() ?></span></td>
		<td data-name="PlannedEndDate" <?php echo $detailed_action_view->PlannedEndDate->cellAttributes() ?>>
<span id="el_detailed_action_PlannedEndDate">
<span<?php echo $detailed_action_view->PlannedEndDate->viewAttributes() ?>><?php echo $detailed_action_view->PlannedEndDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailed_action_view->ActualStartDate->Visible) { // ActualStartDate ?>
	<tr id="r_ActualStartDate">
		<td class="<?php echo $detailed_action_view->TableLeftColumnClass ?>"><span id="elh_detailed_action_ActualStartDate"><?php echo $detailed_action_view->ActualStartDate->caption() ?></span></td>
		<td data-name="ActualStartDate" <?php echo $detailed_action_view->ActualStartDate->cellAttributes() ?>>
<span id="el_detailed_action_ActualStartDate">
<span<?php echo $detailed_action_view->ActualStartDate->viewAttributes() ?>><?php echo $detailed_action_view->ActualStartDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailed_action_view->ActualEndDate->Visible) { // ActualEndDate ?>
	<tr id="r_ActualEndDate">
		<td class="<?php echo $detailed_action_view->TableLeftColumnClass ?>"><span id="elh_detailed_action_ActualEndDate"><?php echo $detailed_action_view->ActualEndDate->caption() ?></span></td>
		<td data-name="ActualEndDate" <?php echo $detailed_action_view->ActualEndDate->cellAttributes() ?>>
<span id="el_detailed_action_ActualEndDate">
<span<?php echo $detailed_action_view->ActualEndDate->viewAttributes() ?>><?php echo $detailed_action_view->ActualEndDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailed_action_view->Ward->Visible) { // Ward ?>
	<tr id="r_Ward">
		<td class="<?php echo $detailed_action_view->TableLeftColumnClass ?>"><span id="elh_detailed_action_Ward"><?php echo $detailed_action_view->Ward->caption() ?></span></td>
		<td data-name="Ward" <?php echo $detailed_action_view->Ward->cellAttributes() ?>>
<span id="el_detailed_action_Ward">
<span<?php echo $detailed_action_view->Ward->viewAttributes() ?>><?php echo $detailed_action_view->Ward->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailed_action_view->ExpectedResult->Visible) { // ExpectedResult ?>
	<tr id="r_ExpectedResult">
		<td class="<?php echo $detailed_action_view->TableLeftColumnClass ?>"><span id="elh_detailed_action_ExpectedResult"><?php echo $detailed_action_view->ExpectedResult->caption() ?></span></td>
		<td data-name="ExpectedResult" <?php echo $detailed_action_view->ExpectedResult->cellAttributes() ?>>
<span id="el_detailed_action_ExpectedResult">
<span<?php echo $detailed_action_view->ExpectedResult->viewAttributes() ?>><?php echo $detailed_action_view->ExpectedResult->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailed_action_view->Comments->Visible) { // Comments ?>
	<tr id="r_Comments">
		<td class="<?php echo $detailed_action_view->TableLeftColumnClass ?>"><span id="elh_detailed_action_Comments"><?php echo $detailed_action_view->Comments->caption() ?></span></td>
		<td data-name="Comments" <?php echo $detailed_action_view->Comments->cellAttributes() ?>>
<span id="el_detailed_action_Comments">
<span<?php echo $detailed_action_view->Comments->viewAttributes() ?>><?php echo $detailed_action_view->Comments->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailed_action_view->ProgressStatus->Visible) { // ProgressStatus ?>
	<tr id="r_ProgressStatus">
		<td class="<?php echo $detailed_action_view->TableLeftColumnClass ?>"><span id="elh_detailed_action_ProgressStatus"><?php echo $detailed_action_view->ProgressStatus->caption() ?></span></td>
		<td data-name="ProgressStatus" <?php echo $detailed_action_view->ProgressStatus->cellAttributes() ?>>
<span id="el_detailed_action_ProgressStatus">
<span<?php echo $detailed_action_view->ProgressStatus->viewAttributes() ?>><?php echo $detailed_action_view->ProgressStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$detailed_action_view->IsModal) { ?>
<?php if (!$detailed_action_view->isExport()) { ?>
<?php echo $detailed_action_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("budget", explode(",", $detailed_action->getCurrentDetailTable())) && $budget->DetailView) {
?>
<?php if ($detailed_action->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("budget", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $detailed_action_view->budget_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "budgetgrid.php" ?>
<?php } ?>
</form>
<?php
$detailed_action_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailed_action_view->isExport()) { ?>
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
$detailed_action_view->terminate();
?>