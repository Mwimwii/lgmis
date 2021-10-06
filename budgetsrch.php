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
$budget_search = new budget_search();

// Run the page
$budget_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$budget_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbudgetsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($budget_search->IsModal) { ?>
	fbudgetsearch = currentAdvancedSearchForm = new ew.Form("fbudgetsearch", "search");
	<?php } else { ?>
	fbudgetsearch = currentForm = new ew.Form("fbudgetsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fbudgetsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_DetailedActionCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($budget_search->DetailedActionCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Quantity");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($budget_search->Quantity->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Frequency");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($budget_search->Frequency->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_UnitCost");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($budget_search->UnitCost->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BudgetEstimate");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($budget_search->BudgetEstimate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ActualAmount");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($budget_search->ActualAmount->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BudgetLine");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($budget_search->BudgetLine->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ApprovedBudget");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($budget_search->ApprovedBudget->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fbudgetsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbudgetsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbudgetsearch.lists["x_OutcomeCode"] = <?php echo $budget_search->OutcomeCode->Lookup->toClientList($budget_search) ?>;
	fbudgetsearch.lists["x_OutcomeCode"].options = <?php echo JsonEncode($budget_search->OutcomeCode->lookupOptions()) ?>;
	fbudgetsearch.lists["x_OutputCode"] = <?php echo $budget_search->OutputCode->Lookup->toClientList($budget_search) ?>;
	fbudgetsearch.lists["x_OutputCode"].options = <?php echo JsonEncode($budget_search->OutputCode->lookupOptions()) ?>;
	fbudgetsearch.lists["x_ActionCode"] = <?php echo $budget_search->ActionCode->Lookup->toClientList($budget_search) ?>;
	fbudgetsearch.lists["x_ActionCode"].options = <?php echo JsonEncode($budget_search->ActionCode->lookupOptions()) ?>;
	fbudgetsearch.lists["x_DetailedActionCode"] = <?php echo $budget_search->DetailedActionCode->Lookup->toClientList($budget_search) ?>;
	fbudgetsearch.lists["x_DetailedActionCode"].options = <?php echo JsonEncode($budget_search->DetailedActionCode->lookupOptions()) ?>;
	fbudgetsearch.autoSuggests["x_DetailedActionCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fbudgetsearch.lists["x_FinancialYear"] = <?php echo $budget_search->FinancialYear->Lookup->toClientList($budget_search) ?>;
	fbudgetsearch.lists["x_FinancialYear"].options = <?php echo JsonEncode($budget_search->FinancialYear->lookupOptions()) ?>;
	fbudgetsearch.lists["x_AccountCode"] = <?php echo $budget_search->AccountCode->Lookup->toClientList($budget_search) ?>;
	fbudgetsearch.lists["x_AccountCode"].options = <?php echo JsonEncode($budget_search->AccountCode->lookupOptions()) ?>;
	fbudgetsearch.lists["x_MeansOfImplementation"] = <?php echo $budget_search->MeansOfImplementation->Lookup->toClientList($budget_search) ?>;
	fbudgetsearch.lists["x_MeansOfImplementation"].options = <?php echo JsonEncode($budget_search->MeansOfImplementation->lookupOptions()) ?>;
	fbudgetsearch.lists["x_UnitOfMeasure"] = <?php echo $budget_search->UnitOfMeasure->Lookup->toClientList($budget_search) ?>;
	fbudgetsearch.lists["x_UnitOfMeasure"].options = <?php echo JsonEncode($budget_search->UnitOfMeasure->lookupOptions()) ?>;
	fbudgetsearch.lists["x_PeriodType"] = <?php echo $budget_search->PeriodType->Lookup->toClientList($budget_search) ?>;
	fbudgetsearch.lists["x_PeriodType"].options = <?php echo JsonEncode($budget_search->PeriodType->lookupOptions()) ?>;
	fbudgetsearch.lists["x_Status"] = <?php echo $budget_search->Status->Lookup->toClientList($budget_search) ?>;
	fbudgetsearch.lists["x_Status"].options = <?php echo JsonEncode($budget_search->Status->lookupOptions()) ?>;
	fbudgetsearch.autoSuggests["x_Status"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fbudgetsearch.lists["x_LACode"] = <?php echo $budget_search->LACode->Lookup->toClientList($budget_search) ?>;
	fbudgetsearch.lists["x_LACode"].options = <?php echo JsonEncode($budget_search->LACode->lookupOptions()) ?>;
	fbudgetsearch.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fbudgetsearch.lists["x_DepartmentCode"] = <?php echo $budget_search->DepartmentCode->Lookup->toClientList($budget_search) ?>;
	fbudgetsearch.lists["x_DepartmentCode"].options = <?php echo JsonEncode($budget_search->DepartmentCode->lookupOptions()) ?>;
	fbudgetsearch.lists["x_SectionCode"] = <?php echo $budget_search->SectionCode->Lookup->toClientList($budget_search) ?>;
	fbudgetsearch.lists["x_SectionCode"].options = <?php echo JsonEncode($budget_search->SectionCode->lookupOptions()) ?>;
	fbudgetsearch.lists["x_ProgramCode"] = <?php echo $budget_search->ProgramCode->Lookup->toClientList($budget_search) ?>;
	fbudgetsearch.lists["x_ProgramCode"].options = <?php echo JsonEncode($budget_search->ProgramCode->lookupOptions()) ?>;
	fbudgetsearch.lists["x_SubProgramCode"] = <?php echo $budget_search->SubProgramCode->Lookup->toClientList($budget_search) ?>;
	fbudgetsearch.lists["x_SubProgramCode"].options = <?php echo JsonEncode($budget_search->SubProgramCode->lookupOptions()) ?>;
	loadjs.done("fbudgetsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $budget_search->showPageHeader(); ?>
<?php
$budget_search->showMessage();
?>
<form name="fbudgetsearch" id="fbudgetsearch" class="<?php echo $budget_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="budget">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$budget_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($budget_search->OutcomeCode->Visible) { // OutcomeCode ?>
	<div id="r_OutcomeCode" class="form-group row">
		<label for="x_OutcomeCode" class="<?php echo $budget_search->LeftColumnClass ?>"><span id="elh_budget_OutcomeCode"><?php echo $budget_search->OutcomeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_OutcomeCode" id="z_OutcomeCode" value="=">
</span>
		</label>
		<div class="<?php echo $budget_search->RightColumnClass ?>"><div <?php echo $budget_search->OutcomeCode->cellAttributes() ?>>
			<span id="el_budget_OutcomeCode" class="ew-search-field">
<?php $budget_search->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_OutcomeCode"><?php echo EmptyValue(strval($budget_search->OutcomeCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_search->OutcomeCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_search->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_search->OutcomeCode->ReadOnly || $budget_search->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_search->OutcomeCode->Lookup->getParamTag($budget_search, "p_x_OutcomeCode") ?>
<input type="hidden" data-table="budget" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_search->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x_OutcomeCode" id="x_OutcomeCode" value="<?php echo $budget_search->OutcomeCode->AdvancedSearch->SearchValue ?>"<?php echo $budget_search->OutcomeCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_search->OutputCode->Visible) { // OutputCode ?>
	<div id="r_OutputCode" class="form-group row">
		<label for="x_OutputCode" class="<?php echo $budget_search->LeftColumnClass ?>"><span id="elh_budget_OutputCode"><?php echo $budget_search->OutputCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_OutputCode" id="z_OutputCode" value="=">
</span>
		</label>
		<div class="<?php echo $budget_search->RightColumnClass ?>"><div <?php echo $budget_search->OutputCode->cellAttributes() ?>>
			<span id="el_budget_OutputCode" class="ew-search-field">
<?php $budget_search->OutputCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_OutputCode"><?php echo EmptyValue(strval($budget_search->OutputCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_search->OutputCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_search->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_search->OutputCode->ReadOnly || $budget_search->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_search->OutputCode->Lookup->getParamTag($budget_search, "p_x_OutputCode") ?>
<input type="hidden" data-table="budget" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_search->OutputCode->displayValueSeparatorAttribute() ?>" name="x_OutputCode" id="x_OutputCode" value="<?php echo $budget_search->OutputCode->AdvancedSearch->SearchValue ?>"<?php echo $budget_search->OutputCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_search->ActionCode->Visible) { // ActionCode ?>
	<div id="r_ActionCode" class="form-group row">
		<label for="x_ActionCode" class="<?php echo $budget_search->LeftColumnClass ?>"><span id="elh_budget_ActionCode"><?php echo $budget_search->ActionCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ActionCode" id="z_ActionCode" value="=">
</span>
		</label>
		<div class="<?php echo $budget_search->RightColumnClass ?>"><div <?php echo $budget_search->ActionCode->cellAttributes() ?>>
			<span id="el_budget_ActionCode" class="ew-search-field">
<?php $budget_search->ActionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_ActionCode" data-value-separator="<?php echo $budget_search->ActionCode->displayValueSeparatorAttribute() ?>" id="x_ActionCode" name="x_ActionCode"<?php echo $budget_search->ActionCode->editAttributes() ?>>
			<?php echo $budget_search->ActionCode->selectOptionListHtml("x_ActionCode") ?>
		</select>
</div>
<?php echo $budget_search->ActionCode->Lookup->getParamTag($budget_search, "p_x_ActionCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_search->DetailedActionCode->Visible) { // DetailedActionCode ?>
	<div id="r_DetailedActionCode" class="form-group row">
		<label class="<?php echo $budget_search->LeftColumnClass ?>"><span id="elh_budget_DetailedActionCode"><?php echo $budget_search->DetailedActionCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DetailedActionCode" id="z_DetailedActionCode" value="=">
</span>
		</label>
		<div class="<?php echo $budget_search->RightColumnClass ?>"><div <?php echo $budget_search->DetailedActionCode->cellAttributes() ?>>
			<span id="el_budget_DetailedActionCode" class="ew-search-field">
<?php
$onchange = $budget_search->DetailedActionCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_search->DetailedActionCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_DetailedActionCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_DetailedActionCode" id="sv_x_DetailedActionCode" value="<?php echo RemoveHtml($budget_search->DetailedActionCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($budget_search->DetailedActionCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_search->DetailedActionCode->getPlaceHolder()) ?>"<?php echo $budget_search->DetailedActionCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_search->DetailedActionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_DetailedActionCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($budget_search->DetailedActionCode->ReadOnly || $budget_search->DetailedActionCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="budget" data-field="x_DetailedActionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_search->DetailedActionCode->displayValueSeparatorAttribute() ?>" name="x_DetailedActionCode" id="x_DetailedActionCode" value="<?php echo HtmlEncode($budget_search->DetailedActionCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudgetsearch"], function() {
	fbudgetsearch.createAutoSuggest({"id":"x_DetailedActionCode","forceSelect":false});
});
</script>
<?php echo $budget_search->DetailedActionCode->Lookup->getParamTag($budget_search, "p_x_DetailedActionCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_search->FinancialYear->Visible) { // FinancialYear ?>
	<div id="r_FinancialYear" class="form-group row">
		<label for="x_FinancialYear" class="<?php echo $budget_search->LeftColumnClass ?>"><span id="elh_budget_FinancialYear"><?php echo $budget_search->FinancialYear->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_FinancialYear" id="z_FinancialYear" value="=">
</span>
		</label>
		<div class="<?php echo $budget_search->RightColumnClass ?>"><div <?php echo $budget_search->FinancialYear->cellAttributes() ?>>
			<span id="el_budget_FinancialYear" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_FinancialYear" data-value-separator="<?php echo $budget_search->FinancialYear->displayValueSeparatorAttribute() ?>" id="x_FinancialYear" name="x_FinancialYear"<?php echo $budget_search->FinancialYear->editAttributes() ?>>
			<?php echo $budget_search->FinancialYear->selectOptionListHtml("x_FinancialYear") ?>
		</select>
</div>
<?php echo $budget_search->FinancialYear->Lookup->getParamTag($budget_search, "p_x_FinancialYear") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_search->AccountCode->Visible) { // AccountCode ?>
	<div id="r_AccountCode" class="form-group row">
		<label for="x_AccountCode" class="<?php echo $budget_search->LeftColumnClass ?>"><span id="elh_budget_AccountCode"><?php echo $budget_search->AccountCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AccountCode" id="z_AccountCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $budget_search->RightColumnClass ?>"><div <?php echo $budget_search->AccountCode->cellAttributes() ?>>
			<span id="el_budget_AccountCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_AccountCode"><?php echo EmptyValue(strval($budget_search->AccountCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_search->AccountCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_search->AccountCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_search->AccountCode->ReadOnly || $budget_search->AccountCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_AccountCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_search->AccountCode->Lookup->getParamTag($budget_search, "p_x_AccountCode") ?>
<input type="hidden" data-table="budget" data-field="x_AccountCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_search->AccountCode->displayValueSeparatorAttribute() ?>" name="x_AccountCode" id="x_AccountCode" value="<?php echo $budget_search->AccountCode->AdvancedSearch->SearchValue ?>"<?php echo $budget_search->AccountCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_search->MeansOfImplementation->Visible) { // MeansOfImplementation ?>
	<div id="r_MeansOfImplementation" class="form-group row">
		<label for="x_MeansOfImplementation" class="<?php echo $budget_search->LeftColumnClass ?>"><span id="elh_budget_MeansOfImplementation"><?php echo $budget_search->MeansOfImplementation->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_MeansOfImplementation" id="z_MeansOfImplementation" value="=">
</span>
		</label>
		<div class="<?php echo $budget_search->RightColumnClass ?>"><div <?php echo $budget_search->MeansOfImplementation->cellAttributes() ?>>
			<span id="el_budget_MeansOfImplementation" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_MeansOfImplementation"><?php echo EmptyValue(strval($budget_search->MeansOfImplementation->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_search->MeansOfImplementation->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_search->MeansOfImplementation->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_search->MeansOfImplementation->ReadOnly || $budget_search->MeansOfImplementation->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_MeansOfImplementation',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_search->MeansOfImplementation->Lookup->getParamTag($budget_search, "p_x_MeansOfImplementation") ?>
<input type="hidden" data-table="budget" data-field="x_MeansOfImplementation" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_search->MeansOfImplementation->displayValueSeparatorAttribute() ?>" name="x_MeansOfImplementation" id="x_MeansOfImplementation" value="<?php echo $budget_search->MeansOfImplementation->AdvancedSearch->SearchValue ?>"<?php echo $budget_search->MeansOfImplementation->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_search->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<div id="r_UnitOfMeasure" class="form-group row">
		<label for="x_UnitOfMeasure" class="<?php echo $budget_search->LeftColumnClass ?>"><span id="elh_budget_UnitOfMeasure"><?php echo $budget_search->UnitOfMeasure->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_UnitOfMeasure" id="z_UnitOfMeasure" value="LIKE">
</span>
		</label>
		<div class="<?php echo $budget_search->RightColumnClass ?>"><div <?php echo $budget_search->UnitOfMeasure->cellAttributes() ?>>
			<span id="el_budget_UnitOfMeasure" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_UnitOfMeasure" data-value-separator="<?php echo $budget_search->UnitOfMeasure->displayValueSeparatorAttribute() ?>" id="x_UnitOfMeasure" name="x_UnitOfMeasure"<?php echo $budget_search->UnitOfMeasure->editAttributes() ?>>
			<?php echo $budget_search->UnitOfMeasure->selectOptionListHtml("x_UnitOfMeasure") ?>
		</select>
</div>
<?php echo $budget_search->UnitOfMeasure->Lookup->getParamTag($budget_search, "p_x_UnitOfMeasure") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_search->Quantity->Visible) { // Quantity ?>
	<div id="r_Quantity" class="form-group row">
		<label for="x_Quantity" class="<?php echo $budget_search->LeftColumnClass ?>"><span id="elh_budget_Quantity"><?php echo $budget_search->Quantity->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Quantity" id="z_Quantity" value="=">
</span>
		</label>
		<div class="<?php echo $budget_search->RightColumnClass ?>"><div <?php echo $budget_search->Quantity->cellAttributes() ?>>
			<span id="el_budget_Quantity" class="ew-search-field">
<input type="text" data-table="budget" data-field="x_Quantity" name="x_Quantity" id="x_Quantity" size="30" placeholder="<?php echo HtmlEncode($budget_search->Quantity->getPlaceHolder()) ?>" value="<?php echo $budget_search->Quantity->EditValue ?>"<?php echo $budget_search->Quantity->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_search->PeriodType->Visible) { // PeriodType ?>
	<div id="r_PeriodType" class="form-group row">
		<label for="x_PeriodType" class="<?php echo $budget_search->LeftColumnClass ?>"><span id="elh_budget_PeriodType"><?php echo $budget_search->PeriodType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PeriodType" id="z_PeriodType" value="LIKE">
</span>
		</label>
		<div class="<?php echo $budget_search->RightColumnClass ?>"><div <?php echo $budget_search->PeriodType->cellAttributes() ?>>
			<span id="el_budget_PeriodType" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_PeriodType" data-value-separator="<?php echo $budget_search->PeriodType->displayValueSeparatorAttribute() ?>" id="x_PeriodType" name="x_PeriodType"<?php echo $budget_search->PeriodType->editAttributes() ?>>
			<?php echo $budget_search->PeriodType->selectOptionListHtml("x_PeriodType") ?>
		</select>
</div>
<?php echo $budget_search->PeriodType->Lookup->getParamTag($budget_search, "p_x_PeriodType") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_search->PeriodLength->Visible) { // PeriodLength ?>
	<div id="r_PeriodLength" class="form-group row">
		<label for="x_PeriodLength" class="<?php echo $budget_search->LeftColumnClass ?>"><span id="elh_budget_PeriodLength"><?php echo $budget_search->PeriodLength->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PeriodLength" id="z_PeriodLength" value="=">
</span>
		</label>
		<div class="<?php echo $budget_search->RightColumnClass ?>"><div <?php echo $budget_search->PeriodLength->cellAttributes() ?>>
			<span id="el_budget_PeriodLength" class="ew-search-field">
<input type="text" data-table="budget" data-field="x_PeriodLength" name="x_PeriodLength" id="x_PeriodLength" size="30" placeholder="<?php echo HtmlEncode($budget_search->PeriodLength->getPlaceHolder()) ?>" value="<?php echo $budget_search->PeriodLength->EditValue ?>"<?php echo $budget_search->PeriodLength->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_search->Frequency->Visible) { // Frequency ?>
	<div id="r_Frequency" class="form-group row">
		<label for="x_Frequency" class="<?php echo $budget_search->LeftColumnClass ?>"><span id="elh_budget_Frequency"><?php echo $budget_search->Frequency->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Frequency" id="z_Frequency" value="=">
</span>
		</label>
		<div class="<?php echo $budget_search->RightColumnClass ?>"><div <?php echo $budget_search->Frequency->cellAttributes() ?>>
			<span id="el_budget_Frequency" class="ew-search-field">
<input type="text" data-table="budget" data-field="x_Frequency" name="x_Frequency" id="x_Frequency" size="30" placeholder="<?php echo HtmlEncode($budget_search->Frequency->getPlaceHolder()) ?>" value="<?php echo $budget_search->Frequency->EditValue ?>"<?php echo $budget_search->Frequency->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_search->UnitCost->Visible) { // UnitCost ?>
	<div id="r_UnitCost" class="form-group row">
		<label for="x_UnitCost" class="<?php echo $budget_search->LeftColumnClass ?>"><span id="elh_budget_UnitCost"><?php echo $budget_search->UnitCost->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_UnitCost" id="z_UnitCost" value="=">
</span>
		</label>
		<div class="<?php echo $budget_search->RightColumnClass ?>"><div <?php echo $budget_search->UnitCost->cellAttributes() ?>>
			<span id="el_budget_UnitCost" class="ew-search-field">
<input type="text" data-table="budget" data-field="x_UnitCost" name="x_UnitCost" id="x_UnitCost" size="30" placeholder="<?php echo HtmlEncode($budget_search->UnitCost->getPlaceHolder()) ?>" value="<?php echo $budget_search->UnitCost->EditValue ?>"<?php echo $budget_search->UnitCost->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_search->BudgetEstimate->Visible) { // BudgetEstimate ?>
	<div id="r_BudgetEstimate" class="form-group row">
		<label for="x_BudgetEstimate" class="<?php echo $budget_search->LeftColumnClass ?>"><span id="elh_budget_BudgetEstimate"><?php echo $budget_search->BudgetEstimate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BudgetEstimate" id="z_BudgetEstimate" value="=">
</span>
		</label>
		<div class="<?php echo $budget_search->RightColumnClass ?>"><div <?php echo $budget_search->BudgetEstimate->cellAttributes() ?>>
			<span id="el_budget_BudgetEstimate" class="ew-search-field">
<input type="text" data-table="budget" data-field="x_BudgetEstimate" name="x_BudgetEstimate" id="x_BudgetEstimate" size="30" placeholder="<?php echo HtmlEncode($budget_search->BudgetEstimate->getPlaceHolder()) ?>" value="<?php echo $budget_search->BudgetEstimate->EditValue ?>"<?php echo $budget_search->BudgetEstimate->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_search->ActualAmount->Visible) { // ActualAmount ?>
	<div id="r_ActualAmount" class="form-group row">
		<label for="x_ActualAmount" class="<?php echo $budget_search->LeftColumnClass ?>"><span id="elh_budget_ActualAmount"><?php echo $budget_search->ActualAmount->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ActualAmount" id="z_ActualAmount" value="=">
</span>
		</label>
		<div class="<?php echo $budget_search->RightColumnClass ?>"><div <?php echo $budget_search->ActualAmount->cellAttributes() ?>>
			<span id="el_budget_ActualAmount" class="ew-search-field">
<input type="text" data-table="budget" data-field="x_ActualAmount" name="x_ActualAmount" id="x_ActualAmount" size="30" placeholder="<?php echo HtmlEncode($budget_search->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $budget_search->ActualAmount->EditValue ?>"<?php echo $budget_search->ActualAmount->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_search->Status->Visible) { // Status ?>
	<div id="r_Status" class="form-group row">
		<label class="<?php echo $budget_search->LeftColumnClass ?>"><span id="elh_budget_Status"><?php echo $budget_search->Status->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Status" id="z_Status" value="LIKE">
</span>
		</label>
		<div class="<?php echo $budget_search->RightColumnClass ?>"><div <?php echo $budget_search->Status->cellAttributes() ?>>
			<span id="el_budget_Status" class="ew-search-field">
<?php
$onchange = $budget_search->Status->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_search->Status->EditAttrs["onchange"] = "";
?>
<span id="as_x_Status">
	<input type="text" class="form-control" name="sv_x_Status" id="sv_x_Status" value="<?php echo RemoveHtml($budget_search->Status->EditValue) ?>" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($budget_search->Status->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_search->Status->getPlaceHolder()) ?>"<?php echo $budget_search->Status->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget" data-field="x_Status" data-value-separator="<?php echo $budget_search->Status->displayValueSeparatorAttribute() ?>" name="x_Status" id="x_Status" value="<?php echo HtmlEncode($budget_search->Status->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudgetsearch"], function() {
	fbudgetsearch.createAutoSuggest({"id":"x_Status","forceSelect":false});
});
</script>
<?php echo $budget_search->Status->Lookup->getParamTag($budget_search, "p_x_Status") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_search->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label class="<?php echo $budget_search->LeftColumnClass ?>"><span id="elh_budget_LACode"><?php echo $budget_search->LACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $budget_search->RightColumnClass ?>"><div <?php echo $budget_search->LACode->cellAttributes() ?>>
			<span id="el_budget_LACode" class="ew-search-field">
<?php
$onchange = $budget_search->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_search->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($budget_search->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($budget_search->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_search->LACode->getPlaceHolder()) ?>"<?php echo $budget_search->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_search->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($budget_search->LACode->ReadOnly || $budget_search->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="budget" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_search->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($budget_search->LACode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudgetsearch"], function() {
	fbudgetsearch.createAutoSuggest({"id":"x_LACode","forceSelect":false});
});
</script>
<?php echo $budget_search->LACode->Lookup->getParamTag($budget_search, "p_x_LACode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_search->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label for="x_DepartmentCode" class="<?php echo $budget_search->LeftColumnClass ?>"><span id="elh_budget_DepartmentCode"><?php echo $budget_search->DepartmentCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DepartmentCode" id="z_DepartmentCode" value="=">
</span>
		</label>
		<div class="<?php echo $budget_search->RightColumnClass ?>"><div <?php echo $budget_search->DepartmentCode->cellAttributes() ?>>
			<span id="el_budget_DepartmentCode" class="ew-search-field">
<?php $budget_search->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_DepartmentCode" data-value-separator="<?php echo $budget_search->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $budget_search->DepartmentCode->editAttributes() ?>>
			<?php echo $budget_search->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $budget_search->DepartmentCode->Lookup->getParamTag($budget_search, "p_x_DepartmentCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_search->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label for="x_SectionCode" class="<?php echo $budget_search->LeftColumnClass ?>"><span id="elh_budget_SectionCode"><?php echo $budget_search->SectionCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SectionCode" id="z_SectionCode" value="=">
</span>
		</label>
		<div class="<?php echo $budget_search->RightColumnClass ?>"><div <?php echo $budget_search->SectionCode->cellAttributes() ?>>
			<span id="el_budget_SectionCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_SectionCode" data-value-separator="<?php echo $budget_search->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $budget_search->SectionCode->editAttributes() ?>>
			<?php echo $budget_search->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $budget_search->SectionCode->Lookup->getParamTag($budget_search, "p_x_SectionCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_search->BudgetLine->Visible) { // BudgetLine ?>
	<div id="r_BudgetLine" class="form-group row">
		<label for="x_BudgetLine" class="<?php echo $budget_search->LeftColumnClass ?>"><span id="elh_budget_BudgetLine"><?php echo $budget_search->BudgetLine->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BudgetLine" id="z_BudgetLine" value="=">
</span>
		</label>
		<div class="<?php echo $budget_search->RightColumnClass ?>"><div <?php echo $budget_search->BudgetLine->cellAttributes() ?>>
			<span id="el_budget_BudgetLine" class="ew-search-field">
<input type="text" data-table="budget" data-field="x_BudgetLine" name="x_BudgetLine" id="x_BudgetLine" placeholder="<?php echo HtmlEncode($budget_search->BudgetLine->getPlaceHolder()) ?>" value="<?php echo $budget_search->BudgetLine->EditValue ?>"<?php echo $budget_search->BudgetLine->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_search->ProgramCode->Visible) { // ProgramCode ?>
	<div id="r_ProgramCode" class="form-group row">
		<label for="x_ProgramCode" class="<?php echo $budget_search->LeftColumnClass ?>"><span id="elh_budget_ProgramCode"><?php echo $budget_search->ProgramCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ProgramCode" id="z_ProgramCode" value="=">
</span>
		</label>
		<div class="<?php echo $budget_search->RightColumnClass ?>"><div <?php echo $budget_search->ProgramCode->cellAttributes() ?>>
			<span id="el_budget_ProgramCode" class="ew-search-field">
<?php $budget_search->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ProgramCode"><?php echo EmptyValue(strval($budget_search->ProgramCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_search->ProgramCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_search->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_search->ProgramCode->ReadOnly || $budget_search->ProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_search->ProgramCode->Lookup->getParamTag($budget_search, "p_x_ProgramCode") ?>
<input type="hidden" data-table="budget" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_search->ProgramCode->displayValueSeparatorAttribute() ?>" name="x_ProgramCode" id="x_ProgramCode" value="<?php echo $budget_search->ProgramCode->AdvancedSearch->SearchValue ?>"<?php echo $budget_search->ProgramCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_search->SubProgramCode->Visible) { // SubProgramCode ?>
	<div id="r_SubProgramCode" class="form-group row">
		<label for="x_SubProgramCode" class="<?php echo $budget_search->LeftColumnClass ?>"><span id="elh_budget_SubProgramCode"><?php echo $budget_search->SubProgramCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SubProgramCode" id="z_SubProgramCode" value="=">
</span>
		</label>
		<div class="<?php echo $budget_search->RightColumnClass ?>"><div <?php echo $budget_search->SubProgramCode->cellAttributes() ?>>
			<span id="el_budget_SubProgramCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_SubProgramCode"><?php echo EmptyValue(strval($budget_search->SubProgramCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_search->SubProgramCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_search->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_search->SubProgramCode->ReadOnly || $budget_search->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_search->SubProgramCode->Lookup->getParamTag($budget_search, "p_x_SubProgramCode") ?>
<input type="hidden" data-table="budget" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_search->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x_SubProgramCode" id="x_SubProgramCode" value="<?php echo $budget_search->SubProgramCode->AdvancedSearch->SearchValue ?>"<?php echo $budget_search->SubProgramCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_search->ApprovedBudget->Visible) { // ApprovedBudget ?>
	<div id="r_ApprovedBudget" class="form-group row">
		<label for="x_ApprovedBudget" class="<?php echo $budget_search->LeftColumnClass ?>"><span id="elh_budget_ApprovedBudget"><?php echo $budget_search->ApprovedBudget->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ApprovedBudget" id="z_ApprovedBudget" value="=">
</span>
		</label>
		<div class="<?php echo $budget_search->RightColumnClass ?>"><div <?php echo $budget_search->ApprovedBudget->cellAttributes() ?>>
			<span id="el_budget_ApprovedBudget" class="ew-search-field">
<input type="text" data-table="budget" data-field="x_ApprovedBudget" name="x_ApprovedBudget" id="x_ApprovedBudget" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($budget_search->ApprovedBudget->getPlaceHolder()) ?>" value="<?php echo $budget_search->ApprovedBudget->EditValue ?>"<?php echo $budget_search->ApprovedBudget->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$budget_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $budget_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$budget_search->showPageFooter();
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
$budget_search->terminate();
?>