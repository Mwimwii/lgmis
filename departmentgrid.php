<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($department_grid))
	$department_grid = new department_grid();

// Run the page
$department_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$department_grid->Page_Render();
?>
<?php if (!$department_grid->isExport()) { ?>
<script>
var fdepartmentgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fdepartmentgrid = new ew.Form("fdepartmentgrid", "grid");
	fdepartmentgrid.formKeyCountName = '<?php echo $department_grid->FormKeyCountName ?>';

	// Validate form
	fdepartmentgrid.validate = function() {
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
			<?php if ($department_grid->DepartmentName->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $department_grid->DepartmentName->caption(), $department_grid->DepartmentName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($department_grid->Telephone->Required) { ?>
				elm = this.getElements("x" + infix + "_Telephone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $department_grid->Telephone->caption(), $department_grid->Telephone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($department_grid->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $department_grid->_Email->caption(), $department_grid->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($department_grid->_Email->errorMessage()) ?>");
			<?php if ($department_grid->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $department_grid->LACode->caption(), $department_grid->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($department_grid->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $department_grid->ProvinceCode->caption(), $department_grid->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fdepartmentgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "DepartmentName", false)) return false;
		if (ew.valueChanged(fobj, infix, "Telephone", false)) return false;
		if (ew.valueChanged(fobj, infix, "_Email", false)) return false;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProvinceCode", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdepartmentgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdepartmentgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdepartmentgrid.lists["x_LACode"] = <?php echo $department_grid->LACode->Lookup->toClientList($department_grid) ?>;
	fdepartmentgrid.lists["x_LACode"].options = <?php echo JsonEncode($department_grid->LACode->lookupOptions()) ?>;
	fdepartmentgrid.lists["x_ProvinceCode"] = <?php echo $department_grid->ProvinceCode->Lookup->toClientList($department_grid) ?>;
	fdepartmentgrid.lists["x_ProvinceCode"].options = <?php echo JsonEncode($department_grid->ProvinceCode->lookupOptions()) ?>;
	loadjs.done("fdepartmentgrid");
});
</script>
<?php } ?>
<?php
$department_grid->renderOtherOptions();
?>
<?php if ($department_grid->TotalRecords > 0 || $department->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($department_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> department">
<?php if ($department_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $department_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdepartmentgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_department" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_departmentgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$department->RowType = ROWTYPE_HEADER;

// Render list options
$department_grid->renderListOptions();

// Render list options (header, left)
$department_grid->ListOptions->render("header", "left");
?>
<?php if ($department_grid->DepartmentName->Visible) { // DepartmentName ?>
	<?php if ($department_grid->SortUrl($department_grid->DepartmentName) == "") { ?>
		<th data-name="DepartmentName" class="<?php echo $department_grid->DepartmentName->headerCellClass() ?>"><div id="elh_department_DepartmentName" class="department_DepartmentName"><div class="ew-table-header-caption"><?php echo $department_grid->DepartmentName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentName" class="<?php echo $department_grid->DepartmentName->headerCellClass() ?>"><div><div id="elh_department_DepartmentName" class="department_DepartmentName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $department_grid->DepartmentName->caption() ?></span><span class="ew-table-header-sort"><?php if ($department_grid->DepartmentName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($department_grid->DepartmentName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($department_grid->Telephone->Visible) { // Telephone ?>
	<?php if ($department_grid->SortUrl($department_grid->Telephone) == "") { ?>
		<th data-name="Telephone" class="<?php echo $department_grid->Telephone->headerCellClass() ?>"><div id="elh_department_Telephone" class="department_Telephone"><div class="ew-table-header-caption"><?php echo $department_grid->Telephone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Telephone" class="<?php echo $department_grid->Telephone->headerCellClass() ?>"><div><div id="elh_department_Telephone" class="department_Telephone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $department_grid->Telephone->caption() ?></span><span class="ew-table-header-sort"><?php if ($department_grid->Telephone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($department_grid->Telephone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($department_grid->_Email->Visible) { // Email ?>
	<?php if ($department_grid->SortUrl($department_grid->_Email) == "") { ?>
		<th data-name="_Email" class="<?php echo $department_grid->_Email->headerCellClass() ?>"><div id="elh_department__Email" class="department__Email"><div class="ew-table-header-caption"><?php echo $department_grid->_Email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_Email" class="<?php echo $department_grid->_Email->headerCellClass() ?>"><div><div id="elh_department__Email" class="department__Email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $department_grid->_Email->caption() ?></span><span class="ew-table-header-sort"><?php if ($department_grid->_Email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($department_grid->_Email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($department_grid->LACode->Visible) { // LACode ?>
	<?php if ($department_grid->SortUrl($department_grid->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $department_grid->LACode->headerCellClass() ?>"><div id="elh_department_LACode" class="department_LACode"><div class="ew-table-header-caption"><?php echo $department_grid->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $department_grid->LACode->headerCellClass() ?>"><div><div id="elh_department_LACode" class="department_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $department_grid->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($department_grid->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($department_grid->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($department_grid->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($department_grid->SortUrl($department_grid->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $department_grid->ProvinceCode->headerCellClass() ?>"><div id="elh_department_ProvinceCode" class="department_ProvinceCode"><div class="ew-table-header-caption"><?php echo $department_grid->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $department_grid->ProvinceCode->headerCellClass() ?>"><div><div id="elh_department_ProvinceCode" class="department_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $department_grid->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($department_grid->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($department_grid->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$department_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$department_grid->StartRecord = 1;
$department_grid->StopRecord = $department_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($department->isConfirm() || $department_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($department_grid->FormKeyCountName) && ($department_grid->isGridAdd() || $department_grid->isGridEdit() || $department->isConfirm())) {
		$department_grid->KeyCount = $CurrentForm->getValue($department_grid->FormKeyCountName);
		$department_grid->StopRecord = $department_grid->StartRecord + $department_grid->KeyCount - 1;
	}
}
$department_grid->RecordCount = $department_grid->StartRecord - 1;
if ($department_grid->Recordset && !$department_grid->Recordset->EOF) {
	$department_grid->Recordset->moveFirst();
	$selectLimit = $department_grid->UseSelectLimit;
	if (!$selectLimit && $department_grid->StartRecord > 1)
		$department_grid->Recordset->move($department_grid->StartRecord - 1);
} elseif (!$department->AllowAddDeleteRow && $department_grid->StopRecord == 0) {
	$department_grid->StopRecord = $department->GridAddRowCount;
}

// Initialize aggregate
$department->RowType = ROWTYPE_AGGREGATEINIT;
$department->resetAttributes();
$department_grid->renderRow();
if ($department_grid->isGridAdd())
	$department_grid->RowIndex = 0;
if ($department_grid->isGridEdit())
	$department_grid->RowIndex = 0;
while ($department_grid->RecordCount < $department_grid->StopRecord) {
	$department_grid->RecordCount++;
	if ($department_grid->RecordCount >= $department_grid->StartRecord) {
		$department_grid->RowCount++;
		if ($department_grid->isGridAdd() || $department_grid->isGridEdit() || $department->isConfirm()) {
			$department_grid->RowIndex++;
			$CurrentForm->Index = $department_grid->RowIndex;
			if ($CurrentForm->hasValue($department_grid->FormActionName) && ($department->isConfirm() || $department_grid->EventCancelled))
				$department_grid->RowAction = strval($CurrentForm->getValue($department_grid->FormActionName));
			elseif ($department_grid->isGridAdd())
				$department_grid->RowAction = "insert";
			else
				$department_grid->RowAction = "";
		}

		// Set up key count
		$department_grid->KeyCount = $department_grid->RowIndex;

		// Init row class and style
		$department->resetAttributes();
		$department->CssClass = "";
		if ($department_grid->isGridAdd()) {
			if ($department->CurrentMode == "copy") {
				$department_grid->loadRowValues($department_grid->Recordset); // Load row values
				$department_grid->setRecordKey($department_grid->RowOldKey, $department_grid->Recordset); // Set old record key
			} else {
				$department_grid->loadRowValues(); // Load default values
				$department_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$department_grid->loadRowValues($department_grid->Recordset); // Load row values
		}
		$department->RowType = ROWTYPE_VIEW; // Render view
		if ($department_grid->isGridAdd()) // Grid add
			$department->RowType = ROWTYPE_ADD; // Render add
		if ($department_grid->isGridAdd() && $department->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$department_grid->restoreCurrentRowFormValues($department_grid->RowIndex); // Restore form values
		if ($department_grid->isGridEdit()) { // Grid edit
			if ($department->EventCancelled)
				$department_grid->restoreCurrentRowFormValues($department_grid->RowIndex); // Restore form values
			if ($department_grid->RowAction == "insert")
				$department->RowType = ROWTYPE_ADD; // Render add
			else
				$department->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($department_grid->isGridEdit() && ($department->RowType == ROWTYPE_EDIT || $department->RowType == ROWTYPE_ADD) && $department->EventCancelled) // Update failed
			$department_grid->restoreCurrentRowFormValues($department_grid->RowIndex); // Restore form values
		if ($department->RowType == ROWTYPE_EDIT) // Edit row
			$department_grid->EditRowCount++;
		if ($department->isConfirm()) // Confirm row
			$department_grid->restoreCurrentRowFormValues($department_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$department->RowAttrs->merge(["data-rowindex" => $department_grid->RowCount, "id" => "r" . $department_grid->RowCount . "_department", "data-rowtype" => $department->RowType]);

		// Render row
		$department_grid->renderRow();

		// Render list options
		$department_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($department_grid->RowAction != "delete" && $department_grid->RowAction != "insertdelete" && !($department_grid->RowAction == "insert" && $department->isConfirm() && $department_grid->emptyRow())) {
?>
	<tr <?php echo $department->rowAttributes() ?>>
<?php

// Render list options (body, left)
$department_grid->ListOptions->render("body", "left", $department_grid->RowCount);
?>
	<?php if ($department_grid->DepartmentName->Visible) { // DepartmentName ?>
		<td data-name="DepartmentName" <?php echo $department_grid->DepartmentName->cellAttributes() ?>>
<?php if ($department->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $department_grid->RowCount ?>_department_DepartmentName" class="form-group">
<input type="text" data-table="department" data-field="x_DepartmentName" name="x<?php echo $department_grid->RowIndex ?>_DepartmentName" id="x<?php echo $department_grid->RowIndex ?>_DepartmentName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($department_grid->DepartmentName->getPlaceHolder()) ?>" value="<?php echo $department_grid->DepartmentName->EditValue ?>"<?php echo $department_grid->DepartmentName->editAttributes() ?>>
</span>
<input type="hidden" data-table="department" data-field="x_DepartmentName" name="o<?php echo $department_grid->RowIndex ?>_DepartmentName" id="o<?php echo $department_grid->RowIndex ?>_DepartmentName" value="<?php echo HtmlEncode($department_grid->DepartmentName->OldValue) ?>">
<?php } ?>
<?php if ($department->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $department_grid->RowCount ?>_department_DepartmentName" class="form-group">
<input type="text" data-table="department" data-field="x_DepartmentName" name="x<?php echo $department_grid->RowIndex ?>_DepartmentName" id="x<?php echo $department_grid->RowIndex ?>_DepartmentName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($department_grid->DepartmentName->getPlaceHolder()) ?>" value="<?php echo $department_grid->DepartmentName->EditValue ?>"<?php echo $department_grid->DepartmentName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($department->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $department_grid->RowCount ?>_department_DepartmentName">
<span<?php echo $department_grid->DepartmentName->viewAttributes() ?>><?php echo $department_grid->DepartmentName->getViewValue() ?></span>
</span>
<?php if (!$department->isConfirm()) { ?>
<input type="hidden" data-table="department" data-field="x_DepartmentName" name="x<?php echo $department_grid->RowIndex ?>_DepartmentName" id="x<?php echo $department_grid->RowIndex ?>_DepartmentName" value="<?php echo HtmlEncode($department_grid->DepartmentName->FormValue) ?>">
<input type="hidden" data-table="department" data-field="x_DepartmentName" name="o<?php echo $department_grid->RowIndex ?>_DepartmentName" id="o<?php echo $department_grid->RowIndex ?>_DepartmentName" value="<?php echo HtmlEncode($department_grid->DepartmentName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="department" data-field="x_DepartmentName" name="fdepartmentgrid$x<?php echo $department_grid->RowIndex ?>_DepartmentName" id="fdepartmentgrid$x<?php echo $department_grid->RowIndex ?>_DepartmentName" value="<?php echo HtmlEncode($department_grid->DepartmentName->FormValue) ?>">
<input type="hidden" data-table="department" data-field="x_DepartmentName" name="fdepartmentgrid$o<?php echo $department_grid->RowIndex ?>_DepartmentName" id="fdepartmentgrid$o<?php echo $department_grid->RowIndex ?>_DepartmentName" value="<?php echo HtmlEncode($department_grid->DepartmentName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($department->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="department" data-field="x_DepartmentCode" name="x<?php echo $department_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $department_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($department_grid->DepartmentCode->CurrentValue) ?>">
<input type="hidden" data-table="department" data-field="x_DepartmentCode" name="o<?php echo $department_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $department_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($department_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($department->RowType == ROWTYPE_EDIT || $department->CurrentMode == "edit") { ?>
<input type="hidden" data-table="department" data-field="x_DepartmentCode" name="x<?php echo $department_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $department_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($department_grid->DepartmentCode->CurrentValue) ?>">
<?php } ?>
	<?php if ($department_grid->Telephone->Visible) { // Telephone ?>
		<td data-name="Telephone" <?php echo $department_grid->Telephone->cellAttributes() ?>>
<?php if ($department->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $department_grid->RowCount ?>_department_Telephone" class="form-group">
<input type="text" data-table="department" data-field="x_Telephone" name="x<?php echo $department_grid->RowIndex ?>_Telephone" id="x<?php echo $department_grid->RowIndex ?>_Telephone" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($department_grid->Telephone->getPlaceHolder()) ?>" value="<?php echo $department_grid->Telephone->EditValue ?>"<?php echo $department_grid->Telephone->editAttributes() ?>>
</span>
<input type="hidden" data-table="department" data-field="x_Telephone" name="o<?php echo $department_grid->RowIndex ?>_Telephone" id="o<?php echo $department_grid->RowIndex ?>_Telephone" value="<?php echo HtmlEncode($department_grid->Telephone->OldValue) ?>">
<?php } ?>
<?php if ($department->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $department_grid->RowCount ?>_department_Telephone" class="form-group">
<input type="text" data-table="department" data-field="x_Telephone" name="x<?php echo $department_grid->RowIndex ?>_Telephone" id="x<?php echo $department_grid->RowIndex ?>_Telephone" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($department_grid->Telephone->getPlaceHolder()) ?>" value="<?php echo $department_grid->Telephone->EditValue ?>"<?php echo $department_grid->Telephone->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($department->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $department_grid->RowCount ?>_department_Telephone">
<span<?php echo $department_grid->Telephone->viewAttributes() ?>><?php echo $department_grid->Telephone->getViewValue() ?></span>
</span>
<?php if (!$department->isConfirm()) { ?>
<input type="hidden" data-table="department" data-field="x_Telephone" name="x<?php echo $department_grid->RowIndex ?>_Telephone" id="x<?php echo $department_grid->RowIndex ?>_Telephone" value="<?php echo HtmlEncode($department_grid->Telephone->FormValue) ?>">
<input type="hidden" data-table="department" data-field="x_Telephone" name="o<?php echo $department_grid->RowIndex ?>_Telephone" id="o<?php echo $department_grid->RowIndex ?>_Telephone" value="<?php echo HtmlEncode($department_grid->Telephone->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="department" data-field="x_Telephone" name="fdepartmentgrid$x<?php echo $department_grid->RowIndex ?>_Telephone" id="fdepartmentgrid$x<?php echo $department_grid->RowIndex ?>_Telephone" value="<?php echo HtmlEncode($department_grid->Telephone->FormValue) ?>">
<input type="hidden" data-table="department" data-field="x_Telephone" name="fdepartmentgrid$o<?php echo $department_grid->RowIndex ?>_Telephone" id="fdepartmentgrid$o<?php echo $department_grid->RowIndex ?>_Telephone" value="<?php echo HtmlEncode($department_grid->Telephone->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($department_grid->_Email->Visible) { // Email ?>
		<td data-name="_Email" <?php echo $department_grid->_Email->cellAttributes() ?>>
<?php if ($department->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $department_grid->RowCount ?>_department__Email" class="form-group">
<input type="text" data-table="department" data-field="x__Email" name="x<?php echo $department_grid->RowIndex ?>__Email" id="x<?php echo $department_grid->RowIndex ?>__Email" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($department_grid->_Email->getPlaceHolder()) ?>" value="<?php echo $department_grid->_Email->EditValue ?>"<?php echo $department_grid->_Email->editAttributes() ?>>
</span>
<input type="hidden" data-table="department" data-field="x__Email" name="o<?php echo $department_grid->RowIndex ?>__Email" id="o<?php echo $department_grid->RowIndex ?>__Email" value="<?php echo HtmlEncode($department_grid->_Email->OldValue) ?>">
<?php } ?>
<?php if ($department->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $department_grid->RowCount ?>_department__Email" class="form-group">
<input type="text" data-table="department" data-field="x__Email" name="x<?php echo $department_grid->RowIndex ?>__Email" id="x<?php echo $department_grid->RowIndex ?>__Email" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($department_grid->_Email->getPlaceHolder()) ?>" value="<?php echo $department_grid->_Email->EditValue ?>"<?php echo $department_grid->_Email->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($department->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $department_grid->RowCount ?>_department__Email">
<span<?php echo $department_grid->_Email->viewAttributes() ?>><?php echo $department_grid->_Email->getViewValue() ?></span>
</span>
<?php if (!$department->isConfirm()) { ?>
<input type="hidden" data-table="department" data-field="x__Email" name="x<?php echo $department_grid->RowIndex ?>__Email" id="x<?php echo $department_grid->RowIndex ?>__Email" value="<?php echo HtmlEncode($department_grid->_Email->FormValue) ?>">
<input type="hidden" data-table="department" data-field="x__Email" name="o<?php echo $department_grid->RowIndex ?>__Email" id="o<?php echo $department_grid->RowIndex ?>__Email" value="<?php echo HtmlEncode($department_grid->_Email->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="department" data-field="x__Email" name="fdepartmentgrid$x<?php echo $department_grid->RowIndex ?>__Email" id="fdepartmentgrid$x<?php echo $department_grid->RowIndex ?>__Email" value="<?php echo HtmlEncode($department_grid->_Email->FormValue) ?>">
<input type="hidden" data-table="department" data-field="x__Email" name="fdepartmentgrid$o<?php echo $department_grid->RowIndex ?>__Email" id="fdepartmentgrid$o<?php echo $department_grid->RowIndex ?>__Email" value="<?php echo HtmlEncode($department_grid->_Email->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($department_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $department_grid->LACode->cellAttributes() ?>>
<?php if ($department->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($department_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $department_grid->RowCount ?>_department_LACode" class="form-group">
<span<?php echo $department_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($department_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $department_grid->RowIndex ?>_LACode" name="x<?php echo $department_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($department_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $department_grid->RowCount ?>_department_LACode" class="form-group">
<?php $department_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="department" data-field="x_LACode" data-value-separator="<?php echo $department_grid->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $department_grid->RowIndex ?>_LACode" name="x<?php echo $department_grid->RowIndex ?>_LACode"<?php echo $department_grid->LACode->editAttributes() ?>>
			<?php echo $department_grid->LACode->selectOptionListHtml("x{$department_grid->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $department_grid->LACode->Lookup->getParamTag($department_grid, "p_x" . $department_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="department" data-field="x_LACode" name="o<?php echo $department_grid->RowIndex ?>_LACode" id="o<?php echo $department_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($department_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($department->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($department_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $department_grid->RowCount ?>_department_LACode" class="form-group">
<span<?php echo $department_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($department_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $department_grid->RowIndex ?>_LACode" name="x<?php echo $department_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($department_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $department_grid->RowCount ?>_department_LACode" class="form-group">
<?php $department_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="department" data-field="x_LACode" data-value-separator="<?php echo $department_grid->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $department_grid->RowIndex ?>_LACode" name="x<?php echo $department_grid->RowIndex ?>_LACode"<?php echo $department_grid->LACode->editAttributes() ?>>
			<?php echo $department_grid->LACode->selectOptionListHtml("x{$department_grid->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $department_grid->LACode->Lookup->getParamTag($department_grid, "p_x" . $department_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($department->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $department_grid->RowCount ?>_department_LACode">
<span<?php echo $department_grid->LACode->viewAttributes() ?>><?php echo $department_grid->LACode->getViewValue() ?></span>
</span>
<?php if (!$department->isConfirm()) { ?>
<input type="hidden" data-table="department" data-field="x_LACode" name="x<?php echo $department_grid->RowIndex ?>_LACode" id="x<?php echo $department_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($department_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="department" data-field="x_LACode" name="o<?php echo $department_grid->RowIndex ?>_LACode" id="o<?php echo $department_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($department_grid->LACode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="department" data-field="x_LACode" name="fdepartmentgrid$x<?php echo $department_grid->RowIndex ?>_LACode" id="fdepartmentgrid$x<?php echo $department_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($department_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="department" data-field="x_LACode" name="fdepartmentgrid$o<?php echo $department_grid->RowIndex ?>_LACode" id="fdepartmentgrid$o<?php echo $department_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($department_grid->LACode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($department_grid->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $department_grid->ProvinceCode->cellAttributes() ?>>
<?php if ($department->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($department_grid->ProvinceCode->getSessionValue() != "") { ?>
<span id="el<?php echo $department_grid->RowCount ?>_department_ProvinceCode" class="form-group">
<span<?php echo $department_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($department_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $department_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $department_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($department_grid->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $department_grid->RowCount ?>_department_ProvinceCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="department" data-field="x_ProvinceCode" data-value-separator="<?php echo $department_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $department_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $department_grid->RowIndex ?>_ProvinceCode"<?php echo $department_grid->ProvinceCode->editAttributes() ?>>
			<?php echo $department_grid->ProvinceCode->selectOptionListHtml("x{$department_grid->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $department_grid->ProvinceCode->Lookup->getParamTag($department_grid, "p_x" . $department_grid->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="department" data-field="x_ProvinceCode" name="o<?php echo $department_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $department_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($department_grid->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php if ($department->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($department_grid->ProvinceCode->getSessionValue() != "") { ?>
<span id="el<?php echo $department_grid->RowCount ?>_department_ProvinceCode" class="form-group">
<span<?php echo $department_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($department_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $department_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $department_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($department_grid->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $department_grid->RowCount ?>_department_ProvinceCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="department" data-field="x_ProvinceCode" data-value-separator="<?php echo $department_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $department_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $department_grid->RowIndex ?>_ProvinceCode"<?php echo $department_grid->ProvinceCode->editAttributes() ?>>
			<?php echo $department_grid->ProvinceCode->selectOptionListHtml("x{$department_grid->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $department_grid->ProvinceCode->Lookup->getParamTag($department_grid, "p_x" . $department_grid->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($department->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $department_grid->RowCount ?>_department_ProvinceCode">
<span<?php echo $department_grid->ProvinceCode->viewAttributes() ?>><?php echo $department_grid->ProvinceCode->getViewValue() ?></span>
</span>
<?php if (!$department->isConfirm()) { ?>
<input type="hidden" data-table="department" data-field="x_ProvinceCode" name="x<?php echo $department_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $department_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($department_grid->ProvinceCode->FormValue) ?>">
<input type="hidden" data-table="department" data-field="x_ProvinceCode" name="o<?php echo $department_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $department_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($department_grid->ProvinceCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="department" data-field="x_ProvinceCode" name="fdepartmentgrid$x<?php echo $department_grid->RowIndex ?>_ProvinceCode" id="fdepartmentgrid$x<?php echo $department_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($department_grid->ProvinceCode->FormValue) ?>">
<input type="hidden" data-table="department" data-field="x_ProvinceCode" name="fdepartmentgrid$o<?php echo $department_grid->RowIndex ?>_ProvinceCode" id="fdepartmentgrid$o<?php echo $department_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($department_grid->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$department_grid->ListOptions->render("body", "right", $department_grid->RowCount);
?>
	</tr>
<?php if ($department->RowType == ROWTYPE_ADD || $department->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdepartmentgrid", "load"], function() {
	fdepartmentgrid.updateLists(<?php echo $department_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$department_grid->isGridAdd() || $department->CurrentMode == "copy")
		if (!$department_grid->Recordset->EOF)
			$department_grid->Recordset->moveNext();
}
?>
<?php
	if ($department->CurrentMode == "add" || $department->CurrentMode == "copy" || $department->CurrentMode == "edit") {
		$department_grid->RowIndex = '$rowindex$';
		$department_grid->loadRowValues();

		// Set row properties
		$department->resetAttributes();
		$department->RowAttrs->merge(["data-rowindex" => $department_grid->RowIndex, "id" => "r0_department", "data-rowtype" => ROWTYPE_ADD]);
		$department->RowAttrs->appendClass("ew-template");
		$department->RowType = ROWTYPE_ADD;

		// Render row
		$department_grid->renderRow();

		// Render list options
		$department_grid->renderListOptions();
		$department_grid->StartRowCount = 0;
?>
	<tr <?php echo $department->rowAttributes() ?>>
<?php

// Render list options (body, left)
$department_grid->ListOptions->render("body", "left", $department_grid->RowIndex);
?>
	<?php if ($department_grid->DepartmentName->Visible) { // DepartmentName ?>
		<td data-name="DepartmentName">
<?php if (!$department->isConfirm()) { ?>
<span id="el$rowindex$_department_DepartmentName" class="form-group department_DepartmentName">
<input type="text" data-table="department" data-field="x_DepartmentName" name="x<?php echo $department_grid->RowIndex ?>_DepartmentName" id="x<?php echo $department_grid->RowIndex ?>_DepartmentName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($department_grid->DepartmentName->getPlaceHolder()) ?>" value="<?php echo $department_grid->DepartmentName->EditValue ?>"<?php echo $department_grid->DepartmentName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_department_DepartmentName" class="form-group department_DepartmentName">
<span<?php echo $department_grid->DepartmentName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($department_grid->DepartmentName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="department" data-field="x_DepartmentName" name="x<?php echo $department_grid->RowIndex ?>_DepartmentName" id="x<?php echo $department_grid->RowIndex ?>_DepartmentName" value="<?php echo HtmlEncode($department_grid->DepartmentName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="department" data-field="x_DepartmentName" name="o<?php echo $department_grid->RowIndex ?>_DepartmentName" id="o<?php echo $department_grid->RowIndex ?>_DepartmentName" value="<?php echo HtmlEncode($department_grid->DepartmentName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($department_grid->Telephone->Visible) { // Telephone ?>
		<td data-name="Telephone">
<?php if (!$department->isConfirm()) { ?>
<span id="el$rowindex$_department_Telephone" class="form-group department_Telephone">
<input type="text" data-table="department" data-field="x_Telephone" name="x<?php echo $department_grid->RowIndex ?>_Telephone" id="x<?php echo $department_grid->RowIndex ?>_Telephone" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($department_grid->Telephone->getPlaceHolder()) ?>" value="<?php echo $department_grid->Telephone->EditValue ?>"<?php echo $department_grid->Telephone->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_department_Telephone" class="form-group department_Telephone">
<span<?php echo $department_grid->Telephone->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($department_grid->Telephone->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="department" data-field="x_Telephone" name="x<?php echo $department_grid->RowIndex ?>_Telephone" id="x<?php echo $department_grid->RowIndex ?>_Telephone" value="<?php echo HtmlEncode($department_grid->Telephone->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="department" data-field="x_Telephone" name="o<?php echo $department_grid->RowIndex ?>_Telephone" id="o<?php echo $department_grid->RowIndex ?>_Telephone" value="<?php echo HtmlEncode($department_grid->Telephone->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($department_grid->_Email->Visible) { // Email ?>
		<td data-name="_Email">
<?php if (!$department->isConfirm()) { ?>
<span id="el$rowindex$_department__Email" class="form-group department__Email">
<input type="text" data-table="department" data-field="x__Email" name="x<?php echo $department_grid->RowIndex ?>__Email" id="x<?php echo $department_grid->RowIndex ?>__Email" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($department_grid->_Email->getPlaceHolder()) ?>" value="<?php echo $department_grid->_Email->EditValue ?>"<?php echo $department_grid->_Email->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_department__Email" class="form-group department__Email">
<span<?php echo $department_grid->_Email->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($department_grid->_Email->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="department" data-field="x__Email" name="x<?php echo $department_grid->RowIndex ?>__Email" id="x<?php echo $department_grid->RowIndex ?>__Email" value="<?php echo HtmlEncode($department_grid->_Email->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="department" data-field="x__Email" name="o<?php echo $department_grid->RowIndex ?>__Email" id="o<?php echo $department_grid->RowIndex ?>__Email" value="<?php echo HtmlEncode($department_grid->_Email->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($department_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if (!$department->isConfirm()) { ?>
<?php if ($department_grid->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_department_LACode" class="form-group department_LACode">
<span<?php echo $department_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($department_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $department_grid->RowIndex ?>_LACode" name="x<?php echo $department_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($department_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_department_LACode" class="form-group department_LACode">
<?php $department_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="department" data-field="x_LACode" data-value-separator="<?php echo $department_grid->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $department_grid->RowIndex ?>_LACode" name="x<?php echo $department_grid->RowIndex ?>_LACode"<?php echo $department_grid->LACode->editAttributes() ?>>
			<?php echo $department_grid->LACode->selectOptionListHtml("x{$department_grid->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $department_grid->LACode->Lookup->getParamTag($department_grid, "p_x" . $department_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_department_LACode" class="form-group department_LACode">
<span<?php echo $department_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($department_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="department" data-field="x_LACode" name="x<?php echo $department_grid->RowIndex ?>_LACode" id="x<?php echo $department_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($department_grid->LACode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="department" data-field="x_LACode" name="o<?php echo $department_grid->RowIndex ?>_LACode" id="o<?php echo $department_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($department_grid->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($department_grid->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode">
<?php if (!$department->isConfirm()) { ?>
<?php if ($department_grid->ProvinceCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_department_ProvinceCode" class="form-group department_ProvinceCode">
<span<?php echo $department_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($department_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $department_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $department_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($department_grid->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_department_ProvinceCode" class="form-group department_ProvinceCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="department" data-field="x_ProvinceCode" data-value-separator="<?php echo $department_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $department_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $department_grid->RowIndex ?>_ProvinceCode"<?php echo $department_grid->ProvinceCode->editAttributes() ?>>
			<?php echo $department_grid->ProvinceCode->selectOptionListHtml("x{$department_grid->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $department_grid->ProvinceCode->Lookup->getParamTag($department_grid, "p_x" . $department_grid->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_department_ProvinceCode" class="form-group department_ProvinceCode">
<span<?php echo $department_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($department_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="department" data-field="x_ProvinceCode" name="x<?php echo $department_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $department_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($department_grid->ProvinceCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="department" data-field="x_ProvinceCode" name="o<?php echo $department_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $department_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($department_grid->ProvinceCode->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$department_grid->ListOptions->render("body", "right", $department_grid->RowIndex);
?>
<script>
loadjs.ready(["fdepartmentgrid", "load"], function() {
	fdepartmentgrid.updateLists(<?php echo $department_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($department->CurrentMode == "add" || $department->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $department_grid->FormKeyCountName ?>" id="<?php echo $department_grid->FormKeyCountName ?>" value="<?php echo $department_grid->KeyCount ?>">
<?php echo $department_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($department->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $department_grid->FormKeyCountName ?>" id="<?php echo $department_grid->FormKeyCountName ?>" value="<?php echo $department_grid->KeyCount ?>">
<?php echo $department_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($department->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdepartmentgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($department_grid->Recordset)
	$department_grid->Recordset->Close();
?>
<?php if ($department_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $department_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($department_grid->TotalRecords == 0 && !$department->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $department_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$department_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$department_grid->terminate();
?>