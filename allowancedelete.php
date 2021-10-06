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
$allowance_delete = new allowance_delete();

// Run the page
$allowance_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$allowance_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fallowancedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fallowancedelete = currentForm = new ew.Form("fallowancedelete", "delete");
	loadjs.done("fallowancedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $allowance_delete->showPageHeader(); ?>
<?php
$allowance_delete->showMessage();
?>
<form name="fallowancedelete" id="fallowancedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="allowance">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($allowance_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($allowance_delete->AllowanceCode->Visible) { // AllowanceCode ?>
		<th class="<?php echo $allowance_delete->AllowanceCode->headerCellClass() ?>"><span id="elh_allowance_AllowanceCode" class="allowance_AllowanceCode"><?php echo $allowance_delete->AllowanceCode->caption() ?></span></th>
<?php } ?>
<?php if ($allowance_delete->AllowanceName->Visible) { // AllowanceName ?>
		<th class="<?php echo $allowance_delete->AllowanceName->headerCellClass() ?>"><span id="elh_allowance_AllowanceName" class="allowance_AllowanceName"><?php echo $allowance_delete->AllowanceName->caption() ?></span></th>
<?php } ?>
<?php if ($allowance_delete->AllowanceAmount->Visible) { // AllowanceAmount ?>
		<th class="<?php echo $allowance_delete->AllowanceAmount->headerCellClass() ?>"><span id="elh_allowance_AllowanceAmount" class="allowance_AllowanceAmount"><?php echo $allowance_delete->AllowanceAmount->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$allowance_delete->RecordCount = 0;
$i = 0;
while (!$allowance_delete->Recordset->EOF) {
	$allowance_delete->RecordCount++;
	$allowance_delete->RowCount++;

	// Set row properties
	$allowance->resetAttributes();
	$allowance->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$allowance_delete->loadRowValues($allowance_delete->Recordset);

	// Render row
	$allowance_delete->renderRow();
?>
	<tr <?php echo $allowance->rowAttributes() ?>>
<?php if ($allowance_delete->AllowanceCode->Visible) { // AllowanceCode ?>
		<td <?php echo $allowance_delete->AllowanceCode->cellAttributes() ?>>
<span id="el<?php echo $allowance_delete->RowCount ?>_allowance_AllowanceCode" class="allowance_AllowanceCode">
<span<?php echo $allowance_delete->AllowanceCode->viewAttributes() ?>><?php echo $allowance_delete->AllowanceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($allowance_delete->AllowanceName->Visible) { // AllowanceName ?>
		<td <?php echo $allowance_delete->AllowanceName->cellAttributes() ?>>
<span id="el<?php echo $allowance_delete->RowCount ?>_allowance_AllowanceName" class="allowance_AllowanceName">
<span<?php echo $allowance_delete->AllowanceName->viewAttributes() ?>><?php echo $allowance_delete->AllowanceName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($allowance_delete->AllowanceAmount->Visible) { // AllowanceAmount ?>
		<td <?php echo $allowance_delete->AllowanceAmount->cellAttributes() ?>>
<span id="el<?php echo $allowance_delete->RowCount ?>_allowance_AllowanceAmount" class="allowance_AllowanceAmount">
<span<?php echo $allowance_delete->AllowanceAmount->viewAttributes() ?>><?php echo $allowance_delete->AllowanceAmount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$allowance_delete->Recordset->moveNext();
}
$allowance_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $allowance_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$allowance_delete->showPageFooter();
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
$allowance_delete->terminate();
?>