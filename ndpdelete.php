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
$ndp_delete = new ndp_delete();

// Run the page
$ndp_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ndp_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fndpdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fndpdelete = currentForm = new ew.Form("fndpdelete", "delete");
	loadjs.done("fndpdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ndp_delete->showPageHeader(); ?>
<?php
$ndp_delete->showMessage();
?>
<form name="fndpdelete" id="fndpdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ndp">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ndp_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ndp_delete->NDP->Visible) { // NDP ?>
		<th class="<?php echo $ndp_delete->NDP->headerCellClass() ?>"><span id="elh_ndp_NDP" class="ndp_NDP"><?php echo $ndp_delete->NDP->caption() ?></span></th>
<?php } ?>
<?php if ($ndp_delete->NDPShortName->Visible) { // NDPShortName ?>
		<th class="<?php echo $ndp_delete->NDPShortName->headerCellClass() ?>"><span id="elh_ndp_NDPShortName" class="ndp_NDPShortName"><?php echo $ndp_delete->NDPShortName->caption() ?></span></th>
<?php } ?>
<?php if ($ndp_delete->FromYear->Visible) { // FromYear ?>
		<th class="<?php echo $ndp_delete->FromYear->headerCellClass() ?>"><span id="elh_ndp_FromYear" class="ndp_FromYear"><?php echo $ndp_delete->FromYear->caption() ?></span></th>
<?php } ?>
<?php if ($ndp_delete->ToYear->Visible) { // ToYear ?>
		<th class="<?php echo $ndp_delete->ToYear->headerCellClass() ?>"><span id="elh_ndp_ToYear" class="ndp_ToYear"><?php echo $ndp_delete->ToYear->caption() ?></span></th>
<?php } ?>
<?php if ($ndp_delete->NDPObjectives->Visible) { // NDPObjectives ?>
		<th class="<?php echo $ndp_delete->NDPObjectives->headerCellClass() ?>"><span id="elh_ndp_NDPObjectives" class="ndp_NDPObjectives"><?php echo $ndp_delete->NDPObjectives->caption() ?></span></th>
<?php } ?>
<?php if ($ndp_delete->EffectiveDate->Visible) { // EffectiveDate ?>
		<th class="<?php echo $ndp_delete->EffectiveDate->headerCellClass() ?>"><span id="elh_ndp_EffectiveDate" class="ndp_EffectiveDate"><?php echo $ndp_delete->EffectiveDate->caption() ?></span></th>
<?php } ?>
<?php if ($ndp_delete->NDPURL->Visible) { // NDPURL ?>
		<th class="<?php echo $ndp_delete->NDPURL->headerCellClass() ?>"><span id="elh_ndp_NDPURL" class="ndp_NDPURL"><?php echo $ndp_delete->NDPURL->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ndp_delete->RecordCount = 0;
$i = 0;
while (!$ndp_delete->Recordset->EOF) {
	$ndp_delete->RecordCount++;
	$ndp_delete->RowCount++;

	// Set row properties
	$ndp->resetAttributes();
	$ndp->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ndp_delete->loadRowValues($ndp_delete->Recordset);

	// Render row
	$ndp_delete->renderRow();
?>
	<tr <?php echo $ndp->rowAttributes() ?>>
<?php if ($ndp_delete->NDP->Visible) { // NDP ?>
		<td <?php echo $ndp_delete->NDP->cellAttributes() ?>>
<span id="el<?php echo $ndp_delete->RowCount ?>_ndp_NDP" class="ndp_NDP">
<span<?php echo $ndp_delete->NDP->viewAttributes() ?>><?php echo $ndp_delete->NDP->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ndp_delete->NDPShortName->Visible) { // NDPShortName ?>
		<td <?php echo $ndp_delete->NDPShortName->cellAttributes() ?>>
<span id="el<?php echo $ndp_delete->RowCount ?>_ndp_NDPShortName" class="ndp_NDPShortName">
<span<?php echo $ndp_delete->NDPShortName->viewAttributes() ?>><?php echo $ndp_delete->NDPShortName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ndp_delete->FromYear->Visible) { // FromYear ?>
		<td <?php echo $ndp_delete->FromYear->cellAttributes() ?>>
<span id="el<?php echo $ndp_delete->RowCount ?>_ndp_FromYear" class="ndp_FromYear">
<span<?php echo $ndp_delete->FromYear->viewAttributes() ?>><?php echo $ndp_delete->FromYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ndp_delete->ToYear->Visible) { // ToYear ?>
		<td <?php echo $ndp_delete->ToYear->cellAttributes() ?>>
<span id="el<?php echo $ndp_delete->RowCount ?>_ndp_ToYear" class="ndp_ToYear">
<span<?php echo $ndp_delete->ToYear->viewAttributes() ?>><?php echo $ndp_delete->ToYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ndp_delete->NDPObjectives->Visible) { // NDPObjectives ?>
		<td <?php echo $ndp_delete->NDPObjectives->cellAttributes() ?>>
<span id="el<?php echo $ndp_delete->RowCount ?>_ndp_NDPObjectives" class="ndp_NDPObjectives">
<span<?php echo $ndp_delete->NDPObjectives->viewAttributes() ?>><?php echo $ndp_delete->NDPObjectives->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ndp_delete->EffectiveDate->Visible) { // EffectiveDate ?>
		<td <?php echo $ndp_delete->EffectiveDate->cellAttributes() ?>>
<span id="el<?php echo $ndp_delete->RowCount ?>_ndp_EffectiveDate" class="ndp_EffectiveDate">
<span<?php echo $ndp_delete->EffectiveDate->viewAttributes() ?>><?php echo $ndp_delete->EffectiveDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ndp_delete->NDPURL->Visible) { // NDPURL ?>
		<td <?php echo $ndp_delete->NDPURL->cellAttributes() ?>>
<span id="el<?php echo $ndp_delete->RowCount ?>_ndp_NDPURL" class="ndp_NDPURL">
<span<?php echo $ndp_delete->NDPURL->viewAttributes() ?>><?php echo $ndp_delete->NDPURL->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ndp_delete->Recordset->moveNext();
}
$ndp_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ndp_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ndp_delete->showPageFooter();
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
$ndp_delete->terminate();
?>