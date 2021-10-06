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
$project_status_delete = new project_status_delete();

// Run the page
$project_status_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$project_status_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproject_statusdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fproject_statusdelete = currentForm = new ew.Form("fproject_statusdelete", "delete");
	loadjs.done("fproject_statusdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $project_status_delete->showPageHeader(); ?>
<?php
$project_status_delete->showMessage();
?>
<form name="fproject_statusdelete" id="fproject_statusdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="project_status">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($project_status_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($project_status_delete->ProjectStatusCode->Visible) { // ProjectStatusCode ?>
		<th class="<?php echo $project_status_delete->ProjectStatusCode->headerCellClass() ?>"><span id="elh_project_status_ProjectStatusCode" class="project_status_ProjectStatusCode"><?php echo $project_status_delete->ProjectStatusCode->caption() ?></span></th>
<?php } ?>
<?php if ($project_status_delete->ProjectStatusDesc->Visible) { // ProjectStatusDesc ?>
		<th class="<?php echo $project_status_delete->ProjectStatusDesc->headerCellClass() ?>"><span id="elh_project_status_ProjectStatusDesc" class="project_status_ProjectStatusDesc"><?php echo $project_status_delete->ProjectStatusDesc->caption() ?></span></th>
<?php } ?>
<?php if ($project_status_delete->LastUserID->Visible) { // LastUserID ?>
		<th class="<?php echo $project_status_delete->LastUserID->headerCellClass() ?>"><span id="elh_project_status_LastUserID" class="project_status_LastUserID"><?php echo $project_status_delete->LastUserID->caption() ?></span></th>
<?php } ?>
<?php if ($project_status_delete->LastUpdated->Visible) { // LastUpdated ?>
		<th class="<?php echo $project_status_delete->LastUpdated->headerCellClass() ?>"><span id="elh_project_status_LastUpdated" class="project_status_LastUpdated"><?php echo $project_status_delete->LastUpdated->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$project_status_delete->RecordCount = 0;
$i = 0;
while (!$project_status_delete->Recordset->EOF) {
	$project_status_delete->RecordCount++;
	$project_status_delete->RowCount++;

	// Set row properties
	$project_status->resetAttributes();
	$project_status->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$project_status_delete->loadRowValues($project_status_delete->Recordset);

	// Render row
	$project_status_delete->renderRow();
?>
	<tr <?php echo $project_status->rowAttributes() ?>>
<?php if ($project_status_delete->ProjectStatusCode->Visible) { // ProjectStatusCode ?>
		<td <?php echo $project_status_delete->ProjectStatusCode->cellAttributes() ?>>
<span id="el<?php echo $project_status_delete->RowCount ?>_project_status_ProjectStatusCode" class="project_status_ProjectStatusCode">
<span<?php echo $project_status_delete->ProjectStatusCode->viewAttributes() ?>><?php echo $project_status_delete->ProjectStatusCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project_status_delete->ProjectStatusDesc->Visible) { // ProjectStatusDesc ?>
		<td <?php echo $project_status_delete->ProjectStatusDesc->cellAttributes() ?>>
<span id="el<?php echo $project_status_delete->RowCount ?>_project_status_ProjectStatusDesc" class="project_status_ProjectStatusDesc">
<span<?php echo $project_status_delete->ProjectStatusDesc->viewAttributes() ?>><?php echo $project_status_delete->ProjectStatusDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project_status_delete->LastUserID->Visible) { // LastUserID ?>
		<td <?php echo $project_status_delete->LastUserID->cellAttributes() ?>>
<span id="el<?php echo $project_status_delete->RowCount ?>_project_status_LastUserID" class="project_status_LastUserID">
<span<?php echo $project_status_delete->LastUserID->viewAttributes() ?>><?php echo $project_status_delete->LastUserID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project_status_delete->LastUpdated->Visible) { // LastUpdated ?>
		<td <?php echo $project_status_delete->LastUpdated->cellAttributes() ?>>
<span id="el<?php echo $project_status_delete->RowCount ?>_project_status_LastUpdated" class="project_status_LastUpdated">
<span<?php echo $project_status_delete->LastUpdated->viewAttributes() ?>><?php echo $project_status_delete->LastUpdated->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$project_status_delete->Recordset->moveNext();
}
$project_status_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $project_status_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$project_status_delete->showPageFooter();
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
$project_status_delete->terminate();
?>