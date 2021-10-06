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
$monthly_payroll_journal_view_search = new monthly_payroll_journal_view_search();

// Run the page
$monthly_payroll_journal_view_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$monthly_payroll_journal_view_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmonthly_payroll_journal_viewsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($monthly_payroll_journal_view_search->IsModal) { ?>
	fmonthly_payroll_journal_viewsearch = currentAdvancedSearchForm = new ew.Form("fmonthly_payroll_journal_viewsearch", "search");
	<?php } else { ?>
	fmonthly_payroll_journal_viewsearch = currentForm = new ew.Form("fmonthly_payroll_journal_viewsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fmonthly_payroll_journal_viewsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_PayrollPeriod");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($monthly_payroll_journal_view_search->PayrollPeriod->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_IncomeAmount");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($monthly_payroll_journal_view_search->IncomeAmount->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DeductionAmount");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($monthly_payroll_journal_view_search->DeductionAmount->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fmonthly_payroll_journal_viewsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmonthly_payroll_journal_viewsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fmonthly_payroll_journal_viewsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $monthly_payroll_journal_view_search->showPageHeader(); ?>
<?php
$monthly_payroll_journal_view_search->showMessage();
?>
<form name="fmonthly_payroll_journal_viewsearch" id="fmonthly_payroll_journal_viewsearch" class="<?php echo $monthly_payroll_journal_view_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="monthly_payroll_journal_view">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$monthly_payroll_journal_view_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($monthly_payroll_journal_view_search->LocalAuthority->Visible) { // LocalAuthority ?>
	<div id="r_LocalAuthority" class="form-group row">
		<label for="x_LocalAuthority" class="<?php echo $monthly_payroll_journal_view_search->LeftColumnClass ?>"><span id="elh_monthly_payroll_journal_view_LocalAuthority"><?php echo $monthly_payroll_journal_view_search->LocalAuthority->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LocalAuthority" id="z_LocalAuthority" value="LIKE">
</span>
		</label>
		<div class="<?php echo $monthly_payroll_journal_view_search->RightColumnClass ?>"><div <?php echo $monthly_payroll_journal_view_search->LocalAuthority->cellAttributes() ?>>
			<span id="el_monthly_payroll_journal_view_LocalAuthority" class="ew-search-field">
<input type="text" data-table="monthly_payroll_journal_view" data-field="x_LocalAuthority" name="x_LocalAuthority" id="x_LocalAuthority" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($monthly_payroll_journal_view_search->LocalAuthority->getPlaceHolder()) ?>" value="<?php echo $monthly_payroll_journal_view_search->LocalAuthority->EditValue ?>"<?php echo $monthly_payroll_journal_view_search->LocalAuthority->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($monthly_payroll_journal_view_search->Period->Visible) { // Period ?>
	<div id="r_Period" class="form-group row">
		<label for="x_Period" class="<?php echo $monthly_payroll_journal_view_search->LeftColumnClass ?>"><span id="elh_monthly_payroll_journal_view_Period"><?php echo $monthly_payroll_journal_view_search->Period->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Period" id="z_Period" value="LIKE">
</span>
		</label>
		<div class="<?php echo $monthly_payroll_journal_view_search->RightColumnClass ?>"><div <?php echo $monthly_payroll_journal_view_search->Period->cellAttributes() ?>>
			<span id="el_monthly_payroll_journal_view_Period" class="ew-search-field">
<input type="text" data-table="monthly_payroll_journal_view" data-field="x_Period" name="x_Period" id="x_Period" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($monthly_payroll_journal_view_search->Period->getPlaceHolder()) ?>" value="<?php echo $monthly_payroll_journal_view_search->Period->EditValue ?>"<?php echo $monthly_payroll_journal_view_search->Period->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($monthly_payroll_journal_view_search->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<div id="r_PayrollPeriod" class="form-group row">
		<label for="x_PayrollPeriod" class="<?php echo $monthly_payroll_journal_view_search->LeftColumnClass ?>"><span id="elh_monthly_payroll_journal_view_PayrollPeriod"><?php echo $monthly_payroll_journal_view_search->PayrollPeriod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PayrollPeriod" id="z_PayrollPeriod" value="=">
</span>
		</label>
		<div class="<?php echo $monthly_payroll_journal_view_search->RightColumnClass ?>"><div <?php echo $monthly_payroll_journal_view_search->PayrollPeriod->cellAttributes() ?>>
			<span id="el_monthly_payroll_journal_view_PayrollPeriod" class="ew-search-field">
<input type="text" data-table="monthly_payroll_journal_view" data-field="x_PayrollPeriod" name="x_PayrollPeriod" id="x_PayrollPeriod" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($monthly_payroll_journal_view_search->PayrollPeriod->getPlaceHolder()) ?>" value="<?php echo $monthly_payroll_journal_view_search->PayrollPeriod->EditValue ?>"<?php echo $monthly_payroll_journal_view_search->PayrollPeriod->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($monthly_payroll_journal_view_search->AmtType->Visible) { // AmtType ?>
	<div id="r_AmtType" class="form-group row">
		<label for="x_AmtType" class="<?php echo $monthly_payroll_journal_view_search->LeftColumnClass ?>"><span id="elh_monthly_payroll_journal_view_AmtType"><?php echo $monthly_payroll_journal_view_search->AmtType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AmtType" id="z_AmtType" value="LIKE">
</span>
		</label>
		<div class="<?php echo $monthly_payroll_journal_view_search->RightColumnClass ?>"><div <?php echo $monthly_payroll_journal_view_search->AmtType->cellAttributes() ?>>
			<span id="el_monthly_payroll_journal_view_AmtType" class="ew-search-field">
<input type="text" data-table="monthly_payroll_journal_view" data-field="x_AmtType" name="x_AmtType" id="x_AmtType" size="30" maxlength="9" placeholder="<?php echo HtmlEncode($monthly_payroll_journal_view_search->AmtType->getPlaceHolder()) ?>" value="<?php echo $monthly_payroll_journal_view_search->AmtType->EditValue ?>"<?php echo $monthly_payroll_journal_view_search->AmtType->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($monthly_payroll_journal_view_search->IncomeCode->Visible) { // IncomeCode ?>
	<div id="r_IncomeCode" class="form-group row">
		<label for="x_IncomeCode" class="<?php echo $monthly_payroll_journal_view_search->LeftColumnClass ?>"><span id="elh_monthly_payroll_journal_view_IncomeCode"><?php echo $monthly_payroll_journal_view_search->IncomeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_IncomeCode" id="z_IncomeCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $monthly_payroll_journal_view_search->RightColumnClass ?>"><div <?php echo $monthly_payroll_journal_view_search->IncomeCode->cellAttributes() ?>>
			<span id="el_monthly_payroll_journal_view_IncomeCode" class="ew-search-field">
<input type="text" data-table="monthly_payroll_journal_view" data-field="x_IncomeCode" name="x_IncomeCode" id="x_IncomeCode" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($monthly_payroll_journal_view_search->IncomeCode->getPlaceHolder()) ?>" value="<?php echo $monthly_payroll_journal_view_search->IncomeCode->EditValue ?>"<?php echo $monthly_payroll_journal_view_search->IncomeCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($monthly_payroll_journal_view_search->IncomeName->Visible) { // IncomeName ?>
	<div id="r_IncomeName" class="form-group row">
		<label for="x_IncomeName" class="<?php echo $monthly_payroll_journal_view_search->LeftColumnClass ?>"><span id="elh_monthly_payroll_journal_view_IncomeName"><?php echo $monthly_payroll_journal_view_search->IncomeName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_IncomeName" id="z_IncomeName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $monthly_payroll_journal_view_search->RightColumnClass ?>"><div <?php echo $monthly_payroll_journal_view_search->IncomeName->cellAttributes() ?>>
			<span id="el_monthly_payroll_journal_view_IncomeName" class="ew-search-field">
<input type="text" data-table="monthly_payroll_journal_view" data-field="x_IncomeName" name="x_IncomeName" id="x_IncomeName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($monthly_payroll_journal_view_search->IncomeName->getPlaceHolder()) ?>" value="<?php echo $monthly_payroll_journal_view_search->IncomeName->EditValue ?>"<?php echo $monthly_payroll_journal_view_search->IncomeName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($monthly_payroll_journal_view_search->IncomeAmount->Visible) { // IncomeAmount ?>
	<div id="r_IncomeAmount" class="form-group row">
		<label for="x_IncomeAmount" class="<?php echo $monthly_payroll_journal_view_search->LeftColumnClass ?>"><span id="elh_monthly_payroll_journal_view_IncomeAmount"><?php echo $monthly_payroll_journal_view_search->IncomeAmount->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_IncomeAmount" id="z_IncomeAmount" value="=">
</span>
		</label>
		<div class="<?php echo $monthly_payroll_journal_view_search->RightColumnClass ?>"><div <?php echo $monthly_payroll_journal_view_search->IncomeAmount->cellAttributes() ?>>
			<span id="el_monthly_payroll_journal_view_IncomeAmount" class="ew-search-field">
<input type="text" data-table="monthly_payroll_journal_view" data-field="x_IncomeAmount" name="x_IncomeAmount" id="x_IncomeAmount" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($monthly_payroll_journal_view_search->IncomeAmount->getPlaceHolder()) ?>" value="<?php echo $monthly_payroll_journal_view_search->IncomeAmount->EditValue ?>"<?php echo $monthly_payroll_journal_view_search->IncomeAmount->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($monthly_payroll_journal_view_search->DeductionCode->Visible) { // DeductionCode ?>
	<div id="r_DeductionCode" class="form-group row">
		<label for="x_DeductionCode" class="<?php echo $monthly_payroll_journal_view_search->LeftColumnClass ?>"><span id="elh_monthly_payroll_journal_view_DeductionCode"><?php echo $monthly_payroll_journal_view_search->DeductionCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DeductionCode" id="z_DeductionCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $monthly_payroll_journal_view_search->RightColumnClass ?>"><div <?php echo $monthly_payroll_journal_view_search->DeductionCode->cellAttributes() ?>>
			<span id="el_monthly_payroll_journal_view_DeductionCode" class="ew-search-field">
<input type="text" data-table="monthly_payroll_journal_view" data-field="x_DeductionCode" name="x_DeductionCode" id="x_DeductionCode" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($monthly_payroll_journal_view_search->DeductionCode->getPlaceHolder()) ?>" value="<?php echo $monthly_payroll_journal_view_search->DeductionCode->EditValue ?>"<?php echo $monthly_payroll_journal_view_search->DeductionCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($monthly_payroll_journal_view_search->DeductionName->Visible) { // DeductionName ?>
	<div id="r_DeductionName" class="form-group row">
		<label for="x_DeductionName" class="<?php echo $monthly_payroll_journal_view_search->LeftColumnClass ?>"><span id="elh_monthly_payroll_journal_view_DeductionName"><?php echo $monthly_payroll_journal_view_search->DeductionName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DeductionName" id="z_DeductionName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $monthly_payroll_journal_view_search->RightColumnClass ?>"><div <?php echo $monthly_payroll_journal_view_search->DeductionName->cellAttributes() ?>>
			<span id="el_monthly_payroll_journal_view_DeductionName" class="ew-search-field">
<input type="text" data-table="monthly_payroll_journal_view" data-field="x_DeductionName" name="x_DeductionName" id="x_DeductionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($monthly_payroll_journal_view_search->DeductionName->getPlaceHolder()) ?>" value="<?php echo $monthly_payroll_journal_view_search->DeductionName->EditValue ?>"<?php echo $monthly_payroll_journal_view_search->DeductionName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($monthly_payroll_journal_view_search->DeductionAmount->Visible) { // DeductionAmount ?>
	<div id="r_DeductionAmount" class="form-group row">
		<label for="x_DeductionAmount" class="<?php echo $monthly_payroll_journal_view_search->LeftColumnClass ?>"><span id="elh_monthly_payroll_journal_view_DeductionAmount"><?php echo $monthly_payroll_journal_view_search->DeductionAmount->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DeductionAmount" id="z_DeductionAmount" value="=">
</span>
		</label>
		<div class="<?php echo $monthly_payroll_journal_view_search->RightColumnClass ?>"><div <?php echo $monthly_payroll_journal_view_search->DeductionAmount->cellAttributes() ?>>
			<span id="el_monthly_payroll_journal_view_DeductionAmount" class="ew-search-field">
<input type="text" data-table="monthly_payroll_journal_view" data-field="x_DeductionAmount" name="x_DeductionAmount" id="x_DeductionAmount" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($monthly_payroll_journal_view_search->DeductionAmount->getPlaceHolder()) ?>" value="<?php echo $monthly_payroll_journal_view_search->DeductionAmount->EditValue ?>"<?php echo $monthly_payroll_journal_view_search->DeductionAmount->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$monthly_payroll_journal_view_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $monthly_payroll_journal_view_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$monthly_payroll_journal_view_search->showPageFooter();
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
$monthly_payroll_journal_view_search->terminate();
?>