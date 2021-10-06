<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($salary_notch_grid))
	$salary_notch_grid = new salary_notch_grid();

// Run the page
$salary_notch_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$salary_notch_grid->Page_Render();
?>
<?php if (!$salary_notch_grid->isExport()) { ?>
<script>
var fsalary_notchgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fsalary_notchgrid = new ew.Form("fsalary_notchgrid", "grid");
	fsalary_notchgrid.formKeyCountName = '<?php echo $salary_notch_grid->FormKeyCountName ?>';

	// Validate form
	fsalary_notchgrid.validate = function() {
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
			<?php if ($salary_notch_grid->SalaryScale->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryScale");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $salary_notch_grid->SalaryScale->caption(), $salary_notch_grid->SalaryScale->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($salary_notch_grid->Notch->Required) { ?>
				elm = this.getElements("x" + infix + "_Notch");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $salary_notch_grid->Notch->caption(), $salary_notch_grid->Notch->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Notch");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($salary_notch_grid->Notch->errorMessage()) ?>");
			<?php if ($salary_notch_grid->BasicMonthlySalary->Required) { ?>
				elm = this.getElements("x" + infix + "_BasicMonthlySalary");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $salary_notch_grid->BasicMonthlySalary->caption(), $salary_notch_grid->BasicMonthlySalary->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BasicMonthlySalary");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($salary_notch_grid->BasicMonthlySalary->errorMessage()) ?>");
			<?php if ($salary_notch_grid->AnnualSalary->Required) { ?>
				elm = this.getElements("x" + infix + "_AnnualSalary");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $salary_notch_grid->AnnualSalary->caption(), $salary_notch_grid->AnnualSalary->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AnnualSalary");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($salary_notch_grid->AnnualSalary->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fsalary_notchgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "SalaryScale", false)) return false;
		if (ew.valueChanged(fobj, infix, "Notch", false)) return false;
		if (ew.valueChanged(fobj, infix, "BasicMonthlySalary", false)) return false;
		if (ew.valueChanged(fobj, infix, "AnnualSalary", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fsalary_notchgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsalary_notchgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fsalary_notchgrid");
});
</script>
<?php } ?>
<?php
$salary_notch_grid->renderOtherOptions();
?>
<?php if ($salary_notch_grid->TotalRecords > 0 || $salary_notch->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($salary_notch_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> salary_notch">
<?php if ($salary_notch_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $salary_notch_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fsalary_notchgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_salary_notch" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_salary_notchgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$salary_notch->RowType = ROWTYPE_HEADER;

// Render list options
$salary_notch_grid->renderListOptions();

// Render list options (header, left)
$salary_notch_grid->ListOptions->render("header", "left");
?>
<?php if ($salary_notch_grid->SalaryScale->Visible) { // SalaryScale ?>
	<?php if ($salary_notch_grid->SortUrl($salary_notch_grid->SalaryScale) == "") { ?>
		<th data-name="SalaryScale" class="<?php echo $salary_notch_grid->SalaryScale->headerCellClass() ?>"><div id="elh_salary_notch_SalaryScale" class="salary_notch_SalaryScale"><div class="ew-table-header-caption"><?php echo $salary_notch_grid->SalaryScale->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SalaryScale" class="<?php echo $salary_notch_grid->SalaryScale->headerCellClass() ?>"><div><div id="elh_salary_notch_SalaryScale" class="salary_notch_SalaryScale">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $salary_notch_grid->SalaryScale->caption() ?></span><span class="ew-table-header-sort"><?php if ($salary_notch_grid->SalaryScale->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($salary_notch_grid->SalaryScale->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($salary_notch_grid->Notch->Visible) { // Notch ?>
	<?php if ($salary_notch_grid->SortUrl($salary_notch_grid->Notch) == "") { ?>
		<th data-name="Notch" class="<?php echo $salary_notch_grid->Notch->headerCellClass() ?>"><div id="elh_salary_notch_Notch" class="salary_notch_Notch"><div class="ew-table-header-caption"><?php echo $salary_notch_grid->Notch->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Notch" class="<?php echo $salary_notch_grid->Notch->headerCellClass() ?>"><div><div id="elh_salary_notch_Notch" class="salary_notch_Notch">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $salary_notch_grid->Notch->caption() ?></span><span class="ew-table-header-sort"><?php if ($salary_notch_grid->Notch->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($salary_notch_grid->Notch->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($salary_notch_grid->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
	<?php if ($salary_notch_grid->SortUrl($salary_notch_grid->BasicMonthlySalary) == "") { ?>
		<th data-name="BasicMonthlySalary" class="<?php echo $salary_notch_grid->BasicMonthlySalary->headerCellClass() ?>"><div id="elh_salary_notch_BasicMonthlySalary" class="salary_notch_BasicMonthlySalary"><div class="ew-table-header-caption"><?php echo $salary_notch_grid->BasicMonthlySalary->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BasicMonthlySalary" class="<?php echo $salary_notch_grid->BasicMonthlySalary->headerCellClass() ?>"><div><div id="elh_salary_notch_BasicMonthlySalary" class="salary_notch_BasicMonthlySalary">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $salary_notch_grid->BasicMonthlySalary->caption() ?></span><span class="ew-table-header-sort"><?php if ($salary_notch_grid->BasicMonthlySalary->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($salary_notch_grid->BasicMonthlySalary->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($salary_notch_grid->AnnualSalary->Visible) { // AnnualSalary ?>
	<?php if ($salary_notch_grid->SortUrl($salary_notch_grid->AnnualSalary) == "") { ?>
		<th data-name="AnnualSalary" class="<?php echo $salary_notch_grid->AnnualSalary->headerCellClass() ?>"><div id="elh_salary_notch_AnnualSalary" class="salary_notch_AnnualSalary"><div class="ew-table-header-caption"><?php echo $salary_notch_grid->AnnualSalary->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AnnualSalary" class="<?php echo $salary_notch_grid->AnnualSalary->headerCellClass() ?>"><div><div id="elh_salary_notch_AnnualSalary" class="salary_notch_AnnualSalary">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $salary_notch_grid->AnnualSalary->caption() ?></span><span class="ew-table-header-sort"><?php if ($salary_notch_grid->AnnualSalary->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($salary_notch_grid->AnnualSalary->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$salary_notch_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$salary_notch_grid->StartRecord = 1;
$salary_notch_grid->StopRecord = $salary_notch_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($salary_notch->isConfirm() || $salary_notch_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($salary_notch_grid->FormKeyCountName) && ($salary_notch_grid->isGridAdd() || $salary_notch_grid->isGridEdit() || $salary_notch->isConfirm())) {
		$salary_notch_grid->KeyCount = $CurrentForm->getValue($salary_notch_grid->FormKeyCountName);
		$salary_notch_grid->StopRecord = $salary_notch_grid->StartRecord + $salary_notch_grid->KeyCount - 1;
	}
}
$salary_notch_grid->RecordCount = $salary_notch_grid->StartRecord - 1;
if ($salary_notch_grid->Recordset && !$salary_notch_grid->Recordset->EOF) {
	$salary_notch_grid->Recordset->moveFirst();
	$selectLimit = $salary_notch_grid->UseSelectLimit;
	if (!$selectLimit && $salary_notch_grid->StartRecord > 1)
		$salary_notch_grid->Recordset->move($salary_notch_grid->StartRecord - 1);
} elseif (!$salary_notch->AllowAddDeleteRow && $salary_notch_grid->StopRecord == 0) {
	$salary_notch_grid->StopRecord = $salary_notch->GridAddRowCount;
}

// Initialize aggregate
$salary_notch->RowType = ROWTYPE_AGGREGATEINIT;
$salary_notch->resetAttributes();
$salary_notch_grid->renderRow();
if ($salary_notch_grid->isGridAdd())
	$salary_notch_grid->RowIndex = 0;
if ($salary_notch_grid->isGridEdit())
	$salary_notch_grid->RowIndex = 0;
while ($salary_notch_grid->RecordCount < $salary_notch_grid->StopRecord) {
	$salary_notch_grid->RecordCount++;
	if ($salary_notch_grid->RecordCount >= $salary_notch_grid->StartRecord) {
		$salary_notch_grid->RowCount++;
		if ($salary_notch_grid->isGridAdd() || $salary_notch_grid->isGridEdit() || $salary_notch->isConfirm()) {
			$salary_notch_grid->RowIndex++;
			$CurrentForm->Index = $salary_notch_grid->RowIndex;
			if ($CurrentForm->hasValue($salary_notch_grid->FormActionName) && ($salary_notch->isConfirm() || $salary_notch_grid->EventCancelled))
				$salary_notch_grid->RowAction = strval($CurrentForm->getValue($salary_notch_grid->FormActionName));
			elseif ($salary_notch_grid->isGridAdd())
				$salary_notch_grid->RowAction = "insert";
			else
				$salary_notch_grid->RowAction = "";
		}

		// Set up key count
		$salary_notch_grid->KeyCount = $salary_notch_grid->RowIndex;

		// Init row class and style
		$salary_notch->resetAttributes();
		$salary_notch->CssClass = "";
		if ($salary_notch_grid->isGridAdd()) {
			if ($salary_notch->CurrentMode == "copy") {
				$salary_notch_grid->loadRowValues($salary_notch_grid->Recordset); // Load row values
				$salary_notch_grid->setRecordKey($salary_notch_grid->RowOldKey, $salary_notch_grid->Recordset); // Set old record key
			} else {
				$salary_notch_grid->loadRowValues(); // Load default values
				$salary_notch_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$salary_notch_grid->loadRowValues($salary_notch_grid->Recordset); // Load row values
		}
		$salary_notch->RowType = ROWTYPE_VIEW; // Render view
		if ($salary_notch_grid->isGridAdd()) // Grid add
			$salary_notch->RowType = ROWTYPE_ADD; // Render add
		if ($salary_notch_grid->isGridAdd() && $salary_notch->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$salary_notch_grid->restoreCurrentRowFormValues($salary_notch_grid->RowIndex); // Restore form values
		if ($salary_notch_grid->isGridEdit()) { // Grid edit
			if ($salary_notch->EventCancelled)
				$salary_notch_grid->restoreCurrentRowFormValues($salary_notch_grid->RowIndex); // Restore form values
			if ($salary_notch_grid->RowAction == "insert")
				$salary_notch->RowType = ROWTYPE_ADD; // Render add
			else
				$salary_notch->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($salary_notch_grid->isGridEdit() && ($salary_notch->RowType == ROWTYPE_EDIT || $salary_notch->RowType == ROWTYPE_ADD) && $salary_notch->EventCancelled) // Update failed
			$salary_notch_grid->restoreCurrentRowFormValues($salary_notch_grid->RowIndex); // Restore form values
		if ($salary_notch->RowType == ROWTYPE_EDIT) // Edit row
			$salary_notch_grid->EditRowCount++;
		if ($salary_notch->isConfirm()) // Confirm row
			$salary_notch_grid->restoreCurrentRowFormValues($salary_notch_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$salary_notch->RowAttrs->merge(["data-rowindex" => $salary_notch_grid->RowCount, "id" => "r" . $salary_notch_grid->RowCount . "_salary_notch", "data-rowtype" => $salary_notch->RowType]);

		// Render row
		$salary_notch_grid->renderRow();

		// Render list options
		$salary_notch_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($salary_notch_grid->RowAction != "delete" && $salary_notch_grid->RowAction != "insertdelete" && !($salary_notch_grid->RowAction == "insert" && $salary_notch->isConfirm() && $salary_notch_grid->emptyRow())) {
?>
	<tr <?php echo $salary_notch->rowAttributes() ?>>
<?php

// Render list options (body, left)
$salary_notch_grid->ListOptions->render("body", "left", $salary_notch_grid->RowCount);
?>
	<?php if ($salary_notch_grid->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale" <?php echo $salary_notch_grid->SalaryScale->cellAttributes() ?>>
<?php if ($salary_notch->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($salary_notch_grid->SalaryScale->getSessionValue() != "") { ?>
<span id="el<?php echo $salary_notch_grid->RowCount ?>_salary_notch_SalaryScale" class="form-group">
<span<?php echo $salary_notch_grid->SalaryScale->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($salary_notch_grid->SalaryScale->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" name="x<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_notch_grid->SalaryScale->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $salary_notch_grid->RowCount ?>_salary_notch_SalaryScale" class="form-group">
<input type="text" data-table="salary_notch" data-field="x_SalaryScale" name="x<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" id="x<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($salary_notch_grid->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $salary_notch_grid->SalaryScale->EditValue ?>"<?php echo $salary_notch_grid->SalaryScale->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="salary_notch" data-field="x_SalaryScale" name="o<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" id="o<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_notch_grid->SalaryScale->OldValue) ?>">
<?php } ?>
<?php if ($salary_notch->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($salary_notch_grid->SalaryScale->getSessionValue() != "") { ?>

<span id="el<?php echo $salary_notch_grid->RowCount ?>_salary_notch_SalaryScale" class="form-group">
<span<?php echo $salary_notch_grid->SalaryScale->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($salary_notch_grid->SalaryScale->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" name="x<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_notch_grid->SalaryScale->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="salary_notch" data-field="x_SalaryScale" name="x<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" id="x<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($salary_notch_grid->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $salary_notch_grid->SalaryScale->EditValue ?>"<?php echo $salary_notch_grid->SalaryScale->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="salary_notch" data-field="x_SalaryScale" name="o<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" id="o<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_notch_grid->SalaryScale->OldValue != null ? $salary_notch_grid->SalaryScale->OldValue : $salary_notch_grid->SalaryScale->CurrentValue) ?>">
<?php } ?>
<?php if ($salary_notch->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $salary_notch_grid->RowCount ?>_salary_notch_SalaryScale">
<span<?php echo $salary_notch_grid->SalaryScale->viewAttributes() ?>><?php echo $salary_notch_grid->SalaryScale->getViewValue() ?></span>
</span>
<?php if (!$salary_notch->isConfirm()) { ?>
<input type="hidden" data-table="salary_notch" data-field="x_SalaryScale" name="x<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" id="x<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_notch_grid->SalaryScale->FormValue) ?>">
<input type="hidden" data-table="salary_notch" data-field="x_SalaryScale" name="o<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" id="o<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_notch_grid->SalaryScale->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="salary_notch" data-field="x_SalaryScale" name="fsalary_notchgrid$x<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" id="fsalary_notchgrid$x<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_notch_grid->SalaryScale->FormValue) ?>">
<input type="hidden" data-table="salary_notch" data-field="x_SalaryScale" name="fsalary_notchgrid$o<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" id="fsalary_notchgrid$o<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_notch_grid->SalaryScale->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($salary_notch_grid->Notch->Visible) { // Notch ?>
		<td data-name="Notch" <?php echo $salary_notch_grid->Notch->cellAttributes() ?>>
<?php if ($salary_notch->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $salary_notch_grid->RowCount ?>_salary_notch_Notch" class="form-group">
<input type="text" data-table="salary_notch" data-field="x_Notch" name="x<?php echo $salary_notch_grid->RowIndex ?>_Notch" id="x<?php echo $salary_notch_grid->RowIndex ?>_Notch" size="30" placeholder="<?php echo HtmlEncode($salary_notch_grid->Notch->getPlaceHolder()) ?>" value="<?php echo $salary_notch_grid->Notch->EditValue ?>"<?php echo $salary_notch_grid->Notch->editAttributes() ?>>
</span>
<input type="hidden" data-table="salary_notch" data-field="x_Notch" name="o<?php echo $salary_notch_grid->RowIndex ?>_Notch" id="o<?php echo $salary_notch_grid->RowIndex ?>_Notch" value="<?php echo HtmlEncode($salary_notch_grid->Notch->OldValue) ?>">
<?php } ?>
<?php if ($salary_notch->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="salary_notch" data-field="x_Notch" name="x<?php echo $salary_notch_grid->RowIndex ?>_Notch" id="x<?php echo $salary_notch_grid->RowIndex ?>_Notch" size="30" placeholder="<?php echo HtmlEncode($salary_notch_grid->Notch->getPlaceHolder()) ?>" value="<?php echo $salary_notch_grid->Notch->EditValue ?>"<?php echo $salary_notch_grid->Notch->editAttributes() ?>>
<input type="hidden" data-table="salary_notch" data-field="x_Notch" name="o<?php echo $salary_notch_grid->RowIndex ?>_Notch" id="o<?php echo $salary_notch_grid->RowIndex ?>_Notch" value="<?php echo HtmlEncode($salary_notch_grid->Notch->OldValue != null ? $salary_notch_grid->Notch->OldValue : $salary_notch_grid->Notch->CurrentValue) ?>">
<?php } ?>
<?php if ($salary_notch->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $salary_notch_grid->RowCount ?>_salary_notch_Notch">
<span<?php echo $salary_notch_grid->Notch->viewAttributes() ?>><?php echo $salary_notch_grid->Notch->getViewValue() ?></span>
</span>
<?php if (!$salary_notch->isConfirm()) { ?>
<input type="hidden" data-table="salary_notch" data-field="x_Notch" name="x<?php echo $salary_notch_grid->RowIndex ?>_Notch" id="x<?php echo $salary_notch_grid->RowIndex ?>_Notch" value="<?php echo HtmlEncode($salary_notch_grid->Notch->FormValue) ?>">
<input type="hidden" data-table="salary_notch" data-field="x_Notch" name="o<?php echo $salary_notch_grid->RowIndex ?>_Notch" id="o<?php echo $salary_notch_grid->RowIndex ?>_Notch" value="<?php echo HtmlEncode($salary_notch_grid->Notch->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="salary_notch" data-field="x_Notch" name="fsalary_notchgrid$x<?php echo $salary_notch_grid->RowIndex ?>_Notch" id="fsalary_notchgrid$x<?php echo $salary_notch_grid->RowIndex ?>_Notch" value="<?php echo HtmlEncode($salary_notch_grid->Notch->FormValue) ?>">
<input type="hidden" data-table="salary_notch" data-field="x_Notch" name="fsalary_notchgrid$o<?php echo $salary_notch_grid->RowIndex ?>_Notch" id="fsalary_notchgrid$o<?php echo $salary_notch_grid->RowIndex ?>_Notch" value="<?php echo HtmlEncode($salary_notch_grid->Notch->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($salary_notch_grid->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
		<td data-name="BasicMonthlySalary" <?php echo $salary_notch_grid->BasicMonthlySalary->cellAttributes() ?>>
<?php if ($salary_notch->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $salary_notch_grid->RowCount ?>_salary_notch_BasicMonthlySalary" class="form-group">
<input type="text" data-table="salary_notch" data-field="x_BasicMonthlySalary" name="x<?php echo $salary_notch_grid->RowIndex ?>_BasicMonthlySalary" id="x<?php echo $salary_notch_grid->RowIndex ?>_BasicMonthlySalary" size="30" placeholder="<?php echo HtmlEncode($salary_notch_grid->BasicMonthlySalary->getPlaceHolder()) ?>" value="<?php echo $salary_notch_grid->BasicMonthlySalary->EditValue ?>"<?php echo $salary_notch_grid->BasicMonthlySalary->editAttributes() ?>>
</span>
<input type="hidden" data-table="salary_notch" data-field="x_BasicMonthlySalary" name="o<?php echo $salary_notch_grid->RowIndex ?>_BasicMonthlySalary" id="o<?php echo $salary_notch_grid->RowIndex ?>_BasicMonthlySalary" value="<?php echo HtmlEncode($salary_notch_grid->BasicMonthlySalary->OldValue) ?>">
<?php } ?>
<?php if ($salary_notch->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $salary_notch_grid->RowCount ?>_salary_notch_BasicMonthlySalary" class="form-group">
<input type="text" data-table="salary_notch" data-field="x_BasicMonthlySalary" name="x<?php echo $salary_notch_grid->RowIndex ?>_BasicMonthlySalary" id="x<?php echo $salary_notch_grid->RowIndex ?>_BasicMonthlySalary" size="30" placeholder="<?php echo HtmlEncode($salary_notch_grid->BasicMonthlySalary->getPlaceHolder()) ?>" value="<?php echo $salary_notch_grid->BasicMonthlySalary->EditValue ?>"<?php echo $salary_notch_grid->BasicMonthlySalary->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($salary_notch->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $salary_notch_grid->RowCount ?>_salary_notch_BasicMonthlySalary">
<span<?php echo $salary_notch_grid->BasicMonthlySalary->viewAttributes() ?>><?php echo $salary_notch_grid->BasicMonthlySalary->getViewValue() ?></span>
</span>
<?php if (!$salary_notch->isConfirm()) { ?>
<input type="hidden" data-table="salary_notch" data-field="x_BasicMonthlySalary" name="x<?php echo $salary_notch_grid->RowIndex ?>_BasicMonthlySalary" id="x<?php echo $salary_notch_grid->RowIndex ?>_BasicMonthlySalary" value="<?php echo HtmlEncode($salary_notch_grid->BasicMonthlySalary->FormValue) ?>">
<input type="hidden" data-table="salary_notch" data-field="x_BasicMonthlySalary" name="o<?php echo $salary_notch_grid->RowIndex ?>_BasicMonthlySalary" id="o<?php echo $salary_notch_grid->RowIndex ?>_BasicMonthlySalary" value="<?php echo HtmlEncode($salary_notch_grid->BasicMonthlySalary->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="salary_notch" data-field="x_BasicMonthlySalary" name="fsalary_notchgrid$x<?php echo $salary_notch_grid->RowIndex ?>_BasicMonthlySalary" id="fsalary_notchgrid$x<?php echo $salary_notch_grid->RowIndex ?>_BasicMonthlySalary" value="<?php echo HtmlEncode($salary_notch_grid->BasicMonthlySalary->FormValue) ?>">
<input type="hidden" data-table="salary_notch" data-field="x_BasicMonthlySalary" name="fsalary_notchgrid$o<?php echo $salary_notch_grid->RowIndex ?>_BasicMonthlySalary" id="fsalary_notchgrid$o<?php echo $salary_notch_grid->RowIndex ?>_BasicMonthlySalary" value="<?php echo HtmlEncode($salary_notch_grid->BasicMonthlySalary->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($salary_notch_grid->AnnualSalary->Visible) { // AnnualSalary ?>
		<td data-name="AnnualSalary" <?php echo $salary_notch_grid->AnnualSalary->cellAttributes() ?>>
<?php if ($salary_notch->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $salary_notch_grid->RowCount ?>_salary_notch_AnnualSalary" class="form-group">
<input type="text" data-table="salary_notch" data-field="x_AnnualSalary" name="x<?php echo $salary_notch_grid->RowIndex ?>_AnnualSalary" id="x<?php echo $salary_notch_grid->RowIndex ?>_AnnualSalary" size="30" placeholder="<?php echo HtmlEncode($salary_notch_grid->AnnualSalary->getPlaceHolder()) ?>" value="<?php echo $salary_notch_grid->AnnualSalary->EditValue ?>"<?php echo $salary_notch_grid->AnnualSalary->editAttributes() ?>>
</span>
<input type="hidden" data-table="salary_notch" data-field="x_AnnualSalary" name="o<?php echo $salary_notch_grid->RowIndex ?>_AnnualSalary" id="o<?php echo $salary_notch_grid->RowIndex ?>_AnnualSalary" value="<?php echo HtmlEncode($salary_notch_grid->AnnualSalary->OldValue) ?>">
<?php } ?>
<?php if ($salary_notch->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $salary_notch_grid->RowCount ?>_salary_notch_AnnualSalary" class="form-group">
<input type="text" data-table="salary_notch" data-field="x_AnnualSalary" name="x<?php echo $salary_notch_grid->RowIndex ?>_AnnualSalary" id="x<?php echo $salary_notch_grid->RowIndex ?>_AnnualSalary" size="30" placeholder="<?php echo HtmlEncode($salary_notch_grid->AnnualSalary->getPlaceHolder()) ?>" value="<?php echo $salary_notch_grid->AnnualSalary->EditValue ?>"<?php echo $salary_notch_grid->AnnualSalary->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($salary_notch->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $salary_notch_grid->RowCount ?>_salary_notch_AnnualSalary">
<span<?php echo $salary_notch_grid->AnnualSalary->viewAttributes() ?>><?php echo $salary_notch_grid->AnnualSalary->getViewValue() ?></span>
</span>
<?php if (!$salary_notch->isConfirm()) { ?>
<input type="hidden" data-table="salary_notch" data-field="x_AnnualSalary" name="x<?php echo $salary_notch_grid->RowIndex ?>_AnnualSalary" id="x<?php echo $salary_notch_grid->RowIndex ?>_AnnualSalary" value="<?php echo HtmlEncode($salary_notch_grid->AnnualSalary->FormValue) ?>">
<input type="hidden" data-table="salary_notch" data-field="x_AnnualSalary" name="o<?php echo $salary_notch_grid->RowIndex ?>_AnnualSalary" id="o<?php echo $salary_notch_grid->RowIndex ?>_AnnualSalary" value="<?php echo HtmlEncode($salary_notch_grid->AnnualSalary->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="salary_notch" data-field="x_AnnualSalary" name="fsalary_notchgrid$x<?php echo $salary_notch_grid->RowIndex ?>_AnnualSalary" id="fsalary_notchgrid$x<?php echo $salary_notch_grid->RowIndex ?>_AnnualSalary" value="<?php echo HtmlEncode($salary_notch_grid->AnnualSalary->FormValue) ?>">
<input type="hidden" data-table="salary_notch" data-field="x_AnnualSalary" name="fsalary_notchgrid$o<?php echo $salary_notch_grid->RowIndex ?>_AnnualSalary" id="fsalary_notchgrid$o<?php echo $salary_notch_grid->RowIndex ?>_AnnualSalary" value="<?php echo HtmlEncode($salary_notch_grid->AnnualSalary->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$salary_notch_grid->ListOptions->render("body", "right", $salary_notch_grid->RowCount);
?>
	</tr>
<?php if ($salary_notch->RowType == ROWTYPE_ADD || $salary_notch->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fsalary_notchgrid", "load"], function() {
	fsalary_notchgrid.updateLists(<?php echo $salary_notch_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$salary_notch_grid->isGridAdd() || $salary_notch->CurrentMode == "copy")
		if (!$salary_notch_grid->Recordset->EOF)
			$salary_notch_grid->Recordset->moveNext();
}
?>
<?php
	if ($salary_notch->CurrentMode == "add" || $salary_notch->CurrentMode == "copy" || $salary_notch->CurrentMode == "edit") {
		$salary_notch_grid->RowIndex = '$rowindex$';
		$salary_notch_grid->loadRowValues();

		// Set row properties
		$salary_notch->resetAttributes();
		$salary_notch->RowAttrs->merge(["data-rowindex" => $salary_notch_grid->RowIndex, "id" => "r0_salary_notch", "data-rowtype" => ROWTYPE_ADD]);
		$salary_notch->RowAttrs->appendClass("ew-template");
		$salary_notch->RowType = ROWTYPE_ADD;

		// Render row
		$salary_notch_grid->renderRow();

		// Render list options
		$salary_notch_grid->renderListOptions();
		$salary_notch_grid->StartRowCount = 0;
?>
	<tr <?php echo $salary_notch->rowAttributes() ?>>
<?php

// Render list options (body, left)
$salary_notch_grid->ListOptions->render("body", "left", $salary_notch_grid->RowIndex);
?>
	<?php if ($salary_notch_grid->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale">
<?php if (!$salary_notch->isConfirm()) { ?>
<?php if ($salary_notch_grid->SalaryScale->getSessionValue() != "") { ?>
<span id="el$rowindex$_salary_notch_SalaryScale" class="form-group salary_notch_SalaryScale">
<span<?php echo $salary_notch_grid->SalaryScale->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($salary_notch_grid->SalaryScale->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" name="x<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_notch_grid->SalaryScale->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_salary_notch_SalaryScale" class="form-group salary_notch_SalaryScale">
<input type="text" data-table="salary_notch" data-field="x_SalaryScale" name="x<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" id="x<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($salary_notch_grid->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $salary_notch_grid->SalaryScale->EditValue ?>"<?php echo $salary_notch_grid->SalaryScale->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_salary_notch_SalaryScale" class="form-group salary_notch_SalaryScale">
<span<?php echo $salary_notch_grid->SalaryScale->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($salary_notch_grid->SalaryScale->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="salary_notch" data-field="x_SalaryScale" name="x<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" id="x<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_notch_grid->SalaryScale->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="salary_notch" data-field="x_SalaryScale" name="o<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" id="o<?php echo $salary_notch_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_notch_grid->SalaryScale->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($salary_notch_grid->Notch->Visible) { // Notch ?>
		<td data-name="Notch">
<?php if (!$salary_notch->isConfirm()) { ?>
<span id="el$rowindex$_salary_notch_Notch" class="form-group salary_notch_Notch">
<input type="text" data-table="salary_notch" data-field="x_Notch" name="x<?php echo $salary_notch_grid->RowIndex ?>_Notch" id="x<?php echo $salary_notch_grid->RowIndex ?>_Notch" size="30" placeholder="<?php echo HtmlEncode($salary_notch_grid->Notch->getPlaceHolder()) ?>" value="<?php echo $salary_notch_grid->Notch->EditValue ?>"<?php echo $salary_notch_grid->Notch->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_salary_notch_Notch" class="form-group salary_notch_Notch">
<span<?php echo $salary_notch_grid->Notch->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($salary_notch_grid->Notch->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="salary_notch" data-field="x_Notch" name="x<?php echo $salary_notch_grid->RowIndex ?>_Notch" id="x<?php echo $salary_notch_grid->RowIndex ?>_Notch" value="<?php echo HtmlEncode($salary_notch_grid->Notch->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="salary_notch" data-field="x_Notch" name="o<?php echo $salary_notch_grid->RowIndex ?>_Notch" id="o<?php echo $salary_notch_grid->RowIndex ?>_Notch" value="<?php echo HtmlEncode($salary_notch_grid->Notch->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($salary_notch_grid->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
		<td data-name="BasicMonthlySalary">
<?php if (!$salary_notch->isConfirm()) { ?>
<span id="el$rowindex$_salary_notch_BasicMonthlySalary" class="form-group salary_notch_BasicMonthlySalary">
<input type="text" data-table="salary_notch" data-field="x_BasicMonthlySalary" name="x<?php echo $salary_notch_grid->RowIndex ?>_BasicMonthlySalary" id="x<?php echo $salary_notch_grid->RowIndex ?>_BasicMonthlySalary" size="30" placeholder="<?php echo HtmlEncode($salary_notch_grid->BasicMonthlySalary->getPlaceHolder()) ?>" value="<?php echo $salary_notch_grid->BasicMonthlySalary->EditValue ?>"<?php echo $salary_notch_grid->BasicMonthlySalary->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_salary_notch_BasicMonthlySalary" class="form-group salary_notch_BasicMonthlySalary">
<span<?php echo $salary_notch_grid->BasicMonthlySalary->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($salary_notch_grid->BasicMonthlySalary->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="salary_notch" data-field="x_BasicMonthlySalary" name="x<?php echo $salary_notch_grid->RowIndex ?>_BasicMonthlySalary" id="x<?php echo $salary_notch_grid->RowIndex ?>_BasicMonthlySalary" value="<?php echo HtmlEncode($salary_notch_grid->BasicMonthlySalary->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="salary_notch" data-field="x_BasicMonthlySalary" name="o<?php echo $salary_notch_grid->RowIndex ?>_BasicMonthlySalary" id="o<?php echo $salary_notch_grid->RowIndex ?>_BasicMonthlySalary" value="<?php echo HtmlEncode($salary_notch_grid->BasicMonthlySalary->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($salary_notch_grid->AnnualSalary->Visible) { // AnnualSalary ?>
		<td data-name="AnnualSalary">
<?php if (!$salary_notch->isConfirm()) { ?>
<span id="el$rowindex$_salary_notch_AnnualSalary" class="form-group salary_notch_AnnualSalary">
<input type="text" data-table="salary_notch" data-field="x_AnnualSalary" name="x<?php echo $salary_notch_grid->RowIndex ?>_AnnualSalary" id="x<?php echo $salary_notch_grid->RowIndex ?>_AnnualSalary" size="30" placeholder="<?php echo HtmlEncode($salary_notch_grid->AnnualSalary->getPlaceHolder()) ?>" value="<?php echo $salary_notch_grid->AnnualSalary->EditValue ?>"<?php echo $salary_notch_grid->AnnualSalary->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_salary_notch_AnnualSalary" class="form-group salary_notch_AnnualSalary">
<span<?php echo $salary_notch_grid->AnnualSalary->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($salary_notch_grid->AnnualSalary->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="salary_notch" data-field="x_AnnualSalary" name="x<?php echo $salary_notch_grid->RowIndex ?>_AnnualSalary" id="x<?php echo $salary_notch_grid->RowIndex ?>_AnnualSalary" value="<?php echo HtmlEncode($salary_notch_grid->AnnualSalary->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="salary_notch" data-field="x_AnnualSalary" name="o<?php echo $salary_notch_grid->RowIndex ?>_AnnualSalary" id="o<?php echo $salary_notch_grid->RowIndex ?>_AnnualSalary" value="<?php echo HtmlEncode($salary_notch_grid->AnnualSalary->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$salary_notch_grid->ListOptions->render("body", "right", $salary_notch_grid->RowIndex);
?>
<script>
loadjs.ready(["fsalary_notchgrid", "load"], function() {
	fsalary_notchgrid.updateLists(<?php echo $salary_notch_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($salary_notch->CurrentMode == "add" || $salary_notch->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $salary_notch_grid->FormKeyCountName ?>" id="<?php echo $salary_notch_grid->FormKeyCountName ?>" value="<?php echo $salary_notch_grid->KeyCount ?>">
<?php echo $salary_notch_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($salary_notch->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $salary_notch_grid->FormKeyCountName ?>" id="<?php echo $salary_notch_grid->FormKeyCountName ?>" value="<?php echo $salary_notch_grid->KeyCount ?>">
<?php echo $salary_notch_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($salary_notch->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fsalary_notchgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($salary_notch_grid->Recordset)
	$salary_notch_grid->Recordset->Close();
?>
<?php if ($salary_notch_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $salary_notch_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($salary_notch_grid->TotalRecords == 0 && !$salary_notch->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $salary_notch_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$salary_notch_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$salary_notch_grid->terminate();
?>