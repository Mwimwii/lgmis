<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($licence_account->Visible) { ?>
<div id="t_licence_account" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_licence_accountmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($licence_account->LicenceNo->Visible) { // LicenceNo ?>
			<th class="<?php echo $licence_account->LicenceNo->headerCellClass() ?>"><?php echo $licence_account->LicenceNo->caption() ?></th>
<?php } ?>
<?php if ($licence_account->BusinessNo->Visible) { // BusinessNo ?>
			<th class="<?php echo $licence_account->BusinessNo->headerCellClass() ?>"><?php echo $licence_account->BusinessNo->caption() ?></th>
<?php } ?>
<?php if ($licence_account->ClientID->Visible) { // ClientID ?>
			<th class="<?php echo $licence_account->ClientID->headerCellClass() ?>"><?php echo $licence_account->ClientID->caption() ?></th>
<?php } ?>
<?php if ($licence_account->ChargeCode->Visible) { // ChargeCode ?>
			<th class="<?php echo $licence_account->ChargeCode->headerCellClass() ?>"><?php echo $licence_account->ChargeCode->caption() ?></th>
<?php } ?>
<?php if ($licence_account->ChargeGroup->Visible) { // ChargeGroup ?>
			<th class="<?php echo $licence_account->ChargeGroup->headerCellClass() ?>"><?php echo $licence_account->ChargeGroup->caption() ?></th>
<?php } ?>
<?php if ($licence_account->BalanceBF->Visible) { // BalanceBF ?>
			<th class="<?php echo $licence_account->BalanceBF->headerCellClass() ?>"><?php echo $licence_account->BalanceBF->caption() ?></th>
<?php } ?>
<?php if ($licence_account->CurrentDemand->Visible) { // CurrentDemand ?>
			<th class="<?php echo $licence_account->CurrentDemand->headerCellClass() ?>"><?php echo $licence_account->CurrentDemand->caption() ?></th>
<?php } ?>
<?php if ($licence_account->VAT->Visible) { // VAT ?>
			<th class="<?php echo $licence_account->VAT->headerCellClass() ?>"><?php echo $licence_account->VAT->caption() ?></th>
<?php } ?>
<?php if ($licence_account->AmountPaid->Visible) { // AmountPaid ?>
			<th class="<?php echo $licence_account->AmountPaid->headerCellClass() ?>"><?php echo $licence_account->AmountPaid->caption() ?></th>
<?php } ?>
<?php if ($licence_account->BillPeriod->Visible) { // BillPeriod ?>
			<th class="<?php echo $licence_account->BillPeriod->headerCellClass() ?>"><?php echo $licence_account->BillPeriod->caption() ?></th>
<?php } ?>
<?php if ($licence_account->PeriodType->Visible) { // PeriodType ?>
			<th class="<?php echo $licence_account->PeriodType->headerCellClass() ?>"><?php echo $licence_account->PeriodType->caption() ?></th>
<?php } ?>
<?php if ($licence_account->BillYear->Visible) { // BillYear ?>
			<th class="<?php echo $licence_account->BillYear->headerCellClass() ?>"><?php echo $licence_account->BillYear->caption() ?></th>
<?php } ?>
<?php if ($licence_account->StartDate->Visible) { // StartDate ?>
			<th class="<?php echo $licence_account->StartDate->headerCellClass() ?>"><?php echo $licence_account->StartDate->caption() ?></th>
<?php } ?>
<?php if ($licence_account->EndDate->Visible) { // EndDate ?>
			<th class="<?php echo $licence_account->EndDate->headerCellClass() ?>"><?php echo $licence_account->EndDate->caption() ?></th>
<?php } ?>
<?php if ($licence_account->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
			<th class="<?php echo $licence_account->LastUpdatedBy->headerCellClass() ?>"><?php echo $licence_account->LastUpdatedBy->caption() ?></th>
<?php } ?>
<?php if ($licence_account->LastUpdateDate->Visible) { // LastUpdateDate ?>
			<th class="<?php echo $licence_account->LastUpdateDate->headerCellClass() ?>"><?php echo $licence_account->LastUpdateDate->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($licence_account->LicenceNo->Visible) { // LicenceNo ?>
			<td <?php echo $licence_account->LicenceNo->cellAttributes() ?>>
<span id="el_licence_account_LicenceNo">
<span<?php echo $licence_account->LicenceNo->viewAttributes() ?>><?php echo $licence_account->LicenceNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account->BusinessNo->Visible) { // BusinessNo ?>
			<td <?php echo $licence_account->BusinessNo->cellAttributes() ?>>
<span id="el_licence_account_BusinessNo">
<span<?php echo $licence_account->BusinessNo->viewAttributes() ?>><?php echo $licence_account->BusinessNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account->ClientID->Visible) { // ClientID ?>
			<td <?php echo $licence_account->ClientID->cellAttributes() ?>>
<span id="el_licence_account_ClientID">
<span<?php echo $licence_account->ClientID->viewAttributes() ?>><?php echo $licence_account->ClientID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account->ChargeCode->Visible) { // ChargeCode ?>
			<td <?php echo $licence_account->ChargeCode->cellAttributes() ?>>
<span id="el_licence_account_ChargeCode">
<span<?php echo $licence_account->ChargeCode->viewAttributes() ?>><?php echo $licence_account->ChargeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account->ChargeGroup->Visible) { // ChargeGroup ?>
			<td <?php echo $licence_account->ChargeGroup->cellAttributes() ?>>
<span id="el_licence_account_ChargeGroup">
<span<?php echo $licence_account->ChargeGroup->viewAttributes() ?>><?php echo $licence_account->ChargeGroup->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account->BalanceBF->Visible) { // BalanceBF ?>
			<td <?php echo $licence_account->BalanceBF->cellAttributes() ?>>
<span id="el_licence_account_BalanceBF">
<span<?php echo $licence_account->BalanceBF->viewAttributes() ?>><?php echo $licence_account->BalanceBF->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account->CurrentDemand->Visible) { // CurrentDemand ?>
			<td <?php echo $licence_account->CurrentDemand->cellAttributes() ?>>
<span id="el_licence_account_CurrentDemand">
<span<?php echo $licence_account->CurrentDemand->viewAttributes() ?>><?php echo $licence_account->CurrentDemand->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account->VAT->Visible) { // VAT ?>
			<td <?php echo $licence_account->VAT->cellAttributes() ?>>
<span id="el_licence_account_VAT">
<span<?php echo $licence_account->VAT->viewAttributes() ?>><?php echo $licence_account->VAT->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account->AmountPaid->Visible) { // AmountPaid ?>
			<td <?php echo $licence_account->AmountPaid->cellAttributes() ?>>
<span id="el_licence_account_AmountPaid">
<span<?php echo $licence_account->AmountPaid->viewAttributes() ?>><?php echo $licence_account->AmountPaid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account->BillPeriod->Visible) { // BillPeriod ?>
			<td <?php echo $licence_account->BillPeriod->cellAttributes() ?>>
<span id="el_licence_account_BillPeriod">
<span<?php echo $licence_account->BillPeriod->viewAttributes() ?>><?php echo $licence_account->BillPeriod->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account->PeriodType->Visible) { // PeriodType ?>
			<td <?php echo $licence_account->PeriodType->cellAttributes() ?>>
<span id="el_licence_account_PeriodType">
<span<?php echo $licence_account->PeriodType->viewAttributes() ?>><?php echo $licence_account->PeriodType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account->BillYear->Visible) { // BillYear ?>
			<td <?php echo $licence_account->BillYear->cellAttributes() ?>>
<span id="el_licence_account_BillYear">
<span<?php echo $licence_account->BillYear->viewAttributes() ?>><?php echo $licence_account->BillYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account->StartDate->Visible) { // StartDate ?>
			<td <?php echo $licence_account->StartDate->cellAttributes() ?>>
<span id="el_licence_account_StartDate">
<span<?php echo $licence_account->StartDate->viewAttributes() ?>><?php echo $licence_account->StartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account->EndDate->Visible) { // EndDate ?>
			<td <?php echo $licence_account->EndDate->cellAttributes() ?>>
<span id="el_licence_account_EndDate">
<span<?php echo $licence_account->EndDate->viewAttributes() ?>><?php echo $licence_account->EndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
			<td <?php echo $licence_account->LastUpdatedBy->cellAttributes() ?>>
<span id="el_licence_account_LastUpdatedBy">
<span<?php echo $licence_account->LastUpdatedBy->viewAttributes() ?>><?php echo $licence_account->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($licence_account->LastUpdateDate->Visible) { // LastUpdateDate ?>
			<td <?php echo $licence_account->LastUpdateDate->cellAttributes() ?>>
<span id="el_licence_account_LastUpdateDate">
<span<?php echo $licence_account->LastUpdateDate->viewAttributes() ?>><?php echo $licence_account->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>