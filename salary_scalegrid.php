<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($salary_scale_grid))
	$salary_scale_grid = new salary_scale_grid();

// Run the page
$salary_scale_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$salary_scale_grid->Page_Render();
?>
<?php if (!$salary_scale_grid->isExport()) { ?>
<script>
var fsalary_scalegrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fsalary_scalegrid = new ew.Form("fsalary_scalegrid", "grid");
	fsalary_scalegrid.formKeyCountName = '<?php echo $salary_scale_grid->FormKeyCountName ?>';

	// Validate form
	fsalary_scalegrid.validate = function() {
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
			<?php if ($salary_scale_grid->Division->Required) { ?>
				elm = this.getElements("x" + infix + "_Division");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $salary_scale_grid->Division->caption(), $salary_scale_grid->Division->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Division");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($salary_scale_grid->Division->errorMessage()) ?>");
			<?php if ($salary_scale_grid->SalaryScale->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryScale");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $salary_scale_grid->SalaryScale->caption(), $salary_scale_grid->SalaryScale->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fsalary_scalegrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Division", false)) return false;
		if (ew.valueChanged(fobj, infix, "SalaryScale", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fsalary_scalegrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsalary_scalegrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fsalary_scalegrid");
});
</script>
<?php } ?>
<?php
$salary_scale_grid->renderOtherOptions();
?>
<?php if ($salary_scale_grid->TotalRecords > 0 || $salary_scale->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($salary_scale_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> salary_scale">
<?php if ($salary_scale_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $salary_scale_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fsalary_scalegrid" class="ew-form ew-list-form form-inline">
<div id="gmp_salary_scale" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_salary_scalegrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$salary_scale->RowType = ROWTYPE_HEADER;

// Render list options
$salary_scale_grid->renderListOptions();

// Render list options (header, left)
$salary_scale_grid->ListOptions->render("header", "left");
?>
<?php if ($salary_scale_grid->Division->Visible) { // Division ?>
	<?php if ($salary_scale_grid->SortUrl($salary_scale_grid->Division) == "") { ?>
		<th data-name="Division" class="<?php echo $salary_scale_grid->Division->headerCellClass() ?>"><div id="elh_salary_scale_Division" class="salary_scale_Division"><div class="ew-table-header-caption"><?php echo $salary_scale_grid->Division->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Division" class="<?php echo $salary_scale_grid->Division->headerCellClass() ?>"><div><div id="elh_salary_scale_Division" class="salary_scale_Division">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $salary_scale_grid->Division->caption() ?></span><span class="ew-table-header-sort"><?php if ($salary_scale_grid->Division->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($salary_scale_grid->Division->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($salary_scale_grid->SalaryScale->Visible) { // SalaryScale ?>
	<?php if ($salary_scale_grid->SortUrl($salary_scale_grid->SalaryScale) == "") { ?>
		<th data-name="SalaryScale" class="<?php echo $salary_scale_grid->SalaryScale->headerCellClass() ?>"><div id="elh_salary_scale_SalaryScale" class="salary_scale_SalaryScale"><div class="ew-table-header-caption"><?php echo $salary_scale_grid->SalaryScale->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SalaryScale" class="<?php echo $salary_scale_grid->SalaryScale->headerCellClass() ?>"><div><div id="elh_salary_scale_SalaryScale" class="salary_scale_SalaryScale">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $salary_scale_grid->SalaryScale->caption() ?></span><span class="ew-table-header-sort"><?php if ($salary_scale_grid->SalaryScale->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($salary_scale_grid->SalaryScale->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$salary_scale_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$salary_scale_grid->StartRecord = 1;
$salary_scale_grid->StopRecord = $salary_scale_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($salary_scale->isConfirm() || $salary_scale_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($salary_scale_grid->FormKeyCountName) && ($salary_scale_grid->isGridAdd() || $salary_scale_grid->isGridEdit() || $salary_scale->isConfirm())) {
		$salary_scale_grid->KeyCount = $CurrentForm->getValue($salary_scale_grid->FormKeyCountName);
		$salary_scale_grid->StopRecord = $salary_scale_grid->StartRecord + $salary_scale_grid->KeyCount - 1;
	}
}
$salary_scale_grid->RecordCount = $salary_scale_grid->StartRecord - 1;
if ($salary_scale_grid->Recordset && !$salary_scale_grid->Recordset->EOF) {
	$salary_scale_grid->Recordset->moveFirst();
	$selectLimit = $salary_scale_grid->UseSelectLimit;
	if (!$selectLimit && $salary_scale_grid->StartRecord > 1)
		$salary_scale_grid->Recordset->move($salary_scale_grid->StartRecord - 1);
} elseif (!$salary_scale->AllowAddDeleteRow && $salary_scale_grid->StopRecord == 0) {
	$salary_scale_grid->StopRecord = $salary_scale->GridAddRowCount;
}

// Initialize aggregate
$salary_scale->RowType = ROWTYPE_AGGREGATEINIT;
$salary_scale->resetAttributes();
$salary_scale_grid->renderRow();
if ($salary_scale_grid->isGridAdd())
	$salary_scale_grid->RowIndex = 0;
if ($salary_scale_grid->isGridEdit())
	$salary_scale_grid->RowIndex = 0;
while ($salary_scale_grid->RecordCount < $salary_scale_grid->StopRecord) {
	$salary_scale_grid->RecordCount++;
	if ($salary_scale_grid->RecordCount >= $salary_scale_grid->StartRecord) {
		$salary_scale_grid->RowCount++;
		if ($salary_scale_grid->isGridAdd() || $salary_scale_grid->isGridEdit() || $salary_scale->isConfirm()) {
			$salary_scale_grid->RowIndex++;
			$CurrentForm->Index = $salary_scale_grid->RowIndex;
			if ($CurrentForm->hasValue($salary_scale_grid->FormActionName) && ($salary_scale->isConfirm() || $salary_scale_grid->EventCancelled))
				$salary_scale_grid->RowAction = strval($CurrentForm->getValue($salary_scale_grid->FormActionName));
			elseif ($salary_scale_grid->isGridAdd())
				$salary_scale_grid->RowAction = "insert";
			else
				$salary_scale_grid->RowAction = "";
		}

		// Set up key count
		$salary_scale_grid->KeyCount = $salary_scale_grid->RowIndex;

		// Init row class and style
		$salary_scale->resetAttributes();
		$salary_scale->CssClass = "";
		if ($salary_scale_grid->isGridAdd()) {
			if ($salary_scale->CurrentMode == "copy") {
				$salary_scale_grid->loadRowValues($salary_scale_grid->Recordset); // Load row values
				$salary_scale_grid->setRecordKey($salary_scale_grid->RowOldKey, $salary_scale_grid->Recordset); // Set old record key
			} else {
				$salary_scale_grid->loadRowValues(); // Load default values
				$salary_scale_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$salary_scale_grid->loadRowValues($salary_scale_grid->Recordset); // Load row values
		}
		$salary_scale->RowType = ROWTYPE_VIEW; // Render view
		if ($salary_scale_grid->isGridAdd()) // Grid add
			$salary_scale->RowType = ROWTYPE_ADD; // Render add
		if ($salary_scale_grid->isGridAdd() && $salary_scale->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$salary_scale_grid->restoreCurrentRowFormValues($salary_scale_grid->RowIndex); // Restore form values
		if ($salary_scale_grid->isGridEdit()) { // Grid edit
			if ($salary_scale->EventCancelled)
				$salary_scale_grid->restoreCurrentRowFormValues($salary_scale_grid->RowIndex); // Restore form values
			if ($salary_scale_grid->RowAction == "insert")
				$salary_scale->RowType = ROWTYPE_ADD; // Render add
			else
				$salary_scale->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($salary_scale_grid->isGridEdit() && ($salary_scale->RowType == ROWTYPE_EDIT || $salary_scale->RowType == ROWTYPE_ADD) && $salary_scale->EventCancelled) // Update failed
			$salary_scale_grid->restoreCurrentRowFormValues($salary_scale_grid->RowIndex); // Restore form values
		if ($salary_scale->RowType == ROWTYPE_EDIT) // Edit row
			$salary_scale_grid->EditRowCount++;
		if ($salary_scale->isConfirm()) // Confirm row
			$salary_scale_grid->restoreCurrentRowFormValues($salary_scale_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$salary_scale->RowAttrs->merge(["data-rowindex" => $salary_scale_grid->RowCount, "id" => "r" . $salary_scale_grid->RowCount . "_salary_scale", "data-rowtype" => $salary_scale->RowType]);

		// Render row
		$salary_scale_grid->renderRow();

		// Render list options
		$salary_scale_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($salary_scale_grid->RowAction != "delete" && $salary_scale_grid->RowAction != "insertdelete" && !($salary_scale_grid->RowAction == "insert" && $salary_scale->isConfirm() && $salary_scale_grid->emptyRow())) {
?>
	<tr <?php echo $salary_scale->rowAttributes() ?>>
<?php

// Render list options (body, left)
$salary_scale_grid->ListOptions->render("body", "left", $salary_scale_grid->RowCount);
?>
	<?php if ($salary_scale_grid->Division->Visible) { // Division ?>
		<td data-name="Division" <?php echo $salary_scale_grid->Division->cellAttributes() ?>>
<?php if ($salary_scale->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($salary_scale_grid->Division->getSessionValue() != "") { ?>
<span id="el<?php echo $salary_scale_grid->RowCount ?>_salary_scale_Division" class="form-group">
<span<?php echo $salary_scale_grid->Division->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($salary_scale_grid->Division->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $salary_scale_grid->RowIndex ?>_Division" name="x<?php echo $salary_scale_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($salary_scale_grid->Division->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $salary_scale_grid->RowCount ?>_salary_scale_Division" class="form-group">
<input type="text" data-table="salary_scale" data-field="x_Division" name="x<?php echo $salary_scale_grid->RowIndex ?>_Division" id="x<?php echo $salary_scale_grid->RowIndex ?>_Division" size="30" placeholder="<?php echo HtmlEncode($salary_scale_grid->Division->getPlaceHolder()) ?>" value="<?php echo $salary_scale_grid->Division->EditValue ?>"<?php echo $salary_scale_grid->Division->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="salary_scale" data-field="x_Division" name="o<?php echo $salary_scale_grid->RowIndex ?>_Division" id="o<?php echo $salary_scale_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($salary_scale_grid->Division->OldValue) ?>">
<?php } ?>
<?php if ($salary_scale->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($salary_scale_grid->Division->getSessionValue() != "") { ?>
<span id="el<?php echo $salary_scale_grid->RowCount ?>_salary_scale_Division" class="form-group">
<span<?php echo $salary_scale_grid->Division->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($salary_scale_grid->Division->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $salary_scale_grid->RowIndex ?>_Division" name="x<?php echo $salary_scale_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($salary_scale_grid->Division->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $salary_scale_grid->RowCount ?>_salary_scale_Division" class="form-group">
<input type="text" data-table="salary_scale" data-field="x_Division" name="x<?php echo $salary_scale_grid->RowIndex ?>_Division" id="x<?php echo $salary_scale_grid->RowIndex ?>_Division" size="30" placeholder="<?php echo HtmlEncode($salary_scale_grid->Division->getPlaceHolder()) ?>" value="<?php echo $salary_scale_grid->Division->EditValue ?>"<?php echo $salary_scale_grid->Division->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($salary_scale->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $salary_scale_grid->RowCount ?>_salary_scale_Division">
<span<?php echo $salary_scale_grid->Division->viewAttributes() ?>><?php echo $salary_scale_grid->Division->getViewValue() ?></span>
</span>
<?php if (!$salary_scale->isConfirm()) { ?>
<input type="hidden" data-table="salary_scale" data-field="x_Division" name="x<?php echo $salary_scale_grid->RowIndex ?>_Division" id="x<?php echo $salary_scale_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($salary_scale_grid->Division->FormValue) ?>">
<input type="hidden" data-table="salary_scale" data-field="x_Division" name="o<?php echo $salary_scale_grid->RowIndex ?>_Division" id="o<?php echo $salary_scale_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($salary_scale_grid->Division->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="salary_scale" data-field="x_Division" name="fsalary_scalegrid$x<?php echo $salary_scale_grid->RowIndex ?>_Division" id="fsalary_scalegrid$x<?php echo $salary_scale_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($salary_scale_grid->Division->FormValue) ?>">
<input type="hidden" data-table="salary_scale" data-field="x_Division" name="fsalary_scalegrid$o<?php echo $salary_scale_grid->RowIndex ?>_Division" id="fsalary_scalegrid$o<?php echo $salary_scale_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($salary_scale_grid->Division->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($salary_scale_grid->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale" <?php echo $salary_scale_grid->SalaryScale->cellAttributes() ?>>
<?php if ($salary_scale->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $salary_scale_grid->RowCount ?>_salary_scale_SalaryScale" class="form-group">
<input type="text" data-table="salary_scale" data-field="x_SalaryScale" name="x<?php echo $salary_scale_grid->RowIndex ?>_SalaryScale" id="x<?php echo $salary_scale_grid->RowIndex ?>_SalaryScale" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($salary_scale_grid->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $salary_scale_grid->SalaryScale->EditValue ?>"<?php echo $salary_scale_grid->SalaryScale->editAttributes() ?>>
</span>
<input type="hidden" data-table="salary_scale" data-field="x_SalaryScale" name="o<?php echo $salary_scale_grid->RowIndex ?>_SalaryScale" id="o<?php echo $salary_scale_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_scale_grid->SalaryScale->OldValue) ?>">
<?php } ?>
<?php if ($salary_scale->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="salary_scale" data-field="x_SalaryScale" name="x<?php echo $salary_scale_grid->RowIndex ?>_SalaryScale" id="x<?php echo $salary_scale_grid->RowIndex ?>_SalaryScale" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($salary_scale_grid->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $salary_scale_grid->SalaryScale->EditValue ?>"<?php echo $salary_scale_grid->SalaryScale->editAttributes() ?>>
<input type="hidden" data-table="salary_scale" data-field="x_SalaryScale" name="o<?php echo $salary_scale_grid->RowIndex ?>_SalaryScale" id="o<?php echo $salary_scale_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_scale_grid->SalaryScale->OldValue != null ? $salary_scale_grid->SalaryScale->OldValue : $salary_scale_grid->SalaryScale->CurrentValue) ?>">
<?php } ?>
<?php if ($salary_scale->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $salary_scale_grid->RowCount ?>_salary_scale_SalaryScale">
<span<?php echo $salary_scale_grid->SalaryScale->viewAttributes() ?>><?php echo $salary_scale_grid->SalaryScale->getViewValue() ?></span>
</span>
<?php if (!$salary_scale->isConfirm()) { ?>
<input type="hidden" data-table="salary_scale" data-field="x_SalaryScale" name="x<?php echo $salary_scale_grid->RowIndex ?>_SalaryScale" id="x<?php echo $salary_scale_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_scale_grid->SalaryScale->FormValue) ?>">
<input type="hidden" data-table="salary_scale" data-field="x_SalaryScale" name="o<?php echo $salary_scale_grid->RowIndex ?>_SalaryScale" id="o<?php echo $salary_scale_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_scale_grid->SalaryScale->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="salary_scale" data-field="x_SalaryScale" name="fsalary_scalegrid$x<?php echo $salary_scale_grid->RowIndex ?>_SalaryScale" id="fsalary_scalegrid$x<?php echo $salary_scale_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_scale_grid->SalaryScale->FormValue) ?>">
<input type="hidden" data-table="salary_scale" data-field="x_SalaryScale" name="fsalary_scalegrid$o<?php echo $salary_scale_grid->RowIndex ?>_SalaryScale" id="fsalary_scalegrid$o<?php echo $salary_scale_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_scale_grid->SalaryScale->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$salary_scale_grid->ListOptions->render("body", "right", $salary_scale_grid->RowCount);
?>
	</tr>
<?php if ($salary_scale->RowType == ROWTYPE_ADD || $salary_scale->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fsalary_scalegrid", "load"], function() {
	fsalary_scalegrid.updateLists(<?php echo $salary_scale_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$salary_scale_grid->isGridAdd() || $salary_scale->CurrentMode == "copy")
		if (!$salary_scale_grid->Recordset->EOF)
			$salary_scale_grid->Recordset->moveNext();
}
?>
<?php
	if ($salary_scale->CurrentMode == "add" || $salary_scale->CurrentMode == "copy" || $salary_scale->CurrentMode == "edit") {
		$salary_scale_grid->RowIndex = '$rowindex$';
		$salary_scale_grid->loadRowValues();

		// Set row properties
		$salary_scale->resetAttributes();
		$salary_scale->RowAttrs->merge(["data-rowindex" => $salary_scale_grid->RowIndex, "id" => "r0_salary_scale", "data-rowtype" => ROWTYPE_ADD]);
		$salary_scale->RowAttrs->appendClass("ew-template");
		$salary_scale->RowType = ROWTYPE_ADD;

		// Render row
		$salary_scale_grid->renderRow();

		// Render list options
		$salary_scale_grid->renderListOptions();
		$salary_scale_grid->StartRowCount = 0;
?>
	<tr <?php echo $salary_scale->rowAttributes() ?>>
<?php

// Render list options (body, left)
$salary_scale_grid->ListOptions->render("body", "left", $salary_scale_grid->RowIndex);
?>
	<?php if ($salary_scale_grid->Division->Visible) { // Division ?>
		<td data-name="Division">
<?php if (!$salary_scale->isConfirm()) { ?>
<?php if ($salary_scale_grid->Division->getSessionValue() != "") { ?>
<span id="el$rowindex$_salary_scale_Division" class="form-group salary_scale_Division">
<span<?php echo $salary_scale_grid->Division->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($salary_scale_grid->Division->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $salary_scale_grid->RowIndex ?>_Division" name="x<?php echo $salary_scale_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($salary_scale_grid->Division->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_salary_scale_Division" class="form-group salary_scale_Division">
<input type="text" data-table="salary_scale" data-field="x_Division" name="x<?php echo $salary_scale_grid->RowIndex ?>_Division" id="x<?php echo $salary_scale_grid->RowIndex ?>_Division" size="30" placeholder="<?php echo HtmlEncode($salary_scale_grid->Division->getPlaceHolder()) ?>" value="<?php echo $salary_scale_grid->Division->EditValue ?>"<?php echo $salary_scale_grid->Division->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_salary_scale_Division" class="form-group salary_scale_Division">
<span<?php echo $salary_scale_grid->Division->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($salary_scale_grid->Division->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="salary_scale" data-field="x_Division" name="x<?php echo $salary_scale_grid->RowIndex ?>_Division" id="x<?php echo $salary_scale_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($salary_scale_grid->Division->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="salary_scale" data-field="x_Division" name="o<?php echo $salary_scale_grid->RowIndex ?>_Division" id="o<?php echo $salary_scale_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($salary_scale_grid->Division->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($salary_scale_grid->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale">
<?php if (!$salary_scale->isConfirm()) { ?>
<span id="el$rowindex$_salary_scale_SalaryScale" class="form-group salary_scale_SalaryScale">
<input type="text" data-table="salary_scale" data-field="x_SalaryScale" name="x<?php echo $salary_scale_grid->RowIndex ?>_SalaryScale" id="x<?php echo $salary_scale_grid->RowIndex ?>_SalaryScale" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($salary_scale_grid->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $salary_scale_grid->SalaryScale->EditValue ?>"<?php echo $salary_scale_grid->SalaryScale->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_salary_scale_SalaryScale" class="form-group salary_scale_SalaryScale">
<span<?php echo $salary_scale_grid->SalaryScale->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($salary_scale_grid->SalaryScale->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="salary_scale" data-field="x_SalaryScale" name="x<?php echo $salary_scale_grid->RowIndex ?>_SalaryScale" id="x<?php echo $salary_scale_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_scale_grid->SalaryScale->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="salary_scale" data-field="x_SalaryScale" name="o<?php echo $salary_scale_grid->RowIndex ?>_SalaryScale" id="o<?php echo $salary_scale_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_scale_grid->SalaryScale->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$salary_scale_grid->ListOptions->render("body", "right", $salary_scale_grid->RowIndex);
?>
<script>
loadjs.ready(["fsalary_scalegrid", "load"], function() {
	fsalary_scalegrid.updateLists(<?php echo $salary_scale_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($salary_scale->CurrentMode == "add" || $salary_scale->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $salary_scale_grid->FormKeyCountName ?>" id="<?php echo $salary_scale_grid->FormKeyCountName ?>" value="<?php echo $salary_scale_grid->KeyCount ?>">
<?php echo $salary_scale_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($salary_scale->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $salary_scale_grid->FormKeyCountName ?>" id="<?php echo $salary_scale_grid->FormKeyCountName ?>" value="<?php echo $salary_scale_grid->KeyCount ?>">
<?php echo $salary_scale_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($salary_scale->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fsalary_scalegrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($salary_scale_grid->Recordset)
	$salary_scale_grid->Recordset->Close();
?>
<?php if ($salary_scale_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $salary_scale_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($salary_scale_grid->TotalRecords == 0 && !$salary_scale->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $salary_scale_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$salary_scale_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$salary_scale_grid->terminate();
?>