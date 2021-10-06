<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($division->Visible) { ?>
<div id="t_division" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_divisionmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($division->Division->Visible) { // Division ?>
			<th class="<?php echo $division->Division->headerCellClass() ?>"><?php echo $division->Division->caption() ?></th>
<?php } ?>
<?php if ($division->DivisionName->Visible) { // DivisionName ?>
			<th class="<?php echo $division->DivisionName->headerCellClass() ?>"><?php echo $division->DivisionName->caption() ?></th>
<?php } ?>
<?php if ($division->Comments->Visible) { // Comments ?>
			<th class="<?php echo $division->Comments->headerCellClass() ?>"><?php echo $division->Comments->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($division->Division->Visible) { // Division ?>
			<td <?php echo $division->Division->cellAttributes() ?>>
<span id="el_division_Division">
<span<?php echo $division->Division->viewAttributes() ?>><?php echo $division->Division->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($division->DivisionName->Visible) { // DivisionName ?>
			<td <?php echo $division->DivisionName->cellAttributes() ?>>
<span id="el_division_DivisionName">
<span<?php echo $division->DivisionName->viewAttributes() ?>><?php echo $division->DivisionName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($division->Comments->Visible) { // Comments ?>
			<td <?php echo $division->Comments->cellAttributes() ?>>
<span id="el_division_Comments">
<span<?php echo $division->Comments->viewAttributes() ?>><?php echo $division->Comments->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>