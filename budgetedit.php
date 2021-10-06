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
$budget_edit = new budget_edit();

// Run the page
$budget_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$budget_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbudgetedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fbudgetedit = currentForm = new ew.Form("fbudgetedit", "edit");

	// Validate form
	fbudgetedit.validate = function() {
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
			<?php if ($budget_edit->OutcomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_edit->OutcomeCode->caption(), $budget_edit->OutcomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_edit->OutputCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_edit->OutputCode->caption(), $budget_edit->OutputCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_edit->ActionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_edit->ActionCode->caption(), $budget_edit->ActionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_edit->DetailedActionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DetailedActionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_edit->DetailedActionCode->caption(), $budget_edit->DetailedActionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DetailedActionCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_edit->DetailedActionCode->errorMessage()) ?>");
			<?php if ($budget_edit->FinancialYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_edit->FinancialYear->caption(), $budget_edit->FinancialYear->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_edit->AccountCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_edit->AccountCode->caption(), $budget_edit->AccountCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_edit->MeansOfImplementation->Required) { ?>
				elm = this.getElements("x" + infix + "_MeansOfImplementation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_edit->MeansOfImplementation->caption(), $budget_edit->MeansOfImplementation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_edit->UnitOfMeasure->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitOfMeasure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_edit->UnitOfMeasure->caption(), $budget_edit->UnitOfMeasure->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_edit->Quantity->Required) { ?>
				elm = this.getElements("x" + infix + "_Quantity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_edit->Quantity->caption(), $budget_edit->Quantity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Quantity");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_edit->Quantity->errorMessage()) ?>");
			<?php if ($budget_edit->PeriodType->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_edit->PeriodType->caption(), $budget_edit->PeriodType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_edit->PeriodLength->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodLength");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_edit->PeriodLength->caption(), $budget_edit->PeriodLength->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_edit->Frequency->Required) { ?>
				elm = this.getElements("x" + infix + "_Frequency");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_edit->Frequency->caption(), $budget_edit->Frequency->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Frequency");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_edit->Frequency->errorMessage()) ?>");
			<?php if ($budget_edit->UnitCost->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitCost");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_edit->UnitCost->caption(), $budget_edit->UnitCost->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_UnitCost");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_edit->UnitCost->errorMessage()) ?>");
			<?php if ($budget_edit->BudgetEstimate->Required) { ?>
				elm = this.getElements("x" + infix + "_BudgetEstimate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_edit->BudgetEstimate->caption(), $budget_edit->BudgetEstimate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BudgetEstimate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_edit->BudgetEstimate->errorMessage()) ?>");
			<?php if ($budget_edit->ActualAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_edit->ActualAmount->caption(), $budget_edit->ActualAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_edit->ActualAmount->errorMessage()) ?>");
			<?php if ($budget_edit->Status->Required) { ?>
				elm = this.getElements("x" + infix + "_Status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_edit->Status->caption(), $budget_edit->Status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_edit->LACode->caption(), $budget_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_edit->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_edit->DepartmentCode->caption(), $budget_edit->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_edit->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_edit->SectionCode->caption(), $budget_edit->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_edit->BudgetLine->Required) { ?>
				elm = this.getElements("x" + infix + "_BudgetLine");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_edit->BudgetLine->caption(), $budget_edit->BudgetLine->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_edit->ProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_edit->ProgramCode->caption(), $budget_edit->ProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_edit->SubProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SubProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_edit->SubProgramCode->caption(), $budget_edit->SubProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_edit->ApprovedBudget->Required) { ?>
				elm = this.getElements("x" + infix + "_ApprovedBudget");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_edit->ApprovedBudget->caption(), $budget_edit->ApprovedBudget->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ApprovedBudget");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_edit->ApprovedBudget->errorMessage()) ?>");

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
	fbudgetedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbudgetedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbudgetedit.lists["x_OutcomeCode"] = <?php echo $budget_edit->OutcomeCode->Lookup->toClientList($budget_edit) ?>;
	fbudgetedit.lists["x_OutcomeCode"].options = <?php echo JsonEncode($budget_edit->OutcomeCode->lookupOptions()) ?>;
	fbudgetedit.lists["x_OutputCode"] = <?php echo $budget_edit->OutputCode->Lookup->toClientList($budget_edit) ?>;
	fbudgetedit.lists["x_OutputCode"].options = <?php echo JsonEncode($budget_edit->OutputCode->lookupOptions()) ?>;
	fbudgetedit.lists["x_ActionCode"] = <?php echo $budget_edit->ActionCode->Lookup->toClientList($budget_edit) ?>;
	fbudgetedit.lists["x_ActionCode"].options = <?php echo JsonEncode($budget_edit->ActionCode->lookupOptions()) ?>;
	fbudgetedit.lists["x_DetailedActionCode"] = <?php echo $budget_edit->DetailedActionCode->Lookup->toClientList($budget_edit) ?>;
	fbudgetedit.lists["x_DetailedActionCode"].options = <?php echo JsonEncode($budget_edit->DetailedActionCode->lookupOptions()) ?>;
	fbudgetedit.autoSuggests["x_DetailedActionCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fbudgetedit.lists["x_FinancialYear"] = <?php echo $budget_edit->FinancialYear->Lookup->toClientList($budget_edit) ?>;
	fbudgetedit.lists["x_FinancialYear"].options = <?php echo JsonEncode($budget_edit->FinancialYear->lookupOptions()) ?>;
	fbudgetedit.lists["x_AccountCode"] = <?php echo $budget_edit->AccountCode->Lookup->toClientList($budget_edit) ?>;
	fbudgetedit.lists["x_AccountCode"].options = <?php echo JsonEncode($budget_edit->AccountCode->lookupOptions()) ?>;
	fbudgetedit.lists["x_MeansOfImplementation"] = <?php echo $budget_edit->MeansOfImplementation->Lookup->toClientList($budget_edit) ?>;
	fbudgetedit.lists["x_MeansOfImplementation"].options = <?php echo JsonEncode($budget_edit->MeansOfImplementation->lookupOptions()) ?>;
	fbudgetedit.lists["x_UnitOfMeasure"] = <?php echo $budget_edit->UnitOfMeasure->Lookup->toClientList($budget_edit) ?>;
	fbudgetedit.lists["x_UnitOfMeasure"].options = <?php echo JsonEncode($budget_edit->UnitOfMeasure->lookupOptions()) ?>;
	fbudgetedit.lists["x_PeriodType"] = <?php echo $budget_edit->PeriodType->Lookup->toClientList($budget_edit) ?>;
	fbudgetedit.lists["x_PeriodType"].options = <?php echo JsonEncode($budget_edit->PeriodType->lookupOptions()) ?>;
	fbudgetedit.lists["x_Status"] = <?php echo $budget_edit->Status->Lookup->toClientList($budget_edit) ?>;
	fbudgetedit.lists["x_Status"].options = <?php echo JsonEncode($budget_edit->Status->lookupOptions()) ?>;
	fbudgetedit.autoSuggests["x_Status"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fbudgetedit.lists["x_LACode"] = <?php echo $budget_edit->LACode->Lookup->toClientList($budget_edit) ?>;
	fbudgetedit.lists["x_LACode"].options = <?php echo JsonEncode($budget_edit->LACode->lookupOptions()) ?>;
	fbudgetedit.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fbudgetedit.lists["x_DepartmentCode"] = <?php echo $budget_edit->DepartmentCode->Lookup->toClientList($budget_edit) ?>;
	fbudgetedit.lists["x_DepartmentCode"].options = <?php echo JsonEncode($budget_edit->DepartmentCode->lookupOptions()) ?>;
	fbudgetedit.lists["x_SectionCode"] = <?php echo $budget_edit->SectionCode->Lookup->toClientList($budget_edit) ?>;
	fbudgetedit.lists["x_SectionCode"].options = <?php echo JsonEncode($budget_edit->SectionCode->lookupOptions()) ?>;
	fbudgetedit.lists["x_ProgramCode"] = <?php echo $budget_edit->ProgramCode->Lookup->toClientList($budget_edit) ?>;
	fbudgetedit.lists["x_ProgramCode"].options = <?php echo JsonEncode($budget_edit->ProgramCode->lookupOptions()) ?>;
	fbudgetedit.lists["x_SubProgramCode"] = <?php echo $budget_edit->SubProgramCode->Lookup->toClientList($budget_edit) ?>;
	fbudgetedit.lists["x_SubProgramCode"].options = <?php echo JsonEncode($budget_edit->SubProgramCode->lookupOptions()) ?>;
	loadjs.done("fbudgetedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $budget_edit->showPageHeader(); ?>
<?php
$budget_edit->showMessage();
?>
<?php if (!$budget_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $budget_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fbudgetedit" id="fbudgetedit" class="<?php echo $budget_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="budget">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$budget_edit->IsModal ?>">
<?php if ($budget->getCurrentMasterTable() == "detailed_action") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="detailed_action">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($budget_edit->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($budget_edit->DepartmentCode->getSessionValue()) ?>">
<input type="hidden" name="fk_FinancialYear" value="<?php echo HtmlEncode($budget_edit->FinancialYear->getSessionValue()) ?>">
<input type="hidden" name="fk_ActionCode" value="<?php echo HtmlEncode($budget_edit->ActionCode->getSessionValue()) ?>">
<input type="hidden" name="fk_OutcomeCode" value="<?php echo HtmlEncode($budget_edit->OutcomeCode->getSessionValue()) ?>">
<input type="hidden" name="fk_OutputCode" value="<?php echo HtmlEncode($budget_edit->OutputCode->getSessionValue()) ?>">
<input type="hidden" name="fk_DetailedActionCode" value="<?php echo HtmlEncode($budget_edit->DetailedActionCode->getSessionValue()) ?>">
<input type="hidden" name="fk_ProgramCode" value="<?php echo HtmlEncode($budget_edit->ProgramCode->getSessionValue()) ?>">
<input type="hidden" name="fk_SubProgramCode" value="<?php echo HtmlEncode($budget_edit->SubProgramCode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($budget_edit->OutcomeCode->Visible) { // OutcomeCode ?>
	<div id="r_OutcomeCode" class="form-group row">
		<label id="elh_budget_OutcomeCode" for="x_OutcomeCode" class="<?php echo $budget_edit->LeftColumnClass ?>"><?php echo $budget_edit->OutcomeCode->caption() ?><?php echo $budget_edit->OutcomeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_edit->RightColumnClass ?>"><div <?php echo $budget_edit->OutcomeCode->cellAttributes() ?>>
<?php if ($budget_edit->OutcomeCode->getSessionValue() != "") { ?>
<span id="el_budget_OutcomeCode">
<span<?php echo $budget_edit->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_edit->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_OutcomeCode" name="x_OutcomeCode" value="<?php echo HtmlEncode($budget_edit->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_budget_OutcomeCode">
<?php $budget_edit->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_OutcomeCode"><?php echo EmptyValue(strval($budget_edit->OutcomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_edit->OutcomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_edit->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_edit->OutcomeCode->ReadOnly || $budget_edit->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_edit->OutcomeCode->Lookup->getParamTag($budget_edit, "p_x_OutcomeCode") ?>
<input type="hidden" data-table="budget" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_edit->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x_OutcomeCode" id="x_OutcomeCode" value="<?php echo $budget_edit->OutcomeCode->CurrentValue ?>"<?php echo $budget_edit->OutcomeCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $budget_edit->OutcomeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_edit->OutputCode->Visible) { // OutputCode ?>
	<div id="r_OutputCode" class="form-group row">
		<label id="elh_budget_OutputCode" for="x_OutputCode" class="<?php echo $budget_edit->LeftColumnClass ?>"><?php echo $budget_edit->OutputCode->caption() ?><?php echo $budget_edit->OutputCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_edit->RightColumnClass ?>"><div <?php echo $budget_edit->OutputCode->cellAttributes() ?>>
<?php if ($budget_edit->OutputCode->getSessionValue() != "") { ?>
<span id="el_budget_OutputCode">
<span<?php echo $budget_edit->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_edit->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_OutputCode" name="x_OutputCode" value="<?php echo HtmlEncode($budget_edit->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_budget_OutputCode">
<?php $budget_edit->OutputCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_OutputCode"><?php echo EmptyValue(strval($budget_edit->OutputCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_edit->OutputCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_edit->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_edit->OutputCode->ReadOnly || $budget_edit->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_edit->OutputCode->Lookup->getParamTag($budget_edit, "p_x_OutputCode") ?>
<input type="hidden" data-table="budget" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_edit->OutputCode->displayValueSeparatorAttribute() ?>" name="x_OutputCode" id="x_OutputCode" value="<?php echo $budget_edit->OutputCode->CurrentValue ?>"<?php echo $budget_edit->OutputCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $budget_edit->OutputCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_edit->ActionCode->Visible) { // ActionCode ?>
	<div id="r_ActionCode" class="form-group row">
		<label id="elh_budget_ActionCode" for="x_ActionCode" class="<?php echo $budget_edit->LeftColumnClass ?>"><?php echo $budget_edit->ActionCode->caption() ?><?php echo $budget_edit->ActionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_edit->RightColumnClass ?>"><div <?php echo $budget_edit->ActionCode->cellAttributes() ?>>
<?php if ($budget_edit->ActionCode->getSessionValue() != "") { ?>
<span id="el_budget_ActionCode">
<span<?php echo $budget_edit->ActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_edit->ActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ActionCode" name="x_ActionCode" value="<?php echo HtmlEncode($budget_edit->ActionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_budget_ActionCode">
<?php $budget_edit->ActionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_ActionCode" data-value-separator="<?php echo $budget_edit->ActionCode->displayValueSeparatorAttribute() ?>" id="x_ActionCode" name="x_ActionCode"<?php echo $budget_edit->ActionCode->editAttributes() ?>>
			<?php echo $budget_edit->ActionCode->selectOptionListHtml("x_ActionCode") ?>
		</select>
</div>
<?php echo $budget_edit->ActionCode->Lookup->getParamTag($budget_edit, "p_x_ActionCode") ?>
</span>
<?php } ?>
<?php echo $budget_edit->ActionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_edit->DetailedActionCode->Visible) { // DetailedActionCode ?>
	<div id="r_DetailedActionCode" class="form-group row">
		<label id="elh_budget_DetailedActionCode" class="<?php echo $budget_edit->LeftColumnClass ?>"><?php echo $budget_edit->DetailedActionCode->caption() ?><?php echo $budget_edit->DetailedActionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_edit->RightColumnClass ?>"><div <?php echo $budget_edit->DetailedActionCode->cellAttributes() ?>>
<?php if ($budget_edit->DetailedActionCode->getSessionValue() != "") { ?>
<span id="el_budget_DetailedActionCode">
<span<?php echo $budget_edit->DetailedActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_edit->DetailedActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_DetailedActionCode" name="x_DetailedActionCode" value="<?php echo HtmlEncode($budget_edit->DetailedActionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_budget_DetailedActionCode">
<?php
$onchange = $budget_edit->DetailedActionCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_edit->DetailedActionCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_DetailedActionCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_DetailedActionCode" id="sv_x_DetailedActionCode" value="<?php echo RemoveHtml($budget_edit->DetailedActionCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($budget_edit->DetailedActionCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_edit->DetailedActionCode->getPlaceHolder()) ?>"<?php echo $budget_edit->DetailedActionCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_edit->DetailedActionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_DetailedActionCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($budget_edit->DetailedActionCode->ReadOnly || $budget_edit->DetailedActionCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="budget" data-field="x_DetailedActionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_edit->DetailedActionCode->displayValueSeparatorAttribute() ?>" name="x_DetailedActionCode" id="x_DetailedActionCode" value="<?php echo HtmlEncode($budget_edit->DetailedActionCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudgetedit"], function() {
	fbudgetedit.createAutoSuggest({"id":"x_DetailedActionCode","forceSelect":false});
});
</script>
<?php echo $budget_edit->DetailedActionCode->Lookup->getParamTag($budget_edit, "p_x_DetailedActionCode") ?>
</span>
<?php } ?>
<?php echo $budget_edit->DetailedActionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_edit->FinancialYear->Visible) { // FinancialYear ?>
	<div id="r_FinancialYear" class="form-group row">
		<label id="elh_budget_FinancialYear" for="x_FinancialYear" class="<?php echo $budget_edit->LeftColumnClass ?>"><?php echo $budget_edit->FinancialYear->caption() ?><?php echo $budget_edit->FinancialYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_edit->RightColumnClass ?>"><div <?php echo $budget_edit->FinancialYear->cellAttributes() ?>>
<?php if ($budget_edit->FinancialYear->getSessionValue() != "") { ?>
<span id="el_budget_FinancialYear">
<span<?php echo $budget_edit->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_edit->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_FinancialYear" name="x_FinancialYear" value="<?php echo HtmlEncode($budget_edit->FinancialYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el_budget_FinancialYear">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_FinancialYear" data-value-separator="<?php echo $budget_edit->FinancialYear->displayValueSeparatorAttribute() ?>" id="x_FinancialYear" name="x_FinancialYear"<?php echo $budget_edit->FinancialYear->editAttributes() ?>>
			<?php echo $budget_edit->FinancialYear->selectOptionListHtml("x_FinancialYear") ?>
		</select>
</div>
<?php echo $budget_edit->FinancialYear->Lookup->getParamTag($budget_edit, "p_x_FinancialYear") ?>
</span>
<?php } ?>
<?php echo $budget_edit->FinancialYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_edit->AccountCode->Visible) { // AccountCode ?>
	<div id="r_AccountCode" class="form-group row">
		<label id="elh_budget_AccountCode" for="x_AccountCode" class="<?php echo $budget_edit->LeftColumnClass ?>"><?php echo $budget_edit->AccountCode->caption() ?><?php echo $budget_edit->AccountCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_edit->RightColumnClass ?>"><div <?php echo $budget_edit->AccountCode->cellAttributes() ?>>
<span id="el_budget_AccountCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_AccountCode"><?php echo EmptyValue(strval($budget_edit->AccountCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_edit->AccountCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_edit->AccountCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_edit->AccountCode->ReadOnly || $budget_edit->AccountCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_AccountCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_edit->AccountCode->Lookup->getParamTag($budget_edit, "p_x_AccountCode") ?>
<input type="hidden" data-table="budget" data-field="x_AccountCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_edit->AccountCode->displayValueSeparatorAttribute() ?>" name="x_AccountCode" id="x_AccountCode" value="<?php echo $budget_edit->AccountCode->CurrentValue ?>"<?php echo $budget_edit->AccountCode->editAttributes() ?>>
</span>
<?php echo $budget_edit->AccountCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_edit->MeansOfImplementation->Visible) { // MeansOfImplementation ?>
	<div id="r_MeansOfImplementation" class="form-group row">
		<label id="elh_budget_MeansOfImplementation" for="x_MeansOfImplementation" class="<?php echo $budget_edit->LeftColumnClass ?>"><?php echo $budget_edit->MeansOfImplementation->caption() ?><?php echo $budget_edit->MeansOfImplementation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_edit->RightColumnClass ?>"><div <?php echo $budget_edit->MeansOfImplementation->cellAttributes() ?>>
<span id="el_budget_MeansOfImplementation">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_MeansOfImplementation"><?php echo EmptyValue(strval($budget_edit->MeansOfImplementation->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_edit->MeansOfImplementation->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_edit->MeansOfImplementation->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_edit->MeansOfImplementation->ReadOnly || $budget_edit->MeansOfImplementation->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_MeansOfImplementation',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_edit->MeansOfImplementation->Lookup->getParamTag($budget_edit, "p_x_MeansOfImplementation") ?>
<input type="hidden" data-table="budget" data-field="x_MeansOfImplementation" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_edit->MeansOfImplementation->displayValueSeparatorAttribute() ?>" name="x_MeansOfImplementation" id="x_MeansOfImplementation" value="<?php echo $budget_edit->MeansOfImplementation->CurrentValue ?>"<?php echo $budget_edit->MeansOfImplementation->editAttributes() ?>>
</span>
<?php echo $budget_edit->MeansOfImplementation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_edit->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<div id="r_UnitOfMeasure" class="form-group row">
		<label id="elh_budget_UnitOfMeasure" for="x_UnitOfMeasure" class="<?php echo $budget_edit->LeftColumnClass ?>"><?php echo $budget_edit->UnitOfMeasure->caption() ?><?php echo $budget_edit->UnitOfMeasure->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_edit->RightColumnClass ?>"><div <?php echo $budget_edit->UnitOfMeasure->cellAttributes() ?>>
<span id="el_budget_UnitOfMeasure">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_UnitOfMeasure" data-value-separator="<?php echo $budget_edit->UnitOfMeasure->displayValueSeparatorAttribute() ?>" id="x_UnitOfMeasure" name="x_UnitOfMeasure"<?php echo $budget_edit->UnitOfMeasure->editAttributes() ?>>
			<?php echo $budget_edit->UnitOfMeasure->selectOptionListHtml("x_UnitOfMeasure") ?>
		</select>
</div>
<?php echo $budget_edit->UnitOfMeasure->Lookup->getParamTag($budget_edit, "p_x_UnitOfMeasure") ?>
</span>
<?php echo $budget_edit->UnitOfMeasure->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_edit->Quantity->Visible) { // Quantity ?>
	<div id="r_Quantity" class="form-group row">
		<label id="elh_budget_Quantity" for="x_Quantity" class="<?php echo $budget_edit->LeftColumnClass ?>"><?php echo $budget_edit->Quantity->caption() ?><?php echo $budget_edit->Quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_edit->RightColumnClass ?>"><div <?php echo $budget_edit->Quantity->cellAttributes() ?>>
<span id="el_budget_Quantity">
<input type="text" data-table="budget" data-field="x_Quantity" name="x_Quantity" id="x_Quantity" size="30" placeholder="<?php echo HtmlEncode($budget_edit->Quantity->getPlaceHolder()) ?>" value="<?php echo $budget_edit->Quantity->EditValue ?>"<?php echo $budget_edit->Quantity->editAttributes() ?>>
</span>
<?php echo $budget_edit->Quantity->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_edit->PeriodType->Visible) { // PeriodType ?>
	<div id="r_PeriodType" class="form-group row">
		<label id="elh_budget_PeriodType" for="x_PeriodType" class="<?php echo $budget_edit->LeftColumnClass ?>"><?php echo $budget_edit->PeriodType->caption() ?><?php echo $budget_edit->PeriodType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_edit->RightColumnClass ?>"><div <?php echo $budget_edit->PeriodType->cellAttributes() ?>>
<span id="el_budget_PeriodType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_PeriodType" data-value-separator="<?php echo $budget_edit->PeriodType->displayValueSeparatorAttribute() ?>" id="x_PeriodType" name="x_PeriodType"<?php echo $budget_edit->PeriodType->editAttributes() ?>>
			<?php echo $budget_edit->PeriodType->selectOptionListHtml("x_PeriodType") ?>
		</select>
</div>
<?php echo $budget_edit->PeriodType->Lookup->getParamTag($budget_edit, "p_x_PeriodType") ?>
</span>
<?php echo $budget_edit->PeriodType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_edit->PeriodLength->Visible) { // PeriodLength ?>
	<div id="r_PeriodLength" class="form-group row">
		<label id="elh_budget_PeriodLength" for="x_PeriodLength" class="<?php echo $budget_edit->LeftColumnClass ?>"><?php echo $budget_edit->PeriodLength->caption() ?><?php echo $budget_edit->PeriodLength->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_edit->RightColumnClass ?>"><div <?php echo $budget_edit->PeriodLength->cellAttributes() ?>>
<span id="el_budget_PeriodLength">
<input type="text" data-table="budget" data-field="x_PeriodLength" name="x_PeriodLength" id="x_PeriodLength" size="30" placeholder="<?php echo HtmlEncode($budget_edit->PeriodLength->getPlaceHolder()) ?>" value="<?php echo $budget_edit->PeriodLength->EditValue ?>"<?php echo $budget_edit->PeriodLength->editAttributes() ?>>
</span>
<?php echo $budget_edit->PeriodLength->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_edit->Frequency->Visible) { // Frequency ?>
	<div id="r_Frequency" class="form-group row">
		<label id="elh_budget_Frequency" for="x_Frequency" class="<?php echo $budget_edit->LeftColumnClass ?>"><?php echo $budget_edit->Frequency->caption() ?><?php echo $budget_edit->Frequency->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_edit->RightColumnClass ?>"><div <?php echo $budget_edit->Frequency->cellAttributes() ?>>
<span id="el_budget_Frequency">
<input type="text" data-table="budget" data-field="x_Frequency" name="x_Frequency" id="x_Frequency" size="30" placeholder="<?php echo HtmlEncode($budget_edit->Frequency->getPlaceHolder()) ?>" value="<?php echo $budget_edit->Frequency->EditValue ?>"<?php echo $budget_edit->Frequency->editAttributes() ?>>
</span>
<?php echo $budget_edit->Frequency->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_edit->UnitCost->Visible) { // UnitCost ?>
	<div id="r_UnitCost" class="form-group row">
		<label id="elh_budget_UnitCost" for="x_UnitCost" class="<?php echo $budget_edit->LeftColumnClass ?>"><?php echo $budget_edit->UnitCost->caption() ?><?php echo $budget_edit->UnitCost->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_edit->RightColumnClass ?>"><div <?php echo $budget_edit->UnitCost->cellAttributes() ?>>
<span id="el_budget_UnitCost">
<input type="text" data-table="budget" data-field="x_UnitCost" name="x_UnitCost" id="x_UnitCost" size="30" placeholder="<?php echo HtmlEncode($budget_edit->UnitCost->getPlaceHolder()) ?>" value="<?php echo $budget_edit->UnitCost->EditValue ?>"<?php echo $budget_edit->UnitCost->editAttributes() ?>>
</span>
<?php echo $budget_edit->UnitCost->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_edit->BudgetEstimate->Visible) { // BudgetEstimate ?>
	<div id="r_BudgetEstimate" class="form-group row">
		<label id="elh_budget_BudgetEstimate" for="x_BudgetEstimate" class="<?php echo $budget_edit->LeftColumnClass ?>"><?php echo $budget_edit->BudgetEstimate->caption() ?><?php echo $budget_edit->BudgetEstimate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_edit->RightColumnClass ?>"><div <?php echo $budget_edit->BudgetEstimate->cellAttributes() ?>>
<span id="el_budget_BudgetEstimate">
<input type="text" data-table="budget" data-field="x_BudgetEstimate" name="x_BudgetEstimate" id="x_BudgetEstimate" size="30" placeholder="<?php echo HtmlEncode($budget_edit->BudgetEstimate->getPlaceHolder()) ?>" value="<?php echo $budget_edit->BudgetEstimate->EditValue ?>"<?php echo $budget_edit->BudgetEstimate->editAttributes() ?>>
</span>
<?php echo $budget_edit->BudgetEstimate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_edit->ActualAmount->Visible) { // ActualAmount ?>
	<div id="r_ActualAmount" class="form-group row">
		<label id="elh_budget_ActualAmount" for="x_ActualAmount" class="<?php echo $budget_edit->LeftColumnClass ?>"><?php echo $budget_edit->ActualAmount->caption() ?><?php echo $budget_edit->ActualAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_edit->RightColumnClass ?>"><div <?php echo $budget_edit->ActualAmount->cellAttributes() ?>>
<span id="el_budget_ActualAmount">
<input type="text" data-table="budget" data-field="x_ActualAmount" name="x_ActualAmount" id="x_ActualAmount" size="30" placeholder="<?php echo HtmlEncode($budget_edit->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $budget_edit->ActualAmount->EditValue ?>"<?php echo $budget_edit->ActualAmount->editAttributes() ?>>
</span>
<?php echo $budget_edit->ActualAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_edit->Status->Visible) { // Status ?>
	<div id="r_Status" class="form-group row">
		<label id="elh_budget_Status" class="<?php echo $budget_edit->LeftColumnClass ?>"><?php echo $budget_edit->Status->caption() ?><?php echo $budget_edit->Status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_edit->RightColumnClass ?>"><div <?php echo $budget_edit->Status->cellAttributes() ?>>
<span id="el_budget_Status">
<?php
$onchange = $budget_edit->Status->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_edit->Status->EditAttrs["onchange"] = "";
?>
<span id="as_x_Status">
	<input type="text" class="form-control" name="sv_x_Status" id="sv_x_Status" value="<?php echo RemoveHtml($budget_edit->Status->EditValue) ?>" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($budget_edit->Status->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_edit->Status->getPlaceHolder()) ?>"<?php echo $budget_edit->Status->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget" data-field="x_Status" data-value-separator="<?php echo $budget_edit->Status->displayValueSeparatorAttribute() ?>" name="x_Status" id="x_Status" value="<?php echo HtmlEncode($budget_edit->Status->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudgetedit"], function() {
	fbudgetedit.createAutoSuggest({"id":"x_Status","forceSelect":false});
});
</script>
<?php echo $budget_edit->Status->Lookup->getParamTag($budget_edit, "p_x_Status") ?>
</span>
<?php echo $budget_edit->Status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_budget_LACode" class="<?php echo $budget_edit->LeftColumnClass ?>"><?php echo $budget_edit->LACode->caption() ?><?php echo $budget_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_edit->RightColumnClass ?>"><div <?php echo $budget_edit->LACode->cellAttributes() ?>>
<?php if ($budget_edit->LACode->getSessionValue() != "") { ?>
<span id="el_budget_LACode">
<span<?php echo $budget_edit->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_edit->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($budget_edit->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_budget_LACode">
<?php
$onchange = $budget_edit->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_edit->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($budget_edit->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($budget_edit->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_edit->LACode->getPlaceHolder()) ?>"<?php echo $budget_edit->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_edit->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($budget_edit->LACode->ReadOnly || $budget_edit->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="budget" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_edit->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($budget_edit->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudgetedit"], function() {
	fbudgetedit.createAutoSuggest({"id":"x_LACode","forceSelect":false});
});
</script>
<?php echo $budget_edit->LACode->Lookup->getParamTag($budget_edit, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $budget_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_edit->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_budget_DepartmentCode" for="x_DepartmentCode" class="<?php echo $budget_edit->LeftColumnClass ?>"><?php echo $budget_edit->DepartmentCode->caption() ?><?php echo $budget_edit->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_edit->RightColumnClass ?>"><div <?php echo $budget_edit->DepartmentCode->cellAttributes() ?>>
<?php if ($budget_edit->DepartmentCode->getSessionValue() != "") { ?>
<span id="el_budget_DepartmentCode">
<span<?php echo $budget_edit->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_edit->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_DepartmentCode" name="x_DepartmentCode" value="<?php echo HtmlEncode($budget_edit->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_budget_DepartmentCode">
<?php $budget_edit->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_DepartmentCode" data-value-separator="<?php echo $budget_edit->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $budget_edit->DepartmentCode->editAttributes() ?>>
			<?php echo $budget_edit->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $budget_edit->DepartmentCode->Lookup->getParamTag($budget_edit, "p_x_DepartmentCode") ?>
</span>
<?php } ?>
<?php echo $budget_edit->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_edit->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_budget_SectionCode" for="x_SectionCode" class="<?php echo $budget_edit->LeftColumnClass ?>"><?php echo $budget_edit->SectionCode->caption() ?><?php echo $budget_edit->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_edit->RightColumnClass ?>"><div <?php echo $budget_edit->SectionCode->cellAttributes() ?>>
<span id="el_budget_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_SectionCode" data-value-separator="<?php echo $budget_edit->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $budget_edit->SectionCode->editAttributes() ?>>
			<?php echo $budget_edit->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $budget_edit->SectionCode->Lookup->getParamTag($budget_edit, "p_x_SectionCode") ?>
</span>
<?php echo $budget_edit->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_edit->BudgetLine->Visible) { // BudgetLine ?>
	<div id="r_BudgetLine" class="form-group row">
		<label id="elh_budget_BudgetLine" class="<?php echo $budget_edit->LeftColumnClass ?>"><?php echo $budget_edit->BudgetLine->caption() ?><?php echo $budget_edit->BudgetLine->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_edit->RightColumnClass ?>"><div <?php echo $budget_edit->BudgetLine->cellAttributes() ?>>
<span id="el_budget_BudgetLine">
<span<?php echo $budget_edit->BudgetLine->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_edit->BudgetLine->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget" data-field="x_BudgetLine" name="x_BudgetLine" id="x_BudgetLine" value="<?php echo HtmlEncode($budget_edit->BudgetLine->CurrentValue) ?>">
<?php echo $budget_edit->BudgetLine->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_edit->ProgramCode->Visible) { // ProgramCode ?>
	<div id="r_ProgramCode" class="form-group row">
		<label id="elh_budget_ProgramCode" for="x_ProgramCode" class="<?php echo $budget_edit->LeftColumnClass ?>"><?php echo $budget_edit->ProgramCode->caption() ?><?php echo $budget_edit->ProgramCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_edit->RightColumnClass ?>"><div <?php echo $budget_edit->ProgramCode->cellAttributes() ?>>
<?php if ($budget_edit->ProgramCode->getSessionValue() != "") { ?>
<span id="el_budget_ProgramCode">
<span<?php echo $budget_edit->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_edit->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProgramCode" name="x_ProgramCode" value="<?php echo HtmlEncode($budget_edit->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_budget_ProgramCode">
<?php $budget_edit->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ProgramCode"><?php echo EmptyValue(strval($budget_edit->ProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_edit->ProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_edit->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_edit->ProgramCode->ReadOnly || $budget_edit->ProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_edit->ProgramCode->Lookup->getParamTag($budget_edit, "p_x_ProgramCode") ?>
<input type="hidden" data-table="budget" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_edit->ProgramCode->displayValueSeparatorAttribute() ?>" name="x_ProgramCode" id="x_ProgramCode" value="<?php echo $budget_edit->ProgramCode->CurrentValue ?>"<?php echo $budget_edit->ProgramCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $budget_edit->ProgramCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_edit->SubProgramCode->Visible) { // SubProgramCode ?>
	<div id="r_SubProgramCode" class="form-group row">
		<label id="elh_budget_SubProgramCode" for="x_SubProgramCode" class="<?php echo $budget_edit->LeftColumnClass ?>"><?php echo $budget_edit->SubProgramCode->caption() ?><?php echo $budget_edit->SubProgramCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_edit->RightColumnClass ?>"><div <?php echo $budget_edit->SubProgramCode->cellAttributes() ?>>
<?php if ($budget_edit->SubProgramCode->getSessionValue() != "") { ?>
<span id="el_budget_SubProgramCode">
<span<?php echo $budget_edit->SubProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_edit->SubProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_SubProgramCode" name="x_SubProgramCode" value="<?php echo HtmlEncode($budget_edit->SubProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_budget_SubProgramCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_SubProgramCode"><?php echo EmptyValue(strval($budget_edit->SubProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_edit->SubProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_edit->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_edit->SubProgramCode->ReadOnly || $budget_edit->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_edit->SubProgramCode->Lookup->getParamTag($budget_edit, "p_x_SubProgramCode") ?>
<input type="hidden" data-table="budget" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_edit->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x_SubProgramCode" id="x_SubProgramCode" value="<?php echo $budget_edit->SubProgramCode->CurrentValue ?>"<?php echo $budget_edit->SubProgramCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $budget_edit->SubProgramCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_edit->ApprovedBudget->Visible) { // ApprovedBudget ?>
	<div id="r_ApprovedBudget" class="form-group row">
		<label id="elh_budget_ApprovedBudget" for="x_ApprovedBudget" class="<?php echo $budget_edit->LeftColumnClass ?>"><?php echo $budget_edit->ApprovedBudget->caption() ?><?php echo $budget_edit->ApprovedBudget->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_edit->RightColumnClass ?>"><div <?php echo $budget_edit->ApprovedBudget->cellAttributes() ?>>
<span id="el_budget_ApprovedBudget">
<input type="text" data-table="budget" data-field="x_ApprovedBudget" name="x_ApprovedBudget" id="x_ApprovedBudget" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($budget_edit->ApprovedBudget->getPlaceHolder()) ?>" value="<?php echo $budget_edit->ApprovedBudget->EditValue ?>"<?php echo $budget_edit->ApprovedBudget->editAttributes() ?>>
</span>
<?php echo $budget_edit->ApprovedBudget->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$budget_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $budget_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $budget_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$budget_edit->IsModal) { ?>
<?php echo $budget_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$budget_edit->showPageFooter();
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
$budget_edit->terminate();
?>