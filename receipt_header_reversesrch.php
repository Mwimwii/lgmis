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
$receipt_header_reverse_search = new receipt_header_reverse_search();

// Run the page
$receipt_header_reverse_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$receipt_header_reverse_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var freceipt_header_reversesearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($receipt_header_reverse_search->IsModal) { ?>
	freceipt_header_reversesearch = currentAdvancedSearchForm = new ew.Form("freceipt_header_reversesearch", "search");
	<?php } else { ?>
	freceipt_header_reversesearch = currentForm = new ew.Form("freceipt_header_reversesearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	freceipt_header_reversesearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ReceiptNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_header_reverse_search->ReceiptNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ClientSerNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_header_reverse_search->ClientSerNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ReceiptDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_header_reverse_search->ReceiptDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_TotalDue");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_header_reverse_search->TotalDue->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_AmountTendered");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_header_reverse_search->AmountTendered->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Change");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_header_reverse_search->Change->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ReversalRef");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_header_reverse_search->ReversalRef->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	freceipt_header_reversesearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	freceipt_header_reversesearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	freceipt_header_reversesearch.lists["x_ReceiptNo"] = <?php echo $receipt_header_reverse_search->ReceiptNo->Lookup->toClientList($receipt_header_reverse_search) ?>;
	freceipt_header_reversesearch.lists["x_ReceiptNo"].options = <?php echo JsonEncode($receipt_header_reverse_search->ReceiptNo->lookupOptions()) ?>;
	freceipt_header_reversesearch.autoSuggests["x_ReceiptNo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	freceipt_header_reversesearch.lists["x_ClientSerNo"] = <?php echo $receipt_header_reverse_search->ClientSerNo->Lookup->toClientList($receipt_header_reverse_search) ?>;
	freceipt_header_reversesearch.lists["x_ClientSerNo"].options = <?php echo JsonEncode($receipt_header_reverse_search->ClientSerNo->lookupOptions()) ?>;
	freceipt_header_reversesearch.autoSuggests["x_ClientSerNo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	freceipt_header_reversesearch.lists["x_AccountBased[]"] = <?php echo $receipt_header_reverse_search->AccountBased->Lookup->toClientList($receipt_header_reverse_search) ?>;
	freceipt_header_reversesearch.lists["x_AccountBased[]"].options = <?php echo JsonEncode($receipt_header_reverse_search->AccountBased->options(FALSE, TRUE)) ?>;
	loadjs.done("freceipt_header_reversesearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $receipt_header_reverse_search->showPageHeader(); ?>
<?php
$receipt_header_reverse_search->showMessage();
?>
<form name="freceipt_header_reversesearch" id="freceipt_header_reversesearch" class="<?php echo $receipt_header_reverse_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="receipt_header_reverse">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$receipt_header_reverse_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($receipt_header_reverse_search->ReceiptNo->Visible) { // ReceiptNo ?>
	<div id="r_ReceiptNo" class="form-group row">
		<label class="<?php echo $receipt_header_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_header_reverse_ReceiptNo"><?php echo $receipt_header_reverse_search->ReceiptNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ReceiptNo" id="z_ReceiptNo" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_header_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_search->ReceiptNo->cellAttributes() ?>>
			<span id="el_receipt_header_reverse_ReceiptNo" class="ew-search-field">
<?php
$onchange = $receipt_header_reverse_search->ReceiptNo->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipt_header_reverse_search->ReceiptNo->EditAttrs["onchange"] = "";
?>
<span id="as_x_ReceiptNo">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ReceiptNo" id="sv_x_ReceiptNo" value="<?php echo RemoveHtml($receipt_header_reverse_search->ReceiptNo->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($receipt_header_reverse_search->ReceiptNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipt_header_reverse_search->ReceiptNo->getPlaceHolder()) ?>"<?php echo $receipt_header_reverse_search->ReceiptNo->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($receipt_header_reverse_search->ReceiptNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ReceiptNo',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($receipt_header_reverse_search->ReceiptNo->ReadOnly || $receipt_header_reverse_search->ReceiptNo->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="receipt_header_reverse" data-field="x_ReceiptNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $receipt_header_reverse_search->ReceiptNo->displayValueSeparatorAttribute() ?>" name="x_ReceiptNo" id="x_ReceiptNo" value="<?php echo HtmlEncode($receipt_header_reverse_search->ReceiptNo->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceipt_header_reversesearch"], function() {
	freceipt_header_reversesearch.createAutoSuggest({"id":"x_ReceiptNo","forceSelect":true});
});
</script>
<?php echo $receipt_header_reverse_search->ReceiptNo->Lookup->getParamTag($receipt_header_reverse_search, "p_x_ReceiptNo") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_search->ClientSerNo->Visible) { // ClientSerNo ?>
	<div id="r_ClientSerNo" class="form-group row">
		<label class="<?php echo $receipt_header_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_header_reverse_ClientSerNo"><?php echo $receipt_header_reverse_search->ClientSerNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ClientSerNo" id="z_ClientSerNo" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_header_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_search->ClientSerNo->cellAttributes() ?>>
			<span id="el_receipt_header_reverse_ClientSerNo" class="ew-search-field">
<?php
$onchange = $receipt_header_reverse_search->ClientSerNo->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipt_header_reverse_search->ClientSerNo->EditAttrs["onchange"] = "";
?>
<span id="as_x_ClientSerNo">
	<input type="text" class="form-control" name="sv_x_ClientSerNo" id="sv_x_ClientSerNo" value="<?php echo RemoveHtml($receipt_header_reverse_search->ClientSerNo->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($receipt_header_reverse_search->ClientSerNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipt_header_reverse_search->ClientSerNo->getPlaceHolder()) ?>"<?php echo $receipt_header_reverse_search->ClientSerNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt_header_reverse" data-field="x_ClientSerNo" data-value-separator="<?php echo $receipt_header_reverse_search->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x_ClientSerNo" id="x_ClientSerNo" value="<?php echo HtmlEncode($receipt_header_reverse_search->ClientSerNo->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceipt_header_reversesearch"], function() {
	freceipt_header_reversesearch.createAutoSuggest({"id":"x_ClientSerNo","forceSelect":true});
});
</script>
<?php echo $receipt_header_reverse_search->ClientSerNo->Lookup->getParamTag($receipt_header_reverse_search, "p_x_ClientSerNo") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_search->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label for="x_ClientID" class="<?php echo $receipt_header_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_header_reverse_ClientID"><?php echo $receipt_header_reverse_search->ClientID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ClientID" id="z_ClientID" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_header_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_search->ClientID->cellAttributes() ?>>
			<span id="el_receipt_header_reverse_ClientID" class="ew-search-field">
<input type="text" data-table="receipt_header_reverse" data-field="x_ClientID" name="x_ClientID" id="x_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($receipt_header_reverse_search->ClientID->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_search->ClientID->EditValue ?>"<?php echo $receipt_header_reverse_search->ClientID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_search->PaidBy->Visible) { // PaidBy ?>
	<div id="r_PaidBy" class="form-group row">
		<label for="x_PaidBy" class="<?php echo $receipt_header_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_header_reverse_PaidBy"><?php echo $receipt_header_reverse_search->PaidBy->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PaidBy" id="z_PaidBy" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_header_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_search->PaidBy->cellAttributes() ?>>
			<span id="el_receipt_header_reverse_PaidBy" class="ew-search-field">
<input type="text" data-table="receipt_header_reverse" data-field="x_PaidBy" name="x_PaidBy" id="x_PaidBy" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($receipt_header_reverse_search->PaidBy->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_search->PaidBy->EditValue ?>"<?php echo $receipt_header_reverse_search->PaidBy->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_search->ClientPostalAddress->Visible) { // ClientPostalAddress ?>
	<div id="r_ClientPostalAddress" class="form-group row">
		<label for="x_ClientPostalAddress" class="<?php echo $receipt_header_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_header_reverse_ClientPostalAddress"><?php echo $receipt_header_reverse_search->ClientPostalAddress->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ClientPostalAddress" id="z_ClientPostalAddress" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_header_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_search->ClientPostalAddress->cellAttributes() ?>>
			<span id="el_receipt_header_reverse_ClientPostalAddress" class="ew-search-field">
<input type="text" data-table="receipt_header_reverse" data-field="x_ClientPostalAddress" name="x_ClientPostalAddress" id="x_ClientPostalAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipt_header_reverse_search->ClientPostalAddress->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_search->ClientPostalAddress->EditValue ?>"<?php echo $receipt_header_reverse_search->ClientPostalAddress->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_search->ClientPhysicalAddress->Visible) { // ClientPhysicalAddress ?>
	<div id="r_ClientPhysicalAddress" class="form-group row">
		<label for="x_ClientPhysicalAddress" class="<?php echo $receipt_header_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_header_reverse_ClientPhysicalAddress"><?php echo $receipt_header_reverse_search->ClientPhysicalAddress->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ClientPhysicalAddress" id="z_ClientPhysicalAddress" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_header_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_search->ClientPhysicalAddress->cellAttributes() ?>>
			<span id="el_receipt_header_reverse_ClientPhysicalAddress" class="ew-search-field">
<input type="text" data-table="receipt_header_reverse" data-field="x_ClientPhysicalAddress" name="x_ClientPhysicalAddress" id="x_ClientPhysicalAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipt_header_reverse_search->ClientPhysicalAddress->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_search->ClientPhysicalAddress->EditValue ?>"<?php echo $receipt_header_reverse_search->ClientPhysicalAddress->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_search->ClientEmail->Visible) { // ClientEmail ?>
	<div id="r_ClientEmail" class="form-group row">
		<label for="x_ClientEmail" class="<?php echo $receipt_header_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_header_reverse_ClientEmail"><?php echo $receipt_header_reverse_search->ClientEmail->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ClientEmail" id="z_ClientEmail" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_header_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_search->ClientEmail->cellAttributes() ?>>
			<span id="el_receipt_header_reverse_ClientEmail" class="ew-search-field">
<input type="text" data-table="receipt_header_reverse" data-field="x_ClientEmail" name="x_ClientEmail" id="x_ClientEmail" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipt_header_reverse_search->ClientEmail->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_search->ClientEmail->EditValue ?>"<?php echo $receipt_header_reverse_search->ClientEmail->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_search->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label for="x_ChargeGroup" class="<?php echo $receipt_header_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_header_reverse_ChargeGroup"><?php echo $receipt_header_reverse_search->ChargeGroup->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ChargeGroup" id="z_ChargeGroup" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_header_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_search->ChargeGroup->cellAttributes() ?>>
			<span id="el_receipt_header_reverse_ChargeGroup" class="ew-search-field">
<input type="text" data-table="receipt_header_reverse" data-field="x_ChargeGroup" name="x_ChargeGroup" id="x_ChargeGroup" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($receipt_header_reverse_search->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_search->ChargeGroup->EditValue ?>"<?php echo $receipt_header_reverse_search->ChargeGroup->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_search->ReceiptPrefix->Visible) { // ReceiptPrefix ?>
	<div id="r_ReceiptPrefix" class="form-group row">
		<label for="x_ReceiptPrefix" class="<?php echo $receipt_header_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_header_reverse_ReceiptPrefix"><?php echo $receipt_header_reverse_search->ReceiptPrefix->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ReceiptPrefix" id="z_ReceiptPrefix" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_header_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_search->ReceiptPrefix->cellAttributes() ?>>
			<span id="el_receipt_header_reverse_ReceiptPrefix" class="ew-search-field">
<input type="text" data-table="receipt_header_reverse" data-field="x_ReceiptPrefix" name="x_ReceiptPrefix" id="x_ReceiptPrefix" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($receipt_header_reverse_search->ReceiptPrefix->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_search->ReceiptPrefix->EditValue ?>"<?php echo $receipt_header_reverse_search->ReceiptPrefix->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_search->AccountBased->Visible) { // AccountBased ?>
	<div id="r_AccountBased" class="form-group row">
		<label class="<?php echo $receipt_header_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_header_reverse_AccountBased"><?php echo $receipt_header_reverse_search->AccountBased->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AccountBased" id="z_AccountBased" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_header_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_search->AccountBased->cellAttributes() ?>>
			<span id="el_receipt_header_reverse_AccountBased" class="ew-search-field">
<?php
$selwrk = ConvertToBool($receipt_header_reverse_search->AccountBased->AdvancedSearch->SearchValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="receipt_header_reverse" data-field="x_AccountBased" name="x_AccountBased[]" id="x_AccountBased[]_960698" value="1"<?php echo $selwrk ?><?php echo $receipt_header_reverse_search->AccountBased->editAttributes() ?>>
	<label class="custom-control-label" for="x_AccountBased[]_960698"></label>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_search->Cashier->Visible) { // Cashier ?>
	<div id="r_Cashier" class="form-group row">
		<label for="x_Cashier" class="<?php echo $receipt_header_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_header_reverse_Cashier"><?php echo $receipt_header_reverse_search->Cashier->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Cashier" id="z_Cashier" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_header_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_search->Cashier->cellAttributes() ?>>
			<span id="el_receipt_header_reverse_Cashier" class="ew-search-field">
<input type="text" data-table="receipt_header_reverse" data-field="x_Cashier" name="x_Cashier" id="x_Cashier" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipt_header_reverse_search->Cashier->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_search->Cashier->EditValue ?>"<?php echo $receipt_header_reverse_search->Cashier->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_search->ReceiptDate->Visible) { // ReceiptDate ?>
	<div id="r_ReceiptDate" class="form-group row">
		<label for="x_ReceiptDate" class="<?php echo $receipt_header_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_header_reverse_ReceiptDate"><?php echo $receipt_header_reverse_search->ReceiptDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ReceiptDate" id="z_ReceiptDate" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_header_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_search->ReceiptDate->cellAttributes() ?>>
			<span id="el_receipt_header_reverse_ReceiptDate" class="ew-search-field">
<input type="text" data-table="receipt_header_reverse" data-field="x_ReceiptDate" name="x_ReceiptDate" id="x_ReceiptDate" maxlength="19" placeholder="<?php echo HtmlEncode($receipt_header_reverse_search->ReceiptDate->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_search->ReceiptDate->EditValue ?>"<?php echo $receipt_header_reverse_search->ReceiptDate->editAttributes() ?>>
<?php if (!$receipt_header_reverse_search->ReceiptDate->ReadOnly && !$receipt_header_reverse_search->ReceiptDate->Disabled && !isset($receipt_header_reverse_search->ReceiptDate->EditAttrs["readonly"]) && !isset($receipt_header_reverse_search->ReceiptDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freceipt_header_reversesearch", "datetimepicker"], function() {
	ew.createDateTimePicker("freceipt_header_reversesearch", "x_ReceiptDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_search->PaymentMethod->Visible) { // PaymentMethod ?>
	<div id="r_PaymentMethod" class="form-group row">
		<label for="x_PaymentMethod" class="<?php echo $receipt_header_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_header_reverse_PaymentMethod"><?php echo $receipt_header_reverse_search->PaymentMethod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PaymentMethod" id="z_PaymentMethod" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_header_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_search->PaymentMethod->cellAttributes() ?>>
			<span id="el_receipt_header_reverse_PaymentMethod" class="ew-search-field">
<input type="text" data-table="receipt_header_reverse" data-field="x_PaymentMethod" name="x_PaymentMethod" id="x_PaymentMethod" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($receipt_header_reverse_search->PaymentMethod->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_search->PaymentMethod->EditValue ?>"<?php echo $receipt_header_reverse_search->PaymentMethod->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_search->TotalDue->Visible) { // TotalDue ?>
	<div id="r_TotalDue" class="form-group row">
		<label for="x_TotalDue" class="<?php echo $receipt_header_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_header_reverse_TotalDue"><?php echo $receipt_header_reverse_search->TotalDue->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_TotalDue" id="z_TotalDue" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_header_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_search->TotalDue->cellAttributes() ?>>
			<span id="el_receipt_header_reverse_TotalDue" class="ew-search-field">
<input type="text" data-table="receipt_header_reverse" data-field="x_TotalDue" name="x_TotalDue" id="x_TotalDue" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($receipt_header_reverse_search->TotalDue->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_search->TotalDue->EditValue ?>"<?php echo $receipt_header_reverse_search->TotalDue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_search->AmountTendered->Visible) { // AmountTendered ?>
	<div id="r_AmountTendered" class="form-group row">
		<label for="x_AmountTendered" class="<?php echo $receipt_header_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_header_reverse_AmountTendered"><?php echo $receipt_header_reverse_search->AmountTendered->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AmountTendered" id="z_AmountTendered" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_header_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_search->AmountTendered->cellAttributes() ?>>
			<span id="el_receipt_header_reverse_AmountTendered" class="ew-search-field">
<input type="text" data-table="receipt_header_reverse" data-field="x_AmountTendered" name="x_AmountTendered" id="x_AmountTendered" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($receipt_header_reverse_search->AmountTendered->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_search->AmountTendered->EditValue ?>"<?php echo $receipt_header_reverse_search->AmountTendered->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_search->Change->Visible) { // Change ?>
	<div id="r_Change" class="form-group row">
		<label for="x_Change" class="<?php echo $receipt_header_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_header_reverse_Change"><?php echo $receipt_header_reverse_search->Change->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Change" id="z_Change" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_header_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_search->Change->cellAttributes() ?>>
			<span id="el_receipt_header_reverse_Change" class="ew-search-field">
<input type="text" data-table="receipt_header_reverse" data-field="x_Change" name="x_Change" id="x_Change" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($receipt_header_reverse_search->Change->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_search->Change->EditValue ?>"<?php echo $receipt_header_reverse_search->Change->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_search->ClientMessage->Visible) { // ClientMessage ?>
	<div id="r_ClientMessage" class="form-group row">
		<label for="x_ClientMessage" class="<?php echo $receipt_header_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_header_reverse_ClientMessage"><?php echo $receipt_header_reverse_search->ClientMessage->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ClientMessage" id="z_ClientMessage" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_header_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_search->ClientMessage->cellAttributes() ?>>
			<span id="el_receipt_header_reverse_ClientMessage" class="ew-search-field">
<input type="text" data-table="receipt_header_reverse" data-field="x_ClientMessage" name="x_ClientMessage" id="x_ClientMessage" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipt_header_reverse_search->ClientMessage->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_search->ClientMessage->EditValue ?>"<?php echo $receipt_header_reverse_search->ClientMessage->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_search->Reasons->Visible) { // Reasons ?>
	<div id="r_Reasons" class="form-group row">
		<label for="x_Reasons" class="<?php echo $receipt_header_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_header_reverse_Reasons"><?php echo $receipt_header_reverse_search->Reasons->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Reasons" id="z_Reasons" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_header_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_search->Reasons->cellAttributes() ?>>
			<span id="el_receipt_header_reverse_Reasons" class="ew-search-field">
<input type="text" data-table="receipt_header_reverse" data-field="x_Reasons" name="x_Reasons" id="x_Reasons" size="35" maxlength="65535" placeholder="<?php echo HtmlEncode($receipt_header_reverse_search->Reasons->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_search->Reasons->EditValue ?>"<?php echo $receipt_header_reverse_search->Reasons->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_search->ReversalRef->Visible) { // ReversalRef ?>
	<div id="r_ReversalRef" class="form-group row">
		<label for="x_ReversalRef" class="<?php echo $receipt_header_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_header_reverse_ReversalRef"><?php echo $receipt_header_reverse_search->ReversalRef->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ReversalRef" id="z_ReversalRef" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_header_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_search->ReversalRef->cellAttributes() ?>>
			<span id="el_receipt_header_reverse_ReversalRef" class="ew-search-field">
<input type="text" data-table="receipt_header_reverse" data-field="x_ReversalRef" name="x_ReversalRef" id="x_ReversalRef" maxlength="11" placeholder="<?php echo HtmlEncode($receipt_header_reverse_search->ReversalRef->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_search->ReversalRef->EditValue ?>"<?php echo $receipt_header_reverse_search->ReversalRef->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$receipt_header_reverse_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $receipt_header_reverse_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$receipt_header_reverse_search->showPageFooter();
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
$receipt_header_reverse_search->terminate();
?>