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
$quarter_ref_delete = new quarter_ref_delete();

// Run the page
$quarter_ref_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$quarter_ref_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fquarter_refdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fquarter_refdelete = currentForm = new ew.Form("fquarter_refdelete", "delete");
	loadjs.done("fquarter_refdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $quarter_ref_delete->showPageHeader(); ?>
<?php
$quarter_ref_delete->showMessage();
?>
<form name="fquarter_refdelete" id="fquarter_refdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="quarter_ref">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($quarter_ref_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($quarter_ref_delete->Quarter->Visible) { // Quarter ?>
		<th class="<?php echo $quarter_ref_delete->Quarter->headerCellClass() ?>"><span id="elh_quarter_ref_Quarter" class="quarter_ref_Quarter"><?php echo $quarter_ref_delete->Quarter->caption() ?></span></th>
<?php } ?>
<?php if ($quarter_ref_delete->BillYear->Visible) { // BillYear ?>
		<th class="<?php echo $quarter_ref_delete->BillYear->headerCellClass() ?>"><span id="elh_quarter_ref_BillYear" class="quarter_ref_BillYear"><?php echo $quarter_ref_delete->BillYear->caption() ?></span></th>
<?php } ?>
<?php if ($quarter_ref_delete->StartDate->Visible) { // StartDate ?>
		<th class="<?php echo $quarter_ref_delete->StartDate->headerCellClass() ?>"><span id="elh_quarter_ref_StartDate" class="quarter_ref_StartDate"><?php echo $quarter_ref_delete->StartDate->caption() ?></span></th>
<?php } ?>
<?php if ($quarter_ref_delete->Enddate->Visible) { // Enddate ?>
		<th class="<?php echo $quarter_ref_delete->Enddate->headerCellClass() ?>"><span id="elh_quarter_ref_Enddate" class="quarter_ref_Enddate"><?php echo $quarter_ref_delete->Enddate->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$quarter_ref_delete->RecordCount = 0;
$i = 0;
while (!$quarter_ref_delete->Recordset->EOF) {
	$quarter_ref_delete->RecordCount++;
	$quarter_ref_delete->RowCount++;

	// Set row properties
	$quarter_ref->resetAttributes();
	$quarter_ref->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$quarter_ref_delete->loadRowValues($quarter_ref_delete->Recordset);

	// Render row
	$quarter_ref_delete->renderRow();
?>
	<tr <?php echo $quarter_ref->rowAttributes() ?>>
<?php if ($quarter_ref_delete->Quarter->Visible) { // Quarter ?>
		<td <?php echo $quarter_ref_delete->Quarter->cellAttributes() ?>>
<span id="el<?php echo $quarter_ref_delete->RowCount ?>_quarter_ref_Quarter" class="quarter_ref_Quarter">
<span<?php echo $quarter_ref_delete->Quarter->viewAttributes() ?>><?php echo $quarter_ref_delete->Quarter->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($quarter_ref_delete->BillYear->Visible) { // BillYear ?>
		<td <?php echo $quarter_ref_delete->BillYear->cellAttributes() ?>>
<span id="el<?php echo $quarter_ref_delete->RowCount ?>_quarter_ref_BillYear" class="quarter_ref_BillYear">
<span<?php echo $quarter_ref_delete->BillYear->viewAttributes() ?>><?php echo $quarter_ref_delete->BillYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($quarter_ref_delete->StartDate->Visible) { // StartDate ?>
		<td <?php echo $quarter_ref_delete->StartDate->cellAttributes() ?>>
<span id="el<?php echo $quarter_ref_delete->RowCount ?>_quarter_ref_StartDate" class="quarter_ref_StartDate">
<span<?php echo $quarter_ref_delete->StartDate->viewAttributes() ?>><?php echo $quarter_ref_delete->StartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($quarter_ref_delete->Enddate->Visible) { // Enddate ?>
		<td <?php echo $quarter_ref_delete->Enddate->cellAttributes() ?>>
<span id="el<?php echo $quarter_ref_delete->RowCount ?>_quarter_ref_Enddate" class="quarter_ref_Enddate">
<span<?php echo $quarter_ref_delete->Enddate->viewAttributes() ?>><?php echo $quarter_ref_delete->Enddate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$quarter_ref_delete->Recordset->moveNext();
}
$quarter_ref_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $quarter_ref_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$quarter_ref_delete->showPageFooter();
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
$quarter_ref_delete->terminate();
?>