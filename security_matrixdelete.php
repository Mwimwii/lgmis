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
$security_matrix_delete = new security_matrix_delete();

// Run the page
$security_matrix_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$security_matrix_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsecurity_matrixdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fsecurity_matrixdelete = currentForm = new ew.Form("fsecurity_matrixdelete", "delete");
	loadjs.done("fsecurity_matrixdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $security_matrix_delete->showPageHeader(); ?>
<?php
$security_matrix_delete->showMessage();
?>
<form name="fsecurity_matrixdelete" id="fsecurity_matrixdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="security_matrix">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($security_matrix_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($security_matrix_delete->UserCode->Visible) { // UserCode ?>
		<th class="<?php echo $security_matrix_delete->UserCode->headerCellClass() ?>"><span id="elh_security_matrix_UserCode" class="security_matrix_UserCode"><?php echo $security_matrix_delete->UserCode->caption() ?></span></th>
<?php } ?>
<?php if ($security_matrix_delete->PeriodCode->Visible) { // PeriodCode ?>
		<th class="<?php echo $security_matrix_delete->PeriodCode->headerCellClass() ?>"><span id="elh_security_matrix_PeriodCode" class="security_matrix_PeriodCode"><?php echo $security_matrix_delete->PeriodCode->caption() ?></span></th>
<?php } ?>
<?php if ($security_matrix_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<th class="<?php echo $security_matrix_delete->ProvinceCode->headerCellClass() ?>"><span id="elh_security_matrix_ProvinceCode" class="security_matrix_ProvinceCode"><?php echo $security_matrix_delete->ProvinceCode->caption() ?></span></th>
<?php } ?>
<?php if ($security_matrix_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $security_matrix_delete->LACode->headerCellClass() ?>"><span id="elh_security_matrix_LACode" class="security_matrix_LACode"><?php echo $security_matrix_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($security_matrix_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<th class="<?php echo $security_matrix_delete->DepartmentCode->headerCellClass() ?>"><span id="elh_security_matrix_DepartmentCode" class="security_matrix_DepartmentCode"><?php echo $security_matrix_delete->DepartmentCode->caption() ?></span></th>
<?php } ?>
<?php if ($security_matrix_delete->SectionCode->Visible) { // SectionCode ?>
		<th class="<?php echo $security_matrix_delete->SectionCode->headerCellClass() ?>"><span id="elh_security_matrix_SectionCode" class="security_matrix_SectionCode"><?php echo $security_matrix_delete->SectionCode->caption() ?></span></th>
<?php } ?>
<?php if ($security_matrix_delete->SecurityNumber->Visible) { // SecurityNumber ?>
		<th class="<?php echo $security_matrix_delete->SecurityNumber->headerCellClass() ?>"><span id="elh_security_matrix_SecurityNumber" class="security_matrix_SecurityNumber"><?php echo $security_matrix_delete->SecurityNumber->caption() ?></span></th>
<?php } ?>
<?php if ($security_matrix_delete->ValidFrom->Visible) { // ValidFrom ?>
		<th class="<?php echo $security_matrix_delete->ValidFrom->headerCellClass() ?>"><span id="elh_security_matrix_ValidFrom" class="security_matrix_ValidFrom"><?php echo $security_matrix_delete->ValidFrom->caption() ?></span></th>
<?php } ?>
<?php if ($security_matrix_delete->ValidTo->Visible) { // ValidTo ?>
		<th class="<?php echo $security_matrix_delete->ValidTo->headerCellClass() ?>"><span id="elh_security_matrix_ValidTo" class="security_matrix_ValidTo"><?php echo $security_matrix_delete->ValidTo->caption() ?></span></th>
<?php } ?>
<?php if ($security_matrix_delete->ApproveLevel->Visible) { // ApproveLevel ?>
		<th class="<?php echo $security_matrix_delete->ApproveLevel->headerCellClass() ?>"><span id="elh_security_matrix_ApproveLevel" class="security_matrix_ApproveLevel"><?php echo $security_matrix_delete->ApproveLevel->caption() ?></span></th>
<?php } ?>
<?php if ($security_matrix_delete->ActivityCode->Visible) { // ActivityCode ?>
		<th class="<?php echo $security_matrix_delete->ActivityCode->headerCellClass() ?>"><span id="elh_security_matrix_ActivityCode" class="security_matrix_ActivityCode"><?php echo $security_matrix_delete->ActivityCode->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$security_matrix_delete->RecordCount = 0;
$i = 0;
while (!$security_matrix_delete->Recordset->EOF) {
	$security_matrix_delete->RecordCount++;
	$security_matrix_delete->RowCount++;

	// Set row properties
	$security_matrix->resetAttributes();
	$security_matrix->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$security_matrix_delete->loadRowValues($security_matrix_delete->Recordset);

	// Render row
	$security_matrix_delete->renderRow();
?>
	<tr <?php echo $security_matrix->rowAttributes() ?>>
<?php if ($security_matrix_delete->UserCode->Visible) { // UserCode ?>
		<td <?php echo $security_matrix_delete->UserCode->cellAttributes() ?>>
<span id="el<?php echo $security_matrix_delete->RowCount ?>_security_matrix_UserCode" class="security_matrix_UserCode">
<span<?php echo $security_matrix_delete->UserCode->viewAttributes() ?>><?php echo $security_matrix_delete->UserCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($security_matrix_delete->PeriodCode->Visible) { // PeriodCode ?>
		<td <?php echo $security_matrix_delete->PeriodCode->cellAttributes() ?>>
<span id="el<?php echo $security_matrix_delete->RowCount ?>_security_matrix_PeriodCode" class="security_matrix_PeriodCode">
<span<?php echo $security_matrix_delete->PeriodCode->viewAttributes() ?>><?php echo $security_matrix_delete->PeriodCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($security_matrix_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<td <?php echo $security_matrix_delete->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $security_matrix_delete->RowCount ?>_security_matrix_ProvinceCode" class="security_matrix_ProvinceCode">
<span<?php echo $security_matrix_delete->ProvinceCode->viewAttributes() ?>><?php echo $security_matrix_delete->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($security_matrix_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $security_matrix_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $security_matrix_delete->RowCount ?>_security_matrix_LACode" class="security_matrix_LACode">
<span<?php echo $security_matrix_delete->LACode->viewAttributes() ?>><?php echo $security_matrix_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($security_matrix_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<td <?php echo $security_matrix_delete->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $security_matrix_delete->RowCount ?>_security_matrix_DepartmentCode" class="security_matrix_DepartmentCode">
<span<?php echo $security_matrix_delete->DepartmentCode->viewAttributes() ?>><?php echo $security_matrix_delete->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($security_matrix_delete->SectionCode->Visible) { // SectionCode ?>
		<td <?php echo $security_matrix_delete->SectionCode->cellAttributes() ?>>
<span id="el<?php echo $security_matrix_delete->RowCount ?>_security_matrix_SectionCode" class="security_matrix_SectionCode">
<span<?php echo $security_matrix_delete->SectionCode->viewAttributes() ?>><?php echo $security_matrix_delete->SectionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($security_matrix_delete->SecurityNumber->Visible) { // SecurityNumber ?>
		<td <?php echo $security_matrix_delete->SecurityNumber->cellAttributes() ?>>
<span id="el<?php echo $security_matrix_delete->RowCount ?>_security_matrix_SecurityNumber" class="security_matrix_SecurityNumber">
<span<?php echo $security_matrix_delete->SecurityNumber->viewAttributes() ?>><?php echo $security_matrix_delete->SecurityNumber->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($security_matrix_delete->ValidFrom->Visible) { // ValidFrom ?>
		<td <?php echo $security_matrix_delete->ValidFrom->cellAttributes() ?>>
<span id="el<?php echo $security_matrix_delete->RowCount ?>_security_matrix_ValidFrom" class="security_matrix_ValidFrom">
<span<?php echo $security_matrix_delete->ValidFrom->viewAttributes() ?>><?php echo $security_matrix_delete->ValidFrom->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($security_matrix_delete->ValidTo->Visible) { // ValidTo ?>
		<td <?php echo $security_matrix_delete->ValidTo->cellAttributes() ?>>
<span id="el<?php echo $security_matrix_delete->RowCount ?>_security_matrix_ValidTo" class="security_matrix_ValidTo">
<span<?php echo $security_matrix_delete->ValidTo->viewAttributes() ?>><?php echo $security_matrix_delete->ValidTo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($security_matrix_delete->ApproveLevel->Visible) { // ApproveLevel ?>
		<td <?php echo $security_matrix_delete->ApproveLevel->cellAttributes() ?>>
<span id="el<?php echo $security_matrix_delete->RowCount ?>_security_matrix_ApproveLevel" class="security_matrix_ApproveLevel">
<span<?php echo $security_matrix_delete->ApproveLevel->viewAttributes() ?>><?php echo $security_matrix_delete->ApproveLevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($security_matrix_delete->ActivityCode->Visible) { // ActivityCode ?>
		<td <?php echo $security_matrix_delete->ActivityCode->cellAttributes() ?>>
<span id="el<?php echo $security_matrix_delete->RowCount ?>_security_matrix_ActivityCode" class="security_matrix_ActivityCode">
<span<?php echo $security_matrix_delete->ActivityCode->viewAttributes() ?>><?php echo $security_matrix_delete->ActivityCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$security_matrix_delete->Recordset->moveNext();
}
$security_matrix_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $security_matrix_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$security_matrix_delete->showPageFooter();
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
$security_matrix_delete->terminate();
?>