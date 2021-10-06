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
$budget_add = new budget_add();

// Run the page
$budget_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$budget_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbudgetadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fbudgetadd = currentForm = new ew.Form("fbudgetadd", "add");

	// Validate form
	fbudgetadd.validate = function() {
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
			<?php if ($budget_add->OutcomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_add->OutcomeCode->caption(), $budget_add->OutcomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_add->OutputCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_add->OutputCode->caption(), $budget_add->OutputCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_add->ActionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_add->ActionCode->caption(), $budget_add->ActionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_add->DetailedActionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DetailedActionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_add->DetailedActionCode->caption(), $budget_add->DetailedActionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DetailedActionCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_add->DetailedActionCode->errorMessage()) ?>");
			<?php if ($budget_add->FinancialYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_add->FinancialYear->caption(), $budget_add->FinancialYear->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_add->AccountCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_add->AccountCode->caption(), $budget_add->AccountCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_add->MeansOfImplementation->Required) { ?>
				elm = this.getElements("x" + infix + "_MeansOfImplementation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_add->MeansOfImplementation->caption(), $budget_add->MeansOfImplementation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_add->UnitOfMeasure->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitOfMeasure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_add->UnitOfMeasure->caption(), $budget_add->UnitOfMeasure->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_add->Quantity->Required) { ?>
				elm = this.getElements("x" + infix + "_Quantity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_add->Quantity->caption(), $budget_add->Quantity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Quantity");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_add->Quantity->errorMessage()) ?>");
			<?php if ($budget_add->PeriodType->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_add->PeriodType->caption(), $budget_add->PeriodType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_add->PeriodLength->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodLength");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_add->PeriodLength->caption(), $budget_add->PeriodLength->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_add->Frequency->Required) { ?>
				elm = this.getElements("x" + infix + "_Frequency");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_add->Frequency->caption(), $budget_add->Frequency->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Frequency");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_add->Frequency->errorMessage()) ?>");
			<?php if ($budget_add->UnitCost->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitCost");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_add->UnitCost->caption(), $budget_add->UnitCost->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_UnitCost");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_add->UnitCost->errorMessage()) ?>");
			<?php if ($budget_add->BudgetEstimate->Required) { ?>
				elm = this.getElements("x" + infix + "_BudgetEstimate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_add->BudgetEstimate->caption(), $budget_add->BudgetEstimate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BudgetEstimate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_add->BudgetEstimate->errorMessage()) ?>");
			<?php if ($budget_add->ActualAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_add->ActualAmount->caption(), $budget_add->ActualAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_add->ActualAmount->errorMessage()) ?>");
			<?php if ($budget_add->Status->Required) { ?>
				elm = this.getElements("x" + infix + "_Status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_add->Status->caption(), $budget_add->Status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_add->LACode->caption(), $budget_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_add->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_add->DepartmentCode->caption(), $budget_add->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_add->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_add->SectionCode->caption(), $budget_add->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_add->ProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_add->ProgramCode->caption(), $budget_add->ProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_add->SubProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SubProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_add->SubProgramCode->caption(), $budget_add->SubProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_add->ApprovedBudget->Required) { ?>
				elm = this.getElements("x" + infix + "_ApprovedBudget");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_add->ApprovedBudget->caption(), $budget_add->ApprovedBudget->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ApprovedBudget");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_add->ApprovedBudget->errorMessage()) ?>");

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
	fbudgetadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbudgetadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbudgetadd.lists["x_OutcomeCode"] = <?php echo $budget_add->OutcomeCode->Lookup->toClientList($budget_add) ?>;
	fbudgetadd.lists["x_OutcomeCode"].options = <?php echo JsonEncode($budget_add->OutcomeCode->lookupOptions()) ?>;
	fbudgetadd.lists["x_OutputCode"] = <?php echo $budget_add->OutputCode->Lookup->toClientList($budget_add) ?>;
	fbudgetadd.lists["x_OutputCode"].options = <?php echo JsonEncode($budget_add->OutputCode->lookupOptions()) ?>;
	fbudgetadd.lists["x_ActionCode"] = <?php echo $budget_add->ActionCode->Lookup->toClientList($budget_add) ?>;
	fbudgetadd.lists["x_ActionCode"].options = <?php echo JsonEncode($budget_add->ActionCode->lookupOptions()) ?>;
	fbudgetadd.lists["x_DetailedActionCode"] = <?php echo $budget_add->DetailedActionCode->Lookup->toClientList($budget_add) ?>;
	fbudgetadd.lists["x_DetailedActionCode"].options = <?php echo JsonEncode($budget_add->DetailedActionCode->lookupOptions()) ?>;
	fbudgetadd.autoSuggests["x_DetailedActionCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fbudgetadd.lists["x_FinancialYear"] = <?php echo $budget_add->FinancialYear->Lookup->toClientList($budget_add) ?>;
	fbudgetadd.lists["x_FinancialYear"].options = <?php echo JsonEncode($budget_add->FinancialYear->lookupOptions()) ?>;
	fbudgetadd.lists["x_AccountCode"] = <?php echo $budget_add->AccountCode->Lookup->toClientList($budget_add) ?>;
	fbudgetadd.lists["x_AccountCode"].options = <?php echo JsonEncode($budget_add->AccountCode->lookupOptions()) ?>;
	fbudgetadd.lists["x_MeansOfImplementation"] = <?php echo $budget_add->MeansOfImplementation->Lookup->toClientList($budget_add) ?>;
	fbudgetadd.lists["x_MeansOfImplementation"].options = <?php echo JsonEncode($budget_add->MeansOfImplementation->lookupOptions()) ?>;
	fbudgetadd.lists["x_UnitOfMeasure"] = <?php echo $budget_add->UnitOfMeasure->Lookup->toClientList($budget_add) ?>;
	fbudgetadd.lists["x_UnitOfMeasure"].options = <?php echo JsonEncode($budget_add->UnitOfMeasure->lookupOptions()) ?>;
	fbudgetadd.lists["x_PeriodType"] = <?php echo $budget_add->PeriodType->Lookup->toClientList($budget_add) ?>;
	fbudgetadd.lists["x_PeriodType"].options = <?php echo JsonEncode($budget_add->PeriodType->lookupOptions()) ?>;
	fbudgetadd.lists["x_Status"] = <?php echo $budget_add->Status->Lookup->toClientList($budget_add) ?>;
	fbudgetadd.lists["x_Status"].options = <?php echo JsonEncode($budget_add->Status->lookupOptions()) ?>;
	fbudgetadd.autoSuggests["x_Status"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fbudgetadd.lists["x_LACode"] = <?php echo $budget_add->LACode->Lookup->toClientList($budget_add) ?>;
	fbudgetadd.lists["x_LACode"].options = <?php echo JsonEncode($budget_add->LACode->lookupOptions()) ?>;
	fbudgetadd.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fbudgetadd.lists["x_DepartmentCode"] = <?php echo $budget_add->DepartmentCode->Lookup->toClientList($budget_add) ?>;
	fbudgetadd.lists["x_DepartmentCode"].options = <?php echo JsonEncode($budget_add->DepartmentCode->lookupOptions()) ?>;
	fbudgetadd.lists["x_SectionCode"] = <?php echo $budget_add->SectionCode->Lookup->toClientList($budget_add) ?>;
	fbudgetadd.lists["x_SectionCode"].options = <?php echo JsonEncode($budget_add->SectionCode->lookupOptions()) ?>;
	fbudgetadd.lists["x_ProgramCode"] = <?php echo $budget_add->ProgramCode->Lookup->toClientList($budget_add) ?>;
	fbudgetadd.lists["x_ProgramCode"].options = <?php echo JsonEncode($budget_add->ProgramCode->lookupOptions()) ?>;
	fbudgetadd.lists["x_SubProgramCode"] = <?php echo $budget_add->SubProgramCode->Lookup->toClientList($budget_add) ?>;
	fbudgetadd.lists["x_SubProgramCode"].options = <?php echo JsonEncode($budget_add->SubProgramCode->lookupOptions()) ?>;
	loadjs.done("fbudgetadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $budget_add->showPageHeader(); ?>
<?php
$budget_add->showMessage();
?>
<form name="fbudgetadd" id="fbudgetadd" class="<?php echo $budget_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="budget">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$budget_add->IsModal ?>">
<?php if ($budget->getCurrentMasterTable() == "detailed_action") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="detailed_action">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($budget_add->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($budget_add->DepartmentCode->getSessionValue()) ?>">
<input type="hidden" name="fk_FinancialYear" value="<?php echo HtmlEncode($budget_add->FinancialYear->getSessionValue()) ?>">
<input type="hidden" name="fk_ActionCode" value="<?php echo HtmlEncode($budget_add->ActionCode->getSessionValue()) ?>">
<input type="hidden" name="fk_OutcomeCode" value="<?php echo HtmlEncode($budget_add->OutcomeCode->getSessionValue()) ?>">
<input type="hidden" name="fk_OutputCode" value="<?php echo HtmlEncode($budget_add->OutputCode->getSessionValue()) ?>">
<input type="hidden" name="fk_DetailedActionCode" value="<?php echo HtmlEncode($budget_add->DetailedActionCode->getSessionValue()) ?>">
<input type="hidden" name="fk_ProgramCode" value="<?php echo HtmlEncode($budget_add->ProgramCode->getSessionValue()) ?>">
<input type="hidden" name="fk_SubProgramCode" value="<?php echo HtmlEncode($budget_add->SubProgramCode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($budget_add->OutcomeCode->Visible) { // OutcomeCode ?>
	<div id="r_OutcomeCode" class="form-group row">
		<label id="elh_budget_OutcomeCode" for="x_OutcomeCode" class="<?php echo $budget_add->LeftColumnClass ?>"><?php echo $budget_add->OutcomeCode->caption() ?><?php echo $budget_add->OutcomeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_add->RightColumnClass ?>"><div <?php echo $budget_add->OutcomeCode->cellAttributes() ?>>
<?php if ($budget_add->OutcomeCode->getSessionValue() != "") { ?>
<span id="el_budget_OutcomeCode">
<span<?php echo $budget_add->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_add->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_OutcomeCode" name="x_OutcomeCode" value="<?php echo HtmlEncode($budget_add->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_budget_OutcomeCode">
<?php $budget_add->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_OutcomeCode"><?php echo EmptyValue(strval($budget_add->OutcomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_add->OutcomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_add->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_add->OutcomeCode->ReadOnly || $budget_add->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_add->OutcomeCode->Lookup->getParamTag($budget_add, "p_x_OutcomeCode") ?>
<input type="hidden" data-table="budget" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_add->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x_OutcomeCode" id="x_OutcomeCode" value="<?php echo $budget_add->OutcomeCode->CurrentValue ?>"<?php echo $budget_add->OutcomeCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $budget_add->OutcomeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_add->OutputCode->Visible) { // OutputCode ?>
	<div id="r_OutputCode" class="form-group row">
		<label id="elh_budget_OutputCode" for="x_OutputCode" class="<?php echo $budget_add->LeftColumnClass ?>"><?php echo $budget_add->OutputCode->caption() ?><?php echo $budget_add->OutputCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_add->RightColumnClass ?>"><div <?php echo $budget_add->OutputCode->cellAttributes() ?>>
<?php if ($budget_add->OutputCode->getSessionValue() != "") { ?>
<span id="el_budget_OutputCode">
<span<?php echo $budget_add->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_add->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_OutputCode" name="x_OutputCode" value="<?php echo HtmlEncode($budget_add->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_budget_OutputCode">
<?php $budget_add->OutputCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_OutputCode"><?php echo EmptyValue(strval($budget_add->OutputCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_add->OutputCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_add->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_add->OutputCode->ReadOnly || $budget_add->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_add->OutputCode->Lookup->getParamTag($budget_add, "p_x_OutputCode") ?>
<input type="hidden" data-table="budget" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_add->OutputCode->displayValueSeparatorAttribute() ?>" name="x_OutputCode" id="x_OutputCode" value="<?php echo $budget_add->OutputCode->CurrentValue ?>"<?php echo $budget_add->OutputCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $budget_add->OutputCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_add->ActionCode->Visible) { // ActionCode ?>
	<div id="r_ActionCode" class="form-group row">
		<label id="elh_budget_ActionCode" for="x_ActionCode" class="<?php echo $budget_add->LeftColumnClass ?>"><?php echo $budget_add->ActionCode->caption() ?><?php echo $budget_add->ActionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_add->RightColumnClass ?>"><div <?php echo $budget_add->ActionCode->cellAttributes() ?>>
<?php if ($budget_add->ActionCode->getSessionValue() != "") { ?>
<span id="el_budget_ActionCode">
<span<?php echo $budget_add->ActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_add->ActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ActionCode" name="x_ActionCode" value="<?php echo HtmlEncode($budget_add->ActionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_budget_ActionCode">
<?php $budget_add->ActionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_ActionCode" data-value-separator="<?php echo $budget_add->ActionCode->displayValueSeparatorAttribute() ?>" id="x_ActionCode" name="x_ActionCode"<?php echo $budget_add->ActionCode->editAttributes() ?>>
			<?php echo $budget_add->ActionCode->selectOptionListHtml("x_ActionCode") ?>
		</select>
</div>
<?php echo $budget_add->ActionCode->Lookup->getParamTag($budget_add, "p_x_ActionCode") ?>
</span>
<?php } ?>
<?php echo $budget_add->ActionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_add->DetailedActionCode->Visible) { // DetailedActionCode ?>
	<div id="r_DetailedActionCode" class="form-group row">
		<label id="elh_budget_DetailedActionCode" class="<?php echo $budget_add->LeftColumnClass ?>"><?php echo $budget_add->DetailedActionCode->caption() ?><?php echo $budget_add->DetailedActionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_add->RightColumnClass ?>"><div <?php echo $budget_add->DetailedActionCode->cellAttributes() ?>>
<?php if ($budget_add->DetailedActionCode->getSessionValue() != "") { ?>
<span id="el_budget_DetailedActionCode">
<span<?php echo $budget_add->DetailedActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_add->DetailedActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_DetailedActionCode" name="x_DetailedActionCode" value="<?php echo HtmlEncode($budget_add->DetailedActionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_budget_DetailedActionCode">
<?php
$onchange = $budget_add->DetailedActionCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_add->DetailedActionCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_DetailedActionCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_DetailedActionCode" id="sv_x_DetailedActionCode" value="<?php echo RemoveHtml($budget_add->DetailedActionCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($budget_add->DetailedActionCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_add->DetailedActionCode->getPlaceHolder()) ?>"<?php echo $budget_add->DetailedActionCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_add->DetailedActionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_DetailedActionCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($budget_add->DetailedActionCode->ReadOnly || $budget_add->DetailedActionCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="budget" data-field="x_DetailedActionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_add->DetailedActionCode->displayValueSeparatorAttribute() ?>" name="x_DetailedActionCode" id="x_DetailedActionCode" value="<?php echo HtmlEncode($budget_add->DetailedActionCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudgetadd"], function() {
	fbudgetadd.createAutoSuggest({"id":"x_DetailedActionCode","forceSelect":false});
});
</script>
<?php echo $budget_add->DetailedActionCode->Lookup->getParamTag($budget_add, "p_x_DetailedActionCode") ?>
</span>
<?php } ?>
<?php echo $budget_add->DetailedActionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_add->FinancialYear->Visible) { // FinancialYear ?>
	<div id="r_FinancialYear" class="form-group row">
		<label id="elh_budget_FinancialYear" for="x_FinancialYear" class="<?php echo $budget_add->LeftColumnClass ?>"><?php echo $budget_add->FinancialYear->caption() ?><?php echo $budget_add->FinancialYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_add->RightColumnClass ?>"><div <?php echo $budget_add->FinancialYear->cellAttributes() ?>>
<?php if ($budget_add->FinancialYear->getSessionValue() != "") { ?>
<span id="el_budget_FinancialYear">
<span<?php echo $budget_add->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_add->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_FinancialYear" name="x_FinancialYear" value="<?php echo HtmlEncode($budget_add->FinancialYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el_budget_FinancialYear">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_FinancialYear" data-value-separator="<?php echo $budget_add->FinancialYear->displayValueSeparatorAttribute() ?>" id="x_FinancialYear" name="x_FinancialYear"<?php echo $budget_add->FinancialYear->editAttributes() ?>>
			<?php echo $budget_add->FinancialYear->selectOptionListHtml("x_FinancialYear") ?>
		</select>
</div>
<?php echo $budget_add->FinancialYear->Lookup->getParamTag($budget_add, "p_x_FinancialYear") ?>
</span>
<?php } ?>
<?php echo $budget_add->FinancialYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_add->AccountCode->Visible) { // AccountCode ?>
	<div id="r_AccountCode" class="form-group row">
		<label id="elh_budget_AccountCode" for="x_AccountCode" class="<?php echo $budget_add->LeftColumnClass ?>"><?php echo $budget_add->AccountCode->caption() ?><?php echo $budget_add->AccountCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_add->RightColumnClass ?>"><div <?php echo $budget_add->AccountCode->cellAttributes() ?>>
<span id="el_budget_AccountCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_AccountCode"><?php echo EmptyValue(strval($budget_add->AccountCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_add->AccountCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_add->AccountCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_add->AccountCode->ReadOnly || $budget_add->AccountCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_AccountCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_add->AccountCode->Lookup->getParamTag($budget_add, "p_x_AccountCode") ?>
<input type="hidden" data-table="budget" data-field="x_AccountCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_add->AccountCode->displayValueSeparatorAttribute() ?>" name="x_AccountCode" id="x_AccountCode" value="<?php echo $budget_add->AccountCode->CurrentValue ?>"<?php echo $budget_add->AccountCode->editAttributes() ?>>
</span>
<?php echo $budget_add->AccountCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_add->MeansOfImplementation->Visible) { // MeansOfImplementation ?>
	<div id="r_MeansOfImplementation" class="form-group row">
		<label id="elh_budget_MeansOfImplementation" for="x_MeansOfImplementation" class="<?php echo $budget_add->LeftColumnClass ?>"><?php echo $budget_add->MeansOfImplementation->caption() ?><?php echo $budget_add->MeansOfImplementation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_add->RightColumnClass ?>"><div <?php echo $budget_add->MeansOfImplementation->cellAttributes() ?>>
<span id="el_budget_MeansOfImplementation">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_MeansOfImplementation"><?php echo EmptyValue(strval($budget_add->MeansOfImplementation->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_add->MeansOfImplementation->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_add->MeansOfImplementation->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_add->MeansOfImplementation->ReadOnly || $budget_add->MeansOfImplementation->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_MeansOfImplementation',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_add->MeansOfImplementation->Lookup->getParamTag($budget_add, "p_x_MeansOfImplementation") ?>
<input type="hidden" data-table="budget" data-field="x_MeansOfImplementation" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_add->MeansOfImplementation->displayValueSeparatorAttribute() ?>" name="x_MeansOfImplementation" id="x_MeansOfImplementation" value="<?php echo $budget_add->MeansOfImplementation->CurrentValue ?>"<?php echo $budget_add->MeansOfImplementation->editAttributes() ?>>
</span>
<?php echo $budget_add->MeansOfImplementation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_add->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<div id="r_UnitOfMeasure" class="form-group row">
		<label id="elh_budget_UnitOfMeasure" for="x_UnitOfMeasure" class="<?php echo $budget_add->LeftColumnClass ?>"><?php echo $budget_add->UnitOfMeasure->caption() ?><?php echo $budget_add->UnitOfMeasure->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_add->RightColumnClass ?>"><div <?php echo $budget_add->UnitOfMeasure->cellAttributes() ?>>
<span id="el_budget_UnitOfMeasure">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_UnitOfMeasure" data-value-separator="<?php echo $budget_add->UnitOfMeasure->displayValueSeparatorAttribute() ?>" id="x_UnitOfMeasure" name="x_UnitOfMeasure"<?php echo $budget_add->UnitOfMeasure->editAttributes() ?>>
			<?php echo $budget_add->UnitOfMeasure->selectOptionListHtml("x_UnitOfMeasure") ?>
		</select>
</div>
<?php echo $budget_add->UnitOfMeasure->Lookup->getParamTag($budget_add, "p_x_UnitOfMeasure") ?>
</span>
<?php echo $budget_add->UnitOfMeasure->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_add->Quantity->Visible) { // Quantity ?>
	<div id="r_Quantity" class="form-group row">
		<label id="elh_budget_Quantity" for="x_Quantity" class="<?php echo $budget_add->LeftColumnClass ?>"><?php echo $budget_add->Quantity->caption() ?><?php echo $budget_add->Quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_add->RightColumnClass ?>"><div <?php echo $budget_add->Quantity->cellAttributes() ?>>
<span id="el_budget_Quantity">
<input type="text" data-table="budget" data-field="x_Quantity" name="x_Quantity" id="x_Quantity" size="30" placeholder="<?php echo HtmlEncode($budget_add->Quantity->getPlaceHolder()) ?>" value="<?php echo $budget_add->Quantity->EditValue ?>"<?php echo $budget_add->Quantity->editAttributes() ?>>
</span>
<?php echo $budget_add->Quantity->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_add->PeriodType->Visible) { // PeriodType ?>
	<div id="r_PeriodType" class="form-group row">
		<label id="elh_budget_PeriodType" for="x_PeriodType" class="<?php echo $budget_add->LeftColumnClass ?>"><?php echo $budget_add->PeriodType->caption() ?><?php echo $budget_add->PeriodType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_add->RightColumnClass ?>"><div <?php echo $budget_add->PeriodType->cellAttributes() ?>>
<span id="el_budget_PeriodType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_PeriodType" data-value-separator="<?php echo $budget_add->PeriodType->displayValueSeparatorAttribute() ?>" id="x_PeriodType" name="x_PeriodType"<?php echo $budget_add->PeriodType->editAttributes() ?>>
			<?php echo $budget_add->PeriodType->selectOptionListHtml("x_PeriodType") ?>
		</select>
</div>
<?php echo $budget_add->PeriodType->Lookup->getParamTag($budget_add, "p_x_PeriodType") ?>
</span>
<?php echo $budget_add->PeriodType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_add->PeriodLength->Visible) { // PeriodLength ?>
	<div id="r_PeriodLength" class="form-group row">
		<label id="elh_budget_PeriodLength" for="x_PeriodLength" class="<?php echo $budget_add->LeftColumnClass ?>"><?php echo $budget_add->PeriodLength->caption() ?><?php echo $budget_add->PeriodLength->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_add->RightColumnClass ?>"><div <?php echo $budget_add->PeriodLength->cellAttributes() ?>>
<span id="el_budget_PeriodLength">
<input type="text" data-table="budget" data-field="x_PeriodLength" name="x_PeriodLength" id="x_PeriodLength" size="30" placeholder="<?php echo HtmlEncode($budget_add->PeriodLength->getPlaceHolder()) ?>" value="<?php echo $budget_add->PeriodLength->EditValue ?>"<?php echo $budget_add->PeriodLength->editAttributes() ?>>
</span>
<?php echo $budget_add->PeriodLength->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_add->Frequency->Visible) { // Frequency ?>
	<div id="r_Frequency" class="form-group row">
		<label id="elh_budget_Frequency" for="x_Frequency" class="<?php echo $budget_add->LeftColumnClass ?>"><?php echo $budget_add->Frequency->caption() ?><?php echo $budget_add->Frequency->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_add->RightColumnClass ?>"><div <?php echo $budget_add->Frequency->cellAttributes() ?>>
<span id="el_budget_Frequency">
<input type="text" data-table="budget" data-field="x_Frequency" name="x_Frequency" id="x_Frequency" size="30" placeholder="<?php echo HtmlEncode($budget_add->Frequency->getPlaceHolder()) ?>" value="<?php echo $budget_add->Frequency->EditValue ?>"<?php echo $budget_add->Frequency->editAttributes() ?>>
</span>
<?php echo $budget_add->Frequency->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_add->UnitCost->Visible) { // UnitCost ?>
	<div id="r_UnitCost" class="form-group row">
		<label id="elh_budget_UnitCost" for="x_UnitCost" class="<?php echo $budget_add->LeftColumnClass ?>"><?php echo $budget_add->UnitCost->caption() ?><?php echo $budget_add->UnitCost->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_add->RightColumnClass ?>"><div <?php echo $budget_add->UnitCost->cellAttributes() ?>>
<span id="el_budget_UnitCost">
<input type="text" data-table="budget" data-field="x_UnitCost" name="x_UnitCost" id="x_UnitCost" size="30" placeholder="<?php echo HtmlEncode($budget_add->UnitCost->getPlaceHolder()) ?>" value="<?php echo $budget_add->UnitCost->EditValue ?>"<?php echo $budget_add->UnitCost->editAttributes() ?>>
</span>
<?php echo $budget_add->UnitCost->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_add->BudgetEstimate->Visible) { // BudgetEstimate ?>
	<div id="r_BudgetEstimate" class="form-group row">
		<label id="elh_budget_BudgetEstimate" for="x_BudgetEstimate" class="<?php echo $budget_add->LeftColumnClass ?>"><?php echo $budget_add->BudgetEstimate->caption() ?><?php echo $budget_add->BudgetEstimate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_add->RightColumnClass ?>"><div <?php echo $budget_add->BudgetEstimate->cellAttributes() ?>>
<span id="el_budget_BudgetEstimate">
<input type="text" data-table="budget" data-field="x_BudgetEstimate" name="x_BudgetEstimate" id="x_BudgetEstimate" size="30" placeholder="<?php echo HtmlEncode($budget_add->BudgetEstimate->getPlaceHolder()) ?>" value="<?php echo $budget_add->BudgetEstimate->EditValue ?>"<?php echo $budget_add->BudgetEstimate->editAttributes() ?>>
</span>
<?php echo $budget_add->BudgetEstimate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_add->ActualAmount->Visible) { // ActualAmount ?>
	<div id="r_ActualAmount" class="form-group row">
		<label id="elh_budget_ActualAmount" for="x_ActualAmount" class="<?php echo $budget_add->LeftColumnClass ?>"><?php echo $budget_add->ActualAmount->caption() ?><?php echo $budget_add->ActualAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_add->RightColumnClass ?>"><div <?php echo $budget_add->ActualAmount->cellAttributes() ?>>
<span id="el_budget_ActualAmount">
<input type="text" data-table="budget" data-field="x_ActualAmount" name="x_ActualAmount" id="x_ActualAmount" size="30" placeholder="<?php echo HtmlEncode($budget_add->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $budget_add->ActualAmount->EditValue ?>"<?php echo $budget_add->ActualAmount->editAttributes() ?>>
</span>
<?php echo $budget_add->ActualAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_add->Status->Visible) { // Status ?>
	<div id="r_Status" class="form-group row">
		<label id="elh_budget_Status" class="<?php echo $budget_add->LeftColumnClass ?>"><?php echo $budget_add->Status->caption() ?><?php echo $budget_add->Status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_add->RightColumnClass ?>"><div <?php echo $budget_add->Status->cellAttributes() ?>>
<span id="el_budget_Status">
<?php
$onchange = $budget_add->Status->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_add->Status->EditAttrs["onchange"] = "";
?>
<span id="as_x_Status">
	<input type="text" class="form-control" name="sv_x_Status" id="sv_x_Status" value="<?php echo RemoveHtml($budget_add->Status->EditValue) ?>" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($budget_add->Status->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_add->Status->getPlaceHolder()) ?>"<?php echo $budget_add->Status->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget" data-field="x_Status" data-value-separator="<?php echo $budget_add->Status->displayValueSeparatorAttribute() ?>" name="x_Status" id="x_Status" value="<?php echo HtmlEncode($budget_add->Status->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudgetadd"], function() {
	fbudgetadd.createAutoSuggest({"id":"x_Status","forceSelect":false});
});
</script>
<?php echo $budget_add->Status->Lookup->getParamTag($budget_add, "p_x_Status") ?>
</span>
<?php echo $budget_add->Status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_budget_LACode" class="<?php echo $budget_add->LeftColumnClass ?>"><?php echo $budget_add->LACode->caption() ?><?php echo $budget_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_add->RightColumnClass ?>"><div <?php echo $budget_add->LACode->cellAttributes() ?>>
<?php if ($budget_add->LACode->getSessionValue() != "") { ?>
<span id="el_budget_LACode">
<span<?php echo $budget_add->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_add->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($budget_add->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_budget_LACode">
<?php
$onchange = $budget_add->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_add->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($budget_add->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($budget_add->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_add->LACode->getPlaceHolder()) ?>"<?php echo $budget_add->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_add->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($budget_add->LACode->ReadOnly || $budget_add->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="budget" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_add->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($budget_add->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudgetadd"], function() {
	fbudgetadd.createAutoSuggest({"id":"x_LACode","forceSelect":false});
});
</script>
<?php echo $budget_add->LACode->Lookup->getParamTag($budget_add, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $budget_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_add->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_budget_DepartmentCode" for="x_DepartmentCode" class="<?php echo $budget_add->LeftColumnClass ?>"><?php echo $budget_add->DepartmentCode->caption() ?><?php echo $budget_add->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_add->RightColumnClass ?>"><div <?php echo $budget_add->DepartmentCode->cellAttributes() ?>>
<?php if ($budget_add->DepartmentCode->getSessionValue() != "") { ?>
<span id="el_budget_DepartmentCode">
<span<?php echo $budget_add->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_add->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_DepartmentCode" name="x_DepartmentCode" value="<?php echo HtmlEncode($budget_add->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_budget_DepartmentCode">
<?php $budget_add->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_DepartmentCode" data-value-separator="<?php echo $budget_add->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $budget_add->DepartmentCode->editAttributes() ?>>
			<?php echo $budget_add->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $budget_add->DepartmentCode->Lookup->getParamTag($budget_add, "p_x_DepartmentCode") ?>
</span>
<?php } ?>
<?php echo $budget_add->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_add->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_budget_SectionCode" for="x_SectionCode" class="<?php echo $budget_add->LeftColumnClass ?>"><?php echo $budget_add->SectionCode->caption() ?><?php echo $budget_add->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_add->RightColumnClass ?>"><div <?php echo $budget_add->SectionCode->cellAttributes() ?>>
<span id="el_budget_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_SectionCode" data-value-separator="<?php echo $budget_add->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $budget_add->SectionCode->editAttributes() ?>>
			<?php echo $budget_add->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $budget_add->SectionCode->Lookup->getParamTag($budget_add, "p_x_SectionCode") ?>
</span>
<?php echo $budget_add->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_add->ProgramCode->Visible) { // ProgramCode ?>
	<div id="r_ProgramCode" class="form-group row">
		<label id="elh_budget_ProgramCode" for="x_ProgramCode" class="<?php echo $budget_add->LeftColumnClass ?>"><?php echo $budget_add->ProgramCode->caption() ?><?php echo $budget_add->ProgramCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_add->RightColumnClass ?>"><div <?php echo $budget_add->ProgramCode->cellAttributes() ?>>
<?php if ($budget_add->ProgramCode->getSessionValue() != "") { ?>
<span id="el_budget_ProgramCode">
<span<?php echo $budget_add->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_add->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProgramCode" name="x_ProgramCode" value="<?php echo HtmlEncode($budget_add->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_budget_ProgramCode">
<?php $budget_add->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ProgramCode"><?php echo EmptyValue(strval($budget_add->ProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_add->ProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_add->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_add->ProgramCode->ReadOnly || $budget_add->ProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_add->ProgramCode->Lookup->getParamTag($budget_add, "p_x_ProgramCode") ?>
<input type="hidden" data-table="budget" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_add->ProgramCode->displayValueSeparatorAttribute() ?>" name="x_ProgramCode" id="x_ProgramCode" value="<?php echo $budget_add->ProgramCode->CurrentValue ?>"<?php echo $budget_add->ProgramCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $budget_add->ProgramCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_add->SubProgramCode->Visible) { // SubProgramCode ?>
	<div id="r_SubProgramCode" class="form-group row">
		<label id="elh_budget_SubProgramCode" for="x_SubProgramCode" class="<?php echo $budget_add->LeftColumnClass ?>"><?php echo $budget_add->SubProgramCode->caption() ?><?php echo $budget_add->SubProgramCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_add->RightColumnClass ?>"><div <?php echo $budget_add->SubProgramCode->cellAttributes() ?>>
<?php if ($budget_add->SubProgramCode->getSessionValue() != "") { ?>
<span id="el_budget_SubProgramCode">
<span<?php echo $budget_add->SubProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_add->SubProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_SubProgramCode" name="x_SubProgramCode" value="<?php echo HtmlEncode($budget_add->SubProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_budget_SubProgramCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_SubProgramCode"><?php echo EmptyValue(strval($budget_add->SubProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_add->SubProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_add->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_add->SubProgramCode->ReadOnly || $budget_add->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_add->SubProgramCode->Lookup->getParamTag($budget_add, "p_x_SubProgramCode") ?>
<input type="hidden" data-table="budget" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_add->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x_SubProgramCode" id="x_SubProgramCode" value="<?php echo $budget_add->SubProgramCode->CurrentValue ?>"<?php echo $budget_add->SubProgramCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $budget_add->SubProgramCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_add->ApprovedBudget->Visible) { // ApprovedBudget ?>
	<div id="r_ApprovedBudget" class="form-group row">
		<label id="elh_budget_ApprovedBudget" for="x_ApprovedBudget" class="<?php echo $budget_add->LeftColumnClass ?>"><?php echo $budget_add->ApprovedBudget->caption() ?><?php echo $budget_add->ApprovedBudget->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_add->RightColumnClass ?>"><div <?php echo $budget_add->ApprovedBudget->cellAttributes() ?>>
<span id="el_budget_ApprovedBudget">
<input type="text" data-table="budget" data-field="x_ApprovedBudget" name="x_ApprovedBudget" id="x_ApprovedBudget" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($budget_add->ApprovedBudget->getPlaceHolder()) ?>" value="<?php echo $budget_add->ApprovedBudget->EditValue ?>"<?php echo $budget_add->ApprovedBudget->editAttributes() ?>>
</span>
<?php echo $budget_add->ApprovedBudget->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$budget_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $budget_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $budget_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$budget_add->showPageFooter();
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
$budget_add->terminate();
?>