<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($qualification_grid))
	$qualification_grid = new qualification_grid();

// Run the page
$qualification_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$qualification_grid->Page_Render();
?>
<?php if (!$qualification_grid->isExport()) { ?>
<script>
var fqualificationgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fqualificationgrid = new ew.Form("fqualificationgrid", "grid");
	fqualificationgrid.formKeyCountName = '<?php echo $qualification_grid->FormKeyCountName ?>';

	// Validate form
	fqualificationgrid.validate = function() {
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
			<?php if ($qualification_grid->QualificationCode->Required) { ?>
				elm = this.getElements("x" + infix + "_QualificationCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $qualification_grid->QualificationCode->caption(), $qualification_grid->QualificationCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($qualification_grid->QualificationName->Required) { ?>
				elm = this.getElements("x" + infix + "_QualificationName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $qualification_grid->QualificationName->caption(), $qualification_grid->QualificationName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($qualification_grid->QualificationType->Required) { ?>
				elm = this.getElements("x" + infix + "_QualificationType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $qualification_grid->QualificationType->caption(), $qualification_grid->QualificationType->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fqualificationgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "QualificationName", false)) return false;
		if (ew.valueChanged(fobj, infix, "QualificationType", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fqualificationgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fqualificationgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fqualificationgrid.lists["x_QualificationType"] = <?php echo $qualification_grid->QualificationType->Lookup->toClientList($qualification_grid) ?>;
	fqualificationgrid.lists["x_QualificationType"].options = <?php echo JsonEncode($qualification_grid->QualificationType->lookupOptions()) ?>;
	loadjs.done("fqualificationgrid");
});
</script>
<?php } ?>
<?php
$qualification_grid->renderOtherOptions();
?>
<?php if ($qualification_grid->TotalRecords > 0 || $qualification->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($qualification_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> qualification">
<?php if ($qualification_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $qualification_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fqualificationgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_qualification" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_qualificationgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$qualification->RowType = ROWTYPE_HEADER;

// Render list options
$qualification_grid->renderListOptions();

// Render list options (header, left)
$qualification_grid->ListOptions->render("header", "left");
?>
<?php if ($qualification_grid->QualificationCode->Visible) { // QualificationCode ?>
	<?php if ($qualification_grid->SortUrl($qualification_grid->QualificationCode) == "") { ?>
		<th data-name="QualificationCode" class="<?php echo $qualification_grid->QualificationCode->headerCellClass() ?>"><div id="elh_qualification_QualificationCode" class="qualification_QualificationCode"><div class="ew-table-header-caption"><?php echo $qualification_grid->QualificationCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="QualificationCode" class="<?php echo $qualification_grid->QualificationCode->headerCellClass() ?>"><div><div id="elh_qualification_QualificationCode" class="qualification_QualificationCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $qualification_grid->QualificationCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($qualification_grid->QualificationCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($qualification_grid->QualificationCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($qualification_grid->QualificationName->Visible) { // QualificationName ?>
	<?php if ($qualification_grid->SortUrl($qualification_grid->QualificationName) == "") { ?>
		<th data-name="QualificationName" class="<?php echo $qualification_grid->QualificationName->headerCellClass() ?>"><div id="elh_qualification_QualificationName" class="qualification_QualificationName"><div class="ew-table-header-caption"><?php echo $qualification_grid->QualificationName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="QualificationName" class="<?php echo $qualification_grid->QualificationName->headerCellClass() ?>"><div><div id="elh_qualification_QualificationName" class="qualification_QualificationName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $qualification_grid->QualificationName->caption() ?></span><span class="ew-table-header-sort"><?php if ($qualification_grid->QualificationName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($qualification_grid->QualificationName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($qualification_grid->QualificationType->Visible) { // QualificationType ?>
	<?php if ($qualification_grid->SortUrl($qualification_grid->QualificationType) == "") { ?>
		<th data-name="QualificationType" class="<?php echo $qualification_grid->QualificationType->headerCellClass() ?>"><div id="elh_qualification_QualificationType" class="qualification_QualificationType"><div class="ew-table-header-caption"><?php echo $qualification_grid->QualificationType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="QualificationType" class="<?php echo $qualification_grid->QualificationType->headerCellClass() ?>"><div><div id="elh_qualification_QualificationType" class="qualification_QualificationType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $qualification_grid->QualificationType->caption() ?></span><span class="ew-table-header-sort"><?php if ($qualification_grid->QualificationType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($qualification_grid->QualificationType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$qualification_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$qualification_grid->StartRecord = 1;
$qualification_grid->StopRecord = $qualification_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($qualification->isConfirm() || $qualification_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($qualification_grid->FormKeyCountName) && ($qualification_grid->isGridAdd() || $qualification_grid->isGridEdit() || $qualification->isConfirm())) {
		$qualification_grid->KeyCount = $CurrentForm->getValue($qualification_grid->FormKeyCountName);
		$qualification_grid->StopRecord = $qualification_grid->StartRecord + $qualification_grid->KeyCount - 1;
	}
}
$qualification_grid->RecordCount = $qualification_grid->StartRecord - 1;
if ($qualification_grid->Recordset && !$qualification_grid->Recordset->EOF) {
	$qualification_grid->Recordset->moveFirst();
	$selectLimit = $qualification_grid->UseSelectLimit;
	if (!$selectLimit && $qualification_grid->StartRecord > 1)
		$qualification_grid->Recordset->move($qualification_grid->StartRecord - 1);
} elseif (!$qualification->AllowAddDeleteRow && $qualification_grid->StopRecord == 0) {
	$qualification_grid->StopRecord = $qualification->GridAddRowCount;
}

// Initialize aggregate
$qualification->RowType = ROWTYPE_AGGREGATEINIT;
$qualification->resetAttributes();
$qualification_grid->renderRow();
if ($qualification_grid->isGridAdd())
	$qualification_grid->RowIndex = 0;
if ($qualification_grid->isGridEdit())
	$qualification_grid->RowIndex = 0;
while ($qualification_grid->RecordCount < $qualification_grid->StopRecord) {
	$qualification_grid->RecordCount++;
	if ($qualification_grid->RecordCount >= $qualification_grid->StartRecord) {
		$qualification_grid->RowCount++;
		if ($qualification_grid->isGridAdd() || $qualification_grid->isGridEdit() || $qualification->isConfirm()) {
			$qualification_grid->RowIndex++;
			$CurrentForm->Index = $qualification_grid->RowIndex;
			if ($CurrentForm->hasValue($qualification_grid->FormActionName) && ($qualification->isConfirm() || $qualification_grid->EventCancelled))
				$qualification_grid->RowAction = strval($CurrentForm->getValue($qualification_grid->FormActionName));
			elseif ($qualification_grid->isGridAdd())
				$qualification_grid->RowAction = "insert";
			else
				$qualification_grid->RowAction = "";
		}

		// Set up key count
		$qualification_grid->KeyCount = $qualification_grid->RowIndex;

		// Init row class and style
		$qualification->resetAttributes();
		$qualification->CssClass = "";
		if ($qualification_grid->isGridAdd()) {
			if ($qualification->CurrentMode == "copy") {
				$qualification_grid->loadRowValues($qualification_grid->Recordset); // Load row values
				$qualification_grid->setRecordKey($qualification_grid->RowOldKey, $qualification_grid->Recordset); // Set old record key
			} else {
				$qualification_grid->loadRowValues(); // Load default values
				$qualification_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$qualification_grid->loadRowValues($qualification_grid->Recordset); // Load row values
		}
		$qualification->RowType = ROWTYPE_VIEW; // Render view
		if ($qualification_grid->isGridAdd()) // Grid add
			$qualification->RowType = ROWTYPE_ADD; // Render add
		if ($qualification_grid->isGridAdd() && $qualification->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$qualification_grid->restoreCurrentRowFormValues($qualification_grid->RowIndex); // Restore form values
		if ($qualification_grid->isGridEdit()) { // Grid edit
			if ($qualification->EventCancelled)
				$qualification_grid->restoreCurrentRowFormValues($qualification_grid->RowIndex); // Restore form values
			if ($qualification_grid->RowAction == "insert")
				$qualification->RowType = ROWTYPE_ADD; // Render add
			else
				$qualification->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($qualification_grid->isGridEdit() && ($qualification->RowType == ROWTYPE_EDIT || $qualification->RowType == ROWTYPE_ADD) && $qualification->EventCancelled) // Update failed
			$qualification_grid->restoreCurrentRowFormValues($qualification_grid->RowIndex); // Restore form values
		if ($qualification->RowType == ROWTYPE_EDIT) // Edit row
			$qualification_grid->EditRowCount++;
		if ($qualification->isConfirm()) // Confirm row
			$qualification_grid->restoreCurrentRowFormValues($qualification_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$qualification->RowAttrs->merge(["data-rowindex" => $qualification_grid->RowCount, "id" => "r" . $qualification_grid->RowCount . "_qualification", "data-rowtype" => $qualification->RowType]);

		// Render row
		$qualification_grid->renderRow();

		// Render list options
		$qualification_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($qualification_grid->RowAction != "delete" && $qualification_grid->RowAction != "insertdelete" && !($qualification_grid->RowAction == "insert" && $qualification->isConfirm() && $qualification_grid->emptyRow())) {
?>
	<tr <?php echo $qualification->rowAttributes() ?>>
<?php

// Render list options (body, left)
$qualification_grid->ListOptions->render("body", "left", $qualification_grid->RowCount);
?>
	<?php if ($qualification_grid->QualificationCode->Visible) { // QualificationCode ?>
		<td data-name="QualificationCode" <?php echo $qualification_grid->QualificationCode->cellAttributes() ?>>
<?php if ($qualification->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $qualification_grid->RowCount ?>_qualification_QualificationCode" class="form-group"></span>
<input type="hidden" data-table="qualification" data-field="x_QualificationCode" name="o<?php echo $qualification_grid->RowIndex ?>_QualificationCode" id="o<?php echo $qualification_grid->RowIndex ?>_QualificationCode" value="<?php echo HtmlEncode($qualification_grid->QualificationCode->OldValue) ?>">
<?php } ?>
<?php if ($qualification->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $qualification_grid->RowCount ?>_qualification_QualificationCode" class="form-group">
<span<?php echo $qualification_grid->QualificationCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($qualification_grid->QualificationCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="qualification" data-field="x_QualificationCode" name="x<?php echo $qualification_grid->RowIndex ?>_QualificationCode" id="x<?php echo $qualification_grid->RowIndex ?>_QualificationCode" value="<?php echo HtmlEncode($qualification_grid->QualificationCode->CurrentValue) ?>">
<?php } ?>
<?php if ($qualification->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $qualification_grid->RowCount ?>_qualification_QualificationCode">
<span<?php echo $qualification_grid->QualificationCode->viewAttributes() ?>><?php echo $qualification_grid->QualificationCode->getViewValue() ?></span>
</span>
<?php if (!$qualification->isConfirm()) { ?>
<input type="hidden" data-table="qualification" data-field="x_QualificationCode" name="x<?php echo $qualification_grid->RowIndex ?>_QualificationCode" id="x<?php echo $qualification_grid->RowIndex ?>_QualificationCode" value="<?php echo HtmlEncode($qualification_grid->QualificationCode->FormValue) ?>">
<input type="hidden" data-table="qualification" data-field="x_QualificationCode" name="o<?php echo $qualification_grid->RowIndex ?>_QualificationCode" id="o<?php echo $qualification_grid->RowIndex ?>_QualificationCode" value="<?php echo HtmlEncode($qualification_grid->QualificationCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="qualification" data-field="x_QualificationCode" name="fqualificationgrid$x<?php echo $qualification_grid->RowIndex ?>_QualificationCode" id="fqualificationgrid$x<?php echo $qualification_grid->RowIndex ?>_QualificationCode" value="<?php echo HtmlEncode($qualification_grid->QualificationCode->FormValue) ?>">
<input type="hidden" data-table="qualification" data-field="x_QualificationCode" name="fqualificationgrid$o<?php echo $qualification_grid->RowIndex ?>_QualificationCode" id="fqualificationgrid$o<?php echo $qualification_grid->RowIndex ?>_QualificationCode" value="<?php echo HtmlEncode($qualification_grid->QualificationCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($qualification_grid->QualificationName->Visible) { // QualificationName ?>
		<td data-name="QualificationName" <?php echo $qualification_grid->QualificationName->cellAttributes() ?>>
<?php if ($qualification->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $qualification_grid->RowCount ?>_qualification_QualificationName" class="form-group">
<input type="text" data-table="qualification" data-field="x_QualificationName" name="x<?php echo $qualification_grid->RowIndex ?>_QualificationName" id="x<?php echo $qualification_grid->RowIndex ?>_QualificationName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($qualification_grid->QualificationName->getPlaceHolder()) ?>" value="<?php echo $qualification_grid->QualificationName->EditValue ?>"<?php echo $qualification_grid->QualificationName->editAttributes() ?>>
</span>
<input type="hidden" data-table="qualification" data-field="x_QualificationName" name="o<?php echo $qualification_grid->RowIndex ?>_QualificationName" id="o<?php echo $qualification_grid->RowIndex ?>_QualificationName" value="<?php echo HtmlEncode($qualification_grid->QualificationName->OldValue) ?>">
<?php } ?>
<?php if ($qualification->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $qualification_grid->RowCount ?>_qualification_QualificationName" class="form-group">
<input type="text" data-table="qualification" data-field="x_QualificationName" name="x<?php echo $qualification_grid->RowIndex ?>_QualificationName" id="x<?php echo $qualification_grid->RowIndex ?>_QualificationName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($qualification_grid->QualificationName->getPlaceHolder()) ?>" value="<?php echo $qualification_grid->QualificationName->EditValue ?>"<?php echo $qualification_grid->QualificationName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($qualification->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $qualification_grid->RowCount ?>_qualification_QualificationName">
<span<?php echo $qualification_grid->QualificationName->viewAttributes() ?>><?php echo $qualification_grid->QualificationName->getViewValue() ?></span>
</span>
<?php if (!$qualification->isConfirm()) { ?>
<input type="hidden" data-table="qualification" data-field="x_QualificationName" name="x<?php echo $qualification_grid->RowIndex ?>_QualificationName" id="x<?php echo $qualification_grid->RowIndex ?>_QualificationName" value="<?php echo HtmlEncode($qualification_grid->QualificationName->FormValue) ?>">
<input type="hidden" data-table="qualification" data-field="x_QualificationName" name="o<?php echo $qualification_grid->RowIndex ?>_QualificationName" id="o<?php echo $qualification_grid->RowIndex ?>_QualificationName" value="<?php echo HtmlEncode($qualification_grid->QualificationName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="qualification" data-field="x_QualificationName" name="fqualificationgrid$x<?php echo $qualification_grid->RowIndex ?>_QualificationName" id="fqualificationgrid$x<?php echo $qualification_grid->RowIndex ?>_QualificationName" value="<?php echo HtmlEncode($qualification_grid->QualificationName->FormValue) ?>">
<input type="hidden" data-table="qualification" data-field="x_QualificationName" name="fqualificationgrid$o<?php echo $qualification_grid->RowIndex ?>_QualificationName" id="fqualificationgrid$o<?php echo $qualification_grid->RowIndex ?>_QualificationName" value="<?php echo HtmlEncode($qualification_grid->QualificationName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($qualification_grid->QualificationType->Visible) { // QualificationType ?>
		<td data-name="QualificationType" <?php echo $qualification_grid->QualificationType->cellAttributes() ?>>
<?php if ($qualification->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($qualification_grid->QualificationType->getSessionValue() != "") { ?>
<span id="el<?php echo $qualification_grid->RowCount ?>_qualification_QualificationType" class="form-group">
<span<?php echo $qualification_grid->QualificationType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($qualification_grid->QualificationType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $qualification_grid->RowIndex ?>_QualificationType" name="x<?php echo $qualification_grid->RowIndex ?>_QualificationType" value="<?php echo HtmlEncode($qualification_grid->QualificationType->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $qualification_grid->RowCount ?>_qualification_QualificationType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="qualification" data-field="x_QualificationType" data-value-separator="<?php echo $qualification_grid->QualificationType->displayValueSeparatorAttribute() ?>" id="x<?php echo $qualification_grid->RowIndex ?>_QualificationType" name="x<?php echo $qualification_grid->RowIndex ?>_QualificationType"<?php echo $qualification_grid->QualificationType->editAttributes() ?>>
			<?php echo $qualification_grid->QualificationType->selectOptionListHtml("x{$qualification_grid->RowIndex}_QualificationType") ?>
		</select>
</div>
<?php echo $qualification_grid->QualificationType->Lookup->getParamTag($qualification_grid, "p_x" . $qualification_grid->RowIndex . "_QualificationType") ?>
</span>
<?php } ?>
<input type="hidden" data-table="qualification" data-field="x_QualificationType" name="o<?php echo $qualification_grid->RowIndex ?>_QualificationType" id="o<?php echo $qualification_grid->RowIndex ?>_QualificationType" value="<?php echo HtmlEncode($qualification_grid->QualificationType->OldValue) ?>">
<?php } ?>
<?php if ($qualification->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($qualification_grid->QualificationType->getSessionValue() != "") { ?>
<span id="el<?php echo $qualification_grid->RowCount ?>_qualification_QualificationType" class="form-group">
<span<?php echo $qualification_grid->QualificationType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($qualification_grid->QualificationType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $qualification_grid->RowIndex ?>_QualificationType" name="x<?php echo $qualification_grid->RowIndex ?>_QualificationType" value="<?php echo HtmlEncode($qualification_grid->QualificationType->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $qualification_grid->RowCount ?>_qualification_QualificationType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="qualification" data-field="x_QualificationType" data-value-separator="<?php echo $qualification_grid->QualificationType->displayValueSeparatorAttribute() ?>" id="x<?php echo $qualification_grid->RowIndex ?>_QualificationType" name="x<?php echo $qualification_grid->RowIndex ?>_QualificationType"<?php echo $qualification_grid->QualificationType->editAttributes() ?>>
			<?php echo $qualification_grid->QualificationType->selectOptionListHtml("x{$qualification_grid->RowIndex}_QualificationType") ?>
		</select>
</div>
<?php echo $qualification_grid->QualificationType->Lookup->getParamTag($qualification_grid, "p_x" . $qualification_grid->RowIndex . "_QualificationType") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($qualification->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $qualification_grid->RowCount ?>_qualification_QualificationType">
<span<?php echo $qualification_grid->QualificationType->viewAttributes() ?>><?php echo $qualification_grid->QualificationType->getViewValue() ?></span>
</span>
<?php if (!$qualification->isConfirm()) { ?>
<input type="hidden" data-table="qualification" data-field="x_QualificationType" name="x<?php echo $qualification_grid->RowIndex ?>_QualificationType" id="x<?php echo $qualification_grid->RowIndex ?>_QualificationType" value="<?php echo HtmlEncode($qualification_grid->QualificationType->FormValue) ?>">
<input type="hidden" data-table="qualification" data-field="x_QualificationType" name="o<?php echo $qualification_grid->RowIndex ?>_QualificationType" id="o<?php echo $qualification_grid->RowIndex ?>_QualificationType" value="<?php echo HtmlEncode($qualification_grid->QualificationType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="qualification" data-field="x_QualificationType" name="fqualificationgrid$x<?php echo $qualification_grid->RowIndex ?>_QualificationType" id="fqualificationgrid$x<?php echo $qualification_grid->RowIndex ?>_QualificationType" value="<?php echo HtmlEncode($qualification_grid->QualificationType->FormValue) ?>">
<input type="hidden" data-table="qualification" data-field="x_QualificationType" name="fqualificationgrid$o<?php echo $qualification_grid->RowIndex ?>_QualificationType" id="fqualificationgrid$o<?php echo $qualification_grid->RowIndex ?>_QualificationType" value="<?php echo HtmlEncode($qualification_grid->QualificationType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$qualification_grid->ListOptions->render("body", "right", $qualification_grid->RowCount);
?>
	</tr>
<?php if ($qualification->RowType == ROWTYPE_ADD || $qualification->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fqualificationgrid", "load"], function() {
	fqualificationgrid.updateLists(<?php echo $qualification_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$qualification_grid->isGridAdd() || $qualification->CurrentMode == "copy")
		if (!$qualification_grid->Recordset->EOF)
			$qualification_grid->Recordset->moveNext();
}
?>
<?php
	if ($qualification->CurrentMode == "add" || $qualification->CurrentMode == "copy" || $qualification->CurrentMode == "edit") {
		$qualification_grid->RowIndex = '$rowindex$';
		$qualification_grid->loadRowValues();

		// Set row properties
		$qualification->resetAttributes();
		$qualification->RowAttrs->merge(["data-rowindex" => $qualification_grid->RowIndex, "id" => "r0_qualification", "data-rowtype" => ROWTYPE_ADD]);
		$qualification->RowAttrs->appendClass("ew-template");
		$qualification->RowType = ROWTYPE_ADD;

		// Render row
		$qualification_grid->renderRow();

		// Render list options
		$qualification_grid->renderListOptions();
		$qualification_grid->StartRowCount = 0;
?>
	<tr <?php echo $qualification->rowAttributes() ?>>
<?php

// Render list options (body, left)
$qualification_grid->ListOptions->render("body", "left", $qualification_grid->RowIndex);
?>
	<?php if ($qualification_grid->QualificationCode->Visible) { // QualificationCode ?>
		<td data-name="QualificationCode">
<?php if (!$qualification->isConfirm()) { ?>
<span id="el$rowindex$_qualification_QualificationCode" class="form-group qualification_QualificationCode"></span>
<?php } else { ?>
<span id="el$rowindex$_qualification_QualificationCode" class="form-group qualification_QualificationCode">
<span<?php echo $qualification_grid->QualificationCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($qualification_grid->QualificationCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="qualification" data-field="x_QualificationCode" name="x<?php echo $qualification_grid->RowIndex ?>_QualificationCode" id="x<?php echo $qualification_grid->RowIndex ?>_QualificationCode" value="<?php echo HtmlEncode($qualification_grid->QualificationCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="qualification" data-field="x_QualificationCode" name="o<?php echo $qualification_grid->RowIndex ?>_QualificationCode" id="o<?php echo $qualification_grid->RowIndex ?>_QualificationCode" value="<?php echo HtmlEncode($qualification_grid->QualificationCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($qualification_grid->QualificationName->Visible) { // QualificationName ?>
		<td data-name="QualificationName">
<?php if (!$qualification->isConfirm()) { ?>
<span id="el$rowindex$_qualification_QualificationName" class="form-group qualification_QualificationName">
<input type="text" data-table="qualification" data-field="x_QualificationName" name="x<?php echo $qualification_grid->RowIndex ?>_QualificationName" id="x<?php echo $qualification_grid->RowIndex ?>_QualificationName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($qualification_grid->QualificationName->getPlaceHolder()) ?>" value="<?php echo $qualification_grid->QualificationName->EditValue ?>"<?php echo $qualification_grid->QualificationName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_qualification_QualificationName" class="form-group qualification_QualificationName">
<span<?php echo $qualification_grid->QualificationName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($qualification_grid->QualificationName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="qualification" data-field="x_QualificationName" name="x<?php echo $qualification_grid->RowIndex ?>_QualificationName" id="x<?php echo $qualification_grid->RowIndex ?>_QualificationName" value="<?php echo HtmlEncode($qualification_grid->QualificationName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="qualification" data-field="x_QualificationName" name="o<?php echo $qualification_grid->RowIndex ?>_QualificationName" id="o<?php echo $qualification_grid->RowIndex ?>_QualificationName" value="<?php echo HtmlEncode($qualification_grid->QualificationName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($qualification_grid->QualificationType->Visible) { // QualificationType ?>
		<td data-name="QualificationType">
<?php if (!$qualification->isConfirm()) { ?>
<?php if ($qualification_grid->QualificationType->getSessionValue() != "") { ?>
<span id="el$rowindex$_qualification_QualificationType" class="form-group qualification_QualificationType">
<span<?php echo $qualification_grid->QualificationType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($qualification_grid->QualificationType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $qualification_grid->RowIndex ?>_QualificationType" name="x<?php echo $qualification_grid->RowIndex ?>_QualificationType" value="<?php echo HtmlEncode($qualification_grid->QualificationType->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_qualification_QualificationType" class="form-group qualification_QualificationType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="qualification" data-field="x_QualificationType" data-value-separator="<?php echo $qualification_grid->QualificationType->displayValueSeparatorAttribute() ?>" id="x<?php echo $qualification_grid->RowIndex ?>_QualificationType" name="x<?php echo $qualification_grid->RowIndex ?>_QualificationType"<?php echo $qualification_grid->QualificationType->editAttributes() ?>>
			<?php echo $qualification_grid->QualificationType->selectOptionListHtml("x{$qualification_grid->RowIndex}_QualificationType") ?>
		</select>
</div>
<?php echo $qualification_grid->QualificationType->Lookup->getParamTag($qualification_grid, "p_x" . $qualification_grid->RowIndex . "_QualificationType") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_qualification_QualificationType" class="form-group qualification_QualificationType">
<span<?php echo $qualification_grid->QualificationType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($qualification_grid->QualificationType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="qualification" data-field="x_QualificationType" name="x<?php echo $qualification_grid->RowIndex ?>_QualificationType" id="x<?php echo $qualification_grid->RowIndex ?>_QualificationType" value="<?php echo HtmlEncode($qualification_grid->QualificationType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="qualification" data-field="x_QualificationType" name="o<?php echo $qualification_grid->RowIndex ?>_QualificationType" id="o<?php echo $qualification_grid->RowIndex ?>_QualificationType" value="<?php echo HtmlEncode($qualification_grid->QualificationType->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$qualification_grid->ListOptions->render("body", "right", $qualification_grid->RowIndex);
?>
<script>
loadjs.ready(["fqualificationgrid", "load"], function() {
	fqualificationgrid.updateLists(<?php echo $qualification_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($qualification->CurrentMode == "add" || $qualification->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $qualification_grid->FormKeyCountName ?>" id="<?php echo $qualification_grid->FormKeyCountName ?>" value="<?php echo $qualification_grid->KeyCount ?>">
<?php echo $qualification_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($qualification->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $qualification_grid->FormKeyCountName ?>" id="<?php echo $qualification_grid->FormKeyCountName ?>" value="<?php echo $qualification_grid->KeyCount ?>">
<?php echo $qualification_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($qualification->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fqualificationgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($qualification_grid->Recordset)
	$qualification_grid->Recordset->Close();
?>
<?php if ($qualification_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $qualification_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($qualification_grid->TotalRecords == 0 && !$qualification->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $qualification_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$qualification_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$qualification_grid->terminate();
?>