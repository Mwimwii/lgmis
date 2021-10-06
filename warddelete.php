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
$ward_delete = new ward_delete();

// Run the page
$ward_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ward_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fwarddelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fwarddelete = currentForm = new ew.Form("fwarddelete", "delete");
	loadjs.done("fwarddelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ward_delete->showPageHeader(); ?>
<?php
$ward_delete->showMessage();
?>
<form name="fwarddelete" id="fwarddelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ward">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ward_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ward_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $ward_delete->LACode->headerCellClass() ?>"><span id="elh_ward_LACode" class="ward_LACode"><?php echo $ward_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($ward_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<th class="<?php echo $ward_delete->ProvinceCode->headerCellClass() ?>"><span id="elh_ward_ProvinceCode" class="ward_ProvinceCode"><?php echo $ward_delete->ProvinceCode->caption() ?></span></th>
<?php } ?>
<?php if ($ward_delete->WardCode->Visible) { // WardCode ?>
		<th class="<?php echo $ward_delete->WardCode->headerCellClass() ?>"><span id="elh_ward_WardCode" class="ward_WardCode"><?php echo $ward_delete->WardCode->caption() ?></span></th>
<?php } ?>
<?php if ($ward_delete->WardName->Visible) { // WardName ?>
		<th class="<?php echo $ward_delete->WardName->headerCellClass() ?>"><span id="elh_ward_WardName" class="ward_WardName"><?php echo $ward_delete->WardName->caption() ?></span></th>
<?php } ?>
<?php if ($ward_delete->Population->Visible) { // Population ?>
		<th class="<?php echo $ward_delete->Population->headerCellClass() ?>"><span id="elh_ward_Population" class="ward_Population"><?php echo $ward_delete->Population->caption() ?></span></th>
<?php } ?>
<?php if ($ward_delete->Areas->Visible) { // Areas ?>
		<th class="<?php echo $ward_delete->Areas->headerCellClass() ?>"><span id="elh_ward_Areas" class="ward_Areas"><?php echo $ward_delete->Areas->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ward_delete->RecordCount = 0;
$i = 0;
while (!$ward_delete->Recordset->EOF) {
	$ward_delete->RecordCount++;
	$ward_delete->RowCount++;

	// Set row properties
	$ward->resetAttributes();
	$ward->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ward_delete->loadRowValues($ward_delete->Recordset);

	// Render row
	$ward_delete->renderRow();
?>
	<tr <?php echo $ward->rowAttributes() ?>>
<?php if ($ward_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $ward_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $ward_delete->RowCount ?>_ward_LACode" class="ward_LACode">
<span<?php echo $ward_delete->LACode->viewAttributes() ?>><?php echo $ward_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ward_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<td <?php echo $ward_delete->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $ward_delete->RowCount ?>_ward_ProvinceCode" class="ward_ProvinceCode">
<span<?php echo $ward_delete->ProvinceCode->viewAttributes() ?>><?php echo $ward_delete->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ward_delete->WardCode->Visible) { // WardCode ?>
		<td <?php echo $ward_delete->WardCode->cellAttributes() ?>>
<span id="el<?php echo $ward_delete->RowCount ?>_ward_WardCode" class="ward_WardCode">
<span<?php echo $ward_delete->WardCode->viewAttributes() ?>><?php echo $ward_delete->WardCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ward_delete->WardName->Visible) { // WardName ?>
		<td <?php echo $ward_delete->WardName->cellAttributes() ?>>
<span id="el<?php echo $ward_delete->RowCount ?>_ward_WardName" class="ward_WardName">
<span<?php echo $ward_delete->WardName->viewAttributes() ?>><?php echo $ward_delete->WardName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ward_delete->Population->Visible) { // Population ?>
		<td <?php echo $ward_delete->Population->cellAttributes() ?>>
<span id="el<?php echo $ward_delete->RowCount ?>_ward_Population" class="ward_Population">
<span<?php echo $ward_delete->Population->viewAttributes() ?>><?php echo $ward_delete->Population->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ward_delete->Areas->Visible) { // Areas ?>
		<td <?php echo $ward_delete->Areas->cellAttributes() ?>>
<span id="el<?php echo $ward_delete->RowCount ?>_ward_Areas" class="ward_Areas">
<span<?php echo $ward_delete->Areas->viewAttributes() ?>><?php echo $ward_delete->Areas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ward_delete->Recordset->moveNext();
}
$ward_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ward_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ward_delete->showPageFooter();
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
$ward_delete->terminate();
?>