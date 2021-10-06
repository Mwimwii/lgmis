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
$property_search = new property_search();

// Run the page
$property_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpropertysearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($property_search->IsModal) { ?>
	fpropertysearch = currentAdvancedSearchForm = new ew.Form("fpropertysearch", "search");
	<?php } else { ?>
	fpropertysearch = currentForm = new ew.Form("fpropertysearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fpropertysearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ClientSerNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_search->ClientSerNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PropertyType");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_search->PropertyType->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PropertyStatus");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_search->PropertyStatus->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_LandExtentInHA");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_search->LandExtentInHA->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_RateableValue");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_search->RateableValue->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_SupplementaryValue");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_search->SupplementaryValue->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ExemptCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_search->ExemptCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Longitude");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_search->Longitude->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Latitude");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_search->Latitude->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_SubDivisionOf");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_search->SubDivisionOf->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_LastUpdateDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_search->LastUpdateDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ValuationNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_search->ValuationNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_LandValue");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_search->LandValue->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ImprovementsValue");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_search->ImprovementsValue->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fpropertysearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpropertysearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpropertysearch.lists["x_ClientSerNo"] = <?php echo $property_search->ClientSerNo->Lookup->toClientList($property_search) ?>;
	fpropertysearch.lists["x_ClientSerNo"].options = <?php echo JsonEncode($property_search->ClientSerNo->lookupOptions()) ?>;
	fpropertysearch.autoSuggests["x_ClientSerNo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpropertysearch.lists["x_ClientID"] = <?php echo $property_search->ClientID->Lookup->toClientList($property_search) ?>;
	fpropertysearch.lists["x_ClientID"].options = <?php echo JsonEncode($property_search->ClientID->lookupOptions()) ?>;
	fpropertysearch.autoSuggests["x_ClientID"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpropertysearch.lists["x_PropertyGroup"] = <?php echo $property_search->PropertyGroup->Lookup->toClientList($property_search) ?>;
	fpropertysearch.lists["x_PropertyGroup"].options = <?php echo JsonEncode($property_search->PropertyGroup->lookupOptions()) ?>;
	fpropertysearch.lists["x_PropertyType"] = <?php echo $property_search->PropertyType->Lookup->toClientList($property_search) ?>;
	fpropertysearch.lists["x_PropertyType"].options = <?php echo JsonEncode($property_search->PropertyType->lookupOptions()) ?>;
	fpropertysearch.autoSuggests["x_PropertyType"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpropertysearch.lists["x_Location[]"] = <?php echo $property_search->Location->Lookup->toClientList($property_search) ?>;
	fpropertysearch.lists["x_Location[]"].options = <?php echo JsonEncode($property_search->Location->lookupOptions()) ?>;
	fpropertysearch.lists["x_PropertyUse[]"] = <?php echo $property_search->PropertyUse->Lookup->toClientList($property_search) ?>;
	fpropertysearch.lists["x_PropertyUse[]"].options = <?php echo JsonEncode($property_search->PropertyUse->lookupOptions()) ?>;
	loadjs.done("fpropertysearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $property_search->showPageHeader(); ?>
<?php
$property_search->showMessage();
?>
<form name="fpropertysearch" id="fpropertysearch" class="<?php echo $property_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$property_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($property_search->PropertyNo->Visible) { // PropertyNo ?>
	<div id="r_PropertyNo" class="form-group row">
		<label for="x_PropertyNo" class="<?php echo $property_search->LeftColumnClass ?>"><span id="elh_property_PropertyNo"><?php echo $property_search->PropertyNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PropertyNo" id="z_PropertyNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $property_search->RightColumnClass ?>"><div <?php echo $property_search->PropertyNo->cellAttributes() ?>>
			<span id="el_property_PropertyNo" class="ew-search-field">
<input type="text" data-table="property" data-field="x_PropertyNo" name="x_PropertyNo" id="x_PropertyNo" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($property_search->PropertyNo->getPlaceHolder()) ?>" value="<?php echo $property_search->PropertyNo->EditValue ?>"<?php echo $property_search->PropertyNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_search->ClientSerNo->Visible) { // ClientSerNo ?>
	<div id="r_ClientSerNo" class="form-group row">
		<label class="<?php echo $property_search->LeftColumnClass ?>"><span id="elh_property_ClientSerNo"><?php echo $property_search->ClientSerNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ClientSerNo" id="z_ClientSerNo" value="=">
</span>
		</label>
		<div class="<?php echo $property_search->RightColumnClass ?>"><div <?php echo $property_search->ClientSerNo->cellAttributes() ?>>
			<span id="el_property_ClientSerNo" class="ew-search-field">
<?php
$onchange = $property_search->ClientSerNo->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_search->ClientSerNo->EditAttrs["onchange"] = "";
?>
<span id="as_x_ClientSerNo">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ClientSerNo" id="sv_x_ClientSerNo" value="<?php echo RemoveHtml($property_search->ClientSerNo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($property_search->ClientSerNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_search->ClientSerNo->getPlaceHolder()) ?>"<?php echo $property_search->ClientSerNo->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_search->ClientSerNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ClientSerNo',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($property_search->ClientSerNo->ReadOnly || $property_search->ClientSerNo->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property" data-field="x_ClientSerNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_search->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x_ClientSerNo" id="x_ClientSerNo" value="<?php echo HtmlEncode($property_search->ClientSerNo->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpropertysearch"], function() {
	fpropertysearch.createAutoSuggest({"id":"x_ClientSerNo","forceSelect":true});
});
</script>
<?php echo $property_search->ClientSerNo->Lookup->getParamTag($property_search, "p_x_ClientSerNo") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_search->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label class="<?php echo $property_search->LeftColumnClass ?>"><span id="elh_property_ClientID"><?php echo $property_search->ClientID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ClientID" id="z_ClientID" value="LIKE">
</span>
		</label>
		<div class="<?php echo $property_search->RightColumnClass ?>"><div <?php echo $property_search->ClientID->cellAttributes() ?>>
			<span id="el_property_ClientID" class="ew-search-field">
<?php
$onchange = $property_search->ClientID->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_search->ClientID->EditAttrs["onchange"] = "";
?>
<span id="as_x_ClientID">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ClientID" id="sv_x_ClientID" value="<?php echo RemoveHtml($property_search->ClientID->EditValue) ?>" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($property_search->ClientID->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_search->ClientID->getPlaceHolder()) ?>"<?php echo $property_search->ClientID->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_search->ClientID->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ClientID',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($property_search->ClientID->ReadOnly || $property_search->ClientID->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property" data-field="x_ClientID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_search->ClientID->displayValueSeparatorAttribute() ?>" name="x_ClientID" id="x_ClientID" value="<?php echo HtmlEncode($property_search->ClientID->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpropertysearch"], function() {
	fpropertysearch.createAutoSuggest({"id":"x_ClientID","forceSelect":false});
});
</script>
<?php echo $property_search->ClientID->Lookup->getParamTag($property_search, "p_x_ClientID") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_search->PropertyGroup->Visible) { // PropertyGroup ?>
	<div id="r_PropertyGroup" class="form-group row">
		<label for="x_PropertyGroup" class="<?php echo $property_search->LeftColumnClass ?>"><span id="elh_property_PropertyGroup"><?php echo $property_search->PropertyGroup->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PropertyGroup" id="z_PropertyGroup" value="=">
</span>
		</label>
		<div class="<?php echo $property_search->RightColumnClass ?>"><div <?php echo $property_search->PropertyGroup->cellAttributes() ?>>
			<span id="el_property_PropertyGroup" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="property" data-field="x_PropertyGroup" data-value-separator="<?php echo $property_search->PropertyGroup->displayValueSeparatorAttribute() ?>" id="x_PropertyGroup" name="x_PropertyGroup"<?php echo $property_search->PropertyGroup->editAttributes() ?>>
			<?php echo $property_search->PropertyGroup->selectOptionListHtml("x_PropertyGroup") ?>
		</select>
</div>
<?php echo $property_search->PropertyGroup->Lookup->getParamTag($property_search, "p_x_PropertyGroup") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_search->PropertyType->Visible) { // PropertyType ?>
	<div id="r_PropertyType" class="form-group row">
		<label class="<?php echo $property_search->LeftColumnClass ?>"><span id="elh_property_PropertyType"><?php echo $property_search->PropertyType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PropertyType" id="z_PropertyType" value="=">
</span>
		</label>
		<div class="<?php echo $property_search->RightColumnClass ?>"><div <?php echo $property_search->PropertyType->cellAttributes() ?>>
			<span id="el_property_PropertyType" class="ew-search-field">
<?php
$onchange = $property_search->PropertyType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_search->PropertyType->EditAttrs["onchange"] = "";
?>
<span id="as_x_PropertyType">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_PropertyType" id="sv_x_PropertyType" value="<?php echo RemoveHtml($property_search->PropertyType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($property_search->PropertyType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_search->PropertyType->getPlaceHolder()) ?>"<?php echo $property_search->PropertyType->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_search->PropertyType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_PropertyType',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($property_search->PropertyType->ReadOnly || $property_search->PropertyType->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property" data-field="x_PropertyType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_search->PropertyType->displayValueSeparatorAttribute() ?>" name="x_PropertyType" id="x_PropertyType" value="<?php echo HtmlEncode($property_search->PropertyType->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpropertysearch"], function() {
	fpropertysearch.createAutoSuggest({"id":"x_PropertyType","forceSelect":false});
});
</script>
<?php echo $property_search->PropertyType->Lookup->getParamTag($property_search, "p_x_PropertyType") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_search->Location->Visible) { // Location ?>
	<div id="r_Location" class="form-group row">
		<label class="<?php echo $property_search->LeftColumnClass ?>"><span id="elh_property_Location"><?php echo $property_search->Location->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Location" id="z_Location" value="LIKE">
</span>
		</label>
		<div class="<?php echo $property_search->RightColumnClass ?>"><div <?php echo $property_search->Location->cellAttributes() ?>>
			<span id="el_property_Location" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_Location"><?php echo EmptyValue(strval($property_search->Location->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_search->Location->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_search->Location->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_search->Location->ReadOnly || $property_search->Location->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_Location[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_search->Location->Lookup->getParamTag($property_search, "p_x_Location") ?>
<input type="hidden" data-table="property" data-field="x_Location" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $property_search->Location->displayValueSeparatorAttribute() ?>" name="x_Location[]" id="x_Location[]" value="<?php echo $property_search->Location->AdvancedSearch->SearchValue ?>"<?php echo $property_search->Location->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_search->PropertyStatus->Visible) { // PropertyStatus ?>
	<div id="r_PropertyStatus" class="form-group row">
		<label for="x_PropertyStatus" class="<?php echo $property_search->LeftColumnClass ?>"><span id="elh_property_PropertyStatus"><?php echo $property_search->PropertyStatus->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PropertyStatus" id="z_PropertyStatus" value="=">
</span>
		</label>
		<div class="<?php echo $property_search->RightColumnClass ?>"><div <?php echo $property_search->PropertyStatus->cellAttributes() ?>>
			<span id="el_property_PropertyStatus" class="ew-search-field">
<input type="text" data-table="property" data-field="x_PropertyStatus" name="x_PropertyStatus" id="x_PropertyStatus" size="30" placeholder="<?php echo HtmlEncode($property_search->PropertyStatus->getPlaceHolder()) ?>" value="<?php echo $property_search->PropertyStatus->EditValue ?>"<?php echo $property_search->PropertyStatus->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_search->PropertyUse->Visible) { // PropertyUse ?>
	<div id="r_PropertyUse" class="form-group row">
		<label class="<?php echo $property_search->LeftColumnClass ?>"><span id="elh_property_PropertyUse"><?php echo $property_search->PropertyUse->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PropertyUse" id="z_PropertyUse" value="=">
</span>
		</label>
		<div class="<?php echo $property_search->RightColumnClass ?>"><div <?php echo $property_search->PropertyUse->cellAttributes() ?>>
			<span id="el_property_PropertyUse" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_PropertyUse"><?php echo EmptyValue(strval($property_search->PropertyUse->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_search->PropertyUse->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_search->PropertyUse->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_search->PropertyUse->ReadOnly || $property_search->PropertyUse->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_PropertyUse[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_search->PropertyUse->Lookup->getParamTag($property_search, "p_x_PropertyUse") ?>
<input type="hidden" data-table="property" data-field="x_PropertyUse" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $property_search->PropertyUse->displayValueSeparatorAttribute() ?>" name="x_PropertyUse[]" id="x_PropertyUse[]" value="<?php echo $property_search->PropertyUse->AdvancedSearch->SearchValue ?>"<?php echo $property_search->PropertyUse->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_search->LandExtentInHA->Visible) { // LandExtentInHA ?>
	<div id="r_LandExtentInHA" class="form-group row">
		<label for="x_LandExtentInHA" class="<?php echo $property_search->LeftColumnClass ?>"><span id="elh_property_LandExtentInHA"><?php echo $property_search->LandExtentInHA->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LandExtentInHA" id="z_LandExtentInHA" value="=">
</span>
		</label>
		<div class="<?php echo $property_search->RightColumnClass ?>"><div <?php echo $property_search->LandExtentInHA->cellAttributes() ?>>
			<span id="el_property_LandExtentInHA" class="ew-search-field">
<input type="text" data-table="property" data-field="x_LandExtentInHA" name="x_LandExtentInHA" id="x_LandExtentInHA" size="30" placeholder="<?php echo HtmlEncode($property_search->LandExtentInHA->getPlaceHolder()) ?>" value="<?php echo $property_search->LandExtentInHA->EditValue ?>"<?php echo $property_search->LandExtentInHA->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_search->RateableValue->Visible) { // RateableValue ?>
	<div id="r_RateableValue" class="form-group row">
		<label for="x_RateableValue" class="<?php echo $property_search->LeftColumnClass ?>"><span id="elh_property_RateableValue"><?php echo $property_search->RateableValue->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_RateableValue" id="z_RateableValue" value="BETWEEN">
</span>
		</label>
		<div class="<?php echo $property_search->RightColumnClass ?>"><div <?php echo $property_search->RateableValue->cellAttributes() ?>>
			<span id="el_property_RateableValue" class="ew-search-field">
<input type="text" data-table="property" data-field="x_RateableValue" name="x_RateableValue" id="x_RateableValue" size="30" placeholder="<?php echo HtmlEncode($property_search->RateableValue->getPlaceHolder()) ?>" value="<?php echo $property_search->RateableValue->EditValue ?>"<?php echo $property_search->RateableValue->editAttributes() ?>>
</span>
			<span class="ew-search-and"><label><?php echo $Language->phrase("AND") ?></label></span>
			<span id="el2_property_RateableValue" class="ew-search-field2">
<input type="text" data-table="property" data-field="x_RateableValue" name="y_RateableValue" id="y_RateableValue" size="30" placeholder="<?php echo HtmlEncode($property_search->RateableValue->getPlaceHolder()) ?>" value="<?php echo $property_search->RateableValue->EditValue2 ?>"<?php echo $property_search->RateableValue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_search->SupplementaryValue->Visible) { // SupplementaryValue ?>
	<div id="r_SupplementaryValue" class="form-group row">
		<label for="x_SupplementaryValue" class="<?php echo $property_search->LeftColumnClass ?>"><span id="elh_property_SupplementaryValue"><?php echo $property_search->SupplementaryValue->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SupplementaryValue" id="z_SupplementaryValue" value="=">
</span>
		</label>
		<div class="<?php echo $property_search->RightColumnClass ?>"><div <?php echo $property_search->SupplementaryValue->cellAttributes() ?>>
			<span id="el_property_SupplementaryValue" class="ew-search-field">
<input type="text" data-table="property" data-field="x_SupplementaryValue" name="x_SupplementaryValue" id="x_SupplementaryValue" size="30" placeholder="<?php echo HtmlEncode($property_search->SupplementaryValue->getPlaceHolder()) ?>" value="<?php echo $property_search->SupplementaryValue->EditValue ?>"<?php echo $property_search->SupplementaryValue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_search->ExemptCode->Visible) { // ExemptCode ?>
	<div id="r_ExemptCode" class="form-group row">
		<label for="x_ExemptCode" class="<?php echo $property_search->LeftColumnClass ?>"><span id="elh_property_ExemptCode"><?php echo $property_search->ExemptCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ExemptCode" id="z_ExemptCode" value="=">
</span>
		</label>
		<div class="<?php echo $property_search->RightColumnClass ?>"><div <?php echo $property_search->ExemptCode->cellAttributes() ?>>
			<span id="el_property_ExemptCode" class="ew-search-field">
<input type="text" data-table="property" data-field="x_ExemptCode" name="x_ExemptCode" id="x_ExemptCode" size="30" placeholder="<?php echo HtmlEncode($property_search->ExemptCode->getPlaceHolder()) ?>" value="<?php echo $property_search->ExemptCode->EditValue ?>"<?php echo $property_search->ExemptCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_search->Improvements->Visible) { // Improvements ?>
	<div id="r_Improvements" class="form-group row">
		<label for="x_Improvements" class="<?php echo $property_search->LeftColumnClass ?>"><span id="elh_property_Improvements"><?php echo $property_search->Improvements->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Improvements" id="z_Improvements" value="LIKE">
</span>
		</label>
		<div class="<?php echo $property_search->RightColumnClass ?>"><div <?php echo $property_search->Improvements->cellAttributes() ?>>
			<span id="el_property_Improvements" class="ew-search-field">
<input type="text" data-table="property" data-field="x_Improvements" name="x_Improvements" id="x_Improvements" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($property_search->Improvements->getPlaceHolder()) ?>" value="<?php echo $property_search->Improvements->EditValue ?>"<?php echo $property_search->Improvements->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_search->StreetAddress->Visible) { // StreetAddress ?>
	<div id="r_StreetAddress" class="form-group row">
		<label for="x_StreetAddress" class="<?php echo $property_search->LeftColumnClass ?>"><span id="elh_property_StreetAddress"><?php echo $property_search->StreetAddress->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_StreetAddress" id="z_StreetAddress" value="LIKE">
</span>
		</label>
		<div class="<?php echo $property_search->RightColumnClass ?>"><div <?php echo $property_search->StreetAddress->cellAttributes() ?>>
			<span id="el_property_StreetAddress" class="ew-search-field">
<input type="text" data-table="property" data-field="x_StreetAddress" name="x_StreetAddress" id="x_StreetAddress" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($property_search->StreetAddress->getPlaceHolder()) ?>" value="<?php echo $property_search->StreetAddress->EditValue ?>"<?php echo $property_search->StreetAddress->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_search->Longitude->Visible) { // Longitude ?>
	<div id="r_Longitude" class="form-group row">
		<label for="x_Longitude" class="<?php echo $property_search->LeftColumnClass ?>"><span id="elh_property_Longitude"><?php echo $property_search->Longitude->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Longitude" id="z_Longitude" value="=">
</span>
		</label>
		<div class="<?php echo $property_search->RightColumnClass ?>"><div <?php echo $property_search->Longitude->cellAttributes() ?>>
			<span id="el_property_Longitude" class="ew-search-field">
<input type="text" data-table="property" data-field="x_Longitude" name="x_Longitude" id="x_Longitude" size="30" placeholder="<?php echo HtmlEncode($property_search->Longitude->getPlaceHolder()) ?>" value="<?php echo $property_search->Longitude->EditValue ?>"<?php echo $property_search->Longitude->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_search->Latitude->Visible) { // Latitude ?>
	<div id="r_Latitude" class="form-group row">
		<label for="x_Latitude" class="<?php echo $property_search->LeftColumnClass ?>"><span id="elh_property_Latitude"><?php echo $property_search->Latitude->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Latitude" id="z_Latitude" value="=">
</span>
		</label>
		<div class="<?php echo $property_search->RightColumnClass ?>"><div <?php echo $property_search->Latitude->cellAttributes() ?>>
			<span id="el_property_Latitude" class="ew-search-field">
<input type="text" data-table="property" data-field="x_Latitude" name="x_Latitude" id="x_Latitude" size="30" placeholder="<?php echo HtmlEncode($property_search->Latitude->getPlaceHolder()) ?>" value="<?php echo $property_search->Latitude->EditValue ?>"<?php echo $property_search->Latitude->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_search->Incumberance->Visible) { // Incumberance ?>
	<div id="r_Incumberance" class="form-group row">
		<label for="x_Incumberance" class="<?php echo $property_search->LeftColumnClass ?>"><span id="elh_property_Incumberance"><?php echo $property_search->Incumberance->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Incumberance" id="z_Incumberance" value="LIKE">
</span>
		</label>
		<div class="<?php echo $property_search->RightColumnClass ?>"><div <?php echo $property_search->Incumberance->cellAttributes() ?>>
			<span id="el_property_Incumberance" class="ew-search-field">
<input type="text" data-table="property" data-field="x_Incumberance" name="x_Incumberance" id="x_Incumberance" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($property_search->Incumberance->getPlaceHolder()) ?>" value="<?php echo $property_search->Incumberance->EditValue ?>"<?php echo $property_search->Incumberance->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_search->SubDivisionOf->Visible) { // SubDivisionOf ?>
	<div id="r_SubDivisionOf" class="form-group row">
		<label for="x_SubDivisionOf" class="<?php echo $property_search->LeftColumnClass ?>"><span id="elh_property_SubDivisionOf"><?php echo $property_search->SubDivisionOf->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SubDivisionOf" id="z_SubDivisionOf" value="=">
</span>
		</label>
		<div class="<?php echo $property_search->RightColumnClass ?>"><div <?php echo $property_search->SubDivisionOf->cellAttributes() ?>>
			<span id="el_property_SubDivisionOf" class="ew-search-field">
<input type="text" data-table="property" data-field="x_SubDivisionOf" name="x_SubDivisionOf" id="x_SubDivisionOf" size="30" placeholder="<?php echo HtmlEncode($property_search->SubDivisionOf->getPlaceHolder()) ?>" value="<?php echo $property_search->SubDivisionOf->EditValue ?>"<?php echo $property_search->SubDivisionOf->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_search->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<div id="r_LastUpdatedBy" class="form-group row">
		<label for="x_LastUpdatedBy" class="<?php echo $property_search->LeftColumnClass ?>"><span id="elh_property_LastUpdatedBy"><?php echo $property_search->LastUpdatedBy->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LastUpdatedBy" id="z_LastUpdatedBy" value="LIKE">
</span>
		</label>
		<div class="<?php echo $property_search->RightColumnClass ?>"><div <?php echo $property_search->LastUpdatedBy->cellAttributes() ?>>
			<span id="el_property_LastUpdatedBy" class="ew-search-field">
<input type="text" data-table="property" data-field="x_LastUpdatedBy" name="x_LastUpdatedBy" id="x_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_search->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $property_search->LastUpdatedBy->EditValue ?>"<?php echo $property_search->LastUpdatedBy->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_search->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<div id="r_LastUpdateDate" class="form-group row">
		<label for="x_LastUpdateDate" class="<?php echo $property_search->LeftColumnClass ?>"><span id="elh_property_LastUpdateDate"><?php echo $property_search->LastUpdateDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LastUpdateDate" id="z_LastUpdateDate" value="=">
</span>
		</label>
		<div class="<?php echo $property_search->RightColumnClass ?>"><div <?php echo $property_search->LastUpdateDate->cellAttributes() ?>>
			<span id="el_property_LastUpdateDate" class="ew-search-field">
<input type="text" data-table="property" data-field="x_LastUpdateDate" name="x_LastUpdateDate" id="x_LastUpdateDate" placeholder="<?php echo HtmlEncode($property_search->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $property_search->LastUpdateDate->EditValue ?>"<?php echo $property_search->LastUpdateDate->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_search->ValuationNo->Visible) { // ValuationNo ?>
	<div id="r_ValuationNo" class="form-group row">
		<label for="x_ValuationNo" class="<?php echo $property_search->LeftColumnClass ?>"><span id="elh_property_ValuationNo"><?php echo $property_search->ValuationNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ValuationNo" id="z_ValuationNo" value="=">
</span>
		</label>
		<div class="<?php echo $property_search->RightColumnClass ?>"><div <?php echo $property_search->ValuationNo->cellAttributes() ?>>
			<span id="el_property_ValuationNo" class="ew-search-field">
<input type="text" data-table="property" data-field="x_ValuationNo" name="x_ValuationNo" id="x_ValuationNo" size="30" placeholder="<?php echo HtmlEncode($property_search->ValuationNo->getPlaceHolder()) ?>" value="<?php echo $property_search->ValuationNo->EditValue ?>"<?php echo $property_search->ValuationNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_search->LandValue->Visible) { // LandValue ?>
	<div id="r_LandValue" class="form-group row">
		<label for="x_LandValue" class="<?php echo $property_search->LeftColumnClass ?>"><span id="elh_property_LandValue"><?php echo $property_search->LandValue->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LandValue" id="z_LandValue" value="=">
</span>
		</label>
		<div class="<?php echo $property_search->RightColumnClass ?>"><div <?php echo $property_search->LandValue->cellAttributes() ?>>
			<span id="el_property_LandValue" class="ew-search-field">
<input type="text" data-table="property" data-field="x_LandValue" name="x_LandValue" id="x_LandValue" size="30" placeholder="<?php echo HtmlEncode($property_search->LandValue->getPlaceHolder()) ?>" value="<?php echo $property_search->LandValue->EditValue ?>"<?php echo $property_search->LandValue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_search->ImprovementsValue->Visible) { // ImprovementsValue ?>
	<div id="r_ImprovementsValue" class="form-group row">
		<label for="x_ImprovementsValue" class="<?php echo $property_search->LeftColumnClass ?>"><span id="elh_property_ImprovementsValue"><?php echo $property_search->ImprovementsValue->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ImprovementsValue" id="z_ImprovementsValue" value="=">
</span>
		</label>
		<div class="<?php echo $property_search->RightColumnClass ?>"><div <?php echo $property_search->ImprovementsValue->cellAttributes() ?>>
			<span id="el_property_ImprovementsValue" class="ew-search-field">
<input type="text" data-table="property" data-field="x_ImprovementsValue" name="x_ImprovementsValue" id="x_ImprovementsValue" size="30" placeholder="<?php echo HtmlEncode($property_search->ImprovementsValue->getPlaceHolder()) ?>" value="<?php echo $property_search->ImprovementsValue->EditValue ?>"<?php echo $property_search->ImprovementsValue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$property_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $property_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$property_search->showPageFooter();
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
$property_search->terminate();
?>