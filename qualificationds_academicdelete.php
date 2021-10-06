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
$qualificationds_academic_delete = new qualificationds_academic_delete();

// Run the page
$qualificationds_academic_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$qualificationds_academic_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fqualificationds_academicdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fqualificationds_academicdelete = currentForm = new ew.Form("fqualificationds_academicdelete", "delete");
	loadjs.done("fqualificationds_academicdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $qualificationds_academic_delete->showPageHeader(); ?>
<?php
$qualificationds_academic_delete->showMessage();
?>
<form name="fqualificationds_academicdelete" id="fqualificationds_academicdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="qualificationds_academic">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($qualificationds_academic_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($qualificationds_academic_delete->AcademicQualifications->Visible) { // AcademicQualifications ?>
		<th class="<?php echo $qualificationds_academic_delete->AcademicQualifications->headerCellClass() ?>"><span id="elh_qualificationds_academic_AcademicQualifications" class="qualificationds_academic_AcademicQualifications"><?php echo $qualificationds_academic_delete->AcademicQualifications->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$qualificationds_academic_delete->RecordCount = 0;
$i = 0;
while (!$qualificationds_academic_delete->Recordset->EOF) {
	$qualificationds_academic_delete->RecordCount++;
	$qualificationds_academic_delete->RowCount++;

	// Set row properties
	$qualificationds_academic->resetAttributes();
	$qualificationds_academic->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$qualificationds_academic_delete->loadRowValues($qualificationds_academic_delete->Recordset);

	// Render row
	$qualificationds_academic_delete->renderRow();
?>
	<tr <?php echo $qualificationds_academic->rowAttributes() ?>>
<?php if ($qualificationds_academic_delete->AcademicQualifications->Visible) { // AcademicQualifications ?>
		<td <?php echo $qualificationds_academic_delete->AcademicQualifications->cellAttributes() ?>>
<span id="el<?php echo $qualificationds_academic_delete->RowCount ?>_qualificationds_academic_AcademicQualifications" class="qualificationds_academic_AcademicQualifications">
<span<?php echo $qualificationds_academic_delete->AcademicQualifications->viewAttributes() ?>><?php echo $qualificationds_academic_delete->AcademicQualifications->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$qualificationds_academic_delete->Recordset->moveNext();
}
$qualificationds_academic_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $qualificationds_academic_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$qualificationds_academic_delete->showPageFooter();
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
$qualificationds_academic_delete->terminate();
?>