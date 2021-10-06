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
$business_type_contracts_delete = new business_type_contracts_delete();

// Run the page
$business_type_contracts_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_type_contracts_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbusiness_type_contractsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fbusiness_type_contractsdelete = currentForm = new ew.Form("fbusiness_type_contractsdelete", "delete");
	loadjs.done("fbusiness_type_contractsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $business_type_contracts_delete->showPageHeader(); ?>
<?php
$business_type_contracts_delete->showMessage();
?>
<form name="fbusiness_type_contractsdelete" id="fbusiness_type_contractsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business_type_contracts">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($business_type_contracts_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($business_type_contracts_delete->business_type_code->Visible) { // business_type_code ?>
		<th class="<?php echo $business_type_contracts_delete->business_type_code->headerCellClass() ?>"><span id="elh_business_type_contracts_business_type_code" class="business_type_contracts_business_type_code"><?php echo $business_type_contracts_delete->business_type_code->caption() ?></span></th>
<?php } ?>
<?php if ($business_type_contracts_delete->business_type_name->Visible) { // business_type_name ?>
		<th class="<?php echo $business_type_contracts_delete->business_type_name->headerCellClass() ?>"><span id="elh_business_type_contracts_business_type_name" class="business_type_contracts_business_type_name"><?php echo $business_type_contracts_delete->business_type_name->caption() ?></span></th>
<?php } ?>
<?php if ($business_type_contracts_delete->business_type_desc->Visible) { // business_type_desc ?>
		<th class="<?php echo $business_type_contracts_delete->business_type_desc->headerCellClass() ?>"><span id="elh_business_type_contracts_business_type_desc" class="business_type_contracts_business_type_desc"><?php echo $business_type_contracts_delete->business_type_desc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$business_type_contracts_delete->RecordCount = 0;
$i = 0;
while (!$business_type_contracts_delete->Recordset->EOF) {
	$business_type_contracts_delete->RecordCount++;
	$business_type_contracts_delete->RowCount++;

	// Set row properties
	$business_type_contracts->resetAttributes();
	$business_type_contracts->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$business_type_contracts_delete->loadRowValues($business_type_contracts_delete->Recordset);

	// Render row
	$business_type_contracts_delete->renderRow();
?>
	<tr <?php echo $business_type_contracts->rowAttributes() ?>>
<?php if ($business_type_contracts_delete->business_type_code->Visible) { // business_type_code ?>
		<td <?php echo $business_type_contracts_delete->business_type_code->cellAttributes() ?>>
<span id="el<?php echo $business_type_contracts_delete->RowCount ?>_business_type_contracts_business_type_code" class="business_type_contracts_business_type_code">
<span<?php echo $business_type_contracts_delete->business_type_code->viewAttributes() ?>><?php echo $business_type_contracts_delete->business_type_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_type_contracts_delete->business_type_name->Visible) { // business_type_name ?>
		<td <?php echo $business_type_contracts_delete->business_type_name->cellAttributes() ?>>
<span id="el<?php echo $business_type_contracts_delete->RowCount ?>_business_type_contracts_business_type_name" class="business_type_contracts_business_type_name">
<span<?php echo $business_type_contracts_delete->business_type_name->viewAttributes() ?>><?php echo $business_type_contracts_delete->business_type_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_type_contracts_delete->business_type_desc->Visible) { // business_type_desc ?>
		<td <?php echo $business_type_contracts_delete->business_type_desc->cellAttributes() ?>>
<span id="el<?php echo $business_type_contracts_delete->RowCount ?>_business_type_contracts_business_type_desc" class="business_type_contracts_business_type_desc">
<span<?php echo $business_type_contracts_delete->business_type_desc->viewAttributes() ?>><?php echo $business_type_contracts_delete->business_type_desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$business_type_contracts_delete->Recordset->moveNext();
}
$business_type_contracts_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $business_type_contracts_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$business_type_contracts_delete->showPageFooter();
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
$business_type_contracts_delete->terminate();
?>