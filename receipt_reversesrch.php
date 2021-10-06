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
$receipt_reverse_search = new receipt_reverse_search();

// Run the page
$receipt_reverse_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$receipt_reverse_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var freceipt_reversesearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($receipt_reverse_search->IsModal) { ?>
	freceipt_reversesearch = currentAdvancedSearchForm = new ew.Form("freceipt_reversesearch", "search");
	<?php } else { ?>
	freceipt_reversesearch = currentForm = new ew.Form("freceipt_reversesearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	freceipt_reversesearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ReversalRef");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_reverse_search->ReversalRef->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ReceiptNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_reverse_search->ReceiptNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ClientSerNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_reverse_search->ClientSerNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ChargeCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_reverse_search->ChargeCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ReceiptDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_reverse_search->ReceiptDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_UnitCost");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_reverse_search->UnitCost->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Quantity");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_reverse_search->Quantity->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_AmountPaid");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_reverse_search->AmountPaid->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BillPeriod");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_reverse_search->BillPeriod->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BillYear");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_reverse_search->BillYear->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_LastUpdateDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_reverse_search->LastUpdateDate->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	freceipt_reversesearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	freceipt_reversesearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("freceipt_reversesearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $receipt_reverse_search->showPageHeader(); ?>
<?php
$receipt_reverse_search->showMessage();
?>
<form name="freceipt_reversesearch" id="freceipt_reversesearch" class="<?php echo $receipt_reverse_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="receipt_reverse">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$receipt_reverse_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($receipt_reverse_search->ReversalRef->Visible) { // ReversalRef ?>
	<div id="r_ReversalRef" class="form-group row">
		<label for="x_ReversalRef" class="<?php echo $receipt_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_reverse_ReversalRef"><?php echo $receipt_reverse_search->ReversalRef->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ReversalRef" id="z_ReversalRef" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_reverse_search->ReversalRef->cellAttributes() ?>>
			<span id="el_receipt_reverse_ReversalRef" class="ew-search-field">
<input type="text" data-table="receipt_reverse" data-field="x_ReversalRef" name="x_ReversalRef" id="x_ReversalRef" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($receipt_reverse_search->ReversalRef->getPlaceHolder()) ?>" value="<?php echo $receipt_reverse_search->ReversalRef->EditValue ?>"<?php echo $receipt_reverse_search->ReversalRef->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_reverse_search->ReceiptNo->Visible) { // ReceiptNo ?>
	<div id="r_ReceiptNo" class="form-group row">
		<label for="x_ReceiptNo" class="<?php echo $receipt_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_reverse_ReceiptNo"><?php echo $receipt_reverse_search->ReceiptNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ReceiptNo" id="z_ReceiptNo" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_reverse_search->ReceiptNo->cellAttributes() ?>>
			<span id="el_receipt_reverse_ReceiptNo" class="ew-search-field">
<input type="text" data-table="receipt_reverse" data-field="x_ReceiptNo" name="x_ReceiptNo" id="x_ReceiptNo" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($receipt_reverse_search->ReceiptNo->getPlaceHolder()) ?>" value="<?php echo $receipt_reverse_search->ReceiptNo->EditValue ?>"<?php echo $receipt_reverse_search->ReceiptNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_reverse_search->ClientSerNo->Visible) { // ClientSerNo ?>
	<div id="r_ClientSerNo" class="form-group row">
		<label for="x_ClientSerNo" class="<?php echo $receipt_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_reverse_ClientSerNo"><?php echo $receipt_reverse_search->ClientSerNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ClientSerNo" id="z_ClientSerNo" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_reverse_search->ClientSerNo->cellAttributes() ?>>
			<span id="el_receipt_reverse_ClientSerNo" class="ew-search-field">
<input type="text" data-table="receipt_reverse" data-field="x_ClientSerNo" name="x_ClientSerNo" id="x_ClientSerNo" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($receipt_reverse_search->ClientSerNo->getPlaceHolder()) ?>" value="<?php echo $receipt_reverse_search->ClientSerNo->EditValue ?>"<?php echo $receipt_reverse_search->ClientSerNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_reverse_search->ChargeCode->Visible) { // ChargeCode ?>
	<div id="r_ChargeCode" class="form-group row">
		<label for="x_ChargeCode" class="<?php echo $receipt_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_reverse_ChargeCode"><?php echo $receipt_reverse_search->ChargeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ChargeCode" id="z_ChargeCode" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_reverse_search->ChargeCode->cellAttributes() ?>>
			<span id="el_receipt_reverse_ChargeCode" class="ew-search-field">
