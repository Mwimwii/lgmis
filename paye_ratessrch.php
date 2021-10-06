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
$paye_rates_search = new paye_rates_search();

// Run the page
$paye_rates_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$paye_rates_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpaye_ratessearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($paye_rates_search->IsModal) { ?>
	fpaye_ratessearch = currentAdvancedSearchForm = new ew.Form("fpaye_ratessearch", "search");
	<?php } else { ?>
	fpaye_ratessearch = currentForm = new ew.Form("fpaye_ratessearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fpaye_ratessearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_band");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($paye_rates_search->band->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_MinimumIncome");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($paye_rates_search->MinimumIncome->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_MaximumIncome");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($paye_rates_search->MaximumIncome->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PAYERate");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($paye_rates_search->PAYERate->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fpaye_ratessearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpaye_ratessearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpaye_ratessearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $paye_rates_search->showPageHeader(); ?>
<?php
$paye_rates_search->showMessage();
?>
<form name="fpaye_ratessearch" id="fpaye_ratessearch" class="<?php echo $paye_rates_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="paye_rates">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$paye_rates_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($paye_rates_search->band->Visible) { // band ?>
	<div id="r_band" class="form-group row">
		<label for="x_band" class="<?php echo $paye_rates_search->LeftColumnClass ?>"><span id="elh_paye_rates_band"><?php echo $paye_rates_search->band->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_band" id="z_band" value="=">
</span>
		</label>
		<div class="<?php echo $paye_rates_search->RightColumnClass ?>"><div <?php echo $paye_rates_search->band->cellAttributes() ?>>
			<span id="el_paye_rates_band" class="ew-search-field">
<input type="text" data-table="paye_rates" data-field="x_band" name="x_band" id="x_band" size="30" placeholder="<?php echo HtmlEncode($paye_rates_search->band->getPlaceHolder()) ?>" value="<?php echo $paye_rates_search->band->EditValue ?>"<?php echo $paye_rates_search->band->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($paye_rates_search->MinimumIncome->Visible) { // MinimumIncome ?>
	<div id="r_MinimumIncome" class="form-group row">
		<label for="x_MinimumIncome" class="<?php echo $paye_rates_search->LeftColumnClass ?>"><span id="elh_paye_rates_MinimumIncome"><?php echo $paye_rates_search->MinimumIncome->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_MinimumIncome" id="z_MinimumIncome" value="=">
</span>
		</label>
		<div class="<?php echo $paye_rates_search->RightColumnClass ?>"><div <?php echo $paye_rates_search->MinimumIncome->cellAttributes() ?>>
			<span id="el_paye_rates_MinimumIncome" class="ew-search-field">
<input type="text" data-table="paye_rates" data-field="x_MinimumIncome" name="x_MinimumIncome" id="x_MinimumIncome" size="30" placeholder="<?php echo HtmlEncode($paye_rates_search->MinimumIncome->getPlaceHolder()) ?>" value="<?php echo $paye_rates_search->MinimumIncome->EditValue ?>"<?php echo $paye_rates_search->MinimumIncome->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($paye_rates_search->MaximumIncome->Visible) { // MaximumIncome ?>
	<div id="r_MaximumIncome" class="form-group row">
		<label for="x_MaximumIncome" class="<?php echo $paye_rates_search->LeftColumnClass ?>"><span id="elh_paye_rates_MaximumIncome"><?php echo $paye_rates_search->MaximumIncome->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_MaximumIncome" id="z_MaximumIncome" value="=">
</span>
		</label>
		<div class="<?php echo $paye_rates_search->RightColumnClass ?>"><div <?php echo $paye_rates_search->MaximumIncome->cellAttributes() ?>>
			<span id="el_paye_rates_MaximumIncome" class="ew-search-field">
<input type="text" data-table="paye_rates" data-field="x_MaximumIncome" name="x_MaximumIncome" id="x_MaximumIncome" size="30" placeholder="<?php echo HtmlEncode($paye_rates_search->MaximumIncome->getPlaceHolder()) ?>" value="<?php echo $paye_rates_search->MaximumIncome->EditValue ?>"<?php echo $paye_rates_search->MaximumIncome->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($paye_rates_search->PAYERate->Visible) { // PAYERate ?>
	<div id="r_PAYERate" class="form-group row">
		<label for="x_PAYERate" class="<?php echo $paye_rates_search->LeftColumnClass ?>"><span id="elh_paye_rates_PAYERate"><?php echo $paye_rates_search->PAYERate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PAYERate" id="z_PAYERate" value="=">
</span>
		</label>
		<div class="<?php echo $paye_rates_search->RightColumnClass ?>"><div <?php echo $paye_rates_search->PAYERate->cellAttributes() ?>>
			<span id="el_paye_rates_PAYERate" class="ew-search-field">
<input type="text" data-table="paye_rates" data-field="x_PAYERate" name="x_PAYERate" id="x_PAYERate" size="30" placeholder="<?php echo HtmlEncode($paye_rates_search->PAYERate->getPlaceHolder()) ?>" value="<?php echo $paye_rates_search->PAYERate->EditValue ?>"<?php echo $paye_rates_search->PAYERate->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$paye_rates_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $paye_rates_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$paye_rates_search->showPageFooter();
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
$paye_rates_search->terminate();
?>