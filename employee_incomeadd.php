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
$employee_income_add = new employee_income_add();

// Run the page
$employee_income_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_income_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployee_incomeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	femployee_incomeadd = currentForm = new ew.Form("femployee_incomeadd", "add");

	// Validate form
	femployee_incomeadd.validate = function() {
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
			<?php if ($employee_income_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_add->EmployeeID->caption(), $employee_income_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_add->EmployeeID->errorMessage()) ?>");
			<?php if ($employee_income_add->PaidPosition->Required) { ?>
				elm = this.getElements("x" + infix + "_PaidPosition");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_add->PaidPosition->caption(), $employee_income_add->PaidPosition->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PaidPosition");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_add->PaidPosition->errorMessage()) ?>");
			<?php if ($employee_income_add->PayrollDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_add->PayrollDate->caption(), $employee_income_add->PayrollDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_add->PayrollDate->errorMessage()) ?>");
			<?php if ($employee_income_add->PayrollPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_add->PayrollPeriod->caption(), $employee_income_add->PayrollPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollPeriod");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_add->PayrollPeriod->errorMessage()) ?>");
			<?php if ($employee_income_add->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_add->StartDate->caption(), $employee_income_add->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_add->StartDate->errorMessage()) ?>");
			<?php if ($employee_income_add->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_add->EndDate->caption(), $employee_income_add->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_add->EndDate->errorMessage()) ?>");
			<?php if ($employee_income_add->IncomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_IncomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_add->IncomeCode->caption(), $employee_income_add->IncomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_income_add->Income->Required) { ?>
				elm = this.getElements("x" + infix + "_Income");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_add->Income->caption(), $employee_income_add->Income->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Income");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_add->Income->errorMessage()) ?>");
			<?php if ($employee_income_add->Remarks->Required) { ?>
				elm = this.getElements("x" + infix + "_Remarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_add->Remarks->caption(), $employee_income_add->Remarks->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_income_add->Taxable->Required) { ?>
				elm = this.getElements("x" + infix + "_Taxable");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_add->Taxable->caption(), $employee_income_add->Taxable->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Taxable");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_add->Taxable->errorMessage()) ?>");

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
	femployee_incomeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployee_incomeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femployee_incomeadd.lists["x_PaidPosition"] = <?php echo $employee_income_add->PaidPosition->Lookup->toClientList($employee_income_add) ?>;
	femployee_incomeadd.lists["x_PaidPosition"].options = <?php echo JsonEncode($employee_income_add->PaidPosition->lookupOptions()) ?>;
	femployee_incomeadd.autoSuggests["x_PaidPosition"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	femployee_incomeadd.lists["x_IncomeCode"] = <?php echo $employee_income_add->IncomeCode->Lookup->toClientList($employee_income_add) ?>;
	femployee_incomeadd.lists["x_IncomeCode"].options = <?php echo JsonEncode($employee_income_add->IncomeCode->lookupOptions()) ?>;
	loadjs.done("femployee_incomeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employee_income_add->showPageHeader(); ?>
<?php
$employee_income_add->showMessage();
?>
<form name="femployee_incomeadd" id="femployee_incomeadd" class="<?php echo $employee_income_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employee_income">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$employee_income_add->IsModal ?>">
<?php if ($employee_income->getCurrentMasterTable() == "employment") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="employment">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($employee_income_add->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($employee_income_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_employee_income_EmployeeID" for="x_EmployeeID" class="<?php echo $employee_income_add->LeftColumnClass ?>"><?php echo $employee_income_add->EmployeeID->caption() ?><?php echo $employee_income_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_income_add->RightColumnClass ?>"><div <?php echo $employee_income_add->EmployeeID->cellAttributes() ?>>
<?php if ($employee_income_add->EmployeeID->getSessionValue() != "") { ?>
<span id="el_employee_income_EmployeeID">
<span<?php echo $employee_income_add->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_income_add->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($employee_income_add->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_employee_income_EmployeeID">
<input type="text" data-table="employee_income" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employee_income_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employee_income_add->EmployeeID->EditValue ?>"<?php echo $employee_income_add->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $employee_income_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_income_add->PaidPosition->Visible) { // PaidPosition ?>
	<div id="r_PaidPosition" class="form-group row">
		<label id="elh_employee_income_PaidPosition" class="<?php echo $employee_income_add->LeftColumnClass ?>"><?php echo $employee_income_add->PaidPosition->caption() ?><?php echo $employee_income_add->PaidPosition->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_income_add->RightColumnClass ?>"><div <?php echo $employee_income_add->PaidPosition->cellAttributes() ?>>
<span id="el_employee_income_PaidPosition">
<?php
$onchange = $employee_income_add->PaidPosition->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employee_income_add->PaidPosition->EditAttrs["onchange"] = "";
?>
<span id="as_x_PaidPosition">
	<input type="text" class="form-control" name="sv_x_PaidPosition" id="sv_x_PaidPosition" value="<?php echo RemoveHtml($employee_income_add->PaidPosition->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employee_income_add->PaidPosition->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employee_income_add->PaidPosition->getPlaceHolder()) ?>"<?php echo $employee_income_add->PaidPosition->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_income" data-field="x_PaidPosition" data-value-separator="<?php echo $employee_income_add->PaidPosition->displayValueSeparatorAttribute() ?>" name="x_PaidPosition" id="x_PaidPosition" value="<?php echo HtmlEncode($employee_income_add->PaidPosition->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployee_incomeadd"], function() {
	femployee_incomeadd.createAutoSuggest({"id":"x_PaidPosition","forceSelect":false});
});
</script>
<?php echo $employee_income_add->PaidPosition->Lookup->getParamTag($employee_income_add, "p_x_PaidPosition") ?>
</span>
<?php echo $employee_income_add->PaidPosition->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_income_add->PayrollDate->Visible) { // PayrollDate ?>
	<div id="r_PayrollDate" class="form-group row">
		<label id="elh_employee_income_PayrollDate" for="x_PayrollDate" class="<?php echo $employee_income_add->LeftColumnClass ?>"><?php echo $employee_income_add->PayrollDate->caption() ?><?php echo $employee_income_add->PayrollDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_income_add->RightColumnClass ?>"><div <?php echo $employee_income_add->PayrollDate->cellAttributes() ?>>
<span id="el_employee_income_PayrollDate">
<input type="text" data-table="employee_income" data-field="x_PayrollDate" name="x_PayrollDate" id="x_PayrollDate" placeholder="<?php echo HtmlEncode($employee_income_add->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_add->PayrollDate->EditValue ?>"<?php echo $employee_income_add->PayrollDate->editAttributes() ?>>
<?php if (!$employee_income_add->PayrollDate->ReadOnly && !$employee_income_add->PayrollDate->Disabled && !isset($employee_income_add->PayrollDate->EditAttrs["readonly"]) && !isset($employee_income_add->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomeadd", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomeadd", "x_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employee_income_add->PayrollDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_income_add->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<div id="r_PayrollPeriod" class="form-group row">
		<label id="elh_employee_income_PayrollPeriod" for="x_PayrollPeriod" class="<?php echo $employee_income_add->LeftColumnClass ?>"><?php echo $employee_income_add->PayrollPeriod->caption() ?><?php echo $employee_income_add->PayrollPeriod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_income_add->RightColumnClass ?>"><div <?php echo $employee_income_add->PayrollPeriod->cellAttributes() ?>>
<span id="el_employee_income_PayrollPeriod">
<input type="text" data-table="employee_income" data-field="x_PayrollPeriod" name="x_PayrollPeriod" id="x_PayrollPeriod" size="30" placeholder="<?php echo HtmlEncode($employee_income_add->PayrollPeriod->getPlaceHolder()) ?>" value="<?php echo $employee_income_add->PayrollPeriod->EditValue ?>"<?php echo $employee_income_add->PayrollPeriod->editAttributes() ?>>
</span>
<?php echo $employee_income_add->PayrollPeriod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_income_add->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_employee_income_StartDate" for="x_StartDate" class="<?php echo $employee_income_add->LeftColumnClass ?>"><?php echo $employee_income_add->StartDate->caption() ?><?php echo $employee_income_add->StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_income_add->RightColumnClass ?>"><div <?php echo $employee_income_add->StartDate->cellAttributes() ?>>
<span id="el_employee_income_StartDate">
<input type="text" data-table="employee_income" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($employee_income_add->StartDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_add->StartDate->EditValue ?>"<?php echo $employee_income_add->StartDate->editAttributes() ?>>
<?php if (!$employee_income_add->StartDate->ReadOnly && !$employee_income_add->StartDate->Disabled && !isset($employee_income_add->StartDate->EditAttrs["readonly"]) && !isset($employee_income_add->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomeadd", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomeadd", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employee_income_add->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_income_add->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label id="elh_employee_income_EndDate" for="x_EndDate" class="<?php echo $employee_income_add->LeftColumnClass ?>"><?php echo $employee_income_add->EndDate->caption() ?><?php echo $employee_income_add->EndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_income_add->RightColumnClass ?>"><div <?php echo $employee_income_add->EndDate->cellAttributes() ?>>
<span id="el_employee_income_EndDate">
<input type="text" data-table="employee_income" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" placeholder="<?php echo HtmlEncode($employee_income_add->EndDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_add->EndDate->EditValue ?>"<?php echo $employee_income_add->EndDate->editAttributes() ?>>
<?php if (!$employee_income_add->EndDate->ReadOnly && !$employee_income_add->EndDate->Disabled && !isset($employee_income_add->EndDate->EditAttrs["readonly"]) && !isset($employee_income_add->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomeadd", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomeadd", "x_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employee_income_add->EndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_income_add->IncomeCode->Visible) { // IncomeCode ?>
	<div id="r_IncomeCode" class="form-group row">
		<label id="elh_employee_income_IncomeCode" for="x_IncomeCode" class="<?php echo $employee_income_add->LeftColumnClass ?>"><?php echo $employee_income_add->IncomeCode->caption() ?><?php echo $employee_income_add->IncomeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_income_add->RightColumnClass ?>"><div <?php echo $employee_income_add->IncomeCode->cellAttributes() ?>>
<span id="el_employee_income_IncomeCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_IncomeCode"><?php echo EmptyValue(strval($employee_income_add->IncomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employee_income_add->IncomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employee_income_add->IncomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employee_income_add->IncomeCode->ReadOnly || $employee_income_add->IncomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_IncomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employee_income_add->IncomeCode->Lookup->getParamTag($employee_income_add, "p_x_IncomeCode") ?>
<input type="hidden" data-table="employee_income" data-field="x_IncomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employee_income_add->IncomeCode->displayValueSeparatorAttribute() ?>" name="x_IncomeCode" id="x_IncomeCode" value="<?php echo $employee_income_add->IncomeCode->CurrentValue ?>"<?php echo $employee_income_add->IncomeCode->editAttributes() ?>>
</span>
<?php echo $employee_income_add->IncomeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_income_add->Income->Visible) { // Income ?>
	<div id="r_Income" class="form-group row">
		<label id="elh_employee_income_Income" for="x_Income" class="<?php echo $employee_income_add->LeftColumnClass ?>"><?php echo $employee_income_add->Income->caption() ?><?php echo $employee_income_add->Income->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_income_add->RightColumnClass ?>"><div <?php echo $employee_income_add->Income->cellAttributes() ?>>
<span id="el_employee_income_Income">
<input type="text" data-table="employee_income" data-field="x_Income" name="x_Income" id="x_Income" size="30" placeholder="<?php echo HtmlEncode($employee_income_add->Income->getPlaceHolder()) ?>" value="<?php echo $employee_income_add->Income->EditValue ?>"<?php echo $employee_income_add->Income->editAttributes() ?>>
</span>
<?php echo $employee_income_add->Income->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_income_add->Remarks->Visible) { // Remarks ?>
	<div id="r_Remarks" class="form-group row">
		<label id="elh_employee_income_Remarks" for="x_Remarks" class="<?php echo $employee_income_add->LeftColumnClass ?>"><?php echo $employee_income_add->Remarks->caption() ?><?php echo $employee_income_add->Remarks->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_income_add->RightColumnClass ?>"><div <?php echo $employee_income_add->Remarks->cellAttributes() ?>>
<span id="el_employee_income_Remarks">
<textarea data-table="employee_income" data-field="x_Remarks" name="x_Remarks" id="x_Remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employee_income_add->Remarks->getPlaceHolder()) ?>"<?php echo $employee_income_add->Remarks->editAttributes() ?>><?php echo $employee_income_add->Remarks->EditValue ?></textarea>
</span>
<?php echo $employee_income_add->Remarks->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_income_add->Taxable->Visible) { // Taxable ?>
	<div id="r_Taxable" class="form-group row">
		<label id="elh_employee_income_Taxable" for="x_Taxable" class="<?php echo $employee_income_add->LeftColumnClass ?>"><?php echo $employee_income_add->Taxable->caption() ?><?php echo $employee_income_add->Taxable->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_income_add->RightColumnClass ?>"><div <?php echo $employee_income_add->Taxable->cellAttributes() ?>>
<span id="el_employee_income_Taxable">
<input type="text" data-table="employee_income" data-field="x_Taxable" name="x_Taxable" id="x_Taxable" size="30" placeholder="<?php echo HtmlEncode($employee_income_add->Taxable->getPlaceHolder()) ?>" value="<?php echo $employee_income_add->Taxable->EditValue ?>"<?php echo $employee_income_add->Taxable->editAttributes() ?>>
</span>
<?php echo $employee_income_add->Taxable->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$employee_income_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employee_income_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employee_income_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$employee_income_add->showPageFooter();
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
$employee_income_add->terminate();
?>