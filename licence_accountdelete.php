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
$licence_account_delete = new licence_account_delete();

// Run the page
$licence_account_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$licence_account_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var flicence_accountdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	flicence_accountdelete = currentForm = new ew.Form("flicence_accountdelete", "delete");
	loadjs.done("flicence_accountdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $licence_account_delete->showPageHeader(); ?>
<?php
$licence_account_delete->showMessage();
?>
<form name="flicence_accountdelete" id="flicence_accountdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="licence_account">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($licence_account_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($licence_account_delete->LicenceNo->Visible) { // LicenceNo ?>
		<th class="<?php echo $licence_account_delete->LicenceNo->headerCellClass() ?>"><span id="elh_licence_account_LicenceNo" class="licence_account_LicenceNo"><?php echo $licence_account_delete->LicenceNo->caption() ?></span></th>
<?php } ?>
<?php if ($licence_account_delete->BusinessNo->Visible) { // BusinessNo ?>
		<th class="<?php echo $licence_account_delete->BusinessNo->headerCellClass() ?>"><span id="elh_licence_account_BusinessNo" class="licence_account_BusinessNo"><?php echo $licence_account_delete->BusinessNo->caption() ?></span></th>
<?php } ?>
<?php if ($licence_account_delete->ClientID->Visible) { // ClientID ?>
		<th class="<?php echo $licence_account_delete->ClientID->headerCellClass() ?>"><span id="elh_licence_account_ClientID" class="licence_account_ClientID"><?php echo $licence_account_delete->ClientID->caption() ?></span></th>
<?php } ?>
<?php if ($licence_account_delete->ChargeCode->Visible) { // ChargeCode ?>
		<th class="<?php echo $licence_account_delete->ChargeCode->headerCellClass() ?>"><span id="elh_licence_account_ChargeCode" class="licence_account_ChargeCode"><?php echo $licence_account_delete->ChargeCode->caption() ?></span></th>
<?php } ?>
<?php if ($licence_account_delete->ChargeGroup->Visible) { // ChargeGroup ?>
		<th class="<?php echo $licence_account_delete->ChargeGroup->headerCellClass() ?>"><span id="elh_licence_account_ChargeGroup" class="licence_account_ChargeGroup"><?php echo $licence_account_delete->ChargeGroup->caption() ?></span></th>
<?php } ?>
<?php if ($licence_account_delete->BalanceBF->Visible) { // BalanceBF ?>
		<th class="<?php echo $licence_account_delete->BalanceBF->headerCellClass() ?>"><span id="elh_licence_account_BalanceBF" class="licence_account_BalanceBF"><?php echo $licence_account_delete->BalanceBF->caption() ?></span></th>
<?php } ?>
<?php if ($licence_account_delete->CurrentDemand->Visible) { // CurrentDemand ?>
		<th class="<?php echo $licence_account_delete->CurrentDemand->headerCellClass() ?>"><span id="elh_licence_account_CurrentDemand" class="licence_account_CurrentDemand"><?php echo $licence_account_delete->CurrentDemand->caption() ?></span></th>
<?php } ?>
<?php if ($licence_account_delete->VAT->Visible) { // VAT ?>
		<th class="<?php echo $licence_account_delete->VAT->headerCellClass() ?>"><span id="elh_licence_account_VAT" class="licence_account_VAT"><?php echo $licence_account_delete->VAT->caption() ?></span></th>
<?php } ?>
<?php if ($licence_account_delete->AmountPaid->Visible) { // AmountPaid ?>
		<th class="<?php echo $licence_account_delete->AmountPaid->headerCellClass() ?>"><span id="elh_licence_account_AmountPaid" class="licence_account_AmountPaid"><?php echo $licence_account_delete->AmountPaid->caption() ?></span></th>
<?php } ?>
<?php if ($licence_account_delete->BillPeriod->Visible) { // BillPeriod ?>
		<th class="<?php echo $licence_account_delete->BillPeriod->headerCellClass() ?>"><span id="elh_licence_account_BillPeriod" class="licence_account_BillPeriod"><?php echo $licence_account_delete->BillPeriod->caption() ?></span></th>
<?php } ?>
<?php if ($licence_account_delete->PeriodType->Visible) { // PeriodType ?>
		<th class="<?php echo $licence_account_delete->PeriodType->headerCellClass() ?>"><span id="elh_licence_account_PeriodType" class="licence_account_PeriodType"><?php echo $licence_account_delete->PeriodType->caption() ?></span></th>
<?php } ?>
<?php if ($licence_account_delete->BillYear->Visible) { // BillYear ?>
		<th class="<?php echo $licence_account_delete->BillYear->headerCellClass() ?>"><span id="elh_licence_account_BillYear" class="licence_account_BillYear"><?php echo $licence_account_delete->BillYear->caption() ?></span></th>
<?php } ?>
<?php if ($licence_account_delete->StartDate->Visible) { // StartDate ?>
		<th class="<?php echo $licence_account_delete->StartDate->headerCellClass() ?>"><span id="elh_licence_account_StartDate" class="licence_account_StartDate"><?php echo $licence_account_delete->StartDate->caption() ?></span></th>
<?php } ?>
<?php if ($licence_account_delete->EndDate->Visible) { // EndDate ?>
		<th class="<?php echo $licence_account_delete->EndDate->headerCellClass() ?>"><span id="elh_licence_account_EndDate" class="licence_account_EndDate"><?php echo $licence_account_delete->EndDate->caption() ?></span></th>
<?php } ?>
<?php if ($licence_account_delete->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<th class="<?php echo $licence_account_delete->LastUpdatedBy->headerCellClass() ?>"><span id="elh_licence_account_LastUpdatedBy" class="licence_account_LastUpdatedBy"><?php echo $licence_account_delete->LastUpdatedBy->caption() ?></span></th>
<?php } ?>
<?php if ($licence_account_delete->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<th class="<?php echo $licence_account_delete->LastUpdateDate->headerCellClass() ?>"><span id="elh_licence_account_LastUpdateDate" class="licence_account_LastUpdateDate"><?php echo $licence_account_delete->LastUpdateDate->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$licence_account_delete->RecordCount = 0;
$i = 0;
while (!$licence_account_delete->Recordset->EOF) {
	$licence_account_delete->RecordCount++;
	$licence_account_delete->RowCount++;

	// Set row properties
	$licence_account->resetAttributes();
	$licence_account->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$licence_account_delete->loadRowValues($licence_account_delete->Recordset);

	// Render row
	$licence_account_delete->renderRow();
?>
	<tr <?php echo $licence_account->rowAttributes() ?>>
<?php if ($licence_account_delete->LicenceNo->Visible) { // LicenceNo ?>
		<td <?php echo $licence_account_delete->LicenceNo->cellAttributes() ?>>
<span id="el<?php echo $licence_account_delete->RowCount ?>_licence_account_LicenceNo" class="licence_account_LicenceNo">
<span<?php echo $licence_account_delete->LicenceNo->viewAttributes() ?>><?php echo $licence_account_delete->LicenceNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account_delete->BusinessNo->Visible) { // BusinessNo ?>
		<td <?php echo $licence_account_delete->BusinessNo->cellAttributes() ?>>
<span id="el<?php echo $licence_account_delete->RowCount ?>_licence_account_BusinessNo" class="licence_account_BusinessNo">
<span<?php echo $licence_account_delete->BusinessNo->viewAttributes() ?>><?php echo $licence_account_delete->BusinessNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account_delete->ClientID->Visible) { // ClientID ?>
		<td <?php echo $licence_account_delete->ClientID->cellAttributes() ?>>
<span id="el<?php echo $licence_account_delete->RowCount ?>_licence_account_ClientID" class="licence_account_ClientID">
<span<?php echo $licence_account_delete->ClientID->viewAttributes() ?>><?php echo $licence_account_delete->ClientID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account_delete->ChargeCode->Visible) { // ChargeCode ?>
		<td <?php echo $licence_account_delete->ChargeCode->cellAttributes() ?>>
<span id="el<?php echo $licence_account_delete->RowCount ?>_licence_account_ChargeCode" class="licence_account_ChargeCode">
<span<?php echo $licence_account_delete->ChargeCode->viewAttributes() ?>><?php echo $licence_account_delete->ChargeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account_delete->ChargeGroup->Visible) { // ChargeGroup ?>
		<td <?php echo $licence_account_delete->ChargeGroup->cellAttributes() ?>>
<span id="el<?php echo $licence_account_delete->RowCount ?>_licence_account_ChargeGroup" class="licence_account_ChargeGroup">
<span<?php echo $licence_account_delete->ChargeGroup->viewAttributes() ?>><?php echo $licence_account_delete->ChargeGroup->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account_delete->BalanceBF->Visible) { // BalanceBF ?>
		<td <?php echo $licence_account_delete->BalanceBF->cellAttributes() ?>>
<span id="el<?php echo $licence_account_delete->RowCount ?>_licence_account_BalanceBF" class="licence_account_BalanceBF">
<span<?php echo $licence_account_delete->BalanceBF->viewAttributes() ?>><?php echo $licence_account_delete->BalanceBF->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account_delete->CurrentDemand->Visible) { // CurrentDemand ?>
		<td <?php echo $licence_account_delete->CurrentDemand->cellAttributes() ?>>
<span id="el<?php echo $licence_account_delete->RowCount ?>_licence_account_CurrentDemand" class="licence_account_CurrentDemand">
<span<?php echo $licence_account_delete->CurrentDemand->viewAttributes() ?>><?php echo $licence_account_delete->CurrentDemand->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account_delete->VAT->Visible) { // VAT ?>
		<td <?php echo $licence_account_delete->VAT->cellAttributes() ?>>
<span id="el<?php echo $licence_account_delete->RowCount ?>_licence_account_VAT" class="licence_account_VAT">
<span<?php echo $licence_account_delete->VAT->viewAttributes() ?>><?php echo $licence_account_delete->VAT->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account_delete->AmountPaid->Visible) { // AmountPaid ?>
		<td <?php echo $licence_account_delete->AmountPaid->cellAttributes() ?>>
<span id="el<?php echo $licence_account_delete->RowCount ?>_licence_account_AmountPaid" class="licence_account_AmountPaid">
<span<?php echo $licence_account_delete->AmountPaid->viewAttributes() ?>><?php echo $licence_account_delete->AmountPaid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account_delete->BillPeriod->Visible) { // BillPeriod ?>
		<td <?php echo $licence_account_delete->BillPeriod->cellAttributes() ?>>
<span id="el<?php echo $licence_account_delete->RowCount ?>_licence_account_BillPeriod" class="licence_account_BillPeriod">
<span<?php echo $licence_account_delete->BillPeriod->viewAttributes() ?>><?php echo $licence_account_delete->BillPeriod->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account_delete->PeriodType->Visible) { // PeriodType ?>
		<td <?php echo $licence_account_delete->PeriodType->cellAttributes() ?>>
<span id="el<?php echo $licence_account_delete->RowCount ?>_licence_account_PeriodType" class="licence_account_PeriodType">
<span<?php echo $licence_account_delete->PeriodType->viewAttributes() ?>><?php echo $licence_account_delete->PeriodType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account_delete->BillYear->Visible) { // BillYear ?>
		<td <?php echo $licence_account_delete->BillYear->cellAttributes() ?>>
<span id="el<?php echo $licence_account_delete->RowCount ?>_licence_account_BillYear" class="licence_account_BillYear">
<span<?php echo $licence_account_delete->BillYear->viewAttributes() ?>><?php echo $licence_account_delete->BillYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account_delete->StartDate->Visible) { // StartDate ?>
		<td <?php echo $licence_account_delete->StartDate->cellAttributes() ?>>
<span id="el<?php echo $licence_account_delete->RowCount ?>_licence_account_StartDate" class="licence_account_StartDate">
<span<?php echo $licence_account_delete->StartDate->viewAttributes() ?>><?php echo $licence_account_delete->StartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account_delete->EndDate->Visible) { // EndDate ?>
		<td <?php echo $licence_account_delete->EndDate->cellAttributes() ?>>
<span id="el<?php echo $licence_account_delete->RowCount ?>_licence_account_EndDate" class="licence_account_EndDate">
<span<?php echo $licence_account_delete->EndDate->viewAttributes() ?>><?php echo $licence_account_delete->EndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account_delete->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td <?php echo $licence_account_delete->LastUpdatedBy->cellAttributes() ?>>
<span id="el<?php echo $licence_account_delete->RowCount ?>_licence_account_LastUpdatedBy" class="licence_account_LastUpdatedBy">
<span<?php echo $licence_account_delete->LastUpdatedBy->viewAttributes() ?>><?php echo $licence_account_delete->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account_delete->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td <?php echo $licence_account_delete->LastUpdateDate->cellAttributes() ?>>
<span id="el<?php echo $licence_account_delete->RowCount ?>_licence_account_LastUpdateDate" class="licence_account_LastUpdateDate">
<span<?php echo $licence_account_delete->LastUpdateDate->viewAttributes() ?>><?php echo $licence_account_delete->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$licence_account_delete->Recordset->moveNext();
}
$licence_account_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $licence_account_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$licence_account_delete->showPageFooter();
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
$licence_account_delete->terminate();
?>