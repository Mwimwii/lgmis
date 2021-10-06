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
$staff_list = new staff_list();

// Run the page
$staff_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staff_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$staff_list->isExport()) { ?>
<script>
var fstafflist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fstafflist = currentForm = new ew.Form("fstafflist", "list");
	fstafflist.formKeyCountName = '<?php echo $staff_list->FormKeyCountName ?>';

	// Validate form
	fstafflist.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($staff_list->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->EmployeeID->caption(), $staff_list->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->LACode->caption(), $staff_list->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->FormerFileNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_FormerFileNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->FormerFileNumber->caption(), $staff_list->FormerFileNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->NRC->Required) { ?>
				elm = this.getElements("x" + infix + "_NRC");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->NRC->caption(), $staff_list->NRC->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->Title->Required) { ?>
				elm = this.getElements("x" + infix + "_Title");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->Title->caption(), $staff_list->Title->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->Surname->Required) { ?>
				elm = this.getElements("x" + infix + "_Surname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->Surname->caption(), $staff_list->Surname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->FirstName->caption(), $staff_list->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->MiddleName->Required) { ?>
				elm = this.getElements("x" + infix + "_MiddleName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->MiddleName->caption(), $staff_list->MiddleName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->Sex->Required) { ?>
				elm = this.getElements("x" + infix + "_Sex");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->Sex->caption(), $staff_list->Sex->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->MaritalStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_MaritalStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->MaritalStatus->caption(), $staff_list->MaritalStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->MaidenName->Required) { ?>
				elm = this.getElements("x" + infix + "_MaidenName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->MaidenName->caption(), $staff_list->MaidenName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->DateOfBirth->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->DateOfBirth->caption(), $staff_list->DateOfBirth->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staff_list->DateOfBirth->errorMessage()) ?>");
			<?php if ($staff_list->AcademicQualification->Required) { ?>
				elm = this.getElements("x" + infix + "_AcademicQualification");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->AcademicQualification->caption(), $staff_list->AcademicQualification->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->ProfessionalQualification->Required) { ?>
				elm = this.getElements("x" + infix + "_ProfessionalQualification");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->ProfessionalQualification->caption(), $staff_list->ProfessionalQualification->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->MedicalCondition->Required) { ?>
				elm = this.getElements("x" + infix + "_MedicalCondition");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->MedicalCondition->caption(), $staff_list->MedicalCondition->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->OtherMedicalConditions->Required) { ?>
				elm = this.getElements("x" + infix + "_OtherMedicalConditions");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->OtherMedicalConditions->caption(), $staff_list->OtherMedicalConditions->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->PhysicalChallenge->Required) { ?>
				elm = this.getElements("x" + infix + "_PhysicalChallenge");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->PhysicalChallenge->caption(), $staff_list->PhysicalChallenge->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->PostalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PostalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->PostalAddress->caption(), $staff_list->PostalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->PhysicalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PhysicalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->PhysicalAddress->caption(), $staff_list->PhysicalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->TownOrVillage->Required) { ?>
				elm = this.getElements("x" + infix + "_TownOrVillage");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->TownOrVillage->caption(), $staff_list->TownOrVillage->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->Telephone->Required) { ?>
				elm = this.getElements("x" + infix + "_Telephone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->Telephone->caption(), $staff_list->Telephone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->Mobile->Required) { ?>
				elm = this.getElements("x" + infix + "_Mobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->Mobile->caption(), $staff_list->Mobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->Fax->Required) { ?>
				elm = this.getElements("x" + infix + "_Fax");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->Fax->caption(), $staff_list->Fax->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->_Email->caption(), $staff_list->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staff_list->_Email->errorMessage()) ?>");
			<?php if ($staff_list->NumberOfBiologicalChildren->Required) { ?>
				elm = this.getElements("x" + infix + "_NumberOfBiologicalChildren");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->NumberOfBiologicalChildren->caption(), $staff_list->NumberOfBiologicalChildren->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NumberOfBiologicalChildren");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staff_list->NumberOfBiologicalChildren->errorMessage()) ?>");
			<?php if ($staff_list->NumberOfDependants->Required) { ?>
				elm = this.getElements("x" + infix + "_NumberOfDependants");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->NumberOfDependants->caption(), $staff_list->NumberOfDependants->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NumberOfDependants");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staff_list->NumberOfDependants->errorMessage()) ?>");
			<?php if ($staff_list->NextOfKin->Required) { ?>
				elm = this.getElements("x" + infix + "_NextOfKin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->NextOfKin->caption(), $staff_list->NextOfKin->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->RelationshipCode->Required) { ?>
				elm = this.getElements("x" + infix + "_RelationshipCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->RelationshipCode->caption(), $staff_list->RelationshipCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->NextOfKinMobile->Required) { ?>
				elm = this.getElements("x" + infix + "_NextOfKinMobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->NextOfKinMobile->caption(), $staff_list->NextOfKinMobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->NextOfKinEmail->Required) { ?>
				elm = this.getElements("x" + infix + "_NextOfKinEmail");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->NextOfKinEmail->caption(), $staff_list->NextOfKinEmail->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NextOfKinEmail");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staff_list->NextOfKinEmail->errorMessage()) ?>");
			<?php if ($staff_list->SpouseName->Required) { ?>
				elm = this.getElements("x" + infix + "_SpouseName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->SpouseName->caption(), $staff_list->SpouseName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->SpouseNRC->Required) { ?>
				elm = this.getElements("x" + infix + "_SpouseNRC");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->SpouseNRC->caption(), $staff_list->SpouseNRC->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->SpouseMobile->Required) { ?>
				elm = this.getElements("x" + infix + "_SpouseMobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->SpouseMobile->caption(), $staff_list->SpouseMobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->SpouseEmail->Required) { ?>
				elm = this.getElements("x" + infix + "_SpouseEmail");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->SpouseEmail->caption(), $staff_list->SpouseEmail->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SpouseEmail");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staff_list->SpouseEmail->errorMessage()) ?>");
			<?php if ($staff_list->SpouseResidentialAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_SpouseResidentialAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->SpouseResidentialAddress->caption(), $staff_list->SpouseResidentialAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->BankAccountNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BankAccountNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->BankAccountNo->caption(), $staff_list->BankAccountNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->PaymentMethod->Required) { ?>
				elm = this.getElements("x" + infix + "_PaymentMethod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->PaymentMethod->caption(), $staff_list->PaymentMethod->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->BankBranchCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BankBranchCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->BankBranchCode->caption(), $staff_list->BankBranchCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->TaxNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_TaxNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->TaxNumber->caption(), $staff_list->TaxNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->PensionNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_PensionNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->PensionNumber->caption(), $staff_list->PensionNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->SocialSecurityNo->Required) { ?>
				elm = this.getElements("x" + infix + "_SocialSecurityNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->SocialSecurityNo->caption(), $staff_list->SocialSecurityNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_list->ThirdParties->Required) { ?>
				elm = this.getElements("x" + infix + "_ThirdParties[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_list->ThirdParties->caption(), $staff_list->ThirdParties->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		if (gridinsert && addcnt == 0) { // No row added
			ew.alert(ew.language.phrase("NoAddRecord"));
			return false;
		}
		return true;
	}

	// Check empty row
	fstafflist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "FormerFileNumber", false)) return false;
		if (ew.valueChanged(fobj, infix, "NRC", false)) return false;
		if (ew.valueChanged(fobj, infix, "Title", false)) return false;
		if (ew.valueChanged(fobj, infix, "Surname", false)) return false;
		if (ew.valueChanged(fobj, infix, "FirstName", false)) return false;
		if (ew.valueChanged(fobj, infix, "MiddleName", false)) return false;
		if (ew.valueChanged(fobj, infix, "Sex", false)) return false;
		if (ew.valueChanged(fobj, infix, "MaritalStatus", false)) return false;
		if (ew.valueChanged(fobj, infix, "MaidenName", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateOfBirth", false)) return false;
		if (ew.valueChanged(fobj, infix, "AcademicQualification", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProfessionalQualification", false)) return false;
		if (ew.valueChanged(fobj, infix, "MedicalCondition", false)) return false;
		if (ew.valueChanged(fobj, infix, "OtherMedicalConditions", false)) return false;
		if (ew.valueChanged(fobj, infix, "PhysicalChallenge", false)) return false;
		if (ew.valueChanged(fobj, infix, "PostalAddress", false)) return false;
		if (ew.valueChanged(fobj, infix, "PhysicalAddress", false)) return false;
		if (ew.valueChanged(fobj, infix, "TownOrVillage", false)) return false;
		if (ew.valueChanged(fobj, infix, "Telephone", false)) return false;
		if (ew.valueChanged(fobj, infix, "Mobile", false)) return false;
		if (ew.valueChanged(fobj, infix, "Fax", false)) return false;
		if (ew.valueChanged(fobj, infix, "_Email", false)) return false;
		if (ew.valueChanged(fobj, infix, "NumberOfBiologicalChildren", false)) return false;
		if (ew.valueChanged(fobj, infix, "NumberOfDependants", false)) return false;
		if (ew.valueChanged(fobj, infix, "NextOfKin", false)) return false;
		if (ew.valueChanged(fobj, infix, "RelationshipCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "NextOfKinMobile", false)) return false;
		if (ew.valueChanged(fobj, infix, "NextOfKinEmail", false)) return false;
		if (ew.valueChanged(fobj, infix, "SpouseName", false)) return false;
		if (ew.valueChanged(fobj, infix, "SpouseNRC", false)) return false;
		if (ew.valueChanged(fobj, infix, "SpouseMobile", false)) return false;
		if (ew.valueChanged(fobj, infix, "SpouseEmail", false)) return false;
		if (ew.valueChanged(fobj, infix, "SpouseResidentialAddress", false)) return false;
		if (ew.valueChanged(fobj, infix, "BankAccountNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "PaymentMethod", false)) return false;
		if (ew.valueChanged(fobj, infix, "BankBranchCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "TaxNumber", false)) return false;
		if (ew.valueChanged(fobj, infix, "PensionNumber", false)) return false;
		if (ew.valueChanged(fobj, infix, "SocialSecurityNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "ThirdParties[]", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fstafflist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstafflist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstafflist.lists["x_LACode"] = <?php echo $staff_list->LACode->Lookup->toClientList($staff_list) ?>;
	fstafflist.lists["x_LACode"].options = <?php echo JsonEncode($staff_list->LACode->lookupOptions()) ?>;
	fstafflist.lists["x_Title"] = <?php echo $staff_list->Title->Lookup->toClientList($staff_list) ?>;
	fstafflist.lists["x_Title"].options = <?php echo JsonEncode($staff_list->Title->lookupOptions()) ?>;
	fstafflist.lists["x_Sex"] = <?php echo $staff_list->Sex->Lookup->toClientList($staff_list) ?>;
	fstafflist.lists["x_Sex"].options = <?php echo JsonEncode($staff_list->Sex->lookupOptions()) ?>;
	fstafflist.lists["x_MaritalStatus"] = <?php echo $staff_list->MaritalStatus->Lookup->toClientList($staff_list) ?>;
	fstafflist.lists["x_MaritalStatus"].options = <?php echo JsonEncode($staff_list->MaritalStatus->lookupOptions()) ?>;
	fstafflist.lists["x_AcademicQualification"] = <?php echo $staff_list->AcademicQualification->Lookup->toClientList($staff_list) ?>;
	fstafflist.lists["x_AcademicQualification"].options = <?php echo JsonEncode($staff_list->AcademicQualification->lookupOptions()) ?>;
	fstafflist.lists["x_ProfessionalQualification"] = <?php echo $staff_list->ProfessionalQualification->Lookup->toClientList($staff_list) ?>;
	fstafflist.lists["x_ProfessionalQualification"].options = <?php echo JsonEncode($staff_list->ProfessionalQualification->lookupOptions()) ?>;
	fstafflist.lists["x_MedicalCondition"] = <?php echo $staff_list->MedicalCondition->Lookup->toClientList($staff_list) ?>;
	fstafflist.lists["x_MedicalCondition"].options = <?php echo JsonEncode($staff_list->MedicalCondition->lookupOptions()) ?>;
	fstafflist.lists["x_OtherMedicalConditions"] = <?php echo $staff_list->OtherMedicalConditions->Lookup->toClientList($staff_list) ?>;
	fstafflist.lists["x_OtherMedicalConditions"].options = <?php echo JsonEncode($staff_list->OtherMedicalConditions->lookupOptions()) ?>;
	fstafflist.lists["x_PhysicalChallenge"] = <?php echo $staff_list->PhysicalChallenge->Lookup->toClientList($staff_list) ?>;
	fstafflist.lists["x_PhysicalChallenge"].options = <?php echo JsonEncode($staff_list->PhysicalChallenge->lookupOptions()) ?>;
	fstafflist.lists["x_RelationshipCode"] = <?php echo $staff_list->RelationshipCode->Lookup->toClientList($staff_list) ?>;
	fstafflist.lists["x_RelationshipCode"].options = <?php echo JsonEncode($staff_list->RelationshipCode->lookupOptions()) ?>;
	fstafflist.lists["x_PaymentMethod"] = <?php echo $staff_list->PaymentMethod->Lookup->toClientList($staff_list) ?>;
	fstafflist.lists["x_PaymentMethod"].options = <?php echo JsonEncode($staff_list->PaymentMethod->lookupOptions()) ?>;
	fstafflist.lists["x_BankBranchCode"] = <?php echo $staff_list->BankBranchCode->Lookup->toClientList($staff_list) ?>;
	fstafflist.lists["x_BankBranchCode"].options = <?php echo JsonEncode($staff_list->BankBranchCode->lookupOptions()) ?>;
	fstafflist.lists["x_ThirdParties[]"] = <?php echo $staff_list->ThirdParties->Lookup->toClientList($staff_list) ?>;
	fstafflist.lists["x_ThirdParties[]"].options = <?php echo JsonEncode($staff_list->ThirdParties->lookupOptions()) ?>;
	loadjs.done("fstafflist");
});
var fstafflistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fstafflistsrch = currentSearchForm = new ew.Form("fstafflistsrch");

	// Dynamic selection lists
	// Filters

	fstafflistsrch.filterList = <?php echo $staff_list->getFilterList() ?>;

	// Init search panel as collapsed
	fstafflistsrch.initSearchPanel = true;
	loadjs.done("fstafflistsrch");
});
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
	display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
	<div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade active show"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script>
loadjs.ready("head", function() {
	ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "left" : "right";
	ew.PREVIEW_SINGLE_ROW = false;
	ew.PREVIEW_OVERLAY = false;
	loadjs("js/ewpreview.js", "preview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$staff_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($staff_list->TotalRecords > 0 && $staff_list->ExportOptions->visible()) { ?>
<?php $staff_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($staff_list->ImportOptions->visible()) { ?>
<?php $staff_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($staff_list->SearchOptions->visible()) { ?>
<?php $staff_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($staff_list->FilterOptions->visible()) { ?>
<?php $staff_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$staff_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$staff_list->isExport() && !$staff->CurrentAction) { ?>
<form name="fstafflistsrch" id="fstafflistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fstafflistsrch-search-panel" class="<?php echo $staff_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="staff">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $staff_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($staff_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($staff_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $staff_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($staff_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($staff_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($staff_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($staff_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $staff_list->showPageHeader(); ?>
<?php
$staff_list->showMessage();
?>
<?php if ($staff_list->TotalRecords > 0 || $staff->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($staff_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> staff">
<?php if (!$staff_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$staff_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staff_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $staff_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fstafflist" id="fstafflist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staff">
<div id="gmp_staff" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($staff_list->TotalRecords > 0 || $staff_list->isGridEdit()) { ?>
<table id="tbl_stafflist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$staff->RowType = ROWTYPE_HEADER;

// Render list options
$staff_list->renderListOptions();

// Render list options (header, left)
$staff_list->ListOptions->render("header", "left");
?>
<?php if ($staff_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($staff_list->SortUrl($staff_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $staff_list->EmployeeID->headerCellClass() ?>"><div id="elh_staff_EmployeeID" class="staff_EmployeeID"><div class="ew-table-header-caption"><?php echo $staff_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $staff_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->EmployeeID) ?>', 1);"><div id="elh_staff_EmployeeID" class="staff_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($staff_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->LACode->Visible) { // LACode ?>
	<?php if ($staff_list->SortUrl($staff_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $staff_list->LACode->headerCellClass() ?>"><div id="elh_staff_LACode" class="staff_LACode"><div class="ew-table-header-caption"><?php echo $staff_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $staff_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->LACode) ?>', 1);"><div id="elh_staff_LACode" class="staff_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($staff_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->FormerFileNumber->Visible) { // FormerFileNumber ?>
	<?php if ($staff_list->SortUrl($staff_list->FormerFileNumber) == "") { ?>
		<th data-name="FormerFileNumber" class="<?php echo $staff_list->FormerFileNumber->headerCellClass() ?>"><div id="elh_staff_FormerFileNumber" class="staff_FormerFileNumber"><div class="ew-table-header-caption"><?php echo $staff_list->FormerFileNumber->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FormerFileNumber" class="<?php echo $staff_list->FormerFileNumber->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->FormerFileNumber) ?>', 1);"><div id="elh_staff_FormerFileNumber" class="staff_FormerFileNumber">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->FormerFileNumber->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->FormerFileNumber->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->FormerFileNumber->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->NRC->Visible) { // NRC ?>
	<?php if ($staff_list->SortUrl($staff_list->NRC) == "") { ?>
		<th data-name="NRC" class="<?php echo $staff_list->NRC->headerCellClass() ?>"><div id="elh_staff_NRC" class="staff_NRC"><div class="ew-table-header-caption"><?php echo $staff_list->NRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC" class="<?php echo $staff_list->NRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->NRC) ?>', 1);"><div id="elh_staff_NRC" class="staff_NRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->NRC->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->Title->Visible) { // Title ?>
	<?php if ($staff_list->SortUrl($staff_list->Title) == "") { ?>
		<th data-name="Title" class="<?php echo $staff_list->Title->headerCellClass() ?>"><div id="elh_staff_Title" class="staff_Title"><div class="ew-table-header-caption"><?php echo $staff_list->Title->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Title" class="<?php echo $staff_list->Title->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->Title) ?>', 1);"><div id="elh_staff_Title" class="staff_Title">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->Title->caption() ?></span><span class="ew-table-header-sort"><?php if ($staff_list->Title->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->Title->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->Surname->Visible) { // Surname ?>
	<?php if ($staff_list->SortUrl($staff_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $staff_list->Surname->headerCellClass() ?>"><div id="elh_staff_Surname" class="staff_Surname"><div class="ew-table-header-caption"><?php echo $staff_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $staff_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->Surname) ?>', 1);"><div id="elh_staff_Surname" class="staff_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->FirstName->Visible) { // FirstName ?>
	<?php if ($staff_list->SortUrl($staff_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $staff_list->FirstName->headerCellClass() ?>"><div id="elh_staff_FirstName" class="staff_FirstName"><div class="ew-table-header-caption"><?php echo $staff_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $staff_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->FirstName) ?>', 1);"><div id="elh_staff_FirstName" class="staff_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->MiddleName->Visible) { // MiddleName ?>
	<?php if ($staff_list->SortUrl($staff_list->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $staff_list->MiddleName->headerCellClass() ?>"><div id="elh_staff_MiddleName" class="staff_MiddleName"><div class="ew-table-header-caption"><?php echo $staff_list->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $staff_list->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->MiddleName) ?>', 1);"><div id="elh_staff_MiddleName" class="staff_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->MiddleName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->Sex->Visible) { // Sex ?>
	<?php if ($staff_list->SortUrl($staff_list->Sex) == "") { ?>
		<th data-name="Sex" class="<?php echo $staff_list->Sex->headerCellClass() ?>"><div id="elh_staff_Sex" class="staff_Sex"><div class="ew-table-header-caption"><?php echo $staff_list->Sex->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sex" class="<?php echo $staff_list->Sex->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->Sex) ?>', 1);"><div id="elh_staff_Sex" class="staff_Sex">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->Sex->caption() ?></span><span class="ew-table-header-sort"><?php if ($staff_list->Sex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->Sex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->MaritalStatus->Visible) { // MaritalStatus ?>
	<?php if ($staff_list->SortUrl($staff_list->MaritalStatus) == "") { ?>
		<th data-name="MaritalStatus" class="<?php echo $staff_list->MaritalStatus->headerCellClass() ?>"><div id="elh_staff_MaritalStatus" class="staff_MaritalStatus"><div class="ew-table-header-caption"><?php echo $staff_list->MaritalStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MaritalStatus" class="<?php echo $staff_list->MaritalStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->MaritalStatus) ?>', 1);"><div id="elh_staff_MaritalStatus" class="staff_MaritalStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->MaritalStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($staff_list->MaritalStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->MaritalStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->MaidenName->Visible) { // MaidenName ?>
	<?php if ($staff_list->SortUrl($staff_list->MaidenName) == "") { ?>
		<th data-name="MaidenName" class="<?php echo $staff_list->MaidenName->headerCellClass() ?>"><div id="elh_staff_MaidenName" class="staff_MaidenName"><div class="ew-table-header-caption"><?php echo $staff_list->MaidenName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MaidenName" class="<?php echo $staff_list->MaidenName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->MaidenName) ?>', 1);"><div id="elh_staff_MaidenName" class="staff_MaidenName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->MaidenName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->MaidenName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->MaidenName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->DateOfBirth->Visible) { // DateOfBirth ?>
	<?php if ($staff_list->SortUrl($staff_list->DateOfBirth) == "") { ?>
		<th data-name="DateOfBirth" class="<?php echo $staff_list->DateOfBirth->headerCellClass() ?>"><div id="elh_staff_DateOfBirth" class="staff_DateOfBirth"><div class="ew-table-header-caption"><?php echo $staff_list->DateOfBirth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfBirth" class="<?php echo $staff_list->DateOfBirth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->DateOfBirth) ?>', 1);"><div id="elh_staff_DateOfBirth" class="staff_DateOfBirth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->DateOfBirth->caption() ?></span><span class="ew-table-header-sort"><?php if ($staff_list->DateOfBirth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->DateOfBirth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->AcademicQualification->Visible) { // AcademicQualification ?>
	<?php if ($staff_list->SortUrl($staff_list->AcademicQualification) == "") { ?>
		<th data-name="AcademicQualification" class="<?php echo $staff_list->AcademicQualification->headerCellClass() ?>"><div id="elh_staff_AcademicQualification" class="staff_AcademicQualification"><div class="ew-table-header-caption"><?php echo $staff_list->AcademicQualification->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AcademicQualification" class="<?php echo $staff_list->AcademicQualification->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->AcademicQualification) ?>', 1);"><div id="elh_staff_AcademicQualification" class="staff_AcademicQualification">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->AcademicQualification->caption() ?></span><span class="ew-table-header-sort"><?php if ($staff_list->AcademicQualification->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->AcademicQualification->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->ProfessionalQualification->Visible) { // ProfessionalQualification ?>
	<?php if ($staff_list->SortUrl($staff_list->ProfessionalQualification) == "") { ?>
		<th data-name="ProfessionalQualification" class="<?php echo $staff_list->ProfessionalQualification->headerCellClass() ?>"><div id="elh_staff_ProfessionalQualification" class="staff_ProfessionalQualification"><div class="ew-table-header-caption"><?php echo $staff_list->ProfessionalQualification->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProfessionalQualification" class="<?php echo $staff_list->ProfessionalQualification->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->ProfessionalQualification) ?>', 1);"><div id="elh_staff_ProfessionalQualification" class="staff_ProfessionalQualification">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->ProfessionalQualification->caption() ?></span><span class="ew-table-header-sort"><?php if ($staff_list->ProfessionalQualification->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->ProfessionalQualification->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->MedicalCondition->Visible) { // MedicalCondition ?>
	<?php if ($staff_list->SortUrl($staff_list->MedicalCondition) == "") { ?>
		<th data-name="MedicalCondition" class="<?php echo $staff_list->MedicalCondition->headerCellClass() ?>"><div id="elh_staff_MedicalCondition" class="staff_MedicalCondition"><div class="ew-table-header-caption"><?php echo $staff_list->MedicalCondition->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MedicalCondition" class="<?php echo $staff_list->MedicalCondition->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->MedicalCondition) ?>', 1);"><div id="elh_staff_MedicalCondition" class="staff_MedicalCondition">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->MedicalCondition->caption() ?></span><span class="ew-table-header-sort"><?php if ($staff_list->MedicalCondition->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->MedicalCondition->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->OtherMedicalConditions->Visible) { // OtherMedicalConditions ?>
	<?php if ($staff_list->SortUrl($staff_list->OtherMedicalConditions) == "") { ?>
		<th data-name="OtherMedicalConditions" class="<?php echo $staff_list->OtherMedicalConditions->headerCellClass() ?>"><div id="elh_staff_OtherMedicalConditions" class="staff_OtherMedicalConditions"><div class="ew-table-header-caption"><?php echo $staff_list->OtherMedicalConditions->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OtherMedicalConditions" class="<?php echo $staff_list->OtherMedicalConditions->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->OtherMedicalConditions) ?>', 1);"><div id="elh_staff_OtherMedicalConditions" class="staff_OtherMedicalConditions">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->OtherMedicalConditions->caption() ?></span><span class="ew-table-header-sort"><?php if ($staff_list->OtherMedicalConditions->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->OtherMedicalConditions->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->PhysicalChallenge->Visible) { // PhysicalChallenge ?>
	<?php if ($staff_list->SortUrl($staff_list->PhysicalChallenge) == "") { ?>
		<th data-name="PhysicalChallenge" class="<?php echo $staff_list->PhysicalChallenge->headerCellClass() ?>"><div id="elh_staff_PhysicalChallenge" class="staff_PhysicalChallenge"><div class="ew-table-header-caption"><?php echo $staff_list->PhysicalChallenge->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PhysicalChallenge" class="<?php echo $staff_list->PhysicalChallenge->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->PhysicalChallenge) ?>', 1);"><div id="elh_staff_PhysicalChallenge" class="staff_PhysicalChallenge">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->PhysicalChallenge->caption() ?></span><span class="ew-table-header-sort"><?php if ($staff_list->PhysicalChallenge->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->PhysicalChallenge->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->PostalAddress->Visible) { // PostalAddress ?>
	<?php if ($staff_list->SortUrl($staff_list->PostalAddress) == "") { ?>
		<th data-name="PostalAddress" class="<?php echo $staff_list->PostalAddress->headerCellClass() ?>"><div id="elh_staff_PostalAddress" class="staff_PostalAddress"><div class="ew-table-header-caption"><?php echo $staff_list->PostalAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PostalAddress" class="<?php echo $staff_list->PostalAddress->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->PostalAddress) ?>', 1);"><div id="elh_staff_PostalAddress" class="staff_PostalAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->PostalAddress->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->PostalAddress->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->PostalAddress->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->PhysicalAddress->Visible) { // PhysicalAddress ?>
	<?php if ($staff_list->SortUrl($staff_list->PhysicalAddress) == "") { ?>
		<th data-name="PhysicalAddress" class="<?php echo $staff_list->PhysicalAddress->headerCellClass() ?>"><div id="elh_staff_PhysicalAddress" class="staff_PhysicalAddress"><div class="ew-table-header-caption"><?php echo $staff_list->PhysicalAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PhysicalAddress" class="<?php echo $staff_list->PhysicalAddress->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->PhysicalAddress) ?>', 1);"><div id="elh_staff_PhysicalAddress" class="staff_PhysicalAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->PhysicalAddress->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->PhysicalAddress->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->PhysicalAddress->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->TownOrVillage->Visible) { // TownOrVillage ?>
	<?php if ($staff_list->SortUrl($staff_list->TownOrVillage) == "") { ?>
		<th data-name="TownOrVillage" class="<?php echo $staff_list->TownOrVillage->headerCellClass() ?>"><div id="elh_staff_TownOrVillage" class="staff_TownOrVillage"><div class="ew-table-header-caption"><?php echo $staff_list->TownOrVillage->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TownOrVillage" class="<?php echo $staff_list->TownOrVillage->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->TownOrVillage) ?>', 1);"><div id="elh_staff_TownOrVillage" class="staff_TownOrVillage">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->TownOrVillage->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->TownOrVillage->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->TownOrVillage->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->Telephone->Visible) { // Telephone ?>
	<?php if ($staff_list->SortUrl($staff_list->Telephone) == "") { ?>
		<th data-name="Telephone" class="<?php echo $staff_list->Telephone->headerCellClass() ?>"><div id="elh_staff_Telephone" class="staff_Telephone"><div class="ew-table-header-caption"><?php echo $staff_list->Telephone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Telephone" class="<?php echo $staff_list->Telephone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->Telephone) ?>', 1);"><div id="elh_staff_Telephone" class="staff_Telephone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->Telephone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->Telephone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->Telephone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->Mobile->Visible) { // Mobile ?>
	<?php if ($staff_list->SortUrl($staff_list->Mobile) == "") { ?>
		<th data-name="Mobile" class="<?php echo $staff_list->Mobile->headerCellClass() ?>"><div id="elh_staff_Mobile" class="staff_Mobile"><div class="ew-table-header-caption"><?php echo $staff_list->Mobile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Mobile" class="<?php echo $staff_list->Mobile->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->Mobile) ?>', 1);"><div id="elh_staff_Mobile" class="staff_Mobile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->Mobile->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->Mobile->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->Mobile->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->Fax->Visible) { // Fax ?>
	<?php if ($staff_list->SortUrl($staff_list->Fax) == "") { ?>
		<th data-name="Fax" class="<?php echo $staff_list->Fax->headerCellClass() ?>"><div id="elh_staff_Fax" class="staff_Fax"><div class="ew-table-header-caption"><?php echo $staff_list->Fax->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Fax" class="<?php echo $staff_list->Fax->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->Fax) ?>', 1);"><div id="elh_staff_Fax" class="staff_Fax">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->Fax->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->Fax->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->Fax->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->_Email->Visible) { // Email ?>
	<?php if ($staff_list->SortUrl($staff_list->_Email) == "") { ?>
		<th data-name="_Email" class="<?php echo $staff_list->_Email->headerCellClass() ?>"><div id="elh_staff__Email" class="staff__Email"><div class="ew-table-header-caption"><?php echo $staff_list->_Email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_Email" class="<?php echo $staff_list->_Email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->_Email) ?>', 1);"><div id="elh_staff__Email" class="staff__Email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->_Email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->_Email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->_Email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->NumberOfBiologicalChildren->Visible) { // NumberOfBiologicalChildren ?>
	<?php if ($staff_list->SortUrl($staff_list->NumberOfBiologicalChildren) == "") { ?>
		<th data-name="NumberOfBiologicalChildren" class="<?php echo $staff_list->NumberOfBiologicalChildren->headerCellClass() ?>"><div id="elh_staff_NumberOfBiologicalChildren" class="staff_NumberOfBiologicalChildren"><div class="ew-table-header-caption"><?php echo $staff_list->NumberOfBiologicalChildren->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NumberOfBiologicalChildren" class="<?php echo $staff_list->NumberOfBiologicalChildren->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->NumberOfBiologicalChildren) ?>', 1);"><div id="elh_staff_NumberOfBiologicalChildren" class="staff_NumberOfBiologicalChildren">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->NumberOfBiologicalChildren->caption() ?></span><span class="ew-table-header-sort"><?php if ($staff_list->NumberOfBiologicalChildren->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->NumberOfBiologicalChildren->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->NumberOfDependants->Visible) { // NumberOfDependants ?>
	<?php if ($staff_list->SortUrl($staff_list->NumberOfDependants) == "") { ?>
		<th data-name="NumberOfDependants" class="<?php echo $staff_list->NumberOfDependants->headerCellClass() ?>"><div id="elh_staff_NumberOfDependants" class="staff_NumberOfDependants"><div class="ew-table-header-caption"><?php echo $staff_list->NumberOfDependants->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NumberOfDependants" class="<?php echo $staff_list->NumberOfDependants->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->NumberOfDependants) ?>', 1);"><div id="elh_staff_NumberOfDependants" class="staff_NumberOfDependants">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->NumberOfDependants->caption() ?></span><span class="ew-table-header-sort"><?php if ($staff_list->NumberOfDependants->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->NumberOfDependants->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->NextOfKin->Visible) { // NextOfKin ?>
	<?php if ($staff_list->SortUrl($staff_list->NextOfKin) == "") { ?>
		<th data-name="NextOfKin" class="<?php echo $staff_list->NextOfKin->headerCellClass() ?>"><div id="elh_staff_NextOfKin" class="staff_NextOfKin"><div class="ew-table-header-caption"><?php echo $staff_list->NextOfKin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NextOfKin" class="<?php echo $staff_list->NextOfKin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->NextOfKin) ?>', 1);"><div id="elh_staff_NextOfKin" class="staff_NextOfKin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->NextOfKin->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->NextOfKin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->NextOfKin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->RelationshipCode->Visible) { // RelationshipCode ?>
	<?php if ($staff_list->SortUrl($staff_list->RelationshipCode) == "") { ?>
		<th data-name="RelationshipCode" class="<?php echo $staff_list->RelationshipCode->headerCellClass() ?>"><div id="elh_staff_RelationshipCode" class="staff_RelationshipCode"><div class="ew-table-header-caption"><?php echo $staff_list->RelationshipCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RelationshipCode" class="<?php echo $staff_list->RelationshipCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->RelationshipCode) ?>', 1);"><div id="elh_staff_RelationshipCode" class="staff_RelationshipCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->RelationshipCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($staff_list->RelationshipCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->RelationshipCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
	<?php if ($staff_list->SortUrl($staff_list->NextOfKinMobile) == "") { ?>
		<th data-name="NextOfKinMobile" class="<?php echo $staff_list->NextOfKinMobile->headerCellClass() ?>"><div id="elh_staff_NextOfKinMobile" class="staff_NextOfKinMobile"><div class="ew-table-header-caption"><?php echo $staff_list->NextOfKinMobile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NextOfKinMobile" class="<?php echo $staff_list->NextOfKinMobile->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->NextOfKinMobile) ?>', 1);"><div id="elh_staff_NextOfKinMobile" class="staff_NextOfKinMobile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->NextOfKinMobile->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->NextOfKinMobile->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->NextOfKinMobile->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
	<?php if ($staff_list->SortUrl($staff_list->NextOfKinEmail) == "") { ?>
		<th data-name="NextOfKinEmail" class="<?php echo $staff_list->NextOfKinEmail->headerCellClass() ?>"><div id="elh_staff_NextOfKinEmail" class="staff_NextOfKinEmail"><div class="ew-table-header-caption"><?php echo $staff_list->NextOfKinEmail->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NextOfKinEmail" class="<?php echo $staff_list->NextOfKinEmail->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->NextOfKinEmail) ?>', 1);"><div id="elh_staff_NextOfKinEmail" class="staff_NextOfKinEmail">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->NextOfKinEmail->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->NextOfKinEmail->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->NextOfKinEmail->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->SpouseName->Visible) { // SpouseName ?>
	<?php if ($staff_list->SortUrl($staff_list->SpouseName) == "") { ?>
		<th data-name="SpouseName" class="<?php echo $staff_list->SpouseName->headerCellClass() ?>"><div id="elh_staff_SpouseName" class="staff_SpouseName"><div class="ew-table-header-caption"><?php echo $staff_list->SpouseName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SpouseName" class="<?php echo $staff_list->SpouseName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->SpouseName) ?>', 1);"><div id="elh_staff_SpouseName" class="staff_SpouseName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->SpouseName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->SpouseName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->SpouseName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->SpouseNRC->Visible) { // SpouseNRC ?>
	<?php if ($staff_list->SortUrl($staff_list->SpouseNRC) == "") { ?>
		<th data-name="SpouseNRC" class="<?php echo $staff_list->SpouseNRC->headerCellClass() ?>"><div id="elh_staff_SpouseNRC" class="staff_SpouseNRC"><div class="ew-table-header-caption"><?php echo $staff_list->SpouseNRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SpouseNRC" class="<?php echo $staff_list->SpouseNRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->SpouseNRC) ?>', 1);"><div id="elh_staff_SpouseNRC" class="staff_SpouseNRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->SpouseNRC->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->SpouseNRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->SpouseNRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->SpouseMobile->Visible) { // SpouseMobile ?>
	<?php if ($staff_list->SortUrl($staff_list->SpouseMobile) == "") { ?>
		<th data-name="SpouseMobile" class="<?php echo $staff_list->SpouseMobile->headerCellClass() ?>"><div id="elh_staff_SpouseMobile" class="staff_SpouseMobile"><div class="ew-table-header-caption"><?php echo $staff_list->SpouseMobile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SpouseMobile" class="<?php echo $staff_list->SpouseMobile->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->SpouseMobile) ?>', 1);"><div id="elh_staff_SpouseMobile" class="staff_SpouseMobile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->SpouseMobile->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->SpouseMobile->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->SpouseMobile->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->SpouseEmail->Visible) { // SpouseEmail ?>
	<?php if ($staff_list->SortUrl($staff_list->SpouseEmail) == "") { ?>
		<th data-name="SpouseEmail" class="<?php echo $staff_list->SpouseEmail->headerCellClass() ?>"><div id="elh_staff_SpouseEmail" class="staff_SpouseEmail"><div class="ew-table-header-caption"><?php echo $staff_list->SpouseEmail->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SpouseEmail" class="<?php echo $staff_list->SpouseEmail->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->SpouseEmail) ?>', 1);"><div id="elh_staff_SpouseEmail" class="staff_SpouseEmail">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->SpouseEmail->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->SpouseEmail->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->SpouseEmail->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->SpouseResidentialAddress->Visible) { // SpouseResidentialAddress ?>
	<?php if ($staff_list->SortUrl($staff_list->SpouseResidentialAddress) == "") { ?>
		<th data-name="SpouseResidentialAddress" class="<?php echo $staff_list->SpouseResidentialAddress->headerCellClass() ?>"><div id="elh_staff_SpouseResidentialAddress" class="staff_SpouseResidentialAddress"><div class="ew-table-header-caption"><?php echo $staff_list->SpouseResidentialAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SpouseResidentialAddress" class="<?php echo $staff_list->SpouseResidentialAddress->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->SpouseResidentialAddress) ?>', 1);"><div id="elh_staff_SpouseResidentialAddress" class="staff_SpouseResidentialAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->SpouseResidentialAddress->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->SpouseResidentialAddress->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->SpouseResidentialAddress->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->BankAccountNo->Visible) { // BankAccountNo ?>
	<?php if ($staff_list->SortUrl($staff_list->BankAccountNo) == "") { ?>
		<th data-name="BankAccountNo" class="<?php echo $staff_list->BankAccountNo->headerCellClass() ?>"><div id="elh_staff_BankAccountNo" class="staff_BankAccountNo"><div class="ew-table-header-caption"><?php echo $staff_list->BankAccountNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankAccountNo" class="<?php echo $staff_list->BankAccountNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->BankAccountNo) ?>', 1);"><div id="elh_staff_BankAccountNo" class="staff_BankAccountNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->BankAccountNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->BankAccountNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->BankAccountNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->PaymentMethod->Visible) { // PaymentMethod ?>
	<?php if ($staff_list->SortUrl($staff_list->PaymentMethod) == "") { ?>
		<th data-name="PaymentMethod" class="<?php echo $staff_list->PaymentMethod->headerCellClass() ?>"><div id="elh_staff_PaymentMethod" class="staff_PaymentMethod"><div class="ew-table-header-caption"><?php echo $staff_list->PaymentMethod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaymentMethod" class="<?php echo $staff_list->PaymentMethod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->PaymentMethod) ?>', 1);"><div id="elh_staff_PaymentMethod" class="staff_PaymentMethod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->PaymentMethod->caption() ?></span><span class="ew-table-header-sort"><?php if ($staff_list->PaymentMethod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->PaymentMethod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->BankBranchCode->Visible) { // BankBranchCode ?>
	<?php if ($staff_list->SortUrl($staff_list->BankBranchCode) == "") { ?>
		<th data-name="BankBranchCode" class="<?php echo $staff_list->BankBranchCode->headerCellClass() ?>"><div id="elh_staff_BankBranchCode" class="staff_BankBranchCode"><div class="ew-table-header-caption"><?php echo $staff_list->BankBranchCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankBranchCode" class="<?php echo $staff_list->BankBranchCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->BankBranchCode) ?>', 1);"><div id="elh_staff_BankBranchCode" class="staff_BankBranchCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->BankBranchCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($staff_list->BankBranchCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->BankBranchCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->TaxNumber->Visible) { // TaxNumber ?>
	<?php if ($staff_list->SortUrl($staff_list->TaxNumber) == "") { ?>
		<th data-name="TaxNumber" class="<?php echo $staff_list->TaxNumber->headerCellClass() ?>"><div id="elh_staff_TaxNumber" class="staff_TaxNumber"><div class="ew-table-header-caption"><?php echo $staff_list->TaxNumber->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TaxNumber" class="<?php echo $staff_list->TaxNumber->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->TaxNumber) ?>', 1);"><div id="elh_staff_TaxNumber" class="staff_TaxNumber">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->TaxNumber->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->TaxNumber->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->TaxNumber->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->PensionNumber->Visible) { // PensionNumber ?>
	<?php if ($staff_list->SortUrl($staff_list->PensionNumber) == "") { ?>
		<th data-name="PensionNumber" class="<?php echo $staff_list->PensionNumber->headerCellClass() ?>"><div id="elh_staff_PensionNumber" class="staff_PensionNumber"><div class="ew-table-header-caption"><?php echo $staff_list->PensionNumber->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PensionNumber" class="<?php echo $staff_list->PensionNumber->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->PensionNumber) ?>', 1);"><div id="elh_staff_PensionNumber" class="staff_PensionNumber">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->PensionNumber->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->PensionNumber->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->PensionNumber->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
	<?php if ($staff_list->SortUrl($staff_list->SocialSecurityNo) == "") { ?>
		<th data-name="SocialSecurityNo" class="<?php echo $staff_list->SocialSecurityNo->headerCellClass() ?>"><div id="elh_staff_SocialSecurityNo" class="staff_SocialSecurityNo"><div class="ew-table-header-caption"><?php echo $staff_list->SocialSecurityNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SocialSecurityNo" class="<?php echo $staff_list->SocialSecurityNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->SocialSecurityNo) ?>', 1);"><div id="elh_staff_SocialSecurityNo" class="staff_SocialSecurityNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->SocialSecurityNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staff_list->SocialSecurityNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->SocialSecurityNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staff_list->ThirdParties->Visible) { // ThirdParties ?>
	<?php if ($staff_list->SortUrl($staff_list->ThirdParties) == "") { ?>
		<th data-name="ThirdParties" class="<?php echo $staff_list->ThirdParties->headerCellClass() ?>"><div id="elh_staff_ThirdParties" class="staff_ThirdParties"><div class="ew-table-header-caption"><?php echo $staff_list->ThirdParties->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ThirdParties" class="<?php echo $staff_list->ThirdParties->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staff_list->SortUrl($staff_list->ThirdParties) ?>', 1);"><div id="elh_staff_ThirdParties" class="staff_ThirdParties">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staff_list->ThirdParties->caption() ?></span><span class="ew-table-header-sort"><?php if ($staff_list->ThirdParties->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staff_list->ThirdParties->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$staff_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($staff_list->ExportAll && $staff_list->isExport()) {
	$staff_list->StopRecord = $staff_list->TotalRecords;
} else {

	// Set the last record to display
	if ($staff_list->TotalRecords > $staff_list->StartRecord + $staff_list->DisplayRecords - 1)
		$staff_list->StopRecord = $staff_list->StartRecord + $staff_list->DisplayRecords - 1;
	else
		$staff_list->StopRecord = $staff_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($staff->isConfirm() || $staff_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($staff_list->FormKeyCountName) && ($staff_list->isGridAdd() || $staff_list->isGridEdit() || $staff->isConfirm())) {
		$staff_list->KeyCount = $CurrentForm->getValue($staff_list->FormKeyCountName);
		$staff_list->StopRecord = $staff_list->StartRecord + $staff_list->KeyCount - 1;
	}
}
$staff_list->RecordCount = $staff_list->StartRecord - 1;
if ($staff_list->Recordset && !$staff_list->Recordset->EOF) {
	$staff_list->Recordset->moveFirst();
	$selectLimit = $staff_list->UseSelectLimit;
	if (!$selectLimit && $staff_list->StartRecord > 1)
		$staff_list->Recordset->move($staff_list->StartRecord - 1);
} elseif (!$staff->AllowAddDeleteRow && $staff_list->StopRecord == 0) {
	$staff_list->StopRecord = $staff->GridAddRowCount;
}

// Initialize aggregate
$staff->RowType = ROWTYPE_AGGREGATEINIT;
$staff->resetAttributes();
$staff_list->renderRow();
if ($staff_list->isGridAdd())
	$staff_list->RowIndex = 0;
if ($staff_list->isGridEdit())
	$staff_list->RowIndex = 0;
while ($staff_list->RecordCount < $staff_list->StopRecord) {
	$staff_list->RecordCount++;
	if ($staff_list->RecordCount >= $staff_list->StartRecord) {
		$staff_list->RowCount++;
		if ($staff_list->isGridAdd() || $staff_list->isGridEdit() || $staff->isConfirm()) {
			$staff_list->RowIndex++;
			$CurrentForm->Index = $staff_list->RowIndex;
			if ($CurrentForm->hasValue($staff_list->FormActionName) && ($staff->isConfirm() || $staff_list->EventCancelled))
				$staff_list->RowAction = strval($CurrentForm->getValue($staff_list->FormActionName));
			elseif ($staff_list->isGridAdd())
				$staff_list->RowAction = "insert";
			else
				$staff_list->RowAction = "";
		}

		// Set up key count
		$staff_list->KeyCount = $staff_list->RowIndex;

		// Init row class and style
		$staff->resetAttributes();
		$staff->CssClass = "";
		if ($staff_list->isGridAdd()) {
			$staff_list->loadRowValues(); // Load default values
		} else {
			$staff_list->loadRowValues($staff_list->Recordset); // Load row values
		}
		$staff->RowType = ROWTYPE_VIEW; // Render view
		if ($staff_list->isGridAdd()) // Grid add
			$staff->RowType = ROWTYPE_ADD; // Render add
		if ($staff_list->isGridAdd() && $staff->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$staff_list->restoreCurrentRowFormValues($staff_list->RowIndex); // Restore form values
		if ($staff_list->isGridEdit()) { // Grid edit
			if ($staff->EventCancelled)
				$staff_list->restoreCurrentRowFormValues($staff_list->RowIndex); // Restore form values
			if ($staff_list->RowAction == "insert")
				$staff->RowType = ROWTYPE_ADD; // Render add
			else
				$staff->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($staff_list->isGridEdit() && ($staff->RowType == ROWTYPE_EDIT || $staff->RowType == ROWTYPE_ADD) && $staff->EventCancelled) // Update failed
			$staff_list->restoreCurrentRowFormValues($staff_list->RowIndex); // Restore form values
		if ($staff->RowType == ROWTYPE_EDIT) // Edit row
			$staff_list->EditRowCount++;

		// Set up row id / data-rowindex
		$staff->RowAttrs->merge(["data-rowindex" => $staff_list->RowCount, "id" => "r" . $staff_list->RowCount . "_staff", "data-rowtype" => $staff->RowType]);

		// Render row
		$staff_list->renderRow();

		// Render list options
		$staff_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($staff_list->RowAction != "delete" && $staff_list->RowAction != "insertdelete" && !($staff_list->RowAction == "insert" && $staff->isConfirm() && $staff_list->emptyRow())) {
?>
	<tr <?php echo $staff->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staff_list->ListOptions->render("body", "left", $staff_list->RowCount);
?>
	<?php if ($staff_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $staff_list->EmployeeID->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_EmployeeID" class="form-group"></span>
<input type="hidden" data-table="staff" data-field="x_EmployeeID" name="o<?php echo $staff_list->RowIndex ?>_EmployeeID" id="o<?php echo $staff_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staff_list->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_EmployeeID" class="form-group">
<span<?php echo $staff_list->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staff_list->EmployeeID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="staff" data-field="x_EmployeeID" name="x<?php echo $staff_list->RowIndex ?>_EmployeeID" id="x<?php echo $staff_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staff_list->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_EmployeeID">
<span<?php echo $staff_list->EmployeeID->viewAttributes() ?>><?php echo $staff_list->EmployeeID->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $staff_list->LACode->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_LACode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staff_list->RowIndex ?>_LACode"><?php echo EmptyValue(strval($staff_list->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_list->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_list->LACode->ReadOnly || $staff_list->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staff_list->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_list->LACode->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_LACode") ?>
<input type="hidden" data-table="staff" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $staff_list->RowIndex ?>_LACode" id="x<?php echo $staff_list->RowIndex ?>_LACode" value="<?php echo $staff_list->LACode->CurrentValue ?>"<?php echo $staff_list->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_LACode" name="o<?php echo $staff_list->RowIndex ?>_LACode" id="o<?php echo $staff_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($staff_list->LACode->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_LACode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staff_list->RowIndex ?>_LACode"><?php echo EmptyValue(strval($staff_list->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_list->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_list->LACode->ReadOnly || $staff_list->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staff_list->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_list->LACode->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_LACode") ?>
<input type="hidden" data-table="staff" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $staff_list->RowIndex ?>_LACode" id="x<?php echo $staff_list->RowIndex ?>_LACode" value="<?php echo $staff_list->LACode->CurrentValue ?>"<?php echo $staff_list->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_LACode">
<span<?php echo $staff_list->LACode->viewAttributes() ?>><?php echo $staff_list->LACode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->FormerFileNumber->Visible) { // FormerFileNumber ?>
		<td data-name="FormerFileNumber" <?php echo $staff_list->FormerFileNumber->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_FormerFileNumber" class="form-group">
<input type="text" data-table="staff" data-field="x_FormerFileNumber" name="x<?php echo $staff_list->RowIndex ?>_FormerFileNumber" id="x<?php echo $staff_list->RowIndex ?>_FormerFileNumber" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($staff_list->FormerFileNumber->getPlaceHolder()) ?>" value="<?php echo $staff_list->FormerFileNumber->EditValue ?>"<?php echo $staff_list->FormerFileNumber->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_FormerFileNumber" name="o<?php echo $staff_list->RowIndex ?>_FormerFileNumber" id="o<?php echo $staff_list->RowIndex ?>_FormerFileNumber" value="<?php echo HtmlEncode($staff_list->FormerFileNumber->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_FormerFileNumber" class="form-group">
<input type="text" data-table="staff" data-field="x_FormerFileNumber" name="x<?php echo $staff_list->RowIndex ?>_FormerFileNumber" id="x<?php echo $staff_list->RowIndex ?>_FormerFileNumber" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($staff_list->FormerFileNumber->getPlaceHolder()) ?>" value="<?php echo $staff_list->FormerFileNumber->EditValue ?>"<?php echo $staff_list->FormerFileNumber->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_FormerFileNumber">
<span<?php echo $staff_list->FormerFileNumber->viewAttributes() ?>><?php echo $staff_list->FormerFileNumber->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->NRC->Visible) { // NRC ?>
		<td data-name="NRC" <?php echo $staff_list->NRC->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_NRC" class="form-group">
<input type="text" data-table="staff" data-field="x_NRC" name="x<?php echo $staff_list->RowIndex ?>_NRC" id="x<?php echo $staff_list->RowIndex ?>_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($staff_list->NRC->getPlaceHolder()) ?>" value="<?php echo $staff_list->NRC->EditValue ?>"<?php echo $staff_list->NRC->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_NRC" name="o<?php echo $staff_list->RowIndex ?>_NRC" id="o<?php echo $staff_list->RowIndex ?>_NRC" value="<?php echo HtmlEncode($staff_list->NRC->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_NRC" class="form-group">
<input type="text" data-table="staff" data-field="x_NRC" name="x<?php echo $staff_list->RowIndex ?>_NRC" id="x<?php echo $staff_list->RowIndex ?>_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($staff_list->NRC->getPlaceHolder()) ?>" value="<?php echo $staff_list->NRC->EditValue ?>"<?php echo $staff_list->NRC->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_NRC">
<span<?php echo $staff_list->NRC->viewAttributes() ?>><?php echo $staff_list->NRC->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->Title->Visible) { // Title ?>
		<td data-name="Title" <?php echo $staff_list->Title->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_Title" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_Title" data-value-separator="<?php echo $staff_list->Title->displayValueSeparatorAttribute() ?>" id="x<?php echo $staff_list->RowIndex ?>_Title" name="x<?php echo $staff_list->RowIndex ?>_Title"<?php echo $staff_list->Title->editAttributes() ?>>
			<?php echo $staff_list->Title->selectOptionListHtml("x{$staff_list->RowIndex}_Title") ?>
		</select>
</div>
<?php echo $staff_list->Title->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_Title") ?>
</span>
<input type="hidden" data-table="staff" data-field="x_Title" name="o<?php echo $staff_list->RowIndex ?>_Title" id="o<?php echo $staff_list->RowIndex ?>_Title" value="<?php echo HtmlEncode($staff_list->Title->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_Title" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_Title" data-value-separator="<?php echo $staff_list->Title->displayValueSeparatorAttribute() ?>" id="x<?php echo $staff_list->RowIndex ?>_Title" name="x<?php echo $staff_list->RowIndex ?>_Title"<?php echo $staff_list->Title->editAttributes() ?>>
			<?php echo $staff_list->Title->selectOptionListHtml("x{$staff_list->RowIndex}_Title") ?>
		</select>
</div>
<?php echo $staff_list->Title->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_Title") ?>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_Title">
<span<?php echo $staff_list->Title->viewAttributes() ?>><?php echo $staff_list->Title->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $staff_list->Surname->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_Surname" class="form-group">
<input type="text" data-table="staff" data-field="x_Surname" name="x<?php echo $staff_list->RowIndex ?>_Surname" id="x<?php echo $staff_list->RowIndex ?>_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($staff_list->Surname->getPlaceHolder()) ?>" value="<?php echo $staff_list->Surname->EditValue ?>"<?php echo $staff_list->Surname->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_Surname" name="o<?php echo $staff_list->RowIndex ?>_Surname" id="o<?php echo $staff_list->RowIndex ?>_Surname" value="<?php echo HtmlEncode($staff_list->Surname->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_Surname" class="form-group">
<input type="text" data-table="staff" data-field="x_Surname" name="x<?php echo $staff_list->RowIndex ?>_Surname" id="x<?php echo $staff_list->RowIndex ?>_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($staff_list->Surname->getPlaceHolder()) ?>" value="<?php echo $staff_list->Surname->EditValue ?>"<?php echo $staff_list->Surname->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_Surname">
<span<?php echo $staff_list->Surname->viewAttributes() ?>><?php echo $staff_list->Surname->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $staff_list->FirstName->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_FirstName" class="form-group">
<input type="text" data-table="staff" data-field="x_FirstName" name="x<?php echo $staff_list->RowIndex ?>_FirstName" id="x<?php echo $staff_list->RowIndex ?>_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($staff_list->FirstName->getPlaceHolder()) ?>" value="<?php echo $staff_list->FirstName->EditValue ?>"<?php echo $staff_list->FirstName->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_FirstName" name="o<?php echo $staff_list->RowIndex ?>_FirstName" id="o<?php echo $staff_list->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($staff_list->FirstName->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_FirstName" class="form-group">
<input type="text" data-table="staff" data-field="x_FirstName" name="x<?php echo $staff_list->RowIndex ?>_FirstName" id="x<?php echo $staff_list->RowIndex ?>_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($staff_list->FirstName->getPlaceHolder()) ?>" value="<?php echo $staff_list->FirstName->EditValue ?>"<?php echo $staff_list->FirstName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_FirstName">
<span<?php echo $staff_list->FirstName->viewAttributes() ?>><?php echo $staff_list->FirstName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $staff_list->MiddleName->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_MiddleName" class="form-group">
<input type="text" data-table="staff" data-field="x_MiddleName" name="x<?php echo $staff_list->RowIndex ?>_MiddleName" id="x<?php echo $staff_list->RowIndex ?>_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($staff_list->MiddleName->getPlaceHolder()) ?>" value="<?php echo $staff_list->MiddleName->EditValue ?>"<?php echo $staff_list->MiddleName->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_MiddleName" name="o<?php echo $staff_list->RowIndex ?>_MiddleName" id="o<?php echo $staff_list->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($staff_list->MiddleName->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_MiddleName" class="form-group">
<input type="text" data-table="staff" data-field="x_MiddleName" name="x<?php echo $staff_list->RowIndex ?>_MiddleName" id="x<?php echo $staff_list->RowIndex ?>_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($staff_list->MiddleName->getPlaceHolder()) ?>" value="<?php echo $staff_list->MiddleName->EditValue ?>"<?php echo $staff_list->MiddleName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_MiddleName">
<span<?php echo $staff_list->MiddleName->viewAttributes() ?>><?php echo $staff_list->MiddleName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->Sex->Visible) { // Sex ?>
		<td data-name="Sex" <?php echo $staff_list->Sex->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_Sex" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_Sex" data-value-separator="<?php echo $staff_list->Sex->displayValueSeparatorAttribute() ?>" id="x<?php echo $staff_list->RowIndex ?>_Sex" name="x<?php echo $staff_list->RowIndex ?>_Sex"<?php echo $staff_list->Sex->editAttributes() ?>>
			<?php echo $staff_list->Sex->selectOptionListHtml("x{$staff_list->RowIndex}_Sex") ?>
		</select>
</div>
<?php echo $staff_list->Sex->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_Sex") ?>
</span>
<input type="hidden" data-table="staff" data-field="x_Sex" name="o<?php echo $staff_list->RowIndex ?>_Sex" id="o<?php echo $staff_list->RowIndex ?>_Sex" value="<?php echo HtmlEncode($staff_list->Sex->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_Sex" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_Sex" data-value-separator="<?php echo $staff_list->Sex->displayValueSeparatorAttribute() ?>" id="x<?php echo $staff_list->RowIndex ?>_Sex" name="x<?php echo $staff_list->RowIndex ?>_Sex"<?php echo $staff_list->Sex->editAttributes() ?>>
			<?php echo $staff_list->Sex->selectOptionListHtml("x{$staff_list->RowIndex}_Sex") ?>
		</select>
</div>
<?php echo $staff_list->Sex->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_Sex") ?>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_Sex">
<span<?php echo $staff_list->Sex->viewAttributes() ?>><?php echo $staff_list->Sex->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->MaritalStatus->Visible) { // MaritalStatus ?>
		<td data-name="MaritalStatus" <?php echo $staff_list->MaritalStatus->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_MaritalStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_MaritalStatus" data-value-separator="<?php echo $staff_list->MaritalStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $staff_list->RowIndex ?>_MaritalStatus" name="x<?php echo $staff_list->RowIndex ?>_MaritalStatus"<?php echo $staff_list->MaritalStatus->editAttributes() ?>>
			<?php echo $staff_list->MaritalStatus->selectOptionListHtml("x{$staff_list->RowIndex}_MaritalStatus") ?>
		</select>
</div>
<?php echo $staff_list->MaritalStatus->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_MaritalStatus") ?>
</span>
<input type="hidden" data-table="staff" data-field="x_MaritalStatus" name="o<?php echo $staff_list->RowIndex ?>_MaritalStatus" id="o<?php echo $staff_list->RowIndex ?>_MaritalStatus" value="<?php echo HtmlEncode($staff_list->MaritalStatus->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_MaritalStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_MaritalStatus" data-value-separator="<?php echo $staff_list->MaritalStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $staff_list->RowIndex ?>_MaritalStatus" name="x<?php echo $staff_list->RowIndex ?>_MaritalStatus"<?php echo $staff_list->MaritalStatus->editAttributes() ?>>
			<?php echo $staff_list->MaritalStatus->selectOptionListHtml("x{$staff_list->RowIndex}_MaritalStatus") ?>
		</select>
</div>
<?php echo $staff_list->MaritalStatus->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_MaritalStatus") ?>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_MaritalStatus">
<span<?php echo $staff_list->MaritalStatus->viewAttributes() ?>><?php echo $staff_list->MaritalStatus->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->MaidenName->Visible) { // MaidenName ?>
		<td data-name="MaidenName" <?php echo $staff_list->MaidenName->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_MaidenName" class="form-group">
<input type="text" data-table="staff" data-field="x_MaidenName" name="x<?php echo $staff_list->RowIndex ?>_MaidenName" id="x<?php echo $staff_list->RowIndex ?>_MaidenName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($staff_list->MaidenName->getPlaceHolder()) ?>" value="<?php echo $staff_list->MaidenName->EditValue ?>"<?php echo $staff_list->MaidenName->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_MaidenName" name="o<?php echo $staff_list->RowIndex ?>_MaidenName" id="o<?php echo $staff_list->RowIndex ?>_MaidenName" value="<?php echo HtmlEncode($staff_list->MaidenName->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_MaidenName" class="form-group">
<input type="text" data-table="staff" data-field="x_MaidenName" name="x<?php echo $staff_list->RowIndex ?>_MaidenName" id="x<?php echo $staff_list->RowIndex ?>_MaidenName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($staff_list->MaidenName->getPlaceHolder()) ?>" value="<?php echo $staff_list->MaidenName->EditValue ?>"<?php echo $staff_list->MaidenName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_MaidenName">
<span<?php echo $staff_list->MaidenName->viewAttributes() ?>><?php echo $staff_list->MaidenName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->DateOfBirth->Visible) { // DateOfBirth ?>
		<td data-name="DateOfBirth" <?php echo $staff_list->DateOfBirth->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_DateOfBirth" class="form-group">
<input type="text" data-table="staff" data-field="x_DateOfBirth" name="x<?php echo $staff_list->RowIndex ?>_DateOfBirth" id="x<?php echo $staff_list->RowIndex ?>_DateOfBirth" placeholder="<?php echo HtmlEncode($staff_list->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $staff_list->DateOfBirth->EditValue ?>"<?php echo $staff_list->DateOfBirth->editAttributes() ?>>
<?php if (!$staff_list->DateOfBirth->ReadOnly && !$staff_list->DateOfBirth->Disabled && !isset($staff_list->DateOfBirth->EditAttrs["readonly"]) && !isset($staff_list->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstafflist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstafflist", "x<?php echo $staff_list->RowIndex ?>_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staff" data-field="x_DateOfBirth" name="o<?php echo $staff_list->RowIndex ?>_DateOfBirth" id="o<?php echo $staff_list->RowIndex ?>_DateOfBirth" value="<?php echo HtmlEncode($staff_list->DateOfBirth->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_DateOfBirth" class="form-group">
<input type="text" data-table="staff" data-field="x_DateOfBirth" name="x<?php echo $staff_list->RowIndex ?>_DateOfBirth" id="x<?php echo $staff_list->RowIndex ?>_DateOfBirth" placeholder="<?php echo HtmlEncode($staff_list->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $staff_list->DateOfBirth->EditValue ?>"<?php echo $staff_list->DateOfBirth->editAttributes() ?>>
<?php if (!$staff_list->DateOfBirth->ReadOnly && !$staff_list->DateOfBirth->Disabled && !isset($staff_list->DateOfBirth->EditAttrs["readonly"]) && !isset($staff_list->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstafflist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstafflist", "x<?php echo $staff_list->RowIndex ?>_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_DateOfBirth">
<span<?php echo $staff_list->DateOfBirth->viewAttributes() ?>><?php echo $staff_list->DateOfBirth->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->AcademicQualification->Visible) { // AcademicQualification ?>
		<td data-name="AcademicQualification" <?php echo $staff_list->AcademicQualification->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_AcademicQualification" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staff_list->RowIndex ?>_AcademicQualification"><?php echo EmptyValue(strval($staff_list->AcademicQualification->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_list->AcademicQualification->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_list->AcademicQualification->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_list->AcademicQualification->ReadOnly || $staff_list->AcademicQualification->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staff_list->RowIndex ?>_AcademicQualification',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_list->AcademicQualification->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_AcademicQualification") ?>
<input type="hidden" data-table="staff" data-field="x_AcademicQualification" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_list->AcademicQualification->displayValueSeparatorAttribute() ?>" name="x<?php echo $staff_list->RowIndex ?>_AcademicQualification" id="x<?php echo $staff_list->RowIndex ?>_AcademicQualification" value="<?php echo $staff_list->AcademicQualification->CurrentValue ?>"<?php echo $staff_list->AcademicQualification->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_AcademicQualification" name="o<?php echo $staff_list->RowIndex ?>_AcademicQualification" id="o<?php echo $staff_list->RowIndex ?>_AcademicQualification" value="<?php echo HtmlEncode($staff_list->AcademicQualification->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_AcademicQualification" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staff_list->RowIndex ?>_AcademicQualification"><?php echo EmptyValue(strval($staff_list->AcademicQualification->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_list->AcademicQualification->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_list->AcademicQualification->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_list->AcademicQualification->ReadOnly || $staff_list->AcademicQualification->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staff_list->RowIndex ?>_AcademicQualification',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_list->AcademicQualification->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_AcademicQualification") ?>
<input type="hidden" data-table="staff" data-field="x_AcademicQualification" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_list->AcademicQualification->displayValueSeparatorAttribute() ?>" name="x<?php echo $staff_list->RowIndex ?>_AcademicQualification" id="x<?php echo $staff_list->RowIndex ?>_AcademicQualification" value="<?php echo $staff_list->AcademicQualification->CurrentValue ?>"<?php echo $staff_list->AcademicQualification->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_AcademicQualification">
<span<?php echo $staff_list->AcademicQualification->viewAttributes() ?>><?php echo $staff_list->AcademicQualification->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->ProfessionalQualification->Visible) { // ProfessionalQualification ?>
		<td data-name="ProfessionalQualification" <?php echo $staff_list->ProfessionalQualification->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_ProfessionalQualification" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staff_list->RowIndex ?>_ProfessionalQualification"><?php echo EmptyValue(strval($staff_list->ProfessionalQualification->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_list->ProfessionalQualification->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_list->ProfessionalQualification->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_list->ProfessionalQualification->ReadOnly || $staff_list->ProfessionalQualification->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staff_list->RowIndex ?>_ProfessionalQualification',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_list->ProfessionalQualification->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_ProfessionalQualification") ?>
<input type="hidden" data-table="staff" data-field="x_ProfessionalQualification" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_list->ProfessionalQualification->displayValueSeparatorAttribute() ?>" name="x<?php echo $staff_list->RowIndex ?>_ProfessionalQualification" id="x<?php echo $staff_list->RowIndex ?>_ProfessionalQualification" value="<?php echo $staff_list->ProfessionalQualification->CurrentValue ?>"<?php echo $staff_list->ProfessionalQualification->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_ProfessionalQualification" name="o<?php echo $staff_list->RowIndex ?>_ProfessionalQualification" id="o<?php echo $staff_list->RowIndex ?>_ProfessionalQualification" value="<?php echo HtmlEncode($staff_list->ProfessionalQualification->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_ProfessionalQualification" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staff_list->RowIndex ?>_ProfessionalQualification"><?php echo EmptyValue(strval($staff_list->ProfessionalQualification->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_list->ProfessionalQualification->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_list->ProfessionalQualification->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_list->ProfessionalQualification->ReadOnly || $staff_list->ProfessionalQualification->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staff_list->RowIndex ?>_ProfessionalQualification',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_list->ProfessionalQualification->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_ProfessionalQualification") ?>
<input type="hidden" data-table="staff" data-field="x_ProfessionalQualification" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_list->ProfessionalQualification->displayValueSeparatorAttribute() ?>" name="x<?php echo $staff_list->RowIndex ?>_ProfessionalQualification" id="x<?php echo $staff_list->RowIndex ?>_ProfessionalQualification" value="<?php echo $staff_list->ProfessionalQualification->CurrentValue ?>"<?php echo $staff_list->ProfessionalQualification->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_ProfessionalQualification">
<span<?php echo $staff_list->ProfessionalQualification->viewAttributes() ?>><?php echo $staff_list->ProfessionalQualification->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->MedicalCondition->Visible) { // MedicalCondition ?>
		<td data-name="MedicalCondition" <?php echo $staff_list->MedicalCondition->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_MedicalCondition" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_MedicalCondition" data-value-separator="<?php echo $staff_list->MedicalCondition->displayValueSeparatorAttribute() ?>" id="x<?php echo $staff_list->RowIndex ?>_MedicalCondition" name="x<?php echo $staff_list->RowIndex ?>_MedicalCondition"<?php echo $staff_list->MedicalCondition->editAttributes() ?>>
			<?php echo $staff_list->MedicalCondition->selectOptionListHtml("x{$staff_list->RowIndex}_MedicalCondition") ?>
		</select>
</div>
<?php echo $staff_list->MedicalCondition->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_MedicalCondition") ?>
</span>
<input type="hidden" data-table="staff" data-field="x_MedicalCondition" name="o<?php echo $staff_list->RowIndex ?>_MedicalCondition" id="o<?php echo $staff_list->RowIndex ?>_MedicalCondition" value="<?php echo HtmlEncode($staff_list->MedicalCondition->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_MedicalCondition" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_MedicalCondition" data-value-separator="<?php echo $staff_list->MedicalCondition->displayValueSeparatorAttribute() ?>" id="x<?php echo $staff_list->RowIndex ?>_MedicalCondition" name="x<?php echo $staff_list->RowIndex ?>_MedicalCondition"<?php echo $staff_list->MedicalCondition->editAttributes() ?>>
			<?php echo $staff_list->MedicalCondition->selectOptionListHtml("x{$staff_list->RowIndex}_MedicalCondition") ?>
		</select>
</div>
<?php echo $staff_list->MedicalCondition->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_MedicalCondition") ?>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_MedicalCondition">
<span<?php echo $staff_list->MedicalCondition->viewAttributes() ?>><?php echo $staff_list->MedicalCondition->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->OtherMedicalConditions->Visible) { // OtherMedicalConditions ?>
		<td data-name="OtherMedicalConditions" <?php echo $staff_list->OtherMedicalConditions->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_OtherMedicalConditions" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_OtherMedicalConditions" data-value-separator="<?php echo $staff_list->OtherMedicalConditions->displayValueSeparatorAttribute() ?>" id="x<?php echo $staff_list->RowIndex ?>_OtherMedicalConditions" name="x<?php echo $staff_list->RowIndex ?>_OtherMedicalConditions"<?php echo $staff_list->OtherMedicalConditions->editAttributes() ?>>
			<?php echo $staff_list->OtherMedicalConditions->selectOptionListHtml("x{$staff_list->RowIndex}_OtherMedicalConditions") ?>
		</select>
</div>
<?php echo $staff_list->OtherMedicalConditions->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_OtherMedicalConditions") ?>
</span>
<input type="hidden" data-table="staff" data-field="x_OtherMedicalConditions" name="o<?php echo $staff_list->RowIndex ?>_OtherMedicalConditions" id="o<?php echo $staff_list->RowIndex ?>_OtherMedicalConditions" value="<?php echo HtmlEncode($staff_list->OtherMedicalConditions->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_OtherMedicalConditions" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_OtherMedicalConditions" data-value-separator="<?php echo $staff_list->OtherMedicalConditions->displayValueSeparatorAttribute() ?>" id="x<?php echo $staff_list->RowIndex ?>_OtherMedicalConditions" name="x<?php echo $staff_list->RowIndex ?>_OtherMedicalConditions"<?php echo $staff_list->OtherMedicalConditions->editAttributes() ?>>
			<?php echo $staff_list->OtherMedicalConditions->selectOptionListHtml("x{$staff_list->RowIndex}_OtherMedicalConditions") ?>
		</select>
</div>
<?php echo $staff_list->OtherMedicalConditions->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_OtherMedicalConditions") ?>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_OtherMedicalConditions">
<span<?php echo $staff_list->OtherMedicalConditions->viewAttributes() ?>><?php echo $staff_list->OtherMedicalConditions->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->PhysicalChallenge->Visible) { // PhysicalChallenge ?>
		<td data-name="PhysicalChallenge" <?php echo $staff_list->PhysicalChallenge->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_PhysicalChallenge" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_PhysicalChallenge" data-value-separator="<?php echo $staff_list->PhysicalChallenge->displayValueSeparatorAttribute() ?>" id="x<?php echo $staff_list->RowIndex ?>_PhysicalChallenge" name="x<?php echo $staff_list->RowIndex ?>_PhysicalChallenge"<?php echo $staff_list->PhysicalChallenge->editAttributes() ?>>
			<?php echo $staff_list->PhysicalChallenge->selectOptionListHtml("x{$staff_list->RowIndex}_PhysicalChallenge") ?>
		</select>
</div>
<?php echo $staff_list->PhysicalChallenge->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_PhysicalChallenge") ?>
</span>
<input type="hidden" data-table="staff" data-field="x_PhysicalChallenge" name="o<?php echo $staff_list->RowIndex ?>_PhysicalChallenge" id="o<?php echo $staff_list->RowIndex ?>_PhysicalChallenge" value="<?php echo HtmlEncode($staff_list->PhysicalChallenge->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_PhysicalChallenge" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_PhysicalChallenge" data-value-separator="<?php echo $staff_list->PhysicalChallenge->displayValueSeparatorAttribute() ?>" id="x<?php echo $staff_list->RowIndex ?>_PhysicalChallenge" name="x<?php echo $staff_list->RowIndex ?>_PhysicalChallenge"<?php echo $staff_list->PhysicalChallenge->editAttributes() ?>>
			<?php echo $staff_list->PhysicalChallenge->selectOptionListHtml("x{$staff_list->RowIndex}_PhysicalChallenge") ?>
		</select>
</div>
<?php echo $staff_list->PhysicalChallenge->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_PhysicalChallenge") ?>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_PhysicalChallenge">
<span<?php echo $staff_list->PhysicalChallenge->viewAttributes() ?>><?php echo $staff_list->PhysicalChallenge->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->PostalAddress->Visible) { // PostalAddress ?>
		<td data-name="PostalAddress" <?php echo $staff_list->PostalAddress->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_PostalAddress" class="form-group">
<input type="text" data-table="staff" data-field="x_PostalAddress" name="x<?php echo $staff_list->RowIndex ?>_PostalAddress" id="x<?php echo $staff_list->RowIndex ?>_PostalAddress" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->PostalAddress->getPlaceHolder()) ?>" value="<?php echo $staff_list->PostalAddress->EditValue ?>"<?php echo $staff_list->PostalAddress->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_PostalAddress" name="o<?php echo $staff_list->RowIndex ?>_PostalAddress" id="o<?php echo $staff_list->RowIndex ?>_PostalAddress" value="<?php echo HtmlEncode($staff_list->PostalAddress->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_PostalAddress" class="form-group">
<input type="text" data-table="staff" data-field="x_PostalAddress" name="x<?php echo $staff_list->RowIndex ?>_PostalAddress" id="x<?php echo $staff_list->RowIndex ?>_PostalAddress" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->PostalAddress->getPlaceHolder()) ?>" value="<?php echo $staff_list->PostalAddress->EditValue ?>"<?php echo $staff_list->PostalAddress->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_PostalAddress">
<span<?php echo $staff_list->PostalAddress->viewAttributes() ?>><?php echo $staff_list->PostalAddress->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->PhysicalAddress->Visible) { // PhysicalAddress ?>
		<td data-name="PhysicalAddress" <?php echo $staff_list->PhysicalAddress->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_PhysicalAddress" class="form-group">
<input type="text" data-table="staff" data-field="x_PhysicalAddress" name="x<?php echo $staff_list->RowIndex ?>_PhysicalAddress" id="x<?php echo $staff_list->RowIndex ?>_PhysicalAddress" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->PhysicalAddress->getPlaceHolder()) ?>" value="<?php echo $staff_list->PhysicalAddress->EditValue ?>"<?php echo $staff_list->PhysicalAddress->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_PhysicalAddress" name="o<?php echo $staff_list->RowIndex ?>_PhysicalAddress" id="o<?php echo $staff_list->RowIndex ?>_PhysicalAddress" value="<?php echo HtmlEncode($staff_list->PhysicalAddress->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_PhysicalAddress" class="form-group">
<input type="text" data-table="staff" data-field="x_PhysicalAddress" name="x<?php echo $staff_list->RowIndex ?>_PhysicalAddress" id="x<?php echo $staff_list->RowIndex ?>_PhysicalAddress" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->PhysicalAddress->getPlaceHolder()) ?>" value="<?php echo $staff_list->PhysicalAddress->EditValue ?>"<?php echo $staff_list->PhysicalAddress->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_PhysicalAddress">
<span<?php echo $staff_list->PhysicalAddress->viewAttributes() ?>><?php echo $staff_list->PhysicalAddress->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->TownOrVillage->Visible) { // TownOrVillage ?>
		<td data-name="TownOrVillage" <?php echo $staff_list->TownOrVillage->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_TownOrVillage" class="form-group">
<input type="text" data-table="staff" data-field="x_TownOrVillage" name="x<?php echo $staff_list->RowIndex ?>_TownOrVillage" id="x<?php echo $staff_list->RowIndex ?>_TownOrVillage" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->TownOrVillage->getPlaceHolder()) ?>" value="<?php echo $staff_list->TownOrVillage->EditValue ?>"<?php echo $staff_list->TownOrVillage->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_TownOrVillage" name="o<?php echo $staff_list->RowIndex ?>_TownOrVillage" id="o<?php echo $staff_list->RowIndex ?>_TownOrVillage" value="<?php echo HtmlEncode($staff_list->TownOrVillage->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_TownOrVillage" class="form-group">
<input type="text" data-table="staff" data-field="x_TownOrVillage" name="x<?php echo $staff_list->RowIndex ?>_TownOrVillage" id="x<?php echo $staff_list->RowIndex ?>_TownOrVillage" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->TownOrVillage->getPlaceHolder()) ?>" value="<?php echo $staff_list->TownOrVillage->EditValue ?>"<?php echo $staff_list->TownOrVillage->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_TownOrVillage">
<span<?php echo $staff_list->TownOrVillage->viewAttributes() ?>><?php echo $staff_list->TownOrVillage->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->Telephone->Visible) { // Telephone ?>
		<td data-name="Telephone" <?php echo $staff_list->Telephone->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_Telephone" class="form-group">
<input type="text" data-table="staff" data-field="x_Telephone" name="x<?php echo $staff_list->RowIndex ?>_Telephone" id="x<?php echo $staff_list->RowIndex ?>_Telephone" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->Telephone->getPlaceHolder()) ?>" value="<?php echo $staff_list->Telephone->EditValue ?>"<?php echo $staff_list->Telephone->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_Telephone" name="o<?php echo $staff_list->RowIndex ?>_Telephone" id="o<?php echo $staff_list->RowIndex ?>_Telephone" value="<?php echo HtmlEncode($staff_list->Telephone->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_Telephone" class="form-group">
<input type="text" data-table="staff" data-field="x_Telephone" name="x<?php echo $staff_list->RowIndex ?>_Telephone" id="x<?php echo $staff_list->RowIndex ?>_Telephone" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->Telephone->getPlaceHolder()) ?>" value="<?php echo $staff_list->Telephone->EditValue ?>"<?php echo $staff_list->Telephone->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_Telephone">
<span<?php echo $staff_list->Telephone->viewAttributes() ?>><?php echo $staff_list->Telephone->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->Mobile->Visible) { // Mobile ?>
		<td data-name="Mobile" <?php echo $staff_list->Mobile->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_Mobile" class="form-group">
<input type="text" data-table="staff" data-field="x_Mobile" name="x<?php echo $staff_list->RowIndex ?>_Mobile" id="x<?php echo $staff_list->RowIndex ?>_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->Mobile->getPlaceHolder()) ?>" value="<?php echo $staff_list->Mobile->EditValue ?>"<?php echo $staff_list->Mobile->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_Mobile" name="o<?php echo $staff_list->RowIndex ?>_Mobile" id="o<?php echo $staff_list->RowIndex ?>_Mobile" value="<?php echo HtmlEncode($staff_list->Mobile->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_Mobile" class="form-group">
<input type="text" data-table="staff" data-field="x_Mobile" name="x<?php echo $staff_list->RowIndex ?>_Mobile" id="x<?php echo $staff_list->RowIndex ?>_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->Mobile->getPlaceHolder()) ?>" value="<?php echo $staff_list->Mobile->EditValue ?>"<?php echo $staff_list->Mobile->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_Mobile">
<span<?php echo $staff_list->Mobile->viewAttributes() ?>><?php echo $staff_list->Mobile->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->Fax->Visible) { // Fax ?>
		<td data-name="Fax" <?php echo $staff_list->Fax->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_Fax" class="form-group">
<input type="text" data-table="staff" data-field="x_Fax" name="x<?php echo $staff_list->RowIndex ?>_Fax" id="x<?php echo $staff_list->RowIndex ?>_Fax" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($staff_list->Fax->getPlaceHolder()) ?>" value="<?php echo $staff_list->Fax->EditValue ?>"<?php echo $staff_list->Fax->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_Fax" name="o<?php echo $staff_list->RowIndex ?>_Fax" id="o<?php echo $staff_list->RowIndex ?>_Fax" value="<?php echo HtmlEncode($staff_list->Fax->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_Fax" class="form-group">
<input type="text" data-table="staff" data-field="x_Fax" name="x<?php echo $staff_list->RowIndex ?>_Fax" id="x<?php echo $staff_list->RowIndex ?>_Fax" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($staff_list->Fax->getPlaceHolder()) ?>" value="<?php echo $staff_list->Fax->EditValue ?>"<?php echo $staff_list->Fax->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_Fax">
<span<?php echo $staff_list->Fax->viewAttributes() ?>><?php echo $staff_list->Fax->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->_Email->Visible) { // Email ?>
		<td data-name="_Email" <?php echo $staff_list->_Email->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff__Email" class="form-group">
<input type="text" data-table="staff" data-field="x__Email" name="x<?php echo $staff_list->RowIndex ?>__Email" id="x<?php echo $staff_list->RowIndex ?>__Email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->_Email->getPlaceHolder()) ?>" value="<?php echo $staff_list->_Email->EditValue ?>"<?php echo $staff_list->_Email->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x__Email" name="o<?php echo $staff_list->RowIndex ?>__Email" id="o<?php echo $staff_list->RowIndex ?>__Email" value="<?php echo HtmlEncode($staff_list->_Email->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff__Email" class="form-group">
<input type="text" data-table="staff" data-field="x__Email" name="x<?php echo $staff_list->RowIndex ?>__Email" id="x<?php echo $staff_list->RowIndex ?>__Email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->_Email->getPlaceHolder()) ?>" value="<?php echo $staff_list->_Email->EditValue ?>"<?php echo $staff_list->_Email->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff__Email">
<span<?php echo $staff_list->_Email->viewAttributes() ?>><?php echo $staff_list->_Email->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->NumberOfBiologicalChildren->Visible) { // NumberOfBiologicalChildren ?>
		<td data-name="NumberOfBiologicalChildren" <?php echo $staff_list->NumberOfBiologicalChildren->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_NumberOfBiologicalChildren" class="form-group">
<input type="text" data-table="staff" data-field="x_NumberOfBiologicalChildren" name="x<?php echo $staff_list->RowIndex ?>_NumberOfBiologicalChildren" id="x<?php echo $staff_list->RowIndex ?>_NumberOfBiologicalChildren" size="30" placeholder="<?php echo HtmlEncode($staff_list->NumberOfBiologicalChildren->getPlaceHolder()) ?>" value="<?php echo $staff_list->NumberOfBiologicalChildren->EditValue ?>"<?php echo $staff_list->NumberOfBiologicalChildren->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_NumberOfBiologicalChildren" name="o<?php echo $staff_list->RowIndex ?>_NumberOfBiologicalChildren" id="o<?php echo $staff_list->RowIndex ?>_NumberOfBiologicalChildren" value="<?php echo HtmlEncode($staff_list->NumberOfBiologicalChildren->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_NumberOfBiologicalChildren" class="form-group">
<input type="text" data-table="staff" data-field="x_NumberOfBiologicalChildren" name="x<?php echo $staff_list->RowIndex ?>_NumberOfBiologicalChildren" id="x<?php echo $staff_list->RowIndex ?>_NumberOfBiologicalChildren" size="30" placeholder="<?php echo HtmlEncode($staff_list->NumberOfBiologicalChildren->getPlaceHolder()) ?>" value="<?php echo $staff_list->NumberOfBiologicalChildren->EditValue ?>"<?php echo $staff_list->NumberOfBiologicalChildren->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_NumberOfBiologicalChildren">
<span<?php echo $staff_list->NumberOfBiologicalChildren->viewAttributes() ?>><?php echo $staff_list->NumberOfBiologicalChildren->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->NumberOfDependants->Visible) { // NumberOfDependants ?>
		<td data-name="NumberOfDependants" <?php echo $staff_list->NumberOfDependants->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_NumberOfDependants" class="form-group">
<input type="text" data-table="staff" data-field="x_NumberOfDependants" name="x<?php echo $staff_list->RowIndex ?>_NumberOfDependants" id="x<?php echo $staff_list->RowIndex ?>_NumberOfDependants" size="30" placeholder="<?php echo HtmlEncode($staff_list->NumberOfDependants->getPlaceHolder()) ?>" value="<?php echo $staff_list->NumberOfDependants->EditValue ?>"<?php echo $staff_list->NumberOfDependants->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_NumberOfDependants" name="o<?php echo $staff_list->RowIndex ?>_NumberOfDependants" id="o<?php echo $staff_list->RowIndex ?>_NumberOfDependants" value="<?php echo HtmlEncode($staff_list->NumberOfDependants->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_NumberOfDependants" class="form-group">
<input type="text" data-table="staff" data-field="x_NumberOfDependants" name="x<?php echo $staff_list->RowIndex ?>_NumberOfDependants" id="x<?php echo $staff_list->RowIndex ?>_NumberOfDependants" size="30" placeholder="<?php echo HtmlEncode($staff_list->NumberOfDependants->getPlaceHolder()) ?>" value="<?php echo $staff_list->NumberOfDependants->EditValue ?>"<?php echo $staff_list->NumberOfDependants->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_NumberOfDependants">
<span<?php echo $staff_list->NumberOfDependants->viewAttributes() ?>><?php echo $staff_list->NumberOfDependants->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->NextOfKin->Visible) { // NextOfKin ?>
		<td data-name="NextOfKin" <?php echo $staff_list->NextOfKin->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_NextOfKin" class="form-group">
<input type="text" data-table="staff" data-field="x_NextOfKin" name="x<?php echo $staff_list->RowIndex ?>_NextOfKin" id="x<?php echo $staff_list->RowIndex ?>_NextOfKin" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->NextOfKin->getPlaceHolder()) ?>" value="<?php echo $staff_list->NextOfKin->EditValue ?>"<?php echo $staff_list->NextOfKin->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_NextOfKin" name="o<?php echo $staff_list->RowIndex ?>_NextOfKin" id="o<?php echo $staff_list->RowIndex ?>_NextOfKin" value="<?php echo HtmlEncode($staff_list->NextOfKin->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_NextOfKin" class="form-group">
<input type="text" data-table="staff" data-field="x_NextOfKin" name="x<?php echo $staff_list->RowIndex ?>_NextOfKin" id="x<?php echo $staff_list->RowIndex ?>_NextOfKin" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->NextOfKin->getPlaceHolder()) ?>" value="<?php echo $staff_list->NextOfKin->EditValue ?>"<?php echo $staff_list->NextOfKin->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_NextOfKin">
<span<?php echo $staff_list->NextOfKin->viewAttributes() ?>><?php echo $staff_list->NextOfKin->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->RelationshipCode->Visible) { // RelationshipCode ?>
		<td data-name="RelationshipCode" <?php echo $staff_list->RelationshipCode->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_RelationshipCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staff_list->RowIndex ?>_RelationshipCode"><?php echo EmptyValue(strval($staff_list->RelationshipCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_list->RelationshipCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_list->RelationshipCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_list->RelationshipCode->ReadOnly || $staff_list->RelationshipCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staff_list->RowIndex ?>_RelationshipCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_list->RelationshipCode->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_RelationshipCode") ?>
<input type="hidden" data-table="staff" data-field="x_RelationshipCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_list->RelationshipCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $staff_list->RowIndex ?>_RelationshipCode" id="x<?php echo $staff_list->RowIndex ?>_RelationshipCode" value="<?php echo $staff_list->RelationshipCode->CurrentValue ?>"<?php echo $staff_list->RelationshipCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_RelationshipCode" name="o<?php echo $staff_list->RowIndex ?>_RelationshipCode" id="o<?php echo $staff_list->RowIndex ?>_RelationshipCode" value="<?php echo HtmlEncode($staff_list->RelationshipCode->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_RelationshipCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staff_list->RowIndex ?>_RelationshipCode"><?php echo EmptyValue(strval($staff_list->RelationshipCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_list->RelationshipCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_list->RelationshipCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_list->RelationshipCode->ReadOnly || $staff_list->RelationshipCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staff_list->RowIndex ?>_RelationshipCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_list->RelationshipCode->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_RelationshipCode") ?>
<input type="hidden" data-table="staff" data-field="x_RelationshipCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_list->RelationshipCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $staff_list->RowIndex ?>_RelationshipCode" id="x<?php echo $staff_list->RowIndex ?>_RelationshipCode" value="<?php echo $staff_list->RelationshipCode->CurrentValue ?>"<?php echo $staff_list->RelationshipCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_RelationshipCode">
<span<?php echo $staff_list->RelationshipCode->viewAttributes() ?>><?php echo $staff_list->RelationshipCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
		<td data-name="NextOfKinMobile" <?php echo $staff_list->NextOfKinMobile->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_NextOfKinMobile" class="form-group">
<input type="text" data-table="staff" data-field="x_NextOfKinMobile" name="x<?php echo $staff_list->RowIndex ?>_NextOfKinMobile" id="x<?php echo $staff_list->RowIndex ?>_NextOfKinMobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->NextOfKinMobile->getPlaceHolder()) ?>" value="<?php echo $staff_list->NextOfKinMobile->EditValue ?>"<?php echo $staff_list->NextOfKinMobile->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_NextOfKinMobile" name="o<?php echo $staff_list->RowIndex ?>_NextOfKinMobile" id="o<?php echo $staff_list->RowIndex ?>_NextOfKinMobile" value="<?php echo HtmlEncode($staff_list->NextOfKinMobile->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_NextOfKinMobile" class="form-group">
<input type="text" data-table="staff" data-field="x_NextOfKinMobile" name="x<?php echo $staff_list->RowIndex ?>_NextOfKinMobile" id="x<?php echo $staff_list->RowIndex ?>_NextOfKinMobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->NextOfKinMobile->getPlaceHolder()) ?>" value="<?php echo $staff_list->NextOfKinMobile->EditValue ?>"<?php echo $staff_list->NextOfKinMobile->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_NextOfKinMobile">
<span<?php echo $staff_list->NextOfKinMobile->viewAttributes() ?>><?php echo $staff_list->NextOfKinMobile->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
		<td data-name="NextOfKinEmail" <?php echo $staff_list->NextOfKinEmail->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_NextOfKinEmail" class="form-group">
<input type="text" data-table="staff" data-field="x_NextOfKinEmail" name="x<?php echo $staff_list->RowIndex ?>_NextOfKinEmail" id="x<?php echo $staff_list->RowIndex ?>_NextOfKinEmail" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->NextOfKinEmail->getPlaceHolder()) ?>" value="<?php echo $staff_list->NextOfKinEmail->EditValue ?>"<?php echo $staff_list->NextOfKinEmail->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_NextOfKinEmail" name="o<?php echo $staff_list->RowIndex ?>_NextOfKinEmail" id="o<?php echo $staff_list->RowIndex ?>_NextOfKinEmail" value="<?php echo HtmlEncode($staff_list->NextOfKinEmail->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_NextOfKinEmail" class="form-group">
<input type="text" data-table="staff" data-field="x_NextOfKinEmail" name="x<?php echo $staff_list->RowIndex ?>_NextOfKinEmail" id="x<?php echo $staff_list->RowIndex ?>_NextOfKinEmail" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->NextOfKinEmail->getPlaceHolder()) ?>" value="<?php echo $staff_list->NextOfKinEmail->EditValue ?>"<?php echo $staff_list->NextOfKinEmail->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_NextOfKinEmail">
<span<?php echo $staff_list->NextOfKinEmail->viewAttributes() ?>><?php echo $staff_list->NextOfKinEmail->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->SpouseName->Visible) { // SpouseName ?>
		<td data-name="SpouseName" <?php echo $staff_list->SpouseName->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_SpouseName" class="form-group">
<input type="text" data-table="staff" data-field="x_SpouseName" name="x<?php echo $staff_list->RowIndex ?>_SpouseName" id="x<?php echo $staff_list->RowIndex ?>_SpouseName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->SpouseName->getPlaceHolder()) ?>" value="<?php echo $staff_list->SpouseName->EditValue ?>"<?php echo $staff_list->SpouseName->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_SpouseName" name="o<?php echo $staff_list->RowIndex ?>_SpouseName" id="o<?php echo $staff_list->RowIndex ?>_SpouseName" value="<?php echo HtmlEncode($staff_list->SpouseName->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_SpouseName" class="form-group">
<input type="text" data-table="staff" data-field="x_SpouseName" name="x<?php echo $staff_list->RowIndex ?>_SpouseName" id="x<?php echo $staff_list->RowIndex ?>_SpouseName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->SpouseName->getPlaceHolder()) ?>" value="<?php echo $staff_list->SpouseName->EditValue ?>"<?php echo $staff_list->SpouseName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_SpouseName">
<span<?php echo $staff_list->SpouseName->viewAttributes() ?>><?php echo $staff_list->SpouseName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->SpouseNRC->Visible) { // SpouseNRC ?>
		<td data-name="SpouseNRC" <?php echo $staff_list->SpouseNRC->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_SpouseNRC" class="form-group">
<input type="text" data-table="staff" data-field="x_SpouseNRC" name="x<?php echo $staff_list->RowIndex ?>_SpouseNRC" id="x<?php echo $staff_list->RowIndex ?>_SpouseNRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($staff_list->SpouseNRC->getPlaceHolder()) ?>" value="<?php echo $staff_list->SpouseNRC->EditValue ?>"<?php echo $staff_list->SpouseNRC->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_SpouseNRC" name="o<?php echo $staff_list->RowIndex ?>_SpouseNRC" id="o<?php echo $staff_list->RowIndex ?>_SpouseNRC" value="<?php echo HtmlEncode($staff_list->SpouseNRC->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_SpouseNRC" class="form-group">
<input type="text" data-table="staff" data-field="x_SpouseNRC" name="x<?php echo $staff_list->RowIndex ?>_SpouseNRC" id="x<?php echo $staff_list->RowIndex ?>_SpouseNRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($staff_list->SpouseNRC->getPlaceHolder()) ?>" value="<?php echo $staff_list->SpouseNRC->EditValue ?>"<?php echo $staff_list->SpouseNRC->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_SpouseNRC">
<span<?php echo $staff_list->SpouseNRC->viewAttributes() ?>><?php echo $staff_list->SpouseNRC->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->SpouseMobile->Visible) { // SpouseMobile ?>
		<td data-name="SpouseMobile" <?php echo $staff_list->SpouseMobile->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_SpouseMobile" class="form-group">
<input type="text" data-table="staff" data-field="x_SpouseMobile" name="x<?php echo $staff_list->RowIndex ?>_SpouseMobile" id="x<?php echo $staff_list->RowIndex ?>_SpouseMobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->SpouseMobile->getPlaceHolder()) ?>" value="<?php echo $staff_list->SpouseMobile->EditValue ?>"<?php echo $staff_list->SpouseMobile->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_SpouseMobile" name="o<?php echo $staff_list->RowIndex ?>_SpouseMobile" id="o<?php echo $staff_list->RowIndex ?>_SpouseMobile" value="<?php echo HtmlEncode($staff_list->SpouseMobile->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_SpouseMobile" class="form-group">
<input type="text" data-table="staff" data-field="x_SpouseMobile" name="x<?php echo $staff_list->RowIndex ?>_SpouseMobile" id="x<?php echo $staff_list->RowIndex ?>_SpouseMobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->SpouseMobile->getPlaceHolder()) ?>" value="<?php echo $staff_list->SpouseMobile->EditValue ?>"<?php echo $staff_list->SpouseMobile->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_SpouseMobile">
<span<?php echo $staff_list->SpouseMobile->viewAttributes() ?>><?php echo $staff_list->SpouseMobile->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->SpouseEmail->Visible) { // SpouseEmail ?>
		<td data-name="SpouseEmail" <?php echo $staff_list->SpouseEmail->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_SpouseEmail" class="form-group">
<input type="text" data-table="staff" data-field="x_SpouseEmail" name="x<?php echo $staff_list->RowIndex ?>_SpouseEmail" id="x<?php echo $staff_list->RowIndex ?>_SpouseEmail" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->SpouseEmail->getPlaceHolder()) ?>" value="<?php echo $staff_list->SpouseEmail->EditValue ?>"<?php echo $staff_list->SpouseEmail->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_SpouseEmail" name="o<?php echo $staff_list->RowIndex ?>_SpouseEmail" id="o<?php echo $staff_list->RowIndex ?>_SpouseEmail" value="<?php echo HtmlEncode($staff_list->SpouseEmail->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_SpouseEmail" class="form-group">
<input type="text" data-table="staff" data-field="x_SpouseEmail" name="x<?php echo $staff_list->RowIndex ?>_SpouseEmail" id="x<?php echo $staff_list->RowIndex ?>_SpouseEmail" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->SpouseEmail->getPlaceHolder()) ?>" value="<?php echo $staff_list->SpouseEmail->EditValue ?>"<?php echo $staff_list->SpouseEmail->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_SpouseEmail">
<span<?php echo $staff_list->SpouseEmail->viewAttributes() ?>><?php echo $staff_list->SpouseEmail->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->SpouseResidentialAddress->Visible) { // SpouseResidentialAddress ?>
		<td data-name="SpouseResidentialAddress" <?php echo $staff_list->SpouseResidentialAddress->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_SpouseResidentialAddress" class="form-group">
<input type="text" data-table="staff" data-field="x_SpouseResidentialAddress" name="x<?php echo $staff_list->RowIndex ?>_SpouseResidentialAddress" id="x<?php echo $staff_list->RowIndex ?>_SpouseResidentialAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->SpouseResidentialAddress->getPlaceHolder()) ?>" value="<?php echo $staff_list->SpouseResidentialAddress->EditValue ?>"<?php echo $staff_list->SpouseResidentialAddress->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_SpouseResidentialAddress" name="o<?php echo $staff_list->RowIndex ?>_SpouseResidentialAddress" id="o<?php echo $staff_list->RowIndex ?>_SpouseResidentialAddress" value="<?php echo HtmlEncode($staff_list->SpouseResidentialAddress->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_SpouseResidentialAddress" class="form-group">
<input type="text" data-table="staff" data-field="x_SpouseResidentialAddress" name="x<?php echo $staff_list->RowIndex ?>_SpouseResidentialAddress" id="x<?php echo $staff_list->RowIndex ?>_SpouseResidentialAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->SpouseResidentialAddress->getPlaceHolder()) ?>" value="<?php echo $staff_list->SpouseResidentialAddress->EditValue ?>"<?php echo $staff_list->SpouseResidentialAddress->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_SpouseResidentialAddress">
<span<?php echo $staff_list->SpouseResidentialAddress->viewAttributes() ?>><?php echo $staff_list->SpouseResidentialAddress->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->BankAccountNo->Visible) { // BankAccountNo ?>
		<td data-name="BankAccountNo" <?php echo $staff_list->BankAccountNo->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_BankAccountNo" class="form-group">
<input type="text" data-table="staff" data-field="x_BankAccountNo" name="x<?php echo $staff_list->RowIndex ?>_BankAccountNo" id="x<?php echo $staff_list->RowIndex ?>_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($staff_list->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $staff_list->BankAccountNo->EditValue ?>"<?php echo $staff_list->BankAccountNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_BankAccountNo" name="o<?php echo $staff_list->RowIndex ?>_BankAccountNo" id="o<?php echo $staff_list->RowIndex ?>_BankAccountNo" value="<?php echo HtmlEncode($staff_list->BankAccountNo->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_BankAccountNo" class="form-group">
<input type="text" data-table="staff" data-field="x_BankAccountNo" name="x<?php echo $staff_list->RowIndex ?>_BankAccountNo" id="x<?php echo $staff_list->RowIndex ?>_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($staff_list->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $staff_list->BankAccountNo->EditValue ?>"<?php echo $staff_list->BankAccountNo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_BankAccountNo">
<span<?php echo $staff_list->BankAccountNo->viewAttributes() ?>><?php echo $staff_list->BankAccountNo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->PaymentMethod->Visible) { // PaymentMethod ?>
		<td data-name="PaymentMethod" <?php echo $staff_list->PaymentMethod->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_PaymentMethod" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_PaymentMethod" data-value-separator="<?php echo $staff_list->PaymentMethod->displayValueSeparatorAttribute() ?>" id="x<?php echo $staff_list->RowIndex ?>_PaymentMethod" name="x<?php echo $staff_list->RowIndex ?>_PaymentMethod"<?php echo $staff_list->PaymentMethod->editAttributes() ?>>
			<?php echo $staff_list->PaymentMethod->selectOptionListHtml("x{$staff_list->RowIndex}_PaymentMethod") ?>
		</select>
</div>
<?php echo $staff_list->PaymentMethod->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_PaymentMethod") ?>
</span>
<input type="hidden" data-table="staff" data-field="x_PaymentMethod" name="o<?php echo $staff_list->RowIndex ?>_PaymentMethod" id="o<?php echo $staff_list->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($staff_list->PaymentMethod->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_PaymentMethod" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_PaymentMethod" data-value-separator="<?php echo $staff_list->PaymentMethod->displayValueSeparatorAttribute() ?>" id="x<?php echo $staff_list->RowIndex ?>_PaymentMethod" name="x<?php echo $staff_list->RowIndex ?>_PaymentMethod"<?php echo $staff_list->PaymentMethod->editAttributes() ?>>
			<?php echo $staff_list->PaymentMethod->selectOptionListHtml("x{$staff_list->RowIndex}_PaymentMethod") ?>
		</select>
</div>
<?php echo $staff_list->PaymentMethod->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_PaymentMethod") ?>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_PaymentMethod">
<span<?php echo $staff_list->PaymentMethod->viewAttributes() ?>><?php echo $staff_list->PaymentMethod->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->BankBranchCode->Visible) { // BankBranchCode ?>
		<td data-name="BankBranchCode" <?php echo $staff_list->BankBranchCode->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_BankBranchCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staff_list->RowIndex ?>_BankBranchCode"><?php echo EmptyValue(strval($staff_list->BankBranchCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_list->BankBranchCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_list->BankBranchCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_list->BankBranchCode->ReadOnly || $staff_list->BankBranchCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staff_list->RowIndex ?>_BankBranchCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_list->BankBranchCode->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_BankBranchCode") ?>
<input type="hidden" data-table="staff" data-field="x_BankBranchCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_list->BankBranchCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $staff_list->RowIndex ?>_BankBranchCode" id="x<?php echo $staff_list->RowIndex ?>_BankBranchCode" value="<?php echo $staff_list->BankBranchCode->CurrentValue ?>"<?php echo $staff_list->BankBranchCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_BankBranchCode" name="o<?php echo $staff_list->RowIndex ?>_BankBranchCode" id="o<?php echo $staff_list->RowIndex ?>_BankBranchCode" value="<?php echo HtmlEncode($staff_list->BankBranchCode->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_BankBranchCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staff_list->RowIndex ?>_BankBranchCode"><?php echo EmptyValue(strval($staff_list->BankBranchCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_list->BankBranchCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_list->BankBranchCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_list->BankBranchCode->ReadOnly || $staff_list->BankBranchCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staff_list->RowIndex ?>_BankBranchCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_list->BankBranchCode->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_BankBranchCode") ?>
<input type="hidden" data-table="staff" data-field="x_BankBranchCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_list->BankBranchCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $staff_list->RowIndex ?>_BankBranchCode" id="x<?php echo $staff_list->RowIndex ?>_BankBranchCode" value="<?php echo $staff_list->BankBranchCode->CurrentValue ?>"<?php echo $staff_list->BankBranchCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_BankBranchCode">
<span<?php echo $staff_list->BankBranchCode->viewAttributes() ?>><?php echo $staff_list->BankBranchCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->TaxNumber->Visible) { // TaxNumber ?>
		<td data-name="TaxNumber" <?php echo $staff_list->TaxNumber->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_TaxNumber" class="form-group">
<input type="text" data-table="staff" data-field="x_TaxNumber" name="x<?php echo $staff_list->RowIndex ?>_TaxNumber" id="x<?php echo $staff_list->RowIndex ?>_TaxNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($staff_list->TaxNumber->getPlaceHolder()) ?>" value="<?php echo $staff_list->TaxNumber->EditValue ?>"<?php echo $staff_list->TaxNumber->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_TaxNumber" name="o<?php echo $staff_list->RowIndex ?>_TaxNumber" id="o<?php echo $staff_list->RowIndex ?>_TaxNumber" value="<?php echo HtmlEncode($staff_list->TaxNumber->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_TaxNumber" class="form-group">
<input type="text" data-table="staff" data-field="x_TaxNumber" name="x<?php echo $staff_list->RowIndex ?>_TaxNumber" id="x<?php echo $staff_list->RowIndex ?>_TaxNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($staff_list->TaxNumber->getPlaceHolder()) ?>" value="<?php echo $staff_list->TaxNumber->EditValue ?>"<?php echo $staff_list->TaxNumber->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_TaxNumber">
<span<?php echo $staff_list->TaxNumber->viewAttributes() ?>><?php echo $staff_list->TaxNumber->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->PensionNumber->Visible) { // PensionNumber ?>
		<td data-name="PensionNumber" <?php echo $staff_list->PensionNumber->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_PensionNumber" class="form-group">
<input type="text" data-table="staff" data-field="x_PensionNumber" name="x<?php echo $staff_list->RowIndex ?>_PensionNumber" id="x<?php echo $staff_list->RowIndex ?>_PensionNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($staff_list->PensionNumber->getPlaceHolder()) ?>" value="<?php echo $staff_list->PensionNumber->EditValue ?>"<?php echo $staff_list->PensionNumber->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_PensionNumber" name="o<?php echo $staff_list->RowIndex ?>_PensionNumber" id="o<?php echo $staff_list->RowIndex ?>_PensionNumber" value="<?php echo HtmlEncode($staff_list->PensionNumber->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_PensionNumber" class="form-group">
<input type="text" data-table="staff" data-field="x_PensionNumber" name="x<?php echo $staff_list->RowIndex ?>_PensionNumber" id="x<?php echo $staff_list->RowIndex ?>_PensionNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($staff_list->PensionNumber->getPlaceHolder()) ?>" value="<?php echo $staff_list->PensionNumber->EditValue ?>"<?php echo $staff_list->PensionNumber->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_PensionNumber">
<span<?php echo $staff_list->PensionNumber->viewAttributes() ?>><?php echo $staff_list->PensionNumber->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
		<td data-name="SocialSecurityNo" <?php echo $staff_list->SocialSecurityNo->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_SocialSecurityNo" class="form-group">
<input type="text" data-table="staff" data-field="x_SocialSecurityNo" name="x<?php echo $staff_list->RowIndex ?>_SocialSecurityNo" id="x<?php echo $staff_list->RowIndex ?>_SocialSecurityNo" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($staff_list->SocialSecurityNo->getPlaceHolder()) ?>" value="<?php echo $staff_list->SocialSecurityNo->EditValue ?>"<?php echo $staff_list->SocialSecurityNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_SocialSecurityNo" name="o<?php echo $staff_list->RowIndex ?>_SocialSecurityNo" id="o<?php echo $staff_list->RowIndex ?>_SocialSecurityNo" value="<?php echo HtmlEncode($staff_list->SocialSecurityNo->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_SocialSecurityNo" class="form-group">
<input type="text" data-table="staff" data-field="x_SocialSecurityNo" name="x<?php echo $staff_list->RowIndex ?>_SocialSecurityNo" id="x<?php echo $staff_list->RowIndex ?>_SocialSecurityNo" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($staff_list->SocialSecurityNo->getPlaceHolder()) ?>" value="<?php echo $staff_list->SocialSecurityNo->EditValue ?>"<?php echo $staff_list->SocialSecurityNo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_SocialSecurityNo">
<span<?php echo $staff_list->SocialSecurityNo->viewAttributes() ?>><?php echo $staff_list->SocialSecurityNo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staff_list->ThirdParties->Visible) { // ThirdParties ?>
		<td data-name="ThirdParties" <?php echo $staff_list->ThirdParties->cellAttributes() ?>>
<?php if ($staff->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_ThirdParties" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staff_list->RowIndex ?>_ThirdParties"><?php echo EmptyValue(strval($staff_list->ThirdParties->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_list->ThirdParties->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_list->ThirdParties->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_list->ThirdParties->ReadOnly || $staff_list->ThirdParties->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staff_list->RowIndex ?>_ThirdParties[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_list->ThirdParties->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_ThirdParties") ?>
<input type="hidden" data-table="staff" data-field="x_ThirdParties" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $staff_list->ThirdParties->displayValueSeparatorAttribute() ?>" name="x<?php echo $staff_list->RowIndex ?>_ThirdParties[]" id="x<?php echo $staff_list->RowIndex ?>_ThirdParties[]" value="<?php echo $staff_list->ThirdParties->CurrentValue ?>"<?php echo $staff_list->ThirdParties->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_ThirdParties" name="o<?php echo $staff_list->RowIndex ?>_ThirdParties[]" id="o<?php echo $staff_list->RowIndex ?>_ThirdParties[]" value="<?php echo HtmlEncode($staff_list->ThirdParties->OldValue) ?>">
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_ThirdParties" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staff_list->RowIndex ?>_ThirdParties"><?php echo EmptyValue(strval($staff_list->ThirdParties->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_list->ThirdParties->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_list->ThirdParties->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_list->ThirdParties->ReadOnly || $staff_list->ThirdParties->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staff_list->RowIndex ?>_ThirdParties[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_list->ThirdParties->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_ThirdParties") ?>
<input type="hidden" data-table="staff" data-field="x_ThirdParties" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $staff_list->ThirdParties->displayValueSeparatorAttribute() ?>" name="x<?php echo $staff_list->RowIndex ?>_ThirdParties[]" id="x<?php echo $staff_list->RowIndex ?>_ThirdParties[]" value="<?php echo $staff_list->ThirdParties->CurrentValue ?>"<?php echo $staff_list->ThirdParties->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staff->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staff_list->RowCount ?>_staff_ThirdParties">
<span<?php echo $staff_list->ThirdParties->viewAttributes() ?>><?php echo $staff_list->ThirdParties->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staff_list->ListOptions->render("body", "right", $staff_list->RowCount);
?>
	</tr>
<?php if ($staff->RowType == ROWTYPE_ADD || $staff->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fstafflist", "load"], function() {
	fstafflist.updateLists(<?php echo $staff_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$staff_list->isGridAdd())
		if (!$staff_list->Recordset->EOF)
			$staff_list->Recordset->moveNext();
}
?>
<?php
	if ($staff_list->isGridAdd() || $staff_list->isGridEdit()) {
		$staff_list->RowIndex = '$rowindex$';
		$staff_list->loadRowValues();

		// Set row properties
		$staff->resetAttributes();
		$staff->RowAttrs->merge(["data-rowindex" => $staff_list->RowIndex, "id" => "r0_staff", "data-rowtype" => ROWTYPE_ADD]);
		$staff->RowAttrs->appendClass("ew-template");
		$staff->RowType = ROWTYPE_ADD;

		// Render row
		$staff_list->renderRow();

		// Render list options
		$staff_list->renderListOptions();
		$staff_list->StartRowCount = 0;
?>
	<tr <?php echo $staff->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staff_list->ListOptions->render("body", "left", $staff_list->RowIndex);
?>
	<?php if ($staff_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID">
<span id="el$rowindex$_staff_EmployeeID" class="form-group staff_EmployeeID"></span>
<input type="hidden" data-table="staff" data-field="x_EmployeeID" name="o<?php echo $staff_list->RowIndex ?>_EmployeeID" id="o<?php echo $staff_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staff_list->EmployeeID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<span id="el$rowindex$_staff_LACode" class="form-group staff_LACode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staff_list->RowIndex ?>_LACode"><?php echo EmptyValue(strval($staff_list->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_list->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_list->LACode->ReadOnly || $staff_list->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staff_list->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_list->LACode->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_LACode") ?>
<input type="hidden" data-table="staff" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $staff_list->RowIndex ?>_LACode" id="x<?php echo $staff_list->RowIndex ?>_LACode" value="<?php echo $staff_list->LACode->CurrentValue ?>"<?php echo $staff_list->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_LACode" name="o<?php echo $staff_list->RowIndex ?>_LACode" id="o<?php echo $staff_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($staff_list->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->FormerFileNumber->Visible) { // FormerFileNumber ?>
		<td data-name="FormerFileNumber">
<span id="el$rowindex$_staff_FormerFileNumber" class="form-group staff_FormerFileNumber">
<input type="text" data-table="staff" data-field="x_FormerFileNumber" name="x<?php echo $staff_list->RowIndex ?>_FormerFileNumber" id="x<?php echo $staff_list->RowIndex ?>_FormerFileNumber" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($staff_list->FormerFileNumber->getPlaceHolder()) ?>" value="<?php echo $staff_list->FormerFileNumber->EditValue ?>"<?php echo $staff_list->FormerFileNumber->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_FormerFileNumber" name="o<?php echo $staff_list->RowIndex ?>_FormerFileNumber" id="o<?php echo $staff_list->RowIndex ?>_FormerFileNumber" value="<?php echo HtmlEncode($staff_list->FormerFileNumber->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->NRC->Visible) { // NRC ?>
		<td data-name="NRC">
<span id="el$rowindex$_staff_NRC" class="form-group staff_NRC">
<input type="text" data-table="staff" data-field="x_NRC" name="x<?php echo $staff_list->RowIndex ?>_NRC" id="x<?php echo $staff_list->RowIndex ?>_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($staff_list->NRC->getPlaceHolder()) ?>" value="<?php echo $staff_list->NRC->EditValue ?>"<?php echo $staff_list->NRC->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_NRC" name="o<?php echo $staff_list->RowIndex ?>_NRC" id="o<?php echo $staff_list->RowIndex ?>_NRC" value="<?php echo HtmlEncode($staff_list->NRC->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->Title->Visible) { // Title ?>
		<td data-name="Title">
<span id="el$rowindex$_staff_Title" class="form-group staff_Title">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_Title" data-value-separator="<?php echo $staff_list->Title->displayValueSeparatorAttribute() ?>" id="x<?php echo $staff_list->RowIndex ?>_Title" name="x<?php echo $staff_list->RowIndex ?>_Title"<?php echo $staff_list->Title->editAttributes() ?>>
			<?php echo $staff_list->Title->selectOptionListHtml("x{$staff_list->RowIndex}_Title") ?>
		</select>
</div>
<?php echo $staff_list->Title->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_Title") ?>
</span>
<input type="hidden" data-table="staff" data-field="x_Title" name="o<?php echo $staff_list->RowIndex ?>_Title" id="o<?php echo $staff_list->RowIndex ?>_Title" value="<?php echo HtmlEncode($staff_list->Title->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname">
<span id="el$rowindex$_staff_Surname" class="form-group staff_Surname">
<input type="text" data-table="staff" data-field="x_Surname" name="x<?php echo $staff_list->RowIndex ?>_Surname" id="x<?php echo $staff_list->RowIndex ?>_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($staff_list->Surname->getPlaceHolder()) ?>" value="<?php echo $staff_list->Surname->EditValue ?>"<?php echo $staff_list->Surname->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_Surname" name="o<?php echo $staff_list->RowIndex ?>_Surname" id="o<?php echo $staff_list->RowIndex ?>_Surname" value="<?php echo HtmlEncode($staff_list->Surname->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName">
<span id="el$rowindex$_staff_FirstName" class="form-group staff_FirstName">
<input type="text" data-table="staff" data-field="x_FirstName" name="x<?php echo $staff_list->RowIndex ?>_FirstName" id="x<?php echo $staff_list->RowIndex ?>_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($staff_list->FirstName->getPlaceHolder()) ?>" value="<?php echo $staff_list->FirstName->EditValue ?>"<?php echo $staff_list->FirstName->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_FirstName" name="o<?php echo $staff_list->RowIndex ?>_FirstName" id="o<?php echo $staff_list->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($staff_list->FirstName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName">
<span id="el$rowindex$_staff_MiddleName" class="form-group staff_MiddleName">
<input type="text" data-table="staff" data-field="x_MiddleName" name="x<?php echo $staff_list->RowIndex ?>_MiddleName" id="x<?php echo $staff_list->RowIndex ?>_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($staff_list->MiddleName->getPlaceHolder()) ?>" value="<?php echo $staff_list->MiddleName->EditValue ?>"<?php echo $staff_list->MiddleName->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_MiddleName" name="o<?php echo $staff_list->RowIndex ?>_MiddleName" id="o<?php echo $staff_list->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($staff_list->MiddleName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->Sex->Visible) { // Sex ?>
		<td data-name="Sex">
<span id="el$rowindex$_staff_Sex" class="form-group staff_Sex">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_Sex" data-value-separator="<?php echo $staff_list->Sex->displayValueSeparatorAttribute() ?>" id="x<?php echo $staff_list->RowIndex ?>_Sex" name="x<?php echo $staff_list->RowIndex ?>_Sex"<?php echo $staff_list->Sex->editAttributes() ?>>
			<?php echo $staff_list->Sex->selectOptionListHtml("x{$staff_list->RowIndex}_Sex") ?>
		</select>
</div>
<?php echo $staff_list->Sex->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_Sex") ?>
</span>
<input type="hidden" data-table="staff" data-field="x_Sex" name="o<?php echo $staff_list->RowIndex ?>_Sex" id="o<?php echo $staff_list->RowIndex ?>_Sex" value="<?php echo HtmlEncode($staff_list->Sex->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->MaritalStatus->Visible) { // MaritalStatus ?>
		<td data-name="MaritalStatus">
<span id="el$rowindex$_staff_MaritalStatus" class="form-group staff_MaritalStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_MaritalStatus" data-value-separator="<?php echo $staff_list->MaritalStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $staff_list->RowIndex ?>_MaritalStatus" name="x<?php echo $staff_list->RowIndex ?>_MaritalStatus"<?php echo $staff_list->MaritalStatus->editAttributes() ?>>
			<?php echo $staff_list->MaritalStatus->selectOptionListHtml("x{$staff_list->RowIndex}_MaritalStatus") ?>
		</select>
</div>
<?php echo $staff_list->MaritalStatus->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_MaritalStatus") ?>
</span>
<input type="hidden" data-table="staff" data-field="x_MaritalStatus" name="o<?php echo $staff_list->RowIndex ?>_MaritalStatus" id="o<?php echo $staff_list->RowIndex ?>_MaritalStatus" value="<?php echo HtmlEncode($staff_list->MaritalStatus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->MaidenName->Visible) { // MaidenName ?>
		<td data-name="MaidenName">
<span id="el$rowindex$_staff_MaidenName" class="form-group staff_MaidenName">
<input type="text" data-table="staff" data-field="x_MaidenName" name="x<?php echo $staff_list->RowIndex ?>_MaidenName" id="x<?php echo $staff_list->RowIndex ?>_MaidenName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($staff_list->MaidenName->getPlaceHolder()) ?>" value="<?php echo $staff_list->MaidenName->EditValue ?>"<?php echo $staff_list->MaidenName->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_MaidenName" name="o<?php echo $staff_list->RowIndex ?>_MaidenName" id="o<?php echo $staff_list->RowIndex ?>_MaidenName" value="<?php echo HtmlEncode($staff_list->MaidenName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->DateOfBirth->Visible) { // DateOfBirth ?>
		<td data-name="DateOfBirth">
<span id="el$rowindex$_staff_DateOfBirth" class="form-group staff_DateOfBirth">
<input type="text" data-table="staff" data-field="x_DateOfBirth" name="x<?php echo $staff_list->RowIndex ?>_DateOfBirth" id="x<?php echo $staff_list->RowIndex ?>_DateOfBirth" placeholder="<?php echo HtmlEncode($staff_list->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $staff_list->DateOfBirth->EditValue ?>"<?php echo $staff_list->DateOfBirth->editAttributes() ?>>
<?php if (!$staff_list->DateOfBirth->ReadOnly && !$staff_list->DateOfBirth->Disabled && !isset($staff_list->DateOfBirth->EditAttrs["readonly"]) && !isset($staff_list->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstafflist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstafflist", "x<?php echo $staff_list->RowIndex ?>_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staff" data-field="x_DateOfBirth" name="o<?php echo $staff_list->RowIndex ?>_DateOfBirth" id="o<?php echo $staff_list->RowIndex ?>_DateOfBirth" value="<?php echo HtmlEncode($staff_list->DateOfBirth->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->AcademicQualification->Visible) { // AcademicQualification ?>
		<td data-name="AcademicQualification">
<span id="el$rowindex$_staff_AcademicQualification" class="form-group staff_AcademicQualification">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staff_list->RowIndex ?>_AcademicQualification"><?php echo EmptyValue(strval($staff_list->AcademicQualification->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_list->AcademicQualification->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_list->AcademicQualification->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_list->AcademicQualification->ReadOnly || $staff_list->AcademicQualification->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staff_list->RowIndex ?>_AcademicQualification',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_list->AcademicQualification->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_AcademicQualification") ?>
<input type="hidden" data-table="staff" data-field="x_AcademicQualification" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_list->AcademicQualification->displayValueSeparatorAttribute() ?>" name="x<?php echo $staff_list->RowIndex ?>_AcademicQualification" id="x<?php echo $staff_list->RowIndex ?>_AcademicQualification" value="<?php echo $staff_list->AcademicQualification->CurrentValue ?>"<?php echo $staff_list->AcademicQualification->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_AcademicQualification" name="o<?php echo $staff_list->RowIndex ?>_AcademicQualification" id="o<?php echo $staff_list->RowIndex ?>_AcademicQualification" value="<?php echo HtmlEncode($staff_list->AcademicQualification->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->ProfessionalQualification->Visible) { // ProfessionalQualification ?>
		<td data-name="ProfessionalQualification">
<span id="el$rowindex$_staff_ProfessionalQualification" class="form-group staff_ProfessionalQualification">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staff_list->RowIndex ?>_ProfessionalQualification"><?php echo EmptyValue(strval($staff_list->ProfessionalQualification->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_list->ProfessionalQualification->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_list->ProfessionalQualification->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_list->ProfessionalQualification->ReadOnly || $staff_list->ProfessionalQualification->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staff_list->RowIndex ?>_ProfessionalQualification',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_list->ProfessionalQualification->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_ProfessionalQualification") ?>
<input type="hidden" data-table="staff" data-field="x_ProfessionalQualification" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_list->ProfessionalQualification->displayValueSeparatorAttribute() ?>" name="x<?php echo $staff_list->RowIndex ?>_ProfessionalQualification" id="x<?php echo $staff_list->RowIndex ?>_ProfessionalQualification" value="<?php echo $staff_list->ProfessionalQualification->CurrentValue ?>"<?php echo $staff_list->ProfessionalQualification->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_ProfessionalQualification" name="o<?php echo $staff_list->RowIndex ?>_ProfessionalQualification" id="o<?php echo $staff_list->RowIndex ?>_ProfessionalQualification" value="<?php echo HtmlEncode($staff_list->ProfessionalQualification->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->MedicalCondition->Visible) { // MedicalCondition ?>
		<td data-name="MedicalCondition">
<span id="el$rowindex$_staff_MedicalCondition" class="form-group staff_MedicalCondition">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_MedicalCondition" data-value-separator="<?php echo $staff_list->MedicalCondition->displayValueSeparatorAttribute() ?>" id="x<?php echo $staff_list->RowIndex ?>_MedicalCondition" name="x<?php echo $staff_list->RowIndex ?>_MedicalCondition"<?php echo $staff_list->MedicalCondition->editAttributes() ?>>
			<?php echo $staff_list->MedicalCondition->selectOptionListHtml("x{$staff_list->RowIndex}_MedicalCondition") ?>
		</select>
</div>
<?php echo $staff_list->MedicalCondition->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_MedicalCondition") ?>
</span>
<input type="hidden" data-table="staff" data-field="x_MedicalCondition" name="o<?php echo $staff_list->RowIndex ?>_MedicalCondition" id="o<?php echo $staff_list->RowIndex ?>_MedicalCondition" value="<?php echo HtmlEncode($staff_list->MedicalCondition->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->OtherMedicalConditions->Visible) { // OtherMedicalConditions ?>
		<td data-name="OtherMedicalConditions">
<span id="el$rowindex$_staff_OtherMedicalConditions" class="form-group staff_OtherMedicalConditions">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_OtherMedicalConditions" data-value-separator="<?php echo $staff_list->OtherMedicalConditions->displayValueSeparatorAttribute() ?>" id="x<?php echo $staff_list->RowIndex ?>_OtherMedicalConditions" name="x<?php echo $staff_list->RowIndex ?>_OtherMedicalConditions"<?php echo $staff_list->OtherMedicalConditions->editAttributes() ?>>
			<?php echo $staff_list->OtherMedicalConditions->selectOptionListHtml("x{$staff_list->RowIndex}_OtherMedicalConditions") ?>
		</select>
</div>
<?php echo $staff_list->OtherMedicalConditions->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_OtherMedicalConditions") ?>
</span>
<input type="hidden" data-table="staff" data-field="x_OtherMedicalConditions" name="o<?php echo $staff_list->RowIndex ?>_OtherMedicalConditions" id="o<?php echo $staff_list->RowIndex ?>_OtherMedicalConditions" value="<?php echo HtmlEncode($staff_list->OtherMedicalConditions->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->PhysicalChallenge->Visible) { // PhysicalChallenge ?>
		<td data-name="PhysicalChallenge">
<span id="el$rowindex$_staff_PhysicalChallenge" class="form-group staff_PhysicalChallenge">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_PhysicalChallenge" data-value-separator="<?php echo $staff_list->PhysicalChallenge->displayValueSeparatorAttribute() ?>" id="x<?php echo $staff_list->RowIndex ?>_PhysicalChallenge" name="x<?php echo $staff_list->RowIndex ?>_PhysicalChallenge"<?php echo $staff_list->PhysicalChallenge->editAttributes() ?>>
			<?php echo $staff_list->PhysicalChallenge->selectOptionListHtml("x{$staff_list->RowIndex}_PhysicalChallenge") ?>
		</select>
</div>
<?php echo $staff_list->PhysicalChallenge->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_PhysicalChallenge") ?>
</span>
<input type="hidden" data-table="staff" data-field="x_PhysicalChallenge" name="o<?php echo $staff_list->RowIndex ?>_PhysicalChallenge" id="o<?php echo $staff_list->RowIndex ?>_PhysicalChallenge" value="<?php echo HtmlEncode($staff_list->PhysicalChallenge->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->PostalAddress->Visible) { // PostalAddress ?>
		<td data-name="PostalAddress">
<span id="el$rowindex$_staff_PostalAddress" class="form-group staff_PostalAddress">
<input type="text" data-table="staff" data-field="x_PostalAddress" name="x<?php echo $staff_list->RowIndex ?>_PostalAddress" id="x<?php echo $staff_list->RowIndex ?>_PostalAddress" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->PostalAddress->getPlaceHolder()) ?>" value="<?php echo $staff_list->PostalAddress->EditValue ?>"<?php echo $staff_list->PostalAddress->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_PostalAddress" name="o<?php echo $staff_list->RowIndex ?>_PostalAddress" id="o<?php echo $staff_list->RowIndex ?>_PostalAddress" value="<?php echo HtmlEncode($staff_list->PostalAddress->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->PhysicalAddress->Visible) { // PhysicalAddress ?>
		<td data-name="PhysicalAddress">
<span id="el$rowindex$_staff_PhysicalAddress" class="form-group staff_PhysicalAddress">
<input type="text" data-table="staff" data-field="x_PhysicalAddress" name="x<?php echo $staff_list->RowIndex ?>_PhysicalAddress" id="x<?php echo $staff_list->RowIndex ?>_PhysicalAddress" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->PhysicalAddress->getPlaceHolder()) ?>" value="<?php echo $staff_list->PhysicalAddress->EditValue ?>"<?php echo $staff_list->PhysicalAddress->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_PhysicalAddress" name="o<?php echo $staff_list->RowIndex ?>_PhysicalAddress" id="o<?php echo $staff_list->RowIndex ?>_PhysicalAddress" value="<?php echo HtmlEncode($staff_list->PhysicalAddress->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->TownOrVillage->Visible) { // TownOrVillage ?>
		<td data-name="TownOrVillage">
<span id="el$rowindex$_staff_TownOrVillage" class="form-group staff_TownOrVillage">
<input type="text" data-table="staff" data-field="x_TownOrVillage" name="x<?php echo $staff_list->RowIndex ?>_TownOrVillage" id="x<?php echo $staff_list->RowIndex ?>_TownOrVillage" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->TownOrVillage->getPlaceHolder()) ?>" value="<?php echo $staff_list->TownOrVillage->EditValue ?>"<?php echo $staff_list->TownOrVillage->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_TownOrVillage" name="o<?php echo $staff_list->RowIndex ?>_TownOrVillage" id="o<?php echo $staff_list->RowIndex ?>_TownOrVillage" value="<?php echo HtmlEncode($staff_list->TownOrVillage->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->Telephone->Visible) { // Telephone ?>
		<td data-name="Telephone">
<span id="el$rowindex$_staff_Telephone" class="form-group staff_Telephone">
<input type="text" data-table="staff" data-field="x_Telephone" name="x<?php echo $staff_list->RowIndex ?>_Telephone" id="x<?php echo $staff_list->RowIndex ?>_Telephone" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->Telephone->getPlaceHolder()) ?>" value="<?php echo $staff_list->Telephone->EditValue ?>"<?php echo $staff_list->Telephone->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_Telephone" name="o<?php echo $staff_list->RowIndex ?>_Telephone" id="o<?php echo $staff_list->RowIndex ?>_Telephone" value="<?php echo HtmlEncode($staff_list->Telephone->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->Mobile->Visible) { // Mobile ?>
		<td data-name="Mobile">
<span id="el$rowindex$_staff_Mobile" class="form-group staff_Mobile">
<input type="text" data-table="staff" data-field="x_Mobile" name="x<?php echo $staff_list->RowIndex ?>_Mobile" id="x<?php echo $staff_list->RowIndex ?>_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->Mobile->getPlaceHolder()) ?>" value="<?php echo $staff_list->Mobile->EditValue ?>"<?php echo $staff_list->Mobile->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_Mobile" name="o<?php echo $staff_list->RowIndex ?>_Mobile" id="o<?php echo $staff_list->RowIndex ?>_Mobile" value="<?php echo HtmlEncode($staff_list->Mobile->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->Fax->Visible) { // Fax ?>
		<td data-name="Fax">
<span id="el$rowindex$_staff_Fax" class="form-group staff_Fax">
<input type="text" data-table="staff" data-field="x_Fax" name="x<?php echo $staff_list->RowIndex ?>_Fax" id="x<?php echo $staff_list->RowIndex ?>_Fax" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($staff_list->Fax->getPlaceHolder()) ?>" value="<?php echo $staff_list->Fax->EditValue ?>"<?php echo $staff_list->Fax->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_Fax" name="o<?php echo $staff_list->RowIndex ?>_Fax" id="o<?php echo $staff_list->RowIndex ?>_Fax" value="<?php echo HtmlEncode($staff_list->Fax->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->_Email->Visible) { // Email ?>
		<td data-name="_Email">
<span id="el$rowindex$_staff__Email" class="form-group staff__Email">
<input type="text" data-table="staff" data-field="x__Email" name="x<?php echo $staff_list->RowIndex ?>__Email" id="x<?php echo $staff_list->RowIndex ?>__Email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->_Email->getPlaceHolder()) ?>" value="<?php echo $staff_list->_Email->EditValue ?>"<?php echo $staff_list->_Email->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x__Email" name="o<?php echo $staff_list->RowIndex ?>__Email" id="o<?php echo $staff_list->RowIndex ?>__Email" value="<?php echo HtmlEncode($staff_list->_Email->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->NumberOfBiologicalChildren->Visible) { // NumberOfBiologicalChildren ?>
		<td data-name="NumberOfBiologicalChildren">
<span id="el$rowindex$_staff_NumberOfBiologicalChildren" class="form-group staff_NumberOfBiologicalChildren">
<input type="text" data-table="staff" data-field="x_NumberOfBiologicalChildren" name="x<?php echo $staff_list->RowIndex ?>_NumberOfBiologicalChildren" id="x<?php echo $staff_list->RowIndex ?>_NumberOfBiologicalChildren" size="30" placeholder="<?php echo HtmlEncode($staff_list->NumberOfBiologicalChildren->getPlaceHolder()) ?>" value="<?php echo $staff_list->NumberOfBiologicalChildren->EditValue ?>"<?php echo $staff_list->NumberOfBiologicalChildren->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_NumberOfBiologicalChildren" name="o<?php echo $staff_list->RowIndex ?>_NumberOfBiologicalChildren" id="o<?php echo $staff_list->RowIndex ?>_NumberOfBiologicalChildren" value="<?php echo HtmlEncode($staff_list->NumberOfBiologicalChildren->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->NumberOfDependants->Visible) { // NumberOfDependants ?>
		<td data-name="NumberOfDependants">
<span id="el$rowindex$_staff_NumberOfDependants" class="form-group staff_NumberOfDependants">
<input type="text" data-table="staff" data-field="x_NumberOfDependants" name="x<?php echo $staff_list->RowIndex ?>_NumberOfDependants" id="x<?php echo $staff_list->RowIndex ?>_NumberOfDependants" size="30" placeholder="<?php echo HtmlEncode($staff_list->NumberOfDependants->getPlaceHolder()) ?>" value="<?php echo $staff_list->NumberOfDependants->EditValue ?>"<?php echo $staff_list->NumberOfDependants->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_NumberOfDependants" name="o<?php echo $staff_list->RowIndex ?>_NumberOfDependants" id="o<?php echo $staff_list->RowIndex ?>_NumberOfDependants" value="<?php echo HtmlEncode($staff_list->NumberOfDependants->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->NextOfKin->Visible) { // NextOfKin ?>
		<td data-name="NextOfKin">
<span id="el$rowindex$_staff_NextOfKin" class="form-group staff_NextOfKin">
<input type="text" data-table="staff" data-field="x_NextOfKin" name="x<?php echo $staff_list->RowIndex ?>_NextOfKin" id="x<?php echo $staff_list->RowIndex ?>_NextOfKin" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->NextOfKin->getPlaceHolder()) ?>" value="<?php echo $staff_list->NextOfKin->EditValue ?>"<?php echo $staff_list->NextOfKin->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_NextOfKin" name="o<?php echo $staff_list->RowIndex ?>_NextOfKin" id="o<?php echo $staff_list->RowIndex ?>_NextOfKin" value="<?php echo HtmlEncode($staff_list->NextOfKin->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->RelationshipCode->Visible) { // RelationshipCode ?>
		<td data-name="RelationshipCode">
<span id="el$rowindex$_staff_RelationshipCode" class="form-group staff_RelationshipCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staff_list->RowIndex ?>_RelationshipCode"><?php echo EmptyValue(strval($staff_list->RelationshipCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_list->RelationshipCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_list->RelationshipCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_list->RelationshipCode->ReadOnly || $staff_list->RelationshipCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staff_list->RowIndex ?>_RelationshipCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_list->RelationshipCode->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_RelationshipCode") ?>
<input type="hidden" data-table="staff" data-field="x_RelationshipCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_list->RelationshipCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $staff_list->RowIndex ?>_RelationshipCode" id="x<?php echo $staff_list->RowIndex ?>_RelationshipCode" value="<?php echo $staff_list->RelationshipCode->CurrentValue ?>"<?php echo $staff_list->RelationshipCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_RelationshipCode" name="o<?php echo $staff_list->RowIndex ?>_RelationshipCode" id="o<?php echo $staff_list->RowIndex ?>_RelationshipCode" value="<?php echo HtmlEncode($staff_list->RelationshipCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
		<td data-name="NextOfKinMobile">
<span id="el$rowindex$_staff_NextOfKinMobile" class="form-group staff_NextOfKinMobile">
<input type="text" data-table="staff" data-field="x_NextOfKinMobile" name="x<?php echo $staff_list->RowIndex ?>_NextOfKinMobile" id="x<?php echo $staff_list->RowIndex ?>_NextOfKinMobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->NextOfKinMobile->getPlaceHolder()) ?>" value="<?php echo $staff_list->NextOfKinMobile->EditValue ?>"<?php echo $staff_list->NextOfKinMobile->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_NextOfKinMobile" name="o<?php echo $staff_list->RowIndex ?>_NextOfKinMobile" id="o<?php echo $staff_list->RowIndex ?>_NextOfKinMobile" value="<?php echo HtmlEncode($staff_list->NextOfKinMobile->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
		<td data-name="NextOfKinEmail">
<span id="el$rowindex$_staff_NextOfKinEmail" class="form-group staff_NextOfKinEmail">
<input type="text" data-table="staff" data-field="x_NextOfKinEmail" name="x<?php echo $staff_list->RowIndex ?>_NextOfKinEmail" id="x<?php echo $staff_list->RowIndex ?>_NextOfKinEmail" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->NextOfKinEmail->getPlaceHolder()) ?>" value="<?php echo $staff_list->NextOfKinEmail->EditValue ?>"<?php echo $staff_list->NextOfKinEmail->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_NextOfKinEmail" name="o<?php echo $staff_list->RowIndex ?>_NextOfKinEmail" id="o<?php echo $staff_list->RowIndex ?>_NextOfKinEmail" value="<?php echo HtmlEncode($staff_list->NextOfKinEmail->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->SpouseName->Visible) { // SpouseName ?>
		<td data-name="SpouseName">
<span id="el$rowindex$_staff_SpouseName" class="form-group staff_SpouseName">
<input type="text" data-table="staff" data-field="x_SpouseName" name="x<?php echo $staff_list->RowIndex ?>_SpouseName" id="x<?php echo $staff_list->RowIndex ?>_SpouseName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->SpouseName->getPlaceHolder()) ?>" value="<?php echo $staff_list->SpouseName->EditValue ?>"<?php echo $staff_list->SpouseName->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_SpouseName" name="o<?php echo $staff_list->RowIndex ?>_SpouseName" id="o<?php echo $staff_list->RowIndex ?>_SpouseName" value="<?php echo HtmlEncode($staff_list->SpouseName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->SpouseNRC->Visible) { // SpouseNRC ?>
		<td data-name="SpouseNRC">
<span id="el$rowindex$_staff_SpouseNRC" class="form-group staff_SpouseNRC">
<input type="text" data-table="staff" data-field="x_SpouseNRC" name="x<?php echo $staff_list->RowIndex ?>_SpouseNRC" id="x<?php echo $staff_list->RowIndex ?>_SpouseNRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($staff_list->SpouseNRC->getPlaceHolder()) ?>" value="<?php echo $staff_list->SpouseNRC->EditValue ?>"<?php echo $staff_list->SpouseNRC->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_SpouseNRC" name="o<?php echo $staff_list->RowIndex ?>_SpouseNRC" id="o<?php echo $staff_list->RowIndex ?>_SpouseNRC" value="<?php echo HtmlEncode($staff_list->SpouseNRC->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->SpouseMobile->Visible) { // SpouseMobile ?>
		<td data-name="SpouseMobile">
<span id="el$rowindex$_staff_SpouseMobile" class="form-group staff_SpouseMobile">
<input type="text" data-table="staff" data-field="x_SpouseMobile" name="x<?php echo $staff_list->RowIndex ?>_SpouseMobile" id="x<?php echo $staff_list->RowIndex ?>_SpouseMobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->SpouseMobile->getPlaceHolder()) ?>" value="<?php echo $staff_list->SpouseMobile->EditValue ?>"<?php echo $staff_list->SpouseMobile->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_SpouseMobile" name="o<?php echo $staff_list->RowIndex ?>_SpouseMobile" id="o<?php echo $staff_list->RowIndex ?>_SpouseMobile" value="<?php echo HtmlEncode($staff_list->SpouseMobile->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->SpouseEmail->Visible) { // SpouseEmail ?>
		<td data-name="SpouseEmail">
<span id="el$rowindex$_staff_SpouseEmail" class="form-group staff_SpouseEmail">
<input type="text" data-table="staff" data-field="x_SpouseEmail" name="x<?php echo $staff_list->RowIndex ?>_SpouseEmail" id="x<?php echo $staff_list->RowIndex ?>_SpouseEmail" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->SpouseEmail->getPlaceHolder()) ?>" value="<?php echo $staff_list->SpouseEmail->EditValue ?>"<?php echo $staff_list->SpouseEmail->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_SpouseEmail" name="o<?php echo $staff_list->RowIndex ?>_SpouseEmail" id="o<?php echo $staff_list->RowIndex ?>_SpouseEmail" value="<?php echo HtmlEncode($staff_list->SpouseEmail->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->SpouseResidentialAddress->Visible) { // SpouseResidentialAddress ?>
		<td data-name="SpouseResidentialAddress">
<span id="el$rowindex$_staff_SpouseResidentialAddress" class="form-group staff_SpouseResidentialAddress">
<input type="text" data-table="staff" data-field="x_SpouseResidentialAddress" name="x<?php echo $staff_list->RowIndex ?>_SpouseResidentialAddress" id="x<?php echo $staff_list->RowIndex ?>_SpouseResidentialAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_list->SpouseResidentialAddress->getPlaceHolder()) ?>" value="<?php echo $staff_list->SpouseResidentialAddress->EditValue ?>"<?php echo $staff_list->SpouseResidentialAddress->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_SpouseResidentialAddress" name="o<?php echo $staff_list->RowIndex ?>_SpouseResidentialAddress" id="o<?php echo $staff_list->RowIndex ?>_SpouseResidentialAddress" value="<?php echo HtmlEncode($staff_list->SpouseResidentialAddress->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->BankAccountNo->Visible) { // BankAccountNo ?>
		<td data-name="BankAccountNo">
<span id="el$rowindex$_staff_BankAccountNo" class="form-group staff_BankAccountNo">
<input type="text" data-table="staff" data-field="x_BankAccountNo" name="x<?php echo $staff_list->RowIndex ?>_BankAccountNo" id="x<?php echo $staff_list->RowIndex ?>_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($staff_list->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $staff_list->BankAccountNo->EditValue ?>"<?php echo $staff_list->BankAccountNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_BankAccountNo" name="o<?php echo $staff_list->RowIndex ?>_BankAccountNo" id="o<?php echo $staff_list->RowIndex ?>_BankAccountNo" value="<?php echo HtmlEncode($staff_list->BankAccountNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->PaymentMethod->Visible) { // PaymentMethod ?>
		<td data-name="PaymentMethod">
<span id="el$rowindex$_staff_PaymentMethod" class="form-group staff_PaymentMethod">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_PaymentMethod" data-value-separator="<?php echo $staff_list->PaymentMethod->displayValueSeparatorAttribute() ?>" id="x<?php echo $staff_list->RowIndex ?>_PaymentMethod" name="x<?php echo $staff_list->RowIndex ?>_PaymentMethod"<?php echo $staff_list->PaymentMethod->editAttributes() ?>>
			<?php echo $staff_list->PaymentMethod->selectOptionListHtml("x{$staff_list->RowIndex}_PaymentMethod") ?>
		</select>
</div>
<?php echo $staff_list->PaymentMethod->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_PaymentMethod") ?>
</span>
<input type="hidden" data-table="staff" data-field="x_PaymentMethod" name="o<?php echo $staff_list->RowIndex ?>_PaymentMethod" id="o<?php echo $staff_list->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($staff_list->PaymentMethod->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->BankBranchCode->Visible) { // BankBranchCode ?>
		<td data-name="BankBranchCode">
<span id="el$rowindex$_staff_BankBranchCode" class="form-group staff_BankBranchCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staff_list->RowIndex ?>_BankBranchCode"><?php echo EmptyValue(strval($staff_list->BankBranchCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_list->BankBranchCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_list->BankBranchCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_list->BankBranchCode->ReadOnly || $staff_list->BankBranchCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staff_list->RowIndex ?>_BankBranchCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_list->BankBranchCode->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_BankBranchCode") ?>
<input type="hidden" data-table="staff" data-field="x_BankBranchCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_list->BankBranchCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $staff_list->RowIndex ?>_BankBranchCode" id="x<?php echo $staff_list->RowIndex ?>_BankBranchCode" value="<?php echo $staff_list->BankBranchCode->CurrentValue ?>"<?php echo $staff_list->BankBranchCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_BankBranchCode" name="o<?php echo $staff_list->RowIndex ?>_BankBranchCode" id="o<?php echo $staff_list->RowIndex ?>_BankBranchCode" value="<?php echo HtmlEncode($staff_list->BankBranchCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->TaxNumber->Visible) { // TaxNumber ?>
		<td data-name="TaxNumber">
<span id="el$rowindex$_staff_TaxNumber" class="form-group staff_TaxNumber">
<input type="text" data-table="staff" data-field="x_TaxNumber" name="x<?php echo $staff_list->RowIndex ?>_TaxNumber" id="x<?php echo $staff_list->RowIndex ?>_TaxNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($staff_list->TaxNumber->getPlaceHolder()) ?>" value="<?php echo $staff_list->TaxNumber->EditValue ?>"<?php echo $staff_list->TaxNumber->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_TaxNumber" name="o<?php echo $staff_list->RowIndex ?>_TaxNumber" id="o<?php echo $staff_list->RowIndex ?>_TaxNumber" value="<?php echo HtmlEncode($staff_list->TaxNumber->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->PensionNumber->Visible) { // PensionNumber ?>
		<td data-name="PensionNumber">
<span id="el$rowindex$_staff_PensionNumber" class="form-group staff_PensionNumber">
<input type="text" data-table="staff" data-field="x_PensionNumber" name="x<?php echo $staff_list->RowIndex ?>_PensionNumber" id="x<?php echo $staff_list->RowIndex ?>_PensionNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($staff_list->PensionNumber->getPlaceHolder()) ?>" value="<?php echo $staff_list->PensionNumber->EditValue ?>"<?php echo $staff_list->PensionNumber->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_PensionNumber" name="o<?php echo $staff_list->RowIndex ?>_PensionNumber" id="o<?php echo $staff_list->RowIndex ?>_PensionNumber" value="<?php echo HtmlEncode($staff_list->PensionNumber->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
		<td data-name="SocialSecurityNo">
<span id="el$rowindex$_staff_SocialSecurityNo" class="form-group staff_SocialSecurityNo">
<input type="text" data-table="staff" data-field="x_SocialSecurityNo" name="x<?php echo $staff_list->RowIndex ?>_SocialSecurityNo" id="x<?php echo $staff_list->RowIndex ?>_SocialSecurityNo" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($staff_list->SocialSecurityNo->getPlaceHolder()) ?>" value="<?php echo $staff_list->SocialSecurityNo->EditValue ?>"<?php echo $staff_list->SocialSecurityNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_SocialSecurityNo" name="o<?php echo $staff_list->RowIndex ?>_SocialSecurityNo" id="o<?php echo $staff_list->RowIndex ?>_SocialSecurityNo" value="<?php echo HtmlEncode($staff_list->SocialSecurityNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staff_list->ThirdParties->Visible) { // ThirdParties ?>
		<td data-name="ThirdParties">
<span id="el$rowindex$_staff_ThirdParties" class="form-group staff_ThirdParties">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staff_list->RowIndex ?>_ThirdParties"><?php echo EmptyValue(strval($staff_list->ThirdParties->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_list->ThirdParties->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_list->ThirdParties->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_list->ThirdParties->ReadOnly || $staff_list->ThirdParties->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staff_list->RowIndex ?>_ThirdParties[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_list->ThirdParties->Lookup->getParamTag($staff_list, "p_x" . $staff_list->RowIndex . "_ThirdParties") ?>
<input type="hidden" data-table="staff" data-field="x_ThirdParties" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $staff_list->ThirdParties->displayValueSeparatorAttribute() ?>" name="x<?php echo $staff_list->RowIndex ?>_ThirdParties[]" id="x<?php echo $staff_list->RowIndex ?>_ThirdParties[]" value="<?php echo $staff_list->ThirdParties->CurrentValue ?>"<?php echo $staff_list->ThirdParties->editAttributes() ?>>
</span>
<input type="hidden" data-table="staff" data-field="x_ThirdParties" name="o<?php echo $staff_list->RowIndex ?>_ThirdParties[]" id="o<?php echo $staff_list->RowIndex ?>_ThirdParties[]" value="<?php echo HtmlEncode($staff_list->ThirdParties->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staff_list->ListOptions->render("body", "right", $staff_list->RowIndex);
?>
<script>
loadjs.ready(["fstafflist", "load"], function() {
	fstafflist.updateLists(<?php echo $staff_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($staff_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $staff_list->FormKeyCountName ?>" id="<?php echo $staff_list->FormKeyCountName ?>" value="<?php echo $staff_list->KeyCount ?>">
<?php echo $staff_list->MultiSelectKey ?>
<?php } ?>
<?php if ($staff_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $staff_list->FormKeyCountName ?>" id="<?php echo $staff_list->FormKeyCountName ?>" value="<?php echo $staff_list->KeyCount ?>">
<?php echo $staff_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$staff->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($staff_list->Recordset)
	$staff_list->Recordset->Close();
?>
<?php if (!$staff_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$staff_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staff_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $staff_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($staff_list->TotalRecords == 0 && !$staff->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $staff_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$staff_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$staff_list->isExport()) { ?>
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
$staff_list->terminate();
?>