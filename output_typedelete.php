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
$output_type_delete = new output_type_delete();

// Run the page
$output_type_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$output_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var foutput_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	foutput_typedelete = currentForm = new ew.Form("foutput_typedelete", "delete");
	loadjs.done("foutput_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $output_type_delete->showPageHeader(); ?>
<?php
$output_type_delete->showMessage();
?>
<form name="foutput_typedelete" id="foutput_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="output_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($output_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($output_type_delete->OutputType->Visible) { // OutputType ?>
		<th class="<?php echo $output_type_delete->OutputType->headerCellClass() ?>"><span id="elh_output_type_OutputType" class="output_type_OutputType"><?php echo $output_type_delete->OutputType->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$output_type_delete->RecordCount = 0;
$i = 0;
while (!$output_type_delete->Recordset->EOF) {
	$output_type_delete->RecordCount++;
	$output_type_delete->RowCount++;

	// Set row properties
	$output_type->resetAttributes();
	$output_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$output_type_delete->loadRowValues($output_type_delete->Recordset);

	// Render row
	$output_type_delete->renderRow();
?>
	<tr <?php echo $output_type->rowAttributes() ?>>
<?php if ($output_type_delete->OutputType->Visible) { // OutputType ?>
		<td <?php echo $output_type_delete->OutputType->cellAttributes() ?>>
<span id="el<?php echo $output_type_delete->RowCount ?>_output_type_OutputType" class="output_type_OutputType">
<span<?php echo $output_type_delete->OutputType->viewAttributes() ?>><?php echo $output_type_delete->OutputType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$output_type_delete->Recordset->moveNext();
}
$output_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $output_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$output_type_delete->showPageFooter();
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
$output_type_delete->terminate();
?>