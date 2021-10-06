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
$professional_body_delete = new professional_body_delete();

// Run the page
$professional_body_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$professional_body_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fprofessional_bodydelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fprofessional_bodydelete = currentForm = new ew.Form("fprofessional_bodydelete", "delete");
	loadjs.done("fprofessional_bodydelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $professional_body_delete->showPageHeader(); ?>
<?php
$professional_body_delete->showMessage();
?>
<form name="fprofessional_bodydelete" id="fprofessional_bodydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="professional_body">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($professional_body_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($professional_body_delete->ProfessionalBody->Visible) { // ProfessionalBody ?>
		<th class="<?php echo $professional_body_delete->ProfessionalBody->headerCellClass() ?>"><span id="elh_professional_body_ProfessionalBody" class="professional_body_ProfessionalBody"><?php echo $professional_body_delete->ProfessionalBody->caption() ?></span></th>
<?php } ?>
<?php if ($professional_body_delete->ProfessionalField->Visible) { // ProfessionalField ?>
		<th class="<?php echo $professional_body_delete->ProfessionalField->headerCellClass() ?>"><span id="elh_professional_body_ProfessionalField" class="professional_body_ProfessionalField"><?php echo $professional_body_delete->ProfessionalField->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$professional_body_delete->RecordCount = 0;
$i = 0;
while (!$professional_body_delete->Recordset->EOF) {
	$professional_body_delete->RecordCount++;
	$professional_body_delete->RowCount++;

	// Set row properties
	$professional_body->resetAttributes();
	$professional_body->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$professional_body_delete->loadRowValues($professional_body_delete->Recordset);

	// Render row
	$professional_body_delete->renderRow();
?>
	<tr <?php echo $professional_body->rowAttributes() ?>>
<?php if ($professional_body_delete->ProfessionalBody->Visible) { // ProfessionalBody ?>
		<td <?php echo $professional_body_delete->ProfessionalBody->cellAttributes() ?>>
<span id="el<?php echo $professional_body_delete->RowCount ?>_professional_body_ProfessionalBody" class="professional_body_ProfessionalBody">
<span<?php echo $professional_body_delete->ProfessionalBody->viewAttributes() ?>><?php echo $professional_body_delete->ProfessionalBody->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($professional_body_delete->ProfessionalField->Visible) { // ProfessionalField ?>
		<td <?php echo $professional_body_delete->ProfessionalField->cellAttributes() ?>>
<span id="el<?php echo $professional_body_delete->RowCount ?>_professional_body_ProfessionalField" class="professional_body_ProfessionalField">
<span<?php echo $professional_body_delete->ProfessionalField->viewAttributes() ?>><?php echo $professional_body_delete->ProfessionalField->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$professional_body_delete->Recordset->moveNext();
}
$professional_body_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $professional_body_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$professional_body_delete->showPageFooter();
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
$professional_body_delete->terminate();
?>