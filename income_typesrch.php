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
$income_type_search = new income_type_search();

// Run the page
$income_type_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$income_type_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fincome_typesearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($income_type_search->IsModal) { ?>
	fincome_typesearch = currentAdvancedSearchForm = new ew.Form("fincome_typesearch", "search");
	<?php } else { ?>
	fincome_typesearch = currentForm = new ew.Form("fincome_typesearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fincome_typesearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_IncomeAmount");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($income_type_search->IncomeAmount->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_IncomeBasicRate");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($income_type_search->IncomeBasicRate->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fincome_typesearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fincome_typesearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fincome_typesearch.lists["x_Division[]"] = <?php echo $income_type_search->Division->Lookup->toClientList($income_type_search) ?>;
	fincome_typesearch.lists["x_Division[]"].options = <?php echo JsonEncode($income_type_search->Division->lookupOptions()) ?>;
	fincome_typesearch.lists["x_BaseIncomeCode"] = <?php echo $income_type_search->BaseIncomeCode->Lookup->toClientList($income_type_search) ?>;
	fincome_typesearch.lists["x_BaseIncomeCode"].options = <?php echo JsonEncode($income_type_search->BaseIncomeCode->lookupOptions()) ?>;
	fincome_typesearch.lists["x_Taxable"] = <?php echo $income_type_search->Taxable->Lookup->toClientList($income_type_search) ?>;
	fincome_typesearch.lists["x_Taxable"].options = <?php echo JsonEncode($income_type_search->Taxable->lookupOptions()) ?>;
	fincome_typesearch.lists["x_AccountNo"] = <?php echo $income_type_search->AccountNo->Lookup->toClientList($income_type_search) ?>;
	fincome_typesearch.lists["x_AccountNo"].options = <?php echo JsonEncode($income_type_search->AccountNo->lookupOptions()) ?>;
	fincome_typesearch.lists["x_JobIncluded[]"] = <?php echo $income_type_search->JobIncluded->Lookup->toClientList($income_type_search) ?>;
	fincome_typesearch.lists["x_JobIncluded[]"].options = <?php echo JsonEncode($income_type_search->JobIncluded->lookupOptions()) ?>;
	fincome_typesearch.lists["x_Application"] = <?php echo $income_type_search->Application->Lookup->toClientList($income_type_search) ?>;
	fincome_typesearch.lists["x_Application"].options = <?php echo JsonEncode($income_type_search->Application->lookupOptions()) ?>;
	fincome_typesearch.lists["x_JobExcluded[]"] = <?php echo $income_type_search->JobExcluded->Lookup->toClientList($income_type_search) ?>;
	fincome_typesearch.lists["x_JobExcluded[]"].options = <?php echo JsonEncode($income_type_search->JobExcluded->lookupOptions()) ?>;
	loadjs.done("fincome_typesearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $income_type_search->showPageHeader(); ?>
<?php
$income_type_search->showMessage();
?>
<form name="fincome_typesearch" id="fincome_typesearch" class="<?php echo $income_type_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="income_type">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$income_type_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($income_type_search->IncomeCode->Visible) { // IncomeCode ?>
	<div id="r_IncomeCode" class="form-group row">
		<label for="x_IncomeCode" class="<?php echo $income_type_search->LeftColumnClass ?>"><span id="elh_income_type_IncomeCode"><?php echo $income_type_search->IncomeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_IncomeCode" id="z_IncomeCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $income_type_search->RightColumnClass ?>"><div <?php echo $income_type_search->IncomeCode->cellAttributes() ?>>
			<span id="el_income_type_IncomeCode" class="ew-search-field">
<input type="text" data-table="income_type" data-field="x_IncomeCode" name="x_IncomeCode" id="x_IncomeCode" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($income_type_search->IncomeCode->getPlaceHolder()) ?>" value="<?php echo $income_type_search->IncomeCode->EditValue ?>"<?php echo $income_type_search->IncomeCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($income_type_search->IncomeName->Visible) { // IncomeName ?>
	<div id="r_IncomeName" class="form-group row">
		<label for="x_IncomeName" class="<?php echo $income_type_search->LeftColumnClass ?>"><span id="elh_income_type_IncomeName"><?php echo $income_type_search->IncomeName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_IncomeName" id="z_IncomeName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $income_type_search->RightColumnClass ?>"><div <?php echo $income_type_search->IncomeName->cellAttributes() ?>>
			<span id="el_income_type_IncomeName" class="ew-search-field">
<input type="text" data-table="income_type" data-field="x_IncomeName" name="x_IncomeName" id="x_IncomeName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($income_type_search->IncomeName->getPlaceHolder()) ?>" value="<?php echo $income_type_search->IncomeName->EditValue ?>"<?php echo $income_type_search->IncomeName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($income_type_search->IncomeDescription->Visible) { // IncomeDescription ?>
	<div id="r_IncomeDescription" class="form-group row">
		<label for="x_IncomeDescription" class="<?php echo $income_type_search->LeftColumnClass ?>"><span id="elh_income_type_IncomeDescription"><?php echo $income_type_search->IncomeDescription->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_IncomeDescription" id="z_IncomeDescription" value="LIKE">
</span>
		</label>
		<div class="<?php echo $income_type_search->RightColumnClass ?>"><div <?php echo $income_type_search->IncomeDescription->cellAttributes() ?>>
			<span id="el_income_type_IncomeDescription" class="ew-search-field">
<input type="text" data-table="income_type" data-field="x_IncomeDescription" name="x_IncomeDescription" id="x_IncomeDescription" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($income_type_search->IncomeDescription->getPlaceHolder()) ?>" value="<?php echo $income_type_search->IncomeDescription->EditValue ?>"<?php echo $income_type_search->IncomeDescription->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($income_type_search->Division->Visible) { // Division ?>
	<div id="r_Division" class="form-group row">
		<label class="<?php echo $income_type_search->LeftColumnClass ?>"><span id="elh_income_type_Division"><?php echo $income_type_search->Division->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Division" id="z_Division" value="LIKE">
</span>
		</label>
		<div class="<?php echo $income_type_search->RightColumnClass ?>"><div <?php echo $income_type_search->Division->cellAttributes() ?>>
			<span id="el_income_type_Division" class="ew-search-field">
<div id="tp_x_Division" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="income_type" data-field="x_Division" data-value-separator="<?php echo $income_type_search->Division->displayValueSeparatorAttribute() ?>" name="x_Division[]" id="x_Division[]" value="{value}"<?php echo $income_type_search->Division->editAttributes() ?>></div>
<div id="dsl_x_Division" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $income_type_search->Division->checkBoxListHtml(FALSE, "x_Division[]") ?>
</div></div>
<?php echo $income_type_search->Division->Lookup->getParamTag($income_type_search, "p_x_Division") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($income_type_search->IncomeAmount->Visible) { // IncomeAmount ?>
	<div id="r_IncomeAmount" class="form-group row">
		<label for="x_IncomeAmount" class="<?php echo $income_type_search->LeftColumnClass ?>"><span id="elh_income_type_IncomeAmount"><?php echo $income_type_search->IncomeAmount->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_IncomeAmount" id="z_IncomeAmount" value="=">
</span>
		</label>
		<div class="<?php echo $income_type_search->RightColumnClass ?>"><div <?php echo $income_type_search->IncomeAmount->cellAttributes() ?>>
			<span id="el_income_type_IncomeAmount" class="ew-search-field">
<input type="text" data-table="income_type" data-field="x_IncomeAmount" name="x_IncomeAmount" id="x_IncomeAmount" size="30" placeholder="<?php echo HtmlEncode($income_type_search->IncomeAmount->getPlaceHolder()) ?>" value="<?php echo $income_type_search->IncomeAmount->EditValue ?>"<?php echo $income_type_search->IncomeAmount->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($income_type_search->IncomeBasicRate->Visible) { // IncomeBasicRate ?>
	<div id="r_IncomeBasicRate" class="form-group row">
		<label for="x_IncomeBasicRate" class="<?php echo $income_type_search->LeftColumnClass ?>"><span id="elh_income_type_IncomeBasicRate"><?php echo $income_type_search->IncomeBasicRate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_IncomeBasicRate" id="z_IncomeBasicRate" value="=">
</span>
		</label>
		<div class="<?php echo $income_type_search->RightColumnClass ?>"><div <?php echo $income_type_search->IncomeBasicRate->cellAttributes() ?>>
			<span id="el_income_type_IncomeBasicRate" class="ew-search-field">
<input type="text" data-table="income_type" data-field="x_IncomeBasicRate" name="x_IncomeBasicRate" id="x_IncomeBasicRate" size="30" placeholder="<?php echo HtmlEncode($income_type_search->IncomeBasicRate->getPlaceHolder()) ?>" value="<?php echo $income_type_search->IncomeBasicRate->EditValue ?>"<?php echo $income_type_search->IncomeBasicRate->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($income_type_search->BaseIncomeCode->Visible) { // BaseIncomeCode ?>
	<div id="r_BaseIncomeCode" class="form-group row">
		<label for="x_BaseIncomeCode" class="<?php echo $income_type_search->LeftColumnClass ?>"><span id="elh_income_type_BaseIncomeCode"><?php echo $income_type_search->BaseIncomeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_BaseIncomeCode" id="z_BaseIncomeCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $income_type_search->RightColumnClass ?>"><div <?php echo $income_type_search->BaseIncomeCode->cellAttributes() ?>>
			<span id="el_income_type_BaseIncomeCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_BaseIncomeCode"><?php echo EmptyValue(strval($income_type_search->BaseIncomeCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $income_type_search->BaseIncomeCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($income_type_search->BaseIncomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($income_type_search->BaseIncomeCode->ReadOnly || $income_type_search->BaseIncomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_BaseIncomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $income_type_search->BaseIncomeCode->Lookup->getParamTag($income_type_search, "p_x_BaseIncomeCode") ?>
<input type="hidden" data-table="income_type" data-field="x_BaseIncomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $income_type_search->BaseIncomeCode->displayValueSeparatorAttribute() ?>" name="x_BaseIncomeCode" id="x_BaseIncomeCode" value="<?php echo $income_type_search->BaseIncomeCode->AdvancedSearch->SearchValue ?>"<?php echo $income_type_search->BaseIncomeCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($income_type_search->Taxable->Visible) { // Taxable ?>
	<div id="r_Taxable" class="form-group row">
		<label for="x_Taxable" class="<?php echo $income_type_search->LeftColumnClass ?>"><span id="elh_income_type_Taxable"><?php echo $income_type_search->Taxable->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Taxable" id="z_Taxable" value="=">
</span>
		</label>
		<div class="<?php echo $income_type_search->RightColumnClass ?>"><div <?php echo $income_type_search->Taxable->cellAttributes() ?>>
			<span id="el_income_type_Taxable" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="income_type" data-field="x_Taxable" data-value-separator="<?php echo $income_type_search->Taxable->displayValueSeparatorAttribute() ?>" id="x_Taxable" name="x_Taxable"<?php echo $income_type_search->Taxable->editAttributes() ?>>
			<?php echo $income_type_search->Taxable->selectOptionListHtml("x_Taxable") ?>
		</select>
</div>
<?php echo $income_type_search->Taxable->Lookup->getParamTag($income_type_search, "p_x_Taxable") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($income_type_search->AccountNo->Visible) { // AccountNo ?>
	<div id="r_AccountNo" class="form-group row">
		<label for="x_AccountNo" class="<?php echo $income_type_search->LeftColumnClass ?>"><span id="elh_income_type_AccountNo"><?php echo $income_type_search->AccountNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AccountNo" id="z_AccountNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $income_type_search->RightColumnClass ?>"><div <?php echo $income_type_search->AccountNo->cellAttributes() ?>>
			<span id="el_income_type_AccountNo" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_AccountNo"><?php echo EmptyValue(strval($income_type_search->AccountNo->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $income_type_search->AccountNo->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($income_type_search->AccountNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($income_type_search->AccountNo->ReadOnly || $income_type_search->AccountNo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_AccountNo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $income_type_search->AccountNo->Lookup->getParamTag($income_type_search, "p_x_AccountNo") ?>
<input type="hidden" data-table="income_type" data-field="x_AccountNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $income_type_search->AccountNo->displayValueSeparatorAttribute() ?>" name="x_AccountNo" id="x_AccountNo" value="<?php echo $income_type_search->AccountNo->AdvancedSearch->SearchValue ?>"<?php echo $income_type_search->AccountNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($income_type_search->JobIncluded->Visible) { // JobIncluded ?>
	<div id="r_JobIncluded" class="form-group row">
		<label class="<?php echo $income_type_search->LeftColumnClass ?>"><span id="elh_income_type_JobIncluded"><?php echo $income_type_search->JobIncluded->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_JobIncluded" id="z_JobIncluded" value="LIKE">
</span>
		</label>
		<div class="<?php echo $income_type_search->RightColumnClass ?>"><div <?php echo $income_type_search->JobIncluded->cellAttributes() ?>>
			<span id="el_income_type_JobIncluded" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_JobIncluded"><?php echo EmptyValue(strval($income_type_search->JobIncluded->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $income_type_search->JobIncluded->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($income_type_search->JobIncluded->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($income_type_search->JobIncluded->ReadOnly || $income_type_search->JobIncluded->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_JobIncluded[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $income_type_search->JobIncluded->Lookup->getParamTag($income_type_search, "p_x_JobIncluded") ?>
<input type="hidden" data-table="income_type" data-field="x_JobIncluded" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $income_type_search->JobIncluded->displayValueSeparatorAttribute() ?>" name="x_JobIncluded[]" id="x_JobIncluded[]" value="<?php echo $income_type_search->JobIncluded->AdvancedSearch->SearchValue ?>"<?php echo $income_type_search->JobIncluded->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($income_type_search->Application->Visible) { // Application ?>
	<div id="r_Application" class="form-group row">
		<label for="x_Application" class="<?php echo $income_type_search->LeftColumnClass ?>"><span id="elh_income_type_Application"><?php echo $income_type_search->Application->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Application" id="z_Application" value="=">
</span>
		</label>
		<div class="<?php echo $income_type_search->RightColumnClass ?>"><div <?php echo $income_type_search->Application->cellAttributes() ?>>
			<span id="el_income_type_Application" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="income_type" data-field="x_Application" data-value-separator="<?php echo $income_type_search->Application->displayValueSeparatorAttribute() ?>" id="x_Application" name="x_Application"<?php echo $income_type_search->Application->editAttributes() ?>>
			<?php echo $income_type_search->Application->selectOptionListHtml("x_Application") ?>
		</select>
</div>
<?php echo $income_type_search->Application->Lookup->getParamTag($income_type_search, "p_x_Application") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($income_type_search->JobExcluded->Visible) { // JobExcluded ?>
	<div id="r_JobExcluded" class="form-group row">
		<label class="<?php echo $income_type_search->LeftColumnClass ?>"><span id="elh_income_type_JobExcluded"><?php echo $income_type_search->JobExcluded->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_JobExcluded" id="z_JobExcluded" value="LIKE">
</span>
		</label>
		<div class="<?php echo $income_type_search->RightColumnClass ?>"><div <?php echo $income_type_search->JobExcluded->cellAttributes() ?>>
			<span id="el_income_type_JobExcluded" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_JobExcluded"><?php echo EmptyValue(strval($income_type_search->JobExcluded->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $income_type_search->JobExcluded->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($income_type_search->JobExcluded->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($income_type_search->JobExcluded->ReadOnly || $income_type_search->JobExcluded->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_JobExcluded[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $income_type_search->JobExcluded->Lookup->getParamTag($income_type_search, "p_x_JobExcluded") ?>
<input type="hidden" data-table="income_type" data-field="x_JobExcluded" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $income_type_search->JobExcluded->displayValueSeparatorAttribute() ?>" name="x_JobExcluded[]" id="x_JobExcluded[]" value="<?php echo $income_type_search->JobExcluded->AdvancedSearch->SearchValue ?>"<?php echo $income_type_search->JobExcluded->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$income_type_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $income_type_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$income_type_search->showPageFooter();
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
$income_type_search->terminate();
?>