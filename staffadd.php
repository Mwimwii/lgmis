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
$staff_add = new staff_add();

// Run the page
$staff_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staff_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fstaffadd = currentForm = new ew.Form("fstaffadd", "add");

	// Validate form
	fstaffadd.validate = function() {
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
			<?php if ($staff_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->LACode->caption(), $staff_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->FormerFileNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_FormerFileNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->FormerFileNumber->caption(), $staff_add->FormerFileNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->NRC->Required) { ?>
				elm = this.getElements("x" + infix + "_NRC");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->NRC->caption(), $staff_add->NRC->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->Title->Required) { ?>
				elm = this.getElements("x" + infix + "_Title");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->Title->caption(), $staff_add->Title->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->Surname->Required) { ?>
				elm = this.getElements("x" + infix + "_Surname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->Surname->caption(), $staff_add->Surname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->FirstName->caption(), $staff_add->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->MiddleName->Required) { ?>
				elm = this.getElements("x" + infix + "_MiddleName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->MiddleName->caption(), $staff_add->MiddleName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->Sex->Required) { ?>
				elm = this.getElements("x" + infix + "_Sex");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->Sex->caption(), $staff_add->Sex->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->StaffPhoto->Required) { ?>
				felm = this.getElements("x" + infix + "_StaffPhoto");
				elm = this.getElements("fn_x" + infix + "_StaffPhoto");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $staff_add->StaffPhoto->caption(), $staff_add->StaffPhoto->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->MaritalStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_MaritalStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->MaritalStatus->caption(), $staff_add->MaritalStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->MaidenName->Required) { ?>
				elm = this.getElements("x" + infix + "_MaidenName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->MaidenName->caption(), $staff_add->MaidenName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->DateOfBirth->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->DateOfBirth->caption(), $staff_add->DateOfBirth->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staff_add->DateOfBirth->errorMessage()) ?>");
			<?php if ($staff_add->AcademicQualification->Required) { ?>
				elm = this.getElements("x" + infix + "_AcademicQualification");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->AcademicQualification->caption(), $staff_add->AcademicQualification->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->ProfessionalQualification->Required) { ?>
				elm = this.getElements("x" + infix + "_ProfessionalQualification");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->ProfessionalQualification->caption(), $staff_add->ProfessionalQualification->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->MedicalCondition->Required) { ?>
				elm = this.getElements("x" + infix + "_MedicalCondition");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->MedicalCondition->caption(), $staff_add->MedicalCondition->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->OtherMedicalConditions->Required) { ?>
				elm = this.getElements("x" + infix + "_OtherMedicalConditions");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->OtherMedicalConditions->caption(), $staff_add->OtherMedicalConditions->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->PhysicalChallenge->Required) { ?>
				elm = this.getElements("x" + infix + "_PhysicalChallenge");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->PhysicalChallenge->caption(), $staff_add->PhysicalChallenge->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->PostalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PostalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->PostalAddress->caption(), $staff_add->PostalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->PhysicalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PhysicalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->PhysicalAddress->caption(), $staff_add->PhysicalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->TownOrVillage->Required) { ?>
				elm = this.getElements("x" + infix + "_TownOrVillage");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->TownOrVillage->caption(), $staff_add->TownOrVillage->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->Telephone->Required) { ?>
				elm = this.getElements("x" + infix + "_Telephone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->Telephone->caption(), $staff_add->Telephone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->Mobile->Required) { ?>
				elm = this.getElements("x" + infix + "_Mobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->Mobile->caption(), $staff_add->Mobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->Fax->Required) { ?>
				elm = this.getElements("x" + infix + "_Fax");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->Fax->caption(), $staff_add->Fax->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->_Email->caption(), $staff_add->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staff_add->_Email->errorMessage()) ?>");
			<?php if ($staff_add->NumberOfBiologicalChildren->Required) { ?>
				elm = this.getElements("x" + infix + "_NumberOfBiologicalChildren");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->NumberOfBiologicalChildren->caption(), $staff_add->NumberOfBiologicalChildren->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NumberOfBiologicalChildren");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staff_add->NumberOfBiologicalChildren->errorMessage()) ?>");
			<?php if ($staff_add->NumberOfDependants->Required) { ?>
				elm = this.getElements("x" + infix + "_NumberOfDependants");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->NumberOfDependants->caption(), $staff_add->NumberOfDependants->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NumberOfDependants");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staff_add->NumberOfDependants->errorMessage()) ?>");
			<?php if ($staff_add->NextOfKin->Required) { ?>
				elm = this.getElements("x" + infix + "_NextOfKin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->NextOfKin->caption(), $staff_add->NextOfKin->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->RelationshipCode->Required) { ?>
				elm = this.getElements("x" + infix + "_RelationshipCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->RelationshipCode->caption(), $staff_add->RelationshipCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->NextOfKinMobile->Required) { ?>
				elm = this.getElements("x" + infix + "_NextOfKinMobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->NextOfKinMobile->caption(), $staff_add->NextOfKinMobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->NextOfKinEmail->Required) { ?>
				elm = this.getElements("x" + infix + "_NextOfKinEmail");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->NextOfKinEmail->caption(), $staff_add->NextOfKinEmail->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NextOfKinEmail");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staff_add->NextOfKinEmail->errorMessage()) ?>");
			<?php if ($staff_add->SpouseName->Required) { ?>
				elm = this.getElements("x" + infix + "_SpouseName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->SpouseName->caption(), $staff_add->SpouseName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->SpouseNRC->Required) { ?>
				elm = this.getElements("x" + infix + "_SpouseNRC");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->SpouseNRC->caption(), $staff_add->SpouseNRC->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->SpouseMobile->Required) { ?>
				elm = this.getElements("x" + infix + "_SpouseMobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->SpouseMobile->caption(), $staff_add->SpouseMobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->SpouseEmail->Required) { ?>
				elm = this.getElements("x" + infix + "_SpouseEmail");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->SpouseEmail->caption(), $staff_add->SpouseEmail->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SpouseEmail");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staff_add->SpouseEmail->errorMessage()) ?>");
			<?php if ($staff_add->SpouseResidentialAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_SpouseResidentialAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->SpouseResidentialAddress->caption(), $staff_add->SpouseResidentialAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->AdditionalInformation->Required) { ?>
				elm = this.getElements("x" + infix + "_AdditionalInformation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->AdditionalInformation->caption(), $staff_add->AdditionalInformation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->LastUpdated->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdated");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->LastUpdated->caption(), $staff_add->LastUpdated->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->BankAccountNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BankAccountNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->BankAccountNo->caption(), $staff_add->BankAccountNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->PaymentMethod->Required) { ?>
				elm = this.getElements("x" + infix + "_PaymentMethod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->PaymentMethod->caption(), $staff_add->PaymentMethod->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->BankBranchCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BankBranchCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->BankBranchCode->caption(), $staff_add->BankBranchCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->TaxNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_TaxNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->TaxNumber->caption(), $staff_add->TaxNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->PensionNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_PensionNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->PensionNumber->caption(), $staff_add->PensionNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->SocialSecurityNo->Required) { ?>
				elm = this.getElements("x" + infix + "_SocialSecurityNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->SocialSecurityNo->caption(), $staff_add->SocialSecurityNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staff_add->ThirdParties->Required) { ?>
				elm = this.getElements("x" + infix + "_ThirdParties[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staff_add->ThirdParties->caption(), $staff_add->ThirdParties->RequiredErrorMessage)) ?>");
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
	fstaffadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffadd.lists["x_LACode"] = <?php echo $staff_add->LACode->Lookup->toClientList($staff_add) ?>;
	fstaffadd.lists["x_LACode"].options = <?php echo JsonEncode($staff_add->LACode->lookupOptions()) ?>;
	fstaffadd.lists["x_Title"] = <?php echo $staff_add->Title->Lookup->toClientList($staff_add) ?>;
	fstaffadd.lists["x_Title"].options = <?php echo JsonEncode($staff_add->Title->lookupOptions()) ?>;
	fstaffadd.lists["x_Sex"] = <?php echo $staff_add->Sex->Lookup->toClientList($staff_add) ?>;
	fstaffadd.lists["x_Sex"].options = <?php echo JsonEncode($staff_add->Sex->lookupOptions()) ?>;
	fstaffadd.lists["x_MaritalStatus"] = <?php echo $staff_add->MaritalStatus->Lookup->toClientList($staff_add) ?>;
	fstaffadd.lists["x_MaritalStatus"].options = <?php echo JsonEncode($staff_add->MaritalStatus->lookupOptions()) ?>;
	fstaffadd.lists["x_AcademicQualification"] = <?php echo $staff_add->AcademicQualification->Lookup->toClientList($staff_add) ?>;
	fstaffadd.lists["x_AcademicQualification"].options = <?php echo JsonEncode($staff_add->AcademicQualification->lookupOptions()) ?>;
	fstaffadd.lists["x_ProfessionalQualification"] = <?php echo $staff_add->ProfessionalQualification->Lookup->toClientList($staff_add) ?>;
	fstaffadd.lists["x_ProfessionalQualification"].options = <?php echo JsonEncode($staff_add->ProfessionalQualification->lookupOptions()) ?>;
	fstaffadd.lists["x_MedicalCondition"] = <?php echo $staff_add->MedicalCondition->Lookup->toClientList($staff_add) ?>;
	fstaffadd.lists["x_MedicalCondition"].options = <?php echo JsonEncode($staff_add->MedicalCondition->lookupOptions()) ?>;
	fstaffadd.lists["x_OtherMedicalConditions"] = <?php echo $staff_add->OtherMedicalConditions->Lookup->toClientList($staff_add) ?>;
	fstaffadd.lists["x_OtherMedicalConditions"].options = <?php echo JsonEncode($staff_add->OtherMedicalConditions->lookupOptions()) ?>;
	fstaffadd.lists["x_PhysicalChallenge"] = <?php echo $staff_add->PhysicalChallenge->Lookup->toClientList($staff_add) ?>;
	fstaffadd.lists["x_PhysicalChallenge"].options = <?php echo JsonEncode($staff_add->PhysicalChallenge->lookupOptions()) ?>;
	fstaffadd.lists["x_RelationshipCode"] = <?php echo $staff_add->RelationshipCode->Lookup->toClientList($staff_add) ?>;
	fstaffadd.lists["x_RelationshipCode"].options = <?php echo JsonEncode($staff_add->RelationshipCode->lookupOptions()) ?>;
	fstaffadd.lists["x_PaymentMethod"] = <?php echo $staff_add->PaymentMethod->Lookup->toClientList($staff_add) ?>;
	fstaffadd.lists["x_PaymentMethod"].options = <?php echo JsonEncode($staff_add->PaymentMethod->lookupOptions()) ?>;
	fstaffadd.lists["x_BankBranchCode"] = <?php echo $staff_add->BankBranchCode->Lookup->toClientList($staff_add) ?>;
	fstaffadd.lists["x_BankBranchCode"].options = <?php echo JsonEncode($staff_add->BankBranchCode->lookupOptions()) ?>;
	fstaffadd.lists["x_ThirdParties[]"] = <?php echo $staff_add->ThirdParties->Lookup->toClientList($staff_add) ?>;
	fstaffadd.lists["x_ThirdParties[]"].options = <?php echo JsonEncode($staff_add->ThirdParties->lookupOptions()) ?>;
	loadjs.done("fstaffadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staff_add->showPageHeader(); ?>
<?php
$staff_add->showMessage();
?>
<form name="fstaffadd" id="fstaffadd" class="<?php echo $staff_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staff">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$staff_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($staff_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_staff_LACode" for="x_LACode" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->LACode->caption() ?><?php echo $staff_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->LACode->cellAttributes() ?>>
<span id="el_staff_LACode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($staff_add->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_add->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_add->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_add->LACode->ReadOnly || $staff_add->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_add->LACode->Lookup->getParamTag($staff_add, "p_x_LACode") ?>
<input type="hidden" data-table="staff" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_add->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $staff_add->LACode->CurrentValue ?>"<?php echo $staff_add->LACode->editAttributes() ?>>
</span>
<?php echo $staff_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->FormerFileNumber->Visible) { // FormerFileNumber ?>
	<div id="r_FormerFileNumber" class="form-group row">
		<label id="elh_staff_FormerFileNumber" for="x_FormerFileNumber" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->FormerFileNumber->caption() ?><?php echo $staff_add->FormerFileNumber->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->FormerFileNumber->cellAttributes() ?>>
<span id="el_staff_FormerFileNumber">
<input type="text" data-table="staff" data-field="x_FormerFileNumber" name="x_FormerFileNumber" id="x_FormerFileNumber" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($staff_add->FormerFileNumber->getPlaceHolder()) ?>" value="<?php echo $staff_add->FormerFileNumber->EditValue ?>"<?php echo $staff_add->FormerFileNumber->editAttributes() ?>>
</span>
<?php echo $staff_add->FormerFileNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->NRC->Visible) { // NRC ?>
	<div id="r_NRC" class="form-group row">
		<label id="elh_staff_NRC" for="x_NRC" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->NRC->caption() ?><?php echo $staff_add->NRC->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->NRC->cellAttributes() ?>>
<span id="el_staff_NRC">
<input type="text" data-table="staff" data-field="x_NRC" name="x_NRC" id="x_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($staff_add->NRC->getPlaceHolder()) ?>" value="<?php echo $staff_add->NRC->EditValue ?>"<?php echo $staff_add->NRC->editAttributes() ?>>
</span>
<?php echo $staff_add->NRC->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->Title->Visible) { // Title ?>
	<div id="r_Title" class="form-group row">
		<label id="elh_staff_Title" for="x_Title" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->Title->caption() ?><?php echo $staff_add->Title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->Title->cellAttributes() ?>>
<span id="el_staff_Title">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_Title" data-value-separator="<?php echo $staff_add->Title->displayValueSeparatorAttribute() ?>" id="x_Title" name="x_Title"<?php echo $staff_add->Title->editAttributes() ?>>
			<?php echo $staff_add->Title->selectOptionListHtml("x_Title") ?>
		</select>
</div>
<?php echo $staff_add->Title->Lookup->getParamTag($staff_add, "p_x_Title") ?>
</span>
<?php echo $staff_add->Title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->Surname->Visible) { // Surname ?>
	<div id="r_Surname" class="form-group row">
		<label id="elh_staff_Surname" for="x_Surname" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->Surname->caption() ?><?php echo $staff_add->Surname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->Surname->cellAttributes() ?>>
<span id="el_staff_Surname">
<input type="text" data-table="staff" data-field="x_Surname" name="x_Surname" id="x_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($staff_add->Surname->getPlaceHolder()) ?>" value="<?php echo $staff_add->Surname->EditValue ?>"<?php echo $staff_add->Surname->editAttributes() ?>>
</span>
<?php echo $staff_add->Surname->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label id="elh_staff_FirstName" for="x_FirstName" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->FirstName->caption() ?><?php echo $staff_add->FirstName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->FirstName->cellAttributes() ?>>
<span id="el_staff_FirstName">
<input type="text" data-table="staff" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($staff_add->FirstName->getPlaceHolder()) ?>" value="<?php echo $staff_add->FirstName->EditValue ?>"<?php echo $staff_add->FirstName->editAttributes() ?>>
</span>
<?php echo $staff_add->FirstName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->MiddleName->Visible) { // MiddleName ?>
	<div id="r_MiddleName" class="form-group row">
		<label id="elh_staff_MiddleName" for="x_MiddleName" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->MiddleName->caption() ?><?php echo $staff_add->MiddleName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->MiddleName->cellAttributes() ?>>
<span id="el_staff_MiddleName">
<input type="text" data-table="staff" data-field="x_MiddleName" name="x_MiddleName" id="x_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($staff_add->MiddleName->getPlaceHolder()) ?>" value="<?php echo $staff_add->MiddleName->EditValue ?>"<?php echo $staff_add->MiddleName->editAttributes() ?>>
</span>
<?php echo $staff_add->MiddleName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->Sex->Visible) { // Sex ?>
	<div id="r_Sex" class="form-group row">
		<label id="elh_staff_Sex" for="x_Sex" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->Sex->caption() ?><?php echo $staff_add->Sex->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->Sex->cellAttributes() ?>>
<span id="el_staff_Sex">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_Sex" data-value-separator="<?php echo $staff_add->Sex->displayValueSeparatorAttribute() ?>" id="x_Sex" name="x_Sex"<?php echo $staff_add->Sex->editAttributes() ?>>
			<?php echo $staff_add->Sex->selectOptionListHtml("x_Sex") ?>
		</select>
</div>
<?php echo $staff_add->Sex->Lookup->getParamTag($staff_add, "p_x_Sex") ?>
</span>
<?php echo $staff_add->Sex->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->StaffPhoto->Visible) { // StaffPhoto ?>
	<div id="r_StaffPhoto" class="form-group row">
		<label id="elh_staff_StaffPhoto" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->StaffPhoto->caption() ?><?php echo $staff_add->StaffPhoto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->StaffPhoto->cellAttributes() ?>>
<span id="el_staff_StaffPhoto">
<div id="fd_x_StaffPhoto">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $staff_add->StaffPhoto->title() ?>" data-table="staff" data-field="x_StaffPhoto" name="x_StaffPhoto" id="x_StaffPhoto" lang="<?php echo CurrentLanguageID() ?>"<?php echo $staff_add->StaffPhoto->editAttributes() ?><?php if ($staff_add->StaffPhoto->ReadOnly || $staff_add->StaffPhoto->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_StaffPhoto"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_StaffPhoto" id= "fn_x_StaffPhoto" value="<?php echo $staff_add->StaffPhoto->Upload->FileName ?>">
<input type="hidden" name="fa_x_StaffPhoto" id= "fa_x_StaffPhoto" value="0">
<input type="hidden" name="fs_x_StaffPhoto" id= "fs_x_StaffPhoto" value="0">
<input type="hidden" name="fx_x_StaffPhoto" id= "fx_x_StaffPhoto" value="<?php echo $staff_add->StaffPhoto->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_StaffPhoto" id= "fm_x_StaffPhoto" value="<?php echo $staff_add->StaffPhoto->UploadMaxFileSize ?>">
</div>
<table id="ft_x_StaffPhoto" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $staff_add->StaffPhoto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->MaritalStatus->Visible) { // MaritalStatus ?>
	<div id="r_MaritalStatus" class="form-group row">
		<label id="elh_staff_MaritalStatus" for="x_MaritalStatus" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->MaritalStatus->caption() ?><?php echo $staff_add->MaritalStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->MaritalStatus->cellAttributes() ?>>
<span id="el_staff_MaritalStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_MaritalStatus" data-value-separator="<?php echo $staff_add->MaritalStatus->displayValueSeparatorAttribute() ?>" id="x_MaritalStatus" name="x_MaritalStatus"<?php echo $staff_add->MaritalStatus->editAttributes() ?>>
			<?php echo $staff_add->MaritalStatus->selectOptionListHtml("x_MaritalStatus") ?>
		</select>
</div>
<?php echo $staff_add->MaritalStatus->Lookup->getParamTag($staff_add, "p_x_MaritalStatus") ?>
</span>
<?php echo $staff_add->MaritalStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->MaidenName->Visible) { // MaidenName ?>
	<div id="r_MaidenName" class="form-group row">
		<label id="elh_staff_MaidenName" for="x_MaidenName" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->MaidenName->caption() ?><?php echo $staff_add->MaidenName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->MaidenName->cellAttributes() ?>>
<span id="el_staff_MaidenName">
<input type="text" data-table="staff" data-field="x_MaidenName" name="x_MaidenName" id="x_MaidenName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($staff_add->MaidenName->getPlaceHolder()) ?>" value="<?php echo $staff_add->MaidenName->EditValue ?>"<?php echo $staff_add->MaidenName->editAttributes() ?>>
</span>
<?php echo $staff_add->MaidenName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->DateOfBirth->Visible) { // DateOfBirth ?>
	<div id="r_DateOfBirth" class="form-group row">
		<label id="elh_staff_DateOfBirth" for="x_DateOfBirth" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->DateOfBirth->caption() ?><?php echo $staff_add->DateOfBirth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->DateOfBirth->cellAttributes() ?>>
<span id="el_staff_DateOfBirth">
<input type="text" data-table="staff" data-field="x_DateOfBirth" name="x_DateOfBirth" id="x_DateOfBirth" placeholder="<?php echo HtmlEncode($staff_add->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $staff_add->DateOfBirth->EditValue ?>"<?php echo $staff_add->DateOfBirth->editAttributes() ?>>
<?php if (!$staff_add->DateOfBirth->ReadOnly && !$staff_add->DateOfBirth->Disabled && !isset($staff_add->DateOfBirth->EditAttrs["readonly"]) && !isset($staff_add->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffadd", "x_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staff_add->DateOfBirth->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->AcademicQualification->Visible) { // AcademicQualification ?>
	<div id="r_AcademicQualification" class="form-group row">
		<label id="elh_staff_AcademicQualification" for="x_AcademicQualification" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->AcademicQualification->caption() ?><?php echo $staff_add->AcademicQualification->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->AcademicQualification->cellAttributes() ?>>
<span id="el_staff_AcademicQualification">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_AcademicQualification"><?php echo EmptyValue(strval($staff_add->AcademicQualification->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_add->AcademicQualification->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_add->AcademicQualification->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_add->AcademicQualification->ReadOnly || $staff_add->AcademicQualification->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_AcademicQualification',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_add->AcademicQualification->Lookup->getParamTag($staff_add, "p_x_AcademicQualification") ?>
<input type="hidden" data-table="staff" data-field="x_AcademicQualification" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_add->AcademicQualification->displayValueSeparatorAttribute() ?>" name="x_AcademicQualification" id="x_AcademicQualification" value="<?php echo $staff_add->AcademicQualification->CurrentValue ?>"<?php echo $staff_add->AcademicQualification->editAttributes() ?>>
</span>
<?php echo $staff_add->AcademicQualification->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->ProfessionalQualification->Visible) { // ProfessionalQualification ?>
	<div id="r_ProfessionalQualification" class="form-group row">
		<label id="elh_staff_ProfessionalQualification" for="x_ProfessionalQualification" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->ProfessionalQualification->caption() ?><?php echo $staff_add->ProfessionalQualification->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->ProfessionalQualification->cellAttributes() ?>>
<span id="el_staff_ProfessionalQualification">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ProfessionalQualification"><?php echo EmptyValue(strval($staff_add->ProfessionalQualification->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_add->ProfessionalQualification->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_add->ProfessionalQualification->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_add->ProfessionalQualification->ReadOnly || $staff_add->ProfessionalQualification->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ProfessionalQualification',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_add->ProfessionalQualification->Lookup->getParamTag($staff_add, "p_x_ProfessionalQualification") ?>
<input type="hidden" data-table="staff" data-field="x_ProfessionalQualification" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_add->ProfessionalQualification->displayValueSeparatorAttribute() ?>" name="x_ProfessionalQualification" id="x_ProfessionalQualification" value="<?php echo $staff_add->ProfessionalQualification->CurrentValue ?>"<?php echo $staff_add->ProfessionalQualification->editAttributes() ?>>
</span>
<?php echo $staff_add->ProfessionalQualification->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->MedicalCondition->Visible) { // MedicalCondition ?>
	<div id="r_MedicalCondition" class="form-group row">
		<label id="elh_staff_MedicalCondition" for="x_MedicalCondition" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->MedicalCondition->caption() ?><?php echo $staff_add->MedicalCondition->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->MedicalCondition->cellAttributes() ?>>
<span id="el_staff_MedicalCondition">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_MedicalCondition" data-value-separator="<?php echo $staff_add->MedicalCondition->displayValueSeparatorAttribute() ?>" id="x_MedicalCondition" name="x_MedicalCondition"<?php echo $staff_add->MedicalCondition->editAttributes() ?>>
			<?php echo $staff_add->MedicalCondition->selectOptionListHtml("x_MedicalCondition") ?>
		</select>
</div>
<?php echo $staff_add->MedicalCondition->Lookup->getParamTag($staff_add, "p_x_MedicalCondition") ?>
</span>
<?php echo $staff_add->MedicalCondition->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->OtherMedicalConditions->Visible) { // OtherMedicalConditions ?>
	<div id="r_OtherMedicalConditions" class="form-group row">
		<label id="elh_staff_OtherMedicalConditions" for="x_OtherMedicalConditions" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->OtherMedicalConditions->caption() ?><?php echo $staff_add->OtherMedicalConditions->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->OtherMedicalConditions->cellAttributes() ?>>
<span id="el_staff_OtherMedicalConditions">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_OtherMedicalConditions" data-value-separator="<?php echo $staff_add->OtherMedicalConditions->displayValueSeparatorAttribute() ?>" id="x_OtherMedicalConditions" name="x_OtherMedicalConditions"<?php echo $staff_add->OtherMedicalConditions->editAttributes() ?>>
			<?php echo $staff_add->OtherMedicalConditions->selectOptionListHtml("x_OtherMedicalConditions") ?>
		</select>
</div>
<?php echo $staff_add->OtherMedicalConditions->Lookup->getParamTag($staff_add, "p_x_OtherMedicalConditions") ?>
</span>
<?php echo $staff_add->OtherMedicalConditions->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->PhysicalChallenge->Visible) { // PhysicalChallenge ?>
	<div id="r_PhysicalChallenge" class="form-group row">
		<label id="elh_staff_PhysicalChallenge" for="x_PhysicalChallenge" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->PhysicalChallenge->caption() ?><?php echo $staff_add->PhysicalChallenge->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->PhysicalChallenge->cellAttributes() ?>>
<span id="el_staff_PhysicalChallenge">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_PhysicalChallenge" data-value-separator="<?php echo $staff_add->PhysicalChallenge->displayValueSeparatorAttribute() ?>" id="x_PhysicalChallenge" name="x_PhysicalChallenge"<?php echo $staff_add->PhysicalChallenge->editAttributes() ?>>
			<?php echo $staff_add->PhysicalChallenge->selectOptionListHtml("x_PhysicalChallenge") ?>
		</select>
</div>
<?php echo $staff_add->PhysicalChallenge->Lookup->getParamTag($staff_add, "p_x_PhysicalChallenge") ?>
</span>
<?php echo $staff_add->PhysicalChallenge->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->PostalAddress->Visible) { // PostalAddress ?>
	<div id="r_PostalAddress" class="form-group row">
		<label id="elh_staff_PostalAddress" for="x_PostalAddress" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->PostalAddress->caption() ?><?php echo $staff_add->PostalAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->PostalAddress->cellAttributes() ?>>
<span id="el_staff_PostalAddress">
<input type="text" data-table="staff" data-field="x_PostalAddress" name="x_PostalAddress" id="x_PostalAddress" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($staff_add->PostalAddress->getPlaceHolder()) ?>" value="<?php echo $staff_add->PostalAddress->EditValue ?>"<?php echo $staff_add->PostalAddress->editAttributes() ?>>
</span>
<?php echo $staff_add->PostalAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->PhysicalAddress->Visible) { // PhysicalAddress ?>
	<div id="r_PhysicalAddress" class="form-group row">
		<label id="elh_staff_PhysicalAddress" for="x_PhysicalAddress" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->PhysicalAddress->caption() ?><?php echo $staff_add->PhysicalAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->PhysicalAddress->cellAttributes() ?>>
<span id="el_staff_PhysicalAddress">
<input type="text" data-table="staff" data-field="x_PhysicalAddress" name="x_PhysicalAddress" id="x_PhysicalAddress" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($staff_add->PhysicalAddress->getPlaceHolder()) ?>" value="<?php echo $staff_add->PhysicalAddress->EditValue ?>"<?php echo $staff_add->PhysicalAddress->editAttributes() ?>>
</span>
<?php echo $staff_add->PhysicalAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->TownOrVillage->Visible) { // TownOrVillage ?>
	<div id="r_TownOrVillage" class="form-group row">
		<label id="elh_staff_TownOrVillage" for="x_TownOrVillage" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->TownOrVillage->caption() ?><?php echo $staff_add->TownOrVillage->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->TownOrVillage->cellAttributes() ?>>
<span id="el_staff_TownOrVillage">
<input type="text" data-table="staff" data-field="x_TownOrVillage" name="x_TownOrVillage" id="x_TownOrVillage" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_add->TownOrVillage->getPlaceHolder()) ?>" value="<?php echo $staff_add->TownOrVillage->EditValue ?>"<?php echo $staff_add->TownOrVillage->editAttributes() ?>>
</span>
<?php echo $staff_add->TownOrVillage->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->Telephone->Visible) { // Telephone ?>
	<div id="r_Telephone" class="form-group row">
		<label id="elh_staff_Telephone" for="x_Telephone" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->Telephone->caption() ?><?php echo $staff_add->Telephone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->Telephone->cellAttributes() ?>>
<span id="el_staff_Telephone">
<input type="text" data-table="staff" data-field="x_Telephone" name="x_Telephone" id="x_Telephone" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_add->Telephone->getPlaceHolder()) ?>" value="<?php echo $staff_add->Telephone->EditValue ?>"<?php echo $staff_add->Telephone->editAttributes() ?>>
</span>
<?php echo $staff_add->Telephone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->Mobile->Visible) { // Mobile ?>
	<div id="r_Mobile" class="form-group row">
		<label id="elh_staff_Mobile" for="x_Mobile" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->Mobile->caption() ?><?php echo $staff_add->Mobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->Mobile->cellAttributes() ?>>
<span id="el_staff_Mobile">
<input type="text" data-table="staff" data-field="x_Mobile" name="x_Mobile" id="x_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_add->Mobile->getPlaceHolder()) ?>" value="<?php echo $staff_add->Mobile->EditValue ?>"<?php echo $staff_add->Mobile->editAttributes() ?>>
</span>
<?php echo $staff_add->Mobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->Fax->Visible) { // Fax ?>
	<div id="r_Fax" class="form-group row">
		<label id="elh_staff_Fax" for="x_Fax" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->Fax->caption() ?><?php echo $staff_add->Fax->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->Fax->cellAttributes() ?>>
<span id="el_staff_Fax">
<input type="text" data-table="staff" data-field="x_Fax" name="x_Fax" id="x_Fax" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($staff_add->Fax->getPlaceHolder()) ?>" value="<?php echo $staff_add->Fax->EditValue ?>"<?php echo $staff_add->Fax->editAttributes() ?>>
</span>
<?php echo $staff_add->Fax->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_staff__Email" for="x__Email" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->_Email->caption() ?><?php echo $staff_add->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->_Email->cellAttributes() ?>>
<span id="el_staff__Email">
<input type="text" data-table="staff" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_add->_Email->getPlaceHolder()) ?>" value="<?php echo $staff_add->_Email->EditValue ?>"<?php echo $staff_add->_Email->editAttributes() ?>>
</span>
<?php echo $staff_add->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->NumberOfBiologicalChildren->Visible) { // NumberOfBiologicalChildren ?>
	<div id="r_NumberOfBiologicalChildren" class="form-group row">
		<label id="elh_staff_NumberOfBiologicalChildren" for="x_NumberOfBiologicalChildren" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->NumberOfBiologicalChildren->caption() ?><?php echo $staff_add->NumberOfBiologicalChildren->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->NumberOfBiologicalChildren->cellAttributes() ?>>
<span id="el_staff_NumberOfBiologicalChildren">
<input type="text" data-table="staff" data-field="x_NumberOfBiologicalChildren" name="x_NumberOfBiologicalChildren" id="x_NumberOfBiologicalChildren" size="30" placeholder="<?php echo HtmlEncode($staff_add->NumberOfBiologicalChildren->getPlaceHolder()) ?>" value="<?php echo $staff_add->NumberOfBiologicalChildren->EditValue ?>"<?php echo $staff_add->NumberOfBiologicalChildren->editAttributes() ?>>
</span>
<?php echo $staff_add->NumberOfBiologicalChildren->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->NumberOfDependants->Visible) { // NumberOfDependants ?>
	<div id="r_NumberOfDependants" class="form-group row">
		<label id="elh_staff_NumberOfDependants" for="x_NumberOfDependants" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->NumberOfDependants->caption() ?><?php echo $staff_add->NumberOfDependants->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->NumberOfDependants->cellAttributes() ?>>
<span id="el_staff_NumberOfDependants">
<input type="text" data-table="staff" data-field="x_NumberOfDependants" name="x_NumberOfDependants" id="x_NumberOfDependants" size="30" placeholder="<?php echo HtmlEncode($staff_add->NumberOfDependants->getPlaceHolder()) ?>" value="<?php echo $staff_add->NumberOfDependants->EditValue ?>"<?php echo $staff_add->NumberOfDependants->editAttributes() ?>>
</span>
<?php echo $staff_add->NumberOfDependants->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->NextOfKin->Visible) { // NextOfKin ?>
	<div id="r_NextOfKin" class="form-group row">
		<label id="elh_staff_NextOfKin" for="x_NextOfKin" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->NextOfKin->caption() ?><?php echo $staff_add->NextOfKin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->NextOfKin->cellAttributes() ?>>
<span id="el_staff_NextOfKin">
<input type="text" data-table="staff" data-field="x_NextOfKin" name="x_NextOfKin" id="x_NextOfKin" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_add->NextOfKin->getPlaceHolder()) ?>" value="<?php echo $staff_add->NextOfKin->EditValue ?>"<?php echo $staff_add->NextOfKin->editAttributes() ?>>
</span>
<?php echo $staff_add->NextOfKin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->RelationshipCode->Visible) { // RelationshipCode ?>
	<div id="r_RelationshipCode" class="form-group row">
		<label id="elh_staff_RelationshipCode" for="x_RelationshipCode" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->RelationshipCode->caption() ?><?php echo $staff_add->RelationshipCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->RelationshipCode->cellAttributes() ?>>
<span id="el_staff_RelationshipCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_RelationshipCode"><?php echo EmptyValue(strval($staff_add->RelationshipCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_add->RelationshipCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_add->RelationshipCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_add->RelationshipCode->ReadOnly || $staff_add->RelationshipCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_RelationshipCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_add->RelationshipCode->Lookup->getParamTag($staff_add, "p_x_RelationshipCode") ?>
<input type="hidden" data-table="staff" data-field="x_RelationshipCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_add->RelationshipCode->displayValueSeparatorAttribute() ?>" name="x_RelationshipCode" id="x_RelationshipCode" value="<?php echo $staff_add->RelationshipCode->CurrentValue ?>"<?php echo $staff_add->RelationshipCode->editAttributes() ?>>
</span>
<?php echo $staff_add->RelationshipCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
	<div id="r_NextOfKinMobile" class="form-group row">
		<label id="elh_staff_NextOfKinMobile" for="x_NextOfKinMobile" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->NextOfKinMobile->caption() ?><?php echo $staff_add->NextOfKinMobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->NextOfKinMobile->cellAttributes() ?>>
<span id="el_staff_NextOfKinMobile">
<input type="text" data-table="staff" data-field="x_NextOfKinMobile" name="x_NextOfKinMobile" id="x_NextOfKinMobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_add->NextOfKinMobile->getPlaceHolder()) ?>" value="<?php echo $staff_add->NextOfKinMobile->EditValue ?>"<?php echo $staff_add->NextOfKinMobile->editAttributes() ?>>
</span>
<?php echo $staff_add->NextOfKinMobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
	<div id="r_NextOfKinEmail" class="form-group row">
		<label id="elh_staff_NextOfKinEmail" for="x_NextOfKinEmail" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->NextOfKinEmail->caption() ?><?php echo $staff_add->NextOfKinEmail->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->NextOfKinEmail->cellAttributes() ?>>
<span id="el_staff_NextOfKinEmail">
<input type="text" data-table="staff" data-field="x_NextOfKinEmail" name="x_NextOfKinEmail" id="x_NextOfKinEmail" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_add->NextOfKinEmail->getPlaceHolder()) ?>" value="<?php echo $staff_add->NextOfKinEmail->EditValue ?>"<?php echo $staff_add->NextOfKinEmail->editAttributes() ?>>
</span>
<?php echo $staff_add->NextOfKinEmail->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->SpouseName->Visible) { // SpouseName ?>
	<div id="r_SpouseName" class="form-group row">
		<label id="elh_staff_SpouseName" for="x_SpouseName" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->SpouseName->caption() ?><?php echo $staff_add->SpouseName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->SpouseName->cellAttributes() ?>>
<span id="el_staff_SpouseName">
<input type="text" data-table="staff" data-field="x_SpouseName" name="x_SpouseName" id="x_SpouseName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_add->SpouseName->getPlaceHolder()) ?>" value="<?php echo $staff_add->SpouseName->EditValue ?>"<?php echo $staff_add->SpouseName->editAttributes() ?>>
</span>
<?php echo $staff_add->SpouseName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->SpouseNRC->Visible) { // SpouseNRC ?>
	<div id="r_SpouseNRC" class="form-group row">
		<label id="elh_staff_SpouseNRC" for="x_SpouseNRC" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->SpouseNRC->caption() ?><?php echo $staff_add->SpouseNRC->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->SpouseNRC->cellAttributes() ?>>
<span id="el_staff_SpouseNRC">
<input type="text" data-table="staff" data-field="x_SpouseNRC" name="x_SpouseNRC" id="x_SpouseNRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($staff_add->SpouseNRC->getPlaceHolder()) ?>" value="<?php echo $staff_add->SpouseNRC->EditValue ?>"<?php echo $staff_add->SpouseNRC->editAttributes() ?>>
</span>
<?php echo $staff_add->SpouseNRC->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->SpouseMobile->Visible) { // SpouseMobile ?>
	<div id="r_SpouseMobile" class="form-group row">
		<label id="elh_staff_SpouseMobile" for="x_SpouseMobile" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->SpouseMobile->caption() ?><?php echo $staff_add->SpouseMobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->SpouseMobile->cellAttributes() ?>>
<span id="el_staff_SpouseMobile">
<input type="text" data-table="staff" data-field="x_SpouseMobile" name="x_SpouseMobile" id="x_SpouseMobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_add->SpouseMobile->getPlaceHolder()) ?>" value="<?php echo $staff_add->SpouseMobile->EditValue ?>"<?php echo $staff_add->SpouseMobile->editAttributes() ?>>
</span>
<?php echo $staff_add->SpouseMobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->SpouseEmail->Visible) { // SpouseEmail ?>
	<div id="r_SpouseEmail" class="form-group row">
		<label id="elh_staff_SpouseEmail" for="x_SpouseEmail" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->SpouseEmail->caption() ?><?php echo $staff_add->SpouseEmail->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->SpouseEmail->cellAttributes() ?>>
<span id="el_staff_SpouseEmail">
<input type="text" data-table="staff" data-field="x_SpouseEmail" name="x_SpouseEmail" id="x_SpouseEmail" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_add->SpouseEmail->getPlaceHolder()) ?>" value="<?php echo $staff_add->SpouseEmail->EditValue ?>"<?php echo $staff_add->SpouseEmail->editAttributes() ?>>
</span>
<?php echo $staff_add->SpouseEmail->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->SpouseResidentialAddress->Visible) { // SpouseResidentialAddress ?>
	<div id="r_SpouseResidentialAddress" class="form-group row">
		<label id="elh_staff_SpouseResidentialAddress" for="x_SpouseResidentialAddress" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->SpouseResidentialAddress->caption() ?><?php echo $staff_add->SpouseResidentialAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->SpouseResidentialAddress->cellAttributes() ?>>
<span id="el_staff_SpouseResidentialAddress">
<input type="text" data-table="staff" data-field="x_SpouseResidentialAddress" name="x_SpouseResidentialAddress" id="x_SpouseResidentialAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_add->SpouseResidentialAddress->getPlaceHolder()) ?>" value="<?php echo $staff_add->SpouseResidentialAddress->EditValue ?>"<?php echo $staff_add->SpouseResidentialAddress->editAttributes() ?>>
</span>
<?php echo $staff_add->SpouseResidentialAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->AdditionalInformation->Visible) { // AdditionalInformation ?>
	<div id="r_AdditionalInformation" class="form-group row">
		<label id="elh_staff_AdditionalInformation" for="x_AdditionalInformation" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->AdditionalInformation->caption() ?><?php echo $staff_add->AdditionalInformation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->AdditionalInformation->cellAttributes() ?>>
<span id="el_staff_AdditionalInformation">
<textarea data-table="staff" data-field="x_AdditionalInformation" name="x_AdditionalInformation" id="x_AdditionalInformation" cols="35" rows="4" placeholder="<?php echo HtmlEncode($staff_add->AdditionalInformation->getPlaceHolder()) ?>"<?php echo $staff_add->AdditionalInformation->editAttributes() ?>><?php echo $staff_add->AdditionalInformation->EditValue ?></textarea>
</span>
<?php echo $staff_add->AdditionalInformation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->BankAccountNo->Visible) { // BankAccountNo ?>
	<div id="r_BankAccountNo" class="form-group row">
		<label id="elh_staff_BankAccountNo" for="x_BankAccountNo" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->BankAccountNo->caption() ?><?php echo $staff_add->BankAccountNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->BankAccountNo->cellAttributes() ?>>
<span id="el_staff_BankAccountNo">
<input type="text" data-table="staff" data-field="x_BankAccountNo" name="x_BankAccountNo" id="x_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($staff_add->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $staff_add->BankAccountNo->EditValue ?>"<?php echo $staff_add->BankAccountNo->editAttributes() ?>>
</span>
<?php echo $staff_add->BankAccountNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->PaymentMethod->Visible) { // PaymentMethod ?>
	<div id="r_PaymentMethod" class="form-group row">
		<label id="elh_staff_PaymentMethod" for="x_PaymentMethod" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->PaymentMethod->caption() ?><?php echo $staff_add->PaymentMethod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->PaymentMethod->cellAttributes() ?>>
<span id="el_staff_PaymentMethod">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_PaymentMethod" data-value-separator="<?php echo $staff_add->PaymentMethod->displayValueSeparatorAttribute() ?>" id="x_PaymentMethod" name="x_PaymentMethod"<?php echo $staff_add->PaymentMethod->editAttributes() ?>>
			<?php echo $staff_add->PaymentMethod->selectOptionListHtml("x_PaymentMethod") ?>
		</select>
</div>
<?php echo $staff_add->PaymentMethod->Lookup->getParamTag($staff_add, "p_x_PaymentMethod") ?>
</span>
<?php echo $staff_add->PaymentMethod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->BankBranchCode->Visible) { // BankBranchCode ?>
	<div id="r_BankBranchCode" class="form-group row">
		<label id="elh_staff_BankBranchCode" for="x_BankBranchCode" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->BankBranchCode->caption() ?><?php echo $staff_add->BankBranchCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->BankBranchCode->cellAttributes() ?>>
<span id="el_staff_BankBranchCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_BankBranchCode"><?php echo EmptyValue(strval($staff_add->BankBranchCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_add->BankBranchCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_add->BankBranchCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_add->BankBranchCode->ReadOnly || $staff_add->BankBranchCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_BankBranchCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_add->BankBranchCode->Lookup->getParamTag($staff_add, "p_x_BankBranchCode") ?>
<input type="hidden" data-table="staff" data-field="x_BankBranchCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_add->BankBranchCode->displayValueSeparatorAttribute() ?>" name="x_BankBranchCode" id="x_BankBranchCode" value="<?php echo $staff_add->BankBranchCode->CurrentValue ?>"<?php echo $staff_add->BankBranchCode->editAttributes() ?>>
</span>
<?php echo $staff_add->BankBranchCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->TaxNumber->Visible) { // TaxNumber ?>
	<div id="r_TaxNumber" class="form-group row">
		<label id="elh_staff_TaxNumber" for="x_TaxNumber" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->TaxNumber->caption() ?><?php echo $staff_add->TaxNumber->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->TaxNumber->cellAttributes() ?>>
<span id="el_staff_TaxNumber">
<input type="text" data-table="staff" data-field="x_TaxNumber" name="x_TaxNumber" id="x_TaxNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($staff_add->TaxNumber->getPlaceHolder()) ?>" value="<?php echo $staff_add->TaxNumber->EditValue ?>"<?php echo $staff_add->TaxNumber->editAttributes() ?>>
</span>
<?php echo $staff_add->TaxNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->PensionNumber->Visible) { // PensionNumber ?>
	<div id="r_PensionNumber" class="form-group row">
		<label id="elh_staff_PensionNumber" for="x_PensionNumber" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->PensionNumber->caption() ?><?php echo $staff_add->PensionNumber->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->PensionNumber->cellAttributes() ?>>
<span id="el_staff_PensionNumber">
<input type="text" data-table="staff" data-field="x_PensionNumber" name="x_PensionNumber" id="x_PensionNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($staff_add->PensionNumber->getPlaceHolder()) ?>" value="<?php echo $staff_add->PensionNumber->EditValue ?>"<?php echo $staff_add->PensionNumber->editAttributes() ?>>
</span>
<?php echo $staff_add->PensionNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
	<div id="r_SocialSecurityNo" class="form-group row">
		<label id="elh_staff_SocialSecurityNo" for="x_SocialSecurityNo" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->SocialSecurityNo->caption() ?><?php echo $staff_add->SocialSecurityNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->SocialSecurityNo->cellAttributes() ?>>
<span id="el_staff_SocialSecurityNo">
<input type="text" data-table="staff" data-field="x_SocialSecurityNo" name="x_SocialSecurityNo" id="x_SocialSecurityNo" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($staff_add->SocialSecurityNo->getPlaceHolder()) ?>" value="<?php echo $staff_add->SocialSecurityNo->EditValue ?>"<?php echo $staff_add->SocialSecurityNo->editAttributes() ?>>
</span>
<?php echo $staff_add->SocialSecurityNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staff_add->ThirdParties->Visible) { // ThirdParties ?>
	<div id="r_ThirdParties" class="form-group row">
		<label id="elh_staff_ThirdParties" class="<?php echo $staff_add->LeftColumnClass ?>"><?php echo $staff_add->ThirdParties->caption() ?><?php echo $staff_add->ThirdParties->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staff_add->RightColumnClass ?>"><div <?php echo $staff_add->ThirdParties->cellAttributes() ?>>
<span id="el_staff_ThirdParties">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ThirdParties"><?php echo EmptyValue(strval($staff_add->ThirdParties->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_add->ThirdParties->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_add->ThirdParties->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_add->ThirdParties->ReadOnly || $staff_add->ThirdParties->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ThirdParties[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_add->ThirdParties->Lookup->getParamTag($staff_add, "p_x_ThirdParties") ?>
<input type="hidden" data-table="staff" data-field="x_ThirdParties" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $staff_add->ThirdParties->displayValueSeparatorAttribute() ?>" name="x_ThirdParties[]" id="x_ThirdParties[]" value="<?php echo $staff_add->ThirdParties->CurrentValue ?>"<?php echo $staff_add->ThirdParties->editAttributes() ?>>
</span>
<?php echo $staff_add->ThirdParties->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if ($staff->getCurrentDetailTable() != "") { ?>
<?php
	$staff_add->DetailPages->ValidKeys = explode(",", $staff->getCurrentDetailTable());
	$firstActiveDetailTable = $staff_add->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="staff_add_details"><!-- tabs -->
	<ul class="<?php echo $staff_add->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("staffchildren", explode(",", $staff->getCurrentDetailTable())) && $staffchildren->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffchildren") {
			$firstActiveDetailTable = "staffchildren";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_add->DetailPages->pageStyle("staffchildren") ?>" href="#tab_staffchildren" data-toggle="tab"><?php echo $Language->tablePhrase("staffchildren", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("staffdisciplinary_action", explode(",", $staff->getCurrentDetailTable())) && $staffdisciplinary_action->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffdisciplinary_action") {
			$firstActiveDetailTable = "staffdisciplinary_action";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_add->DetailPages->pageStyle("staffdisciplinary_action") ?>" href="#tab_staffdisciplinary_action" data-toggle="tab"><?php echo $Language->tablePhrase("staffdisciplinary_action", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("staffdisciplinary_appeal", explode(",", $staff->getCurrentDetailTable())) && $staffdisciplinary_appeal->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffdisciplinary_appeal") {
			$firstActiveDetailTable = "staffdisciplinary_appeal";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_add->DetailPages->pageStyle("staffdisciplinary_appeal") ?>" href="#tab_staffdisciplinary_appeal" data-toggle="tab"><?php echo $Language->tablePhrase("staffdisciplinary_appeal", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("staffdisciplinary_case", explode(",", $staff->getCurrentDetailTable())) && $staffdisciplinary_case->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffdisciplinary_case") {
			$firstActiveDetailTable = "staffdisciplinary_case";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_add->DetailPages->pageStyle("staffdisciplinary_case") ?>" href="#tab_staffdisciplinary_case" data-toggle="tab"><?php echo $Language->tablePhrase("staffdisciplinary_case", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("staffexperience", explode(",", $staff->getCurrentDetailTable())) && $staffexperience->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffexperience") {
			$firstActiveDetailTable = "staffexperience";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_add->DetailPages->pageStyle("staffexperience") ?>" href="#tab_staffexperience" data-toggle="tab"><?php echo $Language->tablePhrase("staffexperience", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("staffprofbodies", explode(",", $staff->getCurrentDetailTable())) && $staffprofbodies->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffprofbodies") {
			$firstActiveDetailTable = "staffprofbodies";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_add->DetailPages->pageStyle("staffprofbodies") ?>" href="#tab_staffprofbodies" data-toggle="tab"><?php echo $Language->tablePhrase("staffprofbodies", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("staffqualifications_academic", explode(",", $staff->getCurrentDetailTable())) && $staffqualifications_academic->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffqualifications_academic") {
			$firstActiveDetailTable = "staffqualifications_academic";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_add->DetailPages->pageStyle("staffqualifications_academic") ?>" href="#tab_staffqualifications_academic" data-toggle="tab"><?php echo $Language->tablePhrase("staffqualifications_academic", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("staffqualifications_prof", explode(",", $staff->getCurrentDetailTable())) && $staffqualifications_prof->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffqualifications_prof") {
			$firstActiveDetailTable = "staffqualifications_prof";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_add->DetailPages->pageStyle("staffqualifications_prof") ?>" href="#tab_staffqualifications_prof" data-toggle="tab"><?php echo $Language->tablePhrase("staffqualifications_prof", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("employment", explode(",", $staff->getCurrentDetailTable())) && $employment->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "employment") {
			$firstActiveDetailTable = "employment";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $staff_add->DetailPages->pageStyle("employment") ?>" href="#tab_employment" data-toggle="tab"><?php echo $Language->tablePhrase("employment", "TblCaption") ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("staffchildren", explode(",", $staff->getCurrentDetailTable())) && $staffchildren->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffchildren")
			$firstActiveDetailTable = "staffchildren";
?>
		<div class="tab-pane <?php echo $staff_add->DetailPages->pageStyle("staffchildren") ?>" id="tab_staffchildren"><!-- page* -->
<?php include_once "staffchildrengrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("staffdisciplinary_action", explode(",", $staff->getCurrentDetailTable())) && $staffdisciplinary_action->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffdisciplinary_action")
			$firstActiveDetailTable = "staffdisciplinary_action";
?>
		<div class="tab-pane <?php echo $staff_add->DetailPages->pageStyle("staffdisciplinary_action") ?>" id="tab_staffdisciplinary_action"><!-- page* -->
<?php include_once "staffdisciplinary_actiongrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("staffdisciplinary_appeal", explode(",", $staff->getCurrentDetailTable())) && $staffdisciplinary_appeal->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffdisciplinary_appeal")
			$firstActiveDetailTable = "staffdisciplinary_appeal";
?>
		<div class="tab-pane <?php echo $staff_add->DetailPages->pageStyle("staffdisciplinary_appeal") ?>" id="tab_staffdisciplinary_appeal"><!-- page* -->
<?php include_once "staffdisciplinary_appealgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("staffdisciplinary_case", explode(",", $staff->getCurrentDetailTable())) && $staffdisciplinary_case->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffdisciplinary_case")
			$firstActiveDetailTable = "staffdisciplinary_case";
?>
		<div class="tab-pane <?php echo $staff_add->DetailPages->pageStyle("staffdisciplinary_case") ?>" id="tab_staffdisciplinary_case"><!-- page* -->
<?php include_once "staffdisciplinary_casegrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("staffexperience", explode(",", $staff->getCurrentDetailTable())) && $staffexperience->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffexperience")
			$firstActiveDetailTable = "staffexperience";
?>
		<div class="tab-pane <?php echo $staff_add->DetailPages->pageStyle("staffexperience") ?>" id="tab_staffexperience"><!-- page* -->
<?php include_once "staffexperiencegrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("staffprofbodies", explode(",", $staff->getCurrentDetailTable())) && $staffprofbodies->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffprofbodies")
			$firstActiveDetailTable = "staffprofbodies";
?>
		<div class="tab-pane <?php echo $staff_add->DetailPages->pageStyle("staffprofbodies") ?>" id="tab_staffprofbodies"><!-- page* -->
<?php include_once "staffprofbodiesgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("staffqualifications_academic", explode(",", $staff->getCurrentDetailTable())) && $staffqualifications_academic->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffqualifications_academic")
			$firstActiveDetailTable = "staffqualifications_academic";
?>
		<div class="tab-pane <?php echo $staff_add->DetailPages->pageStyle("staffqualifications_academic") ?>" id="tab_staffqualifications_academic"><!-- page* -->
<?php include_once "staffqualifications_academicgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("staffqualifications_prof", explode(",", $staff->getCurrentDetailTable())) && $staffqualifications_prof->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "staffqualifications_prof")
			$firstActiveDetailTable = "staffqualifications_prof";
?>
		<div class="tab-pane <?php echo $staff_add->DetailPages->pageStyle("staffqualifications_prof") ?>" id="tab_staffqualifications_prof"><!-- page* -->
<?php include_once "staffqualifications_profgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("employment", explode(",", $staff->getCurrentDetailTable())) && $employment->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "employment")
			$firstActiveDetailTable = "employment";
?>
		<div class="tab-pane <?php echo $staff_add->DetailPages->pageStyle("employment") ?>" id="tab_employment"><!-- page* -->
<?php include_once "employmentgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
<?php if (!$staff_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $staff_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staff_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$staff_add->showPageFooter();
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
$staff_add->terminate();
?>