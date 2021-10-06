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
$pillars_delete = new pillars_delete();

// Run the page
$pillars_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pillars_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpillarsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpillarsdelete = currentForm = new ew.Form("fpillarsdelete", "delete");
	loadjs.done("fpillarsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $pillars_delete->showPageHeader(); ?>
<?php
$pillars_delete->showMessage();
?>
<form name="fpillarsdelete" id="fpillarsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pillars">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($pillars_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($pillars_delete->NDP->Visible) { // NDP ?>
		<th class="<?php echo $pillars_delete->NDP->headerCellClass() ?>"><span id="elh_pillars_NDP" class="pillars_NDP"><?php echo $pillars_delete->NDP->caption() ?></span></th>
<?php } ?>
<?php if ($pillars_delete->PillarNo->Visible) { // PillarNo ?>
		<th class="<?php echo $pillars_delete->PillarNo->headerCellClass() ?>"><span id="elh_pillars_PillarNo" class="pillars_PillarNo"><?php echo $pillars_delete->PillarNo->caption() ?></span></th>
<?php } ?>
<?php if ($pillars_delete->PillarName->Visible) { // PillarName ?>
		<th class="<?php echo $pillars_delete->PillarName->headerCellClass() ?>"><span id="elh_pillars_PillarName" class="pillars_PillarName"><?php echo $pillars_delete->PillarName->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$pillars_delete->RecordCount = 0;
$i = 0;
while (!$pillars_delete->Recordset->EOF) {
	$pillars_delete->RecordCount++;
	$pillars_delete->RowCount++;

	// Set row properties
	$pillars->resetAttributes();
	$pillars->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$pillars_delete->loadRowValues($pillars_delete->Recordset);

	// Render row
	$pillars_delete->renderRow();
?>
	<tr <?php echo $pillars->rowAttributes() ?>>
<?php if ($pillars_delete->NDP->Visible) { // NDP ?>
		<td <?php echo $pillars_delete->NDP->cellAttributes() ?>>
<span id="el<?php echo $pillars_delete->RowCount ?>_pillars_NDP" class="pillars_NDP">
<span<?php echo $pillars_delete->NDP->viewAttributes() ?>><?php echo $pillars_delete->NDP->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pillars_delete->PillarNo->Visible) { // PillarNo ?>
		<td <?php echo $pillars_delete->PillarNo->cellAttributes() ?>>
<span id="el<?php echo $pillars_delete->RowCount ?>_pillars_PillarNo" class="pillars_PillarNo">
<span<?php echo $pillars_delete->PillarNo->viewAttributes() ?>><?php echo $pillars_delete->PillarNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pillars_delete->PillarName->Visible) { // PillarName ?>
		<td <?php echo $pillars_delete->PillarName->cellAttributes() ?>>
<span id="el<?php echo $pillars_delete->RowCount ?>_pillars_PillarName" class="pillars_PillarName">
<span<?php echo $pillars_delete->PillarName->viewAttributes() ?>><?php echo $pillars_delete->PillarName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$pillars_delete->Recordset->moveNext();
}
$pillars_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $pillars_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$pillars_delete->showPageFooter();
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
$pillars_delete->terminate();
?>