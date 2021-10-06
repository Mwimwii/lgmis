<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($strategic_objective->Visible) { ?>
<div id="t_strategic_objective" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_strategic_objectivemaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($strategic_objective->LACode->Visible) { // LACode ?>
			<th class="<?php echo $strategic_objective->LACode->headerCellClass() ?>"><?php echo $strategic_objective->LACode->caption() ?></th>
<?php } ?>
<?php if ($strategic_objective->DepartmentCode->Visible) { // DepartmentCode ?>
			<th class="<?php echo $strategic_objective->DepartmentCode->headerCellClass() ?>"><?php echo $strategic_objective->DepartmentCode->caption() ?></th>
<?php } ?>
<?php if ($strategic_objective->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
			<th class="<?php echo $strategic_objective->StrategicObjectiveCode->headerCellClass() ?>"><?php echo $strategic_objective->StrategicObjectiveCode->caption() ?></th>
<?php } ?>
<?php if ($strategic_objective->StrategicObjectiveName->Visible) { // StrategicObjectiveName ?>
			<th class="<?php echo $strategic_objective->StrategicObjectiveName->headerCellClass() ?>"><?php echo $strategic_objective->StrategicObjectiveName->caption() ?></th>
<?php } ?>
<?php if ($strategic_objective->ReferencedDocs->Visible) { // ReferencedDocs ?>
			<th class="<?php echo $strategic_objective->ReferencedDocs->headerCellClass() ?>"><?php echo $strategic_objective->ReferencedDocs->caption() ?></th>
<?php } ?>
<?php if ($strategic_objective->ResultAreaCode->Visible) { // ResultAreaCode ?>
			<th class="<?php echo $strategic_objective->ResultAreaCode->headerCellClass() ?>"><?php echo $strategic_objective->ResultAreaCode->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($strategic_objective->LACode->Visible) { // LACode ?>
			<td <?php echo $strategic_objective->LACode->cellAttributes() ?>>
<span id="el_strategic_objective_LACode">
<span<?php echo $strategic_objective->LACode->viewAttributes() ?>><?php echo $strategic_objective->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($strategic_objective->DepartmentCode->Visible) { // DepartmentCode ?>
			<td <?php echo $strategic_objective->DepartmentCode->cellAttributes() ?>>
<span id="el_strategic_objective_DepartmentCode">
<span<?php echo $strategic_objective->DepartmentCode->viewAttributes() ?>><?php echo $strategic_objective->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($strategic_objective->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
			<td <?php echo $strategic_objective->StrategicObjectiveCode->cellAttributes() ?>>
<span id="el_strategic_objective_StrategicObjectiveCode">
<span<?php echo $strategic_objective->StrategicObjectiveCode->viewAttributes() ?>><?php echo $strategic_objective->StrategicObjectiveCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($strategic_objective->StrategicObjectiveName->Visible) { // StrategicObjectiveName ?>
			<td <?php echo $strategic_objective->StrategicObjectiveName->cellAttributes() ?>>
<span id="el_strategic_objective_StrategicObjectiveName">
<span<?php echo $strategic_objective->StrategicObjectiveName->viewAttributes() ?>><?php echo $strategic_objective->StrategicObjectiveName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($strategic_objective->ReferencedDocs->Visible) { // ReferencedDocs ?>
			<td <?php echo $strategic_objective->ReferencedDocs->cellAttributes() ?>>
<span id="el_strategic_objective_ReferencedDocs">
<span<?php echo $strategic_objective->ReferencedDocs->viewAttributes() ?>><?php echo $strategic_objective->ReferencedDocs->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($strategic_objective->ResultAreaCode->Visible) { // ResultAreaCode ?>
			<td <?php echo $strategic_objective->ResultAreaCode->cellAttributes() ?>>
<span id="el_strategic_objective_ResultAreaCode">
<span<?php echo $strategic_objective->ResultAreaCode->viewAttributes() ?>><?php echo $strategic_objective->ResultAreaCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>