<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($output->Visible) { ?>
<div id="t_output" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_outputmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($output->LACode->Visible) { // LACode ?>
			<th class="<?php echo $output->LACode->headerCellClass() ?>"><?php echo $output->LACode->caption() ?></th>
<?php } ?>
<?php if ($output->DepartmentCode->Visible) { // DepartmentCode ?>
			<th class="<?php echo $output->DepartmentCode->headerCellClass() ?>"><?php echo $output->DepartmentCode->caption() ?></th>
<?php } ?>
<?php if ($output->SectionCode->Visible) { // SectionCode ?>
			<th class="<?php echo $output->SectionCode->headerCellClass() ?>"><?php echo $output->SectionCode->caption() ?></th>
<?php } ?>
<?php if ($output->OutcomeCode->Visible) { // OutcomeCode ?>
			<th class="<?php echo $output->OutcomeCode->headerCellClass() ?>"><?php echo $output->OutcomeCode->caption() ?></th>
<?php } ?>
<?php if ($output->ProgramCode->Visible) { // ProgramCode ?>
			<th class="<?php echo $output->ProgramCode->headerCellClass() ?>"><?php echo $output->ProgramCode->caption() ?></th>
<?php } ?>
<?php if ($output->SubProgramCode->Visible) { // SubProgramCode ?>
			<th class="<?php echo $output->SubProgramCode->headerCellClass() ?>"><?php echo $output->SubProgramCode->caption() ?></th>
<?php } ?>
<?php if ($output->OutputCode->Visible) { // OutputCode ?>
			<th class="<?php echo $output->OutputCode->headerCellClass() ?>"><?php echo $output->OutputCode->caption() ?></th>
<?php } ?>
<?php if ($output->OutputType->Visible) { // OutputType ?>
			<th class="<?php echo $output->OutputType->headerCellClass() ?>"><?php echo $output->OutputType->caption() ?></th>
<?php } ?>
<?php if ($output->OutputName->Visible) { // OutputName ?>
			<th class="<?php echo $output->OutputName->headerCellClass() ?>"><?php echo $output->OutputName->caption() ?></th>
<?php } ?>
<?php if ($output->DeliveryDate->Visible) { // DeliveryDate ?>
			<th class="<?php echo $output->DeliveryDate->headerCellClass() ?>"><?php echo $output->DeliveryDate->caption() ?></th>
<?php } ?>
<?php if ($output->FinancialYear->Visible) { // FinancialYear ?>
			<th class="<?php echo $output->FinancialYear->headerCellClass() ?>"><?php echo $output->FinancialYear->caption() ?></th>
<?php } ?>
<?php if ($output->OutputDescription->Visible) { // OutputDescription ?>
			<th class="<?php echo $output->OutputDescription->headerCellClass() ?>"><?php echo $output->OutputDescription->caption() ?></th>
<?php } ?>
<?php if ($output->OutputMeansOfVerification->Visible) { // OutputMeansOfVerification ?>
			<th class="<?php echo $output->OutputMeansOfVerification->headerCellClass() ?>"><?php echo $output->OutputMeansOfVerification->caption() ?></th>
<?php } ?>
<?php if ($output->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
			<th class="<?php echo $output->ResponsibleOfficer->headerCellClass() ?>"><?php echo $output->ResponsibleOfficer->caption() ?></th>
<?php } ?>
<?php if ($output->Clients->Visible) { // Clients ?>
			<th class="<?php echo $output->Clients->headerCellClass() ?>"><?php echo $output->Clients->caption() ?></th>
<?php } ?>
<?php if ($output->Beneficiaries->Visible) { // Beneficiaries ?>
			<th class="<?php echo $output->Beneficiaries->headerCellClass() ?>"><?php echo $output->Beneficiaries->caption() ?></th>
<?php } ?>
<?php if ($output->OutputStatus->Visible) { // OutputStatus ?>
			<th class="<?php echo $output->OutputStatus->headerCellClass() ?>"><?php echo $output->OutputStatus->caption() ?></th>
<?php } ?>
<?php if ($output->TargetAmount->Visible) { // TargetAmount ?>
			<th class="<?php echo $output->TargetAmount->headerCellClass() ?>"><?php echo $output->TargetAmount->caption() ?></th>
<?php } ?>
<?php if ($output->ActualAmount->Visible) { // ActualAmount ?>
			<th class="<?php echo $output->ActualAmount->headerCellClass() ?>"><?php echo $output->ActualAmount->caption() ?></th>
<?php } ?>
<?php if ($output->PercentAchieved->Visible) { // PercentAchieved ?>
			<th class="<?php echo $output->PercentAchieved->headerCellClass() ?>"><?php echo $output->PercentAchieved->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($output->LACode->Visible) { // LACode ?>
			<td <?php echo $output->LACode->cellAttributes() ?>>
<span id="el_output_LACode">
<span<?php echo $output->LACode->viewAttributes() ?>><?php echo $output->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output->DepartmentCode->Visible) { // DepartmentCode ?>
			<td <?php echo $output->DepartmentCode->cellAttributes() ?>>
<span id="el_output_DepartmentCode">
<span<?php echo $output->DepartmentCode->viewAttributes() ?>><?php echo $output->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output->SectionCode->Visible) { // SectionCode ?>
			<td <?php echo $output->SectionCode->cellAttributes() ?>>
<span id="el_output_SectionCode">
<span<?php echo $output->SectionCode->viewAttributes() ?>><?php echo $output->SectionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output->OutcomeCode->Visible) { // OutcomeCode ?>
			<td <?php echo $output->OutcomeCode->cellAttributes() ?>>
<span id="el_output_OutcomeCode">
<span<?php echo $output->OutcomeCode->viewAttributes() ?>><?php echo $output->OutcomeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output->ProgramCode->Visible) { // ProgramCode ?>
			<td <?php echo $output->ProgramCode->cellAttributes() ?>>
<span id="el_output_ProgramCode">
<span<?php echo $output->ProgramCode->viewAttributes() ?>><?php echo $output->ProgramCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output->SubProgramCode->Visible) { // SubProgramCode ?>
			<td <?php echo $output->SubProgramCode->cellAttributes() ?>>
<span id="el_output_SubProgramCode">
<span<?php echo $output->SubProgramCode->viewAttributes() ?>><?php echo $output->SubProgramCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output->OutputCode->Visible) { // OutputCode ?>
			<td <?php echo $output->OutputCode->cellAttributes() ?>>
<span id="el_output_OutputCode">
<span<?php echo $output->OutputCode->viewAttributes() ?>><?php echo $output->OutputCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output->OutputType->Visible) { // OutputType ?>
			<td <?php echo $output->OutputType->cellAttributes() ?>>
<span id="el_output_OutputType">
<span<?php echo $output->OutputType->viewAttributes() ?>><?php echo $output->OutputType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output->OutputName->Visible) { // OutputName ?>
			<td <?php echo $output->OutputName->cellAttributes() ?>>
<span id="el_output_OutputName">
<span<?php echo $output->OutputName->viewAttributes() ?>><?php echo $output->OutputName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output->DeliveryDate->Visible) { // DeliveryDate ?>
			<td <?php echo $output->DeliveryDate->cellAttributes() ?>>
<span id="el_output_DeliveryDate">
<span<?php echo $output->DeliveryDate->viewAttributes() ?>><?php echo $output->DeliveryDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output->FinancialYear->Visible) { // FinancialYear ?>
			<td <?php echo $output->FinancialYear->cellAttributes() ?>>
<span id="el_output_FinancialYear">
<span<?php echo $output->FinancialYear->viewAttributes() ?>><?php echo $output->FinancialYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output->OutputDescription->Visible) { // OutputDescription ?>
			<td <?php echo $output->OutputDescription->cellAttributes() ?>>
<span id="el_output_OutputDescription">
<span<?php echo $output->OutputDescription->viewAttributes() ?>><?php echo $output->OutputDescription->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output->OutputMeansOfVerification->Visible) { // OutputMeansOfVerification ?>
			<td <?php echo $output->OutputMeansOfVerification->cellAttributes() ?>>
<span id="el_output_OutputMeansOfVerification">
<span<?php echo $output->OutputMeansOfVerification->viewAttributes() ?>><?php echo $output->OutputMeansOfVerification->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
			<td <?php echo $output->ResponsibleOfficer->cellAttributes() ?>>
<span id="el_output_ResponsibleOfficer">
<span<?php echo $output->ResponsibleOfficer->viewAttributes() ?>><?php echo $output->ResponsibleOfficer->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output->Clients->Visible) { // Clients ?>
			<td <?php echo $output->Clients->cellAttributes() ?>>
<span id="el_output_Clients">
<span<?php echo $output->Clients->viewAttributes() ?>><?php echo $output->Clients->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output->Beneficiaries->Visible) { // Beneficiaries ?>
			<td <?php echo $output->Beneficiaries->cellAttributes() ?>>
<span id="el_output_Beneficiaries">
<span<?php echo $output->Beneficiaries->viewAttributes() ?>><?php echo $output->Beneficiaries->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output->OutputStatus->Visible) { // OutputStatus ?>
			<td <?php echo $output->OutputStatus->cellAttributes() ?>>
<span id="el_output_OutputStatus">
<span<?php echo $output->OutputStatus->viewAttributes() ?>><?php echo $output->OutputStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output->TargetAmount->Visible) { // TargetAmount ?>
			<td <?php echo $output->TargetAmount->cellAttributes() ?>>
<span id="el_output_TargetAmount">
<span<?php echo $output->TargetAmount->viewAttributes() ?>><?php echo $output->TargetAmount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output->ActualAmount->Visible) { // ActualAmount ?>
			<td <?php echo $output->ActualAmount->cellAttributes() ?>>
<span id="el_output_ActualAmount">
<span<?php echo $output->ActualAmount->viewAttributes() ?>><?php echo $output->ActualAmount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($output->PercentAchieved->Visible) { // PercentAchieved ?>
			<td <?php echo $output->PercentAchieved->cellAttributes() ?>>
<span id="el_output_PercentAchieved">
<span<?php echo $output->PercentAchieved->viewAttributes() ?>><?php echo $output->PercentAchieved->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>