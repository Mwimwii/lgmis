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
$payroll_summary_view_search = new payroll_summary_view_search();

// Run the page
$payroll_summary_view_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payroll_summary_view_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpayroll_summary_viewsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($payroll_summary_view_search->IsModal) { ?>
	fpayroll_summary_viewsearch = currentAdvancedSearchForm = new ew.Form("fpayroll_summary_viewsearch", "search");
	<?php } else { ?>
	fpayroll_summary_viewsearch = currentForm = new ew.Form("fpayroll_summary_viewsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fpayroll_summary_viewsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payroll_summary_view_search->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Amount");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payroll_summary_view_search->Amount->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Division");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payroll_summary_view_search->Division->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fpayroll_summary_viewsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpayroll_summary_viewsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpayroll_summary_viewsearch.lists["x_LocalAuthority"] = <?php echo $payroll_summary_view_search->LocalAuthority->Lookup->toClientList($payroll_summary_view_search) ?>;
	fpayroll_summary_viewsearch.lists["x_LocalAuthority"].options = <?php echo JsonEncode($payroll_summary_view_search->LocalAuthority->lookupOptions()) ?>;
	fpayroll_summary_viewsearch.lists["x_PayrollPeriod"] = <?php echo $payroll_summary_view_search->PayrollPeriod->Lookup->toClientList($payroll_summary_view_search) ?>;
	fpayroll_summary_viewsearch.lists["x_PayrollPeriod"].options = <?php echo JsonEncode($payroll_summary_view_search->PayrollPeriod->lookupOptions()) ?>;
	loadjs.done("fpayroll_summary_viewsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $payroll_summary_view_search->showPageHeader(); ?>
<?php
$payroll_summary_view_search->showMessage();
?>
<form name="fpayroll_summary_viewsearch" id="fpayroll_summary_viewsearch" class="<?php echo $payroll_summary_view_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payroll_summary_view">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$payroll_summary_view_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($payroll_summary_view_search->LocalAuthority->Visible) { // LocalAuthority ?>
	<div id="r_LocalAuthority" class="form-group row">
		<label for="x_LocalAuthority" class="<?php echo $payroll_summary_view_search->LeftColumnClass ?>"><span id="elh_payroll_summary_view_LocalAuthority"><?php echo $payroll_summary_view_search->LocalAuthority->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LocalAuthority" id="z_LocalAuthority" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payroll_summary_view_search->RightColumnClass ?>"><div <?php echo $payroll_summary_view_search->LocalAuthority->cellAttributes() ?>>
			<span id="el_payroll_summary_view_LocalAuthority" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LocalAuthority"><?php echo EmptyValue(strval($payroll_summary_view_search->LocalAuthority->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $payroll_summary_view_search->LocalAuthority->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($payroll_summary_view_search->LocalAuthority->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($payroll_summary_view_search->LocalAuthority->ReadOnly || $payroll_summary_view_search->LocalAuthority->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LocalAuthority',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $payroll_summary_view_search->LocalAuthority->Lookup->getParamTag($payroll_summary_view_search, "p_x_LocalAuthority") ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_LocalAuthority" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $payroll_summary_view_search->LocalAuthority->displayValueSeparatorAttribute() ?>" name="x_LocalAuthority" id="x_LocalAuthority" value="<?php echo $payroll_summary_view_search->LocalAuthority->AdvancedSearch->SearchValue ?>"<?php echo $payroll_summary_view_search->LocalAuthority->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_summary_view_search->DepartmentName->Visible) { // DepartmentName ?>
	<div id="r_DepartmentName" class="form-group row">
		<label for="x_DepartmentName" class="<?php echo $payroll_summary_view_search->LeftColumnClass ?>"><span id="elh_payroll_summary_view_DepartmentName"><?php echo $payroll_summary_view_search->DepartmentName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DepartmentName" id="z_DepartmentName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payroll_summary_view_search->RightColumnClass ?>"><div <?php echo $payroll_summary_view_search->DepartmentName->cellAttributes() ?>>
			<span id="el_payroll_summary_view_DepartmentName" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_DepartmentName" name="x_DepartmentName" id="x_DepartmentName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payroll_summary_view_search->DepartmentName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_search->DepartmentName->EditValue ?>"<?php echo $payroll_summary_view_search->DepartmentName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_summary_view_search->SectionName->Visible) { // SectionName ?>
	<div id="r_SectionName" class="form-group row">
		<label for="x_SectionName" class="<?php echo $payroll_summary_view_search->LeftColumnClass ?>"><span id="elh_payroll_summary_view_SectionName"><?php echo $payroll_summary_view_search->SectionName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SectionName" id="z_SectionName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payroll_summary_view_search->RightColumnClass ?>"><div <?php echo $payroll_summary_view_search->SectionName->cellAttributes() ?>>
			<span id="el_payroll_summary_view_SectionName" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_SectionName" name="x_SectionName" id="x_SectionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payroll_summary_view_search->SectionName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_search->SectionName->EditValue ?>"<?php echo $payroll_summary_view_search->SectionName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_summary_view_search->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label for="x_EmployeeID" class="<?php echo $payroll_summary_view_search->LeftColumnClass ?>"><span id="elh_payroll_summary_view_EmployeeID"><?php echo $payroll_summary_view_search->EmployeeID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		</label>
		<div class="<?php echo $payroll_summary_view_search->RightColumnClass ?>"><div <?php echo $payroll_summary_view_search->EmployeeID->cellAttributes() ?>>
			<span id="el_payroll_summary_view_EmployeeID" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($payroll_summary_view_search->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_search->EmployeeID->EditValue ?>"<?php echo $payroll_summary_view_search->EmployeeID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_summary_view_search->Title->Visible) { // Title ?>
	<div id="r_Title" class="form-group row">
		<label for="x_Title" class="<?php echo $payroll_summary_view_search->LeftColumnClass ?>"><span id="elh_payroll_summary_view_Title"><?php echo $payroll_summary_view_search->Title->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Title" id="z_Title" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payroll_summary_view_search->RightColumnClass ?>"><div <?php echo $payroll_summary_view_search->Title->cellAttributes() ?>>
			<span id="el_payroll_summary_view_Title" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_Title" name="x_Title" id="x_Title" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($payroll_summary_view_search->Title->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_search->Title->EditValue ?>"<?php echo $payroll_summary_view_search->Title->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_summary_view_search->Surname->Visible) { // Surname ?>
	<div id="r_Surname" class="form-group row">
		<label for="x_Surname" class="<?php echo $payroll_summary_view_search->LeftColumnClass ?>"><span id="elh_payroll_summary_view_Surname"><?php echo $payroll_summary_view_search->Surname->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Surname" id="z_Surname" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payroll_summary_view_search->RightColumnClass ?>"><div <?php echo $payroll_summary_view_search->Surname->cellAttributes() ?>>
			<span id="el_payroll_summary_view_Surname" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_Surname" name="x_Surname" id="x_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($payroll_summary_view_search->Surname->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_search->Surname->EditValue ?>"<?php echo $payroll_summary_view_search->Surname->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_summary_view_search->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label for="x_FirstName" class="<?php echo $payroll_summary_view_search->LeftColumnClass ?>"><span id="elh_payroll_summary_view_FirstName"><?php echo $payroll_summary_view_search->FirstName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_FirstName" id="z_FirstName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payroll_summary_view_search->RightColumnClass ?>"><div <?php echo $payroll_summary_view_search->FirstName->cellAttributes() ?>>
			<span id="el_payroll_summary_view_FirstName" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($payroll_summary_view_search->FirstName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_search->FirstName->EditValue ?>"<?php echo $payroll_summary_view_search->FirstName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_summary_view_search->MiddleName->Visible) { // MiddleName ?>
	<div id="r_MiddleName" class="form-group row">
		<label for="x_MiddleName" class="<?php echo $payroll_summary_view_search->LeftColumnClass ?>"><span id="elh_payroll_summary_view_MiddleName"><?php echo $payroll_summary_view_search->MiddleName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_MiddleName" id="z_MiddleName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payroll_summary_view_search->RightColumnClass ?>"><div <?php echo $payroll_summary_view_search->MiddleName->cellAttributes() ?>>
			<span id="el_payroll_summary_view_MiddleName" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_MiddleName" name="x_MiddleName" id="x_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($payroll_summary_view_search->MiddleName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_search->MiddleName->EditValue ?>"<?php echo $payroll_summary_view_search->MiddleName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_summary_view_search->Sex->Visible) { // Sex ?>
	<div id="r_Sex" class="form-group row">
		<label for="x_Sex" class="<?php echo $payroll_summary_view_search->LeftColumnClass ?>"><span id="elh_payroll_summary_view_Sex"><?php echo $payroll_summary_view_search->Sex->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Sex" id="z_Sex" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payroll_summary_view_search->RightColumnClass ?>"><div <?php echo $payroll_summary_view_search->Sex->cellAttributes() ?>>
			<span id="el_payroll_summary_view_Sex" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_Sex" name="x_Sex" id="x_Sex" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($payroll_summary_view_search->Sex->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_search->Sex->EditValue ?>"<?php echo $payroll_summary_view_search->Sex->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_summary_view_search->NRC->Visible) { // NRC ?>
	<div id="r_NRC" class="form-group row">
		<label for="x_NRC" class="<?php echo $payroll_summary_view_search->LeftColumnClass ?>"><span id="elh_payroll_summary_view_NRC"><?php echo $payroll_summary_view_search->NRC->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_NRC" id="z_NRC" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payroll_summary_view_search->RightColumnClass ?>"><div <?php echo $payroll_summary_view_search->NRC->cellAttributes() ?>>
			<span id="el_payroll_summary_view_NRC" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_NRC" name="x_NRC" id="x_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($payroll_summary_view_search->NRC->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_search->NRC->EditValue ?>"<?php echo $payroll_summary_view_search->NRC->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_summary_view_search->PositionName->Visible) { // PositionName ?>
	<div id="r_PositionName" class="form-group row">
		<label for="x_PositionName" class="<?php echo $payroll_summary_view_search->LeftColumnClass ?>"><span id="elh_payroll_summary_view_PositionName"><?php echo $payroll_summary_view_search->PositionName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PositionName" id="z_PositionName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payroll_summary_view_search->RightColumnClass ?>"><div <?php echo $payroll_summary_view_search->PositionName->cellAttributes() ?>>
			<span id="el_payroll_summary_view_PositionName" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_PositionName" name="x_PositionName" id="x_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payroll_summary_view_search->PositionName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_search->PositionName->EditValue ?>"<?php echo $payroll_summary_view_search->PositionName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_summary_view_search->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<div id="r_PayrollPeriod" class="form-group row">
		<label for="x_PayrollPeriod" class="<?php echo $payroll_summary_view_search->LeftColumnClass ?>"><span id="elh_payroll_summary_view_PayrollPeriod"><?php echo $payroll_summary_view_search->PayrollPeriod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PayrollPeriod" id="z_PayrollPeriod" value="=">
</span>
		</label>
		<div class="<?php echo $payroll_summary_view_search->RightColumnClass ?>"><div <?php echo $payroll_summary_view_search->PayrollPeriod->cellAttributes() ?>>
			<span id="el_payroll_summary_view_PayrollPeriod" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="payroll_summary_view" data-field="x_PayrollPeriod" data-value-separator="<?php echo $payroll_summary_view_search->PayrollPeriod->displayValueSeparatorAttribute() ?>" id="x_PayrollPeriod" name="x_PayrollPeriod"<?php echo $payroll_summary_view_search->PayrollPeriod->editAttributes() ?>>
			<?php echo $payroll_summary_view_search->PayrollPeriod->selectOptionListHtml("x_PayrollPeriod") ?>
		</select>
</div>
<?php echo $payroll_summary_view_search->PayrollPeriod->Lookup->getParamTag($payroll_summary_view_search, "p_x_PayrollPeriod") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_summary_view_search->pCode->Visible) { // pCode ?>
	<div id="r_pCode" class="form-group row">
		<label for="x_pCode" class="<?php echo $payroll_summary_view_search->LeftColumnClass ?>"><span id="elh_payroll_summary_view_pCode"><?php echo $payroll_summary_view_search->pCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_pCode" id="z_pCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payroll_summary_view_search->RightColumnClass ?>"><div <?php echo $payroll_summary_view_search->pCode->cellAttributes() ?>>
			<span id="el_payroll_summary_view_pCode" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_pCode" name="x_pCode" id="x_pCode" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($payroll_summary_view_search->pCode->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_search->pCode->EditValue ?>"<?php echo $payroll_summary_view_search->pCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_summary_view_search->pName->Visible) { // pName ?>
	<div id="r_pName" class="form-group row">
		<label for="x_pName" class="<?php echo $payroll_summary_view_search->LeftColumnClass ?>"><span id="elh_payroll_summary_view_pName"><?php echo $payroll_summary_view_search->pName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_pName" id="z_pName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payroll_summary_view_search->RightColumnClass ?>"><div <?php echo $payroll_summary_view_search->pName->cellAttributes() ?>>
			<span id="el_payroll_summary_view_pName" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_pName" name="x_pName" id="x_pName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payroll_summary_view_search->pName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_search->pName->EditValue ?>"<?php echo $payroll_summary_view_search->pName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_summary_view_search->Amount->Visible) { // Amount ?>
	<div id="r_Amount" class="form-group row">
		<label for="x_Amount" class="<?php echo $payroll_summary_view_search->LeftColumnClass ?>"><span id="elh_payroll_summary_view_Amount"><?php echo $payroll_summary_view_search->Amount->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Amount" id="z_Amount" value="=">
</span>
		</label>
		<div class="<?php echo $payroll_summary_view_search->RightColumnClass ?>"><div <?php echo $payroll_summary_view_search->Amount->cellAttributes() ?>>
			<span id="el_payroll_summary_view_Amount" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_Amount" name="x_Amount" id="x_Amount" size="30" placeholder="<?php echo HtmlEncode($payroll_summary_view_search->Amount->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_search->Amount->EditValue ?>"<?php echo $payroll_summary_view_search->Amount->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_summary_view_search->PayPeriod->Visible) { // PayPeriod ?>
	<div id="r_PayPeriod" class="form-group row">
		<label for="x_PayPeriod" class="<?php echo $payroll_summary_view_search->LeftColumnClass ?>"><span id="elh_payroll_summary_view_PayPeriod"><?php echo $payroll_summary_view_search->PayPeriod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PayPeriod" id="z_PayPeriod" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payroll_summary_view_search->RightColumnClass ?>"><div <?php echo $payroll_summary_view_search->PayPeriod->cellAttributes() ?>>
			<span id="el_payroll_summary_view_PayPeriod" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_PayPeriod" name="x_PayPeriod" id="x_PayPeriod" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($payroll_summary_view_search->PayPeriod->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_search->PayPeriod->EditValue ?>"<?php echo $payroll_summary_view_search->PayPeriod->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_summary_view_search->SalaryScale->Visible) { // SalaryScale ?>
	<div id="r_SalaryScale" class="form-group row">
		<label for="x_SalaryScale" class="<?php echo $payroll_summary_view_search->LeftColumnClass ?>"><span id="elh_payroll_summary_view_SalaryScale"><?php echo $payroll_summary_view_search->SalaryScale->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SalaryScale" id="z_SalaryScale" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payroll_summary_view_search->RightColumnClass ?>"><div <?php echo $payroll_summary_view_search->SalaryScale->cellAttributes() ?>>
			<span id="el_payroll_summary_view_SalaryScale" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_SalaryScale" name="x_SalaryScale" id="x_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($payroll_summary_view_search->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_search->SalaryScale->EditValue ?>"<?php echo $payroll_summary_view_search->SalaryScale->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_summary_view_search->Division->Visible) { // Division ?>
	<div id="r_Division" class="form-group row">
		<label for="x_Division" class="<?php echo $payroll_summary_view_search->LeftColumnClass ?>"><span id="elh_payroll_summary_view_Division"><?php echo $payroll_summary_view_search->Division->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Division" id="z_Division" value="=">
</span>
		</label>
		<div class="<?php echo $payroll_summary_view_search->RightColumnClass ?>"><div <?php echo $payroll_summary_view_search->Division->cellAttributes() ?>>
			<span id="el_payroll_summary_view_Division" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_Division" name="x_Division" id="x_Division" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($payroll_summary_view_search->Division->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_search->Division->EditValue ?>"<?php echo $payroll_summary_view_search->Division->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_summary_view_search->PaymentMethod->Visible) { // PaymentMethod ?>
	<div id="r_PaymentMethod" class="form-group row">
		<label for="x_PaymentMethod" class="<?php echo $payroll_summary_view_search->LeftColumnClass ?>"><span id="elh_payroll_summary_view_PaymentMethod"><?php echo $payroll_summary_view_search->PaymentMethod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PaymentMethod" id="z_PaymentMethod" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payroll_summary_view_search->RightColumnClass ?>"><div <?php echo $payroll_summary_view_search->PaymentMethod->cellAttributes() ?>>
			<span id="el_payroll_summary_view_PaymentMethod" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_PaymentMethod" name="x_PaymentMethod" id="x_PaymentMethod" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($payroll_summary_view_search->PaymentMethod->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_search->PaymentMethod->EditValue ?>"<?php echo $payroll_summary_view_search->PaymentMethod->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_summary_view_search->BankBranchCode->Visible) { // BankBranchCode ?>
	<div id="r_BankBranchCode" class="form-group row">
		<label for="x_BankBranchCode" class="<?php echo $payroll_summary_view_search->LeftColumnClass ?>"><span id="elh_payroll_summary_view_BankBranchCode"><?php echo $payroll_summary_view_search->BankBranchCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_BankBranchCode" id="z_BankBranchCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payroll_summary_view_search->RightColumnClass ?>"><div <?php echo $payroll_summary_view_search->BankBranchCode->cellAttributes() ?>>
			<span id="el_payroll_summary_view_BankBranchCode" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_BankBranchCode" name="x_BankBranchCode" id="x_BankBranchCode" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($payroll_summary_view_search->BankBranchCode->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_search->BankBranchCode->EditValue ?>"<?php echo $payroll_summary_view_search->BankBranchCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_summary_view_search->BankAccountNo->Visible) { // BankAccountNo ?>
	<div id="r_BankAccountNo" class="form-group row">
		<label for="x_BankAccountNo" class="<?php echo $payroll_summary_view_search->LeftColumnClass ?>"><span id="elh_payroll_summary_view_BankAccountNo"><?php echo $payroll_summary_view_search->BankAccountNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_BankAccountNo" id="z_BankAccountNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payroll_summary_view_search->RightColumnClass ?>"><div <?php echo $payroll_summary_view_search->BankAccountNo->cellAttributes() ?>>
			<span id="el_payroll_summary_view_BankAccountNo" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_BankAccountNo" name="x_BankAccountNo" id="x_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($payroll_summary_view_search->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_search->BankAccountNo->EditValue ?>"<?php echo $payroll_summary_view_search->BankAccountNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$payroll_summary_view_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $payroll_summary_view_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$payroll_summary_view_search->showPageFooter();
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
$payroll_summary_view_search->terminate();
?>