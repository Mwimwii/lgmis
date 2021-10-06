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
$monthly_run_search = new monthly_run_search();

// Run the page
$monthly_run_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$monthly_run_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmonthly_runsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($monthly_run_search->IsModal) { ?>
	fmonthly_runsearch = currentAdvancedSearchForm = new ew.Form("fmonthly_runsearch", "search");
	<?php } else { ?>
	fmonthly_runsearch = currentForm = new ew.Form("fmonthly_runsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fmonthly_runsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_RunDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($monthly_run_search->RunDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PayrollCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($monthly_run_search->PayrollCode->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fmonthly_runsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmonthly_runsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmonthly_runsearch.lists["x_LACode"] = <?php echo $monthly_run_search->LACode->Lookup->toClientList($monthly_run_search) ?>;
	fmonthly_runsearch.lists["x_LACode"].options = <?php echo JsonEncode($monthly_run_search->LACode->lookupOptions()) ?>;
	fmonthly_runsearch.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmonthly_runsearch.lists["x_PeriodCode"] = <?php echo $monthly_run_search->PeriodCode->Lookup->toClientList($monthly_run_search) ?>;
	fmonthly_runsearch.lists["x_PeriodCode"].options = <?php echo JsonEncode($monthly_run_search->PeriodCode->lookupOptions()) ?>;
	fmonthly_runsearch.lists["x_Year"] = <?php echo $monthly_run_search->Year->Lookup->toClientList($monthly_run_search) ?>;
	fmonthly_runsearch.lists["x_Year"].options = <?php echo JsonEncode($monthly_run_search->Year->lookupOptions()) ?>;
	fmonthly_runsearch.lists["x_RunMonth"] = <?php echo $monthly_run_search->RunMonth->Lookup->toClientList($monthly_run_search) ?>;
	fmonthly_runsearch.lists["x_RunMonth"].options = <?php echo JsonEncode($monthly_run_search->RunMonth->lookupOptions()) ?>;
	loadjs.done("fmonthly_runsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $monthly_run_search->showPageHeader(); ?>
<?php
$monthly_run_search->showMessage();
?>
<form name="fmonthly_runsearch" id="fmonthly_runsearch" class="<?php echo $monthly_run_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="monthly_run">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$monthly_run_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($monthly_run_search->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label class="<?php echo $monthly_run_search->LeftColumnClass ?>"><span id="elh_monthly_run_LACode"><?php echo $monthly_run_search->LACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $monthly_run_search->RightColumnClass ?>"><div <?php echo $monthly_run_search->LACode->cellAttributes() ?>>
			<span id="el_monthly_run_LACode" class="ew-search-field">
<?php
$onchange = $monthly_run_search->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$monthly_run_search->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($monthly_run_search->LACode->EditValue) ?>" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($monthly_run_search->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($monthly_run_search->LACode->getPlaceHolder()) ?>"<?php echo $monthly_run_search->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($monthly_run_search->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($monthly_run_search->LACode->ReadOnly || $monthly_run_search->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="monthly_run" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $monthly_run_search->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($monthly_run_search->LACode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmonthly_runsearch"], function() {
	fmonthly_runsearch.createAutoSuggest({"id":"x_LACode","forceSelect":true});
});
</script>
<?php echo $monthly_run_search->LACode->Lookup->getParamTag($monthly_run_search, "p_x_LACode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($monthly_run_search->PeriodCode->Visible) { // PeriodCode ?>
	<div id="r_PeriodCode" class="form-group row">
		<label for="x_PeriodCode" class="<?php echo $monthly_run_search->LeftColumnClass ?>"><span id="elh_monthly_run_PeriodCode"><?php echo $monthly_run_search->PeriodCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PeriodCode" id="z_PeriodCode" value="=">
</span>
		</label>
		<div class="<?php echo $monthly_run_search->RightColumnClass ?>"><div <?php echo $monthly_run_search->PeriodCode->cellAttributes() ?>>
			<span id="el_monthly_run_PeriodCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="monthly_run" data-field="x_PeriodCode" data-value-separator="<?php echo $monthly_run_search->PeriodCode->displayValueSeparatorAttribute() ?>" id="x_PeriodCode" name="x_PeriodCode"<?php echo $monthly_run_search->PeriodCode->editAttributes() ?>>
			<?php echo $monthly_run_search->PeriodCode->selectOptionListHtml("x_PeriodCode") ?>
		</select>
</div>
<?php echo $monthly_run_search->PeriodCode->Lookup->getParamTag($monthly_run_search, "p_x_PeriodCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($monthly_run_search->RunDate->Visible) { // RunDate ?>
	<div id="r_RunDate" class="form-group row">
		<label for="x_RunDate" class="<?php echo $monthly_run_search->LeftColumnClass ?>"><span id="elh_monthly_run_RunDate"><?php echo $monthly_run_search->RunDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_RunDate" id="z_RunDate" value="=">
</span>
		</label>
		<div class="<?php echo $monthly_run_search->RightColumnClass ?>"><div <?php echo $monthly_run_search->RunDate->cellAttributes() ?>>
			<span id="el_monthly_run_RunDate" class="ew-search-field">
<input type="text" data-table="monthly_run" data-field="x_RunDate" name="x_RunDate" id="x_RunDate" placeholder="<?php echo HtmlEncode($monthly_run_search->RunDate->getPlaceHolder()) ?>" value="<?php echo $monthly_run_search->RunDate->EditValue ?>"<?php echo $monthly_run_search->RunDate->editAttributes() ?>>
<?php if (!$monthly_run_search->RunDate->ReadOnly && !$monthly_run_search->RunDate->Disabled && !isset($monthly_run_search->RunDate->EditAttrs["readonly"]) && !isset($monthly_run_search->RunDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmonthly_runsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fmonthly_runsearch", "x_RunDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($monthly_run_search->RunType->Visible) { // RunType ?>
	<div id="r_RunType" class="form-group row">
		<label for="x_RunType" class="<?php echo $monthly_run_search->LeftColumnClass ?>"><span id="elh_monthly_run_RunType"><?php echo $monthly_run_search->RunType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_RunType" id="z_RunType" value="LIKE">
</span>
		</label>
		<div class="<?php echo $monthly_run_search->RightColumnClass ?>"><div <?php echo $monthly_run_search->RunType->cellAttributes() ?>>
			<span id="el_monthly_run_RunType" class="ew-search-field">
<input type="text" data-table="monthly_run" data-field="x_RunType" name="x_RunType" id="x_RunType" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($monthly_run_search->RunType->getPlaceHolder()) ?>" value="<?php echo $monthly_run_search->RunType->EditValue ?>"<?php echo $monthly_run_search->RunType->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($monthly_run_search->Description->Visible) { // Description ?>
	<div id="r_Description" class="form-group row">
		<label for="x_Description" class="<?php echo $monthly_run_search->LeftColumnClass ?>"><span id="elh_monthly_run_Description"><?php echo $monthly_run_search->Description->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Description" id="z_Description" value="LIKE">
</span>
		</label>
		<div class="<?php echo $monthly_run_search->RightColumnClass ?>"><div <?php echo $monthly_run_search->Description->cellAttributes() ?>>
			<span id="el_monthly_run_Description" class="ew-search-field">
<input type="text" data-table="monthly_run" data-field="x_Description" name="x_Description" id="x_Description" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($monthly_run_search->Description->getPlaceHolder()) ?>" value="<?php echo $monthly_run_search->Description->EditValue ?>"<?php echo $monthly_run_search->Description->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($monthly_run_search->Year->Visible) { // Year ?>
	<div id="r_Year" class="form-group row">
		<label for="x_Year" class="<?php echo $monthly_run_search->LeftColumnClass ?>"><span id="elh_monthly_run_Year"><?php echo $monthly_run_search->Year->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Year" id="z_Year" value="=">
</span>
		</label>
		<div class="<?php echo $monthly_run_search->RightColumnClass ?>"><div <?php echo $monthly_run_search->Year->cellAttributes() ?>>
			<span id="el_monthly_run_Year" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="monthly_run" data-field="x_Year" data-value-separator="<?php echo $monthly_run_search->Year->displayValueSeparatorAttribute() ?>" id="x_Year" name="x_Year"<?php echo $monthly_run_search->Year->editAttributes() ?>>
			<?php echo $monthly_run_search->Year->selectOptionListHtml("x_Year") ?>
		</select>
</div>
<?php echo $monthly_run_search->Year->Lookup->getParamTag($monthly_run_search, "p_x_Year") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($monthly_run_search->RunMonth->Visible) { // RunMonth ?>
	<div id="r_RunMonth" class="form-group row">
		<label for="x_RunMonth" class="<?php echo $monthly_run_search->LeftColumnClass ?>"><span id="elh_monthly_run_RunMonth"><?php echo $monthly_run_search->RunMonth->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_RunMonth" id="z_RunMonth" value="=">
</span>
		</label>
		<div class="<?php echo $monthly_run_search->RightColumnClass ?>"><div <?php echo $monthly_run_search->RunMonth->cellAttributes() ?>>
			<span id="el_monthly_run_RunMonth" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="monthly_run" data-field="x_RunMonth" data-value-separator="<?php echo $monthly_run_search->RunMonth->displayValueSeparatorAttribute() ?>" id="x_RunMonth" name="x_RunMonth"<?php echo $monthly_run_search->RunMonth->editAttributes() ?>>
			<?php echo $monthly_run_search->RunMonth->selectOptionListHtml("x_RunMonth") ?>
		</select>
</div>
<?php echo $monthly_run_search->RunMonth->Lookup->getParamTag($monthly_run_search, "p_x_RunMonth") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($monthly_run_search->PayrollCode->Visible) { // PayrollCode ?>
	<div id="r_PayrollCode" class="form-group row">
		<label for="x_PayrollCode" class="<?php echo $monthly_run_search->LeftColumnClass ?>"><span id="elh_monthly_run_PayrollCode"><?php echo $monthly_run_search->PayrollCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PayrollCode" id="z_PayrollCode" value="=">
</span>
		</label>
		<div class="<?php echo $monthly_run_search->RightColumnClass ?>"><div <?php echo $monthly_run_search->PayrollCode->cellAttributes() ?>>
			<span id="el_monthly_run_PayrollCode" class="ew-search-field">
<input type="text" data-table="monthly_run" data-field="x_PayrollCode" name="x_PayrollCode" id="x_PayrollCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($monthly_run_search->PayrollCode->getPlaceHolder()) ?>" value="<?php echo $monthly_run_search->PayrollCode->EditValue ?>"<?php echo $monthly_run_search->PayrollCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$monthly_run_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $monthly_run_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$monthly_run_search->showPageFooter();
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
$monthly_run_search->terminate();
?>