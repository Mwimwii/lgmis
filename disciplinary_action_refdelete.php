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
$disciplinary_action_ref_delete = new disciplinary_action_ref_delete();

// Run the page
$disciplinary_action_ref_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$disciplinary_action_ref_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdisciplinary_action_refdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdisciplinary_action_refdelete = currentForm = new ew.Form("fdisciplinary_action_refdelete", "delete");
	loadjs.done("fdisciplinary_action_refdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $disciplinary_action_ref_delete->showPageHeader(); ?>
<?php
$disciplinary_action_ref_delete->showMessage();
?>
<form name="fdisciplinary_action_refdelete" id="fdisciplinary_action_refdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="disciplinary_action_ref">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($disciplinary_action_ref_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($disciplinary_action_ref_delete->ActionCode->Visible) { // ActionCode ?>
		<th class="<?php echo $disciplinary_action_ref_delete->ActionCode->headerCellClass() ?>"><span id="elh_disciplinary_action_ref_ActionCode" class="disciplinary_action_ref_ActionCode"><?php echo $disciplinary_action_ref_delete->ActionCode->caption() ?></span></th>
<?php } ?>
<?php if ($disciplinary_action_ref_delete->ActionDesc->Visible) { // ActionDesc ?>
		<th class="<?php echo $disciplinary_action_ref_delete->ActionDesc->headerCellClass() ?>"><span id="elh_disciplinary_action_ref_ActionDesc" class="disciplinary_action_ref_ActionDesc"><?php echo $disciplinary_action_ref_delete->ActionDesc->caption() ?></span></th>
<?php } ?>
<?php if ($disciplinary_action_ref_delete->Authority->Visible) { // Authority ?>
		<th class="<?php echo $disciplinary_action_ref_delete->Authority->headerCellClass() ?>"><span id="elh_disciplinary_action_ref_Authority" class="disciplinary_action_ref_Authority"><?php echo $disciplinary_action_ref_delete->Authority->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$disciplinary_action_ref_delete->RecordCount = 0;
$i = 0;
while (!$disciplinary_action_ref_delete->Recordset->EOF) {
	$disciplinary_action_ref_delete->RecordCount++;
	$disciplinary_action_ref_delete->RowCount++;

	// Set row properties
	$disciplinary_action_ref->resetAttributes();
	$disciplinary_action_ref->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$disciplinary_action_ref_delete->loadRowValues($disciplinary_action_ref_delete->Recordset);

	// Render row
	$disciplinary_action_ref_delete->renderRow();
?>
	<tr <?php echo $disciplinary_action_ref->rowAttributes() ?>>
<?php if ($disciplinary_action_ref_delete->ActionCode->Visible) { // ActionCode ?>
		<td <?php echo $disciplinary_action_ref_delete->ActionCode->cellAttributes() ?>>
<span id="el<?php echo $disciplinary_action_ref_delete->RowCount ?>_disciplinary_action_ref_ActionCode" class="disciplinary_action_ref_ActionCode">
<span<?php echo $disciplinary_action_ref_delete->ActionCode->viewAttributes() ?>><?php echo $disciplinary_action_ref_delete->ActionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($disciplinary_action_ref_delete->ActionDesc->Visible) { // ActionDesc ?>
		<td <?php echo $disciplinary_action_ref_delete->ActionDesc->cellAttributes() ?>>
<span id="el<?php echo $disciplinary_action_ref_delete->RowCount ?>_disciplinary_action_ref_ActionDesc" class="disciplinary_action_ref_ActionDesc">
<span<?php echo $disciplinary_action_ref_delete->ActionDesc->viewAttributes() ?>><?php echo $disciplinary_action_ref_delete->ActionDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($disciplinary_action_ref_delete->Authority->Visible) { // Authority ?>
		<td <?php echo $disciplinary_action_ref_delete->Authority->cellAttributes() ?>>
<span id="el<?php echo $disciplinary_action_ref_delete->RowCount ?>_disciplinary_action_ref_Authority" class="disciplinary_action_ref_Authority">
<span<?php echo $disciplinary_action_ref_delete->Authority->viewAttributes() ?>><?php echo $disciplinary_action_ref_delete->Authority->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$disciplinary_action_ref_delete->Recordset->moveNext();
}
$disciplinary_action_ref_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $disciplinary_action_ref_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$disciplinary_action_ref_delete->showPageFooter();
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
$disciplinary_action_ref_delete->terminate();
?>