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
$contractor_edit = new contractor_edit();

// Run the page
$contractor_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contractor_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcontractoredit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcontractoredit = currentForm = new ew.Form("fcontractoredit", "edit");

	// Validate form
	fcontractoredit.validate = function() {
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
			<?php if ($contractor_edit->ContractorRef->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractorRef");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_edit->ContractorRef->caption(), $contractor_edit->ContractorRef->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_edit->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_edit->ProvinceCode->caption(), $contractor_edit->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contractor_edit->ProvinceCode->errorMessage()) ?>");
			<?php if ($contractor_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_edit->LACode->caption(), $contractor_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_edit->ContractorName->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractorName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_edit->ContractorName->caption(), $contractor_edit->ContractorName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_edit->TradingName->Required) { ?>
				elm = this.getElements("x" + infix + "_TradingName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_edit->TradingName->caption(), $contractor_edit->TradingName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_edit->ZambianContrator->Required) { ?>
				elm = this.getElements("x" + infix + "_ZambianContrator[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_edit->ZambianContrator->caption(), $contractor_edit->ZambianContrator->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_edit->ContractorType->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractorType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_edit->ContractorType->caption(), $contractor_edit->ContractorType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_edit->BusinessType->Required) { ?>
				elm = this.getElements("x" + infix + "_BusinessType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_edit->BusinessType->caption(), $contractor_edit->BusinessType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_edit->BusinessSector->Required) { ?>
				elm = this.getElements("x" + infix + "_BusinessSector");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_edit->BusinessSector->caption(), $contractor_edit->BusinessSector->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_edit->BusinessDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_BusinessDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_edit->BusinessDesc->caption(), $contractor_edit->BusinessDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_edit->PostalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PostalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_edit->PostalAddress->caption(), $contractor_edit->PostalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_edit->Town->Required) { ?>
				elm = this.getElements("x" + infix + "_Town");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_edit->Town->caption(), $contractor_edit->Town->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_edit->PhysicaAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PhysicaAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_edit->PhysicaAddress->caption(), $contractor_edit->PhysicaAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_edit->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_edit->_Email->caption(), $contractor_edit->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_edit->Telephone->Required) { ?>
				elm = this.getElements("x" + infix + "_Telephone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_edit->Telephone->caption(), $contractor_edit->Telephone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_edit->Mobile->Required) { ?>
				elm = this.getElements("x" + infix + "_Mobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_edit->Mobile->caption(), $contractor_edit->Mobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_edit->Fax->Required) { ?>
				elm = this.getElements("x" + infix + "_Fax");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_edit->Fax->caption(), $contractor_edit->Fax->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_edit->Country->Required) { ?>
				elm = this.getElements("x" + infix + "_Country");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_edit->Country->caption(), $contractor_edit->Country->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_edit->ContactPerson->Required) { ?>
				elm = this.getElements("x" + infix + "_ContactPerson");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_edit->ContactPerson->caption(), $contractor_edit->ContactPerson->RequiredErrorMessage)) ?>");
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
	fcontractoredit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcontractoredit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcontractoredit.lists["x_ProvinceCode"] = <?php echo $contractor_edit->ProvinceCode->Lookup->toClientList($contractor_edit) ?>;
	fcontractoredit.lists["x_ProvinceCode"].options = <?php echo JsonEncode($contractor_edit->ProvinceCode->lookupOptions()) ?>;
	fcontractoredit.autoSuggests["x_ProvinceCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcontractoredit.lists["x_LACode"] = <?php echo $contractor_edit->LACode->Lookup->toClientList($contractor_edit) ?>;
	fcontractoredit.lists["x_LACode"].options = <?php echo JsonEncode($contractor_edit->LACode->lookupOptions()) ?>;
	fcontractoredit.lists["x_ZambianContrator[]"] = <?php echo $contractor_edit->ZambianContrator->Lookup->toClientList($contractor_edit) ?>;
	fcontractoredit.lists["x_ZambianContrator[]"].options = <?php echo JsonEncode($contractor_edit->ZambianContrator->options(FALSE, TRUE)) ?>;
	fcontractoredit.lists["x_ContractorType"] = <?php echo $contractor_edit->ContractorType->Lookup->toClientList($contractor_edit) ?>;
	fcontractoredit.lists["x_ContractorType"].options = <?php echo JsonEncode($contractor_edit->ContractorType->lookupOptions()) ?>;
	fcontractoredit.lists["x_BusinessType"] = <?php echo $contractor_edit->BusinessType->Lookup->toClientList($contractor_edit) ?>;
	fcontractoredit.lists["x_BusinessType"].options = <?php echo JsonEncode($contractor_edit->BusinessType->lookupOptions()) ?>;
	fcontractoredit.lists["x_BusinessSector"] = <?php echo $contractor_edit->BusinessSector->Lookup->toClientList($contractor_edit) ?>;
	fcontractoredit.lists["x_BusinessSector"].options = <?php echo JsonEncode($contractor_edit->BusinessSector->lookupOptions()) ?>;
	fcontractoredit.lists["x_Country"] = <?php echo $contractor_edit->Country->Lookup->toClientList($contractor_edit) ?>;
	fcontractoredit.lists["x_Country"].options = <?php echo JsonEncode($contractor_edit->Country->lookupOptions()) ?>;
	fcontractoredit.autoSuggests["x_Country"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fcontractoredit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $contractor_edit->showPageHeader(); ?>
<?php
$contractor_edit->showMessage();
?>
<?php if (!$contractor_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contractor_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcontractoredit" id="fcontractoredit" class="<?php echo $contractor_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contractor">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$contractor_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($contractor_edit->ContractorRef->Visible) { // ContractorRef ?>
	<div id="r_ContractorRef" class="form-group row">
		<label id="elh_contractor_ContractorRef" class="<?php echo $contractor_edit->LeftColumnClass ?>"><?php echo $contractor_edit->ContractorRef->caption() ?><?php echo $contractor_edit->ContractorRef->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_edit->RightColumnClass ?>"><div <?php echo $contractor_edit->ContractorRef->cellAttributes() ?>>
<span id="el_contractor_ContractorRef">
<span<?php echo $contractor_edit->ContractorRef->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contractor_edit->ContractorRef->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="contractor" data-field="x_ContractorRef" name="x_ContractorRef" id="x_ContractorRef" value="<?php echo HtmlEncode($contractor_edit->ContractorRef->CurrentValue) ?>">
<?php echo $contractor_edit->ContractorRef->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_edit->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_contractor_ProvinceCode" class="<?php echo $contractor_edit->LeftColumnClass ?>"><?php echo $contractor_edit->ProvinceCode->caption() ?><?php echo $contractor_edit->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_edit->RightColumnClass ?>"><div <?php echo $contractor_edit->ProvinceCode->cellAttributes() ?>>
<span id="el_contractor_ProvinceCode">
<?php
$onchange = $contractor_edit->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$contractor_edit->ProvinceCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProvinceCode">
	<input type="text" class="form-control" name="sv_x_ProvinceCode" id="sv_x_ProvinceCode" value="<?php echo RemoveHtml($contractor_edit->ProvinceCode->EditValue) ?>" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($contractor_edit->ProvinceCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($contractor_edit->ProvinceCode->getPlaceHolder()) ?>"<?php echo $contractor_edit->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="contractor" data-field="x_ProvinceCode" data-value-separator="<?php echo $contractor_edit->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x_ProvinceCode" id="x_ProvinceCode" value="<?php echo HtmlEncode($contractor_edit->ProvinceCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcontractoredit"], function() {
	fcontractoredit.createAutoSuggest({"id":"x_ProvinceCode","forceSelect":false});
});
</script>
<?php echo $contractor_edit->ProvinceCode->Lookup->getParamTag($contractor_edit, "p_x_ProvinceCode") ?>
</span>
<?php echo $contractor_edit->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_contractor_LACode" for="x_LACode" class="<?php echo $contractor_edit->LeftColumnClass ?>"><?php echo $contractor_edit->LACode->caption() ?><?php echo $contractor_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_edit->RightColumnClass ?>"><div <?php echo $contractor_edit->LACode->cellAttributes() ?>>
<span id="el_contractor_LACode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($contractor_edit->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $contractor_edit->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contractor_edit->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($contractor_edit->LACode->ReadOnly || $contractor_edit->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $contractor_edit->LACode->Lookup->getParamTag($contractor_edit, "p_x_LACode") ?>
<input type="hidden" data-table="contractor" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contractor_edit->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $contractor_edit->LACode->CurrentValue ?>"<?php echo $contractor_edit->LACode->editAttributes() ?>>
</span>
<?php echo $contractor_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_edit->ContractorName->Visible) { // ContractorName ?>
	<div id="r_ContractorName" class="form-group row">
		<label id="elh_contractor_ContractorName" for="x_ContractorName" class="<?php echo $contractor_edit->LeftColumnClass ?>"><?php echo $contractor_edit->ContractorName->caption() ?><?php echo $contractor_edit->ContractorName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_edit->RightColumnClass ?>"><div <?php echo $contractor_edit->ContractorName->cellAttributes() ?>>
<span id="el_contractor_ContractorName">
<input type="text" data-table="contractor" data-field="x_ContractorName" name="x_ContractorName" id="x_ContractorName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($contractor_edit->ContractorName->getPlaceHolder()) ?>" value="<?php echo $contractor_edit->ContractorName->EditValue ?>"<?php echo $contractor_edit->ContractorName->editAttributes() ?>>
</span>
<?php echo $contractor_edit->ContractorName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_edit->TradingName->Visible) { // TradingName ?>
	<div id="r_TradingName" class="form-group row">
		<label id="elh_contractor_TradingName" for="x_TradingName" class="<?php echo $contractor_edit->LeftColumnClass ?>"><?php echo $contractor_edit->TradingName->caption() ?><?php echo $contractor_edit->TradingName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_edit->RightColumnClass ?>"><div <?php echo $contractor_edit->TradingName->cellAttributes() ?>>
<span id="el_contractor_TradingName">
<input type="text" data-table="contractor" data-field="x_TradingName" name="x_TradingName" id="x_TradingName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($contractor_edit->TradingName->getPlaceHolder()) ?>" value="<?php echo $contractor_edit->TradingName->EditValue ?>"<?php echo $contractor_edit->TradingName->editAttributes() ?>>
</span>
<?php echo $contractor_edit->TradingName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_edit->ZambianContrator->Visible) { // ZambianContrator ?>
	<div id="r_ZambianContrator" class="form-group row">
		<label id="elh_contractor_ZambianContrator" class="<?php echo $contractor_edit->LeftColumnClass ?>"><?php echo $contractor_edit->ZambianContrator->caption() ?><?php echo $contractor_edit->ZambianContrator->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_edit->RightColumnClass ?>"><div <?php echo $contractor_edit->ZambianContrator->cellAttributes() ?>>
<span id="el_contractor_ZambianContrator">
<?php
$selwrk = ConvertToBool($contractor_edit->ZambianContrator->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="contractor" data-field="x_ZambianContrator" name="x_ZambianContrator[]" id="x_ZambianContrator[]_959885" value="1"<?php echo $selwrk ?><?php echo $contractor_edit->ZambianContrator->editAttributes() ?>>
	<label class="custom-control-label" for="x_ZambianContrator[]_959885"></label>
</div>
</span>
<?php echo $contractor_edit->ZambianContrator->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_edit->ContractorType->Visible) { // ContractorType ?>
	<div id="r_ContractorType" class="form-group row">
		<label id="elh_contractor_ContractorType" for="x_ContractorType" class="<?php echo $contractor_edit->LeftColumnClass ?>"><?php echo $contractor_edit->ContractorType->caption() ?><?php echo $contractor_edit->ContractorType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_edit->RightColumnClass ?>"><div <?php echo $contractor_edit->ContractorType->cellAttributes() ?>>
<span id="el_contractor_ContractorType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contractor" data-field="x_ContractorType" data-value-separator="<?php echo $contractor_edit->ContractorType->displayValueSeparatorAttribute() ?>" id="x_ContractorType" name="x_ContractorType"<?php echo $contractor_edit->ContractorType->editAttributes() ?>>
			<?php echo $contractor_edit->ContractorType->selectOptionListHtml("x_ContractorType") ?>
		</select>
</div>
<?php echo $contractor_edit->ContractorType->Lookup->getParamTag($contractor_edit, "p_x_ContractorType") ?>
</span>
<?php echo $contractor_edit->ContractorType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_edit->BusinessType->Visible) { // BusinessType ?>
	<div id="r_BusinessType" class="form-group row">
		<label id="elh_contractor_BusinessType" for="x_BusinessType" class="<?php echo $contractor_edit->LeftColumnClass ?>"><?php echo $contractor_edit->BusinessType->caption() ?><?php echo $contractor_edit->BusinessType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_edit->RightColumnClass ?>"><div <?php echo $contractor_edit->BusinessType->cellAttributes() ?>>
<span id="el_contractor_BusinessType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contractor" data-field="x_BusinessType" data-value-separator="<?php echo $contractor_edit->BusinessType->displayValueSeparatorAttribute() ?>" id="x_BusinessType" name="x_BusinessType"<?php echo $contractor_edit->BusinessType->editAttributes() ?>>
			<?php echo $contractor_edit->BusinessType->selectOptionListHtml("x_BusinessType") ?>
		</select>
</div>
<?php echo $contractor_edit->BusinessType->Lookup->getParamTag($contractor_edit, "p_x_BusinessType") ?>
</span>
<?php echo $contractor_edit->BusinessType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_edit->BusinessSector->Visible) { // BusinessSector ?>
	<div id="r_BusinessSector" class="form-group row">
		<label id="elh_contractor_BusinessSector" for="x_BusinessSector" class="<?php echo $contractor_edit->LeftColumnClass ?>"><?php echo $contractor_edit->BusinessSector->caption() ?><?php echo $contractor_edit->BusinessSector->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_edit->RightColumnClass ?>"><div <?php echo $contractor_edit->BusinessSector->cellAttributes() ?>>
<span id="el_contractor_BusinessSector">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contractor" data-field="x_BusinessSector" data-value-separator="<?php echo $contractor_edit->BusinessSector->displayValueSeparatorAttribute() ?>" id="x_BusinessSector" name="x_BusinessSector"<?php echo $contractor_edit->BusinessSector->editAttributes() ?>>
			<?php echo $contractor_edit->BusinessSector->selectOptionListHtml("x_BusinessSector") ?>
		</select>
</div>
<?php echo $contractor_edit->BusinessSector->Lookup->getParamTag($contractor_edit, "p_x_BusinessSector") ?>
</span>
<?php echo $contractor_edit->BusinessSector->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_edit->BusinessDesc->Visible) { // BusinessDesc ?>
	<div id="r_BusinessDesc" class="form-group row">
		<label id="elh_contractor_BusinessDesc" for="x_BusinessDesc" class="<?php echo $contractor_edit->LeftColumnClass ?>"><?php echo $contractor_edit->BusinessDesc->caption() ?><?php echo $contractor_edit->BusinessDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_edit->RightColumnClass ?>"><div <?php echo $contractor_edit->BusinessDesc->cellAttributes() ?>>
<span id="el_contractor_BusinessDesc">
<textarea data-table="contractor" data-field="x_BusinessDesc" name="x_BusinessDesc" id="x_BusinessDesc" cols="35" rows="2" placeholder="<?php echo HtmlEncode($contractor_edit->BusinessDesc->getPlaceHolder()) ?>"<?php echo $contractor_edit->BusinessDesc->editAttributes() ?>><?php echo $contractor_edit->BusinessDesc->EditValue ?></textarea>
</span>
<?php echo $contractor_edit->BusinessDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_edit->PostalAddress->Visible) { // PostalAddress ?>
	<div id="r_PostalAddress" class="form-group row">
		<label id="elh_contractor_PostalAddress" for="x_PostalAddress" class="<?php echo $contractor_edit->LeftColumnClass ?>"><?php echo $contractor_edit->PostalAddress->caption() ?><?php echo $contractor_edit->PostalAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_edit->RightColumnClass ?>"><div <?php echo $contractor_edit->PostalAddress->cellAttributes() ?>>
<span id="el_contractor_PostalAddress">
<textarea data-table="contractor" data-field="x_PostalAddress" name="x_PostalAddress" id="x_PostalAddress" cols="35" rows="2" placeholder="<?php echo HtmlEncode($contractor_edit->PostalAddress->getPlaceHolder()) ?>"<?php echo $contractor_edit->PostalAddress->editAttributes() ?>><?php echo $contractor_edit->PostalAddress->EditValue ?></textarea>
</span>
<?php echo $contractor_edit->PostalAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_edit->Town->Visible) { // Town ?>
	<div id="r_Town" class="form-group row">
		<label id="elh_contractor_Town" for="x_Town" class="<?php echo $contractor_edit->LeftColumnClass ?>"><?php echo $contractor_edit->Town->caption() ?><?php echo $contractor_edit->Town->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_edit->RightColumnClass ?>"><div <?php echo $contractor_edit->Town->cellAttributes() ?>>
<span id="el_contractor_Town">
<input type="text" data-table="contractor" data-field="x_Town" name="x_Town" id="x_Town" size="30" maxlength="70" placeholder="<?php echo HtmlEncode($contractor_edit->Town->getPlaceHolder()) ?>" value="<?php echo $contractor_edit->Town->EditValue ?>"<?php echo $contractor_edit->Town->editAttributes() ?>>
</span>
<?php echo $contractor_edit->Town->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_edit->PhysicaAddress->Visible) { // PhysicaAddress ?>
	<div id="r_PhysicaAddress" class="form-group row">
		<label id="elh_contractor_PhysicaAddress" for="x_PhysicaAddress" class="<?php echo $contractor_edit->LeftColumnClass ?>"><?php echo $contractor_edit->PhysicaAddress->caption() ?><?php echo $contractor_edit->PhysicaAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_edit->RightColumnClass ?>"><div <?php echo $contractor_edit->PhysicaAddress->cellAttributes() ?>>
<span id="el_contractor_PhysicaAddress">
<textarea data-table="contractor" data-field="x_PhysicaAddress" name="x_PhysicaAddress" id="x_PhysicaAddress" cols="35" rows="2" placeholder="<?php echo HtmlEncode($contractor_edit->PhysicaAddress->getPlaceHolder()) ?>"<?php echo $contractor_edit->PhysicaAddress->editAttributes() ?>><?php echo $contractor_edit->PhysicaAddress->EditValue ?></textarea>
</span>
<?php echo $contractor_edit->PhysicaAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_edit->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_contractor__Email" for="x__Email" class="<?php echo $contractor_edit->LeftColumnClass ?>"><?php echo $contractor_edit->_Email->caption() ?><?php echo $contractor_edit->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_edit->RightColumnClass ?>"><div <?php echo $contractor_edit->_Email->cellAttributes() ?>>
<span id="el_contractor__Email">
<input type="text" data-table="contractor" data-field="x__Email" name="x__Email" id="x__Email" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($contractor_edit->_Email->getPlaceHolder()) ?>" value="<?php echo $contractor_edit->_Email->EditValue ?>"<?php echo $contractor_edit->_Email->editAttributes() ?>>
</span>
<?php echo $contractor_edit->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_edit->Telephone->Visible) { // Telephone ?>
	<div id="r_Telephone" class="form-group row">
		<label id="elh_contractor_Telephone" for="x_Telephone" class="<?php echo $contractor_edit->LeftColumnClass ?>"><?php echo $contractor_edit->Telephone->caption() ?><?php echo $contractor_edit->Telephone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_edit->RightColumnClass ?>"><div <?php echo $contractor_edit->Telephone->cellAttributes() ?>>
<span id="el_contractor_Telephone">
<input type="text" data-table="contractor" data-field="x_Telephone" name="x_Telephone" id="x_Telephone" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($contractor_edit->Telephone->getPlaceHolder()) ?>" value="<?php echo $contractor_edit->Telephone->EditValue ?>"<?php echo $contractor_edit->Telephone->editAttributes() ?>>
</span>
<?php echo $contractor_edit->Telephone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_edit->Mobile->Visible) { // Mobile ?>
	<div id="r_Mobile" class="form-group row">
		<label id="elh_contractor_Mobile" for="x_Mobile" class="<?php echo $contractor_edit->LeftColumnClass ?>"><?php echo $contractor_edit->Mobile->caption() ?><?php echo $contractor_edit->Mobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_edit->RightColumnClass ?>"><div <?php echo $contractor_edit->Mobile->cellAttributes() ?>>
<span id="el_contractor_Mobile">
<input type="text" data-table="contractor" data-field="x_Mobile" name="x_Mobile" id="x_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contractor_edit->Mobile->getPlaceHolder()) ?>" value="<?php echo $contractor_edit->Mobile->EditValue ?>"<?php echo $contractor_edit->Mobile->editAttributes() ?>>
</span>
<?php echo $contractor_edit->Mobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_edit->Fax->Visible) { // Fax ?>
	<div id="r_Fax" class="form-group row">
		<label id="elh_contractor_Fax" for="x_Fax" class="<?php echo $contractor_edit->LeftColumnClass ?>"><?php echo $contractor_edit->Fax->caption() ?><?php echo $contractor_edit->Fax->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_edit->RightColumnClass ?>"><div <?php echo $contractor_edit->Fax->cellAttributes() ?>>
<span id="el_contractor_Fax">
<input type="text" data-table="contractor" data-field="x_Fax" name="x_Fax" id="x_Fax" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($contractor_edit->Fax->getPlaceHolder()) ?>" value="<?php echo $contractor_edit->Fax->EditValue ?>"<?php echo $contractor_edit->Fax->editAttributes() ?>>
</span>
<?php echo $contractor_edit->Fax->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_edit->Country->Visible) { // Country ?>
	<div id="r_Country" class="form-group row">
		<label id="elh_contractor_Country" class="<?php echo $contractor_edit->LeftColumnClass ?>"><?php echo $contractor_edit->Country->caption() ?><?php echo $contractor_edit->Country->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_edit->RightColumnClass ?>"><div <?php echo $contractor_edit->Country->cellAttributes() ?>>
<span id="el_contractor_Country">
<?php
$onchange = $contractor_edit->Country->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$contractor_edit->Country->EditAttrs["onchange"] = "";
?>
<span id="as_x_Country">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_Country" id="sv_x_Country" value="<?php echo RemoveHtml($contractor_edit->Country->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($contractor_edit->Country->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($contractor_edit->Country->getPlaceHolder()) ?>"<?php echo $contractor_edit->Country->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contractor_edit->Country->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_Country',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($contractor_edit->Country->ReadOnly || $contractor_edit->Country->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="contractor" data-field="x_Country" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contractor_edit->Country->displayValueSeparatorAttribute() ?>" name="x_Country" id="x_Country" value="<?php echo HtmlEncode($contractor_edit->Country->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcontractoredit"], function() {
	fcontractoredit.createAutoSuggest({"id":"x_Country","forceSelect":false});
});
</script>
<?php echo $contractor_edit->Country->Lookup->getParamTag($contractor_edit, "p_x_Country") ?>
</span>
<?php echo $contractor_edit->Country->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_edit->ContactPerson->Visible) { // ContactPerson ?>
	<div id="r_ContactPerson" class="form-group row">
		<label id="elh_contractor_ContactPerson" for="x_ContactPerson" class="<?php echo $contractor_edit->LeftColumnClass ?>"><?php echo $contractor_edit->ContactPerson->caption() ?><?php echo $contractor_edit->ContactPerson->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_edit->RightColumnClass ?>"><div <?php echo $contractor_edit->ContactPerson->cellAttributes() ?>>
<span id="el_contractor_ContactPerson">
<input type="text" data-table="contractor" data-field="x_ContactPerson" name="x_ContactPerson" id="x_ContactPerson" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contractor_edit->ContactPerson->getPlaceHolder()) ?>" value="<?php echo $contractor_edit->ContactPerson->EditValue ?>"<?php echo $contractor_edit->ContactPerson->editAttributes() ?>>
</span>
<?php echo $contractor_edit->ContactPerson->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$contractor_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $contractor_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contractor_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$contractor_edit->IsModal) { ?>
<?php echo $contractor_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$contractor_edit->showPageFooter();
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
$contractor_edit->terminate();
?>