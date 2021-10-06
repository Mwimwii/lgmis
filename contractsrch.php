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
$contract_search = new contract_search();

// Run the page
$contract_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contract_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcontractsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($contract_search->IsModal) { ?>
	fcontractsearch = currentAdvancedSearchForm = new ew.Form("fcontractsearch", "search");
	<?php } else { ?>
	fcontractsearch = currentForm = new ew.Form("fcontractsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fcontractsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ContractSum");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($contract_search->ContractSum->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_RevisedContractSum");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($contract_search->RevisedContractSum->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_SigningDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($contract_search->SigningDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PlannedStartDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($contract_search->PlannedStartDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PlannedEndDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($contract_search->PlannedEndDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ActualStartDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($contract_search->ActualStartDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ActualEndDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($contract_search->ActualEndDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Duration");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($contract_search->Duration->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_AdvancePaymentAmount");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($contract_search->AdvancePaymentAmount->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_AdvancePaymentdate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($contract_search->AdvancePaymentdate->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fcontractsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcontractsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcontractsearch.lists["x_LACode"] = <?php echo $contract_search->LACode->Lookup->toClientList($contract_search) ?>;
	fcontractsearch.lists["x_LACode"].options = <?php echo JsonEncode($contract_search->LACode->lookupOptions()) ?>;
	fcontractsearch.lists["x_DepartmentCode"] = <?php echo $contract_search->DepartmentCode->Lookup->toClientList($contract_search) ?>;
	fcontractsearch.lists["x_DepartmentCode"].options = <?php echo JsonEncode($contract_search->DepartmentCode->lookupOptions()) ?>;
	fcontractsearch.lists["x_SectionCode"] = <?php echo $contract_search->SectionCode->Lookup->toClientList($contract_search) ?>;
	fcontractsearch.lists["x_SectionCode"].options = <?php echo JsonEncode($contract_search->SectionCode->lookupOptions()) ?>;
	fcontractsearch.lists["x_ProjectCode"] = <?php echo $contract_search->ProjectCode->Lookup->toClientList($contract_search) ?>;
	fcontractsearch.lists["x_ProjectCode"].options = <?php echo JsonEncode($contract_search->ProjectCode->lookupOptions()) ?>;
	fcontractsearch.autoSuggests["x_ProjectCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcontractsearch.lists["x_ContractType"] = <?php echo $contract_search->ContractType->Lookup->toClientList($contract_search) ?>;
	fcontractsearch.lists["x_ContractType"].options = <?php echo JsonEncode($contract_search->ContractType->lookupOptions()) ?>;
	fcontractsearch.lists["x_ContractorRef"] = <?php echo $contract_search->ContractorRef->Lookup->toClientList($contract_search) ?>;
	fcontractsearch.lists["x_ContractorRef"].options = <?php echo JsonEncode($contract_search->ContractorRef->lookupOptions()) ?>;
	fcontractsearch.lists["x_UnitOfMeasure"] = <?php echo $contract_search->UnitOfMeasure->Lookup->toClientList($contract_search) ?>;
	fcontractsearch.lists["x_UnitOfMeasure"].options = <?php echo JsonEncode($contract_search->UnitOfMeasure->lookupOptions()) ?>;
	fcontractsearch.lists["x_ContractStatus"] = <?php echo $contract_search->ContractStatus->Lookup->toClientList($contract_search) ?>;
	fcontractsearch.lists["x_ContractStatus"].options = <?php echo JsonEncode($contract_search->ContractStatus->lookupOptions()) ?>;
	loadjs.done("fcontractsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $contract_search->showPageHeader(); ?>
<?php
$contract_search->showMessage();
?>
<form name="fcontractsearch" id="fcontractsearch" class="<?php echo $contract_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contract">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$contract_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($contract_search->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label for="x_LACode" class="<?php echo $contract_search->LeftColumnClass ?>"><span id="elh_contract_LACode"><?php echo $contract_search->LACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $contract_search->RightColumnClass ?>"><div <?php echo $contract_search->LACode->cellAttributes() ?>>
			<span id="el_contract_LACode" class="ew-search-field">
<?php $contract_search->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($contract_search->LACode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $contract_search->LACode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contract_search->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($contract_search->LACode->ReadOnly || $contract_search->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $contract_search->LACode->Lookup->getParamTag($contract_search, "p_x_LACode") ?>
<input type="hidden" data-table="contract" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contract_search->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $contract_search->LACode->AdvancedSearch->SearchValue ?>"<?php echo $contract_search->LACode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_search->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label for="x_DepartmentCode" class="<?php echo $contract_search->LeftColumnClass ?>"><span id="elh_contract_DepartmentCode"><?php echo $contract_search->DepartmentCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DepartmentCode" id="z_DepartmentCode" value="=">
</span>
		</label>
		<div class="<?php echo $contract_search->RightColumnClass ?>"><div <?php echo $contract_search->DepartmentCode->cellAttributes() ?>>
			<span id="el_contract_DepartmentCode" class="ew-search-field">
<?php $contract_search->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DepartmentCode"><?php echo EmptyValue(strval($contract_search->DepartmentCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $contract_search->DepartmentCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contract_search->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($contract_search->DepartmentCode->ReadOnly || $contract_search->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $contract_search->DepartmentCode->Lookup->getParamTag($contract_search, "p_x_DepartmentCode") ?>
<input type="hidden" data-table="contract" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contract_search->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo $contract_search->DepartmentCode->AdvancedSearch->SearchValue ?>"<?php echo $contract_search->DepartmentCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_search->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label for="x_SectionCode" class="<?php echo $contract_search->LeftColumnClass ?>"><span id="elh_contract_SectionCode"><?php echo $contract_search->SectionCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SectionCode" id="z_SectionCode" value="=">
</span>
		</label>
		<div class="<?php echo $contract_search->RightColumnClass ?>"><div <?php echo $contract_search->SectionCode->cellAttributes() ?>>
			<span id="el_contract_SectionCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contract" data-field="x_SectionCode" data-value-separator="<?php echo $contract_search->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $contract_search->SectionCode->editAttributes() ?>>
			<?php echo $contract_search->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $contract_search->SectionCode->Lookup->getParamTag($contract_search, "p_x_SectionCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_search->ProjectCode->Visible) { // ProjectCode ?>
	<div id="r_ProjectCode" class="form-group row">
		<label class="<?php echo $contract_search->LeftColumnClass ?>"><span id="elh_contract_ProjectCode"><?php echo $contract_search->ProjectCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ProjectCode" id="z_ProjectCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $contract_search->RightColumnClass ?>"><div <?php echo $contract_search->ProjectCode->cellAttributes() ?>>
			<span id="el_contract_ProjectCode" class="ew-search-field">
<?php
$onchange = $contract_search->ProjectCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$contract_search->ProjectCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProjectCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ProjectCode" id="sv_x_ProjectCode" value="<?php echo RemoveHtml($contract_search->ProjectCode->EditValue) ?>" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($contract_search->ProjectCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($contract_search->ProjectCode->getPlaceHolder()) ?>"<?php echo $contract_search->ProjectCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contract_search->ProjectCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ProjectCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($contract_search->ProjectCode->ReadOnly || $contract_search->ProjectCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="contract" data-field="x_ProjectCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contract_search->ProjectCode->displayValueSeparatorAttribute() ?>" name="x_ProjectCode" id="x_ProjectCode" value="<?php echo HtmlEncode($contract_search->ProjectCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcontractsearch"], function() {
	fcontractsearch.createAutoSuggest({"id":"x_ProjectCode","forceSelect":false});
});
</script>
<?php echo $contract_search->ProjectCode->Lookup->getParamTag($contract_search, "p_x_ProjectCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_search->ContractNo->Visible) { // ContractNo ?>
	<div id="r_ContractNo" class="form-group row">
		<label for="x_ContractNo" class="<?php echo $contract_search->LeftColumnClass ?>"><span id="elh_contract_ContractNo"><?php echo $contract_search->ContractNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ContractNo" id="z_ContractNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $contract_search->RightColumnClass ?>"><div <?php echo $contract_search->ContractNo->cellAttributes() ?>>
			<span id="el_contract_ContractNo" class="ew-search-field">
<input type="text" data-table="contract" data-field="x_ContractNo" name="x_ContractNo" id="x_ContractNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($contract_search->ContractNo->getPlaceHolder()) ?>" value="<?php echo $contract_search->ContractNo->EditValue ?>"<?php echo $contract_search->ContractNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_search->ContractName->Visible) { // ContractName ?>
	<div id="r_ContractName" class="form-group row">
		<label for="x_ContractName" class="<?php echo $contract_search->LeftColumnClass ?>"><span id="elh_contract_ContractName"><?php echo $contract_search->ContractName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ContractName" id="z_ContractName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $contract_search->RightColumnClass ?>"><div <?php echo $contract_search->ContractName->cellAttributes() ?>>
			<span id="el_contract_ContractName" class="ew-search-field">
<input type="text" data-table="contract" data-field="x_ContractName" name="x_ContractName" id="x_ContractName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contract_search->ContractName->getPlaceHolder()) ?>" value="<?php echo $contract_search->ContractName->EditValue ?>"<?php echo $contract_search->ContractName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_search->ContractType->Visible) { // ContractType ?>
	<div id="r_ContractType" class="form-group row">
		<label for="x_ContractType" class="<?php echo $contract_search->LeftColumnClass ?>"><span id="elh_contract_ContractType"><?php echo $contract_search->ContractType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ContractType" id="z_ContractType" value="=">
</span>
		</label>
		<div class="<?php echo $contract_search->RightColumnClass ?>"><div <?php echo $contract_search->ContractType->cellAttributes() ?>>
			<span id="el_contract_ContractType" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contract" data-field="x_ContractType" data-value-separator="<?php echo $contract_search->ContractType->displayValueSeparatorAttribute() ?>" id="x_ContractType" name="x_ContractType"<?php echo $contract_search->ContractType->editAttributes() ?>>
			<?php echo $contract_search->ContractType->selectOptionListHtml("x_ContractType") ?>
		</select>
</div>
<?php echo $contract_search->ContractType->Lookup->getParamTag($contract_search, "p_x_ContractType") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_search->ContractSum->Visible) { // ContractSum ?>
	<div id="r_ContractSum" class="form-group row">
		<label for="x_ContractSum" class="<?php echo $contract_search->LeftColumnClass ?>"><span id="elh_contract_ContractSum"><?php echo $contract_search->ContractSum->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ContractSum" id="z_ContractSum" value="=">
</span>
		</label>
		<div class="<?php echo $contract_search->RightColumnClass ?>"><div <?php echo $contract_search->ContractSum->cellAttributes() ?>>
			<span id="el_contract_ContractSum" class="ew-search-field">
<input type="text" data-table="contract" data-field="x_ContractSum" name="x_ContractSum" id="x_ContractSum" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($contract_search->ContractSum->getPlaceHolder()) ?>" value="<?php echo $contract_search->ContractSum->EditValue ?>"<?php echo $contract_search->ContractSum->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_search->RevisedContractSum->Visible) { // RevisedContractSum ?>
	<div id="r_RevisedContractSum" class="form-group row">
		<label for="x_RevisedContractSum" class="<?php echo $contract_search->LeftColumnClass ?>"><span id="elh_contract_RevisedContractSum"><?php echo $contract_search->RevisedContractSum->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_RevisedContractSum" id="z_RevisedContractSum" value="=">
</span>
		</label>
		<div class="<?php echo $contract_search->RightColumnClass ?>"><div <?php echo $contract_search->RevisedContractSum->cellAttributes() ?>>
			<span id="el_contract_RevisedContractSum" class="ew-search-field">
<input type="text" data-table="contract" data-field="x_RevisedContractSum" name="x_RevisedContractSum" id="x_RevisedContractSum" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($contract_search->RevisedContractSum->getPlaceHolder()) ?>" value="<?php echo $contract_search->RevisedContractSum->EditValue ?>"<?php echo $contract_search->RevisedContractSum->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_search->ContractorRef->Visible) { // ContractorRef ?>
	<div id="r_ContractorRef" class="form-group row">
		<label for="x_ContractorRef" class="<?php echo $contract_search->LeftColumnClass ?>"><span id="elh_contract_ContractorRef"><?php echo $contract_search->ContractorRef->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ContractorRef" id="z_ContractorRef" value="=">
</span>
		</label>
		<div class="<?php echo $contract_search->RightColumnClass ?>"><div <?php echo $contract_search->ContractorRef->cellAttributes() ?>>
			<span id="el_contract_ContractorRef" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ContractorRef"><?php echo EmptyValue(strval($contract_search->ContractorRef->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $contract_search->ContractorRef->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contract_search->ContractorRef->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($contract_search->ContractorRef->ReadOnly || $contract_search->ContractorRef->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ContractorRef',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $contract_search->ContractorRef->Lookup->getParamTag($contract_search, "p_x_ContractorRef") ?>
<input type="hidden" data-table="contract" data-field="x_ContractorRef" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contract_search->ContractorRef->displayValueSeparatorAttribute() ?>" name="x_ContractorRef" id="x_ContractorRef" value="<?php echo $contract_search->ContractorRef->AdvancedSearch->SearchValue ?>"<?php echo $contract_search->ContractorRef->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_search->SigningDate->Visible) { // SigningDate ?>
	<div id="r_SigningDate" class="form-group row">
		<label for="x_SigningDate" class="<?php echo $contract_search->LeftColumnClass ?>"><span id="elh_contract_SigningDate"><?php echo $contract_search->SigningDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SigningDate" id="z_SigningDate" value="=">
</span>
		</label>
		<div class="<?php echo $contract_search->RightColumnClass ?>"><div <?php echo $contract_search->SigningDate->cellAttributes() ?>>
			<span id="el_contract_SigningDate" class="ew-search-field">
<input type="text" data-table="contract" data-field="x_SigningDate" name="x_SigningDate" id="x_SigningDate" maxlength="10" placeholder="<?php echo HtmlEncode($contract_search->SigningDate->getPlaceHolder()) ?>" value="<?php echo $contract_search->SigningDate->EditValue ?>"<?php echo $contract_search->SigningDate->editAttributes() ?>>
<?php if (!$contract_search->SigningDate->ReadOnly && !$contract_search->SigningDate->Disabled && !isset($contract_search->SigningDate->EditAttrs["readonly"]) && !isset($contract_search->SigningDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontractsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontractsearch", "x_SigningDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_search->PlannedStartDate->Visible) { // PlannedStartDate ?>
	<div id="r_PlannedStartDate" class="form-group row">
		<label for="x_PlannedStartDate" class="<?php echo $contract_search->LeftColumnClass ?>"><span id="elh_contract_PlannedStartDate"><?php echo $contract_search->PlannedStartDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PlannedStartDate" id="z_PlannedStartDate" value="=">
</span>
		</label>
		<div class="<?php echo $contract_search->RightColumnClass ?>"><div <?php echo $contract_search->PlannedStartDate->cellAttributes() ?>>
			<span id="el_contract_PlannedStartDate" class="ew-search-field">
<input type="text" data-table="contract" data-field="x_PlannedStartDate" name="x_PlannedStartDate" id="x_PlannedStartDate" maxlength="10" placeholder="<?php echo HtmlEncode($contract_search->PlannedStartDate->getPlaceHolder()) ?>" value="<?php echo $contract_search->PlannedStartDate->EditValue ?>"<?php echo $contract_search->PlannedStartDate->editAttributes() ?>>
<?php if (!$contract_search->PlannedStartDate->ReadOnly && !$contract_search->PlannedStartDate->Disabled && !isset($contract_search->PlannedStartDate->EditAttrs["readonly"]) && !isset($contract_search->PlannedStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontractsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontractsearch", "x_PlannedStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_search->PlannedEndDate->Visible) { // PlannedEndDate ?>
	<div id="r_PlannedEndDate" class="form-group row">
		<label for="x_PlannedEndDate" class="<?php echo $contract_search->LeftColumnClass ?>"><span id="elh_contract_PlannedEndDate"><?php echo $contract_search->PlannedEndDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PlannedEndDate" id="z_PlannedEndDate" value="=">
</span>
		</label>
		<div class="<?php echo $contract_search->RightColumnClass ?>"><div <?php echo $contract_search->PlannedEndDate->cellAttributes() ?>>
			<span id="el_contract_PlannedEndDate" class="ew-search-field">
<input type="text" data-table="contract" data-field="x_PlannedEndDate" name="x_PlannedEndDate" id="x_PlannedEndDate" maxlength="10" placeholder="<?php echo HtmlEncode($contract_search->PlannedEndDate->getPlaceHolder()) ?>" value="<?php echo $contract_search->PlannedEndDate->EditValue ?>"<?php echo $contract_search->PlannedEndDate->editAttributes() ?>>
<?php if (!$contract_search->PlannedEndDate->ReadOnly && !$contract_search->PlannedEndDate->Disabled && !isset($contract_search->PlannedEndDate->EditAttrs["readonly"]) && !isset($contract_search->PlannedEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontractsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontractsearch", "x_PlannedEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_search->ActualStartDate->Visible) { // ActualStartDate ?>
	<div id="r_ActualStartDate" class="form-group row">
		<label for="x_ActualStartDate" class="<?php echo $contract_search->LeftColumnClass ?>"><span id="elh_contract_ActualStartDate"><?php echo $contract_search->ActualStartDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ActualStartDate" id="z_ActualStartDate" value="=">
</span>
		</label>
		<div class="<?php echo $contract_search->RightColumnClass ?>"><div <?php echo $contract_search->ActualStartDate->cellAttributes() ?>>
			<span id="el_contract_ActualStartDate" class="ew-search-field">
<input type="text" data-table="contract" data-field="x_ActualStartDate" name="x_ActualStartDate" id="x_ActualStartDate" maxlength="10" placeholder="<?php echo HtmlEncode($contract_search->ActualStartDate->getPlaceHolder()) ?>" value="<?php echo $contract_search->ActualStartDate->EditValue ?>"<?php echo $contract_search->ActualStartDate->editAttributes() ?>>
<?php if (!$contract_search->ActualStartDate->ReadOnly && !$contract_search->ActualStartDate->Disabled && !isset($contract_search->ActualStartDate->EditAttrs["readonly"]) && !isset($contract_search->ActualStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontractsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontractsearch", "x_ActualStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_search->ActualEndDate->Visible) { // ActualEndDate ?>
	<div id="r_ActualEndDate" class="form-group row">
		<label for="x_ActualEndDate" class="<?php echo $contract_search->LeftColumnClass ?>"><span id="elh_contract_ActualEndDate"><?php echo $contract_search->ActualEndDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ActualEndDate" id="z_ActualEndDate" value="=">
</span>
		</label>
		<div class="<?php echo $contract_search->RightColumnClass ?>"><div <?php echo $contract_search->ActualEndDate->cellAttributes() ?>>
			<span id="el_contract_ActualEndDate" class="ew-search-field">
<input type="text" data-table="contract" data-field="x_ActualEndDate" name="x_ActualEndDate" id="x_ActualEndDate" maxlength="10" placeholder="<?php echo HtmlEncode($contract_search->ActualEndDate->getPlaceHolder()) ?>" value="<?php echo $contract_search->ActualEndDate->EditValue ?>"<?php echo $contract_search->ActualEndDate->editAttributes() ?>>
<?php if (!$contract_search->ActualEndDate->ReadOnly && !$contract_search->ActualEndDate->Disabled && !isset($contract_search->ActualEndDate->EditAttrs["readonly"]) && !isset($contract_search->ActualEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontractsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontractsearch", "x_ActualEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_search->Duration->Visible) { // Duration ?>
	<div id="r_Duration" class="form-group row">
		<label for="x_Duration" class="<?php echo $contract_search->LeftColumnClass ?>"><span id="elh_contract_Duration"><?php echo $contract_search->Duration->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Duration" id="z_Duration" value="=">
</span>
		</label>
		<div class="<?php echo $contract_search->RightColumnClass ?>"><div <?php echo $contract_search->Duration->cellAttributes() ?>>
			<span id="el_contract_Duration" class="ew-search-field">
<input type="text" data-table="contract" data-field="x_Duration" name="x_Duration" id="x_Duration" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($contract_search->Duration->getPlaceHolder()) ?>" value="<?php echo $contract_search->Duration->EditValue ?>"<?php echo $contract_search->Duration->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_search->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<div id="r_UnitOfMeasure" class="form-group row">
		<label for="x_UnitOfMeasure" class="<?php echo $contract_search->LeftColumnClass ?>"><span id="elh_contract_UnitOfMeasure"><?php echo $contract_search->UnitOfMeasure->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_UnitOfMeasure" id="z_UnitOfMeasure" value="LIKE">
</span>
		</label>
		<div class="<?php echo $contract_search->RightColumnClass ?>"><div <?php echo $contract_search->UnitOfMeasure->cellAttributes() ?>>
			<span id="el_contract_UnitOfMeasure" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contract" data-field="x_UnitOfMeasure" data-value-separator="<?php echo $contract_search->UnitOfMeasure->displayValueSeparatorAttribute() ?>" id="x_UnitOfMeasure" name="x_UnitOfMeasure"<?php echo $contract_search->UnitOfMeasure->editAttributes() ?>>
			<?php echo $contract_search->UnitOfMeasure->selectOptionListHtml("x_UnitOfMeasure") ?>
		</select>
</div>
<?php echo $contract_search->UnitOfMeasure->Lookup->getParamTag($contract_search, "p_x_UnitOfMeasure") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_search->AdvancePaymentAmount->Visible) { // AdvancePaymentAmount ?>
	<div id="r_AdvancePaymentAmount" class="form-group row">
		<label for="x_AdvancePaymentAmount" class="<?php echo $contract_search->LeftColumnClass ?>"><span id="elh_contract_AdvancePaymentAmount"><?php echo $contract_search->AdvancePaymentAmount->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AdvancePaymentAmount" id="z_AdvancePaymentAmount" value="=">
</span>
		</label>
		<div class="<?php echo $contract_search->RightColumnClass ?>"><div <?php echo $contract_search->AdvancePaymentAmount->cellAttributes() ?>>
			<span id="el_contract_AdvancePaymentAmount" class="ew-search-field">
<input type="text" data-table="contract" data-field="x_AdvancePaymentAmount" name="x_AdvancePaymentAmount" id="x_AdvancePaymentAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($contract_search->AdvancePaymentAmount->getPlaceHolder()) ?>" value="<?php echo $contract_search->AdvancePaymentAmount->EditValue ?>"<?php echo $contract_search->AdvancePaymentAmount->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_search->AdvancePaymentdate->Visible) { // AdvancePaymentdate ?>
	<div id="r_AdvancePaymentdate" class="form-group row">
		<label for="x_AdvancePaymentdate" class="<?php echo $contract_search->LeftColumnClass ?>"><span id="elh_contract_AdvancePaymentdate"><?php echo $contract_search->AdvancePaymentdate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AdvancePaymentdate" id="z_AdvancePaymentdate" value="=">
</span>
		</label>
		<div class="<?php echo $contract_search->RightColumnClass ?>"><div <?php echo $contract_search->AdvancePaymentdate->cellAttributes() ?>>
			<span id="el_contract_AdvancePaymentdate" class="ew-search-field">
<input type="text" data-table="contract" data-field="x_AdvancePaymentdate" name="x_AdvancePaymentdate" id="x_AdvancePaymentdate" maxlength="10" placeholder="<?php echo HtmlEncode($contract_search->AdvancePaymentdate->getPlaceHolder()) ?>" value="<?php echo $contract_search->AdvancePaymentdate->EditValue ?>"<?php echo $contract_search->AdvancePaymentdate->editAttributes() ?>>
<?php if (!$contract_search->AdvancePaymentdate->ReadOnly && !$contract_search->AdvancePaymentdate->Disabled && !isset($contract_search->AdvancePaymentdate->EditAttrs["readonly"]) && !isset($contract_search->AdvancePaymentdate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontractsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontractsearch", "x_AdvancePaymentdate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contract_search->ContractStatus->Visible) { // ContractStatus ?>
	<div id="r_ContractStatus" class="form-group row">
		<label for="x_ContractStatus" class="<?php echo $contract_search->LeftColumnClass ?>"><span id="elh_contract_ContractStatus"><?php echo $contract_search->ContractStatus->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ContractStatus" id="z_ContractStatus" value="=">
</span>
		</label>
		<div class="<?php echo $contract_search->RightColumnClass ?>"><div <?php echo $contract_search->ContractStatus->cellAttributes() ?>>
			<span id="el_contract_ContractStatus" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contract" data-field="x_ContractStatus" data-value-separator="<?php echo $contract_search->ContractStatus->displayValueSeparatorAttribute() ?>" id="x_ContractStatus" name="x_ContractStatus"<?php echo $contract_search->ContractStatus->editAttributes() ?>>
			<?php echo $contract_search->ContractStatus->selectOptionListHtml("x_ContractStatus") ?>
		</select>
</div>
<?php echo $contract_search->ContractStatus->Lookup->getParamTag($contract_search, "p_x_ContractStatus") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$contract_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $contract_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$contract_search->showPageFooter();
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
$contract_search->terminate();
?>