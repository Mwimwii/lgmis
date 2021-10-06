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
$receipt_header_add = new receipt_header_add();

// Run the page
$receipt_header_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$receipt_header_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var freceipt_headeradd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	freceipt_headeradd = currentForm = new ew.Form("freceipt_headeradd", "add");

	// Validate form
	freceipt_headeradd.validate = function() {
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
			<?php if ($receipt_header_add->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_add->ChargeGroup->caption(), $receipt_header_add->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_header_add->ClientSerNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_add->ClientSerNo->caption(), $receipt_header_add->ClientSerNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_header_add->ClientSerNo->errorMessage()) ?>");
			<?php if ($receipt_header_add->ReceiptPrefix->Required) { ?>
				elm = this.getElements("x" + infix + "_ReceiptPrefix");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_add->ReceiptPrefix->caption(), $receipt_header_add->ReceiptPrefix->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_header_add->AccountBased->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountBased");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_add->AccountBased->caption(), $receipt_header_add->AccountBased->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_header_add->Cashier->Required) { ?>
				elm = this.getElements("x" + infix + "_Cashier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_add->Cashier->caption(), $receipt_header_add->Cashier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_header_add->ReceiptDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ReceiptDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_add->ReceiptDate->caption(), $receipt_header_add->ReceiptDate->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_header_add->PaymentMethod->Required) { ?>
				elm = this.getElements("x" + infix + "_PaymentMethod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_add->PaymentMethod->caption(), $receipt_header_add->PaymentMethod->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_header_add->PaidBy->Required) { ?>
				elm = this.getElements("x" + infix + "_PaidBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_add->PaidBy->caption(), $receipt_header_add->PaidBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_header_add->TotalDue->Required) { ?>
				elm = this.getElements("x" + infix + "_TotalDue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_add->TotalDue->caption(), $receipt_header_add->TotalDue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TotalDue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_header_add->TotalDue->errorMessage()) ?>");
			<?php if ($receipt_header_add->AmountTendered->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountTendered");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_add->AmountTendered->caption(), $receipt_header_add->AmountTendered->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountTendered");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_header_add->AmountTendered->errorMessage()) ?>");
			<?php if ($receipt_header_add->Change->Required) { ?>
				elm = this.getElements("x" + infix + "_Change");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_add->Change->caption(), $receipt_header_add->Change->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Change");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_header_add->Change->errorMessage()) ?>");
			<?php if ($receipt_header_add->ClientMessage->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientMessage");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_add->ClientMessage->caption(), $receipt_header_add->ClientMessage->RequiredErrorMessage)) ?>");
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
	freceipt_headeradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	freceipt_headeradd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	freceipt_headeradd.lists["x_ChargeGroup"] = <?php echo $receipt_header_add->ChargeGroup->Lookup->toClientList($receipt_header_add) ?>;
	freceipt_headeradd.lists["x_ChargeGroup"].options = <?php echo JsonEncode($receipt_header_add->ChargeGroup->lookupOptions()) ?>;
	freceipt_headeradd.lists["x_ClientSerNo"] = <?php echo $receipt_header_add->ClientSerNo->Lookup->toClientList($receipt_header_add) ?>;
	freceipt_headeradd.lists["x_ClientSerNo"].options = <?php echo JsonEncode($receipt_header_add->ClientSerNo->lookupOptions()) ?>;
	freceipt_headeradd.autoSuggests["x_ClientSerNo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	freceipt_headeradd.lists["x_AccountBased"] = <?php echo $receipt_header_add->AccountBased->Lookup->toClientList($receipt_header_add) ?>;
	freceipt_headeradd.lists["x_AccountBased"].options = <?php echo JsonEncode($receipt_header_add->AccountBased->lookupOptions()) ?>;
	freceipt_headeradd.lists["x_PaymentMethod"] = <?php echo $receipt_header_add->PaymentMethod->Lookup->toClientList($receipt_header_add) ?>;
	freceipt_headeradd.lists["x_PaymentMethod"].options = <?php echo JsonEncode($receipt_header_add->PaymentMethod->lookupOptions()) ?>;
	loadjs.done("freceipt_headeradd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $receipt_header_add->showPageHeader(); ?>
<?php
$receipt_header_add->showMessage();
?>
<form name="freceipt_headeradd" id="freceipt_headeradd" class="<?php echo $receipt_header_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="receipt_header">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$receipt_header_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($receipt_header_add->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label id="elh_receipt_header_ChargeGroup" for="x_ChargeGroup" class="<?php echo $receipt_header_add->LeftColumnClass ?>"><?php echo $receipt_header_add->ChargeGroup->caption() ?><?php echo $receipt_header_add->ChargeGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_add->RightColumnClass ?>"><div <?php echo $receipt_header_add->ChargeGroup->cellAttributes() ?>>
<span id="el_receipt_header_ChargeGroup">
<?php $receipt_header_add->ChargeGroup->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ChargeGroup"><?php echo EmptyValue(strval($receipt_header_add->ChargeGroup->ViewValue)) ? $Language->phrase("PleaseSelect") : $receipt_header_add->ChargeGroup->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($receipt_header_add->ChargeGroup->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($receipt_header_add->ChargeGroup->ReadOnly || $receipt_header_add->ChargeGroup->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeGroup',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $receipt_header_add->ChargeGroup->Lookup->getParamTag($receipt_header_add, "p_x_ChargeGroup") ?>
<input type="hidden" data-table="receipt_header" data-field="x_ChargeGroup" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $receipt_header_add->ChargeGroup->displayValueSeparatorAttribute() ?>" name="x_ChargeGroup" id="x_ChargeGroup" value="<?php echo $receipt_header_add->ChargeGroup->CurrentValue ?>"<?php echo $receipt_header_add->ChargeGroup->editAttributes() ?>>
</span>
<?php echo $receipt_header_add->ChargeGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_add->ClientSerNo->Visible) { // ClientSerNo ?>
	<div id="r_ClientSerNo" class="form-group row">
		<label id="elh_receipt_header_ClientSerNo" class="<?php echo $receipt_header_add->LeftColumnClass ?>"><?php echo $receipt_header_add->ClientSerNo->caption() ?><?php echo $receipt_header_add->ClientSerNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_add->RightColumnClass ?>"><div <?php echo $receipt_header_add->ClientSerNo->cellAttributes() ?>>
<span id="el_receipt_header_ClientSerNo">
<?php
$onchange = $receipt_header_add->ClientSerNo->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipt_header_add->ClientSerNo->EditAttrs["onchange"] = "";
?>
<span id="as_x_ClientSerNo">
	<input type="text" class="form-control" name="sv_x_ClientSerNo" id="sv_x_ClientSerNo" value="<?php echo RemoveHtml($receipt_header_add->ClientSerNo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($receipt_header_add->ClientSerNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipt_header_add->ClientSerNo->getPlaceHolder()) ?>"<?php echo $receipt_header_add->ClientSerNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt_header" data-field="x_ClientSerNo" data-value-separator="<?php echo $receipt_header_add->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x_ClientSerNo" id="x_ClientSerNo" value="<?php echo HtmlEncode($receipt_header_add->ClientSerNo->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceipt_headeradd"], function() {
	freceipt_headeradd.createAutoSuggest({"id":"x_ClientSerNo","forceSelect":true});
});
</script>
<?php echo $receipt_header_add->ClientSerNo->Lookup->getParamTag($receipt_header_add, "p_x_ClientSerNo") ?>
</span>
<?php echo $receipt_header_add->ClientSerNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_add->ReceiptPrefix->Visible) { // ReceiptPrefix ?>
	<div id="r_ReceiptPrefix" class="form-group row">
		<label id="elh_receipt_header_ReceiptPrefix" for="x_ReceiptPrefix" class="<?php echo $receipt_header_add->LeftColumnClass ?>"><?php echo $receipt_header_add->ReceiptPrefix->caption() ?><?php echo $receipt_header_add->ReceiptPrefix->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_add->RightColumnClass ?>"><div <?php echo $receipt_header_add->ReceiptPrefix->cellAttributes() ?>>
<span id="el_receipt_header_ReceiptPrefix">
<input type="text" data-table="receipt_header" data-field="x_ReceiptPrefix" name="x_ReceiptPrefix" id="x_ReceiptPrefix" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($receipt_header_add->ReceiptPrefix->getPlaceHolder()) ?>" value="<?php echo $receipt_header_add->ReceiptPrefix->EditValue ?>"<?php echo $receipt_header_add->ReceiptPrefix->editAttributes() ?>>
</span>
<?php echo $receipt_header_add->ReceiptPrefix->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_add->AccountBased->Visible) { // AccountBased ?>
	<div id="r_AccountBased" class="form-group row">
		<label id="elh_receipt_header_AccountBased" class="<?php echo $receipt_header_add->LeftColumnClass ?>"><?php echo $receipt_header_add->AccountBased->caption() ?><?php echo $receipt_header_add->AccountBased->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_add->RightColumnClass ?>"><div <?php echo $receipt_header_add->AccountBased->cellAttributes() ?>>
<span id="el_receipt_header_AccountBased">
<div id="tp_x_AccountBased" class="ew-template"><input type="radio" class="custom-control-input" data-table="receipt_header" data-field="x_AccountBased" data-value-separator="<?php echo $receipt_header_add->AccountBased->displayValueSeparatorAttribute() ?>" name="x_AccountBased" id="x_AccountBased" value="{value}"<?php echo $receipt_header_add->AccountBased->editAttributes() ?>></div>
<div id="dsl_x_AccountBased" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $receipt_header_add->AccountBased->radioButtonListHtml(FALSE, "x_AccountBased") ?>
</div></div>
<?php echo $receipt_header_add->AccountBased->Lookup->getParamTag($receipt_header_add, "p_x_AccountBased") ?>
</span>
<?php echo $receipt_header_add->AccountBased->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_add->PaymentMethod->Visible) { // PaymentMethod ?>
	<div id="r_PaymentMethod" class="form-group row">
		<label id="elh_receipt_header_PaymentMethod" for="x_PaymentMethod" class="<?php echo $receipt_header_add->LeftColumnClass ?>"><?php echo $receipt_header_add->PaymentMethod->caption() ?><?php echo $receipt_header_add->PaymentMethod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_add->RightColumnClass ?>"><div <?php echo $receipt_header_add->PaymentMethod->cellAttributes() ?>>
<span id="el_receipt_header_PaymentMethod">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_PaymentMethod"><?php echo EmptyValue(strval($receipt_header_add->PaymentMethod->ViewValue)) ? $Language->phrase("PleaseSelect") : $receipt_header_add->PaymentMethod->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($receipt_header_add->PaymentMethod->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($receipt_header_add->PaymentMethod->ReadOnly || $receipt_header_add->PaymentMethod->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_PaymentMethod',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $receipt_header_add->PaymentMethod->Lookup->getParamTag($receipt_header_add, "p_x_PaymentMethod") ?>
<input type="hidden" data-table="receipt_header" data-field="x_PaymentMethod" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $receipt_header_add->PaymentMethod->displayValueSeparatorAttribute() ?>" name="x_PaymentMethod" id="x_PaymentMethod" value="<?php echo $receipt_header_add->PaymentMethod->CurrentValue ?>"<?php echo $receipt_header_add->PaymentMethod->editAttributes() ?>>
</span>
<?php echo $receipt_header_add->PaymentMethod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_add->PaidBy->Visible) { // PaidBy ?>
	<div id="r_PaidBy" class="form-group row">
		<label id="elh_receipt_header_PaidBy" for="x_PaidBy" class="<?php echo $receipt_header_add->LeftColumnClass ?>"><?php echo $receipt_header_add->PaidBy->caption() ?><?php echo $receipt_header_add->PaidBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_add->RightColumnClass ?>"><div <?php echo $receipt_header_add->PaidBy->cellAttributes() ?>>
<span id="el_receipt_header_PaidBy">
<input type="text" data-table="receipt_header" data-field="x_PaidBy" name="x_PaidBy" id="x_PaidBy" size="50" maxlength="80" placeholder="<?php echo HtmlEncode($receipt_header_add->PaidBy->getPlaceHolder()) ?>" value="<?php echo $receipt_header_add->PaidBy->EditValue ?>"<?php echo $receipt_header_add->PaidBy->editAttributes() ?>>
</span>
<?php echo $receipt_header_add->PaidBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_add->TotalDue->Visible) { // TotalDue ?>
	<div id="r_TotalDue" class="form-group row">
		<label id="elh_receipt_header_TotalDue" for="x_TotalDue" class="<?php echo $receipt_header_add->LeftColumnClass ?>"><?php echo $receipt_header_add->TotalDue->caption() ?><?php echo $receipt_header_add->TotalDue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_add->RightColumnClass ?>"><div <?php echo $receipt_header_add->TotalDue->cellAttributes() ?>>
<span id="el_receipt_header_TotalDue">
<input type="text" data-table="receipt_header" data-field="x_TotalDue" name="x_TotalDue" id="x_TotalDue" size="30" placeholder="<?php echo HtmlEncode($receipt_header_add->TotalDue->getPlaceHolder()) ?>" value="<?php echo $receipt_header_add->TotalDue->EditValue ?>"<?php echo $receipt_header_add->TotalDue->editAttributes() ?>>
</span>
<?php echo $receipt_header_add->TotalDue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_add->AmountTendered->Visible) { // AmountTendered ?>
	<div id="r_AmountTendered" class="form-group row">
		<label id="elh_receipt_header_AmountTendered" for="x_AmountTendered" class="<?php echo $receipt_header_add->LeftColumnClass ?>"><?php echo $receipt_header_add->AmountTendered->caption() ?><?php echo $receipt_header_add->AmountTendered->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_add->RightColumnClass ?>"><div <?php echo $receipt_header_add->AmountTendered->cellAttributes() ?>>
<span id="el_receipt_header_AmountTendered">
<input type="text" data-table="receipt_header" data-field="x_AmountTendered" name="x_AmountTendered" id="x_AmountTendered" size="30" placeholder="<?php echo HtmlEncode($receipt_header_add->AmountTendered->getPlaceHolder()) ?>" value="<?php echo $receipt_header_add->AmountTendered->EditValue ?>"<?php echo $receipt_header_add->AmountTendered->editAttributes() ?>>
</span>
<?php echo $receipt_header_add->AmountTendered->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_add->Change->Visible) { // Change ?>
	<div id="r_Change" class="form-group row">
		<label id="elh_receipt_header_Change" for="x_Change" class="<?php echo $receipt_header_add->LeftColumnClass ?>"><?php echo $receipt_header_add->Change->caption() ?><?php echo $receipt_header_add->Change->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_add->RightColumnClass ?>"><div <?php echo $receipt_header_add->Change->cellAttributes() ?>>
<span id="el_receipt_header_Change">
<input type="text" data-table="receipt_header" data-field="x_Change" name="x_Change" id="x_Change" size="30" placeholder="<?php echo HtmlEncode($receipt_header_add->Change->getPlaceHolder()) ?>" value="<?php echo $receipt_header_add->Change->EditValue ?>"<?php echo $receipt_header_add->Change->editAttributes() ?>>
</span>
<?php echo $receipt_header_add->Change->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_add->ClientMessage->Visible) { // ClientMessage ?>
	<div id="r_ClientMessage" class="form-group row">
		<label id="elh_receipt_header_ClientMessage" for="x_ClientMessage" class="<?php echo $receipt_header_add->LeftColumnClass ?>"><?php echo $receipt_header_add->ClientMessage->caption() ?><?php echo $receipt_header_add->ClientMessage->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_add->RightColumnClass ?>"><div <?php echo $receipt_header_add->ClientMessage->cellAttributes() ?>>
<span id="el_receipt_header_ClientMessage">
<input type="text" data-table="receipt_header" data-field="x_ClientMessage" name="x_ClientMessage" id="x_ClientMessage" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipt_header_add->ClientMessage->getPlaceHolder()) ?>" value="<?php echo $receipt_header_add->ClientMessage->EditValue ?>"<?php echo $receipt_header_add->ClientMessage->editAttributes() ?>>
</span>
<?php echo $receipt_header_add->ClientMessage->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("receipt", explode(",", $receipt_header->getCurrentDetailTable())) && $receipt->DetailAdd) {
?>
<?php if ($receipt_header->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("receipt", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "receiptgrid.php" ?>
<?php } ?>
<?php if (!$receipt_header_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $receipt_header_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $receipt_header_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$receipt_header_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$("#x_ClientSerNo, #x_ChargeGroup").change(function(){var e=$("#x_ChargeGroup").val(),a=$("#x_ClientSerNo").val();if(""!=e&&""!=a){var o=ew.API_URL;$.get(o+"?action=getRatesAccounts&ClientSerNo="+a+"&ChargeGroup="+e,function(a){$(this.form).serialize();if("&action="+encodeURIComponent("add")+"&object="+encodeURIComponent("charge_group"),a){var o=Object.keys(a).length;o>1&&(o-=1);var t=0,n=0,l=0,r=0,_=0,v=0,i=0,c=0;$.each(a,function(a,o){if(t++,c=o.ChargeCode,r=o.BalanceBF,r=parseFloat(r)||0,l=o.CurrentDemand,l=parseFloat(l)||0,_=o.VAT,_=parseFloat(_)||0,v=o.AmountPaid,v=parseFloat(v)||0,n+=i=r+l+_-v,"RT"==e||"BB"==e||"LC"==e||"CO"==e||"GR"==e)var d=$("#x"+t+"_ChargeCode").val(c);"RT"==e&&($("#x"+t+"_ItemID").val(o.ValuationNo),$("#x"+t+"_PaymentRef").val(o.PropertyNo)),"BB"==e&&($("#x"+t+"_ItemID").val(o.BillBoardNo),$("#x"+t+"_PaymentRef").val(o.BillBoardNo)),"LC"==e&&($("#x"+t+"_ItemID").val(o.LicenceNo),$("#x"+t+"_PaymentRef").val(o.BusinessyNo)),"CO"==e&&($("#x"+t+"_ItemID").val(o.AccountNo),$("#x"+t+"_PaymentRef").val(o.PropertyNo)),"GR"==e&&($("#x"+t+"_ItemID").val(o.ValuationNo),$("#x"+t+"_PaymentRef").val(o.PropertyNo)),$("#x"+t+"_UnitCost").val(i),$("#x"+t+"_AmountPaid").val(i),$("#x"+t+"_BillPeriod").val(o.BillPeriod),$("#x"+t+"_BillYear").val(o.BillYear),$("select#x"+t+"_ChargeCode").val(d),total_tendered=$("#x_AmountTendered").val(),total_tendered=parseFloat(total_tendered),n=parseFloat(n),change=total_tendered-n,$("#x_TotalDue").val(n),$("#x_Change").val(change)})}})}}),$("#x_AmountTendered").on("focus input change",function(){var e=$("#x_AmountTendered").val(),a=$("#x_TotalDue").val();change=e-a,$("#x_Change").val(change)}),$("#x1_AmountPaid").on("focus input change",function(){var e=$("#x1_AmountPaid").val();$("#x_TotalDue").val(e);var a=$("#x_AmountTendered").val();change=a-e,$("#x_Change").val(change)});
});
</script>
<?php include_once "footer.php"; ?>
<?php
$receipt_header_add->terminate();
?>