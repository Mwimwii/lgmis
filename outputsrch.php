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
$output_search = new output_search();

// Run the page
$output_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$output_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var foutputsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($output_search->IsModal) { ?>
	foutputsearch = currentAdvancedSearchForm = new ew.Form("foutputsearch", "search");
	<?php } else { ?>
	foutputsearch = currentForm = new ew.Form("foutputsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	foutputsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ProgramCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($output_search->ProgramCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DeliveryDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($output_search->DeliveryDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_FinancialYear");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($output_search->FinancialYear->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_TargetAmount");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($output_search->TargetAmount->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ActualAmount");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($output_search->ActualAmount->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PercentAchieved");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($output_search->PercentAchieved->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	foutputsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	foutputsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	foutputsearch.lists["x_LACode"] = <?php echo $output_search->LACode->Lookup->toClientList($output_search) ?>;
	foutputsearch.lists["x_LACode"].options = <?php echo JsonEncode($output_search->LACode->lookupOptions()) ?>;
	foutputsearch.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutputsearch.lists["x_DepartmentCode"] = <?php echo $output_search->DepartmentCode->Lookup->toClientList($output_search) ?>;
	foutputsearch.lists["x_DepartmentCode"].options = <?php echo JsonEncode($output_search->DepartmentCode->lookupOptions()) ?>;
	foutputsearch.lists["x_SectionCode"] = <?php echo $output_search->SectionCode->Lookup->toClientList($output_search) ?>;
	foutputsearch.lists["x_SectionCode"].options = <?php echo JsonEncode($output_search->SectionCode->lookupOptions()) ?>;
	foutputsearch.lists["x_OutcomeCode"] = <?php echo $output_search->OutcomeCode->Lookup->toClientList($output_search) ?>;
	foutputsearch.lists["x_OutcomeCode"].options = <?php echo JsonEncode($output_search->OutcomeCode->lookupOptions()) ?>;
	foutputsearch.lists["x_ProgramCode"] = <?php echo $output_search->ProgramCode->Lookup->toClientList($output_search) ?>;
	foutputsearch.lists["x_ProgramCode"].options = <?php echo JsonEncode($output_search->ProgramCode->lookupOptions()) ?>;
	foutputsearch.autoSuggests["x_ProgramCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutputsearch.lists["x_SubProgramCode"] = <?php echo $output_search->SubProgramCode->Lookup->toClientList($output_search) ?>;
	foutputsearch.lists["x_SubProgramCode"].options = <?php echo JsonEncode($output_search->SubProgramCode->lookupOptions()) ?>;
	foutputsearch.lists["x_OutputCode"] = <?php echo $output_search->OutputCode->Lookup->toClientList($output_search) ?>;
	foutputsearch.lists["x_OutputCode"].options = <?php echo JsonEncode($output_search->OutputCode->lookupOptions()) ?>;
	foutputsearch.lists["x_OutputType"] = <?php echo $output_search->OutputType->Lookup->toClientList($output_search) ?>;
	foutputsearch.lists["x_OutputType"].options = <?php echo JsonEncode($output_search->OutputType->lookupOptions()) ?>;
	foutputsearch.lists["x_OutputStatus"] = <?php echo $output_search->OutputStatus->Lookup->toClientList($output_search) ?>;
	foutputsearch.lists["x_OutputStatus"].options = <?php echo JsonEncode($output_search->OutputStatus->lookupOptions()) ?>;
	foutputsearch.lists["x_LockStatus"] = <?php echo $output_search->LockStatus->Lookup->toClientList($output_search) ?>;
	foutputsearch.lists["x_LockStatus"].options = <?php echo JsonEncode($output_search->LockStatus->lookupOptions()) ?>;
	loadjs.done("foutputsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $output_search->showPageHeader(); ?>
<?php
$output_search->showMessage();
?>
<form name="foutputsearch" id="foutputsearch" class="<?php echo $output_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="output">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$output_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($output_search->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label class="<?php echo $output_search->LeftColumnClass ?>"><span id="elh_output_LACode"><?php echo $output_search->LACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $output_search->RightColumnClass ?>"><div <?php echo $output_search->LACode->cellAttributes() ?>>
			<span id="el_output_LACode" class="ew-search-field">
<?php
$onchange = $output_search->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_search->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($output_search->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($output_search->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_search->LACode->getPlaceHolder()) ?>"<?php echo $output_search->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_search->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($output_search->LACode->ReadOnly || $output_search->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="output" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_search->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($output_search->LACode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutputsearch"], function() {
	foutputsearch.createAutoSuggest({"id":"x_LACode","forceSelect":true});
});
</script>
<?php echo $output_search->LACode->Lookup->getParamTag($output_search, "p_x_LACode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_search->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label for="x_DepartmentCode" class="<?php echo $output_search->LeftColumnClass ?>"><span id="elh_output_DepartmentCode"><?php echo $output_search->DepartmentCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DepartmentCode" id="z_DepartmentCode" value="=">
</span>
		</label>
		<div class="<?php echo $output_search->RightColumnClass ?>"><div <?php echo $output_search->DepartmentCode->cellAttributes() ?>>
			<span id="el_output_DepartmentCode" class="ew-search-field">
<?php $output_search->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DepartmentCode"><?php echo EmptyValue(strval($output_search->DepartmentCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_search->DepartmentCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_search->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_search->DepartmentCode->ReadOnly || $output_search->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_search->DepartmentCode->Lookup->getParamTag($output_search, "p_x_DepartmentCode") ?>
<input type="hidden" data-table="output" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_search->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo $output_search->DepartmentCode->AdvancedSearch->SearchValue ?>"<?php echo $output_search->DepartmentCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_search->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label for="x_SectionCode" class="<?php echo $output_search->LeftColumnClass ?>"><span id="elh_output_SectionCode"><?php echo $output_search->SectionCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SectionCode" id="z_SectionCode" value="=">
</span>
		</label>
		<div class="<?php echo $output_search->RightColumnClass ?>"><div <?php echo $output_search->SectionCode->cellAttributes() ?>>
			<span id="el_output_SectionCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_SectionCode"><?php echo EmptyValue(strval($output_search->SectionCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_search->SectionCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_search->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_search->SectionCode->ReadOnly || $output_search->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_search->SectionCode->Lookup->getParamTag($output_search, "p_x_SectionCode") ?>
<input type="hidden" data-table="output" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_search->SectionCode->displayValueSeparatorAttribute() ?>" name="x_SectionCode" id="x_SectionCode" value="<?php echo $output_search->SectionCode->AdvancedSearch->SearchValue ?>"<?php echo $output_search->SectionCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_search->OutcomeCode->Visible) { // OutcomeCode ?>
	<div id="r_OutcomeCode" class="form-group row">
		<label for="x_OutcomeCode" class="<?php echo $output_search->LeftColumnClass ?>"><span id="elh_output_OutcomeCode"><?php echo $output_search->OutcomeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_OutcomeCode" id="z_OutcomeCode" value="=">
</span>
		</label>
		<div class="<?php echo $output_search->RightColumnClass ?>"><div <?php echo $output_search->OutcomeCode->cellAttributes() ?>>
			<span id="el_output_OutcomeCode" class="ew-search-field">
<?php $output_search->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_OutcomeCode"><?php echo EmptyValue(strval($output_search->OutcomeCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_search->OutcomeCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_search->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_search->OutcomeCode->ReadOnly || $output_search->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_search->OutcomeCode->Lookup->getParamTag($output_search, "p_x_OutcomeCode") ?>
<input type="hidden" data-table="output" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_search->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x_OutcomeCode" id="x_OutcomeCode" value="<?php echo $output_search->OutcomeCode->AdvancedSearch->SearchValue ?>"<?php echo $output_search->OutcomeCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_search->ProgramCode->Visible) { // ProgramCode ?>
	<div id="r_ProgramCode" class="form-group row">
		<label class="<?php echo $output_search->LeftColumnClass ?>"><span id="elh_output_ProgramCode"><?php echo $output_search->ProgramCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ProgramCode" id="z_ProgramCode" value="=">
</span>
		</label>
		<div class="<?php echo $output_search->RightColumnClass ?>"><div <?php echo $output_search->ProgramCode->cellAttributes() ?>>
			<span id="el_output_ProgramCode" class="ew-search-field">
<?php
$onchange = $output_search->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_search->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProgramCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ProgramCode" id="sv_x_ProgramCode" value="<?php echo RemoveHtml($output_search->ProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_search->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_search->ProgramCode->getPlaceHolder()) ?>"<?php echo $output_search->ProgramCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_search->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ProgramCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($output_search->ProgramCode->ReadOnly || $output_search->ProgramCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="output" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_search->ProgramCode->displayValueSeparatorAttribute() ?>" name="x_ProgramCode" id="x_ProgramCode" value="<?php echo HtmlEncode($output_search->ProgramCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutputsearch"], function() {
	foutputsearch.createAutoSuggest({"id":"x_ProgramCode","forceSelect":true});
});
</script>
<?php echo $output_search->ProgramCode->Lookup->getParamTag($output_search, "p_x_ProgramCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_search->SubProgramCode->Visible) { // SubProgramCode ?>
	<div id="r_SubProgramCode" class="form-group row">
		<label for="x_SubProgramCode" class="<?php echo $output_search->LeftColumnClass ?>"><span id="elh_output_SubProgramCode"><?php echo $output_search->SubProgramCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SubProgramCode" id="z_SubProgramCode" value="=">
</span>
		</label>
		<div class="<?php echo $output_search->RightColumnClass ?>"><div <?php echo $output_search->SubProgramCode->cellAttributes() ?>>
			<span id="el_output_SubProgramCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_SubProgramCode"><?php echo EmptyValue(strval($output_search->SubProgramCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_search->SubProgramCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_search->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_search->SubProgramCode->ReadOnly || $output_search->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_search->SubProgramCode->Lookup->getParamTag($output_search, "p_x_SubProgramCode") ?>
<input type="hidden" data-table="output" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_search->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x_SubProgramCode" id="x_SubProgramCode" value="<?php echo $output_search->SubProgramCode->AdvancedSearch->SearchValue ?>"<?php echo $output_search->SubProgramCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_search->OutputCode->Visible) { // OutputCode ?>
	<div id="r_OutputCode" class="form-group row">
		<label for="x_OutputCode" class="<?php echo $output_search->LeftColumnClass ?>"><span id="elh_output_OutputCode"><?php echo $output_search->OutputCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_OutputCode" id="z_OutputCode" value="=">
</span>
		</label>
		<div class="<?php echo $output_search->RightColumnClass ?>"><div <?php echo $output_search->OutputCode->cellAttributes() ?>>
			<span id="el_output_OutputCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_OutputCode"><?php echo EmptyValue(strval($output_search->OutputCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_search->OutputCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_search->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_search->OutputCode->ReadOnly || $output_search->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_search->OutputCode->Lookup->getParamTag($output_search, "p_x_OutputCode") ?>
<input type="hidden" data-table="output" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_search->OutputCode->displayValueSeparatorAttribute() ?>" name="x_OutputCode" id="x_OutputCode" value="<?php echo $output_search->OutputCode->AdvancedSearch->SearchValue ?>"<?php echo $output_search->OutputCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_search->OutputType->Visible) { // OutputType ?>
	<div id="r_OutputType" class="form-group row">
		<label for="x_OutputType" class="<?php echo $output_search->LeftColumnClass ?>"><span id="elh_output_OutputType"><?php echo $output_search->OutputType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_OutputType" id="z_OutputType" value="LIKE">
</span>
		</label>
		<div class="<?php echo $output_search->RightColumnClass ?>"><div <?php echo $output_search->OutputType->cellAttributes() ?>>
			<span id="el_output_OutputType" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="output" data-field="x_OutputType" data-value-separator="<?php echo $output_search->OutputType->displayValueSeparatorAttribute() ?>" id="x_OutputType" name="x_OutputType"<?php echo $output_search->OutputType->editAttributes() ?>>
			<?php echo $output_search->OutputType->selectOptionListHtml("x_OutputType") ?>
		</select>
</div>
<?php echo $output_search->OutputType->Lookup->getParamTag($output_search, "p_x_OutputType") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_search->OutputName->Visible) { // OutputName ?>
	<div id="r_OutputName" class="form-group row">
		<label for="x_OutputName" class="<?php echo $output_search->LeftColumnClass ?>"><span id="elh_output_OutputName"><?php echo $output_search->OutputName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_OutputName" id="z_OutputName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $output_search->RightColumnClass ?>"><div <?php echo $output_search->OutputName->cellAttributes() ?>>
			<span id="el_output_OutputName" class="ew-search-field">
<input type="text" data-table="output" data-field="x_OutputName" name="x_OutputName" id="x_OutputName" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($output_search->OutputName->getPlaceHolder()) ?>" value="<?php echo $output_search->OutputName->EditValue ?>"<?php echo $output_search->OutputName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_search->DeliveryDate->Visible) { // DeliveryDate ?>
	<div id="r_DeliveryDate" class="form-group row">
		<label for="x_DeliveryDate" class="<?php echo $output_search->LeftColumnClass ?>"><span id="elh_output_DeliveryDate"><?php echo $output_search->DeliveryDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DeliveryDate" id="z_DeliveryDate" value="=">
</span>
		</label>
		<div class="<?php echo $output_search->RightColumnClass ?>"><div <?php echo $output_search->DeliveryDate->cellAttributes() ?>>
			<span id="el_output_DeliveryDate" class="ew-search-field">
<input type="text" data-table="output" data-field="x_DeliveryDate" name="x_DeliveryDate" id="x_DeliveryDate" placeholder="<?php echo HtmlEncode($output_search->DeliveryDate->getPlaceHolder()) ?>" value="<?php echo $output_search->DeliveryDate->EditValue ?>"<?php echo $output_search->DeliveryDate->editAttributes() ?>>
<?php if (!$output_search->DeliveryDate->ReadOnly && !$output_search->DeliveryDate->Disabled && !isset($output_search->DeliveryDate->EditAttrs["readonly"]) && !isset($output_search->DeliveryDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["foutputsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("foutputsearch", "x_DeliveryDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_search->FinancialYear->Visible) { // FinancialYear ?>
	<div id="r_FinancialYear" class="form-group row">
		<label for="x_FinancialYear" class="<?php echo $output_search->LeftColumnClass ?>"><span id="elh_output_FinancialYear"><?php echo $output_search->FinancialYear->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_FinancialYear" id="z_FinancialYear" value="=">
</span>
		</label>
		<div class="<?php echo $output_search->RightColumnClass ?>"><div <?php echo $output_search->FinancialYear->cellAttributes() ?>>
			<span id="el_output_FinancialYear" class="ew-search-field">
<input type="text" data-table="output" data-field="x_FinancialYear" name="x_FinancialYear" id="x_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($output_search->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $output_search->FinancialYear->EditValue ?>"<?php echo $output_search->FinancialYear->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_search->OutputDescription->Visible) { // OutputDescription ?>
	<div id="r_OutputDescription" class="form-group row">
		<label for="x_OutputDescription" class="<?php echo $output_search->LeftColumnClass ?>"><span id="elh_output_OutputDescription"><?php echo $output_search->OutputDescription->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_OutputDescription" id="z_OutputDescription" value="LIKE">
</span>
		</label>
		<div class="<?php echo $output_search->RightColumnClass ?>"><div <?php echo $output_search->OutputDescription->cellAttributes() ?>>
			<span id="el_output_OutputDescription" class="ew-search-field">
<input type="text" data-table="output" data-field="x_OutputDescription" name="x_OutputDescription" id="x_OutputDescription" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($output_search->OutputDescription->getPlaceHolder()) ?>" value="<?php echo $output_search->OutputDescription->EditValue ?>"<?php echo $output_search->OutputDescription->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_search->OutputMeansOfVerification->Visible) { // OutputMeansOfVerification ?>
	<div id="r_OutputMeansOfVerification" class="form-group row">
		<label for="x_OutputMeansOfVerification" class="<?php echo $output_search->LeftColumnClass ?>"><span id="elh_output_OutputMeansOfVerification"><?php echo $output_search->OutputMeansOfVerification->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_OutputMeansOfVerification" id="z_OutputMeansOfVerification" value="LIKE">
</span>
		</label>
		<div class="<?php echo $output_search->RightColumnClass ?>"><div <?php echo $output_search->OutputMeansOfVerification->cellAttributes() ?>>
			<span id="el_output_OutputMeansOfVerification" class="ew-search-field">
<input type="text" data-table="output" data-field="x_OutputMeansOfVerification" name="x_OutputMeansOfVerification" id="x_OutputMeansOfVerification" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($output_search->OutputMeansOfVerification->getPlaceHolder()) ?>" value="<?php echo $output_search->OutputMeansOfVerification->EditValue ?>"<?php echo $output_search->OutputMeansOfVerification->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_search->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
	<div id="r_ResponsibleOfficer" class="form-group row">
		<label for="x_ResponsibleOfficer" class="<?php echo $output_search->LeftColumnClass ?>"><span id="elh_output_ResponsibleOfficer"><?php echo $output_search->ResponsibleOfficer->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ResponsibleOfficer" id="z_ResponsibleOfficer" value="LIKE">
</span>
		</label>
		<div class="<?php echo $output_search->RightColumnClass ?>"><div <?php echo $output_search->ResponsibleOfficer->cellAttributes() ?>>
			<span id="el_output_ResponsibleOfficer" class="ew-search-field">
<input type="text" data-table="output" data-field="x_ResponsibleOfficer" name="x_ResponsibleOfficer" id="x_ResponsibleOfficer" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($output_search->ResponsibleOfficer->getPlaceHolder()) ?>" value="<?php echo $output_search->ResponsibleOfficer->EditValue ?>"<?php echo $output_search->ResponsibleOfficer->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_search->Clients->Visible) { // Clients ?>
	<div id="r_Clients" class="form-group row">
		<label for="x_Clients" class="<?php echo $output_search->LeftColumnClass ?>"><span id="elh_output_Clients"><?php echo $output_search->Clients->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Clients" id="z_Clients" value="LIKE">
</span>
		</label>
		<div class="<?php echo $output_search->RightColumnClass ?>"><div <?php echo $output_search->Clients->cellAttributes() ?>>
			<span id="el_output_Clients" class="ew-search-field">
<input type="text" data-table="output" data-field="x_Clients" name="x_Clients" id="x_Clients" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($output_search->Clients->getPlaceHolder()) ?>" value="<?php echo $output_search->Clients->EditValue ?>"<?php echo $output_search->Clients->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_search->Beneficiaries->Visible) { // Beneficiaries ?>
	<div id="r_Beneficiaries" class="form-group row">
		<label for="x_Beneficiaries" class="<?php echo $output_search->LeftColumnClass ?>"><span id="elh_output_Beneficiaries"><?php echo $output_search->Beneficiaries->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Beneficiaries" id="z_Beneficiaries" value="LIKE">
</span>
		</label>
		<div class="<?php echo $output_search->RightColumnClass ?>"><div <?php echo $output_search->Beneficiaries->cellAttributes() ?>>
			<span id="el_output_Beneficiaries" class="ew-search-field">
<input type="text" data-table="output" data-field="x_Beneficiaries" name="x_Beneficiaries" id="x_Beneficiaries" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($output_search->Beneficiaries->getPlaceHolder()) ?>" value="<?php echo $output_search->Beneficiaries->EditValue ?>"<?php echo $output_search->Beneficiaries->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_search->OutputStatus->Visible) { // OutputStatus ?>
	<div id="r_OutputStatus" class="form-group row">
		<label for="x_OutputStatus" class="<?php echo $output_search->LeftColumnClass ?>"><span id="elh_output_OutputStatus"><?php echo $output_search->OutputStatus->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_OutputStatus" id="z_OutputStatus" value="LIKE">
</span>
		</label>
		<div class="<?php echo $output_search->RightColumnClass ?>"><div <?php echo $output_search->OutputStatus->cellAttributes() ?>>
			<span id="el_output_OutputStatus" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="output" data-field="x_OutputStatus" data-value-separator="<?php echo $output_search->OutputStatus->displayValueSeparatorAttribute() ?>" id="x_OutputStatus" name="x_OutputStatus"<?php echo $output_search->OutputStatus->editAttributes() ?>>
			<?php echo $output_search->OutputStatus->selectOptionListHtml("x_OutputStatus") ?>
		</select>
</div>
<?php echo $output_search->OutputStatus->Lookup->getParamTag($output_search, "p_x_OutputStatus") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_search->LockStatus->Visible) { // LockStatus ?>
	<div id="r_LockStatus" class="form-group row">
		<label for="x_LockStatus" class="<?php echo $output_search->LeftColumnClass ?>"><span id="elh_output_LockStatus"><?php echo $output_search->LockStatus->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LockStatus" id="z_LockStatus" value="=">
</span>
		</label>
		<div class="<?php echo $output_search->RightColumnClass ?>"><div <?php echo $output_search->LockStatus->cellAttributes() ?>>
			<span id="el_output_LockStatus" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="output" data-field="x_LockStatus" data-value-separator="<?php echo $output_search->LockStatus->displayValueSeparatorAttribute() ?>" id="x_LockStatus" name="x_LockStatus"<?php echo $output_search->LockStatus->editAttributes() ?>>
			<?php echo $output_search->LockStatus->selectOptionListHtml("x_LockStatus") ?>
		</select>
</div>
<?php echo $output_search->LockStatus->Lookup->getParamTag($output_search, "p_x_LockStatus") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_search->TargetAmount->Visible) { // TargetAmount ?>
	<div id="r_TargetAmount" class="form-group row">
		<label for="x_TargetAmount" class="<?php echo $output_search->LeftColumnClass ?>"><span id="elh_output_TargetAmount"><?php echo $output_search->TargetAmount->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_TargetAmount" id="z_TargetAmount" value="=">
</span>
		</label>
		<div class="<?php echo $output_search->RightColumnClass ?>"><div <?php echo $output_search->TargetAmount->cellAttributes() ?>>
			<span id="el_output_TargetAmount" class="ew-search-field">
<input type="text" data-table="output" data-field="x_TargetAmount" name="x_TargetAmount" id="x_TargetAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_search->TargetAmount->getPlaceHolder()) ?>" value="<?php echo $output_search->TargetAmount->EditValue ?>"<?php echo $output_search->TargetAmount->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_search->ActualAmount->Visible) { // ActualAmount ?>
	<div id="r_ActualAmount" class="form-group row">
		<label for="x_ActualAmount" class="<?php echo $output_search->LeftColumnClass ?>"><span id="elh_output_ActualAmount"><?php echo $output_search->ActualAmount->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ActualAmount" id="z_ActualAmount" value="=">
</span>
		</label>
		<div class="<?php echo $output_search->RightColumnClass ?>"><div <?php echo $output_search->ActualAmount->cellAttributes() ?>>
			<span id="el_output_ActualAmount" class="ew-search-field">
<input type="text" data-table="output" data-field="x_ActualAmount" name="x_ActualAmount" id="x_ActualAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_search->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $output_search->ActualAmount->EditValue ?>"<?php echo $output_search->ActualAmount->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_search->PercentAchieved->Visible) { // PercentAchieved ?>
	<div id="r_PercentAchieved" class="form-group row">
		<label for="x_PercentAchieved" class="<?php echo $output_search->LeftColumnClass ?>"><span id="elh_output_PercentAchieved"><?php echo $output_search->PercentAchieved->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PercentAchieved" id="z_PercentAchieved" value="=">
</span>
		</label>
		<div class="<?php echo $output_search->RightColumnClass ?>"><div <?php echo $output_search->PercentAchieved->cellAttributes() ?>>
			<span id="el_output_PercentAchieved" class="ew-search-field">
<input type="text" data-table="output" data-field="x_PercentAchieved" name="x_PercentAchieved" id="x_PercentAchieved" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_search->PercentAchieved->getPlaceHolder()) ?>" value="<?php echo $output_search->PercentAchieved->EditValue ?>"<?php echo $output_search->PercentAchieved->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$output_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $output_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$output_search->showPageFooter();
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
$output_search->terminate();
?>