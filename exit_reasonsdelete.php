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
$exit_reasons_delete = new exit_reasons_delete();

// Run the page
$exit_reasons_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$exit_reasons_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fexit_reasonsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fexit_reasonsdelete = currentForm = new ew.Form("fexit_reasonsdelete", "delete");
	loadjs.done("fexit_reasonsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $exit_reasons_delete->showPageHeader(); ?>
<?php
$exit_reasons_delete->showMessage();
?>
<form name="fexit_reasonsdelete" id="fexit_reasonsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="exit_reasons">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($exit_reasons_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($exit_reasons_delete->ExitCode->Visible) { // ExitCode ?>
		<th class="<?php echo $exit_reasons_delete->ExitCode->headerCellClass() ?>"><span id="elh_exit_reasons_ExitCode" class="exit_reasons_ExitCode"><?php echo $exit_reasons_delete->ExitCode->caption() ?></span></th>
<?php } ?>
<?php if ($exit_reasons_delete->ExitReason->Visible) { // ExitReason ?>
		<th class="<?php echo $exit_reasons_delete->ExitReason->headerCellClass() ?>"><span id="elh_exit_reasons_ExitReason" class="exit_reasons_ExitReason"><?php echo $exit_reasons_delete->ExitReason->caption() ?></span></th>
<?php } ?>
<?php if ($exit_reasons_delete->EmploymentStatus->Visible) { // EmploymentStatus ?>
		<th class="<?php echo $exit_reasons_delete->EmploymentStatus->headerCellClass() ?>"><span id="elh_exit_reasons_EmploymentStatus" class="exit_reasons_EmploymentStatus"><?php echo $exit_reasons_delete->EmploymentStatus->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$exit_reasons_delete->RecordCount = 0;
$i = 0;
while (!$exit_reasons_delete->Recordset->EOF) {
	$exit_reasons_delete->RecordCount++;
	$exit_reasons_delete->RowCount++;

	// Set row properties
	$exit_reasons->resetAttributes();
	$exit_reasons->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$exit_reasons_delete->loadRowValues($exit_reasons_delete->Recordset);

	// Render row
	$exit_reasons_delete->renderRow();
?>
	<tr <?php echo $exit_reasons->rowAttributes() ?>>
<?php if ($exit_reasons_delete->ExitCode->Visible) { // ExitCode ?>
		<td <?php echo $exit_reasons_delete->ExitCode->cellAttributes() ?>>
<span id="el<?php echo $exit_reasons_delete->RowCount ?>_exit_reasons_ExitCode" class="exit_reasons_ExitCode">
<span<?php echo $exit_reasons_delete->ExitCode->viewAttributes() ?>><?php echo $exit_reasons_delete->ExitCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($exit_reasons_delete->ExitReason->Visible) { // ExitReason ?>
		<td <?php echo $exit_reasons_delete->ExitReason->cellAttributes() ?>>
<span id="el<?php echo $exit_reasons_delete->RowCount ?>_exit_reasons_ExitReason" class="exit_reasons_ExitReason">
<span<?php echo $exit_reasons_delete->ExitReason->viewAttributes() ?>><?php echo $exit_reasons_delete->ExitReason->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($exit_reasons_delete->EmploymentStatus->Visible) { // EmploymentStatus ?>
		<td <?php echo $exit_reasons_delete->EmploymentStatus->cellAttributes() ?>>
<span id="el<?php echo $exit_reasons_delete->RowCount ?>_exit_reasons_EmploymentStatus" class="exit_reasons_EmploymentStatus">
<span<?php echo $exit_reasons_delete->EmploymentStatus->viewAttributes() ?>><?php echo $exit_reasons_delete->EmploymentStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$exit_reasons_delete->Recordset->moveNext();
}
$exit_reasons_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $exit_reasons_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$exit_reasons_delete->showPageFooter();
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
$exit_reasons_delete->terminate();
?>