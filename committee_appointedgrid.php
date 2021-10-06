<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($committee_appointed_grid))
	$committee_appointed_grid = new committee_appointed_grid();

// Run the page
$committee_appointed_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$committee_appointed_grid->Page_Render();
?>
<?php if (!$committee_appointed_grid->isExport()) { ?>
<script>
var fcommittee_appointedgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fcommittee_appointedgrid = new ew.Form("fcommittee_appointedgrid", "grid");
	fcommittee_appointedgrid.formKeyCountName = '<?php echo $committee_appointed_grid->FormKeyCountName ?>';

	// Validate form
	fcommittee_appointedgrid.validate = function() {
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
			<?php if ($committee_appointed_grid->CommitteCode->Required) { ?>
				elm = this.getElements("x" + infix + "_CommitteCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $committee_appointed_grid->CommitteCode->caption(), $committee_appointed_grid->CommitteCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($committee_appointed_grid->CommitteeRole->Required) { ?>
				elm = this.getElements("x" + infix + "_CommitteeRole");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $committee_appointed_grid->CommitteeRole->caption(), $committee_appointed_grid->CommitteeRole->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fcommittee_appointedgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "CommitteCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "CommitteeRole", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fcommittee_appointedgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcommittee_appointedgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcommittee_appointedgrid.lists["x_CommitteCode"] = <?php echo $committee_appointed_grid->CommitteCode->Lookup->toClientList($committee_appointed_grid) ?>;
	fcommittee_appointedgrid.lists["x_CommitteCode"].options = <?php echo JsonEncode($committee_appointed_grid->CommitteCode->lookupOptions()) ?>;
	fcommittee_appointedgrid.lists["x_CommitteeRole"] = <?php echo $committee_appointed_grid->CommitteeRole->Lookup->toClientList($committee_appointed_grid) ?>;
	fcommittee_appointedgrid.lists["x_CommitteeRole"].options = <?php echo JsonEncode($committee_appointed_grid->CommitteeRole->lookupOptions()) ?>;
	loadjs.done("fcommittee_appointedgrid");
});
</script>
<?php } ?>
<?php
$committee_appointed_grid->renderOtherOptions();
?>
<?php if ($committee_appointed_grid->TotalRecords > 0 || $committee_appointed->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($committee_appointed_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> committee_appointed">
<?php if ($committee_appointed_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $committee_appointed_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fcommittee_appointedgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_committee_appointed" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_committee_appointedgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$committee_appointed->RowType = ROWTYPE_HEADER;

// Render list options
$committee_appointed_grid->renderListOptions();

// Render list options (header, left)
$committee_appointed_grid->ListOptions->render("header", "left");
?>
<?php if ($committee_appointed_grid->CommitteCode->Visible) { // CommitteCode ?>
	<?php if ($committee_appointed_grid->SortUrl($committee_appointed_grid->CommitteCode) == "") { ?>
		<th data-name="CommitteCode" class="<?php echo $committee_appointed_grid->CommitteCode->headerCellClass() ?>"><div id="elh_committee_appointed_CommitteCode" class="committee_appointed_CommitteCode"><div class="ew-table-header-caption"><?php echo $committee_appointed_grid->CommitteCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CommitteCode" class="<?php echo $committee_appointed_grid->CommitteCode->headerCellClass() ?>"><div><div id="elh_committee_appointed_CommitteCode" class="committee_appointed_CommitteCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $committee_appointed_grid->CommitteCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($committee_appointed_grid->CommitteCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($committee_appointed_grid->CommitteCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($committee_appointed_grid->CommitteeRole->Visible) { // CommitteeRole ?>
	<?php if ($committee_appointed_grid->SortUrl($committee_appointed_grid->CommitteeRole) == "") { ?>
		<th data-name="CommitteeRole" class="<?php echo $committee_appointed_grid->CommitteeRole->headerCellClass() ?>"><div id="elh_committee_appointed_CommitteeRole" class="committee_appointed_CommitteeRole"><div class="ew-table-header-caption"><?php echo $committee_appointed_grid->CommitteeRole->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CommitteeRole" class="<?php echo $committee_appointed_grid->CommitteeRole->headerCellClass() ?>"><div><div id="elh_committee_appointed_CommitteeRole" class="committee_appointed_CommitteeRole">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $committee_appointed_grid->CommitteeRole->caption() ?></span><span class="ew-table-header-sort"><?php if ($committee_appointed_grid->CommitteeRole->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($committee_appointed_grid->CommitteeRole->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$committee_appointed_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$committee_appointed_grid->StartRecord = 1;
$committee_appointed_grid->StopRecord = $committee_appointed_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($committee_appointed->isConfirm() || $committee_appointed_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($committee_appointed_grid->FormKeyCountName) && ($committee_appointed_grid->isGridAdd() || $committee_appointed_grid->isGridEdit() || $committee_appointed->isConfirm())) {
		$committee_appointed_grid->KeyCount = $CurrentForm->getValue($committee_appointed_grid->FormKeyCountName);
		$committee_appointed_grid->StopRecord = $committee_appointed_grid->StartRecord + $committee_appointed_grid->KeyCount - 1;
	}
}
$committee_appointed_grid->RecordCount = $committee_appointed_grid->StartRecord - 1;
if ($committee_appointed_grid->Recordset && !$committee_appointed_grid->Recordset->EOF) {
	$committee_appointed_grid->Recordset->moveFirst();
	$selectLimit = $committee_appointed_grid->UseSelectLimit;
	if (!$selectLimit && $committee_appointed_grid->StartRecord > 1)
		$committee_appointed_grid->Recordset->move($committee_appointed_grid->StartRecord - 1);
} elseif (!$committee_appointed->AllowAddDeleteRow && $committee_appointed_grid->StopRecord == 0) {
	$committee_appointed_grid->StopRecord = $committee_appointed->GridAddRowCount;
}

// Initialize aggregate
$committee_appointed->RowType = ROWTYPE_AGGREGATEINIT;
$committee_appointed->resetAttributes();
$committee_appointed_grid->renderRow();
if ($committee_appointed_grid->isGridAdd())
	$committee_appointed_grid->RowIndex = 0;
if ($committee_appointed_grid->isGridEdit())
	$committee_appointed_grid->RowIndex = 0;
while ($committee_appointed_grid->RecordCount < $committee_appointed_grid->StopRecord) {
	$committee_appointed_grid->RecordCount++;
	if ($committee_appointed_grid->RecordCount >= $committee_appointed_grid->StartRecord) {
		$committee_appointed_grid->RowCount++;
		if ($committee_appointed_grid->isGridAdd() || $committee_appointed_grid->isGridEdit() || $committee_appointed->isConfirm()) {
			$committee_appointed_grid->RowIndex++;
			$CurrentForm->Index = $committee_appointed_grid->RowIndex;
			if ($CurrentForm->hasValue($committee_appointed_grid->FormActionName) && ($committee_appointed->isConfirm() || $committee_appointed_grid->EventCancelled))
				$committee_appointed_grid->RowAction = strval($CurrentForm->getValue($committee_appointed_grid->FormActionName));
			elseif ($committee_appointed_grid->isGridAdd())
				$committee_appointed_grid->RowAction = "insert";
			else
				$committee_appointed_grid->RowAction = "";
		}

		// Set up key count
		$committee_appointed_grid->KeyCount = $committee_appointed_grid->RowIndex;

		// Init row class and style
		$committee_appointed->resetAttributes();
		$committee_appointed->CssClass = "";
		if ($committee_appointed_grid->isGridAdd()) {
			if ($committee_appointed->CurrentMode == "copy") {
				$committee_appointed_grid->loadRowValues($committee_appointed_grid->Recordset); // Load row values
				$committee_appointed_grid->setRecordKey($committee_appointed_grid->RowOldKey, $committee_appointed_grid->Recordset); // Set old record key
			} else {
				$committee_appointed_grid->loadRowValues(); // Load default values
				$committee_appointed_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$committee_appointed_grid->loadRowValues($committee_appointed_grid->Recordset); // Load row values
		}
		$committee_appointed->RowType = ROWTYPE_VIEW; // Render view
		if ($committee_appointed_grid->isGridAdd()) // Grid add
			$committee_appointed->RowType = ROWTYPE_ADD; // Render add
		if ($committee_appointed_grid->isGridAdd() && $committee_appointed->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$committee_appointed_grid->restoreCurrentRowFormValues($committee_appointed_grid->RowIndex); // Restore form values
		if ($committee_appointed_grid->isGridEdit()) { // Grid edit
			if ($committee_appointed->EventCancelled)
				$committee_appointed_grid->restoreCurrentRowFormValues($committee_appointed_grid->RowIndex); // Restore form values
			if ($committee_appointed_grid->RowAction == "insert")
				$committee_appointed->RowType = ROWTYPE_ADD; // Render add
			else
				$committee_appointed->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($committee_appointed_grid->isGridEdit() && ($committee_appointed->RowType == ROWTYPE_EDIT || $committee_appointed->RowType == ROWTYPE_ADD) && $committee_appointed->EventCancelled) // Update failed
			$committee_appointed_grid->restoreCurrentRowFormValues($committee_appointed_grid->RowIndex); // Restore form values
		if ($committee_appointed->RowType == ROWTYPE_EDIT) // Edit row
			$committee_appointed_grid->EditRowCount++;
		if ($committee_appointed->isConfirm()) // Confirm row
			$committee_appointed_grid->restoreCurrentRowFormValues($committee_appointed_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$committee_appointed->RowAttrs->merge(["data-rowindex" => $committee_appointed_grid->RowCount, "id" => "r" . $committee_appointed_grid->RowCount . "_committee_appointed", "data-rowtype" => $committee_appointed->RowType]);

		// Render row
		$committee_appointed_grid->renderRow();

		// Render list options
		$committee_appointed_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($committee_appointed_grid->RowAction != "delete" && $committee_appointed_grid->RowAction != "insertdelete" && !($committee_appointed_grid->RowAction == "insert" && $committee_appointed->isConfirm() && $committee_appointed_grid->emptyRow())) {
?>
	<tr <?php echo $committee_appointed->rowAttributes() ?>>
<?php

// Render list options (body, left)
$committee_appointed_grid->ListOptions->render("body", "left", $committee_appointed_grid->RowCount);
?>
	<?php if ($committee_appointed_grid->CommitteCode->Visible) { // CommitteCode ?>
		<td data-name="CommitteCode" <?php echo $committee_appointed_grid->CommitteCode->cellAttributes() ?>>
<?php if ($committee_appointed->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $committee_appointed_grid->RowCount ?>_committee_appointed_CommitteCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="committee_appointed" data-field="x_CommitteCode" data-value-separator="<?php echo $committee_appointed_grid->CommitteCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $committee_appointed_grid->RowIndex ?>_CommitteCode" name="x<?php echo $committee_appointed_grid->RowIndex ?>_CommitteCode"<?php echo $committee_appointed_grid->CommitteCode->editAttributes() ?>>
			<?php echo $committee_appointed_grid->CommitteCode->selectOptionListHtml("x{$committee_appointed_grid->RowIndex}_CommitteCode") ?>
		</select>
</div>
<?php echo $committee_appointed_grid->CommitteCode->Lookup->getParamTag($committee_appointed_grid, "p_x" . $committee_appointed_grid->RowIndex . "_CommitteCode") ?>
</span>
<input type="hidden" data-table="committee_appointed" data-field="x_CommitteCode" name="o<?php echo $committee_appointed_grid->RowIndex ?>_CommitteCode" id="o<?php echo $committee_appointed_grid->RowIndex ?>_CommitteCode" value="<?php echo HtmlEncode($committee_appointed_grid->CommitteCode->OldValue) ?>">
<?php } ?>
<?php if ($committee_appointed->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="committee_appointed" data-field="x_CommitteCode" data-value-separator="<?php echo $committee_appointed_grid->CommitteCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $committee_appointed_grid->RowIndex ?>_CommitteCode" name="x<?php echo $committee_appointed_grid->RowIndex ?>_CommitteCode"<?php echo $committee_appointed_grid->CommitteCode->editAttributes() ?>>
			<?php echo $committee_appointed_grid->CommitteCode->selectOptionListHtml("x{$committee_appointed_grid->RowIndex}_CommitteCode") ?>
		</select>
</div>
<?php echo $committee_appointed_grid->CommitteCode->Lookup->getParamTag($committee_appointed_grid, "p_x" . $committee_appointed_grid->RowIndex . "_CommitteCode") ?>
<input type="hidden" data-table="committee_appointed" data-field="x_CommitteCode" name="o<?php echo $committee_appointed_grid->RowIndex ?>_CommitteCode" id="o<?php echo $committee_appointed_grid->RowIndex ?>_CommitteCode" value="<?php echo HtmlEncode($committee_appointed_grid->CommitteCode->OldValue != null ? $committee_appointed_grid->CommitteCode->OldValue : $committee_appointed_grid->CommitteCode->CurrentValue) ?>">
<?php } ?>
<?php if ($committee_appointed->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $committee_appointed_grid->RowCount ?>_committee_appointed_CommitteCode">
<span<?php echo $committee_appointed_grid->CommitteCode->viewAttributes() ?>><?php echo $committee_appointed_grid->CommitteCode->getViewValue() ?></span>
</span>
<?php if (!$committee_appointed->isConfirm()) { ?>
<input type="hidden" data-table="committee_appointed" data-field="x_CommitteCode" name="x<?php echo $committee_appointed_grid->RowIndex ?>_CommitteCode" id="x<?php echo $committee_appointed_grid->RowIndex ?>_CommitteCode" value="<?php echo HtmlEncode($committee_appointed_grid->CommitteCode->FormValue) ?>">
<input type="hidden" data-table="committee_appointed" data-field="x_CommitteCode" name="o<?php echo $committee_appointed_grid->RowIndex ?>_CommitteCode" id="o<?php echo $committee_appointed_grid->RowIndex ?>_CommitteCode" value="<?php echo HtmlEncode($committee_appointed_grid->CommitteCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="committee_appointed" data-field="x_CommitteCode" name="fcommittee_appointedgrid$x<?php echo $committee_appointed_grid->RowIndex ?>_CommitteCode" id="fcommittee_appointedgrid$x<?php echo $committee_appointed_grid->RowIndex ?>_CommitteCode" value="<?php echo HtmlEncode($committee_appointed_grid->CommitteCode->FormValue) ?>">
<input type="hidden" data-table="committee_appointed" data-field="x_CommitteCode" name="fcommittee_appointedgrid$o<?php echo $committee_appointed_grid->RowIndex ?>_CommitteCode" id="fcommittee_appointedgrid$o<?php echo $committee_appointed_grid->RowIndex ?>_CommitteCode" value="<?php echo HtmlEncode($committee_appointed_grid->CommitteCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($committee_appointed->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="committee_appointed" data-field="x_EmployeeID" name="x<?php echo $committee_appointed_grid->RowIndex ?>_EmployeeID" id="x<?php echo $committee_appointed_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($committee_appointed_grid->EmployeeID->CurrentValue) ?>">
<input type="hidden" data-table="committee_appointed" data-field="x_EmployeeID" name="o<?php echo $committee_appointed_grid->RowIndex ?>_EmployeeID" id="o<?php echo $committee_appointed_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($committee_appointed_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($committee_appointed->RowType == ROWTYPE_EDIT || $committee_appointed->CurrentMode == "edit") { ?>
<input type="hidden" data-table="committee_appointed" data-field="x_EmployeeID" name="x<?php echo $committee_appointed_grid->RowIndex ?>_EmployeeID" id="x<?php echo $committee_appointed_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($committee_appointed_grid->EmployeeID->CurrentValue) ?>">
<?php } ?>
	<?php if ($committee_appointed_grid->CommitteeRole->Visible) { // CommitteeRole ?>
		<td data-name="CommitteeRole" <?php echo $committee_appointed_grid->CommitteeRole->cellAttributes() ?>>
<?php if ($committee_appointed->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $committee_appointed_grid->RowCount ?>_committee_appointed_CommitteeRole" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="committee_appointed" data-field="x_CommitteeRole" data-value-separator="<?php echo $committee_appointed_grid->CommitteeRole->displayValueSeparatorAttribute() ?>" id="x<?php echo $committee_appointed_grid->RowIndex ?>_CommitteeRole" name="x<?php echo $committee_appointed_grid->RowIndex ?>_CommitteeRole"<?php echo $committee_appointed_grid->CommitteeRole->editAttributes() ?>>
			<?php echo $committee_appointed_grid->CommitteeRole->selectOptionListHtml("x{$committee_appointed_grid->RowIndex}_CommitteeRole") ?>
		</select>
</div>
<?php echo $committee_appointed_grid->CommitteeRole->Lookup->getParamTag($committee_appointed_grid, "p_x" . $committee_appointed_grid->RowIndex . "_CommitteeRole") ?>
</span>
<input type="hidden" data-table="committee_appointed" data-field="x_CommitteeRole" name="o<?php echo $committee_appointed_grid->RowIndex ?>_CommitteeRole" id="o<?php echo $committee_appointed_grid->RowIndex ?>_CommitteeRole" value="<?php echo HtmlEncode($committee_appointed_grid->CommitteeRole->OldValue) ?>">
<?php } ?>
<?php if ($committee_appointed->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="committee_appointed" data-field="x_CommitteeRole" data-value-separator="<?php echo $committee_appointed_grid->CommitteeRole->displayValueSeparatorAttribute() ?>" id="x<?php echo $committee_appointed_grid->RowIndex ?>_CommitteeRole" name="x<?php echo $committee_appointed_grid->RowIndex ?>_CommitteeRole"<?php echo $committee_appointed_grid->CommitteeRole->editAttributes() ?>>
			<?php echo $committee_appointed_grid->CommitteeRole->selectOptionListHtml("x{$committee_appointed_grid->RowIndex}_CommitteeRole") ?>
		</select>
</div>
<?php echo $committee_appointed_grid->CommitteeRole->Lookup->getParamTag($committee_appointed_grid, "p_x" . $committee_appointed_grid->RowIndex . "_CommitteeRole") ?>
<input type="hidden" data-table="committee_appointed" data-field="x_CommitteeRole" name="o<?php echo $committee_appointed_grid->RowIndex ?>_CommitteeRole" id="o<?php echo $committee_appointed_grid->RowIndex ?>_CommitteeRole" value="<?php echo HtmlEncode($committee_appointed_grid->CommitteeRole->OldValue != null ? $committee_appointed_grid->CommitteeRole->OldValue : $committee_appointed_grid->CommitteeRole->CurrentValue) ?>">
<?php } ?>
<?php if ($committee_appointed->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $committee_appointed_grid->RowCount ?>_committee_appointed_CommitteeRole">
<span<?php echo $committee_appointed_grid->CommitteeRole->viewAttributes() ?>><?php echo $committee_appointed_grid->CommitteeRole->getViewValue() ?></span>
</span>
<?php if (!$committee_appointed->isConfirm()) { ?>
<input type="hidden" data-table="committee_appointed" data-field="x_CommitteeRole" name="x<?php echo $committee_appointed_grid->RowIndex ?>_CommitteeRole" id="x<?php echo $committee_appointed_grid->RowIndex ?>_CommitteeRole" value="<?php echo HtmlEncode($committee_appointed_grid->CommitteeRole->FormValue) ?>">
<input type="hidden" data-table="committee_appointed" data-field="x_CommitteeRole" name="o<?php echo $committee_appointed_grid->RowIndex ?>_CommitteeRole" id="o<?php echo $committee_appointed_grid->RowIndex ?>_CommitteeRole" value="<?php echo HtmlEncode($committee_appointed_grid->CommitteeRole->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="committee_appointed" data-field="x_CommitteeRole" name="fcommittee_appointedgrid$x<?php echo $committee_appointed_grid->RowIndex ?>_CommitteeRole" id="fcommittee_appointedgrid$x<?php echo $committee_appointed_grid->RowIndex ?>_CommitteeRole" value="<?php echo HtmlEncode($committee_appointed_grid->CommitteeRole->FormValue) ?>">
<input type="hidden" data-table="committee_appointed" data-field="x_CommitteeRole" name="fcommittee_appointedgrid$o<?php echo $committee_appointed_grid->RowIndex ?>_CommitteeRole" id="fcommittee_appointedgrid$o<?php echo $committee_appointed_grid->RowIndex ?>_CommitteeRole" value="<?php echo HtmlEncode($committee_appointed_grid->CommitteeRole->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$committee_appointed_grid->ListOptions->render("body", "right", $committee_appointed_grid->RowCount);
?>
	</tr>
<?php if ($committee_appointed->RowType == ROWTYPE_ADD || $committee_appointed->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fcommittee_appointedgrid", "load"], function() {
	fcommittee_appointedgrid.updateLists(<?php echo $committee_appointed_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$committee_appointed_grid->isGridAdd() || $committee_appointed->CurrentMode == "copy")
		if (!$committee_appointed_grid->Recordset->EOF)
			$committee_appointed_grid->Recordset->moveNext();
}
?>
<?php
	if ($committee_appointed->CurrentMode == "add" || $committee_appointed->CurrentMode == "copy" || $committee_appointed->CurrentMode == "edit") {
		$committee_appointed_grid->RowIndex = '$rowindex$';
		$committee_appointed_grid->loadRowValues();

		// Set row properties
		$committee_appointed->resetAttributes();
		$committee_appointed->RowAttrs->merge(["data-rowindex" => $committee_appointed_grid->RowIndex, "id" => "r0_committee_appointed", "data-rowtype" => ROWTYPE_ADD]);
		$committee_appointed->RowAttrs->appendClass("ew-template");
		$committee_appointed->RowType = ROWTYPE_ADD;

		// Render row
		$committee_appointed_grid->renderRow();

		// Render list options
		$committee_appointed_grid->renderListOptions();
		$committee_appointed_grid->StartRowCount = 0;
?>
	<tr <?php echo $committee_appointed->rowAttributes() ?>>
<?php

// Render list options (body, left)
$committee_appointed_grid->ListOptions->render("body", "left", $committee_appointed_grid->RowIndex);
?>
	<?php if ($committee_appointed_grid->CommitteCode->Visible) { // CommitteCode ?>
		<td data-name="CommitteCode">
<?php if (!$committee_appointed->isConfirm()) { ?>
<span id="el$rowindex$_committee_appointed_CommitteCode" class="form-group committee_appointed_CommitteCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="committee_appointed" data-field="x_CommitteCode" data-value-separator="<?php echo $committee_appointed_grid->CommitteCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $committee_appointed_grid->RowIndex ?>_CommitteCode" name="x<?php echo $committee_appointed_grid->RowIndex ?>_CommitteCode"<?php echo $committee_appointed_grid->CommitteCode->editAttributes() ?>>
			<?php echo $committee_appointed_grid->CommitteCode->selectOptionListHtml("x{$committee_appointed_grid->RowIndex}_CommitteCode") ?>
		</select>
</div>
<?php echo $committee_appointed_grid->CommitteCode->Lookup->getParamTag($committee_appointed_grid, "p_x" . $committee_appointed_grid->RowIndex . "_CommitteCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_committee_appointed_CommitteCode" class="form-group committee_appointed_CommitteCode">
<span<?php echo $committee_appointed_grid->CommitteCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($committee_appointed_grid->CommitteCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="committee_appointed" data-field="x_CommitteCode" name="x<?php echo $committee_appointed_grid->RowIndex ?>_CommitteCode" id="x<?php echo $committee_appointed_grid->RowIndex ?>_CommitteCode" value="<?php echo HtmlEncode($committee_appointed_grid->CommitteCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="committee_appointed" data-field="x_CommitteCode" name="o<?php echo $committee_appointed_grid->RowIndex ?>_CommitteCode" id="o<?php echo $committee_appointed_grid->RowIndex ?>_CommitteCode" value="<?php echo HtmlEncode($committee_appointed_grid->CommitteCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($committee_appointed_grid->CommitteeRole->Visible) { // CommitteeRole ?>
		<td data-name="CommitteeRole">
<?php if (!$committee_appointed->isConfirm()) { ?>
<span id="el$rowindex$_committee_appointed_CommitteeRole" class="form-group committee_appointed_CommitteeRole">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="committee_appointed" data-field="x_CommitteeRole" data-value-separator="<?php echo $committee_appointed_grid->CommitteeRole->displayValueSeparatorAttribute() ?>" id="x<?php echo $committee_appointed_grid->RowIndex ?>_CommitteeRole" name="x<?php echo $committee_appointed_grid->RowIndex ?>_CommitteeRole"<?php echo $committee_appointed_grid->CommitteeRole->editAttributes() ?>>
			<?php echo $committee_appointed_grid->CommitteeRole->selectOptionListHtml("x{$committee_appointed_grid->RowIndex}_CommitteeRole") ?>
		</select>
</div>
<?php echo $committee_appointed_grid->CommitteeRole->Lookup->getParamTag($committee_appointed_grid, "p_x" . $committee_appointed_grid->RowIndex . "_CommitteeRole") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_committee_appointed_CommitteeRole" class="form-group committee_appointed_CommitteeRole">
<span<?php echo $committee_appointed_grid->CommitteeRole->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($committee_appointed_grid->CommitteeRole->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="committee_appointed" data-field="x_CommitteeRole" name="x<?php echo $committee_appointed_grid->RowIndex ?>_CommitteeRole" id="x<?php echo $committee_appointed_grid->RowIndex ?>_CommitteeRole" value="<?php echo HtmlEncode($committee_appointed_grid->CommitteeRole->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="committee_appointed" data-field="x_CommitteeRole" name="o<?php echo $committee_appointed_grid->RowIndex ?>_CommitteeRole" id="o<?php echo $committee_appointed_grid->RowIndex ?>_CommitteeRole" value="<?php echo HtmlEncode($committee_appointed_grid->CommitteeRole->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$committee_appointed_grid->ListOptions->render("body", "right", $committee_appointed_grid->RowIndex);
?>
<script>
loadjs.ready(["fcommittee_appointedgrid", "load"], function() {
	fcommittee_appointedgrid.updateLists(<?php echo $committee_appointed_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($committee_appointed->CurrentMode == "add" || $committee_appointed->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $committee_appointed_grid->FormKeyCountName ?>" id="<?php echo $committee_appointed_grid->FormKeyCountName ?>" value="<?php echo $committee_appointed_grid->KeyCount ?>">
<?php echo $committee_appointed_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($committee_appointed->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $committee_appointed_grid->FormKeyCountName ?>" id="<?php echo $committee_appointed_grid->FormKeyCountName ?>" value="<?php echo $committee_appointed_grid->KeyCount ?>">
<?php echo $committee_appointed_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($committee_appointed->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcommittee_appointedgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($committee_appointed_grid->Recordset)
	$committee_appointed_grid->Recordset->Close();
?>
<?php if ($committee_appointed_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $committee_appointed_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($committee_appointed_grid->TotalRecords == 0 && !$committee_appointed->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $committee_appointed_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$committee_appointed_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$committee_appointed_grid->terminate();
?>