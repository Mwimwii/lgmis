<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($outcome->Visible) { ?>
<div id="t_outcome" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_outcomemaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($outcome->OutcomeCode->Visible) { // OutcomeCode ?>
			<th class="<?php echo $outcome->OutcomeCode->headerCellClass() ?>"><?php echo $outcome->OutcomeCode->caption() ?></th>
<?php } ?>
<?php if ($outcome->OutcomeName->Visible) { // OutcomeName ?>
			<th class="<?php echo $outcome->OutcomeName->headerCellClass() ?>"><?php echo $outcome->OutcomeName->caption() ?></th>
<?php } ?>
<?php if ($outcome->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
			<th class="<?php echo $outcome->StrategicObjectiveCode->headerCellClass() ?>"><?php echo $outcome->StrategicObjectiveCode->caption() ?></th>
<?php } ?>
<?php if ($outcome->LACode->Visible) { // LACode ?>
			<th class="<?php echo $outcome->LACode->headerCellClass() ?>"><?php echo $outcome->LACode->caption() ?></th>
<?php } ?>
<?php if ($outcome->DepartmentCode->Visible) { // DepartmentCode ?>
			<th class="<?php echo $outcome->DepartmentCode->headerCellClass() ?>"><?php echo $outcome->DepartmentCode->caption() ?></th>
<?php } ?>
<?php if ($outcome->OutcomeKPI->Visible) { // OutcomeKPI ?>
			<th class="<?php echo $outcome->OutcomeKPI->headerCellClass() ?>"><?php echo $outcome->OutcomeKPI->caption() ?></th>
<?php } ?>
<?php if ($outcome->Assumptions->Visible) { // Assumptions ?>
			<th class="<?php echo $outcome->Assumptions->headerCellClass() ?>"><?php echo $outcome->Assumptions->caption() ?></th>
<?php } ?>
<?php if ($outcome->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
			<th class="<?php echo $outcome->ResponsibleOfficer->headerCellClass() ?>"><?php echo $outcome->ResponsibleOfficer->caption() ?></th>
<?php } ?>
<?php if ($outcome->OutcomeStatus->Visible) { // OutcomeStatus ?>
			<th class="<?php echo $outcome->OutcomeStatus->headerCellClass() ?>"><?php echo $outcome->OutcomeStatus->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($outcome->OutcomeCode->Visible) { // OutcomeCode ?>
			<td <?php echo $outcome->OutcomeCode->cellAttributes() ?>>
<span id="el_outcome_OutcomeCode">
<span<?php echo $outcome->OutcomeCode->viewAttributes() ?>><?php echo $outcome->OutcomeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($outcome->OutcomeName->Visible) { // OutcomeName ?>
			<td <?php echo $outcome->OutcomeName->cellAttributes() ?>>
<span id="el_outcome_OutcomeName">
<span<?php echo $outcome->OutcomeName->viewAttributes() ?>><?php echo $outcome->OutcomeName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($outcome->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
			<td <?php echo $outcome->StrategicObjectiveCode->cellAttributes() ?>>
<span id="el_outcome_StrategicObjectiveCode">
<span<?php echo $outcome->StrategicObjectiveCode->viewAttributes() ?>><?php echo $outcome->StrategicObjectiveCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($outcome->LACode->Visible) { // LACode ?>
			<td <?php echo $outcome->LACode->cellAttributes() ?>>
<span id="el_outcome_LACode">
<span<?php echo $outcome->LACode->viewAttributes() ?>><?php echo $outcome->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($outcome->DepartmentCode->Visible) { // DepartmentCode ?>
			<td <?php echo $outcome->DepartmentCode->cellAttributes() ?>>
<span id="el_outcome_DepartmentCode">
<span<?php echo $outcome->DepartmentCode->viewAttributes() ?>><?php echo $outcome->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($outcome->OutcomeKPI->Visible) { // OutcomeKPI ?>
			<td <?php echo $outcome->OutcomeKPI->cellAttributes() ?>>
<span id="el_outcome_OutcomeKPI">
<span<?php echo $outcome->OutcomeKPI->viewAttributes() ?>><?php echo $outcome->OutcomeKPI->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($outcome->Assumptions->Visible) { // Assumptions ?>
			<td <?php echo $outcome->Assumptions->cellAttributes() ?>>
<span id="el_outcome_Assumptions">
<span<?php echo $outcome->Assumptions->viewAttributes() ?>><?php echo $outcome->Assumptions->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($outcome->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
			<td <?php echo $outcome->ResponsibleOfficer->cellAttributes() ?>>
<span id="el_outcome_ResponsibleOfficer">
<span<?php echo $outcome->ResponsibleOfficer->viewAttributes() ?>><?php echo $outcome->ResponsibleOfficer->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($outcome->OutcomeStatus->Visible) { // OutcomeStatus ?>
			<td <?php echo $outcome->OutcomeStatus->cellAttributes() ?>>
<span id="el_outcome_OutcomeStatus">
<span<?php echo $outcome->OutcomeStatus->viewAttributes() ?>><?php echo $outcome->OutcomeStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>