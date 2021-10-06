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
$id_type_delete = new id_type_delete();

// Run the page
$id_type_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$id_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fid_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fid_typedelete = currentForm = new ew.Form("fid_typedelete", "delete");
	loadjs.done("fid_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $id_type_delete->showPageHeader(); ?>
<?php
$id_type_delete->showMessage();
?>
<form name="fid_typedelete" id="fid_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="id_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($id_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($id_type_delete->IDType->Visible) { // IDType ?>
		<th class="<?php echo $id_type_delete->IDType->headerCellClass() ?>"><span id="elh_id_type_IDType" class="id_type_IDType"><?php echo $id_type_delete->IDType->caption() ?></span></th>
<?php } ?>
<?php if ($id_type_delete->IDTypeName->Visible) { // IDTypeName ?>
		<th class="<?php echo $id_type_delete->IDTypeName->headerCellClass() ?>"><span id="elh_id_type_IDTypeName" class="id_type_IDTypeName"><?php echo $id_type_delete->IDTypeName->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$id_type_delete->RecordCount = 0;
$i = 0;
while (!$id_type_delete->Recordset->EOF) {
	$id_type_delete->RecordCount++;
	$id_type_delete->RowCount++;

	// Set row properties
	$id_type->resetAttributes();
	$id_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$id_type_delete->loadRowValues($id_type_delete->Recordset);

	// Render row
	$id_type_delete->renderRow();
?>
	<tr <?php echo $id_type->rowAttributes() ?>>
<?php if ($id_type_delete->IDType->Visible) { // IDType ?>
		<td <?php echo $id_type_delete->IDType->cellAttributes() ?>>
<span id="el<?php echo $id_type_delete->RowCount ?>_id_type_IDType" class="id_type_IDType">
<span<?php echo $id_type_delete->IDType->viewAttributes() ?>><?php echo $id_type_delete->IDType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($id_type_delete->IDTypeName->Visible) { // IDTypeName ?>
		<td <?php echo $id_type_delete->IDTypeName->cellAttributes() ?>>
<span id="el<?php echo $id_type_delete->RowCount ?>_id_type_IDTypeName" class="id_type_IDTypeName">
<span<?php echo $id_type_delete->IDTypeName->viewAttributes() ?>><?php echo $id_type_delete->IDTypeName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$id_type_delete->Recordset->moveNext();
}
$id_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $id_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$id_type_delete->showPageFooter();
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
$id_type_delete->terminate();
?>