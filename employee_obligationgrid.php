<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($employee_obligation_grid))
	$employee_obligation_grid = new employee_obligation_grid();

// Run the page
$employee_obligation_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_obligation_grid->Page_Render();
?>
<?php if (!$employee_obligation_grid->isExport()) { ?>
<script>
var femployee_obligationgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	femployee_obligationgrid = new ew.Form("femployee_obligationgrid", "grid");
	femployee_obligationgrid.formKeyCountName = '<?php echo $employee_obligation_grid->FormKeyCountName ?>';

	// Validate form
	femployee_obligationgrid.validate = function() {
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
			<?php if ($employee_obligation_grid->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_grid->EmployeeID->caption(), $employee_obligation_grid->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_grid->EmployeeID->errorMessage()) ?>");
			<?php if ($employee_obligation_grid->PaidPosition->Required) { ?>
				elm = this.getElements("x" + infix + "_PaidPosition");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_grid->PaidPosition->caption(), $employee_obligation_grid->PaidPosition->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PaidPosition");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_grid->PaidPosition->errorMessage()) ?>");
			<?php if ($employee_obligation_grid->PayrollDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_grid->PayrollDate->caption(), $employee_obligation_grid->PayrollDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_grid->PayrollDate->errorMessage()) ?>");
			<?php if ($employee_obligation_grid->PayrollPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_grid->PayrollPeriod->caption(), $employee_obligation_grid->PayrollPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollPeriod");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_grid->PayrollPeriod->errorMessage()) ?>");
			<?php if ($employee_obligation_grid->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_grid->StartDate->caption(), $employee_obligation_grid->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_grid->StartDate->errorMessage()) ?>");
			<?php if ($employee_obligation_grid->Enddate->Required) { ?>
				elm = this.getElements("x" + infix + "_Enddate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_grid->Enddate->caption(), $employee_obligation_grid->Enddate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Enddate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_grid->Enddate->errorMessage()) ?>");
			<?php if ($employee_obligation_grid->ObligationCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ObligationCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_grid->ObligationCode->caption(), $employee_obligation_grid->ObligationCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_obligation_grid->ObligationAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_ObligationAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_grid->ObligationAmount->caption(), $employee_obligation_grid->ObligationAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ObligationAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_grid->ObligationAmount->errorMessage()) ?>");
			<?php if ($employee_obligation_grid->Remarks->Required) { ?>
				elm = this.getElements("x" + infix + "_Remarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_grid->Remarks->caption(), $employee_obligation_grid->Remarks->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	femployee_obligationgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "EmployeeID", false)) return false;
		if (ew.valueChanged(fobj, infix, "PaidPosition", false)) return false;
		if (ew.valueChanged(fobj, infix, "PayrollDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "PayrollPeriod", false)) return false;
		if (ew.valueChanged(fobj, infix, "StartDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "Enddate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ObligationCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ObligationAmount", false)) return false;
		if (ew.valueChanged(fobj, infix, "Remarks", false)) return false;
		return true;
	}

	// Form_CustomValidate
	femployee_obligationgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployee_obligationgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femployee_obligationgrid.lists["x_PaidPosition"] = <?php echo $employee_obligation_grid->PaidPosition->Lookup->toClientList($employee_obligation_grid) ?>;
	femployee_obligationgrid.lists["x_PaidPosition"].options = <?php echo JsonEncode($employee_obligation_grid->PaidPosition->lookupOptions()) ?>;
	femployee_obligationgrid.autoSuggests["x_PaidPosition"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("femployee_obligationgrid");
});
</script>
<?php } ?>
<?php
$employee_obligation_grid->renderOtherOptions();
?>
<?php if ($employee_obligation_grid->TotalRecords > 0 || $employee_obligation->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($employee_obligation_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> employee_obligation">
<?php if ($employee_obligation_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $employee_obligation_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="femployee_obligationgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_employee_obligation" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_employee_obligationgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$employee_obligation->RowType = ROWTYPE_HEADER;

// Render list options
$employee_obligation_grid->renderListOptions();

// Render list options (header, left)
$employee_obligation_grid->ListOptions->render("header", "left");
?>
<?php if ($employee_obligation_grid->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($employee_obligation_grid->SortUrl($employee_obligation_grid->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $employee_obligation_grid->EmployeeID->headerCellClass() ?>"><div id="elh_employee_obligation_EmployeeID" class="employee_obligation_EmployeeID"><div class="ew-table-header-caption"><?php echo $employee_obligation_grid->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $employee_obligation_grid->EmployeeID->headerCellClass() ?>"><div><div id="elh_employee_obligation_EmployeeID" class="employee_obligation_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_grid->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_grid->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_grid->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_obligation_grid->PaidPosition->Visible) { // PaidPosition ?>
	<?php if ($employee_obligation_grid->SortUrl($employee_obligation_grid->PaidPosition) == "") { ?>
		<th data-name="PaidPosition" class="<?php echo $employee_obligation_grid->PaidPosition->headerCellClass() ?>"><div id="elh_employee_obligation_PaidPosition" class="employee_obligation_PaidPosition"><div class="ew-table-header-caption"><?php echo $employee_obligation_grid->PaidPosition->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaidPosition" class="<?php echo $employee_obligation_grid->PaidPosition->headerCellClass() ?>"><div><div id="elh_employee_obligation_PaidPosition" class="employee_obligation_PaidPosition">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_grid->PaidPosition->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_grid->PaidPosition->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_grid->PaidPosition->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_obligation_grid->PayrollDate->Visible) { // PayrollDate ?>
	<?php if ($employee_obligation_grid->SortUrl($employee_obligation_grid->PayrollDate) == "") { ?>
		<th data-name="PayrollDate" class="<?php echo $employee_obligation_grid->PayrollDate->headerCellClass() ?>"><div id="elh_employee_obligation_PayrollDate" class="employee_obligation_PayrollDate"><div class="ew-table-header-caption"><?php echo $employee_obligation_grid->PayrollDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollDate" class="<?php echo $employee_obligation_grid->PayrollDate->headerCellClass() ?>"><div><div id="elh_employee_obligation_PayrollDate" class="employee_obligation_PayrollDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_grid->PayrollDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_grid->PayrollDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_grid->PayrollDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_obligation_grid->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($employee_obligation_grid->SortUrl($employee_obligation_grid->PayrollPeriod) == "") { ?>
		<th data-name="PayrollPeriod" class="<?php echo $employee_obligation_grid->PayrollPeriod->headerCellClass() ?>"><div id="elh_employee_obligation_PayrollPeriod" class="employee_obligation_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $employee_obligation_grid->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollPeriod" class="<?php echo $employee_obligation_grid->PayrollPeriod->headerCellClass() ?>"><div><div id="elh_employee_obligation_PayrollPeriod" class="employee_obligation_PayrollPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_grid->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_grid->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_grid->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_obligation_grid->StartDate->Visible) { // StartDate ?>
	<?php if ($employee_obligation_grid->SortUrl($employee_obligation_grid->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $employee_obligation_grid->StartDate->headerCellClass() ?>"><div id="elh_employee_obligation_StartDate" class="employee_obligation_StartDate"><div class="ew-table-header-caption"><?php echo $employee_obligation_grid->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $employee_obligation_grid->StartDate->headerCellClass() ?>"><div><div id="elh_employee_obligation_StartDate" class="employee_obligation_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_grid->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_grid->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_grid->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_obligation_grid->Enddate->Visible) { // Enddate ?>
	<?php if ($employee_obligation_grid->SortUrl($employee_obligation_grid->Enddate) == "") { ?>
		<th data-name="Enddate" class="<?php echo $employee_obligation_grid->Enddate->headerCellClass() ?>"><div id="elh_employee_obligation_Enddate" class="employee_obligation_Enddate"><div class="ew-table-header-caption"><?php echo $employee_obligation_grid->Enddate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Enddate" class="<?php echo $employee_obligation_grid->Enddate->headerCellClass() ?>"><div><div id="elh_employee_obligation_Enddate" class="employee_obligation_Enddate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_grid->Enddate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_grid->Enddate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_grid->Enddate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_obligation_grid->ObligationCode->Visible) { // ObligationCode ?>
	<?php if ($employee_obligation_grid->SortUrl($employee_obligation_grid->ObligationCode) == "") { ?>
		<th data-name="ObligationCode" class="<?php echo $employee_obligation_grid->ObligationCode->headerCellClass() ?>"><div id="elh_employee_obligation_ObligationCode" class="employee_obligation_ObligationCode"><div class="ew-table-header-caption"><?php echo $employee_obligation_grid->ObligationCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ObligationCode" class="<?php echo $employee_obligation_grid->ObligationCode->headerCellClass() ?>"><div><div id="elh_employee_obligation_ObligationCode" class="employee_obligation_ObligationCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_grid->ObligationCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_grid->ObligationCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_grid->ObligationCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_obligation_grid->ObligationAmount->Visible) { // ObligationAmount ?>
	<?php if ($employee_obligation_grid->SortUrl($employee_obligation_grid->ObligationAmount) == "") { ?>
		<th data-name="ObligationAmount" class="<?php echo $employee_obligation_grid->ObligationAmount->headerCellClass() ?>"><div id="elh_employee_obligation_ObligationAmount" class="employee_obligation_ObligationAmount"><div class="ew-table-header-caption"><?php echo $employee_obligation_grid->ObligationAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ObligationAmount" class="<?php echo $employee_obligation_grid->ObligationAmount->headerCellClass() ?>"><div><div id="elh_employee_obligation_ObligationAmount" class="employee_obligation_ObligationAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_grid->ObligationAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_grid->ObligationAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_grid->ObligationAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_obligation_grid->Remarks->Visible) { // Remarks ?>
	<?php if ($employee_obligation_grid->SortUrl($employee_obligation_grid->Remarks) == "") { ?>
		<th data-name="Remarks" class="<?php echo $employee_obligation_grid->Remarks->headerCellClass() ?>"><div id="elh_employee_obligation_Remarks" class="employee_obligation_Remarks"><div class="ew-table-header-caption"><?php echo $employee_obligation_grid->Remarks->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Remarks" class="<?php echo $employee_obligation_grid->Remarks->headerCellClass() ?>"><div><div id="elh_employee_obligation_Remarks" class="employee_obligation_Remarks">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_grid->Remarks->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_grid->Remarks->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_grid->Remarks->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$employee_obligation_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$employee_obligation_grid->StartRecord = 1;
$employee_obligation_grid->StopRecord = $employee_obligation_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($employee_obligation->isConfirm() || $employee_obligation_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($employee_obligation_grid->FormKeyCountName) && ($employee_obligation_grid->isGridAdd() || $employee_obligation_grid->isGridEdit() || $employee_obligation->isConfirm())) {
		$employee_obligation_grid->KeyCount = $CurrentForm->getValue($employee_obligation_grid->FormKeyCountName);
		$employee_obligation_grid->StopRecord = $employee_obligation_grid->StartRecord + $employee_obligation_grid->KeyCount - 1;
	}
}
$employee_obligation_grid->RecordCount = $employee_obligation_grid->StartRecord - 1;
if ($employee_obligation_grid->Recordset && !$employee_obligation_grid->Recordset->EOF) {
	$employee_obligation_grid->Recordset->moveFirst();
	$selectLimit = $employee_obligation_grid->UseSelectLimit;
	if (!$selectLimit && $employee_obligation_grid->StartRecord > 1)
		$employee_obligation_grid->Recordset->move($employee_obligation_grid->StartRecord - 1);
} elseif (!$employee_obligation->AllowAddDeleteRow && $employee_obligation_grid->StopRecord == 0) {
	$employee_obligation_grid->StopRecord = $employee_obligation->GridAddRowCount;
}

// Initialize aggregate
$employee_obligation->RowType = ROWTYPE_AGGREGATEINIT;
$employee_obligation->resetAttributes();
$employee_obligation_grid->renderRow();
if ($employee_obligation_grid->isGridAdd())
	$employee_obligation_grid->RowIndex = 0;
if ($employee_obligation_grid->isGridEdit())
	$employee_obligation_grid->RowIndex = 0;
while ($employee_obligation_grid->RecordCount < $employee_obligation_grid->StopRecord) {
	$employee_obligation_grid->RecordCount++;
	if ($employee_obligation_grid->RecordCount >= $employee_obligation_grid->StartRecord) {
		$employee_obligation_grid->RowCount++;
		if ($employee_obligation_grid->isGridAdd() || $employee_obligation_grid->isGridEdit() || $employee_obligation->isConfirm()) {
			$employee_obligation_grid->RowIndex++;
			$CurrentForm->Index = $employee_obligation_grid->RowIndex;
			if ($CurrentForm->hasValue($employee_obligation_grid->FormActionName) && ($employee_obligation->isConfirm() || $employee_obligation_grid->EventCancelled))
				$employee_obligation_grid->RowAction = strval($CurrentForm->getValue($employee_obligation_grid->FormActionName));
			elseif ($employee_obligation_grid->isGridAdd())
				$employee_obligation_grid->RowAction = "insert";
			else
				$employee_obligation_grid->RowAction = "";
		}

		// Set up key count
		$employee_obligation_grid->KeyCount = $employee_obligation_grid->RowIndex;

		// Init row class and style
		$employee_obligation->resetAttributes();
		$employee_obligation->CssClass = "";
		if ($employee_obligation_grid->isGridAdd()) {
			if ($employee_obligation->CurrentMode == "copy") {
				$employee_obligation_grid->loadRowValues($employee_obligation_grid->Recordset); // Load row values
				$employee_obligation_grid->setRecordKey($employee_obligation_grid->RowOldKey, $employee_obligation_grid->Recordset); // Set old record key
			} else {
				$employee_obligation_grid->loadRowValues(); // Load default values
				$employee_obligation_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$employee_obligation_grid->loadRowValues($employee_obligation_grid->Recordset); // Load row values
		}
		$employee_obligation->RowType = ROWTYPE_VIEW; // Render view
		if ($employee_obligation_grid->isGridAdd()) // Grid add
			$employee_obligation->RowType = ROWTYPE_ADD; // Render add
		if ($employee_obligation_grid->isGridAdd() && $employee_obligation->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$employee_obligation_grid->restoreCurrentRowFormValues($employee_obligation_grid->RowIndex); // Restore form values
		if ($employee_obligation_grid->isGridEdit()) { // Grid edit
			if ($employee_obligation->EventCancelled)
				$employee_obligation_grid->restoreCurrentRowFormValues($employee_obligation_grid->RowIndex); // Restore form values
			if ($employee_obligation_grid->RowAction == "insert")
				$employee_obligation->RowType = ROWTYPE_ADD; // Render add
			else
				$employee_obligation->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($employee_obligation_grid->isGridEdit() && ($employee_obligation->RowType == ROWTYPE_EDIT || $employee_obligation->RowType == ROWTYPE_ADD) && $employee_obligation->EventCancelled) // Update failed
			$employee_obligation_grid->restoreCurrentRowFormValues($employee_obligation_grid->RowIndex); // Restore form values
		if ($employee_obligation->RowType == ROWTYPE_EDIT) // Edit row
			$employee_obligation_grid->EditRowCount++;
		if ($employee_obligation->isConfirm()) // Confirm row
			$employee_obligation_grid->restoreCurrentRowFormValues($employee_obligation_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$employee_obligation->RowAttrs->merge(["data-rowindex" => $employee_obligation_grid->RowCount, "id" => "r" . $employee_obligation_grid->RowCount . "_employee_obligation", "data-rowtype" => $employee_obligation->RowType]);

		// Render row
		$employee_obligation_grid->renderRow();

		// Render list options
		$employee_obligation_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($employee_obligation_grid->RowAction != "delete" && $employee_obligation_grid->RowAction != "insertdelete" && !($employee_obligation_grid->RowAction == "insert" && $employee_obligation->isConfirm() && $employee_obligation_grid->emptyRow())) {
?>
	<tr <?php echo $employee_obligation->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employee_obligation_grid->ListOptions->render("body", "left", $employee_obligation_grid->RowCount);
?>
	<?php if ($employee_obligation_grid->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $employee_obligation_grid->EmployeeID->cellAttributes() ?>>
<?php if ($employee_obligation->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($employee_obligation_grid->EmployeeID->getSessionValue() != "") { ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_EmployeeID" class="form-group">
<span<?php echo $employee_obligation_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_obligation_grid->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" name="x<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_obligation_grid->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_EmployeeID" class="form-group">
<input type="text" data-table="employee_obligation" data-field="x_EmployeeID" name="x<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" id="x<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_grid->EmployeeID->EditValue ?>"<?php echo $employee_obligation_grid->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="employee_obligation" data-field="x_EmployeeID" name="o<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" id="o<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_obligation_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($employee_obligation_grid->EmployeeID->getSessionValue() != "") { ?>

<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_EmployeeID" class="form-group">
<span<?php echo $employee_obligation_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_obligation_grid->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" name="x<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_obligation_grid->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="employee_obligation" data-field="x_EmployeeID" name="x<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" id="x<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_grid->EmployeeID->EditValue ?>"<?php echo $employee_obligation_grid->EmployeeID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="employee_obligation" data-field="x_EmployeeID" name="o<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" id="o<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_obligation_grid->EmployeeID->OldValue != null ? $employee_obligation_grid->EmployeeID->OldValue : $employee_obligation_grid->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_EmployeeID">
<span<?php echo $employee_obligation_grid->EmployeeID->viewAttributes() ?>><?php echo $employee_obligation_grid->EmployeeID->getViewValue() ?></span>
</span>
<?php if (!$employee_obligation->isConfirm()) { ?>
<input type="hidden" data-table="employee_obligation" data-field="x_EmployeeID" name="x<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" id="x<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_obligation_grid->EmployeeID->FormValue) ?>">
<input type="hidden" data-table="employee_obligation" data-field="x_EmployeeID" name="o<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" id="o<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_obligation_grid->EmployeeID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employee_obligation" data-field="x_EmployeeID" name="femployee_obligationgrid$x<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" id="femployee_obligationgrid$x<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_obligation_grid->EmployeeID->FormValue) ?>">
<input type="hidden" data-table="employee_obligation" data-field="x_EmployeeID" name="femployee_obligationgrid$o<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" id="femployee_obligationgrid$o<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_obligation_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_obligation_grid->PaidPosition->Visible) { // PaidPosition ?>
		<td data-name="PaidPosition" <?php echo $employee_obligation_grid->PaidPosition->cellAttributes() ?>>
<?php if ($employee_obligation->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_PaidPosition" class="form-group">
<?php
$onchange = $employee_obligation_grid->PaidPosition->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employee_obligation_grid->PaidPosition->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition">
	<input type="text" class="form-control" name="sv_x<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" id="sv_x<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" value="<?php echo RemoveHtml($employee_obligation_grid->PaidPosition->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_grid->PaidPosition->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employee_obligation_grid->PaidPosition->getPlaceHolder()) ?>"<?php echo $employee_obligation_grid->PaidPosition->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_PaidPosition" data-value-separator="<?php echo $employee_obligation_grid->PaidPosition->displayValueSeparatorAttribute() ?>" name="x<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" id="x<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_obligation_grid->PaidPosition->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployee_obligationgrid"], function() {
	femployee_obligationgrid.createAutoSuggest({"id":"x<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition","forceSelect":false});
});
</script>
<?php echo $employee_obligation_grid->PaidPosition->Lookup->getParamTag($employee_obligation_grid, "p_x" . $employee_obligation_grid->RowIndex . "_PaidPosition") ?>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_PaidPosition" name="o<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" id="o<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_obligation_grid->PaidPosition->OldValue) ?>">
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_PaidPosition" class="form-group">
<?php
$onchange = $employee_obligation_grid->PaidPosition->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employee_obligation_grid->PaidPosition->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition">
	<input type="text" class="form-control" name="sv_x<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" id="sv_x<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" value="<?php echo RemoveHtml($employee_obligation_grid->PaidPosition->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_grid->PaidPosition->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employee_obligation_grid->PaidPosition->getPlaceHolder()) ?>"<?php echo $employee_obligation_grid->PaidPosition->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_PaidPosition" data-value-separator="<?php echo $employee_obligation_grid->PaidPosition->displayValueSeparatorAttribute() ?>" name="x<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" id="x<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_obligation_grid->PaidPosition->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployee_obligationgrid"], function() {
	femployee_obligationgrid.createAutoSuggest({"id":"x<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition","forceSelect":false});
});
</script>
<?php echo $employee_obligation_grid->PaidPosition->Lookup->getParamTag($employee_obligation_grid, "p_x" . $employee_obligation_grid->RowIndex . "_PaidPosition") ?>
</span>
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_PaidPosition">
<span<?php echo $employee_obligation_grid->PaidPosition->viewAttributes() ?>><?php echo $employee_obligation_grid->PaidPosition->getViewValue() ?></span>
</span>
<?php if (!$employee_obligation->isConfirm()) { ?>
<input type="hidden" data-table="employee_obligation" data-field="x_PaidPosition" name="x<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" id="x<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_obligation_grid->PaidPosition->FormValue) ?>">
<input type="hidden" data-table="employee_obligation" data-field="x_PaidPosition" name="o<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" id="o<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_obligation_grid->PaidPosition->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employee_obligation" data-field="x_PaidPosition" name="femployee_obligationgrid$x<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" id="femployee_obligationgrid$x<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_obligation_grid->PaidPosition->FormValue) ?>">
<input type="hidden" data-table="employee_obligation" data-field="x_PaidPosition" name="femployee_obligationgrid$o<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" id="femployee_obligationgrid$o<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_obligation_grid->PaidPosition->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_obligation_grid->PayrollDate->Visible) { // PayrollDate ?>
		<td data-name="PayrollDate" <?php echo $employee_obligation_grid->PayrollDate->cellAttributes() ?>>
<?php if ($employee_obligation->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_PayrollDate" class="form-group">
<input type="text" data-table="employee_obligation" data-field="x_PayrollDate" name="x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollDate" id="x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollDate" placeholder="<?php echo HtmlEncode($employee_obligation_grid->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_grid->PayrollDate->EditValue ?>"<?php echo $employee_obligation_grid->PayrollDate->editAttributes() ?>>
<?php if (!$employee_obligation_grid->PayrollDate->ReadOnly && !$employee_obligation_grid->PayrollDate->Disabled && !isset($employee_obligation_grid->PayrollDate->EditAttrs["readonly"]) && !isset($employee_obligation_grid->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationgrid", "x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_PayrollDate" name="o<?php echo $employee_obligation_grid->RowIndex ?>_PayrollDate" id="o<?php echo $employee_obligation_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($employee_obligation_grid->PayrollDate->OldValue) ?>">
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_PayrollDate" class="form-group">
<input type="text" data-table="employee_obligation" data-field="x_PayrollDate" name="x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollDate" id="x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollDate" placeholder="<?php echo HtmlEncode($employee_obligation_grid->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_grid->PayrollDate->EditValue ?>"<?php echo $employee_obligation_grid->PayrollDate->editAttributes() ?>>
<?php if (!$employee_obligation_grid->PayrollDate->ReadOnly && !$employee_obligation_grid->PayrollDate->Disabled && !isset($employee_obligation_grid->PayrollDate->EditAttrs["readonly"]) && !isset($employee_obligation_grid->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationgrid", "x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_PayrollDate">
<span<?php echo $employee_obligation_grid->PayrollDate->viewAttributes() ?>><?php echo $employee_obligation_grid->PayrollDate->getViewValue() ?></span>
</span>
<?php if (!$employee_obligation->isConfirm()) { ?>
<input type="hidden" data-table="employee_obligation" data-field="x_PayrollDate" name="x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollDate" id="x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($employee_obligation_grid->PayrollDate->FormValue) ?>">
<input type="hidden" data-table="employee_obligation" data-field="x_PayrollDate" name="o<?php echo $employee_obligation_grid->RowIndex ?>_PayrollDate" id="o<?php echo $employee_obligation_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($employee_obligation_grid->PayrollDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employee_obligation" data-field="x_PayrollDate" name="femployee_obligationgrid$x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollDate" id="femployee_obligationgrid$x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($employee_obligation_grid->PayrollDate->FormValue) ?>">
<input type="hidden" data-table="employee_obligation" data-field="x_PayrollDate" name="femployee_obligationgrid$o<?php echo $employee_obligation_grid->RowIndex ?>_PayrollDate" id="femployee_obligationgrid$o<?php echo $employee_obligation_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($employee_obligation_grid->PayrollDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_obligation_grid->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod" <?php echo $employee_obligation_grid->PayrollPeriod->cellAttributes() ?>>
<?php if ($employee_obligation->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_PayrollPeriod" class="form-group">
<input type="text" data-table="employee_obligation" data-field="x_PayrollPeriod" name="x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollPeriod" id="x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollPeriod" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_grid->PayrollPeriod->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_grid->PayrollPeriod->EditValue ?>"<?php echo $employee_obligation_grid->PayrollPeriod->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_PayrollPeriod" name="o<?php echo $employee_obligation_grid->RowIndex ?>_PayrollPeriod" id="o<?php echo $employee_obligation_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($employee_obligation_grid->PayrollPeriod->OldValue) ?>">
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="employee_obligation" data-field="x_PayrollPeriod" name="x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollPeriod" id="x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollPeriod" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_grid->PayrollPeriod->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_grid->PayrollPeriod->EditValue ?>"<?php echo $employee_obligation_grid->PayrollPeriod->editAttributes() ?>>
<input type="hidden" data-table="employee_obligation" data-field="x_PayrollPeriod" name="o<?php echo $employee_obligation_grid->RowIndex ?>_PayrollPeriod" id="o<?php echo $employee_obligation_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($employee_obligation_grid->PayrollPeriod->OldValue != null ? $employee_obligation_grid->PayrollPeriod->OldValue : $employee_obligation_grid->PayrollPeriod->CurrentValue) ?>">
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_PayrollPeriod">
<span<?php echo $employee_obligation_grid->PayrollPeriod->viewAttributes() ?>><?php echo $employee_obligation_grid->PayrollPeriod->getViewValue() ?></span>
</span>
<?php if (!$employee_obligation->isConfirm()) { ?>
<input type="hidden" data-table="employee_obligation" data-field="x_PayrollPeriod" name="x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollPeriod" id="x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($employee_obligation_grid->PayrollPeriod->FormValue) ?>">
<input type="hidden" data-table="employee_obligation" data-field="x_PayrollPeriod" name="o<?php echo $employee_obligation_grid->RowIndex ?>_PayrollPeriod" id="o<?php echo $employee_obligation_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($employee_obligation_grid->PayrollPeriod->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employee_obligation" data-field="x_PayrollPeriod" name="femployee_obligationgrid$x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollPeriod" id="femployee_obligationgrid$x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($employee_obligation_grid->PayrollPeriod->FormValue) ?>">
<input type="hidden" data-table="employee_obligation" data-field="x_PayrollPeriod" name="femployee_obligationgrid$o<?php echo $employee_obligation_grid->RowIndex ?>_PayrollPeriod" id="femployee_obligationgrid$o<?php echo $employee_obligation_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($employee_obligation_grid->PayrollPeriod->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_obligation_grid->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $employee_obligation_grid->StartDate->cellAttributes() ?>>
<?php if ($employee_obligation->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_StartDate" class="form-group">
<input type="text" data-table="employee_obligation" data-field="x_StartDate" name="x<?php echo $employee_obligation_grid->RowIndex ?>_StartDate" id="x<?php echo $employee_obligation_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($employee_obligation_grid->StartDate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_grid->StartDate->EditValue ?>"<?php echo $employee_obligation_grid->StartDate->editAttributes() ?>>
<?php if (!$employee_obligation_grid->StartDate->ReadOnly && !$employee_obligation_grid->StartDate->Disabled && !isset($employee_obligation_grid->StartDate->EditAttrs["readonly"]) && !isset($employee_obligation_grid->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationgrid", "x<?php echo $employee_obligation_grid->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_StartDate" name="o<?php echo $employee_obligation_grid->RowIndex ?>_StartDate" id="o<?php echo $employee_obligation_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($employee_obligation_grid->StartDate->OldValue) ?>">
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_StartDate" class="form-group">
<input type="text" data-table="employee_obligation" data-field="x_StartDate" name="x<?php echo $employee_obligation_grid->RowIndex ?>_StartDate" id="x<?php echo $employee_obligation_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($employee_obligation_grid->StartDate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_grid->StartDate->EditValue ?>"<?php echo $employee_obligation_grid->StartDate->editAttributes() ?>>
<?php if (!$employee_obligation_grid->StartDate->ReadOnly && !$employee_obligation_grid->StartDate->Disabled && !isset($employee_obligation_grid->StartDate->EditAttrs["readonly"]) && !isset($employee_obligation_grid->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationgrid", "x<?php echo $employee_obligation_grid->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_StartDate">
<span<?php echo $employee_obligation_grid->StartDate->viewAttributes() ?>><?php echo $employee_obligation_grid->StartDate->getViewValue() ?></span>
</span>
<?php if (!$employee_obligation->isConfirm()) { ?>
<input type="hidden" data-table="employee_obligation" data-field="x_StartDate" name="x<?php echo $employee_obligation_grid->RowIndex ?>_StartDate" id="x<?php echo $employee_obligation_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($employee_obligation_grid->StartDate->FormValue) ?>">
<input type="hidden" data-table="employee_obligation" data-field="x_StartDate" name="o<?php echo $employee_obligation_grid->RowIndex ?>_StartDate" id="o<?php echo $employee_obligation_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($employee_obligation_grid->StartDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employee_obligation" data-field="x_StartDate" name="femployee_obligationgrid$x<?php echo $employee_obligation_grid->RowIndex ?>_StartDate" id="femployee_obligationgrid$x<?php echo $employee_obligation_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($employee_obligation_grid->StartDate->FormValue) ?>">
<input type="hidden" data-table="employee_obligation" data-field="x_StartDate" name="femployee_obligationgrid$o<?php echo $employee_obligation_grid->RowIndex ?>_StartDate" id="femployee_obligationgrid$o<?php echo $employee_obligation_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($employee_obligation_grid->StartDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_obligation_grid->Enddate->Visible) { // Enddate ?>
		<td data-name="Enddate" <?php echo $employee_obligation_grid->Enddate->cellAttributes() ?>>
<?php if ($employee_obligation->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_Enddate" class="form-group">
<input type="text" data-table="employee_obligation" data-field="x_Enddate" name="x<?php echo $employee_obligation_grid->RowIndex ?>_Enddate" id="x<?php echo $employee_obligation_grid->RowIndex ?>_Enddate" placeholder="<?php echo HtmlEncode($employee_obligation_grid->Enddate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_grid->Enddate->EditValue ?>"<?php echo $employee_obligation_grid->Enddate->editAttributes() ?>>
<?php if (!$employee_obligation_grid->Enddate->ReadOnly && !$employee_obligation_grid->Enddate->Disabled && !isset($employee_obligation_grid->Enddate->EditAttrs["readonly"]) && !isset($employee_obligation_grid->Enddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationgrid", "x<?php echo $employee_obligation_grid->RowIndex ?>_Enddate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_Enddate" name="o<?php echo $employee_obligation_grid->RowIndex ?>_Enddate" id="o<?php echo $employee_obligation_grid->RowIndex ?>_Enddate" value="<?php echo HtmlEncode($employee_obligation_grid->Enddate->OldValue) ?>">
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_Enddate" class="form-group">
<input type="text" data-table="employee_obligation" data-field="x_Enddate" name="x<?php echo $employee_obligation_grid->RowIndex ?>_Enddate" id="x<?php echo $employee_obligation_grid->RowIndex ?>_Enddate" placeholder="<?php echo HtmlEncode($employee_obligation_grid->Enddate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_grid->Enddate->EditValue ?>"<?php echo $employee_obligation_grid->Enddate->editAttributes() ?>>
<?php if (!$employee_obligation_grid->Enddate->ReadOnly && !$employee_obligation_grid->Enddate->Disabled && !isset($employee_obligation_grid->Enddate->EditAttrs["readonly"]) && !isset($employee_obligation_grid->Enddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationgrid", "x<?php echo $employee_obligation_grid->RowIndex ?>_Enddate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_Enddate">
<span<?php echo $employee_obligation_grid->Enddate->viewAttributes() ?>><?php echo $employee_obligation_grid->Enddate->getViewValue() ?></span>
</span>
<?php if (!$employee_obligation->isConfirm()) { ?>
<input type="hidden" data-table="employee_obligation" data-field="x_Enddate" name="x<?php echo $employee_obligation_grid->RowIndex ?>_Enddate" id="x<?php echo $employee_obligation_grid->RowIndex ?>_Enddate" value="<?php echo HtmlEncode($employee_obligation_grid->Enddate->FormValue) ?>">
<input type="hidden" data-table="employee_obligation" data-field="x_Enddate" name="o<?php echo $employee_obligation_grid->RowIndex ?>_Enddate" id="o<?php echo $employee_obligation_grid->RowIndex ?>_Enddate" value="<?php echo HtmlEncode($employee_obligation_grid->Enddate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employee_obligation" data-field="x_Enddate" name="femployee_obligationgrid$x<?php echo $employee_obligation_grid->RowIndex ?>_Enddate" id="femployee_obligationgrid$x<?php echo $employee_obligation_grid->RowIndex ?>_Enddate" value="<?php echo HtmlEncode($employee_obligation_grid->Enddate->FormValue) ?>">
<input type="hidden" data-table="employee_obligation" data-field="x_Enddate" name="femployee_obligationgrid$o<?php echo $employee_obligation_grid->RowIndex ?>_Enddate" id="femployee_obligationgrid$o<?php echo $employee_obligation_grid->RowIndex ?>_Enddate" value="<?php echo HtmlEncode($employee_obligation_grid->Enddate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_obligation_grid->ObligationCode->Visible) { // ObligationCode ?>
		<td data-name="ObligationCode" <?php echo $employee_obligation_grid->ObligationCode->cellAttributes() ?>>
<?php if ($employee_obligation->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_ObligationCode" class="form-group">
<input type="text" data-table="employee_obligation" data-field="x_ObligationCode" name="x<?php echo $employee_obligation_grid->RowIndex ?>_ObligationCode" id="x<?php echo $employee_obligation_grid->RowIndex ?>_ObligationCode" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($employee_obligation_grid->ObligationCode->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_grid->ObligationCode->EditValue ?>"<?php echo $employee_obligation_grid->ObligationCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_ObligationCode" name="o<?php echo $employee_obligation_grid->RowIndex ?>_ObligationCode" id="o<?php echo $employee_obligation_grid->RowIndex ?>_ObligationCode" value="<?php echo HtmlEncode($employee_obligation_grid->ObligationCode->OldValue) ?>">
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="employee_obligation" data-field="x_ObligationCode" name="x<?php echo $employee_obligation_grid->RowIndex ?>_ObligationCode" id="x<?php echo $employee_obligation_grid->RowIndex ?>_ObligationCode" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($employee_obligation_grid->ObligationCode->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_grid->ObligationCode->EditValue ?>"<?php echo $employee_obligation_grid->ObligationCode->editAttributes() ?>>
<input type="hidden" data-table="employee_obligation" data-field="x_ObligationCode" name="o<?php echo $employee_obligation_grid->RowIndex ?>_ObligationCode" id="o<?php echo $employee_obligation_grid->RowIndex ?>_ObligationCode" value="<?php echo HtmlEncode($employee_obligation_grid->ObligationCode->OldValue != null ? $employee_obligation_grid->ObligationCode->OldValue : $employee_obligation_grid->ObligationCode->CurrentValue) ?>">
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_ObligationCode">
<span<?php echo $employee_obligation_grid->ObligationCode->viewAttributes() ?>><?php echo $employee_obligation_grid->ObligationCode->getViewValue() ?></span>
</span>
<?php if (!$employee_obligation->isConfirm()) { ?>
<input type="hidden" data-table="employee_obligation" data-field="x_ObligationCode" name="x<?php echo $employee_obligation_grid->RowIndex ?>_ObligationCode" id="x<?php echo $employee_obligation_grid->RowIndex ?>_ObligationCode" value="<?php echo HtmlEncode($employee_obligation_grid->ObligationCode->FormValue) ?>">
<input type="hidden" data-table="employee_obligation" data-field="x_ObligationCode" name="o<?php echo $employee_obligation_grid->RowIndex ?>_ObligationCode" id="o<?php echo $employee_obligation_grid->RowIndex ?>_ObligationCode" value="<?php echo HtmlEncode($employee_obligation_grid->ObligationCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employee_obligation" data-field="x_ObligationCode" name="femployee_obligationgrid$x<?php echo $employee_obligation_grid->RowIndex ?>_ObligationCode" id="femployee_obligationgrid$x<?php echo $employee_obligation_grid->RowIndex ?>_ObligationCode" value="<?php echo HtmlEncode($employee_obligation_grid->ObligationCode->FormValue) ?>">
<input type="hidden" data-table="employee_obligation" data-field="x_ObligationCode" name="femployee_obligationgrid$o<?php echo $employee_obligation_grid->RowIndex ?>_ObligationCode" id="femployee_obligationgrid$o<?php echo $employee_obligation_grid->RowIndex ?>_ObligationCode" value="<?php echo HtmlEncode($employee_obligation_grid->ObligationCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_obligation_grid->ObligationAmount->Visible) { // ObligationAmount ?>
		<td data-name="ObligationAmount" <?php echo $employee_obligation_grid->ObligationAmount->cellAttributes() ?>>
<?php if ($employee_obligation->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_ObligationAmount" class="form-group">
<input type="text" data-table="employee_obligation" data-field="x_ObligationAmount" name="x<?php echo $employee_obligation_grid->RowIndex ?>_ObligationAmount" id="x<?php echo $employee_obligation_grid->RowIndex ?>_ObligationAmount" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_grid->ObligationAmount->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_grid->ObligationAmount->EditValue ?>"<?php echo $employee_obligation_grid->ObligationAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_ObligationAmount" name="o<?php echo $employee_obligation_grid->RowIndex ?>_ObligationAmount" id="o<?php echo $employee_obligation_grid->RowIndex ?>_ObligationAmount" value="<?php echo HtmlEncode($employee_obligation_grid->ObligationAmount->OldValue) ?>">
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_ObligationAmount" class="form-group">
<input type="text" data-table="employee_obligation" data-field="x_ObligationAmount" name="x<?php echo $employee_obligation_grid->RowIndex ?>_ObligationAmount" id="x<?php echo $employee_obligation_grid->RowIndex ?>_ObligationAmount" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_grid->ObligationAmount->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_grid->ObligationAmount->EditValue ?>"<?php echo $employee_obligation_grid->ObligationAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_ObligationAmount">
<span<?php echo $employee_obligation_grid->ObligationAmount->viewAttributes() ?>><?php echo $employee_obligation_grid->ObligationAmount->getViewValue() ?></span>
</span>
<?php if (!$employee_obligation->isConfirm()) { ?>
<input type="hidden" data-table="employee_obligation" data-field="x_ObligationAmount" name="x<?php echo $employee_obligation_grid->RowIndex ?>_ObligationAmount" id="x<?php echo $employee_obligation_grid->RowIndex ?>_ObligationAmount" value="<?php echo HtmlEncode($employee_obligation_grid->ObligationAmount->FormValue) ?>">
<input type="hidden" data-table="employee_obligation" data-field="x_ObligationAmount" name="o<?php echo $employee_obligation_grid->RowIndex ?>_ObligationAmount" id="o<?php echo $employee_obligation_grid->RowIndex ?>_ObligationAmount" value="<?php echo HtmlEncode($employee_obligation_grid->ObligationAmount->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employee_obligation" data-field="x_ObligationAmount" name="femployee_obligationgrid$x<?php echo $employee_obligation_grid->RowIndex ?>_ObligationAmount" id="femployee_obligationgrid$x<?php echo $employee_obligation_grid->RowIndex ?>_ObligationAmount" value="<?php echo HtmlEncode($employee_obligation_grid->ObligationAmount->FormValue) ?>">
<input type="hidden" data-table="employee_obligation" data-field="x_ObligationAmount" name="femployee_obligationgrid$o<?php echo $employee_obligation_grid->RowIndex ?>_ObligationAmount" id="femployee_obligationgrid$o<?php echo $employee_obligation_grid->RowIndex ?>_ObligationAmount" value="<?php echo HtmlEncode($employee_obligation_grid->ObligationAmount->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_obligation_grid->Remarks->Visible) { // Remarks ?>
		<td data-name="Remarks" <?php echo $employee_obligation_grid->Remarks->cellAttributes() ?>>
<?php if ($employee_obligation->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_Remarks" class="form-group">
<textarea data-table="employee_obligation" data-field="x_Remarks" name="x<?php echo $employee_obligation_grid->RowIndex ?>_Remarks" id="x<?php echo $employee_obligation_grid->RowIndex ?>_Remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employee_obligation_grid->Remarks->getPlaceHolder()) ?>"<?php echo $employee_obligation_grid->Remarks->editAttributes() ?>><?php echo $employee_obligation_grid->Remarks->EditValue ?></textarea>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_Remarks" name="o<?php echo $employee_obligation_grid->RowIndex ?>_Remarks" id="o<?php echo $employee_obligation_grid->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($employee_obligation_grid->Remarks->OldValue) ?>">
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_Remarks" class="form-group">
<textarea data-table="employee_obligation" data-field="x_Remarks" name="x<?php echo $employee_obligation_grid->RowIndex ?>_Remarks" id="x<?php echo $employee_obligation_grid->RowIndex ?>_Remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employee_obligation_grid->Remarks->getPlaceHolder()) ?>"<?php echo $employee_obligation_grid->Remarks->editAttributes() ?>><?php echo $employee_obligation_grid->Remarks->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_obligation_grid->RowCount ?>_employee_obligation_Remarks">
<span<?php echo $employee_obligation_grid->Remarks->viewAttributes() ?>><?php echo $employee_obligation_grid->Remarks->getViewValue() ?></span>
</span>
<?php if (!$employee_obligation->isConfirm()) { ?>
<input type="hidden" data-table="employee_obligation" data-field="x_Remarks" name="x<?php echo $employee_obligation_grid->RowIndex ?>_Remarks" id="x<?php echo $employee_obligation_grid->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($employee_obligation_grid->Remarks->FormValue) ?>">
<input type="hidden" data-table="employee_obligation" data-field="x_Remarks" name="o<?php echo $employee_obligation_grid->RowIndex ?>_Remarks" id="o<?php echo $employee_obligation_grid->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($employee_obligation_grid->Remarks->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employee_obligation" data-field="x_Remarks" name="femployee_obligationgrid$x<?php echo $employee_obligation_grid->RowIndex ?>_Remarks" id="femployee_obligationgrid$x<?php echo $employee_obligation_grid->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($employee_obligation_grid->Remarks->FormValue) ?>">
<input type="hidden" data-table="employee_obligation" data-field="x_Remarks" name="femployee_obligationgrid$o<?php echo $employee_obligation_grid->RowIndex ?>_Remarks" id="femployee_obligationgrid$o<?php echo $employee_obligation_grid->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($employee_obligation_grid->Remarks->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employee_obligation_grid->ListOptions->render("body", "right", $employee_obligation_grid->RowCount);
?>
	</tr>
<?php if ($employee_obligation->RowType == ROWTYPE_ADD || $employee_obligation->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["femployee_obligationgrid", "load"], function() {
	femployee_obligationgrid.updateLists(<?php echo $employee_obligation_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$employee_obligation_grid->isGridAdd() || $employee_obligation->CurrentMode == "copy")
		if (!$employee_obligation_grid->Recordset->EOF)
			$employee_obligation_grid->Recordset->moveNext();
}
?>
<?php
	if ($employee_obligation->CurrentMode == "add" || $employee_obligation->CurrentMode == "copy" || $employee_obligation->CurrentMode == "edit") {
		$employee_obligation_grid->RowIndex = '$rowindex$';
		$employee_obligation_grid->loadRowValues();

		// Set row properties
		$employee_obligation->resetAttributes();
		$employee_obligation->RowAttrs->merge(["data-rowindex" => $employee_obligation_grid->RowIndex, "id" => "r0_employee_obligation", "data-rowtype" => ROWTYPE_ADD]);
		$employee_obligation->RowAttrs->appendClass("ew-template");
		$employee_obligation->RowType = ROWTYPE_ADD;

		// Render row
		$employee_obligation_grid->renderRow();

		// Render list options
		$employee_obligation_grid->renderListOptions();
		$employee_obligation_grid->StartRowCount = 0;
?>
	<tr <?php echo $employee_obligation->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employee_obligation_grid->ListOptions->render("body", "left", $employee_obligation_grid->RowIndex);
?>
	<?php if ($employee_obligation_grid->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID">
<?php if (!$employee_obligation->isConfirm()) { ?>
<?php if ($employee_obligation_grid->EmployeeID->getSessionValue() != "") { ?>
<span id="el$rowindex$_employee_obligation_EmployeeID" class="form-group employee_obligation_EmployeeID">
<span<?php echo $employee_obligation_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_obligation_grid->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" name="x<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_obligation_grid->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_employee_obligation_EmployeeID" class="form-group employee_obligation_EmployeeID">
<input type="text" data-table="employee_obligation" data-field="x_EmployeeID" name="x<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" id="x<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_grid->EmployeeID->EditValue ?>"<?php echo $employee_obligation_grid->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_employee_obligation_EmployeeID" class="form-group employee_obligation_EmployeeID">
<span<?php echo $employee_obligation_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_obligation_grid->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_EmployeeID" name="x<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" id="x<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_obligation_grid->EmployeeID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employee_obligation" data-field="x_EmployeeID" name="o<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" id="o<?php echo $employee_obligation_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_obligation_grid->EmployeeID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_obligation_grid->PaidPosition->Visible) { // PaidPosition ?>
		<td data-name="PaidPosition">
<?php if (!$employee_obligation->isConfirm()) { ?>
<span id="el$rowindex$_employee_obligation_PaidPosition" class="form-group employee_obligation_PaidPosition">
<?php
$onchange = $employee_obligation_grid->PaidPosition->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employee_obligation_grid->PaidPosition->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition">
	<input type="text" class="form-control" name="sv_x<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" id="sv_x<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" value="<?php echo RemoveHtml($employee_obligation_grid->PaidPosition->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_grid->PaidPosition->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employee_obligation_grid->PaidPosition->getPlaceHolder()) ?>"<?php echo $employee_obligation_grid->PaidPosition->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_PaidPosition" data-value-separator="<?php echo $employee_obligation_grid->PaidPosition->displayValueSeparatorAttribute() ?>" name="x<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" id="x<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_obligation_grid->PaidPosition->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployee_obligationgrid"], function() {
	femployee_obligationgrid.createAutoSuggest({"id":"x<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition","forceSelect":false});
});
</script>
<?php echo $employee_obligation_grid->PaidPosition->Lookup->getParamTag($employee_obligation_grid, "p_x" . $employee_obligation_grid->RowIndex . "_PaidPosition") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_employee_obligation_PaidPosition" class="form-group employee_obligation_PaidPosition">
<span<?php echo $employee_obligation_grid->PaidPosition->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_obligation_grid->PaidPosition->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_PaidPosition" name="x<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" id="x<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_obligation_grid->PaidPosition->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employee_obligation" data-field="x_PaidPosition" name="o<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" id="o<?php echo $employee_obligation_grid->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_obligation_grid->PaidPosition->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_obligation_grid->PayrollDate->Visible) { // PayrollDate ?>
		<td data-name="PayrollDate">
<?php if (!$employee_obligation->isConfirm()) { ?>
<span id="el$rowindex$_employee_obligation_PayrollDate" class="form-group employee_obligation_PayrollDate">
<input type="text" data-table="employee_obligation" data-field="x_PayrollDate" name="x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollDate" id="x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollDate" placeholder="<?php echo HtmlEncode($employee_obligation_grid->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_grid->PayrollDate->EditValue ?>"<?php echo $employee_obligation_grid->PayrollDate->editAttributes() ?>>
<?php if (!$employee_obligation_grid->PayrollDate->ReadOnly && !$employee_obligation_grid->PayrollDate->Disabled && !isset($employee_obligation_grid->PayrollDate->EditAttrs["readonly"]) && !isset($employee_obligation_grid->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationgrid", "x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_employee_obligation_PayrollDate" class="form-group employee_obligation_PayrollDate">
<span<?php echo $employee_obligation_grid->PayrollDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_obligation_grid->PayrollDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_PayrollDate" name="x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollDate" id="x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($employee_obligation_grid->PayrollDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employee_obligation" data-field="x_PayrollDate" name="o<?php echo $employee_obligation_grid->RowIndex ?>_PayrollDate" id="o<?php echo $employee_obligation_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($employee_obligation_grid->PayrollDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_obligation_grid->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod">
<?php if (!$employee_obligation->isConfirm()) { ?>
<span id="el$rowindex$_employee_obligation_PayrollPeriod" class="form-group employee_obligation_PayrollPeriod">
<input type="text" data-table="employee_obligation" data-field="x_PayrollPeriod" name="x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollPeriod" id="x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollPeriod" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_grid->PayrollPeriod->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_grid->PayrollPeriod->EditValue ?>"<?php echo $employee_obligation_grid->PayrollPeriod->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_employee_obligation_PayrollPeriod" class="form-group employee_obligation_PayrollPeriod">
<span<?php echo $employee_obligation_grid->PayrollPeriod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_obligation_grid->PayrollPeriod->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_PayrollPeriod" name="x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollPeriod" id="x<?php echo $employee_obligation_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($employee_obligation_grid->PayrollPeriod->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employee_obligation" data-field="x_PayrollPeriod" name="o<?php echo $employee_obligation_grid->RowIndex ?>_PayrollPeriod" id="o<?php echo $employee_obligation_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($employee_obligation_grid->PayrollPeriod->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_obligation_grid->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate">
<?php if (!$employee_obligation->isConfirm()) { ?>
<span id="el$rowindex$_employee_obligation_StartDate" class="form-group employee_obligation_StartDate">
<input type="text" data-table="employee_obligation" data-field="x_StartDate" name="x<?php echo $employee_obligation_grid->RowIndex ?>_StartDate" id="x<?php echo $employee_obligation_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($employee_obligation_grid->StartDate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_grid->StartDate->EditValue ?>"<?php echo $employee_obligation_grid->StartDate->editAttributes() ?>>
<?php if (!$employee_obligation_grid->StartDate->ReadOnly && !$employee_obligation_grid->StartDate->Disabled && !isset($employee_obligation_grid->StartDate->EditAttrs["readonly"]) && !isset($employee_obligation_grid->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationgrid", "x<?php echo $employee_obligation_grid->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_employee_obligation_StartDate" class="form-group employee_obligation_StartDate">
<span<?php echo $employee_obligation_grid->StartDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_obligation_grid->StartDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_StartDate" name="x<?php echo $employee_obligation_grid->RowIndex ?>_StartDate" id="x<?php echo $employee_obligation_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($employee_obligation_grid->StartDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employee_obligation" data-field="x_StartDate" name="o<?php echo $employee_obligation_grid->RowIndex ?>_StartDate" id="o<?php echo $employee_obligation_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($employee_obligation_grid->StartDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_obligation_grid->Enddate->Visible) { // Enddate ?>
		<td data-name="Enddate">
<?php if (!$employee_obligation->isConfirm()) { ?>
<span id="el$rowindex$_employee_obligation_Enddate" class="form-group employee_obligation_Enddate">
<input type="text" data-table="employee_obligation" data-field="x_Enddate" name="x<?php echo $employee_obligation_grid->RowIndex ?>_Enddate" id="x<?php echo $employee_obligation_grid->RowIndex ?>_Enddate" placeholder="<?php echo HtmlEncode($employee_obligation_grid->Enddate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_grid->Enddate->EditValue ?>"<?php echo $employee_obligation_grid->Enddate->editAttributes() ?>>
<?php if (!$employee_obligation_grid->Enddate->ReadOnly && !$employee_obligation_grid->Enddate->Disabled && !isset($employee_obligation_grid->Enddate->EditAttrs["readonly"]) && !isset($employee_obligation_grid->Enddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationgrid", "x<?php echo $employee_obligation_grid->RowIndex ?>_Enddate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_employee_obligation_Enddate" class="form-group employee_obligation_Enddate">
<span<?php echo $employee_obligation_grid->Enddate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_obligation_grid->Enddate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_Enddate" name="x<?php echo $employee_obligation_grid->RowIndex ?>_Enddate" id="x<?php echo $employee_obligation_grid->RowIndex ?>_Enddate" value="<?php echo HtmlEncode($employee_obligation_grid->Enddate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employee_obligation" data-field="x_Enddate" name="o<?php echo $employee_obligation_grid->RowIndex ?>_Enddate" id="o<?php echo $employee_obligation_grid->RowIndex ?>_Enddate" value="<?php echo HtmlEncode($employee_obligation_grid->Enddate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_obligation_grid->ObligationCode->Visible) { // ObligationCode ?>
		<td data-name="ObligationCode">
<?php if (!$employee_obligation->isConfirm()) { ?>
<span id="el$rowindex$_employee_obligation_ObligationCode" class="form-group employee_obligation_ObligationCode">
<input type="text" data-table="employee_obligation" data-field="x_ObligationCode" name="x<?php echo $employee_obligation_grid->RowIndex ?>_ObligationCode" id="x<?php echo $employee_obligation_grid->RowIndex ?>_ObligationCode" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($employee_obligation_grid->ObligationCode->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_grid->ObligationCode->EditValue ?>"<?php echo $employee_obligation_grid->ObligationCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_employee_obligation_ObligationCode" class="form-group employee_obligation_ObligationCode">
<span<?php echo $employee_obligation_grid->ObligationCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_obligation_grid->ObligationCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_ObligationCode" name="x<?php echo $employee_obligation_grid->RowIndex ?>_ObligationCode" id="x<?php echo $employee_obligation_grid->RowIndex ?>_ObligationCode" value="<?php echo HtmlEncode($employee_obligation_grid->ObligationCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employee_obligation" data-field="x_ObligationCode" name="o<?php echo $employee_obligation_grid->RowIndex ?>_ObligationCode" id="o<?php echo $employee_obligation_grid->RowIndex ?>_ObligationCode" value="<?php echo HtmlEncode($employee_obligation_grid->ObligationCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_obligation_grid->ObligationAmount->Visible) { // ObligationAmount ?>
		<td data-name="ObligationAmount">
<?php if (!$employee_obligation->isConfirm()) { ?>
<span id="el$rowindex$_employee_obligation_ObligationAmount" class="form-group employee_obligation_ObligationAmount">
<input type="text" data-table="employee_obligation" data-field="x_ObligationAmount" name="x<?php echo $employee_obligation_grid->RowIndex ?>_ObligationAmount" id="x<?php echo $employee_obligation_grid->RowIndex ?>_ObligationAmount" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_grid->ObligationAmount->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_grid->ObligationAmount->EditValue ?>"<?php echo $employee_obligation_grid->ObligationAmount->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_employee_obligation_ObligationAmount" class="form-group employee_obligation_ObligationAmount">
<span<?php echo $employee_obligation_grid->ObligationAmount->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_obligation_grid->ObligationAmount->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_ObligationAmount" name="x<?php echo $employee_obligation_grid->RowIndex ?>_ObligationAmount" id="x<?php echo $employee_obligation_grid->RowIndex ?>_ObligationAmount" value="<?php echo HtmlEncode($employee_obligation_grid->ObligationAmount->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employee_obligation" data-field="x_ObligationAmount" name="o<?php echo $employee_obligation_grid->RowIndex ?>_ObligationAmount" id="o<?php echo $employee_obligation_grid->RowIndex ?>_ObligationAmount" value="<?php echo HtmlEncode($employee_obligation_grid->ObligationAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_obligation_grid->Remarks->Visible) { // Remarks ?>
		<td data-name="Remarks">
<?php if (!$employee_obligation->isConfirm()) { ?>
<span id="el$rowindex$_employee_obligation_Remarks" class="form-group employee_obligation_Remarks">
<textarea data-table="employee_obligation" data-field="x_Remarks" name="x<?php echo $employee_obligation_grid->RowIndex ?>_Remarks" id="x<?php echo $employee_obligation_grid->RowIndex ?>_Remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employee_obligation_grid->Remarks->getPlaceHolder()) ?>"<?php echo $employee_obligation_grid->Remarks->editAttributes() ?>><?php echo $employee_obligation_grid->Remarks->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_employee_obligation_Remarks" class="form-group employee_obligation_Remarks">
<span<?php echo $employee_obligation_grid->Remarks->viewAttributes() ?>><?php echo $employee_obligation_grid->Remarks->ViewValue ?></span>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_Remarks" name="x<?php echo $employee_obligation_grid->RowIndex ?>_Remarks" id="x<?php echo $employee_obligation_grid->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($employee_obligation_grid->Remarks->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employee_obligation" data-field="x_Remarks" name="o<?php echo $employee_obligation_grid->RowIndex ?>_Remarks" id="o<?php echo $employee_obligation_grid->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($employee_obligation_grid->Remarks->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employee_obligation_grid->ListOptions->render("body", "right", $employee_obligation_grid->RowIndex);
?>
<script>
loadjs.ready(["femployee_obligationgrid", "load"], function() {
	femployee_obligationgrid.updateLists(<?php echo $employee_obligation_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($employee_obligation->CurrentMode == "add" || $employee_obligation->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $employee_obligation_grid->FormKeyCountName ?>" id="<?php echo $employee_obligation_grid->FormKeyCountName ?>" value="<?php echo $employee_obligation_grid->KeyCount ?>">
<?php echo $employee_obligation_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($employee_obligation->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $employee_obligation_grid->FormKeyCountName ?>" id="<?php echo $employee_obligation_grid->FormKeyCountName ?>" value="<?php echo $employee_obligation_grid->KeyCount ?>">
<?php echo $employee_obligation_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($employee_obligation->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="femployee_obligationgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($employee_obligation_grid->Recordset)
	$employee_obligation_grid->Recordset->Close();
?>
<?php if ($employee_obligation_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $employee_obligation_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($employee_obligation_grid->TotalRecords == 0 && !$employee_obligation->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $employee_obligation_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$employee_obligation_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$employee_obligation_grid->terminate();
?>