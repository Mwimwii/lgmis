<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($budget_grid))
	$budget_grid = new budget_grid();

// Run the page
$budget_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$budget_grid->Page_Render();
?>
<?php if (!$budget_grid->isExport()) { ?>
<script>
var fbudgetgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fbudgetgrid = new ew.Form("fbudgetgrid", "grid");
	fbudgetgrid.formKeyCountName = '<?php echo $budget_grid->FormKeyCountName ?>';

	// Validate form
	fbudgetgrid.validate = function() {
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
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($budget_grid->OutcomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_grid->OutcomeCode->caption(), $budget_grid->OutcomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_grid->OutputCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_grid->OutputCode->caption(), $budget_grid->OutputCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_grid->ActionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_grid->ActionCode->caption(), $budget_grid->ActionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_grid->DetailedActionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DetailedActionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_grid->DetailedActionCode->caption(), $budget_grid->DetailedActionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DetailedActionCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_grid->DetailedActionCode->errorMessage()) ?>");
			<?php if ($budget_grid->FinancialYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_grid->FinancialYear->caption(), $budget_grid->FinancialYear->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_grid->AccountCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_grid->AccountCode->caption(), $budget_grid->AccountCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_grid->MeansOfImplementation->Required) { ?>
				elm = this.getElements("x" + infix + "_MeansOfImplementation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_grid->MeansOfImplementation->caption(), $budget_grid->MeansOfImplementation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_grid->UnitOfMeasure->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitOfMeasure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_grid->UnitOfMeasure->caption(), $budget_grid->UnitOfMeasure->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_grid->Quantity->Required) { ?>
				elm = this.getElements("x" + infix + "_Quantity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_grid->Quantity->caption(), $budget_grid->Quantity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Quantity");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_grid->Quantity->errorMessage()) ?>");
			<?php if ($budget_grid->Frequency->Required) { ?>
				elm = this.getElements("x" + infix + "_Frequency");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_grid->Frequency->caption(), $budget_grid->Frequency->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Frequency");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_grid->Frequency->errorMessage()) ?>");
			<?php if ($budget_grid->UnitCost->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitCost");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_grid->UnitCost->caption(), $budget_grid->UnitCost->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_UnitCost");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_grid->UnitCost->errorMessage()) ?>");
			<?php if ($budget_grid->BudgetEstimate->Required) { ?>
				elm = this.getElements("x" + infix + "_BudgetEstimate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_grid->BudgetEstimate->caption(), $budget_grid->BudgetEstimate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BudgetEstimate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_grid->BudgetEstimate->errorMessage()) ?>");
			<?php if ($budget_grid->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_grid->LACode->caption(), $budget_grid->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_grid->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_grid->DepartmentCode->caption(), $budget_grid->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_grid->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_grid->SectionCode->caption(), $budget_grid->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_grid->BudgetLine->Required) { ?>
				elm = this.getElements("x" + infix + "_BudgetLine");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_grid->BudgetLine->caption(), $budget_grid->BudgetLine->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_grid->ProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_grid->ProgramCode->caption(), $budget_grid->ProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_grid->SubProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SubProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_grid->SubProgramCode->caption(), $budget_grid->SubProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_grid->ApprovedBudget->Required) { ?>
				elm = this.getElements("x" + infix + "_ApprovedBudget");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_grid->ApprovedBudget->caption(), $budget_grid->ApprovedBudget->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ApprovedBudget");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_grid->ApprovedBudget->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fbudgetgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "OutcomeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutputCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DetailedActionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "FinancialYear", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "MeansOfImplementation", false)) return false;
		if (ew.valueChanged(fobj, infix, "UnitOfMeasure", false)) return false;
		if (ew.valueChanged(fobj, infix, "Quantity", false)) return false;
		if (ew.valueChanged(fobj, infix, "Frequency", false)) return false;
		if (ew.valueChanged(fobj, infix, "UnitCost", false)) return false;
		if (ew.valueChanged(fobj, infix, "BudgetEstimate", false)) return false;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SectionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProgramCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SubProgramCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ApprovedBudget", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fbudgetgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbudgetgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbudgetgrid.lists["x_OutcomeCode"] = <?php echo $budget_grid->OutcomeCode->Lookup->toClientList($budget_grid) ?>;
	fbudgetgrid.lists["x_OutcomeCode"].options = <?php echo JsonEncode($budget_grid->OutcomeCode->lookupOptions()) ?>;
	fbudgetgrid.lists["x_OutputCode"] = <?php echo $budget_grid->OutputCode->Lookup->toClientList($budget_grid) ?>;
	fbudgetgrid.lists["x_OutputCode"].options = <?php echo JsonEncode($budget_grid->OutputCode->lookupOptions()) ?>;
	fbudgetgrid.lists["x_ActionCode"] = <?php echo $budget_grid->ActionCode->Lookup->toClientList($budget_grid) ?>;
	fbudgetgrid.lists["x_ActionCode"].options = <?php echo JsonEncode($budget_grid->ActionCode->lookupOptions()) ?>;
	fbudgetgrid.lists["x_DetailedActionCode"] = <?php echo $budget_grid->DetailedActionCode->Lookup->toClientList($budget_grid) ?>;
	fbudgetgrid.lists["x_DetailedActionCode"].options = <?php echo JsonEncode($budget_grid->DetailedActionCode->lookupOptions()) ?>;
	fbudgetgrid.autoSuggests["x_DetailedActionCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fbudgetgrid.lists["x_FinancialYear"] = <?php echo $budget_grid->FinancialYear->Lookup->toClientList($budget_grid) ?>;
	fbudgetgrid.lists["x_FinancialYear"].options = <?php echo JsonEncode($budget_grid->FinancialYear->lookupOptions()) ?>;
	fbudgetgrid.lists["x_AccountCode"] = <?php echo $budget_grid->AccountCode->Lookup->toClientList($budget_grid) ?>;
	fbudgetgrid.lists["x_AccountCode"].options = <?php echo JsonEncode($budget_grid->AccountCode->lookupOptions()) ?>;
	fbudgetgrid.lists["x_MeansOfImplementation"] = <?php echo $budget_grid->MeansOfImplementation->Lookup->toClientList($budget_grid) ?>;
	fbudgetgrid.lists["x_MeansOfImplementation"].options = <?php echo JsonEncode($budget_grid->MeansOfImplementation->lookupOptions()) ?>;
	fbudgetgrid.lists["x_UnitOfMeasure"] = <?php echo $budget_grid->UnitOfMeasure->Lookup->toClientList($budget_grid) ?>;
	fbudgetgrid.lists["x_UnitOfMeasure"].options = <?php echo JsonEncode($budget_grid->UnitOfMeasure->lookupOptions()) ?>;
	fbudgetgrid.lists["x_LACode"] = <?php echo $budget_grid->LACode->Lookup->toClientList($budget_grid) ?>;
	fbudgetgrid.lists["x_LACode"].options = <?php echo JsonEncode($budget_grid->LACode->lookupOptions()) ?>;
	fbudgetgrid.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fbudgetgrid.lists["x_DepartmentCode"] = <?php echo $budget_grid->DepartmentCode->Lookup->toClientList($budget_grid) ?>;
	fbudgetgrid.lists["x_DepartmentCode"].options = <?php echo JsonEncode($budget_grid->DepartmentCode->lookupOptions()) ?>;
	fbudgetgrid.lists["x_SectionCode"] = <?php echo $budget_grid->SectionCode->Lookup->toClientList($budget_grid) ?>;
	fbudgetgrid.lists["x_SectionCode"].options = <?php echo JsonEncode($budget_grid->SectionCode->lookupOptions()) ?>;
	fbudgetgrid.lists["x_ProgramCode"] = <?php echo $budget_grid->ProgramCode->Lookup->toClientList($budget_grid) ?>;
	fbudgetgrid.lists["x_ProgramCode"].options = <?php echo JsonEncode($budget_grid->ProgramCode->lookupOptions()) ?>;
	fbudgetgrid.lists["x_SubProgramCode"] = <?php echo $budget_grid->SubProgramCode->Lookup->toClientList($budget_grid) ?>;
	fbudgetgrid.lists["x_SubProgramCode"].options = <?php echo JsonEncode($budget_grid->SubProgramCode->lookupOptions()) ?>;
	loadjs.done("fbudgetgrid");
});
</script>
<?php } ?>
<?php
$budget_grid->renderOtherOptions();
?>
<?php if ($budget_grid->TotalRecords > 0 || $budget->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($budget_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> budget">
<?php if ($budget_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $budget_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fbudgetgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_budget" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_budgetgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$budget->RowType = ROWTYPE_HEADER;

// Render list options
$budget_grid->renderListOptions();

// Render list options (header, left)
$budget_grid->ListOptions->render("header", "left");
?>
<?php if ($budget_grid->OutcomeCode->Visible) { // OutcomeCode ?>
	<?php if ($budget_grid->SortUrl($budget_grid->OutcomeCode) == "") { ?>
		<th data-name="OutcomeCode" class="<?php echo $budget_grid->OutcomeCode->headerCellClass() ?>"><div id="elh_budget_OutcomeCode" class="budget_OutcomeCode"><div class="ew-table-header-caption"><?php echo $budget_grid->OutcomeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutcomeCode" class="<?php echo $budget_grid->OutcomeCode->headerCellClass() ?>"><div><div id="elh_budget_OutcomeCode" class="budget_OutcomeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_grid->OutcomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_grid->OutcomeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_grid->OutcomeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_grid->OutputCode->Visible) { // OutputCode ?>
	<?php if ($budget_grid->SortUrl($budget_grid->OutputCode) == "") { ?>
		<th data-name="OutputCode" class="<?php echo $budget_grid->OutputCode->headerCellClass() ?>"><div id="elh_budget_OutputCode" class="budget_OutputCode"><div class="ew-table-header-caption"><?php echo $budget_grid->OutputCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputCode" class="<?php echo $budget_grid->OutputCode->headerCellClass() ?>"><div><div id="elh_budget_OutputCode" class="budget_OutputCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_grid->OutputCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_grid->OutputCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_grid->OutputCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_grid->ActionCode->Visible) { // ActionCode ?>
	<?php if ($budget_grid->SortUrl($budget_grid->ActionCode) == "") { ?>
		<th data-name="ActionCode" class="<?php echo $budget_grid->ActionCode->headerCellClass() ?>"><div id="elh_budget_ActionCode" class="budget_ActionCode"><div class="ew-table-header-caption"><?php echo $budget_grid->ActionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionCode" class="<?php echo $budget_grid->ActionCode->headerCellClass() ?>"><div><div id="elh_budget_ActionCode" class="budget_ActionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_grid->ActionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_grid->ActionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_grid->ActionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_grid->DetailedActionCode->Visible) { // DetailedActionCode ?>
	<?php if ($budget_grid->SortUrl($budget_grid->DetailedActionCode) == "") { ?>
		<th data-name="DetailedActionCode" class="<?php echo $budget_grid->DetailedActionCode->headerCellClass() ?>"><div id="elh_budget_DetailedActionCode" class="budget_DetailedActionCode"><div class="ew-table-header-caption"><?php echo $budget_grid->DetailedActionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DetailedActionCode" class="<?php echo $budget_grid->DetailedActionCode->headerCellClass() ?>"><div><div id="elh_budget_DetailedActionCode" class="budget_DetailedActionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_grid->DetailedActionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_grid->DetailedActionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_grid->DetailedActionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_grid->FinancialYear->Visible) { // FinancialYear ?>
	<?php if ($budget_grid->SortUrl($budget_grid->FinancialYear) == "") { ?>
		<th data-name="FinancialYear" class="<?php echo $budget_grid->FinancialYear->headerCellClass() ?>"><div id="elh_budget_FinancialYear" class="budget_FinancialYear"><div class="ew-table-header-caption"><?php echo $budget_grid->FinancialYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FinancialYear" class="<?php echo $budget_grid->FinancialYear->headerCellClass() ?>"><div><div id="elh_budget_FinancialYear" class="budget_FinancialYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_grid->FinancialYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_grid->FinancialYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_grid->FinancialYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_grid->AccountCode->Visible) { // AccountCode ?>
	<?php if ($budget_grid->SortUrl($budget_grid->AccountCode) == "") { ?>
		<th data-name="AccountCode" class="<?php echo $budget_grid->AccountCode->headerCellClass() ?>"><div id="elh_budget_AccountCode" class="budget_AccountCode"><div class="ew-table-header-caption"><?php echo $budget_grid->AccountCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountCode" class="<?php echo $budget_grid->AccountCode->headerCellClass() ?>"><div><div id="elh_budget_AccountCode" class="budget_AccountCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_grid->AccountCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_grid->AccountCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_grid->AccountCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_grid->MeansOfImplementation->Visible) { // MeansOfImplementation ?>
	<?php if ($budget_grid->SortUrl($budget_grid->MeansOfImplementation) == "") { ?>
		<th data-name="MeansOfImplementation" class="<?php echo $budget_grid->MeansOfImplementation->headerCellClass() ?>"><div id="elh_budget_MeansOfImplementation" class="budget_MeansOfImplementation"><div class="ew-table-header-caption"><?php echo $budget_grid->MeansOfImplementation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MeansOfImplementation" class="<?php echo $budget_grid->MeansOfImplementation->headerCellClass() ?>"><div><div id="elh_budget_MeansOfImplementation" class="budget_MeansOfImplementation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_grid->MeansOfImplementation->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_grid->MeansOfImplementation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_grid->MeansOfImplementation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_grid->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<?php if ($budget_grid->SortUrl($budget_grid->UnitOfMeasure) == "") { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $budget_grid->UnitOfMeasure->headerCellClass() ?>"><div id="elh_budget_UnitOfMeasure" class="budget_UnitOfMeasure"><div class="ew-table-header-caption"><?php echo $budget_grid->UnitOfMeasure->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $budget_grid->UnitOfMeasure->headerCellClass() ?>"><div><div id="elh_budget_UnitOfMeasure" class="budget_UnitOfMeasure">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_grid->UnitOfMeasure->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_grid->UnitOfMeasure->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_grid->UnitOfMeasure->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_grid->Quantity->Visible) { // Quantity ?>
	<?php if ($budget_grid->SortUrl($budget_grid->Quantity) == "") { ?>
		<th data-name="Quantity" class="<?php echo $budget_grid->Quantity->headerCellClass() ?>"><div id="elh_budget_Quantity" class="budget_Quantity"><div class="ew-table-header-caption"><?php echo $budget_grid->Quantity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Quantity" class="<?php echo $budget_grid->Quantity->headerCellClass() ?>"><div><div id="elh_budget_Quantity" class="budget_Quantity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_grid->Quantity->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_grid->Quantity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_grid->Quantity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_grid->Frequency->Visible) { // Frequency ?>
	<?php if ($budget_grid->SortUrl($budget_grid->Frequency) == "") { ?>
		<th data-name="Frequency" class="<?php echo $budget_grid->Frequency->headerCellClass() ?>"><div id="elh_budget_Frequency" class="budget_Frequency"><div class="ew-table-header-caption"><?php echo $budget_grid->Frequency->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Frequency" class="<?php echo $budget_grid->Frequency->headerCellClass() ?>"><div><div id="elh_budget_Frequency" class="budget_Frequency">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_grid->Frequency->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_grid->Frequency->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_grid->Frequency->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_grid->UnitCost->Visible) { // UnitCost ?>
	<?php if ($budget_grid->SortUrl($budget_grid->UnitCost) == "") { ?>
		<th data-name="UnitCost" class="<?php echo $budget_grid->UnitCost->headerCellClass() ?>"><div id="elh_budget_UnitCost" class="budget_UnitCost"><div class="ew-table-header-caption"><?php echo $budget_grid->UnitCost->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitCost" class="<?php echo $budget_grid->UnitCost->headerCellClass() ?>"><div><div id="elh_budget_UnitCost" class="budget_UnitCost">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_grid->UnitCost->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_grid->UnitCost->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_grid->UnitCost->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_grid->BudgetEstimate->Visible) { // BudgetEstimate ?>
	<?php if ($budget_grid->SortUrl($budget_grid->BudgetEstimate) == "") { ?>
		<th data-name="BudgetEstimate" class="<?php echo $budget_grid->BudgetEstimate->headerCellClass() ?>"><div id="elh_budget_BudgetEstimate" class="budget_BudgetEstimate"><div class="ew-table-header-caption"><?php echo $budget_grid->BudgetEstimate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BudgetEstimate" class="<?php echo $budget_grid->BudgetEstimate->headerCellClass() ?>"><div><div id="elh_budget_BudgetEstimate" class="budget_BudgetEstimate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_grid->BudgetEstimate->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_grid->BudgetEstimate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_grid->BudgetEstimate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_grid->LACode->Visible) { // LACode ?>
	<?php if ($budget_grid->SortUrl($budget_grid->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $budget_grid->LACode->headerCellClass() ?>"><div id="elh_budget_LACode" class="budget_LACode"><div class="ew-table-header-caption"><?php echo $budget_grid->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $budget_grid->LACode->headerCellClass() ?>"><div><div id="elh_budget_LACode" class="budget_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_grid->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_grid->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_grid->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_grid->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($budget_grid->SortUrl($budget_grid->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $budget_grid->DepartmentCode->headerCellClass() ?>"><div id="elh_budget_DepartmentCode" class="budget_DepartmentCode"><div class="ew-table-header-caption"><?php echo $budget_grid->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $budget_grid->DepartmentCode->headerCellClass() ?>"><div><div id="elh_budget_DepartmentCode" class="budget_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_grid->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_grid->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_grid->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_grid->SectionCode->Visible) { // SectionCode ?>
	<?php if ($budget_grid->SortUrl($budget_grid->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $budget_grid->SectionCode->headerCellClass() ?>"><div id="elh_budget_SectionCode" class="budget_SectionCode"><div class="ew-table-header-caption"><?php echo $budget_grid->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $budget_grid->SectionCode->headerCellClass() ?>"><div><div id="elh_budget_SectionCode" class="budget_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_grid->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_grid->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_grid->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_grid->BudgetLine->Visible) { // BudgetLine ?>
	<?php if ($budget_grid->SortUrl($budget_grid->BudgetLine) == "") { ?>
		<th data-name="BudgetLine" class="<?php echo $budget_grid->BudgetLine->headerCellClass() ?>"><div id="elh_budget_BudgetLine" class="budget_BudgetLine"><div class="ew-table-header-caption"><?php echo $budget_grid->BudgetLine->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BudgetLine" class="<?php echo $budget_grid->BudgetLine->headerCellClass() ?>"><div><div id="elh_budget_BudgetLine" class="budget_BudgetLine">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_grid->BudgetLine->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_grid->BudgetLine->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_grid->BudgetLine->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_grid->ProgramCode->Visible) { // ProgramCode ?>
	<?php if ($budget_grid->SortUrl($budget_grid->ProgramCode) == "") { ?>
		<th data-name="ProgramCode" class="<?php echo $budget_grid->ProgramCode->headerCellClass() ?>"><div id="elh_budget_ProgramCode" class="budget_ProgramCode"><div class="ew-table-header-caption"><?php echo $budget_grid->ProgramCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgramCode" class="<?php echo $budget_grid->ProgramCode->headerCellClass() ?>"><div><div id="elh_budget_ProgramCode" class="budget_ProgramCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_grid->ProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_grid->ProgramCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_grid->ProgramCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_grid->SubProgramCode->Visible) { // SubProgramCode ?>
	<?php if ($budget_grid->SortUrl($budget_grid->SubProgramCode) == "") { ?>
		<th data-name="SubProgramCode" class="<?php echo $budget_grid->SubProgramCode->headerCellClass() ?>"><div id="elh_budget_SubProgramCode" class="budget_SubProgramCode"><div class="ew-table-header-caption"><?php echo $budget_grid->SubProgramCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubProgramCode" class="<?php echo $budget_grid->SubProgramCode->headerCellClass() ?>"><div><div id="elh_budget_SubProgramCode" class="budget_SubProgramCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_grid->SubProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_grid->SubProgramCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_grid->SubProgramCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_grid->ApprovedBudget->Visible) { // ApprovedBudget ?>
	<?php if ($budget_grid->SortUrl($budget_grid->ApprovedBudget) == "") { ?>
		<th data-name="ApprovedBudget" class="<?php echo $budget_grid->ApprovedBudget->headerCellClass() ?>"><div id="elh_budget_ApprovedBudget" class="budget_ApprovedBudget"><div class="ew-table-header-caption"><?php echo $budget_grid->ApprovedBudget->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ApprovedBudget" class="<?php echo $budget_grid->ApprovedBudget->headerCellClass() ?>"><div><div id="elh_budget_ApprovedBudget" class="budget_ApprovedBudget">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_grid->ApprovedBudget->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_grid->ApprovedBudget->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_grid->ApprovedBudget->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$budget_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$budget_grid->StartRecord = 1;
$budget_grid->StopRecord = $budget_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($budget->isConfirm() || $budget_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($budget_grid->FormKeyCountName) && ($budget_grid->isGridAdd() || $budget_grid->isGridEdit() || $budget->isConfirm())) {
		$budget_grid->KeyCount = $CurrentForm->getValue($budget_grid->FormKeyCountName);
		$budget_grid->StopRecord = $budget_grid->StartRecord + $budget_grid->KeyCount - 1;
	}
}
$budget_grid->RecordCount = $budget_grid->StartRecord - 1;
if ($budget_grid->Recordset && !$budget_grid->Recordset->EOF) {
	$budget_grid->Recordset->moveFirst();
	$selectLimit = $budget_grid->UseSelectLimit;
	if (!$selectLimit && $budget_grid->StartRecord > 1)
		$budget_grid->Recordset->move($budget_grid->StartRecord - 1);
} elseif (!$budget->AllowAddDeleteRow && $budget_grid->StopRecord == 0) {
	$budget_grid->StopRecord = $budget->GridAddRowCount;
}

// Initialize aggregate
$budget->RowType = ROWTYPE_AGGREGATEINIT;
$budget->resetAttributes();
$budget_grid->renderRow();
if ($budget_grid->isGridAdd())
	$budget_grid->RowIndex = 0;
if ($budget_grid->isGridEdit())
	$budget_grid->RowIndex = 0;
while ($budget_grid->RecordCount < $budget_grid->StopRecord) {
	$budget_grid->RecordCount++;
	if ($budget_grid->RecordCount >= $budget_grid->StartRecord) {
		$budget_grid->RowCount++;
		if ($budget_grid->isGridAdd() || $budget_grid->isGridEdit() || $budget->isConfirm()) {
			$budget_grid->RowIndex++;
			$CurrentForm->Index = $budget_grid->RowIndex;
			if ($CurrentForm->hasValue($budget_grid->FormActionName) && ($budget->isConfirm() || $budget_grid->EventCancelled))
				$budget_grid->RowAction = strval($CurrentForm->getValue($budget_grid->FormActionName));
			elseif ($budget_grid->isGridAdd())
				$budget_grid->RowAction = "insert";
			else
				$budget_grid->RowAction = "";
		}

		// Set up key count
		$budget_grid->KeyCount = $budget_grid->RowIndex;

		// Init row class and style
		$budget->resetAttributes();
		$budget->CssClass = "";
		if ($budget_grid->isGridAdd()) {
			if ($budget->CurrentMode == "copy") {
				$budget_grid->loadRowValues($budget_grid->Recordset); // Load row values
				$budget_grid->setRecordKey($budget_grid->RowOldKey, $budget_grid->Recordset); // Set old record key
			} else {
				$budget_grid->loadRowValues(); // Load default values
				$budget_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$budget_grid->loadRowValues($budget_grid->Recordset); // Load row values
		}
		$budget->RowType = ROWTYPE_VIEW; // Render view
		if ($budget_grid->isGridAdd()) // Grid add
			$budget->RowType = ROWTYPE_ADD; // Render add
		if ($budget_grid->isGridAdd() && $budget->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$budget_grid->restoreCurrentRowFormValues($budget_grid->RowIndex); // Restore form values
		if ($budget_grid->isGridEdit()) { // Grid edit
			if ($budget->EventCancelled)
				$budget_grid->restoreCurrentRowFormValues($budget_grid->RowIndex); // Restore form values
			if ($budget_grid->RowAction == "insert")
				$budget->RowType = ROWTYPE_ADD; // Render add
			else
				$budget->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($budget_grid->isGridEdit() && ($budget->RowType == ROWTYPE_EDIT || $budget->RowType == ROWTYPE_ADD) && $budget->EventCancelled) // Update failed
			$budget_grid->restoreCurrentRowFormValues($budget_grid->RowIndex); // Restore form values
		if ($budget->RowType == ROWTYPE_EDIT) // Edit row
			$budget_grid->EditRowCount++;
		if ($budget->isConfirm()) // Confirm row
			$budget_grid->restoreCurrentRowFormValues($budget_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$budget->RowAttrs->merge(["data-rowindex" => $budget_grid->RowCount, "id" => "r" . $budget_grid->RowCount . "_budget", "data-rowtype" => $budget->RowType]);

		// Render row
		$budget_grid->renderRow();

		// Render list options
		$budget_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($budget_grid->RowAction != "delete" && $budget_grid->RowAction != "insertdelete" && !($budget_grid->RowAction == "insert" && $budget->isConfirm() && $budget_grid->emptyRow())) {
?>
	<tr <?php echo $budget->rowAttributes() ?>>
<?php

// Render list options (body, left)
$budget_grid->ListOptions->render("body", "left", $budget_grid->RowCount);
?>
	<?php if ($budget_grid->OutcomeCode->Visible) { // OutcomeCode ?>
		<td data-name="OutcomeCode" <?php echo $budget_grid->OutcomeCode->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($budget_grid->OutcomeCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_OutcomeCode" class="form-group">
<span<?php echo $budget_grid->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_OutcomeCode" name="x<?php echo $budget_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($budget_grid->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_OutcomeCode" class="form-group">
<?php $budget_grid->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_grid->RowIndex ?>_OutcomeCode"><?php echo EmptyValue(strval($budget_grid->OutcomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_grid->OutcomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_grid->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_grid->OutcomeCode->ReadOnly || $budget_grid->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_grid->RowIndex ?>_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_grid->OutcomeCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_OutcomeCode") ?>
<input type="hidden" data-table="budget" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_grid->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_grid->RowIndex ?>_OutcomeCode" id="x<?php echo $budget_grid->RowIndex ?>_OutcomeCode" value="<?php echo $budget_grid->OutcomeCode->CurrentValue ?>"<?php echo $budget_grid->OutcomeCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_OutcomeCode" name="o<?php echo $budget_grid->RowIndex ?>_OutcomeCode" id="o<?php echo $budget_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($budget_grid->OutcomeCode->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($budget_grid->OutcomeCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_OutcomeCode" class="form-group">
<span<?php echo $budget_grid->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_OutcomeCode" name="x<?php echo $budget_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($budget_grid->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_OutcomeCode" class="form-group">
<?php $budget_grid->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_grid->RowIndex ?>_OutcomeCode"><?php echo EmptyValue(strval($budget_grid->OutcomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_grid->OutcomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_grid->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_grid->OutcomeCode->ReadOnly || $budget_grid->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_grid->RowIndex ?>_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_grid->OutcomeCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_OutcomeCode") ?>
<input type="hidden" data-table="budget" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_grid->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_grid->RowIndex ?>_OutcomeCode" id="x<?php echo $budget_grid->RowIndex ?>_OutcomeCode" value="<?php echo $budget_grid->OutcomeCode->CurrentValue ?>"<?php echo $budget_grid->OutcomeCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_OutcomeCode">
<span<?php echo $budget_grid->OutcomeCode->viewAttributes() ?>><?php echo $budget_grid->OutcomeCode->getViewValue() ?></span>
</span>
<?php if (!$budget->isConfirm()) { ?>
<input type="hidden" data-table="budget" data-field="x_OutcomeCode" name="x<?php echo $budget_grid->RowIndex ?>_OutcomeCode" id="x<?php echo $budget_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($budget_grid->OutcomeCode->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_OutcomeCode" name="o<?php echo $budget_grid->RowIndex ?>_OutcomeCode" id="o<?php echo $budget_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($budget_grid->OutcomeCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget" data-field="x_OutcomeCode" name="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_OutcomeCode" id="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($budget_grid->OutcomeCode->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_OutcomeCode" name="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_OutcomeCode" id="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($budget_grid->OutcomeCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_grid->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode" <?php echo $budget_grid->OutputCode->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($budget_grid->OutputCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_OutputCode" class="form-group">
<span<?php echo $budget_grid->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_OutputCode" name="x<?php echo $budget_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($budget_grid->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_OutputCode" class="form-group">
<?php $budget_grid->OutputCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_grid->RowIndex ?>_OutputCode"><?php echo EmptyValue(strval($budget_grid->OutputCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_grid->OutputCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_grid->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_grid->OutputCode->ReadOnly || $budget_grid->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_grid->RowIndex ?>_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_grid->OutputCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_OutputCode") ?>
<input type="hidden" data-table="budget" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_grid->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_grid->RowIndex ?>_OutputCode" id="x<?php echo $budget_grid->RowIndex ?>_OutputCode" value="<?php echo $budget_grid->OutputCode->CurrentValue ?>"<?php echo $budget_grid->OutputCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_OutputCode" name="o<?php echo $budget_grid->RowIndex ?>_OutputCode" id="o<?php echo $budget_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($budget_grid->OutputCode->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($budget_grid->OutputCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_OutputCode" class="form-group">
<span<?php echo $budget_grid->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_OutputCode" name="x<?php echo $budget_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($budget_grid->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_OutputCode" class="form-group">
<?php $budget_grid->OutputCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_grid->RowIndex ?>_OutputCode"><?php echo EmptyValue(strval($budget_grid->OutputCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_grid->OutputCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_grid->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_grid->OutputCode->ReadOnly || $budget_grid->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_grid->RowIndex ?>_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_grid->OutputCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_OutputCode") ?>
<input type="hidden" data-table="budget" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_grid->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_grid->RowIndex ?>_OutputCode" id="x<?php echo $budget_grid->RowIndex ?>_OutputCode" value="<?php echo $budget_grid->OutputCode->CurrentValue ?>"<?php echo $budget_grid->OutputCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_OutputCode">
<span<?php echo $budget_grid->OutputCode->viewAttributes() ?>><?php echo $budget_grid->OutputCode->getViewValue() ?></span>
</span>
<?php if (!$budget->isConfirm()) { ?>
<input type="hidden" data-table="budget" data-field="x_OutputCode" name="x<?php echo $budget_grid->RowIndex ?>_OutputCode" id="x<?php echo $budget_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($budget_grid->OutputCode->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_OutputCode" name="o<?php echo $budget_grid->RowIndex ?>_OutputCode" id="o<?php echo $budget_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($budget_grid->OutputCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget" data-field="x_OutputCode" name="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_OutputCode" id="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($budget_grid->OutputCode->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_OutputCode" name="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_OutputCode" id="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($budget_grid->OutputCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_grid->ActionCode->Visible) { // ActionCode ?>
		<td data-name="ActionCode" <?php echo $budget_grid->ActionCode->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($budget_grid->ActionCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_ActionCode" class="form-group">
<span<?php echo $budget_grid->ActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->ActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_ActionCode" name="x<?php echo $budget_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($budget_grid->ActionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_ActionCode" class="form-group">
<?php $budget_grid->ActionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_ActionCode" data-value-separator="<?php echo $budget_grid->ActionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_grid->RowIndex ?>_ActionCode" name="x<?php echo $budget_grid->RowIndex ?>_ActionCode"<?php echo $budget_grid->ActionCode->editAttributes() ?>>
			<?php echo $budget_grid->ActionCode->selectOptionListHtml("x{$budget_grid->RowIndex}_ActionCode") ?>
		</select>
</div>
<?php echo $budget_grid->ActionCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_ActionCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_ActionCode" name="o<?php echo $budget_grid->RowIndex ?>_ActionCode" id="o<?php echo $budget_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($budget_grid->ActionCode->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($budget_grid->ActionCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_ActionCode" class="form-group">
<span<?php echo $budget_grid->ActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->ActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_ActionCode" name="x<?php echo $budget_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($budget_grid->ActionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_ActionCode" class="form-group">
<?php $budget_grid->ActionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_ActionCode" data-value-separator="<?php echo $budget_grid->ActionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_grid->RowIndex ?>_ActionCode" name="x<?php echo $budget_grid->RowIndex ?>_ActionCode"<?php echo $budget_grid->ActionCode->editAttributes() ?>>
			<?php echo $budget_grid->ActionCode->selectOptionListHtml("x{$budget_grid->RowIndex}_ActionCode") ?>
		</select>
</div>
<?php echo $budget_grid->ActionCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_ActionCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_ActionCode">
<span<?php echo $budget_grid->ActionCode->viewAttributes() ?>><?php echo $budget_grid->ActionCode->getViewValue() ?></span>
</span>
<?php if (!$budget->isConfirm()) { ?>
<input type="hidden" data-table="budget" data-field="x_ActionCode" name="x<?php echo $budget_grid->RowIndex ?>_ActionCode" id="x<?php echo $budget_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($budget_grid->ActionCode->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_ActionCode" name="o<?php echo $budget_grid->RowIndex ?>_ActionCode" id="o<?php echo $budget_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($budget_grid->ActionCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget" data-field="x_ActionCode" name="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_ActionCode" id="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($budget_grid->ActionCode->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_ActionCode" name="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_ActionCode" id="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($budget_grid->ActionCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_grid->DetailedActionCode->Visible) { // DetailedActionCode ?>
		<td data-name="DetailedActionCode" <?php echo $budget_grid->DetailedActionCode->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($budget_grid->DetailedActionCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_DetailedActionCode" class="form-group">
<span<?php echo $budget_grid->DetailedActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->DetailedActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" name="x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($budget_grid->DetailedActionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_DetailedActionCode" class="form-group">
<?php
$onchange = $budget_grid->DetailedActionCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_grid->DetailedActionCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" id="sv_x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" value="<?php echo RemoveHtml($budget_grid->DetailedActionCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($budget_grid->DetailedActionCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_grid->DetailedActionCode->getPlaceHolder()) ?>"<?php echo $budget_grid->DetailedActionCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_grid->DetailedActionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($budget_grid->DetailedActionCode->ReadOnly || $budget_grid->DetailedActionCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="budget" data-field="x_DetailedActionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_grid->DetailedActionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" id="x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($budget_grid->DetailedActionCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudgetgrid"], function() {
	fbudgetgrid.createAutoSuggest({"id":"x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode","forceSelect":false});
});
</script>
<?php echo $budget_grid->DetailedActionCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_DetailedActionCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_DetailedActionCode" name="o<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" id="o<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($budget_grid->DetailedActionCode->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($budget_grid->DetailedActionCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_DetailedActionCode" class="form-group">
<span<?php echo $budget_grid->DetailedActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->DetailedActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" name="x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($budget_grid->DetailedActionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_DetailedActionCode" class="form-group">
<?php
$onchange = $budget_grid->DetailedActionCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_grid->DetailedActionCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" id="sv_x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" value="<?php echo RemoveHtml($budget_grid->DetailedActionCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($budget_grid->DetailedActionCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_grid->DetailedActionCode->getPlaceHolder()) ?>"<?php echo $budget_grid->DetailedActionCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_grid->DetailedActionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($budget_grid->DetailedActionCode->ReadOnly || $budget_grid->DetailedActionCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="budget" data-field="x_DetailedActionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_grid->DetailedActionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" id="x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($budget_grid->DetailedActionCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudgetgrid"], function() {
	fbudgetgrid.createAutoSuggest({"id":"x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode","forceSelect":false});
});
</script>
<?php echo $budget_grid->DetailedActionCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_DetailedActionCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_DetailedActionCode">
<span<?php echo $budget_grid->DetailedActionCode->viewAttributes() ?>><?php echo $budget_grid->DetailedActionCode->getViewValue() ?></span>
</span>
<?php if (!$budget->isConfirm()) { ?>
<input type="hidden" data-table="budget" data-field="x_DetailedActionCode" name="x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" id="x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($budget_grid->DetailedActionCode->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_DetailedActionCode" name="o<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" id="o<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($budget_grid->DetailedActionCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget" data-field="x_DetailedActionCode" name="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" id="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($budget_grid->DetailedActionCode->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_DetailedActionCode" name="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" id="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($budget_grid->DetailedActionCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_grid->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear" <?php echo $budget_grid->FinancialYear->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($budget_grid->FinancialYear->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_FinancialYear" class="form-group">
<span<?php echo $budget_grid->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_FinancialYear" name="x<?php echo $budget_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($budget_grid->FinancialYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_FinancialYear" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_FinancialYear" data-value-separator="<?php echo $budget_grid->FinancialYear->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_grid->RowIndex ?>_FinancialYear" name="x<?php echo $budget_grid->RowIndex ?>_FinancialYear"<?php echo $budget_grid->FinancialYear->editAttributes() ?>>
			<?php echo $budget_grid->FinancialYear->selectOptionListHtml("x{$budget_grid->RowIndex}_FinancialYear") ?>
		</select>
</div>
<?php echo $budget_grid->FinancialYear->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_FinancialYear") ?>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_FinancialYear" name="o<?php echo $budget_grid->RowIndex ?>_FinancialYear" id="o<?php echo $budget_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($budget_grid->FinancialYear->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($budget_grid->FinancialYear->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_FinancialYear" class="form-group">
<span<?php echo $budget_grid->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_FinancialYear" name="x<?php echo $budget_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($budget_grid->FinancialYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_FinancialYear" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_FinancialYear" data-value-separator="<?php echo $budget_grid->FinancialYear->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_grid->RowIndex ?>_FinancialYear" name="x<?php echo $budget_grid->RowIndex ?>_FinancialYear"<?php echo $budget_grid->FinancialYear->editAttributes() ?>>
			<?php echo $budget_grid->FinancialYear->selectOptionListHtml("x{$budget_grid->RowIndex}_FinancialYear") ?>
		</select>
</div>
<?php echo $budget_grid->FinancialYear->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_FinancialYear") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_FinancialYear">
<span<?php echo $budget_grid->FinancialYear->viewAttributes() ?>><?php echo $budget_grid->FinancialYear->getViewValue() ?></span>
</span>
<?php if (!$budget->isConfirm()) { ?>
<input type="hidden" data-table="budget" data-field="x_FinancialYear" name="x<?php echo $budget_grid->RowIndex ?>_FinancialYear" id="x<?php echo $budget_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($budget_grid->FinancialYear->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_FinancialYear" name="o<?php echo $budget_grid->RowIndex ?>_FinancialYear" id="o<?php echo $budget_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($budget_grid->FinancialYear->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget" data-field="x_FinancialYear" name="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_FinancialYear" id="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($budget_grid->FinancialYear->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_FinancialYear" name="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_FinancialYear" id="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($budget_grid->FinancialYear->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_grid->AccountCode->Visible) { // AccountCode ?>
		<td data-name="AccountCode" <?php echo $budget_grid->AccountCode->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_AccountCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_grid->RowIndex ?>_AccountCode"><?php echo EmptyValue(strval($budget_grid->AccountCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_grid->AccountCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_grid->AccountCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_grid->AccountCode->ReadOnly || $budget_grid->AccountCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_grid->RowIndex ?>_AccountCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_grid->AccountCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_AccountCode") ?>
<input type="hidden" data-table="budget" data-field="x_AccountCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_grid->AccountCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_grid->RowIndex ?>_AccountCode" id="x<?php echo $budget_grid->RowIndex ?>_AccountCode" value="<?php echo $budget_grid->AccountCode->CurrentValue ?>"<?php echo $budget_grid->AccountCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget" data-field="x_AccountCode" name="o<?php echo $budget_grid->RowIndex ?>_AccountCode" id="o<?php echo $budget_grid->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($budget_grid->AccountCode->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_AccountCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_grid->RowIndex ?>_AccountCode"><?php echo EmptyValue(strval($budget_grid->AccountCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_grid->AccountCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_grid->AccountCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_grid->AccountCode->ReadOnly || $budget_grid->AccountCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_grid->RowIndex ?>_AccountCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_grid->AccountCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_AccountCode") ?>
<input type="hidden" data-table="budget" data-field="x_AccountCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_grid->AccountCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_grid->RowIndex ?>_AccountCode" id="x<?php echo $budget_grid->RowIndex ?>_AccountCode" value="<?php echo $budget_grid->AccountCode->CurrentValue ?>"<?php echo $budget_grid->AccountCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_AccountCode">
<span<?php echo $budget_grid->AccountCode->viewAttributes() ?>><?php echo $budget_grid->AccountCode->getViewValue() ?></span>
</span>
<?php if (!$budget->isConfirm()) { ?>
<input type="hidden" data-table="budget" data-field="x_AccountCode" name="x<?php echo $budget_grid->RowIndex ?>_AccountCode" id="x<?php echo $budget_grid->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($budget_grid->AccountCode->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_AccountCode" name="o<?php echo $budget_grid->RowIndex ?>_AccountCode" id="o<?php echo $budget_grid->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($budget_grid->AccountCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget" data-field="x_AccountCode" name="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_AccountCode" id="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($budget_grid->AccountCode->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_AccountCode" name="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_AccountCode" id="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($budget_grid->AccountCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_grid->MeansOfImplementation->Visible) { // MeansOfImplementation ?>
		<td data-name="MeansOfImplementation" <?php echo $budget_grid->MeansOfImplementation->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_MeansOfImplementation" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation"><?php echo EmptyValue(strval($budget_grid->MeansOfImplementation->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_grid->MeansOfImplementation->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_grid->MeansOfImplementation->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_grid->MeansOfImplementation->ReadOnly || $budget_grid->MeansOfImplementation->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_grid->MeansOfImplementation->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_MeansOfImplementation") ?>
<input type="hidden" data-table="budget" data-field="x_MeansOfImplementation" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_grid->MeansOfImplementation->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation" id="x<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation" value="<?php echo $budget_grid->MeansOfImplementation->CurrentValue ?>"<?php echo $budget_grid->MeansOfImplementation->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget" data-field="x_MeansOfImplementation" name="o<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation" id="o<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation" value="<?php echo HtmlEncode($budget_grid->MeansOfImplementation->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_MeansOfImplementation" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation"><?php echo EmptyValue(strval($budget_grid->MeansOfImplementation->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_grid->MeansOfImplementation->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_grid->MeansOfImplementation->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_grid->MeansOfImplementation->ReadOnly || $budget_grid->MeansOfImplementation->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_grid->MeansOfImplementation->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_MeansOfImplementation") ?>
<input type="hidden" data-table="budget" data-field="x_MeansOfImplementation" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_grid->MeansOfImplementation->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation" id="x<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation" value="<?php echo $budget_grid->MeansOfImplementation->CurrentValue ?>"<?php echo $budget_grid->MeansOfImplementation->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_MeansOfImplementation">
<span<?php echo $budget_grid->MeansOfImplementation->viewAttributes() ?>><?php echo $budget_grid->MeansOfImplementation->getViewValue() ?></span>
</span>
<?php if (!$budget->isConfirm()) { ?>
<input type="hidden" data-table="budget" data-field="x_MeansOfImplementation" name="x<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation" id="x<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation" value="<?php echo HtmlEncode($budget_grid->MeansOfImplementation->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_MeansOfImplementation" name="o<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation" id="o<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation" value="<?php echo HtmlEncode($budget_grid->MeansOfImplementation->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget" data-field="x_MeansOfImplementation" name="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation" id="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation" value="<?php echo HtmlEncode($budget_grid->MeansOfImplementation->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_MeansOfImplementation" name="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation" id="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation" value="<?php echo HtmlEncode($budget_grid->MeansOfImplementation->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_grid->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" <?php echo $budget_grid->UnitOfMeasure->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_UnitOfMeasure" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_UnitOfMeasure" data-value-separator="<?php echo $budget_grid->UnitOfMeasure->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_grid->RowIndex ?>_UnitOfMeasure" name="x<?php echo $budget_grid->RowIndex ?>_UnitOfMeasure"<?php echo $budget_grid->UnitOfMeasure->editAttributes() ?>>
			<?php echo $budget_grid->UnitOfMeasure->selectOptionListHtml("x{$budget_grid->RowIndex}_UnitOfMeasure") ?>
		</select>
</div>
<?php echo $budget_grid->UnitOfMeasure->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_UnitOfMeasure") ?>
</span>
<input type="hidden" data-table="budget" data-field="x_UnitOfMeasure" name="o<?php echo $budget_grid->RowIndex ?>_UnitOfMeasure" id="o<?php echo $budget_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($budget_grid->UnitOfMeasure->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_UnitOfMeasure" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_UnitOfMeasure" data-value-separator="<?php echo $budget_grid->UnitOfMeasure->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_grid->RowIndex ?>_UnitOfMeasure" name="x<?php echo $budget_grid->RowIndex ?>_UnitOfMeasure"<?php echo $budget_grid->UnitOfMeasure->editAttributes() ?>>
			<?php echo $budget_grid->UnitOfMeasure->selectOptionListHtml("x{$budget_grid->RowIndex}_UnitOfMeasure") ?>
		</select>
</div>
<?php echo $budget_grid->UnitOfMeasure->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_UnitOfMeasure") ?>
</span>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_UnitOfMeasure">
<span<?php echo $budget_grid->UnitOfMeasure->viewAttributes() ?>><?php echo $budget_grid->UnitOfMeasure->getViewValue() ?></span>
</span>
<?php if (!$budget->isConfirm()) { ?>
<input type="hidden" data-table="budget" data-field="x_UnitOfMeasure" name="x<?php echo $budget_grid->RowIndex ?>_UnitOfMeasure" id="x<?php echo $budget_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($budget_grid->UnitOfMeasure->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_UnitOfMeasure" name="o<?php echo $budget_grid->RowIndex ?>_UnitOfMeasure" id="o<?php echo $budget_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($budget_grid->UnitOfMeasure->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget" data-field="x_UnitOfMeasure" name="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_UnitOfMeasure" id="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($budget_grid->UnitOfMeasure->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_UnitOfMeasure" name="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_UnitOfMeasure" id="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($budget_grid->UnitOfMeasure->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_grid->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity" <?php echo $budget_grid->Quantity->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_Quantity" class="form-group">
<input type="text" data-table="budget" data-field="x_Quantity" name="x<?php echo $budget_grid->RowIndex ?>_Quantity" id="x<?php echo $budget_grid->RowIndex ?>_Quantity" size="30" placeholder="<?php echo HtmlEncode($budget_grid->Quantity->getPlaceHolder()) ?>" value="<?php echo $budget_grid->Quantity->EditValue ?>"<?php echo $budget_grid->Quantity->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget" data-field="x_Quantity" name="o<?php echo $budget_grid->RowIndex ?>_Quantity" id="o<?php echo $budget_grid->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($budget_grid->Quantity->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_Quantity" class="form-group">
<input type="text" data-table="budget" data-field="x_Quantity" name="x<?php echo $budget_grid->RowIndex ?>_Quantity" id="x<?php echo $budget_grid->RowIndex ?>_Quantity" size="30" placeholder="<?php echo HtmlEncode($budget_grid->Quantity->getPlaceHolder()) ?>" value="<?php echo $budget_grid->Quantity->EditValue ?>"<?php echo $budget_grid->Quantity->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_Quantity">
<span<?php echo $budget_grid->Quantity->viewAttributes() ?>><?php echo $budget_grid->Quantity->getViewValue() ?></span>
</span>
<?php if (!$budget->isConfirm()) { ?>
<input type="hidden" data-table="budget" data-field="x_Quantity" name="x<?php echo $budget_grid->RowIndex ?>_Quantity" id="x<?php echo $budget_grid->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($budget_grid->Quantity->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_Quantity" name="o<?php echo $budget_grid->RowIndex ?>_Quantity" id="o<?php echo $budget_grid->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($budget_grid->Quantity->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget" data-field="x_Quantity" name="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_Quantity" id="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($budget_grid->Quantity->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_Quantity" name="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_Quantity" id="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($budget_grid->Quantity->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_grid->Frequency->Visible) { // Frequency ?>
		<td data-name="Frequency" <?php echo $budget_grid->Frequency->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_Frequency" class="form-group">
<input type="text" data-table="budget" data-field="x_Frequency" name="x<?php echo $budget_grid->RowIndex ?>_Frequency" id="x<?php echo $budget_grid->RowIndex ?>_Frequency" size="30" placeholder="<?php echo HtmlEncode($budget_grid->Frequency->getPlaceHolder()) ?>" value="<?php echo $budget_grid->Frequency->EditValue ?>"<?php echo $budget_grid->Frequency->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget" data-field="x_Frequency" name="o<?php echo $budget_grid->RowIndex ?>_Frequency" id="o<?php echo $budget_grid->RowIndex ?>_Frequency" value="<?php echo HtmlEncode($budget_grid->Frequency->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_Frequency" class="form-group">
<input type="text" data-table="budget" data-field="x_Frequency" name="x<?php echo $budget_grid->RowIndex ?>_Frequency" id="x<?php echo $budget_grid->RowIndex ?>_Frequency" size="30" placeholder="<?php echo HtmlEncode($budget_grid->Frequency->getPlaceHolder()) ?>" value="<?php echo $budget_grid->Frequency->EditValue ?>"<?php echo $budget_grid->Frequency->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_Frequency">
<span<?php echo $budget_grid->Frequency->viewAttributes() ?>><?php echo $budget_grid->Frequency->getViewValue() ?></span>
</span>
<?php if (!$budget->isConfirm()) { ?>
<input type="hidden" data-table="budget" data-field="x_Frequency" name="x<?php echo $budget_grid->RowIndex ?>_Frequency" id="x<?php echo $budget_grid->RowIndex ?>_Frequency" value="<?php echo HtmlEncode($budget_grid->Frequency->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_Frequency" name="o<?php echo $budget_grid->RowIndex ?>_Frequency" id="o<?php echo $budget_grid->RowIndex ?>_Frequency" value="<?php echo HtmlEncode($budget_grid->Frequency->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget" data-field="x_Frequency" name="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_Frequency" id="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_Frequency" value="<?php echo HtmlEncode($budget_grid->Frequency->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_Frequency" name="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_Frequency" id="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_Frequency" value="<?php echo HtmlEncode($budget_grid->Frequency->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_grid->UnitCost->Visible) { // UnitCost ?>
		<td data-name="UnitCost" <?php echo $budget_grid->UnitCost->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_UnitCost" class="form-group">
<input type="text" data-table="budget" data-field="x_UnitCost" name="x<?php echo $budget_grid->RowIndex ?>_UnitCost" id="x<?php echo $budget_grid->RowIndex ?>_UnitCost" size="30" placeholder="<?php echo HtmlEncode($budget_grid->UnitCost->getPlaceHolder()) ?>" value="<?php echo $budget_grid->UnitCost->EditValue ?>"<?php echo $budget_grid->UnitCost->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget" data-field="x_UnitCost" name="o<?php echo $budget_grid->RowIndex ?>_UnitCost" id="o<?php echo $budget_grid->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($budget_grid->UnitCost->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_UnitCost" class="form-group">
<input type="text" data-table="budget" data-field="x_UnitCost" name="x<?php echo $budget_grid->RowIndex ?>_UnitCost" id="x<?php echo $budget_grid->RowIndex ?>_UnitCost" size="30" placeholder="<?php echo HtmlEncode($budget_grid->UnitCost->getPlaceHolder()) ?>" value="<?php echo $budget_grid->UnitCost->EditValue ?>"<?php echo $budget_grid->UnitCost->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_UnitCost">
<span<?php echo $budget_grid->UnitCost->viewAttributes() ?>><?php echo $budget_grid->UnitCost->getViewValue() ?></span>
</span>
<?php if (!$budget->isConfirm()) { ?>
<input type="hidden" data-table="budget" data-field="x_UnitCost" name="x<?php echo $budget_grid->RowIndex ?>_UnitCost" id="x<?php echo $budget_grid->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($budget_grid->UnitCost->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_UnitCost" name="o<?php echo $budget_grid->RowIndex ?>_UnitCost" id="o<?php echo $budget_grid->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($budget_grid->UnitCost->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget" data-field="x_UnitCost" name="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_UnitCost" id="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($budget_grid->UnitCost->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_UnitCost" name="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_UnitCost" id="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($budget_grid->UnitCost->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_grid->BudgetEstimate->Visible) { // BudgetEstimate ?>
		<td data-name="BudgetEstimate" <?php echo $budget_grid->BudgetEstimate->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_BudgetEstimate" class="form-group">
<input type="text" data-table="budget" data-field="x_BudgetEstimate" name="x<?php echo $budget_grid->RowIndex ?>_BudgetEstimate" id="x<?php echo $budget_grid->RowIndex ?>_BudgetEstimate" size="30" placeholder="<?php echo HtmlEncode($budget_grid->BudgetEstimate->getPlaceHolder()) ?>" value="<?php echo $budget_grid->BudgetEstimate->EditValue ?>"<?php echo $budget_grid->BudgetEstimate->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget" data-field="x_BudgetEstimate" name="o<?php echo $budget_grid->RowIndex ?>_BudgetEstimate" id="o<?php echo $budget_grid->RowIndex ?>_BudgetEstimate" value="<?php echo HtmlEncode($budget_grid->BudgetEstimate->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_BudgetEstimate" class="form-group">
<input type="text" data-table="budget" data-field="x_BudgetEstimate" name="x<?php echo $budget_grid->RowIndex ?>_BudgetEstimate" id="x<?php echo $budget_grid->RowIndex ?>_BudgetEstimate" size="30" placeholder="<?php echo HtmlEncode($budget_grid->BudgetEstimate->getPlaceHolder()) ?>" value="<?php echo $budget_grid->BudgetEstimate->EditValue ?>"<?php echo $budget_grid->BudgetEstimate->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_BudgetEstimate">
<span<?php echo $budget_grid->BudgetEstimate->viewAttributes() ?>><?php echo $budget_grid->BudgetEstimate->getViewValue() ?></span>
</span>
<?php if (!$budget->isConfirm()) { ?>
<input type="hidden" data-table="budget" data-field="x_BudgetEstimate" name="x<?php echo $budget_grid->RowIndex ?>_BudgetEstimate" id="x<?php echo $budget_grid->RowIndex ?>_BudgetEstimate" value="<?php echo HtmlEncode($budget_grid->BudgetEstimate->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_BudgetEstimate" name="o<?php echo $budget_grid->RowIndex ?>_BudgetEstimate" id="o<?php echo $budget_grid->RowIndex ?>_BudgetEstimate" value="<?php echo HtmlEncode($budget_grid->BudgetEstimate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget" data-field="x_BudgetEstimate" name="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_BudgetEstimate" id="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_BudgetEstimate" value="<?php echo HtmlEncode($budget_grid->BudgetEstimate->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_BudgetEstimate" name="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_BudgetEstimate" id="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_BudgetEstimate" value="<?php echo HtmlEncode($budget_grid->BudgetEstimate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $budget_grid->LACode->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($budget_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_LACode" class="form-group">
<span<?php echo $budget_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_LACode" name="x<?php echo $budget_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_LACode" class="form-group">
<?php
$onchange = $budget_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $budget_grid->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $budget_grid->RowIndex ?>_LACode" id="sv_x<?php echo $budget_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($budget_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($budget_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_grid->LACode->getPlaceHolder()) ?>"<?php echo $budget_grid->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_grid->RowIndex ?>_LACode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($budget_grid->LACode->ReadOnly || $budget_grid->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="budget" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_grid->RowIndex ?>_LACode" id="x<?php echo $budget_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudgetgrid"], function() {
	fbudgetgrid.createAutoSuggest({"id":"x<?php echo $budget_grid->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $budget_grid->LACode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_LACode" name="o<?php echo $budget_grid->RowIndex ?>_LACode" id="o<?php echo $budget_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($budget_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_LACode" class="form-group">
<span<?php echo $budget_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_LACode" name="x<?php echo $budget_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_LACode" class="form-group">
<?php
$onchange = $budget_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $budget_grid->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $budget_grid->RowIndex ?>_LACode" id="sv_x<?php echo $budget_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($budget_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($budget_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_grid->LACode->getPlaceHolder()) ?>"<?php echo $budget_grid->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_grid->RowIndex ?>_LACode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($budget_grid->LACode->ReadOnly || $budget_grid->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="budget" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_grid->RowIndex ?>_LACode" id="x<?php echo $budget_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudgetgrid"], function() {
	fbudgetgrid.createAutoSuggest({"id":"x<?php echo $budget_grid->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $budget_grid->LACode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_LACode">
<span<?php echo $budget_grid->LACode->viewAttributes() ?>><?php echo $budget_grid->LACode->getViewValue() ?></span>
</span>
<?php if (!$budget->isConfirm()) { ?>
<input type="hidden" data-table="budget" data-field="x_LACode" name="x<?php echo $budget_grid->RowIndex ?>_LACode" id="x<?php echo $budget_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_LACode" name="o<?php echo $budget_grid->RowIndex ?>_LACode" id="o<?php echo $budget_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_grid->LACode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget" data-field="x_LACode" name="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_LACode" id="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_LACode" name="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_LACode" id="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_grid->LACode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $budget_grid->DepartmentCode->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($budget_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_DepartmentCode" class="form-group">
<span<?php echo $budget_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $budget_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($budget_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_DepartmentCode" class="form-group">
<?php $budget_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_DepartmentCode" data-value-separator="<?php echo $budget_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $budget_grid->RowIndex ?>_DepartmentCode"<?php echo $budget_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $budget_grid->DepartmentCode->selectOptionListHtml("x{$budget_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $budget_grid->DepartmentCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_DepartmentCode" name="o<?php echo $budget_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $budget_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($budget_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($budget_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_DepartmentCode" class="form-group">
<span<?php echo $budget_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $budget_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($budget_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_DepartmentCode" class="form-group">
<?php $budget_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_DepartmentCode" data-value-separator="<?php echo $budget_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $budget_grid->RowIndex ?>_DepartmentCode"<?php echo $budget_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $budget_grid->DepartmentCode->selectOptionListHtml("x{$budget_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $budget_grid->DepartmentCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_DepartmentCode">
<span<?php echo $budget_grid->DepartmentCode->viewAttributes() ?>><?php echo $budget_grid->DepartmentCode->getViewValue() ?></span>
</span>
<?php if (!$budget->isConfirm()) { ?>
<input type="hidden" data-table="budget" data-field="x_DepartmentCode" name="x<?php echo $budget_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $budget_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($budget_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_DepartmentCode" name="o<?php echo $budget_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $budget_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($budget_grid->DepartmentCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget" data-field="x_DepartmentCode" name="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_DepartmentCode" id="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($budget_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_DepartmentCode" name="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_DepartmentCode" id="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($budget_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $budget_grid->SectionCode->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_SectionCode" data-value-separator="<?php echo $budget_grid->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_grid->RowIndex ?>_SectionCode" name="x<?php echo $budget_grid->RowIndex ?>_SectionCode"<?php echo $budget_grid->SectionCode->editAttributes() ?>>
			<?php echo $budget_grid->SectionCode->selectOptionListHtml("x{$budget_grid->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $budget_grid->SectionCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_SectionCode") ?>
</span>
<input type="hidden" data-table="budget" data-field="x_SectionCode" name="o<?php echo $budget_grid->RowIndex ?>_SectionCode" id="o<?php echo $budget_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($budget_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_SectionCode" data-value-separator="<?php echo $budget_grid->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_grid->RowIndex ?>_SectionCode" name="x<?php echo $budget_grid->RowIndex ?>_SectionCode"<?php echo $budget_grid->SectionCode->editAttributes() ?>>
			<?php echo $budget_grid->SectionCode->selectOptionListHtml("x{$budget_grid->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $budget_grid->SectionCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_SectionCode") ?>
</span>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_SectionCode">
<span<?php echo $budget_grid->SectionCode->viewAttributes() ?>><?php echo $budget_grid->SectionCode->getViewValue() ?></span>
</span>
<?php if (!$budget->isConfirm()) { ?>
<input type="hidden" data-table="budget" data-field="x_SectionCode" name="x<?php echo $budget_grid->RowIndex ?>_SectionCode" id="x<?php echo $budget_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($budget_grid->SectionCode->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_SectionCode" name="o<?php echo $budget_grid->RowIndex ?>_SectionCode" id="o<?php echo $budget_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($budget_grid->SectionCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget" data-field="x_SectionCode" name="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_SectionCode" id="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($budget_grid->SectionCode->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_SectionCode" name="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_SectionCode" id="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($budget_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_grid->BudgetLine->Visible) { // BudgetLine ?>
		<td data-name="BudgetLine" <?php echo $budget_grid->BudgetLine->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_BudgetLine" class="form-group"></span>
<input type="hidden" data-table="budget" data-field="x_BudgetLine" name="o<?php echo $budget_grid->RowIndex ?>_BudgetLine" id="o<?php echo $budget_grid->RowIndex ?>_BudgetLine" value="<?php echo HtmlEncode($budget_grid->BudgetLine->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_BudgetLine" class="form-group">
<span<?php echo $budget_grid->BudgetLine->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->BudgetLine->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget" data-field="x_BudgetLine" name="x<?php echo $budget_grid->RowIndex ?>_BudgetLine" id="x<?php echo $budget_grid->RowIndex ?>_BudgetLine" value="<?php echo HtmlEncode($budget_grid->BudgetLine->CurrentValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_BudgetLine">
<span<?php echo $budget_grid->BudgetLine->viewAttributes() ?>><?php echo $budget_grid->BudgetLine->getViewValue() ?></span>
</span>
<?php if (!$budget->isConfirm()) { ?>
<input type="hidden" data-table="budget" data-field="x_BudgetLine" name="x<?php echo $budget_grid->RowIndex ?>_BudgetLine" id="x<?php echo $budget_grid->RowIndex ?>_BudgetLine" value="<?php echo HtmlEncode($budget_grid->BudgetLine->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_BudgetLine" name="o<?php echo $budget_grid->RowIndex ?>_BudgetLine" id="o<?php echo $budget_grid->RowIndex ?>_BudgetLine" value="<?php echo HtmlEncode($budget_grid->BudgetLine->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget" data-field="x_BudgetLine" name="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_BudgetLine" id="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_BudgetLine" value="<?php echo HtmlEncode($budget_grid->BudgetLine->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_BudgetLine" name="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_BudgetLine" id="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_BudgetLine" value="<?php echo HtmlEncode($budget_grid->BudgetLine->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_grid->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode" <?php echo $budget_grid->ProgramCode->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($budget_grid->ProgramCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_ProgramCode" class="form-group">
<span<?php echo $budget_grid->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_ProgramCode" name="x<?php echo $budget_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($budget_grid->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_ProgramCode" class="form-group">
<?php $budget_grid->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_grid->RowIndex ?>_ProgramCode"><?php echo EmptyValue(strval($budget_grid->ProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_grid->ProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_grid->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_grid->ProgramCode->ReadOnly || $budget_grid->ProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_grid->RowIndex ?>_ProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_grid->ProgramCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_ProgramCode") ?>
<input type="hidden" data-table="budget" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_grid->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_grid->RowIndex ?>_ProgramCode" id="x<?php echo $budget_grid->RowIndex ?>_ProgramCode" value="<?php echo $budget_grid->ProgramCode->CurrentValue ?>"<?php echo $budget_grid->ProgramCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_ProgramCode" name="o<?php echo $budget_grid->RowIndex ?>_ProgramCode" id="o<?php echo $budget_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($budget_grid->ProgramCode->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($budget_grid->ProgramCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_ProgramCode" class="form-group">
<span<?php echo $budget_grid->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_ProgramCode" name="x<?php echo $budget_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($budget_grid->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_ProgramCode" class="form-group">
<?php $budget_grid->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_grid->RowIndex ?>_ProgramCode"><?php echo EmptyValue(strval($budget_grid->ProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_grid->ProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_grid->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_grid->ProgramCode->ReadOnly || $budget_grid->ProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_grid->RowIndex ?>_ProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_grid->ProgramCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_ProgramCode") ?>
<input type="hidden" data-table="budget" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_grid->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_grid->RowIndex ?>_ProgramCode" id="x<?php echo $budget_grid->RowIndex ?>_ProgramCode" value="<?php echo $budget_grid->ProgramCode->CurrentValue ?>"<?php echo $budget_grid->ProgramCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_ProgramCode">
<span<?php echo $budget_grid->ProgramCode->viewAttributes() ?>><?php echo $budget_grid->ProgramCode->getViewValue() ?></span>
</span>
<?php if (!$budget->isConfirm()) { ?>
<input type="hidden" data-table="budget" data-field="x_ProgramCode" name="x<?php echo $budget_grid->RowIndex ?>_ProgramCode" id="x<?php echo $budget_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($budget_grid->ProgramCode->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_ProgramCode" name="o<?php echo $budget_grid->RowIndex ?>_ProgramCode" id="o<?php echo $budget_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($budget_grid->ProgramCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget" data-field="x_ProgramCode" name="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_ProgramCode" id="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($budget_grid->ProgramCode->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_ProgramCode" name="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_ProgramCode" id="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($budget_grid->ProgramCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_grid->SubProgramCode->Visible) { // SubProgramCode ?>
		<td data-name="SubProgramCode" <?php echo $budget_grid->SubProgramCode->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($budget_grid->SubProgramCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_SubProgramCode" class="form-group">
<span<?php echo $budget_grid->SubProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->SubProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_SubProgramCode" name="x<?php echo $budget_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($budget_grid->SubProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_SubProgramCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_grid->RowIndex ?>_SubProgramCode"><?php echo EmptyValue(strval($budget_grid->SubProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_grid->SubProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_grid->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_grid->SubProgramCode->ReadOnly || $budget_grid->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_grid->RowIndex ?>_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_grid->SubProgramCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_SubProgramCode") ?>
<input type="hidden" data-table="budget" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_grid->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_grid->RowIndex ?>_SubProgramCode" id="x<?php echo $budget_grid->RowIndex ?>_SubProgramCode" value="<?php echo $budget_grid->SubProgramCode->CurrentValue ?>"<?php echo $budget_grid->SubProgramCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_SubProgramCode" name="o<?php echo $budget_grid->RowIndex ?>_SubProgramCode" id="o<?php echo $budget_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($budget_grid->SubProgramCode->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($budget_grid->SubProgramCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_SubProgramCode" class="form-group">
<span<?php echo $budget_grid->SubProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->SubProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_SubProgramCode" name="x<?php echo $budget_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($budget_grid->SubProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_SubProgramCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_grid->RowIndex ?>_SubProgramCode"><?php echo EmptyValue(strval($budget_grid->SubProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_grid->SubProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_grid->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_grid->SubProgramCode->ReadOnly || $budget_grid->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_grid->RowIndex ?>_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_grid->SubProgramCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_SubProgramCode") ?>
<input type="hidden" data-table="budget" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_grid->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_grid->RowIndex ?>_SubProgramCode" id="x<?php echo $budget_grid->RowIndex ?>_SubProgramCode" value="<?php echo $budget_grid->SubProgramCode->CurrentValue ?>"<?php echo $budget_grid->SubProgramCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_SubProgramCode">
<span<?php echo $budget_grid->SubProgramCode->viewAttributes() ?>><?php echo $budget_grid->SubProgramCode->getViewValue() ?></span>
</span>
<?php if (!$budget->isConfirm()) { ?>
<input type="hidden" data-table="budget" data-field="x_SubProgramCode" name="x<?php echo $budget_grid->RowIndex ?>_SubProgramCode" id="x<?php echo $budget_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($budget_grid->SubProgramCode->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_SubProgramCode" name="o<?php echo $budget_grid->RowIndex ?>_SubProgramCode" id="o<?php echo $budget_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($budget_grid->SubProgramCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget" data-field="x_SubProgramCode" name="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_SubProgramCode" id="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($budget_grid->SubProgramCode->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_SubProgramCode" name="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_SubProgramCode" id="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($budget_grid->SubProgramCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_grid->ApprovedBudget->Visible) { // ApprovedBudget ?>
		<td data-name="ApprovedBudget" <?php echo $budget_grid->ApprovedBudget->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_ApprovedBudget" class="form-group">
<input type="text" data-table="budget" data-field="x_ApprovedBudget" name="x<?php echo $budget_grid->RowIndex ?>_ApprovedBudget" id="x<?php echo $budget_grid->RowIndex ?>_ApprovedBudget" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($budget_grid->ApprovedBudget->getPlaceHolder()) ?>" value="<?php echo $budget_grid->ApprovedBudget->EditValue ?>"<?php echo $budget_grid->ApprovedBudget->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget" data-field="x_ApprovedBudget" name="o<?php echo $budget_grid->RowIndex ?>_ApprovedBudget" id="o<?php echo $budget_grid->RowIndex ?>_ApprovedBudget" value="<?php echo HtmlEncode($budget_grid->ApprovedBudget->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_ApprovedBudget" class="form-group">
<input type="text" data-table="budget" data-field="x_ApprovedBudget" name="x<?php echo $budget_grid->RowIndex ?>_ApprovedBudget" id="x<?php echo $budget_grid->RowIndex ?>_ApprovedBudget" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($budget_grid->ApprovedBudget->getPlaceHolder()) ?>" value="<?php echo $budget_grid->ApprovedBudget->EditValue ?>"<?php echo $budget_grid->ApprovedBudget->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_grid->RowCount ?>_budget_ApprovedBudget">
<span<?php echo $budget_grid->ApprovedBudget->viewAttributes() ?>><?php echo $budget_grid->ApprovedBudget->getViewValue() ?></span>
</span>
<?php if (!$budget->isConfirm()) { ?>
<input type="hidden" data-table="budget" data-field="x_ApprovedBudget" name="x<?php echo $budget_grid->RowIndex ?>_ApprovedBudget" id="x<?php echo $budget_grid->RowIndex ?>_ApprovedBudget" value="<?php echo HtmlEncode($budget_grid->ApprovedBudget->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_ApprovedBudget" name="o<?php echo $budget_grid->RowIndex ?>_ApprovedBudget" id="o<?php echo $budget_grid->RowIndex ?>_ApprovedBudget" value="<?php echo HtmlEncode($budget_grid->ApprovedBudget->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget" data-field="x_ApprovedBudget" name="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_ApprovedBudget" id="fbudgetgrid$x<?php echo $budget_grid->RowIndex ?>_ApprovedBudget" value="<?php echo HtmlEncode($budget_grid->ApprovedBudget->FormValue) ?>">
<input type="hidden" data-table="budget" data-field="x_ApprovedBudget" name="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_ApprovedBudget" id="fbudgetgrid$o<?php echo $budget_grid->RowIndex ?>_ApprovedBudget" value="<?php echo HtmlEncode($budget_grid->ApprovedBudget->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$budget_grid->ListOptions->render("body", "right", $budget_grid->RowCount);
?>
	</tr>
<?php if ($budget->RowType == ROWTYPE_ADD || $budget->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fbudgetgrid", "load"], function() {
	fbudgetgrid.updateLists(<?php echo $budget_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$budget_grid->isGridAdd() || $budget->CurrentMode == "copy")
		if (!$budget_grid->Recordset->EOF)
			$budget_grid->Recordset->moveNext();
}
?>
<?php
	if ($budget->CurrentMode == "add" || $budget->CurrentMode == "copy" || $budget->CurrentMode == "edit") {
		$budget_grid->RowIndex = '$rowindex$';
		$budget_grid->loadRowValues();

		// Set row properties
		$budget->resetAttributes();
		$budget->RowAttrs->merge(["data-rowindex" => $budget_grid->RowIndex, "id" => "r0_budget", "data-rowtype" => ROWTYPE_ADD]);
		$budget->RowAttrs->appendClass("ew-template");
		$budget->RowType = ROWTYPE_ADD;

		// Render row
		$budget_grid->renderRow();

		// Render list options
		$budget_grid->renderListOptions();
		$budget_grid->StartRowCount = 0;
?>
	<tr <?php echo $budget->rowAttributes() ?>>
<?php

// Render list options (body, left)
$budget_grid->ListOptions->render("body", "left", $budget_grid->RowIndex);
?>
	<?php if ($budget_grid->OutcomeCode->Visible) { // OutcomeCode ?>
		<td data-name="OutcomeCode">
<?php if (!$budget->isConfirm()) { ?>
<?php if ($budget_grid->OutcomeCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_budget_OutcomeCode" class="form-group budget_OutcomeCode">
<span<?php echo $budget_grid->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_OutcomeCode" name="x<?php echo $budget_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($budget_grid->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_budget_OutcomeCode" class="form-group budget_OutcomeCode">
<?php $budget_grid->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_grid->RowIndex ?>_OutcomeCode"><?php echo EmptyValue(strval($budget_grid->OutcomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_grid->OutcomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_grid->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_grid->OutcomeCode->ReadOnly || $budget_grid->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_grid->RowIndex ?>_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_grid->OutcomeCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_OutcomeCode") ?>
<input type="hidden" data-table="budget" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_grid->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_grid->RowIndex ?>_OutcomeCode" id="x<?php echo $budget_grid->RowIndex ?>_OutcomeCode" value="<?php echo $budget_grid->OutcomeCode->CurrentValue ?>"<?php echo $budget_grid->OutcomeCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_budget_OutcomeCode" class="form-group budget_OutcomeCode">
<span<?php echo $budget_grid->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget" data-field="x_OutcomeCode" name="x<?php echo $budget_grid->RowIndex ?>_OutcomeCode" id="x<?php echo $budget_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($budget_grid->OutcomeCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_OutcomeCode" name="o<?php echo $budget_grid->RowIndex ?>_OutcomeCode" id="o<?php echo $budget_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($budget_grid->OutcomeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_grid->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode">
<?php if (!$budget->isConfirm()) { ?>
<?php if ($budget_grid->OutputCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_budget_OutputCode" class="form-group budget_OutputCode">
<span<?php echo $budget_grid->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_OutputCode" name="x<?php echo $budget_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($budget_grid->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_budget_OutputCode" class="form-group budget_OutputCode">
<?php $budget_grid->OutputCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_grid->RowIndex ?>_OutputCode"><?php echo EmptyValue(strval($budget_grid->OutputCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_grid->OutputCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_grid->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_grid->OutputCode->ReadOnly || $budget_grid->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_grid->RowIndex ?>_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_grid->OutputCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_OutputCode") ?>
<input type="hidden" data-table="budget" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_grid->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_grid->RowIndex ?>_OutputCode" id="x<?php echo $budget_grid->RowIndex ?>_OutputCode" value="<?php echo $budget_grid->OutputCode->CurrentValue ?>"<?php echo $budget_grid->OutputCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_budget_OutputCode" class="form-group budget_OutputCode">
<span<?php echo $budget_grid->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget" data-field="x_OutputCode" name="x<?php echo $budget_grid->RowIndex ?>_OutputCode" id="x<?php echo $budget_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($budget_grid->OutputCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_OutputCode" name="o<?php echo $budget_grid->RowIndex ?>_OutputCode" id="o<?php echo $budget_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($budget_grid->OutputCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_grid->ActionCode->Visible) { // ActionCode ?>
		<td data-name="ActionCode">
<?php if (!$budget->isConfirm()) { ?>
<?php if ($budget_grid->ActionCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_budget_ActionCode" class="form-group budget_ActionCode">
<span<?php echo $budget_grid->ActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->ActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_ActionCode" name="x<?php echo $budget_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($budget_grid->ActionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_budget_ActionCode" class="form-group budget_ActionCode">
<?php $budget_grid->ActionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_ActionCode" data-value-separator="<?php echo $budget_grid->ActionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_grid->RowIndex ?>_ActionCode" name="x<?php echo $budget_grid->RowIndex ?>_ActionCode"<?php echo $budget_grid->ActionCode->editAttributes() ?>>
			<?php echo $budget_grid->ActionCode->selectOptionListHtml("x{$budget_grid->RowIndex}_ActionCode") ?>
		</select>
</div>
<?php echo $budget_grid->ActionCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_ActionCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_budget_ActionCode" class="form-group budget_ActionCode">
<span<?php echo $budget_grid->ActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->ActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget" data-field="x_ActionCode" name="x<?php echo $budget_grid->RowIndex ?>_ActionCode" id="x<?php echo $budget_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($budget_grid->ActionCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_ActionCode" name="o<?php echo $budget_grid->RowIndex ?>_ActionCode" id="o<?php echo $budget_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($budget_grid->ActionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_grid->DetailedActionCode->Visible) { // DetailedActionCode ?>
		<td data-name="DetailedActionCode">
<?php if (!$budget->isConfirm()) { ?>
<?php if ($budget_grid->DetailedActionCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_budget_DetailedActionCode" class="form-group budget_DetailedActionCode">
<span<?php echo $budget_grid->DetailedActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->DetailedActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" name="x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($budget_grid->DetailedActionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_budget_DetailedActionCode" class="form-group budget_DetailedActionCode">
<?php
$onchange = $budget_grid->DetailedActionCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_grid->DetailedActionCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" id="sv_x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" value="<?php echo RemoveHtml($budget_grid->DetailedActionCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($budget_grid->DetailedActionCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_grid->DetailedActionCode->getPlaceHolder()) ?>"<?php echo $budget_grid->DetailedActionCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_grid->DetailedActionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($budget_grid->DetailedActionCode->ReadOnly || $budget_grid->DetailedActionCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="budget" data-field="x_DetailedActionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_grid->DetailedActionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" id="x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($budget_grid->DetailedActionCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudgetgrid"], function() {
	fbudgetgrid.createAutoSuggest({"id":"x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode","forceSelect":false});
});
</script>
<?php echo $budget_grid->DetailedActionCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_DetailedActionCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_budget_DetailedActionCode" class="form-group budget_DetailedActionCode">
<span<?php echo $budget_grid->DetailedActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->DetailedActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget" data-field="x_DetailedActionCode" name="x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" id="x<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($budget_grid->DetailedActionCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_DetailedActionCode" name="o<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" id="o<?php echo $budget_grid->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($budget_grid->DetailedActionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_grid->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear">
<?php if (!$budget->isConfirm()) { ?>
<?php if ($budget_grid->FinancialYear->getSessionValue() != "") { ?>
<span id="el$rowindex$_budget_FinancialYear" class="form-group budget_FinancialYear">
<span<?php echo $budget_grid->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_FinancialYear" name="x<?php echo $budget_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($budget_grid->FinancialYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_budget_FinancialYear" class="form-group budget_FinancialYear">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_FinancialYear" data-value-separator="<?php echo $budget_grid->FinancialYear->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_grid->RowIndex ?>_FinancialYear" name="x<?php echo $budget_grid->RowIndex ?>_FinancialYear"<?php echo $budget_grid->FinancialYear->editAttributes() ?>>
			<?php echo $budget_grid->FinancialYear->selectOptionListHtml("x{$budget_grid->RowIndex}_FinancialYear") ?>
		</select>
</div>
<?php echo $budget_grid->FinancialYear->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_FinancialYear") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_budget_FinancialYear" class="form-group budget_FinancialYear">
<span<?php echo $budget_grid->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget" data-field="x_FinancialYear" name="x<?php echo $budget_grid->RowIndex ?>_FinancialYear" id="x<?php echo $budget_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($budget_grid->FinancialYear->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_FinancialYear" name="o<?php echo $budget_grid->RowIndex ?>_FinancialYear" id="o<?php echo $budget_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($budget_grid->FinancialYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_grid->AccountCode->Visible) { // AccountCode ?>
		<td data-name="AccountCode">
<?php if (!$budget->isConfirm()) { ?>
<span id="el$rowindex$_budget_AccountCode" class="form-group budget_AccountCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_grid->RowIndex ?>_AccountCode"><?php echo EmptyValue(strval($budget_grid->AccountCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_grid->AccountCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_grid->AccountCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_grid->AccountCode->ReadOnly || $budget_grid->AccountCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_grid->RowIndex ?>_AccountCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_grid->AccountCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_AccountCode") ?>
<input type="hidden" data-table="budget" data-field="x_AccountCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_grid->AccountCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_grid->RowIndex ?>_AccountCode" id="x<?php echo $budget_grid->RowIndex ?>_AccountCode" value="<?php echo $budget_grid->AccountCode->CurrentValue ?>"<?php echo $budget_grid->AccountCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_budget_AccountCode" class="form-group budget_AccountCode">
<span<?php echo $budget_grid->AccountCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->AccountCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget" data-field="x_AccountCode" name="x<?php echo $budget_grid->RowIndex ?>_AccountCode" id="x<?php echo $budget_grid->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($budget_grid->AccountCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_AccountCode" name="o<?php echo $budget_grid->RowIndex ?>_AccountCode" id="o<?php echo $budget_grid->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($budget_grid->AccountCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_grid->MeansOfImplementation->Visible) { // MeansOfImplementation ?>
		<td data-name="MeansOfImplementation">
<?php if (!$budget->isConfirm()) { ?>
<span id="el$rowindex$_budget_MeansOfImplementation" class="form-group budget_MeansOfImplementation">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation"><?php echo EmptyValue(strval($budget_grid->MeansOfImplementation->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_grid->MeansOfImplementation->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_grid->MeansOfImplementation->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_grid->MeansOfImplementation->ReadOnly || $budget_grid->MeansOfImplementation->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_grid->MeansOfImplementation->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_MeansOfImplementation") ?>
<input type="hidden" data-table="budget" data-field="x_MeansOfImplementation" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_grid->MeansOfImplementation->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation" id="x<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation" value="<?php echo $budget_grid->MeansOfImplementation->CurrentValue ?>"<?php echo $budget_grid->MeansOfImplementation->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_budget_MeansOfImplementation" class="form-group budget_MeansOfImplementation">
<span<?php echo $budget_grid->MeansOfImplementation->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->MeansOfImplementation->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget" data-field="x_MeansOfImplementation" name="x<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation" id="x<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation" value="<?php echo HtmlEncode($budget_grid->MeansOfImplementation->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_MeansOfImplementation" name="o<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation" id="o<?php echo $budget_grid->RowIndex ?>_MeansOfImplementation" value="<?php echo HtmlEncode($budget_grid->MeansOfImplementation->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_grid->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure">
<?php if (!$budget->isConfirm()) { ?>
<span id="el$rowindex$_budget_UnitOfMeasure" class="form-group budget_UnitOfMeasure">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_UnitOfMeasure" data-value-separator="<?php echo $budget_grid->UnitOfMeasure->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_grid->RowIndex ?>_UnitOfMeasure" name="x<?php echo $budget_grid->RowIndex ?>_UnitOfMeasure"<?php echo $budget_grid->UnitOfMeasure->editAttributes() ?>>
			<?php echo $budget_grid->UnitOfMeasure->selectOptionListHtml("x{$budget_grid->RowIndex}_UnitOfMeasure") ?>
		</select>
</div>
<?php echo $budget_grid->UnitOfMeasure->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_UnitOfMeasure") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_budget_UnitOfMeasure" class="form-group budget_UnitOfMeasure">
<span<?php echo $budget_grid->UnitOfMeasure->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->UnitOfMeasure->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget" data-field="x_UnitOfMeasure" name="x<?php echo $budget_grid->RowIndex ?>_UnitOfMeasure" id="x<?php echo $budget_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($budget_grid->UnitOfMeasure->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_UnitOfMeasure" name="o<?php echo $budget_grid->RowIndex ?>_UnitOfMeasure" id="o<?php echo $budget_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($budget_grid->UnitOfMeasure->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_grid->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity">
<?php if (!$budget->isConfirm()) { ?>
<span id="el$rowindex$_budget_Quantity" class="form-group budget_Quantity">
<input type="text" data-table="budget" data-field="x_Quantity" name="x<?php echo $budget_grid->RowIndex ?>_Quantity" id="x<?php echo $budget_grid->RowIndex ?>_Quantity" size="30" placeholder="<?php echo HtmlEncode($budget_grid->Quantity->getPlaceHolder()) ?>" value="<?php echo $budget_grid->Quantity->EditValue ?>"<?php echo $budget_grid->Quantity->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_budget_Quantity" class="form-group budget_Quantity">
<span<?php echo $budget_grid->Quantity->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->Quantity->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget" data-field="x_Quantity" name="x<?php echo $budget_grid->RowIndex ?>_Quantity" id="x<?php echo $budget_grid->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($budget_grid->Quantity->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_Quantity" name="o<?php echo $budget_grid->RowIndex ?>_Quantity" id="o<?php echo $budget_grid->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($budget_grid->Quantity->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_grid->Frequency->Visible) { // Frequency ?>
		<td data-name="Frequency">
<?php if (!$budget->isConfirm()) { ?>
<span id="el$rowindex$_budget_Frequency" class="form-group budget_Frequency">
<input type="text" data-table="budget" data-field="x_Frequency" name="x<?php echo $budget_grid->RowIndex ?>_Frequency" id="x<?php echo $budget_grid->RowIndex ?>_Frequency" size="30" placeholder="<?php echo HtmlEncode($budget_grid->Frequency->getPlaceHolder()) ?>" value="<?php echo $budget_grid->Frequency->EditValue ?>"<?php echo $budget_grid->Frequency->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_budget_Frequency" class="form-group budget_Frequency">
<span<?php echo $budget_grid->Frequency->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->Frequency->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget" data-field="x_Frequency" name="x<?php echo $budget_grid->RowIndex ?>_Frequency" id="x<?php echo $budget_grid->RowIndex ?>_Frequency" value="<?php echo HtmlEncode($budget_grid->Frequency->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_Frequency" name="o<?php echo $budget_grid->RowIndex ?>_Frequency" id="o<?php echo $budget_grid->RowIndex ?>_Frequency" value="<?php echo HtmlEncode($budget_grid->Frequency->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_grid->UnitCost->Visible) { // UnitCost ?>
		<td data-name="UnitCost">
<?php if (!$budget->isConfirm()) { ?>
<span id="el$rowindex$_budget_UnitCost" class="form-group budget_UnitCost">
<input type="text" data-table="budget" data-field="x_UnitCost" name="x<?php echo $budget_grid->RowIndex ?>_UnitCost" id="x<?php echo $budget_grid->RowIndex ?>_UnitCost" size="30" placeholder="<?php echo HtmlEncode($budget_grid->UnitCost->getPlaceHolder()) ?>" value="<?php echo $budget_grid->UnitCost->EditValue ?>"<?php echo $budget_grid->UnitCost->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_budget_UnitCost" class="form-group budget_UnitCost">
<span<?php echo $budget_grid->UnitCost->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->UnitCost->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget" data-field="x_UnitCost" name="x<?php echo $budget_grid->RowIndex ?>_UnitCost" id="x<?php echo $budget_grid->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($budget_grid->UnitCost->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_UnitCost" name="o<?php echo $budget_grid->RowIndex ?>_UnitCost" id="o<?php echo $budget_grid->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($budget_grid->UnitCost->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_grid->BudgetEstimate->Visible) { // BudgetEstimate ?>
		<td data-name="BudgetEstimate">
<?php if (!$budget->isConfirm()) { ?>
<span id="el$rowindex$_budget_BudgetEstimate" class="form-group budget_BudgetEstimate">
<input type="text" data-table="budget" data-field="x_BudgetEstimate" name="x<?php echo $budget_grid->RowIndex ?>_BudgetEstimate" id="x<?php echo $budget_grid->RowIndex ?>_BudgetEstimate" size="30" placeholder="<?php echo HtmlEncode($budget_grid->BudgetEstimate->getPlaceHolder()) ?>" value="<?php echo $budget_grid->BudgetEstimate->EditValue ?>"<?php echo $budget_grid->BudgetEstimate->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_budget_BudgetEstimate" class="form-group budget_BudgetEstimate">
<span<?php echo $budget_grid->BudgetEstimate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->BudgetEstimate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget" data-field="x_BudgetEstimate" name="x<?php echo $budget_grid->RowIndex ?>_BudgetEstimate" id="x<?php echo $budget_grid->RowIndex ?>_BudgetEstimate" value="<?php echo HtmlEncode($budget_grid->BudgetEstimate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_BudgetEstimate" name="o<?php echo $budget_grid->RowIndex ?>_BudgetEstimate" id="o<?php echo $budget_grid->RowIndex ?>_BudgetEstimate" value="<?php echo HtmlEncode($budget_grid->BudgetEstimate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if (!$budget->isConfirm()) { ?>
<?php if ($budget_grid->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_budget_LACode" class="form-group budget_LACode">
<span<?php echo $budget_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_LACode" name="x<?php echo $budget_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_budget_LACode" class="form-group budget_LACode">
<?php
$onchange = $budget_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $budget_grid->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $budget_grid->RowIndex ?>_LACode" id="sv_x<?php echo $budget_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($budget_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($budget_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_grid->LACode->getPlaceHolder()) ?>"<?php echo $budget_grid->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_grid->RowIndex ?>_LACode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($budget_grid->LACode->ReadOnly || $budget_grid->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="budget" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_grid->RowIndex ?>_LACode" id="x<?php echo $budget_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudgetgrid"], function() {
	fbudgetgrid.createAutoSuggest({"id":"x<?php echo $budget_grid->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $budget_grid->LACode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_budget_LACode" class="form-group budget_LACode">
<span<?php echo $budget_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget" data-field="x_LACode" name="x<?php echo $budget_grid->RowIndex ?>_LACode" id="x<?php echo $budget_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_grid->LACode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_LACode" name="o<?php echo $budget_grid->RowIndex ?>_LACode" id="o<?php echo $budget_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_grid->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<?php if (!$budget->isConfirm()) { ?>
<?php if ($budget_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_budget_DepartmentCode" class="form-group budget_DepartmentCode">
<span<?php echo $budget_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $budget_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($budget_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_budget_DepartmentCode" class="form-group budget_DepartmentCode">
<?php $budget_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_DepartmentCode" data-value-separator="<?php echo $budget_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $budget_grid->RowIndex ?>_DepartmentCode"<?php echo $budget_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $budget_grid->DepartmentCode->selectOptionListHtml("x{$budget_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $budget_grid->DepartmentCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_budget_DepartmentCode" class="form-group budget_DepartmentCode">
<span<?php echo $budget_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget" data-field="x_DepartmentCode" name="x<?php echo $budget_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $budget_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($budget_grid->DepartmentCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_DepartmentCode" name="o<?php echo $budget_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $budget_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($budget_grid->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode">
<?php if (!$budget->isConfirm()) { ?>
<span id="el$rowindex$_budget_SectionCode" class="form-group budget_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_SectionCode" data-value-separator="<?php echo $budget_grid->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_grid->RowIndex ?>_SectionCode" name="x<?php echo $budget_grid->RowIndex ?>_SectionCode"<?php echo $budget_grid->SectionCode->editAttributes() ?>>
			<?php echo $budget_grid->SectionCode->selectOptionListHtml("x{$budget_grid->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $budget_grid->SectionCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_SectionCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_budget_SectionCode" class="form-group budget_SectionCode">
<span<?php echo $budget_grid->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget" data-field="x_SectionCode" name="x<?php echo $budget_grid->RowIndex ?>_SectionCode" id="x<?php echo $budget_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($budget_grid->SectionCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_SectionCode" name="o<?php echo $budget_grid->RowIndex ?>_SectionCode" id="o<?php echo $budget_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($budget_grid->SectionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_grid->BudgetLine->Visible) { // BudgetLine ?>
		<td data-name="BudgetLine">
<?php if (!$budget->isConfirm()) { ?>
<span id="el$rowindex$_budget_BudgetLine" class="form-group budget_BudgetLine"></span>
<?php } else { ?>
<span id="el$rowindex$_budget_BudgetLine" class="form-group budget_BudgetLine">
<span<?php echo $budget_grid->BudgetLine->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->BudgetLine->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget" data-field="x_BudgetLine" name="x<?php echo $budget_grid->RowIndex ?>_BudgetLine" id="x<?php echo $budget_grid->RowIndex ?>_BudgetLine" value="<?php echo HtmlEncode($budget_grid->BudgetLine->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_BudgetLine" name="o<?php echo $budget_grid->RowIndex ?>_BudgetLine" id="o<?php echo $budget_grid->RowIndex ?>_BudgetLine" value="<?php echo HtmlEncode($budget_grid->BudgetLine->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_grid->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode">
<?php if (!$budget->isConfirm()) { ?>
<?php if ($budget_grid->ProgramCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_budget_ProgramCode" class="form-group budget_ProgramCode">
<span<?php echo $budget_grid->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_ProgramCode" name="x<?php echo $budget_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($budget_grid->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_budget_ProgramCode" class="form-group budget_ProgramCode">
<?php $budget_grid->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_grid->RowIndex ?>_ProgramCode"><?php echo EmptyValue(strval($budget_grid->ProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_grid->ProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_grid->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_grid->ProgramCode->ReadOnly || $budget_grid->ProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_grid->RowIndex ?>_ProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_grid->ProgramCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_ProgramCode") ?>
<input type="hidden" data-table="budget" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_grid->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_grid->RowIndex ?>_ProgramCode" id="x<?php echo $budget_grid->RowIndex ?>_ProgramCode" value="<?php echo $budget_grid->ProgramCode->CurrentValue ?>"<?php echo $budget_grid->ProgramCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_budget_ProgramCode" class="form-group budget_ProgramCode">
<span<?php echo $budget_grid->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget" data-field="x_ProgramCode" name="x<?php echo $budget_grid->RowIndex ?>_ProgramCode" id="x<?php echo $budget_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($budget_grid->ProgramCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_ProgramCode" name="o<?php echo $budget_grid->RowIndex ?>_ProgramCode" id="o<?php echo $budget_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($budget_grid->ProgramCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_grid->SubProgramCode->Visible) { // SubProgramCode ?>
		<td data-name="SubProgramCode">
<?php if (!$budget->isConfirm()) { ?>
<?php if ($budget_grid->SubProgramCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_budget_SubProgramCode" class="form-group budget_SubProgramCode">
<span<?php echo $budget_grid->SubProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->SubProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_grid->RowIndex ?>_SubProgramCode" name="x<?php echo $budget_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($budget_grid->SubProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_budget_SubProgramCode" class="form-group budget_SubProgramCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_grid->RowIndex ?>_SubProgramCode"><?php echo EmptyValue(strval($budget_grid->SubProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_grid->SubProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_grid->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_grid->SubProgramCode->ReadOnly || $budget_grid->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_grid->RowIndex ?>_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_grid->SubProgramCode->Lookup->getParamTag($budget_grid, "p_x" . $budget_grid->RowIndex . "_SubProgramCode") ?>
<input type="hidden" data-table="budget" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_grid->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_grid->RowIndex ?>_SubProgramCode" id="x<?php echo $budget_grid->RowIndex ?>_SubProgramCode" value="<?php echo $budget_grid->SubProgramCode->CurrentValue ?>"<?php echo $budget_grid->SubProgramCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_budget_SubProgramCode" class="form-group budget_SubProgramCode">
<span<?php echo $budget_grid->SubProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->SubProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget" data-field="x_SubProgramCode" name="x<?php echo $budget_grid->RowIndex ?>_SubProgramCode" id="x<?php echo $budget_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($budget_grid->SubProgramCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_SubProgramCode" name="o<?php echo $budget_grid->RowIndex ?>_SubProgramCode" id="o<?php echo $budget_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($budget_grid->SubProgramCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_grid->ApprovedBudget->Visible) { // ApprovedBudget ?>
		<td data-name="ApprovedBudget">
<?php if (!$budget->isConfirm()) { ?>
<span id="el$rowindex$_budget_ApprovedBudget" class="form-group budget_ApprovedBudget">
<input type="text" data-table="budget" data-field="x_ApprovedBudget" name="x<?php echo $budget_grid->RowIndex ?>_ApprovedBudget" id="x<?php echo $budget_grid->RowIndex ?>_ApprovedBudget" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($budget_grid->ApprovedBudget->getPlaceHolder()) ?>" value="<?php echo $budget_grid->ApprovedBudget->EditValue ?>"<?php echo $budget_grid->ApprovedBudget->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_budget_ApprovedBudget" class="form-group budget_ApprovedBudget">
<span<?php echo $budget_grid->ApprovedBudget->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_grid->ApprovedBudget->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget" data-field="x_ApprovedBudget" name="x<?php echo $budget_grid->RowIndex ?>_ApprovedBudget" id="x<?php echo $budget_grid->RowIndex ?>_ApprovedBudget" value="<?php echo HtmlEncode($budget_grid->ApprovedBudget->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_ApprovedBudget" name="o<?php echo $budget_grid->RowIndex ?>_ApprovedBudget" id="o<?php echo $budget_grid->RowIndex ?>_ApprovedBudget" value="<?php echo HtmlEncode($budget_grid->ApprovedBudget->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$budget_grid->ListOptions->render("body", "right", $budget_grid->RowIndex);
?>
<script>
loadjs.ready(["fbudgetgrid", "load"], function() {
	fbudgetgrid.updateLists(<?php echo $budget_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
<?php

// Render aggregate row
$budget->RowType = ROWTYPE_AGGREGATE;
$budget->resetAttributes();
$budget_grid->renderRow();
?>
<?php if ($budget_grid->TotalRecords > 0 && $budget->CurrentMode == "view") { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$budget_grid->renderListOptions();

// Render list options (footer, left)
$budget_grid->ListOptions->render("footer", "left");
?>
	<?php if ($budget_grid->OutcomeCode->Visible) { // OutcomeCode ?>
		<td data-name="OutcomeCode" class="<?php echo $budget_grid->OutcomeCode->footerCellClass() ?>"><span id="elf_budget_OutcomeCode" class="budget_OutcomeCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_grid->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode" class="<?php echo $budget_grid->OutputCode->footerCellClass() ?>"><span id="elf_budget_OutputCode" class="budget_OutputCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_grid->ActionCode->Visible) { // ActionCode ?>
		<td data-name="ActionCode" class="<?php echo $budget_grid->ActionCode->footerCellClass() ?>"><span id="elf_budget_ActionCode" class="budget_ActionCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_grid->DetailedActionCode->Visible) { // DetailedActionCode ?>
		<td data-name="DetailedActionCode" class="<?php echo $budget_grid->DetailedActionCode->footerCellClass() ?>"><span id="elf_budget_DetailedActionCode" class="budget_DetailedActionCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_grid->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear" class="<?php echo $budget_grid->FinancialYear->footerCellClass() ?>"><span id="elf_budget_FinancialYear" class="budget_FinancialYear">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_grid->AccountCode->Visible) { // AccountCode ?>
		<td data-name="AccountCode" class="<?php echo $budget_grid->AccountCode->footerCellClass() ?>"><span id="elf_budget_AccountCode" class="budget_AccountCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_grid->MeansOfImplementation->Visible) { // MeansOfImplementation ?>
		<td data-name="MeansOfImplementation" class="<?php echo $budget_grid->MeansOfImplementation->footerCellClass() ?>"><span id="elf_budget_MeansOfImplementation" class="budget_MeansOfImplementation">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_grid->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" class="<?php echo $budget_grid->UnitOfMeasure->footerCellClass() ?>"><span id="elf_budget_UnitOfMeasure" class="budget_UnitOfMeasure">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_grid->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity" class="<?php echo $budget_grid->Quantity->footerCellClass() ?>"><span id="elf_budget_Quantity" class="budget_Quantity">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_grid->Frequency->Visible) { // Frequency ?>
		<td data-name="Frequency" class="<?php echo $budget_grid->Frequency->footerCellClass() ?>"><span id="elf_budget_Frequency" class="budget_Frequency">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_grid->UnitCost->Visible) { // UnitCost ?>
		<td data-name="UnitCost" class="<?php echo $budget_grid->UnitCost->footerCellClass() ?>"><span id="elf_budget_UnitCost" class="budget_UnitCost">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_grid->BudgetEstimate->Visible) { // BudgetEstimate ?>
		<td data-name="BudgetEstimate" class="<?php echo $budget_grid->BudgetEstimate->footerCellClass() ?>"><span id="elf_budget_BudgetEstimate" class="budget_BudgetEstimate">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $budget_grid->BudgetEstimate->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($budget_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" class="<?php echo $budget_grid->LACode->footerCellClass() ?>"><span id="elf_budget_LACode" class="budget_LACode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" class="<?php echo $budget_grid->DepartmentCode->footerCellClass() ?>"><span id="elf_budget_DepartmentCode" class="budget_DepartmentCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" class="<?php echo $budget_grid->SectionCode->footerCellClass() ?>"><span id="elf_budget_SectionCode" class="budget_SectionCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_grid->BudgetLine->Visible) { // BudgetLine ?>
		<td data-name="BudgetLine" class="<?php echo $budget_grid->BudgetLine->footerCellClass() ?>"><span id="elf_budget_BudgetLine" class="budget_BudgetLine">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_grid->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode" class="<?php echo $budget_grid->ProgramCode->footerCellClass() ?>"><span id="elf_budget_ProgramCode" class="budget_ProgramCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_grid->SubProgramCode->Visible) { // SubProgramCode ?>
		<td data-name="SubProgramCode" class="<?php echo $budget_grid->SubProgramCode->footerCellClass() ?>"><span id="elf_budget_SubProgramCode" class="budget_SubProgramCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_grid->ApprovedBudget->Visible) { // ApprovedBudget ?>
		<td data-name="ApprovedBudget" class="<?php echo $budget_grid->ApprovedBudget->footerCellClass() ?>"><span id="elf_budget_ApprovedBudget" class="budget_ApprovedBudget">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$budget_grid->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($budget->CurrentMode == "add" || $budget->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $budget_grid->FormKeyCountName ?>" id="<?php echo $budget_grid->FormKeyCountName ?>" value="<?php echo $budget_grid->KeyCount ?>">
<?php echo $budget_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($budget->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $budget_grid->FormKeyCountName ?>" id="<?php echo $budget_grid->FormKeyCountName ?>" value="<?php echo $budget_grid->KeyCount ?>">
<?php echo $budget_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($budget->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fbudgetgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($budget_grid->Recordset)
	$budget_grid->Recordset->Close();
?>
<?php if ($budget_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $budget_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($budget_grid->TotalRecords == 0 && !$budget->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $budget_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$budget_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$budget_grid->terminate();
?>