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
$position_ref_delete = new position_ref_delete();

// Run the page
$position_ref_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$position_ref_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fposition_refdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fposition_refdelete = currentForm = new ew.Form("fposition_refdelete", "delete");
	loadjs.done("fposition_refdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $position_ref_delete->showPageHeader(); ?>
<?php
$position_ref_delete->showMessage();
?>
<form name="fposition_refdelete" id="fposition_refdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="position_ref">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($position_ref_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($position_ref_delete->PositionCode->Visible) { // PositionCode ?>
		<th class="<?php echo $position_ref_delete->PositionCode->headerCellClass() ?>"><span id="elh_position_ref_PositionCode" class="position_ref_PositionCode"><?php echo $position_ref_delete->PositionCode->caption() ?></span></th>
<?php } ?>
<?php if ($position_ref_delete->PositionName->Visible) { // PositionName ?>
		<th class="<?php echo $position_ref_delete->PositionName->headerCellClass() ?>"><span id="elh_position_ref_PositionName" class="position_ref_PositionName"><?php echo $position_ref_delete->PositionName->caption() ?></span></th>
<?php } ?>
<?php if ($position_ref_delete->RequisiteQualification->Visible) { // RequisiteQualification ?>
		<th class="<?php echo $position_ref_delete->RequisiteQualification->headerCellClass() ?>"><span id="elh_position_ref_RequisiteQualification" class="position_ref_RequisiteQualification"><?php echo $position_ref_delete->RequisiteQualification->caption() ?></span></th>
<?php } ?>
<?php if ($position_ref_delete->JobCode->Visible) { // JobCode ?>
		<th class="<?php echo $position_ref_delete->JobCode->headerCellClass() ?>"><span id="elh_position_ref_JobCode" class="position_ref_JobCode"><?php echo $position_ref_delete->JobCode->caption() ?></span></th>
<?php } ?>
<?php if ($position_ref_delete->SalaryScale->Visible) { // SalaryScale ?>
		<th class="<?php echo $position_ref_delete->SalaryScale->headerCellClass() ?>"><span id="elh_position_ref_SalaryScale" class="position_ref_SalaryScale"><?php echo $position_ref_delete->SalaryScale->caption() ?></span></th>
<?php } ?>
<?php if ($position_ref_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<th class="<?php echo $position_ref_delete->ProvinceCode->headerCellClass() ?>"><span id="elh_position_ref_ProvinceCode" class="position_ref_ProvinceCode"><?php echo $position_ref_delete->ProvinceCode->caption() ?></span></th>
<?php } ?>
<?php if ($position_ref_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $position_ref_delete->LACode->headerCellClass() ?>"><span id="elh_position_ref_LACode" class="position_ref_LACode"><?php echo $position_ref_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($position_ref_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<th class="<?php echo $position_ref_delete->DepartmentCode->headerCellClass() ?>"><span id="elh_position_ref_DepartmentCode" class="position_ref_DepartmentCode"><?php echo $position_ref_delete->DepartmentCode->caption() ?></span></th>
<?php } ?>
<?php if ($position_ref_delete->FieldQualified->Visible) { // FieldQualified ?>
		<th class="<?php echo $position_ref_delete->FieldQualified->headerCellClass() ?>"><span id="elh_position_ref_FieldQualified" class="position_ref_FieldQualified"><?php echo $position_ref_delete->FieldQualified->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$position_ref_delete->RecordCount = 0;
$i = 0;
while (!$position_ref_delete->Recordset->EOF) {
	$position_ref_delete->RecordCount++;
	$position_ref_delete->RowCount++;

	// Set row properties
	$position_ref->resetAttributes();
	$position_ref->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$position_ref_delete->loadRowValues($position_ref_delete->Recordset);

	// Render row
	$position_ref_delete->renderRow();
?>
	<tr <?php echo $position_ref->rowAttributes() ?>>
<?php if ($position_ref_delete->PositionCode->Visible) { // PositionCode ?>
		<td <?php echo $position_ref_delete->PositionCode->cellAttributes() ?>>
<span id="el<?php echo $position_ref_delete->RowCount ?>_position_ref_PositionCode" class="position_ref_PositionCode">
<span<?php echo $position_ref_delete->PositionCode->viewAttributes() ?>><?php echo $position_ref_delete->PositionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($position_ref_delete->PositionName->Visible) { // PositionName ?>
		<td <?php echo $position_ref_delete->PositionName->cellAttributes() ?>>
<span id="el<?php echo $position_ref_delete->RowCount ?>_position_ref_PositionName" class="position_ref_PositionName">
<span<?php echo $position_ref_delete->PositionName->viewAttributes() ?>><?php echo $position_ref_delete->PositionName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($position_ref_delete->RequisiteQualification->Visible) { // RequisiteQualification ?>
		<td <?php echo $position_ref_delete->RequisiteQualification->cellAttributes() ?>>
<span id="el<?php echo $position_ref_delete->RowCount ?>_position_ref_RequisiteQualification" class="position_ref_RequisiteQualification">
<span<?php echo $position_ref_delete->RequisiteQualification->viewAttributes() ?>><?php echo $position_ref_delete->RequisiteQualification->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($position_ref_delete->JobCode->Visible) { // JobCode ?>
		<td <?php echo $position_ref_delete->JobCode->cellAttributes() ?>>
<span id="el<?php echo $position_ref_delete->RowCount ?>_position_ref_JobCode" class="position_ref_JobCode">
<span<?php echo $position_ref_delete->JobCode->viewAttributes() ?>><?php echo $position_ref_delete->JobCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($position_ref_delete->SalaryScale->Visible) { // SalaryScale ?>
		<td <?php echo $position_ref_delete->SalaryScale->cellAttributes() ?>>
<span id="el<?php echo $position_ref_delete->RowCount ?>_position_ref_SalaryScale" class="position_ref_SalaryScale">
<span<?php echo $position_ref_delete->SalaryScale->viewAttributes() ?>><?php echo $position_ref_delete->SalaryScale->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($position_ref_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<td <?php echo $position_ref_delete->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $position_ref_delete->RowCount ?>_position_ref_ProvinceCode" class="position_ref_ProvinceCode">
<span<?php echo $position_ref_delete->ProvinceCode->viewAttributes() ?>><?php echo $position_ref_delete->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($position_ref_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $position_ref_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $position_ref_delete->RowCount ?>_position_ref_LACode" class="position_ref_LACode">
<span<?php echo $position_ref_delete->LACode->viewAttributes() ?>><?php echo $position_ref_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($position_ref_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<td <?php echo $position_ref_delete->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $position_ref_delete->RowCount ?>_position_ref_DepartmentCode" class="position_ref_DepartmentCode">
<span<?php echo $position_ref_delete->DepartmentCode->viewAttributes() ?>><?php echo $position_ref_delete->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($position_ref_delete->FieldQualified->Visible) { // FieldQualified ?>
		<td <?php echo $position_ref_delete->FieldQualified->cellAttributes() ?>>
<span id="el<?php echo $position_ref_delete->RowCount ?>_position_ref_FieldQualified" class="position_ref_FieldQualified">
<span<?php echo $position_ref_delete->FieldQualified->viewAttributes() ?>><?php echo $position_ref_delete->FieldQualified->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$position_ref_delete->Recordset->moveNext();
}
$position_ref_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $position_ref_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$position_ref_delete->showPageFooter();
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
$position_ref_delete->terminate();
?>