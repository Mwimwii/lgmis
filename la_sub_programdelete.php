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
$la_sub_program_delete = new la_sub_program_delete();

// Run the page
$la_sub_program_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$la_sub_program_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fla_sub_programdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fla_sub_programdelete = currentForm = new ew.Form("fla_sub_programdelete", "delete");
	loadjs.done("fla_sub_programdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $la_sub_program_delete->showPageHeader(); ?>
<?php
$la_sub_program_delete->showMessage();
?>
<form name="fla_sub_programdelete" id="fla_sub_programdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="la_sub_program">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($la_sub_program_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($la_sub_program_delete->ProgramCode->Visible) { // ProgramCode ?>
		<th class="<?php echo $la_sub_program_delete->ProgramCode->headerCellClass() ?>"><span id="elh_la_sub_program_ProgramCode" class="la_sub_program_ProgramCode"><?php echo $la_sub_program_delete->ProgramCode->caption() ?></span></th>
<?php } ?>
<?php if ($la_sub_program_delete->SubProgramCode->Visible) { // SubProgramCode ?>
		<th class="<?php echo $la_sub_program_delete->SubProgramCode->headerCellClass() ?>"><span id="elh_la_sub_program_SubProgramCode" class="la_sub_program_SubProgramCode"><?php echo $la_sub_program_delete->SubProgramCode->caption() ?></span></th>
<?php } ?>
<?php if ($la_sub_program_delete->SubProgramName->Visible) { // SubProgramName ?>
		<th class="<?php echo $la_sub_program_delete->SubProgramName->headerCellClass() ?>"><span id="elh_la_sub_program_SubProgramName" class="la_sub_program_SubProgramName"><?php echo $la_sub_program_delete->SubProgramName->caption() ?></span></th>
<?php } ?>
<?php if ($la_sub_program_delete->SubProgramPurpose->Visible) { // SubProgramPurpose ?>
		<th class="<?php echo $la_sub_program_delete->SubProgramPurpose->headerCellClass() ?>"><span id="elh_la_sub_program_SubProgramPurpose" class="la_sub_program_SubProgramPurpose"><?php echo $la_sub_program_delete->SubProgramPurpose->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$la_sub_program_delete->RecordCount = 0;
$i = 0;
while (!$la_sub_program_delete->Recordset->EOF) {
	$la_sub_program_delete->RecordCount++;
	$la_sub_program_delete->RowCount++;

	// Set row properties
	$la_sub_program->resetAttributes();
	$la_sub_program->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$la_sub_program_delete->loadRowValues($la_sub_program_delete->Recordset);

	// Render row
	$la_sub_program_delete->renderRow();
?>
	<tr <?php echo $la_sub_program->rowAttributes() ?>>
<?php if ($la_sub_program_delete->ProgramCode->Visible) { // ProgramCode ?>
		<td <?php echo $la_sub_program_delete->ProgramCode->cellAttributes() ?>>
<span id="el<?php echo $la_sub_program_delete->RowCount ?>_la_sub_program_ProgramCode" class="la_sub_program_ProgramCode">
<span<?php echo $la_sub_program_delete->ProgramCode->viewAttributes() ?>><?php echo $la_sub_program_delete->ProgramCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($la_sub_program_delete->SubProgramCode->Visible) { // SubProgramCode ?>
		<td <?php echo $la_sub_program_delete->SubProgramCode->cellAttributes() ?>>
<span id="el<?php echo $la_sub_program_delete->RowCount ?>_la_sub_program_SubProgramCode" class="la_sub_program_SubProgramCode">
<span<?php echo $la_sub_program_delete->SubProgramCode->viewAttributes() ?>><?php echo $la_sub_program_delete->SubProgramCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($la_sub_program_delete->SubProgramName->Visible) { // SubProgramName ?>
		<td <?php echo $la_sub_program_delete->SubProgramName->cellAttributes() ?>>
<span id="el<?php echo $la_sub_program_delete->RowCount ?>_la_sub_program_SubProgramName" class="la_sub_program_SubProgramName">
<span<?php echo $la_sub_program_delete->SubProgramName->viewAttributes() ?>><?php echo $la_sub_program_delete->SubProgramName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($la_sub_program_delete->SubProgramPurpose->Visible) { // SubProgramPurpose ?>
		<td <?php echo $la_sub_program_delete->SubProgramPurpose->cellAttributes() ?>>
<span id="el<?php echo $la_sub_program_delete->RowCount ?>_la_sub_program_SubProgramPurpose" class="la_sub_program_SubProgramPurpose">
<span<?php echo $la_sub_program_delete->SubProgramPurpose->viewAttributes() ?>><?php echo $la_sub_program_delete->SubProgramPurpose->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$la_sub_program_delete->Recordset->moveNext();
}
$la_sub_program_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $la_sub_program_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$la_sub_program_delete->showPageFooter();
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
$la_sub_program_delete->terminate();
?>