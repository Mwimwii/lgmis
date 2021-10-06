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
$budget_period_search = new budget_period_search();

// Run the page
$budget_period_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$budget_period_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbudget_periodsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($budget_period_search->IsModal) { ?>
	fbudget_periodsearch = currentAdvancedSearchForm = new ew.Form("fbudget_periodsearch", "search");
	<?php } else { ?>
	fbudget_periodsearch = currentForm = new ew.Form("fbudget_periodsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fbudget_periodsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_FiscalYear");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($budget_period_search->FiscalYear->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_StartDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($budget_period_search->StartDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_EndDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($budget_period_search->EndDate->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fbudget_periodsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbudget_periodsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbudget_periodsearch.lists["x_CurrentPeriod"] = <?php echo $budget_period_search->CurrentPeriod->Lookup->toClientList($budget_period_search) ?>;
	fbudget_periodsearch.lists["x_CurrentPeriod"].options = <?php echo JsonEncode($budget_period_search->CurrentPeriod->lookupOptions()) ?>;
	loadjs.done("fbudget_periodsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $budget_period_search->showPageHeader(); ?>
<?php
$budget_period_search->showMessage();
?>
<form name="fbudget_periodsearch" id="fbudget_periodsearch" class="<?php echo $budget_period_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="budget_period">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$budget_period_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($budget_period_search->FiscalYear->Visible) { // FiscalYear ?>
	<div id="r_FiscalYear" class="form-group row">
		<label for="x_FiscalYear" class="<?php echo $budget_period_search->LeftColumnClass ?>"><span id="elh_budget_period_FiscalYear"><?php echo $budget_period_search->FiscalYear->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_FiscalYear" id="z_FiscalYear" value="=">
</span>
		</label>
		<div class="<?php echo $budget_period_search->RightColumnClass ?>"><div <?php echo $budget_period_search->FiscalYear->cellAttributes() ?>>
			<span id="el_budget_period_FiscalYear" class="ew-search-field">
<input type="text" data-table="budget_period" data-field="x_FiscalYear" name="x_FiscalYear" id="x_FiscalYear" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($budget_period_search->FiscalYear->getPlaceHolder()) ?>" value="<?php echo $budget_period_search->FiscalYear->EditValue ?>"<?php echo $budget_period_search->FiscalYear->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_period_search->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label for="x_StartDate" class="<?php echo $budget_period_search->LeftColumnClass ?>"><span id="elh_budget_period_StartDate"><?php echo $budget_period_search->StartDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_StartDate" id="z_StartDate" value="=">
</span>
		</label>
		<div class="<?php echo $budget_period_search->RightColumnClass ?>"><div <?php echo $budget_period_search->StartDate->cellAttributes() ?>>
			<span id="el_budget_period_StartDate" class="ew-search-field">
<input type="text" data-table="budget_period" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" maxlength="10" placeholder="<?php echo HtmlEncode($budget_period_search->StartDate->getPlaceHolder()) ?>" value="<?php echo $budget_period_search->StartDate->EditValue ?>"<?php echo $budget_period_search->StartDate->editAttributes() ?>>
<?php if (!$budget_period_search->StartDate->ReadOnly && !$budget_period_search->StartDate->Disabled && !isset($budget_period_search->StartDate->EditAttrs["readonly"]) && !isset($budget_period_search->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbudget_periodsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fbudget_periodsearch", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_period_search->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label for="x_EndDate" class="<?php echo $budget_period_search->LeftColumnClass ?>"><span id="elh_budget_period_EndDate"><?php echo $budget_period_search->EndDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EndDate" id="z_EndDate" value="=">
</span>
		</label>
		<div class="<?php echo $budget_period_search->RightColumnClass ?>"><div <?php echo $budget_period_search->EndDate->cellAttributes() ?>>
			<span id="el_budget_period_EndDate" class="ew-search-field">
<input type="text" data-table="budget_period" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" maxlength="10" placeholder="<?php echo HtmlEncode($budget_period_search->EndDate->getPlaceHolder()) ?>" value="<?php echo $budget_period_search->EndDate->EditValue ?>"<?php echo $budget_period_search->EndDate->editAttributes() ?>>
<?php if (!$budget_period_search->EndDate->ReadOnly && !$budget_period_search->EndDate->Disabled && !isset($budget_period_search->EndDate->EditAttrs["readonly"]) && !isset($budget_period_search->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbudget_periodsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fbudget_periodsearch", "x_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_period_search->CurrentPeriod->Visible) { // CurrentPeriod ?>
	<div id="r_CurrentPeriod" class="form-group row">
		<label for="x_CurrentPeriod" class="<?php echo $budget_period_search->LeftColumnClass ?>"><span id="elh_budget_period_CurrentPeriod"><?php echo $budget_period_search->CurrentPeriod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_CurrentPeriod" id="z_CurrentPeriod" value="=">
</span>
		</label>
		<div class="<?php echo $budget_period_search->RightColumnClass ?>"><div <?php echo $budget_period_search->CurrentPeriod->cellAttributes() ?>>
			<span id="el_budget_period_CurrentPeriod" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_period" data-field="x_CurrentPeriod" data-value-separator="<?php echo $budget_period_search->CurrentPeriod->displayValueSeparatorAttribute() ?>" id="x_CurrentPeriod" name="x_CurrentPeriod"<?php echo $budget_period_search->CurrentPeriod->editAttributes() ?>>
			<?php echo $budget_period_search->CurrentPeriod->selectOptionListHtml("x_CurrentPeriod") ?>
		</select>
</div>
<?php echo $budget_period_search->CurrentPeriod->Lookup->getParamTag($budget_period_search, "p_x_CurrentPeriod") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($budget_period_search->PeriodDescription->Visible) { // PeriodDescription ?>
	<div id="r_PeriodDescription" class="form-group row">
		<label for="x_PeriodDescription" class="<?php echo $budget_period_search->LeftColumnClass ?>"><span id="elh_budget_period_PeriodDescription"><?php echo $budget_period_search->PeriodDescription->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PeriodDescription" id="z_PeriodDescription" value="LIKE">
</span>
		</label>
		<div class="<?php echo $budget_period_search->RightColumnClass ?>"><div <?php echo $budget_period_search->PeriodDescription->cellAttributes() ?>>
			<span id="el_budget_period_PeriodDescription" class="ew-search-field">
<input type="text" data-table="budget_period" data-field="x_PeriodDescription" name="x_PeriodDescription" id="x_PeriodDescription" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($budget_period_search->PeriodDescription->getPlaceHolder()) ?>" value="<?php echo $budget_period_search->PeriodDescription->EditValue ?>"<?php echo $budget_period_search->PeriodDescription->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$budget_period_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $budget_period_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$budget_period_search->showPageFooter();
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
$budget_period_search->terminate();
?>