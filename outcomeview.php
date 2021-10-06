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
$outcome_view = new outcome_view();

// Run the page
$outcome_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$outcome_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$outcome_view->isExport()) { ?>
<script>
var foutcomeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	foutcomeview = currentForm = new ew.Form("foutcomeview", "view");
	loadjs.done("foutcomeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$outcome_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $outcome_view->ExportOptions->render("body") ?>
<?php $outcome_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $outcome_view->showPageHeader(); ?>
<?php
$outcome_view->showMessage();
?>
<?php if (!$outcome_view->IsModal) { ?>
<?php if (!$outcome_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $outcome_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="foutcomeview" id="foutcomeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="outcome">
<input type="hidden" name="modal" value="<?php echo (int)$outcome_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($outcome_view->OutcomeCode->Visible) { // OutcomeCode ?>
	<tr id="r_OutcomeCode">
		<td class="<?php echo $outcome_view->TableLeftColumnClass ?>"><span id="elh_outcome_OutcomeCode"><?php echo $outcome_view->OutcomeCode->caption() ?></span></td>
		<td data-name="OutcomeCode" <?php echo $outcome_view->OutcomeCode->cellAttributes() ?>>
<span id="el_outcome_OutcomeCode">
<span<?php echo $outcome_view->OutcomeCode->viewAttributes() ?>><?php echo $outcome_view->OutcomeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($outcome_view->OutcomeName->Visible) { // OutcomeName ?>
	<tr id="r_OutcomeName">
		<td class="<?php echo $outcome_view->TableLeftColumnClass ?>"><span id="elh_outcome_OutcomeName"><?php echo $outcome_view->OutcomeName->caption() ?></span></td>
		<td data-name="OutcomeName" <?php echo $outcome_view->OutcomeName->cellAttributes() ?>>
<span id="el_outcome_OutcomeName">
<span<?php echo $outcome_view->OutcomeName->viewAttributes() ?>><?php echo $outcome_view->OutcomeName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($outcome_view->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
	<tr id="r_StrategicObjectiveCode">
		<td class="<?php echo $outcome_view->TableLeftColumnClass ?>"><span id="elh_outcome_StrategicObjectiveCode"><?php echo $outcome_view->StrategicObjectiveCode->caption() ?></span></td>
		<td data-name="StrategicObjectiveCode" <?php echo $outcome_view->StrategicObjectiveCode->cellAttributes() ?>>
<span id="el_outcome_StrategicObjectiveCode">
<span<?php echo $outcome_view->StrategicObjectiveCode->viewAttributes() ?>><?php echo $outcome_view->StrategicObjectiveCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($outcome_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $outcome_view->TableLeftColumnClass ?>"><span id="elh_outcome_LACode"><?php echo $outcome_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $outcome_view->LACode->cellAttributes() ?>>
<span id="el_outcome_LACode">
<span<?php echo $outcome_view->LACode->viewAttributes() ?>><?php echo $outcome_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($outcome_view->DepartmentCode->Visible) { // DepartmentCode ?>
	<tr id="r_DepartmentCode">
		<td class="<?php echo $outcome_view->TableLeftColumnClass ?>"><span id="elh_outcome_DepartmentCode"><?php echo $outcome_view->DepartmentCode->caption() ?></span></td>
		<td data-name="DepartmentCode" <?php echo $outcome_view->DepartmentCode->cellAttributes() ?>>
<span id="el_outcome_DepartmentCode">
<span<?php echo $outcome_view->DepartmentCode->viewAttributes() ?>><?php echo $outcome_view->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($outcome_view->OutcomeKPI->Visible) { // OutcomeKPI ?>
	<tr id="r_OutcomeKPI">
		<td class="<?php echo $outcome_view->TableLeftColumnClass ?>"><span id="elh_outcome_OutcomeKPI"><?php echo $outcome_view->OutcomeKPI->caption() ?></span></td>
		<td data-name="OutcomeKPI" <?php echo $outcome_view->OutcomeKPI->cellAttributes() ?>>
<span id="el_outcome_OutcomeKPI">
<span<?php echo $outcome_view->OutcomeKPI->viewAttributes() ?>><?php echo $outcome_view->OutcomeKPI->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($outcome_view->Assumptions->Visible) { // Assumptions ?>
	<tr id="r_Assumptions">
		<td class="<?php echo $outcome_view->TableLeftColumnClass ?>"><span id="elh_outcome_Assumptions"><?php echo $outcome_view->Assumptions->caption() ?></span></td>
		<td data-name="Assumptions" <?php echo $outcome_view->Assumptions->cellAttributes() ?>>
<span id="el_outcome_Assumptions">
<span<?php echo $outcome_view->Assumptions->viewAttributes() ?>><?php echo $outcome_view->Assumptions->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($outcome_view->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
	<tr id="r_ResponsibleOfficer">
		<td class="<?php echo $outcome_view->TableLeftColumnClass ?>"><span id="elh_outcome_ResponsibleOfficer"><?php echo $outcome_view->ResponsibleOfficer->caption() ?></span></td>
		<td data-name="ResponsibleOfficer" <?php echo $outcome_view->ResponsibleOfficer->cellAttributes() ?>>
<span id="el_outcome_ResponsibleOfficer">
<span<?php echo $outcome_view->ResponsibleOfficer->viewAttributes() ?>><?php echo $outcome_view->ResponsibleOfficer->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($outcome_view->OutcomeStatus->Visible) { // OutcomeStatus ?>
	<tr id="r_OutcomeStatus">
		<td class="<?php echo $outcome_view->TableLeftColumnClass ?>"><span id="elh_outcome_OutcomeStatus"><?php echo $outcome_view->OutcomeStatus->caption() ?></span></td>
		<td data-name="OutcomeStatus" <?php echo $outcome_view->OutcomeStatus->cellAttributes() ?>>
<span id="el_outcome_OutcomeStatus">
<span<?php echo $outcome_view->OutcomeStatus->viewAttributes() ?>><?php echo $outcome_view->OutcomeStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$outcome_view->IsModal) { ?>
<?php if (!$outcome_view->isExport()) { ?>
<?php echo $outcome_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("output", explode(",", $outcome->getCurrentDetailTable())) && $output->DetailView) {
?>
<?php if ($outcome->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("output", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $outcome_view->output_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "outputgrid.php" ?>
<?php } ?>
</form>
<?php
$outcome_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$outcome_view->isExport()) { ?>
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
$outcome_view->terminate();
?>