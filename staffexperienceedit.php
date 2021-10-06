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
$staffexperience_edit = new staffexperience_edit();

// Run the page
$staffexperience_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffexperience_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffexperienceedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fstaffexperienceedit = currentForm = new ew.Form("fstaffexperienceedit", "edit");

	// Validate form
	fstaffexperienceedit.validate = function() {
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
			<?php if ($staffexperience_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_edit->EmployeeID->caption(), $staffexperience_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffexperience_edit->EmployeeID->errorMessage()) ?>");
			<?php if ($staffexperience_edit->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_edit->ProvinceCode->caption(), $staffexperience_edit->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffexperience_edit->LAcode->Required) { ?>
				elm = this.getElements("x" + infix + "_LAcode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_edit->LAcode->caption(), $staffexperience_edit->LAcode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffexperience_edit->PositionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_edit->PositionCode->caption(), $staffexperience_edit->PositionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffexperience_edit->FromDate->Required) { ?>
				elm = this.getElements("x" + infix + "_FromDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_edit->FromDate->caption(), $staffexperience_edit->FromDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FromDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffexperience_edit->FromDate->errorMessage()) ?>");
			<?php if ($staffexperience_edit->ExitDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ExitDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_edit->ExitDate->caption(), $staffexperience_edit->ExitDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ExitDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffexperience_edit->ExitDate->errorMessage()) ?>");
			<?php if ($staffexperience_edit->RelevantExperience->Required) { ?>
				elm = this.getElements("x" + infix + "_RelevantExperience");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_edit->RelevantExperience->caption(), $staffexperience_edit->RelevantExperience->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffexperience_edit->ReasonForExit->Required) { ?>
				elm = this.getElements("x" + infix + "_ReasonForExit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_edit->ReasonForExit->caption(), $staffexperience_edit->ReasonForExit->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffexperience_edit->RetirementType->Required) { ?>
				elm = this.getElements("x" + infix + "_RetirementType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_edit->RetirementType->caption(), $staffexperience_edit->RetirementType->RequiredErrorMessage)) ?>");
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
	fstaffexperienceedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffexperienceedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffexperienceedit.lists["x_ProvinceCode"] = <?php echo $staffexperience_edit->ProvinceCode->Lookup->toClientList($staffexperience_edit) ?>;
	fstaffexperienceedit.lists["x_ProvinceCode"].options = <?php echo JsonEncode($staffexperience_edit->ProvinceCode->lookupOptions()) ?>;
	fstaffexperienceedit.lists["x_LAcode"] = <?php echo $staffexperience_edit->LAcode->Lookup->toClientList($staffexperience_edit) ?>;
	fstaffexperienceedit.lists["x_LAcode"].options = <?php echo JsonEncode($staffexperience_edit->LAcode->lookupOptions()) ?>;
	fstaffexperienceedit.lists["x_PositionCode"] = <?php echo $staffexperience_edit->PositionCode->Lookup->toClientList($staffexperience_edit) ?>;
	fstaffexperienceedit.lists["x_PositionCode"].options = <?php echo JsonEncode($staffexperience_edit->PositionCode->lookupOptions()) ?>;
	fstaffexperienceedit.lists["x_ReasonForExit"] = <?php echo $staffexperience_edit->ReasonForExit->Lookup->toClientList($staffexperience_edit) ?>;
	fstaffexperienceedit.lists["x_ReasonForExit"].options = <?php echo JsonEncode($staffexperience_edit->ReasonForExit->lookupOptions()) ?>;
	fstaffexperienceedit.lists["x_RetirementType"] = <?php echo $staffexperience_edit->RetirementType->Lookup->toClientList($staffexperience_edit) ?>;
	fstaffexperienceedit.lists["x_RetirementType"].options = <?php echo JsonEncode($staffexperience_edit->RetirementType->lookupOptions()) ?>;
	loadjs.done("fstaffexperienceedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffexperience_edit->showPageHeader(); ?>
<?php
$staffexperience_edit->showMessage();
?>
<?php if (!$staffexperience_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffexperience_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fstaffexperienceedit" id="fstaffexperienceedit" class="<?php echo $staffexperience_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffexperience">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$staffexperience_edit->IsModal ?>">
<?php if ($staffexperience->getCurrentMasterTable() == "staff") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffexperience_edit->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($staffexperience_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_staffexperience_EmployeeID" for="x_EmployeeID" class="<?php echo $staffexperience_edit->LeftColumnClass ?>"><?php echo $staffexperience_edit->EmployeeID->caption() ?><?php echo $staffexperience_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffexperience_edit->RightColumnClass ?>"><div <?php echo $staffexperience_edit->EmployeeID->cellAttributes() ?>>
<?php if ($staffexperience_edit->EmployeeID->getSessionValue() != "") { ?>

<span id="el_staffexperience_EmployeeID">
<span<?php echo $staffexperience_edit->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffexperience_edit->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($staffexperience_edit->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="staffexperience" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($staffexperience_edit->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $staffexperience_edit->EmployeeID->EditValue ?>"<?php echo $staffexperience_edit->EmployeeID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="staffexperience" data-field="x_EmployeeID" name="o_EmployeeID" id="o_EmployeeID" value="<?php echo HtmlEncode($staffexperience_edit->EmployeeID->OldValue != null ? $staffexperience_edit->EmployeeID->OldValue : $staffexperience_edit->EmployeeID->CurrentValue) ?>">
<?php echo $staffexperience_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffexperience_edit->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_staffexperience_ProvinceCode" for="x_ProvinceCode" class="<?php echo $staffexperience_edit->LeftColumnClass ?>"><?php echo $staffexperience_edit->ProvinceCode->caption() ?><?php echo $staffexperience_edit->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffexperience_edit->RightColumnClass ?>"><div <?php echo $staffexperience_edit->ProvinceCode->cellAttributes() ?>>
<span id="el_staffexperience_ProvinceCode">
<?php $staffexperience_edit->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_ProvinceCode" data-value-separator="<?php echo $staffexperience_edit->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $staffexperience_edit->ProvinceCode->editAttributes() ?>>
			<?php echo $staffexperience_edit->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $staffexperience_edit->ProvinceCode->Lookup->getParamTag($staffexperience_edit, "p_x_ProvinceCode") ?>
</span>
<?php echo $staffexperience_edit->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffexperience_edit->LAcode->Visible) { // LAcode ?>
	<div id="r_LAcode" class="form-group row">
		<label id="elh_staffexperience_LAcode" for="x_LAcode" class="<?php echo $staffexperience_edit->LeftColumnClass ?>"><?php echo $staffexperience_edit->LAcode->caption() ?><?php echo $staffexperience_edit->LAcode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffexperience_edit->RightColumnClass ?>"><div <?php echo $staffexperience_edit->LAcode->cellAttributes() ?>>
<span id="el_staffexperience_LAcode">
<?php $staffexperience_edit->LAcode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LAcode"><?php echo EmptyValue(strval($staffexperience_edit->LAcode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffexperience_edit->LAcode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffexperience_edit->LAcode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffexperience_edit->LAcode->ReadOnly || $staffexperience_edit->LAcode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LAcode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffexperience_edit->LAcode->Lookup->getParamTag($staffexperience_edit, "p_x_LAcode") ?>
<input type="hidden" data-table="staffexperience" data-field="x_LAcode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffexperience_edit->LAcode->displayValueSeparatorAttribute() ?>" name="x_LAcode" id="x_LAcode" value="<?php echo $staffexperience_edit->LAcode->CurrentValue ?>"<?php echo $staffexperience_edit->LAcode->editAttributes() ?>>
</span>
<?php echo $staffexperience_edit->LAcode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffexperience_edit->PositionCode->Visible) { // PositionCode ?>
	<div id="r_PositionCode" class="form-group row">
		<label id="elh_staffexperience_PositionCode" for="x_PositionCode" class="<?php echo $staffexperience_edit->LeftColumnClass ?>"><?php echo $staffexperience_edit->PositionCode->caption() ?><?php echo $staffexperience_edit->PositionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffexperience_edit->RightColumnClass ?>"><div <?php echo $staffexperience_edit->PositionCode->cellAttributes() ?>>
<span id="el_staffexperience_PositionCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_PositionCode"><?php echo EmptyValue(strval($staffexperience_edit->PositionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffexperience_edit->PositionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffexperience_edit->PositionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffexperience_edit->PositionCode->ReadOnly || $staffexperience_edit->PositionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_PositionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffexperience_edit->PositionCode->Lookup->getParamTag($staffexperience_edit, "p_x_PositionCode") ?>
<input type="hidden" data-table="staffexperience" data-field="x_PositionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffexperience_edit->PositionCode->displayValueSeparatorAttribute() ?>" name="x_PositionCode" id="x_PositionCode" value="<?php echo $staffexperience_edit->PositionCode->CurrentValue ?>"<?php echo $staffexperience_edit->PositionCode->editAttributes() ?>>
</span>
<?php echo $staffexperience_edit->PositionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffexperience_edit->FromDate->Visible) { // FromDate ?>
	<div id="r_FromDate" class="form-group row">
		<label id="elh_staffexperience_FromDate" for="x_FromDate" class="<?php echo $staffexperience_edit->LeftColumnClass ?>"><?php echo $staffexperience_edit->FromDate->caption() ?><?php echo $staffexperience_edit->FromDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffexperience_edit->RightColumnClass ?>"><div <?php echo $staffexperience_edit->FromDate->cellAttributes() ?>>
<span id="el_staffexperience_FromDate">
<input type="text" data-table="staffexperience" data-field="x_FromDate" name="x_FromDate" id="x_FromDate" placeholder="<?php echo HtmlEncode($staffexperience_edit->FromDate->getPlaceHolder()) ?>" value="<?php echo $staffexperience_edit->FromDate->EditValue ?>"<?php echo $staffexperience_edit->FromDate->editAttributes() ?>>
<?php if (!$staffexperience_edit->FromDate->ReadOnly && !$staffexperience_edit->FromDate->Disabled && !isset($staffexperience_edit->FromDate->EditAttrs["readonly"]) && !isset($staffexperience_edit->FromDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffexperienceedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffexperienceedit", "x_FromDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffexperience_edit->FromDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffexperience_edit->ExitDate->Visible) { // ExitDate ?>
	<div id="r_ExitDate" class="form-group row">
		<label id="elh_staffexperience_ExitDate" for="x_ExitDate" class="<?php echo $staffexperience_edit->LeftColumnClass ?>"><?php echo $staffexperience_edit->ExitDate->caption() ?><?php echo $staffexperience_edit->ExitDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffexperience_edit->RightColumnClass ?>"><div <?php echo $staffexperience_edit->ExitDate->cellAttributes() ?>>
<span id="el_staffexperience_ExitDate">
<input type="text" data-table="staffexperience" data-field="x_ExitDate" name="x_ExitDate" id="x_ExitDate" placeholder="<?php echo HtmlEncode($staffexperience_edit->ExitDate->getPlaceHolder()) ?>" value="<?php echo $staffexperience_edit->ExitDate->EditValue ?>"<?php echo $staffexperience_edit->ExitDate->editAttributes() ?>>
<?php if (!$staffexperience_edit->ExitDate->ReadOnly && !$staffexperience_edit->ExitDate->Disabled && !isset($staffexperience_edit->ExitDate->EditAttrs["readonly"]) && !isset($staffexperience_edit->ExitDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffexperienceedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffexperienceedit", "x_ExitDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffexperience_edit->ExitDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffexperience_edit->RelevantExperience->Visible) { // RelevantExperience ?>
	<div id="r_RelevantExperience" class="form-group row">
		<label id="elh_staffexperience_RelevantExperience" for="x_RelevantExperience" class="<?php echo $staffexperience_edit->LeftColumnClass ?>"><?php echo $staffexperience_edit->RelevantExperience->caption() ?><?php echo $staffexperience_edit->RelevantExperience->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffexperience_edit->RightColumnClass ?>"><div <?php echo $staffexperience_edit->RelevantExperience->cellAttributes() ?>>
<span id="el_staffexperience_RelevantExperience">
<textarea data-table="staffexperience" data-field="x_RelevantExperience" name="x_RelevantExperience" id="x_RelevantExperience" cols="35" rows="4" placeholder="<?php echo HtmlEncode($staffexperience_edit->RelevantExperience->getPlaceHolder()) ?>"<?php echo $staffexperience_edit->RelevantExperience->editAttributes() ?>><?php echo $staffexperience_edit->RelevantExperience->EditValue ?></textarea>
</span>
<?php echo $staffexperience_edit->RelevantExperience->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffexperience_edit->ReasonForExit->Visible) { // ReasonForExit ?>
	<div id="r_ReasonForExit" class="form-group row">
		<label id="elh_staffexperience_ReasonForExit" for="x_ReasonForExit" class="<?php echo $staffexperience_edit->LeftColumnClass ?>"><?php echo $staffexperience_edit->ReasonForExit->caption() ?><?php echo $staffexperience_edit->ReasonForExit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffexperience_edit->RightColumnClass ?>"><div <?php echo $staffexperience_edit->ReasonForExit->cellAttributes() ?>>
<span id="el_staffexperience_ReasonForExit">
<?php $staffexperience_edit->ReasonForExit->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_ReasonForExit" data-value-separator="<?php echo $staffexperience_edit->ReasonForExit->displayValueSeparatorAttribute() ?>" id="x_ReasonForExit" name="x_ReasonForExit"<?php echo $staffexperience_edit->ReasonForExit->editAttributes() ?>>
			<?php echo $staffexperience_edit->ReasonForExit->selectOptionListHtml("x_ReasonForExit") ?>
		</select>
</div>
<?php echo $staffexperience_edit->ReasonForExit->Lookup->getParamTag($staffexperience_edit, "p_x_ReasonForExit") ?>
</span>
<?php echo $staffexperience_edit->ReasonForExit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffexperience_edit->RetirementType->Visible) { // RetirementType ?>
	<div id="r_RetirementType" class="form-group row">
		<label id="elh_staffexperience_RetirementType" for="x_RetirementType" class="<?php echo $staffexperience_edit->LeftColumnClass ?>"><?php echo $staffexperience_edit->RetirementType->caption() ?><?php echo $staffexperience_edit->RetirementType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffexperience_edit->RightColumnClass ?>"><div <?php echo $staffexperience_edit->RetirementType->cellAttributes() ?>>
<span id="el_staffexperience_RetirementType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_RetirementType" data-value-separator="<?php echo $staffexperience_edit->RetirementType->displayValueSeparatorAttribute() ?>" id="x_RetirementType" name="x_RetirementType"<?php echo $staffexperience_edit->RetirementType->editAttributes() ?>>
			<?php echo $staffexperience_edit->RetirementType->selectOptionListHtml("x_RetirementType") ?>
		</select>
</div>
<?php echo $staffexperience_edit->RetirementType->Lookup->getParamTag($staffexperience_edit, "p_x_RetirementType") ?>
</span>
<?php echo $staffexperience_edit->RetirementType->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="staffexperience" data-field="x_IndexNo" name="x_IndexNo" id="x_IndexNo" value="<?php echo HtmlEncode($staffexperience_edit->IndexNo->CurrentValue) ?>">
<?php if (!$staffexperience_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $staffexperience_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staffexperience_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$staffexperience_edit->IsModal) { ?>
<?php echo $staffexperience_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$staffexperience_edit->showPageFooter();
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
$staffexperience_edit->terminate();
?>