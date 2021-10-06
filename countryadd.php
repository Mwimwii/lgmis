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
$country_add = new country_add();

// Run the page
$country_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$country_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcountryadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcountryadd = currentForm = new ew.Form("fcountryadd", "add");

	// Validate form
	fcountryadd.validate = function() {
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
			<?php if ($country_add->CountryName->Required) { ?>
				elm = this.getElements("x" + infix + "_CountryName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $country_add->CountryName->caption(), $country_add->CountryName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($country_add->CurrencyCode->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrencyCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $country_add->CurrencyCode->caption(), $country_add->CurrencyCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($country_add->ExchangeRate->Required) { ?>
				elm = this.getElements("x" + infix + "_ExchangeRate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $country_add->ExchangeRate->caption(), $country_add->ExchangeRate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ExchangeRate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($country_add->ExchangeRate->errorMessage()) ?>");
			<?php if ($country_add->CountryCode->Required) { ?>
				elm = this.getElements("x" + infix + "_CountryCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $country_add->CountryCode->caption(), $country_add->CountryCode->RequiredErrorMessage)) ?>");
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
	fcountryadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcountryadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcountryadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $country_add->showPageHeader(); ?>
<?php
$country_add->showMessage();
?>
<form name="fcountryadd" id="fcountryadd" class="<?php echo $country_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="country">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$country_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($country_add->CountryName->Visible) { // CountryName ?>
	<div id="r_CountryName" class="form-group row">
		<label id="elh_country_CountryName" for="x_CountryName" class="<?php echo $country_add->LeftColumnClass ?>"><?php echo $country_add->CountryName->caption() ?><?php echo $country_add->CountryName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $country_add->RightColumnClass ?>"><div <?php echo $country_add->CountryName->cellAttributes() ?>>
<span id="el_country_CountryName">
<input type="text" data-table="country" data-field="x_CountryName" name="x_CountryName" id="x_CountryName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($country_add->CountryName->getPlaceHolder()) ?>" value="<?php echo $country_add->CountryName->EditValue ?>"<?php echo $country_add->CountryName->editAttributes() ?>>
</span>
<?php echo $country_add->CountryName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($country_add->CurrencyCode->Visible) { // CurrencyCode ?>
	<div id="r_CurrencyCode" class="form-group row">
		<label id="elh_country_CurrencyCode" for="x_CurrencyCode" class="<?php echo $country_add->LeftColumnClass ?>"><?php echo $country_add->CurrencyCode->caption() ?><?php echo $country_add->CurrencyCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $country_add->RightColumnClass ?>"><div <?php echo $country_add->CurrencyCode->cellAttributes() ?>>
<span id="el_country_CurrencyCode">
<input type="text" data-table="country" data-field="x_CurrencyCode" name="x_CurrencyCode" id="x_CurrencyCode" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($country_add->CurrencyCode->getPlaceHolder()) ?>" value="<?php echo $country_add->CurrencyCode->EditValue ?>"<?php echo $country_add->CurrencyCode->editAttributes() ?>>
</span>
<?php echo $country_add->CurrencyCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($country_add->ExchangeRate->Visible) { // ExchangeRate ?>
	<div id="r_ExchangeRate" class="form-group row">
		<label id="elh_country_ExchangeRate" for="x_ExchangeRate" class="<?php echo $country_add->LeftColumnClass ?>"><?php echo $country_add->ExchangeRate->caption() ?><?php echo $country_add->ExchangeRate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $country_add->RightColumnClass ?>"><div <?php echo $country_add->ExchangeRate->cellAttributes() ?>>
<span id="el_country_ExchangeRate">
<input type="text" data-table="country" data-field="x_ExchangeRate" name="x_ExchangeRate" id="x_ExchangeRate" size="30" placeholder="<?php echo HtmlEncode($country_add->ExchangeRate->getPlaceHolder()) ?>" value="<?php echo $country_add->ExchangeRate->EditValue ?>"<?php echo $country_add->ExchangeRate->editAttributes() ?>>
</span>
<?php echo $country_add->ExchangeRate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($country_add->CountryCode->Visible) { // CountryCode ?>
	<div id="r_CountryCode" class="form-group row">
		<label id="elh_country_CountryCode" for="x_CountryCode" class="<?php echo $country_add->LeftColumnClass ?>"><?php echo $country_add->CountryCode->caption() ?><?php echo $country_add->CountryCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $country_add->RightColumnClass ?>"><div <?php echo $country_add->CountryCode->cellAttributes() ?>>
<span id="el_country_CountryCode">
<input type="text" data-table="country" data-field="x_CountryCode" name="x_CountryCode" id="x_CountryCode" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($country_add->CountryCode->getPlaceHolder()) ?>" value="<?php echo $country_add->CountryCode->EditValue ?>"<?php echo $country_add->CountryCode->editAttributes() ?>>
</span>
<?php echo $country_add->CountryCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$country_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $country_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $country_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$country_add->showPageFooter();
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
$country_add->terminate();
?>