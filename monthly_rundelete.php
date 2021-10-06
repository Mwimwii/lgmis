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
$monthly_run_delete = new monthly_run_delete();

// Run the page
$monthly_run_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$monthly_run_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmonthly_rundelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fmonthly_rundelete = currentForm = new ew.Form("fmonthly_rundelete", "delete");
	loadjs.done("fmonthly_rundelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $monthly_run_delete->showPageHeader(); ?>
<?php
$monthly_run_delete->showMessage();
?>
<form name="fmonthly_rundelete" id="fmonthly_rundelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="monthly_run">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($monthly_run_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($monthly_run_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $monthly_run_delete->LACode->headerCellClass() ?>"><span id="elh_monthly_run_LACode" class="monthly_run_LACode"><?php echo $monthly_run_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($monthly_run_delete->PeriodCode->Visible) { // PeriodCode ?>
		<th class="<?php echo $monthly_run_delete->PeriodCode->headerCellClass() ?>"><span id="elh_monthly_run_PeriodCode" class="monthly_run_PeriodCode"><?php echo $monthly_run_delete->PeriodCode->caption() ?></span></th>
<?php } ?>
<?php if ($monthly_run_delete->RunDate->Visible) { // RunDate ?>
		<th class="<?php echo $monthly_run_delete->RunDate->headerCellClass() ?>"><span id="elh_monthly_run_RunDate" class="monthly_run_RunDate"><?php echo $monthly_run_delete->RunDate->caption() ?></span></th>
<?php } ?>
<?php if ($monthly_run_delete->Description->Visible) { // Description ?>
		<th class="<?php echo $monthly_run_delete->Description->headerCellClass() ?>"><span id="elh_monthly_run_Description" class="monthly_run_Description"><?php echo $monthly_run_delete->Description->caption() ?></span></th>
<?php } ?>
<?php if ($monthly_run_delete->Year->Visible) { // Year ?>
		<th class="<?php echo $monthly_run_delete->Year->headerCellClass() ?>"><span id="elh_monthly_run_Year" class="monthly_run_Year"><?php echo $monthly_run_delete->Year->caption() ?></span></th>
<?php } ?>
<?php if ($monthly_run_delete->RunMonth->Visible) { // RunMonth ?>
		<th class="<?php echo $monthly_run_delete->RunMonth->headerCellClass() ?>"><span id="elh_monthly_run_RunMonth" class="monthly_run_RunMonth"><?php echo $monthly_run_delete->RunMonth->caption() ?></span></th>
<?php } ?>
<?php if ($monthly_run_delete->PayrollCode->Visible) { // PayrollCode ?>
		<th class="<?php echo $monthly_run_delete->PayrollCode->headerCellClass() ?>"><span id="elh_monthly_run_PayrollCode" class="monthly_run_PayrollCode"><?php echo $monthly_run_delete->PayrollCode->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$monthly_run_delete->RecordCount = 0;
$i = 0;
while (!$monthly_run_delete->Recordset->EOF) {
	$monthly_run_delete->RecordCount++;
	$monthly_run_delete->RowCount++;

	// Set row properties
	$monthly_run->resetAttributes();
	$monthly_run->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$monthly_run_delete->loadRowValues($monthly_run_delete->Recordset);

	// Render row
	$monthly_run_delete->renderRow();
?>
	<tr <?php echo $monthly_run->rowAttributes() ?>>
<?php if ($monthly_run_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $monthly_run_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $monthly_run_delete->RowCount ?>_monthly_run_LACode" class="monthly_run_LACode">
<span<?php echo $monthly_run_delete->LACode->viewAttributes() ?>><?php echo $monthly_run_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($monthly_run_delete->PeriodCode->Visible) { // PeriodCode ?>
		<td <?php echo $monthly_run_delete->PeriodCode->cellAttributes() ?>>
<span id="el<?php echo $monthly_run_delete->RowCount ?>_monthly_run_PeriodCode" class="monthly_run_PeriodCode">
<span<?php echo $monthly_run_delete->PeriodCode->viewAttributes() ?>><?php echo $monthly_run_delete->PeriodCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($monthly_run_delete->RunDate->Visible) { // RunDate ?>
		<td <?php echo $monthly_run_delete->RunDate->cellAttributes() ?>>
<span id="el<?php echo $monthly_run_delete->RowCount ?>_monthly_run_RunDate" class="monthly_run_RunDate">
<span<?php echo $monthly_run_delete->RunDate->viewAttributes() ?>><?php echo $monthly_run_delete->RunDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($monthly_run_delete->Description->Visible) { // Description ?>
		<td <?php echo $monthly_run_delete->Description->cellAttributes() ?>>
<span id="el<?php echo $monthly_run_delete->RowCount ?>_monthly_run_Description" class="monthly_run_Description">
<span<?php echo $monthly_run_delete->Description->viewAttributes() ?>><?php echo $monthly_run_delete->Description->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($monthly_run_delete->Year->Visible) { // Year ?>
		<td <?php echo $monthly_run_delete->Year->cellAttributes() ?>>
<span id="el<?php echo $monthly_run_delete->RowCount ?>_monthly_run_Year" class="monthly_run_Year">
<span<?php echo $monthly_run_delete->Year->viewAttributes() ?>><?php echo $monthly_run_delete->Year->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($monthly_run_delete->RunMonth->Visible) { // RunMonth ?>
		<td <?php echo $monthly_run_delete->RunMonth->cellAttributes() ?>>
<span id="el<?php echo $monthly_run_delete->RowCount ?>_monthly_run_RunMonth" class="monthly_run_RunMonth">
<span<?php echo $monthly_run_delete->RunMonth->viewAttributes() ?>><?php echo $monthly_run_delete->RunMonth->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($monthly_run_delete->PayrollCode->Visible) { // PayrollCode ?>
		<td <?php echo $monthly_run_delete->PayrollCode->cellAttributes() ?>>
<span id="el<?php echo $monthly_run_delete->RowCount ?>_monthly_run_PayrollCode" class="monthly_run_PayrollCode">
<span<?php echo $monthly_run_delete->PayrollCode->viewAttributes() ?>><?php echo $monthly_run_delete->PayrollCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$monthly_run_delete->Recordset->moveNext();
}
$monthly_run_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $monthly_run_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$monthly_run_delete->showPageFooter();
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
$monthly_run_delete->terminate();
?>