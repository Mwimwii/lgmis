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
$meansofimplement_delete = new meansofimplement_delete();

// Run the page
$meansofimplement_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$meansofimplement_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmeansofimplementdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fmeansofimplementdelete = currentForm = new ew.Form("fmeansofimplementdelete", "delete");
	loadjs.done("fmeansofimplementdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $meansofimplement_delete->showPageHeader(); ?>
<?php
$meansofimplement_delete->showMessage();
?>
<form name="fmeansofimplementdelete" id="fmeansofimplementdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="meansofimplement">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($meansofimplement_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($meansofimplement_delete->moimp_code->Visible) { // moimp_code ?>
		<th class="<?php echo $meansofimplement_delete->moimp_code->headerCellClass() ?>"><span id="elh_meansofimplement_moimp_code" class="meansofimplement_moimp_code"><?php echo $meansofimplement_delete->moimp_code->caption() ?></span></th>
<?php } ?>
<?php if ($meansofimplement_delete->moimp_desc->Visible) { // moimp_desc ?>
		<th class="<?php echo $meansofimplement_delete->moimp_desc->headerCellClass() ?>"><span id="elh_meansofimplement_moimp_desc" class="meansofimplement_moimp_desc"><?php echo $meansofimplement_delete->moimp_desc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$meansofimplement_delete->RecordCount = 0;
$i = 0;
while (!$meansofimplement_delete->Recordset->EOF) {
	$meansofimplement_delete->RecordCount++;
	$meansofimplement_delete->RowCount++;

	// Set row properties
	$meansofimplement->resetAttributes();
	$meansofimplement->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$meansofimplement_delete->loadRowValues($meansofimplement_delete->Recordset);

	// Render row
	$meansofimplement_delete->renderRow();
?>
	<tr <?php echo $meansofimplement->rowAttributes() ?>>
<?php if ($meansofimplement_delete->moimp_code->Visible) { // moimp_code ?>
		<td <?php echo $meansofimplement_delete->moimp_code->cellAttributes() ?>>
<span id="el<?php echo $meansofimplement_delete->RowCount ?>_meansofimplement_moimp_code" class="meansofimplement_moimp_code">
<span<?php echo $meansofimplement_delete->moimp_code->viewAttributes() ?>><?php echo $meansofimplement_delete->moimp_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($meansofimplement_delete->moimp_desc->Visible) { // moimp_desc ?>
		<td <?php echo $meansofimplement_delete->moimp_desc->cellAttributes() ?>>
<span id="el<?php echo $meansofimplement_delete->RowCount ?>_meansofimplement_moimp_desc" class="meansofimplement_moimp_desc">
<span<?php echo $meansofimplement_delete->moimp_desc->viewAttributes() ?>><?php echo $meansofimplement_delete->moimp_desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$meansofimplement_delete->Recordset->moveNext();
}
$meansofimplement_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $meansofimplement_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$meansofimplement_delete->showPageFooter();
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
$meansofimplement_delete->terminate();
?>