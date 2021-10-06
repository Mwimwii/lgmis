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
$currency_add = new currency_add();

// Run the page
$currency_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$currency_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcurrencyadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcurrencyadd = currentForm = new ew.Form("fcurrencyadd", "add");

	// Validate form
	fcurrencyadd.validate = function() {
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
			<?php if ($currency_add->CurrencyCode->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrencyCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $currency_add->CurrencyCode->caption(), $currency_add->CurrencyCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($currency_add->CurrencyName->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrencyName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $currency_add->CurrencyName->caption(), $currency_add->CurrencyName->RequiredErrorMessage)) ?>");
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
	fcurrencyadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcurrencyadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcurrencyadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $currency_add->showPageHeader(); ?>
<?php
$currency_add->showMessage();
?>
<form name="fcurrencyadd" id="fcurrencyadd" class="<?php echo $currency_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="currency">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$currency_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($currency_add->CurrencyCode->Visible) { // CurrencyCode ?>
	<div id="r_CurrencyCode" class="form-group row">
		<label id="elh_currency_CurrencyCode" for="x_CurrencyCode" class="<?php echo $currency_add->LeftColumnClass ?>"><?php echo $currency_add->CurrencyCode->caption() ?><?php echo $currency_add->CurrencyCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $currency_add->RightColumnClass ?>"><div <?php echo $currency_add->CurrencyCode->cellAttributes() ?>>
<span id="el_currency_CurrencyCode">
<input type="text" data-table="currency" data-field="x_CurrencyCode" name="x_CurrencyCode" id="x_CurrencyCode" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($currency_add->CurrencyCode->getPlaceHolder()) ?>" value="<?php echo $currency_add->CurrencyCode->EditValue ?>"<?php echo $currency_add->CurrencyCode->editAttributes() ?>>
</span>
<?php echo $currency_add->CurrencyCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($currency_add->CurrencyName->Visible) { // CurrencyName ?>
	<div id="r_CurrencyName" class="form-group row">
		<label id="elh_currency_CurrencyName" for="x_CurrencyName" class="<?php echo $currency_add->LeftColumnClass ?>"><?php echo $currency_add->CurrencyName->caption() ?><?php echo $currency_add->CurrencyName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $currency_add->RightColumnClass ?>"><div <?php echo $currency_add->CurrencyName->cellAttributes() ?>>
<span id="el_currency_CurrencyName">
<input type="text" data-table="currency" data-field="x_CurrencyName" name="x_CurrencyName" id="x_CurrencyName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($currency_add->CurrencyName->getPlaceHolder()) ?>" value="<?php echo $currency_add->CurrencyName->EditValue ?>"<?php echo $currency_add->CurrencyName->editAttributes() ?>>
</span>
<?php echo $currency_add->CurrencyName->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$currency_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $currency_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $currency_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$currency_add->showPageFooter();
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
$currency_add->terminate();
?>