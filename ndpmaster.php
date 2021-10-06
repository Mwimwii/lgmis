<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($ndp->Visible) { ?>
<div id="t_ndp" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_ndpmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($ndp->NDP->Visible) { // NDP ?>
			<th class="<?php echo $ndp->NDP->headerCellClass() ?>"><?php echo $ndp->NDP->caption() ?></th>
<?php } ?>
<?php if ($ndp->NDPShortName->Visible) { // NDPShortName ?>
			<th class="<?php echo $ndp->NDPShortName->headerCellClass() ?>"><?php echo $ndp->NDPShortName->caption() ?></th>
<?php } ?>
<?php if ($ndp->FromYear->Visible) { // FromYear ?>
			<th class="<?php echo $ndp->FromYear->headerCellClass() ?>"><?php echo $ndp->FromYear->caption() ?></th>
<?php } ?>
<?php if ($ndp->ToYear->Visible) { // ToYear ?>
			<th class="<?php echo $ndp->ToYear->headerCellClass() ?>"><?php echo $ndp->ToYear->caption() ?></th>
<?php } ?>
<?php if ($ndp->NDPObjectives->Visible) { // NDPObjectives ?>
			<th class="<?php echo $ndp->NDPObjectives->headerCellClass() ?>"><?php echo $ndp->NDPObjectives->caption() ?></th>
<?php } ?>
<?php if ($ndp->EffectiveDate->Visible) { // EffectiveDate ?>
			<th class="<?php echo $ndp->EffectiveDate->headerCellClass() ?>"><?php echo $ndp->EffectiveDate->caption() ?></th>
<?php } ?>
<?php if ($ndp->NDPURL->Visible) { // NDPURL ?>
			<th class="<?php echo $ndp->NDPURL->headerCellClass() ?>"><?php echo $ndp->NDPURL->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($ndp->NDP->Visible) { // NDP ?>
			<td <?php echo $ndp->NDP->cellAttributes() ?>>
<span id="el_ndp_NDP">
<span<?php echo $ndp->NDP->viewAttributes() ?>><?php echo $ndp->NDP->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ndp->NDPShortName->Visible) { // NDPShortName ?>
			<td <?php echo $ndp->NDPShortName->cellAttributes() ?>>
<span id="el_ndp_NDPShortName">
<span<?php echo $ndp->NDPShortName->viewAttributes() ?>><?php echo $ndp->NDPShortName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ndp->FromYear->Visible) { // FromYear ?>
			<td <?php echo $ndp->FromYear->cellAttributes() ?>>
<span id="el_ndp_FromYear">
<span<?php echo $ndp->FromYear->viewAttributes() ?>><?php echo $ndp->FromYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ndp->ToYear->Visible) { // ToYear ?>
			<td <?php echo $ndp->ToYear->cellAttributes() ?>>
<span id="el_ndp_ToYear">
<span<?php echo $ndp->ToYear->viewAttributes() ?>><?php echo $ndp->ToYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ndp->NDPObjectives->Visible) { // NDPObjectives ?>
			<td <?php echo $ndp->NDPObjectives->cellAttributes() ?>>
<span id="el_ndp_NDPObjectives">
<span<?php echo $ndp->NDPObjectives->viewAttributes() ?>><?php echo $ndp->NDPObjectives->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ndp->EffectiveDate->Visible) { // EffectiveDate ?>
			<td <?php echo $ndp->EffectiveDate->cellAttributes() ?>>
<span id="el_ndp_EffectiveDate">
<span<?php echo $ndp->EffectiveDate->viewAttributes() ?>><?php echo $ndp->EffectiveDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ndp->NDPURL->Visible) { // NDPURL ?>
			<td <?php echo $ndp->NDPURL->cellAttributes() ?>>
<span id="el_ndp_NDPURL">
<span<?php echo $ndp->NDPURL->viewAttributes() ?>><?php echo $ndp->NDPURL->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>