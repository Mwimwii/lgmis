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
$_action_delete = new _action_delete();

// Run the page
$_action_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_action_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var f_actiondelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	f_actiondelete = currentForm = new ew.Form("f_actiondelete", "delete");
	loadjs.done("f_actiondelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $_action_delete->showPageHeader(); ?>
<?php
$_action_delete->showMessage();
?>
<form name="f_actiondelete" id="f_actiondelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_action">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($_action_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($_action_delete->ProgramCode->Visible) { // ProgramCode ?>
		<th class="<?php echo $_action_delete->ProgramCode->headerCellClass() ?>"><span id="elh__action_ProgramCode" class="_action_ProgramCode"><?php echo $_action_delete->ProgramCode->caption() ?></span></th>
<?php } ?>
<?php if ($_action_delete->OucomeCode->Visible) { // OucomeCode ?>
		<th class="<?php echo $_action_delete->OucomeCode->headerCellClass() ?>"><span id="elh__action_OucomeCode" class="_action_OucomeCode"><?php echo $_action_delete->OucomeCode->caption() ?></span></th>
<?php } ?>
<?php if ($_action_delete->OutputCode->Visible) { // OutputCode ?>
		<th class="<?php echo $_action_delete->OutputCode->headerCellClass() ?>"><span id="elh__action_OutputCode" class="_action_OutputCode"><?php echo $_action_delete->OutputCode->caption() ?></span></th>
<?php } ?>
<?php if ($_action_delete->ProjectCode->Visible) { // ProjectCode ?>
		<th class="<?php echo $_action_delete->ProjectCode->headerCellClass() ?>"><span id="elh__action_ProjectCode" class="_action_ProjectCode"><?php echo $_action_delete->ProjectCode->caption() ?></span></th>
<?php } ?>
<?php if ($_action_delete->ActionCode->Visible) { // ActionCode ?>
		<th class="<?php echo $_action_delete->ActionCode->headerCellClass() ?>"><span id="elh__action_ActionCode" class="_action_ActionCode"><?php echo $_action_delete->ActionCode->caption() ?></span></th>
<?php } ?>
<?php if ($_action_delete->ActionName->Visible) { // ActionName ?>
		<th class="<?php echo $_action_delete->ActionName->headerCellClass() ?>"><span id="elh__action_ActionName" class="_action_ActionName"><?php echo $_action_delete->ActionName->caption() ?></span></th>
<?php } ?>
<?php if ($_action_delete->ActionType->Visible) { // ActionType ?>
		<th class="<?php echo $_action_delete->ActionType->headerCellClass() ?>"><span id="elh__action_ActionType" class="_action_ActionType"><?php echo $_action_delete->ActionType->caption() ?></span></th>
<?php } ?>
<?php if ($_action_delete->FinancialYear->Visible) { // FinancialYear ?>
		<th class="<?php echo $_action_delete->FinancialYear->headerCellClass() ?>"><span id="elh__action_FinancialYear" class="_action_FinancialYear"><?php echo $_action_delete->FinancialYear->caption() ?></span></th>
<?php } ?>
<?php if ($_action_delete->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
		<th class="<?php echo $_action_delete->ExpectedAnnualAchievement->headerCellClass() ?>"><span id="elh__action_ExpectedAnnualAchievement" class="_action_ExpectedAnnualAchievement"><?php echo $_action_delete->ExpectedAnnualAchievement->caption() ?></span></th>
<?php } ?>
<?php if ($_action_delete->ActionLocation->Visible) { // ActionLocation ?>
		<th class="<?php echo $_action_delete->ActionLocation->headerCellClass() ?>"><span id="elh__action_ActionLocation" class="_action_ActionLocation"><?php echo $_action_delete->ActionLocation->caption() ?></span></th>
<?php } ?>
<?php if ($_action_delete->Latitude->Visible) { // Latitude ?>
		<th class="<?php echo $_action_delete->Latitude->headerCellClass() ?>"><span id="elh__action_Latitude" class="_action_Latitude"><?php echo $_action_delete->Latitude->caption() ?></span></th>
<?php } ?>
<?php if ($_action_delete->Longitude->Visible) { // Longitude ?>
		<th class="<?php echo $_action_delete->Longitude->headerCellClass() ?>"><span id="elh__action_Longitude" class="_action_Longitude"><?php echo $_action_delete->Longitude->caption() ?></span></th>
<?php } ?>
<?php if ($_action_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $_action_delete->LACode->headerCellClass() ?>"><span id="elh__action_LACode" class="_action_LACode"><?php echo $_action_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($_action_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<th class="<?php echo $_action_delete->DepartmentCode->headerCellClass() ?>"><span id="elh__action_DepartmentCode" class="_action_DepartmentCode"><?php echo $_action_delete->DepartmentCode->caption() ?></span></th>
<?php } ?>
<?php if ($_action_delete->SectionCode->Visible) { // SectionCode ?>
		<th class="<?php echo $_action_delete->SectionCode->headerCellClass() ?>"><span id="elh__action_SectionCode" class="_action_SectionCode"><?php echo $_action_delete->SectionCode->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$_action_delete->RecordCount = 0;
$i = 0;
while (!$_action_delete->Recordset->EOF) {
	$_action_delete->RecordCount++;
	$_action_delete->RowCount++;

	// Set row properties
	$_action->resetAttributes();
	$_action->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$_action_delete->loadRowValues($_action_delete->Recordset);

	// Render row
	$_action_delete->renderRow();
?>
	<tr <?php echo $_action->rowAttributes() ?>>
<?php if ($_action_delete->ProgramCode->Visible) { // ProgramCode ?>
		<td <?php echo $_action_delete->ProgramCode->cellAttributes() ?>>
<span id="el<?php echo $_action_delete->RowCount ?>__action_ProgramCode" class="_action_ProgramCode">
<span<?php echo $_action_delete->ProgramCode->viewAttributes() ?>><?php echo $_action_delete->ProgramCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action_delete->OucomeCode->Visible) { // OucomeCode ?>
		<td <?php echo $_action_delete->OucomeCode->cellAttributes() ?>>
<span id="el<?php echo $_action_delete->RowCount ?>__action_OucomeCode" class="_action_OucomeCode">
<span<?php echo $_action_delete->OucomeCode->viewAttributes() ?>><?php echo $_action_delete->OucomeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action_delete->OutputCode->Visible) { // OutputCode ?>
		<td <?php echo $_action_delete->OutputCode->cellAttributes() ?>>
<span id="el<?php echo $_action_delete->RowCount ?>__action_OutputCode" class="_action_OutputCode">
<span<?php echo $_action_delete->OutputCode->viewAttributes() ?>><?php echo $_action_delete->OutputCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action_delete->ProjectCode->Visible) { // ProjectCode ?>
		<td <?php echo $_action_delete->ProjectCode->cellAttributes() ?>>
<span id="el<?php echo $_action_delete->RowCount ?>__action_ProjectCode" class="_action_ProjectCode">
<span<?php echo $_action_delete->ProjectCode->viewAttributes() ?>><?php echo $_action_delete->ProjectCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action_delete->ActionCode->Visible) { // ActionCode ?>
		<td <?php echo $_action_delete->ActionCode->cellAttributes() ?>>
<span id="el<?php echo $_action_delete->RowCount ?>__action_ActionCode" class="_action_ActionCode">
<span<?php echo $_action_delete->ActionCode->viewAttributes() ?>><?php echo $_action_delete->ActionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action_delete->ActionName->Visible) { // ActionName ?>
		<td <?php echo $_action_delete->ActionName->cellAttributes() ?>>
<span id="el<?php echo $_action_delete->RowCount ?>__action_ActionName" class="_action_ActionName">
<span<?php echo $_action_delete->ActionName->viewAttributes() ?>><?php echo $_action_delete->ActionName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action_delete->ActionType->Visible) { // ActionType ?>
		<td <?php echo $_action_delete->ActionType->cellAttributes() ?>>
<span id="el<?php echo $_action_delete->RowCount ?>__action_ActionType" class="_action_ActionType">
<span<?php echo $_action_delete->ActionType->viewAttributes() ?>><?php echo $_action_delete->ActionType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action_delete->FinancialYear->Visible) { // FinancialYear ?>
		<td <?php echo $_action_delete->FinancialYear->cellAttributes() ?>>
<span id="el<?php echo $_action_delete->RowCount ?>__action_FinancialYear" class="_action_FinancialYear">
<span<?php echo $_action_delete->FinancialYear->viewAttributes() ?>><?php echo $_action_delete->FinancialYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action_delete->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
		<td <?php echo $_action_delete->ExpectedAnnualAchievement->cellAttributes() ?>>
<span id="el<?php echo $_action_delete->RowCount ?>__action_ExpectedAnnualAchievement" class="_action_ExpectedAnnualAchievement">
<span<?php echo $_action_delete->ExpectedAnnualAchievement->viewAttributes() ?>><?php echo $_action_delete->ExpectedAnnualAchievement->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action_delete->ActionLocation->Visible) { // ActionLocation ?>
		<td <?php echo $_action_delete->ActionLocation->cellAttributes() ?>>
<span id="el<?php echo $_action_delete->RowCount ?>__action_ActionLocation" class="_action_ActionLocation">
<span<?php echo $_action_delete->ActionLocation->viewAttributes() ?>><?php echo $_action_delete->ActionLocation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action_delete->Latitude->Visible) { // Latitude ?>
		<td <?php echo $_action_delete->Latitude->cellAttributes() ?>>
<span id="el<?php echo $_action_delete->RowCount ?>__action_Latitude" class="_action_Latitude">
<span<?php echo $_action_delete->Latitude->viewAttributes() ?>><?php echo $_action_delete->Latitude->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action_delete->Longitude->Visible) { // Longitude ?>
		<td <?php echo $_action_delete->Longitude->cellAttributes() ?>>
<span id="el<?php echo $_action_delete->RowCount ?>__action_Longitude" class="_action_Longitude">
<span<?php echo $_action_delete->Longitude->viewAttributes() ?>><?php echo $_action_delete->Longitude->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $_action_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $_action_delete->RowCount ?>__action_LACode" class="_action_LACode">
<span<?php echo $_action_delete->LACode->viewAttributes() ?>><?php echo $_action_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<td <?php echo $_action_delete->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $_action_delete->RowCount ?>__action_DepartmentCode" class="_action_DepartmentCode">
<span<?php echo $_action_delete->DepartmentCode->viewAttributes() ?>><?php echo $_action_delete->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action_delete->SectionCode->Visible) { // SectionCode ?>
		<td <?php echo $_action_delete->SectionCode->cellAttributes() ?>>
<span id="el<?php echo $_action_delete->RowCount ?>__action_SectionCode" class="_action_SectionCode">
<span<?php echo $_action_delete->SectionCode->viewAttributes() ?>><?php echo $_action_delete->SectionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$_action_delete->Recordset->moveNext();
}
$_action_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $_action_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$_action_delete->showPageFooter();
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
$_action_delete->terminate();
?>