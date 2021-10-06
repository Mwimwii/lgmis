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
$job_group_delete = new job_group_delete();

// Run the page
$job_group_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$job_group_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fjob_groupdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fjob_groupdelete = currentForm = new ew.Form("fjob_groupdelete", "delete");
	loadjs.done("fjob_groupdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $job_group_delete->showPageHeader(); ?>
<?php
$job_group_delete->showMessage();
?>
<form name="fjob_groupdelete" id="fjob_groupdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="job_group">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($job_group_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($job_group_delete->JobGroupCode->Visible) { // JobGroupCode ?>
		<th class="<?php echo $job_group_delete->JobGroupCode->headerCellClass() ?>"><span id="elh_job_group_JobGroupCode" class="job_group_JobGroupCode"><?php echo $job_group_delete->JobGroupCode->caption() ?></span></th>
<?php } ?>
<?php if ($job_group_delete->JobGroupName->Visible) { // JobGroupName ?>
		<th class="<?php echo $job_group_delete->JobGroupName->headerCellClass() ?>"><span id="elh_job_group_JobGroupName" class="job_group_JobGroupName"><?php echo $job_group_delete->JobGroupName->caption() ?></span></th>
<?php } ?>
<?php if ($job_group_delete->JobGroupDesc->Visible) { // JobGroupDesc ?>
		<th class="<?php echo $job_group_delete->JobGroupDesc->headerCellClass() ?>"><span id="elh_job_group_JobGroupDesc" class="job_group_JobGroupDesc"><?php echo $job_group_delete->JobGroupDesc->caption() ?></span></th>
<?php } ?>
<?php if ($job_group_delete->LastUserID->Visible) { // LastUserID ?>
		<th class="<?php echo $job_group_delete->LastUserID->headerCellClass() ?>"><span id="elh_job_group_LastUserID" class="job_group_LastUserID"><?php echo $job_group_delete->LastUserID->caption() ?></span></th>
<?php } ?>
<?php if ($job_group_delete->LastUpdated->Visible) { // LastUpdated ?>
		<th class="<?php echo $job_group_delete->LastUpdated->headerCellClass() ?>"><span id="elh_job_group_LastUpdated" class="job_group_LastUpdated"><?php echo $job_group_delete->LastUpdated->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$job_group_delete->RecordCount = 0;
$i = 0;
while (!$job_group_delete->Recordset->EOF) {
	$job_group_delete->RecordCount++;
	$job_group_delete->RowCount++;

	// Set row properties
	$job_group->resetAttributes();
	$job_group->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$job_group_delete->loadRowValues($job_group_delete->Recordset);

	// Render row
	$job_group_delete->renderRow();
?>
	<tr <?php echo $job_group->rowAttributes() ?>>
<?php if ($job_group_delete->JobGroupCode->Visible) { // JobGroupCode ?>
		<td <?php echo $job_group_delete->JobGroupCode->cellAttributes() ?>>
<span id="el<?php echo $job_group_delete->RowCount ?>_job_group_JobGroupCode" class="job_group_JobGroupCode">
<span<?php echo $job_group_delete->JobGroupCode->viewAttributes() ?>><?php echo $job_group_delete->JobGroupCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($job_group_delete->JobGroupName->Visible) { // JobGroupName ?>
		<td <?php echo $job_group_delete->JobGroupName->cellAttributes() ?>>
<span id="el<?php echo $job_group_delete->RowCount ?>_job_group_JobGroupName" class="job_group_JobGroupName">
<span<?php echo $job_group_delete->JobGroupName->viewAttributes() ?>><?php echo $job_group_delete->JobGroupName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($job_group_delete->JobGroupDesc->Visible) { // JobGroupDesc ?>
		<td <?php echo $job_group_delete->JobGroupDesc->cellAttributes() ?>>
<span id="el<?php echo $job_group_delete->RowCount ?>_job_group_JobGroupDesc" class="job_group_JobGroupDesc">
<span<?php echo $job_group_delete->JobGroupDesc->viewAttributes() ?>><?php echo $job_group_delete->JobGroupDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($job_group_delete->LastUserID->Visible) { // LastUserID ?>
		<td <?php echo $job_group_delete->LastUserID->cellAttributes() ?>>
<span id="el<?php echo $job_group_delete->RowCount ?>_job_group_LastUserID" class="job_group_LastUserID">
<span<?php echo $job_group_delete->LastUserID->viewAttributes() ?>><?php echo $job_group_delete->LastUserID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($job_group_delete->LastUpdated->Visible) { // LastUpdated ?>
		<td <?php echo $job_group_delete->LastUpdated->cellAttributes() ?>>
<span id="el<?php echo $job_group_delete->RowCount ?>_job_group_LastUpdated" class="job_group_LastUpdated">
<span<?php echo $job_group_delete->LastUpdated->viewAttributes() ?>><?php echo $job_group_delete->LastUpdated->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$job_group_delete->Recordset->moveNext();
}
$job_group_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $job_group_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$job_group_delete->showPageFooter();
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
$job_group_delete->terminate();
?>