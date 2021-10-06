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
$print_bill_view_search = new print_bill_view_search();

// Run the page
$print_bill_view_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$print_bill_view_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fprint_bill_viewsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($print_bill_view_search->IsModal) { ?>
	fprint_bill_viewsearch = currentAdvancedSearchForm = new ew.Form("fprint_bill_viewsearch", "search");
	<?php } else { ?>
	fprint_bill_viewsearch = currentForm = new ew.Form("fprint_bill_viewsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fprint_bill_viewsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ValuationNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($print_bill_view_search->ValuationNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PropertyGroup");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($print_bill_view_search->PropertyGroup->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_RateableValue");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($print_bill_view_search->RateableValue->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ReferenceNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($print_bill_view_search->ReferenceNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ChargeCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($print_bill_view_search->ChargeCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BillPeriod");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($print_bill_view_search->BillPeriod->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_StartDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($print_bill_view_search->StartDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_EndDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($print_bill_view_search->EndDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BalanceBF");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($print_bill_view_search->BalanceBF->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_AmountDue");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($print_bill_view_search->AmountDue->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_VAT");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($print_bill_view_search->VAT->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_SalesTax");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($print_bill_view_search->SalesTax->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_AmountPaid");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($print_bill_view_search->AmountPaid->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fprint_bill_viewsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fprint_bill_viewsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fprint_bill_viewsearch.lists["x_ClientSerNo"] = <?php echo $print_bill_view_search->ClientSerNo->Lookup->toClientList($print_bill_view_search) ?>;
	fprint_bill_viewsearch.lists["x_ClientSerNo"].options = <?php echo JsonEncode($print_bill_view_search->ClientSerNo->lookupOptions()) ?>;
	fprint_bill_viewsearch.autoSuggests["x_ClientSerNo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fprint_bill_viewsearch.lists["x_PropertyGroup"] = <?php echo $print_bill_view_search->PropertyGroup->Lookup->toClientList($print_bill_view_search) ?>;
	fprint_bill_viewsearch.lists["x_PropertyGroup"].options = <?php echo JsonEncode($print_bill_view_search->PropertyGroup->lookupOptions()) ?>;
	fprint_bill_viewsearch.autoSuggests["x_PropertyGroup"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fprint_bill_viewsearch.lists["x_Location[]"] = <?php echo $print_bill_view_search->Location->Lookup->toClientList($print_bill_view_search) ?>;
	fprint_bill_viewsearch.lists["x_Location[]"].options = <?php echo JsonEncode($print_bill_view_search->Location->lookupOptions()) ?>;
	fprint_bill_viewsearch.lists["x_PropertyUse[]"] = <?php echo $print_bill_view_search->PropertyUse->Lookup->toClientList($print_bill_view_search) ?>;
	fprint_bill_viewsearch.lists["x_PropertyUse[]"].options = <?php echo JsonEncode($print_bill_view_search->PropertyUse->lookupOptions()) ?>;
	fprint_bill_viewsearch.lists["x_ChargeCode"] = <?php echo $print_bill_view_search->ChargeCode->Lookup->toClientList($print_bill_view_search) ?>;
	fprint_bill_viewsearch.lists["x_ChargeCode"].options = <?php echo JsonEncode($print_bill_view_search->ChargeCode->lookupOptions()) ?>;
	fprint_bill_viewsearch.autoSuggests["x_ChargeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fprint_bill_viewsearch.lists["x_ChargeGroup[]"] = <?php echo $print_bill_view_search->ChargeGroup->Lookup->toClientList($print_bill_view_search) ?>;
	fprint_bill_viewsearch.lists["x_ChargeGroup[]"].options = <?php echo JsonEncode($print_bill_view_search->ChargeGroup->lookupOptions()) ?>;
	fprint_bill_viewsearch.lists["x_BillYear"] = <?php echo $print_bill_view_search->BillYear->Lookup->toClientList($print_bill_view_search) ?>;
	fprint_bill_viewsearch.lists["x_BillYear"].options = <?php echo JsonEncode($print_bill_view_search->BillYear->lookupOptions()) ?>;
	loadjs.done("fprint_bill_viewsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $print_bill_view_search->showPageHeader(); ?>
<?php
$print_bill_view_search->showMessage();
?>
<form name="fprint_bill_viewsearch" id="fprint_bill_viewsearch" class="<?php echo $print_bill_view_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="print_bill_view">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$print_bill_view_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($print_bill_view_search->ValuationNo->Visible) { // ValuationNo ?>
	<div id="r_ValuationNo" class="form-group row">
		<label for="x_ValuationNo" class="<?php echo $print_bill_view_search->LeftColumnClass ?>"><span id="elh_print_bill_view_ValuationNo"><?php echo $print_bill_view_search->ValuationNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ValuationNo" id="z_ValuationNo" value="=">
</span>
		</label>
		<div class="<?php echo $print_bill_view_search->RightColumnClass ?>"><div <?php echo $print_bill_view_search->ValuationNo->cellAttributes() ?>>
			<span id="el_print_bill_view_ValuationNo" class="ew-search-field">
<input type="text" data-table="print_bill_view" data-field="x_ValuationNo" name="x_ValuationNo" id="x_ValuationNo" placeholder="<?php echo HtmlEncode($print_bill_view_search->ValuationNo->getPlaceHolder()) ?>" value="<?php echo $print_bill_view_search->ValuationNo->EditValue ?>"<?php echo $print_bill_view_search->ValuationNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($print_bill_view_search->PropertyNo->Visible) { // PropertyNo ?>
	<div id="r_PropertyNo" class="form-group row">
		<label for="x_PropertyNo" class="<?php echo $print_bill_view_search->LeftColumnClass ?>"><span id="elh_print_bill_view_PropertyNo"><?php echo $print_bill_view_search->PropertyNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PropertyNo" id="z_PropertyNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $print_bill_view_search->RightColumnClass ?>"><div <?php echo $print_bill_view_search->PropertyNo->cellAttributes() ?>>
			<span id="el_print_bill_view_PropertyNo" class="ew-search-field">
<input type="text" data-table="print_bill_view" data-field="x_PropertyNo" name="x_PropertyNo" id="x_PropertyNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($print_bill_view_search->PropertyNo->getPlaceHolder()) ?>" value="<?php echo $print_bill_view_search->PropertyNo->EditValue ?>"<?php echo $print_bill_view_search->PropertyNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($print_bill_view_search->ClientSerNo->Visible) { // ClientSerNo ?>
	<div id="r_ClientSerNo" class="form-group row">
		<label class="<?php echo $print_bill_view_search->LeftColumnClass ?>"><span id="elh_print_bill_view_ClientSerNo"><?php echo $print_bill_view_search->ClientSerNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ClientSerNo" id="z_ClientSerNo" value="=">
</span>
		</label>
		<div class="<?php echo $print_bill_view_search->RightColumnClass ?>"><div <?php echo $print_bill_view_search->ClientSerNo->cellAttributes() ?>>
			<span id="el_print_bill_view_ClientSerNo" class="ew-search-field">
<?php
$onchange = $print_bill_view_search->ClientSerNo->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$print_bill_view_search->ClientSerNo->EditAttrs["onchange"] = "";
?>
<span id="as_x_ClientSerNo">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ClientSerNo" id="sv_x_ClientSerNo" value="<?php echo RemoveHtml($print_bill_view_search->ClientSerNo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($print_bill_view_search->ClientSerNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($print_bill_view_search->ClientSerNo->getPlaceHolder()) ?>"<?php echo $print_bill_view_search->ClientSerNo->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($print_bill_view_search->ClientSerNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ClientSerNo',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($print_bill_view_search->ClientSerNo->ReadOnly || $print_bill_view_search->ClientSerNo->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="print_bill_view" data-field="x_ClientSerNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $print_bill_view_search->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x_ClientSerNo" id="x_ClientSerNo" value="<?php echo HtmlEncode($print_bill_view_search->ClientSerNo->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fprint_bill_viewsearch"], function() {
	fprint_bill_viewsearch.createAutoSuggest({"id":"x_ClientSerNo","forceSelect":true});
});
</script>
<?php echo $print_bill_view_search->ClientSerNo->Lookup->getParamTag($print_bill_view_search, "p_x_ClientSerNo") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($print_bill_view_search->PropertyGroup->Visible) { // PropertyGroup ?>
	<div id="r_PropertyGroup" class="form-group row">
		<label class="<?php echo $print_bill_view_search->LeftColumnClass ?>"><span id="elh_print_bill_view_PropertyGroup"><?php echo $print_bill_view_search->PropertyGroup->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PropertyGroup" id="z_PropertyGroup" value="=">
</span>
		</label>
		<div class="<?php echo $print_bill_view_search->RightColumnClass ?>"><div <?php echo $print_bill_view_search->PropertyGroup->cellAttributes() ?>>
			<span id="el_print_bill_view_PropertyGroup" class="ew-search-field">
<?php
$onchange = $print_bill_view_search->PropertyGroup->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$print_bill_view_search->PropertyGroup->EditAttrs["onchange"] = "";
?>
<span id="as_x_PropertyGroup">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_PropertyGroup" id="sv_x_PropertyGroup" value="<?php echo RemoveHtml($print_bill_view_search->PropertyGroup->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($print_bill_view_search->PropertyGroup->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($print_bill_view_search->PropertyGroup->getPlaceHolder()) ?>"<?php echo $print_bill_view_search->PropertyGroup->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($print_bill_view_search->PropertyGroup->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_PropertyGroup',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($print_bill_view_search->PropertyGroup->ReadOnly || $print_bill_view_search->PropertyGroup->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="print_bill_view" data-field="x_PropertyGroup" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $print_bill_view_search->PropertyGroup->displayValueSeparatorAttribute() ?>" name="x_PropertyGroup" id="x_PropertyGroup" value="<?php echo HtmlEncode($print_bill_view_search->PropertyGroup->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fprint_bill_viewsearch"], function() {
	fprint_bill_viewsearch.createAutoSuggest({"id":"x_PropertyGroup","forceSelect":false});
});
</script>
<?php echo $print_bill_view_search->PropertyGroup->Lookup->getParamTag($print_bill_view_search, "p_x_PropertyGroup") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($print_bill_view_search->Location->Visible) { // Location ?>
	<div id="r_Location" class="form-group row">
		<label class="<?php echo $print_bill_view_search->LeftColumnClass ?>"><span id="elh_print_bill_view_Location"><?php echo $print_bill_view_search->Location->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Location" id="z_Location" value="LIKE">
</span>
		</label>
		<div class="<?php echo $print_bill_view_search->RightColumnClass ?>"><div <?php echo $print_bill_view_search->Location->cellAttributes() ?>>
			<span id="el_print_bill_view_Location" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_Location"><?php echo EmptyValue(strval($print_bill_view_search->Location->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $print_bill_view_search->Location->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($print_bill_view_search->Location->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($print_bill_view_search->Location->ReadOnly || $print_bill_view_search->Location->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_Location[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $print_bill_view_search->Location->Lookup->getParamTag($print_bill_view_search, "p_x_Location") ?>
<input type="hidden" data-table="print_bill_view" data-field="x_Location" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $print_bill_view_search->Location->displayValueSeparatorAttribute() ?>" name="x_Location[]" id="x_Location[]" value="<?php echo $print_bill_view_search->Location->AdvancedSearch->SearchValue ?>"<?php echo $print_bill_view_search->Location->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($print_bill_view_search->PropertyUse->Visible) { // PropertyUse ?>
	<div id="r_PropertyUse" class="form-group row">
		<label class="<?php echo $print_bill_view_search->LeftColumnClass ?>"><span id="elh_print_bill_view_PropertyUse"><?php echo $print_bill_view_search->PropertyUse->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PropertyUse" id="z_PropertyUse" value="LIKE">
</span>
		</label>
		<div class="<?php echo $print_bill_view_search->RightColumnClass ?>"><div <?php echo $print_bill_view_search->PropertyUse->cellAttributes() ?>>
			<span id="el_print_bill_view_PropertyUse" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_PropertyUse"><?php echo EmptyValue(strval($print_bill_view_search->PropertyUse->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $print_bill_view_search->PropertyUse->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($print_bill_view_search->PropertyUse->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($print_bill_view_search->PropertyUse->ReadOnly || $print_bill_view_search->PropertyUse->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_PropertyUse[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $print_bill_view_search->PropertyUse->Lookup->getParamTag($print_bill_view_search, "p_x_PropertyUse") ?>
<input type="hidden" data-table="print_bill_view" data-field="x_PropertyUse" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $print_bill_view_search->PropertyUse->displayValueSeparatorAttribute() ?>" name="x_PropertyUse[]" id="x_PropertyUse[]" value="<?php echo $print_bill_view_search->PropertyUse->AdvancedSearch->SearchValue ?>"<?php echo $print_bill_view_search->PropertyUse->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($print_bill_view_search->RateableValue->Visible) { // RateableValue ?>
	<div id="r_RateableValue" class="form-group row">
		<label for="x_RateableValue" class="<?php echo $print_bill_view_search->LeftColumnClass ?>"><span id="elh_print_bill_view_RateableValue"><?php echo $print_bill_view_search->RateableValue->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_RateableValue" id="z_RateableValue" value="=">
</span>
		</label>
		<div class="<?php echo $print_bill_view_search->RightColumnClass ?>"><div <?php echo $print_bill_view_search->RateableValue->cellAttributes() ?>>
			<span id="el_print_bill_view_RateableValue" class="ew-search-field">
<input type="text" data-table="print_bill_view" data-field="x_RateableValue" name="x_RateableValue" id="x_RateableValue" size="30" placeholder="<?php echo HtmlEncode($print_bill_view_search->RateableValue->getPlaceHolder()) ?>" value="<?php echo $print_bill_view_search->RateableValue->EditValue ?>"<?php echo $print_bill_view_search->RateableValue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($print_bill_view_search->ReferenceNo->Visible) { // ReferenceNo ?>
	<div id="r_ReferenceNo" class="form-group row">
		<label for="x_ReferenceNo" class="<?php echo $print_bill_view_search->LeftColumnClass ?>"><span id="elh_print_bill_view_ReferenceNo"><?php echo $print_bill_view_search->ReferenceNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_ReferenceNo" id="z_ReferenceNo" value="BETWEEN">
</span>
		</label>
		<div class="<?php echo $print_bill_view_search->RightColumnClass ?>"><div <?php echo $print_bill_view_search->ReferenceNo->cellAttributes() ?>>
			<span id="el_print_bill_view_ReferenceNo" class="ew-search-field">
<input type="text" data-table="print_bill_view" data-field="x_ReferenceNo" name="x_ReferenceNo" id="x_ReferenceNo" placeholder="<?php echo HtmlEncode($print_bill_view_search->ReferenceNo->getPlaceHolder()) ?>" value="<?php echo $print_bill_view_search->ReferenceNo->EditValue ?>"<?php echo $print_bill_view_search->ReferenceNo->editAttributes() ?>>
</span>
			<span class="ew-search-and"><label><?php echo $Language->phrase("AND") ?></label></span>
			<span id="el2_print_bill_view_ReferenceNo" class="ew-search-field2">
<input type="text" data-table="print_bill_view" data-field="x_ReferenceNo" name="y_ReferenceNo" id="y_ReferenceNo" placeholder="<?php echo HtmlEncode($print_bill_view_search->ReferenceNo->getPlaceHolder()) ?>" value="<?php echo $print_bill_view_search->ReferenceNo->EditValue2 ?>"<?php echo $print_bill_view_search->ReferenceNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($print_bill_view_search->ChargeCode->Visible) { // ChargeCode ?>
	<div id="r_ChargeCode" class="form-group row">
		<label class="<?php echo $print_bill_view_search->LeftColumnClass ?>"><span id="elh_print_bill_view_ChargeCode"><?php echo $print_bill_view_search->ChargeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ChargeCode" id="z_ChargeCode" value="=">
</span>
		</label>
		<div class="<?php echo $print_bill_view_search->RightColumnClass ?>"><div <?php echo $print_bill_view_search->ChargeCode->cellAttributes() ?>>
			<span id="el_print_bill_view_ChargeCode" class="ew-search-field">
<?php
$onchange = $print_bill_view_search->ChargeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$print_bill_view_search->ChargeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ChargeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ChargeCode" id="sv_x_ChargeCode" value="<?php echo RemoveHtml($print_bill_view_search->ChargeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($print_bill_view_search->ChargeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($print_bill_view_search->ChargeCode->getPlaceHolder()) ?>"<?php echo $print_bill_view_search->ChargeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($print_bill_view_search->ChargeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($print_bill_view_search->ChargeCode->ReadOnly || $print_bill_view_search->ChargeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="print_bill_view" data-field="x_ChargeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $print_bill_view_search->ChargeCode->displayValueSeparatorAttribute() ?>" name="x_ChargeCode" id="x_ChargeCode" value="<?php echo HtmlEncode($print_bill_view_search->ChargeCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fprint_bill_viewsearch"], function() {
	fprint_bill_viewsearch.createAutoSuggest({"id":"x_ChargeCode","forceSelect":false});
});
</script>
<?php echo $print_bill_view_search->ChargeCode->Lookup->getParamTag($print_bill_view_search, "p_x_ChargeCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($print_bill_view_search->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label class="<?php echo $print_bill_view_search->LeftColumnClass ?>"><span id="elh_print_bill_view_ChargeGroup"><?php echo $print_bill_view_search->ChargeGroup->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ChargeGroup" id="z_ChargeGroup" value="LIKE">
</span>
		</label>
		<div class="<?php echo $print_bill_view_search->RightColumnClass ?>"><div <?php echo $print_bill_view_search->ChargeGroup->cellAttributes() ?>>
			<span id="el_print_bill_view_ChargeGroup" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ChargeGroup"><?php echo EmptyValue(strval($print_bill_view_search->ChargeGroup->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $print_bill_view_search->ChargeGroup->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($print_bill_view_search->ChargeGroup->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($print_bill_view_search->ChargeGroup->ReadOnly || $print_bill_view_search->ChargeGroup->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeGroup[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $print_bill_view_search->ChargeGroup->Lookup->getParamTag($print_bill_view_search, "p_x_ChargeGroup") ?>
<input type="hidden" data-table="print_bill_view" data-field="x_ChargeGroup" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $print_bill_view_search->ChargeGroup->displayValueSeparatorAttribute() ?>" name="x_ChargeGroup[]" id="x_ChargeGroup[]" value="<?php echo $print_bill_view_search->ChargeGroup->AdvancedSearch->SearchValue ?>"<?php echo $print_bill_view_search->ChargeGroup->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($print_bill_view_search->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label for="x_ClientID" class="<?php echo $print_bill_view_search->LeftColumnClass ?>"><span id="elh_print_bill_view_ClientID"><?php echo $print_bill_view_search->ClientID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ClientID" id="z_ClientID" value="LIKE">
</span>
		</label>
		<div class="<?php echo $print_bill_view_search->RightColumnClass ?>"><div <?php echo $print_bill_view_search->ClientID->cellAttributes() ?>>
			<span id="el_print_bill_view_ClientID" class="ew-search-field">
<input type="text" data-table="print_bill_view" data-field="x_ClientID" name="x_ClientID" id="x_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($print_bill_view_search->ClientID->getPlaceHolder()) ?>" value="<?php echo $print_bill_view_search->ClientID->EditValue ?>"<?php echo $print_bill_view_search->ClientID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($print_bill_view_search->BillYear->Visible) { // BillYear ?>
	<div id="r_BillYear" class="form-group row">
		<label for="x_BillYear" class="<?php echo $print_bill_view_search->LeftColumnClass ?>"><span id="elh_print_bill_view_BillYear"><?php echo $print_bill_view_search->BillYear->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillYear" id="z_BillYear" value="=">
</span>
		</label>
		<div class="<?php echo $print_bill_view_search->RightColumnClass ?>"><div <?php echo $print_bill_view_search->BillYear->cellAttributes() ?>>
			<span id="el_print_bill_view_BillYear" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="print_bill_view" data-field="x_BillYear" data-value-separator="<?php echo $print_bill_view_search->BillYear->displayValueSeparatorAttribute() ?>" id="x_BillYear" name="x_BillYear"<?php echo $print_bill_view_search->BillYear->editAttributes() ?>>
			<?php echo $print_bill_view_search->BillYear->selectOptionListHtml("x_BillYear") ?>
		</select>
</div>
<?php echo $print_bill_view_search->BillYear->Lookup->getParamTag($print_bill_view_search, "p_x_BillYear") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($print_bill_view_search->BillPeriod->Visible) { // BillPeriod ?>
	<div id="r_BillPeriod" class="form-group row">
		<label for="x_BillPeriod" class="<?php echo $print_bill_view_search->LeftColumnClass ?>"><span id="elh_print_bill_view_BillPeriod"><?php echo $print_bill_view_search->BillPeriod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillPeriod" id="z_BillPeriod" value="=">
</span>
		</label>
		<div class="<?php echo $print_bill_view_search->RightColumnClass ?>"><div <?php echo $print_bill_view_search->BillPeriod->cellAttributes() ?>>
			<span id="el_print_bill_view_BillPeriod" class="ew-search-field">
<input type="text" data-table="print_bill_view" data-field="x_BillPeriod" name="x_BillPeriod" id="x_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($print_bill_view_search->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $print_bill_view_search->BillPeriod->EditValue ?>"<?php echo $print_bill_view_search->BillPeriod->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($print_bill_view_search->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label for="x_StartDate" class="<?php echo $print_bill_view_search->LeftColumnClass ?>"><span id="elh_print_bill_view_StartDate"><?php echo $print_bill_view_search->StartDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_StartDate" id="z_StartDate" value="=">
</span>
		</label>
		<div class="<?php echo $print_bill_view_search->RightColumnClass ?>"><div <?php echo $print_bill_view_search->StartDate->cellAttributes() ?>>
			<span id="el_print_bill_view_StartDate" class="ew-search-field">
<input type="text" data-table="print_bill_view" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($print_bill_view_search->StartDate->getPlaceHolder()) ?>" value="<?php echo $print_bill_view_search->StartDate->EditValue ?>"<?php echo $print_bill_view_search->StartDate->editAttributes() ?>>
<?php if (!$print_bill_view_search->StartDate->ReadOnly && !$print_bill_view_search->StartDate->Disabled && !isset($print_bill_view_search->StartDate->EditAttrs["readonly"]) && !isset($print_bill_view_search->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprint_bill_viewsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fprint_bill_viewsearch", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($print_bill_view_search->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label for="x_EndDate" class="<?php echo $print_bill_view_search->LeftColumnClass ?>"><span id="elh_print_bill_view_EndDate"><?php echo $print_bill_view_search->EndDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EndDate" id="z_EndDate" value="=">
</span>
		</label>
		<div class="<?php echo $print_bill_view_search->RightColumnClass ?>"><div <?php echo $print_bill_view_search->EndDate->cellAttributes() ?>>
			<span id="el_print_bill_view_EndDate" class="ew-search-field">
<input type="text" data-table="print_bill_view" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" placeholder="<?php echo HtmlEncode($print_bill_view_search->EndDate->getPlaceHolder()) ?>" value="<?php echo $print_bill_view_search->EndDate->EditValue ?>"<?php echo $print_bill_view_search->EndDate->editAttributes() ?>>
<?php if (!$print_bill_view_search->EndDate->ReadOnly && !$print_bill_view_search->EndDate->Disabled && !isset($print_bill_view_search->EndDate->EditAttrs["readonly"]) && !isset($print_bill_view_search->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprint_bill_viewsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fprint_bill_viewsearch", "x_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($print_bill_view_search->BalanceBF->Visible) { // BalanceBF ?>
	<div id="r_BalanceBF" class="form-group row">
		<label for="x_BalanceBF" class="<?php echo $print_bill_view_search->LeftColumnClass ?>"><span id="elh_print_bill_view_BalanceBF"><?php echo $print_bill_view_search->BalanceBF->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BalanceBF" id="z_BalanceBF" value="=">
</span>
		</label>
		<div class="<?php echo $print_bill_view_search->RightColumnClass ?>"><div <?php echo $print_bill_view_search->BalanceBF->cellAttributes() ?>>
			<span id="el_print_bill_view_BalanceBF" class="ew-search-field">
<input type="text" data-table="print_bill_view" data-field="x_BalanceBF" name="x_BalanceBF" id="x_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($print_bill_view_search->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $print_bill_view_search->BalanceBF->EditValue ?>"<?php echo $print_bill_view_search->BalanceBF->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($print_bill_view_search->AmountDue->Visible) { // AmountDue ?>
	<div id="r_AmountDue" class="form-group row">
		<label for="x_AmountDue" class="<?php echo $print_bill_view_search->LeftColumnClass ?>"><span id="elh_print_bill_view_AmountDue"><?php echo $print_bill_view_search->AmountDue->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AmountDue" id="z_AmountDue" value="=">
</span>
		</label>
		<div class="<?php echo $print_bill_view_search->RightColumnClass ?>"><div <?php echo $print_bill_view_search->AmountDue->cellAttributes() ?>>
			<span id="el_print_bill_view_AmountDue" class="ew-search-field">
<input type="text" data-table="print_bill_view" data-field="x_AmountDue" name="x_AmountDue" id="x_AmountDue" size="30" placeholder="<?php echo HtmlEncode($print_bill_view_search->AmountDue->getPlaceHolder()) ?>" value="<?php echo $print_bill_view_search->AmountDue->EditValue ?>"<?php echo $print_bill_view_search->AmountDue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($print_bill_view_search->VAT->Visible) { // VAT ?>
	<div id="r_VAT" class="form-group row">
		<label for="x_VAT" class="<?php echo $print_bill_view_search->LeftColumnClass ?>"><span id="elh_print_bill_view_VAT"><?php echo $print_bill_view_search->VAT->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_VAT" id="z_VAT" value="=">
</span>
		</label>
		<div class="<?php echo $print_bill_view_search->RightColumnClass ?>"><div <?php echo $print_bill_view_search->VAT->cellAttributes() ?>>
			<span id="el_print_bill_view_VAT" class="ew-search-field">
<input type="text" data-table="print_bill_view" data-field="x_VAT" name="x_VAT" id="x_VAT" size="30" placeholder="<?php echo HtmlEncode($print_bill_view_search->VAT->getPlaceHolder()) ?>" value="<?php echo $print_bill_view_search->VAT->EditValue ?>"<?php echo $print_bill_view_search->VAT->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($print_bill_view_search->SalesTax->Visible) { // SalesTax ?>
	<div id="r_SalesTax" class="form-group row">
		<label for="x_SalesTax" class="<?php echo $print_bill_view_search->LeftColumnClass ?>"><span id="elh_print_bill_view_SalesTax"><?php echo $print_bill_view_search->SalesTax->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SalesTax" id="z_SalesTax" value="=">
</span>
		</label>
		<div class="<?php echo $print_bill_view_search->RightColumnClass ?>"><div <?php echo $print_bill_view_search->SalesTax->cellAttributes() ?>>
			<span id="el_print_bill_view_SalesTax" class="ew-search-field">
<input type="text" data-table="print_bill_view" data-field="x_SalesTax" name="x_SalesTax" id="x_SalesTax" size="30" placeholder="<?php echo HtmlEncode($print_bill_view_search->SalesTax->getPlaceHolder()) ?>" value="<?php echo $print_bill_view_search->SalesTax->EditValue ?>"<?php echo $print_bill_view_search->SalesTax->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($print_bill_view_search->AmountPaid->Visible) { // AmountPaid ?>
	<div id="r_AmountPaid" class="form-group row">
		<label for="x_AmountPaid" class="<?php echo $print_bill_view_search->LeftColumnClass ?>"><span id="elh_print_bill_view_AmountPaid"><?php echo $print_bill_view_search->AmountPaid->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AmountPaid" id="z_AmountPaid" value="=">
</span>
		</label>
		<div class="<?php echo $print_bill_view_search->RightColumnClass ?>"><div <?php echo $print_bill_view_search->AmountPaid->cellAttributes() ?>>
			<span id="el_print_bill_view_AmountPaid" class="ew-search-field">
<input type="text" data-table="print_bill_view" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($print_bill_view_search->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $print_bill_view_search->AmountPaid->EditValue ?>"<?php echo $print_bill_view_search->AmountPaid->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$print_bill_view_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $print_bill_view_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$print_bill_view_search->showPageFooter();
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
$print_bill_view_search->terminate();
?>