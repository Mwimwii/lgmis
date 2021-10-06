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
$employment_status_delete = new employment_status_delete();

// Run the page
$employment_status_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_status_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployment_statusdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	femployment_statusdelete = currentForm = new ew.Form("femployment_statusdelete", "delete");
	loadjs.done("femployment_statusdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employment_status_delete->showPageHeader(); ?>
<?php
$employment_status_delete->showMessage();
?>
<form name="femployment_statusdelete" id="femployment_statusdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employment_status">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($employment_status_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($employment_status_delete->EmploymentStatus->Visible) { // EmploymentStatus ?>
		<th class="<?php echo $employment_status_delete->EmploymentStatus->headerCellClass() ?>"><span id="elh_employment_status_EmploymentStatus" class="employment_status_EmploymentStatus"><?php echo $employment_status_delete->EmploymentStatus->caption() ?></span></th>
<?php } ?>
<?php if ($employment_status_delete->EmploymentStatusDesc->Visible) { // EmploymentStatusDesc ?>
		<th class="<?php echo $employment_status_delete->EmploymentStatusDesc->headerCellClass() ?>"><span id="elh_employment_status_EmploymentStatusDesc" class="employment_status_EmploymentStatusDesc"><?php echo $employment_status_delete->EmploymentStatusDesc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$employment_status_delete->RecordCount = 0;
$i = 0;
while (!$employment_status_delete->Recordset->EOF) {
	$employment_status_delete->RecordCount++;
	$employment_status_delete->RowCount++;

	// Set row properties
	$employment_status->resetAttributes();
	$employment_status->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$employment_status_delete->loadRowValues($employment_status_delete->Recordset);

	// Render row
	$employment_status_delete->renderRow();
?>
	<tr <?php echo $employment_status->rowAttributes() ?>>
<?php if ($employment_status_delete->EmploymentStatus->Visible) { // EmploymentStatus ?>
		<td <?php echo $employment_status_delete->EmploymentStatus->cellAttributes() ?>>
<span id="el<?php echo $employment_status_delete->RowCount ?>_employment_status_EmploymentStatus" class="employment_status_EmploymentStatus">
<span<?php echo $employment_status_delete->EmploymentStatus->viewAttributes() ?>><?php echo $employment_status_delete->EmploymentStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment_status_delete->EmploymentStatusDesc->Visible) { // EmploymentStatusDesc ?>
		<td <?php echo $employment_status_delete->EmploymentStatusDesc->cellAttributes() ?>>
<span id="el<?php echo $employment_status_delete->RowCount ?>_employment_status_EmploymentStatusDesc" class="employment_status_EmploymentStatusDesc">
<span<?php echo $employment_status_delete->EmploymentStatusDesc->viewAttributes() ?>><?php echo $employment_status_delete->EmploymentStatusDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$employment_status_delete->Recordset->moveNext();
}
$employment_status_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employment_status_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$employment_status_delete->showPageFooter();
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
$employment_status_delete->terminate();
?>