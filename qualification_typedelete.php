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
$qualification_type_delete = new qualification_type_delete();

// Run the page
$qualification_type_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$qualification_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fqualification_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fqualification_typedelete = currentForm = new ew.Form("fqualification_typedelete", "delete");
	loadjs.done("fqualification_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $qualification_type_delete->showPageHeader(); ?>
<?php
$qualification_type_delete->showMessage();
?>
<form name="fqualification_typedelete" id="fqualification_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="qualification_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($qualification_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($qualification_type_delete->QualificationType->Visible) { // QualificationType ?>
		<th class="<?php echo $qualification_type_delete->QualificationType->headerCellClass() ?>"><span id="elh_qualification_type_QualificationType" class="qualification_type_QualificationType"><?php echo $qualification_type_delete->QualificationType->caption() ?></span></th>
<?php } ?>
<?php if ($qualification_type_delete->QualificationTYpeName->Visible) { // QualificationTYpeName ?>
		<th class="<?php echo $qualification_type_delete->QualificationTYpeName->headerCellClass() ?>"><span id="elh_qualification_type_QualificationTYpeName" class="qualification_type_QualificationTYpeName"><?php echo $qualification_type_delete->QualificationTYpeName->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$qualification_type_delete->RecordCount = 0;
$i = 0;
while (!$qualification_type_delete->Recordset->EOF) {
	$qualification_type_delete->RecordCount++;
	$qualification_type_delete->RowCount++;

	// Set row properties
	$qualification_type->resetAttributes();
	$qualification_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$qualification_type_delete->loadRowValues($qualification_type_delete->Recordset);

	// Render row
	$qualification_type_delete->renderRow();
?>
	<tr <?php echo $qualification_type->rowAttributes() ?>>
<?php if ($qualification_type_delete->QualificationType->Visible) { // QualificationType ?>
		<td <?php echo $qualification_type_delete->QualificationType->cellAttributes() ?>>
<span id="el<?php echo $qualification_type_delete->RowCount ?>_qualification_type_QualificationType" class="qualification_type_QualificationType">
<span<?php echo $qualification_type_delete->QualificationType->viewAttributes() ?>><?php echo $qualification_type_delete->QualificationType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($qualification_type_delete->QualificationTYpeName->Visible) { // QualificationTYpeName ?>
		<td <?php echo $qualification_type_delete->QualificationTYpeName->cellAttributes() ?>>
<span id="el<?php echo $qualification_type_delete->RowCount ?>_qualification_type_QualificationTYpeName" class="qualification_type_QualificationTYpeName">
<span<?php echo $qualification_type_delete->QualificationTYpeName->viewAttributes() ?>><?php echo $qualification_type_delete->QualificationTYpeName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$qualification_type_delete->Recordset->moveNext();
}
$qualification_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $qualification_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$qualification_type_delete->showPageFooter();
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
$qualification_type_delete->terminate();
?>