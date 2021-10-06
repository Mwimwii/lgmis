<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($councillor->Visible) { ?>
<div id="t_councillor" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_councillormaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($councillor->EmployeeID->Visible) { // EmployeeID ?>
			<th class="<?php echo $councillor->EmployeeID->headerCellClass() ?>"><?php echo $councillor->EmployeeID->caption() ?></th>
<?php } ?>
<?php if ($councillor->LACode->Visible) { // LACode ?>
			<th class="<?php echo $councillor->LACode->headerCellClass() ?>"><?php echo $councillor->LACode->caption() ?></th>
<?php } ?>
<?php if ($councillor->NRC->Visible) { // NRC ?>
			<th class="<?php echo $councillor->NRC->headerCellClass() ?>"><?php echo $councillor->NRC->caption() ?></th>
<?php } ?>
<?php if ($councillor->Sex->Visible) { // Sex ?>
			<th class="<?php echo $councillor->Sex->headerCellClass() ?>"><?php echo $councillor->Sex->caption() ?></th>
<?php } ?>
<?php if ($councillor->Title->Visible) { // Title ?>
			<th class="<?php echo $councillor->Title->headerCellClass() ?>"><?php echo $councillor->Title->caption() ?></th>
<?php } ?>
<?php if ($councillor->Surname->Visible) { // Surname ?>
			<th class="<?php echo $councillor->Surname->headerCellClass() ?>"><?php echo $councillor->Surname->caption() ?></th>
<?php } ?>
<?php if ($councillor->FirstName->Visible) { // FirstName ?>
			<th class="<?php echo $councillor->FirstName->headerCellClass() ?>"><?php echo $councillor->FirstName->caption() ?></th>
<?php } ?>
<?php if ($councillor->MiddleName->Visible) { // MiddleName ?>
			<th class="<?php echo $councillor->MiddleName->headerCellClass() ?>"><?php echo $councillor->MiddleName->caption() ?></th>
<?php } ?>
<?php if ($councillor->MaritalStatus->Visible) { // MaritalStatus ?>
			<th class="<?php echo $councillor->MaritalStatus->headerCellClass() ?>"><?php echo $councillor->MaritalStatus->caption() ?></th>
<?php } ?>
<?php if ($councillor->DateOfBirth->Visible) { // DateOfBirth ?>
			<th class="<?php echo $councillor->DateOfBirth->headerCellClass() ?>"><?php echo $councillor->DateOfBirth->caption() ?></th>
<?php } ?>
<?php if ($councillor->Mobile->Visible) { // Mobile ?>
			<th class="<?php echo $councillor->Mobile->headerCellClass() ?>"><?php echo $councillor->Mobile->caption() ?></th>
<?php } ?>
<?php if ($councillor->_Email->Visible) { // Email ?>
			<th class="<?php echo $councillor->_Email->headerCellClass() ?>"><?php echo $councillor->_Email->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($councillor->EmployeeID->Visible) { // EmployeeID ?>
			<td <?php echo $councillor->EmployeeID->cellAttributes() ?>>
<span id="el_councillor_EmployeeID">
<span<?php echo $councillor->EmployeeID->viewAttributes() ?>><?php echo $councillor->EmployeeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor->LACode->Visible) { // LACode ?>
			<td <?php echo $councillor->LACode->cellAttributes() ?>>
<span id="el_councillor_LACode">
<span<?php echo $councillor->LACode->viewAttributes() ?>><?php echo $councillor->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor->NRC->Visible) { // NRC ?>
			<td <?php echo $councillor->NRC->cellAttributes() ?>>
<span id="el_councillor_NRC">
<span<?php echo $councillor->NRC->viewAttributes() ?>><?php echo $councillor->NRC->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor->Sex->Visible) { // Sex ?>
			<td <?php echo $councillor->Sex->cellAttributes() ?>>
<span id="el_councillor_Sex">
<span<?php echo $councillor->Sex->viewAttributes() ?>><?php echo $councillor->Sex->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor->Title->Visible) { // Title ?>
			<td <?php echo $councillor->Title->cellAttributes() ?>>
<span id="el_councillor_Title">
<span<?php echo $councillor->Title->viewAttributes() ?>><?php echo $councillor->Title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor->Surname->Visible) { // Surname ?>
			<td <?php echo $councillor->Surname->cellAttributes() ?>>
<span id="el_councillor_Surname">
<span<?php echo $councillor->Surname->viewAttributes() ?>><?php echo $councillor->Surname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor->FirstName->Visible) { // FirstName ?>
			<td <?php echo $councillor->FirstName->cellAttributes() ?>>
<span id="el_councillor_FirstName">
<span<?php echo $councillor->FirstName->viewAttributes() ?>><?php echo $councillor->FirstName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor->MiddleName->Visible) { // MiddleName ?>
			<td <?php echo $councillor->MiddleName->cellAttributes() ?>>
<span id="el_councillor_MiddleName">
<span<?php echo $councillor->MiddleName->viewAttributes() ?>><?php echo $councillor->MiddleName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor->MaritalStatus->Visible) { // MaritalStatus ?>
			<td <?php echo $councillor->MaritalStatus->cellAttributes() ?>>
<span id="el_councillor_MaritalStatus">
<span<?php echo $councillor->MaritalStatus->viewAttributes() ?>><?php echo $councillor->MaritalStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor->DateOfBirth->Visible) { // DateOfBirth ?>
			<td <?php echo $councillor->DateOfBirth->cellAttributes() ?>>
<span id="el_councillor_DateOfBirth">
<span<?php echo $councillor->DateOfBirth->viewAttributes() ?>><?php echo $councillor->DateOfBirth->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor->Mobile->Visible) { // Mobile ?>
			<td <?php echo $councillor->Mobile->cellAttributes() ?>>
<span id="el_councillor_Mobile">
<span<?php echo $councillor->Mobile->viewAttributes() ?>><?php echo $councillor->Mobile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor->_Email->Visible) { // Email ?>
			<td <?php echo $councillor->_Email->cellAttributes() ?>>
<span id="el_councillor__Email">
<span<?php echo $councillor->_Email->viewAttributes() ?>><?php echo $councillor->_Email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>