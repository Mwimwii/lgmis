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
$payroll_period_search = new payroll_period_search();

// Run the page
$payroll_period_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payroll_period_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpayroll_periodsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($payroll_period_search->IsModal) { ?>
	fpayroll_periodsearch = currentAdvancedSearchForm = new ew.Form("fpayroll_periodsearch", "search");
	<?php } else { ?>
	fpayroll_periodsearch = currentForm = new ew.Form("fpayroll_periodsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fpayroll_periodsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_PeriodCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payroll_period_search->PeriodCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_FiscalYear");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payroll_period_search->FiscalYear->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fpayroll_periodsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpayroll_periodsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpayroll_periodsearch.lists["x_FiscalYear"] = <?php echo $payroll_period_search->FiscalYear->Lookup->toClientList($payroll_period_search) ?>;
	fpayroll_periodsearch.lists["x_FiscalYear"].options = <?php echo JsonEncode($payroll_period_search->FiscalYear->lookupOptions()) ?>;
	fpayroll_periodsearch.autoSuggests["x_FiscalYear"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpayroll_periodsearch.lists["x_RunMonth"] = <?php echo $payroll_period_search->RunMonth->Lookup->toClientList($payroll_period_search) ?>;
	fpayroll_periodsearch.lists["x_RunMonth"].options = <?php echo JsonEncode($payroll_period_search->RunMonth->lookupOptions()) ?>;
	fpayroll_periodsearch.lists["x_CurrentPeriod"] = <?php echo $payroll_period_search->CurrentPeriod->Lookup->toClientList($payroll_period_search) ?>;
	fpayroll_periodsearch.lists["x_CurrentPeriod"].options = <?php echo JsonEncode($payroll_period_search->CurrentPeriod->lookupOptions()) ?>;
	loadjs.done("fpayroll_periodsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $payroll_period_search->showPageHeader(); ?>
<?php
$payroll_period_search->showMessage();
?>
<form name="fpayroll_periodsearch" id="fpayroll_periodsearch" class="<?php echo $payroll_period_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payroll_period">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$payroll_period_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($payroll_period_search->PeriodCode->Visible) { // PeriodCode ?>
	<div id="r_PeriodCode" class="form-group row">
		<label for="x_PeriodCode" class="<?php echo $payroll_period_search->LeftColumnClass ?>"><span id="elh_payroll_period_PeriodCode"><?php echo $payroll_period_search->PeriodCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PeriodCode" id="z_PeriodCode" value="=">
</span>
		</label>
		<div class="<?php echo $payroll_period_search->RightColumnClass ?>"><div <?php echo $payroll_period_search->PeriodCode->cellAttributes() ?>>
			<span id="el_payroll_period_PeriodCode" class="ew-search-field">
<input type="text" data-table="payroll_period" data-field="x_PeriodCode" name="x_PeriodCode" id="x_PeriodCode" size="30" placeholder="<?php echo HtmlEncode($payroll_period_search->PeriodCode->getPlaceHolder()) ?>" value="<?php echo $payroll_period_search->PeriodCode->EditValue ?>"<?php echo $payroll_period_search->PeriodCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_period_search->FiscalYear->Visible) { // FiscalYear ?>
	<div id="r_FiscalYear" class="form-group row">
		<label class="<?php echo $payroll_period_search->LeftColumnClass ?>"><span id="elh_payroll_period_FiscalYear"><?php echo $payroll_period_search->FiscalYear->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_FiscalYear" id="z_FiscalYear" value="=">
</span>
		</label>
		<div class="<?php echo $payroll_period_search->RightColumnClass ?>"><div <?php echo $payroll_period_search->FiscalYear->cellAttributes() ?>>
			<span id="el_payroll_period_FiscalYear" class="ew-search-field">
<?php
$onchange = $payroll_period_search->FiscalYear->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$payroll_period_search->FiscalYear->EditAttrs["onchange"] = "";
?>
<span id="as_x_FiscalYear">
	<input type="text" class="form-control" name="sv_x_FiscalYear" id="sv_x_FiscalYear" value="<?php echo RemoveHtml($payroll_period_search->FiscalYear->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($payroll_period_search->FiscalYear->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($payroll_period_search->FiscalYear->getPlaceHolder()) ?>"<?php echo $payroll_period_search->FiscalYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_period" data-field="x_FiscalYear" data-value-separator="<?php echo $payroll_period_search->FiscalYear->displayValueSeparatorAttribute() ?>" name="x_FiscalYear" id="x_FiscalYear" value="<?php echo HtmlEncode($payroll_period_search->FiscalYear->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpayroll_periodsearch"], function() {
	fpayroll_periodsearch.createAutoSuggest({"id":"x_FiscalYear","forceSelect":false});
});
</script>
<?php echo $payroll_period_search->FiscalYear->Lookup->getParamTag($payroll_period_search, "p_x_FiscalYear") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_period_search->RunMonth->Visible) { // RunMonth ?>
	<div id="r_RunMonth" class="form-group row">
		<label for="x_RunMonth" class="<?php echo $payroll_period_search->LeftColumnClass ?>"><span id="elh_payroll_period_RunMonth"><?php echo $payroll_period_search->RunMonth->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_RunMonth" id="z_RunMonth" value="=">
</span>
		</label>
		<div class="<?php echo $payroll_period_search->RightColumnClass ?>"><div <?php echo $payroll_period_search->RunMonth->cellAttributes() ?>>
			<span id="el_payroll_period_RunMonth" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="payroll_period" data-field="x_RunMonth" data-value-separator="<?php echo $payroll_period_search->RunMonth->displayValueSeparatorAttribute() ?>" id="x_RunMonth" name="x_RunMonth"<?php echo $payroll_period_search->RunMonth->editAttributes() ?>>
			<?php echo $payroll_period_search->RunMonth->selectOptionListHtml("x_RunMonth") ?>
		</select>
</div>
<?php echo $payroll_period_search->RunMonth->Lookup->getParamTag($payroll_period_search, "p_x_RunMonth") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_period_search->RunDescription->Visible) { // RunDescription ?>
	<div id="r_RunDescription" class="form-group row">
		<label for="x_RunDescription" class="<?php echo $payroll_period_search->LeftColumnClass ?>"><span id="elh_payroll_period_RunDescription"><?php echo $payroll_period_search->RunDescription->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_RunDescription" id="z_RunDescription" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payroll_period_search->RightColumnClass ?>"><div <?php echo $payroll_period_search->RunDescription->cellAttributes() ?>>
			<span id="el_payroll_period_RunDescription" class="ew-search-field">
<input type="text" data-table="payroll_period" data-field="x_RunDescription" name="x_RunDescription" id="x_RunDescription" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($payroll_period_search->RunDescription->getPlaceHolder()) ?>" value="<?php echo $payroll_period_search->RunDescription->EditValue ?>"<?php echo $payroll_period_search->RunDescription->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payroll_period_search->CurrentPeriod->Visible) { // CurrentPeriod ?>
	<div id="r_CurrentPeriod" class="form-group row">
		<label class="<?php echo $payroll_period_search->LeftColumnClass ?>"><span id="elh_payroll_period_CurrentPeriod"><?php echo $payroll_period_search->CurrentPeriod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_CurrentPeriod" id="z_CurrentPeriod" value="=">
</span>
		</label>
		<div class="<?php echo $payroll_period_search->RightColumnClass ?>"><div <?php echo $payroll_period_search->CurrentPeriod->cellAttributes() ?>>
			<span id="el_payroll_period_CurrentPeriod" class="ew-search-field">
<div id="tp_x_CurrentPeriod" class="ew-template"><input type="radio" class="custom-control-input" data-table="payroll_period" data-field="x_CurrentPeriod" data-value-separator="<?php echo $payroll_period_search->CurrentPeriod->displayValueSeparatorAttribute() ?>" name="x_CurrentPeriod" id="x_CurrentPeriod" value="{value}"<?php echo $payroll_period_search->CurrentPeriod->editAttributes() ?>></div>
<div id="dsl_x_CurrentPeriod" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $payroll_period_search->CurrentPeriod->radioButtonListHtml(FALSE, "x_CurrentPeriod") ?>
</div></div>
<?php echo $payroll_period_search->CurrentPeriod->Lookup->getParamTag($payroll_period_search, "p_x_CurrentPeriod") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$payroll_period_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $payroll_period_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$payroll_period_search->showPageFooter();
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
$payroll_period_search->terminate();
?>