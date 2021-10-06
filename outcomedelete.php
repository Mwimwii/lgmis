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
$outcome_delete = new outcome_delete();

// Run the page
$outcome_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$outcome_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var foutcomedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	foutcomedelete = currentForm = new ew.Form("foutcomedelete", "delete");
	loadjs.done("foutcomedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $outcome_delete->showPageHeader(); ?>
<?php
$outcome_delete->showMessage();
?>
<form name="foutcomedelete" id="foutcomedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="outcome">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($outcome_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($outcome_delete->OutcomeCode->Visible) { // OutcomeCode ?>
		<th class="<?php echo $outcome_delete->OutcomeCode->headerCellClass() ?>"><span id="elh_outcome_OutcomeCode" class="outcome_OutcomeCode"><?php echo $outcome_delete->OutcomeCode->caption() ?></span></th>
<?php } ?>
<?php if ($outcome_delete->OutcomeName->Visible) { // OutcomeName ?>
		<th class="<?php echo $outcome_delete->OutcomeName->headerCellClass() ?>"><span id="elh_outcome_OutcomeName" class="outcome_OutcomeName"><?php echo $outcome_delete->OutcomeName->caption() ?></span></th>
<?php } ?>
<?php if ($outcome_delete->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
		<th class="<?php echo $outcome_delete->StrategicObjectiveCode->headerCellClass() ?>"><span id="elh_outcome_StrategicObjectiveCode" class="outcome_StrategicObjectiveCode"><?php echo $outcome_delete->StrategicObjectiveCode->caption() ?></span></th>
<?php } ?>
<?php if ($outcome_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $outcome_delete->LACode->headerCellClass() ?>"><span id="elh_outcome_LACode" class="outcome_LACode"><?php echo $outcome_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($outcome_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<th class="<?php echo $outcome_delete->DepartmentCode->headerCellClass() ?>"><span id="elh_outcome_DepartmentCode" class="outcome_DepartmentCode"><?php echo $outcome_delete->DepartmentCode->caption() ?></span></th>
<?php } ?>
<?php if ($outcome_delete->OutcomeKPI->Visible) { // OutcomeKPI ?>
		<th class="<?php echo $outcome_delete->OutcomeKPI->headerCellClass() ?>"><span id="elh_outcome_OutcomeKPI" class="outcome_OutcomeKPI"><?php echo $outcome_delete->OutcomeKPI->caption() ?></span></th>
<?php } ?>
<?php if ($outcome_delete->Assumptions->Visible) { // Assumptions ?>
		<th class="<?php echo $outcome_delete->Assumptions->headerCellClass() ?>"><span id="elh_outcome_Assumptions" class="outcome_Assumptions"><?php echo $outcome_delete->Assumptions->caption() ?></span></th>
<?php } ?>
<?php if ($outcome_delete->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
		<th class="<?php echo $outcome_delete->ResponsibleOfficer->headerCellClass() ?>"><span id="elh_outcome_ResponsibleOfficer" class="outcome_ResponsibleOfficer"><?php echo $outcome_delete->ResponsibleOfficer->caption() ?></span></th>
<?php } ?>
<?php if ($outcome_delete->OutcomeStatus->Visible) { // OutcomeStatus ?>
		<th class="<?php echo $outcome_delete->OutcomeStatus->headerCellClass() ?>"><span id="elh_outcome_OutcomeStatus" class="outcome_OutcomeStatus"><?php echo $outcome_delete->OutcomeStatus->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$outcome_delete->RecordCount = 0;
$i = 0;
while (!$outcome_delete->Recordset->EOF) {
	$outcome_delete->RecordCount++;
	$outcome_delete->RowCount++;

	// Set row properties
	$outcome->resetAttributes();
	$outcome->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$outcome_delete->loadRowValues($outcome_delete->Recordset);

	// Render row
	$outcome_delete->renderRow();
?>
	<tr <?php echo $outcome->rowAttributes() ?>>
<?php if ($outcome_delete->OutcomeCode->Visible) { // OutcomeCode ?>
		<td <?php echo $outcome_delete->OutcomeCode->cellAttributes() ?>>
<span id="el<?php echo $outcome_delete->RowCount ?>_outcome_OutcomeCode" class="outcome_OutcomeCode">
<span<?php echo $outcome_delete->OutcomeCode->viewAttributes() ?>><?php echo $outcome_delete->OutcomeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($outcome_delete->OutcomeName->Visible) { // OutcomeName ?>
		<td <?php echo $outcome_delete->OutcomeName->cellAttributes() ?>>
<span id="el<?php echo $outcome_delete->RowCount ?>_outcome_OutcomeName" class="outcome_OutcomeName">
<span<?php echo $outcome_delete->OutcomeName->viewAttributes() ?>><?php echo $outcome_delete->OutcomeName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($outcome_delete->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
		<td <?php echo $outcome_delete->StrategicObjectiveCode->cellAttributes() ?>>
<span id="el<?php echo $outcome_delete->RowCount ?>_outcome_StrategicObjectiveCode" class="outcome_StrategicObjectiveCode">
<span<?php echo $outcome_delete->StrategicObjectiveCode->viewAttributes() ?>><?php echo $outcome_delete->StrategicObjectiveCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($outcome_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $outcome_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $outcome_delete->RowCount ?>_outcome_LACode" class="outcome_LACode">
<span<?php echo $outcome_delete->LACode->viewAttributes() ?>><?php echo $outcome_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($outcome_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<td <?php echo $outcome_delete->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $outcome_delete->RowCount ?>_outcome_DepartmentCode" class="outcome_DepartmentCode">
<span<?php echo $outcome_delete->DepartmentCode->viewAttributes() ?>><?php echo $outcome_delete->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($outcome_delete->OutcomeKPI->Visible) { // OutcomeKPI ?>
		<td <?php echo $outcome_delete->OutcomeKPI->cellAttributes() ?>>
<span id="el<?php echo $outcome_delete->RowCount ?>_outcome_OutcomeKPI" class="outcome_OutcomeKPI">
<span<?php echo $outcome_delete->OutcomeKPI->viewAttributes() ?>><?php echo $outcome_delete->OutcomeKPI->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($outcome_delete->Assumptions->Visible) { // Assumptions ?>
		<td <?php echo $outcome_delete->Assumptions->cellAttributes() ?>>
<span id="el<?php echo $outcome_delete->RowCount ?>_outcome_Assumptions" class="outcome_Assumptions">
<span<?php echo $outcome_delete->Assumptions->viewAttributes() ?>><?php echo $outcome_delete->Assumptions->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($outcome_delete->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
		<td <?php echo $outcome_delete->ResponsibleOfficer->cellAttributes() ?>>
<span id="el<?php echo $outcome_delete->RowCount ?>_outcome_ResponsibleOfficer" class="outcome_ResponsibleOfficer">
<span<?php echo $outcome_delete->ResponsibleOfficer->viewAttributes() ?>><?php echo $outcome_delete->ResponsibleOfficer->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($outcome_delete->OutcomeStatus->Visible) { // OutcomeStatus ?>
		<td <?php echo $outcome_delete->OutcomeStatus->cellAttributes() ?>>
<span id="el<?php echo $outcome_delete->RowCount ?>_outcome_OutcomeStatus" class="outcome_OutcomeStatus">
<span<?php echo $outcome_delete->OutcomeStatus->viewAttributes() ?>><?php echo $outcome_delete->OutcomeStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$outcome_delete->Recordset->moveNext();
}
$outcome_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $outcome_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$outcome_delete->showPageFooter();
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
$outcome_delete->terminate();
?>