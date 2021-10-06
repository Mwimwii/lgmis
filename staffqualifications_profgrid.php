<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($staffqualifications_prof_grid))
	$staffqualifications_prof_grid = new staffqualifications_prof_grid();

// Run the page
$staffqualifications_prof_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffqualifications_prof_grid->Page_Render();
?>
<?php if (!$staffqualifications_prof_grid->isExport()) { ?>
<script>
var fstaffqualifications_profgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fstaffqualifications_profgrid = new ew.Form("fstaffqualifications_profgrid", "grid");
	fstaffqualifications_profgrid.formKeyCountName = '<?php echo $staffqualifications_prof_grid->FormKeyCountName ?>';

	// Validate form
	fstaffqualifications_profgrid.validate = function() {
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
			<?php if ($staffqualifications_prof_grid->ProfQualificationLevel->Required) { ?>
				elm = this.getElements("x" + infix + "_ProfQualificationLevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_prof_grid->ProfQualificationLevel->caption(), $staffqualifications_prof_grid->ProfQualificationLevel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffqualifications_prof_grid->QualificationCode->Required) { ?>
				elm = this.getElements("x" + infix + "_QualificationCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_prof_grid->QualificationCode->caption(), $staffqualifications_prof_grid->QualificationCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffqualifications_prof_grid->QualificationRemarks->Required) { ?>
				elm = this.getElements("x" + infix + "_QualificationRemarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_prof_grid->QualificationRemarks->caption(), $staffqualifications_prof_grid->QualificationRemarks->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffqualifications_prof_grid->AwardingInstitution->Required) { ?>
				elm = this.getElements("x" + infix + "_AwardingInstitution");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_prof_grid->AwardingInstitution->caption(), $staffqualifications_prof_grid->AwardingInstitution->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffqualifications_prof_grid->FromYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FromYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_prof_grid->FromYear->caption(), $staffqualifications_prof_grid->FromYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FromYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffqualifications_prof_grid->FromYear->errorMessage()) ?>");
			<?php if ($staffqualifications_prof_grid->YearObtained->Required) { ?>
				elm = this.getElements("x" + infix + "_YearObtained");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_prof_grid->YearObtained->caption(), $staffqualifications_prof_grid->YearObtained->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_YearObtained");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffqualifications_prof_grid->YearObtained->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fstaffqualifications_profgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ProfQualificationLevel", false)) return false;
		if (ew.valueChanged(fobj, infix, "QualificationCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "QualificationRemarks", false)) return false;
		if (ew.valueChanged(fobj, infix, "AwardingInstitution", false)) return false;
		if (ew.valueChanged(fobj, infix, "FromYear", false)) return false;
		if (ew.valueChanged(fobj, infix, "YearObtained", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fstaffqualifications_profgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffqualifications_profgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffqualifications_profgrid.lists["x_ProfQualificationLevel"] = <?php echo $staffqualifications_prof_grid->ProfQualificationLevel->Lookup->toClientList($staffqualifications_prof_grid) ?>;
	fstaffqualifications_profgrid.lists["x_ProfQualificationLevel"].options = <?php echo JsonEncode($staffqualifications_prof_grid->ProfQualificationLevel->lookupOptions()) ?>;
	fstaffqualifications_profgrid.lists["x_QualificationCode"] = <?php echo $staffqualifications_prof_grid->QualificationCode->Lookup->toClientList($staffqualifications_prof_grid) ?>;
	fstaffqualifications_profgrid.lists["x_QualificationCode"].options = <?php echo JsonEncode($staffqualifications_prof_grid->QualificationCode->lookupOptions()) ?>;
	loadjs.done("fstaffqualifications_profgrid");
});
</script>
<?php } ?>
<?php
$staffqualifications_prof_grid->renderOtherOptions();
?>
<?php if ($staffqualifications_prof_grid->TotalRecords > 0 || $staffqualifications_prof->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($staffqualifications_prof_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> staffqualifications_prof">
<?php if ($staffqualifications_prof_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $staffqualifications_prof_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fstaffqualifications_profgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_staffqualifications_prof" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_staffqualifications_profgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$staffqualifications_prof->RowType = ROWTYPE_HEADER;

// Render list options
$staffqualifications_prof_grid->renderListOptions();

// Render list options (header, left)
$staffqualifications_prof_grid->ListOptions->render("header", "left");
?>
<?php if ($staffqualifications_prof_grid->ProfQualificationLevel->Visible) { // ProfQualificationLevel ?>
	<?php if ($staffqualifications_prof_grid->SortUrl($staffqualifications_prof_grid->ProfQualificationLevel) == "") { ?>
		<th data-name="ProfQualificationLevel" class="<?php echo $staffqualifications_prof_grid->ProfQualificationLevel->headerCellClass() ?>"><div id="elh_staffqualifications_prof_ProfQualificationLevel" class="staffqualifications_prof_ProfQualificationLevel"><div class="ew-table-header-caption"><?php echo $staffqualifications_prof_grid->ProfQualificationLevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProfQualificationLevel" class="<?php echo $staffqualifications_prof_grid->ProfQualificationLevel->headerCellClass() ?>"><div><div id="elh_staffqualifications_prof_ProfQualificationLevel" class="staffqualifications_prof_ProfQualificationLevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffqualifications_prof_grid->ProfQualificationLevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffqualifications_prof_grid->ProfQualificationLevel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffqualifications_prof_grid->ProfQualificationLevel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffqualifications_prof_grid->QualificationCode->Visible) { // QualificationCode ?>
	<?php if ($staffqualifications_prof_grid->SortUrl($staffqualifications_prof_grid->QualificationCode) == "") { ?>
		<th data-name="QualificationCode" class="<?php echo $staffqualifications_prof_grid->QualificationCode->headerCellClass() ?>"><div id="elh_staffqualifications_prof_QualificationCode" class="staffqualifications_prof_QualificationCode"><div class="ew-table-header-caption"><?php echo $staffqualifications_prof_grid->QualificationCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="QualificationCode" class="<?php echo $staffqualifications_prof_grid->QualificationCode->headerCellClass() ?>"><div><div id="elh_staffqualifications_prof_QualificationCode" class="staffqualifications_prof_QualificationCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffqualifications_prof_grid->QualificationCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffqualifications_prof_grid->QualificationCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffqualifications_prof_grid->QualificationCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffqualifications_prof_grid->QualificationRemarks->Visible) { // QualificationRemarks ?>
	<?php if ($staffqualifications_prof_grid->SortUrl($staffqualifications_prof_grid->QualificationRemarks) == "") { ?>
		<th data-name="QualificationRemarks" class="<?php echo $staffqualifications_prof_grid->QualificationRemarks->headerCellClass() ?>"><div id="elh_staffqualifications_prof_QualificationRemarks" class="staffqualifications_prof_QualificationRemarks"><div class="ew-table-header-caption"><?php echo $staffqualifications_prof_grid->QualificationRemarks->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="QualificationRemarks" class="<?php echo $staffqualifications_prof_grid->QualificationRemarks->headerCellClass() ?>"><div><div id="elh_staffqualifications_prof_QualificationRemarks" class="staffqualifications_prof_QualificationRemarks">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffqualifications_prof_grid->QualificationRemarks->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffqualifications_prof_grid->QualificationRemarks->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffqualifications_prof_grid->QualificationRemarks->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffqualifications_prof_grid->AwardingInstitution->Visible) { // AwardingInstitution ?>
	<?php if ($staffqualifications_prof_grid->SortUrl($staffqualifications_prof_grid->AwardingInstitution) == "") { ?>
		<th data-name="AwardingInstitution" class="<?php echo $staffqualifications_prof_grid->AwardingInstitution->headerCellClass() ?>"><div id="elh_staffqualifications_prof_AwardingInstitution" class="staffqualifications_prof_AwardingInstitution"><div class="ew-table-header-caption"><?php echo $staffqualifications_prof_grid->AwardingInstitution->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AwardingInstitution" class="<?php echo $staffqualifications_prof_grid->AwardingInstitution->headerCellClass() ?>"><div><div id="elh_staffqualifications_prof_AwardingInstitution" class="staffqualifications_prof_AwardingInstitution">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffqualifications_prof_grid->AwardingInstitution->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffqualifications_prof_grid->AwardingInstitution->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffqualifications_prof_grid->AwardingInstitution->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffqualifications_prof_grid->FromYear->Visible) { // FromYear ?>
	<?php if ($staffqualifications_prof_grid->SortUrl($staffqualifications_prof_grid->FromYear) == "") { ?>
		<th data-name="FromYear" class="<?php echo $staffqualifications_prof_grid->FromYear->headerCellClass() ?>"><div id="elh_staffqualifications_prof_FromYear" class="staffqualifications_prof_FromYear"><div class="ew-table-header-caption"><?php echo $staffqualifications_prof_grid->FromYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FromYear" class="<?php echo $staffqualifications_prof_grid->FromYear->headerCellClass() ?>"><div><div id="elh_staffqualifications_prof_FromYear" class="staffqualifications_prof_FromYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffqualifications_prof_grid->FromYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffqualifications_prof_grid->FromYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffqualifications_prof_grid->FromYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffqualifications_prof_grid->YearObtained->Visible) { // YearObtained ?>
	<?php if ($staffqualifications_prof_grid->SortUrl($staffqualifications_prof_grid->YearObtained) == "") { ?>
		<th data-name="YearObtained" class="<?php echo $staffqualifications_prof_grid->YearObtained->headerCellClass() ?>"><div id="elh_staffqualifications_prof_YearObtained" class="staffqualifications_prof_YearObtained"><div class="ew-table-header-caption"><?php echo $staffqualifications_prof_grid->YearObtained->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="YearObtained" class="<?php echo $staffqualifications_prof_grid->YearObtained->headerCellClass() ?>"><div><div id="elh_staffqualifications_prof_YearObtained" class="staffqualifications_prof_YearObtained">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffqualifications_prof_grid->YearObtained->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffqualifications_prof_grid->YearObtained->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffqualifications_prof_grid->YearObtained->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$staffqualifications_prof_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$staffqualifications_prof_grid->StartRecord = 1;
$staffqualifications_prof_grid->StopRecord = $staffqualifications_prof_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($staffqualifications_prof->isConfirm() || $staffqualifications_prof_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($staffqualifications_prof_grid->FormKeyCountName) && ($staffqualifications_prof_grid->isGridAdd() || $staffqualifications_prof_grid->isGridEdit() || $staffqualifications_prof->isConfirm())) {
		$staffqualifications_prof_grid->KeyCount = $CurrentForm->getValue($staffqualifications_prof_grid->FormKeyCountName);
		$staffqualifications_prof_grid->StopRecord = $staffqualifications_prof_grid->StartRecord + $staffqualifications_prof_grid->KeyCount - 1;
	}
}
$staffqualifications_prof_grid->RecordCount = $staffqualifications_prof_grid->StartRecord - 1;
if ($staffqualifications_prof_grid->Recordset && !$staffqualifications_prof_grid->Recordset->EOF) {
	$staffqualifications_prof_grid->Recordset->moveFirst();
	$selectLimit = $staffqualifications_prof_grid->UseSelectLimit;
	if (!$selectLimit && $staffqualifications_prof_grid->StartRecord > 1)
		$staffqualifications_prof_grid->Recordset->move($staffqualifications_prof_grid->StartRecord - 1);
} elseif (!$staffqualifications_prof->AllowAddDeleteRow && $staffqualifications_prof_grid->StopRecord == 0) {
	$staffqualifications_prof_grid->StopRecord = $staffqualifications_prof->GridAddRowCount;
}

// Initialize aggregate
$staffqualifications_prof->RowType = ROWTYPE_AGGREGATEINIT;
$staffqualifications_prof->resetAttributes();
$staffqualifications_prof_grid->renderRow();
if ($staffqualifications_prof_grid->isGridAdd())
	$staffqualifications_prof_grid->RowIndex = 0;
if ($staffqualifications_prof_grid->isGridEdit())
	$staffqualifications_prof_grid->RowIndex = 0;
while ($staffqualifications_prof_grid->RecordCount < $staffqualifications_prof_grid->StopRecord) {
	$staffqualifications_prof_grid->RecordCount++;
	if ($staffqualifications_prof_grid->RecordCount >= $staffqualifications_prof_grid->StartRecord) {
		$staffqualifications_prof_grid->RowCount++;
		if ($staffqualifications_prof_grid->isGridAdd() || $staffqualifications_prof_grid->isGridEdit() || $staffqualifications_prof->isConfirm()) {
			$staffqualifications_prof_grid->RowIndex++;
			$CurrentForm->Index = $staffqualifications_prof_grid->RowIndex;
			if ($CurrentForm->hasValue($staffqualifications_prof_grid->FormActionName) && ($staffqualifications_prof->isConfirm() || $staffqualifications_prof_grid->EventCancelled))
				$staffqualifications_prof_grid->RowAction = strval($CurrentForm->getValue($staffqualifications_prof_grid->FormActionName));
			elseif ($staffqualifications_prof_grid->isGridAdd())
				$staffqualifications_prof_grid->RowAction = "insert";
			else
				$staffqualifications_prof_grid->RowAction = "";
		}

		// Set up key count
		$staffqualifications_prof_grid->KeyCount = $staffqualifications_prof_grid->RowIndex;

		// Init row class and style
		$staffqualifications_prof->resetAttributes();
		$staffqualifications_prof->CssClass = "";
		if ($staffqualifications_prof_grid->isGridAdd()) {
			if ($staffqualifications_prof->CurrentMode == "copy") {
				$staffqualifications_prof_grid->loadRowValues($staffqualifications_prof_grid->Recordset); // Load row values
				$staffqualifications_prof_grid->setRecordKey($staffqualifications_prof_grid->RowOldKey, $staffqualifications_prof_grid->Recordset); // Set old record key
			} else {
				$staffqualifications_prof_grid->loadRowValues(); // Load default values
				$staffqualifications_prof_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$staffqualifications_prof_grid->loadRowValues($staffqualifications_prof_grid->Recordset); // Load row values
		}
		$staffqualifications_prof->RowType = ROWTYPE_VIEW; // Render view
		if ($staffqualifications_prof_grid->isGridAdd()) // Grid add
			$staffqualifications_prof->RowType = ROWTYPE_ADD; // Render add
		if ($staffqualifications_prof_grid->isGridAdd() && $staffqualifications_prof->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$staffqualifications_prof_grid->restoreCurrentRowFormValues($staffqualifications_prof_grid->RowIndex); // Restore form values
		if ($staffqualifications_prof_grid->isGridEdit()) { // Grid edit
			if ($staffqualifications_prof->EventCancelled)
				$staffqualifications_prof_grid->restoreCurrentRowFormValues($staffqualifications_prof_grid->RowIndex); // Restore form values
			if ($staffqualifications_prof_grid->RowAction == "insert")
				$staffqualifications_prof->RowType = ROWTYPE_ADD; // Render add
			else
				$staffqualifications_prof->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($staffqualifications_prof_grid->isGridEdit() && ($staffqualifications_prof->RowType == ROWTYPE_EDIT || $staffqualifications_prof->RowType == ROWTYPE_ADD) && $staffqualifications_prof->EventCancelled) // Update failed
			$staffqualifications_prof_grid->restoreCurrentRowFormValues($staffqualifications_prof_grid->RowIndex); // Restore form values
		if ($staffqualifications_prof->RowType == ROWTYPE_EDIT) // Edit row
			$staffqualifications_prof_grid->EditRowCount++;
		if ($staffqualifications_prof->isConfirm()) // Confirm row
			$staffqualifications_prof_grid->restoreCurrentRowFormValues($staffqualifications_prof_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$staffqualifications_prof->RowAttrs->merge(["data-rowindex" => $staffqualifications_prof_grid->RowCount, "id" => "r" . $staffqualifications_prof_grid->RowCount . "_staffqualifications_prof", "data-rowtype" => $staffqualifications_prof->RowType]);

		// Render row
		$staffqualifications_prof_grid->renderRow();

		// Render list options
		$staffqualifications_prof_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($staffqualifications_prof_grid->RowAction != "delete" && $staffqualifications_prof_grid->RowAction != "insertdelete" && !($staffqualifications_prof_grid->RowAction == "insert" && $staffqualifications_prof->isConfirm() && $staffqualifications_prof_grid->emptyRow())) {
?>
	<tr <?php echo $staffqualifications_prof->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffqualifications_prof_grid->ListOptions->render("body", "left", $staffqualifications_prof_grid->RowCount);
?>
	<?php if ($staffqualifications_prof_grid->ProfQualificationLevel->Visible) { // ProfQualificationLevel ?>
		<td data-name="ProfQualificationLevel" <?php echo $staffqualifications_prof_grid->ProfQualificationLevel->cellAttributes() ?>>
<?php if ($staffqualifications_prof->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffqualifications_prof_grid->RowCount ?>_staffqualifications_prof_ProfQualificationLevel" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel"><?php echo EmptyValue(strval($staffqualifications_prof_grid->ProfQualificationLevel->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffqualifications_prof_grid->ProfQualificationLevel->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffqualifications_prof_grid->ProfQualificationLevel->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffqualifications_prof_grid->ProfQualificationLevel->ReadOnly || $staffqualifications_prof_grid->ProfQualificationLevel->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffqualifications_prof_grid->ProfQualificationLevel->Lookup->getParamTag($staffqualifications_prof_grid, "p_x" . $staffqualifications_prof_grid->RowIndex . "_ProfQualificationLevel") ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_ProfQualificationLevel" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffqualifications_prof_grid->ProfQualificationLevel->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel" value="<?php echo $staffqualifications_prof_grid->ProfQualificationLevel->CurrentValue ?>"<?php echo $staffqualifications_prof_grid->ProfQualificationLevel->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_ProfQualificationLevel" name="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel" id="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel" value="<?php echo HtmlEncode($staffqualifications_prof_grid->ProfQualificationLevel->OldValue) ?>">
<?php } ?>
<?php if ($staffqualifications_prof->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel"><?php echo EmptyValue(strval($staffqualifications_prof_grid->ProfQualificationLevel->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffqualifications_prof_grid->ProfQualificationLevel->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffqualifications_prof_grid->ProfQualificationLevel->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffqualifications_prof_grid->ProfQualificationLevel->ReadOnly || $staffqualifications_prof_grid->ProfQualificationLevel->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffqualifications_prof_grid->ProfQualificationLevel->Lookup->getParamTag($staffqualifications_prof_grid, "p_x" . $staffqualifications_prof_grid->RowIndex . "_ProfQualificationLevel") ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_ProfQualificationLevel" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffqualifications_prof_grid->ProfQualificationLevel->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel" value="<?php echo $staffqualifications_prof_grid->ProfQualificationLevel->CurrentValue ?>"<?php echo $staffqualifications_prof_grid->ProfQualificationLevel->editAttributes() ?>>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_ProfQualificationLevel" name="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel" id="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel" value="<?php echo HtmlEncode($staffqualifications_prof_grid->ProfQualificationLevel->OldValue != null ? $staffqualifications_prof_grid->ProfQualificationLevel->OldValue : $staffqualifications_prof_grid->ProfQualificationLevel->CurrentValue) ?>">
<?php } ?>
<?php if ($staffqualifications_prof->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffqualifications_prof_grid->RowCount ?>_staffqualifications_prof_ProfQualificationLevel">
<span<?php echo $staffqualifications_prof_grid->ProfQualificationLevel->viewAttributes() ?>><?php echo $staffqualifications_prof_grid->ProfQualificationLevel->getViewValue() ?></span>
</span>
<?php if (!$staffqualifications_prof->isConfirm()) { ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_ProfQualificationLevel" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel" value="<?php echo HtmlEncode($staffqualifications_prof_grid->ProfQualificationLevel->FormValue) ?>">
<input type="hidden" data-table="staffqualifications_prof" data-field="x_ProfQualificationLevel" name="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel" id="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel" value="<?php echo HtmlEncode($staffqualifications_prof_grid->ProfQualificationLevel->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_ProfQualificationLevel" name="fstaffqualifications_profgrid$x<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel" id="fstaffqualifications_profgrid$x<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel" value="<?php echo HtmlEncode($staffqualifications_prof_grid->ProfQualificationLevel->FormValue) ?>">
<input type="hidden" data-table="staffqualifications_prof" data-field="x_ProfQualificationLevel" name="fstaffqualifications_profgrid$o<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel" id="fstaffqualifications_profgrid$o<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel" value="<?php echo HtmlEncode($staffqualifications_prof_grid->ProfQualificationLevel->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($staffqualifications_prof->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_EmployeeID" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_EmployeeID" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffqualifications_prof_grid->EmployeeID->CurrentValue) ?>">
<input type="hidden" data-table="staffqualifications_prof" data-field="x_EmployeeID" name="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_EmployeeID" id="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffqualifications_prof_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($staffqualifications_prof->RowType == ROWTYPE_EDIT || $staffqualifications_prof->CurrentMode == "edit") { ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_EmployeeID" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_EmployeeID" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffqualifications_prof_grid->EmployeeID->CurrentValue) ?>">
<?php } ?>
	<?php if ($staffqualifications_prof_grid->QualificationCode->Visible) { // QualificationCode ?>
		<td data-name="QualificationCode" <?php echo $staffqualifications_prof_grid->QualificationCode->cellAttributes() ?>>
<?php if ($staffqualifications_prof->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffqualifications_prof_grid->RowCount ?>_staffqualifications_prof_QualificationCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffqualifications_prof" data-field="x_QualificationCode" data-value-separator="<?php echo $staffqualifications_prof_grid->QualificationCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationCode" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationCode"<?php echo $staffqualifications_prof_grid->QualificationCode->editAttributes() ?>>
			<?php echo $staffqualifications_prof_grid->QualificationCode->selectOptionListHtml("x{$staffqualifications_prof_grid->RowIndex}_QualificationCode") ?>
		</select>
</div>
<?php echo $staffqualifications_prof_grid->QualificationCode->Lookup->getParamTag($staffqualifications_prof_grid, "p_x" . $staffqualifications_prof_grid->RowIndex . "_QualificationCode") ?>
</span>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_QualificationCode" name="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationCode" id="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationCode" value="<?php echo HtmlEncode($staffqualifications_prof_grid->QualificationCode->OldValue) ?>">
<?php } ?>
<?php if ($staffqualifications_prof->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffqualifications_prof" data-field="x_QualificationCode" data-value-separator="<?php echo $staffqualifications_prof_grid->QualificationCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationCode" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationCode"<?php echo $staffqualifications_prof_grid->QualificationCode->editAttributes() ?>>
			<?php echo $staffqualifications_prof_grid->QualificationCode->selectOptionListHtml("x{$staffqualifications_prof_grid->RowIndex}_QualificationCode") ?>
		</select>
</div>
<?php echo $staffqualifications_prof_grid->QualificationCode->Lookup->getParamTag($staffqualifications_prof_grid, "p_x" . $staffqualifications_prof_grid->RowIndex . "_QualificationCode") ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_QualificationCode" name="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationCode" id="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationCode" value="<?php echo HtmlEncode($staffqualifications_prof_grid->QualificationCode->OldValue != null ? $staffqualifications_prof_grid->QualificationCode->OldValue : $staffqualifications_prof_grid->QualificationCode->CurrentValue) ?>">
<?php } ?>
<?php if ($staffqualifications_prof->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffqualifications_prof_grid->RowCount ?>_staffqualifications_prof_QualificationCode">
<span<?php echo $staffqualifications_prof_grid->QualificationCode->viewAttributes() ?>><?php echo $staffqualifications_prof_grid->QualificationCode->getViewValue() ?></span>
</span>
<?php if (!$staffqualifications_prof->isConfirm()) { ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_QualificationCode" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationCode" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationCode" value="<?php echo HtmlEncode($staffqualifications_prof_grid->QualificationCode->FormValue) ?>">
<input type="hidden" data-table="staffqualifications_prof" data-field="x_QualificationCode" name="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationCode" id="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationCode" value="<?php echo HtmlEncode($staffqualifications_prof_grid->QualificationCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_QualificationCode" name="fstaffqualifications_profgrid$x<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationCode" id="fstaffqualifications_profgrid$x<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationCode" value="<?php echo HtmlEncode($staffqualifications_prof_grid->QualificationCode->FormValue) ?>">
<input type="hidden" data-table="staffqualifications_prof" data-field="x_QualificationCode" name="fstaffqualifications_profgrid$o<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationCode" id="fstaffqualifications_profgrid$o<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationCode" value="<?php echo HtmlEncode($staffqualifications_prof_grid->QualificationCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffqualifications_prof_grid->QualificationRemarks->Visible) { // QualificationRemarks ?>
		<td data-name="QualificationRemarks" <?php echo $staffqualifications_prof_grid->QualificationRemarks->cellAttributes() ?>>
<?php if ($staffqualifications_prof->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffqualifications_prof_grid->RowCount ?>_staffqualifications_prof_QualificationRemarks" class="form-group">
<input type="text" data-table="staffqualifications_prof" data-field="x_QualificationRemarks" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationRemarks" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationRemarks" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_prof_grid->QualificationRemarks->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_prof_grid->QualificationRemarks->EditValue ?>"<?php echo $staffqualifications_prof_grid->QualificationRemarks->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_QualificationRemarks" name="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationRemarks" id="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationRemarks" value="<?php echo HtmlEncode($staffqualifications_prof_grid->QualificationRemarks->OldValue) ?>">
<?php } ?>
<?php if ($staffqualifications_prof->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffqualifications_prof_grid->RowCount ?>_staffqualifications_prof_QualificationRemarks" class="form-group">
<input type="text" data-table="staffqualifications_prof" data-field="x_QualificationRemarks" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationRemarks" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationRemarks" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_prof_grid->QualificationRemarks->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_prof_grid->QualificationRemarks->EditValue ?>"<?php echo $staffqualifications_prof_grid->QualificationRemarks->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staffqualifications_prof->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffqualifications_prof_grid->RowCount ?>_staffqualifications_prof_QualificationRemarks">
<span<?php echo $staffqualifications_prof_grid->QualificationRemarks->viewAttributes() ?>><?php echo $staffqualifications_prof_grid->QualificationRemarks->getViewValue() ?></span>
</span>
<?php if (!$staffqualifications_prof->isConfirm()) { ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_QualificationRemarks" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationRemarks" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationRemarks" value="<?php echo HtmlEncode($staffqualifications_prof_grid->QualificationRemarks->FormValue) ?>">
<input type="hidden" data-table="staffqualifications_prof" data-field="x_QualificationRemarks" name="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationRemarks" id="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationRemarks" value="<?php echo HtmlEncode($staffqualifications_prof_grid->QualificationRemarks->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_QualificationRemarks" name="fstaffqualifications_profgrid$x<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationRemarks" id="fstaffqualifications_profgrid$x<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationRemarks" value="<?php echo HtmlEncode($staffqualifications_prof_grid->QualificationRemarks->FormValue) ?>">
<input type="hidden" data-table="staffqualifications_prof" data-field="x_QualificationRemarks" name="fstaffqualifications_profgrid$o<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationRemarks" id="fstaffqualifications_profgrid$o<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationRemarks" value="<?php echo HtmlEncode($staffqualifications_prof_grid->QualificationRemarks->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffqualifications_prof_grid->AwardingInstitution->Visible) { // AwardingInstitution ?>
		<td data-name="AwardingInstitution" <?php echo $staffqualifications_prof_grid->AwardingInstitution->cellAttributes() ?>>
<?php if ($staffqualifications_prof->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffqualifications_prof_grid->RowCount ?>_staffqualifications_prof_AwardingInstitution" class="form-group">
<input type="text" data-table="staffqualifications_prof" data-field="x_AwardingInstitution" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_AwardingInstitution" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_AwardingInstitution" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_prof_grid->AwardingInstitution->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_prof_grid->AwardingInstitution->EditValue ?>"<?php echo $staffqualifications_prof_grid->AwardingInstitution->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_AwardingInstitution" name="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_AwardingInstitution" id="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_AwardingInstitution" value="<?php echo HtmlEncode($staffqualifications_prof_grid->AwardingInstitution->OldValue) ?>">
<?php } ?>
<?php if ($staffqualifications_prof->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffqualifications_prof_grid->RowCount ?>_staffqualifications_prof_AwardingInstitution" class="form-group">
<input type="text" data-table="staffqualifications_prof" data-field="x_AwardingInstitution" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_AwardingInstitution" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_AwardingInstitution" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_prof_grid->AwardingInstitution->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_prof_grid->AwardingInstitution->EditValue ?>"<?php echo $staffqualifications_prof_grid->AwardingInstitution->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staffqualifications_prof->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffqualifications_prof_grid->RowCount ?>_staffqualifications_prof_AwardingInstitution">
<span<?php echo $staffqualifications_prof_grid->AwardingInstitution->viewAttributes() ?>><?php echo $staffqualifications_prof_grid->AwardingInstitution->getViewValue() ?></span>
</span>
<?php if (!$staffqualifications_prof->isConfirm()) { ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_AwardingInstitution" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_AwardingInstitution" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_AwardingInstitution" value="<?php echo HtmlEncode($staffqualifications_prof_grid->AwardingInstitution->FormValue) ?>">
<input type="hidden" data-table="staffqualifications_prof" data-field="x_AwardingInstitution" name="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_AwardingInstitution" id="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_AwardingInstitution" value="<?php echo HtmlEncode($staffqualifications_prof_grid->AwardingInstitution->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_AwardingInstitution" name="fstaffqualifications_profgrid$x<?php echo $staffqualifications_prof_grid->RowIndex ?>_AwardingInstitution" id="fstaffqualifications_profgrid$x<?php echo $staffqualifications_prof_grid->RowIndex ?>_AwardingInstitution" value="<?php echo HtmlEncode($staffqualifications_prof_grid->AwardingInstitution->FormValue) ?>">
<input type="hidden" data-table="staffqualifications_prof" data-field="x_AwardingInstitution" name="fstaffqualifications_profgrid$o<?php echo $staffqualifications_prof_grid->RowIndex ?>_AwardingInstitution" id="fstaffqualifications_profgrid$o<?php echo $staffqualifications_prof_grid->RowIndex ?>_AwardingInstitution" value="<?php echo HtmlEncode($staffqualifications_prof_grid->AwardingInstitution->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffqualifications_prof_grid->FromYear->Visible) { // FromYear ?>
		<td data-name="FromYear" <?php echo $staffqualifications_prof_grid->FromYear->cellAttributes() ?>>
<?php if ($staffqualifications_prof->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffqualifications_prof_grid->RowCount ?>_staffqualifications_prof_FromYear" class="form-group">
<input type="text" data-table="staffqualifications_prof" data-field="x_FromYear" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_FromYear" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_FromYear" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_prof_grid->FromYear->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_prof_grid->FromYear->EditValue ?>"<?php echo $staffqualifications_prof_grid->FromYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_FromYear" name="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_FromYear" id="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_FromYear" value="<?php echo HtmlEncode($staffqualifications_prof_grid->FromYear->OldValue) ?>">
<?php } ?>
<?php if ($staffqualifications_prof->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffqualifications_prof_grid->RowCount ?>_staffqualifications_prof_FromYear" class="form-group">
<input type="text" data-table="staffqualifications_prof" data-field="x_FromYear" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_FromYear" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_FromYear" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_prof_grid->FromYear->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_prof_grid->FromYear->EditValue ?>"<?php echo $staffqualifications_prof_grid->FromYear->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staffqualifications_prof->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffqualifications_prof_grid->RowCount ?>_staffqualifications_prof_FromYear">
<span<?php echo $staffqualifications_prof_grid->FromYear->viewAttributes() ?>><?php echo $staffqualifications_prof_grid->FromYear->getViewValue() ?></span>
</span>
<?php if (!$staffqualifications_prof->isConfirm()) { ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_FromYear" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_FromYear" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_FromYear" value="<?php echo HtmlEncode($staffqualifications_prof_grid->FromYear->FormValue) ?>">
<input type="hidden" data-table="staffqualifications_prof" data-field="x_FromYear" name="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_FromYear" id="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_FromYear" value="<?php echo HtmlEncode($staffqualifications_prof_grid->FromYear->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_FromYear" name="fstaffqualifications_profgrid$x<?php echo $staffqualifications_prof_grid->RowIndex ?>_FromYear" id="fstaffqualifications_profgrid$x<?php echo $staffqualifications_prof_grid->RowIndex ?>_FromYear" value="<?php echo HtmlEncode($staffqualifications_prof_grid->FromYear->FormValue) ?>">
<input type="hidden" data-table="staffqualifications_prof" data-field="x_FromYear" name="fstaffqualifications_profgrid$o<?php echo $staffqualifications_prof_grid->RowIndex ?>_FromYear" id="fstaffqualifications_profgrid$o<?php echo $staffqualifications_prof_grid->RowIndex ?>_FromYear" value="<?php echo HtmlEncode($staffqualifications_prof_grid->FromYear->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffqualifications_prof_grid->YearObtained->Visible) { // YearObtained ?>
		<td data-name="YearObtained" <?php echo $staffqualifications_prof_grid->YearObtained->cellAttributes() ?>>
<?php if ($staffqualifications_prof->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffqualifications_prof_grid->RowCount ?>_staffqualifications_prof_YearObtained" class="form-group">
<input type="text" data-table="staffqualifications_prof" data-field="x_YearObtained" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_YearObtained" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_YearObtained" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_prof_grid->YearObtained->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_prof_grid->YearObtained->EditValue ?>"<?php echo $staffqualifications_prof_grid->YearObtained->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_YearObtained" name="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_YearObtained" id="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_YearObtained" value="<?php echo HtmlEncode($staffqualifications_prof_grid->YearObtained->OldValue) ?>">
<?php } ?>
<?php if ($staffqualifications_prof->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffqualifications_prof_grid->RowCount ?>_staffqualifications_prof_YearObtained" class="form-group">
<input type="text" data-table="staffqualifications_prof" data-field="x_YearObtained" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_YearObtained" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_YearObtained" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_prof_grid->YearObtained->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_prof_grid->YearObtained->EditValue ?>"<?php echo $staffqualifications_prof_grid->YearObtained->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staffqualifications_prof->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffqualifications_prof_grid->RowCount ?>_staffqualifications_prof_YearObtained">
<span<?php echo $staffqualifications_prof_grid->YearObtained->viewAttributes() ?>><?php echo $staffqualifications_prof_grid->YearObtained->getViewValue() ?></span>
</span>
<?php if (!$staffqualifications_prof->isConfirm()) { ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_YearObtained" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_YearObtained" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_YearObtained" value="<?php echo HtmlEncode($staffqualifications_prof_grid->YearObtained->FormValue) ?>">
<input type="hidden" data-table="staffqualifications_prof" data-field="x_YearObtained" name="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_YearObtained" id="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_YearObtained" value="<?php echo HtmlEncode($staffqualifications_prof_grid->YearObtained->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_YearObtained" name="fstaffqualifications_profgrid$x<?php echo $staffqualifications_prof_grid->RowIndex ?>_YearObtained" id="fstaffqualifications_profgrid$x<?php echo $staffqualifications_prof_grid->RowIndex ?>_YearObtained" value="<?php echo HtmlEncode($staffqualifications_prof_grid->YearObtained->FormValue) ?>">
<input type="hidden" data-table="staffqualifications_prof" data-field="x_YearObtained" name="fstaffqualifications_profgrid$o<?php echo $staffqualifications_prof_grid->RowIndex ?>_YearObtained" id="fstaffqualifications_profgrid$o<?php echo $staffqualifications_prof_grid->RowIndex ?>_YearObtained" value="<?php echo HtmlEncode($staffqualifications_prof_grid->YearObtained->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffqualifications_prof_grid->ListOptions->render("body", "right", $staffqualifications_prof_grid->RowCount);
?>
	</tr>
<?php if ($staffqualifications_prof->RowType == ROWTYPE_ADD || $staffqualifications_prof->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fstaffqualifications_profgrid", "load"], function() {
	fstaffqualifications_profgrid.updateLists(<?php echo $staffqualifications_prof_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$staffqualifications_prof_grid->isGridAdd() || $staffqualifications_prof->CurrentMode == "copy")
		if (!$staffqualifications_prof_grid->Recordset->EOF)
			$staffqualifications_prof_grid->Recordset->moveNext();
}
?>
<?php
	if ($staffqualifications_prof->CurrentMode == "add" || $staffqualifications_prof->CurrentMode == "copy" || $staffqualifications_prof->CurrentMode == "edit") {
		$staffqualifications_prof_grid->RowIndex = '$rowindex$';
		$staffqualifications_prof_grid->loadRowValues();

		// Set row properties
		$staffqualifications_prof->resetAttributes();
		$staffqualifications_prof->RowAttrs->merge(["data-rowindex" => $staffqualifications_prof_grid->RowIndex, "id" => "r0_staffqualifications_prof", "data-rowtype" => ROWTYPE_ADD]);
		$staffqualifications_prof->RowAttrs->appendClass("ew-template");
		$staffqualifications_prof->RowType = ROWTYPE_ADD;

		// Render row
		$staffqualifications_prof_grid->renderRow();

		// Render list options
		$staffqualifications_prof_grid->renderListOptions();
		$staffqualifications_prof_grid->StartRowCount = 0;
?>
	<tr <?php echo $staffqualifications_prof->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffqualifications_prof_grid->ListOptions->render("body", "left", $staffqualifications_prof_grid->RowIndex);
?>
	<?php if ($staffqualifications_prof_grid->ProfQualificationLevel->Visible) { // ProfQualificationLevel ?>
		<td data-name="ProfQualificationLevel">
<?php if (!$staffqualifications_prof->isConfirm()) { ?>
<span id="el$rowindex$_staffqualifications_prof_ProfQualificationLevel" class="form-group staffqualifications_prof_ProfQualificationLevel">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel"><?php echo EmptyValue(strval($staffqualifications_prof_grid->ProfQualificationLevel->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffqualifications_prof_grid->ProfQualificationLevel->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffqualifications_prof_grid->ProfQualificationLevel->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffqualifications_prof_grid->ProfQualificationLevel->ReadOnly || $staffqualifications_prof_grid->ProfQualificationLevel->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffqualifications_prof_grid->ProfQualificationLevel->Lookup->getParamTag($staffqualifications_prof_grid, "p_x" . $staffqualifications_prof_grid->RowIndex . "_ProfQualificationLevel") ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_ProfQualificationLevel" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffqualifications_prof_grid->ProfQualificationLevel->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel" value="<?php echo $staffqualifications_prof_grid->ProfQualificationLevel->CurrentValue ?>"<?php echo $staffqualifications_prof_grid->ProfQualificationLevel->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffqualifications_prof_ProfQualificationLevel" class="form-group staffqualifications_prof_ProfQualificationLevel">
<span<?php echo $staffqualifications_prof_grid->ProfQualificationLevel->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffqualifications_prof_grid->ProfQualificationLevel->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_ProfQualificationLevel" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel" value="<?php echo HtmlEncode($staffqualifications_prof_grid->ProfQualificationLevel->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_ProfQualificationLevel" name="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel" id="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_ProfQualificationLevel" value="<?php echo HtmlEncode($staffqualifications_prof_grid->ProfQualificationLevel->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffqualifications_prof_grid->QualificationCode->Visible) { // QualificationCode ?>
		<td data-name="QualificationCode">
<?php if (!$staffqualifications_prof->isConfirm()) { ?>
<span id="el$rowindex$_staffqualifications_prof_QualificationCode" class="form-group staffqualifications_prof_QualificationCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffqualifications_prof" data-field="x_QualificationCode" data-value-separator="<?php echo $staffqualifications_prof_grid->QualificationCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationCode" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationCode"<?php echo $staffqualifications_prof_grid->QualificationCode->editAttributes() ?>>
			<?php echo $staffqualifications_prof_grid->QualificationCode->selectOptionListHtml("x{$staffqualifications_prof_grid->RowIndex}_QualificationCode") ?>
		</select>
</div>
<?php echo $staffqualifications_prof_grid->QualificationCode->Lookup->getParamTag($staffqualifications_prof_grid, "p_x" . $staffqualifications_prof_grid->RowIndex . "_QualificationCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffqualifications_prof_QualificationCode" class="form-group staffqualifications_prof_QualificationCode">
<span<?php echo $staffqualifications_prof_grid->QualificationCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffqualifications_prof_grid->QualificationCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_QualificationCode" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationCode" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationCode" value="<?php echo HtmlEncode($staffqualifications_prof_grid->QualificationCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_QualificationCode" name="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationCode" id="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationCode" value="<?php echo HtmlEncode($staffqualifications_prof_grid->QualificationCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffqualifications_prof_grid->QualificationRemarks->Visible) { // QualificationRemarks ?>
		<td data-name="QualificationRemarks">
<?php if (!$staffqualifications_prof->isConfirm()) { ?>
<span id="el$rowindex$_staffqualifications_prof_QualificationRemarks" class="form-group staffqualifications_prof_QualificationRemarks">
<input type="text" data-table="staffqualifications_prof" data-field="x_QualificationRemarks" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationRemarks" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationRemarks" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_prof_grid->QualificationRemarks->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_prof_grid->QualificationRemarks->EditValue ?>"<?php echo $staffqualifications_prof_grid->QualificationRemarks->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffqualifications_prof_QualificationRemarks" class="form-group staffqualifications_prof_QualificationRemarks">
<span<?php echo $staffqualifications_prof_grid->QualificationRemarks->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffqualifications_prof_grid->QualificationRemarks->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_QualificationRemarks" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationRemarks" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationRemarks" value="<?php echo HtmlEncode($staffqualifications_prof_grid->QualificationRemarks->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_QualificationRemarks" name="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationRemarks" id="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_QualificationRemarks" value="<?php echo HtmlEncode($staffqualifications_prof_grid->QualificationRemarks->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffqualifications_prof_grid->AwardingInstitution->Visible) { // AwardingInstitution ?>
		<td data-name="AwardingInstitution">
<?php if (!$staffqualifications_prof->isConfirm()) { ?>
<span id="el$rowindex$_staffqualifications_prof_AwardingInstitution" class="form-group staffqualifications_prof_AwardingInstitution">
<input type="text" data-table="staffqualifications_prof" data-field="x_AwardingInstitution" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_AwardingInstitution" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_AwardingInstitution" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_prof_grid->AwardingInstitution->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_prof_grid->AwardingInstitution->EditValue ?>"<?php echo $staffqualifications_prof_grid->AwardingInstitution->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffqualifications_prof_AwardingInstitution" class="form-group staffqualifications_prof_AwardingInstitution">
<span<?php echo $staffqualifications_prof_grid->AwardingInstitution->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffqualifications_prof_grid->AwardingInstitution->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_AwardingInstitution" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_AwardingInstitution" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_AwardingInstitution" value="<?php echo HtmlEncode($staffqualifications_prof_grid->AwardingInstitution->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_AwardingInstitution" name="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_AwardingInstitution" id="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_AwardingInstitution" value="<?php echo HtmlEncode($staffqualifications_prof_grid->AwardingInstitution->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffqualifications_prof_grid->FromYear->Visible) { // FromYear ?>
		<td data-name="FromYear">
<?php if (!$staffqualifications_prof->isConfirm()) { ?>
<span id="el$rowindex$_staffqualifications_prof_FromYear" class="form-group staffqualifications_prof_FromYear">
<input type="text" data-table="staffqualifications_prof" data-field="x_FromYear" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_FromYear" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_FromYear" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_prof_grid->FromYear->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_prof_grid->FromYear->EditValue ?>"<?php echo $staffqualifications_prof_grid->FromYear->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffqualifications_prof_FromYear" class="form-group staffqualifications_prof_FromYear">
<span<?php echo $staffqualifications_prof_grid->FromYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffqualifications_prof_grid->FromYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_FromYear" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_FromYear" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_FromYear" value="<?php echo HtmlEncode($staffqualifications_prof_grid->FromYear->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_FromYear" name="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_FromYear" id="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_FromYear" value="<?php echo HtmlEncode($staffqualifications_prof_grid->FromYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffqualifications_prof_grid->YearObtained->Visible) { // YearObtained ?>
		<td data-name="YearObtained">
<?php if (!$staffqualifications_prof->isConfirm()) { ?>
<span id="el$rowindex$_staffqualifications_prof_YearObtained" class="form-group staffqualifications_prof_YearObtained">
<input type="text" data-table="staffqualifications_prof" data-field="x_YearObtained" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_YearObtained" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_YearObtained" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_prof_grid->YearObtained->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_prof_grid->YearObtained->EditValue ?>"<?php echo $staffqualifications_prof_grid->YearObtained->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffqualifications_prof_YearObtained" class="form-group staffqualifications_prof_YearObtained">
<span<?php echo $staffqualifications_prof_grid->YearObtained->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffqualifications_prof_grid->YearObtained->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_YearObtained" name="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_YearObtained" id="x<?php echo $staffqualifications_prof_grid->RowIndex ?>_YearObtained" value="<?php echo HtmlEncode($staffqualifications_prof_grid->YearObtained->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_YearObtained" name="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_YearObtained" id="o<?php echo $staffqualifications_prof_grid->RowIndex ?>_YearObtained" value="<?php echo HtmlEncode($staffqualifications_prof_grid->YearObtained->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffqualifications_prof_grid->ListOptions->render("body", "right", $staffqualifications_prof_grid->RowIndex);
?>
<script>
loadjs.ready(["fstaffqualifications_profgrid", "load"], function() {
	fstaffqualifications_profgrid.updateLists(<?php echo $staffqualifications_prof_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($staffqualifications_prof->CurrentMode == "add" || $staffqualifications_prof->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $staffqualifications_prof_grid->FormKeyCountName ?>" id="<?php echo $staffqualifications_prof_grid->FormKeyCountName ?>" value="<?php echo $staffqualifications_prof_grid->KeyCount ?>">
<?php echo $staffqualifications_prof_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($staffqualifications_prof->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $staffqualifications_prof_grid->FormKeyCountName ?>" id="<?php echo $staffqualifications_prof_grid->FormKeyCountName ?>" value="<?php echo $staffqualifications_prof_grid->KeyCount ?>">
<?php echo $staffqualifications_prof_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($staffqualifications_prof->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fstaffqualifications_profgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($staffqualifications_prof_grid->Recordset)
	$staffqualifications_prof_grid->Recordset->Close();
?>
<?php if ($staffqualifications_prof_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $staffqualifications_prof_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($staffqualifications_prof_grid->TotalRecords == 0 && !$staffqualifications_prof->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $staffqualifications_prof_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$staffqualifications_prof_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$staffqualifications_prof_grid->terminate();
?>