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
$security_matrix_add = new security_matrix_add();

// Run the page
$security_matrix_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$security_matrix_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsecurity_matrixadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fsecurity_matrixadd = currentForm = new ew.Form("fsecurity_matrixadd", "add");

	// Validate form
	fsecurity_matrixadd.validate = function() {
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
			<?php if ($security_matrix_add->UserCode->Required) { ?>
				elm = this.getElements("x" + infix + "_UserCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_add->UserCode->caption(), $security_matrix_add->UserCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_UserCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($security_matrix_add->UserCode->errorMessage()) ?>");
			<?php if ($security_matrix_add->PeriodCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_add->PeriodCode->caption(), $security_matrix_add->PeriodCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PeriodCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($security_matrix_add->PeriodCode->errorMessage()) ?>");
			<?php if ($security_matrix_add->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_add->ProvinceCode->caption(), $security_matrix_add->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($security_matrix_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_add->LACode->caption(), $security_matrix_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($security_matrix_add->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_add->DepartmentCode->caption(), $security_matrix_add->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($security_matrix_add->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_add->SectionCode->caption(), $security_matrix_add->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($security_matrix_add->ValidFrom->Required) { ?>
				elm = this.getElements("x" + infix + "_ValidFrom");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_add->ValidFrom->caption(), $security_matrix_add->ValidFrom->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ValidFrom");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($security_matrix_add->ValidFrom->errorMessage()) ?>");
			<?php if ($security_matrix_add->ValidTo->Required) { ?>
				elm = this.getElements("x" + infix + "_ValidTo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_add->ValidTo->caption(), $security_matrix_add->ValidTo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ValidTo");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($security_matrix_add->ValidTo->errorMessage()) ?>");
			<?php if ($security_matrix_add->ApproveLevel->Required) { ?>
				elm = this.getElements("x" + infix + "_ApproveLevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_add->ApproveLevel->caption(), $security_matrix_add->ApproveLevel->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ApproveLevel");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($security_matrix_add->ApproveLevel->errorMessage()) ?>");
			<?php if ($security_matrix_add->ActivityCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ActivityCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_add->ActivityCode->caption(), $security_matrix_add->ActivityCode->RequiredErrorMessage)) ?>");
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
	fsecurity_matrixadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsecurity_matrixadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fsecurity_matrixadd.lists["x_ProvinceCode"] = <?php echo $security_matrix_add->ProvinceCode->Lookup->toClientList($security_matrix_add) ?>;
	fsecurity_matrixadd.lists["x_ProvinceCode"].options = <?php echo JsonEncode($security_matrix_add->ProvinceCode->lookupOptions()) ?>;
	fsecurity_matrixadd.lists["x_LACode"] = <?php echo $security_matrix_add->LACode->Lookup->toClientList($security_matrix_add) ?>;
	fsecurity_matrixadd.lists["x_LACode"].options = <?php echo JsonEncode($security_matrix_add->LACode->lookupOptions()) ?>;
	fsecurity_matrixadd.lists["x_DepartmentCode"] = <?php echo $security_matrix_add->DepartmentCode->Lookup->toClientList($security_matrix_add) ?>;
	fsecurity_matrixadd.lists["x_DepartmentCode"].options = <?php echo JsonEncode($security_matrix_add->DepartmentCode->lookupOptions()) ?>;
	fsecurity_matrixadd.lists["x_SectionCode"] = <?php echo $security_matrix_add->SectionCode->Lookup->toClientList($security_matrix_add) ?>;
	fsecurity_matrixadd.lists["x_SectionCode"].options = <?php echo JsonEncode($security_matrix_add->SectionCode->lookupOptions()) ?>;
	loadjs.done("fsecurity_matrixadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $security_matrix_add->showPageHeader(); ?>
<?php
$security_matrix_add->showMessage();
?>
<form name="fsecurity_matrixadd" id="fsecurity_matrixadd" class="<?php echo $security_matrix_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="security_matrix">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$security_matrix_add->IsModal ?>">
<?php if ($security_matrix->getCurrentMasterTable() == "musers") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="musers">
<input type="hidden" name="fk_UserCode" value="<?php echo HtmlEncode($security_matrix_add->UserCode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($security_matrix_add->UserCode->Visible) { // UserCode ?>
	<div id="r_UserCode" class="form-group row">
		<label id="elh_security_matrix_UserCode" for="x_UserCode" class="<?php echo $security_matrix_add->LeftColumnClass ?>"><?php echo $security_matrix_add->UserCode->caption() ?><?php echo $security_matrix_add->UserCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $security_matrix_add->RightColumnClass ?>"><div <?php echo $security_matrix_add->UserCode->cellAttributes() ?>>
<?php if ($security_matrix_add->UserCode->getSessionValue() != "") { ?>
<span id="el_security_matrix_UserCode">
<span<?php echo $security_matrix_add->UserCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($security_matrix_add->UserCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_UserCode" name="x_UserCode" value="<?php echo HtmlEncode($security_matrix_add->UserCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_security_matrix_UserCode">
<input type="text" data-table="security_matrix" data-field="x_UserCode" name="x_UserCode" id="x_UserCode" size="30" placeholder="<?php echo HtmlEncode($security_matrix_add->UserCode->getPlaceHolder()) ?>" value="<?php echo $security_matrix_add->UserCode->EditValue ?>"<?php echo $security_matrix_add->UserCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $security_matrix_add->UserCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($security_matrix_add->PeriodCode->Visible) { // PeriodCode ?>
	<div id="r_PeriodCode" class="form-group row">
		<label id="elh_security_matrix_PeriodCode" for="x_PeriodCode" class="<?php echo $security_matrix_add->LeftColumnClass ?>"><?php echo $security_matrix_add->PeriodCode->caption() ?><?php echo $security_matrix_add->PeriodCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $security_matrix_add->RightColumnClass ?>"><div <?php echo $security_matrix_add->PeriodCode->cellAttributes() ?>>
<span id="el_security_matrix_PeriodCode">
<input type="text" data-table="security_matrix" data-field="x_PeriodCode" name="x_PeriodCode" id="x_PeriodCode" size="30" placeholder="<?php echo HtmlEncode($security_matrix_add->PeriodCode->getPlaceHolder()) ?>" value="<?php echo $security_matrix_add->PeriodCode->EditValue ?>"<?php echo $security_matrix_add->PeriodCode->editAttributes() ?>>
</span>
<?php echo $security_matrix_add->PeriodCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($security_matrix_add->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_security_matrix_ProvinceCode" for="x_ProvinceCode" class="<?php echo $security_matrix_add->LeftColumnClass ?>"><?php echo $security_matrix_add->ProvinceCode->caption() ?><?php echo $security_matrix_add->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $security_matrix_add->RightColumnClass ?>"><div <?php echo $security_matrix_add->ProvinceCode->cellAttributes() ?>>
<span id="el_security_matrix_ProvinceCode">
<?php $security_matrix_add->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="security_matrix" data-field="x_ProvinceCode" data-value-separator="<?php echo $security_matrix_add->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $security_matrix_add->ProvinceCode->editAttributes() ?>>
			<?php echo $security_matrix_add->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $security_matrix_add->ProvinceCode->Lookup->getParamTag($security_matrix_add, "p_x_ProvinceCode") ?>
</span>
<?php echo $security_matrix_add->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($security_matrix_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_security_matrix_LACode" for="x_LACode" class="<?php echo $security_matrix_add->LeftColumnClass ?>"><?php echo $security_matrix_add->LACode->caption() ?><?php echo $security_matrix_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $security_matrix_add->RightColumnClass ?>"><div <?php echo $security_matrix_add->LACode->cellAttributes() ?>>
<span id="el_security_matrix_LACode">
<?php $security_matrix_add->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="security_matrix" data-field="x_LACode" data-value-separator="<?php echo $security_matrix_add->LACode->displayValueSeparatorAttribute() ?>" id="x_LACode" name="x_LACode"<?php echo $security_matrix_add->LACode->editAttributes() ?>>
			<?php echo $security_matrix_add->LACode->selectOptionListHtml("x_LACode") ?>
		</select>
</div>
<?php echo $security_matrix_add->LACode->Lookup->getParamTag($security_matrix_add, "p_x_LACode") ?>
</span>
<?php echo $security_matrix_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($security_matrix_add->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_security_matrix_DepartmentCode" for="x_DepartmentCode" class="<?php echo $security_matrix_add->LeftColumnClass ?>"><?php echo $security_matrix_add->DepartmentCode->caption() ?><?php echo $security_matrix_add->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $security_matrix_add->RightColumnClass ?>"><div <?php echo $security_matrix_add->DepartmentCode->cellAttributes() ?>>
<span id="el_security_matrix_DepartmentCode">
<?php $security_matrix_add->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="security_matrix" data-field="x_DepartmentCode" data-value-separator="<?php echo $security_matrix_add->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $security_matrix_add->DepartmentCode->editAttributes() ?>>
			<?php echo $security_matrix_add->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $security_matrix_add->DepartmentCode->Lookup->getParamTag($security_matrix_add, "p_x_DepartmentCode") ?>
</span>
<?php echo $security_matrix_add->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($security_matrix_add->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_security_matrix_SectionCode" for="x_SectionCode" class="<?php echo $security_matrix_add->LeftColumnClass ?>"><?php echo $security_matrix_add->SectionCode->caption() ?><?php echo $security_matrix_add->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $security_matrix_add->RightColumnClass ?>"><div <?php echo $security_matrix_add->SectionCode->cellAttributes() ?>>
<span id="el_security_matrix_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="security_matrix" data-field="x_SectionCode" data-value-separator="<?php echo $security_matrix_add->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $security_matrix_add->SectionCode->editAttributes() ?>>
			<?php echo $security_matrix_add->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $security_matrix_add->SectionCode->Lookup->getParamTag($security_matrix_add, "p_x_SectionCode") ?>
</span>
<?php echo $security_matrix_add->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($security_matrix_add->ValidFrom->Visible) { // ValidFrom ?>
	<div id="r_ValidFrom" class="form-group row">
		<label id="elh_security_matrix_ValidFrom" for="x_ValidFrom" class="<?php echo $security_matrix_add->LeftColumnClass ?>"><?php echo $security_matrix_add->ValidFrom->caption() ?><?php echo $security_matrix_add->ValidFrom->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $security_matrix_add->RightColumnClass ?>"><div <?php echo $security_matrix_add->ValidFrom->cellAttributes() ?>>
<span id="el_security_matrix_ValidFrom">
<input type="text" data-table="security_matrix" data-field="x_ValidFrom" name="x_ValidFrom" id="x_ValidFrom" placeholder="<?php echo HtmlEncode($security_matrix_add->ValidFrom->getPlaceHolder()) ?>" value="<?php echo $security_matrix_add->ValidFrom->EditValue ?>"<?php echo $security_matrix_add->ValidFrom->editAttributes() ?>>
<?php if (!$security_matrix_add->ValidFrom->ReadOnly && !$security_matrix_add->ValidFrom->Disabled && !isset($security_matrix_add->ValidFrom->EditAttrs["readonly"]) && !isset($security_matrix_add->ValidFrom->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsecurity_matrixadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fsecurity_matrixadd", "x_ValidFrom", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $security_matrix_add->ValidFrom->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($security_matrix_add->ValidTo->Visible) { // ValidTo ?>
	<div id="r_ValidTo" class="form-group row">
		<label id="elh_security_matrix_ValidTo" for="x_ValidTo" class="<?php echo $security_matrix_add->LeftColumnClass ?>"><?php echo $security_matrix_add->ValidTo->caption() ?><?php echo $security_matrix_add->ValidTo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $security_matrix_add->RightColumnClass ?>"><div <?php echo $security_matrix_add->ValidTo->cellAttributes() ?>>
<span id="el_security_matrix_ValidTo">
<input type="text" data-table="security_matrix" data-field="x_ValidTo" name="x_ValidTo" id="x_ValidTo" placeholder="<?php echo HtmlEncode($security_matrix_add->ValidTo->getPlaceHolder()) ?>" value="<?php echo $security_matrix_add->ValidTo->EditValue ?>"<?php echo $security_matrix_add->ValidTo->editAttributes() ?>>
<?php if (!$security_matrix_add->ValidTo->ReadOnly && !$security_matrix_add->ValidTo->Disabled && !isset($security_matrix_add->ValidTo->EditAttrs["readonly"]) && !isset($security_matrix_add->ValidTo->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsecurity_matrixadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fsecurity_matrixadd", "x_ValidTo", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $security_matrix_add->ValidTo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($security_matrix_add->ApproveLevel->Visible) { // ApproveLevel ?>
	<div id="r_ApproveLevel" class="form-group row">
		<label id="elh_security_matrix_ApproveLevel" for="x_ApproveLevel" class="<?php echo $security_matrix_add->LeftColumnClass ?>"><?php echo $security_matrix_add->ApproveLevel->caption() ?><?php echo $security_matrix_add->ApproveLevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $security_matrix_add->RightColumnClass ?>"><div <?php echo $security_matrix_add->ApproveLevel->cellAttributes() ?>>
<span id="el_security_matrix_ApproveLevel">
<input type="text" data-table="security_matrix" data-field="x_ApproveLevel" name="x_ApproveLevel" id="x_ApproveLevel" size="30" placeholder="<?php echo HtmlEncode($security_matrix_add->ApproveLevel->getPlaceHolder()) ?>" value="<?php echo $security_matrix_add->ApproveLevel->EditValue ?>"<?php echo $security_matrix_add->ApproveLevel->editAttributes() ?>>
</span>
<?php echo $security_matrix_add->ApproveLevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($security_matrix_add->ActivityCode->Visible) { // ActivityCode ?>
	<div id="r_ActivityCode" class="form-group row">
		<label id="elh_security_matrix_ActivityCode" for="x_ActivityCode" class="<?php echo $security_matrix_add->LeftColumnClass ?>"><?php echo $security_matrix_add->ActivityCode->caption() ?><?php echo $security_matrix_add->ActivityCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $security_matrix_add->RightColumnClass ?>"><div <?php echo $security_matrix_add->ActivityCode->cellAttributes() ?>>
<span id="el_security_matrix_ActivityCode">
<input type="text" data-table="security_matrix" data-field="x_ActivityCode" name="x_ActivityCode" id="x_ActivityCode" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($security_matrix_add->ActivityCode->getPlaceHolder()) ?>" value="<?php echo $security_matrix_add->ActivityCode->EditValue ?>"<?php echo $security_matrix_add->ActivityCode->editAttributes() ?>>
</span>
<?php echo $security_matrix_add->ActivityCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$security_matrix_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $security_matrix_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $security_matrix_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$security_matrix_add->showPageFooter();
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
$security_matrix_add->terminate();
?>