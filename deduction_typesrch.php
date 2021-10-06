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
$deduction_type_search = new deduction_type_search();

// Run the page
$deduction_type_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$deduction_type_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdeduction_typesearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($deduction_type_search->IsModal) { ?>
	fdeduction_typesearch = currentAdvancedSearchForm = new ew.Form("fdeduction_typesearch", "search");
	<?php } else { ?>
	fdeduction_typesearch = currentForm = new ew.Form("fdeduction_typesearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fdeduction_typesearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_DeductionAmount");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($deduction_type_search->DeductionAmount->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DeductionBasicRate");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($deduction_type_search->DeductionBasicRate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_MinimumAmount");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($deduction_type_search->MinimumAmount->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_MaximumAmount");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($deduction_type_search->MaximumAmount->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_EmployerContributionRate");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($deduction_type_search->EmployerContributionRate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_EmployerContributionAmount");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($deduction_type_search->EmployerContributionAmount->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fdeduction_typesearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdeduction_typesearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdeduction_typesearch.lists["x_Division[]"] = <?php echo $deduction_type_search->Division->Lookup->toClientList($deduction_type_search) ?>;
	fdeduction_typesearch.lists["x_Division[]"].options = <?php echo JsonEncode($deduction_type_search->Division->lookupOptions()) ?>;
	fdeduction_typesearch.lists["x_AccountNo"] = <?php echo $deduction_type_search->AccountNo->Lookup->toClientList($deduction_type_search) ?>;
	fdeduction_typesearch.lists["x_AccountNo"].options = <?php echo JsonEncode($deduction_type_search->AccountNo->lookupOptions()) ?>;
	fdeduction_typesearch.lists["x_BaseIncomeCode"] = <?php echo $deduction_type_search->BaseIncomeCode->Lookup->toClientList($deduction_type_search) ?>;
	fdeduction_typesearch.lists["x_BaseIncomeCode"].options = <?php echo JsonEncode($deduction_type_search->BaseIncomeCode->lookupOptions()) ?>;
	fdeduction_typesearch.lists["x_BaseDeductionCode"] = <?php echo $deduction_type_search->BaseDeductionCode->Lookup->toClientList($deduction_type_search) ?>;
	fdeduction_typesearch.lists["x_BaseDeductionCode"].options = <?php echo JsonEncode($deduction_type_search->BaseDeductionCode->lookupOptions()) ?>;
	fdeduction_typesearch.lists["x_TaxExempt"] = <?php echo $deduction_type_search->TaxExempt->Lookup->toClientList($deduction_type_search) ?>;
	fdeduction_typesearch.lists["x_TaxExempt"].options = <?php echo JsonEncode($deduction_type_search->TaxExempt->lookupOptions()) ?>;
	fdeduction_typesearch.lists["x_JobCode[]"] = <?php echo $deduction_type_search->JobCode->Lookup->toClientList($deduction_type_search) ?>;
	fdeduction_typesearch.lists["x_JobCode[]"].options = <?php echo JsonEncode($deduction_type_search->JobCode->lookupOptions()) ?>;
	fdeduction_typesearch.lists["x_Application"] = <?php echo $deduction_type_search->Application->Lookup->toClientList($deduction_type_search) ?>;
	fdeduction_typesearch.lists["x_Application"].options = <?php echo JsonEncode($deduction_type_search->Application->lookupOptions()) ?>;
	loadjs.done("fdeduction_typesearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $deduction_type_search->showPageHeader(); ?>
<?php
$deduction_type_search->showMessage();
?>
<form name="fdeduction_typesearch" id="fdeduction_typesearch" class="<?php echo $deduction_type_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="deduction_type">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$deduction_type_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($deduction_type_search->DeductionCode->Visible) { // DeductionCode ?>
	<div id="r_DeductionCode" class="form-group row">
		<label for="x_DeductionCode" class="<?php echo $deduction_type_search->LeftColumnClass ?>"><span id="elh_deduction_type_DeductionCode"><?php echo $deduction_type_search->DeductionCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DeductionCode" id="z_DeductionCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $deduction_type_search->RightColumnClass ?>"><div <?php echo $deduction_type_search->DeductionCode->cellAttributes() ?>>
			<span id="el_deduction_type_DeductionCode" class="ew-search-field">
<input type="text" data-table="deduction_type" data-field="x_DeductionCode" name="x_DeductionCode" id="x_DeductionCode" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($deduction_type_search->DeductionCode->getPlaceHolder()) ?>" value="<?php echo $deduction_type_search->DeductionCode->EditValue ?>"<?php echo $deduction_type_search->DeductionCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_search->DeductionName->Visible) { // DeductionName ?>
	<div id="r_DeductionName" class="form-group row">
		<label for="x_DeductionName" class="<?php echo $deduction_type_search->LeftColumnClass ?>"><span id="elh_deduction_type_DeductionName"><?php echo $deduction_type_search->DeductionName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DeductionName" id="z_DeductionName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $deduction_type_search->RightColumnClass ?>"><div <?php echo $deduction_type_search->DeductionName->cellAttributes() ?>>
			<span id="el_deduction_type_DeductionName" class="ew-search-field">
<input type="text" data-table="deduction_type" data-field="x_DeductionName" name="x_DeductionName" id="x_DeductionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($deduction_type_search->DeductionName->getPlaceHolder()) ?>" value="<?php echo $deduction_type_search->DeductionName->EditValue ?>"<?php echo $deduction_type_search->DeductionName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_search->DeductionDescription->Visible) { // DeductionDescription ?>
	<div id="r_DeductionDescription" class="form-group row">
		<label for="x_DeductionDescription" class="<?php echo $deduction_type_search->LeftColumnClass ?>"><span id="elh_deduction_type_DeductionDescription"><?php echo $deduction_type_search->DeductionDescription->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DeductionDescription" id="z_DeductionDescription" value="LIKE">
</span>
		</label>
		<div class="<?php echo $deduction_type_search->RightColumnClass ?>"><div <?php echo $deduction_type_search->DeductionDescription->cellAttributes() ?>>
			<span id="el_deduction_type_DeductionDescription" class="ew-search-field">
<input type="text" data-table="deduction_type" data-field="x_DeductionDescription" name="x_DeductionDescription" id="x_DeductionDescription" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($deduction_type_search->DeductionDescription->getPlaceHolder()) ?>" value="<?php echo $deduction_type_search->DeductionDescription->EditValue ?>"<?php echo $deduction_type_search->DeductionDescription->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_search->Division->Visible) { // Division ?>
	<div id="r_Division" class="form-group row">
		<label class="<?php echo $deduction_type_search->LeftColumnClass ?>"><span id="elh_deduction_type_Division"><?php echo $deduction_type_search->Division->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Division" id="z_Division" value="LIKE">
</span>
		</label>
		<div class="<?php echo $deduction_type_search->RightColumnClass ?>"><div <?php echo $deduction_type_search->Division->cellAttributes() ?>>
			<span id="el_deduction_type_Division" class="ew-search-field">
<div id="tp_x_Division" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="deduction_type" data-field="x_Division" data-value-separator="<?php echo $deduction_type_search->Division->displayValueSeparatorAttribute() ?>" name="x_Division[]" id="x_Division[]" value="{value}"<?php echo $deduction_type_search->Division->editAttributes() ?>></div>
<div id="dsl_x_Division" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $deduction_type_search->Division->checkBoxListHtml(FALSE, "x_Division[]") ?>
</div></div>
<?php echo $deduction_type_search->Division->Lookup->getParamTag($deduction_type_search, "p_x_Division") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_search->DeductionAmount->Visible) { // DeductionAmount ?>
	<div id="r_DeductionAmount" class="form-group row">
		<label for="x_DeductionAmount" class="<?php echo $deduction_type_search->LeftColumnClass ?>"><span id="elh_deduction_type_DeductionAmount"><?php echo $deduction_type_search->DeductionAmount->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DeductionAmount" id="z_DeductionAmount" value="=">
</span>
		</label>
		<div class="<?php echo $deduction_type_search->RightColumnClass ?>"><div <?php echo $deduction_type_search->DeductionAmount->cellAttributes() ?>>
			<span id="el_deduction_type_DeductionAmount" class="ew-search-field">
<input type="text" data-table="deduction_type" data-field="x_DeductionAmount" name="x_DeductionAmount" id="x_DeductionAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_type_search->DeductionAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_type_search->DeductionAmount->EditValue ?>"<?php echo $deduction_type_search->DeductionAmount->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_search->DeductionBasicRate->Visible) { // DeductionBasicRate ?>
	<div id="r_DeductionBasicRate" class="form-group row">
		<label for="x_DeductionBasicRate" class="<?php echo $deduction_type_search->LeftColumnClass ?>"><span id="elh_deduction_type_DeductionBasicRate"><?php echo $deduction_type_search->DeductionBasicRate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DeductionBasicRate" id="z_DeductionBasicRate" value="=">
</span>
		</label>
		<div class="<?php echo $deduction_type_search->RightColumnClass ?>"><div <?php echo $deduction_type_search->DeductionBasicRate->cellAttributes() ?>>
			<span id="el_deduction_type_DeductionBasicRate" class="ew-search-field">
<input type="text" data-table="deduction_type" data-field="x_DeductionBasicRate" name="x_DeductionBasicRate" id="x_DeductionBasicRate" size="30" placeholder="<?php echo HtmlEncode($deduction_type_search->DeductionBasicRate->getPlaceHolder()) ?>" value="<?php echo $deduction_type_search->DeductionBasicRate->EditValue ?>"<?php echo $deduction_type_search->DeductionBasicRate->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_search->RemittedTo->Visible) { // RemittedTo ?>
	<div id="r_RemittedTo" class="form-group row">
		<label for="x_RemittedTo" class="<?php echo $deduction_type_search->LeftColumnClass ?>"><span id="elh_deduction_type_RemittedTo"><?php echo $deduction_type_search->RemittedTo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_RemittedTo" id="z_RemittedTo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $deduction_type_search->RightColumnClass ?>"><div <?php echo $deduction_type_search->RemittedTo->cellAttributes() ?>>
			<span id="el_deduction_type_RemittedTo" class="ew-search-field">
<input type="text" data-table="deduction_type" data-field="x_RemittedTo" name="x_RemittedTo" id="x_RemittedTo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($deduction_type_search->RemittedTo->getPlaceHolder()) ?>" value="<?php echo $deduction_type_search->RemittedTo->EditValue ?>"<?php echo $deduction_type_search->RemittedTo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_search->AccountNo->Visible) { // AccountNo ?>
	<div id="r_AccountNo" class="form-group row">
		<label for="x_AccountNo" class="<?php echo $deduction_type_search->LeftColumnClass ?>"><span id="elh_deduction_type_AccountNo"><?php echo $deduction_type_search->AccountNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AccountNo" id="z_AccountNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $deduction_type_search->RightColumnClass ?>"><div <?php echo $deduction_type_search->AccountNo->cellAttributes() ?>>
			<span id="el_deduction_type_AccountNo" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_AccountNo"><?php echo EmptyValue(strval($deduction_type_search->AccountNo->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $deduction_type_search->AccountNo->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($deduction_type_search->AccountNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($deduction_type_search->AccountNo->ReadOnly || $deduction_type_search->AccountNo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_AccountNo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $deduction_type_search->AccountNo->Lookup->getParamTag($deduction_type_search, "p_x_AccountNo") ?>
<input type="hidden" data-table="deduction_type" data-field="x_AccountNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $deduction_type_search->AccountNo->displayValueSeparatorAttribute() ?>" name="x_AccountNo" id="x_AccountNo" value="<?php echo $deduction_type_search->AccountNo->AdvancedSearch->SearchValue ?>"<?php echo $deduction_type_search->AccountNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_search->BaseIncomeCode->Visible) { // BaseIncomeCode ?>
	<div id="r_BaseIncomeCode" class="form-group row">
		<label for="x_BaseIncomeCode" class="<?php echo $deduction_type_search->LeftColumnClass ?>"><span id="elh_deduction_type_BaseIncomeCode"><?php echo $deduction_type_search->BaseIncomeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_BaseIncomeCode" id="z_BaseIncomeCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $deduction_type_search->RightColumnClass ?>"><div <?php echo $deduction_type_search->BaseIncomeCode->cellAttributes() ?>>
			<span id="el_deduction_type_BaseIncomeCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_BaseIncomeCode"><?php echo EmptyValue(strval($deduction_type_search->BaseIncomeCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $deduction_type_search->BaseIncomeCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($deduction_type_search->BaseIncomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($deduction_type_search->BaseIncomeCode->ReadOnly || $deduction_type_search->BaseIncomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_BaseIncomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $deduction_type_search->BaseIncomeCode->Lookup->getParamTag($deduction_type_search, "p_x_BaseIncomeCode") ?>
<input type="hidden" data-table="deduction_type" data-field="x_BaseIncomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $deduction_type_search->BaseIncomeCode->displayValueSeparatorAttribute() ?>" name="x_BaseIncomeCode" id="x_BaseIncomeCode" value="<?php echo $deduction_type_search->BaseIncomeCode->AdvancedSearch->SearchValue ?>"<?php echo $deduction_type_search->BaseIncomeCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_search->BaseDeductionCode->Visible) { // BaseDeductionCode ?>
	<div id="r_BaseDeductionCode" class="form-group row">
		<label for="x_BaseDeductionCode" class="<?php echo $deduction_type_search->LeftColumnClass ?>"><span id="elh_deduction_type_BaseDeductionCode"><?php echo $deduction_type_search->BaseDeductionCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_BaseDeductionCode" id="z_BaseDeductionCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $deduction_type_search->RightColumnClass ?>"><div <?php echo $deduction_type_search->BaseDeductionCode->cellAttributes() ?>>
			<span id="el_deduction_type_BaseDeductionCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_BaseDeductionCode"><?php echo EmptyValue(strval($deduction_type_search->BaseDeductionCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $deduction_type_search->BaseDeductionCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($deduction_type_search->BaseDeductionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($deduction_type_search->BaseDeductionCode->ReadOnly || $deduction_type_search->BaseDeductionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_BaseDeductionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $deduction_type_search->BaseDeductionCode->Lookup->getParamTag($deduction_type_search, "p_x_BaseDeductionCode") ?>
<input type="hidden" data-table="deduction_type" data-field="x_BaseDeductionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $deduction_type_search->BaseDeductionCode->displayValueSeparatorAttribute() ?>" name="x_BaseDeductionCode" id="x_BaseDeductionCode" value="<?php echo $deduction_type_search->BaseDeductionCode->AdvancedSearch->SearchValue ?>"<?php echo $deduction_type_search->BaseDeductionCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_search->TaxExempt->Visible) { // TaxExempt ?>
	<div id="r_TaxExempt" class="form-group row">
		<label for="x_TaxExempt" class="<?php echo $deduction_type_search->LeftColumnClass ?>"><span id="elh_deduction_type_TaxExempt"><?php echo $deduction_type_search->TaxExempt->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_TaxExempt" id="z_TaxExempt" value="=">
</span>
		</label>
		<div class="<?php echo $deduction_type_search->RightColumnClass ?>"><div <?php echo $deduction_type_search->TaxExempt->cellAttributes() ?>>
			<span id="el_deduction_type_TaxExempt" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="deduction_type" data-field="x_TaxExempt" data-value-separator="<?php echo $deduction_type_search->TaxExempt->displayValueSeparatorAttribute() ?>" id="x_TaxExempt" name="x_TaxExempt"<?php echo $deduction_type_search->TaxExempt->editAttributes() ?>>
			<?php echo $deduction_type_search->TaxExempt->selectOptionListHtml("x_TaxExempt") ?>
		</select>
</div>
<?php echo $deduction_type_search->TaxExempt->Lookup->getParamTag($deduction_type_search, "p_x_TaxExempt") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_search->JobCode->Visible) { // JobCode ?>
	<div id="r_JobCode" class="form-group row">
		<label class="<?php echo $deduction_type_search->LeftColumnClass ?>"><span id="elh_deduction_type_JobCode"><?php echo $deduction_type_search->JobCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_JobCode" id="z_JobCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $deduction_type_search->RightColumnClass ?>"><div <?php echo $deduction_type_search->JobCode->cellAttributes() ?>>
			<span id="el_deduction_type_JobCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_JobCode"><?php echo EmptyValue(strval($deduction_type_search->JobCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $deduction_type_search->JobCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($deduction_type_search->JobCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($deduction_type_search->JobCode->ReadOnly || $deduction_type_search->JobCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_JobCode[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $deduction_type_search->JobCode->Lookup->getParamTag($deduction_type_search, "p_x_JobCode") ?>
<input type="hidden" data-table="deduction_type" data-field="x_JobCode" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $deduction_type_search->JobCode->displayValueSeparatorAttribute() ?>" name="x_JobCode[]" id="x_JobCode[]" value="<?php echo $deduction_type_search->JobCode->AdvancedSearch->SearchValue ?>"<?php echo $deduction_type_search->JobCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_search->MinimumAmount->Visible) { // MinimumAmount ?>
	<div id="r_MinimumAmount" class="form-group row">
		<label for="x_MinimumAmount" class="<?php echo $deduction_type_search->LeftColumnClass ?>"><span id="elh_deduction_type_MinimumAmount"><?php echo $deduction_type_search->MinimumAmount->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_MinimumAmount" id="z_MinimumAmount" value="=">
</span>
		</label>
		<div class="<?php echo $deduction_type_search->RightColumnClass ?>"><div <?php echo $deduction_type_search->MinimumAmount->cellAttributes() ?>>
			<span id="el_deduction_type_MinimumAmount" class="ew-search-field">
<input type="text" data-table="deduction_type" data-field="x_MinimumAmount" name="x_MinimumAmount" id="x_MinimumAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_type_search->MinimumAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_type_search->MinimumAmount->EditValue ?>"<?php echo $deduction_type_search->MinimumAmount->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_search->MaximumAmount->Visible) { // MaximumAmount ?>
	<div id="r_MaximumAmount" class="form-group row">
		<label for="x_MaximumAmount" class="<?php echo $deduction_type_search->LeftColumnClass ?>"><span id="elh_deduction_type_MaximumAmount"><?php echo $deduction_type_search->MaximumAmount->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_MaximumAmount" id="z_MaximumAmount" value="=">
</span>
		</label>
		<div class="<?php echo $deduction_type_search->RightColumnClass ?>"><div <?php echo $deduction_type_search->MaximumAmount->cellAttributes() ?>>
			<span id="el_deduction_type_MaximumAmount" class="ew-search-field">
<input type="text" data-table="deduction_type" data-field="x_MaximumAmount" name="x_MaximumAmount" id="x_MaximumAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_type_search->MaximumAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_type_search->MaximumAmount->EditValue ?>"<?php echo $deduction_type_search->MaximumAmount->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_search->EmployerContributionRate->Visible) { // EmployerContributionRate ?>
	<div id="r_EmployerContributionRate" class="form-group row">
		<label for="x_EmployerContributionRate" class="<?php echo $deduction_type_search->LeftColumnClass ?>"><span id="elh_deduction_type_EmployerContributionRate"><?php echo $deduction_type_search->EmployerContributionRate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployerContributionRate" id="z_EmployerContributionRate" value="=">
</span>
		</label>
		<div class="<?php echo $deduction_type_search->RightColumnClass ?>"><div <?php echo $deduction_type_search->EmployerContributionRate->cellAttributes() ?>>
			<span id="el_deduction_type_EmployerContributionRate" class="ew-search-field">
<input type="text" data-table="deduction_type" data-field="x_EmployerContributionRate" name="x_EmployerContributionRate" id="x_EmployerContributionRate" size="30" placeholder="<?php echo HtmlEncode($deduction_type_search->EmployerContributionRate->getPlaceHolder()) ?>" value="<?php echo $deduction_type_search->EmployerContributionRate->EditValue ?>"<?php echo $deduction_type_search->EmployerContributionRate->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_search->EmployerContributionAmount->Visible) { // EmployerContributionAmount ?>
	<div id="r_EmployerContributionAmount" class="form-group row">
		<label for="x_EmployerContributionAmount" class="<?php echo $deduction_type_search->LeftColumnClass ?>"><span id="elh_deduction_type_EmployerContributionAmount"><?php echo $deduction_type_search->EmployerContributionAmount->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployerContributionAmount" id="z_EmployerContributionAmount" value="=">
</span>
		</label>
		<div class="<?php echo $deduction_type_search->RightColumnClass ?>"><div <?php echo $deduction_type_search->EmployerContributionAmount->cellAttributes() ?>>
			<span id="el_deduction_type_EmployerContributionAmount" class="ew-search-field">
<input type="text" data-table="deduction_type" data-field="x_EmployerContributionAmount" name="x_EmployerContributionAmount" id="x_EmployerContributionAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_type_search->EmployerContributionAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_type_search->EmployerContributionAmount->EditValue ?>"<?php echo $deduction_type_search->EmployerContributionAmount->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_search->Application->Visible) { // Application ?>
	<div id="r_Application" class="form-group row">
		<label for="x_Application" class="<?php echo $deduction_type_search->LeftColumnClass ?>"><span id="elh_deduction_type_Application"><?php echo $deduction_type_search->Application->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Application" id="z_Application" value="=">
</span>
		</label>
		<div class="<?php echo $deduction_type_search->RightColumnClass ?>"><div <?php echo $deduction_type_search->Application->cellAttributes() ?>>
			<span id="el_deduction_type_Application" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="deduction_type" data-field="x_Application" data-value-separator="<?php echo $deduction_type_search->Application->displayValueSeparatorAttribute() ?>" id="x_Application" name="x_Application"<?php echo $deduction_type_search->Application->editAttributes() ?>>
			<?php echo $deduction_type_search->Application->selectOptionListHtml("x_Application") ?>
		</select>
</div>
<?php echo $deduction_type_search->Application->Lookup->getParamTag($deduction_type_search, "p_x_Application") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$deduction_type_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $deduction_type_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$deduction_type_search->showPageFooter();
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
$deduction_type_search->terminate();
?>