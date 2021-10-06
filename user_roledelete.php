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
$user_role_delete = new user_role_delete();

// Run the page
$user_role_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_role_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fuser_roledelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fuser_roledelete = currentForm = new ew.Form("fuser_roledelete", "delete");
	loadjs.done("fuser_roledelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $user_role_delete->showPageHeader(); ?>
<?php
$user_role_delete->showMessage();
?>
<form name="fuser_roledelete" id="fuser_roledelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user_role">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($user_role_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($user_role_delete->Role->Visible) { // Role ?>
		<th class="<?php echo $user_role_delete->Role->headerCellClass() ?>"><span id="elh_user_role_Role" class="user_role_Role"><?php echo $user_role_delete->Role->caption() ?></span></th>
<?php } ?>
<?php if ($user_role_delete->RoleDescription->Visible) { // RoleDescription ?>
		<th class="<?php echo $user_role_delete->RoleDescription->headerCellClass() ?>"><span id="elh_user_role_RoleDescription" class="user_role_RoleDescription"><?php echo $user_role_delete->RoleDescription->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$user_role_delete->RecordCount = 0;
$i = 0;
while (!$user_role_delete->Recordset->EOF) {
	$user_role_delete->RecordCount++;
	$user_role_delete->RowCount++;

	// Set row properties
	$user_role->resetAttributes();
	$user_role->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$user_role_delete->loadRowValues($user_role_delete->Recordset);

	// Render row
	$user_role_delete->renderRow();
?>
	<tr <?php echo $user_role->rowAttributes() ?>>
<?php if ($user_role_delete->Role->Visible) { // Role ?>
		<td <?php echo $user_role_delete->Role->cellAttributes() ?>>
<span id="el<?php echo $user_role_delete->RowCount ?>_user_role_Role" class="user_role_Role">
<span<?php echo $user_role_delete->Role->viewAttributes() ?>><?php echo $user_role_delete->Role->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user_role_delete->RoleDescription->Visible) { // RoleDescription ?>
		<td <?php echo $user_role_delete->RoleDescription->cellAttributes() ?>>
<span id="el<?php echo $user_role_delete->RowCount ?>_user_role_RoleDescription" class="user_role_RoleDescription">
<span<?php echo $user_role_delete->RoleDescription->viewAttributes() ?>><?php echo $user_role_delete->RoleDescription->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$user_role_delete->Recordset->moveNext();
}
$user_role_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $user_role_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$user_role_delete->showPageFooter();
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
$user_role_delete->terminate();
?>