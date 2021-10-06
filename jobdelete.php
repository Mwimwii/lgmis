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
$job_delete = new job_delete();

// Run the page
$job_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$job_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fjobdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fjobdelete = currentForm = new ew.Form("fjobdelete", "delete");
	loadjs.done("fjobdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $job_delete->showPageHeader(); ?>
<?php
$job_delete->showMessage();
?>
<form name="fjobdelete" id="fjobdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="job">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($job_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($job_delete->JobCode->Visible) { // JobCode ?>
		<th class="<?php echo $job_delete->JobCode->headerCellClass() ?>"><span id="elh_job_JobCode" class="job_JobCode"><?php echo $job_delete->JobCode->caption() ?></span></th>
<?php } ?>
<?php if ($job_delete->JobName->Visible) { // JobName ?>
		<th class="<?php echo $job_delete->JobName->headerCellClass() ?>"><span id="elh_job_JobName" class="job_JobName"><?php echo $job_delete->JobName->caption() ?></span></th>
<?php } ?>
<?php if ($job_delete->JobGroupCode->Visible) { // JobGroupCode ?>
		<th class="<?php echo $job_delete->JobGroupCode->headerCellClass() ?>"><span id="elh_job_JobGroupCode" class="job_JobGroupCode"><?php echo $job_delete->JobGroupCode->caption() ?></span></th>
<?php } ?>
<?php if ($job_delete->Division->Visible) { // Division ?>
		<th class="<?php echo $job_delete->Division->headerCellClass() ?>"><span id="elh_job_Division" class="job_Division"><?php echo $job_delete->Division->caption() ?></span></th>
<?php } ?>
<?php if ($job_delete->CouncilType->Visible) { // CouncilType ?>
		<th class="<?php echo $job_delete->CouncilType->headerCellClass() ?>"><span id="elh_job_CouncilType" class="job_CouncilType"><?php echo $job_delete->CouncilType->caption() ?></span></th>
<?php } ?>
<?php if ($job_delete->SalaryScale->Visible) { // SalaryScale ?>
		<th class="<?php echo $job_delete->SalaryScale->headerCellClass() ?>"><span id="elh_job_SalaryScale" class="job_SalaryScale"><?php echo $job_delete->SalaryScale->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$job_delete->RecordCount = 0;
$i = 0;
while (!$job_delete->Recordset->EOF) {
	$job_delete->RecordCount++;
	$job_delete->RowCount++;

	// Set row properties
	$job->resetAttributes();
	$job->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$job_delete->loadRowValues($job_delete->Recordset);

	// Render row
	$job_delete->renderRow();
?>
	<tr <?php echo $job->rowAttributes() ?>>
<?php if ($job_delete->JobCode->Visible) { // JobCode ?>
		<td <?php echo $job_delete->JobCode->cellAttributes() ?>>
<span id="el<?php echo $job_delete->RowCount ?>_job_JobCode" class="job_JobCode">
<span<?php echo $job_delete->JobCode->viewAttributes() ?>><?php echo $job_delete->JobCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($job_delete->JobName->Visible) { // JobName ?>
		<td <?php echo $job_delete->JobName->cellAttributes() ?>>
<span id="el<?php echo $job_delete->RowCount ?>_job_JobName" class="job_JobName">
<span<?php echo $job_delete->JobName->viewAttributes() ?>><?php echo $job_delete->JobName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($job_delete->JobGroupCode->Visible) { // JobGroupCode ?>
		<td <?php echo $job_delete->JobGroupCode->cellAttributes() ?>>
<span id="el<?php echo $job_delete->RowCount ?>_job_JobGroupCode" class="job_JobGroupCode">
<span<?php echo $job_delete->JobGroupCode->viewAttributes() ?>><?php echo $job_delete->JobGroupCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($job_delete->Division->Visible) { // Division ?>
		<td <?php echo $job_delete->Division->cellAttributes() ?>>
<span id="el<?php echo $job_delete->RowCount ?>_job_Division" class="job_Division">
<span<?php echo $job_delete->Division->viewAttributes() ?>><?php echo $job_delete->Division->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($job_delete->CouncilType->Visible) { // CouncilType ?>
		<td <?php echo $job_delete->CouncilType->cellAttributes() ?>>
<span id="el<?php echo $job_delete->RowCount ?>_job_CouncilType" class="job_CouncilType">
<span<?php echo $job_delete->CouncilType->viewAttributes() ?>><?php echo $job_delete->CouncilType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($job_delete->SalaryScale->Visible) { // SalaryScale ?>
		<td <?php echo $job_delete->SalaryScale->cellAttributes() ?>>
<span id="el<?php echo $job_delete->RowCount ?>_job_SalaryScale" class="job_SalaryScale">
<span<?php echo $job_delete->SalaryScale->viewAttributes() ?>><?php echo $job_delete->SalaryScale->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$job_delete->Recordset->moveNext();
}
$job_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $job_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$job_delete->showPageFooter();
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
$job_delete->terminate();
?>