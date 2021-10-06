<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($staffchildren_grid))
	$staffchildren_grid = new staffchildren_grid();

// Run the page
$staffchildren_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffchildren_grid->Page_Render();
?>
<?php if (!$staffchildren_grid->isExport()) { ?>
<script>
var fstaffchildrengrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fstaffchildrengrid = new ew.Form("fstaffchildrengrid", "grid");
	fstaffchildrengrid.formKeyCountName = '<?php echo $staffchildren_grid->FormKeyCountName ?>';

	// Validate form
	fstaffchildrengrid.validate = function() {
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
			<?php if ($staffchildren_grid->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffchildren_grid->FirstName->caption(), $staffchildren_grid->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffchildren_grid->MiddleName->Required) { ?>
				elm = this.getElements("x" + infix + "_MiddleName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffchildren_grid->MiddleName->caption(), $staffchildren_grid->MiddleName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffchildren_grid->Surname->Required) { ?>
				elm = this.getElements("x" + infix + "_Surname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffchildren_grid->Surname->caption(), $staffchildren_grid->Surname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffchildren_grid->DateOfBirth->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffchildren_grid->DateOfBirth->caption(), $staffchildren_grid->DateOfBirth->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffchildren_grid->DateOfBirth->errorMessage()) ?>");
			<?php if ($staffchildren_grid->Sex->Required) { ?>
				elm = this.getElements("x" + infix + "_Sex");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffchildren_grid->Sex->caption(), $staffchildren_grid->Sex->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fstaffchildrengrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "FirstName", false)) return false;
		if (ew.valueChanged(fobj, infix, "MiddleName", false)) return false;
		if (ew.valueChanged(fobj, infix, "Surname", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateOfBirth", false)) return false;
		if (ew.valueChanged(fobj, infix, "Sex", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fstaffchildrengrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffchildrengrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffchildrengrid.lists["x_Sex"] = <?php echo $staffchildren_grid->Sex->Lookup->toClientList($staffchildren_grid) ?>;
	fstaffchildrengrid.lists["x_Sex"].options = <?php echo JsonEncode($staffchildren_grid->Sex->lookupOptions()) ?>;
	loadjs.done("fstaffchildrengrid");
});
</script>
<?php } ?>
<?php
$staffchildren_grid->renderOtherOptions();
?>
<?php if ($staffchildren_grid->TotalRecords > 0 || $staffchildren->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($staffchildren_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> staffchildren">
<?php if ($staffchildren_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $staffchildren_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fstaffchildrengrid" class="ew-form ew-list-form form-inline">
<div id="gmp_staffchildren" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_staffchildrengrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$staffchildren->RowType = ROWTYPE_HEADER;

// Render list options
$staffchildren_grid->renderListOptions();

// Render list options (header, left)
$staffchildren_grid->ListOptions->render("header", "left");
?>
<?php if ($staffchildren_grid->FirstName->Visible) { // FirstName ?>
	<?php if ($staffchildren_grid->SortUrl($staffchildren_grid->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $staffchildren_grid->FirstName->headerCellClass() ?>"><div id="elh_staffchildren_FirstName" class="staffchildren_FirstName"><div class="ew-table-header-caption"><?php echo $staffchildren_grid->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $staffchildren_grid->FirstName->headerCellClass() ?>"><div><div id="elh_staffchildren_FirstName" class="staffchildren_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffchildren_grid->FirstName->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffchildren_grid->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffchildren_grid->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffchildren_grid->MiddleName->Visible) { // MiddleName ?>
	<?php if ($staffchildren_grid->SortUrl($staffchildren_grid->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $staffchildren_grid->MiddleName->headerCellClass() ?>"><div id="elh_staffchildren_MiddleName" class="staffchildren_MiddleName"><div class="ew-table-header-caption"><?php echo $staffchildren_grid->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $staffchildren_grid->MiddleName->headerCellClass() ?>"><div><div id="elh_staffchildren_MiddleName" class="staffchildren_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffchildren_grid->MiddleName->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffchildren_grid->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffchildren_grid->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffchildren_grid->Surname->Visible) { // Surname ?>
	<?php if ($staffchildren_grid->SortUrl($staffchildren_grid->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $staffchildren_grid->Surname->headerCellClass() ?>"><div id="elh_staffchildren_Surname" class="staffchildren_Surname"><div class="ew-table-header-caption"><?php echo $staffchildren_grid->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $staffchildren_grid->Surname->headerCellClass() ?>"><div><div id="elh_staffchildren_Surname" class="staffchildren_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffchildren_grid->Surname->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffchildren_grid->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffchildren_grid->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffchildren_grid->DateOfBirth->Visible) { // DateOfBirth ?>
	<?php if ($staffchildren_grid->SortUrl($staffchildren_grid->DateOfBirth) == "") { ?>
		<th data-name="DateOfBirth" class="<?php echo $staffchildren_grid->DateOfBirth->headerCellClass() ?>"><div id="elh_staffchildren_DateOfBirth" class="staffchildren_DateOfBirth"><div class="ew-table-header-caption"><?php echo $staffchildren_grid->DateOfBirth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfBirth" class="<?php echo $staffchildren_grid->DateOfBirth->headerCellClass() ?>"><div><div id="elh_staffchildren_DateOfBirth" class="staffchildren_DateOfBirth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffchildren_grid->DateOfBirth->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffchildren_grid->DateOfBirth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffchildren_grid->DateOfBirth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffchildren_grid->Sex->Visible) { // Sex ?>
	<?php if ($staffchildren_grid->SortUrl($staffchildren_grid->Sex) == "") { ?>
		<th data-name="Sex" class="<?php echo $staffchildren_grid->Sex->headerCellClass() ?>"><div id="elh_staffchildren_Sex" class="staffchildren_Sex"><div class="ew-table-header-caption"><?php echo $staffchildren_grid->Sex->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sex" class="<?php echo $staffchildren_grid->Sex->headerCellClass() ?>"><div><div id="elh_staffchildren_Sex" class="staffchildren_Sex">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffchildren_grid->Sex->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffchildren_grid->Sex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffchildren_grid->Sex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$staffchildren_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$staffchildren_grid->StartRecord = 1;
$staffchildren_grid->StopRecord = $staffchildren_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($staffchildren->isConfirm() || $staffchildren_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($staffchildren_grid->FormKeyCountName) && ($staffchildren_grid->isGridAdd() || $staffchildren_grid->isGridEdit() || $staffchildren->isConfirm())) {
		$staffchildren_grid->KeyCount = $CurrentForm->getValue($staffchildren_grid->FormKeyCountName);
		$staffchildren_grid->StopRecord = $staffchildren_grid->StartRecord + $staffchildren_grid->KeyCount - 1;
	}
}
$staffchildren_grid->RecordCount = $staffchildren_grid->StartRecord - 1;
if ($staffchildren_grid->Recordset && !$staffchildren_grid->Recordset->EOF) {
	$staffchildren_grid->Recordset->moveFirst();
	$selectLimit = $staffchildren_grid->UseSelectLimit;
	if (!$selectLimit && $staffchildren_grid->StartRecord > 1)
		$staffchildren_grid->Recordset->move($staffchildren_grid->StartRecord - 1);
} elseif (!$staffchildren->AllowAddDeleteRow && $staffchildren_grid->StopRecord == 0) {
	$staffchildren_grid->StopRecord = $staffchildren->GridAddRowCount;
}

// Initialize aggregate
$staffchildren->RowType = ROWTYPE_AGGREGATEINIT;
$staffchildren->resetAttributes();
$staffchildren_grid->renderRow();
if ($staffchildren_grid->isGridAdd())
	$staffchildren_grid->RowIndex = 0;
if ($staffchildren_grid->isGridEdit())
	$staffchildren_grid->RowIndex = 0;
while ($staffchildren_grid->RecordCount < $staffchildren_grid->StopRecord) {
	$staffchildren_grid->RecordCount++;
	if ($staffchildren_grid->RecordCount >= $staffchildren_grid->StartRecord) {
		$staffchildren_grid->RowCount++;
		if ($staffchildren_grid->isGridAdd() || $staffchildren_grid->isGridEdit() || $staffchildren->isConfirm()) {
			$staffchildren_grid->RowIndex++;
			$CurrentForm->Index = $staffchildren_grid->RowIndex;
			if ($CurrentForm->hasValue($staffchildren_grid->FormActionName) && ($staffchildren->isConfirm() || $staffchildren_grid->EventCancelled))
				$staffchildren_grid->RowAction = strval($CurrentForm->getValue($staffchildren_grid->FormActionName));
			elseif ($staffchildren_grid->isGridAdd())
				$staffchildren_grid->RowAction = "insert";
			else
				$staffchildren_grid->RowAction = "";
		}

		// Set up key count
		$staffchildren_grid->KeyCount = $staffchildren_grid->RowIndex;

		// Init row class and style
		$staffchildren->resetAttributes();
		$staffchildren->CssClass = "";
		if ($staffchildren_grid->isGridAdd()) {
			if ($staffchildren->CurrentMode == "copy") {
				$staffchildren_grid->loadRowValues($staffchildren_grid->Recordset); // Load row values
				$staffchildren_grid->setRecordKey($staffchildren_grid->RowOldKey, $staffchildren_grid->Recordset); // Set old record key
			} else {
				$staffchildren_grid->loadRowValues(); // Load default values
				$staffchildren_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$staffchildren_grid->loadRowValues($staffchildren_grid->Recordset); // Load row values
		}
		$staffchildren->RowType = ROWTYPE_VIEW; // Render view
		if ($staffchildren_grid->isGridAdd()) // Grid add
			$staffchildren->RowType = ROWTYPE_ADD; // Render add
		if ($staffchildren_grid->isGridAdd() && $staffchildren->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$staffchildren_grid->restoreCurrentRowFormValues($staffchildren_grid->RowIndex); // Restore form values
		if ($staffchildren_grid->isGridEdit()) { // Grid edit
			if ($staffchildren->EventCancelled)
				$staffchildren_grid->restoreCurrentRowFormValues($staffchildren_grid->RowIndex); // Restore form values
			if ($staffchildren_grid->RowAction == "insert")
				$staffchildren->RowType = ROWTYPE_ADD; // Render add
			else
				$staffchildren->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($staffchildren_grid->isGridEdit() && ($staffchildren->RowType == ROWTYPE_EDIT || $staffchildren->RowType == ROWTYPE_ADD) && $staffchildren->EventCancelled) // Update failed
			$staffchildren_grid->restoreCurrentRowFormValues($staffchildren_grid->RowIndex); // Restore form values
		if ($staffchildren->RowType == ROWTYPE_EDIT) // Edit row
			$staffchildren_grid->EditRowCount++;
		if ($staffchildren->isConfirm()) // Confirm row
			$staffchildren_grid->restoreCurrentRowFormValues($staffchildren_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$staffchildren->RowAttrs->merge(["data-rowindex" => $staffchildren_grid->RowCount, "id" => "r" . $staffchildren_grid->RowCount . "_staffchildren", "data-rowtype" => $staffchildren->RowType]);

		// Render row
		$staffchildren_grid->renderRow();

		// Render list options
		$staffchildren_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($staffchildren_grid->RowAction != "delete" && $staffchildren_grid->RowAction != "insertdelete" && !($staffchildren_grid->RowAction == "insert" && $staffchildren->isConfirm() && $staffchildren_grid->emptyRow())) {
?>
	<tr <?php echo $staffchildren->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffchildren_grid->ListOptions->render("body", "left", $staffchildren_grid->RowCount);
?>
	<?php if ($staffchildren_grid->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $staffchildren_grid->FirstName->cellAttributes() ?>>
<?php if ($staffchildren->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffchildren_grid->RowCount ?>_staffchildren_FirstName" class="form-group">
<input type="text" data-table="staffchildren" data-field="x_FirstName" name="x<?php echo $staffchildren_grid->RowIndex ?>_FirstName" id="x<?php echo $staffchildren_grid->RowIndex ?>_FirstName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_grid->FirstName->getPlaceHolder()) ?>" value="<?php echo $staffchildren_grid->FirstName->EditValue ?>"<?php echo $staffchildren_grid->FirstName->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_FirstName" name="o<?php echo $staffchildren_grid->RowIndex ?>_FirstName" id="o<?php echo $staffchildren_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($staffchildren_grid->FirstName->OldValue) ?>">
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffchildren_grid->RowCount ?>_staffchildren_FirstName" class="form-group">
<input type="text" data-table="staffchildren" data-field="x_FirstName" name="x<?php echo $staffchildren_grid->RowIndex ?>_FirstName" id="x<?php echo $staffchildren_grid->RowIndex ?>_FirstName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_grid->FirstName->getPlaceHolder()) ?>" value="<?php echo $staffchildren_grid->FirstName->EditValue ?>"<?php echo $staffchildren_grid->FirstName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffchildren_grid->RowCount ?>_staffchildren_FirstName">
<span<?php echo $staffchildren_grid->FirstName->viewAttributes() ?>><?php echo $staffchildren_grid->FirstName->getViewValue() ?></span>
</span>
<?php if (!$staffchildren->isConfirm()) { ?>
<input type="hidden" data-table="staffchildren" data-field="x_FirstName" name="x<?php echo $staffchildren_grid->RowIndex ?>_FirstName" id="x<?php echo $staffchildren_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($staffchildren_grid->FirstName->FormValue) ?>">
<input type="hidden" data-table="staffchildren" data-field="x_FirstName" name="o<?php echo $staffchildren_grid->RowIndex ?>_FirstName" id="o<?php echo $staffchildren_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($staffchildren_grid->FirstName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffchildren" data-field="x_FirstName" name="fstaffchildrengrid$x<?php echo $staffchildren_grid->RowIndex ?>_FirstName" id="fstaffchildrengrid$x<?php echo $staffchildren_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($staffchildren_grid->FirstName->FormValue) ?>">
<input type="hidden" data-table="staffchildren" data-field="x_FirstName" name="fstaffchildrengrid$o<?php echo $staffchildren_grid->RowIndex ?>_FirstName" id="fstaffchildrengrid$o<?php echo $staffchildren_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($staffchildren_grid->FirstName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="staffchildren" data-field="x_EmployeeID" name="x<?php echo $staffchildren_grid->RowIndex ?>_EmployeeID" id="x<?php echo $staffchildren_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffchildren_grid->EmployeeID->CurrentValue) ?>">
<input type="hidden" data-table="staffchildren" data-field="x_EmployeeID" name="o<?php echo $staffchildren_grid->RowIndex ?>_EmployeeID" id="o<?php echo $staffchildren_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffchildren_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_EDIT || $staffchildren->CurrentMode == "edit") { ?>
<input type="hidden" data-table="staffchildren" data-field="x_EmployeeID" name="x<?php echo $staffchildren_grid->RowIndex ?>_EmployeeID" id="x<?php echo $staffchildren_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffchildren_grid->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="staffchildren" data-field="x_ChildNo" name="x<?php echo $staffchildren_grid->RowIndex ?>_ChildNo" id="x<?php echo $staffchildren_grid->RowIndex ?>_ChildNo" value="<?php echo HtmlEncode($staffchildren_grid->ChildNo->CurrentValue) ?>">
<input type="hidden" data-table="staffchildren" data-field="x_ChildNo" name="o<?php echo $staffchildren_grid->RowIndex ?>_ChildNo" id="o<?php echo $staffchildren_grid->RowIndex ?>_ChildNo" value="<?php echo HtmlEncode($staffchildren_grid->ChildNo->OldValue) ?>">
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_EDIT || $staffchildren->CurrentMode == "edit") { ?>
<input type="hidden" data-table="staffchildren" data-field="x_ChildNo" name="x<?php echo $staffchildren_grid->RowIndex ?>_ChildNo" id="x<?php echo $staffchildren_grid->RowIndex ?>_ChildNo" value="<?php echo HtmlEncode($staffchildren_grid->ChildNo->CurrentValue) ?>">
<?php } ?>
	<?php if ($staffchildren_grid->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $staffchildren_grid->MiddleName->cellAttributes() ?>>
<?php if ($staffchildren->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffchildren_grid->RowCount ?>_staffchildren_MiddleName" class="form-group">
<input type="text" data-table="staffchildren" data-field="x_MiddleName" name="x<?php echo $staffchildren_grid->RowIndex ?>_MiddleName" id="x<?php echo $staffchildren_grid->RowIndex ?>_MiddleName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_grid->MiddleName->getPlaceHolder()) ?>" value="<?php echo $staffchildren_grid->MiddleName->EditValue ?>"<?php echo $staffchildren_grid->MiddleName->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_MiddleName" name="o<?php echo $staffchildren_grid->RowIndex ?>_MiddleName" id="o<?php echo $staffchildren_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($staffchildren_grid->MiddleName->OldValue) ?>">
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffchildren_grid->RowCount ?>_staffchildren_MiddleName" class="form-group">
<input type="text" data-table="staffchildren" data-field="x_MiddleName" name="x<?php echo $staffchildren_grid->RowIndex ?>_MiddleName" id="x<?php echo $staffchildren_grid->RowIndex ?>_MiddleName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_grid->MiddleName->getPlaceHolder()) ?>" value="<?php echo $staffchildren_grid->MiddleName->EditValue ?>"<?php echo $staffchildren_grid->MiddleName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffchildren_grid->RowCount ?>_staffchildren_MiddleName">
<span<?php echo $staffchildren_grid->MiddleName->viewAttributes() ?>><?php echo $staffchildren_grid->MiddleName->getViewValue() ?></span>
</span>
<?php if (!$staffchildren->isConfirm()) { ?>
<input type="hidden" data-table="staffchildren" data-field="x_MiddleName" name="x<?php echo $staffchildren_grid->RowIndex ?>_MiddleName" id="x<?php echo $staffchildren_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($staffchildren_grid->MiddleName->FormValue) ?>">
<input type="hidden" data-table="staffchildren" data-field="x_MiddleName" name="o<?php echo $staffchildren_grid->RowIndex ?>_MiddleName" id="o<?php echo $staffchildren_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($staffchildren_grid->MiddleName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffchildren" data-field="x_MiddleName" name="fstaffchildrengrid$x<?php echo $staffchildren_grid->RowIndex ?>_MiddleName" id="fstaffchildrengrid$x<?php echo $staffchildren_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($staffchildren_grid->MiddleName->FormValue) ?>">
<input type="hidden" data-table="staffchildren" data-field="x_MiddleName" name="fstaffchildrengrid$o<?php echo $staffchildren_grid->RowIndex ?>_MiddleName" id="fstaffchildrengrid$o<?php echo $staffchildren_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($staffchildren_grid->MiddleName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffchildren_grid->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $staffchildren_grid->Surname->cellAttributes() ?>>
<?php if ($staffchildren->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffchildren_grid->RowCount ?>_staffchildren_Surname" class="form-group">
<input type="text" data-table="staffchildren" data-field="x_Surname" name="x<?php echo $staffchildren_grid->RowIndex ?>_Surname" id="x<?php echo $staffchildren_grid->RowIndex ?>_Surname" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_grid->Surname->getPlaceHolder()) ?>" value="<?php echo $staffchildren_grid->Surname->EditValue ?>"<?php echo $staffchildren_grid->Surname->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_Surname" name="o<?php echo $staffchildren_grid->RowIndex ?>_Surname" id="o<?php echo $staffchildren_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($staffchildren_grid->Surname->OldValue) ?>">
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffchildren_grid->RowCount ?>_staffchildren_Surname" class="form-group">
<input type="text" data-table="staffchildren" data-field="x_Surname" name="x<?php echo $staffchildren_grid->RowIndex ?>_Surname" id="x<?php echo $staffchildren_grid->RowIndex ?>_Surname" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_grid->Surname->getPlaceHolder()) ?>" value="<?php echo $staffchildren_grid->Surname->EditValue ?>"<?php echo $staffchildren_grid->Surname->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffchildren_grid->RowCount ?>_staffchildren_Surname">
<span<?php echo $staffchildren_grid->Surname->viewAttributes() ?>><?php echo $staffchildren_grid->Surname->getViewValue() ?></span>
</span>
<?php if (!$staffchildren->isConfirm()) { ?>
<input type="hidden" data-table="staffchildren" data-field="x_Surname" name="x<?php echo $staffchildren_grid->RowIndex ?>_Surname" id="x<?php echo $staffchildren_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($staffchildren_grid->Surname->FormValue) ?>">
<input type="hidden" data-table="staffchildren" data-field="x_Surname" name="o<?php echo $staffchildren_grid->RowIndex ?>_Surname" id="o<?php echo $staffchildren_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($staffchildren_grid->Surname->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffchildren" data-field="x_Surname" name="fstaffchildrengrid$x<?php echo $staffchildren_grid->RowIndex ?>_Surname" id="fstaffchildrengrid$x<?php echo $staffchildren_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($staffchildren_grid->Surname->FormValue) ?>">
<input type="hidden" data-table="staffchildren" data-field="x_Surname" name="fstaffchildrengrid$o<?php echo $staffchildren_grid->RowIndex ?>_Surname" id="fstaffchildrengrid$o<?php echo $staffchildren_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($staffchildren_grid->Surname->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffchildren_grid->DateOfBirth->Visible) { // DateOfBirth ?>
		<td data-name="DateOfBirth" <?php echo $staffchildren_grid->DateOfBirth->cellAttributes() ?>>
<?php if ($staffchildren->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffchildren_grid->RowCount ?>_staffchildren_DateOfBirth" class="form-group">
<input type="text" data-table="staffchildren" data-field="x_DateOfBirth" name="x<?php echo $staffchildren_grid->RowIndex ?>_DateOfBirth" id="x<?php echo $staffchildren_grid->RowIndex ?>_DateOfBirth" placeholder="<?php echo HtmlEncode($staffchildren_grid->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $staffchildren_grid->DateOfBirth->EditValue ?>"<?php echo $staffchildren_grid->DateOfBirth->editAttributes() ?>>
<?php if (!$staffchildren_grid->DateOfBirth->ReadOnly && !$staffchildren_grid->DateOfBirth->Disabled && !isset($staffchildren_grid->DateOfBirth->EditAttrs["readonly"]) && !isset($staffchildren_grid->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffchildrengrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffchildrengrid", "x<?php echo $staffchildren_grid->RowIndex ?>_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_DateOfBirth" name="o<?php echo $staffchildren_grid->RowIndex ?>_DateOfBirth" id="o<?php echo $staffchildren_grid->RowIndex ?>_DateOfBirth" value="<?php echo HtmlEncode($staffchildren_grid->DateOfBirth->OldValue) ?>">
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffchildren_grid->RowCount ?>_staffchildren_DateOfBirth" class="form-group">
<input type="text" data-table="staffchildren" data-field="x_DateOfBirth" name="x<?php echo $staffchildren_grid->RowIndex ?>_DateOfBirth" id="x<?php echo $staffchildren_grid->RowIndex ?>_DateOfBirth" placeholder="<?php echo HtmlEncode($staffchildren_grid->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $staffchildren_grid->DateOfBirth->EditValue ?>"<?php echo $staffchildren_grid->DateOfBirth->editAttributes() ?>>
<?php if (!$staffchildren_grid->DateOfBirth->ReadOnly && !$staffchildren_grid->DateOfBirth->Disabled && !isset($staffchildren_grid->DateOfBirth->EditAttrs["readonly"]) && !isset($staffchildren_grid->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffchildrengrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffchildrengrid", "x<?php echo $staffchildren_grid->RowIndex ?>_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffchildren_grid->RowCount ?>_staffchildren_DateOfBirth">
<span<?php echo $staffchildren_grid->DateOfBirth->viewAttributes() ?>><?php echo $staffchildren_grid->DateOfBirth->getViewValue() ?></span>
</span>
<?php if (!$staffchildren->isConfirm()) { ?>
<input type="hidden" data-table="staffchildren" data-field="x_DateOfBirth" name="x<?php echo $staffchildren_grid->RowIndex ?>_DateOfBirth" id="x<?php echo $staffchildren_grid->RowIndex ?>_DateOfBirth" value="<?php echo HtmlEncode($staffchildren_grid->DateOfBirth->FormValue) ?>">
<input type="hidden" data-table="staffchildren" data-field="x_DateOfBirth" name="o<?php echo $staffchildren_grid->RowIndex ?>_DateOfBirth" id="o<?php echo $staffchildren_grid->RowIndex ?>_DateOfBirth" value="<?php echo HtmlEncode($staffchildren_grid->DateOfBirth->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffchildren" data-field="x_DateOfBirth" name="fstaffchildrengrid$x<?php echo $staffchildren_grid->RowIndex ?>_DateOfBirth" id="fstaffchildrengrid$x<?php echo $staffchildren_grid->RowIndex ?>_DateOfBirth" value="<?php echo HtmlEncode($staffchildren_grid->DateOfBirth->FormValue) ?>">
<input type="hidden" data-table="staffchildren" data-field="x_DateOfBirth" name="fstaffchildrengrid$o<?php echo $staffchildren_grid->RowIndex ?>_DateOfBirth" id="fstaffchildrengrid$o<?php echo $staffchildren_grid->RowIndex ?>_DateOfBirth" value="<?php echo HtmlEncode($staffchildren_grid->DateOfBirth->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffchildren_grid->Sex->Visible) { // Sex ?>
		<td data-name="Sex" <?php echo $staffchildren_grid->Sex->cellAttributes() ?>>
<?php if ($staffchildren->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffchildren_grid->RowCount ?>_staffchildren_Sex" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffchildren" data-field="x_Sex" data-value-separator="<?php echo $staffchildren_grid->Sex->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffchildren_grid->RowIndex ?>_Sex" name="x<?php echo $staffchildren_grid->RowIndex ?>_Sex"<?php echo $staffchildren_grid->Sex->editAttributes() ?>>
			<?php echo $staffchildren_grid->Sex->selectOptionListHtml("x{$staffchildren_grid->RowIndex}_Sex") ?>
		</select>
</div>
<?php echo $staffchildren_grid->Sex->Lookup->getParamTag($staffchildren_grid, "p_x" . $staffchildren_grid->RowIndex . "_Sex") ?>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_Sex" name="o<?php echo $staffchildren_grid->RowIndex ?>_Sex" id="o<?php echo $staffchildren_grid->RowIndex ?>_Sex" value="<?php echo HtmlEncode($staffchildren_grid->Sex->OldValue) ?>">
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffchildren_grid->RowCount ?>_staffchildren_Sex" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffchildren" data-field="x_Sex" data-value-separator="<?php echo $staffchildren_grid->Sex->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffchildren_grid->RowIndex ?>_Sex" name="x<?php echo $staffchildren_grid->RowIndex ?>_Sex"<?php echo $staffchildren_grid->Sex->editAttributes() ?>>
			<?php echo $staffchildren_grid->Sex->selectOptionListHtml("x{$staffchildren_grid->RowIndex}_Sex") ?>
		</select>
</div>
<?php echo $staffchildren_grid->Sex->Lookup->getParamTag($staffchildren_grid, "p_x" . $staffchildren_grid->RowIndex . "_Sex") ?>
</span>
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffchildren_grid->RowCount ?>_staffchildren_Sex">
<span<?php echo $staffchildren_grid->Sex->viewAttributes() ?>><?php echo $staffchildren_grid->Sex->getViewValue() ?></span>
</span>
<?php if (!$staffchildren->isConfirm()) { ?>
<input type="hidden" data-table="staffchildren" data-field="x_Sex" name="x<?php echo $staffchildren_grid->RowIndex ?>_Sex" id="x<?php echo $staffchildren_grid->RowIndex ?>_Sex" value="<?php echo HtmlEncode($staffchildren_grid->Sex->FormValue) ?>">
<input type="hidden" data-table="staffchildren" data-field="x_Sex" name="o<?php echo $staffchildren_grid->RowIndex ?>_Sex" id="o<?php echo $staffchildren_grid->RowIndex ?>_Sex" value="<?php echo HtmlEncode($staffchildren_grid->Sex->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffchildren" data-field="x_Sex" name="fstaffchildrengrid$x<?php echo $staffchildren_grid->RowIndex ?>_Sex" id="fstaffchildrengrid$x<?php echo $staffchildren_grid->RowIndex ?>_Sex" value="<?php echo HtmlEncode($staffchildren_grid->Sex->FormValue) ?>">
<input type="hidden" data-table="staffchildren" data-field="x_Sex" name="fstaffchildrengrid$o<?php echo $staffchildren_grid->RowIndex ?>_Sex" id="fstaffchildrengrid$o<?php echo $staffchildren_grid->RowIndex ?>_Sex" value="<?php echo HtmlEncode($staffchildren_grid->Sex->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffchildren_grid->ListOptions->render("body", "right", $staffchildren_grid->RowCount);
?>
	</tr>
<?php if ($staffchildren->RowType == ROWTYPE_ADD || $staffchildren->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fstaffchildrengrid", "load"], function() {
	fstaffchildrengrid.updateLists(<?php echo $staffchildren_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$staffchildren_grid->isGridAdd() || $staffchildren->CurrentMode == "copy")
		if (!$staffchildren_grid->Recordset->EOF)
			$staffchildren_grid->Recordset->moveNext();
}
?>
<?php
	if ($staffchildren->CurrentMode == "add" || $staffchildren->CurrentMode == "copy" || $staffchildren->CurrentMode == "edit") {
		$staffchildren_grid->RowIndex = '$rowindex$';
		$staffchildren_grid->loadRowValues();

		// Set row properties
		$staffchildren->resetAttributes();
		$staffchildren->RowAttrs->merge(["data-rowindex" => $staffchildren_grid->RowIndex, "id" => "r0_staffchildren", "data-rowtype" => ROWTYPE_ADD]);
		$staffchildren->RowAttrs->appendClass("ew-template");
		$staffchildren->RowType = ROWTYPE_ADD;

		// Render row
		$staffchildren_grid->renderRow();

		// Render list options
		$staffchildren_grid->renderListOptions();
		$staffchildren_grid->StartRowCount = 0;
?>
	<tr <?php echo $staffchildren->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffchildren_grid->ListOptions->render("body", "left", $staffchildren_grid->RowIndex);
?>
	<?php if ($staffchildren_grid->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName">
<?php if (!$staffchildren->isConfirm()) { ?>
<span id="el$rowindex$_staffchildren_FirstName" class="form-group staffchildren_FirstName">
<input type="text" data-table="staffchildren" data-field="x_FirstName" name="x<?php echo $staffchildren_grid->RowIndex ?>_FirstName" id="x<?php echo $staffchildren_grid->RowIndex ?>_FirstName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_grid->FirstName->getPlaceHolder()) ?>" value="<?php echo $staffchildren_grid->FirstName->EditValue ?>"<?php echo $staffchildren_grid->FirstName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffchildren_FirstName" class="form-group staffchildren_FirstName">
<span<?php echo $staffchildren_grid->FirstName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffchildren_grid->FirstName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_FirstName" name="x<?php echo $staffchildren_grid->RowIndex ?>_FirstName" id="x<?php echo $staffchildren_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($staffchildren_grid->FirstName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffchildren" data-field="x_FirstName" name="o<?php echo $staffchildren_grid->RowIndex ?>_FirstName" id="o<?php echo $staffchildren_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($staffchildren_grid->FirstName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffchildren_grid->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName">
<?php if (!$staffchildren->isConfirm()) { ?>
<span id="el$rowindex$_staffchildren_MiddleName" class="form-group staffchildren_MiddleName">
<input type="text" data-table="staffchildren" data-field="x_MiddleName" name="x<?php echo $staffchildren_grid->RowIndex ?>_MiddleName" id="x<?php echo $staffchildren_grid->RowIndex ?>_MiddleName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_grid->MiddleName->getPlaceHolder()) ?>" value="<?php echo $staffchildren_grid->MiddleName->EditValue ?>"<?php echo $staffchildren_grid->MiddleName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffchildren_MiddleName" class="form-group staffchildren_MiddleName">
<span<?php echo $staffchildren_grid->MiddleName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffchildren_grid->MiddleName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_MiddleName" name="x<?php echo $staffchildren_grid->RowIndex ?>_MiddleName" id="x<?php echo $staffchildren_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($staffchildren_grid->MiddleName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffchildren" data-field="x_MiddleName" name="o<?php echo $staffchildren_grid->RowIndex ?>_MiddleName" id="o<?php echo $staffchildren_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($staffchildren_grid->MiddleName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffchildren_grid->Surname->Visible) { // Surname ?>
		<td data-name="Surname">
<?php if (!$staffchildren->isConfirm()) { ?>
<span id="el$rowindex$_staffchildren_Surname" class="form-group staffchildren_Surname">
<input type="text" data-table="staffchildren" data-field="x_Surname" name="x<?php echo $staffchildren_grid->RowIndex ?>_Surname" id="x<?php echo $staffchildren_grid->RowIndex ?>_Surname" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_grid->Surname->getPlaceHolder()) ?>" value="<?php echo $staffchildren_grid->Surname->EditValue ?>"<?php echo $staffchildren_grid->Surname->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffchildren_Surname" class="form-group staffchildren_Surname">
<span<?php echo $staffchildren_grid->Surname->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffchildren_grid->Surname->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_Surname" name="x<?php echo $staffchildren_grid->RowIndex ?>_Surname" id="x<?php echo $staffchildren_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($staffchildren_grid->Surname->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffchildren" data-field="x_Surname" name="o<?php echo $staffchildren_grid->RowIndex ?>_Surname" id="o<?php echo $staffchildren_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($staffchildren_grid->Surname->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffchildren_grid->DateOfBirth->Visible) { // DateOfBirth ?>
		<td data-name="DateOfBirth">
<?php if (!$staffchildren->isConfirm()) { ?>
<span id="el$rowindex$_staffchildren_DateOfBirth" class="form-group staffchildren_DateOfBirth">
<input type="text" data-table="staffchildren" data-field="x_DateOfBirth" name="x<?php echo $staffchildren_grid->RowIndex ?>_DateOfBirth" id="x<?php echo $staffchildren_grid->RowIndex ?>_DateOfBirth" placeholder="<?php echo HtmlEncode($staffchildren_grid->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $staffchildren_grid->DateOfBirth->EditValue ?>"<?php echo $staffchildren_grid->DateOfBirth->editAttributes() ?>>
<?php if (!$staffchildren_grid->DateOfBirth->ReadOnly && !$staffchildren_grid->DateOfBirth->Disabled && !isset($staffchildren_grid->DateOfBirth->EditAttrs["readonly"]) && !isset($staffchildren_grid->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffchildrengrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffchildrengrid", "x<?php echo $staffchildren_grid->RowIndex ?>_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffchildren_DateOfBirth" class="form-group staffchildren_DateOfBirth">
<span<?php echo $staffchildren_grid->DateOfBirth->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffchildren_grid->DateOfBirth->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_DateOfBirth" name="x<?php echo $staffchildren_grid->RowIndex ?>_DateOfBirth" id="x<?php echo $staffchildren_grid->RowIndex ?>_DateOfBirth" value="<?php echo HtmlEncode($staffchildren_grid->DateOfBirth->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffchildren" data-field="x_DateOfBirth" name="o<?php echo $staffchildren_grid->RowIndex ?>_DateOfBirth" id="o<?php echo $staffchildren_grid->RowIndex ?>_DateOfBirth" value="<?php echo HtmlEncode($staffchildren_grid->DateOfBirth->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffchildren_grid->Sex->Visible) { // Sex ?>
		<td data-name="Sex">
<?php if (!$staffchildren->isConfirm()) { ?>
<span id="el$rowindex$_staffchildren_Sex" class="form-group staffchildren_Sex">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffchildren" data-field="x_Sex" data-value-separator="<?php echo $staffchildren_grid->Sex->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffchildren_grid->RowIndex ?>_Sex" name="x<?php echo $staffchildren_grid->RowIndex ?>_Sex"<?php echo $staffchildren_grid->Sex->editAttributes() ?>>
			<?php echo $staffchildren_grid->Sex->selectOptionListHtml("x{$staffchildren_grid->RowIndex}_Sex") ?>
		</select>
</div>
<?php echo $staffchildren_grid->Sex->Lookup->getParamTag($staffchildren_grid, "p_x" . $staffchildren_grid->RowIndex . "_Sex") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffchildren_Sex" class="form-group staffchildren_Sex">
<span<?php echo $staffchildren_grid->Sex->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffchildren_grid->Sex->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_Sex" name="x<?php echo $staffchildren_grid->RowIndex ?>_Sex" id="x<?php echo $staffchildren_grid->RowIndex ?>_Sex" value="<?php echo HtmlEncode($staffchildren_grid->Sex->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffchildren" data-field="x_Sex" name="o<?php echo $staffchildren_grid->RowIndex ?>_Sex" id="o<?php echo $staffchildren_grid->RowIndex ?>_Sex" value="<?php echo HtmlEncode($staffchildren_grid->Sex->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffchildren_grid->ListOptions->render("body", "right", $staffchildren_grid->RowIndex);
?>
<script>
loadjs.ready(["fstaffchildrengrid", "load"], function() {
	fstaffchildrengrid.updateLists(<?php echo $staffchildren_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($staffchildren->CurrentMode == "add" || $staffchildren->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $staffchildren_grid->FormKeyCountName ?>" id="<?php echo $staffchildren_grid->FormKeyCountName ?>" value="<?php echo $staffchildren_grid->KeyCount ?>">
<?php echo $staffchildren_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($staffchildren->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $staffchildren_grid->FormKeyCountName ?>" id="<?php echo $staffchildren_grid->FormKeyCountName ?>" value="<?php echo $staffchildren_grid->KeyCount ?>">
<?php echo $staffchildren_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($staffchildren->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fstaffchildrengrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($staffchildren_grid->Recordset)
	$staffchildren_grid->Recordset->Close();
?>
<?php if ($staffchildren_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $staffchildren_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($staffchildren_grid->TotalRecords == 0 && !$staffchildren->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $staffchildren_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$staffchildren_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$staffchildren_grid->terminate();
?>