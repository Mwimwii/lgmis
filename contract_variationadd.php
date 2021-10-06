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
$contract_variation_add = new contract_variation_add();

// Run the page
$contract_variation_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contract_variation_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcontract_variationadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcontract_variationadd = currentForm = new ew.Form("fcontract_variationadd", "add");

	// Validate form
	fcontract_variationadd.validate = function() {
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
			<?php if ($contract_variation_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_variation_add->LACode->caption(), $contract_variation_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_variation_add->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_variation_add->DepartmentCode->caption(), $contract_variation_add->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_variation_add->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_variation_add->SectionCode->caption(), $contract_variation_add->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_variation_add->ContractNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_variation_add->ContractNo->caption(), $contract_variation_add->ContractNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_variation_add->VariationAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_VariationAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_variation_add->VariationAmount->caption(), $contract_variation_add->VariationAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VariationAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_variation_add->VariationAmount->errorMessage()) ?>");
			<?php if ($contract_variation_add->VariationDate->Required) { ?>
				elm = this.getElements("x" + infix + "_VariationDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_variation_add->VariationDate->caption(), $contract_variation_add->VariationDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VariationDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_variation_add->VariationDate->errorMessage()) ?>");
			<?php if ($contract_variation_add->VariationJustification->Required) { ?>
				elm = this.getElements("x" + infix + "_VariationJustification");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_variation_add->VariationJustification->caption(), $contract_variation_add->VariationJustification->RequiredErrorMessage)) ?>");
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
	fcontract_variationadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcontract_variationadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcontract_variationadd.lists["x_LACode"] = <?php echo $contract_variation_add->LACode->Lookup->toClientList($contract_variation_add) ?>;
	fcontract_variationadd.lists["x_LACode"].options = <?php echo JsonEncode($contract_variation_add->LACode->lookupOptions()) ?>;
	fcontract_variationadd.lists["x_DepartmentCode"] = <?php echo $contract_variation_add->DepartmentCode->Lookup->toClientList($contract_variation_add) ?>;
	fcontract_variationadd.lists["x_DepartmentCode"].options = <?php echo JsonEncode($contract_variation_add->DepartmentCode->lookupOptions()) ?>;
	fcontract_variationadd.lists["x_SectionCode"] = <?php echo $contract_variation_add->SectionCode->Lookup->toClientList($contract_variation_add) ?>;
	fcontract_variationadd.lists["x_SectionCode"].options = <?php echo JsonEncode($contract_variation_add->SectionCode->lookupOptions()) ?>;
	loadjs.done("fcontract_variationadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $contract_variation_add->showPageHeader(); ?>
<?php
$contract_variation_add->showMessage();
?>
<form name="fcontract_variationadd" id="fcontract_variationadd" class="<?php echo $contract_variation_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contract_variation">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$contract_variation_add->IsModal ?>">
<?php if ($contract_variation->getCurrentMasterTable() == "contract") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="contract">
<input type="hidden" name="fk_ContractNo" value="<?php echo HtmlEncode($contract_variation_add->ContractNo->getSessionValue()) ?>">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($contract_variation_add->DepartmentCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($contract_variation_add->LACode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($contract_variation_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_contract_variation_LACode" for="x_LACode" class="<?php echo $contract_variation_add->LeftColumnClass ?>"><?php echo $contract_variation_add->LACode->caption() ?><?php echo $contract_variation_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_variation_add->RightColumnClass ?>"><div <?php echo $contract_variation_add->LACode->cellAttributes() ?>>
<?php if ($contract_variation_add->LACode->getSessionValue() != "") { ?>
<span id="el_contract_variation_LACode">
<span<?php echo $contract_variation_add->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contract_variation_add->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($contract_variation_add->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_contract_variation_LACode">
<?php $contract_variation_add->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($contract_variation_add->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $contract_variation_add->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contract_variation_add->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($contract_variation_add->LACode->ReadOnly || $contract_variation_add->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $contract_variation_add->LACode->Lookup->getParamTag($contract_variation_add, "p_x_LACode") ?>
<input type="hidden" data-table="contract_variation" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contract_variation_add->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $contract_variation_add->LACode->CurrentValue ?>"<?php echo $contract_variation_add->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $contract_variation_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_variation_add->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_contract_variation_DepartmentCode" for="x_DepartmentCode" class="<?php echo $contract_variation_add->LeftColumnClass ?>"><?php echo $contract_variation_add->DepartmentCode->caption() ?><?php echo $contract_variation_add->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_variation_add->RightColumnClass ?>"><div <?php echo $contract_variation_add->DepartmentCode->cellAttributes() ?>>
<?php if ($contract_variation_add->DepartmentCode->getSessionValue() != "") { ?>
<span id="el_contract_variation_DepartmentCode">
<span<?php echo $contract_variation_add->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contract_variation_add->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_DepartmentCode" name="x_DepartmentCode" value="<?php echo HtmlEncode($contract_variation_add->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_contract_variation_DepartmentCode">
<?php $contract_variation_add->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contract_variation" data-field="x_DepartmentCode" data-value-separator="<?php echo $contract_variation_add->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $contract_variation_add->DepartmentCode->editAttributes() ?>>
			<?php echo $contract_variation_add->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $contract_variation_add->DepartmentCode->Lookup->getParamTag($contract_variation_add, "p_x_DepartmentCode") ?>
</span>
<?php } ?>
<?php echo $contract_variation_add->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_variation_add->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_contract_variation_SectionCode" for="x_SectionCode" class="<?php echo $contract_variation_add->LeftColumnClass ?>"><?php echo $contract_variation_add->SectionCode->caption() ?><?php echo $contract_variation_add->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_variation_add->RightColumnClass ?>"><div <?php echo $contract_variation_add->SectionCode->cellAttributes() ?>>
<span id="el_contract_variation_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contract_variation" data-field="x_SectionCode" data-value-separator="<?php echo $contract_variation_add->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $contract_variation_add->SectionCode->editAttributes() ?>>
			<?php echo $contract_variation_add->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $contract_variation_add->SectionCode->Lookup->getParamTag($contract_variation_add, "p_x_SectionCode") ?>
</span>
<?php echo $contract_variation_add->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_variation_add->ContractNo->Visible) { // ContractNo ?>
	<div id="r_ContractNo" class="form-group row">
		<label id="elh_contract_variation_ContractNo" for="x_ContractNo" class="<?php echo $contract_variation_add->LeftColumnClass ?>"><?php echo $contract_variation_add->ContractNo->caption() ?><?php echo $contract_variation_add->ContractNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_variation_add->RightColumnClass ?>"><div <?php echo $contract_variation_add->ContractNo->cellAttributes() ?>>
<?php if ($contract_variation_add->ContractNo->getSessionValue() != "") { ?>
<span id="el_contract_variation_ContractNo">
<span<?php echo $contract_variation_add->ContractNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contract_variation_add->ContractNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ContractNo" name="x_ContractNo" value="<?php echo HtmlEncode($contract_variation_add->ContractNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_contract_variation_ContractNo">
<input type="text" data-table="contract_variation" data-field="x_ContractNo" name="x_ContractNo" id="x_ContractNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($contract_variation_add->ContractNo->getPlaceHolder()) ?>" value="<?php echo $contract_variation_add->ContractNo->EditValue ?>"<?php echo $contract_variation_add->ContractNo->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $contract_variation_add->ContractNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_variation_add->VariationAmount->Visible) { // VariationAmount ?>
	<div id="r_VariationAmount" class="form-group row">
		<label id="elh_contract_variation_VariationAmount" for="x_VariationAmount" class="<?php echo $contract_variation_add->LeftColumnClass ?>"><?php echo $contract_variation_add->VariationAmount->caption() ?><?php echo $contract_variation_add->VariationAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_variation_add->RightColumnClass ?>"><div <?php echo $contract_variation_add->VariationAmount->cellAttributes() ?>>
<span id="el_contract_variation_VariationAmount">
<input type="text" data-table="contract_variation" data-field="x_VariationAmount" name="x_VariationAmount" id="x_VariationAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($contract_variation_add->VariationAmount->getPlaceHolder()) ?>" value="<?php echo $contract_variation_add->VariationAmount->EditValue ?>"<?php echo $contract_variation_add->VariationAmount->editAttributes() ?>>
</span>
<?php echo $contract_variation_add->VariationAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_variation_add->VariationDate->Visible) { // VariationDate ?>
	<div id="r_VariationDate" class="form-group row">
		<label id="elh_contract_variation_VariationDate" for="x_VariationDate" class="<?php echo $contract_variation_add->LeftColumnClass ?>"><?php echo $contract_variation_add->VariationDate->caption() ?><?php echo $contract_variation_add->VariationDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_variation_add->RightColumnClass ?>"><div <?php echo $contract_variation_add->VariationDate->cellAttributes() ?>>
<span id="el_contract_variation_VariationDate">
<input type="text" data-table="contract_variation" data-field="x_VariationDate" name="x_VariationDate" id="x_VariationDate" maxlength="10" placeholder="<?php echo HtmlEncode($contract_variation_add->VariationDate->getPlaceHolder()) ?>" value="<?php echo $contract_variation_add->VariationDate->EditValue ?>"<?php echo $contract_variation_add->VariationDate->editAttributes() ?>>
<?php if (!$contract_variation_add->VariationDate->ReadOnly && !$contract_variation_add->VariationDate->Disabled && !isset($contract_variation_add->VariationDate->EditAttrs["readonly"]) && !isset($contract_variation_add->VariationDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontract_variationadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontract_variationadd", "x_VariationDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $contract_variation_add->VariationDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_variation_add->VariationJustification->Visible) { // VariationJustification ?>
	<div id="r_VariationJustification" class="form-group row">
		<label id="elh_contract_variation_VariationJustification" for="x_VariationJustification" class="<?php echo $contract_variation_add->LeftColumnClass ?>"><?php echo $contract_variation_add->VariationJustification->caption() ?><?php echo $contract_variation_add->VariationJustification->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_variation_add->RightColumnClass ?>"><div <?php echo $contract_variation_add->VariationJustification->cellAttributes() ?>>
<span id="el_contract_variation_VariationJustification">
<textarea data-table="contract_variation" data-field="x_VariationJustification" name="x_VariationJustification" id="x_VariationJustification" cols="35" rows="2" placeholder="<?php echo HtmlEncode($contract_variation_add->VariationJustification->getPlaceHolder()) ?>"<?php echo $contract_variation_add->VariationJustification->editAttributes() ?>><?php echo $contract_variation_add->VariationJustification->EditValue ?></textarea>
</span>
<?php echo $contract_variation_add->VariationJustification->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$contract_variation_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $contract_variation_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contract_variation_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$contract_variation_add->showPageFooter();
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
$contract_variation_add->terminate();
?>