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
$budget_actual_add = new budget_actual_add();

// Run the page
$budget_actual_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$budget_actual_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbudget_actualadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fbudget_actualadd = currentForm = new ew.Form("fbudget_actualadd", "add");

	// Validate form
	fbudget_actualadd.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($budget_actual_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_add->LACode->caption(), $budget_actual_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_actual_add->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_add->DepartmentCode->caption(), $budget_actual_add->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_actual_add->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_add->SectionCode->caption(), $budget_actual_add->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_actual_add->AccountCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_add->AccountCode->caption(), $budget_actual_add->AccountCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_actual_add->PostingDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PostingDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_add->PostingDate->caption(), $budget_actual_add->PostingDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PostingDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_actual_add->PostingDate->errorMessage()) ?>");
			<?php if ($budget_actual_add->AccountMonth->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountMonth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_add->AccountMonth->caption(), $budget_actual_add->AccountMonth->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_actual_add->AccountYear->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_add->AccountYear->caption(), $budget_actual_add->AccountYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AccountYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_actual_add->AccountYear->errorMessage()) ?>");
			<?php if ($budget_actual_add->BudgetEstimate->Required) { ?>
				elm = this.getElements("x" + infix + "_BudgetEstimate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_add->BudgetEstimate->caption(), $budget_actual_add->BudgetEstimate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BudgetEstimate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_actual_add->BudgetEstimate->errorMessage()) ?>");
			<?php if ($budget_actual_add->ActualAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_add->ActualAmount->caption(), $budget_actual_add->ActualAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_actual_add->ActualAmount->errorMessage()) ?>");
			<?php if ($budget_actual_add->ForecastAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_ForecastAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_add->ForecastAmount->caption(), $budget_actual_add->ForecastAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ForecastAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_actual_add->ForecastAmount->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fbudget_actualadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbudget_actualadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbudget_actualadd.lists["x_LACode"] = <?php echo $budget_actual_add->LACode->Lookup->toClientList($budget_actual_add) ?>;
	fbudget_actualadd.lists["x_LACode"].options = <?php echo JsonEncode($budget_actual_add->LACode->lookupOptions()) ?>;
	fbudget_actualadd.lists["x_DepartmentCode"] = <?php echo $budget_actual_add->DepartmentCode->Lookup->toClientList($budget_actual_add) ?>;
	fbudget_actualadd.lists["x_DepartmentCode"].options = <?php echo JsonEncode($budget_actual_add->DepartmentCode->lookupOptions()) ?>;
	fbudget_actualadd.lists["x_SectionCode"] = <?php echo $budget_actual_add->SectionCode->Lookup->toClientList($budget_actual_add) ?>;
	fbudget_actualadd.lists["x_SectionCode"].options = <?php echo JsonEncode($budget_actual_add->SectionCode->lookupOptions()) ?>;
	fbudget_actualadd.lists["x_AccountMonth"] = <?php echo $budget_actual_add->AccountMonth->Lookup->toClientList($budget_actual_add) ?>;
	fbudget_actualadd.lists["x_AccountMonth"].options = <?php echo JsonEncode($budget_actual_add->AccountMonth->lookupOptions()) ?>;
	fbudget_actualadd.lists["x_AccountYear"] = <?php echo $budget_actual_add->AccountYear->Lookup->toClientList($budget_actual_add) ?>;
	fbudget_actualadd.lists["x_AccountYear"].options = <?php echo JsonEncode($budget_actual_add->AccountYear->lookupOptions()) ?>;
	fbudget_actualadd.autoSuggests["x_AccountYear"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fbudget_actualadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $budget_actual_add->showPageHeader(); ?>
<?php
$budget_actual_add->showMessage();
?>
<form name="fbudget_actualadd" id="fbudget_actualadd" class="<?php echo $budget_actual_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="budget_actual">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$budget_actual_add->IsModal ?>">
<?php if ($budget_actual->getCurrentMasterTable() == "local_authority") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($budget_actual_add->LACode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($budget_actual_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_budget_actual_LACode" for="x_LACode" class="<?php echo $budget_actual_add->LeftColumnClass ?>"><?php echo $budget_actual_add->LACode->caption() ?><?php echo $budget_actual_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_actual_add->RightColumnClass ?>"><div <?php echo $budget_actual_add->LACode->cellAttributes() ?>>
<?php if ($budget_actual_add->LACode->getSessionValue() != "") { ?>
<span id="el_budget_actual_LACode">
<span<?php echo $budget_actual_add->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_actual_add->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($budget_actual_add->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_budget_actual_LACode">
<?php $budget_actual_add->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_LACode" data-value-separator="<?php echo $budget_actual_add->LACode->displayValueSeparatorAttribute() ?>" id="x_LACode" name="x_LACode"<?php echo $budget_actual_add->LACode->editAttributes() ?>>
			<?php echo $budget_actual_add->LACode->selectOptionListHtml("x_LACode") ?>
		</select>
</div>
<?php echo $budget_actual_add->LACode->Lookup->getParamTag($budget_actual_add, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $budget_actual_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_actual_add->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_budget_actual_DepartmentCode" for="x_DepartmentCode" class="<?php echo $budget_actual_add->LeftColumnClass ?>"><?php echo $budget_actual_add->DepartmentCode->caption() ?><?php echo $budget_actual_add->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_actual_add->RightColumnClass ?>"><div <?php echo $budget_actual_add->DepartmentCode->cellAttributes() ?>>
<span id="el_budget_actual_DepartmentCode">
<?php $budget_actual_add->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_DepartmentCode" data-value-separator="<?php echo $budget_actual_add->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $budget_actual_add->DepartmentCode->editAttributes() ?>>
			<?php echo $budget_actual_add->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $budget_actual_add->DepartmentCode->Lookup->getParamTag($budget_actual_add, "p_x_DepartmentCode") ?>
</span>
<?php echo $budget_actual_add->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_actual_add->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_budget_actual_SectionCode" for="x_SectionCode" class="<?php echo $budget_actual_add->LeftColumnClass ?>"><?php echo $budget_actual_add->SectionCode->caption() ?><?php echo $budget_actual_add->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_actual_add->RightColumnClass ?>"><div <?php echo $budget_actual_add->SectionCode->cellAttributes() ?>>
<span id="el_budget_actual_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_SectionCode" data-value-separator="<?php echo $budget_actual_add->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $budget_actual_add->SectionCode->editAttributes() ?>>
			<?php echo $budget_actual_add->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $budget_actual_add->SectionCode->Lookup->getParamTag($budget_actual_add, "p_x_SectionCode") ?>
</span>
<?php echo $budget_actual_add->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_actual_add->AccountCode->Visible) { // AccountCode ?>
	<div id="r_AccountCode" class="form-group row">
		<label id="elh_budget_actual_AccountCode" for="x_AccountCode" class="<?php echo $budget_actual_add->LeftColumnClass ?>"><?php echo $budget_actual_add->AccountCode->caption() ?><?php echo $budget_actual_add->AccountCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_actual_add->RightColumnClass ?>"><div <?php echo $budget_actual_add->AccountCode->cellAttributes() ?>>
<span id="el_budget_actual_AccountCode">
<input type="text" data-table="budget_actual" data-field="x_AccountCode" name="x_AccountCode" id="x_AccountCode" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($budget_actual_add->AccountCode->getPlaceHolder()) ?>" value="<?php echo $budget_actual_add->AccountCode->EditValue ?>"<?php echo $budget_actual_add->AccountCode->editAttributes() ?>>
</span>
<?php echo $budget_actual_add->AccountCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_actual_add->PostingDate->Visible) { // PostingDate ?>
	<div id="r_PostingDate" class="form-group row">
		<label id="elh_budget_actual_PostingDate" for="x_PostingDate" class="<?php echo $budget_actual_add->LeftColumnClass ?>"><?php echo $budget_actual_add->PostingDate->caption() ?><?php echo $budget_actual_add->PostingDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_actual_add->RightColumnClass ?>"><div <?php echo $budget_actual_add->PostingDate->cellAttributes() ?>>
<span id="el_budget_actual_PostingDate">
<input type="text" data-table="budget_actual" data-field="x_PostingDate" name="x_PostingDate" id="x_PostingDate" placeholder="<?php echo HtmlEncode($budget_actual_add->PostingDate->getPlaceHolder()) ?>" value="<?php echo $budget_actual_add->PostingDate->EditValue ?>"<?php echo $budget_actual_add->PostingDate->editAttributes() ?>>
<?php if (!$budget_actual_add->PostingDate->ReadOnly && !$budget_actual_add->PostingDate->Disabled && !isset($budget_actual_add->PostingDate->EditAttrs["readonly"]) && !isset($budget_actual_add->PostingDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbudget_actualadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fbudget_actualadd", "x_PostingDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $budget_actual_add->PostingDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_actual_add->AccountMonth->Visible) { // AccountMonth ?>
	<div id="r_AccountMonth" class="form-group row">
		<label id="elh_budget_actual_AccountMonth" for="x_AccountMonth" class="<?php echo $budget_actual_add->LeftColumnClass ?>"><?php echo $budget_actual_add->AccountMonth->caption() ?><?php echo $budget_actual_add->AccountMonth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_actual_add->RightColumnClass ?>"><div <?php echo $budget_actual_add->AccountMonth->cellAttributes() ?>>
<span id="el_budget_actual_AccountMonth">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_AccountMonth" data-value-separator="<?php echo $budget_actual_add->AccountMonth->displayValueSeparatorAttribute() ?>" id="x_AccountMonth" name="x_AccountMonth"<?php echo $budget_actual_add->AccountMonth->editAttributes() ?>>
			<?php echo $budget_actual_add->AccountMonth->selectOptionListHtml("x_AccountMonth") ?>
		</select>
</div>
<?php echo $budget_actual_add->AccountMonth->Lookup->getParamTag($budget_actual_add, "p_x_AccountMonth") ?>
</span>
<?php echo $budget_actual_add->AccountMonth->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_actual_add->AccountYear->Visible) { // AccountYear ?>
	<div id="r_AccountYear" class="form-group row">
		<label id="elh_budget_actual_AccountYear" class="<?php echo $budget_actual_add->LeftColumnClass ?>"><?php echo $budget_actual_add->AccountYear->caption() ?><?php echo $budget_actual_add->AccountYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_actual_add->RightColumnClass ?>"><div <?php echo $budget_actual_add->AccountYear->cellAttributes() ?>>
<span id="el_budget_actual_AccountYear">
<?php
$onchange = $budget_actual_add->AccountYear->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_actual_add->AccountYear->EditAttrs["onchange"] = "";
?>
<span id="as_x_AccountYear">
	<input type="text" class="form-control" name="sv_x_AccountYear" id="sv_x_AccountYear" value="<?php echo RemoveHtml($budget_actual_add->AccountYear->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($budget_actual_add->AccountYear->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_actual_add->AccountYear->getPlaceHolder()) ?>"<?php echo $budget_actual_add->AccountYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_AccountYear" data-value-separator="<?php echo $budget_actual_add->AccountYear->displayValueSeparatorAttribute() ?>" name="x_AccountYear" id="x_AccountYear" value="<?php echo HtmlEncode($budget_actual_add->AccountYear->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudget_actualadd"], function() {
	fbudget_actualadd.createAutoSuggest({"id":"x_AccountYear","forceSelect":false});
});
</script>
<?php echo $budget_actual_add->AccountYear->Lookup->getParamTag($budget_actual_add, "p_x_AccountYear") ?>
</span>
<?php echo $budget_actual_add->AccountYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_actual_add->BudgetEstimate->Visible) { // BudgetEstimate ?>
	<div id="r_BudgetEstimate" class="form-group row">
		<label id="elh_budget_actual_BudgetEstimate" for="x_BudgetEstimate" class="<?php echo $budget_actual_add->LeftColumnClass ?>"><?php echo $budget_actual_add->BudgetEstimate->caption() ?><?php echo $budget_actual_add->BudgetEstimate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_actual_add->RightColumnClass ?>"><div <?php echo $budget_actual_add->BudgetEstimate->cellAttributes() ?>>
<span id="el_budget_actual_BudgetEstimate">
<input type="text" data-table="budget_actual" data-field="x_BudgetEstimate" name="x_BudgetEstimate" id="x_BudgetEstimate" size="30" placeholder="<?php echo HtmlEncode($budget_actual_add->BudgetEstimate->getPlaceHolder()) ?>" value="<?php echo $budget_actual_add->BudgetEstimate->EditValue ?>"<?php echo $budget_actual_add->BudgetEstimate->editAttributes() ?>>
</span>
<?php echo $budget_actual_add->BudgetEstimate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_actual_add->ActualAmount->Visible) { // ActualAmount ?>
	<div id="r_ActualAmount" class="form-group row">
		<label id="elh_budget_actual_ActualAmount" for="x_ActualAmount" class="<?php echo $budget_actual_add->LeftColumnClass ?>"><?php echo $budget_actual_add->ActualAmount->caption() ?><?php echo $budget_actual_add->ActualAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_actual_add->RightColumnClass ?>"><div <?php echo $budget_actual_add->ActualAmount->cellAttributes() ?>>
<span id="el_budget_actual_ActualAmount">
<input type="text" data-table="budget_actual" data-field="x_ActualAmount" name="x_ActualAmount" id="x_ActualAmount" size="30" placeholder="<?php echo HtmlEncode($budget_actual_add->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $budget_actual_add->ActualAmount->EditValue ?>"<?php echo $budget_actual_add->ActualAmount->editAttributes() ?>>
</span>
<?php echo $budget_actual_add->ActualAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_actual_add->ForecastAmount->Visible) { // ForecastAmount ?>
	<div id="r_ForecastAmount" class="form-group row">
		<label id="elh_budget_actual_ForecastAmount" for="x_ForecastAmount" class="<?php echo $budget_actual_add->LeftColumnClass ?>"><?php echo $budget_actual_add->ForecastAmount->caption() ?><?php echo $budget_actual_add->ForecastAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_actual_add->RightColumnClass ?>"><div <?php echo $budget_actual_add->ForecastAmount->cellAttributes() ?>>
<span id="el_budget_actual_ForecastAmount">
<input type="text" data-table="budget_actual" data-field="x_ForecastAmount" name="x_ForecastAmount" id="x_ForecastAmount" size="30" placeholder="<?php echo HtmlEncode($budget_actual_add->ForecastAmount->getPlaceHolder()) ?>" value="<?php echo $budget_actual_add->ForecastAmount->EditValue ?>"<?php echo $budget_actual_add->ForecastAmount->editAttributes() ?>>
</span>
<?php echo $budget_actual_add->ForecastAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$budget_actual_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $budget_actual_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $budget_actual_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$budget_actual_add->showPageFooter();
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
$budget_actual_add->terminate();
?>