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
$acting_reasons_delete = new acting_reasons_delete();

// Run the page
$acting_reasons_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acting_reasons_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var facting_reasonsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	facting_reasonsdelete = currentForm = new ew.Form("facting_reasonsdelete", "delete");
	loadjs.done("facting_reasonsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $acting_reasons_delete->showPageHeader(); ?>
<?php
$acting_reasons_delete->showMessage();
?>
<form name="facting_reasonsdelete" id="facting_reasonsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acting_reasons">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($acting_reasons_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($acting_reasons_delete->ActingReasons->Visible) { // ActingReasons ?>
		<th class="<?php echo $acting_reasons_delete->ActingReasons->headerCellClass() ?>"><span id="elh_acting_reasons_ActingReasons" class="acting_reasons_ActingReasons"><?php echo $acting_reasons_delete->ActingReasons->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$acting_reasons_delete->RecordCount = 0;
$i = 0;
while (!$acting_reasons_delete->Recordset->EOF) {
	$acting_reasons_delete->RecordCount++;
	$acting_reasons_delete->RowCount++;

	// Set row properties
	$acting_reasons->resetAttributes();
	$acting_reasons->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$acting_reasons_delete->loadRowValues($acting_reasons_delete->Recordset);

	// Render row
	$acting_reasons_delete->renderRow();
?>
	<tr <?php echo $acting_reasons->rowAttributes() ?>>
<?php if ($acting_reasons_delete->ActingReasons->Visible) { // ActingReasons ?>
		<td <?php echo $acting_reasons_delete->ActingReasons->cellAttributes() ?>>
<span id="el<?php echo $acting_reasons_delete->RowCount ?>_acting_reasons_ActingReasons" class="acting_reasons_ActingReasons">
<span<?php echo $acting_reasons_delete->ActingReasons->viewAttributes() ?>><?php echo $acting_reasons_delete->ActingReasons->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$acting_reasons_delete->Recordset->moveNext();
}
$acting_reasons_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $acting_reasons_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$acting_reasons_delete->showPageFooter();
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
$acting_reasons_delete->terminate();
?>