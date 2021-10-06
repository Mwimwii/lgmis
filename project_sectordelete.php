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
$project_sector_delete = new project_sector_delete();

// Run the page
$project_sector_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$project_sector_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproject_sectordelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fproject_sectordelete = currentForm = new ew.Form("fproject_sectordelete", "delete");
	loadjs.done("fproject_sectordelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $project_sector_delete->showPageHeader(); ?>
<?php
$project_sector_delete->showMessage();
?>
<form name="fproject_sectordelete" id="fproject_sectordelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="project_sector">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($project_sector_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($project_sector_delete->ProjectSector->Visible) { // ProjectSector ?>
		<th class="<?php echo $project_sector_delete->ProjectSector->headerCellClass() ?>"><span id="elh_project_sector_ProjectSector" class="project_sector_ProjectSector"><?php echo $project_sector_delete->ProjectSector->caption() ?></span></th>
<?php } ?>
<?php if ($project_sector_delete->ProjectSectorDesc->Visible) { // ProjectSectorDesc ?>
		<th class="<?php echo $project_sector_delete->ProjectSectorDesc->headerCellClass() ?>"><span id="elh_project_sector_ProjectSectorDesc" class="project_sector_ProjectSectorDesc"><?php echo $project_sector_delete->ProjectSectorDesc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$project_sector_delete->RecordCount = 0;
$i = 0;
while (!$project_sector_delete->Recordset->EOF) {
	$project_sector_delete->RecordCount++;
	$project_sector_delete->RowCount++;

	// Set row properties
	$project_sector->resetAttributes();
	$project_sector->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$project_sector_delete->loadRowValues($project_sector_delete->Recordset);

	// Render row
	$project_sector_delete->renderRow();
?>
	<tr <?php echo $project_sector->rowAttributes() ?>>
<?php if ($project_sector_delete->ProjectSector->Visible) { // ProjectSector ?>
		<td <?php echo $project_sector_delete->ProjectSector->cellAttributes() ?>>
<span id="el<?php echo $project_sector_delete->RowCount ?>_project_sector_ProjectSector" class="project_sector_ProjectSector">
<span<?php echo $project_sector_delete->ProjectSector->viewAttributes() ?>><?php echo $project_sector_delete->ProjectSector->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project_sector_delete->ProjectSectorDesc->Visible) { // ProjectSectorDesc ?>
		<td <?php echo $project_sector_delete->ProjectSectorDesc->cellAttributes() ?>>
<span id="el<?php echo $project_sector_delete->RowCount ?>_project_sector_ProjectSectorDesc" class="project_sector_ProjectSectorDesc">
<span<?php echo $project_sector_delete->ProjectSectorDesc->viewAttributes() ?>><?php echo $project_sector_delete->ProjectSectorDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$project_sector_delete->Recordset->moveNext();
}
$project_sector_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $project_sector_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$project_sector_delete->showPageFooter();
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
$project_sector_delete->terminate();
?>