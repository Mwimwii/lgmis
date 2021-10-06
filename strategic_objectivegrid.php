<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($strategic_objective_grid))
	$strategic_objective_grid = new strategic_objective_grid();

// Run the page
$strategic_objective_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$strategic_objective_grid->Page_Render();
?>
<?php if (!$strategic_objective_grid->isExport()) { ?>
<script>
var fstrategic_objectivegrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fstrategic_objectivegrid = new ew.Form("fstrategic_objectivegrid", "grid");
	fstrategic_objectivegrid.formKeyCountName = '<?php echo $strategic_objective_grid->FormKeyCountName ?>';

	// Validate form
	fstrategic_objectivegrid.validate = function() {
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
			<?php if ($strategic_objective_grid->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $strategic_objective_grid->LACode->caption(), $strategic_objective_grid->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($strategic_objective_grid->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $strategic_objective_grid->DepartmentCode->caption(), $strategic_objective_grid->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($strategic_objective_grid->StrategicObjectiveCode->Required) { ?>
				elm = this.getElements("x" + infix + "_StrategicObjectiveCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $strategic_objective_grid->StrategicObjectiveCode->caption(), $strategic_objective_grid->StrategicObjectiveCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($strategic_objective_grid->StrategicObjectiveName->Required) { ?>
				elm = this.getElements("x" + infix + "_StrategicObjectiveName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $strategic_objective_grid->StrategicObjectiveName->caption(), $strategic_objective_grid->StrategicObjectiveName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($strategic_objective_grid->ReferencedDocs->Required) { ?>
				elm = this.getElements("x" + infix + "_ReferencedDocs");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $strategic_objective_grid->ReferencedDocs->caption(), $strategic_objective_grid->ReferencedDocs->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($strategic_objective_grid->ResultAreaCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ResultAreaCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $strategic_objective_grid->ResultAreaCode->caption(), $strategic_objective_grid->ResultAreaCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ResultAreaCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($strategic_objective_grid->ResultAreaCode->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fstrategic_objectivegrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "StrategicObjectiveName", false)) return false;
		if (ew.valueChanged(fobj, infix, "ReferencedDocs", false)) return false;
		if (ew.valueChanged(fobj, infix, "ResultAreaCode", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fstrategic_objectivegrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstrategic_objectivegrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstrategic_objectivegrid.lists["x_LACode"] = <?php echo $strategic_objective_grid->LACode->Lookup->toClientList($strategic_objective_grid) ?>;
	fstrategic_objectivegrid.lists["x_LACode"].options = <?php echo JsonEncode($strategic_objective_grid->LACode->lookupOptions()) ?>;
	fstrategic_objectivegrid.lists["x_DepartmentCode"] = <?php echo $strategic_objective_grid->DepartmentCode->Lookup->toClientList($strategic_objective_grid) ?>;
	fstrategic_objectivegrid.lists["x_DepartmentCode"].options = <?php echo JsonEncode($strategic_objective_grid->DepartmentCode->lookupOptions()) ?>;
	loadjs.done("fstrategic_objectivegrid");
});
</script>
<?php } ?>
<?php
$strategic_objective_grid->renderOtherOptions();
?>
<?php if ($strategic_objective_grid->TotalRecords > 0 || $strategic_objective->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($strategic_objective_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> strategic_objective">
<?php if ($strategic_objective_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $strategic_objective_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fstrategic_objectivegrid" class="ew-form ew-list-form form-inline">
<div id="gmp_strategic_objective" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_strategic_objectivegrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$strategic_objective->RowType = ROWTYPE_HEADER;

// Render list options
$strategic_objective_grid->renderListOptions();

// Render list options (header, left)
$strategic_objective_grid->ListOptions->render("header", "left");
?>
<?php if ($strategic_objective_grid->LACode->Visible) { // LACode ?>
	<?php if ($strategic_objective_grid->SortUrl($strategic_objective_grid->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $strategic_objective_grid->LACode->headerCellClass() ?>"><div id="elh_strategic_objective_LACode" class="strategic_objective_LACode"><div class="ew-table-header-caption"><?php echo $strategic_objective_grid->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $strategic_objective_grid->LACode->headerCellClass() ?>"><div><div id="elh_strategic_objective_LACode" class="strategic_objective_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $strategic_objective_grid->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($strategic_objective_grid->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($strategic_objective_grid->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($strategic_objective_grid->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($strategic_objective_grid->SortUrl($strategic_objective_grid->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $strategic_objective_grid->DepartmentCode->headerCellClass() ?>"><div id="elh_strategic_objective_DepartmentCode" class="strategic_objective_DepartmentCode"><div class="ew-table-header-caption"><?php echo $strategic_objective_grid->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $strategic_objective_grid->DepartmentCode->headerCellClass() ?>"><div><div id="elh_strategic_objective_DepartmentCode" class="strategic_objective_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $strategic_objective_grid->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($strategic_objective_grid->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($strategic_objective_grid->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($strategic_objective_grid->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
	<?php if ($strategic_objective_grid->SortUrl($strategic_objective_grid->StrategicObjectiveCode) == "") { ?>
		<th data-name="StrategicObjectiveCode" class="<?php echo $strategic_objective_grid->StrategicObjectiveCode->headerCellClass() ?>"><div id="elh_strategic_objective_StrategicObjectiveCode" class="strategic_objective_StrategicObjectiveCode"><div class="ew-table-header-caption"><?php echo $strategic_objective_grid->StrategicObjectiveCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StrategicObjectiveCode" class="<?php echo $strategic_objective_grid->StrategicObjectiveCode->headerCellClass() ?>"><div><div id="elh_strategic_objective_StrategicObjectiveCode" class="strategic_objective_StrategicObjectiveCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $strategic_objective_grid->StrategicObjectiveCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($strategic_objective_grid->StrategicObjectiveCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($strategic_objective_grid->StrategicObjectiveCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($strategic_objective_grid->StrategicObjectiveName->Visible) { // StrategicObjectiveName ?>
	<?php if ($strategic_objective_grid->SortUrl($strategic_objective_grid->StrategicObjectiveName) == "") { ?>
		<th data-name="StrategicObjectiveName" class="<?php echo $strategic_objective_grid->StrategicObjectiveName->headerCellClass() ?>"><div id="elh_strategic_objective_StrategicObjectiveName" class="strategic_objective_StrategicObjectiveName"><div class="ew-table-header-caption"><?php echo $strategic_objective_grid->StrategicObjectiveName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StrategicObjectiveName" class="<?php echo $strategic_objective_grid->StrategicObjectiveName->headerCellClass() ?>"><div><div id="elh_strategic_objective_StrategicObjectiveName" class="strategic_objective_StrategicObjectiveName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $strategic_objective_grid->StrategicObjectiveName->caption() ?></span><span class="ew-table-header-sort"><?php if ($strategic_objective_grid->StrategicObjectiveName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($strategic_objective_grid->StrategicObjectiveName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($strategic_objective_grid->ReferencedDocs->Visible) { // ReferencedDocs ?>
	<?php if ($strategic_objective_grid->SortUrl($strategic_objective_grid->ReferencedDocs) == "") { ?>
		<th data-name="ReferencedDocs" class="<?php echo $strategic_objective_grid->ReferencedDocs->headerCellClass() ?>"><div id="elh_strategic_objective_ReferencedDocs" class="strategic_objective_ReferencedDocs"><div class="ew-table-header-caption"><?php echo $strategic_objective_grid->ReferencedDocs->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReferencedDocs" class="<?php echo $strategic_objective_grid->ReferencedDocs->headerCellClass() ?>"><div><div id="elh_strategic_objective_ReferencedDocs" class="strategic_objective_ReferencedDocs">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $strategic_objective_grid->ReferencedDocs->caption() ?></span><span class="ew-table-header-sort"><?php if ($strategic_objective_grid->ReferencedDocs->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($strategic_objective_grid->ReferencedDocs->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($strategic_objective_grid->ResultAreaCode->Visible) { // ResultAreaCode ?>
	<?php if ($strategic_objective_grid->SortUrl($strategic_objective_grid->ResultAreaCode) == "") { ?>
		<th data-name="ResultAreaCode" class="<?php echo $strategic_objective_grid->ResultAreaCode->headerCellClass() ?>"><div id="elh_strategic_objective_ResultAreaCode" class="strategic_objective_ResultAreaCode"><div class="ew-table-header-caption"><?php echo $strategic_objective_grid->ResultAreaCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ResultAreaCode" class="<?php echo $strategic_objective_grid->ResultAreaCode->headerCellClass() ?>"><div><div id="elh_strategic_objective_ResultAreaCode" class="strategic_objective_ResultAreaCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $strategic_objective_grid->ResultAreaCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($strategic_objective_grid->ResultAreaCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($strategic_objective_grid->ResultAreaCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$strategic_objective_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$strategic_objective_grid->StartRecord = 1;
$strategic_objective_grid->StopRecord = $strategic_objective_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($strategic_objective->isConfirm() || $strategic_objective_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($strategic_objective_grid->FormKeyCountName) && ($strategic_objective_grid->isGridAdd() || $strategic_objective_grid->isGridEdit() || $strategic_objective->isConfirm())) {
		$strategic_objective_grid->KeyCount = $CurrentForm->getValue($strategic_objective_grid->FormKeyCountName);
		$strategic_objective_grid->StopRecord = $strategic_objective_grid->StartRecord + $strategic_objective_grid->KeyCount - 1;
	}
}
$strategic_objective_grid->RecordCount = $strategic_objective_grid->StartRecord - 1;
if ($strategic_objective_grid->Recordset && !$strategic_objective_grid->Recordset->EOF) {
	$strategic_objective_grid->Recordset->moveFirst();
	$selectLimit = $strategic_objective_grid->UseSelectLimit;
	if (!$selectLimit && $strategic_objective_grid->StartRecord > 1)
		$strategic_objective_grid->Recordset->move($strategic_objective_grid->StartRecord - 1);
} elseif (!$strategic_objective->AllowAddDeleteRow && $strategic_objective_grid->StopRecord == 0) {
	$strategic_objective_grid->StopRecord = $strategic_objective->GridAddRowCount;
}

// Initialize aggregate
$strategic_objective->RowType = ROWTYPE_AGGREGATEINIT;
$strategic_objective->resetAttributes();
$strategic_objective_grid->renderRow();
if ($strategic_objective_grid->isGridAdd())
	$strategic_objective_grid->RowIndex = 0;
if ($strategic_objective_grid->isGridEdit())
	$strategic_objective_grid->RowIndex = 0;
while ($strategic_objective_grid->RecordCount < $strategic_objective_grid->StopRecord) {
	$strategic_objective_grid->RecordCount++;
	if ($strategic_objective_grid->RecordCount >= $strategic_objective_grid->StartRecord) {
		$strategic_objective_grid->RowCount++;
		if ($strategic_objective_grid->isGridAdd() || $strategic_objective_grid->isGridEdit() || $strategic_objective->isConfirm()) {
			$strategic_objective_grid->RowIndex++;
			$CurrentForm->Index = $strategic_objective_grid->RowIndex;
			if ($CurrentForm->hasValue($strategic_objective_grid->FormActionName) && ($strategic_objective->isConfirm() || $strategic_objective_grid->EventCancelled))
				$strategic_objective_grid->RowAction = strval($CurrentForm->getValue($strategic_objective_grid->FormActionName));
			elseif ($strategic_objective_grid->isGridAdd())
				$strategic_objective_grid->RowAction = "insert";
			else
				$strategic_objective_grid->RowAction = "";
		}

		// Set up key count
		$strategic_objective_grid->KeyCount = $strategic_objective_grid->RowIndex;

		// Init row class and style
		$strategic_objective->resetAttributes();
		$strategic_objective->CssClass = "";
		if ($strategic_objective_grid->isGridAdd()) {
			if ($strategic_objective->CurrentMode == "copy") {
				$strategic_objective_grid->loadRowValues($strategic_objective_grid->Recordset); // Load row values
				$strategic_objective_grid->setRecordKey($strategic_objective_grid->RowOldKey, $strategic_objective_grid->Recordset); // Set old record key
			} else {
				$strategic_objective_grid->loadRowValues(); // Load default values
				$strategic_objective_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$strategic_objective_grid->loadRowValues($strategic_objective_grid->Recordset); // Load row values
		}
		$strategic_objective->RowType = ROWTYPE_VIEW; // Render view
		if ($strategic_objective_grid->isGridAdd()) // Grid add
			$strategic_objective->RowType = ROWTYPE_ADD; // Render add
		if ($strategic_objective_grid->isGridAdd() && $strategic_objective->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$strategic_objective_grid->restoreCurrentRowFormValues($strategic_objective_grid->RowIndex); // Restore form values
		if ($strategic_objective_grid->isGridEdit()) { // Grid edit
			if ($strategic_objective->EventCancelled)
				$strategic_objective_grid->restoreCurrentRowFormValues($strategic_objective_grid->RowIndex); // Restore form values
			if ($strategic_objective_grid->RowAction == "insert")
				$strategic_objective->RowType = ROWTYPE_ADD; // Render add
			else
				$strategic_objective->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($strategic_objective_grid->isGridEdit() && ($strategic_objective->RowType == ROWTYPE_EDIT || $strategic_objective->RowType == ROWTYPE_ADD) && $strategic_objective->EventCancelled) // Update failed
			$strategic_objective_grid->restoreCurrentRowFormValues($strategic_objective_grid->RowIndex); // Restore form values
		if ($strategic_objective->RowType == ROWTYPE_EDIT) // Edit row
			$strategic_objective_grid->EditRowCount++;
		if ($strategic_objective->isConfirm()) // Confirm row
			$strategic_objective_grid->restoreCurrentRowFormValues($strategic_objective_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$strategic_objective->RowAttrs->merge(["data-rowindex" => $strategic_objective_grid->RowCount, "id" => "r" . $strategic_objective_grid->RowCount . "_strategic_objective", "data-rowtype" => $strategic_objective->RowType]);

		// Render row
		$strategic_objective_grid->renderRow();

		// Render list options
		$strategic_objective_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($strategic_objective_grid->RowAction != "delete" && $strategic_objective_grid->RowAction != "insertdelete" && !($strategic_objective_grid->RowAction == "insert" && $strategic_objective->isConfirm() && $strategic_objective_grid->emptyRow())) {
?>
	<tr <?php echo $strategic_objective->rowAttributes() ?>>
<?php

// Render list options (body, left)
$strategic_objective_grid->ListOptions->render("body", "left", $strategic_objective_grid->RowCount);
?>
	<?php if ($strategic_objective_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $strategic_objective_grid->LACode->cellAttributes() ?>>
<?php if ($strategic_objective->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($strategic_objective_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $strategic_objective_grid->RowCount ?>_strategic_objective_LACode" class="form-group">
<span<?php echo $strategic_objective_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($strategic_objective_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $strategic_objective_grid->RowIndex ?>_LACode" name="x<?php echo $strategic_objective_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($strategic_objective_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $strategic_objective_grid->RowCount ?>_strategic_objective_LACode" class="form-group">
<?php $strategic_objective_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $strategic_objective_grid->RowIndex ?>_LACode"><?php echo EmptyValue(strval($strategic_objective_grid->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $strategic_objective_grid->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($strategic_objective_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($strategic_objective_grid->LACode->ReadOnly || $strategic_objective_grid->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $strategic_objective_grid->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $strategic_objective_grid->LACode->Lookup->getParamTag($strategic_objective_grid, "p_x" . $strategic_objective_grid->RowIndex . "_LACode") ?>
<input type="hidden" data-table="strategic_objective" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $strategic_objective_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $strategic_objective_grid->RowIndex ?>_LACode" id="x<?php echo $strategic_objective_grid->RowIndex ?>_LACode" value="<?php echo $strategic_objective_grid->LACode->CurrentValue ?>"<?php echo $strategic_objective_grid->LACode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="strategic_objective" data-field="x_LACode" name="o<?php echo $strategic_objective_grid->RowIndex ?>_LACode" id="o<?php echo $strategic_objective_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($strategic_objective_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($strategic_objective->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($strategic_objective_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $strategic_objective_grid->RowCount ?>_strategic_objective_LACode" class="form-group">
<span<?php echo $strategic_objective_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($strategic_objective_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $strategic_objective_grid->RowIndex ?>_LACode" name="x<?php echo $strategic_objective_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($strategic_objective_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $strategic_objective_grid->RowCount ?>_strategic_objective_LACode" class="form-group">
<?php $strategic_objective_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $strategic_objective_grid->RowIndex ?>_LACode"><?php echo EmptyValue(strval($strategic_objective_grid->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $strategic_objective_grid->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($strategic_objective_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($strategic_objective_grid->LACode->ReadOnly || $strategic_objective_grid->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $strategic_objective_grid->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $strategic_objective_grid->LACode->Lookup->getParamTag($strategic_objective_grid, "p_x" . $strategic_objective_grid->RowIndex . "_LACode") ?>
<input type="hidden" data-table="strategic_objective" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $strategic_objective_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $strategic_objective_grid->RowIndex ?>_LACode" id="x<?php echo $strategic_objective_grid->RowIndex ?>_LACode" value="<?php echo $strategic_objective_grid->LACode->CurrentValue ?>"<?php echo $strategic_objective_grid->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($strategic_objective->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $strategic_objective_grid->RowCount ?>_strategic_objective_LACode">
<span<?php echo $strategic_objective_grid->LACode->viewAttributes() ?>><?php echo $strategic_objective_grid->LACode->getViewValue() ?></span>
</span>
<?php if (!$strategic_objective->isConfirm()) { ?>
<input type="hidden" data-table="strategic_objective" data-field="x_LACode" name="x<?php echo $strategic_objective_grid->RowIndex ?>_LACode" id="x<?php echo $strategic_objective_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($strategic_objective_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="strategic_objective" data-field="x_LACode" name="o<?php echo $strategic_objective_grid->RowIndex ?>_LACode" id="o<?php echo $strategic_objective_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($strategic_objective_grid->LACode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="strategic_objective" data-field="x_LACode" name="fstrategic_objectivegrid$x<?php echo $strategic_objective_grid->RowIndex ?>_LACode" id="fstrategic_objectivegrid$x<?php echo $strategic_objective_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($strategic_objective_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="strategic_objective" data-field="x_LACode" name="fstrategic_objectivegrid$o<?php echo $strategic_objective_grid->RowIndex ?>_LACode" id="fstrategic_objectivegrid$o<?php echo $strategic_objective_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($strategic_objective_grid->LACode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($strategic_objective_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $strategic_objective_grid->DepartmentCode->cellAttributes() ?>>
<?php if ($strategic_objective->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $strategic_objective_grid->RowCount ?>_strategic_objective_DepartmentCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="strategic_objective" data-field="x_DepartmentCode" data-value-separator="<?php echo $strategic_objective_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $strategic_objective_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $strategic_objective_grid->RowIndex ?>_DepartmentCode"<?php echo $strategic_objective_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $strategic_objective_grid->DepartmentCode->selectOptionListHtml("x{$strategic_objective_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $strategic_objective_grid->DepartmentCode->Lookup->getParamTag($strategic_objective_grid, "p_x" . $strategic_objective_grid->RowIndex . "_DepartmentCode") ?>
</span>
<input type="hidden" data-table="strategic_objective" data-field="x_DepartmentCode" name="o<?php echo $strategic_objective_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $strategic_objective_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($strategic_objective_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($strategic_objective->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $strategic_objective_grid->RowCount ?>_strategic_objective_DepartmentCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="strategic_objective" data-field="x_DepartmentCode" data-value-separator="<?php echo $strategic_objective_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $strategic_objective_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $strategic_objective_grid->RowIndex ?>_DepartmentCode"<?php echo $strategic_objective_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $strategic_objective_grid->DepartmentCode->selectOptionListHtml("x{$strategic_objective_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $strategic_objective_grid->DepartmentCode->Lookup->getParamTag($strategic_objective_grid, "p_x" . $strategic_objective_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php if ($strategic_objective->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $strategic_objective_grid->RowCount ?>_strategic_objective_DepartmentCode">
<span<?php echo $strategic_objective_grid->DepartmentCode->viewAttributes() ?>><?php echo $strategic_objective_grid->DepartmentCode->getViewValue() ?></span>
</span>
<?php if (!$strategic_objective->isConfirm()) { ?>
<input type="hidden" data-table="strategic_objective" data-field="x_DepartmentCode" name="x<?php echo $strategic_objective_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $strategic_objective_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($strategic_objective_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="strategic_objective" data-field="x_DepartmentCode" name="o<?php echo $strategic_objective_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $strategic_objective_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($strategic_objective_grid->DepartmentCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="strategic_objective" data-field="x_DepartmentCode" name="fstrategic_objectivegrid$x<?php echo $strategic_objective_grid->RowIndex ?>_DepartmentCode" id="fstrategic_objectivegrid$x<?php echo $strategic_objective_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($strategic_objective_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="strategic_objective" data-field="x_DepartmentCode" name="fstrategic_objectivegrid$o<?php echo $strategic_objective_grid->RowIndex ?>_DepartmentCode" id="fstrategic_objectivegrid$o<?php echo $strategic_objective_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($strategic_objective_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($strategic_objective_grid->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
		<td data-name="StrategicObjectiveCode" <?php echo $strategic_objective_grid->StrategicObjectiveCode->cellAttributes() ?>>
<?php if ($strategic_objective->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $strategic_objective_grid->RowCount ?>_strategic_objective_StrategicObjectiveCode" class="form-group"></span>
<input type="hidden" data-table="strategic_objective" data-field="x_StrategicObjectiveCode" name="o<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveCode" id="o<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($strategic_objective_grid->StrategicObjectiveCode->OldValue) ?>">
<?php } ?>
<?php if ($strategic_objective->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $strategic_objective_grid->RowCount ?>_strategic_objective_StrategicObjectiveCode" class="form-group">
<span<?php echo $strategic_objective_grid->StrategicObjectiveCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($strategic_objective_grid->StrategicObjectiveCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="strategic_objective" data-field="x_StrategicObjectiveCode" name="x<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveCode" id="x<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($strategic_objective_grid->StrategicObjectiveCode->CurrentValue) ?>">
<?php } ?>
<?php if ($strategic_objective->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $strategic_objective_grid->RowCount ?>_strategic_objective_StrategicObjectiveCode">
<span<?php echo $strategic_objective_grid->StrategicObjectiveCode->viewAttributes() ?>><?php echo $strategic_objective_grid->StrategicObjectiveCode->getViewValue() ?></span>
</span>
<?php if (!$strategic_objective->isConfirm()) { ?>
<input type="hidden" data-table="strategic_objective" data-field="x_StrategicObjectiveCode" name="x<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveCode" id="x<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($strategic_objective_grid->StrategicObjectiveCode->FormValue) ?>">
<input type="hidden" data-table="strategic_objective" data-field="x_StrategicObjectiveCode" name="o<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveCode" id="o<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($strategic_objective_grid->StrategicObjectiveCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="strategic_objective" data-field="x_StrategicObjectiveCode" name="fstrategic_objectivegrid$x<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveCode" id="fstrategic_objectivegrid$x<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($strategic_objective_grid->StrategicObjectiveCode->FormValue) ?>">
<input type="hidden" data-table="strategic_objective" data-field="x_StrategicObjectiveCode" name="fstrategic_objectivegrid$o<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveCode" id="fstrategic_objectivegrid$o<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($strategic_objective_grid->StrategicObjectiveCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($strategic_objective_grid->StrategicObjectiveName->Visible) { // StrategicObjectiveName ?>
		<td data-name="StrategicObjectiveName" <?php echo $strategic_objective_grid->StrategicObjectiveName->cellAttributes() ?>>
<?php if ($strategic_objective->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $strategic_objective_grid->RowCount ?>_strategic_objective_StrategicObjectiveName" class="form-group">
<textarea data-table="strategic_objective" data-field="x_StrategicObjectiveName" name="x<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveName" id="x<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveName" cols="50" rows="2" placeholder="<?php echo HtmlEncode($strategic_objective_grid->StrategicObjectiveName->getPlaceHolder()) ?>"<?php echo $strategic_objective_grid->StrategicObjectiveName->editAttributes() ?>><?php echo $strategic_objective_grid->StrategicObjectiveName->EditValue ?></textarea>
</span>
<input type="hidden" data-table="strategic_objective" data-field="x_StrategicObjectiveName" name="o<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveName" id="o<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveName" value="<?php echo HtmlEncode($strategic_objective_grid->StrategicObjectiveName->OldValue) ?>">
<?php } ?>
<?php if ($strategic_objective->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $strategic_objective_grid->RowCount ?>_strategic_objective_StrategicObjectiveName" class="form-group">
<textarea data-table="strategic_objective" data-field="x_StrategicObjectiveName" name="x<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveName" id="x<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveName" cols="50" rows="2" placeholder="<?php echo HtmlEncode($strategic_objective_grid->StrategicObjectiveName->getPlaceHolder()) ?>"<?php echo $strategic_objective_grid->StrategicObjectiveName->editAttributes() ?>><?php echo $strategic_objective_grid->StrategicObjectiveName->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($strategic_objective->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $strategic_objective_grid->RowCount ?>_strategic_objective_StrategicObjectiveName">
<span<?php echo $strategic_objective_grid->StrategicObjectiveName->viewAttributes() ?>><?php echo $strategic_objective_grid->StrategicObjectiveName->getViewValue() ?></span>
</span>
<?php if (!$strategic_objective->isConfirm()) { ?>
<input type="hidden" data-table="strategic_objective" data-field="x_StrategicObjectiveName" name="x<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveName" id="x<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveName" value="<?php echo HtmlEncode($strategic_objective_grid->StrategicObjectiveName->FormValue) ?>">
<input type="hidden" data-table="strategic_objective" data-field="x_StrategicObjectiveName" name="o<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveName" id="o<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveName" value="<?php echo HtmlEncode($strategic_objective_grid->StrategicObjectiveName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="strategic_objective" data-field="x_StrategicObjectiveName" name="fstrategic_objectivegrid$x<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveName" id="fstrategic_objectivegrid$x<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveName" value="<?php echo HtmlEncode($strategic_objective_grid->StrategicObjectiveName->FormValue) ?>">
<input type="hidden" data-table="strategic_objective" data-field="x_StrategicObjectiveName" name="fstrategic_objectivegrid$o<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveName" id="fstrategic_objectivegrid$o<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveName" value="<?php echo HtmlEncode($strategic_objective_grid->StrategicObjectiveName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($strategic_objective_grid->ReferencedDocs->Visible) { // ReferencedDocs ?>
		<td data-name="ReferencedDocs" <?php echo $strategic_objective_grid->ReferencedDocs->cellAttributes() ?>>
<?php if ($strategic_objective->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $strategic_objective_grid->RowCount ?>_strategic_objective_ReferencedDocs" class="form-group">
<textarea data-table="strategic_objective" data-field="x_ReferencedDocs" name="x<?php echo $strategic_objective_grid->RowIndex ?>_ReferencedDocs" id="x<?php echo $strategic_objective_grid->RowIndex ?>_ReferencedDocs" cols="50" rows="2" placeholder="<?php echo HtmlEncode($strategic_objective_grid->ReferencedDocs->getPlaceHolder()) ?>"<?php echo $strategic_objective_grid->ReferencedDocs->editAttributes() ?>><?php echo $strategic_objective_grid->ReferencedDocs->EditValue ?></textarea>
</span>
<input type="hidden" data-table="strategic_objective" data-field="x_ReferencedDocs" name="o<?php echo $strategic_objective_grid->RowIndex ?>_ReferencedDocs" id="o<?php echo $strategic_objective_grid->RowIndex ?>_ReferencedDocs" value="<?php echo HtmlEncode($strategic_objective_grid->ReferencedDocs->OldValue) ?>">
<?php } ?>
<?php if ($strategic_objective->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $strategic_objective_grid->RowCount ?>_strategic_objective_ReferencedDocs" class="form-group">
<textarea data-table="strategic_objective" data-field="x_ReferencedDocs" name="x<?php echo $strategic_objective_grid->RowIndex ?>_ReferencedDocs" id="x<?php echo $strategic_objective_grid->RowIndex ?>_ReferencedDocs" cols="50" rows="2" placeholder="<?php echo HtmlEncode($strategic_objective_grid->ReferencedDocs->getPlaceHolder()) ?>"<?php echo $strategic_objective_grid->ReferencedDocs->editAttributes() ?>><?php echo $strategic_objective_grid->ReferencedDocs->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($strategic_objective->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $strategic_objective_grid->RowCount ?>_strategic_objective_ReferencedDocs">
<span<?php echo $strategic_objective_grid->ReferencedDocs->viewAttributes() ?>><?php echo $strategic_objective_grid->ReferencedDocs->getViewValue() ?></span>
</span>
<?php if (!$strategic_objective->isConfirm()) { ?>
<input type="hidden" data-table="strategic_objective" data-field="x_ReferencedDocs" name="x<?php echo $strategic_objective_grid->RowIndex ?>_ReferencedDocs" id="x<?php echo $strategic_objective_grid->RowIndex ?>_ReferencedDocs" value="<?php echo HtmlEncode($strategic_objective_grid->ReferencedDocs->FormValue) ?>">
<input type="hidden" data-table="strategic_objective" data-field="x_ReferencedDocs" name="o<?php echo $strategic_objective_grid->RowIndex ?>_ReferencedDocs" id="o<?php echo $strategic_objective_grid->RowIndex ?>_ReferencedDocs" value="<?php echo HtmlEncode($strategic_objective_grid->ReferencedDocs->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="strategic_objective" data-field="x_ReferencedDocs" name="fstrategic_objectivegrid$x<?php echo $strategic_objective_grid->RowIndex ?>_ReferencedDocs" id="fstrategic_objectivegrid$x<?php echo $strategic_objective_grid->RowIndex ?>_ReferencedDocs" value="<?php echo HtmlEncode($strategic_objective_grid->ReferencedDocs->FormValue) ?>">
<input type="hidden" data-table="strategic_objective" data-field="x_ReferencedDocs" name="fstrategic_objectivegrid$o<?php echo $strategic_objective_grid->RowIndex ?>_ReferencedDocs" id="fstrategic_objectivegrid$o<?php echo $strategic_objective_grid->RowIndex ?>_ReferencedDocs" value="<?php echo HtmlEncode($strategic_objective_grid->ReferencedDocs->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($strategic_objective_grid->ResultAreaCode->Visible) { // ResultAreaCode ?>
		<td data-name="ResultAreaCode" <?php echo $strategic_objective_grid->ResultAreaCode->cellAttributes() ?>>
<?php if ($strategic_objective->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $strategic_objective_grid->RowCount ?>_strategic_objective_ResultAreaCode" class="form-group">
<input type="text" data-table="strategic_objective" data-field="x_ResultAreaCode" name="x<?php echo $strategic_objective_grid->RowIndex ?>_ResultAreaCode" id="x<?php echo $strategic_objective_grid->RowIndex ?>_ResultAreaCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($strategic_objective_grid->ResultAreaCode->getPlaceHolder()) ?>" value="<?php echo $strategic_objective_grid->ResultAreaCode->EditValue ?>"<?php echo $strategic_objective_grid->ResultAreaCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="strategic_objective" data-field="x_ResultAreaCode" name="o<?php echo $strategic_objective_grid->RowIndex ?>_ResultAreaCode" id="o<?php echo $strategic_objective_grid->RowIndex ?>_ResultAreaCode" value="<?php echo HtmlEncode($strategic_objective_grid->ResultAreaCode->OldValue) ?>">
<?php } ?>
<?php if ($strategic_objective->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $strategic_objective_grid->RowCount ?>_strategic_objective_ResultAreaCode" class="form-group">
<input type="text" data-table="strategic_objective" data-field="x_ResultAreaCode" name="x<?php echo $strategic_objective_grid->RowIndex ?>_ResultAreaCode" id="x<?php echo $strategic_objective_grid->RowIndex ?>_ResultAreaCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($strategic_objective_grid->ResultAreaCode->getPlaceHolder()) ?>" value="<?php echo $strategic_objective_grid->ResultAreaCode->EditValue ?>"<?php echo $strategic_objective_grid->ResultAreaCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($strategic_objective->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $strategic_objective_grid->RowCount ?>_strategic_objective_ResultAreaCode">
<span<?php echo $strategic_objective_grid->ResultAreaCode->viewAttributes() ?>><?php echo $strategic_objective_grid->ResultAreaCode->getViewValue() ?></span>
</span>
<?php if (!$strategic_objective->isConfirm()) { ?>
<input type="hidden" data-table="strategic_objective" data-field="x_ResultAreaCode" name="x<?php echo $strategic_objective_grid->RowIndex ?>_ResultAreaCode" id="x<?php echo $strategic_objective_grid->RowIndex ?>_ResultAreaCode" value="<?php echo HtmlEncode($strategic_objective_grid->ResultAreaCode->FormValue) ?>">
<input type="hidden" data-table="strategic_objective" data-field="x_ResultAreaCode" name="o<?php echo $strategic_objective_grid->RowIndex ?>_ResultAreaCode" id="o<?php echo $strategic_objective_grid->RowIndex ?>_ResultAreaCode" value="<?php echo HtmlEncode($strategic_objective_grid->ResultAreaCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="strategic_objective" data-field="x_ResultAreaCode" name="fstrategic_objectivegrid$x<?php echo $strategic_objective_grid->RowIndex ?>_ResultAreaCode" id="fstrategic_objectivegrid$x<?php echo $strategic_objective_grid->RowIndex ?>_ResultAreaCode" value="<?php echo HtmlEncode($strategic_objective_grid->ResultAreaCode->FormValue) ?>">
<input type="hidden" data-table="strategic_objective" data-field="x_ResultAreaCode" name="fstrategic_objectivegrid$o<?php echo $strategic_objective_grid->RowIndex ?>_ResultAreaCode" id="fstrategic_objectivegrid$o<?php echo $strategic_objective_grid->RowIndex ?>_ResultAreaCode" value="<?php echo HtmlEncode($strategic_objective_grid->ResultAreaCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$strategic_objective_grid->ListOptions->render("body", "right", $strategic_objective_grid->RowCount);
?>
	</tr>
<?php if ($strategic_objective->RowType == ROWTYPE_ADD || $strategic_objective->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fstrategic_objectivegrid", "load"], function() {
	fstrategic_objectivegrid.updateLists(<?php echo $strategic_objective_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$strategic_objective_grid->isGridAdd() || $strategic_objective->CurrentMode == "copy")
		if (!$strategic_objective_grid->Recordset->EOF)
			$strategic_objective_grid->Recordset->moveNext();
}
?>
<?php
	if ($strategic_objective->CurrentMode == "add" || $strategic_objective->CurrentMode == "copy" || $strategic_objective->CurrentMode == "edit") {
		$strategic_objective_grid->RowIndex = '$rowindex$';
		$strategic_objective_grid->loadRowValues();

		// Set row properties
		$strategic_objective->resetAttributes();
		$strategic_objective->RowAttrs->merge(["data-rowindex" => $strategic_objective_grid->RowIndex, "id" => "r0_strategic_objective", "data-rowtype" => ROWTYPE_ADD]);
		$strategic_objective->RowAttrs->appendClass("ew-template");
		$strategic_objective->RowType = ROWTYPE_ADD;

		// Render row
		$strategic_objective_grid->renderRow();

		// Render list options
		$strategic_objective_grid->renderListOptions();
		$strategic_objective_grid->StartRowCount = 0;
?>
	<tr <?php echo $strategic_objective->rowAttributes() ?>>
<?php

// Render list options (body, left)
$strategic_objective_grid->ListOptions->render("body", "left", $strategic_objective_grid->RowIndex);
?>
	<?php if ($strategic_objective_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if (!$strategic_objective->isConfirm()) { ?>
<?php if ($strategic_objective_grid->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_strategic_objective_LACode" class="form-group strategic_objective_LACode">
<span<?php echo $strategic_objective_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($strategic_objective_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $strategic_objective_grid->RowIndex ?>_LACode" name="x<?php echo $strategic_objective_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($strategic_objective_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_strategic_objective_LACode" class="form-group strategic_objective_LACode">
<?php $strategic_objective_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $strategic_objective_grid->RowIndex ?>_LACode"><?php echo EmptyValue(strval($strategic_objective_grid->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $strategic_objective_grid->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($strategic_objective_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($strategic_objective_grid->LACode->ReadOnly || $strategic_objective_grid->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $strategic_objective_grid->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $strategic_objective_grid->LACode->Lookup->getParamTag($strategic_objective_grid, "p_x" . $strategic_objective_grid->RowIndex . "_LACode") ?>
<input type="hidden" data-table="strategic_objective" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $strategic_objective_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $strategic_objective_grid->RowIndex ?>_LACode" id="x<?php echo $strategic_objective_grid->RowIndex ?>_LACode" value="<?php echo $strategic_objective_grid->LACode->CurrentValue ?>"<?php echo $strategic_objective_grid->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_strategic_objective_LACode" class="form-group strategic_objective_LACode">
<span<?php echo $strategic_objective_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($strategic_objective_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="strategic_objective" data-field="x_LACode" name="x<?php echo $strategic_objective_grid->RowIndex ?>_LACode" id="x<?php echo $strategic_objective_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($strategic_objective_grid->LACode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="strategic_objective" data-field="x_LACode" name="o<?php echo $strategic_objective_grid->RowIndex ?>_LACode" id="o<?php echo $strategic_objective_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($strategic_objective_grid->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($strategic_objective_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<?php if (!$strategic_objective->isConfirm()) { ?>
<span id="el$rowindex$_strategic_objective_DepartmentCode" class="form-group strategic_objective_DepartmentCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="strategic_objective" data-field="x_DepartmentCode" data-value-separator="<?php echo $strategic_objective_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $strategic_objective_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $strategic_objective_grid->RowIndex ?>_DepartmentCode"<?php echo $strategic_objective_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $strategic_objective_grid->DepartmentCode->selectOptionListHtml("x{$strategic_objective_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $strategic_objective_grid->DepartmentCode->Lookup->getParamTag($strategic_objective_grid, "p_x" . $strategic_objective_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_strategic_objective_DepartmentCode" class="form-group strategic_objective_DepartmentCode">
<span<?php echo $strategic_objective_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($strategic_objective_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="strategic_objective" data-field="x_DepartmentCode" name="x<?php echo $strategic_objective_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $strategic_objective_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($strategic_objective_grid->DepartmentCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="strategic_objective" data-field="x_DepartmentCode" name="o<?php echo $strategic_objective_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $strategic_objective_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($strategic_objective_grid->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($strategic_objective_grid->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
		<td data-name="StrategicObjectiveCode">
<?php if (!$strategic_objective->isConfirm()) { ?>
<span id="el$rowindex$_strategic_objective_StrategicObjectiveCode" class="form-group strategic_objective_StrategicObjectiveCode"></span>
<?php } else { ?>
<span id="el$rowindex$_strategic_objective_StrategicObjectiveCode" class="form-group strategic_objective_StrategicObjectiveCode">
<span<?php echo $strategic_objective_grid->StrategicObjectiveCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($strategic_objective_grid->StrategicObjectiveCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="strategic_objective" data-field="x_StrategicObjectiveCode" name="x<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveCode" id="x<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($strategic_objective_grid->StrategicObjectiveCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="strategic_objective" data-field="x_StrategicObjectiveCode" name="o<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveCode" id="o<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($strategic_objective_grid->StrategicObjectiveCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($strategic_objective_grid->StrategicObjectiveName->Visible) { // StrategicObjectiveName ?>
		<td data-name="StrategicObjectiveName">
<?php if (!$strategic_objective->isConfirm()) { ?>
<span id="el$rowindex$_strategic_objective_StrategicObjectiveName" class="form-group strategic_objective_StrategicObjectiveName">
<textarea data-table="strategic_objective" data-field="x_StrategicObjectiveName" name="x<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveName" id="x<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveName" cols="50" rows="2" placeholder="<?php echo HtmlEncode($strategic_objective_grid->StrategicObjectiveName->getPlaceHolder()) ?>"<?php echo $strategic_objective_grid->StrategicObjectiveName->editAttributes() ?>><?php echo $strategic_objective_grid->StrategicObjectiveName->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_strategic_objective_StrategicObjectiveName" class="form-group strategic_objective_StrategicObjectiveName">
<span<?php echo $strategic_objective_grid->StrategicObjectiveName->viewAttributes() ?>><?php echo $strategic_objective_grid->StrategicObjectiveName->ViewValue ?></span>
</span>
<input type="hidden" data-table="strategic_objective" data-field="x_StrategicObjectiveName" name="x<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveName" id="x<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveName" value="<?php echo HtmlEncode($strategic_objective_grid->StrategicObjectiveName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="strategic_objective" data-field="x_StrategicObjectiveName" name="o<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveName" id="o<?php echo $strategic_objective_grid->RowIndex ?>_StrategicObjectiveName" value="<?php echo HtmlEncode($strategic_objective_grid->StrategicObjectiveName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($strategic_objective_grid->ReferencedDocs->Visible) { // ReferencedDocs ?>
		<td data-name="ReferencedDocs">
<?php if (!$strategic_objective->isConfirm()) { ?>
<span id="el$rowindex$_strategic_objective_ReferencedDocs" class="form-group strategic_objective_ReferencedDocs">
<textarea data-table="strategic_objective" data-field="x_ReferencedDocs" name="x<?php echo $strategic_objective_grid->RowIndex ?>_ReferencedDocs" id="x<?php echo $strategic_objective_grid->RowIndex ?>_ReferencedDocs" cols="50" rows="2" placeholder="<?php echo HtmlEncode($strategic_objective_grid->ReferencedDocs->getPlaceHolder()) ?>"<?php echo $strategic_objective_grid->ReferencedDocs->editAttributes() ?>><?php echo $strategic_objective_grid->ReferencedDocs->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_strategic_objective_ReferencedDocs" class="form-group strategic_objective_ReferencedDocs">
<span<?php echo $strategic_objective_grid->ReferencedDocs->viewAttributes() ?>><?php echo $strategic_objective_grid->ReferencedDocs->ViewValue ?></span>
</span>
<input type="hidden" data-table="strategic_objective" data-field="x_ReferencedDocs" name="x<?php echo $strategic_objective_grid->RowIndex ?>_ReferencedDocs" id="x<?php echo $strategic_objective_grid->RowIndex ?>_ReferencedDocs" value="<?php echo HtmlEncode($strategic_objective_grid->ReferencedDocs->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="strategic_objective" data-field="x_ReferencedDocs" name="o<?php echo $strategic_objective_grid->RowIndex ?>_ReferencedDocs" id="o<?php echo $strategic_objective_grid->RowIndex ?>_ReferencedDocs" value="<?php echo HtmlEncode($strategic_objective_grid->ReferencedDocs->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($strategic_objective_grid->ResultAreaCode->Visible) { // ResultAreaCode ?>
		<td data-name="ResultAreaCode">
<?php if (!$strategic_objective->isConfirm()) { ?>
<span id="el$rowindex$_strategic_objective_ResultAreaCode" class="form-group strategic_objective_ResultAreaCode">
<input type="text" data-table="strategic_objective" data-field="x_ResultAreaCode" name="x<?php echo $strategic_objective_grid->RowIndex ?>_ResultAreaCode" id="x<?php echo $strategic_objective_grid->RowIndex ?>_ResultAreaCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($strategic_objective_grid->ResultAreaCode->getPlaceHolder()) ?>" value="<?php echo $strategic_objective_grid->ResultAreaCode->EditValue ?>"<?php echo $strategic_objective_grid->ResultAreaCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_strategic_objective_ResultAreaCode" class="form-group strategic_objective_ResultAreaCode">
<span<?php echo $strategic_objective_grid->ResultAreaCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($strategic_objective_grid->ResultAreaCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="strategic_objective" data-field="x_ResultAreaCode" name="x<?php echo $strategic_objective_grid->RowIndex ?>_ResultAreaCode" id="x<?php echo $strategic_objective_grid->RowIndex ?>_ResultAreaCode" value="<?php echo HtmlEncode($strategic_objective_grid->ResultAreaCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="strategic_objective" data-field="x_ResultAreaCode" name="o<?php echo $strategic_objective_grid->RowIndex ?>_ResultAreaCode" id="o<?php echo $strategic_objective_grid->RowIndex ?>_ResultAreaCode" value="<?php echo HtmlEncode($strategic_objective_grid->ResultAreaCode->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$strategic_objective_grid->ListOptions->render("body", "right", $strategic_objective_grid->RowIndex);
?>
<script>
loadjs.ready(["fstrategic_objectivegrid", "load"], function() {
	fstrategic_objectivegrid.updateLists(<?php echo $strategic_objective_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($strategic_objective->CurrentMode == "add" || $strategic_objective->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $strategic_objective_grid->FormKeyCountName ?>" id="<?php echo $strategic_objective_grid->FormKeyCountName ?>" value="<?php echo $strategic_objective_grid->KeyCount ?>">
<?php echo $strategic_objective_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($strategic_objective->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $strategic_objective_grid->FormKeyCountName ?>" id="<?php echo $strategic_objective_grid->FormKeyCountName ?>" value="<?php echo $strategic_objective_grid->KeyCount ?>">
<?php echo $strategic_objective_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($strategic_objective->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fstrategic_objectivegrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($strategic_objective_grid->Recordset)
	$strategic_objective_grid->Recordset->Close();
?>
<?php if ($strategic_objective_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $strategic_objective_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($strategic_objective_grid->TotalRecords == 0 && !$strategic_objective->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $strategic_objective_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$strategic_objective_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$strategic_objective_grid->terminate();
?>