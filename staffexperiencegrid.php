<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($staffexperience_grid))
	$staffexperience_grid = new staffexperience_grid();

// Run the page
$staffexperience_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffexperience_grid->Page_Render();
?>
<?php if (!$staffexperience_grid->isExport()) { ?>
<script>
var fstaffexperiencegrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fstaffexperiencegrid = new ew.Form("fstaffexperiencegrid", "grid");
	fstaffexperiencegrid.formKeyCountName = '<?php echo $staffexperience_grid->FormKeyCountName ?>';

	// Validate form
	fstaffexperiencegrid.validate = function() {
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
			<?php if ($staffexperience_grid->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_grid->ProvinceCode->caption(), $staffexperience_grid->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffexperience_grid->LAcode->Required) { ?>
				elm = this.getElements("x" + infix + "_LAcode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_grid->LAcode->caption(), $staffexperience_grid->LAcode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffexperience_grid->PositionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_grid->PositionCode->caption(), $staffexperience_grid->PositionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffexperience_grid->FromDate->Required) { ?>
				elm = this.getElements("x" + infix + "_FromDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_grid->FromDate->caption(), $staffexperience_grid->FromDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FromDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffexperience_grid->FromDate->errorMessage()) ?>");
			<?php if ($staffexperience_grid->ExitDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ExitDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_grid->ExitDate->caption(), $staffexperience_grid->ExitDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ExitDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffexperience_grid->ExitDate->errorMessage()) ?>");
			<?php if ($staffexperience_grid->ReasonForExit->Required) { ?>
				elm = this.getElements("x" + infix + "_ReasonForExit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_grid->ReasonForExit->caption(), $staffexperience_grid->ReasonForExit->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffexperience_grid->RetirementType->Required) { ?>
				elm = this.getElements("x" + infix + "_RetirementType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_grid->RetirementType->caption(), $staffexperience_grid->RetirementType->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fstaffexperiencegrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ProvinceCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "LAcode", false)) return false;
		if (ew.valueChanged(fobj, infix, "PositionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "FromDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ExitDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ReasonForExit", false)) return false;
		if (ew.valueChanged(fobj, infix, "RetirementType", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fstaffexperiencegrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffexperiencegrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffexperiencegrid.lists["x_ProvinceCode"] = <?php echo $staffexperience_grid->ProvinceCode->Lookup->toClientList($staffexperience_grid) ?>;
	fstaffexperiencegrid.lists["x_ProvinceCode"].options = <?php echo JsonEncode($staffexperience_grid->ProvinceCode->lookupOptions()) ?>;
	fstaffexperiencegrid.lists["x_LAcode"] = <?php echo $staffexperience_grid->LAcode->Lookup->toClientList($staffexperience_grid) ?>;
	fstaffexperiencegrid.lists["x_LAcode"].options = <?php echo JsonEncode($staffexperience_grid->LAcode->lookupOptions()) ?>;
	fstaffexperiencegrid.lists["x_PositionCode"] = <?php echo $staffexperience_grid->PositionCode->Lookup->toClientList($staffexperience_grid) ?>;
	fstaffexperiencegrid.lists["x_PositionCode"].options = <?php echo JsonEncode($staffexperience_grid->PositionCode->lookupOptions()) ?>;
	fstaffexperiencegrid.lists["x_ReasonForExit"] = <?php echo $staffexperience_grid->ReasonForExit->Lookup->toClientList($staffexperience_grid) ?>;
	fstaffexperiencegrid.lists["x_ReasonForExit"].options = <?php echo JsonEncode($staffexperience_grid->ReasonForExit->lookupOptions()) ?>;
	fstaffexperiencegrid.lists["x_RetirementType"] = <?php echo $staffexperience_grid->RetirementType->Lookup->toClientList($staffexperience_grid) ?>;
	fstaffexperiencegrid.lists["x_RetirementType"].options = <?php echo JsonEncode($staffexperience_grid->RetirementType->lookupOptions()) ?>;
	loadjs.done("fstaffexperiencegrid");
});
</script>
<?php } ?>
<?php
$staffexperience_grid->renderOtherOptions();
?>
<?php if ($staffexperience_grid->TotalRecords > 0 || $staffexperience->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($staffexperience_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> staffexperience">
<?php if ($staffexperience_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $staffexperience_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fstaffexperiencegrid" class="ew-form ew-list-form form-inline">
<div id="gmp_staffexperience" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_staffexperiencegrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$staffexperience->RowType = ROWTYPE_HEADER;

// Render list options
$staffexperience_grid->renderListOptions();

// Render list options (header, left)
$staffexperience_grid->ListOptions->render("header", "left");
?>
<?php if ($staffexperience_grid->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($staffexperience_grid->SortUrl($staffexperience_grid->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $staffexperience_grid->ProvinceCode->headerCellClass() ?>"><div id="elh_staffexperience_ProvinceCode" class="staffexperience_ProvinceCode"><div class="ew-table-header-caption"><?php echo $staffexperience_grid->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $staffexperience_grid->ProvinceCode->headerCellClass() ?>"><div><div id="elh_staffexperience_ProvinceCode" class="staffexperience_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffexperience_grid->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffexperience_grid->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffexperience_grid->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffexperience_grid->LAcode->Visible) { // LAcode ?>
	<?php if ($staffexperience_grid->SortUrl($staffexperience_grid->LAcode) == "") { ?>
		<th data-name="LAcode" class="<?php echo $staffexperience_grid->LAcode->headerCellClass() ?>"><div id="elh_staffexperience_LAcode" class="staffexperience_LAcode"><div class="ew-table-header-caption"><?php echo $staffexperience_grid->LAcode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LAcode" class="<?php echo $staffexperience_grid->LAcode->headerCellClass() ?>"><div><div id="elh_staffexperience_LAcode" class="staffexperience_LAcode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffexperience_grid->LAcode->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffexperience_grid->LAcode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffexperience_grid->LAcode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffexperience_grid->PositionCode->Visible) { // PositionCode ?>
	<?php if ($staffexperience_grid->SortUrl($staffexperience_grid->PositionCode) == "") { ?>
		<th data-name="PositionCode" class="<?php echo $staffexperience_grid->PositionCode->headerCellClass() ?>"><div id="elh_staffexperience_PositionCode" class="staffexperience_PositionCode"><div class="ew-table-header-caption"><?php echo $staffexperience_grid->PositionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionCode" class="<?php echo $staffexperience_grid->PositionCode->headerCellClass() ?>"><div><div id="elh_staffexperience_PositionCode" class="staffexperience_PositionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffexperience_grid->PositionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffexperience_grid->PositionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffexperience_grid->PositionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffexperience_grid->FromDate->Visible) { // FromDate ?>
	<?php if ($staffexperience_grid->SortUrl($staffexperience_grid->FromDate) == "") { ?>
		<th data-name="FromDate" class="<?php echo $staffexperience_grid->FromDate->headerCellClass() ?>"><div id="elh_staffexperience_FromDate" class="staffexperience_FromDate"><div class="ew-table-header-caption"><?php echo $staffexperience_grid->FromDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FromDate" class="<?php echo $staffexperience_grid->FromDate->headerCellClass() ?>"><div><div id="elh_staffexperience_FromDate" class="staffexperience_FromDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffexperience_grid->FromDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffexperience_grid->FromDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffexperience_grid->FromDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffexperience_grid->ExitDate->Visible) { // ExitDate ?>
	<?php if ($staffexperience_grid->SortUrl($staffexperience_grid->ExitDate) == "") { ?>
		<th data-name="ExitDate" class="<?php echo $staffexperience_grid->ExitDate->headerCellClass() ?>"><div id="elh_staffexperience_ExitDate" class="staffexperience_ExitDate"><div class="ew-table-header-caption"><?php echo $staffexperience_grid->ExitDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExitDate" class="<?php echo $staffexperience_grid->ExitDate->headerCellClass() ?>"><div><div id="elh_staffexperience_ExitDate" class="staffexperience_ExitDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffexperience_grid->ExitDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffexperience_grid->ExitDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffexperience_grid->ExitDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffexperience_grid->ReasonForExit->Visible) { // ReasonForExit ?>
	<?php if ($staffexperience_grid->SortUrl($staffexperience_grid->ReasonForExit) == "") { ?>
		<th data-name="ReasonForExit" class="<?php echo $staffexperience_grid->ReasonForExit->headerCellClass() ?>"><div id="elh_staffexperience_ReasonForExit" class="staffexperience_ReasonForExit"><div class="ew-table-header-caption"><?php echo $staffexperience_grid->ReasonForExit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReasonForExit" class="<?php echo $staffexperience_grid->ReasonForExit->headerCellClass() ?>"><div><div id="elh_staffexperience_ReasonForExit" class="staffexperience_ReasonForExit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffexperience_grid->ReasonForExit->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffexperience_grid->ReasonForExit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffexperience_grid->ReasonForExit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffexperience_grid->RetirementType->Visible) { // RetirementType ?>
	<?php if ($staffexperience_grid->SortUrl($staffexperience_grid->RetirementType) == "") { ?>
		<th data-name="RetirementType" class="<?php echo $staffexperience_grid->RetirementType->headerCellClass() ?>"><div id="elh_staffexperience_RetirementType" class="staffexperience_RetirementType"><div class="ew-table-header-caption"><?php echo $staffexperience_grid->RetirementType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RetirementType" class="<?php echo $staffexperience_grid->RetirementType->headerCellClass() ?>"><div><div id="elh_staffexperience_RetirementType" class="staffexperience_RetirementType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffexperience_grid->RetirementType->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffexperience_grid->RetirementType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffexperience_grid->RetirementType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$staffexperience_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$staffexperience_grid->StartRecord = 1;
$staffexperience_grid->StopRecord = $staffexperience_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($staffexperience->isConfirm() || $staffexperience_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($staffexperience_grid->FormKeyCountName) && ($staffexperience_grid->isGridAdd() || $staffexperience_grid->isGridEdit() || $staffexperience->isConfirm())) {
		$staffexperience_grid->KeyCount = $CurrentForm->getValue($staffexperience_grid->FormKeyCountName);
		$staffexperience_grid->StopRecord = $staffexperience_grid->StartRecord + $staffexperience_grid->KeyCount - 1;
	}
}
$staffexperience_grid->RecordCount = $staffexperience_grid->StartRecord - 1;
if ($staffexperience_grid->Recordset && !$staffexperience_grid->Recordset->EOF) {
	$staffexperience_grid->Recordset->moveFirst();
	$selectLimit = $staffexperience_grid->UseSelectLimit;
	if (!$selectLimit && $staffexperience_grid->StartRecord > 1)
		$staffexperience_grid->Recordset->move($staffexperience_grid->StartRecord - 1);
} elseif (!$staffexperience->AllowAddDeleteRow && $staffexperience_grid->StopRecord == 0) {
	$staffexperience_grid->StopRecord = $staffexperience->GridAddRowCount;
}

// Initialize aggregate
$staffexperience->RowType = ROWTYPE_AGGREGATEINIT;
$staffexperience->resetAttributes();
$staffexperience_grid->renderRow();
if ($staffexperience_grid->isGridAdd())
	$staffexperience_grid->RowIndex = 0;
if ($staffexperience_grid->isGridEdit())
	$staffexperience_grid->RowIndex = 0;
while ($staffexperience_grid->RecordCount < $staffexperience_grid->StopRecord) {
	$staffexperience_grid->RecordCount++;
	if ($staffexperience_grid->RecordCount >= $staffexperience_grid->StartRecord) {
		$staffexperience_grid->RowCount++;
		if ($staffexperience_grid->isGridAdd() || $staffexperience_grid->isGridEdit() || $staffexperience->isConfirm()) {
			$staffexperience_grid->RowIndex++;
			$CurrentForm->Index = $staffexperience_grid->RowIndex;
			if ($CurrentForm->hasValue($staffexperience_grid->FormActionName) && ($staffexperience->isConfirm() || $staffexperience_grid->EventCancelled))
				$staffexperience_grid->RowAction = strval($CurrentForm->getValue($staffexperience_grid->FormActionName));
			elseif ($staffexperience_grid->isGridAdd())
				$staffexperience_grid->RowAction = "insert";
			else
				$staffexperience_grid->RowAction = "";
		}

		// Set up key count
		$staffexperience_grid->KeyCount = $staffexperience_grid->RowIndex;

		// Init row class and style
		$staffexperience->resetAttributes();
		$staffexperience->CssClass = "";
		if ($staffexperience_grid->isGridAdd()) {
			if ($staffexperience->CurrentMode == "copy") {
				$staffexperience_grid->loadRowValues($staffexperience_grid->Recordset); // Load row values
				$staffexperience_grid->setRecordKey($staffexperience_grid->RowOldKey, $staffexperience_grid->Recordset); // Set old record key
			} else {
				$staffexperience_grid->loadRowValues(); // Load default values
				$staffexperience_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$staffexperience_grid->loadRowValues($staffexperience_grid->Recordset); // Load row values
		}
		$staffexperience->RowType = ROWTYPE_VIEW; // Render view
		if ($staffexperience_grid->isGridAdd()) // Grid add
			$staffexperience->RowType = ROWTYPE_ADD; // Render add
		if ($staffexperience_grid->isGridAdd() && $staffexperience->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$staffexperience_grid->restoreCurrentRowFormValues($staffexperience_grid->RowIndex); // Restore form values
		if ($staffexperience_grid->isGridEdit()) { // Grid edit
			if ($staffexperience->EventCancelled)
				$staffexperience_grid->restoreCurrentRowFormValues($staffexperience_grid->RowIndex); // Restore form values
			if ($staffexperience_grid->RowAction == "insert")
				$staffexperience->RowType = ROWTYPE_ADD; // Render add
			else
				$staffexperience->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($staffexperience_grid->isGridEdit() && ($staffexperience->RowType == ROWTYPE_EDIT || $staffexperience->RowType == ROWTYPE_ADD) && $staffexperience->EventCancelled) // Update failed
			$staffexperience_grid->restoreCurrentRowFormValues($staffexperience_grid->RowIndex); // Restore form values
		if ($staffexperience->RowType == ROWTYPE_EDIT) // Edit row
			$staffexperience_grid->EditRowCount++;
		if ($staffexperience->isConfirm()) // Confirm row
			$staffexperience_grid->restoreCurrentRowFormValues($staffexperience_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$staffexperience->RowAttrs->merge(["data-rowindex" => $staffexperience_grid->RowCount, "id" => "r" . $staffexperience_grid->RowCount . "_staffexperience", "data-rowtype" => $staffexperience->RowType]);

		// Render row
		$staffexperience_grid->renderRow();

		// Render list options
		$staffexperience_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($staffexperience_grid->RowAction != "delete" && $staffexperience_grid->RowAction != "insertdelete" && !($staffexperience_grid->RowAction == "insert" && $staffexperience->isConfirm() && $staffexperience_grid->emptyRow())) {
?>
	<tr <?php echo $staffexperience->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffexperience_grid->ListOptions->render("body", "left", $staffexperience_grid->RowCount);
?>
	<?php if ($staffexperience_grid->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $staffexperience_grid->ProvinceCode->cellAttributes() ?>>
<?php if ($staffexperience->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffexperience_grid->RowCount ?>_staffexperience_ProvinceCode" class="form-group">
<?php $staffexperience_grid->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_ProvinceCode" data-value-separator="<?php echo $staffexperience_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffexperience_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $staffexperience_grid->RowIndex ?>_ProvinceCode"<?php echo $staffexperience_grid->ProvinceCode->editAttributes() ?>>
			<?php echo $staffexperience_grid->ProvinceCode->selectOptionListHtml("x{$staffexperience_grid->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $staffexperience_grid->ProvinceCode->Lookup->getParamTag($staffexperience_grid, "p_x" . $staffexperience_grid->RowIndex . "_ProvinceCode") ?>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_ProvinceCode" name="o<?php echo $staffexperience_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $staffexperience_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($staffexperience_grid->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffexperience_grid->RowCount ?>_staffexperience_ProvinceCode" class="form-group">
<?php $staffexperience_grid->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_ProvinceCode" data-value-separator="<?php echo $staffexperience_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffexperience_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $staffexperience_grid->RowIndex ?>_ProvinceCode"<?php echo $staffexperience_grid->ProvinceCode->editAttributes() ?>>
			<?php echo $staffexperience_grid->ProvinceCode->selectOptionListHtml("x{$staffexperience_grid->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $staffexperience_grid->ProvinceCode->Lookup->getParamTag($staffexperience_grid, "p_x" . $staffexperience_grid->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffexperience_grid->RowCount ?>_staffexperience_ProvinceCode">
<span<?php echo $staffexperience_grid->ProvinceCode->viewAttributes() ?>><?php echo $staffexperience_grid->ProvinceCode->getViewValue() ?></span>
</span>
<?php if (!$staffexperience->isConfirm()) { ?>
<input type="hidden" data-table="staffexperience" data-field="x_ProvinceCode" name="x<?php echo $staffexperience_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $staffexperience_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($staffexperience_grid->ProvinceCode->FormValue) ?>">
<input type="hidden" data-table="staffexperience" data-field="x_ProvinceCode" name="o<?php echo $staffexperience_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $staffexperience_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($staffexperience_grid->ProvinceCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffexperience" data-field="x_ProvinceCode" name="fstaffexperiencegrid$x<?php echo $staffexperience_grid->RowIndex ?>_ProvinceCode" id="fstaffexperiencegrid$x<?php echo $staffexperience_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($staffexperience_grid->ProvinceCode->FormValue) ?>">
<input type="hidden" data-table="staffexperience" data-field="x_ProvinceCode" name="fstaffexperiencegrid$o<?php echo $staffexperience_grid->RowIndex ?>_ProvinceCode" id="fstaffexperiencegrid$o<?php echo $staffexperience_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($staffexperience_grid->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="staffexperience" data-field="x_EmployeeID" name="x<?php echo $staffexperience_grid->RowIndex ?>_EmployeeID" id="x<?php echo $staffexperience_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffexperience_grid->EmployeeID->CurrentValue) ?>">
<input type="hidden" data-table="staffexperience" data-field="x_EmployeeID" name="o<?php echo $staffexperience_grid->RowIndex ?>_EmployeeID" id="o<?php echo $staffexperience_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffexperience_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_EDIT || $staffexperience->CurrentMode == "edit") { ?>
<input type="hidden" data-table="staffexperience" data-field="x_EmployeeID" name="x<?php echo $staffexperience_grid->RowIndex ?>_EmployeeID" id="x<?php echo $staffexperience_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffexperience_grid->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="staffexperience" data-field="x_IndexNo" name="x<?php echo $staffexperience_grid->RowIndex ?>_IndexNo" id="x<?php echo $staffexperience_grid->RowIndex ?>_IndexNo" value="<?php echo HtmlEncode($staffexperience_grid->IndexNo->CurrentValue) ?>">
<input type="hidden" data-table="staffexperience" data-field="x_IndexNo" name="o<?php echo $staffexperience_grid->RowIndex ?>_IndexNo" id="o<?php echo $staffexperience_grid->RowIndex ?>_IndexNo" value="<?php echo HtmlEncode($staffexperience_grid->IndexNo->OldValue) ?>">
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_EDIT || $staffexperience->CurrentMode == "edit") { ?>
<input type="hidden" data-table="staffexperience" data-field="x_IndexNo" name="x<?php echo $staffexperience_grid->RowIndex ?>_IndexNo" id="x<?php echo $staffexperience_grid->RowIndex ?>_IndexNo" value="<?php echo HtmlEncode($staffexperience_grid->IndexNo->CurrentValue) ?>">
<?php } ?>
	<?php if ($staffexperience_grid->LAcode->Visible) { // LAcode ?>
		<td data-name="LAcode" <?php echo $staffexperience_grid->LAcode->cellAttributes() ?>>
<?php if ($staffexperience->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffexperience_grid->RowCount ?>_staffexperience_LAcode" class="form-group">
<?php $staffexperience_grid->LAcode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffexperience_grid->RowIndex ?>_LAcode"><?php echo EmptyValue(strval($staffexperience_grid->LAcode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffexperience_grid->LAcode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffexperience_grid->LAcode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffexperience_grid->LAcode->ReadOnly || $staffexperience_grid->LAcode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffexperience_grid->RowIndex ?>_LAcode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffexperience_grid->LAcode->Lookup->getParamTag($staffexperience_grid, "p_x" . $staffexperience_grid->RowIndex . "_LAcode") ?>
<input type="hidden" data-table="staffexperience" data-field="x_LAcode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffexperience_grid->LAcode->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffexperience_grid->RowIndex ?>_LAcode" id="x<?php echo $staffexperience_grid->RowIndex ?>_LAcode" value="<?php echo $staffexperience_grid->LAcode->CurrentValue ?>"<?php echo $staffexperience_grid->LAcode->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_LAcode" name="o<?php echo $staffexperience_grid->RowIndex ?>_LAcode" id="o<?php echo $staffexperience_grid->RowIndex ?>_LAcode" value="<?php echo HtmlEncode($staffexperience_grid->LAcode->OldValue) ?>">
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffexperience_grid->RowCount ?>_staffexperience_LAcode" class="form-group">
<?php $staffexperience_grid->LAcode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffexperience_grid->RowIndex ?>_LAcode"><?php echo EmptyValue(strval($staffexperience_grid->LAcode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffexperience_grid->LAcode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffexperience_grid->LAcode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffexperience_grid->LAcode->ReadOnly || $staffexperience_grid->LAcode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffexperience_grid->RowIndex ?>_LAcode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffexperience_grid->LAcode->Lookup->getParamTag($staffexperience_grid, "p_x" . $staffexperience_grid->RowIndex . "_LAcode") ?>
<input type="hidden" data-table="staffexperience" data-field="x_LAcode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffexperience_grid->LAcode->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffexperience_grid->RowIndex ?>_LAcode" id="x<?php echo $staffexperience_grid->RowIndex ?>_LAcode" value="<?php echo $staffexperience_grid->LAcode->CurrentValue ?>"<?php echo $staffexperience_grid->LAcode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffexperience_grid->RowCount ?>_staffexperience_LAcode">
<span<?php echo $staffexperience_grid->LAcode->viewAttributes() ?>><?php echo $staffexperience_grid->LAcode->getViewValue() ?></span>
</span>
<?php if (!$staffexperience->isConfirm()) { ?>
<input type="hidden" data-table="staffexperience" data-field="x_LAcode" name="x<?php echo $staffexperience_grid->RowIndex ?>_LAcode" id="x<?php echo $staffexperience_grid->RowIndex ?>_LAcode" value="<?php echo HtmlEncode($staffexperience_grid->LAcode->FormValue) ?>">
<input type="hidden" data-table="staffexperience" data-field="x_LAcode" name="o<?php echo $staffexperience_grid->RowIndex ?>_LAcode" id="o<?php echo $staffexperience_grid->RowIndex ?>_LAcode" value="<?php echo HtmlEncode($staffexperience_grid->LAcode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffexperience" data-field="x_LAcode" name="fstaffexperiencegrid$x<?php echo $staffexperience_grid->RowIndex ?>_LAcode" id="fstaffexperiencegrid$x<?php echo $staffexperience_grid->RowIndex ?>_LAcode" value="<?php echo HtmlEncode($staffexperience_grid->LAcode->FormValue) ?>">
<input type="hidden" data-table="staffexperience" data-field="x_LAcode" name="fstaffexperiencegrid$o<?php echo $staffexperience_grid->RowIndex ?>_LAcode" id="fstaffexperiencegrid$o<?php echo $staffexperience_grid->RowIndex ?>_LAcode" value="<?php echo HtmlEncode($staffexperience_grid->LAcode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffexperience_grid->PositionCode->Visible) { // PositionCode ?>
		<td data-name="PositionCode" <?php echo $staffexperience_grid->PositionCode->cellAttributes() ?>>
<?php if ($staffexperience->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffexperience_grid->RowCount ?>_staffexperience_PositionCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffexperience_grid->RowIndex ?>_PositionCode"><?php echo EmptyValue(strval($staffexperience_grid->PositionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffexperience_grid->PositionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffexperience_grid->PositionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffexperience_grid->PositionCode->ReadOnly || $staffexperience_grid->PositionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffexperience_grid->RowIndex ?>_PositionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffexperience_grid->PositionCode->Lookup->getParamTag($staffexperience_grid, "p_x" . $staffexperience_grid->RowIndex . "_PositionCode") ?>
<input type="hidden" data-table="staffexperience" data-field="x_PositionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffexperience_grid->PositionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffexperience_grid->RowIndex ?>_PositionCode" id="x<?php echo $staffexperience_grid->RowIndex ?>_PositionCode" value="<?php echo $staffexperience_grid->PositionCode->CurrentValue ?>"<?php echo $staffexperience_grid->PositionCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_PositionCode" name="o<?php echo $staffexperience_grid->RowIndex ?>_PositionCode" id="o<?php echo $staffexperience_grid->RowIndex ?>_PositionCode" value="<?php echo HtmlEncode($staffexperience_grid->PositionCode->OldValue) ?>">
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffexperience_grid->RowCount ?>_staffexperience_PositionCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffexperience_grid->RowIndex ?>_PositionCode"><?php echo EmptyValue(strval($staffexperience_grid->PositionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffexperience_grid->PositionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffexperience_grid->PositionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffexperience_grid->PositionCode->ReadOnly || $staffexperience_grid->PositionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffexperience_grid->RowIndex ?>_PositionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffexperience_grid->PositionCode->Lookup->getParamTag($staffexperience_grid, "p_x" . $staffexperience_grid->RowIndex . "_PositionCode") ?>
<input type="hidden" data-table="staffexperience" data-field="x_PositionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffexperience_grid->PositionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffexperience_grid->RowIndex ?>_PositionCode" id="x<?php echo $staffexperience_grid->RowIndex ?>_PositionCode" value="<?php echo $staffexperience_grid->PositionCode->CurrentValue ?>"<?php echo $staffexperience_grid->PositionCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffexperience_grid->RowCount ?>_staffexperience_PositionCode">
<span<?php echo $staffexperience_grid->PositionCode->viewAttributes() ?>><?php echo $staffexperience_grid->PositionCode->getViewValue() ?></span>
</span>
<?php if (!$staffexperience->isConfirm()) { ?>
<input type="hidden" data-table="staffexperience" data-field="x_PositionCode" name="x<?php echo $staffexperience_grid->RowIndex ?>_PositionCode" id="x<?php echo $staffexperience_grid->RowIndex ?>_PositionCode" value="<?php echo HtmlEncode($staffexperience_grid->PositionCode->FormValue) ?>">
<input type="hidden" data-table="staffexperience" data-field="x_PositionCode" name="o<?php echo $staffexperience_grid->RowIndex ?>_PositionCode" id="o<?php echo $staffexperience_grid->RowIndex ?>_PositionCode" value="<?php echo HtmlEncode($staffexperience_grid->PositionCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffexperience" data-field="x_PositionCode" name="fstaffexperiencegrid$x<?php echo $staffexperience_grid->RowIndex ?>_PositionCode" id="fstaffexperiencegrid$x<?php echo $staffexperience_grid->RowIndex ?>_PositionCode" value="<?php echo HtmlEncode($staffexperience_grid->PositionCode->FormValue) ?>">
<input type="hidden" data-table="staffexperience" data-field="x_PositionCode" name="fstaffexperiencegrid$o<?php echo $staffexperience_grid->RowIndex ?>_PositionCode" id="fstaffexperiencegrid$o<?php echo $staffexperience_grid->RowIndex ?>_PositionCode" value="<?php echo HtmlEncode($staffexperience_grid->PositionCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffexperience_grid->FromDate->Visible) { // FromDate ?>
		<td data-name="FromDate" <?php echo $staffexperience_grid->FromDate->cellAttributes() ?>>
<?php if ($staffexperience->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffexperience_grid->RowCount ?>_staffexperience_FromDate" class="form-group">
<input type="text" data-table="staffexperience" data-field="x_FromDate" name="x<?php echo $staffexperience_grid->RowIndex ?>_FromDate" id="x<?php echo $staffexperience_grid->RowIndex ?>_FromDate" placeholder="<?php echo HtmlEncode($staffexperience_grid->FromDate->getPlaceHolder()) ?>" value="<?php echo $staffexperience_grid->FromDate->EditValue ?>"<?php echo $staffexperience_grid->FromDate->editAttributes() ?>>
<?php if (!$staffexperience_grid->FromDate->ReadOnly && !$staffexperience_grid->FromDate->Disabled && !isset($staffexperience_grid->FromDate->EditAttrs["readonly"]) && !isset($staffexperience_grid->FromDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffexperiencegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffexperiencegrid", "x<?php echo $staffexperience_grid->RowIndex ?>_FromDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_FromDate" name="o<?php echo $staffexperience_grid->RowIndex ?>_FromDate" id="o<?php echo $staffexperience_grid->RowIndex ?>_FromDate" value="<?php echo HtmlEncode($staffexperience_grid->FromDate->OldValue) ?>">
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffexperience_grid->RowCount ?>_staffexperience_FromDate" class="form-group">
<input type="text" data-table="staffexperience" data-field="x_FromDate" name="x<?php echo $staffexperience_grid->RowIndex ?>_FromDate" id="x<?php echo $staffexperience_grid->RowIndex ?>_FromDate" placeholder="<?php echo HtmlEncode($staffexperience_grid->FromDate->getPlaceHolder()) ?>" value="<?php echo $staffexperience_grid->FromDate->EditValue ?>"<?php echo $staffexperience_grid->FromDate->editAttributes() ?>>
<?php if (!$staffexperience_grid->FromDate->ReadOnly && !$staffexperience_grid->FromDate->Disabled && !isset($staffexperience_grid->FromDate->EditAttrs["readonly"]) && !isset($staffexperience_grid->FromDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffexperiencegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffexperiencegrid", "x<?php echo $staffexperience_grid->RowIndex ?>_FromDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffexperience_grid->RowCount ?>_staffexperience_FromDate">
<span<?php echo $staffexperience_grid->FromDate->viewAttributes() ?>><?php echo $staffexperience_grid->FromDate->getViewValue() ?></span>
</span>
<?php if (!$staffexperience->isConfirm()) { ?>
<input type="hidden" data-table="staffexperience" data-field="x_FromDate" name="x<?php echo $staffexperience_grid->RowIndex ?>_FromDate" id="x<?php echo $staffexperience_grid->RowIndex ?>_FromDate" value="<?php echo HtmlEncode($staffexperience_grid->FromDate->FormValue) ?>">
<input type="hidden" data-table="staffexperience" data-field="x_FromDate" name="o<?php echo $staffexperience_grid->RowIndex ?>_FromDate" id="o<?php echo $staffexperience_grid->RowIndex ?>_FromDate" value="<?php echo HtmlEncode($staffexperience_grid->FromDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffexperience" data-field="x_FromDate" name="fstaffexperiencegrid$x<?php echo $staffexperience_grid->RowIndex ?>_FromDate" id="fstaffexperiencegrid$x<?php echo $staffexperience_grid->RowIndex ?>_FromDate" value="<?php echo HtmlEncode($staffexperience_grid->FromDate->FormValue) ?>">
<input type="hidden" data-table="staffexperience" data-field="x_FromDate" name="fstaffexperiencegrid$o<?php echo $staffexperience_grid->RowIndex ?>_FromDate" id="fstaffexperiencegrid$o<?php echo $staffexperience_grid->RowIndex ?>_FromDate" value="<?php echo HtmlEncode($staffexperience_grid->FromDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffexperience_grid->ExitDate->Visible) { // ExitDate ?>
		<td data-name="ExitDate" <?php echo $staffexperience_grid->ExitDate->cellAttributes() ?>>
<?php if ($staffexperience->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffexperience_grid->RowCount ?>_staffexperience_ExitDate" class="form-group">
<input type="text" data-table="staffexperience" data-field="x_ExitDate" name="x<?php echo $staffexperience_grid->RowIndex ?>_ExitDate" id="x<?php echo $staffexperience_grid->RowIndex ?>_ExitDate" placeholder="<?php echo HtmlEncode($staffexperience_grid->ExitDate->getPlaceHolder()) ?>" value="<?php echo $staffexperience_grid->ExitDate->EditValue ?>"<?php echo $staffexperience_grid->ExitDate->editAttributes() ?>>
<?php if (!$staffexperience_grid->ExitDate->ReadOnly && !$staffexperience_grid->ExitDate->Disabled && !isset($staffexperience_grid->ExitDate->EditAttrs["readonly"]) && !isset($staffexperience_grid->ExitDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffexperiencegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffexperiencegrid", "x<?php echo $staffexperience_grid->RowIndex ?>_ExitDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_ExitDate" name="o<?php echo $staffexperience_grid->RowIndex ?>_ExitDate" id="o<?php echo $staffexperience_grid->RowIndex ?>_ExitDate" value="<?php echo HtmlEncode($staffexperience_grid->ExitDate->OldValue) ?>">
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffexperience_grid->RowCount ?>_staffexperience_ExitDate" class="form-group">
<input type="text" data-table="staffexperience" data-field="x_ExitDate" name="x<?php echo $staffexperience_grid->RowIndex ?>_ExitDate" id="x<?php echo $staffexperience_grid->RowIndex ?>_ExitDate" placeholder="<?php echo HtmlEncode($staffexperience_grid->ExitDate->getPlaceHolder()) ?>" value="<?php echo $staffexperience_grid->ExitDate->EditValue ?>"<?php echo $staffexperience_grid->ExitDate->editAttributes() ?>>
<?php if (!$staffexperience_grid->ExitDate->ReadOnly && !$staffexperience_grid->ExitDate->Disabled && !isset($staffexperience_grid->ExitDate->EditAttrs["readonly"]) && !isset($staffexperience_grid->ExitDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffexperiencegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffexperiencegrid", "x<?php echo $staffexperience_grid->RowIndex ?>_ExitDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffexperience_grid->RowCount ?>_staffexperience_ExitDate">
<span<?php echo $staffexperience_grid->ExitDate->viewAttributes() ?>><?php echo $staffexperience_grid->ExitDate->getViewValue() ?></span>
</span>
<?php if (!$staffexperience->isConfirm()) { ?>
<input type="hidden" data-table="staffexperience" data-field="x_ExitDate" name="x<?php echo $staffexperience_grid->RowIndex ?>_ExitDate" id="x<?php echo $staffexperience_grid->RowIndex ?>_ExitDate" value="<?php echo HtmlEncode($staffexperience_grid->ExitDate->FormValue) ?>">
<input type="hidden" data-table="staffexperience" data-field="x_ExitDate" name="o<?php echo $staffexperience_grid->RowIndex ?>_ExitDate" id="o<?php echo $staffexperience_grid->RowIndex ?>_ExitDate" value="<?php echo HtmlEncode($staffexperience_grid->ExitDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffexperience" data-field="x_ExitDate" name="fstaffexperiencegrid$x<?php echo $staffexperience_grid->RowIndex ?>_ExitDate" id="fstaffexperiencegrid$x<?php echo $staffexperience_grid->RowIndex ?>_ExitDate" value="<?php echo HtmlEncode($staffexperience_grid->ExitDate->FormValue) ?>">
<input type="hidden" data-table="staffexperience" data-field="x_ExitDate" name="fstaffexperiencegrid$o<?php echo $staffexperience_grid->RowIndex ?>_ExitDate" id="fstaffexperiencegrid$o<?php echo $staffexperience_grid->RowIndex ?>_ExitDate" value="<?php echo HtmlEncode($staffexperience_grid->ExitDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffexperience_grid->ReasonForExit->Visible) { // ReasonForExit ?>
		<td data-name="ReasonForExit" <?php echo $staffexperience_grid->ReasonForExit->cellAttributes() ?>>
<?php if ($staffexperience->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffexperience_grid->RowCount ?>_staffexperience_ReasonForExit" class="form-group">
<?php $staffexperience_grid->ReasonForExit->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_ReasonForExit" data-value-separator="<?php echo $staffexperience_grid->ReasonForExit->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffexperience_grid->RowIndex ?>_ReasonForExit" name="x<?php echo $staffexperience_grid->RowIndex ?>_ReasonForExit"<?php echo $staffexperience_grid->ReasonForExit->editAttributes() ?>>
			<?php echo $staffexperience_grid->ReasonForExit->selectOptionListHtml("x{$staffexperience_grid->RowIndex}_ReasonForExit") ?>
		</select>
</div>
<?php echo $staffexperience_grid->ReasonForExit->Lookup->getParamTag($staffexperience_grid, "p_x" . $staffexperience_grid->RowIndex . "_ReasonForExit") ?>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_ReasonForExit" name="o<?php echo $staffexperience_grid->RowIndex ?>_ReasonForExit" id="o<?php echo $staffexperience_grid->RowIndex ?>_ReasonForExit" value="<?php echo HtmlEncode($staffexperience_grid->ReasonForExit->OldValue) ?>">
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffexperience_grid->RowCount ?>_staffexperience_ReasonForExit" class="form-group">
<?php $staffexperience_grid->ReasonForExit->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_ReasonForExit" data-value-separator="<?php echo $staffexperience_grid->ReasonForExit->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffexperience_grid->RowIndex ?>_ReasonForExit" name="x<?php echo $staffexperience_grid->RowIndex ?>_ReasonForExit"<?php echo $staffexperience_grid->ReasonForExit->editAttributes() ?>>
			<?php echo $staffexperience_grid->ReasonForExit->selectOptionListHtml("x{$staffexperience_grid->RowIndex}_ReasonForExit") ?>
		</select>
</div>
<?php echo $staffexperience_grid->ReasonForExit->Lookup->getParamTag($staffexperience_grid, "p_x" . $staffexperience_grid->RowIndex . "_ReasonForExit") ?>
</span>
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffexperience_grid->RowCount ?>_staffexperience_ReasonForExit">
<span<?php echo $staffexperience_grid->ReasonForExit->viewAttributes() ?>><?php echo $staffexperience_grid->ReasonForExit->getViewValue() ?></span>
</span>
<?php if (!$staffexperience->isConfirm()) { ?>
<input type="hidden" data-table="staffexperience" data-field="x_ReasonForExit" name="x<?php echo $staffexperience_grid->RowIndex ?>_ReasonForExit" id="x<?php echo $staffexperience_grid->RowIndex ?>_ReasonForExit" value="<?php echo HtmlEncode($staffexperience_grid->ReasonForExit->FormValue) ?>">
<input type="hidden" data-table="staffexperience" data-field="x_ReasonForExit" name="o<?php echo $staffexperience_grid->RowIndex ?>_ReasonForExit" id="o<?php echo $staffexperience_grid->RowIndex ?>_ReasonForExit" value="<?php echo HtmlEncode($staffexperience_grid->ReasonForExit->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffexperience" data-field="x_ReasonForExit" name="fstaffexperiencegrid$x<?php echo $staffexperience_grid->RowIndex ?>_ReasonForExit" id="fstaffexperiencegrid$x<?php echo $staffexperience_grid->RowIndex ?>_ReasonForExit" value="<?php echo HtmlEncode($staffexperience_grid->ReasonForExit->FormValue) ?>">
<input type="hidden" data-table="staffexperience" data-field="x_ReasonForExit" name="fstaffexperiencegrid$o<?php echo $staffexperience_grid->RowIndex ?>_ReasonForExit" id="fstaffexperiencegrid$o<?php echo $staffexperience_grid->RowIndex ?>_ReasonForExit" value="<?php echo HtmlEncode($staffexperience_grid->ReasonForExit->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffexperience_grid->RetirementType->Visible) { // RetirementType ?>
		<td data-name="RetirementType" <?php echo $staffexperience_grid->RetirementType->cellAttributes() ?>>
<?php if ($staffexperience->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffexperience_grid->RowCount ?>_staffexperience_RetirementType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_RetirementType" data-value-separator="<?php echo $staffexperience_grid->RetirementType->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffexperience_grid->RowIndex ?>_RetirementType" name="x<?php echo $staffexperience_grid->RowIndex ?>_RetirementType"<?php echo $staffexperience_grid->RetirementType->editAttributes() ?>>
			<?php echo $staffexperience_grid->RetirementType->selectOptionListHtml("x{$staffexperience_grid->RowIndex}_RetirementType") ?>
		</select>
</div>
<?php echo $staffexperience_grid->RetirementType->Lookup->getParamTag($staffexperience_grid, "p_x" . $staffexperience_grid->RowIndex . "_RetirementType") ?>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_RetirementType" name="o<?php echo $staffexperience_grid->RowIndex ?>_RetirementType" id="o<?php echo $staffexperience_grid->RowIndex ?>_RetirementType" value="<?php echo HtmlEncode($staffexperience_grid->RetirementType->OldValue) ?>">
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffexperience_grid->RowCount ?>_staffexperience_RetirementType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_RetirementType" data-value-separator="<?php echo $staffexperience_grid->RetirementType->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffexperience_grid->RowIndex ?>_RetirementType" name="x<?php echo $staffexperience_grid->RowIndex ?>_RetirementType"<?php echo $staffexperience_grid->RetirementType->editAttributes() ?>>
			<?php echo $staffexperience_grid->RetirementType->selectOptionListHtml("x{$staffexperience_grid->RowIndex}_RetirementType") ?>
		</select>
</div>
<?php echo $staffexperience_grid->RetirementType->Lookup->getParamTag($staffexperience_grid, "p_x" . $staffexperience_grid->RowIndex . "_RetirementType") ?>
</span>
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffexperience_grid->RowCount ?>_staffexperience_RetirementType">
<span<?php echo $staffexperience_grid->RetirementType->viewAttributes() ?>><?php echo $staffexperience_grid->RetirementType->getViewValue() ?></span>
</span>
<?php if (!$staffexperience->isConfirm()) { ?>
<input type="hidden" data-table="staffexperience" data-field="x_RetirementType" name="x<?php echo $staffexperience_grid->RowIndex ?>_RetirementType" id="x<?php echo $staffexperience_grid->RowIndex ?>_RetirementType" value="<?php echo HtmlEncode($staffexperience_grid->RetirementType->FormValue) ?>">
<input type="hidden" data-table="staffexperience" data-field="x_RetirementType" name="o<?php echo $staffexperience_grid->RowIndex ?>_RetirementType" id="o<?php echo $staffexperience_grid->RowIndex ?>_RetirementType" value="<?php echo HtmlEncode($staffexperience_grid->RetirementType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffexperience" data-field="x_RetirementType" name="fstaffexperiencegrid$x<?php echo $staffexperience_grid->RowIndex ?>_RetirementType" id="fstaffexperiencegrid$x<?php echo $staffexperience_grid->RowIndex ?>_RetirementType" value="<?php echo HtmlEncode($staffexperience_grid->RetirementType->FormValue) ?>">
<input type="hidden" data-table="staffexperience" data-field="x_RetirementType" name="fstaffexperiencegrid$o<?php echo $staffexperience_grid->RowIndex ?>_RetirementType" id="fstaffexperiencegrid$o<?php echo $staffexperience_grid->RowIndex ?>_RetirementType" value="<?php echo HtmlEncode($staffexperience_grid->RetirementType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffexperience_grid->ListOptions->render("body", "right", $staffexperience_grid->RowCount);
?>
	</tr>
<?php if ($staffexperience->RowType == ROWTYPE_ADD || $staffexperience->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fstaffexperiencegrid", "load"], function() {
	fstaffexperiencegrid.updateLists(<?php echo $staffexperience_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$staffexperience_grid->isGridAdd() || $staffexperience->CurrentMode == "copy")
		if (!$staffexperience_grid->Recordset->EOF)
			$staffexperience_grid->Recordset->moveNext();
}
?>
<?php
	if ($staffexperience->CurrentMode == "add" || $staffexperience->CurrentMode == "copy" || $staffexperience->CurrentMode == "edit") {
		$staffexperience_grid->RowIndex = '$rowindex$';
		$staffexperience_grid->loadRowValues();

		// Set row properties
		$staffexperience->resetAttributes();
		$staffexperience->RowAttrs->merge(["data-rowindex" => $staffexperience_grid->RowIndex, "id" => "r0_staffexperience", "data-rowtype" => ROWTYPE_ADD]);
		$staffexperience->RowAttrs->appendClass("ew-template");
		$staffexperience->RowType = ROWTYPE_ADD;

		// Render row
		$staffexperience_grid->renderRow();

		// Render list options
		$staffexperience_grid->renderListOptions();
		$staffexperience_grid->StartRowCount = 0;
?>
	<tr <?php echo $staffexperience->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffexperience_grid->ListOptions->render("body", "left", $staffexperience_grid->RowIndex);
?>
	<?php if ($staffexperience_grid->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode">
<?php if (!$staffexperience->isConfirm()) { ?>
<span id="el$rowindex$_staffexperience_ProvinceCode" class="form-group staffexperience_ProvinceCode">
<?php $staffexperience_grid->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_ProvinceCode" data-value-separator="<?php echo $staffexperience_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffexperience_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $staffexperience_grid->RowIndex ?>_ProvinceCode"<?php echo $staffexperience_grid->ProvinceCode->editAttributes() ?>>
			<?php echo $staffexperience_grid->ProvinceCode->selectOptionListHtml("x{$staffexperience_grid->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $staffexperience_grid->ProvinceCode->Lookup->getParamTag($staffexperience_grid, "p_x" . $staffexperience_grid->RowIndex . "_ProvinceCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffexperience_ProvinceCode" class="form-group staffexperience_ProvinceCode">
<span<?php echo $staffexperience_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffexperience_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_ProvinceCode" name="x<?php echo $staffexperience_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $staffexperience_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($staffexperience_grid->ProvinceCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffexperience" data-field="x_ProvinceCode" name="o<?php echo $staffexperience_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $staffexperience_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($staffexperience_grid->ProvinceCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffexperience_grid->LAcode->Visible) { // LAcode ?>
		<td data-name="LAcode">
<?php if (!$staffexperience->isConfirm()) { ?>
<span id="el$rowindex$_staffexperience_LAcode" class="form-group staffexperience_LAcode">
<?php $staffexperience_grid->LAcode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffexperience_grid->RowIndex ?>_LAcode"><?php echo EmptyValue(strval($staffexperience_grid->LAcode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffexperience_grid->LAcode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffexperience_grid->LAcode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffexperience_grid->LAcode->ReadOnly || $staffexperience_grid->LAcode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffexperience_grid->RowIndex ?>_LAcode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffexperience_grid->LAcode->Lookup->getParamTag($staffexperience_grid, "p_x" . $staffexperience_grid->RowIndex . "_LAcode") ?>
<input type="hidden" data-table="staffexperience" data-field="x_LAcode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffexperience_grid->LAcode->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffexperience_grid->RowIndex ?>_LAcode" id="x<?php echo $staffexperience_grid->RowIndex ?>_LAcode" value="<?php echo $staffexperience_grid->LAcode->CurrentValue ?>"<?php echo $staffexperience_grid->LAcode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffexperience_LAcode" class="form-group staffexperience_LAcode">
<span<?php echo $staffexperience_grid->LAcode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffexperience_grid->LAcode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_LAcode" name="x<?php echo $staffexperience_grid->RowIndex ?>_LAcode" id="x<?php echo $staffexperience_grid->RowIndex ?>_LAcode" value="<?php echo HtmlEncode($staffexperience_grid->LAcode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffexperience" data-field="x_LAcode" name="o<?php echo $staffexperience_grid->RowIndex ?>_LAcode" id="o<?php echo $staffexperience_grid->RowIndex ?>_LAcode" value="<?php echo HtmlEncode($staffexperience_grid->LAcode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffexperience_grid->PositionCode->Visible) { // PositionCode ?>
		<td data-name="PositionCode">
<?php if (!$staffexperience->isConfirm()) { ?>
<span id="el$rowindex$_staffexperience_PositionCode" class="form-group staffexperience_PositionCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffexperience_grid->RowIndex ?>_PositionCode"><?php echo EmptyValue(strval($staffexperience_grid->PositionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffexperience_grid->PositionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffexperience_grid->PositionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffexperience_grid->PositionCode->ReadOnly || $staffexperience_grid->PositionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffexperience_grid->RowIndex ?>_PositionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffexperience_grid->PositionCode->Lookup->getParamTag($staffexperience_grid, "p_x" . $staffexperience_grid->RowIndex . "_PositionCode") ?>
<input type="hidden" data-table="staffexperience" data-field="x_PositionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffexperience_grid->PositionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffexperience_grid->RowIndex ?>_PositionCode" id="x<?php echo $staffexperience_grid->RowIndex ?>_PositionCode" value="<?php echo $staffexperience_grid->PositionCode->CurrentValue ?>"<?php echo $staffexperience_grid->PositionCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffexperience_PositionCode" class="form-group staffexperience_PositionCode">
<span<?php echo $staffexperience_grid->PositionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffexperience_grid->PositionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_PositionCode" name="x<?php echo $staffexperience_grid->RowIndex ?>_PositionCode" id="x<?php echo $staffexperience_grid->RowIndex ?>_PositionCode" value="<?php echo HtmlEncode($staffexperience_grid->PositionCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffexperience" data-field="x_PositionCode" name="o<?php echo $staffexperience_grid->RowIndex ?>_PositionCode" id="o<?php echo $staffexperience_grid->RowIndex ?>_PositionCode" value="<?php echo HtmlEncode($staffexperience_grid->PositionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffexperience_grid->FromDate->Visible) { // FromDate ?>
		<td data-name="FromDate">
<?php if (!$staffexperience->isConfirm()) { ?>
<span id="el$rowindex$_staffexperience_FromDate" class="form-group staffexperience_FromDate">
<input type="text" data-table="staffexperience" data-field="x_FromDate" name="x<?php echo $staffexperience_grid->RowIndex ?>_FromDate" id="x<?php echo $staffexperience_grid->RowIndex ?>_FromDate" placeholder="<?php echo HtmlEncode($staffexperience_grid->FromDate->getPlaceHolder()) ?>" value="<?php echo $staffexperience_grid->FromDate->EditValue ?>"<?php echo $staffexperience_grid->FromDate->editAttributes() ?>>
<?php if (!$staffexperience_grid->FromDate->ReadOnly && !$staffexperience_grid->FromDate->Disabled && !isset($staffexperience_grid->FromDate->EditAttrs["readonly"]) && !isset($staffexperience_grid->FromDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffexperiencegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffexperiencegrid", "x<?php echo $staffexperience_grid->RowIndex ?>_FromDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffexperience_FromDate" class="form-group staffexperience_FromDate">
<span<?php echo $staffexperience_grid->FromDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffexperience_grid->FromDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_FromDate" name="x<?php echo $staffexperience_grid->RowIndex ?>_FromDate" id="x<?php echo $staffexperience_grid->RowIndex ?>_FromDate" value="<?php echo HtmlEncode($staffexperience_grid->FromDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffexperience" data-field="x_FromDate" name="o<?php echo $staffexperience_grid->RowIndex ?>_FromDate" id="o<?php echo $staffexperience_grid->RowIndex ?>_FromDate" value="<?php echo HtmlEncode($staffexperience_grid->FromDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffexperience_grid->ExitDate->Visible) { // ExitDate ?>
		<td data-name="ExitDate">
<?php if (!$staffexperience->isConfirm()) { ?>
<span id="el$rowindex$_staffexperience_ExitDate" class="form-group staffexperience_ExitDate">
<input type="text" data-table="staffexperience" data-field="x_ExitDate" name="x<?php echo $staffexperience_grid->RowIndex ?>_ExitDate" id="x<?php echo $staffexperience_grid->RowIndex ?>_ExitDate" placeholder="<?php echo HtmlEncode($staffexperience_grid->ExitDate->getPlaceHolder()) ?>" value="<?php echo $staffexperience_grid->ExitDate->EditValue ?>"<?php echo $staffexperience_grid->ExitDate->editAttributes() ?>>
<?php if (!$staffexperience_grid->ExitDate->ReadOnly && !$staffexperience_grid->ExitDate->Disabled && !isset($staffexperience_grid->ExitDate->EditAttrs["readonly"]) && !isset($staffexperience_grid->ExitDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffexperiencegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffexperiencegrid", "x<?php echo $staffexperience_grid->RowIndex ?>_ExitDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffexperience_ExitDate" class="form-group staffexperience_ExitDate">
<span<?php echo $staffexperience_grid->ExitDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffexperience_grid->ExitDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_ExitDate" name="x<?php echo $staffexperience_grid->RowIndex ?>_ExitDate" id="x<?php echo $staffexperience_grid->RowIndex ?>_ExitDate" value="<?php echo HtmlEncode($staffexperience_grid->ExitDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffexperience" data-field="x_ExitDate" name="o<?php echo $staffexperience_grid->RowIndex ?>_ExitDate" id="o<?php echo $staffexperience_grid->RowIndex ?>_ExitDate" value="<?php echo HtmlEncode($staffexperience_grid->ExitDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffexperience_grid->ReasonForExit->Visible) { // ReasonForExit ?>
		<td data-name="ReasonForExit">
<?php if (!$staffexperience->isConfirm()) { ?>
<span id="el$rowindex$_staffexperience_ReasonForExit" class="form-group staffexperience_ReasonForExit">
<?php $staffexperience_grid->ReasonForExit->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_ReasonForExit" data-value-separator="<?php echo $staffexperience_grid->ReasonForExit->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffexperience_grid->RowIndex ?>_ReasonForExit" name="x<?php echo $staffexperience_grid->RowIndex ?>_ReasonForExit"<?php echo $staffexperience_grid->ReasonForExit->editAttributes() ?>>
			<?php echo $staffexperience_grid->ReasonForExit->selectOptionListHtml("x{$staffexperience_grid->RowIndex}_ReasonForExit") ?>
		</select>
</div>
<?php echo $staffexperience_grid->ReasonForExit->Lookup->getParamTag($staffexperience_grid, "p_x" . $staffexperience_grid->RowIndex . "_ReasonForExit") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffexperience_ReasonForExit" class="form-group staffexperience_ReasonForExit">
<span<?php echo $staffexperience_grid->ReasonForExit->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffexperience_grid->ReasonForExit->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_ReasonForExit" name="x<?php echo $staffexperience_grid->RowIndex ?>_ReasonForExit" id="x<?php echo $staffexperience_grid->RowIndex ?>_ReasonForExit" value="<?php echo HtmlEncode($staffexperience_grid->ReasonForExit->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffexperience" data-field="x_ReasonForExit" name="o<?php echo $staffexperience_grid->RowIndex ?>_ReasonForExit" id="o<?php echo $staffexperience_grid->RowIndex ?>_ReasonForExit" value="<?php echo HtmlEncode($staffexperience_grid->ReasonForExit->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffexperience_grid->RetirementType->Visible) { // RetirementType ?>
		<td data-name="RetirementType">
<?php if (!$staffexperience->isConfirm()) { ?>
<span id="el$rowindex$_staffexperience_RetirementType" class="form-group staffexperience_RetirementType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_RetirementType" data-value-separator="<?php echo $staffexperience_grid->RetirementType->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffexperience_grid->RowIndex ?>_RetirementType" name="x<?php echo $staffexperience_grid->RowIndex ?>_RetirementType"<?php echo $staffexperience_grid->RetirementType->editAttributes() ?>>
			<?php echo $staffexperience_grid->RetirementType->selectOptionListHtml("x{$staffexperience_grid->RowIndex}_RetirementType") ?>
		</select>
</div>
<?php echo $staffexperience_grid->RetirementType->Lookup->getParamTag($staffexperience_grid, "p_x" . $staffexperience_grid->RowIndex . "_RetirementType") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffexperience_RetirementType" class="form-group staffexperience_RetirementType">
<span<?php echo $staffexperience_grid->RetirementType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffexperience_grid->RetirementType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_RetirementType" name="x<?php echo $staffexperience_grid->RowIndex ?>_RetirementType" id="x<?php echo $staffexperience_grid->RowIndex ?>_RetirementType" value="<?php echo HtmlEncode($staffexperience_grid->RetirementType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffexperience" data-field="x_RetirementType" name="o<?php echo $staffexperience_grid->RowIndex ?>_RetirementType" id="o<?php echo $staffexperience_grid->RowIndex ?>_RetirementType" value="<?php echo HtmlEncode($staffexperience_grid->RetirementType->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffexperience_grid->ListOptions->render("body", "right", $staffexperience_grid->RowIndex);
?>
<script>
loadjs.ready(["fstaffexperiencegrid", "load"], function() {
	fstaffexperiencegrid.updateLists(<?php echo $staffexperience_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($staffexperience->CurrentMode == "add" || $staffexperience->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $staffexperience_grid->FormKeyCountName ?>" id="<?php echo $staffexperience_grid->FormKeyCountName ?>" value="<?php echo $staffexperience_grid->KeyCount ?>">
<?php echo $staffexperience_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($staffexperience->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $staffexperience_grid->FormKeyCountName ?>" id="<?php echo $staffexperience_grid->FormKeyCountName ?>" value="<?php echo $staffexperience_grid->KeyCount ?>">
<?php echo $staffexperience_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($staffexperience->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fstaffexperiencegrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($staffexperience_grid->Recordset)
	$staffexperience_grid->Recordset->Close();
?>
<?php if ($staffexperience_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $staffexperience_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($staffexperience_grid->TotalRecords == 0 && !$staffexperience->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $staffexperience_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$staffexperience_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$staffexperience_grid->terminate();
?>