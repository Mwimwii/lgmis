<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($ward_grid))
	$ward_grid = new ward_grid();

// Run the page
$ward_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ward_grid->Page_Render();
?>
<?php if (!$ward_grid->isExport()) { ?>
<script>
var fwardgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fwardgrid = new ew.Form("fwardgrid", "grid");
	fwardgrid.formKeyCountName = '<?php echo $ward_grid->FormKeyCountName ?>';

	// Validate form
	fwardgrid.validate = function() {
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
			<?php if ($ward_grid->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ward_grid->LACode->caption(), $ward_grid->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ward_grid->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ward_grid->ProvinceCode->caption(), $ward_grid->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ward_grid->ProvinceCode->errorMessage()) ?>");
			<?php if ($ward_grid->WardCode->Required) { ?>
				elm = this.getElements("x" + infix + "_WardCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ward_grid->WardCode->caption(), $ward_grid->WardCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ward_grid->WardName->Required) { ?>
				elm = this.getElements("x" + infix + "_WardName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ward_grid->WardName->caption(), $ward_grid->WardName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ward_grid->Population->Required) { ?>
				elm = this.getElements("x" + infix + "_Population");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ward_grid->Population->caption(), $ward_grid->Population->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Population");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ward_grid->Population->errorMessage()) ?>");
			<?php if ($ward_grid->Areas->Required) { ?>
				elm = this.getElements("x" + infix + "_Areas");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ward_grid->Areas->caption(), $ward_grid->Areas->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fwardgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProvinceCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "WardName", false)) return false;
		if (ew.valueChanged(fobj, infix, "Population", false)) return false;
		if (ew.valueChanged(fobj, infix, "Areas", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fwardgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fwardgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fwardgrid");
});
</script>
<?php } ?>
<?php
$ward_grid->renderOtherOptions();
?>
<?php if ($ward_grid->TotalRecords > 0 || $ward->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ward_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ward">
<?php if ($ward_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $ward_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fwardgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_ward" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_wardgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ward->RowType = ROWTYPE_HEADER;

// Render list options
$ward_grid->renderListOptions();

// Render list options (header, left)
$ward_grid->ListOptions->render("header", "left");
?>
<?php if ($ward_grid->LACode->Visible) { // LACode ?>
	<?php if ($ward_grid->SortUrl($ward_grid->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $ward_grid->LACode->headerCellClass() ?>"><div id="elh_ward_LACode" class="ward_LACode"><div class="ew-table-header-caption"><?php echo $ward_grid->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $ward_grid->LACode->headerCellClass() ?>"><div><div id="elh_ward_LACode" class="ward_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ward_grid->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($ward_grid->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ward_grid->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ward_grid->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($ward_grid->SortUrl($ward_grid->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $ward_grid->ProvinceCode->headerCellClass() ?>"><div id="elh_ward_ProvinceCode" class="ward_ProvinceCode"><div class="ew-table-header-caption"><?php echo $ward_grid->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $ward_grid->ProvinceCode->headerCellClass() ?>"><div><div id="elh_ward_ProvinceCode" class="ward_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ward_grid->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($ward_grid->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ward_grid->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ward_grid->WardCode->Visible) { // WardCode ?>
	<?php if ($ward_grid->SortUrl($ward_grid->WardCode) == "") { ?>
		<th data-name="WardCode" class="<?php echo $ward_grid->WardCode->headerCellClass() ?>"><div id="elh_ward_WardCode" class="ward_WardCode"><div class="ew-table-header-caption"><?php echo $ward_grid->WardCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WardCode" class="<?php echo $ward_grid->WardCode->headerCellClass() ?>"><div><div id="elh_ward_WardCode" class="ward_WardCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ward_grid->WardCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($ward_grid->WardCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ward_grid->WardCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ward_grid->WardName->Visible) { // WardName ?>
	<?php if ($ward_grid->SortUrl($ward_grid->WardName) == "") { ?>
		<th data-name="WardName" class="<?php echo $ward_grid->WardName->headerCellClass() ?>"><div id="elh_ward_WardName" class="ward_WardName"><div class="ew-table-header-caption"><?php echo $ward_grid->WardName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WardName" class="<?php echo $ward_grid->WardName->headerCellClass() ?>"><div><div id="elh_ward_WardName" class="ward_WardName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ward_grid->WardName->caption() ?></span><span class="ew-table-header-sort"><?php if ($ward_grid->WardName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ward_grid->WardName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ward_grid->Population->Visible) { // Population ?>
	<?php if ($ward_grid->SortUrl($ward_grid->Population) == "") { ?>
		<th data-name="Population" class="<?php echo $ward_grid->Population->headerCellClass() ?>"><div id="elh_ward_Population" class="ward_Population"><div class="ew-table-header-caption"><?php echo $ward_grid->Population->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Population" class="<?php echo $ward_grid->Population->headerCellClass() ?>"><div><div id="elh_ward_Population" class="ward_Population">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ward_grid->Population->caption() ?></span><span class="ew-table-header-sort"><?php if ($ward_grid->Population->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ward_grid->Population->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ward_grid->Areas->Visible) { // Areas ?>
	<?php if ($ward_grid->SortUrl($ward_grid->Areas) == "") { ?>
		<th data-name="Areas" class="<?php echo $ward_grid->Areas->headerCellClass() ?>"><div id="elh_ward_Areas" class="ward_Areas"><div class="ew-table-header-caption"><?php echo $ward_grid->Areas->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Areas" class="<?php echo $ward_grid->Areas->headerCellClass() ?>"><div><div id="elh_ward_Areas" class="ward_Areas">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ward_grid->Areas->caption() ?></span><span class="ew-table-header-sort"><?php if ($ward_grid->Areas->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ward_grid->Areas->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ward_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$ward_grid->StartRecord = 1;
$ward_grid->StopRecord = $ward_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($ward->isConfirm() || $ward_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($ward_grid->FormKeyCountName) && ($ward_grid->isGridAdd() || $ward_grid->isGridEdit() || $ward->isConfirm())) {
		$ward_grid->KeyCount = $CurrentForm->getValue($ward_grid->FormKeyCountName);
		$ward_grid->StopRecord = $ward_grid->StartRecord + $ward_grid->KeyCount - 1;
	}
}
$ward_grid->RecordCount = $ward_grid->StartRecord - 1;
if ($ward_grid->Recordset && !$ward_grid->Recordset->EOF) {
	$ward_grid->Recordset->moveFirst();
	$selectLimit = $ward_grid->UseSelectLimit;
	if (!$selectLimit && $ward_grid->StartRecord > 1)
		$ward_grid->Recordset->move($ward_grid->StartRecord - 1);
} elseif (!$ward->AllowAddDeleteRow && $ward_grid->StopRecord == 0) {
	$ward_grid->StopRecord = $ward->GridAddRowCount;
}

// Initialize aggregate
$ward->RowType = ROWTYPE_AGGREGATEINIT;
$ward->resetAttributes();
$ward_grid->renderRow();
if ($ward_grid->isGridAdd())
	$ward_grid->RowIndex = 0;
if ($ward_grid->isGridEdit())
	$ward_grid->RowIndex = 0;
while ($ward_grid->RecordCount < $ward_grid->StopRecord) {
	$ward_grid->RecordCount++;
	if ($ward_grid->RecordCount >= $ward_grid->StartRecord) {
		$ward_grid->RowCount++;
		if ($ward_grid->isGridAdd() || $ward_grid->isGridEdit() || $ward->isConfirm()) {
			$ward_grid->RowIndex++;
			$CurrentForm->Index = $ward_grid->RowIndex;
			if ($CurrentForm->hasValue($ward_grid->FormActionName) && ($ward->isConfirm() || $ward_grid->EventCancelled))
				$ward_grid->RowAction = strval($CurrentForm->getValue($ward_grid->FormActionName));
			elseif ($ward_grid->isGridAdd())
				$ward_grid->RowAction = "insert";
			else
				$ward_grid->RowAction = "";
		}

		// Set up key count
		$ward_grid->KeyCount = $ward_grid->RowIndex;

		// Init row class and style
		$ward->resetAttributes();
		$ward->CssClass = "";
		if ($ward_grid->isGridAdd()) {
			if ($ward->CurrentMode == "copy") {
				$ward_grid->loadRowValues($ward_grid->Recordset); // Load row values
				$ward_grid->setRecordKey($ward_grid->RowOldKey, $ward_grid->Recordset); // Set old record key
			} else {
				$ward_grid->loadRowValues(); // Load default values
				$ward_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$ward_grid->loadRowValues($ward_grid->Recordset); // Load row values
		}
		$ward->RowType = ROWTYPE_VIEW; // Render view
		if ($ward_grid->isGridAdd()) // Grid add
			$ward->RowType = ROWTYPE_ADD; // Render add
		if ($ward_grid->isGridAdd() && $ward->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$ward_grid->restoreCurrentRowFormValues($ward_grid->RowIndex); // Restore form values
		if ($ward_grid->isGridEdit()) { // Grid edit
			if ($ward->EventCancelled)
				$ward_grid->restoreCurrentRowFormValues($ward_grid->RowIndex); // Restore form values
			if ($ward_grid->RowAction == "insert")
				$ward->RowType = ROWTYPE_ADD; // Render add
			else
				$ward->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($ward_grid->isGridEdit() && ($ward->RowType == ROWTYPE_EDIT || $ward->RowType == ROWTYPE_ADD) && $ward->EventCancelled) // Update failed
			$ward_grid->restoreCurrentRowFormValues($ward_grid->RowIndex); // Restore form values
		if ($ward->RowType == ROWTYPE_EDIT) // Edit row
			$ward_grid->EditRowCount++;
		if ($ward->isConfirm()) // Confirm row
			$ward_grid->restoreCurrentRowFormValues($ward_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$ward->RowAttrs->merge(["data-rowindex" => $ward_grid->RowCount, "id" => "r" . $ward_grid->RowCount . "_ward", "data-rowtype" => $ward->RowType]);

		// Render row
		$ward_grid->renderRow();

		// Render list options
		$ward_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($ward_grid->RowAction != "delete" && $ward_grid->RowAction != "insertdelete" && !($ward_grid->RowAction == "insert" && $ward->isConfirm() && $ward_grid->emptyRow())) {
?>
	<tr <?php echo $ward->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ward_grid->ListOptions->render("body", "left", $ward_grid->RowCount);
?>
	<?php if ($ward_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $ward_grid->LACode->cellAttributes() ?>>
<?php if ($ward->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($ward_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $ward_grid->RowCount ?>_ward_LACode" class="form-group">
<span<?php echo $ward_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ward_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $ward_grid->RowIndex ?>_LACode" name="x<?php echo $ward_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($ward_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $ward_grid->RowCount ?>_ward_LACode" class="form-group">
<input type="text" data-table="ward" data-field="x_LACode" name="x<?php echo $ward_grid->RowIndex ?>_LACode" id="x<?php echo $ward_grid->RowIndex ?>_LACode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($ward_grid->LACode->getPlaceHolder()) ?>" value="<?php echo $ward_grid->LACode->EditValue ?>"<?php echo $ward_grid->LACode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="ward" data-field="x_LACode" name="o<?php echo $ward_grid->RowIndex ?>_LACode" id="o<?php echo $ward_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($ward_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($ward->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($ward_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $ward_grid->RowCount ?>_ward_LACode" class="form-group">
<span<?php echo $ward_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ward_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $ward_grid->RowIndex ?>_LACode" name="x<?php echo $ward_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($ward_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $ward_grid->RowCount ?>_ward_LACode" class="form-group">
<input type="text" data-table="ward" data-field="x_LACode" name="x<?php echo $ward_grid->RowIndex ?>_LACode" id="x<?php echo $ward_grid->RowIndex ?>_LACode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($ward_grid->LACode->getPlaceHolder()) ?>" value="<?php echo $ward_grid->LACode->EditValue ?>"<?php echo $ward_grid->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($ward->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ward_grid->RowCount ?>_ward_LACode">
<span<?php echo $ward_grid->LACode->viewAttributes() ?>><?php echo $ward_grid->LACode->getViewValue() ?></span>
</span>
<?php if (!$ward->isConfirm()) { ?>
<input type="hidden" data-table="ward" data-field="x_LACode" name="x<?php echo $ward_grid->RowIndex ?>_LACode" id="x<?php echo $ward_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($ward_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="ward" data-field="x_LACode" name="o<?php echo $ward_grid->RowIndex ?>_LACode" id="o<?php echo $ward_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($ward_grid->LACode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ward" data-field="x_LACode" name="fwardgrid$x<?php echo $ward_grid->RowIndex ?>_LACode" id="fwardgrid$x<?php echo $ward_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($ward_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="ward" data-field="x_LACode" name="fwardgrid$o<?php echo $ward_grid->RowIndex ?>_LACode" id="fwardgrid$o<?php echo $ward_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($ward_grid->LACode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ward_grid->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $ward_grid->ProvinceCode->cellAttributes() ?>>
<?php if ($ward->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($ward_grid->ProvinceCode->getSessionValue() != "") { ?>
<span id="el<?php echo $ward_grid->RowCount ?>_ward_ProvinceCode" class="form-group">
<span<?php echo $ward_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ward_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $ward_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $ward_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($ward_grid->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $ward_grid->RowCount ?>_ward_ProvinceCode" class="form-group">
<input type="text" data-table="ward" data-field="x_ProvinceCode" name="x<?php echo $ward_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $ward_grid->RowIndex ?>_ProvinceCode" size="30" placeholder="<?php echo HtmlEncode($ward_grid->ProvinceCode->getPlaceHolder()) ?>" value="<?php echo $ward_grid->ProvinceCode->EditValue ?>"<?php echo $ward_grid->ProvinceCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="ward" data-field="x_ProvinceCode" name="o<?php echo $ward_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $ward_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($ward_grid->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php if ($ward->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($ward_grid->ProvinceCode->getSessionValue() != "") { ?>
<span id="el<?php echo $ward_grid->RowCount ?>_ward_ProvinceCode" class="form-group">
<span<?php echo $ward_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ward_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $ward_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $ward_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($ward_grid->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $ward_grid->RowCount ?>_ward_ProvinceCode" class="form-group">
<input type="text" data-table="ward" data-field="x_ProvinceCode" name="x<?php echo $ward_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $ward_grid->RowIndex ?>_ProvinceCode" size="30" placeholder="<?php echo HtmlEncode($ward_grid->ProvinceCode->getPlaceHolder()) ?>" value="<?php echo $ward_grid->ProvinceCode->EditValue ?>"<?php echo $ward_grid->ProvinceCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($ward->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ward_grid->RowCount ?>_ward_ProvinceCode">
<span<?php echo $ward_grid->ProvinceCode->viewAttributes() ?>><?php echo $ward_grid->ProvinceCode->getViewValue() ?></span>
</span>
<?php if (!$ward->isConfirm()) { ?>
<input type="hidden" data-table="ward" data-field="x_ProvinceCode" name="x<?php echo $ward_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $ward_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($ward_grid->ProvinceCode->FormValue) ?>">
<input type="hidden" data-table="ward" data-field="x_ProvinceCode" name="o<?php echo $ward_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $ward_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($ward_grid->ProvinceCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ward" data-field="x_ProvinceCode" name="fwardgrid$x<?php echo $ward_grid->RowIndex ?>_ProvinceCode" id="fwardgrid$x<?php echo $ward_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($ward_grid->ProvinceCode->FormValue) ?>">
<input type="hidden" data-table="ward" data-field="x_ProvinceCode" name="fwardgrid$o<?php echo $ward_grid->RowIndex ?>_ProvinceCode" id="fwardgrid$o<?php echo $ward_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($ward_grid->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ward_grid->WardCode->Visible) { // WardCode ?>
		<td data-name="WardCode" <?php echo $ward_grid->WardCode->cellAttributes() ?>>
<?php if ($ward->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ward_grid->RowCount ?>_ward_WardCode" class="form-group"></span>
<input type="hidden" data-table="ward" data-field="x_WardCode" name="o<?php echo $ward_grid->RowIndex ?>_WardCode" id="o<?php echo $ward_grid->RowIndex ?>_WardCode" value="<?php echo HtmlEncode($ward_grid->WardCode->OldValue) ?>">
<?php } ?>
<?php if ($ward->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ward_grid->RowCount ?>_ward_WardCode" class="form-group">
<span<?php echo $ward_grid->WardCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ward_grid->WardCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ward" data-field="x_WardCode" name="x<?php echo $ward_grid->RowIndex ?>_WardCode" id="x<?php echo $ward_grid->RowIndex ?>_WardCode" value="<?php echo HtmlEncode($ward_grid->WardCode->CurrentValue) ?>">
<?php } ?>
<?php if ($ward->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ward_grid->RowCount ?>_ward_WardCode">
<span<?php echo $ward_grid->WardCode->viewAttributes() ?>><?php echo $ward_grid->WardCode->getViewValue() ?></span>
</span>
<?php if (!$ward->isConfirm()) { ?>
<input type="hidden" data-table="ward" data-field="x_WardCode" name="x<?php echo $ward_grid->RowIndex ?>_WardCode" id="x<?php echo $ward_grid->RowIndex ?>_WardCode" value="<?php echo HtmlEncode($ward_grid->WardCode->FormValue) ?>">
<input type="hidden" data-table="ward" data-field="x_WardCode" name="o<?php echo $ward_grid->RowIndex ?>_WardCode" id="o<?php echo $ward_grid->RowIndex ?>_WardCode" value="<?php echo HtmlEncode($ward_grid->WardCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ward" data-field="x_WardCode" name="fwardgrid$x<?php echo $ward_grid->RowIndex ?>_WardCode" id="fwardgrid$x<?php echo $ward_grid->RowIndex ?>_WardCode" value="<?php echo HtmlEncode($ward_grid->WardCode->FormValue) ?>">
<input type="hidden" data-table="ward" data-field="x_WardCode" name="fwardgrid$o<?php echo $ward_grid->RowIndex ?>_WardCode" id="fwardgrid$o<?php echo $ward_grid->RowIndex ?>_WardCode" value="<?php echo HtmlEncode($ward_grid->WardCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ward_grid->WardName->Visible) { // WardName ?>
		<td data-name="WardName" <?php echo $ward_grid->WardName->cellAttributes() ?>>
<?php if ($ward->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ward_grid->RowCount ?>_ward_WardName" class="form-group">
<input type="text" data-table="ward" data-field="x_WardName" name="x<?php echo $ward_grid->RowIndex ?>_WardName" id="x<?php echo $ward_grid->RowIndex ?>_WardName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ward_grid->WardName->getPlaceHolder()) ?>" value="<?php echo $ward_grid->WardName->EditValue ?>"<?php echo $ward_grid->WardName->editAttributes() ?>>
</span>
<input type="hidden" data-table="ward" data-field="x_WardName" name="o<?php echo $ward_grid->RowIndex ?>_WardName" id="o<?php echo $ward_grid->RowIndex ?>_WardName" value="<?php echo HtmlEncode($ward_grid->WardName->OldValue) ?>">
<?php } ?>
<?php if ($ward->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ward_grid->RowCount ?>_ward_WardName" class="form-group">
<input type="text" data-table="ward" data-field="x_WardName" name="x<?php echo $ward_grid->RowIndex ?>_WardName" id="x<?php echo $ward_grid->RowIndex ?>_WardName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ward_grid->WardName->getPlaceHolder()) ?>" value="<?php echo $ward_grid->WardName->EditValue ?>"<?php echo $ward_grid->WardName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ward->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ward_grid->RowCount ?>_ward_WardName">
<span<?php echo $ward_grid->WardName->viewAttributes() ?>><?php echo $ward_grid->WardName->getViewValue() ?></span>
</span>
<?php if (!$ward->isConfirm()) { ?>
<input type="hidden" data-table="ward" data-field="x_WardName" name="x<?php echo $ward_grid->RowIndex ?>_WardName" id="x<?php echo $ward_grid->RowIndex ?>_WardName" value="<?php echo HtmlEncode($ward_grid->WardName->FormValue) ?>">
<input type="hidden" data-table="ward" data-field="x_WardName" name="o<?php echo $ward_grid->RowIndex ?>_WardName" id="o<?php echo $ward_grid->RowIndex ?>_WardName" value="<?php echo HtmlEncode($ward_grid->WardName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ward" data-field="x_WardName" name="fwardgrid$x<?php echo $ward_grid->RowIndex ?>_WardName" id="fwardgrid$x<?php echo $ward_grid->RowIndex ?>_WardName" value="<?php echo HtmlEncode($ward_grid->WardName->FormValue) ?>">
<input type="hidden" data-table="ward" data-field="x_WardName" name="fwardgrid$o<?php echo $ward_grid->RowIndex ?>_WardName" id="fwardgrid$o<?php echo $ward_grid->RowIndex ?>_WardName" value="<?php echo HtmlEncode($ward_grid->WardName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ward_grid->Population->Visible) { // Population ?>
		<td data-name="Population" <?php echo $ward_grid->Population->cellAttributes() ?>>
<?php if ($ward->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ward_grid->RowCount ?>_ward_Population" class="form-group">
<input type="text" data-table="ward" data-field="x_Population" name="x<?php echo $ward_grid->RowIndex ?>_Population" id="x<?php echo $ward_grid->RowIndex ?>_Population" size="30" placeholder="<?php echo HtmlEncode($ward_grid->Population->getPlaceHolder()) ?>" value="<?php echo $ward_grid->Population->EditValue ?>"<?php echo $ward_grid->Population->editAttributes() ?>>
</span>
<input type="hidden" data-table="ward" data-field="x_Population" name="o<?php echo $ward_grid->RowIndex ?>_Population" id="o<?php echo $ward_grid->RowIndex ?>_Population" value="<?php echo HtmlEncode($ward_grid->Population->OldValue) ?>">
<?php } ?>
<?php if ($ward->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ward_grid->RowCount ?>_ward_Population" class="form-group">
<input type="text" data-table="ward" data-field="x_Population" name="x<?php echo $ward_grid->RowIndex ?>_Population" id="x<?php echo $ward_grid->RowIndex ?>_Population" size="30" placeholder="<?php echo HtmlEncode($ward_grid->Population->getPlaceHolder()) ?>" value="<?php echo $ward_grid->Population->EditValue ?>"<?php echo $ward_grid->Population->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ward->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ward_grid->RowCount ?>_ward_Population">
<span<?php echo $ward_grid->Population->viewAttributes() ?>><?php echo $ward_grid->Population->getViewValue() ?></span>
</span>
<?php if (!$ward->isConfirm()) { ?>
<input type="hidden" data-table="ward" data-field="x_Population" name="x<?php echo $ward_grid->RowIndex ?>_Population" id="x<?php echo $ward_grid->RowIndex ?>_Population" value="<?php echo HtmlEncode($ward_grid->Population->FormValue) ?>">
<input type="hidden" data-table="ward" data-field="x_Population" name="o<?php echo $ward_grid->RowIndex ?>_Population" id="o<?php echo $ward_grid->RowIndex ?>_Population" value="<?php echo HtmlEncode($ward_grid->Population->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ward" data-field="x_Population" name="fwardgrid$x<?php echo $ward_grid->RowIndex ?>_Population" id="fwardgrid$x<?php echo $ward_grid->RowIndex ?>_Population" value="<?php echo HtmlEncode($ward_grid->Population->FormValue) ?>">
<input type="hidden" data-table="ward" data-field="x_Population" name="fwardgrid$o<?php echo $ward_grid->RowIndex ?>_Population" id="fwardgrid$o<?php echo $ward_grid->RowIndex ?>_Population" value="<?php echo HtmlEncode($ward_grid->Population->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ward_grid->Areas->Visible) { // Areas ?>
		<td data-name="Areas" <?php echo $ward_grid->Areas->cellAttributes() ?>>
<?php if ($ward->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ward_grid->RowCount ?>_ward_Areas" class="form-group">
<input type="text" data-table="ward" data-field="x_Areas" name="x<?php echo $ward_grid->RowIndex ?>_Areas" id="x<?php echo $ward_grid->RowIndex ?>_Areas" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ward_grid->Areas->getPlaceHolder()) ?>" value="<?php echo $ward_grid->Areas->EditValue ?>"<?php echo $ward_grid->Areas->editAttributes() ?>>
</span>
<input type="hidden" data-table="ward" data-field="x_Areas" name="o<?php echo $ward_grid->RowIndex ?>_Areas" id="o<?php echo $ward_grid->RowIndex ?>_Areas" value="<?php echo HtmlEncode($ward_grid->Areas->OldValue) ?>">
<?php } ?>
<?php if ($ward->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ward_grid->RowCount ?>_ward_Areas" class="form-group">
<input type="text" data-table="ward" data-field="x_Areas" name="x<?php echo $ward_grid->RowIndex ?>_Areas" id="x<?php echo $ward_grid->RowIndex ?>_Areas" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ward_grid->Areas->getPlaceHolder()) ?>" value="<?php echo $ward_grid->Areas->EditValue ?>"<?php echo $ward_grid->Areas->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ward->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ward_grid->RowCount ?>_ward_Areas">
<span<?php echo $ward_grid->Areas->viewAttributes() ?>><?php echo $ward_grid->Areas->getViewValue() ?></span>
</span>
<?php if (!$ward->isConfirm()) { ?>
<input type="hidden" data-table="ward" data-field="x_Areas" name="x<?php echo $ward_grid->RowIndex ?>_Areas" id="x<?php echo $ward_grid->RowIndex ?>_Areas" value="<?php echo HtmlEncode($ward_grid->Areas->FormValue) ?>">
<input type="hidden" data-table="ward" data-field="x_Areas" name="o<?php echo $ward_grid->RowIndex ?>_Areas" id="o<?php echo $ward_grid->RowIndex ?>_Areas" value="<?php echo HtmlEncode($ward_grid->Areas->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ward" data-field="x_Areas" name="fwardgrid$x<?php echo $ward_grid->RowIndex ?>_Areas" id="fwardgrid$x<?php echo $ward_grid->RowIndex ?>_Areas" value="<?php echo HtmlEncode($ward_grid->Areas->FormValue) ?>">
<input type="hidden" data-table="ward" data-field="x_Areas" name="fwardgrid$o<?php echo $ward_grid->RowIndex ?>_Areas" id="fwardgrid$o<?php echo $ward_grid->RowIndex ?>_Areas" value="<?php echo HtmlEncode($ward_grid->Areas->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ward_grid->ListOptions->render("body", "right", $ward_grid->RowCount);
?>
	</tr>
<?php if ($ward->RowType == ROWTYPE_ADD || $ward->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fwardgrid", "load"], function() {
	fwardgrid.updateLists(<?php echo $ward_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$ward_grid->isGridAdd() || $ward->CurrentMode == "copy")
		if (!$ward_grid->Recordset->EOF)
			$ward_grid->Recordset->moveNext();
}
?>
<?php
	if ($ward->CurrentMode == "add" || $ward->CurrentMode == "copy" || $ward->CurrentMode == "edit") {
		$ward_grid->RowIndex = '$rowindex$';
		$ward_grid->loadRowValues();

		// Set row properties
		$ward->resetAttributes();
		$ward->RowAttrs->merge(["data-rowindex" => $ward_grid->RowIndex, "id" => "r0_ward", "data-rowtype" => ROWTYPE_ADD]);
		$ward->RowAttrs->appendClass("ew-template");
		$ward->RowType = ROWTYPE_ADD;

		// Render row
		$ward_grid->renderRow();

		// Render list options
		$ward_grid->renderListOptions();
		$ward_grid->StartRowCount = 0;
?>
	<tr <?php echo $ward->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ward_grid->ListOptions->render("body", "left", $ward_grid->RowIndex);
?>
	<?php if ($ward_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if (!$ward->isConfirm()) { ?>
<?php if ($ward_grid->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_ward_LACode" class="form-group ward_LACode">
<span<?php echo $ward_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ward_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $ward_grid->RowIndex ?>_LACode" name="x<?php echo $ward_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($ward_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_ward_LACode" class="form-group ward_LACode">
<input type="text" data-table="ward" data-field="x_LACode" name="x<?php echo $ward_grid->RowIndex ?>_LACode" id="x<?php echo $ward_grid->RowIndex ?>_LACode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($ward_grid->LACode->getPlaceHolder()) ?>" value="<?php echo $ward_grid->LACode->EditValue ?>"<?php echo $ward_grid->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_ward_LACode" class="form-group ward_LACode">
<span<?php echo $ward_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ward_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ward" data-field="x_LACode" name="x<?php echo $ward_grid->RowIndex ?>_LACode" id="x<?php echo $ward_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($ward_grid->LACode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ward" data-field="x_LACode" name="o<?php echo $ward_grid->RowIndex ?>_LACode" id="o<?php echo $ward_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($ward_grid->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ward_grid->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode">
<?php if (!$ward->isConfirm()) { ?>
<?php if ($ward_grid->ProvinceCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_ward_ProvinceCode" class="form-group ward_ProvinceCode">
<span<?php echo $ward_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ward_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $ward_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $ward_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($ward_grid->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_ward_ProvinceCode" class="form-group ward_ProvinceCode">
<input type="text" data-table="ward" data-field="x_ProvinceCode" name="x<?php echo $ward_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $ward_grid->RowIndex ?>_ProvinceCode" size="30" placeholder="<?php echo HtmlEncode($ward_grid->ProvinceCode->getPlaceHolder()) ?>" value="<?php echo $ward_grid->ProvinceCode->EditValue ?>"<?php echo $ward_grid->ProvinceCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_ward_ProvinceCode" class="form-group ward_ProvinceCode">
<span<?php echo $ward_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ward_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ward" data-field="x_ProvinceCode" name="x<?php echo $ward_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $ward_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($ward_grid->ProvinceCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ward" data-field="x_ProvinceCode" name="o<?php echo $ward_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $ward_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($ward_grid->ProvinceCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ward_grid->WardCode->Visible) { // WardCode ?>
		<td data-name="WardCode">
<?php if (!$ward->isConfirm()) { ?>
<span id="el$rowindex$_ward_WardCode" class="form-group ward_WardCode"></span>
<?php } else { ?>
<span id="el$rowindex$_ward_WardCode" class="form-group ward_WardCode">
<span<?php echo $ward_grid->WardCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ward_grid->WardCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ward" data-field="x_WardCode" name="x<?php echo $ward_grid->RowIndex ?>_WardCode" id="x<?php echo $ward_grid->RowIndex ?>_WardCode" value="<?php echo HtmlEncode($ward_grid->WardCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ward" data-field="x_WardCode" name="o<?php echo $ward_grid->RowIndex ?>_WardCode" id="o<?php echo $ward_grid->RowIndex ?>_WardCode" value="<?php echo HtmlEncode($ward_grid->WardCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ward_grid->WardName->Visible) { // WardName ?>
		<td data-name="WardName">
<?php if (!$ward->isConfirm()) { ?>
<span id="el$rowindex$_ward_WardName" class="form-group ward_WardName">
<input type="text" data-table="ward" data-field="x_WardName" name="x<?php echo $ward_grid->RowIndex ?>_WardName" id="x<?php echo $ward_grid->RowIndex ?>_WardName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ward_grid->WardName->getPlaceHolder()) ?>" value="<?php echo $ward_grid->WardName->EditValue ?>"<?php echo $ward_grid->WardName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_ward_WardName" class="form-group ward_WardName">
<span<?php echo $ward_grid->WardName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ward_grid->WardName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ward" data-field="x_WardName" name="x<?php echo $ward_grid->RowIndex ?>_WardName" id="x<?php echo $ward_grid->RowIndex ?>_WardName" value="<?php echo HtmlEncode($ward_grid->WardName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ward" data-field="x_WardName" name="o<?php echo $ward_grid->RowIndex ?>_WardName" id="o<?php echo $ward_grid->RowIndex ?>_WardName" value="<?php echo HtmlEncode($ward_grid->WardName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ward_grid->Population->Visible) { // Population ?>
		<td data-name="Population">
<?php if (!$ward->isConfirm()) { ?>
<span id="el$rowindex$_ward_Population" class="form-group ward_Population">
<input type="text" data-table="ward" data-field="x_Population" name="x<?php echo $ward_grid->RowIndex ?>_Population" id="x<?php echo $ward_grid->RowIndex ?>_Population" size="30" placeholder="<?php echo HtmlEncode($ward_grid->Population->getPlaceHolder()) ?>" value="<?php echo $ward_grid->Population->EditValue ?>"<?php echo $ward_grid->Population->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_ward_Population" class="form-group ward_Population">
<span<?php echo $ward_grid->Population->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ward_grid->Population->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ward" data-field="x_Population" name="x<?php echo $ward_grid->RowIndex ?>_Population" id="x<?php echo $ward_grid->RowIndex ?>_Population" value="<?php echo HtmlEncode($ward_grid->Population->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ward" data-field="x_Population" name="o<?php echo $ward_grid->RowIndex ?>_Population" id="o<?php echo $ward_grid->RowIndex ?>_Population" value="<?php echo HtmlEncode($ward_grid->Population->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ward_grid->Areas->Visible) { // Areas ?>
		<td data-name="Areas">
<?php if (!$ward->isConfirm()) { ?>
<span id="el$rowindex$_ward_Areas" class="form-group ward_Areas">
<input type="text" data-table="ward" data-field="x_Areas" name="x<?php echo $ward_grid->RowIndex ?>_Areas" id="x<?php echo $ward_grid->RowIndex ?>_Areas" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ward_grid->Areas->getPlaceHolder()) ?>" value="<?php echo $ward_grid->Areas->EditValue ?>"<?php echo $ward_grid->Areas->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_ward_Areas" class="form-group ward_Areas">
<span<?php echo $ward_grid->Areas->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ward_grid->Areas->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ward" data-field="x_Areas" name="x<?php echo $ward_grid->RowIndex ?>_Areas" id="x<?php echo $ward_grid->RowIndex ?>_Areas" value="<?php echo HtmlEncode($ward_grid->Areas->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ward" data-field="x_Areas" name="o<?php echo $ward_grid->RowIndex ?>_Areas" id="o<?php echo $ward_grid->RowIndex ?>_Areas" value="<?php echo HtmlEncode($ward_grid->Areas->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ward_grid->ListOptions->render("body", "right", $ward_grid->RowIndex);
?>
<script>
loadjs.ready(["fwardgrid", "load"], function() {
	fwardgrid.updateLists(<?php echo $ward_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($ward->CurrentMode == "add" || $ward->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $ward_grid->FormKeyCountName ?>" id="<?php echo $ward_grid->FormKeyCountName ?>" value="<?php echo $ward_grid->KeyCount ?>">
<?php echo $ward_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($ward->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $ward_grid->FormKeyCountName ?>" id="<?php echo $ward_grid->FormKeyCountName ?>" value="<?php echo $ward_grid->KeyCount ?>">
<?php echo $ward_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($ward->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fwardgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ward_grid->Recordset)
	$ward_grid->Recordset->Close();
?>
<?php if ($ward_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $ward_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ward_grid->TotalRecords == 0 && !$ward->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ward_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$ward_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$ward_grid->terminate();
?>