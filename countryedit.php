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
$country_edit = new country_edit();

// Run the page
$country_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$country_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcountryedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcountryedit = currentForm = new ew.Form("fcountryedit", "edit");

	// Validate form
	fcountryedit.validate = function() {
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
			<?php if ($country_edit->CountryName->Required) { ?>
				elm = this.getElements("x" + infix + "_CountryName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $country_edit->CountryName->caption(), $country_edit->CountryName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($country_edit->CurrencyCode->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrencyCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $country_edit->CurrencyCode->caption(), $country_edit->CurrencyCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($country_edit->ExchangeRate->Required) { ?>
				elm = this.getElements("x" + infix + "_ExchangeRate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $country_edit->ExchangeRate->caption(), $country_edit->ExchangeRate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ExchangeRate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($country_edit->ExchangeRate->errorMessage()) ?>");
			<?php if ($country_edit->CountryCode->Required) { ?>
				elm = this.getElements("x" + infix + "_CountryCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $country_edit->CountryCode->caption(), $country_edit->CountryCode->RequiredErrorMessage)) ?>");
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
	fcountryedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcountryedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcountryedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $country_edit->showPageHeader(); ?>
<?php
$country_edit->showMessage();
?>
<?php if (!$country_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $country_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcountryedit" id="fcountryedit" class="<?php echo $country_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="country">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$country_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($country_edit->CountryName->Visible) { // CountryName ?>
	<div id="r_CountryName" class="form-group row">
		<label id="elh_country_CountryName" for="x_CountryName" class="<?php echo $country_edit->LeftColumnClass ?>"><?php echo $country_edit->CountryName->caption() ?><?php echo $country_edit->CountryName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $country_edit->RightColumnClass ?>"><div <?php echo $country_edit->CountryName->cellAttributes() ?>>
<input type="text" data-table="country" data-field="x_CountryName" name="x_CountryName" id="x_CountryName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($country_edit->CountryName->getPlaceHolder()) ?>" value="<?php echo $country_edit->CountryName->EditValue ?>"<?php echo $country_edit->CountryName->editAttributes() ?>>
<input type="hidden" data-table="country" data-field="x_CountryName" name="o_CountryName" id="o_CountryName" value="<?php echo HtmlEncode($country_edit->CountryName->OldValue != null ? $country_edit->CountryName->OldValue : $country_edit->CountryName->CurrentValue) ?>">
<?php echo $country_edit->CountryName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($country_edit->CurrencyCode->Visible) { // CurrencyCode ?>
	<div id="r_CurrencyCode" class="form-group row">
		<label id="elh_country_CurrencyCode" for="x_CurrencyCode" class="<?php echo $country_edit->LeftColumnClass ?>"><?php echo $country_edit->CurrencyCode->caption() ?><?php echo $country_edit->CurrencyCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $country_edit->RightColumnClass ?>"><div <?php echo $country_edit->CurrencyCode->cellAttributes() ?>>
<span id="el_country_CurrencyCode">
<input type="text" data-table="country" data-field="x_CurrencyCode" name="x_CurrencyCode" id="x_CurrencyCode" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($country_edit->CurrencyCode->getPlaceHolder()) ?>" value="<?php echo $country_edit->CurrencyCode->EditValue ?>"<?php echo $country_edit->CurrencyCode->editAttributes() ?>>
</span>
<?php echo $country_edit->CurrencyCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($country_edit->ExchangeRate->Visible) { // ExchangeRate ?>
	<div id="r_ExchangeRate" class="form-group row">
		<label id="elh_country_ExchangeRate" for="x_ExchangeRate" class="<?php echo $country_edit->LeftColumnClass ?>"><?php echo $country_edit->ExchangeRate->caption() ?><?php echo $country_edit->ExchangeRate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $country_edit->RightColumnClass ?>"><div <?php echo $country_edit->ExchangeRate->cellAttributes() ?>>
<span id="el_country_ExchangeRate">
<input type="text" data-table="country" data-field="x_ExchangeRate" name="x_ExchangeRate" id="x_ExchangeRate" size="30" placeholder="<?php echo HtmlEncode($country_edit->ExchangeRate->getPlaceHolder()) ?>" value="<?php echo $country_edit->ExchangeRate->EditValue ?>"<?php echo $country_edit->ExchangeRate->editAttributes() ?>>
</span>
<?php echo $country_edit->ExchangeRate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($country_edit->CountryCode->Visible) { // CountryCode ?>
	<div id="r_CountryCode" class="form-group row">
		<label id="elh_country_CountryCode" for="x_CountryCode" class="<?php echo $country_edit->LeftColumnClass ?>"><?php echo $country_edit->CountryCode->caption() ?><?php echo $country_edit->CountryCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $country_edit->RightColumnClass ?>"><div <?php echo $country_edit->CountryCode->cellAttributes() ?>>
<span id="el_country_CountryCode">
<input type="text" data-table="country" data-field="x_CountryCode" name="x_CountryCode" id="x_CountryCode" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($country_edit->CountryCode->getPlaceHolder()) ?>" value="<?php echo $country_edit->CountryCode->EditValue ?>"<?php echo $country_edit->CountryCode->editAttributes() ?>>
</span>
<?php echo $country_edit->CountryCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$country_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $country_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $country_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$country_edit->IsModal) { ?>
<?php echo $country_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$country_edit->showPageFooter();
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
$country_edit->terminate();
?>