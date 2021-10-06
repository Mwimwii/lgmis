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
$employee_income_edit = new employee_income_edit();

// Run the page
$employee_income_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_income_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployee_incomeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	femployee_incomeedit = currentForm = new ew.Form("femployee_incomeedit", "edit");

	// Validate form
	femployee_incomeedit.validate = function() {
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
			<?php if ($employee_income_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_edit->EmployeeID->caption(), $employee_income_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_edit->EmployeeID->errorMessage()) ?>");
			<?php if ($employee_income_edit->PaidPosition->Required) { ?>
				elm = this.getElements("x" + infix + "_PaidPosition");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_edit->PaidPosition->caption(), $employee_income_edit->PaidPosition->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PaidPosition");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_edit->PaidPosition->errorMessage()) ?>");
			<?php if ($employee_income_edit->PayrollDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_edit->PayrollDate->caption(), $employee_income_edit->PayrollDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_edit->PayrollDate->errorMessage()) ?>");
			<?php if ($employee_income_edit->PayrollPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_edit->PayrollPeriod->caption(), $employee_income_edit->PayrollPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollPeriod");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_edit->PayrollPeriod->errorMessage()) ?>");
			<?php if ($employee_income_edit->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_edit->StartDate->caption(), $employee_income_edit->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_edit->StartDate->errorMessage()) ?>");
			<?php if ($employee_income_edit->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_edit->EndDate->caption(), $employee_income_edit->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_edit->EndDate->errorMessage()) ?>");
			<?php if ($employee_income_edit->IncomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_IncomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_edit->IncomeCode->caption(), $employee_income_edit->IncomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_income_edit->Income->Required) { ?>
				elm = this.getElements("x" + infix + "_Income");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_edit->Income->caption(), $employee_income_edit->Income->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Income");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_edit->Income->errorMessage()) ?>");
			<?php if ($employee_income_edit->Remarks->Required) { ?>
				elm = this.getElements("x" + infix + "_Remarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_edit->Remarks->caption(), $employee_income_edit->Remarks->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_income_edit->Taxable->Required) { ?>
				elm = this.getElements("x" + infix + "_Taxable");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_edit->Taxable->caption(), $employee_income_edit->Taxable->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Taxable");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_edit->Taxable->errorMessage()) ?>");

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
	femployee_incomeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployee_incomeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femployee_incomeedit.lists["x_PaidPosition"] = <?php echo $employee_income_edit->PaidPosition->Lookup->toClientList($employee_income_edit) ?>;
	femployee_incomeedit.lists["x_PaidPosition"].options = <?php echo JsonEncode($employee_income_edit->PaidPosition->lookupOptions()) ?>;
	femployee_incomeedit.autoSuggests["x_PaidPosition"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	femployee_incomeedit.lists["x_IncomeCode"] = <?php echo $employee_income_edit->IncomeCode->Lookup->toClientList($employee_income_edit) ?>;
	femployee_incomeedit.lists["x_IncomeCode"].options = <?php echo JsonEncode($employee_income_edit->IncomeCode->lookupOptions()) ?>;
	loadjs.done("femployee_incomeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employee_income_edit->showPageHeader(); ?>
<?php
$employee_income_edit->showMessage();
?>
<?php if (!$employee_income_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employee_income_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="femployee_incomeedit" id="femployee_incomeedit" class="<?php echo $employee_income_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employee_income">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$employee_income_edit->IsModal ?>">
<?php if ($employee_income->getCurrentMasterTable() == "employment") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="employment">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($employee_income_edit->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($employee_income_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_employee_income_EmployeeID" for="x_EmployeeID" class="<?php echo $employee_income_edit->LeftColumnClass ?>"><?php echo $employee_income_edit->EmployeeID->caption() ?><?php echo $employee_income_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_income_edit->RightColumnClass ?>"><div <?php echo $employee_income_edit->EmployeeID->cellAttributes() ?>>
<?php if ($employee_income_edit->EmployeeID->getSessionValue() != "") { ?>

<span id="el_employee_income_EmployeeID">
<span<?php echo $employee_income_edit->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_income_edit->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($employee_income_edit->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="employee_income" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employee_income_edit->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employee_income_edit->EmployeeID->EditValue ?>"<?php echo $employee_income_edit->EmployeeID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="employee_income" data-field="x_EmployeeID" name="o_EmployeeID" id="o_EmployeeID" value="<?php echo HtmlEncode($employee_income_edit->EmployeeID->OldValue != null ? $employee_income_edit->EmployeeID->OldValue : $employee_income_edit->EmployeeID->CurrentValue) ?>">
<?php echo $employee_income_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_income_edit->PaidPosition->Visible) { // PaidPosition ?>
	<div id="r_PaidPosition" class="form-group row">
		<label id="elh_employee_income_PaidPosition" class="<?php echo $employee_income_edit->LeftColumnClass ?>"><?php echo $employee_income_edit->PaidPosition->caption() ?><?php echo $employee_income_edit->PaidPosition->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_income_edit->RightColumnClass ?>"><div <?php echo $employee_income_edit->PaidPosition->cellAttributes() ?>>
<span id="el_employee_income_PaidPosition">
<?php
$onchange = $employee_income_edit->PaidPosition->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employee_income_edit->PaidPosition->EditAttrs["onchange"] = "";
?>
<span id="as_x_PaidPosition">
	<input type="text" class="form-control" name="sv_x_PaidPosition" id="sv_x_PaidPosition" value="<?php echo RemoveHtml($employee_income_edit->PaidPosition->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employee_income_edit->PaidPosition->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employee_income_edit->PaidPosition->getPlaceHolder()) ?>"<?php echo $employee_income_edit->PaidPosition->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_income" data-field="x_PaidPosition" data-value-separator="<?php echo $employee_income_edit->PaidPosition->displayValueSeparatorAttribute() ?>" name="x_PaidPosition" id="x_PaidPosition" value="<?php echo HtmlEncode($employee_income_edit->PaidPosition->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployee_incomeedit"], function() {
	femployee_incomeedit.createAutoSuggest({"id":"x_PaidPosition","forceSelect":false});
});
</script>
<?php echo $employee_income_edit->PaidPosition->Lookup->getParamTag($employee_income_edit, "p_x_PaidPosition") ?>
</span>
<?php echo $employee_income_edit->PaidPosition->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_income_edit->PayrollDate->Visible) { // PayrollDate ?>
	<div id="r_PayrollDate" class="form-group row">
		<label id="elh_employee_income_PayrollDate" for="x_PayrollDate" class="<?php echo $employee_income_edit->LeftColumnClass ?>"><?php echo $employee_income_edit->PayrollDate->caption() ?><?php echo $employee_income_edit->PayrollDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_income_edit->RightColumnClass ?>"><div <?php echo $employee_income_edit->PayrollDate->cellAttributes() ?>>
<span id="el_employee_income_PayrollDate">
<input type="text" data-table="employee_income" data-field="x_PayrollDate" name="x_PayrollDate" id="x_PayrollDate" placeholder="<?php echo HtmlEncode($employee_income_edit->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_edit->PayrollDate->EditValue ?>"<?php echo $employee_income_edit->PayrollDate->editAttributes() ?>>
<?php if (!$employee_income_edit->PayrollDate->ReadOnly && !$employee_income_edit->PayrollDate->Disabled && !isset($employee_income_edit->PayrollDate->EditAttrs["readonly"]) && !isset($employee_income_edit->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomeedit", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomeedit", "x_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employee_income_edit->PayrollDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_income_edit->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<div id="r_PayrollPeriod" class="form-group row">
		<label id="elh_employee_income_PayrollPeriod" for="x_PayrollPeriod" class="<?php echo $employee_income_edit->LeftColumnClass ?>"><?php echo $employee_income_edit->PayrollPeriod->caption() ?><?php echo $employee_income_edit->PayrollPeriod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_income_edit->RightColumnClass ?>"><div <?php echo $employee_income_edit->PayrollPeriod->cellAttributes() ?>>
<input type="text" data-table="employee_income" data-field="x_PayrollPeriod" name="x_PayrollPeriod" id="x_PayrollPeriod" size="30" placeholder="<?php echo HtmlEncode($employee_income_edit->PayrollPeriod->getPlaceHolder()) ?>" value="<?php echo $employee_income_edit->PayrollPeriod->EditValue ?>"<?php echo $employee_income_edit->PayrollPeriod->editAttributes() ?>>
<input type="hidden" data-table="employee_income" data-field="x_PayrollPeriod" name="o_PayrollPeriod" id="o_PayrollPeriod" value="<?php echo HtmlEncode($employee_income_edit->PayrollPeriod->OldValue != null ? $employee_income_edit->PayrollPeriod->OldValue : $employee_income_edit->PayrollPeriod->CurrentValue) ?>">
<?php echo $employee_income_edit->PayrollPeriod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_income_edit->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_employee_income_StartDate" for="x_StartDate" class="<?php echo $employee_income_edit->LeftColumnClass ?>"><?php echo $employee_income_edit->StartDate->caption() ?><?php echo $employee_income_edit->StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_income_edit->RightColumnClass ?>"><div <?php echo $employee_income_edit->StartDate->cellAttributes() ?>>
<span id="el_employee_income_StartDate">
<input type="text" data-table="employee_income" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($employee_income_edit->StartDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_edit->StartDate->EditValue ?>"<?php echo $employee_income_edit->StartDate->editAttributes() ?>>
<?php if (!$employee_income_edit->StartDate->ReadOnly && !$employee_income_edit->StartDate->Disabled && !isset($employee_income_edit->StartDate->EditAttrs["readonly"]) && !isset($employee_income_edit->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomeedit", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomeedit", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employee_income_edit->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_income_edit->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label id="elh_employee_income_EndDate" for="x_EndDate" class="<?php echo $employee_income_edit->LeftColumnClass ?>"><?php echo $employee_income_edit->EndDate->caption() ?><?php echo $employee_income_edit->EndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_income_edit->RightColumnClass ?>"><div <?php echo $employee_income_edit->EndDate->cellAttributes() ?>>
<span id="el_employee_income_EndDate">
<input type="text" data-table="employee_income" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" placeholder="<?php echo HtmlEncode($employee_income_edit->EndDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_edit->EndDate->EditValue ?>"<?php echo $employee_income_edit->EndDate->editAttributes() ?>>
<?php if (!$employee_income_edit->EndDate->ReadOnly && !$employee_income_edit->EndDate->Disabled && !isset($employee_income_edit->EndDate->EditAttrs["readonly"]) && !isset($employee_income_edit->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomeedit", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomeedit", "x_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employee_income_edit->EndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_income_edit->IncomeCode->Visible) { // IncomeCode ?>
	<div id="r_IncomeCode" class="form-group row">
		<label id="elh_employee_income_IncomeCode" for="x_IncomeCode" class="<?php echo $employee_income_edit->LeftColumnClass ?>"><?php echo $employee_income_edit->IncomeCode->caption() ?><?php echo $employee_income_edit->IncomeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_income_edit->RightColumnClass ?>"><div <?php echo $employee_income_edit->IncomeCode->cellAttributes() ?>>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_IncomeCode"><?php echo EmptyValue(strval($employee_income_edit->IncomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employee_income_edit->IncomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employee_income_edit->IncomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employee_income_edit->IncomeCode->ReadOnly || $employee_income_edit->IncomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_IncomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employee_income_edit->IncomeCode->Lookup->getParamTag($employee_income_edit, "p_x_IncomeCode") ?>
<input type="hidden" data-table="employee_income" data-field="x_IncomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employee_income_edit->IncomeCode->displayValueSeparatorAttribute() ?>" name="x_IncomeCode" id="x_IncomeCode" value="<?php echo $employee_income_edit->IncomeCode->CurrentValue ?>"<?php echo $employee_income_edit->IncomeCode->editAttributes() ?>>
<input type="hidden" data-table="employee_income" data-field="x_IncomeCode" name="o_IncomeCode" id="o_IncomeCode" value="<?php echo HtmlEncode($employee_income_edit->IncomeCode->OldValue != null ? $employee_income_edit->IncomeCode->OldValue : $employee_income_edit->IncomeCode->CurrentValue) ?>">
<?php echo $employee_income_edit->IncomeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_income_edit->Income->Visible) { // Income ?>
	<div id="r_Income" class="form-group row">
		<label id="elh_employee_income_Income" for="x_Income" class="<?php echo $employee_income_edit->LeftColumnClass ?>"><?php echo $employee_income_edit->Income->caption() ?><?php echo $employee_income_edit->Income->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_income_edit->RightColumnClass ?>"><div <?php echo $employee_income_edit->Income->cellAttributes() ?>>
<span id="el_employee_income_Income">
<input type="text" data-table="employee_income" data-field="x_Income" name="x_Income" id="x_Income" size="30" placeholder="<?php echo HtmlEncode($employee_income_edit->Income->getPlaceHolder()) ?>" value="<?php echo $employee_income_edit->Income->EditValue ?>"<?php echo $employee_income_edit->Income->editAttributes() ?>>
</span>
<?php echo $employee_income_edit->Income->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_income_edit->Remarks->Visible) { // Remarks ?>
	<div id="r_Remarks" class="form-group row">
		<label id="elh_employee_income_Remarks" for="x_Remarks" class="<?php echo $employee_income_edit->LeftColumnClass ?>"><?php echo $employee_income_edit->Remarks->caption() ?><?php echo $employee_income_edit->Remarks->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_income_edit->RightColumnClass ?>"><div <?php echo $employee_income_edit->Remarks->cellAttributes() ?>>
<span id="el_employee_income_Remarks">
<textarea data-table="employee_income" data-field="x_Remarks" name="x_Remarks" id="x_Remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employee_income_edit->Remarks->getPlaceHolder()) ?>"<?php echo $employee_income_edit->Remarks->editAttributes() ?>><?php echo $employee_income_edit->Remarks->EditValue ?></textarea>
</span>
<?php echo $employee_income_edit->Remarks->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_income_edit->Taxable->Visible) { // Taxable ?>
	<div id="r_Taxable" class="form-group row">
		<label id="elh_employee_income_Taxable" for="x_Taxable" class="<?php echo $employee_income_edit->LeftColumnClass ?>"><?php echo $employee_income_edit->Taxable->caption() ?><?php echo $employee_income_edit->Taxable->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_income_edit->RightColumnClass ?>"><div <?php echo $employee_income_edit->Taxable->cellAttributes() ?>>
<span id="el_employee_income_Taxable">
<input type="text" data-table="employee_income" data-field="x_Taxable" name="x_Taxable" id="x_Taxable" size="30" placeholder="<?php echo HtmlEncode($employee_income_edit->Taxable->getPlaceHolder()) ?>" value="<?php echo $employee_income_edit->Taxable->EditValue ?>"<?php echo $employee_income_edit->Taxable->editAttributes() ?>>
</span>
<?php echo $employee_income_edit->Taxable->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$employee_income_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employee_income_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employee_income_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$employee_income_edit->IsModal) { ?>
<?php echo $employee_income_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$employee_income_edit->showPageFooter();
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
$employee_income_edit->terminate();
?>