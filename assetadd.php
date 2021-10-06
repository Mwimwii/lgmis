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
$asset_add = new asset_add();

// Run the page
$asset_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$asset_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fassetadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fassetadd = currentForm = new ew.Form("fassetadd", "add");

	// Validate form
	fassetadd.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($asset_add->AssetCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_add->AssetCode->caption(), $asset_add->AssetCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_add->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_add->ProvinceCode->caption(), $asset_add->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_add->ProvinceCode->errorMessage()) ?>");
			<?php if ($asset_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_add->LACode->caption(), $asset_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_add->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_add->DepartmentCode->caption(), $asset_add->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_add->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_add->SectionCode->caption(), $asset_add->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_add->AssetTypeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetTypeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_add->AssetTypeCode->caption(), $asset_add->AssetTypeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_add->Supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_Supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_add->Supplier->caption(), $asset_add->Supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_add->PurchasePrice->Required) { ?>
				elm = this.getElements("x" + infix + "_PurchasePrice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_add->PurchasePrice->caption(), $asset_add->PurchasePrice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PurchasePrice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_add->PurchasePrice->errorMessage()) ?>");
			<?php if ($asset_add->CurrencyCode->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrencyCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_add->CurrencyCode->caption(), $asset_add->CurrencyCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_add->ConditionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ConditionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_add->ConditionCode->caption(), $asset_add->ConditionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_add->DateOfPurchase->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfPurchase");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_add->DateOfPurchase->caption(), $asset_add->DateOfPurchase->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfPurchase");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_add->DateOfPurchase->errorMessage()) ?>");
			<?php if ($asset_add->AssetCapacity->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetCapacity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_add->AssetCapacity->caption(), $asset_add->AssetCapacity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AssetCapacity");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_add->AssetCapacity->errorMessage()) ?>");
			<?php if ($asset_add->UnitOfMeasure->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitOfMeasure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_add->UnitOfMeasure->caption(), $asset_add->UnitOfMeasure->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_add->AssetDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_add->AssetDescription->caption(), $asset_add->AssetDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_add->DateOfLastRevaluation->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfLastRevaluation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_add->DateOfLastRevaluation->caption(), $asset_add->DateOfLastRevaluation->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfLastRevaluation");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_add->DateOfLastRevaluation->errorMessage()) ?>");
			<?php if ($asset_add->NewValue->Required) { ?>
				elm = this.getElements("x" + infix + "_NewValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_add->NewValue->caption(), $asset_add->NewValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NewValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_add->NewValue->errorMessage()) ?>");
			<?php if ($asset_add->NameOfValuer->Required) { ?>
				elm = this.getElements("x" + infix + "_NameOfValuer");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_add->NameOfValuer->caption(), $asset_add->NameOfValuer->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_add->BookValue->Required) { ?>
				elm = this.getElements("x" + infix + "_BookValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_add->BookValue->caption(), $asset_add->BookValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BookValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_add->BookValue->errorMessage()) ?>");
			<?php if ($asset_add->LastDepreciationDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastDepreciationDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_add->LastDepreciationDate->caption(), $asset_add->LastDepreciationDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastDepreciationDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_add->LastDepreciationDate->errorMessage()) ?>");
			<?php if ($asset_add->LastDepreciationAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_LastDepreciationAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_add->LastDepreciationAmount->caption(), $asset_add->LastDepreciationAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastDepreciationAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_add->LastDepreciationAmount->errorMessage()) ?>");
			<?php if ($asset_add->DepreciationRate->Required) { ?>
				elm = this.getElements("x" + infix + "_DepreciationRate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_add->DepreciationRate->caption(), $asset_add->DepreciationRate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DepreciationRate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_add->DepreciationRate->errorMessage()) ?>");
			<?php if ($asset_add->CumulativeDepreciation->Required) { ?>
				elm = this.getElements("x" + infix + "_CumulativeDepreciation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_add->CumulativeDepreciation->caption(), $asset_add->CumulativeDepreciation->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CumulativeDepreciation");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_add->CumulativeDepreciation->errorMessage()) ?>");
			<?php if ($asset_add->AssetStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_add->AssetStatus->caption(), $asset_add->AssetStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_add->ScrapValue->Required) { ?>
				elm = this.getElements("x" + infix + "_ScrapValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_add->ScrapValue->caption(), $asset_add->ScrapValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ScrapValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_add->ScrapValue->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fassetadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fassetadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fassetadd.lists["x_ProvinceCode"] = <?php echo $asset_add->ProvinceCode->Lookup->toClientList($asset_add) ?>;
	fassetadd.lists["x_ProvinceCode"].options = <?php echo JsonEncode($asset_add->ProvinceCode->lookupOptions()) ?>;
	fassetadd.autoSuggests["x_ProvinceCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fassetadd.lists["x_LACode"] = <?php echo $asset_add->LACode->Lookup->toClientList($asset_add) ?>;
	fassetadd.lists["x_LACode"].options = <?php echo JsonEncode($asset_add->LACode->lookupOptions()) ?>;
	fassetadd.lists["x_DepartmentCode"] = <?php echo $asset_add->DepartmentCode->Lookup->toClientList($asset_add) ?>;
	fassetadd.lists["x_DepartmentCode"].options = <?php echo JsonEncode($asset_add->DepartmentCode->lookupOptions()) ?>;
	fassetadd.lists["x_SectionCode"] = <?php echo $asset_add->SectionCode->Lookup->toClientList($asset_add) ?>;
	fassetadd.lists["x_SectionCode"].options = <?php echo JsonEncode($asset_add->SectionCode->lookupOptions()) ?>;
	fassetadd.lists["x_AssetTypeCode"] = <?php echo $asset_add->AssetTypeCode->Lookup->toClientList($asset_add) ?>;
	fassetadd.lists["x_AssetTypeCode"].options = <?php echo JsonEncode($asset_add->AssetTypeCode->lookupOptions()) ?>;
	fassetadd.lists["x_CurrencyCode"] = <?php echo $asset_add->CurrencyCode->Lookup->toClientList($asset_add) ?>;
	fassetadd.lists["x_CurrencyCode"].options = <?php echo JsonEncode($asset_add->CurrencyCode->lookupOptions()) ?>;
	fassetadd.lists["x_ConditionCode"] = <?php echo $asset_add->ConditionCode->Lookup->toClientList($asset_add) ?>;
	fassetadd.lists["x_ConditionCode"].options = <?php echo JsonEncode($asset_add->ConditionCode->lookupOptions()) ?>;
	fassetadd.lists["x_UnitOfMeasure"] = <?php echo $asset_add->UnitOfMeasure->Lookup->toClientList($asset_add) ?>;
	fassetadd.lists["x_UnitOfMeasure"].options = <?php echo JsonEncode($asset_add->UnitOfMeasure->lookupOptions()) ?>;
	fassetadd.lists["x_AssetStatus"] = <?php echo $asset_add->AssetStatus->Lookup->toClientList($asset_add) ?>;
	fassetadd.lists["x_AssetStatus"].options = <?php echo JsonEncode($asset_add->AssetStatus->lookupOptions()) ?>;
	loadjs.done("fassetadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $asset_add->showPageHeader(); ?>
<?php
$asset_add->showMessage();
?>
<form name="fassetadd" id="fassetadd" class="<?php echo $asset_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="asset">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$asset_add->IsModal ?>">
<?php if ($asset->getCurrentMasterTable() == "local_authority") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($asset_add->ProvinceCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($asset_add->LACode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($asset_add->AssetCode->Visible) { // AssetCode ?>
	<div id="r_AssetCode" class="form-group row">
		<label id="elh_asset_AssetCode" for="x_AssetCode" class="<?php echo $asset_add->LeftColumnClass ?>"><?php echo $asset_add->AssetCode->caption() ?><?php echo $asset_add->AssetCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_add->RightColumnClass ?>"><div <?php echo $asset_add->AssetCode->cellAttributes() ?>>
<span id="el_asset_AssetCode">
<input type="text" data-table="asset" data-field="x_AssetCode" name="x_AssetCode" id="x_AssetCode" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($asset_add->AssetCode->getPlaceHolder()) ?>" value="<?php echo $asset_add->AssetCode->EditValue ?>"<?php echo $asset_add->AssetCode->editAttributes() ?>>
</span>
<?php echo $asset_add->AssetCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_add->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_asset_ProvinceCode" class="<?php echo $asset_add->LeftColumnClass ?>"><?php echo $asset_add->ProvinceCode->caption() ?><?php echo $asset_add->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_add->RightColumnClass ?>"><div <?php echo $asset_add->ProvinceCode->cellAttributes() ?>>
<?php if ($asset_add->ProvinceCode->getSessionValue() != "") { ?>
<span id="el_asset_ProvinceCode">
<span<?php echo $asset_add->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_add->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProvinceCode" name="x_ProvinceCode" value="<?php echo HtmlEncode($asset_add->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_asset_ProvinceCode">
<?php
$onchange = $asset_add->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$asset_add->ProvinceCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProvinceCode">
	<input type="text" class="form-control" name="sv_x_ProvinceCode" id="sv_x_ProvinceCode" value="<?php echo RemoveHtml($asset_add->ProvinceCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($asset_add->ProvinceCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($asset_add->ProvinceCode->getPlaceHolder()) ?>"<?php echo $asset_add->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_ProvinceCode" data-value-separator="<?php echo $asset_add->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x_ProvinceCode" id="x_ProvinceCode" value="<?php echo HtmlEncode($asset_add->ProvinceCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fassetadd"], function() {
	fassetadd.createAutoSuggest({"id":"x_ProvinceCode","forceSelect":false});
});
</script>
<?php echo $asset_add->ProvinceCode->Lookup->getParamTag($asset_add, "p_x_ProvinceCode") ?>
</span>
<?php } ?>
<?php echo $asset_add->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_asset_LACode" for="x_LACode" class="<?php echo $asset_add->LeftColumnClass ?>"><?php echo $asset_add->LACode->caption() ?><?php echo $asset_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_add->RightColumnClass ?>"><div <?php echo $asset_add->LACode->cellAttributes() ?>>
<?php if ($asset_add->LACode->getSessionValue() != "") { ?>
<span id="el_asset_LACode">
<span<?php echo $asset_add->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_add->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($asset_add->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_asset_LACode">
<?php $asset_add->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_LACode" data-value-separator="<?php echo $asset_add->LACode->displayValueSeparatorAttribute() ?>" id="x_LACode" name="x_LACode"<?php echo $asset_add->LACode->editAttributes() ?>>
			<?php echo $asset_add->LACode->selectOptionListHtml("x_LACode") ?>
		</select>
</div>
<?php echo $asset_add->LACode->Lookup->getParamTag($asset_add, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $asset_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_add->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_asset_DepartmentCode" for="x_DepartmentCode" class="<?php echo $asset_add->LeftColumnClass ?>"><?php echo $asset_add->DepartmentCode->caption() ?><?php echo $asset_add->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_add->RightColumnClass ?>"><div <?php echo $asset_add->DepartmentCode->cellAttributes() ?>>
<span id="el_asset_DepartmentCode">
<?php $asset_add->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_DepartmentCode" data-value-separator="<?php echo $asset_add->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $asset_add->DepartmentCode->editAttributes() ?>>
			<?php echo $asset_add->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $asset_add->DepartmentCode->Lookup->getParamTag($asset_add, "p_x_DepartmentCode") ?>
</span>
<?php echo $asset_add->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_add->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_asset_SectionCode" for="x_SectionCode" class="<?php echo $asset_add->LeftColumnClass ?>"><?php echo $asset_add->SectionCode->caption() ?><?php echo $asset_add->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_add->RightColumnClass ?>"><div <?php echo $asset_add->SectionCode->cellAttributes() ?>>
<span id="el_asset_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_SectionCode" data-value-separator="<?php echo $asset_add->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $asset_add->SectionCode->editAttributes() ?>>
			<?php echo $asset_add->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $asset_add->SectionCode->Lookup->getParamTag($asset_add, "p_x_SectionCode") ?>
</span>
<?php echo $asset_add->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_add->AssetTypeCode->Visible) { // AssetTypeCode ?>
	<div id="r_AssetTypeCode" class="form-group row">
		<label id="elh_asset_AssetTypeCode" for="x_AssetTypeCode" class="<?php echo $asset_add->LeftColumnClass ?>"><?php echo $asset_add->AssetTypeCode->caption() ?><?php echo $asset_add->AssetTypeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_add->RightColumnClass ?>"><div <?php echo $asset_add->AssetTypeCode->cellAttributes() ?>>
<span id="el_asset_AssetTypeCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_AssetTypeCode" data-value-separator="<?php echo $asset_add->AssetTypeCode->displayValueSeparatorAttribute() ?>" id="x_AssetTypeCode" name="x_AssetTypeCode"<?php echo $asset_add->AssetTypeCode->editAttributes() ?>>
			<?php echo $asset_add->AssetTypeCode->selectOptionListHtml("x_AssetTypeCode") ?>
		</select>
</div>
<?php echo $asset_add->AssetTypeCode->Lookup->getParamTag($asset_add, "p_x_AssetTypeCode") ?>
</span>
<?php echo $asset_add->AssetTypeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_add->Supplier->Visible) { // Supplier ?>
	<div id="r_Supplier" class="form-group row">
		<label id="elh_asset_Supplier" for="x_Supplier" class="<?php echo $asset_add->LeftColumnClass ?>"><?php echo $asset_add->Supplier->caption() ?><?php echo $asset_add->Supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_add->RightColumnClass ?>"><div <?php echo $asset_add->Supplier->cellAttributes() ?>>
<span id="el_asset_Supplier">
<input type="text" data-table="asset" data-field="x_Supplier" name="x_Supplier" id="x_Supplier" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($asset_add->Supplier->getPlaceHolder()) ?>" value="<?php echo $asset_add->Supplier->EditValue ?>"<?php echo $asset_add->Supplier->editAttributes() ?>>
</span>
<?php echo $asset_add->Supplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_add->PurchasePrice->Visible) { // PurchasePrice ?>
	<div id="r_PurchasePrice" class="form-group row">
		<label id="elh_asset_PurchasePrice" for="x_PurchasePrice" class="<?php echo $asset_add->LeftColumnClass ?>"><?php echo $asset_add->PurchasePrice->caption() ?><?php echo $asset_add->PurchasePrice->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_add->RightColumnClass ?>"><div <?php echo $asset_add->PurchasePrice->cellAttributes() ?>>
<span id="el_asset_PurchasePrice">
<input type="text" data-table="asset" data-field="x_PurchasePrice" name="x_PurchasePrice" id="x_PurchasePrice" size="30" placeholder="<?php echo HtmlEncode($asset_add->PurchasePrice->getPlaceHolder()) ?>" value="<?php echo $asset_add->PurchasePrice->EditValue ?>"<?php echo $asset_add->PurchasePrice->editAttributes() ?>>
</span>
<?php echo $asset_add->PurchasePrice->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_add->CurrencyCode->Visible) { // CurrencyCode ?>
	<div id="r_CurrencyCode" class="form-group row">
		<label id="elh_asset_CurrencyCode" for="x_CurrencyCode" class="<?php echo $asset_add->LeftColumnClass ?>"><?php echo $asset_add->CurrencyCode->caption() ?><?php echo $asset_add->CurrencyCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_add->RightColumnClass ?>"><div <?php echo $asset_add->CurrencyCode->cellAttributes() ?>>
<span id="el_asset_CurrencyCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_CurrencyCode" data-value-separator="<?php echo $asset_add->CurrencyCode->displayValueSeparatorAttribute() ?>" id="x_CurrencyCode" name="x_CurrencyCode"<?php echo $asset_add->CurrencyCode->editAttributes() ?>>
			<?php echo $asset_add->CurrencyCode->selectOptionListHtml("x_CurrencyCode") ?>
		</select>
</div>
<?php echo $asset_add->CurrencyCode->Lookup->getParamTag($asset_add, "p_x_CurrencyCode") ?>
</span>
<?php echo $asset_add->CurrencyCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_add->ConditionCode->Visible) { // ConditionCode ?>
	<div id="r_ConditionCode" class="form-group row">
		<label id="elh_asset_ConditionCode" for="x_ConditionCode" class="<?php echo $asset_add->LeftColumnClass ?>"><?php echo $asset_add->ConditionCode->caption() ?><?php echo $asset_add->ConditionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_add->RightColumnClass ?>"><div <?php echo $asset_add->ConditionCode->cellAttributes() ?>>
<span id="el_asset_ConditionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_ConditionCode" data-value-separator="<?php echo $asset_add->ConditionCode->displayValueSeparatorAttribute() ?>" id="x_ConditionCode" name="x_ConditionCode"<?php echo $asset_add->ConditionCode->editAttributes() ?>>
			<?php echo $asset_add->ConditionCode->selectOptionListHtml("x_ConditionCode") ?>
		</select>
</div>
<?php echo $asset_add->ConditionCode->Lookup->getParamTag($asset_add, "p_x_ConditionCode") ?>
</span>
<?php echo $asset_add->ConditionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_add->DateOfPurchase->Visible) { // DateOfPurchase ?>
	<div id="r_DateOfPurchase" class="form-group row">
		<label id="elh_asset_DateOfPurchase" for="x_DateOfPurchase" class="<?php echo $asset_add->LeftColumnClass ?>"><?php echo $asset_add->DateOfPurchase->caption() ?><?php echo $asset_add->DateOfPurchase->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_add->RightColumnClass ?>"><div <?php echo $asset_add->DateOfPurchase->cellAttributes() ?>>
<span id="el_asset_DateOfPurchase">
<input type="text" data-table="asset" data-field="x_DateOfPurchase" name="x_DateOfPurchase" id="x_DateOfPurchase" placeholder="<?php echo HtmlEncode($asset_add->DateOfPurchase->getPlaceHolder()) ?>" value="<?php echo $asset_add->DateOfPurchase->EditValue ?>"<?php echo $asset_add->DateOfPurchase->editAttributes() ?>>
<?php if (!$asset_add->DateOfPurchase->ReadOnly && !$asset_add->DateOfPurchase->Disabled && !isset($asset_add->DateOfPurchase->EditAttrs["readonly"]) && !isset($asset_add->DateOfPurchase->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetadd", "x_DateOfPurchase", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $asset_add->DateOfPurchase->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_add->AssetCapacity->Visible) { // AssetCapacity ?>
	<div id="r_AssetCapacity" class="form-group row">
		<label id="elh_asset_AssetCapacity" for="x_AssetCapacity" class="<?php echo $asset_add->LeftColumnClass ?>"><?php echo $asset_add->AssetCapacity->caption() ?><?php echo $asset_add->AssetCapacity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_add->RightColumnClass ?>"><div <?php echo $asset_add->AssetCapacity->cellAttributes() ?>>
<span id="el_asset_AssetCapacity">
<input type="text" data-table="asset" data-field="x_AssetCapacity" name="x_AssetCapacity" id="x_AssetCapacity" size="30" placeholder="<?php echo HtmlEncode($asset_add->AssetCapacity->getPlaceHolder()) ?>" value="<?php echo $asset_add->AssetCapacity->EditValue ?>"<?php echo $asset_add->AssetCapacity->editAttributes() ?>>
</span>
<?php echo $asset_add->AssetCapacity->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_add->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<div id="r_UnitOfMeasure" class="form-group row">
		<label id="elh_asset_UnitOfMeasure" for="x_UnitOfMeasure" class="<?php echo $asset_add->LeftColumnClass ?>"><?php echo $asset_add->UnitOfMeasure->caption() ?><?php echo $asset_add->UnitOfMeasure->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_add->RightColumnClass ?>"><div <?php echo $asset_add->UnitOfMeasure->cellAttributes() ?>>
<span id="el_asset_UnitOfMeasure">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_UnitOfMeasure" data-value-separator="<?php echo $asset_add->UnitOfMeasure->displayValueSeparatorAttribute() ?>" id="x_UnitOfMeasure" name="x_UnitOfMeasure"<?php echo $asset_add->UnitOfMeasure->editAttributes() ?>>
			<?php echo $asset_add->UnitOfMeasure->selectOptionListHtml("x_UnitOfMeasure") ?>
		</select>
</div>
<?php echo $asset_add->UnitOfMeasure->Lookup->getParamTag($asset_add, "p_x_UnitOfMeasure") ?>
</span>
<?php echo $asset_add->UnitOfMeasure->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_add->AssetDescription->Visible) { // AssetDescription ?>
	<div id="r_AssetDescription" class="form-group row">
		<label id="elh_asset_AssetDescription" for="x_AssetDescription" class="<?php echo $asset_add->LeftColumnClass ?>"><?php echo $asset_add->AssetDescription->caption() ?><?php echo $asset_add->AssetDescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_add->RightColumnClass ?>"><div <?php echo $asset_add->AssetDescription->cellAttributes() ?>>
<span id="el_asset_AssetDescription">
<input type="text" data-table="asset" data-field="x_AssetDescription" name="x_AssetDescription" id="x_AssetDescription" size="50" maxlength="60" placeholder="<?php echo HtmlEncode($asset_add->AssetDescription->getPlaceHolder()) ?>" value="<?php echo $asset_add->AssetDescription->EditValue ?>"<?php echo $asset_add->AssetDescription->editAttributes() ?>>
</span>
<?php echo $asset_add->AssetDescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_add->DateOfLastRevaluation->Visible) { // DateOfLastRevaluation ?>
	<div id="r_DateOfLastRevaluation" class="form-group row">
		<label id="elh_asset_DateOfLastRevaluation" for="x_DateOfLastRevaluation" class="<?php echo $asset_add->LeftColumnClass ?>"><?php echo $asset_add->DateOfLastRevaluation->caption() ?><?php echo $asset_add->DateOfLastRevaluation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_add->RightColumnClass ?>"><div <?php echo $asset_add->DateOfLastRevaluation->cellAttributes() ?>>
<span id="el_asset_DateOfLastRevaluation">
<input type="text" data-table="asset" data-field="x_DateOfLastRevaluation" name="x_DateOfLastRevaluation" id="x_DateOfLastRevaluation" placeholder="<?php echo HtmlEncode($asset_add->DateOfLastRevaluation->getPlaceHolder()) ?>" value="<?php echo $asset_add->DateOfLastRevaluation->EditValue ?>"<?php echo $asset_add->DateOfLastRevaluation->editAttributes() ?>>
<?php if (!$asset_add->DateOfLastRevaluation->ReadOnly && !$asset_add->DateOfLastRevaluation->Disabled && !isset($asset_add->DateOfLastRevaluation->EditAttrs["readonly"]) && !isset($asset_add->DateOfLastRevaluation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetadd", "x_DateOfLastRevaluation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $asset_add->DateOfLastRevaluation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_add->NewValue->Visible) { // NewValue ?>
	<div id="r_NewValue" class="form-group row">
		<label id="elh_asset_NewValue" for="x_NewValue" class="<?php echo $asset_add->LeftColumnClass ?>"><?php echo $asset_add->NewValue->caption() ?><?php echo $asset_add->NewValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_add->RightColumnClass ?>"><div <?php echo $asset_add->NewValue->cellAttributes() ?>>
<span id="el_asset_NewValue">
<input type="text" data-table="asset" data-field="x_NewValue" name="x_NewValue" id="x_NewValue" size="30" placeholder="<?php echo HtmlEncode($asset_add->NewValue->getPlaceHolder()) ?>" value="<?php echo $asset_add->NewValue->EditValue ?>"<?php echo $asset_add->NewValue->editAttributes() ?>>
</span>
<?php echo $asset_add->NewValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_add->NameOfValuer->Visible) { // NameOfValuer ?>
	<div id="r_NameOfValuer" class="form-group row">
		<label id="elh_asset_NameOfValuer" for="x_NameOfValuer" class="<?php echo $asset_add->LeftColumnClass ?>"><?php echo $asset_add->NameOfValuer->caption() ?><?php echo $asset_add->NameOfValuer->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_add->RightColumnClass ?>"><div <?php echo $asset_add->NameOfValuer->cellAttributes() ?>>
<span id="el_asset_NameOfValuer">
<input type="text" data-table="asset" data-field="x_NameOfValuer" name="x_NameOfValuer" id="x_NameOfValuer" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($asset_add->NameOfValuer->getPlaceHolder()) ?>" value="<?php echo $asset_add->NameOfValuer->EditValue ?>"<?php echo $asset_add->NameOfValuer->editAttributes() ?>>
</span>
<?php echo $asset_add->NameOfValuer->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_add->BookValue->Visible) { // BookValue ?>
	<div id="r_BookValue" class="form-group row">
		<label id="elh_asset_BookValue" for="x_BookValue" class="<?php echo $asset_add->LeftColumnClass ?>"><?php echo $asset_add->BookValue->caption() ?><?php echo $asset_add->BookValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_add->RightColumnClass ?>"><div <?php echo $asset_add->BookValue->cellAttributes() ?>>
<span id="el_asset_BookValue">
<input type="text" data-table="asset" data-field="x_BookValue" name="x_BookValue" id="x_BookValue" size="30" placeholder="<?php echo HtmlEncode($asset_add->BookValue->getPlaceHolder()) ?>" value="<?php echo $asset_add->BookValue->EditValue ?>"<?php echo $asset_add->BookValue->editAttributes() ?>>
</span>
<?php echo $asset_add->BookValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_add->LastDepreciationDate->Visible) { // LastDepreciationDate ?>
	<div id="r_LastDepreciationDate" class="form-group row">
		<label id="elh_asset_LastDepreciationDate" for="x_LastDepreciationDate" class="<?php echo $asset_add->LeftColumnClass ?>"><?php echo $asset_add->LastDepreciationDate->caption() ?><?php echo $asset_add->LastDepreciationDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_add->RightColumnClass ?>"><div <?php echo $asset_add->LastDepreciationDate->cellAttributes() ?>>
<span id="el_asset_LastDepreciationDate">
<input type="text" data-table="asset" data-field="x_LastDepreciationDate" name="x_LastDepreciationDate" id="x_LastDepreciationDate" placeholder="<?php echo HtmlEncode($asset_add->LastDepreciationDate->getPlaceHolder()) ?>" value="<?php echo $asset_add->LastDepreciationDate->EditValue ?>"<?php echo $asset_add->LastDepreciationDate->editAttributes() ?>>
<?php if (!$asset_add->LastDepreciationDate->ReadOnly && !$asset_add->LastDepreciationDate->Disabled && !isset($asset_add->LastDepreciationDate->EditAttrs["readonly"]) && !isset($asset_add->LastDepreciationDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetadd", "x_LastDepreciationDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $asset_add->LastDepreciationDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_add->LastDepreciationAmount->Visible) { // LastDepreciationAmount ?>
	<div id="r_LastDepreciationAmount" class="form-group row">
		<label id="elh_asset_LastDepreciationAmount" for="x_LastDepreciationAmount" class="<?php echo $asset_add->LeftColumnClass ?>"><?php echo $asset_add->LastDepreciationAmount->caption() ?><?php echo $asset_add->LastDepreciationAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_add->RightColumnClass ?>"><div <?php echo $asset_add->LastDepreciationAmount->cellAttributes() ?>>
<span id="el_asset_LastDepreciationAmount">
<input type="text" data-table="asset" data-field="x_LastDepreciationAmount" name="x_LastDepreciationAmount" id="x_LastDepreciationAmount" size="30" placeholder="<?php echo HtmlEncode($asset_add->LastDepreciationAmount->getPlaceHolder()) ?>" value="<?php echo $asset_add->LastDepreciationAmount->EditValue ?>"<?php echo $asset_add->LastDepreciationAmount->editAttributes() ?>>
</span>
<?php echo $asset_add->LastDepreciationAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_add->DepreciationRate->Visible) { // DepreciationRate ?>
	<div id="r_DepreciationRate" class="form-group row">
		<label id="elh_asset_DepreciationRate" for="x_DepreciationRate" class="<?php echo $asset_add->LeftColumnClass ?>"><?php echo $asset_add->DepreciationRate->caption() ?><?php echo $asset_add->DepreciationRate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_add->RightColumnClass ?>"><div <?php echo $asset_add->DepreciationRate->cellAttributes() ?>>
<span id="el_asset_DepreciationRate">
<input type="text" data-table="asset" data-field="x_DepreciationRate" name="x_DepreciationRate" id="x_DepreciationRate" size="30" placeholder="<?php echo HtmlEncode($asset_add->DepreciationRate->getPlaceHolder()) ?>" value="<?php echo $asset_add->DepreciationRate->EditValue ?>"<?php echo $asset_add->DepreciationRate->editAttributes() ?>>
</span>
<?php echo $asset_add->DepreciationRate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_add->CumulativeDepreciation->Visible) { // CumulativeDepreciation ?>
	<div id="r_CumulativeDepreciation" class="form-group row">
		<label id="elh_asset_CumulativeDepreciation" for="x_CumulativeDepreciation" class="<?php echo $asset_add->LeftColumnClass ?>"><?php echo $asset_add->CumulativeDepreciation->caption() ?><?php echo $asset_add->CumulativeDepreciation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_add->RightColumnClass ?>"><div <?php echo $asset_add->CumulativeDepreciation->cellAttributes() ?>>
<span id="el_asset_CumulativeDepreciation">
<input type="text" data-table="asset" data-field="x_CumulativeDepreciation" name="x_CumulativeDepreciation" id="x_CumulativeDepreciation" size="30" placeholder="<?php echo HtmlEncode($asset_add->CumulativeDepreciation->getPlaceHolder()) ?>" value="<?php echo $asset_add->CumulativeDepreciation->EditValue ?>"<?php echo $asset_add->CumulativeDepreciation->editAttributes() ?>>
</span>
<?php echo $asset_add->CumulativeDepreciation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_add->AssetStatus->Visible) { // AssetStatus ?>
	<div id="r_AssetStatus" class="form-group row">
		<label id="elh_asset_AssetStatus" for="x_AssetStatus" class="<?php echo $asset_add->LeftColumnClass ?>"><?php echo $asset_add->AssetStatus->caption() ?><?php echo $asset_add->AssetStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_add->RightColumnClass ?>"><div <?php echo $asset_add->AssetStatus->cellAttributes() ?>>
<span id="el_asset_AssetStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_AssetStatus" data-value-separator="<?php echo $asset_add->AssetStatus->displayValueSeparatorAttribute() ?>" id="x_AssetStatus" name="x_AssetStatus"<?php echo $asset_add->AssetStatus->editAttributes() ?>>
			<?php echo $asset_add->AssetStatus->selectOptionListHtml("x_AssetStatus") ?>
		</select>
</div>
<?php echo $asset_add->AssetStatus->Lookup->getParamTag($asset_add, "p_x_AssetStatus") ?>
</span>
<?php echo $asset_add->AssetStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_add->ScrapValue->Visible) { // ScrapValue ?>
	<div id="r_ScrapValue" class="form-group row">
		<label id="elh_asset_ScrapValue" for="x_ScrapValue" class="<?php echo $asset_add->LeftColumnClass ?>"><?php echo $asset_add->ScrapValue->caption() ?><?php echo $asset_add->ScrapValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_add->RightColumnClass ?>"><div <?php echo $asset_add->ScrapValue->cellAttributes() ?>>
<span id="el_asset_ScrapValue">
<input type="text" data-table="asset" data-field="x_ScrapValue" name="x_ScrapValue" id="x_ScrapValue" size="30" placeholder="<?php echo HtmlEncode($asset_add->ScrapValue->getPlaceHolder()) ?>" value="<?php echo $asset_add->ScrapValue->EditValue ?>"<?php echo $asset_add->ScrapValue->editAttributes() ?>>
</span>
<?php echo $asset_add->ScrapValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$asset_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $asset_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $asset_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$asset_add->showPageFooter();
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
$asset_add->terminate();
?>