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
$committee_role_delete = new committee_role_delete();

// Run the page
$committee_role_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$committee_role_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcommittee_roledelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcommittee_roledelete = currentForm = new ew.Form("fcommittee_roledelete", "delete");
	loadjs.done("fcommittee_roledelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $committee_role_delete->showPageHeader(); ?>
<?php
$committee_role_delete->showMessage();
?>
<form name="fcommittee_roledelete" id="fcommittee_roledelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="committee_role">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($committee_role_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($committee_role_delete->CommitteeRole->Visible) { // CommitteeRole ?>
		<th class="<?php echo $committee_role_delete->CommitteeRole->headerCellClass() ?>"><span id="elh_committee_role_CommitteeRole" class="committee_role_CommitteeRole"><?php echo $committee_role_delete->CommitteeRole->caption() ?></span></th>
<?php } ?>
<?php if ($committee_role_delete->CommitteeRoleDesc->Visible) { // CommitteeRoleDesc ?>
		<th class="<?php echo $committee_role_delete->CommitteeRoleDesc->headerCellClass() ?>"><span id="elh_committee_role_CommitteeRoleDesc" class="committee_role_CommitteeRoleDesc"><?php echo $committee_role_delete->CommitteeRoleDesc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$committee_role_delete->RecordCount = 0;
$i = 0;
while (!$committee_role_delete->Recordset->EOF) {
	$committee_role_delete->RecordCount++;
	$committee_role_delete->RowCount++;

	// Set row properties
	$committee_role->resetAttributes();
	$committee_role->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$committee_role_delete->loadRowValues($committee_role_delete->Recordset);

	// Render row
	$committee_role_delete->renderRow();
?>
	<tr <?php echo $committee_role->rowAttributes() ?>>
<?php if ($committee_role_delete->CommitteeRole->Visible) { // CommitteeRole ?>
		<td <?php echo $committee_role_delete->CommitteeRole->cellAttributes() ?>>
<span id="el<?php echo $committee_role_delete->RowCount ?>_committee_role_CommitteeRole" class="committee_role_CommitteeRole">
<span<?php echo $committee_role_delete->CommitteeRole->viewAttributes() ?>><?php echo $committee_role_delete->CommitteeRole->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($committee_role_delete->CommitteeRoleDesc->Visible) { // CommitteeRoleDesc ?>
		<td <?php echo $committee_role_delete->CommitteeRoleDesc->cellAttributes() ?>>
<span id="el<?php echo $committee_role_delete->RowCount ?>_committee_role_CommitteeRoleDesc" class="committee_role_CommitteeRoleDesc">
<span<?php echo $committee_role_delete->CommitteeRoleDesc->viewAttributes() ?>><?php echo $committee_role_delete->CommitteeRoleDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$committee_role_delete->Recordset->moveNext();
}
$committee_role_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $committee_role_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$committee_role_delete->showPageFooter();
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
$committee_role_delete->terminate();
?>