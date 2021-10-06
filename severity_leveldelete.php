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
$severity_level_delete = new severity_level_delete();

// Run the page
$severity_level_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$severity_level_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fseverity_leveldelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fseverity_leveldelete = currentForm = new ew.Form("fseverity_leveldelete", "delete");
	loadjs.done("fseverity_leveldelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $severity_level_delete->showPageHeader(); ?>
<?php
$severity_level_delete->showMessage();
?>
<form name="fseverity_leveldelete" id="fseverity_leveldelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="severity_level">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($severity_level_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($severity_level_delete->SeverityLevelCode->Visible) { // SeverityLevelCode ?>
		<th class="<?php echo $severity_level_delete->SeverityLevelCode->headerCellClass() ?>"><span id="elh_severity_level_SeverityLevelCode" class="severity_level_SeverityLevelCode"><?php echo $severity_level_delete->SeverityLevelCode->caption() ?></span></th>
<?php } ?>
<?php if ($severity_level_delete->SeverityLevel->Visible) { // SeverityLevel ?>
		<th class="<?php echo $severity_level_delete->SeverityLevel->headerCellClass() ?>"><span id="elh_severity_level_SeverityLevel" class="severity_level_SeverityLevel"><?php echo $severity_level_delete->SeverityLevel->caption() ?></span></th>
<?php } ?>
<?php if ($severity_level_delete->SeverityDescription->Visible) { // SeverityDescription ?>
		<th class="<?php echo $severity_level_delete->SeverityDescription->headerCellClass() ?>"><span id="elh_severity_level_SeverityDescription" class="severity_level_SeverityDescription"><?php echo $severity_level_delete->SeverityDescription->caption() ?></span></th>
<?php } ?>
<?php if ($severity_level_delete->ResponseTime->Visible) { // ResponseTime ?>
		<th class="<?php echo $severity_level_delete->ResponseTime->headerCellClass() ?>"><span id="elh_severity_level_ResponseTime" class="severity_level_ResponseTime"><?php echo $severity_level_delete->ResponseTime->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$severity_level_delete->RecordCount = 0;
$i = 0;
while (!$severity_level_delete->Recordset->EOF) {
	$severity_level_delete->RecordCount++;
	$severity_level_delete->RowCount++;

	// Set row properties
	$severity_level->resetAttributes();
	$severity_level->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$severity_level_delete->loadRowValues($severity_level_delete->Recordset);

	// Render row
	$severity_level_delete->renderRow();
?>
	<tr <?php echo $severity_level->rowAttributes() ?>>
<?php if ($severity_level_delete->SeverityLevelCode->Visible) { // SeverityLevelCode ?>
		<td <?php echo $severity_level_delete->SeverityLevelCode->cellAttributes() ?>>
<span id="el<?php echo $severity_level_delete->RowCount ?>_severity_level_SeverityLevelCode" class="severity_level_SeverityLevelCode">
<span<?php echo $severity_level_delete->SeverityLevelCode->viewAttributes() ?>><?php echo $severity_level_delete->SeverityLevelCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($severity_level_delete->SeverityLevel->Visible) { // SeverityLevel ?>
		<td <?php echo $severity_level_delete->SeverityLevel->cellAttributes() ?>>
<span id="el<?php echo $severity_level_delete->RowCount ?>_severity_level_SeverityLevel" class="severity_level_SeverityLevel">
<span<?php echo $severity_level_delete->SeverityLevel->viewAttributes() ?>><?php echo $severity_level_delete->SeverityLevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($severity_level_delete->SeverityDescription->Visible) { // SeverityDescription ?>
		<td <?php echo $severity_level_delete->SeverityDescription->cellAttributes() ?>>
<span id="el<?php echo $severity_level_delete->RowCount ?>_severity_level_SeverityDescription" class="severity_level_SeverityDescription">
<span<?php echo $severity_level_delete->SeverityDescription->viewAttributes() ?>><?php echo $severity_level_delete->SeverityDescription->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($severity_level_delete->ResponseTime->Visible) { // ResponseTime ?>
		<td <?php echo $severity_level_delete->ResponseTime->cellAttributes() ?>>
<span id="el<?php echo $severity_level_delete->RowCount ?>_severity_level_ResponseTime" class="severity_level_ResponseTime">
<span<?php echo $severity_level_delete->ResponseTime->viewAttributes() ?>><?php echo $severity_level_delete->ResponseTime->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$severity_level_delete->Recordset->moveNext();
}
$severity_level_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $severity_level_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$severity_level_delete->showPageFooter();
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
$severity_level_delete->terminate();
?>