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
$bill_board_delete = new bill_board_delete();

// Run the page
$bill_board_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bill_board_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbill_boarddelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fbill_boarddelete = currentForm = new ew.Form("fbill_boarddelete", "delete");
	loadjs.done("fbill_boarddelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $bill_board_delete->showPageHeader(); ?>
<?php
$bill_board_delete->showMessage();
?>
<form name="fbill_boarddelete" id="fbill_boarddelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bill_board">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($bill_board_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($bill_board_delete->BillBoardNo->Visible) { // BillBoardNo ?>
		<th class="<?php echo $bill_board_delete->BillBoardNo->headerCellClass() ?>"><span id="elh_bill_board_BillBoardNo" class="bill_board_BillBoardNo"><?php echo $bill_board_delete->BillBoardNo->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_delete->BoardStandNo->Visible) { // BoardStandNo ?>
		<th class="<?php echo $bill_board_delete->BoardStandNo->headerCellClass() ?>"><span id="elh_bill_board_BoardStandNo" class="bill_board_BoardStandNo"><?php echo $bill_board_delete->BoardStandNo->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_delete->ClientSerNo->Visible) { // ClientSerNo ?>
		<th class="<?php echo $bill_board_delete->ClientSerNo->headerCellClass() ?>"><span id="elh_bill_board_ClientSerNo" class="bill_board_ClientSerNo"><?php echo $bill_board_delete->ClientSerNo->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_delete->ClientID->Visible) { // ClientID ?>
		<th class="<?php echo $bill_board_delete->ClientID->headerCellClass() ?>"><span id="elh_bill_board_ClientID" class="bill_board_ClientID"><?php echo $bill_board_delete->ClientID->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_delete->BoardLength->Visible) { // BoardLength ?>
		<th class="<?php echo $bill_board_delete->BoardLength->headerCellClass() ?>"><span id="elh_bill_board_BoardLength" class="bill_board_BoardLength"><?php echo $bill_board_delete->BoardLength->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_delete->BoardWidth->Visible) { // BoardWidth ?>
		<th class="<?php echo $bill_board_delete->BoardWidth->headerCellClass() ?>"><span id="elh_bill_board_BoardWidth" class="bill_board_BoardWidth"><?php echo $bill_board_delete->BoardWidth->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_delete->BoardSize->Visible) { // BoardSize ?>
		<th class="<?php echo $bill_board_delete->BoardSize->headerCellClass() ?>"><span id="elh_bill_board_BoardSize" class="bill_board_BoardSize"><?php echo $bill_board_delete->BoardSize->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_delete->BoardType->Visible) { // BoardType ?>
		<th class="<?php echo $bill_board_delete->BoardType->headerCellClass() ?>"><span id="elh_bill_board_BoardType" class="bill_board_BoardType"><?php echo $bill_board_delete->BoardType->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_delete->BoardLocation->Visible) { // BoardLocation ?>
		<th class="<?php echo $bill_board_delete->BoardLocation->headerCellClass() ?>"><span id="elh_bill_board_BoardLocation" class="bill_board_BoardLocation"><?php echo $bill_board_delete->BoardLocation->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_delete->BoardStatus->Visible) { // BoardStatus ?>
		<th class="<?php echo $bill_board_delete->BoardStatus->headerCellClass() ?>"><span id="elh_bill_board_BoardStatus" class="bill_board_BoardStatus"><?php echo $bill_board_delete->BoardStatus->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_delete->ExemptCode->Visible) { // ExemptCode ?>
		<th class="<?php echo $bill_board_delete->ExemptCode->headerCellClass() ?>"><span id="elh_bill_board_ExemptCode" class="bill_board_ExemptCode"><?php echo $bill_board_delete->ExemptCode->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_delete->StreetAddress->Visible) { // StreetAddress ?>
		<th class="<?php echo $bill_board_delete->StreetAddress->headerCellClass() ?>"><span id="elh_bill_board_StreetAddress" class="bill_board_StreetAddress"><?php echo $bill_board_delete->StreetAddress->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_delete->Longitude->Visible) { // Longitude ?>
		<th class="<?php echo $bill_board_delete->Longitude->headerCellClass() ?>"><span id="elh_bill_board_Longitude" class="bill_board_Longitude"><?php echo $bill_board_delete->Longitude->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_delete->Latitude->Visible) { // Latitude ?>
		<th class="<?php echo $bill_board_delete->Latitude->headerCellClass() ?>"><span id="elh_bill_board_Latitude" class="bill_board_Latitude"><?php echo $bill_board_delete->Latitude->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_delete->Incumberance->Visible) { // Incumberance ?>
		<th class="<?php echo $bill_board_delete->Incumberance->headerCellClass() ?>"><span id="elh_bill_board_Incumberance" class="bill_board_Incumberance"><?php echo $bill_board_delete->Incumberance->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_delete->StartDate->Visible) { // StartDate ?>
		<th class="<?php echo $bill_board_delete->StartDate->headerCellClass() ?>"><span id="elh_bill_board_StartDate" class="bill_board_StartDate"><?php echo $bill_board_delete->StartDate->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_delete->EndDate->Visible) { // EndDate ?>
		<th class="<?php echo $bill_board_delete->EndDate->headerCellClass() ?>"><span id="elh_bill_board_EndDate" class="bill_board_EndDate"><?php echo $bill_board_delete->EndDate->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$bill_board_delete->RecordCount = 0;
$i = 0;
while (!$bill_board_delete->Recordset->EOF) {
	$bill_board_delete->RecordCount++;
	$bill_board_delete->RowCount++;

	// Set row properties
	$bill_board->resetAttributes();
	$bill_board->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$bill_board_delete->loadRowValues($bill_board_delete->Recordset);

	// Render row
	$bill_board_delete->renderRow();
?>
	<tr <?php echo $bill_board->rowAttributes() ?>>
<?php if ($bill_board_delete->BillBoardNo->Visible) { // BillBoardNo ?>
		<td <?php echo $bill_board_delete->BillBoardNo->cellAttributes() ?>>
<span id="el<?php echo $bill_board_delete->RowCount ?>_bill_board_BillBoardNo" class="bill_board_BillBoardNo">
<span<?php echo $bill_board_delete->BillBoardNo->viewAttributes() ?>><?php echo $bill_board_delete->BillBoardNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_delete->BoardStandNo->Visible) { // BoardStandNo ?>
		<td <?php echo $bill_board_delete->BoardStandNo->cellAttributes() ?>>
<span id="el<?php echo $bill_board_delete->RowCount ?>_bill_board_BoardStandNo" class="bill_board_BoardStandNo">
<span<?php echo $bill_board_delete->BoardStandNo->viewAttributes() ?>><?php echo $bill_board_delete->BoardStandNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_delete->ClientSerNo->Visible) { // ClientSerNo ?>
		<td <?php echo $bill_board_delete->ClientSerNo->cellAttributes() ?>>
<span id="el<?php echo $bill_board_delete->RowCount ?>_bill_board_ClientSerNo" class="bill_board_ClientSerNo">
<span<?php echo $bill_board_delete->ClientSerNo->viewAttributes() ?>><?php echo $bill_board_delete->ClientSerNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_delete->ClientID->Visible) { // ClientID ?>
		<td <?php echo $bill_board_delete->ClientID->cellAttributes() ?>>
<span id="el<?php echo $bill_board_delete->RowCount ?>_bill_board_ClientID" class="bill_board_ClientID">
<span<?php echo $bill_board_delete->ClientID->viewAttributes() ?>><?php echo $bill_board_delete->ClientID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_delete->BoardLength->Visible) { // BoardLength ?>
		<td <?php echo $bill_board_delete->BoardLength->cellAttributes() ?>>
<span id="el<?php echo $bill_board_delete->RowCount ?>_bill_board_BoardLength" class="bill_board_BoardLength">
<span<?php echo $bill_board_delete->BoardLength->viewAttributes() ?>><?php echo $bill_board_delete->BoardLength->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_delete->BoardWidth->Visible) { // BoardWidth ?>
		<td <?php echo $bill_board_delete->BoardWidth->cellAttributes() ?>>
<span id="el<?php echo $bill_board_delete->RowCount ?>_bill_board_BoardWidth" class="bill_board_BoardWidth">
<span<?php echo $bill_board_delete->BoardWidth->viewAttributes() ?>><?php echo $bill_board_delete->BoardWidth->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_delete->BoardSize->Visible) { // BoardSize ?>
		<td <?php echo $bill_board_delete->BoardSize->cellAttributes() ?>>
<span id="el<?php echo $bill_board_delete->RowCount ?>_bill_board_BoardSize" class="bill_board_BoardSize">
<span<?php echo $bill_board_delete->BoardSize->viewAttributes() ?>><?php echo $bill_board_delete->BoardSize->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_delete->BoardType->Visible) { // BoardType ?>
		<td <?php echo $bill_board_delete->BoardType->cellAttributes() ?>>
<span id="el<?php echo $bill_board_delete->RowCount ?>_bill_board_BoardType" class="bill_board_BoardType">
<span<?php echo $bill_board_delete->BoardType->viewAttributes() ?>><?php echo $bill_board_delete->BoardType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_delete->BoardLocation->Visible) { // BoardLocation ?>
		<td <?php echo $bill_board_delete->BoardLocation->cellAttributes() ?>>
<span id="el<?php echo $bill_board_delete->RowCount ?>_bill_board_BoardLocation" class="bill_board_BoardLocation">
<span<?php echo $bill_board_delete->BoardLocation->viewAttributes() ?>><?php echo $bill_board_delete->BoardLocation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_delete->BoardStatus->Visible) { // BoardStatus ?>
		<td <?php echo $bill_board_delete->BoardStatus->cellAttributes() ?>>
<span id="el<?php echo $bill_board_delete->RowCount ?>_bill_board_BoardStatus" class="bill_board_BoardStatus">
<span<?php echo $bill_board_delete->BoardStatus->viewAttributes() ?>><?php echo $bill_board_delete->BoardStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_delete->ExemptCode->Visible) { // ExemptCode ?>
		<td <?php echo $bill_board_delete->ExemptCode->cellAttributes() ?>>
<span id="el<?php echo $bill_board_delete->RowCount ?>_bill_board_ExemptCode" class="bill_board_ExemptCode">
<span<?php echo $bill_board_delete->ExemptCode->viewAttributes() ?>><?php echo $bill_board_delete->ExemptCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_delete->StreetAddress->Visible) { // StreetAddress ?>
		<td <?php echo $bill_board_delete->StreetAddress->cellAttributes() ?>>
<span id="el<?php echo $bill_board_delete->RowCount ?>_bill_board_StreetAddress" class="bill_board_StreetAddress">
<span<?php echo $bill_board_delete->StreetAddress->viewAttributes() ?>><?php echo $bill_board_delete->StreetAddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_delete->Longitude->Visible) { // Longitude ?>
		<td <?php echo $bill_board_delete->Longitude->cellAttributes() ?>>
<span id="el<?php echo $bill_board_delete->RowCount ?>_bill_board_Longitude" class="bill_board_Longitude">
<span<?php echo $bill_board_delete->Longitude->viewAttributes() ?>><?php echo $bill_board_delete->Longitude->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_delete->Latitude->Visible) { // Latitude ?>
		<td <?php echo $bill_board_delete->Latitude->cellAttributes() ?>>
<span id="el<?php echo $bill_board_delete->RowCount ?>_bill_board_Latitude" class="bill_board_Latitude">
<span<?php echo $bill_board_delete->Latitude->viewAttributes() ?>><?php echo $bill_board_delete->Latitude->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_delete->Incumberance->Visible) { // Incumberance ?>
		<td <?php echo $bill_board_delete->Incumberance->cellAttributes() ?>>
<span id="el<?php echo $bill_board_delete->RowCount ?>_bill_board_Incumberance" class="bill_board_Incumberance">
<span<?php echo $bill_board_delete->Incumberance->viewAttributes() ?>><?php echo $bill_board_delete->Incumberance->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_delete->StartDate->Visible) { // StartDate ?>
		<td <?php echo $bill_board_delete->StartDate->cellAttributes() ?>>
<span id="el<?php echo $bill_board_delete->RowCount ?>_bill_board_StartDate" class="bill_board_StartDate">
<span<?php echo $bill_board_delete->StartDate->viewAttributes() ?>><?php echo $bill_board_delete->StartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_delete->EndDate->Visible) { // EndDate ?>
		<td <?php echo $bill_board_delete->EndDate->cellAttributes() ?>>
<span id="el<?php echo $bill_board_delete->RowCount ?>_bill_board_EndDate" class="bill_board_EndDate">
<span<?php echo $bill_board_delete->EndDate->viewAttributes() ?>><?php echo $bill_board_delete->EndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$bill_board_delete->Recordset->moveNext();
}
$bill_board_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $bill_board_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$bill_board_delete->showPageFooter();
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
$bill_board_delete->terminate();
?>