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
$years_delete = new years_delete();

// Run the page
$years_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$years_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fyearsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fyearsdelete = currentForm = new ew.Form("fyearsdelete", "delete");
	loadjs.done("fyearsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $years_delete->showPageHeader(); ?>
<?php
$years_delete->showMessage();
?>
<form name="fyearsdelete" id="fyearsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="years">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($years_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($years_delete->Year->Visible) { // Year ?>
		<th class="<?php echo $years_delete->Year->headerCellClass() ?>"><span id="elh_years_Year" class="years_Year"><?php echo $years_delete->Year->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$years_delete->RecordCount = 0;
$i = 0;
while (!$years_delete->Recordset->EOF) {
	$years_delete->RecordCount++;
	$years_delete->RowCount++;

	// Set row properties
	$years->resetAttributes();
	$years->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$years_delete->loadRowValues($years_delete->Recordset);

	// Render row
	$years_delete->renderRow();
?>
	<tr <?php echo $years->rowAttributes() ?>>
<?php if ($years_delete->Year->Visible) { // Year ?>
		<td <?php echo $years_delete->Year->cellAttributes() ?>>
<span id="el<?php echo $years_delete->RowCount ?>_years_Year" class="years_Year">
<span<?php echo $years_delete->Year->viewAttributes() ?>><?php echo $years_delete->Year->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$years_delete->Recordset->moveNext();
}
$years_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $years_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$years_delete->showPageFooter();
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
$years_delete->terminate();
?>