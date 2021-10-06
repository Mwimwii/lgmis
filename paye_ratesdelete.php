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
$paye_rates_delete = new paye_rates_delete();

// Run the page
$paye_rates_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$paye_rates_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpaye_ratesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpaye_ratesdelete = currentForm = new ew.Form("fpaye_ratesdelete", "delete");
	loadjs.done("fpaye_ratesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $paye_rates_delete->showPageHeader(); ?>
<?php
$paye_rates_delete->showMessage();
?>
<form name="fpaye_ratesdelete" id="fpaye_ratesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="paye_rates">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($paye_rates_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($paye_rates_delete->band->Visible) { // band ?>
		<th class="<?php echo $paye_rates_delete->band->headerCellClass() ?>"><span id="elh_paye_rates_band" class="paye_rates_band"><?php echo $paye_rates_delete->band->caption() ?></span></th>
<?php } ?>
<?php if ($paye_rates_delete->MinimumIncome->Visible) { // MinimumIncome ?>
		<th class="<?php echo $paye_rates_delete->MinimumIncome->headerCellClass() ?>"><span id="elh_paye_rates_MinimumIncome" class="paye_rates_MinimumIncome"><?php echo $paye_rates_delete->MinimumIncome->caption() ?></span></th>
<?php } ?>
<?php if ($paye_rates_delete->MaximumIncome->Visible) { // MaximumIncome ?>
		<th class="<?php echo $paye_rates_delete->MaximumIncome->headerCellClass() ?>"><span id="elh_paye_rates_MaximumIncome" class="paye_rates_MaximumIncome"><?php echo $paye_rates_delete->MaximumIncome->caption() ?></span></th>
<?php } ?>
<?php if ($paye_rates_delete->PAYERate->Visible) { // PAYERate ?>
		<th class="<?php echo $paye_rates_delete->PAYERate->headerCellClass() ?>"><span id="elh_paye_rates_PAYERate" class="paye_rates_PAYERate"><?php echo $paye_rates_delete->PAYERate->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$paye_rates_delete->RecordCount = 0;
$i = 0;
while (!$paye_rates_delete->Recordset->EOF) {
	$paye_rates_delete->RecordCount++;
	$paye_rates_delete->RowCount++;

	// Set row properties
	$paye_rates->resetAttributes();
	$paye_rates->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$paye_rates_delete->loadRowValues($paye_rates_delete->Recordset);

	// Render row
	$paye_rates_delete->renderRow();
?>
	<tr <?php echo $paye_rates->rowAttributes() ?>>
<?php if ($paye_rates_delete->band->Visible) { // band ?>
		<td <?php echo $paye_rates_delete->band->cellAttributes() ?>>
<span id="el<?php echo $paye_rates_delete->RowCount ?>_paye_rates_band" class="paye_rates_band">
<span<?php echo $paye_rates_delete->band->viewAttributes() ?>><?php echo $paye_rates_delete->band->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($paye_rates_delete->MinimumIncome->Visible) { // MinimumIncome ?>
		<td <?php echo $paye_rates_delete->MinimumIncome->cellAttributes() ?>>
<span id="el<?php echo $paye_rates_delete->RowCount ?>_paye_rates_MinimumIncome" class="paye_rates_MinimumIncome">
<span<?php echo $paye_rates_delete->MinimumIncome->viewAttributes() ?>><?php echo $paye_rates_delete->MinimumIncome->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($paye_rates_delete->MaximumIncome->Visible) { // MaximumIncome ?>
		<td <?php echo $paye_rates_delete->MaximumIncome->cellAttributes() ?>>
<span id="el<?php echo $paye_rates_delete->RowCount ?>_paye_rates_MaximumIncome" class="paye_rates_MaximumIncome">
<span<?php echo $paye_rates_delete->MaximumIncome->viewAttributes() ?>><?php echo $paye_rates_delete->MaximumIncome->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($paye_rates_delete->PAYERate->Visible) { // PAYERate ?>
		<td <?php echo $paye_rates_delete->PAYERate->cellAttributes() ?>>
<span id="el<?php echo $paye_rates_delete->RowCount ?>_paye_rates_PAYERate" class="paye_rates_PAYERate">
<span<?php echo $paye_rates_delete->PAYERate->viewAttributes() ?>><?php echo $paye_rates_delete->PAYERate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$paye_rates_delete->Recordset->moveNext();
}
$paye_rates_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $paye_rates_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$paye_rates_delete->showPageFooter();
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
$paye_rates_delete->terminate();
?>