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
$strategic_objective_delete = new strategic_objective_delete();

// Run the page
$strategic_objective_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$strategic_objective_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstrategic_objectivedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fstrategic_objectivedelete = currentForm = new ew.Form("fstrategic_objectivedelete", "delete");
	loadjs.done("fstrategic_objectivedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $strategic_objective_delete->showPageHeader(); ?>
<?php
$strategic_objective_delete->showMessage();
?>
<form name="fstrategic_objectivedelete" id="fstrategic_objectivedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="strategic_objective">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($strategic_objective_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($strategic_objective_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $strategic_objective_delete->LACode->headerCellClass() ?>"><span id="elh_strategic_objective_LACode" class="strategic_objective_LACode"><?php echo $strategic_objective_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($strategic_objective_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<th class="<?php echo $strategic_objective_delete->DepartmentCode->headerCellClass() ?>"><span id="elh_strategic_objective_DepartmentCode" class="strategic_objective_DepartmentCode"><?php echo $strategic_objective_delete->DepartmentCode->caption() ?></span></th>
<?php } ?>
<?php if ($strategic_objective_delete->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
		<th class="<?php echo $strategic_objective_delete->StrategicObjectiveCode->headerCellClass() ?>"><span id="elh_strategic_objective_StrategicObjectiveCode" class="strategic_objective_StrategicObjectiveCode"><?php echo $strategic_objective_delete->StrategicObjectiveCode->caption() ?></span></th>
<?php } ?>
<?php if ($strategic_objective_delete->StrategicObjectiveName->Visible) { // StrategicObjectiveName ?>
		<th class="<?php echo $strategic_objective_delete->StrategicObjectiveName->headerCellClass() ?>"><span id="elh_strategic_objective_StrategicObjectiveName" class="strategic_objective_StrategicObjectiveName"><?php echo $strategic_objective_delete->StrategicObjectiveName->caption() ?></span></th>
<?php } ?>
<?php if ($strategic_objective_delete->ReferencedDocs->Visible) { // ReferencedDocs ?>
		<th class="<?php echo $strategic_objective_delete->ReferencedDocs->headerCellClass() ?>"><span id="elh_strategic_objective_ReferencedDocs" class="strategic_objective_ReferencedDocs"><?php echo $strategic_objective_delete->ReferencedDocs->caption() ?></span></th>
<?php } ?>
<?php if ($strategic_objective_delete->ResultAreaCode->Visible) { // ResultAreaCode ?>
		<th class="<?php echo $strategic_objective_delete->ResultAreaCode->headerCellClass() ?>"><span id="elh_strategic_objective_ResultAreaCode" class="strategic_objective_ResultAreaCode"><?php echo $strategic_objective_delete->ResultAreaCode->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$strategic_objective_delete->RecordCount = 0;
$i = 0;
while (!$strategic_objective_delete->Recordset->EOF) {
	$strategic_objective_delete->RecordCount++;
	$strategic_objective_delete->RowCount++;

	// Set row properties
	$strategic_objective->resetAttributes();
	$strategic_objective->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$strategic_objective_delete->loadRowValues($strategic_objective_delete->Recordset);

	// Render row
	$strategic_objective_delete->renderRow();
?>
	<tr <?php echo $strategic_objective->rowAttributes() ?>>
<?php if ($strategic_objective_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $strategic_objective_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $strategic_objective_delete->RowCount ?>_strategic_objective_LACode" class="strategic_objective_LACode">
<span<?php echo $strategic_objective_delete->LACode->viewAttributes() ?>><?php echo $strategic_objective_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($strategic_objective_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<td <?php echo $strategic_objective_delete->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $strategic_objective_delete->RowCount ?>_strategic_objective_DepartmentCode" class="strategic_objective_DepartmentCode">
<span<?php echo $strategic_objective_delete->DepartmentCode->viewAttributes() ?>><?php echo $strategic_objective_delete->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($strategic_objective_delete->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
		<td <?php echo $strategic_objective_delete->StrategicObjectiveCode->cellAttributes() ?>>
<span id="el<?php echo $strategic_objective_delete->RowCount ?>_strategic_objective_StrategicObjectiveCode" class="strategic_objective_StrategicObjectiveCode">
<span<?php echo $strategic_objective_delete->StrategicObjectiveCode->viewAttributes() ?>><?php echo $strategic_objective_delete->StrategicObjectiveCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($strategic_objective_delete->StrategicObjectiveName->Visible) { // StrategicObjectiveName ?>
		<td <?php echo $strategic_objective_delete->StrategicObjectiveName->cellAttributes() ?>>
<span id="el<?php echo $strategic_objective_delete->RowCount ?>_strategic_objective_StrategicObjectiveName" class="strategic_objective_StrategicObjectiveName">
<span<?php echo $strategic_objective_delete->StrategicObjectiveName->viewAttributes() ?>><?php echo $strategic_objective_delete->StrategicObjectiveName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($strategic_objective_delete->ReferencedDocs->Visible) { // ReferencedDocs ?>
		<td <?php echo $strategic_objective_delete->ReferencedDocs->cellAttributes() ?>>
<span id="el<?php echo $strategic_objective_delete->RowCount ?>_strategic_objective_ReferencedDocs" class="strategic_objective_ReferencedDocs">
<span<?php echo $strategic_objective_delete->ReferencedDocs->viewAttributes() ?>><?php echo $strategic_objective_delete->ReferencedDocs->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($strategic_objective_delete->ResultAreaCode->Visible) { // ResultAreaCode ?>
		<td <?php echo $strategic_objective_delete->ResultAreaCode->cellAttributes() ?>>
<span id="el<?php echo $strategic_objective_delete->RowCount ?>_strategic_objective_ResultAreaCode" class="strategic_objective_ResultAreaCode">
<span<?php echo $strategic_objective_delete->ResultAreaCode->viewAttributes() ?>><?php echo $strategic_objective_delete->ResultAreaCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$strategic_objective_delete->Recordset->moveNext();
}
$strategic_objective_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $strategic_objective_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$strategic_objective_delete->showPageFooter();
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
$strategic_objective_delete->terminate();
?>