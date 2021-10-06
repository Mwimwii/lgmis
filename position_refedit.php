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
$position_ref_edit = new position_ref_edit();

// Run the page
$position_ref_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$position_ref_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fposition_refedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fposition_refedit = currentForm = new ew.Form("fposition_refedit", "edit");

	// Validate form
	fposition_refedit.validate = function() {
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
			<?php if ($position_ref_edit->PositionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_edit->PositionCode->caption(), $position_ref_edit->PositionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_edit->PositionName->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_edit->PositionName->caption(), $position_ref_edit->PositionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_edit->RequisiteQualification->Required) { ?>
				elm = this.getElements("x" + infix + "_RequisiteQualification");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_edit->RequisiteQualification->caption(), $position_ref_edit->RequisiteQualification->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_edit->JobCode->Required) { ?>
				elm = this.getElements("x" + infix + "_JobCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_edit->JobCode->caption(), $position_ref_edit->JobCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_JobCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($position_ref_edit->JobCode->errorMessage()) ?>");
			<?php if ($position_ref_edit->SalaryScale->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryScale");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_edit->SalaryScale->caption(), $position_ref_edit->SalaryScale->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_edit->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_edit->ProvinceCode->caption(), $position_ref_edit->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_edit->LACode->caption(), $position_ref_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_edit->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_edit->DepartmentCode->caption(), $position_ref_edit->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_edit->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_edit->SectionCode->caption(), $position_ref_edit->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_edit->FieldQualified->Required) { ?>
				elm = this.getElements("x" + infix + "_FieldQualified");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_edit->FieldQualified->caption(), $position_ref_edit->FieldQualified->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FieldQualified");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($position_ref_edit->FieldQualified->errorMessage()) ?>");

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
	fposition_refedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fposition_refedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fposition_refedit.lists["x_RequisiteQualification"] = <?php echo $position_ref_edit->RequisiteQualification->Lookup->toClientList($position_ref_edit) ?>;
	fposition_refedit.lists["x_RequisiteQualification"].options = <?php echo JsonEncode($position_ref_edit->RequisiteQualification->lookupOptions()) ?>;
	fposition_refedit.lists["x_JobCode"] = <?php echo $position_ref_edit->JobCode->Lookup->toClientList($position_ref_edit) ?>;
	fposition_refedit.lists["x_JobCode"].options = <?php echo JsonEncode($position_ref_edit->JobCode->lookupOptions()) ?>;
	fposition_refedit.autoSuggests["x_JobCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fposition_refedit.lists["x_SalaryScale"] = <?php echo $position_ref_edit->SalaryScale->Lookup->toClientList($position_ref_edit) ?>;
	fposition_refedit.lists["x_SalaryScale"].options = <?php echo JsonEncode($position_ref_edit->SalaryScale->lookupOptions()) ?>;
	fposition_refedit.lists["x_ProvinceCode"] = <?php echo $position_ref_edit->ProvinceCode->Lookup->toClientList($position_ref_edit) ?>;
	fposition_refedit.lists["x_ProvinceCode"].options = <?php echo JsonEncode($position_ref_edit->ProvinceCode->lookupOptions()) ?>;
	fposition_refedit.lists["x_LACode"] = <?php echo $position_ref_edit->LACode->Lookup->toClientList($position_ref_edit) ?>;
	fposition_refedit.lists["x_LACode"].options = <?php echo JsonEncode($position_ref_edit->LACode->lookupOptions()) ?>;
	fposition_refedit.lists["x_DepartmentCode"] = <?php echo $position_ref_edit->DepartmentCode->Lookup->toClientList($position_ref_edit) ?>;
	fposition_refedit.lists["x_DepartmentCode"].options = <?php echo JsonEncode($position_ref_edit->DepartmentCode->lookupOptions()) ?>;
	fposition_refedit.lists["x_SectionCode"] = <?php echo $position_ref_edit->SectionCode->Lookup->toClientList($position_ref_edit) ?>;
	fposition_refedit.lists["x_SectionCode"].options = <?php echo JsonEncode($position_ref_edit->SectionCode->lookupOptions()) ?>;
	loadjs.done("fposition_refedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $position_ref_edit->showPageHeader(); ?>
<?php
$position_ref_edit->showMessage();
?>
<?php if (!$position_ref_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $position_ref_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fposition_refedit" id="fposition_refedit" class="<?php echo $position_ref_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="position_ref">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$position_ref_edit->IsModal ?>">
<?php if ($position_ref->getCurrentMasterTable() == "dept_section") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="dept_section">
<input type="hidden" name="fk_SectionCode" value="<?php echo HtmlEncode($position_ref_edit->SectionCode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($position_ref_edit->PositionCode->Visible) { // PositionCode ?>
	<div id="r_PositionCode" class="form-group row">
		<label id="elh_position_ref_PositionCode" class="<?php echo $position_ref_edit->LeftColumnClass ?>"><?php echo $position_ref_edit->PositionCode->caption() ?><?php echo $position_ref_edit->PositionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $position_ref_edit->RightColumnClass ?>"><div <?php echo $position_ref_edit->PositionCode->cellAttributes() ?>>
<span id="el_position_ref_PositionCode">
<span<?php echo $position_ref_edit->PositionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($position_ref_edit->PositionCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="position_ref" data-field="x_PositionCode" name="x_PositionCode" id="x_PositionCode" value="<?php echo HtmlEncode($position_ref_edit->PositionCode->CurrentValue) ?>">
<?php echo $position_ref_edit->PositionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($position_ref_edit->PositionName->Visible) { // PositionName ?>
	<div id="r_PositionName" class="form-group row">
		<label id="elh_position_ref_PositionName" for="x_PositionName" class="<?php echo $position_ref_edit->LeftColumnClass ?>"><?php echo $position_ref_edit->PositionName->caption() ?><?php echo $position_ref_edit->PositionName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $position_ref_edit->RightColumnClass ?>"><div <?php echo $position_ref_edit->PositionName->cellAttributes() ?>>
<span id="el_position_ref_PositionName">
<input type="text" data-table="position_ref" data-field="x_PositionName" name="x_PositionName" id="x_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($position_ref_edit->PositionName->getPlaceHolder()) ?>" value="<?php echo $position_ref_edit->PositionName->EditValue ?>"<?php echo $position_ref_edit->PositionName->editAttributes() ?>>
</span>
<?php echo $position_ref_edit->PositionName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($position_ref_edit->RequisiteQualification->Visible) { // RequisiteQualification ?>
	<div id="r_RequisiteQualification" class="form-group row">
		<label id="elh_position_ref_RequisiteQualification" for="x_RequisiteQualification" class="<?php echo $position_ref_edit->LeftColumnClass ?>"><?php echo $position_ref_edit->RequisiteQualification->caption() ?><?php echo $position_ref_edit->RequisiteQualification->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $position_ref_edit->RightColumnClass ?>"><div <?php echo $position_ref_edit->RequisiteQualification->cellAttributes() ?>>
<span id="el_position_ref_RequisiteQualification">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_RequisiteQualification" data-value-separator="<?php echo $position_ref_edit->RequisiteQualification->displayValueSeparatorAttribute() ?>" id="x_RequisiteQualification" name="x_RequisiteQualification"<?php echo $position_ref_edit->RequisiteQualification->editAttributes() ?>>
			<?php echo $position_ref_edit->RequisiteQualification->selectOptionListHtml("x_RequisiteQualification") ?>
		</select>
</div>
<?php echo $position_ref_edit->RequisiteQualification->Lookup->getParamTag($position_ref_edit, "p_x_RequisiteQualification") ?>
</span>
<?php echo $position_ref_edit->RequisiteQualification->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($position_ref_edit->JobCode->Visible) { // JobCode ?>
	<div id="r_JobCode" class="form-group row">
		<label id="elh_position_ref_JobCode" class="<?php echo $position_ref_edit->LeftColumnClass ?>"><?php echo $position_ref_edit->JobCode->caption() ?><?php echo $position_ref_edit->JobCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $position_ref_edit->RightColumnClass ?>"><div <?php echo $position_ref_edit->JobCode->cellAttributes() ?>>
<span id="el_position_ref_JobCode">
<?php
$onchange = $position_ref_edit->JobCode->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$position_ref_edit->JobCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_JobCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_JobCode" id="sv_x_JobCode" value="<?php echo RemoveHtml($position_ref_edit->JobCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($position_ref_edit->JobCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($position_ref_edit->JobCode->getPlaceHolder()) ?>"<?php echo $position_ref_edit->JobCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($position_ref_edit->JobCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_JobCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($position_ref_edit->JobCode->ReadOnly || $position_ref_edit->JobCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="position_ref" data-field="x_JobCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $position_ref_edit->JobCode->displayValueSeparatorAttribute() ?>" name="x_JobCode" id="x_JobCode" value="<?php echo HtmlEncode($position_ref_edit->JobCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fposition_refedit"], function() {
	fposition_refedit.createAutoSuggest({"id":"x_JobCode","forceSelect":true});
});
</script>
<?php echo $position_ref_edit->JobCode->Lookup->getParamTag($position_ref_edit, "p_x_JobCode") ?>
</span>
<?php echo $position_ref_edit->JobCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($position_ref_edit->SalaryScale->Visible) { // SalaryScale ?>
	<div id="r_SalaryScale" class="form-group row">
		<label id="elh_position_ref_SalaryScale" for="x_SalaryScale" class="<?php echo $position_ref_edit->LeftColumnClass ?>"><?php echo $position_ref_edit->SalaryScale->caption() ?><?php echo $position_ref_edit->SalaryScale->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $position_ref_edit->RightColumnClass ?>"><div <?php echo $position_ref_edit->SalaryScale->cellAttributes() ?>>
<span id="el_position_ref_SalaryScale">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_SalaryScale" data-value-separator="<?php echo $position_ref_edit->SalaryScale->displayValueSeparatorAttribute() ?>" id="x_SalaryScale" name="x_SalaryScale"<?php echo $position_ref_edit->SalaryScale->editAttributes() ?>>
			<?php echo $position_ref_edit->SalaryScale->selectOptionListHtml("x_SalaryScale") ?>
		</select>
</div>
<?php echo $position_ref_edit->SalaryScale->Lookup->getParamTag($position_ref_edit, "p_x_SalaryScale") ?>
</span>
<?php echo $position_ref_edit->SalaryScale->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($position_ref_edit->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_position_ref_ProvinceCode" for="x_ProvinceCode" class="<?php echo $position_ref_edit->LeftColumnClass ?>"><?php echo $position_ref_edit->ProvinceCode->caption() ?><?php echo $position_ref_edit->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $position_ref_edit->RightColumnClass ?>"><div <?php echo $position_ref_edit->ProvinceCode->cellAttributes() ?>>
<span id="el_position_ref_ProvinceCode">
<?php $position_ref_edit->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_ProvinceCode" data-value-separator="<?php echo $position_ref_edit->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $position_ref_edit->ProvinceCode->editAttributes() ?>>
			<?php echo $position_ref_edit->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $position_ref_edit->ProvinceCode->Lookup->getParamTag($position_ref_edit, "p_x_ProvinceCode") ?>
</span>
<?php echo $position_ref_edit->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($position_ref_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_position_ref_LACode" for="x_LACode" class="<?php echo $position_ref_edit->LeftColumnClass ?>"><?php echo $position_ref_edit->LACode->caption() ?><?php echo $position_ref_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $position_ref_edit->RightColumnClass ?>"><div <?php echo $position_ref_edit->LACode->cellAttributes() ?>>
<span id="el_position_ref_LACode">
<?php $position_ref_edit->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_LACode" data-value-separator="<?php echo $position_ref_edit->LACode->displayValueSeparatorAttribute() ?>" id="x_LACode" name="x_LACode"<?php echo $position_ref_edit->LACode->editAttributes() ?>>
			<?php echo $position_ref_edit->LACode->selectOptionListHtml("x_LACode") ?>
		</select>
</div>
<?php echo $position_ref_edit->LACode->Lookup->getParamTag($position_ref_edit, "p_x_LACode") ?>
</span>
<?php echo $position_ref_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($position_ref_edit->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_position_ref_DepartmentCode" for="x_DepartmentCode" class="<?php echo $position_ref_edit->LeftColumnClass ?>"><?php echo $position_ref_edit->DepartmentCode->caption() ?><?php echo $position_ref_edit->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $position_ref_edit->RightColumnClass ?>"><div <?php echo $position_ref_edit->DepartmentCode->cellAttributes() ?>>
<span id="el_position_ref_DepartmentCode">
<?php $position_ref_edit->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_DepartmentCode" data-value-separator="<?php echo $position_ref_edit->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $position_ref_edit->DepartmentCode->editAttributes() ?>>
			<?php echo $position_ref_edit->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $position_ref_edit->DepartmentCode->Lookup->getParamTag($position_ref_edit, "p_x_DepartmentCode") ?>
</span>
<?php echo $position_ref_edit->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($position_ref_edit->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_position_ref_SectionCode" for="x_SectionCode" class="<?php echo $position_ref_edit->LeftColumnClass ?>"><?php echo $position_ref_edit->SectionCode->caption() ?><?php echo $position_ref_edit->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $position_ref_edit->RightColumnClass ?>"><div <?php echo $position_ref_edit->SectionCode->cellAttributes() ?>>
<?php if ($position_ref_edit->SectionCode->getSessionValue() != "") { ?>
<span id="el_position_ref_SectionCode">
<span<?php echo $position_ref_edit->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($position_ref_edit->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_SectionCode" name="x_SectionCode" value="<?php echo HtmlEncode($position_ref_edit->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_position_ref_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_SectionCode" data-value-separator="<?php echo $position_ref_edit->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $position_ref_edit->SectionCode->editAttributes() ?>>
			<?php echo $position_ref_edit->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $position_ref_edit->SectionCode->Lookup->getParamTag($position_ref_edit, "p_x_SectionCode") ?>
</span>
<?php } ?>
<?php echo $position_ref_edit->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($position_ref_edit->FieldQualified->Visible) { // FieldQualified ?>
	<div id="r_FieldQualified" class="form-group row">
		<label id="elh_position_ref_FieldQualified" for="x_FieldQualified" class="<?php echo $position_ref_edit->LeftColumnClass ?>"><?php echo $position_ref_edit->FieldQualified->caption() ?><?php echo $position_ref_edit->FieldQualified->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $position_ref_edit->RightColumnClass ?>"><div <?php echo $position_ref_edit->FieldQualified->cellAttributes() ?>>
<span id="el_position_ref_FieldQualified">
<input type="text" data-table="position_ref" data-field="x_FieldQualified" name="x_FieldQualified" id="x_FieldQualified" size="30" placeholder="<?php echo HtmlEncode($position_ref_edit->FieldQualified->getPlaceHolder()) ?>" value="<?php echo $position_ref_edit->FieldQualified->EditValue ?>"<?php echo $position_ref_edit->FieldQualified->editAttributes() ?>>
</span>
<?php echo $position_ref_edit->FieldQualified->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("employment", explode(",", $position_ref->getCurrentDetailTable())) && $employment->DetailEdit) {
?>
<?php if ($position_ref->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("employment", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "employmentgrid.php" ?>
<?php } ?>
<?php if (!$position_ref_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $position_ref_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $position_ref_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$position_ref_edit->IsModal) { ?>
<?php echo $position_ref_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$position_ref_edit->showPageFooter();
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
$position_ref_edit->terminate();
?>