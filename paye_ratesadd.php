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
$paye_rates_add = new paye_rates_add();

// Run the page
$paye_rates_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$paye_rates_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpaye_ratesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpaye_ratesadd = currentForm = new ew.Form("fpaye_ratesadd", "add");

	// Validate form
	fpaye_ratesadd.validate = function() {
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
			<?php if ($paye_rates_add->band->Required) { ?>
				elm = this.getElements("x" + infix + "_band");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $paye_rates_add->band->caption(), $paye_rates_add->band->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_band");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($paye_rates_add->band->errorMessage()) ?>");
			<?php if ($paye_rates_add->MinimumIncome->Required) { ?>
				elm = this.getElements("x" + infix + "_MinimumIncome");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $paye_rates_add->MinimumIncome->caption(), $paye_rates_add->MinimumIncome->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MinimumIncome");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($paye_rates_add->MinimumIncome->errorMessage()) ?>");
			<?php if ($paye_rates_add->MaximumIncome->Required) { ?>
				elm = this.getElements("x" + infix + "_MaximumIncome");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $paye_rates_add->MaximumIncome->caption(), $paye_rates_add->MaximumIncome->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MaximumIncome");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($paye_rates_add->MaximumIncome->errorMessage()) ?>");
			<?php if ($paye_rates_add->PAYERate->Required) { ?>
				elm = this.getElements("x" + infix + "_PAYERate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $paye_rates_add->PAYERate->caption(), $paye_rates_add->PAYERate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PAYERate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($paye_rates_add->PAYERate->errorMessage()) ?>");

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
	fpaye_ratesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpaye_ratesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpaye_ratesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $paye_rates_add->showPageHeader(); ?>
<?php
$paye_rates_add->showMessage();
?>
<form name="fpaye_ratesadd" id="fpaye_ratesadd" class="<?php echo $paye_rates_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="paye_rates">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$paye_rates_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($paye_rates_add->band->Visible) { // band ?>
	<div id="r_band" class="form-group row">
		<label id="elh_paye_rates_band" for="x_band" class="<?php echo $paye_rates_add->LeftColumnClass ?>"><?php echo $paye_rates_add->band->caption() ?><?php echo $paye_rates_add->band->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $paye_rates_add->RightColumnClass ?>"><div <?php echo $paye_rates_add->band->cellAttributes() ?>>
<span id="el_paye_rates_band">
<input type="text" data-table="paye_rates" data-field="x_band" name="x_band" id="x_band" size="30" placeholder="<?php echo HtmlEncode($paye_rates_add->band->getPlaceHolder()) ?>" value="<?php echo $paye_rates_add->band->EditValue ?>"<?php echo $paye_rates_add->band->editAttributes() ?>>
</span>
<?php echo $paye_rates_add->band->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($paye_rates_add->MinimumIncome->Visible) { // MinimumIncome ?>
	<div id="r_MinimumIncome" class="form-group row">
		<label id="elh_paye_rates_MinimumIncome" for="x_MinimumIncome" class="<?php echo $paye_rates_add->LeftColumnClass ?>"><?php echo $paye_rates_add->MinimumIncome->caption() ?><?php echo $paye_rates_add->MinimumIncome->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $paye_rates_add->RightColumnClass ?>"><div <?php echo $paye_rates_add->MinimumIncome->cellAttributes() ?>>
<span id="el_paye_rates_MinimumIncome">
<input type="text" data-table="paye_rates" data-field="x_MinimumIncome" name="x_MinimumIncome" id="x_MinimumIncome" size="30" placeholder="<?php echo HtmlEncode($paye_rates_add->MinimumIncome->getPlaceHolder()) ?>" value="<?php echo $paye_rates_add->MinimumIncome->EditValue ?>"<?php echo $paye_rates_add->MinimumIncome->editAttributes() ?>>
</span>
<?php echo $paye_rates_add->MinimumIncome->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($paye_rates_add->MaximumIncome->Visible) { // MaximumIncome ?>
	<div id="r_MaximumIncome" class="form-group row">
		<label id="elh_paye_rates_MaximumIncome" for="x_MaximumIncome" class="<?php echo $paye_rates_add->LeftColumnClass ?>"><?php echo $paye_rates_add->MaximumIncome->caption() ?><?php echo $paye_rates_add->MaximumIncome->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $paye_rates_add->RightColumnClass ?>"><div <?php echo $paye_rates_add->MaximumIncome->cellAttributes() ?>>
<span id="el_paye_rates_MaximumIncome">
<input type="text" data-table="paye_rates" data-field="x_MaximumIncome" name="x_MaximumIncome" id="x_MaximumIncome" size="30" placeholder="<?php echo HtmlEncode($paye_rates_add->MaximumIncome->getPlaceHolder()) ?>" value="<?php echo $paye_rates_add->MaximumIncome->EditValue ?>"<?php echo $paye_rates_add->MaximumIncome->editAttributes() ?>>
</span>
<?php echo $paye_rates_add->MaximumIncome->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($paye_rates_add->PAYERate->Visible) { // PAYERate ?>
	<div id="r_PAYERate" class="form-group row">
		<label id="elh_paye_rates_PAYERate" for="x_PAYERate" class="<?php echo $paye_rates_add->LeftColumnClass ?>"><?php echo $paye_rates_add->PAYERate->caption() ?><?php echo $paye_rates_add->PAYERate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $paye_rates_add->RightColumnClass ?>"><div <?php echo $paye_rates_add->PAYERate->cellAttributes() ?>>
<span id="el_paye_rates_PAYERate">
<input type="text" data-table="paye_rates" data-field="x_PAYERate" name="x_PAYERate" id="x_PAYERate" size="30" placeholder="<?php echo HtmlEncode($paye_rates_add->PAYERate->getPlaceHolder()) ?>" value="<?php echo $paye_rates_add->PAYERate->EditValue ?>"<?php echo $paye_rates_add->PAYERate->editAttributes() ?>>
</span>
<?php echo $paye_rates_add->PAYERate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$paye_rates_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $paye_rates_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $paye_rates_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$paye_rates_add->showPageFooter();
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
$paye_rates_add->terminate();
?>