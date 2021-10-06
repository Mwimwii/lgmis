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
$cashier_eod_view_search = new cashier_eod_view_search();

// Run the page
$cashier_eod_view_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cashier_eod_view_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcashier_eod_viewsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($cashier_eod_view_search->IsModal) { ?>
	fcashier_eod_viewsearch = currentAdvancedSearchForm = new ew.Form("fcashier_eod_viewsearch", "search");
	<?php } else { ?>
	fcashier_eod_viewsearch = currentForm = new ew.Form("fcashier_eod_viewsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fcashier_eod_viewsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ReceiptedTotalAmount");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($cashier_eod_view_search->ReceiptedTotalAmount->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_NoOfReceipts");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($cashier_eod_view_search->NoOfReceipts->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ReceiptDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($cashier_eod_view_search->ReceiptDate->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fcashier_eod_viewsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcashier_eod_viewsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcashier_eod_viewsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $cashier_eod_view_search->showPageHeader(); ?>
<?php
$cashier_eod_view_search->showMessage();
?>
<form name="fcashier_eod_viewsearch" id="fcashier_eod_viewsearch" class="<?php echo $cashier_eod_view_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cashier_eod_view">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$cashier_eod_view_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($cashier_eod_view_search->ReceiptedTotalAmount->Visible) { // ReceiptedTotalAmount ?>
	<div id="r_ReceiptedTotalAmount" class="form-group row">
		<label for="x_ReceiptedTotalAmount" class="<?php echo $cashier_eod_view_search->LeftColumnClass ?>"><span id="elh_cashier_eod_view_ReceiptedTotalAmount"><?php echo $cashier_eod_view_search->ReceiptedTotalAmount->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ReceiptedTotalAmount" id="z_ReceiptedTotalAmount" value="=">
</span>
		</label>
		<div class="<?php echo $cashier_eod_view_search->RightColumnClass ?>"><div <?php echo $cashier_eod_view_search->ReceiptedTotalAmount->cellAttributes() ?>>
			<span id="el_cashier_eod_view_ReceiptedTotalAmount" class="ew-search-field">
<input type="text" data-table="cashier_eod_view" data-field="x_ReceiptedTotalAmount" name="x_ReceiptedTotalAmount" id="x_ReceiptedTotalAmount" size="30" placeholder="<?php echo HtmlEncode($cashier_eod_view_search->ReceiptedTotalAmount->getPlaceHolder()) ?>" value="<?php echo $cashier_eod_view_search->ReceiptedTotalAmount->EditValue ?>"<?php echo $cashier_eod_view_search->ReceiptedTotalAmount->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cashier_eod_view_search->NoOfReceipts->Visible) { // NoOfReceipts ?>
	<div id="r_NoOfReceipts" class="form-group row">
		<label for="x_NoOfReceipts" class="<?php echo $cashier_eod_view_search->LeftColumnClass ?>"><span id="elh_cashier_eod_view_NoOfReceipts"><?php echo $cashier_eod_view_search->NoOfReceipts->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_NoOfReceipts" id="z_NoOfReceipts" value="=">
</span>
		</label>
		<div class="<?php echo $cashier_eod_view_search->RightColumnClass ?>"><div <?php echo $cashier_eod_view_search->NoOfReceipts->cellAttributes() ?>>
			<span id="el_cashier_eod_view_NoOfReceipts" class="ew-search-field">
<input type="text" data-table="cashier_eod_view" data-field="x_NoOfReceipts" name="x_NoOfReceipts" id="x_NoOfReceipts" size="30" placeholder="<?php echo HtmlEncode($cashier_eod_view_search->NoOfReceipts->getPlaceHolder()) ?>" value="<?php echo $cashier_eod_view_search->NoOfReceipts->EditValue ?>"<?php echo $cashier_eod_view_search->NoOfReceipts->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cashier_eod_view_search->PaymentDesc->Visible) { // PaymentDesc ?>
	<div id="r_PaymentDesc" class="form-group row">
		<label for="x_PaymentDesc" class="<?php echo $cashier_eod_view_search->LeftColumnClass ?>"><span id="elh_cashier_eod_view_PaymentDesc"><?php echo $cashier_eod_view_search->PaymentDesc->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PaymentDesc" id="z_PaymentDesc" value="LIKE">
</span>
		</label>
		<div class="<?php echo $cashier_eod_view_search->RightColumnClass ?>"><div <?php echo $cashier_eod_view_search->PaymentDesc->cellAttributes() ?>>
			<span id="el_cashier_eod_view_PaymentDesc" class="ew-search-field">
<input type="text" data-table="cashier_eod_view" data-field="x_PaymentDesc" name="x_PaymentDesc" id="x_PaymentDesc" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($cashier_eod_view_search->PaymentDesc->getPlaceHolder()) ?>" value="<?php echo $cashier_eod_view_search->PaymentDesc->EditValue ?>"<?php echo $cashier_eod_view_search->PaymentDesc->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cashier_eod_view_search->ReceiptDate->Visible) { // ReceiptDate ?>
	<div id="r_ReceiptDate" class="form-group row">
		<label for="x_ReceiptDate" class="<?php echo $cashier_eod_view_search->LeftColumnClass ?>"><span id="elh_cashier_eod_view_ReceiptDate"><?php echo $cashier_eod_view_search->ReceiptDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ReceiptDate" id="z_ReceiptDate" value="=">
</span>
		</label>
		<div class="<?php echo $cashier_eod_view_search->RightColumnClass ?>"><div <?php echo $cashier_eod_view_search->ReceiptDate->cellAttributes() ?>>
			<span id="el_cashier_eod_view_ReceiptDate" class="ew-search-field">
<input type="text" data-table="cashier_eod_view" data-field="x_ReceiptDate" name="x_ReceiptDate" id="x_ReceiptDate" placeholder="<?php echo HtmlEncode($cashier_eod_view_search->ReceiptDate->getPlaceHolder()) ?>" value="<?php echo $cashier_eod_view_search->ReceiptDate->EditValue ?>"<?php echo $cashier_eod_view_search->ReceiptDate->editAttributes() ?>>
<?php if (!$cashier_eod_view_search->ReceiptDate->ReadOnly && !$cashier_eod_view_search->ReceiptDate->Disabled && !isset($cashier_eod_view_search->ReceiptDate->EditAttrs["readonly"]) && !isset($cashier_eod_view_search->ReceiptDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcashier_eod_viewsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fcashier_eod_viewsearch", "x_ReceiptDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cashier_eod_view_search->CashierNo->Visible) { // CashierNo ?>
	<div id="r_CashierNo" class="form-group row">
		<label for="x_CashierNo" class="<?php echo $cashier_eod_view_search->LeftColumnClass ?>"><span id="elh_cashier_eod_view_CashierNo"><?php echo $cashier_eod_view_search->CashierNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_CashierNo" id="z_CashierNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $cashier_eod_view_search->RightColumnClass ?>"><div <?php echo $cashier_eod_view_search->CashierNo->cellAttributes() ?>>
			<span id="el_cashier_eod_view_CashierNo" class="ew-search-field">
<input type="text" data-table="cashier_eod_view" data-field="x_CashierNo" name="x_CashierNo" id="x_CashierNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($cashier_eod_view_search->CashierNo->getPlaceHolder()) ?>" value="<?php echo $cashier_eod_view_search->CashierNo->EditValue ?>"<?php echo $cashier_eod_view_search->CashierNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cashier_eod_view_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cashier_eod_view_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cashier_eod_view_search->showPageFooter();
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
$cashier_eod_view_search->terminate();
?>