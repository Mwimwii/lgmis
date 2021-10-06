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
$activity_view = new activity_view();

// Run the page
$activity_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$activity_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$activity_view->isExport()) { ?>
<script>
var factivityview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	factivityview = currentForm = new ew.Form("factivityview", "view");
	loadjs.done("factivityview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$activity_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $activity_view->ExportOptions->render("body") ?>
<?php $activity_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $activity_view->showPageHeader(); ?>
<?php
$activity_view->showMessage();
?>
<?php if (!$activity_view->IsModal) { ?>
<?php if (!$activity_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $activity_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="factivityview" id="factivityview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="activity">
<input type="hidden" name="modal" value="<?php echo (int)$activity_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($activity_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $activity_view->TableLeftColumnClass ?>"><span id="elh_activity_LACode"><?php echo $activity_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $activity_view->LACode->cellAttributes() ?>>
<span id="el_activity_LACode">
<span<?php echo $activity_view->LACode->viewAttributes() ?>><?php echo $activity_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($activity_view->DepartmentCode->Visible) { // DepartmentCode ?>
	<tr id="r_DepartmentCode">
		<td class="<?php echo $activity_view->TableLeftColumnClass ?>"><span id="elh_activity_DepartmentCode"><?php echo $activity_view->DepartmentCode->caption() ?></span></td>
		<td data-name="DepartmentCode" <?php echo $activity_view->DepartmentCode->cellAttributes() ?>>
<span id="el_activity_DepartmentCode">
<span<?php echo $activity_view->DepartmentCode->viewAttributes() ?>><?php echo $activity_view->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($activity_view->SectionCode->Visible) { // SectionCode ?>
	<tr id="r_SectionCode">
		<td class="<?php echo $activity_view->TableLeftColumnClass ?>"><span id="elh_activity_SectionCode"><?php echo $activity_view->SectionCode->caption() ?></span></td>
		<td data-name="SectionCode" <?php echo $activity_view->SectionCode->cellAttributes() ?>>
<span id="el_activity_SectionCode">
<span<?php echo $activity_view->SectionCode->viewAttributes() ?>><?php echo $activity_view->SectionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($activity_view->ProgrammeCode->Visible) { // ProgrammeCode ?>
	<tr id="r_ProgrammeCode">
		<td class="<?php echo $activity_view->TableLeftColumnClass ?>"><span id="elh_activity_ProgrammeCode"><?php echo $activity_view->ProgrammeCode->caption() ?></span></td>
		<td data-name="ProgrammeCode" <?php echo $activity_view->ProgrammeCode->cellAttributes() ?>>
<span id="el_activity_ProgrammeCode">
<span<?php echo $activity_view->ProgrammeCode->viewAttributes() ?>><?php echo $activity_view->ProgrammeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($activity_view->OucomeCode->Visible) { // OucomeCode ?>
	<tr id="r_OucomeCode">
		<td class="<?php echo $activity_view->TableLeftColumnClass ?>"><span id="elh_activity_OucomeCode"><?php echo $activity_view->OucomeCode->caption() ?></span></td>
		<td data-name="OucomeCode" <?php echo $activity_view->OucomeCode->cellAttributes() ?>>
<span id="el_activity_OucomeCode">
<span<?php echo $activity_view->OucomeCode->viewAttributes() ?>><?php echo $activity_view->OucomeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($activity_view->OutputCode->Visible) { // OutputCode ?>
	<tr id="r_OutputCode">
		<td class="<?php echo $activity_view->TableLeftColumnClass ?>"><span id="elh_activity_OutputCode"><?php echo $activity_view->OutputCode->caption() ?></span></td>
		<td data-name="OutputCode" <?php echo $activity_view->OutputCode->cellAttributes() ?>>
<span id="el_activity_OutputCode">
<span<?php echo $activity_view->OutputCode->viewAttributes() ?>><?php echo $activity_view->OutputCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($activity_view->ProjectCode->Visible) { // ProjectCode ?>
	<tr id="r_ProjectCode">
		<td class="<?php echo $activity_view->TableLeftColumnClass ?>"><span id="elh_activity_ProjectCode"><?php echo $activity_view->ProjectCode->caption() ?></span></td>
		<td data-name="ProjectCode" <?php echo $activity_view->ProjectCode->cellAttributes() ?>>
<span id="el_activity_ProjectCode">
<span<?php echo $activity_view->ProjectCode->viewAttributes() ?>><?php echo $activity_view->ProjectCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($activity_view->ActivityCode->Visible) { // ActivityCode ?>
	<tr id="r_ActivityCode">
		<td class="<?php echo $activity_view->TableLeftColumnClass ?>"><span id="elh_activity_ActivityCode"><?php echo $activity_view->ActivityCode->caption() ?></span></td>
		<td data-name="ActivityCode" <?php echo $activity_view->ActivityCode->cellAttributes() ?>>
<span id="el_activity_ActivityCode">
<span<?php echo $activity_view->ActivityCode->viewAttributes() ?>><?php echo $activity_view->ActivityCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($activity_view->FinancialYear->Visible) { // FinancialYear ?>
	<tr id="r_FinancialYear">
		<td class="<?php echo $activity_view->TableLeftColumnClass ?>"><span id="elh_activity_FinancialYear"><?php echo $activity_view->FinancialYear->caption() ?></span></td>
		<td data-name="FinancialYear" <?php echo $activity_view->FinancialYear->cellAttributes() ?>>
<span id="el_activity_FinancialYear">
<span<?php echo $activity_view->FinancialYear->viewAttributes() ?>><?php echo $activity_view->FinancialYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($activity_view->ActivityName->Visible) { // ActivityName ?>
	<tr id="r_ActivityName">
		<td class="<?php echo $activity_view->TableLeftColumnClass ?>"><span id="elh_activity_ActivityName"><?php echo $activity_view->ActivityName->caption() ?></span></td>
		<td data-name="ActivityName" <?php echo $activity_view->ActivityName->cellAttributes() ?>>
<span id="el_activity_ActivityName">
<span<?php echo $activity_view->ActivityName->viewAttributes() ?>><?php echo $activity_view->ActivityName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($activity_view->SupplementaryBudget->Visible) { // SupplementaryBudget ?>
	<tr id="r_SupplementaryBudget">
		<td class="<?php echo $activity_view->TableLeftColumnClass ?>"><span id="elh_activity_SupplementaryBudget"><?php echo $activity_view->SupplementaryBudget->caption() ?></span></td>
		<td data-name="SupplementaryBudget" <?php echo $activity_view->SupplementaryBudget->cellAttributes() ?>>
<span id="el_activity_SupplementaryBudget">
<span<?php echo $activity_view->SupplementaryBudget->viewAttributes() ?>><?php echo $activity_view->SupplementaryBudget->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($activity_view->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
	<tr id="r_ExpectedAnnualAchievement">
		<td class="<?php echo $activity_view->TableLeftColumnClass ?>"><span id="elh_activity_ExpectedAnnualAchievement"><?php echo $activity_view->ExpectedAnnualAchievement->caption() ?></span></td>
		<td data-name="ExpectedAnnualAchievement" <?php echo $activity_view->ExpectedAnnualAchievement->cellAttributes() ?>>
<span id="el_activity_ExpectedAnnualAchievement">
<span<?php echo $activity_view->ExpectedAnnualAchievement->viewAttributes() ?>><?php echo $activity_view->ExpectedAnnualAchievement->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($activity_view->ActivityLocation->Visible) { // ActivityLocation ?>
	<tr id="r_ActivityLocation">
		<td class="<?php echo $activity_view->TableLeftColumnClass ?>"><span id="elh_activity_ActivityLocation"><?php echo $activity_view->ActivityLocation->caption() ?></span></td>
		<td data-name="ActivityLocation" <?php echo $activity_view->ActivityLocation->cellAttributes() ?>>
<span id="el_activity_ActivityLocation">
<span<?php echo $activity_view->ActivityLocation->viewAttributes() ?>><?php echo $activity_view->ActivityLocation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$activity_view->IsModal) { ?>
<?php if (!$activity_view->isExport()) { ?>
<?php echo $activity_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$activity_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$activity_view->isExport()) { ?>
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
$activity_view->terminate();
?>