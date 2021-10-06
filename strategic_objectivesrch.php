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
$strategic_objective_search = new strategic_objective_search();

// Run the page
$strategic_objective_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$strategic_objective_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstrategic_objectivesearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($strategic_objective_search->IsModal) { ?>
	fstrategic_objectivesearch = currentAdvancedSearchForm = new ew.Form("fstrategic_objectivesearch", "search");
	<?php } else { ?>
	fstrategic_objectivesearch = currentForm = new ew.Form("fstrategic_objectivesearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fstrategic_objectivesearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_StrategicObjectiveCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($strategic_objective_search->StrategicObjectiveCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ResultAreaCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($strategic_objective_search->ResultAreaCode->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fstrategic_objectivesearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstrategic_objectivesearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstrategic_objectivesearch.lists["x_LACode"] = <?php echo $strategic_objective_search->LACode->Lookup->toClientList($strategic_objective_search) ?>;
	fstrategic_objectivesearch.lists["x_LACode"].options = <?php echo JsonEncode($strategic_objective_search->LACode->lookupOptions()) ?>;
	fstrategic_objectivesearch.lists["x_DepartmentCode"] = <?php echo $strategic_objective_search->DepartmentCode->Lookup->toClientList($strategic_objective_search) ?>;
	fstrategic_objectivesearch.lists["x_DepartmentCode"].options = <?php echo JsonEncode($strategic_objective_search->DepartmentCode->lookupOptions()) ?>;
	loadjs.done("fstrategic_objectivesearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $strategic_objective_search->showPageHeader(); ?>
<?php
$strategic_objective_search->showMessage();
?>
<form name="fstrategic_objectivesearch" id="fstrategic_objectivesearch" class="<?php echo $strategic_objective_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="strategic_objective">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$strategic_objective_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($strategic_objective_search->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label for="x_LACode" class="<?php echo $strategic_objective_search->LeftColumnClass ?>"><span id="elh_strategic_objective_LACode"><?php echo $strategic_objective_search->LACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $strategic_objective_search->RightColumnClass ?>"><div <?php echo $strategic_objective_search->LACode->cellAttributes() ?>>
			<span id="el_strategic_objective_LACode" class="ew-search-field">
<?php $strategic_objective_search->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($strategic_objective_search->LACode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $strategic_objective_search->LACode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($strategic_objective_search->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($strategic_objective_search->LACode->ReadOnly || $strategic_objective_search->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $strategic_objective_search->LACode->Lookup->getParamTag($strategic_objective_search, "p_x_LACode") ?>
<input type="hidden" data-table="strategic_objective" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $strategic_objective_search->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $strategic_objective_search->LACode->AdvancedSearch->SearchValue ?>"<?php echo $strategic_objective_search->LACode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($strategic_objective_search->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label for="x_DepartmentCode" class="<?php echo $strategic_objective_search->LeftColumnClass ?>"><span id="elh_strategic_objective_DepartmentCode"><?php echo $strategic_objective_search->DepartmentCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DepartmentCode" id="z_DepartmentCode" value="=">
</span>
		</label>
		<div class="<?php echo $strategic_objective_search->RightColumnClass ?>"><div <?php echo $strategic_objective_search->DepartmentCode->cellAttributes() ?>>
			<span id="el_strategic_objective_DepartmentCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="strategic_objective" data-field="x_DepartmentCode" data-value-separator="<?php echo $strategic_objective_search->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $strategic_objective_search->DepartmentCode->editAttributes() ?>>
			<?php echo $strategic_objective_search->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $strategic_objective_search->DepartmentCode->Lookup->getParamTag($strategic_objective_search, "p_x_DepartmentCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($strategic_objective_search->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
	<div id="r_StrategicObjectiveCode" class="form-group row">
		<label for="x_StrategicObjectiveCode" class="<?php echo $strategic_objective_search->LeftColumnClass ?>"><span id="elh_strategic_objective_StrategicObjectiveCode"><?php echo $strategic_objective_search->StrategicObjectiveCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_StrategicObjectiveCode" id="z_StrategicObjectiveCode" value="=">
</span>
		</label>
		<div class="<?php echo $strategic_objective_search->RightColumnClass ?>"><div <?php echo $strategic_objective_search->StrategicObjectiveCode->cellAttributes() ?>>
			<span id="el_strategic_objective_StrategicObjectiveCode" class="ew-search-field">
<input type="text" data-table="strategic_objective" data-field="x_StrategicObjectiveCode" name="x_StrategicObjectiveCode" id="x_StrategicObjectiveCode" placeholder="<?php echo HtmlEncode($strategic_objective_search->StrategicObjectiveCode->getPlaceHolder()) ?>" value="<?php echo $strategic_objective_search->StrategicObjectiveCode->EditValue ?>"<?php echo $strategic_objective_search->StrategicObjectiveCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($strategic_objective_search->StrategicObjectiveName->Visible) { // StrategicObjectiveName ?>
	<div id="r_StrategicObjectiveName" class="form-group row">
		<label for="x_StrategicObjectiveName" class="<?php echo $strategic_objective_search->LeftColumnClass ?>"><span id="elh_strategic_objective_StrategicObjectiveName"><?php echo $strategic_objective_search->StrategicObjectiveName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_StrategicObjectiveName" id="z_StrategicObjectiveName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $strategic_objective_search->RightColumnClass ?>"><div <?php echo $strategic_objective_search->StrategicObjectiveName->cellAttributes() ?>>
			<span id="el_strategic_objective_StrategicObjectiveName" class="ew-search-field">
<input type="text" data-table="strategic_objective" data-field="x_StrategicObjectiveName" name="x_StrategicObjectiveName" id="x_StrategicObjectiveName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($strategic_objective_search->StrategicObjectiveName->getPlaceHolder()) ?>" value="<?php echo $strategic_objective_search->StrategicObjectiveName->EditValue ?>"<?php echo $strategic_objective_search->StrategicObjectiveName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($strategic_objective_search->Description->Visible) { // Description ?>
	<div id="r_Description" class="form-group row">
		<label for="x_Description" class="<?php echo $strategic_objective_search->LeftColumnClass ?>"><span id="elh_strategic_objective_Description"><?php echo $strategic_objective_search->Description->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Description" id="z_Description" value="LIKE">
</span>
		</label>
		<div class="<?php echo $strategic_objective_search->RightColumnClass ?>"><div <?php echo $strategic_objective_search->Description->cellAttributes() ?>>
			<span id="el_strategic_objective_Description" class="ew-search-field">
<input type="text" data-table="strategic_objective" data-field="x_Description" name="x_Description" id="x_Description" size="35" placeholder="<?php echo HtmlEncode($strategic_objective_search->Description->getPlaceHolder()) ?>" value="<?php echo $strategic_objective_search->Description->EditValue ?>"<?php echo $strategic_objective_search->Description->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($strategic_objective_search->ReferencedDocs->Visible) { // ReferencedDocs ?>
	<div id="r_ReferencedDocs" class="form-group row">
		<label for="x_ReferencedDocs" class="<?php echo $strategic_objective_search->LeftColumnClass ?>"><span id="elh_strategic_objective_ReferencedDocs"><?php echo $strategic_objective_search->ReferencedDocs->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ReferencedDocs" id="z_ReferencedDocs" value="LIKE">
</span>
		</label>
		<div class="<?php echo $strategic_objective_search->RightColumnClass ?>"><div <?php echo $strategic_objective_search->ReferencedDocs->cellAttributes() ?>>
			<span id="el_strategic_objective_ReferencedDocs" class="ew-search-field">
<input type="text" data-table="strategic_objective" data-field="x_ReferencedDocs" name="x_ReferencedDocs" id="x_ReferencedDocs" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($strategic_objective_search->ReferencedDocs->getPlaceHolder()) ?>" value="<?php echo $strategic_objective_search->ReferencedDocs->EditValue ?>"<?php echo $strategic_objective_search->ReferencedDocs->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($strategic_objective_search->ResultAreaCode->Visible) { // ResultAreaCode ?>
	<div id="r_ResultAreaCode" class="form-group row">
		<label for="x_ResultAreaCode" class="<?php echo $strategic_objective_search->LeftColumnClass ?>"><span id="elh_strategic_objective_ResultAreaCode"><?php echo $strategic_objective_search->ResultAreaCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ResultAreaCode" id="z_ResultAreaCode" value="=">
</span>
		</label>
		<div class="<?php echo $strategic_objective_search->RightColumnClass ?>"><div <?php echo $strategic_objective_search->ResultAreaCode->cellAttributes() ?>>
			<span id="el_strategic_objective_ResultAreaCode" class="ew-search-field">
<input type="text" data-table="strategic_objective" data-field="x_ResultAreaCode" name="x_ResultAreaCode" id="x_ResultAreaCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($strategic_objective_search->ResultAreaCode->getPlaceHolder()) ?>" value="<?php echo $strategic_objective_search->ResultAreaCode->EditValue ?>"<?php echo $strategic_objective_search->ResultAreaCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$strategic_objective_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $strategic_objective_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$strategic_objective_search->showPageFooter();
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
$strategic_objective_search->terminate();
?>