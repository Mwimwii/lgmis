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
$occupation_delete = new occupation_delete();

// Run the page
$occupation_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$occupation_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var foccupationdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	foccupationdelete = currentForm = new ew.Form("foccupationdelete", "delete");
	loadjs.done("foccupationdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $occupation_delete->showPageHeader(); ?>
<?php
$occupation_delete->showMessage();
?>
<form name="foccupationdelete" id="foccupationdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="occupation">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($occupation_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($occupation_delete->OccupationCode->Visible) { // OccupationCode ?>
		<th class="<?php echo $occupation_delete->OccupationCode->headerCellClass() ?>"><span id="elh_occupation_OccupationCode" class="occupation_OccupationCode"><?php echo $occupation_delete->OccupationCode->caption() ?></span></th>
<?php } ?>
<?php if ($occupation_delete->OccupationName->Visible) { // OccupationName ?>
		<th class="<?php echo $occupation_delete->OccupationName->headerCellClass() ?>"><span id="elh_occupation_OccupationName" class="occupation_OccupationName"><?php echo $occupation_delete->OccupationName->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$occupation_delete->RecordCount = 0;
$i = 0;
while (!$occupation_delete->Recordset->EOF) {
	$occupation_delete->RecordCount++;
	$occupation_delete->RowCount++;

	// Set row properties
	$occupation->resetAttributes();
	$occupation->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$occupation_delete->loadRowValues($occupation_delete->Recordset);

	// Render row
	$occupation_delete->renderRow();
?>
	<tr <?php echo $occupation->rowAttributes() ?>>
<?php if ($occupation_delete->OccupationCode->Visible) { // OccupationCode ?>
		<td <?php echo $occupation_delete->OccupationCode->cellAttributes() ?>>
<span id="el<?php echo $occupation_delete->RowCount ?>_occupation_OccupationCode" class="occupation_OccupationCode">
<span<?php echo $occupation_delete->OccupationCode->viewAttributes() ?>><?php echo $occupation_delete->OccupationCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($occupation_delete->OccupationName->Visible) { // OccupationName ?>
		<td <?php echo $occupation_delete->OccupationName->cellAttributes() ?>>
<span id="el<?php echo $occupation_delete->RowCount ?>_occupation_OccupationName" class="occupation_OccupationName">
<span<?php echo $occupation_delete->OccupationName->viewAttributes() ?>><?php echo $occupation_delete->OccupationName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$occupation_delete->Recordset->moveNext();
}
$occupation_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $occupation_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$occupation_delete->showPageFooter();
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
$occupation_delete->terminate();
?>