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
$market_trans_add = new market_trans_add();

// Run the page
$market_trans_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$market_trans_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmarket_transadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fmarket_transadd = currentForm = new ew.Form("fmarket_transadd", "add");

	// Validate form
	fmarket_transadd.validate = function() {
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
			<?php if ($market_trans_add->MarketItemNo->Required) { ?>
				elm = this.getElements("x" + infix + "_MarketItemNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_trans_add->MarketItemNo->caption(), $market_trans_add->MarketItemNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MarketItemNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($market_trans_add->MarketItemNo->errorMessage()) ?>");
			<?php if ($market_trans_add->DateHired->Required) { ?>
				elm = this.getElements("x" + infix + "_DateHired");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_trans_add->DateHired->caption(), $market_trans_add->DateHired->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateHired");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($market_trans_add->DateHired->errorMessage()) ?>");
			<?php if ($market_trans_add->MartketeerName->Required) { ?>
				elm = this.getElements("x" + infix + "_MartketeerName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_trans_add->MartketeerName->caption(), $market_trans_add->MartketeerName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($market_trans_add->MartketeerID->Required) { ?>
				elm = this.getElements("x" + infix + "_MartketeerID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_trans_add->MartketeerID->caption(), $market_trans_add->MartketeerID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($market_trans_add->AmountDue->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountDue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_trans_add->AmountDue->caption(), $market_trans_add->AmountDue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountDue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($market_trans_add->AmountDue->errorMessage()) ?>");
			<?php if ($market_trans_add->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_trans_add->AmountPaid->caption(), $market_trans_add->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($market_trans_add->AmountPaid->errorMessage()) ?>");
			<?php if ($market_trans_add->ReceiptNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ReceiptNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_trans_add->ReceiptNo->caption(), $market_trans_add->ReceiptNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($market_trans_add->LastUpdatedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdatedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_trans_add->LastUpdatedBy->caption(), $market_trans_add->LastUpdatedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($market_trans_add->LastUpdateDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_trans_add->LastUpdateDate->caption(), $market_trans_add->LastUpdateDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($market_trans_add->LastUpdateDate->errorMessage()) ?>");

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
	fmarket_transadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmarket_transadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fmarket_transadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $market_trans_add->showPageHeader(); ?>
<?php
$market_trans_add->showMessage();
?>
<form name="fmarket_transadd" id="fmarket_transadd" class="<?php echo $market_trans_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="market_trans">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$market_trans_add->IsModal ?>">
<?php if ($market_trans->getCurrentMasterTable() == "market_property") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="market_property">
<input type="hidden" name="fk_MarketItemNo" value="<?php echo HtmlEncode($market_trans_add->MarketItemNo->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($market_trans_add->MarketItemNo->Visible) { // MarketItemNo ?>
	<div id="r_MarketItemNo" class="form-group row">
		<label id="elh_market_trans_MarketItemNo" for="x_MarketItemNo" class="<?php echo $market_trans_add->LeftColumnClass ?>"><?php echo $market_trans_add->MarketItemNo->caption() ?><?php echo $market_trans_add->MarketItemNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $market_trans_add->RightColumnClass ?>"><div <?php echo $market_trans_add->MarketItemNo->cellAttributes() ?>>
<?php if ($market_trans_add->MarketItemNo->getSessionValue() != "") { ?>
<span id="el_market_trans_MarketItemNo">
<span<?php echo $market_trans_add->MarketItemNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_trans_add->MarketItemNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_MarketItemNo" name="x_MarketItemNo" value="<?php echo HtmlEncode($market_trans_add->MarketItemNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_market_trans_MarketItemNo">
<input type="text" data-table="market_trans" data-field="x_MarketItemNo" name="x_MarketItemNo" id="x_MarketItemNo" size="30" placeholder="<?php echo HtmlEncode($market_trans_add->MarketItemNo->getPlaceHolder()) ?>" value="<?php echo $market_trans_add->MarketItemNo->EditValue ?>"<?php echo $market_trans_add->MarketItemNo->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $market_trans_add->MarketItemNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($market_trans_add->DateHired->Visible) { // DateHired ?>
	<div id="r_DateHired" class="form-group row">
		<label id="elh_market_trans_DateHired" for="x_DateHired" class="<?php echo $market_trans_add->LeftColumnClass ?>"><?php echo $market_trans_add->DateHired->caption() ?><?php echo $market_trans_add->DateHired->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $market_trans_add->RightColumnClass ?>"><div <?php echo $market_trans_add->DateHired->cellAttributes() ?>>
<span id="el_market_trans_DateHired">
<input type="text" data-table="market_trans" data-field="x_DateHired" name="x_DateHired" id="x_DateHired" placeholder="<?php echo HtmlEncode($market_trans_add->DateHired->getPlaceHolder()) ?>" value="<?php echo $market_trans_add->DateHired->EditValue ?>"<?php echo $market_trans_add->DateHired->editAttributes() ?>>
</span>
<?php echo $market_trans_add->DateHired->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($market_trans_add->MartketeerName->Visible) { // MartketeerName ?>
	<div id="r_MartketeerName" class="form-group row">
		<label id="elh_market_trans_MartketeerName" for="x_MartketeerName" class="<?php echo $market_trans_add->LeftColumnClass ?>"><?php echo $market_trans_add->MartketeerName->caption() ?><?php echo $market_trans_add->MartketeerName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $market_trans_add->RightColumnClass ?>"><div <?php echo $market_trans_add->MartketeerName->cellAttributes() ?>>
<span id="el_market_trans_MartketeerName">
<input type="text" data-table="market_trans" data-field="x_MartketeerName" name="x_MartketeerName" id="x_MartketeerName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($market_trans_add->MartketeerName->getPlaceHolder()) ?>" value="<?php echo $market_trans_add->MartketeerName->EditValue ?>"<?php echo $market_trans_add->MartketeerName->editAttributes() ?>>
</span>
<?php echo $market_trans_add->MartketeerName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($market_trans_add->MartketeerID->Visible) { // MartketeerID ?>
	<div id="r_MartketeerID" class="form-group row">
		<label id="elh_market_trans_MartketeerID" for="x_MartketeerID" class="<?php echo $market_trans_add->LeftColumnClass ?>"><?php echo $market_trans_add->MartketeerID->caption() ?><?php echo $market_trans_add->MartketeerID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $market_trans_add->RightColumnClass ?>"><div <?php echo $market_trans_add->MartketeerID->cellAttributes() ?>>
<span id="el_market_trans_MartketeerID">
<input type="text" data-table="market_trans" data-field="x_MartketeerID" name="x_MartketeerID" id="x_MartketeerID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($market_trans_add->MartketeerID->getPlaceHolder()) ?>" value="<?php echo $market_trans_add->MartketeerID->EditValue ?>"<?php echo $market_trans_add->MartketeerID->editAttributes() ?>>
</span>
<?php echo $market_trans_add->MartketeerID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($market_trans_add->AmountDue->Visible) { // AmountDue ?>
	<div id="r_AmountDue" class="form-group row">
		<label id="elh_market_trans_AmountDue" for="x_AmountDue" class="<?php echo $market_trans_add->LeftColumnClass ?>"><?php echo $market_trans_add->AmountDue->caption() ?><?php echo $market_trans_add->AmountDue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $market_trans_add->RightColumnClass ?>"><div <?php echo $market_trans_add->AmountDue->cellAttributes() ?>>
<span id="el_market_trans_AmountDue">
<input type="text" data-table="market_trans" data-field="x_AmountDue" name="x_AmountDue" id="x_AmountDue" size="30" placeholder="<?php echo HtmlEncode($market_trans_add->AmountDue->getPlaceHolder()) ?>" value="<?php echo $market_trans_add->AmountDue->EditValue ?>"<?php echo $market_trans_add->AmountDue->editAttributes() ?>>
</span>
<?php echo $market_trans_add->AmountDue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($market_trans_add->AmountPaid->Visible) { // AmountPaid ?>
	<div id="r_AmountPaid" class="form-group row">
		<label id="elh_market_trans_AmountPaid" for="x_AmountPaid" class="<?php echo $market_trans_add->LeftColumnClass ?>"><?php echo $market_trans_add->AmountPaid->caption() ?><?php echo $market_trans_add->AmountPaid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $market_trans_add->RightColumnClass ?>"><div <?php echo $market_trans_add->AmountPaid->cellAttributes() ?>>
<span id="el_market_trans_AmountPaid">
<input type="text" data-table="market_trans" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($market_trans_add->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $market_trans_add->AmountPaid->EditValue ?>"<?php echo $market_trans_add->AmountPaid->editAttributes() ?>>
</span>
<?php echo $market_trans_add->AmountPaid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($market_trans_add->ReceiptNo->Visible) { // ReceiptNo ?>
	<div id="r_ReceiptNo" class="form-group row">
		<label id="elh_market_trans_ReceiptNo" for="x_ReceiptNo" class="<?php echo $market_trans_add->LeftColumnClass ?>"><?php echo $market_trans_add->ReceiptNo->caption() ?><?php echo $market_trans_add->ReceiptNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $market_trans_add->RightColumnClass ?>"><div <?php echo $market_trans_add->ReceiptNo->cellAttributes() ?>>
<span id="el_market_trans_ReceiptNo">
<input type="text" data-table="market_trans" data-field="x_ReceiptNo" name="x_ReceiptNo" id="x_ReceiptNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($market_trans_add->ReceiptNo->getPlaceHolder()) ?>" value="<?php echo $market_trans_add->ReceiptNo->EditValue ?>"<?php echo $market_trans_add->ReceiptNo->editAttributes() ?>>
</span>
<?php echo $market_trans_add->ReceiptNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($market_trans_add->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<div id="r_LastUpdatedBy" class="form-group row">
		<label id="elh_market_trans_LastUpdatedBy" for="x_LastUpdatedBy" class="<?php echo $market_trans_add->LeftColumnClass ?>"><?php echo $market_trans_add->LastUpdatedBy->caption() ?><?php echo $market_trans_add->LastUpdatedBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $market_trans_add->RightColumnClass ?>"><div <?php echo $market_trans_add->LastUpdatedBy->cellAttributes() ?>>
<span id="el_market_trans_LastUpdatedBy">
<input type="text" data-table="market_trans" data-field="x_LastUpdatedBy" name="x_LastUpdatedBy" id="x_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($market_trans_add->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $market_trans_add->LastUpdatedBy->EditValue ?>"<?php echo $market_trans_add->LastUpdatedBy->editAttributes() ?>>
</span>
<?php echo $market_trans_add->LastUpdatedBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($market_trans_add->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<div id="r_LastUpdateDate" class="form-group row">
		<label id="elh_market_trans_LastUpdateDate" for="x_LastUpdateDate" class="<?php echo $market_trans_add->LeftColumnClass ?>"><?php echo $market_trans_add->LastUpdateDate->caption() ?><?php echo $market_trans_add->LastUpdateDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $market_trans_add->RightColumnClass ?>"><div <?php echo $market_trans_add->LastUpdateDate->cellAttributes() ?>>
<span id="el_market_trans_LastUpdateDate">
<input type="text" data-table="market_trans" data-field="x_LastUpdateDate" name="x_LastUpdateDate" id="x_LastUpdateDate" placeholder="<?php echo HtmlEncode($market_trans_add->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $market_trans_add->LastUpdateDate->EditValue ?>"<?php echo $market_trans_add->LastUpdateDate->editAttributes() ?>>
</span>
<?php echo $market_trans_add->LastUpdateDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$market_trans_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $market_trans_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $market_trans_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$market_trans_add->showPageFooter();
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
$market_trans_add->terminate();
?>