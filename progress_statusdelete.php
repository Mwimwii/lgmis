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
$progress_status_delete = new progress_status_delete();

// Run the page
$progress_status_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$progress_status_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fprogress_statusdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fprogress_statusdelete = currentForm = new ew.Form("fprogress_statusdelete", "delete");
	loadjs.done("fprogress_statusdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $progress_status_delete->showPageHeader(); ?>
<?php
$progress_status_delete->showMessage();
?>
<form name="fprogress_statusdelete" id="fprogress_statusdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="progress_status">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($progress_status_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($progress_status_delete->ProgressCode->Visible) { // ProgressCode ?>
		<th class="<?php echo $progress_status_delete->ProgressCode->headerCellClass() ?>"><span id="elh_progress_status_ProgressCode" class="progress_status_ProgressCode"><?php echo $progress_status_delete->ProgressCode->caption() ?></span></th>
<?php } ?>
<?php if ($progress_status_delete->ProgressDescription->Visible) { // ProgressDescription ?>
		<th class="<?php echo $progress_status_delete->ProgressDescription->headerCellClass() ?>"><span id="elh_progress_status_ProgressDescription" class="progress_status_ProgressDescription"><?php echo $progress_status_delete->ProgressDescription->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$progress_status_delete->RecordCount = 0;
$i = 0;
while (!$progress_status_delete->Recordset->EOF) {
	$progress_status_delete->RecordCount++;
	$progress_status_delete->RowCount++;

	// Set row properties
	$progress_status->resetAttributes();
	$progress_status->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$progress_status_delete->loadRowValues($progress_status_delete->Recordset);

	// Render row
	$progress_status_delete->renderRow();
?>
	<tr <?php echo $progress_status->rowAttributes() ?>>
<?php if ($progress_status_delete->ProgressCode->Visible) { // ProgressCode ?>
		<td <?php echo $progress_status_delete->ProgressCode->cellAttributes() ?>>
<span id="el<?php echo $progress_status_delete->RowCount ?>_progress_status_ProgressCode" class="progress_status_ProgressCode">
<span<?php echo $progress_status_delete->ProgressCode->viewAttributes() ?>><?php echo $progress_status_delete->ProgressCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($progress_status_delete->ProgressDescription->Visible) { // ProgressDescription ?>
		<td <?php echo $progress_status_delete->ProgressDescription->cellAttributes() ?>>
<span id="el<?php echo $progress_status_delete->RowCount ?>_progress_status_ProgressDescription" class="progress_status_ProgressDescription">
<span<?php echo $progress_status_delete->ProgressDescription->viewAttributes() ?>><?php echo $progress_status_delete->ProgressDescription->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$progress_status_delete->Recordset->moveNext();
}
$progress_status_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $progress_status_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$progress_status_delete->showPageFooter();
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
$progress_status_delete->terminate();
?>