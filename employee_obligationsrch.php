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
$employee_obligation_search = new employee_obligation_search();

// Run the page
$employee_obligation_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_obligation_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployee_obligationsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($employee_obligation_search->IsModal) { ?>
	femployee_obligationsearch = currentAdvancedSearchForm = new ew.Form("femployee_obligationsearch", "search");
	<?php } else { ?>
	femployee_obligationsearch = currentForm = new ew.Form("femployee_obligationsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	femployee_obligationsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employee_obligation_search->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PaidPosition");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employee_obligation_search->PaidPosition->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PayrollDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employee_obligation_search->PayrollDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PayrollPeriod");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employee_obligation_search->PayrollPeriod->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_StartDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employee_obligation_search->StartDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Enddate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employee_obligation_search->Enddate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ObligationAmount");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employee_obligation_search->ObligationAmount->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	femployee_obligationsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployee_obligationsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femployee_obligationsearch.lists["x_PaidPosition"] = <?php echo $employee_obligation_search->PaidPosition->Lookup->toClientList($employee_obligation_search) ?>;
	femployee_obligationsearch.lists["x_PaidPosition"].options = <?php echo JsonEncode($employee_obligation_search->PaidPosition->lookupOptions()) ?>;
	femployee_obligationsearch.autoSuggests["x_PaidPosition"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("femployee_obligationsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employee_obligation_search->showPageHeader(); ?>
<?php
$employee_obligation_search->showMessage();
?>
<form name="femployee_obligationsearch" id="femployee_obligationsearch" class="<?php echo $employee_obligation_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employee_obligation">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$employee_obligation_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($employee_obligation_search->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label for="x_EmployeeID" class="<?php echo $employee_obligation_search->LeftColumnClass ?>"><span id="elh_employee_obligation_EmployeeID"><?php echo $employee_obligation_search->EmployeeID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		</label>
		<div class="<?php echo $employee_obligation_search->RightColumnClass ?>"><div <?php echo $employee_obligation_search->EmployeeID->cellAttributes() ?>>
			<span id="el_employee_obligation_EmployeeID" class="ew-search-field">
<input type="text" data-table="employee_obligation" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_search->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_search->EmployeeID->EditValue ?>"<?php echo $employee_obligation_search->EmployeeID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_obligation_search->PaidPosition->Visible) { // PaidPosition ?>
	<div id="r_PaidPosition" class="form-group row">
		<label class="<?php echo $employee_obligation_search->LeftColumnClass ?>"><span id="elh_employee_obligation_PaidPosition"><?php echo $employee_obligation_search->PaidPosition->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PaidPosition" id="z_PaidPosition" value="=">
</span>
		</label>
		<div class="<?php echo $employee_obligation_search->RightColumnClass ?>"><div <?php echo $employee_obligation_search->PaidPosition->cellAttributes() ?>>
			<span id="el_employee_obligation_PaidPosition" class="ew-search-field">
<?php
$onchange = $employee_obligation_search->PaidPosition->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employee_obligation_search->PaidPosition->EditAttrs["onchange"] = "";
?>
<span id="as_x_PaidPosition">
	<input type="text" class="form-control" name="sv_x_PaidPosition" id="sv_x_PaidPosition" value="<?php echo RemoveHtml($employee_obligation_search->PaidPosition->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_search->PaidPosition->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employee_obligation_search->PaidPosition->getPlaceHolder()) ?>"<?php echo $employee_obligation_search->PaidPosition->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_PaidPosition" data-value-separator="<?php echo $employee_obligation_search->PaidPosition->displayValueSeparatorAttribute() ?>" name="x_PaidPosition" id="x_PaidPosition" value="<?php echo HtmlEncode($employee_obligation_search->PaidPosition->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployee_obligationsearch"], function() {
	femployee_obligationsearch.createAutoSuggest({"id":"x_PaidPosition","forceSelect":false});
});
</script>
<?php echo $employee_obligation_search->PaidPosition->Lookup->getParamTag($employee_obligation_search, "p_x_PaidPosition") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_obligation_search->PayrollDate->Visible) { // PayrollDate ?>
	<div id="r_PayrollDate" class="form-group row">
		<label for="x_PayrollDate" class="<?php echo $employee_obligation_search->LeftColumnClass ?>"><span id="elh_employee_obligation_PayrollDate"><?php echo $employee_obligation_search->PayrollDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PayrollDate" id="z_PayrollDate" value="=">
</span>
		</label>
		<div class="<?php echo $employee_obligation_search->RightColumnClass ?>"><div <?php echo $employee_obligation_search->PayrollDate->cellAttributes() ?>>
			<span id="el_employee_obligation_PayrollDate" class="ew-search-field">
<input type="text" data-table="employee_obligation" data-field="x_PayrollDate" name="x_PayrollDate" id="x_PayrollDate" placeholder="<?php echo HtmlEncode($employee_obligation_search->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_search->PayrollDate->EditValue ?>"<?php echo $employee_obligation_search->PayrollDate->editAttributes() ?>>
<?php if (!$employee_obligation_search->PayrollDate->ReadOnly && !$employee_obligation_search->PayrollDate->Disabled && !isset($employee_obligation_search->PayrollDate->EditAttrs["readonly"]) && !isset($employee_obligation_search->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationsearch", "x_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_obligation_search->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<div id="r_PayrollPeriod" class="form-group row">
		<label for="x_PayrollPeriod" class="<?php echo $employee_obligation_search->LeftColumnClass ?>"><span id="elh_employee_obligation_PayrollPeriod"><?php echo $employee_obligation_search->PayrollPeriod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PayrollPeriod" id="z_PayrollPeriod" value="=">
</span>
		</label>
		<div class="<?php echo $employee_obligation_search->RightColumnClass ?>"><div <?php echo $employee_obligation_search->PayrollPeriod->cellAttributes() ?>>
			<span id="el_employee_obligation_PayrollPeriod" class="ew-search-field">
<input type="text" data-table="employee_obligation" data-field="x_PayrollPeriod" name="x_PayrollPeriod" id="x_PayrollPeriod" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_search->PayrollPeriod->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_search->PayrollPeriod->EditValue ?>"<?php echo $employee_obligation_search->PayrollPeriod->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_obligation_search->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label for="x_StartDate" class="<?php echo $employee_obligation_search->LeftColumnClass ?>"><span id="elh_employee_obligation_StartDate"><?php echo $employee_obligation_search->StartDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_StartDate" id="z_StartDate" value="=">
</span>
		</label>
		<div class="<?php echo $employee_obligation_search->RightColumnClass ?>"><div <?php echo $employee_obligation_search->StartDate->cellAttributes() ?>>
			<span id="el_employee_obligation_StartDate" class="ew-search-field">
<input type="text" data-table="employee_obligation" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($employee_obligation_search->StartDate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_search->StartDate->EditValue ?>"<?php echo $employee_obligation_search->StartDate->editAttributes() ?>>
<?php if (!$employee_obligation_search->StartDate->ReadOnly && !$employee_obligation_search->StartDate->Disabled && !isset($employee_obligation_search->StartDate->EditAttrs["readonly"]) && !isset($employee_obligation_search->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationsearch", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_obligation_search->Enddate->Visible) { // Enddate ?>
	<div id="r_Enddate" class="form-group row">
		<label for="x_Enddate" class="<?php echo $employee_obligation_search->LeftColumnClass ?>"><span id="elh_employee_obligation_Enddate"><?php echo $employee_obligation_search->Enddate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Enddate" id="z_Enddate" value="=">
</span>
		</label>
		<div class="<?php echo $employee_obligation_search->RightColumnClass ?>"><div <?php echo $employee_obligation_search->Enddate->cellAttributes() ?>>
			<span id="el_employee_obligation_Enddate" class="ew-search-field">
<input type="text" data-table="employee_obligation" data-field="x_Enddate" name="x_Enddate" id="x_Enddate" placeholder="<?php echo HtmlEncode($employee_obligation_search->Enddate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_search->Enddate->EditValue ?>"<?php echo $employee_obligation_search->Enddate->editAttributes() ?>>
<?php if (!$employee_obligation_search->Enddate->ReadOnly && !$employee_obligation_search->Enddate->Disabled && !isset($employee_obligation_search->Enddate->EditAttrs["readonly"]) && !isset($employee_obligation_search->Enddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationsearch", "x_Enddate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_obligation_search->ObligationCode->Visible) { // ObligationCode ?>
	<div id="r_ObligationCode" class="form-group row">
		<label for="x_ObligationCode" class="<?php echo $employee_obligation_search->LeftColumnClass ?>"><span id="elh_employee_obligation_ObligationCode"><?php echo $employee_obligation_search->ObligationCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ObligationCode" id="z_ObligationCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $employee_obligation_search->RightColumnClass ?>"><div <?php echo $employee_obligation_search->ObligationCode->cellAttributes() ?>>
			<span id="el_employee_obligation_ObligationCode" class="ew-search-field">
<input type="text" data-table="employee_obligation" data-field="x_ObligationCode" name="x_ObligationCode" id="x_ObligationCode" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($employee_obligation_search->ObligationCode->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_search->ObligationCode->EditValue ?>"<?php echo $employee_obligation_search->ObligationCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_obligation_search->ObligationAmount->Visible) { // ObligationAmount ?>
	<div id="r_ObligationAmount" class="form-group row">
		<label for="x_ObligationAmount" class="<?php echo $employee_obligation_search->LeftColumnClass ?>"><span id="elh_employee_obligation_ObligationAmount"><?php echo $employee_obligation_search->ObligationAmount->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ObligationAmount" id="z_ObligationAmount" value="=">
</span>
		</label>
		<div class="<?php echo $employee_obligation_search->RightColumnClass ?>"><div <?php echo $employee_obligation_search->ObligationAmount->cellAttributes() ?>>
			<span id="el_employee_obligation_ObligationAmount" class="ew-search-field">
<input type="text" data-table="employee_obligation" data-field="x_ObligationAmount" name="x_ObligationAmount" id="x_ObligationAmount" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_search->ObligationAmount->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_search->ObligationAmount->EditValue ?>"<?php echo $employee_obligation_search->ObligationAmount->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_obligation_search->Remarks->Visible) { // Remarks ?>
	<div id="r_Remarks" class="form-group row">
		<label for="x_Remarks" class="<?php echo $employee_obligation_search->LeftColumnClass ?>"><span id="elh_employee_obligation_Remarks"><?php echo $employee_obligation_search->Remarks->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Remarks" id="z_Remarks" value="=">
</span>
		</label>
		<div class="<?php echo $employee_obligation_search->RightColumnClass ?>"><div <?php echo $employee_obligation_search->Remarks->cellAttributes() ?>>
			<span id="el_employee_obligation_Remarks" class="ew-search-field">
<input type="text" data-table="employee_obligation" data-field="x_Remarks" name="x_Remarks" id="x_Remarks" size="35" placeholder="<?php echo HtmlEncode($employee_obligation_search->Remarks->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_search->Remarks->EditValue ?>"<?php echo $employee_obligation_search->Remarks->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$employee_obligation_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employee_obligation_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$employee_obligation_search->showPageFooter();
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
$employee_obligation_search->terminate();
?>