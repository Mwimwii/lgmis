<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($staffqualifications_academic_grid))
	$staffqualifications_academic_grid = new staffqualifications_academic_grid();

// Run the page
$staffqualifications_academic_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffqualifications_academic_grid->Page_Render();
?>
<?php if (!$staffqualifications_academic_grid->isExport()) { ?>
<script>
var fstaffqualifications_academicgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fstaffqualifications_academicgrid = new ew.Form("fstaffqualifications_academicgrid", "grid");
	fstaffqualifications_academicgrid.formKeyCountName = '<?php echo $staffqualifications_academic_grid->FormKeyCountName ?>';

	// Validate form
	fstaffqualifications_academicgrid.validate = function() {
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
			<?php if ($staffqualifications_academic_grid->QualificationLevel->Required) { ?>
				elm = this.getElements("x" + infix + "_QualificationLevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_academic_grid->QualificationLevel->caption(), $staffqualifications_academic_grid->QualificationLevel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffqualifications_academic_grid->QualificationRemarks->Required) { ?>
				elm = this.getElements("x" + infix + "_QualificationRemarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_academic_grid->QualificationRemarks->caption(), $staffqualifications_academic_grid->QualificationRemarks->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffqualifications_academic_grid->AwardingInstitution->Required) { ?>
				elm = this.getElements("x" + infix + "_AwardingInstitution");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_academic_grid->AwardingInstitution->caption(), $staffqualifications_academic_grid->AwardingInstitution->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffqualifications_academic_grid->FromYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FromYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_academic_grid->FromYear->caption(), $staffqualifications_academic_grid->FromYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FromYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffqualifications_academic_grid->FromYear->errorMessage()) ?>");
			<?php if ($staffqualifications_academic_grid->YearObtained->Required) { ?>
				elm = this.getElements("x" + infix + "_YearObtained");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_academic_grid->YearObtained->caption(), $staffqualifications_academic_grid->YearObtained->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_YearObtained");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffqualifications_academic_grid->YearObtained->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fstaffqualifications_academicgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "QualificationLevel", false)) return false;
		if (ew.valueChanged(fobj, infix, "QualificationRemarks", false)) return false;
		if (ew.valueChanged(fobj, infix, "AwardingInstitution", false)) return false;
		if (ew.valueChanged(fobj, infix, "FromYear", false)) return false;
		if (ew.valueChanged(fobj, infix, "YearObtained", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fstaffqualifications_academicgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffqualifications_academicgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffqualifications_academicgrid.lists["x_QualificationLevel"] = <?php echo $staffqualifications_academic_grid->QualificationLevel->Lookup->toClientList($staffqualifications_academic_grid) ?>;
	fstaffqualifications_academicgrid.lists["x_QualificationLevel"].options = <?php echo JsonEncode($staffqualifications_academic_grid->QualificationLevel->lookupOptions()) ?>;
	loadjs.done("fstaffqualifications_academicgrid");
});
</script>
<?php } ?>
<?php
$staffqualifications_academic_grid->renderOtherOptions();
?>
<?php if ($staffqualifications_academic_grid->TotalRecords > 0 || $staffqualifications_academic->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($staffqualifications_academic_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> staffqualifications_academic">
<?php if ($staffqualifications_academic_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $staffqualifications_academic_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fstaffqualifications_academicgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_staffqualifications_academic" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_staffqualifications_academicgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$staffqualifications_academic->RowType = ROWTYPE_HEADER;

// Render list options
$staffqualifications_academic_grid->renderListOptions();

// Render list options (header, left)
$staffqualifications_academic_grid->ListOptions->render("header", "left");
?>
<?php if ($staffqualifications_academic_grid->QualificationLevel->Visible) { // QualificationLevel ?>
	<?php if ($staffqualifications_academic_grid->SortUrl($staffqualifications_academic_grid->QualificationLevel) == "") { ?>
		<th data-name="QualificationLevel" class="<?php echo $staffqualifications_academic_grid->QualificationLevel->headerCellClass() ?>"><div id="elh_staffqualifications_academic_QualificationLevel" class="staffqualifications_academic_QualificationLevel"><div class="ew-table-header-caption"><?php echo $staffqualifications_academic_grid->QualificationLevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="QualificationLevel" class="<?php echo $staffqualifications_academic_grid->QualificationLevel->headerCellClass() ?>"><div><div id="elh_staffqualifications_academic_QualificationLevel" class="staffqualifications_academic_QualificationLevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffqualifications_academic_grid->QualificationLevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffqualifications_academic_grid->QualificationLevel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffqualifications_academic_grid->QualificationLevel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffqualifications_academic_grid->QualificationRemarks->Visible) { // QualificationRemarks ?>
	<?php if ($staffqualifications_academic_grid->SortUrl($staffqualifications_academic_grid->QualificationRemarks) == "") { ?>
		<th data-name="QualificationRemarks" class="<?php echo $staffqualifications_academic_grid->QualificationRemarks->headerCellClass() ?>"><div id="elh_staffqualifications_academic_QualificationRemarks" class="staffqualifications_academic_QualificationRemarks"><div class="ew-table-header-caption"><?php echo $staffqualifications_academic_grid->QualificationRemarks->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="QualificationRemarks" class="<?php echo $staffqualifications_academic_grid->QualificationRemarks->headerCellClass() ?>"><div><div id="elh_staffqualifications_academic_QualificationRemarks" class="staffqualifications_academic_QualificationRemarks">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffqualifications_academic_grid->QualificationRemarks->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffqualifications_academic_grid->QualificationRemarks->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffqualifications_academic_grid->QualificationRemarks->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffqualifications_academic_grid->AwardingInstitution->Visible) { // AwardingInstitution ?>
	<?php if ($staffqualifications_academic_grid->SortUrl($staffqualifications_academic_grid->AwardingInstitution) == "") { ?>
		<th data-name="AwardingInstitution" class="<?php echo $staffqualifications_academic_grid->AwardingInstitution->headerCellClass() ?>"><div id="elh_staffqualifications_academic_AwardingInstitution" class="staffqualifications_academic_AwardingInstitution"><div class="ew-table-header-caption"><?php echo $staffqualifications_academic_grid->AwardingInstitution->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AwardingInstitution" class="<?php echo $staffqualifications_academic_grid->AwardingInstitution->headerCellClass() ?>"><div><div id="elh_staffqualifications_academic_AwardingInstitution" class="staffqualifications_academic_AwardingInstitution">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffqualifications_academic_grid->AwardingInstitution->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffqualifications_academic_grid->AwardingInstitution->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffqualifications_academic_grid->AwardingInstitution->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffqualifications_academic_grid->FromYear->Visible) { // FromYear ?>
	<?php if ($staffqualifications_academic_grid->SortUrl($staffqualifications_academic_grid->FromYear) == "") { ?>
		<th data-name="FromYear" class="<?php echo $staffqualifications_academic_grid->FromYear->headerCellClass() ?>"><div id="elh_staffqualifications_academic_FromYear" class="staffqualifications_academic_FromYear"><div class="ew-table-header-caption"><?php echo $staffqualifications_academic_grid->FromYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FromYear" class="<?php echo $staffqualifications_academic_grid->FromYear->headerCellClass() ?>"><div><div id="elh_staffqualifications_academic_FromYear" class="staffqualifications_academic_FromYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffqualifications_academic_grid->FromYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffqualifications_academic_grid->FromYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffqualifications_academic_grid->FromYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffqualifications_academic_grid->YearObtained->Visible) { // YearObtained ?>
	<?php if ($staffqualifications_academic_grid->SortUrl($staffqualifications_academic_grid->YearObtained) == "") { ?>
		<th data-name="YearObtained" class="<?php echo $staffqualifications_academic_grid->YearObtained->headerCellClass() ?>"><div id="elh_staffqualifications_academic_YearObtained" class="staffqualifications_academic_YearObtained"><div class="ew-table-header-caption"><?php echo $staffqualifications_academic_grid->YearObtained->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="YearObtained" class="<?php echo $staffqualifications_academic_grid->YearObtained->headerCellClass() ?>"><div><div id="elh_staffqualifications_academic_YearObtained" class="staffqualifications_academic_YearObtained">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffqualifications_academic_grid->YearObtained->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffqualifications_academic_grid->YearObtained->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffqualifications_academic_grid->YearObtained->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$staffqualifications_academic_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$staffqualifications_academic_grid->StartRecord = 1;
$staffqualifications_academic_grid->StopRecord = $staffqualifications_academic_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($staffqualifications_academic->isConfirm() || $staffqualifications_academic_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($staffqualifications_academic_grid->FormKeyCountName) && ($staffqualifications_academic_grid->isGridAdd() || $staffqualifications_academic_grid->isGridEdit() || $staffqualifications_academic->isConfirm())) {
		$staffqualifications_academic_grid->KeyCount = $CurrentForm->getValue($staffqualifications_academic_grid->FormKeyCountName);
		$staffqualifications_academic_grid->StopRecord = $staffqualifications_academic_grid->StartRecord + $staffqualifications_academic_grid->KeyCount - 1;
	}
}
$staffqualifications_academic_grid->RecordCount = $staffqualifications_academic_grid->StartRecord - 1;
if ($staffqualifications_academic_grid->Recordset && !$staffqualifications_academic_grid->Recordset->EOF) {
	$staffqualifications_academic_grid->Recordset->moveFirst();
	$selectLimit = $staffqualifications_academic_grid->UseSelectLimit;
	if (!$selectLimit && $staffqualifications_academic_grid->StartRecord > 1)
		$staffqualifications_academic_grid->Recordset->move($staffqualifications_academic_grid->StartRecord - 1);
} elseif (!$staffqualifications_academic->AllowAddDeleteRow && $staffqualifications_academic_grid->StopRecord == 0) {
	$staffqualifications_academic_grid->StopRecord = $staffqualifications_academic->GridAddRowCount;
}

// Initialize aggregate
$staffqualifications_academic->RowType = ROWTYPE_AGGREGATEINIT;
$staffqualifications_academic->resetAttributes();
$staffqualifications_academic_grid->renderRow();
if ($staffqualifications_academic_grid->isGridAdd())
	$staffqualifications_academic_grid->RowIndex = 0;
if ($staffqualifications_academic_grid->isGridEdit())
	$staffqualifications_academic_grid->RowIndex = 0;
while ($staffqualifications_academic_grid->RecordCount < $staffqualifications_academic_grid->StopRecord) {
	$staffqualifications_academic_grid->RecordCount++;
	if ($staffqualifications_academic_grid->RecordCount >= $staffqualifications_academic_grid->StartRecord) {
		$staffqualifications_academic_grid->RowCount++;
		if ($staffqualifications_academic_grid->isGridAdd() || $staffqualifications_academic_grid->isGridEdit() || $staffqualifications_academic->isConfirm()) {
			$staffqualifications_academic_grid->RowIndex++;
			$CurrentForm->Index = $staffqualifications_academic_grid->RowIndex;
			if ($CurrentForm->hasValue($staffqualifications_academic_grid->FormActionName) && ($staffqualifications_academic->isConfirm() || $staffqualifications_academic_grid->EventCancelled))
				$staffqualifications_academic_grid->RowAction = strval($CurrentForm->getValue($staffqualifications_academic_grid->FormActionName));
			elseif ($staffqualifications_academic_grid->isGridAdd())
				$staffqualifications_academic_grid->RowAction = "insert";
			else
				$staffqualifications_academic_grid->RowAction = "";
		}

		// Set up key count
		$staffqualifications_academic_grid->KeyCount = $staffqualifications_academic_grid->RowIndex;

		// Init row class and style
		$staffqualifications_academic->resetAttributes();
		$staffqualifications_academic->CssClass = "";
		if ($staffqualifications_academic_grid->isGridAdd()) {
			if ($staffqualifications_academic->CurrentMode == "copy") {
				$staffqualifications_academic_grid->loadRowValues($staffqualifications_academic_grid->Recordset); // Load row values
				$staffqualifications_academic_grid->setRecordKey($staffqualifications_academic_grid->RowOldKey, $staffqualifications_academic_grid->Recordset); // Set old record key
			} else {
				$staffqualifications_academic_grid->loadRowValues(); // Load default values
				$staffqualifications_academic_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$staffqualifications_academic_grid->loadRowValues($staffqualifications_academic_grid->Recordset); // Load row values
		}
		$staffqualifications_academic->RowType = ROWTYPE_VIEW; // Render view
		if ($staffqualifications_academic_grid->isGridAdd()) // Grid add
			$staffqualifications_academic->RowType = ROWTYPE_ADD; // Render add
		if ($staffqualifications_academic_grid->isGridAdd() && $staffqualifications_academic->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$staffqualifications_academic_grid->restoreCurrentRowFormValues($staffqualifications_academic_grid->RowIndex); // Restore form values
		if ($staffqualifications_academic_grid->isGridEdit()) { // Grid edit
			if ($staffqualifications_academic->EventCancelled)
				$staffqualifications_academic_grid->restoreCurrentRowFormValues($staffqualifications_academic_grid->RowIndex); // Restore form values
			if ($staffqualifications_academic_grid->RowAction == "insert")
				$staffqualifications_academic->RowType = ROWTYPE_ADD; // Render add
			else
				$staffqualifications_academic->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($staffqualifications_academic_grid->isGridEdit() && ($staffqualifications_academic->RowType == ROWTYPE_EDIT || $staffqualifications_academic->RowType == ROWTYPE_ADD) && $staffqualifications_academic->EventCancelled) // Update failed
			$staffqualifications_academic_grid->restoreCurrentRowFormValues($staffqualifications_academic_grid->RowIndex); // Restore form values
		if ($staffqualifications_academic->RowType == ROWTYPE_EDIT) // Edit row
			$staffqualifications_academic_grid->EditRowCount++;
		if ($staffqualifications_academic->isConfirm()) // Confirm row
			$staffqualifications_academic_grid->restoreCurrentRowFormValues($staffqualifications_academic_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$staffqualifications_academic->RowAttrs->merge(["data-rowindex" => $staffqualifications_academic_grid->RowCount, "id" => "r" . $staffqualifications_academic_grid->RowCount . "_staffqualifications_academic", "data-rowtype" => $staffqualifications_academic->RowType]);

		// Render row
		$staffqualifications_academic_grid->renderRow();

		// Render list options
		$staffqualifications_academic_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($staffqualifications_academic_grid->RowAction != "delete" && $staffqualifications_academic_grid->RowAction != "insertdelete" && !($staffqualifications_academic_grid->RowAction == "insert" && $staffqualifications_academic->isConfirm() && $staffqualifications_academic_grid->emptyRow())) {
?>
	<tr <?php echo $staffqualifications_academic->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffqualifications_academic_grid->ListOptions->render("body", "left", $staffqualifications_academic_grid->RowCount);
?>
	<?php if ($staffqualifications_academic_grid->QualificationLevel->Visible) { // QualificationLevel ?>
		<td data-name="QualificationLevel" <?php echo $staffqualifications_academic_grid->QualificationLevel->cellAttributes() ?>>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffqualifications_academic_grid->RowCount ?>_staffqualifications_academic_QualificationLevel" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel"><?php echo EmptyValue(strval($staffqualifications_academic_grid->QualificationLevel->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffqualifications_academic_grid->QualificationLevel->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffqualifications_academic_grid->QualificationLevel->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffqualifications_academic_grid->QualificationLevel->ReadOnly || $staffqualifications_academic_grid->QualificationLevel->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffqualifications_academic_grid->QualificationLevel->Lookup->getParamTag($staffqualifications_academic_grid, "p_x" . $staffqualifications_academic_grid->RowIndex . "_QualificationLevel") ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationLevel" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffqualifications_academic_grid->QualificationLevel->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel" value="<?php echo $staffqualifications_academic_grid->QualificationLevel->CurrentValue ?>"<?php echo $staffqualifications_academic_grid->QualificationLevel->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationLevel" name="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel" id="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel" value="<?php echo HtmlEncode($staffqualifications_academic_grid->QualificationLevel->OldValue) ?>">
<?php } ?>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel"><?php echo EmptyValue(strval($staffqualifications_academic_grid->QualificationLevel->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffqualifications_academic_grid->QualificationLevel->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffqualifications_academic_grid->QualificationLevel->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffqualifications_academic_grid->QualificationLevel->ReadOnly || $staffqualifications_academic_grid->QualificationLevel->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffqualifications_academic_grid->QualificationLevel->Lookup->getParamTag($staffqualifications_academic_grid, "p_x" . $staffqualifications_academic_grid->RowIndex . "_QualificationLevel") ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationLevel" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffqualifications_academic_grid->QualificationLevel->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel" value="<?php echo $staffqualifications_academic_grid->QualificationLevel->CurrentValue ?>"<?php echo $staffqualifications_academic_grid->QualificationLevel->editAttributes() ?>>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationLevel" name="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel" id="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel" value="<?php echo HtmlEncode($staffqualifications_academic_grid->QualificationLevel->OldValue != null ? $staffqualifications_academic_grid->QualificationLevel->OldValue : $staffqualifications_academic_grid->QualificationLevel->CurrentValue) ?>">
<?php } ?>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffqualifications_academic_grid->RowCount ?>_staffqualifications_academic_QualificationLevel">
<span<?php echo $staffqualifications_academic_grid->QualificationLevel->viewAttributes() ?>><?php echo $staffqualifications_academic_grid->QualificationLevel->getViewValue() ?></span>
</span>
<?php if (!$staffqualifications_academic->isConfirm()) { ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationLevel" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel" value="<?php echo HtmlEncode($staffqualifications_academic_grid->QualificationLevel->FormValue) ?>">
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationLevel" name="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel" id="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel" value="<?php echo HtmlEncode($staffqualifications_academic_grid->QualificationLevel->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationLevel" name="fstaffqualifications_academicgrid$x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel" id="fstaffqualifications_academicgrid$x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel" value="<?php echo HtmlEncode($staffqualifications_academic_grid->QualificationLevel->FormValue) ?>">
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationLevel" name="fstaffqualifications_academicgrid$o<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel" id="fstaffqualifications_academicgrid$o<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel" value="<?php echo HtmlEncode($staffqualifications_academic_grid->QualificationLevel->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_EmployeeID" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_EmployeeID" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffqualifications_academic_grid->EmployeeID->CurrentValue) ?>">
<input type="hidden" data-table="staffqualifications_academic" data-field="x_EmployeeID" name="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_EmployeeID" id="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffqualifications_academic_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_EDIT || $staffqualifications_academic->CurrentMode == "edit") { ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_EmployeeID" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_EmployeeID" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffqualifications_academic_grid->EmployeeID->CurrentValue) ?>">
<?php } ?>
	<?php if ($staffqualifications_academic_grid->QualificationRemarks->Visible) { // QualificationRemarks ?>
		<td data-name="QualificationRemarks" <?php echo $staffqualifications_academic_grid->QualificationRemarks->cellAttributes() ?>>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffqualifications_academic_grid->RowCount ?>_staffqualifications_academic_QualificationRemarks" class="form-group">
<input type="text" data-table="staffqualifications_academic" data-field="x_QualificationRemarks" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationRemarks" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationRemarks" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_academic_grid->QualificationRemarks->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_grid->QualificationRemarks->EditValue ?>"<?php echo $staffqualifications_academic_grid->QualificationRemarks->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationRemarks" name="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationRemarks" id="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationRemarks" value="<?php echo HtmlEncode($staffqualifications_academic_grid->QualificationRemarks->OldValue) ?>">
<?php } ?>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffqualifications_academic_grid->RowCount ?>_staffqualifications_academic_QualificationRemarks" class="form-group">
<input type="text" data-table="staffqualifications_academic" data-field="x_QualificationRemarks" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationRemarks" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationRemarks" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_academic_grid->QualificationRemarks->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_grid->QualificationRemarks->EditValue ?>"<?php echo $staffqualifications_academic_grid->QualificationRemarks->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffqualifications_academic_grid->RowCount ?>_staffqualifications_academic_QualificationRemarks">
<span<?php echo $staffqualifications_academic_grid->QualificationRemarks->viewAttributes() ?>><?php echo $staffqualifications_academic_grid->QualificationRemarks->getViewValue() ?></span>
</span>
<?php if (!$staffqualifications_academic->isConfirm()) { ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationRemarks" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationRemarks" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationRemarks" value="<?php echo HtmlEncode($staffqualifications_academic_grid->QualificationRemarks->FormValue) ?>">
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationRemarks" name="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationRemarks" id="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationRemarks" value="<?php echo HtmlEncode($staffqualifications_academic_grid->QualificationRemarks->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationRemarks" name="fstaffqualifications_academicgrid$x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationRemarks" id="fstaffqualifications_academicgrid$x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationRemarks" value="<?php echo HtmlEncode($staffqualifications_academic_grid->QualificationRemarks->FormValue) ?>">
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationRemarks" name="fstaffqualifications_academicgrid$o<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationRemarks" id="fstaffqualifications_academicgrid$o<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationRemarks" value="<?php echo HtmlEncode($staffqualifications_academic_grid->QualificationRemarks->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffqualifications_academic_grid->AwardingInstitution->Visible) { // AwardingInstitution ?>
		<td data-name="AwardingInstitution" <?php echo $staffqualifications_academic_grid->AwardingInstitution->cellAttributes() ?>>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffqualifications_academic_grid->RowCount ?>_staffqualifications_academic_AwardingInstitution" class="form-group">
<input type="text" data-table="staffqualifications_academic" data-field="x_AwardingInstitution" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_AwardingInstitution" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_AwardingInstitution" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_academic_grid->AwardingInstitution->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_grid->AwardingInstitution->EditValue ?>"<?php echo $staffqualifications_academic_grid->AwardingInstitution->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_AwardingInstitution" name="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_AwardingInstitution" id="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_AwardingInstitution" value="<?php echo HtmlEncode($staffqualifications_academic_grid->AwardingInstitution->OldValue) ?>">
<?php } ?>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffqualifications_academic_grid->RowCount ?>_staffqualifications_academic_AwardingInstitution" class="form-group">
<input type="text" data-table="staffqualifications_academic" data-field="x_AwardingInstitution" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_AwardingInstitution" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_AwardingInstitution" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_academic_grid->AwardingInstitution->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_grid->AwardingInstitution->EditValue ?>"<?php echo $staffqualifications_academic_grid->AwardingInstitution->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffqualifications_academic_grid->RowCount ?>_staffqualifications_academic_AwardingInstitution">
<span<?php echo $staffqualifications_academic_grid->AwardingInstitution->viewAttributes() ?>><?php echo $staffqualifications_academic_grid->AwardingInstitution->getViewValue() ?></span>
</span>
<?php if (!$staffqualifications_academic->isConfirm()) { ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_AwardingInstitution" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_AwardingInstitution" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_AwardingInstitution" value="<?php echo HtmlEncode($staffqualifications_academic_grid->AwardingInstitution->FormValue) ?>">
<input type="hidden" data-table="staffqualifications_academic" data-field="x_AwardingInstitution" name="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_AwardingInstitution" id="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_AwardingInstitution" value="<?php echo HtmlEncode($staffqualifications_academic_grid->AwardingInstitution->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_AwardingInstitution" name="fstaffqualifications_academicgrid$x<?php echo $staffqualifications_academic_grid->RowIndex ?>_AwardingInstitution" id="fstaffqualifications_academicgrid$x<?php echo $staffqualifications_academic_grid->RowIndex ?>_AwardingInstitution" value="<?php echo HtmlEncode($staffqualifications_academic_grid->AwardingInstitution->FormValue) ?>">
<input type="hidden" data-table="staffqualifications_academic" data-field="x_AwardingInstitution" name="fstaffqualifications_academicgrid$o<?php echo $staffqualifications_academic_grid->RowIndex ?>_AwardingInstitution" id="fstaffqualifications_academicgrid$o<?php echo $staffqualifications_academic_grid->RowIndex ?>_AwardingInstitution" value="<?php echo HtmlEncode($staffqualifications_academic_grid->AwardingInstitution->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffqualifications_academic_grid->FromYear->Visible) { // FromYear ?>
		<td data-name="FromYear" <?php echo $staffqualifications_academic_grid->FromYear->cellAttributes() ?>>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffqualifications_academic_grid->RowCount ?>_staffqualifications_academic_FromYear" class="form-group">
<input type="text" data-table="staffqualifications_academic" data-field="x_FromYear" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_FromYear" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_FromYear" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_academic_grid->FromYear->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_grid->FromYear->EditValue ?>"<?php echo $staffqualifications_academic_grid->FromYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_FromYear" name="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_FromYear" id="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_FromYear" value="<?php echo HtmlEncode($staffqualifications_academic_grid->FromYear->OldValue) ?>">
<?php } ?>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffqualifications_academic_grid->RowCount ?>_staffqualifications_academic_FromYear" class="form-group">
<input type="text" data-table="staffqualifications_academic" data-field="x_FromYear" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_FromYear" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_FromYear" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_academic_grid->FromYear->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_grid->FromYear->EditValue ?>"<?php echo $staffqualifications_academic_grid->FromYear->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffqualifications_academic_grid->RowCount ?>_staffqualifications_academic_FromYear">
<span<?php echo $staffqualifications_academic_grid->FromYear->viewAttributes() ?>><?php echo $staffqualifications_academic_grid->FromYear->getViewValue() ?></span>
</span>
<?php if (!$staffqualifications_academic->isConfirm()) { ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_FromYear" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_FromYear" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_FromYear" value="<?php echo HtmlEncode($staffqualifications_academic_grid->FromYear->FormValue) ?>">
<input type="hidden" data-table="staffqualifications_academic" data-field="x_FromYear" name="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_FromYear" id="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_FromYear" value="<?php echo HtmlEncode($staffqualifications_academic_grid->FromYear->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_FromYear" name="fstaffqualifications_academicgrid$x<?php echo $staffqualifications_academic_grid->RowIndex ?>_FromYear" id="fstaffqualifications_academicgrid$x<?php echo $staffqualifications_academic_grid->RowIndex ?>_FromYear" value="<?php echo HtmlEncode($staffqualifications_academic_grid->FromYear->FormValue) ?>">
<input type="hidden" data-table="staffqualifications_academic" data-field="x_FromYear" name="fstaffqualifications_academicgrid$o<?php echo $staffqualifications_academic_grid->RowIndex ?>_FromYear" id="fstaffqualifications_academicgrid$o<?php echo $staffqualifications_academic_grid->RowIndex ?>_FromYear" value="<?php echo HtmlEncode($staffqualifications_academic_grid->FromYear->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffqualifications_academic_grid->YearObtained->Visible) { // YearObtained ?>
		<td data-name="YearObtained" <?php echo $staffqualifications_academic_grid->YearObtained->cellAttributes() ?>>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffqualifications_academic_grid->RowCount ?>_staffqualifications_academic_YearObtained" class="form-group">
<input type="text" data-table="staffqualifications_academic" data-field="x_YearObtained" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_YearObtained" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_YearObtained" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_academic_grid->YearObtained->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_grid->YearObtained->EditValue ?>"<?php echo $staffqualifications_academic_grid->YearObtained->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_YearObtained" name="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_YearObtained" id="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_YearObtained" value="<?php echo HtmlEncode($staffqualifications_academic_grid->YearObtained->OldValue) ?>">
<?php } ?>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="staffqualifications_academic" data-field="x_YearObtained" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_YearObtained" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_YearObtained" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_academic_grid->YearObtained->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_grid->YearObtained->EditValue ?>"<?php echo $staffqualifications_academic_grid->YearObtained->editAttributes() ?>>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_YearObtained" name="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_YearObtained" id="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_YearObtained" value="<?php echo HtmlEncode($staffqualifications_academic_grid->YearObtained->OldValue != null ? $staffqualifications_academic_grid->YearObtained->OldValue : $staffqualifications_academic_grid->YearObtained->CurrentValue) ?>">
<?php } ?>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffqualifications_academic_grid->RowCount ?>_staffqualifications_academic_YearObtained">
<span<?php echo $staffqualifications_academic_grid->YearObtained->viewAttributes() ?>><?php echo $staffqualifications_academic_grid->YearObtained->getViewValue() ?></span>
</span>
<?php if (!$staffqualifications_academic->isConfirm()) { ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_YearObtained" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_YearObtained" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_YearObtained" value="<?php echo HtmlEncode($staffqualifications_academic_grid->YearObtained->FormValue) ?>">
<input type="hidden" data-table="staffqualifications_academic" data-field="x_YearObtained" name="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_YearObtained" id="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_YearObtained" value="<?php echo HtmlEncode($staffqualifications_academic_grid->YearObtained->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_YearObtained" name="fstaffqualifications_academicgrid$x<?php echo $staffqualifications_academic_grid->RowIndex ?>_YearObtained" id="fstaffqualifications_academicgrid$x<?php echo $staffqualifications_academic_grid->RowIndex ?>_YearObtained" value="<?php echo HtmlEncode($staffqualifications_academic_grid->YearObtained->FormValue) ?>">
<input type="hidden" data-table="staffqualifications_academic" data-field="x_YearObtained" name="fstaffqualifications_academicgrid$o<?php echo $staffqualifications_academic_grid->RowIndex ?>_YearObtained" id="fstaffqualifications_academicgrid$o<?php echo $staffqualifications_academic_grid->RowIndex ?>_YearObtained" value="<?php echo HtmlEncode($staffqualifications_academic_grid->YearObtained->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffqualifications_academic_grid->ListOptions->render("body", "right", $staffqualifications_academic_grid->RowCount);
?>
	</tr>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_ADD || $staffqualifications_academic->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fstaffqualifications_academicgrid", "load"], function() {
	fstaffqualifications_academicgrid.updateLists(<?php echo $staffqualifications_academic_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$staffqualifications_academic_grid->isGridAdd() || $staffqualifications_academic->CurrentMode == "copy")
		if (!$staffqualifications_academic_grid->Recordset->EOF)
			$staffqualifications_academic_grid->Recordset->moveNext();
}
?>
<?php
	if ($staffqualifications_academic->CurrentMode == "add" || $staffqualifications_academic->CurrentMode == "copy" || $staffqualifications_academic->CurrentMode == "edit") {
		$staffqualifications_academic_grid->RowIndex = '$rowindex$';
		$staffqualifications_academic_grid->loadRowValues();

		// Set row properties
		$staffqualifications_academic->resetAttributes();
		$staffqualifications_academic->RowAttrs->merge(["data-rowindex" => $staffqualifications_academic_grid->RowIndex, "id" => "r0_staffqualifications_academic", "data-rowtype" => ROWTYPE_ADD]);
		$staffqualifications_academic->RowAttrs->appendClass("ew-template");
		$staffqualifications_academic->RowType = ROWTYPE_ADD;

		// Render row
		$staffqualifications_academic_grid->renderRow();

		// Render list options
		$staffqualifications_academic_grid->renderListOptions();
		$staffqualifications_academic_grid->StartRowCount = 0;
?>
	<tr <?php echo $staffqualifications_academic->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffqualifications_academic_grid->ListOptions->render("body", "left", $staffqualifications_academic_grid->RowIndex);
?>
	<?php if ($staffqualifications_academic_grid->QualificationLevel->Visible) { // QualificationLevel ?>
		<td data-name="QualificationLevel">
<?php if (!$staffqualifications_academic->isConfirm()) { ?>
<span id="el$rowindex$_staffqualifications_academic_QualificationLevel" class="form-group staffqualifications_academic_QualificationLevel">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel"><?php echo EmptyValue(strval($staffqualifications_academic_grid->QualificationLevel->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffqualifications_academic_grid->QualificationLevel->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffqualifications_academic_grid->QualificationLevel->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffqualifications_academic_grid->QualificationLevel->ReadOnly || $staffqualifications_academic_grid->QualificationLevel->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffqualifications_academic_grid->QualificationLevel->Lookup->getParamTag($staffqualifications_academic_grid, "p_x" . $staffqualifications_academic_grid->RowIndex . "_QualificationLevel") ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationLevel" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffqualifications_academic_grid->QualificationLevel->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel" value="<?php echo $staffqualifications_academic_grid->QualificationLevel->CurrentValue ?>"<?php echo $staffqualifications_academic_grid->QualificationLevel->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffqualifications_academic_QualificationLevel" class="form-group staffqualifications_academic_QualificationLevel">
<span<?php echo $staffqualifications_academic_grid->QualificationLevel->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffqualifications_academic_grid->QualificationLevel->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationLevel" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel" value="<?php echo HtmlEncode($staffqualifications_academic_grid->QualificationLevel->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationLevel" name="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel" id="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationLevel" value="<?php echo HtmlEncode($staffqualifications_academic_grid->QualificationLevel->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffqualifications_academic_grid->QualificationRemarks->Visible) { // QualificationRemarks ?>
		<td data-name="QualificationRemarks">
<?php if (!$staffqualifications_academic->isConfirm()) { ?>
<span id="el$rowindex$_staffqualifications_academic_QualificationRemarks" class="form-group staffqualifications_academic_QualificationRemarks">
<input type="text" data-table="staffqualifications_academic" data-field="x_QualificationRemarks" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationRemarks" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationRemarks" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_academic_grid->QualificationRemarks->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_grid->QualificationRemarks->EditValue ?>"<?php echo $staffqualifications_academic_grid->QualificationRemarks->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffqualifications_academic_QualificationRemarks" class="form-group staffqualifications_academic_QualificationRemarks">
<span<?php echo $staffqualifications_academic_grid->QualificationRemarks->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffqualifications_academic_grid->QualificationRemarks->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationRemarks" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationRemarks" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationRemarks" value="<?php echo HtmlEncode($staffqualifications_academic_grid->QualificationRemarks->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationRemarks" name="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationRemarks" id="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_QualificationRemarks" value="<?php echo HtmlEncode($staffqualifications_academic_grid->QualificationRemarks->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffqualifications_academic_grid->AwardingInstitution->Visible) { // AwardingInstitution ?>
		<td data-name="AwardingInstitution">
<?php if (!$staffqualifications_academic->isConfirm()) { ?>
<span id="el$rowindex$_staffqualifications_academic_AwardingInstitution" class="form-group staffqualifications_academic_AwardingInstitution">
<input type="text" data-table="staffqualifications_academic" data-field="x_AwardingInstitution" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_AwardingInstitution" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_AwardingInstitution" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_academic_grid->AwardingInstitution->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_grid->AwardingInstitution->EditValue ?>"<?php echo $staffqualifications_academic_grid->AwardingInstitution->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffqualifications_academic_AwardingInstitution" class="form-group staffqualifications_academic_AwardingInstitution">
<span<?php echo $staffqualifications_academic_grid->AwardingInstitution->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffqualifications_academic_grid->AwardingInstitution->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_AwardingInstitution" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_AwardingInstitution" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_AwardingInstitution" value="<?php echo HtmlEncode($staffqualifications_academic_grid->AwardingInstitution->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_AwardingInstitution" name="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_AwardingInstitution" id="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_AwardingInstitution" value="<?php echo HtmlEncode($staffqualifications_academic_grid->AwardingInstitution->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffqualifications_academic_grid->FromYear->Visible) { // FromYear ?>
		<td data-name="FromYear">
<?php if (!$staffqualifications_academic->isConfirm()) { ?>
<span id="el$rowindex$_staffqualifications_academic_FromYear" class="form-group staffqualifications_academic_FromYear">
<input type="text" data-table="staffqualifications_academic" data-field="x_FromYear" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_FromYear" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_FromYear" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_academic_grid->FromYear->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_grid->FromYear->EditValue ?>"<?php echo $staffqualifications_academic_grid->FromYear->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffqualifications_academic_FromYear" class="form-group staffqualifications_academic_FromYear">
<span<?php echo $staffqualifications_academic_grid->FromYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffqualifications_academic_grid->FromYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_FromYear" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_FromYear" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_FromYear" value="<?php echo HtmlEncode($staffqualifications_academic_grid->FromYear->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_FromYear" name="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_FromYear" id="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_FromYear" value="<?php echo HtmlEncode($staffqualifications_academic_grid->FromYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffqualifications_academic_grid->YearObtained->Visible) { // YearObtained ?>
		<td data-name="YearObtained">
<?php if (!$staffqualifications_academic->isConfirm()) { ?>
<span id="el$rowindex$_staffqualifications_academic_YearObtained" class="form-group staffqualifications_academic_YearObtained">
<input type="text" data-table="staffqualifications_academic" data-field="x_YearObtained" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_YearObtained" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_YearObtained" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_academic_grid->YearObtained->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_grid->YearObtained->EditValue ?>"<?php echo $staffqualifications_academic_grid->YearObtained->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffqualifications_academic_YearObtained" class="form-group staffqualifications_academic_YearObtained">
<span<?php echo $staffqualifications_academic_grid->YearObtained->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffqualifications_academic_grid->YearObtained->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_YearObtained" name="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_YearObtained" id="x<?php echo $staffqualifications_academic_grid->RowIndex ?>_YearObtained" value="<?php echo HtmlEncode($staffqualifications_academic_grid->YearObtained->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_YearObtained" name="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_YearObtained" id="o<?php echo $staffqualifications_academic_grid->RowIndex ?>_YearObtained" value="<?php echo HtmlEncode($staffqualifications_academic_grid->YearObtained->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffqualifications_academic_grid->ListOptions->render("body", "right", $staffqualifications_academic_grid->RowIndex);
?>
<script>
loadjs.ready(["fstaffqualifications_academicgrid", "load"], function() {
	fstaffqualifications_academicgrid.updateLists(<?php echo $staffqualifications_academic_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($staffqualifications_academic->CurrentMode == "add" || $staffqualifications_academic->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $staffqualifications_academic_grid->FormKeyCountName ?>" id="<?php echo $staffqualifications_academic_grid->FormKeyCountName ?>" value="<?php echo $staffqualifications_academic_grid->KeyCount ?>">
<?php echo $staffqualifications_academic_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($staffqualifications_academic->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $staffqualifications_academic_grid->FormKeyCountName ?>" id="<?php echo $staffqualifications_academic_grid->FormKeyCountName ?>" value="<?php echo $staffqualifications_academic_grid->KeyCount ?>">
<?php echo $staffqualifications_academic_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($staffqualifications_academic->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fstaffqualifications_academicgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($staffqualifications_academic_grid->Recordset)
	$staffqualifications_academic_grid->Recordset->Close();
?>
<?php if ($staffqualifications_academic_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $staffqualifications_academic_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($staffqualifications_academic_grid->TotalRecords == 0 && !$staffqualifications_academic->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $staffqualifications_academic_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$staffqualifications_academic_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$staffqualifications_academic_grid->terminate();
?>