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
$division_delete = new division_delete();

// Run the page
$division_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$division_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdivisiondelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdivisiondelete = currentForm = new ew.Form("fdivisiondelete", "delete");
	loadjs.done("fdivisiondelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $division_delete->showPageHeader(); ?>
<?php
$division_delete->showMessage();
?>
<form name="fdivisiondelete" id="fdivisiondelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="division">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($division_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($division_delete->Division->Visible) { // Division ?>
		<th class="<?php echo $division_delete->Division->headerCellClass() ?>"><span id="elh_division_Division" class="division_Division"><?php echo $division_delete->Division->caption() ?></span></th>
<?php } ?>
<?php if ($division_delete->DivisionName->Visible) { // DivisionName ?>
		<th class="<?php echo $division_delete->DivisionName->headerCellClass() ?>"><span id="elh_division_DivisionName" class="division_DivisionName"><?php echo $division_delete->DivisionName->caption() ?></span></th>
<?php } ?>
<?php if ($division_delete->Comments->Visible) { // Comments ?>
		<th class="<?php echo $division_delete->Comments->headerCellClass() ?>"><span id="elh_division_Comments" class="division_Comments"><?php echo $division_delete->Comments->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$division_delete->RecordCount = 0;
$i = 0;
while (!$division_delete->Recordset->EOF) {
	$division_delete->RecordCount++;
	$division_delete->RowCount++;

	// Set row properties
	$division->resetAttributes();
	$division->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$division_delete->loadRowValues($division_delete->Recordset);

	// Render row
	$division_delete->renderRow();
?>
	<tr <?php echo $division->rowAttributes() ?>>
<?php if ($division_delete->Division->Visible) { // Division ?>
		<td <?php echo $division_delete->Division->cellAttributes() ?>>
<span id="el<?php echo $division_delete->RowCount ?>_division_Division" class="division_Division">
<span<?php echo $division_delete->Division->viewAttributes() ?>><?php echo $division_delete->Division->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($division_delete->DivisionName->Visible) { // DivisionName ?>
		<td <?php echo $division_delete->DivisionName->cellAttributes() ?>>
<span id="el<?php echo $division_delete->RowCount ?>_division_DivisionName" class="division_DivisionName">
<span<?php echo $division_delete->DivisionName->viewAttributes() ?>><?php echo $division_delete->DivisionName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($division_delete->Comments->Visible) { // Comments ?>
		<td <?php echo $division_delete->Comments->cellAttributes() ?>>
<span id="el<?php echo $division_delete->RowCount ?>_division_Comments" class="division_Comments">
<span<?php echo $division_delete->Comments->viewAttributes() ?>><?php echo $division_delete->Comments->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$division_delete->Recordset->moveNext();
}
$division_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $division_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$division_delete->showPageFooter();
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
$division_delete->terminate();
?>