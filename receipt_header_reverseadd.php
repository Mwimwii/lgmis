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
$receipt_header_reverse_add = new receipt_header_reverse_add();

// Run the page
$receipt_header_reverse_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$receipt_header_reverse_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var freceipt_header_reverseadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	freceipt_header_reverseadd = currentForm = new ew.Form("freceipt_header_reverseadd", "add");

	// Validate form
	freceipt_header_reverseadd.validate = function() {
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
			<?php if ($receipt_header_reverse_add->ReceiptNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ReceiptNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_reverse_add->ReceiptNo->caption(), $receipt_header_reverse_add->ReceiptNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ReceiptNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_header_reverse_add->ReceiptNo->errorMessage()) ?>");
			<?php if ($receipt_header_reverse_add->ClientSerNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_reverse_add->ClientSerNo->caption(), $receipt_header_reverse_add->ClientSerNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_header_reverse_add->ClientSerNo->errorMessage()) ?>");
			<?php if ($receipt_header_reverse_add->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_reverse_add->ClientID->caption(), $receipt_header_reverse_add->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_header_reverse_add->PaidBy->Required) { ?>
				elm = this.getElements("x" + infix + "_PaidBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_reverse_add->PaidBy->caption(), $receipt_header_reverse_add->PaidBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_header_reverse_add->ClientPostalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientPostalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_reverse_add->ClientPostalAddress->caption(), $receipt_header_reverse_add->ClientPostalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_header_reverse_add->ClientPhysicalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientPhysicalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_reverse_add->ClientPhysicalAddress->caption(), $receipt_header_reverse_add->ClientPhysicalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_header_reverse_add->ClientEmail->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientEmail");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_reverse_add->ClientEmail->caption(), $receipt_header_reverse_add->ClientEmail->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_header_reverse_add->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_reverse_add->ChargeGroup->caption(), $receipt_header_reverse_add->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_header_reverse_add->ReceiptPrefix->Required) { ?>
				elm = this.getElements("x" + infix + "_ReceiptPrefix");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_reverse_add->ReceiptPrefix->caption(), $receipt_header_reverse_add->ReceiptPrefix->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_header_reverse_add->AccountBased->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountBased[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_reverse_add->AccountBased->caption(), $receipt_header_reverse_add->AccountBased->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_header_reverse_add->Cashier->Required) { ?>
				elm = this.getElements("x" + infix + "_Cashier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_reverse_add->Cashier->caption(), $receipt_header_reverse_add->Cashier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_header_reverse_add->ReceiptDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ReceiptDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_reverse_add->ReceiptDate->caption(), $receipt_header_reverse_add->ReceiptDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ReceiptDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_header_reverse_add->ReceiptDate->errorMessage()) ?>");
			<?php if ($receipt_header_reverse_add->PaymentMethod->Required) { ?>
				elm = this.getElements("x" + infix + "_PaymentMethod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_reverse_add->PaymentMethod->caption(), $receipt_header_reverse_add->PaymentMethod->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_header_reverse_add->TotalDue->Required) { ?>
				elm = this.getElements("x" + infix + "_TotalDue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_reverse_add->TotalDue->caption(), $receipt_header_reverse_add->TotalDue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TotalDue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_header_reverse_add->TotalDue->errorMessage()) ?>");
			<?php if ($receipt_header_reverse_add->AmountTendered->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountTendered");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_reverse_add->AmountTendered->caption(), $receipt_header_reverse_add->AmountTendered->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountTendered");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_header_reverse_add->AmountTendered->errorMessage()) ?>");
			<?php if ($receipt_header_reverse_add->Change->Required) { ?>
				elm = this.getElements("x" + infix + "_Change");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_reverse_add->Change->caption(), $receipt_header_reverse_add->Change->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Change");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_header_reverse_add->Change->errorMessage()) ?>");
			<?php if ($receipt_header_reverse_add->ClientMessage->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientMessage");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_reverse_add->ClientMessage->caption(), $receipt_header_reverse_add->ClientMessage->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_header_reverse_add->Reasons->Required) { ?>
				elm = this.getElements("x" + infix + "_Reasons");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_header_reverse_add->Reasons->caption(), $receipt_header_reverse_add->Reasons->RequiredErrorMessage)) ?>");
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
	freceipt_header_reverseadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	freceipt_header_reverseadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	freceipt_header_reverseadd.lists["x_ReceiptNo"] = <?php echo $receipt_header_reverse_add->ReceiptNo->Lookup->toClientList($receipt_header_reverse_add) ?>;
	freceipt_header_reverseadd.lists["x_ReceiptNo"].options = <?php echo JsonEncode($receipt_header_reverse_add->ReceiptNo->lookupOptions()) ?>;
	freceipt_header_reverseadd.autoSuggests["x_ReceiptNo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	freceipt_header_reverseadd.lists["x_ClientSerNo"] = <?php echo $receipt_header_reverse_add->ClientSerNo->Lookup->toClientList($receipt_header_reverse_add) ?>;
	freceipt_header_reverseadd.lists["x_ClientSerNo"].options = <?php echo JsonEncode($receipt_header_reverse_add->ClientSerNo->lookupOptions()) ?>;
	freceipt_header_reverseadd.autoSuggests["x_ClientSerNo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	freceipt_header_reverseadd.lists["x_AccountBased[]"] = <?php echo $receipt_header_reverse_add->AccountBased->Lookup->toClientList($receipt_header_reverse_add) ?>;
	freceipt_header_reverseadd.lists["x_AccountBased[]"].options = <?php echo JsonEncode($receipt_header_reverse_add->AccountBased->options(FALSE, TRUE)) ?>;
	loadjs.done("freceipt_header_reverseadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $receipt_header_reverse_add->showPageHeader(); ?>
<?php
$receipt_header_reverse_add->showMessage();
?>
<form name="freceipt_header_reverseadd" id="freceipt_header_reverseadd" class="<?php echo $receipt_header_reverse_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="receipt_header_reverse">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$receipt_header_reverse_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($receipt_header_reverse_add->ReceiptNo->Visible) { // ReceiptNo ?>
	<div id="r_ReceiptNo" class="form-group row">
		<label id="elh_receipt_header_reverse_ReceiptNo" class="<?php echo $receipt_header_reverse_add->LeftColumnClass ?>"><?php echo $receipt_header_reverse_add->ReceiptNo->caption() ?><?php echo $receipt_header_reverse_add->ReceiptNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_reverse_add->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_add->ReceiptNo->cellAttributes() ?>>
<span id="el_receipt_header_reverse_ReceiptNo">
<?php
$onchange = $receipt_header_reverse_add->ReceiptNo->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipt_header_reverse_add->ReceiptNo->EditAttrs["onchange"] = "";
?>
<span id="as_x_ReceiptNo">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ReceiptNo" id="sv_x_ReceiptNo" value="<?php echo RemoveHtml($receipt_header_reverse_add->ReceiptNo->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($receipt_header_reverse_add->ReceiptNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipt_header_reverse_add->ReceiptNo->getPlaceHolder()) ?>"<?php echo $receipt_header_reverse_add->ReceiptNo->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($receipt_header_reverse_add->ReceiptNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ReceiptNo',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($receipt_header_reverse_add->ReceiptNo->ReadOnly || $receipt_header_reverse_add->ReceiptNo->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="receipt_header_reverse" data-field="x_ReceiptNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $receipt_header_reverse_add->ReceiptNo->displayValueSeparatorAttribute() ?>" name="x_ReceiptNo" id="x_ReceiptNo" value="<?php echo HtmlEncode($receipt_header_reverse_add->ReceiptNo->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceipt_header_reverseadd"], function() {
	freceipt_header_reverseadd.createAutoSuggest({"id":"x_ReceiptNo","forceSelect":true});
});
</script>
<?php echo $receipt_header_reverse_add->ReceiptNo->Lookup->getParamTag($receipt_header_reverse_add, "p_x_ReceiptNo") ?>
</span>
<?php echo $receipt_header_reverse_add->ReceiptNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_add->ClientSerNo->Visible) { // ClientSerNo ?>
	<div id="r_ClientSerNo" class="form-group row">
		<label id="elh_receipt_header_reverse_ClientSerNo" class="<?php echo $receipt_header_reverse_add->LeftColumnClass ?>"><?php echo $receipt_header_reverse_add->ClientSerNo->caption() ?><?php echo $receipt_header_reverse_add->ClientSerNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_reverse_add->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_add->ClientSerNo->cellAttributes() ?>>
<span id="el_receipt_header_reverse_ClientSerNo">
<?php
$onchange = $receipt_header_reverse_add->ClientSerNo->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipt_header_reverse_add->ClientSerNo->EditAttrs["onchange"] = "";
?>
<span id="as_x_ClientSerNo">
	<input type="text" class="form-control" name="sv_x_ClientSerNo" id="sv_x_ClientSerNo" value="<?php echo RemoveHtml($receipt_header_reverse_add->ClientSerNo->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($receipt_header_reverse_add->ClientSerNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipt_header_reverse_add->ClientSerNo->getPlaceHolder()) ?>"<?php echo $receipt_header_reverse_add->ClientSerNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt_header_reverse" data-field="x_ClientSerNo" data-value-separator="<?php echo $receipt_header_reverse_add->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x_ClientSerNo" id="x_ClientSerNo" value="<?php echo HtmlEncode($receipt_header_reverse_add->ClientSerNo->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceipt_header_reverseadd"], function() {
	freceipt_header_reverseadd.createAutoSuggest({"id":"x_ClientSerNo","forceSelect":true});
});
</script>
<?php echo $receipt_header_reverse_add->ClientSerNo->Lookup->getParamTag($receipt_header_reverse_add, "p_x_ClientSerNo") ?>
</span>
<?php echo $receipt_header_reverse_add->ClientSerNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_add->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label id="elh_receipt_header_reverse_ClientID" for="x_ClientID" class="<?php echo $receipt_header_reverse_add->LeftColumnClass ?>"><?php echo $receipt_header_reverse_add->ClientID->caption() ?><?php echo $receipt_header_reverse_add->ClientID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_reverse_add->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_add->ClientID->cellAttributes() ?>>
<span id="el_receipt_header_reverse_ClientID">
<input type="text" data-table="receipt_header_reverse" data-field="x_ClientID" name="x_ClientID" id="x_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($receipt_header_reverse_add->ClientID->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_add->ClientID->EditValue ?>"<?php echo $receipt_header_reverse_add->ClientID->editAttributes() ?>>
</span>
<?php echo $receipt_header_reverse_add->ClientID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_add->PaidBy->Visible) { // PaidBy ?>
	<div id="r_PaidBy" class="form-group row">
		<label id="elh_receipt_header_reverse_PaidBy" for="x_PaidBy" class="<?php echo $receipt_header_reverse_add->LeftColumnClass ?>"><?php echo $receipt_header_reverse_add->PaidBy->caption() ?><?php echo $receipt_header_reverse_add->PaidBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_reverse_add->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_add->PaidBy->cellAttributes() ?>>
<span id="el_receipt_header_reverse_PaidBy">
<input type="text" data-table="receipt_header_reverse" data-field="x_PaidBy" name="x_PaidBy" id="x_PaidBy" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($receipt_header_reverse_add->PaidBy->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_add->PaidBy->EditValue ?>"<?php echo $receipt_header_reverse_add->PaidBy->editAttributes() ?>>
</span>
<?php echo $receipt_header_reverse_add->PaidBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_add->ClientPostalAddress->Visible) { // ClientPostalAddress ?>
	<div id="r_ClientPostalAddress" class="form-group row">
		<label id="elh_receipt_header_reverse_ClientPostalAddress" for="x_ClientPostalAddress" class="<?php echo $receipt_header_reverse_add->LeftColumnClass ?>"><?php echo $receipt_header_reverse_add->ClientPostalAddress->caption() ?><?php echo $receipt_header_reverse_add->ClientPostalAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_reverse_add->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_add->ClientPostalAddress->cellAttributes() ?>>
<span id="el_receipt_header_reverse_ClientPostalAddress">
<input type="text" data-table="receipt_header_reverse" data-field="x_ClientPostalAddress" name="x_ClientPostalAddress" id="x_ClientPostalAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipt_header_reverse_add->ClientPostalAddress->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_add->ClientPostalAddress->EditValue ?>"<?php echo $receipt_header_reverse_add->ClientPostalAddress->editAttributes() ?>>
</span>
<?php echo $receipt_header_reverse_add->ClientPostalAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_add->ClientPhysicalAddress->Visible) { // ClientPhysicalAddress ?>
	<div id="r_ClientPhysicalAddress" class="form-group row">
		<label id="elh_receipt_header_reverse_ClientPhysicalAddress" for="x_ClientPhysicalAddress" class="<?php echo $receipt_header_reverse_add->LeftColumnClass ?>"><?php echo $receipt_header_reverse_add->ClientPhysicalAddress->caption() ?><?php echo $receipt_header_reverse_add->ClientPhysicalAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_reverse_add->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_add->ClientPhysicalAddress->cellAttributes() ?>>
<span id="el_receipt_header_reverse_ClientPhysicalAddress">
<input type="text" data-table="receipt_header_reverse" data-field="x_ClientPhysicalAddress" name="x_ClientPhysicalAddress" id="x_ClientPhysicalAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipt_header_reverse_add->ClientPhysicalAddress->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_add->ClientPhysicalAddress->EditValue ?>"<?php echo $receipt_header_reverse_add->ClientPhysicalAddress->editAttributes() ?>>
</span>
<?php echo $receipt_header_reverse_add->ClientPhysicalAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_add->ClientEmail->Visible) { // ClientEmail ?>
	<div id="r_ClientEmail" class="form-group row">
		<label id="elh_receipt_header_reverse_ClientEmail" for="x_ClientEmail" class="<?php echo $receipt_header_reverse_add->LeftColumnClass ?>"><?php echo $receipt_header_reverse_add->ClientEmail->caption() ?><?php echo $receipt_header_reverse_add->ClientEmail->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_reverse_add->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_add->ClientEmail->cellAttributes() ?>>
<span id="el_receipt_header_reverse_ClientEmail">
<input type="text" data-table="receipt_header_reverse" data-field="x_ClientEmail" name="x_ClientEmail" id="x_ClientEmail" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipt_header_reverse_add->ClientEmail->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_add->ClientEmail->EditValue ?>"<?php echo $receipt_header_reverse_add->ClientEmail->editAttributes() ?>>
</span>
<?php echo $receipt_header_reverse_add->ClientEmail->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_add->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label id="elh_receipt_header_reverse_ChargeGroup" for="x_ChargeGroup" class="<?php echo $receipt_header_reverse_add->LeftColumnClass ?>"><?php echo $receipt_header_reverse_add->ChargeGroup->caption() ?><?php echo $receipt_header_reverse_add->ChargeGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_reverse_add->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_add->ChargeGroup->cellAttributes() ?>>
<span id="el_receipt_header_reverse_ChargeGroup">
<input type="text" data-table="receipt_header_reverse" data-field="x_ChargeGroup" name="x_ChargeGroup" id="x_ChargeGroup" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($receipt_header_reverse_add->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_add->ChargeGroup->EditValue ?>"<?php echo $receipt_header_reverse_add->ChargeGroup->editAttributes() ?>>
</span>
<?php echo $receipt_header_reverse_add->ChargeGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_add->ReceiptPrefix->Visible) { // ReceiptPrefix ?>
	<div id="r_ReceiptPrefix" class="form-group row">
		<label id="elh_receipt_header_reverse_ReceiptPrefix" for="x_ReceiptPrefix" class="<?php echo $receipt_header_reverse_add->LeftColumnClass ?>"><?php echo $receipt_header_reverse_add->ReceiptPrefix->caption() ?><?php echo $receipt_header_reverse_add->ReceiptPrefix->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_reverse_add->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_add->ReceiptPrefix->cellAttributes() ?>>
<span id="el_receipt_header_reverse_ReceiptPrefix">
<input type="text" data-table="receipt_header_reverse" data-field="x_ReceiptPrefix" name="x_ReceiptPrefix" id="x_ReceiptPrefix" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($receipt_header_reverse_add->ReceiptPrefix->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_add->ReceiptPrefix->EditValue ?>"<?php echo $receipt_header_reverse_add->ReceiptPrefix->editAttributes() ?>>
</span>
<?php echo $receipt_header_reverse_add->ReceiptPrefix->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_add->AccountBased->Visible) { // AccountBased ?>
	<div id="r_AccountBased" class="form-group row">
		<label id="elh_receipt_header_reverse_AccountBased" class="<?php echo $receipt_header_reverse_add->LeftColumnClass ?>"><?php echo $receipt_header_reverse_add->AccountBased->caption() ?><?php echo $receipt_header_reverse_add->AccountBased->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_reverse_add->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_add->AccountBased->cellAttributes() ?>>
<span id="el_receipt_header_reverse_AccountBased">
<?php
$selwrk = ConvertToBool($receipt_header_reverse_add->AccountBased->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="receipt_header_reverse" data-field="x_AccountBased" name="x_AccountBased[]" id="x_AccountBased[]_499586" value="1"<?php echo $selwrk ?><?php echo $receipt_header_reverse_add->AccountBased->editAttributes() ?>>
	<label class="custom-control-label" for="x_AccountBased[]_499586"></label>
</div>
</span>
<?php echo $receipt_header_reverse_add->AccountBased->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_add->Cashier->Visible) { // Cashier ?>
	<div id="r_Cashier" class="form-group row">
		<label id="elh_receipt_header_reverse_Cashier" for="x_Cashier" class="<?php echo $receipt_header_reverse_add->LeftColumnClass ?>"><?php echo $receipt_header_reverse_add->Cashier->caption() ?><?php echo $receipt_header_reverse_add->Cashier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_reverse_add->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_add->Cashier->cellAttributes() ?>>
<span id="el_receipt_header_reverse_Cashier">
<input type="text" data-table="receipt_header_reverse" data-field="x_Cashier" name="x_Cashier" id="x_Cashier" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipt_header_reverse_add->Cashier->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_add->Cashier->EditValue ?>"<?php echo $receipt_header_reverse_add->Cashier->editAttributes() ?>>
</span>
<?php echo $receipt_header_reverse_add->Cashier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_add->ReceiptDate->Visible) { // ReceiptDate ?>
	<div id="r_ReceiptDate" class="form-group row">
		<label id="elh_receipt_header_reverse_ReceiptDate" for="x_ReceiptDate" class="<?php echo $receipt_header_reverse_add->LeftColumnClass ?>"><?php echo $receipt_header_reverse_add->ReceiptDate->caption() ?><?php echo $receipt_header_reverse_add->ReceiptDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_reverse_add->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_add->ReceiptDate->cellAttributes() ?>>
<span id="el_receipt_header_reverse_ReceiptDate">
<input type="text" data-table="receipt_header_reverse" data-field="x_ReceiptDate" name="x_ReceiptDate" id="x_ReceiptDate" maxlength="19" placeholder="<?php echo HtmlEncode($receipt_header_reverse_add->ReceiptDate->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_add->ReceiptDate->EditValue ?>"<?php echo $receipt_header_reverse_add->ReceiptDate->editAttributes() ?>>
<?php if (!$receipt_header_reverse_add->ReceiptDate->ReadOnly && !$receipt_header_reverse_add->ReceiptDate->Disabled && !isset($receipt_header_reverse_add->ReceiptDate->EditAttrs["readonly"]) && !isset($receipt_header_reverse_add->ReceiptDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freceipt_header_reverseadd", "datetimepicker"], function() {
	ew.createDateTimePicker("freceipt_header_reverseadd", "x_ReceiptDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $receipt_header_reverse_add->ReceiptDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_add->PaymentMethod->Visible) { // PaymentMethod ?>
	<div id="r_PaymentMethod" class="form-group row">
		<label id="elh_receipt_header_reverse_PaymentMethod" for="x_PaymentMethod" class="<?php echo $receipt_header_reverse_add->LeftColumnClass ?>"><?php echo $receipt_header_reverse_add->PaymentMethod->caption() ?><?php echo $receipt_header_reverse_add->PaymentMethod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_reverse_add->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_add->PaymentMethod->cellAttributes() ?>>
<span id="el_receipt_header_reverse_PaymentMethod">
<input type="text" data-table="receipt_header_reverse" data-field="x_PaymentMethod" name="x_PaymentMethod" id="x_PaymentMethod" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($receipt_header_reverse_add->PaymentMethod->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_add->PaymentMethod->EditValue ?>"<?php echo $receipt_header_reverse_add->PaymentMethod->editAttributes() ?>>
</span>
<?php echo $receipt_header_reverse_add->PaymentMethod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_add->TotalDue->Visible) { // TotalDue ?>
	<div id="r_TotalDue" class="form-group row">
		<label id="elh_receipt_header_reverse_TotalDue" for="x_TotalDue" class="<?php echo $receipt_header_reverse_add->LeftColumnClass ?>"><?php echo $receipt_header_reverse_add->TotalDue->caption() ?><?php echo $receipt_header_reverse_add->TotalDue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_reverse_add->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_add->TotalDue->cellAttributes() ?>>
<span id="el_receipt_header_reverse_TotalDue">
<input type="text" data-table="receipt_header_reverse" data-field="x_TotalDue" name="x_TotalDue" id="x_TotalDue" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($receipt_header_reverse_add->TotalDue->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_add->TotalDue->EditValue ?>"<?php echo $receipt_header_reverse_add->TotalDue->editAttributes() ?>>
</span>
<?php echo $receipt_header_reverse_add->TotalDue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_add->AmountTendered->Visible) { // AmountTendered ?>
	<div id="r_AmountTendered" class="form-group row">
		<label id="elh_receipt_header_reverse_AmountTendered" for="x_AmountTendered" class="<?php echo $receipt_header_reverse_add->LeftColumnClass ?>"><?php echo $receipt_header_reverse_add->AmountTendered->caption() ?><?php echo $receipt_header_reverse_add->AmountTendered->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_reverse_add->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_add->AmountTendered->cellAttributes() ?>>
<span id="el_receipt_header_reverse_AmountTendered">
<input type="text" data-table="receipt_header_reverse" data-field="x_AmountTendered" name="x_AmountTendered" id="x_AmountTendered" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($receipt_header_reverse_add->AmountTendered->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_add->AmountTendered->EditValue ?>"<?php echo $receipt_header_reverse_add->AmountTendered->editAttributes() ?>>
</span>
<?php echo $receipt_header_reverse_add->AmountTendered->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_add->Change->Visible) { // Change ?>
	<div id="r_Change" class="form-group row">
		<label id="elh_receipt_header_reverse_Change" for="x_Change" class="<?php echo $receipt_header_reverse_add->LeftColumnClass ?>"><?php echo $receipt_header_reverse_add->Change->caption() ?><?php echo $receipt_header_reverse_add->Change->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_reverse_add->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_add->Change->cellAttributes() ?>>
<span id="el_receipt_header_reverse_Change">
<input type="text" data-table="receipt_header_reverse" data-field="x_Change" name="x_Change" id="x_Change" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($receipt_header_reverse_add->Change->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_add->Change->EditValue ?>"<?php echo $receipt_header_reverse_add->Change->editAttributes() ?>>
</span>
<?php echo $receipt_header_reverse_add->Change->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_add->ClientMessage->Visible) { // ClientMessage ?>
	<div id="r_ClientMessage" class="form-group row">
		<label id="elh_receipt_header_reverse_ClientMessage" for="x_ClientMessage" class="<?php echo $receipt_header_reverse_add->LeftColumnClass ?>"><?php echo $receipt_header_reverse_add->ClientMessage->caption() ?><?php echo $receipt_header_reverse_add->ClientMessage->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_reverse_add->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_add->ClientMessage->cellAttributes() ?>>
<span id="el_receipt_header_reverse_ClientMessage">
<input type="text" data-table="receipt_header_reverse" data-field="x_ClientMessage" name="x_ClientMessage" id="x_ClientMessage" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipt_header_reverse_add->ClientMessage->getPlaceHolder()) ?>" value="<?php echo $receipt_header_reverse_add->ClientMessage->EditValue ?>"<?php echo $receipt_header_reverse_add->ClientMessage->editAttributes() ?>>
</span>
<?php echo $receipt_header_reverse_add->ClientMessage->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($receipt_header_reverse_add->Reasons->Visible) { // Reasons ?>
	<div id="r_Reasons" class="form-group row">
		<label id="elh_receipt_header_reverse_Reasons" for="x_Reasons" class="<?php echo $receipt_header_reverse_add->LeftColumnClass ?>"><?php echo $receipt_header_reverse_add->Reasons->caption() ?><?php echo $receipt_header_reverse_add->Reasons->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $receipt_header_reverse_add->RightColumnClass ?>"><div <?php echo $receipt_header_reverse_add->Reasons->cellAttributes() ?>>
<span id="el_receipt_header_reverse_Reasons">
<textarea data-table="receipt_header_reverse" data-field="x_Reasons" name="x_Reasons" id="x_Reasons" cols="35" rows="4" placeholder="<?php echo HtmlEncode($receipt_header_reverse_add->Reasons->getPlaceHolder()) ?>"<?php echo $receipt_header_reverse_add->Reasons->editAttributes() ?>><?php echo $receipt_header_reverse_add->Reasons->EditValue ?></textarea>
</span>
<?php echo $receipt_header_reverse_add->Reasons->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$receipt_header_reverse_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $receipt_header_reverse_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $receipt_header_reverse_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$receipt_header_reverse_add->showPageFooter();
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
$receipt_header_reverse_add->terminate();
?>