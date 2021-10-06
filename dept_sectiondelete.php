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
$dept_section_delete = new dept_section_delete();

// Run the page
$dept_section_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dept_section_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdept_sectiondelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdept_sectiondelete = currentForm = new ew.Form("fdept_sectiondelete", "delete");
	loadjs.done("fdept_sectiondelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $dept_section_delete->showPageHeader(); ?>
<?php
$dept_section_delete->showMessage();
?>
<form name="fdept_sectiondelete" id="fdept_sectiondelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dept_section">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($dept_section_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($dept_section_delete->SectionName->Visible) { // SectionName ?>
		<th class="<?php echo $dept_section_delete->SectionName->headerCellClass() ?>"><span id="elh_dept_section_SectionName" class="dept_section_SectionName"><?php echo $dept_section_delete->SectionName->caption() ?></span></th>
<?php } ?>
<?php if ($dept_section_delete->Telephone->Visible) { // Telephone ?>
		<th class="<?php echo $dept_section_delete->Telephone->headerCellClass() ?>"><span id="elh_dept_section_Telephone" class="dept_section_Telephone"><?php echo $dept_section_delete->Telephone->caption() ?></span></th>
<?php } ?>
<?php if ($dept_section_delete->_Email->Visible) { // Email ?>
		<th class="<?php echo $dept_section_delete->_Email->headerCellClass() ?>"><span id="elh_dept_section__Email" class="dept_section__Email"><?php echo $dept_section_delete->_Email->caption() ?></span></th>
<?php } ?>
<?php if ($dept_section_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<th class="<?php echo $dept_section_delete->ProvinceCode->headerCellClass() ?>"><span id="elh_dept_section_ProvinceCode" class="dept_section_ProvinceCode"><?php echo $dept_section_delete->ProvinceCode->caption() ?></span></th>
<?php } ?>
<?php if ($dept_section_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $dept_section_delete->LACode->headerCellClass() ?>"><span id="elh_dept_section_LACode" class="dept_section_LACode"><?php echo $dept_section_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($dept_section_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<th class="<?php echo $dept_section_delete->DepartmentCode->headerCellClass() ?>"><span id="elh_dept_section_DepartmentCode" class="dept_section_DepartmentCode"><?php echo $dept_section_delete->DepartmentCode->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$dept_section_delete->RecordCount = 0;
$i = 0;
while (!$dept_section_delete->Recordset->EOF) {
	$dept_section_delete->RecordCount++;
	$dept_section_delete->RowCount++;

	// Set row properties
	$dept_section->resetAttributes();
	$dept_section->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$dept_section_delete->loadRowValues($dept_section_delete->Recordset);

	// Render row
	$dept_section_delete->renderRow();
?>
	<tr <?php echo $dept_section->rowAttributes() ?>>
<?php if ($dept_section_delete->SectionName->Visible) { // SectionName ?>
		<td <?php echo $dept_section_delete->SectionName->cellAttributes() ?>>
<span id="el<?php echo $dept_section_delete->RowCount ?>_dept_section_SectionName" class="dept_section_SectionName">
<span<?php echo $dept_section_delete->SectionName->viewAttributes() ?>><?php echo $dept_section_delete->SectionName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dept_section_delete->Telephone->Visible) { // Telephone ?>
		<td <?php echo $dept_section_delete->Telephone->cellAttributes() ?>>
<span id="el<?php echo $dept_section_delete->RowCount ?>_dept_section_Telephone" class="dept_section_Telephone">
<span<?php echo $dept_section_delete->Telephone->viewAttributes() ?>><?php echo $dept_section_delete->Telephone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dept_section_delete->_Email->Visible) { // Email ?>
		<td <?php echo $dept_section_delete->_Email->cellAttributes() ?>>
<span id="el<?php echo $dept_section_delete->RowCount ?>_dept_section__Email" class="dept_section__Email">
<span<?php echo $dept_section_delete->_Email->viewAttributes() ?>><?php echo $dept_section_delete->_Email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dept_section_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<td <?php echo $dept_section_delete->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $dept_section_delete->RowCount ?>_dept_section_ProvinceCode" class="dept_section_ProvinceCode">
<span<?php echo $dept_section_delete->ProvinceCode->viewAttributes() ?>><?php echo $dept_section_delete->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dept_section_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $dept_section_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $dept_section_delete->RowCount ?>_dept_section_LACode" class="dept_section_LACode">
<span<?php echo $dept_section_delete->LACode->viewAttributes() ?>><?php echo $dept_section_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dept_section_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<td <?php echo $dept_section_delete->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $dept_section_delete->RowCount ?>_dept_section_DepartmentCode" class="dept_section_DepartmentCode">
<span<?php echo $dept_section_delete->DepartmentCode->viewAttributes() ?>><?php echo $dept_section_delete->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$dept_section_delete->Recordset->moveNext();
}
$dept_section_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $dept_section_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$dept_section_delete->showPageFooter();
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
$dept_section_delete->terminate();
?>