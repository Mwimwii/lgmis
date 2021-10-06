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
$receipt_search = new receipt_search();

// Run the page
$receipt_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$receipt_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var freceiptsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($receipt_search->IsModal) { ?>
	freceiptsearch = currentAdvancedSearchForm = new ew.Form("freceiptsearch", "search");
	<?php } else { ?>
	freceiptsearch = currentForm = new ew.Form("freceiptsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	freceiptsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_UnitCost");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_search->UnitCost->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Quantity");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_search->Quantity->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_AmountPaid");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_search->AmountPaid->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ReceiptDate");
		if (elm && !ew.checkEuroDate(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_search->ReceiptDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_LastUpdateDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_search->LastUpdateDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BillPeriod");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_search->BillPeriod->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BillYear");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_search->BillYear->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	freceiptsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	freceiptsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	freceiptsearch.lists["x_ClientSerNo"] = <?php echo $receipt_search->ClientSerNo->Lookup->toClientList($receipt_search) ?>;
	freceiptsearch.lists["x_ClientSerNo"].options = <?php echo JsonEncode($receipt_search->ClientSerNo->lookupOptions()) ?>;
	freceiptsearch.lists["x_ChargeCode"] = <?php echo $receipt_search->ChargeCode->Lookup->toClientList($receipt_search) ?>;
	freceiptsearch.lists["x_ChargeCode"].options = <?php echo JsonEncode($receipt_search->ChargeCode->lookupOptions()) ?>;
	freceiptsearch.autoSuggests["x_ChargeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	freceiptsearch.lists["x_PaymentMethod"] = <?php echo $receipt_search->PaymentMethod->Lookup->toClientList($receipt_search) ?>;
	freceiptsearch.lists["x_PaymentMethod"].options = <?php echo JsonEncode($receipt_search->PaymentMethod->lookupOptions()) ?>;
	loadjs.done("freceiptsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $receipt_search->showPageHeader(); ?>
<?php
$receipt_search->showMessage();
?>
<form name="freceiptsearch" id="freceiptsearch" class="<?php echo $receipt_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="receipt">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$receipt_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($receipt_search->ClientSerNo->Visible) { // ClientSerNo ?>
	<div id="r_ClientSerNo" class="form-group row">
		<label for="x_ClientSerNo" class="<?php echo $receipt_search->LeftColumnClass ?>"><span id="elh_receipt_ClientSerNo"><?php echo $receipt_search->ClientSerNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ClientSerNo" id="z_ClientSerNo" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_search->RightColumnClass ?>"><div <?php echo $receipt_search->ClientSerNo->cellAttributes() ?>>
			<span id="el_receipt_ClientSerNo" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ClientSerNo"><?php echo EmptyValue(strval($receipt_search->ClientSerNo->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $receipt_search->ClientSerNo->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($receipt_search->ClientSerNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($receipt_search->ClientSerNo->ReadOnly || $receipt_search->ClientSerNo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ClientSerNo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $receipt_search->ClientSerNo->Lookup->getParamTag($receipt_search, "p_x_ClientSerNo") ?>
<input type="hidden" data-table="receipt" data-field="x_ClientSerNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $receipt_search->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x_ClientSerNo" id="x_ClientSerNo" value="<?php echo $receipt_search->ClientSerNo->AdvancedSearch->SearchValue ?>"<?php echo $receipt_search->ClientSerNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_search->ChargeCode->Visible) { // ChargeCode ?>
	<div id="r_ChargeCode" class="form-group row">
		<label class="<?php echo $receipt_search->LeftColumnClass ?>"><span id="elh_receipt_ChargeCode"><?php echo $receipt_search->ChargeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ChargeCode" id="z_ChargeCode" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_search->RightColumnClass ?>"><div <?php echo $receipt_search->ChargeCode->cellAttributes() ?>>
			<span id="el_receipt_ChargeCode" class="ew-search-field">
<?php
$onchange = $receipt_search->ChargeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipt_search->ChargeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ChargeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ChargeCode" id="sv_x_ChargeCode" value="<?php echo RemoveHtml($receipt_search->ChargeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($receipt_search->ChargeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipt_search->ChargeCode->getPlaceHolder()) ?>"<?php echo $receipt_search->ChargeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($receipt_search->ChargeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($receipt_search->ChargeCode->ReadOnly || $receipt_search->ChargeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="receipt" data-field="x_ChargeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $receipt_search->ChargeCode->displayValueSeparatorAttribute() ?>" name="x_ChargeCode" id="x_ChargeCode" value="<?php echo HtmlEncode($receipt_search->ChargeCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceiptsearch"], function() {
	freceiptsearch.createAutoSuggest({"id":"x_ChargeCode","forceSelect":false});
});
</script>
<?php echo $receipt_search->ChargeCode->Lookup->getParamTag($receipt_search, "p_x_ChargeCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_search->ItemID->Visible) { // ItemID ?>
	<div id="r_ItemID" class="form-group row">
		<label for="x_ItemID" class="<?php echo $receipt_search->LeftColumnClass ?>"><span id="elh_receipt_ItemID"><?php echo $receipt_search->ItemID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ItemID" id="z_ItemID" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_search->RightColumnClass ?>"><div <?php echo $receipt_search->ItemID->cellAttributes() ?>>
			<span id="el_receipt_ItemID" class="ew-search-field">
<input type="text" data-table="receipt" data-field="x_ItemID" name="x_ItemID" id="x_ItemID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($receipt_search->ItemID->getPlaceHolder()) ?>" value="<?php echo $receipt_search->ItemID->EditValue ?>"<?php echo $receipt_search->ItemID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_search->UnitCost->Visible) { // UnitCost ?>
	<div id="r_UnitCost" class="form-group row">
		<label for="x_UnitCost" class="<?php echo $receipt_search->LeftColumnClass ?>"><span id="elh_receipt_UnitCost"><?php echo $receipt_search->UnitCost->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_UnitCost" id="z_UnitCost" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_search->RightColumnClass ?>"><div <?php echo $receipt_search->UnitCost->cellAttributes() ?>>
			<span id="el_receipt_UnitCost" class="ew-search-field">
<input type="text" data-table="receipt" data-field="x_UnitCost" name="x_UnitCost" id="x_UnitCost" size="30" placeholder="<?php echo HtmlEncode($receipt_search->UnitCost->getPlaceHolder()) ?>" value="<?php echo $receipt_search->UnitCost->EditValue ?>"<?php echo $receipt_search->UnitCost->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_search->Quantity->Visible) { // Quantity ?>
	<div id="r_Quantity" class="form-group row">
		<label for="x_Quantity" class="<?php echo $receipt_search->LeftColumnClass ?>"><span id="elh_receipt_Quantity"><?php echo $receipt_search->Quantity->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Quantity" id="z_Quantity" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_search->RightColumnClass ?>"><div <?php echo $receipt_search->Quantity->cellAttributes() ?>>
			<span id="el_receipt_Quantity" class="ew-search-field">
<input type="text" data-table="receipt" data-field="x_Quantity" name="x_Quantity" id="x_Quantity" size="30" placeholder="<?php echo HtmlEncode($receipt_search->Quantity->getPlaceHolder()) ?>" value="<?php echo $receipt_search->Quantity->EditValue ?>"<?php echo $receipt_search->Quantity->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_search->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<div id="r_UnitOfMeasure" class="form-group row">
		<label for="x_UnitOfMeasure" class="<?php echo $receipt_search->LeftColumnClass ?>"><span id="elh_receipt_UnitOfMeasure"><?php echo $receipt_search->UnitOfMeasure->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_UnitOfMeasure" id="z_UnitOfMeasure" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_search->RightColumnClass ?>"><div <?php echo $receipt_search->UnitOfMeasure->cellAttributes() ?>>
			<span id="el_receipt_UnitOfMeasure" class="ew-search-field">
<input type="text" data-table="receipt" data-field="x_UnitOfMeasure" name="x_UnitOfMeasure" id="x_UnitOfMeasure" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($receipt_search->UnitOfMeasure->getPlaceHolder()) ?>" value="<?php echo $receipt_search->UnitOfMeasure->EditValue ?>"<?php echo $receipt_search->UnitOfMeasure->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_search->AmountPaid->Visible) { // AmountPaid ?>
	<div id="r_AmountPaid" class="form-group row">
		<label for="x_AmountPaid" class="<?php echo $receipt_search->LeftColumnClass ?>"><span id="elh_receipt_AmountPaid"><?php echo $receipt_search->AmountPaid->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AmountPaid" id="z_AmountPaid" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_search->RightColumnClass ?>"><div <?php echo $receipt_search->AmountPaid->cellAttributes() ?>>
			<span id="el_receipt_AmountPaid" class="ew-search-field">
<input type="text" data-table="receipt" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($receipt_search->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $receipt_search->AmountPaid->EditValue ?>"<?php echo $receipt_search->AmountPaid->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_search->ReceiptNo->Visible) { // ReceiptNo ?>
	<div id="r_ReceiptNo" class="form-group row">
		<label for="x_ReceiptNo" class="<?php echo $receipt_search->LeftColumnClass ?>"><span id="elh_receipt_ReceiptNo"><?php echo $receipt_search->ReceiptNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ReceiptNo" id="z_ReceiptNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_search->RightColumnClass ?>"><div <?php echo $receipt_search->ReceiptNo->cellAttributes() ?>>
			<span id="el_receipt_ReceiptNo" class="ew-search-field">
<input type="text" data-table="receipt" data-field="x_ReceiptNo" name="x_ReceiptNo" id="x_ReceiptNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($receipt_search->ReceiptNo->getPlaceHolder()) ?>" value="<?php echo $receipt_search->ReceiptNo->EditValue ?>"<?php echo $receipt_search->ReceiptNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_search->ReceiptDate->Visible) { // ReceiptDate ?>
	<div id="r_ReceiptDate" class="form-group row">
		<label for="x_ReceiptDate" class="<?php echo $receipt_search->LeftColumnClass ?>"><span id="elh_receipt_ReceiptDate"><?php echo $receipt_search->ReceiptDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_ReceiptDate" id="z_ReceiptDate" value="BETWEEN">
</span>
		</label>
		<div class="<?php echo $receipt_search->RightColumnClass ?>"><div <?php echo $receipt_search->ReceiptDate->cellAttributes() ?>>
			<span id="el_receipt_ReceiptDate" class="ew-search-field">
<input type="text" data-table="receipt" data-field="x_ReceiptDate" data-format="7" name="x_ReceiptDate" id="x_ReceiptDate" placeholder="<?php echo HtmlEncode($receipt_search->ReceiptDate->getPlaceHolder()) ?>" value="<?php echo $receipt_search->ReceiptDate->EditValue ?>"<?php echo $receipt_search->ReceiptDate->editAttributes() ?>>
<?php if (!$receipt_search->ReceiptDate->ReadOnly && !$receipt_search->ReceiptDate->Disabled && !isset($receipt_search->ReceiptDate->EditAttrs["readonly"]) && !isset($receipt_search->ReceiptDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freceiptsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("freceiptsearch", "x_ReceiptDate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
			<span class="ew-search-and"><label><?php echo $Language->phrase("AND") ?></label></span>
			<span id="el2_receipt_ReceiptDate" class="ew-search-field2">
<input type="text" data-table="receipt" data-field="x_ReceiptDate" data-format="7" name="y_ReceiptDate" id="y_ReceiptDate" placeholder="<?php echo HtmlEncode($receipt_search->ReceiptDate->getPlaceHolder()) ?>" value="<?php echo $receipt_search->ReceiptDate->EditValue2 ?>"<?php echo $receipt_search->ReceiptDate->editAttributes() ?>>
<?php if (!$receipt_search->ReceiptDate->ReadOnly && !$receipt_search->ReceiptDate->Disabled && !isset($receipt_search->ReceiptDate->EditAttrs["readonly"]) && !isset($receipt_search->ReceiptDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freceiptsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("freceiptsearch", "y_ReceiptDate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_search->PaymentMethod->Visible) { // PaymentMethod ?>
	<div id="r_PaymentMethod" class="form-group row">
		<label for="x_PaymentMethod" class="<?php echo $receipt_search->LeftColumnClass ?>"><span id="elh_receipt_PaymentMethod"><?php echo $receipt_search->PaymentMethod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PaymentMethod" id="z_PaymentMethod" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_search->RightColumnClass ?>"><div <?php echo $receipt_search->PaymentMethod->cellAttributes() ?>>
			<span id="el_receipt_PaymentMethod" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="receipt" data-field="x_PaymentMethod" data-value-separator="<?php echo $receipt_search->PaymentMethod->displayValueSeparatorAttribute() ?>" id="x_PaymentMethod" name="x_PaymentMethod"<?php echo $receipt_search->PaymentMethod->editAttributes() ?>>
			<?php echo $receipt_search->PaymentMethod->selectOptionListHtml("x_PaymentMethod") ?>
		</select>
</div>
<?php echo $receipt_search->PaymentMethod->Lookup->getParamTag($receipt_search, "p_x_PaymentMethod") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_search->PaymentRef->Visible) { // PaymentRef ?>
	<div id="r_PaymentRef" class="form-group row">
		<label for="x_PaymentRef" class="<?php echo $receipt_search->LeftColumnClass ?>"><span id="elh_receipt_PaymentRef"><?php echo $receipt_search->PaymentRef->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PaymentRef" id="z_PaymentRef" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_search->RightColumnClass ?>"><div <?php echo $receipt_search->PaymentRef->cellAttributes() ?>>
			<span id="el_receipt_PaymentRef" class="ew-search-field">
<input type="text" data-table="receipt" data-field="x_PaymentRef" name="x_PaymentRef" id="x_PaymentRef" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipt_search->PaymentRef->getPlaceHolder()) ?>" value="<?php echo $receipt_search->PaymentRef->EditValue ?>"<?php echo $receipt_search->PaymentRef->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_search->AdditionalInformation->Visible) { // AdditionalInformation ?>
	<div id="r_AdditionalInformation" class="form-group row">
		<label for="x_AdditionalInformation" class="<?php echo $receipt_search->LeftColumnClass ?>"><span id="elh_receipt_AdditionalInformation"><?php echo $receipt_search->AdditionalInformation->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AdditionalInformation" id="z_AdditionalInformation" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_search->RightColumnClass ?>"><div <?php echo $receipt_search->AdditionalInformation->cellAttributes() ?>>
			<span id="el_receipt_AdditionalInformation" class="ew-search-field">
<input type="text" data-table="receipt" data-field="x_AdditionalInformation" name="x_AdditionalInformation" id="x_AdditionalInformation" size="35" placeholder="<?php echo HtmlEncode($receipt_search->AdditionalInformation->getPlaceHolder()) ?>" value="<?php echo $receipt_search->AdditionalInformation->EditValue ?>"<?php echo $receipt_search->AdditionalInformation->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_search->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<div id="r_LastUpdatedBy" class="form-group row">
		<label for="x_LastUpdatedBy" class="<?php echo $receipt_search->LeftColumnClass ?>"><span id="elh_receipt_LastUpdatedBy"><?php echo $receipt_search->LastUpdatedBy->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LastUpdatedBy" id="z_LastUpdatedBy" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_search->RightColumnClass ?>"><div <?php echo $receipt_search->LastUpdatedBy->cellAttributes() ?>>
			<span id="el_receipt_LastUpdatedBy" class="ew-search-field">
<input type="text" data-table="receipt" data-field="x_LastUpdatedBy" name="x_LastUpdatedBy" id="x_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($receipt_search->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $receipt_search->LastUpdatedBy->EditValue ?>"<?php echo $receipt_search->LastUpdatedBy->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_search->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<div id="r_LastUpdateDate" class="form-group row">
		<label for="x_LastUpdateDate" class="<?php echo $receipt_search->LeftColumnClass ?>"><span id="elh_receipt_LastUpdateDate"><?php echo $receipt_search->LastUpdateDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LastUpdateDate" id="z_LastUpdateDate" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_search->RightColumnClass ?>"><div <?php echo $receipt_search->LastUpdateDate->cellAttributes() ?>>
			<span id="el_receipt_LastUpdateDate" class="ew-search-field">
<input type="text" data-table="receipt" data-field="x_LastUpdateDate" name="x_LastUpdateDate" id="x_LastUpdateDate" placeholder="<?php echo HtmlEncode($receipt_search->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $receipt_search->LastUpdateDate->EditValue ?>"<?php echo $receipt_search->LastUpdateDate->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_search->CashierNo->Visible) { // CashierNo ?>
	<div id="r_CashierNo" class="form-group row">
		<label for="x_CashierNo" class="<?php echo $receipt_search->LeftColumnClass ?>"><span id="elh_receipt_CashierNo"><?php echo $receipt_search->CashierNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_CashierNo" id="z_CashierNo" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_search->RightColumnClass ?>"><div <?php echo $receipt_search->CashierNo->cellAttributes() ?>>
			<span id="el_receipt_CashierNo" class="ew-search-field">
<input type="text" data-table="receipt" data-field="x_CashierNo" name="x_CashierNo" id="x_CashierNo" size="30" placeholder="<?php echo HtmlEncode($receipt_search->CashierNo->getPlaceHolder()) ?>" value="<?php echo $receipt_search->CashierNo->EditValue ?>"<?php echo $receipt_search->CashierNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_search->BillPeriod->Visible) { // BillPeriod ?>
	<div id="r_BillPeriod" class="form-group row">
		<label for="x_BillPeriod" class="<?php echo $receipt_search->LeftColumnClass ?>"><span id="elh_receipt_BillPeriod"><?php echo $receipt_search->BillPeriod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillPeriod" id="z_BillPeriod" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_search->RightColumnClass ?>"><div <?php echo $receipt_search->BillPeriod->cellAttributes() ?>>
			<span id="el_receipt_BillPeriod" class="ew-search-field">
<input type="text" data-table="receipt" data-field="x_BillPeriod" name="x_BillPeriod" id="x_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($receipt_search->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $receipt_search->BillPeriod->EditValue ?>"<?php echo $receipt_search->BillPeriod->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_search->BillYear->Visible) { // BillYear ?>
	<div id="r_BillYear" class="form-group row">
		<label for="x_BillYear" class="<?php echo $receipt_search->LeftColumnClass ?>"><span id="elh_receipt_BillYear"><?php echo $receipt_search->BillYear->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillYear" id="z_BillYear" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_search->RightColumnClass ?>"><div <?php echo $receipt_search->BillYear->cellAttributes() ?>>
			<span id="el_receipt_BillYear" class="ew-search-field">
<input type="text" data-table="receipt" data-field="x_BillYear" name="x_BillYear" id="x_BillYear" size="30" placeholder="<?php echo HtmlEncode($receipt_search->BillYear->getPlaceHolder()) ?>" value="<?php echo $receipt_search->BillYear->EditValue ?>"<?php echo $receipt_search->BillYear->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_search->PaymentFor->Visible) { // PaymentFor ?>
	<div id="r_PaymentFor" class="form-group row">
		<label for="x_PaymentFor" class="<?php echo $receipt_search->LeftColumnClass ?>"><span id="elh_receipt_PaymentFor"><?php echo $receipt_search->PaymentFor->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PaymentFor" id="z_PaymentFor" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_search->RightColumnClass ?>"><div <?php echo $receipt_search->PaymentFor->cellAttributes() ?>>
			<span id="el_receipt_PaymentFor" class="ew-search-field">
<input type="text" data-table="receipt" data-field="x_PaymentFor" name="x_PaymentFor" id="x_PaymentFor" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($receipt_search->PaymentFor->getPlaceHolder()) ?>" value="<?php echo $receipt_search->PaymentFor->EditValue ?>"<?php echo $receipt_search->PaymentFor->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_search->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label for="x_ChargeGroup" class="<?php echo $receipt_search->LeftColumnClass ?>"><span id="elh_receipt_ChargeGroup"><?php echo $receipt_search->ChargeGroup->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ChargeGroup" id="z_ChargeGroup" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_search->RightColumnClass ?>"><div <?php echo $receipt_search->ChargeGroup->cellAttributes() ?>>
			<span id="el_receipt_ChargeGroup" class="ew-search-field">
<input type="text" data-table="receipt" data-field="x_ChargeGroup" name="x_ChargeGroup" id="x_ChargeGroup" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($receipt_search->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $receipt_search->ChargeGroup->EditValue ?>"<?php echo $receipt_search->ChargeGroup->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_search->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label for="x_ClientID" class="<?php echo $receipt_search->LeftColumnClass ?>"><span id="elh_receipt_ClientID"><?php echo $receipt_search->ClientID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ClientID" id="z_ClientID" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_search->RightColumnClass ?>"><div <?php echo $receipt_search->ClientID->cellAttributes() ?>>
			<span id="el_receipt_ClientID" class="ew-search-field">
<input type="text" data-table="receipt" data-field="x_ClientID" name="x_ClientID" id="x_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($receipt_search->ClientID->getPlaceHolder()) ?>" value="<?php echo $receipt_search->ClientID->EditValue ?>"<?php echo $receipt_search->ClientID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_search->PrintedReceipt->Visible) { // PrintedReceipt ?>
	<div id="r_PrintedReceipt" class="form-group row">
		<label for="x_PrintedReceipt" class="<?php echo $receipt_search->LeftColumnClass ?>"><span id="elh_receipt_PrintedReceipt"><?php echo $receipt_search->PrintedReceipt->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PrintedReceipt" id="z_PrintedReceipt" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_search->RightColumnClass ?>"><div <?php echo $receipt_search->PrintedReceipt->cellAttributes() ?>>
			<span id="el_receipt_PrintedReceipt" class="ew-search-field">
<input type="text" data-table="receipt" data-field="x_PrintedReceipt" name="x_PrintedReceipt" id="x_PrintedReceipt" size="35" placeholder="<?php echo HtmlEncode($receipt_search->PrintedReceipt->getPlaceHolder()) ?>" value="<?php echo $receipt_search->PrintedReceipt->EditValue ?>"<?php echo $receipt_search->PrintedReceipt->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$receipt_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $receipt_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$receipt_search->showPageFooter();
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
$receipt_search->terminate();
?>