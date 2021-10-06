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
$medical_condition_delete = new medical_condition_delete();

// Run the page
$medical_condition_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$medical_condition_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmedical_conditiondelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fmedical_conditiondelete = currentForm = new ew.Form("fmedical_conditiondelete", "delete");
	loadjs.done("fmedical_conditiondelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $medical_condition_delete->showPageHeader(); ?>
<?php
$medical_condition_delete->showMessage();
?>
<form name="fmedical_conditiondelete" id="fmedical_conditiondelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="medical_condition">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($medical_condition_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($medical_condition_delete->MedicalCondition->Visible) { // MedicalCondition ?>
		<th class="<?php echo $medical_condition_delete->MedicalCondition->headerCellClass() ?>"><span id="elh_medical_condition_MedicalCondition" class="medical_condition_MedicalCondition"><?php echo $medical_condition_delete->MedicalCondition->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$medical_condition_delete->RecordCount = 0;
$i = 0;
while (!$medical_condition_delete->Recordset->EOF) {
	$medical_condition_delete->RecordCount++;
	$medical_condition_delete->RowCount++;

	// Set row properties
	$medical_condition->resetAttributes();
	$medical_condition->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$medical_condition_delete->loadRowValues($medical_condition_delete->Recordset);

	// Render row
	$medical_condition_delete->renderRow();
?>
	<tr <?php echo $medical_condition->rowAttributes() ?>>
<?php if ($medical_condition_delete->MedicalCondition->Visible) { // MedicalCondition ?>
		<td <?php echo $medical_condition_delete->MedicalCondition->cellAttributes() ?>>
<span id="el<?php echo $medical_condition_delete->RowCount ?>_medical_condition_MedicalCondition" class="medical_condition_MedicalCondition">
<span<?php echo $medical_condition_delete->MedicalCondition->viewAttributes() ?>><?php echo $medical_condition_delete->MedicalCondition->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$medical_condition_delete->Recordset->moveNext();
}
$medical_condition_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $medical_condition_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$medical_condition_delete->showPageFooter();
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
$medical_condition_delete->terminate();
?>