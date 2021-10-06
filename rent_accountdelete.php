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
$rent_account_delete = new rent_account_delete();

// Run the page
$rent_account_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rent_account_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var frent_accountdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	frent_accountdelete = currentForm = new ew.Form("frent_accountdelete", "delete");
	loadjs.done("frent_accountdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $rent_account_delete->showPageHeader(); ?>
<?php
$rent_account_delete->showMessage();
?>
<form name="frent_accountdelete" id="frent_accountdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rent_account">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($rent_account_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($rent_account_delete->AccountNo->Visible) { // AccountNo ?>
		<th class="<?php echo $rent_account_delete->AccountNo->headerCellClass() ?>"><span id="elh_rent_account_AccountNo" class="rent_account_AccountNo"><?php echo $rent_account_delete->AccountNo->caption() ?></span></th>
<?php } ?>
<?php if ($rent_account_delete->PropertyNo->Visible) { // PropertyNo ?>
		<th class="<?php echo $rent_account_delete->PropertyNo->headerCellClass() ?>"><span id="elh_rent_account_PropertyNo" class="rent_account_PropertyNo"><?php echo $rent_account_delete->PropertyNo->caption() ?></span></th>
<?php } ?>
<?php if ($rent_account_delete->ClientSerNo->Visible) { // ClientSerNo ?>
		<th class="<?php echo $rent_account_delete->ClientSerNo->headerCellClass() ?>"><span id="elh_rent_account_ClientSerNo" class="rent_account_ClientSerNo"><?php echo $rent_account_delete->ClientSerNo->caption() ?></span></th>
<?php } ?>
<?php if ($rent_account_delete->ClientID->Visible) { // ClientID ?>
		<th class="<?php echo $rent_account_delete->ClientID->headerCellClass() ?>"><span id="elh_rent_account_ClientID" class="rent_account_ClientID"><?php echo $rent_account_delete->ClientID->caption() ?></span></th>
<?php } ?>
<?php if ($rent_account_delete->ChargeCode->Visible) { // ChargeCode ?>
		<th class="<?php echo $rent_account_delete->ChargeCode->headerCellClass() ?>"><span id="elh_rent_account_ChargeCode" class="rent_account_ChargeCode"><?php echo $rent_account_delete->ChargeCode->caption() ?></span></th>
<?php } ?>
<?php if ($rent_account_delete->ChargeGroup->Visible) { // ChargeGroup ?>
		<th class="<?php echo $rent_account_delete->ChargeGroup->headerCellClass() ?>"><span id="elh_rent_account_ChargeGroup" class="rent_account_ChargeGroup"><?php echo $rent_account_delete->ChargeGroup->caption() ?></span></th>
<?php } ?>
<?php if ($rent_account_delete->Securitydeposit->Visible) { // Securitydeposit ?>
		<th class="<?php echo $rent_account_delete->Securitydeposit->headerCellClass() ?>"><span id="elh_rent_account_Securitydeposit" class="rent_account_Securitydeposit"><?php echo $rent_account_delete->Securitydeposit->caption() ?></span></th>
<?php } ?>
<?php if ($rent_account_delete->BalanceBF->Visible) { // BalanceBF ?>
		<th class="<?php echo $rent_account_delete->BalanceBF->headerCellClass() ?>"><span id="elh_rent_account_BalanceBF" class="rent_account_BalanceBF"><?php echo $rent_account_delete->BalanceBF->caption() ?></span></th>
<?php } ?>
<?php if ($rent_account_delete->CurrentDemand->Visible) { // CurrentDemand ?>
		<th class="<?php echo $rent_account_delete->CurrentDemand->headerCellClass() ?>"><span id="elh_rent_account_CurrentDemand" class="rent_account_CurrentDemand"><?php echo $rent_account_delete->CurrentDemand->caption() ?></span></th>
<?php } ?>
<?php if ($rent_account_delete->VAT->Visible) { // VAT ?>
		<th class="<?php echo $rent_account_delete->VAT->headerCellClass() ?>"><span id="elh_rent_account_VAT" class="rent_account_VAT"><?php echo $rent_account_delete->VAT->caption() ?></span></th>
<?php } ?>
<?php if ($rent_account_delete->AmountPaid->Visible) { // AmountPaid ?>
		<th class="<?php echo $rent_account_delete->AmountPaid->headerCellClass() ?>"><span id="elh_rent_account_AmountPaid" class="rent_account_AmountPaid"><?php echo $rent_account_delete->AmountPaid->caption() ?></span></th>
<?php } ?>
<?php if ($rent_account_delete->BillPeriod->Visible) { // BillPeriod ?>
		<th class="<?php echo $rent_account_delete->BillPeriod->headerCellClass() ?>"><span id="elh_rent_account_BillPeriod" class="rent_account_BillPeriod"><?php echo $rent_account_delete->BillPeriod->caption() ?></span></th>
<?php } ?>
<?php if ($rent_account_delete->PeriodType->Visible) { // PeriodType ?>
		<th class="<?php echo $rent_account_delete->PeriodType->headerCellClass() ?>"><span id="elh_rent_account_PeriodType" class="rent_account_PeriodType"><?php echo $rent_account_delete->PeriodType->caption() ?></span></th>
<?php } ?>
<?php if ($rent_account_delete->BillYear->Visible) { // BillYear ?>
		<th class="<?php echo $rent_account_delete->BillYear->headerCellClass() ?>"><span id="elh_rent_account_BillYear" class="rent_account_BillYear"><?php echo $rent_account_delete->BillYear->caption() ?></span></th>
<?php } ?>
<?php if ($rent_account_delete->StartDate->Visible) { // StartDate ?>
		<th class="<?php echo $rent_account_delete->StartDate->headerCellClass() ?>"><span id="elh_rent_account_StartDate" class="rent_account_StartDate"><?php echo $rent_account_delete->StartDate->caption() ?></span></th>
<?php } ?>
<?php if ($rent_account_delete->EndDate->Visible) { // EndDate ?>
		<th class="<?php echo $rent_account_delete->EndDate->headerCellClass() ?>"><span id="elh_rent_account_EndDate" class="rent_account_EndDate"><?php echo $rent_account_delete->EndDate->caption() ?></span></th>
<?php } ?>
<?php if ($rent_account_delete->LeaseDesc->Visible) { // LeaseDesc ?>
		<th class="<?php echo $rent_account_delete->LeaseDesc->headerCellClass() ?>"><span id="elh_rent_account_LeaseDesc" class="rent_account_LeaseDesc"><?php echo $rent_account_delete->LeaseDesc->caption() ?></span></th>
<?php } ?>
<?php if ($rent_account_delete->Rent->Visible) { // Rent ?>
		<th class="<?php echo $rent_account_delete->Rent->headerCellClass() ?>"><span id="elh_rent_account_Rent" class="rent_account_Rent"><?php echo $rent_account_delete->Rent->caption() ?></span></th>
<?php } ?>
<?php if ($rent_account_delete->Period_type->Visible) { // Period_type ?>
		<th class="<?php echo $rent_account_delete->Period_type->headerCellClass() ?>"><span id="elh_rent_account_Period_type" class="rent_account_Period_type"><?php echo $rent_account_delete->Period_type->caption() ?></span></th>
<?php } ?>
<?php if ($rent_account_delete->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<th class="<?php echo $rent_account_delete->LastUpdatedBy->headerCellClass() ?>"><span id="elh_rent_account_LastUpdatedBy" class="rent_account_LastUpdatedBy"><?php echo $rent_account_delete->LastUpdatedBy->caption() ?></span></th>
<?php } ?>
<?php if ($rent_account_delete->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<th class="<?php echo $rent_account_delete->LastUpdateDate->headerCellClass() ?>"><span id="elh_rent_account_LastUpdateDate" class="rent_account_LastUpdateDate"><?php echo $rent_account_delete->LastUpdateDate->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$rent_account_delete->RecordCount = 0;
$i = 0;
while (!$rent_account_delete->Recordset->EOF) {
	$rent_account_delete->RecordCount++;
	$rent_account_delete->RowCount++;

	// Set row properties
	$rent_account->resetAttributes();
	$rent_account->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$rent_account_delete->loadRowValues($rent_account_delete->Recordset);

	// Render row
	$rent_account_delete->renderRow();
?>
	<tr <?php echo $rent_account->rowAttributes() ?>>
<?php if ($rent_account_delete->AccountNo->Visible) { // AccountNo ?>
		<td <?php echo $rent_account_delete->AccountNo->cellAttributes() ?>>
<span id="el<?php echo $rent_account_delete->RowCount ?>_rent_account_AccountNo" class="rent_account_AccountNo">
<span<?php echo $rent_account_delete->AccountNo->viewAttributes() ?>><?php echo $rent_account_delete->AccountNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rent_account_delete->PropertyNo->Visible) { // PropertyNo ?>
		<td <?php echo $rent_account_delete->PropertyNo->cellAttributes() ?>>
<span id="el<?php echo $rent_account_delete->RowCount ?>_rent_account_PropertyNo" class="rent_account_PropertyNo">
<span<?php echo $rent_account_delete->PropertyNo->viewAttributes() ?>><?php echo $rent_account_delete->PropertyNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rent_account_delete->ClientSerNo->Visible) { // ClientSerNo ?>
		<td <?php echo $rent_account_delete->ClientSerNo->cellAttributes() ?>>
<span id="el<?php echo $rent_account_delete->RowCount ?>_rent_account_ClientSerNo" class="rent_account_ClientSerNo">
<span<?php echo $rent_account_delete->ClientSerNo->viewAttributes() ?>><?php echo $rent_account_delete->ClientSerNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rent_account_delete->ClientID->Visible) { // ClientID ?>
		<td <?php echo $rent_account_delete->ClientID->cellAttributes() ?>>
<span id="el<?php echo $rent_account_delete->RowCount ?>_rent_account_ClientID" class="rent_account_ClientID">
<span<?php echo $rent_account_delete->ClientID->viewAttributes() ?>><?php echo $rent_account_delete->ClientID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rent_account_delete->ChargeCode->Visible) { // ChargeCode ?>
		<td <?php echo $rent_account_delete->ChargeCode->cellAttributes() ?>>
<span id="el<?php echo $rent_account_delete->RowCount ?>_rent_account_ChargeCode" class="rent_account_ChargeCode">
<span<?php echo $rent_account_delete->ChargeCode->viewAttributes() ?>><?php echo $rent_account_delete->ChargeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rent_account_delete->ChargeGroup->Visible) { // ChargeGroup ?>
		<td <?php echo $rent_account_delete->ChargeGroup->cellAttributes() ?>>
<span id="el<?php echo $rent_account_delete->RowCount ?>_rent_account_ChargeGroup" class="rent_account_ChargeGroup">
<span<?php echo $rent_account_delete->ChargeGroup->viewAttributes() ?>><?php echo $rent_account_delete->ChargeGroup->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rent_account_delete->Securitydeposit->Visible) { // Securitydeposit ?>
		<td <?php echo $rent_account_delete->Securitydeposit->cellAttributes() ?>>
<span id="el<?php echo $rent_account_delete->RowCount ?>_rent_account_Securitydeposit" class="rent_account_Securitydeposit">
<span<?php echo $rent_account_delete->Securitydeposit->viewAttributes() ?>><?php echo $rent_account_delete->Securitydeposit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rent_account_delete->BalanceBF->Visible) { // BalanceBF ?>
		<td <?php echo $rent_account_delete->BalanceBF->cellAttributes() ?>>
<span id="el<?php echo $rent_account_delete->RowCount ?>_rent_account_BalanceBF" class="rent_account_BalanceBF">
<span<?php echo $rent_account_delete->BalanceBF->viewAttributes() ?>><?php echo $rent_account_delete->BalanceBF->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rent_account_delete->CurrentDemand->Visible) { // CurrentDemand ?>
		<td <?php echo $rent_account_delete->CurrentDemand->cellAttributes() ?>>
<span id="el<?php echo $rent_account_delete->RowCount ?>_rent_account_CurrentDemand" class="rent_account_CurrentDemand">
<span<?php echo $rent_account_delete->CurrentDemand->viewAttributes() ?>><?php echo $rent_account_delete->CurrentDemand->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rent_account_delete->VAT->Visible) { // VAT ?>
		<td <?php echo $rent_account_delete->VAT->cellAttributes() ?>>
<span id="el<?php echo $rent_account_delete->RowCount ?>_rent_account_VAT" class="rent_account_VAT">
<span<?php echo $rent_account_delete->VAT->viewAttributes() ?>><?php echo $rent_account_delete->VAT->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rent_account_delete->AmountPaid->Visible) { // AmountPaid ?>
		<td <?php echo $rent_account_delete->AmountPaid->cellAttributes() ?>>
<span id="el<?php echo $rent_account_delete->RowCount ?>_rent_account_AmountPaid" class="rent_account_AmountPaid">
<span<?php echo $rent_account_delete->AmountPaid->viewAttributes() ?>><?php echo $rent_account_delete->AmountPaid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rent_account_delete->BillPeriod->Visible) { // BillPeriod ?>
		<td <?php echo $rent_account_delete->BillPeriod->cellAttributes() ?>>
<span id="el<?php echo $rent_account_delete->RowCount ?>_rent_account_BillPeriod" class="rent_account_BillPeriod">
<span<?php echo $rent_account_delete->BillPeriod->viewAttributes() ?>><?php echo $rent_account_delete->BillPeriod->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rent_account_delete->PeriodType->Visible) { // PeriodType ?>
		<td <?php echo $rent_account_delete->PeriodType->cellAttributes() ?>>
<span id="el<?php echo $rent_account_delete->RowCount ?>_rent_account_PeriodType" class="rent_account_PeriodType">
<span<?php echo $rent_account_delete->PeriodType->viewAttributes() ?>><?php echo $rent_account_delete->PeriodType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rent_account_delete->BillYear->Visible) { // BillYear ?>
		<td <?php echo $rent_account_delete->BillYear->cellAttributes() ?>>
<span id="el<?php echo $rent_account_delete->RowCount ?>_rent_account_BillYear" class="rent_account_BillYear">
<span<?php echo $rent_account_delete->BillYear->viewAttributes() ?>><?php echo $rent_account_delete->BillYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rent_account_delete->StartDate->Visible) { // StartDate ?>
		<td <?php echo $rent_account_delete->StartDate->cellAttributes() ?>>
<span id="el<?php echo $rent_account_delete->RowCount ?>_rent_account_StartDate" class="rent_account_StartDate">
<span<?php echo $rent_account_delete->StartDate->viewAttributes() ?>><?php echo $rent_account_delete->StartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rent_account_delete->EndDate->Visible) { // EndDate ?>
		<td <?php echo $rent_account_delete->EndDate->cellAttributes() ?>>
<span id="el<?php echo $rent_account_delete->RowCount ?>_rent_account_EndDate" class="rent_account_EndDate">
<span<?php echo $rent_account_delete->EndDate->viewAttributes() ?>><?php echo $rent_account_delete->EndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rent_account_delete->LeaseDesc->Visible) { // LeaseDesc ?>
		<td <?php echo $rent_account_delete->LeaseDesc->cellAttributes() ?>>
<span id="el<?php echo $rent_account_delete->RowCount ?>_rent_account_LeaseDesc" class="rent_account_LeaseDesc">
<span<?php echo $rent_account_delete->LeaseDesc->viewAttributes() ?>><?php echo $rent_account_delete->LeaseDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rent_account_delete->Rent->Visible) { // Rent ?>
		<td <?php echo $rent_account_delete->Rent->cellAttributes() ?>>
<span id="el<?php echo $rent_account_delete->RowCount ?>_rent_account_Rent" class="rent_account_Rent">
<span<?php echo $rent_account_delete->Rent->viewAttributes() ?>><?php echo $rent_account_delete->Rent->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rent_account_delete->Period_type->Visible) { // Period_type ?>
		<td <?php echo $rent_account_delete->Period_type->cellAttributes() ?>>
<span id="el<?php echo $rent_account_delete->RowCount ?>_rent_account_Period_type" class="rent_account_Period_type">
<span<?php echo $rent_account_delete->Period_type->viewAttributes() ?>><?php echo $rent_account_delete->Period_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rent_account_delete->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td <?php echo $rent_account_delete->LastUpdatedBy->cellAttributes() ?>>
<span id="el<?php echo $rent_account_delete->RowCount ?>_rent_account_LastUpdatedBy" class="rent_account_LastUpdatedBy">
<span<?php echo $rent_account_delete->LastUpdatedBy->viewAttributes() ?>><?php echo $rent_account_delete->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rent_account_delete->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td <?php echo $rent_account_delete->LastUpdateDate->cellAttributes() ?>>
<span id="el<?php echo $rent_account_delete->RowCount ?>_rent_account_LastUpdateDate" class="rent_account_LastUpdateDate">
<span<?php echo $rent_account_delete->LastUpdateDate->viewAttributes() ?>><?php echo $rent_account_delete->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$rent_account_delete->Recordset->moveNext();
}
$rent_account_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $rent_account_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$rent_account_delete->showPageFooter();
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
$rent_account_delete->terminate();
?>