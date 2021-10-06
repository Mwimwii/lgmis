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
$staff_edit = new staff_edit();

// Run the page
$staff_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staff_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fstaffedit = currentForm = new ew.Form("fstaffedit", "edit");

	// Validate form
	fstaffedit.validate = function() {
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
			<?php if ($staff_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->EmployeeID->caption(), $staff_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->LACode->caption(), $staff_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->FormerFileNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_FormerFileNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->FormerFileNumber->caption(), $staff_edit->FormerFileNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->NRC->Required) { ?>
				elm = this.getElements("x" + infix + "_NRC");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->NRC->caption(), $staff_edit->NRC->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->Title->Required) { ?>
				elm = this.getElements("x" + infix + "_Title");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->Title->caption(), $staff_edit->Title->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->Surname->Required) { ?>
				elm = this.getElements("x" + infix + "_Surname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->Surname->caption(), $staff_edit->Surname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->FirstName->caption(), $staff_edit->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->MiddleName->Required) { ?>
				elm = this.getElements("x" + infix + "_MiddleName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->MiddleName->caption(), $staff_edit->MiddleName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->Sex->Required) { ?>
				elm = this.getElements("x" + infix + "_Sex");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->Sex->caption(), $staff_edit->Sex->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->StaffPhoto->Required) { ?>
				felm = this.getElements("x" + infix + "_StaffPhoto");
				elm = this.getElements("fn_x" + infix + "_StaffPhoto");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $staff_edit->StaffPhoto->caption(), $staff_edit->StaffPhoto->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->MaritalStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_MaritalStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->MaritalStatus->caption(), $staff_edit->MaritalStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->MaidenName->Required) { ?>
				elm = this.getElements("x" + infix + "_MaidenName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->MaidenName->caption(), $staff_edit->MaidenName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->DateOfBirth->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->DateOfBirth->caption(), $staff_edit->DateOfBirth->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staff_edit->DateOfBirth->errorMessage()) ?>");
			<?php if ($staff_edit->AcademicQualification->Required) { ?>
				elm = this.getElements("x" + infix + "_AcademicQualification");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->AcademicQualification->caption(), $staff_edit->AcademicQualification->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->ProfessionalQualification->Required) { ?>
				elm = this.getElements("x" + infix + "_ProfessionalQualification");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->ProfessionalQualification->caption(), $staff_edit->ProfessionalQualification->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->MedicalCondition->Required) { ?>
				elm = this.getElements("x" + infix + "_MedicalCondition");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->MedicalCondition->caption(), $staff_edit->MedicalCondition->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->OtherMedicalConditions->Required) { ?>
				elm = this.getElements("x" + infix + "_OtherMedicalConditions");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->OtherMedicalConditions->caption(), $staff_edit->OtherMedicalConditions->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->PhysicalChallenge->Required) { ?>
				elm = this.getElements("x" + infix + "_PhysicalChallenge");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->PhysicalChallenge->caption(), $staff_edit->PhysicalChallenge->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->PostalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PostalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->PostalAddress->caption(), $staff_edit->PostalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->PhysicalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PhysicalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->PhysicalAddress->caption(), $staff_edit->PhysicalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->TownOrVillage->Required) { ?>
				elm = this.getElements("x" + infix + "_TownOrVillage");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->TownOrVillage->caption(), $staff_edit->TownOrVillage->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->Telephone->Required) { ?>
				elm = this.getElements("x" + infix + "_Telephone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->Telephone->caption(), $staff_edit->Telephone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->Mobile->Required) { ?>
				elm = this.getElements("x" + infix + "_Mobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->Mobile->caption(), $staff_edit->Mobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->Fax->Required) { ?>
				elm = this.getElements("x" + infix + "_Fax");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->Fax->caption(), $staff_edit->Fax->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->_Email->caption(), $staff_edit->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staff_edit->_Email->errorMessage()) ?>");
			<?php if ($staff_edit->NumberOfBiologicalChildren->Required) { ?>
				elm = this.getElements("x" + infix + "_NumberOfBiologicalChildren");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->NumberOfBiologicalChildren->caption(), $staff_edit->NumberOfBiologicalChildren->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NumberOfBiologicalChildren");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staff_edit->NumberOfBiologicalChildren->errorMessage()) ?>");
			<?php if ($staff_edit->NumberOfDependants->Required) { ?>
				elm = this.getElements("x" + infix + "_NumberOfDependants");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->NumberOfDependants->caption(), $staff_edit->NumberOfDependants->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NumberOfDependants");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staff_edit->NumberOfDependants->errorMessage()) ?>");
			<?php if ($staff_edit->NextOfKin->Required) { ?>
				elm = this.getElements("x" + infix + "_NextOfKin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->NextOfKin->caption(), $staff_edit->NextOfKin->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->RelationshipCode->Required) { ?>
				elm = this.getElements("x" + infix + "_RelationshipCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->RelationshipCode->caption(), $staff_edit->RelationshipCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->NextOfKinMobile->Required) { ?>
				elm = this.getElements("x" + infix + "_NextOfKinMobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->NextOfKinMobile->caption(), $staff_edit->NextOfKinMobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->NextOfKinEmail->Required) { ?>
				elm = this.getElements("x" + infix + "_NextOfKinEmail");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->NextOfKinEmail->caption(), $staff_edit->NextOfKinEmail->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NextOfKinEmail");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staff_edit->NextOfKinEmail->errorMessage()) ?>");
			<?php if ($staff_edit->SpouseName->Required) { ?>
				elm = this.getElements("x" + infix + "_SpouseName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->SpouseName->caption(), $staff_edit->SpouseName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->SpouseNRC->Required) { ?>
				elm = this.getElements("x" + infix + "_SpouseNRC");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->SpouseNRC->caption(), $staff_edit->SpouseNRC->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->SpouseMobile->Required) { ?>
				elm = this.getElements("x" + infix + "_SpouseMobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->SpouseMobile->caption(), $staff_edit->SpouseMobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->SpouseEmail->Required) { ?>
				elm = this.getElements("x" + infix + "_SpouseEmail");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->SpouseEmail->caption(), $staff_edit->SpouseEmail->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SpouseEmail");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staff_edit->SpouseEmail->errorMessage()) ?>");
			<?php if ($staff_edit->SpouseResidentialAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_SpouseResidentialAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->SpouseResidentialAddress->caption(), $staff_edit->SpouseResidentialAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->AdditionalInformation->Required) { ?>
				elm = this.getElements("x" + infix + "_AdditionalInformation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->AdditionalInformation->caption(), $staff_edit->AdditionalInformation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->BankAccountNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BankAccountNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->BankAccountNo->caption(), $staff_edit->BankAccountNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->PaymentMethod->Required) { ?>
				elm = this.getElements("x" + infix + "_PaymentMethod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->PaymentMethod->caption(), $staff_edit->PaymentMethod->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->BankBranchCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BankBranchCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->BankBranchCode->caption(), $staff_edit->BankBranchCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->TaxNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_TaxNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->TaxNumber->caption(), $staff_edit->TaxNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->PensionNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_PensionNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->PensionNumber->caption(), $staff_edit->PensionNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->SocialSecurityNo->Required) { ?>
				elm = this.getElements("x" + infix + "_SocialSecurityNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->SocialSecurityNo->caption(), $staff_edit->SocialSecurityNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_edit->ThirdParties->Required) { ?>
				elm = this.getElements("x" + infix + "_ThirdParties[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_edit->ThirdParties->caption(), $staff_edit->ThirdParties->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fstaffedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffedit.lists["x_LACode"] = <?php echo $staff_edit->LACode->Lookup->toClientList($staff_edit) ?>;
	fstaffedit.lists["x_LACode"].options = <?php echo JsonEncode($staff_edit->LACode->lookupOptions()) ?>;
	fstaffedit.lists["x_Title"] = <?php echo $staff_edit->Title->Lookup->toClientList($staff_edit) ?>;
	fstaffedit.lists["x_Title"].options = <?php echo JsonEncode($staff_edit->Title->lookupOptions()) ?>;
	fstaffedit.lists["x_Sex"] = <?php echo $staff_edit->Sex->Lookup->toClientList($staff_edit) ?>;
	fstaffedit.lists["x_Sex"].options = <?php echo JsonEncode($staff_edit->Sex->lookupOptions()) ?>;
	fstaffedit.lists["x_MaritalStatus"] = <?php echo $staff_edit->MaritalStatus->Lookup->toClientList($staff_edit) ?>;
	fstaffedit.lists["x_MaritalStatus"].options = <?php echo JsonEncode($staff_edit->MaritalStatus->lookupOptions()) ?>;
	fstaffedit.lists["x_AcademicQualification"] = <?php echo $staff_edit->AcademicQualification->Lookup->toClientList($staff_edit) ?>;
	fstaffedit.lists["x_AcademicQualification"].options = <?php echo JsonEncode($staff_edit->AcademicQualification->lookupOptions()) ?>;
	fstaffedit.lists["x_ProfessionalQualification"] = <?php echo $staff_edit->ProfessionalQualification->Lookup->toClientList($staff_edit) ?>;
	fstaffedit.lists["x_ProfessionalQualification"].options = <?php echo JsonEncode($staff_edit->ProfessionalQualification->lookupOptions()) ?>;
	fstaffedit.lists["x_MedicalCondition"] = <?php echo $staff_edit->MedicalCondition->Lookup->toClientList($staff_edit) ?>;
	fstaffedit.lists["x_MedicalCondition"].options = <?php echo JsonEncode($staff_edit->MedicalCondition->lookupOptions()) ?>;
	fstaffedit.lists["x_OtherMedicalConditions"] = <?php echo $staff_edit->OtherMedicalConditions->Lookup->toClientList($staff_edit) ?>;
	fstaffedit.lists["x_OtherMedicalConditions"].options = <?php echo JsonEncode($staff_edit->OtherMedicalConditions->lookupOptions()) ?>;
	fstaffedit.lists["x_PhysicalChallenge"] = <?php echo $staff_edit->PhysicalChallenge->Lookup->toClientList($staff_edit) ?>;
	fstaffedit.lists["x_PhysicalChallenge"].options = <?php echo JsonEncode($staff_edit->PhysicalChallenge->lookupOptions()) ?>;
	fstaffedit.lists["x_RelationshipCode"] = <?php echo $staff_edit->RelationshipCode->Lookup->toClientList($staff_edit) ?>;
	fstaffedit.lists["x_RelationshipCode"].options = <?php echo JsonEncode($staff_edit->RelationshipCode->lookupOptions()) ?>;
	fstaffedit.lists["x_PaymentMethod"] = <?php echo $staff_edit->PaymentMethod->Lookup->toClientList($staff_edit) ?>;
	fstaffedit.lists["x_PaymentMethod"].options = <?php echo JsonEncode($staff_edit->PaymentMethod->lookupOptions()) ?>;
	fstaffedit.lists["x_BankBranchCode"] = <?php echo $staff_edit->BankBranchCode->Lookup->toClientList($staff_edit) ?>;
	fstaffedit.lists["x_BankBranchCode"].options = <?php echo JsonEncode($staff_edit->BankBranchCode->lookupOptions()) ?>;
	fstaffedit.lists["x_ThirdParties[]"] = <?php echo $staff_edit->ThirdParties->Lookup->toClientList($staff_edit) ?>;
	fstaffedit.lists["x_ThirdParties[]"].options = <?php echo JsonEncode($staff_edit->ThirdParties->lookupOptions()) ?>;
	loadjs.done("fstaffedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staff_edit->showPageHeader(); ?>
<?php
$staff_edit->showMessage();
?>
<?php if (!$staff_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staff_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fstaffedit" id="fstaffedit" class="<?php echo $staff_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staff">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$staff_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($staff_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_staff_EmployeeID" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->EmployeeID->caption() ?><?php echo $staff_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->EmployeeID->cellAttributes() ?>>
<span id="el_staff_EmployeeID">
<span<?php echo $staff_edit->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staff_edit->EmployeeID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="staff" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" value="<?php echo HtmlEncode($staff_edit->EmployeeID->CurrentValue) ?>">
<?php echo $staff_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_staff_LACode" for="x_LACode" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->LACode->caption() ?><?php echo $staff_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->LACode->cellAttributes() ?>>
<span id="el_staff_LACode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($staff_edit->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_edit->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_edit->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_edit->LACode->ReadOnly || $staff_edit->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_edit->LACode->Lookup->getParamTag($staff_edit, "p_x_LACode") ?>
<input type="hidden" data-table="staff" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_edit->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $staff_edit->LACode->CurrentValue ?>"<?php echo $staff_edit->LACode->editAttributes() ?>>
</span>
<?php echo $staff_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->FormerFileNumber->Visible) { // FormerFileNumber ?>
	<div id="r_FormerFileNumber" class="form-group row">
		<label id="elh_staff_FormerFileNumber" for="x_FormerFileNumber" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->FormerFileNumber->caption() ?><?php echo $staff_edit->FormerFileNumber->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->FormerFileNumber->cellAttributes() ?>>
<span id="el_staff_FormerFileNumber">
<input type="text" data-table="staff" data-field="x_FormerFileNumber" name="x_FormerFileNumber" id="x_FormerFileNumber" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($staff_edit->FormerFileNumber->getPlaceHolder()) ?>" value="<?php echo $staff_edit->FormerFileNumber->EditValue ?>"<?php echo $staff_edit->FormerFileNumber->editAttributes() ?>>
</span>
<?php echo $staff_edit->FormerFileNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->NRC->Visible) { // NRC ?>
	<div id="r_NRC" class="form-group row">
		<label id="elh_staff_NRC" for="x_NRC" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->NRC->caption() ?><?php echo $staff_edit->NRC->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->NRC->cellAttributes() ?>>
<span id="el_staff_NRC">
<input type="text" data-table="staff" data-field="x_NRC" name="x_NRC" id="x_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($staff_edit->NRC->getPlaceHolder()) ?>" value="<?php echo $staff_edit->NRC->EditValue ?>"<?php echo $staff_edit->NRC->editAttributes() ?>>
</span>
<?php echo $staff_edit->NRC->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->Title->Visible) { // Title ?>
	<div id="r_Title" class="form-group row">
		<label id="elh_staff_Title" for="x_Title" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->Title->caption() ?><?php echo $staff_edit->Title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->Title->cellAttributes() ?>>
<span id="el_staff_Title">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_Title" data-value-separator="<?php echo $staff_edit->Title->displayValueSeparatorAttribute() ?>" id="x_Title" name="x_Title"<?php echo $staff_edit->Title->editAttributes() ?>>
			<?php echo $staff_edit->Title->selectOptionListHtml("x_Title") ?>
		</select>
</div>
<?php echo $staff_edit->Title->Lookup->getParamTag($staff_edit, "p_x_Title") ?>
</span>
<?php echo $staff_edit->Title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->Surname->Visible) { // Surname ?>
	<div id="r_Surname" class="form-group row">
		<label id="elh_staff_Surname" for="x_Surname" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->Surname->caption() ?><?php echo $staff_edit->Surname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->Surname->cellAttributes() ?>>
<span id="el_staff_Surname">
<input type="text" data-table="staff" data-field="x_Surname" name="x_Surname" id="x_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($staff_edit->Surname->getPlaceHolder()) ?>" value="<?php echo $staff_edit->Surname->EditValue ?>"<?php echo $staff_edit->Surname->editAttributes() ?>>
</span>
<?php echo $staff_edit->Surname->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label id="elh_staff_FirstName" for="x_FirstName" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->FirstName->caption() ?><?php echo $staff_edit->FirstName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->FirstName->cellAttributes() ?>>
<span id="el_staff_FirstName">
<input type="text" data-table="staff" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($staff_edit->FirstName->getPlaceHolder()) ?>" value="<?php echo $staff_edit->FirstName->EditValue ?>"<?php echo $staff_edit->FirstName->editAttributes() ?>>
</span>
<?php echo $staff_edit->FirstName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->MiddleName->Visible) { // MiddleName ?>
	<div id="r_MiddleName" class="form-group row">
		<label id="elh_staff_MiddleName" for="x_MiddleName" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->MiddleName->caption() ?><?php echo $staff_edit->MiddleName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->MiddleName->cellAttributes() ?>>
<span id="el_staff_MiddleName">
<input type="text" data-table="staff" data-field="x_MiddleName" name="x_MiddleName" id="x_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($staff_edit->MiddleName->getPlaceHolder()) ?>" value="<?php echo $staff_edit->MiddleName->EditValue ?>"<?php echo $staff_edit->MiddleName->editAttributes() ?>>
</span>
<?php echo $staff_edit->MiddleName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->Sex->Visible) { // Sex ?>
	<div id="r_Sex" class="form-group row">
		<label id="elh_staff_Sex" for="x_Sex" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->Sex->caption() ?><?php echo $staff_edit->Sex->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->Sex->cellAttributes() ?>>
<span id="el_staff_Sex">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_Sex" data-value-separator="<?php echo $staff_edit->Sex->displayValueSeparatorAttribute() ?>" id="x_Sex" name="x_Sex"<?php echo $staff_edit->Sex->editAttributes() ?>>
			<?php echo $staff_edit->Sex->selectOptionListHtml("x_Sex") ?>
		</select>
</div>
<?php echo $staff_edit->Sex->Lookup->getParamTag($staff_edit, "p_x_Sex") ?>
</span>
<?php echo $staff_edit->Sex->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->StaffPhoto->Visible) { // StaffPhoto ?>
	<div id="r_StaffPhoto" class="form-group row">
		<label id="elh_staff_StaffPhoto" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->StaffPhoto->caption() ?><?php echo $staff_edit->StaffPhoto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->StaffPhoto->cellAttributes() ?>>
<span id="el_staff_StaffPhoto">
<div id="fd_x_StaffPhoto">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $staff_edit->StaffPhoto->title() ?>" data-table="staff" data-field="x_StaffPhoto" name="x_StaffPhoto" id="x_StaffPhoto" lang="<?php echo CurrentLanguageID() ?>"<?php echo $staff_edit->StaffPhoto->editAttributes() ?><?php if ($staff_edit->StaffPhoto->ReadOnly || $staff_edit->StaffPhoto->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_StaffPhoto"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_StaffPhoto" id= "fn_x_StaffPhoto" value="<?php echo $staff_edit->StaffPhoto->Upload->FileName ?>">
<input type="hidden" name="fa_x_StaffPhoto" id= "fa_x_StaffPhoto" value="<?php echo (Post("fa_x_StaffPhoto") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_StaffPhoto" id= "fs_x_StaffPhoto" value="0">
<input type="hidden" name="fx_x_StaffPhoto" id= "fx_x_StaffPhoto" value="<?php echo $staff_edit->StaffPhoto->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_StaffPhoto" id= "fm_x_StaffPhoto" value="<?php echo $staff_edit->StaffPhoto->UploadMaxFileSize ?>">
</div>
<table id="ft_x_StaffPhoto" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $staff_edit->StaffPhoto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->MaritalStatus->Visible) { // MaritalStatus ?>
	<div id="r_MaritalStatus" class="form-group row">
		<label id="elh_staff_MaritalStatus" for="x_MaritalStatus" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->MaritalStatus->caption() ?><?php echo $staff_edit->MaritalStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->MaritalStatus->cellAttributes() ?>>
<span id="el_staff_MaritalStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_MaritalStatus" data-value-separator="<?php echo $staff_edit->MaritalStatus->displayValueSeparatorAttribute() ?>" id="x_MaritalStatus" name="x_MaritalStatus"<?php echo $staff_edit->MaritalStatus->editAttributes() ?>>
			<?php echo $staff_edit->MaritalStatus->selectOptionListHtml("x_MaritalStatus") ?>
		</select>
</div>
<?php echo $staff_edit->MaritalStatus->Lookup->getParamTag($staff_edit, "p_x_MaritalStatus") ?>
</span>
<?php echo $staff_edit->MaritalStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->MaidenName->Visible) { // MaidenName ?>
	<div id="r_MaidenName" class="form-group row">
		<label id="elh_staff_MaidenName" for="x_MaidenName" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->MaidenName->caption() ?><?php echo $staff_edit->MaidenName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->MaidenName->cellAttributes() ?>>
<span id="el_staff_MaidenName">
<input type="text" data-table="staff" data-field="x_MaidenName" name="x_MaidenName" id="x_MaidenName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($staff_edit->MaidenName->getPlaceHolder()) ?>" value="<?php echo $staff_edit->MaidenName->EditValue ?>"<?php echo $staff_edit->MaidenName->editAttributes() ?>>
</span>
<?php echo $staff_edit->MaidenName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->DateOfBirth->Visible) { // DateOfBirth ?>
	<div id="r_DateOfBirth" class="form-group row">
		<label id="elh_staff_DateOfBirth" for="x_DateOfBirth" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->DateOfBirth->caption() ?><?php echo $staff_edit->DateOfBirth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->DateOfBirth->cellAttributes() ?>>
<span id="el_staff_DateOfBirth">
<input type="text" data-table="staff" data-field="x_DateOfBirth" name="x_DateOfBirth" id="x_DateOfBirth" placeholder="<?php echo HtmlEncode($staff_edit->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $staff_edit->DateOfBirth->EditValue ?>"<?php echo $staff_edit->DateOfBirth->editAttributes() ?>>
<?php if (!$staff_edit->DateOfBirth->ReadOnly && !$staff_edit->DateOfBirth->Disabled && !isset($staff_edit->DateOfBirth->EditAttrs["readonly"]) && !isset($staff_edit->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffedit", "x_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staff_edit->DateOfBirth->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->AcademicQualification->Visible) { // AcademicQualification ?>
	<div id="r_AcademicQualification" class="form-group row">
		<label id="elh_staff_AcademicQualification" for="x_AcademicQualification" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->AcademicQualification->caption() ?><?php echo $staff_edit->AcademicQualification->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->AcademicQualification->cellAttributes() ?>>
<span id="el_staff_AcademicQualification">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_AcademicQualification"><?php echo EmptyValue(strval($staff_edit->AcademicQualification->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_edit->AcademicQualification->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_edit->AcademicQualification->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_edit->AcademicQualification->ReadOnly || $staff_edit->AcademicQualification->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_AcademicQualification',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_edit->AcademicQualification->Lookup->getParamTag($staff_edit, "p_x_AcademicQualification") ?>
<input type="hidden" data-table="staff" data-field="x_AcademicQualification" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_edit->AcademicQualification->displayValueSeparatorAttribute() ?>" name="x_AcademicQualification" id="x_AcademicQualification" value="<?php echo $staff_edit->AcademicQualification->CurrentValue ?>"<?php echo $staff_edit->AcademicQualification->editAttributes() ?>>
</span>
<?php echo $staff_edit->AcademicQualification->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->ProfessionalQualification->Visible) { // ProfessionalQualification ?>
	<div id="r_ProfessionalQualification" class="form-group row">
		<label id="elh_staff_ProfessionalQualification" for="x_ProfessionalQualification" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->ProfessionalQualification->caption() ?><?php echo $staff_edit->ProfessionalQualification->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->ProfessionalQualification->cellAttributes() ?>>
<span id="el_staff_ProfessionalQualification">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ProfessionalQualification"><?php echo EmptyValue(strval($staff_edit->ProfessionalQualification->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_edit->ProfessionalQualification->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_edit->ProfessionalQualification->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_edit->ProfessionalQualification->ReadOnly || $staff_edit->ProfessionalQualification->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ProfessionalQualification',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_edit->ProfessionalQualification->Lookup->getParamTag($staff_edit, "p_x_ProfessionalQualification") ?>
<input type="hidden" data-table="staff" data-field="x_ProfessionalQualification" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_edit->ProfessionalQualification->displayValueSeparatorAttribute() ?>" name="x_ProfessionalQualification" id="x_ProfessionalQualification" value="<?php echo $staff_edit->ProfessionalQualification->CurrentValue ?>"<?php echo $staff_edit->ProfessionalQualification->editAttributes() ?>>
</span>
<?php echo $staff_edit->ProfessionalQualification->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->MedicalCondition->Visible) { // MedicalCondition ?>
	<div id="r_MedicalCondition" class="form-group row">
		<label id="elh_staff_MedicalCondition" for="x_MedicalCondition" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->MedicalCondition->caption() ?><?php echo $staff_edit->MedicalCondition->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->MedicalCondition->cellAttributes() ?>>
<span id="el_staff_MedicalCondition">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_MedicalCondition" data-value-separator="<?php echo $staff_edit->MedicalCondition->displayValueSeparatorAttribute() ?>" id="x_MedicalCondition" name="x_MedicalCondition"<?php echo $staff_edit->MedicalCondition->editAttributes() ?>>
			<?php echo $staff_edit->MedicalCondition->selectOptionListHtml("x_MedicalCondition") ?>
		</select>
</div>
<?php echo $staff_edit->MedicalCondition->Lookup->getParamTag($staff_edit, "p_x_MedicalCondition") ?>
</span>
<?php echo $staff_edit->MedicalCondition->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->OtherMedicalConditions->Visible) { // OtherMedicalConditions ?>
	<div id="r_OtherMedicalConditions" class="form-group row">
		<label id="elh_staff_OtherMedicalConditions" for="x_OtherMedicalConditions" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->OtherMedicalConditions->caption() ?><?php echo $staff_edit->OtherMedicalConditions->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->OtherMedicalConditions->cellAttributes() ?>>
<span id="el_staff_OtherMedicalConditions">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_OtherMedicalConditions" data-value-separator="<?php echo $staff_edit->OtherMedicalConditions->displayValueSeparatorAttribute() ?>" id="x_OtherMedicalConditions" name="x_OtherMedicalConditions"<?php echo $staff_edit->OtherMedicalConditions->editAttributes() ?>>
			<?php echo $staff_edit->OtherMedicalConditions->selectOptionListHtml("x_OtherMedicalConditions") ?>
		</select>
</div>
<?php echo $staff_edit->OtherMedicalConditions->Lookup->getParamTag($staff_edit, "p_x_OtherMedicalConditions") ?>
</span>
<?php echo $staff_edit->OtherMedicalConditions->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->PhysicalChallenge->Visible) { // PhysicalChallenge ?>
	<div id="r_PhysicalChallenge" class="form-group row">
		<label id="elh_staff_PhysicalChallenge" for="x_PhysicalChallenge" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->PhysicalChallenge->caption() ?><?php echo $staff_edit->PhysicalChallenge->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->PhysicalChallenge->cellAttributes() ?>>
<span id="el_staff_PhysicalChallenge">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_PhysicalChallenge" data-value-separator="<?php echo $staff_edit->PhysicalChallenge->displayValueSeparatorAttribute() ?>" id="x_PhysicalChallenge" name="x_PhysicalChallenge"<?php echo $staff_edit->PhysicalChallenge->editAttributes() ?>>
			<?php echo $staff_edit->PhysicalChallenge->selectOptionListHtml("x_PhysicalChallenge") ?>
		</select>
</div>
<?php echo $staff_edit->PhysicalChallenge->Lookup->getParamTag($staff_edit, "p_x_PhysicalChallenge") ?>
</span>
<?php echo $staff_edit->PhysicalChallenge->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->PostalAddress->Visible) { // PostalAddress ?>
	<div id="r_PostalAddress" class="form-group row">
		<label id="elh_staff_PostalAddress" for="x_PostalAddress" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->PostalAddress->caption() ?><?php echo $staff_edit->PostalAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->PostalAddress->cellAttributes() ?>>
<span id="el_staff_PostalAddress">
<input type="text" data-table="staff" data-field="x_PostalAddress" name="x_PostalAddress" id="x_PostalAddress" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($staff_edit->PostalAddress->getPlaceHolder()) ?>" value="<?php echo $staff_edit->PostalAddress->EditValue ?>"<?php echo $staff_edit->PostalAddress->editAttributes() ?>>
</span>
<?php echo $staff_edit->PostalAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->PhysicalAddress->Visible) { // PhysicalAddress ?>
	<div id="r_PhysicalAddress" class="form-group row">
		<label id="elh_staff_PhysicalAddress" for="x_PhysicalAddress" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->PhysicalAddress->caption() ?><?php echo $staff_edit->PhysicalAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->PhysicalAddress->cellAttributes() ?>>
<span id="el_staff_PhysicalAddress">
<input type="text" data-table="staff" data-field="x_PhysicalAddress" name="x_PhysicalAddress" id="x_PhysicalAddress" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($staff_edit->PhysicalAddress->getPlaceHolder()) ?>" value="<?php echo $staff_edit->PhysicalAddress->EditValue ?>"<?php echo $staff_edit->PhysicalAddress->editAttributes() ?>>
</span>
<?php echo $staff_edit->PhysicalAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->TownOrVillage->Visible) { // TownOrVillage ?>
	<div id="r_TownOrVillage" class="form-group row">
		<label id="elh_staff_TownOrVillage" for="x_TownOrVillage" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->TownOrVillage->caption() ?><?php echo $staff_edit->TownOrVillage->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->TownOrVillage->cellAttributes() ?>>
<span id="el_staff_TownOrVillage">
<input type="text" data-table="staff" data-field="x_TownOrVillage" name="x_TownOrVillage" id="x_TownOrVillage" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_edit->TownOrVillage->getPlaceHolder()) ?>" value="<?php echo $staff_edit->TownOrVillage->EditValue ?>"<?php echo $staff_edit->TownOrVillage->editAttributes() ?>>
</span>
<?php echo $staff_edit->TownOrVillage->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->Telephone->Visible) { // Telephone ?>
	<div id="r_Telephone" class="form-group row">
		<label id="elh_staff_Telephone" for="x_Telephone" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->Telephone->caption() ?><?php echo $staff_edit->Telephone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->Telephone->cellAttributes() ?>>
<span id="el_staff_Telephone">
<input type="text" data-table="staff" data-field="x_Telephone" name="x_Telephone" id="x_Telephone" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_edit->Telephone->getPlaceHolder()) ?>" value="<?php echo $staff_edit->Telephone->EditValue ?>"<?php echo $staff_edit->Telephone->editAttributes() ?>>
</span>
<?php echo $staff_edit->Telephone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->Mobile->Visible) { // Mobile ?>
	<div id="r_Mobile" class="form-group row">
		<label id="elh_staff_Mobile" for="x_Mobile" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->Mobile->caption() ?><?php echo $staff_edit->Mobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->Mobile->cellAttributes() ?>>
<span id="el_staff_Mobile">
<input type="text" data-table="staff" data-field="x_Mobile" name="x_Mobile" id="x_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_edit->Mobile->getPlaceHolder()) ?>" value="<?php echo $staff_edit->Mobile->EditValue ?>"<?php echo $staff_edit->Mobile->editAttributes() ?>>
</span>
<?php echo $staff_edit->Mobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->Fax->Visible) { // Fax ?>
	<div id="r_Fax" class="form-group row">
		<label id="elh_staff_Fax" for="x_Fax" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->Fax->caption() ?><?php echo $staff_edit->Fax->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->Fax->cellAttributes() ?>>
<span id="el_staff_Fax">
<input type="text" data-table="staff" data-field="x_Fax" name="x_Fax" id="x_Fax" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($staff_edit->Fax->getPlaceHolder()) ?>" value="<?php echo $staff_edit->Fax->EditValue ?>"<?php echo $staff_edit->Fax->editAttributes() ?>>
</span>
<?php echo $staff_edit->Fax->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_staff__Email" for="x__Email" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->_Email->caption() ?><?php echo $staff_edit->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->_Email->cellAttributes() ?>>
<span id="el_staff__Email">
<input type="text" data-table="staff" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_edit->_Email->getPlaceHolder()) ?>" value="<?php echo $staff_edit->_Email->EditValue ?>"<?php echo $staff_edit->_Email->editAttributes() ?>>
</span>
<?php echo $staff_edit->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->NumberOfBiologicalChildren->Visible) { // NumberOfBiologicalChildren ?>
	<div id="r_NumberOfBiologicalChildren" class="form-group row">
		<label id="elh_staff_NumberOfBiologicalChildren" for="x_NumberOfBiologicalChildren" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->NumberOfBiologicalChildren->caption() ?><?php echo $staff_edit->NumberOfBiologicalChildren->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->NumberOfBiologicalChildren->cellAttributes() ?>>
<span id="el_staff_NumberOfBiologicalChildren">
<input type="text" data-table="staff" data-field="x_NumberOfBiologicalChildren" name="x_NumberOfBiologicalChildren" id="x_NumberOfBiologicalChildren" size="30" placeholder="<?php echo HtmlEncode($staff_edit->NumberOfBiologicalChildren->getPlaceHolder()) ?>" value="<?php echo $staff_edit->NumberOfBiologicalChildren->EditValue ?>"<?php echo $staff_edit->NumberOfBiologicalChildren->editAttributes() ?>>
</span>
<?php echo $staff_edit->NumberOfBiologicalChildren->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->NumberOfDependants->Visible) { // NumberOfDependants ?>
	<div id="r_NumberOfDependants" class="form-group row">
		<label id="elh_staff_NumberOfDependants" for="x_NumberOfDependants" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->NumberOfDependants->caption() ?><?php echo $staff_edit->NumberOfDependants->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->NumberOfDependants->cellAttributes() ?>>
<span id="el_staff_NumberOfDependants">
<input type="text" data-table="staff" data-field="x_NumberOfDependants" name="x_NumberOfDependants" id="x_NumberOfDependants" size="30" placeholder="<?php echo HtmlEncode($staff_edit->NumberOfDependants->getPlaceHolder()) ?>" value="<?php echo $staff_edit->NumberOfDependants->EditValue ?>"<?php echo $staff_edit->NumberOfDependants->editAttributes() ?>>
</span>
<?php echo $staff_edit->NumberOfDependants->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->NextOfKin->Visible) { // NextOfKin ?>
	<div id="r_NextOfKin" class="form-group row">
		<label id="elh_staff_NextOfKin" for="x_NextOfKin" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->NextOfKin->caption() ?><?php echo $staff_edit->NextOfKin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->NextOfKin->cellAttributes() ?>>
<span id="el_staff_NextOfKin">
<input type="text" data-table="staff" data-field="x_NextOfKin" name="x_NextOfKin" id="x_NextOfKin" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_edit->NextOfKin->getPlaceHolder()) ?>" value="<?php echo $staff_edit->NextOfKin->EditValue ?>"<?php echo $staff_edit->NextOfKin->editAttributes() ?>>
</span>
<?php echo $staff_edit->NextOfKin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->RelationshipCode->Visible) { // RelationshipCode ?>
	<div id="r_RelationshipCode" class="form-group row">
		<label id="elh_staff_RelationshipCode" for="x_RelationshipCode" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->RelationshipCode->caption() ?><?php echo $staff_edit->RelationshipCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->RelationshipCode->cellAttributes() ?>>
<span id="el_staff_RelationshipCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_RelationshipCode"><?php echo EmptyValue(strval($staff_edit->RelationshipCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_edit->RelationshipCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_edit->RelationshipCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_edit->RelationshipCode->ReadOnly || $staff_edit->RelationshipCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_RelationshipCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_edit->RelationshipCode->Lookup->getParamTag($staff_edit, "p_x_RelationshipCode") ?>
<input type="hidden" data-table="staff" data-field="x_RelationshipCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_edit->RelationshipCode->displayValueSeparatorAttribute() ?>" name="x_RelationshipCode" id="x_RelationshipCode" value="<?php echo $staff_edit->RelationshipCode->CurrentValue ?>"<?php echo $staff_edit->RelationshipCode->editAttributes() ?>>
</span>
<?php echo $staff_edit->RelationshipCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
	<div id="r_NextOfKinMobile" class="form-group row">
		<label id="elh_staff_NextOfKinMobile" for="x_NextOfKinMobile" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->NextOfKinMobile->caption() ?><?php echo $staff_edit->NextOfKinMobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->NextOfKinMobile->cellAttributes() ?>>
<span id="el_staff_NextOfKinMobile">
<input type="text" data-table="staff" data-field="x_NextOfKinMobile" name="x_NextOfKinMobile" id="x_NextOfKinMobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_edit->NextOfKinMobile->getPlaceHolder()) ?>" value="<?php echo $staff_edit->NextOfKinMobile->EditValue ?>"<?php echo $staff_edit->NextOfKinMobile->editAttributes() ?>>
</span>
<?php echo $staff_edit->NextOfKinMobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
	<div id="r_NextOfKinEmail" class="form-group row">
		<label id="elh_staff_NextOfKinEmail" for="x_NextOfKinEmail" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->NextOfKinEmail->caption() ?><?php echo $staff_edit->NextOfKinEmail->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->NextOfKinEmail->cellAttributes() ?>>
<span id="el_staff_NextOfKinEmail">
<input type="text" data-table="staff" data-field="x_NextOfKinEmail" name="x_NextOfKinEmail" id="x_NextOfKinEmail" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_edit->NextOfKinEmail->getPlaceHolder()) ?>" value="<?php echo $staff_edit->NextOfKinEmail->EditValue ?>"<?php echo $staff_edit->NextOfKinEmail->editAttributes() ?>>
</span>
<?php echo $staff_edit->NextOfKinEmail->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->SpouseName->Visible) { // SpouseName ?>
	<div id="r_SpouseName" class="form-group row">
		<label id="elh_staff_SpouseName" for="x_SpouseName" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->SpouseName->caption() ?><?php echo $staff_edit->SpouseName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->SpouseName->cellAttributes() ?>>
<span id="el_staff_SpouseName">
<input type="text" data-table="staff" data-field="x_SpouseName" name="x_SpouseName" id="x_SpouseName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_edit->SpouseName->getPlaceHolder()) ?>" value="<?php echo $staff_edit->SpouseName->EditValue ?>"<?php echo $staff_edit->SpouseName->editAttributes() ?>>
</span>
<?php echo $staff_edit->SpouseName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->SpouseNRC->Visible) { // SpouseNRC ?>
	<div id="r_SpouseNRC" class="form-group row">
		<label id="elh_staff_SpouseNRC" for="x_SpouseNRC" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->SpouseNRC->caption() ?><?php echo $staff_edit->SpouseNRC->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->SpouseNRC->cellAttributes() ?>>
<span id="el_staff_SpouseNRC">
<input type="text" data-table="staff" data-field="x_SpouseNRC" name="x_SpouseNRC" id="x_SpouseNRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($staff_edit->SpouseNRC->getPlaceHolder()) ?>" value="<?php echo $staff_edit->SpouseNRC->EditValue ?>"<?php echo $staff_edit->SpouseNRC->editAttributes() ?>>
</span>
<?php echo $staff_edit->SpouseNRC->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->SpouseMobile->Visible) { // SpouseMobile ?>
	<div id="r_SpouseMobile" class="form-group row">
		<label id="elh_staff_SpouseMobile" for="x_SpouseMobile" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->SpouseMobile->caption() ?><?php echo $staff_edit->SpouseMobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->SpouseMobile->cellAttributes() ?>>
<span id="el_staff_SpouseMobile">
<input type="text" data-table="staff" data-field="x_SpouseMobile" name="x_SpouseMobile" id="x_SpouseMobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_edit->SpouseMobile->getPlaceHolder()) ?>" value="<?php echo $staff_edit->SpouseMobile->EditValue ?>"<?php echo $staff_edit->SpouseMobile->editAttributes() ?>>
</span>
<?php echo $staff_edit->SpouseMobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->SpouseEmail->Visible) { // SpouseEmail ?>
	<div id="r_SpouseEmail" class="form-group row">
		<label id="elh_staff_SpouseEmail" for="x_SpouseEmail" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->SpouseEmail->caption() ?><?php echo $staff_edit->SpouseEmail->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->SpouseEmail->cellAttributes() ?>>
<span id="el_staff_SpouseEmail">
<input type="text" data-table="staff" data-field="x_SpouseEmail" name="x_SpouseEmail" id="x_SpouseEmail" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_edit->SpouseEmail->getPlaceHolder()) ?>" value="<?php echo $staff_edit->SpouseEmail->EditValue ?>"<?php echo $staff_edit->SpouseEmail->editAttributes() ?>>
</span>
<?php echo $staff_edit->SpouseEmail->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->SpouseResidentialAddress->Visible) { // SpouseResidentialAddress ?>
	<div id="r_SpouseResidentialAddress" class="form-group row">
		<label id="elh_staff_SpouseResidentialAddress" for="x_SpouseResidentialAddress" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->SpouseResidentialAddress->caption() ?><?php echo $staff_edit->SpouseResidentialAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->SpouseResidentialAddress->cellAttributes() ?>>
<span id="el_staff_SpouseResidentialAddress">
<input type="text" data-table="staff" data-field="x_SpouseResidentialAddress" name="x_SpouseResidentialAddress" id="x_SpouseResidentialAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_edit->SpouseResidentialAddress->getPlaceHolder()) ?>" value="<?php echo $staff_edit->SpouseResidentialAddress->EditValue ?>"<?php echo $staff_edit->SpouseResidentialAddress->editAttributes() ?>>
</span>
<?php echo $staff_edit->SpouseResidentialAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->AdditionalInformation->Visible) { // AdditionalInformation ?>
	<div id="r_AdditionalInformation" class="form-group row">
		<label id="elh_staff_AdditionalInformation" for="x_AdditionalInformation" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->AdditionalInformation->caption() ?><?php echo $staff_edit->AdditionalInformation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->AdditionalInformation->cellAttributes() ?>>
<span id="el_staff_AdditionalInformation">
<textarea data-table="staff" data-field="x_AdditionalInformation" name="x_AdditionalInformation" id="x_AdditionalInformation" cols="35" rows="4" placeholder="<?php echo HtmlEncode($staff_edit->AdditionalInformation->getPlaceHolder()) ?>"<?php echo $staff_edit->AdditionalInformation->editAttributes() ?>><?php echo $staff_edit->AdditionalInformation->EditValue ?></textarea>
</span>
<?php echo $staff_edit->AdditionalInformation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->BankAccountNo->Visible) { // BankAccountNo ?>
	<div id="r_BankAccountNo" class="form-group row">
		<label id="elh_staff_BankAccountNo" for="x_BankAccountNo" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->BankAccountNo->caption() ?><?php echo $staff_edit->BankAccountNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->BankAccountNo->cellAttributes() ?>>
<span id="el_staff_BankAccountNo">
<input type="text" data-table="staff" data-field="x_BankAccountNo" name="x_BankAccountNo" id="x_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($staff_edit->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $staff_edit->BankAccountNo->EditValue ?>"<?php echo $staff_edit->BankAccountNo->editAttributes() ?>>
</span>
<?php echo $staff_edit->BankAccountNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->PaymentMethod->Visible) { // PaymentMethod ?>
	<div id="r_PaymentMethod" class="form-group row">
		<label id="elh_staff_PaymentMethod" for="x_PaymentMethod" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->PaymentMethod->caption() ?><?php echo $staff_edit->PaymentMethod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->PaymentMethod->cellAttributes() ?>>
<span id="el_staff_PaymentMethod">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_PaymentMethod" data-value-separator="<?php echo $staff_edit->PaymentMethod->displayValueSeparatorAttribute() ?>" id="x_PaymentMethod" name="x_PaymentMethod"<?php echo $staff_edit->PaymentMethod->editAttributes() ?>>
			<?php echo $staff_edit->PaymentMethod->selectOptionListHtml("x_PaymentMethod") ?>
		</select>
</div>
<?php echo $staff_edit->PaymentMethod->Lookup->getParamTag($staff_edit, "p_x_PaymentMethod") ?>
</span>
<?php echo $staff_edit->PaymentMethod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->BankBranchCode->Visible) { // BankBranchCode ?>
	<div id="r_BankBranchCode" class="form-group row">
		<label id="elh_staff_BankBranchCode" for="x_BankBranchCode" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->BankBranchCode->caption() ?><?php echo $staff_edit->BankBranchCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->BankBranchCode->cellAttributes() ?>>
<span id="el_staff_BankBranchCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_BankBranchCode"><?php echo EmptyValue(strval($staff_edit->BankBranchCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_edit->BankBranchCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_edit->BankBranchCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_edit->BankBranchCode->ReadOnly || $staff_edit->BankBranchCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_BankBranchCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_edit->BankBranchCode->Lookup->getParamTag($staff_edit, "p_x_BankBranchCode") ?>
<input type="hidden" data-table="staff" data-field="x_BankBranchCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_edit->BankBranchCode->displayValueSeparatorAttribute() ?>" name="x_BankBranchCode" id="x_BankBranchCode" value="<?php echo $staff_edit->BankBranchCode->CurrentValue ?>"<?php echo $staff_edit->BankBranchCode->editAttributes() ?>>
</span>
<?php echo $staff_edit->BankBranchCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->TaxNumber->Visible) { // TaxNumber ?>
	<div id="r_TaxNumber" class="form-group row">
		<label id="elh_staff_TaxNumber" for="x_TaxNumber" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->TaxNumber->caption() ?><?php echo $staff_edit->TaxNumber->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->TaxNumber->cellAttributes() ?>>
<span id="el_staff_TaxNumber">
<input type="text" data-table="staff" data-field="x_TaxNumber" name="x_TaxNumber" id="x_TaxNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($staff_edit->TaxNumber->getPlaceHolder()) ?>" value="<?php echo $staff_edit->TaxNumber->EditValue ?>"<?php echo $staff_edit->TaxNumber->editAttributes() ?>>
</span>
<?php echo $staff_edit->TaxNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->PensionNumber->Visible) { // PensionNumber ?>
	<div id="r_PensionNumber" class="form-group row">
		<label id="elh_staff_PensionNumber" for="x_PensionNumber" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->PensionNumber->caption() ?><?php echo $staff_edit->PensionNumber->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->PensionNumber->cellAttributes() ?>>
<span id="el_staff_PensionNumber">
<input type="text" data-table="staff" data-field="x_PensionNumber" name="x_PensionNumber" id="x_PensionNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($staff_edit->PensionNumber->getPlaceHolder()) ?>" value="<?php echo $staff_edit->PensionNumber->EditValue ?>"<?php echo $staff_edit->PensionNumber->editAttributes() ?>>
</span>
<?php echo $staff_edit->PensionNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
	<div id="r_SocialSecurityNo" class="form-group row">
		<label id="elh_staff_SocialSecurityNo" for="x_SocialSecurityNo" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->SocialSecurityNo->caption() ?><?php echo $staff_edit->SocialSecurityNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->SocialSecurityNo->cellAttributes() ?>>
<span id="el_staff_SocialSecurityNo">
<input type="text" data-table="staff" data-field="x_SocialSecurityNo" name="x_SocialSecurityNo" id="x_SocialSecurityNo" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($staff_edit->SocialSecurityNo->getPlaceHolder()) ?>" value="<?php echo $staff_edit->SocialSecurityNo->EditValue ?>"<?php echo $staff_edit->SocialSecurityNo->editAttributes() ?>>
</span>
<?php echo $staff_edit->SocialSecurityNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_edit->ThirdParties->Visible) { // ThirdParties ?>
	<div id="r_ThirdParties" class="form-group row">
		<label id="elh_staff_ThirdParties" class="<?php echo $staff_edit->LeftColumnClass ?>"><?php echo $staff_edit->ThirdParties->caption() ?><?php echo $staff_edit->ThirdParties->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_edit->RightColumnClass ?>"><div <?php echo $staff_edit->ThirdParties->cellAttributes() ?>>
<span id="el_staff_ThirdParties">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ThirdParties"><?php echo EmptyValue(strval($staff_edit->ThirdParties->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_edit->ThirdParties->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_edit->ThirdParties->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_edit->ThirdParties->ReadOnly || $staff_edit->ThirdParties->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ThirdParties[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_edit->ThirdParties->Lookup->getParamTag($staff_edit, "p_x_ThirdParties") ?>
<input type="hidden" data-table="staff" data-field="x_ThirdParties" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $staff_edit->ThirdParties->displayValueSeparatorAttribute() ?>" name="x_ThirdParties[]" id="x_ThirdParties[]" value="<?php echo $staff_edit->ThirdParties->CurrentValue ?>"<?php echo $staff_edit->ThirdParties->editAttributes() ?>>
</span>
<?php echo $staff_edit->ThirdParties->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if ($staff->getCurrentDetailTable() != "") { ?>
<?php
	$staff_edit->DetailPages->ValidKeys = explode(",", $staff->getCurrentDetailTable());
	$firstActiveDetailTable = $staff_edit->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="staff_edit_details"><!-- tabs -->
	<ul class="<?php echo $staff_edit->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("staffchildren", explode(",", $staff->getCurrentDetailTable())) && $staffchildren->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffchildren") {
			$firstActiveDetailTable = "staffchildren";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_edit->DetailPages->pageStyle("staffchildren") ?>" href="#tab_staffchildren" data-toggle="tab"><?php echo $Language->tablePhrase("staffchildren", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("staffdisciplinary_action", explode(",", $staff->getCurrentDetailTable())) && $staffdisciplinary_action->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffdisciplinary_action") {
			$firstActiveDetailTable = "staffdisciplinary_action";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_edit->DetailPages->pageStyle("staffdisciplinary_action") ?>" href="#tab_staffdisciplinary_action" data-toggle="tab"><?php echo $Language->tablePhrase("staffdisciplinary_action", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("staffdisciplinary_appeal", explode(",", $staff->getCurrentDetailTable())) && $staffdisciplinary_appeal->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffdisciplinary_appeal") {
			$firstActiveDetailTable = "staffdisciplinary_appeal";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_edit->DetailPages->pageStyle("staffdisciplinary_appeal") ?>" href="#tab_staffdisciplinary_appeal" data-toggle="tab"><?php echo $Language->tablePhrase("staffdisciplinary_appeal", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("staffdisciplinary_case", explode(",", $staff->getCurrentDetailTable())) && $staffdisciplinary_case->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffdisciplinary_case") {
			$firstActiveDetailTable = "staffdisciplinary_case";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_edit->DetailPages->pageStyle("staffdisciplinary_case") ?>" href="#tab_staffdisciplinary_case" data-toggle="tab"><?php echo $Language->tablePhrase("staffdisciplinary_case", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("staffexperience", explode(",", $staff->getCurrentDetailTable())) && $staffexperience->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffexperience") {
			$firstActiveDetailTable = "staffexperience";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_edit->DetailPages->pageStyle("staffexperience") ?>" href="#tab_staffexperience" data-toggle="tab"><?php echo $Language->tablePhrase("staffexperience", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("staffprofbodies", explode(",", $staff->getCurrentDetailTable())) && $staffprofbodies->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffprofbodies") {
			$firstActiveDetailTable = "staffprofbodies";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_edit->DetailPages->pageStyle("staffprofbodies") ?>" href="#tab_staffprofbodies" data-toggle="tab"><?php echo $Language->tablePhrase("staffprofbodies", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("staffqualifications_academic", explode(",", $staff->getCurrentDetailTable())) && $staffqualifications_academic->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffqualifications_academic") {
			$firstActiveDetailTable = "staffqualifications_academic";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_edit->DetailPages->pageStyle("staffqualifications_academic") ?>" href="#tab_staffqualifications_academic" data-toggle="tab"><?php echo $Language->tablePhrase("staffqualifications_academic", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("staffqualifications_prof", explode(",", $staff->getCurrentDetailTable())) && $staffqualifications_prof->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffqualifications_prof") {
			$firstActiveDetailTable = "staffqualifications_prof";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_edit->DetailPages->pageStyle("staffqualifications_prof") ?>" href="#tab_staffqualifications_prof" data-toggle="tab"><?php echo $Language->tablePhrase("staffqualifications_prof", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("employment", explode(",", $staff->getCurrentDetailTable())) && $employment->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "employment") {
			$firstActiveDetailTable = "employment";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_edit->DetailPages->pageStyle("employment") ?>" href="#tab_employment" data-toggle="tab"><?php echo $Language->tablePhrase("employment", "TblCaption") ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("staffchildren", explode(",", $staff->getCurrentDetailTable())) && $staffchildren->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffchildren")
			$firstActiveDetailTable = "staffchildren";
?>
		<div class="tab-pane <?php echo $staff_edit->DetailPages->pageStyle("staffchildren") ?>" id="tab_staffchildren"><!-- page* -->
<?php include_once "staffchildrengrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("staffdisciplinary_action", explode(",", $staff->getCurrentDetailTable())) && $staffdisciplinary_action->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffdisciplinary_action")
			$firstActiveDetailTable = "staffdisciplinary_action";
?>
		<div class="tab-pane <?php echo $staff_edit->DetailPages->pageStyle("staffdisciplinary_action") ?>" id="tab_staffdisciplinary_action"><!-- page* -->
<?php include_once "staffdisciplinary_actiongrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("staffdisciplinary_appeal", explode(",", $staff->getCurrentDetailTable())) && $staffdisciplinary_appeal->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffdisciplinary_appeal")
			$firstActiveDetailTable = "staffdisciplinary_appeal";
?>
		<div class="tab-pane <?php echo $staff_edit->DetailPages->pageStyle("staffdisciplinary_appeal") ?>" id="tab_staffdisciplinary_appeal"><!-- page* -->
<?php include_once "staffdisciplinary_appealgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("staffdisciplinary_case", explode(",", $staff->getCurrentDetailTable())) && $staffdisciplinary_case->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffdisciplinary_case")
			$firstActiveDetailTable = "staffdisciplinary_case";
?>
		<div class="tab-pane <?php echo $staff_edit->DetailPages->pageStyle("staffdisciplinary_case") ?>" id="tab_staffdisciplinary_case"><!-- page* -->
<?php include_once "staffdisciplinary_casegrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("staffexperience", explode(",", $staff->getCurrentDetailTable())) && $staffexperience->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffexperience")
			$firstActiveDetailTable = "staffexperience";
?>
		<div class="tab-pane <?php echo $staff_edit->DetailPages->pageStyle("staffexperience") ?>" id="tab_staffexperience"><!-- page* -->
<?php include_once "staffexperiencegrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("staffprofbodies", explode(",", $staff->getCurrentDetailTable())) && $staffprofbodies->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffprofbodies")
			$firstActiveDetailTable = "staffprofbodies";
?>
		<div class="tab-pane <?php echo $staff_edit->DetailPages->pageStyle("staffprofbodies") ?>" id="tab_staffprofbodies"><!-- page* -->
<?php include_once "staffprofbodiesgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("staffqualifications_academic", explode(",", $staff->getCurrentDetailTable())) && $staffqualifications_academic->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffqualifications_academic")
			$firstActiveDetailTable = "staffqualifications_academic";
?>
		<div class="tab-pane <?php echo $staff_edit->DetailPages->pageStyle("staffqualifications_academic") ?>" id="tab_staffqualifications_academic"><!-- page* -->
<?php include_once "staffqualifications_academicgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("staffqualifications_prof", explode(",", $staff->getCurrentDetailTable())) && $staffqualifications_prof->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffqualifications_prof")
			$firstActiveDetailTable = "staffqualifications_prof";
?>
		<div class="tab-pane <?php echo $staff_edit->DetailPages->pageStyle("staffqualifications_prof") ?>" id="tab_staffqualifications_prof"><!-- page* -->
<?php include_once "staffqualifications_profgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("employment", explode(",", $staff->getCurrentDetailTable())) && $employment->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "employment")
			$firstActiveDetailTable = "employment";
?>
		<div class="tab-pane <?php echo $staff_edit->DetailPages->pageStyle("employment") ?>" id="tab_employment"><!-- page* -->
<?php include_once "employmentgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
<?php if (!$staff_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $staff_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staff_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$staff_edit->IsModal) { ?>
<?php echo $staff_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$staff_edit->showPageFooter();
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
$staff_edit->terminate();
?>