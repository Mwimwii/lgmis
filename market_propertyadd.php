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
$market_property_add = new market_property_add();

// Run the page
$market_property_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$market_property_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmarket_propertyadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fmarket_propertyadd = currentForm = new ew.Form("fmarket_propertyadd", "add");

	// Validate form
	fmarket_propertyadd.validate = function() {
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
			<?php if ($market_property_add->MarketNo->Required) { ?>
				elm = this.getElements("x" + infix + "_MarketNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_property_add->MarketNo->caption(), $market_property_add->MarketNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($market_property_add->ItemName->Required) { ?>
				elm = this.getElements("x" + infix + "_ItemName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_property_add->ItemName->caption(), $market_property_add->ItemName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($market_property_add->ItemRef->Required) { ?>
				elm = this.getElements("x" + infix + "_ItemRef");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_property_add->ItemRef->caption(), $market_property_add->ItemRef->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($market_property_add->ItemLength->Required) { ?>
				elm = this.getElements("x" + infix + "_ItemLength");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_property_add->ItemLength->caption(), $market_property_add->ItemLength->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ItemLength");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($market_property_add->ItemLength->errorMessage()) ?>");
			<?php if ($market_property_add->ItemWidth->Required) { ?>
				elm = this.getElements("x" + infix + "_ItemWidth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_property_add->ItemWidth->caption(), $market_property_add->ItemWidth->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ItemWidth");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($market_property_add->ItemWidth->errorMessage()) ?>");
			<?php if ($market_property_add->DefaultFees->Required) { ?>
				elm = this.getElements("x" + infix + "_DefaultFees");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_property_add->DefaultFees->caption(), $market_property_add->DefaultFees->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DefaultFees");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($market_property_add->DefaultFees->errorMessage()) ?>");
			<?php if ($market_property_add->LastUpdatedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdatedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_property_add->LastUpdatedBy->caption(), $market_property_add->LastUpdatedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($market_property_add->LastUpdateDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_property_add->LastUpdateDate->caption(), $market_property_add->LastUpdateDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($market_property_add->LastUpdateDate->errorMessage()) ?>");

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
	fmarket_propertyadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmarket_propertyadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmarket_propertyadd.lists["x_MarketNo"] = <?php echo $market_property_add->MarketNo->Lookup->toClientList($market_property_add) ?>;
	fmarket_propertyadd.lists["x_MarketNo"].options = <?php echo JsonEncode($market_property_add->MarketNo->lookupOptions()) ?>;
	loadjs.done("fmarket_propertyadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $market_property_add->showPageHeader(); ?>
<?php
$market_property_add->showMessage();
?>
<form name="fmarket_propertyadd" id="fmarket_propertyadd" class="<?php echo $market_property_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="market_property">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$market_property_add->IsModal ?>">
<?php if ($market_property->getCurrentMasterTable() == "market") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="market">
<input type="hidden" name="fk_MarketNo" value="<?php echo HtmlEncode($market_property_add->MarketNo->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($market_property_add->MarketNo->Visible) { // MarketNo ?>
	<div id="r_MarketNo" class="form-group row">
		<label id="elh_market_property_MarketNo" for="x_MarketNo" class="<?php echo $market_property_add->LeftColumnClass ?>"><?php echo $market_property_add->MarketNo->caption() ?><?php echo $market_property_add->MarketNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $market_property_add->RightColumnClass ?>"><div <?php echo $market_property_add->MarketNo->cellAttributes() ?>>
<?php if ($market_property_add->MarketNo->getSessionValue() != "") { ?>
<span id="el_market_property_MarketNo">
<span<?php echo $market_property_add->MarketNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_property_add->MarketNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_MarketNo" name="x_MarketNo" value="<?php echo HtmlEncode($market_property_add->MarketNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_market_property_MarketNo">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="market_property" data-field="x_MarketNo" data-value-separator="<?php echo $market_property_add->MarketNo->displayValueSeparatorAttribute() ?>" id="x_MarketNo" name="x_MarketNo"<?php echo $market_property_add->MarketNo->editAttributes() ?>>
			<?php echo $market_property_add->MarketNo->selectOptionListHtml("x_MarketNo") ?>
		</select>
</div>
<?php echo $market_property_add->MarketNo->Lookup->getParamTag($market_property_add, "p_x_MarketNo") ?>
</span>
<?php } ?>
<?php echo $market_property_add->MarketNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($market_property_add->ItemName->Visible) { // ItemName ?>
	<div id="r_ItemName" class="form-group row">
		<label id="elh_market_property_ItemName" for="x_ItemName" class="<?php echo $market_property_add->LeftColumnClass ?>"><?php echo $market_property_add->ItemName->caption() ?><?php echo $market_property_add->ItemName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $market_property_add->RightColumnClass ?>"><div <?php echo $market_property_add->ItemName->cellAttributes() ?>>
<span id="el_market_property_ItemName">
<input type="text" data-table="market_property" data-field="x_ItemName" name="x_ItemName" id="x_ItemName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($market_property_add->ItemName->getPlaceHolder()) ?>" value="<?php echo $market_property_add->ItemName->EditValue ?>"<?php echo $market_property_add->ItemName->editAttributes() ?>>
</span>
<?php echo $market_property_add->ItemName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($market_property_add->ItemRef->Visible) { // ItemRef ?>
	<div id="r_ItemRef" class="form-group row">
		<label id="elh_market_property_ItemRef" for="x_ItemRef" class="<?php echo $market_property_add->LeftColumnClass ?>"><?php echo $market_property_add->ItemRef->caption() ?><?php echo $market_property_add->ItemRef->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $market_property_add->RightColumnClass ?>"><div <?php echo $market_property_add->ItemRef->cellAttributes() ?>>
<span id="el_market_property_ItemRef">
<input type="text" data-table="market_property" data-field="x_ItemRef" name="x_ItemRef" id="x_ItemRef" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($market_property_add->ItemRef->getPlaceHolder()) ?>" value="<?php echo $market_property_add->ItemRef->EditValue ?>"<?php echo $market_property_add->ItemRef->editAttributes() ?>>
</span>
<?php echo $market_property_add->ItemRef->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($market_property_add->ItemLength->Visible) { // ItemLength ?>
	<div id="r_ItemLength" class="form-group row">
		<label id="elh_market_property_ItemLength" for="x_ItemLength" class="<?php echo $market_property_add->LeftColumnClass ?>"><?php echo $market_property_add->ItemLength->caption() ?><?php echo $market_property_add->ItemLength->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $market_property_add->RightColumnClass ?>"><div <?php echo $market_property_add->ItemLength->cellAttributes() ?>>
<span id="el_market_property_ItemLength">
<input type="text" data-table="market_property" data-field="x_ItemLength" name="x_ItemLength" id="x_ItemLength" size="30" placeholder="<?php echo HtmlEncode($market_property_add->ItemLength->getPlaceHolder()) ?>" value="<?php echo $market_property_add->ItemLength->EditValue ?>"<?php echo $market_property_add->ItemLength->editAttributes() ?>>
</span>
<?php echo $market_property_add->ItemLength->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($market_property_add->ItemWidth->Visible) { // ItemWidth ?>
	<div id="r_ItemWidth" class="form-group row">
		<label id="elh_market_property_ItemWidth" for="x_ItemWidth" class="<?php echo $market_property_add->LeftColumnClass ?>"><?php echo $market_property_add->ItemWidth->caption() ?><?php echo $market_property_add->ItemWidth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $market_property_add->RightColumnClass ?>"><div <?php echo $market_property_add->ItemWidth->cellAttributes() ?>>
<span id="el_market_property_ItemWidth">
<input type="text" data-table="market_property" data-field="x_ItemWidth" name="x_ItemWidth" id="x_ItemWidth" size="30" placeholder="<?php echo HtmlEncode($market_property_add->ItemWidth->getPlaceHolder()) ?>" value="<?php echo $market_property_add->ItemWidth->EditValue ?>"<?php echo $market_property_add->ItemWidth->editAttributes() ?>>
</span>
<?php echo $market_property_add->ItemWidth->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($market_property_add->DefaultFees->Visible) { // DefaultFees ?>
	<div id="r_DefaultFees" class="form-group row">
		<label id="elh_market_property_DefaultFees" for="x_DefaultFees" class="<?php echo $market_property_add->LeftColumnClass ?>"><?php echo $market_property_add->DefaultFees->caption() ?><?php echo $market_property_add->DefaultFees->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $market_property_add->RightColumnClass ?>"><div <?php echo $market_property_add->DefaultFees->cellAttributes() ?>>
<span id="el_market_property_DefaultFees">
<input type="text" data-table="market_property" data-field="x_DefaultFees" name="x_DefaultFees" id="x_DefaultFees" size="30" placeholder="<?php echo HtmlEncode($market_property_add->DefaultFees->getPlaceHolder()) ?>" value="<?php echo $market_property_add->DefaultFees->EditValue ?>"<?php echo $market_property_add->DefaultFees->editAttributes() ?>>
</span>
<?php echo $market_property_add->DefaultFees->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($market_property_add->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<div id="r_LastUpdatedBy" class="form-group row">
		<label id="elh_market_property_LastUpdatedBy" for="x_LastUpdatedBy" class="<?php echo $market_property_add->LeftColumnClass ?>"><?php echo $market_property_add->LastUpdatedBy->caption() ?><?php echo $market_property_add->LastUpdatedBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $market_property_add->RightColumnClass ?>"><div <?php echo $market_property_add->LastUpdatedBy->cellAttributes() ?>>
<span id="el_market_property_LastUpdatedBy">
<input type="text" data-table="market_property" data-field="x_LastUpdatedBy" name="x_LastUpdatedBy" id="x_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($market_property_add->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $market_property_add->LastUpdatedBy->EditValue ?>"<?php echo $market_property_add->LastUpdatedBy->editAttributes() ?>>
</span>
<?php echo $market_property_add->LastUpdatedBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($market_property_add->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<div id="r_LastUpdateDate" class="form-group row">
		<label id="elh_market_property_LastUpdateDate" for="x_LastUpdateDate" class="<?php echo $market_property_add->LeftColumnClass ?>"><?php echo $market_property_add->LastUpdateDate->caption() ?><?php echo $market_property_add->LastUpdateDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $market_property_add->RightColumnClass ?>"><div <?php echo $market_property_add->LastUpdateDate->cellAttributes() ?>>
<span id="el_market_property_LastUpdateDate">
<input type="text" data-table="market_property" data-field="x_LastUpdateDate" name="x_LastUpdateDate" id="x_LastUpdateDate" placeholder="<?php echo HtmlEncode($market_property_add->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $market_property_add->LastUpdateDate->EditValue ?>"<?php echo $market_property_add->LastUpdateDate->editAttributes() ?>>
</span>
<?php echo $market_property_add->LastUpdateDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("market_trans", explode(",", $market_property->getCurrentDetailTable())) && $market_trans->DetailAdd) {
?>
<?php if ($market_property->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("market_trans", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "market_transgrid.php" ?>
<?php } ?>
<?php if (!$market_property_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $market_property_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $market_property_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$market_property_add->showPageFooter();
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
$market_property_add->terminate();
?>