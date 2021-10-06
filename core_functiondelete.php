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
$core_function_delete = new core_function_delete();

// Run the page
$core_function_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$core_function_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcore_functiondelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcore_functiondelete = currentForm = new ew.Form("fcore_functiondelete", "delete");
	loadjs.done("fcore_functiondelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $core_function_delete->showPageHeader(); ?>
<?php
$core_function_delete->showMessage();
?>
<form name="fcore_functiondelete" id="fcore_functiondelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="core_function">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($core_function_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($core_function_delete->functioncode->Visible) { // functioncode ?>
		<th class="<?php echo $core_function_delete->functioncode->headerCellClass() ?>"><span id="elh_core_function_functioncode" class="core_function_functioncode"><?php echo $core_function_delete->functioncode->caption() ?></span></th>
<?php } ?>
<?php if ($core_function_delete->FunctionName->Visible) { // FunctionName ?>
		<th class="<?php echo $core_function_delete->FunctionName->headerCellClass() ?>"><span id="elh_core_function_FunctionName" class="core_function_FunctionName"><?php echo $core_function_delete->FunctionName->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$core_function_delete->RecordCount = 0;
$i = 0;
while (!$core_function_delete->Recordset->EOF) {
	$core_function_delete->RecordCount++;
	$core_function_delete->RowCount++;

	// Set row properties
	$core_function->resetAttributes();
	$core_function->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$core_function_delete->loadRowValues($core_function_delete->Recordset);

	// Render row
	$core_function_delete->renderRow();
?>
	<tr <?php echo $core_function->rowAttributes() ?>>
<?php if ($core_function_delete->functioncode->Visible) { // functioncode ?>
		<td <?php echo $core_function_delete->functioncode->cellAttributes() ?>>
<span id="el<?php echo $core_function_delete->RowCount ?>_core_function_functioncode" class="core_function_functioncode">
<span<?php echo $core_function_delete->functioncode->viewAttributes() ?>><?php echo $core_function_delete->functioncode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($core_function_delete->FunctionName->Visible) { // FunctionName ?>
		<td <?php echo $core_function_delete->FunctionName->cellAttributes() ?>>
<span id="el<?php echo $core_function_delete->RowCount ?>_core_function_FunctionName" class="core_function_FunctionName">
<span<?php echo $core_function_delete->FunctionName->viewAttributes() ?>><?php echo $core_function_delete->FunctionName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$core_function_delete->Recordset->moveNext();
}
$core_function_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $core_function_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$core_function_delete->showPageFooter();
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
$core_function_delete->terminate();
?>