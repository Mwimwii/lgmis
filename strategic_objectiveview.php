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
$strategic_objective_view = new strategic_objective_view();

// Run the page
$strategic_objective_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$strategic_objective_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$strategic_objective_view->isExport()) { ?>
<script>
var fstrategic_objectiveview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fstrategic_objectiveview = currentForm = new ew.Form("fstrategic_objectiveview", "view");
	loadjs.done("fstrategic_objectiveview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$strategic_objective_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $strategic_objective_view->ExportOptions->render("body") ?>
<?php $strategic_objective_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $strategic_objective_view->showPageHeader(); ?>
<?php
$strategic_objective_view->showMessage();
?>
<?php if (!$strategic_objective_view->IsModal) { ?>
<?php if (!$strategic_objective_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $strategic_objective_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fstrategic_objectiveview" id="fstrategic_objectiveview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="strategic_objective">
<input type="hidden" name="modal" value="<?php echo (int)$strategic_objective_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($strategic_objective_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $strategic_objective_view->TableLeftColumnClass ?>"><span id="elh_strategic_objective_LACode"><?php echo $strategic_objective_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $strategic_objective_view->LACode->cellAttributes() ?>>
<span id="el_strategic_objective_LACode">
<span<?php echo $strategic_objective_view->LACode->viewAttributes() ?>><?php echo $strategic_objective_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($strategic_objective_view->DepartmentCode->Visible) { // DepartmentCode ?>
	<tr id="r_DepartmentCode">
		<td class="<?php echo $strategic_objective_view->TableLeftColumnClass ?>"><span id="elh_strategic_objective_DepartmentCode"><?php echo $strategic_objective_view->DepartmentCode->caption() ?></span></td>
		<td data-name="DepartmentCode" <?php echo $strategic_objective_view->DepartmentCode->cellAttributes() ?>>
<span id="el_strategic_objective_DepartmentCode">
<span<?php echo $strategic_objective_view->DepartmentCode->viewAttributes() ?>><?php echo $strategic_objective_view->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($strategic_objective_view->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
	<tr id="r_StrategicObjectiveCode">
		<td class="<?php echo $strategic_objective_view->TableLeftColumnClass ?>"><span id="elh_strategic_objective_StrategicObjectiveCode"><?php echo $strategic_objective_view->StrategicObjectiveCode->caption() ?></span></td>
		<td data-name="StrategicObjectiveCode" <?php echo $strategic_objective_view->StrategicObjectiveCode->cellAttributes() ?>>
<span id="el_strategic_objective_StrategicObjectiveCode">
<span<?php echo $strategic_objective_view->StrategicObjectiveCode->viewAttributes() ?>><?php echo $strategic_objective_view->StrategicObjectiveCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($strategic_objective_view->StrategicObjectiveName->Visible) { // StrategicObjectiveName ?>
	<tr id="r_StrategicObjectiveName">
		<td class="<?php echo $strategic_objective_view->TableLeftColumnClass ?>"><span id="elh_strategic_objective_StrategicObjectiveName"><?php echo $strategic_objective_view->StrategicObjectiveName->caption() ?></span></td>
		<td data-name="StrategicObjectiveName" <?php echo $strategic_objective_view->StrategicObjectiveName->cellAttributes() ?>>
<span id="el_strategic_objective_StrategicObjectiveName">
<span<?php echo $strategic_objective_view->StrategicObjectiveName->viewAttributes() ?>><?php echo $strategic_objective_view->StrategicObjectiveName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($strategic_objective_view->Description->Visible) { // Description ?>
	<tr id="r_Description">
		<td class="<?php echo $strategic_objective_view->TableLeftColumnClass ?>"><span id="elh_strategic_objective_Description"><?php echo $strategic_objective_view->Description->caption() ?></span></td>
		<td data-name="Description" <?php echo $strategic_objective_view->Description->cellAttributes() ?>>
<span id="el_strategic_objective_Description">
<span<?php echo $strategic_objective_view->Description->viewAttributes() ?>><?php echo $strategic_objective_view->Description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($strategic_objective_view->ReferencedDocs->Visible) { // ReferencedDocs ?>
	<tr id="r_ReferencedDocs">
		<td class="<?php echo $strategic_objective_view->TableLeftColumnClass ?>"><span id="elh_strategic_objective_ReferencedDocs"><?php echo $strategic_objective_view->ReferencedDocs->caption() ?></span></td>
		<td data-name="ReferencedDocs" <?php echo $strategic_objective_view->ReferencedDocs->cellAttributes() ?>>
<span id="el_strategic_objective_ReferencedDocs">
<span<?php echo $strategic_objective_view->ReferencedDocs->viewAttributes() ?>><?php echo $strategic_objective_view->ReferencedDocs->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($strategic_objective_view->ResultAreaCode->Visible) { // ResultAreaCode ?>
	<tr id="r_ResultAreaCode">
		<td class="<?php echo $strategic_objective_view->TableLeftColumnClass ?>"><span id="elh_strategic_objective_ResultAreaCode"><?php echo $strategic_objective_view->ResultAreaCode->caption() ?></span></td>
		<td data-name="ResultAreaCode" <?php echo $strategic_objective_view->ResultAreaCode->cellAttributes() ?>>
<span id="el_strategic_objective_ResultAreaCode">
<span<?php echo $strategic_objective_view->ResultAreaCode->viewAttributes() ?>><?php echo $strategic_objective_view->ResultAreaCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$strategic_objective_view->IsModal) { ?>
<?php if (!$strategic_objective_view->isExport()) { ?>
<?php echo $strategic_objective_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("outcome", explode(",", $strategic_objective->getCurrentDetailTable())) && $outcome->DetailView) {
?>
<?php if ($strategic_objective->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("outcome", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $strategic_objective_view->outcome_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "outcomegrid.php" ?>
<?php } ?>
</form>
<?php
$strategic_objective_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$strategic_objective_view->isExport()) { ?>
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
$strategic_objective_view->terminate();
?>