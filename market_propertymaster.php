<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($market_property->Visible) { ?>
<div id="t_market_property" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_market_propertymaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($market_property->MarketItemNo->Visible) { // MarketItemNo ?>
			<th class="<?php echo $market_property->MarketItemNo->headerCellClass() ?>"><?php echo $market_property->MarketItemNo->caption() ?></th>
<?php } ?>
<?php if ($market_property->MarketNo->Visible) { // MarketNo ?>
			<th class="<?php echo $market_property->MarketNo->headerCellClass() ?>"><?php echo $market_property->MarketNo->caption() ?></th>
<?php } ?>
<?php if ($market_property->ItemName->Visible) { // ItemName ?>
			<th class="<?php echo $market_property->ItemName->headerCellClass() ?>"><?php echo $market_property->ItemName->caption() ?></th>
<?php } ?>
<?php if ($market_property->ItemRef->Visible) { // ItemRef ?>
			<th class="<?php echo $market_property->ItemRef->headerCellClass() ?>"><?php echo $market_property->ItemRef->caption() ?></th>
<?php } ?>
<?php if ($market_property->ItemLength->Visible) { // ItemLength ?>
			<th class="<?php echo $market_property->ItemLength->headerCellClass() ?>"><?php echo $market_property->ItemLength->caption() ?></th>
<?php } ?>
<?php if ($market_property->ItemWidth->Visible) { // ItemWidth ?>
			<th class="<?php echo $market_property->ItemWidth->headerCellClass() ?>"><?php echo $market_property->ItemWidth->caption() ?></th>
<?php } ?>
<?php if ($market_property->DefaultFees->Visible) { // DefaultFees ?>
			<th class="<?php echo $market_property->DefaultFees->headerCellClass() ?>"><?php echo $market_property->DefaultFees->caption() ?></th>
<?php } ?>
<?php if ($market_property->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
			<th class="<?php echo $market_property->LastUpdatedBy->headerCellClass() ?>"><?php echo $market_property->LastUpdatedBy->caption() ?></th>
<?php } ?>
<?php if ($market_property->LastUpdateDate->Visible) { // LastUpdateDate ?>
			<th class="<?php echo $market_property->LastUpdateDate->headerCellClass() ?>"><?php echo $market_property->LastUpdateDate->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($market_property->MarketItemNo->Visible) { // MarketItemNo ?>
			<td <?php echo $market_property->MarketItemNo->cellAttributes() ?>>
<span id="el_market_property_MarketItemNo">
<span<?php echo $market_property->MarketItemNo->viewAttributes() ?>><?php echo $market_property->MarketItemNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($market_property->MarketNo->Visible) { // MarketNo ?>
			<td <?php echo $market_property->MarketNo->cellAttributes() ?>>
<span id="el_market_property_MarketNo">
<span<?php echo $market_property->MarketNo->viewAttributes() ?>><?php echo $market_property->MarketNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($market_property->ItemName->Visible) { // ItemName ?>
			<td <?php echo $market_property->ItemName->cellAttributes() ?>>
<span id="el_market_property_ItemName">
<span<?php echo $market_property->ItemName->viewAttributes() ?>><?php echo $market_property->ItemName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($market_property->ItemRef->Visible) { // ItemRef ?>
			<td <?php echo $market_property->ItemRef->cellAttributes() ?>>
<span id="el_market_property_ItemRef">
<span<?php echo $market_property->ItemRef->viewAttributes() ?>><?php echo $market_property->ItemRef->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($market_property->ItemLength->Visible) { // ItemLength ?>
			<td <?php echo $market_property->ItemLength->cellAttributes() ?>>
<span id="el_market_property_ItemLength">
<span<?php echo $market_property->ItemLength->viewAttributes() ?>><?php echo $market_property->ItemLength->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($market_property->ItemWidth->Visible) { // ItemWidth ?>
			<td <?php echo $market_property->ItemWidth->cellAttributes() ?>>
<span id="el_market_property_ItemWidth">
<span<?php echo $market_property->ItemWidth->viewAttributes() ?>><?php echo $market_property->ItemWidth->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($market_property->DefaultFees->Visible) { // DefaultFees ?>
			<td <?php echo $market_property->DefaultFees->cellAttributes() ?>>
<span id="el_market_property_DefaultFees">
<span<?php echo $market_property->DefaultFees->viewAttributes() ?>><?php echo $market_property->DefaultFees->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($market_property->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
			<td <?php echo $market_property->LastUpdatedBy->cellAttributes() ?>>
<span id="el_market_property_LastUpdatedBy">
<span<?php echo $market_property->LastUpdatedBy->viewAttributes() ?>><?php echo $market_property->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($market_property->LastUpdateDate->Visible) { // LastUpdateDate ?>
			<td <?php echo $market_property->LastUpdateDate->cellAttributes() ?>>
<span id="el_market_property_LastUpdateDate">
<span<?php echo $market_property->LastUpdateDate->viewAttributes() ?>><?php echo $market_property->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>