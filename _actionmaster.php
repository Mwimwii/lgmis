<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($_action->Visible) { ?>
<div id="t__action" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl__actionmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($_action->ProgramCode->Visible) { // ProgramCode ?>
			<th class="<?php echo $_action->ProgramCode->headerCellClass() ?>"><?php echo $_action->ProgramCode->caption() ?></th>
<?php } ?>
<?php if ($_action->OucomeCode->Visible) { // OucomeCode ?>
			<th class="<?php echo $_action->OucomeCode->headerCellClass() ?>"><?php echo $_action->OucomeCode->caption() ?></th>
<?php } ?>
<?php if ($_action->OutputCode->Visible) { // OutputCode ?>
			<th class="<?php echo $_action->OutputCode->headerCellClass() ?>"><?php echo $_action->OutputCode->caption() ?></th>
<?php } ?>
<?php if ($_action->ProjectCode->Visible) { // ProjectCode ?>
			<th class="<?php echo $_action->ProjectCode->headerCellClass() ?>"><?php echo $_action->ProjectCode->caption() ?></th>
<?php } ?>
<?php if ($_action->ActionCode->Visible) { // ActionCode ?>
			<th class="<?php echo $_action->ActionCode->headerCellClass() ?>"><?php echo $_action->ActionCode->caption() ?></th>
<?php } ?>
<?php if ($_action->ActionName->Visible) { // ActionName ?>
			<th class="<?php echo $_action->ActionName->headerCellClass() ?>"><?php echo $_action->ActionName->caption() ?></th>
<?php } ?>
<?php if ($_action->ActionType->Visible) { // ActionType ?>
			<th class="<?php echo $_action->ActionType->headerCellClass() ?>"><?php echo $_action->ActionType->caption() ?></th>
<?php } ?>
<?php if ($_action->FinancialYear->Visible) { // FinancialYear ?>
			<th class="<?php echo $_action->FinancialYear->headerCellClass() ?>"><?php echo $_action->FinancialYear->caption() ?></th>
<?php } ?>
<?php if ($_action->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
			<th class="<?php echo $_action->ExpectedAnnualAchievement->headerCellClass() ?>"><?php echo $_action->ExpectedAnnualAchievement->caption() ?></th>
<?php } ?>
<?php if ($_action->ActionLocation->Visible) { // ActionLocation ?>
			<th class="<?php echo $_action->ActionLocation->headerCellClass() ?>"><?php echo $_action->ActionLocation->caption() ?></th>
<?php } ?>
<?php if ($_action->Latitude->Visible) { // Latitude ?>
			<th class="<?php echo $_action->Latitude->headerCellClass() ?>"><?php echo $_action->Latitude->caption() ?></th>
<?php } ?>
<?php if ($_action->Longitude->Visible) { // Longitude ?>
			<th class="<?php echo $_action->Longitude->headerCellClass() ?>"><?php echo $_action->Longitude->caption() ?></th>
<?php } ?>
<?php if ($_action->LACode->Visible) { // LACode ?>
			<th class="<?php echo $_action->LACode->headerCellClass() ?>"><?php echo $_action->LACode->caption() ?></th>
<?php } ?>
<?php if ($_action->DepartmentCode->Visible) { // DepartmentCode ?>
			<th class="<?php echo $_action->DepartmentCode->headerCellClass() ?>"><?php echo $_action->DepartmentCode->caption() ?></th>
<?php } ?>
<?php if ($_action->SectionCode->Visible) { // SectionCode ?>
			<th class="<?php echo $_action->SectionCode->headerCellClass() ?>"><?php echo $_action->SectionCode->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($_action->ProgramCode->Visible) { // ProgramCode ?>
			<td <?php echo $_action->ProgramCode->cellAttributes() ?>>
<span id="el__action_ProgramCode">
<span<?php echo $_action->ProgramCode->viewAttributes() ?>><?php echo $_action->ProgramCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action->OucomeCode->Visible) { // OucomeCode ?>
			<td <?php echo $_action->OucomeCode->cellAttributes() ?>>
<span id="el__action_OucomeCode">
<span<?php echo $_action->OucomeCode->viewAttributes() ?>><?php echo $_action->OucomeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action->OutputCode->Visible) { // OutputCode ?>
			<td <?php echo $_action->OutputCode->cellAttributes() ?>>
<span id="el__action_OutputCode">
<span<?php echo $_action->OutputCode->viewAttributes() ?>><?php echo $_action->OutputCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action->ProjectCode->Visible) { // ProjectCode ?>
			<td <?php echo $_action->ProjectCode->cellAttributes() ?>>
<span id="el__action_ProjectCode">
<span<?php echo $_action->ProjectCode->viewAttributes() ?>><?php echo $_action->ProjectCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action->ActionCode->Visible) { // ActionCode ?>
			<td <?php echo $_action->ActionCode->cellAttributes() ?>>
<span id="el__action_ActionCode">
<span<?php echo $_action->ActionCode->viewAttributes() ?>><?php echo $_action->ActionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action->ActionName->Visible) { // ActionName ?>
			<td <?php echo $_action->ActionName->cellAttributes() ?>>
<span id="el__action_ActionName">
<span<?php echo $_action->ActionName->viewAttributes() ?>><?php echo $_action->ActionName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action->ActionType->Visible) { // ActionType ?>
			<td <?php echo $_action->ActionType->cellAttributes() ?>>
<span id="el__action_ActionType">
<span<?php echo $_action->ActionType->viewAttributes() ?>><?php echo $_action->ActionType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action->FinancialYear->Visible) { // FinancialYear ?>
			<td <?php echo $_action->FinancialYear->cellAttributes() ?>>
<span id="el__action_FinancialYear">
<span<?php echo $_action->FinancialYear->viewAttributes() ?>><?php echo $_action->FinancialYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
			<td <?php echo $_action->ExpectedAnnualAchievement->cellAttributes() ?>>
<span id="el__action_ExpectedAnnualAchievement">
<span<?php echo $_action->ExpectedAnnualAchievement->viewAttributes() ?>><?php echo $_action->ExpectedAnnualAchievement->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action->ActionLocation->Visible) { // ActionLocation ?>
			<td <?php echo $_action->ActionLocation->cellAttributes() ?>>
<span id="el__action_ActionLocation">
<span<?php echo $_action->ActionLocation->viewAttributes() ?>><?php echo $_action->ActionLocation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action->Latitude->Visible) { // Latitude ?>
			<td <?php echo $_action->Latitude->cellAttributes() ?>>
<span id="el__action_Latitude">
<span<?php echo $_action->Latitude->viewAttributes() ?>><?php echo $_action->Latitude->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action->Longitude->Visible) { // Longitude ?>
			<td <?php echo $_action->Longitude->cellAttributes() ?>>
<span id="el__action_Longitude">
<span<?php echo $_action->Longitude->viewAttributes() ?>><?php echo $_action->Longitude->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action->LACode->Visible) { // LACode ?>
			<td <?php echo $_action->LACode->cellAttributes() ?>>
<span id="el__action_LACode">
<span<?php echo $_action->LACode->viewAttributes() ?>><?php echo $_action->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action->DepartmentCode->Visible) { // DepartmentCode ?>
			<td <?php echo $_action->DepartmentCode->cellAttributes() ?>>
<span id="el__action_DepartmentCode">
<span<?php echo $_action->DepartmentCode->viewAttributes() ?>><?php echo $_action->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_action->SectionCode->Visible) { // SectionCode ?>
			<td <?php echo $_action->SectionCode->cellAttributes() ?>>
<span id="el__action_SectionCode">
<span<?php echo $_action->SectionCode->viewAttributes() ?>><?php echo $_action->SectionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>