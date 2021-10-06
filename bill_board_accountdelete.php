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
$bill_board_account_delete = new bill_board_account_delete();

// Run the page
$bill_board_account_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bill_board_account_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbill_board_accountdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fbill_board_accountdelete = currentForm = new ew.Form("fbill_board_accountdelete", "delete");
	loadjs.done("fbill_board_accountdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $bill_board_account_delete->showPageHeader(); ?>
<?php
$bill_board_account_delete->showMessage();
?>
<form name="fbill_board_accountdelete" id="fbill_board_accountdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bill_board_account">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($bill_board_account_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($bill_board_account_delete->AccountNo->Visible) { // AccountNo ?>
		<th class="<?php echo $bill_board_account_delete->AccountNo->headerCellClass() ?>"><span id="elh_bill_board_account_AccountNo" class="bill_board_account_AccountNo"><?php echo $bill_board_account_delete->AccountNo->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_account_delete->BillBoardNo->Visible) { // BillBoardNo ?>
		<th class="<?php echo $bill_board_account_delete->BillBoardNo->headerCellClass() ?>"><span id="elh_bill_board_account_BillBoardNo" class="bill_board_account_BillBoardNo"><?php echo $bill_board_account_delete->BillBoardNo->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_account_delete->ClientID->Visible) { // ClientID ?>
		<th class="<?php echo $bill_board_account_delete->ClientID->headerCellClass() ?>"><span id="elh_bill_board_account_ClientID" class="bill_board_account_ClientID"><?php echo $bill_board_account_delete->ClientID->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_account_delete->BalanceBF->Visible) { // BalanceBF ?>
		<th class="<?php echo $bill_board_account_delete->BalanceBF->headerCellClass() ?>"><span id="elh_bill_board_account_BalanceBF" class="bill_board_account_BalanceBF"><?php echo $bill_board_account_delete->BalanceBF->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_account_delete->CurrentDemand->Visible) { // CurrentDemand ?>
		<th class="<?php echo $bill_board_account_delete->CurrentDemand->headerCellClass() ?>"><span id="elh_bill_board_account_CurrentDemand" class="bill_board_account_CurrentDemand"><?php echo $bill_board_account_delete->CurrentDemand->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_account_delete->VAT->Visible) { // VAT ?>
		<th class="<?php echo $bill_board_account_delete->VAT->headerCellClass() ?>"><span id="elh_bill_board_account_VAT" class="bill_board_account_VAT"><?php echo $bill_board_account_delete->VAT->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_account_delete->AmountPaid->Visible) { // AmountPaid ?>
		<th class="<?php echo $bill_board_account_delete->AmountPaid->headerCellClass() ?>"><span id="elh_bill_board_account_AmountPaid" class="bill_board_account_AmountPaid"><?php echo $bill_board_account_delete->AmountPaid->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_account_delete->BillPeriod->Visible) { // BillPeriod ?>
		<th class="<?php echo $bill_board_account_delete->BillPeriod->headerCellClass() ?>"><span id="elh_bill_board_account_BillPeriod" class="bill_board_account_BillPeriod"><?php echo $bill_board_account_delete->BillPeriod->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_account_delete->PeriodType->Visible) { // PeriodType ?>
		<th class="<?php echo $bill_board_account_delete->PeriodType->headerCellClass() ?>"><span id="elh_bill_board_account_PeriodType" class="bill_board_account_PeriodType"><?php echo $bill_board_account_delete->PeriodType->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_account_delete->BillYear->Visible) { // BillYear ?>
		<th class="<?php echo $bill_board_account_delete->BillYear->headerCellClass() ?>"><span id="elh_bill_board_account_BillYear" class="bill_board_account_BillYear"><?php echo $bill_board_account_delete->BillYear->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_account_delete->StartDate->Visible) { // StartDate ?>
		<th class="<?php echo $bill_board_account_delete->StartDate->headerCellClass() ?>"><span id="elh_bill_board_account_StartDate" class="bill_board_account_StartDate"><?php echo $bill_board_account_delete->StartDate->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_account_delete->EndDate->Visible) { // EndDate ?>
		<th class="<?php echo $bill_board_account_delete->EndDate->headerCellClass() ?>"><span id="elh_bill_board_account_EndDate" class="bill_board_account_EndDate"><?php echo $bill_board_account_delete->EndDate->caption() ?></span></th>
<?php } ?>
<?php if ($bill_board_account_delete->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<th class="<?php echo $bill_board_account_delete->LastUpdatedBy->headerCellClass() ?>"><span id="elh_bill_board_account_LastUpdatedBy" class="bill_board_account_LastUpdatedBy"><?php echo $bill_board_account_delete->LastUpdatedBy->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$bill_board_account_delete->RecordCount = 0;
$i = 0;
while (!$bill_board_account_delete->Recordset->EOF) {
	$bill_board_account_delete->RecordCount++;
	$bill_board_account_delete->RowCount++;

	// Set row properties
	$bill_board_account->resetAttributes();
	$bill_board_account->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$bill_board_account_delete->loadRowValues($bill_board_account_delete->Recordset);

	// Render row
	$bill_board_account_delete->renderRow();
?>
	<tr <?php echo $bill_board_account->rowAttributes() ?>>
<?php if ($bill_board_account_delete->AccountNo->Visible) { // AccountNo ?>
		<td <?php echo $bill_board_account_delete->AccountNo->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_delete->RowCount ?>_bill_board_account_AccountNo" class="bill_board_account_AccountNo">
<span<?php echo $bill_board_account_delete->AccountNo->viewAttributes() ?>><?php echo $bill_board_account_delete->AccountNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_account_delete->BillBoardNo->Visible) { // BillBoardNo ?>
		<td <?php echo $bill_board_account_delete->BillBoardNo->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_delete->RowCount ?>_bill_board_account_BillBoardNo" class="bill_board_account_BillBoardNo">
<span<?php echo $bill_board_account_delete->BillBoardNo->viewAttributes() ?>><?php echo $bill_board_account_delete->BillBoardNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_account_delete->ClientID->Visible) { // ClientID ?>
		<td <?php echo $bill_board_account_delete->ClientID->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_delete->RowCount ?>_bill_board_account_ClientID" class="bill_board_account_ClientID">
<span<?php echo $bill_board_account_delete->ClientID->viewAttributes() ?>><?php echo $bill_board_account_delete->ClientID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_account_delete->BalanceBF->Visible) { // BalanceBF ?>
		<td <?php echo $bill_board_account_delete->BalanceBF->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_delete->RowCount ?>_bill_board_account_BalanceBF" class="bill_board_account_BalanceBF">
<span<?php echo $bill_board_account_delete->BalanceBF->viewAttributes() ?>><?php echo $bill_board_account_delete->BalanceBF->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_account_delete->CurrentDemand->Visible) { // CurrentDemand ?>
		<td <?php echo $bill_board_account_delete->CurrentDemand->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_delete->RowCount ?>_bill_board_account_CurrentDemand" class="bill_board_account_CurrentDemand">
<span<?php echo $bill_board_account_delete->CurrentDemand->viewAttributes() ?>><?php echo $bill_board_account_delete->CurrentDemand->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_account_delete->VAT->Visible) { // VAT ?>
		<td <?php echo $bill_board_account_delete->VAT->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_delete->RowCount ?>_bill_board_account_VAT" class="bill_board_account_VAT">
<span<?php echo $bill_board_account_delete->VAT->viewAttributes() ?>><?php echo $bill_board_account_delete->VAT->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_account_delete->AmountPaid->Visible) { // AmountPaid ?>
		<td <?php echo $bill_board_account_delete->AmountPaid->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_delete->RowCount ?>_bill_board_account_AmountPaid" class="bill_board_account_AmountPaid">
<span<?php echo $bill_board_account_delete->AmountPaid->viewAttributes() ?>><?php echo $bill_board_account_delete->AmountPaid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_account_delete->BillPeriod->Visible) { // BillPeriod ?>
		<td <?php echo $bill_board_account_delete->BillPeriod->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_delete->RowCount ?>_bill_board_account_BillPeriod" class="bill_board_account_BillPeriod">
<span<?php echo $bill_board_account_delete->BillPeriod->viewAttributes() ?>><?php echo $bill_board_account_delete->BillPeriod->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_account_delete->PeriodType->Visible) { // PeriodType ?>
		<td <?php echo $bill_board_account_delete->PeriodType->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_delete->RowCount ?>_bill_board_account_PeriodType" class="bill_board_account_PeriodType">
<span<?php echo $bill_board_account_delete->PeriodType->viewAttributes() ?>><?php echo $bill_board_account_delete->PeriodType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_account_delete->BillYear->Visible) { // BillYear ?>
		<td <?php echo $bill_board_account_delete->BillYear->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_delete->RowCount ?>_bill_board_account_BillYear" class="bill_board_account_BillYear">
<span<?php echo $bill_board_account_delete->BillYear->viewAttributes() ?>><?php echo $bill_board_account_delete->BillYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_account_delete->StartDate->Visible) { // StartDate ?>
		<td <?php echo $bill_board_account_delete->StartDate->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_delete->RowCount ?>_bill_board_account_StartDate" class="bill_board_account_StartDate">
<span<?php echo $bill_board_account_delete->StartDate->viewAttributes() ?>><?php echo $bill_board_account_delete->StartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_account_delete->EndDate->Visible) { // EndDate ?>
		<td <?php echo $bill_board_account_delete->EndDate->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_delete->RowCount ?>_bill_board_account_EndDate" class="bill_board_account_EndDate">
<span<?php echo $bill_board_account_delete->EndDate->viewAttributes() ?>><?php echo $bill_board_account_delete->EndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board_account_delete->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td <?php echo $bill_board_account_delete->LastUpdatedBy->cellAttributes() ?>>
<span id="el<?php echo $bill_board_account_delete->RowCount ?>_bill_board_account_LastUpdatedBy" class="bill_board_account_LastUpdatedBy">
<span<?php echo $bill_board_account_delete->LastUpdatedBy->viewAttributes() ?>><?php echo $bill_board_account_delete->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$bill_board_account_delete->Recordset->moveNext();
}
$bill_board_account_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $bill_board_account_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$bill_board_account_delete->showPageFooter();
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
$bill_board_account_delete->terminate();
?>