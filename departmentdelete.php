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
$department_delete = new department_delete();

// Run the page
$department_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$department_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdepartmentdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdepartmentdelete = currentForm = new ew.Form("fdepartmentdelete", "delete");
	loadjs.done("fdepartmentdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $department_delete->showPageHeader(); ?>
<?php
$department_delete->showMessage();
?>
<form name="fdepartmentdelete" id="fdepartmentdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="department">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($department_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($department_delete->DepartmentName->Visible) { // DepartmentName ?>
		<th class="<?php echo $department_delete->DepartmentName->headerCellClass() ?>"><span id="elh_department_DepartmentName" class="department_DepartmentName"><?php echo $department_delete->DepartmentName->caption() ?></span></th>
<?php } ?>
<?php if ($department_delete->Telephone->Visible) { // Telephone ?>
		<th class="<?php echo $department_delete->Telephone->headerCellClass() ?>"><span id="elh_department_Telephone" class="department_Telephone"><?php echo $department_delete->Telephone->caption() ?></span></th>
<?php } ?>
<?php if ($department_delete->_Email->Visible) { // Email ?>
		<th class="<?php echo $department_delete->_Email->headerCellClass() ?>"><span id="elh_department__Email" class="department__Email"><?php echo $department_delete->_Email->caption() ?></span></th>
<?php } ?>
<?php if ($department_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $department_delete->LACode->headerCellClass() ?>"><span id="elh_department_LACode" class="department_LACode"><?php echo $department_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($department_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<th class="<?php echo $department_delete->ProvinceCode->headerCellClass() ?>"><span id="elh_department_ProvinceCode" class="department_ProvinceCode"><?php echo $department_delete->ProvinceCode->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$department_delete->RecordCount = 0;
$i = 0;
while (!$department_delete->Recordset->EOF) {
	$department_delete->RecordCount++;
	$department_delete->RowCount++;

	// Set row properties
	$department->resetAttributes();
	$department->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$department_delete->loadRowValues($department_delete->Recordset);

	// Render row
	$department_delete->renderRow();
?>
	<tr <?php echo $department->rowAttributes() ?>>
<?php if ($department_delete->DepartmentName->Visible) { // DepartmentName ?>
		<td <?php echo $department_delete->DepartmentName->cellAttributes() ?>>
<span id="el<?php echo $department_delete->RowCount ?>_department_DepartmentName" class="department_DepartmentName">
<span<?php echo $department_delete->DepartmentName->viewAttributes() ?>><?php echo $department_delete->DepartmentName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($department_delete->Telephone->Visible) { // Telephone ?>
		<td <?php echo $department_delete->Telephone->cellAttributes() ?>>
<span id="el<?php echo $department_delete->RowCount ?>_department_Telephone" class="department_Telephone">
<span<?php echo $department_delete->Telephone->viewAttributes() ?>><?php echo $department_delete->Telephone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($department_delete->_Email->Visible) { // Email ?>
		<td <?php echo $department_delete->_Email->cellAttributes() ?>>
<span id="el<?php echo $department_delete->RowCount ?>_department__Email" class="department__Email">
<span<?php echo $department_delete->_Email->viewAttributes() ?>><?php echo $department_delete->_Email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($department_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $department_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $department_delete->RowCount ?>_department_LACode" class="department_LACode">
<span<?php echo $department_delete->LACode->viewAttributes() ?>><?php echo $department_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($department_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<td <?php echo $department_delete->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $department_delete->RowCount ?>_department_ProvinceCode" class="department_ProvinceCode">
<span<?php echo $department_delete->ProvinceCode->viewAttributes() ?>><?php echo $department_delete->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$department_delete->Recordset->moveNext();
}
$department_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $department_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$department_delete->showPageFooter();
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
$department_delete->terminate();
?>