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
$month_ref_delete = new month_ref_delete();

// Run the page
$month_ref_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$month_ref_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmonth_refdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fmonth_refdelete = currentForm = new ew.Form("fmonth_refdelete", "delete");
	loadjs.done("fmonth_refdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $month_ref_delete->showPageHeader(); ?>
<?php
$month_ref_delete->showMessage();
?>
<form name="fmonth_refdelete" id="fmonth_refdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="month_ref">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($month_ref_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($month_ref_delete->MonthCode->Visible) { // MonthCode ?>
		<th class="<?php echo $month_ref_delete->MonthCode->headerCellClass() ?>"><span id="elh_month_ref_MonthCode" class="month_ref_MonthCode"><?php echo $month_ref_delete->MonthCode->caption() ?></span></th>
<?php } ?>
<?php if ($month_ref_delete->MonthName->Visible) { // MonthName ?>
		<th class="<?php echo $month_ref_delete->MonthName->headerCellClass() ?>"><span id="elh_month_ref_MonthName" class="month_ref_MonthName"><?php echo $month_ref_delete->MonthName->caption() ?></span></th>
<?php } ?>
<?php if ($month_ref_delete->MonthShort->Visible) { // MonthShort ?>
		<th class="<?php echo $month_ref_delete->MonthShort->headerCellClass() ?>"><span id="elh_month_ref_MonthShort" class="month_ref_MonthShort"><?php echo $month_ref_delete->MonthShort->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$month_ref_delete->RecordCount = 0;
$i = 0;
while (!$month_ref_delete->Recordset->EOF) {
	$month_ref_delete->RecordCount++;
	$month_ref_delete->RowCount++;

	// Set row properties
	$month_ref->resetAttributes();
	$month_ref->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$month_ref_delete->loadRowValues($month_ref_delete->Recordset);

	// Render row
	$month_ref_delete->renderRow();
?>
	<tr <?php echo $month_ref->rowAttributes() ?>>
<?php if ($month_ref_delete->MonthCode->Visible) { // MonthCode ?>
		<td <?php echo $month_ref_delete->MonthCode->cellAttributes() ?>>
<span id="el<?php echo $month_ref_delete->RowCount ?>_month_ref_MonthCode" class="month_ref_MonthCode">
<span<?php echo $month_ref_delete->MonthCode->viewAttributes() ?>><?php echo $month_ref_delete->MonthCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($month_ref_delete->MonthName->Visible) { // MonthName ?>
		<td <?php echo $month_ref_delete->MonthName->cellAttributes() ?>>
<span id="el<?php echo $month_ref_delete->RowCount ?>_month_ref_MonthName" class="month_ref_MonthName">
<span<?php echo $month_ref_delete->MonthName->viewAttributes() ?>><?php echo $month_ref_delete->MonthName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($month_ref_delete->MonthShort->Visible) { // MonthShort ?>
		<td <?php echo $month_ref_delete->MonthShort->cellAttributes() ?>>
<span id="el<?php echo $month_ref_delete->RowCount ?>_month_ref_MonthShort" class="month_ref_MonthShort">
<span<?php echo $month_ref_delete->MonthShort->viewAttributes() ?>><?php echo $month_ref_delete->MonthShort->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$month_ref_delete->Recordset->moveNext();
}
$month_ref_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $month_ref_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$month_ref_delete->showPageFooter();
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
$month_ref_delete->terminate();
?>