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
$sex_delete = new sex_delete();

// Run the page
$sex_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sex_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsexdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fsexdelete = currentForm = new ew.Form("fsexdelete", "delete");
	loadjs.done("fsexdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $sex_delete->showPageHeader(); ?>
<?php
$sex_delete->showMessage();
?>
<form name="fsexdelete" id="fsexdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sex">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($sex_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($sex_delete->Sex->Visible) { // Sex ?>
		<th class="<?php echo $sex_delete->Sex->headerCellClass() ?>"><span id="elh_sex_Sex" class="sex_Sex"><?php echo $sex_delete->Sex->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$sex_delete->RecordCount = 0;
$i = 0;
while (!$sex_delete->Recordset->EOF) {
	$sex_delete->RecordCount++;
	$sex_delete->RowCount++;

	// Set row properties
	$sex->resetAttributes();
	$sex->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$sex_delete->loadRowValues($sex_delete->Recordset);

	// Render row
	$sex_delete->renderRow();
?>
	<tr <?php echo $sex->rowAttributes() ?>>
<?php if ($sex_delete->Sex->Visible) { // Sex ?>
		<td <?php echo $sex_delete->Sex->cellAttributes() ?>>
<span id="el<?php echo $sex_delete->RowCount ?>_sex_Sex" class="sex_Sex">
<span<?php echo $sex_delete->Sex->viewAttributes() ?>><?php echo $sex_delete->Sex->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$sex_delete->Recordset->moveNext();
}
$sex_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $sex_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$sex_delete->showPageFooter();
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
$sex_delete->terminate();
?>