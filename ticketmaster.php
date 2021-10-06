<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($ticket->Visible) { ?>
<div id="t_ticket" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_ticketmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($ticket->Subject->Visible) { // Subject ?>
			<th class="<?php echo $ticket->Subject->headerCellClass() ?>"><?php echo $ticket->Subject->caption() ?></th>
<?php } ?>
<?php if ($ticket->TicketReportDate->Visible) { // TicketReportDate ?>
			<th class="<?php echo $ticket->TicketReportDate->headerCellClass() ?>"><?php echo $ticket->TicketReportDate->caption() ?></th>
<?php } ?>
<?php if ($ticket->IncidentDate->Visible) { // IncidentDate ?>
			<th class="<?php echo $ticket->IncidentDate->headerCellClass() ?>"><?php echo $ticket->IncidentDate->caption() ?></th>
<?php } ?>
<?php if ($ticket->IncidentTime->Visible) { // IncidentTime ?>
			<th class="<?php echo $ticket->IncidentTime->headerCellClass() ?>"><?php echo $ticket->IncidentTime->caption() ?></th>
<?php } ?>
<?php if ($ticket->TicketCategory->Visible) { // TicketCategory ?>
			<th class="<?php echo $ticket->TicketCategory->headerCellClass() ?>"><?php echo $ticket->TicketCategory->caption() ?></th>
<?php } ?>
<?php if ($ticket->TicketType->Visible) { // TicketType ?>
			<th class="<?php echo $ticket->TicketType->headerCellClass() ?>"><?php echo $ticket->TicketType->caption() ?></th>
<?php } ?>
<?php if ($ticket->ReportedBy->Visible) { // ReportedBy ?>
			<th class="<?php echo $ticket->ReportedBy->headerCellClass() ?>"><?php echo $ticket->ReportedBy->caption() ?></th>
<?php } ?>
<?php if ($ticket->TicketStatus->Visible) { // TicketStatus ?>
			<th class="<?php echo $ticket->TicketStatus->headerCellClass() ?>"><?php echo $ticket->TicketStatus->caption() ?></th>
<?php } ?>
<?php if ($ticket->TicketNumber->Visible) { // TicketNumber ?>
			<th class="<?php echo $ticket->TicketNumber->headerCellClass() ?>"><?php echo $ticket->TicketNumber->caption() ?></th>
<?php } ?>
<?php if ($ticket->ReporterEmail->Visible) { // ReporterEmail ?>
			<th class="<?php echo $ticket->ReporterEmail->headerCellClass() ?>"><?php echo $ticket->ReporterEmail->caption() ?></th>
<?php } ?>
<?php if ($ticket->ReporterMobile->Visible) { // ReporterMobile ?>
			<th class="<?php echo $ticket->ReporterMobile->headerCellClass() ?>"><?php echo $ticket->ReporterMobile->caption() ?></th>
<?php } ?>
<?php if ($ticket->ProvinceCode->Visible) { // ProvinceCode ?>
			<th class="<?php echo $ticket->ProvinceCode->headerCellClass() ?>"><?php echo $ticket->ProvinceCode->caption() ?></th>
<?php } ?>
<?php if ($ticket->LACode->Visible) { // LACode ?>
			<th class="<?php echo $ticket->LACode->headerCellClass() ?>"><?php echo $ticket->LACode->caption() ?></th>
<?php } ?>
<?php if ($ticket->DepartmentCode->Visible) { // DepartmentCode ?>
			<th class="<?php echo $ticket->DepartmentCode->headerCellClass() ?>"><?php echo $ticket->DepartmentCode->caption() ?></th>
<?php } ?>
<?php if ($ticket->DeptSection->Visible) { // DeptSection ?>
			<th class="<?php echo $ticket->DeptSection->headerCellClass() ?>"><?php echo $ticket->DeptSection->caption() ?></th>
<?php } ?>
<?php if ($ticket->TicketLevel->Visible) { // TicketLevel ?>
			<th class="<?php echo $ticket->TicketLevel->headerCellClass() ?>"><?php echo $ticket->TicketLevel->caption() ?></th>
<?php } ?>
<?php if ($ticket->AllocatedTo->Visible) { // AllocatedTo ?>
			<th class="<?php echo $ticket->AllocatedTo->headerCellClass() ?>"><?php echo $ticket->AllocatedTo->caption() ?></th>
<?php } ?>
<?php if ($ticket->EscalatedTo->Visible) { // EscalatedTo ?>
			<th class="<?php echo $ticket->EscalatedTo->headerCellClass() ?>"><?php echo $ticket->EscalatedTo->caption() ?></th>
<?php } ?>
<?php if ($ticket->TicketSolution->Visible) { // TicketSolution ?>
			<th class="<?php echo $ticket->TicketSolution->headerCellClass() ?>"><?php echo $ticket->TicketSolution->caption() ?></th>
<?php } ?>
<?php if ($ticket->SeverityLevel->Visible) { // SeverityLevel ?>
			<th class="<?php echo $ticket->SeverityLevel->headerCellClass() ?>"><?php echo $ticket->SeverityLevel->caption() ?></th>
<?php } ?>
<?php if ($ticket->Days->Visible) { // Days ?>
			<th class="<?php echo $ticket->Days->headerCellClass() ?>"><?php echo $ticket->Days->caption() ?></th>
<?php } ?>
<?php if ($ticket->DataLastUpdated->Visible) { // DataLastUpdated ?>
			<th class="<?php echo $ticket->DataLastUpdated->headerCellClass() ?>"><?php echo $ticket->DataLastUpdated->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($ticket->Subject->Visible) { // Subject ?>
			<td <?php echo $ticket->Subject->cellAttributes() ?>>
<span id="el_ticket_Subject">
<span<?php echo $ticket->Subject->viewAttributes() ?>><?php echo $ticket->Subject->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket->TicketReportDate->Visible) { // TicketReportDate ?>
			<td <?php echo $ticket->TicketReportDate->cellAttributes() ?>>
<span id="el_ticket_TicketReportDate">
<span<?php echo $ticket->TicketReportDate->viewAttributes() ?>><?php echo $ticket->TicketReportDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket->IncidentDate->Visible) { // IncidentDate ?>
			<td <?php echo $ticket->IncidentDate->cellAttributes() ?>>
<span id="el_ticket_IncidentDate">
<span<?php echo $ticket->IncidentDate->viewAttributes() ?>><?php echo $ticket->IncidentDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket->IncidentTime->Visible) { // IncidentTime ?>
			<td <?php echo $ticket->IncidentTime->cellAttributes() ?>>
<span id="el_ticket_IncidentTime">
<span<?php echo $ticket->IncidentTime->viewAttributes() ?>><?php echo $ticket->IncidentTime->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket->TicketCategory->Visible) { // TicketCategory ?>
			<td <?php echo $ticket->TicketCategory->cellAttributes() ?>>
<span id="el_ticket_TicketCategory">
<span<?php echo $ticket->TicketCategory->viewAttributes() ?>><?php echo $ticket->TicketCategory->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket->TicketType->Visible) { // TicketType ?>
			<td <?php echo $ticket->TicketType->cellAttributes() ?>>
<span id="el_ticket_TicketType">
<span<?php echo $ticket->TicketType->viewAttributes() ?>><?php echo $ticket->TicketType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket->ReportedBy->Visible) { // ReportedBy ?>
			<td <?php echo $ticket->ReportedBy->cellAttributes() ?>>
<span id="el_ticket_ReportedBy">
<span<?php echo $ticket->ReportedBy->viewAttributes() ?>><?php echo $ticket->ReportedBy->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket->TicketStatus->Visible) { // TicketStatus ?>
			<td <?php echo $ticket->TicketStatus->cellAttributes() ?>>
<span id="el_ticket_TicketStatus">
<span<?php echo $ticket->TicketStatus->viewAttributes() ?>><?php echo $ticket->TicketStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket->TicketNumber->Visible) { // TicketNumber ?>
			<td <?php echo $ticket->TicketNumber->cellAttributes() ?>>
<span id="el_ticket_TicketNumber">
<span<?php echo $ticket->TicketNumber->viewAttributes() ?>><?php echo $ticket->TicketNumber->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket->ReporterEmail->Visible) { // ReporterEmail ?>
			<td <?php echo $ticket->ReporterEmail->cellAttributes() ?>>
<span id="el_ticket_ReporterEmail">
<span<?php echo $ticket->ReporterEmail->viewAttributes() ?>><?php echo $ticket->ReporterEmail->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket->ReporterMobile->Visible) { // ReporterMobile ?>
			<td <?php echo $ticket->ReporterMobile->cellAttributes() ?>>
<span id="el_ticket_ReporterMobile">
<span<?php echo $ticket->ReporterMobile->viewAttributes() ?>><?php echo $ticket->ReporterMobile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket->ProvinceCode->Visible) { // ProvinceCode ?>
			<td <?php echo $ticket->ProvinceCode->cellAttributes() ?>>
<span id="el_ticket_ProvinceCode">
<span<?php echo $ticket->ProvinceCode->viewAttributes() ?>><?php echo $ticket->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket->LACode->Visible) { // LACode ?>
			<td <?php echo $ticket->LACode->cellAttributes() ?>>
<span id="el_ticket_LACode">
<span<?php echo $ticket->LACode->viewAttributes() ?>><?php echo $ticket->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket->DepartmentCode->Visible) { // DepartmentCode ?>
			<td <?php echo $ticket->DepartmentCode->cellAttributes() ?>>
<span id="el_ticket_DepartmentCode">
<span<?php echo $ticket->DepartmentCode->viewAttributes() ?>><?php echo $ticket->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket->DeptSection->Visible) { // DeptSection ?>
			<td <?php echo $ticket->DeptSection->cellAttributes() ?>>
<span id="el_ticket_DeptSection">
<span<?php echo $ticket->DeptSection->viewAttributes() ?>><?php echo $ticket->DeptSection->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket->TicketLevel->Visible) { // TicketLevel ?>
			<td <?php echo $ticket->TicketLevel->cellAttributes() ?>>
<span id="el_ticket_TicketLevel">
<span<?php echo $ticket->TicketLevel->viewAttributes() ?>><?php echo $ticket->TicketLevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket->AllocatedTo->Visible) { // AllocatedTo ?>
			<td <?php echo $ticket->AllocatedTo->cellAttributes() ?>>
<span id="el_ticket_AllocatedTo">
<span<?php echo $ticket->AllocatedTo->viewAttributes() ?>><?php echo $ticket->AllocatedTo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket->EscalatedTo->Visible) { // EscalatedTo ?>
			<td <?php echo $ticket->EscalatedTo->cellAttributes() ?>>
<span id="el_ticket_EscalatedTo">
<span<?php echo $ticket->EscalatedTo->viewAttributes() ?>><?php echo $ticket->EscalatedTo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket->TicketSolution->Visible) { // TicketSolution ?>
			<td <?php echo $ticket->TicketSolution->cellAttributes() ?>>
<span id="el_ticket_TicketSolution">
<span<?php echo $ticket->TicketSolution->viewAttributes() ?>><?php echo $ticket->TicketSolution->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket->SeverityLevel->Visible) { // SeverityLevel ?>
			<td <?php echo $ticket->SeverityLevel->cellAttributes() ?>>
<span id="el_ticket_SeverityLevel">
<span<?php echo $ticket->SeverityLevel->viewAttributes() ?>><?php echo $ticket->SeverityLevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket->Days->Visible) { // Days ?>
			<td <?php echo $ticket->Days->cellAttributes() ?>>
<span id="el_ticket_Days">
<span<?php echo $ticket->Days->viewAttributes() ?>><?php echo $ticket->Days->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket->DataLastUpdated->Visible) { // DataLastUpdated ?>
			<td <?php echo $ticket->DataLastUpdated->cellAttributes() ?>>
<span id="el_ticket_DataLastUpdated">
<span<?php echo $ticket->DataLastUpdated->viewAttributes() ?>><?php echo $ticket->DataLastUpdated->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>