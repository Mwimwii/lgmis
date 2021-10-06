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
$appraisal_status_delete = new appraisal_status_delete();

// Run the page
$appraisal_status_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$appraisal_status_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fappraisal_statusdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fappraisal_statusdelete = currentForm = new ew.Form("fappraisal_statusdelete", "delete");
	loadjs.done("fappraisal_statusdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $appraisal_status_delete->showPageHeader(); ?>
<?php
$appraisal_status_delete->showMessage();
?>
<form name="fappraisal_statusdelete" id="fappraisal_statusdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="appraisal_status">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($appraisal_status_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($appraisal_status_delete->AppraisalStatus->Visible) { // AppraisalStatus ?>
		<th class="<?php echo $appraisal_status_delete->AppraisalStatus->headerCellClass() ?>"><span id="elh_appraisal_status_AppraisalStatus" class="appraisal_status_AppraisalStatus"><?php echo $appraisal_status_delete->AppraisalStatus->caption() ?></span></th>
<?php } ?>
<?php if ($appraisal_status_delete->AppraisalStatusDesc->Visible) { // AppraisalStatusDesc ?>
		<th class="<?php echo $appraisal_status_delete->AppraisalStatusDesc->headerCellClass() ?>"><span id="elh_appraisal_status_AppraisalStatusDesc" class="appraisal_status_AppraisalStatusDesc"><?php echo $appraisal_status_delete->AppraisalStatusDesc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$appraisal_status_delete->RecordCount = 0;
$i = 0;
while (!$appraisal_status_delete->Recordset->EOF) {
	$appraisal_status_delete->RecordCount++;
	$appraisal_status_delete->RowCount++;

	// Set row properties
	$appraisal_status->resetAttributes();
	$appraisal_status->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$appraisal_status_delete->loadRowValues($appraisal_status_delete->Recordset);

	// Render row
	$appraisal_status_delete->renderRow();
?>
	<tr <?php echo $appraisal_status->rowAttributes() ?>>
<?php if ($appraisal_status_delete->AppraisalStatus->Visible) { // AppraisalStatus ?>
		<td <?php echo $appraisal_status_delete->AppraisalStatus->cellAttributes() ?>>
<span id="el<?php echo $appraisal_status_delete->RowCount ?>_appraisal_status_AppraisalStatus" class="appraisal_status_AppraisalStatus">
<span<?php echo $appraisal_status_delete->AppraisalStatus->viewAttributes() ?>><?php echo $appraisal_status_delete->AppraisalStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($appraisal_status_delete->AppraisalStatusDesc->Visible) { // AppraisalStatusDesc ?>
		<td <?php echo $appraisal_status_delete->AppraisalStatusDesc->cellAttributes() ?>>
<span id="el<?php echo $appraisal_status_delete->RowCount ?>_appraisal_status_AppraisalStatusDesc" class="appraisal_status_AppraisalStatusDesc">
<span<?php echo $appraisal_status_delete->AppraisalStatusDesc->viewAttributes() ?>><?php echo $appraisal_status_delete->AppraisalStatusDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$appraisal_status_delete->Recordset->moveNext();
}
$appraisal_status_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $appraisal_status_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$appraisal_status_delete->showPageFooter();
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
$appraisal_status_delete->terminate();
?>