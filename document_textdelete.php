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
$document_text_delete = new document_text_delete();

// Run the page
$document_text_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_text_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdocument_textdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdocument_textdelete = currentForm = new ew.Form("fdocument_textdelete", "delete");
	loadjs.done("fdocument_textdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $document_text_delete->showPageHeader(); ?>
<?php
$document_text_delete->showMessage();
?>
<form name="fdocument_textdelete" id="fdocument_textdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_text">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($document_text_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($document_text_delete->ID->Visible) { // ID ?>
		<th class="<?php echo $document_text_delete->ID->headerCellClass() ?>"><span id="elh_document_text_ID" class="document_text_ID"><?php echo $document_text_delete->ID->caption() ?></span></th>
<?php } ?>
<?php if ($document_text_delete->Ref->Visible) { // Ref ?>
		<th class="<?php echo $document_text_delete->Ref->headerCellClass() ?>"><span id="elh_document_text_Ref" class="document_text_Ref"><?php echo $document_text_delete->Ref->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$document_text_delete->RecordCount = 0;
$i = 0;
while (!$document_text_delete->Recordset->EOF) {
	$document_text_delete->RecordCount++;
	$document_text_delete->RowCount++;

	// Set row properties
	$document_text->resetAttributes();
	$document_text->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$document_text_delete->loadRowValues($document_text_delete->Recordset);

	// Render row
	$document_text_delete->renderRow();
?>
	<tr <?php echo $document_text->rowAttributes() ?>>
<?php if ($document_text_delete->ID->Visible) { // ID ?>
		<td <?php echo $document_text_delete->ID->cellAttributes() ?>>
<span id="el<?php echo $document_text_delete->RowCount ?>_document_text_ID" class="document_text_ID">
<span<?php echo $document_text_delete->ID->viewAttributes() ?>><?php echo $document_text_delete->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($document_text_delete->Ref->Visible) { // Ref ?>
		<td <?php echo $document_text_delete->Ref->cellAttributes() ?>>
<span id="el<?php echo $document_text_delete->RowCount ?>_document_text_Ref" class="document_text_Ref">
<span<?php echo $document_text_delete->Ref->viewAttributes() ?>><?php echo $document_text_delete->Ref->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$document_text_delete->Recordset->moveNext();
}
$document_text_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $document_text_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$document_text_delete->showPageFooter();
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
$document_text_delete->terminate();
?>