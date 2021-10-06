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
$employee_employer_schedule_view_search = new employee_employer_schedule_view_search();

// Run the page
$employee_employer_schedule_view_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_employer_schedule_view_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployee_employer_schedule_viewsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($employee_employer_schedule_view_search->IsModal) { ?>
	femployee_employer_schedule_viewsearch = currentAdvancedSearchForm = new ew.Form("femployee_employer_schedule_viewsearch", "search");
	<?php } else { ?>
	femployee_employer_schedule_viewsearch = currentForm = new ew.Form("femployee_employer_schedule_viewsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	femployee_employer_schedule_viewsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employee_employer_schedule_view_search->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PayrollDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employee_employer_schedule_view_search->PayrollDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DeductionAmount");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employee_employer_schedule_view_search->DeductionAmount->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ObligationAmount");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employee_employer_schedule_view_search->ObligationAmount->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	femployee_employer_schedule_viewsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployee_employer_schedule_viewsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femployee_employer_schedule_viewsearch.lists["x_PeriodCode"] = <?php echo $employee_employer_schedule_view_search->PeriodCode->Lookup->toClientList($employee_employer_schedule_view_search) ?>;
	femployee_employer_schedule_viewsearch.lists["x_PeriodCode"].options = <?php echo JsonEncode($employee_employer_schedule_view_search->PeriodCode->lookupOptions()) ?>;
	loadjs.done("femployee_employer_schedule_viewsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employee_employer_schedule_view_search->showPageHeader(); ?>
<?php
$employee_employer_schedule_view_search->showMessage();
?>
<form name="femployee_employer_schedule_viewsearch" id="femployee_employer_schedule_viewsearch" class="<?php echo $employee_employer_schedule_view_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employee_employer_schedule_view">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$employee_employer_schedule_view_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($employee_employer_schedule_view_search->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label for="x_EmployeeID" class="<?php echo $employee_employer_schedule_view_search->LeftColumnClass ?>"><span id="elh_employee_employer_schedule_view_EmployeeID"><?php echo $employee_employer_schedule_view_search->EmployeeID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		</label>
		<div class="<?php echo $employee_employer_schedule_view_search->RightColumnClass ?>"><div <?php echo $employee_employer_schedule_view_search->EmployeeID->cellAttributes() ?>>
			<span id="el_employee_employer_schedule_view_EmployeeID" class="ew-search-field">
<input type="text" data-table="employee_employer_schedule_view" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employee_employer_schedule_view_search->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employee_employer_schedule_view_search->EmployeeID->EditValue ?>"<?php echo $employee_employer_schedule_view_search->EmployeeID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_employer_schedule_view_search->PayrollDate->Visible) { // PayrollDate ?>
	<div id="r_PayrollDate" class="form-group row">
		<label for="x_PayrollDate" class="<?php echo $employee_employer_schedule_view_search->LeftColumnClass ?>"><span id="elh_employee_employer_schedule_view_PayrollDate"><?php echo $employee_employer_schedule_view_search->PayrollDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PayrollDate" id="z_PayrollDate" value="=">
</span>
		</label>
		<div class="<?php echo $employee_employer_schedule_view_search->RightColumnClass ?>"><div <?php echo $employee_employer_schedule_view_search->PayrollDate->cellAttributes() ?>>
			<span id="el_employee_employer_schedule_view_PayrollDate" class="ew-search-field">
<input type="text" data-table="employee_employer_schedule_view" data-field="x_PayrollDate" name="x_PayrollDate" id="x_PayrollDate" placeholder="<?php echo HtmlEncode($employee_employer_schedule_view_search->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $employee_employer_schedule_view_search->PayrollDate->EditValue ?>"<?php echo $employee_employer_schedule_view_search->PayrollDate->editAttributes() ?>>
<?php if (!$employee_employer_schedule_view_search->PayrollDate->ReadOnly && !$employee_employer_schedule_view_search->PayrollDate->Disabled && !isset($employee_employer_schedule_view_search->PayrollDate->EditAttrs["readonly"]) && !isset($employee_employer_schedule_view_search->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_employer_schedule_viewsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_employer_schedule_viewsearch", "x_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_employer_schedule_view_search->LAName->Visible) { // LAName ?>
	<div id="r_LAName" class="form-group row">
		<label for="x_LAName" class="<?php echo $employee_employer_schedule_view_search->LeftColumnClass ?>"><span id="elh_employee_employer_schedule_view_LAName"><?php echo $employee_employer_schedule_view_search->LAName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LAName" id="z_LAName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $employee_employer_schedule_view_search->RightColumnClass ?>"><div <?php echo $employee_employer_schedule_view_search->LAName->cellAttributes() ?>>
			<span id="el_employee_employer_schedule_view_LAName" class="ew-search-field">
<input type="text" data-table="employee_employer_schedule_view" data-field="x_LAName" name="x_LAName" id="x_LAName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($employee_employer_schedule_view_search->LAName->getPlaceHolder()) ?>" value="<?php echo $employee_employer_schedule_view_search->LAName->EditValue ?>"<?php echo $employee_employer_schedule_view_search->LAName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_employer_schedule_view_search->DeductionName->Visible) { // DeductionName ?>
	<div id="r_DeductionName" class="form-group row">
		<label for="x_DeductionName" class="<?php echo $employee_employer_schedule_view_search->LeftColumnClass ?>"><span id="elh_employee_employer_schedule_view_DeductionName"><?php echo $employee_employer_schedule_view_search->DeductionName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DeductionName" id="z_DeductionName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $employee_employer_schedule_view_search->RightColumnClass ?>"><div <?php echo $employee_employer_schedule_view_search->DeductionName->cellAttributes() ?>>
			<span id="el_employee_employer_schedule_view_DeductionName" class="ew-search-field">
<input type="text" data-table="employee_employer_schedule_view" data-field="x_DeductionName" name="x_DeductionName" id="x_DeductionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($employee_employer_schedule_view_search->DeductionName->getPlaceHolder()) ?>" value="<?php echo $employee_employer_schedule_view_search->DeductionName->EditValue ?>"<?php echo $employee_employer_schedule_view_search->DeductionName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_employer_schedule_view_search->DeductionAmount->Visible) { // DeductionAmount ?>
	<div id="r_DeductionAmount" class="form-group row">
		<label for="x_DeductionAmount" class="<?php echo $employee_employer_schedule_view_search->LeftColumnClass ?>"><span id="elh_employee_employer_schedule_view_DeductionAmount"><?php echo $employee_employer_schedule_view_search->DeductionAmount->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DeductionAmount" id="z_DeductionAmount" value="=">
</span>
		</label>
		<div class="<?php echo $employee_employer_schedule_view_search->RightColumnClass ?>"><div <?php echo $employee_employer_schedule_view_search->DeductionAmount->cellAttributes() ?>>
			<span id="el_employee_employer_schedule_view_DeductionAmount" class="ew-search-field">
<input type="text" data-table="employee_employer_schedule_view" data-field="x_DeductionAmount" name="x_DeductionAmount" id="x_DeductionAmount" size="30" placeholder="<?php echo HtmlEncode($employee_employer_schedule_view_search->DeductionAmount->getPlaceHolder()) ?>" value="<?php echo $employee_employer_schedule_view_search->DeductionAmount->EditValue ?>"<?php echo $employee_employer_schedule_view_search->DeductionAmount->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_employer_schedule_view_search->ObligationAmount->Visible) { // ObligationAmount ?>
	<div id="r_ObligationAmount" class="form-group row">
		<label for="x_ObligationAmount" class="<?php echo $employee_employer_schedule_view_search->LeftColumnClass ?>"><span id="elh_employee_employer_schedule_view_ObligationAmount"><?php echo $employee_employer_schedule_view_search->ObligationAmount->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ObligationAmount" id="z_ObligationAmount" value="=">
</span>
		</label>
		<div class="<?php echo $employee_employer_schedule_view_search->RightColumnClass ?>"><div <?php echo $employee_employer_schedule_view_search->ObligationAmount->cellAttributes() ?>>
			<span id="el_employee_employer_schedule_view_ObligationAmount" class="ew-search-field">
<input type="text" data-table="employee_employer_schedule_view" data-field="x_ObligationAmount" name="x_ObligationAmount" id="x_ObligationAmount" size="30" placeholder="<?php echo HtmlEncode($employee_employer_schedule_view_search->ObligationAmount->getPlaceHolder()) ?>" value="<?php echo $employee_employer_schedule_view_search->ObligationAmount->EditValue ?>"<?php echo $employee_employer_schedule_view_search->ObligationAmount->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_employer_schedule_view_search->PayrollRun->Visible) { // PayrollRun ?>
	<div id="r_PayrollRun" class="form-group row">
		<label for="x_PayrollRun" class="<?php echo $employee_employer_schedule_view_search->LeftColumnClass ?>"><span id="elh_employee_employer_schedule_view_PayrollRun"><?php echo $employee_employer_schedule_view_search->PayrollRun->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PayrollRun" id="z_PayrollRun" value="LIKE">
</span>
		</label>
		<div class="<?php echo $employee_employer_schedule_view_search->RightColumnClass ?>"><div <?php echo $employee_employer_schedule_view_search->PayrollRun->cellAttributes() ?>>
			<span id="el_employee_employer_schedule_view_PayrollRun" class="ew-search-field">
<input type="text" data-table="employee_employer_schedule_view" data-field="x_PayrollRun" name="x_PayrollRun" id="x_PayrollRun" size="35" placeholder="<?php echo HtmlEncode($employee_employer_schedule_view_search->PayrollRun->getPlaceHolder()) ?>" value="<?php echo $employee_employer_schedule_view_search->PayrollRun->EditValue ?>"<?php echo $employee_employer_schedule_view_search->PayrollRun->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_employer_schedule_view_search->NRC->Visible) { // NRC ?>
	<div id="r_NRC" class="form-group row">
		<label for="x_NRC" class="<?php echo $employee_employer_schedule_view_search->LeftColumnClass ?>"><span id="elh_employee_employer_schedule_view_NRC"><?php echo $employee_employer_schedule_view_search->NRC->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_NRC" id="z_NRC" value="LIKE">
</span>
		</label>
		<div class="<?php echo $employee_employer_schedule_view_search->RightColumnClass ?>"><div <?php echo $employee_employer_schedule_view_search->NRC->cellAttributes() ?>>
			<span id="el_employee_employer_schedule_view_NRC" class="ew-search-field">
<input type="text" data-table="employee_employer_schedule_view" data-field="x_NRC" name="x_NRC" id="x_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($employee_employer_schedule_view_search->NRC->getPlaceHolder()) ?>" value="<?php echo $employee_employer_schedule_view_search->NRC->EditValue ?>"<?php echo $employee_employer_schedule_view_search->NRC->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_employer_schedule_view_search->Surname->Visible) { // Surname ?>
	<div id="r_Surname" class="form-group row">
		<label for="x_Surname" class="<?php echo $employee_employer_schedule_view_search->LeftColumnClass ?>"><span id="elh_employee_employer_schedule_view_Surname"><?php echo $employee_employer_schedule_view_search->Surname->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Surname" id="z_Surname" value="LIKE">
</span>
		</label>
		<div class="<?php echo $employee_employer_schedule_view_search->RightColumnClass ?>"><div <?php echo $employee_employer_schedule_view_search->Surname->cellAttributes() ?>>
			<span id="el_employee_employer_schedule_view_Surname" class="ew-search-field">
<input type="text" data-table="employee_employer_schedule_view" data-field="x_Surname" name="x_Surname" id="x_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($employee_employer_schedule_view_search->Surname->getPlaceHolder()) ?>" value="<?php echo $employee_employer_schedule_view_search->Surname->EditValue ?>"<?php echo $employee_employer_schedule_view_search->Surname->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_employer_schedule_view_search->MiddleName->Visible) { // MiddleName ?>
	<div id="r_MiddleName" class="form-group row">
		<label for="x_MiddleName" class="<?php echo $employee_employer_schedule_view_search->LeftColumnClass ?>"><span id="elh_employee_employer_schedule_view_MiddleName"><?php echo $employee_employer_schedule_view_search->MiddleName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_MiddleName" id="z_MiddleName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $employee_employer_schedule_view_search->RightColumnClass ?>"><div <?php echo $employee_employer_schedule_view_search->MiddleName->cellAttributes() ?>>
			<span id="el_employee_employer_schedule_view_MiddleName" class="ew-search-field">
<input type="text" data-table="employee_employer_schedule_view" data-field="x_MiddleName" name="x_MiddleName" id="x_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($employee_employer_schedule_view_search->MiddleName->getPlaceHolder()) ?>" value="<?php echo $employee_employer_schedule_view_search->MiddleName->EditValue ?>"<?php echo $employee_employer_schedule_view_search->MiddleName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_employer_schedule_view_search->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label for="x_FirstName" class="<?php echo $employee_employer_schedule_view_search->LeftColumnClass ?>"><span id="elh_employee_employer_schedule_view_FirstName"><?php echo $employee_employer_schedule_view_search->FirstName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_FirstName" id="z_FirstName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $employee_employer_schedule_view_search->RightColumnClass ?>"><div <?php echo $employee_employer_schedule_view_search->FirstName->cellAttributes() ?>>
			<span id="el_employee_employer_schedule_view_FirstName" class="ew-search-field">
<input type="text" data-table="employee_employer_schedule_view" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($employee_employer_schedule_view_search->FirstName->getPlaceHolder()) ?>" value="<?php echo $employee_employer_schedule_view_search->FirstName->EditValue ?>"<?php echo $employee_employer_schedule_view_search->FirstName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_employer_schedule_view_search->PositionName->Visible) { // PositionName ?>
	<div id="r_PositionName" class="form-group row">
		<label for="x_PositionName" class="<?php echo $employee_employer_schedule_view_search->LeftColumnClass ?>"><span id="elh_employee_employer_schedule_view_PositionName"><?php echo $employee_employer_schedule_view_search->PositionName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PositionName" id="z_PositionName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $employee_employer_schedule_view_search->RightColumnClass ?>"><div <?php echo $employee_employer_schedule_view_search->PositionName->cellAttributes() ?>>
			<span id="el_employee_employer_schedule_view_PositionName" class="ew-search-field">
<input type="text" data-table="employee_employer_schedule_view" data-field="x_PositionName" name="x_PositionName" id="x_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($employee_employer_schedule_view_search->PositionName->getPlaceHolder()) ?>" value="<?php echo $employee_employer_schedule_view_search->PositionName->EditValue ?>"<?php echo $employee_employer_schedule_view_search->PositionName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employee_employer_schedule_view_search->PeriodCode->Visible) { // PeriodCode ?>
	<div id="r_PeriodCode" class="form-group row">
		<label for="x_PeriodCode" class="<?php echo $employee_employer_schedule_view_search->LeftColumnClass ?>"><span id="elh_employee_employer_schedule_view_PeriodCode"><?php echo $employee_employer_schedule_view_search->PeriodCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PeriodCode" id="z_PeriodCode" value="=">
</span>
		</label>
		<div class="<?php echo $employee_employer_schedule_view_search->RightColumnClass ?>"><div <?php echo $employee_employer_schedule_view_search->PeriodCode->cellAttributes() ?>>
			<span id="el_employee_employer_schedule_view_PeriodCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employee_employer_schedule_view" data-field="x_PeriodCode" data-value-separator="<?php echo $employee_employer_schedule_view_search->PeriodCode->displayValueSeparatorAttribute() ?>" id="x_PeriodCode" name="x_PeriodCode"<?php echo $employee_employer_schedule_view_search->PeriodCode->editAttributes() ?>>
			<?php echo $employee_employer_schedule_view_search->PeriodCode->selectOptionListHtml("x_PeriodCode") ?>
		</select>
</div>
<?php echo $employee_employer_schedule_view_search->PeriodCode->Lookup->getParamTag($employee_employer_schedule_view_search, "p_x_PeriodCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$employee_employer_schedule_view_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employee_employer_schedule_view_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$employee_employer_schedule_view_search->showPageFooter();
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
$employee_employer_schedule_view_search->terminate();
?>