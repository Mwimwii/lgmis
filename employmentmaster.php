<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($employment->Visible) { ?>
<div id="t_employment" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_employmentmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($employment->ProvinceCode->Visible) { // ProvinceCode ?>
			<th class="<?php echo $employment->ProvinceCode->headerCellClass() ?>"><?php echo $employment->ProvinceCode->caption() ?></th>
<?php } ?>
<?php if ($employment->LACode->Visible) { // LACode ?>
			<th class="<?php echo $employment->LACode->headerCellClass() ?>"><?php echo $employment->LACode->caption() ?></th>
<?php } ?>
<?php if ($employment->DepartmentCode->Visible) { // DepartmentCode ?>
			<th class="<?php echo $employment->DepartmentCode->headerCellClass() ?>"><?php echo $employment->DepartmentCode->caption() ?></th>
<?php } ?>
<?php if ($employment->SectionCode->Visible) { // SectionCode ?>
			<th class="<?php echo $employment->SectionCode->headerCellClass() ?>"><?php echo $employment->SectionCode->caption() ?></th>
<?php } ?>
<?php if ($employment->SubstantivePosition->Visible) { // SubstantivePosition ?>
			<th class="<?php echo $employment->SubstantivePosition->headerCellClass() ?>"><?php echo $employment->SubstantivePosition->caption() ?></th>
<?php } ?>
<?php if ($employment->DateOfCurrentAppointment->Visible) { // DateOfCurrentAppointment ?>
			<th class="<?php echo $employment->DateOfCurrentAppointment->headerCellClass() ?>"><?php echo $employment->DateOfCurrentAppointment->caption() ?></th>
<?php } ?>
<?php if ($employment->LastAppraisalDate->Visible) { // LastAppraisalDate ?>
			<th class="<?php echo $employment->LastAppraisalDate->headerCellClass() ?>"><?php echo $employment->LastAppraisalDate->caption() ?></th>
<?php } ?>
<?php if ($employment->AppraisalStatus->Visible) { // AppraisalStatus ?>
			<th class="<?php echo $employment->AppraisalStatus->headerCellClass() ?>"><?php echo $employment->AppraisalStatus->caption() ?></th>
<?php } ?>
<?php if ($employment->DateOfExit->Visible) { // DateOfExit ?>
			<th class="<?php echo $employment->DateOfExit->headerCellClass() ?>"><?php echo $employment->DateOfExit->caption() ?></th>
<?php } ?>
<?php if ($employment->EmploymentType->Visible) { // EmploymentType ?>
			<th class="<?php echo $employment->EmploymentType->headerCellClass() ?>"><?php echo $employment->EmploymentType->caption() ?></th>
<?php } ?>
<?php if ($employment->EmploymentStatus->Visible) { // EmploymentStatus ?>
			<th class="<?php echo $employment->EmploymentStatus->headerCellClass() ?>"><?php echo $employment->EmploymentStatus->caption() ?></th>
<?php } ?>
<?php if ($employment->EmployeeNumber->Visible) { // EmployeeNumber ?>
			<th class="<?php echo $employment->EmployeeNumber->headerCellClass() ?>"><?php echo $employment->EmployeeNumber->caption() ?></th>
<?php } ?>
<?php if ($employment->SalaryNotch->Visible) { // SalaryNotch ?>
			<th class="<?php echo $employment->SalaryNotch->headerCellClass() ?>"><?php echo $employment->SalaryNotch->caption() ?></th>
<?php } ?>
<?php if ($employment->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
			<th class="<?php echo $employment->BasicMonthlySalary->headerCellClass() ?>"><?php echo $employment->BasicMonthlySalary->caption() ?></th>
<?php } ?>
<?php if ($employment->ThirdParties->Visible) { // ThirdParties ?>
			<th class="<?php echo $employment->ThirdParties->headerCellClass() ?>"><?php echo $employment->ThirdParties->caption() ?></th>
<?php } ?>
<?php if ($employment->PayrollCode->Visible) { // PayrollCode ?>
			<th class="<?php echo $employment->PayrollCode->headerCellClass() ?>"><?php echo $employment->PayrollCode->caption() ?></th>
<?php } ?>
<?php if ($employment->DateOfConfirmation->Visible) { // DateOfConfirmation ?>
			<th class="<?php echo $employment->DateOfConfirmation->headerCellClass() ?>"><?php echo $employment->DateOfConfirmation->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($employment->ProvinceCode->Visible) { // ProvinceCode ?>
			<td <?php echo $employment->ProvinceCode->cellAttributes() ?>>
<span id="el_employment_ProvinceCode">
<span<?php echo $employment->ProvinceCode->viewAttributes() ?>><?php echo $employment->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment->LACode->Visible) { // LACode ?>
			<td <?php echo $employment->LACode->cellAttributes() ?>>
<span id="el_employment_LACode">
<span<?php echo $employment->LACode->viewAttributes() ?>><?php echo $employment->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment->DepartmentCode->Visible) { // DepartmentCode ?>
			<td <?php echo $employment->DepartmentCode->cellAttributes() ?>>
<span id="el_employment_DepartmentCode">
<span<?php echo $employment->DepartmentCode->viewAttributes() ?>><?php echo $employment->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment->SectionCode->Visible) { // SectionCode ?>
			<td <?php echo $employment->SectionCode->cellAttributes() ?>>
<span id="el_employment_SectionCode">
<span<?php echo $employment->SectionCode->viewAttributes() ?>><?php echo $employment->SectionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment->SubstantivePosition->Visible) { // SubstantivePosition ?>
			<td <?php echo $employment->SubstantivePosition->cellAttributes() ?>>
<span id="el_employment_SubstantivePosition">
<span<?php echo $employment->SubstantivePosition->viewAttributes() ?>><?php echo $employment->SubstantivePosition->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment->DateOfCurrentAppointment->Visible) { // DateOfCurrentAppointment ?>
			<td <?php echo $employment->DateOfCurrentAppointment->cellAttributes() ?>>
<span id="el_employment_DateOfCurrentAppointment">
<span<?php echo $employment->DateOfCurrentAppointment->viewAttributes() ?>><?php echo $employment->DateOfCurrentAppointment->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment->LastAppraisalDate->Visible) { // LastAppraisalDate ?>
			<td <?php echo $employment->LastAppraisalDate->cellAttributes() ?>>
<span id="el_employment_LastAppraisalDate">
<span<?php echo $employment->LastAppraisalDate->viewAttributes() ?>><?php echo $employment->LastAppraisalDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment->AppraisalStatus->Visible) { // AppraisalStatus ?>
			<td <?php echo $employment->AppraisalStatus->cellAttributes() ?>>
<span id="el_employment_AppraisalStatus">
<span<?php echo $employment->AppraisalStatus->viewAttributes() ?>><?php echo $employment->AppraisalStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment->DateOfExit->Visible) { // DateOfExit ?>
			<td <?php echo $employment->DateOfExit->cellAttributes() ?>>
<span id="el_employment_DateOfExit">
<span<?php echo $employment->DateOfExit->viewAttributes() ?>><?php echo $employment->DateOfExit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment->EmploymentType->Visible) { // EmploymentType ?>
			<td <?php echo $employment->EmploymentType->cellAttributes() ?>>
<span id="el_employment_EmploymentType">
<span<?php echo $employment->EmploymentType->viewAttributes() ?>><?php echo $employment->EmploymentType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment->EmploymentStatus->Visible) { // EmploymentStatus ?>
			<td <?php echo $employment->EmploymentStatus->cellAttributes() ?>>
<span id="el_employment_EmploymentStatus">
<span<?php echo $employment->EmploymentStatus->viewAttributes() ?>><?php echo $employment->EmploymentStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment->EmployeeNumber->Visible) { // EmployeeNumber ?>
			<td <?php echo $employment->EmployeeNumber->cellAttributes() ?>>
<span id="el_employment_EmployeeNumber">
<span<?php echo $employment->EmployeeNumber->viewAttributes() ?>><?php echo $employment->EmployeeNumber->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment->SalaryNotch->Visible) { // SalaryNotch ?>
			<td <?php echo $employment->SalaryNotch->cellAttributes() ?>>
<span id="el_employment_SalaryNotch">
<span<?php echo $employment->SalaryNotch->viewAttributes() ?>><?php echo $employment->SalaryNotch->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
			<td <?php echo $employment->BasicMonthlySalary->cellAttributes() ?>>
<span id="el_employment_BasicMonthlySalary">
<span<?php echo $employment->BasicMonthlySalary->viewAttributes() ?>><?php echo $employment->BasicMonthlySalary->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment->ThirdParties->Visible) { // ThirdParties ?>
			<td <?php echo $employment->ThirdParties->cellAttributes() ?>>
<span id="el_employment_ThirdParties">
<span<?php echo $employment->ThirdParties->viewAttributes() ?>><?php echo $employment->ThirdParties->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment->PayrollCode->Visible) { // PayrollCode ?>
			<td <?php echo $employment->PayrollCode->cellAttributes() ?>>
<span id="el_employment_PayrollCode">
<span<?php echo $employment->PayrollCode->viewAttributes() ?>><?php echo $employment->PayrollCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employment->DateOfConfirmation->Visible) { // DateOfConfirmation ?>
			<td <?php echo $employment->DateOfConfirmation->cellAttributes() ?>>
<span id="el_employment_DateOfConfirmation">
<span<?php echo $employment->DateOfConfirmation->viewAttributes() ?>><?php echo $employment->DateOfConfirmation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>