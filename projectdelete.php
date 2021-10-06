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
$project_delete = new project_delete();

// Run the page
$project_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$project_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fprojectdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fprojectdelete = currentForm = new ew.Form("fprojectdelete", "delete");
	loadjs.done("fprojectdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $project_delete->showPageHeader(); ?>
<?php
$project_delete->showMessage();
?>
<form name="fprojectdelete" id="fprojectdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="project">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($project_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($project_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<th class="<?php echo $project_delete->ProvinceCode->headerCellClass() ?>"><span id="elh_project_ProvinceCode" class="project_ProvinceCode"><?php echo $project_delete->ProvinceCode->caption() ?></span></th>
<?php } ?>
<?php if ($project_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $project_delete->LACode->headerCellClass() ?>"><span id="elh_project_LACode" class="project_LACode"><?php echo $project_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($project_delete->ProjectCode->Visible) { // ProjectCode ?>
		<th class="<?php echo $project_delete->ProjectCode->headerCellClass() ?>"><span id="elh_project_ProjectCode" class="project_ProjectCode"><?php echo $project_delete->ProjectCode->caption() ?></span></th>
<?php } ?>
<?php if ($project_delete->ProjectName->Visible) { // ProjectName ?>
		<th class="<?php echo $project_delete->ProjectName->headerCellClass() ?>"><span id="elh_project_ProjectName" class="project_ProjectName"><?php echo $project_delete->ProjectName->caption() ?></span></th>
<?php } ?>
<?php if ($project_delete->ProjectType->Visible) { // ProjectType ?>
		<th class="<?php echo $project_delete->ProjectType->headerCellClass() ?>"><span id="elh_project_ProjectType" class="project_ProjectType"><?php echo $project_delete->ProjectType->caption() ?></span></th>
<?php } ?>
<?php if ($project_delete->ProjectSector->Visible) { // ProjectSector ?>
		<th class="<?php echo $project_delete->ProjectSector->headerCellClass() ?>"><span id="elh_project_ProjectSector" class="project_ProjectSector"><?php echo $project_delete->ProjectSector->caption() ?></span></th>
<?php } ?>
<?php if ($project_delete->Contractors->Visible) { // Contractors ?>
		<th class="<?php echo $project_delete->Contractors->headerCellClass() ?>"><span id="elh_project_Contractors" class="project_Contractors"><?php echo $project_delete->Contractors->caption() ?></span></th>
<?php } ?>
<?php if ($project_delete->PlannedStartDate->Visible) { // PlannedStartDate ?>
		<th class="<?php echo $project_delete->PlannedStartDate->headerCellClass() ?>"><span id="elh_project_PlannedStartDate" class="project_PlannedStartDate"><?php echo $project_delete->PlannedStartDate->caption() ?></span></th>
<?php } ?>
<?php if ($project_delete->PlannedEndDate->Visible) { // PlannedEndDate ?>
		<th class="<?php echo $project_delete->PlannedEndDate->headerCellClass() ?>"><span id="elh_project_PlannedEndDate" class="project_PlannedEndDate"><?php echo $project_delete->PlannedEndDate->caption() ?></span></th>
<?php } ?>
<?php if ($project_delete->ActualStartDate->Visible) { // ActualStartDate ?>
		<th class="<?php echo $project_delete->ActualStartDate->headerCellClass() ?>"><span id="elh_project_ActualStartDate" class="project_ActualStartDate"><?php echo $project_delete->ActualStartDate->caption() ?></span></th>
<?php } ?>
<?php if ($project_delete->ActualEndDate->Visible) { // ActualEndDate ?>
		<th class="<?php echo $project_delete->ActualEndDate->headerCellClass() ?>"><span id="elh_project_ActualEndDate" class="project_ActualEndDate"><?php echo $project_delete->ActualEndDate->caption() ?></span></th>
<?php } ?>
<?php if ($project_delete->Budget->Visible) { // Budget ?>
		<th class="<?php echo $project_delete->Budget->headerCellClass() ?>"><span id="elh_project_Budget" class="project_Budget"><?php echo $project_delete->Budget->caption() ?></span></th>
<?php } ?>
<?php if ($project_delete->ProgressStatus->Visible) { // ProgressStatus ?>
		<th class="<?php echo $project_delete->ProgressStatus->headerCellClass() ?>"><span id="elh_project_ProgressStatus" class="project_ProgressStatus"><?php echo $project_delete->ProgressStatus->caption() ?></span></th>
<?php } ?>
<?php if ($project_delete->OutstandingTasks->Visible) { // OutstandingTasks ?>
		<th class="<?php echo $project_delete->OutstandingTasks->headerCellClass() ?>"><span id="elh_project_OutstandingTasks" class="project_OutstandingTasks"><?php echo $project_delete->OutstandingTasks->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$project_delete->RecordCount = 0;
$i = 0;
while (!$project_delete->Recordset->EOF) {
	$project_delete->RecordCount++;
	$project_delete->RowCount++;

	// Set row properties
	$project->resetAttributes();
	$project->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$project_delete->loadRowValues($project_delete->Recordset);

	// Render row
	$project_delete->renderRow();
?>
	<tr <?php echo $project->rowAttributes() ?>>
<?php if ($project_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<td <?php echo $project_delete->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $project_delete->RowCount ?>_project_ProvinceCode" class="project_ProvinceCode">
<span<?php echo $project_delete->ProvinceCode->viewAttributes() ?>><?php echo $project_delete->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $project_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $project_delete->RowCount ?>_project_LACode" class="project_LACode">
<span<?php echo $project_delete->LACode->viewAttributes() ?>><?php echo $project_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project_delete->ProjectCode->Visible) { // ProjectCode ?>
		<td <?php echo $project_delete->ProjectCode->cellAttributes() ?>>
<span id="el<?php echo $project_delete->RowCount ?>_project_ProjectCode" class="project_ProjectCode">
<span<?php echo $project_delete->ProjectCode->viewAttributes() ?>><?php echo $project_delete->ProjectCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project_delete->ProjectName->Visible) { // ProjectName ?>
		<td <?php echo $project_delete->ProjectName->cellAttributes() ?>>
<span id="el<?php echo $project_delete->RowCount ?>_project_ProjectName" class="project_ProjectName">
<span<?php echo $project_delete->ProjectName->viewAttributes() ?>><?php echo $project_delete->ProjectName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project_delete->ProjectType->Visible) { // ProjectType ?>
		<td <?php echo $project_delete->ProjectType->cellAttributes() ?>>
<span id="el<?php echo $project_delete->RowCount ?>_project_ProjectType" class="project_ProjectType">
<span<?php echo $project_delete->ProjectType->viewAttributes() ?>><?php echo $project_delete->ProjectType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project_delete->ProjectSector->Visible) { // ProjectSector ?>
		<td <?php echo $project_delete->ProjectSector->cellAttributes() ?>>
<span id="el<?php echo $project_delete->RowCount ?>_project_ProjectSector" class="project_ProjectSector">
<span<?php echo $project_delete->ProjectSector->viewAttributes() ?>><?php echo $project_delete->ProjectSector->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project_delete->Contractors->Visible) { // Contractors ?>
		<td <?php echo $project_delete->Contractors->cellAttributes() ?>>
<span id="el<?php echo $project_delete->RowCount ?>_project_Contractors" class="project_Contractors">
<span<?php echo $project_delete->Contractors->viewAttributes() ?>><?php echo $project_delete->Contractors->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project_delete->PlannedStartDate->Visible) { // PlannedStartDate ?>
		<td <?php echo $project_delete->PlannedStartDate->cellAttributes() ?>>
<span id="el<?php echo $project_delete->RowCount ?>_project_PlannedStartDate" class="project_PlannedStartDate">
<span<?php echo $project_delete->PlannedStartDate->viewAttributes() ?>><?php echo $project_delete->PlannedStartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project_delete->PlannedEndDate->Visible) { // PlannedEndDate ?>
		<td <?php echo $project_delete->PlannedEndDate->cellAttributes() ?>>
<span id="el<?php echo $project_delete->RowCount ?>_project_PlannedEndDate" class="project_PlannedEndDate">
<span<?php echo $project_delete->PlannedEndDate->viewAttributes() ?>><?php echo $project_delete->PlannedEndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project_delete->ActualStartDate->Visible) { // ActualStartDate ?>
		<td <?php echo $project_delete->ActualStartDate->cellAttributes() ?>>
<span id="el<?php echo $project_delete->RowCount ?>_project_ActualStartDate" class="project_ActualStartDate">
<span<?php echo $project_delete->ActualStartDate->viewAttributes() ?>><?php echo $project_delete->ActualStartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project_delete->ActualEndDate->Visible) { // ActualEndDate ?>
		<td <?php echo $project_delete->ActualEndDate->cellAttributes() ?>>
<span id="el<?php echo $project_delete->RowCount ?>_project_ActualEndDate" class="project_ActualEndDate">
<span<?php echo $project_delete->ActualEndDate->viewAttributes() ?>><?php echo $project_delete->ActualEndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project_delete->Budget->Visible) { // Budget ?>
		<td <?php echo $project_delete->Budget->cellAttributes() ?>>
<span id="el<?php echo $project_delete->RowCount ?>_project_Budget" class="project_Budget">
<span<?php echo $project_delete->Budget->viewAttributes() ?>><?php echo $project_delete->Budget->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project_delete->ProgressStatus->Visible) { // ProgressStatus ?>
		<td <?php echo $project_delete->ProgressStatus->cellAttributes() ?>>
<span id="el<?php echo $project_delete->RowCount ?>_project_ProgressStatus" class="project_ProgressStatus">
<span<?php echo $project_delete->ProgressStatus->viewAttributes() ?>><?php echo $project_delete->ProgressStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project_delete->OutstandingTasks->Visible) { // OutstandingTasks ?>
		<td <?php echo $project_delete->OutstandingTasks->cellAttributes() ?>>
<span id="el<?php echo $project_delete->RowCount ?>_project_OutstandingTasks" class="project_OutstandingTasks">
<span<?php echo $project_delete->OutstandingTasks->viewAttributes() ?>><?php echo $project_delete->OutstandingTasks->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$project_delete->Recordset->moveNext();
}
$project_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $project_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$project_delete->showPageFooter();
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
$project_delete->terminate();
?>