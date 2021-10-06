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
$payroll_period_delete = new payroll_period_delete();

// Run the page
$payroll_period_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payroll_period_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpayroll_perioddelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpayroll_perioddelete = currentForm = new ew.Form("fpayroll_perioddelete", "delete");
	loadjs.done("fpayroll_perioddelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $payroll_period_delete->showPageHeader(); ?>
<?php
$payroll_period_delete->showMessage();
?>
<form name="fpayroll_perioddelete" id="fpayroll_perioddelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payroll_period">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($payroll_period_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($payroll_period_delete->PeriodCode->Visible) { // PeriodCode ?>
		<th class="<?php echo $payroll_period_delete->PeriodCode->headerCellClass() ?>"><span id="elh_payroll_period_PeriodCode" class="payroll_period_PeriodCode"><?php echo $payroll_period_delete->PeriodCode->caption() ?></span></th>
<?php } ?>
<?php if ($payroll_period_delete->FiscalYear->Visible) { // FiscalYear ?>
		<th class="<?php echo $payroll_period_delete->FiscalYear->headerCellClass() ?>"><span id="elh_payroll_period_FiscalYear" class="payroll_period_FiscalYear"><?php echo $payroll_period_delete->FiscalYear->caption() ?></span></th>
<?php } ?>
<?php if ($payroll_period_delete->RunMonth->Visible) { // RunMonth ?>
		<th class="<?php echo $payroll_period_delete->RunMonth->headerCellClass() ?>"><span id="elh_payroll_period_RunMonth" class="payroll_period_RunMonth"><?php echo $payroll_period_delete->RunMonth->caption() ?></span></th>
<?php } ?>
<?php if ($payroll_period_delete->RunDescription->Visible) { // RunDescription ?>
		<th class="<?php echo $payroll_period_delete->RunDescription->headerCellClass() ?>"><span id="elh_payroll_period_RunDescription" class="payroll_period_RunDescription"><?php echo $payroll_period_delete->RunDescription->caption() ?></span></th>
<?php } ?>
<?php if ($payroll_period_delete->CurrentPeriod->Visible) { // CurrentPeriod ?>
		<th class="<?php echo $payroll_period_delete->CurrentPeriod->headerCellClass() ?>"><span id="elh_payroll_period_CurrentPeriod" class="payroll_period_CurrentPeriod"><?php echo $payroll_period_delete->CurrentPeriod->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$payroll_period_delete->RecordCount = 0;
$i = 0;
while (!$payroll_period_delete->Recordset->EOF) {
	$payroll_period_delete->RecordCount++;
	$payroll_period_delete->RowCount++;

	// Set row properties
	$payroll_period->resetAttributes();
	$payroll_period->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$payroll_period_delete->loadRowValues($payroll_period_delete->Recordset);

	// Render row
	$payroll_period_delete->renderRow();
?>
	<tr <?php echo $payroll_period->rowAttributes() ?>>
<?php if ($payroll_period_delete->PeriodCode->Visible) { // PeriodCode ?>
		<td <?php echo $payroll_period_delete->PeriodCode->cellAttributes() ?>>
<span id="el<?php echo $payroll_period_delete->RowCount ?>_payroll_period_PeriodCode" class="payroll_period_PeriodCode">
<span<?php echo $payroll_period_delete->PeriodCode->viewAttributes() ?>><?php echo $payroll_period_delete->PeriodCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payroll_period_delete->FiscalYear->Visible) { // FiscalYear ?>
		<td <?php echo $payroll_period_delete->FiscalYear->cellAttributes() ?>>
<span id="el<?php echo $payroll_period_delete->RowCount ?>_payroll_period_FiscalYear" class="payroll_period_FiscalYear">
<span<?php echo $payroll_period_delete->FiscalYear->viewAttributes() ?>><?php echo $payroll_period_delete->FiscalYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payroll_period_delete->RunMonth->Visible) { // RunMonth ?>
		<td <?php echo $payroll_period_delete->RunMonth->cellAttributes() ?>>
<span id="el<?php echo $payroll_period_delete->RowCount ?>_payroll_period_RunMonth" class="payroll_period_RunMonth">
<span<?php echo $payroll_period_delete->RunMonth->viewAttributes() ?>><?php echo $payroll_period_delete->RunMonth->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payroll_period_delete->RunDescription->Visible) { // RunDescription ?>
		<td <?php echo $payroll_period_delete->RunDescription->cellAttributes() ?>>
<span id="el<?php echo $payroll_period_delete->RowCount ?>_payroll_period_RunDescription" class="payroll_period_RunDescription">
<span<?php echo $payroll_period_delete->RunDescription->viewAttributes() ?>><?php echo $payroll_period_delete->RunDescription->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payroll_period_delete->CurrentPeriod->Visible) { // CurrentPeriod ?>
		<td <?php echo $payroll_period_delete->CurrentPeriod->cellAttributes() ?>>
<span id="el<?php echo $payroll_period_delete->RowCount ?>_payroll_period_CurrentPeriod" class="payroll_period_CurrentPeriod">
<span<?php echo $payroll_period_delete->CurrentPeriod->viewAttributes() ?>><?php echo $payroll_period_delete->CurrentPeriod->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$payroll_period_delete->Recordset->moveNext();
}
$payroll_period_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $payroll_period_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$payroll_period_delete->showPageFooter();
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
$payroll_period_delete->terminate();
?>