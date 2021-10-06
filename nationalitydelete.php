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
$nationality_delete = new nationality_delete();

// Run the page
$nationality_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$nationality_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fnationalitydelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fnationalitydelete = currentForm = new ew.Form("fnationalitydelete", "delete");
	loadjs.done("fnationalitydelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $nationality_delete->showPageHeader(); ?>
<?php
$nationality_delete->showMessage();
?>
<form name="fnationalitydelete" id="fnationalitydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="nationality">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($nationality_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($nationality_delete->NationalID->Visible) { // NationalID ?>
		<th class="<?php echo $nationality_delete->NationalID->headerCellClass() ?>"><span id="elh_nationality_NationalID" class="nationality_NationalID"><?php echo $nationality_delete->NationalID->caption() ?></span></th>
<?php } ?>
<?php if ($nationality_delete->Nationality->Visible) { // Nationality ?>
		<th class="<?php echo $nationality_delete->Nationality->headerCellClass() ?>"><span id="elh_nationality_Nationality" class="nationality_Nationality"><?php echo $nationality_delete->Nationality->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$nationality_delete->RecordCount = 0;
$i = 0;
while (!$nationality_delete->Recordset->EOF) {
	$nationality_delete->RecordCount++;
	$nationality_delete->RowCount++;

	// Set row properties
	$nationality->resetAttributes();
	$nationality->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$nationality_delete->loadRowValues($nationality_delete->Recordset);

	// Render row
	$nationality_delete->renderRow();
?>
	<tr <?php echo $nationality->rowAttributes() ?>>
<?php if ($nationality_delete->NationalID->Visible) { // NationalID ?>
		<td <?php echo $nationality_delete->NationalID->cellAttributes() ?>>
<span id="el<?php echo $nationality_delete->RowCount ?>_nationality_NationalID" class="nationality_NationalID">
<span<?php echo $nationality_delete->NationalID->viewAttributes() ?>><?php echo $nationality_delete->NationalID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($nationality_delete->Nationality->Visible) { // Nationality ?>
		<td <?php echo $nationality_delete->Nationality->cellAttributes() ?>>
<span id="el<?php echo $nationality_delete->RowCount ?>_nationality_Nationality" class="nationality_Nationality">
<span<?php echo $nationality_delete->Nationality->viewAttributes() ?>><?php echo $nationality_delete->Nationality->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$nationality_delete->Recordset->moveNext();
}
$nationality_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $nationality_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$nationality_delete->showPageFooter();
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
$nationality_delete->terminate();
?>