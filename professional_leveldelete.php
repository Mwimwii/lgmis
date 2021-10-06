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
$professional_level_delete = new professional_level_delete();

// Run the page
$professional_level_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$professional_level_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fprofessional_leveldelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fprofessional_leveldelete = currentForm = new ew.Form("fprofessional_leveldelete", "delete");
	loadjs.done("fprofessional_leveldelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $professional_level_delete->showPageHeader(); ?>
<?php
$professional_level_delete->showMessage();
?>
<form name="fprofessional_leveldelete" id="fprofessional_leveldelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="professional_level">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($professional_level_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($professional_level_delete->ProfessionalLevel->Visible) { // ProfessionalLevel ?>
		<th class="<?php echo $professional_level_delete->ProfessionalLevel->headerCellClass() ?>"><span id="elh_professional_level_ProfessionalLevel" class="professional_level_ProfessionalLevel"><?php echo $professional_level_delete->ProfessionalLevel->caption() ?></span></th>
<?php } ?>
<?php if ($professional_level_delete->ProfessionalName->Visible) { // ProfessionalName ?>
		<th class="<?php echo $professional_level_delete->ProfessionalName->headerCellClass() ?>"><span id="elh_professional_level_ProfessionalName" class="professional_level_ProfessionalName"><?php echo $professional_level_delete->ProfessionalName->caption() ?></span></th>
<?php } ?>
<?php if ($professional_level_delete->ProfessionalDesc->Visible) { // ProfessionalDesc ?>
		<th class="<?php echo $professional_level_delete->ProfessionalDesc->headerCellClass() ?>"><span id="elh_professional_level_ProfessionalDesc" class="professional_level_ProfessionalDesc"><?php echo $professional_level_delete->ProfessionalDesc->caption() ?></span></th>
<?php } ?>
<?php if ($professional_level_delete->LastUserID->Visible) { // LastUserID ?>
		<th class="<?php echo $professional_level_delete->LastUserID->headerCellClass() ?>"><span id="elh_professional_level_LastUserID" class="professional_level_LastUserID"><?php echo $professional_level_delete->LastUserID->caption() ?></span></th>
<?php } ?>
<?php if ($professional_level_delete->LastUpdated->Visible) { // LastUpdated ?>
		<th class="<?php echo $professional_level_delete->LastUpdated->headerCellClass() ?>"><span id="elh_professional_level_LastUpdated" class="professional_level_LastUpdated"><?php echo $professional_level_delete->LastUpdated->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$professional_level_delete->RecordCount = 0;
$i = 0;
while (!$professional_level_delete->Recordset->EOF) {
	$professional_level_delete->RecordCount++;
	$professional_level_delete->RowCount++;

	// Set row properties
	$professional_level->resetAttributes();
	$professional_level->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$professional_level_delete->loadRowValues($professional_level_delete->Recordset);

	// Render row
	$professional_level_delete->renderRow();
?>
	<tr <?php echo $professional_level->rowAttributes() ?>>
<?php if ($professional_level_delete->ProfessionalLevel->Visible) { // ProfessionalLevel ?>
		<td <?php echo $professional_level_delete->ProfessionalLevel->cellAttributes() ?>>
<span id="el<?php echo $professional_level_delete->RowCount ?>_professional_level_ProfessionalLevel" class="professional_level_ProfessionalLevel">
<span<?php echo $professional_level_delete->ProfessionalLevel->viewAttributes() ?>><?php echo $professional_level_delete->ProfessionalLevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($professional_level_delete->ProfessionalName->Visible) { // ProfessionalName ?>
		<td <?php echo $professional_level_delete->ProfessionalName->cellAttributes() ?>>
<span id="el<?php echo $professional_level_delete->RowCount ?>_professional_level_ProfessionalName" class="professional_level_ProfessionalName">
<span<?php echo $professional_level_delete->ProfessionalName->viewAttributes() ?>><?php echo $professional_level_delete->ProfessionalName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($professional_level_delete->ProfessionalDesc->Visible) { // ProfessionalDesc ?>
		<td <?php echo $professional_level_delete->ProfessionalDesc->cellAttributes() ?>>
<span id="el<?php echo $professional_level_delete->RowCount ?>_professional_level_ProfessionalDesc" class="professional_level_ProfessionalDesc">
<span<?php echo $professional_level_delete->ProfessionalDesc->viewAttributes() ?>><?php echo $professional_level_delete->ProfessionalDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($professional_level_delete->LastUserID->Visible) { // LastUserID ?>
		<td <?php echo $professional_level_delete->LastUserID->cellAttributes() ?>>
<span id="el<?php echo $professional_level_delete->RowCount ?>_professional_level_LastUserID" class="professional_level_LastUserID">
<span<?php echo $professional_level_delete->LastUserID->viewAttributes() ?>><?php echo $professional_level_delete->LastUserID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($professional_level_delete->LastUpdated->Visible) { // LastUpdated ?>
		<td <?php echo $professional_level_delete->LastUpdated->cellAttributes() ?>>
<span id="el<?php echo $professional_level_delete->RowCount ?>_professional_level_LastUpdated" class="professional_level_LastUpdated">
<span<?php echo $professional_level_delete->LastUpdated->viewAttributes() ?>><?php echo $professional_level_delete->LastUpdated->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$professional_level_delete->Recordset->moveNext();
}
$professional_level_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $professional_level_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$professional_level_delete->showPageFooter();
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
$professional_level_delete->terminate();
?>