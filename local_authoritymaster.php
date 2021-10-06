<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($local_authority->Visible) { ?>
<div id="t_local_authority" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_local_authoritymaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($local_authority->LAName->Visible) { // LAName ?>
			<th class="<?php echo $local_authority->LAName->headerCellClass() ?>"><?php echo $local_authority->LAName->caption() ?></th>
<?php } ?>
<?php if ($local_authority->CouncilType->Visible) { // CouncilType ?>
			<th class="<?php echo $local_authority->CouncilType->headerCellClass() ?>"><?php echo $local_authority->CouncilType->caption() ?></th>
<?php } ?>
<?php if ($local_authority->ProvinceCode->Visible) { // ProvinceCode ?>
			<th class="<?php echo $local_authority->ProvinceCode->headerCellClass() ?>"><?php echo $local_authority->ProvinceCode->caption() ?></th>
<?php } ?>
<?php if ($local_authority->Clients->Visible) { // Clients ?>
			<th class="<?php echo $local_authority->Clients->headerCellClass() ?>"><?php echo $local_authority->Clients->caption() ?></th>
<?php } ?>
<?php if ($local_authority->Beneficiaries->Visible) { // Beneficiaries ?>
			<th class="<?php echo $local_authority->Beneficiaries->headerCellClass() ?>"><?php echo $local_authority->Beneficiaries->caption() ?></th>
<?php } ?>
<?php if ($local_authority->ExecutiveAuthority->Visible) { // ExecutiveAuthority ?>
			<th class="<?php echo $local_authority->ExecutiveAuthority->headerCellClass() ?>"><?php echo $local_authority->ExecutiveAuthority->caption() ?></th>
<?php } ?>
<?php if ($local_authority->ControllingOfficer->Visible) { // ControllingOfficer ?>
			<th class="<?php echo $local_authority->ControllingOfficer->headerCellClass() ?>"><?php echo $local_authority->ControllingOfficer->caption() ?></th>
<?php } ?>
<?php if ($local_authority->Comment->Visible) { // Comment ?>
			<th class="<?php echo $local_authority->Comment->headerCellClass() ?>"><?php echo $local_authority->Comment->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($local_authority->LAName->Visible) { // LAName ?>
			<td <?php echo $local_authority->LAName->cellAttributes() ?>>
<span id="el_local_authority_LAName">
<span<?php echo $local_authority->LAName->viewAttributes() ?>><?php echo $local_authority->LAName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($local_authority->CouncilType->Visible) { // CouncilType ?>
			<td <?php echo $local_authority->CouncilType->cellAttributes() ?>>
<span id="el_local_authority_CouncilType">
<span<?php echo $local_authority->CouncilType->viewAttributes() ?>><?php echo $local_authority->CouncilType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($local_authority->ProvinceCode->Visible) { // ProvinceCode ?>
			<td <?php echo $local_authority->ProvinceCode->cellAttributes() ?>>
<span id="el_local_authority_ProvinceCode">
<span<?php echo $local_authority->ProvinceCode->viewAttributes() ?>><?php echo $local_authority->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($local_authority->Clients->Visible) { // Clients ?>
			<td <?php echo $local_authority->Clients->cellAttributes() ?>>
<span id="el_local_authority_Clients">
<span<?php echo $local_authority->Clients->viewAttributes() ?>><?php echo $local_authority->Clients->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($local_authority->Beneficiaries->Visible) { // Beneficiaries ?>
			<td <?php echo $local_authority->Beneficiaries->cellAttributes() ?>>
<span id="el_local_authority_Beneficiaries">
<span<?php echo $local_authority->Beneficiaries->viewAttributes() ?>><?php echo $local_authority->Beneficiaries->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($local_authority->ExecutiveAuthority->Visible) { // ExecutiveAuthority ?>
			<td <?php echo $local_authority->ExecutiveAuthority->cellAttributes() ?>>
<span id="el_local_authority_ExecutiveAuthority">
<span<?php echo $local_authority->ExecutiveAuthority->viewAttributes() ?>><?php echo $local_authority->ExecutiveAuthority->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($local_authority->ControllingOfficer->Visible) { // ControllingOfficer ?>
			<td <?php echo $local_authority->ControllingOfficer->cellAttributes() ?>>
<span id="el_local_authority_ControllingOfficer">
<span<?php echo $local_authority->ControllingOfficer->viewAttributes() ?>><?php echo $local_authority->ControllingOfficer->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($local_authority->Comment->Visible) { // Comment ?>
			<td <?php echo $local_authority->Comment->cellAttributes() ?>>
<span id="el_local_authority_Comment">
<span<?php echo $local_authority->Comment->viewAttributes() ?>><?php echo $local_authority->Comment->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>