<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($la_program->Visible) { ?>
<div id="t_la_program" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_la_programmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($la_program->ProgramCode->Visible) { // ProgramCode ?>
			<th class="<?php echo $la_program->ProgramCode->headerCellClass() ?>"><?php echo $la_program->ProgramCode->caption() ?></th>
<?php } ?>
<?php if ($la_program->ProgramName->Visible) { // ProgramName ?>
			<th class="<?php echo $la_program->ProgramName->headerCellClass() ?>"><?php echo $la_program->ProgramName->caption() ?></th>
<?php } ?>
<?php if ($la_program->ProgramPurpose->Visible) { // ProgramPurpose ?>
			<th class="<?php echo $la_program->ProgramPurpose->headerCellClass() ?>"><?php echo $la_program->ProgramPurpose->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($la_program->ProgramCode->Visible) { // ProgramCode ?>
			<td <?php echo $la_program->ProgramCode->cellAttributes() ?>>
<span id="el_la_program_ProgramCode">
<span<?php echo $la_program->ProgramCode->viewAttributes() ?>><?php echo $la_program->ProgramCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($la_program->ProgramName->Visible) { // ProgramName ?>
			<td <?php echo $la_program->ProgramName->cellAttributes() ?>>
<span id="el_la_program_ProgramName">
<span<?php echo $la_program->ProgramName->viewAttributes() ?>><?php echo $la_program->ProgramName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($la_program->ProgramPurpose->Visible) { // ProgramPurpose ?>
			<td <?php echo $la_program->ProgramPurpose->cellAttributes() ?>>
<span id="el_la_program_ProgramPurpose">
<span<?php echo $la_program->ProgramPurpose->viewAttributes() ?>><?php echo $la_program->ProgramPurpose->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>