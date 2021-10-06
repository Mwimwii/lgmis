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
$_payroll_schedule_view_search = new _payroll_schedule_view_search();

// Run the page
$_payroll_schedule_view_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_payroll_schedule_view_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var f_payroll_schedule_viewsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($_payroll_schedule_view_search->IsModal) { ?>
	f_payroll_schedule_viewsearch = currentAdvancedSearchForm = new ew.Form("f_payroll_schedule_viewsearch", "search");
	<?php } else { ?>
	f_payroll_schedule_viewsearch = currentForm = new ew.Form("f_payroll_schedule_viewsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	f_payroll_schedule_viewsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_Amount");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_payroll_schedule_view_search->Amount->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	f_payroll_schedule_viewsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	f_payroll_schedule_viewsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	f_payroll_schedule_viewsearch.lists["x_LocalAuthority"] = <?php echo $_payroll_schedule_view_search->LocalAuthority->Lookup->toClientList($_payroll_schedule_view_search) ?>;
	f_payroll_schedule_viewsearch.lists["x_LocalAuthority"].options = <?php echo JsonEncode($_payroll_schedule_view_search->LocalAuthority->lookupOptions()) ?>;
	f_payroll_schedule_viewsearch.lists["x_PayrollPeriod"] = <?php echo $_payroll_schedule_view_search->PayrollPeriod->Lookup->toClientList($_payroll_schedule_view_search) ?>;
	f_payroll_schedule_viewsearch.lists["x_PayrollPeriod"].options = <?php echo JsonEncode($_payroll_schedule_view_search->PayrollPeriod->lookupOptions()) ?>;
	loadjs.done("f_payroll_schedule_viewsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $_payroll_schedule_view_search->showPageHeader(); ?>
<?php
$_payroll_schedule_view_search->showMessage();
?>
<form name="f_payroll_schedule_viewsearch" id="f_payroll_schedule_viewsearch" class="<?php echo $_payroll_schedule_view_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_payroll_schedule_view">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$_payroll_schedule_view_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($_payroll_schedule_view_search->LocalAuthority->Visible) { // LocalAuthority ?>
	<div id="r_LocalAuthority" class="form-group row">
		<label for="x_LocalAuthority" class="<?php echo $_payroll_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_schedule_view_LocalAuthority"><?php echo $_payroll_schedule_view_search->LocalAuthority->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LocalAuthority" id="z_LocalAuthority" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_payroll_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_schedule_view_search->LocalAuthority->cellAttributes() ?>>
			<span id="el__payroll_schedule_view_LocalAuthority" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LocalAuthority"><?php echo EmptyValue(strval($_payroll_schedule_view_search->LocalAuthority->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $_payroll_schedule_view_search->LocalAuthority->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_payroll_schedule_view_search->LocalAuthority->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($_payroll_schedule_view_search->LocalAuthority->ReadOnly || $_payroll_schedule_view_search->LocalAuthority->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LocalAuthority',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $_payroll_schedule_view_search->LocalAuthority->Lookup->getParamTag($_payroll_schedule_view_search, "p_x_LocalAuthority") ?>
<input type="hidden" data-table="_payroll_schedule_view" data-field="x_LocalAuthority" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_payroll_schedule_view_search->LocalAuthority->displayValueSeparatorAttribute() ?>" name="x_LocalAuthority" id="x_LocalAuthority" value="<?php echo $_payroll_schedule_view_search->LocalAuthority->AdvancedSearch->SearchValue ?>"<?php echo $_payroll_schedule_view_search->LocalAuthority->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_schedule_view_search->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<div id="r_PayrollPeriod" class="form-group row">
		<label for="x_PayrollPeriod" class="<?php echo $_payroll_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_schedule_view_PayrollPeriod"><?php echo $_payroll_schedule_view_search->PayrollPeriod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PayrollPeriod" id="z_PayrollPeriod" value="=">
</span>
		</label>
		<div class="<?php echo $_payroll_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_schedule_view_search->PayrollPeriod->cellAttributes() ?>>
			<span id="el__payroll_schedule_view_PayrollPeriod" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_PayrollPeriod"><?php echo EmptyValue(strval($_payroll_schedule_view_search->PayrollPeriod->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $_payroll_schedule_view_search->PayrollPeriod->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_payroll_schedule_view_search->PayrollPeriod->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($_payroll_schedule_view_search->PayrollPeriod->ReadOnly || $_payroll_schedule_view_search->PayrollPeriod->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_PayrollPeriod',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $_payroll_schedule_view_search->PayrollPeriod->Lookup->getParamTag($_payroll_schedule_view_search, "p_x_PayrollPeriod") ?>
<input type="hidden" data-table="_payroll_schedule_view" data-field="x_PayrollPeriod" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_payroll_schedule_view_search->PayrollPeriod->displayValueSeparatorAttribute() ?>" name="x_PayrollPeriod" id="x_PayrollPeriod" value="<?php echo $_payroll_schedule_view_search->PayrollPeriod->AdvancedSearch->SearchValue ?>"<?php echo $_payroll_schedule_view_search->PayrollPeriod->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_schedule_view_search->Title->Visible) { // Title ?>
	<div id="r_Title" class="form-group row">
		<label for="x_Title" class="<?php echo $_payroll_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_schedule_view_Title"><?php echo $_payroll_schedule_view_search->Title->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Title" id="z_Title" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_payroll_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_schedule_view_search->Title->cellAttributes() ?>>
			<span id="el__payroll_schedule_view_Title" class="ew-search-field">
<input type="text" data-table="_payroll_schedule_view" data-field="x_Title" name="x_Title" id="x_Title" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($_payroll_schedule_view_search->Title->getPlaceHolder()) ?>" value="<?php echo $_payroll_schedule_view_search->Title->EditValue ?>"<?php echo $_payroll_schedule_view_search->Title->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_schedule_view_search->Surname->Visible) { // Surname ?>
	<div id="r_Surname" class="form-group row">
		<label for="x_Surname" class="<?php echo $_payroll_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_schedule_view_Surname"><?php echo $_payroll_schedule_view_search->Surname->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Surname" id="z_Surname" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_payroll_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_schedule_view_search->Surname->cellAttributes() ?>>
			<span id="el__payroll_schedule_view_Surname" class="ew-search-field">
<input type="text" data-table="_payroll_schedule_view" data-field="x_Surname" name="x_Surname" id="x_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($_payroll_schedule_view_search->Surname->getPlaceHolder()) ?>" value="<?php echo $_payroll_schedule_view_search->Surname->EditValue ?>"<?php echo $_payroll_schedule_view_search->Surname->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_schedule_view_search->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label for="x_FirstName" class="<?php echo $_payroll_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_schedule_view_FirstName"><?php echo $_payroll_schedule_view_search->FirstName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_FirstName" id="z_FirstName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_payroll_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_schedule_view_search->FirstName->cellAttributes() ?>>
			<span id="el__payroll_schedule_view_FirstName" class="ew-search-field">
<input type="text" data-table="_payroll_schedule_view" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($_payroll_schedule_view_search->FirstName->getPlaceHolder()) ?>" value="<?php echo $_payroll_schedule_view_search->FirstName->EditValue ?>"<?php echo $_payroll_schedule_view_search->FirstName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_schedule_view_search->MiddleName->Visible) { // MiddleName ?>
	<div id="r_MiddleName" class="form-group row">
		<label for="x_MiddleName" class="<?php echo $_payroll_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_schedule_view_MiddleName"><?php echo $_payroll_schedule_view_search->MiddleName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_MiddleName" id="z_MiddleName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_payroll_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_schedule_view_search->MiddleName->cellAttributes() ?>>
			<span id="el__payroll_schedule_view_MiddleName" class="ew-search-field">
<input type="text" data-table="_payroll_schedule_view" data-field="x_MiddleName" name="x_MiddleName" id="x_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($_payroll_schedule_view_search->MiddleName->getPlaceHolder()) ?>" value="<?php echo $_payroll_schedule_view_search->MiddleName->EditValue ?>"<?php echo $_payroll_schedule_view_search->MiddleName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_schedule_view_search->PositionName->Visible) { // PositionName ?>
	<div id="r_PositionName" class="form-group row">
		<label for="x_PositionName" class="<?php echo $_payroll_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_schedule_view_PositionName"><?php echo $_payroll_schedule_view_search->PositionName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PositionName" id="z_PositionName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_payroll_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_schedule_view_search->PositionName->cellAttributes() ?>>
			<span id="el__payroll_schedule_view_PositionName" class="ew-search-field">
<input type="text" data-table="_payroll_schedule_view" data-field="x_PositionName" name="x_PositionName" id="x_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_payroll_schedule_view_search->PositionName->getPlaceHolder()) ?>" value="<?php echo $_payroll_schedule_view_search->PositionName->EditValue ?>"<?php echo $_payroll_schedule_view_search->PositionName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_schedule_view_search->pCode->Visible) { // pCode ?>
	<div id="r_pCode" class="form-group row">
		<label for="x_pCode" class="<?php echo $_payroll_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_schedule_view_pCode"><?php echo $_payroll_schedule_view_search->pCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_pCode" id="z_pCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_payroll_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_schedule_view_search->pCode->cellAttributes() ?>>
			<span id="el__payroll_schedule_view_pCode" class="ew-search-field">
<input type="text" data-table="_payroll_schedule_view" data-field="x_pCode" name="x_pCode" id="x_pCode" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($_payroll_schedule_view_search->pCode->getPlaceHolder()) ?>" value="<?php echo $_payroll_schedule_view_search->pCode->EditValue ?>"<?php echo $_payroll_schedule_view_search->pCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_schedule_view_search->pName->Visible) { // pName ?>
	<div id="r_pName" class="form-group row">
		<label for="x_pName" class="<?php echo $_payroll_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_schedule_view_pName"><?php echo $_payroll_schedule_view_search->pName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_pName" id="z_pName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_payroll_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_schedule_view_search->pName->cellAttributes() ?>>
			<span id="el__payroll_schedule_view_pName" class="ew-search-field">
<input type="text" data-table="_payroll_schedule_view" data-field="x_pName" name="x_pName" id="x_pName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_payroll_schedule_view_search->pName->getPlaceHolder()) ?>" value="<?php echo $_payroll_schedule_view_search->pName->EditValue ?>"<?php echo $_payroll_schedule_view_search->pName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_schedule_view_search->Amount->Visible) { // Amount ?>
	<div id="r_Amount" class="form-group row">
		<label for="x_Amount" class="<?php echo $_payroll_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_schedule_view_Amount"><?php echo $_payroll_schedule_view_search->Amount->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Amount" id="z_Amount" value="=">
</span>
		</label>
		<div class="<?php echo $_payroll_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_schedule_view_search->Amount->cellAttributes() ?>>
			<span id="el__payroll_schedule_view_Amount" class="ew-search-field">
<input type="text" data-table="_payroll_schedule_view" data-field="x_Amount" name="x_Amount" id="x_Amount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($_payroll_schedule_view_search->Amount->getPlaceHolder()) ?>" value="<?php echo $_payroll_schedule_view_search->Amount->EditValue ?>"<?php echo $_payroll_schedule_view_search->Amount->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_schedule_view_search->PaymentMethod->Visible) { // PaymentMethod ?>
	<div id="r_PaymentMethod" class="form-group row">
		<label for="x_PaymentMethod" class="<?php echo $_payroll_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_schedule_view_PaymentMethod"><?php echo $_payroll_schedule_view_search->PaymentMethod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PaymentMethod" id="z_PaymentMethod" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_payroll_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_schedule_view_search->PaymentMethod->cellAttributes() ?>>
			<span id="el__payroll_schedule_view_PaymentMethod" class="ew-search-field">
<input type="text" data-table="_payroll_schedule_view" data-field="x_PaymentMethod" name="x_PaymentMethod" id="x_PaymentMethod" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($_payroll_schedule_view_search->PaymentMethod->getPlaceHolder()) ?>" value="<?php echo $_payroll_schedule_view_search->PaymentMethod->EditValue ?>"<?php echo $_payroll_schedule_view_search->PaymentMethod->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_schedule_view_search->BankBranchCode->Visible) { // BankBranchCode ?>
	<div id="r_BankBranchCode" class="form-group row">
		<label for="x_BankBranchCode" class="<?php echo $_payroll_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_schedule_view_BankBranchCode"><?php echo $_payroll_schedule_view_search->BankBranchCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_BankBranchCode" id="z_BankBranchCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_payroll_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_schedule_view_search->BankBranchCode->cellAttributes() ?>>
			<span id="el__payroll_schedule_view_BankBranchCode" class="ew-search-field">
<input type="text" data-table="_payroll_schedule_view" data-field="x_BankBranchCode" name="x_BankBranchCode" id="x_BankBranchCode" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($_payroll_schedule_view_search->BankBranchCode->getPlaceHolder()) ?>" value="<?php echo $_payroll_schedule_view_search->BankBranchCode->EditValue ?>"<?php echo $_payroll_schedule_view_search->BankBranchCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_schedule_view_search->BankAccountNo->Visible) { // BankAccountNo ?>
	<div id="r_BankAccountNo" class="form-group row">
		<label for="x_BankAccountNo" class="<?php echo $_payroll_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_schedule_view_BankAccountNo"><?php echo $_payroll_schedule_view_search->BankAccountNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_BankAccountNo" id="z_BankAccountNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_payroll_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_schedule_view_search->BankAccountNo->cellAttributes() ?>>
			<span id="el__payroll_schedule_view_BankAccountNo" class="ew-search-field">
<input type="text" data-table="_payroll_schedule_view" data-field="x_BankAccountNo" name="x_BankAccountNo" id="x_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($_payroll_schedule_view_search->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $_payroll_schedule_view_search->BankAccountNo->EditValue ?>"<?php echo $_payroll_schedule_view_search->BankAccountNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_schedule_view_search->ThirdPartyPayMethod->Visible) { // ThirdPartyPayMethod ?>
	<div id="r_ThirdPartyPayMethod" class="form-group row">
		<label for="x_ThirdPartyPayMethod" class="<?php echo $_payroll_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_schedule_view_ThirdPartyPayMethod"><?php echo $_payroll_schedule_view_search->ThirdPartyPayMethod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ThirdPartyPayMethod" id="z_ThirdPartyPayMethod" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_payroll_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_schedule_view_search->ThirdPartyPayMethod->cellAttributes() ?>>
			<span id="el__payroll_schedule_view_ThirdPartyPayMethod" class="ew-search-field">
<input type="text" data-table="_payroll_schedule_view" data-field="x_ThirdPartyPayMethod" name="x_ThirdPartyPayMethod" id="x_ThirdPartyPayMethod" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($_payroll_schedule_view_search->ThirdPartyPayMethod->getPlaceHolder()) ?>" value="<?php echo $_payroll_schedule_view_search->ThirdPartyPayMethod->EditValue ?>"<?php echo $_payroll_schedule_view_search->ThirdPartyPayMethod->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_schedule_view_search->ThirdPartyBank->Visible) { // ThirdPartyBank ?>
	<div id="r_ThirdPartyBank" class="form-group row">
		<label for="x_ThirdPartyBank" class="<?php echo $_payroll_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_schedule_view_ThirdPartyBank"><?php echo $_payroll_schedule_view_search->ThirdPartyBank->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ThirdPartyBank" id="z_ThirdPartyBank" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_payroll_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_schedule_view_search->ThirdPartyBank->cellAttributes() ?>>
			<span id="el__payroll_schedule_view_ThirdPartyBank" class="ew-search-field">
<input type="text" data-table="_payroll_schedule_view" data-field="x_ThirdPartyBank" name="x_ThirdPartyBank" id="x_ThirdPartyBank" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($_payroll_schedule_view_search->ThirdPartyBank->getPlaceHolder()) ?>" value="<?php echo $_payroll_schedule_view_search->ThirdPartyBank->EditValue ?>"<?php echo $_payroll_schedule_view_search->ThirdPartyBank->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_payroll_schedule_view_search->ThirdPartyAccount->Visible) { // ThirdPartyAccount ?>
	<div id="r_ThirdPartyAccount" class="form-group row">
		<label for="x_ThirdPartyAccount" class="<?php echo $_payroll_schedule_view_search->LeftColumnClass ?>"><span id="elh__payroll_schedule_view_ThirdPartyAccount"><?php echo $_payroll_schedule_view_search->ThirdPartyAccount->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ThirdPartyAccount" id="z_ThirdPartyAccount" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_payroll_schedule_view_search->RightColumnClass ?>"><div <?php echo $_payroll_schedule_view_search->ThirdPartyAccount->cellAttributes() ?>>
			<span id="el__payroll_schedule_view_ThirdPartyAccount" class="ew-search-field">
<input type="text" data-table="_payroll_schedule_view" data-field="x_ThirdPartyAccount" name="x_ThirdPartyAccount" id="x_ThirdPartyAccount" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($_payroll_schedule_view_search->ThirdPartyAccount->getPlaceHolder()) ?>" value="<?php echo $_payroll_schedule_view_search->ThirdPartyAccount->EditValue ?>"<?php echo $_payroll_schedule_view_search->ThirdPartyAccount->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$_payroll_schedule_view_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $_payroll_schedule_view_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$_payroll_schedule_view_search->showPageFooter();
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
$_payroll_schedule_view_search->terminate();
?>