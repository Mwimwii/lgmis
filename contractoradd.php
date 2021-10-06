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
$contractor_add = new contractor_add();

// Run the page
$contractor_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contractor_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcontractoradd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcontractoradd = currentForm = new ew.Form("fcontractoradd", "add");

	// Validate form
	fcontractoradd.validate = function() {
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
			<?php if ($contractor_add->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_add->ProvinceCode->caption(), $contractor_add->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contractor_add->ProvinceCode->errorMessage()) ?>");
			<?php if ($contractor_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_add->LACode->caption(), $contractor_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_add->ContractorName->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractorName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_add->ContractorName->caption(), $contractor_add->ContractorName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_add->TradingName->Required) { ?>
				elm = this.getElements("x" + infix + "_TradingName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_add->TradingName->caption(), $contractor_add->TradingName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_add->ZambianContrator->Required) { ?>
				elm = this.getElements("x" + infix + "_ZambianContrator[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_add->ZambianContrator->caption(), $contractor_add->ZambianContrator->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_add->ContractorType->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractorType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_add->ContractorType->caption(), $contractor_add->ContractorType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_add->BusinessType->Required) { ?>
				elm = this.getElements("x" + infix + "_BusinessType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_add->BusinessType->caption(), $contractor_add->BusinessType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_add->BusinessSector->Required) { ?>
				elm = this.getElements("x" + infix + "_BusinessSector");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_add->BusinessSector->caption(), $contractor_add->BusinessSector->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_add->BusinessDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_BusinessDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_add->BusinessDesc->caption(), $contractor_add->BusinessDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_add->PostalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PostalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_add->PostalAddress->caption(), $contractor_add->PostalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_add->Town->Required) { ?>
				elm = this.getElements("x" + infix + "_Town");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_add->Town->caption(), $contractor_add->Town->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_add->PhysicaAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PhysicaAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_add->PhysicaAddress->caption(), $contractor_add->PhysicaAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_add->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_add->_Email->caption(), $contractor_add->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_add->Telephone->Required) { ?>
				elm = this.getElements("x" + infix + "_Telephone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_add->Telephone->caption(), $contractor_add->Telephone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_add->Mobile->Required) { ?>
				elm = this.getElements("x" + infix + "_Mobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_add->Mobile->caption(), $contractor_add->Mobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_add->Fax->Required) { ?>
				elm = this.getElements("x" + infix + "_Fax");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_add->Fax->caption(), $contractor_add->Fax->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_add->Country->Required) { ?>
				elm = this.getElements("x" + infix + "_Country");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_add->Country->caption(), $contractor_add->Country->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_add->ContactPerson->Required) { ?>
				elm = this.getElements("x" + infix + "_ContactPerson");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_add->ContactPerson->caption(), $contractor_add->ContactPerson->RequiredErrorMessage)) ?>");
			<?php } ?>

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
	fcontractoradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcontractoradd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcontractoradd.lists["x_ProvinceCode"] = <?php echo $contractor_add->ProvinceCode->Lookup->toClientList($contractor_add) ?>;
	fcontractoradd.lists["x_ProvinceCode"].options = <?php echo JsonEncode($contractor_add->ProvinceCode->lookupOptions()) ?>;
	fcontractoradd.autoSuggests["x_ProvinceCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcontractoradd.lists["x_LACode"] = <?php echo $contractor_add->LACode->Lookup->toClientList($contractor_add) ?>;
	fcontractoradd.lists["x_LACode"].options = <?php echo JsonEncode($contractor_add->LACode->lookupOptions()) ?>;
	fcontractoradd.lists["x_ZambianContrator[]"] = <?php echo $contractor_add->ZambianContrator->Lookup->toClientList($contractor_add) ?>;
	fcontractoradd.lists["x_ZambianContrator[]"].options = <?php echo JsonEncode($contractor_add->ZambianContrator->options(FALSE, TRUE)) ?>;
	fcontractoradd.lists["x_ContractorType"] = <?php echo $contractor_add->ContractorType->Lookup->toClientList($contractor_add) ?>;
	fcontractoradd.lists["x_ContractorType"].options = <?php echo JsonEncode($contractor_add->ContractorType->lookupOptions()) ?>;
	fcontractoradd.lists["x_BusinessType"] = <?php echo $contractor_add->BusinessType->Lookup->toClientList($contractor_add) ?>;
	fcontractoradd.lists["x_BusinessType"].options = <?php echo JsonEncode($contractor_add->BusinessType->lookupOptions()) ?>;
	fcontractoradd.lists["x_BusinessSector"] = <?php echo $contractor_add->BusinessSector->Lookup->toClientList($contractor_add) ?>;
	fcontractoradd.lists["x_BusinessSector"].options = <?php echo JsonEncode($contractor_add->BusinessSector->lookupOptions()) ?>;
	fcontractoradd.lists["x_Country"] = <?php echo $contractor_add->Country->Lookup->toClientList($contractor_add) ?>;
	fcontractoradd.lists["x_Country"].options = <?php echo JsonEncode($contractor_add->Country->lookupOptions()) ?>;
	fcontractoradd.autoSuggests["x_Country"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fcontractoradd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $contractor_add->showPageHeader(); ?>
<?php
$contractor_add->showMessage();
?>
<form name="fcontractoradd" id="fcontractoradd" class="<?php echo $contractor_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contractor">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$contractor_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($contractor_add->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_contractor_ProvinceCode" class="<?php echo $contractor_add->LeftColumnClass ?>"><?php echo $contractor_add->ProvinceCode->caption() ?><?php echo $contractor_add->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_add->RightColumnClass ?>"><div <?php echo $contractor_add->ProvinceCode->cellAttributes() ?>>
<span id="el_contractor_ProvinceCode">
<?php
$onchange = $contractor_add->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$contractor_add->ProvinceCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProvinceCode">
	<input type="text" class="form-control" name="sv_x_ProvinceCode" id="sv_x_ProvinceCode" value="<?php echo RemoveHtml($contractor_add->ProvinceCode->EditValue) ?>" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($contractor_add->ProvinceCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($contractor_add->ProvinceCode->getPlaceHolder()) ?>"<?php echo $contractor_add->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="contractor" data-field="x_ProvinceCode" data-value-separator="<?php echo $contractor_add->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x_ProvinceCode" id="x_ProvinceCode" value="<?php echo HtmlEncode($contractor_add->ProvinceCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcontractoradd"], function() {
	fcontractoradd.createAutoSuggest({"id":"x_ProvinceCode","forceSelect":false});
});
</script>
<?php echo $contractor_add->ProvinceCode->Lookup->getParamTag($contractor_add, "p_x_ProvinceCode") ?>
</span>
<?php echo $contractor_add->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_contractor_LACode" for="x_LACode" class="<?php echo $contractor_add->LeftColumnClass ?>"><?php echo $contractor_add->LACode->caption() ?><?php echo $contractor_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_add->RightColumnClass ?>"><div <?php echo $contractor_add->LACode->cellAttributes() ?>>
<span id="el_contractor_LACode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($contractor_add->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $contractor_add->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contractor_add->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($contractor_add->LACode->ReadOnly || $contractor_add->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $contractor_add->LACode->Lookup->getParamTag($contractor_add, "p_x_LACode") ?>
<input type="hidden" data-table="contractor" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contractor_add->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $contractor_add->LACode->CurrentValue ?>"<?php echo $contractor_add->LACode->editAttributes() ?>>
</span>
<?php echo $contractor_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_add->ContractorName->Visible) { // ContractorName ?>
	<div id="r_ContractorName" class="form-group row">
		<label id="elh_contractor_ContractorName" for="x_ContractorName" class="<?php echo $contractor_add->LeftColumnClass ?>"><?php echo $contractor_add->ContractorName->caption() ?><?php echo $contractor_add->ContractorName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_add->RightColumnClass ?>"><div <?php echo $contractor_add->ContractorName->cellAttributes() ?>>
<span id="el_contractor_ContractorName">
<input type="text" data-table="contractor" data-field="x_ContractorName" name="x_ContractorName" id="x_ContractorName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($contractor_add->ContractorName->getPlaceHolder()) ?>" value="<?php echo $contractor_add->ContractorName->EditValue ?>"<?php echo $contractor_add->ContractorName->editAttributes() ?>>
</span>
<?php echo $contractor_add->ContractorName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_add->TradingName->Visible) { // TradingName ?>
	<div id="r_TradingName" class="form-group row">
		<label id="elh_contractor_TradingName" for="x_TradingName" class="<?php echo $contractor_add->LeftColumnClass ?>"><?php echo $contractor_add->TradingName->caption() ?><?php echo $contractor_add->TradingName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_add->RightColumnClass ?>"><div <?php echo $contractor_add->TradingName->cellAttributes() ?>>
<span id="el_contractor_TradingName">
<input type="text" data-table="contractor" data-field="x_TradingName" name="x_TradingName" id="x_TradingName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($contractor_add->TradingName->getPlaceHolder()) ?>" value="<?php echo $contractor_add->TradingName->EditValue ?>"<?php echo $contractor_add->TradingName->editAttributes() ?>>
</span>
<?php echo $contractor_add->TradingName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_add->ZambianContrator->Visible) { // ZambianContrator ?>
	<div id="r_ZambianContrator" class="form-group row">
		<label id="elh_contractor_ZambianContrator" class="<?php echo $contractor_add->LeftColumnClass ?>"><?php echo $contractor_add->ZambianContrator->caption() ?><?php echo $contractor_add->ZambianContrator->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_add->RightColumnClass ?>"><div <?php echo $contractor_add->ZambianContrator->cellAttributes() ?>>
<span id="el_contractor_ZambianContrator">
<?php
$selwrk = ConvertToBool($contractor_add->ZambianContrator->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="contractor" data-field="x_ZambianContrator" name="x_ZambianContrator[]" id="x_ZambianContrator[]_782107" value="1"<?php echo $selwrk ?><?php echo $contractor_add->ZambianContrator->editAttributes() ?>>
	<label class="custom-control-label" for="x_ZambianContrator[]_782107"></label>
</div>
</span>
<?php echo $contractor_add->ZambianContrator->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_add->ContractorType->Visible) { // ContractorType ?>
	<div id="r_ContractorType" class="form-group row">
		<label id="elh_contractor_ContractorType" for="x_ContractorType" class="<?php echo $contractor_add->LeftColumnClass ?>"><?php echo $contractor_add->ContractorType->caption() ?><?php echo $contractor_add->ContractorType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_add->RightColumnClass ?>"><div <?php echo $contractor_add->ContractorType->cellAttributes() ?>>
<span id="el_contractor_ContractorType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contractor" data-field="x_ContractorType" data-value-separator="<?php echo $contractor_add->ContractorType->displayValueSeparatorAttribute() ?>" id="x_ContractorType" name="x_ContractorType"<?php echo $contractor_add->ContractorType->editAttributes() ?>>
			<?php echo $contractor_add->ContractorType->selectOptionListHtml("x_ContractorType") ?>
		</select>
</div>
<?php echo $contractor_add->ContractorType->Lookup->getParamTag($contractor_add, "p_x_ContractorType") ?>
</span>
<?php echo $contractor_add->ContractorType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_add->BusinessType->Visible) { // BusinessType ?>
	<div id="r_BusinessType" class="form-group row">
		<label id="elh_contractor_BusinessType" for="x_BusinessType" class="<?php echo $contractor_add->LeftColumnClass ?>"><?php echo $contractor_add->BusinessType->caption() ?><?php echo $contractor_add->BusinessType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_add->RightColumnClass ?>"><div <?php echo $contractor_add->BusinessType->cellAttributes() ?>>
<span id="el_contractor_BusinessType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contractor" data-field="x_BusinessType" data-value-separator="<?php echo $contractor_add->BusinessType->displayValueSeparatorAttribute() ?>" id="x_BusinessType" name="x_BusinessType"<?php echo $contractor_add->BusinessType->editAttributes() ?>>
			<?php echo $contractor_add->BusinessType->selectOptionListHtml("x_BusinessType") ?>
		</select>
</div>
<?php echo $contractor_add->BusinessType->Lookup->getParamTag($contractor_add, "p_x_BusinessType") ?>
</span>
<?php echo $contractor_add->BusinessType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_add->BusinessSector->Visible) { // BusinessSector ?>
	<div id="r_BusinessSector" class="form-group row">
		<label id="elh_contractor_BusinessSector" for="x_BusinessSector" class="<?php echo $contractor_add->LeftColumnClass ?>"><?php echo $contractor_add->BusinessSector->caption() ?><?php echo $contractor_add->BusinessSector->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_add->RightColumnClass ?>"><div <?php echo $contractor_add->BusinessSector->cellAttributes() ?>>
<span id="el_contractor_BusinessSector">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contractor" data-field="x_BusinessSector" data-value-separator="<?php echo $contractor_add->BusinessSector->displayValueSeparatorAttribute() ?>" id="x_BusinessSector" name="x_BusinessSector"<?php echo $contractor_add->BusinessSector->editAttributes() ?>>
			<?php echo $contractor_add->BusinessSector->selectOptionListHtml("x_BusinessSector") ?>
		</select>
</div>
<?php echo $contractor_add->BusinessSector->Lookup->getParamTag($contractor_add, "p_x_BusinessSector") ?>
</span>
<?php echo $contractor_add->BusinessSector->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_add->BusinessDesc->Visible) { // BusinessDesc ?>
	<div id="r_BusinessDesc" class="form-group row">
		<label id="elh_contractor_BusinessDesc" for="x_BusinessDesc" class="<?php echo $contractor_add->LeftColumnClass ?>"><?php echo $contractor_add->BusinessDesc->caption() ?><?php echo $contractor_add->BusinessDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_add->RightColumnClass ?>"><div <?php echo $contractor_add->BusinessDesc->cellAttributes() ?>>
<span id="el_contractor_BusinessDesc">
<textarea data-table="contractor" data-field="x_BusinessDesc" name="x_BusinessDesc" id="x_BusinessDesc" cols="35" rows="2" placeholder="<?php echo HtmlEncode($contractor_add->BusinessDesc->getPlaceHolder()) ?>"<?php echo $contractor_add->BusinessDesc->editAttributes() ?>><?php echo $contractor_add->BusinessDesc->EditValue ?></textarea>
</span>
<?php echo $contractor_add->BusinessDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_add->PostalAddress->Visible) { // PostalAddress ?>
	<div id="r_PostalAddress" class="form-group row">
		<label id="elh_contractor_PostalAddress" for="x_PostalAddress" class="<?php echo $contractor_add->LeftColumnClass ?>"><?php echo $contractor_add->PostalAddress->caption() ?><?php echo $contractor_add->PostalAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_add->RightColumnClass ?>"><div <?php echo $contractor_add->PostalAddress->cellAttributes() ?>>
<span id="el_contractor_PostalAddress">
<textarea data-table="contractor" data-field="x_PostalAddress" name="x_PostalAddress" id="x_PostalAddress" cols="35" rows="2" placeholder="<?php echo HtmlEncode($contractor_add->PostalAddress->getPlaceHolder()) ?>"<?php echo $contractor_add->PostalAddress->editAttributes() ?>><?php echo $contractor_add->PostalAddress->EditValue ?></textarea>
</span>
<?php echo $contractor_add->PostalAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_add->Town->Visible) { // Town ?>
	<div id="r_Town" class="form-group row">
		<label id="elh_contractor_Town" for="x_Town" class="<?php echo $contractor_add->LeftColumnClass ?>"><?php echo $contractor_add->Town->caption() ?><?php echo $contractor_add->Town->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_add->RightColumnClass ?>"><div <?php echo $contractor_add->Town->cellAttributes() ?>>
<span id="el_contractor_Town">
<input type="text" data-table="contractor" data-field="x_Town" name="x_Town" id="x_Town" size="30" maxlength="70" placeholder="<?php echo HtmlEncode($contractor_add->Town->getPlaceHolder()) ?>" value="<?php echo $contractor_add->Town->EditValue ?>"<?php echo $contractor_add->Town->editAttributes() ?>>
</span>
<?php echo $contractor_add->Town->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_add->PhysicaAddress->Visible) { // PhysicaAddress ?>
	<div id="r_PhysicaAddress" class="form-group row">
		<label id="elh_contractor_PhysicaAddress" for="x_PhysicaAddress" class="<?php echo $contractor_add->LeftColumnClass ?>"><?php echo $contractor_add->PhysicaAddress->caption() ?><?php echo $contractor_add->PhysicaAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_add->RightColumnClass ?>"><div <?php echo $contractor_add->PhysicaAddress->cellAttributes() ?>>
<span id="el_contractor_PhysicaAddress">
<textarea data-table="contractor" data-field="x_PhysicaAddress" name="x_PhysicaAddress" id="x_PhysicaAddress" cols="35" rows="2" placeholder="<?php echo HtmlEncode($contractor_add->PhysicaAddress->getPlaceHolder()) ?>"<?php echo $contractor_add->PhysicaAddress->editAttributes() ?>><?php echo $contractor_add->PhysicaAddress->EditValue ?></textarea>
</span>
<?php echo $contractor_add->PhysicaAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_add->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_contractor__Email" for="x__Email" class="<?php echo $contractor_add->LeftColumnClass ?>"><?php echo $contractor_add->_Email->caption() ?><?php echo $contractor_add->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_add->RightColumnClass ?>"><div <?php echo $contractor_add->_Email->cellAttributes() ?>>
<span id="el_contractor__Email">
<input type="text" data-table="contractor" data-field="x__Email" name="x__Email" id="x__Email" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($contractor_add->_Email->getPlaceHolder()) ?>" value="<?php echo $contractor_add->_Email->EditValue ?>"<?php echo $contractor_add->_Email->editAttributes() ?>>
</span>
<?php echo $contractor_add->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_add->Telephone->Visible) { // Telephone ?>
	<div id="r_Telephone" class="form-group row">
		<label id="elh_contractor_Telephone" for="x_Telephone" class="<?php echo $contractor_add->LeftColumnClass ?>"><?php echo $contractor_add->Telephone->caption() ?><?php echo $contractor_add->Telephone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_add->RightColumnClass ?>"><div <?php echo $contractor_add->Telephone->cellAttributes() ?>>
<span id="el_contractor_Telephone">
<input type="text" data-table="contractor" data-field="x_Telephone" name="x_Telephone" id="x_Telephone" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($contractor_add->Telephone->getPlaceHolder()) ?>" value="<?php echo $contractor_add->Telephone->EditValue ?>"<?php echo $contractor_add->Telephone->editAttributes() ?>>
</span>
<?php echo $contractor_add->Telephone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_add->Mobile->Visible) { // Mobile ?>
	<div id="r_Mobile" class="form-group row">
		<label id="elh_contractor_Mobile" for="x_Mobile" class="<?php echo $contractor_add->LeftColumnClass ?>"><?php echo $contractor_add->Mobile->caption() ?><?php echo $contractor_add->Mobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_add->RightColumnClass ?>"><div <?php echo $contractor_add->Mobile->cellAttributes() ?>>
<span id="el_contractor_Mobile">
<input type="text" data-table="contractor" data-field="x_Mobile" name="x_Mobile" id="x_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contractor_add->Mobile->getPlaceHolder()) ?>" value="<?php echo $contractor_add->Mobile->EditValue ?>"<?php echo $contractor_add->Mobile->editAttributes() ?>>
</span>
<?php echo $contractor_add->Mobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_add->Fax->Visible) { // Fax ?>
	<div id="r_Fax" class="form-group row">
		<label id="elh_contractor_Fax" for="x_Fax" class="<?php echo $contractor_add->LeftColumnClass ?>"><?php echo $contractor_add->Fax->caption() ?><?php echo $contractor_add->Fax->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_add->RightColumnClass ?>"><div <?php echo $contractor_add->Fax->cellAttributes() ?>>
<span id="el_contractor_Fax">
<input type="text" data-table="contractor" data-field="x_Fax" name="x_Fax" id="x_Fax" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($contractor_add->Fax->getPlaceHolder()) ?>" value="<?php echo $contractor_add->Fax->EditValue ?>"<?php echo $contractor_add->Fax->editAttributes() ?>>
</span>
<?php echo $contractor_add->Fax->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_add->Country->Visible) { // Country ?>
	<div id="r_Country" class="form-group row">
		<label id="elh_contractor_Country" class="<?php echo $contractor_add->LeftColumnClass ?>"><?php echo $contractor_add->Country->caption() ?><?php echo $contractor_add->Country->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_add->RightColumnClass ?>"><div <?php echo $contractor_add->Country->cellAttributes() ?>>
<span id="el_contractor_Country">
<?php
$onchange = $contractor_add->Country->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$contractor_add->Country->EditAttrs["onchange"] = "";
?>
<span id="as_x_Country">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_Country" id="sv_x_Country" value="<?php echo RemoveHtml($contractor_add->Country->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($contractor_add->Country->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($contractor_add->Country->getPlaceHolder()) ?>"<?php echo $contractor_add->Country->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contractor_add->Country->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_Country',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($contractor_add->Country->ReadOnly || $contractor_add->Country->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="contractor" data-field="x_Country" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contractor_add->Country->displayValueSeparatorAttribute() ?>" name="x_Country" id="x_Country" value="<?php echo HtmlEncode($contractor_add->Country->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcontractoradd"], function() {
	fcontractoradd.createAutoSuggest({"id":"x_Country","forceSelect":false});
});
</script>
<?php echo $contractor_add->Country->Lookup->getParamTag($contractor_add, "p_x_Country") ?>
</span>
<?php echo $contractor_add->Country->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_add->ContactPerson->Visible) { // ContactPerson ?>
	<div id="r_ContactPerson" class="form-group row">
		<label id="elh_contractor_ContactPerson" for="x_ContactPerson" class="<?php echo $contractor_add->LeftColumnClass ?>"><?php echo $contractor_add->ContactPerson->caption() ?><?php echo $contractor_add->ContactPerson->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_add->RightColumnClass ?>"><div <?php echo $contractor_add->ContactPerson->cellAttributes() ?>>
<span id="el_contractor_ContactPerson">
<input type="text" data-table="contractor" data-field="x_ContactPerson" name="x_ContactPerson" id="x_ContactPerson" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contractor_add->ContactPerson->getPlaceHolder()) ?>" value="<?php echo $contractor_add->ContactPerson->EditValue ?>"<?php echo $contractor_add->ContactPerson->editAttributes() ?>>
</span>
<?php echo $contractor_add->ContactPerson->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$contractor_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $contractor_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contractor_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$contractor_add->showPageFooter();
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
$contractor_add->terminate();
?>