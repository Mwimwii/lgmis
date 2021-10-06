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
$salary_notch_delete = new salary_notch_delete();

// Run the page
$salary_notch_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$salary_notch_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsalary_notchdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fsalary_notchdelete = currentForm = new ew.Form("fsalary_notchdelete", "delete");
	loadjs.done("fsalary_notchdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $salary_notch_delete->showPageHeader(); ?>
<?php
$salary_notch_delete->showMessage();
?>
<form name="fsalary_notchdelete" id="fsalary_notchdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="salary_notch">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($salary_notch_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($salary_notch_delete->SalaryScale->Visible) { // SalaryScale ?>
		<th class="<?php echo $salary_notch_delete->SalaryScale->headerCellClass() ?>"><span id="elh_salary_notch_SalaryScale" class="salary_notch_SalaryScale"><?php echo $salary_notch_delete->SalaryScale->caption() ?></span></th>
<?php } ?>
<?php if ($salary_notch_delete->Notch->Visible) { // Notch ?>
		<th class="<?php echo $salary_notch_delete->Notch->headerCellClass() ?>"><span id="elh_salary_notch_Notch" class="salary_notch_Notch"><?php echo $salary_notch_delete->Notch->caption() ?></span></th>
<?php } ?>
<?php if ($salary_notch_delete->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
		<th class="<?php echo $salary_notch_delete->BasicMonthlySalary->headerCellClass() ?>"><span id="elh_salary_notch_BasicMonthlySalary" class="salary_notch_BasicMonthlySalary"><?php echo $salary_notch_delete->BasicMonthlySalary->caption() ?></span></th>
<?php } ?>
<?php if ($salary_notch_delete->AnnualSalary->Visible) { // AnnualSalary ?>
		<th class="<?php echo $salary_notch_delete->AnnualSalary->headerCellClass() ?>"><span id="elh_salary_notch_AnnualSalary" class="salary_notch_AnnualSalary"><?php echo $salary_notch_delete->AnnualSalary->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$salary_notch_delete->RecordCount = 0;
$i = 0;
while (!$salary_notch_delete->Recordset->EOF) {
	$salary_notch_delete->RecordCount++;
	$salary_notch_delete->RowCount++;

	// Set row properties
	$salary_notch->resetAttributes();
	$salary_notch->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$salary_notch_delete->loadRowValues($salary_notch_delete->Recordset);

	// Render row
	$salary_notch_delete->renderRow();
?>
	<tr <?php echo $salary_notch->rowAttributes() ?>>
<?php if ($salary_notch_delete->SalaryScale->Visible) { // SalaryScale ?>
		<td <?php echo $salary_notch_delete->SalaryScale->cellAttributes() ?>>
<span id="el<?php echo $salary_notch_delete->RowCount ?>_salary_notch_SalaryScale" class="salary_notch_SalaryScale">
<span<?php echo $salary_notch_delete->SalaryScale->viewAttributes() ?>><?php echo $salary_notch_delete->SalaryScale->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($salary_notch_delete->Notch->Visible) { // Notch ?>
		<td <?php echo $salary_notch_delete->Notch->cellAttributes() ?>>
<span id="el<?php echo $salary_notch_delete->RowCount ?>_salary_notch_Notch" class="salary_notch_Notch">
<span<?php echo $salary_notch_delete->Notch->viewAttributes() ?>><?php echo $salary_notch_delete->Notch->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($salary_notch_delete->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
		<td <?php echo $salary_notch_delete->BasicMonthlySalary->cellAttributes() ?>>
<span id="el<?php echo $salary_notch_delete->RowCount ?>_salary_notch_BasicMonthlySalary" class="salary_notch_BasicMonthlySalary">
<span<?php echo $salary_notch_delete->BasicMonthlySalary->viewAttributes() ?>><?php echo $salary_notch_delete->BasicMonthlySalary->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($salary_notch_delete->AnnualSalary->Visible) { // AnnualSalary ?>
		<td <?php echo $salary_notch_delete->AnnualSalary->cellAttributes() ?>>
<span id="el<?php echo $salary_notch_delete->RowCount ?>_salary_notch_AnnualSalary" class="salary_notch_AnnualSalary">
<span<?php echo $salary_notch_delete->AnnualSalary->viewAttributes() ?>><?php echo $salary_notch_delete->AnnualSalary->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$salary_notch_delete->Recordset->moveNext();
}
$salary_notch_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $salary_notch_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$salary_notch_delete->showPageFooter();
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
$salary_notch_delete->terminate();
?>