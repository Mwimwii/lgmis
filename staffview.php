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
$staff_view = new staff_view();

// Run the page
$staff_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staff_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$staff_view->isExport()) { ?>
<script>
var fstaffview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fstaffview = currentForm = new ew.Form("fstaffview", "view");
	loadjs.done("fstaffview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$staff_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $staff_view->ExportOptions->render("body") ?>
<?php $staff_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $staff_view->showPageHeader(); ?>
<?php
$staff_view->showMessage();
?>
<?php if (!$staff_view->IsModal) { ?>
<?php if (!$staff_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staff_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fstaffview" id="fstaffview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staff">
<input type="hidden" name="modal" value="<?php echo (int)$staff_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($staff_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_EmployeeID"><?php echo $staff_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $staff_view->EmployeeID->cellAttributes() ?>>
<span id="el_staff_EmployeeID">
<span<?php echo $staff_view->EmployeeID->viewAttributes() ?>><?php echo $staff_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_LACode"><?php echo $staff_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $staff_view->LACode->cellAttributes() ?>>
<span id="el_staff_LACode">
<span<?php echo $staff_view->LACode->viewAttributes() ?>><?php echo $staff_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->FormerFileNumber->Visible) { // FormerFileNumber ?>
	<tr id="r_FormerFileNumber">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_FormerFileNumber"><?php echo $staff_view->FormerFileNumber->caption() ?></span></td>
		<td data-name="FormerFileNumber" <?php echo $staff_view->FormerFileNumber->cellAttributes() ?>>
<span id="el_staff_FormerFileNumber">
<span<?php echo $staff_view->FormerFileNumber->viewAttributes() ?>><?php echo $staff_view->FormerFileNumber->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->NRC->Visible) { // NRC ?>
	<tr id="r_NRC">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_NRC"><?php echo $staff_view->NRC->caption() ?></span></td>
		<td data-name="NRC" <?php echo $staff_view->NRC->cellAttributes() ?>>
<span id="el_staff_NRC">
<span<?php echo $staff_view->NRC->viewAttributes() ?>><?php echo $staff_view->NRC->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->Title->Visible) { // Title ?>
	<tr id="r_Title">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_Title"><?php echo $staff_view->Title->caption() ?></span></td>
		<td data-name="Title" <?php echo $staff_view->Title->cellAttributes() ?>>
<span id="el_staff_Title">
<span<?php echo $staff_view->Title->viewAttributes() ?>><?php echo $staff_view->Title->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->Surname->Visible) { // Surname ?>
	<tr id="r_Surname">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_Surname"><?php echo $staff_view->Surname->caption() ?></span></td>
		<td data-name="Surname" <?php echo $staff_view->Surname->cellAttributes() ?>>
<span id="el_staff_Surname">
<span<?php echo $staff_view->Surname->viewAttributes() ?>><?php echo $staff_view->Surname->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->FirstName->Visible) { // FirstName ?>
	<tr id="r_FirstName">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_FirstName"><?php echo $staff_view->FirstName->caption() ?></span></td>
		<td data-name="FirstName" <?php echo $staff_view->FirstName->cellAttributes() ?>>
<span id="el_staff_FirstName">
<span<?php echo $staff_view->FirstName->viewAttributes() ?>><?php echo $staff_view->FirstName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->MiddleName->Visible) { // MiddleName ?>
	<tr id="r_MiddleName">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_MiddleName"><?php echo $staff_view->MiddleName->caption() ?></span></td>
		<td data-name="MiddleName" <?php echo $staff_view->MiddleName->cellAttributes() ?>>
<span id="el_staff_MiddleName">
<span<?php echo $staff_view->MiddleName->viewAttributes() ?>><?php echo $staff_view->MiddleName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->Sex->Visible) { // Sex ?>
	<tr id="r_Sex">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_Sex"><?php echo $staff_view->Sex->caption() ?></span></td>
		<td data-name="Sex" <?php echo $staff_view->Sex->cellAttributes() ?>>
<span id="el_staff_Sex">
<span<?php echo $staff_view->Sex->viewAttributes() ?>><?php echo $staff_view->Sex->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->StaffPhoto->Visible) { // StaffPhoto ?>
	<tr id="r_StaffPhoto">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_StaffPhoto"><?php echo $staff_view->StaffPhoto->caption() ?></span></td>
		<td data-name="StaffPhoto" <?php echo $staff_view->StaffPhoto->cellAttributes() ?>>
<span id="el_staff_StaffPhoto">
<span<?php echo $staff_view->StaffPhoto->viewAttributes() ?>><?php echo GetFileViewTag($staff_view->StaffPhoto, $staff_view->StaffPhoto->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->MaritalStatus->Visible) { // MaritalStatus ?>
	<tr id="r_MaritalStatus">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_MaritalStatus"><?php echo $staff_view->MaritalStatus->caption() ?></span></td>
		<td data-name="MaritalStatus" <?php echo $staff_view->MaritalStatus->cellAttributes() ?>>
<span id="el_staff_MaritalStatus">
<span<?php echo $staff_view->MaritalStatus->viewAttributes() ?>><?php echo $staff_view->MaritalStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->MaidenName->Visible) { // MaidenName ?>
	<tr id="r_MaidenName">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_MaidenName"><?php echo $staff_view->MaidenName->caption() ?></span></td>
		<td data-name="MaidenName" <?php echo $staff_view->MaidenName->cellAttributes() ?>>
<span id="el_staff_MaidenName">
<span<?php echo $staff_view->MaidenName->viewAttributes() ?>><?php echo $staff_view->MaidenName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->DateOfBirth->Visible) { // DateOfBirth ?>
	<tr id="r_DateOfBirth">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_DateOfBirth"><?php echo $staff_view->DateOfBirth->caption() ?></span></td>
		<td data-name="DateOfBirth" <?php echo $staff_view->DateOfBirth->cellAttributes() ?>>
<span id="el_staff_DateOfBirth">
<span<?php echo $staff_view->DateOfBirth->viewAttributes() ?>><?php echo $staff_view->DateOfBirth->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->AcademicQualification->Visible) { // AcademicQualification ?>
	<tr id="r_AcademicQualification">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_AcademicQualification"><?php echo $staff_view->AcademicQualification->caption() ?></span></td>
		<td data-name="AcademicQualification" <?php echo $staff_view->AcademicQualification->cellAttributes() ?>>
<span id="el_staff_AcademicQualification">
<span<?php echo $staff_view->AcademicQualification->viewAttributes() ?>><?php echo $staff_view->AcademicQualification->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->ProfessionalQualification->Visible) { // ProfessionalQualification ?>
	<tr id="r_ProfessionalQualification">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_ProfessionalQualification"><?php echo $staff_view->ProfessionalQualification->caption() ?></span></td>
		<td data-name="ProfessionalQualification" <?php echo $staff_view->ProfessionalQualification->cellAttributes() ?>>
<span id="el_staff_ProfessionalQualification">
<span<?php echo $staff_view->ProfessionalQualification->viewAttributes() ?>><?php echo $staff_view->ProfessionalQualification->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->MedicalCondition->Visible) { // MedicalCondition ?>
	<tr id="r_MedicalCondition">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_MedicalCondition"><?php echo $staff_view->MedicalCondition->caption() ?></span></td>
		<td data-name="MedicalCondition" <?php echo $staff_view->MedicalCondition->cellAttributes() ?>>
<span id="el_staff_MedicalCondition">
<span<?php echo $staff_view->MedicalCondition->viewAttributes() ?>><?php echo $staff_view->MedicalCondition->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->OtherMedicalConditions->Visible) { // OtherMedicalConditions ?>
	<tr id="r_OtherMedicalConditions">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_OtherMedicalConditions"><?php echo $staff_view->OtherMedicalConditions->caption() ?></span></td>
		<td data-name="OtherMedicalConditions" <?php echo $staff_view->OtherMedicalConditions->cellAttributes() ?>>
<span id="el_staff_OtherMedicalConditions">
<span<?php echo $staff_view->OtherMedicalConditions->viewAttributes() ?>><?php echo $staff_view->OtherMedicalConditions->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->PhysicalChallenge->Visible) { // PhysicalChallenge ?>
	<tr id="r_PhysicalChallenge">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_PhysicalChallenge"><?php echo $staff_view->PhysicalChallenge->caption() ?></span></td>
		<td data-name="PhysicalChallenge" <?php echo $staff_view->PhysicalChallenge->cellAttributes() ?>>
<span id="el_staff_PhysicalChallenge">
<span<?php echo $staff_view->PhysicalChallenge->viewAttributes() ?>><?php echo $staff_view->PhysicalChallenge->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->PostalAddress->Visible) { // PostalAddress ?>
	<tr id="r_PostalAddress">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_PostalAddress"><?php echo $staff_view->PostalAddress->caption() ?></span></td>
		<td data-name="PostalAddress" <?php echo $staff_view->PostalAddress->cellAttributes() ?>>
<span id="el_staff_PostalAddress">
<span<?php echo $staff_view->PostalAddress->viewAttributes() ?>><?php echo $staff_view->PostalAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->PhysicalAddress->Visible) { // PhysicalAddress ?>
	<tr id="r_PhysicalAddress">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_PhysicalAddress"><?php echo $staff_view->PhysicalAddress->caption() ?></span></td>
		<td data-name="PhysicalAddress" <?php echo $staff_view->PhysicalAddress->cellAttributes() ?>>
<span id="el_staff_PhysicalAddress">
<span<?php echo $staff_view->PhysicalAddress->viewAttributes() ?>><?php echo $staff_view->PhysicalAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->TownOrVillage->Visible) { // TownOrVillage ?>
	<tr id="r_TownOrVillage">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_TownOrVillage"><?php echo $staff_view->TownOrVillage->caption() ?></span></td>
		<td data-name="TownOrVillage" <?php echo $staff_view->TownOrVillage->cellAttributes() ?>>
<span id="el_staff_TownOrVillage">
<span<?php echo $staff_view->TownOrVillage->viewAttributes() ?>><?php echo $staff_view->TownOrVillage->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->Telephone->Visible) { // Telephone ?>
	<tr id="r_Telephone">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_Telephone"><?php echo $staff_view->Telephone->caption() ?></span></td>
		<td data-name="Telephone" <?php echo $staff_view->Telephone->cellAttributes() ?>>
<span id="el_staff_Telephone">
<span<?php echo $staff_view->Telephone->viewAttributes() ?>><?php echo $staff_view->Telephone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->Mobile->Visible) { // Mobile ?>
	<tr id="r_Mobile">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_Mobile"><?php echo $staff_view->Mobile->caption() ?></span></td>
		<td data-name="Mobile" <?php echo $staff_view->Mobile->cellAttributes() ?>>
<span id="el_staff_Mobile">
<span<?php echo $staff_view->Mobile->viewAttributes() ?>><?php echo $staff_view->Mobile->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->Fax->Visible) { // Fax ?>
	<tr id="r_Fax">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_Fax"><?php echo $staff_view->Fax->caption() ?></span></td>
		<td data-name="Fax" <?php echo $staff_view->Fax->cellAttributes() ?>>
<span id="el_staff_Fax">
<span<?php echo $staff_view->Fax->viewAttributes() ?>><?php echo $staff_view->Fax->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->_Email->Visible) { // Email ?>
	<tr id="r__Email">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff__Email"><?php echo $staff_view->_Email->caption() ?></span></td>
		<td data-name="_Email" <?php echo $staff_view->_Email->cellAttributes() ?>>
<span id="el_staff__Email">
<span<?php echo $staff_view->_Email->viewAttributes() ?>><?php echo $staff_view->_Email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->NumberOfBiologicalChildren->Visible) { // NumberOfBiologicalChildren ?>
	<tr id="r_NumberOfBiologicalChildren">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_NumberOfBiologicalChildren"><?php echo $staff_view->NumberOfBiologicalChildren->caption() ?></span></td>
		<td data-name="NumberOfBiologicalChildren" <?php echo $staff_view->NumberOfBiologicalChildren->cellAttributes() ?>>
<span id="el_staff_NumberOfBiologicalChildren">
<span<?php echo $staff_view->NumberOfBiologicalChildren->viewAttributes() ?>><?php echo $staff_view->NumberOfBiologicalChildren->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->NumberOfDependants->Visible) { // NumberOfDependants ?>
	<tr id="r_NumberOfDependants">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_NumberOfDependants"><?php echo $staff_view->NumberOfDependants->caption() ?></span></td>
		<td data-name="NumberOfDependants" <?php echo $staff_view->NumberOfDependants->cellAttributes() ?>>
<span id="el_staff_NumberOfDependants">
<span<?php echo $staff_view->NumberOfDependants->viewAttributes() ?>><?php echo $staff_view->NumberOfDependants->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->NextOfKin->Visible) { // NextOfKin ?>
	<tr id="r_NextOfKin">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_NextOfKin"><?php echo $staff_view->NextOfKin->caption() ?></span></td>
		<td data-name="NextOfKin" <?php echo $staff_view->NextOfKin->cellAttributes() ?>>
<span id="el_staff_NextOfKin">
<span<?php echo $staff_view->NextOfKin->viewAttributes() ?>><?php echo $staff_view->NextOfKin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->RelationshipCode->Visible) { // RelationshipCode ?>
	<tr id="r_RelationshipCode">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_RelationshipCode"><?php echo $staff_view->RelationshipCode->caption() ?></span></td>
		<td data-name="RelationshipCode" <?php echo $staff_view->RelationshipCode->cellAttributes() ?>>
<span id="el_staff_RelationshipCode">
<span<?php echo $staff_view->RelationshipCode->viewAttributes() ?>><?php echo $staff_view->RelationshipCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
	<tr id="r_NextOfKinMobile">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_NextOfKinMobile"><?php echo $staff_view->NextOfKinMobile->caption() ?></span></td>
		<td data-name="NextOfKinMobile" <?php echo $staff_view->NextOfKinMobile->cellAttributes() ?>>
<span id="el_staff_NextOfKinMobile">
<span<?php echo $staff_view->NextOfKinMobile->viewAttributes() ?>><?php echo $staff_view->NextOfKinMobile->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
	<tr id="r_NextOfKinEmail">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_NextOfKinEmail"><?php echo $staff_view->NextOfKinEmail->caption() ?></span></td>
		<td data-name="NextOfKinEmail" <?php echo $staff_view->NextOfKinEmail->cellAttributes() ?>>
<span id="el_staff_NextOfKinEmail">
<span<?php echo $staff_view->NextOfKinEmail->viewAttributes() ?>><?php echo $staff_view->NextOfKinEmail->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->SpouseName->Visible) { // SpouseName ?>
	<tr id="r_SpouseName">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_SpouseName"><?php echo $staff_view->SpouseName->caption() ?></span></td>
		<td data-name="SpouseName" <?php echo $staff_view->SpouseName->cellAttributes() ?>>
<span id="el_staff_SpouseName">
<span<?php echo $staff_view->SpouseName->viewAttributes() ?>><?php echo $staff_view->SpouseName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->SpouseNRC->Visible) { // SpouseNRC ?>
	<tr id="r_SpouseNRC">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_SpouseNRC"><?php echo $staff_view->SpouseNRC->caption() ?></span></td>
		<td data-name="SpouseNRC" <?php echo $staff_view->SpouseNRC->cellAttributes() ?>>
<span id="el_staff_SpouseNRC">
<span<?php echo $staff_view->SpouseNRC->viewAttributes() ?>><?php echo $staff_view->SpouseNRC->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->SpouseMobile->Visible) { // SpouseMobile ?>
	<tr id="r_SpouseMobile">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_SpouseMobile"><?php echo $staff_view->SpouseMobile->caption() ?></span></td>
		<td data-name="SpouseMobile" <?php echo $staff_view->SpouseMobile->cellAttributes() ?>>
<span id="el_staff_SpouseMobile">
<span<?php echo $staff_view->SpouseMobile->viewAttributes() ?>><?php echo $staff_view->SpouseMobile->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->SpouseEmail->Visible) { // SpouseEmail ?>
	<tr id="r_SpouseEmail">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_SpouseEmail"><?php echo $staff_view->SpouseEmail->caption() ?></span></td>
		<td data-name="SpouseEmail" <?php echo $staff_view->SpouseEmail->cellAttributes() ?>>
<span id="el_staff_SpouseEmail">
<span<?php echo $staff_view->SpouseEmail->viewAttributes() ?>><?php echo $staff_view->SpouseEmail->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->SpouseResidentialAddress->Visible) { // SpouseResidentialAddress ?>
	<tr id="r_SpouseResidentialAddress">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_SpouseResidentialAddress"><?php echo $staff_view->SpouseResidentialAddress->caption() ?></span></td>
		<td data-name="SpouseResidentialAddress" <?php echo $staff_view->SpouseResidentialAddress->cellAttributes() ?>>
<span id="el_staff_SpouseResidentialAddress">
<span<?php echo $staff_view->SpouseResidentialAddress->viewAttributes() ?>><?php echo $staff_view->SpouseResidentialAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->AdditionalInformation->Visible) { // AdditionalInformation ?>
	<tr id="r_AdditionalInformation">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_AdditionalInformation"><?php echo $staff_view->AdditionalInformation->caption() ?></span></td>
		<td data-name="AdditionalInformation" <?php echo $staff_view->AdditionalInformation->cellAttributes() ?>>
<span id="el_staff_AdditionalInformation">
<span<?php echo $staff_view->AdditionalInformation->viewAttributes() ?>><?php echo $staff_view->AdditionalInformation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->BankAccountNo->Visible) { // BankAccountNo ?>
	<tr id="r_BankAccountNo">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_BankAccountNo"><?php echo $staff_view->BankAccountNo->caption() ?></span></td>
		<td data-name="BankAccountNo" <?php echo $staff_view->BankAccountNo->cellAttributes() ?>>
<span id="el_staff_BankAccountNo">
<span<?php echo $staff_view->BankAccountNo->viewAttributes() ?>><?php echo $staff_view->BankAccountNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->PaymentMethod->Visible) { // PaymentMethod ?>
	<tr id="r_PaymentMethod">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_PaymentMethod"><?php echo $staff_view->PaymentMethod->caption() ?></span></td>
		<td data-name="PaymentMethod" <?php echo $staff_view->PaymentMethod->cellAttributes() ?>>
<span id="el_staff_PaymentMethod">
<span<?php echo $staff_view->PaymentMethod->viewAttributes() ?>><?php echo $staff_view->PaymentMethod->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->BankBranchCode->Visible) { // BankBranchCode ?>
	<tr id="r_BankBranchCode">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_BankBranchCode"><?php echo $staff_view->BankBranchCode->caption() ?></span></td>
		<td data-name="BankBranchCode" <?php echo $staff_view->BankBranchCode->cellAttributes() ?>>
<span id="el_staff_BankBranchCode">
<span<?php echo $staff_view->BankBranchCode->viewAttributes() ?>><?php echo $staff_view->BankBranchCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->TaxNumber->Visible) { // TaxNumber ?>
	<tr id="r_TaxNumber">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_TaxNumber"><?php echo $staff_view->TaxNumber->caption() ?></span></td>
		<td data-name="TaxNumber" <?php echo $staff_view->TaxNumber->cellAttributes() ?>>
<span id="el_staff_TaxNumber">
<span<?php echo $staff_view->TaxNumber->viewAttributes() ?>><?php echo $staff_view->TaxNumber->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->PensionNumber->Visible) { // PensionNumber ?>
	<tr id="r_PensionNumber">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_PensionNumber"><?php echo $staff_view->PensionNumber->caption() ?></span></td>
		<td data-name="PensionNumber" <?php echo $staff_view->PensionNumber->cellAttributes() ?>>
<span id="el_staff_PensionNumber">
<span<?php echo $staff_view->PensionNumber->viewAttributes() ?>><?php echo $staff_view->PensionNumber->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
	<tr id="r_SocialSecurityNo">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_SocialSecurityNo"><?php echo $staff_view->SocialSecurityNo->caption() ?></span></td>
		<td data-name="SocialSecurityNo" <?php echo $staff_view->SocialSecurityNo->cellAttributes() ?>>
<span id="el_staff_SocialSecurityNo">
<span<?php echo $staff_view->SocialSecurityNo->viewAttributes() ?>><?php echo $staff_view->SocialSecurityNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staff_view->ThirdParties->Visible) { // ThirdParties ?>
	<tr id="r_ThirdParties">
		<td class="<?php echo $staff_view->TableLeftColumnClass ?>"><span id="elh_staff_ThirdParties"><?php echo $staff_view->ThirdParties->caption() ?></span></td>
		<td data-name="ThirdParties" <?php echo $staff_view->ThirdParties->cellAttributes() ?>>
<span id="el_staff_ThirdParties">
<span<?php echo $staff_view->ThirdParties->viewAttributes() ?>><?php echo $staff_view->ThirdParties->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$staff_view->IsModal) { ?>
<?php if (!$staff_view->isExport()) { ?>
<?php echo $staff_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php if ($staff->getCurrentDetailTable() != "") { ?>
<?php
	$staff_view->DetailPages->ValidKeys = explode(",", $staff->getCurrentDetailTable());
	$firstActiveDetailTable = $staff_view->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="staff_view_details"><!-- tabs -->
	<ul class="<?php echo $staff_view->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("staffchildren", explode(",", $staff->getCurrentDetailTable())) && $staffchildren->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffchildren") {
			$firstActiveDetailTable = "staffchildren";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_view->DetailPages->pageStyle("staffchildren") ?>" href="#tab_staffchildren" data-toggle="tab"><?php echo $Language->tablePhrase("staffchildren", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $staff_view->staffchildren_Count, $Language->phrase("DetailCount")) ?></a></li>
<?php
	}
?>
<?php
	if (in_array("staffdisciplinary_action", explode(",", $staff->getCurrentDetailTable())) && $staffdisciplinary_action->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffdisciplinary_action") {
			$firstActiveDetailTable = "staffdisciplinary_action";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_view->DetailPages->pageStyle("staffdisciplinary_action") ?>" href="#tab_staffdisciplinary_action" data-toggle="tab"><?php echo $Language->tablePhrase("staffdisciplinary_action", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $staff_view->staffdisciplinary_action_Count, $Language->phrase("DetailCount")) ?></a></li>
<?php
	}
?>
<?php
	if (in_array("staffdisciplinary_appeal", explode(",", $staff->getCurrentDetailTable())) && $staffdisciplinary_appeal->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffdisciplinary_appeal") {
			$firstActiveDetailTable = "staffdisciplinary_appeal";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_view->DetailPages->pageStyle("staffdisciplinary_appeal") ?>" href="#tab_staffdisciplinary_appeal" data-toggle="tab"><?php echo $Language->tablePhrase("staffdisciplinary_appeal", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $staff_view->staffdisciplinary_appeal_Count, $Language->phrase("DetailCount")) ?></a></li>
<?php
	}
?>
<?php
	if (in_array("staffdisciplinary_case", explode(",", $staff->getCurrentDetailTable())) && $staffdisciplinary_case->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffdisciplinary_case") {
			$firstActiveDetailTable = "staffdisciplinary_case";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_view->DetailPages->pageStyle("staffdisciplinary_case") ?>" href="#tab_staffdisciplinary_case" data-toggle="tab"><?php echo $Language->tablePhrase("staffdisciplinary_case", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $staff_view->staffdisciplinary_case_Count, $Language->phrase("DetailCount")) ?></a></li>
<?php
	}
?>
<?php
	if (in_array("staffexperience", explode(",", $staff->getCurrentDetailTable())) && $staffexperience->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffexperience") {
			$firstActiveDetailTable = "staffexperience";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_view->DetailPages->pageStyle("staffexperience") ?>" href="#tab_staffexperience" data-toggle="tab"><?php echo $Language->tablePhrase("staffexperience", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $staff_view->staffexperience_Count, $Language->phrase("DetailCount")) ?></a></li>
<?php
	}
?>
<?php
	if (in_array("staffprofbodies", explode(",", $staff->getCurrentDetailTable())) && $staffprofbodies->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffprofbodies") {
			$firstActiveDetailTable = "staffprofbodies";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_view->DetailPages->pageStyle("staffprofbodies") ?>" href="#tab_staffprofbodies" data-toggle="tab"><?php echo $Language->tablePhrase("staffprofbodies", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $staff_view->staffprofbodies_Count, $Language->phrase("DetailCount")) ?></a></li>
<?php
	}
?>
<?php
	if (in_array("staffqualifications_academic", explode(",", $staff->getCurrentDetailTable())) && $staffqualifications_academic->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffqualifications_academic") {
			$firstActiveDetailTable = "staffqualifications_academic";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_view->DetailPages->pageStyle("staffqualifications_academic") ?>" href="#tab_staffqualifications_academic" data-toggle="tab"><?php echo $Language->tablePhrase("staffqualifications_academic", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $staff_view->staffqualifications_academic_Count, $Language->phrase("DetailCount")) ?></a></li>
<?php
	}
?>
<?php
	if (in_array("staffqualifications_prof", explode(",", $staff->getCurrentDetailTable())) && $staffqualifications_prof->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffqualifications_prof") {
			$firstActiveDetailTable = "staffqualifications_prof";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_view->DetailPages->pageStyle("staffqualifications_prof") ?>" href="#tab_staffqualifications_prof" data-toggle="tab"><?php echo $Language->tablePhrase("staffqualifications_prof", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $staff_view->staffqualifications_prof_Count, $Language->phrase("DetailCount")) ?></a></li>
<?php
	}
?>
<?php
	if (in_array("employment", explode(",", $staff->getCurrentDetailTable())) && $employment->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "employment") {
			$firstActiveDetailTable = "employment";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_view->DetailPages->pageStyle("employment") ?>" href="#tab_employment" data-toggle="tab"><?php echo $Language->tablePhrase("employment", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $staff_view->employment_Count, $Language->phrase("DetailCount")) ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("staffchildren", explode(",", $staff->getCurrentDetailTable())) && $staffchildren->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffchildren")
			$firstActiveDetailTable = "staffchildren";
?>
		<div class="tab-pane <?php echo $staff_view->DetailPages->pageStyle("staffchildren") ?>" id="tab_staffchildren"><!-- page* -->
<?php include_once "staffchildrengrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("staffdisciplinary_action", explode(",", $staff->getCurrentDetailTable())) && $staffdisciplinary_action->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffdisciplinary_action")
			$firstActiveDetailTable = "staffdisciplinary_action";
?>
		<div class="tab-pane <?php echo $staff_view->DetailPages->pageStyle("staffdisciplinary_action") ?>" id="tab_staffdisciplinary_action"><!-- page* -->
<?php include_once "staffdisciplinary_actiongrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("staffdisciplinary_appeal", explode(",", $staff->getCurrentDetailTable())) && $staffdisciplinary_appeal->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffdisciplinary_appeal")
			$firstActiveDetailTable = "staffdisciplinary_appeal";
?>
		<div class="tab-pane <?php echo $staff_view->DetailPages->pageStyle("staffdisciplinary_appeal") ?>" id="tab_staffdisciplinary_appeal"><!-- page* -->
<?php include_once "staffdisciplinary_appealgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("staffdisciplinary_case", explode(",", $staff->getCurrentDetailTable())) && $staffdisciplinary_case->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffdisciplinary_case")
			$firstActiveDetailTable = "staffdisciplinary_case";
?>
		<div class="tab-pane <?php echo $staff_view->DetailPages->pageStyle("staffdisciplinary_case") ?>" id="tab_staffdisciplinary_case"><!-- page* -->
<?php include_once "staffdisciplinary_casegrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("staffexperience", explode(",", $staff->getCurrentDetailTable())) && $staffexperience->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffexperience")
			$firstActiveDetailTable = "staffexperience";
?>
		<div class="tab-pane <?php echo $staff_view->DetailPages->pageStyle("staffexperience") ?>" id="tab_staffexperience"><!-- page* -->
<?php include_once "staffexperiencegrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("staffprofbodies", explode(",", $staff->getCurrentDetailTable())) && $staffprofbodies->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffprofbodies")
			$firstActiveDetailTable = "staffprofbodies";
?>
		<div class="tab-pane <?php echo $staff_view->DetailPages->pageStyle("staffprofbodies") ?>" id="tab_staffprofbodies"><!-- page* -->
<?php include_once "staffprofbodiesgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("staffqualifications_academic", explode(",", $staff->getCurrentDetailTable())) && $staffqualifications_academic->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffqualifications_academic")
			$firstActiveDetailTable = "staffqualifications_academic";
?>
		<div class="tab-pane <?php echo $staff_view->DetailPages->pageStyle("staffqualifications_academic") ?>" id="tab_staffqualifications_academic"><!-- page* -->
<?php include_once "staffqualifications_academicgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("staffqualifications_prof", explode(",", $staff->getCurrentDetailTable())) && $staffqualifications_prof->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffqualifications_prof")
			$firstActiveDetailTable = "staffqualifications_prof";
?>
		<div class="tab-pane <?php echo $staff_view->DetailPages->pageStyle("staffqualifications_prof") ?>" id="tab_staffqualifications_prof"><!-- page* -->
<?php include_once "staffqualifications_profgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("employment", explode(",", $staff->getCurrentDetailTable())) && $employment->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "employment")
			$firstActiveDetailTable = "employment";
?>
		<div class="tab-pane <?php echo $staff_view->DetailPages->pageStyle("employment") ?>" id="tab_employment"><!-- page* -->
<?php include_once "employmentgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
</form>
<?php
$staff_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$staff_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$staff_view->terminate();
?>