<input type="text" data-table="receipt_reverse" data-field="x_ChargeCode" name="x_ChargeCode" id="x_ChargeCode" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($receipt_reverse_search->ChargeCode->getPlaceHolder()) ?>" value="<?php echo $receipt_reverse_search->ChargeCode->EditValue ?>"<?php echo $receipt_reverse_search->ChargeCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_reverse_search->ReceiptDate->Visible) { // ReceiptDate ?>
	<div id="r_ReceiptDate" class="form-group row">
		<label for="x_ReceiptDate" class="<?php echo $receipt_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_reverse_ReceiptDate"><?php echo $receipt_reverse_search->ReceiptDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ReceiptDate" id="z_ReceiptDate" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_reverse_search->ReceiptDate->cellAttributes() ?>>
			<span id="el_receipt_reverse_ReceiptDate" class="ew-search-field">
<input type="text" data-table="receipt_reverse" data-field="x_ReceiptDate" name="x_ReceiptDate" id="x_ReceiptDate" maxlength="19" placeholder="<?php echo HtmlEncode($receipt_reverse_search->ReceiptDate->getPlaceHolder()) ?>" value="<?php echo $receipt_reverse_search->ReceiptDate->EditValue ?>"<?php echo $receipt_reverse_search->ReceiptDate->editAttributes() ?>>
<?php if (!$receipt_reverse_search->ReceiptDate->ReadOnly && !$receipt_reverse_search->ReceiptDate->Disabled && !isset($receipt_reverse_search->ReceiptDate->EditAttrs["readonly"]) && !isset($receipt_reverse_search->ReceiptDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freceipt_reversesearch", "datetimepicker"], function() {
	ew.createDateTimePicker("freceipt_reversesearch", "x_ReceiptDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_reverse_search->ItemID->Visible) { // ItemID ?>
	<div id="r_ItemID" class="form-group row">
		<label for="x_ItemID" class="<?php echo $receipt_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_reverse_ItemID"><?php echo $receipt_reverse_search->ItemID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ItemID" id="z_ItemID" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_reverse_search->ItemID->cellAttributes() ?>>
			<span id="el_receipt_reverse_ItemID" class="ew-search-field">
<input type="text" data-table="receipt_reverse" data-field="x_ItemID" name="x_ItemID" id="x_ItemID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($receipt_reverse_search->ItemID->getPlaceHolder()) ?>" value="<?php echo $receipt_reverse_search->ItemID->EditValue ?>"<?php echo $receipt_reverse_search->ItemID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_reverse_search->UnitCost->Visible) { // UnitCost ?>
	<div id="r_UnitCost" class="form-group row">
		<label for="x_UnitCost" class="<?php echo $receipt_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_reverse_UnitCost"><?php echo $receipt_reverse_search->UnitCost->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_UnitCost" id="z_UnitCost" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_reverse_search->UnitCost->cellAttributes() ?>>
			<span id="el_receipt_reverse_UnitCost" class="ew-search-field">
<input type="text" data-table="receipt_reverse" data-field="x_UnitCost" name="x_UnitCost" id="x_UnitCost" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($receipt_reverse_search->UnitCost->getPlaceHolder()) ?>" value="<?php echo $receipt_reverse_search->UnitCost->EditValue ?>"<?php echo $receipt_reverse_search->UnitCost->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_reverse_search->Quantity->Visible) { // Quantity ?>
	<div id="r_Quantity" class="form-group row">
		<label for="x_Quantity" class="<?php echo $receipt_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_reverse_Quantity"><?php echo $receipt_reverse_search->Quantity->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Quantity" id="z_Quantity" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_reverse_search->Quantity->cellAttributes() ?>>
			<span id="el_receipt_reverse_Quantity" class="ew-search-field">
<input type="text" data-table="receipt_reverse" data-field="x_Quantity" name="x_Quantity" id="x_Quantity" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($receipt_reverse_search->Quantity->getPlaceHolder()) ?>" value="<?php echo $receipt_reverse_search->Quantity->EditValue ?>"<?php echo $receipt_reverse_search->Quantity->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_reverse_search->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<div id="r_UnitOfMeasure" class="form-group row">
		<label for="x_UnitOfMeasure" class="<?php echo $receipt_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_reverse_UnitOfMeasure"><?php echo $receipt_reverse_search->UnitOfMeasure->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_UnitOfMeasure" id="z_UnitOfMeasure" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_reverse_search->UnitOfMeasure->cellAttributes() ?>>
			<span id="el_receipt_reverse_UnitOfMeasure" class="ew-search-field">
<input type="text" data-table="receipt_reverse" data-field="x_UnitOfMeasure" name="x_UnitOfMeasure" id="x_UnitOfMeasure" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($receipt_reverse_search->UnitOfMeasure->getPlaceHolder()) ?>" value="<?php echo $receipt_reverse_search->UnitOfMeasure->EditValue ?>"<?php echo $receipt_reverse_search->UnitOfMeasure->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_reverse_search->AmountPaid->Visible) { // AmountPaid ?>
	<div id="r_AmountPaid" class="form-group row">
		<label for="x_AmountPaid" class="<?php echo $receipt_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_reverse_AmountPaid"><?php echo $receipt_reverse_search->AmountPaid->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AmountPaid" id="z_AmountPaid" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_reverse_search->AmountPaid->cellAttributes() ?>>
			<span id="el_receipt_reverse_AmountPaid" class="ew-search-field">
<input type="text" data-table="receipt_reverse" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($receipt_reverse_search->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $receipt_reverse_search->AmountPaid->EditValue ?>"<?php echo $receipt_reverse_search->AmountPaid->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_reverse_search->PaymentMethod->Visible) { // PaymentMethod ?>
	<div id="r_PaymentMethod" class="form-group row">
		<label for="x_PaymentMethod" class="<?php echo $receipt_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_reverse_PaymentMethod"><?php echo $receipt_reverse_search->PaymentMethod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PaymentMethod" id="z_PaymentMethod" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_reverse_search->PaymentMethod->cellAttributes() ?>>
			<span id="el_receipt_reverse_PaymentMethod" class="ew-search-field">
<input type="text" data-table="receipt_reverse" data-field="x_PaymentMethod" name="x_PaymentMethod" id="x_PaymentMethod" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($receipt_reverse_search->PaymentMethod->getPlaceHolder()) ?>" value="<?php echo $receipt_reverse_search->PaymentMethod->EditValue ?>"<?php echo $receipt_reverse_search->PaymentMethod->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_reverse_search->PaymentRef->Visible) { // PaymentRef ?>
	<div id="r_PaymentRef" class="form-group row">
		<label for="x_PaymentRef" class="<?php echo $receipt_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_reverse_PaymentRef"><?php echo $receipt_reverse_search->PaymentRef->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PaymentRef" id="z_PaymentRef" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_reverse_search->PaymentRef->cellAttributes() ?>>
			<span id="el_receipt_reverse_PaymentRef" class="ew-search-field">
<input type="text" data-table="receipt_reverse" data-field="x_PaymentRef" name="x_PaymentRef" id="x_PaymentRef" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipt_reverse_search->PaymentRef->getPlaceHolder()) ?>" value="<?php echo $receipt_reverse_search->PaymentRef->EditValue ?>"<?php echo $receipt_reverse_search->PaymentRef->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_reverse_search->CashierNo->Visible) { // CashierNo ?>
	<div id="r_CashierNo" class="form-group row">
		<label for="x_CashierNo" class="<?php echo $receipt_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_reverse_CashierNo"><?php echo $receipt_reverse_search->CashierNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_CashierNo" id="z_CashierNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_reverse_search->CashierNo->cellAttributes() ?>>
			<span id="el_receipt_reverse_CashierNo" class="ew-search-field">
<input type="text" data-table="receipt_reverse" data-field="x_CashierNo" name="x_CashierNo" id="x_CashierNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipt_reverse_search->CashierNo->getPlaceHolder()) ?>" value="<?php echo $receipt_reverse_search->CashierNo->EditValue ?>"<?php echo $receipt_reverse_search->CashierNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_reverse_search->BillPeriod->Visible) { // BillPeriod ?>
	<div id="r_BillPeriod" class="form-group row">
		<label for="x_BillPeriod" class="<?php echo $receipt_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_reverse_BillPeriod"><?php echo $receipt_reverse_search->BillPeriod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillPeriod" id="z_BillPeriod" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_reverse_search->BillPeriod->cellAttributes() ?>>
			<span id="el_receipt_reverse_BillPeriod" class="ew-search-field">
<input type="text" data-table="receipt_reverse" data-field="x_BillPeriod" name="x_BillPeriod" id="x_BillPeriod" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($receipt_reverse_search->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $receipt_reverse_search->BillPeriod->EditValue ?>"<?php echo $receipt_reverse_search->BillPeriod->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_reverse_search->BillYear->Visible) { // BillYear ?>
	<div id="r_BillYear" class="form-group row">
		<label for="x_BillYear" class="<?php echo $receipt_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_reverse_BillYear"><?php echo $receipt_reverse_search->BillYear->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillYear" id="z_BillYear" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_reverse_search->BillYear->cellAttributes() ?>>
			<span id="el_receipt_reverse_BillYear" class="ew-search-field">
<input type="text" data-table="receipt_reverse" data-field="x_BillYear" name="x_BillYear" id="x_BillYear" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($receipt_reverse_search->BillYear->getPlaceHolder()) ?>" value="<?php echo $receipt_reverse_search->BillYear->EditValue ?>"<?php echo $receipt_reverse_search->BillYear->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_reverse_search->PaymentFor->Visible) { // PaymentFor ?>
	<div id="r_PaymentFor" class="form-group row">
		<label for="x_PaymentFor" class="<?php echo $receipt_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_reverse_PaymentFor"><?php echo $receipt_reverse_search->PaymentFor->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PaymentFor" id="z_PaymentFor" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_reverse_search->PaymentFor->cellAttributes() ?>>
			<span id="el_receipt_reverse_PaymentFor" class="ew-search-field">
<input type="text" data-table="receipt_reverse" data-field="x_PaymentFor" name="x_PaymentFor" id="x_PaymentFor" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($receipt_reverse_search->PaymentFor->getPlaceHolder()) ?>" value="<?php echo $receipt_reverse_search->PaymentFor->EditValue ?>"<?php echo $receipt_reverse_search->PaymentFor->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_reverse_search->AdditionalInformation->Visible) { // AdditionalInformation ?>
	<div id="r_AdditionalInformation" class="form-group row">
		<label for="x_AdditionalInformation" class="<?php echo $receipt_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_reverse_AdditionalInformation"><?php echo $receipt_reverse_search->AdditionalInformation->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AdditionalInformation" id="z_AdditionalInformation" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_reverse_search->AdditionalInformation->cellAttributes() ?>>
			<span id="el_receipt_reverse_AdditionalInformation" class="ew-search-field">
<input type="text" data-table="receipt_reverse" data-field="x_AdditionalInformation" name="x_AdditionalInformation" id="x_AdditionalInformation" size="35" maxlength="16777215" placeholder="<?php echo HtmlEncode($receipt_reverse_search->AdditionalInformation->getPlaceHolder()) ?>" value="<?php echo $receipt_reverse_search->AdditionalInformation->EditValue ?>"<?php echo $receipt_reverse_search->AdditionalInformation->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_reverse_search->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<div id="r_LastUpdatedBy" class="form-group row">
		<label for="x_LastUpdatedBy" class="<?php echo $receipt_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_reverse_LastUpdatedBy"><?php echo $receipt_reverse_search->LastUpdatedBy->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LastUpdatedBy" id="z_LastUpdatedBy" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_reverse_search->LastUpdatedBy->cellAttributes() ?>>
			<span id="el_receipt_reverse_LastUpdatedBy" class="ew-search-field">
<input type="text" data-table="receipt_reverse" data-field="x_LastUpdatedBy" name="x_LastUpdatedBy" id="x_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($receipt_reverse_search->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $receipt_reverse_search->LastUpdatedBy->EditValue ?>"<?php echo $receipt_reverse_search->LastUpdatedBy->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_reverse_search->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<div id="r_LastUpdateDate" class="form-group row">
		<label for="x_LastUpdateDate" class="<?php echo $receipt_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_reverse_LastUpdateDate"><?php echo $receipt_reverse_search->LastUpdateDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LastUpdateDate" id="z_LastUpdateDate" value="=">
</span>
		</label>
		<div class="<?php echo $receipt_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_reverse_search->LastUpdateDate->cellAttributes() ?>>
			<span id="el_receipt_reverse_LastUpdateDate" class="ew-search-field">
<input type="text" data-table="receipt_reverse" data-field="x_LastUpdateDate" name="x_LastUpdateDate" id="x_LastUpdateDate" maxlength="19" placeholder="<?php echo HtmlEncode($receipt_reverse_search->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $receipt_reverse_search->LastUpdateDate->EditValue ?>"<?php echo $receipt_reverse_search->LastUpdateDate->editAttributes() ?>>
<?php if (!$receipt_reverse_search->LastUpdateDate->ReadOnly && !$receipt_reverse_search->LastUpdateDate->Disabled && !isset($receipt_reverse_search->LastUpdateDate->EditAttrs["readonly"]) && !isset($receipt_reverse_search->LastUpdateDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freceipt_reversesearch", "datetimepicker"], function() {
	ew.createDateTimePicker("freceipt_reversesearch", "x_LastUpdateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($receipt_reverse_search->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label for="x_ChargeGroup" class="<?php echo $receipt_reverse_search->LeftColumnClass ?>"><span id="elh_receipt_reverse_ChargeGroup"><?php echo $receipt_reverse_search->ChargeGroup->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ChargeGroup" id="z_ChargeGroup" value="LIKE">
</span>
		</label>
		<div class="<?php echo $receipt_reverse_search->RightColumnClass ?>"><div <?php echo $receipt_reverse_search->ChargeGroup->cellAttributes() ?>>
			<span id="el_receipt_reverse_ChargeGroup" class="ew-search-field">
<input type="text" data-table="receipt_reverse" data-field="x_ChargeGroup" name="x_ChargeGroup" id="x_ChargeGroup" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($receipt_reverse_search->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $receipt_reverse_search->ChargeGroup->EditValue ?>"<?php echo $receipt_reverse_search->ChargeGroup->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$receipt_reverse_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $receipt_reverse_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$receipt_reverse_search->showPageFooter();
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
$receipt_reverse_search->terminate();
?>