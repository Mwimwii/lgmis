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
$fire_certificate_delete = new fire_certificate_delete();

// Run the page
$fire_certificate_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$fire_certificate_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ffire_certificatedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ffire_certificatedelete = currentForm = new ew.Form("ffire_certificatedelete", "delete");
	loadjs.done("ffire_certificatedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $fire_certificate_delete->showPageHeader(); ?>
<?php
$fire_certificate_delete->showMessage();
?>
<form name="ffire_certificatedelete" id="ffire_certificatedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="fire_certificate">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($fire_certificate_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($fire_certificate_delete->FireCertificateNo->Visible) { // FireCertificateNo ?>
		<th class="<?php echo $fire_certificate_delete->FireCertificateNo->headerCellClass() ?>"><span id="elh_fire_certificate_FireCertificateNo" class="fire_certificate_FireCertificateNo"><?php echo $fire_certificate_delete->FireCertificateNo->caption() ?></span></th>
<?php } ?>
<?php if ($fire_certificate_delete->LicenceNo->Visible) { // LicenceNo ?>
		<th class="<?php echo $fire_certificate_delete->LicenceNo->headerCellClass() ?>"><span id="elh_fire_certificate_LicenceNo" class="fire_certificate_LicenceNo"><?php echo $fire_certificate_delete->LicenceNo->caption() ?></span></th>
<?php } ?>
<?php if ($fire_certificate_delete->BusinessNo->Visible) { // BusinessNo ?>
		<th class="<?php echo $fire_certificate_delete->BusinessNo->headerCellClass() ?>"><span id="elh_fire_certificate_BusinessNo" class="fire_certificate_BusinessNo"><?php echo $fire_certificate_delete->BusinessNo->caption() ?></span></th>
<?php } ?>
<?php if ($fire_certificate_delete->InspectionDate->Visible) { // InspectionDate ?>
		<th class="<?php echo $fire_certificate_delete->InspectionDate->headerCellClass() ?>"><span id="elh_fire_certificate_InspectionDate" class="fire_certificate_InspectionDate"><?php echo $fire_certificate_delete->InspectionDate->caption() ?></span></th>
<?php } ?>
<?php if ($fire_certificate_delete->InspectedBy->Visible) { // InspectedBy ?>
		<th class="<?php echo $fire_certificate_delete->InspectedBy->headerCellClass() ?>"><span id="elh_fire_certificate_InspectedBy" class="fire_certificate_InspectedBy"><?php echo $fire_certificate_delete->InspectedBy->caption() ?></span></th>
<?php } ?>
<?php if ($fire_certificate_delete->ChargeCode->Visible) { // ChargeCode ?>
		<th class="<?php echo $fire_certificate_delete->ChargeCode->headerCellClass() ?>"><span id="elh_fire_certificate_ChargeCode" class="fire_certificate_ChargeCode"><?php echo $fire_certificate_delete->ChargeCode->caption() ?></span></th>
<?php } ?>
<?php if ($fire_certificate_delete->ChargeGroup->Visible) { // ChargeGroup ?>
		<th class="<?php echo $fire_certificate_delete->ChargeGroup->headerCellClass() ?>"><span id="elh_fire_certificate_ChargeGroup" class="fire_certificate_ChargeGroup"><?php echo $fire_certificate_delete->ChargeGroup->caption() ?></span></th>
<?php } ?>
<?php if ($fire_certificate_delete->BalanceBF->Visible) { // BalanceBF ?>
		<th class="<?php echo $fire_certificate_delete->BalanceBF->headerCellClass() ?>"><span id="elh_fire_certificate_BalanceBF" class="fire_certificate_BalanceBF"><?php echo $fire_certificate_delete->BalanceBF->caption() ?></span></th>
<?php } ?>
<?php if ($fire_certificate_delete->CurrentDemand->Visible) { // CurrentDemand ?>
		<th class="<?php echo $fire_certificate_delete->CurrentDemand->headerCellClass() ?>"><span id="elh_fire_certificate_CurrentDemand" class="fire_certificate_CurrentDemand"><?php echo $fire_certificate_delete->CurrentDemand->caption() ?></span></th>
<?php } ?>
<?php if ($fire_certificate_delete->VAT->Visible) { // VAT ?>
		<th class="<?php echo $fire_certificate_delete->VAT->headerCellClass() ?>"><span id="elh_fire_certificate_VAT" class="fire_certificate_VAT"><?php echo $fire_certificate_delete->VAT->caption() ?></span></th>
<?php } ?>
<?php if ($fire_certificate_delete->AmountPaid->Visible) { // AmountPaid ?>
		<th class="<?php echo $fire_certificate_delete->AmountPaid->headerCellClass() ?>"><span id="elh_fire_certificate_AmountPaid" class="fire_certificate_AmountPaid"><?php echo $fire_certificate_delete->AmountPaid->caption() ?></span></th>
<?php } ?>
<?php if ($fire_certificate_delete->BillPeriod->Visible) { // BillPeriod ?>
		<th class="<?php echo $fire_certificate_delete->BillPeriod->headerCellClass() ?>"><span id="elh_fire_certificate_BillPeriod" class="fire_certificate_BillPeriod"><?php echo $fire_certificate_delete->BillPeriod->caption() ?></span></th>
<?php } ?>
<?php if ($fire_certificate_delete->PeriodType->Visible) { // PeriodType ?>
		<th class="<?php echo $fire_certificate_delete->PeriodType->headerCellClass() ?>"><span id="elh_fire_certificate_PeriodType" class="fire_certificate_PeriodType"><?php echo $fire_certificate_delete->PeriodType->caption() ?></span></th>
<?php } ?>
<?php if ($fire_certificate_delete->BillYear->Visible) { // BillYear ?>
		<th class="<?php echo $fire_certificate_delete->BillYear->headerCellClass() ?>"><span id="elh_fire_certificate_BillYear" class="fire_certificate_BillYear"><?php echo $fire_certificate_delete->BillYear->caption() ?></span></th>
<?php } ?>
<?php if ($fire_certificate_delete->StartDate->Visible) { // StartDate ?>
		<th class="<?php echo $fire_certificate_delete->StartDate->headerCellClass() ?>"><span id="elh_fire_certificate_StartDate" class="fire_certificate_StartDate"><?php echo $fire_certificate_delete->StartDate->caption() ?></span></th>
<?php } ?>
<?php if ($fire_certificate_delete->EndDate->Visible) { // EndDate ?>
		<th class="<?php echo $fire_certificate_delete->EndDate->headerCellClass() ?>"><span id="elh_fire_certificate_EndDate" class="fire_certificate_EndDate"><?php echo $fire_certificate_delete->EndDate->caption() ?></span></th>
<?php } ?>
<?php if ($fire_certificate_delete->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<th class="<?php echo $fire_certificate_delete->LastUpdatedBy->headerCellClass() ?>"><span id="elh_fire_certificate_LastUpdatedBy" class="fire_certificate_LastUpdatedBy"><?php echo $fire_certificate_delete->LastUpdatedBy->caption() ?></span></th>
<?php } ?>
<?php if ($fire_certificate_delete->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<th class="<?php echo $fire_certificate_delete->LastUpdateDate->headerCellClass() ?>"><span id="elh_fire_certificate_LastUpdateDate" class="fire_certificate_LastUpdateDate"><?php echo $fire_certificate_delete->LastUpdateDate->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$fire_certificate_delete->RecordCount = 0;
$i = 0;
while (!$fire_certificate_delete->Recordset->EOF) {
	$fire_certificate_delete->RecordCount++;
	$fire_certificate_delete->RowCount++;

	// Set row properties
	$fire_certificate->resetAttributes();
	$fire_certificate->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$fire_certificate_delete->loadRowValues($fire_certificate_delete->Recordset);

	// Render row
	$fire_certificate_delete->renderRow();
?>
	<tr <?php echo $fire_certificate->rowAttributes() ?>>
<?php if ($fire_certificate_delete->FireCertificateNo->Visible) { // FireCertificateNo ?>
		<td <?php echo $fire_certificate_delete->FireCertificateNo->cellAttributes() ?>>
<span id="el<?php echo $fire_certificate_delete->RowCount ?>_fire_certificate_FireCertificateNo" class="fire_certificate_FireCertificateNo">
<span<?php echo $fire_certificate_delete->FireCertificateNo->viewAttributes() ?>><?php echo $fire_certificate_delete->FireCertificateNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fire_certificate_delete->LicenceNo->Visible) { // LicenceNo ?>
		<td <?php echo $fire_certificate_delete->LicenceNo->cellAttributes() ?>>
<span id="el<?php echo $fire_certificate_delete->RowCount ?>_fire_certificate_LicenceNo" class="fire_certificate_LicenceNo">
<span<?php echo $fire_certificate_delete->LicenceNo->viewAttributes() ?>><?php echo $fire_certificate_delete->LicenceNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fire_certificate_delete->BusinessNo->Visible) { // BusinessNo ?>
		<td <?php echo $fire_certificate_delete->BusinessNo->cellAttributes() ?>>
<span id="el<?php echo $fire_certificate_delete->RowCount ?>_fire_certificate_BusinessNo" class="fire_certificate_BusinessNo">
<span<?php echo $fire_certificate_delete->BusinessNo->viewAttributes() ?>><?php echo $fire_certificate_delete->BusinessNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fire_certificate_delete->InspectionDate->Visible) { // InspectionDate ?>
		<td <?php echo $fire_certificate_delete->InspectionDate->cellAttributes() ?>>
<span id="el<?php echo $fire_certificate_delete->RowCount ?>_fire_certificate_InspectionDate" class="fire_certificate_InspectionDate">
<span<?php echo $fire_certificate_delete->InspectionDate->viewAttributes() ?>><?php echo $fire_certificate_delete->InspectionDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fire_certificate_delete->InspectedBy->Visible) { // InspectedBy ?>
		<td <?php echo $fire_certificate_delete->InspectedBy->cellAttributes() ?>>
<span id="el<?php echo $fire_certificate_delete->RowCount ?>_fire_certificate_InspectedBy" class="fire_certificate_InspectedBy">
<span<?php echo $fire_certificate_delete->InspectedBy->viewAttributes() ?>><?php echo $fire_certificate_delete->InspectedBy->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fire_certificate_delete->ChargeCode->Visible) { // ChargeCode ?>
		<td <?php echo $fire_certificate_delete->ChargeCode->cellAttributes() ?>>
<span id="el<?php echo $fire_certificate_delete->RowCount ?>_fire_certificate_ChargeCode" class="fire_certificate_ChargeCode">
<span<?php echo $fire_certificate_delete->ChargeCode->viewAttributes() ?>><?php echo $fire_certificate_delete->ChargeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fire_certificate_delete->ChargeGroup->Visible) { // ChargeGroup ?>
		<td <?php echo $fire_certificate_delete->ChargeGroup->cellAttributes() ?>>
<span id="el<?php echo $fire_certificate_delete->RowCount ?>_fire_certificate_ChargeGroup" class="fire_certificate_ChargeGroup">
<span<?php echo $fire_certificate_delete->ChargeGroup->viewAttributes() ?>><?php echo $fire_certificate_delete->ChargeGroup->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fire_certificate_delete->BalanceBF->Visible) { // BalanceBF ?>
		<td <?php echo $fire_certificate_delete->BalanceBF->cellAttributes() ?>>
<span id="el<?php echo $fire_certificate_delete->RowCount ?>_fire_certificate_BalanceBF" class="fire_certificate_BalanceBF">
<span<?php echo $fire_certificate_delete->BalanceBF->viewAttributes() ?>><?php echo $fire_certificate_delete->BalanceBF->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fire_certificate_delete->CurrentDemand->Visible) { // CurrentDemand ?>
		<td <?php echo $fire_certificate_delete->CurrentDemand->cellAttributes() ?>>
<span id="el<?php echo $fire_certificate_delete->RowCount ?>_fire_certificate_CurrentDemand" class="fire_certificate_CurrentDemand">
<span<?php echo $fire_certificate_delete->CurrentDemand->viewAttributes() ?>><?php echo $fire_certificate_delete->CurrentDemand->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fire_certificate_delete->VAT->Visible) { // VAT ?>
		<td <?php echo $fire_certificate_delete->VAT->cellAttributes() ?>>
<span id="el<?php echo $fire_certificate_delete->RowCount ?>_fire_certificate_VAT" class="fire_certificate_VAT">
<span<?php echo $fire_certificate_delete->VAT->viewAttributes() ?>><?php echo $fire_certificate_delete->VAT->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fire_certificate_delete->AmountPaid->Visible) { // AmountPaid ?>
		<td <?php echo $fire_certificate_delete->AmountPaid->cellAttributes() ?>>
<span id="el<?php echo $fire_certificate_delete->RowCount ?>_fire_certificate_AmountPaid" class="fire_certificate_AmountPaid">
<span<?php echo $fire_certificate_delete->AmountPaid->viewAttributes() ?>><?php echo $fire_certificate_delete->AmountPaid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fire_certificate_delete->BillPeriod->Visible) { // BillPeriod ?>
		<td <?php echo $fire_certificate_delete->BillPeriod->cellAttributes() ?>>
<span id="el<?php echo $fire_certificate_delete->RowCount ?>_fire_certificate_BillPeriod" class="fire_certificate_BillPeriod">
<span<?php echo $fire_certificate_delete->BillPeriod->viewAttributes() ?>><?php echo $fire_certificate_delete->BillPeriod->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fire_certificate_delete->PeriodType->Visible) { // PeriodType ?>
		<td <?php echo $fire_certificate_delete->PeriodType->cellAttributes() ?>>
<span id="el<?php echo $fire_certificate_delete->RowCount ?>_fire_certificate_PeriodType" class="fire_certificate_PeriodType">
<span<?php echo $fire_certificate_delete->PeriodType->viewAttributes() ?>><?php echo $fire_certificate_delete->PeriodType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fire_certificate_delete->BillYear->Visible) { // BillYear ?>
		<td <?php echo $fire_certificate_delete->BillYear->cellAttributes() ?>>
<span id="el<?php echo $fire_certificate_delete->RowCount ?>_fire_certificate_BillYear" class="fire_certificate_BillYear">
<span<?php echo $fire_certificate_delete->BillYear->viewAttributes() ?>><?php echo $fire_certificate_delete->BillYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fire_certificate_delete->StartDate->Visible) { // StartDate ?>
		<td <?php echo $fire_certificate_delete->StartDate->cellAttributes() ?>>
<span id="el<?php echo $fire_certificate_delete->RowCount ?>_fire_certificate_StartDate" class="fire_certificate_StartDate">
<span<?php echo $fire_certificate_delete->StartDate->viewAttributes() ?>><?php echo $fire_certificate_delete->StartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fire_certificate_delete->EndDate->Visible) { // EndDate ?>
		<td <?php echo $fire_certificate_delete->EndDate->cellAttributes() ?>>
<span id="el<?php echo $fire_certificate_delete->RowCount ?>_fire_certificate_EndDate" class="fire_certificate_EndDate">
<span<?php echo $fire_certificate_delete->EndDate->viewAttributes() ?>><?php echo $fire_certificate_delete->EndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fire_certificate_delete->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td <?php echo $fire_certificate_delete->LastUpdatedBy->cellAttributes() ?>>
<span id="el<?php echo $fire_certificate_delete->RowCount ?>_fire_certificate_LastUpdatedBy" class="fire_certificate_LastUpdatedBy">
<span<?php echo $fire_certificate_delete->LastUpdatedBy->viewAttributes() ?>><?php echo $fire_certificate_delete->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fire_certificate_delete->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td <?php echo $fire_certificate_delete->LastUpdateDate->cellAttributes() ?>>
<span id="el<?php echo $fire_certificate_delete->RowCount ?>_fire_certificate_LastUpdateDate" class="fire_certificate_LastUpdateDate">
<span<?php echo $fire_certificate_delete->LastUpdateDate->viewAttributes() ?>><?php echo $fire_certificate_delete->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$fire_certificate_delete->Recordset->moveNext();
}
$fire_certificate_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $fire_certificate_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$fire_certificate_delete->showPageFooter();
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
$fire_certificate_delete->terminate();
?>