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
$employment_acting_search = new employment_acting_search();

// Run the page
$employment_acting_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_acting_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployment_actingsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($employment_acting_search->IsModal) { ?>
	femployment_actingsearch = currentAdvancedSearchForm = new ew.Form("femployment_actingsearch", "search");
	<?php } else { ?>
	femployment_actingsearch = currentForm = new ew.Form("femployment_actingsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	femployment_actingsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_acting_search->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ProvinceCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_acting_search->ProvinceCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DateOfActingAppointment");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_acting_search->DateOfActingAppointment->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_EndDateOfActingPeriod");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_acting_search->EndDateOfActingPeriod->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	femployment_actingsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployment_actingsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femployment_actingsearch.lists["x_ProvinceCode"] = <?php echo $employment_acting_search->ProvinceCode->Lookup->toClientList($employment_acting_search) ?>;
	femployment_actingsearch.lists["x_ProvinceCode"].options = <?php echo JsonEncode($employment_acting_search->ProvinceCode->lookupOptions()) ?>;
	femployment_actingsearch.autoSuggests["x_ProvinceCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	femployment_actingsearch.lists["x_LACode"] = <?php echo $employment_acting_search->LACode->Lookup->toClientList($employment_acting_search) ?>;
	femployment_actingsearch.lists["x_LACode"].options = <?php echo JsonEncode($employment_acting_search->LACode->lookupOptions()) ?>;
	femployment_actingsearch.lists["x_DepartmentCode"] = <?php echo $employment_acting_search->DepartmentCode->Lookup->toClientList($employment_acting_search) ?>;
	femployment_actingsearch.lists["x_DepartmentCode"].options = <?php echo JsonEncode($employment_acting_search->DepartmentCode->lookupOptions()) ?>;
	femployment_actingsearch.lists["x_SectionCode"] = <?php echo $employment_acting_search->SectionCode->Lookup->toClientList($employment_acting_search) ?>;
	femployment_actingsearch.lists["x_SectionCode"].options = <?php echo JsonEncode($employment_acting_search->SectionCode->lookupOptions()) ?>;
	femployment_actingsearch.lists["x_ActingPosition"] = <?php echo $employment_acting_search->ActingPosition->Lookup->toClientList($employment_acting_search) ?>;
	femployment_actingsearch.lists["x_ActingPosition"].options = <?php echo JsonEncode($employment_acting_search->ActingPosition->lookupOptions()) ?>;
	femployment_actingsearch.lists["x_ActingType"] = <?php echo $employment_acting_search->ActingType->Lookup->toClientList($employment_acting_search) ?>;
	femployment_actingsearch.lists["x_ActingType"].options = <?php echo JsonEncode($employment_acting_search->ActingType->lookupOptions()) ?>;
	femployment_actingsearch.lists["x_ActingStatus"] = <?php echo $employment_acting_search->ActingStatus->Lookup->toClientList($employment_acting_search) ?>;
	femployment_actingsearch.lists["x_ActingStatus"].options = <?php echo JsonEncode($employment_acting_search->ActingStatus->lookupOptions()) ?>;
	femployment_actingsearch.lists["x_ActingReason"] = <?php echo $employment_acting_search->ActingReason->Lookup->toClientList($employment_acting_search) ?>;
	femployment_actingsearch.lists["x_ActingReason"].options = <?php echo JsonEncode($employment_acting_search->ActingReason->lookupOptions()) ?>;
	loadjs.done("femployment_actingsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employment_acting_search->showPageHeader(); ?>
<?php
$employment_acting_search->showMessage();
?>
<form name="femployment_actingsearch" id="femployment_actingsearch" class="<?php echo $employment_acting_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employment_acting">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$employment_acting_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($employment_acting_search->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label for="x_EmployeeID" class="<?php echo $employment_acting_search->LeftColumnClass ?>"><span id="elh_employment_acting_EmployeeID"><?php echo $employment_acting_search->EmployeeID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		</label>
		<div class="<?php echo $employment_acting_search->RightColumnClass ?>"><div <?php echo $employment_acting_search->EmployeeID->cellAttributes() ?>>
			<span id="el_employment_acting_EmployeeID" class="ew-search-field">
<input type="text" data-table="employment_acting" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employment_acting_search->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employment_acting_search->EmployeeID->EditValue ?>"<?php echo $employment_acting_search->EmployeeID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_search->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label class="<?php echo $employment_acting_search->LeftColumnClass ?>"><span id="elh_employment_acting_ProvinceCode"><?php echo $employment_acting_search->ProvinceCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ProvinceCode" id="z_ProvinceCode" value="=">
</span>
		</label>
		<div class="<?php echo $employment_acting_search->RightColumnClass ?>"><div <?php echo $employment_acting_search->ProvinceCode->cellAttributes() ?>>
			<span id="el_employment_acting_ProvinceCode" class="ew-search-field">
<?php
$onchange = $employment_acting_search->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employment_acting_search->ProvinceCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProvinceCode">
	<input type="text" class="form-control" name="sv_x_ProvinceCode" id="sv_x_ProvinceCode" value="<?php echo RemoveHtml($employment_acting_search->ProvinceCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employment_acting_search->ProvinceCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employment_acting_search->ProvinceCode->getPlaceHolder()) ?>"<?php echo $employment_acting_search->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_ProvinceCode" data-value-separator="<?php echo $employment_acting_search->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x_ProvinceCode" id="x_ProvinceCode" value="<?php echo HtmlEncode($employment_acting_search->ProvinceCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployment_actingsearch"], function() {
	femployment_actingsearch.createAutoSuggest({"id":"x_ProvinceCode","forceSelect":false});
});
</script>
<?php echo $employment_acting_search->ProvinceCode->Lookup->getParamTag($employment_acting_search, "p_x_ProvinceCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_search->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label for="x_LACode" class="<?php echo $employment_acting_search->LeftColumnClass ?>"><span id="elh_employment_acting_LACode"><?php echo $employment_acting_search->LACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $employment_acting_search->RightColumnClass ?>"><div <?php echo $employment_acting_search->LACode->cellAttributes() ?>>
			<span id="el_employment_acting_LACode" class="ew-search-field">
<?php $employment_acting_search->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_LACode" data-value-separator="<?php echo $employment_acting_search->LACode->displayValueSeparatorAttribute() ?>" id="x_LACode" name="x_LACode"<?php echo $employment_acting_search->LACode->editAttributes() ?>>
			<?php echo $employment_acting_search->LACode->selectOptionListHtml("x_LACode") ?>
		</select>
</div>
<?php echo $employment_acting_search->LACode->Lookup->getParamTag($employment_acting_search, "p_x_LACode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_search->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label for="x_DepartmentCode" class="<?php echo $employment_acting_search->LeftColumnClass ?>"><span id="elh_employment_acting_DepartmentCode"><?php echo $employment_acting_search->DepartmentCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DepartmentCode" id="z_DepartmentCode" value="=">
</span>
		</label>
		<div class="<?php echo $employment_acting_search->RightColumnClass ?>"><div <?php echo $employment_acting_search->DepartmentCode->cellAttributes() ?>>
			<span id="el_employment_acting_DepartmentCode" class="ew-search-field">
<?php $employment_acting_search->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_DepartmentCode" data-value-separator="<?php echo $employment_acting_search->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $employment_acting_search->DepartmentCode->editAttributes() ?>>
			<?php echo $employment_acting_search->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $employment_acting_search->DepartmentCode->Lookup->getParamTag($employment_acting_search, "p_x_DepartmentCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_search->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label for="x_SectionCode" class="<?php echo $employment_acting_search->LeftColumnClass ?>"><span id="elh_employment_acting_SectionCode"><?php echo $employment_acting_search->SectionCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SectionCode" id="z_SectionCode" value="=">
</span>
		</label>
		<div class="<?php echo $employment_acting_search->RightColumnClass ?>"><div <?php echo $employment_acting_search->SectionCode->cellAttributes() ?>>
			<span id="el_employment_acting_SectionCode" class="ew-search-field">
<?php $employment_acting_search->SectionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_SectionCode" data-value-separator="<?php echo $employment_acting_search->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $employment_acting_search->SectionCode->editAttributes() ?>>
			<?php echo $employment_acting_search->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $employment_acting_search->SectionCode->Lookup->getParamTag($employment_acting_search, "p_x_SectionCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_search->ActingPosition->Visible) { // ActingPosition ?>
	<div id="r_ActingPosition" class="form-group row">
		<label for="x_ActingPosition" class="<?php echo $employment_acting_search->LeftColumnClass ?>"><span id="elh_employment_acting_ActingPosition"><?php echo $employment_acting_search->ActingPosition->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ActingPosition" id="z_ActingPosition" value="=">
</span>
		</label>
		<div class="<?php echo $employment_acting_search->RightColumnClass ?>"><div <?php echo $employment_acting_search->ActingPosition->cellAttributes() ?>>
			<span id="el_employment_acting_ActingPosition" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_ActingPosition" data-value-separator="<?php echo $employment_acting_search->ActingPosition->displayValueSeparatorAttribute() ?>" id="x_ActingPosition" name="x_ActingPosition"<?php echo $employment_acting_search->ActingPosition->editAttributes() ?>>
			<?php echo $employment_acting_search->ActingPosition->selectOptionListHtml("x_ActingPosition") ?>
		</select>
</div>
<?php echo $employment_acting_search->ActingPosition->Lookup->getParamTag($employment_acting_search, "p_x_ActingPosition") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_search->DateOfActingAppointment->Visible) { // DateOfActingAppointment ?>
	<div id="r_DateOfActingAppointment" class="form-group row">
		<label for="x_DateOfActingAppointment" class="<?php echo $employment_acting_search->LeftColumnClass ?>"><span id="elh_employment_acting_DateOfActingAppointment"><?php echo $employment_acting_search->DateOfActingAppointment->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DateOfActingAppointment" id="z_DateOfActingAppointment" value="=">
</span>
		</label>
		<div class="<?php echo $employment_acting_search->RightColumnClass ?>"><div <?php echo $employment_acting_search->DateOfActingAppointment->cellAttributes() ?>>
			<span id="el_employment_acting_DateOfActingAppointment" class="ew-search-field">
<input type="text" data-table="employment_acting" data-field="x_DateOfActingAppointment" name="x_DateOfActingAppointment" id="x_DateOfActingAppointment" placeholder="<?php echo HtmlEncode($employment_acting_search->DateOfActingAppointment->getPlaceHolder()) ?>" value="<?php echo $employment_acting_search->DateOfActingAppointment->EditValue ?>"<?php echo $employment_acting_search->DateOfActingAppointment->editAttributes() ?>>
<?php if (!$employment_acting_search->DateOfActingAppointment->ReadOnly && !$employment_acting_search->DateOfActingAppointment->Disabled && !isset($employment_acting_search->DateOfActingAppointment->EditAttrs["readonly"]) && !isset($employment_acting_search->DateOfActingAppointment->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployment_actingsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("femployment_actingsearch", "x_DateOfActingAppointment", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_search->EndDateOfActingPeriod->Visible) { // EndDateOfActingPeriod ?>
	<div id="r_EndDateOfActingPeriod" class="form-group row">
		<label for="x_EndDateOfActingPeriod" class="<?php echo $employment_acting_search->LeftColumnClass ?>"><span id="elh_employment_acting_EndDateOfActingPeriod"><?php echo $employment_acting_search->EndDateOfActingPeriod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EndDateOfActingPeriod" id="z_EndDateOfActingPeriod" value="=">
</span>
		</label>
		<div class="<?php echo $employment_acting_search->RightColumnClass ?>"><div <?php echo $employment_acting_search->EndDateOfActingPeriod->cellAttributes() ?>>
			<span id="el_employment_acting_EndDateOfActingPeriod" class="ew-search-field">
<input type="text" data-table="employment_acting" data-field="x_EndDateOfActingPeriod" name="x_EndDateOfActingPeriod" id="x_EndDateOfActingPeriod" placeholder="<?php echo HtmlEncode($employment_acting_search->EndDateOfActingPeriod->getPlaceHolder()) ?>" value="<?php echo $employment_acting_search->EndDateOfActingPeriod->EditValue ?>"<?php echo $employment_acting_search->EndDateOfActingPeriod->editAttributes() ?>>
<?php if (!$employment_acting_search->EndDateOfActingPeriod->ReadOnly && !$employment_acting_search->EndDateOfActingPeriod->Disabled && !isset($employment_acting_search->EndDateOfActingPeriod->EditAttrs["readonly"]) && !isset($employment_acting_search->EndDateOfActingPeriod->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployment_actingsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("femployment_actingsearch", "x_EndDateOfActingPeriod", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_search->SalaryScale->Visible) { // SalaryScale ?>
	<div id="r_SalaryScale" class="form-group row">
		<label for="x_SalaryScale" class="<?php echo $employment_acting_search->LeftColumnClass ?>"><span id="elh_employment_acting_SalaryScale"><?php echo $employment_acting_search->SalaryScale->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SalaryScale" id="z_SalaryScale" value="LIKE">
</span>
		</label>
		<div class="<?php echo $employment_acting_search->RightColumnClass ?>"><div <?php echo $employment_acting_search->SalaryScale->cellAttributes() ?>>
			<span id="el_employment_acting_SalaryScale" class="ew-search-field">
<input type="text" data-table="employment_acting" data-field="x_SalaryScale" name="x_SalaryScale" id="x_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_acting_search->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $employment_acting_search->SalaryScale->EditValue ?>"<?php echo $employment_acting_search->SalaryScale->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_search->ActingType->Visible) { // ActingType ?>
	<div id="r_ActingType" class="form-group row">
		<label for="x_ActingType" class="<?php echo $employment_acting_search->LeftColumnClass ?>"><span id="elh_employment_acting_ActingType"><?php echo $employment_acting_search->ActingType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ActingType" id="z_ActingType" value="=">
</span>
		</label>
		<div class="<?php echo $employment_acting_search->RightColumnClass ?>"><div <?php echo $employment_acting_search->ActingType->cellAttributes() ?>>
			<span id="el_employment_acting_ActingType" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_ActingType" data-value-separator="<?php echo $employment_acting_search->ActingType->displayValueSeparatorAttribute() ?>" id="x_ActingType" name="x_ActingType"<?php echo $employment_acting_search->ActingType->editAttributes() ?>>
			<?php echo $employment_acting_search->ActingType->selectOptionListHtml("x_ActingType") ?>
		</select>
</div>
<?php echo $employment_acting_search->ActingType->Lookup->getParamTag($employment_acting_search, "p_x_ActingType") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_search->ActingStatus->Visible) { // ActingStatus ?>
	<div id="r_ActingStatus" class="form-group row">
		<label for="x_ActingStatus" class="<?php echo $employment_acting_search->LeftColumnClass ?>"><span id="elh_employment_acting_ActingStatus"><?php echo $employment_acting_search->ActingStatus->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ActingStatus" id="z_ActingStatus" value="=">
</span>
		</label>
		<div class="<?php echo $employment_acting_search->RightColumnClass ?>"><div <?php echo $employment_acting_search->ActingStatus->cellAttributes() ?>>
			<span id="el_employment_acting_ActingStatus" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_ActingStatus" data-value-separator="<?php echo $employment_acting_search->ActingStatus->displayValueSeparatorAttribute() ?>" id="x_ActingStatus" name="x_ActingStatus"<?php echo $employment_acting_search->ActingStatus->editAttributes() ?>>
			<?php echo $employment_acting_search->ActingStatus->selectOptionListHtml("x_ActingStatus") ?>
		</select>
</div>
<?php echo $employment_acting_search->ActingStatus->Lookup->getParamTag($employment_acting_search, "p_x_ActingStatus") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_search->ActingReason->Visible) { // ActingReason ?>
	<div id="r_ActingReason" class="form-group row">
		<label for="x_ActingReason" class="<?php echo $employment_acting_search->LeftColumnClass ?>"><span id="elh_employment_acting_ActingReason"><?php echo $employment_acting_search->ActingReason->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ActingReason" id="z_ActingReason" value="LIKE">
</span>
		</label>
		<div class="<?php echo $employment_acting_search->RightColumnClass ?>"><div <?php echo $employment_acting_search->ActingReason->cellAttributes() ?>>
			<span id="el_employment_acting_ActingReason" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_ActingReason" data-value-separator="<?php echo $employment_acting_search->ActingReason->displayValueSeparatorAttribute() ?>" id="x_ActingReason" name="x_ActingReason"<?php echo $employment_acting_search->ActingReason->editAttributes() ?>>
			<?php echo $employment_acting_search->ActingReason->selectOptionListHtml("x_ActingReason") ?>
		</select>
</div>
<?php echo $employment_acting_search->ActingReason->Lookup->getParamTag($employment_acting_search, "p_x_ActingReason") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$employment_acting_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employment_acting_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$employment_acting_search->showPageFooter();
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
$employment_acting_search->terminate();
?>