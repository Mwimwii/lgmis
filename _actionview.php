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
$_action_view = new _action_view();

// Run the page
$_action_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_action_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$_action_view->isExport()) { ?>
<script>
var f_actionview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	f_actionview = currentForm = new ew.Form("f_actionview", "view");
	loadjs.done("f_actionview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$_action_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $_action_view->ExportOptions->render("body") ?>
<?php $_action_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $_action_view->showPageHeader(); ?>
<?php
$_action_view->showMessage();
?>
<?php if (!$_action_view->IsModal) { ?>
<?php if (!$_action_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $_action_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="f_actionview" id="f_actionview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_action">
<input type="hidden" name="modal" value="<?php echo (int)$_action_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($_action_view->ProgramCode->Visible) { // ProgramCode ?>
	<tr id="r_ProgramCode">
		<td class="<?php echo $_action_view->TableLeftColumnClass ?>"><span id="elh__action_ProgramCode"><?php echo $_action_view->ProgramCode->caption() ?></span></td>
		<td data-name="ProgramCode" <?php echo $_action_view->ProgramCode->cellAttributes() ?>>
<span id="el__action_ProgramCode">
<span<?php echo $_action_view->ProgramCode->viewAttributes() ?>><?php echo $_action_view->ProgramCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($_action_view->OucomeCode->Visible) { // OucomeCode ?>
	<tr id="r_OucomeCode">
		<td class="<?php echo $_action_view->TableLeftColumnClass ?>"><span id="elh__action_OucomeCode"><?php echo $_action_view->OucomeCode->caption() ?></span></td>
		<td data-name="OucomeCode" <?php echo $_action_view->OucomeCode->cellAttributes() ?>>
<span id="el__action_OucomeCode">
<span<?php echo $_action_view->OucomeCode->viewAttributes() ?>><?php echo $_action_view->OucomeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($_action_view->OutputCode->Visible) { // OutputCode ?>
	<tr id="r_OutputCode">
		<td class="<?php echo $_action_view->TableLeftColumnClass ?>"><span id="elh__action_OutputCode"><?php echo $_action_view->OutputCode->caption() ?></span></td>
		<td data-name="OutputCode" <?php echo $_action_view->OutputCode->cellAttributes() ?>>
<span id="el__action_OutputCode">
<span<?php echo $_action_view->OutputCode->viewAttributes() ?>><?php echo $_action_view->OutputCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($_action_view->ProjectCode->Visible) { // ProjectCode ?>
	<tr id="r_ProjectCode">
		<td class="<?php echo $_action_view->TableLeftColumnClass ?>"><span id="elh__action_ProjectCode"><?php echo $_action_view->ProjectCode->caption() ?></span></td>
		<td data-name="ProjectCode" <?php echo $_action_view->ProjectCode->cellAttributes() ?>>
<span id="el__action_ProjectCode">
<span<?php echo $_action_view->ProjectCode->viewAttributes() ?>><?php echo $_action_view->ProjectCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($_action_view->ActionCode->Visible) { // ActionCode ?>
	<tr id="r_ActionCode">
		<td class="<?php echo $_action_view->TableLeftColumnClass ?>"><span id="elh__action_ActionCode"><?php echo $_action_view->ActionCode->caption() ?></span></td>
		<td data-name="ActionCode" <?php echo $_action_view->ActionCode->cellAttributes() ?>>
<span id="el__action_ActionCode">
<span<?php echo $_action_view->ActionCode->viewAttributes() ?>><?php echo $_action_view->ActionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($_action_view->ActionName->Visible) { // ActionName ?>
	<tr id="r_ActionName">
		<td class="<?php echo $_action_view->TableLeftColumnClass ?>"><span id="elh__action_ActionName"><?php echo $_action_view->ActionName->caption() ?></span></td>
		<td data-name="ActionName" <?php echo $_action_view->ActionName->cellAttributes() ?>>
<span id="el__action_ActionName">
<span<?php echo $_action_view->ActionName->viewAttributes() ?>><?php echo $_action_view->ActionName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($_action_view->ActionType->Visible) { // ActionType ?>
	<tr id="r_ActionType">
		<td class="<?php echo $_action_view->TableLeftColumnClass ?>"><span id="elh__action_ActionType"><?php echo $_action_view->ActionType->caption() ?></span></td>
		<td data-name="ActionType" <?php echo $_action_view->ActionType->cellAttributes() ?>>
<span id="el__action_ActionType">
<span<?php echo $_action_view->ActionType->viewAttributes() ?>><?php echo $_action_view->ActionType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($_action_view->FinancialYear->Visible) { // FinancialYear ?>
	<tr id="r_FinancialYear">
		<td class="<?php echo $_action_view->TableLeftColumnClass ?>"><span id="elh__action_FinancialYear"><?php echo $_action_view->FinancialYear->caption() ?></span></td>
		<td data-name="FinancialYear" <?php echo $_action_view->FinancialYear->cellAttributes() ?>>
<span id="el__action_FinancialYear">
<span<?php echo $_action_view->FinancialYear->viewAttributes() ?>><?php echo $_action_view->FinancialYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($_action_view->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
	<tr id="r_ExpectedAnnualAchievement">
		<td class="<?php echo $_action_view->TableLeftColumnClass ?>"><span id="elh__action_ExpectedAnnualAchievement"><?php echo $_action_view->ExpectedAnnualAchievement->caption() ?></span></td>
		<td data-name="ExpectedAnnualAchievement" <?php echo $_action_view->ExpectedAnnualAchievement->cellAttributes() ?>>
<span id="el__action_ExpectedAnnualAchievement">
<span<?php echo $_action_view->ExpectedAnnualAchievement->viewAttributes() ?>><?php echo $_action_view->ExpectedAnnualAchievement->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($_action_view->ActionLocation->Visible) { // ActionLocation ?>
	<tr id="r_ActionLocation">
		<td class="<?php echo $_action_view->TableLeftColumnClass ?>"><span id="elh__action_ActionLocation"><?php echo $_action_view->ActionLocation->caption() ?></span></td>
		<td data-name="ActionLocation" <?php echo $_action_view->ActionLocation->cellAttributes() ?>>
<span id="el__action_ActionLocation">
<span<?php echo $_action_view->ActionLocation->viewAttributes() ?>><?php echo $_action_view->ActionLocation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($_action_view->Latitude->Visible) { // Latitude ?>
	<tr id="r_Latitude">
		<td class="<?php echo $_action_view->TableLeftColumnClass ?>"><span id="elh__action_Latitude"><?php echo $_action_view->Latitude->caption() ?></span></td>
		<td data-name="Latitude" <?php echo $_action_view->Latitude->cellAttributes() ?>>
<span id="el__action_Latitude">
<span<?php echo $_action_view->Latitude->viewAttributes() ?>><?php echo $_action_view->Latitude->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($_action_view->Longitude->Visible) { // Longitude ?>
	<tr id="r_Longitude">
		<td class="<?php echo $_action_view->TableLeftColumnClass ?>"><span id="elh__action_Longitude"><?php echo $_action_view->Longitude->caption() ?></span></td>
		<td data-name="Longitude" <?php echo $_action_view->Longitude->cellAttributes() ?>>
<span id="el__action_Longitude">
<span<?php echo $_action_view->Longitude->viewAttributes() ?>><?php echo $_action_view->Longitude->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($_action_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $_action_view->TableLeftColumnClass ?>"><span id="elh__action_LACode"><?php echo $_action_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $_action_view->LACode->cellAttributes() ?>>
<span id="el__action_LACode">
<span<?php echo $_action_view->LACode->viewAttributes() ?>><?php echo $_action_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($_action_view->DepartmentCode->Visible) { // DepartmentCode ?>
	<tr id="r_DepartmentCode">
		<td class="<?php echo $_action_view->TableLeftColumnClass ?>"><span id="elh__action_DepartmentCode"><?php echo $_action_view->DepartmentCode->caption() ?></span></td>
		<td data-name="DepartmentCode" <?php echo $_action_view->DepartmentCode->cellAttributes() ?>>
<span id="el__action_DepartmentCode">
<span<?php echo $_action_view->DepartmentCode->viewAttributes() ?>><?php echo $_action_view->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($_action_view->SectionCode->Visible) { // SectionCode ?>
	<tr id="r_SectionCode">
		<td class="<?php echo $_action_view->TableLeftColumnClass ?>"><span id="elh__action_SectionCode"><?php echo $_action_view->SectionCode->caption() ?></span></td>
		<td data-name="SectionCode" <?php echo $_action_view->SectionCode->cellAttributes() ?>>
<span id="el__action_SectionCode">
<span<?php echo $_action_view->SectionCode->viewAttributes() ?>><?php echo $_action_view->SectionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$_action_view->IsModal) { ?>
<?php if (!$_action_view->isExport()) { ?>
<?php echo $_action_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("detailed_action", explode(",", $_action->getCurrentDetailTable())) && $detailed_action->DetailView) {
?>
<?php if ($_action->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailed_action", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $_action_view->detailed_action_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "detailed_actiongrid.php" ?>
<?php } ?>
</form>
<?php
$_action_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$_action_view->isExport()) { ?>
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
$_action_view->terminate();
?>