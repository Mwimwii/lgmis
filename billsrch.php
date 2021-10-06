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
$bill_search = new bill_search();

// Run the page
$bill_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bill_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbillsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($bill_search->IsModal) { ?>
	fbillsearch = currentAdvancedSearchForm = new ew.Form("fbillsearch", "search");
	<?php } else { ?>
	fbillsearch = currentForm = new ew.Form("fbillsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fbillsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ClientSerNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($bill_search->ClientSerNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ChargeCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($bill_search->ChargeCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BillYear");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($bill_search->BillYear->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BillPeriod");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($bill_search->BillPeriod->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_StartDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($bill_search->StartDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_EndDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($bill_search->EndDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BalanceBF");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($bill_search->BalanceBF->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_AmountDue");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($bill_search->AmountDue->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_VAT");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($bill_search->VAT->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_SalesTax");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($bill_search->SalesTax->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_AmountPaid");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($bill_search->AmountPaid->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ReferenceNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($bill_search->ReferenceNo->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fbillsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbillsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbillsearch.lists["x_ClientSerNo"] = <?php echo $bill_search->ClientSerNo->Lookup->toClientList($bill_search) ?>;
	fbillsearch.lists["x_ClientSerNo"].options = <?php echo JsonEncode($bill_search->ClientSerNo->lookupOptions()) ?>;
	fbillsearch.autoSuggests["x_ClientSerNo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fbillsearch.lists["x_ChargeCode"] = <?php echo $bill_search->ChargeCode->Lookup->toClientList($bill_search) ?>;
	fbillsearch.lists["x_ChargeCode"].options = <?php echo JsonEncode($bill_search->ChargeCode->lookupOptions()) ?>;
	fbillsearch.autoSuggests["x_ChargeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fbillsearch.lists["x_ChargeGroup"] = <?php echo $bill_search->ChargeGroup->Lookup->toClientList($bill_search) ?>;
	fbillsearch.lists["x_ChargeGroup"].options = <?php echo JsonEncode($bill_search->ChargeGroup->lookupOptions()) ?>;
	fbillsearch.autoSuggests["x_ChargeGroup"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fbillsearch.lists["x_BillYear"] = <?php echo $bill_search->BillYear->Lookup->toClientList($bill_search) ?>;
	fbillsearch.lists["x_BillYear"].options = <?php echo JsonEncode($bill_search->BillYear->lookupOptions()) ?>;
	fbillsearch.autoSuggests["x_BillYear"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fbillsearch.lists["x_BillPeriod"] = <?php echo $bill_search->BillPeriod->Lookup->toClientList($bill_search) ?>;
	fbillsearch.lists["x_BillPeriod"].options = <?php echo JsonEncode($bill_search->BillPeriod->lookupOptions()) ?>;
	fbillsearch.autoSuggests["x_BillPeriod"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fbillsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $bill_search->showPageHeader(); ?>
<?php
$bill_search->showMessage();
?>
<form name="fbillsearch" id="fbillsearch" class="<?php echo $bill_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bill">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$bill_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($bill_search->ClientSerNo->Visible) { // ClientSerNo ?>
	<div id="r_ClientSerNo" class="form-group row">
		<label class="<?php echo $bill_search->LeftColumnClass ?>"><span id="elh_bill_ClientSerNo"><?php echo $bill_search->ClientSerNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ClientSerNo" id="z_ClientSerNo" value="=">
</span>
		</label>
		<div class="<?php echo $bill_search->RightColumnClass ?>"><div <?php echo $bill_search->ClientSerNo->cellAttributes() ?>>
			<span id="el_bill_ClientSerNo" class="ew-search-field">
<?php
$onchange = $bill_search->ClientSerNo->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$bill_search->ClientSerNo->EditAttrs["onchange"] = "";
?>
<span id="as_x_ClientSerNo">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ClientSerNo" id="sv_x_ClientSerNo" value="<?php echo RemoveHtml($bill_search->ClientSerNo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($bill_search->ClientSerNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($bill_search->ClientSerNo->getPlaceHolder()) ?>"<?php echo $bill_search->ClientSerNo->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($bill_search->ClientSerNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ClientSerNo',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($bill_search->ClientSerNo->ReadOnly || $bill_search->ClientSerNo->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="bill" data-field="x_ClientSerNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $bill_search->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x_ClientSerNo" id="x_ClientSerNo" value="<?php echo HtmlEncode($bill_search->ClientSerNo->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbillsearch"], function() {
	fbillsearch.createAutoSuggest({"id":"x_ClientSerNo","forceSelect":false});
});
</script>
<?php echo $bill_search->ClientSerNo->Lookup->getParamTag($bill_search, "p_x_ClientSerNo") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($bill_search->ChargeCode->Visible) { // ChargeCode ?>
	<div id="r_ChargeCode" class="form-group row">
		<label class="<?php echo $bill_search->LeftColumnClass ?>"><span id="elh_bill_ChargeCode"><?php echo $bill_search->ChargeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ChargeCode" id="z_ChargeCode" value="=">
</span>
		</label>
		<div class="<?php echo $bill_search->RightColumnClass ?>"><div <?php echo $bill_search->ChargeCode->cellAttributes() ?>>
			<span id="el_bill_ChargeCode" class="ew-search-field">
<?php
$onchange = $bill_search->ChargeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$bill_search->ChargeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ChargeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ChargeCode" id="sv_x_ChargeCode" value="<?php echo RemoveHtml($bill_search->ChargeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($bill_search->ChargeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($bill_search->ChargeCode->getPlaceHolder()) ?>"<?php echo $bill_search->ChargeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($bill_search->ChargeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($bill_search->ChargeCode->ReadOnly || $bill_search->ChargeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="bill" data-field="x_ChargeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $bill_search->ChargeCode->displayValueSeparatorAttribute() ?>" name="x_ChargeCode" id="x_ChargeCode" value="<?php echo HtmlEncode($bill_search->ChargeCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbillsearch"], function() {
	fbillsearch.createAutoSuggest({"id":"x_ChargeCode","forceSelect":false});
});
</script>
<?php echo $bill_search->ChargeCode->Lookup->getParamTag($bill_search, "p_x_ChargeCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($bill_search->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label class="<?php echo $bill_search->LeftColumnClass ?>"><span id="elh_bill_ChargeGroup"><?php echo $bill_search->ChargeGroup->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ChargeGroup" id="z_ChargeGroup" value="LIKE">
</span>
		</label>
		<div class="<?php echo $bill_search->RightColumnClass ?>"><div <?php echo $bill_search->ChargeGroup->cellAttributes() ?>>
			<span id="el_bill_ChargeGroup" class="ew-search-field">
<?php
$onchange = $bill_search->ChargeGroup->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$bill_search->ChargeGroup->EditAttrs["onchange"] = "";
?>
<span id="as_x_ChargeGroup">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ChargeGroup" id="sv_x_ChargeGroup" value="<?php echo RemoveHtml($bill_search->ChargeGroup->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($bill_search->ChargeGroup->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($bill_search->ChargeGroup->getPlaceHolder()) ?>"<?php echo $bill_search->ChargeGroup->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($bill_search->ChargeGroup->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeGroup',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($bill_search->ChargeGroup->ReadOnly || $bill_search->ChargeGroup->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="bill" data-field="x_ChargeGroup" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $bill_search->ChargeGroup->displayValueSeparatorAttribute() ?>" name="x_ChargeGroup" id="x_ChargeGroup" value="<?php echo HtmlEncode($bill_search->ChargeGroup->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbillsearch"], function() {
	fbillsearch.createAutoSuggest({"id":"x_ChargeGroup","forceSelect":false});
});
</script>
<?php echo $bill_search->ChargeGroup->Lookup->getParamTag($bill_search, "p_x_ChargeGroup") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($bill_search->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label for="x_ClientID" class="<?php echo $bill_search->LeftColumnClass ?>"><span id="elh_bill_ClientID"><?php echo $bill_search->ClientID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ClientID" id="z_ClientID" value="LIKE">
</span>
		</label>
		<div class="<?php echo $bill_search->RightColumnClass ?>"><div <?php echo $bill_search->ClientID->cellAttributes() ?>>
			<span id="el_bill_ClientID" class="ew-search-field">
<input type="text" data-table="bill" data-field="x_ClientID" name="x_ClientID" id="x_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($bill_search->ClientID->getPlaceHolder()) ?>" value="<?php echo $bill_search->ClientID->EditValue ?>"<?php echo $bill_search->ClientID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($bill_search->AccountNo->Visible) { // AccountNo ?>
	<div id="r_AccountNo" class="form-group row">
		<label for="x_AccountNo" class="<?php echo $bill_search->LeftColumnClass ?>"><span id="elh_bill_AccountNo"><?php echo $bill_search->AccountNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AccountNo" id="z_AccountNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $bill_search->RightColumnClass ?>"><div <?php echo $bill_search->AccountNo->cellAttributes() ?>>
			<span id="el_bill_AccountNo" class="ew-search-field">
<input type="text" data-table="bill" data-field="x_AccountNo" name="x_AccountNo" id="x_AccountNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($bill_search->AccountNo->getPlaceHolder()) ?>" value="<?php echo $bill_search->AccountNo->EditValue ?>"<?php echo $bill_search->AccountNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($bill_search->ChargeRef->Visible) { // ChargeRef ?>
	<div id="r_ChargeRef" class="form-group row">
		<label for="x_ChargeRef" class="<?php echo $bill_search->LeftColumnClass ?>"><span id="elh_bill_ChargeRef"><?php echo $bill_search->ChargeRef->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ChargeRef" id="z_ChargeRef" value="LIKE">
</span>
		</label>
		<div class="<?php echo $bill_search->RightColumnClass ?>"><div <?php echo $bill_search->ChargeRef->cellAttributes() ?>>
			<span id="el_bill_ChargeRef" class="ew-search-field">
<input type="text" data-table="bill" data-field="x_ChargeRef" name="x_ChargeRef" id="x_ChargeRef" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($bill_search->ChargeRef->getPlaceHolder()) ?>" value="<?php echo $bill_search->ChargeRef->EditValue ?>"<?php echo $bill_search->ChargeRef->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($bill_search->BillYear->Visible) { // BillYear ?>
	<div id="r_BillYear" class="form-group row">
		<label class="<?php echo $bill_search->LeftColumnClass ?>"><span id="elh_bill_BillYear"><?php echo $bill_search->BillYear->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillYear" id="z_BillYear" value="=">
</span>
		</label>
		<div class="<?php echo $bill_search->RightColumnClass ?>"><div <?php echo $bill_search->BillYear->cellAttributes() ?>>
			<span id="el_bill_BillYear" class="ew-search-field">
<?php
$onchange = $bill_search->BillYear->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$bill_search->BillYear->EditAttrs["onchange"] = "";
?>
<span id="as_x_BillYear">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_BillYear" id="sv_x_BillYear" value="<?php echo RemoveHtml($bill_search->BillYear->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($bill_search->BillYear->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($bill_search->BillYear->getPlaceHolder()) ?>"<?php echo $bill_search->BillYear->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($bill_search->BillYear->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_BillYear',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($bill_search->BillYear->ReadOnly || $bill_search->BillYear->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="bill" data-field="x_BillYear" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $bill_search->BillYear->displayValueSeparatorAttribute() ?>" name="x_BillYear" id="x_BillYear" value="<?php echo HtmlEncode($bill_search->BillYear->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbillsearch"], function() {
	fbillsearch.createAutoSuggest({"id":"x_BillYear","forceSelect":false});
});
</script>
<?php echo $bill_search->BillYear->Lookup->getParamTag($bill_search, "p_x_BillYear") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($bill_search->BillPeriod->Visible) { // BillPeriod ?>
	<div id="r_BillPeriod" class="form-group row">
		<label class="<?php echo $bill_search->LeftColumnClass ?>"><span id="elh_bill_BillPeriod"><?php echo $bill_search->BillPeriod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillPeriod" id="z_BillPeriod" value="=">
</span>
		</label>
		<div class="<?php echo $bill_search->RightColumnClass ?>"><div <?php echo $bill_search->BillPeriod->cellAttributes() ?>>
			<span id="el_bill_BillPeriod" class="ew-search-field">
<?php
$onchange = $bill_search->BillPeriod->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$bill_search->BillPeriod->EditAttrs["onchange"] = "";
?>
<span id="as_x_BillPeriod">
	<input type="text" class="form-control" name="sv_x_BillPeriod" id="sv_x_BillPeriod" value="<?php echo RemoveHtml($bill_search->BillPeriod->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($bill_search->BillPeriod->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($bill_search->BillPeriod->getPlaceHolder()) ?>"<?php echo $bill_search->BillPeriod->editAttributes() ?>>
</span>
<input type="hidden" data-table="bill" data-field="x_BillPeriod" data-value-separator="<?php echo $bill_search->BillPeriod->displayValueSeparatorAttribute() ?>" name="x_BillPeriod" id="x_BillPeriod" value="<?php echo HtmlEncode($bill_search->BillPeriod->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbillsearch"], function() {
	fbillsearch.createAutoSuggest({"id":"x_BillPeriod","forceSelect":false});
});
</script>
<?php echo $bill_search->BillPeriod->Lookup->getParamTag($bill_search, "p_x_BillPeriod") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($bill_search->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label for="x_StartDate" class="<?php echo $bill_search->LeftColumnClass ?>"><span id="elh_bill_StartDate"><?php echo $bill_search->StartDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_StartDate" id="z_StartDate" value="=">
</span>
		</label>
		<div class="<?php echo $bill_search->RightColumnClass ?>"><div <?php echo $bill_search->StartDate->cellAttributes() ?>>
			<span id="el_bill_StartDate" class="ew-search-field">
<input type="text" data-table="bill" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($bill_search->StartDate->getPlaceHolder()) ?>" value="<?php echo $bill_search->StartDate->EditValue ?>"<?php echo $bill_search->StartDate->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($bill_search->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label for="x_EndDate" class="<?php echo $bill_search->LeftColumnClass ?>"><span id="elh_bill_EndDate"><?php echo $bill_search->EndDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EndDate" id="z_EndDate" value="=">
</span>
		</label>
		<div class="<?php echo $bill_search->RightColumnClass ?>"><div <?php echo $bill_search->EndDate->cellAttributes() ?>>
			<span id="el_bill_EndDate" class="ew-search-field">
<input type="text" data-table="bill" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" placeholder="<?php echo HtmlEncode($bill_search->EndDate->getPlaceHolder()) ?>" value="<?php echo $bill_search->EndDate->EditValue ?>"<?php echo $bill_search->EndDate->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($bill_search->BalanceBF->Visible) { // BalanceBF ?>
	<div id="r_BalanceBF" class="form-group row">
		<label for="x_BalanceBF" class="<?php echo $bill_search->LeftColumnClass ?>"><span id="elh_bill_BalanceBF"><?php echo $bill_search->BalanceBF->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BalanceBF" id="z_BalanceBF" value="=">
</span>
		</label>
		<div class="<?php echo $bill_search->RightColumnClass ?>"><div <?php echo $bill_search->BalanceBF->cellAttributes() ?>>
			<span id="el_bill_BalanceBF" class="ew-search-field">
<input type="text" data-table="bill" data-field="x_BalanceBF" name="x_BalanceBF" id="x_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($bill_search->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $bill_search->BalanceBF->EditValue ?>"<?php echo $bill_search->BalanceBF->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($bill_search->AmountDue->Visible) { // AmountDue ?>
	<div id="r_AmountDue" class="form-group row">
		<label for="x_AmountDue" class="<?php echo $bill_search->LeftColumnClass ?>"><span id="elh_bill_AmountDue"><?php echo $bill_search->AmountDue->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_AmountDue" id="z_AmountDue" value="BETWEEN">
</span>
		</label>
		<div class="<?php echo $bill_search->RightColumnClass ?>"><div <?php echo $bill_search->AmountDue->cellAttributes() ?>>
			<span id="el_bill_AmountDue" class="ew-search-field">
<input type="text" data-table="bill" data-field="x_AmountDue" name="x_AmountDue" id="x_AmountDue" size="30" placeholder="<?php echo HtmlEncode($bill_search->AmountDue->getPlaceHolder()) ?>" value="<?php echo $bill_search->AmountDue->EditValue ?>"<?php echo $bill_search->AmountDue->editAttributes() ?>>
</span>
			<span class="ew-search-and"><label><?php echo $Language->phrase("AND") ?></label></span>
			<span id="el2_bill_AmountDue" class="ew-search-field2">
<input type="text" data-table="bill" data-field="x_AmountDue" name="y_AmountDue" id="y_AmountDue" size="30" placeholder="<?php echo HtmlEncode($bill_search->AmountDue->getPlaceHolder()) ?>" value="<?php echo $bill_search->AmountDue->EditValue2 ?>"<?php echo $bill_search->AmountDue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($bill_search->VAT->Visible) { // VAT ?>
	<div id="r_VAT" class="form-group row">
		<label for="x_VAT" class="<?php echo $bill_search->LeftColumnClass ?>"><span id="elh_bill_VAT"><?php echo $bill_search->VAT->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_VAT" id="z_VAT" value="=">
</span>
		</label>
		<div class="<?php echo $bill_search->RightColumnClass ?>"><div <?php echo $bill_search->VAT->cellAttributes() ?>>
			<span id="el_bill_VAT" class="ew-search-field">
<input type="text" data-table="bill" data-field="x_VAT" name="x_VAT" id="x_VAT" size="30" placeholder="<?php echo HtmlEncode($bill_search->VAT->getPlaceHolder()) ?>" value="<?php echo $bill_search->VAT->EditValue ?>"<?php echo $bill_search->VAT->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($bill_search->SalesTax->Visible) { // SalesTax ?>
	<div id="r_SalesTax" class="form-group row">
		<label for="x_SalesTax" class="<?php echo $bill_search->LeftColumnClass ?>"><span id="elh_bill_SalesTax"><?php echo $bill_search->SalesTax->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SalesTax" id="z_SalesTax" value="=">
</span>
		</label>
		<div class="<?php echo $bill_search->RightColumnClass ?>"><div <?php echo $bill_search->SalesTax->cellAttributes() ?>>
			<span id="el_bill_SalesTax" class="ew-search-field">
<input type="text" data-table="bill" data-field="x_SalesTax" name="x_SalesTax" id="x_SalesTax" size="30" placeholder="<?php echo HtmlEncode($bill_search->SalesTax->getPlaceHolder()) ?>" value="<?php echo $bill_search->SalesTax->EditValue ?>"<?php echo $bill_search->SalesTax->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($bill_search->AmountPaid->Visible) { // AmountPaid ?>
	<div id="r_AmountPaid" class="form-group row">
		<label for="x_AmountPaid" class="<?php echo $bill_search->LeftColumnClass ?>"><span id="elh_bill_AmountPaid"><?php echo $bill_search->AmountPaid->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AmountPaid" id="z_AmountPaid" value="=">
</span>
		</label>
		<div class="<?php echo $bill_search->RightColumnClass ?>"><div <?php echo $bill_search->AmountPaid->cellAttributes() ?>>
			<span id="el_bill_AmountPaid" class="ew-search-field">
<input type="text" data-table="bill" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($bill_search->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $bill_search->AmountPaid->EditValue ?>"<?php echo $bill_search->AmountPaid->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($bill_search->ReferenceNo->Visible) { // ReferenceNo ?>
	<div id="r_ReferenceNo" class="form-group row">
		<label for="x_ReferenceNo" class="<?php echo $bill_search->LeftColumnClass ?>"><span id="elh_bill_ReferenceNo"><?php echo $bill_search->ReferenceNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ReferenceNo" id="z_ReferenceNo" value="=">
</span>
		</label>
		<div class="<?php echo $bill_search->RightColumnClass ?>"><div <?php echo $bill_search->ReferenceNo->cellAttributes() ?>>
			<span id="el_bill_ReferenceNo" class="ew-search-field">
<input type="text" data-table="bill" data-field="x_ReferenceNo" name="x_ReferenceNo" id="x_ReferenceNo" size="30" placeholder="<?php echo HtmlEncode($bill_search->ReferenceNo->getPlaceHolder()) ?>" value="<?php echo $bill_search->ReferenceNo->EditValue ?>"<?php echo $bill_search->ReferenceNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$bill_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $bill_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$bill_search->showPageFooter();
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
$bill_search->terminate();
?>