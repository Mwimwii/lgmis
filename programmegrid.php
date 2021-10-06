<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($programme_grid))
	$programme_grid = new programme_grid();

// Run the page
$programme_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$programme_grid->Page_Render();
?>
<?php if (!$programme_grid->isExport()) { ?>
<script>
var fprogrammegrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fprogrammegrid = new ew.Form("fprogrammegrid", "grid");
	fprogrammegrid.formKeyCountName = '<?php echo $programme_grid->FormKeyCountName ?>';

	// Validate form
	fprogrammegrid.validate = function() {
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
			<?php if ($programme_grid->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $programme_grid->LACode->caption(), $programme_grid->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($programme_grid->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $programme_grid->DepartmentCode->caption(), $programme_grid->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($programme_grid->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $programme_grid->SectionCode->caption(), $programme_grid->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($programme_grid->IFMISProgramme->Required) { ?>
				elm = this.getElements("x" + infix + "_IFMISProgramme");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $programme_grid->IFMISProgramme->caption(), $programme_grid->IFMISProgramme->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($programme_grid->ProgrammeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgrammeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $programme_grid->ProgrammeCode->caption(), $programme_grid->ProgrammeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProgrammeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($programme_grid->ProgrammeCode->errorMessage()) ?>");
			<?php if ($programme_grid->ProgrammeName->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgrammeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $programme_grid->ProgrammeName->caption(), $programme_grid->ProgrammeName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($programme_grid->ProgrammeType->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgrammeType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $programme_grid->ProgrammeType->caption(), $programme_grid->ProgrammeType->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fprogrammegrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SectionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "IFMISProgramme", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProgrammeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProgrammeName", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProgrammeType", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fprogrammegrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fprogrammegrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fprogrammegrid.lists["x_LACode"] = <?php echo $programme_grid->LACode->Lookup->toClientList($programme_grid) ?>;
	fprogrammegrid.lists["x_LACode"].options = <?php echo JsonEncode($programme_grid->LACode->lookupOptions()) ?>;
	fprogrammegrid.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fprogrammegrid.lists["x_DepartmentCode"] = <?php echo $programme_grid->DepartmentCode->Lookup->toClientList($programme_grid) ?>;
	fprogrammegrid.lists["x_DepartmentCode"].options = <?php echo JsonEncode($programme_grid->DepartmentCode->lookupOptions()) ?>;
	fprogrammegrid.lists["x_SectionCode"] = <?php echo $programme_grid->SectionCode->Lookup->toClientList($programme_grid) ?>;
	fprogrammegrid.lists["x_SectionCode"].options = <?php echo JsonEncode($programme_grid->SectionCode->lookupOptions()) ?>;
	fprogrammegrid.lists["x_ProgrammeType"] = <?php echo $programme_grid->ProgrammeType->Lookup->toClientList($programme_grid) ?>;
	fprogrammegrid.lists["x_ProgrammeType"].options = <?php echo JsonEncode($programme_grid->ProgrammeType->lookupOptions()) ?>;
	loadjs.done("fprogrammegrid");
});
</script>
<?php } ?>
<?php
$programme_grid->renderOtherOptions();
?>
<?php if ($programme_grid->TotalRecords > 0 || $programme->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($programme_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> programme">
<?php if ($programme_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $programme_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fprogrammegrid" class="ew-form ew-list-form form-inline">
<div id="gmp_programme" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_programmegrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$programme->RowType = ROWTYPE_HEADER;

// Render list options
$programme_grid->renderListOptions();

// Render list options (header, left)
$programme_grid->ListOptions->render("header", "left");
?>
<?php if ($programme_grid->LACode->Visible) { // LACode ?>
	<?php if ($programme_grid->SortUrl($programme_grid->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $programme_grid->LACode->headerCellClass() ?>"><div id="elh_programme_LACode" class="programme_LACode"><div class="ew-table-header-caption"><?php echo $programme_grid->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $programme_grid->LACode->headerCellClass() ?>"><div><div id="elh_programme_LACode" class="programme_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_grid->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($programme_grid->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_grid->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($programme_grid->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($programme_grid->SortUrl($programme_grid->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $programme_grid->DepartmentCode->headerCellClass() ?>"><div id="elh_programme_DepartmentCode" class="programme_DepartmentCode"><div class="ew-table-header-caption"><?php echo $programme_grid->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $programme_grid->DepartmentCode->headerCellClass() ?>"><div><div id="elh_programme_DepartmentCode" class="programme_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_grid->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($programme_grid->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_grid->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($programme_grid->SectionCode->Visible) { // SectionCode ?>
	<?php if ($programme_grid->SortUrl($programme_grid->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $programme_grid->SectionCode->headerCellClass() ?>"><div id="elh_programme_SectionCode" class="programme_SectionCode"><div class="ew-table-header-caption"><?php echo $programme_grid->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $programme_grid->SectionCode->headerCellClass() ?>"><div><div id="elh_programme_SectionCode" class="programme_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_grid->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($programme_grid->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_grid->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($programme_grid->IFMISProgramme->Visible) { // IFMISProgramme ?>
	<?php if ($programme_grid->SortUrl($programme_grid->IFMISProgramme) == "") { ?>
		<th data-name="IFMISProgramme" class="<?php echo $programme_grid->IFMISProgramme->headerCellClass() ?>"><div id="elh_programme_IFMISProgramme" class="programme_IFMISProgramme"><div class="ew-table-header-caption"><?php echo $programme_grid->IFMISProgramme->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IFMISProgramme" class="<?php echo $programme_grid->IFMISProgramme->headerCellClass() ?>"><div><div id="elh_programme_IFMISProgramme" class="programme_IFMISProgramme">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_grid->IFMISProgramme->caption() ?></span><span class="ew-table-header-sort"><?php if ($programme_grid->IFMISProgramme->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_grid->IFMISProgramme->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($programme_grid->ProgrammeCode->Visible) { // ProgrammeCode ?>
	<?php if ($programme_grid->SortUrl($programme_grid->ProgrammeCode) == "") { ?>
		<th data-name="ProgrammeCode" class="<?php echo $programme_grid->ProgrammeCode->headerCellClass() ?>"><div id="elh_programme_ProgrammeCode" class="programme_ProgrammeCode"><div class="ew-table-header-caption"><?php echo $programme_grid->ProgrammeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgrammeCode" class="<?php echo $programme_grid->ProgrammeCode->headerCellClass() ?>"><div><div id="elh_programme_ProgrammeCode" class="programme_ProgrammeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_grid->ProgrammeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($programme_grid->ProgrammeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_grid->ProgrammeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($programme_grid->ProgrammeName->Visible) { // ProgrammeName ?>
	<?php if ($programme_grid->SortUrl($programme_grid->ProgrammeName) == "") { ?>
		<th data-name="ProgrammeName" class="<?php echo $programme_grid->ProgrammeName->headerCellClass() ?>"><div id="elh_programme_ProgrammeName" class="programme_ProgrammeName"><div class="ew-table-header-caption"><?php echo $programme_grid->ProgrammeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgrammeName" class="<?php echo $programme_grid->ProgrammeName->headerCellClass() ?>"><div><div id="elh_programme_ProgrammeName" class="programme_ProgrammeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_grid->ProgrammeName->caption() ?></span><span class="ew-table-header-sort"><?php if ($programme_grid->ProgrammeName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_grid->ProgrammeName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($programme_grid->ProgrammeType->Visible) { // ProgrammeType ?>
	<?php if ($programme_grid->SortUrl($programme_grid->ProgrammeType) == "") { ?>
		<th data-name="ProgrammeType" class="<?php echo $programme_grid->ProgrammeType->headerCellClass() ?>"><div id="elh_programme_ProgrammeType" class="programme_ProgrammeType"><div class="ew-table-header-caption"><?php echo $programme_grid->ProgrammeType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgrammeType" class="<?php echo $programme_grid->ProgrammeType->headerCellClass() ?>"><div><div id="elh_programme_ProgrammeType" class="programme_ProgrammeType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_grid->ProgrammeType->caption() ?></span><span class="ew-table-header-sort"><?php if ($programme_grid->ProgrammeType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_grid->ProgrammeType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$programme_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$programme_grid->StartRecord = 1;
$programme_grid->StopRecord = $programme_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($programme->isConfirm() || $programme_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($programme_grid->FormKeyCountName) && ($programme_grid->isGridAdd() || $programme_grid->isGridEdit() || $programme->isConfirm())) {
		$programme_grid->KeyCount = $CurrentForm->getValue($programme_grid->FormKeyCountName);
		$programme_grid->StopRecord = $programme_grid->StartRecord + $programme_grid->KeyCount - 1;
	}
}
$programme_grid->RecordCount = $programme_grid->StartRecord - 1;
if ($programme_grid->Recordset && !$programme_grid->Recordset->EOF) {
	$programme_grid->Recordset->moveFirst();
	$selectLimit = $programme_grid->UseSelectLimit;
	if (!$selectLimit && $programme_grid->StartRecord > 1)
		$programme_grid->Recordset->move($programme_grid->StartRecord - 1);
} elseif (!$programme->AllowAddDeleteRow && $programme_grid->StopRecord == 0) {
	$programme_grid->StopRecord = $programme->GridAddRowCount;
}

// Initialize aggregate
$programme->RowType = ROWTYPE_AGGREGATEINIT;
$programme->resetAttributes();
$programme_grid->renderRow();
if ($programme_grid->isGridAdd())
	$programme_grid->RowIndex = 0;
if ($programme_grid->isGridEdit())
	$programme_grid->RowIndex = 0;
while ($programme_grid->RecordCount < $programme_grid->StopRecord) {
	$programme_grid->RecordCount++;
	if ($programme_grid->RecordCount >= $programme_grid->StartRecord) {
		$programme_grid->RowCount++;
		if ($programme_grid->isGridAdd() || $programme_grid->isGridEdit() || $programme->isConfirm()) {
			$programme_grid->RowIndex++;
			$CurrentForm->Index = $programme_grid->RowIndex;
			if ($CurrentForm->hasValue($programme_grid->FormActionName) && ($programme->isConfirm() || $programme_grid->EventCancelled))
				$programme_grid->RowAction = strval($CurrentForm->getValue($programme_grid->FormActionName));
			elseif ($programme_grid->isGridAdd())
				$programme_grid->RowAction = "insert";
			else
				$programme_grid->RowAction = "";
		}

		// Set up key count
		$programme_grid->KeyCount = $programme_grid->RowIndex;

		// Init row class and style
		$programme->resetAttributes();
		$programme->CssClass = "";
		if ($programme_grid->isGridAdd()) {
			if ($programme->CurrentMode == "copy") {
				$programme_grid->loadRowValues($programme_grid->Recordset); // Load row values
				$programme_grid->setRecordKey($programme_grid->RowOldKey, $programme_grid->Recordset); // Set old record key
			} else {
				$programme_grid->loadRowValues(); // Load default values
				$programme_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$programme_grid->loadRowValues($programme_grid->Recordset); // Load row values
		}
		$programme->RowType = ROWTYPE_VIEW; // Render view
		if ($programme_grid->isGridAdd()) // Grid add
			$programme->RowType = ROWTYPE_ADD; // Render add
		if ($programme_grid->isGridAdd() && $programme->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$programme_grid->restoreCurrentRowFormValues($programme_grid->RowIndex); // Restore form values
		if ($programme_grid->isGridEdit()) { // Grid edit
			if ($programme->EventCancelled)
				$programme_grid->restoreCurrentRowFormValues($programme_grid->RowIndex); // Restore form values
			if ($programme_grid->RowAction == "insert")
				$programme->RowType = ROWTYPE_ADD; // Render add
			else
				$programme->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($programme_grid->isGridEdit() && ($programme->RowType == ROWTYPE_EDIT || $programme->RowType == ROWTYPE_ADD) && $programme->EventCancelled) // Update failed
			$programme_grid->restoreCurrentRowFormValues($programme_grid->RowIndex); // Restore form values
		if ($programme->RowType == ROWTYPE_EDIT) // Edit row
			$programme_grid->EditRowCount++;
		if ($programme->isConfirm()) // Confirm row
			$programme_grid->restoreCurrentRowFormValues($programme_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$programme->RowAttrs->merge(["data-rowindex" => $programme_grid->RowCount, "id" => "r" . $programme_grid->RowCount . "_programme", "data-rowtype" => $programme->RowType]);

		// Render row
		$programme_grid->renderRow();

		// Render list options
		$programme_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($programme_grid->RowAction != "delete" && $programme_grid->RowAction != "insertdelete" && !($programme_grid->RowAction == "insert" && $programme->isConfirm() && $programme_grid->emptyRow())) {
?>
	<tr <?php echo $programme->rowAttributes() ?>>
<?php

// Render list options (body, left)
$programme_grid->ListOptions->render("body", "left", $programme_grid->RowCount);
?>
	<?php if ($programme_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $programme_grid->LACode->cellAttributes() ?>>
<?php if ($programme->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($programme_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_LACode" class="form-group">
<span<?php echo $programme_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($programme_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $programme_grid->RowIndex ?>_LACode" name="x<?php echo $programme_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($programme_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_LACode" class="form-group">
<?php
$onchange = $programme_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$programme_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $programme_grid->RowIndex ?>_LACode">
	<input type="text" class="form-control" name="sv_x<?php echo $programme_grid->RowIndex ?>_LACode" id="sv_x<?php echo $programme_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($programme_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($programme_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($programme_grid->LACode->getPlaceHolder()) ?>"<?php echo $programme_grid->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="programme" data-field="x_LACode" data-value-separator="<?php echo $programme_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $programme_grid->RowIndex ?>_LACode" id="x<?php echo $programme_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($programme_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fprogrammegrid"], function() {
	fprogrammegrid.createAutoSuggest({"id":"x<?php echo $programme_grid->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $programme_grid->LACode->Lookup->getParamTag($programme_grid, "p_x" . $programme_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="programme" data-field="x_LACode" name="o<?php echo $programme_grid->RowIndex ?>_LACode" id="o<?php echo $programme_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($programme_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($programme->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($programme_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_LACode" class="form-group">
<span<?php echo $programme_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($programme_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $programme_grid->RowIndex ?>_LACode" name="x<?php echo $programme_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($programme_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_LACode" class="form-group">
<?php
$onchange = $programme_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$programme_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $programme_grid->RowIndex ?>_LACode">
	<input type="text" class="form-control" name="sv_x<?php echo $programme_grid->RowIndex ?>_LACode" id="sv_x<?php echo $programme_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($programme_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($programme_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($programme_grid->LACode->getPlaceHolder()) ?>"<?php echo $programme_grid->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="programme" data-field="x_LACode" data-value-separator="<?php echo $programme_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $programme_grid->RowIndex ?>_LACode" id="x<?php echo $programme_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($programme_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fprogrammegrid"], function() {
	fprogrammegrid.createAutoSuggest({"id":"x<?php echo $programme_grid->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $programme_grid->LACode->Lookup->getParamTag($programme_grid, "p_x" . $programme_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($programme->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_LACode">
<span<?php echo $programme_grid->LACode->viewAttributes() ?>><?php echo $programme_grid->LACode->getViewValue() ?></span>
</span>
<?php if (!$programme->isConfirm()) { ?>
<input type="hidden" data-table="programme" data-field="x_LACode" name="x<?php echo $programme_grid->RowIndex ?>_LACode" id="x<?php echo $programme_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($programme_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="programme" data-field="x_LACode" name="o<?php echo $programme_grid->RowIndex ?>_LACode" id="o<?php echo $programme_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($programme_grid->LACode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="programme" data-field="x_LACode" name="fprogrammegrid$x<?php echo $programme_grid->RowIndex ?>_LACode" id="fprogrammegrid$x<?php echo $programme_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($programme_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="programme" data-field="x_LACode" name="fprogrammegrid$o<?php echo $programme_grid->RowIndex ?>_LACode" id="fprogrammegrid$o<?php echo $programme_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($programme_grid->LACode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($programme_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $programme_grid->DepartmentCode->cellAttributes() ?>>
<?php if ($programme->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($programme_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_DepartmentCode" class="form-group">
<span<?php echo $programme_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($programme_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $programme_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $programme_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($programme_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_DepartmentCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="programme" data-field="x_DepartmentCode" data-value-separator="<?php echo $programme_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $programme_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $programme_grid->RowIndex ?>_DepartmentCode"<?php echo $programme_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $programme_grid->DepartmentCode->selectOptionListHtml("x{$programme_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $programme_grid->DepartmentCode->Lookup->getParamTag($programme_grid, "p_x" . $programme_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="programme" data-field="x_DepartmentCode" name="o<?php echo $programme_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $programme_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($programme_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($programme->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($programme_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_DepartmentCode" class="form-group">
<span<?php echo $programme_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($programme_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $programme_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $programme_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($programme_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_DepartmentCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="programme" data-field="x_DepartmentCode" data-value-separator="<?php echo $programme_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $programme_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $programme_grid->RowIndex ?>_DepartmentCode"<?php echo $programme_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $programme_grid->DepartmentCode->selectOptionListHtml("x{$programme_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $programme_grid->DepartmentCode->Lookup->getParamTag($programme_grid, "p_x" . $programme_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($programme->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_DepartmentCode">
<span<?php echo $programme_grid->DepartmentCode->viewAttributes() ?>><?php echo $programme_grid->DepartmentCode->getViewValue() ?></span>
</span>
<?php if (!$programme->isConfirm()) { ?>
<input type="hidden" data-table="programme" data-field="x_DepartmentCode" name="x<?php echo $programme_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $programme_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($programme_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="programme" data-field="x_DepartmentCode" name="o<?php echo $programme_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $programme_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($programme_grid->DepartmentCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="programme" data-field="x_DepartmentCode" name="fprogrammegrid$x<?php echo $programme_grid->RowIndex ?>_DepartmentCode" id="fprogrammegrid$x<?php echo $programme_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($programme_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="programme" data-field="x_DepartmentCode" name="fprogrammegrid$o<?php echo $programme_grid->RowIndex ?>_DepartmentCode" id="fprogrammegrid$o<?php echo $programme_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($programme_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($programme_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $programme_grid->SectionCode->cellAttributes() ?>>
<?php if ($programme->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($programme_grid->SectionCode->getSessionValue() != "") { ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_SectionCode" class="form-group">
<span<?php echo $programme_grid->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($programme_grid->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $programme_grid->RowIndex ?>_SectionCode" name="x<?php echo $programme_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($programme_grid->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="programme" data-field="x_SectionCode" data-value-separator="<?php echo $programme_grid->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $programme_grid->RowIndex ?>_SectionCode" name="x<?php echo $programme_grid->RowIndex ?>_SectionCode"<?php echo $programme_grid->SectionCode->editAttributes() ?>>
			<?php echo $programme_grid->SectionCode->selectOptionListHtml("x{$programme_grid->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $programme_grid->SectionCode->Lookup->getParamTag($programme_grid, "p_x" . $programme_grid->RowIndex . "_SectionCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="programme" data-field="x_SectionCode" name="o<?php echo $programme_grid->RowIndex ?>_SectionCode" id="o<?php echo $programme_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($programme_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($programme->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($programme_grid->SectionCode->getSessionValue() != "") { ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_SectionCode" class="form-group">
<span<?php echo $programme_grid->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($programme_grid->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $programme_grid->RowIndex ?>_SectionCode" name="x<?php echo $programme_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($programme_grid->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="programme" data-field="x_SectionCode" data-value-separator="<?php echo $programme_grid->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $programme_grid->RowIndex ?>_SectionCode" name="x<?php echo $programme_grid->RowIndex ?>_SectionCode"<?php echo $programme_grid->SectionCode->editAttributes() ?>>
			<?php echo $programme_grid->SectionCode->selectOptionListHtml("x{$programme_grid->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $programme_grid->SectionCode->Lookup->getParamTag($programme_grid, "p_x" . $programme_grid->RowIndex . "_SectionCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($programme->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_SectionCode">
<span<?php echo $programme_grid->SectionCode->viewAttributes() ?>><?php echo $programme_grid->SectionCode->getViewValue() ?></span>
</span>
<?php if (!$programme->isConfirm()) { ?>
<input type="hidden" data-table="programme" data-field="x_SectionCode" name="x<?php echo $programme_grid->RowIndex ?>_SectionCode" id="x<?php echo $programme_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($programme_grid->SectionCode->FormValue) ?>">
<input type="hidden" data-table="programme" data-field="x_SectionCode" name="o<?php echo $programme_grid->RowIndex ?>_SectionCode" id="o<?php echo $programme_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($programme_grid->SectionCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="programme" data-field="x_SectionCode" name="fprogrammegrid$x<?php echo $programme_grid->RowIndex ?>_SectionCode" id="fprogrammegrid$x<?php echo $programme_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($programme_grid->SectionCode->FormValue) ?>">
<input type="hidden" data-table="programme" data-field="x_SectionCode" name="fprogrammegrid$o<?php echo $programme_grid->RowIndex ?>_SectionCode" id="fprogrammegrid$o<?php echo $programme_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($programme_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($programme_grid->IFMISProgramme->Visible) { // IFMISProgramme ?>
		<td data-name="IFMISProgramme" <?php echo $programme_grid->IFMISProgramme->cellAttributes() ?>>
<?php if ($programme->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_IFMISProgramme" class="form-group">
<input type="text" data-table="programme" data-field="x_IFMISProgramme" name="x<?php echo $programme_grid->RowIndex ?>_IFMISProgramme" id="x<?php echo $programme_grid->RowIndex ?>_IFMISProgramme" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($programme_grid->IFMISProgramme->getPlaceHolder()) ?>" value="<?php echo $programme_grid->IFMISProgramme->EditValue ?>"<?php echo $programme_grid->IFMISProgramme->editAttributes() ?>>
</span>
<input type="hidden" data-table="programme" data-field="x_IFMISProgramme" name="o<?php echo $programme_grid->RowIndex ?>_IFMISProgramme" id="o<?php echo $programme_grid->RowIndex ?>_IFMISProgramme" value="<?php echo HtmlEncode($programme_grid->IFMISProgramme->OldValue) ?>">
<?php } ?>
<?php if ($programme->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_IFMISProgramme" class="form-group">
<input type="text" data-table="programme" data-field="x_IFMISProgramme" name="x<?php echo $programme_grid->RowIndex ?>_IFMISProgramme" id="x<?php echo $programme_grid->RowIndex ?>_IFMISProgramme" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($programme_grid->IFMISProgramme->getPlaceHolder()) ?>" value="<?php echo $programme_grid->IFMISProgramme->EditValue ?>"<?php echo $programme_grid->IFMISProgramme->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($programme->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_IFMISProgramme">
<span<?php echo $programme_grid->IFMISProgramme->viewAttributes() ?>><?php echo $programme_grid->IFMISProgramme->getViewValue() ?></span>
</span>
<?php if (!$programme->isConfirm()) { ?>
<input type="hidden" data-table="programme" data-field="x_IFMISProgramme" name="x<?php echo $programme_grid->RowIndex ?>_IFMISProgramme" id="x<?php echo $programme_grid->RowIndex ?>_IFMISProgramme" value="<?php echo HtmlEncode($programme_grid->IFMISProgramme->FormValue) ?>">
<input type="hidden" data-table="programme" data-field="x_IFMISProgramme" name="o<?php echo $programme_grid->RowIndex ?>_IFMISProgramme" id="o<?php echo $programme_grid->RowIndex ?>_IFMISProgramme" value="<?php echo HtmlEncode($programme_grid->IFMISProgramme->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="programme" data-field="x_IFMISProgramme" name="fprogrammegrid$x<?php echo $programme_grid->RowIndex ?>_IFMISProgramme" id="fprogrammegrid$x<?php echo $programme_grid->RowIndex ?>_IFMISProgramme" value="<?php echo HtmlEncode($programme_grid->IFMISProgramme->FormValue) ?>">
<input type="hidden" data-table="programme" data-field="x_IFMISProgramme" name="fprogrammegrid$o<?php echo $programme_grid->RowIndex ?>_IFMISProgramme" id="fprogrammegrid$o<?php echo $programme_grid->RowIndex ?>_IFMISProgramme" value="<?php echo HtmlEncode($programme_grid->IFMISProgramme->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($programme_grid->ProgrammeCode->Visible) { // ProgrammeCode ?>
		<td data-name="ProgrammeCode" <?php echo $programme_grid->ProgrammeCode->cellAttributes() ?>>
<?php if ($programme->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_ProgrammeCode" class="form-group">
<input type="text" data-table="programme" data-field="x_ProgrammeCode" name="x<?php echo $programme_grid->RowIndex ?>_ProgrammeCode" id="x<?php echo $programme_grid->RowIndex ?>_ProgrammeCode" placeholder="<?php echo HtmlEncode($programme_grid->ProgrammeCode->getPlaceHolder()) ?>" value="<?php echo $programme_grid->ProgrammeCode->EditValue ?>"<?php echo $programme_grid->ProgrammeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="programme" data-field="x_ProgrammeCode" name="o<?php echo $programme_grid->RowIndex ?>_ProgrammeCode" id="o<?php echo $programme_grid->RowIndex ?>_ProgrammeCode" value="<?php echo HtmlEncode($programme_grid->ProgrammeCode->OldValue) ?>">
<?php } ?>
<?php if ($programme->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_ProgrammeCode" class="form-group">
<input type="text" data-table="programme" data-field="x_ProgrammeCode" name="x<?php echo $programme_grid->RowIndex ?>_ProgrammeCode" id="x<?php echo $programme_grid->RowIndex ?>_ProgrammeCode" placeholder="<?php echo HtmlEncode($programme_grid->ProgrammeCode->getPlaceHolder()) ?>" value="<?php echo $programme_grid->ProgrammeCode->EditValue ?>"<?php echo $programme_grid->ProgrammeCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($programme->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_ProgrammeCode">
<span<?php echo $programme_grid->ProgrammeCode->viewAttributes() ?>><?php echo $programme_grid->ProgrammeCode->getViewValue() ?></span>
</span>
<?php if (!$programme->isConfirm()) { ?>
<input type="hidden" data-table="programme" data-field="x_ProgrammeCode" name="x<?php echo $programme_grid->RowIndex ?>_ProgrammeCode" id="x<?php echo $programme_grid->RowIndex ?>_ProgrammeCode" value="<?php echo HtmlEncode($programme_grid->ProgrammeCode->FormValue) ?>">
<input type="hidden" data-table="programme" data-field="x_ProgrammeCode" name="o<?php echo $programme_grid->RowIndex ?>_ProgrammeCode" id="o<?php echo $programme_grid->RowIndex ?>_ProgrammeCode" value="<?php echo HtmlEncode($programme_grid->ProgrammeCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="programme" data-field="x_ProgrammeCode" name="fprogrammegrid$x<?php echo $programme_grid->RowIndex ?>_ProgrammeCode" id="fprogrammegrid$x<?php echo $programme_grid->RowIndex ?>_ProgrammeCode" value="<?php echo HtmlEncode($programme_grid->ProgrammeCode->FormValue) ?>">
<input type="hidden" data-table="programme" data-field="x_ProgrammeCode" name="fprogrammegrid$o<?php echo $programme_grid->RowIndex ?>_ProgrammeCode" id="fprogrammegrid$o<?php echo $programme_grid->RowIndex ?>_ProgrammeCode" value="<?php echo HtmlEncode($programme_grid->ProgrammeCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($programme_grid->ProgrammeName->Visible) { // ProgrammeName ?>
		<td data-name="ProgrammeName" <?php echo $programme_grid->ProgrammeName->cellAttributes() ?>>
<?php if ($programme->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_ProgrammeName" class="form-group">
<input type="text" data-table="programme" data-field="x_ProgrammeName" name="x<?php echo $programme_grid->RowIndex ?>_ProgrammeName" id="x<?php echo $programme_grid->RowIndex ?>_ProgrammeName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($programme_grid->ProgrammeName->getPlaceHolder()) ?>" value="<?php echo $programme_grid->ProgrammeName->EditValue ?>"<?php echo $programme_grid->ProgrammeName->editAttributes() ?>>
</span>
<input type="hidden" data-table="programme" data-field="x_ProgrammeName" name="o<?php echo $programme_grid->RowIndex ?>_ProgrammeName" id="o<?php echo $programme_grid->RowIndex ?>_ProgrammeName" value="<?php echo HtmlEncode($programme_grid->ProgrammeName->OldValue) ?>">
<?php } ?>
<?php if ($programme->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_ProgrammeName" class="form-group">
<input type="text" data-table="programme" data-field="x_ProgrammeName" name="x<?php echo $programme_grid->RowIndex ?>_ProgrammeName" id="x<?php echo $programme_grid->RowIndex ?>_ProgrammeName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($programme_grid->ProgrammeName->getPlaceHolder()) ?>" value="<?php echo $programme_grid->ProgrammeName->EditValue ?>"<?php echo $programme_grid->ProgrammeName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($programme->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_ProgrammeName">
<span<?php echo $programme_grid->ProgrammeName->viewAttributes() ?>><?php echo $programme_grid->ProgrammeName->getViewValue() ?></span>
</span>
<?php if (!$programme->isConfirm()) { ?>
<input type="hidden" data-table="programme" data-field="x_ProgrammeName" name="x<?php echo $programme_grid->RowIndex ?>_ProgrammeName" id="x<?php echo $programme_grid->RowIndex ?>_ProgrammeName" value="<?php echo HtmlEncode($programme_grid->ProgrammeName->FormValue) ?>">
<input type="hidden" data-table="programme" data-field="x_ProgrammeName" name="o<?php echo $programme_grid->RowIndex ?>_ProgrammeName" id="o<?php echo $programme_grid->RowIndex ?>_ProgrammeName" value="<?php echo HtmlEncode($programme_grid->ProgrammeName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="programme" data-field="x_ProgrammeName" name="fprogrammegrid$x<?php echo $programme_grid->RowIndex ?>_ProgrammeName" id="fprogrammegrid$x<?php echo $programme_grid->RowIndex ?>_ProgrammeName" value="<?php echo HtmlEncode($programme_grid->ProgrammeName->FormValue) ?>">
<input type="hidden" data-table="programme" data-field="x_ProgrammeName" name="fprogrammegrid$o<?php echo $programme_grid->RowIndex ?>_ProgrammeName" id="fprogrammegrid$o<?php echo $programme_grid->RowIndex ?>_ProgrammeName" value="<?php echo HtmlEncode($programme_grid->ProgrammeName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($programme_grid->ProgrammeType->Visible) { // ProgrammeType ?>
		<td data-name="ProgrammeType" <?php echo $programme_grid->ProgrammeType->cellAttributes() ?>>
<?php if ($programme->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_ProgrammeType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="programme" data-field="x_ProgrammeType" data-value-separator="<?php echo $programme_grid->ProgrammeType->displayValueSeparatorAttribute() ?>" id="x<?php echo $programme_grid->RowIndex ?>_ProgrammeType" name="x<?php echo $programme_grid->RowIndex ?>_ProgrammeType"<?php echo $programme_grid->ProgrammeType->editAttributes() ?>>
			<?php echo $programme_grid->ProgrammeType->selectOptionListHtml("x{$programme_grid->RowIndex}_ProgrammeType") ?>
		</select>
</div>
<?php echo $programme_grid->ProgrammeType->Lookup->getParamTag($programme_grid, "p_x" . $programme_grid->RowIndex . "_ProgrammeType") ?>
</span>
<input type="hidden" data-table="programme" data-field="x_ProgrammeType" name="o<?php echo $programme_grid->RowIndex ?>_ProgrammeType" id="o<?php echo $programme_grid->RowIndex ?>_ProgrammeType" value="<?php echo HtmlEncode($programme_grid->ProgrammeType->OldValue) ?>">
<?php } ?>
<?php if ($programme->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_ProgrammeType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="programme" data-field="x_ProgrammeType" data-value-separator="<?php echo $programme_grid->ProgrammeType->displayValueSeparatorAttribute() ?>" id="x<?php echo $programme_grid->RowIndex ?>_ProgrammeType" name="x<?php echo $programme_grid->RowIndex ?>_ProgrammeType"<?php echo $programme_grid->ProgrammeType->editAttributes() ?>>
			<?php echo $programme_grid->ProgrammeType->selectOptionListHtml("x{$programme_grid->RowIndex}_ProgrammeType") ?>
		</select>
</div>
<?php echo $programme_grid->ProgrammeType->Lookup->getParamTag($programme_grid, "p_x" . $programme_grid->RowIndex . "_ProgrammeType") ?>
</span>
<?php } ?>
<?php if ($programme->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $programme_grid->RowCount ?>_programme_ProgrammeType">
<span<?php echo $programme_grid->ProgrammeType->viewAttributes() ?>><?php echo $programme_grid->ProgrammeType->getViewValue() ?></span>
</span>
<?php if (!$programme->isConfirm()) { ?>
<input type="hidden" data-table="programme" data-field="x_ProgrammeType" name="x<?php echo $programme_grid->RowIndex ?>_ProgrammeType" id="x<?php echo $programme_grid->RowIndex ?>_ProgrammeType" value="<?php echo HtmlEncode($programme_grid->ProgrammeType->FormValue) ?>">
<input type="hidden" data-table="programme" data-field="x_ProgrammeType" name="o<?php echo $programme_grid->RowIndex ?>_ProgrammeType" id="o<?php echo $programme_grid->RowIndex ?>_ProgrammeType" value="<?php echo HtmlEncode($programme_grid->ProgrammeType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="programme" data-field="x_ProgrammeType" name="fprogrammegrid$x<?php echo $programme_grid->RowIndex ?>_ProgrammeType" id="fprogrammegrid$x<?php echo $programme_grid->RowIndex ?>_ProgrammeType" value="<?php echo HtmlEncode($programme_grid->ProgrammeType->FormValue) ?>">
<input type="hidden" data-table="programme" data-field="x_ProgrammeType" name="fprogrammegrid$o<?php echo $programme_grid->RowIndex ?>_ProgrammeType" id="fprogrammegrid$o<?php echo $programme_grid->RowIndex ?>_ProgrammeType" value="<?php echo HtmlEncode($programme_grid->ProgrammeType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$programme_grid->ListOptions->render("body", "right", $programme_grid->RowCount);
?>
	</tr>
<?php if ($programme->RowType == ROWTYPE_ADD || $programme->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fprogrammegrid", "load"], function() {
	fprogrammegrid.updateLists(<?php echo $programme_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$programme_grid->isGridAdd() || $programme->CurrentMode == "copy")
		if (!$programme_grid->Recordset->EOF)
			$programme_grid->Recordset->moveNext();
}
?>
<?php
	if ($programme->CurrentMode == "add" || $programme->CurrentMode == "copy" || $programme->CurrentMode == "edit") {
		$programme_grid->RowIndex = '$rowindex$';
		$programme_grid->loadRowValues();

		// Set row properties
		$programme->resetAttributes();
		$programme->RowAttrs->merge(["data-rowindex" => $programme_grid->RowIndex, "id" => "r0_programme", "data-rowtype" => ROWTYPE_ADD]);
		$programme->RowAttrs->appendClass("ew-template");
		$programme->RowType = ROWTYPE_ADD;

		// Render row
		$programme_grid->renderRow();

		// Render list options
		$programme_grid->renderListOptions();
		$programme_grid->StartRowCount = 0;
?>
	<tr <?php echo $programme->rowAttributes() ?>>
<?php

// Render list options (body, left)
$programme_grid->ListOptions->render("body", "left", $programme_grid->RowIndex);
?>
	<?php if ($programme_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if (!$programme->isConfirm()) { ?>
<?php if ($programme_grid->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_programme_LACode" class="form-group programme_LACode">
<span<?php echo $programme_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($programme_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $programme_grid->RowIndex ?>_LACode" name="x<?php echo $programme_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($programme_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_programme_LACode" class="form-group programme_LACode">
<?php
$onchange = $programme_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$programme_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $programme_grid->RowIndex ?>_LACode">
	<input type="text" class="form-control" name="sv_x<?php echo $programme_grid->RowIndex ?>_LACode" id="sv_x<?php echo $programme_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($programme_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($programme_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($programme_grid->LACode->getPlaceHolder()) ?>"<?php echo $programme_grid->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="programme" data-field="x_LACode" data-value-separator="<?php echo $programme_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $programme_grid->RowIndex ?>_LACode" id="x<?php echo $programme_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($programme_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fprogrammegrid"], function() {
	fprogrammegrid.createAutoSuggest({"id":"x<?php echo $programme_grid->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $programme_grid->LACode->Lookup->getParamTag($programme_grid, "p_x" . $programme_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_programme_LACode" class="form-group programme_LACode">
<span<?php echo $programme_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($programme_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="programme" data-field="x_LACode" name="x<?php echo $programme_grid->RowIndex ?>_LACode" id="x<?php echo $programme_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($programme_grid->LACode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="programme" data-field="x_LACode" name="o<?php echo $programme_grid->RowIndex ?>_LACode" id="o<?php echo $programme_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($programme_grid->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($programme_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<?php if (!$programme->isConfirm()) { ?>
<?php if ($programme_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_programme_DepartmentCode" class="form-group programme_DepartmentCode">
<span<?php echo $programme_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($programme_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $programme_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $programme_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($programme_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_programme_DepartmentCode" class="form-group programme_DepartmentCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="programme" data-field="x_DepartmentCode" data-value-separator="<?php echo $programme_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $programme_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $programme_grid->RowIndex ?>_DepartmentCode"<?php echo $programme_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $programme_grid->DepartmentCode->selectOptionListHtml("x{$programme_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $programme_grid->DepartmentCode->Lookup->getParamTag($programme_grid, "p_x" . $programme_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_programme_DepartmentCode" class="form-group programme_DepartmentCode">
<span<?php echo $programme_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($programme_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="programme" data-field="x_DepartmentCode" name="x<?php echo $programme_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $programme_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($programme_grid->DepartmentCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="programme" data-field="x_DepartmentCode" name="o<?php echo $programme_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $programme_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($programme_grid->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($programme_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode">
<?php if (!$programme->isConfirm()) { ?>
<?php if ($programme_grid->SectionCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_programme_SectionCode" class="form-group programme_SectionCode">
<span<?php echo $programme_grid->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($programme_grid->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $programme_grid->RowIndex ?>_SectionCode" name="x<?php echo $programme_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($programme_grid->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_programme_SectionCode" class="form-group programme_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="programme" data-field="x_SectionCode" data-value-separator="<?php echo $programme_grid->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $programme_grid->RowIndex ?>_SectionCode" name="x<?php echo $programme_grid->RowIndex ?>_SectionCode"<?php echo $programme_grid->SectionCode->editAttributes() ?>>
			<?php echo $programme_grid->SectionCode->selectOptionListHtml("x{$programme_grid->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $programme_grid->SectionCode->Lookup->getParamTag($programme_grid, "p_x" . $programme_grid->RowIndex . "_SectionCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_programme_SectionCode" class="form-group programme_SectionCode">
<span<?php echo $programme_grid->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($programme_grid->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="programme" data-field="x_SectionCode" name="x<?php echo $programme_grid->RowIndex ?>_SectionCode" id="x<?php echo $programme_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($programme_grid->SectionCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="programme" data-field="x_SectionCode" name="o<?php echo $programme_grid->RowIndex ?>_SectionCode" id="o<?php echo $programme_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($programme_grid->SectionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($programme_grid->IFMISProgramme->Visible) { // IFMISProgramme ?>
		<td data-name="IFMISProgramme">
<?php if (!$programme->isConfirm()) { ?>
<span id="el$rowindex$_programme_IFMISProgramme" class="form-group programme_IFMISProgramme">
<input type="text" data-table="programme" data-field="x_IFMISProgramme" name="x<?php echo $programme_grid->RowIndex ?>_IFMISProgramme" id="x<?php echo $programme_grid->RowIndex ?>_IFMISProgramme" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($programme_grid->IFMISProgramme->getPlaceHolder()) ?>" value="<?php echo $programme_grid->IFMISProgramme->EditValue ?>"<?php echo $programme_grid->IFMISProgramme->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_programme_IFMISProgramme" class="form-group programme_IFMISProgramme">
<span<?php echo $programme_grid->IFMISProgramme->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($programme_grid->IFMISProgramme->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="programme" data-field="x_IFMISProgramme" name="x<?php echo $programme_grid->RowIndex ?>_IFMISProgramme" id="x<?php echo $programme_grid->RowIndex ?>_IFMISProgramme" value="<?php echo HtmlEncode($programme_grid->IFMISProgramme->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="programme" data-field="x_IFMISProgramme" name="o<?php echo $programme_grid->RowIndex ?>_IFMISProgramme" id="o<?php echo $programme_grid->RowIndex ?>_IFMISProgramme" value="<?php echo HtmlEncode($programme_grid->IFMISProgramme->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($programme_grid->ProgrammeCode->Visible) { // ProgrammeCode ?>
		<td data-name="ProgrammeCode">
<?php if (!$programme->isConfirm()) { ?>
<span id="el$rowindex$_programme_ProgrammeCode" class="form-group programme_ProgrammeCode">
<input type="text" data-table="programme" data-field="x_ProgrammeCode" name="x<?php echo $programme_grid->RowIndex ?>_ProgrammeCode" id="x<?php echo $programme_grid->RowIndex ?>_ProgrammeCode" placeholder="<?php echo HtmlEncode($programme_grid->ProgrammeCode->getPlaceHolder()) ?>" value="<?php echo $programme_grid->ProgrammeCode->EditValue ?>"<?php echo $programme_grid->ProgrammeCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_programme_ProgrammeCode" class="form-group programme_ProgrammeCode">
<span<?php echo $programme_grid->ProgrammeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($programme_grid->ProgrammeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="programme" data-field="x_ProgrammeCode" name="x<?php echo $programme_grid->RowIndex ?>_ProgrammeCode" id="x<?php echo $programme_grid->RowIndex ?>_ProgrammeCode" value="<?php echo HtmlEncode($programme_grid->ProgrammeCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="programme" data-field="x_ProgrammeCode" name="o<?php echo $programme_grid->RowIndex ?>_ProgrammeCode" id="o<?php echo $programme_grid->RowIndex ?>_ProgrammeCode" value="<?php echo HtmlEncode($programme_grid->ProgrammeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($programme_grid->ProgrammeName->Visible) { // ProgrammeName ?>
		<td data-name="ProgrammeName">
<?php if (!$programme->isConfirm()) { ?>
<span id="el$rowindex$_programme_ProgrammeName" class="form-group programme_ProgrammeName">
<input type="text" data-table="programme" data-field="x_ProgrammeName" name="x<?php echo $programme_grid->RowIndex ?>_ProgrammeName" id="x<?php echo $programme_grid->RowIndex ?>_ProgrammeName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($programme_grid->ProgrammeName->getPlaceHolder()) ?>" value="<?php echo $programme_grid->ProgrammeName->EditValue ?>"<?php echo $programme_grid->ProgrammeName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_programme_ProgrammeName" class="form-group programme_ProgrammeName">
<span<?php echo $programme_grid->ProgrammeName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($programme_grid->ProgrammeName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="programme" data-field="x_ProgrammeName" name="x<?php echo $programme_grid->RowIndex ?>_ProgrammeName" id="x<?php echo $programme_grid->RowIndex ?>_ProgrammeName" value="<?php echo HtmlEncode($programme_grid->ProgrammeName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="programme" data-field="x_ProgrammeName" name="o<?php echo $programme_grid->RowIndex ?>_ProgrammeName" id="o<?php echo $programme_grid->RowIndex ?>_ProgrammeName" value="<?php echo HtmlEncode($programme_grid->ProgrammeName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($programme_grid->ProgrammeType->Visible) { // ProgrammeType ?>
		<td data-name="ProgrammeType">
<?php if (!$programme->isConfirm()) { ?>
<span id="el$rowindex$_programme_ProgrammeType" class="form-group programme_ProgrammeType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="programme" data-field="x_ProgrammeType" data-value-separator="<?php echo $programme_grid->ProgrammeType->displayValueSeparatorAttribute() ?>" id="x<?php echo $programme_grid->RowIndex ?>_ProgrammeType" name="x<?php echo $programme_grid->RowIndex ?>_ProgrammeType"<?php echo $programme_grid->ProgrammeType->editAttributes() ?>>
			<?php echo $programme_grid->ProgrammeType->selectOptionListHtml("x{$programme_grid->RowIndex}_ProgrammeType") ?>
		</select>
</div>
<?php echo $programme_grid->ProgrammeType->Lookup->getParamTag($programme_grid, "p_x" . $programme_grid->RowIndex . "_ProgrammeType") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_programme_ProgrammeType" class="form-group programme_ProgrammeType">
<span<?php echo $programme_grid->ProgrammeType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($programme_grid->ProgrammeType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="programme" data-field="x_ProgrammeType" name="x<?php echo $programme_grid->RowIndex ?>_ProgrammeType" id="x<?php echo $programme_grid->RowIndex ?>_ProgrammeType" value="<?php echo HtmlEncode($programme_grid->ProgrammeType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="programme" data-field="x_ProgrammeType" name="o<?php echo $programme_grid->RowIndex ?>_ProgrammeType" id="o<?php echo $programme_grid->RowIndex ?>_ProgrammeType" value="<?php echo HtmlEncode($programme_grid->ProgrammeType->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$programme_grid->ListOptions->render("body", "right", $programme_grid->RowIndex);
?>
<script>
loadjs.ready(["fprogrammegrid", "load"], function() {
	fprogrammegrid.updateLists(<?php echo $programme_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($programme->CurrentMode == "add" || $programme->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $programme_grid->FormKeyCountName ?>" id="<?php echo $programme_grid->FormKeyCountName ?>" value="<?php echo $programme_grid->KeyCount ?>">
<?php echo $programme_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($programme->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $programme_grid->FormKeyCountName ?>" id="<?php echo $programme_grid->FormKeyCountName ?>" value="<?php echo $programme_grid->KeyCount ?>">
<?php echo $programme_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($programme->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fprogrammegrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($programme_grid->Recordset)
	$programme_grid->Recordset->Close();
?>
<?php if ($programme_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $programme_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($programme_grid->TotalRecords == 0 && !$programme->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $programme_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$programme_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$programme_grid->terminate();
?>