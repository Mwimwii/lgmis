<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($job_group->Visible) { ?>
<div id="t_job_group" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_job_groupmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($job_group->JobGroupCode->Visible) { // JobGroupCode ?>
			<th class="<?php echo $job_group->JobGroupCode->headerCellClass() ?>"><?php echo $job_group->JobGroupCode->caption() ?></th>
<?php } ?>
<?php if ($job_group->JobGroupName->Visible) { // JobGroupName ?>
			<th class="<?php echo $job_group->JobGroupName->headerCellClass() ?>"><?php echo $job_group->JobGroupName->caption() ?></th>
<?php } ?>
<?php if ($job_group->JobGroupDesc->Visible) { // JobGroupDesc ?>
			<th class="<?php echo $job_group->JobGroupDesc->headerCellClass() ?>"><?php echo $job_group->JobGroupDesc->caption() ?></th>
<?php } ?>
<?php if ($job_group->LastUserID->Visible) { // LastUserID ?>
			<th class="<?php echo $job_group->LastUserID->headerCellClass() ?>"><?php echo $job_group->LastUserID->caption() ?></th>
<?php } ?>
<?php if ($job_group->LastUpdated->Visible) { // LastUpdated ?>
			<th class="<?php echo $job_group->LastUpdated->headerCellClass() ?>"><?php echo $job_group->LastUpdated->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($job_group->JobGroupCode->Visible) { // JobGroupCode ?>
			<td <?php echo $job_group->JobGroupCode->cellAttributes() ?>>
<span id="el_job_group_JobGroupCode">
<span<?php echo $job_group->JobGroupCode->viewAttributes() ?>><?php echo $job_group->JobGroupCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($job_group->JobGroupName->Visible) { // JobGroupName ?>
			<td <?php echo $job_group->JobGroupName->cellAttributes() ?>>
<span id="el_job_group_JobGroupName">
<span<?php echo $job_group->JobGroupName->viewAttributes() ?>><?php echo $job_group->JobGroupName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($job_group->JobGroupDesc->Visible) { // JobGroupDesc ?>
			<td <?php echo $job_group->JobGroupDesc->cellAttributes() ?>>
<span id="el_job_group_JobGroupDesc">
<span<?php echo $job_group->JobGroupDesc->viewAttributes() ?>><?php echo $job_group->JobGroupDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($job_group->LastUserID->Visible) { // LastUserID ?>
			<td <?php echo $job_group->LastUserID->cellAttributes() ?>>
<span id="el_job_group_LastUserID">
<span<?php echo $job_group->LastUserID->viewAttributes() ?>><?php echo $job_group->LastUserID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($job_group->LastUpdated->Visible) { // LastUpdated ?>
			<td <?php echo $job_group->LastUpdated->cellAttributes() ?>>
<span id="el_job_group_LastUpdated">
<span<?php echo $job_group->LastUpdated->viewAttributes() ?>><?php echo $job_group->LastUpdated->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>