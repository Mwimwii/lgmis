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
$output_indicator_delete = new output_indicator_delete();

// Run the page
$output_indicator_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$output_indicator_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var foutput_indicatordelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	foutput_indicatordelete = currentForm = new ew.Form("foutput_indicatordelete", "delete");
	loadjs.done("foutput_indicatordelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $output_indicator_delete->showPageHeader(); ?>
<?php
$output_indicator_delete->showMessage();
?>
<form name="foutput_indicatordelete" id="foutput_indicatordelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="output_indicator">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($output_indicator_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($output_indicator_delete->IndicatorNo->Visible) { // IndicatorNo ?>
		<th class="<?php echo $output_indicator_delete->IndicatorNo->headerCellClass() ?>"><span id="elh_output_indicator_IndicatorNo" class="output_indicator_IndicatorNo"><?php echo $output_indicator_delete->IndicatorNo->caption() ?></span></th>
<?php } ?>
<?php if ($output_indicator_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $output_indicator_delete->LACode->headerCellClass() ?>"><span id="elh_output_indicator_LACode" class="output_indicator_LACode"><?php echo $output_indicator_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($output_indicator_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<th class="<?php echo $output_indicator_delete->DepartmentCode->headerCellClass() ?>"><span id="elh_output_indicator_DepartmentCode" class="output_indicator_DepartmentCode"><?php echo $output_indicator_delete->DepartmentCode->caption() ?></span></th>
<?php } ?>
<?php if ($output_indicator_delete->SectionCode->Visible) { // SectionCode ?>
		<th class="<?php echo $output_indicator_delete->SectionCode->headerCellClass() ?>"><span id="elh_output_indicator_SectionCode" class="output_indicator_SectionCode"><?php echo $output_indicator_delete->SectionCode->caption() ?></span></th>
<?php } ?>
<?php if ($output_indicator_delete->OutputCode->Visible) { // OutputCode ?>
		<th class="<?php echo $output_indicator_delete->OutputCode->headerCellClass() ?>"><span id="elh_output_indicator_OutputCode" class="output_indicator_OutputCode"><?php echo $output_indicator_delete->OutputCode->caption() ?></span></th>
<?php } ?>
<?php if ($output_indicator_delete->OutcomeCode->Visible) { // OutcomeCode ?>
		<th class="<?php echo $output_indicator_delete->OutcomeCode->headerCellClass() ?>"><span id="elh_output_indicator_OutcomeCode" class="output_indicator_OutcomeCode"><?php echo $output_indicator_delete->OutcomeCode->caption() ?></span></th>
<?php } ?>
<?php if ($output_indicator_delete->OutputType->Visible) { // OutputType ?>
		<th class="<?php echo $output_indicator_delete->OutputType->headerCellClass() ?>"><span id="elh_output_indicator_OutputType" class="output_indicator_OutputType"><?php echo $output_indicator_delete->OutputType->caption() ?></span></th>
<?php } ?>
<?php if ($output_indicator_delete->ProgramCode->Visible) { // ProgramCode ?>
		<th class="<?php echo $output_indicator_delete->ProgramCode->headerCellClass() ?>"><span id="elh_output_indicator_ProgramCode" class="output_indicator_ProgramCode"><?php echo $output_indicator_delete->ProgramCode->caption() ?></span></th>
<?php } ?>
<?php if ($output_indicator_delete->SubProgramCode->Visible) { // SubProgramCode ?>
		<th class="<?php echo $output_indicator_delete->SubProgramCode->headerCellClass() ?>"><span id="elh_output_indicator_SubProgramCode" class="output_indicator_SubProgramCode"><?php echo $output_indicator_delete->SubProgramCode->caption() ?></span></th>
<?php } ?>
<?php if ($output_indicator_delete->FinancialYear->Visible) { // FinancialYear ?>
		<th class="<?php echo $output_indicator_delete->FinancialYear->headerCellClass() ?>"><span id="elh_output_indicator_FinancialYear" class="output_indicator_FinancialYear"><?php echo $output_indicator_delete->FinancialYear->caption() ?></span></th>
<?php } ?>
<?php if ($output_indicator_delete->OutputIndicatorName->Visible) { // OutputIndicatorName ?>
		<th class="<?php echo $output_indicator_delete->OutputIndicatorName->headerCellClass() ?>"><span id="elh_output_indicator_OutputIndicatorName" class="output_indicator_OutputIndicatorName"><?php echo $output_indicator_delete->OutputIndicatorName->caption() ?></span></th>
<?php } ?>
<?php if ($output_indicator_delete->TargetAmount->Visible) { // TargetAmount ?>
		<th class="<?php echo $output_indicator_delete->TargetAmount->headerCellClass() ?>"><span id="elh_output_indicator_TargetAmount" class="output_indicator_TargetAmount"><?php echo $output_indicator_delete->TargetAmount->caption() ?></span></th>
<?php } ?>
<?php if ($output_indicator_delete->ActualAmount->Visible) { // ActualAmount ?>
		<th class="<?php echo $output_indicator_delete->ActualAmount->headerCellClass() ?>"><span id="elh_output_indicator_ActualAmount" class="output_indicator_ActualAmount"><?php echo $output_indicator_delete->ActualAmount->caption() ?></span></th>
<?php } ?>
<?php if ($output_indicator_delete->PercentAchieved->Visible) { // PercentAchieved ?>
		<th class="<?php echo $output_indicator_delete->PercentAchieved->headerCellClass() ?>"><span id="elh_output_indicator_PercentAchieved" class="output_indicator_PercentAchieved"><?php echo $output_indicator_delete->PercentAchieved->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$output_indicator_delete->RecordCount = 0;
$i = 0;
while (!$output_indicator_delete->Recordset->EOF) {
	$output_indicator_delete->RecordCount++;
	$output_indicator_delete->RowCount++;

	// Set row properties
	$output_indicator->resetAttributes();
	$output_indicator->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$output_indicator_delete->loadRowValues($output_indicator_delete->Recordset);

	// Render row
	$output_indicator_delete->renderRow();
?>
	<tr <?php echo $output_indicator->rowAttributes() ?>>
<?php if ($output_indicator_delete->IndicatorNo->Visible) { // IndicatorNo ?>
		<td <?php echo $output_indicator_delete->IndicatorNo->cellAttributes() ?>>
<span id="el<?php echo $output_indicator_delete->RowCount ?>_output_indicator_IndicatorNo" class="output_indicator_IndicatorNo">
<span<?php echo $output_indicator_delete->IndicatorNo->viewAttributes() ?>><?php echo $output_indicator_delete->IndicatorNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_indicator_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $output_indicator_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $output_indicator_delete->RowCount ?>_output_indicator_LACode" class="output_indicator_LACode">
<span<?php echo $output_indicator_delete->LACode->viewAttributes() ?>><?php echo $output_indicator_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_indicator_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<td <?php echo $output_indicator_delete->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $output_indicator_delete->RowCount ?>_output_indicator_DepartmentCode" class="output_indicator_DepartmentCode">
<span<?php echo $output_indicator_delete->DepartmentCode->viewAttributes() ?>><?php echo $output_indicator_delete->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_indicator_delete->SectionCode->Visible) { // SectionCode ?>
		<td <?php echo $output_indicator_delete->SectionCode->cellAttributes() ?>>
<span id="el<?php echo $output_indicator_delete->RowCount ?>_output_indicator_SectionCode" class="output_indicator_SectionCode">
<span<?php echo $output_indicator_delete->SectionCode->viewAttributes() ?>><?php echo $output_indicator_delete->SectionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_indicator_delete->OutputCode->Visible) { // OutputCode ?>
		<td <?php echo $output_indicator_delete->OutputCode->cellAttributes() ?>>
<span id="el<?php echo $output_indicator_delete->RowCount ?>_output_indicator_OutputCode" class="output_indicator_OutputCode">
<span<?php echo $output_indicator_delete->OutputCode->viewAttributes() ?>><?php echo $output_indicator_delete->OutputCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_indicator_delete->OutcomeCode->Visible) { // OutcomeCode ?>
		<td <?php echo $output_indicator_delete->OutcomeCode->cellAttributes() ?>>
<span id="el<?php echo $output_indicator_delete->RowCount ?>_output_indicator_OutcomeCode" class="output_indicator_OutcomeCode">
<span<?php echo $output_indicator_delete->OutcomeCode->viewAttributes() ?>><?php echo $output_indicator_delete->OutcomeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_indicator_delete->OutputType->Visible) { // OutputType ?>
		<td <?php echo $output_indicator_delete->OutputType->cellAttributes() ?>>
<span id="el<?php echo $output_indicator_delete->RowCount ?>_output_indicator_OutputType" class="output_indicator_OutputType">
<span<?php echo $output_indicator_delete->OutputType->viewAttributes() ?>><?php echo $output_indicator_delete->OutputType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_indicator_delete->ProgramCode->Visible) { // ProgramCode ?>
		<td <?php echo $output_indicator_delete->ProgramCode->cellAttributes() ?>>
<span id="el<?php echo $output_indicator_delete->RowCount ?>_output_indicator_ProgramCode" class="output_indicator_ProgramCode">
<span<?php echo $output_indicator_delete->ProgramCode->viewAttributes() ?>><?php echo $output_indicator_delete->ProgramCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_indicator_delete->SubProgramCode->Visible) { // SubProgramCode ?>
		<td <?php echo $output_indicator_delete->SubProgramCode->cellAttributes() ?>>
<span id="el<?php echo $output_indicator_delete->RowCount ?>_output_indicator_SubProgramCode" class="output_indicator_SubProgramCode">
<span<?php echo $output_indicator_delete->SubProgramCode->viewAttributes() ?>><?php echo $output_indicator_delete->SubProgramCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_indicator_delete->FinancialYear->Visible) { // FinancialYear ?>
		<td <?php echo $output_indicator_delete->FinancialYear->cellAttributes() ?>>
<span id="el<?php echo $output_indicator_delete->RowCount ?>_output_indicator_FinancialYear" class="output_indicator_FinancialYear">
<span<?php echo $output_indicator_delete->FinancialYear->viewAttributes() ?>><?php echo $output_indicator_delete->FinancialYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_indicator_delete->OutputIndicatorName->Visible) { // OutputIndicatorName ?>
		<td <?php echo $output_indicator_delete->OutputIndicatorName->cellAttributes() ?>>
<span id="el<?php echo $output_indicator_delete->RowCount ?>_output_indicator_OutputIndicatorName" class="output_indicator_OutputIndicatorName">
<span<?php echo $output_indicator_delete->OutputIndicatorName->viewAttributes() ?>><?php echo $output_indicator_delete->OutputIndicatorName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_indicator_delete->TargetAmount->Visible) { // TargetAmount ?>
		<td <?php echo $output_indicator_delete->TargetAmount->cellAttributes() ?>>
<span id="el<?php echo $output_indicator_delete->RowCount ?>_output_indicator_TargetAmount" class="output_indicator_TargetAmount">
<span<?php echo $output_indicator_delete->TargetAmount->viewAttributes() ?>><?php echo $output_indicator_delete->TargetAmount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_indicator_delete->ActualAmount->Visible) { // ActualAmount ?>
		<td <?php echo $output_indicator_delete->ActualAmount->cellAttributes() ?>>
<span id="el<?php echo $output_indicator_delete->RowCount ?>_output_indicator_ActualAmount" class="output_indicator_ActualAmount">
<span<?php echo $output_indicator_delete->ActualAmount->viewAttributes() ?>><?php echo $output_indicator_delete->ActualAmount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output_indicator_delete->PercentAchieved->Visible) { // PercentAchieved ?>
		<td <?php echo $output_indicator_delete->PercentAchieved->cellAttributes() ?>>
<span id="el<?php echo $output_indicator_delete->RowCount ?>_output_indicator_PercentAchieved" class="output_indicator_PercentAchieved">
<span<?php echo $output_indicator_delete->PercentAchieved->viewAttributes() ?>><?php echo $output_indicator_delete->PercentAchieved->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$output_indicator_delete->Recordset->moveNext();
}
$output_indicator_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $output_indicator_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$output_indicator_delete->showPageFooter();
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
$output_indicator_delete->terminate();
?>