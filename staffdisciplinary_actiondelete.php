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
$staffdisciplinary_action_delete = new staffdisciplinary_action_delete();

// Run the page
$staffdisciplinary_action_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffdisciplinary_action_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffdisciplinary_actiondelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fstaffdisciplinary_actiondelete = currentForm = new ew.Form("fstaffdisciplinary_actiondelete", "delete");
	loadjs.done("fstaffdisciplinary_actiondelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffdisciplinary_action_delete->showPageHeader(); ?>
<?php
$staffdisciplinary_action_delete->showMessage();
?>
<form name="fstaffdisciplinary_actiondelete" id="fstaffdisciplinary_actiondelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffdisciplinary_action">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($staffdisciplinary_action_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($staffdisciplinary_action_delete->CaseNo->Visible) { // CaseNo ?>
		<th class="<?php echo $staffdisciplinary_action_delete->CaseNo->headerCellClass() ?>"><span id="elh_staffdisciplinary_action_CaseNo" class="staffdisciplinary_action_CaseNo"><?php echo $staffdisciplinary_action_delete->CaseNo->caption() ?></span></th>
<?php } ?>
<?php if ($staffdisciplinary_action_delete->OffenseCode->Visible) { // OffenseCode ?>
		<th class="<?php echo $staffdisciplinary_action_delete->OffenseCode->headerCellClass() ?>"><span id="elh_staffdisciplinary_action_OffenseCode" class="staffdisciplinary_action_OffenseCode"><?php echo $staffdisciplinary_action_delete->OffenseCode->caption() ?></span></th>
<?php } ?>
<?php if ($staffdisciplinary_action_delete->ActionTaken->Visible) { // ActionTaken ?>
		<th class="<?php echo $staffdisciplinary_action_delete->ActionTaken->headerCellClass() ?>"><span id="elh_staffdisciplinary_action_ActionTaken" class="staffdisciplinary_action_ActionTaken"><?php echo $staffdisciplinary_action_delete->ActionTaken->caption() ?></span></th>
<?php } ?>
<?php if ($staffdisciplinary_action_delete->ActionDate->Visible) { // ActionDate ?>
		<th class="<?php echo $staffdisciplinary_action_delete->ActionDate->headerCellClass() ?>"><span id="elh_staffdisciplinary_action_ActionDate" class="staffdisciplinary_action_ActionDate"><?php echo $staffdisciplinary_action_delete->ActionDate->caption() ?></span></th>
<?php } ?>
<?php if ($staffdisciplinary_action_delete->FromDate->Visible) { // FromDate ?>
		<th class="<?php echo $staffdisciplinary_action_delete->FromDate->headerCellClass() ?>"><span id="elh_staffdisciplinary_action_FromDate" class="staffdisciplinary_action_FromDate"><?php echo $staffdisciplinary_action_delete->FromDate->caption() ?></span></th>
<?php } ?>
<?php if ($staffdisciplinary_action_delete->ToDate->Visible) { // ToDate ?>
		<th class="<?php echo $staffdisciplinary_action_delete->ToDate->headerCellClass() ?>"><span id="elh_staffdisciplinary_action_ToDate" class="staffdisciplinary_action_ToDate"><?php echo $staffdisciplinary_action_delete->ToDate->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$staffdisciplinary_action_delete->RecordCount = 0;
$i = 0;
while (!$staffdisciplinary_action_delete->Recordset->EOF) {
	$staffdisciplinary_action_delete->RecordCount++;
	$staffdisciplinary_action_delete->RowCount++;

	// Set row properties
	$staffdisciplinary_action->resetAttributes();
	$staffdisciplinary_action->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$staffdisciplinary_action_delete->loadRowValues($staffdisciplinary_action_delete->Recordset);

	// Render row
	$staffdisciplinary_action_delete->renderRow();
?>
	<tr <?php echo $staffdisciplinary_action->rowAttributes() ?>>
<?php if ($staffdisciplinary_action_delete->CaseNo->Visible) { // CaseNo ?>
		<td <?php echo $staffdisciplinary_action_delete->CaseNo->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_action_delete->RowCount ?>_staffdisciplinary_action_CaseNo" class="staffdisciplinary_action_CaseNo">
<span<?php echo $staffdisciplinary_action_delete->CaseNo->viewAttributes() ?>><?php echo $staffdisciplinary_action_delete->CaseNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_action_delete->OffenseCode->Visible) { // OffenseCode ?>
		<td <?php echo $staffdisciplinary_action_delete->OffenseCode->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_action_delete->RowCount ?>_staffdisciplinary_action_OffenseCode" class="staffdisciplinary_action_OffenseCode">
<span<?php echo $staffdisciplinary_action_delete->OffenseCode->viewAttributes() ?>><?php echo $staffdisciplinary_action_delete->OffenseCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_action_delete->ActionTaken->Visible) { // ActionTaken ?>
		<td <?php echo $staffdisciplinary_action_delete->ActionTaken->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_action_delete->RowCount ?>_staffdisciplinary_action_ActionTaken" class="staffdisciplinary_action_ActionTaken">
<span<?php echo $staffdisciplinary_action_delete->ActionTaken->viewAttributes() ?>><?php echo $staffdisciplinary_action_delete->ActionTaken->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_action_delete->ActionDate->Visible) { // ActionDate ?>
		<td <?php echo $staffdisciplinary_action_delete->ActionDate->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_action_delete->RowCount ?>_staffdisciplinary_action_ActionDate" class="staffdisciplinary_action_ActionDate">
<span<?php echo $staffdisciplinary_action_delete->ActionDate->viewAttributes() ?>><?php echo $staffdisciplinary_action_delete->ActionDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_action_delete->FromDate->Visible) { // FromDate ?>
		<td <?php echo $staffdisciplinary_action_delete->FromDate->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_action_delete->RowCount ?>_staffdisciplinary_action_FromDate" class="staffdisciplinary_action_FromDate">
<span<?php echo $staffdisciplinary_action_delete->FromDate->viewAttributes() ?>><?php echo $staffdisciplinary_action_delete->FromDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_action_delete->ToDate->Visible) { // ToDate ?>
		<td <?php echo $staffdisciplinary_action_delete->ToDate->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_action_delete->RowCount ?>_staffdisciplinary_action_ToDate" class="staffdisciplinary_action_ToDate">
<span<?php echo $staffdisciplinary_action_delete->ToDate->viewAttributes() ?>><?php echo $staffdisciplinary_action_delete->ToDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$staffdisciplinary_action_delete->Recordset->moveNext();
}
$staffdisciplinary_action_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staffdisciplinary_action_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$staffdisciplinary_action_delete->showPageFooter();
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
$staffdisciplinary_action_delete->terminate();
?>