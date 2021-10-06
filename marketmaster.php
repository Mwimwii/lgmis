<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($market->Visible) { ?>
<div id="t_market" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_marketmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($market->MarketNo->Visible) { // MarketNo ?>
			<th class="<?php echo $market->MarketNo->headerCellClass() ?>"><?php echo $market->MarketNo->caption() ?></th>
<?php } ?>
<?php if ($market->MarketName->Visible) { // MarketName ?>
			<th class="<?php echo $market->MarketName->headerCellClass() ?>"><?php echo $market->MarketName->caption() ?></th>
<?php } ?>
<?php if ($market->MarketDesc->Visible) { // MarketDesc ?>
			<th class="<?php echo $market->MarketDesc->headerCellClass() ?>"><?php echo $market->MarketDesc->caption() ?></th>
<?php } ?>
<?php if ($market->MarketMaster->Visible) { // MarketMaster ?>
			<th class="<?php echo $market->MarketMaster->headerCellClass() ?>"><?php echo $market->MarketMaster->caption() ?></th>
<?php } ?>
<?php if ($market->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
			<th class="<?php echo $market->LastUpdatedBy->headerCellClass() ?>"><?php echo $market->LastUpdatedBy->caption() ?></th>
<?php } ?>
<?php if ($market->LastUpdateDate->Visible) { // LastUpdateDate ?>
			<th class="<?php echo $market->LastUpdateDate->headerCellClass() ?>"><?php echo $market->LastUpdateDate->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($market->MarketNo->Visible) { // MarketNo ?>
			<td <?php echo $market->MarketNo->cellAttributes() ?>>
<span id="el_market_MarketNo">
<span<?php echo $market->MarketNo->viewAttributes() ?>><?php echo $market->MarketNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($market->MarketName->Visible) { // MarketName ?>
			<td <?php echo $market->MarketName->cellAttributes() ?>>
<span id="el_market_MarketName">
<span<?php echo $market->MarketName->viewAttributes() ?>><?php echo $market->MarketName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($market->MarketDesc->Visible) { // MarketDesc ?>
			<td <?php echo $market->MarketDesc->cellAttributes() ?>>
<span id="el_market_MarketDesc">
<span<?php echo $market->MarketDesc->viewAttributes() ?>><?php echo $market->MarketDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($market->MarketMaster->Visible) { // MarketMaster ?>
			<td <?php echo $market->MarketMaster->cellAttributes() ?>>
<span id="el_market_MarketMaster">
<span<?php echo $market->MarketMaster->viewAttributes() ?>><?php echo $market->MarketMaster->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($market->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
			<td <?php echo $market->LastUpdatedBy->cellAttributes() ?>>
<span id="el_market_LastUpdatedBy">
<span<?php echo $market->LastUpdatedBy->viewAttributes() ?>><?php echo $market->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($market->LastUpdateDate->Visible) { // LastUpdateDate ?>
			<td <?php echo $market->LastUpdateDate->cellAttributes() ?>>
<span id="el_market_LastUpdateDate">
<span<?php echo $market->LastUpdateDate->viewAttributes() ?>><?php echo $market->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>