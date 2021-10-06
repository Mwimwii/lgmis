<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($bill_board->Visible) { ?>
<div id="t_bill_board" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_bill_boardmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($bill_board->BillBoardNo->Visible) { // BillBoardNo ?>
			<th class="<?php echo $bill_board->BillBoardNo->headerCellClass() ?>"><?php echo $bill_board->BillBoardNo->caption() ?></th>
<?php } ?>
<?php if ($bill_board->BoardStandNo->Visible) { // BoardStandNo ?>
			<th class="<?php echo $bill_board->BoardStandNo->headerCellClass() ?>"><?php echo $bill_board->BoardStandNo->caption() ?></th>
<?php } ?>
<?php if ($bill_board->ClientSerNo->Visible) { // ClientSerNo ?>
			<th class="<?php echo $bill_board->ClientSerNo->headerCellClass() ?>"><?php echo $bill_board->ClientSerNo->caption() ?></th>
<?php } ?>
<?php if ($bill_board->ClientID->Visible) { // ClientID ?>
			<th class="<?php echo $bill_board->ClientID->headerCellClass() ?>"><?php echo $bill_board->ClientID->caption() ?></th>
<?php } ?>
<?php if ($bill_board->BoardLength->Visible) { // BoardLength ?>
			<th class="<?php echo $bill_board->BoardLength->headerCellClass() ?>"><?php echo $bill_board->BoardLength->caption() ?></th>
<?php } ?>
<?php if ($bill_board->BoardWidth->Visible) { // BoardWidth ?>
			<th class="<?php echo $bill_board->BoardWidth->headerCellClass() ?>"><?php echo $bill_board->BoardWidth->caption() ?></th>
<?php } ?>
<?php if ($bill_board->BoardSize->Visible) { // BoardSize ?>
			<th class="<?php echo $bill_board->BoardSize->headerCellClass() ?>"><?php echo $bill_board->BoardSize->caption() ?></th>
<?php } ?>
<?php if ($bill_board->BoardType->Visible) { // BoardType ?>
			<th class="<?php echo $bill_board->BoardType->headerCellClass() ?>"><?php echo $bill_board->BoardType->caption() ?></th>
<?php } ?>
<?php if ($bill_board->BoardLocation->Visible) { // BoardLocation ?>
			<th class="<?php echo $bill_board->BoardLocation->headerCellClass() ?>"><?php echo $bill_board->BoardLocation->caption() ?></th>
<?php } ?>
<?php if ($bill_board->BoardStatus->Visible) { // BoardStatus ?>
			<th class="<?php echo $bill_board->BoardStatus->headerCellClass() ?>"><?php echo $bill_board->BoardStatus->caption() ?></th>
<?php } ?>
<?php if ($bill_board->ExemptCode->Visible) { // ExemptCode ?>
			<th class="<?php echo $bill_board->ExemptCode->headerCellClass() ?>"><?php echo $bill_board->ExemptCode->caption() ?></th>
<?php } ?>
<?php if ($bill_board->StreetAddress->Visible) { // StreetAddress ?>
			<th class="<?php echo $bill_board->StreetAddress->headerCellClass() ?>"><?php echo $bill_board->StreetAddress->caption() ?></th>
<?php } ?>
<?php if ($bill_board->Longitude->Visible) { // Longitude ?>
			<th class="<?php echo $bill_board->Longitude->headerCellClass() ?>"><?php echo $bill_board->Longitude->caption() ?></th>
<?php } ?>
<?php if ($bill_board->Latitude->Visible) { // Latitude ?>
			<th class="<?php echo $bill_board->Latitude->headerCellClass() ?>"><?php echo $bill_board->Latitude->caption() ?></th>
<?php } ?>
<?php if ($bill_board->Incumberance->Visible) { // Incumberance ?>
			<th class="<?php echo $bill_board->Incumberance->headerCellClass() ?>"><?php echo $bill_board->Incumberance->caption() ?></th>
<?php } ?>
<?php if ($bill_board->StartDate->Visible) { // StartDate ?>
			<th class="<?php echo $bill_board->StartDate->headerCellClass() ?>"><?php echo $bill_board->StartDate->caption() ?></th>
<?php } ?>
<?php if ($bill_board->EndDate->Visible) { // EndDate ?>
			<th class="<?php echo $bill_board->EndDate->headerCellClass() ?>"><?php echo $bill_board->EndDate->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($bill_board->BillBoardNo->Visible) { // BillBoardNo ?>
			<td <?php echo $bill_board->BillBoardNo->cellAttributes() ?>>
<span id="el_bill_board_BillBoardNo">
<span<?php echo $bill_board->BillBoardNo->viewAttributes() ?>><?php echo $bill_board->BillBoardNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board->BoardStandNo->Visible) { // BoardStandNo ?>
			<td <?php echo $bill_board->BoardStandNo->cellAttributes() ?>>
<span id="el_bill_board_BoardStandNo">
<span<?php echo $bill_board->BoardStandNo->viewAttributes() ?>><?php echo $bill_board->BoardStandNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board->ClientSerNo->Visible) { // ClientSerNo ?>
			<td <?php echo $bill_board->ClientSerNo->cellAttributes() ?>>
<span id="el_bill_board_ClientSerNo">
<span<?php echo $bill_board->ClientSerNo->viewAttributes() ?>><?php echo $bill_board->ClientSerNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board->ClientID->Visible) { // ClientID ?>
			<td <?php echo $bill_board->ClientID->cellAttributes() ?>>
<span id="el_bill_board_ClientID">
<span<?php echo $bill_board->ClientID->viewAttributes() ?>><?php echo $bill_board->ClientID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board->BoardLength->Visible) { // BoardLength ?>
			<td <?php echo $bill_board->BoardLength->cellAttributes() ?>>
<span id="el_bill_board_BoardLength">
<span<?php echo $bill_board->BoardLength->viewAttributes() ?>><?php echo $bill_board->BoardLength->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board->BoardWidth->Visible) { // BoardWidth ?>
			<td <?php echo $bill_board->BoardWidth->cellAttributes() ?>>
<span id="el_bill_board_BoardWidth">
<span<?php echo $bill_board->BoardWidth->viewAttributes() ?>><?php echo $bill_board->BoardWidth->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board->BoardSize->Visible) { // BoardSize ?>
			<td <?php echo $bill_board->BoardSize->cellAttributes() ?>>
<span id="el_bill_board_BoardSize">
<span<?php echo $bill_board->BoardSize->viewAttributes() ?>><?php echo $bill_board->BoardSize->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board->BoardType->Visible) { // BoardType ?>
			<td <?php echo $bill_board->BoardType->cellAttributes() ?>>
<span id="el_bill_board_BoardType">
<span<?php echo $bill_board->BoardType->viewAttributes() ?>><?php echo $bill_board->BoardType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board->BoardLocation->Visible) { // BoardLocation ?>
			<td <?php echo $bill_board->BoardLocation->cellAttributes() ?>>
<span id="el_bill_board_BoardLocation">
<span<?php echo $bill_board->BoardLocation->viewAttributes() ?>><?php echo $bill_board->BoardLocation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board->BoardStatus->Visible) { // BoardStatus ?>
			<td <?php echo $bill_board->BoardStatus->cellAttributes() ?>>
<span id="el_bill_board_BoardStatus">
<span<?php echo $bill_board->BoardStatus->viewAttributes() ?>><?php echo $bill_board->BoardStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board->ExemptCode->Visible) { // ExemptCode ?>
			<td <?php echo $bill_board->ExemptCode->cellAttributes() ?>>
<span id="el_bill_board_ExemptCode">
<span<?php echo $bill_board->ExemptCode->viewAttributes() ?>><?php echo $bill_board->ExemptCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board->StreetAddress->Visible) { // StreetAddress ?>
			<td <?php echo $bill_board->StreetAddress->cellAttributes() ?>>
<span id="el_bill_board_StreetAddress">
<span<?php echo $bill_board->StreetAddress->viewAttributes() ?>><?php echo $bill_board->StreetAddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board->Longitude->Visible) { // Longitude ?>
			<td <?php echo $bill_board->Longitude->cellAttributes() ?>>
<span id="el_bill_board_Longitude">
<span<?php echo $bill_board->Longitude->viewAttributes() ?>><?php echo $bill_board->Longitude->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board->Latitude->Visible) { // Latitude ?>
			<td <?php echo $bill_board->Latitude->cellAttributes() ?>>
<span id="el_bill_board_Latitude">
<span<?php echo $bill_board->Latitude->viewAttributes() ?>><?php echo $bill_board->Latitude->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board->Incumberance->Visible) { // Incumberance ?>
			<td <?php echo $bill_board->Incumberance->cellAttributes() ?>>
<span id="el_bill_board_Incumberance">
<span<?php echo $bill_board->Incumberance->viewAttributes() ?>><?php echo $bill_board->Incumberance->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board->StartDate->Visible) { // StartDate ?>
			<td <?php echo $bill_board->StartDate->cellAttributes() ?>>
<span id="el_bill_board_StartDate">
<span<?php echo $bill_board->StartDate->viewAttributes() ?>><?php echo $bill_board->StartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bill_board->EndDate->Visible) { // EndDate ?>
			<td <?php echo $bill_board->EndDate->cellAttributes() ?>>
<span id="el_bill_board_EndDate">
<span<?php echo $bill_board->EndDate->viewAttributes() ?>><?php echo $bill_board->EndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>