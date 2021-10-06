<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($project->Visible) { ?>
<div id="t_project" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_projectmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($project->ProvinceCode->Visible) { // ProvinceCode ?>
			<th class="<?php echo $project->ProvinceCode->headerCellClass() ?>"><?php echo $project->ProvinceCode->caption() ?></th>
<?php } ?>
<?php if ($project->LACode->Visible) { // LACode ?>
			<th class="<?php echo $project->LACode->headerCellClass() ?>"><?php echo $project->LACode->caption() ?></th>
<?php } ?>
<?php if ($project->ProjectCode->Visible) { // ProjectCode ?>
			<th class="<?php echo $project->ProjectCode->headerCellClass() ?>"><?php echo $project->ProjectCode->caption() ?></th>
<?php } ?>
<?php if ($project->ProjectName->Visible) { // ProjectName ?>
			<th class="<?php echo $project->ProjectName->headerCellClass() ?>"><?php echo $project->ProjectName->caption() ?></th>
<?php } ?>
<?php if ($project->ProjectType->Visible) { // ProjectType ?>
			<th class="<?php echo $project->ProjectType->headerCellClass() ?>"><?php echo $project->ProjectType->caption() ?></th>
<?php } ?>
<?php if ($project->ProjectSector->Visible) { // ProjectSector ?>
			<th class="<?php echo $project->ProjectSector->headerCellClass() ?>"><?php echo $project->ProjectSector->caption() ?></th>
<?php } ?>
<?php if ($project->Contractors->Visible) { // Contractors ?>
			<th class="<?php echo $project->Contractors->headerCellClass() ?>"><?php echo $project->Contractors->caption() ?></th>
<?php } ?>
<?php if ($project->PlannedStartDate->Visible) { // PlannedStartDate ?>
			<th class="<?php echo $project->PlannedStartDate->headerCellClass() ?>"><?php echo $project->PlannedStartDate->caption() ?></th>
<?php } ?>
<?php if ($project->PlannedEndDate->Visible) { // PlannedEndDate ?>
			<th class="<?php echo $project->PlannedEndDate->headerCellClass() ?>"><?php echo $project->PlannedEndDate->caption() ?></th>
<?php } ?>
<?php if ($project->ActualStartDate->Visible) { // ActualStartDate ?>
			<th class="<?php echo $project->ActualStartDate->headerCellClass() ?>"><?php echo $project->ActualStartDate->caption() ?></th>
<?php } ?>
<?php if ($project->ActualEndDate->Visible) { // ActualEndDate ?>
			<th class="<?php echo $project->ActualEndDate->headerCellClass() ?>"><?php echo $project->ActualEndDate->caption() ?></th>
<?php } ?>
<?php if ($project->Budget->Visible) { // Budget ?>
			<th class="<?php echo $project->Budget->headerCellClass() ?>"><?php echo $project->Budget->caption() ?></th>
<?php } ?>
<?php if ($project->ProgressStatus->Visible) { // ProgressStatus ?>
			<th class="<?php echo $project->ProgressStatus->headerCellClass() ?>"><?php echo $project->ProgressStatus->caption() ?></th>
<?php } ?>
<?php if ($project->OutstandingTasks->Visible) { // OutstandingTasks ?>
			<th class="<?php echo $project->OutstandingTasks->headerCellClass() ?>"><?php echo $project->OutstandingTasks->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($project->ProvinceCode->Visible) { // ProvinceCode ?>
			<td <?php echo $project->ProvinceCode->cellAttributes() ?>>
<span id="el_project_ProvinceCode">
<span<?php echo $project->ProvinceCode->viewAttributes() ?>><?php echo $project->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project->LACode->Visible) { // LACode ?>
			<td <?php echo $project->LACode->cellAttributes() ?>>
<span id="el_project_LACode">
<span<?php echo $project->LACode->viewAttributes() ?>><?php echo $project->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project->ProjectCode->Visible) { // ProjectCode ?>
			<td <?php echo $project->ProjectCode->cellAttributes() ?>>
<span id="el_project_ProjectCode">
<span<?php echo $project->ProjectCode->viewAttributes() ?>><?php echo $project->ProjectCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project->ProjectName->Visible) { // ProjectName ?>
			<td <?php echo $project->ProjectName->cellAttributes() ?>>
<span id="el_project_ProjectName">
<span<?php echo $project->ProjectName->viewAttributes() ?>><?php echo $project->ProjectName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project->ProjectType->Visible) { // ProjectType ?>
			<td <?php echo $project->ProjectType->cellAttributes() ?>>
<span id="el_project_ProjectType">
<span<?php echo $project->ProjectType->viewAttributes() ?>><?php echo $project->ProjectType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project->ProjectSector->Visible) { // ProjectSector ?>
			<td <?php echo $project->ProjectSector->cellAttributes() ?>>
<span id="el_project_ProjectSector">
<span<?php echo $project->ProjectSector->viewAttributes() ?>><?php echo $project->ProjectSector->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project->Contractors->Visible) { // Contractors ?>
			<td <?php echo $project->Contractors->cellAttributes() ?>>
<span id="el_project_Contractors">
<span<?php echo $project->Contractors->viewAttributes() ?>><?php echo $project->Contractors->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project->PlannedStartDate->Visible) { // PlannedStartDate ?>
			<td <?php echo $project->PlannedStartDate->cellAttributes() ?>>
<span id="el_project_PlannedStartDate">
<span<?php echo $project->PlannedStartDate->viewAttributes() ?>><?php echo $project->PlannedStartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project->PlannedEndDate->Visible) { // PlannedEndDate ?>
			<td <?php echo $project->PlannedEndDate->cellAttributes() ?>>
<span id="el_project_PlannedEndDate">
<span<?php echo $project->PlannedEndDate->viewAttributes() ?>><?php echo $project->PlannedEndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project->ActualStartDate->Visible) { // ActualStartDate ?>
			<td <?php echo $project->ActualStartDate->cellAttributes() ?>>
<span id="el_project_ActualStartDate">
<span<?php echo $project->ActualStartDate->viewAttributes() ?>><?php echo $project->ActualStartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project->ActualEndDate->Visible) { // ActualEndDate ?>
			<td <?php echo $project->ActualEndDate->cellAttributes() ?>>
<span id="el_project_ActualEndDate">
<span<?php echo $project->ActualEndDate->viewAttributes() ?>><?php echo $project->ActualEndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project->Budget->Visible) { // Budget ?>
			<td <?php echo $project->Budget->cellAttributes() ?>>
<span id="el_project_Budget">
<span<?php echo $project->Budget->viewAttributes() ?>><?php echo $project->Budget->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project->ProgressStatus->Visible) { // ProgressStatus ?>
			<td <?php echo $project->ProgressStatus->cellAttributes() ?>>
<span id="el_project_ProgressStatus">
<span<?php echo $project->ProgressStatus->viewAttributes() ?>><?php echo $project->ProgressStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($project->OutstandingTasks->Visible) { // OutstandingTasks ?>
			<td <?php echo $project->OutstandingTasks->cellAttributes() ?>>
<span id="el_project_OutstandingTasks">
<span<?php echo $project->OutstandingTasks->viewAttributes() ?>><?php echo $project->OutstandingTasks->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>