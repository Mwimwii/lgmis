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
$staffdisciplinary_appeal_delete = new staffdisciplinary_appeal_delete();

// Run the page
$staffdisciplinary_appeal_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffdisciplinary_appeal_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffdisciplinary_appealdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fstaffdisciplinary_appealdelete = currentForm = new ew.Form("fstaffdisciplinary_appealdelete", "delete");
	loadjs.done("fstaffdisciplinary_appealdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffdisciplinary_appeal_delete->showPageHeader(); ?>
<?php
$staffdisciplinary_appeal_delete->showMessage();
?>
<form name="fstaffdisciplinary_appealdelete" id="fstaffdisciplinary_appealdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffdisciplinary_appeal">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($staffdisciplinary_appeal_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($staffdisciplinary_appeal_delete->CaseNo->Visible) { // CaseNo ?>
		<th class="<?php echo $staffdisciplinary_appeal_delete->CaseNo->headerCellClass() ?>"><span id="elh_staffdisciplinary_appeal_CaseNo" class="staffdisciplinary_appeal_CaseNo"><?php echo $staffdisciplinary_appeal_delete->CaseNo->caption() ?></span></th>
<?php } ?>
<?php if ($staffdisciplinary_appeal_delete->OffenseCode->Visible) { // OffenseCode ?>
		<th class="<?php echo $staffdisciplinary_appeal_delete->OffenseCode->headerCellClass() ?>"><span id="elh_staffdisciplinary_appeal_OffenseCode" class="staffdisciplinary_appeal_OffenseCode"><?php echo $staffdisciplinary_appeal_delete->OffenseCode->caption() ?></span></th>
<?php } ?>
<?php if ($staffdisciplinary_appeal_delete->AppealNo->Visible) { // AppealNo ?>
		<th class="<?php echo $staffdisciplinary_appeal_delete->AppealNo->headerCellClass() ?>"><span id="elh_staffdisciplinary_appeal_AppealNo" class="staffdisciplinary_appeal_AppealNo"><?php echo $staffdisciplinary_appeal_delete->AppealNo->caption() ?></span></th>
<?php } ?>
<?php if ($staffdisciplinary_appeal_delete->DateOfAppealLetter->Visible) { // DateOfAppealLetter ?>
		<th class="<?php echo $staffdisciplinary_appeal_delete->DateOfAppealLetter->headerCellClass() ?>"><span id="elh_staffdisciplinary_appeal_DateOfAppealLetter" class="staffdisciplinary_appeal_DateOfAppealLetter"><?php echo $staffdisciplinary_appeal_delete->DateOfAppealLetter->caption() ?></span></th>
<?php } ?>
<?php if ($staffdisciplinary_appeal_delete->DateAppealReceived->Visible) { // DateAppealReceived ?>
		<th class="<?php echo $staffdisciplinary_appeal_delete->DateAppealReceived->headerCellClass() ?>"><span id="elh_staffdisciplinary_appeal_DateAppealReceived" class="staffdisciplinary_appeal_DateAppealReceived"><?php echo $staffdisciplinary_appeal_delete->DateAppealReceived->caption() ?></span></th>
<?php } ?>
<?php if ($staffdisciplinary_appeal_delete->DateConcluded->Visible) { // DateConcluded ?>
		<th class="<?php echo $staffdisciplinary_appeal_delete->DateConcluded->headerCellClass() ?>"><span id="elh_staffdisciplinary_appeal_DateConcluded" class="staffdisciplinary_appeal_DateConcluded"><?php echo $staffdisciplinary_appeal_delete->DateConcluded->caption() ?></span></th>
<?php } ?>
<?php if ($staffdisciplinary_appeal_delete->AppealStatus->Visible) { // AppealStatus ?>
		<th class="<?php echo $staffdisciplinary_appeal_delete->AppealStatus->headerCellClass() ?>"><span id="elh_staffdisciplinary_appeal_AppealStatus" class="staffdisciplinary_appeal_AppealStatus"><?php echo $staffdisciplinary_appeal_delete->AppealStatus->caption() ?></span></th>
<?php } ?>
<?php if ($staffdisciplinary_appeal_delete->LastUpdate->Visible) { // LastUpdate ?>
		<th class="<?php echo $staffdisciplinary_appeal_delete->LastUpdate->headerCellClass() ?>"><span id="elh_staffdisciplinary_appeal_LastUpdate" class="staffdisciplinary_appeal_LastUpdate"><?php echo $staffdisciplinary_appeal_delete->LastUpdate->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$staffdisciplinary_appeal_delete->RecordCount = 0;
$i = 0;
while (!$staffdisciplinary_appeal_delete->Recordset->EOF) {
	$staffdisciplinary_appeal_delete->RecordCount++;
	$staffdisciplinary_appeal_delete->RowCount++;

	// Set row properties
	$staffdisciplinary_appeal->resetAttributes();
	$staffdisciplinary_appeal->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$staffdisciplinary_appeal_delete->loadRowValues($staffdisciplinary_appeal_delete->Recordset);

	// Render row
	$staffdisciplinary_appeal_delete->renderRow();
?>
	<tr <?php echo $staffdisciplinary_appeal->rowAttributes() ?>>
<?php if ($staffdisciplinary_appeal_delete->CaseNo->Visible) { // CaseNo ?>
		<td <?php echo $staffdisciplinary_appeal_delete->CaseNo->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_appeal_delete->RowCount ?>_staffdisciplinary_appeal_CaseNo" class="staffdisciplinary_appeal_CaseNo">
<span<?php echo $staffdisciplinary_appeal_delete->CaseNo->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_delete->CaseNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_appeal_delete->OffenseCode->Visible) { // OffenseCode ?>
		<td <?php echo $staffdisciplinary_appeal_delete->OffenseCode->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_appeal_delete->RowCount ?>_staffdisciplinary_appeal_OffenseCode" class="staffdisciplinary_appeal_OffenseCode">
<span<?php echo $staffdisciplinary_appeal_delete->OffenseCode->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_delete->OffenseCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_appeal_delete->AppealNo->Visible) { // AppealNo ?>
		<td <?php echo $staffdisciplinary_appeal_delete->AppealNo->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_appeal_delete->RowCount ?>_staffdisciplinary_appeal_AppealNo" class="staffdisciplinary_appeal_AppealNo">
<span<?php echo $staffdisciplinary_appeal_delete->AppealNo->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_delete->AppealNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_appeal_delete->DateOfAppealLetter->Visible) { // DateOfAppealLetter ?>
		<td <?php echo $staffdisciplinary_appeal_delete->DateOfAppealLetter->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_appeal_delete->RowCount ?>_staffdisciplinary_appeal_DateOfAppealLetter" class="staffdisciplinary_appeal_DateOfAppealLetter">
<span<?php echo $staffdisciplinary_appeal_delete->DateOfAppealLetter->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_delete->DateOfAppealLetter->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_appeal_delete->DateAppealReceived->Visible) { // DateAppealReceived ?>
		<td <?php echo $staffdisciplinary_appeal_delete->DateAppealReceived->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_appeal_delete->RowCount ?>_staffdisciplinary_appeal_DateAppealReceived" class="staffdisciplinary_appeal_DateAppealReceived">
<span<?php echo $staffdisciplinary_appeal_delete->DateAppealReceived->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_delete->DateAppealReceived->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_appeal_delete->DateConcluded->Visible) { // DateConcluded ?>
		<td <?php echo $staffdisciplinary_appeal_delete->DateConcluded->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_appeal_delete->RowCount ?>_staffdisciplinary_appeal_DateConcluded" class="staffdisciplinary_appeal_DateConcluded">
<span<?php echo $staffdisciplinary_appeal_delete->DateConcluded->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_delete->DateConcluded->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_appeal_delete->AppealStatus->Visible) { // AppealStatus ?>
		<td <?php echo $staffdisciplinary_appeal_delete->AppealStatus->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_appeal_delete->RowCount ?>_staffdisciplinary_appeal_AppealStatus" class="staffdisciplinary_appeal_AppealStatus">
<span<?php echo $staffdisciplinary_appeal_delete->AppealStatus->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_delete->AppealStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_appeal_delete->LastUpdate->Visible) { // LastUpdate ?>
		<td <?php echo $staffdisciplinary_appeal_delete->LastUpdate->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_appeal_delete->RowCount ?>_staffdisciplinary_appeal_LastUpdate" class="staffdisciplinary_appeal_LastUpdate">
<span<?php echo $staffdisciplinary_appeal_delete->LastUpdate->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_delete->LastUpdate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$staffdisciplinary_appeal_delete->Recordset->moveNext();
}
$staffdisciplinary_appeal_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staffdisciplinary_appeal_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$staffdisciplinary_appeal_delete->showPageFooter();
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
$staffdisciplinary_appeal_delete->terminate();
?>