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
$result_area_delete = new result_area_delete();

// Run the page
$result_area_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$result_area_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fresult_areadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fresult_areadelete = currentForm = new ew.Form("fresult_areadelete", "delete");
	loadjs.done("fresult_areadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $result_area_delete->showPageHeader(); ?>
<?php
$result_area_delete->showMessage();
?>
<form name="fresult_areadelete" id="fresult_areadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="result_area">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($result_area_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($result_area_delete->ResultAreaCode->Visible) { // ResultAreaCode ?>
		<th class="<?php echo $result_area_delete->ResultAreaCode->headerCellClass() ?>"><span id="elh_result_area_ResultAreaCode" class="result_area_ResultAreaCode"><?php echo $result_area_delete->ResultAreaCode->caption() ?></span></th>
<?php } ?>
<?php if ($result_area_delete->ResultAreaName->Visible) { // ResultAreaName ?>
		<th class="<?php echo $result_area_delete->ResultAreaName->headerCellClass() ?>"><span id="elh_result_area_ResultAreaName" class="result_area_ResultAreaName"><?php echo $result_area_delete->ResultAreaName->caption() ?></span></th>
<?php } ?>
<?php if ($result_area_delete->ResultAreaStatus->Visible) { // ResultAreaStatus ?>
		<th class="<?php echo $result_area_delete->ResultAreaStatus->headerCellClass() ?>"><span id="elh_result_area_ResultAreaStatus" class="result_area_ResultAreaStatus"><?php echo $result_area_delete->ResultAreaStatus->caption() ?></span></th>
<?php } ?>
<?php if ($result_area_delete->ProgressStatus->Visible) { // ProgressStatus ?>
		<th class="<?php echo $result_area_delete->ProgressStatus->headerCellClass() ?>"><span id="elh_result_area_ProgressStatus" class="result_area_ProgressStatus"><?php echo $result_area_delete->ProgressStatus->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$result_area_delete->RecordCount = 0;
$i = 0;
while (!$result_area_delete->Recordset->EOF) {
	$result_area_delete->RecordCount++;
	$result_area_delete->RowCount++;

	// Set row properties
	$result_area->resetAttributes();
	$result_area->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$result_area_delete->loadRowValues($result_area_delete->Recordset);

	// Render row
	$result_area_delete->renderRow();
?>
	<tr <?php echo $result_area->rowAttributes() ?>>
<?php if ($result_area_delete->ResultAreaCode->Visible) { // ResultAreaCode ?>
		<td <?php echo $result_area_delete->ResultAreaCode->cellAttributes() ?>>
<span id="el<?php echo $result_area_delete->RowCount ?>_result_area_ResultAreaCode" class="result_area_ResultAreaCode">
<span<?php echo $result_area_delete->ResultAreaCode->viewAttributes() ?>><?php echo $result_area_delete->ResultAreaCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($result_area_delete->ResultAreaName->Visible) { // ResultAreaName ?>
		<td <?php echo $result_area_delete->ResultAreaName->cellAttributes() ?>>
<span id="el<?php echo $result_area_delete->RowCount ?>_result_area_ResultAreaName" class="result_area_ResultAreaName">
<span<?php echo $result_area_delete->ResultAreaName->viewAttributes() ?>><?php echo $result_area_delete->ResultAreaName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($result_area_delete->ResultAreaStatus->Visible) { // ResultAreaStatus ?>
		<td <?php echo $result_area_delete->ResultAreaStatus->cellAttributes() ?>>
<span id="el<?php echo $result_area_delete->RowCount ?>_result_area_ResultAreaStatus" class="result_area_ResultAreaStatus">
<span<?php echo $result_area_delete->ResultAreaStatus->viewAttributes() ?>><?php echo $result_area_delete->ResultAreaStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($result_area_delete->ProgressStatus->Visible) { // ProgressStatus ?>
		<td <?php echo $result_area_delete->ProgressStatus->cellAttributes() ?>>
<span id="el<?php echo $result_area_delete->RowCount ?>_result_area_ProgressStatus" class="result_area_ProgressStatus">
<span<?php echo $result_area_delete->ProgressStatus->viewAttributes() ?>><?php echo $result_area_delete->ProgressStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$result_area_delete->Recordset->moveNext();
}
$result_area_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $result_area_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$result_area_delete->showPageFooter();
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
$result_area_delete->terminate();
?>