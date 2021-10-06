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
$period_type_delete = new period_type_delete();

// Run the page
$period_type_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$period_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fperiod_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fperiod_typedelete = currentForm = new ew.Form("fperiod_typedelete", "delete");
	loadjs.done("fperiod_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $period_type_delete->showPageHeader(); ?>
<?php
$period_type_delete->showMessage();
?>
<form name="fperiod_typedelete" id="fperiod_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="period_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($period_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($period_type_delete->Period_Type->Visible) { // Period_Type ?>
		<th class="<?php echo $period_type_delete->Period_Type->headerCellClass() ?>"><span id="elh_period_type_Period_Type" class="period_type_Period_Type"><?php echo $period_type_delete->Period_Type->caption() ?></span></th>
<?php } ?>
<?php if ($period_type_delete->PeriodTypeName->Visible) { // PeriodTypeName ?>
		<th class="<?php echo $period_type_delete->PeriodTypeName->headerCellClass() ?>"><span id="elh_period_type_PeriodTypeName" class="period_type_PeriodTypeName"><?php echo $period_type_delete->PeriodTypeName->caption() ?></span></th>
<?php } ?>
<?php if ($period_type_delete->PeriodLength->Visible) { // PeriodLength ?>
		<th class="<?php echo $period_type_delete->PeriodLength->headerCellClass() ?>"><span id="elh_period_type_PeriodLength" class="period_type_PeriodLength"><?php echo $period_type_delete->PeriodLength->caption() ?></span></th>
<?php } ?>
<?php if ($period_type_delete->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<th class="<?php echo $period_type_delete->UnitOfMeasure->headerCellClass() ?>"><span id="elh_period_type_UnitOfMeasure" class="period_type_UnitOfMeasure"><?php echo $period_type_delete->UnitOfMeasure->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$period_type_delete->RecordCount = 0;
$i = 0;
while (!$period_type_delete->Recordset->EOF) {
	$period_type_delete->RecordCount++;
	$period_type_delete->RowCount++;

	// Set row properties
	$period_type->resetAttributes();
	$period_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$period_type_delete->loadRowValues($period_type_delete->Recordset);

	// Render row
	$period_type_delete->renderRow();
?>
	<tr <?php echo $period_type->rowAttributes() ?>>
<?php if ($period_type_delete->Period_Type->Visible) { // Period_Type ?>
		<td <?php echo $period_type_delete->Period_Type->cellAttributes() ?>>
<span id="el<?php echo $period_type_delete->RowCount ?>_period_type_Period_Type" class="period_type_Period_Type">
<span<?php echo $period_type_delete->Period_Type->viewAttributes() ?>><?php echo $period_type_delete->Period_Type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($period_type_delete->PeriodTypeName->Visible) { // PeriodTypeName ?>
		<td <?php echo $period_type_delete->PeriodTypeName->cellAttributes() ?>>
<span id="el<?php echo $period_type_delete->RowCount ?>_period_type_PeriodTypeName" class="period_type_PeriodTypeName">
<span<?php echo $period_type_delete->PeriodTypeName->viewAttributes() ?>><?php echo $period_type_delete->PeriodTypeName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($period_type_delete->PeriodLength->Visible) { // PeriodLength ?>
		<td <?php echo $period_type_delete->PeriodLength->cellAttributes() ?>>
<span id="el<?php echo $period_type_delete->RowCount ?>_period_type_PeriodLength" class="period_type_PeriodLength">
<span<?php echo $period_type_delete->PeriodLength->viewAttributes() ?>><?php echo $period_type_delete->PeriodLength->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($period_type_delete->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td <?php echo $period_type_delete->UnitOfMeasure->cellAttributes() ?>>
<span id="el<?php echo $period_type_delete->RowCount ?>_period_type_UnitOfMeasure" class="period_type_UnitOfMeasure">
<span<?php echo $period_type_delete->UnitOfMeasure->viewAttributes() ?>><?php echo $period_type_delete->UnitOfMeasure->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$period_type_delete->Recordset->moveNext();
}
$period_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $period_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$period_type_delete->showPageFooter();
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
$period_type_delete->terminate();
?>