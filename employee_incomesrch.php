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
$employee_income_search = new employee_income_search();

// Run the page
$employee_income_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_income_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployee_incomesearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($employee_income_search->IsModal) { ?>
	femployee_incomesearch = currentAdvancedSearchForm = new ew.Form("femployee_incomesearch", "search");
	<?php } else { ?>
	femployee_incomesearch = currentForm = new ew.Form("femployee_incomesearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	femployee_incomesearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employee_income_search->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PaidPosition");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employee_income_search->PaidPosition->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PayrollDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employee_income_search->PayrollDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PayrollPeriod");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employee_income_search->PayrollPeriod->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_StartDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employee_income_search->StartDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_EndDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employee_income_search->EndDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Income");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employee_income_search->Income->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Taxable");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employee_income_search->Taxable->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	femployee_incomesearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployee_incomesearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femployee_incomesearch.lists["x_PaidPosition"] = <?php echo $employee_income_search->PaidPosition->Lookup->toClientList($employee_income_search) ?>;
	femployee_incomesearch.lists["x_PaidPosition"].options = <?php echo JsonEncode($employee_income_search->PaidPosition->lookupOptions()) ?>;
	femployee_incomesearch.autoSuggests["x_PaidPosition"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	femployee_incomesearch.lists["x_IncomeCode"] = <?php echo $employee_income_search->IncomeCode->Lookup->toClientList($employee_income_search) ?>;
	femployee_incomesearch.lists["x_IncomeCode"].options = <?php echo JsonEncode($employee_income_search->IncomeCode->lookupOptions()) ?>;
	loadjs.done("femployee_incomesearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employee_income_search->showPageHeader(); ?>
<?php
$employee_income_search->showMessage();
?>
<form name="femployee_incomesearch" id="femployee_incomesearch" class="<?php echo $employee_income_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employee_income">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$employee_income_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($employee_income_search->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label for="x_EmployeeID" class="<?php echo $employee_income_search->LeftColumnClass ?>"><span id="elh_employee_income_EmployeeID"><?php echo $employee_income_search->EmployeeID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		</label>
		<div class="<?php echo $employee_income_search->RightColumnClass ?>"><div <?php echo $employee_income_search->EmployeeID->cellAttributes() ?>>
			<span id="el_employee_income_EmployeeID" class="ew-search-field">
<input type="text" data-table="employee_income" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employee_income_search->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employee_income_search->EmployeeID->EditValue ?>"<?php echo $employee_income_search->EmployeeID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_income_search->PaidPosition->Visible) { // PaidPosition ?>
	<div id="r_PaidPosition" class="form-group row">
		<label class="<?php echo $employee_income_search->LeftColumnClass ?>"><span id="elh_employee_income_PaidPosition"><?php echo $employee_income_search->PaidPosition->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PaidPosition" id="z_PaidPosition" value="=">
</span>
		</label>
		<div class="<?php echo $employee_income_search->RightColumnClass ?>"><div <?php echo $employee_income_search->PaidPosition->cellAttributes() ?>>
			<span id="el_employee_income_PaidPosition" class="ew-search-field">
<?php
$onchange = $employee_income_search->PaidPosition->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employee_income_search->PaidPosition->EditAttrs["onchange"] = "";
?>
<span id="as_x_PaidPosition">
	<input type="text" class="form-control" name="sv_x_PaidPosition" id="sv_x_PaidPosition" value="<?php echo RemoveHtml($employee_income_search->PaidPosition->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employee_income_search->PaidPosition->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employee_income_search->PaidPosition->getPlaceHolder()) ?>"<?php echo $employee_income_search->PaidPosition->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_income" data-field="x_PaidPosition" data-value-separator="<?php echo $employee_income_search->PaidPosition->displayValueSeparatorAttribute() ?>" name="x_PaidPosition" id="x_PaidPosition" value="<?php echo HtmlEncode($employee_income_search->PaidPosition->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployee_incomesearch"], function() {
	femployee_incomesearch.createAutoSuggest({"id":"x_PaidPosition","forceSelect":false});
});
</script>
<?php echo $employee_income_search->PaidPosition->Lookup->getParamTag($employee_income_search, "p_x_PaidPosition") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_income_search->PayrollDate->Visible) { // PayrollDate ?>
	<div id="r_PayrollDate" class="form-group row">
		<label for="x_PayrollDate" class="<?php echo $employee_income_search->LeftColumnClass ?>"><span id="elh_employee_income_PayrollDate"><?php echo $employee_income_search->PayrollDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PayrollDate" id="z_PayrollDate" value="=">
</span>
		</label>
		<div class="<?php echo $employee_income_search->RightColumnClass ?>"><div <?php echo $employee_income_search->PayrollDate->cellAttributes() ?>>
			<span id="el_employee_income_PayrollDate" class="ew-search-field">
<input type="text" data-table="employee_income" data-field="x_PayrollDate" name="x_PayrollDate" id="x_PayrollDate" placeholder="<?php echo HtmlEncode($employee_income_search->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_search->PayrollDate->EditValue ?>"<?php echo $employee_income_search->PayrollDate->editAttributes() ?>>
<?php if (!$employee_income_search->PayrollDate->ReadOnly && !$employee_income_search->PayrollDate->Disabled && !isset($employee_income_search->PayrollDate->EditAttrs["readonly"]) && !isset($employee_income_search->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomesearch", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomesearch", "x_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_income_search->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<div id="r_PayrollPeriod" class="form-group row">
		<label for="x_PayrollPeriod" class="<?php echo $employee_income_search->LeftColumnClass ?>"><span id="elh_employee_income_PayrollPeriod"><?php echo $employee_income_search->PayrollPeriod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PayrollPeriod" id="z_PayrollPeriod" value="=">
</span>
		</label>
		<div class="<?php echo $employee_income_search->RightColumnClass ?>"><div <?php echo $employee_income_search->PayrollPeriod->cellAttributes() ?>>
			<span id="el_employee_income_PayrollPeriod" class="ew-search-field">
<input type="text" data-table="employee_income" data-field="x_PayrollPeriod" name="x_PayrollPeriod" id="x_PayrollPeriod" size="30" placeholder="<?php echo HtmlEncode($employee_income_search->PayrollPeriod->getPlaceHolder()) ?>" value="<?php echo $employee_income_search->PayrollPeriod->EditValue ?>"<?php echo $employee_income_search->PayrollPeriod->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_income_search->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label for="x_StartDate" class="<?php echo $employee_income_search->LeftColumnClass ?>"><span id="elh_employee_income_StartDate"><?php echo $employee_income_search->StartDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_StartDate" id="z_StartDate" value="=">
</span>
		</label>
		<div class="<?php echo $employee_income_search->RightColumnClass ?>"><div <?php echo $employee_income_search->StartDate->cellAttributes() ?>>
			<span id="el_employee_income_StartDate" class="ew-search-field">
<input type="text" data-table="employee_income" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($employee_income_search->StartDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_search->StartDate->EditValue ?>"<?php echo $employee_income_search->StartDate->editAttributes() ?>>
<?php if (!$employee_income_search->StartDate->ReadOnly && !$employee_income_search->StartDate->Disabled && !isset($employee_income_search->StartDate->EditAttrs["readonly"]) && !isset($employee_income_search->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomesearch", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomesearch", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_income_search->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label for="x_EndDate" class="<?php echo $employee_income_search->LeftColumnClass ?>"><span id="elh_employee_income_EndDate"><?php echo $employee_income_search->EndDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EndDate" id="z_EndDate" value="=">
</span>
		</label>
		<div class="<?php echo $employee_income_search->RightColumnClass ?>"><div <?php echo $employee_income_search->EndDate->cellAttributes() ?>>
			<span id="el_employee_income_EndDate" class="ew-search-field">
<input type="text" data-table="employee_income" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" placeholder="<?php echo HtmlEncode($employee_income_search->EndDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_search->EndDate->EditValue ?>"<?php echo $employee_income_search->EndDate->editAttributes() ?>>
<?php if (!$employee_income_search->EndDate->ReadOnly && !$employee_income_search->EndDate->Disabled && !isset($employee_income_search->EndDate->EditAttrs["readonly"]) && !isset($employee_income_search->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomesearch", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomesearch", "x_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_income_search->IncomeCode->Visible) { // IncomeCode ?>
	<div id="r_IncomeCode" class="form-group row">
		<label for="x_IncomeCode" class="<?php echo $employee_income_search->LeftColumnClass ?>"><span id="elh_employee_income_IncomeCode"><?php echo $employee_income_search->IncomeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_IncomeCode" id="z_IncomeCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $employee_income_search->RightColumnClass ?>"><div <?php echo $employee_income_search->IncomeCode->cellAttributes() ?>>
			<span id="el_employee_income_IncomeCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_IncomeCode"><?php echo EmptyValue(strval($employee_income_search->IncomeCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $employee_income_search->IncomeCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employee_income_search->IncomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employee_income_search->IncomeCode->ReadOnly || $employee_income_search->IncomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_IncomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employee_income_search->IncomeCode->Lookup->getParamTag($employee_income_search, "p_x_IncomeCode") ?>
<input type="hidden" data-table="employee_income" data-field="x_IncomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employee_income_search->IncomeCode->displayValueSeparatorAttribute() ?>" name="x_IncomeCode" id="x_IncomeCode" value="<?php echo $employee_income_search->IncomeCode->AdvancedSearch->SearchValue ?>"<?php echo $employee_income_search->IncomeCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_income_search->Income->Visible) { // Income ?>
	<div id="r_Income" class="form-group row">
		<label for="x_Income" class="<?php echo $employee_income_search->LeftColumnClass ?>"><span id="elh_employee_income_Income"><?php echo $employee_income_search->Income->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Income" id="z_Income" value="=">
</span>
		</label>
		<div class="<?php echo $employee_income_search->RightColumnClass ?>"><div <?php echo $employee_income_search->Income->cellAttributes() ?>>
			<span id="el_employee_income_Income" class="ew-search-field">
<input type="text" data-table="employee_income" data-field="x_Income" name="x_Income" id="x_Income" size="30" placeholder="<?php echo HtmlEncode($employee_income_search->Income->getPlaceHolder()) ?>" value="<?php echo $employee_income_search->Income->EditValue ?>"<?php echo $employee_income_search->Income->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_income_search->Remarks->Visible) { // Remarks ?>
	<div id="r_Remarks" class="form-group row">
		<label for="x_Remarks" class="<?php echo $employee_income_search->LeftColumnClass ?>"><span id="elh_employee_income_Remarks"><?php echo $employee_income_search->Remarks->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Remarks" id="z_Remarks" value="=">
</span>
		</label>
		<div class="<?php echo $employee_income_search->RightColumnClass ?>"><div <?php echo $employee_income_search->Remarks->cellAttributes() ?>>
			<span id="el_employee_income_Remarks" class="ew-search-field">
<input type="text" data-table="employee_income" data-field="x_Remarks" name="x_Remarks" id="x_Remarks" size="35" placeholder="<?php echo HtmlEncode($employee_income_search->Remarks->getPlaceHolder()) ?>" value="<?php echo $employee_income_search->Remarks->EditValue ?>"<?php echo $employee_income_search->Remarks->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_income_search->Taxable->Visible) { // Taxable ?>
	<div id="r_Taxable" class="form-group row">
		<label for="x_Taxable" class="<?php echo $employee_income_search->LeftColumnClass ?>"><span id="elh_employee_income_Taxable"><?php echo $employee_income_search->Taxable->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Taxable" id="z_Taxable" value="=">
</span>
		</label>
		<div class="<?php echo $employee_income_search->RightColumnClass ?>"><div <?php echo $employee_income_search->Taxable->cellAttributes() ?>>
			<span id="el_employee_income_Taxable" class="ew-search-field">
<input type="text" data-table="employee_income" data-field="x_Taxable" name="x_Taxable" id="x_Taxable" size="30" placeholder="<?php echo HtmlEncode($employee_income_search->Taxable->getPlaceHolder()) ?>" value="<?php echo $employee_income_search->Taxable->EditValue ?>"<?php echo $employee_income_search->Taxable->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$employee_income_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employee_income_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$employee_income_search->showPageFooter();
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
$employee_income_search->terminate();
?>