<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($_property_account_view->Visible) { ?>
<div id="t__property_account_view" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl__property_account_viewmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($_property_account_view->ClientSerNo->Visible) { // ClientSerNo ?>
			<th class="<?php echo $_property_account_view->ClientSerNo->headerCellClass() ?>"><?php echo $_property_account_view->ClientSerNo->caption() ?></th>
<?php } ?>
<?php if ($_property_account_view->ClientName->Visible) { // ClientName ?>
			<th class="<?php echo $_property_account_view->ClientName->headerCellClass() ?>"><?php echo $_property_account_view->ClientName->caption() ?></th>
<?php } ?>
<?php if ($_property_account_view->PostalAddress->Visible) { // PostalAddress ?>
			<th class="<?php echo $_property_account_view->PostalAddress->headerCellClass() ?>"><?php echo $_property_account_view->PostalAddress->caption() ?></th>
<?php } ?>
<?php if ($_property_account_view->PhysicalAddress->Visible) { // PhysicalAddress ?>
			<th class="<?php echo $_property_account_view->PhysicalAddress->headerCellClass() ?>"><?php echo $_property_account_view->PhysicalAddress->caption() ?></th>
<?php } ?>
<?php if ($_property_account_view->Mobile->Visible) { // Mobile ?>
			<th class="<?php echo $_property_account_view->Mobile->headerCellClass() ?>"><?php echo $_property_account_view->Mobile->caption() ?></th>
<?php } ?>
<?php if ($_property_account_view->ValuationNo->Visible) { // ValuationNo ?>
			<th class="<?php echo $_property_account_view->ValuationNo->headerCellClass() ?>"><?php echo $_property_account_view->ValuationNo->caption() ?></th>
<?php } ?>
<?php if ($_property_account_view->PropertyNo->Visible) { // PropertyNo ?>
			<th class="<?php echo $_property_account_view->PropertyNo->headerCellClass() ?>"><?php echo $_property_account_view->PropertyNo->caption() ?></th>
<?php } ?>
<?php if ($_property_account_view->Location->Visible) { // Location ?>
			<th class="<?php echo $_property_account_view->Location->headerCellClass() ?>"><?php echo $_property_account_view->Location->caption() ?></th>
<?php } ?>
<?php if ($_property_account_view->LandValue->Visible) { // LandValue ?>
			<th class="<?php echo $_property_account_view->LandValue->headerCellClass() ?>"><?php echo $_property_account_view->LandValue->caption() ?></th>
<?php } ?>
<?php if ($_property_account_view->ImprovementsValue->Visible) { // ImprovementsValue ?>
			<th class="<?php echo $_property_account_view->ImprovementsValue->headerCellClass() ?>"><?php echo $_property_account_view->ImprovementsValue->caption() ?></th>
<?php } ?>
<?php if ($_property_account_view->RateableValue->Visible) { // RateableValue ?>
			<th class="<?php echo $_property_account_view->RateableValue->headerCellClass() ?>"><?php echo $_property_account_view->RateableValue->caption() ?></th>
<?php } ?>
<?php if ($_property_account_view->SupplementaryValue->Visible) { // SupplementaryValue ?>
			<th class="<?php echo $_property_account_view->SupplementaryValue->headerCellClass() ?>"><?php echo $_property_account_view->SupplementaryValue->caption() ?></th>
<?php } ?>
<?php if ($_property_account_view->Improvements->Visible) { // Improvements ?>
			<th class="<?php echo $_property_account_view->Improvements->headerCellClass() ?>"><?php echo $_property_account_view->Improvements->caption() ?></th>
<?php } ?>
<?php if ($_property_account_view->LandExtentInHA->Visible) { // LandExtentInHA ?>
			<th class="<?php echo $_property_account_view->LandExtentInHA->headerCellClass() ?>"><?php echo $_property_account_view->LandExtentInHA->caption() ?></th>
<?php } ?>
<?php if ($_property_account_view->BalanceBF->Visible) { // BalanceBF ?>
			<th class="<?php echo $_property_account_view->BalanceBF->headerCellClass() ?>"><?php echo $_property_account_view->BalanceBF->caption() ?></th>
<?php } ?>
<?php if ($_property_account_view->CurrentDemand->Visible) { // CurrentDemand ?>
			<th class="<?php echo $_property_account_view->CurrentDemand->headerCellClass() ?>"><?php echo $_property_account_view->CurrentDemand->caption() ?></th>
<?php } ?>
<?php if ($_property_account_view->VAT->Visible) { // VAT ?>
			<th class="<?php echo $_property_account_view->VAT->headerCellClass() ?>"><?php echo $_property_account_view->VAT->caption() ?></th>
<?php } ?>
<?php if ($_property_account_view->AmountPaid->Visible) { // AmountPaid ?>
			<th class="<?php echo $_property_account_view->AmountPaid->headerCellClass() ?>"><?php echo $_property_account_view->AmountPaid->caption() ?></th>
<?php } ?>
<?php if ($_property_account_view->BillPeriod->Visible) { // BillPeriod ?>
			<th class="<?php echo $_property_account_view->BillPeriod->headerCellClass() ?>"><?php echo $_property_account_view->BillPeriod->caption() ?></th>
<?php } ?>
<?php if ($_property_account_view->BillYear->Visible) { // BillYear ?>
			<th class="<?php echo $_property_account_view->BillYear->headerCellClass() ?>"><?php echo $_property_account_view->BillYear->caption() ?></th>
<?php } ?>
<?php if ($_property_account_view->AmountDue->Visible) { // AmountDue ?>
			<th class="<?php echo $_property_account_view->AmountDue->headerCellClass() ?>"><?php echo $_property_account_view->AmountDue->caption() ?></th>
<?php } ?>
<?php if ($_property_account_view->ChargeCode->Visible) { // ChargeCode ?>
			<th class="<?php echo $_property_account_view->ChargeCode->headerCellClass() ?>"><?php echo $_property_account_view->ChargeCode->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($_property_account_view->ClientSerNo->Visible) { // ClientSerNo ?>
			<td <?php echo $_property_account_view->ClientSerNo->cellAttributes() ?>>
<span id="el__property_account_view_ClientSerNo">
<span<?php echo $_property_account_view->ClientSerNo->viewAttributes() ?>><?php echo $_property_account_view->ClientSerNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_property_account_view->ClientName->Visible) { // ClientName ?>
			<td <?php echo $_property_account_view->ClientName->cellAttributes() ?>>
<span id="el__property_account_view_ClientName">
<span<?php echo $_property_account_view->ClientName->viewAttributes() ?>><?php echo $_property_account_view->ClientName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_property_account_view->PostalAddress->Visible) { // PostalAddress ?>
			<td <?php echo $_property_account_view->PostalAddress->cellAttributes() ?>>
<span id="el__property_account_view_PostalAddress">
<span<?php echo $_property_account_view->PostalAddress->viewAttributes() ?>><?php echo $_property_account_view->PostalAddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_property_account_view->PhysicalAddress->Visible) { // PhysicalAddress ?>
			<td <?php echo $_property_account_view->PhysicalAddress->cellAttributes() ?>>
<span id="el__property_account_view_PhysicalAddress">
<span<?php echo $_property_account_view->PhysicalAddress->viewAttributes() ?>><?php echo $_property_account_view->PhysicalAddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_property_account_view->Mobile->Visible) { // Mobile ?>
			<td <?php echo $_property_account_view->Mobile->cellAttributes() ?>>
<span id="el__property_account_view_Mobile">
<span<?php echo $_property_account_view->Mobile->viewAttributes() ?>><?php echo $_property_account_view->Mobile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_property_account_view->ValuationNo->Visible) { // ValuationNo ?>
			<td <?php echo $_property_account_view->ValuationNo->cellAttributes() ?>>
<span id="el__property_account_view_ValuationNo">
<span<?php echo $_property_account_view->ValuationNo->viewAttributes() ?>><?php echo $_property_account_view->ValuationNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_property_account_view->PropertyNo->Visible) { // PropertyNo ?>
			<td <?php echo $_property_account_view->PropertyNo->cellAttributes() ?>>
<span id="el__property_account_view_PropertyNo">
<span<?php echo $_property_account_view->PropertyNo->viewAttributes() ?>><?php echo $_property_account_view->PropertyNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_property_account_view->Location->Visible) { // Location ?>
			<td <?php echo $_property_account_view->Location->cellAttributes() ?>>
<span id="el__property_account_view_Location">
<span<?php echo $_property_account_view->Location->viewAttributes() ?>><?php echo $_property_account_view->Location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_property_account_view->LandValue->Visible) { // LandValue ?>
			<td <?php echo $_property_account_view->LandValue->cellAttributes() ?>>
<span id="el__property_account_view_LandValue">
<span<?php echo $_property_account_view->LandValue->viewAttributes() ?>><?php echo $_property_account_view->LandValue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_property_account_view->ImprovementsValue->Visible) { // ImprovementsValue ?>
			<td <?php echo $_property_account_view->ImprovementsValue->cellAttributes() ?>>
<span id="el__property_account_view_ImprovementsValue">
<span<?php echo $_property_account_view->ImprovementsValue->viewAttributes() ?>><?php echo $_property_account_view->ImprovementsValue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_property_account_view->RateableValue->Visible) { // RateableValue ?>
			<td <?php echo $_property_account_view->RateableValue->cellAttributes() ?>>
<span id="el__property_account_view_RateableValue">
<span<?php echo $_property_account_view->RateableValue->viewAttributes() ?>><?php echo $_property_account_view->RateableValue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_property_account_view->SupplementaryValue->Visible) { // SupplementaryValue ?>
			<td <?php echo $_property_account_view->SupplementaryValue->cellAttributes() ?>>
<span id="el__property_account_view_SupplementaryValue">
<span<?php echo $_property_account_view->SupplementaryValue->viewAttributes() ?>><?php echo $_property_account_view->SupplementaryValue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_property_account_view->Improvements->Visible) { // Improvements ?>
			<td <?php echo $_property_account_view->Improvements->cellAttributes() ?>>
<span id="el__property_account_view_Improvements">
<span<?php echo $_property_account_view->Improvements->viewAttributes() ?>><?php echo $_property_account_view->Improvements->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_property_account_view->LandExtentInHA->Visible) { // LandExtentInHA ?>
			<td <?php echo $_property_account_view->LandExtentInHA->cellAttributes() ?>>
<span id="el__property_account_view_LandExtentInHA">
<span<?php echo $_property_account_view->LandExtentInHA->viewAttributes() ?>><?php echo $_property_account_view->LandExtentInHA->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_property_account_view->BalanceBF->Visible) { // BalanceBF ?>
			<td <?php echo $_property_account_view->BalanceBF->cellAttributes() ?>>
<span id="el__property_account_view_BalanceBF">
<span<?php echo $_property_account_view->BalanceBF->viewAttributes() ?>><?php echo $_property_account_view->BalanceBF->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_property_account_view->CurrentDemand->Visible) { // CurrentDemand ?>
			<td <?php echo $_property_account_view->CurrentDemand->cellAttributes() ?>>
<span id="el__property_account_view_CurrentDemand">
<span<?php echo $_property_account_view->CurrentDemand->viewAttributes() ?>><?php echo $_property_account_view->CurrentDemand->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_property_account_view->VAT->Visible) { // VAT ?>
			<td <?php echo $_property_account_view->VAT->cellAttributes() ?>>
<span id="el__property_account_view_VAT">
<span<?php echo $_property_account_view->VAT->viewAttributes() ?>><?php echo $_property_account_view->VAT->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_property_account_view->AmountPaid->Visible) { // AmountPaid ?>
			<td <?php echo $_property_account_view->AmountPaid->cellAttributes() ?>>
<span id="el__property_account_view_AmountPaid">
<span<?php echo $_property_account_view->AmountPaid->viewAttributes() ?>><?php echo $_property_account_view->AmountPaid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_property_account_view->BillPeriod->Visible) { // BillPeriod ?>
			<td <?php echo $_property_account_view->BillPeriod->cellAttributes() ?>>
<span id="el__property_account_view_BillPeriod">
<span<?php echo $_property_account_view->BillPeriod->viewAttributes() ?>><?php echo $_property_account_view->BillPeriod->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_property_account_view->BillYear->Visible) { // BillYear ?>
			<td <?php echo $_property_account_view->BillYear->cellAttributes() ?>>
<span id="el__property_account_view_BillYear">
<span<?php echo $_property_account_view->BillYear->viewAttributes() ?>><?php echo $_property_account_view->BillYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_property_account_view->AmountDue->Visible) { // AmountDue ?>
			<td <?php echo $_property_account_view->AmountDue->cellAttributes() ?>>
<span id="el__property_account_view_AmountDue">
<span<?php echo $_property_account_view->AmountDue->viewAttributes() ?>><?php echo $_property_account_view->AmountDue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_property_account_view->ChargeCode->Visible) { // ChargeCode ?>
			<td <?php echo $_property_account_view->ChargeCode->cellAttributes() ?>>
<span id="el__property_account_view_ChargeCode">
<span<?php echo $_property_account_view->ChargeCode->viewAttributes() ?>><?php echo $_property_account_view->ChargeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>