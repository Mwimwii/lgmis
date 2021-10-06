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
$action_type_delete = new action_type_delete();

// Run the page
$action_type_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$action_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var faction_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	faction_typedelete = currentForm = new ew.Form("faction_typedelete", "delete");
	loadjs.done("faction_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $action_type_delete->showPageHeader(); ?>
<?php
$action_type_delete->showMessage();
?>
<form name="faction_typedelete" id="faction_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="action_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($action_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($action_type_delete->ActionType->Visible) { // ActionType ?>
		<th class="<?php echo $action_type_delete->ActionType->headerCellClass() ?>"><span id="elh_action_type_ActionType" class="action_type_ActionType"><?php echo $action_type_delete->ActionType->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$action_type_delete->RecordCount = 0;
$i = 0;
while (!$action_type_delete->Recordset->EOF) {
	$action_type_delete->RecordCount++;
	$action_type_delete->RowCount++;

	// Set row properties
	$action_type->resetAttributes();
	$action_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$action_type_delete->loadRowValues($action_type_delete->Recordset);

	// Render row
	$action_type_delete->renderRow();
?>
	<tr <?php echo $action_type->rowAttributes() ?>>
<?php if ($action_type_delete->ActionType->Visible) { // ActionType ?>
		<td <?php echo $action_type_delete->ActionType->cellAttributes() ?>>
<span id="el<?php echo $action_type_delete->RowCount ?>_action_type_ActionType" class="action_type_ActionType">
<span<?php echo $action_type_delete->ActionType->viewAttributes() ?>><?php echo $action_type_delete->ActionType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$action_type_delete->Recordset->moveNext();
}
$action_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $action_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$action_type_delete->showPageFooter();
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
$action_type_delete->terminate();
?>