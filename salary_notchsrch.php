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
$salary_notch_search = new salary_notch_search();

// Run the page
$salary_notch_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$salary_notch_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsalary_notchsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($salary_notch_search->IsModal) { ?>
	fsalary_notchsearch = currentAdvancedSearchForm = new ew.Form("fsalary_notchsearch", "search");
	<?php } else { ?>
	fsalary_notchsearch = currentForm = new ew.Form("fsalary_notchsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fsalary_notchsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_Notch");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($salary_notch_search->Notch->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BasicMonthlySalary");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($salary_notch_search->BasicMonthlySalary->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_AnnualSalary");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($salary_notch_search->AnnualSalary->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fsalary_notchsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsalary_notchsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fsalary_notchsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $salary_notch_search->showPageHeader(); ?>
<?php
$salary_notch_search->showMessage();
?>
<form name="fsalary_notchsearch" id="fsalary_notchsearch" class="<?php echo $salary_notch_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="salary_notch">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$salary_notch_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($salary_notch_search->SalaryScale->Visible) { // SalaryScale ?>
	<div id="r_SalaryScale" class="form-group row">
		<label for="x_SalaryScale" class="<?php echo $salary_notch_search->LeftColumnClass ?>"><span id="elh_salary_notch_SalaryScale"><?php echo $salary_notch_search->SalaryScale->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SalaryScale" id="z_SalaryScale" value="LIKE">
</span>
		</label>
		<div class="<?php echo $salary_notch_search->RightColumnClass ?>"><div <?php echo $salary_notch_search->SalaryScale->cellAttributes() ?>>
			<span id="el_salary_notch_SalaryScale" class="ew-search-field">
<input type="text" data-table="salary_notch" data-field="x_SalaryScale" name="x_SalaryScale" id="x_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($salary_notch_search->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $salary_notch_search->SalaryScale->EditValue ?>"<?php echo $salary_notch_search->SalaryScale->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($salary_notch_search->Notch->Visible) { // Notch ?>
	<div id="r_Notch" class="form-group row">
		<label for="x_Notch" class="<?php echo $salary_notch_search->LeftColumnClass ?>"><span id="elh_salary_notch_Notch"><?php echo $salary_notch_search->Notch->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Notch" id="z_Notch" value="=">
</span>
		</label>
		<div class="<?php echo $salary_notch_search->RightColumnClass ?>"><div <?php echo $salary_notch_search->Notch->cellAttributes() ?>>
			<span id="el_salary_notch_Notch" class="ew-search-field">
<input type="text" data-table="salary_notch" data-field="x_Notch" name="x_Notch" id="x_Notch" size="30" placeholder="<?php echo HtmlEncode($salary_notch_search->Notch->getPlaceHolder()) ?>" value="<?php echo $salary_notch_search->Notch->EditValue ?>"<?php echo $salary_notch_search->Notch->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($salary_notch_search->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
	<div id="r_BasicMonthlySalary" class="form-group row">
		<label for="x_BasicMonthlySalary" class="<?php echo $salary_notch_search->LeftColumnClass ?>"><span id="elh_salary_notch_BasicMonthlySalary"><?php echo $salary_notch_search->BasicMonthlySalary->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BasicMonthlySalary" id="z_BasicMonthlySalary" value="=">
</span>
		</label>
		<div class="<?php echo $salary_notch_search->RightColumnClass ?>"><div <?php echo $salary_notch_search->BasicMonthlySalary->cellAttributes() ?>>
			<span id="el_salary_notch_BasicMonthlySalary" class="ew-search-field">
<input type="text" data-table="salary_notch" data-field="x_BasicMonthlySalary" name="x_BasicMonthlySalary" id="x_BasicMonthlySalary" size="30" placeholder="<?php echo HtmlEncode($salary_notch_search->BasicMonthlySalary->getPlaceHolder()) ?>" value="<?php echo $salary_notch_search->BasicMonthlySalary->EditValue ?>"<?php echo $salary_notch_search->BasicMonthlySalary->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($salary_notch_search->AnnualSalary->Visible) { // AnnualSalary ?>
	<div id="r_AnnualSalary" class="form-group row">
		<label for="x_AnnualSalary" class="<?php echo $salary_notch_search->LeftColumnClass ?>"><span id="elh_salary_notch_AnnualSalary"><?php echo $salary_notch_search->AnnualSalary->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AnnualSalary" id="z_AnnualSalary" value="=">
</span>
		</label>
		<div class="<?php echo $salary_notch_search->RightColumnClass ?>"><div <?php echo $salary_notch_search->AnnualSalary->cellAttributes() ?>>
			<span id="el_salary_notch_AnnualSalary" class="ew-search-field">
<input type="text" data-table="salary_notch" data-field="x_AnnualSalary" name="x_AnnualSalary" id="x_AnnualSalary" size="30" placeholder="<?php echo HtmlEncode($salary_notch_search->AnnualSalary->getPlaceHolder()) ?>" value="<?php echo $salary_notch_search->AnnualSalary->EditValue ?>"<?php echo $salary_notch_search->AnnualSalary->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$salary_notch_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $salary_notch_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$salary_notch_search->showPageFooter();
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
$salary_notch_search->terminate();
?>