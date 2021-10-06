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
$output_indicator_view = new output_indicator_view();

// Run the page
$output_indicator_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$output_indicator_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$output_indicator_view->isExport()) { ?>
<script>
var foutput_indicatorview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	foutput_indicatorview = currentForm = new ew.Form("foutput_indicatorview", "view");
	loadjs.done("foutput_indicatorview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$output_indicator_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $output_indicator_view->ExportOptions->render("body") ?>
<?php $output_indicator_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $output_indicator_view->showPageHeader(); ?>
<?php
$output_indicator_view->showMessage();
?>
<?php if (!$output_indicator_view->IsModal) { ?>
<?php if (!$output_indicator_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $output_indicator_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="foutput_indicatorview" id="foutput_indicatorview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="output_indicator">
<input type="hidden" name="modal" value="<?php echo (int)$output_indicator_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($output_indicator_view->IndicatorNo->Visible) { // IndicatorNo ?>
	<tr id="r_IndicatorNo">
		<td class="<?php echo $output_indicator_view->TableLeftColumnClass ?>"><span id="elh_output_indicator_IndicatorNo"><?php echo $output_indicator_view->IndicatorNo->caption() ?></span></td>
		<td data-name="IndicatorNo" <?php echo $output_indicator_view->IndicatorNo->cellAttributes() ?>>
<span id="el_output_indicator_IndicatorNo">
<span<?php echo $output_indicator_view->IndicatorNo->viewAttributes() ?>><?php echo $output_indicator_view->IndicatorNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_indicator_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $output_indicator_view->TableLeftColumnClass ?>"><span id="elh_output_indicator_LACode"><?php echo $output_indicator_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $output_indicator_view->LACode->cellAttributes() ?>>
<span id="el_output_indicator_LACode">
<span<?php echo $output_indicator_view->LACode->viewAttributes() ?>><?php echo $output_indicator_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_indicator_view->DepartmentCode->Visible) { // DepartmentCode ?>
	<tr id="r_DepartmentCode">
		<td class="<?php echo $output_indicator_view->TableLeftColumnClass ?>"><span id="elh_output_indicator_DepartmentCode"><?php echo $output_indicator_view->DepartmentCode->caption() ?></span></td>
		<td data-name="DepartmentCode" <?php echo $output_indicator_view->DepartmentCode->cellAttributes() ?>>
<span id="el_output_indicator_DepartmentCode">
<span<?php echo $output_indicator_view->DepartmentCode->viewAttributes() ?>><?php echo $output_indicator_view->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_indicator_view->SectionCode->Visible) { // SectionCode ?>
	<tr id="r_SectionCode">
		<td class="<?php echo $output_indicator_view->TableLeftColumnClass ?>"><span id="elh_output_indicator_SectionCode"><?php echo $output_indicator_view->SectionCode->caption() ?></span></td>
		<td data-name="SectionCode" <?php echo $output_indicator_view->SectionCode->cellAttributes() ?>>
<span id="el_output_indicator_SectionCode">
<span<?php echo $output_indicator_view->SectionCode->viewAttributes() ?>><?php echo $output_indicator_view->SectionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_indicator_view->OutputCode->Visible) { // OutputCode ?>
	<tr id="r_OutputCode">
		<td class="<?php echo $output_indicator_view->TableLeftColumnClass ?>"><span id="elh_output_indicator_OutputCode"><?php echo $output_indicator_view->OutputCode->caption() ?></span></td>
		<td data-name="OutputCode" <?php echo $output_indicator_view->OutputCode->cellAttributes() ?>>
<span id="el_output_indicator_OutputCode">
<span<?php echo $output_indicator_view->OutputCode->viewAttributes() ?>><?php echo $output_indicator_view->OutputCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_indicator_view->OutcomeCode->Visible) { // OutcomeCode ?>
	<tr id="r_OutcomeCode">
		<td class="<?php echo $output_indicator_view->TableLeftColumnClass ?>"><span id="elh_output_indicator_OutcomeCode"><?php echo $output_indicator_view->OutcomeCode->caption() ?></span></td>
		<td data-name="OutcomeCode" <?php echo $output_indicator_view->OutcomeCode->cellAttributes() ?>>
<span id="el_output_indicator_OutcomeCode">
<span<?php echo $output_indicator_view->OutcomeCode->viewAttributes() ?>><?php echo $output_indicator_view->OutcomeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_indicator_view->OutputType->Visible) { // OutputType ?>
	<tr id="r_OutputType">
		<td class="<?php echo $output_indicator_view->TableLeftColumnClass ?>"><span id="elh_output_indicator_OutputType"><?php echo $output_indicator_view->OutputType->caption() ?></span></td>
		<td data-name="OutputType" <?php echo $output_indicator_view->OutputType->cellAttributes() ?>>
<span id="el_output_indicator_OutputType">
<span<?php echo $output_indicator_view->OutputType->viewAttributes() ?>><?php echo $output_indicator_view->OutputType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_indicator_view->ProgramCode->Visible) { // ProgramCode ?>
	<tr id="r_ProgramCode">
		<td class="<?php echo $output_indicator_view->TableLeftColumnClass ?>"><span id="elh_output_indicator_ProgramCode"><?php echo $output_indicator_view->ProgramCode->caption() ?></span></td>
		<td data-name="ProgramCode" <?php echo $output_indicator_view->ProgramCode->cellAttributes() ?>>
<span id="el_output_indicator_ProgramCode">
<span<?php echo $output_indicator_view->ProgramCode->viewAttributes() ?>><?php echo $output_indicator_view->ProgramCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_indicator_view->SubProgramCode->Visible) { // SubProgramCode ?>
	<tr id="r_SubProgramCode">
		<td class="<?php echo $output_indicator_view->TableLeftColumnClass ?>"><span id="elh_output_indicator_SubProgramCode"><?php echo $output_indicator_view->SubProgramCode->caption() ?></span></td>
		<td data-name="SubProgramCode" <?php echo $output_indicator_view->SubProgramCode->cellAttributes() ?>>
<span id="el_output_indicator_SubProgramCode">
<span<?php echo $output_indicator_view->SubProgramCode->viewAttributes() ?>><?php echo $output_indicator_view->SubProgramCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_indicator_view->FinancialYear->Visible) { // FinancialYear ?>
	<tr id="r_FinancialYear">
		<td class="<?php echo $output_indicator_view->TableLeftColumnClass ?>"><span id="elh_output_indicator_FinancialYear"><?php echo $output_indicator_view->FinancialYear->caption() ?></span></td>
		<td data-name="FinancialYear" <?php echo $output_indicator_view->FinancialYear->cellAttributes() ?>>
<span id="el_output_indicator_FinancialYear">
<span<?php echo $output_indicator_view->FinancialYear->viewAttributes() ?>><?php echo $output_indicator_view->FinancialYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_indicator_view->OutputIndicatorName->Visible) { // OutputIndicatorName ?>
	<tr id="r_OutputIndicatorName">
		<td class="<?php echo $output_indicator_view->TableLeftColumnClass ?>"><span id="elh_output_indicator_OutputIndicatorName"><?php echo $output_indicator_view->OutputIndicatorName->caption() ?></span></td>
		<td data-name="OutputIndicatorName" <?php echo $output_indicator_view->OutputIndicatorName->cellAttributes() ?>>
<span id="el_output_indicator_OutputIndicatorName">
<span<?php echo $output_indicator_view->OutputIndicatorName->viewAttributes() ?>><?php echo $output_indicator_view->OutputIndicatorName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_indicator_view->TargetAmount->Visible) { // TargetAmount ?>
	<tr id="r_TargetAmount">
		<td class="<?php echo $output_indicator_view->TableLeftColumnClass ?>"><span id="elh_output_indicator_TargetAmount"><?php echo $output_indicator_view->TargetAmount->caption() ?></span></td>
		<td data-name="TargetAmount" <?php echo $output_indicator_view->TargetAmount->cellAttributes() ?>>
<span id="el_output_indicator_TargetAmount">
<span<?php echo $output_indicator_view->TargetAmount->viewAttributes() ?>><?php echo $output_indicator_view->TargetAmount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_indicator_view->ActualAmount->Visible) { // ActualAmount ?>
	<tr id="r_ActualAmount">
		<td class="<?php echo $output_indicator_view->TableLeftColumnClass ?>"><span id="elh_output_indicator_ActualAmount"><?php echo $output_indicator_view->ActualAmount->caption() ?></span></td>
		<td data-name="ActualAmount" <?php echo $output_indicator_view->ActualAmount->cellAttributes() ?>>
<span id="el_output_indicator_ActualAmount">
<span<?php echo $output_indicator_view->ActualAmount->viewAttributes() ?>><?php echo $output_indicator_view->ActualAmount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($output_indicator_view->PercentAchieved->Visible) { // PercentAchieved ?>
	<tr id="r_PercentAchieved">
		<td class="<?php echo $output_indicator_view->TableLeftColumnClass ?>"><span id="elh_output_indicator_PercentAchieved"><?php echo $output_indicator_view->PercentAchieved->caption() ?></span></td>
		<td data-name="PercentAchieved" <?php echo $output_indicator_view->PercentAchieved->cellAttributes() ?>>
<span id="el_output_indicator_PercentAchieved">
<span<?php echo $output_indicator_view->PercentAchieved->viewAttributes() ?>><?php echo $output_indicator_view->PercentAchieved->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$output_indicator_view->IsModal) { ?>
<?php if (!$output_indicator_view->isExport()) { ?>
<?php echo $output_indicator_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$output_indicator_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$output_indicator_view->isExport()) { ?>
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
$output_indicator_view->terminate();
?>