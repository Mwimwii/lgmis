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
$time_measure_delete = new time_measure_delete();

// Run the page
$time_measure_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$time_measure_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftime_measuredelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftime_measuredelete = currentForm = new ew.Form("ftime_measuredelete", "delete");
	loadjs.done("ftime_measuredelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $time_measure_delete->showPageHeader(); ?>
<?php
$time_measure_delete->showMessage();
?>
<form name="ftime_measuredelete" id="ftime_measuredelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="time_measure">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($time_measure_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($time_measure_delete->Unit_of_measure->Visible) { // Unit_of_measure ?>
		<th class="<?php echo $time_measure_delete->Unit_of_measure->headerCellClass() ?>"><span id="elh_time_measure_Unit_of_measure" class="time_measure_Unit_of_measure"><?php echo $time_measure_delete->Unit_of_measure->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$time_measure_delete->RecordCount = 0;
$i = 0;
while (!$time_measure_delete->Recordset->EOF) {
	$time_measure_delete->RecordCount++;
	$time_measure_delete->RowCount++;

	// Set row properties
	$time_measure->resetAttributes();
	$time_measure->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$time_measure_delete->loadRowValues($time_measure_delete->Recordset);

	// Render row
	$time_measure_delete->renderRow();
?>
	<tr <?php echo $time_measure->rowAttributes() ?>>
<?php if ($time_measure_delete->Unit_of_measure->Visible) { // Unit_of_measure ?>
		<td <?php echo $time_measure_delete->Unit_of_measure->cellAttributes() ?>>
<span id="el<?php echo $time_measure_delete->RowCount ?>_time_measure_Unit_of_measure" class="time_measure_Unit_of_measure">
<span<?php echo $time_measure_delete->Unit_of_measure->viewAttributes() ?>><?php echo $time_measure_delete->Unit_of_measure->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$time_measure_delete->Recordset->moveNext();
}
$time_measure_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $time_measure_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$time_measure_delete->showPageFooter();
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
$time_measure_delete->terminate();
?>