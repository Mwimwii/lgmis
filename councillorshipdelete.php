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
$councillorship_delete = new councillorship_delete();

// Run the page
$councillorship_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillorship_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncillorshipdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcouncillorshipdelete = currentForm = new ew.Form("fcouncillorshipdelete", "delete");
	loadjs.done("fcouncillorshipdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $councillorship_delete->showPageHeader(); ?>
<?php
$councillorship_delete->showMessage();
?>
<form name="fcouncillorshipdelete" id="fcouncillorshipdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillorship">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($councillorship_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($councillorship_delete->EmployeeID->Visible) { // EmployeeID ?>
		<th class="<?php echo $councillorship_delete->EmployeeID->headerCellClass() ?>"><span id="elh_councillorship_EmployeeID" class="councillorship_EmployeeID"><?php echo $councillorship_delete->EmployeeID->caption() ?></span></th>
<?php } ?>
<?php if ($councillorship_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $councillorship_delete->LACode->headerCellClass() ?>"><span id="elh_councillorship_LACode" class="councillorship_LACode"><?php echo $councillorship_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($councillorship_delete->PoliticalParty->Visible) { // PoliticalParty ?>
		<th class="<?php echo $councillorship_delete->PoliticalParty->headerCellClass() ?>"><span id="elh_councillorship_PoliticalParty" class="councillorship_PoliticalParty"><?php echo $councillorship_delete->PoliticalParty->caption() ?></span></th>
<?php } ?>
<?php if ($councillorship_delete->Occupation->Visible) { // Occupation ?>
		<th class="<?php echo $councillorship_delete->Occupation->headerCellClass() ?>"><span id="elh_councillorship_Occupation" class="councillorship_Occupation"><?php echo $councillorship_delete->Occupation->caption() ?></span></th>
<?php } ?>
<?php if ($councillorship_delete->PositionInCouncil->Visible) { // PositionInCouncil ?>
		<th class="<?php echo $councillorship_delete->PositionInCouncil->headerCellClass() ?>"><span id="elh_councillorship_PositionInCouncil" class="councillorship_PositionInCouncil"><?php echo $councillorship_delete->PositionInCouncil->caption() ?></span></th>
<?php } ?>
<?php if ($councillorship_delete->Committee->Visible) { // Committee ?>
		<th class="<?php echo $councillorship_delete->Committee->headerCellClass() ?>"><span id="elh_councillorship_Committee" class="councillorship_Committee"><?php echo $councillorship_delete->Committee->caption() ?></span></th>
<?php } ?>
<?php if ($councillorship_delete->CommitteeRole->Visible) { // CommitteeRole ?>
		<th class="<?php echo $councillorship_delete->CommitteeRole->headerCellClass() ?>"><span id="elh_councillorship_CommitteeRole" class="councillorship_CommitteeRole"><?php echo $councillorship_delete->CommitteeRole->caption() ?></span></th>
<?php } ?>
<?php if ($councillorship_delete->CouncilTerm->Visible) { // CouncilTerm ?>
		<th class="<?php echo $councillorship_delete->CouncilTerm->headerCellClass() ?>"><span id="elh_councillorship_CouncilTerm" class="councillorship_CouncilTerm"><?php echo $councillorship_delete->CouncilTerm->caption() ?></span></th>
<?php } ?>
<?php if ($councillorship_delete->CouncillorTypeType->Visible) { // CouncillorTypeType ?>
		<th class="<?php echo $councillorship_delete->CouncillorTypeType->headerCellClass() ?>"><span id="elh_councillorship_CouncillorTypeType" class="councillorship_CouncillorTypeType"><?php echo $councillorship_delete->CouncillorTypeType->caption() ?></span></th>
<?php } ?>
<?php if ($councillorship_delete->ExitReason->Visible) { // ExitReason ?>
		<th class="<?php echo $councillorship_delete->ExitReason->headerCellClass() ?>"><span id="elh_councillorship_ExitReason" class="councillorship_ExitReason"><?php echo $councillorship_delete->ExitReason->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$councillorship_delete->RecordCount = 0;
$i = 0;
while (!$councillorship_delete->Recordset->EOF) {
	$councillorship_delete->RecordCount++;
	$councillorship_delete->RowCount++;

	// Set row properties
	$councillorship->resetAttributes();
	$councillorship->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$councillorship_delete->loadRowValues($councillorship_delete->Recordset);

	// Render row
	$councillorship_delete->renderRow();
?>
	<tr <?php echo $councillorship->rowAttributes() ?>>
<?php if ($councillorship_delete->EmployeeID->Visible) { // EmployeeID ?>
		<td <?php echo $councillorship_delete->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $councillorship_delete->RowCount ?>_councillorship_EmployeeID" class="councillorship_EmployeeID">
<span<?php echo $councillorship_delete->EmployeeID->viewAttributes() ?>><?php echo $councillorship_delete->EmployeeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $councillorship_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $councillorship_delete->RowCount ?>_councillorship_LACode" class="councillorship_LACode">
<span<?php echo $councillorship_delete->LACode->viewAttributes() ?>><?php echo $councillorship_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship_delete->PoliticalParty->Visible) { // PoliticalParty ?>
		<td <?php echo $councillorship_delete->PoliticalParty->cellAttributes() ?>>
<span id="el<?php echo $councillorship_delete->RowCount ?>_councillorship_PoliticalParty" class="councillorship_PoliticalParty">
<span<?php echo $councillorship_delete->PoliticalParty->viewAttributes() ?>><?php echo $councillorship_delete->PoliticalParty->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship_delete->Occupation->Visible) { // Occupation ?>
		<td <?php echo $councillorship_delete->Occupation->cellAttributes() ?>>
<span id="el<?php echo $councillorship_delete->RowCount ?>_councillorship_Occupation" class="councillorship_Occupation">
<span<?php echo $councillorship_delete->Occupation->viewAttributes() ?>><?php echo $councillorship_delete->Occupation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship_delete->PositionInCouncil->Visible) { // PositionInCouncil ?>
		<td <?php echo $councillorship_delete->PositionInCouncil->cellAttributes() ?>>
<span id="el<?php echo $councillorship_delete->RowCount ?>_councillorship_PositionInCouncil" class="councillorship_PositionInCouncil">
<span<?php echo $councillorship_delete->PositionInCouncil->viewAttributes() ?>><?php echo $councillorship_delete->PositionInCouncil->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship_delete->Committee->Visible) { // Committee ?>
		<td <?php echo $councillorship_delete->Committee->cellAttributes() ?>>
<span id="el<?php echo $councillorship_delete->RowCount ?>_councillorship_Committee" class="councillorship_Committee">
<span<?php echo $councillorship_delete->Committee->viewAttributes() ?>><?php echo $councillorship_delete->Committee->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship_delete->CommitteeRole->Visible) { // CommitteeRole ?>
		<td <?php echo $councillorship_delete->CommitteeRole->cellAttributes() ?>>
<span id="el<?php echo $councillorship_delete->RowCount ?>_councillorship_CommitteeRole" class="councillorship_CommitteeRole">
<span<?php echo $councillorship_delete->CommitteeRole->viewAttributes() ?>><?php echo $councillorship_delete->CommitteeRole->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship_delete->CouncilTerm->Visible) { // CouncilTerm ?>
		<td <?php echo $councillorship_delete->CouncilTerm->cellAttributes() ?>>
<span id="el<?php echo $councillorship_delete->RowCount ?>_councillorship_CouncilTerm" class="councillorship_CouncilTerm">
<span<?php echo $councillorship_delete->CouncilTerm->viewAttributes() ?>><?php echo $councillorship_delete->CouncilTerm->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship_delete->CouncillorTypeType->Visible) { // CouncillorTypeType ?>
		<td <?php echo $councillorship_delete->CouncillorTypeType->cellAttributes() ?>>
<span id="el<?php echo $councillorship_delete->RowCount ?>_councillorship_CouncillorTypeType" class="councillorship_CouncillorTypeType">
<span<?php echo $councillorship_delete->CouncillorTypeType->viewAttributes() ?>><?php echo $councillorship_delete->CouncillorTypeType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship_delete->ExitReason->Visible) { // ExitReason ?>
		<td <?php echo $councillorship_delete->ExitReason->cellAttributes() ?>>
<span id="el<?php echo $councillorship_delete->RowCount ?>_councillorship_ExitReason" class="councillorship_ExitReason">
<span<?php echo $councillorship_delete->ExitReason->viewAttributes() ?>><?php echo $councillorship_delete->ExitReason->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$councillorship_delete->Recordset->moveNext();
}
$councillorship_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $councillorship_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$councillorship_delete->showPageFooter();
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
$councillorship_delete->terminate();
?>