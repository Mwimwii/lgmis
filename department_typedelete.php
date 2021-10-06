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
$department_type_delete = new department_type_delete();

// Run the page
$department_type_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$department_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdepartment_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdepartment_typedelete = currentForm = new ew.Form("fdepartment_typedelete", "delete");
	loadjs.done("fdepartment_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $department_type_delete->showPageHeader(); ?>
<?php
$department_type_delete->showMessage();
?>
<form name="fdepartment_typedelete" id="fdepartment_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="department_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($department_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($department_type_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<th class="<?php echo $department_type_delete->DepartmentCode->headerCellClass() ?>"><span id="elh_department_type_DepartmentCode" class="department_type_DepartmentCode"><?php echo $department_type_delete->DepartmentCode->caption() ?></span></th>
<?php } ?>
<?php if ($department_type_delete->DepartmentName->Visible) { // DepartmentName ?>
		<th class="<?php echo $department_type_delete->DepartmentName->headerCellClass() ?>"><span id="elh_department_type_DepartmentName" class="department_type_DepartmentName"><?php echo $department_type_delete->DepartmentName->caption() ?></span></th>
<?php } ?>
<?php if ($department_type_delete->CouncilType->Visible) { // CouncilType ?>
		<th class="<?php echo $department_type_delete->CouncilType->headerCellClass() ?>"><span id="elh_department_type_CouncilType" class="department_type_CouncilType"><?php echo $department_type_delete->CouncilType->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$department_type_delete->RecordCount = 0;
$i = 0;
while (!$department_type_delete->Recordset->EOF) {
	$department_type_delete->RecordCount++;
	$department_type_delete->RowCount++;

	// Set row properties
	$department_type->resetAttributes();
	$department_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$department_type_delete->loadRowValues($department_type_delete->Recordset);

	// Render row
	$department_type_delete->renderRow();
?>
	<tr <?php echo $department_type->rowAttributes() ?>>
<?php if ($department_type_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<td <?php echo $department_type_delete->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $department_type_delete->RowCount ?>_department_type_DepartmentCode" class="department_type_DepartmentCode">
<span<?php echo $department_type_delete->DepartmentCode->viewAttributes() ?>><?php echo $department_type_delete->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($department_type_delete->DepartmentName->Visible) { // DepartmentName ?>
		<td <?php echo $department_type_delete->DepartmentName->cellAttributes() ?>>
<span id="el<?php echo $department_type_delete->RowCount ?>_department_type_DepartmentName" class="department_type_DepartmentName">
<span<?php echo $department_type_delete->DepartmentName->viewAttributes() ?>><?php echo $department_type_delete->DepartmentName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($department_type_delete->CouncilType->Visible) { // CouncilType ?>
		<td <?php echo $department_type_delete->CouncilType->cellAttributes() ?>>
<span id="el<?php echo $department_type_delete->RowCount ?>_department_type_CouncilType" class="department_type_CouncilType">
<span<?php echo $department_type_delete->CouncilType->viewAttributes() ?>><?php echo $department_type_delete->CouncilType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$department_type_delete->Recordset->moveNext();
}
$department_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $department_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$department_type_delete->showPageFooter();
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
$department_type_delete->terminate();
?>