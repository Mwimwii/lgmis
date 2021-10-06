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
$_payroll_net_schedule_view_search = new _payroll_net_schedule_view_search();

// Run the page
$_payroll_net_schedule_view_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_payroll_net_schedule_view_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var f_payroll_net_schedule_viewsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($_payroll_net_schedule_view_search->IsModal) { ?>
	f_payroll_net_schedule_viewsearch = currentAdvancedSearchForm = new ew.Form("f_payroll_net_schedule_viewsearch", "search");
	<?php } else { ?>
	f_payroll_net_schedule_viewsearch = currentForm = new ew.Form("f_payroll_net_schedule_viewsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	f_payroll_net_schedule_viewsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_NetPay");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_payroll_net_schedule_view_search->NetPay->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Division");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_payroll_net_schedule_view_search->Division->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_payroll_net_schedule_view_search->EmployeeID->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	f_payroll_net_schedule_viewsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	f_payroll_net_schedule_viewsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	f_payroll_net_schedule_viewsearch.lists["x_LocalAuthority"] = <?php echo $_payroll_net_schedule_view_search->LocalAuthority->Lookup->toClientList($_payroll_net_schedule_view_search) ?>;
	f_payroll_net_schedule_viewsearch.lists["x_LocalAuthority"].options = <?php echo JsonEncode($_payroll_net_schedule_view_search->LocalAuthority->lookupOptions()) ?>;
	f_payroll_net_schedule_viewsearch.lists["x_PayrollPeriod"] = <?php echo $_payroll_net_schedule_view_search->PayrollPeriod->Lookup->toClientList($_payroll_net_schedule_view_search) ?>;
	f_payroll_net_schedule_viewsearch.lists["x_PayrollPeriod"].options = <?php echo JsonEncode($_payroll_net_schedule_view_search->PayrollPeriod->lookupOptions()) ?>;
	loadjs.done("f_payroll_net_schedule_viewsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $_payroll_net_schedule_view_search->showPageHeader(); ?>
<?php
$_payroll_net_schedule_view_search->showMessage();
?>
<form name="f_payroll_net_schedule_viewsearch" id="f_payroll_net_schedule_viewsearch" class="<?php echo $_payroll_net_schedule_view_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_payroll_net_schedule_view">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$_payroll_net_schedule_view_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($_payroll_net_schedule_view_search->LocalAuthority->Visible) { // LocalAuthority ?>
	<div id="r_LocalAuthority" class="form-group row">
		<label for="x_LocalAuthority" class="<?php echo $_payroll_net_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_net_schedule_view_LocalAuthority"><?php echo $_payroll_net_schedule_view_search->LocalAuthority->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LocalAuthority" id="z_LocalAuthority" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_payroll_net_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_net_schedule_view_search->LocalAuthority->cellAttributes() ?>>
			<span id="el__payroll_net_schedule_view_LocalAuthority" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LocalAuthority"><?php echo EmptyValue(strval($_payroll_net_schedule_view_search->LocalAuthority->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $_payroll_net_schedule_view_search->LocalAuthority->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_payroll_net_schedule_view_search->LocalAuthority->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($_payroll_net_schedule_view_search->LocalAuthority->ReadOnly || $_payroll_net_schedule_view_search->LocalAuthority->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LocalAuthority',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $_payroll_net_schedule_view_search->LocalAuthority->Lookup->getParamTag($_payroll_net_schedule_view_search, "p_x_LocalAuthority") ?>
<input type="hidden" data-table="_payroll_net_schedule_view" data-field="x_LocalAuthority" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_payroll_net_schedule_view_search->LocalAuthority->displayValueSeparatorAttribute() ?>" name="x_LocalAuthority" id="x_LocalAuthority" value="<?php echo $_payroll_net_schedule_view_search->LocalAuthority->AdvancedSearch->SearchValue ?>"<?php echo $_payroll_net_schedule_view_search->LocalAuthority->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_net_schedule_view_search->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<div id="r_PayrollPeriod" class="form-group row">
		<label for="x_PayrollPeriod" class="<?php echo $_payroll_net_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_net_schedule_view_PayrollPeriod"><?php echo $_payroll_net_schedule_view_search->PayrollPeriod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PayrollPeriod" id="z_PayrollPeriod" value="=">
</span>
		</label>
		<div class="<?php echo $_payroll_net_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_net_schedule_view_search->PayrollPeriod->cellAttributes() ?>>
			<span id="el__payroll_net_schedule_view_PayrollPeriod" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_payroll_net_schedule_view" data-field="x_PayrollPeriod" data-value-separator="<?php echo $_payroll_net_schedule_view_search->PayrollPeriod->displayValueSeparatorAttribute() ?>" id="x_PayrollPeriod" name="x_PayrollPeriod"<?php echo $_payroll_net_schedule_view_search->PayrollPeriod->editAttributes() ?>>
			<?php echo $_payroll_net_schedule_view_search->PayrollPeriod->selectOptionListHtml("x_PayrollPeriod") ?>
		</select>
</div>
<?php echo $_payroll_net_schedule_view_search->PayrollPeriod->Lookup->getParamTag($_payroll_net_schedule_view_search, "p_x_PayrollPeriod") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_net_schedule_view_search->Title->Visible) { // Title ?>
	<div id="r_Title" class="form-group row">
		<label for="x_Title" class="<?php echo $_payroll_net_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_net_schedule_view_Title"><?php echo $_payroll_net_schedule_view_search->Title->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Title" id="z_Title" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_payroll_net_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_net_schedule_view_search->Title->cellAttributes() ?>>
			<span id="el__payroll_net_schedule_view_Title" class="ew-search-field">
<input type="text" data-table="_payroll_net_schedule_view" data-field="x_Title" name="x_Title" id="x_Title" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($_payroll_net_schedule_view_search->Title->getPlaceHolder()) ?>" value="<?php echo $_payroll_net_schedule_view_search->Title->EditValue ?>"<?php echo $_payroll_net_schedule_view_search->Title->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_net_schedule_view_search->Surname->Visible) { // Surname ?>
	<div id="r_Surname" class="form-group row">
		<label for="x_Surname" class="<?php echo $_payroll_net_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_net_schedule_view_Surname"><?php echo $_payroll_net_schedule_view_search->Surname->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Surname" id="z_Surname" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_payroll_net_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_net_schedule_view_search->Surname->cellAttributes() ?>>
			<span id="el__payroll_net_schedule_view_Surname" class="ew-search-field">
<input type="text" data-table="_payroll_net_schedule_view" data-field="x_Surname" name="x_Surname" id="x_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($_payroll_net_schedule_view_search->Surname->getPlaceHolder()) ?>" value="<?php echo $_payroll_net_schedule_view_search->Surname->EditValue ?>"<?php echo $_payroll_net_schedule_view_search->Surname->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_net_schedule_view_search->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label for="x_FirstName" class="<?php echo $_payroll_net_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_net_schedule_view_FirstName"><?php echo $_payroll_net_schedule_view_search->FirstName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_FirstName" id="z_FirstName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_payroll_net_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_net_schedule_view_search->FirstName->cellAttributes() ?>>
			<span id="el__payroll_net_schedule_view_FirstName" class="ew-search-field">
<input type="text" data-table="_payroll_net_schedule_view" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($_payroll_net_schedule_view_search->FirstName->getPlaceHolder()) ?>" value="<?php echo $_payroll_net_schedule_view_search->FirstName->EditValue ?>"<?php echo $_payroll_net_schedule_view_search->FirstName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_net_schedule_view_search->MiddleName->Visible) { // MiddleName ?>
	<div id="r_MiddleName" class="form-group row">
		<label for="x_MiddleName" class="<?php echo $_payroll_net_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_net_schedule_view_MiddleName"><?php echo $_payroll_net_schedule_view_search->MiddleName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_MiddleName" id="z_MiddleName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_payroll_net_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_net_schedule_view_search->MiddleName->cellAttributes() ?>>
			<span id="el__payroll_net_schedule_view_MiddleName" class="ew-search-field">
<input type="text" data-table="_payroll_net_schedule_view" data-field="x_MiddleName" name="x_MiddleName" id="x_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($_payroll_net_schedule_view_search->MiddleName->getPlaceHolder()) ?>" value="<?php echo $_payroll_net_schedule_view_search->MiddleName->EditValue ?>"<?php echo $_payroll_net_schedule_view_search->MiddleName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_net_schedule_view_search->PositionName->Visible) { // PositionName ?>
	<div id="r_PositionName" class="form-group row">
		<label for="x_PositionName" class="<?php echo $_payroll_net_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_net_schedule_view_PositionName"><?php echo $_payroll_net_schedule_view_search->PositionName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PositionName" id="z_PositionName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_payroll_net_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_net_schedule_view_search->PositionName->cellAttributes() ?>>
			<span id="el__payroll_net_schedule_view_PositionName" class="ew-search-field">
<input type="text" data-table="_payroll_net_schedule_view" data-field="x_PositionName" name="x_PositionName" id="x_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_payroll_net_schedule_view_search->PositionName->getPlaceHolder()) ?>" value="<?php echo $_payroll_net_schedule_view_search->PositionName->EditValue ?>"<?php echo $_payroll_net_schedule_view_search->PositionName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_net_schedule_view_search->Net_Pay->Visible) { // Net Pay ?>
	<div id="r_Net_Pay" class="form-group row">
		<label for="x_Net_Pay" class="<?php echo $_payroll_net_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_net_schedule_view_Net_Pay"><?php echo $_payroll_net_schedule_view_search->Net_Pay->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Net_Pay" id="z_Net_Pay" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_payroll_net_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_net_schedule_view_search->Net_Pay->cellAttributes() ?>>
			<span id="el__payroll_net_schedule_view_Net_Pay" class="ew-search-field">
<input type="text" data-table="_payroll_net_schedule_view" data-field="x_Net_Pay" name="x_Net_Pay" id="x_Net_Pay" size="30" maxlength="7" placeholder="<?php echo HtmlEncode($_payroll_net_schedule_view_search->Net_Pay->getPlaceHolder()) ?>" value="<?php echo $_payroll_net_schedule_view_search->Net_Pay->EditValue ?>"<?php echo $_payroll_net_schedule_view_search->Net_Pay->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_net_schedule_view_search->NetPay->Visible) { // NetPay ?>
	<div id="r_NetPay" class="form-group row">
		<label for="x_NetPay" class="<?php echo $_payroll_net_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_net_schedule_view_NetPay"><?php echo $_payroll_net_schedule_view_search->NetPay->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_NetPay" id="z_NetPay" value="=">
</span>
		</label>
		<div class="<?php echo $_payroll_net_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_net_schedule_view_search->NetPay->cellAttributes() ?>>
			<span id="el__payroll_net_schedule_view_NetPay" class="ew-search-field">
<input type="text" data-table="_payroll_net_schedule_view" data-field="x_NetPay" name="x_NetPay" id="x_NetPay" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($_payroll_net_schedule_view_search->NetPay->getPlaceHolder()) ?>" value="<?php echo $_payroll_net_schedule_view_search->NetPay->EditValue ?>"<?php echo $_payroll_net_schedule_view_search->NetPay->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_net_schedule_view_search->PaymentMethod->Visible) { // PaymentMethod ?>
	<div id="r_PaymentMethod" class="form-group row">
		<label for="x_PaymentMethod" class="<?php echo $_payroll_net_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_net_schedule_view_PaymentMethod"><?php echo $_payroll_net_schedule_view_search->PaymentMethod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PaymentMethod" id="z_PaymentMethod" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_payroll_net_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_net_schedule_view_search->PaymentMethod->cellAttributes() ?>>
			<span id="el__payroll_net_schedule_view_PaymentMethod" class="ew-search-field">
<input type="text" data-table="_payroll_net_schedule_view" data-field="x_PaymentMethod" name="x_PaymentMethod" id="x_PaymentMethod" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($_payroll_net_schedule_view_search->PaymentMethod->getPlaceHolder()) ?>" value="<?php echo $_payroll_net_schedule_view_search->PaymentMethod->EditValue ?>"<?php echo $_payroll_net_schedule_view_search->PaymentMethod->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_net_schedule_view_search->BankBranchCode->Visible) { // BankBranchCode ?>
	<div id="r_BankBranchCode" class="form-group row">
		<label for="x_BankBranchCode" class="<?php echo $_payroll_net_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_net_schedule_view_BankBranchCode"><?php echo $_payroll_net_schedule_view_search->BankBranchCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_BankBranchCode" id="z_BankBranchCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_payroll_net_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_net_schedule_view_search->BankBranchCode->cellAttributes() ?>>
			<span id="el__payroll_net_schedule_view_BankBranchCode" class="ew-search-field">
<input type="text" data-table="_payroll_net_schedule_view" data-field="x_BankBranchCode" name="x_BankBranchCode" id="x_BankBranchCode" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($_payroll_net_schedule_view_search->BankBranchCode->getPlaceHolder()) ?>" value="<?php echo $_payroll_net_schedule_view_search->BankBranchCode->EditValue ?>"<?php echo $_payroll_net_schedule_view_search->BankBranchCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_net_schedule_view_search->BankAccountNo->Visible) { // BankAccountNo ?>
	<div id="r_BankAccountNo" class="form-group row">
		<label for="x_BankAccountNo" class="<?php echo $_payroll_net_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_net_schedule_view_BankAccountNo"><?php echo $_payroll_net_schedule_view_search->BankAccountNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_BankAccountNo" id="z_BankAccountNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_payroll_net_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_net_schedule_view_search->BankAccountNo->cellAttributes() ?>>
			<span id="el__payroll_net_schedule_view_BankAccountNo" class="ew-search-field">
<input type="text" data-table="_payroll_net_schedule_view" data-field="x_BankAccountNo" name="x_BankAccountNo" id="x_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($_payroll_net_schedule_view_search->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $_payroll_net_schedule_view_search->BankAccountNo->EditValue ?>"<?php echo $_payroll_net_schedule_view_search->BankAccountNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_net_schedule_view_search->Division->Visible) { // Division ?>
	<div id="r_Division" class="form-group row">
		<label for="x_Division" class="<?php echo $_payroll_net_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_net_schedule_view_Division"><?php echo $_payroll_net_schedule_view_search->Division->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Division" id="z_Division" value="=">
</span>
		</label>
		<div class="<?php echo $_payroll_net_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_net_schedule_view_search->Division->cellAttributes() ?>>
			<span id="el__payroll_net_schedule_view_Division" class="ew-search-field">
<input type="text" data-table="_payroll_net_schedule_view" data-field="x_Division" name="x_Division" id="x_Division" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($_payroll_net_schedule_view_search->Division->getPlaceHolder()) ?>" value="<?php echo $_payroll_net_schedule_view_search->Division->EditValue ?>"<?php echo $_payroll_net_schedule_view_search->Division->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_net_schedule_view_search->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label for="x_EmployeeID" class="<?php echo $_payroll_net_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_net_schedule_view_EmployeeID"><?php echo $_payroll_net_schedule_view_search->EmployeeID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		</label>
		<div class="<?php echo $_payroll_net_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_net_schedule_view_search->EmployeeID->cellAttributes() ?>>
			<span id="el__payroll_net_schedule_view_EmployeeID" class="ew-search-field">
<input type="text" data-table="_payroll_net_schedule_view" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($_payroll_net_schedule_view_search->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $_payroll_net_schedule_view_search->EmployeeID->EditValue ?>"<?php echo $_payroll_net_schedule_view_search->EmployeeID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$_payroll_net_schedule_view_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $_payroll_net_schedule_view_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$_payroll_net_schedule_view_search->showPageFooter();
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
$_payroll_net_schedule_view_search->terminate();
?>