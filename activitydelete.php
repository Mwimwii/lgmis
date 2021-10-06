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
$activity_delete = new activity_delete();

// Run the page
$activity_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$activity_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var factivitydelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	factivitydelete = currentForm = new ew.Form("factivitydelete", "delete");
	loadjs.done("factivitydelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $activity_delete->showPageHeader(); ?>
<?php
$activity_delete->showMessage();
?>
<form name="factivitydelete" id="factivitydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="activity">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($activity_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($activity_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $activity_delete->LACode->headerCellClass() ?>"><span id="elh_activity_LACode" class="activity_LACode"><?php echo $activity_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($activity_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<th class="<?php echo $activity_delete->DepartmentCode->headerCellClass() ?>"><span id="elh_activity_DepartmentCode" class="activity_DepartmentCode"><?php echo $activity_delete->DepartmentCode->caption() ?></span></th>
<?php } ?>
<?php if ($activity_delete->SectionCode->Visible) { // SectionCode ?>
		<th class="<?php echo $activity_delete->SectionCode->headerCellClass() ?>"><span id="elh_activity_SectionCode" class="activity_SectionCode"><?php echo $activity_delete->SectionCode->caption() ?></span></th>
<?php } ?>
<?php if ($activity_delete->ProgrammeCode->Visible) { // ProgrammeCode ?>
		<th class="<?php echo $activity_delete->ProgrammeCode->headerCellClass() ?>"><span id="elh_activity_ProgrammeCode" class="activity_ProgrammeCode"><?php echo $activity_delete->ProgrammeCode->caption() ?></span></th>
<?php } ?>
<?php if ($activity_delete->OucomeCode->Visible) { // OucomeCode ?>
		<th class="<?php echo $activity_delete->OucomeCode->headerCellClass() ?>"><span id="elh_activity_OucomeCode" class="activity_OucomeCode"><?php echo $activity_delete->OucomeCode->caption() ?></span></th>
<?php } ?>
<?php if ($activity_delete->OutputCode->Visible) { // OutputCode ?>
		<th class="<?php echo $activity_delete->OutputCode->headerCellClass() ?>"><span id="elh_activity_OutputCode" class="activity_OutputCode"><?php echo $activity_delete->OutputCode->caption() ?></span></th>
<?php } ?>
<?php if ($activity_delete->ProjectCode->Visible) { // ProjectCode ?>
		<th class="<?php echo $activity_delete->ProjectCode->headerCellClass() ?>"><span id="elh_activity_ProjectCode" class="activity_ProjectCode"><?php echo $activity_delete->ProjectCode->caption() ?></span></th>
<?php } ?>
<?php if ($activity_delete->ActivityCode->Visible) { // ActivityCode ?>
		<th class="<?php echo $activity_delete->ActivityCode->headerCellClass() ?>"><span id="elh_activity_ActivityCode" class="activity_ActivityCode"><?php echo $activity_delete->ActivityCode->caption() ?></span></th>
<?php } ?>
<?php if ($activity_delete->FinancialYear->Visible) { // FinancialYear ?>
		<th class="<?php echo $activity_delete->FinancialYear->headerCellClass() ?>"><span id="elh_activity_FinancialYear" class="activity_FinancialYear"><?php echo $activity_delete->FinancialYear->caption() ?></span></th>
<?php } ?>
<?php if ($activity_delete->ActivityName->Visible) { // ActivityName ?>
		<th class="<?php echo $activity_delete->ActivityName->headerCellClass() ?>"><span id="elh_activity_ActivityName" class="activity_ActivityName"><?php echo $activity_delete->ActivityName->caption() ?></span></th>
<?php } ?>
<?php if ($activity_delete->MTEFBudget->Visible) { // MTEFBudget ?>
		<th class="<?php echo $activity_delete->MTEFBudget->headerCellClass() ?>"><span id="elh_activity_MTEFBudget" class="activity_MTEFBudget"><?php echo $activity_delete->MTEFBudget->caption() ?></span></th>
<?php } ?>
<?php if ($activity_delete->SupplementaryBudget->Visible) { // SupplementaryBudget ?>
		<th class="<?php echo $activity_delete->SupplementaryBudget->headerCellClass() ?>"><span id="elh_activity_SupplementaryBudget" class="activity_SupplementaryBudget"><?php echo $activity_delete->SupplementaryBudget->caption() ?></span></th>
<?php } ?>
<?php if ($activity_delete->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
		<th class="<?php echo $activity_delete->ExpectedAnnualAchievement->headerCellClass() ?>"><span id="elh_activity_ExpectedAnnualAchievement" class="activity_ExpectedAnnualAchievement"><?php echo $activity_delete->ExpectedAnnualAchievement->caption() ?></span></th>
<?php } ?>
<?php if ($activity_delete->ActivityLocation->Visible) { // ActivityLocation ?>
		<th class="<?php echo $activity_delete->ActivityLocation->headerCellClass() ?>"><span id="elh_activity_ActivityLocation" class="activity_ActivityLocation"><?php echo $activity_delete->ActivityLocation->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$activity_delete->RecordCount = 0;
$i = 0;
while (!$activity_delete->Recordset->EOF) {
	$activity_delete->RecordCount++;
	$activity_delete->RowCount++;

	// Set row properties
	$activity->resetAttributes();
	$activity->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$activity_delete->loadRowValues($activity_delete->Recordset);

	// Render row
	$activity_delete->renderRow();
?>
	<tr <?php echo $activity->rowAttributes() ?>>
<?php if ($activity_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $activity_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $activity_delete->RowCount ?>_activity_LACode" class="activity_LACode">
<span<?php echo $activity_delete->LACode->viewAttributes() ?>><?php echo $activity_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($activity_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<td <?php echo $activity_delete->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $activity_delete->RowCount ?>_activity_DepartmentCode" class="activity_DepartmentCode">
<span<?php echo $activity_delete->DepartmentCode->viewAttributes() ?>><?php echo $activity_delete->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($activity_delete->SectionCode->Visible) { // SectionCode ?>
		<td <?php echo $activity_delete->SectionCode->cellAttributes() ?>>
<span id="el<?php echo $activity_delete->RowCount ?>_activity_SectionCode" class="activity_SectionCode">
<span<?php echo $activity_delete->SectionCode->viewAttributes() ?>><?php echo $activity_delete->SectionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($activity_delete->ProgrammeCode->Visible) { // ProgrammeCode ?>
		<td <?php echo $activity_delete->ProgrammeCode->cellAttributes() ?>>
<span id="el<?php echo $activity_delete->RowCount ?>_activity_ProgrammeCode" class="activity_ProgrammeCode">
<span<?php echo $activity_delete->ProgrammeCode->viewAttributes() ?>><?php echo $activity_delete->ProgrammeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($activity_delete->OucomeCode->Visible) { // OucomeCode ?>
		<td <?php echo $activity_delete->OucomeCode->cellAttributes() ?>>
<span id="el<?php echo $activity_delete->RowCount ?>_activity_OucomeCode" class="activity_OucomeCode">
<span<?php echo $activity_delete->OucomeCode->viewAttributes() ?>><?php echo $activity_delete->OucomeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($activity_delete->OutputCode->Visible) { // OutputCode ?>
		<td <?php echo $activity_delete->OutputCode->cellAttributes() ?>>
<span id="el<?php echo $activity_delete->RowCount ?>_activity_OutputCode" class="activity_OutputCode">
<span<?php echo $activity_delete->OutputCode->viewAttributes() ?>><?php echo $activity_delete->OutputCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($activity_delete->ProjectCode->Visible) { // ProjectCode ?>
		<td <?php echo $activity_delete->ProjectCode->cellAttributes() ?>>
<span id="el<?php echo $activity_delete->RowCount ?>_activity_ProjectCode" class="activity_ProjectCode">
<span<?php echo $activity_delete->ProjectCode->viewAttributes() ?>><?php echo $activity_delete->ProjectCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($activity_delete->ActivityCode->Visible) { // ActivityCode ?>
		<td <?php echo $activity_delete->ActivityCode->cellAttributes() ?>>
<span id="el<?php echo $activity_delete->RowCount ?>_activity_ActivityCode" class="activity_ActivityCode">
<span<?php echo $activity_delete->ActivityCode->viewAttributes() ?>><?php echo $activity_delete->ActivityCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($activity_delete->FinancialYear->Visible) { // FinancialYear ?>
		<td <?php echo $activity_delete->FinancialYear->cellAttributes() ?>>
<span id="el<?php echo $activity_delete->RowCount ?>_activity_FinancialYear" class="activity_FinancialYear">
<span<?php echo $activity_delete->FinancialYear->viewAttributes() ?>><?php echo $activity_delete->FinancialYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($activity_delete->ActivityName->Visible) { // ActivityName ?>
		<td <?php echo $activity_delete->ActivityName->cellAttributes() ?>>
<span id="el<?php echo $activity_delete->RowCount ?>_activity_ActivityName" class="activity_ActivityName">
<span<?php echo $activity_delete->ActivityName->viewAttributes() ?>><?php echo $activity_delete->ActivityName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($activity_delete->MTEFBudget->Visible) { // MTEFBudget ?>
		<td <?php echo $activity_delete->MTEFBudget->cellAttributes() ?>>
<span id="el<?php echo $activity_delete->RowCount ?>_activity_MTEFBudget" class="activity_MTEFBudget">
<span<?php echo $activity_delete->MTEFBudget->viewAttributes() ?>><?php echo $activity_delete->MTEFBudget->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($activity_delete->SupplementaryBudget->Visible) { // SupplementaryBudget ?>
		<td <?php echo $activity_delete->SupplementaryBudget->cellAttributes() ?>>
<span id="el<?php echo $activity_delete->RowCount ?>_activity_SupplementaryBudget" class="activity_SupplementaryBudget">
<span<?php echo $activity_delete->SupplementaryBudget->viewAttributes() ?>><?php echo $activity_delete->SupplementaryBudget->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($activity_delete->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
		<td <?php echo $activity_delete->ExpectedAnnualAchievement->cellAttributes() ?>>
<span id="el<?php echo $activity_delete->RowCount ?>_activity_ExpectedAnnualAchievement" class="activity_ExpectedAnnualAchievement">
<span<?php echo $activity_delete->ExpectedAnnualAchievement->viewAttributes() ?>><?php echo $activity_delete->ExpectedAnnualAchievement->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($activity_delete->ActivityLocation->Visible) { // ActivityLocation ?>
		<td <?php echo $activity_delete->ActivityLocation->cellAttributes() ?>>
<span id="el<?php echo $activity_delete->RowCount ?>_activity_ActivityLocation" class="activity_ActivityLocation">
<span<?php echo $activity_delete->ActivityLocation->viewAttributes() ?>><?php echo $activity_delete->ActivityLocation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$activity_delete->Recordset->moveNext();
}
$activity_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $activity_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$activity_delete->showPageFooter();
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
$activity_delete->terminate();
?>