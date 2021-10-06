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
$asset_search = new asset_search();

// Run the page
$asset_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$asset_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fassetsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($asset_search->IsModal) { ?>
	fassetsearch = currentAdvancedSearchForm = new ew.Form("fassetsearch", "search");
	<?php } else { ?>
	fassetsearch = currentForm = new ew.Form("fassetsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fassetsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ProvinceCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($asset_search->ProvinceCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PurchasePrice");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($asset_search->PurchasePrice->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DateOfPurchase");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($asset_search->DateOfPurchase->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_AssetCapacity");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($asset_search->AssetCapacity->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DateOfLastRevaluation");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($asset_search->DateOfLastRevaluation->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_NewValue");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($asset_search->NewValue->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BookValue");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($asset_search->BookValue->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_LastDepreciationDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($asset_search->LastDepreciationDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_LastDepreciationAmount");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($asset_search->LastDepreciationAmount->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DepreciationRate");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($asset_search->DepreciationRate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_CumulativeDepreciation");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($asset_search->CumulativeDepreciation->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ScrapValue");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($asset_search->ScrapValue->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fassetsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fassetsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fassetsearch.lists["x_ProvinceCode"] = <?php echo $asset_search->ProvinceCode->Lookup->toClientList($asset_search) ?>;
	fassetsearch.lists["x_ProvinceCode"].options = <?php echo JsonEncode($asset_search->ProvinceCode->lookupOptions()) ?>;
	fassetsearch.autoSuggests["x_ProvinceCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fassetsearch.lists["x_LACode"] = <?php echo $asset_search->LACode->Lookup->toClientList($asset_search) ?>;
	fassetsearch.lists["x_LACode"].options = <?php echo JsonEncode($asset_search->LACode->lookupOptions()) ?>;
	fassetsearch.lists["x_DepartmentCode"] = <?php echo $asset_search->DepartmentCode->Lookup->toClientList($asset_search) ?>;
	fassetsearch.lists["x_DepartmentCode"].options = <?php echo JsonEncode($asset_search->DepartmentCode->lookupOptions()) ?>;
	fassetsearch.lists["x_SectionCode"] = <?php echo $asset_search->SectionCode->Lookup->toClientList($asset_search) ?>;
	fassetsearch.lists["x_SectionCode"].options = <?php echo JsonEncode($asset_search->SectionCode->lookupOptions()) ?>;
	fassetsearch.lists["x_AssetTypeCode"] = <?php echo $asset_search->AssetTypeCode->Lookup->toClientList($asset_search) ?>;
	fassetsearch.lists["x_AssetTypeCode"].options = <?php echo JsonEncode($asset_search->AssetTypeCode->lookupOptions()) ?>;
	fassetsearch.lists["x_CurrencyCode"] = <?php echo $asset_search->CurrencyCode->Lookup->toClientList($asset_search) ?>;
	fassetsearch.lists["x_CurrencyCode"].options = <?php echo JsonEncode($asset_search->CurrencyCode->lookupOptions()) ?>;
	fassetsearch.lists["x_ConditionCode"] = <?php echo $asset_search->ConditionCode->Lookup->toClientList($asset_search) ?>;
	fassetsearch.lists["x_ConditionCode"].options = <?php echo JsonEncode($asset_search->ConditionCode->lookupOptions()) ?>;
	fassetsearch.lists["x_UnitOfMeasure"] = <?php echo $asset_search->UnitOfMeasure->Lookup->toClientList($asset_search) ?>;
	fassetsearch.lists["x_UnitOfMeasure"].options = <?php echo JsonEncode($asset_search->UnitOfMeasure->lookupOptions()) ?>;
	fassetsearch.lists["x_AssetStatus"] = <?php echo $asset_search->AssetStatus->Lookup->toClientList($asset_search) ?>;
	fassetsearch.lists["x_AssetStatus"].options = <?php echo JsonEncode($asset_search->AssetStatus->lookupOptions()) ?>;
	loadjs.done("fassetsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $asset_search->showPageHeader(); ?>
<?php
$asset_search->showMessage();
?>
<form name="fassetsearch" id="fassetsearch" class="<?php echo $asset_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="asset">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$asset_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($asset_search->AssetCode->Visible) { // AssetCode ?>
	<div id="r_AssetCode" class="form-group row">
		<label for="x_AssetCode" class="<?php echo $asset_search->LeftColumnClass ?>"><span id="elh_asset_AssetCode"><?php echo $asset_search->AssetCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AssetCode" id="z_AssetCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $asset_search->RightColumnClass ?>"><div <?php echo $asset_search->AssetCode->cellAttributes() ?>>
			<span id="el_asset_AssetCode" class="ew-search-field">
<input type="text" data-table="asset" data-field="x_AssetCode" name="x_AssetCode" id="x_AssetCode" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($asset_search->AssetCode->getPlaceHolder()) ?>" value="<?php echo $asset_search->AssetCode->EditValue ?>"<?php echo $asset_search->AssetCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($asset_search->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label class="<?php echo $asset_search->LeftColumnClass ?>"><span id="elh_asset_ProvinceCode"><?php echo $asset_search->ProvinceCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ProvinceCode" id="z_ProvinceCode" value="=">
</span>
		</label>
		<div class="<?php echo $asset_search->RightColumnClass ?>"><div <?php echo $asset_search->ProvinceCode->cellAttributes() ?>>
			<span id="el_asset_ProvinceCode" class="ew-search-field">
<?php
$onchange = $asset_search->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$asset_search->ProvinceCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProvinceCode">
	<input type="text" class="form-control" name="sv_x_ProvinceCode" id="sv_x_ProvinceCode" value="<?php echo RemoveHtml($asset_search->ProvinceCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($asset_search->ProvinceCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($asset_search->ProvinceCode->getPlaceHolder()) ?>"<?php echo $asset_search->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_ProvinceCode" data-value-separator="<?php echo $asset_search->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x_ProvinceCode" id="x_ProvinceCode" value="<?php echo HtmlEncode($asset_search->ProvinceCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fassetsearch"], function() {
	fassetsearch.createAutoSuggest({"id":"x_ProvinceCode","forceSelect":false});
});
</script>
<?php echo $asset_search->ProvinceCode->Lookup->getParamTag($asset_search, "p_x_ProvinceCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($asset_search->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label for="x_LACode" class="<?php echo $asset_search->LeftColumnClass ?>"><span id="elh_asset_LACode"><?php echo $asset_search->LACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="=">
</span>
		</label>
		<div class="<?php echo $asset_search->RightColumnClass ?>"><div <?php echo $asset_search->LACode->cellAttributes() ?>>
			<span id="el_asset_LACode" class="ew-search-field">
<?php $asset_search->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_LACode" data-value-separator="<?php echo $asset_search->LACode->displayValueSeparatorAttribute() ?>" id="x_LACode" name="x_LACode"<?php echo $asset_search->LACode->editAttributes() ?>>
			<?php echo $asset_search->LACode->selectOptionListHtml("x_LACode") ?>
		</select>
</div>
<?php echo $asset_search->LACode->Lookup->getParamTag($asset_search, "p_x_LACode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($asset_search->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label for="x_DepartmentCode" class="<?php echo $asset_search->LeftColumnClass ?>"><span id="elh_asset_DepartmentCode"><?php echo $asset_search->DepartmentCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DepartmentCode" id="z_DepartmentCode" value="=">
</span>
		</label>
		<div class="<?php echo $asset_search->RightColumnClass ?>"><div <?php echo $asset_search->DepartmentCode->cellAttributes() ?>>
			<span id="el_asset_DepartmentCode" class="ew-search-field">
<?php $asset_search->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_DepartmentCode" data-value-separator="<?php echo $asset_search->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $asset_search->DepartmentCode->editAttributes() ?>>
			<?php echo $asset_search->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $asset_search->DepartmentCode->Lookup->getParamTag($asset_search, "p_x_DepartmentCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($asset_search->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label for="x_SectionCode" class="<?php echo $asset_search->LeftColumnClass ?>"><span id="elh_asset_SectionCode"><?php echo $asset_search->SectionCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SectionCode" id="z_SectionCode" value="=">
</span>
		</label>
		<div class="<?php echo $asset_search->RightColumnClass ?>"><div <?php echo $asset_search->SectionCode->cellAttributes() ?>>
			<span id="el_asset_SectionCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_SectionCode" data-value-separator="<?php echo $asset_search->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $asset_search->SectionCode->editAttributes() ?>>
			<?php echo $asset_search->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $asset_search->SectionCode->Lookup->getParamTag($asset_search, "p_x_SectionCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($asset_search->AssetTypeCode->Visible) { // AssetTypeCode ?>
	<div id="r_AssetTypeCode" class="form-group row">
		<label for="x_AssetTypeCode" class="<?php echo $asset_search->LeftColumnClass ?>"><span id="elh_asset_AssetTypeCode"><?php echo $asset_search->AssetTypeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AssetTypeCode" id="z_AssetTypeCode" value="=">
</span>
		</label>
		<div class="<?php echo $asset_search->RightColumnClass ?>"><div <?php echo $asset_search->AssetTypeCode->cellAttributes() ?>>
			<span id="el_asset_AssetTypeCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_AssetTypeCode" data-value-separator="<?php echo $asset_search->AssetTypeCode->displayValueSeparatorAttribute() ?>" id="x_AssetTypeCode" name="x_AssetTypeCode"<?php echo $asset_search->AssetTypeCode->editAttributes() ?>>
			<?php echo $asset_search->AssetTypeCode->selectOptionListHtml("x_AssetTypeCode") ?>
		</select>
</div>
<?php echo $asset_search->AssetTypeCode->Lookup->getParamTag($asset_search, "p_x_AssetTypeCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($asset_search->Supplier->Visible) { // Supplier ?>
	<div id="r_Supplier" class="form-group row">
		<label for="x_Supplier" class="<?php echo $asset_search->LeftColumnClass ?>"><span id="elh_asset_Supplier"><?php echo $asset_search->Supplier->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Supplier" id="z_Supplier" value="LIKE">
</span>
		</label>
		<div class="<?php echo $asset_search->RightColumnClass ?>"><div <?php echo $asset_search->Supplier->cellAttributes() ?>>
			<span id="el_asset_Supplier" class="ew-search-field">
<input type="text" data-table="asset" data-field="x_Supplier" name="x_Supplier" id="x_Supplier" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($asset_search->Supplier->getPlaceHolder()) ?>" value="<?php echo $asset_search->Supplier->EditValue ?>"<?php echo $asset_search->Supplier->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($asset_search->PurchasePrice->Visible) { // PurchasePrice ?>
	<div id="r_PurchasePrice" class="form-group row">
		<label for="x_PurchasePrice" class="<?php echo $asset_search->LeftColumnClass ?>"><span id="elh_asset_PurchasePrice"><?php echo $asset_search->PurchasePrice->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PurchasePrice" id="z_PurchasePrice" value="=">
</span>
		</label>
		<div class="<?php echo $asset_search->RightColumnClass ?>"><div <?php echo $asset_search->PurchasePrice->cellAttributes() ?>>
			<span id="el_asset_PurchasePrice" class="ew-search-field">
<input type="text" data-table="asset" data-field="x_PurchasePrice" name="x_PurchasePrice" id="x_PurchasePrice" size="30" placeholder="<?php echo HtmlEncode($asset_search->PurchasePrice->getPlaceHolder()) ?>" value="<?php echo $asset_search->PurchasePrice->EditValue ?>"<?php echo $asset_search->PurchasePrice->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($asset_search->CurrencyCode->Visible) { // CurrencyCode ?>
	<div id="r_CurrencyCode" class="form-group row">
		<label for="x_CurrencyCode" class="<?php echo $asset_search->LeftColumnClass ?>"><span id="elh_asset_CurrencyCode"><?php echo $asset_search->CurrencyCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_CurrencyCode" id="z_CurrencyCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $asset_search->RightColumnClass ?>"><div <?php echo $asset_search->CurrencyCode->cellAttributes() ?>>
			<span id="el_asset_CurrencyCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_CurrencyCode" data-value-separator="<?php echo $asset_search->CurrencyCode->displayValueSeparatorAttribute() ?>" id="x_CurrencyCode" name="x_CurrencyCode"<?php echo $asset_search->CurrencyCode->editAttributes() ?>>
			<?php echo $asset_search->CurrencyCode->selectOptionListHtml("x_CurrencyCode") ?>
		</select>
</div>
<?php echo $asset_search->CurrencyCode->Lookup->getParamTag($asset_search, "p_x_CurrencyCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($asset_search->ConditionCode->Visible) { // ConditionCode ?>
	<div id="r_ConditionCode" class="form-group row">
		<label for="x_ConditionCode" class="<?php echo $asset_search->LeftColumnClass ?>"><span id="elh_asset_ConditionCode"><?php echo $asset_search->ConditionCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ConditionCode" id="z_ConditionCode" value="=">
</span>
		</label>
		<div class="<?php echo $asset_search->RightColumnClass ?>"><div <?php echo $asset_search->ConditionCode->cellAttributes() ?>>
			<span id="el_asset_ConditionCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_ConditionCode" data-value-separator="<?php echo $asset_search->ConditionCode->displayValueSeparatorAttribute() ?>" id="x_ConditionCode" name="x_ConditionCode"<?php echo $asset_search->ConditionCode->editAttributes() ?>>
			<?php echo $asset_search->ConditionCode->selectOptionListHtml("x_ConditionCode") ?>
		</select>
</div>
<?php echo $asset_search->ConditionCode->Lookup->getParamTag($asset_search, "p_x_ConditionCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($asset_search->DateOfPurchase->Visible) { // DateOfPurchase ?>
	<div id="r_DateOfPurchase" class="form-group row">
		<label for="x_DateOfPurchase" class="<?php echo $asset_search->LeftColumnClass ?>"><span id="elh_asset_DateOfPurchase"><?php echo $asset_search->DateOfPurchase->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DateOfPurchase" id="z_DateOfPurchase" value="=">
</span>
		</label>
		<div class="<?php echo $asset_search->RightColumnClass ?>"><div <?php echo $asset_search->DateOfPurchase->cellAttributes() ?>>
			<span id="el_asset_DateOfPurchase" class="ew-search-field">
<input type="text" data-table="asset" data-field="x_DateOfPurchase" name="x_DateOfPurchase" id="x_DateOfPurchase" placeholder="<?php echo HtmlEncode($asset_search->DateOfPurchase->getPlaceHolder()) ?>" value="<?php echo $asset_search->DateOfPurchase->EditValue ?>"<?php echo $asset_search->DateOfPurchase->editAttributes() ?>>
<?php if (!$asset_search->DateOfPurchase->ReadOnly && !$asset_search->DateOfPurchase->Disabled && !isset($asset_search->DateOfPurchase->EditAttrs["readonly"]) && !isset($asset_search->DateOfPurchase->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetsearch", "x_DateOfPurchase", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($asset_search->AssetCapacity->Visible) { // AssetCapacity ?>
	<div id="r_AssetCapacity" class="form-group row">
		<label for="x_AssetCapacity" class="<?php echo $asset_search->LeftColumnClass ?>"><span id="elh_asset_AssetCapacity"><?php echo $asset_search->AssetCapacity->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AssetCapacity" id="z_AssetCapacity" value="=">
</span>
		</label>
		<div class="<?php echo $asset_search->RightColumnClass ?>"><div <?php echo $asset_search->AssetCapacity->cellAttributes() ?>>
			<span id="el_asset_AssetCapacity" class="ew-search-field">
<input type="text" data-table="asset" data-field="x_AssetCapacity" name="x_AssetCapacity" id="x_AssetCapacity" size="30" placeholder="<?php echo HtmlEncode($asset_search->AssetCapacity->getPlaceHolder()) ?>" value="<?php echo $asset_search->AssetCapacity->EditValue ?>"<?php echo $asset_search->AssetCapacity->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($asset_search->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<div id="r_UnitOfMeasure" class="form-group row">
		<label for="x_UnitOfMeasure" class="<?php echo $asset_search->LeftColumnClass ?>"><span id="elh_asset_UnitOfMeasure"><?php echo $asset_search->UnitOfMeasure->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_UnitOfMeasure" id="z_UnitOfMeasure" value="LIKE">
</span>
		</label>
		<div class="<?php echo $asset_search->RightColumnClass ?>"><div <?php echo $asset_search->UnitOfMeasure->cellAttributes() ?>>
			<span id="el_asset_UnitOfMeasure" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_UnitOfMeasure" data-value-separator="<?php echo $asset_search->UnitOfMeasure->displayValueSeparatorAttribute() ?>" id="x_UnitOfMeasure" name="x_UnitOfMeasure"<?php echo $asset_search->UnitOfMeasure->editAttributes() ?>>
			<?php echo $asset_search->UnitOfMeasure->selectOptionListHtml("x_UnitOfMeasure") ?>
		</select>
</div>
<?php echo $asset_search->UnitOfMeasure->Lookup->getParamTag($asset_search, "p_x_UnitOfMeasure") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($asset_search->AssetDescription->Visible) { // AssetDescription ?>
	<div id="r_AssetDescription" class="form-group row">
		<label for="x_AssetDescription" class="<?php echo $asset_search->LeftColumnClass ?>"><span id="elh_asset_AssetDescription"><?php echo $asset_search->AssetDescription->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AssetDescription" id="z_AssetDescription" value="LIKE">
</span>
		</label>
		<div class="<?php echo $asset_search->RightColumnClass ?>"><div <?php echo $asset_search->AssetDescription->cellAttributes() ?>>
			<span id="el_asset_AssetDescription" class="ew-search-field">
<input type="text" data-table="asset" data-field="x_AssetDescription" name="x_AssetDescription" id="x_AssetDescription" size="50" maxlength="60" placeholder="<?php echo HtmlEncode($asset_search->AssetDescription->getPlaceHolder()) ?>" value="<?php echo $asset_search->AssetDescription->EditValue ?>"<?php echo $asset_search->AssetDescription->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($asset_search->DateOfLastRevaluation->Visible) { // DateOfLastRevaluation ?>
	<div id="r_DateOfLastRevaluation" class="form-group row">
		<label for="x_DateOfLastRevaluation" class="<?php echo $asset_search->LeftColumnClass ?>"><span id="elh_asset_DateOfLastRevaluation"><?php echo $asset_search->DateOfLastRevaluation->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DateOfLastRevaluation" id="z_DateOfLastRevaluation" value="=">
</span>
		</label>
		<div class="<?php echo $asset_search->RightColumnClass ?>"><div <?php echo $asset_search->DateOfLastRevaluation->cellAttributes() ?>>
			<span id="el_asset_DateOfLastRevaluation" class="ew-search-field">
<input type="text" data-table="asset" data-field="x_DateOfLastRevaluation" name="x_DateOfLastRevaluation" id="x_DateOfLastRevaluation" placeholder="<?php echo HtmlEncode($asset_search->DateOfLastRevaluation->getPlaceHolder()) ?>" value="<?php echo $asset_search->DateOfLastRevaluation->EditValue ?>"<?php echo $asset_search->DateOfLastRevaluation->editAttributes() ?>>
<?php if (!$asset_search->DateOfLastRevaluation->ReadOnly && !$asset_search->DateOfLastRevaluation->Disabled && !isset($asset_search->DateOfLastRevaluation->EditAttrs["readonly"]) && !isset($asset_search->DateOfLastRevaluation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetsearch", "x_DateOfLastRevaluation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($asset_search->NewValue->Visible) { // NewValue ?>
	<div id="r_NewValue" class="form-group row">
		<label for="x_NewValue" class="<?php echo $asset_search->LeftColumnClass ?>"><span id="elh_asset_NewValue"><?php echo $asset_search->NewValue->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_NewValue" id="z_NewValue" value="=">
</span>
		</label>
		<div class="<?php echo $asset_search->RightColumnClass ?>"><div <?php echo $asset_search->NewValue->cellAttributes() ?>>
			<span id="el_asset_NewValue" class="ew-search-field">
<input type="text" data-table="asset" data-field="x_NewValue" name="x_NewValue" id="x_NewValue" size="30" placeholder="<?php echo HtmlEncode($asset_search->NewValue->getPlaceHolder()) ?>" value="<?php echo $asset_search->NewValue->EditValue ?>"<?php echo $asset_search->NewValue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($asset_search->NameOfValuer->Visible) { // NameOfValuer ?>
	<div id="r_NameOfValuer" class="form-group row">
		<label for="x_NameOfValuer" class="<?php echo $asset_search->LeftColumnClass ?>"><span id="elh_asset_NameOfValuer"><?php echo $asset_search->NameOfValuer->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_NameOfValuer" id="z_NameOfValuer" value="LIKE">
</span>
		</label>
		<div class="<?php echo $asset_search->RightColumnClass ?>"><div <?php echo $asset_search->NameOfValuer->cellAttributes() ?>>
			<span id="el_asset_NameOfValuer" class="ew-search-field">
<input type="text" data-table="asset" data-field="x_NameOfValuer" name="x_NameOfValuer" id="x_NameOfValuer" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($asset_search->NameOfValuer->getPlaceHolder()) ?>" value="<?php echo $asset_search->NameOfValuer->EditValue ?>"<?php echo $asset_search->NameOfValuer->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($asset_search->BookValue->Visible) { // BookValue ?>
	<div id="r_BookValue" class="form-group row">
		<label for="x_BookValue" class="<?php echo $asset_search->LeftColumnClass ?>"><span id="elh_asset_BookValue"><?php echo $asset_search->BookValue->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BookValue" id="z_BookValue" value="=">
</span>
		</label>
		<div class="<?php echo $asset_search->RightColumnClass ?>"><div <?php echo $asset_search->BookValue->cellAttributes() ?>>
			<span id="el_asset_BookValue" class="ew-search-field">
<input type="text" data-table="asset" data-field="x_BookValue" name="x_BookValue" id="x_BookValue" size="30" placeholder="<?php echo HtmlEncode($asset_search->BookValue->getPlaceHolder()) ?>" value="<?php echo $asset_search->BookValue->EditValue ?>"<?php echo $asset_search->BookValue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($asset_search->LastDepreciationDate->Visible) { // LastDepreciationDate ?>
	<div id="r_LastDepreciationDate" class="form-group row">
		<label for="x_LastDepreciationDate" class="<?php echo $asset_search->LeftColumnClass ?>"><span id="elh_asset_LastDepreciationDate"><?php echo $asset_search->LastDepreciationDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LastDepreciationDate" id="z_LastDepreciationDate" value="=">
</span>
		</label>
		<div class="<?php echo $asset_search->RightColumnClass ?>"><div <?php echo $asset_search->LastDepreciationDate->cellAttributes() ?>>
			<span id="el_asset_LastDepreciationDate" class="ew-search-field">
<input type="text" data-table="asset" data-field="x_LastDepreciationDate" name="x_LastDepreciationDate" id="x_LastDepreciationDate" placeholder="<?php echo HtmlEncode($asset_search->LastDepreciationDate->getPlaceHolder()) ?>" value="<?php echo $asset_search->LastDepreciationDate->EditValue ?>"<?php echo $asset_search->LastDepreciationDate->editAttributes() ?>>
<?php if (!$asset_search->LastDepreciationDate->ReadOnly && !$asset_search->LastDepreciationDate->Disabled && !isset($asset_search->LastDepreciationDate->EditAttrs["readonly"]) && !isset($asset_search->LastDepreciationDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetsearch", "x_LastDepreciationDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($asset_search->LastDepreciationAmount->Visible) { // LastDepreciationAmount ?>
	<div id="r_LastDepreciationAmount" class="form-group row">
		<label for="x_LastDepreciationAmount" class="<?php echo $asset_search->LeftColumnClass ?>"><span id="elh_asset_LastDepreciationAmount"><?php echo $asset_search->LastDepreciationAmount->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LastDepreciationAmount" id="z_LastDepreciationAmount" value="=">
</span>
		</label>
		<div class="<?php echo $asset_search->RightColumnClass ?>"><div <?php echo $asset_search->LastDepreciationAmount->cellAttributes() ?>>
			<span id="el_asset_LastDepreciationAmount" class="ew-search-field">
<input type="text" data-table="asset" data-field="x_LastDepreciationAmount" name="x_LastDepreciationAmount" id="x_LastDepreciationAmount" size="30" placeholder="<?php echo HtmlEncode($asset_search->LastDepreciationAmount->getPlaceHolder()) ?>" value="<?php echo $asset_search->LastDepreciationAmount->EditValue ?>"<?php echo $asset_search->LastDepreciationAmount->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($asset_search->DepreciationRate->Visible) { // DepreciationRate ?>
	<div id="r_DepreciationRate" class="form-group row">
		<label for="x_DepreciationRate" class="<?php echo $asset_search->LeftColumnClass ?>"><span id="elh_asset_DepreciationRate"><?php echo $asset_search->DepreciationRate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DepreciationRate" id="z_DepreciationRate" value="=">
</span>
		</label>
		<div class="<?php echo $asset_search->RightColumnClass ?>"><div <?php echo $asset_search->DepreciationRate->cellAttributes() ?>>
			<span id="el_asset_DepreciationRate" class="ew-search-field">
<input type="text" data-table="asset" data-field="x_DepreciationRate" name="x_DepreciationRate" id="x_DepreciationRate" size="30" placeholder="<?php echo HtmlEncode($asset_search->DepreciationRate->getPlaceHolder()) ?>" value="<?php echo $asset_search->DepreciationRate->EditValue ?>"<?php echo $asset_search->DepreciationRate->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($asset_search->CumulativeDepreciation->Visible) { // CumulativeDepreciation ?>
	<div id="r_CumulativeDepreciation" class="form-group row">
		<label for="x_CumulativeDepreciation" class="<?php echo $asset_search->LeftColumnClass ?>"><span id="elh_asset_CumulativeDepreciation"><?php echo $asset_search->CumulativeDepreciation->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_CumulativeDepreciation" id="z_CumulativeDepreciation" value="=">
</span>
		</label>
		<div class="<?php echo $asset_search->RightColumnClass ?>"><div <?php echo $asset_search->CumulativeDepreciation->cellAttributes() ?>>
			<span id="el_asset_CumulativeDepreciation" class="ew-search-field">
<input type="text" data-table="asset" data-field="x_CumulativeDepreciation" name="x_CumulativeDepreciation" id="x_CumulativeDepreciation" size="30" placeholder="<?php echo HtmlEncode($asset_search->CumulativeDepreciation->getPlaceHolder()) ?>" value="<?php echo $asset_search->CumulativeDepreciation->EditValue ?>"<?php echo $asset_search->CumulativeDepreciation->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($asset_search->AssetStatus->Visible) { // AssetStatus ?>
	<div id="r_AssetStatus" class="form-group row">
		<label for="x_AssetStatus" class="<?php echo $asset_search->LeftColumnClass ?>"><span id="elh_asset_AssetStatus"><?php echo $asset_search->AssetStatus->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AssetStatus" id="z_AssetStatus" value="=">
</span>
		</label>
		<div class="<?php echo $asset_search->RightColumnClass ?>"><div <?php echo $asset_search->AssetStatus->cellAttributes() ?>>
			<span id="el_asset_AssetStatus" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_AssetStatus" data-value-separator="<?php echo $asset_search->AssetStatus->displayValueSeparatorAttribute() ?>" id="x_AssetStatus" name="x_AssetStatus"<?php echo $asset_search->AssetStatus->editAttributes() ?>>
			<?php echo $asset_search->AssetStatus->selectOptionListHtml("x_AssetStatus") ?>
		</select>
</div>
<?php echo $asset_search->AssetStatus->Lookup->getParamTag($asset_search, "p_x_AssetStatus") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($asset_search->ScrapValue->Visible) { // ScrapValue ?>
	<div id="r_ScrapValue" class="form-group row">
		<label for="x_ScrapValue" class="<?php echo $asset_search->LeftColumnClass ?>"><span id="elh_asset_ScrapValue"><?php echo $asset_search->ScrapValue->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ScrapValue" id="z_ScrapValue" value="=">
</span>
		</label>
		<div class="<?php echo $asset_search->RightColumnClass ?>"><div <?php echo $asset_search->ScrapValue->cellAttributes() ?>>
			<span id="el_asset_ScrapValue" class="ew-search-field">
<input type="text" data-table="asset" data-field="x_ScrapValue" name="x_ScrapValue" id="x_ScrapValue" size="30" placeholder="<?php echo HtmlEncode($asset_search->ScrapValue->getPlaceHolder()) ?>" value="<?php echo $asset_search->ScrapValue->EditValue ?>"<?php echo $asset_search->ScrapValue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$asset_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $asset_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$asset_search->showPageFooter();
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
$asset_search->terminate();
?>