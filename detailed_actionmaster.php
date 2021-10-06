<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($detailed_action->Visible) { ?>
<div id="t_detailed_action" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_detailed_actionmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($detailed_action->LACode->Visible) { // LACode ?>
			<th class="<?php echo $detailed_action->LACode->headerCellClass() ?>"><?php echo $detailed_action->LACode->caption() ?></th>
<?php } ?>
<?php if ($detailed_action->DepartmentCode->Visible) { // DepartmentCode ?>
			<th class="<?php echo $detailed_action->DepartmentCode->headerCellClass() ?>"><?php echo $detailed_action->DepartmentCode->caption() ?></th>
<?php } ?>
<?php if ($detailed_action->SectionCode->Visible) { // SectionCode ?>
			<th class="<?php echo $detailed_action->SectionCode->headerCellClass() ?>"><?php echo $detailed_action->SectionCode->caption() ?></th>
<?php } ?>
<?php if ($detailed_action->ProgramCode->Visible) { // ProgramCode ?>
			<th class="<?php echo $detailed_action->ProgramCode->headerCellClass() ?>"><?php echo $detailed_action->ProgramCode->caption() ?></th>
<?php } ?>
<?php if ($detailed_action->SubProgramCode->Visible) { // SubProgramCode ?>
			<th class="<?php echo $detailed_action->SubProgramCode->headerCellClass() ?>"><?php echo $detailed_action->SubProgramCode->caption() ?></th>
<?php } ?>
<?php if ($detailed_action->OutcomeCode->Visible) { // OutcomeCode ?>
			<th class="<?php echo $detailed_action->OutcomeCode->headerCellClass() ?>"><?php echo $detailed_action->OutcomeCode->caption() ?></th>
<?php } ?>
<?php if ($detailed_action->OutputCode->Visible) { // OutputCode ?>
			<th class="<?php echo $detailed_action->OutputCode->headerCellClass() ?>"><?php echo $detailed_action->OutputCode->caption() ?></th>
<?php } ?>
<?php if ($detailed_action->ActionCode->Visible) { // ActionCode ?>
			<th class="<?php echo $detailed_action->ActionCode->headerCellClass() ?>"><?php echo $detailed_action->ActionCode->caption() ?></th>
<?php } ?>
<?php if ($detailed_action->FinancialYear->Visible) { // FinancialYear ?>
			<th class="<?php echo $detailed_action->FinancialYear->headerCellClass() ?>"><?php echo $detailed_action->FinancialYear->caption() ?></th>
<?php } ?>
<?php if ($detailed_action->DetailedActionCode->Visible) { // DetailedActionCode ?>
			<th class="<?php echo $detailed_action->DetailedActionCode->headerCellClass() ?>"><?php echo $detailed_action->DetailedActionCode->caption() ?></th>
<?php } ?>
<?php if ($detailed_action->DetailedActionName->Visible) { // DetailedActionName ?>
			<th class="<?php echo $detailed_action->DetailedActionName->headerCellClass() ?>"><?php echo $detailed_action->DetailedActionName->caption() ?></th>
<?php } ?>
<?php if ($detailed_action->DetailedActionLocation->Visible) { // DetailedActionLocation ?>
			<th class="<?php echo $detailed_action->DetailedActionLocation->headerCellClass() ?>"><?php echo $detailed_action->DetailedActionLocation->caption() ?></th>
<?php } ?>
<?php if ($detailed_action->PlannedStartDate->Visible) { // PlannedStartDate ?>
			<th class="<?php echo $detailed_action->PlannedStartDate->headerCellClass() ?>"><?php echo $detailed_action->PlannedStartDate->caption() ?></th>
<?php } ?>
<?php if ($detailed_action->PlannedEndDate->Visible) { // PlannedEndDate ?>
			<th class="<?php echo $detailed_action->PlannedEndDate->headerCellClass() ?>"><?php echo $detailed_action->PlannedEndDate->caption() ?></th>
<?php } ?>
<?php if ($detailed_action->ActualStartDate->Visible) { // ActualStartDate ?>
			<th class="<?php echo $detailed_action->ActualStartDate->headerCellClass() ?>"><?php echo $detailed_action->ActualStartDate->caption() ?></th>
<?php } ?>
<?php if ($detailed_action->ActualEndDate->Visible) { // ActualEndDate ?>
			<th class="<?php echo $detailed_action->ActualEndDate->headerCellClass() ?>"><?php echo $detailed_action->ActualEndDate->caption() ?></th>
<?php } ?>
<?php if ($detailed_action->Ward->Visible) { // Ward ?>
			<th class="<?php echo $detailed_action->Ward->headerCellClass() ?>"><?php echo $detailed_action->Ward->caption() ?></th>
<?php } ?>
<?php if ($detailed_action->ExpectedResult->Visible) { // ExpectedResult ?>
			<th class="<?php echo $detailed_action->ExpectedResult->headerCellClass() ?>"><?php echo $detailed_action->ExpectedResult->caption() ?></th>
<?php } ?>
<?php if ($detailed_action->Comments->Visible) { // Comments ?>
			<th class="<?php echo $detailed_action->Comments->headerCellClass() ?>"><?php echo $detailed_action->Comments->caption() ?></th>
<?php } ?>
<?php if ($detailed_action->ProgressStatus->Visible) { // ProgressStatus ?>
			<th class="<?php echo $detailed_action->ProgressStatus->headerCellClass() ?>"><?php echo $detailed_action->ProgressStatus->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($detailed_action->LACode->Visible) { // LACode ?>
			<td <?php echo $detailed_action->LACode->cellAttributes() ?>>
<span id="el_detailed_action_LACode">
<span<?php echo $detailed_action->LACode->viewAttributes() ?>><?php echo $detailed_action->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action->DepartmentCode->Visible) { // DepartmentCode ?>
			<td <?php echo $detailed_action->DepartmentCode->cellAttributes() ?>>
<span id="el_detailed_action_DepartmentCode">
<span<?php echo $detailed_action->DepartmentCode->viewAttributes() ?>><?php echo $detailed_action->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action->SectionCode->Visible) { // SectionCode ?>
			<td <?php echo $detailed_action->SectionCode->cellAttributes() ?>>
<span id="el_detailed_action_SectionCode">
<span<?php echo $detailed_action->SectionCode->viewAttributes() ?>><?php echo $detailed_action->SectionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action->ProgramCode->Visible) { // ProgramCode ?>
			<td <?php echo $detailed_action->ProgramCode->cellAttributes() ?>>
<span id="el_detailed_action_ProgramCode">
<span<?php echo $detailed_action->ProgramCode->viewAttributes() ?>><?php echo $detailed_action->ProgramCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action->SubProgramCode->Visible) { // SubProgramCode ?>
			<td <?php echo $detailed_action->SubProgramCode->cellAttributes() ?>>
<span id="el_detailed_action_SubProgramCode">
<span<?php echo $detailed_action->SubProgramCode->viewAttributes() ?>><?php echo $detailed_action->SubProgramCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action->OutcomeCode->Visible) { // OutcomeCode ?>
			<td <?php echo $detailed_action->OutcomeCode->cellAttributes() ?>>
<span id="el_detailed_action_OutcomeCode">
<span<?php echo $detailed_action->OutcomeCode->viewAttributes() ?>><?php echo $detailed_action->OutcomeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action->OutputCode->Visible) { // OutputCode ?>
			<td <?php echo $detailed_action->OutputCode->cellAttributes() ?>>
<span id="el_detailed_action_OutputCode">
<span<?php echo $detailed_action->OutputCode->viewAttributes() ?>><?php echo $detailed_action->OutputCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action->ActionCode->Visible) { // ActionCode ?>
			<td <?php echo $detailed_action->ActionCode->cellAttributes() ?>>
<span id="el_detailed_action_ActionCode">
<span<?php echo $detailed_action->ActionCode->viewAttributes() ?>><?php echo $detailed_action->ActionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action->FinancialYear->Visible) { // FinancialYear ?>
			<td <?php echo $detailed_action->FinancialYear->cellAttributes() ?>>
<span id="el_detailed_action_FinancialYear">
<span<?php echo $detailed_action->FinancialYear->viewAttributes() ?>><?php echo $detailed_action->FinancialYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action->DetailedActionCode->Visible) { // DetailedActionCode ?>
			<td <?php echo $detailed_action->DetailedActionCode->cellAttributes() ?>>
<span id="el_detailed_action_DetailedActionCode">
<span<?php echo $detailed_action->DetailedActionCode->viewAttributes() ?>><?php echo $detailed_action->DetailedActionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action->DetailedActionName->Visible) { // DetailedActionName ?>
			<td <?php echo $detailed_action->DetailedActionName->cellAttributes() ?>>
<span id="el_detailed_action_DetailedActionName">
<span<?php echo $detailed_action->DetailedActionName->viewAttributes() ?>><?php echo $detailed_action->DetailedActionName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action->DetailedActionLocation->Visible) { // DetailedActionLocation ?>
			<td <?php echo $detailed_action->DetailedActionLocation->cellAttributes() ?>>
<span id="el_detailed_action_DetailedActionLocation">
<span<?php echo $detailed_action->DetailedActionLocation->viewAttributes() ?>><?php echo $detailed_action->DetailedActionLocation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action->PlannedStartDate->Visible) { // PlannedStartDate ?>
			<td <?php echo $detailed_action->PlannedStartDate->cellAttributes() ?>>
<span id="el_detailed_action_PlannedStartDate">
<span<?php echo $detailed_action->PlannedStartDate->viewAttributes() ?>><?php echo $detailed_action->PlannedStartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action->PlannedEndDate->Visible) { // PlannedEndDate ?>
			<td <?php echo $detailed_action->PlannedEndDate->cellAttributes() ?>>
<span id="el_detailed_action_PlannedEndDate">
<span<?php echo $detailed_action->PlannedEndDate->viewAttributes() ?>><?php echo $detailed_action->PlannedEndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action->ActualStartDate->Visible) { // ActualStartDate ?>
			<td <?php echo $detailed_action->ActualStartDate->cellAttributes() ?>>
<span id="el_detailed_action_ActualStartDate">
<span<?php echo $detailed_action->ActualStartDate->viewAttributes() ?>><?php echo $detailed_action->ActualStartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action->ActualEndDate->Visible) { // ActualEndDate ?>
			<td <?php echo $detailed_action->ActualEndDate->cellAttributes() ?>>
<span id="el_detailed_action_ActualEndDate">
<span<?php echo $detailed_action->ActualEndDate->viewAttributes() ?>><?php echo $detailed_action->ActualEndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action->Ward->Visible) { // Ward ?>
			<td <?php echo $detailed_action->Ward->cellAttributes() ?>>
<span id="el_detailed_action_Ward">
<span<?php echo $detailed_action->Ward->viewAttributes() ?>><?php echo $detailed_action->Ward->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action->ExpectedResult->Visible) { // ExpectedResult ?>
			<td <?php echo $detailed_action->ExpectedResult->cellAttributes() ?>>
<span id="el_detailed_action_ExpectedResult">
<span<?php echo $detailed_action->ExpectedResult->viewAttributes() ?>><?php echo $detailed_action->ExpectedResult->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action->Comments->Visible) { // Comments ?>
			<td <?php echo $detailed_action->Comments->cellAttributes() ?>>
<span id="el_detailed_action_Comments">
<span<?php echo $detailed_action->Comments->viewAttributes() ?>><?php echo $detailed_action->Comments->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailed_action->ProgressStatus->Visible) { // ProgressStatus ?>
			<td <?php echo $detailed_action->ProgressStatus->cellAttributes() ?>>
<span id="el_detailed_action_ProgressStatus">
<span<?php echo $detailed_action->ProgressStatus->viewAttributes() ?>><?php echo $detailed_action->ProgressStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>