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
$detailed_action_search = new detailed_action_search();

// Run the page
$detailed_action_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailed_action_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailed_actionsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($detailed_action_search->IsModal) { ?>
	fdetailed_actionsearch = currentAdvancedSearchForm = new ew.Form("fdetailed_actionsearch", "search");
	<?php } else { ?>
	fdetailed_actionsearch = currentForm = new ew.Form("fdetailed_actionsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fdetailed_actionsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_FinancialYear");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailed_action_search->FinancialYear->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DetailedActionCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailed_action_search->DetailedActionCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PlannedStartDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailed_action_search->PlannedStartDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PlannedEndDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailed_action_search->PlannedEndDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ActualStartDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailed_action_search->ActualStartDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ActualEndDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailed_action_search->ActualEndDate->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fdetailed_actionsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailed_actionsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailed_actionsearch.lists["x_LACode"] = <?php echo $detailed_action_search->LACode->Lookup->toClientList($detailed_action_search) ?>;
	fdetailed_actionsearch.lists["x_LACode"].options = <?php echo JsonEncode($detailed_action_search->LACode->lookupOptions()) ?>;
	fdetailed_actionsearch.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailed_actionsearch.lists["x_DepartmentCode"] = <?php echo $detailed_action_search->DepartmentCode->Lookup->toClientList($detailed_action_search) ?>;
	fdetailed_actionsearch.lists["x_DepartmentCode"].options = <?php echo JsonEncode($detailed_action_search->DepartmentCode->lookupOptions()) ?>;
	fdetailed_actionsearch.lists["x_SectionCode"] = <?php echo $detailed_action_search->SectionCode->Lookup->toClientList($detailed_action_search) ?>;
	fdetailed_actionsearch.lists["x_SectionCode"].options = <?php echo JsonEncode($detailed_action_search->SectionCode->lookupOptions()) ?>;
	fdetailed_actionsearch.lists["x_ProgramCode"] = <?php echo $detailed_action_search->ProgramCode->Lookup->toClientList($detailed_action_search) ?>;
	fdetailed_actionsearch.lists["x_ProgramCode"].options = <?php echo JsonEncode($detailed_action_search->ProgramCode->lookupOptions()) ?>;
	fdetailed_actionsearch.lists["x_SubProgramCode"] = <?php echo $detailed_action_search->SubProgramCode->Lookup->toClientList($detailed_action_search) ?>;
	fdetailed_actionsearch.lists["x_SubProgramCode"].options = <?php echo JsonEncode($detailed_action_search->SubProgramCode->lookupOptions()) ?>;
	fdetailed_actionsearch.lists["x_OutcomeCode"] = <?php echo $detailed_action_search->OutcomeCode->Lookup->toClientList($detailed_action_search) ?>;
	fdetailed_actionsearch.lists["x_OutcomeCode"].options = <?php echo JsonEncode($detailed_action_search->OutcomeCode->lookupOptions()) ?>;
	fdetailed_actionsearch.lists["x_OutputCode"] = <?php echo $detailed_action_search->OutputCode->Lookup->toClientList($detailed_action_search) ?>;
	fdetailed_actionsearch.lists["x_OutputCode"].options = <?php echo JsonEncode($detailed_action_search->OutputCode->lookupOptions()) ?>;
	fdetailed_actionsearch.lists["x_ActionCode"] = <?php echo $detailed_action_search->ActionCode->Lookup->toClientList($detailed_action_search) ?>;
	fdetailed_actionsearch.lists["x_ActionCode"].options = <?php echo JsonEncode($detailed_action_search->ActionCode->lookupOptions()) ?>;
	fdetailed_actionsearch.lists["x_ProgressStatus"] = <?php echo $detailed_action_search->ProgressStatus->Lookup->toClientList($detailed_action_search) ?>;
	fdetailed_actionsearch.lists["x_ProgressStatus"].options = <?php echo JsonEncode($detailed_action_search->ProgressStatus->lookupOptions()) ?>;
	loadjs.done("fdetailed_actionsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailed_action_search->showPageHeader(); ?>
<?php
$detailed_action_search->showMessage();
?>
<form name="fdetailed_actionsearch" id="fdetailed_actionsearch" class="<?php echo $detailed_action_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailed_action">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$detailed_action_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($detailed_action_search->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label class="<?php echo $detailed_action_search->LeftColumnClass ?>"><span id="elh_detailed_action_LACode"><?php echo $detailed_action_search->LACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $detailed_action_search->RightColumnClass ?>"><div <?php echo $detailed_action_search->LACode->cellAttributes() ?>>
			<span id="el_detailed_action_LACode" class="ew-search-field">
<?php
$onchange = $detailed_action_search->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailed_action_search->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($detailed_action_search->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($detailed_action_search->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailed_action_search->LACode->getPlaceHolder()) ?>"<?php echo $detailed_action_search->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_search->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_search->LACode->ReadOnly || $detailed_action_search->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_search->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($detailed_action_search->LACode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailed_actionsearch"], function() {
	fdetailed_actionsearch.createAutoSuggest({"id":"x_LACode","forceSelect":false});
});
</script>
<?php echo $detailed_action_search->LACode->Lookup->getParamTag($detailed_action_search, "p_x_LACode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_search->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label for="x_DepartmentCode" class="<?php echo $detailed_action_search->LeftColumnClass ?>"><span id="elh_detailed_action_DepartmentCode"><?php echo $detailed_action_search->DepartmentCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DepartmentCode" id="z_DepartmentCode" value="=">
</span>
		</label>
		<div class="<?php echo $detailed_action_search->RightColumnClass ?>"><div <?php echo $detailed_action_search->DepartmentCode->cellAttributes() ?>>
			<span id="el_detailed_action_DepartmentCode" class="ew-search-field">
<?php $detailed_action_search->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_DepartmentCode" data-value-separator="<?php echo $detailed_action_search->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $detailed_action_search->DepartmentCode->editAttributes() ?>>
			<?php echo $detailed_action_search->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $detailed_action_search->DepartmentCode->Lookup->getParamTag($detailed_action_search, "p_x_DepartmentCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_search->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label for="x_SectionCode" class="<?php echo $detailed_action_search->LeftColumnClass ?>"><span id="elh_detailed_action_SectionCode"><?php echo $detailed_action_search->SectionCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SectionCode" id="z_SectionCode" value="=">
</span>
		</label>
		<div class="<?php echo $detailed_action_search->RightColumnClass ?>"><div <?php echo $detailed_action_search->SectionCode->cellAttributes() ?>>
			<span id="el_detailed_action_SectionCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_SectionCode" data-value-separator="<?php echo $detailed_action_search->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $detailed_action_search->SectionCode->editAttributes() ?>>
			<?php echo $detailed_action_search->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $detailed_action_search->SectionCode->Lookup->getParamTag($detailed_action_search, "p_x_SectionCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_search->ProgramCode->Visible) { // ProgramCode ?>
	<div id="r_ProgramCode" class="form-group row">
		<label for="x_ProgramCode" class="<?php echo $detailed_action_search->LeftColumnClass ?>"><span id="elh_detailed_action_ProgramCode"><?php echo $detailed_action_search->ProgramCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ProgramCode" id="z_ProgramCode" value="=">
</span>
		</label>
		<div class="<?php echo $detailed_action_search->RightColumnClass ?>"><div <?php echo $detailed_action_search->ProgramCode->cellAttributes() ?>>
			<span id="el_detailed_action_ProgramCode" class="ew-search-field">
<?php $detailed_action_search->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_ProgramCode" data-value-separator="<?php echo $detailed_action_search->ProgramCode->displayValueSeparatorAttribute() ?>" id="x_ProgramCode" name="x_ProgramCode"<?php echo $detailed_action_search->ProgramCode->editAttributes() ?>>
			<?php echo $detailed_action_search->ProgramCode->selectOptionListHtml("x_ProgramCode") ?>
		</select>
</div>
<?php echo $detailed_action_search->ProgramCode->Lookup->getParamTag($detailed_action_search, "p_x_ProgramCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_search->SubProgramCode->Visible) { // SubProgramCode ?>
	<div id="r_SubProgramCode" class="form-group row">
		<label for="x_SubProgramCode" class="<?php echo $detailed_action_search->LeftColumnClass ?>"><span id="elh_detailed_action_SubProgramCode"><?php echo $detailed_action_search->SubProgramCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SubProgramCode" id="z_SubProgramCode" value="=">
</span>
		</label>
		<div class="<?php echo $detailed_action_search->RightColumnClass ?>"><div <?php echo $detailed_action_search->SubProgramCode->cellAttributes() ?>>
			<span id="el_detailed_action_SubProgramCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_SubProgramCode"><?php echo EmptyValue(strval($detailed_action_search->SubProgramCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_search->SubProgramCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_search->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_search->SubProgramCode->ReadOnly || $detailed_action_search->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_search->SubProgramCode->Lookup->getParamTag($detailed_action_search, "p_x_SubProgramCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_search->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x_SubProgramCode" id="x_SubProgramCode" value="<?php echo $detailed_action_search->SubProgramCode->AdvancedSearch->SearchValue ?>"<?php echo $detailed_action_search->SubProgramCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_search->OutcomeCode->Visible) { // OutcomeCode ?>
	<div id="r_OutcomeCode" class="form-group row">
		<label for="x_OutcomeCode" class="<?php echo $detailed_action_search->LeftColumnClass ?>"><span id="elh_detailed_action_OutcomeCode"><?php echo $detailed_action_search->OutcomeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_OutcomeCode" id="z_OutcomeCode" value="=">
</span>
		</label>
		<div class="<?php echo $detailed_action_search->RightColumnClass ?>"><div <?php echo $detailed_action_search->OutcomeCode->cellAttributes() ?>>
			<span id="el_detailed_action_OutcomeCode" class="ew-search-field">
<?php $detailed_action_search->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_OutcomeCode"><?php echo EmptyValue(strval($detailed_action_search->OutcomeCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_search->OutcomeCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_search->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_search->OutcomeCode->ReadOnly || $detailed_action_search->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_search->OutcomeCode->Lookup->getParamTag($detailed_action_search, "p_x_OutcomeCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_search->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x_OutcomeCode" id="x_OutcomeCode" value="<?php echo $detailed_action_search->OutcomeCode->AdvancedSearch->SearchValue ?>"<?php echo $detailed_action_search->OutcomeCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_search->OutputCode->Visible) { // OutputCode ?>
	<div id="r_OutputCode" class="form-group row">
		<label for="x_OutputCode" class="<?php echo $detailed_action_search->LeftColumnClass ?>"><span id="elh_detailed_action_OutputCode"><?php echo $detailed_action_search->OutputCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_OutputCode" id="z_OutputCode" value="=">
</span>
		</label>
		<div class="<?php echo $detailed_action_search->RightColumnClass ?>"><div <?php echo $detailed_action_search->OutputCode->cellAttributes() ?>>
			<span id="el_detailed_action_OutputCode" class="ew-search-field">
<?php $detailed_action_search->OutputCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_OutputCode"><?php echo EmptyValue(strval($detailed_action_search->OutputCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_search->OutputCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_search->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_search->OutputCode->ReadOnly || $detailed_action_search->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_search->OutputCode->Lookup->getParamTag($detailed_action_search, "p_x_OutputCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_search->OutputCode->displayValueSeparatorAttribute() ?>" name="x_OutputCode" id="x_OutputCode" value="<?php echo $detailed_action_search->OutputCode->AdvancedSearch->SearchValue ?>"<?php echo $detailed_action_search->OutputCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_search->ActionCode->Visible) { // ActionCode ?>
	<div id="r_ActionCode" class="form-group row">
		<label for="x_ActionCode" class="<?php echo $detailed_action_search->LeftColumnClass ?>"><span id="elh_detailed_action_ActionCode"><?php echo $detailed_action_search->ActionCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ActionCode" id="z_ActionCode" value="=">
</span>
		</label>
		<div class="<?php echo $detailed_action_search->RightColumnClass ?>"><div <?php echo $detailed_action_search->ActionCode->cellAttributes() ?>>
			<span id="el_detailed_action_ActionCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ActionCode"><?php echo EmptyValue(strval($detailed_action_search->ActionCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_search->ActionCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_search->ActionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_search->ActionCode->ReadOnly || $detailed_action_search->ActionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ActionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_search->ActionCode->Lookup->getParamTag($detailed_action_search, "p_x_ActionCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_ActionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_search->ActionCode->displayValueSeparatorAttribute() ?>" name="x_ActionCode" id="x_ActionCode" value="<?php echo $detailed_action_search->ActionCode->AdvancedSearch->SearchValue ?>"<?php echo $detailed_action_search->ActionCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_search->FinancialYear->Visible) { // FinancialYear ?>
	<div id="r_FinancialYear" class="form-group row">
		<label for="x_FinancialYear" class="<?php echo $detailed_action_search->LeftColumnClass ?>"><span id="elh_detailed_action_FinancialYear"><?php echo $detailed_action_search->FinancialYear->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_FinancialYear" id="z_FinancialYear" value="=">
</span>
		</label>
		<div class="<?php echo $detailed_action_search->RightColumnClass ?>"><div <?php echo $detailed_action_search->FinancialYear->cellAttributes() ?>>
			<span id="el_detailed_action_FinancialYear" class="ew-search-field">
<input type="text" data-table="detailed_action" data-field="x_FinancialYear" name="x_FinancialYear" id="x_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($detailed_action_search->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $detailed_action_search->FinancialYear->EditValue ?>"<?php echo $detailed_action_search->FinancialYear->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_search->DetailedActionCode->Visible) { // DetailedActionCode ?>
	<div id="r_DetailedActionCode" class="form-group row">
		<label for="x_DetailedActionCode" class="<?php echo $detailed_action_search->LeftColumnClass ?>"><span id="elh_detailed_action_DetailedActionCode"><?php echo $detailed_action_search->DetailedActionCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DetailedActionCode" id="z_DetailedActionCode" value="=">
</span>
		</label>
		<div class="<?php echo $detailed_action_search->RightColumnClass ?>"><div <?php echo $detailed_action_search->DetailedActionCode->cellAttributes() ?>>
			<span id="el_detailed_action_DetailedActionCode" class="ew-search-field">
<input type="text" data-table="detailed_action" data-field="x_DetailedActionCode" name="x_DetailedActionCode" id="x_DetailedActionCode" placeholder="<?php echo HtmlEncode($detailed_action_search->DetailedActionCode->getPlaceHolder()) ?>" value="<?php echo $detailed_action_search->DetailedActionCode->EditValue ?>"<?php echo $detailed_action_search->DetailedActionCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_search->DetailedActionName->Visible) { // DetailedActionName ?>
	<div id="r_DetailedActionName" class="form-group row">
		<label for="x_DetailedActionName" class="<?php echo $detailed_action_search->LeftColumnClass ?>"><span id="elh_detailed_action_DetailedActionName"><?php echo $detailed_action_search->DetailedActionName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DetailedActionName" id="z_DetailedActionName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $detailed_action_search->RightColumnClass ?>"><div <?php echo $detailed_action_search->DetailedActionName->cellAttributes() ?>>
			<span id="el_detailed_action_DetailedActionName" class="ew-search-field">
<input type="text" data-table="detailed_action" data-field="x_DetailedActionName" name="x_DetailedActionName" id="x_DetailedActionName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($detailed_action_search->DetailedActionName->getPlaceHolder()) ?>" value="<?php echo $detailed_action_search->DetailedActionName->EditValue ?>"<?php echo $detailed_action_search->DetailedActionName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_search->DetailedActionLocation->Visible) { // DetailedActionLocation ?>
	<div id="r_DetailedActionLocation" class="form-group row">
		<label for="x_DetailedActionLocation" class="<?php echo $detailed_action_search->LeftColumnClass ?>"><span id="elh_detailed_action_DetailedActionLocation"><?php echo $detailed_action_search->DetailedActionLocation->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DetailedActionLocation" id="z_DetailedActionLocation" value="LIKE">
</span>
		</label>
		<div class="<?php echo $detailed_action_search->RightColumnClass ?>"><div <?php echo $detailed_action_search->DetailedActionLocation->cellAttributes() ?>>
			<span id="el_detailed_action_DetailedActionLocation" class="ew-search-field">
<input type="text" data-table="detailed_action" data-field="x_DetailedActionLocation" name="x_DetailedActionLocation" id="x_DetailedActionLocation" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($detailed_action_search->DetailedActionLocation->getPlaceHolder()) ?>" value="<?php echo $detailed_action_search->DetailedActionLocation->EditValue ?>"<?php echo $detailed_action_search->DetailedActionLocation->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_search->PlannedStartDate->Visible) { // PlannedStartDate ?>
	<div id="r_PlannedStartDate" class="form-group row">
		<label for="x_PlannedStartDate" class="<?php echo $detailed_action_search->LeftColumnClass ?>"><span id="elh_detailed_action_PlannedStartDate"><?php echo $detailed_action_search->PlannedStartDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PlannedStartDate" id="z_PlannedStartDate" value="=">
</span>
		</label>
		<div class="<?php echo $detailed_action_search->RightColumnClass ?>"><div <?php echo $detailed_action_search->PlannedStartDate->cellAttributes() ?>>
			<span id="el_detailed_action_PlannedStartDate" class="ew-search-field">
<input type="text" data-table="detailed_action" data-field="x_PlannedStartDate" name="x_PlannedStartDate" id="x_PlannedStartDate" placeholder="<?php echo HtmlEncode($detailed_action_search->PlannedStartDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_search->PlannedStartDate->EditValue ?>"<?php echo $detailed_action_search->PlannedStartDate->editAttributes() ?>>
<?php if (!$detailed_action_search->PlannedStartDate->ReadOnly && !$detailed_action_search->PlannedStartDate->Disabled && !isset($detailed_action_search->PlannedStartDate->EditAttrs["readonly"]) && !isset($detailed_action_search->PlannedStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actionsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actionsearch", "x_PlannedStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_search->PlannedEndDate->Visible) { // PlannedEndDate ?>
	<div id="r_PlannedEndDate" class="form-group row">
		<label for="x_PlannedEndDate" class="<?php echo $detailed_action_search->LeftColumnClass ?>"><span id="elh_detailed_action_PlannedEndDate"><?php echo $detailed_action_search->PlannedEndDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PlannedEndDate" id="z_PlannedEndDate" value="=">
</span>
		</label>
		<div class="<?php echo $detailed_action_search->RightColumnClass ?>"><div <?php echo $detailed_action_search->PlannedEndDate->cellAttributes() ?>>
			<span id="el_detailed_action_PlannedEndDate" class="ew-search-field">
<input type="text" data-table="detailed_action" data-field="x_PlannedEndDate" name="x_PlannedEndDate" id="x_PlannedEndDate" placeholder="<?php echo HtmlEncode($detailed_action_search->PlannedEndDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_search->PlannedEndDate->EditValue ?>"<?php echo $detailed_action_search->PlannedEndDate->editAttributes() ?>>
<?php if (!$detailed_action_search->PlannedEndDate->ReadOnly && !$detailed_action_search->PlannedEndDate->Disabled && !isset($detailed_action_search->PlannedEndDate->EditAttrs["readonly"]) && !isset($detailed_action_search->PlannedEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actionsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actionsearch", "x_PlannedEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_search->ActualStartDate->Visible) { // ActualStartDate ?>
	<div id="r_ActualStartDate" class="form-group row">
		<label for="x_ActualStartDate" class="<?php echo $detailed_action_search->LeftColumnClass ?>"><span id="elh_detailed_action_ActualStartDate"><?php echo $detailed_action_search->ActualStartDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ActualStartDate" id="z_ActualStartDate" value="=">
</span>
		</label>
		<div class="<?php echo $detailed_action_search->RightColumnClass ?>"><div <?php echo $detailed_action_search->ActualStartDate->cellAttributes() ?>>
			<span id="el_detailed_action_ActualStartDate" class="ew-search-field">
<input type="text" data-table="detailed_action" data-field="x_ActualStartDate" name="x_ActualStartDate" id="x_ActualStartDate" placeholder="<?php echo HtmlEncode($detailed_action_search->ActualStartDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_search->ActualStartDate->EditValue ?>"<?php echo $detailed_action_search->ActualStartDate->editAttributes() ?>>
<?php if (!$detailed_action_search->ActualStartDate->ReadOnly && !$detailed_action_search->ActualStartDate->Disabled && !isset($detailed_action_search->ActualStartDate->EditAttrs["readonly"]) && !isset($detailed_action_search->ActualStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actionsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actionsearch", "x_ActualStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_search->ActualEndDate->Visible) { // ActualEndDate ?>
	<div id="r_ActualEndDate" class="form-group row">
		<label for="x_ActualEndDate" class="<?php echo $detailed_action_search->LeftColumnClass ?>"><span id="elh_detailed_action_ActualEndDate"><?php echo $detailed_action_search->ActualEndDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ActualEndDate" id="z_ActualEndDate" value="=">
</span>
		</label>
		<div class="<?php echo $detailed_action_search->RightColumnClass ?>"><div <?php echo $detailed_action_search->ActualEndDate->cellAttributes() ?>>
			<span id="el_detailed_action_ActualEndDate" class="ew-search-field">
<input type="text" data-table="detailed_action" data-field="x_ActualEndDate" name="x_ActualEndDate" id="x_ActualEndDate" placeholder="<?php echo HtmlEncode($detailed_action_search->ActualEndDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_search->ActualEndDate->EditValue ?>"<?php echo $detailed_action_search->ActualEndDate->editAttributes() ?>>
<?php if (!$detailed_action_search->ActualEndDate->ReadOnly && !$detailed_action_search->ActualEndDate->Disabled && !isset($detailed_action_search->ActualEndDate->EditAttrs["readonly"]) && !isset($detailed_action_search->ActualEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actionsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actionsearch", "x_ActualEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_search->Ward->Visible) { // Ward ?>
	<div id="r_Ward" class="form-group row">
		<label for="x_Ward" class="<?php echo $detailed_action_search->LeftColumnClass ?>"><span id="elh_detailed_action_Ward"><?php echo $detailed_action_search->Ward->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Ward" id="z_Ward" value="LIKE">
</span>
		</label>
		<div class="<?php echo $detailed_action_search->RightColumnClass ?>"><div <?php echo $detailed_action_search->Ward->cellAttributes() ?>>
			<span id="el_detailed_action_Ward" class="ew-search-field">
<input type="text" data-table="detailed_action" data-field="x_Ward" name="x_Ward" id="x_Ward" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($detailed_action_search->Ward->getPlaceHolder()) ?>" value="<?php echo $detailed_action_search->Ward->EditValue ?>"<?php echo $detailed_action_search->Ward->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_search->ExpectedResult->Visible) { // ExpectedResult ?>
	<div id="r_ExpectedResult" class="form-group row">
		<label for="x_ExpectedResult" class="<?php echo $detailed_action_search->LeftColumnClass ?>"><span id="elh_detailed_action_ExpectedResult"><?php echo $detailed_action_search->ExpectedResult->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ExpectedResult" id="z_ExpectedResult" value="LIKE">
</span>
		</label>
		<div class="<?php echo $detailed_action_search->RightColumnClass ?>"><div <?php echo $detailed_action_search->ExpectedResult->cellAttributes() ?>>
			<span id="el_detailed_action_ExpectedResult" class="ew-search-field">
<input type="text" data-table="detailed_action" data-field="x_ExpectedResult" name="x_ExpectedResult" id="x_ExpectedResult" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($detailed_action_search->ExpectedResult->getPlaceHolder()) ?>" value="<?php echo $detailed_action_search->ExpectedResult->EditValue ?>"<?php echo $detailed_action_search->ExpectedResult->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_search->Comments->Visible) { // Comments ?>
	<div id="r_Comments" class="form-group row">
		<label for="x_Comments" class="<?php echo $detailed_action_search->LeftColumnClass ?>"><span id="elh_detailed_action_Comments"><?php echo $detailed_action_search->Comments->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Comments" id="z_Comments" value="LIKE">
</span>
		</label>
		<div class="<?php echo $detailed_action_search->RightColumnClass ?>"><div <?php echo $detailed_action_search->Comments->cellAttributes() ?>>
			<span id="el_detailed_action_Comments" class="ew-search-field">
<input type="text" data-table="detailed_action" data-field="x_Comments" name="x_Comments" id="x_Comments" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($detailed_action_search->Comments->getPlaceHolder()) ?>" value="<?php echo $detailed_action_search->Comments->EditValue ?>"<?php echo $detailed_action_search->Comments->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_search->ProgressStatus->Visible) { // ProgressStatus ?>
	<div id="r_ProgressStatus" class="form-group row">
		<label for="x_ProgressStatus" class="<?php echo $detailed_action_search->LeftColumnClass ?>"><span id="elh_detailed_action_ProgressStatus"><?php echo $detailed_action_search->ProgressStatus->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ProgressStatus" id="z_ProgressStatus" value="=">
</span>
		</label>
		<div class="<?php echo $detailed_action_search->RightColumnClass ?>"><div <?php echo $detailed_action_search->ProgressStatus->cellAttributes() ?>>
			<span id="el_detailed_action_ProgressStatus" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_ProgressStatus" data-value-separator="<?php echo $detailed_action_search->ProgressStatus->displayValueSeparatorAttribute() ?>" id="x_ProgressStatus" name="x_ProgressStatus"<?php echo $detailed_action_search->ProgressStatus->editAttributes() ?>>
			<?php echo $detailed_action_search->ProgressStatus->selectOptionListHtml("x_ProgressStatus") ?>
		</select>
</div>
<?php echo $detailed_action_search->ProgressStatus->Lookup->getParamTag($detailed_action_search, "p_x_ProgressStatus") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detailed_action_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailed_action_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailed_action_search->showPageFooter();
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
$detailed_action_search->terminate();
?>