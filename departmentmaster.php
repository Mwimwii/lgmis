<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($department->Visible) { ?>
<div id="t_department" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_departmentmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($department->DepartmentName->Visible) { // DepartmentName ?>
			<th class="<?php echo $department->DepartmentName->headerCellClass() ?>"><?php echo $department->DepartmentName->caption() ?></th>
<?php } ?>
<?php if ($department->Telephone->Visible) { // Telephone ?>
			<th class="<?php echo $department->Telephone->headerCellClass() ?>"><?php echo $department->Telephone->caption() ?></th>
<?php } ?>
<?php if ($department->_Email->Visible) { // Email ?>
			<th class="<?php echo $department->_Email->headerCellClass() ?>"><?php echo $department->_Email->caption() ?></th>
<?php } ?>
<?php if ($department->LACode->Visible) { // LACode ?>
			<th class="<?php echo $department->LACode->headerCellClass() ?>"><?php echo $department->LACode->caption() ?></th>
<?php } ?>
<?php if ($department->ProvinceCode->Visible) { // ProvinceCode ?>
			<th class="<?php echo $department->ProvinceCode->headerCellClass() ?>"><?php echo $department->ProvinceCode->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($department->DepartmentName->Visible) { // DepartmentName ?>
			<td <?php echo $department->DepartmentName->cellAttributes() ?>>
<span id="el_department_DepartmentName">
<span<?php echo $department->DepartmentName->viewAttributes() ?>><?php echo $department->DepartmentName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($department->Telephone->Visible) { // Telephone ?>
			<td <?php echo $department->Telephone->cellAttributes() ?>>
<span id="el_department_Telephone">
<span<?php echo $department->Telephone->viewAttributes() ?>><?php echo $department->Telephone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($department->_Email->Visible) { // Email ?>
			<td <?php echo $department->_Email->cellAttributes() ?>>
<span id="el_department__Email">
<span<?php echo $department->_Email->viewAttributes() ?>><?php echo $department->_Email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($department->LACode->Visible) { // LACode ?>
			<td <?php echo $department->LACode->cellAttributes() ?>>
<span id="el_department_LACode">
<span<?php echo $department->LACode->viewAttributes() ?>><?php echo $department->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($department->ProvinceCode->Visible) { // ProvinceCode ?>
			<td <?php echo $department->ProvinceCode->cellAttributes() ?>>
<span id="el_department_ProvinceCode">
<span<?php echo $department->ProvinceCode->viewAttributes() ?>><?php echo $department->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>