<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($receipt_header->Visible) { ?>
<div id="t_receipt_header" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_receipt_headermaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($receipt_header->ChargeGroup->Visible) { // ChargeGroup ?>
			<th class="<?php echo $receipt_header->ChargeGroup->headerCellClass() ?>"><?php echo $receipt_header->ChargeGroup->caption() ?></th>
<?php } ?>
<?php if ($receipt_header->ClientSerNo->Visible) { // ClientSerNo ?>
			<th class="<?php echo $receipt_header->ClientSerNo->headerCellClass() ?>"><?php echo $receipt_header->ClientSerNo->caption() ?></th>
<?php } ?>
<?php if ($receipt_header->ReceiptPrefix->Visible) { // ReceiptPrefix ?>
			<th class="<?php echo $receipt_header->ReceiptPrefix->headerCellClass() ?>"><?php echo $receipt_header->ReceiptPrefix->caption() ?></th>
<?php } ?>
<?php if ($receipt_header->AccountBased->Visible) { // AccountBased ?>
			<th class="<?php echo $receipt_header->AccountBased->headerCellClass() ?>"><?php echo $receipt_header->AccountBased->caption() ?></th>
<?php } ?>
<?php if ($receipt_header->Cashier->Visible) { // Cashier ?>
			<th class="<?php echo $receipt_header->Cashier->headerCellClass() ?>"><?php echo $receipt_header->Cashier->caption() ?></th>
<?php } ?>
<?php if ($receipt_header->ReceiptNo->Visible) { // ReceiptNo ?>
			<th class="<?php echo $receipt_header->ReceiptNo->headerCellClass() ?>"><?php echo $receipt_header->ReceiptNo->caption() ?></th>
<?php } ?>
<?php if ($receipt_header->ReceiptDate->Visible) { // ReceiptDate ?>
			<th class="<?php echo $receipt_header->ReceiptDate->headerCellClass() ?>"><?php echo $receipt_header->ReceiptDate->caption() ?></th>
<?php } ?>
<?php if ($receipt_header->PaymentMethod->Visible) { // PaymentMethod ?>
			<th class="<?php echo $receipt_header->PaymentMethod->headerCellClass() ?>"><?php echo $receipt_header->PaymentMethod->caption() ?></th>
<?php } ?>
<?php if ($receipt_header->PaidBy->Visible) { // PaidBy ?>
			<th class="<?php echo $receipt_header->PaidBy->headerCellClass() ?>"><?php echo $receipt_header->PaidBy->caption() ?></th>
<?php } ?>
<?php if ($receipt_header->TotalDue->Visible) { // TotalDue ?>
			<th class="<?php echo $receipt_header->TotalDue->headerCellClass() ?>"><?php echo $receipt_header->TotalDue->caption() ?></th>
<?php } ?>
<?php if ($receipt_header->AmountTendered->Visible) { // AmountTendered ?>
			<th class="<?php echo $receipt_header->AmountTendered->headerCellClass() ?>"><?php echo $receipt_header->AmountTendered->caption() ?></th>
<?php } ?>
<?php if ($receipt_header->Change->Visible) { // Change ?>
			<th class="<?php echo $receipt_header->Change->headerCellClass() ?>"><?php echo $receipt_header->Change->caption() ?></th>
<?php } ?>
<?php if ($receipt_header->ClientMessage->Visible) { // ClientMessage ?>
			<th class="<?php echo $receipt_header->ClientMessage->headerCellClass() ?>"><?php echo $receipt_header->ClientMessage->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($receipt_header->ChargeGroup->Visible) { // ChargeGroup ?>
			<td <?php echo $receipt_header->ChargeGroup->cellAttributes() ?>>
<span id="el_receipt_header_ChargeGroup">
<span<?php echo $receipt_header->ChargeGroup->viewAttributes() ?>><?php echo $receipt_header->ChargeGroup->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($receipt_header->ClientSerNo->Visible) { // ClientSerNo ?>
			<td <?php echo $receipt_header->ClientSerNo->cellAttributes() ?>>
<span id="el_receipt_header_ClientSerNo">
<span<?php echo $receipt_header->ClientSerNo->viewAttributes() ?>><?php echo $receipt_header->ClientSerNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($receipt_header->ReceiptPrefix->Visible) { // ReceiptPrefix ?>
			<td <?php echo $receipt_header->ReceiptPrefix->cellAttributes() ?>>
<span id="el_receipt_header_ReceiptPrefix">
<span<?php echo $receipt_header->ReceiptPrefix->viewAttributes() ?>><?php echo $receipt_header->ReceiptPrefix->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($receipt_header->AccountBased->Visible) { // AccountBased ?>
			<td <?php echo $receipt_header->AccountBased->cellAttributes() ?>>
<span id="el_receipt_header_AccountBased">
<span<?php echo $receipt_header->AccountBased->viewAttributes() ?>><?php echo $receipt_header->AccountBased->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($receipt_header->Cashier->Visible) { // Cashier ?>
			<td <?php echo $receipt_header->Cashier->cellAttributes() ?>>
<span id="el_receipt_header_Cashier">
<span<?php echo $receipt_header->Cashier->viewAttributes() ?>><?php echo $receipt_header->Cashier->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($receipt_header->ReceiptNo->Visible) { // ReceiptNo ?>
			<td <?php echo $receipt_header->ReceiptNo->cellAttributes() ?>>
<span id="el_receipt_header_ReceiptNo">
<span<?php echo $receipt_header->ReceiptNo->viewAttributes() ?>><?php echo $receipt_header->ReceiptNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($receipt_header->ReceiptDate->Visible) { // ReceiptDate ?>
			<td <?php echo $receipt_header->ReceiptDate->cellAttributes() ?>>
<span id="el_receipt_header_ReceiptDate">
<span<?php echo $receipt_header->ReceiptDate->viewAttributes() ?>><?php echo $receipt_header->ReceiptDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($receipt_header->PaymentMethod->Visible) { // PaymentMethod ?>
			<td <?php echo $receipt_header->PaymentMethod->cellAttributes() ?>>
<span id="el_receipt_header_PaymentMethod">
<span<?php echo $receipt_header->PaymentMethod->viewAttributes() ?>><?php echo $receipt_header->PaymentMethod->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($receipt_header->PaidBy->Visible) { // PaidBy ?>
			<td <?php echo $receipt_header->PaidBy->cellAttributes() ?>>
<span id="el_receipt_header_PaidBy">
<span<?php echo $receipt_header->PaidBy->viewAttributes() ?>><?php echo $receipt_header->PaidBy->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($receipt_header->TotalDue->Visible) { // TotalDue ?>
			<td <?php echo $receipt_header->TotalDue->cellAttributes() ?>>
<span id="el_receipt_header_TotalDue">
<span<?php echo $receipt_header->TotalDue->viewAttributes() ?>><?php echo $receipt_header->TotalDue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($receipt_header->AmountTendered->Visible) { // AmountTendered ?>
			<td <?php echo $receipt_header->AmountTendered->cellAttributes() ?>>
<span id="el_receipt_header_AmountTendered">
<span<?php echo $receipt_header->AmountTendered->viewAttributes() ?>><?php echo $receipt_header->AmountTendered->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($receipt_header->Change->Visible) { // Change ?>
			<td <?php echo $receipt_header->Change->cellAttributes() ?>>
<span id="el_receipt_header_Change">
<span<?php echo $receipt_header->Change->viewAttributes() ?>><?php echo $receipt_header->Change->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($receipt_header->ClientMessage->Visible) { // ClientMessage ?>
			<td <?php echo $receipt_header->ClientMessage->cellAttributes() ?>>
<span id="el_receipt_header_ClientMessage">
<span<?php echo $receipt_header->ClientMessage->viewAttributes() ?>><?php echo $receipt_header->ClientMessage->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>