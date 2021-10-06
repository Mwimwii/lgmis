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
$activity_search = new activity_search();

// Run the page
$activity_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$activity_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var factivitysearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($activity_search->IsModal) { ?>
	factivitysearch = currentAdvancedSearchForm = new ew.Form("factivitysearch", "search");
	<?php } else { ?>
	factivitysearch = currentForm = new ew.Form("factivitysearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	factivitysearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_MTEFBudget");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($activity_search->MTEFBudget->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_SupplementaryBudget");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($activity_search->SupplementaryBudget->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	factivitysearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	factivitysearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	factivitysearch.lists["x_LACode"] = <?php echo $activity_search->LACode->Lookup->toClientList($activity_search) ?>;
	factivitysearch.lists["x_LACode"].options = <?php echo JsonEncode($activity_search->LACode->lookupOptions()) ?>;
	factivitysearch.lists["x_DepartmentCode"] = <?php echo $activity_search->DepartmentCode->Lookup->toClientList($activity_search) ?>;
	factivitysearch.lists["x_DepartmentCode"].options = <?php echo JsonEncode($activity_search->DepartmentCode->lookupOptions()) ?>;
	factivitysearch.lists["x_SectionCode"] = <?php echo $activity_search->SectionCode->Lookup->toClientList($activity_search) ?>;
	factivitysearch.lists["x_SectionCode"].options = <?php echo JsonEncode($activity_search->SectionCode->lookupOptions()) ?>;
	factivitysearch.lists["x_ProgrammeCode"] = <?php echo $activity_search->ProgrammeCode->Lookup->toClientList($activity_search) ?>;
	factivitysearch.lists["x_ProgrammeCode"].options = <?php echo JsonEncode($activity_search->ProgrammeCode->lookupOptions()) ?>;
	factivitysearch.autoSuggests["x_ProgrammeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	factivitysearch.lists["x_OucomeCode"] = <?php echo $activity_search->OucomeCode->Lookup->toClientList($activity_search) ?>;
	factivitysearch.lists["x_OucomeCode"].options = <?php echo JsonEncode($activity_search->OucomeCode->lookupOptions()) ?>;
	factivitysearch.lists["x_OutputCode"] = <?php echo $activity_search->OutputCode->Lookup->toClientList($activity_search) ?>;
	factivitysearch.lists["x_OutputCode"].options = <?php echo JsonEncode($activity_search->OutputCode->lookupOptions()) ?>;
	factivitysearch.lists["x_ProjectCode"] = <?php echo $activity_search->ProjectCode->Lookup->toClientList($activity_search) ?>;
	factivitysearch.lists["x_ProjectCode"].options = <?php echo JsonEncode($activity_search->ProjectCode->lookupOptions()) ?>;
	factivitysearch.autoSuggests["x_ProjectCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	factivitysearch.lists["x_FinancialYear"] = <?php echo $activity_search->FinancialYear->Lookup->toClientList($activity_search) ?>;
	factivitysearch.lists["x_FinancialYear"].options = <?php echo JsonEncode($activity_search->FinancialYear->lookupOptions()) ?>;
	loadjs.done("factivitysearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $activity_search->showPageHeader(); ?>
<?php
$activity_search->showMessage();
?>
<form name="factivitysearch" id="factivitysearch" class="<?php echo $activity_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="activity">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$activity_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($activity_search->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label for="x_LACode" class="<?php echo $activity_search->LeftColumnClass ?>"><span id="elh_activity_LACode"><?php echo $activity_search->LACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $activity_search->RightColumnClass ?>"><div <?php echo $activity_search->LACode->cellAttributes() ?>>
			<span id="el_activity_LACode" class="ew-search-field">
<?php $activity_search->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($activity_search->LACode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_search->LACode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_search->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_search->LACode->ReadOnly || $activity_search->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_search->LACode->Lookup->getParamTag($activity_search, "p_x_LACode") ?>
<input type="hidden" data-table="activity" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_search->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $activity_search->LACode->AdvancedSearch->SearchValue ?>"<?php echo $activity_search->LACode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($activity_search->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label for="x_DepartmentCode" class="<?php echo $activity_search->LeftColumnClass ?>"><span id="elh_activity_DepartmentCode"><?php echo $activity_search->DepartmentCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DepartmentCode" id="z_DepartmentCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $activity_search->RightColumnClass ?>"><div <?php echo $activity_search->DepartmentCode->cellAttributes() ?>>
			<span id="el_activity_DepartmentCode" class="ew-search-field">
<?php $activity_search->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DepartmentCode"><?php echo EmptyValue(strval($activity_search->DepartmentCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_search->DepartmentCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_search->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_search->DepartmentCode->ReadOnly || $activity_search->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_search->DepartmentCode->Lookup->getParamTag($activity_search, "p_x_DepartmentCode") ?>
<input type="hidden" data-table="activity" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_search->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo $activity_search->DepartmentCode->AdvancedSearch->SearchValue ?>"<?php echo $activity_search->DepartmentCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($activity_search->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label for="x_SectionCode" class="<?php echo $activity_search->LeftColumnClass ?>"><span id="elh_activity_SectionCode"><?php echo $activity_search->SectionCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SectionCode" id="z_SectionCode" value="=">
</span>
		</label>
		<div class="<?php echo $activity_search->RightColumnClass ?>"><div <?php echo $activity_search->SectionCode->cellAttributes() ?>>
			<span id="el_activity_SectionCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_SectionCode"><?php echo EmptyValue(strval($activity_search->SectionCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_search->SectionCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_search->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_search->SectionCode->ReadOnly || $activity_search->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_search->SectionCode->Lookup->getParamTag($activity_search, "p_x_SectionCode") ?>
<input type="hidden" data-table="activity" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_search->SectionCode->displayValueSeparatorAttribute() ?>" name="x_SectionCode" id="x_SectionCode" value="<?php echo $activity_search->SectionCode->AdvancedSearch->SearchValue ?>"<?php echo $activity_search->SectionCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($activity_search->ProgrammeCode->Visible) { // ProgrammeCode ?>
	<div id="r_ProgrammeCode" class="form-group row">
		<label class="<?php echo $activity_search->LeftColumnClass ?>"><span id="elh_activity_ProgrammeCode"><?php echo $activity_search->ProgrammeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ProgrammeCode" id="z_ProgrammeCode" value="=">
</span>
		</label>
		<div class="<?php echo $activity_search->RightColumnClass ?>"><div <?php echo $activity_search->ProgrammeCode->cellAttributes() ?>>
			<span id="el_activity_ProgrammeCode" class="ew-search-field">
<?php
$onchange = $activity_search->ProgrammeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$activity_search->ProgrammeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProgrammeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ProgrammeCode" id="sv_x_ProgrammeCode" value="<?php echo RemoveHtml($activity_search->ProgrammeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($activity_search->ProgrammeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($activity_search->ProgrammeCode->getPlaceHolder()) ?>"<?php echo $activity_search->ProgrammeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_search->ProgrammeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ProgrammeCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($activity_search->ProgrammeCode->ReadOnly || $activity_search->ProgrammeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="activity" data-field="x_ProgrammeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_search->ProgrammeCode->displayValueSeparatorAttribute() ?>" name="x_ProgrammeCode" id="x_ProgrammeCode" value="<?php echo HtmlEncode($activity_search->ProgrammeCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["factivitysearch"], function() {
	factivitysearch.createAutoSuggest({"id":"x_ProgrammeCode","forceSelect":false});
});
</script>
<?php echo $activity_search->ProgrammeCode->Lookup->getParamTag($activity_search, "p_x_ProgrammeCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($activity_search->OucomeCode->Visible) { // OucomeCode ?>
	<div id="r_OucomeCode" class="form-group row">
		<label for="x_OucomeCode" class="<?php echo $activity_search->LeftColumnClass ?>"><span id="elh_activity_OucomeCode"><?php echo $activity_search->OucomeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_OucomeCode" id="z_OucomeCode" value="=">
</span>
		</label>
		<div class="<?php echo $activity_search->RightColumnClass ?>"><div <?php echo $activity_search->OucomeCode->cellAttributes() ?>>
			<span id="el_activity_OucomeCode" class="ew-search-field">
<?php $activity_search->OucomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="activity" data-field="x_OucomeCode" data-value-separator="<?php echo $activity_search->OucomeCode->displayValueSeparatorAttribute() ?>" id="x_OucomeCode" name="x_OucomeCode"<?php echo $activity_search->OucomeCode->editAttributes() ?>>
			<?php echo $activity_search->OucomeCode->selectOptionListHtml("x_OucomeCode") ?>
		</select>
</div>
<?php echo $activity_search->OucomeCode->Lookup->getParamTag($activity_search, "p_x_OucomeCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($activity_search->OutputCode->Visible) { // OutputCode ?>
	<div id="r_OutputCode" class="form-group row">
		<label for="x_OutputCode" class="<?php echo $activity_search->LeftColumnClass ?>"><span id="elh_activity_OutputCode"><?php echo $activity_search->OutputCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_OutputCode" id="z_OutputCode" value="=">
</span>
		</label>
		<div class="<?php echo $activity_search->RightColumnClass ?>"><div <?php echo $activity_search->OutputCode->cellAttributes() ?>>
			<span id="el_activity_OutputCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_OutputCode"><?php echo EmptyValue(strval($activity_search->OutputCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_search->OutputCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_search->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_search->OutputCode->ReadOnly || $activity_search->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_search->OutputCode->Lookup->getParamTag($activity_search, "p_x_OutputCode") ?>
<input type="hidden" data-table="activity" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_search->OutputCode->displayValueSeparatorAttribute() ?>" name="x_OutputCode" id="x_OutputCode" value="<?php echo $activity_search->OutputCode->AdvancedSearch->SearchValue ?>"<?php echo $activity_search->OutputCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($activity_search->ProjectCode->Visible) { // ProjectCode ?>
	<div id="r_ProjectCode" class="form-group row">
		<label class="<?php echo $activity_search->LeftColumnClass ?>"><span id="elh_activity_ProjectCode"><?php echo $activity_search->ProjectCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ProjectCode" id="z_ProjectCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $activity_search->RightColumnClass ?>"><div <?php echo $activity_search->ProjectCode->cellAttributes() ?>>
			<span id="el_activity_ProjectCode" class="ew-search-field">
<?php
$onchange = $activity_search->ProjectCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$activity_search->ProjectCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProjectCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ProjectCode" id="sv_x_ProjectCode" value="<?php echo RemoveHtml($activity_search->ProjectCode->EditValue) ?>" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($activity_search->ProjectCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($activity_search->ProjectCode->getPlaceHolder()) ?>"<?php echo $activity_search->ProjectCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_search->ProjectCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ProjectCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($activity_search->ProjectCode->ReadOnly || $activity_search->ProjectCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="activity" data-field="x_ProjectCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_search->ProjectCode->displayValueSeparatorAttribute() ?>" name="x_ProjectCode" id="x_ProjectCode" value="<?php echo HtmlEncode($activity_search->ProjectCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["factivitysearch"], function() {
	factivitysearch.createAutoSuggest({"id":"x_ProjectCode","forceSelect":false});
});
</script>
<?php echo $activity_search->ProjectCode->Lookup->getParamTag($activity_search, "p_x_ProjectCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($activity_search->ActivityCode->Visible) { // ActivityCode ?>
	<div id="r_ActivityCode" class="form-group row">
		<label for="x_ActivityCode" class="<?php echo $activity_search->LeftColumnClass ?>"><span id="elh_activity_ActivityCode"><?php echo $activity_search->ActivityCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ActivityCode" id="z_ActivityCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $activity_search->RightColumnClass ?>"><div <?php echo $activity_search->ActivityCode->cellAttributes() ?>>
			<span id="el_activity_ActivityCode" class="ew-search-field">
<input type="text" data-table="activity" data-field="x_ActivityCode" name="x_ActivityCode" id="x_ActivityCode" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($activity_search->ActivityCode->getPlaceHolder()) ?>" value="<?php echo $activity_search->ActivityCode->EditValue ?>"<?php echo $activity_search->ActivityCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($activity_search->FinancialYear->Visible) { // FinancialYear ?>
	<div id="r_FinancialYear" class="form-group row">
		<label for="x_FinancialYear" class="<?php echo $activity_search->LeftColumnClass ?>"><span id="elh_activity_FinancialYear"><?php echo $activity_search->FinancialYear->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_FinancialYear" id="z_FinancialYear" value="=">
</span>
		</label>
		<div class="<?php echo $activity_search->RightColumnClass ?>"><div <?php echo $activity_search->FinancialYear->cellAttributes() ?>>
			<span id="el_activity_FinancialYear" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="activity" data-field="x_FinancialYear" data-value-separator="<?php echo $activity_search->FinancialYear->displayValueSeparatorAttribute() ?>" id="x_FinancialYear" name="x_FinancialYear"<?php echo $activity_search->FinancialYear->editAttributes() ?>>
			<?php echo $activity_search->FinancialYear->selectOptionListHtml("x_FinancialYear") ?>
		</select>
</div>
<?php echo $activity_search->FinancialYear->Lookup->getParamTag($activity_search, "p_x_FinancialYear") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($activity_search->ActivityName->Visible) { // ActivityName ?>
	<div id="r_ActivityName" class="form-group row">
		<label for="x_ActivityName" class="<?php echo $activity_search->LeftColumnClass ?>"><span id="elh_activity_ActivityName"><?php echo $activity_search->ActivityName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ActivityName" id="z_ActivityName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $activity_search->RightColumnClass ?>"><div <?php echo $activity_search->ActivityName->cellAttributes() ?>>
			<span id="el_activity_ActivityName" class="ew-search-field">
<input type="text" data-table="activity" data-field="x_ActivityName" name="x_ActivityName" id="x_ActivityName" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($activity_search->ActivityName->getPlaceHolder()) ?>" value="<?php echo $activity_search->ActivityName->EditValue ?>"<?php echo $activity_search->ActivityName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($activity_search->MTEFBudget->Visible) { // MTEFBudget ?>
	<div id="r_MTEFBudget" class="form-group row">
		<label for="x_MTEFBudget" class="<?php echo $activity_search->LeftColumnClass ?>"><span id="elh_activity_MTEFBudget"><?php echo $activity_search->MTEFBudget->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_MTEFBudget" id="z_MTEFBudget" value="BETWEEN">
</span>
		</label>
		<div class="<?php echo $activity_search->RightColumnClass ?>"><div <?php echo $activity_search->MTEFBudget->cellAttributes() ?>>
			<span id="el_activity_MTEFBudget" class="ew-search-field">
<input type="text" data-table="activity" data-field="x_MTEFBudget" name="x_MTEFBudget" id="x_MTEFBudget" size="30" placeholder="<?php echo HtmlEncode($activity_search->MTEFBudget->getPlaceHolder()) ?>" value="<?php echo $activity_search->MTEFBudget->EditValue ?>"<?php echo $activity_search->MTEFBudget->editAttributes() ?>>
</span>
			<span class="ew-search-and"><label><?php echo $Language->phrase("AND") ?></label></span>
			<span id="el2_activity_MTEFBudget" class="ew-search-field2">
<input type="text" data-table="activity" data-field="x_MTEFBudget" name="y_MTEFBudget" id="y_MTEFBudget" size="30" placeholder="<?php echo HtmlEncode($activity_search->MTEFBudget->getPlaceHolder()) ?>" value="<?php echo $activity_search->MTEFBudget->EditValue2 ?>"<?php echo $activity_search->MTEFBudget->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($activity_search->SupplementaryBudget->Visible) { // SupplementaryBudget ?>
	<div id="r_SupplementaryBudget" class="form-group row">
		<label for="x_SupplementaryBudget" class="<?php echo $activity_search->LeftColumnClass ?>"><span id="elh_activity_SupplementaryBudget"><?php echo $activity_search->SupplementaryBudget->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SupplementaryBudget" id="z_SupplementaryBudget" value="=">
</span>
		</label>
		<div class="<?php echo $activity_search->RightColumnClass ?>"><div <?php echo $activity_search->SupplementaryBudget->cellAttributes() ?>>
			<span id="el_activity_SupplementaryBudget" class="ew-search-field">
<input type="text" data-table="activity" data-field="x_SupplementaryBudget" name="x_SupplementaryBudget" id="x_SupplementaryBudget" size="30" placeholder="<?php echo HtmlEncode($activity_search->SupplementaryBudget->getPlaceHolder()) ?>" value="<?php echo $activity_search->SupplementaryBudget->EditValue ?>"<?php echo $activity_search->SupplementaryBudget->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($activity_search->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
	<div id="r_ExpectedAnnualAchievement" class="form-group row">
		<label for="x_ExpectedAnnualAchievement" class="<?php echo $activity_search->LeftColumnClass ?>"><span id="elh_activity_ExpectedAnnualAchievement"><?php echo $activity_search->ExpectedAnnualAchievement->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ExpectedAnnualAchievement" id="z_ExpectedAnnualAchievement" value="LIKE">
</span>
		</label>
		<div class="<?php echo $activity_search->RightColumnClass ?>"><div <?php echo $activity_search->ExpectedAnnualAchievement->cellAttributes() ?>>
			<span id="el_activity_ExpectedAnnualAchievement" class="ew-search-field">
<input type="text" data-table="activity" data-field="x_ExpectedAnnualAchievement" name="x_ExpectedAnnualAchievement" id="x_ExpectedAnnualAchievement" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($activity_search->ExpectedAnnualAchievement->getPlaceHolder()) ?>" value="<?php echo $activity_search->ExpectedAnnualAchievement->EditValue ?>"<?php echo $activity_search->ExpectedAnnualAchievement->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($activity_search->ActivityLocation->Visible) { // ActivityLocation ?>
	<div id="r_ActivityLocation" class="form-group row">
		<label for="x_ActivityLocation" class="<?php echo $activity_search->LeftColumnClass ?>"><span id="elh_activity_ActivityLocation"><?php echo $activity_search->ActivityLocation->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ActivityLocation" id="z_ActivityLocation" value="LIKE">
</span>
		</label>
		<div class="<?php echo $activity_search->RightColumnClass ?>"><div <?php echo $activity_search->ActivityLocation->cellAttributes() ?>>
			<span id="el_activity_ActivityLocation" class="ew-search-field">
<input type="text" data-table="activity" data-field="x_ActivityLocation" name="x_ActivityLocation" id="x_ActivityLocation" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($activity_search->ActivityLocation->getPlaceHolder()) ?>" value="<?php echo $activity_search->ActivityLocation->EditValue ?>"<?php echo $activity_search->ActivityLocation->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$activity_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $activity_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$activity_search->showPageFooter();
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
$activity_search->terminate();
?>