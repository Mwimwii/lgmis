<?php
namespace PHPMaker2020\lgmis20;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$staff_delete = new staff_delete();

// Run the page
$staff_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staff_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fstaffdelete = currentForm = new ew.Form("fstaffdelete", "delete");
	loadjs.done("fstaffdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staff_delete->showPageHeader(); ?>
<?php
$staff_delete->showMessage();
?>
<form name="fstaffdelete" id="fstaffdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staff">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($staff_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($staff_delete->EmployeeID->Visible) { // EmployeeID ?>
		<th class="<?php echo $staff_delete->EmployeeID->headerCellClass() ?>"><span id="elh_staff_EmployeeID" class="staff_EmployeeID"><?php echo $staff_delete->EmployeeID->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $staff_delete->LACode->headerCellClass() ?>"><span id="elh_staff_LACode" class="staff_LACode"><?php echo $staff_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->FormerFileNumber->Visible) { // FormerFileNumber ?>
		<th class="<?php echo $staff_delete->FormerFileNumber->headerCellClass() ?>"><span id="elh_staff_FormerFileNumber" class="staff_FormerFileNumber"><?php echo $staff_delete->FormerFileNumber->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->NRC->Visible) { // NRC ?>
		<th class="<?php echo $staff_delete->NRC->headerCellClass() ?>"><span id="elh_staff_NRC" class="staff_NRC"><?php echo $staff_delete->NRC->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->Title->Visible) { // Title ?>
		<th class="<?php echo $staff_delete->Title->headerCellClass() ?>"><span id="elh_staff_Title" class="staff_Title"><?php echo $staff_delete->Title->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->Surname->Visible) { // Surname ?>
		<th class="<?php echo $staff_delete->Surname->headerCellClass() ?>"><span id="elh_staff_Surname" class="staff_Surname"><?php echo $staff_delete->Surname->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->FirstName->Visible) { // FirstName ?>
		<th class="<?php echo $staff_delete->FirstName->headerCellClass() ?>"><span id="elh_staff_FirstName" class="staff_FirstName"><?php echo $staff_delete->FirstName->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->MiddleName->Visible) { // MiddleName ?>
		<th class="<?php echo $staff_delete->MiddleName->headerCellClass() ?>"><span id="elh_staff_MiddleName" class="staff_MiddleName"><?php echo $staff_delete->MiddleName->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->Sex->Visible) { // Sex ?>
		<th class="<?php echo $staff_delete->Sex->headerCellClass() ?>"><span id="elh_staff_Sex" class="staff_Sex"><?php echo $staff_delete->Sex->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->MaritalStatus->Visible) { // MaritalStatus ?>
		<th class="<?php echo $staff_delete->MaritalStatus->headerCellClass() ?>"><span id="elh_staff_MaritalStatus" class="staff_MaritalStatus"><?php echo $staff_delete->MaritalStatus->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->MaidenName->Visible) { // MaidenName ?>
		<th class="<?php echo $staff_delete->MaidenName->headerCellClass() ?>"><span id="elh_staff_MaidenName" class="staff_MaidenName"><?php echo $staff_delete->MaidenName->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->DateOfBirth->Visible) { // DateOfBirth ?>
		<th class="<?php echo $staff_delete->DateOfBirth->headerCellClass() ?>"><span id="elh_staff_DateOfBirth" class="staff_DateOfBirth"><?php echo $staff_delete->DateOfBirth->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->AcademicQualification->Visible) { // AcademicQualification ?>
		<th class="<?php echo $staff_delete->AcademicQualification->headerCellClass() ?>"><span id="elh_staff_AcademicQualification" class="staff_AcademicQualification"><?php echo $staff_delete->AcademicQualification->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->ProfessionalQualification->Visible) { // ProfessionalQualification ?>
		<th class="<?php echo $staff_delete->ProfessionalQualification->headerCellClass() ?>"><span id="elh_staff_ProfessionalQualification" class="staff_ProfessionalQualification"><?php echo $staff_delete->ProfessionalQualification->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->MedicalCondition->Visible) { // MedicalCondition ?>
		<th class="<?php echo $staff_delete->MedicalCondition->headerCellClass() ?>"><span id="elh_staff_MedicalCondition" class="staff_MedicalCondition"><?php echo $staff_delete->MedicalCondition->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->OtherMedicalConditions->Visible) { // OtherMedicalConditions ?>
		<th class="<?php echo $staff_delete->OtherMedicalConditions->headerCellClass() ?>"><span id="elh_staff_OtherMedicalConditions" class="staff_OtherMedicalConditions"><?php echo $staff_delete->OtherMedicalConditions->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->PhysicalChallenge->Visible) { // PhysicalChallenge ?>
		<th class="<?php echo $staff_delete->PhysicalChallenge->headerCellClass() ?>"><span id="elh_staff_PhysicalChallenge" class="staff_PhysicalChallenge"><?php echo $staff_delete->PhysicalChallenge->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->PostalAddress->Visible) { // PostalAddress ?>
		<th class="<?php echo $staff_delete->PostalAddress->headerCellClass() ?>"><span id="elh_staff_PostalAddress" class="staff_PostalAddress"><?php echo $staff_delete->PostalAddress->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->PhysicalAddress->Visible) { // PhysicalAddress ?>
		<th class="<?php echo $staff_delete->PhysicalAddress->headerCellClass() ?>"><span id="elh_staff_PhysicalAddress" class="staff_PhysicalAddress"><?php echo $staff_delete->PhysicalAddress->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->TownOrVillage->Visible) { // TownOrVillage ?>
		<th class="<?php echo $staff_delete->TownOrVillage->headerCellClass() ?>"><span id="elh_staff_TownOrVillage" class="staff_TownOrVillage"><?php echo $staff_delete->TownOrVillage->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->Telephone->Visible) { // Telephone ?>
		<th class="<?php echo $staff_delete->Telephone->headerCellClass() ?>"><span id="elh_staff_Telephone" class="staff_Telephone"><?php echo $staff_delete->Telephone->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->Mobile->Visible) { // Mobile ?>
		<th class="<?php echo $staff_delete->Mobile->headerCellClass() ?>"><span id="elh_staff_Mobile" class="staff_Mobile"><?php echo $staff_delete->Mobile->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->Fax->Visible) { // Fax ?>
		<th class="<?php echo $staff_delete->Fax->headerCellClass() ?>"><span id="elh_staff_Fax" class="staff_Fax"><?php echo $staff_delete->Fax->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->_Email->Visible) { // Email ?>
		<th class="<?php echo $staff_delete->_Email->headerCellClass() ?>"><span id="elh_staff__Email" class="staff__Email"><?php echo $staff_delete->_Email->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->NumberOfBiologicalChildren->Visible) { // NumberOfBiologicalChildren ?>
		<th class="<?php echo $staff_delete->NumberOfBiologicalChildren->headerCellClass() ?>"><span id="elh_staff_NumberOfBiologicalChildren" class="staff_NumberOfBiologicalChildren"><?php echo $staff_delete->NumberOfBiologicalChildren->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->NumberOfDependants->Visible) { // NumberOfDependants ?>
		<th class="<?php echo $staff_delete->NumberOfDependants->headerCellClass() ?>"><span id="elh_staff_NumberOfDependants" class="staff_NumberOfDependants"><?php echo $staff_delete->NumberOfDependants->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->NextOfKin->Visible) { // NextOfKin ?>
		<th class="<?php echo $staff_delete->NextOfKin->headerCellClass() ?>"><span id="elh_staff_NextOfKin" class="staff_NextOfKin"><?php echo $staff_delete->NextOfKin->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->RelationshipCode->Visible) { // RelationshipCode ?>
		<th class="<?php echo $staff_delete->RelationshipCode->headerCellClass() ?>"><span id="elh_staff_RelationshipCode" class="staff_RelationshipCode"><?php echo $staff_delete->RelationshipCode->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
		<th class="<?php echo $staff_delete->NextOfKinMobile->headerCellClass() ?>"><span id="elh_staff_NextOfKinMobile" class="staff_NextOfKinMobile"><?php echo $staff_delete->NextOfKinMobile->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
		<th class="<?php echo $staff_delete->NextOfKinEmail->headerCellClass() ?>"><span id="elh_staff_NextOfKinEmail" class="staff_NextOfKinEmail"><?php echo $staff_delete->NextOfKinEmail->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->SpouseName->Visible) { // SpouseName ?>
		<th class="<?php echo $staff_delete->SpouseName->headerCellClass() ?>"><span id="elh_staff_SpouseName" class="staff_SpouseName"><?php echo $staff_delete->SpouseName->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->SpouseNRC->Visible) { // SpouseNRC ?>
		<th class="<?php echo $staff_delete->SpouseNRC->headerCellClass() ?>"><span id="elh_staff_SpouseNRC" class="staff_SpouseNRC"><?php echo $staff_delete->SpouseNRC->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->SpouseMobile->Visible) { // SpouseMobile ?>
		<th class="<?php echo $staff_delete->SpouseMobile->headerCellClass() ?>"><span id="elh_staff_SpouseMobile" class="staff_SpouseMobile"><?php echo $staff_delete->SpouseMobile->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->SpouseEmail->Visible) { // SpouseEmail ?>
		<th class="<?php echo $staff_delete->SpouseEmail->headerCellClass() ?>"><span id="elh_staff_SpouseEmail" class="staff_SpouseEmail"><?php echo $staff_delete->SpouseEmail->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->SpouseResidentialAddress->Visible) { // SpouseResidentialAddress ?>
		<th class="<?php echo $staff_delete->SpouseResidentialAddress->headerCellClass() ?>"><span id="elh_staff_SpouseResidentialAddress" class="staff_SpouseResidentialAddress"><?php echo $staff_delete->SpouseResidentialAddress->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->BankAccountNo->Visible) { // BankAccountNo ?>
		<th class="<?php echo $staff_delete->BankAccountNo->headerCellClass() ?>"><span id="elh_staff_BankAccountNo" class="staff_BankAccountNo"><?php echo $staff_delete->BankAccountNo->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->PaymentMethod->Visible) { // PaymentMethod ?>
		<th class="<?php echo $staff_delete->PaymentMethod->headerCellClass() ?>"><span id="elh_staff_PaymentMethod" class="staff_PaymentMethod"><?php echo $staff_delete->PaymentMethod->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->BankBranchCode->Visible) { // BankBranchCode ?>
		<th class="<?php echo $staff_delete->BankBranchCode->headerCellClass() ?>"><span id="elh_staff_BankBranchCode" class="staff_BankBranchCode"><?php echo $staff_delete->BankBranchCode->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->TaxNumber->Visible) { // TaxNumber ?>
		<th class="<?php echo $staff_delete->TaxNumber->headerCellClass() ?>"><span id="elh_staff_TaxNumber" class="staff_TaxNumber"><?php echo $staff_delete->TaxNumber->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->PensionNumber->Visible) { // PensionNumber ?>
		<th class="<?php echo $staff_delete->PensionNumber->headerCellClass() ?>"><span id="elh_staff_PensionNumber" class="staff_PensionNumber"><?php echo $staff_delete->PensionNumber->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
		<th class="<?php echo $staff_delete->SocialSecurityNo->headerCellClass() ?>"><span id="elh_staff_SocialSecurityNo" class="staff_SocialSecurityNo"><?php echo $staff_delete->SocialSecurityNo->caption() ?></span></th>
<?php } ?>
<?php if ($staff_delete->ThirdParties->Visible) { // ThirdParties ?>
		<th class="<?php echo $staff_delete->ThirdParties->headerCellClass() ?>"><span id="elh_staff_ThirdParties" class="staff_ThirdParties"><?php echo $staff_delete->ThirdParties->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$staff_delete->RecordCount = 0;
$i = 0;
while (!$staff_delete->Recordset->EOF) {
	$staff_delete->RecordCount++;
	$staff_delete->RowCount++;

	// Set row properties
	$staff->resetAttributes();
	$staff->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$staff_delete->loadRowValues($staff_delete->Recordset);

	// Render row
	$staff_delete->renderRow();
?>
	<tr <?php echo $staff->rowAttributes() ?>>
<?php if ($staff_delete->EmployeeID->Visible) { // EmployeeID ?>
		<td <?php echo $staff_delete->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_EmployeeID" class="staff_EmployeeID">
<span<?php echo $staff_delete->EmployeeID->viewAttributes() ?>><?php echo $staff_delete->EmployeeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $staff_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_LACode" class="staff_LACode">
<span<?php echo $staff_delete->LACode->viewAttributes() ?>><?php echo $staff_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->FormerFileNumber->Visible) { // FormerFileNumber ?>
		<td <?php echo $staff_delete->FormerFileNumber->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_FormerFileNumber" class="staff_FormerFileNumber">
<span<?php echo $staff_delete->FormerFileNumber->viewAttributes() ?>><?php echo $staff_delete->FormerFileNumber->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->NRC->Visible) { // NRC ?>
		<td <?php echo $staff_delete->NRC->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_NRC" class="staff_NRC">
<span<?php echo $staff_delete->NRC->viewAttributes() ?>><?php echo $staff_delete->NRC->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->Title->Visible) { // Title ?>
		<td <?php echo $staff_delete->Title->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_Title" class="staff_Title">
<span<?php echo $staff_delete->Title->viewAttributes() ?>><?php echo $staff_delete->Title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->Surname->Visible) { // Surname ?>
		<td <?php echo $staff_delete->Surname->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_Surname" class="staff_Surname">
<span<?php echo $staff_delete->Surname->viewAttributes() ?>><?php echo $staff_delete->Surname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->FirstName->Visible) { // FirstName ?>
		<td <?php echo $staff_delete->FirstName->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_FirstName" class="staff_FirstName">
<span<?php echo $staff_delete->FirstName->viewAttributes() ?>><?php echo $staff_delete->FirstName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->MiddleName->Visible) { // MiddleName ?>
		<td <?php echo $staff_delete->MiddleName->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_MiddleName" class="staff_MiddleName">
<span<?php echo $staff_delete->MiddleName->viewAttributes() ?>><?php echo $staff_delete->MiddleName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->Sex->Visible) { // Sex ?>
		<td <?php echo $staff_delete->Sex->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_Sex" class="staff_Sex">
<span<?php echo $staff_delete->Sex->viewAttributes() ?>><?php echo $staff_delete->Sex->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->MaritalStatus->Visible) { // MaritalStatus ?>
		<td <?php echo $staff_delete->MaritalStatus->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_MaritalStatus" class="staff_MaritalStatus">
<span<?php echo $staff_delete->MaritalStatus->viewAttributes() ?>><?php echo $staff_delete->MaritalStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->MaidenName->Visible) { // MaidenName ?>
		<td <?php echo $staff_delete->MaidenName->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_MaidenName" class="staff_MaidenName">
<span<?php echo $staff_delete->MaidenName->viewAttributes() ?>><?php echo $staff_delete->MaidenName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->DateOfBirth->Visible) { // DateOfBirth ?>
		<td <?php echo $staff_delete->DateOfBirth->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_DateOfBirth" class="staff_DateOfBirth">
<span<?php echo $staff_delete->DateOfBirth->viewAttributes() ?>><?php echo $staff_delete->DateOfBirth->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->AcademicQualification->Visible) { // AcademicQualification ?>
		<td <?php echo $staff_delete->AcademicQualification->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_AcademicQualification" class="staff_AcademicQualification">
<span<?php echo $staff_delete->AcademicQualification->viewAttributes() ?>><?php echo $staff_delete->AcademicQualification->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->ProfessionalQualification->Visible) { // ProfessionalQualification ?>
		<td <?php echo $staff_delete->ProfessionalQualification->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_ProfessionalQualification" class="staff_ProfessionalQualification">
<span<?php echo $staff_delete->ProfessionalQualification->viewAttributes() ?>><?php echo $staff_delete->ProfessionalQualification->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->MedicalCondition->Visible) { // MedicalCondition ?>
		<td <?php echo $staff_delete->MedicalCondition->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_MedicalCondition" class="staff_MedicalCondition">
<span<?php echo $staff_delete->MedicalCondition->viewAttributes() ?>><?php echo $staff_delete->MedicalCondition->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->OtherMedicalConditions->Visible) { // OtherMedicalConditions ?>
		<td <?php echo $staff_delete->OtherMedicalConditions->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_OtherMedicalConditions" class="staff_OtherMedicalConditions">
<span<?php echo $staff_delete->OtherMedicalConditions->viewAttributes() ?>><?php echo $staff_delete->OtherMedicalConditions->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->PhysicalChallenge->Visible) { // PhysicalChallenge ?>
		<td <?php echo $staff_delete->PhysicalChallenge->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_PhysicalChallenge" class="staff_PhysicalChallenge">
<span<?php echo $staff_delete->PhysicalChallenge->viewAttributes() ?>><?php echo $staff_delete->PhysicalChallenge->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->PostalAddress->Visible) { // PostalAddress ?>
		<td <?php echo $staff_delete->PostalAddress->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_PostalAddress" class="staff_PostalAddress">
<span<?php echo $staff_delete->PostalAddress->viewAttributes() ?>><?php echo $staff_delete->PostalAddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->PhysicalAddress->Visible) { // PhysicalAddress ?>
		<td <?php echo $staff_delete->PhysicalAddress->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_PhysicalAddress" class="staff_PhysicalAddress">
<span<?php echo $staff_delete->PhysicalAddress->viewAttributes() ?>><?php echo $staff_delete->PhysicalAddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->TownOrVillage->Visible) { // TownOrVillage ?>
		<td <?php echo $staff_delete->TownOrVillage->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_TownOrVillage" class="staff_TownOrVillage">
<span<?php echo $staff_delete->TownOrVillage->viewAttributes() ?>><?php echo $staff_delete->TownOrVillage->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->Telephone->Visible) { // Telephone ?>
		<td <?php echo $staff_delete->Telephone->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_Telephone" class="staff_Telephone">
<span<?php echo $staff_delete->Telephone->viewAttributes() ?>><?php echo $staff_delete->Telephone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->Mobile->Visible) { // Mobile ?>
		<td <?php echo $staff_delete->Mobile->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_Mobile" class="staff_Mobile">
<span<?php echo $staff_delete->Mobile->viewAttributes() ?>><?php echo $staff_delete->Mobile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->Fax->Visible) { // Fax ?>
		<td <?php echo $staff_delete->Fax->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_Fax" class="staff_Fax">
<span<?php echo $staff_delete->Fax->viewAttributes() ?>><?php echo $staff_delete->Fax->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->_Email->Visible) { // Email ?>
		<td <?php echo $staff_delete->_Email->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff__Email" class="staff__Email">
<span<?php echo $staff_delete->_Email->viewAttributes() ?>><?php echo $staff_delete->_Email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->NumberOfBiologicalChildren->Visible) { // NumberOfBiologicalChildren ?>
		<td <?php echo $staff_delete->NumberOfBiologicalChildren->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_NumberOfBiologicalChildren" class="staff_NumberOfBiologicalChildren">
<span<?php echo $staff_delete->NumberOfBiologicalChildren->viewAttributes() ?>><?php echo $staff_delete->NumberOfBiologicalChildren->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->NumberOfDependants->Visible) { // NumberOfDependants ?>
		<td <?php echo $staff_delete->NumberOfDependants->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_NumberOfDependants" class="staff_NumberOfDependants">
<span<?php echo $staff_delete->NumberOfDependants->viewAttributes() ?>><?php echo $staff_delete->NumberOfDependants->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->NextOfKin->Visible) { // NextOfKin ?>
		<td <?php echo $staff_delete->NextOfKin->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_NextOfKin" class="staff_NextOfKin">
<span<?php echo $staff_delete->NextOfKin->viewAttributes() ?>><?php echo $staff_delete->NextOfKin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->RelationshipCode->Visible) { // RelationshipCode ?>
		<td <?php echo $staff_delete->RelationshipCode->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_RelationshipCode" class="staff_RelationshipCode">
<span<?php echo $staff_delete->RelationshipCode->viewAttributes() ?>><?php echo $staff_delete->RelationshipCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
		<td <?php echo $staff_delete->NextOfKinMobile->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_NextOfKinMobile" class="staff_NextOfKinMobile">
<span<?php echo $staff_delete->NextOfKinMobile->viewAttributes() ?>><?php echo $staff_delete->NextOfKinMobile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
		<td <?php echo $staff_delete->NextOfKinEmail->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_NextOfKinEmail" class="staff_NextOfKinEmail">
<span<?php echo $staff_delete->NextOfKinEmail->viewAttributes() ?>><?php echo $staff_delete->NextOfKinEmail->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->SpouseName->Visible) { // SpouseName ?>
		<td <?php echo $staff_delete->SpouseName->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_SpouseName" class="staff_SpouseName">
<span<?php echo $staff_delete->SpouseName->viewAttributes() ?>><?php echo $staff_delete->SpouseName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->SpouseNRC->Visible) { // SpouseNRC ?>
		<td <?php echo $staff_delete->SpouseNRC->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_SpouseNRC" class="staff_SpouseNRC">
<span<?php echo $staff_delete->SpouseNRC->viewAttributes() ?>><?php echo $staff_delete->SpouseNRC->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->SpouseMobile->Visible) { // SpouseMobile ?>
		<td <?php echo $staff_delete->SpouseMobile->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_SpouseMobile" class="staff_SpouseMobile">
<span<?php echo $staff_delete->SpouseMobile->viewAttributes() ?>><?php echo $staff_delete->SpouseMobile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->SpouseEmail->Visible) { // SpouseEmail ?>
		<td <?php echo $staff_delete->SpouseEmail->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_SpouseEmail" class="staff_SpouseEmail">
<span<?php echo $staff_delete->SpouseEmail->viewAttributes() ?>><?php echo $staff_delete->SpouseEmail->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->SpouseResidentialAddress->Visible) { // SpouseResidentialAddress ?>
		<td <?php echo $staff_delete->SpouseResidentialAddress->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_SpouseResidentialAddress" class="staff_SpouseResidentialAddress">
<span<?php echo $staff_delete->SpouseResidentialAddress->viewAttributes() ?>><?php echo $staff_delete->SpouseResidentialAddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->BankAccountNo->Visible) { // BankAccountNo ?>
		<td <?php echo $staff_delete->BankAccountNo->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_BankAccountNo" class="staff_BankAccountNo">
<span<?php echo $staff_delete->BankAccountNo->viewAttributes() ?>><?php echo $staff_delete->BankAccountNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->PaymentMethod->Visible) { // PaymentMethod ?>
		<td <?php echo $staff_delete->PaymentMethod->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_PaymentMethod" class="staff_PaymentMethod">
<span<?php echo $staff_delete->PaymentMethod->viewAttributes() ?>><?php echo $staff_delete->PaymentMethod->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->BankBranchCode->Visible) { // BankBranchCode ?>
		<td <?php echo $staff_delete->BankBranchCode->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_BankBranchCode" class="staff_BankBranchCode">
<span<?php echo $staff_delete->BankBranchCode->viewAttributes() ?>><?php echo $staff_delete->BankBranchCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->TaxNumber->Visible) { // TaxNumber ?>
		<td <?php echo $staff_delete->TaxNumber->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_TaxNumber" class="staff_TaxNumber">
<span<?php echo $staff_delete->TaxNumber->viewAttributes() ?>><?php echo $staff_delete->TaxNumber->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->PensionNumber->Visible) { // PensionNumber ?>
		<td <?php echo $staff_delete->PensionNumber->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_PensionNumber" class="staff_PensionNumber">
<span<?php echo $staff_delete->PensionNumber->viewAttributes() ?>><?php echo $staff_delete->PensionNumber->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
		<td <?php echo $staff_delete->SocialSecurityNo->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_SocialSecurityNo" class="staff_SocialSecurityNo">
<span<?php echo $staff_delete->SocialSecurityNo->viewAttributes() ?>><?php echo $staff_delete->SocialSecurityNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staff_delete->ThirdParties->Visible) { // ThirdParties ?>
		<td <?php echo $staff_delete->ThirdParties->cellAttributes() ?>>
<span id="el<?php echo $staff_delete->RowCount ?>_staff_ThirdParties" class="staff_ThirdParties">
<span<?php echo $staff_delete->ThirdParties->viewAttributes() ?>><?php echo $staff_delete->ThirdParties->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$staff_delete->Recordset->moveNext();
}
$staff_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staff_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$staff_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$staff_delete->terminate();
?>