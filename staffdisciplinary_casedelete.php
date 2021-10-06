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
$staffdisciplinary_case_delete = new staffdisciplinary_case_delete();

// Run the page
$staffdisciplinary_case_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffdisciplinary_case_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffdisciplinary_casedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fstaffdisciplinary_casedelete = currentForm = new ew.Form("fstaffdisciplinary_casedelete", "delete");
	loadjs.done("fstaffdisciplinary_casedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffdisciplinary_case_delete->showPageHeader(); ?>
<?php
$staffdisciplinary_case_delete->showMessage();
?>
<form name="fstaffdisciplinary_casedelete" id="fstaffdisciplinary_casedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffdisciplinary_case">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($staffdisciplinary_case_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($staffdisciplinary_case_delete->CaseNo->Visible) { // CaseNo ?>
		<th class="<?php echo $staffdisciplinary_case_delete->CaseNo->headerCellClass() ?>"><span id="elh_staffdisciplinary_case_CaseNo" class="staffdisciplinary_case_CaseNo"><?php echo $staffdisciplinary_case_delete->CaseNo->caption() ?></span></th>
<?php } ?>
<?php if ($staffdisciplinary_case_delete->OffenseCode->Visible) { // OffenseCode ?>
		<th class="<?php echo $staffdisciplinary_case_delete->OffenseCode->headerCellClass() ?>"><span id="elh_staffdisciplinary_case_OffenseCode" class="staffdisciplinary_case_OffenseCode"><?php echo $staffdisciplinary_case_delete->OffenseCode->caption() ?></span></th>
<?php } ?>
<?php if ($staffdisciplinary_case_delete->ActionTaken->Visible) { // ActionTaken ?>
		<th class="<?php echo $staffdisciplinary_case_delete->ActionTaken->headerCellClass() ?>"><span id="elh_staffdisciplinary_case_ActionTaken" class="staffdisciplinary_case_ActionTaken"><?php echo $staffdisciplinary_case_delete->ActionTaken->caption() ?></span></th>
<?php } ?>
<?php if ($staffdisciplinary_case_delete->OffenseDate->Visible) { // OffenseDate ?>
		<th class="<?php echo $staffdisciplinary_case_delete->OffenseDate->headerCellClass() ?>"><span id="elh_staffdisciplinary_case_OffenseDate" class="staffdisciplinary_case_OffenseDate"><?php echo $staffdisciplinary_case_delete->OffenseDate->caption() ?></span></th>
<?php } ?>
<?php if ($staffdisciplinary_case_delete->ActionDate->Visible) { // ActionDate ?>
		<th class="<?php echo $staffdisciplinary_case_delete->ActionDate->headerCellClass() ?>"><span id="elh_staffdisciplinary_case_ActionDate" class="staffdisciplinary_case_ActionDate"><?php echo $staffdisciplinary_case_delete->ActionDate->caption() ?></span></th>
<?php } ?>
<?php if ($staffdisciplinary_case_delete->DateOfAppealLetter->Visible) { // DateOfAppealLetter ?>
		<th class="<?php echo $staffdisciplinary_case_delete->DateOfAppealLetter->headerCellClass() ?>"><span id="elh_staffdisciplinary_case_DateOfAppealLetter" class="staffdisciplinary_case_DateOfAppealLetter"><?php echo $staffdisciplinary_case_delete->DateOfAppealLetter->caption() ?></span></th>
<?php } ?>
<?php if ($staffdisciplinary_case_delete->DateAppealReceived->Visible) { // DateAppealReceived ?>
		<th class="<?php echo $staffdisciplinary_case_delete->DateAppealReceived->headerCellClass() ?>"><span id="elh_staffdisciplinary_case_DateAppealReceived" class="staffdisciplinary_case_DateAppealReceived"><?php echo $staffdisciplinary_case_delete->DateAppealReceived->caption() ?></span></th>
<?php } ?>
<?php if ($staffdisciplinary_case_delete->DateConcluded->Visible) { // DateConcluded ?>
		<th class="<?php echo $staffdisciplinary_case_delete->DateConcluded->headerCellClass() ?>"><span id="elh_staffdisciplinary_case_DateConcluded" class="staffdisciplinary_case_DateConcluded"><?php echo $staffdisciplinary_case_delete->DateConcluded->caption() ?></span></th>
<?php } ?>
<?php if ($staffdisciplinary_case_delete->AppealStatus->Visible) { // AppealStatus ?>
		<th class="<?php echo $staffdisciplinary_case_delete->AppealStatus->headerCellClass() ?>"><span id="elh_staffdisciplinary_case_AppealStatus" class="staffdisciplinary_case_AppealStatus"><?php echo $staffdisciplinary_case_delete->AppealStatus->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$staffdisciplinary_case_delete->RecordCount = 0;
$i = 0;
while (!$staffdisciplinary_case_delete->Recordset->EOF) {
	$staffdisciplinary_case_delete->RecordCount++;
	$staffdisciplinary_case_delete->RowCount++;

	// Set row properties
	$staffdisciplinary_case->resetAttributes();
	$staffdisciplinary_case->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$staffdisciplinary_case_delete->loadRowValues($staffdisciplinary_case_delete->Recordset);

	// Render row
	$staffdisciplinary_case_delete->renderRow();
?>
	<tr <?php echo $staffdisciplinary_case->rowAttributes() ?>>
<?php if ($staffdisciplinary_case_delete->CaseNo->Visible) { // CaseNo ?>
		<td <?php echo $staffdisciplinary_case_delete->CaseNo->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_case_delete->RowCount ?>_staffdisciplinary_case_CaseNo" class="staffdisciplinary_case_CaseNo">
<span<?php echo $staffdisciplinary_case_delete->CaseNo->viewAttributes() ?>><?php echo $staffdisciplinary_case_delete->CaseNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_case_delete->OffenseCode->Visible) { // OffenseCode ?>
		<td <?php echo $staffdisciplinary_case_delete->OffenseCode->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_case_delete->RowCount ?>_staffdisciplinary_case_OffenseCode" class="staffdisciplinary_case_OffenseCode">
<span<?php echo $staffdisciplinary_case_delete->OffenseCode->viewAttributes() ?>><?php echo $staffdisciplinary_case_delete->OffenseCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_case_delete->ActionTaken->Visible) { // ActionTaken ?>
		<td <?php echo $staffdisciplinary_case_delete->ActionTaken->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_case_delete->RowCount ?>_staffdisciplinary_case_ActionTaken" class="staffdisciplinary_case_ActionTaken">
<span<?php echo $staffdisciplinary_case_delete->ActionTaken->viewAttributes() ?>><?php echo $staffdisciplinary_case_delete->ActionTaken->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_case_delete->OffenseDate->Visible) { // OffenseDate ?>
		<td <?php echo $staffdisciplinary_case_delete->OffenseDate->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_case_delete->RowCount ?>_staffdisciplinary_case_OffenseDate" class="staffdisciplinary_case_OffenseDate">
<span<?php echo $staffdisciplinary_case_delete->OffenseDate->viewAttributes() ?>><?php echo $staffdisciplinary_case_delete->OffenseDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_case_delete->ActionDate->Visible) { // ActionDate ?>
		<td <?php echo $staffdisciplinary_case_delete->ActionDate->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_case_delete->RowCount ?>_staffdisciplinary_case_ActionDate" class="staffdisciplinary_case_ActionDate">
<span<?php echo $staffdisciplinary_case_delete->ActionDate->viewAttributes() ?>><?php echo $staffdisciplinary_case_delete->ActionDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_case_delete->DateOfAppealLetter->Visible) { // DateOfAppealLetter ?>
		<td <?php echo $staffdisciplinary_case_delete->DateOfAppealLetter->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_case_delete->RowCount ?>_staffdisciplinary_case_DateOfAppealLetter" class="staffdisciplinary_case_DateOfAppealLetter">
<span<?php echo $staffdisciplinary_case_delete->DateOfAppealLetter->viewAttributes() ?>><?php echo $staffdisciplinary_case_delete->DateOfAppealLetter->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_case_delete->DateAppealReceived->Visible) { // DateAppealReceived ?>
		<td <?php echo $staffdisciplinary_case_delete->DateAppealReceived->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_case_delete->RowCount ?>_staffdisciplinary_case_DateAppealReceived" class="staffdisciplinary_case_DateAppealReceived">
<span<?php echo $staffdisciplinary_case_delete->DateAppealReceived->viewAttributes() ?>><?php echo $staffdisciplinary_case_delete->DateAppealReceived->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_case_delete->DateConcluded->Visible) { // DateConcluded ?>
		<td <?php echo $staffdisciplinary_case_delete->DateConcluded->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_case_delete->RowCount ?>_staffdisciplinary_case_DateConcluded" class="staffdisciplinary_case_DateConcluded">
<span<?php echo $staffdisciplinary_case_delete->DateConcluded->viewAttributes() ?>><?php echo $staffdisciplinary_case_delete->DateConcluded->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_case_delete->AppealStatus->Visible) { // AppealStatus ?>
		<td <?php echo $staffdisciplinary_case_delete->AppealStatus->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_case_delete->RowCount ?>_staffdisciplinary_case_AppealStatus" class="staffdisciplinary_case_AppealStatus">
<span<?php echo $staffdisciplinary_case_delete->AppealStatus->viewAttributes() ?>><?php echo $staffdisciplinary_case_delete->AppealStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$staffdisciplinary_case_delete->Recordset->moveNext();
}
$staffdisciplinary_case_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staffdisciplinary_case_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$staffdisciplinary_case_delete->showPageFooter();
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
$staffdisciplinary_case_delete->terminate();
?>