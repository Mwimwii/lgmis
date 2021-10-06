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
$_paye_view_search = new _paye_view_search();

// Run the page
$_paye_view_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_paye_view_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var f_paye_viewsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($_paye_view_search->IsModal) { ?>
	f_paye_viewsearch = currentAdvancedSearchForm = new ew.Form("f_paye_viewsearch", "search");
	<?php } else { ?>
	f_paye_viewsearch = currentForm = new ew.Form("f_paye_viewsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	f_paye_viewsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_paye_view_search->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PayrollPeriod");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_paye_view_search->PayrollPeriod->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Year");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_paye_view_search->Year->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_TaxableIncome");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_paye_view_search->TaxableIncome->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_GrossIncome");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_paye_view_search->GrossIncome->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PAYE");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_paye_view_search->PAYE->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_EmploymentType");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_paye_view_search->EmploymentType->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	f_paye_viewsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	f_paye_viewsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("f_paye_viewsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $_paye_view_search->showPageHeader(); ?>
<?php
$_paye_view_search->showMessage();
?>
<form name="f_paye_viewsearch" id="f_paye_viewsearch" class="<?php echo $_paye_view_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_paye_view">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$_paye_view_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($_paye_view_search->LocalAuthority->Visible) { // LocalAuthority ?>
	<div id="r_LocalAuthority" class="form-group row">
		<label for="x_LocalAuthority" class="<?php echo $_paye_view_search->LeftColumnClass ?>"><span id="elh__paye_view_LocalAuthority"><?php echo $_paye_view_search->LocalAuthority->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LocalAuthority" id="z_LocalAuthority" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_paye_view_search->RightColumnClass ?>"><div <?php echo $_paye_view_search->LocalAuthority->cellAttributes() ?>>
			<span id="el__paye_view_LocalAuthority" class="ew-search-field">
<input type="text" data-table="_paye_view" data-field="x_LocalAuthority" name="x_LocalAuthority" id="x_LocalAuthority" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($_paye_view_search->LocalAuthority->getPlaceHolder()) ?>" value="<?php echo $_paye_view_search->LocalAuthority->EditValue ?>"<?php echo $_paye_view_search->LocalAuthority->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_paye_view_search->DepartmentName->Visible) { // DepartmentName ?>
	<div id="r_DepartmentName" class="form-group row">
		<label for="x_DepartmentName" class="<?php echo $_paye_view_search->LeftColumnClass ?>"><span id="elh__paye_view_DepartmentName"><?php echo $_paye_view_search->DepartmentName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DepartmentName" id="z_DepartmentName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_paye_view_search->RightColumnClass ?>"><div <?php echo $_paye_view_search->DepartmentName->cellAttributes() ?>>
			<span id="el__paye_view_DepartmentName" class="ew-search-field">
<input type="text" data-table="_paye_view" data-field="x_DepartmentName" name="x_DepartmentName" id="x_DepartmentName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_paye_view_search->DepartmentName->getPlaceHolder()) ?>" value="<?php echo $_paye_view_search->DepartmentName->EditValue ?>"<?php echo $_paye_view_search->DepartmentName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_paye_view_search->SectionName->Visible) { // SectionName ?>
	<div id="r_SectionName" class="form-group row">
		<label for="x_SectionName" class="<?php echo $_paye_view_search->LeftColumnClass ?>"><span id="elh__paye_view_SectionName"><?php echo $_paye_view_search->SectionName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SectionName" id="z_SectionName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_paye_view_search->RightColumnClass ?>"><div <?php echo $_paye_view_search->SectionName->cellAttributes() ?>>
			<span id="el__paye_view_SectionName" class="ew-search-field">
<input type="text" data-table="_paye_view" data-field="x_SectionName" name="x_SectionName" id="x_SectionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_paye_view_search->SectionName->getPlaceHolder()) ?>" value="<?php echo $_paye_view_search->SectionName->EditValue ?>"<?php echo $_paye_view_search->SectionName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_paye_view_search->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label for="x_EmployeeID" class="<?php echo $_paye_view_search->LeftColumnClass ?>"><span id="elh__paye_view_EmployeeID"><?php echo $_paye_view_search->EmployeeID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		</label>
		<div class="<?php echo $_paye_view_search->RightColumnClass ?>"><div <?php echo $_paye_view_search->EmployeeID->cellAttributes() ?>>
			<span id="el__paye_view_EmployeeID" class="ew-search-field">
<input type="text" data-table="_paye_view" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($_paye_view_search->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $_paye_view_search->EmployeeID->EditValue ?>"<?php echo $_paye_view_search->EmployeeID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_paye_view_search->EmployeeNames->Visible) { // EmployeeNames ?>
	<div id="r_EmployeeNames" class="form-group row">
		<label for="x_EmployeeNames" class="<?php echo $_paye_view_search->LeftColumnClass ?>"><span id="elh__paye_view_EmployeeNames"><?php echo $_paye_view_search->EmployeeNames->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_EmployeeNames" id="z_EmployeeNames" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_paye_view_search->RightColumnClass ?>"><div <?php echo $_paye_view_search->EmployeeNames->cellAttributes() ?>>
			<span id="el__paye_view_EmployeeNames" class="ew-search-field">
<input type="text" data-table="_paye_view" data-field="x_EmployeeNames" name="x_EmployeeNames" id="x_EmployeeNames" size="35" maxlength="302" placeholder="<?php echo HtmlEncode($_paye_view_search->EmployeeNames->getPlaceHolder()) ?>" value="<?php echo $_paye_view_search->EmployeeNames->EditValue ?>"<?php echo $_paye_view_search->EmployeeNames->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_paye_view_search->NRC->Visible) { // NRC ?>
	<div id="r_NRC" class="form-group row">
		<label for="x_NRC" class="<?php echo $_paye_view_search->LeftColumnClass ?>"><span id="elh__paye_view_NRC"><?php echo $_paye_view_search->NRC->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_NRC" id="z_NRC" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_paye_view_search->RightColumnClass ?>"><div <?php echo $_paye_view_search->NRC->cellAttributes() ?>>
			<span id="el__paye_view_NRC" class="ew-search-field">
<input type="text" data-table="_paye_view" data-field="x_NRC" name="x_NRC" id="x_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($_paye_view_search->NRC->getPlaceHolder()) ?>" value="<?php echo $_paye_view_search->NRC->EditValue ?>"<?php echo $_paye_view_search->NRC->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_paye_view_search->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
	<div id="r_SocialSecurityNo" class="form-group row">
		<label for="x_SocialSecurityNo" class="<?php echo $_paye_view_search->LeftColumnClass ?>"><span id="elh__paye_view_SocialSecurityNo"><?php echo $_paye_view_search->SocialSecurityNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SocialSecurityNo" id="z_SocialSecurityNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_paye_view_search->RightColumnClass ?>"><div <?php echo $_paye_view_search->SocialSecurityNo->cellAttributes() ?>>
			<span id="el__paye_view_SocialSecurityNo" class="ew-search-field">
<input type="text" data-table="_paye_view" data-field="x_SocialSecurityNo" name="x_SocialSecurityNo" id="x_SocialSecurityNo" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($_paye_view_search->SocialSecurityNo->getPlaceHolder()) ?>" value="<?php echo $_paye_view_search->SocialSecurityNo->EditValue ?>"<?php echo $_paye_view_search->SocialSecurityNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_paye_view_search->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<div id="r_PayrollPeriod" class="form-group row">
		<label for="x_PayrollPeriod" class="<?php echo $_paye_view_search->LeftColumnClass ?>"><span id="elh__paye_view_PayrollPeriod"><?php echo $_paye_view_search->PayrollPeriod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PayrollPeriod" id="z_PayrollPeriod" value="=">
</span>
		</label>
		<div class="<?php echo $_paye_view_search->RightColumnClass ?>"><div <?php echo $_paye_view_search->PayrollPeriod->cellAttributes() ?>>
			<span id="el__paye_view_PayrollPeriod" class="ew-search-field">
<input type="text" data-table="_paye_view" data-field="x_PayrollPeriod" name="x_PayrollPeriod" id="x_PayrollPeriod" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($_paye_view_search->PayrollPeriod->getPlaceHolder()) ?>" value="<?php echo $_paye_view_search->PayrollPeriod->EditValue ?>"<?php echo $_paye_view_search->PayrollPeriod->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_paye_view_search->MonthShort->Visible) { // MonthShort ?>
	<div id="r_MonthShort" class="form-group row">
		<label for="x_MonthShort" class="<?php echo $_paye_view_search->LeftColumnClass ?>"><span id="elh__paye_view_MonthShort"><?php echo $_paye_view_search->MonthShort->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_MonthShort" id="z_MonthShort" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_paye_view_search->RightColumnClass ?>"><div <?php echo $_paye_view_search->MonthShort->cellAttributes() ?>>
			<span id="el__paye_view_MonthShort" class="ew-search-field">
<input type="text" data-table="_paye_view" data-field="x_MonthShort" name="x_MonthShort" id="x_MonthShort" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($_paye_view_search->MonthShort->getPlaceHolder()) ?>" value="<?php echo $_paye_view_search->MonthShort->EditValue ?>"<?php echo $_paye_view_search->MonthShort->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_paye_view_search->Year->Visible) { // Year ?>
	<div id="r_Year" class="form-group row">
		<label for="x_Year" class="<?php echo $_paye_view_search->LeftColumnClass ?>"><span id="elh__paye_view_Year"><?php echo $_paye_view_search->Year->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Year" id="z_Year" value="=">
</span>
		</label>
		<div class="<?php echo $_paye_view_search->RightColumnClass ?>"><div <?php echo $_paye_view_search->Year->cellAttributes() ?>>
			<span id="el__paye_view_Year" class="ew-search-field">
<input type="text" data-table="_paye_view" data-field="x_Year" name="x_Year" id="x_Year" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($_paye_view_search->Year->getPlaceHolder()) ?>" value="<?php echo $_paye_view_search->Year->EditValue ?>"<?php echo $_paye_view_search->Year->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_paye_view_search->TaxableIncome->Visible) { // TaxableIncome ?>
	<div id="r_TaxableIncome" class="form-group row">
		<label for="x_TaxableIncome" class="<?php echo $_paye_view_search->LeftColumnClass ?>"><span id="elh__paye_view_TaxableIncome"><?php echo $_paye_view_search->TaxableIncome->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_TaxableIncome" id="z_TaxableIncome" value="=">
</span>
		</label>
		<div class="<?php echo $_paye_view_search->RightColumnClass ?>"><div <?php echo $_paye_view_search->TaxableIncome->cellAttributes() ?>>
			<span id="el__paye_view_TaxableIncome" class="ew-search-field">
<input type="text" data-table="_paye_view" data-field="x_TaxableIncome" name="x_TaxableIncome" id="x_TaxableIncome" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($_paye_view_search->TaxableIncome->getPlaceHolder()) ?>" value="<?php echo $_paye_view_search->TaxableIncome->EditValue ?>"<?php echo $_paye_view_search->TaxableIncome->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_paye_view_search->GrossIncome->Visible) { // GrossIncome ?>
	<div id="r_GrossIncome" class="form-group row">
		<label for="x_GrossIncome" class="<?php echo $_paye_view_search->LeftColumnClass ?>"><span id="elh__paye_view_GrossIncome"><?php echo $_paye_view_search->GrossIncome->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_GrossIncome" id="z_GrossIncome" value="=">
</span>
		</label>
		<div class="<?php echo $_paye_view_search->RightColumnClass ?>"><div <?php echo $_paye_view_search->GrossIncome->cellAttributes() ?>>
			<span id="el__paye_view_GrossIncome" class="ew-search-field">
<input type="text" data-table="_paye_view" data-field="x_GrossIncome" name="x_GrossIncome" id="x_GrossIncome" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($_paye_view_search->GrossIncome->getPlaceHolder()) ?>" value="<?php echo $_paye_view_search->GrossIncome->EditValue ?>"<?php echo $_paye_view_search->GrossIncome->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_paye_view_search->PAYE->Visible) { // PAYE ?>
	<div id="r_PAYE" class="form-group row">
		<label for="x_PAYE" class="<?php echo $_paye_view_search->LeftColumnClass ?>"><span id="elh__paye_view_PAYE"><?php echo $_paye_view_search->PAYE->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PAYE" id="z_PAYE" value="=">
</span>
		</label>
		<div class="<?php echo $_paye_view_search->RightColumnClass ?>"><div <?php echo $_paye_view_search->PAYE->cellAttributes() ?>>
			<span id="el__paye_view_PAYE" class="ew-search-field">
<input type="text" data-table="_paye_view" data-field="x_PAYE" name="x_PAYE" id="x_PAYE" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($_paye_view_search->PAYE->getPlaceHolder()) ?>" value="<?php echo $_paye_view_search->PAYE->EditValue ?>"<?php echo $_paye_view_search->PAYE->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_paye_view_search->EmploymentType->Visible) { // EmploymentType ?>
	<div id="r_EmploymentType" class="form-group row">
		<label for="x_EmploymentType" class="<?php echo $_paye_view_search->LeftColumnClass ?>"><span id="elh__paye_view_EmploymentType"><?php echo $_paye_view_search->EmploymentType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmploymentType" id="z_EmploymentType" value="=">
</span>
		</label>
		<div class="<?php echo $_paye_view_search->RightColumnClass ?>"><div <?php echo $_paye_view_search->EmploymentType->cellAttributes() ?>>
			<span id="el__paye_view_EmploymentType" class="ew-search-field">
<input type="text" data-table="_paye_view" data-field="x_EmploymentType" name="x_EmploymentType" id="x_EmploymentType" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($_paye_view_search->EmploymentType->getPlaceHolder()) ?>" value="<?php echo $_paye_view_search->EmploymentType->EditValue ?>"<?php echo $_paye_view_search->EmploymentType->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$_paye_view_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $_paye_view_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$_paye_view_search->showPageFooter();
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
$_paye_view_search->terminate();
?>