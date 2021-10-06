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
$condition_delete = new condition_delete();

// Run the page
$condition_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$condition_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fconditiondelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fconditiondelete = currentForm = new ew.Form("fconditiondelete", "delete");
	loadjs.done("fconditiondelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $condition_delete->showPageHeader(); ?>
<?php
$condition_delete->showMessage();
?>
<form name="fconditiondelete" id="fconditiondelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="condition">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($condition_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($condition_delete->ConditionCode->Visible) { // ConditionCode ?>
		<th class="<?php echo $condition_delete->ConditionCode->headerCellClass() ?>"><span id="elh_condition_ConditionCode" class="condition_ConditionCode"><?php echo $condition_delete->ConditionCode->caption() ?></span></th>
<?php } ?>
<?php if ($condition_delete->ConditionDesc->Visible) { // ConditionDesc ?>
		<th class="<?php echo $condition_delete->ConditionDesc->headerCellClass() ?>"><span id="elh_condition_ConditionDesc" class="condition_ConditionDesc"><?php echo $condition_delete->ConditionDesc->caption() ?></span></th>
<?php } ?>
<?php if ($condition_delete->AcceptableIndicator->Visible) { // AcceptableIndicator ?>
		<th class="<?php echo $condition_delete->AcceptableIndicator->headerCellClass() ?>"><span id="elh_condition_AcceptableIndicator" class="condition_AcceptableIndicator"><?php echo $condition_delete->AcceptableIndicator->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$condition_delete->RecordCount = 0;
$i = 0;
while (!$condition_delete->Recordset->EOF) {
	$condition_delete->RecordCount++;
	$condition_delete->RowCount++;

	// Set row properties
	$condition->resetAttributes();
	$condition->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$condition_delete->loadRowValues($condition_delete->Recordset);

	// Render row
	$condition_delete->renderRow();
?>
	<tr <?php echo $condition->rowAttributes() ?>>
<?php if ($condition_delete->ConditionCode->Visible) { // ConditionCode ?>
		<td <?php echo $condition_delete->ConditionCode->cellAttributes() ?>>
<span id="el<?php echo $condition_delete->RowCount ?>_condition_ConditionCode" class="condition_ConditionCode">
<span<?php echo $condition_delete->ConditionCode->viewAttributes() ?>><?php echo $condition_delete->ConditionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($condition_delete->ConditionDesc->Visible) { // ConditionDesc ?>
		<td <?php echo $condition_delete->ConditionDesc->cellAttributes() ?>>
<span id="el<?php echo $condition_delete->RowCount ?>_condition_ConditionDesc" class="condition_ConditionDesc">
<span<?php echo $condition_delete->ConditionDesc->viewAttributes() ?>><?php echo $condition_delete->ConditionDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($condition_delete->AcceptableIndicator->Visible) { // AcceptableIndicator ?>
		<td <?php echo $condition_delete->AcceptableIndicator->cellAttributes() ?>>
<span id="el<?php echo $condition_delete->RowCount ?>_condition_AcceptableIndicator" class="condition_AcceptableIndicator">
<span<?php echo $condition_delete->AcceptableIndicator->viewAttributes() ?>><?php echo $condition_delete->AcceptableIndicator->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$condition_delete->Recordset->moveNext();
}
$condition_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $condition_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$condition_delete->showPageFooter();
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
$condition_delete->terminate();
?>