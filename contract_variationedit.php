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
$contract_variation_edit = new contract_variation_edit();

// Run the page
$contract_variation_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contract_variation_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcontract_variationedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcontract_variationedit = currentForm = new ew.Form("fcontract_variationedit", "edit");

	// Validate form
	fcontract_variationedit.validate = function() {
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
			<?php if ($contract_variation_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_variation_edit->LACode->caption(), $contract_variation_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_variation_edit->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_variation_edit->DepartmentCode->caption(), $contract_variation_edit->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_variation_edit->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_variation_edit->SectionCode->caption(), $contract_variation_edit->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_variation_edit->ContractNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_variation_edit->ContractNo->caption(), $contract_variation_edit->ContractNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_variation_edit->VariationAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_VariationAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_variation_edit->VariationAmount->caption(), $contract_variation_edit->VariationAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VariationAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_variation_edit->VariationAmount->errorMessage()) ?>");
			<?php if ($contract_variation_edit->VariationNo->Required) { ?>
				elm = this.getElements("x" + infix + "_VariationNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_variation_edit->VariationNo->caption(), $contract_variation_edit->VariationNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_variation_edit->VariationDate->Required) { ?>
				elm = this.getElements("x" + infix + "_VariationDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_variation_edit->VariationDate->caption(), $contract_variation_edit->VariationDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VariationDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_variation_edit->VariationDate->errorMessage()) ?>");
			<?php if ($contract_variation_edit->VariationJustification->Required) { ?>
				elm = this.getElements("x" + infix + "_VariationJustification");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_variation_edit->VariationJustification->caption(), $contract_variation_edit->VariationJustification->RequiredErrorMessage)) ?>");
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
	fcontract_variationedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcontract_variationedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcontract_variationedit.lists["x_LACode"] = <?php echo $contract_variation_edit->LACode->Lookup->toClientList($contract_variation_edit) ?>;
	fcontract_variationedit.lists["x_LACode"].options = <?php echo JsonEncode($contract_variation_edit->LACode->lookupOptions()) ?>;
	fcontract_variationedit.lists["x_DepartmentCode"] = <?php echo $contract_variation_edit->DepartmentCode->Lookup->toClientList($contract_variation_edit) ?>;
	fcontract_variationedit.lists["x_DepartmentCode"].options = <?php echo JsonEncode($contract_variation_edit->DepartmentCode->lookupOptions()) ?>;
	fcontract_variationedit.lists["x_SectionCode"] = <?php echo $contract_variation_edit->SectionCode->Lookup->toClientList($contract_variation_edit) ?>;
	fcontract_variationedit.lists["x_SectionCode"].options = <?php echo JsonEncode($contract_variation_edit->SectionCode->lookupOptions()) ?>;
	loadjs.done("fcontract_variationedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $contract_variation_edit->showPageHeader(); ?>
<?php
$contract_variation_edit->showMessage();
?>
<?php if (!$contract_variation_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contract_variation_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcontract_variationedit" id="fcontract_variationedit" class="<?php echo $contract_variation_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contract_variation">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$contract_variation_edit->IsModal ?>">
<?php if ($contract_variation->getCurrentMasterTable() == "contract") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="contract">
<input type="hidden" name="fk_ContractNo" value="<?php echo HtmlEncode($contract_variation_edit->ContractNo->getSessionValue()) ?>">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($contract_variation_edit->DepartmentCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($contract_variation_edit->LACode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($contract_variation_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_contract_variation_LACode" for="x_LACode" class="<?php echo $contract_variation_edit->LeftColumnClass ?>"><?php echo $contract_variation_edit->LACode->caption() ?><?php echo $contract_variation_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_variation_edit->RightColumnClass ?>"><div <?php echo $contract_variation_edit->LACode->cellAttributes() ?>>
<?php if ($contract_variation_edit->LACode->getSessionValue() != "") { ?>
<span id="el_contract_variation_LACode">
<span<?php echo $contract_variation_edit->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contract_variation_edit->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($contract_variation_edit->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_contract_variation_LACode">
<?php $contract_variation_edit->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($contract_variation_edit->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $contract_variation_edit->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contract_variation_edit->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($contract_variation_edit->LACode->ReadOnly || $contract_variation_edit->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $contract_variation_edit->LACode->Lookup->getParamTag($contract_variation_edit, "p_x_LACode") ?>
<input type="hidden" data-table="contract_variation" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contract_variation_edit->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $contract_variation_edit->LACode->CurrentValue ?>"<?php echo $contract_variation_edit->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $contract_variation_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_variation_edit->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_contract_variation_DepartmentCode" for="x_DepartmentCode" class="<?php echo $contract_variation_edit->LeftColumnClass ?>"><?php echo $contract_variation_edit->DepartmentCode->caption() ?><?php echo $contract_variation_edit->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_variation_edit->RightColumnClass ?>"><div <?php echo $contract_variation_edit->DepartmentCode->cellAttributes() ?>>
<?php if ($contract_variation_edit->DepartmentCode->getSessionValue() != "") { ?>
<span id="el_contract_variation_DepartmentCode">
<span<?php echo $contract_variation_edit->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contract_variation_edit->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_DepartmentCode" name="x_DepartmentCode" value="<?php echo HtmlEncode($contract_variation_edit->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_contract_variation_DepartmentCode">
<?php $contract_variation_edit->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contract_variation" data-field="x_DepartmentCode" data-value-separator="<?php echo $contract_variation_edit->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $contract_variation_edit->DepartmentCode->editAttributes() ?>>
			<?php echo $contract_variation_edit->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $contract_variation_edit->DepartmentCode->Lookup->getParamTag($contract_variation_edit, "p_x_DepartmentCode") ?>
</span>
<?php } ?>
<?php echo $contract_variation_edit->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_variation_edit->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_contract_variation_SectionCode" for="x_SectionCode" class="<?php echo $contract_variation_edit->LeftColumnClass ?>"><?php echo $contract_variation_edit->SectionCode->caption() ?><?php echo $contract_variation_edit->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_variation_edit->RightColumnClass ?>"><div <?php echo $contract_variation_edit->SectionCode->cellAttributes() ?>>
<span id="el_contract_variation_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contract_variation" data-field="x_SectionCode" data-value-separator="<?php echo $contract_variation_edit->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $contract_variation_edit->SectionCode->editAttributes() ?>>
			<?php echo $contract_variation_edit->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $contract_variation_edit->SectionCode->Lookup->getParamTag($contract_variation_edit, "p_x_SectionCode") ?>
</span>
<?php echo $contract_variation_edit->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_variation_edit->ContractNo->Visible) { // ContractNo ?>
	<div id="r_ContractNo" class="form-group row">
		<label id="elh_contract_variation_ContractNo" for="x_ContractNo" class="<?php echo $contract_variation_edit->LeftColumnClass ?>"><?php echo $contract_variation_edit->ContractNo->caption() ?><?php echo $contract_variation_edit->ContractNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_variation_edit->RightColumnClass ?>"><div <?php echo $contract_variation_edit->ContractNo->cellAttributes() ?>>
<?php if ($contract_variation_edit->ContractNo->getSessionValue() != "") { ?>
<span id="el_contract_variation_ContractNo">
<span<?php echo $contract_variation_edit->ContractNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contract_variation_edit->ContractNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ContractNo" name="x_ContractNo" value="<?php echo HtmlEncode($contract_variation_edit->ContractNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_contract_variation_ContractNo">
<input type="text" data-table="contract_variation" data-field="x_ContractNo" name="x_ContractNo" id="x_ContractNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($contract_variation_edit->ContractNo->getPlaceHolder()) ?>" value="<?php echo $contract_variation_edit->ContractNo->EditValue ?>"<?php echo $contract_variation_edit->ContractNo->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $contract_variation_edit->ContractNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_variation_edit->VariationAmount->Visible) { // VariationAmount ?>
	<div id="r_VariationAmount" class="form-group row">
		<label id="elh_contract_variation_VariationAmount" for="x_VariationAmount" class="<?php echo $contract_variation_edit->LeftColumnClass ?>"><?php echo $contract_variation_edit->VariationAmount->caption() ?><?php echo $contract_variation_edit->VariationAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_variation_edit->RightColumnClass ?>"><div <?php echo $contract_variation_edit->VariationAmount->cellAttributes() ?>>
<span id="el_contract_variation_VariationAmount">
<input type="text" data-table="contract_variation" data-field="x_VariationAmount" name="x_VariationAmount" id="x_VariationAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($contract_variation_edit->VariationAmount->getPlaceHolder()) ?>" value="<?php echo $contract_variation_edit->VariationAmount->EditValue ?>"<?php echo $contract_variation_edit->VariationAmount->editAttributes() ?>>
</span>
<?php echo $contract_variation_edit->VariationAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_variation_edit->VariationNo->Visible) { // VariationNo ?>
	<div id="r_VariationNo" class="form-group row">
		<label id="elh_contract_variation_VariationNo" class="<?php echo $contract_variation_edit->LeftColumnClass ?>"><?php echo $contract_variation_edit->VariationNo->caption() ?><?php echo $contract_variation_edit->VariationNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_variation_edit->RightColumnClass ?>"><div <?php echo $contract_variation_edit->VariationNo->cellAttributes() ?>>
<span id="el_contract_variation_VariationNo">
<span<?php echo $contract_variation_edit->VariationNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contract_variation_edit->VariationNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="contract_variation" data-field="x_VariationNo" name="x_VariationNo" id="x_VariationNo" value="<?php echo HtmlEncode($contract_variation_edit->VariationNo->CurrentValue) ?>">
<?php echo $contract_variation_edit->VariationNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_variation_edit->VariationDate->Visible) { // VariationDate ?>
	<div id="r_VariationDate" class="form-group row">
		<label id="elh_contract_variation_VariationDate" for="x_VariationDate" class="<?php echo $contract_variation_edit->LeftColumnClass ?>"><?php echo $contract_variation_edit->VariationDate->caption() ?><?php echo $contract_variation_edit->VariationDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_variation_edit->RightColumnClass ?>"><div <?php echo $contract_variation_edit->VariationDate->cellAttributes() ?>>
<span id="el_contract_variation_VariationDate">
<input type="text" data-table="contract_variation" data-field="x_VariationDate" name="x_VariationDate" id="x_VariationDate" maxlength="10" placeholder="<?php echo HtmlEncode($contract_variation_edit->VariationDate->getPlaceHolder()) ?>" value="<?php echo $contract_variation_edit->VariationDate->EditValue ?>"<?php echo $contract_variation_edit->VariationDate->editAttributes() ?>>
<?php if (!$contract_variation_edit->VariationDate->ReadOnly && !$contract_variation_edit->VariationDate->Disabled && !isset($contract_variation_edit->VariationDate->EditAttrs["readonly"]) && !isset($contract_variation_edit->VariationDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontract_variationedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontract_variationedit", "x_VariationDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $contract_variation_edit->VariationDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_variation_edit->VariationJustification->Visible) { // VariationJustification ?>
	<div id="r_VariationJustification" class="form-group row">
		<label id="elh_contract_variation_VariationJustification" for="x_VariationJustification" class="<?php echo $contract_variation_edit->LeftColumnClass ?>"><?php echo $contract_variation_edit->VariationJustification->caption() ?><?php echo $contract_variation_edit->VariationJustification->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_variation_edit->RightColumnClass ?>"><div <?php echo $contract_variation_edit->VariationJustification->cellAttributes() ?>>
<span id="el_contract_variation_VariationJustification">
<textarea data-table="contract_variation" data-field="x_VariationJustification" name="x_VariationJustification" id="x_VariationJustification" cols="35" rows="2" placeholder="<?php echo HtmlEncode($contract_variation_edit->VariationJustification->getPlaceHolder()) ?>"<?php echo $contract_variation_edit->VariationJustification->editAttributes() ?>><?php echo $contract_variation_edit->VariationJustification->EditValue ?></textarea>
</span>
<?php echo $contract_variation_edit->VariationJustification->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$contract_variation_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $contract_variation_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contract_variation_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$contract_variation_edit->IsModal) { ?>
<?php echo $contract_variation_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$contract_variation_edit->showPageFooter();
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
$contract_variation_edit->terminate();
?>