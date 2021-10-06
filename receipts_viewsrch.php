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
$receipts_view_search = new receipts_view_search();

// Run the page
$receipts_view_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$receipts_view_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var freceipts_viewsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($receipts_view_search->IsModal) { ?>
	freceipts_viewsearch = currentAdvancedSearchForm = new ew.Form("freceipts_viewsearch", "search");
	<?php } else { ?>
	freceipts_viewsearch = currentForm = new ew.Form("freceipts_viewsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	freceipts_viewsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ReceiptNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipts_view_search->ReceiptNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ClientSerNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipts_view_search->ClientSerNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ChargeCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipts_view_search->ChargeCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ReceiptDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipts_view_search->ReceiptDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_UnitCost");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipts_view_search->UnitCost->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Quantity");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipts_view_search->Quantity->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_AmountPaid");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipts_view_search->AmountPaid->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BillPeriod");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipts_view_search->BillPeriod->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BillYear");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipts_view_search->BillYear->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	freceipts_viewsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	freceipts_viewsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	freceipts_viewsearch.lists["x_ClientSerNo"] = <?php echo $receipts_view_search->ClientSerNo->Lookup->toClientList($receipts_view_search) ?>;
	freceipts_viewsearch.lists["x_ClientSerNo"].options = <?php echo JsonEncode($receipts_view_search->ClientSerNo->lookupOptions()) ?>;
	freceipts_viewsearch.autoSuggests["x_ClientSerNo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	freceipts_viewsearch.lists["x_ChargeCode"] = <?php echo $receipts_view_search->ChargeCode->Lookup->toClientList($receipts_view_search) ?>;
	freceipts_viewsearch.lists["x_ChargeCode"].options = <?php echo JsonEncode($receipts_view_search->ChargeCode->lookupOptions()) ?>;
	freceipts_viewsearch.autoSuggests["x_ChargeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	freceipts_viewsearch.lists["x_PaymentMethod"] = <?php echo $receipts_view_search->PaymentMethod->Lookup->toClientList($receipts_view_search) ?>;
	freceipts_viewsearch.lists["x_PaymentMethod"].options = <?php echo JsonEncode($receipts_view_search->PaymentMethod->lookupOptions()) ?>;
	freceipts_viewsearch.autoSuggests["x_PaymentMethod"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("freceipts_viewsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $receipts_view_search->showPageHeader(); ?>
<?php
$receipts_view_search->showMessage();
?>
<form name="freceipts_viewsearch" id="freceipts_viewsearch" class="<?php echo $receipts_view_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="receipts_view">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$receipts_view_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($receipts_view_search->ReceiptNo->Visible) { // ReceiptNo ?>
	<div id="r_ReceiptNo" class="form-group row">
		<label for="x_ReceiptNo" class="<?php echo $receipts_view_search->LeftColumnClass ?>"><span id="elh_receipts_view_ReceiptNo"><?php echo $receipts_view_search->ReceiptNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ReceiptNo" id="z_ReceiptNo" value="=">
</span>
		</label>
		<div class="<?php echo $receipts_view_search->RightColumnClass ?>"><div <?php echo $receipts_view_search->ReceiptNo->cellAttributes() ?>>
			<span id="el_receipts_view_ReceiptNo" class="ew-search-field">
<input type="text" data-table="receipts_view" data-field="x_ReceiptNo" name="x_ReceiptNo" id="x_ReceiptNo" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($receipts_view_search->ReceiptNo->getPlaceHolder()) ?>" value="<?php echo $receipts_view_search->ReceiptNo->EditValue ?>"<?php echo $receipts_view_search->ReceiptNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipts_view_search->ClientSerNo->Visible) { // ClientSerNo ?>
	<div id="r_ClientSerNo" class="form-group row">
		<label class="<?php echo $receipts_view_search->LeftColumnClass ?>"><span id="elh_receipts_view_ClientSerNo"><?php echo $receipts_view_search->ClientSerNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ClientSerNo" id="z_ClientSerNo" value="=">
</span>
		</label>
		<div class="<?php echo $receipts_view_search->RightColumnClass ?>"><div <?php echo $receipts_view_search->ClientSerNo->cellAttributes() ?>>
			<span id="el_receipts_view_ClientSerNo" class="ew-search-field">
<?php
$onchange = $receipts_view_search->ClientSerNo->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipts_view_search->ClientSerNo->EditAttrs["onchange"] = "";
?>
<span id="as_x_ClientSerNo">
	<input type="text" class="form-control" name="sv_x_ClientSerNo" id="sv_x_ClientSerNo" value="<?php echo RemoveHtml($receipts_view_search->ClientSerNo->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($receipts_view_search->ClientSerNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipts_view_search->ClientSerNo->getPlaceHolder()) ?>"<?php echo $receipts_view_search->ClientSerNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_ClientSerNo" data-value-separator="<?php echo $receipts_view_search->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x_ClientSerNo" id="x_ClientSerNo" value="<?php echo HtmlEncode($receipts_view_search->ClientSerNo->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceipts_viewsearch"], function() {
	freceipts_viewsearch.createAutoSuggest({"id":"x_ClientSerNo","forceSelect":false});
});
</script>
<?php echo $receipts_view_search->ClientSerNo->Lookup->getParamTag($receipts_view_search, "p_x_ClientSerNo") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipts_view_search->ChargeCode->Visible) { // ChargeCode ?>
	<div id="r_ChargeCode" class="form-group row">
		<label class="<?php echo $receipts_view_search->LeftColumnClass ?>"><span id="elh_receipts_view_ChargeCode"><?php echo $receipts_view_search->ChargeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ChargeCode" id="z_ChargeCode" value="=">
</span>
		</label>
		<div class="<?php echo $receipts_view_search->RightColumnClass ?>"><div <?php echo $receipts_view_search->ChargeCode->cellAttributes() ?>>
			<span id="el_receipts_view_ChargeCode" class="ew-search-field">
<?php
$onchange = $receipts_view_search->ChargeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipts_view_search->ChargeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ChargeCode">
	<input type="text" class="form-control" name="sv_x_ChargeCode" id="sv_x_ChargeCode" value="<?php echo RemoveHtml($receipts_view_search->ChargeCode->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($receipts_view_search->ChargeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipts_view_search->ChargeCode->getPlaceHolder()) ?>"<?php echo $receipts_view_search->ChargeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_ChargeCode" data-value-separator="<?php echo $receipts_view_search->ChargeCode->displayValueSeparatorAttribute() ?>" name="x_ChargeCode" id="x_ChargeCode" value="<?php echo HtmlEncode($receipts_view_search->ChargeCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceipts_viewsearch"], function() {
	freceipts_viewsearch.createAutoSuggest({"id":"x_ChargeCode","forceSelect":false});
});
</script>
<?php echo $receipts_view_search->ChargeCode->Lookup->getParamTag($receipts_view_search, "p_x_ChargeCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipts_view_search->ReceiptDate->Visible) { // ReceiptDate ?>
	<div id="r_ReceiptDate" class="form-group row">
		<label for="x_ReceiptDate" class="<?php echo $receipts_view_search->LeftColumnClass ?>"><span id="elh_receipts_view_ReceiptDate"><?php echo $receipts_view_search->ReceiptDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ReceiptDate" id="z_ReceiptDate" value="=">
</span>
		</label>
		<div class="<?php echo $receipts_view_search->RightColumnClass ?>"><div <?php echo $receipts_view_search->ReceiptDate->cellAttributes() ?>>
			<span id="el_receipts_view_ReceiptDate" class="ew-search-field">
<input type="text" data-table="receipts_view" data-field="x_ReceiptDate" name="x_ReceiptDate" id="x_ReceiptDate" maxlength="19" placeholder="<?php echo HtmlEncode($receipts_view_search->ReceiptDate->getPlaceHolder()) ?>" value="<?php echo $receipts_view_search->ReceiptDate->EditValue ?>"<?php echo $receipts_view_search->ReceiptDate->editAttributes() ?>>
<?php if (!$receipts_view_search->ReceiptDate->ReadOnly && !$receipts_view_search->ReceiptDate->Disabled && !isset($receipts_view_search->ReceiptDate->EditAttrs["readonly"]) && !isset($receipts_view_search->ReceiptDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freceipts_viewsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("freceipts_viewsearch", "x_ReceiptDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipts_view_search->ItemID->Visible) { // ItemID ?>
	<div id="r_ItemID" class="form-group row">
		<label for="x_ItemID" class="<?php echo $receipts_view_search->LeftColumnClass ?>"><span id="elh_receipts_view_ItemID"><?php echo $receipts_view_search->ItemID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ItemID" id="z_ItemID" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipts_view_search->RightColumnClass ?>"><div <?php echo $receipts_view_search->ItemID->cellAttributes() ?>>
			<span id="el_receipts_view_ItemID" class="ew-search-field">
<input type="text" data-table="receipts_view" data-field="x_ItemID" name="x_ItemID" id="x_ItemID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($receipts_view_search->ItemID->getPlaceHolder()) ?>" value="<?php echo $receipts_view_search->ItemID->EditValue ?>"<?php echo $receipts_view_search->ItemID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipts_view_search->UnitCost->Visible) { // UnitCost ?>
	<div id="r_UnitCost" class="form-group row">
		<label for="x_UnitCost" class="<?php echo $receipts_view_search->LeftColumnClass ?>"><span id="elh_receipts_view_UnitCost"><?php echo $receipts_view_search->UnitCost->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_UnitCost" id="z_UnitCost" value="=">
</span>
		</label>
		<div class="<?php echo $receipts_view_search->RightColumnClass ?>"><div <?php echo $receipts_view_search->UnitCost->cellAttributes() ?>>
			<span id="el_receipts_view_UnitCost" class="ew-search-field">
<input type="text" data-table="receipts_view" data-field="x_UnitCost" name="x_UnitCost" id="x_UnitCost" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($receipts_view_search->UnitCost->getPlaceHolder()) ?>" value="<?php echo $receipts_view_search->UnitCost->EditValue ?>"<?php echo $receipts_view_search->UnitCost->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipts_view_search->Quantity->Visible) { // Quantity ?>
	<div id="r_Quantity" class="form-group row">
		<label for="x_Quantity" class="<?php echo $receipts_view_search->LeftColumnClass ?>"><span id="elh_receipts_view_Quantity"><?php echo $receipts_view_search->Quantity->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Quantity" id="z_Quantity" value="=">
</span>
		</label>
		<div class="<?php echo $receipts_view_search->RightColumnClass ?>"><div <?php echo $receipts_view_search->Quantity->cellAttributes() ?>>
			<span id="el_receipts_view_Quantity" class="ew-search-field">
<input type="text" data-table="receipts_view" data-field="x_Quantity" name="x_Quantity" id="x_Quantity" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($receipts_view_search->Quantity->getPlaceHolder()) ?>" value="<?php echo $receipts_view_search->Quantity->EditValue ?>"<?php echo $receipts_view_search->Quantity->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipts_view_search->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<div id="r_UnitOfMeasure" class="form-group row">
		<label for="x_UnitOfMeasure" class="<?php echo $receipts_view_search->LeftColumnClass ?>"><span id="elh_receipts_view_UnitOfMeasure"><?php echo $receipts_view_search->UnitOfMeasure->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_UnitOfMeasure" id="z_UnitOfMeasure" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipts_view_search->RightColumnClass ?>"><div <?php echo $receipts_view_search->UnitOfMeasure->cellAttributes() ?>>
			<span id="el_receipts_view_UnitOfMeasure" class="ew-search-field">
<input type="text" data-table="receipts_view" data-field="x_UnitOfMeasure" name="x_UnitOfMeasure" id="x_UnitOfMeasure" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($receipts_view_search->UnitOfMeasure->getPlaceHolder()) ?>" value="<?php echo $receipts_view_search->UnitOfMeasure->EditValue ?>"<?php echo $receipts_view_search->UnitOfMeasure->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipts_view_search->AmountPaid->Visible) { // AmountPaid ?>
	<div id="r_AmountPaid" class="form-group row">
		<label for="x_AmountPaid" class="<?php echo $receipts_view_search->LeftColumnClass ?>"><span id="elh_receipts_view_AmountPaid"><?php echo $receipts_view_search->AmountPaid->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AmountPaid" id="z_AmountPaid" value="=">
</span>
		</label>
		<div class="<?php echo $receipts_view_search->RightColumnClass ?>"><div <?php echo $receipts_view_search->AmountPaid->cellAttributes() ?>>
			<span id="el_receipts_view_AmountPaid" class="ew-search-field">
<input type="text" data-table="receipts_view" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($receipts_view_search->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $receipts_view_search->AmountPaid->EditValue ?>"<?php echo $receipts_view_search->AmountPaid->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipts_view_search->PaymentMethod->Visible) { // PaymentMethod ?>
	<div id="r_PaymentMethod" class="form-group row">
		<label class="<?php echo $receipts_view_search->LeftColumnClass ?>"><span id="elh_receipts_view_PaymentMethod"><?php echo $receipts_view_search->PaymentMethod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PaymentMethod" id="z_PaymentMethod" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipts_view_search->RightColumnClass ?>"><div <?php echo $receipts_view_search->PaymentMethod->cellAttributes() ?>>
			<span id="el_receipts_view_PaymentMethod" class="ew-search-field">
<?php
$onchange = $receipts_view_search->PaymentMethod->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipts_view_search->PaymentMethod->EditAttrs["onchange"] = "";
?>
<span id="as_x_PaymentMethod">
	<input type="text" class="form-control" name="sv_x_PaymentMethod" id="sv_x_PaymentMethod" value="<?php echo RemoveHtml($receipts_view_search->PaymentMethod->EditValue) ?>" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($receipts_view_search->PaymentMethod->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipts_view_search->PaymentMethod->getPlaceHolder()) ?>"<?php echo $receipts_view_search->PaymentMethod->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_PaymentMethod" data-value-separator="<?php echo $receipts_view_search->PaymentMethod->displayValueSeparatorAttribute() ?>" name="x_PaymentMethod" id="x_PaymentMethod" value="<?php echo HtmlEncode($receipts_view_search->PaymentMethod->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceipts_viewsearch"], function() {
	freceipts_viewsearch.createAutoSuggest({"id":"x_PaymentMethod","forceSelect":false});
});
</script>
<?php echo $receipts_view_search->PaymentMethod->Lookup->getParamTag($receipts_view_search, "p_x_PaymentMethod") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipts_view_search->PaymentRef->Visible) { // PaymentRef ?>
	<div id="r_PaymentRef" class="form-group row">
		<label for="x_PaymentRef" class="<?php echo $receipts_view_search->LeftColumnClass ?>"><span id="elh_receipts_view_PaymentRef"><?php echo $receipts_view_search->PaymentRef->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PaymentRef" id="z_PaymentRef" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipts_view_search->RightColumnClass ?>"><div <?php echo $receipts_view_search->PaymentRef->cellAttributes() ?>>
			<span id="el_receipts_view_PaymentRef" class="ew-search-field">
<input type="text" data-table="receipts_view" data-field="x_PaymentRef" name="x_PaymentRef" id="x_PaymentRef" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipts_view_search->PaymentRef->getPlaceHolder()) ?>" value="<?php echo $receipts_view_search->PaymentRef->EditValue ?>"<?php echo $receipts_view_search->PaymentRef->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipts_view_search->CashierNo->Visible) { // CashierNo ?>
	<div id="r_CashierNo" class="form-group row">
		<label for="x_CashierNo" class="<?php echo $receipts_view_search->LeftColumnClass ?>"><span id="elh_receipts_view_CashierNo"><?php echo $receipts_view_search->CashierNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_CashierNo" id="z_CashierNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipts_view_search->RightColumnClass ?>"><div <?php echo $receipts_view_search->CashierNo->cellAttributes() ?>>
			<span id="el_receipts_view_CashierNo" class="ew-search-field">
<input type="text" data-table="receipts_view" data-field="x_CashierNo" name="x_CashierNo" id="x_CashierNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipts_view_search->CashierNo->getPlaceHolder()) ?>" value="<?php echo $receipts_view_search->CashierNo->EditValue ?>"<?php echo $receipts_view_search->CashierNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipts_view_search->BillPeriod->Visible) { // BillPeriod ?>
	<div id="r_BillPeriod" class="form-group row">
		<label for="x_BillPeriod" class="<?php echo $receipts_view_search->LeftColumnClass ?>"><span id="elh_receipts_view_BillPeriod"><?php echo $receipts_view_search->BillPeriod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillPeriod" id="z_BillPeriod" value="=">
</span>
		</label>
		<div class="<?php echo $receipts_view_search->RightColumnClass ?>"><div <?php echo $receipts_view_search->BillPeriod->cellAttributes() ?>>
			<span id="el_receipts_view_BillPeriod" class="ew-search-field">
<input type="text" data-table="receipts_view" data-field="x_BillPeriod" name="x_BillPeriod" id="x_BillPeriod" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($receipts_view_search->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $receipts_view_search->BillPeriod->EditValue ?>"<?php echo $receipts_view_search->BillPeriod->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipts_view_search->BillYear->Visible) { // BillYear ?>
	<div id="r_BillYear" class="form-group row">
		<label for="x_BillYear" class="<?php echo $receipts_view_search->LeftColumnClass ?>"><span id="elh_receipts_view_BillYear"><?php echo $receipts_view_search->BillYear->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillYear" id="z_BillYear" value="=">
</span>
		</label>
		<div class="<?php echo $receipts_view_search->RightColumnClass ?>"><div <?php echo $receipts_view_search->BillYear->cellAttributes() ?>>
			<span id="el_receipts_view_BillYear" class="ew-search-field">
<input type="text" data-table="receipts_view" data-field="x_BillYear" name="x_BillYear" id="x_BillYear" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($receipts_view_search->BillYear->getPlaceHolder()) ?>" value="<?php echo $receipts_view_search->BillYear->EditValue ?>"<?php echo $receipts_view_search->BillYear->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipts_view_search->PaymentFor->Visible) { // PaymentFor ?>
	<div id="r_PaymentFor" class="form-group row">
		<label for="x_PaymentFor" class="<?php echo $receipts_view_search->LeftColumnClass ?>"><span id="elh_receipts_view_PaymentFor"><?php echo $receipts_view_search->PaymentFor->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PaymentFor" id="z_PaymentFor" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipts_view_search->RightColumnClass ?>"><div <?php echo $receipts_view_search->PaymentFor->cellAttributes() ?>>
			<span id="el_receipts_view_PaymentFor" class="ew-search-field">
<input type="text" data-table="receipts_view" data-field="x_PaymentFor" name="x_PaymentFor" id="x_PaymentFor" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($receipts_view_search->PaymentFor->getPlaceHolder()) ?>" value="<?php echo $receipts_view_search->PaymentFor->EditValue ?>"<?php echo $receipts_view_search->PaymentFor->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipts_view_search->AdditionalInformation->Visible) { // AdditionalInformation ?>
	<div id="r_AdditionalInformation" class="form-group row">
		<label for="x_AdditionalInformation" class="<?php echo $receipts_view_search->LeftColumnClass ?>"><span id="elh_receipts_view_AdditionalInformation"><?php echo $receipts_view_search->AdditionalInformation->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AdditionalInformation" id="z_AdditionalInformation" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipts_view_search->RightColumnClass ?>"><div <?php echo $receipts_view_search->AdditionalInformation->cellAttributes() ?>>
			<span id="el_receipts_view_AdditionalInformation" class="ew-search-field">
<input type="text" data-table="receipts_view" data-field="x_AdditionalInformation" name="x_AdditionalInformation" id="x_AdditionalInformation" size="35" placeholder="<?php echo HtmlEncode($receipts_view_search->AdditionalInformation->getPlaceHolder()) ?>" value="<?php echo $receipts_view_search->AdditionalInformation->EditValue ?>"<?php echo $receipts_view_search->AdditionalInformation->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipts_view_search->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label for="x_ChargeGroup" class="<?php echo $receipts_view_search->LeftColumnClass ?>"><span id="elh_receipts_view_ChargeGroup"><?php echo $receipts_view_search->ChargeGroup->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ChargeGroup" id="z_ChargeGroup" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipts_view_search->RightColumnClass ?>"><div <?php echo $receipts_view_search->ChargeGroup->cellAttributes() ?>>
			<span id="el_receipts_view_ChargeGroup" class="ew-search-field">
<input type="text" data-table="receipts_view" data-field="x_ChargeGroup" name="x_ChargeGroup" id="x_ChargeGroup" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($receipts_view_search->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $receipts_view_search->ChargeGroup->EditValue ?>"<?php echo $receipts_view_search->ChargeGroup->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$receipts_view_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $receipts_view_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$receipts_view_search->showPageFooter();
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
$receipts_view_search->terminate();
?>