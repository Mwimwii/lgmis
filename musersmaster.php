<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($musers->Visible) { ?>
<div id="t_musers" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_musersmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($musers->UserCode->Visible) { // UserCode ?>
			<th class="<?php echo $musers->UserCode->headerCellClass() ?>"><?php echo $musers->UserCode->caption() ?></th>
<?php } ?>
<?php if ($musers->UserName->Visible) { // UserName ?>
			<th class="<?php echo $musers->UserName->headerCellClass() ?>"><?php echo $musers->UserName->caption() ?></th>
<?php } ?>
<?php if ($musers->Password->Visible) { // Password ?>
			<th class="<?php echo $musers->Password->headerCellClass() ?>"><?php echo $musers->Password->caption() ?></th>
<?php } ?>
<?php if ($musers->EmployeeID->Visible) { // EmployeeID ?>
			<th class="<?php echo $musers->EmployeeID->headerCellClass() ?>"><?php echo $musers->EmployeeID->caption() ?></th>
<?php } ?>
<?php if ($musers->FirstName->Visible) { // FirstName ?>
			<th class="<?php echo $musers->FirstName->headerCellClass() ?>"><?php echo $musers->FirstName->caption() ?></th>
<?php } ?>
<?php if ($musers->LastName->Visible) { // LastName ?>
			<th class="<?php echo $musers->LastName->headerCellClass() ?>"><?php echo $musers->LastName->caption() ?></th>
<?php } ?>
<?php if ($musers->ProvinceCode->Visible) { // ProvinceCode ?>
			<th class="<?php echo $musers->ProvinceCode->headerCellClass() ?>"><?php echo $musers->ProvinceCode->caption() ?></th>
<?php } ?>
<?php if ($musers->LACode->Visible) { // LACode ?>
			<th class="<?php echo $musers->LACode->headerCellClass() ?>"><?php echo $musers->LACode->caption() ?></th>
<?php } ?>
<?php if ($musers->Level->Visible) { // Level ?>
			<th class="<?php echo $musers->Level->headerCellClass() ?>"><?php echo $musers->Level->caption() ?></th>
<?php } ?>
<?php if ($musers->Role->Visible) { // Role ?>
			<th class="<?php echo $musers->Role->headerCellClass() ?>"><?php echo $musers->Role->caption() ?></th>
<?php } ?>
<?php if ($musers->Clearance->Visible) { // Clearance ?>
			<th class="<?php echo $musers->Clearance->headerCellClass() ?>"><?php echo $musers->Clearance->caption() ?></th>
<?php } ?>
<?php if ($musers->OrganisationLevel->Visible) { // OrganisationLevel ?>
			<th class="<?php echo $musers->OrganisationLevel->headerCellClass() ?>"><?php echo $musers->OrganisationLevel->caption() ?></th>
<?php } ?>
<?php if ($musers->Active->Visible) { // Active ?>
			<th class="<?php echo $musers->Active->headerCellClass() ?>"><?php echo $musers->Active->caption() ?></th>
<?php } ?>
<?php if ($musers->_Email->Visible) { // Email ?>
			<th class="<?php echo $musers->_Email->headerCellClass() ?>"><?php echo $musers->_Email->caption() ?></th>
<?php } ?>
<?php if ($musers->Telephone->Visible) { // Telephone ?>
			<th class="<?php echo $musers->Telephone->headerCellClass() ?>"><?php echo $musers->Telephone->caption() ?></th>
<?php } ?>
<?php if ($musers->Mobile->Visible) { // Mobile ?>
			<th class="<?php echo $musers->Mobile->headerCellClass() ?>"><?php echo $musers->Mobile->caption() ?></th>
<?php } ?>
<?php if ($musers->Position->Visible) { // Position ?>
			<th class="<?php echo $musers->Position->headerCellClass() ?>"><?php echo $musers->Position->caption() ?></th>
<?php } ?>
<?php if ($musers->ReportsTo->Visible) { // ReportsTo ?>
			<th class="<?php echo $musers->ReportsTo->headerCellClass() ?>"><?php echo $musers->ReportsTo->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($musers->UserCode->Visible) { // UserCode ?>
			<td <?php echo $musers->UserCode->cellAttributes() ?>>
<span id="el_musers_UserCode">
<span<?php echo $musers->UserCode->viewAttributes() ?>><?php echo $musers->UserCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers->UserName->Visible) { // UserName ?>
			<td <?php echo $musers->UserName->cellAttributes() ?>>
<span id="el_musers_UserName">
<span<?php echo $musers->UserName->viewAttributes() ?>><?php echo $musers->UserName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers->Password->Visible) { // Password ?>
			<td <?php echo $musers->Password->cellAttributes() ?>>
<span id="el_musers_Password">
<span<?php echo $musers->Password->viewAttributes() ?>><?php echo $musers->Password->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers->EmployeeID->Visible) { // EmployeeID ?>
			<td <?php echo $musers->EmployeeID->cellAttributes() ?>>
<span id="el_musers_EmployeeID">
<span<?php echo $musers->EmployeeID->viewAttributes() ?>><?php echo $musers->EmployeeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers->FirstName->Visible) { // FirstName ?>
			<td <?php echo $musers->FirstName->cellAttributes() ?>>
<span id="el_musers_FirstName">
<span<?php echo $musers->FirstName->viewAttributes() ?>><?php echo $musers->FirstName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers->LastName->Visible) { // LastName ?>
			<td <?php echo $musers->LastName->cellAttributes() ?>>
<span id="el_musers_LastName">
<span<?php echo $musers->LastName->viewAttributes() ?>><?php echo $musers->LastName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers->ProvinceCode->Visible) { // ProvinceCode ?>
			<td <?php echo $musers->ProvinceCode->cellAttributes() ?>>
<span id="el_musers_ProvinceCode">
<span<?php echo $musers->ProvinceCode->viewAttributes() ?>><?php echo $musers->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers->LACode->Visible) { // LACode ?>
			<td <?php echo $musers->LACode->cellAttributes() ?>>
<span id="el_musers_LACode">
<span<?php echo $musers->LACode->viewAttributes() ?>><?php echo $musers->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers->Level->Visible) { // Level ?>
			<td <?php echo $musers->Level->cellAttributes() ?>>
<span id="el_musers_Level">
<span<?php echo $musers->Level->viewAttributes() ?>><?php echo $musers->Level->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers->Role->Visible) { // Role ?>
			<td <?php echo $musers->Role->cellAttributes() ?>>
<span id="el_musers_Role">
<span<?php echo $musers->Role->viewAttributes() ?>><?php echo $musers->Role->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers->Clearance->Visible) { // Clearance ?>
			<td <?php echo $musers->Clearance->cellAttributes() ?>>
<span id="el_musers_Clearance">
<span<?php echo $musers->Clearance->viewAttributes() ?>><?php echo $musers->Clearance->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers->OrganisationLevel->Visible) { // OrganisationLevel ?>
			<td <?php echo $musers->OrganisationLevel->cellAttributes() ?>>
<span id="el_musers_OrganisationLevel">
<span<?php echo $musers->OrganisationLevel->viewAttributes() ?>><?php echo $musers->OrganisationLevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers->Active->Visible) { // Active ?>
			<td <?php echo $musers->Active->cellAttributes() ?>>
<span id="el_musers_Active">
<span<?php echo $musers->Active->viewAttributes() ?>><?php echo $musers->Active->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers->_Email->Visible) { // Email ?>
			<td <?php echo $musers->_Email->cellAttributes() ?>>
<span id="el_musers__Email">
<span<?php echo $musers->_Email->viewAttributes() ?>><?php echo $musers->_Email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers->Telephone->Visible) { // Telephone ?>
			<td <?php echo $musers->Telephone->cellAttributes() ?>>
<span id="el_musers_Telephone">
<span<?php echo $musers->Telephone->viewAttributes() ?>><?php echo $musers->Telephone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers->Mobile->Visible) { // Mobile ?>
			<td <?php echo $musers->Mobile->cellAttributes() ?>>
<span id="el_musers_Mobile">
<span<?php echo $musers->Mobile->viewAttributes() ?>><?php echo $musers->Mobile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers->Position->Visible) { // Position ?>
			<td <?php echo $musers->Position->cellAttributes() ?>>
<span id="el_musers_Position">
<span<?php echo $musers->Position->viewAttributes() ?>><?php echo $musers->Position->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers->ReportsTo->Visible) { // ReportsTo ?>
			<td <?php echo $musers->ReportsTo->cellAttributes() ?>>
<span id="el_musers_ReportsTo">
<span<?php echo $musers->ReportsTo->viewAttributes() ?>><?php echo $musers->ReportsTo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>