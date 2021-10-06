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
$_napsa_view_search = new _napsa_view_search();

// Run the page
$_napsa_view_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_napsa_view_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var f_napsa_viewsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($_napsa_view_search->IsModal) { ?>
	f_napsa_viewsearch = currentAdvancedSearchForm = new ew.Form("f_napsa_viewsearch", "search");
	<?php } else { ?>
	f_napsa_viewsearch = currentForm = new ew.Form("f_napsa_viewsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	f_napsa_viewsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_napsa_view_search->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PayrollPeriod");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_napsa_view_search->PayrollPeriod->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Year");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_napsa_view_search->Year->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_GrossPay");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_napsa_view_search->GrossPay->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_EmployeeContribution");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_napsa_view_search->EmployeeContribution->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_EmployerContribution");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_napsa_view_search->EmployerContribution->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DateOfBirth");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_napsa_view_search->DateOfBirth->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	f_napsa_viewsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	f_napsa_viewsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("f_napsa_viewsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $_napsa_view_search->showPageHeader(); ?>
<?php
$_napsa_view_search->showMessage();
?>
<form name="f_napsa_viewsearch" id="f_napsa_viewsearch" class="<?php echo $_napsa_view_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_napsa_view">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$_napsa_view_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($_napsa_view_search->LocalAuthority->Visible) { // LocalAuthority ?>
	<div id="r_LocalAuthority" class="form-group row">
		<label for="x_LocalAuthority" class="<?php echo $_napsa_view_search->LeftColumnClass ?>"><span id="elh__napsa_view_LocalAuthority"><?php echo $_napsa_view_search->LocalAuthority->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LocalAuthority" id="z_LocalAuthority" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_napsa_view_search->RightColumnClass ?>"><div <?php echo $_napsa_view_search->LocalAuthority->cellAttributes() ?>>
			<span id="el__napsa_view_LocalAuthority" class="ew-search-field">
<input type="text" data-table="_napsa_view" data-field="x_LocalAuthority" name="x_LocalAuthority" id="x_LocalAuthority" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($_napsa_view_search->LocalAuthority->getPlaceHolder()) ?>" value="<?php echo $_napsa_view_search->LocalAuthority->EditValue ?>"<?php echo $_napsa_view_search->LocalAuthority->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_napsa_view_search->DepartmentName->Visible) { // DepartmentName ?>
	<div id="r_DepartmentName" class="form-group row">
		<label for="x_DepartmentName" class="<?php echo $_napsa_view_search->LeftColumnClass ?>"><span id="elh__napsa_view_DepartmentName"><?php echo $_napsa_view_search->DepartmentName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DepartmentName" id="z_DepartmentName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_napsa_view_search->RightColumnClass ?>"><div <?php echo $_napsa_view_search->DepartmentName->cellAttributes() ?>>
			<span id="el__napsa_view_DepartmentName" class="ew-search-field">
<input type="text" data-table="_napsa_view" data-field="x_DepartmentName" name="x_DepartmentName" id="x_DepartmentName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_napsa_view_search->DepartmentName->getPlaceHolder()) ?>" value="<?php echo $_napsa_view_search->DepartmentName->EditValue ?>"<?php echo $_napsa_view_search->DepartmentName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_napsa_view_search->SectionName->Visible) { // SectionName ?>
	<div id="r_SectionName" class="form-group row">
		<label for="x_SectionName" class="<?php echo $_napsa_view_search->LeftColumnClass ?>"><span id="elh__napsa_view_SectionName"><?php echo $_napsa_view_search->SectionName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SectionName" id="z_SectionName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_napsa_view_search->RightColumnClass ?>"><div <?php echo $_napsa_view_search->SectionName->cellAttributes() ?>>
			<span id="el__napsa_view_SectionName" class="ew-search-field">
<input type="text" data-table="_napsa_view" data-field="x_SectionName" name="x_SectionName" id="x_SectionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_napsa_view_search->SectionName->getPlaceHolder()) ?>" value="<?php echo $_napsa_view_search->SectionName->EditValue ?>"<?php echo $_napsa_view_search->SectionName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_napsa_view_search->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label for="x_EmployeeID" class="<?php echo $_napsa_view_search->LeftColumnClass ?>"><span id="elh__napsa_view_EmployeeID"><?php echo $_napsa_view_search->EmployeeID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		</label>
		<div class="<?php echo $_napsa_view_search->RightColumnClass ?>"><div <?php echo $_napsa_view_search->EmployeeID->cellAttributes() ?>>
			<span id="el__napsa_view_EmployeeID" class="ew-search-field">
<input type="text" data-table="_napsa_view" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($_napsa_view_search->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $_napsa_view_search->EmployeeID->EditValue ?>"<?php echo $_napsa_view_search->EmployeeID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_napsa_view_search->Surname->Visible) { // Surname ?>
	<div id="r_Surname" class="form-group row">
		<label for="x_Surname" class="<?php echo $_napsa_view_search->LeftColumnClass ?>"><span id="elh__napsa_view_Surname"><?php echo $_napsa_view_search->Surname->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Surname" id="z_Surname" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_napsa_view_search->RightColumnClass ?>"><div <?php echo $_napsa_view_search->Surname->cellAttributes() ?>>
			<span id="el__napsa_view_Surname" class="ew-search-field">
<input type="text" data-table="_napsa_view" data-field="x_Surname" name="x_Surname" id="x_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($_napsa_view_search->Surname->getPlaceHolder()) ?>" value="<?php echo $_napsa_view_search->Surname->EditValue ?>"<?php echo $_napsa_view_search->Surname->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_napsa_view_search->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label for="x_FirstName" class="<?php echo $_napsa_view_search->LeftColumnClass ?>"><span id="elh__napsa_view_FirstName"><?php echo $_napsa_view_search->FirstName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_FirstName" id="z_FirstName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_napsa_view_search->RightColumnClass ?>"><div <?php echo $_napsa_view_search->FirstName->cellAttributes() ?>>
			<span id="el__napsa_view_FirstName" class="ew-search-field">
<input type="text" data-table="_napsa_view" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($_napsa_view_search->FirstName->getPlaceHolder()) ?>" value="<?php echo $_napsa_view_search->FirstName->EditValue ?>"<?php echo $_napsa_view_search->FirstName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_napsa_view_search->MiddleName->Visible) { // MiddleName ?>
	<div id="r_MiddleName" class="form-group row">
		<label for="x_MiddleName" class="<?php echo $_napsa_view_search->LeftColumnClass ?>"><span id="elh__napsa_view_MiddleName"><?php echo $_napsa_view_search->MiddleName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_MiddleName" id="z_MiddleName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_napsa_view_search->RightColumnClass ?>"><div <?php echo $_napsa_view_search->MiddleName->cellAttributes() ?>>
			<span id="el__napsa_view_MiddleName" class="ew-search-field">
<input type="text" data-table="_napsa_view" data-field="x_MiddleName" name="x_MiddleName" id="x_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($_napsa_view_search->MiddleName->getPlaceHolder()) ?>" value="<?php echo $_napsa_view_search->MiddleName->EditValue ?>"<?php echo $_napsa_view_search->MiddleName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_napsa_view_search->NRC->Visible) { // NRC ?>
	<div id="r_NRC" class="form-group row">
		<label for="x_NRC" class="<?php echo $_napsa_view_search->LeftColumnClass ?>"><span id="elh__napsa_view_NRC"><?php echo $_napsa_view_search->NRC->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_NRC" id="z_NRC" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_napsa_view_search->RightColumnClass ?>"><div <?php echo $_napsa_view_search->NRC->cellAttributes() ?>>
			<span id="el__napsa_view_NRC" class="ew-search-field">
<input type="text" data-table="_napsa_view" data-field="x_NRC" name="x_NRC" id="x_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($_napsa_view_search->NRC->getPlaceHolder()) ?>" value="<?php echo $_napsa_view_search->NRC->EditValue ?>"<?php echo $_napsa_view_search->NRC->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_napsa_view_search->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
	<div id="r_SocialSecurityNo" class="form-group row">
		<label for="x_SocialSecurityNo" class="<?php echo $_napsa_view_search->LeftColumnClass ?>"><span id="elh__napsa_view_SocialSecurityNo"><?php echo $_napsa_view_search->SocialSecurityNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SocialSecurityNo" id="z_SocialSecurityNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_napsa_view_search->RightColumnClass ?>"><div <?php echo $_napsa_view_search->SocialSecurityNo->cellAttributes() ?>>
			<span id="el__napsa_view_SocialSecurityNo" class="ew-search-field">
<input type="text" data-table="_napsa_view" data-field="x_SocialSecurityNo" name="x_SocialSecurityNo" id="x_SocialSecurityNo" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($_napsa_view_search->SocialSecurityNo->getPlaceHolder()) ?>" value="<?php echo $_napsa_view_search->SocialSecurityNo->EditValue ?>"<?php echo $_napsa_view_search->SocialSecurityNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_napsa_view_search->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<div id="r_PayrollPeriod" class="form-group row">
		<label for="x_PayrollPeriod" class="<?php echo $_napsa_view_search->LeftColumnClass ?>"><span id="elh__napsa_view_PayrollPeriod"><?php echo $_napsa_view_search->PayrollPeriod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PayrollPeriod" id="z_PayrollPeriod" value="=">
</span>
		</label>
		<div class="<?php echo $_napsa_view_search->RightColumnClass ?>"><div <?php echo $_napsa_view_search->PayrollPeriod->cellAttributes() ?>>
			<span id="el__napsa_view_PayrollPeriod" class="ew-search-field">
<input type="text" data-table="_napsa_view" data-field="x_PayrollPeriod" name="x_PayrollPeriod" id="x_PayrollPeriod" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($_napsa_view_search->PayrollPeriod->getPlaceHolder()) ?>" value="<?php echo $_napsa_view_search->PayrollPeriod->EditValue ?>"<?php echo $_napsa_view_search->PayrollPeriod->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_napsa_view_search->MonthShort->Visible) { // MonthShort ?>
	<div id="r_MonthShort" class="form-group row">
		<label for="x_MonthShort" class="<?php echo $_napsa_view_search->LeftColumnClass ?>"><span id="elh__napsa_view_MonthShort"><?php echo $_napsa_view_search->MonthShort->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_MonthShort" id="z_MonthShort" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_napsa_view_search->RightColumnClass ?>"><div <?php echo $_napsa_view_search->MonthShort->cellAttributes() ?>>
			<span id="el__napsa_view_MonthShort" class="ew-search-field">
<input type="text" data-table="_napsa_view" data-field="x_MonthShort" name="x_MonthShort" id="x_MonthShort" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($_napsa_view_search->MonthShort->getPlaceHolder()) ?>" value="<?php echo $_napsa_view_search->MonthShort->EditValue ?>"<?php echo $_napsa_view_search->MonthShort->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_napsa_view_search->Year->Visible) { // Year ?>
	<div id="r_Year" class="form-group row">
		<label for="x_Year" class="<?php echo $_napsa_view_search->LeftColumnClass ?>"><span id="elh__napsa_view_Year"><?php echo $_napsa_view_search->Year->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Year" id="z_Year" value="=">
</span>
		</label>
		<div class="<?php echo $_napsa_view_search->RightColumnClass ?>"><div <?php echo $_napsa_view_search->Year->cellAttributes() ?>>
			<span id="el__napsa_view_Year" class="ew-search-field">
<input type="text" data-table="_napsa_view" data-field="x_Year" name="x_Year" id="x_Year" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($_napsa_view_search->Year->getPlaceHolder()) ?>" value="<?php echo $_napsa_view_search->Year->EditValue ?>"<?php echo $_napsa_view_search->Year->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_napsa_view_search->pName->Visible) { // pName ?>
	<div id="r_pName" class="form-group row">
		<label for="x_pName" class="<?php echo $_napsa_view_search->LeftColumnClass ?>"><span id="elh__napsa_view_pName"><?php echo $_napsa_view_search->pName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_pName" id="z_pName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_napsa_view_search->RightColumnClass ?>"><div <?php echo $_napsa_view_search->pName->cellAttributes() ?>>
			<span id="el__napsa_view_pName" class="ew-search-field">
<input type="text" data-table="_napsa_view" data-field="x_pName" name="x_pName" id="x_pName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_napsa_view_search->pName->getPlaceHolder()) ?>" value="<?php echo $_napsa_view_search->pName->EditValue ?>"<?php echo $_napsa_view_search->pName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_napsa_view_search->GrossPay->Visible) { // GrossPay ?>
	<div id="r_GrossPay" class="form-group row">
		<label for="x_GrossPay" class="<?php echo $_napsa_view_search->LeftColumnClass ?>"><span id="elh__napsa_view_GrossPay"><?php echo $_napsa_view_search->GrossPay->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_GrossPay" id="z_GrossPay" value="=">
</span>
		</label>
		<div class="<?php echo $_napsa_view_search->RightColumnClass ?>"><div <?php echo $_napsa_view_search->GrossPay->cellAttributes() ?>>
			<span id="el__napsa_view_GrossPay" class="ew-search-field">
<input type="text" data-table="_napsa_view" data-field="x_GrossPay" name="x_GrossPay" id="x_GrossPay" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($_napsa_view_search->GrossPay->getPlaceHolder()) ?>" value="<?php echo $_napsa_view_search->GrossPay->EditValue ?>"<?php echo $_napsa_view_search->GrossPay->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_napsa_view_search->EmployeeContribution->Visible) { // EmployeeContribution ?>
	<div id="r_EmployeeContribution" class="form-group row">
		<label for="x_EmployeeContribution" class="<?php echo $_napsa_view_search->LeftColumnClass ?>"><span id="elh__napsa_view_EmployeeContribution"><?php echo $_napsa_view_search->EmployeeContribution->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeContribution" id="z_EmployeeContribution" value="=">
</span>
		</label>
		<div class="<?php echo $_napsa_view_search->RightColumnClass ?>"><div <?php echo $_napsa_view_search->EmployeeContribution->cellAttributes() ?>>
			<span id="el__napsa_view_EmployeeContribution" class="ew-search-field">
<input type="text" data-table="_napsa_view" data-field="x_EmployeeContribution" name="x_EmployeeContribution" id="x_EmployeeContribution" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($_napsa_view_search->EmployeeContribution->getPlaceHolder()) ?>" value="<?php echo $_napsa_view_search->EmployeeContribution->EditValue ?>"<?php echo $_napsa_view_search->EmployeeContribution->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_napsa_view_search->EmployerContribution->Visible) { // EmployerContribution ?>
	<div id="r_EmployerContribution" class="form-group row">
		<label for="x_EmployerContribution" class="<?php echo $_napsa_view_search->LeftColumnClass ?>"><span id="elh__napsa_view_EmployerContribution"><?php echo $_napsa_view_search->EmployerContribution->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployerContribution" id="z_EmployerContribution" value="=">
</span>
		</label>
		<div class="<?php echo $_napsa_view_search->RightColumnClass ?>"><div <?php echo $_napsa_view_search->EmployerContribution->cellAttributes() ?>>
			<span id="el__napsa_view_EmployerContribution" class="ew-search-field">
<input type="text" data-table="_napsa_view" data-field="x_EmployerContribution" name="x_EmployerContribution" id="x_EmployerContribution" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($_napsa_view_search->EmployerContribution->getPlaceHolder()) ?>" value="<?php echo $_napsa_view_search->EmployerContribution->EditValue ?>"<?php echo $_napsa_view_search->EmployerContribution->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_napsa_view_search->DateOfBirth->Visible) { // DateOfBirth ?>
	<div id="r_DateOfBirth" class="form-group row">
		<label for="x_DateOfBirth" class="<?php echo $_napsa_view_search->LeftColumnClass ?>"><span id="elh__napsa_view_DateOfBirth"><?php echo $_napsa_view_search->DateOfBirth->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DateOfBirth" id="z_DateOfBirth" value="=">
</span>
		</label>
		<div class="<?php echo $_napsa_view_search->RightColumnClass ?>"><div <?php echo $_napsa_view_search->DateOfBirth->cellAttributes() ?>>
			<span id="el__napsa_view_DateOfBirth" class="ew-search-field">
<input type="text" data-table="_napsa_view" data-field="x_DateOfBirth" name="x_DateOfBirth" id="x_DateOfBirth" maxlength="10" placeholder="<?php echo HtmlEncode($_napsa_view_search->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $_napsa_view_search->DateOfBirth->EditValue ?>"<?php echo $_napsa_view_search->DateOfBirth->editAttributes() ?>>
<?php if (!$_napsa_view_search->DateOfBirth->ReadOnly && !$_napsa_view_search->DateOfBirth->Disabled && !isset($_napsa_view_search->DateOfBirth->EditAttrs["readonly"]) && !isset($_napsa_view_search->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["f_napsa_viewsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("f_napsa_viewsearch", "x_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$_napsa_view_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $_napsa_view_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$_napsa_view_search->showPageFooter();
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
$_napsa_view_search->terminate();
?>