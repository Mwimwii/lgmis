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
$business_sector_delete = new business_sector_delete();

// Run the page
$business_sector_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_sector_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbusiness_sectordelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fbusiness_sectordelete = currentForm = new ew.Form("fbusiness_sectordelete", "delete");
	loadjs.done("fbusiness_sectordelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $business_sector_delete->showPageHeader(); ?>
<?php
$business_sector_delete->showMessage();
?>
<form name="fbusiness_sectordelete" id="fbusiness_sectordelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business_sector">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($business_sector_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($business_sector_delete->business_sector_code->Visible) { // business_sector_code ?>
		<th class="<?php echo $business_sector_delete->business_sector_code->headerCellClass() ?>"><span id="elh_business_sector_business_sector_code" class="business_sector_business_sector_code"><?php echo $business_sector_delete->business_sector_code->caption() ?></span></th>
<?php } ?>
<?php if ($business_sector_delete->business_sector_name->Visible) { // business_sector_name ?>
		<th class="<?php echo $business_sector_delete->business_sector_name->headerCellClass() ?>"><span id="elh_business_sector_business_sector_name" class="business_sector_business_sector_name"><?php echo $business_sector_delete->business_sector_name->caption() ?></span></th>
<?php } ?>
<?php if ($business_sector_delete->business_sector_desc->Visible) { // business_sector_desc ?>
		<th class="<?php echo $business_sector_delete->business_sector_desc->headerCellClass() ?>"><span id="elh_business_sector_business_sector_desc" class="business_sector_business_sector_desc"><?php echo $business_sector_delete->business_sector_desc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$business_sector_delete->RecordCount = 0;
$i = 0;
while (!$business_sector_delete->Recordset->EOF) {
	$business_sector_delete->RecordCount++;
	$business_sector_delete->RowCount++;

	// Set row properties
	$business_sector->resetAttributes();
	$business_sector->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$business_sector_delete->loadRowValues($business_sector_delete->Recordset);

	// Render row
	$business_sector_delete->renderRow();
?>
	<tr <?php echo $business_sector->rowAttributes() ?>>
<?php if ($business_sector_delete->business_sector_code->Visible) { // business_sector_code ?>
		<td <?php echo $business_sector_delete->business_sector_code->cellAttributes() ?>>
<span id="el<?php echo $business_sector_delete->RowCount ?>_business_sector_business_sector_code" class="business_sector_business_sector_code">
<span<?php echo $business_sector_delete->business_sector_code->viewAttributes() ?>><?php echo $business_sector_delete->business_sector_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_sector_delete->business_sector_name->Visible) { // business_sector_name ?>
		<td <?php echo $business_sector_delete->business_sector_name->cellAttributes() ?>>
<span id="el<?php echo $business_sector_delete->RowCount ?>_business_sector_business_sector_name" class="business_sector_business_sector_name">
<span<?php echo $business_sector_delete->business_sector_name->viewAttributes() ?>><?php echo $business_sector_delete->business_sector_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_sector_delete->business_sector_desc->Visible) { // business_sector_desc ?>
		<td <?php echo $business_sector_delete->business_sector_desc->cellAttributes() ?>>
<span id="el<?php echo $business_sector_delete->RowCount ?>_business_sector_business_sector_desc" class="business_sector_business_sector_desc">
<span<?php echo $business_sector_delete->business_sector_desc->viewAttributes() ?>><?php echo $business_sector_delete->business_sector_desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$business_sector_delete->Recordset->moveNext();
}
$business_sector_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $business_sector_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$business_sector_delete->showPageFooter();
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
$business_sector_delete->terminate();
?>