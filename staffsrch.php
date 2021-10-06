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
$staff_search = new staff_search();

// Run the page
$staff_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staff_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($staff_search->IsModal) { ?>
	fstaffsearch = currentAdvancedSearchForm = new ew.Form("fstaffsearch", "search");
	<?php } else { ?>
	fstaffsearch = currentForm = new ew.Form("fstaffsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fstaffsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($staff_search->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DateOfBirth");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($staff_search->DateOfBirth->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_NumberOfBiologicalChildren");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($staff_search->NumberOfBiologicalChildren->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_NumberOfDependants");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($staff_search->NumberOfDependants->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_LastUpdated");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($staff_search->LastUpdated->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fstaffsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffsearch.lists["x_LACode"] = <?php echo $staff_search->LACode->Lookup->toClientList($staff_search) ?>;
	fstaffsearch.lists["x_LACode"].options = <?php echo JsonEncode($staff_search->LACode->lookupOptions()) ?>;
	fstaffsearch.lists["x_Title"] = <?php echo $staff_search->Title->Lookup->toClientList($staff_search) ?>;
	fstaffsearch.lists["x_Title"].options = <?php echo JsonEncode($staff_search->Title->lookupOptions()) ?>;
	fstaffsearch.lists["x_Sex"] = <?php echo $staff_search->Sex->Lookup->toClientList($staff_search) ?>;
	fstaffsearch.lists["x_Sex"].options = <?php echo JsonEncode($staff_search->Sex->lookupOptions()) ?>;
	fstaffsearch.lists["x_MaritalStatus"] = <?php echo $staff_search->MaritalStatus->Lookup->toClientList($staff_search) ?>;
	fstaffsearch.lists["x_MaritalStatus"].options = <?php echo JsonEncode($staff_search->MaritalStatus->lookupOptions()) ?>;
	fstaffsearch.lists["x_AcademicQualification"] = <?php echo $staff_search->AcademicQualification->Lookup->toClientList($staff_search) ?>;
	fstaffsearch.lists["x_AcademicQualification"].options = <?php echo JsonEncode($staff_search->AcademicQualification->lookupOptions()) ?>;
	fstaffsearch.lists["x_ProfessionalQualification"] = <?php echo $staff_search->ProfessionalQualification->Lookup->toClientList($staff_search) ?>;
	fstaffsearch.lists["x_ProfessionalQualification"].options = <?php echo JsonEncode($staff_search->ProfessionalQualification->lookupOptions()) ?>;
	fstaffsearch.lists["x_MedicalCondition"] = <?php echo $staff_search->MedicalCondition->Lookup->toClientList($staff_search) ?>;
	fstaffsearch.lists["x_MedicalCondition"].options = <?php echo JsonEncode($staff_search->MedicalCondition->lookupOptions()) ?>;
	fstaffsearch.lists["x_OtherMedicalConditions"] = <?php echo $staff_search->OtherMedicalConditions->Lookup->toClientList($staff_search) ?>;
	fstaffsearch.lists["x_OtherMedicalConditions"].options = <?php echo JsonEncode($staff_search->OtherMedicalConditions->lookupOptions()) ?>;
	fstaffsearch.lists["x_PhysicalChallenge"] = <?php echo $staff_search->PhysicalChallenge->Lookup->toClientList($staff_search) ?>;
	fstaffsearch.lists["x_PhysicalChallenge"].options = <?php echo JsonEncode($staff_search->PhysicalChallenge->lookupOptions()) ?>;
	fstaffsearch.lists["x_RelationshipCode"] = <?php echo $staff_search->RelationshipCode->Lookup->toClientList($staff_search) ?>;
	fstaffsearch.lists["x_RelationshipCode"].options = <?php echo JsonEncode($staff_search->RelationshipCode->lookupOptions()) ?>;
	fstaffsearch.lists["x_PaymentMethod"] = <?php echo $staff_search->PaymentMethod->Lookup->toClientList($staff_search) ?>;
	fstaffsearch.lists["x_PaymentMethod"].options = <?php echo JsonEncode($staff_search->PaymentMethod->lookupOptions()) ?>;
	fstaffsearch.lists["x_BankBranchCode"] = <?php echo $staff_search->BankBranchCode->Lookup->toClientList($staff_search) ?>;
	fstaffsearch.lists["x_BankBranchCode"].options = <?php echo JsonEncode($staff_search->BankBranchCode->lookupOptions()) ?>;
	fstaffsearch.lists["x_ThirdParties[]"] = <?php echo $staff_search->ThirdParties->Lookup->toClientList($staff_search) ?>;
	fstaffsearch.lists["x_ThirdParties[]"].options = <?php echo JsonEncode($staff_search->ThirdParties->lookupOptions()) ?>;
	loadjs.done("fstaffsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staff_search->showPageHeader(); ?>
<?php
$staff_search->showMessage();
?>
<form name="fstaffsearch" id="fstaffsearch" class="<?php echo $staff_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staff">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$staff_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($staff_search->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label for="x_EmployeeID" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_EmployeeID"><?php echo $staff_search->EmployeeID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->EmployeeID->cellAttributes() ?>>
			<span id="el_staff_EmployeeID" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" placeholder="<?php echo HtmlEncode($staff_search->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $staff_search->EmployeeID->EditValue ?>"<?php echo $staff_search->EmployeeID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label for="x_LACode" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_LACode"><?php echo $staff_search->LACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->LACode->cellAttributes() ?>>
			<span id="el_staff_LACode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($staff_search->LACode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_search->LACode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_search->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_search->LACode->ReadOnly || $staff_search->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_search->LACode->Lookup->getParamTag($staff_search, "p_x_LACode") ?>
<input type="hidden" data-table="staff" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_search->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $staff_search->LACode->AdvancedSearch->SearchValue ?>"<?php echo $staff_search->LACode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->FormerFileNumber->Visible) { // FormerFileNumber ?>
	<div id="r_FormerFileNumber" class="form-group row">
		<label for="x_FormerFileNumber" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_FormerFileNumber"><?php echo $staff_search->FormerFileNumber->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_FormerFileNumber" id="z_FormerFileNumber" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->FormerFileNumber->cellAttributes() ?>>
			<span id="el_staff_FormerFileNumber" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_FormerFileNumber" name="x_FormerFileNumber" id="x_FormerFileNumber" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($staff_search->FormerFileNumber->getPlaceHolder()) ?>" value="<?php echo $staff_search->FormerFileNumber->EditValue ?>"<?php echo $staff_search->FormerFileNumber->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->NRC->Visible) { // NRC ?>
	<div id="r_NRC" class="form-group row">
		<label for="x_NRC" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_NRC"><?php echo $staff_search->NRC->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_NRC" id="z_NRC" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->NRC->cellAttributes() ?>>
			<span id="el_staff_NRC" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_NRC" name="x_NRC" id="x_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($staff_search->NRC->getPlaceHolder()) ?>" value="<?php echo $staff_search->NRC->EditValue ?>"<?php echo $staff_search->NRC->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->Title->Visible) { // Title ?>
	<div id="r_Title" class="form-group row">
		<label for="x_Title" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_Title"><?php echo $staff_search->Title->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Title" id="z_Title" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->Title->cellAttributes() ?>>
			<span id="el_staff_Title" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_Title" data-value-separator="<?php echo $staff_search->Title->displayValueSeparatorAttribute() ?>" id="x_Title" name="x_Title"<?php echo $staff_search->Title->editAttributes() ?>>
			<?php echo $staff_search->Title->selectOptionListHtml("x_Title") ?>
		</select>
</div>
<?php echo $staff_search->Title->Lookup->getParamTag($staff_search, "p_x_Title") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->Surname->Visible) { // Surname ?>
	<div id="r_Surname" class="form-group row">
		<label for="x_Surname" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_Surname"><?php echo $staff_search->Surname->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Surname" id="z_Surname" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->Surname->cellAttributes() ?>>
			<span id="el_staff_Surname" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_Surname" name="x_Surname" id="x_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($staff_search->Surname->getPlaceHolder()) ?>" value="<?php echo $staff_search->Surname->EditValue ?>"<?php echo $staff_search->Surname->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label for="x_FirstName" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_FirstName"><?php echo $staff_search->FirstName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_FirstName" id="z_FirstName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->FirstName->cellAttributes() ?>>
			<span id="el_staff_FirstName" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($staff_search->FirstName->getPlaceHolder()) ?>" value="<?php echo $staff_search->FirstName->EditValue ?>"<?php echo $staff_search->FirstName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->MiddleName->Visible) { // MiddleName ?>
	<div id="r_MiddleName" class="form-group row">
		<label for="x_MiddleName" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_MiddleName"><?php echo $staff_search->MiddleName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_MiddleName" id="z_MiddleName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->MiddleName->cellAttributes() ?>>
			<span id="el_staff_MiddleName" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_MiddleName" name="x_MiddleName" id="x_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($staff_search->MiddleName->getPlaceHolder()) ?>" value="<?php echo $staff_search->MiddleName->EditValue ?>"<?php echo $staff_search->MiddleName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->Sex->Visible) { // Sex ?>
	<div id="r_Sex" class="form-group row">
		<label for="x_Sex" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_Sex"><?php echo $staff_search->Sex->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Sex" id="z_Sex" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->Sex->cellAttributes() ?>>
			<span id="el_staff_Sex" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_Sex" data-value-separator="<?php echo $staff_search->Sex->displayValueSeparatorAttribute() ?>" id="x_Sex" name="x_Sex"<?php echo $staff_search->Sex->editAttributes() ?>>
			<?php echo $staff_search->Sex->selectOptionListHtml("x_Sex") ?>
		</select>
</div>
<?php echo $staff_search->Sex->Lookup->getParamTag($staff_search, "p_x_Sex") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->MaritalStatus->Visible) { // MaritalStatus ?>
	<div id="r_MaritalStatus" class="form-group row">
		<label for="x_MaritalStatus" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_MaritalStatus"><?php echo $staff_search->MaritalStatus->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_MaritalStatus" id="z_MaritalStatus" value="=">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->MaritalStatus->cellAttributes() ?>>
			<span id="el_staff_MaritalStatus" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_MaritalStatus" data-value-separator="<?php echo $staff_search->MaritalStatus->displayValueSeparatorAttribute() ?>" id="x_MaritalStatus" name="x_MaritalStatus"<?php echo $staff_search->MaritalStatus->editAttributes() ?>>
			<?php echo $staff_search->MaritalStatus->selectOptionListHtml("x_MaritalStatus") ?>
		</select>
</div>
<?php echo $staff_search->MaritalStatus->Lookup->getParamTag($staff_search, "p_x_MaritalStatus") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->MaidenName->Visible) { // MaidenName ?>
	<div id="r_MaidenName" class="form-group row">
		<label for="x_MaidenName" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_MaidenName"><?php echo $staff_search->MaidenName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_MaidenName" id="z_MaidenName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->MaidenName->cellAttributes() ?>>
			<span id="el_staff_MaidenName" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_MaidenName" name="x_MaidenName" id="x_MaidenName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($staff_search->MaidenName->getPlaceHolder()) ?>" value="<?php echo $staff_search->MaidenName->EditValue ?>"<?php echo $staff_search->MaidenName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->DateOfBirth->Visible) { // DateOfBirth ?>
	<div id="r_DateOfBirth" class="form-group row">
		<label for="x_DateOfBirth" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_DateOfBirth"><?php echo $staff_search->DateOfBirth->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DateOfBirth" id="z_DateOfBirth" value="=">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->DateOfBirth->cellAttributes() ?>>
			<span id="el_staff_DateOfBirth" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_DateOfBirth" name="x_DateOfBirth" id="x_DateOfBirth" placeholder="<?php echo HtmlEncode($staff_search->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $staff_search->DateOfBirth->EditValue ?>"<?php echo $staff_search->DateOfBirth->editAttributes() ?>>
<?php if (!$staff_search->DateOfBirth->ReadOnly && !$staff_search->DateOfBirth->Disabled && !isset($staff_search->DateOfBirth->EditAttrs["readonly"]) && !isset($staff_search->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffsearch", "x_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->AcademicQualification->Visible) { // AcademicQualification ?>
	<div id="r_AcademicQualification" class="form-group row">
		<label for="x_AcademicQualification" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_AcademicQualification"><?php echo $staff_search->AcademicQualification->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AcademicQualification" id="z_AcademicQualification" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->AcademicQualification->cellAttributes() ?>>
			<span id="el_staff_AcademicQualification" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_AcademicQualification"><?php echo EmptyValue(strval($staff_search->AcademicQualification->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_search->AcademicQualification->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_search->AcademicQualification->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_search->AcademicQualification->ReadOnly || $staff_search->AcademicQualification->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_AcademicQualification',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_search->AcademicQualification->Lookup->getParamTag($staff_search, "p_x_AcademicQualification") ?>
<input type="hidden" data-table="staff" data-field="x_AcademicQualification" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_search->AcademicQualification->displayValueSeparatorAttribute() ?>" name="x_AcademicQualification" id="x_AcademicQualification" value="<?php echo $staff_search->AcademicQualification->AdvancedSearch->SearchValue ?>"<?php echo $staff_search->AcademicQualification->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->ProfessionalQualification->Visible) { // ProfessionalQualification ?>
	<div id="r_ProfessionalQualification" class="form-group row">
		<label for="x_ProfessionalQualification" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_ProfessionalQualification"><?php echo $staff_search->ProfessionalQualification->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ProfessionalQualification" id="z_ProfessionalQualification" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->ProfessionalQualification->cellAttributes() ?>>
			<span id="el_staff_ProfessionalQualification" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ProfessionalQualification"><?php echo EmptyValue(strval($staff_search->ProfessionalQualification->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_search->ProfessionalQualification->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_search->ProfessionalQualification->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_search->ProfessionalQualification->ReadOnly || $staff_search->ProfessionalQualification->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ProfessionalQualification',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_search->ProfessionalQualification->Lookup->getParamTag($staff_search, "p_x_ProfessionalQualification") ?>
<input type="hidden" data-table="staff" data-field="x_ProfessionalQualification" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_search->ProfessionalQualification->displayValueSeparatorAttribute() ?>" name="x_ProfessionalQualification" id="x_ProfessionalQualification" value="<?php echo $staff_search->ProfessionalQualification->AdvancedSearch->SearchValue ?>"<?php echo $staff_search->ProfessionalQualification->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->MedicalCondition->Visible) { // MedicalCondition ?>
	<div id="r_MedicalCondition" class="form-group row">
		<label for="x_MedicalCondition" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_MedicalCondition"><?php echo $staff_search->MedicalCondition->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_MedicalCondition" id="z_MedicalCondition" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->MedicalCondition->cellAttributes() ?>>
			<span id="el_staff_MedicalCondition" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_MedicalCondition" data-value-separator="<?php echo $staff_search->MedicalCondition->displayValueSeparatorAttribute() ?>" id="x_MedicalCondition" name="x_MedicalCondition"<?php echo $staff_search->MedicalCondition->editAttributes() ?>>
			<?php echo $staff_search->MedicalCondition->selectOptionListHtml("x_MedicalCondition") ?>
		</select>
</div>
<?php echo $staff_search->MedicalCondition->Lookup->getParamTag($staff_search, "p_x_MedicalCondition") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->OtherMedicalConditions->Visible) { // OtherMedicalConditions ?>
	<div id="r_OtherMedicalConditions" class="form-group row">
		<label for="x_OtherMedicalConditions" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_OtherMedicalConditions"><?php echo $staff_search->OtherMedicalConditions->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_OtherMedicalConditions" id="z_OtherMedicalConditions" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->OtherMedicalConditions->cellAttributes() ?>>
			<span id="el_staff_OtherMedicalConditions" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_OtherMedicalConditions" data-value-separator="<?php echo $staff_search->OtherMedicalConditions->displayValueSeparatorAttribute() ?>" id="x_OtherMedicalConditions" name="x_OtherMedicalConditions"<?php echo $staff_search->OtherMedicalConditions->editAttributes() ?>>
			<?php echo $staff_search->OtherMedicalConditions->selectOptionListHtml("x_OtherMedicalConditions") ?>
		</select>
</div>
<?php echo $staff_search->OtherMedicalConditions->Lookup->getParamTag($staff_search, "p_x_OtherMedicalConditions") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->PhysicalChallenge->Visible) { // PhysicalChallenge ?>
	<div id="r_PhysicalChallenge" class="form-group row">
		<label for="x_PhysicalChallenge" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_PhysicalChallenge"><?php echo $staff_search->PhysicalChallenge->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PhysicalChallenge" id="z_PhysicalChallenge" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->PhysicalChallenge->cellAttributes() ?>>
			<span id="el_staff_PhysicalChallenge" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_PhysicalChallenge" data-value-separator="<?php echo $staff_search->PhysicalChallenge->displayValueSeparatorAttribute() ?>" id="x_PhysicalChallenge" name="x_PhysicalChallenge"<?php echo $staff_search->PhysicalChallenge->editAttributes() ?>>
			<?php echo $staff_search->PhysicalChallenge->selectOptionListHtml("x_PhysicalChallenge") ?>
		</select>
</div>
<?php echo $staff_search->PhysicalChallenge->Lookup->getParamTag($staff_search, "p_x_PhysicalChallenge") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->PostalAddress->Visible) { // PostalAddress ?>
	<div id="r_PostalAddress" class="form-group row">
		<label for="x_PostalAddress" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_PostalAddress"><?php echo $staff_search->PostalAddress->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PostalAddress" id="z_PostalAddress" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->PostalAddress->cellAttributes() ?>>
			<span id="el_staff_PostalAddress" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_PostalAddress" name="x_PostalAddress" id="x_PostalAddress" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($staff_search->PostalAddress->getPlaceHolder()) ?>" value="<?php echo $staff_search->PostalAddress->EditValue ?>"<?php echo $staff_search->PostalAddress->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->PhysicalAddress->Visible) { // PhysicalAddress ?>
	<div id="r_PhysicalAddress" class="form-group row">
		<label for="x_PhysicalAddress" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_PhysicalAddress"><?php echo $staff_search->PhysicalAddress->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PhysicalAddress" id="z_PhysicalAddress" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->PhysicalAddress->cellAttributes() ?>>
			<span id="el_staff_PhysicalAddress" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_PhysicalAddress" name="x_PhysicalAddress" id="x_PhysicalAddress" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($staff_search->PhysicalAddress->getPlaceHolder()) ?>" value="<?php echo $staff_search->PhysicalAddress->EditValue ?>"<?php echo $staff_search->PhysicalAddress->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->TownOrVillage->Visible) { // TownOrVillage ?>
	<div id="r_TownOrVillage" class="form-group row">
		<label for="x_TownOrVillage" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_TownOrVillage"><?php echo $staff_search->TownOrVillage->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_TownOrVillage" id="z_TownOrVillage" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->TownOrVillage->cellAttributes() ?>>
			<span id="el_staff_TownOrVillage" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_TownOrVillage" name="x_TownOrVillage" id="x_TownOrVillage" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_search->TownOrVillage->getPlaceHolder()) ?>" value="<?php echo $staff_search->TownOrVillage->EditValue ?>"<?php echo $staff_search->TownOrVillage->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->Telephone->Visible) { // Telephone ?>
	<div id="r_Telephone" class="form-group row">
		<label for="x_Telephone" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_Telephone"><?php echo $staff_search->Telephone->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Telephone" id="z_Telephone" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->Telephone->cellAttributes() ?>>
			<span id="el_staff_Telephone" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_Telephone" name="x_Telephone" id="x_Telephone" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_search->Telephone->getPlaceHolder()) ?>" value="<?php echo $staff_search->Telephone->EditValue ?>"<?php echo $staff_search->Telephone->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->Mobile->Visible) { // Mobile ?>
	<div id="r_Mobile" class="form-group row">
		<label for="x_Mobile" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_Mobile"><?php echo $staff_search->Mobile->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Mobile" id="z_Mobile" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->Mobile->cellAttributes() ?>>
			<span id="el_staff_Mobile" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_Mobile" name="x_Mobile" id="x_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_search->Mobile->getPlaceHolder()) ?>" value="<?php echo $staff_search->Mobile->EditValue ?>"<?php echo $staff_search->Mobile->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->Fax->Visible) { // Fax ?>
	<div id="r_Fax" class="form-group row">
		<label for="x_Fax" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_Fax"><?php echo $staff_search->Fax->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Fax" id="z_Fax" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->Fax->cellAttributes() ?>>
			<span id="el_staff_Fax" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_Fax" name="x_Fax" id="x_Fax" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($staff_search->Fax->getPlaceHolder()) ?>" value="<?php echo $staff_search->Fax->EditValue ?>"<?php echo $staff_search->Fax->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label for="x__Email" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff__Email"><?php echo $staff_search->_Email->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z__Email" id="z__Email" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->_Email->cellAttributes() ?>>
			<span id="el_staff__Email" class="ew-search-field">
<input type="text" data-table="staff" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_search->_Email->getPlaceHolder()) ?>" value="<?php echo $staff_search->_Email->EditValue ?>"<?php echo $staff_search->_Email->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->NumberOfBiologicalChildren->Visible) { // NumberOfBiologicalChildren ?>
	<div id="r_NumberOfBiologicalChildren" class="form-group row">
		<label for="x_NumberOfBiologicalChildren" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_NumberOfBiologicalChildren"><?php echo $staff_search->NumberOfBiologicalChildren->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_NumberOfBiologicalChildren" id="z_NumberOfBiologicalChildren" value="=">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->NumberOfBiologicalChildren->cellAttributes() ?>>
			<span id="el_staff_NumberOfBiologicalChildren" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_NumberOfBiologicalChildren" name="x_NumberOfBiologicalChildren" id="x_NumberOfBiologicalChildren" size="30" placeholder="<?php echo HtmlEncode($staff_search->NumberOfBiologicalChildren->getPlaceHolder()) ?>" value="<?php echo $staff_search->NumberOfBiologicalChildren->EditValue ?>"<?php echo $staff_search->NumberOfBiologicalChildren->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->NumberOfDependants->Visible) { // NumberOfDependants ?>
	<div id="r_NumberOfDependants" class="form-group row">
		<label for="x_NumberOfDependants" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_NumberOfDependants"><?php echo $staff_search->NumberOfDependants->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_NumberOfDependants" id="z_NumberOfDependants" value="=">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->NumberOfDependants->cellAttributes() ?>>
			<span id="el_staff_NumberOfDependants" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_NumberOfDependants" name="x_NumberOfDependants" id="x_NumberOfDependants" size="30" placeholder="<?php echo HtmlEncode($staff_search->NumberOfDependants->getPlaceHolder()) ?>" value="<?php echo $staff_search->NumberOfDependants->EditValue ?>"<?php echo $staff_search->NumberOfDependants->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->NextOfKin->Visible) { // NextOfKin ?>
	<div id="r_NextOfKin" class="form-group row">
		<label for="x_NextOfKin" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_NextOfKin"><?php echo $staff_search->NextOfKin->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_NextOfKin" id="z_NextOfKin" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->NextOfKin->cellAttributes() ?>>
			<span id="el_staff_NextOfKin" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_NextOfKin" name="x_NextOfKin" id="x_NextOfKin" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_search->NextOfKin->getPlaceHolder()) ?>" value="<?php echo $staff_search->NextOfKin->EditValue ?>"<?php echo $staff_search->NextOfKin->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->RelationshipCode->Visible) { // RelationshipCode ?>
	<div id="r_RelationshipCode" class="form-group row">
		<label for="x_RelationshipCode" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_RelationshipCode"><?php echo $staff_search->RelationshipCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_RelationshipCode" id="z_RelationshipCode" value="=">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->RelationshipCode->cellAttributes() ?>>
			<span id="el_staff_RelationshipCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_RelationshipCode"><?php echo EmptyValue(strval($staff_search->RelationshipCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_search->RelationshipCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_search->RelationshipCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_search->RelationshipCode->ReadOnly || $staff_search->RelationshipCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_RelationshipCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_search->RelationshipCode->Lookup->getParamTag($staff_search, "p_x_RelationshipCode") ?>
<input type="hidden" data-table="staff" data-field="x_RelationshipCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_search->RelationshipCode->displayValueSeparatorAttribute() ?>" name="x_RelationshipCode" id="x_RelationshipCode" value="<?php echo $staff_search->RelationshipCode->AdvancedSearch->SearchValue ?>"<?php echo $staff_search->RelationshipCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
	<div id="r_NextOfKinMobile" class="form-group row">
		<label for="x_NextOfKinMobile" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_NextOfKinMobile"><?php echo $staff_search->NextOfKinMobile->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_NextOfKinMobile" id="z_NextOfKinMobile" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->NextOfKinMobile->cellAttributes() ?>>
			<span id="el_staff_NextOfKinMobile" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_NextOfKinMobile" name="x_NextOfKinMobile" id="x_NextOfKinMobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_search->NextOfKinMobile->getPlaceHolder()) ?>" value="<?php echo $staff_search->NextOfKinMobile->EditValue ?>"<?php echo $staff_search->NextOfKinMobile->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
	<div id="r_NextOfKinEmail" class="form-group row">
		<label for="x_NextOfKinEmail" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_NextOfKinEmail"><?php echo $staff_search->NextOfKinEmail->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_NextOfKinEmail" id="z_NextOfKinEmail" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->NextOfKinEmail->cellAttributes() ?>>
			<span id="el_staff_NextOfKinEmail" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_NextOfKinEmail" name="x_NextOfKinEmail" id="x_NextOfKinEmail" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_search->NextOfKinEmail->getPlaceHolder()) ?>" value="<?php echo $staff_search->NextOfKinEmail->EditValue ?>"<?php echo $staff_search->NextOfKinEmail->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->SpouseName->Visible) { // SpouseName ?>
	<div id="r_SpouseName" class="form-group row">
		<label for="x_SpouseName" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_SpouseName"><?php echo $staff_search->SpouseName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SpouseName" id="z_SpouseName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->SpouseName->cellAttributes() ?>>
			<span id="el_staff_SpouseName" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_SpouseName" name="x_SpouseName" id="x_SpouseName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_search->SpouseName->getPlaceHolder()) ?>" value="<?php echo $staff_search->SpouseName->EditValue ?>"<?php echo $staff_search->SpouseName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->SpouseNRC->Visible) { // SpouseNRC ?>
	<div id="r_SpouseNRC" class="form-group row">
		<label for="x_SpouseNRC" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_SpouseNRC"><?php echo $staff_search->SpouseNRC->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SpouseNRC" id="z_SpouseNRC" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->SpouseNRC->cellAttributes() ?>>
			<span id="el_staff_SpouseNRC" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_SpouseNRC" name="x_SpouseNRC" id="x_SpouseNRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($staff_search->SpouseNRC->getPlaceHolder()) ?>" value="<?php echo $staff_search->SpouseNRC->EditValue ?>"<?php echo $staff_search->SpouseNRC->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->SpouseMobile->Visible) { // SpouseMobile ?>
	<div id="r_SpouseMobile" class="form-group row">
		<label for="x_SpouseMobile" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_SpouseMobile"><?php echo $staff_search->SpouseMobile->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SpouseMobile" id="z_SpouseMobile" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->SpouseMobile->cellAttributes() ?>>
			<span id="el_staff_SpouseMobile" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_SpouseMobile" name="x_SpouseMobile" id="x_SpouseMobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_search->SpouseMobile->getPlaceHolder()) ?>" value="<?php echo $staff_search->SpouseMobile->EditValue ?>"<?php echo $staff_search->SpouseMobile->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->SpouseEmail->Visible) { // SpouseEmail ?>
	<div id="r_SpouseEmail" class="form-group row">
		<label for="x_SpouseEmail" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_SpouseEmail"><?php echo $staff_search->SpouseEmail->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SpouseEmail" id="z_SpouseEmail" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->SpouseEmail->cellAttributes() ?>>
			<span id="el_staff_SpouseEmail" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_SpouseEmail" name="x_SpouseEmail" id="x_SpouseEmail" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_search->SpouseEmail->getPlaceHolder()) ?>" value="<?php echo $staff_search->SpouseEmail->EditValue ?>"<?php echo $staff_search->SpouseEmail->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->SpouseResidentialAddress->Visible) { // SpouseResidentialAddress ?>
	<div id="r_SpouseResidentialAddress" class="form-group row">
		<label for="x_SpouseResidentialAddress" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_SpouseResidentialAddress"><?php echo $staff_search->SpouseResidentialAddress->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SpouseResidentialAddress" id="z_SpouseResidentialAddress" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->SpouseResidentialAddress->cellAttributes() ?>>
			<span id="el_staff_SpouseResidentialAddress" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_SpouseResidentialAddress" name="x_SpouseResidentialAddress" id="x_SpouseResidentialAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staff_search->SpouseResidentialAddress->getPlaceHolder()) ?>" value="<?php echo $staff_search->SpouseResidentialAddress->EditValue ?>"<?php echo $staff_search->SpouseResidentialAddress->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->AdditionalInformation->Visible) { // AdditionalInformation ?>
	<div id="r_AdditionalInformation" class="form-group row">
		<label for="x_AdditionalInformation" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_AdditionalInformation"><?php echo $staff_search->AdditionalInformation->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AdditionalInformation" id="z_AdditionalInformation" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->AdditionalInformation->cellAttributes() ?>>
			<span id="el_staff_AdditionalInformation" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_AdditionalInformation" name="x_AdditionalInformation" id="x_AdditionalInformation" size="35" placeholder="<?php echo HtmlEncode($staff_search->AdditionalInformation->getPlaceHolder()) ?>" value="<?php echo $staff_search->AdditionalInformation->EditValue ?>"<?php echo $staff_search->AdditionalInformation->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->LastUserID->Visible) { // LastUserID ?>
	<div id="r_LastUserID" class="form-group row">
		<label for="x_LastUserID" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_LastUserID"><?php echo $staff_search->LastUserID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LastUserID" id="z_LastUserID" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->LastUserID->cellAttributes() ?>>
			<span id="el_staff_LastUserID" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_LastUserID" name="x_LastUserID" id="x_LastUserID" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($staff_search->LastUserID->getPlaceHolder()) ?>" value="<?php echo $staff_search->LastUserID->EditValue ?>"<?php echo $staff_search->LastUserID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->LastUpdated->Visible) { // LastUpdated ?>
	<div id="r_LastUpdated" class="form-group row">
		<label for="x_LastUpdated" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_LastUpdated"><?php echo $staff_search->LastUpdated->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LastUpdated" id="z_LastUpdated" value="=">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->LastUpdated->cellAttributes() ?>>
			<span id="el_staff_LastUpdated" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_LastUpdated" name="x_LastUpdated" id="x_LastUpdated" placeholder="<?php echo HtmlEncode($staff_search->LastUpdated->getPlaceHolder()) ?>" value="<?php echo $staff_search->LastUpdated->EditValue ?>"<?php echo $staff_search->LastUpdated->editAttributes() ?>>
<?php if (!$staff_search->LastUpdated->ReadOnly && !$staff_search->LastUpdated->Disabled && !isset($staff_search->LastUpdated->EditAttrs["readonly"]) && !isset($staff_search->LastUpdated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffsearch", "x_LastUpdated", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->BankAccountNo->Visible) { // BankAccountNo ?>
	<div id="r_BankAccountNo" class="form-group row">
		<label for="x_BankAccountNo" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_BankAccountNo"><?php echo $staff_search->BankAccountNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_BankAccountNo" id="z_BankAccountNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->BankAccountNo->cellAttributes() ?>>
			<span id="el_staff_BankAccountNo" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_BankAccountNo" name="x_BankAccountNo" id="x_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($staff_search->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $staff_search->BankAccountNo->EditValue ?>"<?php echo $staff_search->BankAccountNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->PaymentMethod->Visible) { // PaymentMethod ?>
	<div id="r_PaymentMethod" class="form-group row">
		<label for="x_PaymentMethod" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_PaymentMethod"><?php echo $staff_search->PaymentMethod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PaymentMethod" id="z_PaymentMethod" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->PaymentMethod->cellAttributes() ?>>
			<span id="el_staff_PaymentMethod" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staff" data-field="x_PaymentMethod" data-value-separator="<?php echo $staff_search->PaymentMethod->displayValueSeparatorAttribute() ?>" id="x_PaymentMethod" name="x_PaymentMethod"<?php echo $staff_search->PaymentMethod->editAttributes() ?>>
			<?php echo $staff_search->PaymentMethod->selectOptionListHtml("x_PaymentMethod") ?>
		</select>
</div>
<?php echo $staff_search->PaymentMethod->Lookup->getParamTag($staff_search, "p_x_PaymentMethod") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->BankBranchCode->Visible) { // BankBranchCode ?>
	<div id="r_BankBranchCode" class="form-group row">
		<label for="x_BankBranchCode" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_BankBranchCode"><?php echo $staff_search->BankBranchCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_BankBranchCode" id="z_BankBranchCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->BankBranchCode->cellAttributes() ?>>
			<span id="el_staff_BankBranchCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_BankBranchCode"><?php echo EmptyValue(strval($staff_search->BankBranchCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_search->BankBranchCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_search->BankBranchCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_search->BankBranchCode->ReadOnly || $staff_search->BankBranchCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_BankBranchCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_search->BankBranchCode->Lookup->getParamTag($staff_search, "p_x_BankBranchCode") ?>
<input type="hidden" data-table="staff" data-field="x_BankBranchCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staff_search->BankBranchCode->displayValueSeparatorAttribute() ?>" name="x_BankBranchCode" id="x_BankBranchCode" value="<?php echo $staff_search->BankBranchCode->AdvancedSearch->SearchValue ?>"<?php echo $staff_search->BankBranchCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->TaxNumber->Visible) { // TaxNumber ?>
	<div id="r_TaxNumber" class="form-group row">
		<label for="x_TaxNumber" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_TaxNumber"><?php echo $staff_search->TaxNumber->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_TaxNumber" id="z_TaxNumber" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->TaxNumber->cellAttributes() ?>>
			<span id="el_staff_TaxNumber" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_TaxNumber" name="x_TaxNumber" id="x_TaxNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($staff_search->TaxNumber->getPlaceHolder()) ?>" value="<?php echo $staff_search->TaxNumber->EditValue ?>"<?php echo $staff_search->TaxNumber->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->PensionNumber->Visible) { // PensionNumber ?>
	<div id="r_PensionNumber" class="form-group row">
		<label for="x_PensionNumber" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_PensionNumber"><?php echo $staff_search->PensionNumber->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PensionNumber" id="z_PensionNumber" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->PensionNumber->cellAttributes() ?>>
			<span id="el_staff_PensionNumber" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_PensionNumber" name="x_PensionNumber" id="x_PensionNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($staff_search->PensionNumber->getPlaceHolder()) ?>" value="<?php echo $staff_search->PensionNumber->EditValue ?>"<?php echo $staff_search->PensionNumber->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
	<div id="r_SocialSecurityNo" class="form-group row">
		<label for="x_SocialSecurityNo" class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_SocialSecurityNo"><?php echo $staff_search->SocialSecurityNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SocialSecurityNo" id="z_SocialSecurityNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->SocialSecurityNo->cellAttributes() ?>>
			<span id="el_staff_SocialSecurityNo" class="ew-search-field">
<input type="text" data-table="staff" data-field="x_SocialSecurityNo" name="x_SocialSecurityNo" id="x_SocialSecurityNo" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($staff_search->SocialSecurityNo->getPlaceHolder()) ?>" value="<?php echo $staff_search->SocialSecurityNo->EditValue ?>"<?php echo $staff_search->SocialSecurityNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staff_search->ThirdParties->Visible) { // ThirdParties ?>
	<div id="r_ThirdParties" class="form-group row">
		<label class="<?php echo $staff_search->LeftColumnClass ?>"><span id="elh_staff_ThirdParties"><?php echo $staff_search->ThirdParties->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ThirdParties" id="z_ThirdParties" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staff_search->RightColumnClass ?>"><div <?php echo $staff_search->ThirdParties->cellAttributes() ?>>
			<span id="el_staff_ThirdParties" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ThirdParties"><?php echo EmptyValue(strval($staff_search->ThirdParties->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $staff_search->ThirdParties->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staff_search->ThirdParties->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staff_search->ThirdParties->ReadOnly || $staff_search->ThirdParties->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ThirdParties[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staff_search->ThirdParties->Lookup->getParamTag($staff_search, "p_x_ThirdParties") ?>
<input type="hidden" data-table="staff" data-field="x_ThirdParties" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $staff_search->ThirdParties->displayValueSeparatorAttribute() ?>" name="x_ThirdParties[]" id="x_ThirdParties[]" value="<?php echo $staff_search->ThirdParties->AdvancedSearch->SearchValue ?>"<?php echo $staff_search->ThirdParties->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$staff_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $staff_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$staff_search->showPageFooter();
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
$staff_search->terminate();
?>