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
$board_zone_delete = new board_zone_delete();

// Run the page
$board_zone_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$board_zone_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fboard_zonedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fboard_zonedelete = currentForm = new ew.Form("fboard_zonedelete", "delete");
	loadjs.done("fboard_zonedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $board_zone_delete->showPageHeader(); ?>
<?php
$board_zone_delete->showMessage();
?>
<form name="fboard_zonedelete" id="fboard_zonedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="board_zone">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($board_zone_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($board_zone_delete->BoardZone->Visible) { // BoardZone ?>
		<th class="<?php echo $board_zone_delete->BoardZone->headerCellClass() ?>"><span id="elh_board_zone_BoardZone" class="board_zone_BoardZone"><?php echo $board_zone_delete->BoardZone->caption() ?></span></th>
<?php } ?>
<?php if ($board_zone_delete->BoardZoneDesc->Visible) { // BoardZoneDesc ?>
		<th class="<?php echo $board_zone_delete->BoardZoneDesc->headerCellClass() ?>"><span id="elh_board_zone_BoardZoneDesc" class="board_zone_BoardZoneDesc"><?php echo $board_zone_delete->BoardZoneDesc->caption() ?></span></th>
<?php } ?>
<?php if ($board_zone_delete->IndividualCharge->Visible) { // IndividualCharge ?>
		<th class="<?php echo $board_zone_delete->IndividualCharge->headerCellClass() ?>"><span id="elh_board_zone_IndividualCharge" class="board_zone_IndividualCharge"><?php echo $board_zone_delete->IndividualCharge->caption() ?></span></th>
<?php } ?>
<?php if ($board_zone_delete->AgentCharge->Visible) { // AgentCharge ?>
		<th class="<?php echo $board_zone_delete->AgentCharge->headerCellClass() ?>"><span id="elh_board_zone_AgentCharge" class="board_zone_AgentCharge"><?php echo $board_zone_delete->AgentCharge->caption() ?></span></th>
<?php } ?>
<?php if ($board_zone_delete->PeriodType->Visible) { // PeriodType ?>
		<th class="<?php echo $board_zone_delete->PeriodType->headerCellClass() ?>"><span id="elh_board_zone_PeriodType" class="board_zone_PeriodType"><?php echo $board_zone_delete->PeriodType->caption() ?></span></th>
<?php } ?>
<?php if ($board_zone_delete->BoardType->Visible) { // BoardType ?>
		<th class="<?php echo $board_zone_delete->BoardType->headerCellClass() ?>"><span id="elh_board_zone_BoardType" class="board_zone_BoardType"><?php echo $board_zone_delete->BoardType->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$board_zone_delete->RecordCount = 0;
$i = 0;
while (!$board_zone_delete->Recordset->EOF) {
	$board_zone_delete->RecordCount++;
	$board_zone_delete->RowCount++;

	// Set row properties
	$board_zone->resetAttributes();
	$board_zone->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$board_zone_delete->loadRowValues($board_zone_delete->Recordset);

	// Render row
	$board_zone_delete->renderRow();
?>
	<tr <?php echo $board_zone->rowAttributes() ?>>
<?php if ($board_zone_delete->BoardZone->Visible) { // BoardZone ?>
		<td <?php echo $board_zone_delete->BoardZone->cellAttributes() ?>>
<span id="el<?php echo $board_zone_delete->RowCount ?>_board_zone_BoardZone" class="board_zone_BoardZone">
<span<?php echo $board_zone_delete->BoardZone->viewAttributes() ?>><?php echo $board_zone_delete->BoardZone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($board_zone_delete->BoardZoneDesc->Visible) { // BoardZoneDesc ?>
		<td <?php echo $board_zone_delete->BoardZoneDesc->cellAttributes() ?>>
<span id="el<?php echo $board_zone_delete->RowCount ?>_board_zone_BoardZoneDesc" class="board_zone_BoardZoneDesc">
<span<?php echo $board_zone_delete->BoardZoneDesc->viewAttributes() ?>><?php echo $board_zone_delete->BoardZoneDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($board_zone_delete->IndividualCharge->Visible) { // IndividualCharge ?>
		<td <?php echo $board_zone_delete->IndividualCharge->cellAttributes() ?>>
<span id="el<?php echo $board_zone_delete->RowCount ?>_board_zone_IndividualCharge" class="board_zone_IndividualCharge">
<span<?php echo $board_zone_delete->IndividualCharge->viewAttributes() ?>><?php echo $board_zone_delete->IndividualCharge->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($board_zone_delete->AgentCharge->Visible) { // AgentCharge ?>
		<td <?php echo $board_zone_delete->AgentCharge->cellAttributes() ?>>
<span id="el<?php echo $board_zone_delete->RowCount ?>_board_zone_AgentCharge" class="board_zone_AgentCharge">
<span<?php echo $board_zone_delete->AgentCharge->viewAttributes() ?>><?php echo $board_zone_delete->AgentCharge->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($board_zone_delete->PeriodType->Visible) { // PeriodType ?>
		<td <?php echo $board_zone_delete->PeriodType->cellAttributes() ?>>
<span id="el<?php echo $board_zone_delete->RowCount ?>_board_zone_PeriodType" class="board_zone_PeriodType">
<span<?php echo $board_zone_delete->PeriodType->viewAttributes() ?>><?php echo $board_zone_delete->PeriodType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($board_zone_delete->BoardType->Visible) { // BoardType ?>
		<td <?php echo $board_zone_delete->BoardType->cellAttributes() ?>>
<span id="el<?php echo $board_zone_delete->RowCount ?>_board_zone_BoardType" class="board_zone_BoardType">
<span<?php echo $board_zone_delete->BoardType->viewAttributes() ?>><?php echo $board_zone_delete->BoardType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$board_zone_delete->Recordset->moveNext();
}
$board_zone_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $board_zone_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$board_zone_delete->showPageFooter();
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
$board_zone_delete->terminate();
?>