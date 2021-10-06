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
$security_matrix_edit = new security_matrix_edit();

// Run the page
$security_matrix_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$security_matrix_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsecurity_matrixedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fsecurity_matrixedit = currentForm = new ew.Form("fsecurity_matrixedit", "edit");

	// Validate form
	fsecurity_matrixedit.validate = function() {
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
			<?php if ($security_matrix_edit->UserCode->Required) { ?>
				elm = this.getElements("x" + infix + "_UserCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_edit->UserCode->caption(), $security_matrix_edit->UserCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_UserCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($security_matrix_edit->UserCode->errorMessage()) ?>");
			<?php if ($security_matrix_edit->PeriodCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_edit->PeriodCode->caption(), $security_matrix_edit->PeriodCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PeriodCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($security_matrix_edit->PeriodCode->errorMessage()) ?>");
			<?php if ($security_matrix_edit->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_edit->ProvinceCode->caption(), $security_matrix_edit->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($security_matrix_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_edit->LACode->caption(), $security_matrix_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($security_matrix_edit->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_edit->DepartmentCode->caption(), $security_matrix_edit->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($security_matrix_edit->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_edit->SectionCode->caption(), $security_matrix_edit->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($security_matrix_edit->SecurityNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_SecurityNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_edit->SecurityNumber->caption(), $security_matrix_edit->SecurityNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($security_matrix_edit->ValidFrom->Required) { ?>
				elm = this.getElements("x" + infix + "_ValidFrom");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_edit->ValidFrom->caption(), $security_matrix_edit->ValidFrom->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ValidFrom");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($security_matrix_edit->ValidFrom->errorMessage()) ?>");
			<?php if ($security_matrix_edit->ValidTo->Required) { ?>
				elm = this.getElements("x" + infix + "_ValidTo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_edit->ValidTo->caption(), $security_matrix_edit->ValidTo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ValidTo");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($security_matrix_edit->ValidTo->errorMessage()) ?>");
			<?php if ($security_matrix_edit->ApproveLevel->Required) { ?>
				elm = this.getElements("x" + infix + "_ApproveLevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_edit->ApproveLevel->caption(), $security_matrix_edit->ApproveLevel->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ApproveLevel");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($security_matrix_edit->ApproveLevel->errorMessage()) ?>");
			<?php if ($security_matrix_edit->ActivityCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ActivityCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_edit->ActivityCode->caption(), $security_matrix_edit->ActivityCode->RequiredErrorMessage)) ?>");
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
	fsecurity_matrixedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsecurity_matrixedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fsecurity_matrixedit.lists["x_ProvinceCode"] = <?php echo $security_matrix_edit->ProvinceCode->Lookup->toClientList($security_matrix_edit) ?>;
	fsecurity_matrixedit.lists["x_ProvinceCode"].options = <?php echo JsonEncode($security_matrix_edit->ProvinceCode->lookupOptions()) ?>;
	fsecurity_matrixedit.lists["x_LACode"] = <?php echo $security_matrix_edit->LACode->Lookup->toClientList($security_matrix_edit) ?>;
	fsecurity_matrixedit.lists["x_LACode"].options = <?php echo JsonEncode($security_matrix_edit->LACode->lookupOptions()) ?>;
	fsecurity_matrixedit.lists["x_DepartmentCode"] = <?php echo $security_matrix_edit->DepartmentCode->Lookup->toClientList($security_matrix_edit) ?>;
	fsecurity_matrixedit.lists["x_DepartmentCode"].options = <?php echo JsonEncode($security_matrix_edit->DepartmentCode->lookupOptions()) ?>;
	fsecurity_matrixedit.lists["x_SectionCode"] = <?php echo $security_matrix_edit->SectionCode->Lookup->toClientList($security_matrix_edit) ?>;
	fsecurity_matrixedit.lists["x_SectionCode"].options = <?php echo JsonEncode($security_matrix_edit->SectionCode->lookupOptions()) ?>;
	loadjs.done("fsecurity_matrixedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $security_matrix_edit->showPageHeader(); ?>
<?php
$security_matrix_edit->showMessage();
?>
<?php if (!$security_matrix_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $security_matrix_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fsecurity_matrixedit" id="fsecurity_matrixedit" class="<?php echo $security_matrix_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="security_matrix">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$security_matrix_edit->IsModal ?>">
<?php if ($security_matrix->getCurrentMasterTable() == "musers") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="musers">
<input type="hidden" name="fk_UserCode" value="<?php echo HtmlEncode($security_matrix_edit->UserCode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($security_matrix_edit->UserCode->Visible) { // UserCode ?>
	<div id="r_UserCode" class="form-group row">
		<label id="elh_security_matrix_UserCode" for="x_UserCode" class="<?php echo $security_matrix_edit->LeftColumnClass ?>"><?php echo $security_matrix_edit->UserCode->caption() ?><?php echo $security_matrix_edit->UserCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $security_matrix_edit->RightColumnClass ?>"><div <?php echo $security_matrix_edit->UserCode->cellAttributes() ?>>
<?php if ($security_matrix_edit->UserCode->getSessionValue() != "") { ?>
<span id="el_security_matrix_UserCode">
<span<?php echo $security_matrix_edit->UserCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($security_matrix_edit->UserCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_UserCode" name="x_UserCode" value="<?php echo HtmlEncode($security_matrix_edit->UserCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_security_matrix_UserCode">
<input type="text" data-table="security_matrix" data-field="x_UserCode" name="x_UserCode" id="x_UserCode" size="30" placeholder="<?php echo HtmlEncode($security_matrix_edit->UserCode->getPlaceHolder()) ?>" value="<?php echo $security_matrix_edit->UserCode->EditValue ?>"<?php echo $security_matrix_edit->UserCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $security_matrix_edit->UserCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($security_matrix_edit->PeriodCode->Visible) { // PeriodCode ?>
	<div id="r_PeriodCode" class="form-group row">
		<label id="elh_security_matrix_PeriodCode" for="x_PeriodCode" class="<?php echo $security_matrix_edit->LeftColumnClass ?>"><?php echo $security_matrix_edit->PeriodCode->caption() ?><?php echo $security_matrix_edit->PeriodCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $security_matrix_edit->RightColumnClass ?>"><div <?php echo $security_matrix_edit->PeriodCode->cellAttributes() ?>>
<span id="el_security_matrix_PeriodCode">
<input type="text" data-table="security_matrix" data-field="x_PeriodCode" name="x_PeriodCode" id="x_PeriodCode" size="30" placeholder="<?php echo HtmlEncode($security_matrix_edit->PeriodCode->getPlaceHolder()) ?>" value="<?php echo $security_matrix_edit->PeriodCode->EditValue ?>"<?php echo $security_matrix_edit->PeriodCode->editAttributes() ?>>
</span>
<?php echo $security_matrix_edit->PeriodCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($security_matrix_edit->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_security_matrix_ProvinceCode" for="x_ProvinceCode" class="<?php echo $security_matrix_edit->LeftColumnClass ?>"><?php echo $security_matrix_edit->ProvinceCode->caption() ?><?php echo $security_matrix_edit->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $security_matrix_edit->RightColumnClass ?>"><div <?php echo $security_matrix_edit->ProvinceCode->cellAttributes() ?>>
<span id="el_security_matrix_ProvinceCode">
<?php $security_matrix_edit->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="security_matrix" data-field="x_ProvinceCode" data-value-separator="<?php echo $security_matrix_edit->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $security_matrix_edit->ProvinceCode->editAttributes() ?>>
			<?php echo $security_matrix_edit->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $security_matrix_edit->ProvinceCode->Lookup->getParamTag($security_matrix_edit, "p_x_ProvinceCode") ?>
</span>
<?php echo $security_matrix_edit->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($security_matrix_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_security_matrix_LACode" for="x_LACode" class="<?php echo $security_matrix_edit->LeftColumnClass ?>"><?php echo $security_matrix_edit->LACode->caption() ?><?php echo $security_matrix_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $security_matrix_edit->RightColumnClass ?>"><div <?php echo $security_matrix_edit->LACode->cellAttributes() ?>>
<span id="el_security_matrix_LACode">
<?php $security_matrix_edit->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="security_matrix" data-field="x_LACode" data-value-separator="<?php echo $security_matrix_edit->LACode->displayValueSeparatorAttribute() ?>" id="x_LACode" name="x_LACode"<?php echo $security_matrix_edit->LACode->editAttributes() ?>>
			<?php echo $security_matrix_edit->LACode->selectOptionListHtml("x_LACode") ?>
		</select>
</div>
<?php echo $security_matrix_edit->LACode->Lookup->getParamTag($security_matrix_edit, "p_x_LACode") ?>
</span>
<?php echo $security_matrix_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($security_matrix_edit->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_security_matrix_DepartmentCode" for="x_DepartmentCode" class="<?php echo $security_matrix_edit->LeftColumnClass ?>"><?php echo $security_matrix_edit->DepartmentCode->caption() ?><?php echo $security_matrix_edit->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $security_matrix_edit->RightColumnClass ?>"><div <?php echo $security_matrix_edit->DepartmentCode->cellAttributes() ?>>
<span id="el_security_matrix_DepartmentCode">
<?php $security_matrix_edit->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="security_matrix" data-field="x_DepartmentCode" data-value-separator="<?php echo $security_matrix_edit->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $security_matrix_edit->DepartmentCode->editAttributes() ?>>
			<?php echo $security_matrix_edit->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $security_matrix_edit->DepartmentCode->Lookup->getParamTag($security_matrix_edit, "p_x_DepartmentCode") ?>
</span>
<?php echo $security_matrix_edit->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($security_matrix_edit->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_security_matrix_SectionCode" for="x_SectionCode" class="<?php echo $security_matrix_edit->LeftColumnClass ?>"><?php echo $security_matrix_edit->SectionCode->caption() ?><?php echo $security_matrix_edit->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $security_matrix_edit->RightColumnClass ?>"><div <?php echo $security_matrix_edit->SectionCode->cellAttributes() ?>>
<span id="el_security_matrix_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="security_matrix" data-field="x_SectionCode" data-value-separator="<?php echo $security_matrix_edit->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $security_matrix_edit->SectionCode->editAttributes() ?>>
			<?php echo $security_matrix_edit->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $security_matrix_edit->SectionCode->Lookup->getParamTag($security_matrix_edit, "p_x_SectionCode") ?>
</span>
<?php echo $security_matrix_edit->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($security_matrix_edit->SecurityNumber->Visible) { // SecurityNumber ?>
	<div id="r_SecurityNumber" class="form-group row">
		<label id="elh_security_matrix_SecurityNumber" class="<?php echo $security_matrix_edit->LeftColumnClass ?>"><?php echo $security_matrix_edit->SecurityNumber->caption() ?><?php echo $security_matrix_edit->SecurityNumber->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $security_matrix_edit->RightColumnClass ?>"><div <?php echo $security_matrix_edit->SecurityNumber->cellAttributes() ?>>
<span id="el_security_matrix_SecurityNumber">
<span<?php echo $security_matrix_edit->SecurityNumber->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($security_matrix_edit->SecurityNumber->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="security_matrix" data-field="x_SecurityNumber" name="x_SecurityNumber" id="x_SecurityNumber" value="<?php echo HtmlEncode($security_matrix_edit->SecurityNumber->CurrentValue) ?>">
<?php echo $security_matrix_edit->SecurityNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($security_matrix_edit->ValidFrom->Visible) { // ValidFrom ?>
	<div id="r_ValidFrom" class="form-group row">
		<label id="elh_security_matrix_ValidFrom" for="x_ValidFrom" class="<?php echo $security_matrix_edit->LeftColumnClass ?>"><?php echo $security_matrix_edit->ValidFrom->caption() ?><?php echo $security_matrix_edit->ValidFrom->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $security_matrix_edit->RightColumnClass ?>"><div <?php echo $security_matrix_edit->ValidFrom->cellAttributes() ?>>
<span id="el_security_matrix_ValidFrom">
<input type="text" data-table="security_matrix" data-field="x_ValidFrom" name="x_ValidFrom" id="x_ValidFrom" placeholder="<?php echo HtmlEncode($security_matrix_edit->ValidFrom->getPlaceHolder()) ?>" value="<?php echo $security_matrix_edit->ValidFrom->EditValue ?>"<?php echo $security_matrix_edit->ValidFrom->editAttributes() ?>>
<?php if (!$security_matrix_edit->ValidFrom->ReadOnly && !$security_matrix_edit->ValidFrom->Disabled && !isset($security_matrix_edit->ValidFrom->EditAttrs["readonly"]) && !isset($security_matrix_edit->ValidFrom->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsecurity_matrixedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fsecurity_matrixedit", "x_ValidFrom", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $security_matrix_edit->ValidFrom->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($security_matrix_edit->ValidTo->Visible) { // ValidTo ?>
	<div id="r_ValidTo" class="form-group row">
		<label id="elh_security_matrix_ValidTo" for="x_ValidTo" class="<?php echo $security_matrix_edit->LeftColumnClass ?>"><?php echo $security_matrix_edit->ValidTo->caption() ?><?php echo $security_matrix_edit->ValidTo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $security_matrix_edit->RightColumnClass ?>"><div <?php echo $security_matrix_edit->ValidTo->cellAttributes() ?>>
<span id="el_security_matrix_ValidTo">
<input type="text" data-table="security_matrix" data-field="x_ValidTo" name="x_ValidTo" id="x_ValidTo" placeholder="<?php echo HtmlEncode($security_matrix_edit->ValidTo->getPlaceHolder()) ?>" value="<?php echo $security_matrix_edit->ValidTo->EditValue ?>"<?php echo $security_matrix_edit->ValidTo->editAttributes() ?>>
<?php if (!$security_matrix_edit->ValidTo->ReadOnly && !$security_matrix_edit->ValidTo->Disabled && !isset($security_matrix_edit->ValidTo->EditAttrs["readonly"]) && !isset($security_matrix_edit->ValidTo->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsecurity_matrixedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fsecurity_matrixedit", "x_ValidTo", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $security_matrix_edit->ValidTo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($security_matrix_edit->ApproveLevel->Visible) { // ApproveLevel ?>
	<div id="r_ApproveLevel" class="form-group row">
		<label id="elh_security_matrix_ApproveLevel" for="x_ApproveLevel" class="<?php echo $security_matrix_edit->LeftColumnClass ?>"><?php echo $security_matrix_edit->ApproveLevel->caption() ?><?php echo $security_matrix_edit->ApproveLevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $security_matrix_edit->RightColumnClass ?>"><div <?php echo $security_matrix_edit->ApproveLevel->cellAttributes() ?>>
<span id="el_security_matrix_ApproveLevel">
<input type="text" data-table="security_matrix" data-field="x_ApproveLevel" name="x_ApproveLevel" id="x_ApproveLevel" size="30" placeholder="<?php echo HtmlEncode($security_matrix_edit->ApproveLevel->getPlaceHolder()) ?>" value="<?php echo $security_matrix_edit->ApproveLevel->EditValue ?>"<?php echo $security_matrix_edit->ApproveLevel->editAttributes() ?>>
</span>
<?php echo $security_matrix_edit->ApproveLevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($security_matrix_edit->ActivityCode->Visible) { // ActivityCode ?>
	<div id="r_ActivityCode" class="form-group row">
		<label id="elh_security_matrix_ActivityCode" for="x_ActivityCode" class="<?php echo $security_matrix_edit->LeftColumnClass ?>"><?php echo $security_matrix_edit->ActivityCode->caption() ?><?php echo $security_matrix_edit->ActivityCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $security_matrix_edit->RightColumnClass ?>"><div <?php echo $security_matrix_edit->ActivityCode->cellAttributes() ?>>
<span id="el_security_matrix_ActivityCode">
<input type="text" data-table="security_matrix" data-field="x_ActivityCode" name="x_ActivityCode" id="x_ActivityCode" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($security_matrix_edit->ActivityCode->getPlaceHolder()) ?>" value="<?php echo $security_matrix_edit->ActivityCode->EditValue ?>"<?php echo $security_matrix_edit->ActivityCode->editAttributes() ?>>
</span>
<?php echo $security_matrix_edit->ActivityCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$security_matrix_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $security_matrix_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $security_matrix_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$security_matrix_edit->IsModal) { ?>
<?php echo $security_matrix_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$security_matrix_edit->showPageFooter();
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
$security_matrix_edit->terminate();
?>