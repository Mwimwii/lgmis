<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($pillars_grid))
	$pillars_grid = new pillars_grid();

// Run the page
$pillars_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pillars_grid->Page_Render();
?>
<?php if (!$pillars_grid->isExport()) { ?>
<script>
var fpillarsgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fpillarsgrid = new ew.Form("fpillarsgrid", "grid");
	fpillarsgrid.formKeyCountName = '<?php echo $pillars_grid->FormKeyCountName ?>';

	// Validate form
	fpillarsgrid.validate = function() {
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
			<?php if ($pillars_grid->NDP->Required) { ?>
				elm = this.getElements("x" + infix + "_NDP");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pillars_grid->NDP->caption(), $pillars_grid->NDP->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NDP");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pillars_grid->NDP->errorMessage()) ?>");
			<?php if ($pillars_grid->PillarNo->Required) { ?>
				elm = this.getElements("x" + infix + "_PillarNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pillars_grid->PillarNo->caption(), $pillars_grid->PillarNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PillarNo");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pillars_grid->PillarNo->errorMessage()) ?>");
			<?php if ($pillars_grid->PillarName->Required) { ?>
				elm = this.getElements("x" + infix + "_PillarName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pillars_grid->PillarName->caption(), $pillars_grid->PillarName->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fpillarsgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "NDP", false)) return false;
		if (ew.valueChanged(fobj, infix, "PillarNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "PillarName", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fpillarsgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpillarsgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpillarsgrid");
});
</script>
<?php } ?>
<?php
$pillars_grid->renderOtherOptions();
?>
<?php if ($pillars_grid->TotalRecords > 0 || $pillars->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($pillars_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> pillars">
<?php if ($pillars_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $pillars_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fpillarsgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_pillars" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_pillarsgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$pillars->RowType = ROWTYPE_HEADER;

// Render list options
$pillars_grid->renderListOptions();

// Render list options (header, left)
$pillars_grid->ListOptions->render("header", "left");
?>
<?php if ($pillars_grid->NDP->Visible) { // NDP ?>
	<?php if ($pillars_grid->SortUrl($pillars_grid->NDP) == "") { ?>
		<th data-name="NDP" class="<?php echo $pillars_grid->NDP->headerCellClass() ?>"><div id="elh_pillars_NDP" class="pillars_NDP"><div class="ew-table-header-caption"><?php echo $pillars_grid->NDP->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NDP" class="<?php echo $pillars_grid->NDP->headerCellClass() ?>"><div><div id="elh_pillars_NDP" class="pillars_NDP">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pillars_grid->NDP->caption() ?></span><span class="ew-table-header-sort"><?php if ($pillars_grid->NDP->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pillars_grid->NDP->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pillars_grid->PillarNo->Visible) { // PillarNo ?>
	<?php if ($pillars_grid->SortUrl($pillars_grid->PillarNo) == "") { ?>
		<th data-name="PillarNo" class="<?php echo $pillars_grid->PillarNo->headerCellClass() ?>"><div id="elh_pillars_PillarNo" class="pillars_PillarNo"><div class="ew-table-header-caption"><?php echo $pillars_grid->PillarNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PillarNo" class="<?php echo $pillars_grid->PillarNo->headerCellClass() ?>"><div><div id="elh_pillars_PillarNo" class="pillars_PillarNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pillars_grid->PillarNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($pillars_grid->PillarNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pillars_grid->PillarNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pillars_grid->PillarName->Visible) { // PillarName ?>
	<?php if ($pillars_grid->SortUrl($pillars_grid->PillarName) == "") { ?>
		<th data-name="PillarName" class="<?php echo $pillars_grid->PillarName->headerCellClass() ?>"><div id="elh_pillars_PillarName" class="pillars_PillarName"><div class="ew-table-header-caption"><?php echo $pillars_grid->PillarName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PillarName" class="<?php echo $pillars_grid->PillarName->headerCellClass() ?>"><div><div id="elh_pillars_PillarName" class="pillars_PillarName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pillars_grid->PillarName->caption() ?></span><span class="ew-table-header-sort"><?php if ($pillars_grid->PillarName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pillars_grid->PillarName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$pillars_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$pillars_grid->StartRecord = 1;
$pillars_grid->StopRecord = $pillars_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($pillars->isConfirm() || $pillars_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($pillars_grid->FormKeyCountName) && ($pillars_grid->isGridAdd() || $pillars_grid->isGridEdit() || $pillars->isConfirm())) {
		$pillars_grid->KeyCount = $CurrentForm->getValue($pillars_grid->FormKeyCountName);
		$pillars_grid->StopRecord = $pillars_grid->StartRecord + $pillars_grid->KeyCount - 1;
	}
}
$pillars_grid->RecordCount = $pillars_grid->StartRecord - 1;
if ($pillars_grid->Recordset && !$pillars_grid->Recordset->EOF) {
	$pillars_grid->Recordset->moveFirst();
	$selectLimit = $pillars_grid->UseSelectLimit;
	if (!$selectLimit && $pillars_grid->StartRecord > 1)
		$pillars_grid->Recordset->move($pillars_grid->StartRecord - 1);
} elseif (!$pillars->AllowAddDeleteRow && $pillars_grid->StopRecord == 0) {
	$pillars_grid->StopRecord = $pillars->GridAddRowCount;
}

// Initialize aggregate
$pillars->RowType = ROWTYPE_AGGREGATEINIT;
$pillars->resetAttributes();
$pillars_grid->renderRow();
if ($pillars_grid->isGridAdd())
	$pillars_grid->RowIndex = 0;
if ($pillars_grid->isGridEdit())
	$pillars_grid->RowIndex = 0;
while ($pillars_grid->RecordCount < $pillars_grid->StopRecord) {
	$pillars_grid->RecordCount++;
	if ($pillars_grid->RecordCount >= $pillars_grid->StartRecord) {
		$pillars_grid->RowCount++;
		if ($pillars_grid->isGridAdd() || $pillars_grid->isGridEdit() || $pillars->isConfirm()) {
			$pillars_grid->RowIndex++;
			$CurrentForm->Index = $pillars_grid->RowIndex;
			if ($CurrentForm->hasValue($pillars_grid->FormActionName) && ($pillars->isConfirm() || $pillars_grid->EventCancelled))
				$pillars_grid->RowAction = strval($CurrentForm->getValue($pillars_grid->FormActionName));
			elseif ($pillars_grid->isGridAdd())
				$pillars_grid->RowAction = "insert";
			else
				$pillars_grid->RowAction = "";
		}

		// Set up key count
		$pillars_grid->KeyCount = $pillars_grid->RowIndex;

		// Init row class and style
		$pillars->resetAttributes();
		$pillars->CssClass = "";
		if ($pillars_grid->isGridAdd()) {
			if ($pillars->CurrentMode == "copy") {
				$pillars_grid->loadRowValues($pillars_grid->Recordset); // Load row values
				$pillars_grid->setRecordKey($pillars_grid->RowOldKey, $pillars_grid->Recordset); // Set old record key
			} else {
				$pillars_grid->loadRowValues(); // Load default values
				$pillars_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$pillars_grid->loadRowValues($pillars_grid->Recordset); // Load row values
		}
		$pillars->RowType = ROWTYPE_VIEW; // Render view
		if ($pillars_grid->isGridAdd()) // Grid add
			$pillars->RowType = ROWTYPE_ADD; // Render add
		if ($pillars_grid->isGridAdd() && $pillars->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$pillars_grid->restoreCurrentRowFormValues($pillars_grid->RowIndex); // Restore form values
		if ($pillars_grid->isGridEdit()) { // Grid edit
			if ($pillars->EventCancelled)
				$pillars_grid->restoreCurrentRowFormValues($pillars_grid->RowIndex); // Restore form values
			if ($pillars_grid->RowAction == "insert")
				$pillars->RowType = ROWTYPE_ADD; // Render add
			else
				$pillars->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($pillars_grid->isGridEdit() && ($pillars->RowType == ROWTYPE_EDIT || $pillars->RowType == ROWTYPE_ADD) && $pillars->EventCancelled) // Update failed
			$pillars_grid->restoreCurrentRowFormValues($pillars_grid->RowIndex); // Restore form values
		if ($pillars->RowType == ROWTYPE_EDIT) // Edit row
			$pillars_grid->EditRowCount++;
		if ($pillars->isConfirm()) // Confirm row
			$pillars_grid->restoreCurrentRowFormValues($pillars_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$pillars->RowAttrs->merge(["data-rowindex" => $pillars_grid->RowCount, "id" => "r" . $pillars_grid->RowCount . "_pillars", "data-rowtype" => $pillars->RowType]);

		// Render row
		$pillars_grid->renderRow();

		// Render list options
		$pillars_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($pillars_grid->RowAction != "delete" && $pillars_grid->RowAction != "insertdelete" && !($pillars_grid->RowAction == "insert" && $pillars->isConfirm() && $pillars_grid->emptyRow())) {
?>
	<tr <?php echo $pillars->rowAttributes() ?>>
<?php

// Render list options (body, left)
$pillars_grid->ListOptions->render("body", "left", $pillars_grid->RowCount);
?>
	<?php if ($pillars_grid->NDP->Visible) { // NDP ?>
		<td data-name="NDP" <?php echo $pillars_grid->NDP->cellAttributes() ?>>
<?php if ($pillars->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($pillars_grid->NDP->getSessionValue() != "") { ?>
<span id="el<?php echo $pillars_grid->RowCount ?>_pillars_NDP" class="form-group">
<span<?php echo $pillars_grid->NDP->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($pillars_grid->NDP->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $pillars_grid->RowIndex ?>_NDP" name="x<?php echo $pillars_grid->RowIndex ?>_NDP" value="<?php echo HtmlEncode($pillars_grid->NDP->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $pillars_grid->RowCount ?>_pillars_NDP" class="form-group">
<input type="text" data-table="pillars" data-field="x_NDP" name="x<?php echo $pillars_grid->RowIndex ?>_NDP" id="x<?php echo $pillars_grid->RowIndex ?>_NDP" size="30" placeholder="<?php echo HtmlEncode($pillars_grid->NDP->getPlaceHolder()) ?>" value="<?php echo $pillars_grid->NDP->EditValue ?>"<?php echo $pillars_grid->NDP->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="pillars" data-field="x_NDP" name="o<?php echo $pillars_grid->RowIndex ?>_NDP" id="o<?php echo $pillars_grid->RowIndex ?>_NDP" value="<?php echo HtmlEncode($pillars_grid->NDP->OldValue) ?>">
<?php } ?>
<?php if ($pillars->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($pillars_grid->NDP->getSessionValue() != "") { ?>
<span id="el<?php echo $pillars_grid->RowCount ?>_pillars_NDP" class="form-group">
<span<?php echo $pillars_grid->NDP->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($pillars_grid->NDP->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $pillars_grid->RowIndex ?>_NDP" name="x<?php echo $pillars_grid->RowIndex ?>_NDP" value="<?php echo HtmlEncode($pillars_grid->NDP->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $pillars_grid->RowCount ?>_pillars_NDP" class="form-group">
<input type="text" data-table="pillars" data-field="x_NDP" name="x<?php echo $pillars_grid->RowIndex ?>_NDP" id="x<?php echo $pillars_grid->RowIndex ?>_NDP" size="30" placeholder="<?php echo HtmlEncode($pillars_grid->NDP->getPlaceHolder()) ?>" value="<?php echo $pillars_grid->NDP->EditValue ?>"<?php echo $pillars_grid->NDP->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($pillars->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pillars_grid->RowCount ?>_pillars_NDP">
<span<?php echo $pillars_grid->NDP->viewAttributes() ?>><?php echo $pillars_grid->NDP->getViewValue() ?></span>
</span>
<?php if (!$pillars->isConfirm()) { ?>
<input type="hidden" data-table="pillars" data-field="x_NDP" name="x<?php echo $pillars_grid->RowIndex ?>_NDP" id="x<?php echo $pillars_grid->RowIndex ?>_NDP" value="<?php echo HtmlEncode($pillars_grid->NDP->FormValue) ?>">
<input type="hidden" data-table="pillars" data-field="x_NDP" name="o<?php echo $pillars_grid->RowIndex ?>_NDP" id="o<?php echo $pillars_grid->RowIndex ?>_NDP" value="<?php echo HtmlEncode($pillars_grid->NDP->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="pillars" data-field="x_NDP" name="fpillarsgrid$x<?php echo $pillars_grid->RowIndex ?>_NDP" id="fpillarsgrid$x<?php echo $pillars_grid->RowIndex ?>_NDP" value="<?php echo HtmlEncode($pillars_grid->NDP->FormValue) ?>">
<input type="hidden" data-table="pillars" data-field="x_NDP" name="fpillarsgrid$o<?php echo $pillars_grid->RowIndex ?>_NDP" id="fpillarsgrid$o<?php echo $pillars_grid->RowIndex ?>_NDP" value="<?php echo HtmlEncode($pillars_grid->NDP->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pillars_grid->PillarNo->Visible) { // PillarNo ?>
		<td data-name="PillarNo" <?php echo $pillars_grid->PillarNo->cellAttributes() ?>>
<?php if ($pillars->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $pillars_grid->RowCount ?>_pillars_PillarNo" class="form-group">
<input type="text" data-table="pillars" data-field="x_PillarNo" name="x<?php echo $pillars_grid->RowIndex ?>_PillarNo" id="x<?php echo $pillars_grid->RowIndex ?>_PillarNo" size="30" placeholder="<?php echo HtmlEncode($pillars_grid->PillarNo->getPlaceHolder()) ?>" value="<?php echo $pillars_grid->PillarNo->EditValue ?>"<?php echo $pillars_grid->PillarNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="pillars" data-field="x_PillarNo" name="o<?php echo $pillars_grid->RowIndex ?>_PillarNo" id="o<?php echo $pillars_grid->RowIndex ?>_PillarNo" value="<?php echo HtmlEncode($pillars_grid->PillarNo->OldValue) ?>">
<?php } ?>
<?php if ($pillars->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="pillars" data-field="x_PillarNo" name="x<?php echo $pillars_grid->RowIndex ?>_PillarNo" id="x<?php echo $pillars_grid->RowIndex ?>_PillarNo" size="30" placeholder="<?php echo HtmlEncode($pillars_grid->PillarNo->getPlaceHolder()) ?>" value="<?php echo $pillars_grid->PillarNo->EditValue ?>"<?php echo $pillars_grid->PillarNo->editAttributes() ?>>
<input type="hidden" data-table="pillars" data-field="x_PillarNo" name="o<?php echo $pillars_grid->RowIndex ?>_PillarNo" id="o<?php echo $pillars_grid->RowIndex ?>_PillarNo" value="<?php echo HtmlEncode($pillars_grid->PillarNo->OldValue != null ? $pillars_grid->PillarNo->OldValue : $pillars_grid->PillarNo->CurrentValue) ?>">
<?php } ?>
<?php if ($pillars->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pillars_grid->RowCount ?>_pillars_PillarNo">
<span<?php echo $pillars_grid->PillarNo->viewAttributes() ?>><?php echo $pillars_grid->PillarNo->getViewValue() ?></span>
</span>
<?php if (!$pillars->isConfirm()) { ?>
<input type="hidden" data-table="pillars" data-field="x_PillarNo" name="x<?php echo $pillars_grid->RowIndex ?>_PillarNo" id="x<?php echo $pillars_grid->RowIndex ?>_PillarNo" value="<?php echo HtmlEncode($pillars_grid->PillarNo->FormValue) ?>">
<input type="hidden" data-table="pillars" data-field="x_PillarNo" name="o<?php echo $pillars_grid->RowIndex ?>_PillarNo" id="o<?php echo $pillars_grid->RowIndex ?>_PillarNo" value="<?php echo HtmlEncode($pillars_grid->PillarNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="pillars" data-field="x_PillarNo" name="fpillarsgrid$x<?php echo $pillars_grid->RowIndex ?>_PillarNo" id="fpillarsgrid$x<?php echo $pillars_grid->RowIndex ?>_PillarNo" value="<?php echo HtmlEncode($pillars_grid->PillarNo->FormValue) ?>">
<input type="hidden" data-table="pillars" data-field="x_PillarNo" name="fpillarsgrid$o<?php echo $pillars_grid->RowIndex ?>_PillarNo" id="fpillarsgrid$o<?php echo $pillars_grid->RowIndex ?>_PillarNo" value="<?php echo HtmlEncode($pillars_grid->PillarNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pillars_grid->PillarName->Visible) { // PillarName ?>
		<td data-name="PillarName" <?php echo $pillars_grid->PillarName->cellAttributes() ?>>
<?php if ($pillars->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $pillars_grid->RowCount ?>_pillars_PillarName" class="form-group">
<textarea data-table="pillars" data-field="x_PillarName" name="x<?php echo $pillars_grid->RowIndex ?>_PillarName" id="x<?php echo $pillars_grid->RowIndex ?>_PillarName" cols="35" rows="2" placeholder="<?php echo HtmlEncode($pillars_grid->PillarName->getPlaceHolder()) ?>"<?php echo $pillars_grid->PillarName->editAttributes() ?>><?php echo $pillars_grid->PillarName->EditValue ?></textarea>
</span>
<input type="hidden" data-table="pillars" data-field="x_PillarName" name="o<?php echo $pillars_grid->RowIndex ?>_PillarName" id="o<?php echo $pillars_grid->RowIndex ?>_PillarName" value="<?php echo HtmlEncode($pillars_grid->PillarName->OldValue) ?>">
<?php } ?>
<?php if ($pillars->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $pillars_grid->RowCount ?>_pillars_PillarName" class="form-group">
<textarea data-table="pillars" data-field="x_PillarName" name="x<?php echo $pillars_grid->RowIndex ?>_PillarName" id="x<?php echo $pillars_grid->RowIndex ?>_PillarName" cols="35" rows="2" placeholder="<?php echo HtmlEncode($pillars_grid->PillarName->getPlaceHolder()) ?>"<?php echo $pillars_grid->PillarName->editAttributes() ?>><?php echo $pillars_grid->PillarName->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($pillars->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pillars_grid->RowCount ?>_pillars_PillarName">
<span<?php echo $pillars_grid->PillarName->viewAttributes() ?>><?php echo $pillars_grid->PillarName->getViewValue() ?></span>
</span>
<?php if (!$pillars->isConfirm()) { ?>
<input type="hidden" data-table="pillars" data-field="x_PillarName" name="x<?php echo $pillars_grid->RowIndex ?>_PillarName" id="x<?php echo $pillars_grid->RowIndex ?>_PillarName" value="<?php echo HtmlEncode($pillars_grid->PillarName->FormValue) ?>">
<input type="hidden" data-table="pillars" data-field="x_PillarName" name="o<?php echo $pillars_grid->RowIndex ?>_PillarName" id="o<?php echo $pillars_grid->RowIndex ?>_PillarName" value="<?php echo HtmlEncode($pillars_grid->PillarName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="pillars" data-field="x_PillarName" name="fpillarsgrid$x<?php echo $pillars_grid->RowIndex ?>_PillarName" id="fpillarsgrid$x<?php echo $pillars_grid->RowIndex ?>_PillarName" value="<?php echo HtmlEncode($pillars_grid->PillarName->FormValue) ?>">
<input type="hidden" data-table="pillars" data-field="x_PillarName" name="fpillarsgrid$o<?php echo $pillars_grid->RowIndex ?>_PillarName" id="fpillarsgrid$o<?php echo $pillars_grid->RowIndex ?>_PillarName" value="<?php echo HtmlEncode($pillars_grid->PillarName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pillars_grid->ListOptions->render("body", "right", $pillars_grid->RowCount);
?>
	</tr>
<?php if ($pillars->RowType == ROWTYPE_ADD || $pillars->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fpillarsgrid", "load"], function() {
	fpillarsgrid.updateLists(<?php echo $pillars_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$pillars_grid->isGridAdd() || $pillars->CurrentMode == "copy")
		if (!$pillars_grid->Recordset->EOF)
			$pillars_grid->Recordset->moveNext();
}
?>
<?php
	if ($pillars->CurrentMode == "add" || $pillars->CurrentMode == "copy" || $pillars->CurrentMode == "edit") {
		$pillars_grid->RowIndex = '$rowindex$';
		$pillars_grid->loadRowValues();

		// Set row properties
		$pillars->resetAttributes();
		$pillars->RowAttrs->merge(["data-rowindex" => $pillars_grid->RowIndex, "id" => "r0_pillars", "data-rowtype" => ROWTYPE_ADD]);
		$pillars->RowAttrs->appendClass("ew-template");
		$pillars->RowType = ROWTYPE_ADD;

		// Render row
		$pillars_grid->renderRow();

		// Render list options
		$pillars_grid->renderListOptions();
		$pillars_grid->StartRowCount = 0;
?>
	<tr <?php echo $pillars->rowAttributes() ?>>
<?php

// Render list options (body, left)
$pillars_grid->ListOptions->render("body", "left", $pillars_grid->RowIndex);
?>
	<?php if ($pillars_grid->NDP->Visible) { // NDP ?>
		<td data-name="NDP">
<?php if (!$pillars->isConfirm()) { ?>
<?php if ($pillars_grid->NDP->getSessionValue() != "") { ?>
<span id="el$rowindex$_pillars_NDP" class="form-group pillars_NDP">
<span<?php echo $pillars_grid->NDP->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($pillars_grid->NDP->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $pillars_grid->RowIndex ?>_NDP" name="x<?php echo $pillars_grid->RowIndex ?>_NDP" value="<?php echo HtmlEncode($pillars_grid->NDP->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_pillars_NDP" class="form-group pillars_NDP">
<input type="text" data-table="pillars" data-field="x_NDP" name="x<?php echo $pillars_grid->RowIndex ?>_NDP" id="x<?php echo $pillars_grid->RowIndex ?>_NDP" size="30" placeholder="<?php echo HtmlEncode($pillars_grid->NDP->getPlaceHolder()) ?>" value="<?php echo $pillars_grid->NDP->EditValue ?>"<?php echo $pillars_grid->NDP->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_pillars_NDP" class="form-group pillars_NDP">
<span<?php echo $pillars_grid->NDP->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($pillars_grid->NDP->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="pillars" data-field="x_NDP" name="x<?php echo $pillars_grid->RowIndex ?>_NDP" id="x<?php echo $pillars_grid->RowIndex ?>_NDP" value="<?php echo HtmlEncode($pillars_grid->NDP->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pillars" data-field="x_NDP" name="o<?php echo $pillars_grid->RowIndex ?>_NDP" id="o<?php echo $pillars_grid->RowIndex ?>_NDP" value="<?php echo HtmlEncode($pillars_grid->NDP->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pillars_grid->PillarNo->Visible) { // PillarNo ?>
		<td data-name="PillarNo">
<?php if (!$pillars->isConfirm()) { ?>
<span id="el$rowindex$_pillars_PillarNo" class="form-group pillars_PillarNo">
<input type="text" data-table="pillars" data-field="x_PillarNo" name="x<?php echo $pillars_grid->RowIndex ?>_PillarNo" id="x<?php echo $pillars_grid->RowIndex ?>_PillarNo" size="30" placeholder="<?php echo HtmlEncode($pillars_grid->PillarNo->getPlaceHolder()) ?>" value="<?php echo $pillars_grid->PillarNo->EditValue ?>"<?php echo $pillars_grid->PillarNo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_pillars_PillarNo" class="form-group pillars_PillarNo">
<span<?php echo $pillars_grid->PillarNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($pillars_grid->PillarNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="pillars" data-field="x_PillarNo" name="x<?php echo $pillars_grid->RowIndex ?>_PillarNo" id="x<?php echo $pillars_grid->RowIndex ?>_PillarNo" value="<?php echo HtmlEncode($pillars_grid->PillarNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pillars" data-field="x_PillarNo" name="o<?php echo $pillars_grid->RowIndex ?>_PillarNo" id="o<?php echo $pillars_grid->RowIndex ?>_PillarNo" value="<?php echo HtmlEncode($pillars_grid->PillarNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pillars_grid->PillarName->Visible) { // PillarName ?>
		<td data-name="PillarName">
<?php if (!$pillars->isConfirm()) { ?>
<span id="el$rowindex$_pillars_PillarName" class="form-group pillars_PillarName">
<textarea data-table="pillars" data-field="x_PillarName" name="x<?php echo $pillars_grid->RowIndex ?>_PillarName" id="x<?php echo $pillars_grid->RowIndex ?>_PillarName" cols="35" rows="2" placeholder="<?php echo HtmlEncode($pillars_grid->PillarName->getPlaceHolder()) ?>"<?php echo $pillars_grid->PillarName->editAttributes() ?>><?php echo $pillars_grid->PillarName->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_pillars_PillarName" class="form-group pillars_PillarName">
<span<?php echo $pillars_grid->PillarName->viewAttributes() ?>><?php echo $pillars_grid->PillarName->ViewValue ?></span>
</span>
<input type="hidden" data-table="pillars" data-field="x_PillarName" name="x<?php echo $pillars_grid->RowIndex ?>_PillarName" id="x<?php echo $pillars_grid->RowIndex ?>_PillarName" value="<?php echo HtmlEncode($pillars_grid->PillarName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pillars" data-field="x_PillarName" name="o<?php echo $pillars_grid->RowIndex ?>_PillarName" id="o<?php echo $pillars_grid->RowIndex ?>_PillarName" value="<?php echo HtmlEncode($pillars_grid->PillarName->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pillars_grid->ListOptions->render("body", "right", $pillars_grid->RowIndex);
?>
<script>
loadjs.ready(["fpillarsgrid", "load"], function() {
	fpillarsgrid.updateLists(<?php echo $pillars_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($pillars->CurrentMode == "add" || $pillars->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $pillars_grid->FormKeyCountName ?>" id="<?php echo $pillars_grid->FormKeyCountName ?>" value="<?php echo $pillars_grid->KeyCount ?>">
<?php echo $pillars_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($pillars->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $pillars_grid->FormKeyCountName ?>" id="<?php echo $pillars_grid->FormKeyCountName ?>" value="<?php echo $pillars_grid->KeyCount ?>">
<?php echo $pillars_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($pillars->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fpillarsgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($pillars_grid->Recordset)
	$pillars_grid->Recordset->Close();
?>
<?php if ($pillars_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $pillars_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($pillars_grid->TotalRecords == 0 && !$pillars->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $pillars_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$pillars_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$pillars_grid->terminate();
?>