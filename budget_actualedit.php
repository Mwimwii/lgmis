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
$budget_actual_edit = new budget_actual_edit();

// Run the page
$budget_actual_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$budget_actual_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbudget_actualedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fbudget_actualedit = currentForm = new ew.Form("fbudget_actualedit", "edit");

	// Validate form
	fbudget_actualedit.validate = function() {
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
			<?php if ($budget_actual_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_edit->LACode->caption(), $budget_actual_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_actual_edit->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_edit->DepartmentCode->caption(), $budget_actual_edit->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_actual_edit->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_edit->SectionCode->caption(), $budget_actual_edit->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_actual_edit->AccountCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_edit->AccountCode->caption(), $budget_actual_edit->AccountCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_actual_edit->PostingDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PostingDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_edit->PostingDate->caption(), $budget_actual_edit->PostingDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PostingDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_actual_edit->PostingDate->errorMessage()) ?>");
			<?php if ($budget_actual_edit->AccountMonth->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountMonth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_edit->AccountMonth->caption(), $budget_actual_edit->AccountMonth->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_actual_edit->AccountYear->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_edit->AccountYear->caption(), $budget_actual_edit->AccountYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AccountYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_actual_edit->AccountYear->errorMessage()) ?>");
			<?php if ($budget_actual_edit->BudgetEstimate->Required) { ?>
				elm = this.getElements("x" + infix + "_BudgetEstimate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_edit->BudgetEstimate->caption(), $budget_actual_edit->BudgetEstimate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BudgetEstimate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_actual_edit->BudgetEstimate->errorMessage()) ?>");
			<?php if ($budget_actual_edit->ActualAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_edit->ActualAmount->caption(), $budget_actual_edit->ActualAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_actual_edit->ActualAmount->errorMessage()) ?>");
			<?php if ($budget_actual_edit->ForecastAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_ForecastAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_edit->ForecastAmount->caption(), $budget_actual_edit->ForecastAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ForecastAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_actual_edit->ForecastAmount->errorMessage()) ?>");

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
	fbudget_actualedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbudget_actualedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbudget_actualedit.lists["x_LACode"] = <?php echo $budget_actual_edit->LACode->Lookup->toClientList($budget_actual_edit) ?>;
	fbudget_actualedit.lists["x_LACode"].options = <?php echo JsonEncode($budget_actual_edit->LACode->lookupOptions()) ?>;
	fbudget_actualedit.lists["x_DepartmentCode"] = <?php echo $budget_actual_edit->DepartmentCode->Lookup->toClientList($budget_actual_edit) ?>;
	fbudget_actualedit.lists["x_DepartmentCode"].options = <?php echo JsonEncode($budget_actual_edit->DepartmentCode->lookupOptions()) ?>;
	fbudget_actualedit.lists["x_SectionCode"] = <?php echo $budget_actual_edit->SectionCode->Lookup->toClientList($budget_actual_edit) ?>;
	fbudget_actualedit.lists["x_SectionCode"].options = <?php echo JsonEncode($budget_actual_edit->SectionCode->lookupOptions()) ?>;
	fbudget_actualedit.lists["x_AccountMonth"] = <?php echo $budget_actual_edit->AccountMonth->Lookup->toClientList($budget_actual_edit) ?>;
	fbudget_actualedit.lists["x_AccountMonth"].options = <?php echo JsonEncode($budget_actual_edit->AccountMonth->lookupOptions()) ?>;
	fbudget_actualedit.lists["x_AccountYear"] = <?php echo $budget_actual_edit->AccountYear->Lookup->toClientList($budget_actual_edit) ?>;
	fbudget_actualedit.lists["x_AccountYear"].options = <?php echo JsonEncode($budget_actual_edit->AccountYear->lookupOptions()) ?>;
	fbudget_actualedit.autoSuggests["x_AccountYear"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fbudget_actualedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $budget_actual_edit->showPageHeader(); ?>
<?php
$budget_actual_edit->showMessage();
?>
<?php if (!$budget_actual_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $budget_actual_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fbudget_actualedit" id="fbudget_actualedit" class="<?php echo $budget_actual_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="budget_actual">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$budget_actual_edit->IsModal ?>">
<?php if ($budget_actual->getCurrentMasterTable() == "local_authority") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($budget_actual_edit->LACode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($budget_actual_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_budget_actual_LACode" for="x_LACode" class="<?php echo $budget_actual_edit->LeftColumnClass ?>"><?php echo $budget_actual_edit->LACode->caption() ?><?php echo $budget_actual_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_actual_edit->RightColumnClass ?>"><div <?php echo $budget_actual_edit->LACode->cellAttributes() ?>>
<?php if ($budget_actual_edit->LACode->getSessionValue() != "") { ?>

<span id="el_budget_actual_LACode">
<span<?php echo $budget_actual_edit->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_actual_edit->LACode->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($budget_actual_edit->LACode->CurrentValue) ?>">
<?php } else { ?>

<?php $budget_actual_edit->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_LACode" data-value-separator="<?php echo $budget_actual_edit->LACode->displayValueSeparatorAttribute() ?>" id="x_LACode" name="x_LACode"<?php echo $budget_actual_edit->LACode->editAttributes() ?>>
			<?php echo $budget_actual_edit->LACode->selectOptionListHtml("x_LACode") ?>
		</select>
</div>
<?php echo $budget_actual_edit->LACode->Lookup->getParamTag($budget_actual_edit, "p_x_LACode") ?>

<?php } ?>

<input type="hidden" data-table="budget_actual" data-field="x_LACode" name="o_LACode" id="o_LACode" value="<?php echo HtmlEncode($budget_actual_edit->LACode->OldValue != null ? $budget_actual_edit->LACode->OldValue : $budget_actual_edit->LACode->CurrentValue) ?>">
<?php echo $budget_actual_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_actual_edit->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_budget_actual_DepartmentCode" for="x_DepartmentCode" class="<?php echo $budget_actual_edit->LeftColumnClass ?>"><?php echo $budget_actual_edit->DepartmentCode->caption() ?><?php echo $budget_actual_edit->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_actual_edit->RightColumnClass ?>"><div <?php echo $budget_actual_edit->DepartmentCode->cellAttributes() ?>>
<span id="el_budget_actual_DepartmentCode">
<?php $budget_actual_edit->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_DepartmentCode" data-value-separator="<?php echo $budget_actual_edit->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $budget_actual_edit->DepartmentCode->editAttributes() ?>>
			<?php echo $budget_actual_edit->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $budget_actual_edit->DepartmentCode->Lookup->getParamTag($budget_actual_edit, "p_x_DepartmentCode") ?>
</span>
<?php echo $budget_actual_edit->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_actual_edit->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_budget_actual_SectionCode" for="x_SectionCode" class="<?php echo $budget_actual_edit->LeftColumnClass ?>"><?php echo $budget_actual_edit->SectionCode->caption() ?><?php echo $budget_actual_edit->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_actual_edit->RightColumnClass ?>"><div <?php echo $budget_actual_edit->SectionCode->cellAttributes() ?>>
<span id="el_budget_actual_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_SectionCode" data-value-separator="<?php echo $budget_actual_edit->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $budget_actual_edit->SectionCode->editAttributes() ?>>
			<?php echo $budget_actual_edit->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $budget_actual_edit->SectionCode->Lookup->getParamTag($budget_actual_edit, "p_x_SectionCode") ?>
</span>
<?php echo $budget_actual_edit->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_actual_edit->AccountCode->Visible) { // AccountCode ?>
	<div id="r_AccountCode" class="form-group row">
		<label id="elh_budget_actual_AccountCode" for="x_AccountCode" class="<?php echo $budget_actual_edit->LeftColumnClass ?>"><?php echo $budget_actual_edit->AccountCode->caption() ?><?php echo $budget_actual_edit->AccountCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_actual_edit->RightColumnClass ?>"><div <?php echo $budget_actual_edit->AccountCode->cellAttributes() ?>>
<input type="text" data-table="budget_actual" data-field="x_AccountCode" name="x_AccountCode" id="x_AccountCode" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($budget_actual_edit->AccountCode->getPlaceHolder()) ?>" value="<?php echo $budget_actual_edit->AccountCode->EditValue ?>"<?php echo $budget_actual_edit->AccountCode->editAttributes() ?>>
<input type="hidden" data-table="budget_actual" data-field="x_AccountCode" name="o_AccountCode" id="o_AccountCode" value="<?php echo HtmlEncode($budget_actual_edit->AccountCode->OldValue != null ? $budget_actual_edit->AccountCode->OldValue : $budget_actual_edit->AccountCode->CurrentValue) ?>">
<?php echo $budget_actual_edit->AccountCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_actual_edit->PostingDate->Visible) { // PostingDate ?>
	<div id="r_PostingDate" class="form-group row">
		<label id="elh_budget_actual_PostingDate" for="x_PostingDate" class="<?php echo $budget_actual_edit->LeftColumnClass ?>"><?php echo $budget_actual_edit->PostingDate->caption() ?><?php echo $budget_actual_edit->PostingDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_actual_edit->RightColumnClass ?>"><div <?php echo $budget_actual_edit->PostingDate->cellAttributes() ?>>
<span id="el_budget_actual_PostingDate">
<input type="text" data-table="budget_actual" data-field="x_PostingDate" name="x_PostingDate" id="x_PostingDate" placeholder="<?php echo HtmlEncode($budget_actual_edit->PostingDate->getPlaceHolder()) ?>" value="<?php echo $budget_actual_edit->PostingDate->EditValue ?>"<?php echo $budget_actual_edit->PostingDate->editAttributes() ?>>
<?php if (!$budget_actual_edit->PostingDate->ReadOnly && !$budget_actual_edit->PostingDate->Disabled && !isset($budget_actual_edit->PostingDate->EditAttrs["readonly"]) && !isset($budget_actual_edit->PostingDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbudget_actualedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fbudget_actualedit", "x_PostingDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $budget_actual_edit->PostingDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_actual_edit->AccountMonth->Visible) { // AccountMonth ?>
	<div id="r_AccountMonth" class="form-group row">
		<label id="elh_budget_actual_AccountMonth" for="x_AccountMonth" class="<?php echo $budget_actual_edit->LeftColumnClass ?>"><?php echo $budget_actual_edit->AccountMonth->caption() ?><?php echo $budget_actual_edit->AccountMonth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_actual_edit->RightColumnClass ?>"><div <?php echo $budget_actual_edit->AccountMonth->cellAttributes() ?>>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_AccountMonth" data-value-separator="<?php echo $budget_actual_edit->AccountMonth->displayValueSeparatorAttribute() ?>" id="x_AccountMonth" name="x_AccountMonth"<?php echo $budget_actual_edit->AccountMonth->editAttributes() ?>>
			<?php echo $budget_actual_edit->AccountMonth->selectOptionListHtml("x_AccountMonth") ?>
		</select>
</div>
<?php echo $budget_actual_edit->AccountMonth->Lookup->getParamTag($budget_actual_edit, "p_x_AccountMonth") ?>
<input type="hidden" data-table="budget_actual" data-field="x_AccountMonth" name="o_AccountMonth" id="o_AccountMonth" value="<?php echo HtmlEncode($budget_actual_edit->AccountMonth->OldValue != null ? $budget_actual_edit->AccountMonth->OldValue : $budget_actual_edit->AccountMonth->CurrentValue) ?>">
<?php echo $budget_actual_edit->AccountMonth->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_actual_edit->AccountYear->Visible) { // AccountYear ?>
	<div id="r_AccountYear" class="form-group row">
		<label id="elh_budget_actual_AccountYear" class="<?php echo $budget_actual_edit->LeftColumnClass ?>"><?php echo $budget_actual_edit->AccountYear->caption() ?><?php echo $budget_actual_edit->AccountYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_actual_edit->RightColumnClass ?>"><div <?php echo $budget_actual_edit->AccountYear->cellAttributes() ?>>
<?php
$onchange = $budget_actual_edit->AccountYear->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_actual_edit->AccountYear->EditAttrs["onchange"] = "";
?>
<span id="as_x_AccountYear">
	<input type="text" class="form-control" name="sv_x_AccountYear" id="sv_x_AccountYear" value="<?php echo RemoveHtml($budget_actual_edit->AccountYear->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($budget_actual_edit->AccountYear->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_actual_edit->AccountYear->getPlaceHolder()) ?>"<?php echo $budget_actual_edit->AccountYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_AccountYear" data-value-separator="<?php echo $budget_actual_edit->AccountYear->displayValueSeparatorAttribute() ?>" name="x_AccountYear" id="x_AccountYear" value="<?php echo HtmlEncode($budget_actual_edit->AccountYear->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudget_actualedit"], function() {
	fbudget_actualedit.createAutoSuggest({"id":"x_AccountYear","forceSelect":false});
});
</script>
<?php echo $budget_actual_edit->AccountYear->Lookup->getParamTag($budget_actual_edit, "p_x_AccountYear") ?>
<input type="hidden" data-table="budget_actual" data-field="x_AccountYear" name="o_AccountYear" id="o_AccountYear" value="<?php echo HtmlEncode($budget_actual_edit->AccountYear->OldValue != null ? $budget_actual_edit->AccountYear->OldValue : $budget_actual_edit->AccountYear->CurrentValue) ?>">
<?php echo $budget_actual_edit->AccountYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_actual_edit->BudgetEstimate->Visible) { // BudgetEstimate ?>
	<div id="r_BudgetEstimate" class="form-group row">
		<label id="elh_budget_actual_BudgetEstimate" for="x_BudgetEstimate" class="<?php echo $budget_actual_edit->LeftColumnClass ?>"><?php echo $budget_actual_edit->BudgetEstimate->caption() ?><?php echo $budget_actual_edit->BudgetEstimate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_actual_edit->RightColumnClass ?>"><div <?php echo $budget_actual_edit->BudgetEstimate->cellAttributes() ?>>
<span id="el_budget_actual_BudgetEstimate">
<input type="text" data-table="budget_actual" data-field="x_BudgetEstimate" name="x_BudgetEstimate" id="x_BudgetEstimate" size="30" placeholder="<?php echo HtmlEncode($budget_actual_edit->BudgetEstimate->getPlaceHolder()) ?>" value="<?php echo $budget_actual_edit->BudgetEstimate->EditValue ?>"<?php echo $budget_actual_edit->BudgetEstimate->editAttributes() ?>>
</span>
<?php echo $budget_actual_edit->BudgetEstimate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_actual_edit->ActualAmount->Visible) { // ActualAmount ?>
	<div id="r_ActualAmount" class="form-group row">
		<label id="elh_budget_actual_ActualAmount" for="x_ActualAmount" class="<?php echo $budget_actual_edit->LeftColumnClass ?>"><?php echo $budget_actual_edit->ActualAmount->caption() ?><?php echo $budget_actual_edit->ActualAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_actual_edit->RightColumnClass ?>"><div <?php echo $budget_actual_edit->ActualAmount->cellAttributes() ?>>
<span id="el_budget_actual_ActualAmount">
<input type="text" data-table="budget_actual" data-field="x_ActualAmount" name="x_ActualAmount" id="x_ActualAmount" size="30" placeholder="<?php echo HtmlEncode($budget_actual_edit->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $budget_actual_edit->ActualAmount->EditValue ?>"<?php echo $budget_actual_edit->ActualAmount->editAttributes() ?>>
</span>
<?php echo $budget_actual_edit->ActualAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_actual_edit->ForecastAmount->Visible) { // ForecastAmount ?>
	<div id="r_ForecastAmount" class="form-group row">
		<label id="elh_budget_actual_ForecastAmount" for="x_ForecastAmount" class="<?php echo $budget_actual_edit->LeftColumnClass ?>"><?php echo $budget_actual_edit->ForecastAmount->caption() ?><?php echo $budget_actual_edit->ForecastAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_actual_edit->RightColumnClass ?>"><div <?php echo $budget_actual_edit->ForecastAmount->cellAttributes() ?>>
<span id="el_budget_actual_ForecastAmount">
<input type="text" data-table="budget_actual" data-field="x_ForecastAmount" name="x_ForecastAmount" id="x_ForecastAmount" size="30" placeholder="<?php echo HtmlEncode($budget_actual_edit->ForecastAmount->getPlaceHolder()) ?>" value="<?php echo $budget_actual_edit->ForecastAmount->EditValue ?>"<?php echo $budget_actual_edit->ForecastAmount->editAttributes() ?>>
</span>
<?php echo $budget_actual_edit->ForecastAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$budget_actual_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $budget_actual_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $budget_actual_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$budget_actual_edit->IsModal) { ?>
<?php echo $budget_actual_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$budget_actual_edit->showPageFooter();
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
$budget_actual_edit->terminate();
?>