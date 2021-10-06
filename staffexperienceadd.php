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
$staffexperience_add = new staffexperience_add();

// Run the page
$staffexperience_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffexperience_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffexperienceadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fstaffexperienceadd = currentForm = new ew.Form("fstaffexperienceadd", "add");

	// Validate form
	fstaffexperienceadd.validate = function() {
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
			<?php if ($staffexperience_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_add->EmployeeID->caption(), $staffexperience_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffexperience_add->EmployeeID->errorMessage()) ?>");
			<?php if ($staffexperience_add->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_add->ProvinceCode->caption(), $staffexperience_add->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffexperience_add->LAcode->Required) { ?>
				elm = this.getElements("x" + infix + "_LAcode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_add->LAcode->caption(), $staffexperience_add->LAcode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffexperience_add->PositionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_add->PositionCode->caption(), $staffexperience_add->PositionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffexperience_add->FromDate->Required) { ?>
				elm = this.getElements("x" + infix + "_FromDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_add->FromDate->caption(), $staffexperience_add->FromDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FromDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffexperience_add->FromDate->errorMessage()) ?>");
			<?php if ($staffexperience_add->ExitDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ExitDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_add->ExitDate->caption(), $staffexperience_add->ExitDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ExitDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffexperience_add->ExitDate->errorMessage()) ?>");
			<?php if ($staffexperience_add->RelevantExperience->Required) { ?>
				elm = this.getElements("x" + infix + "_RelevantExperience");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_add->RelevantExperience->caption(), $staffexperience_add->RelevantExperience->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffexperience_add->ReasonForExit->Required) { ?>
				elm = this.getElements("x" + infix + "_ReasonForExit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_add->ReasonForExit->caption(), $staffexperience_add->ReasonForExit->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffexperience_add->RetirementType->Required) { ?>
				elm = this.getElements("x" + infix + "_RetirementType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_add->RetirementType->caption(), $staffexperience_add->RetirementType->RequiredErrorMessage)) ?>");
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
	fstaffexperienceadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffexperienceadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffexperienceadd.lists["x_ProvinceCode"] = <?php echo $staffexperience_add->ProvinceCode->Lookup->toClientList($staffexperience_add) ?>;
	fstaffexperienceadd.lists["x_ProvinceCode"].options = <?php echo JsonEncode($staffexperience_add->ProvinceCode->lookupOptions()) ?>;
	fstaffexperienceadd.lists["x_LAcode"] = <?php echo $staffexperience_add->LAcode->Lookup->toClientList($staffexperience_add) ?>;
	fstaffexperienceadd.lists["x_LAcode"].options = <?php echo JsonEncode($staffexperience_add->LAcode->lookupOptions()) ?>;
	fstaffexperienceadd.lists["x_PositionCode"] = <?php echo $staffexperience_add->PositionCode->Lookup->toClientList($staffexperience_add) ?>;
	fstaffexperienceadd.lists["x_PositionCode"].options = <?php echo JsonEncode($staffexperience_add->PositionCode->lookupOptions()) ?>;
	fstaffexperienceadd.lists["x_ReasonForExit"] = <?php echo $staffexperience_add->ReasonForExit->Lookup->toClientList($staffexperience_add) ?>;
	fstaffexperienceadd.lists["x_ReasonForExit"].options = <?php echo JsonEncode($staffexperience_add->ReasonForExit->lookupOptions()) ?>;
	fstaffexperienceadd.lists["x_RetirementType"] = <?php echo $staffexperience_add->RetirementType->Lookup->toClientList($staffexperience_add) ?>;
	fstaffexperienceadd.lists["x_RetirementType"].options = <?php echo JsonEncode($staffexperience_add->RetirementType->lookupOptions()) ?>;
	loadjs.done("fstaffexperienceadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffexperience_add->showPageHeader(); ?>
<?php
$staffexperience_add->showMessage();
?>
<form name="fstaffexperienceadd" id="fstaffexperienceadd" class="<?php echo $staffexperience_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffexperience">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$staffexperience_add->IsModal ?>">
<?php if ($staffexperience->getCurrentMasterTable() == "staff") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffexperience_add->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($staffexperience_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_staffexperience_EmployeeID" for="x_EmployeeID" class="<?php echo $staffexperience_add->LeftColumnClass ?>"><?php echo $staffexperience_add->EmployeeID->caption() ?><?php echo $staffexperience_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffexperience_add->RightColumnClass ?>"><div <?php echo $staffexperience_add->EmployeeID->cellAttributes() ?>>
<?php if ($staffexperience_add->EmployeeID->getSessionValue() != "") { ?>
<span id="el_staffexperience_EmployeeID">
<span<?php echo $staffexperience_add->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffexperience_add->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($staffexperience_add->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_staffexperience_EmployeeID">
<input type="text" data-table="staffexperience" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($staffexperience_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $staffexperience_add->EmployeeID->EditValue ?>"<?php echo $staffexperience_add->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $staffexperience_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffexperience_add->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_staffexperience_ProvinceCode" for="x_ProvinceCode" class="<?php echo $staffexperience_add->LeftColumnClass ?>"><?php echo $staffexperience_add->ProvinceCode->caption() ?><?php echo $staffexperience_add->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffexperience_add->RightColumnClass ?>"><div <?php echo $staffexperience_add->ProvinceCode->cellAttributes() ?>>
<span id="el_staffexperience_ProvinceCode">
<?php $staffexperience_add->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_ProvinceCode" data-value-separator="<?php echo $staffexperience_add->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $staffexperience_add->ProvinceCode->editAttributes() ?>>
			<?php echo $staffexperience_add->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $staffexperience_add->ProvinceCode->Lookup->getParamTag($staffexperience_add, "p_x_ProvinceCode") ?>
</span>
<?php echo $staffexperience_add->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffexperience_add->LAcode->Visible) { // LAcode ?>
	<div id="r_LAcode" class="form-group row">
		<label id="elh_staffexperience_LAcode" for="x_LAcode" class="<?php echo $staffexperience_add->LeftColumnClass ?>"><?php echo $staffexperience_add->LAcode->caption() ?><?php echo $staffexperience_add->LAcode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffexperience_add->RightColumnClass ?>"><div <?php echo $staffexperience_add->LAcode->cellAttributes() ?>>
<span id="el_staffexperience_LAcode">
<?php $staffexperience_add->LAcode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LAcode"><?php echo EmptyValue(strval($staffexperience_add->LAcode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffexperience_add->LAcode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffexperience_add->LAcode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffexperience_add->LAcode->ReadOnly || $staffexperience_add->LAcode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LAcode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffexperience_add->LAcode->Lookup->getParamTag($staffexperience_add, "p_x_LAcode") ?>
<input type="hidden" data-table="staffexperience" data-field="x_LAcode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffexperience_add->LAcode->displayValueSeparatorAttribute() ?>" name="x_LAcode" id="x_LAcode" value="<?php echo $staffexperience_add->LAcode->CurrentValue ?>"<?php echo $staffexperience_add->LAcode->editAttributes() ?>>
</span>
<?php echo $staffexperience_add->LAcode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffexperience_add->PositionCode->Visible) { // PositionCode ?>
	<div id="r_PositionCode" class="form-group row">
		<label id="elh_staffexperience_PositionCode" for="x_PositionCode" class="<?php echo $staffexperience_add->LeftColumnClass ?>"><?php echo $staffexperience_add->PositionCode->caption() ?><?php echo $staffexperience_add->PositionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffexperience_add->RightColumnClass ?>"><div <?php echo $staffexperience_add->PositionCode->cellAttributes() ?>>
<span id="el_staffexperience_PositionCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_PositionCode"><?php echo EmptyValue(strval($staffexperience_add->PositionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffexperience_add->PositionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffexperience_add->PositionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffexperience_add->PositionCode->ReadOnly || $staffexperience_add->PositionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_PositionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffexperience_add->PositionCode->Lookup->getParamTag($staffexperience_add, "p_x_PositionCode") ?>
<input type="hidden" data-table="staffexperience" data-field="x_PositionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffexperience_add->PositionCode->displayValueSeparatorAttribute() ?>" name="x_PositionCode" id="x_PositionCode" value="<?php echo $staffexperience_add->PositionCode->CurrentValue ?>"<?php echo $staffexperience_add->PositionCode->editAttributes() ?>>
</span>
<?php echo $staffexperience_add->PositionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffexperience_add->FromDate->Visible) { // FromDate ?>
	<div id="r_FromDate" class="form-group row">
		<label id="elh_staffexperience_FromDate" for="x_FromDate" class="<?php echo $staffexperience_add->LeftColumnClass ?>"><?php echo $staffexperience_add->FromDate->caption() ?><?php echo $staffexperience_add->FromDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffexperience_add->RightColumnClass ?>"><div <?php echo $staffexperience_add->FromDate->cellAttributes() ?>>
<span id="el_staffexperience_FromDate">
<input type="text" data-table="staffexperience" data-field="x_FromDate" name="x_FromDate" id="x_FromDate" placeholder="<?php echo HtmlEncode($staffexperience_add->FromDate->getPlaceHolder()) ?>" value="<?php echo $staffexperience_add->FromDate->EditValue ?>"<?php echo $staffexperience_add->FromDate->editAttributes() ?>>
<?php if (!$staffexperience_add->FromDate->ReadOnly && !$staffexperience_add->FromDate->Disabled && !isset($staffexperience_add->FromDate->EditAttrs["readonly"]) && !isset($staffexperience_add->FromDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffexperienceadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffexperienceadd", "x_FromDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffexperience_add->FromDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffexperience_add->ExitDate->Visible) { // ExitDate ?>
	<div id="r_ExitDate" class="form-group row">
		<label id="elh_staffexperience_ExitDate" for="x_ExitDate" class="<?php echo $staffexperience_add->LeftColumnClass ?>"><?php echo $staffexperience_add->ExitDate->caption() ?><?php echo $staffexperience_add->ExitDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffexperience_add->RightColumnClass ?>"><div <?php echo $staffexperience_add->ExitDate->cellAttributes() ?>>
<span id="el_staffexperience_ExitDate">
<input type="text" data-table="staffexperience" data-field="x_ExitDate" name="x_ExitDate" id="x_ExitDate" placeholder="<?php echo HtmlEncode($staffexperience_add->ExitDate->getPlaceHolder()) ?>" value="<?php echo $staffexperience_add->ExitDate->EditValue ?>"<?php echo $staffexperience_add->ExitDate->editAttributes() ?>>
<?php if (!$staffexperience_add->ExitDate->ReadOnly && !$staffexperience_add->ExitDate->Disabled && !isset($staffexperience_add->ExitDate->EditAttrs["readonly"]) && !isset($staffexperience_add->ExitDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffexperienceadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffexperienceadd", "x_ExitDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffexperience_add->ExitDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffexperience_add->RelevantExperience->Visible) { // RelevantExperience ?>
	<div id="r_RelevantExperience" class="form-group row">
		<label id="elh_staffexperience_RelevantExperience" for="x_RelevantExperience" class="<?php echo $staffexperience_add->LeftColumnClass ?>"><?php echo $staffexperience_add->RelevantExperience->caption() ?><?php echo $staffexperience_add->RelevantExperience->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffexperience_add->RightColumnClass ?>"><div <?php echo $staffexperience_add->RelevantExperience->cellAttributes() ?>>
<span id="el_staffexperience_RelevantExperience">
<textarea data-table="staffexperience" data-field="x_RelevantExperience" name="x_RelevantExperience" id="x_RelevantExperience" cols="35" rows="4" placeholder="<?php echo HtmlEncode($staffexperience_add->RelevantExperience->getPlaceHolder()) ?>"<?php echo $staffexperience_add->RelevantExperience->editAttributes() ?>><?php echo $staffexperience_add->RelevantExperience->EditValue ?></textarea>
</span>
<?php echo $staffexperience_add->RelevantExperience->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffexperience_add->ReasonForExit->Visible) { // ReasonForExit ?>
	<div id="r_ReasonForExit" class="form-group row">
		<label id="elh_staffexperience_ReasonForExit" for="x_ReasonForExit" class="<?php echo $staffexperience_add->LeftColumnClass ?>"><?php echo $staffexperience_add->ReasonForExit->caption() ?><?php echo $staffexperience_add->ReasonForExit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffexperience_add->RightColumnClass ?>"><div <?php echo $staffexperience_add->ReasonForExit->cellAttributes() ?>>
<span id="el_staffexperience_ReasonForExit">
<?php $staffexperience_add->ReasonForExit->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_ReasonForExit" data-value-separator="<?php echo $staffexperience_add->ReasonForExit->displayValueSeparatorAttribute() ?>" id="x_ReasonForExit" name="x_ReasonForExit"<?php echo $staffexperience_add->ReasonForExit->editAttributes() ?>>
			<?php echo $staffexperience_add->ReasonForExit->selectOptionListHtml("x_ReasonForExit") ?>
		</select>
</div>
<?php echo $staffexperience_add->ReasonForExit->Lookup->getParamTag($staffexperience_add, "p_x_ReasonForExit") ?>
</span>
<?php echo $staffexperience_add->ReasonForExit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffexperience_add->RetirementType->Visible) { // RetirementType ?>
	<div id="r_RetirementType" class="form-group row">
		<label id="elh_staffexperience_RetirementType" for="x_RetirementType" class="<?php echo $staffexperience_add->LeftColumnClass ?>"><?php echo $staffexperience_add->RetirementType->caption() ?><?php echo $staffexperience_add->RetirementType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffexperience_add->RightColumnClass ?>"><div <?php echo $staffexperience_add->RetirementType->cellAttributes() ?>>
<span id="el_staffexperience_RetirementType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_RetirementType" data-value-separator="<?php echo $staffexperience_add->RetirementType->displayValueSeparatorAttribute() ?>" id="x_RetirementType" name="x_RetirementType"<?php echo $staffexperience_add->RetirementType->editAttributes() ?>>
			<?php echo $staffexperience_add->RetirementType->selectOptionListHtml("x_RetirementType") ?>
		</select>
</div>
<?php echo $staffexperience_add->RetirementType->Lookup->getParamTag($staffexperience_add, "p_x_RetirementType") ?>
</span>
<?php echo $staffexperience_add->RetirementType->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$staffexperience_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $staffexperience_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staffexperience_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$staffexperience_add->showPageFooter();
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
$staffexperience_add->terminate();
?>