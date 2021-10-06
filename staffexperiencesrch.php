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
$staffexperience_search = new staffexperience_search();

// Run the page
$staffexperience_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffexperience_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffexperiencesearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($staffexperience_search->IsModal) { ?>
	fstaffexperiencesearch = currentAdvancedSearchForm = new ew.Form("fstaffexperiencesearch", "search");
	<?php } else { ?>
	fstaffexperiencesearch = currentForm = new ew.Form("fstaffexperiencesearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fstaffexperiencesearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($staffexperience_search->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_FromDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($staffexperience_search->FromDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ExitDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($staffexperience_search->ExitDate->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fstaffexperiencesearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffexperiencesearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffexperiencesearch.lists["x_ProvinceCode"] = <?php echo $staffexperience_search->ProvinceCode->Lookup->toClientList($staffexperience_search) ?>;
	fstaffexperiencesearch.lists["x_ProvinceCode"].options = <?php echo JsonEncode($staffexperience_search->ProvinceCode->lookupOptions()) ?>;
	fstaffexperiencesearch.lists["x_LAcode"] = <?php echo $staffexperience_search->LAcode->Lookup->toClientList($staffexperience_search) ?>;
	fstaffexperiencesearch.lists["x_LAcode"].options = <?php echo JsonEncode($staffexperience_search->LAcode->lookupOptions()) ?>;
	fstaffexperiencesearch.lists["x_PositionCode"] = <?php echo $staffexperience_search->PositionCode->Lookup->toClientList($staffexperience_search) ?>;
	fstaffexperiencesearch.lists["x_PositionCode"].options = <?php echo JsonEncode($staffexperience_search->PositionCode->lookupOptions()) ?>;
	fstaffexperiencesearch.lists["x_ReasonForExit"] = <?php echo $staffexperience_search->ReasonForExit->Lookup->toClientList($staffexperience_search) ?>;
	fstaffexperiencesearch.lists["x_ReasonForExit"].options = <?php echo JsonEncode($staffexperience_search->ReasonForExit->lookupOptions()) ?>;
	fstaffexperiencesearch.lists["x_RetirementType"] = <?php echo $staffexperience_search->RetirementType->Lookup->toClientList($staffexperience_search) ?>;
	fstaffexperiencesearch.lists["x_RetirementType"].options = <?php echo JsonEncode($staffexperience_search->RetirementType->lookupOptions()) ?>;
	loadjs.done("fstaffexperiencesearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffexperience_search->showPageHeader(); ?>
<?php
$staffexperience_search->showMessage();
?>
<form name="fstaffexperiencesearch" id="fstaffexperiencesearch" class="<?php echo $staffexperience_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffexperience">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$staffexperience_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($staffexperience_search->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label for="x_EmployeeID" class="<?php echo $staffexperience_search->LeftColumnClass ?>"><span id="elh_staffexperience_EmployeeID"><?php echo $staffexperience_search->EmployeeID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		</label>
		<div class="<?php echo $staffexperience_search->RightColumnClass ?>"><div <?php echo $staffexperience_search->EmployeeID->cellAttributes() ?>>
			<span id="el_staffexperience_EmployeeID" class="ew-search-field">
<input type="text" data-table="staffexperience" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($staffexperience_search->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $staffexperience_search->EmployeeID->EditValue ?>"<?php echo $staffexperience_search->EmployeeID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffexperience_search->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label for="x_ProvinceCode" class="<?php echo $staffexperience_search->LeftColumnClass ?>"><span id="elh_staffexperience_ProvinceCode"><?php echo $staffexperience_search->ProvinceCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ProvinceCode" id="z_ProvinceCode" value="=">
</span>
		</label>
		<div class="<?php echo $staffexperience_search->RightColumnClass ?>"><div <?php echo $staffexperience_search->ProvinceCode->cellAttributes() ?>>
			<span id="el_staffexperience_ProvinceCode" class="ew-search-field">
<?php $staffexperience_search->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_ProvinceCode" data-value-separator="<?php echo $staffexperience_search->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $staffexperience_search->ProvinceCode->editAttributes() ?>>
			<?php echo $staffexperience_search->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $staffexperience_search->ProvinceCode->Lookup->getParamTag($staffexperience_search, "p_x_ProvinceCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffexperience_search->LAcode->Visible) { // LAcode ?>
	<div id="r_LAcode" class="form-group row">
		<label for="x_LAcode" class="<?php echo $staffexperience_search->LeftColumnClass ?>"><span id="elh_staffexperience_LAcode"><?php echo $staffexperience_search->LAcode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LAcode" id="z_LAcode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staffexperience_search->RightColumnClass ?>"><div <?php echo $staffexperience_search->LAcode->cellAttributes() ?>>
			<span id="el_staffexperience_LAcode" class="ew-search-field">
<?php $staffexperience_search->LAcode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LAcode"><?php echo EmptyValue(strval($staffexperience_search->LAcode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffexperience_search->LAcode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffexperience_search->LAcode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffexperience_search->LAcode->ReadOnly || $staffexperience_search->LAcode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LAcode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffexperience_search->LAcode->Lookup->getParamTag($staffexperience_search, "p_x_LAcode") ?>
<input type="hidden" data-table="staffexperience" data-field="x_LAcode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffexperience_search->LAcode->displayValueSeparatorAttribute() ?>" name="x_LAcode" id="x_LAcode" value="<?php echo $staffexperience_search->LAcode->AdvancedSearch->SearchValue ?>"<?php echo $staffexperience_search->LAcode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffexperience_search->PositionCode->Visible) { // PositionCode ?>
	<div id="r_PositionCode" class="form-group row">
		<label for="x_PositionCode" class="<?php echo $staffexperience_search->LeftColumnClass ?>"><span id="elh_staffexperience_PositionCode"><?php echo $staffexperience_search->PositionCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PositionCode" id="z_PositionCode" value="=">
</span>
		</label>
		<div class="<?php echo $staffexperience_search->RightColumnClass ?>"><div <?php echo $staffexperience_search->PositionCode->cellAttributes() ?>>
			<span id="el_staffexperience_PositionCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_PositionCode"><?php echo EmptyValue(strval($staffexperience_search->PositionCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffexperience_search->PositionCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffexperience_search->PositionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffexperience_search->PositionCode->ReadOnly || $staffexperience_search->PositionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_PositionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffexperience_search->PositionCode->Lookup->getParamTag($staffexperience_search, "p_x_PositionCode") ?>
<input type="hidden" data-table="staffexperience" data-field="x_PositionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffexperience_search->PositionCode->displayValueSeparatorAttribute() ?>" name="x_PositionCode" id="x_PositionCode" value="<?php echo $staffexperience_search->PositionCode->AdvancedSearch->SearchValue ?>"<?php echo $staffexperience_search->PositionCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffexperience_search->FromDate->Visible) { // FromDate ?>
	<div id="r_FromDate" class="form-group row">
		<label for="x_FromDate" class="<?php echo $staffexperience_search->LeftColumnClass ?>"><span id="elh_staffexperience_FromDate"><?php echo $staffexperience_search->FromDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_FromDate" id="z_FromDate" value="=">
</span>
		</label>
		<div class="<?php echo $staffexperience_search->RightColumnClass ?>"><div <?php echo $staffexperience_search->FromDate->cellAttributes() ?>>
			<span id="el_staffexperience_FromDate" class="ew-search-field">
<input type="text" data-table="staffexperience" data-field="x_FromDate" name="x_FromDate" id="x_FromDate" placeholder="<?php echo HtmlEncode($staffexperience_search->FromDate->getPlaceHolder()) ?>" value="<?php echo $staffexperience_search->FromDate->EditValue ?>"<?php echo $staffexperience_search->FromDate->editAttributes() ?>>
<?php if (!$staffexperience_search->FromDate->ReadOnly && !$staffexperience_search->FromDate->Disabled && !isset($staffexperience_search->FromDate->EditAttrs["readonly"]) && !isset($staffexperience_search->FromDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffexperiencesearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffexperiencesearch", "x_FromDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffexperience_search->ExitDate->Visible) { // ExitDate ?>
	<div id="r_ExitDate" class="form-group row">
		<label for="x_ExitDate" class="<?php echo $staffexperience_search->LeftColumnClass ?>"><span id="elh_staffexperience_ExitDate"><?php echo $staffexperience_search->ExitDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ExitDate" id="z_ExitDate" value="=">
</span>
		</label>
		<div class="<?php echo $staffexperience_search->RightColumnClass ?>"><div <?php echo $staffexperience_search->ExitDate->cellAttributes() ?>>
			<span id="el_staffexperience_ExitDate" class="ew-search-field">
<input type="text" data-table="staffexperience" data-field="x_ExitDate" name="x_ExitDate" id="x_ExitDate" placeholder="<?php echo HtmlEncode($staffexperience_search->ExitDate->getPlaceHolder()) ?>" value="<?php echo $staffexperience_search->ExitDate->EditValue ?>"<?php echo $staffexperience_search->ExitDate->editAttributes() ?>>
<?php if (!$staffexperience_search->ExitDate->ReadOnly && !$staffexperience_search->ExitDate->Disabled && !isset($staffexperience_search->ExitDate->EditAttrs["readonly"]) && !isset($staffexperience_search->ExitDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffexperiencesearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffexperiencesearch", "x_ExitDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffexperience_search->RelevantExperience->Visible) { // RelevantExperience ?>
	<div id="r_RelevantExperience" class="form-group row">
		<label for="x_RelevantExperience" class="<?php echo $staffexperience_search->LeftColumnClass ?>"><span id="elh_staffexperience_RelevantExperience"><?php echo $staffexperience_search->RelevantExperience->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_RelevantExperience" id="z_RelevantExperience" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staffexperience_search->RightColumnClass ?>"><div <?php echo $staffexperience_search->RelevantExperience->cellAttributes() ?>>
			<span id="el_staffexperience_RelevantExperience" class="ew-search-field">
<input type="text" data-table="staffexperience" data-field="x_RelevantExperience" name="x_RelevantExperience" id="x_RelevantExperience" size="35" placeholder="<?php echo HtmlEncode($staffexperience_search->RelevantExperience->getPlaceHolder()) ?>" value="<?php echo $staffexperience_search->RelevantExperience->EditValue ?>"<?php echo $staffexperience_search->RelevantExperience->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffexperience_search->ReasonForExit->Visible) { // ReasonForExit ?>
	<div id="r_ReasonForExit" class="form-group row">
		<label for="x_ReasonForExit" class="<?php echo $staffexperience_search->LeftColumnClass ?>"><span id="elh_staffexperience_ReasonForExit"><?php echo $staffexperience_search->ReasonForExit->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ReasonForExit" id="z_ReasonForExit" value="=">
</span>
		</label>
		<div class="<?php echo $staffexperience_search->RightColumnClass ?>"><div <?php echo $staffexperience_search->ReasonForExit->cellAttributes() ?>>
			<span id="el_staffexperience_ReasonForExit" class="ew-search-field">
<?php $staffexperience_search->ReasonForExit->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_ReasonForExit" data-value-separator="<?php echo $staffexperience_search->ReasonForExit->displayValueSeparatorAttribute() ?>" id="x_ReasonForExit" name="x_ReasonForExit"<?php echo $staffexperience_search->ReasonForExit->editAttributes() ?>>
			<?php echo $staffexperience_search->ReasonForExit->selectOptionListHtml("x_ReasonForExit") ?>
		</select>
</div>
<?php echo $staffexperience_search->ReasonForExit->Lookup->getParamTag($staffexperience_search, "p_x_ReasonForExit") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffexperience_search->RetirementType->Visible) { // RetirementType ?>
	<div id="r_RetirementType" class="form-group row">
		<label for="x_RetirementType" class="<?php echo $staffexperience_search->LeftColumnClass ?>"><span id="elh_staffexperience_RetirementType"><?php echo $staffexperience_search->RetirementType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_RetirementType" id="z_RetirementType" value="=">
</span>
		</label>
		<div class="<?php echo $staffexperience_search->RightColumnClass ?>"><div <?php echo $staffexperience_search->RetirementType->cellAttributes() ?>>
			<span id="el_staffexperience_RetirementType" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_RetirementType" data-value-separator="<?php echo $staffexperience_search->RetirementType->displayValueSeparatorAttribute() ?>" id="x_RetirementType" name="x_RetirementType"<?php echo $staffexperience_search->RetirementType->editAttributes() ?>>
			<?php echo $staffexperience_search->RetirementType->selectOptionListHtml("x_RetirementType") ?>
		</select>
</div>
<?php echo $staffexperience_search->RetirementType->Lookup->getParamTag($staffexperience_search, "p_x_RetirementType") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$staffexperience_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $staffexperience_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$staffexperience_search->showPageFooter();
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
$staffexperience_search->terminate();
?>