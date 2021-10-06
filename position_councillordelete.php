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
$position_councillor_delete = new position_councillor_delete();

// Run the page
$position_councillor_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$position_councillor_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fposition_councillordelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fposition_councillordelete = currentForm = new ew.Form("fposition_councillordelete", "delete");
	loadjs.done("fposition_councillordelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $position_councillor_delete->showPageHeader(); ?>
<?php
$position_councillor_delete->showMessage();
?>
<form name="fposition_councillordelete" id="fposition_councillordelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="position_councillor">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($position_councillor_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($position_councillor_delete->PositionCode->Visible) { // PositionCode ?>
		<th class="<?php echo $position_councillor_delete->PositionCode->headerCellClass() ?>"><span id="elh_position_councillor_PositionCode" class="position_councillor_PositionCode"><?php echo $position_councillor_delete->PositionCode->caption() ?></span></th>
<?php } ?>
<?php if ($position_councillor_delete->PositionName->Visible) { // PositionName ?>
		<th class="<?php echo $position_councillor_delete->PositionName->headerCellClass() ?>"><span id="elh_position_councillor_PositionName" class="position_councillor_PositionName"><?php echo $position_councillor_delete->PositionName->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$position_councillor_delete->RecordCount = 0;
$i = 0;
while (!$position_councillor_delete->Recordset->EOF) {
	$position_councillor_delete->RecordCount++;
	$position_councillor_delete->RowCount++;

	// Set row properties
	$position_councillor->resetAttributes();
	$position_councillor->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$position_councillor_delete->loadRowValues($position_councillor_delete->Recordset);

	// Render row
	$position_councillor_delete->renderRow();
?>
	<tr <?php echo $position_councillor->rowAttributes() ?>>
<?php if ($position_councillor_delete->PositionCode->Visible) { // PositionCode ?>
		<td <?php echo $position_councillor_delete->PositionCode->cellAttributes() ?>>
<span id="el<?php echo $position_councillor_delete->RowCount ?>_position_councillor_PositionCode" class="position_councillor_PositionCode">
<span<?php echo $position_councillor_delete->PositionCode->viewAttributes() ?>><?php echo $position_councillor_delete->PositionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($position_councillor_delete->PositionName->Visible) { // PositionName ?>
		<td <?php echo $position_councillor_delete->PositionName->cellAttributes() ?>>
<span id="el<?php echo $position_councillor_delete->RowCount ?>_position_councillor_PositionName" class="position_councillor_PositionName">
<span<?php echo $position_councillor_delete->PositionName->viewAttributes() ?>><?php echo $position_councillor_delete->PositionName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$position_councillor_delete->Recordset->moveNext();
}
$position_councillor_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $position_councillor_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$position_councillor_delete->showPageFooter();
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
$position_councillor_delete->terminate();
?>