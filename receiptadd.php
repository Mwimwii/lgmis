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
$receipt_add = new receipt_add();

// Run the page
$receipt_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$receipt_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var freceiptadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	freceiptadd = currentForm = new ew.Form("freceiptadd", "add");

	// Validate form
	freceiptadd.validate = function() {
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
			<?php if ($receipt_add->ClientSerNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_add->ClientSerNo->caption(), $receipt_add->ClientSerNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_add->ChargeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_add->ChargeCode->caption(), $receipt_add->ChargeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_add->ItemID->Required) { ?>
				elm = this.getElements("x" + infix + "_ItemID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_add->ItemID->caption(), $receipt_add->ItemID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_add->UnitCost->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitCost");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_add->UnitCost->caption(), $receipt_add->UnitCost->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_UnitCost");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_add->UnitCost->errorMessage()) ?>");
			<?php if ($receipt_add->Quantity->Required) { ?>
				elm = this.getElements("x" + infix + "_Quantity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_add->Quantity->caption(), $receipt_add->Quantity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Quantity");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_add->Quantity->errorMessage()) ?>");
			<?php if ($receipt_add->UnitOfMeasure->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitOfMeasure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_add->UnitOfMeasure->caption(), $receipt_add->UnitOfMeasure->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_add->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_add->AmountPaid->caption(), $receipt_add->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_add->AmountPaid->errorMessage()) ?>");
			<?php if ($receipt_add->ReceiptNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ReceiptNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_add->ReceiptNo->caption(), $receipt_add->ReceiptNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_add->ReceiptDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ReceiptDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_add->ReceiptDate->caption(), $receipt_add->ReceiptDate->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_add->PaymentMethod->Required) { ?>
				elm = this.getElements("x" + infix + "_PaymentMethod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_add->PaymentMethod->caption(), $receipt_add->PaymentMethod->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_add->PaymentRef->Required) { ?>
				elm = this.getElements("x" + infix + "_PaymentRef");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_add->PaymentRef->caption(), $receipt_add->PaymentRef->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_add->CashierNo->Required) { ?>
				elm = this.getElements("x" + infix + "_CashierNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_add->CashierNo->caption(), $receipt_add->CashierNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_add->BillPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_add->BillPeriod->caption(), $receipt_add->BillPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_add->BillPeriod->errorMessage()) ?>");
			<?php if ($receipt_add->BillYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_add->BillYear->caption(), $receipt_add->BillYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_add->BillYear->errorMessage()) ?>");
			<?php if ($receipt_add->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_add->ChargeGroup->caption(), $receipt_add->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_add->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_add->ClientID->caption(), $receipt_add->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_add->PrintedReceipt->Required) { ?>
				elm = this.getElements("x" + infix + "_PrintedReceipt");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_add->PrintedReceipt->caption(), $receipt_add->PrintedReceipt->RequiredErrorMessage)) ?>");
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
	freceiptadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	freceiptadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	freceiptadd.lists["x_ClientSerNo"] = <?php echo $receipt_add->ClientSerNo->Lookup->toClientList($receipt_add) ?>;
	freceiptadd.lists["x_ClientSerNo"].options = <?php echo JsonEncode($receipt_add->ClientSerNo->lookupOptions()) ?>;
	freceiptadd.lists["x_ChargeCode"] = <?php echo $receipt_add->ChargeCode->Lookup->toClientList($receipt_add) ?>;
	freceiptadd.lists["x_ChargeCode"].options = <?php echo JsonEncode($receipt_add->ChargeCode->lookupOptions()) ?>;
	freceiptadd.autoSuggests["x_ChargeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	freceiptadd.lists["x_PaymentMethod"] = <?php echo $receipt_add->PaymentMethod->Lookup->toClientList($receipt_add) ?>;
	freceiptadd.lists["x_PaymentMethod"].options = <?php echo JsonEncode($receipt_add->PaymentMethod->lookupOptions()) ?>;
	loadjs.done("freceiptadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $receipt_add->showPageHeader(); ?>
<?php
$receipt_add->showMessage();
?>
<form name="freceiptadd" id="freceiptadd" class="<?php echo $receipt_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="receipt">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$receipt_add->IsModal ?>">
<?php if ($receipt->getCurrentMasterTable() == "receipt_header") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="receipt_header">
<input type="hidden" name="fk_ClientSerNo" value="<?php echo HtmlEncode($receipt_add->ClientSerNo->getSessionValue()) ?>">
<input type="hidden" name="fk_ReceiptNo" value="<?php echo HtmlEncode($receipt_add->ReceiptNo->getSessionValue()) ?>">
<input type="hidden" name="fk_PaymentMethod" value="<?php echo HtmlEncode($receipt_add->PaymentMethod->getSessionValue()) ?>">
<input type="hidden" name="fk_ChargeGroup" value="<?php echo HtmlEncode($receipt_add->ChargeGroup->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($receipt_add->ClientSerNo->Visible) { // ClientSerNo ?>
	<div id="r_ClientSerNo" class="form-group row">
		<label id="elh_receipt_ClientSerNo" for="x_ClientSerNo" class="<?php echo $receipt_add->LeftColumnClass ?>"><?php echo $receipt_add->ClientSerNo->caption() ?><?php echo $receipt_add->ClientSerNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_add->RightColumnClass ?>"><div <?php echo $receipt_add->ClientSerNo->cellAttributes() ?>>
<?php if ($receipt_add->ClientSerNo->getSessionValue() != "") { ?>
<span id="el_receipt_ClientSerNo">
<span<?php echo $receipt_add->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_add->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ClientSerNo" name="x_ClientSerNo" value="<?php echo HtmlEncode($receipt_add->ClientSerNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_receipt_ClientSerNo">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ClientSerNo"><?php echo EmptyValue(strval($receipt_add->ClientSerNo->ViewValue)) ? $Language->phrase("PleaseSelect") : $receipt_add->ClientSerNo->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($receipt_add->ClientSerNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($receipt_add->ClientSerNo->ReadOnly || $receipt_add->ClientSerNo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ClientSerNo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $receipt_add->ClientSerNo->Lookup->getParamTag($receipt_add, "p_x_ClientSerNo") ?>
<input type="hidden" data-table="receipt" data-field="x_ClientSerNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $receipt_add->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x_ClientSerNo" id="x_ClientSerNo" value="<?php echo $receipt_add->ClientSerNo->CurrentValue ?>"<?php echo $receipt_add->ClientSerNo->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $receipt_add->ClientSerNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_add->ChargeCode->Visible) { // ChargeCode ?>
	<div id="r_ChargeCode" class="form-group row">
		<label id="elh_receipt_ChargeCode" class="<?php echo $receipt_add->LeftColumnClass ?>"><?php echo $receipt_add->ChargeCode->caption() ?><?php echo $receipt_add->ChargeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_add->RightColumnClass ?>"><div <?php echo $receipt_add->ChargeCode->cellAttributes() ?>>
<span id="el_receipt_ChargeCode">
<?php
$onchange = $receipt_add->ChargeCode->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipt_add->ChargeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ChargeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ChargeCode" id="sv_x_ChargeCode" value="<?php echo RemoveHtml($receipt_add->ChargeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($receipt_add->ChargeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipt_add->ChargeCode->getPlaceHolder()) ?>"<?php echo $receipt_add->ChargeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($receipt_add->ChargeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($receipt_add->ChargeCode->ReadOnly || $receipt_add->ChargeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="receipt" data-field="x_ChargeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $receipt_add->ChargeCode->displayValueSeparatorAttribute() ?>" name="x_ChargeCode" id="x_ChargeCode" value="<?php echo HtmlEncode($receipt_add->ChargeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceiptadd"], function() {
	freceiptadd.createAutoSuggest({"id":"x_ChargeCode","forceSelect":true});
});
</script>
<?php echo $receipt_add->ChargeCode->Lookup->getParamTag($receipt_add, "p_x_ChargeCode") ?>
</span>
<?php echo $receipt_add->ChargeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_add->ItemID->Visible) { // ItemID ?>
	<div id="r_ItemID" class="form-group row">
		<label id="elh_receipt_ItemID" for="x_ItemID" class="<?php echo $receipt_add->LeftColumnClass ?>"><?php echo $receipt_add->ItemID->caption() ?><?php echo $receipt_add->ItemID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_add->RightColumnClass ?>"><div <?php echo $receipt_add->ItemID->cellAttributes() ?>>
<span id="el_receipt_ItemID">
<input type="text" data-table="receipt" data-field="x_ItemID" name="x_ItemID" id="x_ItemID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($receipt_add->ItemID->getPlaceHolder()) ?>" value="<?php echo $receipt_add->ItemID->EditValue ?>"<?php echo $receipt_add->ItemID->editAttributes() ?>>
</span>
<?php echo $receipt_add->ItemID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_add->UnitCost->Visible) { // UnitCost ?>
	<div id="r_UnitCost" class="form-group row">
		<label id="elh_receipt_UnitCost" for="x_UnitCost" class="<?php echo $receipt_add->LeftColumnClass ?>"><?php echo $receipt_add->UnitCost->caption() ?><?php echo $receipt_add->UnitCost->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_add->RightColumnClass ?>"><div <?php echo $receipt_add->UnitCost->cellAttributes() ?>>
<span id="el_receipt_UnitCost">
<input type="text" data-table="receipt" data-field="x_UnitCost" name="x_UnitCost" id="x_UnitCost" size="30" placeholder="<?php echo HtmlEncode($receipt_add->UnitCost->getPlaceHolder()) ?>" value="<?php echo $receipt_add->UnitCost->EditValue ?>"<?php echo $receipt_add->UnitCost->editAttributes() ?>>
</span>
<?php echo $receipt_add->UnitCost->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_add->Quantity->Visible) { // Quantity ?>
	<div id="r_Quantity" class="form-group row">
		<label id="elh_receipt_Quantity" for="x_Quantity" class="<?php echo $receipt_add->LeftColumnClass ?>"><?php echo $receipt_add->Quantity->caption() ?><?php echo $receipt_add->Quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_add->RightColumnClass ?>"><div <?php echo $receipt_add->Quantity->cellAttributes() ?>>
<span id="el_receipt_Quantity">
<input type="text" data-table="receipt" data-field="x_Quantity" name="x_Quantity" id="x_Quantity" size="30" placeholder="<?php echo HtmlEncode($receipt_add->Quantity->getPlaceHolder()) ?>" value="<?php echo $receipt_add->Quantity->EditValue ?>"<?php echo $receipt_add->Quantity->editAttributes() ?>>
</span>
<?php echo $receipt_add->Quantity->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_add->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<div id="r_UnitOfMeasure" class="form-group row">
		<label id="elh_receipt_UnitOfMeasure" for="x_UnitOfMeasure" class="<?php echo $receipt_add->LeftColumnClass ?>"><?php echo $receipt_add->UnitOfMeasure->caption() ?><?php echo $receipt_add->UnitOfMeasure->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_add->RightColumnClass ?>"><div <?php echo $receipt_add->UnitOfMeasure->cellAttributes() ?>>
<span id="el_receipt_UnitOfMeasure">
<input type="text" data-table="receipt" data-field="x_UnitOfMeasure" name="x_UnitOfMeasure" id="x_UnitOfMeasure" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($receipt_add->UnitOfMeasure->getPlaceHolder()) ?>" value="<?php echo $receipt_add->UnitOfMeasure->EditValue ?>"<?php echo $receipt_add->UnitOfMeasure->editAttributes() ?>>
</span>
<?php echo $receipt_add->UnitOfMeasure->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_add->AmountPaid->Visible) { // AmountPaid ?>
	<div id="r_AmountPaid" class="form-group row">
		<label id="elh_receipt_AmountPaid" for="x_AmountPaid" class="<?php echo $receipt_add->LeftColumnClass ?>"><?php echo $receipt_add->AmountPaid->caption() ?><?php echo $receipt_add->AmountPaid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_add->RightColumnClass ?>"><div <?php echo $receipt_add->AmountPaid->cellAttributes() ?>>
<span id="el_receipt_AmountPaid">
<input type="text" data-table="receipt" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($receipt_add->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $receipt_add->AmountPaid->EditValue ?>"<?php echo $receipt_add->AmountPaid->editAttributes() ?>>
</span>
<?php echo $receipt_add->AmountPaid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_add->ReceiptNo->Visible) { // ReceiptNo ?>
	<div id="r_ReceiptNo" class="form-group row">
		<label id="elh_receipt_ReceiptNo" for="x_ReceiptNo" class="<?php echo $receipt_add->LeftColumnClass ?>"><?php echo $receipt_add->ReceiptNo->caption() ?><?php echo $receipt_add->ReceiptNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_add->RightColumnClass ?>"><div <?php echo $receipt_add->ReceiptNo->cellAttributes() ?>>
<?php if ($receipt_add->ReceiptNo->getSessionValue() != "") { ?>
<span id="el_receipt_ReceiptNo">
<span<?php echo $receipt_add->ReceiptNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_add->ReceiptNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ReceiptNo" name="x_ReceiptNo" value="<?php echo HtmlEncode($receipt_add->ReceiptNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_receipt_ReceiptNo">
<input type="text" data-table="receipt" data-field="x_ReceiptNo" name="x_ReceiptNo" id="x_ReceiptNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($receipt_add->ReceiptNo->getPlaceHolder()) ?>" value="<?php echo $receipt_add->ReceiptNo->EditValue ?>"<?php echo $receipt_add->ReceiptNo->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $receipt_add->ReceiptNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_add->PaymentMethod->Visible) { // PaymentMethod ?>
	<div id="r_PaymentMethod" class="form-group row">
		<label id="elh_receipt_PaymentMethod" for="x_PaymentMethod" class="<?php echo $receipt_add->LeftColumnClass ?>"><?php echo $receipt_add->PaymentMethod->caption() ?><?php echo $receipt_add->PaymentMethod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_add->RightColumnClass ?>"><div <?php echo $receipt_add->PaymentMethod->cellAttributes() ?>>
<?php if ($receipt_add->PaymentMethod->getSessionValue() != "") { ?>
<span id="el_receipt_PaymentMethod">
<span<?php echo $receipt_add->PaymentMethod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_add->PaymentMethod->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_PaymentMethod" name="x_PaymentMethod" value="<?php echo HtmlEncode($receipt_add->PaymentMethod->CurrentValue) ?>">
<?php } else { ?>
<span id="el_receipt_PaymentMethod">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="receipt" data-field="x_PaymentMethod" data-value-separator="<?php echo $receipt_add->PaymentMethod->displayValueSeparatorAttribute() ?>" id="x_PaymentMethod" name="x_PaymentMethod"<?php echo $receipt_add->PaymentMethod->editAttributes() ?>>
			<?php echo $receipt_add->PaymentMethod->selectOptionListHtml("x_PaymentMethod") ?>
		</select>
</div>
<?php echo $receipt_add->PaymentMethod->Lookup->getParamTag($receipt_add, "p_x_PaymentMethod") ?>
</span>
<?php } ?>
<?php echo $receipt_add->PaymentMethod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_add->PaymentRef->Visible) { // PaymentRef ?>
	<div id="r_PaymentRef" class="form-group row">
		<label id="elh_receipt_PaymentRef" for="x_PaymentRef" class="<?php echo $receipt_add->LeftColumnClass ?>"><?php echo $receipt_add->PaymentRef->caption() ?><?php echo $receipt_add->PaymentRef->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_add->RightColumnClass ?>"><div <?php echo $receipt_add->PaymentRef->cellAttributes() ?>>
<span id="el_receipt_PaymentRef">
<input type="text" data-table="receipt" data-field="x_PaymentRef" name="x_PaymentRef" id="x_PaymentRef" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipt_add->PaymentRef->getPlaceHolder()) ?>" value="<?php echo $receipt_add->PaymentRef->EditValue ?>"<?php echo $receipt_add->PaymentRef->editAttributes() ?>>
</span>
<?php echo $receipt_add->PaymentRef->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_add->BillPeriod->Visible) { // BillPeriod ?>
	<div id="r_BillPeriod" class="form-group row">
		<label id="elh_receipt_BillPeriod" for="x_BillPeriod" class="<?php echo $receipt_add->LeftColumnClass ?>"><?php echo $receipt_add->BillPeriod->caption() ?><?php echo $receipt_add->BillPeriod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_add->RightColumnClass ?>"><div <?php echo $receipt_add->BillPeriod->cellAttributes() ?>>
<span id="el_receipt_BillPeriod">
<input type="text" data-table="receipt" data-field="x_BillPeriod" name="x_BillPeriod" id="x_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($receipt_add->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $receipt_add->BillPeriod->EditValue ?>"<?php echo $receipt_add->BillPeriod->editAttributes() ?>>
</span>
<?php echo $receipt_add->BillPeriod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_add->BillYear->Visible) { // BillYear ?>
	<div id="r_BillYear" class="form-group row">
		<label id="elh_receipt_BillYear" for="x_BillYear" class="<?php echo $receipt_add->LeftColumnClass ?>"><?php echo $receipt_add->BillYear->caption() ?><?php echo $receipt_add->BillYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_add->RightColumnClass ?>"><div <?php echo $receipt_add->BillYear->cellAttributes() ?>>
<span id="el_receipt_BillYear">
<input type="text" data-table="receipt" data-field="x_BillYear" name="x_BillYear" id="x_BillYear" size="30" placeholder="<?php echo HtmlEncode($receipt_add->BillYear->getPlaceHolder()) ?>" value="<?php echo $receipt_add->BillYear->EditValue ?>"<?php echo $receipt_add->BillYear->editAttributes() ?>>
</span>
<?php echo $receipt_add->BillYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_add->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label id="elh_receipt_ChargeGroup" for="x_ChargeGroup" class="<?php echo $receipt_add->LeftColumnClass ?>"><?php echo $receipt_add->ChargeGroup->caption() ?><?php echo $receipt_add->ChargeGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_add->RightColumnClass ?>"><div <?php echo $receipt_add->ChargeGroup->cellAttributes() ?>>
<?php if ($receipt_add->ChargeGroup->getSessionValue() != "") { ?>
<span id="el_receipt_ChargeGroup">
<span<?php echo $receipt_add->ChargeGroup->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_add->ChargeGroup->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ChargeGroup" name="x_ChargeGroup" value="<?php echo HtmlEncode($receipt_add->ChargeGroup->CurrentValue) ?>">
<?php } else { ?>
<span id="el_receipt_ChargeGroup">
<input type="text" data-table="receipt" data-field="x_ChargeGroup" name="x_ChargeGroup" id="x_ChargeGroup" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($receipt_add->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $receipt_add->ChargeGroup->EditValue ?>"<?php echo $receipt_add->ChargeGroup->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $receipt_add->ChargeGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_add->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label id="elh_receipt_ClientID" for="x_ClientID" class="<?php echo $receipt_add->LeftColumnClass ?>"><?php echo $receipt_add->ClientID->caption() ?><?php echo $receipt_add->ClientID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_add->RightColumnClass ?>"><div <?php echo $receipt_add->ClientID->cellAttributes() ?>>
<span id="el_receipt_ClientID">
<input type="text" data-table="receipt" data-field="x_ClientID" name="x_ClientID" id="x_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($receipt_add->ClientID->getPlaceHolder()) ?>" value="<?php echo $receipt_add->ClientID->EditValue ?>"<?php echo $receipt_add->ClientID->editAttributes() ?>>
</span>
<?php echo $receipt_add->ClientID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_add->PrintedReceipt->Visible) { // PrintedReceipt ?>
	<div id="r_PrintedReceipt" class="form-group row">
		<label id="elh_receipt_PrintedReceipt" for="x_PrintedReceipt" class="<?php echo $receipt_add->LeftColumnClass ?>"><?php echo $receipt_add->PrintedReceipt->caption() ?><?php echo $receipt_add->PrintedReceipt->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_add->RightColumnClass ?>"><div <?php echo $receipt_add->PrintedReceipt->cellAttributes() ?>>
<span id="el_receipt_PrintedReceipt">
<textarea data-table="receipt" data-field="x_PrintedReceipt" name="x_PrintedReceipt" id="x_PrintedReceipt" cols="35" rows="4" placeholder="<?php echo HtmlEncode($receipt_add->PrintedReceipt->getPlaceHolder()) ?>"<?php echo $receipt_add->PrintedReceipt->editAttributes() ?>><?php echo $receipt_add->PrintedReceipt->EditValue ?></textarea>
</span>
<?php echo $receipt_add->PrintedReceipt->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$receipt_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $receipt_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $receipt_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$receipt_add->showPageFooter();
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
$receipt_add->terminate();
?>