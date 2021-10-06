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
$contract_variation_search = new contract_variation_search();

// Run the page
$contract_variation_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contract_variation_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcontract_variationsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($contract_variation_search->IsModal) { ?>
	fcontract_variationsearch = currentAdvancedSearchForm = new ew.Form("fcontract_variationsearch", "search");
	<?php } else { ?>
	fcontract_variationsearch = currentForm = new ew.Form("fcontract_variationsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fcontract_variationsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_VariationAmount");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($contract_variation_search->VariationAmount->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_VariationNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($contract_variation_search->VariationNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_VariationDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($contract_variation_search->VariationDate->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fcontract_variationsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcontract_variationsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcontract_variationsearch.lists["x_LACode"] = <?php echo $contract_variation_search->LACode->Lookup->toClientList($contract_variation_search) ?>;
	fcontract_variationsearch.lists["x_LACode"].options = <?php echo JsonEncode($contract_variation_search->LACode->lookupOptions()) ?>;
	fcontract_variationsearch.lists["x_DepartmentCode"] = <?php echo $contract_variation_search->DepartmentCode->Lookup->toClientList($contract_variation_search) ?>;
	fcontract_variationsearch.lists["x_DepartmentCode"].options = <?php echo JsonEncode($contract_variation_search->DepartmentCode->lookupOptions()) ?>;
	fcontract_variationsearch.lists["x_SectionCode"] = <?php echo $contract_variation_search->SectionCode->Lookup->toClientList($contract_variation_search) ?>;
	fcontract_variationsearch.lists["x_SectionCode"].options = <?php echo JsonEncode($contract_variation_search->SectionCode->lookupOptions()) ?>;
	loadjs.done("fcontract_variationsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $contract_variation_search->showPageHeader(); ?>
<?php
$contract_variation_search->showMessage();
?>
<form name="fcontract_variationsearch" id="fcontract_variationsearch" class="<?php echo $contract_variation_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contract_variation">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$contract_variation_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($contract_variation_search->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label for="x_LACode" class="<?php echo $contract_variation_search->LeftColumnClass ?>"><span id="elh_contract_variation_LACode"><?php echo $contract_variation_search->LACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $contract_variation_search->RightColumnClass ?>"><div <?php echo $contract_variation_search->LACode->cellAttributes() ?>>
			<span id="el_contract_variation_LACode" class="ew-search-field">
<?php $contract_variation_search->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($contract_variation_search->LACode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $contract_variation_search->LACode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contract_variation_search->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($contract_variation_search->LACode->ReadOnly || $contract_variation_search->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $contract_variation_search->LACode->Lookup->getParamTag($contract_variation_search, "p_x_LACode") ?>
<input type="hidden" data-table="contract_variation" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contract_variation_search->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $contract_variation_search->LACode->AdvancedSearch->SearchValue ?>"<?php echo $contract_variation_search->LACode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_variation_search->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label for="x_DepartmentCode" class="<?php echo $contract_variation_search->LeftColumnClass ?>"><span id="elh_contract_variation_DepartmentCode"><?php echo $contract_variation_search->DepartmentCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DepartmentCode" id="z_DepartmentCode" value="=">
</span>
		</label>
		<div class="<?php echo $contract_variation_search->RightColumnClass ?>"><div <?php echo $contract_variation_search->DepartmentCode->cellAttributes() ?>>
			<span id="el_contract_variation_DepartmentCode" class="ew-search-field">
<?php $contract_variation_search->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contract_variation" data-field="x_DepartmentCode" data-value-separator="<?php echo $contract_variation_search->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $contract_variation_search->DepartmentCode->editAttributes() ?>>
			<?php echo $contract_variation_search->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $contract_variation_search->DepartmentCode->Lookup->getParamTag($contract_variation_search, "p_x_DepartmentCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_variation_search->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label for="x_SectionCode" class="<?php echo $contract_variation_search->LeftColumnClass ?>"><span id="elh_contract_variation_SectionCode"><?php echo $contract_variation_search->SectionCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SectionCode" id="z_SectionCode" value="=">
</span>
		</label>
		<div class="<?php echo $contract_variation_search->RightColumnClass ?>"><div <?php echo $contract_variation_search->SectionCode->cellAttributes() ?>>
			<span id="el_contract_variation_SectionCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contract_variation" data-field="x_SectionCode" data-value-separator="<?php echo $contract_variation_search->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $contract_variation_search->SectionCode->editAttributes() ?>>
			<?php echo $contract_variation_search->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $contract_variation_search->SectionCode->Lookup->getParamTag($contract_variation_search, "p_x_SectionCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_variation_search->ContractNo->Visible) { // ContractNo ?>
	<div id="r_ContractNo" class="form-group row">
		<label for="x_ContractNo" class="<?php echo $contract_variation_search->LeftColumnClass ?>"><span id="elh_contract_variation_ContractNo"><?php echo $contract_variation_search->ContractNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ContractNo" id="z_ContractNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $contract_variation_search->RightColumnClass ?>"><div <?php echo $contract_variation_search->ContractNo->cellAttributes() ?>>
			<span id="el_contract_variation_ContractNo" class="ew-search-field">
<input type="text" data-table="contract_variation" data-field="x_ContractNo" name="x_ContractNo" id="x_ContractNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($contract_variation_search->ContractNo->getPlaceHolder()) ?>" value="<?php echo $contract_variation_search->ContractNo->EditValue ?>"<?php echo $contract_variation_search->ContractNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_variation_search->VariationAmount->Visible) { // VariationAmount ?>
	<div id="r_VariationAmount" class="form-group row">
		<label for="x_VariationAmount" class="<?php echo $contract_variation_search->LeftColumnClass ?>"><span id="elh_contract_variation_VariationAmount"><?php echo $contract_variation_search->VariationAmount->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_VariationAmount" id="z_VariationAmount" value="=">
</span>
		</label>
		<div class="<?php echo $contract_variation_search->RightColumnClass ?>"><div <?php echo $contract_variation_search->VariationAmount->cellAttributes() ?>>
			<span id="el_contract_variation_VariationAmount" class="ew-search-field">
<input type="text" data-table="contract_variation" data-field="x_VariationAmount" name="x_VariationAmount" id="x_VariationAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($contract_variation_search->VariationAmount->getPlaceHolder()) ?>" value="<?php echo $contract_variation_search->VariationAmount->EditValue ?>"<?php echo $contract_variation_search->VariationAmount->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_variation_search->VariationNo->Visible) { // VariationNo ?>
	<div id="r_VariationNo" class="form-group row">
		<label for="x_VariationNo" class="<?php echo $contract_variation_search->LeftColumnClass ?>"><span id="elh_contract_variation_VariationNo"><?php echo $contract_variation_search->VariationNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_VariationNo" id="z_VariationNo" value="=">
</span>
		</label>
		<div class="<?php echo $contract_variation_search->RightColumnClass ?>"><div <?php echo $contract_variation_search->VariationNo->cellAttributes() ?>>
			<span id="el_contract_variation_VariationNo" class="ew-search-field">
<input type="text" data-table="contract_variation" data-field="x_VariationNo" name="x_VariationNo" id="x_VariationNo" maxlength="11" placeholder="<?php echo HtmlEncode($contract_variation_search->VariationNo->getPlaceHolder()) ?>" value="<?php echo $contract_variation_search->VariationNo->EditValue ?>"<?php echo $contract_variation_search->VariationNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_variation_search->VariationDate->Visible) { // VariationDate ?>
	<div id="r_VariationDate" class="form-group row">
		<label for="x_VariationDate" class="<?php echo $contract_variation_search->LeftColumnClass ?>"><span id="elh_contract_variation_VariationDate"><?php echo $contract_variation_search->VariationDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_VariationDate" id="z_VariationDate" value="=">
</span>
		</label>
		<div class="<?php echo $contract_variation_search->RightColumnClass ?>"><div <?php echo $contract_variation_search->VariationDate->cellAttributes() ?>>
			<span id="el_contract_variation_VariationDate" class="ew-search-field">
<input type="text" data-table="contract_variation" data-field="x_VariationDate" name="x_VariationDate" id="x_VariationDate" maxlength="10" placeholder="<?php echo HtmlEncode($contract_variation_search->VariationDate->getPlaceHolder()) ?>" value="<?php echo $contract_variation_search->VariationDate->EditValue ?>"<?php echo $contract_variation_search->VariationDate->editAttributes() ?>>
<?php if (!$contract_variation_search->VariationDate->ReadOnly && !$contract_variation_search->VariationDate->Disabled && !isset($contract_variation_search->VariationDate->EditAttrs["readonly"]) && !isset($contract_variation_search->VariationDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontract_variationsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontract_variationsearch", "x_VariationDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_variation_search->VariationJustification->Visible) { // VariationJustification ?>
	<div id="r_VariationJustification" class="form-group row">
		<label for="x_VariationJustification" class="<?php echo $contract_variation_search->LeftColumnClass ?>"><span id="elh_contract_variation_VariationJustification"><?php echo $contract_variation_search->VariationJustification->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_VariationJustification" id="z_VariationJustification" value="LIKE">
</span>
		</label>
		<div class="<?php echo $contract_variation_search->RightColumnClass ?>"><div <?php echo $contract_variation_search->VariationJustification->cellAttributes() ?>>
			<span id="el_contract_variation_VariationJustification" class="ew-search-field">
<input type="text" data-table="contract_variation" data-field="x_VariationJustification" name="x_VariationJustification" id="x_VariationJustification" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($contract_variation_search->VariationJustification->getPlaceHolder()) ?>" value="<?php echo $contract_variation_search->VariationJustification->EditValue ?>"<?php echo $contract_variation_search->VariationJustification->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$contract_variation_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $contract_variation_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$contract_variation_search->showPageFooter();
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
$contract_variation_search->terminate();
?>