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
$project_view = new project_view();

// Run the page
$project_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$project_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$project_view->isExport()) { ?>
<script>
var fprojectview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fprojectview = currentForm = new ew.Form("fprojectview", "view");
	loadjs.done("fprojectview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$project_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $project_view->ExportOptions->render("body") ?>
<?php $project_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $project_view->showPageHeader(); ?>
<?php
$project_view->showMessage();
?>
<?php if (!$project_view->IsModal) { ?>
<?php if (!$project_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $project_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fprojectview" id="fprojectview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="project">
<input type="hidden" name="modal" value="<?php echo (int)$project_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($project_view->ProvinceCode->Visible) { // ProvinceCode ?>
	<tr id="r_ProvinceCode">
		<td class="<?php echo $project_view->TableLeftColumnClass ?>"><span id="elh_project_ProvinceCode"><?php echo $project_view->ProvinceCode->caption() ?></span></td>
		<td data-name="ProvinceCode" <?php echo $project_view->ProvinceCode->cellAttributes() ?>>
<span id="el_project_ProvinceCode">
<span<?php echo $project_view->ProvinceCode->viewAttributes() ?>><?php echo $project_view->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $project_view->TableLeftColumnClass ?>"><span id="elh_project_LACode"><?php echo $project_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $project_view->LACode->cellAttributes() ?>>
<span id="el_project_LACode">
<span<?php echo $project_view->LACode->viewAttributes() ?>><?php echo $project_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_view->DepartmentCode->Visible) { // DepartmentCode ?>
	<tr id="r_DepartmentCode">
		<td class="<?php echo $project_view->TableLeftColumnClass ?>"><span id="elh_project_DepartmentCode"><?php echo $project_view->DepartmentCode->caption() ?></span></td>
		<td data-name="DepartmentCode" <?php echo $project_view->DepartmentCode->cellAttributes() ?>>
<span id="el_project_DepartmentCode">
<span<?php echo $project_view->DepartmentCode->viewAttributes() ?>><?php echo $project_view->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_view->SectionCode->Visible) { // SectionCode ?>
	<tr id="r_SectionCode">
		<td class="<?php echo $project_view->TableLeftColumnClass ?>"><span id="elh_project_SectionCode"><?php echo $project_view->SectionCode->caption() ?></span></td>
		<td data-name="SectionCode" <?php echo $project_view->SectionCode->cellAttributes() ?>>
<span id="el_project_SectionCode">
<span<?php echo $project_view->SectionCode->viewAttributes() ?>><?php echo $project_view->SectionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_view->ProjectCode->Visible) { // ProjectCode ?>
	<tr id="r_ProjectCode">
		<td class="<?php echo $project_view->TableLeftColumnClass ?>"><span id="elh_project_ProjectCode"><?php echo $project_view->ProjectCode->caption() ?></span></td>
		<td data-name="ProjectCode" <?php echo $project_view->ProjectCode->cellAttributes() ?>>
<span id="el_project_ProjectCode">
<span<?php echo $project_view->ProjectCode->viewAttributes() ?>><?php echo $project_view->ProjectCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_view->ProjectName->Visible) { // ProjectName ?>
	<tr id="r_ProjectName">
		<td class="<?php echo $project_view->TableLeftColumnClass ?>"><span id="elh_project_ProjectName"><?php echo $project_view->ProjectName->caption() ?></span></td>
		<td data-name="ProjectName" <?php echo $project_view->ProjectName->cellAttributes() ?>>
<span id="el_project_ProjectName">
<span<?php echo $project_view->ProjectName->viewAttributes() ?>><?php echo $project_view->ProjectName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_view->ProjectType->Visible) { // ProjectType ?>
	<tr id="r_ProjectType">
		<td class="<?php echo $project_view->TableLeftColumnClass ?>"><span id="elh_project_ProjectType"><?php echo $project_view->ProjectType->caption() ?></span></td>
		<td data-name="ProjectType" <?php echo $project_view->ProjectType->cellAttributes() ?>>
<span id="el_project_ProjectType">
<span<?php echo $project_view->ProjectType->viewAttributes() ?>><?php echo $project_view->ProjectType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_view->ProjectSector->Visible) { // ProjectSector ?>
	<tr id="r_ProjectSector">
		<td class="<?php echo $project_view->TableLeftColumnClass ?>"><span id="elh_project_ProjectSector"><?php echo $project_view->ProjectSector->caption() ?></span></td>
		<td data-name="ProjectSector" <?php echo $project_view->ProjectSector->cellAttributes() ?>>
<span id="el_project_ProjectSector">
<span<?php echo $project_view->ProjectSector->viewAttributes() ?>><?php echo $project_view->ProjectSector->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_view->Contractors->Visible) { // Contractors ?>
	<tr id="r_Contractors">
		<td class="<?php echo $project_view->TableLeftColumnClass ?>"><span id="elh_project_Contractors"><?php echo $project_view->Contractors->caption() ?></span></td>
		<td data-name="Contractors" <?php echo $project_view->Contractors->cellAttributes() ?>>
<span id="el_project_Contractors">
<span<?php echo $project_view->Contractors->viewAttributes() ?>><?php echo $project_view->Contractors->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_view->Projectdescription->Visible) { // Projectdescription ?>
	<tr id="r_Projectdescription">
		<td class="<?php echo $project_view->TableLeftColumnClass ?>"><span id="elh_project_Projectdescription"><?php echo $project_view->Projectdescription->caption() ?></span></td>
		<td data-name="Projectdescription" <?php echo $project_view->Projectdescription->cellAttributes() ?>>
<span id="el_project_Projectdescription">
<span<?php echo $project_view->Projectdescription->viewAttributes() ?>><?php echo $project_view->Projectdescription->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_view->PlannedStartDate->Visible) { // PlannedStartDate ?>
	<tr id="r_PlannedStartDate">
		<td class="<?php echo $project_view->TableLeftColumnClass ?>"><span id="elh_project_PlannedStartDate"><?php echo $project_view->PlannedStartDate->caption() ?></span></td>
		<td data-name="PlannedStartDate" <?php echo $project_view->PlannedStartDate->cellAttributes() ?>>
<span id="el_project_PlannedStartDate">
<span<?php echo $project_view->PlannedStartDate->viewAttributes() ?>><?php echo $project_view->PlannedStartDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_view->PlannedEndDate->Visible) { // PlannedEndDate ?>
	<tr id="r_PlannedEndDate">
		<td class="<?php echo $project_view->TableLeftColumnClass ?>"><span id="elh_project_PlannedEndDate"><?php echo $project_view->PlannedEndDate->caption() ?></span></td>
		<td data-name="PlannedEndDate" <?php echo $project_view->PlannedEndDate->cellAttributes() ?>>
<span id="el_project_PlannedEndDate">
<span<?php echo $project_view->PlannedEndDate->viewAttributes() ?>><?php echo $project_view->PlannedEndDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_view->ActualStartDate->Visible) { // ActualStartDate ?>
	<tr id="r_ActualStartDate">
		<td class="<?php echo $project_view->TableLeftColumnClass ?>"><span id="elh_project_ActualStartDate"><?php echo $project_view->ActualStartDate->caption() ?></span></td>
		<td data-name="ActualStartDate" <?php echo $project_view->ActualStartDate->cellAttributes() ?>>
<span id="el_project_ActualStartDate">
<span<?php echo $project_view->ActualStartDate->viewAttributes() ?>><?php echo $project_view->ActualStartDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_view->ActualEndDate->Visible) { // ActualEndDate ?>
	<tr id="r_ActualEndDate">
		<td class="<?php echo $project_view->TableLeftColumnClass ?>"><span id="elh_project_ActualEndDate"><?php echo $project_view->ActualEndDate->caption() ?></span></td>
		<td data-name="ActualEndDate" <?php echo $project_view->ActualEndDate->cellAttributes() ?>>
<span id="el_project_ActualEndDate">
<span<?php echo $project_view->ActualEndDate->viewAttributes() ?>><?php echo $project_view->ActualEndDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_view->Budget->Visible) { // Budget ?>
	<tr id="r_Budget">
		<td class="<?php echo $project_view->TableLeftColumnClass ?>"><span id="elh_project_Budget"><?php echo $project_view->Budget->caption() ?></span></td>
		<td data-name="Budget" <?php echo $project_view->Budget->cellAttributes() ?>>
<span id="el_project_Budget">
<span<?php echo $project_view->Budget->viewAttributes() ?>><?php echo $project_view->Budget->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_view->ExpenditureTodate->Visible) { // ExpenditureTodate ?>
	<tr id="r_ExpenditureTodate">
		<td class="<?php echo $project_view->TableLeftColumnClass ?>"><span id="elh_project_ExpenditureTodate"><?php echo $project_view->ExpenditureTodate->caption() ?></span></td>
		<td data-name="ExpenditureTodate" <?php echo $project_view->ExpenditureTodate->cellAttributes() ?>>
<span id="el_project_ExpenditureTodate">
<span<?php echo $project_view->ExpenditureTodate->viewAttributes() ?>><?php echo $project_view->ExpenditureTodate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_view->FundsReleased->Visible) { // FundsReleased ?>
	<tr id="r_FundsReleased">
		<td class="<?php echo $project_view->TableLeftColumnClass ?>"><span id="elh_project_FundsReleased"><?php echo $project_view->FundsReleased->caption() ?></span></td>
		<td data-name="FundsReleased" <?php echo $project_view->FundsReleased->cellAttributes() ?>>
<span id="el_project_FundsReleased">
<span<?php echo $project_view->FundsReleased->viewAttributes() ?>><?php echo $project_view->FundsReleased->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_view->FundingSource->Visible) { // FundingSource ?>
	<tr id="r_FundingSource">
		<td class="<?php echo $project_view->TableLeftColumnClass ?>"><span id="elh_project_FundingSource"><?php echo $project_view->FundingSource->caption() ?></span></td>
		<td data-name="FundingSource" <?php echo $project_view->FundingSource->cellAttributes() ?>>
<span id="el_project_FundingSource">
<span<?php echo $project_view->FundingSource->viewAttributes() ?>><?php echo $project_view->FundingSource->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_view->ProjectDocs->Visible) { // ProjectDocs ?>
	<tr id="r_ProjectDocs">
		<td class="<?php echo $project_view->TableLeftColumnClass ?>"><span id="elh_project_ProjectDocs"><?php echo $project_view->ProjectDocs->caption() ?></span></td>
		<td data-name="ProjectDocs" <?php echo $project_view->ProjectDocs->cellAttributes() ?>>
<span id="el_project_ProjectDocs">
<span<?php echo $project_view->ProjectDocs->viewAttributes() ?>><?php echo GetFileViewTag($project_view->ProjectDocs, $project_view->ProjectDocs->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_view->ProgressStatus->Visible) { // ProgressStatus ?>
	<tr id="r_ProgressStatus">
		<td class="<?php echo $project_view->TableLeftColumnClass ?>"><span id="elh_project_ProgressStatus"><?php echo $project_view->ProgressStatus->caption() ?></span></td>
		<td data-name="ProgressStatus" <?php echo $project_view->ProgressStatus->cellAttributes() ?>>
<span id="el_project_ProgressStatus">
<span<?php echo $project_view->ProgressStatus->viewAttributes() ?>><?php echo $project_view->ProgressStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_view->OutstandingTasks->Visible) { // OutstandingTasks ?>
	<tr id="r_OutstandingTasks">
		<td class="<?php echo $project_view->TableLeftColumnClass ?>"><span id="elh_project_OutstandingTasks"><?php echo $project_view->OutstandingTasks->caption() ?></span></td>
		<td data-name="OutstandingTasks" <?php echo $project_view->OutstandingTasks->cellAttributes() ?>>
<span id="el_project_OutstandingTasks">
<span<?php echo $project_view->OutstandingTasks->viewAttributes() ?>><?php echo $project_view->OutstandingTasks->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_view->LastUpdated->Visible) { // LastUpdated ?>
	<tr id="r_LastUpdated">
		<td class="<?php echo $project_view->TableLeftColumnClass ?>"><span id="elh_project_LastUpdated"><?php echo $project_view->LastUpdated->caption() ?></span></td>
		<td data-name="LastUpdated" <?php echo $project_view->LastUpdated->cellAttributes() ?>>
<span id="el_project_LastUpdated">
<span<?php echo $project_view->LastUpdated->viewAttributes() ?>><?php echo $project_view->LastUpdated->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_view->CommnentsOnStatus->Visible) { // CommnentsOnStatus ?>
	<tr id="r_CommnentsOnStatus">
		<td class="<?php echo $project_view->TableLeftColumnClass ?>"><span id="elh_project_CommnentsOnStatus"><?php echo $project_view->CommnentsOnStatus->caption() ?></span></td>
		<td data-name="CommnentsOnStatus" <?php echo $project_view->CommnentsOnStatus->cellAttributes() ?>>
<span id="el_project_CommnentsOnStatus">
<span<?php echo $project_view->CommnentsOnStatus->viewAttributes() ?>><?php echo $project_view->CommnentsOnStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_view->MoreDocs->Visible) { // MoreDocs ?>
	<tr id="r_MoreDocs">
		<td class="<?php echo $project_view->TableLeftColumnClass ?>"><span id="elh_project_MoreDocs"><?php echo $project_view->MoreDocs->caption() ?></span></td>
		<td data-name="MoreDocs" <?php echo $project_view->MoreDocs->cellAttributes() ?>>
<span id="el_project_MoreDocs">
<span<?php echo $project_view->MoreDocs->viewAttributes() ?>><?php echo GetFileViewTag($project_view->MoreDocs, $project_view->MoreDocs->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$project_view->IsModal) { ?>
<?php if (!$project_view->isExport()) { ?>
<?php echo $project_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("activity", explode(",", $project->getCurrentDetailTable())) && $activity->DetailView) {
?>
<?php if ($project->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("activity", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "activitygrid.php" ?>
<?php } ?>
</form>
<?php
$project_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$project_view->isExport()) { ?>
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
$project_view->terminate();
?>