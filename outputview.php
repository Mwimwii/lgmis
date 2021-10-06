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
$output_view = new output_view();

// Run the page
$output_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$output_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$output_view->isExport()) { ?>
<script>
var foutputview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	foutputview = currentForm = new ew.Form("foutputview", "view");
	loadjs.done("foutputview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$output_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $output_view->ExportOptions->render("body") ?>
<?php $output_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $output_view->showPageHeader(); ?>
<?php
$output_view->showMessage();
?>
<?php if (!$output_view->IsModal) { ?>
<?php if (!$output_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $output_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="foutputview" id="foutputview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="output">
<input type="hidden" name="modal" value="<?php echo (int)$output_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($output_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $output_view->TableLeftColumnClass ?>"><span id="elh_output_LACode"><?php echo $output_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $output_view->LACode->cellAttributes() ?>>
<span id="el_output_LACode">
<span<?php echo $output_view->LACode->viewAttributes() ?>><?php echo $output_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_view->DepartmentCode->Visible) { // DepartmentCode ?>
	<tr id="r_DepartmentCode">
		<td class="<?php echo $output_view->TableLeftColumnClass ?>"><span id="elh_output_DepartmentCode"><?php echo $output_view->DepartmentCode->caption() ?></span></td>
		<td data-name="DepartmentCode" <?php echo $output_view->DepartmentCode->cellAttributes() ?>>
<span id="el_output_DepartmentCode">
<span<?php echo $output_view->DepartmentCode->viewAttributes() ?>><?php echo $output_view->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_view->SectionCode->Visible) { // SectionCode ?>
	<tr id="r_SectionCode">
		<td class="<?php echo $output_view->TableLeftColumnClass ?>"><span id="elh_output_SectionCode"><?php echo $output_view->SectionCode->caption() ?></span></td>
		<td data-name="SectionCode" <?php echo $output_view->SectionCode->cellAttributes() ?>>
<span id="el_output_SectionCode">
<span<?php echo $output_view->SectionCode->viewAttributes() ?>><?php echo $output_view->SectionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_view->OutcomeCode->Visible) { // OutcomeCode ?>
	<tr id="r_OutcomeCode">
		<td class="<?php echo $output_view->TableLeftColumnClass ?>"><span id="elh_output_OutcomeCode"><?php echo $output_view->OutcomeCode->caption() ?></span></td>
		<td data-name="OutcomeCode" <?php echo $output_view->OutcomeCode->cellAttributes() ?>>
<span id="el_output_OutcomeCode">
<span<?php echo $output_view->OutcomeCode->viewAttributes() ?>><?php echo $output_view->OutcomeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_view->ProgramCode->Visible) { // ProgramCode ?>
	<tr id="r_ProgramCode">
		<td class="<?php echo $output_view->TableLeftColumnClass ?>"><span id="elh_output_ProgramCode"><?php echo $output_view->ProgramCode->caption() ?></span></td>
		<td data-name="ProgramCode" <?php echo $output_view->ProgramCode->cellAttributes() ?>>
<span id="el_output_ProgramCode">
<span<?php echo $output_view->ProgramCode->viewAttributes() ?>><?php echo $output_view->ProgramCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_view->SubProgramCode->Visible) { // SubProgramCode ?>
	<tr id="r_SubProgramCode">
		<td class="<?php echo $output_view->TableLeftColumnClass ?>"><span id="elh_output_SubProgramCode"><?php echo $output_view->SubProgramCode->caption() ?></span></td>
		<td data-name="SubProgramCode" <?php echo $output_view->SubProgramCode->cellAttributes() ?>>
<span id="el_output_SubProgramCode">
<span<?php echo $output_view->SubProgramCode->viewAttributes() ?>><?php echo $output_view->SubProgramCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_view->OutputCode->Visible) { // OutputCode ?>
	<tr id="r_OutputCode">
		<td class="<?php echo $output_view->TableLeftColumnClass ?>"><span id="elh_output_OutputCode"><?php echo $output_view->OutputCode->caption() ?></span></td>
		<td data-name="OutputCode" <?php echo $output_view->OutputCode->cellAttributes() ?>>
<span id="el_output_OutputCode">
<span<?php echo $output_view->OutputCode->viewAttributes() ?>><?php echo $output_view->OutputCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_view->OutputType->Visible) { // OutputType ?>
	<tr id="r_OutputType">
		<td class="<?php echo $output_view->TableLeftColumnClass ?>"><span id="elh_output_OutputType"><?php echo $output_view->OutputType->caption() ?></span></td>
		<td data-name="OutputType" <?php echo $output_view->OutputType->cellAttributes() ?>>
<span id="el_output_OutputType">
<span<?php echo $output_view->OutputType->viewAttributes() ?>><?php echo $output_view->OutputType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_view->OutputName->Visible) { // OutputName ?>
	<tr id="r_OutputName">
		<td class="<?php echo $output_view->TableLeftColumnClass ?>"><span id="elh_output_OutputName"><?php echo $output_view->OutputName->caption() ?></span></td>
		<td data-name="OutputName" <?php echo $output_view->OutputName->cellAttributes() ?>>
<span id="el_output_OutputName">
<span<?php echo $output_view->OutputName->viewAttributes() ?>><?php echo $output_view->OutputName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_view->DeliveryDate->Visible) { // DeliveryDate ?>
	<tr id="r_DeliveryDate">
		<td class="<?php echo $output_view->TableLeftColumnClass ?>"><span id="elh_output_DeliveryDate"><?php echo $output_view->DeliveryDate->caption() ?></span></td>
		<td data-name="DeliveryDate" <?php echo $output_view->DeliveryDate->cellAttributes() ?>>
<span id="el_output_DeliveryDate">
<span<?php echo $output_view->DeliveryDate->viewAttributes() ?>><?php echo $output_view->DeliveryDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_view->FinancialYear->Visible) { // FinancialYear ?>
	<tr id="r_FinancialYear">
		<td class="<?php echo $output_view->TableLeftColumnClass ?>"><span id="elh_output_FinancialYear"><?php echo $output_view->FinancialYear->caption() ?></span></td>
		<td data-name="FinancialYear" <?php echo $output_view->FinancialYear->cellAttributes() ?>>
<span id="el_output_FinancialYear">
<span<?php echo $output_view->FinancialYear->viewAttributes() ?>><?php echo $output_view->FinancialYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_view->OutputDescription->Visible) { // OutputDescription ?>
	<tr id="r_OutputDescription">
		<td class="<?php echo $output_view->TableLeftColumnClass ?>"><span id="elh_output_OutputDescription"><?php echo $output_view->OutputDescription->caption() ?></span></td>
		<td data-name="OutputDescription" <?php echo $output_view->OutputDescription->cellAttributes() ?>>
<span id="el_output_OutputDescription">
<span<?php echo $output_view->OutputDescription->viewAttributes() ?>><?php echo $output_view->OutputDescription->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_view->OutputMeansOfVerification->Visible) { // OutputMeansOfVerification ?>
	<tr id="r_OutputMeansOfVerification">
		<td class="<?php echo $output_view->TableLeftColumnClass ?>"><span id="elh_output_OutputMeansOfVerification"><?php echo $output_view->OutputMeansOfVerification->caption() ?></span></td>
		<td data-name="OutputMeansOfVerification" <?php echo $output_view->OutputMeansOfVerification->cellAttributes() ?>>
<span id="el_output_OutputMeansOfVerification">
<span<?php echo $output_view->OutputMeansOfVerification->viewAttributes() ?>><?php echo $output_view->OutputMeansOfVerification->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_view->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
	<tr id="r_ResponsibleOfficer">
		<td class="<?php echo $output_view->TableLeftColumnClass ?>"><span id="elh_output_ResponsibleOfficer"><?php echo $output_view->ResponsibleOfficer->caption() ?></span></td>
		<td data-name="ResponsibleOfficer" <?php echo $output_view->ResponsibleOfficer->cellAttributes() ?>>
<span id="el_output_ResponsibleOfficer">
<span<?php echo $output_view->ResponsibleOfficer->viewAttributes() ?>><?php echo $output_view->ResponsibleOfficer->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_view->Clients->Visible) { // Clients ?>
	<tr id="r_Clients">
		<td class="<?php echo $output_view->TableLeftColumnClass ?>"><span id="elh_output_Clients"><?php echo $output_view->Clients->caption() ?></span></td>
		<td data-name="Clients" <?php echo $output_view->Clients->cellAttributes() ?>>
<span id="el_output_Clients">
<span<?php echo $output_view->Clients->viewAttributes() ?>><?php echo $output_view->Clients->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_view->Beneficiaries->Visible) { // Beneficiaries ?>
	<tr id="r_Beneficiaries">
		<td class="<?php echo $output_view->TableLeftColumnClass ?>"><span id="elh_output_Beneficiaries"><?php echo $output_view->Beneficiaries->caption() ?></span></td>
		<td data-name="Beneficiaries" <?php echo $output_view->Beneficiaries->cellAttributes() ?>>
<span id="el_output_Beneficiaries">
<span<?php echo $output_view->Beneficiaries->viewAttributes() ?>><?php echo $output_view->Beneficiaries->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_view->OutputStatus->Visible) { // OutputStatus ?>
	<tr id="r_OutputStatus">
		<td class="<?php echo $output_view->TableLeftColumnClass ?>"><span id="elh_output_OutputStatus"><?php echo $output_view->OutputStatus->caption() ?></span></td>
		<td data-name="OutputStatus" <?php echo $output_view->OutputStatus->cellAttributes() ?>>
<span id="el_output_OutputStatus">
<span<?php echo $output_view->OutputStatus->viewAttributes() ?>><?php echo $output_view->OutputStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_view->TargetAmount->Visible) { // TargetAmount ?>
	<tr id="r_TargetAmount">
		<td class="<?php echo $output_view->TableLeftColumnClass ?>"><span id="elh_output_TargetAmount"><?php echo $output_view->TargetAmount->caption() ?></span></td>
		<td data-name="TargetAmount" <?php echo $output_view->TargetAmount->cellAttributes() ?>>
<span id="el_output_TargetAmount">
<span<?php echo $output_view->TargetAmount->viewAttributes() ?>><?php echo $output_view->TargetAmount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_view->ActualAmount->Visible) { // ActualAmount ?>
	<tr id="r_ActualAmount">
		<td class="<?php echo $output_view->TableLeftColumnClass ?>"><span id="elh_output_ActualAmount"><?php echo $output_view->ActualAmount->caption() ?></span></td>
		<td data-name="ActualAmount" <?php echo $output_view->ActualAmount->cellAttributes() ?>>
<span id="el_output_ActualAmount">
<span<?php echo $output_view->ActualAmount->viewAttributes() ?>><?php echo $output_view->ActualAmount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_view->PercentAchieved->Visible) { // PercentAchieved ?>
	<tr id="r_PercentAchieved">
		<td class="<?php echo $output_view->TableLeftColumnClass ?>"><span id="elh_output_PercentAchieved"><?php echo $output_view->PercentAchieved->caption() ?></span></td>
		<td data-name="PercentAchieved" <?php echo $output_view->PercentAchieved->cellAttributes() ?>>
<span id="el_output_PercentAchieved">
<span<?php echo $output_view->PercentAchieved->viewAttributes() ?>><?php echo $output_view->PercentAchieved->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$output_view->IsModal) { ?>
<?php if (!$output_view->isExport()) { ?>
<?php echo $output_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("_action", explode(",", $output->getCurrentDetailTable())) && $_action->DetailView) {
?>
<?php if ($output->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("_action", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $output_view->_action_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "_actiongrid.php" ?>
<?php } ?>
</form>
<?php
$output_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$output_view->isExport()) { ?>
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
$output_view->terminate();
?>