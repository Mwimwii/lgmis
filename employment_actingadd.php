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
$employment_acting_add = new employment_acting_add();

// Run the page
$employment_acting_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_acting_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployment_actingadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	femployment_actingadd = currentForm = new ew.Form("femployment_actingadd", "add");

	// Validate form
	femployment_actingadd.validate = function() {
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
			<?php if ($employment_acting_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_add->EmployeeID->caption(), $employment_acting_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_acting_add->EmployeeID->errorMessage()) ?>");
			<?php if ($employment_acting_add->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_add->ProvinceCode->caption(), $employment_acting_add->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_acting_add->ProvinceCode->errorMessage()) ?>");
			<?php if ($employment_acting_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_add->LACode->caption(), $employment_acting_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_acting_add->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_add->DepartmentCode->caption(), $employment_acting_add->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_acting_add->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_add->SectionCode->caption(), $employment_acting_add->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_acting_add->ActingPosition->Required) { ?>
				elm = this.getElements("x" + infix + "_ActingPosition");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_add->ActingPosition->caption(), $employment_acting_add->ActingPosition->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_acting_add->DateOfActingAppointment->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfActingAppointment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_add->DateOfActingAppointment->caption(), $employment_acting_add->DateOfActingAppointment->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfActingAppointment");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_acting_add->DateOfActingAppointment->errorMessage()) ?>");
			<?php if ($employment_acting_add->EndDateOfActingPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDateOfActingPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_add->EndDateOfActingPeriod->caption(), $employment_acting_add->EndDateOfActingPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDateOfActingPeriod");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_acting_add->EndDateOfActingPeriod->errorMessage()) ?>");
			<?php if ($employment_acting_add->SalaryScale->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryScale");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_add->SalaryScale->caption(), $employment_acting_add->SalaryScale->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_acting_add->ActingType->Required) { ?>
				elm = this.getElements("x" + infix + "_ActingType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_add->ActingType->caption(), $employment_acting_add->ActingType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_acting_add->ActingStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_ActingStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_add->ActingStatus->caption(), $employment_acting_add->ActingStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_acting_add->ActingReason->Required) { ?>
				elm = this.getElements("x" + infix + "_ActingReason");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_add->ActingReason->caption(), $employment_acting_add->ActingReason->RequiredErrorMessage)) ?>");
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
	femployment_actingadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployment_actingadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femployment_actingadd.lists["x_ProvinceCode"] = <?php echo $employment_acting_add->ProvinceCode->Lookup->toClientList($employment_acting_add) ?>;
	femployment_actingadd.lists["x_ProvinceCode"].options = <?php echo JsonEncode($employment_acting_add->ProvinceCode->lookupOptions()) ?>;
	femployment_actingadd.autoSuggests["x_ProvinceCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	femployment_actingadd.lists["x_LACode"] = <?php echo $employment_acting_add->LACode->Lookup->toClientList($employment_acting_add) ?>;
	femployment_actingadd.lists["x_LACode"].options = <?php echo JsonEncode($employment_acting_add->LACode->lookupOptions()) ?>;
	femployment_actingadd.lists["x_DepartmentCode"] = <?php echo $employment_acting_add->DepartmentCode->Lookup->toClientList($employment_acting_add) ?>;
	femployment_actingadd.lists["x_DepartmentCode"].options = <?php echo JsonEncode($employment_acting_add->DepartmentCode->lookupOptions()) ?>;
	femployment_actingadd.lists["x_SectionCode"] = <?php echo $employment_acting_add->SectionCode->Lookup->toClientList($employment_acting_add) ?>;
	femployment_actingadd.lists["x_SectionCode"].options = <?php echo JsonEncode($employment_acting_add->SectionCode->lookupOptions()) ?>;
	femployment_actingadd.lists["x_ActingPosition"] = <?php echo $employment_acting_add->ActingPosition->Lookup->toClientList($employment_acting_add) ?>;
	femployment_actingadd.lists["x_ActingPosition"].options = <?php echo JsonEncode($employment_acting_add->ActingPosition->lookupOptions()) ?>;
	femployment_actingadd.lists["x_ActingType"] = <?php echo $employment_acting_add->ActingType->Lookup->toClientList($employment_acting_add) ?>;
	femployment_actingadd.lists["x_ActingType"].options = <?php echo JsonEncode($employment_acting_add->ActingType->lookupOptions()) ?>;
	femployment_actingadd.lists["x_ActingStatus"] = <?php echo $employment_acting_add->ActingStatus->Lookup->toClientList($employment_acting_add) ?>;
	femployment_actingadd.lists["x_ActingStatus"].options = <?php echo JsonEncode($employment_acting_add->ActingStatus->lookupOptions()) ?>;
	femployment_actingadd.lists["x_ActingReason"] = <?php echo $employment_acting_add->ActingReason->Lookup->toClientList($employment_acting_add) ?>;
	femployment_actingadd.lists["x_ActingReason"].options = <?php echo JsonEncode($employment_acting_add->ActingReason->lookupOptions()) ?>;
	loadjs.done("femployment_actingadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employment_acting_add->showPageHeader(); ?>
<?php
$employment_acting_add->showMessage();
?>
<form name="femployment_actingadd" id="femployment_actingadd" class="<?php echo $employment_acting_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employment_acting">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$employment_acting_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($employment_acting_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_employment_acting_EmployeeID" for="x_EmployeeID" class="<?php echo $employment_acting_add->LeftColumnClass ?>"><?php echo $employment_acting_add->EmployeeID->caption() ?><?php echo $employment_acting_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_acting_add->RightColumnClass ?>"><div <?php echo $employment_acting_add->EmployeeID->cellAttributes() ?>>
<span id="el_employment_acting_EmployeeID">
<input type="text" data-table="employment_acting" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employment_acting_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employment_acting_add->EmployeeID->EditValue ?>"<?php echo $employment_acting_add->EmployeeID->editAttributes() ?>>
</span>
<?php echo $employment_acting_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_add->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_employment_acting_ProvinceCode" class="<?php echo $employment_acting_add->LeftColumnClass ?>"><?php echo $employment_acting_add->ProvinceCode->caption() ?><?php echo $employment_acting_add->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_acting_add->RightColumnClass ?>"><div <?php echo $employment_acting_add->ProvinceCode->cellAttributes() ?>>
<span id="el_employment_acting_ProvinceCode">
<?php
$onchange = $employment_acting_add->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employment_acting_add->ProvinceCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProvinceCode">
	<input type="text" class="form-control" name="sv_x_ProvinceCode" id="sv_x_ProvinceCode" value="<?php echo RemoveHtml($employment_acting_add->ProvinceCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employment_acting_add->ProvinceCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employment_acting_add->ProvinceCode->getPlaceHolder()) ?>"<?php echo $employment_acting_add->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_ProvinceCode" data-value-separator="<?php echo $employment_acting_add->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x_ProvinceCode" id="x_ProvinceCode" value="<?php echo HtmlEncode($employment_acting_add->ProvinceCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployment_actingadd"], function() {
	femployment_actingadd.createAutoSuggest({"id":"x_ProvinceCode","forceSelect":false});
});
</script>
<?php echo $employment_acting_add->ProvinceCode->Lookup->getParamTag($employment_acting_add, "p_x_ProvinceCode") ?>
</span>
<?php echo $employment_acting_add->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_employment_acting_LACode" for="x_LACode" class="<?php echo $employment_acting_add->LeftColumnClass ?>"><?php echo $employment_acting_add->LACode->caption() ?><?php echo $employment_acting_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_acting_add->RightColumnClass ?>"><div <?php echo $employment_acting_add->LACode->cellAttributes() ?>>
<span id="el_employment_acting_LACode">
<?php $employment_acting_add->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_LACode" data-value-separator="<?php echo $employment_acting_add->LACode->displayValueSeparatorAttribute() ?>" id="x_LACode" name="x_LACode"<?php echo $employment_acting_add->LACode->editAttributes() ?>>
			<?php echo $employment_acting_add->LACode->selectOptionListHtml("x_LACode") ?>
		</select>
</div>
<?php echo $employment_acting_add->LACode->Lookup->getParamTag($employment_acting_add, "p_x_LACode") ?>
</span>
<?php echo $employment_acting_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_add->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_employment_acting_DepartmentCode" for="x_DepartmentCode" class="<?php echo $employment_acting_add->LeftColumnClass ?>"><?php echo $employment_acting_add->DepartmentCode->caption() ?><?php echo $employment_acting_add->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_acting_add->RightColumnClass ?>"><div <?php echo $employment_acting_add->DepartmentCode->cellAttributes() ?>>
<span id="el_employment_acting_DepartmentCode">
<?php $employment_acting_add->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_DepartmentCode" data-value-separator="<?php echo $employment_acting_add->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $employment_acting_add->DepartmentCode->editAttributes() ?>>
			<?php echo $employment_acting_add->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $employment_acting_add->DepartmentCode->Lookup->getParamTag($employment_acting_add, "p_x_DepartmentCode") ?>
</span>
<?php echo $employment_acting_add->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_add->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_employment_acting_SectionCode" for="x_SectionCode" class="<?php echo $employment_acting_add->LeftColumnClass ?>"><?php echo $employment_acting_add->SectionCode->caption() ?><?php echo $employment_acting_add->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_acting_add->RightColumnClass ?>"><div <?php echo $employment_acting_add->SectionCode->cellAttributes() ?>>
<span id="el_employment_acting_SectionCode">
<?php $employment_acting_add->SectionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_SectionCode" data-value-separator="<?php echo $employment_acting_add->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $employment_acting_add->SectionCode->editAttributes() ?>>
			<?php echo $employment_acting_add->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $employment_acting_add->SectionCode->Lookup->getParamTag($employment_acting_add, "p_x_SectionCode") ?>
</span>
<?php echo $employment_acting_add->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_add->ActingPosition->Visible) { // ActingPosition ?>
	<div id="r_ActingPosition" class="form-group row">
		<label id="elh_employment_acting_ActingPosition" for="x_ActingPosition" class="<?php echo $employment_acting_add->LeftColumnClass ?>"><?php echo $employment_acting_add->ActingPosition->caption() ?><?php echo $employment_acting_add->ActingPosition->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_acting_add->RightColumnClass ?>"><div <?php echo $employment_acting_add->ActingPosition->cellAttributes() ?>>
<span id="el_employment_acting_ActingPosition">
<?php $employment_acting_add->ActingPosition->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_ActingPosition" data-value-separator="<?php echo $employment_acting_add->ActingPosition->displayValueSeparatorAttribute() ?>" id="x_ActingPosition" name="x_ActingPosition"<?php echo $employment_acting_add->ActingPosition->editAttributes() ?>>
			<?php echo $employment_acting_add->ActingPosition->selectOptionListHtml("x_ActingPosition") ?>
		</select>
</div>
<?php echo $employment_acting_add->ActingPosition->Lookup->getParamTag($employment_acting_add, "p_x_ActingPosition") ?>
</span>
<?php echo $employment_acting_add->ActingPosition->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_add->DateOfActingAppointment->Visible) { // DateOfActingAppointment ?>
	<div id="r_DateOfActingAppointment" class="form-group row">
		<label id="elh_employment_acting_DateOfActingAppointment" for="x_DateOfActingAppointment" class="<?php echo $employment_acting_add->LeftColumnClass ?>"><?php echo $employment_acting_add->DateOfActingAppointment->caption() ?><?php echo $employment_acting_add->DateOfActingAppointment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_acting_add->RightColumnClass ?>"><div <?php echo $employment_acting_add->DateOfActingAppointment->cellAttributes() ?>>
<span id="el_employment_acting_DateOfActingAppointment">
<input type="text" data-table="employment_acting" data-field="x_DateOfActingAppointment" name="x_DateOfActingAppointment" id="x_DateOfActingAppointment" placeholder="<?php echo HtmlEncode($employment_acting_add->DateOfActingAppointment->getPlaceHolder()) ?>" value="<?php echo $employment_acting_add->DateOfActingAppointment->EditValue ?>"<?php echo $employment_acting_add->DateOfActingAppointment->editAttributes() ?>>
<?php if (!$employment_acting_add->DateOfActingAppointment->ReadOnly && !$employment_acting_add->DateOfActingAppointment->Disabled && !isset($employment_acting_add->DateOfActingAppointment->EditAttrs["readonly"]) && !isset($employment_acting_add->DateOfActingAppointment->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployment_actingadd", "datetimepicker"], function() {
	ew.createDateTimePicker("femployment_actingadd", "x_DateOfActingAppointment", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employment_acting_add->DateOfActingAppointment->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_add->EndDateOfActingPeriod->Visible) { // EndDateOfActingPeriod ?>
	<div id="r_EndDateOfActingPeriod" class="form-group row">
		<label id="elh_employment_acting_EndDateOfActingPeriod" for="x_EndDateOfActingPeriod" class="<?php echo $employment_acting_add->LeftColumnClass ?>"><?php echo $employment_acting_add->EndDateOfActingPeriod->caption() ?><?php echo $employment_acting_add->EndDateOfActingPeriod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_acting_add->RightColumnClass ?>"><div <?php echo $employment_acting_add->EndDateOfActingPeriod->cellAttributes() ?>>
<span id="el_employment_acting_EndDateOfActingPeriod">
<input type="text" data-table="employment_acting" data-field="x_EndDateOfActingPeriod" name="x_EndDateOfActingPeriod" id="x_EndDateOfActingPeriod" placeholder="<?php echo HtmlEncode($employment_acting_add->EndDateOfActingPeriod->getPlaceHolder()) ?>" value="<?php echo $employment_acting_add->EndDateOfActingPeriod->EditValue ?>"<?php echo $employment_acting_add->EndDateOfActingPeriod->editAttributes() ?>>
<?php if (!$employment_acting_add->EndDateOfActingPeriod->ReadOnly && !$employment_acting_add->EndDateOfActingPeriod->Disabled && !isset($employment_acting_add->EndDateOfActingPeriod->EditAttrs["readonly"]) && !isset($employment_acting_add->EndDateOfActingPeriod->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployment_actingadd", "datetimepicker"], function() {
	ew.createDateTimePicker("femployment_actingadd", "x_EndDateOfActingPeriod", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employment_acting_add->EndDateOfActingPeriod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_add->SalaryScale->Visible) { // SalaryScale ?>
	<div id="r_SalaryScale" class="form-group row">
		<label id="elh_employment_acting_SalaryScale" for="x_SalaryScale" class="<?php echo $employment_acting_add->LeftColumnClass ?>"><?php echo $employment_acting_add->SalaryScale->caption() ?><?php echo $employment_acting_add->SalaryScale->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_acting_add->RightColumnClass ?>"><div <?php echo $employment_acting_add->SalaryScale->cellAttributes() ?>>
<span id="el_employment_acting_SalaryScale">
<input type="text" data-table="employment_acting" data-field="x_SalaryScale" name="x_SalaryScale" id="x_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_acting_add->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $employment_acting_add->SalaryScale->EditValue ?>"<?php echo $employment_acting_add->SalaryScale->editAttributes() ?>>
</span>
<?php echo $employment_acting_add->SalaryScale->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_add->ActingType->Visible) { // ActingType ?>
	<div id="r_ActingType" class="form-group row">
		<label id="elh_employment_acting_ActingType" for="x_ActingType" class="<?php echo $employment_acting_add->LeftColumnClass ?>"><?php echo $employment_acting_add->ActingType->caption() ?><?php echo $employment_acting_add->ActingType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_acting_add->RightColumnClass ?>"><div <?php echo $employment_acting_add->ActingType->cellAttributes() ?>>
<span id="el_employment_acting_ActingType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_ActingType" data-value-separator="<?php echo $employment_acting_add->ActingType->displayValueSeparatorAttribute() ?>" id="x_ActingType" name="x_ActingType"<?php echo $employment_acting_add->ActingType->editAttributes() ?>>
			<?php echo $employment_acting_add->ActingType->selectOptionListHtml("x_ActingType") ?>
		</select>
</div>
<?php echo $employment_acting_add->ActingType->Lookup->getParamTag($employment_acting_add, "p_x_ActingType") ?>
</span>
<?php echo $employment_acting_add->ActingType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_add->ActingStatus->Visible) { // ActingStatus ?>
	<div id="r_ActingStatus" class="form-group row">
		<label id="elh_employment_acting_ActingStatus" for="x_ActingStatus" class="<?php echo $employment_acting_add->LeftColumnClass ?>"><?php echo $employment_acting_add->ActingStatus->caption() ?><?php echo $employment_acting_add->ActingStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_acting_add->RightColumnClass ?>"><div <?php echo $employment_acting_add->ActingStatus->cellAttributes() ?>>
<span id="el_employment_acting_ActingStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_ActingStatus" data-value-separator="<?php echo $employment_acting_add->ActingStatus->displayValueSeparatorAttribute() ?>" id="x_ActingStatus" name="x_ActingStatus"<?php echo $employment_acting_add->ActingStatus->editAttributes() ?>>
			<?php echo $employment_acting_add->ActingStatus->selectOptionListHtml("x_ActingStatus") ?>
		</select>
</div>
<?php echo $employment_acting_add->ActingStatus->Lookup->getParamTag($employment_acting_add, "p_x_ActingStatus") ?>
</span>
<?php echo $employment_acting_add->ActingStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_add->ActingReason->Visible) { // ActingReason ?>
	<div id="r_ActingReason" class="form-group row">
		<label id="elh_employment_acting_ActingReason" for="x_ActingReason" class="<?php echo $employment_acting_add->LeftColumnClass ?>"><?php echo $employment_acting_add->ActingReason->caption() ?><?php echo $employment_acting_add->ActingReason->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_acting_add->RightColumnClass ?>"><div <?php echo $employment_acting_add->ActingReason->cellAttributes() ?>>
<span id="el_employment_acting_ActingReason">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_ActingReason" data-value-separator="<?php echo $employment_acting_add->ActingReason->displayValueSeparatorAttribute() ?>" id="x_ActingReason" name="x_ActingReason"<?php echo $employment_acting_add->ActingReason->editAttributes() ?>>
			<?php echo $employment_acting_add->ActingReason->selectOptionListHtml("x_ActingReason") ?>
		</select>
</div>
<?php echo $employment_acting_add->ActingReason->Lookup->getParamTag($employment_acting_add, "p_x_ActingReason") ?>
</span>
<?php echo $employment_acting_add->ActingReason->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$employment_acting_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employment_acting_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employment_acting_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$employment_acting_add->showPageFooter();
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
$employment_acting_add->terminate();
?>