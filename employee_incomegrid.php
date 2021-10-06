<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($employee_income_grid))
	$employee_income_grid = new employee_income_grid();

// Run the page
$employee_income_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_income_grid->Page_Render();
?>
<?php if (!$employee_income_grid->isExport()) { ?>
<script>
var femployee_incomegrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	femployee_incomegrid = new ew.Form("femployee_incomegrid", "grid");
	femployee_incomegrid.formKeyCountName = '<?php echo $employee_income_grid->FormKeyCountName ?>';

	// Validate form
	femployee_incomegrid.validate = function() {
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
			<?php if ($employee_income_grid->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_grid->EmployeeID->caption(), $employee_income_grid->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_grid->EmployeeID->errorMessage()) ?>");
			<?php if ($employee_income_grid->PaidPosition->Required) { ?>
				elm = this.getElements("x" + infix + "_PaidPosition");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_grid->PaidPosition->caption(), $employee_income_grid->PaidPosition->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PaidPosition");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_grid->PaidPosition->errorMessage()) ?>");
			<?php if ($employee_income_grid->PayrollDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_grid->PayrollDate->caption(), $employee_income_grid->PayrollDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_grid->PayrollDate->errorMessage()) ?>");
			<?php if ($employee_income_grid->PayrollPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_grid->PayrollPeriod->caption(), $employee_income_grid->PayrollPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollPeriod");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_grid->PayrollPeriod->errorMessage()) ?>");
			<?php if ($employee_income_grid->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_grid->StartDate->caption(), $employee_income_grid->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_grid->StartDate->errorMessage()) ?>");
			<?php if ($employee_income_grid->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_grid->EndDate->caption(), $employee_income_grid->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_grid->EndDate->errorMessage()) ?>");
			<?php if ($employee_income_grid->IncomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_IncomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_grid->IncomeCode->caption(), $employee_income_grid->IncomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_income_grid->Income->Required) { ?>
				elm = this.getElements("x" + infix + "_Income");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_grid->Income->caption(), $employee_income_grid->Income->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Income");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_grid->Income->errorMessage()) ?>");
			<?php if ($employee_income_grid->Remarks->Required) { ?>
				elm = this.getElements("x" + infix + "_Remarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_grid->Remarks->caption(), $employee_income_grid->Remarks->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_income_grid->Taxable->Required) { ?>
				elm = this.getElements("x" + infix + "_Taxable");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_grid->Taxable->caption(), $employee_income_grid->Taxable->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Taxable");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_grid->Taxable->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	femployee_incomegrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "EmployeeID", false)) return false;
		if (ew.valueChanged(fobj, infix, "PaidPosition", false)) return false;
		if (ew.valueChanged(fobj, infix, "PayrollDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "PayrollPeriod", false)) return false;
		if (ew.valueChanged(fobj, infix, "StartDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "EndDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "IncomeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "Income", false)) return false;
		if (ew.valueChanged(fobj, infix, "Remarks", false)) return false;
		if (ew.valueChanged(fobj, infix, "Taxable", false)) return false;
		return true;
	}

	// Form_CustomValidate
	femployee_incomegrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployee_incomegrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femployee_incomegrid.lists["x_PaidPosition"] = <?php echo $employee_income_grid->PaidPosition->Lookup->toClientList($employee_income_grid) ?>;
	femployee_incomegrid.lists["x_PaidPosition"].options = <?php echo JsonEncode($employee_income_grid->PaidPosition->lookupOptions()) ?>;
	femployee_incomegrid.autoSuggests["x_PaidPosition"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	femployee_incomegrid.lists["x_IncomeCode"] = <?php echo $employee_income_grid->IncomeCode->Lookup->toClientList($employee_income_grid) ?>;
	femployee_incomegrid.lists["x_IncomeCode"].options = <?php echo JsonEncode($employee_income_grid->IncomeCode->lookupOptions()) ?>;
	loadjs.done("femployee_incomegrid");
});
</script>
<?php } ?>
<?php
$employee_income_grid->renderOtherOptions();
?>
<?php if ($employee_income_grid->TotalRecords > 0 || $employee_income->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($employee_income_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> employee_income">
<?php if ($employee_income_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $employee_income_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="femployee_incomegrid" class="ew-form ew-list-form form-inline">
<div id="gmp_employee_income" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_employee_incomegrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$employee_income->RowType = ROWTYPE_HEADER;

// Render list options
$employee_income_grid->renderListOptions();

// Render list options (header, left)
$employee_income_grid->ListOptions->render("header", "left");
?>
<?php if ($employee_income_grid->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($employee_income_grid->SortUrl($employee_income_grid->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $employee_income_grid->EmployeeID->headerCellClass() ?>"><div id="elh_employee_income_EmployeeID" class="employee_income_EmployeeID"><div class="ew-table-header-caption"><?php echo $employee_income_grid->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $employee_income_grid->EmployeeID->headerCellClass() ?>"><div><div id="elh_employee_income_EmployeeID" class="employee_income_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_grid->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_grid->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_grid->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_grid->PaidPosition->Visible) { // PaidPosition ?>
	<?php if ($employee_income_grid->SortUrl($employee_income_grid->PaidPosition) == "") { ?>
		<th data-name="PaidPosition" class="<?php echo $employee_income_grid->PaidPosition->headerCellClass() ?>"><div id="elh_employee_income_PaidPosition" class="employee_income_PaidPosition"><div class="ew-table-header-caption"><?php echo $employee_income_grid->PaidPosition->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaidPosition" class="<?php echo $employee_income_grid->PaidPosition->headerCellClass() ?>"><div><div id="elh_employee_income_PaidPosition" class="employee_income_PaidPosition">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_grid->PaidPosition->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_grid->PaidPosition->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_grid->PaidPosition->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_grid->PayrollDate->Visible) { // PayrollDate ?>
	<?php if ($employee_income_grid->SortUrl($employee_income_grid->PayrollDate) == "") { ?>
		<th data-name="PayrollDate" class="<?php echo $employee_income_grid->PayrollDate->headerCellClass() ?>"><div id="elh_employee_income_PayrollDate" class="employee_income_PayrollDate"><div class="ew-table-header-caption"><?php echo $employee_income_grid->PayrollDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollDate" class="<?php echo $employee_income_grid->PayrollDate->headerCellClass() ?>"><div><div id="elh_employee_income_PayrollDate" class="employee_income_PayrollDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_grid->PayrollDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_grid->PayrollDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_grid->PayrollDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_grid->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($employee_income_grid->SortUrl($employee_income_grid->PayrollPeriod) == "") { ?>
		<th data-name="PayrollPeriod" class="<?php echo $employee_income_grid->PayrollPeriod->headerCellClass() ?>"><div id="elh_employee_income_PayrollPeriod" class="employee_income_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $employee_income_grid->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollPeriod" class="<?php echo $employee_income_grid->PayrollPeriod->headerCellClass() ?>"><div><div id="elh_employee_income_PayrollPeriod" class="employee_income_PayrollPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_grid->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_grid->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_grid->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_grid->StartDate->Visible) { // StartDate ?>
	<?php if ($employee_income_grid->SortUrl($employee_income_grid->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $employee_income_grid->StartDate->headerCellClass() ?>"><div id="elh_employee_income_StartDate" class="employee_income_StartDate"><div class="ew-table-header-caption"><?php echo $employee_income_grid->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $employee_income_grid->StartDate->headerCellClass() ?>"><div><div id="elh_employee_income_StartDate" class="employee_income_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_grid->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_grid->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_grid->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_grid->EndDate->Visible) { // EndDate ?>
	<?php if ($employee_income_grid->SortUrl($employee_income_grid->EndDate) == "") { ?>
		<th data-name="EndDate" class="<?php echo $employee_income_grid->EndDate->headerCellClass() ?>"><div id="elh_employee_income_EndDate" class="employee_income_EndDate"><div class="ew-table-header-caption"><?php echo $employee_income_grid->EndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EndDate" class="<?php echo $employee_income_grid->EndDate->headerCellClass() ?>"><div><div id="elh_employee_income_EndDate" class="employee_income_EndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_grid->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_grid->EndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_grid->EndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_grid->IncomeCode->Visible) { // IncomeCode ?>
	<?php if ($employee_income_grid->SortUrl($employee_income_grid->IncomeCode) == "") { ?>
		<th data-name="IncomeCode" class="<?php echo $employee_income_grid->IncomeCode->headerCellClass() ?>"><div id="elh_employee_income_IncomeCode" class="employee_income_IncomeCode"><div class="ew-table-header-caption"><?php echo $employee_income_grid->IncomeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IncomeCode" class="<?php echo $employee_income_grid->IncomeCode->headerCellClass() ?>"><div><div id="elh_employee_income_IncomeCode" class="employee_income_IncomeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_grid->IncomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_grid->IncomeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_grid->IncomeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_grid->Income->Visible) { // Income ?>
	<?php if ($employee_income_grid->SortUrl($employee_income_grid->Income) == "") { ?>
		<th data-name="Income" class="<?php echo $employee_income_grid->Income->headerCellClass() ?>"><div id="elh_employee_income_Income" class="employee_income_Income"><div class="ew-table-header-caption"><?php echo $employee_income_grid->Income->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Income" class="<?php echo $employee_income_grid->Income->headerCellClass() ?>"><div><div id="elh_employee_income_Income" class="employee_income_Income">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_grid->Income->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_grid->Income->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_grid->Income->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_grid->Remarks->Visible) { // Remarks ?>
	<?php if ($employee_income_grid->SortUrl($employee_income_grid->Remarks) == "") { ?>
		<th data-name="Remarks" class="<?php echo $employee_income_grid->Remarks->headerCellClass() ?>"><div id="elh_employee_income_Remarks" class="employee_income_Remarks"><div class="ew-table-header-caption"><?php echo $employee_income_grid->Remarks->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Remarks" class="<?php echo $employee_income_grid->Remarks->headerCellClass() ?>"><div><div id="elh_employee_income_Remarks" class="employee_income_Remarks">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_grid->Remarks->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_grid->Remarks->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_grid->Remarks->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_grid->Taxable->Visible) { // Taxable ?>
	<?php if ($employee_income_grid->SortUrl($employee_income_grid->Taxable) == "") { ?>
		<th data-name="Taxable" class="<?php echo $employee_income_grid->Taxable->headerCellClass() ?>"><div id="elh_employee_income_Taxable" class="employee_income_Taxable"><div class="ew-table-header-caption"><?php echo $employee_income_grid->Taxable->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Taxable" class="<?php echo $employee_income_grid->Taxable->headerCellClass() ?>"><div><div id="elh_employee_income_Taxable" class="employee_income_Taxable">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_grid->Taxable->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_grid->Taxable->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_grid->Taxable->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$employee_income_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$employee_income_grid->StartRecord = 1;
$employee_income_grid->StopRecord = $employee_income_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($employee_income->isConfirm() || $employee_income_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($employee_income_grid->FormKeyCountName) && ($employee_income_grid->isGridAdd() || $employee_income_grid->isGridEdit() || $employee_income->isConfirm())) {
		$employee_income_grid->KeyCount = $CurrentForm->getValue($employee_income_grid->FormKeyCountName);
		$employee_income_grid->StopRecord = $employee_income_grid->StartRecord + $employee_income_grid->KeyCount - 1;
	}
}
$employee_income_grid->RecordCount = $employee_income_grid->StartRecord - 1;
if ($employee_income_grid->Recordset && !$employee_income_grid->Recordset->EOF) {
	$employee_income_grid->Recordset->moveFirst();
	$selectLimit = $employee_income_grid->UseSelectLimit;
	if (!$selectLimit && $employee_income_grid->StartRecord > 1)
		$employee_income_grid->Recordset->move($employee_income_grid->StartRecord - 1);
} elseif (!$employee_income->AllowAddDeleteRow && $employee_income_grid->StopRecord == 0) {
	$employee_income_grid->StopRecord = $employee_income->GridAddRowCount;
}

// Initialize aggregate
$employee_income->RowType = ROWTYPE_AGGREGATEINIT;
$employee_income->resetAttributes();
$employee_income_grid->renderRow();
if ($employee_income_grid->isGridAdd())
	$employee_income_grid->RowIndex = 0;
if ($employee_income_grid->isGridEdit())
	$employee_income_grid->RowIndex = 0;
while ($employee_income_grid->RecordCount < $employee_income_grid->StopRecord) {
	$employee_income_grid->RecordCount++;
	if ($employee_income_grid->RecordCount >= $employee_income_grid->StartRecord) {
		$employee_income_grid->RowCount++;
		if ($employee_income_grid->isGridAdd() || $employee_income_grid->isGridEdit() || $employee_income->isConfirm()) {
			$employee_income_grid->RowIndex++;
			$CurrentForm->Index = $employee_income_grid->RowIndex;
			if ($CurrentForm->hasValue($employee_income_grid->FormActionName) && ($employee_income->isConfirm() || $employee_income_grid->EventCancelled))
				$employee_income_grid->RowAction = strval($CurrentForm->getValue($employee_income_grid->FormActionName));
			elseif ($employee_income_grid->isGridAdd())
				$employee_income_grid->RowAction = "insert";
			else
				$employee_income_grid->RowAction = "";
		}

		// Set up key count
		$employee_income_grid->KeyCount = $employee_income_grid->RowIndex;

		// Init row class and style
		$employee_income->resetAttributes();
		$employee_income->CssClass = "";
		if ($employee_income_grid->isGridAdd()) {
			if ($employee_income->CurrentMode == "copy") {
				$employee_income_grid->loadRowValues($employee_income_grid->Recordset); // Load row values
				$employee_income_grid->setRecordKey($employee_income_grid->RowOldKey, $employee_income_grid->Recordset); // Set old record key
			} else {
				$employee_income_grid->loadRowValues(); // Load default values
				$employee_income_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$employee_income_grid->loadRowValues($employee_income_grid->Recordset); // Load row values
		}
		$employee_income->RowType = ROWTYPE_VIEW; // Render view
		if ($employee_income_grid->isGridAdd()) // Grid add
			$employee_income->RowType = ROWTYPE_ADD; // Render add
		if ($employee_income_grid->isGridAdd() && $employee_income->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$employee_income_grid->restoreCurrentRowFormValues($employee_income_grid->RowIndex); // Restore form values
		if ($employee_income_grid->isGridEdit()) { // Grid edit
			if ($employee_income->EventCancelled)
				$employee_income_grid->restoreCurrentRowFormValues($employee_income_grid->RowIndex); // Restore form values
			if ($employee_income_grid->RowAction == "insert")
				$employee_income->RowType = ROWTYPE_ADD; // Render add
			else
				$employee_income->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($employee_income_grid->isGridEdit() && ($employee_income->RowType == ROWTYPE_EDIT || $employee_income->RowType == ROWTYPE_ADD) && $employee_income->EventCancelled) // Update failed
			$employee_income_grid->restoreCurrentRowFormValues($employee_income_grid->RowIndex); // Restore form values
		if ($employee_income->RowType == ROWTYPE_EDIT) // Edit row
			$employee_income_grid->EditRowCount++;
		if ($employee_income->isConfirm()) // Confirm row
			$employee_income_grid->restoreCurrentRowFormValues($employee_income_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$employee_income->RowAttrs->merge(["data-rowindex" => $employee_income_grid->RowCount, "id" => "r" . $employee_income_grid->RowCount . "_employee_income", "data-rowtype" => $employee_income->RowType]);

		// Render row
		$employee_income_grid->renderRow();

		// Render list options
		$employee_income_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($employee_income_grid->RowAction != "delete" && $employee_income_grid->RowAction != "insertdelete" && !($employee_income_grid->RowAction == "insert" && $employee_income->isConfirm() && $employee_income_grid->emptyRow())) {
?>
	<tr <?php echo $employee_income->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employee_income_grid->ListOptions->render("body", "left", $employee_income_grid->RowCount);
?>
	<?php if ($employee_income_grid->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $employee_income_grid->EmployeeID->cellAttributes() ?>>
<?php if ($employee_income->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($employee_income_grid->EmployeeID->getSessionValue() != "") { ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_EmployeeID" class="form-group">
<span<?php echo $employee_income_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_income_grid->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" name="x<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_income_grid->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_EmployeeID" class="form-group">
<input type="text" data-table="employee_income" data-field="x_EmployeeID" name="x<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" id="x<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employee_income_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employee_income_grid->EmployeeID->EditValue ?>"<?php echo $employee_income_grid->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="employee_income" data-field="x_EmployeeID" name="o<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" id="o<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_income_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($employee_income_grid->EmployeeID->getSessionValue() != "") { ?>

<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_EmployeeID" class="form-group">
<span<?php echo $employee_income_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_income_grid->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" name="x<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_income_grid->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="employee_income" data-field="x_EmployeeID" name="x<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" id="x<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employee_income_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employee_income_grid->EmployeeID->EditValue ?>"<?php echo $employee_income_grid->EmployeeID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="employee_income" data-field="x_EmployeeID" name="o<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" id="o<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_income_grid->EmployeeID->OldValue != null ? $employee_income_grid->EmployeeID->OldValue : $employee_income_grid->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_EmployeeID">
<span<?php echo $employee_income_grid->EmployeeID->viewAttributes() ?>><?php echo $employee_income_grid->EmployeeID->getViewValue() ?></span>
</span>
<?php if (!$employee_income->isConfirm()) { ?>
<input type="hidden" data-table="employee_income" data-field="x_EmployeeID" name="x<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" id="x<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_income_grid->EmployeeID->FormValue) ?>">
<input type="hidden" data-table="employee_income" data-field="x_EmployeeID" name="o<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" id="o<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_income_grid->EmployeeID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employee_income" data-field="x_EmployeeID" name="femployee_incomegrid$x<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" id="femployee_incomegrid$x<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_income_grid->EmployeeID->FormValue) ?>">
<input type="hidden" data-table="employee_income" data-field="x_EmployeeID" name="femployee_incomegrid$o<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" id="femployee_incomegrid$o<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_income_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_income_grid->PaidPosition->Visible) { // PaidPosition ?>
		<td data-name="PaidPosition" <?php echo $employee_income_grid->PaidPosition->cellAttributes() ?>>
<?php if ($employee_income->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_PaidPosition" class="form-group">
<?php
$onchange = $employee_income_grid->PaidPosition->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employee_income_grid->PaidPosition->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $employee_income_grid->RowIndex ?>_PaidPosition">
	<input type="text" class="form-control" name="sv_x<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" id="sv_x<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" value="<?php echo RemoveHtml($employee_income_grid->PaidPosition->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employee_income_grid->PaidPosition->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employee_income_grid->PaidPosition->getPlaceHolder()) ?>"<?php echo $employee_income_grid->PaidPosition->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_income" data-field="x_PaidPosition" data-value-separator="<?php echo $employee_income_grid->PaidPosition->displayValueSeparatorAttribute() ?>" name="x<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" id="x<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_income_grid->PaidPosition->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployee_incomegrid"], function() {
	femployee_incomegrid.createAutoSuggest({"id":"x<?php echo $employee_income_grid->RowIndex ?>_PaidPosition","forceSelect":false});
});
</script>
<?php echo $employee_income_grid->PaidPosition->Lookup->getParamTag($employee_income_grid, "p_x" . $employee_income_grid->RowIndex . "_PaidPosition") ?>
</span>
<input type="hidden" data-table="employee_income" data-field="x_PaidPosition" name="o<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" id="o<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_income_grid->PaidPosition->OldValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_PaidPosition" class="form-group">
<?php
$onchange = $employee_income_grid->PaidPosition->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employee_income_grid->PaidPosition->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $employee_income_grid->RowIndex ?>_PaidPosition">
	<input type="text" class="form-control" name="sv_x<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" id="sv_x<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" value="<?php echo RemoveHtml($employee_income_grid->PaidPosition->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employee_income_grid->PaidPosition->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employee_income_grid->PaidPosition->getPlaceHolder()) ?>"<?php echo $employee_income_grid->PaidPosition->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_income" data-field="x_PaidPosition" data-value-separator="<?php echo $employee_income_grid->PaidPosition->displayValueSeparatorAttribute() ?>" name="x<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" id="x<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_income_grid->PaidPosition->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployee_incomegrid"], function() {
	femployee_incomegrid.createAutoSuggest({"id":"x<?php echo $employee_income_grid->RowIndex ?>_PaidPosition","forceSelect":false});
});
</script>
<?php echo $employee_income_grid->PaidPosition->Lookup->getParamTag($employee_income_grid, "p_x" . $employee_income_grid->RowIndex . "_PaidPosition") ?>
</span>
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_PaidPosition">
<span<?php echo $employee_income_grid->PaidPosition->viewAttributes() ?>><?php echo $employee_income_grid->PaidPosition->getViewValue() ?></span>
</span>
<?php if (!$employee_income->isConfirm()) { ?>
<input type="hidden" data-table="employee_income" data-field="x_PaidPosition" name="x<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" id="x<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_income_grid->PaidPosition->FormValue) ?>">
<input type="hidden" data-table="employee_income" data-field="x_PaidPosition" name="o<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" id="o<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_income_grid->PaidPosition->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employee_income" data-field="x_PaidPosition" name="femployee_incomegrid$x<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" id="femployee_incomegrid$x<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_income_grid->PaidPosition->FormValue) ?>">
<input type="hidden" data-table="employee_income" data-field="x_PaidPosition" name="femployee_incomegrid$o<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" id="femployee_incomegrid$o<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_income_grid->PaidPosition->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_income_grid->PayrollDate->Visible) { // PayrollDate ?>
		<td data-name="PayrollDate" <?php echo $employee_income_grid->PayrollDate->cellAttributes() ?>>
<?php if ($employee_income->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_PayrollDate" class="form-group">
<input type="text" data-table="employee_income" data-field="x_PayrollDate" name="x<?php echo $employee_income_grid->RowIndex ?>_PayrollDate" id="x<?php echo $employee_income_grid->RowIndex ?>_PayrollDate" placeholder="<?php echo HtmlEncode($employee_income_grid->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_grid->PayrollDate->EditValue ?>"<?php echo $employee_income_grid->PayrollDate->editAttributes() ?>>
<?php if (!$employee_income_grid->PayrollDate->ReadOnly && !$employee_income_grid->PayrollDate->Disabled && !isset($employee_income_grid->PayrollDate->EditAttrs["readonly"]) && !isset($employee_income_grid->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomegrid", "x<?php echo $employee_income_grid->RowIndex ?>_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employee_income" data-field="x_PayrollDate" name="o<?php echo $employee_income_grid->RowIndex ?>_PayrollDate" id="o<?php echo $employee_income_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($employee_income_grid->PayrollDate->OldValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_PayrollDate" class="form-group">
<input type="text" data-table="employee_income" data-field="x_PayrollDate" name="x<?php echo $employee_income_grid->RowIndex ?>_PayrollDate" id="x<?php echo $employee_income_grid->RowIndex ?>_PayrollDate" placeholder="<?php echo HtmlEncode($employee_income_grid->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_grid->PayrollDate->EditValue ?>"<?php echo $employee_income_grid->PayrollDate->editAttributes() ?>>
<?php if (!$employee_income_grid->PayrollDate->ReadOnly && !$employee_income_grid->PayrollDate->Disabled && !isset($employee_income_grid->PayrollDate->EditAttrs["readonly"]) && !isset($employee_income_grid->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomegrid", "x<?php echo $employee_income_grid->RowIndex ?>_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_PayrollDate">
<span<?php echo $employee_income_grid->PayrollDate->viewAttributes() ?>><?php echo $employee_income_grid->PayrollDate->getViewValue() ?></span>
</span>
<?php if (!$employee_income->isConfirm()) { ?>
<input type="hidden" data-table="employee_income" data-field="x_PayrollDate" name="x<?php echo $employee_income_grid->RowIndex ?>_PayrollDate" id="x<?php echo $employee_income_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($employee_income_grid->PayrollDate->FormValue) ?>">
<input type="hidden" data-table="employee_income" data-field="x_PayrollDate" name="o<?php echo $employee_income_grid->RowIndex ?>_PayrollDate" id="o<?php echo $employee_income_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($employee_income_grid->PayrollDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employee_income" data-field="x_PayrollDate" name="femployee_incomegrid$x<?php echo $employee_income_grid->RowIndex ?>_PayrollDate" id="femployee_incomegrid$x<?php echo $employee_income_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($employee_income_grid->PayrollDate->FormValue) ?>">
<input type="hidden" data-table="employee_income" data-field="x_PayrollDate" name="femployee_incomegrid$o<?php echo $employee_income_grid->RowIndex ?>_PayrollDate" id="femployee_incomegrid$o<?php echo $employee_income_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($employee_income_grid->PayrollDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_income_grid->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod" <?php echo $employee_income_grid->PayrollPeriod->cellAttributes() ?>>
<?php if ($employee_income->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_PayrollPeriod" class="form-group">
<input type="text" data-table="employee_income" data-field="x_PayrollPeriod" name="x<?php echo $employee_income_grid->RowIndex ?>_PayrollPeriod" id="x<?php echo $employee_income_grid->RowIndex ?>_PayrollPeriod" size="30" placeholder="<?php echo HtmlEncode($employee_income_grid->PayrollPeriod->getPlaceHolder()) ?>" value="<?php echo $employee_income_grid->PayrollPeriod->EditValue ?>"<?php echo $employee_income_grid->PayrollPeriod->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_income" data-field="x_PayrollPeriod" name="o<?php echo $employee_income_grid->RowIndex ?>_PayrollPeriod" id="o<?php echo $employee_income_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($employee_income_grid->PayrollPeriod->OldValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="employee_income" data-field="x_PayrollPeriod" name="x<?php echo $employee_income_grid->RowIndex ?>_PayrollPeriod" id="x<?php echo $employee_income_grid->RowIndex ?>_PayrollPeriod" size="30" placeholder="<?php echo HtmlEncode($employee_income_grid->PayrollPeriod->getPlaceHolder()) ?>" value="<?php echo $employee_income_grid->PayrollPeriod->EditValue ?>"<?php echo $employee_income_grid->PayrollPeriod->editAttributes() ?>>
<input type="hidden" data-table="employee_income" data-field="x_PayrollPeriod" name="o<?php echo $employee_income_grid->RowIndex ?>_PayrollPeriod" id="o<?php echo $employee_income_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($employee_income_grid->PayrollPeriod->OldValue != null ? $employee_income_grid->PayrollPeriod->OldValue : $employee_income_grid->PayrollPeriod->CurrentValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_PayrollPeriod">
<span<?php echo $employee_income_grid->PayrollPeriod->viewAttributes() ?>><?php echo $employee_income_grid->PayrollPeriod->getViewValue() ?></span>
</span>
<?php if (!$employee_income->isConfirm()) { ?>
<input type="hidden" data-table="employee_income" data-field="x_PayrollPeriod" name="x<?php echo $employee_income_grid->RowIndex ?>_PayrollPeriod" id="x<?php echo $employee_income_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($employee_income_grid->PayrollPeriod->FormValue) ?>">
<input type="hidden" data-table="employee_income" data-field="x_PayrollPeriod" name="o<?php echo $employee_income_grid->RowIndex ?>_PayrollPeriod" id="o<?php echo $employee_income_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($employee_income_grid->PayrollPeriod->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employee_income" data-field="x_PayrollPeriod" name="femployee_incomegrid$x<?php echo $employee_income_grid->RowIndex ?>_PayrollPeriod" id="femployee_incomegrid$x<?php echo $employee_income_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($employee_income_grid->PayrollPeriod->FormValue) ?>">
<input type="hidden" data-table="employee_income" data-field="x_PayrollPeriod" name="femployee_incomegrid$o<?php echo $employee_income_grid->RowIndex ?>_PayrollPeriod" id="femployee_incomegrid$o<?php echo $employee_income_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($employee_income_grid->PayrollPeriod->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_income_grid->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $employee_income_grid->StartDate->cellAttributes() ?>>
<?php if ($employee_income->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_StartDate" class="form-group">
<input type="text" data-table="employee_income" data-field="x_StartDate" name="x<?php echo $employee_income_grid->RowIndex ?>_StartDate" id="x<?php echo $employee_income_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($employee_income_grid->StartDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_grid->StartDate->EditValue ?>"<?php echo $employee_income_grid->StartDate->editAttributes() ?>>
<?php if (!$employee_income_grid->StartDate->ReadOnly && !$employee_income_grid->StartDate->Disabled && !isset($employee_income_grid->StartDate->EditAttrs["readonly"]) && !isset($employee_income_grid->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomegrid", "x<?php echo $employee_income_grid->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employee_income" data-field="x_StartDate" name="o<?php echo $employee_income_grid->RowIndex ?>_StartDate" id="o<?php echo $employee_income_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($employee_income_grid->StartDate->OldValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_StartDate" class="form-group">
<input type="text" data-table="employee_income" data-field="x_StartDate" name="x<?php echo $employee_income_grid->RowIndex ?>_StartDate" id="x<?php echo $employee_income_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($employee_income_grid->StartDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_grid->StartDate->EditValue ?>"<?php echo $employee_income_grid->StartDate->editAttributes() ?>>
<?php if (!$employee_income_grid->StartDate->ReadOnly && !$employee_income_grid->StartDate->Disabled && !isset($employee_income_grid->StartDate->EditAttrs["readonly"]) && !isset($employee_income_grid->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomegrid", "x<?php echo $employee_income_grid->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_StartDate">
<span<?php echo $employee_income_grid->StartDate->viewAttributes() ?>><?php echo $employee_income_grid->StartDate->getViewValue() ?></span>
</span>
<?php if (!$employee_income->isConfirm()) { ?>
<input type="hidden" data-table="employee_income" data-field="x_StartDate" name="x<?php echo $employee_income_grid->RowIndex ?>_StartDate" id="x<?php echo $employee_income_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($employee_income_grid->StartDate->FormValue) ?>">
<input type="hidden" data-table="employee_income" data-field="x_StartDate" name="o<?php echo $employee_income_grid->RowIndex ?>_StartDate" id="o<?php echo $employee_income_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($employee_income_grid->StartDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employee_income" data-field="x_StartDate" name="femployee_incomegrid$x<?php echo $employee_income_grid->RowIndex ?>_StartDate" id="femployee_incomegrid$x<?php echo $employee_income_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($employee_income_grid->StartDate->FormValue) ?>">
<input type="hidden" data-table="employee_income" data-field="x_StartDate" name="femployee_incomegrid$o<?php echo $employee_income_grid->RowIndex ?>_StartDate" id="femployee_incomegrid$o<?php echo $employee_income_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($employee_income_grid->StartDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_income_grid->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate" <?php echo $employee_income_grid->EndDate->cellAttributes() ?>>
<?php if ($employee_income->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_EndDate" class="form-group">
<input type="text" data-table="employee_income" data-field="x_EndDate" name="x<?php echo $employee_income_grid->RowIndex ?>_EndDate" id="x<?php echo $employee_income_grid->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($employee_income_grid->EndDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_grid->EndDate->EditValue ?>"<?php echo $employee_income_grid->EndDate->editAttributes() ?>>
<?php if (!$employee_income_grid->EndDate->ReadOnly && !$employee_income_grid->EndDate->Disabled && !isset($employee_income_grid->EndDate->EditAttrs["readonly"]) && !isset($employee_income_grid->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomegrid", "x<?php echo $employee_income_grid->RowIndex ?>_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employee_income" data-field="x_EndDate" name="o<?php echo $employee_income_grid->RowIndex ?>_EndDate" id="o<?php echo $employee_income_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($employee_income_grid->EndDate->OldValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_EndDate" class="form-group">
<input type="text" data-table="employee_income" data-field="x_EndDate" name="x<?php echo $employee_income_grid->RowIndex ?>_EndDate" id="x<?php echo $employee_income_grid->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($employee_income_grid->EndDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_grid->EndDate->EditValue ?>"<?php echo $employee_income_grid->EndDate->editAttributes() ?>>
<?php if (!$employee_income_grid->EndDate->ReadOnly && !$employee_income_grid->EndDate->Disabled && !isset($employee_income_grid->EndDate->EditAttrs["readonly"]) && !isset($employee_income_grid->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomegrid", "x<?php echo $employee_income_grid->RowIndex ?>_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_EndDate">
<span<?php echo $employee_income_grid->EndDate->viewAttributes() ?>><?php echo $employee_income_grid->EndDate->getViewValue() ?></span>
</span>
<?php if (!$employee_income->isConfirm()) { ?>
<input type="hidden" data-table="employee_income" data-field="x_EndDate" name="x<?php echo $employee_income_grid->RowIndex ?>_EndDate" id="x<?php echo $employee_income_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($employee_income_grid->EndDate->FormValue) ?>">
<input type="hidden" data-table="employee_income" data-field="x_EndDate" name="o<?php echo $employee_income_grid->RowIndex ?>_EndDate" id="o<?php echo $employee_income_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($employee_income_grid->EndDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employee_income" data-field="x_EndDate" name="femployee_incomegrid$x<?php echo $employee_income_grid->RowIndex ?>_EndDate" id="femployee_incomegrid$x<?php echo $employee_income_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($employee_income_grid->EndDate->FormValue) ?>">
<input type="hidden" data-table="employee_income" data-field="x_EndDate" name="femployee_incomegrid$o<?php echo $employee_income_grid->RowIndex ?>_EndDate" id="femployee_incomegrid$o<?php echo $employee_income_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($employee_income_grid->EndDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_income_grid->IncomeCode->Visible) { // IncomeCode ?>
		<td data-name="IncomeCode" <?php echo $employee_income_grid->IncomeCode->cellAttributes() ?>>
<?php if ($employee_income->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_IncomeCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employee_income_grid->RowIndex ?>_IncomeCode"><?php echo EmptyValue(strval($employee_income_grid->IncomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employee_income_grid->IncomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employee_income_grid->IncomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employee_income_grid->IncomeCode->ReadOnly || $employee_income_grid->IncomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employee_income_grid->RowIndex ?>_IncomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employee_income_grid->IncomeCode->Lookup->getParamTag($employee_income_grid, "p_x" . $employee_income_grid->RowIndex . "_IncomeCode") ?>
<input type="hidden" data-table="employee_income" data-field="x_IncomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employee_income_grid->IncomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employee_income_grid->RowIndex ?>_IncomeCode" id="x<?php echo $employee_income_grid->RowIndex ?>_IncomeCode" value="<?php echo $employee_income_grid->IncomeCode->CurrentValue ?>"<?php echo $employee_income_grid->IncomeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_income" data-field="x_IncomeCode" name="o<?php echo $employee_income_grid->RowIndex ?>_IncomeCode" id="o<?php echo $employee_income_grid->RowIndex ?>_IncomeCode" value="<?php echo HtmlEncode($employee_income_grid->IncomeCode->OldValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employee_income_grid->RowIndex ?>_IncomeCode"><?php echo EmptyValue(strval($employee_income_grid->IncomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employee_income_grid->IncomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employee_income_grid->IncomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employee_income_grid->IncomeCode->ReadOnly || $employee_income_grid->IncomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employee_income_grid->RowIndex ?>_IncomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employee_income_grid->IncomeCode->Lookup->getParamTag($employee_income_grid, "p_x" . $employee_income_grid->RowIndex . "_IncomeCode") ?>
<input type="hidden" data-table="employee_income" data-field="x_IncomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employee_income_grid->IncomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employee_income_grid->RowIndex ?>_IncomeCode" id="x<?php echo $employee_income_grid->RowIndex ?>_IncomeCode" value="<?php echo $employee_income_grid->IncomeCode->CurrentValue ?>"<?php echo $employee_income_grid->IncomeCode->editAttributes() ?>>
<input type="hidden" data-table="employee_income" data-field="x_IncomeCode" name="o<?php echo $employee_income_grid->RowIndex ?>_IncomeCode" id="o<?php echo $employee_income_grid->RowIndex ?>_IncomeCode" value="<?php echo HtmlEncode($employee_income_grid->IncomeCode->OldValue != null ? $employee_income_grid->IncomeCode->OldValue : $employee_income_grid->IncomeCode->CurrentValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_IncomeCode">
<span<?php echo $employee_income_grid->IncomeCode->viewAttributes() ?>><?php echo $employee_income_grid->IncomeCode->getViewValue() ?></span>
</span>
<?php if (!$employee_income->isConfirm()) { ?>
<input type="hidden" data-table="employee_income" data-field="x_IncomeCode" name="x<?php echo $employee_income_grid->RowIndex ?>_IncomeCode" id="x<?php echo $employee_income_grid->RowIndex ?>_IncomeCode" value="<?php echo HtmlEncode($employee_income_grid->IncomeCode->FormValue) ?>">
<input type="hidden" data-table="employee_income" data-field="x_IncomeCode" name="o<?php echo $employee_income_grid->RowIndex ?>_IncomeCode" id="o<?php echo $employee_income_grid->RowIndex ?>_IncomeCode" value="<?php echo HtmlEncode($employee_income_grid->IncomeCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employee_income" data-field="x_IncomeCode" name="femployee_incomegrid$x<?php echo $employee_income_grid->RowIndex ?>_IncomeCode" id="femployee_incomegrid$x<?php echo $employee_income_grid->RowIndex ?>_IncomeCode" value="<?php echo HtmlEncode($employee_income_grid->IncomeCode->FormValue) ?>">
<input type="hidden" data-table="employee_income" data-field="x_IncomeCode" name="femployee_incomegrid$o<?php echo $employee_income_grid->RowIndex ?>_IncomeCode" id="femployee_incomegrid$o<?php echo $employee_income_grid->RowIndex ?>_IncomeCode" value="<?php echo HtmlEncode($employee_income_grid->IncomeCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_income_grid->Income->Visible) { // Income ?>
		<td data-name="Income" <?php echo $employee_income_grid->Income->cellAttributes() ?>>
<?php if ($employee_income->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_Income" class="form-group">
<input type="text" data-table="employee_income" data-field="x_Income" name="x<?php echo $employee_income_grid->RowIndex ?>_Income" id="x<?php echo $employee_income_grid->RowIndex ?>_Income" size="30" placeholder="<?php echo HtmlEncode($employee_income_grid->Income->getPlaceHolder()) ?>" value="<?php echo $employee_income_grid->Income->EditValue ?>"<?php echo $employee_income_grid->Income->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_income" data-field="x_Income" name="o<?php echo $employee_income_grid->RowIndex ?>_Income" id="o<?php echo $employee_income_grid->RowIndex ?>_Income" value="<?php echo HtmlEncode($employee_income_grid->Income->OldValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_Income" class="form-group">
<input type="text" data-table="employee_income" data-field="x_Income" name="x<?php echo $employee_income_grid->RowIndex ?>_Income" id="x<?php echo $employee_income_grid->RowIndex ?>_Income" size="30" placeholder="<?php echo HtmlEncode($employee_income_grid->Income->getPlaceHolder()) ?>" value="<?php echo $employee_income_grid->Income->EditValue ?>"<?php echo $employee_income_grid->Income->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_Income">
<span<?php echo $employee_income_grid->Income->viewAttributes() ?>><?php echo $employee_income_grid->Income->getViewValue() ?></span>
</span>
<?php if (!$employee_income->isConfirm()) { ?>
<input type="hidden" data-table="employee_income" data-field="x_Income" name="x<?php echo $employee_income_grid->RowIndex ?>_Income" id="x<?php echo $employee_income_grid->RowIndex ?>_Income" value="<?php echo HtmlEncode($employee_income_grid->Income->FormValue) ?>">
<input type="hidden" data-table="employee_income" data-field="x_Income" name="o<?php echo $employee_income_grid->RowIndex ?>_Income" id="o<?php echo $employee_income_grid->RowIndex ?>_Income" value="<?php echo HtmlEncode($employee_income_grid->Income->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employee_income" data-field="x_Income" name="femployee_incomegrid$x<?php echo $employee_income_grid->RowIndex ?>_Income" id="femployee_incomegrid$x<?php echo $employee_income_grid->RowIndex ?>_Income" value="<?php echo HtmlEncode($employee_income_grid->Income->FormValue) ?>">
<input type="hidden" data-table="employee_income" data-field="x_Income" name="femployee_incomegrid$o<?php echo $employee_income_grid->RowIndex ?>_Income" id="femployee_incomegrid$o<?php echo $employee_income_grid->RowIndex ?>_Income" value="<?php echo HtmlEncode($employee_income_grid->Income->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_income_grid->Remarks->Visible) { // Remarks ?>
		<td data-name="Remarks" <?php echo $employee_income_grid->Remarks->cellAttributes() ?>>
<?php if ($employee_income->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_Remarks" class="form-group">
<textarea data-table="employee_income" data-field="x_Remarks" name="x<?php echo $employee_income_grid->RowIndex ?>_Remarks" id="x<?php echo $employee_income_grid->RowIndex ?>_Remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employee_income_grid->Remarks->getPlaceHolder()) ?>"<?php echo $employee_income_grid->Remarks->editAttributes() ?>><?php echo $employee_income_grid->Remarks->EditValue ?></textarea>
</span>
<input type="hidden" data-table="employee_income" data-field="x_Remarks" name="o<?php echo $employee_income_grid->RowIndex ?>_Remarks" id="o<?php echo $employee_income_grid->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($employee_income_grid->Remarks->OldValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_Remarks" class="form-group">
<textarea data-table="employee_income" data-field="x_Remarks" name="x<?php echo $employee_income_grid->RowIndex ?>_Remarks" id="x<?php echo $employee_income_grid->RowIndex ?>_Remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employee_income_grid->Remarks->getPlaceHolder()) ?>"<?php echo $employee_income_grid->Remarks->editAttributes() ?>><?php echo $employee_income_grid->Remarks->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_Remarks">
<span<?php echo $employee_income_grid->Remarks->viewAttributes() ?>><?php echo $employee_income_grid->Remarks->getViewValue() ?></span>
</span>
<?php if (!$employee_income->isConfirm()) { ?>
<input type="hidden" data-table="employee_income" data-field="x_Remarks" name="x<?php echo $employee_income_grid->RowIndex ?>_Remarks" id="x<?php echo $employee_income_grid->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($employee_income_grid->Remarks->FormValue) ?>">
<input type="hidden" data-table="employee_income" data-field="x_Remarks" name="o<?php echo $employee_income_grid->RowIndex ?>_Remarks" id="o<?php echo $employee_income_grid->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($employee_income_grid->Remarks->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employee_income" data-field="x_Remarks" name="femployee_incomegrid$x<?php echo $employee_income_grid->RowIndex ?>_Remarks" id="femployee_incomegrid$x<?php echo $employee_income_grid->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($employee_income_grid->Remarks->FormValue) ?>">
<input type="hidden" data-table="employee_income" data-field="x_Remarks" name="femployee_incomegrid$o<?php echo $employee_income_grid->RowIndex ?>_Remarks" id="femployee_incomegrid$o<?php echo $employee_income_grid->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($employee_income_grid->Remarks->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_income_grid->Taxable->Visible) { // Taxable ?>
		<td data-name="Taxable" <?php echo $employee_income_grid->Taxable->cellAttributes() ?>>
<?php if ($employee_income->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_Taxable" class="form-group">
<input type="text" data-table="employee_income" data-field="x_Taxable" name="x<?php echo $employee_income_grid->RowIndex ?>_Taxable" id="x<?php echo $employee_income_grid->RowIndex ?>_Taxable" size="30" placeholder="<?php echo HtmlEncode($employee_income_grid->Taxable->getPlaceHolder()) ?>" value="<?php echo $employee_income_grid->Taxable->EditValue ?>"<?php echo $employee_income_grid->Taxable->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_income" data-field="x_Taxable" name="o<?php echo $employee_income_grid->RowIndex ?>_Taxable" id="o<?php echo $employee_income_grid->RowIndex ?>_Taxable" value="<?php echo HtmlEncode($employee_income_grid->Taxable->OldValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_Taxable" class="form-group">
<input type="text" data-table="employee_income" data-field="x_Taxable" name="x<?php echo $employee_income_grid->RowIndex ?>_Taxable" id="x<?php echo $employee_income_grid->RowIndex ?>_Taxable" size="30" placeholder="<?php echo HtmlEncode($employee_income_grid->Taxable->getPlaceHolder()) ?>" value="<?php echo $employee_income_grid->Taxable->EditValue ?>"<?php echo $employee_income_grid->Taxable->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_income_grid->RowCount ?>_employee_income_Taxable">
<span<?php echo $employee_income_grid->Taxable->viewAttributes() ?>><?php echo $employee_income_grid->Taxable->getViewValue() ?></span>
</span>
<?php if (!$employee_income->isConfirm()) { ?>
<input type="hidden" data-table="employee_income" data-field="x_Taxable" name="x<?php echo $employee_income_grid->RowIndex ?>_Taxable" id="x<?php echo $employee_income_grid->RowIndex ?>_Taxable" value="<?php echo HtmlEncode($employee_income_grid->Taxable->FormValue) ?>">
<input type="hidden" data-table="employee_income" data-field="x_Taxable" name="o<?php echo $employee_income_grid->RowIndex ?>_Taxable" id="o<?php echo $employee_income_grid->RowIndex ?>_Taxable" value="<?php echo HtmlEncode($employee_income_grid->Taxable->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employee_income" data-field="x_Taxable" name="femployee_incomegrid$x<?php echo $employee_income_grid->RowIndex ?>_Taxable" id="femployee_incomegrid$x<?php echo $employee_income_grid->RowIndex ?>_Taxable" value="<?php echo HtmlEncode($employee_income_grid->Taxable->FormValue) ?>">
<input type="hidden" data-table="employee_income" data-field="x_Taxable" name="femployee_incomegrid$o<?php echo $employee_income_grid->RowIndex ?>_Taxable" id="femployee_incomegrid$o<?php echo $employee_income_grid->RowIndex ?>_Taxable" value="<?php echo HtmlEncode($employee_income_grid->Taxable->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employee_income_grid->ListOptions->render("body", "right", $employee_income_grid->RowCount);
?>
	</tr>
<?php if ($employee_income->RowType == ROWTYPE_ADD || $employee_income->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["femployee_incomegrid", "load"], function() {
	femployee_incomegrid.updateLists(<?php echo $employee_income_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$employee_income_grid->isGridAdd() || $employee_income->CurrentMode == "copy")
		if (!$employee_income_grid->Recordset->EOF)
			$employee_income_grid->Recordset->moveNext();
}
?>
<?php
	if ($employee_income->CurrentMode == "add" || $employee_income->CurrentMode == "copy" || $employee_income->CurrentMode == "edit") {
		$employee_income_grid->RowIndex = '$rowindex$';
		$employee_income_grid->loadRowValues();

		// Set row properties
		$employee_income->resetAttributes();
		$employee_income->RowAttrs->merge(["data-rowindex" => $employee_income_grid->RowIndex, "id" => "r0_employee_income", "data-rowtype" => ROWTYPE_ADD]);
		$employee_income->RowAttrs->appendClass("ew-template");
		$employee_income->RowType = ROWTYPE_ADD;

		// Render row
		$employee_income_grid->renderRow();

		// Render list options
		$employee_income_grid->renderListOptions();
		$employee_income_grid->StartRowCount = 0;
?>
	<tr <?php echo $employee_income->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employee_income_grid->ListOptions->render("body", "left", $employee_income_grid->RowIndex);
?>
	<?php if ($employee_income_grid->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID">
<?php if (!$employee_income->isConfirm()) { ?>
<?php if ($employee_income_grid->EmployeeID->getSessionValue() != "") { ?>
<span id="el$rowindex$_employee_income_EmployeeID" class="form-group employee_income_EmployeeID">
<span<?php echo $employee_income_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_income_grid->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" name="x<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_income_grid->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_employee_income_EmployeeID" class="form-group employee_income_EmployeeID">
<input type="text" data-table="employee_income" data-field="x_EmployeeID" name="x<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" id="x<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employee_income_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employee_income_grid->EmployeeID->EditValue ?>"<?php echo $employee_income_grid->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_employee_income_EmployeeID" class="form-group employee_income_EmployeeID">
<span<?php echo $employee_income_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_income_grid->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employee_income" data-field="x_EmployeeID" name="x<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" id="x<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_income_grid->EmployeeID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employee_income" data-field="x_EmployeeID" name="o<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" id="o<?php echo $employee_income_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_income_grid->EmployeeID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_income_grid->PaidPosition->Visible) { // PaidPosition ?>
		<td data-name="PaidPosition">
<?php if (!$employee_income->isConfirm()) { ?>
<span id="el$rowindex$_employee_income_PaidPosition" class="form-group employee_income_PaidPosition">
<?php
$onchange = $employee_income_grid->PaidPosition->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employee_income_grid->PaidPosition->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $employee_income_grid->RowIndex ?>_PaidPosition">
	<input type="text" class="form-control" name="sv_x<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" id="sv_x<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" value="<?php echo RemoveHtml($employee_income_grid->PaidPosition->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employee_income_grid->PaidPosition->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employee_income_grid->PaidPosition->getPlaceHolder()) ?>"<?php echo $employee_income_grid->PaidPosition->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_income" data-field="x_PaidPosition" data-value-separator="<?php echo $employee_income_grid->PaidPosition->displayValueSeparatorAttribute() ?>" name="x<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" id="x<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_income_grid->PaidPosition->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployee_incomegrid"], function() {
	femployee_incomegrid.createAutoSuggest({"id":"x<?php echo $employee_income_grid->RowIndex ?>_PaidPosition","forceSelect":false});
});
</script>
<?php echo $employee_income_grid->PaidPosition->Lookup->getParamTag($employee_income_grid, "p_x" . $employee_income_grid->RowIndex . "_PaidPosition") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_employee_income_PaidPosition" class="form-group employee_income_PaidPosition">
<span<?php echo $employee_income_grid->PaidPosition->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_income_grid->PaidPosition->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employee_income" data-field="x_PaidPosition" name="x<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" id="x<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_income_grid->PaidPosition->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employee_income" data-field="x_PaidPosition" name="o<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" id="o<?php echo $employee_income_grid->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_income_grid->PaidPosition->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_income_grid->PayrollDate->Visible) { // PayrollDate ?>
		<td data-name="PayrollDate">
<?php if (!$employee_income->isConfirm()) { ?>
<span id="el$rowindex$_employee_income_PayrollDate" class="form-group employee_income_PayrollDate">
<input type="text" data-table="employee_income" data-field="x_PayrollDate" name="x<?php echo $employee_income_grid->RowIndex ?>_PayrollDate" id="x<?php echo $employee_income_grid->RowIndex ?>_PayrollDate" placeholder="<?php echo HtmlEncode($employee_income_grid->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_grid->PayrollDate->EditValue ?>"<?php echo $employee_income_grid->PayrollDate->editAttributes() ?>>
<?php if (!$employee_income_grid->PayrollDate->ReadOnly && !$employee_income_grid->PayrollDate->Disabled && !isset($employee_income_grid->PayrollDate->EditAttrs["readonly"]) && !isset($employee_income_grid->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomegrid", "x<?php echo $employee_income_grid->RowIndex ?>_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_employee_income_PayrollDate" class="form-group employee_income_PayrollDate">
<span<?php echo $employee_income_grid->PayrollDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_income_grid->PayrollDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employee_income" data-field="x_PayrollDate" name="x<?php echo $employee_income_grid->RowIndex ?>_PayrollDate" id="x<?php echo $employee_income_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($employee_income_grid->PayrollDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employee_income" data-field="x_PayrollDate" name="o<?php echo $employee_income_grid->RowIndex ?>_PayrollDate" id="o<?php echo $employee_income_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($employee_income_grid->PayrollDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_income_grid->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod">
<?php if (!$employee_income->isConfirm()) { ?>
<span id="el$rowindex$_employee_income_PayrollPeriod" class="form-group employee_income_PayrollPeriod">
<input type="text" data-table="employee_income" data-field="x_PayrollPeriod" name="x<?php echo $employee_income_grid->RowIndex ?>_PayrollPeriod" id="x<?php echo $employee_income_grid->RowIndex ?>_PayrollPeriod" size="30" placeholder="<?php echo HtmlEncode($employee_income_grid->PayrollPeriod->getPlaceHolder()) ?>" value="<?php echo $employee_income_grid->PayrollPeriod->EditValue ?>"<?php echo $employee_income_grid->PayrollPeriod->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_employee_income_PayrollPeriod" class="form-group employee_income_PayrollPeriod">
<span<?php echo $employee_income_grid->PayrollPeriod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_income_grid->PayrollPeriod->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employee_income" data-field="x_PayrollPeriod" name="x<?php echo $employee_income_grid->RowIndex ?>_PayrollPeriod" id="x<?php echo $employee_income_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($employee_income_grid->PayrollPeriod->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employee_income" data-field="x_PayrollPeriod" name="o<?php echo $employee_income_grid->RowIndex ?>_PayrollPeriod" id="o<?php echo $employee_income_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($employee_income_grid->PayrollPeriod->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_income_grid->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate">
<?php if (!$employee_income->isConfirm()) { ?>
<span id="el$rowindex$_employee_income_StartDate" class="form-group employee_income_StartDate">
<input type="text" data-table="employee_income" data-field="x_StartDate" name="x<?php echo $employee_income_grid->RowIndex ?>_StartDate" id="x<?php echo $employee_income_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($employee_income_grid->StartDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_grid->StartDate->EditValue ?>"<?php echo $employee_income_grid->StartDate->editAttributes() ?>>
<?php if (!$employee_income_grid->StartDate->ReadOnly && !$employee_income_grid->StartDate->Disabled && !isset($employee_income_grid->StartDate->EditAttrs["readonly"]) && !isset($employee_income_grid->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomegrid", "x<?php echo $employee_income_grid->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_employee_income_StartDate" class="form-group employee_income_StartDate">
<span<?php echo $employee_income_grid->StartDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_income_grid->StartDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employee_income" data-field="x_StartDate" name="x<?php echo $employee_income_grid->RowIndex ?>_StartDate" id="x<?php echo $employee_income_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($employee_income_grid->StartDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employee_income" data-field="x_StartDate" name="o<?php echo $employee_income_grid->RowIndex ?>_StartDate" id="o<?php echo $employee_income_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($employee_income_grid->StartDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_income_grid->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate">
<?php if (!$employee_income->isConfirm()) { ?>
<span id="el$rowindex$_employee_income_EndDate" class="form-group employee_income_EndDate">
<input type="text" data-table="employee_income" data-field="x_EndDate" name="x<?php echo $employee_income_grid->RowIndex ?>_EndDate" id="x<?php echo $employee_income_grid->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($employee_income_grid->EndDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_grid->EndDate->EditValue ?>"<?php echo $employee_income_grid->EndDate->editAttributes() ?>>
<?php if (!$employee_income_grid->EndDate->ReadOnly && !$employee_income_grid->EndDate->Disabled && !isset($employee_income_grid->EndDate->EditAttrs["readonly"]) && !isset($employee_income_grid->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomegrid", "x<?php echo $employee_income_grid->RowIndex ?>_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_employee_income_EndDate" class="form-group employee_income_EndDate">
<span<?php echo $employee_income_grid->EndDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_income_grid->EndDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employee_income" data-field="x_EndDate" name="x<?php echo $employee_income_grid->RowIndex ?>_EndDate" id="x<?php echo $employee_income_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($employee_income_grid->EndDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employee_income" data-field="x_EndDate" name="o<?php echo $employee_income_grid->RowIndex ?>_EndDate" id="o<?php echo $employee_income_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($employee_income_grid->EndDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_income_grid->IncomeCode->Visible) { // IncomeCode ?>
		<td data-name="IncomeCode">
<?php if (!$employee_income->isConfirm()) { ?>
<span id="el$rowindex$_employee_income_IncomeCode" class="form-group employee_income_IncomeCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employee_income_grid->RowIndex ?>_IncomeCode"><?php echo EmptyValue(strval($employee_income_grid->IncomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employee_income_grid->IncomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employee_income_grid->IncomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employee_income_grid->IncomeCode->ReadOnly || $employee_income_grid->IncomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employee_income_grid->RowIndex ?>_IncomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employee_income_grid->IncomeCode->Lookup->getParamTag($employee_income_grid, "p_x" . $employee_income_grid->RowIndex . "_IncomeCode") ?>
<input type="hidden" data-table="employee_income" data-field="x_IncomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employee_income_grid->IncomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employee_income_grid->RowIndex ?>_IncomeCode" id="x<?php echo $employee_income_grid->RowIndex ?>_IncomeCode" value="<?php echo $employee_income_grid->IncomeCode->CurrentValue ?>"<?php echo $employee_income_grid->IncomeCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_employee_income_IncomeCode" class="form-group employee_income_IncomeCode">
<span<?php echo $employee_income_grid->IncomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_income_grid->IncomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employee_income" data-field="x_IncomeCode" name="x<?php echo $employee_income_grid->RowIndex ?>_IncomeCode" id="x<?php echo $employee_income_grid->RowIndex ?>_IncomeCode" value="<?php echo HtmlEncode($employee_income_grid->IncomeCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employee_income" data-field="x_IncomeCode" name="o<?php echo $employee_income_grid->RowIndex ?>_IncomeCode" id="o<?php echo $employee_income_grid->RowIndex ?>_IncomeCode" value="<?php echo HtmlEncode($employee_income_grid->IncomeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_income_grid->Income->Visible) { // Income ?>
		<td data-name="Income">
<?php if (!$employee_income->isConfirm()) { ?>
<span id="el$rowindex$_employee_income_Income" class="form-group employee_income_Income">
<input type="text" data-table="employee_income" data-field="x_Income" name="x<?php echo $employee_income_grid->RowIndex ?>_Income" id="x<?php echo $employee_income_grid->RowIndex ?>_Income" size="30" placeholder="<?php echo HtmlEncode($employee_income_grid->Income->getPlaceHolder()) ?>" value="<?php echo $employee_income_grid->Income->EditValue ?>"<?php echo $employee_income_grid->Income->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_employee_income_Income" class="form-group employee_income_Income">
<span<?php echo $employee_income_grid->Income->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_income_grid->Income->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employee_income" data-field="x_Income" name="x<?php echo $employee_income_grid->RowIndex ?>_Income" id="x<?php echo $employee_income_grid->RowIndex ?>_Income" value="<?php echo HtmlEncode($employee_income_grid->Income->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employee_income" data-field="x_Income" name="o<?php echo $employee_income_grid->RowIndex ?>_Income" id="o<?php echo $employee_income_grid->RowIndex ?>_Income" value="<?php echo HtmlEncode($employee_income_grid->Income->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_income_grid->Remarks->Visible) { // Remarks ?>
		<td data-name="Remarks">
<?php if (!$employee_income->isConfirm()) { ?>
<span id="el$rowindex$_employee_income_Remarks" class="form-group employee_income_Remarks">
<textarea data-table="employee_income" data-field="x_Remarks" name="x<?php echo $employee_income_grid->RowIndex ?>_Remarks" id="x<?php echo $employee_income_grid->RowIndex ?>_Remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employee_income_grid->Remarks->getPlaceHolder()) ?>"<?php echo $employee_income_grid->Remarks->editAttributes() ?>><?php echo $employee_income_grid->Remarks->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_employee_income_Remarks" class="form-group employee_income_Remarks">
<span<?php echo $employee_income_grid->Remarks->viewAttributes() ?>><?php echo $employee_income_grid->Remarks->ViewValue ?></span>
</span>
<input type="hidden" data-table="employee_income" data-field="x_Remarks" name="x<?php echo $employee_income_grid->RowIndex ?>_Remarks" id="x<?php echo $employee_income_grid->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($employee_income_grid->Remarks->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employee_income" data-field="x_Remarks" name="o<?php echo $employee_income_grid->RowIndex ?>_Remarks" id="o<?php echo $employee_income_grid->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($employee_income_grid->Remarks->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_income_grid->Taxable->Visible) { // Taxable ?>
		<td data-name="Taxable">
<?php if (!$employee_income->isConfirm()) { ?>
<span id="el$rowindex$_employee_income_Taxable" class="form-group employee_income_Taxable">
<input type="text" data-table="employee_income" data-field="x_Taxable" name="x<?php echo $employee_income_grid->RowIndex ?>_Taxable" id="x<?php echo $employee_income_grid->RowIndex ?>_Taxable" size="30" placeholder="<?php echo HtmlEncode($employee_income_grid->Taxable->getPlaceHolder()) ?>" value="<?php echo $employee_income_grid->Taxable->EditValue ?>"<?php echo $employee_income_grid->Taxable->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_employee_income_Taxable" class="form-group employee_income_Taxable">
<span<?php echo $employee_income_grid->Taxable->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_income_grid->Taxable->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employee_income" data-field="x_Taxable" name="x<?php echo $employee_income_grid->RowIndex ?>_Taxable" id="x<?php echo $employee_income_grid->RowIndex ?>_Taxable" value="<?php echo HtmlEncode($employee_income_grid->Taxable->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employee_income" data-field="x_Taxable" name="o<?php echo $employee_income_grid->RowIndex ?>_Taxable" id="o<?php echo $employee_income_grid->RowIndex ?>_Taxable" value="<?php echo HtmlEncode($employee_income_grid->Taxable->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employee_income_grid->ListOptions->render("body", "right", $employee_income_grid->RowIndex);
?>
<script>
loadjs.ready(["femployee_incomegrid", "load"], function() {
	femployee_incomegrid.updateLists(<?php echo $employee_income_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($employee_income->CurrentMode == "add" || $employee_income->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $employee_income_grid->FormKeyCountName ?>" id="<?php echo $employee_income_grid->FormKeyCountName ?>" value="<?php echo $employee_income_grid->KeyCount ?>">
<?php echo $employee_income_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($employee_income->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $employee_income_grid->FormKeyCountName ?>" id="<?php echo $employee_income_grid->FormKeyCountName ?>" value="<?php echo $employee_income_grid->KeyCount ?>">
<?php echo $employee_income_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($employee_income->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="femployee_incomegrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($employee_income_grid->Recordset)
	$employee_income_grid->Recordset->Close();
?>
<?php if ($employee_income_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $employee_income_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($employee_income_grid->TotalRecords == 0 && !$employee_income->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $employee_income_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$employee_income_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$employee_income_grid->terminate();
?>