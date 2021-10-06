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
$position_ref_add = new position_ref_add();

// Run the page
$position_ref_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$position_ref_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fposition_refadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fposition_refadd = currentForm = new ew.Form("fposition_refadd", "add");

	// Validate form
	fposition_refadd.validate = function() {
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
			<?php if ($position_ref_add->PositionName->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_add->PositionName->caption(), $position_ref_add->PositionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_add->RequisiteQualification->Required) { ?>
				elm = this.getElements("x" + infix + "_RequisiteQualification");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_add->RequisiteQualification->caption(), $position_ref_add->RequisiteQualification->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_add->JobCode->Required) { ?>
				elm = this.getElements("x" + infix + "_JobCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_add->JobCode->caption(), $position_ref_add->JobCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_JobCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($position_ref_add->JobCode->errorMessage()) ?>");
			<?php if ($position_ref_add->SalaryScale->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryScale");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_add->SalaryScale->caption(), $position_ref_add->SalaryScale->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_add->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_add->ProvinceCode->caption(), $position_ref_add->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_add->LACode->caption(), $position_ref_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_add->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_add->DepartmentCode->caption(), $position_ref_add->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_add->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_add->SectionCode->caption(), $position_ref_add->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_add->FieldQualified->Required) { ?>
				elm = this.getElements("x" + infix + "_FieldQualified");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_add->FieldQualified->caption(), $position_ref_add->FieldQualified->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FieldQualified");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($position_ref_add->FieldQualified->errorMessage()) ?>");

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
	fposition_refadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fposition_refadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fposition_refadd.lists["x_RequisiteQualification"] = <?php echo $position_ref_add->RequisiteQualification->Lookup->toClientList($position_ref_add) ?>;
	fposition_refadd.lists["x_RequisiteQualification"].options = <?php echo JsonEncode($position_ref_add->RequisiteQualification->lookupOptions()) ?>;
	fposition_refadd.lists["x_JobCode"] = <?php echo $position_ref_add->JobCode->Lookup->toClientList($position_ref_add) ?>;
	fposition_refadd.lists["x_JobCode"].options = <?php echo JsonEncode($position_ref_add->JobCode->lookupOptions()) ?>;
	fposition_refadd.autoSuggests["x_JobCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fposition_refadd.lists["x_SalaryScale"] = <?php echo $position_ref_add->SalaryScale->Lookup->toClientList($position_ref_add) ?>;
	fposition_refadd.lists["x_SalaryScale"].options = <?php echo JsonEncode($position_ref_add->SalaryScale->lookupOptions()) ?>;
	fposition_refadd.lists["x_ProvinceCode"] = <?php echo $position_ref_add->ProvinceCode->Lookup->toClientList($position_ref_add) ?>;
	fposition_refadd.lists["x_ProvinceCode"].options = <?php echo JsonEncode($position_ref_add->ProvinceCode->lookupOptions()) ?>;
	fposition_refadd.lists["x_LACode"] = <?php echo $position_ref_add->LACode->Lookup->toClientList($position_ref_add) ?>;
	fposition_refadd.lists["x_LACode"].options = <?php echo JsonEncode($position_ref_add->LACode->lookupOptions()) ?>;
	fposition_refadd.lists["x_DepartmentCode"] = <?php echo $position_ref_add->DepartmentCode->Lookup->toClientList($position_ref_add) ?>;
	fposition_refadd.lists["x_DepartmentCode"].options = <?php echo JsonEncode($position_ref_add->DepartmentCode->lookupOptions()) ?>;
	fposition_refadd.lists["x_SectionCode"] = <?php echo $position_ref_add->SectionCode->Lookup->toClientList($position_ref_add) ?>;
	fposition_refadd.lists["x_SectionCode"].options = <?php echo JsonEncode($position_ref_add->SectionCode->lookupOptions()) ?>;
	loadjs.done("fposition_refadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $position_ref_add->showPageHeader(); ?>
<?php
$position_ref_add->showMessage();
?>
<form name="fposition_refadd" id="fposition_refadd" class="<?php echo $position_ref_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="position_ref">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$position_ref_add->IsModal ?>">
<?php if ($position_ref->getCurrentMasterTable() == "dept_section") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="dept_section">
<input type="hidden" name="fk_SectionCode" value="<?php echo HtmlEncode($position_ref_add->SectionCode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($position_ref_add->PositionName->Visible) { // PositionName ?>
	<div id="r_PositionName" class="form-group row">
		<label id="elh_position_ref_PositionName" for="x_PositionName" class="<?php echo $position_ref_add->LeftColumnClass ?>"><?php echo $position_ref_add->PositionName->caption() ?><?php echo $position_ref_add->PositionName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $position_ref_add->RightColumnClass ?>"><div <?php echo $position_ref_add->PositionName->cellAttributes() ?>>
<span id="el_position_ref_PositionName">
<input type="text" data-table="position_ref" data-field="x_PositionName" name="x_PositionName" id="x_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($position_ref_add->PositionName->getPlaceHolder()) ?>" value="<?php echo $position_ref_add->PositionName->EditValue ?>"<?php echo $position_ref_add->PositionName->editAttributes() ?>>
</span>
<?php echo $position_ref_add->PositionName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($position_ref_add->RequisiteQualification->Visible) { // RequisiteQualification ?>
	<div id="r_RequisiteQualification" class="form-group row">
		<label id="elh_position_ref_RequisiteQualification" for="x_RequisiteQualification" class="<?php echo $position_ref_add->LeftColumnClass ?>"><?php echo $position_ref_add->RequisiteQualification->caption() ?><?php echo $position_ref_add->RequisiteQualification->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $position_ref_add->RightColumnClass ?>"><div <?php echo $position_ref_add->RequisiteQualification->cellAttributes() ?>>
<span id="el_position_ref_RequisiteQualification">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_RequisiteQualification" data-value-separator="<?php echo $position_ref_add->RequisiteQualification->displayValueSeparatorAttribute() ?>" id="x_RequisiteQualification" name="x_RequisiteQualification"<?php echo $position_ref_add->RequisiteQualification->editAttributes() ?>>
			<?php echo $position_ref_add->RequisiteQualification->selectOptionListHtml("x_RequisiteQualification") ?>
		</select>
</div>
<?php echo $position_ref_add->RequisiteQualification->Lookup->getParamTag($position_ref_add, "p_x_RequisiteQualification") ?>
</span>
<?php echo $position_ref_add->RequisiteQualification->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($position_ref_add->JobCode->Visible) { // JobCode ?>
	<div id="r_JobCode" class="form-group row">
		<label id="elh_position_ref_JobCode" class="<?php echo $position_ref_add->LeftColumnClass ?>"><?php echo $position_ref_add->JobCode->caption() ?><?php echo $position_ref_add->JobCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $position_ref_add->RightColumnClass ?>"><div <?php echo $position_ref_add->JobCode->cellAttributes() ?>>
<span id="el_position_ref_JobCode">
<?php
$onchange = $position_ref_add->JobCode->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$position_ref_add->JobCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_JobCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_JobCode" id="sv_x_JobCode" value="<?php echo RemoveHtml($position_ref_add->JobCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($position_ref_add->JobCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($position_ref_add->JobCode->getPlaceHolder()) ?>"<?php echo $position_ref_add->JobCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($position_ref_add->JobCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_JobCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($position_ref_add->JobCode->ReadOnly || $position_ref_add->JobCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="position_ref" data-field="x_JobCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $position_ref_add->JobCode->displayValueSeparatorAttribute() ?>" name="x_JobCode" id="x_JobCode" value="<?php echo HtmlEncode($position_ref_add->JobCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fposition_refadd"], function() {
	fposition_refadd.createAutoSuggest({"id":"x_JobCode","forceSelect":true});
});
</script>
<?php echo $position_ref_add->JobCode->Lookup->getParamTag($position_ref_add, "p_x_JobCode") ?>
</span>
<?php echo $position_ref_add->JobCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($position_ref_add->SalaryScale->Visible) { // SalaryScale ?>
	<div id="r_SalaryScale" class="form-group row">
		<label id="elh_position_ref_SalaryScale" for="x_SalaryScale" class="<?php echo $position_ref_add->LeftColumnClass ?>"><?php echo $position_ref_add->SalaryScale->caption() ?><?php echo $position_ref_add->SalaryScale->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $position_ref_add->RightColumnClass ?>"><div <?php echo $position_ref_add->SalaryScale->cellAttributes() ?>>
<span id="el_position_ref_SalaryScale">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_SalaryScale" data-value-separator="<?php echo $position_ref_add->SalaryScale->displayValueSeparatorAttribute() ?>" id="x_SalaryScale" name="x_SalaryScale"<?php echo $position_ref_add->SalaryScale->editAttributes() ?>>
			<?php echo $position_ref_add->SalaryScale->selectOptionListHtml("x_SalaryScale") ?>
		</select>
</div>
<?php echo $position_ref_add->SalaryScale->Lookup->getParamTag($position_ref_add, "p_x_SalaryScale") ?>
</span>
<?php echo $position_ref_add->SalaryScale->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($position_ref_add->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_position_ref_ProvinceCode" for="x_ProvinceCode" class="<?php echo $position_ref_add->LeftColumnClass ?>"><?php echo $position_ref_add->ProvinceCode->caption() ?><?php echo $position_ref_add->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $position_ref_add->RightColumnClass ?>"><div <?php echo $position_ref_add->ProvinceCode->cellAttributes() ?>>
<span id="el_position_ref_ProvinceCode">
<?php $position_ref_add->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_ProvinceCode" data-value-separator="<?php echo $position_ref_add->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $position_ref_add->ProvinceCode->editAttributes() ?>>
			<?php echo $position_ref_add->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $position_ref_add->ProvinceCode->Lookup->getParamTag($position_ref_add, "p_x_ProvinceCode") ?>
</span>
<?php echo $position_ref_add->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($position_ref_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_position_ref_LACode" for="x_LACode" class="<?php echo $position_ref_add->LeftColumnClass ?>"><?php echo $position_ref_add->LACode->caption() ?><?php echo $position_ref_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $position_ref_add->RightColumnClass ?>"><div <?php echo $position_ref_add->LACode->cellAttributes() ?>>
<span id="el_position_ref_LACode">
<?php $position_ref_add->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_LACode" data-value-separator="<?php echo $position_ref_add->LACode->displayValueSeparatorAttribute() ?>" id="x_LACode" name="x_LACode"<?php echo $position_ref_add->LACode->editAttributes() ?>>
			<?php echo $position_ref_add->LACode->selectOptionListHtml("x_LACode") ?>
		</select>
</div>
<?php echo $position_ref_add->LACode->Lookup->getParamTag($position_ref_add, "p_x_LACode") ?>
</span>
<?php echo $position_ref_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($position_ref_add->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_position_ref_DepartmentCode" for="x_DepartmentCode" class="<?php echo $position_ref_add->LeftColumnClass ?>"><?php echo $position_ref_add->DepartmentCode->caption() ?><?php echo $position_ref_add->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $position_ref_add->RightColumnClass ?>"><div <?php echo $position_ref_add->DepartmentCode->cellAttributes() ?>>
<span id="el_position_ref_DepartmentCode">
<?php $position_ref_add->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_DepartmentCode" data-value-separator="<?php echo $position_ref_add->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $position_ref_add->DepartmentCode->editAttributes() ?>>
			<?php echo $position_ref_add->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $position_ref_add->DepartmentCode->Lookup->getParamTag($position_ref_add, "p_x_DepartmentCode") ?>
</span>
<?php echo $position_ref_add->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($position_ref_add->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_position_ref_SectionCode" for="x_SectionCode" class="<?php echo $position_ref_add->LeftColumnClass ?>"><?php echo $position_ref_add->SectionCode->caption() ?><?php echo $position_ref_add->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $position_ref_add->RightColumnClass ?>"><div <?php echo $position_ref_add->SectionCode->cellAttributes() ?>>
<?php if ($position_ref_add->SectionCode->getSessionValue() != "") { ?>
<span id="el_position_ref_SectionCode">
<span<?php echo $position_ref_add->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($position_ref_add->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_SectionCode" name="x_SectionCode" value="<?php echo HtmlEncode($position_ref_add->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_position_ref_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_SectionCode" data-value-separator="<?php echo $position_ref_add->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $position_ref_add->SectionCode->editAttributes() ?>>
			<?php echo $position_ref_add->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $position_ref_add->SectionCode->Lookup->getParamTag($position_ref_add, "p_x_SectionCode") ?>
</span>
<?php } ?>
<?php echo $position_ref_add->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($position_ref_add->FieldQualified->Visible) { // FieldQualified ?>
	<div id="r_FieldQualified" class="form-group row">
		<label id="elh_position_ref_FieldQualified" for="x_FieldQualified" class="<?php echo $position_ref_add->LeftColumnClass ?>"><?php echo $position_ref_add->FieldQualified->caption() ?><?php echo $position_ref_add->FieldQualified->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $position_ref_add->RightColumnClass ?>"><div <?php echo $position_ref_add->FieldQualified->cellAttributes() ?>>
<span id="el_position_ref_FieldQualified">
<input type="text" data-table="position_ref" data-field="x_FieldQualified" name="x_FieldQualified" id="x_FieldQualified" size="30" placeholder="<?php echo HtmlEncode($position_ref_add->FieldQualified->getPlaceHolder()) ?>" value="<?php echo $position_ref_add->FieldQualified->EditValue ?>"<?php echo $position_ref_add->FieldQualified->editAttributes() ?>>
</span>
<?php echo $position_ref_add->FieldQualified->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("employment", explode(",", $position_ref->getCurrentDetailTable())) && $employment->DetailAdd) {
?>
<?php if ($position_ref->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("employment", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "employmentgrid.php" ?>
<?php } ?>
<?php if (!$position_ref_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $position_ref_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $position_ref_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$position_ref_add->showPageFooter();
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
$position_ref_add->terminate();
?>