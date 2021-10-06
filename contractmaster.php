<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($contract->Visible) { ?>
<div id="t_contract" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_contractmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($contract->LACode->Visible) { // LACode ?>
			<th class="<?php echo $contract->LACode->headerCellClass() ?>"><?php echo $contract->LACode->caption() ?></th>
<?php } ?>
<?php if ($contract->DepartmentCode->Visible) { // DepartmentCode ?>
			<th class="<?php echo $contract->DepartmentCode->headerCellClass() ?>"><?php echo $contract->DepartmentCode->caption() ?></th>
<?php } ?>
<?php if ($contract->SectionCode->Visible) { // SectionCode ?>
			<th class="<?php echo $contract->SectionCode->headerCellClass() ?>"><?php echo $contract->SectionCode->caption() ?></th>
<?php } ?>
<?php if ($contract->ProjectCode->Visible) { // ProjectCode ?>
			<th class="<?php echo $contract->ProjectCode->headerCellClass() ?>"><?php echo $contract->ProjectCode->caption() ?></th>
<?php } ?>
<?php if ($contract->ContractNo->Visible) { // ContractNo ?>
			<th class="<?php echo $contract->ContractNo->headerCellClass() ?>"><?php echo $contract->ContractNo->caption() ?></th>
<?php } ?>
<?php if ($contract->ContractName->Visible) { // ContractName ?>
			<th class="<?php echo $contract->ContractName->headerCellClass() ?>"><?php echo $contract->ContractName->caption() ?></th>
<?php } ?>
<?php if ($contract->ContractType->Visible) { // ContractType ?>
			<th class="<?php echo $contract->ContractType->headerCellClass() ?>"><?php echo $contract->ContractType->caption() ?></th>
<?php } ?>
<?php if ($contract->ContractSum->Visible) { // ContractSum ?>
			<th class="<?php echo $contract->ContractSum->headerCellClass() ?>"><?php echo $contract->ContractSum->caption() ?></th>
<?php } ?>
<?php if ($contract->RevisedContractSum->Visible) { // RevisedContractSum ?>
			<th class="<?php echo $contract->RevisedContractSum->headerCellClass() ?>"><?php echo $contract->RevisedContractSum->caption() ?></th>
<?php } ?>
<?php if ($contract->ContractorRef->Visible) { // ContractorRef ?>
			<th class="<?php echo $contract->ContractorRef->headerCellClass() ?>"><?php echo $contract->ContractorRef->caption() ?></th>
<?php } ?>
<?php if ($contract->SigningDate->Visible) { // SigningDate ?>
			<th class="<?php echo $contract->SigningDate->headerCellClass() ?>"><?php echo $contract->SigningDate->caption() ?></th>
<?php } ?>
<?php if ($contract->PlannedStartDate->Visible) { // PlannedStartDate ?>
			<th class="<?php echo $contract->PlannedStartDate->headerCellClass() ?>"><?php echo $contract->PlannedStartDate->caption() ?></th>
<?php } ?>
<?php if ($contract->PlannedEndDate->Visible) { // PlannedEndDate ?>
			<th class="<?php echo $contract->PlannedEndDate->headerCellClass() ?>"><?php echo $contract->PlannedEndDate->caption() ?></th>
<?php } ?>
<?php if ($contract->ActualStartDate->Visible) { // ActualStartDate ?>
			<th class="<?php echo $contract->ActualStartDate->headerCellClass() ?>"><?php echo $contract->ActualStartDate->caption() ?></th>
<?php } ?>
<?php if ($contract->ActualEndDate->Visible) { // ActualEndDate ?>
			<th class="<?php echo $contract->ActualEndDate->headerCellClass() ?>"><?php echo $contract->ActualEndDate->caption() ?></th>
<?php } ?>
<?php if ($contract->Duration->Visible) { // Duration ?>
			<th class="<?php echo $contract->Duration->headerCellClass() ?>"><?php echo $contract->Duration->caption() ?></th>
<?php } ?>
<?php if ($contract->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
			<th class="<?php echo $contract->UnitOfMeasure->headerCellClass() ?>"><?php echo $contract->UnitOfMeasure->caption() ?></th>
<?php } ?>
<?php if ($contract->AdvancePaymentAmount->Visible) { // AdvancePaymentAmount ?>
			<th class="<?php echo $contract->AdvancePaymentAmount->headerCellClass() ?>"><?php echo $contract->AdvancePaymentAmount->caption() ?></th>
<?php } ?>
<?php if ($contract->AdvancePaymentdate->Visible) { // AdvancePaymentdate ?>
			<th class="<?php echo $contract->AdvancePaymentdate->headerCellClass() ?>"><?php echo $contract->AdvancePaymentdate->caption() ?></th>
<?php } ?>
<?php if ($contract->ContractStatus->Visible) { // ContractStatus ?>
			<th class="<?php echo $contract->ContractStatus->headerCellClass() ?>"><?php echo $contract->ContractStatus->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($contract->LACode->Visible) { // LACode ?>
			<td <?php echo $contract->LACode->cellAttributes() ?>>
<span id="el_contract_LACode">
<span<?php echo $contract->LACode->viewAttributes() ?>><?php echo $contract->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract->DepartmentCode->Visible) { // DepartmentCode ?>
			<td <?php echo $contract->DepartmentCode->cellAttributes() ?>>
<span id="el_contract_DepartmentCode">
<span<?php echo $contract->DepartmentCode->viewAttributes() ?>><?php echo $contract->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract->SectionCode->Visible) { // SectionCode ?>
			<td <?php echo $contract->SectionCode->cellAttributes() ?>>
<span id="el_contract_SectionCode">
<span<?php echo $contract->SectionCode->viewAttributes() ?>><?php echo $contract->SectionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract->ProjectCode->Visible) { // ProjectCode ?>
			<td <?php echo $contract->ProjectCode->cellAttributes() ?>>
<span id="el_contract_ProjectCode">
<span<?php echo $contract->ProjectCode->viewAttributes() ?>><?php echo $contract->ProjectCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract->ContractNo->Visible) { // ContractNo ?>
			<td <?php echo $contract->ContractNo->cellAttributes() ?>>
<span id="el_contract_ContractNo">
<span<?php echo $contract->ContractNo->viewAttributes() ?>><?php echo $contract->ContractNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract->ContractName->Visible) { // ContractName ?>
			<td <?php echo $contract->ContractName->cellAttributes() ?>>
<span id="el_contract_ContractName">
<span<?php echo $contract->ContractName->viewAttributes() ?>><?php echo $contract->ContractName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract->ContractType->Visible) { // ContractType ?>
			<td <?php echo $contract->ContractType->cellAttributes() ?>>
<span id="el_contract_ContractType">
<span<?php echo $contract->ContractType->viewAttributes() ?>><?php echo $contract->ContractType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract->ContractSum->Visible) { // ContractSum ?>
			<td <?php echo $contract->ContractSum->cellAttributes() ?>>
<span id="el_contract_ContractSum">
<span<?php echo $contract->ContractSum->viewAttributes() ?>><?php echo $contract->ContractSum->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract->RevisedContractSum->Visible) { // RevisedContractSum ?>
			<td <?php echo $contract->RevisedContractSum->cellAttributes() ?>>
<span id="el_contract_RevisedContractSum">
<span<?php echo $contract->RevisedContractSum->viewAttributes() ?>><?php echo $contract->RevisedContractSum->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract->ContractorRef->Visible) { // ContractorRef ?>
			<td <?php echo $contract->ContractorRef->cellAttributes() ?>>
<span id="el_contract_ContractorRef">
<span<?php echo $contract->ContractorRef->viewAttributes() ?>><?php echo $contract->ContractorRef->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract->SigningDate->Visible) { // SigningDate ?>
			<td <?php echo $contract->SigningDate->cellAttributes() ?>>
<span id="el_contract_SigningDate">
<span<?php echo $contract->SigningDate->viewAttributes() ?>><?php echo $contract->SigningDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract->PlannedStartDate->Visible) { // PlannedStartDate ?>
			<td <?php echo $contract->PlannedStartDate->cellAttributes() ?>>
<span id="el_contract_PlannedStartDate">
<span<?php echo $contract->PlannedStartDate->viewAttributes() ?>><?php echo $contract->PlannedStartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract->PlannedEndDate->Visible) { // PlannedEndDate ?>
			<td <?php echo $contract->PlannedEndDate->cellAttributes() ?>>
<span id="el_contract_PlannedEndDate">
<span<?php echo $contract->PlannedEndDate->viewAttributes() ?>><?php echo $contract->PlannedEndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract->ActualStartDate->Visible) { // ActualStartDate ?>
			<td <?php echo $contract->ActualStartDate->cellAttributes() ?>>
<span id="el_contract_ActualStartDate">
<span<?php echo $contract->ActualStartDate->viewAttributes() ?>><?php echo $contract->ActualStartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract->ActualEndDate->Visible) { // ActualEndDate ?>
			<td <?php echo $contract->ActualEndDate->cellAttributes() ?>>
<span id="el_contract_ActualEndDate">
<span<?php echo $contract->ActualEndDate->viewAttributes() ?>><?php echo $contract->ActualEndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract->Duration->Visible) { // Duration ?>
			<td <?php echo $contract->Duration->cellAttributes() ?>>
<span id="el_contract_Duration">
<span<?php echo $contract->Duration->viewAttributes() ?>><?php echo $contract->Duration->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
			<td <?php echo $contract->UnitOfMeasure->cellAttributes() ?>>
<span id="el_contract_UnitOfMeasure">
<span<?php echo $contract->UnitOfMeasure->viewAttributes() ?>><?php echo $contract->UnitOfMeasure->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract->AdvancePaymentAmount->Visible) { // AdvancePaymentAmount ?>
			<td <?php echo $contract->AdvancePaymentAmount->cellAttributes() ?>>
<span id="el_contract_AdvancePaymentAmount">
<span<?php echo $contract->AdvancePaymentAmount->viewAttributes() ?>><?php echo $contract->AdvancePaymentAmount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract->AdvancePaymentdate->Visible) { // AdvancePaymentdate ?>
			<td <?php echo $contract->AdvancePaymentdate->cellAttributes() ?>>
<span id="el_contract_AdvancePaymentdate">
<span<?php echo $contract->AdvancePaymentdate->viewAttributes() ?>><?php echo $contract->AdvancePaymentdate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contract->ContractStatus->Visible) { // ContractStatus ?>
			<td <?php echo $contract->ContractStatus->cellAttributes() ?>>
<span id="el_contract_ContractStatus">
<span<?php echo $contract->ContractStatus->viewAttributes() ?>><?php echo $contract->ContractStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>