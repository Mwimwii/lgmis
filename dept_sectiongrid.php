<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($dept_section_grid))
	$dept_section_grid = new dept_section_grid();

// Run the page
$dept_section_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dept_section_grid->Page_Render();
?>
<?php if (!$dept_section_grid->isExport()) { ?>
<script>
var fdept_sectiongrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fdept_sectiongrid = new ew.Form("fdept_sectiongrid", "grid");
	fdept_sectiongrid.formKeyCountName = '<?php echo $dept_section_grid->FormKeyCountName ?>';

	// Validate form
	fdept_sectiongrid.validate = function() {
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
			<?php if ($dept_section_grid->SectionName->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_grid->SectionName->caption(), $dept_section_grid->SectionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dept_section_grid->Telephone->Required) { ?>
				elm = this.getElements("x" + infix + "_Telephone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_grid->Telephone->caption(), $dept_section_grid->Telephone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dept_section_grid->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_grid->_Email->caption(), $dept_section_grid->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dept_section_grid->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_grid->ProvinceCode->caption(), $dept_section_grid->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dept_section_grid->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_grid->LACode->caption(), $dept_section_grid->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dept_section_grid->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_grid->DepartmentCode->caption(), $dept_section_grid->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fdept_sectiongrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "SectionName", false)) return false;
		if (ew.valueChanged(fobj, infix, "Telephone", false)) return false;
		if (ew.valueChanged(fobj, infix, "_Email", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProvinceCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdept_sectiongrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdept_sectiongrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdept_sectiongrid.lists["x_ProvinceCode"] = <?php echo $dept_section_grid->ProvinceCode->Lookup->toClientList($dept_section_grid) ?>;
	fdept_sectiongrid.lists["x_ProvinceCode"].options = <?php echo JsonEncode($dept_section_grid->ProvinceCode->lookupOptions()) ?>;
	fdept_sectiongrid.lists["x_LACode"] = <?php echo $dept_section_grid->LACode->Lookup->toClientList($dept_section_grid) ?>;
	fdept_sectiongrid.lists["x_LACode"].options = <?php echo JsonEncode($dept_section_grid->LACode->lookupOptions()) ?>;
	fdept_sectiongrid.lists["x_DepartmentCode"] = <?php echo $dept_section_grid->DepartmentCode->Lookup->toClientList($dept_section_grid) ?>;
	fdept_sectiongrid.lists["x_DepartmentCode"].options = <?php echo JsonEncode($dept_section_grid->DepartmentCode->lookupOptions()) ?>;
	loadjs.done("fdept_sectiongrid");
});
</script>
<?php } ?>
<?php
$dept_section_grid->renderOtherOptions();
?>
<?php if ($dept_section_grid->TotalRecords > 0 || $dept_section->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($dept_section_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> dept_section">
<?php if ($dept_section_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $dept_section_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdept_sectiongrid" class="ew-form ew-list-form form-inline">
<div id="gmp_dept_section" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_dept_sectiongrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$dept_section->RowType = ROWTYPE_HEADER;

// Render list options
$dept_section_grid->renderListOptions();

// Render list options (header, left)
$dept_section_grid->ListOptions->render("header", "left");
?>
<?php if ($dept_section_grid->SectionName->Visible) { // SectionName ?>
	<?php if ($dept_section_grid->SortUrl($dept_section_grid->SectionName) == "") { ?>
		<th data-name="SectionName" class="<?php echo $dept_section_grid->SectionName->headerCellClass() ?>"><div id="elh_dept_section_SectionName" class="dept_section_SectionName"><div class="ew-table-header-caption"><?php echo $dept_section_grid->SectionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionName" class="<?php echo $dept_section_grid->SectionName->headerCellClass() ?>"><div><div id="elh_dept_section_SectionName" class="dept_section_SectionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dept_section_grid->SectionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($dept_section_grid->SectionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dept_section_grid->SectionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dept_section_grid->Telephone->Visible) { // Telephone ?>
	<?php if ($dept_section_grid->SortUrl($dept_section_grid->Telephone) == "") { ?>
		<th data-name="Telephone" class="<?php echo $dept_section_grid->Telephone->headerCellClass() ?>"><div id="elh_dept_section_Telephone" class="dept_section_Telephone"><div class="ew-table-header-caption"><?php echo $dept_section_grid->Telephone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Telephone" class="<?php echo $dept_section_grid->Telephone->headerCellClass() ?>"><div><div id="elh_dept_section_Telephone" class="dept_section_Telephone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dept_section_grid->Telephone->caption() ?></span><span class="ew-table-header-sort"><?php if ($dept_section_grid->Telephone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dept_section_grid->Telephone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dept_section_grid->_Email->Visible) { // Email ?>
	<?php if ($dept_section_grid->SortUrl($dept_section_grid->_Email) == "") { ?>
		<th data-name="_Email" class="<?php echo $dept_section_grid->_Email->headerCellClass() ?>"><div id="elh_dept_section__Email" class="dept_section__Email"><div class="ew-table-header-caption"><?php echo $dept_section_grid->_Email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_Email" class="<?php echo $dept_section_grid->_Email->headerCellClass() ?>"><div><div id="elh_dept_section__Email" class="dept_section__Email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dept_section_grid->_Email->caption() ?></span><span class="ew-table-header-sort"><?php if ($dept_section_grid->_Email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dept_section_grid->_Email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dept_section_grid->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($dept_section_grid->SortUrl($dept_section_grid->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $dept_section_grid->ProvinceCode->headerCellClass() ?>"><div id="elh_dept_section_ProvinceCode" class="dept_section_ProvinceCode"><div class="ew-table-header-caption"><?php echo $dept_section_grid->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $dept_section_grid->ProvinceCode->headerCellClass() ?>"><div><div id="elh_dept_section_ProvinceCode" class="dept_section_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dept_section_grid->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($dept_section_grid->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dept_section_grid->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dept_section_grid->LACode->Visible) { // LACode ?>
	<?php if ($dept_section_grid->SortUrl($dept_section_grid->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $dept_section_grid->LACode->headerCellClass() ?>"><div id="elh_dept_section_LACode" class="dept_section_LACode"><div class="ew-table-header-caption"><?php echo $dept_section_grid->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $dept_section_grid->LACode->headerCellClass() ?>"><div><div id="elh_dept_section_LACode" class="dept_section_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dept_section_grid->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($dept_section_grid->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dept_section_grid->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dept_section_grid->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($dept_section_grid->SortUrl($dept_section_grid->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $dept_section_grid->DepartmentCode->headerCellClass() ?>"><div id="elh_dept_section_DepartmentCode" class="dept_section_DepartmentCode"><div class="ew-table-header-caption"><?php echo $dept_section_grid->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $dept_section_grid->DepartmentCode->headerCellClass() ?>"><div><div id="elh_dept_section_DepartmentCode" class="dept_section_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dept_section_grid->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($dept_section_grid->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dept_section_grid->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$dept_section_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$dept_section_grid->StartRecord = 1;
$dept_section_grid->StopRecord = $dept_section_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($dept_section->isConfirm() || $dept_section_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($dept_section_grid->FormKeyCountName) && ($dept_section_grid->isGridAdd() || $dept_section_grid->isGridEdit() || $dept_section->isConfirm())) {
		$dept_section_grid->KeyCount = $CurrentForm->getValue($dept_section_grid->FormKeyCountName);
		$dept_section_grid->StopRecord = $dept_section_grid->StartRecord + $dept_section_grid->KeyCount - 1;
	}
}
$dept_section_grid->RecordCount = $dept_section_grid->StartRecord - 1;
if ($dept_section_grid->Recordset && !$dept_section_grid->Recordset->EOF) {
	$dept_section_grid->Recordset->moveFirst();
	$selectLimit = $dept_section_grid->UseSelectLimit;
	if (!$selectLimit && $dept_section_grid->StartRecord > 1)
		$dept_section_grid->Recordset->move($dept_section_grid->StartRecord - 1);
} elseif (!$dept_section->AllowAddDeleteRow && $dept_section_grid->StopRecord == 0) {
	$dept_section_grid->StopRecord = $dept_section->GridAddRowCount;
}

// Initialize aggregate
$dept_section->RowType = ROWTYPE_AGGREGATEINIT;
$dept_section->resetAttributes();
$dept_section_grid->renderRow();
if ($dept_section_grid->isGridAdd())
	$dept_section_grid->RowIndex = 0;
if ($dept_section_grid->isGridEdit())
	$dept_section_grid->RowIndex = 0;
while ($dept_section_grid->RecordCount < $dept_section_grid->StopRecord) {
	$dept_section_grid->RecordCount++;
	if ($dept_section_grid->RecordCount >= $dept_section_grid->StartRecord) {
		$dept_section_grid->RowCount++;
		if ($dept_section_grid->isGridAdd() || $dept_section_grid->isGridEdit() || $dept_section->isConfirm()) {
			$dept_section_grid->RowIndex++;
			$CurrentForm->Index = $dept_section_grid->RowIndex;
			if ($CurrentForm->hasValue($dept_section_grid->FormActionName) && ($dept_section->isConfirm() || $dept_section_grid->EventCancelled))
				$dept_section_grid->RowAction = strval($CurrentForm->getValue($dept_section_grid->FormActionName));
			elseif ($dept_section_grid->isGridAdd())
				$dept_section_grid->RowAction = "insert";
			else
				$dept_section_grid->RowAction = "";
		}

		// Set up key count
		$dept_section_grid->KeyCount = $dept_section_grid->RowIndex;

		// Init row class and style
		$dept_section->resetAttributes();
		$dept_section->CssClass = "";
		if ($dept_section_grid->isGridAdd()) {
			if ($dept_section->CurrentMode == "copy") {
				$dept_section_grid->loadRowValues($dept_section_grid->Recordset); // Load row values
				$dept_section_grid->setRecordKey($dept_section_grid->RowOldKey, $dept_section_grid->Recordset); // Set old record key
			} else {
				$dept_section_grid->loadRowValues(); // Load default values
				$dept_section_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$dept_section_grid->loadRowValues($dept_section_grid->Recordset); // Load row values
		}
		$dept_section->RowType = ROWTYPE_VIEW; // Render view
		if ($dept_section_grid->isGridAdd()) // Grid add
			$dept_section->RowType = ROWTYPE_ADD; // Render add
		if ($dept_section_grid->isGridAdd() && $dept_section->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$dept_section_grid->restoreCurrentRowFormValues($dept_section_grid->RowIndex); // Restore form values
		if ($dept_section_grid->isGridEdit()) { // Grid edit
			if ($dept_section->EventCancelled)
				$dept_section_grid->restoreCurrentRowFormValues($dept_section_grid->RowIndex); // Restore form values
			if ($dept_section_grid->RowAction == "insert")
				$dept_section->RowType = ROWTYPE_ADD; // Render add
			else
				$dept_section->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($dept_section_grid->isGridEdit() && ($dept_section->RowType == ROWTYPE_EDIT || $dept_section->RowType == ROWTYPE_ADD) && $dept_section->EventCancelled) // Update failed
			$dept_section_grid->restoreCurrentRowFormValues($dept_section_grid->RowIndex); // Restore form values
		if ($dept_section->RowType == ROWTYPE_EDIT) // Edit row
			$dept_section_grid->EditRowCount++;
		if ($dept_section->isConfirm()) // Confirm row
			$dept_section_grid->restoreCurrentRowFormValues($dept_section_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$dept_section->RowAttrs->merge(["data-rowindex" => $dept_section_grid->RowCount, "id" => "r" . $dept_section_grid->RowCount . "_dept_section", "data-rowtype" => $dept_section->RowType]);

		// Render row
		$dept_section_grid->renderRow();

		// Render list options
		$dept_section_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($dept_section_grid->RowAction != "delete" && $dept_section_grid->RowAction != "insertdelete" && !($dept_section_grid->RowAction == "insert" && $dept_section->isConfirm() && $dept_section_grid->emptyRow())) {
?>
	<tr <?php echo $dept_section->rowAttributes() ?>>
<?php

// Render list options (body, left)
$dept_section_grid->ListOptions->render("body", "left", $dept_section_grid->RowCount);
?>
	<?php if ($dept_section_grid->SectionName->Visible) { // SectionName ?>
		<td data-name="SectionName" <?php echo $dept_section_grid->SectionName->cellAttributes() ?>>
<?php if ($dept_section->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dept_section_grid->RowCount ?>_dept_section_SectionName" class="form-group">
<input type="text" data-table="dept_section" data-field="x_SectionName" name="x<?php echo $dept_section_grid->RowIndex ?>_SectionName" id="x<?php echo $dept_section_grid->RowIndex ?>_SectionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dept_section_grid->SectionName->getPlaceHolder()) ?>" value="<?php echo $dept_section_grid->SectionName->EditValue ?>"<?php echo $dept_section_grid->SectionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="dept_section" data-field="x_SectionName" name="o<?php echo $dept_section_grid->RowIndex ?>_SectionName" id="o<?php echo $dept_section_grid->RowIndex ?>_SectionName" value="<?php echo HtmlEncode($dept_section_grid->SectionName->OldValue) ?>">
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dept_section_grid->RowCount ?>_dept_section_SectionName" class="form-group">
<input type="text" data-table="dept_section" data-field="x_SectionName" name="x<?php echo $dept_section_grid->RowIndex ?>_SectionName" id="x<?php echo $dept_section_grid->RowIndex ?>_SectionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dept_section_grid->SectionName->getPlaceHolder()) ?>" value="<?php echo $dept_section_grid->SectionName->EditValue ?>"<?php echo $dept_section_grid->SectionName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dept_section_grid->RowCount ?>_dept_section_SectionName">
<span<?php echo $dept_section_grid->SectionName->viewAttributes() ?>><?php echo $dept_section_grid->SectionName->getViewValue() ?></span>
</span>
<?php if (!$dept_section->isConfirm()) { ?>
<input type="hidden" data-table="dept_section" data-field="x_SectionName" name="x<?php echo $dept_section_grid->RowIndex ?>_SectionName" id="x<?php echo $dept_section_grid->RowIndex ?>_SectionName" value="<?php echo HtmlEncode($dept_section_grid->SectionName->FormValue) ?>">
<input type="hidden" data-table="dept_section" data-field="x_SectionName" name="o<?php echo $dept_section_grid->RowIndex ?>_SectionName" id="o<?php echo $dept_section_grid->RowIndex ?>_SectionName" value="<?php echo HtmlEncode($dept_section_grid->SectionName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="dept_section" data-field="x_SectionName" name="fdept_sectiongrid$x<?php echo $dept_section_grid->RowIndex ?>_SectionName" id="fdept_sectiongrid$x<?php echo $dept_section_grid->RowIndex ?>_SectionName" value="<?php echo HtmlEncode($dept_section_grid->SectionName->FormValue) ?>">
<input type="hidden" data-table="dept_section" data-field="x_SectionName" name="fdept_sectiongrid$o<?php echo $dept_section_grid->RowIndex ?>_SectionName" id="fdept_sectiongrid$o<?php echo $dept_section_grid->RowIndex ?>_SectionName" value="<?php echo HtmlEncode($dept_section_grid->SectionName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="dept_section" data-field="x_SectionCode" name="x<?php echo $dept_section_grid->RowIndex ?>_SectionCode" id="x<?php echo $dept_section_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($dept_section_grid->SectionCode->CurrentValue) ?>">
<input type="hidden" data-table="dept_section" data-field="x_SectionCode" name="o<?php echo $dept_section_grid->RowIndex ?>_SectionCode" id="o<?php echo $dept_section_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($dept_section_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_EDIT || $dept_section->CurrentMode == "edit") { ?>
<input type="hidden" data-table="dept_section" data-field="x_SectionCode" name="x<?php echo $dept_section_grid->RowIndex ?>_SectionCode" id="x<?php echo $dept_section_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($dept_section_grid->SectionCode->CurrentValue) ?>">
<?php } ?>
	<?php if ($dept_section_grid->Telephone->Visible) { // Telephone ?>
		<td data-name="Telephone" <?php echo $dept_section_grid->Telephone->cellAttributes() ?>>
<?php if ($dept_section->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dept_section_grid->RowCount ?>_dept_section_Telephone" class="form-group">
<input type="text" data-table="dept_section" data-field="x_Telephone" name="x<?php echo $dept_section_grid->RowIndex ?>_Telephone" id="x<?php echo $dept_section_grid->RowIndex ?>_Telephone" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dept_section_grid->Telephone->getPlaceHolder()) ?>" value="<?php echo $dept_section_grid->Telephone->EditValue ?>"<?php echo $dept_section_grid->Telephone->editAttributes() ?>>
</span>
<input type="hidden" data-table="dept_section" data-field="x_Telephone" name="o<?php echo $dept_section_grid->RowIndex ?>_Telephone" id="o<?php echo $dept_section_grid->RowIndex ?>_Telephone" value="<?php echo HtmlEncode($dept_section_grid->Telephone->OldValue) ?>">
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dept_section_grid->RowCount ?>_dept_section_Telephone" class="form-group">
<input type="text" data-table="dept_section" data-field="x_Telephone" name="x<?php echo $dept_section_grid->RowIndex ?>_Telephone" id="x<?php echo $dept_section_grid->RowIndex ?>_Telephone" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dept_section_grid->Telephone->getPlaceHolder()) ?>" value="<?php echo $dept_section_grid->Telephone->EditValue ?>"<?php echo $dept_section_grid->Telephone->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dept_section_grid->RowCount ?>_dept_section_Telephone">
<span<?php echo $dept_section_grid->Telephone->viewAttributes() ?>><?php echo $dept_section_grid->Telephone->getViewValue() ?></span>
</span>
<?php if (!$dept_section->isConfirm()) { ?>
<input type="hidden" data-table="dept_section" data-field="x_Telephone" name="x<?php echo $dept_section_grid->RowIndex ?>_Telephone" id="x<?php echo $dept_section_grid->RowIndex ?>_Telephone" value="<?php echo HtmlEncode($dept_section_grid->Telephone->FormValue) ?>">
<input type="hidden" data-table="dept_section" data-field="x_Telephone" name="o<?php echo $dept_section_grid->RowIndex ?>_Telephone" id="o<?php echo $dept_section_grid->RowIndex ?>_Telephone" value="<?php echo HtmlEncode($dept_section_grid->Telephone->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="dept_section" data-field="x_Telephone" name="fdept_sectiongrid$x<?php echo $dept_section_grid->RowIndex ?>_Telephone" id="fdept_sectiongrid$x<?php echo $dept_section_grid->RowIndex ?>_Telephone" value="<?php echo HtmlEncode($dept_section_grid->Telephone->FormValue) ?>">
<input type="hidden" data-table="dept_section" data-field="x_Telephone" name="fdept_sectiongrid$o<?php echo $dept_section_grid->RowIndex ?>_Telephone" id="fdept_sectiongrid$o<?php echo $dept_section_grid->RowIndex ?>_Telephone" value="<?php echo HtmlEncode($dept_section_grid->Telephone->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dept_section_grid->_Email->Visible) { // Email ?>
		<td data-name="_Email" <?php echo $dept_section_grid->_Email->cellAttributes() ?>>
<?php if ($dept_section->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dept_section_grid->RowCount ?>_dept_section__Email" class="form-group">
<input type="text" data-table="dept_section" data-field="x__Email" name="x<?php echo $dept_section_grid->RowIndex ?>__Email" id="x<?php echo $dept_section_grid->RowIndex ?>__Email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dept_section_grid->_Email->getPlaceHolder()) ?>" value="<?php echo $dept_section_grid->_Email->EditValue ?>"<?php echo $dept_section_grid->_Email->editAttributes() ?>>
</span>
<input type="hidden" data-table="dept_section" data-field="x__Email" name="o<?php echo $dept_section_grid->RowIndex ?>__Email" id="o<?php echo $dept_section_grid->RowIndex ?>__Email" value="<?php echo HtmlEncode($dept_section_grid->_Email->OldValue) ?>">
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dept_section_grid->RowCount ?>_dept_section__Email" class="form-group">
<input type="text" data-table="dept_section" data-field="x__Email" name="x<?php echo $dept_section_grid->RowIndex ?>__Email" id="x<?php echo $dept_section_grid->RowIndex ?>__Email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dept_section_grid->_Email->getPlaceHolder()) ?>" value="<?php echo $dept_section_grid->_Email->EditValue ?>"<?php echo $dept_section_grid->_Email->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dept_section_grid->RowCount ?>_dept_section__Email">
<span<?php echo $dept_section_grid->_Email->viewAttributes() ?>><?php echo $dept_section_grid->_Email->getViewValue() ?></span>
</span>
<?php if (!$dept_section->isConfirm()) { ?>
<input type="hidden" data-table="dept_section" data-field="x__Email" name="x<?php echo $dept_section_grid->RowIndex ?>__Email" id="x<?php echo $dept_section_grid->RowIndex ?>__Email" value="<?php echo HtmlEncode($dept_section_grid->_Email->FormValue) ?>">
<input type="hidden" data-table="dept_section" data-field="x__Email" name="o<?php echo $dept_section_grid->RowIndex ?>__Email" id="o<?php echo $dept_section_grid->RowIndex ?>__Email" value="<?php echo HtmlEncode($dept_section_grid->_Email->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="dept_section" data-field="x__Email" name="fdept_sectiongrid$x<?php echo $dept_section_grid->RowIndex ?>__Email" id="fdept_sectiongrid$x<?php echo $dept_section_grid->RowIndex ?>__Email" value="<?php echo HtmlEncode($dept_section_grid->_Email->FormValue) ?>">
<input type="hidden" data-table="dept_section" data-field="x__Email" name="fdept_sectiongrid$o<?php echo $dept_section_grid->RowIndex ?>__Email" id="fdept_sectiongrid$o<?php echo $dept_section_grid->RowIndex ?>__Email" value="<?php echo HtmlEncode($dept_section_grid->_Email->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dept_section_grid->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $dept_section_grid->ProvinceCode->cellAttributes() ?>>
<?php if ($dept_section->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($dept_section_grid->ProvinceCode->getSessionValue() != "") { ?>
<span id="el<?php echo $dept_section_grid->RowCount ?>_dept_section_ProvinceCode" class="form-group">
<span<?php echo $dept_section_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($dept_section_grid->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $dept_section_grid->RowCount ?>_dept_section_ProvinceCode" class="form-group">
<?php $dept_section_grid->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dept_section" data-field="x_ProvinceCode" data-value-separator="<?php echo $dept_section_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode"<?php echo $dept_section_grid->ProvinceCode->editAttributes() ?>>
			<?php echo $dept_section_grid->ProvinceCode->selectOptionListHtml("x{$dept_section_grid->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $dept_section_grid->ProvinceCode->Lookup->getParamTag($dept_section_grid, "p_x" . $dept_section_grid->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="dept_section" data-field="x_ProvinceCode" name="o<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($dept_section_grid->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($dept_section_grid->ProvinceCode->getSessionValue() != "") { ?>
<span id="el<?php echo $dept_section_grid->RowCount ?>_dept_section_ProvinceCode" class="form-group">
<span<?php echo $dept_section_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($dept_section_grid->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $dept_section_grid->RowCount ?>_dept_section_ProvinceCode" class="form-group">
<?php $dept_section_grid->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dept_section" data-field="x_ProvinceCode" data-value-separator="<?php echo $dept_section_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode"<?php echo $dept_section_grid->ProvinceCode->editAttributes() ?>>
			<?php echo $dept_section_grid->ProvinceCode->selectOptionListHtml("x{$dept_section_grid->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $dept_section_grid->ProvinceCode->Lookup->getParamTag($dept_section_grid, "p_x" . $dept_section_grid->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dept_section_grid->RowCount ?>_dept_section_ProvinceCode">
<span<?php echo $dept_section_grid->ProvinceCode->viewAttributes() ?>><?php echo $dept_section_grid->ProvinceCode->getViewValue() ?></span>
</span>
<?php if (!$dept_section->isConfirm()) { ?>
<input type="hidden" data-table="dept_section" data-field="x_ProvinceCode" name="x<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($dept_section_grid->ProvinceCode->FormValue) ?>">
<input type="hidden" data-table="dept_section" data-field="x_ProvinceCode" name="o<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($dept_section_grid->ProvinceCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="dept_section" data-field="x_ProvinceCode" name="fdept_sectiongrid$x<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode" id="fdept_sectiongrid$x<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($dept_section_grid->ProvinceCode->FormValue) ?>">
<input type="hidden" data-table="dept_section" data-field="x_ProvinceCode" name="fdept_sectiongrid$o<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode" id="fdept_sectiongrid$o<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($dept_section_grid->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dept_section_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $dept_section_grid->LACode->cellAttributes() ?>>
<?php if ($dept_section->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($dept_section_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $dept_section_grid->RowCount ?>_dept_section_LACode" class="form-group">
<span<?php echo $dept_section_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $dept_section_grid->RowIndex ?>_LACode" name="x<?php echo $dept_section_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($dept_section_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $dept_section_grid->RowCount ?>_dept_section_LACode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dept_section" data-field="x_LACode" data-value-separator="<?php echo $dept_section_grid->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $dept_section_grid->RowIndex ?>_LACode" name="x<?php echo $dept_section_grid->RowIndex ?>_LACode"<?php echo $dept_section_grid->LACode->editAttributes() ?>>
			<?php echo $dept_section_grid->LACode->selectOptionListHtml("x{$dept_section_grid->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $dept_section_grid->LACode->Lookup->getParamTag($dept_section_grid, "p_x" . $dept_section_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="dept_section" data-field="x_LACode" name="o<?php echo $dept_section_grid->RowIndex ?>_LACode" id="o<?php echo $dept_section_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($dept_section_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($dept_section_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $dept_section_grid->RowCount ?>_dept_section_LACode" class="form-group">
<span<?php echo $dept_section_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $dept_section_grid->RowIndex ?>_LACode" name="x<?php echo $dept_section_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($dept_section_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $dept_section_grid->RowCount ?>_dept_section_LACode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dept_section" data-field="x_LACode" data-value-separator="<?php echo $dept_section_grid->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $dept_section_grid->RowIndex ?>_LACode" name="x<?php echo $dept_section_grid->RowIndex ?>_LACode"<?php echo $dept_section_grid->LACode->editAttributes() ?>>
			<?php echo $dept_section_grid->LACode->selectOptionListHtml("x{$dept_section_grid->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $dept_section_grid->LACode->Lookup->getParamTag($dept_section_grid, "p_x" . $dept_section_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dept_section_grid->RowCount ?>_dept_section_LACode">
<span<?php echo $dept_section_grid->LACode->viewAttributes() ?>><?php echo $dept_section_grid->LACode->getViewValue() ?></span>
</span>
<?php if (!$dept_section->isConfirm()) { ?>
<input type="hidden" data-table="dept_section" data-field="x_LACode" name="x<?php echo $dept_section_grid->RowIndex ?>_LACode" id="x<?php echo $dept_section_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($dept_section_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="dept_section" data-field="x_LACode" name="o<?php echo $dept_section_grid->RowIndex ?>_LACode" id="o<?php echo $dept_section_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($dept_section_grid->LACode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="dept_section" data-field="x_LACode" name="fdept_sectiongrid$x<?php echo $dept_section_grid->RowIndex ?>_LACode" id="fdept_sectiongrid$x<?php echo $dept_section_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($dept_section_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="dept_section" data-field="x_LACode" name="fdept_sectiongrid$o<?php echo $dept_section_grid->RowIndex ?>_LACode" id="fdept_sectiongrid$o<?php echo $dept_section_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($dept_section_grid->LACode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dept_section_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $dept_section_grid->DepartmentCode->cellAttributes() ?>>
<?php if ($dept_section->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($dept_section_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $dept_section_grid->RowCount ?>_dept_section_DepartmentCode" class="form-group">
<span<?php echo $dept_section_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($dept_section_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $dept_section_grid->RowCount ?>_dept_section_DepartmentCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dept_section" data-field="x_DepartmentCode" data-value-separator="<?php echo $dept_section_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode"<?php echo $dept_section_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $dept_section_grid->DepartmentCode->selectOptionListHtml("x{$dept_section_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $dept_section_grid->DepartmentCode->Lookup->getParamTag($dept_section_grid, "p_x" . $dept_section_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="dept_section" data-field="x_DepartmentCode" name="o<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($dept_section_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($dept_section_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $dept_section_grid->RowCount ?>_dept_section_DepartmentCode" class="form-group">
<span<?php echo $dept_section_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($dept_section_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $dept_section_grid->RowCount ?>_dept_section_DepartmentCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dept_section" data-field="x_DepartmentCode" data-value-separator="<?php echo $dept_section_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode"<?php echo $dept_section_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $dept_section_grid->DepartmentCode->selectOptionListHtml("x{$dept_section_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $dept_section_grid->DepartmentCode->Lookup->getParamTag($dept_section_grid, "p_x" . $dept_section_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dept_section_grid->RowCount ?>_dept_section_DepartmentCode">
<span<?php echo $dept_section_grid->DepartmentCode->viewAttributes() ?>><?php echo $dept_section_grid->DepartmentCode->getViewValue() ?></span>
</span>
<?php if (!$dept_section->isConfirm()) { ?>
<input type="hidden" data-table="dept_section" data-field="x_DepartmentCode" name="x<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($dept_section_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="dept_section" data-field="x_DepartmentCode" name="o<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($dept_section_grid->DepartmentCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="dept_section" data-field="x_DepartmentCode" name="fdept_sectiongrid$x<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode" id="fdept_sectiongrid$x<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($dept_section_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="dept_section" data-field="x_DepartmentCode" name="fdept_sectiongrid$o<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode" id="fdept_sectiongrid$o<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($dept_section_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$dept_section_grid->ListOptions->render("body", "right", $dept_section_grid->RowCount);
?>
	</tr>
<?php if ($dept_section->RowType == ROWTYPE_ADD || $dept_section->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdept_sectiongrid", "load"], function() {
	fdept_sectiongrid.updateLists(<?php echo $dept_section_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$dept_section_grid->isGridAdd() || $dept_section->CurrentMode == "copy")
		if (!$dept_section_grid->Recordset->EOF)
			$dept_section_grid->Recordset->moveNext();
}
?>
<?php
	if ($dept_section->CurrentMode == "add" || $dept_section->CurrentMode == "copy" || $dept_section->CurrentMode == "edit") {
		$dept_section_grid->RowIndex = '$rowindex$';
		$dept_section_grid->loadRowValues();

		// Set row properties
		$dept_section->resetAttributes();
		$dept_section->RowAttrs->merge(["data-rowindex" => $dept_section_grid->RowIndex, "id" => "r0_dept_section", "data-rowtype" => ROWTYPE_ADD]);
		$dept_section->RowAttrs->appendClass("ew-template");
		$dept_section->RowType = ROWTYPE_ADD;

		// Render row
		$dept_section_grid->renderRow();

		// Render list options
		$dept_section_grid->renderListOptions();
		$dept_section_grid->StartRowCount = 0;
?>
	<tr <?php echo $dept_section->rowAttributes() ?>>
<?php

// Render list options (body, left)
$dept_section_grid->ListOptions->render("body", "left", $dept_section_grid->RowIndex);
?>
	<?php if ($dept_section_grid->SectionName->Visible) { // SectionName ?>
		<td data-name="SectionName">
<?php if (!$dept_section->isConfirm()) { ?>
<span id="el$rowindex$_dept_section_SectionName" class="form-group dept_section_SectionName">
<input type="text" data-table="dept_section" data-field="x_SectionName" name="x<?php echo $dept_section_grid->RowIndex ?>_SectionName" id="x<?php echo $dept_section_grid->RowIndex ?>_SectionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dept_section_grid->SectionName->getPlaceHolder()) ?>" value="<?php echo $dept_section_grid->SectionName->EditValue ?>"<?php echo $dept_section_grid->SectionName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_dept_section_SectionName" class="form-group dept_section_SectionName">
<span<?php echo $dept_section_grid->SectionName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_grid->SectionName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="dept_section" data-field="x_SectionName" name="x<?php echo $dept_section_grid->RowIndex ?>_SectionName" id="x<?php echo $dept_section_grid->RowIndex ?>_SectionName" value="<?php echo HtmlEncode($dept_section_grid->SectionName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="dept_section" data-field="x_SectionName" name="o<?php echo $dept_section_grid->RowIndex ?>_SectionName" id="o<?php echo $dept_section_grid->RowIndex ?>_SectionName" value="<?php echo HtmlEncode($dept_section_grid->SectionName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dept_section_grid->Telephone->Visible) { // Telephone ?>
		<td data-name="Telephone">
<?php if (!$dept_section->isConfirm()) { ?>
<span id="el$rowindex$_dept_section_Telephone" class="form-group dept_section_Telephone">
<input type="text" data-table="dept_section" data-field="x_Telephone" name="x<?php echo $dept_section_grid->RowIndex ?>_Telephone" id="x<?php echo $dept_section_grid->RowIndex ?>_Telephone" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dept_section_grid->Telephone->getPlaceHolder()) ?>" value="<?php echo $dept_section_grid->Telephone->EditValue ?>"<?php echo $dept_section_grid->Telephone->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_dept_section_Telephone" class="form-group dept_section_Telephone">
<span<?php echo $dept_section_grid->Telephone->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_grid->Telephone->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="dept_section" data-field="x_Telephone" name="x<?php echo $dept_section_grid->RowIndex ?>_Telephone" id="x<?php echo $dept_section_grid->RowIndex ?>_Telephone" value="<?php echo HtmlEncode($dept_section_grid->Telephone->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="dept_section" data-field="x_Telephone" name="o<?php echo $dept_section_grid->RowIndex ?>_Telephone" id="o<?php echo $dept_section_grid->RowIndex ?>_Telephone" value="<?php echo HtmlEncode($dept_section_grid->Telephone->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dept_section_grid->_Email->Visible) { // Email ?>
		<td data-name="_Email">
<?php if (!$dept_section->isConfirm()) { ?>
<span id="el$rowindex$_dept_section__Email" class="form-group dept_section__Email">
<input type="text" data-table="dept_section" data-field="x__Email" name="x<?php echo $dept_section_grid->RowIndex ?>__Email" id="x<?php echo $dept_section_grid->RowIndex ?>__Email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dept_section_grid->_Email->getPlaceHolder()) ?>" value="<?php echo $dept_section_grid->_Email->EditValue ?>"<?php echo $dept_section_grid->_Email->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_dept_section__Email" class="form-group dept_section__Email">
<span<?php echo $dept_section_grid->_Email->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_grid->_Email->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="dept_section" data-field="x__Email" name="x<?php echo $dept_section_grid->RowIndex ?>__Email" id="x<?php echo $dept_section_grid->RowIndex ?>__Email" value="<?php echo HtmlEncode($dept_section_grid->_Email->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="dept_section" data-field="x__Email" name="o<?php echo $dept_section_grid->RowIndex ?>__Email" id="o<?php echo $dept_section_grid->RowIndex ?>__Email" value="<?php echo HtmlEncode($dept_section_grid->_Email->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dept_section_grid->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode">
<?php if (!$dept_section->isConfirm()) { ?>
<?php if ($dept_section_grid->ProvinceCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_dept_section_ProvinceCode" class="form-group dept_section_ProvinceCode">
<span<?php echo $dept_section_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($dept_section_grid->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_dept_section_ProvinceCode" class="form-group dept_section_ProvinceCode">
<?php $dept_section_grid->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dept_section" data-field="x_ProvinceCode" data-value-separator="<?php echo $dept_section_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode"<?php echo $dept_section_grid->ProvinceCode->editAttributes() ?>>
			<?php echo $dept_section_grid->ProvinceCode->selectOptionListHtml("x{$dept_section_grid->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $dept_section_grid->ProvinceCode->Lookup->getParamTag($dept_section_grid, "p_x" . $dept_section_grid->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_dept_section_ProvinceCode" class="form-group dept_section_ProvinceCode">
<span<?php echo $dept_section_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="dept_section" data-field="x_ProvinceCode" name="x<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($dept_section_grid->ProvinceCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="dept_section" data-field="x_ProvinceCode" name="o<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $dept_section_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($dept_section_grid->ProvinceCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dept_section_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if (!$dept_section->isConfirm()) { ?>
<?php if ($dept_section_grid->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_dept_section_LACode" class="form-group dept_section_LACode">
<span<?php echo $dept_section_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $dept_section_grid->RowIndex ?>_LACode" name="x<?php echo $dept_section_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($dept_section_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_dept_section_LACode" class="form-group dept_section_LACode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dept_section" data-field="x_LACode" data-value-separator="<?php echo $dept_section_grid->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $dept_section_grid->RowIndex ?>_LACode" name="x<?php echo $dept_section_grid->RowIndex ?>_LACode"<?php echo $dept_section_grid->LACode->editAttributes() ?>>
			<?php echo $dept_section_grid->LACode->selectOptionListHtml("x{$dept_section_grid->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $dept_section_grid->LACode->Lookup->getParamTag($dept_section_grid, "p_x" . $dept_section_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_dept_section_LACode" class="form-group dept_section_LACode">
<span<?php echo $dept_section_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="dept_section" data-field="x_LACode" name="x<?php echo $dept_section_grid->RowIndex ?>_LACode" id="x<?php echo $dept_section_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($dept_section_grid->LACode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="dept_section" data-field="x_LACode" name="o<?php echo $dept_section_grid->RowIndex ?>_LACode" id="o<?php echo $dept_section_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($dept_section_grid->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dept_section_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<?php if (!$dept_section->isConfirm()) { ?>
<?php if ($dept_section_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_dept_section_DepartmentCode" class="form-group dept_section_DepartmentCode">
<span<?php echo $dept_section_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($dept_section_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_dept_section_DepartmentCode" class="form-group dept_section_DepartmentCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dept_section" data-field="x_DepartmentCode" data-value-separator="<?php echo $dept_section_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode"<?php echo $dept_section_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $dept_section_grid->DepartmentCode->selectOptionListHtml("x{$dept_section_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $dept_section_grid->DepartmentCode->Lookup->getParamTag($dept_section_grid, "p_x" . $dept_section_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_dept_section_DepartmentCode" class="form-group dept_section_DepartmentCode">
<span<?php echo $dept_section_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="dept_section" data-field="x_DepartmentCode" name="x<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($dept_section_grid->DepartmentCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="dept_section" data-field="x_DepartmentCode" name="o<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $dept_section_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($dept_section_grid->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$dept_section_grid->ListOptions->render("body", "right", $dept_section_grid->RowIndex);
?>
<script>
loadjs.ready(["fdept_sectiongrid", "load"], function() {
	fdept_sectiongrid.updateLists(<?php echo $dept_section_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($dept_section->CurrentMode == "add" || $dept_section->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $dept_section_grid->FormKeyCountName ?>" id="<?php echo $dept_section_grid->FormKeyCountName ?>" value="<?php echo $dept_section_grid->KeyCount ?>">
<?php echo $dept_section_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($dept_section->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $dept_section_grid->FormKeyCountName ?>" id="<?php echo $dept_section_grid->FormKeyCountName ?>" value="<?php echo $dept_section_grid->KeyCount ?>">
<?php echo $dept_section_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($dept_section->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdept_sectiongrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($dept_section_grid->Recordset)
	$dept_section_grid->Recordset->Close();
?>
<?php if ($dept_section_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $dept_section_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($dept_section_grid->TotalRecords == 0 && !$dept_section->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $dept_section_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$dept_section_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$dept_section_grid->terminate();
?>