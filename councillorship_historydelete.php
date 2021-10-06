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
$councillorship_history_delete = new councillorship_history_delete();

// Run the page
$councillorship_history_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillorship_history_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncillorship_historydelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcouncillorship_historydelete = currentForm = new ew.Form("fcouncillorship_historydelete", "delete");
	loadjs.done("fcouncillorship_historydelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $councillorship_history_delete->showPageHeader(); ?>
<?php
$councillorship_history_delete->showMessage();
?>
<form name="fcouncillorship_historydelete" id="fcouncillorship_historydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillorship_history">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($councillorship_history_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($councillorship_history_delete->EmployeeID->Visible) { // EmployeeID ?>
		<th class="<?php echo $councillorship_history_delete->EmployeeID->headerCellClass() ?>"><span id="elh_councillorship_history_EmployeeID" class="councillorship_history_EmployeeID"><?php echo $councillorship_history_delete->EmployeeID->caption() ?></span></th>
<?php } ?>
<?php if ($councillorship_history_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<th class="<?php echo $councillorship_history_delete->ProvinceCode->headerCellClass() ?>"><span id="elh_councillorship_history_ProvinceCode" class="councillorship_history_ProvinceCode"><?php echo $councillorship_history_delete->ProvinceCode->caption() ?></span></th>
<?php } ?>
<?php if ($councillorship_history_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $councillorship_history_delete->LACode->headerCellClass() ?>"><span id="elh_councillorship_history_LACode" class="councillorship_history_LACode"><?php echo $councillorship_history_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($councillorship_history_delete->PoliticalParty->Visible) { // PoliticalParty ?>
		<th class="<?php echo $councillorship_history_delete->PoliticalParty->headerCellClass() ?>"><span id="elh_councillorship_history_PoliticalParty" class="councillorship_history_PoliticalParty"><?php echo $councillorship_history_delete->PoliticalParty->caption() ?></span></th>
<?php } ?>
<?php if ($councillorship_history_delete->Occupation->Visible) { // Occupation ?>
		<th class="<?php echo $councillorship_history_delete->Occupation->headerCellClass() ?>"><span id="elh_councillorship_history_Occupation" class="councillorship_history_Occupation"><?php echo $councillorship_history_delete->Occupation->caption() ?></span></th>
<?php } ?>
<?php if ($councillorship_history_delete->PositionInCouncil->Visible) { // PositionInCouncil ?>
		<th class="<?php echo $councillorship_history_delete->PositionInCouncil->headerCellClass() ?>"><span id="elh_councillorship_history_PositionInCouncil" class="councillorship_history_PositionInCouncil"><?php echo $councillorship_history_delete->PositionInCouncil->caption() ?></span></th>
<?php } ?>
<?php if ($councillorship_history_delete->Committee->Visible) { // Committee ?>
		<th class="<?php echo $councillorship_history_delete->Committee->headerCellClass() ?>"><span id="elh_councillorship_history_Committee" class="councillorship_history_Committee"><?php echo $councillorship_history_delete->Committee->caption() ?></span></th>
<?php } ?>
<?php if ($councillorship_history_delete->CouncilTerm->Visible) { // CouncilTerm ?>
		<th class="<?php echo $councillorship_history_delete->CouncilTerm->headerCellClass() ?>"><span id="elh_councillorship_history_CouncilTerm" class="councillorship_history_CouncilTerm"><?php echo $councillorship_history_delete->CouncilTerm->caption() ?></span></th>
<?php } ?>
<?php if ($councillorship_history_delete->DateOfExit->Visible) { // DateOfExit ?>
		<th class="<?php echo $councillorship_history_delete->DateOfExit->headerCellClass() ?>"><span id="elh_councillorship_history_DateOfExit" class="councillorship_history_DateOfExit"><?php echo $councillorship_history_delete->DateOfExit->caption() ?></span></th>
<?php } ?>
<?php if ($councillorship_history_delete->Allowance->Visible) { // Allowance ?>
		<th class="<?php echo $councillorship_history_delete->Allowance->headerCellClass() ?>"><span id="elh_councillorship_history_Allowance" class="councillorship_history_Allowance"><?php echo $councillorship_history_delete->Allowance->caption() ?></span></th>
<?php } ?>
<?php if ($councillorship_history_delete->CouncillorTypeType->Visible) { // CouncillorTypeType ?>
		<th class="<?php echo $councillorship_history_delete->CouncillorTypeType->headerCellClass() ?>"><span id="elh_councillorship_history_CouncillorTypeType" class="councillorship_history_CouncillorTypeType"><?php echo $councillorship_history_delete->CouncillorTypeType->caption() ?></span></th>
<?php } ?>
<?php if ($councillorship_history_delete->CouncillorshipStatus->Visible) { // CouncillorshipStatus ?>
		<th class="<?php echo $councillorship_history_delete->CouncillorshipStatus->headerCellClass() ?>"><span id="elh_councillorship_history_CouncillorshipStatus" class="councillorship_history_CouncillorshipStatus"><?php echo $councillorship_history_delete->CouncillorshipStatus->caption() ?></span></th>
<?php } ?>
<?php if ($councillorship_history_delete->ExitReason->Visible) { // ExitReason ?>
		<th class="<?php echo $councillorship_history_delete->ExitReason->headerCellClass() ?>"><span id="elh_councillorship_history_ExitReason" class="councillorship_history_ExitReason"><?php echo $councillorship_history_delete->ExitReason->caption() ?></span></th>
<?php } ?>
<?php if ($councillorship_history_delete->RetirementType->Visible) { // RetirementType ?>
		<th class="<?php echo $councillorship_history_delete->RetirementType->headerCellClass() ?>"><span id="elh_councillorship_history_RetirementType" class="councillorship_history_RetirementType"><?php echo $councillorship_history_delete->RetirementType->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$councillorship_history_delete->RecordCount = 0;
$i = 0;
while (!$councillorship_history_delete->Recordset->EOF) {
	$councillorship_history_delete->RecordCount++;
	$councillorship_history_delete->RowCount++;

	// Set row properties
	$councillorship_history->resetAttributes();
	$councillorship_history->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$councillorship_history_delete->loadRowValues($councillorship_history_delete->Recordset);

	// Render row
	$councillorship_history_delete->renderRow();
?>
	<tr <?php echo $councillorship_history->rowAttributes() ?>>
<?php if ($councillorship_history_delete->EmployeeID->Visible) { // EmployeeID ?>
		<td <?php echo $councillorship_history_delete->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_delete->RowCount ?>_councillorship_history_EmployeeID" class="councillorship_history_EmployeeID">
<span<?php echo $councillorship_history_delete->EmployeeID->viewAttributes() ?>><?php echo $councillorship_history_delete->EmployeeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship_history_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<td <?php echo $councillorship_history_delete->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_delete->RowCount ?>_councillorship_history_ProvinceCode" class="councillorship_history_ProvinceCode">
<span<?php echo $councillorship_history_delete->ProvinceCode->viewAttributes() ?>><?php echo $councillorship_history_delete->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship_history_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $councillorship_history_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_delete->RowCount ?>_councillorship_history_LACode" class="councillorship_history_LACode">
<span<?php echo $councillorship_history_delete->LACode->viewAttributes() ?>><?php echo $councillorship_history_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship_history_delete->PoliticalParty->Visible) { // PoliticalParty ?>
		<td <?php echo $councillorship_history_delete->PoliticalParty->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_delete->RowCount ?>_councillorship_history_PoliticalParty" class="councillorship_history_PoliticalParty">
<span<?php echo $councillorship_history_delete->PoliticalParty->viewAttributes() ?>><?php echo $councillorship_history_delete->PoliticalParty->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship_history_delete->Occupation->Visible) { // Occupation ?>
		<td <?php echo $councillorship_history_delete->Occupation->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_delete->RowCount ?>_councillorship_history_Occupation" class="councillorship_history_Occupation">
<span<?php echo $councillorship_history_delete->Occupation->viewAttributes() ?>><?php echo $councillorship_history_delete->Occupation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship_history_delete->PositionInCouncil->Visible) { // PositionInCouncil ?>
		<td <?php echo $councillorship_history_delete->PositionInCouncil->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_delete->RowCount ?>_councillorship_history_PositionInCouncil" class="councillorship_history_PositionInCouncil">
<span<?php echo $councillorship_history_delete->PositionInCouncil->viewAttributes() ?>><?php echo $councillorship_history_delete->PositionInCouncil->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship_history_delete->Committee->Visible) { // Committee ?>
		<td <?php echo $councillorship_history_delete->Committee->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_delete->RowCount ?>_councillorship_history_Committee" class="councillorship_history_Committee">
<span<?php echo $councillorship_history_delete->Committee->viewAttributes() ?>><?php echo $councillorship_history_delete->Committee->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship_history_delete->CouncilTerm->Visible) { // CouncilTerm ?>
		<td <?php echo $councillorship_history_delete->CouncilTerm->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_delete->RowCount ?>_councillorship_history_CouncilTerm" class="councillorship_history_CouncilTerm">
<span<?php echo $councillorship_history_delete->CouncilTerm->viewAttributes() ?>><?php echo $councillorship_history_delete->CouncilTerm->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship_history_delete->DateOfExit->Visible) { // DateOfExit ?>
		<td <?php echo $councillorship_history_delete->DateOfExit->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_delete->RowCount ?>_councillorship_history_DateOfExit" class="councillorship_history_DateOfExit">
<span<?php echo $councillorship_history_delete->DateOfExit->viewAttributes() ?>><?php echo $councillorship_history_delete->DateOfExit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship_history_delete->Allowance->Visible) { // Allowance ?>
		<td <?php echo $councillorship_history_delete->Allowance->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_delete->RowCount ?>_councillorship_history_Allowance" class="councillorship_history_Allowance">
<span<?php echo $councillorship_history_delete->Allowance->viewAttributes() ?>><?php echo $councillorship_history_delete->Allowance->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship_history_delete->CouncillorTypeType->Visible) { // CouncillorTypeType ?>
		<td <?php echo $councillorship_history_delete->CouncillorTypeType->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_delete->RowCount ?>_councillorship_history_CouncillorTypeType" class="councillorship_history_CouncillorTypeType">
<span<?php echo $councillorship_history_delete->CouncillorTypeType->viewAttributes() ?>><?php echo $councillorship_history_delete->CouncillorTypeType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship_history_delete->CouncillorshipStatus->Visible) { // CouncillorshipStatus ?>
		<td <?php echo $councillorship_history_delete->CouncillorshipStatus->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_delete->RowCount ?>_councillorship_history_CouncillorshipStatus" class="councillorship_history_CouncillorshipStatus">
<span<?php echo $councillorship_history_delete->CouncillorshipStatus->viewAttributes() ?>><?php echo $councillorship_history_delete->CouncillorshipStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship_history_delete->ExitReason->Visible) { // ExitReason ?>
		<td <?php echo $councillorship_history_delete->ExitReason->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_delete->RowCount ?>_councillorship_history_ExitReason" class="councillorship_history_ExitReason">
<span<?php echo $councillorship_history_delete->ExitReason->viewAttributes() ?>><?php echo $councillorship_history_delete->ExitReason->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship_history_delete->RetirementType->Visible) { // RetirementType ?>
		<td <?php echo $councillorship_history_delete->RetirementType->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_delete->RowCount ?>_councillorship_history_RetirementType" class="councillorship_history_RetirementType">
<span<?php echo $councillorship_history_delete->RetirementType->viewAttributes() ?>><?php echo $councillorship_history_delete->RetirementType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$councillorship_history_delete->Recordset->moveNext();
}
$councillorship_history_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $councillorship_history_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$councillorship_history_delete->showPageFooter();
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
$councillorship_history_delete->terminate();
?>