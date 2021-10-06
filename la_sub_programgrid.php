<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($la_sub_program_grid))
	$la_sub_program_grid = new la_sub_program_grid();

// Run the page
$la_sub_program_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$la_sub_program_grid->Page_Render();
?>
<?php if (!$la_sub_program_grid->isExport()) { ?>
<script>
var fla_sub_programgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fla_sub_programgrid = new ew.Form("fla_sub_programgrid", "grid");
	fla_sub_programgrid.formKeyCountName = '<?php echo $la_sub_program_grid->FormKeyCountName ?>';

	// Validate form
	fla_sub_programgrid.validate = function() {
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
			<?php if ($la_sub_program_grid->ProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_sub_program_grid->ProgramCode->caption(), $la_sub_program_grid->ProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($la_sub_program_grid->ProgramCode->errorMessage()) ?>");
			<?php if ($la_sub_program_grid->SubProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SubProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_sub_program_grid->SubProgramCode->caption(), $la_sub_program_grid->SubProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($la_sub_program_grid->SubProgramName->Required) { ?>
				elm = this.getElements("x" + infix + "_SubProgramName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_sub_program_grid->SubProgramName->caption(), $la_sub_program_grid->SubProgramName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($la_sub_program_grid->SubProgramPurpose->Required) { ?>
				elm = this.getElements("x" + infix + "_SubProgramPurpose");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_sub_program_grid->SubProgramPurpose->caption(), $la_sub_program_grid->SubProgramPurpose->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fla_sub_programgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ProgramCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SubProgramName", false)) return false;
		if (ew.valueChanged(fobj, infix, "SubProgramPurpose", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fla_sub_programgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fla_sub_programgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fla_sub_programgrid.lists["x_ProgramCode"] = <?php echo $la_sub_program_grid->ProgramCode->Lookup->toClientList($la_sub_program_grid) ?>;
	fla_sub_programgrid.lists["x_ProgramCode"].options = <?php echo JsonEncode($la_sub_program_grid->ProgramCode->lookupOptions()) ?>;
	fla_sub_programgrid.autoSuggests["x_ProgramCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fla_sub_programgrid");
});
</script>
<?php } ?>
<?php
$la_sub_program_grid->renderOtherOptions();
?>
<?php if ($la_sub_program_grid->TotalRecords > 0 || $la_sub_program->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($la_sub_program_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> la_sub_program">
<?php if ($la_sub_program_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $la_sub_program_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fla_sub_programgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_la_sub_program" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_la_sub_programgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$la_sub_program->RowType = ROWTYPE_HEADER;

// Render list options
$la_sub_program_grid->renderListOptions();

// Render list options (header, left)
$la_sub_program_grid->ListOptions->render("header", "left");
?>
<?php if ($la_sub_program_grid->ProgramCode->Visible) { // ProgramCode ?>
	<?php if ($la_sub_program_grid->SortUrl($la_sub_program_grid->ProgramCode) == "") { ?>
		<th data-name="ProgramCode" class="<?php echo $la_sub_program_grid->ProgramCode->headerCellClass() ?>"><div id="elh_la_sub_program_ProgramCode" class="la_sub_program_ProgramCode"><div class="ew-table-header-caption"><?php echo $la_sub_program_grid->ProgramCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgramCode" class="<?php echo $la_sub_program_grid->ProgramCode->headerCellClass() ?>"><div><div id="elh_la_sub_program_ProgramCode" class="la_sub_program_ProgramCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_sub_program_grid->ProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($la_sub_program_grid->ProgramCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_sub_program_grid->ProgramCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($la_sub_program_grid->SubProgramCode->Visible) { // SubProgramCode ?>
	<?php if ($la_sub_program_grid->SortUrl($la_sub_program_grid->SubProgramCode) == "") { ?>
		<th data-name="SubProgramCode" class="<?php echo $la_sub_program_grid->SubProgramCode->headerCellClass() ?>"><div id="elh_la_sub_program_SubProgramCode" class="la_sub_program_SubProgramCode"><div class="ew-table-header-caption"><?php echo $la_sub_program_grid->SubProgramCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubProgramCode" class="<?php echo $la_sub_program_grid->SubProgramCode->headerCellClass() ?>"><div><div id="elh_la_sub_program_SubProgramCode" class="la_sub_program_SubProgramCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_sub_program_grid->SubProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($la_sub_program_grid->SubProgramCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_sub_program_grid->SubProgramCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($la_sub_program_grid->SubProgramName->Visible) { // SubProgramName ?>
	<?php if ($la_sub_program_grid->SortUrl($la_sub_program_grid->SubProgramName) == "") { ?>
		<th data-name="SubProgramName" class="<?php echo $la_sub_program_grid->SubProgramName->headerCellClass() ?>"><div id="elh_la_sub_program_SubProgramName" class="la_sub_program_SubProgramName"><div class="ew-table-header-caption"><?php echo $la_sub_program_grid->SubProgramName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubProgramName" class="<?php echo $la_sub_program_grid->SubProgramName->headerCellClass() ?>"><div><div id="elh_la_sub_program_SubProgramName" class="la_sub_program_SubProgramName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_sub_program_grid->SubProgramName->caption() ?></span><span class="ew-table-header-sort"><?php if ($la_sub_program_grid->SubProgramName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_sub_program_grid->SubProgramName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($la_sub_program_grid->SubProgramPurpose->Visible) { // SubProgramPurpose ?>
	<?php if ($la_sub_program_grid->SortUrl($la_sub_program_grid->SubProgramPurpose) == "") { ?>
		<th data-name="SubProgramPurpose" class="<?php echo $la_sub_program_grid->SubProgramPurpose->headerCellClass() ?>"><div id="elh_la_sub_program_SubProgramPurpose" class="la_sub_program_SubProgramPurpose"><div class="ew-table-header-caption"><?php echo $la_sub_program_grid->SubProgramPurpose->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubProgramPurpose" class="<?php echo $la_sub_program_grid->SubProgramPurpose->headerCellClass() ?>"><div><div id="elh_la_sub_program_SubProgramPurpose" class="la_sub_program_SubProgramPurpose">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_sub_program_grid->SubProgramPurpose->caption() ?></span><span class="ew-table-header-sort"><?php if ($la_sub_program_grid->SubProgramPurpose->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_sub_program_grid->SubProgramPurpose->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$la_sub_program_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$la_sub_program_grid->StartRecord = 1;
$la_sub_program_grid->StopRecord = $la_sub_program_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($la_sub_program->isConfirm() || $la_sub_program_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($la_sub_program_grid->FormKeyCountName) && ($la_sub_program_grid->isGridAdd() || $la_sub_program_grid->isGridEdit() || $la_sub_program->isConfirm())) {
		$la_sub_program_grid->KeyCount = $CurrentForm->getValue($la_sub_program_grid->FormKeyCountName);
		$la_sub_program_grid->StopRecord = $la_sub_program_grid->StartRecord + $la_sub_program_grid->KeyCount - 1;
	}
}
$la_sub_program_grid->RecordCount = $la_sub_program_grid->StartRecord - 1;
if ($la_sub_program_grid->Recordset && !$la_sub_program_grid->Recordset->EOF) {
	$la_sub_program_grid->Recordset->moveFirst();
	$selectLimit = $la_sub_program_grid->UseSelectLimit;
	if (!$selectLimit && $la_sub_program_grid->StartRecord > 1)
		$la_sub_program_grid->Recordset->move($la_sub_program_grid->StartRecord - 1);
} elseif (!$la_sub_program->AllowAddDeleteRow && $la_sub_program_grid->StopRecord == 0) {
	$la_sub_program_grid->StopRecord = $la_sub_program->GridAddRowCount;
}

// Initialize aggregate
$la_sub_program->RowType = ROWTYPE_AGGREGATEINIT;
$la_sub_program->resetAttributes();
$la_sub_program_grid->renderRow();
if ($la_sub_program_grid->isGridAdd())
	$la_sub_program_grid->RowIndex = 0;
if ($la_sub_program_grid->isGridEdit())
	$la_sub_program_grid->RowIndex = 0;
while ($la_sub_program_grid->RecordCount < $la_sub_program_grid->StopRecord) {
	$la_sub_program_grid->RecordCount++;
	if ($la_sub_program_grid->RecordCount >= $la_sub_program_grid->StartRecord) {
		$la_sub_program_grid->RowCount++;
		if ($la_sub_program_grid->isGridAdd() || $la_sub_program_grid->isGridEdit() || $la_sub_program->isConfirm()) {
			$la_sub_program_grid->RowIndex++;
			$CurrentForm->Index = $la_sub_program_grid->RowIndex;
			if ($CurrentForm->hasValue($la_sub_program_grid->FormActionName) && ($la_sub_program->isConfirm() || $la_sub_program_grid->EventCancelled))
				$la_sub_program_grid->RowAction = strval($CurrentForm->getValue($la_sub_program_grid->FormActionName));
			elseif ($la_sub_program_grid->isGridAdd())
				$la_sub_program_grid->RowAction = "insert";
			else
				$la_sub_program_grid->RowAction = "";
		}

		// Set up key count
		$la_sub_program_grid->KeyCount = $la_sub_program_grid->RowIndex;

		// Init row class and style
		$la_sub_program->resetAttributes();
		$la_sub_program->CssClass = "";
		if ($la_sub_program_grid->isGridAdd()) {
			if ($la_sub_program->CurrentMode == "copy") {
				$la_sub_program_grid->loadRowValues($la_sub_program_grid->Recordset); // Load row values
				$la_sub_program_grid->setRecordKey($la_sub_program_grid->RowOldKey, $la_sub_program_grid->Recordset); // Set old record key
			} else {
				$la_sub_program_grid->loadRowValues(); // Load default values
				$la_sub_program_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$la_sub_program_grid->loadRowValues($la_sub_program_grid->Recordset); // Load row values
		}
		$la_sub_program->RowType = ROWTYPE_VIEW; // Render view
		if ($la_sub_program_grid->isGridAdd()) // Grid add
			$la_sub_program->RowType = ROWTYPE_ADD; // Render add
		if ($la_sub_program_grid->isGridAdd() && $la_sub_program->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$la_sub_program_grid->restoreCurrentRowFormValues($la_sub_program_grid->RowIndex); // Restore form values
		if ($la_sub_program_grid->isGridEdit()) { // Grid edit
			if ($la_sub_program->EventCancelled)
				$la_sub_program_grid->restoreCurrentRowFormValues($la_sub_program_grid->RowIndex); // Restore form values
			if ($la_sub_program_grid->RowAction == "insert")
				$la_sub_program->RowType = ROWTYPE_ADD; // Render add
			else
				$la_sub_program->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($la_sub_program_grid->isGridEdit() && ($la_sub_program->RowType == ROWTYPE_EDIT || $la_sub_program->RowType == ROWTYPE_ADD) && $la_sub_program->EventCancelled) // Update failed
			$la_sub_program_grid->restoreCurrentRowFormValues($la_sub_program_grid->RowIndex); // Restore form values
		if ($la_sub_program->RowType == ROWTYPE_EDIT) // Edit row
			$la_sub_program_grid->EditRowCount++;
		if ($la_sub_program->isConfirm()) // Confirm row
			$la_sub_program_grid->restoreCurrentRowFormValues($la_sub_program_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$la_sub_program->RowAttrs->merge(["data-rowindex" => $la_sub_program_grid->RowCount, "id" => "r" . $la_sub_program_grid->RowCount . "_la_sub_program", "data-rowtype" => $la_sub_program->RowType]);

		// Render row
		$la_sub_program_grid->renderRow();

		// Render list options
		$la_sub_program_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($la_sub_program_grid->RowAction != "delete" && $la_sub_program_grid->RowAction != "insertdelete" && !($la_sub_program_grid->RowAction == "insert" && $la_sub_program->isConfirm() && $la_sub_program_grid->emptyRow())) {
?>
	<tr <?php echo $la_sub_program->rowAttributes() ?>>
<?php

// Render list options (body, left)
$la_sub_program_grid->ListOptions->render("body", "left", $la_sub_program_grid->RowCount);
?>
	<?php if ($la_sub_program_grid->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode" <?php echo $la_sub_program_grid->ProgramCode->cellAttributes() ?>>
<?php if ($la_sub_program->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($la_sub_program_grid->ProgramCode->getSessionValue() != "") { ?>
<span id="el<?php echo $la_sub_program_grid->RowCount ?>_la_sub_program_ProgramCode" class="form-group">
<span<?php echo $la_sub_program_grid->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($la_sub_program_grid->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" name="x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($la_sub_program_grid->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $la_sub_program_grid->RowCount ?>_la_sub_program_ProgramCode" class="form-group">
<?php
$onchange = $la_sub_program_grid->ProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$la_sub_program_grid->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" id="sv_x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" value="<?php echo RemoveHtml($la_sub_program_grid->ProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($la_sub_program_grid->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($la_sub_program_grid->ProgramCode->getPlaceHolder()) ?>"<?php echo $la_sub_program_grid->ProgramCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($la_sub_program_grid->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($la_sub_program_grid->ProgramCode->ReadOnly || $la_sub_program_grid->ProgramCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="la_sub_program" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $la_sub_program_grid->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" id="x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($la_sub_program_grid->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fla_sub_programgrid"], function() {
	fla_sub_programgrid.createAutoSuggest({"id":"x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode","forceSelect":true});
});
</script>
<?php echo $la_sub_program_grid->ProgramCode->Lookup->getParamTag($la_sub_program_grid, "p_x" . $la_sub_program_grid->RowIndex . "_ProgramCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="la_sub_program" data-field="x_ProgramCode" name="o<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" id="o<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($la_sub_program_grid->ProgramCode->OldValue) ?>">
<?php } ?>
<?php if ($la_sub_program->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($la_sub_program_grid->ProgramCode->getSessionValue() != "") { ?>
<span id="el<?php echo $la_sub_program_grid->RowCount ?>_la_sub_program_ProgramCode" class="form-group">
<span<?php echo $la_sub_program_grid->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($la_sub_program_grid->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" name="x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($la_sub_program_grid->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $la_sub_program_grid->RowCount ?>_la_sub_program_ProgramCode" class="form-group">
<?php
$onchange = $la_sub_program_grid->ProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$la_sub_program_grid->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" id="sv_x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" value="<?php echo RemoveHtml($la_sub_program_grid->ProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($la_sub_program_grid->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($la_sub_program_grid->ProgramCode->getPlaceHolder()) ?>"<?php echo $la_sub_program_grid->ProgramCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($la_sub_program_grid->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($la_sub_program_grid->ProgramCode->ReadOnly || $la_sub_program_grid->ProgramCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="la_sub_program" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $la_sub_program_grid->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" id="x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($la_sub_program_grid->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fla_sub_programgrid"], function() {
	fla_sub_programgrid.createAutoSuggest({"id":"x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode","forceSelect":true});
});
</script>
<?php echo $la_sub_program_grid->ProgramCode->Lookup->getParamTag($la_sub_program_grid, "p_x" . $la_sub_program_grid->RowIndex . "_ProgramCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($la_sub_program->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $la_sub_program_grid->RowCount ?>_la_sub_program_ProgramCode">
<span<?php echo $la_sub_program_grid->ProgramCode->viewAttributes() ?>><?php echo $la_sub_program_grid->ProgramCode->getViewValue() ?></span>
</span>
<?php if (!$la_sub_program->isConfirm()) { ?>
<input type="hidden" data-table="la_sub_program" data-field="x_ProgramCode" name="x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" id="x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($la_sub_program_grid->ProgramCode->FormValue) ?>">
<input type="hidden" data-table="la_sub_program" data-field="x_ProgramCode" name="o<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" id="o<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($la_sub_program_grid->ProgramCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="la_sub_program" data-field="x_ProgramCode" name="fla_sub_programgrid$x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" id="fla_sub_programgrid$x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($la_sub_program_grid->ProgramCode->FormValue) ?>">
<input type="hidden" data-table="la_sub_program" data-field="x_ProgramCode" name="fla_sub_programgrid$o<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" id="fla_sub_programgrid$o<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($la_sub_program_grid->ProgramCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($la_sub_program_grid->SubProgramCode->Visible) { // SubProgramCode ?>
		<td data-name="SubProgramCode" <?php echo $la_sub_program_grid->SubProgramCode->cellAttributes() ?>>
<?php if ($la_sub_program->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $la_sub_program_grid->RowCount ?>_la_sub_program_SubProgramCode" class="form-group"></span>
<input type="hidden" data-table="la_sub_program" data-field="x_SubProgramCode" name="o<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramCode" id="o<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($la_sub_program_grid->SubProgramCode->OldValue) ?>">
<?php } ?>
<?php if ($la_sub_program->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $la_sub_program_grid->RowCount ?>_la_sub_program_SubProgramCode" class="form-group">
<span<?php echo $la_sub_program_grid->SubProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($la_sub_program_grid->SubProgramCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="la_sub_program" data-field="x_SubProgramCode" name="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramCode" id="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($la_sub_program_grid->SubProgramCode->CurrentValue) ?>">
<?php } ?>
<?php if ($la_sub_program->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $la_sub_program_grid->RowCount ?>_la_sub_program_SubProgramCode">
<span<?php echo $la_sub_program_grid->SubProgramCode->viewAttributes() ?>><?php echo $la_sub_program_grid->SubProgramCode->getViewValue() ?></span>
</span>
<?php if (!$la_sub_program->isConfirm()) { ?>
<input type="hidden" data-table="la_sub_program" data-field="x_SubProgramCode" name="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramCode" id="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($la_sub_program_grid->SubProgramCode->FormValue) ?>">
<input type="hidden" data-table="la_sub_program" data-field="x_SubProgramCode" name="o<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramCode" id="o<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($la_sub_program_grid->SubProgramCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="la_sub_program" data-field="x_SubProgramCode" name="fla_sub_programgrid$x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramCode" id="fla_sub_programgrid$x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($la_sub_program_grid->SubProgramCode->FormValue) ?>">
<input type="hidden" data-table="la_sub_program" data-field="x_SubProgramCode" name="fla_sub_programgrid$o<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramCode" id="fla_sub_programgrid$o<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($la_sub_program_grid->SubProgramCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($la_sub_program_grid->SubProgramName->Visible) { // SubProgramName ?>
		<td data-name="SubProgramName" <?php echo $la_sub_program_grid->SubProgramName->cellAttributes() ?>>
<?php if ($la_sub_program->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $la_sub_program_grid->RowCount ?>_la_sub_program_SubProgramName" class="form-group">
<input type="text" data-table="la_sub_program" data-field="x_SubProgramName" name="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramName" id="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($la_sub_program_grid->SubProgramName->getPlaceHolder()) ?>" value="<?php echo $la_sub_program_grid->SubProgramName->EditValue ?>"<?php echo $la_sub_program_grid->SubProgramName->editAttributes() ?>>
</span>
<input type="hidden" data-table="la_sub_program" data-field="x_SubProgramName" name="o<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramName" id="o<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramName" value="<?php echo HtmlEncode($la_sub_program_grid->SubProgramName->OldValue) ?>">
<?php } ?>
<?php if ($la_sub_program->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $la_sub_program_grid->RowCount ?>_la_sub_program_SubProgramName" class="form-group">
<input type="text" data-table="la_sub_program" data-field="x_SubProgramName" name="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramName" id="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($la_sub_program_grid->SubProgramName->getPlaceHolder()) ?>" value="<?php echo $la_sub_program_grid->SubProgramName->EditValue ?>"<?php echo $la_sub_program_grid->SubProgramName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($la_sub_program->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $la_sub_program_grid->RowCount ?>_la_sub_program_SubProgramName">
<span<?php echo $la_sub_program_grid->SubProgramName->viewAttributes() ?>><?php echo $la_sub_program_grid->SubProgramName->getViewValue() ?></span>
</span>
<?php if (!$la_sub_program->isConfirm()) { ?>
<input type="hidden" data-table="la_sub_program" data-field="x_SubProgramName" name="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramName" id="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramName" value="<?php echo HtmlEncode($la_sub_program_grid->SubProgramName->FormValue) ?>">
<input type="hidden" data-table="la_sub_program" data-field="x_SubProgramName" name="o<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramName" id="o<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramName" value="<?php echo HtmlEncode($la_sub_program_grid->SubProgramName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="la_sub_program" data-field="x_SubProgramName" name="fla_sub_programgrid$x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramName" id="fla_sub_programgrid$x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramName" value="<?php echo HtmlEncode($la_sub_program_grid->SubProgramName->FormValue) ?>">
<input type="hidden" data-table="la_sub_program" data-field="x_SubProgramName" name="fla_sub_programgrid$o<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramName" id="fla_sub_programgrid$o<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramName" value="<?php echo HtmlEncode($la_sub_program_grid->SubProgramName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($la_sub_program_grid->SubProgramPurpose->Visible) { // SubProgramPurpose ?>
		<td data-name="SubProgramPurpose" <?php echo $la_sub_program_grid->SubProgramPurpose->cellAttributes() ?>>
<?php if ($la_sub_program->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $la_sub_program_grid->RowCount ?>_la_sub_program_SubProgramPurpose" class="form-group">
<textarea data-table="la_sub_program" data-field="x_SubProgramPurpose" name="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramPurpose" id="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramPurpose" cols="35" rows="4" placeholder="<?php echo HtmlEncode($la_sub_program_grid->SubProgramPurpose->getPlaceHolder()) ?>"<?php echo $la_sub_program_grid->SubProgramPurpose->editAttributes() ?>><?php echo $la_sub_program_grid->SubProgramPurpose->EditValue ?></textarea>
</span>
<input type="hidden" data-table="la_sub_program" data-field="x_SubProgramPurpose" name="o<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramPurpose" id="o<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramPurpose" value="<?php echo HtmlEncode($la_sub_program_grid->SubProgramPurpose->OldValue) ?>">
<?php } ?>
<?php if ($la_sub_program->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $la_sub_program_grid->RowCount ?>_la_sub_program_SubProgramPurpose" class="form-group">
<textarea data-table="la_sub_program" data-field="x_SubProgramPurpose" name="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramPurpose" id="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramPurpose" cols="35" rows="4" placeholder="<?php echo HtmlEncode($la_sub_program_grid->SubProgramPurpose->getPlaceHolder()) ?>"<?php echo $la_sub_program_grid->SubProgramPurpose->editAttributes() ?>><?php echo $la_sub_program_grid->SubProgramPurpose->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($la_sub_program->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $la_sub_program_grid->RowCount ?>_la_sub_program_SubProgramPurpose">
<span<?php echo $la_sub_program_grid->SubProgramPurpose->viewAttributes() ?>><?php echo $la_sub_program_grid->SubProgramPurpose->getViewValue() ?></span>
</span>
<?php if (!$la_sub_program->isConfirm()) { ?>
<input type="hidden" data-table="la_sub_program" data-field="x_SubProgramPurpose" name="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramPurpose" id="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramPurpose" value="<?php echo HtmlEncode($la_sub_program_grid->SubProgramPurpose->FormValue) ?>">
<input type="hidden" data-table="la_sub_program" data-field="x_SubProgramPurpose" name="o<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramPurpose" id="o<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramPurpose" value="<?php echo HtmlEncode($la_sub_program_grid->SubProgramPurpose->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="la_sub_program" data-field="x_SubProgramPurpose" name="fla_sub_programgrid$x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramPurpose" id="fla_sub_programgrid$x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramPurpose" value="<?php echo HtmlEncode($la_sub_program_grid->SubProgramPurpose->FormValue) ?>">
<input type="hidden" data-table="la_sub_program" data-field="x_SubProgramPurpose" name="fla_sub_programgrid$o<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramPurpose" id="fla_sub_programgrid$o<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramPurpose" value="<?php echo HtmlEncode($la_sub_program_grid->SubProgramPurpose->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$la_sub_program_grid->ListOptions->render("body", "right", $la_sub_program_grid->RowCount);
?>
	</tr>
<?php if ($la_sub_program->RowType == ROWTYPE_ADD || $la_sub_program->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fla_sub_programgrid", "load"], function() {
	fla_sub_programgrid.updateLists(<?php echo $la_sub_program_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$la_sub_program_grid->isGridAdd() || $la_sub_program->CurrentMode == "copy")
		if (!$la_sub_program_grid->Recordset->EOF)
			$la_sub_program_grid->Recordset->moveNext();
}
?>
<?php
	if ($la_sub_program->CurrentMode == "add" || $la_sub_program->CurrentMode == "copy" || $la_sub_program->CurrentMode == "edit") {
		$la_sub_program_grid->RowIndex = '$rowindex$';
		$la_sub_program_grid->loadRowValues();

		// Set row properties
		$la_sub_program->resetAttributes();
		$la_sub_program->RowAttrs->merge(["data-rowindex" => $la_sub_program_grid->RowIndex, "id" => "r0_la_sub_program", "data-rowtype" => ROWTYPE_ADD]);
		$la_sub_program->RowAttrs->appendClass("ew-template");
		$la_sub_program->RowType = ROWTYPE_ADD;

		// Render row
		$la_sub_program_grid->renderRow();

		// Render list options
		$la_sub_program_grid->renderListOptions();
		$la_sub_program_grid->StartRowCount = 0;
?>
	<tr <?php echo $la_sub_program->rowAttributes() ?>>
<?php

// Render list options (body, left)
$la_sub_program_grid->ListOptions->render("body", "left", $la_sub_program_grid->RowIndex);
?>
	<?php if ($la_sub_program_grid->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode">
<?php if (!$la_sub_program->isConfirm()) { ?>
<?php if ($la_sub_program_grid->ProgramCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_la_sub_program_ProgramCode" class="form-group la_sub_program_ProgramCode">
<span<?php echo $la_sub_program_grid->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($la_sub_program_grid->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" name="x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($la_sub_program_grid->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_la_sub_program_ProgramCode" class="form-group la_sub_program_ProgramCode">
<?php
$onchange = $la_sub_program_grid->ProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$la_sub_program_grid->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" id="sv_x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" value="<?php echo RemoveHtml($la_sub_program_grid->ProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($la_sub_program_grid->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($la_sub_program_grid->ProgramCode->getPlaceHolder()) ?>"<?php echo $la_sub_program_grid->ProgramCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($la_sub_program_grid->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($la_sub_program_grid->ProgramCode->ReadOnly || $la_sub_program_grid->ProgramCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="la_sub_program" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $la_sub_program_grid->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" id="x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($la_sub_program_grid->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fla_sub_programgrid"], function() {
	fla_sub_programgrid.createAutoSuggest({"id":"x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode","forceSelect":true});
});
</script>
<?php echo $la_sub_program_grid->ProgramCode->Lookup->getParamTag($la_sub_program_grid, "p_x" . $la_sub_program_grid->RowIndex . "_ProgramCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_la_sub_program_ProgramCode" class="form-group la_sub_program_ProgramCode">
<span<?php echo $la_sub_program_grid->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($la_sub_program_grid->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="la_sub_program" data-field="x_ProgramCode" name="x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" id="x<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($la_sub_program_grid->ProgramCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="la_sub_program" data-field="x_ProgramCode" name="o<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" id="o<?php echo $la_sub_program_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($la_sub_program_grid->ProgramCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($la_sub_program_grid->SubProgramCode->Visible) { // SubProgramCode ?>
		<td data-name="SubProgramCode">
<?php if (!$la_sub_program->isConfirm()) { ?>
<span id="el$rowindex$_la_sub_program_SubProgramCode" class="form-group la_sub_program_SubProgramCode"></span>
<?php } else { ?>
<span id="el$rowindex$_la_sub_program_SubProgramCode" class="form-group la_sub_program_SubProgramCode">
<span<?php echo $la_sub_program_grid->SubProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($la_sub_program_grid->SubProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="la_sub_program" data-field="x_SubProgramCode" name="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramCode" id="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($la_sub_program_grid->SubProgramCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="la_sub_program" data-field="x_SubProgramCode" name="o<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramCode" id="o<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($la_sub_program_grid->SubProgramCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($la_sub_program_grid->SubProgramName->Visible) { // SubProgramName ?>
		<td data-name="SubProgramName">
<?php if (!$la_sub_program->isConfirm()) { ?>
<span id="el$rowindex$_la_sub_program_SubProgramName" class="form-group la_sub_program_SubProgramName">
<input type="text" data-table="la_sub_program" data-field="x_SubProgramName" name="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramName" id="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($la_sub_program_grid->SubProgramName->getPlaceHolder()) ?>" value="<?php echo $la_sub_program_grid->SubProgramName->EditValue ?>"<?php echo $la_sub_program_grid->SubProgramName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_la_sub_program_SubProgramName" class="form-group la_sub_program_SubProgramName">
<span<?php echo $la_sub_program_grid->SubProgramName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($la_sub_program_grid->SubProgramName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="la_sub_program" data-field="x_SubProgramName" name="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramName" id="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramName" value="<?php echo HtmlEncode($la_sub_program_grid->SubProgramName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="la_sub_program" data-field="x_SubProgramName" name="o<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramName" id="o<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramName" value="<?php echo HtmlEncode($la_sub_program_grid->SubProgramName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($la_sub_program_grid->SubProgramPurpose->Visible) { // SubProgramPurpose ?>
		<td data-name="SubProgramPurpose">
<?php if (!$la_sub_program->isConfirm()) { ?>
<span id="el$rowindex$_la_sub_program_SubProgramPurpose" class="form-group la_sub_program_SubProgramPurpose">
<textarea data-table="la_sub_program" data-field="x_SubProgramPurpose" name="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramPurpose" id="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramPurpose" cols="35" rows="4" placeholder="<?php echo HtmlEncode($la_sub_program_grid->SubProgramPurpose->getPlaceHolder()) ?>"<?php echo $la_sub_program_grid->SubProgramPurpose->editAttributes() ?>><?php echo $la_sub_program_grid->SubProgramPurpose->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_la_sub_program_SubProgramPurpose" class="form-group la_sub_program_SubProgramPurpose">
<span<?php echo $la_sub_program_grid->SubProgramPurpose->viewAttributes() ?>><?php echo $la_sub_program_grid->SubProgramPurpose->ViewValue ?></span>
</span>
<input type="hidden" data-table="la_sub_program" data-field="x_SubProgramPurpose" name="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramPurpose" id="x<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramPurpose" value="<?php echo HtmlEncode($la_sub_program_grid->SubProgramPurpose->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="la_sub_program" data-field="x_SubProgramPurpose" name="o<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramPurpose" id="o<?php echo $la_sub_program_grid->RowIndex ?>_SubProgramPurpose" value="<?php echo HtmlEncode($la_sub_program_grid->SubProgramPurpose->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$la_sub_program_grid->ListOptions->render("body", "right", $la_sub_program_grid->RowIndex);
?>
<script>
loadjs.ready(["fla_sub_programgrid", "load"], function() {
	fla_sub_programgrid.updateLists(<?php echo $la_sub_program_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($la_sub_program->CurrentMode == "add" || $la_sub_program->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $la_sub_program_grid->FormKeyCountName ?>" id="<?php echo $la_sub_program_grid->FormKeyCountName ?>" value="<?php echo $la_sub_program_grid->KeyCount ?>">
<?php echo $la_sub_program_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($la_sub_program->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $la_sub_program_grid->FormKeyCountName ?>" id="<?php echo $la_sub_program_grid->FormKeyCountName ?>" value="<?php echo $la_sub_program_grid->KeyCount ?>">
<?php echo $la_sub_program_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($la_sub_program->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fla_sub_programgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($la_sub_program_grid->Recordset)
	$la_sub_program_grid->Recordset->Close();
?>
<?php if ($la_sub_program_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $la_sub_program_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($la_sub_program_grid->TotalRecords == 0 && !$la_sub_program->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $la_sub_program_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$la_sub_program_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$la_sub_program_grid->terminate();
?>