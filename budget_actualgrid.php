<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($budget_actual_grid))
	$budget_actual_grid = new budget_actual_grid();

// Run the page
$budget_actual_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$budget_actual_grid->Page_Render();
?>
<?php if (!$budget_actual_grid->isExport()) { ?>
<script>
var fbudget_actualgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fbudget_actualgrid = new ew.Form("fbudget_actualgrid", "grid");
	fbudget_actualgrid.formKeyCountName = '<?php echo $budget_actual_grid->FormKeyCountName ?>';

	// Validate form
	fbudget_actualgrid.validate = function() {
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
			<?php if ($budget_actual_grid->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_grid->LACode->caption(), $budget_actual_grid->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_actual_grid->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_grid->DepartmentCode->caption(), $budget_actual_grid->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_actual_grid->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_grid->SectionCode->caption(), $budget_actual_grid->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_actual_grid->AccountCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_grid->AccountCode->caption(), $budget_actual_grid->AccountCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_actual_grid->PostingDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PostingDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_grid->PostingDate->caption(), $budget_actual_grid->PostingDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PostingDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_actual_grid->PostingDate->errorMessage()) ?>");
			<?php if ($budget_actual_grid->AccountMonth->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountMonth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_grid->AccountMonth->caption(), $budget_actual_grid->AccountMonth->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_actual_grid->AccountYear->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_grid->AccountYear->caption(), $budget_actual_grid->AccountYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AccountYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_actual_grid->AccountYear->errorMessage()) ?>");
			<?php if ($budget_actual_grid->BudgetEstimate->Required) { ?>
				elm = this.getElements("x" + infix + "_BudgetEstimate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_grid->BudgetEstimate->caption(), $budget_actual_grid->BudgetEstimate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BudgetEstimate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_actual_grid->BudgetEstimate->errorMessage()) ?>");
			<?php if ($budget_actual_grid->ActualAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_grid->ActualAmount->caption(), $budget_actual_grid->ActualAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_actual_grid->ActualAmount->errorMessage()) ?>");
			<?php if ($budget_actual_grid->ForecastAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_ForecastAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_grid->ForecastAmount->caption(), $budget_actual_grid->ForecastAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ForecastAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_actual_grid->ForecastAmount->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fbudget_actualgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SectionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "PostingDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountMonth", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountYear", false)) return false;
		if (ew.valueChanged(fobj, infix, "BudgetEstimate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActualAmount", false)) return false;
		if (ew.valueChanged(fobj, infix, "ForecastAmount", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fbudget_actualgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbudget_actualgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbudget_actualgrid.lists["x_LACode"] = <?php echo $budget_actual_grid->LACode->Lookup->toClientList($budget_actual_grid) ?>;
	fbudget_actualgrid.lists["x_LACode"].options = <?php echo JsonEncode($budget_actual_grid->LACode->lookupOptions()) ?>;
	fbudget_actualgrid.lists["x_DepartmentCode"] = <?php echo $budget_actual_grid->DepartmentCode->Lookup->toClientList($budget_actual_grid) ?>;
	fbudget_actualgrid.lists["x_DepartmentCode"].options = <?php echo JsonEncode($budget_actual_grid->DepartmentCode->lookupOptions()) ?>;
	fbudget_actualgrid.lists["x_SectionCode"] = <?php echo $budget_actual_grid->SectionCode->Lookup->toClientList($budget_actual_grid) ?>;
	fbudget_actualgrid.lists["x_SectionCode"].options = <?php echo JsonEncode($budget_actual_grid->SectionCode->lookupOptions()) ?>;
	fbudget_actualgrid.lists["x_AccountMonth"] = <?php echo $budget_actual_grid->AccountMonth->Lookup->toClientList($budget_actual_grid) ?>;
	fbudget_actualgrid.lists["x_AccountMonth"].options = <?php echo JsonEncode($budget_actual_grid->AccountMonth->lookupOptions()) ?>;
	fbudget_actualgrid.lists["x_AccountYear"] = <?php echo $budget_actual_grid->AccountYear->Lookup->toClientList($budget_actual_grid) ?>;
	fbudget_actualgrid.lists["x_AccountYear"].options = <?php echo JsonEncode($budget_actual_grid->AccountYear->lookupOptions()) ?>;
	fbudget_actualgrid.autoSuggests["x_AccountYear"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fbudget_actualgrid");
});
</script>
<?php } ?>
<?php
$budget_actual_grid->renderOtherOptions();
?>
<?php if ($budget_actual_grid->TotalRecords > 0 || $budget_actual->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($budget_actual_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> budget_actual">
<?php if ($budget_actual_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $budget_actual_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fbudget_actualgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_budget_actual" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_budget_actualgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$budget_actual->RowType = ROWTYPE_HEADER;

// Render list options
$budget_actual_grid->renderListOptions();

// Render list options (header, left)
$budget_actual_grid->ListOptions->render("header", "left");
?>
<?php if ($budget_actual_grid->LACode->Visible) { // LACode ?>
	<?php if ($budget_actual_grid->SortUrl($budget_actual_grid->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $budget_actual_grid->LACode->headerCellClass() ?>"><div id="elh_budget_actual_LACode" class="budget_actual_LACode"><div class="ew-table-header-caption"><?php echo $budget_actual_grid->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $budget_actual_grid->LACode->headerCellClass() ?>"><div><div id="elh_budget_actual_LACode" class="budget_actual_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_grid->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_grid->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_grid->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_grid->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($budget_actual_grid->SortUrl($budget_actual_grid->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $budget_actual_grid->DepartmentCode->headerCellClass() ?>"><div id="elh_budget_actual_DepartmentCode" class="budget_actual_DepartmentCode"><div class="ew-table-header-caption"><?php echo $budget_actual_grid->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $budget_actual_grid->DepartmentCode->headerCellClass() ?>"><div><div id="elh_budget_actual_DepartmentCode" class="budget_actual_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_grid->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_grid->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_grid->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_grid->SectionCode->Visible) { // SectionCode ?>
	<?php if ($budget_actual_grid->SortUrl($budget_actual_grid->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $budget_actual_grid->SectionCode->headerCellClass() ?>"><div id="elh_budget_actual_SectionCode" class="budget_actual_SectionCode"><div class="ew-table-header-caption"><?php echo $budget_actual_grid->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $budget_actual_grid->SectionCode->headerCellClass() ?>"><div><div id="elh_budget_actual_SectionCode" class="budget_actual_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_grid->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_grid->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_grid->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_grid->AccountCode->Visible) { // AccountCode ?>
	<?php if ($budget_actual_grid->SortUrl($budget_actual_grid->AccountCode) == "") { ?>
		<th data-name="AccountCode" class="<?php echo $budget_actual_grid->AccountCode->headerCellClass() ?>"><div id="elh_budget_actual_AccountCode" class="budget_actual_AccountCode"><div class="ew-table-header-caption"><?php echo $budget_actual_grid->AccountCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountCode" class="<?php echo $budget_actual_grid->AccountCode->headerCellClass() ?>"><div><div id="elh_budget_actual_AccountCode" class="budget_actual_AccountCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_grid->AccountCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_grid->AccountCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_grid->AccountCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_grid->PostingDate->Visible) { // PostingDate ?>
	<?php if ($budget_actual_grid->SortUrl($budget_actual_grid->PostingDate) == "") { ?>
		<th data-name="PostingDate" class="<?php echo $budget_actual_grid->PostingDate->headerCellClass() ?>"><div id="elh_budget_actual_PostingDate" class="budget_actual_PostingDate"><div class="ew-table-header-caption"><?php echo $budget_actual_grid->PostingDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PostingDate" class="<?php echo $budget_actual_grid->PostingDate->headerCellClass() ?>"><div><div id="elh_budget_actual_PostingDate" class="budget_actual_PostingDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_grid->PostingDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_grid->PostingDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_grid->PostingDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_grid->AccountMonth->Visible) { // AccountMonth ?>
	<?php if ($budget_actual_grid->SortUrl($budget_actual_grid->AccountMonth) == "") { ?>
		<th data-name="AccountMonth" class="<?php echo $budget_actual_grid->AccountMonth->headerCellClass() ?>"><div id="elh_budget_actual_AccountMonth" class="budget_actual_AccountMonth"><div class="ew-table-header-caption"><?php echo $budget_actual_grid->AccountMonth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountMonth" class="<?php echo $budget_actual_grid->AccountMonth->headerCellClass() ?>"><div><div id="elh_budget_actual_AccountMonth" class="budget_actual_AccountMonth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_grid->AccountMonth->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_grid->AccountMonth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_grid->AccountMonth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_grid->AccountYear->Visible) { // AccountYear ?>
	<?php if ($budget_actual_grid->SortUrl($budget_actual_grid->AccountYear) == "") { ?>
		<th data-name="AccountYear" class="<?php echo $budget_actual_grid->AccountYear->headerCellClass() ?>"><div id="elh_budget_actual_AccountYear" class="budget_actual_AccountYear"><div class="ew-table-header-caption"><?php echo $budget_actual_grid->AccountYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountYear" class="<?php echo $budget_actual_grid->AccountYear->headerCellClass() ?>"><div><div id="elh_budget_actual_AccountYear" class="budget_actual_AccountYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_grid->AccountYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_grid->AccountYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_grid->AccountYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_grid->BudgetEstimate->Visible) { // BudgetEstimate ?>
	<?php if ($budget_actual_grid->SortUrl($budget_actual_grid->BudgetEstimate) == "") { ?>
		<th data-name="BudgetEstimate" class="<?php echo $budget_actual_grid->BudgetEstimate->headerCellClass() ?>"><div id="elh_budget_actual_BudgetEstimate" class="budget_actual_BudgetEstimate"><div class="ew-table-header-caption"><?php echo $budget_actual_grid->BudgetEstimate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BudgetEstimate" class="<?php echo $budget_actual_grid->BudgetEstimate->headerCellClass() ?>"><div><div id="elh_budget_actual_BudgetEstimate" class="budget_actual_BudgetEstimate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_grid->BudgetEstimate->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_grid->BudgetEstimate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_grid->BudgetEstimate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_grid->ActualAmount->Visible) { // ActualAmount ?>
	<?php if ($budget_actual_grid->SortUrl($budget_actual_grid->ActualAmount) == "") { ?>
		<th data-name="ActualAmount" class="<?php echo $budget_actual_grid->ActualAmount->headerCellClass() ?>"><div id="elh_budget_actual_ActualAmount" class="budget_actual_ActualAmount"><div class="ew-table-header-caption"><?php echo $budget_actual_grid->ActualAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActualAmount" class="<?php echo $budget_actual_grid->ActualAmount->headerCellClass() ?>"><div><div id="elh_budget_actual_ActualAmount" class="budget_actual_ActualAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_grid->ActualAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_grid->ActualAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_grid->ActualAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_grid->ForecastAmount->Visible) { // ForecastAmount ?>
	<?php if ($budget_actual_grid->SortUrl($budget_actual_grid->ForecastAmount) == "") { ?>
		<th data-name="ForecastAmount" class="<?php echo $budget_actual_grid->ForecastAmount->headerCellClass() ?>"><div id="elh_budget_actual_ForecastAmount" class="budget_actual_ForecastAmount"><div class="ew-table-header-caption"><?php echo $budget_actual_grid->ForecastAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ForecastAmount" class="<?php echo $budget_actual_grid->ForecastAmount->headerCellClass() ?>"><div><div id="elh_budget_actual_ForecastAmount" class="budget_actual_ForecastAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_grid->ForecastAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_grid->ForecastAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_grid->ForecastAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$budget_actual_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$budget_actual_grid->StartRecord = 1;
$budget_actual_grid->StopRecord = $budget_actual_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($budget_actual->isConfirm() || $budget_actual_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($budget_actual_grid->FormKeyCountName) && ($budget_actual_grid->isGridAdd() || $budget_actual_grid->isGridEdit() || $budget_actual->isConfirm())) {
		$budget_actual_grid->KeyCount = $CurrentForm->getValue($budget_actual_grid->FormKeyCountName);
		$budget_actual_grid->StopRecord = $budget_actual_grid->StartRecord + $budget_actual_grid->KeyCount - 1;
	}
}
$budget_actual_grid->RecordCount = $budget_actual_grid->StartRecord - 1;
if ($budget_actual_grid->Recordset && !$budget_actual_grid->Recordset->EOF) {
	$budget_actual_grid->Recordset->moveFirst();
	$selectLimit = $budget_actual_grid->UseSelectLimit;
	if (!$selectLimit && $budget_actual_grid->StartRecord > 1)
		$budget_actual_grid->Recordset->move($budget_actual_grid->StartRecord - 1);
} elseif (!$budget_actual->AllowAddDeleteRow && $budget_actual_grid->StopRecord == 0) {
	$budget_actual_grid->StopRecord = $budget_actual->GridAddRowCount;
}

// Initialize aggregate
$budget_actual->RowType = ROWTYPE_AGGREGATEINIT;
$budget_actual->resetAttributes();
$budget_actual_grid->renderRow();
if ($budget_actual_grid->isGridAdd())
	$budget_actual_grid->RowIndex = 0;
if ($budget_actual_grid->isGridEdit())
	$budget_actual_grid->RowIndex = 0;
while ($budget_actual_grid->RecordCount < $budget_actual_grid->StopRecord) {
	$budget_actual_grid->RecordCount++;
	if ($budget_actual_grid->RecordCount >= $budget_actual_grid->StartRecord) {
		$budget_actual_grid->RowCount++;
		if ($budget_actual_grid->isGridAdd() || $budget_actual_grid->isGridEdit() || $budget_actual->isConfirm()) {
			$budget_actual_grid->RowIndex++;
			$CurrentForm->Index = $budget_actual_grid->RowIndex;
			if ($CurrentForm->hasValue($budget_actual_grid->FormActionName) && ($budget_actual->isConfirm() || $budget_actual_grid->EventCancelled))
				$budget_actual_grid->RowAction = strval($CurrentForm->getValue($budget_actual_grid->FormActionName));
			elseif ($budget_actual_grid->isGridAdd())
				$budget_actual_grid->RowAction = "insert";
			else
				$budget_actual_grid->RowAction = "";
		}

		// Set up key count
		$budget_actual_grid->KeyCount = $budget_actual_grid->RowIndex;

		// Init row class and style
		$budget_actual->resetAttributes();
		$budget_actual->CssClass = "";
		if ($budget_actual_grid->isGridAdd()) {
			if ($budget_actual->CurrentMode == "copy") {
				$budget_actual_grid->loadRowValues($budget_actual_grid->Recordset); // Load row values
				$budget_actual_grid->setRecordKey($budget_actual_grid->RowOldKey, $budget_actual_grid->Recordset); // Set old record key
			} else {
				$budget_actual_grid->loadRowValues(); // Load default values
				$budget_actual_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$budget_actual_grid->loadRowValues($budget_actual_grid->Recordset); // Load row values
		}
		$budget_actual->RowType = ROWTYPE_VIEW; // Render view
		if ($budget_actual_grid->isGridAdd()) // Grid add
			$budget_actual->RowType = ROWTYPE_ADD; // Render add
		if ($budget_actual_grid->isGridAdd() && $budget_actual->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$budget_actual_grid->restoreCurrentRowFormValues($budget_actual_grid->RowIndex); // Restore form values
		if ($budget_actual_grid->isGridEdit()) { // Grid edit
			if ($budget_actual->EventCancelled)
				$budget_actual_grid->restoreCurrentRowFormValues($budget_actual_grid->RowIndex); // Restore form values
			if ($budget_actual_grid->RowAction == "insert")
				$budget_actual->RowType = ROWTYPE_ADD; // Render add
			else
				$budget_actual->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($budget_actual_grid->isGridEdit() && ($budget_actual->RowType == ROWTYPE_EDIT || $budget_actual->RowType == ROWTYPE_ADD) && $budget_actual->EventCancelled) // Update failed
			$budget_actual_grid->restoreCurrentRowFormValues($budget_actual_grid->RowIndex); // Restore form values
		if ($budget_actual->RowType == ROWTYPE_EDIT) // Edit row
			$budget_actual_grid->EditRowCount++;
		if ($budget_actual->isConfirm()) // Confirm row
			$budget_actual_grid->restoreCurrentRowFormValues($budget_actual_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$budget_actual->RowAttrs->merge(["data-rowindex" => $budget_actual_grid->RowCount, "id" => "r" . $budget_actual_grid->RowCount . "_budget_actual", "data-rowtype" => $budget_actual->RowType]);

		// Render row
		$budget_actual_grid->renderRow();

		// Render list options
		$budget_actual_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($budget_actual_grid->RowAction != "delete" && $budget_actual_grid->RowAction != "insertdelete" && !($budget_actual_grid->RowAction == "insert" && $budget_actual->isConfirm() && $budget_actual_grid->emptyRow())) {
?>
	<tr <?php echo $budget_actual->rowAttributes() ?>>
<?php

// Render list options (body, left)
$budget_actual_grid->ListOptions->render("body", "left", $budget_actual_grid->RowCount);
?>
	<?php if ($budget_actual_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $budget_actual_grid->LACode->cellAttributes() ?>>
<?php if ($budget_actual->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($budget_actual_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_LACode" class="form-group">
<span<?php echo $budget_actual_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_actual_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_actual_grid->RowIndex ?>_LACode" name="x<?php echo $budget_actual_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_actual_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_LACode" class="form-group">
<?php $budget_actual_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_LACode" data-value-separator="<?php echo $budget_actual_grid->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_actual_grid->RowIndex ?>_LACode" name="x<?php echo $budget_actual_grid->RowIndex ?>_LACode"<?php echo $budget_actual_grid->LACode->editAttributes() ?>>
			<?php echo $budget_actual_grid->LACode->selectOptionListHtml("x{$budget_actual_grid->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $budget_actual_grid->LACode->Lookup->getParamTag($budget_actual_grid, "p_x" . $budget_actual_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="budget_actual" data-field="x_LACode" name="o<?php echo $budget_actual_grid->RowIndex ?>_LACode" id="o<?php echo $budget_actual_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_actual_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($budget_actual_grid->LACode->getSessionValue() != "") { ?>

<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_LACode" class="form-group">
<span<?php echo $budget_actual_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_actual_grid->LACode->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $budget_actual_grid->RowIndex ?>_LACode" name="x<?php echo $budget_actual_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_actual_grid->LACode->CurrentValue) ?>">
<?php } else { ?>

<?php $budget_actual_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_LACode" data-value-separator="<?php echo $budget_actual_grid->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_actual_grid->RowIndex ?>_LACode" name="x<?php echo $budget_actual_grid->RowIndex ?>_LACode"<?php echo $budget_actual_grid->LACode->editAttributes() ?>>
			<?php echo $budget_actual_grid->LACode->selectOptionListHtml("x{$budget_actual_grid->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $budget_actual_grid->LACode->Lookup->getParamTag($budget_actual_grid, "p_x" . $budget_actual_grid->RowIndex . "_LACode") ?>

<?php } ?>

<input type="hidden" data-table="budget_actual" data-field="x_LACode" name="o<?php echo $budget_actual_grid->RowIndex ?>_LACode" id="o<?php echo $budget_actual_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_actual_grid->LACode->OldValue != null ? $budget_actual_grid->LACode->OldValue : $budget_actual_grid->LACode->CurrentValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_LACode">
<span<?php echo $budget_actual_grid->LACode->viewAttributes() ?>><?php echo $budget_actual_grid->LACode->getViewValue() ?></span>
</span>
<?php if (!$budget_actual->isConfirm()) { ?>
<input type="hidden" data-table="budget_actual" data-field="x_LACode" name="x<?php echo $budget_actual_grid->RowIndex ?>_LACode" id="x<?php echo $budget_actual_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_actual_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="budget_actual" data-field="x_LACode" name="o<?php echo $budget_actual_grid->RowIndex ?>_LACode" id="o<?php echo $budget_actual_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_actual_grid->LACode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget_actual" data-field="x_LACode" name="fbudget_actualgrid$x<?php echo $budget_actual_grid->RowIndex ?>_LACode" id="fbudget_actualgrid$x<?php echo $budget_actual_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_actual_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="budget_actual" data-field="x_LACode" name="fbudget_actualgrid$o<?php echo $budget_actual_grid->RowIndex ?>_LACode" id="fbudget_actualgrid$o<?php echo $budget_actual_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_actual_grid->LACode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_actual_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $budget_actual_grid->DepartmentCode->cellAttributes() ?>>
<?php if ($budget_actual->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_DepartmentCode" class="form-group">
<?php $budget_actual_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_DepartmentCode" data-value-separator="<?php echo $budget_actual_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_actual_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $budget_actual_grid->RowIndex ?>_DepartmentCode"<?php echo $budget_actual_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $budget_actual_grid->DepartmentCode->selectOptionListHtml("x{$budget_actual_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $budget_actual_grid->DepartmentCode->Lookup->getParamTag($budget_actual_grid, "p_x" . $budget_actual_grid->RowIndex . "_DepartmentCode") ?>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_DepartmentCode" name="o<?php echo $budget_actual_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $budget_actual_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($budget_actual_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_DepartmentCode" class="form-group">
<?php $budget_actual_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_DepartmentCode" data-value-separator="<?php echo $budget_actual_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_actual_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $budget_actual_grid->RowIndex ?>_DepartmentCode"<?php echo $budget_actual_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $budget_actual_grid->DepartmentCode->selectOptionListHtml("x{$budget_actual_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $budget_actual_grid->DepartmentCode->Lookup->getParamTag($budget_actual_grid, "p_x" . $budget_actual_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_DepartmentCode">
<span<?php echo $budget_actual_grid->DepartmentCode->viewAttributes() ?>><?php echo $budget_actual_grid->DepartmentCode->getViewValue() ?></span>
</span>
<?php if (!$budget_actual->isConfirm()) { ?>
<input type="hidden" data-table="budget_actual" data-field="x_DepartmentCode" name="x<?php echo $budget_actual_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $budget_actual_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($budget_actual_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="budget_actual" data-field="x_DepartmentCode" name="o<?php echo $budget_actual_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $budget_actual_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($budget_actual_grid->DepartmentCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget_actual" data-field="x_DepartmentCode" name="fbudget_actualgrid$x<?php echo $budget_actual_grid->RowIndex ?>_DepartmentCode" id="fbudget_actualgrid$x<?php echo $budget_actual_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($budget_actual_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="budget_actual" data-field="x_DepartmentCode" name="fbudget_actualgrid$o<?php echo $budget_actual_grid->RowIndex ?>_DepartmentCode" id="fbudget_actualgrid$o<?php echo $budget_actual_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($budget_actual_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_actual_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $budget_actual_grid->SectionCode->cellAttributes() ?>>
<?php if ($budget_actual->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_SectionCode" data-value-separator="<?php echo $budget_actual_grid->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_actual_grid->RowIndex ?>_SectionCode" name="x<?php echo $budget_actual_grid->RowIndex ?>_SectionCode"<?php echo $budget_actual_grid->SectionCode->editAttributes() ?>>
			<?php echo $budget_actual_grid->SectionCode->selectOptionListHtml("x{$budget_actual_grid->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $budget_actual_grid->SectionCode->Lookup->getParamTag($budget_actual_grid, "p_x" . $budget_actual_grid->RowIndex . "_SectionCode") ?>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_SectionCode" name="o<?php echo $budget_actual_grid->RowIndex ?>_SectionCode" id="o<?php echo $budget_actual_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($budget_actual_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_SectionCode" data-value-separator="<?php echo $budget_actual_grid->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_actual_grid->RowIndex ?>_SectionCode" name="x<?php echo $budget_actual_grid->RowIndex ?>_SectionCode"<?php echo $budget_actual_grid->SectionCode->editAttributes() ?>>
			<?php echo $budget_actual_grid->SectionCode->selectOptionListHtml("x{$budget_actual_grid->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $budget_actual_grid->SectionCode->Lookup->getParamTag($budget_actual_grid, "p_x" . $budget_actual_grid->RowIndex . "_SectionCode") ?>
</span>
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_SectionCode">
<span<?php echo $budget_actual_grid->SectionCode->viewAttributes() ?>><?php echo $budget_actual_grid->SectionCode->getViewValue() ?></span>
</span>
<?php if (!$budget_actual->isConfirm()) { ?>
<input type="hidden" data-table="budget_actual" data-field="x_SectionCode" name="x<?php echo $budget_actual_grid->RowIndex ?>_SectionCode" id="x<?php echo $budget_actual_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($budget_actual_grid->SectionCode->FormValue) ?>">
<input type="hidden" data-table="budget_actual" data-field="x_SectionCode" name="o<?php echo $budget_actual_grid->RowIndex ?>_SectionCode" id="o<?php echo $budget_actual_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($budget_actual_grid->SectionCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget_actual" data-field="x_SectionCode" name="fbudget_actualgrid$x<?php echo $budget_actual_grid->RowIndex ?>_SectionCode" id="fbudget_actualgrid$x<?php echo $budget_actual_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($budget_actual_grid->SectionCode->FormValue) ?>">
<input type="hidden" data-table="budget_actual" data-field="x_SectionCode" name="fbudget_actualgrid$o<?php echo $budget_actual_grid->RowIndex ?>_SectionCode" id="fbudget_actualgrid$o<?php echo $budget_actual_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($budget_actual_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_actual_grid->AccountCode->Visible) { // AccountCode ?>
		<td data-name="AccountCode" <?php echo $budget_actual_grid->AccountCode->cellAttributes() ?>>
<?php if ($budget_actual->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_AccountCode" class="form-group">
<input type="text" data-table="budget_actual" data-field="x_AccountCode" name="x<?php echo $budget_actual_grid->RowIndex ?>_AccountCode" id="x<?php echo $budget_actual_grid->RowIndex ?>_AccountCode" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($budget_actual_grid->AccountCode->getPlaceHolder()) ?>" value="<?php echo $budget_actual_grid->AccountCode->EditValue ?>"<?php echo $budget_actual_grid->AccountCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_AccountCode" name="o<?php echo $budget_actual_grid->RowIndex ?>_AccountCode" id="o<?php echo $budget_actual_grid->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($budget_actual_grid->AccountCode->OldValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="budget_actual" data-field="x_AccountCode" name="x<?php echo $budget_actual_grid->RowIndex ?>_AccountCode" id="x<?php echo $budget_actual_grid->RowIndex ?>_AccountCode" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($budget_actual_grid->AccountCode->getPlaceHolder()) ?>" value="<?php echo $budget_actual_grid->AccountCode->EditValue ?>"<?php echo $budget_actual_grid->AccountCode->editAttributes() ?>>
<input type="hidden" data-table="budget_actual" data-field="x_AccountCode" name="o<?php echo $budget_actual_grid->RowIndex ?>_AccountCode" id="o<?php echo $budget_actual_grid->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($budget_actual_grid->AccountCode->OldValue != null ? $budget_actual_grid->AccountCode->OldValue : $budget_actual_grid->AccountCode->CurrentValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_AccountCode">
<span<?php echo $budget_actual_grid->AccountCode->viewAttributes() ?>><?php echo $budget_actual_grid->AccountCode->getViewValue() ?></span>
</span>
<?php if (!$budget_actual->isConfirm()) { ?>
<input type="hidden" data-table="budget_actual" data-field="x_AccountCode" name="x<?php echo $budget_actual_grid->RowIndex ?>_AccountCode" id="x<?php echo $budget_actual_grid->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($budget_actual_grid->AccountCode->FormValue) ?>">
<input type="hidden" data-table="budget_actual" data-field="x_AccountCode" name="o<?php echo $budget_actual_grid->RowIndex ?>_AccountCode" id="o<?php echo $budget_actual_grid->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($budget_actual_grid->AccountCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget_actual" data-field="x_AccountCode" name="fbudget_actualgrid$x<?php echo $budget_actual_grid->RowIndex ?>_AccountCode" id="fbudget_actualgrid$x<?php echo $budget_actual_grid->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($budget_actual_grid->AccountCode->FormValue) ?>">
<input type="hidden" data-table="budget_actual" data-field="x_AccountCode" name="fbudget_actualgrid$o<?php echo $budget_actual_grid->RowIndex ?>_AccountCode" id="fbudget_actualgrid$o<?php echo $budget_actual_grid->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($budget_actual_grid->AccountCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_actual_grid->PostingDate->Visible) { // PostingDate ?>
		<td data-name="PostingDate" <?php echo $budget_actual_grid->PostingDate->cellAttributes() ?>>
<?php if ($budget_actual->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_PostingDate" class="form-group">
<input type="text" data-table="budget_actual" data-field="x_PostingDate" name="x<?php echo $budget_actual_grid->RowIndex ?>_PostingDate" id="x<?php echo $budget_actual_grid->RowIndex ?>_PostingDate" placeholder="<?php echo HtmlEncode($budget_actual_grid->PostingDate->getPlaceHolder()) ?>" value="<?php echo $budget_actual_grid->PostingDate->EditValue ?>"<?php echo $budget_actual_grid->PostingDate->editAttributes() ?>>
<?php if (!$budget_actual_grid->PostingDate->ReadOnly && !$budget_actual_grid->PostingDate->Disabled && !isset($budget_actual_grid->PostingDate->EditAttrs["readonly"]) && !isset($budget_actual_grid->PostingDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbudget_actualgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fbudget_actualgrid", "x<?php echo $budget_actual_grid->RowIndex ?>_PostingDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_PostingDate" name="o<?php echo $budget_actual_grid->RowIndex ?>_PostingDate" id="o<?php echo $budget_actual_grid->RowIndex ?>_PostingDate" value="<?php echo HtmlEncode($budget_actual_grid->PostingDate->OldValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_PostingDate" class="form-group">
<input type="text" data-table="budget_actual" data-field="x_PostingDate" name="x<?php echo $budget_actual_grid->RowIndex ?>_PostingDate" id="x<?php echo $budget_actual_grid->RowIndex ?>_PostingDate" placeholder="<?php echo HtmlEncode($budget_actual_grid->PostingDate->getPlaceHolder()) ?>" value="<?php echo $budget_actual_grid->PostingDate->EditValue ?>"<?php echo $budget_actual_grid->PostingDate->editAttributes() ?>>
<?php if (!$budget_actual_grid->PostingDate->ReadOnly && !$budget_actual_grid->PostingDate->Disabled && !isset($budget_actual_grid->PostingDate->EditAttrs["readonly"]) && !isset($budget_actual_grid->PostingDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbudget_actualgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fbudget_actualgrid", "x<?php echo $budget_actual_grid->RowIndex ?>_PostingDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_PostingDate">
<span<?php echo $budget_actual_grid->PostingDate->viewAttributes() ?>><?php echo $budget_actual_grid->PostingDate->getViewValue() ?></span>
</span>
<?php if (!$budget_actual->isConfirm()) { ?>
<input type="hidden" data-table="budget_actual" data-field="x_PostingDate" name="x<?php echo $budget_actual_grid->RowIndex ?>_PostingDate" id="x<?php echo $budget_actual_grid->RowIndex ?>_PostingDate" value="<?php echo HtmlEncode($budget_actual_grid->PostingDate->FormValue) ?>">
<input type="hidden" data-table="budget_actual" data-field="x_PostingDate" name="o<?php echo $budget_actual_grid->RowIndex ?>_PostingDate" id="o<?php echo $budget_actual_grid->RowIndex ?>_PostingDate" value="<?php echo HtmlEncode($budget_actual_grid->PostingDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget_actual" data-field="x_PostingDate" name="fbudget_actualgrid$x<?php echo $budget_actual_grid->RowIndex ?>_PostingDate" id="fbudget_actualgrid$x<?php echo $budget_actual_grid->RowIndex ?>_PostingDate" value="<?php echo HtmlEncode($budget_actual_grid->PostingDate->FormValue) ?>">
<input type="hidden" data-table="budget_actual" data-field="x_PostingDate" name="fbudget_actualgrid$o<?php echo $budget_actual_grid->RowIndex ?>_PostingDate" id="fbudget_actualgrid$o<?php echo $budget_actual_grid->RowIndex ?>_PostingDate" value="<?php echo HtmlEncode($budget_actual_grid->PostingDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_actual_grid->AccountMonth->Visible) { // AccountMonth ?>
		<td data-name="AccountMonth" <?php echo $budget_actual_grid->AccountMonth->cellAttributes() ?>>
<?php if ($budget_actual->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_AccountMonth" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_AccountMonth" data-value-separator="<?php echo $budget_actual_grid->AccountMonth->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_actual_grid->RowIndex ?>_AccountMonth" name="x<?php echo $budget_actual_grid->RowIndex ?>_AccountMonth"<?php echo $budget_actual_grid->AccountMonth->editAttributes() ?>>
			<?php echo $budget_actual_grid->AccountMonth->selectOptionListHtml("x{$budget_actual_grid->RowIndex}_AccountMonth") ?>
		</select>
</div>
<?php echo $budget_actual_grid->AccountMonth->Lookup->getParamTag($budget_actual_grid, "p_x" . $budget_actual_grid->RowIndex . "_AccountMonth") ?>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_AccountMonth" name="o<?php echo $budget_actual_grid->RowIndex ?>_AccountMonth" id="o<?php echo $budget_actual_grid->RowIndex ?>_AccountMonth" value="<?php echo HtmlEncode($budget_actual_grid->AccountMonth->OldValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_AccountMonth" data-value-separator="<?php echo $budget_actual_grid->AccountMonth->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_actual_grid->RowIndex ?>_AccountMonth" name="x<?php echo $budget_actual_grid->RowIndex ?>_AccountMonth"<?php echo $budget_actual_grid->AccountMonth->editAttributes() ?>>
			<?php echo $budget_actual_grid->AccountMonth->selectOptionListHtml("x{$budget_actual_grid->RowIndex}_AccountMonth") ?>
		</select>
</div>
<?php echo $budget_actual_grid->AccountMonth->Lookup->getParamTag($budget_actual_grid, "p_x" . $budget_actual_grid->RowIndex . "_AccountMonth") ?>
<input type="hidden" data-table="budget_actual" data-field="x_AccountMonth" name="o<?php echo $budget_actual_grid->RowIndex ?>_AccountMonth" id="o<?php echo $budget_actual_grid->RowIndex ?>_AccountMonth" value="<?php echo HtmlEncode($budget_actual_grid->AccountMonth->OldValue != null ? $budget_actual_grid->AccountMonth->OldValue : $budget_actual_grid->AccountMonth->CurrentValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_AccountMonth">
<span<?php echo $budget_actual_grid->AccountMonth->viewAttributes() ?>><?php echo $budget_actual_grid->AccountMonth->getViewValue() ?></span>
</span>
<?php if (!$budget_actual->isConfirm()) { ?>
<input type="hidden" data-table="budget_actual" data-field="x_AccountMonth" name="x<?php echo $budget_actual_grid->RowIndex ?>_AccountMonth" id="x<?php echo $budget_actual_grid->RowIndex ?>_AccountMonth" value="<?php echo HtmlEncode($budget_actual_grid->AccountMonth->FormValue) ?>">
<input type="hidden" data-table="budget_actual" data-field="x_AccountMonth" name="o<?php echo $budget_actual_grid->RowIndex ?>_AccountMonth" id="o<?php echo $budget_actual_grid->RowIndex ?>_AccountMonth" value="<?php echo HtmlEncode($budget_actual_grid->AccountMonth->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget_actual" data-field="x_AccountMonth" name="fbudget_actualgrid$x<?php echo $budget_actual_grid->RowIndex ?>_AccountMonth" id="fbudget_actualgrid$x<?php echo $budget_actual_grid->RowIndex ?>_AccountMonth" value="<?php echo HtmlEncode($budget_actual_grid->AccountMonth->FormValue) ?>">
<input type="hidden" data-table="budget_actual" data-field="x_AccountMonth" name="fbudget_actualgrid$o<?php echo $budget_actual_grid->RowIndex ?>_AccountMonth" id="fbudget_actualgrid$o<?php echo $budget_actual_grid->RowIndex ?>_AccountMonth" value="<?php echo HtmlEncode($budget_actual_grid->AccountMonth->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_actual_grid->AccountYear->Visible) { // AccountYear ?>
		<td data-name="AccountYear" <?php echo $budget_actual_grid->AccountYear->cellAttributes() ?>>
<?php if ($budget_actual->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_AccountYear" class="form-group">
<?php
$onchange = $budget_actual_grid->AccountYear->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_actual_grid->AccountYear->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $budget_actual_grid->RowIndex ?>_AccountYear">
	<input type="text" class="form-control" name="sv_x<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" id="sv_x<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" value="<?php echo RemoveHtml($budget_actual_grid->AccountYear->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($budget_actual_grid->AccountYear->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_actual_grid->AccountYear->getPlaceHolder()) ?>"<?php echo $budget_actual_grid->AccountYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_AccountYear" data-value-separator="<?php echo $budget_actual_grid->AccountYear->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" id="x<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" value="<?php echo HtmlEncode($budget_actual_grid->AccountYear->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudget_actualgrid"], function() {
	fbudget_actualgrid.createAutoSuggest({"id":"x<?php echo $budget_actual_grid->RowIndex ?>_AccountYear","forceSelect":false});
});
</script>
<?php echo $budget_actual_grid->AccountYear->Lookup->getParamTag($budget_actual_grid, "p_x" . $budget_actual_grid->RowIndex . "_AccountYear") ?>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_AccountYear" name="o<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" id="o<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" value="<?php echo HtmlEncode($budget_actual_grid->AccountYear->OldValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php
$onchange = $budget_actual_grid->AccountYear->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_actual_grid->AccountYear->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $budget_actual_grid->RowIndex ?>_AccountYear">
	<input type="text" class="form-control" name="sv_x<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" id="sv_x<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" value="<?php echo RemoveHtml($budget_actual_grid->AccountYear->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($budget_actual_grid->AccountYear->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_actual_grid->AccountYear->getPlaceHolder()) ?>"<?php echo $budget_actual_grid->AccountYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_AccountYear" data-value-separator="<?php echo $budget_actual_grid->AccountYear->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" id="x<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" value="<?php echo HtmlEncode($budget_actual_grid->AccountYear->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudget_actualgrid"], function() {
	fbudget_actualgrid.createAutoSuggest({"id":"x<?php echo $budget_actual_grid->RowIndex ?>_AccountYear","forceSelect":false});
});
</script>
<?php echo $budget_actual_grid->AccountYear->Lookup->getParamTag($budget_actual_grid, "p_x" . $budget_actual_grid->RowIndex . "_AccountYear") ?>
<input type="hidden" data-table="budget_actual" data-field="x_AccountYear" name="o<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" id="o<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" value="<?php echo HtmlEncode($budget_actual_grid->AccountYear->OldValue != null ? $budget_actual_grid->AccountYear->OldValue : $budget_actual_grid->AccountYear->CurrentValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_AccountYear">
<span<?php echo $budget_actual_grid->AccountYear->viewAttributes() ?>><?php echo $budget_actual_grid->AccountYear->getViewValue() ?></span>
</span>
<?php if (!$budget_actual->isConfirm()) { ?>
<input type="hidden" data-table="budget_actual" data-field="x_AccountYear" name="x<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" id="x<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" value="<?php echo HtmlEncode($budget_actual_grid->AccountYear->FormValue) ?>">
<input type="hidden" data-table="budget_actual" data-field="x_AccountYear" name="o<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" id="o<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" value="<?php echo HtmlEncode($budget_actual_grid->AccountYear->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget_actual" data-field="x_AccountYear" name="fbudget_actualgrid$x<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" id="fbudget_actualgrid$x<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" value="<?php echo HtmlEncode($budget_actual_grid->AccountYear->FormValue) ?>">
<input type="hidden" data-table="budget_actual" data-field="x_AccountYear" name="fbudget_actualgrid$o<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" id="fbudget_actualgrid$o<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" value="<?php echo HtmlEncode($budget_actual_grid->AccountYear->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_actual_grid->BudgetEstimate->Visible) { // BudgetEstimate ?>
		<td data-name="BudgetEstimate" <?php echo $budget_actual_grid->BudgetEstimate->cellAttributes() ?>>
<?php if ($budget_actual->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_BudgetEstimate" class="form-group">
<input type="text" data-table="budget_actual" data-field="x_BudgetEstimate" name="x<?php echo $budget_actual_grid->RowIndex ?>_BudgetEstimate" id="x<?php echo $budget_actual_grid->RowIndex ?>_BudgetEstimate" size="30" placeholder="<?php echo HtmlEncode($budget_actual_grid->BudgetEstimate->getPlaceHolder()) ?>" value="<?php echo $budget_actual_grid->BudgetEstimate->EditValue ?>"<?php echo $budget_actual_grid->BudgetEstimate->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_BudgetEstimate" name="o<?php echo $budget_actual_grid->RowIndex ?>_BudgetEstimate" id="o<?php echo $budget_actual_grid->RowIndex ?>_BudgetEstimate" value="<?php echo HtmlEncode($budget_actual_grid->BudgetEstimate->OldValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_BudgetEstimate" class="form-group">
<input type="text" data-table="budget_actual" data-field="x_BudgetEstimate" name="x<?php echo $budget_actual_grid->RowIndex ?>_BudgetEstimate" id="x<?php echo $budget_actual_grid->RowIndex ?>_BudgetEstimate" size="30" placeholder="<?php echo HtmlEncode($budget_actual_grid->BudgetEstimate->getPlaceHolder()) ?>" value="<?php echo $budget_actual_grid->BudgetEstimate->EditValue ?>"<?php echo $budget_actual_grid->BudgetEstimate->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_BudgetEstimate">
<span<?php echo $budget_actual_grid->BudgetEstimate->viewAttributes() ?>><?php echo $budget_actual_grid->BudgetEstimate->getViewValue() ?></span>
</span>
<?php if (!$budget_actual->isConfirm()) { ?>
<input type="hidden" data-table="budget_actual" data-field="x_BudgetEstimate" name="x<?php echo $budget_actual_grid->RowIndex ?>_BudgetEstimate" id="x<?php echo $budget_actual_grid->RowIndex ?>_BudgetEstimate" value="<?php echo HtmlEncode($budget_actual_grid->BudgetEstimate->FormValue) ?>">
<input type="hidden" data-table="budget_actual" data-field="x_BudgetEstimate" name="o<?php echo $budget_actual_grid->RowIndex ?>_BudgetEstimate" id="o<?php echo $budget_actual_grid->RowIndex ?>_BudgetEstimate" value="<?php echo HtmlEncode($budget_actual_grid->BudgetEstimate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget_actual" data-field="x_BudgetEstimate" name="fbudget_actualgrid$x<?php echo $budget_actual_grid->RowIndex ?>_BudgetEstimate" id="fbudget_actualgrid$x<?php echo $budget_actual_grid->RowIndex ?>_BudgetEstimate" value="<?php echo HtmlEncode($budget_actual_grid->BudgetEstimate->FormValue) ?>">
<input type="hidden" data-table="budget_actual" data-field="x_BudgetEstimate" name="fbudget_actualgrid$o<?php echo $budget_actual_grid->RowIndex ?>_BudgetEstimate" id="fbudget_actualgrid$o<?php echo $budget_actual_grid->RowIndex ?>_BudgetEstimate" value="<?php echo HtmlEncode($budget_actual_grid->BudgetEstimate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_actual_grid->ActualAmount->Visible) { // ActualAmount ?>
		<td data-name="ActualAmount" <?php echo $budget_actual_grid->ActualAmount->cellAttributes() ?>>
<?php if ($budget_actual->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_ActualAmount" class="form-group">
<input type="text" data-table="budget_actual" data-field="x_ActualAmount" name="x<?php echo $budget_actual_grid->RowIndex ?>_ActualAmount" id="x<?php echo $budget_actual_grid->RowIndex ?>_ActualAmount" size="30" placeholder="<?php echo HtmlEncode($budget_actual_grid->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $budget_actual_grid->ActualAmount->EditValue ?>"<?php echo $budget_actual_grid->ActualAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_ActualAmount" name="o<?php echo $budget_actual_grid->RowIndex ?>_ActualAmount" id="o<?php echo $budget_actual_grid->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($budget_actual_grid->ActualAmount->OldValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_ActualAmount" class="form-group">
<input type="text" data-table="budget_actual" data-field="x_ActualAmount" name="x<?php echo $budget_actual_grid->RowIndex ?>_ActualAmount" id="x<?php echo $budget_actual_grid->RowIndex ?>_ActualAmount" size="30" placeholder="<?php echo HtmlEncode($budget_actual_grid->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $budget_actual_grid->ActualAmount->EditValue ?>"<?php echo $budget_actual_grid->ActualAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_ActualAmount">
<span<?php echo $budget_actual_grid->ActualAmount->viewAttributes() ?>><?php echo $budget_actual_grid->ActualAmount->getViewValue() ?></span>
</span>
<?php if (!$budget_actual->isConfirm()) { ?>
<input type="hidden" data-table="budget_actual" data-field="x_ActualAmount" name="x<?php echo $budget_actual_grid->RowIndex ?>_ActualAmount" id="x<?php echo $budget_actual_grid->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($budget_actual_grid->ActualAmount->FormValue) ?>">
<input type="hidden" data-table="budget_actual" data-field="x_ActualAmount" name="o<?php echo $budget_actual_grid->RowIndex ?>_ActualAmount" id="o<?php echo $budget_actual_grid->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($budget_actual_grid->ActualAmount->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget_actual" data-field="x_ActualAmount" name="fbudget_actualgrid$x<?php echo $budget_actual_grid->RowIndex ?>_ActualAmount" id="fbudget_actualgrid$x<?php echo $budget_actual_grid->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($budget_actual_grid->ActualAmount->FormValue) ?>">
<input type="hidden" data-table="budget_actual" data-field="x_ActualAmount" name="fbudget_actualgrid$o<?php echo $budget_actual_grid->RowIndex ?>_ActualAmount" id="fbudget_actualgrid$o<?php echo $budget_actual_grid->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($budget_actual_grid->ActualAmount->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_actual_grid->ForecastAmount->Visible) { // ForecastAmount ?>
		<td data-name="ForecastAmount" <?php echo $budget_actual_grid->ForecastAmount->cellAttributes() ?>>
<?php if ($budget_actual->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_ForecastAmount" class="form-group">
<input type="text" data-table="budget_actual" data-field="x_ForecastAmount" name="x<?php echo $budget_actual_grid->RowIndex ?>_ForecastAmount" id="x<?php echo $budget_actual_grid->RowIndex ?>_ForecastAmount" size="30" placeholder="<?php echo HtmlEncode($budget_actual_grid->ForecastAmount->getPlaceHolder()) ?>" value="<?php echo $budget_actual_grid->ForecastAmount->EditValue ?>"<?php echo $budget_actual_grid->ForecastAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_ForecastAmount" name="o<?php echo $budget_actual_grid->RowIndex ?>_ForecastAmount" id="o<?php echo $budget_actual_grid->RowIndex ?>_ForecastAmount" value="<?php echo HtmlEncode($budget_actual_grid->ForecastAmount->OldValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_ForecastAmount" class="form-group">
<input type="text" data-table="budget_actual" data-field="x_ForecastAmount" name="x<?php echo $budget_actual_grid->RowIndex ?>_ForecastAmount" id="x<?php echo $budget_actual_grid->RowIndex ?>_ForecastAmount" size="30" placeholder="<?php echo HtmlEncode($budget_actual_grid->ForecastAmount->getPlaceHolder()) ?>" value="<?php echo $budget_actual_grid->ForecastAmount->EditValue ?>"<?php echo $budget_actual_grid->ForecastAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_actual_grid->RowCount ?>_budget_actual_ForecastAmount">
<span<?php echo $budget_actual_grid->ForecastAmount->viewAttributes() ?>><?php echo $budget_actual_grid->ForecastAmount->getViewValue() ?></span>
</span>
<?php if (!$budget_actual->isConfirm()) { ?>
<input type="hidden" data-table="budget_actual" data-field="x_ForecastAmount" name="x<?php echo $budget_actual_grid->RowIndex ?>_ForecastAmount" id="x<?php echo $budget_actual_grid->RowIndex ?>_ForecastAmount" value="<?php echo HtmlEncode($budget_actual_grid->ForecastAmount->FormValue) ?>">
<input type="hidden" data-table="budget_actual" data-field="x_ForecastAmount" name="o<?php echo $budget_actual_grid->RowIndex ?>_ForecastAmount" id="o<?php echo $budget_actual_grid->RowIndex ?>_ForecastAmount" value="<?php echo HtmlEncode($budget_actual_grid->ForecastAmount->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="budget_actual" data-field="x_ForecastAmount" name="fbudget_actualgrid$x<?php echo $budget_actual_grid->RowIndex ?>_ForecastAmount" id="fbudget_actualgrid$x<?php echo $budget_actual_grid->RowIndex ?>_ForecastAmount" value="<?php echo HtmlEncode($budget_actual_grid->ForecastAmount->FormValue) ?>">
<input type="hidden" data-table="budget_actual" data-field="x_ForecastAmount" name="fbudget_actualgrid$o<?php echo $budget_actual_grid->RowIndex ?>_ForecastAmount" id="fbudget_actualgrid$o<?php echo $budget_actual_grid->RowIndex ?>_ForecastAmount" value="<?php echo HtmlEncode($budget_actual_grid->ForecastAmount->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$budget_actual_grid->ListOptions->render("body", "right", $budget_actual_grid->RowCount);
?>
	</tr>
<?php if ($budget_actual->RowType == ROWTYPE_ADD || $budget_actual->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fbudget_actualgrid", "load"], function() {
	fbudget_actualgrid.updateLists(<?php echo $budget_actual_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$budget_actual_grid->isGridAdd() || $budget_actual->CurrentMode == "copy")
		if (!$budget_actual_grid->Recordset->EOF)
			$budget_actual_grid->Recordset->moveNext();
}
?>
<?php
	if ($budget_actual->CurrentMode == "add" || $budget_actual->CurrentMode == "copy" || $budget_actual->CurrentMode == "edit") {
		$budget_actual_grid->RowIndex = '$rowindex$';
		$budget_actual_grid->loadRowValues();

		// Set row properties
		$budget_actual->resetAttributes();
		$budget_actual->RowAttrs->merge(["data-rowindex" => $budget_actual_grid->RowIndex, "id" => "r0_budget_actual", "data-rowtype" => ROWTYPE_ADD]);
		$budget_actual->RowAttrs->appendClass("ew-template");
		$budget_actual->RowType = ROWTYPE_ADD;

		// Render row
		$budget_actual_grid->renderRow();

		// Render list options
		$budget_actual_grid->renderListOptions();
		$budget_actual_grid->StartRowCount = 0;
?>
	<tr <?php echo $budget_actual->rowAttributes() ?>>
<?php

// Render list options (body, left)
$budget_actual_grid->ListOptions->render("body", "left", $budget_actual_grid->RowIndex);
?>
	<?php if ($budget_actual_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if (!$budget_actual->isConfirm()) { ?>
<?php if ($budget_actual_grid->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_budget_actual_LACode" class="form-group budget_actual_LACode">
<span<?php echo $budget_actual_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_actual_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_actual_grid->RowIndex ?>_LACode" name="x<?php echo $budget_actual_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_actual_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_budget_actual_LACode" class="form-group budget_actual_LACode">
<?php $budget_actual_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_LACode" data-value-separator="<?php echo $budget_actual_grid->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_actual_grid->RowIndex ?>_LACode" name="x<?php echo $budget_actual_grid->RowIndex ?>_LACode"<?php echo $budget_actual_grid->LACode->editAttributes() ?>>
			<?php echo $budget_actual_grid->LACode->selectOptionListHtml("x{$budget_actual_grid->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $budget_actual_grid->LACode->Lookup->getParamTag($budget_actual_grid, "p_x" . $budget_actual_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_budget_actual_LACode" class="form-group budget_actual_LACode">
<span<?php echo $budget_actual_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_actual_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_LACode" name="x<?php echo $budget_actual_grid->RowIndex ?>_LACode" id="x<?php echo $budget_actual_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_actual_grid->LACode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget_actual" data-field="x_LACode" name="o<?php echo $budget_actual_grid->RowIndex ?>_LACode" id="o<?php echo $budget_actual_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_actual_grid->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_actual_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<?php if (!$budget_actual->isConfirm()) { ?>
<span id="el$rowindex$_budget_actual_DepartmentCode" class="form-group budget_actual_DepartmentCode">
<?php $budget_actual_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_DepartmentCode" data-value-separator="<?php echo $budget_actual_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_actual_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $budget_actual_grid->RowIndex ?>_DepartmentCode"<?php echo $budget_actual_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $budget_actual_grid->DepartmentCode->selectOptionListHtml("x{$budget_actual_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $budget_actual_grid->DepartmentCode->Lookup->getParamTag($budget_actual_grid, "p_x" . $budget_actual_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_budget_actual_DepartmentCode" class="form-group budget_actual_DepartmentCode">
<span<?php echo $budget_actual_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_actual_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_DepartmentCode" name="x<?php echo $budget_actual_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $budget_actual_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($budget_actual_grid->DepartmentCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget_actual" data-field="x_DepartmentCode" name="o<?php echo $budget_actual_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $budget_actual_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($budget_actual_grid->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_actual_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode">
<?php if (!$budget_actual->isConfirm()) { ?>
<span id="el$rowindex$_budget_actual_SectionCode" class="form-group budget_actual_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_SectionCode" data-value-separator="<?php echo $budget_actual_grid->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_actual_grid->RowIndex ?>_SectionCode" name="x<?php echo $budget_actual_grid->RowIndex ?>_SectionCode"<?php echo $budget_actual_grid->SectionCode->editAttributes() ?>>
			<?php echo $budget_actual_grid->SectionCode->selectOptionListHtml("x{$budget_actual_grid->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $budget_actual_grid->SectionCode->Lookup->getParamTag($budget_actual_grid, "p_x" . $budget_actual_grid->RowIndex . "_SectionCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_budget_actual_SectionCode" class="form-group budget_actual_SectionCode">
<span<?php echo $budget_actual_grid->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_actual_grid->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_SectionCode" name="x<?php echo $budget_actual_grid->RowIndex ?>_SectionCode" id="x<?php echo $budget_actual_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($budget_actual_grid->SectionCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget_actual" data-field="x_SectionCode" name="o<?php echo $budget_actual_grid->RowIndex ?>_SectionCode" id="o<?php echo $budget_actual_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($budget_actual_grid->SectionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_actual_grid->AccountCode->Visible) { // AccountCode ?>
		<td data-name="AccountCode">
<?php if (!$budget_actual->isConfirm()) { ?>
<span id="el$rowindex$_budget_actual_AccountCode" class="form-group budget_actual_AccountCode">
<input type="text" data-table="budget_actual" data-field="x_AccountCode" name="x<?php echo $budget_actual_grid->RowIndex ?>_AccountCode" id="x<?php echo $budget_actual_grid->RowIndex ?>_AccountCode" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($budget_actual_grid->AccountCode->getPlaceHolder()) ?>" value="<?php echo $budget_actual_grid->AccountCode->EditValue ?>"<?php echo $budget_actual_grid->AccountCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_budget_actual_AccountCode" class="form-group budget_actual_AccountCode">
<span<?php echo $budget_actual_grid->AccountCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_actual_grid->AccountCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_AccountCode" name="x<?php echo $budget_actual_grid->RowIndex ?>_AccountCode" id="x<?php echo $budget_actual_grid->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($budget_actual_grid->AccountCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget_actual" data-field="x_AccountCode" name="o<?php echo $budget_actual_grid->RowIndex ?>_AccountCode" id="o<?php echo $budget_actual_grid->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($budget_actual_grid->AccountCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_actual_grid->PostingDate->Visible) { // PostingDate ?>
		<td data-name="PostingDate">
<?php if (!$budget_actual->isConfirm()) { ?>
<span id="el$rowindex$_budget_actual_PostingDate" class="form-group budget_actual_PostingDate">
<input type="text" data-table="budget_actual" data-field="x_PostingDate" name="x<?php echo $budget_actual_grid->RowIndex ?>_PostingDate" id="x<?php echo $budget_actual_grid->RowIndex ?>_PostingDate" placeholder="<?php echo HtmlEncode($budget_actual_grid->PostingDate->getPlaceHolder()) ?>" value="<?php echo $budget_actual_grid->PostingDate->EditValue ?>"<?php echo $budget_actual_grid->PostingDate->editAttributes() ?>>
<?php if (!$budget_actual_grid->PostingDate->ReadOnly && !$budget_actual_grid->PostingDate->Disabled && !isset($budget_actual_grid->PostingDate->EditAttrs["readonly"]) && !isset($budget_actual_grid->PostingDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbudget_actualgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fbudget_actualgrid", "x<?php echo $budget_actual_grid->RowIndex ?>_PostingDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_budget_actual_PostingDate" class="form-group budget_actual_PostingDate">
<span<?php echo $budget_actual_grid->PostingDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_actual_grid->PostingDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_PostingDate" name="x<?php echo $budget_actual_grid->RowIndex ?>_PostingDate" id="x<?php echo $budget_actual_grid->RowIndex ?>_PostingDate" value="<?php echo HtmlEncode($budget_actual_grid->PostingDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget_actual" data-field="x_PostingDate" name="o<?php echo $budget_actual_grid->RowIndex ?>_PostingDate" id="o<?php echo $budget_actual_grid->RowIndex ?>_PostingDate" value="<?php echo HtmlEncode($budget_actual_grid->PostingDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_actual_grid->AccountMonth->Visible) { // AccountMonth ?>
		<td data-name="AccountMonth">
<?php if (!$budget_actual->isConfirm()) { ?>
<span id="el$rowindex$_budget_actual_AccountMonth" class="form-group budget_actual_AccountMonth">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_AccountMonth" data-value-separator="<?php echo $budget_actual_grid->AccountMonth->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_actual_grid->RowIndex ?>_AccountMonth" name="x<?php echo $budget_actual_grid->RowIndex ?>_AccountMonth"<?php echo $budget_actual_grid->AccountMonth->editAttributes() ?>>
			<?php echo $budget_actual_grid->AccountMonth->selectOptionListHtml("x{$budget_actual_grid->RowIndex}_AccountMonth") ?>
		</select>
</div>
<?php echo $budget_actual_grid->AccountMonth->Lookup->getParamTag($budget_actual_grid, "p_x" . $budget_actual_grid->RowIndex . "_AccountMonth") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_budget_actual_AccountMonth" class="form-group budget_actual_AccountMonth">
<span<?php echo $budget_actual_grid->AccountMonth->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_actual_grid->AccountMonth->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_AccountMonth" name="x<?php echo $budget_actual_grid->RowIndex ?>_AccountMonth" id="x<?php echo $budget_actual_grid->RowIndex ?>_AccountMonth" value="<?php echo HtmlEncode($budget_actual_grid->AccountMonth->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget_actual" data-field="x_AccountMonth" name="o<?php echo $budget_actual_grid->RowIndex ?>_AccountMonth" id="o<?php echo $budget_actual_grid->RowIndex ?>_AccountMonth" value="<?php echo HtmlEncode($budget_actual_grid->AccountMonth->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_actual_grid->AccountYear->Visible) { // AccountYear ?>
		<td data-name="AccountYear">
<?php if (!$budget_actual->isConfirm()) { ?>
<span id="el$rowindex$_budget_actual_AccountYear" class="form-group budget_actual_AccountYear">
<?php
$onchange = $budget_actual_grid->AccountYear->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_actual_grid->AccountYear->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $budget_actual_grid->RowIndex ?>_AccountYear">
	<input type="text" class="form-control" name="sv_x<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" id="sv_x<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" value="<?php echo RemoveHtml($budget_actual_grid->AccountYear->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($budget_actual_grid->AccountYear->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_actual_grid->AccountYear->getPlaceHolder()) ?>"<?php echo $budget_actual_grid->AccountYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_AccountYear" data-value-separator="<?php echo $budget_actual_grid->AccountYear->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" id="x<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" value="<?php echo HtmlEncode($budget_actual_grid->AccountYear->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudget_actualgrid"], function() {
	fbudget_actualgrid.createAutoSuggest({"id":"x<?php echo $budget_actual_grid->RowIndex ?>_AccountYear","forceSelect":false});
});
</script>
<?php echo $budget_actual_grid->AccountYear->Lookup->getParamTag($budget_actual_grid, "p_x" . $budget_actual_grid->RowIndex . "_AccountYear") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_budget_actual_AccountYear" class="form-group budget_actual_AccountYear">
<span<?php echo $budget_actual_grid->AccountYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_actual_grid->AccountYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_AccountYear" name="x<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" id="x<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" value="<?php echo HtmlEncode($budget_actual_grid->AccountYear->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget_actual" data-field="x_AccountYear" name="o<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" id="o<?php echo $budget_actual_grid->RowIndex ?>_AccountYear" value="<?php echo HtmlEncode($budget_actual_grid->AccountYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_actual_grid->BudgetEstimate->Visible) { // BudgetEstimate ?>
		<td data-name="BudgetEstimate">
<?php if (!$budget_actual->isConfirm()) { ?>
<span id="el$rowindex$_budget_actual_BudgetEstimate" class="form-group budget_actual_BudgetEstimate">
<input type="text" data-table="budget_actual" data-field="x_BudgetEstimate" name="x<?php echo $budget_actual_grid->RowIndex ?>_BudgetEstimate" id="x<?php echo $budget_actual_grid->RowIndex ?>_BudgetEstimate" size="30" placeholder="<?php echo HtmlEncode($budget_actual_grid->BudgetEstimate->getPlaceHolder()) ?>" value="<?php echo $budget_actual_grid->BudgetEstimate->EditValue ?>"<?php echo $budget_actual_grid->BudgetEstimate->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_budget_actual_BudgetEstimate" class="form-group budget_actual_BudgetEstimate">
<span<?php echo $budget_actual_grid->BudgetEstimate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_actual_grid->BudgetEstimate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_BudgetEstimate" name="x<?php echo $budget_actual_grid->RowIndex ?>_BudgetEstimate" id="x<?php echo $budget_actual_grid->RowIndex ?>_BudgetEstimate" value="<?php echo HtmlEncode($budget_actual_grid->BudgetEstimate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget_actual" data-field="x_BudgetEstimate" name="o<?php echo $budget_actual_grid->RowIndex ?>_BudgetEstimate" id="o<?php echo $budget_actual_grid->RowIndex ?>_BudgetEstimate" value="<?php echo HtmlEncode($budget_actual_grid->BudgetEstimate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_actual_grid->ActualAmount->Visible) { // ActualAmount ?>
		<td data-name="ActualAmount">
<?php if (!$budget_actual->isConfirm()) { ?>
<span id="el$rowindex$_budget_actual_ActualAmount" class="form-group budget_actual_ActualAmount">
<input type="text" data-table="budget_actual" data-field="x_ActualAmount" name="x<?php echo $budget_actual_grid->RowIndex ?>_ActualAmount" id="x<?php echo $budget_actual_grid->RowIndex ?>_ActualAmount" size="30" placeholder="<?php echo HtmlEncode($budget_actual_grid->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $budget_actual_grid->ActualAmount->EditValue ?>"<?php echo $budget_actual_grid->ActualAmount->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_budget_actual_ActualAmount" class="form-group budget_actual_ActualAmount">
<span<?php echo $budget_actual_grid->ActualAmount->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_actual_grid->ActualAmount->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_ActualAmount" name="x<?php echo $budget_actual_grid->RowIndex ?>_ActualAmount" id="x<?php echo $budget_actual_grid->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($budget_actual_grid->ActualAmount->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget_actual" data-field="x_ActualAmount" name="o<?php echo $budget_actual_grid->RowIndex ?>_ActualAmount" id="o<?php echo $budget_actual_grid->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($budget_actual_grid->ActualAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_actual_grid->ForecastAmount->Visible) { // ForecastAmount ?>
		<td data-name="ForecastAmount">
<?php if (!$budget_actual->isConfirm()) { ?>
<span id="el$rowindex$_budget_actual_ForecastAmount" class="form-group budget_actual_ForecastAmount">
<input type="text" data-table="budget_actual" data-field="x_ForecastAmount" name="x<?php echo $budget_actual_grid->RowIndex ?>_ForecastAmount" id="x<?php echo $budget_actual_grid->RowIndex ?>_ForecastAmount" size="30" placeholder="<?php echo HtmlEncode($budget_actual_grid->ForecastAmount->getPlaceHolder()) ?>" value="<?php echo $budget_actual_grid->ForecastAmount->EditValue ?>"<?php echo $budget_actual_grid->ForecastAmount->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_budget_actual_ForecastAmount" class="form-group budget_actual_ForecastAmount">
<span<?php echo $budget_actual_grid->ForecastAmount->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_actual_grid->ForecastAmount->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_ForecastAmount" name="x<?php echo $budget_actual_grid->RowIndex ?>_ForecastAmount" id="x<?php echo $budget_actual_grid->RowIndex ?>_ForecastAmount" value="<?php echo HtmlEncode($budget_actual_grid->ForecastAmount->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="budget_actual" data-field="x_ForecastAmount" name="o<?php echo $budget_actual_grid->RowIndex ?>_ForecastAmount" id="o<?php echo $budget_actual_grid->RowIndex ?>_ForecastAmount" value="<?php echo HtmlEncode($budget_actual_grid->ForecastAmount->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$budget_actual_grid->ListOptions->render("body", "right", $budget_actual_grid->RowIndex);
?>
<script>
loadjs.ready(["fbudget_actualgrid", "load"], function() {
	fbudget_actualgrid.updateLists(<?php echo $budget_actual_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($budget_actual->CurrentMode == "add" || $budget_actual->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $budget_actual_grid->FormKeyCountName ?>" id="<?php echo $budget_actual_grid->FormKeyCountName ?>" value="<?php echo $budget_actual_grid->KeyCount ?>">
<?php echo $budget_actual_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($budget_actual->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $budget_actual_grid->FormKeyCountName ?>" id="<?php echo $budget_actual_grid->FormKeyCountName ?>" value="<?php echo $budget_actual_grid->KeyCount ?>">
<?php echo $budget_actual_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($budget_actual->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fbudget_actualgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($budget_actual_grid->Recordset)
	$budget_actual_grid->Recordset->Close();
?>
<?php if ($budget_actual_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $budget_actual_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($budget_actual_grid->TotalRecords == 0 && !$budget_actual->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $budget_actual_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$budget_actual_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$budget_actual_grid->terminate();
?>