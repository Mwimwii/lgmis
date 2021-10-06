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
$output_indicator_search = new output_indicator_search();

// Run the page
$output_indicator_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$output_indicator_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var foutput_indicatorsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($output_indicator_search->IsModal) { ?>
	foutput_indicatorsearch = currentAdvancedSearchForm = new ew.Form("foutput_indicatorsearch", "search");
	<?php } else { ?>
	foutput_indicatorsearch = currentForm = new ew.Form("foutput_indicatorsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	foutput_indicatorsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_IndicatorNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($output_indicator_search->IndicatorNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DepartmentCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($output_indicator_search->DepartmentCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_SectionCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($output_indicator_search->SectionCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_OutputCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($output_indicator_search->OutputCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_OutcomeCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($output_indicator_search->OutcomeCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ProgramCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($output_indicator_search->ProgramCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_SubProgramCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($output_indicator_search->SubProgramCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_FinancialYear");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($output_indicator_search->FinancialYear->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_TargetAmount");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($output_indicator_search->TargetAmount->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ActualAmount");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($output_indicator_search->ActualAmount->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PercentAchieved");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($output_indicator_search->PercentAchieved->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	foutput_indicatorsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	foutput_indicatorsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	foutput_indicatorsearch.lists["x_LACode"] = <?php echo $output_indicator_search->LACode->Lookup->toClientList($output_indicator_search) ?>;
	foutput_indicatorsearch.lists["x_LACode"].options = <?php echo JsonEncode($output_indicator_search->LACode->lookupOptions()) ?>;
	foutput_indicatorsearch.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatorsearch.lists["x_DepartmentCode"] = <?php echo $output_indicator_search->DepartmentCode->Lookup->toClientList($output_indicator_search) ?>;
	foutput_indicatorsearch.lists["x_DepartmentCode"].options = <?php echo JsonEncode($output_indicator_search->DepartmentCode->lookupOptions()) ?>;
	foutput_indicatorsearch.autoSuggests["x_DepartmentCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatorsearch.lists["x_SectionCode"] = <?php echo $output_indicator_search->SectionCode->Lookup->toClientList($output_indicator_search) ?>;
	foutput_indicatorsearch.lists["x_SectionCode"].options = <?php echo JsonEncode($output_indicator_search->SectionCode->lookupOptions()) ?>;
	foutput_indicatorsearch.autoSuggests["x_SectionCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatorsearch.lists["x_OutputCode"] = <?php echo $output_indicator_search->OutputCode->Lookup->toClientList($output_indicator_search) ?>;
	foutput_indicatorsearch.lists["x_OutputCode"].options = <?php echo JsonEncode($output_indicator_search->OutputCode->lookupOptions()) ?>;
	foutput_indicatorsearch.autoSuggests["x_OutputCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatorsearch.lists["x_OutcomeCode"] = <?php echo $output_indicator_search->OutcomeCode->Lookup->toClientList($output_indicator_search) ?>;
	foutput_indicatorsearch.lists["x_OutcomeCode"].options = <?php echo JsonEncode($output_indicator_search->OutcomeCode->lookupOptions()) ?>;
	foutput_indicatorsearch.autoSuggests["x_OutcomeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatorsearch.lists["x_OutputType"] = <?php echo $output_indicator_search->OutputType->Lookup->toClientList($output_indicator_search) ?>;
	foutput_indicatorsearch.lists["x_OutputType"].options = <?php echo JsonEncode($output_indicator_search->OutputType->lookupOptions()) ?>;
	foutput_indicatorsearch.autoSuggests["x_OutputType"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatorsearch.lists["x_ProgramCode"] = <?php echo $output_indicator_search->ProgramCode->Lookup->toClientList($output_indicator_search) ?>;
	foutput_indicatorsearch.lists["x_ProgramCode"].options = <?php echo JsonEncode($output_indicator_search->ProgramCode->lookupOptions()) ?>;
	foutput_indicatorsearch.autoSuggests["x_ProgramCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatorsearch.lists["x_SubProgramCode"] = <?php echo $output_indicator_search->SubProgramCode->Lookup->toClientList($output_indicator_search) ?>;
	foutput_indicatorsearch.lists["x_SubProgramCode"].options = <?php echo JsonEncode($output_indicator_search->SubProgramCode->lookupOptions()) ?>;
	foutput_indicatorsearch.autoSuggests["x_SubProgramCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("foutput_indicatorsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $output_indicator_search->showPageHeader(); ?>
<?php
$output_indicator_search->showMessage();
?>
<form name="foutput_indicatorsearch" id="foutput_indicatorsearch" class="<?php echo $output_indicator_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="output_indicator">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$output_indicator_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($output_indicator_search->IndicatorNo->Visible) { // IndicatorNo ?>
	<div id="r_IndicatorNo" class="form-group row">
		<label for="x_IndicatorNo" class="<?php echo $output_indicator_search->LeftColumnClass ?>"><span id="elh_output_indicator_IndicatorNo"><?php echo $output_indicator_search->IndicatorNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_IndicatorNo" id="z_IndicatorNo" value="=">
</span>
		</label>
		<div class="<?php echo $output_indicator_search->RightColumnClass ?>"><div <?php echo $output_indicator_search->IndicatorNo->cellAttributes() ?>>
			<span id="el_output_indicator_IndicatorNo" class="ew-search-field">
<input type="text" data-table="output_indicator" data-field="x_IndicatorNo" name="x_IndicatorNo" id="x_IndicatorNo" placeholder="<?php echo HtmlEncode($output_indicator_search->IndicatorNo->getPlaceHolder()) ?>" value="<?php echo $output_indicator_search->IndicatorNo->EditValue ?>"<?php echo $output_indicator_search->IndicatorNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_search->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label class="<?php echo $output_indicator_search->LeftColumnClass ?>"><span id="elh_output_indicator_LACode"><?php echo $output_indicator_search->LACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $output_indicator_search->RightColumnClass ?>"><div <?php echo $output_indicator_search->LACode->cellAttributes() ?>>
			<span id="el_output_indicator_LACode" class="ew-search-field">
<?php
$onchange = $output_indicator_search->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_search->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($output_indicator_search->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($output_indicator_search->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_search->LACode->getPlaceHolder()) ?>"<?php echo $output_indicator_search->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_LACode" data-value-separator="<?php echo $output_indicator_search->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($output_indicator_search->LACode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorsearch"], function() {
	foutput_indicatorsearch.createAutoSuggest({"id":"x_LACode","forceSelect":false});
});
</script>
<?php echo $output_indicator_search->LACode->Lookup->getParamTag($output_indicator_search, "p_x_LACode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_search->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label class="<?php echo $output_indicator_search->LeftColumnClass ?>"><span id="elh_output_indicator_DepartmentCode"><?php echo $output_indicator_search->DepartmentCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DepartmentCode" id="z_DepartmentCode" value="=">
</span>
		</label>
		<div class="<?php echo $output_indicator_search->RightColumnClass ?>"><div <?php echo $output_indicator_search->DepartmentCode->cellAttributes() ?>>
			<span id="el_output_indicator_DepartmentCode" class="ew-search-field">
<?php
$onchange = $output_indicator_search->DepartmentCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_search->DepartmentCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_DepartmentCode">
	<input type="text" class="form-control" name="sv_x_DepartmentCode" id="sv_x_DepartmentCode" value="<?php echo RemoveHtml($output_indicator_search->DepartmentCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_search->DepartmentCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_search->DepartmentCode->getPlaceHolder()) ?>"<?php echo $output_indicator_search->DepartmentCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_DepartmentCode" data-value-separator="<?php echo $output_indicator_search->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo HtmlEncode($output_indicator_search->DepartmentCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorsearch"], function() {
	foutput_indicatorsearch.createAutoSuggest({"id":"x_DepartmentCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_search->DepartmentCode->Lookup->getParamTag($output_indicator_search, "p_x_DepartmentCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_search->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label class="<?php echo $output_indicator_search->LeftColumnClass ?>"><span id="elh_output_indicator_SectionCode"><?php echo $output_indicator_search->SectionCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SectionCode" id="z_SectionCode" value="=">
</span>
		</label>
		<div class="<?php echo $output_indicator_search->RightColumnClass ?>"><div <?php echo $output_indicator_search->SectionCode->cellAttributes() ?>>
			<span id="el_output_indicator_SectionCode" class="ew-search-field">
<?php
$onchange = $output_indicator_search->SectionCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_search->SectionCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_SectionCode">
	<input type="text" class="form-control" name="sv_x_SectionCode" id="sv_x_SectionCode" value="<?php echo RemoveHtml($output_indicator_search->SectionCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_search->SectionCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_search->SectionCode->getPlaceHolder()) ?>"<?php echo $output_indicator_search->SectionCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SectionCode" data-value-separator="<?php echo $output_indicator_search->SectionCode->displayValueSeparatorAttribute() ?>" name="x_SectionCode" id="x_SectionCode" value="<?php echo HtmlEncode($output_indicator_search->SectionCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorsearch"], function() {
	foutput_indicatorsearch.createAutoSuggest({"id":"x_SectionCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_search->SectionCode->Lookup->getParamTag($output_indicator_search, "p_x_SectionCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_search->OutputCode->Visible) { // OutputCode ?>
	<div id="r_OutputCode" class="form-group row">
		<label class="<?php echo $output_indicator_search->LeftColumnClass ?>"><span id="elh_output_indicator_OutputCode"><?php echo $output_indicator_search->OutputCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_OutputCode" id="z_OutputCode" value="=">
</span>
		</label>
		<div class="<?php echo $output_indicator_search->RightColumnClass ?>"><div <?php echo $output_indicator_search->OutputCode->cellAttributes() ?>>
			<span id="el_output_indicator_OutputCode" class="ew-search-field">
<?php
$onchange = $output_indicator_search->OutputCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_search->OutputCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_OutputCode">
	<input type="text" class="form-control" name="sv_x_OutputCode" id="sv_x_OutputCode" value="<?php echo RemoveHtml($output_indicator_search->OutputCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_search->OutputCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_search->OutputCode->getPlaceHolder()) ?>"<?php echo $output_indicator_search->OutputCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputCode" data-value-separator="<?php echo $output_indicator_search->OutputCode->displayValueSeparatorAttribute() ?>" name="x_OutputCode" id="x_OutputCode" value="<?php echo HtmlEncode($output_indicator_search->OutputCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorsearch"], function() {
	foutput_indicatorsearch.createAutoSuggest({"id":"x_OutputCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_search->OutputCode->Lookup->getParamTag($output_indicator_search, "p_x_OutputCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_search->OutcomeCode->Visible) { // OutcomeCode ?>
	<div id="r_OutcomeCode" class="form-group row">
		<label class="<?php echo $output_indicator_search->LeftColumnClass ?>"><span id="elh_output_indicator_OutcomeCode"><?php echo $output_indicator_search->OutcomeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_OutcomeCode" id="z_OutcomeCode" value="=">
</span>
		</label>
		<div class="<?php echo $output_indicator_search->RightColumnClass ?>"><div <?php echo $output_indicator_search->OutcomeCode->cellAttributes() ?>>
			<span id="el_output_indicator_OutcomeCode" class="ew-search-field">
<?php
$onchange = $output_indicator_search->OutcomeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_search->OutcomeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_OutcomeCode">
	<input type="text" class="form-control" name="sv_x_OutcomeCode" id="sv_x_OutcomeCode" value="<?php echo RemoveHtml($output_indicator_search->OutcomeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_search->OutcomeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_search->OutcomeCode->getPlaceHolder()) ?>"<?php echo $output_indicator_search->OutcomeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutcomeCode" data-value-separator="<?php echo $output_indicator_search->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x_OutcomeCode" id="x_OutcomeCode" value="<?php echo HtmlEncode($output_indicator_search->OutcomeCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorsearch"], function() {
	foutput_indicatorsearch.createAutoSuggest({"id":"x_OutcomeCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_search->OutcomeCode->Lookup->getParamTag($output_indicator_search, "p_x_OutcomeCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_search->OutputType->Visible) { // OutputType ?>
	<div id="r_OutputType" class="form-group row">
		<label class="<?php echo $output_indicator_search->LeftColumnClass ?>"><span id="elh_output_indicator_OutputType"><?php echo $output_indicator_search->OutputType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_OutputType" id="z_OutputType" value="LIKE">
</span>
		</label>
		<div class="<?php echo $output_indicator_search->RightColumnClass ?>"><div <?php echo $output_indicator_search->OutputType->cellAttributes() ?>>
			<span id="el_output_indicator_OutputType" class="ew-search-field">
<?php
$onchange = $output_indicator_search->OutputType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_search->OutputType->EditAttrs["onchange"] = "";
?>
<span id="as_x_OutputType">
	<input type="text" class="form-control" name="sv_x_OutputType" id="sv_x_OutputType" value="<?php echo RemoveHtml($output_indicator_search->OutputType->EditValue) ?>" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($output_indicator_search->OutputType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_search->OutputType->getPlaceHolder()) ?>"<?php echo $output_indicator_search->OutputType->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputType" data-value-separator="<?php echo $output_indicator_search->OutputType->displayValueSeparatorAttribute() ?>" name="x_OutputType" id="x_OutputType" value="<?php echo HtmlEncode($output_indicator_search->OutputType->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorsearch"], function() {
	foutput_indicatorsearch.createAutoSuggest({"id":"x_OutputType","forceSelect":false});
});
</script>
<?php echo $output_indicator_search->OutputType->Lookup->getParamTag($output_indicator_search, "p_x_OutputType") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_search->ProgramCode->Visible) { // ProgramCode ?>
	<div id="r_ProgramCode" class="form-group row">
		<label class="<?php echo $output_indicator_search->LeftColumnClass ?>"><span id="elh_output_indicator_ProgramCode"><?php echo $output_indicator_search->ProgramCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ProgramCode" id="z_ProgramCode" value="=">
</span>
		</label>
		<div class="<?php echo $output_indicator_search->RightColumnClass ?>"><div <?php echo $output_indicator_search->ProgramCode->cellAttributes() ?>>
			<span id="el_output_indicator_ProgramCode" class="ew-search-field">
<?php
$onchange = $output_indicator_search->ProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_search->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProgramCode">
	<input type="text" class="form-control" name="sv_x_ProgramCode" id="sv_x_ProgramCode" value="<?php echo RemoveHtml($output_indicator_search->ProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_search->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_search->ProgramCode->getPlaceHolder()) ?>"<?php echo $output_indicator_search->ProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_ProgramCode" data-value-separator="<?php echo $output_indicator_search->ProgramCode->displayValueSeparatorAttribute() ?>" name="x_ProgramCode" id="x_ProgramCode" value="<?php echo HtmlEncode($output_indicator_search->ProgramCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorsearch"], function() {
	foutput_indicatorsearch.createAutoSuggest({"id":"x_ProgramCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_search->ProgramCode->Lookup->getParamTag($output_indicator_search, "p_x_ProgramCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_search->SubProgramCode->Visible) { // SubProgramCode ?>
	<div id="r_SubProgramCode" class="form-group row">
		<label class="<?php echo $output_indicator_search->LeftColumnClass ?>"><span id="elh_output_indicator_SubProgramCode"><?php echo $output_indicator_search->SubProgramCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SubProgramCode" id="z_SubProgramCode" value="=">
</span>
		</label>
		<div class="<?php echo $output_indicator_search->RightColumnClass ?>"><div <?php echo $output_indicator_search->SubProgramCode->cellAttributes() ?>>
			<span id="el_output_indicator_SubProgramCode" class="ew-search-field">
<?php
$onchange = $output_indicator_search->SubProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_search->SubProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_SubProgramCode">
	<input type="text" class="form-control" name="sv_x_SubProgramCode" id="sv_x_SubProgramCode" value="<?php echo RemoveHtml($output_indicator_search->SubProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_search->SubProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_search->SubProgramCode->getPlaceHolder()) ?>"<?php echo $output_indicator_search->SubProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SubProgramCode" data-value-separator="<?php echo $output_indicator_search->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x_SubProgramCode" id="x_SubProgramCode" value="<?php echo HtmlEncode($output_indicator_search->SubProgramCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorsearch"], function() {
	foutput_indicatorsearch.createAutoSuggest({"id":"x_SubProgramCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_search->SubProgramCode->Lookup->getParamTag($output_indicator_search, "p_x_SubProgramCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_search->FinancialYear->Visible) { // FinancialYear ?>
	<div id="r_FinancialYear" class="form-group row">
		<label for="x_FinancialYear" class="<?php echo $output_indicator_search->LeftColumnClass ?>"><span id="elh_output_indicator_FinancialYear"><?php echo $output_indicator_search->FinancialYear->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_FinancialYear" id="z_FinancialYear" value="=">
</span>
		</label>
		<div class="<?php echo $output_indicator_search->RightColumnClass ?>"><div <?php echo $output_indicator_search->FinancialYear->cellAttributes() ?>>
			<span id="el_output_indicator_FinancialYear" class="ew-search-field">
<input type="text" data-table="output_indicator" data-field="x_FinancialYear" name="x_FinancialYear" id="x_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($output_indicator_search->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $output_indicator_search->FinancialYear->EditValue ?>"<?php echo $output_indicator_search->FinancialYear->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_search->OutputIndicatorName->Visible) { // OutputIndicatorName ?>
	<div id="r_OutputIndicatorName" class="form-group row">
		<label for="x_OutputIndicatorName" class="<?php echo $output_indicator_search->LeftColumnClass ?>"><span id="elh_output_indicator_OutputIndicatorName"><?php echo $output_indicator_search->OutputIndicatorName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_OutputIndicatorName" id="z_OutputIndicatorName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $output_indicator_search->RightColumnClass ?>"><div <?php echo $output_indicator_search->OutputIndicatorName->cellAttributes() ?>>
			<span id="el_output_indicator_OutputIndicatorName" class="ew-search-field">
<input type="text" data-table="output_indicator" data-field="x_OutputIndicatorName" name="x_OutputIndicatorName" id="x_OutputIndicatorName" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($output_indicator_search->OutputIndicatorName->getPlaceHolder()) ?>" value="<?php echo $output_indicator_search->OutputIndicatorName->EditValue ?>"<?php echo $output_indicator_search->OutputIndicatorName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_search->TargetAmount->Visible) { // TargetAmount ?>
	<div id="r_TargetAmount" class="form-group row">
		<label for="x_TargetAmount" class="<?php echo $output_indicator_search->LeftColumnClass ?>"><span id="elh_output_indicator_TargetAmount"><?php echo $output_indicator_search->TargetAmount->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_TargetAmount" id="z_TargetAmount" value="=">
</span>
		</label>
		<div class="<?php echo $output_indicator_search->RightColumnClass ?>"><div <?php echo $output_indicator_search->TargetAmount->cellAttributes() ?>>
			<span id="el_output_indicator_TargetAmount" class="ew-search-field">
<input type="text" data-table="output_indicator" data-field="x_TargetAmount" name="x_TargetAmount" id="x_TargetAmount" size="30" placeholder="<?php echo HtmlEncode($output_indicator_search->TargetAmount->getPlaceHolder()) ?>" value="<?php echo $output_indicator_search->TargetAmount->EditValue ?>"<?php echo $output_indicator_search->TargetAmount->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_search->ActualAmount->Visible) { // ActualAmount ?>
	<div id="r_ActualAmount" class="form-group row">
		<label for="x_ActualAmount" class="<?php echo $output_indicator_search->LeftColumnClass ?>"><span id="elh_output_indicator_ActualAmount"><?php echo $output_indicator_search->ActualAmount->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ActualAmount" id="z_ActualAmount" value="=">
</span>
		</label>
		<div class="<?php echo $output_indicator_search->RightColumnClass ?>"><div <?php echo $output_indicator_search->ActualAmount->cellAttributes() ?>>
			<span id="el_output_indicator_ActualAmount" class="ew-search-field">
<input type="text" data-table="output_indicator" data-field="x_ActualAmount" name="x_ActualAmount" id="x_ActualAmount" size="30" placeholder="<?php echo HtmlEncode($output_indicator_search->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $output_indicator_search->ActualAmount->EditValue ?>"<?php echo $output_indicator_search->ActualAmount->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_search->PercentAchieved->Visible) { // PercentAchieved ?>
	<div id="r_PercentAchieved" class="form-group row">
		<label for="x_PercentAchieved" class="<?php echo $output_indicator_search->LeftColumnClass ?>"><span id="elh_output_indicator_PercentAchieved"><?php echo $output_indicator_search->PercentAchieved->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PercentAchieved" id="z_PercentAchieved" value="=">
</span>
		</label>
		<div class="<?php echo $output_indicator_search->RightColumnClass ?>"><div <?php echo $output_indicator_search->PercentAchieved->cellAttributes() ?>>
			<span id="el_output_indicator_PercentAchieved" class="ew-search-field">
<input type="text" data-table="output_indicator" data-field="x_PercentAchieved" name="x_PercentAchieved" id="x_PercentAchieved" size="30" placeholder="<?php echo HtmlEncode($output_indicator_search->PercentAchieved->getPlaceHolder()) ?>" value="<?php echo $output_indicator_search->PercentAchieved->EditValue ?>"<?php echo $output_indicator_search->PercentAchieved->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$output_indicator_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $output_indicator_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$output_indicator_search->showPageFooter();
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
$output_indicator_search->terminate();
?>