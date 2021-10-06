<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($client->Visible) { ?>
<div id="t_client" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_clientmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($client->ClientSerNo->Visible) { // ClientSerNo ?>
			<th class="<?php echo $client->ClientSerNo->headerCellClass() ?>"><?php echo $client->ClientSerNo->caption() ?></th>
<?php } ?>
<?php if ($client->ClientID->Visible) { // ClientID ?>
			<th class="<?php echo $client->ClientID->headerCellClass() ?>"><?php echo $client->ClientID->caption() ?></th>
<?php } ?>
<?php if ($client->ClientType->Visible) { // ClientType ?>
			<th class="<?php echo $client->ClientType->headerCellClass() ?>"><?php echo $client->ClientType->caption() ?></th>
<?php } ?>
<?php if ($client->IdentityType->Visible) { // IdentityType ?>
			<th class="<?php echo $client->IdentityType->headerCellClass() ?>"><?php echo $client->IdentityType->caption() ?></th>
<?php } ?>
<?php if ($client->PrivilegeCode->Visible) { // PrivilegeCode ?>
			<th class="<?php echo $client->PrivilegeCode->headerCellClass() ?>"><?php echo $client->PrivilegeCode->caption() ?></th>
<?php } ?>
<?php if ($client->ClientName->Visible) { // ClientName ?>
			<th class="<?php echo $client->ClientName->headerCellClass() ?>"><?php echo $client->ClientName->caption() ?></th>
<?php } ?>
<?php if ($client->Title->Visible) { // Title ?>
			<th class="<?php echo $client->Title->headerCellClass() ?>"><?php echo $client->Title->caption() ?></th>
<?php } ?>
<?php if ($client->Surname->Visible) { // Surname ?>
			<th class="<?php echo $client->Surname->headerCellClass() ?>"><?php echo $client->Surname->caption() ?></th>
<?php } ?>
<?php if ($client->FirstName->Visible) { // FirstName ?>
			<th class="<?php echo $client->FirstName->headerCellClass() ?>"><?php echo $client->FirstName->caption() ?></th>
<?php } ?>
<?php if ($client->MiddleName->Visible) { // MiddleName ?>
			<th class="<?php echo $client->MiddleName->headerCellClass() ?>"><?php echo $client->MiddleName->caption() ?></th>
<?php } ?>
<?php if ($client->Sex->Visible) { // Sex ?>
			<th class="<?php echo $client->Sex->headerCellClass() ?>"><?php echo $client->Sex->caption() ?></th>
<?php } ?>
<?php if ($client->MaritalStatus->Visible) { // MaritalStatus ?>
			<th class="<?php echo $client->MaritalStatus->headerCellClass() ?>"><?php echo $client->MaritalStatus->caption() ?></th>
<?php } ?>
<?php if ($client->DateOfBirth->Visible) { // DateOfBirth ?>
			<th class="<?php echo $client->DateOfBirth->headerCellClass() ?>"><?php echo $client->DateOfBirth->caption() ?></th>
<?php } ?>
<?php if ($client->PostalAddress->Visible) { // PostalAddress ?>
			<th class="<?php echo $client->PostalAddress->headerCellClass() ?>"><?php echo $client->PostalAddress->caption() ?></th>
<?php } ?>
<?php if ($client->PhysicalAddress->Visible) { // PhysicalAddress ?>
			<th class="<?php echo $client->PhysicalAddress->headerCellClass() ?>"><?php echo $client->PhysicalAddress->caption() ?></th>
<?php } ?>
<?php if ($client->TownOrVillage->Visible) { // TownOrVillage ?>
			<th class="<?php echo $client->TownOrVillage->headerCellClass() ?>"><?php echo $client->TownOrVillage->caption() ?></th>
<?php } ?>
<?php if ($client->Telephone->Visible) { // Telephone ?>
			<th class="<?php echo $client->Telephone->headerCellClass() ?>"><?php echo $client->Telephone->caption() ?></th>
<?php } ?>
<?php if ($client->Mobile->Visible) { // Mobile ?>
			<th class="<?php echo $client->Mobile->headerCellClass() ?>"><?php echo $client->Mobile->caption() ?></th>
<?php } ?>
<?php if ($client->Fax->Visible) { // Fax ?>
			<th class="<?php echo $client->Fax->headerCellClass() ?>"><?php echo $client->Fax->caption() ?></th>
<?php } ?>
<?php if ($client->_Email->Visible) { // Email ?>
			<th class="<?php echo $client->_Email->headerCellClass() ?>"><?php echo $client->_Email->caption() ?></th>
<?php } ?>
<?php if ($client->NextOfKin->Visible) { // NextOfKin ?>
			<th class="<?php echo $client->NextOfKin->headerCellClass() ?>"><?php echo $client->NextOfKin->caption() ?></th>
<?php } ?>
<?php if ($client->RelationshipCode->Visible) { // RelationshipCode ?>
			<th class="<?php echo $client->RelationshipCode->headerCellClass() ?>"><?php echo $client->RelationshipCode->caption() ?></th>
<?php } ?>
<?php if ($client->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
			<th class="<?php echo $client->NextOfKinMobile->headerCellClass() ?>"><?php echo $client->NextOfKinMobile->caption() ?></th>
<?php } ?>
<?php if ($client->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
			<th class="<?php echo $client->NextOfKinEmail->headerCellClass() ?>"><?php echo $client->NextOfKinEmail->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($client->ClientSerNo->Visible) { // ClientSerNo ?>
			<td <?php echo $client->ClientSerNo->cellAttributes() ?>>
<span id="el_client_ClientSerNo">
<span<?php echo $client->ClientSerNo->viewAttributes() ?>><?php echo $client->ClientSerNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client->ClientID->Visible) { // ClientID ?>
			<td <?php echo $client->ClientID->cellAttributes() ?>>
<span id="el_client_ClientID">
<span<?php echo $client->ClientID->viewAttributes() ?>><?php echo $client->ClientID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client->ClientType->Visible) { // ClientType ?>
			<td <?php echo $client->ClientType->cellAttributes() ?>>
<span id="el_client_ClientType">
<span<?php echo $client->ClientType->viewAttributes() ?>><?php echo $client->ClientType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client->IdentityType->Visible) { // IdentityType ?>
			<td <?php echo $client->IdentityType->cellAttributes() ?>>
<span id="el_client_IdentityType">
<span<?php echo $client->IdentityType->viewAttributes() ?>><?php echo $client->IdentityType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client->PrivilegeCode->Visible) { // PrivilegeCode ?>
			<td <?php echo $client->PrivilegeCode->cellAttributes() ?>>
<span id="el_client_PrivilegeCode">
<span<?php echo $client->PrivilegeCode->viewAttributes() ?>><?php echo $client->PrivilegeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client->ClientName->Visible) { // ClientName ?>
			<td <?php echo $client->ClientName->cellAttributes() ?>>
<span id="el_client_ClientName">
<span<?php echo $client->ClientName->viewAttributes() ?>><?php echo $client->ClientName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client->Title->Visible) { // Title ?>
			<td <?php echo $client->Title->cellAttributes() ?>>
<span id="el_client_Title">
<span<?php echo $client->Title->viewAttributes() ?>><?php echo $client->Title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client->Surname->Visible) { // Surname ?>
			<td <?php echo $client->Surname->cellAttributes() ?>>
<span id="el_client_Surname">
<span<?php echo $client->Surname->viewAttributes() ?>><?php echo $client->Surname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client->FirstName->Visible) { // FirstName ?>
			<td <?php echo $client->FirstName->cellAttributes() ?>>
<span id="el_client_FirstName">
<span<?php echo $client->FirstName->viewAttributes() ?>><?php echo $client->FirstName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client->MiddleName->Visible) { // MiddleName ?>
			<td <?php echo $client->MiddleName->cellAttributes() ?>>
<span id="el_client_MiddleName">
<span<?php echo $client->MiddleName->viewAttributes() ?>><?php echo $client->MiddleName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client->Sex->Visible) { // Sex ?>
			<td <?php echo $client->Sex->cellAttributes() ?>>
<span id="el_client_Sex">
<span<?php echo $client->Sex->viewAttributes() ?>><?php echo $client->Sex->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client->MaritalStatus->Visible) { // MaritalStatus ?>
			<td <?php echo $client->MaritalStatus->cellAttributes() ?>>
<span id="el_client_MaritalStatus">
<span<?php echo $client->MaritalStatus->viewAttributes() ?>><?php echo $client->MaritalStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client->DateOfBirth->Visible) { // DateOfBirth ?>
			<td <?php echo $client->DateOfBirth->cellAttributes() ?>>
<span id="el_client_DateOfBirth">
<span<?php echo $client->DateOfBirth->viewAttributes() ?>><?php echo $client->DateOfBirth->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client->PostalAddress->Visible) { // PostalAddress ?>
			<td <?php echo $client->PostalAddress->cellAttributes() ?>>
<span id="el_client_PostalAddress">
<span<?php echo $client->PostalAddress->viewAttributes() ?>><?php echo $client->PostalAddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client->PhysicalAddress->Visible) { // PhysicalAddress ?>
			<td <?php echo $client->PhysicalAddress->cellAttributes() ?>>
<span id="el_client_PhysicalAddress">
<span<?php echo $client->PhysicalAddress->viewAttributes() ?>><?php echo $client->PhysicalAddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client->TownOrVillage->Visible) { // TownOrVillage ?>
			<td <?php echo $client->TownOrVillage->cellAttributes() ?>>
<span id="el_client_TownOrVillage">
<span<?php echo $client->TownOrVillage->viewAttributes() ?>><?php echo $client->TownOrVillage->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client->Telephone->Visible) { // Telephone ?>
			<td <?php echo $client->Telephone->cellAttributes() ?>>
<span id="el_client_Telephone">
<span<?php echo $client->Telephone->viewAttributes() ?>><?php echo $client->Telephone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client->Mobile->Visible) { // Mobile ?>
			<td <?php echo $client->Mobile->cellAttributes() ?>>
<span id="el_client_Mobile">
<span<?php echo $client->Mobile->viewAttributes() ?>><?php echo $client->Mobile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client->Fax->Visible) { // Fax ?>
			<td <?php echo $client->Fax->cellAttributes() ?>>
<span id="el_client_Fax">
<span<?php echo $client->Fax->viewAttributes() ?>><?php echo $client->Fax->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client->_Email->Visible) { // Email ?>
			<td <?php echo $client->_Email->cellAttributes() ?>>
<span id="el_client__Email">
<span<?php echo $client->_Email->viewAttributes() ?>><?php echo $client->_Email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client->NextOfKin->Visible) { // NextOfKin ?>
			<td <?php echo $client->NextOfKin->cellAttributes() ?>>
<span id="el_client_NextOfKin">
<span<?php echo $client->NextOfKin->viewAttributes() ?>><?php echo $client->NextOfKin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client->RelationshipCode->Visible) { // RelationshipCode ?>
			<td <?php echo $client->RelationshipCode->cellAttributes() ?>>
<span id="el_client_RelationshipCode">
<span<?php echo $client->RelationshipCode->viewAttributes() ?>><?php echo $client->RelationshipCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
			<td <?php echo $client->NextOfKinMobile->cellAttributes() ?>>
<span id="el_client_NextOfKinMobile">
<span<?php echo $client->NextOfKinMobile->viewAttributes() ?>><?php echo $client->NextOfKinMobile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
			<td <?php echo $client->NextOfKinEmail->cellAttributes() ?>>
<span id="el_client_NextOfKinEmail">
<span<?php echo $client->NextOfKinEmail->viewAttributes() ?>><?php echo $client->NextOfKinEmail->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>