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
$asset_edit = new asset_edit();

// Run the page
$asset_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$asset_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fassetedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fassetedit = currentForm = new ew.Form("fassetedit", "edit");

	// Validate form
	fassetedit.validate = function() {
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
			<?php if ($asset_edit->AssetCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_edit->AssetCode->caption(), $asset_edit->AssetCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_edit->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_edit->ProvinceCode->caption(), $asset_edit->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_edit->ProvinceCode->errorMessage()) ?>");
			<?php if ($asset_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_edit->LACode->caption(), $asset_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_edit->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_edit->DepartmentCode->caption(), $asset_edit->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_edit->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_edit->SectionCode->caption(), $asset_edit->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_edit->AssetTypeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetTypeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_edit->AssetTypeCode->caption(), $asset_edit->AssetTypeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_edit->Supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_Supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_edit->Supplier->caption(), $asset_edit->Supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_edit->PurchasePrice->Required) { ?>
				elm = this.getElements("x" + infix + "_PurchasePrice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_edit->PurchasePrice->caption(), $asset_edit->PurchasePrice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PurchasePrice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_edit->PurchasePrice->errorMessage()) ?>");
			<?php if ($asset_edit->CurrencyCode->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrencyCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_edit->CurrencyCode->caption(), $asset_edit->CurrencyCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_edit->ConditionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ConditionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_edit->ConditionCode->caption(), $asset_edit->ConditionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_edit->DateOfPurchase->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfPurchase");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_edit->DateOfPurchase->caption(), $asset_edit->DateOfPurchase->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfPurchase");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_edit->DateOfPurchase->errorMessage()) ?>");
			<?php if ($asset_edit->AssetCapacity->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetCapacity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_edit->AssetCapacity->caption(), $asset_edit->AssetCapacity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AssetCapacity");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_edit->AssetCapacity->errorMessage()) ?>");
			<?php if ($asset_edit->UnitOfMeasure->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitOfMeasure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_edit->UnitOfMeasure->caption(), $asset_edit->UnitOfMeasure->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_edit->AssetDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_edit->AssetDescription->caption(), $asset_edit->AssetDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_edit->DateOfLastRevaluation->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfLastRevaluation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_edit->DateOfLastRevaluation->caption(), $asset_edit->DateOfLastRevaluation->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfLastRevaluation");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_edit->DateOfLastRevaluation->errorMessage()) ?>");
			<?php if ($asset_edit->NewValue->Required) { ?>
				elm = this.getElements("x" + infix + "_NewValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_edit->NewValue->caption(), $asset_edit->NewValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NewValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_edit->NewValue->errorMessage()) ?>");
			<?php if ($asset_edit->NameOfValuer->Required) { ?>
				elm = this.getElements("x" + infix + "_NameOfValuer");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_edit->NameOfValuer->caption(), $asset_edit->NameOfValuer->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_edit->BookValue->Required) { ?>
				elm = this.getElements("x" + infix + "_BookValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_edit->BookValue->caption(), $asset_edit->BookValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BookValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_edit->BookValue->errorMessage()) ?>");
			<?php if ($asset_edit->LastDepreciationDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastDepreciationDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_edit->LastDepreciationDate->caption(), $asset_edit->LastDepreciationDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastDepreciationDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_edit->LastDepreciationDate->errorMessage()) ?>");
			<?php if ($asset_edit->LastDepreciationAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_LastDepreciationAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_edit->LastDepreciationAmount->caption(), $asset_edit->LastDepreciationAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastDepreciationAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_edit->LastDepreciationAmount->errorMessage()) ?>");
			<?php if ($asset_edit->DepreciationRate->Required) { ?>
				elm = this.getElements("x" + infix + "_DepreciationRate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_edit->DepreciationRate->caption(), $asset_edit->DepreciationRate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DepreciationRate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_edit->DepreciationRate->errorMessage()) ?>");
			<?php if ($asset_edit->CumulativeDepreciation->Required) { ?>
				elm = this.getElements("x" + infix + "_CumulativeDepreciation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_edit->CumulativeDepreciation->caption(), $asset_edit->CumulativeDepreciation->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CumulativeDepreciation");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_edit->CumulativeDepreciation->errorMessage()) ?>");
			<?php if ($asset_edit->AssetStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_edit->AssetStatus->caption(), $asset_edit->AssetStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_edit->ScrapValue->Required) { ?>
				elm = this.getElements("x" + infix + "_ScrapValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_edit->ScrapValue->caption(), $asset_edit->ScrapValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ScrapValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_edit->ScrapValue->errorMessage()) ?>");

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
	fassetedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fassetedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fassetedit.lists["x_ProvinceCode"] = <?php echo $asset_edit->ProvinceCode->Lookup->toClientList($asset_edit) ?>;
	fassetedit.lists["x_ProvinceCode"].options = <?php echo JsonEncode($asset_edit->ProvinceCode->lookupOptions()) ?>;
	fassetedit.autoSuggests["x_ProvinceCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fassetedit.lists["x_LACode"] = <?php echo $asset_edit->LACode->Lookup->toClientList($asset_edit) ?>;
	fassetedit.lists["x_LACode"].options = <?php echo JsonEncode($asset_edit->LACode->lookupOptions()) ?>;
	fassetedit.lists["x_DepartmentCode"] = <?php echo $asset_edit->DepartmentCode->Lookup->toClientList($asset_edit) ?>;
	fassetedit.lists["x_DepartmentCode"].options = <?php echo JsonEncode($asset_edit->DepartmentCode->lookupOptions()) ?>;
	fassetedit.lists["x_SectionCode"] = <?php echo $asset_edit->SectionCode->Lookup->toClientList($asset_edit) ?>;
	fassetedit.lists["x_SectionCode"].options = <?php echo JsonEncode($asset_edit->SectionCode->lookupOptions()) ?>;
	fassetedit.lists["x_AssetTypeCode"] = <?php echo $asset_edit->AssetTypeCode->Lookup->toClientList($asset_edit) ?>;
	fassetedit.lists["x_AssetTypeCode"].options = <?php echo JsonEncode($asset_edit->AssetTypeCode->lookupOptions()) ?>;
	fassetedit.lists["x_CurrencyCode"] = <?php echo $asset_edit->CurrencyCode->Lookup->toClientList($asset_edit) ?>;
	fassetedit.lists["x_CurrencyCode"].options = <?php echo JsonEncode($asset_edit->CurrencyCode->lookupOptions()) ?>;
	fassetedit.lists["x_ConditionCode"] = <?php echo $asset_edit->ConditionCode->Lookup->toClientList($asset_edit) ?>;
	fassetedit.lists["x_ConditionCode"].options = <?php echo JsonEncode($asset_edit->ConditionCode->lookupOptions()) ?>;
	fassetedit.lists["x_UnitOfMeasure"] = <?php echo $asset_edit->UnitOfMeasure->Lookup->toClientList($asset_edit) ?>;
	fassetedit.lists["x_UnitOfMeasure"].options = <?php echo JsonEncode($asset_edit->UnitOfMeasure->lookupOptions()) ?>;
	fassetedit.lists["x_AssetStatus"] = <?php echo $asset_edit->AssetStatus->Lookup->toClientList($asset_edit) ?>;
	fassetedit.lists["x_AssetStatus"].options = <?php echo JsonEncode($asset_edit->AssetStatus->lookupOptions()) ?>;
	loadjs.done("fassetedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $asset_edit->showPageHeader(); ?>
<?php
$asset_edit->showMessage();
?>
<?php if (!$asset_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $asset_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fassetedit" id="fassetedit" class="<?php echo $asset_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="asset">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$asset_edit->IsModal ?>">
<?php if ($asset->getCurrentMasterTable() == "local_authority") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($asset_edit->ProvinceCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($asset_edit->LACode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($asset_edit->AssetCode->Visible) { // AssetCode ?>
	<div id="r_AssetCode" class="form-group row">
		<label id="elh_asset_AssetCode" for="x_AssetCode" class="<?php echo $asset_edit->LeftColumnClass ?>"><?php echo $asset_edit->AssetCode->caption() ?><?php echo $asset_edit->AssetCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_edit->RightColumnClass ?>"><div <?php echo $asset_edit->AssetCode->cellAttributes() ?>>
<input type="text" data-table="asset" data-field="x_AssetCode" name="x_AssetCode" id="x_AssetCode" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($asset_edit->AssetCode->getPlaceHolder()) ?>" value="<?php echo $asset_edit->AssetCode->EditValue ?>"<?php echo $asset_edit->AssetCode->editAttributes() ?>>
<input type="hidden" data-table="asset" data-field="x_AssetCode" name="o_AssetCode" id="o_AssetCode" value="<?php echo HtmlEncode($asset_edit->AssetCode->OldValue != null ? $asset_edit->AssetCode->OldValue : $asset_edit->AssetCode->CurrentValue) ?>">
<?php echo $asset_edit->AssetCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_edit->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_asset_ProvinceCode" class="<?php echo $asset_edit->LeftColumnClass ?>"><?php echo $asset_edit->ProvinceCode->caption() ?><?php echo $asset_edit->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_edit->RightColumnClass ?>"><div <?php echo $asset_edit->ProvinceCode->cellAttributes() ?>>
<?php if ($asset_edit->ProvinceCode->getSessionValue() != "") { ?>
<span id="el_asset_ProvinceCode">
<span<?php echo $asset_edit->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_edit->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProvinceCode" name="x_ProvinceCode" value="<?php echo HtmlEncode($asset_edit->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_asset_ProvinceCode">
<?php
$onchange = $asset_edit->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$asset_edit->ProvinceCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProvinceCode">
	<input type="text" class="form-control" name="sv_x_ProvinceCode" id="sv_x_ProvinceCode" value="<?php echo RemoveHtml($asset_edit->ProvinceCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($asset_edit->ProvinceCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($asset_edit->ProvinceCode->getPlaceHolder()) ?>"<?php echo $asset_edit->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_ProvinceCode" data-value-separator="<?php echo $asset_edit->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x_ProvinceCode" id="x_ProvinceCode" value="<?php echo HtmlEncode($asset_edit->ProvinceCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fassetedit"], function() {
	fassetedit.createAutoSuggest({"id":"x_ProvinceCode","forceSelect":false});
});
</script>
<?php echo $asset_edit->ProvinceCode->Lookup->getParamTag($asset_edit, "p_x_ProvinceCode") ?>
</span>
<?php } ?>
<?php echo $asset_edit->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_asset_LACode" for="x_LACode" class="<?php echo $asset_edit->LeftColumnClass ?>"><?php echo $asset_edit->LACode->caption() ?><?php echo $asset_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_edit->RightColumnClass ?>"><div <?php echo $asset_edit->LACode->cellAttributes() ?>>
<?php if ($asset_edit->LACode->getSessionValue() != "") { ?>
<span id="el_asset_LACode">
<span<?php echo $asset_edit->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_edit->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($asset_edit->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_asset_LACode">
<?php $asset_edit->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_LACode" data-value-separator="<?php echo $asset_edit->LACode->displayValueSeparatorAttribute() ?>" id="x_LACode" name="x_LACode"<?php echo $asset_edit->LACode->editAttributes() ?>>
			<?php echo $asset_edit->LACode->selectOptionListHtml("x_LACode") ?>
		</select>
</div>
<?php echo $asset_edit->LACode->Lookup->getParamTag($asset_edit, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $asset_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_edit->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_asset_DepartmentCode" for="x_DepartmentCode" class="<?php echo $asset_edit->LeftColumnClass ?>"><?php echo $asset_edit->DepartmentCode->caption() ?><?php echo $asset_edit->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_edit->RightColumnClass ?>"><div <?php echo $asset_edit->DepartmentCode->cellAttributes() ?>>
<span id="el_asset_DepartmentCode">
<?php $asset_edit->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_DepartmentCode" data-value-separator="<?php echo $asset_edit->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $asset_edit->DepartmentCode->editAttributes() ?>>
			<?php echo $asset_edit->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $asset_edit->DepartmentCode->Lookup->getParamTag($asset_edit, "p_x_DepartmentCode") ?>
</span>
<?php echo $asset_edit->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_edit->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_asset_SectionCode" for="x_SectionCode" class="<?php echo $asset_edit->LeftColumnClass ?>"><?php echo $asset_edit->SectionCode->caption() ?><?php echo $asset_edit->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_edit->RightColumnClass ?>"><div <?php echo $asset_edit->SectionCode->cellAttributes() ?>>
<span id="el_asset_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_SectionCode" data-value-separator="<?php echo $asset_edit->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $asset_edit->SectionCode->editAttributes() ?>>
			<?php echo $asset_edit->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $asset_edit->SectionCode->Lookup->getParamTag($asset_edit, "p_x_SectionCode") ?>
</span>
<?php echo $asset_edit->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_edit->AssetTypeCode->Visible) { // AssetTypeCode ?>
	<div id="r_AssetTypeCode" class="form-group row">
		<label id="elh_asset_AssetTypeCode" for="x_AssetTypeCode" class="<?php echo $asset_edit->LeftColumnClass ?>"><?php echo $asset_edit->AssetTypeCode->caption() ?><?php echo $asset_edit->AssetTypeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_edit->RightColumnClass ?>"><div <?php echo $asset_edit->AssetTypeCode->cellAttributes() ?>>
<span id="el_asset_AssetTypeCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_AssetTypeCode" data-value-separator="<?php echo $asset_edit->AssetTypeCode->displayValueSeparatorAttribute() ?>" id="x_AssetTypeCode" name="x_AssetTypeCode"<?php echo $asset_edit->AssetTypeCode->editAttributes() ?>>
			<?php echo $asset_edit->AssetTypeCode->selectOptionListHtml("x_AssetTypeCode") ?>
		</select>
</div>
<?php echo $asset_edit->AssetTypeCode->Lookup->getParamTag($asset_edit, "p_x_AssetTypeCode") ?>
</span>
<?php echo $asset_edit->AssetTypeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_edit->Supplier->Visible) { // Supplier ?>
	<div id="r_Supplier" class="form-group row">
		<label id="elh_asset_Supplier" for="x_Supplier" class="<?php echo $asset_edit->LeftColumnClass ?>"><?php echo $asset_edit->Supplier->caption() ?><?php echo $asset_edit->Supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_edit->RightColumnClass ?>"><div <?php echo $asset_edit->Supplier->cellAttributes() ?>>
<span id="el_asset_Supplier">
<input type="text" data-table="asset" data-field="x_Supplier" name="x_Supplier" id="x_Supplier" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($asset_edit->Supplier->getPlaceHolder()) ?>" value="<?php echo $asset_edit->Supplier->EditValue ?>"<?php echo $asset_edit->Supplier->editAttributes() ?>>
</span>
<?php echo $asset_edit->Supplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_edit->PurchasePrice->Visible) { // PurchasePrice ?>
	<div id="r_PurchasePrice" class="form-group row">
		<label id="elh_asset_PurchasePrice" for="x_PurchasePrice" class="<?php echo $asset_edit->LeftColumnClass ?>"><?php echo $asset_edit->PurchasePrice->caption() ?><?php echo $asset_edit->PurchasePrice->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_edit->RightColumnClass ?>"><div <?php echo $asset_edit->PurchasePrice->cellAttributes() ?>>
<span id="el_asset_PurchasePrice">
<input type="text" data-table="asset" data-field="x_PurchasePrice" name="x_PurchasePrice" id="x_PurchasePrice" size="30" placeholder="<?php echo HtmlEncode($asset_edit->PurchasePrice->getPlaceHolder()) ?>" value="<?php echo $asset_edit->PurchasePrice->EditValue ?>"<?php echo $asset_edit->PurchasePrice->editAttributes() ?>>
</span>
<?php echo $asset_edit->PurchasePrice->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_edit->CurrencyCode->Visible) { // CurrencyCode ?>
	<div id="r_CurrencyCode" class="form-group row">
		<label id="elh_asset_CurrencyCode" for="x_CurrencyCode" class="<?php echo $asset_edit->LeftColumnClass ?>"><?php echo $asset_edit->CurrencyCode->caption() ?><?php echo $asset_edit->CurrencyCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_edit->RightColumnClass ?>"><div <?php echo $asset_edit->CurrencyCode->cellAttributes() ?>>
<span id="el_asset_CurrencyCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_CurrencyCode" data-value-separator="<?php echo $asset_edit->CurrencyCode->displayValueSeparatorAttribute() ?>" id="x_CurrencyCode" name="x_CurrencyCode"<?php echo $asset_edit->CurrencyCode->editAttributes() ?>>
			<?php echo $asset_edit->CurrencyCode->selectOptionListHtml("x_CurrencyCode") ?>
		</select>
</div>
<?php echo $asset_edit->CurrencyCode->Lookup->getParamTag($asset_edit, "p_x_CurrencyCode") ?>
</span>
<?php echo $asset_edit->CurrencyCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_edit->ConditionCode->Visible) { // ConditionCode ?>
	<div id="r_ConditionCode" class="form-group row">
		<label id="elh_asset_ConditionCode" for="x_ConditionCode" class="<?php echo $asset_edit->LeftColumnClass ?>"><?php echo $asset_edit->ConditionCode->caption() ?><?php echo $asset_edit->ConditionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_edit->RightColumnClass ?>"><div <?php echo $asset_edit->ConditionCode->cellAttributes() ?>>
<span id="el_asset_ConditionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_ConditionCode" data-value-separator="<?php echo $asset_edit->ConditionCode->displayValueSeparatorAttribute() ?>" id="x_ConditionCode" name="x_ConditionCode"<?php echo $asset_edit->ConditionCode->editAttributes() ?>>
			<?php echo $asset_edit->ConditionCode->selectOptionListHtml("x_ConditionCode") ?>
		</select>
</div>
<?php echo $asset_edit->ConditionCode->Lookup->getParamTag($asset_edit, "p_x_ConditionCode") ?>
</span>
<?php echo $asset_edit->ConditionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_edit->DateOfPurchase->Visible) { // DateOfPurchase ?>
	<div id="r_DateOfPurchase" class="form-group row">
		<label id="elh_asset_DateOfPurchase" for="x_DateOfPurchase" class="<?php echo $asset_edit->LeftColumnClass ?>"><?php echo $asset_edit->DateOfPurchase->caption() ?><?php echo $asset_edit->DateOfPurchase->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_edit->RightColumnClass ?>"><div <?php echo $asset_edit->DateOfPurchase->cellAttributes() ?>>
<span id="el_asset_DateOfPurchase">
<input type="text" data-table="asset" data-field="x_DateOfPurchase" name="x_DateOfPurchase" id="x_DateOfPurchase" placeholder="<?php echo HtmlEncode($asset_edit->DateOfPurchase->getPlaceHolder()) ?>" value="<?php echo $asset_edit->DateOfPurchase->EditValue ?>"<?php echo $asset_edit->DateOfPurchase->editAttributes() ?>>
<?php if (!$asset_edit->DateOfPurchase->ReadOnly && !$asset_edit->DateOfPurchase->Disabled && !isset($asset_edit->DateOfPurchase->EditAttrs["readonly"]) && !isset($asset_edit->DateOfPurchase->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetedit", "x_DateOfPurchase", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $asset_edit->DateOfPurchase->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_edit->AssetCapacity->Visible) { // AssetCapacity ?>
	<div id="r_AssetCapacity" class="form-group row">
		<label id="elh_asset_AssetCapacity" for="x_AssetCapacity" class="<?php echo $asset_edit->LeftColumnClass ?>"><?php echo $asset_edit->AssetCapacity->caption() ?><?php echo $asset_edit->AssetCapacity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_edit->RightColumnClass ?>"><div <?php echo $asset_edit->AssetCapacity->cellAttributes() ?>>
<span id="el_asset_AssetCapacity">
<input type="text" data-table="asset" data-field="x_AssetCapacity" name="x_AssetCapacity" id="x_AssetCapacity" size="30" placeholder="<?php echo HtmlEncode($asset_edit->AssetCapacity->getPlaceHolder()) ?>" value="<?php echo $asset_edit->AssetCapacity->EditValue ?>"<?php echo $asset_edit->AssetCapacity->editAttributes() ?>>
</span>
<?php echo $asset_edit->AssetCapacity->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_edit->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<div id="r_UnitOfMeasure" class="form-group row">
		<label id="elh_asset_UnitOfMeasure" for="x_UnitOfMeasure" class="<?php echo $asset_edit->LeftColumnClass ?>"><?php echo $asset_edit->UnitOfMeasure->caption() ?><?php echo $asset_edit->UnitOfMeasure->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_edit->RightColumnClass ?>"><div <?php echo $asset_edit->UnitOfMeasure->cellAttributes() ?>>
<span id="el_asset_UnitOfMeasure">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_UnitOfMeasure" data-value-separator="<?php echo $asset_edit->UnitOfMeasure->displayValueSeparatorAttribute() ?>" id="x_UnitOfMeasure" name="x_UnitOfMeasure"<?php echo $asset_edit->UnitOfMeasure->editAttributes() ?>>
			<?php echo $asset_edit->UnitOfMeasure->selectOptionListHtml("x_UnitOfMeasure") ?>
		</select>
</div>
<?php echo $asset_edit->UnitOfMeasure->Lookup->getParamTag($asset_edit, "p_x_UnitOfMeasure") ?>
</span>
<?php echo $asset_edit->UnitOfMeasure->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_edit->AssetDescription->Visible) { // AssetDescription ?>
	<div id="r_AssetDescription" class="form-group row">
		<label id="elh_asset_AssetDescription" for="x_AssetDescription" class="<?php echo $asset_edit->LeftColumnClass ?>"><?php echo $asset_edit->AssetDescription->caption() ?><?php echo $asset_edit->AssetDescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_edit->RightColumnClass ?>"><div <?php echo $asset_edit->AssetDescription->cellAttributes() ?>>
<span id="el_asset_AssetDescription">
<input type="text" data-table="asset" data-field="x_AssetDescription" name="x_AssetDescription" id="x_AssetDescription" size="50" maxlength="60" placeholder="<?php echo HtmlEncode($asset_edit->AssetDescription->getPlaceHolder()) ?>" value="<?php echo $asset_edit->AssetDescription->EditValue ?>"<?php echo $asset_edit->AssetDescription->editAttributes() ?>>
</span>
<?php echo $asset_edit->AssetDescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_edit->DateOfLastRevaluation->Visible) { // DateOfLastRevaluation ?>
	<div id="r_DateOfLastRevaluation" class="form-group row">
		<label id="elh_asset_DateOfLastRevaluation" for="x_DateOfLastRevaluation" class="<?php echo $asset_edit->LeftColumnClass ?>"><?php echo $asset_edit->DateOfLastRevaluation->caption() ?><?php echo $asset_edit->DateOfLastRevaluation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_edit->RightColumnClass ?>"><div <?php echo $asset_edit->DateOfLastRevaluation->cellAttributes() ?>>
<span id="el_asset_DateOfLastRevaluation">
<input type="text" data-table="asset" data-field="x_DateOfLastRevaluation" name="x_DateOfLastRevaluation" id="x_DateOfLastRevaluation" placeholder="<?php echo HtmlEncode($asset_edit->DateOfLastRevaluation->getPlaceHolder()) ?>" value="<?php echo $asset_edit->DateOfLastRevaluation->EditValue ?>"<?php echo $asset_edit->DateOfLastRevaluation->editAttributes() ?>>
<?php if (!$asset_edit->DateOfLastRevaluation->ReadOnly && !$asset_edit->DateOfLastRevaluation->Disabled && !isset($asset_edit->DateOfLastRevaluation->EditAttrs["readonly"]) && !isset($asset_edit->DateOfLastRevaluation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetedit", "x_DateOfLastRevaluation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $asset_edit->DateOfLastRevaluation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_edit->NewValue->Visible) { // NewValue ?>
	<div id="r_NewValue" class="form-group row">
		<label id="elh_asset_NewValue" for="x_NewValue" class="<?php echo $asset_edit->LeftColumnClass ?>"><?php echo $asset_edit->NewValue->caption() ?><?php echo $asset_edit->NewValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_edit->RightColumnClass ?>"><div <?php echo $asset_edit->NewValue->cellAttributes() ?>>
<span id="el_asset_NewValue">
<input type="text" data-table="asset" data-field="x_NewValue" name="x_NewValue" id="x_NewValue" size="30" placeholder="<?php echo HtmlEncode($asset_edit->NewValue->getPlaceHolder()) ?>" value="<?php echo $asset_edit->NewValue->EditValue ?>"<?php echo $asset_edit->NewValue->editAttributes() ?>>
</span>
<?php echo $asset_edit->NewValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_edit->NameOfValuer->Visible) { // NameOfValuer ?>
	<div id="r_NameOfValuer" class="form-group row">
		<label id="elh_asset_NameOfValuer" for="x_NameOfValuer" class="<?php echo $asset_edit->LeftColumnClass ?>"><?php echo $asset_edit->NameOfValuer->caption() ?><?php echo $asset_edit->NameOfValuer->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_edit->RightColumnClass ?>"><div <?php echo $asset_edit->NameOfValuer->cellAttributes() ?>>
<span id="el_asset_NameOfValuer">
<input type="text" data-table="asset" data-field="x_NameOfValuer" name="x_NameOfValuer" id="x_NameOfValuer" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($asset_edit->NameOfValuer->getPlaceHolder()) ?>" value="<?php echo $asset_edit->NameOfValuer->EditValue ?>"<?php echo $asset_edit->NameOfValuer->editAttributes() ?>>
</span>
<?php echo $asset_edit->NameOfValuer->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_edit->BookValue->Visible) { // BookValue ?>
	<div id="r_BookValue" class="form-group row">
		<label id="elh_asset_BookValue" for="x_BookValue" class="<?php echo $asset_edit->LeftColumnClass ?>"><?php echo $asset_edit->BookValue->caption() ?><?php echo $asset_edit->BookValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_edit->RightColumnClass ?>"><div <?php echo $asset_edit->BookValue->cellAttributes() ?>>
<span id="el_asset_BookValue">
<input type="text" data-table="asset" data-field="x_BookValue" name="x_BookValue" id="x_BookValue" size="30" placeholder="<?php echo HtmlEncode($asset_edit->BookValue->getPlaceHolder()) ?>" value="<?php echo $asset_edit->BookValue->EditValue ?>"<?php echo $asset_edit->BookValue->editAttributes() ?>>
</span>
<?php echo $asset_edit->BookValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_edit->LastDepreciationDate->Visible) { // LastDepreciationDate ?>
	<div id="r_LastDepreciationDate" class="form-group row">
		<label id="elh_asset_LastDepreciationDate" for="x_LastDepreciationDate" class="<?php echo $asset_edit->LeftColumnClass ?>"><?php echo $asset_edit->LastDepreciationDate->caption() ?><?php echo $asset_edit->LastDepreciationDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_edit->RightColumnClass ?>"><div <?php echo $asset_edit->LastDepreciationDate->cellAttributes() ?>>
<span id="el_asset_LastDepreciationDate">
<input type="text" data-table="asset" data-field="x_LastDepreciationDate" name="x_LastDepreciationDate" id="x_LastDepreciationDate" placeholder="<?php echo HtmlEncode($asset_edit->LastDepreciationDate->getPlaceHolder()) ?>" value="<?php echo $asset_edit->LastDepreciationDate->EditValue ?>"<?php echo $asset_edit->LastDepreciationDate->editAttributes() ?>>
<?php if (!$asset_edit->LastDepreciationDate->ReadOnly && !$asset_edit->LastDepreciationDate->Disabled && !isset($asset_edit->LastDepreciationDate->EditAttrs["readonly"]) && !isset($asset_edit->LastDepreciationDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetedit", "x_LastDepreciationDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $asset_edit->LastDepreciationDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_edit->LastDepreciationAmount->Visible) { // LastDepreciationAmount ?>
	<div id="r_LastDepreciationAmount" class="form-group row">
		<label id="elh_asset_LastDepreciationAmount" for="x_LastDepreciationAmount" class="<?php echo $asset_edit->LeftColumnClass ?>"><?php echo $asset_edit->LastDepreciationAmount->caption() ?><?php echo $asset_edit->LastDepreciationAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_edit->RightColumnClass ?>"><div <?php echo $asset_edit->LastDepreciationAmount->cellAttributes() ?>>
<span id="el_asset_LastDepreciationAmount">
<input type="text" data-table="asset" data-field="x_LastDepreciationAmount" name="x_LastDepreciationAmount" id="x_LastDepreciationAmount" size="30" placeholder="<?php echo HtmlEncode($asset_edit->LastDepreciationAmount->getPlaceHolder()) ?>" value="<?php echo $asset_edit->LastDepreciationAmount->EditValue ?>"<?php echo $asset_edit->LastDepreciationAmount->editAttributes() ?>>
</span>
<?php echo $asset_edit->LastDepreciationAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_edit->DepreciationRate->Visible) { // DepreciationRate ?>
	<div id="r_DepreciationRate" class="form-group row">
		<label id="elh_asset_DepreciationRate" for="x_DepreciationRate" class="<?php echo $asset_edit->LeftColumnClass ?>"><?php echo $asset_edit->DepreciationRate->caption() ?><?php echo $asset_edit->DepreciationRate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_edit->RightColumnClass ?>"><div <?php echo $asset_edit->DepreciationRate->cellAttributes() ?>>
<span id="el_asset_DepreciationRate">
<input type="text" data-table="asset" data-field="x_DepreciationRate" name="x_DepreciationRate" id="x_DepreciationRate" size="30" placeholder="<?php echo HtmlEncode($asset_edit->DepreciationRate->getPlaceHolder()) ?>" value="<?php echo $asset_edit->DepreciationRate->EditValue ?>"<?php echo $asset_edit->DepreciationRate->editAttributes() ?>>
</span>
<?php echo $asset_edit->DepreciationRate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_edit->CumulativeDepreciation->Visible) { // CumulativeDepreciation ?>
	<div id="r_CumulativeDepreciation" class="form-group row">
		<label id="elh_asset_CumulativeDepreciation" for="x_CumulativeDepreciation" class="<?php echo $asset_edit->LeftColumnClass ?>"><?php echo $asset_edit->CumulativeDepreciation->caption() ?><?php echo $asset_edit->CumulativeDepreciation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_edit->RightColumnClass ?>"><div <?php echo $asset_edit->CumulativeDepreciation->cellAttributes() ?>>
<span id="el_asset_CumulativeDepreciation">
<input type="text" data-table="asset" data-field="x_CumulativeDepreciation" name="x_CumulativeDepreciation" id="x_CumulativeDepreciation" size="30" placeholder="<?php echo HtmlEncode($asset_edit->CumulativeDepreciation->getPlaceHolder()) ?>" value="<?php echo $asset_edit->CumulativeDepreciation->EditValue ?>"<?php echo $asset_edit->CumulativeDepreciation->editAttributes() ?>>
</span>
<?php echo $asset_edit->CumulativeDepreciation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_edit->AssetStatus->Visible) { // AssetStatus ?>
	<div id="r_AssetStatus" class="form-group row">
		<label id="elh_asset_AssetStatus" for="x_AssetStatus" class="<?php echo $asset_edit->LeftColumnClass ?>"><?php echo $asset_edit->AssetStatus->caption() ?><?php echo $asset_edit->AssetStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_edit->RightColumnClass ?>"><div <?php echo $asset_edit->AssetStatus->cellAttributes() ?>>
<span id="el_asset_AssetStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_AssetStatus" data-value-separator="<?php echo $asset_edit->AssetStatus->displayValueSeparatorAttribute() ?>" id="x_AssetStatus" name="x_AssetStatus"<?php echo $asset_edit->AssetStatus->editAttributes() ?>>
			<?php echo $asset_edit->AssetStatus->selectOptionListHtml("x_AssetStatus") ?>
		</select>
</div>
<?php echo $asset_edit->AssetStatus->Lookup->getParamTag($asset_edit, "p_x_AssetStatus") ?>
</span>
<?php echo $asset_edit->AssetStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_edit->ScrapValue->Visible) { // ScrapValue ?>
	<div id="r_ScrapValue" class="form-group row">
		<label id="elh_asset_ScrapValue" for="x_ScrapValue" class="<?php echo $asset_edit->LeftColumnClass ?>"><?php echo $asset_edit->ScrapValue->caption() ?><?php echo $asset_edit->ScrapValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_edit->RightColumnClass ?>"><div <?php echo $asset_edit->ScrapValue->cellAttributes() ?>>
<span id="el_asset_ScrapValue">
<input type="text" data-table="asset" data-field="x_ScrapValue" name="x_ScrapValue" id="x_ScrapValue" size="30" placeholder="<?php echo HtmlEncode($asset_edit->ScrapValue->getPlaceHolder()) ?>" value="<?php echo $asset_edit->ScrapValue->EditValue ?>"<?php echo $asset_edit->ScrapValue->editAttributes() ?>>
</span>
<?php echo $asset_edit->ScrapValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$asset_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $asset_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $asset_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$asset_edit->IsModal) { ?>
<?php echo $asset_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$asset_edit->showPageFooter();
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
$asset_edit->terminate();
?>