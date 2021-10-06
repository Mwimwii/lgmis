<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($councillorship->Visible) { ?>
<div id="t_councillorship" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_councillorshipmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($councillorship->EmployeeID->Visible) { // EmployeeID ?>
			<th class="<?php echo $councillorship->EmployeeID->headerCellClass() ?>"><?php echo $councillorship->EmployeeID->caption() ?></th>
<?php } ?>
<?php if ($councillorship->LACode->Visible) { // LACode ?>
			<th class="<?php echo $councillorship->LACode->headerCellClass() ?>"><?php echo $councillorship->LACode->caption() ?></th>
<?php } ?>
<?php if ($councillorship->PoliticalParty->Visible) { // PoliticalParty ?>
			<th class="<?php echo $councillorship->PoliticalParty->headerCellClass() ?>"><?php echo $councillorship->PoliticalParty->caption() ?></th>
<?php } ?>
<?php if ($councillorship->Occupation->Visible) { // Occupation ?>
			<th class="<?php echo $councillorship->Occupation->headerCellClass() ?>"><?php echo $councillorship->Occupation->caption() ?></th>
<?php } ?>
<?php if ($councillorship->PositionInCouncil->Visible) { // PositionInCouncil ?>
			<th class="<?php echo $councillorship->PositionInCouncil->headerCellClass() ?>"><?php echo $councillorship->PositionInCouncil->caption() ?></th>
<?php } ?>
<?php if ($councillorship->Committee->Visible) { // Committee ?>
			<th class="<?php echo $councillorship->Committee->headerCellClass() ?>"><?php echo $councillorship->Committee->caption() ?></th>
<?php } ?>
<?php if ($councillorship->CommitteeRole->Visible) { // CommitteeRole ?>
			<th class="<?php echo $councillorship->CommitteeRole->headerCellClass() ?>"><?php echo $councillorship->CommitteeRole->caption() ?></th>
<?php } ?>
<?php if ($councillorship->CouncilTerm->Visible) { // CouncilTerm ?>
			<th class="<?php echo $councillorship->CouncilTerm->headerCellClass() ?>"><?php echo $councillorship->CouncilTerm->caption() ?></th>
<?php } ?>
<?php if ($councillorship->CouncillorTypeType->Visible) { // CouncillorTypeType ?>
			<th class="<?php echo $councillorship->CouncillorTypeType->headerCellClass() ?>"><?php echo $councillorship->CouncillorTypeType->caption() ?></th>
<?php } ?>
<?php if ($councillorship->ExitReason->Visible) { // ExitReason ?>
			<th class="<?php echo $councillorship->ExitReason->headerCellClass() ?>"><?php echo $councillorship->ExitReason->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($councillorship->EmployeeID->Visible) { // EmployeeID ?>
			<td <?php echo $councillorship->EmployeeID->cellAttributes() ?>>
<span id="el_councillorship_EmployeeID">
<span<?php echo $councillorship->EmployeeID->viewAttributes() ?>><?php echo $councillorship->EmployeeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship->LACode->Visible) { // LACode ?>
			<td <?php echo $councillorship->LACode->cellAttributes() ?>>
<span id="el_councillorship_LACode">
<span<?php echo $councillorship->LACode->viewAttributes() ?>><?php echo $councillorship->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship->PoliticalParty->Visible) { // PoliticalParty ?>
			<td <?php echo $councillorship->PoliticalParty->cellAttributes() ?>>
<span id="el_councillorship_PoliticalParty">
<span<?php echo $councillorship->PoliticalParty->viewAttributes() ?>><?php echo $councillorship->PoliticalParty->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship->Occupation->Visible) { // Occupation ?>
			<td <?php echo $councillorship->Occupation->cellAttributes() ?>>
<span id="el_councillorship_Occupation">
<span<?php echo $councillorship->Occupation->viewAttributes() ?>><?php echo $councillorship->Occupation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship->PositionInCouncil->Visible) { // PositionInCouncil ?>
			<td <?php echo $councillorship->PositionInCouncil->cellAttributes() ?>>
<span id="el_councillorship_PositionInCouncil">
<span<?php echo $councillorship->PositionInCouncil->viewAttributes() ?>><?php echo $councillorship->PositionInCouncil->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship->Committee->Visible) { // Committee ?>
			<td <?php echo $councillorship->Committee->cellAttributes() ?>>
<span id="el_councillorship_Committee">
<span<?php echo $councillorship->Committee->viewAttributes() ?>><?php echo $councillorship->Committee->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship->CommitteeRole->Visible) { // CommitteeRole ?>
			<td <?php echo $councillorship->CommitteeRole->cellAttributes() ?>>
<span id="el_councillorship_CommitteeRole">
<span<?php echo $councillorship->CommitteeRole->viewAttributes() ?>><?php echo $councillorship->CommitteeRole->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship->CouncilTerm->Visible) { // CouncilTerm ?>
			<td <?php echo $councillorship->CouncilTerm->cellAttributes() ?>>
<span id="el_councillorship_CouncilTerm">
<span<?php echo $councillorship->CouncilTerm->viewAttributes() ?>><?php echo $councillorship->CouncilTerm->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship->CouncillorTypeType->Visible) { // CouncillorTypeType ?>
			<td <?php echo $councillorship->CouncillorTypeType->cellAttributes() ?>>
<span id="el_councillorship_CouncillorTypeType">
<span<?php echo $councillorship->CouncillorTypeType->viewAttributes() ?>><?php echo $councillorship->CouncillorTypeType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship->ExitReason->Visible) { // ExitReason ?>
			<td <?php echo $councillorship->ExitReason->cellAttributes() ?>>
<span id="el_councillorship_ExitReason">
<span<?php echo $councillorship->ExitReason->viewAttributes() ?>><?php echo $councillorship->ExitReason->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>