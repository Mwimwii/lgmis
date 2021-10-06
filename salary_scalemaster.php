<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($salary_scale->Visible) { ?>
<div id="t_salary_scale" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_salary_scalemaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($salary_scale->Division->Visible) { // Division ?>
			<th class="<?php echo $salary_scale->Division->headerCellClass() ?>"><?php echo $salary_scale->Division->caption() ?></th>
<?php } ?>
<?php if ($salary_scale->SalaryScale->Visible) { // SalaryScale ?>
			<th class="<?php echo $salary_scale->SalaryScale->headerCellClass() ?>"><?php echo $salary_scale->SalaryScale->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($salary_scale->Division->Visible) { // Division ?>
			<td <?php echo $salary_scale->Division->cellAttributes() ?>>
<span id="el_salary_scale_Division">
<span<?php echo $salary_scale->Division->viewAttributes() ?>><?php echo $salary_scale->Division->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($salary_scale->SalaryScale->Visible) { // SalaryScale ?>
			<td <?php echo $salary_scale->SalaryScale->cellAttributes() ?>>
<span id="el_salary_scale_SalaryScale">
<span<?php echo $salary_scale->SalaryScale->viewAttributes() ?>><?php echo $salary_scale->SalaryScale->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>