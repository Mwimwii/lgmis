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
$project_type_delete = new project_type_delete();

// Run the page
$project_type_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$project_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproject_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fproject_typedelete = currentForm = new ew.Form("fproject_typedelete", "delete");
	loadjs.done("fproject_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $project_type_delete->showPageHeader(); ?>
<?php
$project_type_delete->showMessage();
?>
<form name="fproject_typedelete" id="fproject_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="project_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($project_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($project_type_delete->ProjectType->Visible) { // ProjectType ?>
		<th class="<?php echo $project_type_delete->ProjectType->headerCellClass() ?>"><span id="elh_project_type_ProjectType" class="project_type_ProjectType"><?php echo $project_type_delete->ProjectType->caption() ?></span></th>
<?php } ?>
<?php if ($project_type_delete->ProjectTypeDesc->Visible) { // ProjectTypeDesc ?>
		<th class="<?php echo $project_type_delete->ProjectTypeDesc->headerCellClass() ?>"><span id="elh_project_type_ProjectTypeDesc" class="project_type_ProjectTypeDesc"><?php echo $project_type_delete->ProjectTypeDesc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$project_type_delete->RecordCount = 0;
$i = 0;
while (!$project_type_delete->Recordset->EOF) {
	$project_type_delete->RecordCount++;
	$project_type_delete->RowCount++;

	// Set row properties
	$project_type->resetAttributes();
	$project_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$project_type_delete->loadRowValues($project_type_delete->Recordset);

	// Render row
	$project_type_delete->renderRow();
?>
	<tr <?php echo $project_type->rowAttributes() ?>>
<?php if ($project_type_delete->ProjectType->Visible) { // ProjectType ?>
		<td <?php echo $project_type_delete->ProjectType->cellAttributes() ?>>
<span id="el<?php echo $project_type_delete->RowCount ?>_project_type_ProjectType" class="project_type_ProjectType">
<span<?php echo $project_type_delete->ProjectType->viewAttributes() ?>><?php echo $project_type_delete->ProjectType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project_type_delete->ProjectTypeDesc->Visible) { // ProjectTypeDesc ?>
		<td <?php echo $project_type_delete->ProjectTypeDesc->cellAttributes() ?>>
<span id="el<?php echo $project_type_delete->RowCount ?>_project_type_ProjectTypeDesc" class="project_type_ProjectTypeDesc">
<span<?php echo $project_type_delete->ProjectTypeDesc->viewAttributes() ?>><?php echo $project_type_delete->ProjectTypeDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$project_type_delete->Recordset->moveNext();
}
$project_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $project_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$project_type_delete->showPageFooter();
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
$project_type_delete->terminate();
?>