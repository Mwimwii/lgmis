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
$employment_acting_edit = new employment_acting_edit();

// Run the page
$employment_acting_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_acting_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployment_actingedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	femployment_actingedit = currentForm = new ew.Form("femployment_actingedit", "edit");

	// Validate form
	femployment_actingedit.validate = function() {
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
			<?php if ($employment_acting_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_edit->EmployeeID->caption(), $employment_acting_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_acting_edit->EmployeeID->errorMessage()) ?>");
			<?php if ($employment_acting_edit->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_edit->ProvinceCode->caption(), $employment_acting_edit->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_acting_edit->ProvinceCode->errorMessage()) ?>");
			<?php if ($employment_acting_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_edit->LACode->caption(), $employment_acting_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_acting_edit->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_edit->DepartmentCode->caption(), $employment_acting_edit->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_acting_edit->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_edit->SectionCode->caption(), $employment_acting_edit->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_acting_edit->ActingPosition->Required) { ?>
				elm = this.getElements("x" + infix + "_ActingPosition");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_edit->ActingPosition->caption(), $employment_acting_edit->ActingPosition->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_acting_edit->DateOfActingAppointment->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfActingAppointment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_edit->DateOfActingAppointment->caption(), $employment_acting_edit->DateOfActingAppointment->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfActingAppointment");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_acting_edit->DateOfActingAppointment->errorMessage()) ?>");
			<?php if ($employment_acting_edit->EndDateOfActingPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDateOfActingPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_edit->EndDateOfActingPeriod->caption(), $employment_acting_edit->EndDateOfActingPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDateOfActingPeriod");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_acting_edit->EndDateOfActingPeriod->errorMessage()) ?>");
			<?php if ($employment_acting_edit->SalaryScale->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryScale");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_edit->SalaryScale->caption(), $employment_acting_edit->SalaryScale->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_acting_edit->ActingType->Required) { ?>
				elm = this.getElements("x" + infix + "_ActingType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_edit->ActingType->caption(), $employment_acting_edit->ActingType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_acting_edit->ActingStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_ActingStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_edit->ActingStatus->caption(), $employment_acting_edit->ActingStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_acting_edit->ActingReason->Required) { ?>
				elm = this.getElements("x" + infix + "_ActingReason");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_edit->ActingReason->caption(), $employment_acting_edit->ActingReason->RequiredErrorMessage)) ?>");
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
	femployment_actingedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployment_actingedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femployment_actingedit.lists["x_ProvinceCode"] = <?php echo $employment_acting_edit->ProvinceCode->Lookup->toClientList($employment_acting_edit) ?>;
	femployment_actingedit.lists["x_ProvinceCode"].options = <?php echo JsonEncode($employment_acting_edit->ProvinceCode->lookupOptions()) ?>;
	femployment_actingedit.autoSuggests["x_ProvinceCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	femployment_actingedit.lists["x_LACode"] = <?php echo $employment_acting_edit->LACode->Lookup->toClientList($employment_acting_edit) ?>;
	femployment_actingedit.lists["x_LACode"].options = <?php echo JsonEncode($employment_acting_edit->LACode->lookupOptions()) ?>;
	femployment_actingedit.lists["x_DepartmentCode"] = <?php echo $employment_acting_edit->DepartmentCode->Lookup->toClientList($employment_acting_edit) ?>;
	femployment_actingedit.lists["x_DepartmentCode"].options = <?php echo JsonEncode($employment_acting_edit->DepartmentCode->lookupOptions()) ?>;
	femployment_actingedit.lists["x_SectionCode"] = <?php echo $employment_acting_edit->SectionCode->Lookup->toClientList($employment_acting_edit) ?>;
	femployment_actingedit.lists["x_SectionCode"].options = <?php echo JsonEncode($employment_acting_edit->SectionCode->lookupOptions()) ?>;
	femployment_actingedit.lists["x_ActingPosition"] = <?php echo $employment_acting_edit->ActingPosition->Lookup->toClientList($employment_acting_edit) ?>;
	femployment_actingedit.lists["x_ActingPosition"].options = <?php echo JsonEncode($employment_acting_edit->ActingPosition->lookupOptions()) ?>;
	femployment_actingedit.lists["x_ActingType"] = <?php echo $employment_acting_edit->ActingType->Lookup->toClientList($employment_acting_edit) ?>;
	femployment_actingedit.lists["x_ActingType"].options = <?php echo JsonEncode($employment_acting_edit->ActingType->lookupOptions()) ?>;
	femployment_actingedit.lists["x_ActingStatus"] = <?php echo $employment_acting_edit->ActingStatus->Lookup->toClientList($employment_acting_edit) ?>;
	femployment_actingedit.lists["x_ActingStatus"].options = <?php echo JsonEncode($employment_acting_edit->ActingStatus->lookupOptions()) ?>;
	femployment_actingedit.lists["x_ActingReason"] = <?php echo $employment_acting_edit->ActingReason->Lookup->toClientList($employment_acting_edit) ?>;
	femployment_actingedit.lists["x_ActingReason"].options = <?php echo JsonEncode($employment_acting_edit->ActingReason->lookupOptions()) ?>;
	loadjs.done("femployment_actingedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employment_acting_edit->showPageHeader(); ?>
<?php
$employment_acting_edit->showMessage();
?>
<?php if (!$employment_acting_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employment_acting_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="femployment_actingedit" id="femployment_actingedit" class="<?php echo $employment_acting_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employment_acting">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$employment_acting_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($employment_acting_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_employment_acting_EmployeeID" for="x_EmployeeID" class="<?php echo $employment_acting_edit->LeftColumnClass ?>"><?php echo $employment_acting_edit->EmployeeID->caption() ?><?php echo $employment_acting_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_acting_edit->RightColumnClass ?>"><div <?php echo $employment_acting_edit->EmployeeID->cellAttributes() ?>>
<input type="text" data-table="employment_acting" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employment_acting_edit->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employment_acting_edit->EmployeeID->EditValue ?>"<?php echo $employment_acting_edit->EmployeeID->editAttributes() ?>>
<input type="hidden" data-table="employment_acting" data-field="x_EmployeeID" name="o_EmployeeID" id="o_EmployeeID" value="<?php echo HtmlEncode($employment_acting_edit->EmployeeID->OldValue != null ? $employment_acting_edit->EmployeeID->OldValue : $employment_acting_edit->EmployeeID->CurrentValue) ?>">
<?php echo $employment_acting_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_edit->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_employment_acting_ProvinceCode" class="<?php echo $employment_acting_edit->LeftColumnClass ?>"><?php echo $employment_acting_edit->ProvinceCode->caption() ?><?php echo $employment_acting_edit->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_acting_edit->RightColumnClass ?>"><div <?php echo $employment_acting_edit->ProvinceCode->cellAttributes() ?>>
<span id="el_employment_acting_ProvinceCode">
<?php
$onchange = $employment_acting_edit->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employment_acting_edit->ProvinceCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProvinceCode">
	<input type="text" class="form-control" name="sv_x_ProvinceCode" id="sv_x_ProvinceCode" value="<?php echo RemoveHtml($employment_acting_edit->ProvinceCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employment_acting_edit->ProvinceCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employment_acting_edit->ProvinceCode->getPlaceHolder()) ?>"<?php echo $employment_acting_edit->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_ProvinceCode" data-value-separator="<?php echo $employment_acting_edit->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x_ProvinceCode" id="x_ProvinceCode" value="<?php echo HtmlEncode($employment_acting_edit->ProvinceCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployment_actingedit"], function() {
	femployment_actingedit.createAutoSuggest({"id":"x_ProvinceCode","forceSelect":false});
});
</script>
<?php echo $employment_acting_edit->ProvinceCode->Lookup->getParamTag($employment_acting_edit, "p_x_ProvinceCode") ?>
</span>
<?php echo $employment_acting_edit->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_employment_acting_LACode" for="x_LACode" class="<?php echo $employment_acting_edit->LeftColumnClass ?>"><?php echo $employment_acting_edit->LACode->caption() ?><?php echo $employment_acting_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_acting_edit->RightColumnClass ?>"><div <?php echo $employment_acting_edit->LACode->cellAttributes() ?>>
<span id="el_employment_acting_LACode">
<?php $employment_acting_edit->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_LACode" data-value-separator="<?php echo $employment_acting_edit->LACode->displayValueSeparatorAttribute() ?>" id="x_LACode" name="x_LACode"<?php echo $employment_acting_edit->LACode->editAttributes() ?>>
			<?php echo $employment_acting_edit->LACode->selectOptionListHtml("x_LACode") ?>
		</select>
</div>
<?php echo $employment_acting_edit->LACode->Lookup->getParamTag($employment_acting_edit, "p_x_LACode") ?>
</span>
<?php echo $employment_acting_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_edit->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_employment_acting_DepartmentCode" for="x_DepartmentCode" class="<?php echo $employment_acting_edit->LeftColumnClass ?>"><?php echo $employment_acting_edit->DepartmentCode->caption() ?><?php echo $employment_acting_edit->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_acting_edit->RightColumnClass ?>"><div <?php echo $employment_acting_edit->DepartmentCode->cellAttributes() ?>>
<span id="el_employment_acting_DepartmentCode">
<?php $employment_acting_edit->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_DepartmentCode" data-value-separator="<?php echo $employment_acting_edit->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $employment_acting_edit->DepartmentCode->editAttributes() ?>>
			<?php echo $employment_acting_edit->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $employment_acting_edit->DepartmentCode->Lookup->getParamTag($employment_acting_edit, "p_x_DepartmentCode") ?>
</span>
<?php echo $employment_acting_edit->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_edit->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_employment_acting_SectionCode" for="x_SectionCode" class="<?php echo $employment_acting_edit->LeftColumnClass ?>"><?php echo $employment_acting_edit->SectionCode->caption() ?><?php echo $employment_acting_edit->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_acting_edit->RightColumnClass ?>"><div <?php echo $employment_acting_edit->SectionCode->cellAttributes() ?>>
<span id="el_employment_acting_SectionCode">
<?php $employment_acting_edit->SectionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_SectionCode" data-value-separator="<?php echo $employment_acting_edit->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $employment_acting_edit->SectionCode->editAttributes() ?>>
			<?php echo $employment_acting_edit->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $employment_acting_edit->SectionCode->Lookup->getParamTag($employment_acting_edit, "p_x_SectionCode") ?>
</span>
<?php echo $employment_acting_edit->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_edit->ActingPosition->Visible) { // ActingPosition ?>
	<div id="r_ActingPosition" class="form-group row">
		<label id="elh_employment_acting_ActingPosition" for="x_ActingPosition" class="<?php echo $employment_acting_edit->LeftColumnClass ?>"><?php echo $employment_acting_edit->ActingPosition->caption() ?><?php echo $employment_acting_edit->ActingPosition->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_acting_edit->RightColumnClass ?>"><div <?php echo $employment_acting_edit->ActingPosition->cellAttributes() ?>>
<?php $employment_acting_edit->ActingPosition->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_ActingPosition" data-value-separator="<?php echo $employment_acting_edit->ActingPosition->displayValueSeparatorAttribute() ?>" id="x_ActingPosition" name="x_ActingPosition"<?php echo $employment_acting_edit->ActingPosition->editAttributes() ?>>
			<?php echo $employment_acting_edit->ActingPosition->selectOptionListHtml("x_ActingPosition") ?>
		</select>
</div>
<?php echo $employment_acting_edit->ActingPosition->Lookup->getParamTag($employment_acting_edit, "p_x_ActingPosition") ?>
<input type="hidden" data-table="employment_acting" data-field="x_ActingPosition" name="o_ActingPosition" id="o_ActingPosition" value="<?php echo HtmlEncode($employment_acting_edit->ActingPosition->OldValue != null ? $employment_acting_edit->ActingPosition->OldValue : $employment_acting_edit->ActingPosition->CurrentValue) ?>">
<?php echo $employment_acting_edit->ActingPosition->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_edit->DateOfActingAppointment->Visible) { // DateOfActingAppointment ?>
	<div id="r_DateOfActingAppointment" class="form-group row">
		<label id="elh_employment_acting_DateOfActingAppointment" for="x_DateOfActingAppointment" class="<?php echo $employment_acting_edit->LeftColumnClass ?>"><?php echo $employment_acting_edit->DateOfActingAppointment->caption() ?><?php echo $employment_acting_edit->DateOfActingAppointment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_acting_edit->RightColumnClass ?>"><div <?php echo $employment_acting_edit->DateOfActingAppointment->cellAttributes() ?>>
<input type="text" data-table="employment_acting" data-field="x_DateOfActingAppointment" name="x_DateOfActingAppointment" id="x_DateOfActingAppointment" placeholder="<?php echo HtmlEncode($employment_acting_edit->DateOfActingAppointment->getPlaceHolder()) ?>" value="<?php echo $employment_acting_edit->DateOfActingAppointment->EditValue ?>"<?php echo $employment_acting_edit->DateOfActingAppointment->editAttributes() ?>>
<?php if (!$employment_acting_edit->DateOfActingAppointment->ReadOnly && !$employment_acting_edit->DateOfActingAppointment->Disabled && !isset($employment_acting_edit->DateOfActingAppointment->EditAttrs["readonly"]) && !isset($employment_acting_edit->DateOfActingAppointment->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployment_actingedit", "datetimepicker"], function() {
	ew.createDateTimePicker("femployment_actingedit", "x_DateOfActingAppointment", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
<input type="hidden" data-table="employment_acting" data-field="x_DateOfActingAppointment" name="o_DateOfActingAppointment" id="o_DateOfActingAppointment" value="<?php echo HtmlEncode($employment_acting_edit->DateOfActingAppointment->OldValue != null ? $employment_acting_edit->DateOfActingAppointment->OldValue : $employment_acting_edit->DateOfActingAppointment->CurrentValue) ?>">
<?php echo $employment_acting_edit->DateOfActingAppointment->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_edit->EndDateOfActingPeriod->Visible) { // EndDateOfActingPeriod ?>
	<div id="r_EndDateOfActingPeriod" class="form-group row">
		<label id="elh_employment_acting_EndDateOfActingPeriod" for="x_EndDateOfActingPeriod" class="<?php echo $employment_acting_edit->LeftColumnClass ?>"><?php echo $employment_acting_edit->EndDateOfActingPeriod->caption() ?><?php echo $employment_acting_edit->EndDateOfActingPeriod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_acting_edit->RightColumnClass ?>"><div <?php echo $employment_acting_edit->EndDateOfActingPeriod->cellAttributes() ?>>
<span id="el_employment_acting_EndDateOfActingPeriod">
<input type="text" data-table="employment_acting" data-field="x_EndDateOfActingPeriod" name="x_EndDateOfActingPeriod" id="x_EndDateOfActingPeriod" placeholder="<?php echo HtmlEncode($employment_acting_edit->EndDateOfActingPeriod->getPlaceHolder()) ?>" value="<?php echo $employment_acting_edit->EndDateOfActingPeriod->EditValue ?>"<?php echo $employment_acting_edit->EndDateOfActingPeriod->editAttributes() ?>>
<?php if (!$employment_acting_edit->EndDateOfActingPeriod->ReadOnly && !$employment_acting_edit->EndDateOfActingPeriod->Disabled && !isset($employment_acting_edit->EndDateOfActingPeriod->EditAttrs["readonly"]) && !isset($employment_acting_edit->EndDateOfActingPeriod->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployment_actingedit", "datetimepicker"], function() {
	ew.createDateTimePicker("femployment_actingedit", "x_EndDateOfActingPeriod", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employment_acting_edit->EndDateOfActingPeriod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_edit->SalaryScale->Visible) { // SalaryScale ?>
	<div id="r_SalaryScale" class="form-group row">
		<label id="elh_employment_acting_SalaryScale" for="x_SalaryScale" class="<?php echo $employment_acting_edit->LeftColumnClass ?>"><?php echo $employment_acting_edit->SalaryScale->caption() ?><?php echo $employment_acting_edit->SalaryScale->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_acting_edit->RightColumnClass ?>"><div <?php echo $employment_acting_edit->SalaryScale->cellAttributes() ?>>
<span id="el_employment_acting_SalaryScale">
<input type="text" data-table="employment_acting" data-field="x_SalaryScale" name="x_SalaryScale" id="x_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_acting_edit->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $employment_acting_edit->SalaryScale->EditValue ?>"<?php echo $employment_acting_edit->SalaryScale->editAttributes() ?>>
</span>
<?php echo $employment_acting_edit->SalaryScale->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_edit->ActingType->Visible) { // ActingType ?>
	<div id="r_ActingType" class="form-group row">
		<label id="elh_employment_acting_ActingType" for="x_ActingType" class="<?php echo $employment_acting_edit->LeftColumnClass ?>"><?php echo $employment_acting_edit->ActingType->caption() ?><?php echo $employment_acting_edit->ActingType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_acting_edit->RightColumnClass ?>"><div <?php echo $employment_acting_edit->ActingType->cellAttributes() ?>>
<span id="el_employment_acting_ActingType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_ActingType" data-value-separator="<?php echo $employment_acting_edit->ActingType->displayValueSeparatorAttribute() ?>" id="x_ActingType" name="x_ActingType"<?php echo $employment_acting_edit->ActingType->editAttributes() ?>>
			<?php echo $employment_acting_edit->ActingType->selectOptionListHtml("x_ActingType") ?>
		</select>
</div>
<?php echo $employment_acting_edit->ActingType->Lookup->getParamTag($employment_acting_edit, "p_x_ActingType") ?>
</span>
<?php echo $employment_acting_edit->ActingType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_edit->ActingStatus->Visible) { // ActingStatus ?>
	<div id="r_ActingStatus" class="form-group row">
		<label id="elh_employment_acting_ActingStatus" for="x_ActingStatus" class="<?php echo $employment_acting_edit->LeftColumnClass ?>"><?php echo $employment_acting_edit->ActingStatus->caption() ?><?php echo $employment_acting_edit->ActingStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_acting_edit->RightColumnClass ?>"><div <?php echo $employment_acting_edit->ActingStatus->cellAttributes() ?>>
<span id="el_employment_acting_ActingStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_ActingStatus" data-value-separator="<?php echo $employment_acting_edit->ActingStatus->displayValueSeparatorAttribute() ?>" id="x_ActingStatus" name="x_ActingStatus"<?php echo $employment_acting_edit->ActingStatus->editAttributes() ?>>
			<?php echo $employment_acting_edit->ActingStatus->selectOptionListHtml("x_ActingStatus") ?>
		</select>
</div>
<?php echo $employment_acting_edit->ActingStatus->Lookup->getParamTag($employment_acting_edit, "p_x_ActingStatus") ?>
</span>
<?php echo $employment_acting_edit->ActingStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_acting_edit->ActingReason->Visible) { // ActingReason ?>
	<div id="r_ActingReason" class="form-group row">
		<label id="elh_employment_acting_ActingReason" for="x_ActingReason" class="<?php echo $employment_acting_edit->LeftColumnClass ?>"><?php echo $employment_acting_edit->ActingReason->caption() ?><?php echo $employment_acting_edit->ActingReason->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_acting_edit->RightColumnClass ?>"><div <?php echo $employment_acting_edit->ActingReason->cellAttributes() ?>>
<span id="el_employment_acting_ActingReason">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_ActingReason" data-value-separator="<?php echo $employment_acting_edit->ActingReason->displayValueSeparatorAttribute() ?>" id="x_ActingReason" name="x_ActingReason"<?php echo $employment_acting_edit->ActingReason->editAttributes() ?>>
			<?php echo $employment_acting_edit->ActingReason->selectOptionListHtml("x_ActingReason") ?>
		</select>
</div>
<?php echo $employment_acting_edit->ActingReason->Lookup->getParamTag($employment_acting_edit, "p_x_ActingReason") ?>
</span>
<?php echo $employment_acting_edit->ActingReason->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$employment_acting_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employment_acting_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employment_acting_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$employment_acting_edit->IsModal) { ?>
<?php echo $employment_acting_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$employment_acting_edit->showPageFooter();
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
$employment_acting_edit->terminate();
?>