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
$relationship_delete = new relationship_delete();

// Run the page
$relationship_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$relationship_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var frelationshipdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	frelationshipdelete = currentForm = new ew.Form("frelationshipdelete", "delete");
	loadjs.done("frelationshipdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $relationship_delete->showPageHeader(); ?>
<?php
$relationship_delete->showMessage();
?>
<form name="frelationshipdelete" id="frelationshipdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="relationship">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($relationship_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($relationship_delete->RelationshipCode->Visible) { // RelationshipCode ?>
		<th class="<?php echo $relationship_delete->RelationshipCode->headerCellClass() ?>"><span id="elh_relationship_RelationshipCode" class="relationship_RelationshipCode"><?php echo $relationship_delete->RelationshipCode->caption() ?></span></th>
<?php } ?>
<?php if ($relationship_delete->Relationship->Visible) { // Relationship ?>
		<th class="<?php echo $relationship_delete->Relationship->headerCellClass() ?>"><span id="elh_relationship_Relationship" class="relationship_Relationship"><?php echo $relationship_delete->Relationship->caption() ?></span></th>
<?php } ?>
<?php if ($relationship_delete->Comment->Visible) { // Comment ?>
		<th class="<?php echo $relationship_delete->Comment->headerCellClass() ?>"><span id="elh_relationship_Comment" class="relationship_Comment"><?php echo $relationship_delete->Comment->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$relationship_delete->RecordCount = 0;
$i = 0;
while (!$relationship_delete->Recordset->EOF) {
	$relationship_delete->RecordCount++;
	$relationship_delete->RowCount++;

	// Set row properties
	$relationship->resetAttributes();
	$relationship->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$relationship_delete->loadRowValues($relationship_delete->Recordset);

	// Render row
	$relationship_delete->renderRow();
?>
	<tr <?php echo $relationship->rowAttributes() ?>>
<?php if ($relationship_delete->RelationshipCode->Visible) { // RelationshipCode ?>
		<td <?php echo $relationship_delete->RelationshipCode->cellAttributes() ?>>
<span id="el<?php echo $relationship_delete->RowCount ?>_relationship_RelationshipCode" class="relationship_RelationshipCode">
<span<?php echo $relationship_delete->RelationshipCode->viewAttributes() ?>><?php echo $relationship_delete->RelationshipCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($relationship_delete->Relationship->Visible) { // Relationship ?>
		<td <?php echo $relationship_delete->Relationship->cellAttributes() ?>>
<span id="el<?php echo $relationship_delete->RowCount ?>_relationship_Relationship" class="relationship_Relationship">
<span<?php echo $relationship_delete->Relationship->viewAttributes() ?>><?php echo $relationship_delete->Relationship->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($relationship_delete->Comment->Visible) { // Comment ?>
		<td <?php echo $relationship_delete->Comment->cellAttributes() ?>>
<span id="el<?php echo $relationship_delete->RowCount ?>_relationship_Comment" class="relationship_Comment">
<span<?php echo $relationship_delete->Comment->viewAttributes() ?>><?php echo $relationship_delete->Comment->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$relationship_delete->Recordset->moveNext();
}
$relationship_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $relationship_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$relationship_delete->showPageFooter();
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
$relationship_delete->terminate();
?>