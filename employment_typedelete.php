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
$employment_type_delete = new employment_type_delete();

// Run the page
$employment_type_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployment_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	femployment_typedelete = currentForm = new ew.Form("femployment_typedelete", "delete");
	loadjs.done("femployment_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employment_type_delete->showPageHeader(); ?>
<?php
$employment_type_delete->showMessage();
?>
<form name="femployment_typedelete" id="femployment_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employment_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($employment_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($employment_type_delete->EmploymentType->Visible) { // EmploymentType ?>
		<th class="<?php echo $employment_type_delete->EmploymentType->headerCellClass() ?>"><span id="elh_employment_type_EmploymentType" class="employment_type_EmploymentType"><?php echo $employment_type_delete->EmploymentType->caption() ?></span></th>
<?php } ?>
<?php if ($employment_type_delete->EmploymentTypeDesc->Visible) { // EmploymentTypeDesc ?>
		<th class="<?php echo $employment_type_delete->EmploymentTypeDesc->headerCellClass() ?>"><span id="elh_employment_type_EmploymentTypeDesc" class="employment_type_EmploymentTypeDesc"><?php echo $employment_type_delete->EmploymentTypeDesc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$employment_type_delete->RecordCount = 0;
$i = 0;
while (!$employment_type_delete->Recordset->EOF) {
	$employment_type_delete->RecordCount++;
	$employment_type_delete->RowCount++;

	// Set row properties
	$employment_type->resetAttributes();
	$employment_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$employment_type_delete->loadRowValues($employment_type_delete->Recordset);

	// Render row
	$employment_type_delete->renderRow();
?>
	<tr <?php echo $employment_type->rowAttributes() ?>>
<?php if ($employment_type_delete->EmploymentType->Visible) { // EmploymentType ?>
		<td <?php echo $employment_type_delete->EmploymentType->cellAttributes() ?>>
<span id="el<?php echo $employment_type_delete->RowCount ?>_employment_type_EmploymentType" class="employment_type_EmploymentType">
<span<?php echo $employment_type_delete->EmploymentType->viewAttributes() ?>><?php echo $employment_type_delete->EmploymentType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_type_delete->EmploymentTypeDesc->Visible) { // EmploymentTypeDesc ?>
		<td <?php echo $employment_type_delete->EmploymentTypeDesc->cellAttributes() ?>>
<span id="el<?php echo $employment_type_delete->RowCount ?>_employment_type_EmploymentTypeDesc" class="employment_type_EmploymentTypeDesc">
<span<?php echo $employment_type_delete->EmploymentTypeDesc->viewAttributes() ?>><?php echo $employment_type_delete->EmploymentTypeDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$employment_type_delete->Recordset->moveNext();
}
$employment_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employment_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$employment_type_delete->showPageFooter();
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
$employment_type_delete->terminate();
?>