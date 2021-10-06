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
$outcome_search = new outcome_search();

// Run the page
$outcome_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$outcome_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var foutcomesearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($outcome_search->IsModal) { ?>
	foutcomesearch = currentAdvancedSearchForm = new ew.Form("foutcomesearch", "search");
	<?php } else { ?>
	foutcomesearch = currentForm = new ew.Form("foutcomesearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	foutcomesearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_OutcomeCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($outcome_search->OutcomeCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_StrategicObjectiveCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($outcome_search->StrategicObjectiveCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_LockStatus");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($outcome_search->LockStatus->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	foutcomesearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	foutcomesearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	foutcomesearch.lists["x_StrategicObjectiveCode"] = <?php echo $outcome_search->StrategicObjectiveCode->Lookup->toClientList($outcome_search) ?>;
	foutcomesearch.lists["x_StrategicObjectiveCode"].options = <?php echo JsonEncode($outcome_search->StrategicObjectiveCode->lookupOptions()) ?>;
	foutcomesearch.autoSuggests["x_StrategicObjectiveCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutcomesearch.lists["x_LACode"] = <?php echo $outcome_search->LACode->Lookup->toClientList($outcome_search) ?>;
	foutcomesearch.lists["x_LACode"].options = <?php echo JsonEncode($outcome_search->LACode->lookupOptions()) ?>;
	foutcomesearch.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutcomesearch.lists["x_DepartmentCode"] = <?php echo $outcome_search->DepartmentCode->Lookup->toClientList($outcome_search) ?>;
	foutcomesearch.lists["x_DepartmentCode"].options = <?php echo JsonEncode($outcome_search->DepartmentCode->lookupOptions()) ?>;
	foutcomesearch.lists["x_ResultAreaCode"] = <?php echo $outcome_search->ResultAreaCode->Lookup->toClientList($outcome_search) ?>;
	foutcomesearch.lists["x_ResultAreaCode"].options = <?php echo JsonEncode($outcome_search->ResultAreaCode->lookupOptions()) ?>;
	foutcomesearch.lists["x_OutcomeStatus"] = <?php echo $outcome_search->OutcomeStatus->Lookup->toClientList($outcome_search) ?>;
	foutcomesearch.lists["x_OutcomeStatus"].options = <?php echo JsonEncode($outcome_search->OutcomeStatus->lookupOptions()) ?>;
	loadjs.done("foutcomesearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $outcome_search->showPageHeader(); ?>
<?php
$outcome_search->showMessage();
?>
<form name="foutcomesearch" id="foutcomesearch" class="<?php echo $outcome_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="outcome">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$outcome_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($outcome_search->OutcomeCode->Visible) { // OutcomeCode ?>
	<div id="r_OutcomeCode" class="form-group row">
		<label for="x_OutcomeCode" class="<?php echo $outcome_search->LeftColumnClass ?>"><span id="elh_outcome_OutcomeCode"><?php echo $outcome_search->OutcomeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_OutcomeCode" id="z_OutcomeCode" value="=">
</span>
		</label>
		<div class="<?php echo $outcome_search->RightColumnClass ?>"><div <?php echo $outcome_search->OutcomeCode->cellAttributes() ?>>
			<span id="el_outcome_OutcomeCode" class="ew-search-field">
<input type="text" data-table="outcome" data-field="x_OutcomeCode" name="x_OutcomeCode" id="x_OutcomeCode" placeholder="<?php echo HtmlEncode($outcome_search->OutcomeCode->getPlaceHolder()) ?>" value="<?php echo $outcome_search->OutcomeCode->EditValue ?>"<?php echo $outcome_search->OutcomeCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($outcome_search->OutcomeName->Visible) { // OutcomeName ?>
	<div id="r_OutcomeName" class="form-group row">
		<label for="x_OutcomeName" class="<?php echo $outcome_search->LeftColumnClass ?>"><span id="elh_outcome_OutcomeName"><?php echo $outcome_search->OutcomeName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_OutcomeName" id="z_OutcomeName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $outcome_search->RightColumnClass ?>"><div <?php echo $outcome_search->OutcomeName->cellAttributes() ?>>
			<span id="el_outcome_OutcomeName" class="ew-search-field">
<input type="text" data-table="outcome" data-field="x_OutcomeName" name="x_OutcomeName" id="x_OutcomeName" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($outcome_search->OutcomeName->getPlaceHolder()) ?>" value="<?php echo $outcome_search->OutcomeName->EditValue ?>"<?php echo $outcome_search->OutcomeName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($outcome_search->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
	<div id="r_StrategicObjectiveCode" class="form-group row">
		<label class="<?php echo $outcome_search->LeftColumnClass ?>"><span id="elh_outcome_StrategicObjectiveCode"><?php echo $outcome_search->StrategicObjectiveCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_StrategicObjectiveCode" id="z_StrategicObjectiveCode" value="=">
</span>
		</label>
		<div class="<?php echo $outcome_search->RightColumnClass ?>"><div <?php echo $outcome_search->StrategicObjectiveCode->cellAttributes() ?>>
			<span id="el_outcome_StrategicObjectiveCode" class="ew-search-field">
<?php
$onchange = $outcome_search->StrategicObjectiveCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$outcome_search->StrategicObjectiveCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_StrategicObjectiveCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_StrategicObjectiveCode" id="sv_x_StrategicObjectiveCode" value="<?php echo RemoveHtml($outcome_search->StrategicObjectiveCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($outcome_search->StrategicObjectiveCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($outcome_search->StrategicObjectiveCode->getPlaceHolder()) ?>"<?php echo $outcome_search->StrategicObjectiveCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_search->StrategicObjectiveCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_StrategicObjectiveCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_search->StrategicObjectiveCode->ReadOnly || $outcome_search->StrategicObjectiveCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="outcome" data-field="x_StrategicObjectiveCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_search->StrategicObjectiveCode->displayValueSeparatorAttribute() ?>" name="x_StrategicObjectiveCode" id="x_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_search->StrategicObjectiveCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutcomesearch"], function() {
	foutcomesearch.createAutoSuggest({"id":"x_StrategicObjectiveCode","forceSelect":true});
});
</script>
<?php echo $outcome_search->StrategicObjectiveCode->Lookup->getParamTag($outcome_search, "p_x_StrategicObjectiveCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($outcome_search->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label class="<?php echo $outcome_search->LeftColumnClass ?>"><span id="elh_outcome_LACode"><?php echo $outcome_search->LACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $outcome_search->RightColumnClass ?>"><div <?php echo $outcome_search->LACode->cellAttributes() ?>>
			<span id="el_outcome_LACode" class="ew-search-field">
<?php
$onchange = $outcome_search->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$outcome_search->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($outcome_search->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($outcome_search->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($outcome_search->LACode->getPlaceHolder()) ?>"<?php echo $outcome_search->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_search->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_search->LACode->ReadOnly || $outcome_search->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="outcome" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_search->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($outcome_search->LACode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutcomesearch"], function() {
	foutcomesearch.createAutoSuggest({"id":"x_LACode","forceSelect":true});
});
</script>
<?php echo $outcome_search->LACode->Lookup->getParamTag($outcome_search, "p_x_LACode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($outcome_search->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label for="x_DepartmentCode" class="<?php echo $outcome_search->LeftColumnClass ?>"><span id="elh_outcome_DepartmentCode"><?php echo $outcome_search->DepartmentCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DepartmentCode" id="z_DepartmentCode" value="=">
</span>
		</label>
		<div class="<?php echo $outcome_search->RightColumnClass ?>"><div <?php echo $outcome_search->DepartmentCode->cellAttributes() ?>>
			<span id="el_outcome_DepartmentCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DepartmentCode"><?php echo EmptyValue(strval($outcome_search->DepartmentCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $outcome_search->DepartmentCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_search->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_search->DepartmentCode->ReadOnly || $outcome_search->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $outcome_search->DepartmentCode->Lookup->getParamTag($outcome_search, "p_x_DepartmentCode") ?>
<input type="hidden" data-table="outcome" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_search->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo $outcome_search->DepartmentCode->AdvancedSearch->SearchValue ?>"<?php echo $outcome_search->DepartmentCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($outcome_search->ResultAreaCode->Visible) { // ResultAreaCode ?>
	<div id="r_ResultAreaCode" class="form-group row">
		<label for="x_ResultAreaCode" class="<?php echo $outcome_search->LeftColumnClass ?>"><span id="elh_outcome_ResultAreaCode"><?php echo $outcome_search->ResultAreaCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ResultAreaCode" id="z_ResultAreaCode" value="=">
</span>
		</label>
		<div class="<?php echo $outcome_search->RightColumnClass ?>"><div <?php echo $outcome_search->ResultAreaCode->cellAttributes() ?>>
			<span id="el_outcome_ResultAreaCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ResultAreaCode"><?php echo EmptyValue(strval($outcome_search->ResultAreaCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $outcome_search->ResultAreaCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_search->ResultAreaCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_search->ResultAreaCode->ReadOnly || $outcome_search->ResultAreaCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ResultAreaCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $outcome_search->ResultAreaCode->Lookup->getParamTag($outcome_search, "p_x_ResultAreaCode") ?>
<input type="hidden" data-table="outcome" data-field="x_ResultAreaCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_search->ResultAreaCode->displayValueSeparatorAttribute() ?>" name="x_ResultAreaCode" id="x_ResultAreaCode" value="<?php echo $outcome_search->ResultAreaCode->AdvancedSearch->SearchValue ?>"<?php echo $outcome_search->ResultAreaCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($outcome_search->OutcomeKPI->Visible) { // OutcomeKPI ?>
	<div id="r_OutcomeKPI" class="form-group row">
		<label for="x_OutcomeKPI" class="<?php echo $outcome_search->LeftColumnClass ?>"><span id="elh_outcome_OutcomeKPI"><?php echo $outcome_search->OutcomeKPI->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_OutcomeKPI" id="z_OutcomeKPI" value="LIKE">
</span>
		</label>
		<div class="<?php echo $outcome_search->RightColumnClass ?>"><div <?php echo $outcome_search->OutcomeKPI->cellAttributes() ?>>
			<span id="el_outcome_OutcomeKPI" class="ew-search-field">
<input type="text" data-table="outcome" data-field="x_OutcomeKPI" name="x_OutcomeKPI" id="x_OutcomeKPI" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($outcome_search->OutcomeKPI->getPlaceHolder()) ?>" value="<?php echo $outcome_search->OutcomeKPI->EditValue ?>"<?php echo $outcome_search->OutcomeKPI->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($outcome_search->Assumptions->Visible) { // Assumptions ?>
	<div id="r_Assumptions" class="form-group row">
		<label for="x_Assumptions" class="<?php echo $outcome_search->LeftColumnClass ?>"><span id="elh_outcome_Assumptions"><?php echo $outcome_search->Assumptions->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Assumptions" id="z_Assumptions" value="LIKE">
</span>
		</label>
		<div class="<?php echo $outcome_search->RightColumnClass ?>"><div <?php echo $outcome_search->Assumptions->cellAttributes() ?>>
			<span id="el_outcome_Assumptions" class="ew-search-field">
<input type="text" data-table="outcome" data-field="x_Assumptions" name="x_Assumptions" id="x_Assumptions" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($outcome_search->Assumptions->getPlaceHolder()) ?>" value="<?php echo $outcome_search->Assumptions->EditValue ?>"<?php echo $outcome_search->Assumptions->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($outcome_search->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
	<div id="r_ResponsibleOfficer" class="form-group row">
		<label for="x_ResponsibleOfficer" class="<?php echo $outcome_search->LeftColumnClass ?>"><span id="elh_outcome_ResponsibleOfficer"><?php echo $outcome_search->ResponsibleOfficer->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ResponsibleOfficer" id="z_ResponsibleOfficer" value="LIKE">
</span>
		</label>
		<div class="<?php echo $outcome_search->RightColumnClass ?>"><div <?php echo $outcome_search->ResponsibleOfficer->cellAttributes() ?>>
			<span id="el_outcome_ResponsibleOfficer" class="ew-search-field">
<input type="text" data-table="outcome" data-field="x_ResponsibleOfficer" name="x_ResponsibleOfficer" id="x_ResponsibleOfficer" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($outcome_search->ResponsibleOfficer->getPlaceHolder()) ?>" value="<?php echo $outcome_search->ResponsibleOfficer->EditValue ?>"<?php echo $outcome_search->ResponsibleOfficer->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($outcome_search->OutcomeStatus->Visible) { // OutcomeStatus ?>
	<div id="r_OutcomeStatus" class="form-group row">
		<label for="x_OutcomeStatus" class="<?php echo $outcome_search->LeftColumnClass ?>"><span id="elh_outcome_OutcomeStatus"><?php echo $outcome_search->OutcomeStatus->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_OutcomeStatus" id="z_OutcomeStatus" value="LIKE">
</span>
		</label>
		<div class="<?php echo $outcome_search->RightColumnClass ?>"><div <?php echo $outcome_search->OutcomeStatus->cellAttributes() ?>>
			<span id="el_outcome_OutcomeStatus" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="outcome" data-field="x_OutcomeStatus" data-value-separator="<?php echo $outcome_search->OutcomeStatus->displayValueSeparatorAttribute() ?>" id="x_OutcomeStatus" name="x_OutcomeStatus"<?php echo $outcome_search->OutcomeStatus->editAttributes() ?>>
			<?php echo $outcome_search->OutcomeStatus->selectOptionListHtml("x_OutcomeStatus") ?>
		</select>
</div>
<?php echo $outcome_search->OutcomeStatus->Lookup->getParamTag($outcome_search, "p_x_OutcomeStatus") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($outcome_search->LockStatus->Visible) { // LockStatus ?>
	<div id="r_LockStatus" class="form-group row">
		<label for="x_LockStatus" class="<?php echo $outcome_search->LeftColumnClass ?>"><span id="elh_outcome_LockStatus"><?php echo $outcome_search->LockStatus->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LockStatus" id="z_LockStatus" value="=">
</span>
		</label>
		<div class="<?php echo $outcome_search->RightColumnClass ?>"><div <?php echo $outcome_search->LockStatus->cellAttributes() ?>>
			<span id="el_outcome_LockStatus" class="ew-search-field">
<input type="text" data-table="outcome" data-field="x_LockStatus" name="x_LockStatus" id="x_LockStatus" size="30" placeholder="<?php echo HtmlEncode($outcome_search->LockStatus->getPlaceHolder()) ?>" value="<?php echo $outcome_search->LockStatus->EditValue ?>"<?php echo $outcome_search->LockStatus->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$outcome_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $outcome_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$outcome_search->showPageFooter();
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
$outcome_search->terminate();
?>