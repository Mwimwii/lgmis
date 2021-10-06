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
$employment_search = new employment_search();

// Run the page
$employment_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femploymentsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($employment_search->IsModal) { ?>
	femploymentsearch = currentAdvancedSearchForm = new ew.Form("femploymentsearch", "search");
	<?php } else { ?>
	femploymentsearch = currentForm = new ew.Form("femploymentsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	femploymentsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_search->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DateOfCurrentAppointment");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_search->DateOfCurrentAppointment->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_LastAppraisalDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_search->LastAppraisalDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DateOfExit");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_search->DateOfExit->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BasicMonthlySalary");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_search->BasicMonthlySalary->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PayrollCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_search->PayrollCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DateOfConfirmation");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_search->DateOfConfirmation->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	femploymentsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femploymentsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femploymentsearch.lists["x_ProvinceCode"] = <?php echo $employment_search->ProvinceCode->Lookup->toClientList($employment_search) ?>;
	femploymentsearch.lists["x_ProvinceCode"].options = <?php echo JsonEncode($employment_search->ProvinceCode->lookupOptions()) ?>;
	femploymentsearch.lists["x_LACode"] = <?php echo $employment_search->LACode->Lookup->toClientList($employment_search) ?>;
	femploymentsearch.lists["x_LACode"].options = <?php echo JsonEncode($employment_search->LACode->lookupOptions()) ?>;
	femploymentsearch.lists["x_DepartmentCode"] = <?php echo $employment_search->DepartmentCode->Lookup->toClientList($employment_search) ?>;
	femploymentsearch.lists["x_DepartmentCode"].options = <?php echo JsonEncode($employment_search->DepartmentCode->lookupOptions()) ?>;
	femploymentsearch.lists["x_SectionCode"] = <?php echo $employment_search->SectionCode->Lookup->toClientList($employment_search) ?>;
	femploymentsearch.lists["x_SectionCode"].options = <?php echo JsonEncode($employment_search->SectionCode->lookupOptions()) ?>;
	femploymentsearch.lists["x_SubstantivePosition"] = <?php echo $employment_search->SubstantivePosition->Lookup->toClientList($employment_search) ?>;
	femploymentsearch.lists["x_SubstantivePosition"].options = <?php echo JsonEncode($employment_search->SubstantivePosition->lookupOptions()) ?>;
	femploymentsearch.lists["x_AppraisalStatus"] = <?php echo $employment_search->AppraisalStatus->Lookup->toClientList($employment_search) ?>;
	femploymentsearch.lists["x_AppraisalStatus"].options = <?php echo JsonEncode($employment_search->AppraisalStatus->lookupOptions()) ?>;
	femploymentsearch.lists["x_SalaryScale"] = <?php echo $employment_search->SalaryScale->Lookup->toClientList($employment_search) ?>;
	femploymentsearch.lists["x_SalaryScale"].options = <?php echo JsonEncode($employment_search->SalaryScale->lookupOptions()) ?>;
	femploymentsearch.autoSuggests["x_SalaryScale"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	femploymentsearch.lists["x_EmploymentType"] = <?php echo $employment_search->EmploymentType->Lookup->toClientList($employment_search) ?>;
	femploymentsearch.lists["x_EmploymentType"].options = <?php echo JsonEncode($employment_search->EmploymentType->lookupOptions()) ?>;
	femploymentsearch.lists["x_EmploymentStatus"] = <?php echo $employment_search->EmploymentStatus->Lookup->toClientList($employment_search) ?>;
	femploymentsearch.lists["x_EmploymentStatus"].options = <?php echo JsonEncode($employment_search->EmploymentStatus->lookupOptions()) ?>;
	femploymentsearch.lists["x_ExitReason"] = <?php echo $employment_search->ExitReason->Lookup->toClientList($employment_search) ?>;
	femploymentsearch.lists["x_ExitReason"].options = <?php echo JsonEncode($employment_search->ExitReason->lookupOptions()) ?>;
	femploymentsearch.lists["x_RetirementType"] = <?php echo $employment_search->RetirementType->Lookup->toClientList($employment_search) ?>;
	femploymentsearch.lists["x_RetirementType"].options = <?php echo JsonEncode($employment_search->RetirementType->lookupOptions()) ?>;
	femploymentsearch.lists["x_SalaryNotch"] = <?php echo $employment_search->SalaryNotch->Lookup->toClientList($employment_search) ?>;
	femploymentsearch.lists["x_SalaryNotch"].options = <?php echo JsonEncode($employment_search->SalaryNotch->lookupOptions()) ?>;
	femploymentsearch.lists["x_ThirdParties[]"] = <?php echo $employment_search->ThirdParties->Lookup->toClientList($employment_search) ?>;
	femploymentsearch.lists["x_ThirdParties[]"].options = <?php echo JsonEncode($employment_search->ThirdParties->lookupOptions()) ?>;
	loadjs.done("femploymentsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employment_search->showPageHeader(); ?>
<?php
$employment_search->showMessage();
?>
<form name="femploymentsearch" id="femploymentsearch" class="<?php echo $employment_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employment">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$employment_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($employment_search->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label for="x_EmployeeID" class="<?php echo $employment_search->LeftColumnClass ?>"><span id="elh_employment_EmployeeID"><?php echo $employment_search->EmployeeID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		</label>
		<div class="<?php echo $employment_search->RightColumnClass ?>"><div <?php echo $employment_search->EmployeeID->cellAttributes() ?>>
			<span id="el_employment_EmployeeID" class="ew-search-field">
<input type="text" data-table="employment" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employment_search->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employment_search->EmployeeID->EditValue ?>"<?php echo $employment_search->EmployeeID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_search->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label for="x_ProvinceCode" class="<?php echo $employment_search->LeftColumnClass ?>"><span id="elh_employment_ProvinceCode"><?php echo $employment_search->ProvinceCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ProvinceCode" id="z_ProvinceCode" value="=">
</span>
		</label>
		<div class="<?php echo $employment_search->RightColumnClass ?>"><div <?php echo $employment_search->ProvinceCode->cellAttributes() ?>>
			<span id="el_employment_ProvinceCode" class="ew-search-field">
<?php $employment_search->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_ProvinceCode" data-value-separator="<?php echo $employment_search->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $employment_search->ProvinceCode->editAttributes() ?>>
			<?php echo $employment_search->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $employment_search->ProvinceCode->Lookup->getParamTag($employment_search, "p_x_ProvinceCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_search->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label for="x_LACode" class="<?php echo $employment_search->LeftColumnClass ?>"><span id="elh_employment_LACode"><?php echo $employment_search->LACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $employment_search->RightColumnClass ?>"><div <?php echo $employment_search->LACode->cellAttributes() ?>>
			<span id="el_employment_LACode" class="ew-search-field">
<?php $employment_search->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($employment_search->LACode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_search->LACode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_search->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_search->LACode->ReadOnly || $employment_search->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_search->LACode->Lookup->getParamTag($employment_search, "p_x_LACode") ?>
<input type="hidden" data-table="employment" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_search->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $employment_search->LACode->AdvancedSearch->SearchValue ?>"<?php echo $employment_search->LACode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_search->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label for="x_DepartmentCode" class="<?php echo $employment_search->LeftColumnClass ?>"><span id="elh_employment_DepartmentCode"><?php echo $employment_search->DepartmentCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DepartmentCode" id="z_DepartmentCode" value="=">
</span>
		</label>
		<div class="<?php echo $employment_search->RightColumnClass ?>"><div <?php echo $employment_search->DepartmentCode->cellAttributes() ?>>
			<span id="el_employment_DepartmentCode" class="ew-search-field">
<?php $employment_search->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DepartmentCode"><?php echo EmptyValue(strval($employment_search->DepartmentCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_search->DepartmentCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_search->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_search->DepartmentCode->ReadOnly || $employment_search->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_search->DepartmentCode->Lookup->getParamTag($employment_search, "p_x_DepartmentCode") ?>
<input type="hidden" data-table="employment" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_search->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo $employment_search->DepartmentCode->AdvancedSearch->SearchValue ?>"<?php echo $employment_search->DepartmentCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_search->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label for="x_SectionCode" class="<?php echo $employment_search->LeftColumnClass ?>"><span id="elh_employment_SectionCode"><?php echo $employment_search->SectionCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SectionCode" id="z_SectionCode" value="=">
</span>
		</label>
		<div class="<?php echo $employment_search->RightColumnClass ?>"><div <?php echo $employment_search->SectionCode->cellAttributes() ?>>
			<span id="el_employment_SectionCode" class="ew-search-field">
<?php $employment_search->SectionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_SectionCode"><?php echo EmptyValue(strval($employment_search->SectionCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_search->SectionCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_search->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_search->SectionCode->ReadOnly || $employment_search->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_search->SectionCode->Lookup->getParamTag($employment_search, "p_x_SectionCode") ?>
<input type="hidden" data-table="employment" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_search->SectionCode->displayValueSeparatorAttribute() ?>" name="x_SectionCode" id="x_SectionCode" value="<?php echo $employment_search->SectionCode->AdvancedSearch->SearchValue ?>"<?php echo $employment_search->SectionCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_search->SubstantivePosition->Visible) { // SubstantivePosition ?>
	<div id="r_SubstantivePosition" class="form-group row">
		<label for="x_SubstantivePosition" class="<?php echo $employment_search->LeftColumnClass ?>"><span id="elh_employment_SubstantivePosition"><?php echo $employment_search->SubstantivePosition->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SubstantivePosition" id="z_SubstantivePosition" value="=">
</span>
		</label>
		<div class="<?php echo $employment_search->RightColumnClass ?>"><div <?php echo $employment_search->SubstantivePosition->cellAttributes() ?>>
			<span id="el_employment_SubstantivePosition" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_SubstantivePosition"><?php echo EmptyValue(strval($employment_search->SubstantivePosition->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_search->SubstantivePosition->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_search->SubstantivePosition->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_search->SubstantivePosition->ReadOnly || $employment_search->SubstantivePosition->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_SubstantivePosition',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_search->SubstantivePosition->Lookup->getParamTag($employment_search, "p_x_SubstantivePosition") ?>
<input type="hidden" data-table="employment" data-field="x_SubstantivePosition" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_search->SubstantivePosition->displayValueSeparatorAttribute() ?>" name="x_SubstantivePosition" id="x_SubstantivePosition" value="<?php echo $employment_search->SubstantivePosition->AdvancedSearch->SearchValue ?>"<?php echo $employment_search->SubstantivePosition->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_search->DateOfCurrentAppointment->Visible) { // DateOfCurrentAppointment ?>
	<div id="r_DateOfCurrentAppointment" class="form-group row">
		<label for="x_DateOfCurrentAppointment" class="<?php echo $employment_search->LeftColumnClass ?>"><span id="elh_employment_DateOfCurrentAppointment"><?php echo $employment_search->DateOfCurrentAppointment->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DateOfCurrentAppointment" id="z_DateOfCurrentAppointment" value="=">
</span>
		</label>
		<div class="<?php echo $employment_search->RightColumnClass ?>"><div <?php echo $employment_search->DateOfCurrentAppointment->cellAttributes() ?>>
			<span id="el_employment_DateOfCurrentAppointment" class="ew-search-field">
<input type="text" data-table="employment" data-field="x_DateOfCurrentAppointment" name="x_DateOfCurrentAppointment" id="x_DateOfCurrentAppointment" placeholder="<?php echo HtmlEncode($employment_search->DateOfCurrentAppointment->getPlaceHolder()) ?>" value="<?php echo $employment_search->DateOfCurrentAppointment->EditValue ?>"<?php echo $employment_search->DateOfCurrentAppointment->editAttributes() ?>>
<?php if (!$employment_search->DateOfCurrentAppointment->ReadOnly && !$employment_search->DateOfCurrentAppointment->Disabled && !isset($employment_search->DateOfCurrentAppointment->EditAttrs["readonly"]) && !isset($employment_search->DateOfCurrentAppointment->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentsearch", "x_DateOfCurrentAppointment", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_search->LastAppraisalDate->Visible) { // LastAppraisalDate ?>
	<div id="r_LastAppraisalDate" class="form-group row">
		<label for="x_LastAppraisalDate" class="<?php echo $employment_search->LeftColumnClass ?>"><span id="elh_employment_LastAppraisalDate"><?php echo $employment_search->LastAppraisalDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LastAppraisalDate" id="z_LastAppraisalDate" value="=">
</span>
		</label>
		<div class="<?php echo $employment_search->RightColumnClass ?>"><div <?php echo $employment_search->LastAppraisalDate->cellAttributes() ?>>
			<span id="el_employment_LastAppraisalDate" class="ew-search-field">
<input type="text" data-table="employment" data-field="x_LastAppraisalDate" name="x_LastAppraisalDate" id="x_LastAppraisalDate" placeholder="<?php echo HtmlEncode($employment_search->LastAppraisalDate->getPlaceHolder()) ?>" value="<?php echo $employment_search->LastAppraisalDate->EditValue ?>"<?php echo $employment_search->LastAppraisalDate->editAttributes() ?>>
<?php if (!$employment_search->LastAppraisalDate->ReadOnly && !$employment_search->LastAppraisalDate->Disabled && !isset($employment_search->LastAppraisalDate->EditAttrs["readonly"]) && !isset($employment_search->LastAppraisalDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentsearch", "x_LastAppraisalDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_search->AppraisalStatus->Visible) { // AppraisalStatus ?>
	<div id="r_AppraisalStatus" class="form-group row">
		<label for="x_AppraisalStatus" class="<?php echo $employment_search->LeftColumnClass ?>"><span id="elh_employment_AppraisalStatus"><?php echo $employment_search->AppraisalStatus->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AppraisalStatus" id="z_AppraisalStatus" value="=">
</span>
		</label>
		<div class="<?php echo $employment_search->RightColumnClass ?>"><div <?php echo $employment_search->AppraisalStatus->cellAttributes() ?>>
			<span id="el_employment_AppraisalStatus" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_AppraisalStatus" data-value-separator="<?php echo $employment_search->AppraisalStatus->displayValueSeparatorAttribute() ?>" id="x_AppraisalStatus" name="x_AppraisalStatus"<?php echo $employment_search->AppraisalStatus->editAttributes() ?>>
			<?php echo $employment_search->AppraisalStatus->selectOptionListHtml("x_AppraisalStatus") ?>
		</select>
</div>
<?php echo $employment_search->AppraisalStatus->Lookup->getParamTag($employment_search, "p_x_AppraisalStatus") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_search->DateOfExit->Visible) { // DateOfExit ?>
	<div id="r_DateOfExit" class="form-group row">
		<label for="x_DateOfExit" class="<?php echo $employment_search->LeftColumnClass ?>"><span id="elh_employment_DateOfExit"><?php echo $employment_search->DateOfExit->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DateOfExit" id="z_DateOfExit" value="=">
</span>
		</label>
		<div class="<?php echo $employment_search->RightColumnClass ?>"><div <?php echo $employment_search->DateOfExit->cellAttributes() ?>>
			<span id="el_employment_DateOfExit" class="ew-search-field">
<input type="text" data-table="employment" data-field="x_DateOfExit" name="x_DateOfExit" id="x_DateOfExit" placeholder="<?php echo HtmlEncode($employment_search->DateOfExit->getPlaceHolder()) ?>" value="<?php echo $employment_search->DateOfExit->EditValue ?>"<?php echo $employment_search->DateOfExit->editAttributes() ?>>
<?php if (!$employment_search->DateOfExit->ReadOnly && !$employment_search->DateOfExit->Disabled && !isset($employment_search->DateOfExit->EditAttrs["readonly"]) && !isset($employment_search->DateOfExit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentsearch", "x_DateOfExit", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_search->SalaryScale->Visible) { // SalaryScale ?>
	<div id="r_SalaryScale" class="form-group row">
		<label class="<?php echo $employment_search->LeftColumnClass ?>"><span id="elh_employment_SalaryScale"><?php echo $employment_search->SalaryScale->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SalaryScale" id="z_SalaryScale" value="LIKE">
</span>
		</label>
		<div class="<?php echo $employment_search->RightColumnClass ?>"><div <?php echo $employment_search->SalaryScale->cellAttributes() ?>>
			<span id="el_employment_SalaryScale" class="ew-search-field">
<?php
$onchange = $employment_search->SalaryScale->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employment_search->SalaryScale->EditAttrs["onchange"] = "";
?>
<span id="as_x_SalaryScale">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_SalaryScale" id="sv_x_SalaryScale" value="<?php echo RemoveHtml($employment_search->SalaryScale->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_search->SalaryScale->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employment_search->SalaryScale->getPlaceHolder()) ?>"<?php echo $employment_search->SalaryScale->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_search->SalaryScale->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_SalaryScale',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($employment_search->SalaryScale->ReadOnly || $employment_search->SalaryScale->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="employment" data-field="x_SalaryScale" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_search->SalaryScale->displayValueSeparatorAttribute() ?>" name="x_SalaryScale" id="x_SalaryScale" value="<?php echo HtmlEncode($employment_search->SalaryScale->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femploymentsearch"], function() {
	femploymentsearch.createAutoSuggest({"id":"x_SalaryScale","forceSelect":true});
});
</script>
<?php echo $employment_search->SalaryScale->Lookup->getParamTag($employment_search, "p_x_SalaryScale") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_search->EmploymentType->Visible) { // EmploymentType ?>
	<div id="r_EmploymentType" class="form-group row">
		<label for="x_EmploymentType" class="<?php echo $employment_search->LeftColumnClass ?>"><span id="elh_employment_EmploymentType"><?php echo $employment_search->EmploymentType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmploymentType" id="z_EmploymentType" value="=">
</span>
		</label>
		<div class="<?php echo $employment_search->RightColumnClass ?>"><div <?php echo $employment_search->EmploymentType->cellAttributes() ?>>
			<span id="el_employment_EmploymentType" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_EmploymentType" data-value-separator="<?php echo $employment_search->EmploymentType->displayValueSeparatorAttribute() ?>" id="x_EmploymentType" name="x_EmploymentType"<?php echo $employment_search->EmploymentType->editAttributes() ?>>
			<?php echo $employment_search->EmploymentType->selectOptionListHtml("x_EmploymentType") ?>
		</select>
</div>
<?php echo $employment_search->EmploymentType->Lookup->getParamTag($employment_search, "p_x_EmploymentType") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_search->EmploymentStatus->Visible) { // EmploymentStatus ?>
	<div id="r_EmploymentStatus" class="form-group row">
		<label for="x_EmploymentStatus" class="<?php echo $employment_search->LeftColumnClass ?>"><span id="elh_employment_EmploymentStatus"><?php echo $employment_search->EmploymentStatus->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmploymentStatus" id="z_EmploymentStatus" value="=">
</span>
		</label>
		<div class="<?php echo $employment_search->RightColumnClass ?>"><div <?php echo $employment_search->EmploymentStatus->cellAttributes() ?>>
			<span id="el_employment_EmploymentStatus" class="ew-search-field">
<?php $employment_search->EmploymentStatus->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_EmploymentStatus" data-value-separator="<?php echo $employment_search->EmploymentStatus->displayValueSeparatorAttribute() ?>" id="x_EmploymentStatus" name="x_EmploymentStatus"<?php echo $employment_search->EmploymentStatus->editAttributes() ?>>
			<?php echo $employment_search->EmploymentStatus->selectOptionListHtml("x_EmploymentStatus") ?>
		</select>
</div>
<?php echo $employment_search->EmploymentStatus->Lookup->getParamTag($employment_search, "p_x_EmploymentStatus") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_search->ExitReason->Visible) { // ExitReason ?>
	<div id="r_ExitReason" class="form-group row">
		<label for="x_ExitReason" class="<?php echo $employment_search->LeftColumnClass ?>"><span id="elh_employment_ExitReason"><?php echo $employment_search->ExitReason->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ExitReason" id="z_ExitReason" value="=">
</span>
		</label>
		<div class="<?php echo $employment_search->RightColumnClass ?>"><div <?php echo $employment_search->ExitReason->cellAttributes() ?>>
			<span id="el_employment_ExitReason" class="ew-search-field">
<?php $employment_search->ExitReason->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_ExitReason" data-value-separator="<?php echo $employment_search->ExitReason->displayValueSeparatorAttribute() ?>" id="x_ExitReason" name="x_ExitReason"<?php echo $employment_search->ExitReason->editAttributes() ?>>
			<?php echo $employment_search->ExitReason->selectOptionListHtml("x_ExitReason") ?>
		</select>
</div>
<?php echo $employment_search->ExitReason->Lookup->getParamTag($employment_search, "p_x_ExitReason") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_search->RetirementType->Visible) { // RetirementType ?>
	<div id="r_RetirementType" class="form-group row">
		<label for="x_RetirementType" class="<?php echo $employment_search->LeftColumnClass ?>"><span id="elh_employment_RetirementType"><?php echo $employment_search->RetirementType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_RetirementType" id="z_RetirementType" value="=">
</span>
		</label>
		<div class="<?php echo $employment_search->RightColumnClass ?>"><div <?php echo $employment_search->RetirementType->cellAttributes() ?>>
			<span id="el_employment_RetirementType" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_RetirementType" data-value-separator="<?php echo $employment_search->RetirementType->displayValueSeparatorAttribute() ?>" id="x_RetirementType" name="x_RetirementType"<?php echo $employment_search->RetirementType->editAttributes() ?>>
			<?php echo $employment_search->RetirementType->selectOptionListHtml("x_RetirementType") ?>
		</select>
</div>
<?php echo $employment_search->RetirementType->Lookup->getParamTag($employment_search, "p_x_RetirementType") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_search->EmployeeNumber->Visible) { // EmployeeNumber ?>
	<div id="r_EmployeeNumber" class="form-group row">
		<label for="x_EmployeeNumber" class="<?php echo $employment_search->LeftColumnClass ?>"><span id="elh_employment_EmployeeNumber"><?php echo $employment_search->EmployeeNumber->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_EmployeeNumber" id="z_EmployeeNumber" value="LIKE">
</span>
		</label>
		<div class="<?php echo $employment_search->RightColumnClass ?>"><div <?php echo $employment_search->EmployeeNumber->cellAttributes() ?>>
			<span id="el_employment_EmployeeNumber" class="ew-search-field">
<input type="text" data-table="employment" data-field="x_EmployeeNumber" name="x_EmployeeNumber" id="x_EmployeeNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($employment_search->EmployeeNumber->getPlaceHolder()) ?>" value="<?php echo $employment_search->EmployeeNumber->EditValue ?>"<?php echo $employment_search->EmployeeNumber->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_search->SalaryNotch->Visible) { // SalaryNotch ?>
	<div id="r_SalaryNotch" class="form-group row">
		<label for="x_SalaryNotch" class="<?php echo $employment_search->LeftColumnClass ?>"><span id="elh_employment_SalaryNotch"><?php echo $employment_search->SalaryNotch->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SalaryNotch" id="z_SalaryNotch" value="=">
</span>
		</label>
		<div class="<?php echo $employment_search->RightColumnClass ?>"><div <?php echo $employment_search->SalaryNotch->cellAttributes() ?>>
			<span id="el_employment_SalaryNotch" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_SalaryNotch"><?php echo EmptyValue(strval($employment_search->SalaryNotch->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_search->SalaryNotch->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_search->SalaryNotch->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_search->SalaryNotch->ReadOnly || $employment_search->SalaryNotch->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_SalaryNotch',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_search->SalaryNotch->Lookup->getParamTag($employment_search, "p_x_SalaryNotch") ?>
<input type="hidden" data-table="employment" data-field="x_SalaryNotch" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_search->SalaryNotch->displayValueSeparatorAttribute() ?>" name="x_SalaryNotch" id="x_SalaryNotch" value="<?php echo $employment_search->SalaryNotch->AdvancedSearch->SearchValue ?>"<?php echo $employment_search->SalaryNotch->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_search->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
	<div id="r_BasicMonthlySalary" class="form-group row">
		<label for="x_BasicMonthlySalary" class="<?php echo $employment_search->LeftColumnClass ?>"><span id="elh_employment_BasicMonthlySalary"><?php echo $employment_search->BasicMonthlySalary->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BasicMonthlySalary" id="z_BasicMonthlySalary" value="=">
</span>
		</label>
		<div class="<?php echo $employment_search->RightColumnClass ?>"><div <?php echo $employment_search->BasicMonthlySalary->cellAttributes() ?>>
			<span id="el_employment_BasicMonthlySalary" class="ew-search-field">
<input type="text" data-table="employment" data-field="x_BasicMonthlySalary" name="x_BasicMonthlySalary" id="x_BasicMonthlySalary" size="30" placeholder="<?php echo HtmlEncode($employment_search->BasicMonthlySalary->getPlaceHolder()) ?>" value="<?php echo $employment_search->BasicMonthlySalary->EditValue ?>"<?php echo $employment_search->BasicMonthlySalary->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_search->ThirdParties->Visible) { // ThirdParties ?>
	<div id="r_ThirdParties" class="form-group row">
		<label class="<?php echo $employment_search->LeftColumnClass ?>"><span id="elh_employment_ThirdParties"><?php echo $employment_search->ThirdParties->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ThirdParties" id="z_ThirdParties" value="LIKE">
</span>
		</label>
		<div class="<?php echo $employment_search->RightColumnClass ?>"><div <?php echo $employment_search->ThirdParties->cellAttributes() ?>>
			<span id="el_employment_ThirdParties" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ThirdParties"><?php echo EmptyValue(strval($employment_search->ThirdParties->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_search->ThirdParties->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_search->ThirdParties->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_search->ThirdParties->ReadOnly || $employment_search->ThirdParties->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ThirdParties[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_search->ThirdParties->Lookup->getParamTag($employment_search, "p_x_ThirdParties") ?>
<input type="hidden" data-table="employment" data-field="x_ThirdParties" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $employment_search->ThirdParties->displayValueSeparatorAttribute() ?>" name="x_ThirdParties[]" id="x_ThirdParties[]" value="<?php echo $employment_search->ThirdParties->AdvancedSearch->SearchValue ?>"<?php echo $employment_search->ThirdParties->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_search->PayrollCode->Visible) { // PayrollCode ?>
	<div id="r_PayrollCode" class="form-group row">
		<label for="x_PayrollCode" class="<?php echo $employment_search->LeftColumnClass ?>"><span id="elh_employment_PayrollCode"><?php echo $employment_search->PayrollCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PayrollCode" id="z_PayrollCode" value="=">
</span>
		</label>
		<div class="<?php echo $employment_search->RightColumnClass ?>"><div <?php echo $employment_search->PayrollCode->cellAttributes() ?>>
			<span id="el_employment_PayrollCode" class="ew-search-field">
<input type="text" data-table="employment" data-field="x_PayrollCode" name="x_PayrollCode" id="x_PayrollCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($employment_search->PayrollCode->getPlaceHolder()) ?>" value="<?php echo $employment_search->PayrollCode->EditValue ?>"<?php echo $employment_search->PayrollCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_search->DateOfConfirmation->Visible) { // DateOfConfirmation ?>
	<div id="r_DateOfConfirmation" class="form-group row">
		<label for="x_DateOfConfirmation" class="<?php echo $employment_search->LeftColumnClass ?>"><span id="elh_employment_DateOfConfirmation"><?php echo $employment_search->DateOfConfirmation->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DateOfConfirmation" id="z_DateOfConfirmation" value="=">
</span>
		</label>
		<div class="<?php echo $employment_search->RightColumnClass ?>"><div <?php echo $employment_search->DateOfConfirmation->cellAttributes() ?>>
			<span id="el_employment_DateOfConfirmation" class="ew-search-field">
<input type="text" data-table="employment" data-field="x_DateOfConfirmation" name="x_DateOfConfirmation" id="x_DateOfConfirmation" maxlength="10" placeholder="<?php echo HtmlEncode($employment_search->DateOfConfirmation->getPlaceHolder()) ?>" value="<?php echo $employment_search->DateOfConfirmation->EditValue ?>"<?php echo $employment_search->DateOfConfirmation->editAttributes() ?>>
<?php if (!$employment_search->DateOfConfirmation->ReadOnly && !$employment_search->DateOfConfirmation->Disabled && !isset($employment_search->DateOfConfirmation->EditAttrs["readonly"]) && !isset($employment_search->DateOfConfirmation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentsearch", "x_DateOfConfirmation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$employment_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employment_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$employment_search->showPageFooter();
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
$employment_search->terminate();
?>