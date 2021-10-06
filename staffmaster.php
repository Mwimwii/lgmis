<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($staff->Visible) { ?>
<div id="t_staff" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_staffmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($staff->EmployeeID->Visible) { // EmployeeID ?>
			<th class="<?php echo $staff->EmployeeID->headerCellClass() ?>"><?php echo $staff->EmployeeID->caption() ?></th>
<?php } ?>
<?php if ($staff->LACode->Visible) { // LACode ?>
			<th class="<?php echo $staff->LACode->headerCellClass() ?>"><?php echo $staff->LACode->caption() ?></th>
<?php } ?>
<?php if ($staff->FormerFileNumber->Visible) { // FormerFileNumber ?>
			<th class="<?php echo $staff->FormerFileNumber->headerCellClass() ?>"><?php echo $staff->FormerFileNumber->caption() ?></th>
<?php } ?>
<?php if ($staff->NRC->Visible) { // NRC ?>
			<th class="<?php echo $staff->NRC->headerCellClass() ?>"><?php echo $staff->NRC->caption() ?></th>
<?php } ?>
<?php if ($staff->Title->Visible) { // Title ?>
			<th class="<?php echo $staff->Title->headerCellClass() ?>"><?php echo $staff->Title->caption() ?></th>
<?php } ?>
<?php if ($staff->Surname->Visible) { // Surname ?>
			<th class="<?php echo $staff->Surname->headerCellClass() ?>"><?php echo $staff->Surname->caption() ?></th>
<?php } ?>
<?php if ($staff->FirstName->Visible) { // FirstName ?>
			<th class="<?php echo $staff->FirstName->headerCellClass() ?>"><?php echo $staff->FirstName->caption() ?></th>
<?php } ?>
<?php if ($staff->MiddleName->Visible) { // MiddleName ?>
			<th class="<?php echo $staff->MiddleName->headerCellClass() ?>"><?php echo $staff->MiddleName->caption() ?></th>
<?php } ?>
<?php if ($staff->Sex->Visible) { // Sex ?>
			<th class="<?php echo $staff->Sex->headerCellClass() ?>"><?php echo $staff->Sex->caption() ?></th>
<?php } ?>
<?php if ($staff->MaritalStatus->Visible) { // MaritalStatus ?>
			<th class="<?php echo $staff->MaritalStatus->headerCellClass() ?>"><?php echo $staff->MaritalStatus->caption() ?></th>
<?php } ?>
<?php if ($staff->MaidenName->Visible) { // MaidenName ?>
			<th class="<?php echo $staff->MaidenName->headerCellClass() ?>"><?php echo $staff->MaidenName->caption() ?></th>
<?php } ?>
<?php if ($staff->DateOfBirth->Visible) { // DateOfBirth ?>
			<th class="<?php echo $staff->DateOfBirth->headerCellClass() ?>"><?php echo $staff->DateOfBirth->caption() ?></th>
<?php } ?>
<?php if ($staff->AcademicQualification->Visible) { // AcademicQualification ?>
			<th class="<?php echo $staff->AcademicQualification->headerCellClass() ?>"><?php echo $staff->AcademicQualification->caption() ?></th>
<?php } ?>
<?php if ($staff->ProfessionalQualification->Visible) { // ProfessionalQualification ?>
			<th class="<?php echo $staff->ProfessionalQualification->headerCellClass() ?>"><?php echo $staff->ProfessionalQualification->caption() ?></th>
<?php } ?>
<?php if ($staff->MedicalCondition->Visible) { // MedicalCondition ?>
			<th class="<?php echo $staff->MedicalCondition->headerCellClass() ?>"><?php echo $staff->MedicalCondition->caption() ?></th>
<?php } ?>
<?php if ($staff->OtherMedicalConditions->Visible) { // OtherMedicalConditions ?>
			<th class="<?php echo $staff->OtherMedicalConditions->headerCellClass() ?>"><?php echo $staff->OtherMedicalConditions->caption() ?></th>
<?php } ?>
<?php if ($staff->PhysicalChallenge->Visible) { // PhysicalChallenge ?>
			<th class="<?php echo $staff->PhysicalChallenge->headerCellClass() ?>"><?php echo $staff->PhysicalChallenge->caption() ?></th>
<?php } ?>
<?php if ($staff->PostalAddress->Visible) { // PostalAddress ?>
			<th class="<?php echo $staff->PostalAddress->headerCellClass() ?>"><?php echo $staff->PostalAddress->caption() ?></th>
<?php } ?>
<?php if ($staff->PhysicalAddress->Visible) { // PhysicalAddress ?>
			<th class="<?php echo $staff->PhysicalAddress->headerCellClass() ?>"><?php echo $staff->PhysicalAddress->caption() ?></th>
<?php } ?>
<?php if ($staff->TownOrVillage->Visible) { // TownOrVillage ?>
			<th class="<?php echo $staff->TownOrVillage->headerCellClass() ?>"><?php echo $staff->TownOrVillage->caption() ?></th>
<?php } ?>
<?php if ($staff->Telephone->Visible) { // Telephone ?>
			<th class="<?php echo $staff->Telephone->headerCellClass() ?>"><?php echo $staff->Telephone->caption() ?></th>
<?php } ?>
<?php if ($staff->Mobile->Visible) { // Mobile ?>
			<th class="<?php echo $staff->Mobile->headerCellClass() ?>"><?php echo $staff->Mobile->caption() ?></th>
<?php } ?>
<?php if ($staff->Fax->Visible) { // Fax ?>
			<th class="<?php echo $staff->Fax->headerCellClass() ?>"><?php echo $staff->Fax->caption() ?></th>
<?php } ?>
<?php if ($staff->_Email->Visible) { // Email ?>
			<th class="<?php echo $staff->_Email->headerCellClass() ?>"><?php echo $staff->_Email->caption() ?></th>
<?php } ?>
<?php if ($staff->NumberOfBiologicalChildren->Visible) { // NumberOfBiologicalChildren ?>
			<th class="<?php echo $staff->NumberOfBiologicalChildren->headerCellClass() ?>"><?php echo $staff->NumberOfBiologicalChildren->caption() ?></th>
<?php } ?>
<?php if ($staff->NumberOfDependants->Visible) { // NumberOfDependants ?>
			<th class="<?php echo $staff->NumberOfDependants->headerCellClass() ?>"><?php echo $staff->NumberOfDependants->caption() ?></th>
<?php } ?>
<?php if ($staff->NextOfKin->Visible) { // NextOfKin ?>
			<th class="<?php echo $staff->NextOfKin->headerCellClass() ?>"><?php echo $staff->NextOfKin->caption() ?></th>
<?php } ?>
<?php if ($staff->RelationshipCode->Visible) { // RelationshipCode ?>
			<th class="<?php echo $staff->RelationshipCode->headerCellClass() ?>"><?php echo $staff->RelationshipCode->caption() ?></th>
<?php } ?>
<?php if ($staff->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
			<th class="<?php echo $staff->NextOfKinMobile->headerCellClass() ?>"><?php echo $staff->NextOfKinMobile->caption() ?></th>
<?php } ?>
<?php if ($staff->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
			<th class="<?php echo $staff->NextOfKinEmail->headerCellClass() ?>"><?php echo $staff->NextOfKinEmail->caption() ?></th>
<?php } ?>
<?php if ($staff->SpouseName->Visible) { // SpouseName ?>
			<th class="<?php echo $staff->SpouseName->headerCellClass() ?>"><?php echo $staff->SpouseName->caption() ?></th>
<?php } ?>
<?php if ($staff->SpouseNRC->Visible) { // SpouseNRC ?>
			<th class="<?php echo $staff->SpouseNRC->headerCellClass() ?>"><?php echo $staff->SpouseNRC->caption() ?></th>
<?php } ?>
<?php if ($staff->SpouseMobile->Visible) { // SpouseMobile ?>
			<th class="<?php echo $staff->SpouseMobile->headerCellClass() ?>"><?php echo $staff->SpouseMobile->caption() ?></th>
<?php } ?>
<?php if ($staff->SpouseEmail->Visible) { // SpouseEmail ?>
			<th class="<?php echo $staff->SpouseEmail->headerCellClass() ?>"><?php echo $staff->SpouseEmail->caption() ?></th>
<?php } ?>
<?php if ($staff->SpouseResidentialAddress->Visible) { // SpouseResidentialAddress ?>
			<th class="<?php echo $staff->SpouseResidentialAddress->headerCellClass() ?>"><?php echo $staff->SpouseResidentialAddress->caption() ?></th>
<?php } ?>
<?php if ($staff->BankAccountNo->Visible) { // BankAccountNo ?>
			<th class="<?php echo $staff->BankAccountNo->headerCellClass() ?>"><?php echo $staff->BankAccountNo->caption() ?></th>
<?php } ?>
<?php if ($staff->PaymentMethod->Visible) { // PaymentMethod ?>
			<th class="<?php echo $staff->PaymentMethod->headerCellClass() ?>"><?php echo $staff->PaymentMethod->caption() ?></th>
<?php } ?>
<?php if ($staff->BankBranchCode->Visible) { // BankBranchCode ?>
			<th class="<?php echo $staff->BankBranchCode->headerCellClass() ?>"><?php echo $staff->BankBranchCode->caption() ?></th>
<?php } ?>
<?php if ($staff->TaxNumber->Visible) { // TaxNumber ?>
			<th class="<?php echo $staff->TaxNumber->headerCellClass() ?>"><?php echo $staff->TaxNumber->caption() ?></th>
<?php } ?>
<?php if ($staff->PensionNumber->Visible) { // PensionNumber ?>
			<th class="<?php echo $staff->PensionNumber->headerCellClass() ?>"><?php echo $staff->PensionNumber->caption() ?></th>
<?php } ?>
<?php if ($staff->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
			<th class="<?php echo $staff->SocialSecurityNo->headerCellClass() ?>"><?php echo $staff->SocialSecurityNo->caption() ?></th>
<?php } ?>
<?php if ($staff->ThirdParties->Visible) { // ThirdParties ?>
			<th class="<?php echo $staff->ThirdParties->headerCellClass() ?>"><?php echo $staff->ThirdParties->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($staff->EmployeeID->Visible) { // EmployeeID ?>
			<td <?php echo $staff->EmployeeID->cellAttributes() ?>>
<span id="el_staff_EmployeeID">
<span<?php echo $staff->EmployeeID->viewAttributes() ?>><?php echo $staff->EmployeeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->LACode->Visible) { // LACode ?>
			<td <?php echo $staff->LACode->cellAttributes() ?>>
<span id="el_staff_LACode">
<span<?php echo $staff->LACode->viewAttributes() ?>><?php echo $staff->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->FormerFileNumber->Visible) { // FormerFileNumber ?>
			<td <?php echo $staff->FormerFileNumber->cellAttributes() ?>>
<span id="el_staff_FormerFileNumber">
<span<?php echo $staff->FormerFileNumber->viewAttributes() ?>><?php echo $staff->FormerFileNumber->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->NRC->Visible) { // NRC ?>
			<td <?php echo $staff->NRC->cellAttributes() ?>>
<span id="el_staff_NRC">
<span<?php echo $staff->NRC->viewAttributes() ?>><?php echo $staff->NRC->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->Title->Visible) { // Title ?>
			<td <?php echo $staff->Title->cellAttributes() ?>>
<span id="el_staff_Title">
<span<?php echo $staff->Title->viewAttributes() ?>><?php echo $staff->Title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->Surname->Visible) { // Surname ?>
			<td <?php echo $staff->Surname->cellAttributes() ?>>
<span id="el_staff_Surname">
<span<?php echo $staff->Surname->viewAttributes() ?>><?php echo $staff->Surname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->FirstName->Visible) { // FirstName ?>
			<td <?php echo $staff->FirstName->cellAttributes() ?>>
<span id="el_staff_FirstName">
<span<?php echo $staff->FirstName->viewAttributes() ?>><?php echo $staff->FirstName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->MiddleName->Visible) { // MiddleName ?>
			<td <?php echo $staff->MiddleName->cellAttributes() ?>>
<span id="el_staff_MiddleName">
<span<?php echo $staff->MiddleName->viewAttributes() ?>><?php echo $staff->MiddleName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->Sex->Visible) { // Sex ?>
			<td <?php echo $staff->Sex->cellAttributes() ?>>
<span id="el_staff_Sex">
<span<?php echo $staff->Sex->viewAttributes() ?>><?php echo $staff->Sex->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->MaritalStatus->Visible) { // MaritalStatus ?>
			<td <?php echo $staff->MaritalStatus->cellAttributes() ?>>
<span id="el_staff_MaritalStatus">
<span<?php echo $staff->MaritalStatus->viewAttributes() ?>><?php echo $staff->MaritalStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->MaidenName->Visible) { // MaidenName ?>
			<td <?php echo $staff->MaidenName->cellAttributes() ?>>
<span id="el_staff_MaidenName">
<span<?php echo $staff->MaidenName->viewAttributes() ?>><?php echo $staff->MaidenName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->DateOfBirth->Visible) { // DateOfBirth ?>
			<td <?php echo $staff->DateOfBirth->cellAttributes() ?>>
<span id="el_staff_DateOfBirth">
<span<?php echo $staff->DateOfBirth->viewAttributes() ?>><?php echo $staff->DateOfBirth->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->AcademicQualification->Visible) { // AcademicQualification ?>
			<td <?php echo $staff->AcademicQualification->cellAttributes() ?>>
<span id="el_staff_AcademicQualification">
<span<?php echo $staff->AcademicQualification->viewAttributes() ?>><?php echo $staff->AcademicQualification->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->ProfessionalQualification->Visible) { // ProfessionalQualification ?>
			<td <?php echo $staff->ProfessionalQualification->cellAttributes() ?>>
<span id="el_staff_ProfessionalQualification">
<span<?php echo $staff->ProfessionalQualification->viewAttributes() ?>><?php echo $staff->ProfessionalQualification->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->MedicalCondition->Visible) { // MedicalCondition ?>
			<td <?php echo $staff->MedicalCondition->cellAttributes() ?>>
<span id="el_staff_MedicalCondition">
<span<?php echo $staff->MedicalCondition->viewAttributes() ?>><?php echo $staff->MedicalCondition->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->OtherMedicalConditions->Visible) { // OtherMedicalConditions ?>
			<td <?php echo $staff->OtherMedicalConditions->cellAttributes() ?>>
<span id="el_staff_OtherMedicalConditions">
<span<?php echo $staff->OtherMedicalConditions->viewAttributes() ?>><?php echo $staff->OtherMedicalConditions->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->PhysicalChallenge->Visible) { // PhysicalChallenge ?>
			<td <?php echo $staff->PhysicalChallenge->cellAttributes() ?>>
<span id="el_staff_PhysicalChallenge">
<span<?php echo $staff->PhysicalChallenge->viewAttributes() ?>><?php echo $staff->PhysicalChallenge->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->PostalAddress->Visible) { // PostalAddress ?>
			<td <?php echo $staff->PostalAddress->cellAttributes() ?>>
<span id="el_staff_PostalAddress">
<span<?php echo $staff->PostalAddress->viewAttributes() ?>><?php echo $staff->PostalAddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->PhysicalAddress->Visible) { // PhysicalAddress ?>
			<td <?php echo $staff->PhysicalAddress->cellAttributes() ?>>
<span id="el_staff_PhysicalAddress">
<span<?php echo $staff->PhysicalAddress->viewAttributes() ?>><?php echo $staff->PhysicalAddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->TownOrVillage->Visible) { // TownOrVillage ?>
			<td <?php echo $staff->TownOrVillage->cellAttributes() ?>>
<span id="el_staff_TownOrVillage">
<span<?php echo $staff->TownOrVillage->viewAttributes() ?>><?php echo $staff->TownOrVillage->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->Telephone->Visible) { // Telephone ?>
			<td <?php echo $staff->Telephone->cellAttributes() ?>>
<span id="el_staff_Telephone">
<span<?php echo $staff->Telephone->viewAttributes() ?>><?php echo $staff->Telephone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->Mobile->Visible) { // Mobile ?>
			<td <?php echo $staff->Mobile->cellAttributes() ?>>
<span id="el_staff_Mobile">
<span<?php echo $staff->Mobile->viewAttributes() ?>><?php echo $staff->Mobile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->Fax->Visible) { // Fax ?>
			<td <?php echo $staff->Fax->cellAttributes() ?>>
<span id="el_staff_Fax">
<span<?php echo $staff->Fax->viewAttributes() ?>><?php echo $staff->Fax->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->_Email->Visible) { // Email ?>
			<td <?php echo $staff->_Email->cellAttributes() ?>>
<span id="el_staff__Email">
<span<?php echo $staff->_Email->viewAttributes() ?>><?php echo $staff->_Email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->NumberOfBiologicalChildren->Visible) { // NumberOfBiologicalChildren ?>
			<td <?php echo $staff->NumberOfBiologicalChildren->cellAttributes() ?>>
<span id="el_staff_NumberOfBiologicalChildren">
<span<?php echo $staff->NumberOfBiologicalChildren->viewAttributes() ?>><?php echo $staff->NumberOfBiologicalChildren->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->NumberOfDependants->Visible) { // NumberOfDependants ?>
			<td <?php echo $staff->NumberOfDependants->cellAttributes() ?>>
<span id="el_staff_NumberOfDependants">
<span<?php echo $staff->NumberOfDependants->viewAttributes() ?>><?php echo $staff->NumberOfDependants->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->NextOfKin->Visible) { // NextOfKin ?>
			<td <?php echo $staff->NextOfKin->cellAttributes() ?>>
<span id="el_staff_NextOfKin">
<span<?php echo $staff->NextOfKin->viewAttributes() ?>><?php echo $staff->NextOfKin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->RelationshipCode->Visible) { // RelationshipCode ?>
			<td <?php echo $staff->RelationshipCode->cellAttributes() ?>>
<span id="el_staff_RelationshipCode">
<span<?php echo $staff->RelationshipCode->viewAttributes() ?>><?php echo $staff->RelationshipCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
			<td <?php echo $staff->NextOfKinMobile->cellAttributes() ?>>
<span id="el_staff_NextOfKinMobile">
<span<?php echo $staff->NextOfKinMobile->viewAttributes() ?>><?php echo $staff->NextOfKinMobile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
			<td <?php echo $staff->NextOfKinEmail->cellAttributes() ?>>
<span id="el_staff_NextOfKinEmail">
<span<?php echo $staff->NextOfKinEmail->viewAttributes() ?>><?php echo $staff->NextOfKinEmail->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->SpouseName->Visible) { // SpouseName ?>
			<td <?php echo $staff->SpouseName->cellAttributes() ?>>
<span id="el_staff_SpouseName">
<span<?php echo $staff->SpouseName->viewAttributes() ?>><?php echo $staff->SpouseName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->SpouseNRC->Visible) { // SpouseNRC ?>
			<td <?php echo $staff->SpouseNRC->cellAttributes() ?>>
<span id="el_staff_SpouseNRC">
<span<?php echo $staff->SpouseNRC->viewAttributes() ?>><?php echo $staff->SpouseNRC->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->SpouseMobile->Visible) { // SpouseMobile ?>
			<td <?php echo $staff->SpouseMobile->cellAttributes() ?>>
<span id="el_staff_SpouseMobile">
<span<?php echo $staff->SpouseMobile->viewAttributes() ?>><?php echo $staff->SpouseMobile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->SpouseEmail->Visible) { // SpouseEmail ?>
			<td <?php echo $staff->SpouseEmail->cellAttributes() ?>>
<span id="el_staff_SpouseEmail">
<span<?php echo $staff->SpouseEmail->viewAttributes() ?>><?php echo $staff->SpouseEmail->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->SpouseResidentialAddress->Visible) { // SpouseResidentialAddress ?>
			<td <?php echo $staff->SpouseResidentialAddress->cellAttributes() ?>>
<span id="el_staff_SpouseResidentialAddress">
<span<?php echo $staff->SpouseResidentialAddress->viewAttributes() ?>><?php echo $staff->SpouseResidentialAddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->BankAccountNo->Visible) { // BankAccountNo ?>
			<td <?php echo $staff->BankAccountNo->cellAttributes() ?>>
<span id="el_staff_BankAccountNo">
<span<?php echo $staff->BankAccountNo->viewAttributes() ?>><?php echo $staff->BankAccountNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->PaymentMethod->Visible) { // PaymentMethod ?>
			<td <?php echo $staff->PaymentMethod->cellAttributes() ?>>
<span id="el_staff_PaymentMethod">
<span<?php echo $staff->PaymentMethod->viewAttributes() ?>><?php echo $staff->PaymentMethod->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->BankBranchCode->Visible) { // BankBranchCode ?>
			<td <?php echo $staff->BankBranchCode->cellAttributes() ?>>
<span id="el_staff_BankBranchCode">
<span<?php echo $staff->BankBranchCode->viewAttributes() ?>><?php echo $staff->BankBranchCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->TaxNumber->Visible) { // TaxNumber ?>
			<td <?php echo $staff->TaxNumber->cellAttributes() ?>>
<span id="el_staff_TaxNumber">
<span<?php echo $staff->TaxNumber->viewAttributes() ?>><?php echo $staff->TaxNumber->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->PensionNumber->Visible) { // PensionNumber ?>
			<td <?php echo $staff->PensionNumber->cellAttributes() ?>>
<span id="el_staff_PensionNumber">
<span<?php echo $staff->PensionNumber->viewAttributes() ?>><?php echo $staff->PensionNumber->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
			<td <?php echo $staff->SocialSecurityNo->cellAttributes() ?>>
<span id="el_staff_SocialSecurityNo">
<span<?php echo $staff->SocialSecurityNo->viewAttributes() ?>><?php echo $staff->SocialSecurityNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff->ThirdParties->Visible) { // ThirdParties ?>
			<td <?php echo $staff->ThirdParties->cellAttributes() ?>>
<span id="el_staff_ThirdParties">
<span<?php echo $staff->ThirdParties->viewAttributes() ?>><?php echo $staff->ThirdParties->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>