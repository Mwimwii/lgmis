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
$staffqualifications_prof_delete = new staffqualifications_prof_delete();

// Run the page
$staffqualifications_prof_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffqualifications_prof_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffqualifications_profdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fstaffqualifications_profdelete = currentForm = new ew.Form("fstaffqualifications_profdelete", "delete");
	loadjs.done("fstaffqualifications_profdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffqualifications_prof_delete->showPageHeader(); ?>
<?php
$staffqualifications_prof_delete->showMessage();
?>
<form name="fstaffqualifications_profdelete" id="fstaffqualifications_profdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffqualifications_prof">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($staffqualifications_prof_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($staffqualifications_prof_delete->ProfQualificationLevel->Visible) { // ProfQualificationLevel ?>
		<th class="<?php echo $staffqualifications_prof_delete->ProfQualificationLevel->headerCellClass() ?>"><span id="elh_staffqualifications_prof_ProfQualificationLevel" class="staffqualifications_prof_ProfQualificationLevel"><?php echo $staffqualifications_prof_delete->ProfQualificationLevel->caption() ?></span></th>
<?php } ?>
<?php if ($staffqualifications_prof_delete->QualificationCode->Visible) { // QualificationCode ?>
		<th class="<?php echo $staffqualifications_prof_delete->QualificationCode->headerCellClass() ?>"><span id="elh_staffqualifications_prof_QualificationCode" class="staffqualifications_prof_QualificationCode"><?php echo $staffqualifications_prof_delete->QualificationCode->caption() ?></span></th>
<?php } ?>
<?php if ($staffqualifications_prof_delete->QualificationRemarks->Visible) { // QualificationRemarks ?>
		<th class="<?php echo $staffqualifications_prof_delete->QualificationRemarks->headerCellClass() ?>"><span id="elh_staffqualifications_prof_QualificationRemarks" class="staffqualifications_prof_QualificationRemarks"><?php echo $staffqualifications_prof_delete->QualificationRemarks->caption() ?></span></th>
<?php } ?>
<?php if ($staffqualifications_prof_delete->AwardingInstitution->Visible) { // AwardingInstitution ?>
		<th class="<?php echo $staffqualifications_prof_delete->AwardingInstitution->headerCellClass() ?>"><span id="elh_staffqualifications_prof_AwardingInstitution" class="staffqualifications_prof_AwardingInstitution"><?php echo $staffqualifications_prof_delete->AwardingInstitution->caption() ?></span></th>
<?php } ?>
<?php if ($staffqualifications_prof_delete->FromYear->Visible) { // FromYear ?>
		<th class="<?php echo $staffqualifications_prof_delete->FromYear->headerCellClass() ?>"><span id="elh_staffqualifications_prof_FromYear" class="staffqualifications_prof_FromYear"><?php echo $staffqualifications_prof_delete->FromYear->caption() ?></span></th>
<?php } ?>
<?php if ($staffqualifications_prof_delete->YearObtained->Visible) { // YearObtained ?>
		<th class="<?php echo $staffqualifications_prof_delete->YearObtained->headerCellClass() ?>"><span id="elh_staffqualifications_prof_YearObtained" class="staffqualifications_prof_YearObtained"><?php echo $staffqualifications_prof_delete->YearObtained->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$staffqualifications_prof_delete->RecordCount = 0;
$i = 0;
while (!$staffqualifications_prof_delete->Recordset->EOF) {
	$staffqualifications_prof_delete->RecordCount++;
	$staffqualifications_prof_delete->RowCount++;

	// Set row properties
	$staffqualifications_prof->resetAttributes();
	$staffqualifications_prof->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$staffqualifications_prof_delete->loadRowValues($staffqualifications_prof_delete->Recordset);

	// Render row
	$staffqualifications_prof_delete->renderRow();
?>
	<tr <?php echo $staffqualifications_prof->rowAttributes() ?>>
<?php if ($staffqualifications_prof_delete->ProfQualificationLevel->Visible) { // ProfQualificationLevel ?>
		<td <?php echo $staffqualifications_prof_delete->ProfQualificationLevel->cellAttributes() ?>>
<span id="el<?php echo $staffqualifications_prof_delete->RowCount ?>_staffqualifications_prof_ProfQualificationLevel" class="staffqualifications_prof_ProfQualificationLevel">
<span<?php echo $staffqualifications_prof_delete->ProfQualificationLevel->viewAttributes() ?>><?php echo $staffqualifications_prof_delete->ProfQualificationLevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffqualifications_prof_delete->QualificationCode->Visible) { // QualificationCode ?>
		<td <?php echo $staffqualifications_prof_delete->QualificationCode->cellAttributes() ?>>
<span id="el<?php echo $staffqualifications_prof_delete->RowCount ?>_staffqualifications_prof_QualificationCode" class="staffqualifications_prof_QualificationCode">
<span<?php echo $staffqualifications_prof_delete->QualificationCode->viewAttributes() ?>><?php echo $staffqualifications_prof_delete->QualificationCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffqualifications_prof_delete->QualificationRemarks->Visible) { // QualificationRemarks ?>
		<td <?php echo $staffqualifications_prof_delete->QualificationRemarks->cellAttributes() ?>>
<span id="el<?php echo $staffqualifications_prof_delete->RowCount ?>_staffqualifications_prof_QualificationRemarks" class="staffqualifications_prof_QualificationRemarks">
<span<?php echo $staffqualifications_prof_delete->QualificationRemarks->viewAttributes() ?>><?php echo $staffqualifications_prof_delete->QualificationRemarks->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffqualifications_prof_delete->AwardingInstitution->Visible) { // AwardingInstitution ?>
		<td <?php echo $staffqualifications_prof_delete->AwardingInstitution->cellAttributes() ?>>
<span id="el<?php echo $staffqualifications_prof_delete->RowCount ?>_staffqualifications_prof_AwardingInstitution" class="staffqualifications_prof_AwardingInstitution">
<span<?php echo $staffqualifications_prof_delete->AwardingInstitution->viewAttributes() ?>><?php echo $staffqualifications_prof_delete->AwardingInstitution->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffqualifications_prof_delete->FromYear->Visible) { // FromYear ?>
		<td <?php echo $staffqualifications_prof_delete->FromYear->cellAttributes() ?>>
<span id="el<?php echo $staffqualifications_prof_delete->RowCount ?>_staffqualifications_prof_FromYear" class="staffqualifications_prof_FromYear">
<span<?php echo $staffqualifications_prof_delete->FromYear->viewAttributes() ?>><?php echo $staffqualifications_prof_delete->FromYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffqualifications_prof_delete->YearObtained->Visible) { // YearObtained ?>
		<td <?php echo $staffqualifications_prof_delete->YearObtained->cellAttributes() ?>>
<span id="el<?php echo $staffqualifications_prof_delete->RowCount ?>_staffqualifications_prof_YearObtained" class="staffqualifications_prof_YearObtained">
<span<?php echo $staffqualifications_prof_delete->YearObtained->viewAttributes() ?>><?php echo $staffqualifications_prof_delete->YearObtained->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$staffqualifications_prof_delete->Recordset->moveNext();
}
$staffqualifications_prof_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staffqualifications_prof_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$staffqualifications_prof_delete->showPageFooter();
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
$staffqualifications_prof_delete->terminate();
?>