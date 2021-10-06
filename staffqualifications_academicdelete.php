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
$staffqualifications_academic_delete = new staffqualifications_academic_delete();

// Run the page
$staffqualifications_academic_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffqualifications_academic_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffqualifications_academicdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fstaffqualifications_academicdelete = currentForm = new ew.Form("fstaffqualifications_academicdelete", "delete");
	loadjs.done("fstaffqualifications_academicdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffqualifications_academic_delete->showPageHeader(); ?>
<?php
$staffqualifications_academic_delete->showMessage();
?>
<form name="fstaffqualifications_academicdelete" id="fstaffqualifications_academicdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffqualifications_academic">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($staffqualifications_academic_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($staffqualifications_academic_delete->QualificationLevel->Visible) { // QualificationLevel ?>
		<th class="<?php echo $staffqualifications_academic_delete->QualificationLevel->headerCellClass() ?>"><span id="elh_staffqualifications_academic_QualificationLevel" class="staffqualifications_academic_QualificationLevel"><?php echo $staffqualifications_academic_delete->QualificationLevel->caption() ?></span></th>
<?php } ?>
<?php if ($staffqualifications_academic_delete->QualificationRemarks->Visible) { // QualificationRemarks ?>
		<th class="<?php echo $staffqualifications_academic_delete->QualificationRemarks->headerCellClass() ?>"><span id="elh_staffqualifications_academic_QualificationRemarks" class="staffqualifications_academic_QualificationRemarks"><?php echo $staffqualifications_academic_delete->QualificationRemarks->caption() ?></span></th>
<?php } ?>
<?php if ($staffqualifications_academic_delete->AwardingInstitution->Visible) { // AwardingInstitution ?>
		<th class="<?php echo $staffqualifications_academic_delete->AwardingInstitution->headerCellClass() ?>"><span id="elh_staffqualifications_academic_AwardingInstitution" class="staffqualifications_academic_AwardingInstitution"><?php echo $staffqualifications_academic_delete->AwardingInstitution->caption() ?></span></th>
<?php } ?>
<?php if ($staffqualifications_academic_delete->FromYear->Visible) { // FromYear ?>
		<th class="<?php echo $staffqualifications_academic_delete->FromYear->headerCellClass() ?>"><span id="elh_staffqualifications_academic_FromYear" class="staffqualifications_academic_FromYear"><?php echo $staffqualifications_academic_delete->FromYear->caption() ?></span></th>
<?php } ?>
<?php if ($staffqualifications_academic_delete->YearObtained->Visible) { // YearObtained ?>
		<th class="<?php echo $staffqualifications_academic_delete->YearObtained->headerCellClass() ?>"><span id="elh_staffqualifications_academic_YearObtained" class="staffqualifications_academic_YearObtained"><?php echo $staffqualifications_academic_delete->YearObtained->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$staffqualifications_academic_delete->RecordCount = 0;
$i = 0;
while (!$staffqualifications_academic_delete->Recordset->EOF) {
	$staffqualifications_academic_delete->RecordCount++;
	$staffqualifications_academic_delete->RowCount++;

	// Set row properties
	$staffqualifications_academic->resetAttributes();
	$staffqualifications_academic->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$staffqualifications_academic_delete->loadRowValues($staffqualifications_academic_delete->Recordset);

	// Render row
	$staffqualifications_academic_delete->renderRow();
?>
	<tr <?php echo $staffqualifications_academic->rowAttributes() ?>>
<?php if ($staffqualifications_academic_delete->QualificationLevel->Visible) { // QualificationLevel ?>
		<td <?php echo $staffqualifications_academic_delete->QualificationLevel->cellAttributes() ?>>
<span id="el<?php echo $staffqualifications_academic_delete->RowCount ?>_staffqualifications_academic_QualificationLevel" class="staffqualifications_academic_QualificationLevel">
<span<?php echo $staffqualifications_academic_delete->QualificationLevel->viewAttributes() ?>><?php echo $staffqualifications_academic_delete->QualificationLevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffqualifications_academic_delete->QualificationRemarks->Visible) { // QualificationRemarks ?>
		<td <?php echo $staffqualifications_academic_delete->QualificationRemarks->cellAttributes() ?>>
<span id="el<?php echo $staffqualifications_academic_delete->RowCount ?>_staffqualifications_academic_QualificationRemarks" class="staffqualifications_academic_QualificationRemarks">
<span<?php echo $staffqualifications_academic_delete->QualificationRemarks->viewAttributes() ?>><?php echo $staffqualifications_academic_delete->QualificationRemarks->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffqualifications_academic_delete->AwardingInstitution->Visible) { // AwardingInstitution ?>
		<td <?php echo $staffqualifications_academic_delete->AwardingInstitution->cellAttributes() ?>>
<span id="el<?php echo $staffqualifications_academic_delete->RowCount ?>_staffqualifications_academic_AwardingInstitution" class="staffqualifications_academic_AwardingInstitution">
<span<?php echo $staffqualifications_academic_delete->AwardingInstitution->viewAttributes() ?>><?php echo $staffqualifications_academic_delete->AwardingInstitution->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffqualifications_academic_delete->FromYear->Visible) { // FromYear ?>
		<td <?php echo $staffqualifications_academic_delete->FromYear->cellAttributes() ?>>
<span id="el<?php echo $staffqualifications_academic_delete->RowCount ?>_staffqualifications_academic_FromYear" class="staffqualifications_academic_FromYear">
<span<?php echo $staffqualifications_academic_delete->FromYear->viewAttributes() ?>><?php echo $staffqualifications_academic_delete->FromYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffqualifications_academic_delete->YearObtained->Visible) { // YearObtained ?>
		<td <?php echo $staffqualifications_academic_delete->YearObtained->cellAttributes() ?>>
<span id="el<?php echo $staffqualifications_academic_delete->RowCount ?>_staffqualifications_academic_YearObtained" class="staffqualifications_academic_YearObtained">
<span<?php echo $staffqualifications_academic_delete->YearObtained->viewAttributes() ?>><?php echo $staffqualifications_academic_delete->YearObtained->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$staffqualifications_academic_delete->Recordset->moveNext();
}
$staffqualifications_academic_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staffqualifications_academic_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$staffqualifications_academic_delete->showPageFooter();
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
$staffqualifications_academic_delete->terminate();
?>