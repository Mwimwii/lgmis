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
$programme_add = new programme_add();

// Run the page
$programme_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$programme_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fprogrammeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fprogrammeadd = currentForm = new ew.Form("fprogrammeadd", "add");

	// Validate form
	fprogrammeadd.validate = function() {
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
			<?php if ($programme_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $programme_add->LACode->caption(), $programme_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($programme_add->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $programme_add->DepartmentCode->caption(), $programme_add->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($programme_add->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $programme_add->SectionCode->caption(), $programme_add->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($programme_add->IFMISProgramme->Required) { ?>
				elm = this.getElements("x" + infix + "_IFMISProgramme");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $programme_add->IFMISProgramme->caption(), $programme_add->IFMISProgramme->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($programme_add->ProgrammeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgrammeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $programme_add->ProgrammeCode->caption(), $programme_add->ProgrammeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProgrammeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($programme_add->ProgrammeCode->errorMessage()) ?>");
			<?php if ($programme_add->ProgrammeName->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgrammeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $programme_add->ProgrammeName->caption(), $programme_add->ProgrammeName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($programme_add->ProgrammeType->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgrammeType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $programme_add->ProgrammeType->caption(), $programme_add->ProgrammeType->RequiredErrorMessage)) ?>");
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
	fprogrammeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fprogrammeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fprogrammeadd.lists["x_LACode"] = <?php echo $programme_add->LACode->Lookup->toClientList($programme_add) ?>;
	fprogrammeadd.lists["x_LACode"].options = <?php echo JsonEncode($programme_add->LACode->lookupOptions()) ?>;
	fprogrammeadd.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fprogrammeadd.lists["x_DepartmentCode"] = <?php echo $programme_add->DepartmentCode->Lookup->toClientList($programme_add) ?>;
	fprogrammeadd.lists["x_DepartmentCode"].options = <?php echo JsonEncode($programme_add->DepartmentCode->lookupOptions()) ?>;
	fprogrammeadd.lists["x_SectionCode"] = <?php echo $programme_add->SectionCode->Lookup->toClientList($programme_add) ?>;
	fprogrammeadd.lists["x_SectionCode"].options = <?php echo JsonEncode($programme_add->SectionCode->lookupOptions()) ?>;
	fprogrammeadd.lists["x_ProgrammeType"] = <?php echo $programme_add->ProgrammeType->Lookup->toClientList($programme_add) ?>;
	fprogrammeadd.lists["x_ProgrammeType"].options = <?php echo JsonEncode($programme_add->ProgrammeType->lookupOptions()) ?>;
	loadjs.done("fprogrammeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $programme_add->showPageHeader(); ?>
<?php
$programme_add->showMessage();
?>
<form name="fprogrammeadd" id="fprogrammeadd" class="<?php echo $programme_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="programme">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$programme_add->IsModal ?>">
<?php if ($programme->getCurrentMasterTable() == "dept_section") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="dept_section">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($programme_add->DepartmentCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($programme_add->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_SectionCode" value="<?php echo HtmlEncode($programme_add->SectionCode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($programme_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_programme_LACode" class="<?php echo $programme_add->LeftColumnClass ?>"><?php echo $programme_add->LACode->caption() ?><?php echo $programme_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $programme_add->RightColumnClass ?>"><div <?php echo $programme_add->LACode->cellAttributes() ?>>
<?php if ($programme_add->LACode->getSessionValue() != "") { ?>
<span id="el_programme_LACode">
<span<?php echo $programme_add->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($programme_add->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($programme_add->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_programme_LACode">
<?php
$onchange = $programme_add->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$programme_add->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($programme_add->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($programme_add->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($programme_add->LACode->getPlaceHolder()) ?>"<?php echo $programme_add->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="programme" data-field="x_LACode" data-value-separator="<?php echo $programme_add->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($programme_add->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fprogrammeadd"], function() {
	fprogrammeadd.createAutoSuggest({"id":"x_LACode","forceSelect":false});
});
</script>
<?php echo $programme_add->LACode->Lookup->getParamTag($programme_add, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $programme_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($programme_add->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_programme_DepartmentCode" for="x_DepartmentCode" class="<?php echo $programme_add->LeftColumnClass ?>"><?php echo $programme_add->DepartmentCode->caption() ?><?php echo $programme_add->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $programme_add->RightColumnClass ?>"><div <?php echo $programme_add->DepartmentCode->cellAttributes() ?>>
<?php if ($programme_add->DepartmentCode->getSessionValue() != "") { ?>
<span id="el_programme_DepartmentCode">
<span<?php echo $programme_add->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($programme_add->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_DepartmentCode" name="x_DepartmentCode" value="<?php echo HtmlEncode($programme_add->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_programme_DepartmentCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="programme" data-field="x_DepartmentCode" data-value-separator="<?php echo $programme_add->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $programme_add->DepartmentCode->editAttributes() ?>>
			<?php echo $programme_add->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $programme_add->DepartmentCode->Lookup->getParamTag($programme_add, "p_x_DepartmentCode") ?>
</span>
<?php } ?>
<?php echo $programme_add->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($programme_add->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_programme_SectionCode" for="x_SectionCode" class="<?php echo $programme_add->LeftColumnClass ?>"><?php echo $programme_add->SectionCode->caption() ?><?php echo $programme_add->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $programme_add->RightColumnClass ?>"><div <?php echo $programme_add->SectionCode->cellAttributes() ?>>
<?php if ($programme_add->SectionCode->getSessionValue() != "") { ?>
<span id="el_programme_SectionCode">
<span<?php echo $programme_add->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($programme_add->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_SectionCode" name="x_SectionCode" value="<?php echo HtmlEncode($programme_add->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_programme_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="programme" data-field="x_SectionCode" data-value-separator="<?php echo $programme_add->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $programme_add->SectionCode->editAttributes() ?>>
			<?php echo $programme_add->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $programme_add->SectionCode->Lookup->getParamTag($programme_add, "p_x_SectionCode") ?>
</span>
<?php } ?>
<?php echo $programme_add->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($programme_add->IFMISProgramme->Visible) { // IFMISProgramme ?>
	<div id="r_IFMISProgramme" class="form-group row">
		<label id="elh_programme_IFMISProgramme" for="x_IFMISProgramme" class="<?php echo $programme_add->LeftColumnClass ?>"><?php echo $programme_add->IFMISProgramme->caption() ?><?php echo $programme_add->IFMISProgramme->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $programme_add->RightColumnClass ?>"><div <?php echo $programme_add->IFMISProgramme->cellAttributes() ?>>
<span id="el_programme_IFMISProgramme">
<input type="text" data-table="programme" data-field="x_IFMISProgramme" name="x_IFMISProgramme" id="x_IFMISProgramme" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($programme_add->IFMISProgramme->getPlaceHolder()) ?>" value="<?php echo $programme_add->IFMISProgramme->EditValue ?>"<?php echo $programme_add->IFMISProgramme->editAttributes() ?>>
</span>
<?php echo $programme_add->IFMISProgramme->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($programme_add->ProgrammeCode->Visible) { // ProgrammeCode ?>
	<div id="r_ProgrammeCode" class="form-group row">
		<label id="elh_programme_ProgrammeCode" for="x_ProgrammeCode" class="<?php echo $programme_add->LeftColumnClass ?>"><?php echo $programme_add->ProgrammeCode->caption() ?><?php echo $programme_add->ProgrammeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $programme_add->RightColumnClass ?>"><div <?php echo $programme_add->ProgrammeCode->cellAttributes() ?>>
<span id="el_programme_ProgrammeCode">
<input type="text" data-table="programme" data-field="x_ProgrammeCode" name="x_ProgrammeCode" id="x_ProgrammeCode" placeholder="<?php echo HtmlEncode($programme_add->ProgrammeCode->getPlaceHolder()) ?>" value="<?php echo $programme_add->ProgrammeCode->EditValue ?>"<?php echo $programme_add->ProgrammeCode->editAttributes() ?>>
</span>
<?php echo $programme_add->ProgrammeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($programme_add->ProgrammeName->Visible) { // ProgrammeName ?>
	<div id="r_ProgrammeName" class="form-group row">
		<label id="elh_programme_ProgrammeName" for="x_ProgrammeName" class="<?php echo $programme_add->LeftColumnClass ?>"><?php echo $programme_add->ProgrammeName->caption() ?><?php echo $programme_add->ProgrammeName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $programme_add->RightColumnClass ?>"><div <?php echo $programme_add->ProgrammeName->cellAttributes() ?>>
<span id="el_programme_ProgrammeName">
<input type="text" data-table="programme" data-field="x_ProgrammeName" name="x_ProgrammeName" id="x_ProgrammeName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($programme_add->ProgrammeName->getPlaceHolder()) ?>" value="<?php echo $programme_add->ProgrammeName->EditValue ?>"<?php echo $programme_add->ProgrammeName->editAttributes() ?>>
</span>
<?php echo $programme_add->ProgrammeName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($programme_add->ProgrammeType->Visible) { // ProgrammeType ?>
	<div id="r_ProgrammeType" class="form-group row">
		<label id="elh_programme_ProgrammeType" for="x_ProgrammeType" class="<?php echo $programme_add->LeftColumnClass ?>"><?php echo $programme_add->ProgrammeType->caption() ?><?php echo $programme_add->ProgrammeType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $programme_add->RightColumnClass ?>"><div <?php echo $programme_add->ProgrammeType->cellAttributes() ?>>
<span id="el_programme_ProgrammeType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="programme" data-field="x_ProgrammeType" data-value-separator="<?php echo $programme_add->ProgrammeType->displayValueSeparatorAttribute() ?>" id="x_ProgrammeType" name="x_ProgrammeType"<?php echo $programme_add->ProgrammeType->editAttributes() ?>>
			<?php echo $programme_add->ProgrammeType->selectOptionListHtml("x_ProgrammeType") ?>
		</select>
</div>
<?php echo $programme_add->ProgrammeType->Lookup->getParamTag($programme_add, "p_x_ProgrammeType") ?>
</span>
<?php echo $programme_add->ProgrammeType->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$programme_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $programme_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $programme_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$programme_add->showPageFooter();
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
$programme_add->terminate();
?>