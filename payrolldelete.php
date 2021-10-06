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
$payroll_delete = new payroll_delete();

// Run the page
$payroll_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payroll_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpayrolldelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpayrolldelete = currentForm = new ew.Form("fpayrolldelete", "delete");
	loadjs.done("fpayrolldelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $payroll_delete->showPageHeader(); ?>
<?php
$payroll_delete->showMessage();
?>
<form name="fpayrolldelete" id="fpayrolldelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payroll">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($payroll_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($payroll_delete->PayrollCode->Visible) { // PayrollCode ?>
		<th class="<?php echo $payroll_delete->PayrollCode->headerCellClass() ?>"><span id="elh_payroll_PayrollCode" class="payroll_PayrollCode"><?php echo $payroll_delete->PayrollCode->caption() ?></span></th>
<?php } ?>
<?php if ($payroll_delete->PayrollName->Visible) { // PayrollName ?>
		<th class="<?php echo $payroll_delete->PayrollName->headerCellClass() ?>"><span id="elh_payroll_PayrollName" class="payroll_PayrollName"><?php echo $payroll_delete->PayrollName->caption() ?></span></th>
<?php } ?>
<?php if ($payroll_delete->PayrollDescription->Visible) { // PayrollDescription ?>
		<th class="<?php echo $payroll_delete->PayrollDescription->headerCellClass() ?>"><span id="elh_payroll_PayrollDescription" class="payroll_PayrollDescription"><?php echo $payroll_delete->PayrollDescription->caption() ?></span></th>
<?php } ?>
<?php if ($payroll_delete->Division->Visible) { // Division ?>
		<th class="<?php echo $payroll_delete->Division->headerCellClass() ?>"><span id="elh_payroll_Division" class="payroll_Division"><?php echo $payroll_delete->Division->caption() ?></span></th>
<?php } ?>
<?php if ($payroll_delete->LAcode->Visible) { // LAcode ?>
		<th class="<?php echo $payroll_delete->LAcode->headerCellClass() ?>"><span id="elh_payroll_LAcode" class="payroll_LAcode"><?php echo $payroll_delete->LAcode->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$payroll_delete->RecordCount = 0;
$i = 0;
while (!$payroll_delete->Recordset->EOF) {
	$payroll_delete->RecordCount++;
	$payroll_delete->RowCount++;

	// Set row properties
	$payroll->resetAttributes();
	$payroll->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$payroll_delete->loadRowValues($payroll_delete->Recordset);

	// Render row
	$payroll_delete->renderRow();
?>
	<tr <?php echo $payroll->rowAttributes() ?>>
<?php if ($payroll_delete->PayrollCode->Visible) { // PayrollCode ?>
		<td <?php echo $payroll_delete->PayrollCode->cellAttributes() ?>>
<span id="el<?php echo $payroll_delete->RowCount ?>_payroll_PayrollCode" class="payroll_PayrollCode">
<span<?php echo $payroll_delete->PayrollCode->viewAttributes() ?>><?php echo $payroll_delete->PayrollCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payroll_delete->PayrollName->Visible) { // PayrollName ?>
		<td <?php echo $payroll_delete->PayrollName->cellAttributes() ?>>
<span id="el<?php echo $payroll_delete->RowCount ?>_payroll_PayrollName" class="payroll_PayrollName">
<span<?php echo $payroll_delete->PayrollName->viewAttributes() ?>><?php echo $payroll_delete->PayrollName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payroll_delete->PayrollDescription->Visible) { // PayrollDescription ?>
		<td <?php echo $payroll_delete->PayrollDescription->cellAttributes() ?>>
<span id="el<?php echo $payroll_delete->RowCount ?>_payroll_PayrollDescription" class="payroll_PayrollDescription">
<span<?php echo $payroll_delete->PayrollDescription->viewAttributes() ?>><?php echo $payroll_delete->PayrollDescription->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payroll_delete->Division->Visible) { // Division ?>
		<td <?php echo $payroll_delete->Division->cellAttributes() ?>>
<span id="el<?php echo $payroll_delete->RowCount ?>_payroll_Division" class="payroll_Division">
<span<?php echo $payroll_delete->Division->viewAttributes() ?>><?php echo $payroll_delete->Division->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payroll_delete->LAcode->Visible) { // LAcode ?>
		<td <?php echo $payroll_delete->LAcode->cellAttributes() ?>>
<span id="el<?php echo $payroll_delete->RowCount ?>_payroll_LAcode" class="payroll_LAcode">
<span<?php echo $payroll_delete->LAcode->viewAttributes() ?>><?php echo $payroll_delete->LAcode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$payroll_delete->Recordset->moveNext();
}
$payroll_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $payroll_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$payroll_delete->showPageFooter();
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
$payroll_delete->terminate();
?>