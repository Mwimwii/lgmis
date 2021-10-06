<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($position_ref->Visible) { ?>
<div id="t_position_ref" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_position_refmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($position_ref->PositionCode->Visible) { // PositionCode ?>
			<th class="<?php echo $position_ref->PositionCode->headerCellClass() ?>"><?php echo $position_ref->PositionCode->caption() ?></th>
<?php } ?>
<?php if ($position_ref->PositionName->Visible) { // PositionName ?>
			<th class="<?php echo $position_ref->PositionName->headerCellClass() ?>"><?php echo $position_ref->PositionName->caption() ?></th>
<?php } ?>
<?php if ($position_ref->RequisiteQualification->Visible) { // RequisiteQualification ?>
			<th class="<?php echo $position_ref->RequisiteQualification->headerCellClass() ?>"><?php echo $position_ref->RequisiteQualification->caption() ?></th>
<?php } ?>
<?php if ($position_ref->JobCode->Visible) { // JobCode ?>
			<th class="<?php echo $position_ref->JobCode->headerCellClass() ?>"><?php echo $position_ref->JobCode->caption() ?></th>
<?php } ?>
<?php if ($position_ref->SalaryScale->Visible) { // SalaryScale ?>
			<th class="<?php echo $position_ref->SalaryScale->headerCellClass() ?>"><?php echo $position_ref->SalaryScale->caption() ?></th>
<?php } ?>
<?php if ($position_ref->ProvinceCode->Visible) { // ProvinceCode ?>
			<th class="<?php echo $position_ref->ProvinceCode->headerCellClass() ?>"><?php echo $position_ref->ProvinceCode->caption() ?></th>
<?php } ?>
<?php if ($position_ref->LACode->Visible) { // LACode ?>
			<th class="<?php echo $position_ref->LACode->headerCellClass() ?>"><?php echo $position_ref->LACode->caption() ?></th>
<?php } ?>
<?php if ($position_ref->DepartmentCode->Visible) { // DepartmentCode ?>
			<th class="<?php echo $position_ref->DepartmentCode->headerCellClass() ?>"><?php echo $position_ref->DepartmentCode->caption() ?></th>
<?php } ?>
<?php if ($position_ref->FieldQualified->Visible) { // FieldQualified ?>
			<th class="<?php echo $position_ref->FieldQualified->headerCellClass() ?>"><?php echo $position_ref->FieldQualified->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($position_ref->PositionCode->Visible) { // PositionCode ?>
			<td <?php echo $position_ref->PositionCode->cellAttributes() ?>>
<span id="el_position_ref_PositionCode">
<span<?php echo $position_ref->PositionCode->viewAttributes() ?>><?php echo $position_ref->PositionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($position_ref->PositionName->Visible) { // PositionName ?>
			<td <?php echo $position_ref->PositionName->cellAttributes() ?>>
<span id="el_position_ref_PositionName">
<span<?php echo $position_ref->PositionName->viewAttributes() ?>><?php echo $position_ref->PositionName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($position_ref->RequisiteQualification->Visible) { // RequisiteQualification ?>
			<td <?php echo $position_ref->RequisiteQualification->cellAttributes() ?>>
<span id="el_position_ref_RequisiteQualification">
<span<?php echo $position_ref->RequisiteQualification->viewAttributes() ?>><?php echo $position_ref->RequisiteQualification->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($position_ref->JobCode->Visible) { // JobCode ?>
			<td <?php echo $position_ref->JobCode->cellAttributes() ?>>
<span id="el_position_ref_JobCode">
<span<?php echo $position_ref->JobCode->viewAttributes() ?>><?php echo $position_ref->JobCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($position_ref->SalaryScale->Visible) { // SalaryScale ?>
			<td <?php echo $position_ref->SalaryScale->cellAttributes() ?>>
<span id="el_position_ref_SalaryScale">
<span<?php echo $position_ref->SalaryScale->viewAttributes() ?>><?php echo $position_ref->SalaryScale->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($position_ref->ProvinceCode->Visible) { // ProvinceCode ?>
			<td <?php echo $position_ref->ProvinceCode->cellAttributes() ?>>
<span id="el_position_ref_ProvinceCode">
<span<?php echo $position_ref->ProvinceCode->viewAttributes() ?>><?php echo $position_ref->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($position_ref->LACode->Visible) { // LACode ?>
			<td <?php echo $position_ref->LACode->cellAttributes() ?>>
<span id="el_position_ref_LACode">
<span<?php echo $position_ref->LACode->viewAttributes() ?>><?php echo $position_ref->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($position_ref->DepartmentCode->Visible) { // DepartmentCode ?>
			<td <?php echo $position_ref->DepartmentCode->cellAttributes() ?>>
<span id="el_position_ref_DepartmentCode">
<span<?php echo $position_ref->DepartmentCode->viewAttributes() ?>><?php echo $position_ref->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($position_ref->FieldQualified->Visible) { // FieldQualified ?>
			<td <?php echo $position_ref->FieldQualified->cellAttributes() ?>>
<span id="el_position_ref_FieldQualified">
<span<?php echo $position_ref->FieldQualified->viewAttributes() ?>><?php echo $position_ref->FieldQualified->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>