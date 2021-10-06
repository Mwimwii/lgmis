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
$programme_ref_delete = new programme_ref_delete();

// Run the page
$programme_ref_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$programme_ref_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fprogramme_refdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fprogramme_refdelete = currentForm = new ew.Form("fprogramme_refdelete", "delete");
	loadjs.done("fprogramme_refdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $programme_ref_delete->showPageHeader(); ?>
<?php
$programme_ref_delete->showMessage();
?>
<form name="fprogramme_refdelete" id="fprogramme_refdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="programme_ref">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($programme_ref_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($programme_ref_delete->ProgRefCode->Visible) { // ProgRefCode ?>
		<th class="<?php echo $programme_ref_delete->ProgRefCode->headerCellClass() ?>"><span id="elh_programme_ref_ProgRefCode" class="programme_ref_ProgRefCode"><?php echo $programme_ref_delete->ProgRefCode->caption() ?></span></th>
<?php } ?>
<?php if ($programme_ref_delete->FunctionCode->Visible) { // FunctionCode ?>
		<th class="<?php echo $programme_ref_delete->FunctionCode->headerCellClass() ?>"><span id="elh_programme_ref_FunctionCode" class="programme_ref_FunctionCode"><?php echo $programme_ref_delete->FunctionCode->caption() ?></span></th>
<?php } ?>
<?php if ($programme_ref_delete->ProgrammeCode->Visible) { // ProgrammeCode ?>
		<th class="<?php echo $programme_ref_delete->ProgrammeCode->headerCellClass() ?>"><span id="elh_programme_ref_ProgrammeCode" class="programme_ref_ProgrammeCode"><?php echo $programme_ref_delete->ProgrammeCode->caption() ?></span></th>
<?php } ?>
<?php if ($programme_ref_delete->ProgrammeName->Visible) { // ProgrammeName ?>
		<th class="<?php echo $programme_ref_delete->ProgrammeName->headerCellClass() ?>"><span id="elh_programme_ref_ProgrammeName" class="programme_ref_ProgrammeName"><?php echo $programme_ref_delete->ProgrammeName->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$programme_ref_delete->RecordCount = 0;
$i = 0;
while (!$programme_ref_delete->Recordset->EOF) {
	$programme_ref_delete->RecordCount++;
	$programme_ref_delete->RowCount++;

	// Set row properties
	$programme_ref->resetAttributes();
	$programme_ref->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$programme_ref_delete->loadRowValues($programme_ref_delete->Recordset);

	// Render row
	$programme_ref_delete->renderRow();
?>
	<tr <?php echo $programme_ref->rowAttributes() ?>>
<?php if ($programme_ref_delete->ProgRefCode->Visible) { // ProgRefCode ?>
		<td <?php echo $programme_ref_delete->ProgRefCode->cellAttributes() ?>>
<span id="el<?php echo $programme_ref_delete->RowCount ?>_programme_ref_ProgRefCode" class="programme_ref_ProgRefCode">
<span<?php echo $programme_ref_delete->ProgRefCode->viewAttributes() ?>><?php echo $programme_ref_delete->ProgRefCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($programme_ref_delete->FunctionCode->Visible) { // FunctionCode ?>
		<td <?php echo $programme_ref_delete->FunctionCode->cellAttributes() ?>>
<span id="el<?php echo $programme_ref_delete->RowCount ?>_programme_ref_FunctionCode" class="programme_ref_FunctionCode">
<span<?php echo $programme_ref_delete->FunctionCode->viewAttributes() ?>><?php echo $programme_ref_delete->FunctionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($programme_ref_delete->ProgrammeCode->Visible) { // ProgrammeCode ?>
		<td <?php echo $programme_ref_delete->ProgrammeCode->cellAttributes() ?>>
<span id="el<?php echo $programme_ref_delete->RowCount ?>_programme_ref_ProgrammeCode" class="programme_ref_ProgrammeCode">
<span<?php echo $programme_ref_delete->ProgrammeCode->viewAttributes() ?>><?php echo $programme_ref_delete->ProgrammeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($programme_ref_delete->ProgrammeName->Visible) { // ProgrammeName ?>
		<td <?php echo $programme_ref_delete->ProgrammeName->cellAttributes() ?>>
<span id="el<?php echo $programme_ref_delete->RowCount ?>_programme_ref_ProgrammeName" class="programme_ref_ProgrammeName">
<span<?php echo $programme_ref_delete->ProgrammeName->viewAttributes() ?>><?php echo $programme_ref_delete->ProgrammeName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$programme_ref_delete->Recordset->moveNext();
}
$programme_ref_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $programme_ref_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$programme_ref_delete->showPageFooter();
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
$programme_ref_delete->terminate();
?>