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
$committee_delete = new committee_delete();

// Run the page
$committee_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$committee_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcommitteedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcommitteedelete = currentForm = new ew.Form("fcommitteedelete", "delete");
	loadjs.done("fcommitteedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $committee_delete->showPageHeader(); ?>
<?php
$committee_delete->showMessage();
?>
<form name="fcommitteedelete" id="fcommitteedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="committee">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($committee_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($committee_delete->CommitteCode->Visible) { // CommitteCode ?>
		<th class="<?php echo $committee_delete->CommitteCode->headerCellClass() ?>"><span id="elh_committee_CommitteCode" class="committee_CommitteCode"><?php echo $committee_delete->CommitteCode->caption() ?></span></th>
<?php } ?>
<?php if ($committee_delete->CommitteeName->Visible) { // CommitteeName ?>
		<th class="<?php echo $committee_delete->CommitteeName->headerCellClass() ?>"><span id="elh_committee_CommitteeName" class="committee_CommitteeName"><?php echo $committee_delete->CommitteeName->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$committee_delete->RecordCount = 0;
$i = 0;
while (!$committee_delete->Recordset->EOF) {
	$committee_delete->RecordCount++;
	$committee_delete->RowCount++;

	// Set row properties
	$committee->resetAttributes();
	$committee->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$committee_delete->loadRowValues($committee_delete->Recordset);

	// Render row
	$committee_delete->renderRow();
?>
	<tr <?php echo $committee->rowAttributes() ?>>
<?php if ($committee_delete->CommitteCode->Visible) { // CommitteCode ?>
		<td <?php echo $committee_delete->CommitteCode->cellAttributes() ?>>
<span id="el<?php echo $committee_delete->RowCount ?>_committee_CommitteCode" class="committee_CommitteCode">
<span<?php echo $committee_delete->CommitteCode->viewAttributes() ?>><?php echo $committee_delete->CommitteCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($committee_delete->CommitteeName->Visible) { // CommitteeName ?>
		<td <?php echo $committee_delete->CommitteeName->cellAttributes() ?>>
<span id="el<?php echo $committee_delete->RowCount ?>_committee_CommitteeName" class="committee_CommitteeName">
<span<?php echo $committee_delete->CommitteeName->viewAttributes() ?>><?php echo $committee_delete->CommitteeName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$committee_delete->Recordset->moveNext();
}
$committee_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $committee_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$committee_delete->showPageFooter();
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
$committee_delete->terminate();
?>