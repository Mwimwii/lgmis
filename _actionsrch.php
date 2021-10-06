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
$_action_search = new _action_search();

// Run the page
$_action_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_action_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var f_actionsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($_action_search->IsModal) { ?>
	f_actionsearch = currentAdvancedSearchForm = new ew.Form("f_actionsearch", "search");
	<?php } else { ?>
	f_actionsearch = currentForm = new ew.Form("f_actionsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	f_actionsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_OucomeCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_action_search->OucomeCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_OutputCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_action_search->OutputCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ActionCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_action_search->ActionCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_FinancialYear");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_action_search->FinancialYear->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_MTEFBudget");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_action_search->MTEFBudget->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_SupplementaryBudget");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_action_search->SupplementaryBudget->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Latitude");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_action_search->Latitude->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Longitude");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_action_search->Longitude->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	f_actionsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	f_actionsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	f_actionsearch.lists["x_ProgramCode"] = <?php echo $_action_search->ProgramCode->Lookup->toClientList($_action_search) ?>;
	f_actionsearch.lists["x_ProgramCode"].options = <?php echo JsonEncode($_action_search->ProgramCode->lookupOptions()) ?>;
	f_actionsearch.autoSuggests["x_ProgramCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	f_actionsearch.lists["x_OucomeCode"] = <?php echo $_action_search->OucomeCode->Lookup->toClientList($_action_search) ?>;
	f_actionsearch.lists["x_OucomeCode"].options = <?php echo JsonEncode($_action_search->OucomeCode->lookupOptions()) ?>;
	f_actionsearch.autoSuggests["x_OucomeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	f_actionsearch.lists["x_OutputCode"] = <?php echo $_action_search->OutputCode->Lookup->toClientList($_action_search) ?>;
	f_actionsearch.lists["x_OutputCode"].options = <?php echo JsonEncode($_action_search->OutputCode->lookupOptions()) ?>;
	f_actionsearch.autoSuggests["x_OutputCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	f_actionsearch.lists["x_ProjectCode"] = <?php echo $_action_search->ProjectCode->Lookup->toClientList($_action_search) ?>;
	f_actionsearch.lists["x_ProjectCode"].options = <?php echo JsonEncode($_action_search->ProjectCode->lookupOptions()) ?>;
	f_actionsearch.lists["x_ActionType"] = <?php echo $_action_search->ActionType->Lookup->toClientList($_action_search) ?>;
	f_actionsearch.lists["x_ActionType"].options = <?php echo JsonEncode($_action_search->ActionType->lookupOptions()) ?>;
	f_actionsearch.lists["x_LACode"] = <?php echo $_action_search->LACode->Lookup->toClientList($_action_search) ?>;
	f_actionsearch.lists["x_LACode"].options = <?php echo JsonEncode($_action_search->LACode->lookupOptions()) ?>;
	f_actionsearch.lists["x_DepartmentCode"] = <?php echo $_action_search->DepartmentCode->Lookup->toClientList($_action_search) ?>;
	f_actionsearch.lists["x_DepartmentCode"].options = <?php echo JsonEncode($_action_search->DepartmentCode->lookupOptions()) ?>;
	f_actionsearch.lists["x_SectionCode"] = <?php echo $_action_search->SectionCode->Lookup->toClientList($_action_search) ?>;
	f_actionsearch.lists["x_SectionCode"].options = <?php echo JsonEncode($_action_search->SectionCode->lookupOptions()) ?>;
	loadjs.done("f_actionsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $_action_search->showPageHeader(); ?>
<?php
$_action_search->showMessage();
?>
<form name="f_actionsearch" id="f_actionsearch" class="<?php echo $_action_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_action">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$_action_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($_action_search->ProgramCode->Visible) { // ProgramCode ?>
	<div id="r_ProgramCode" class="form-group row">
		<label class="<?php echo $_action_search->LeftColumnClass ?>"><span id="elh__action_ProgramCode"><?php echo $_action_search->ProgramCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ProgramCode" id="z_ProgramCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_action_search->RightColumnClass ?>"><div <?php echo $_action_search->ProgramCode->cellAttributes() ?>>
			<span id="el__action_ProgramCode" class="ew-search-field">
<?php
$onchange = $_action_search->ProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_search->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProgramCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ProgramCode" id="sv_x_ProgramCode" value="<?php echo RemoveHtml($_action_search->ProgramCode->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($_action_search->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_search->ProgramCode->getPlaceHolder()) ?>"<?php echo $_action_search->ProgramCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_search->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ProgramCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_search->ProgramCode->ReadOnly || $_action_search->ProgramCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_search->ProgramCode->displayValueSeparatorAttribute() ?>" name="x_ProgramCode" id="x_ProgramCode" value="<?php echo HtmlEncode($_action_search->ProgramCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actionsearch"], function() {
	f_actionsearch.createAutoSuggest({"id":"x_ProgramCode","forceSelect":false});
});
</script>
<?php echo $_action_search->ProgramCode->Lookup->getParamTag($_action_search, "p_x_ProgramCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_action_search->OucomeCode->Visible) { // OucomeCode ?>
	<div id="r_OucomeCode" class="form-group row">
		<label class="<?php echo $_action_search->LeftColumnClass ?>"><span id="elh__action_OucomeCode"><?php echo $_action_search->OucomeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_OucomeCode" id="z_OucomeCode" value="=">
</span>
		</label>
		<div class="<?php echo $_action_search->RightColumnClass ?>"><div <?php echo $_action_search->OucomeCode->cellAttributes() ?>>
			<span id="el__action_OucomeCode" class="ew-search-field">
<?php
$onchange = $_action_search->OucomeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_search->OucomeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_OucomeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_OucomeCode" id="sv_x_OucomeCode" value="<?php echo RemoveHtml($_action_search->OucomeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_action_search->OucomeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_search->OucomeCode->getPlaceHolder()) ?>"<?php echo $_action_search->OucomeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_search->OucomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_OucomeCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_search->OucomeCode->ReadOnly || $_action_search->OucomeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_OucomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_search->OucomeCode->displayValueSeparatorAttribute() ?>" name="x_OucomeCode" id="x_OucomeCode" value="<?php echo HtmlEncode($_action_search->OucomeCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actionsearch"], function() {
	f_actionsearch.createAutoSuggest({"id":"x_OucomeCode","forceSelect":false});
});
</script>
<?php echo $_action_search->OucomeCode->Lookup->getParamTag($_action_search, "p_x_OucomeCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_action_search->OutputCode->Visible) { // OutputCode ?>
	<div id="r_OutputCode" class="form-group row">
		<label class="<?php echo $_action_search->LeftColumnClass ?>"><span id="elh__action_OutputCode"><?php echo $_action_search->OutputCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_OutputCode" id="z_OutputCode" value="=">
</span>
		</label>
		<div class="<?php echo $_action_search->RightColumnClass ?>"><div <?php echo $_action_search->OutputCode->cellAttributes() ?>>
			<span id="el__action_OutputCode" class="ew-search-field">
<?php
$onchange = $_action_search->OutputCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_search->OutputCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_OutputCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_OutputCode" id="sv_x_OutputCode" value="<?php echo RemoveHtml($_action_search->OutputCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_action_search->OutputCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_search->OutputCode->getPlaceHolder()) ?>"<?php echo $_action_search->OutputCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_search->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_OutputCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_search->OutputCode->ReadOnly || $_action_search->OutputCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_search->OutputCode->displayValueSeparatorAttribute() ?>" name="x_OutputCode" id="x_OutputCode" value="<?php echo HtmlEncode($_action_search->OutputCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actionsearch"], function() {
	f_actionsearch.createAutoSuggest({"id":"x_OutputCode","forceSelect":false});
});
</script>
<?php echo $_action_search->OutputCode->Lookup->getParamTag($_action_search, "p_x_OutputCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_action_search->ProjectCode->Visible) { // ProjectCode ?>
	<div id="r_ProjectCode" class="form-group row">
		<label for="x_ProjectCode" class="<?php echo $_action_search->LeftColumnClass ?>"><span id="elh__action_ProjectCode"><?php echo $_action_search->ProjectCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ProjectCode" id="z_ProjectCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_action_search->RightColumnClass ?>"><div <?php echo $_action_search->ProjectCode->cellAttributes() ?>>
			<span id="el__action_ProjectCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ProjectCode"><?php echo EmptyValue(strval($_action_search->ProjectCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $_action_search->ProjectCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_search->ProjectCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($_action_search->ProjectCode->ReadOnly || $_action_search->ProjectCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ProjectCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $_action_search->ProjectCode->Lookup->getParamTag($_action_search, "p_x_ProjectCode") ?>
<input type="hidden" data-table="_action" data-field="x_ProjectCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_search->ProjectCode->displayValueSeparatorAttribute() ?>" name="x_ProjectCode" id="x_ProjectCode" value="<?php echo $_action_search->ProjectCode->AdvancedSearch->SearchValue ?>"<?php echo $_action_search->ProjectCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_action_search->ActionCode->Visible) { // ActionCode ?>
	<div id="r_ActionCode" class="form-group row">
		<label for="x_ActionCode" class="<?php echo $_action_search->LeftColumnClass ?>"><span id="elh__action_ActionCode"><?php echo $_action_search->ActionCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ActionCode" id="z_ActionCode" value="=">
</span>
		</label>
		<div class="<?php echo $_action_search->RightColumnClass ?>"><div <?php echo $_action_search->ActionCode->cellAttributes() ?>>
			<span id="el__action_ActionCode" class="ew-search-field">
<input type="text" data-table="_action" data-field="x_ActionCode" name="x_ActionCode" id="x_ActionCode" placeholder="<?php echo HtmlEncode($_action_search->ActionCode->getPlaceHolder()) ?>" value="<?php echo $_action_search->ActionCode->EditValue ?>"<?php echo $_action_search->ActionCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_action_search->ActionName->Visible) { // ActionName ?>
	<div id="r_ActionName" class="form-group row">
		<label for="x_ActionName" class="<?php echo $_action_search->LeftColumnClass ?>"><span id="elh__action_ActionName"><?php echo $_action_search->ActionName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ActionName" id="z_ActionName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_action_search->RightColumnClass ?>"><div <?php echo $_action_search->ActionName->cellAttributes() ?>>
			<span id="el__action_ActionName" class="ew-search-field">
<input type="text" data-table="_action" data-field="x_ActionName" name="x_ActionName" id="x_ActionName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($_action_search->ActionName->getPlaceHolder()) ?>" value="<?php echo $_action_search->ActionName->EditValue ?>"<?php echo $_action_search->ActionName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_action_search->ActionType->Visible) { // ActionType ?>
	<div id="r_ActionType" class="form-group row">
		<label for="x_ActionType" class="<?php echo $_action_search->LeftColumnClass ?>"><span id="elh__action_ActionType"><?php echo $_action_search->ActionType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ActionType" id="z_ActionType" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_action_search->RightColumnClass ?>"><div <?php echo $_action_search->ActionType->cellAttributes() ?>>
			<span id="el__action_ActionType" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_ActionType" data-value-separator="<?php echo $_action_search->ActionType->displayValueSeparatorAttribute() ?>" id="x_ActionType" name="x_ActionType"<?php echo $_action_search->ActionType->editAttributes() ?>>
			<?php echo $_action_search->ActionType->selectOptionListHtml("x_ActionType") ?>
		</select>
</div>
<?php echo $_action_search->ActionType->Lookup->getParamTag($_action_search, "p_x_ActionType") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_action_search->FinancialYear->Visible) { // FinancialYear ?>
	<div id="r_FinancialYear" class="form-group row">
		<label for="x_FinancialYear" class="<?php echo $_action_search->LeftColumnClass ?>"><span id="elh__action_FinancialYear"><?php echo $_action_search->FinancialYear->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_FinancialYear" id="z_FinancialYear" value="=">
</span>
		</label>
		<div class="<?php echo $_action_search->RightColumnClass ?>"><div <?php echo $_action_search->FinancialYear->cellAttributes() ?>>
			<span id="el__action_FinancialYear" class="ew-search-field">
<input type="text" data-table="_action" data-field="x_FinancialYear" name="x_FinancialYear" id="x_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($_action_search->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $_action_search->FinancialYear->EditValue ?>"<?php echo $_action_search->FinancialYear->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_action_search->MTEFBudget->Visible) { // MTEFBudget ?>
	<div id="r_MTEFBudget" class="form-group row">
		<label for="x_MTEFBudget" class="<?php echo $_action_search->LeftColumnClass ?>"><span id="elh__action_MTEFBudget"><?php echo $_action_search->MTEFBudget->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_MTEFBudget" id="z_MTEFBudget" value="=">
</span>
		</label>
		<div class="<?php echo $_action_search->RightColumnClass ?>"><div <?php echo $_action_search->MTEFBudget->cellAttributes() ?>>
			<span id="el__action_MTEFBudget" class="ew-search-field">
<input type="text" data-table="_action" data-field="x_MTEFBudget" name="x_MTEFBudget" id="x_MTEFBudget" size="30" placeholder="<?php echo HtmlEncode($_action_search->MTEFBudget->getPlaceHolder()) ?>" value="<?php echo $_action_search->MTEFBudget->EditValue ?>"<?php echo $_action_search->MTEFBudget->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_action_search->SupplementaryBudget->Visible) { // SupplementaryBudget ?>
	<div id="r_SupplementaryBudget" class="form-group row">
		<label for="x_SupplementaryBudget" class="<?php echo $_action_search->LeftColumnClass ?>"><span id="elh__action_SupplementaryBudget"><?php echo $_action_search->SupplementaryBudget->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SupplementaryBudget" id="z_SupplementaryBudget" value="=">
</span>
		</label>
		<div class="<?php echo $_action_search->RightColumnClass ?>"><div <?php echo $_action_search->SupplementaryBudget->cellAttributes() ?>>
			<span id="el__action_SupplementaryBudget" class="ew-search-field">
<input type="text" data-table="_action" data-field="x_SupplementaryBudget" name="x_SupplementaryBudget" id="x_SupplementaryBudget" size="30" placeholder="<?php echo HtmlEncode($_action_search->SupplementaryBudget->getPlaceHolder()) ?>" value="<?php echo $_action_search->SupplementaryBudget->EditValue ?>"<?php echo $_action_search->SupplementaryBudget->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_action_search->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
	<div id="r_ExpectedAnnualAchievement" class="form-group row">
		<label for="x_ExpectedAnnualAchievement" class="<?php echo $_action_search->LeftColumnClass ?>"><span id="elh__action_ExpectedAnnualAchievement"><?php echo $_action_search->ExpectedAnnualAchievement->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ExpectedAnnualAchievement" id="z_ExpectedAnnualAchievement" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_action_search->RightColumnClass ?>"><div <?php echo $_action_search->ExpectedAnnualAchievement->cellAttributes() ?>>
			<span id="el__action_ExpectedAnnualAchievement" class="ew-search-field">
<input type="text" data-table="_action" data-field="x_ExpectedAnnualAchievement" name="x_ExpectedAnnualAchievement" id="x_ExpectedAnnualAchievement" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($_action_search->ExpectedAnnualAchievement->getPlaceHolder()) ?>" value="<?php echo $_action_search->ExpectedAnnualAchievement->EditValue ?>"<?php echo $_action_search->ExpectedAnnualAchievement->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_action_search->ActionLocation->Visible) { // ActionLocation ?>
	<div id="r_ActionLocation" class="form-group row">
		<label for="x_ActionLocation" class="<?php echo $_action_search->LeftColumnClass ?>"><span id="elh__action_ActionLocation"><?php echo $_action_search->ActionLocation->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ActionLocation" id="z_ActionLocation" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_action_search->RightColumnClass ?>"><div <?php echo $_action_search->ActionLocation->cellAttributes() ?>>
			<span id="el__action_ActionLocation" class="ew-search-field">
<input type="text" data-table="_action" data-field="x_ActionLocation" name="x_ActionLocation" id="x_ActionLocation" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_action_search->ActionLocation->getPlaceHolder()) ?>" value="<?php echo $_action_search->ActionLocation->EditValue ?>"<?php echo $_action_search->ActionLocation->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_action_search->Latitude->Visible) { // Latitude ?>
	<div id="r_Latitude" class="form-group row">
		<label for="x_Latitude" class="<?php echo $_action_search->LeftColumnClass ?>"><span id="elh__action_Latitude"><?php echo $_action_search->Latitude->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Latitude" id="z_Latitude" value="=">
</span>
		</label>
		<div class="<?php echo $_action_search->RightColumnClass ?>"><div <?php echo $_action_search->Latitude->cellAttributes() ?>>
			<span id="el__action_Latitude" class="ew-search-field">
<input type="text" data-table="_action" data-field="x_Latitude" name="x_Latitude" id="x_Latitude" size="30" placeholder="<?php echo HtmlEncode($_action_search->Latitude->getPlaceHolder()) ?>" value="<?php echo $_action_search->Latitude->EditValue ?>"<?php echo $_action_search->Latitude->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_action_search->Longitude->Visible) { // Longitude ?>
	<div id="r_Longitude" class="form-group row">
		<label for="x_Longitude" class="<?php echo $_action_search->LeftColumnClass ?>"><span id="elh__action_Longitude"><?php echo $_action_search->Longitude->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Longitude" id="z_Longitude" value="=">
</span>
		</label>
		<div class="<?php echo $_action_search->RightColumnClass ?>"><div <?php echo $_action_search->Longitude->cellAttributes() ?>>
			<span id="el__action_Longitude" class="ew-search-field">
<input type="text" data-table="_action" data-field="x_Longitude" name="x_Longitude" id="x_Longitude" size="30" placeholder="<?php echo HtmlEncode($_action_search->Longitude->getPlaceHolder()) ?>" value="<?php echo $_action_search->Longitude->EditValue ?>"<?php echo $_action_search->Longitude->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_action_search->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label for="x_LACode" class="<?php echo $_action_search->LeftColumnClass ?>"><span id="elh__action_LACode"><?php echo $_action_search->LACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_action_search->RightColumnClass ?>"><div <?php echo $_action_search->LACode->cellAttributes() ?>>
			<span id="el__action_LACode" class="ew-search-field">
<?php $_action_search->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($_action_search->LACode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $_action_search->LACode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_search->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($_action_search->LACode->ReadOnly || $_action_search->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $_action_search->LACode->Lookup->getParamTag($_action_search, "p_x_LACode") ?>
<input type="hidden" data-table="_action" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_search->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $_action_search->LACode->AdvancedSearch->SearchValue ?>"<?php echo $_action_search->LACode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_action_search->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label for="x_DepartmentCode" class="<?php echo $_action_search->LeftColumnClass ?>"><span id="elh__action_DepartmentCode"><?php echo $_action_search->DepartmentCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DepartmentCode" id="z_DepartmentCode" value="=">
</span>
		</label>
		<div class="<?php echo $_action_search->RightColumnClass ?>"><div <?php echo $_action_search->DepartmentCode->cellAttributes() ?>>
			<span id="el__action_DepartmentCode" class="ew-search-field">
<?php $_action_search->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_DepartmentCode" data-value-separator="<?php echo $_action_search->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $_action_search->DepartmentCode->editAttributes() ?>>
			<?php echo $_action_search->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $_action_search->DepartmentCode->Lookup->getParamTag($_action_search, "p_x_DepartmentCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_action_search->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label for="x_SectionCode" class="<?php echo $_action_search->LeftColumnClass ?>"><span id="elh__action_SectionCode"><?php echo $_action_search->SectionCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SectionCode" id="z_SectionCode" value="=">
</span>
		</label>
		<div class="<?php echo $_action_search->RightColumnClass ?>"><div <?php echo $_action_search->SectionCode->cellAttributes() ?>>
			<span id="el__action_SectionCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_SectionCode" data-value-separator="<?php echo $_action_search->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $_action_search->SectionCode->editAttributes() ?>>
			<?php echo $_action_search->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $_action_search->SectionCode->Lookup->getParamTag($_action_search, "p_x_SectionCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$_action_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $_action_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$_action_search->showPageFooter();
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
$_action_search->terminate();
?>