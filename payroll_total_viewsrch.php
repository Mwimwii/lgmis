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
$payroll_total_view_search = new payroll_total_view_search();

// Run the page
$payroll_total_view_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payroll_total_view_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpayroll_total_viewsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($payroll_total_view_search->IsModal) { ?>
	fpayroll_total_viewsearch = currentAdvancedSearchForm = new ew.Form("fpayroll_total_viewsearch", "search");
	<?php } else { ?>
	fpayroll_total_viewsearch = currentForm = new ew.Form("fpayroll_total_viewsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fpayroll_total_viewsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_PayrollPeriod");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payroll_total_view_search->PayrollPeriod->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Income");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payroll_total_view_search->Income->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fpayroll_total_viewsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpayroll_total_viewsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpayroll_total_viewsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $payroll_total_view_search->showPageHeader(); ?>
<?php
$payroll_total_view_search->showMessage();
?>
<form name="fpayroll_total_viewsearch" id="fpayroll_total_viewsearch" class="<?php echo $payroll_total_view_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payroll_total_view">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$payroll_total_view_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($payroll_total_view_search->LocalAuthority->Visible) { // LocalAuthority ?>
	<div id="r_LocalAuthority" class="form-group row">
		<label for="x_LocalAuthority" class="<?php echo $payroll_total_view_search->LeftColumnClass ?>"><span id="elh_payroll_total_view_LocalAuthority"><?php echo $payroll_total_view_search->LocalAuthority->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LocalAuthority" id="z_LocalAuthority" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payroll_total_view_search->RightColumnClass ?>"><div <?php echo $payroll_total_view_search->LocalAuthority->cellAttributes() ?>>
			<span id="el_payroll_total_view_LocalAuthority" class="ew-search-field">
<input type="text" data-table="payroll_total_view" data-field="x_LocalAuthority" name="x_LocalAuthority" id="x_LocalAuthority" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($payroll_total_view_search->LocalAuthority->getPlaceHolder()) ?>" value="<?php echo $payroll_total_view_search->LocalAuthority->EditValue ?>"<?php echo $payroll_total_view_search->LocalAuthority->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_total_view_search->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<div id="r_PayrollPeriod" class="form-group row">
		<label for="x_PayrollPeriod" class="<?php echo $payroll_total_view_search->LeftColumnClass ?>"><span id="elh_payroll_total_view_PayrollPeriod"><?php echo $payroll_total_view_search->PayrollPeriod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PayrollPeriod" id="z_PayrollPeriod" value="=">
</span>
		</label>
		<div class="<?php echo $payroll_total_view_search->RightColumnClass ?>"><div <?php echo $payroll_total_view_search->PayrollPeriod->cellAttributes() ?>>
			<span id="el_payroll_total_view_PayrollPeriod" class="ew-search-field">
<input type="text" data-table="payroll_total_view" data-field="x_PayrollPeriod" name="x_PayrollPeriod" id="x_PayrollPeriod" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($payroll_total_view_search->PayrollPeriod->getPlaceHolder()) ?>" value="<?php echo $payroll_total_view_search->PayrollPeriod->EditValue ?>"<?php echo $payroll_total_view_search->PayrollPeriod->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_total_view_search->PayPeriod->Visible) { // PayPeriod ?>
	<div id="r_PayPeriod" class="form-group row">
		<label for="x_PayPeriod" class="<?php echo $payroll_total_view_search->LeftColumnClass ?>"><span id="elh_payroll_total_view_PayPeriod"><?php echo $payroll_total_view_search->PayPeriod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PayPeriod" id="z_PayPeriod" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payroll_total_view_search->RightColumnClass ?>"><div <?php echo $payroll_total_view_search->PayPeriod->cellAttributes() ?>>
			<span id="el_payroll_total_view_PayPeriod" class="ew-search-field">
<input type="text" data-table="payroll_total_view" data-field="x_PayPeriod" name="x_PayPeriod" id="x_PayPeriod" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($payroll_total_view_search->PayPeriod->getPlaceHolder()) ?>" value="<?php echo $payroll_total_view_search->PayPeriod->EditValue ?>"<?php echo $payroll_total_view_search->PayPeriod->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_total_view_search->Income->Visible) { // Income ?>
	<div id="r_Income" class="form-group row">
		<label for="x_Income" class="<?php echo $payroll_total_view_search->LeftColumnClass ?>"><span id="elh_payroll_total_view_Income"><?php echo $payroll_total_view_search->Income->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Income" id="z_Income" value="=">
</span>
		</label>
		<div class="<?php echo $payroll_total_view_search->RightColumnClass ?>"><div <?php echo $payroll_total_view_search->Income->cellAttributes() ?>>
			<span id="el_payroll_total_view_Income" class="ew-search-field">
<input type="text" data-table="payroll_total_view" data-field="x_Income" name="x_Income" id="x_Income" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($payroll_total_view_search->Income->getPlaceHolder()) ?>" value="<?php echo $payroll_total_view_search->Income->EditValue ?>"<?php echo $payroll_total_view_search->Income->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_total_view_search->Item->Visible) { // Item ?>
	<div id="r_Item" class="form-group row">
		<label for="x_Item" class="<?php echo $payroll_total_view_search->LeftColumnClass ?>"><span id="elh_payroll_total_view_Item"><?php echo $payroll_total_view_search->Item->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Item" id="z_Item" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payroll_total_view_search->RightColumnClass ?>"><div <?php echo $payroll_total_view_search->Item->cellAttributes() ?>>
			<span id="el_payroll_total_view_Item" class="ew-search-field">
<input type="text" data-table="payroll_total_view" data-field="x_Item" name="x_Item" id="x_Item" size="30" maxlength="9" placeholder="<?php echo HtmlEncode($payroll_total_view_search->Item->getPlaceHolder()) ?>" value="<?php echo $payroll_total_view_search->Item->EditValue ?>"<?php echo $payroll_total_view_search->Item->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$payroll_total_view_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $payroll_total_view_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$payroll_total_view_search->showPageFooter();
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
$payroll_total_view_search->terminate();
?>