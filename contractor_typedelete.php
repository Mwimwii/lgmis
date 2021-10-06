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
$contractor_type_delete = new contractor_type_delete();

// Run the page
$contractor_type_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contractor_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcontractor_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcontractor_typedelete = currentForm = new ew.Form("fcontractor_typedelete", "delete");
	loadjs.done("fcontractor_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $contractor_type_delete->showPageHeader(); ?>
<?php
$contractor_type_delete->showMessage();
?>
<form name="fcontractor_typedelete" id="fcontractor_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contractor_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($contractor_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($contractor_type_delete->ContractorTypeCode->Visible) { // ContractorTypeCode ?>
		<th class="<?php echo $contractor_type_delete->ContractorTypeCode->headerCellClass() ?>"><span id="elh_contractor_type_ContractorTypeCode" class="contractor_type_ContractorTypeCode"><?php echo $contractor_type_delete->ContractorTypeCode->caption() ?></span></th>
<?php } ?>
<?php if ($contractor_type_delete->ContractortypeName->Visible) { // ContractortypeName ?>
		<th class="<?php echo $contractor_type_delete->ContractortypeName->headerCellClass() ?>"><span id="elh_contractor_type_ContractortypeName" class="contractor_type_ContractortypeName"><?php echo $contractor_type_delete->ContractortypeName->caption() ?></span></th>
<?php } ?>
<?php if ($contractor_type_delete->ContractorTypeDesc->Visible) { // ContractorTypeDesc ?>
		<th class="<?php echo $contractor_type_delete->ContractorTypeDesc->headerCellClass() ?>"><span id="elh_contractor_type_ContractorTypeDesc" class="contractor_type_ContractorTypeDesc"><?php echo $contractor_type_delete->ContractorTypeDesc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$contractor_type_delete->RecordCount = 0;
$i = 0;
while (!$contractor_type_delete->Recordset->EOF) {
	$contractor_type_delete->RecordCount++;
	$contractor_type_delete->RowCount++;

	// Set row properties
	$contractor_type->resetAttributes();
	$contractor_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$contractor_type_delete->loadRowValues($contractor_type_delete->Recordset);

	// Render row
	$contractor_type_delete->renderRow();
?>
	<tr <?php echo $contractor_type->rowAttributes() ?>>
<?php if ($contractor_type_delete->ContractorTypeCode->Visible) { // ContractorTypeCode ?>
		<td <?php echo $contractor_type_delete->ContractorTypeCode->cellAttributes() ?>>
<span id="el<?php echo $contractor_type_delete->RowCount ?>_contractor_type_ContractorTypeCode" class="contractor_type_ContractorTypeCode">
<span<?php echo $contractor_type_delete->ContractorTypeCode->viewAttributes() ?>><?php echo $contractor_type_delete->ContractorTypeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contractor_type_delete->ContractortypeName->Visible) { // ContractortypeName ?>
		<td <?php echo $contractor_type_delete->ContractortypeName->cellAttributes() ?>>
<span id="el<?php echo $contractor_type_delete->RowCount ?>_contractor_type_ContractortypeName" class="contractor_type_ContractortypeName">
<span<?php echo $contractor_type_delete->ContractortypeName->viewAttributes() ?>><?php echo $contractor_type_delete->ContractortypeName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contractor_type_delete->ContractorTypeDesc->Visible) { // ContractorTypeDesc ?>
		<td <?php echo $contractor_type_delete->ContractorTypeDesc->cellAttributes() ?>>
<span id="el<?php echo $contractor_type_delete->RowCount ?>_contractor_type_ContractorTypeDesc" class="contractor_type_ContractorTypeDesc">
<span<?php echo $contractor_type_delete->ContractorTypeDesc->viewAttributes() ?>><?php echo $contractor_type_delete->ContractorTypeDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$contractor_type_delete->Recordset->moveNext();
}
$contractor_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contractor_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$contractor_type_delete->showPageFooter();
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
$contractor_type_delete->terminate();
?>