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
$qualifications_professional_delete = new qualifications_professional_delete();

// Run the page
$qualifications_professional_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$qualifications_professional_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fqualifications_professionaldelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fqualifications_professionaldelete = currentForm = new ew.Form("fqualifications_professionaldelete", "delete");
	loadjs.done("fqualifications_professionaldelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $qualifications_professional_delete->showPageHeader(); ?>
<?php
$qualifications_professional_delete->showMessage();
?>
<form name="fqualifications_professionaldelete" id="fqualifications_professionaldelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="qualifications_professional">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($qualifications_professional_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($qualifications_professional_delete->ProfessionalQualifications->Visible) { // ProfessionalQualifications ?>
		<th class="<?php echo $qualifications_professional_delete->ProfessionalQualifications->headerCellClass() ?>"><span id="elh_qualifications_professional_ProfessionalQualifications" class="qualifications_professional_ProfessionalQualifications"><?php echo $qualifications_professional_delete->ProfessionalQualifications->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$qualifications_professional_delete->RecordCount = 0;
$i = 0;
while (!$qualifications_professional_delete->Recordset->EOF) {
	$qualifications_professional_delete->RecordCount++;
	$qualifications_professional_delete->RowCount++;

	// Set row properties
	$qualifications_professional->resetAttributes();
	$qualifications_professional->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$qualifications_professional_delete->loadRowValues($qualifications_professional_delete->Recordset);

	// Render row
	$qualifications_professional_delete->renderRow();
?>
	<tr <?php echo $qualifications_professional->rowAttributes() ?>>
<?php if ($qualifications_professional_delete->ProfessionalQualifications->Visible) { // ProfessionalQualifications ?>
		<td <?php echo $qualifications_professional_delete->ProfessionalQualifications->cellAttributes() ?>>
<span id="el<?php echo $qualifications_professional_delete->RowCount ?>_qualifications_professional_ProfessionalQualifications" class="qualifications_professional_ProfessionalQualifications">
<span<?php echo $qualifications_professional_delete->ProfessionalQualifications->viewAttributes() ?>><?php echo $qualifications_professional_delete->ProfessionalQualifications->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$qualifications_professional_delete->Recordset->moveNext();
}
$qualifications_professional_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $qualifications_professional_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$qualifications_professional_delete->showPageFooter();
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
$qualifications_professional_delete->terminate();
?>