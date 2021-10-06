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
$marital_status_delete = new marital_status_delete();

// Run the page
$marital_status_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$marital_status_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmarital_statusdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fmarital_statusdelete = currentForm = new ew.Form("fmarital_statusdelete", "delete");
	loadjs.done("fmarital_statusdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $marital_status_delete->showPageHeader(); ?>
<?php
$marital_status_delete->showMessage();
?>
<form name="fmarital_statusdelete" id="fmarital_statusdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="marital_status">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($marital_status_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($marital_status_delete->MaritalStatusCode->Visible) { // MaritalStatusCode ?>
		<th class="<?php echo $marital_status_delete->MaritalStatusCode->headerCellClass() ?>"><span id="elh_marital_status_MaritalStatusCode" class="marital_status_MaritalStatusCode"><?php echo $marital_status_delete->MaritalStatusCode->caption() ?></span></th>
<?php } ?>
<?php if ($marital_status_delete->MaritalStatus->Visible) { // MaritalStatus ?>
		<th class="<?php echo $marital_status_delete->MaritalStatus->headerCellClass() ?>"><span id="elh_marital_status_MaritalStatus" class="marital_status_MaritalStatus"><?php echo $marital_status_delete->MaritalStatus->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$marital_status_delete->RecordCount = 0;
$i = 0;
while (!$marital_status_delete->Recordset->EOF) {
	$marital_status_delete->RecordCount++;
	$marital_status_delete->RowCount++;

	// Set row properties
	$marital_status->resetAttributes();
	$marital_status->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$marital_status_delete->loadRowValues($marital_status_delete->Recordset);

	// Render row
	$marital_status_delete->renderRow();
?>
	<tr <?php echo $marital_status->rowAttributes() ?>>
<?php if ($marital_status_delete->MaritalStatusCode->Visible) { // MaritalStatusCode ?>
		<td <?php echo $marital_status_delete->MaritalStatusCode->cellAttributes() ?>>
<span id="el<?php echo $marital_status_delete->RowCount ?>_marital_status_MaritalStatusCode" class="marital_status_MaritalStatusCode">
<span<?php echo $marital_status_delete->MaritalStatusCode->viewAttributes() ?>><?php echo $marital_status_delete->MaritalStatusCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($marital_status_delete->MaritalStatus->Visible) { // MaritalStatus ?>
		<td <?php echo $marital_status_delete->MaritalStatus->cellAttributes() ?>>
<span id="el<?php echo $marital_status_delete->RowCount ?>_marital_status_MaritalStatus" class="marital_status_MaritalStatus">
<span<?php echo $marital_status_delete->MaritalStatus->viewAttributes() ?>><?php echo $marital_status_delete->MaritalStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$marital_status_delete->Recordset->moveNext();
}
$marital_status_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $marital_status_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$marital_status_delete->showPageFooter();
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
$marital_status_delete->terminate();
?>