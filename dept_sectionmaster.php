<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($dept_section->Visible) { ?>
<div id="t_dept_section" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_dept_sectionmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($dept_section->SectionName->Visible) { // SectionName ?>
			<th class="<?php echo $dept_section->SectionName->headerCellClass() ?>"><?php echo $dept_section->SectionName->caption() ?></th>
<?php } ?>
<?php if ($dept_section->Telephone->Visible) { // Telephone ?>
			<th class="<?php echo $dept_section->Telephone->headerCellClass() ?>"><?php echo $dept_section->Telephone->caption() ?></th>
<?php } ?>
<?php if ($dept_section->_Email->Visible) { // Email ?>
			<th class="<?php echo $dept_section->_Email->headerCellClass() ?>"><?php echo $dept_section->_Email->caption() ?></th>
<?php } ?>
<?php if ($dept_section->ProvinceCode->Visible) { // ProvinceCode ?>
			<th class="<?php echo $dept_section->ProvinceCode->headerCellClass() ?>"><?php echo $dept_section->ProvinceCode->caption() ?></th>
<?php } ?>
<?php if ($dept_section->LACode->Visible) { // LACode ?>
			<th class="<?php echo $dept_section->LACode->headerCellClass() ?>"><?php echo $dept_section->LACode->caption() ?></th>
<?php } ?>
<?php if ($dept_section->DepartmentCode->Visible) { // DepartmentCode ?>
			<th class="<?php echo $dept_section->DepartmentCode->headerCellClass() ?>"><?php echo $dept_section->DepartmentCode->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($dept_section->SectionName->Visible) { // SectionName ?>
			<td <?php echo $dept_section->SectionName->cellAttributes() ?>>
<span id="el_dept_section_SectionName">
<span<?php echo $dept_section->SectionName->viewAttributes() ?>><?php echo $dept_section->SectionName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dept_section->Telephone->Visible) { // Telephone ?>
			<td <?php echo $dept_section->Telephone->cellAttributes() ?>>
<span id="el_dept_section_Telephone">
<span<?php echo $dept_section->Telephone->viewAttributes() ?>><?php echo $dept_section->Telephone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dept_section->_Email->Visible) { // Email ?>
			<td <?php echo $dept_section->_Email->cellAttributes() ?>>
<span id="el_dept_section__Email">
<span<?php echo $dept_section->_Email->viewAttributes() ?>><?php echo $dept_section->_Email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dept_section->ProvinceCode->Visible) { // ProvinceCode ?>
			<td <?php echo $dept_section->ProvinceCode->cellAttributes() ?>>
<span id="el_dept_section_ProvinceCode">
<span<?php echo $dept_section->ProvinceCode->viewAttributes() ?>><?php echo $dept_section->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dept_section->LACode->Visible) { // LACode ?>
			<td <?php echo $dept_section->LACode->cellAttributes() ?>>
<span id="el_dept_section_LACode">
<span<?php echo $dept_section->LACode->viewAttributes() ?>><?php echo $dept_section->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dept_section->DepartmentCode->Visible) { // DepartmentCode ?>
			<td <?php echo $dept_section->DepartmentCode->cellAttributes() ?>>
<span id="el_dept_section_DepartmentCode">
<span<?php echo $dept_section->DepartmentCode->viewAttributes() ?>><?php echo $dept_section->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>