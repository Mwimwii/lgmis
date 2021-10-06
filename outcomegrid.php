<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($outcome_grid))
	$outcome_grid = new outcome_grid();

// Run the page
$outcome_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$outcome_grid->Page_Render();
?>
<?php if (!$outcome_grid->isExport()) { ?>
<script>
var foutcomegrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	foutcomegrid = new ew.Form("foutcomegrid", "grid");
	foutcomegrid.formKeyCountName = '<?php echo $outcome_grid->FormKeyCountName ?>';

	// Validate form
	foutcomegrid.validate = function() {
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
			<?php if ($outcome_grid->OutcomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_grid->OutcomeCode->caption(), $outcome_grid->OutcomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_grid->OutcomeName->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_grid->OutcomeName->caption(), $outcome_grid->OutcomeName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_grid->StrategicObjectiveCode->Required) { ?>
				elm = this.getElements("x" + infix + "_StrategicObjectiveCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_grid->StrategicObjectiveCode->caption(), $outcome_grid->StrategicObjectiveCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StrategicObjectiveCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($outcome_grid->StrategicObjectiveCode->errorMessage()) ?>");
			<?php if ($outcome_grid->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_grid->LACode->caption(), $outcome_grid->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_grid->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_grid->DepartmentCode->caption(), $outcome_grid->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_grid->OutcomeKPI->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeKPI");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_grid->OutcomeKPI->caption(), $outcome_grid->OutcomeKPI->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_grid->Assumptions->Required) { ?>
				elm = this.getElements("x" + infix + "_Assumptions");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_grid->Assumptions->caption(), $outcome_grid->Assumptions->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_grid->ResponsibleOfficer->Required) { ?>
				elm = this.getElements("x" + infix + "_ResponsibleOfficer");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_grid->ResponsibleOfficer->caption(), $outcome_grid->ResponsibleOfficer->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_grid->OutcomeStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_grid->OutcomeStatus->caption(), $outcome_grid->OutcomeStatus->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	foutcomegrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "OutcomeName", false)) return false;
		if (ew.valueChanged(fobj, infix, "StrategicObjectiveCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutcomeKPI", false)) return false;
		if (ew.valueChanged(fobj, infix, "Assumptions", false)) return false;
		if (ew.valueChanged(fobj, infix, "ResponsibleOfficer", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutcomeStatus", false)) return false;
		return true;
	}

	// Form_CustomValidate
	foutcomegrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	foutcomegrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	foutcomegrid.lists["x_StrategicObjectiveCode"] = <?php echo $outcome_grid->StrategicObjectiveCode->Lookup->toClientList($outcome_grid) ?>;
	foutcomegrid.lists["x_StrategicObjectiveCode"].options = <?php echo JsonEncode($outcome_grid->StrategicObjectiveCode->lookupOptions()) ?>;
	foutcomegrid.autoSuggests["x_StrategicObjectiveCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutcomegrid.lists["x_LACode"] = <?php echo $outcome_grid->LACode->Lookup->toClientList($outcome_grid) ?>;
	foutcomegrid.lists["x_LACode"].options = <?php echo JsonEncode($outcome_grid->LACode->lookupOptions()) ?>;
	foutcomegrid.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutcomegrid.lists["x_DepartmentCode"] = <?php echo $outcome_grid->DepartmentCode->Lookup->toClientList($outcome_grid) ?>;
	foutcomegrid.lists["x_DepartmentCode"].options = <?php echo JsonEncode($outcome_grid->DepartmentCode->lookupOptions()) ?>;
	foutcomegrid.lists["x_OutcomeStatus"] = <?php echo $outcome_grid->OutcomeStatus->Lookup->toClientList($outcome_grid) ?>;
	foutcomegrid.lists["x_OutcomeStatus"].options = <?php echo JsonEncode($outcome_grid->OutcomeStatus->lookupOptions()) ?>;
	loadjs.done("foutcomegrid");
});
</script>
<?php } ?>
<?php
$outcome_grid->renderOtherOptions();
?>
<?php if ($outcome_grid->TotalRecords > 0 || $outcome->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($outcome_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> outcome">
<?php if ($outcome_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $outcome_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="foutcomegrid" class="ew-form ew-list-form form-inline">
<div id="gmp_outcome" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_outcomegrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$outcome->RowType = ROWTYPE_HEADER;

// Render list options
$outcome_grid->renderListOptions();

// Render list options (header, left)
$outcome_grid->ListOptions->render("header", "left");
?>
<?php if ($outcome_grid->OutcomeCode->Visible) { // OutcomeCode ?>
	<?php if ($outcome_grid->SortUrl($outcome_grid->OutcomeCode) == "") { ?>
		<th data-name="OutcomeCode" class="<?php echo $outcome_grid->OutcomeCode->headerCellClass() ?>"><div id="elh_outcome_OutcomeCode" class="outcome_OutcomeCode"><div class="ew-table-header-caption"><?php echo $outcome_grid->OutcomeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutcomeCode" class="<?php echo $outcome_grid->OutcomeCode->headerCellClass() ?>"><div><div id="elh_outcome_OutcomeCode" class="outcome_OutcomeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_grid->OutcomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($outcome_grid->OutcomeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_grid->OutcomeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($outcome_grid->OutcomeName->Visible) { // OutcomeName ?>
	<?php if ($outcome_grid->SortUrl($outcome_grid->OutcomeName) == "") { ?>
		<th data-name="OutcomeName" class="<?php echo $outcome_grid->OutcomeName->headerCellClass() ?>"><div id="elh_outcome_OutcomeName" class="outcome_OutcomeName"><div class="ew-table-header-caption"><?php echo $outcome_grid->OutcomeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutcomeName" class="<?php echo $outcome_grid->OutcomeName->headerCellClass() ?>"><div><div id="elh_outcome_OutcomeName" class="outcome_OutcomeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_grid->OutcomeName->caption() ?></span><span class="ew-table-header-sort"><?php if ($outcome_grid->OutcomeName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_grid->OutcomeName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($outcome_grid->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
	<?php if ($outcome_grid->SortUrl($outcome_grid->StrategicObjectiveCode) == "") { ?>
		<th data-name="StrategicObjectiveCode" class="<?php echo $outcome_grid->StrategicObjectiveCode->headerCellClass() ?>"><div id="elh_outcome_StrategicObjectiveCode" class="outcome_StrategicObjectiveCode"><div class="ew-table-header-caption"><?php echo $outcome_grid->StrategicObjectiveCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StrategicObjectiveCode" class="<?php echo $outcome_grid->StrategicObjectiveCode->headerCellClass() ?>"><div><div id="elh_outcome_StrategicObjectiveCode" class="outcome_StrategicObjectiveCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_grid->StrategicObjectiveCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($outcome_grid->StrategicObjectiveCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_grid->StrategicObjectiveCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($outcome_grid->LACode->Visible) { // LACode ?>
	<?php if ($outcome_grid->SortUrl($outcome_grid->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $outcome_grid->LACode->headerCellClass() ?>"><div id="elh_outcome_LACode" class="outcome_LACode"><div class="ew-table-header-caption"><?php echo $outcome_grid->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $outcome_grid->LACode->headerCellClass() ?>"><div><div id="elh_outcome_LACode" class="outcome_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_grid->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($outcome_grid->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_grid->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($outcome_grid->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($outcome_grid->SortUrl($outcome_grid->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $outcome_grid->DepartmentCode->headerCellClass() ?>"><div id="elh_outcome_DepartmentCode" class="outcome_DepartmentCode"><div class="ew-table-header-caption"><?php echo $outcome_grid->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $outcome_grid->DepartmentCode->headerCellClass() ?>"><div><div id="elh_outcome_DepartmentCode" class="outcome_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_grid->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($outcome_grid->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_grid->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($outcome_grid->OutcomeKPI->Visible) { // OutcomeKPI ?>
	<?php if ($outcome_grid->SortUrl($outcome_grid->OutcomeKPI) == "") { ?>
		<th data-name="OutcomeKPI" class="<?php echo $outcome_grid->OutcomeKPI->headerCellClass() ?>"><div id="elh_outcome_OutcomeKPI" class="outcome_OutcomeKPI"><div class="ew-table-header-caption"><?php echo $outcome_grid->OutcomeKPI->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutcomeKPI" class="<?php echo $outcome_grid->OutcomeKPI->headerCellClass() ?>"><div><div id="elh_outcome_OutcomeKPI" class="outcome_OutcomeKPI">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_grid->OutcomeKPI->caption() ?></span><span class="ew-table-header-sort"><?php if ($outcome_grid->OutcomeKPI->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_grid->OutcomeKPI->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($outcome_grid->Assumptions->Visible) { // Assumptions ?>
	<?php if ($outcome_grid->SortUrl($outcome_grid->Assumptions) == "") { ?>
		<th data-name="Assumptions" class="<?php echo $outcome_grid->Assumptions->headerCellClass() ?>"><div id="elh_outcome_Assumptions" class="outcome_Assumptions"><div class="ew-table-header-caption"><?php echo $outcome_grid->Assumptions->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Assumptions" class="<?php echo $outcome_grid->Assumptions->headerCellClass() ?>"><div><div id="elh_outcome_Assumptions" class="outcome_Assumptions">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_grid->Assumptions->caption() ?></span><span class="ew-table-header-sort"><?php if ($outcome_grid->Assumptions->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_grid->Assumptions->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($outcome_grid->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
	<?php if ($outcome_grid->SortUrl($outcome_grid->ResponsibleOfficer) == "") { ?>
		<th data-name="ResponsibleOfficer" class="<?php echo $outcome_grid->ResponsibleOfficer->headerCellClass() ?>"><div id="elh_outcome_ResponsibleOfficer" class="outcome_ResponsibleOfficer"><div class="ew-table-header-caption"><?php echo $outcome_grid->ResponsibleOfficer->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ResponsibleOfficer" class="<?php echo $outcome_grid->ResponsibleOfficer->headerCellClass() ?>"><div><div id="elh_outcome_ResponsibleOfficer" class="outcome_ResponsibleOfficer">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_grid->ResponsibleOfficer->caption() ?></span><span class="ew-table-header-sort"><?php if ($outcome_grid->ResponsibleOfficer->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_grid->ResponsibleOfficer->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($outcome_grid->OutcomeStatus->Visible) { // OutcomeStatus ?>
	<?php if ($outcome_grid->SortUrl($outcome_grid->OutcomeStatus) == "") { ?>
		<th data-name="OutcomeStatus" class="<?php echo $outcome_grid->OutcomeStatus->headerCellClass() ?>"><div id="elh_outcome_OutcomeStatus" class="outcome_OutcomeStatus"><div class="ew-table-header-caption"><?php echo $outcome_grid->OutcomeStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutcomeStatus" class="<?php echo $outcome_grid->OutcomeStatus->headerCellClass() ?>"><div><div id="elh_outcome_OutcomeStatus" class="outcome_OutcomeStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_grid->OutcomeStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($outcome_grid->OutcomeStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_grid->OutcomeStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$outcome_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$outcome_grid->StartRecord = 1;
$outcome_grid->StopRecord = $outcome_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($outcome->isConfirm() || $outcome_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($outcome_grid->FormKeyCountName) && ($outcome_grid->isGridAdd() || $outcome_grid->isGridEdit() || $outcome->isConfirm())) {
		$outcome_grid->KeyCount = $CurrentForm->getValue($outcome_grid->FormKeyCountName);
		$outcome_grid->StopRecord = $outcome_grid->StartRecord + $outcome_grid->KeyCount - 1;
	}
}
$outcome_grid->RecordCount = $outcome_grid->StartRecord - 1;
if ($outcome_grid->Recordset && !$outcome_grid->Recordset->EOF) {
	$outcome_grid->Recordset->moveFirst();
	$selectLimit = $outcome_grid->UseSelectLimit;
	if (!$selectLimit && $outcome_grid->StartRecord > 1)
		$outcome_grid->Recordset->move($outcome_grid->StartRecord - 1);
} elseif (!$outcome->AllowAddDeleteRow && $outcome_grid->StopRecord == 0) {
	$outcome_grid->StopRecord = $outcome->GridAddRowCount;
}

// Initialize aggregate
$outcome->RowType = ROWTYPE_AGGREGATEINIT;
$outcome->resetAttributes();
$outcome_grid->renderRow();
if ($outcome_grid->isGridAdd())
	$outcome_grid->RowIndex = 0;
if ($outcome_grid->isGridEdit())
	$outcome_grid->RowIndex = 0;
while ($outcome_grid->RecordCount < $outcome_grid->StopRecord) {
	$outcome_grid->RecordCount++;
	if ($outcome_grid->RecordCount >= $outcome_grid->StartRecord) {
		$outcome_grid->RowCount++;
		if ($outcome_grid->isGridAdd() || $outcome_grid->isGridEdit() || $outcome->isConfirm()) {
			$outcome_grid->RowIndex++;
			$CurrentForm->Index = $outcome_grid->RowIndex;
			if ($CurrentForm->hasValue($outcome_grid->FormActionName) && ($outcome->isConfirm() || $outcome_grid->EventCancelled))
				$outcome_grid->RowAction = strval($CurrentForm->getValue($outcome_grid->FormActionName));
			elseif ($outcome_grid->isGridAdd())
				$outcome_grid->RowAction = "insert";
			else
				$outcome_grid->RowAction = "";
		}

		// Set up key count
		$outcome_grid->KeyCount = $outcome_grid->RowIndex;

		// Init row class and style
		$outcome->resetAttributes();
		$outcome->CssClass = "";
		if ($outcome_grid->isGridAdd()) {
			if ($outcome->CurrentMode == "copy") {
				$outcome_grid->loadRowValues($outcome_grid->Recordset); // Load row values
				$outcome_grid->setRecordKey($outcome_grid->RowOldKey, $outcome_grid->Recordset); // Set old record key
			} else {
				$outcome_grid->loadRowValues(); // Load default values
				$outcome_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$outcome_grid->loadRowValues($outcome_grid->Recordset); // Load row values
		}
		$outcome->RowType = ROWTYPE_VIEW; // Render view
		if ($outcome_grid->isGridAdd()) // Grid add
			$outcome->RowType = ROWTYPE_ADD; // Render add
		if ($outcome_grid->isGridAdd() && $outcome->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$outcome_grid->restoreCurrentRowFormValues($outcome_grid->RowIndex); // Restore form values
		if ($outcome_grid->isGridEdit()) { // Grid edit
			if ($outcome->EventCancelled)
				$outcome_grid->restoreCurrentRowFormValues($outcome_grid->RowIndex); // Restore form values
			if ($outcome_grid->RowAction == "insert")
				$outcome->RowType = ROWTYPE_ADD; // Render add
			else
				$outcome->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($outcome_grid->isGridEdit() && ($outcome->RowType == ROWTYPE_EDIT || $outcome->RowType == ROWTYPE_ADD) && $outcome->EventCancelled) // Update failed
			$outcome_grid->restoreCurrentRowFormValues($outcome_grid->RowIndex); // Restore form values
		if ($outcome->RowType == ROWTYPE_EDIT) // Edit row
			$outcome_grid->EditRowCount++;
		if ($outcome->isConfirm()) // Confirm row
			$outcome_grid->restoreCurrentRowFormValues($outcome_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$outcome->RowAttrs->merge(["data-rowindex" => $outcome_grid->RowCount, "id" => "r" . $outcome_grid->RowCount . "_outcome", "data-rowtype" => $outcome->RowType]);

		// Render row
		$outcome_grid->renderRow();

		// Render list options
		$outcome_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($outcome_grid->RowAction != "delete" && $outcome_grid->RowAction != "insertdelete" && !($outcome_grid->RowAction == "insert" && $outcome->isConfirm() && $outcome_grid->emptyRow())) {
?>
	<tr <?php echo $outcome->rowAttributes() ?>>
<?php

// Render list options (body, left)
$outcome_grid->ListOptions->render("body", "left", $outcome_grid->RowCount);
?>
	<?php if ($outcome_grid->OutcomeCode->Visible) { // OutcomeCode ?>
		<td data-name="OutcomeCode" <?php echo $outcome_grid->OutcomeCode->cellAttributes() ?>>
<?php if ($outcome->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_OutcomeCode" class="form-group"></span>
<input type="hidden" data-table="outcome" data-field="x_OutcomeCode" name="o<?php echo $outcome_grid->RowIndex ?>_OutcomeCode" id="o<?php echo $outcome_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($outcome_grid->OutcomeCode->OldValue) ?>">
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_OutcomeCode" class="form-group">
<span<?php echo $outcome_grid->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_grid->OutcomeCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="outcome" data-field="x_OutcomeCode" name="x<?php echo $outcome_grid->RowIndex ?>_OutcomeCode" id="x<?php echo $outcome_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($outcome_grid->OutcomeCode->CurrentValue) ?>">
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_OutcomeCode">
<span<?php echo $outcome_grid->OutcomeCode->viewAttributes() ?>><?php echo $outcome_grid->OutcomeCode->getViewValue() ?></span>
</span>
<?php if (!$outcome->isConfirm()) { ?>
<input type="hidden" data-table="outcome" data-field="x_OutcomeCode" name="x<?php echo $outcome_grid->RowIndex ?>_OutcomeCode" id="x<?php echo $outcome_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($outcome_grid->OutcomeCode->FormValue) ?>">
<input type="hidden" data-table="outcome" data-field="x_OutcomeCode" name="o<?php echo $outcome_grid->RowIndex ?>_OutcomeCode" id="o<?php echo $outcome_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($outcome_grid->OutcomeCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="outcome" data-field="x_OutcomeCode" name="foutcomegrid$x<?php echo $outcome_grid->RowIndex ?>_OutcomeCode" id="foutcomegrid$x<?php echo $outcome_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($outcome_grid->OutcomeCode->FormValue) ?>">
<input type="hidden" data-table="outcome" data-field="x_OutcomeCode" name="foutcomegrid$o<?php echo $outcome_grid->RowIndex ?>_OutcomeCode" id="foutcomegrid$o<?php echo $outcome_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($outcome_grid->OutcomeCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($outcome_grid->OutcomeName->Visible) { // OutcomeName ?>
		<td data-name="OutcomeName" <?php echo $outcome_grid->OutcomeName->cellAttributes() ?>>
<?php if ($outcome->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_OutcomeName" class="form-group">
<textarea data-table="outcome" data-field="x_OutcomeName" name="x<?php echo $outcome_grid->RowIndex ?>_OutcomeName" id="x<?php echo $outcome_grid->RowIndex ?>_OutcomeName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($outcome_grid->OutcomeName->getPlaceHolder()) ?>"<?php echo $outcome_grid->OutcomeName->editAttributes() ?>><?php echo $outcome_grid->OutcomeName->EditValue ?></textarea>
</span>
<input type="hidden" data-table="outcome" data-field="x_OutcomeName" name="o<?php echo $outcome_grid->RowIndex ?>_OutcomeName" id="o<?php echo $outcome_grid->RowIndex ?>_OutcomeName" value="<?php echo HtmlEncode($outcome_grid->OutcomeName->OldValue) ?>">
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_OutcomeName" class="form-group">
<textarea data-table="outcome" data-field="x_OutcomeName" name="x<?php echo $outcome_grid->RowIndex ?>_OutcomeName" id="x<?php echo $outcome_grid->RowIndex ?>_OutcomeName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($outcome_grid->OutcomeName->getPlaceHolder()) ?>"<?php echo $outcome_grid->OutcomeName->editAttributes() ?>><?php echo $outcome_grid->OutcomeName->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_OutcomeName">
<span<?php echo $outcome_grid->OutcomeName->viewAttributes() ?>><?php echo $outcome_grid->OutcomeName->getViewValue() ?></span>
</span>
<?php if (!$outcome->isConfirm()) { ?>
<input type="hidden" data-table="outcome" data-field="x_OutcomeName" name="x<?php echo $outcome_grid->RowIndex ?>_OutcomeName" id="x<?php echo $outcome_grid->RowIndex ?>_OutcomeName" value="<?php echo HtmlEncode($outcome_grid->OutcomeName->FormValue) ?>">
<input type="hidden" data-table="outcome" data-field="x_OutcomeName" name="o<?php echo $outcome_grid->RowIndex ?>_OutcomeName" id="o<?php echo $outcome_grid->RowIndex ?>_OutcomeName" value="<?php echo HtmlEncode($outcome_grid->OutcomeName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="outcome" data-field="x_OutcomeName" name="foutcomegrid$x<?php echo $outcome_grid->RowIndex ?>_OutcomeName" id="foutcomegrid$x<?php echo $outcome_grid->RowIndex ?>_OutcomeName" value="<?php echo HtmlEncode($outcome_grid->OutcomeName->FormValue) ?>">
<input type="hidden" data-table="outcome" data-field="x_OutcomeName" name="foutcomegrid$o<?php echo $outcome_grid->RowIndex ?>_OutcomeName" id="foutcomegrid$o<?php echo $outcome_grid->RowIndex ?>_OutcomeName" value="<?php echo HtmlEncode($outcome_grid->OutcomeName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($outcome_grid->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
		<td data-name="StrategicObjectiveCode" <?php echo $outcome_grid->StrategicObjectiveCode->cellAttributes() ?>>
<?php if ($outcome->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($outcome_grid->StrategicObjectiveCode->getSessionValue() != "") { ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_StrategicObjectiveCode" class="form-group">
<span<?php echo $outcome_grid->StrategicObjectiveCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_grid->StrategicObjectiveCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" name="x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_grid->StrategicObjectiveCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_StrategicObjectiveCode" class="form-group">
<?php
$onchange = $outcome_grid->StrategicObjectiveCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$outcome_grid->StrategicObjectiveCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" id="sv_x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" value="<?php echo RemoveHtml($outcome_grid->StrategicObjectiveCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($outcome_grid->StrategicObjectiveCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($outcome_grid->StrategicObjectiveCode->getPlaceHolder()) ?>"<?php echo $outcome_grid->StrategicObjectiveCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_grid->StrategicObjectiveCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_grid->StrategicObjectiveCode->ReadOnly || $outcome_grid->StrategicObjectiveCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="outcome" data-field="x_StrategicObjectiveCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_grid->StrategicObjectiveCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" id="x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_grid->StrategicObjectiveCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutcomegrid"], function() {
	foutcomegrid.createAutoSuggest({"id":"x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode","forceSelect":true});
});
</script>
<?php echo $outcome_grid->StrategicObjectiveCode->Lookup->getParamTag($outcome_grid, "p_x" . $outcome_grid->RowIndex . "_StrategicObjectiveCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="outcome" data-field="x_StrategicObjectiveCode" name="o<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" id="o<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_grid->StrategicObjectiveCode->OldValue) ?>">
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($outcome_grid->StrategicObjectiveCode->getSessionValue() != "") { ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_StrategicObjectiveCode" class="form-group">
<span<?php echo $outcome_grid->StrategicObjectiveCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_grid->StrategicObjectiveCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" name="x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_grid->StrategicObjectiveCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_StrategicObjectiveCode" class="form-group">
<?php
$onchange = $outcome_grid->StrategicObjectiveCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$outcome_grid->StrategicObjectiveCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" id="sv_x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" value="<?php echo RemoveHtml($outcome_grid->StrategicObjectiveCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($outcome_grid->StrategicObjectiveCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($outcome_grid->StrategicObjectiveCode->getPlaceHolder()) ?>"<?php echo $outcome_grid->StrategicObjectiveCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_grid->StrategicObjectiveCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_grid->StrategicObjectiveCode->ReadOnly || $outcome_grid->StrategicObjectiveCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="outcome" data-field="x_StrategicObjectiveCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_grid->StrategicObjectiveCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" id="x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_grid->StrategicObjectiveCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutcomegrid"], function() {
	foutcomegrid.createAutoSuggest({"id":"x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode","forceSelect":true});
});
</script>
<?php echo $outcome_grid->StrategicObjectiveCode->Lookup->getParamTag($outcome_grid, "p_x" . $outcome_grid->RowIndex . "_StrategicObjectiveCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_StrategicObjectiveCode">
<span<?php echo $outcome_grid->StrategicObjectiveCode->viewAttributes() ?>><?php echo $outcome_grid->StrategicObjectiveCode->getViewValue() ?></span>
</span>
<?php if (!$outcome->isConfirm()) { ?>
<input type="hidden" data-table="outcome" data-field="x_StrategicObjectiveCode" name="x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" id="x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_grid->StrategicObjectiveCode->FormValue) ?>">
<input type="hidden" data-table="outcome" data-field="x_StrategicObjectiveCode" name="o<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" id="o<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_grid->StrategicObjectiveCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="outcome" data-field="x_StrategicObjectiveCode" name="foutcomegrid$x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" id="foutcomegrid$x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_grid->StrategicObjectiveCode->FormValue) ?>">
<input type="hidden" data-table="outcome" data-field="x_StrategicObjectiveCode" name="foutcomegrid$o<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" id="foutcomegrid$o<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_grid->StrategicObjectiveCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($outcome_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $outcome_grid->LACode->cellAttributes() ?>>
<?php if ($outcome->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($outcome_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_LACode" class="form-group">
<span<?php echo $outcome_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $outcome_grid->RowIndex ?>_LACode" name="x<?php echo $outcome_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($outcome_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_LACode" class="form-group">
<?php
$onchange = $outcome_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$outcome_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $outcome_grid->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $outcome_grid->RowIndex ?>_LACode" id="sv_x<?php echo $outcome_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($outcome_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($outcome_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($outcome_grid->LACode->getPlaceHolder()) ?>"<?php echo $outcome_grid->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $outcome_grid->RowIndex ?>_LACode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_grid->LACode->ReadOnly || $outcome_grid->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="outcome" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $outcome_grid->RowIndex ?>_LACode" id="x<?php echo $outcome_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($outcome_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutcomegrid"], function() {
	foutcomegrid.createAutoSuggest({"id":"x<?php echo $outcome_grid->RowIndex ?>_LACode","forceSelect":true});
});
</script>
<?php echo $outcome_grid->LACode->Lookup->getParamTag($outcome_grid, "p_x" . $outcome_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="outcome" data-field="x_LACode" name="o<?php echo $outcome_grid->RowIndex ?>_LACode" id="o<?php echo $outcome_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($outcome_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($outcome_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_LACode" class="form-group">
<span<?php echo $outcome_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $outcome_grid->RowIndex ?>_LACode" name="x<?php echo $outcome_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($outcome_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_LACode" class="form-group">
<?php
$onchange = $outcome_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$outcome_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $outcome_grid->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $outcome_grid->RowIndex ?>_LACode" id="sv_x<?php echo $outcome_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($outcome_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($outcome_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($outcome_grid->LACode->getPlaceHolder()) ?>"<?php echo $outcome_grid->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $outcome_grid->RowIndex ?>_LACode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_grid->LACode->ReadOnly || $outcome_grid->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="outcome" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $outcome_grid->RowIndex ?>_LACode" id="x<?php echo $outcome_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($outcome_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutcomegrid"], function() {
	foutcomegrid.createAutoSuggest({"id":"x<?php echo $outcome_grid->RowIndex ?>_LACode","forceSelect":true});
});
</script>
<?php echo $outcome_grid->LACode->Lookup->getParamTag($outcome_grid, "p_x" . $outcome_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_LACode">
<span<?php echo $outcome_grid->LACode->viewAttributes() ?>><?php echo $outcome_grid->LACode->getViewValue() ?></span>
</span>
<?php if (!$outcome->isConfirm()) { ?>
<input type="hidden" data-table="outcome" data-field="x_LACode" name="x<?php echo $outcome_grid->RowIndex ?>_LACode" id="x<?php echo $outcome_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($outcome_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="outcome" data-field="x_LACode" name="o<?php echo $outcome_grid->RowIndex ?>_LACode" id="o<?php echo $outcome_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($outcome_grid->LACode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="outcome" data-field="x_LACode" name="foutcomegrid$x<?php echo $outcome_grid->RowIndex ?>_LACode" id="foutcomegrid$x<?php echo $outcome_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($outcome_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="outcome" data-field="x_LACode" name="foutcomegrid$o<?php echo $outcome_grid->RowIndex ?>_LACode" id="foutcomegrid$o<?php echo $outcome_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($outcome_grid->LACode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($outcome_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $outcome_grid->DepartmentCode->cellAttributes() ?>>
<?php if ($outcome->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_DepartmentCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $outcome_grid->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($outcome_grid->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $outcome_grid->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_grid->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_grid->DepartmentCode->ReadOnly || $outcome_grid->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $outcome_grid->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $outcome_grid->DepartmentCode->Lookup->getParamTag($outcome_grid, "p_x" . $outcome_grid->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="outcome" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $outcome_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $outcome_grid->RowIndex ?>_DepartmentCode" value="<?php echo $outcome_grid->DepartmentCode->CurrentValue ?>"<?php echo $outcome_grid->DepartmentCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="outcome" data-field="x_DepartmentCode" name="o<?php echo $outcome_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $outcome_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($outcome_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_DepartmentCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $outcome_grid->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($outcome_grid->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $outcome_grid->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_grid->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_grid->DepartmentCode->ReadOnly || $outcome_grid->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $outcome_grid->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $outcome_grid->DepartmentCode->Lookup->getParamTag($outcome_grid, "p_x" . $outcome_grid->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="outcome" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $outcome_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $outcome_grid->RowIndex ?>_DepartmentCode" value="<?php echo $outcome_grid->DepartmentCode->CurrentValue ?>"<?php echo $outcome_grid->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_DepartmentCode">
<span<?php echo $outcome_grid->DepartmentCode->viewAttributes() ?>><?php echo $outcome_grid->DepartmentCode->getViewValue() ?></span>
</span>
<?php if (!$outcome->isConfirm()) { ?>
<input type="hidden" data-table="outcome" data-field="x_DepartmentCode" name="x<?php echo $outcome_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $outcome_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($outcome_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="outcome" data-field="x_DepartmentCode" name="o<?php echo $outcome_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $outcome_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($outcome_grid->DepartmentCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="outcome" data-field="x_DepartmentCode" name="foutcomegrid$x<?php echo $outcome_grid->RowIndex ?>_DepartmentCode" id="foutcomegrid$x<?php echo $outcome_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($outcome_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="outcome" data-field="x_DepartmentCode" name="foutcomegrid$o<?php echo $outcome_grid->RowIndex ?>_DepartmentCode" id="foutcomegrid$o<?php echo $outcome_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($outcome_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($outcome_grid->OutcomeKPI->Visible) { // OutcomeKPI ?>
		<td data-name="OutcomeKPI" <?php echo $outcome_grid->OutcomeKPI->cellAttributes() ?>>
<?php if ($outcome->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_OutcomeKPI" class="form-group">
<textarea data-table="outcome" data-field="x_OutcomeKPI" name="x<?php echo $outcome_grid->RowIndex ?>_OutcomeKPI" id="x<?php echo $outcome_grid->RowIndex ?>_OutcomeKPI" cols="50" rows="2" placeholder="<?php echo HtmlEncode($outcome_grid->OutcomeKPI->getPlaceHolder()) ?>"<?php echo $outcome_grid->OutcomeKPI->editAttributes() ?>><?php echo $outcome_grid->OutcomeKPI->EditValue ?></textarea>
</span>
<input type="hidden" data-table="outcome" data-field="x_OutcomeKPI" name="o<?php echo $outcome_grid->RowIndex ?>_OutcomeKPI" id="o<?php echo $outcome_grid->RowIndex ?>_OutcomeKPI" value="<?php echo HtmlEncode($outcome_grid->OutcomeKPI->OldValue) ?>">
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_OutcomeKPI" class="form-group">
<textarea data-table="outcome" data-field="x_OutcomeKPI" name="x<?php echo $outcome_grid->RowIndex ?>_OutcomeKPI" id="x<?php echo $outcome_grid->RowIndex ?>_OutcomeKPI" cols="50" rows="2" placeholder="<?php echo HtmlEncode($outcome_grid->OutcomeKPI->getPlaceHolder()) ?>"<?php echo $outcome_grid->OutcomeKPI->editAttributes() ?>><?php echo $outcome_grid->OutcomeKPI->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_OutcomeKPI">
<span<?php echo $outcome_grid->OutcomeKPI->viewAttributes() ?>><?php echo $outcome_grid->OutcomeKPI->getViewValue() ?></span>
</span>
<?php if (!$outcome->isConfirm()) { ?>
<input type="hidden" data-table="outcome" data-field="x_OutcomeKPI" name="x<?php echo $outcome_grid->RowIndex ?>_OutcomeKPI" id="x<?php echo $outcome_grid->RowIndex ?>_OutcomeKPI" value="<?php echo HtmlEncode($outcome_grid->OutcomeKPI->FormValue) ?>">
<input type="hidden" data-table="outcome" data-field="x_OutcomeKPI" name="o<?php echo $outcome_grid->RowIndex ?>_OutcomeKPI" id="o<?php echo $outcome_grid->RowIndex ?>_OutcomeKPI" value="<?php echo HtmlEncode($outcome_grid->OutcomeKPI->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="outcome" data-field="x_OutcomeKPI" name="foutcomegrid$x<?php echo $outcome_grid->RowIndex ?>_OutcomeKPI" id="foutcomegrid$x<?php echo $outcome_grid->RowIndex ?>_OutcomeKPI" value="<?php echo HtmlEncode($outcome_grid->OutcomeKPI->FormValue) ?>">
<input type="hidden" data-table="outcome" data-field="x_OutcomeKPI" name="foutcomegrid$o<?php echo $outcome_grid->RowIndex ?>_OutcomeKPI" id="foutcomegrid$o<?php echo $outcome_grid->RowIndex ?>_OutcomeKPI" value="<?php echo HtmlEncode($outcome_grid->OutcomeKPI->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($outcome_grid->Assumptions->Visible) { // Assumptions ?>
		<td data-name="Assumptions" <?php echo $outcome_grid->Assumptions->cellAttributes() ?>>
<?php if ($outcome->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_Assumptions" class="form-group">
<textarea data-table="outcome" data-field="x_Assumptions" name="x<?php echo $outcome_grid->RowIndex ?>_Assumptions" id="x<?php echo $outcome_grid->RowIndex ?>_Assumptions" cols="50" rows="2" placeholder="<?php echo HtmlEncode($outcome_grid->Assumptions->getPlaceHolder()) ?>"<?php echo $outcome_grid->Assumptions->editAttributes() ?>><?php echo $outcome_grid->Assumptions->EditValue ?></textarea>
</span>
<input type="hidden" data-table="outcome" data-field="x_Assumptions" name="o<?php echo $outcome_grid->RowIndex ?>_Assumptions" id="o<?php echo $outcome_grid->RowIndex ?>_Assumptions" value="<?php echo HtmlEncode($outcome_grid->Assumptions->OldValue) ?>">
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_Assumptions" class="form-group">
<textarea data-table="outcome" data-field="x_Assumptions" name="x<?php echo $outcome_grid->RowIndex ?>_Assumptions" id="x<?php echo $outcome_grid->RowIndex ?>_Assumptions" cols="50" rows="2" placeholder="<?php echo HtmlEncode($outcome_grid->Assumptions->getPlaceHolder()) ?>"<?php echo $outcome_grid->Assumptions->editAttributes() ?>><?php echo $outcome_grid->Assumptions->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_Assumptions">
<span<?php echo $outcome_grid->Assumptions->viewAttributes() ?>><?php echo $outcome_grid->Assumptions->getViewValue() ?></span>
</span>
<?php if (!$outcome->isConfirm()) { ?>
<input type="hidden" data-table="outcome" data-field="x_Assumptions" name="x<?php echo $outcome_grid->RowIndex ?>_Assumptions" id="x<?php echo $outcome_grid->RowIndex ?>_Assumptions" value="<?php echo HtmlEncode($outcome_grid->Assumptions->FormValue) ?>">
<input type="hidden" data-table="outcome" data-field="x_Assumptions" name="o<?php echo $outcome_grid->RowIndex ?>_Assumptions" id="o<?php echo $outcome_grid->RowIndex ?>_Assumptions" value="<?php echo HtmlEncode($outcome_grid->Assumptions->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="outcome" data-field="x_Assumptions" name="foutcomegrid$x<?php echo $outcome_grid->RowIndex ?>_Assumptions" id="foutcomegrid$x<?php echo $outcome_grid->RowIndex ?>_Assumptions" value="<?php echo HtmlEncode($outcome_grid->Assumptions->FormValue) ?>">
<input type="hidden" data-table="outcome" data-field="x_Assumptions" name="foutcomegrid$o<?php echo $outcome_grid->RowIndex ?>_Assumptions" id="foutcomegrid$o<?php echo $outcome_grid->RowIndex ?>_Assumptions" value="<?php echo HtmlEncode($outcome_grid->Assumptions->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($outcome_grid->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
		<td data-name="ResponsibleOfficer" <?php echo $outcome_grid->ResponsibleOfficer->cellAttributes() ?>>
<?php if ($outcome->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_ResponsibleOfficer" class="form-group">
<input type="text" data-table="outcome" data-field="x_ResponsibleOfficer" name="x<?php echo $outcome_grid->RowIndex ?>_ResponsibleOfficer" id="x<?php echo $outcome_grid->RowIndex ?>_ResponsibleOfficer" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($outcome_grid->ResponsibleOfficer->getPlaceHolder()) ?>" value="<?php echo $outcome_grid->ResponsibleOfficer->EditValue ?>"<?php echo $outcome_grid->ResponsibleOfficer->editAttributes() ?>>
</span>
<input type="hidden" data-table="outcome" data-field="x_ResponsibleOfficer" name="o<?php echo $outcome_grid->RowIndex ?>_ResponsibleOfficer" id="o<?php echo $outcome_grid->RowIndex ?>_ResponsibleOfficer" value="<?php echo HtmlEncode($outcome_grid->ResponsibleOfficer->OldValue) ?>">
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_ResponsibleOfficer" class="form-group">
<input type="text" data-table="outcome" data-field="x_ResponsibleOfficer" name="x<?php echo $outcome_grid->RowIndex ?>_ResponsibleOfficer" id="x<?php echo $outcome_grid->RowIndex ?>_ResponsibleOfficer" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($outcome_grid->ResponsibleOfficer->getPlaceHolder()) ?>" value="<?php echo $outcome_grid->ResponsibleOfficer->EditValue ?>"<?php echo $outcome_grid->ResponsibleOfficer->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_ResponsibleOfficer">
<span<?php echo $outcome_grid->ResponsibleOfficer->viewAttributes() ?>><?php echo $outcome_grid->ResponsibleOfficer->getViewValue() ?></span>
</span>
<?php if (!$outcome->isConfirm()) { ?>
<input type="hidden" data-table="outcome" data-field="x_ResponsibleOfficer" name="x<?php echo $outcome_grid->RowIndex ?>_ResponsibleOfficer" id="x<?php echo $outcome_grid->RowIndex ?>_ResponsibleOfficer" value="<?php echo HtmlEncode($outcome_grid->ResponsibleOfficer->FormValue) ?>">
<input type="hidden" data-table="outcome" data-field="x_ResponsibleOfficer" name="o<?php echo $outcome_grid->RowIndex ?>_ResponsibleOfficer" id="o<?php echo $outcome_grid->RowIndex ?>_ResponsibleOfficer" value="<?php echo HtmlEncode($outcome_grid->ResponsibleOfficer->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="outcome" data-field="x_ResponsibleOfficer" name="foutcomegrid$x<?php echo $outcome_grid->RowIndex ?>_ResponsibleOfficer" id="foutcomegrid$x<?php echo $outcome_grid->RowIndex ?>_ResponsibleOfficer" value="<?php echo HtmlEncode($outcome_grid->ResponsibleOfficer->FormValue) ?>">
<input type="hidden" data-table="outcome" data-field="x_ResponsibleOfficer" name="foutcomegrid$o<?php echo $outcome_grid->RowIndex ?>_ResponsibleOfficer" id="foutcomegrid$o<?php echo $outcome_grid->RowIndex ?>_ResponsibleOfficer" value="<?php echo HtmlEncode($outcome_grid->ResponsibleOfficer->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($outcome_grid->OutcomeStatus->Visible) { // OutcomeStatus ?>
		<td data-name="OutcomeStatus" <?php echo $outcome_grid->OutcomeStatus->cellAttributes() ?>>
<?php if ($outcome->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_OutcomeStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="outcome" data-field="x_OutcomeStatus" data-value-separator="<?php echo $outcome_grid->OutcomeStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $outcome_grid->RowIndex ?>_OutcomeStatus" name="x<?php echo $outcome_grid->RowIndex ?>_OutcomeStatus"<?php echo $outcome_grid->OutcomeStatus->editAttributes() ?>>
			<?php echo $outcome_grid->OutcomeStatus->selectOptionListHtml("x{$outcome_grid->RowIndex}_OutcomeStatus") ?>
		</select>
</div>
<?php echo $outcome_grid->OutcomeStatus->Lookup->getParamTag($outcome_grid, "p_x" . $outcome_grid->RowIndex . "_OutcomeStatus") ?>
</span>
<input type="hidden" data-table="outcome" data-field="x_OutcomeStatus" name="o<?php echo $outcome_grid->RowIndex ?>_OutcomeStatus" id="o<?php echo $outcome_grid->RowIndex ?>_OutcomeStatus" value="<?php echo HtmlEncode($outcome_grid->OutcomeStatus->OldValue) ?>">
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_OutcomeStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="outcome" data-field="x_OutcomeStatus" data-value-separator="<?php echo $outcome_grid->OutcomeStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $outcome_grid->RowIndex ?>_OutcomeStatus" name="x<?php echo $outcome_grid->RowIndex ?>_OutcomeStatus"<?php echo $outcome_grid->OutcomeStatus->editAttributes() ?>>
			<?php echo $outcome_grid->OutcomeStatus->selectOptionListHtml("x{$outcome_grid->RowIndex}_OutcomeStatus") ?>
		</select>
</div>
<?php echo $outcome_grid->OutcomeStatus->Lookup->getParamTag($outcome_grid, "p_x" . $outcome_grid->RowIndex . "_OutcomeStatus") ?>
</span>
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $outcome_grid->RowCount ?>_outcome_OutcomeStatus">
<span<?php echo $outcome_grid->OutcomeStatus->viewAttributes() ?>><?php echo $outcome_grid->OutcomeStatus->getViewValue() ?></span>
</span>
<?php if (!$outcome->isConfirm()) { ?>
<input type="hidden" data-table="outcome" data-field="x_OutcomeStatus" name="x<?php echo $outcome_grid->RowIndex ?>_OutcomeStatus" id="x<?php echo $outcome_grid->RowIndex ?>_OutcomeStatus" value="<?php echo HtmlEncode($outcome_grid->OutcomeStatus->FormValue) ?>">
<input type="hidden" data-table="outcome" data-field="x_OutcomeStatus" name="o<?php echo $outcome_grid->RowIndex ?>_OutcomeStatus" id="o<?php echo $outcome_grid->RowIndex ?>_OutcomeStatus" value="<?php echo HtmlEncode($outcome_grid->OutcomeStatus->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="outcome" data-field="x_OutcomeStatus" name="foutcomegrid$x<?php echo $outcome_grid->RowIndex ?>_OutcomeStatus" id="foutcomegrid$x<?php echo $outcome_grid->RowIndex ?>_OutcomeStatus" value="<?php echo HtmlEncode($outcome_grid->OutcomeStatus->FormValue) ?>">
<input type="hidden" data-table="outcome" data-field="x_OutcomeStatus" name="foutcomegrid$o<?php echo $outcome_grid->RowIndex ?>_OutcomeStatus" id="foutcomegrid$o<?php echo $outcome_grid->RowIndex ?>_OutcomeStatus" value="<?php echo HtmlEncode($outcome_grid->OutcomeStatus->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$outcome_grid->ListOptions->render("body", "right", $outcome_grid->RowCount);
?>
	</tr>
<?php if ($outcome->RowType == ROWTYPE_ADD || $outcome->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["foutcomegrid", "load"], function() {
	foutcomegrid.updateLists(<?php echo $outcome_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$outcome_grid->isGridAdd() || $outcome->CurrentMode == "copy")
		if (!$outcome_grid->Recordset->EOF)
			$outcome_grid->Recordset->moveNext();
}
?>
<?php
	if ($outcome->CurrentMode == "add" || $outcome->CurrentMode == "copy" || $outcome->CurrentMode == "edit") {
		$outcome_grid->RowIndex = '$rowindex$';
		$outcome_grid->loadRowValues();

		// Set row properties
		$outcome->resetAttributes();
		$outcome->RowAttrs->merge(["data-rowindex" => $outcome_grid->RowIndex, "id" => "r0_outcome", "data-rowtype" => ROWTYPE_ADD]);
		$outcome->RowAttrs->appendClass("ew-template");
		$outcome->RowType = ROWTYPE_ADD;

		// Render row
		$outcome_grid->renderRow();

		// Render list options
		$outcome_grid->renderListOptions();
		$outcome_grid->StartRowCount = 0;
?>
	<tr <?php echo $outcome->rowAttributes() ?>>
<?php

// Render list options (body, left)
$outcome_grid->ListOptions->render("body", "left", $outcome_grid->RowIndex);
?>
	<?php if ($outcome_grid->OutcomeCode->Visible) { // OutcomeCode ?>
		<td data-name="OutcomeCode">
<?php if (!$outcome->isConfirm()) { ?>
<span id="el$rowindex$_outcome_OutcomeCode" class="form-group outcome_OutcomeCode"></span>
<?php } else { ?>
<span id="el$rowindex$_outcome_OutcomeCode" class="form-group outcome_OutcomeCode">
<span<?php echo $outcome_grid->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_grid->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="outcome" data-field="x_OutcomeCode" name="x<?php echo $outcome_grid->RowIndex ?>_OutcomeCode" id="x<?php echo $outcome_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($outcome_grid->OutcomeCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="outcome" data-field="x_OutcomeCode" name="o<?php echo $outcome_grid->RowIndex ?>_OutcomeCode" id="o<?php echo $outcome_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($outcome_grid->OutcomeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($outcome_grid->OutcomeName->Visible) { // OutcomeName ?>
		<td data-name="OutcomeName">
<?php if (!$outcome->isConfirm()) { ?>
<span id="el$rowindex$_outcome_OutcomeName" class="form-group outcome_OutcomeName">
<textarea data-table="outcome" data-field="x_OutcomeName" name="x<?php echo $outcome_grid->RowIndex ?>_OutcomeName" id="x<?php echo $outcome_grid->RowIndex ?>_OutcomeName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($outcome_grid->OutcomeName->getPlaceHolder()) ?>"<?php echo $outcome_grid->OutcomeName->editAttributes() ?>><?php echo $outcome_grid->OutcomeName->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_outcome_OutcomeName" class="form-group outcome_OutcomeName">
<span<?php echo $outcome_grid->OutcomeName->viewAttributes() ?>><?php echo $outcome_grid->OutcomeName->ViewValue ?></span>
</span>
<input type="hidden" data-table="outcome" data-field="x_OutcomeName" name="x<?php echo $outcome_grid->RowIndex ?>_OutcomeName" id="x<?php echo $outcome_grid->RowIndex ?>_OutcomeName" value="<?php echo HtmlEncode($outcome_grid->OutcomeName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="outcome" data-field="x_OutcomeName" name="o<?php echo $outcome_grid->RowIndex ?>_OutcomeName" id="o<?php echo $outcome_grid->RowIndex ?>_OutcomeName" value="<?php echo HtmlEncode($outcome_grid->OutcomeName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($outcome_grid->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
		<td data-name="StrategicObjectiveCode">
<?php if (!$outcome->isConfirm()) { ?>
<?php if ($outcome_grid->StrategicObjectiveCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_outcome_StrategicObjectiveCode" class="form-group outcome_StrategicObjectiveCode">
<span<?php echo $outcome_grid->StrategicObjectiveCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_grid->StrategicObjectiveCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" name="x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_grid->StrategicObjectiveCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_outcome_StrategicObjectiveCode" class="form-group outcome_StrategicObjectiveCode">
<?php
$onchange = $outcome_grid->StrategicObjectiveCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$outcome_grid->StrategicObjectiveCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" id="sv_x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" value="<?php echo RemoveHtml($outcome_grid->StrategicObjectiveCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($outcome_grid->StrategicObjectiveCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($outcome_grid->StrategicObjectiveCode->getPlaceHolder()) ?>"<?php echo $outcome_grid->StrategicObjectiveCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_grid->StrategicObjectiveCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_grid->StrategicObjectiveCode->ReadOnly || $outcome_grid->StrategicObjectiveCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="outcome" data-field="x_StrategicObjectiveCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_grid->StrategicObjectiveCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" id="x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_grid->StrategicObjectiveCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutcomegrid"], function() {
	foutcomegrid.createAutoSuggest({"id":"x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode","forceSelect":true});
});
</script>
<?php echo $outcome_grid->StrategicObjectiveCode->Lookup->getParamTag($outcome_grid, "p_x" . $outcome_grid->RowIndex . "_StrategicObjectiveCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_outcome_StrategicObjectiveCode" class="form-group outcome_StrategicObjectiveCode">
<span<?php echo $outcome_grid->StrategicObjectiveCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_grid->StrategicObjectiveCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="outcome" data-field="x_StrategicObjectiveCode" name="x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" id="x<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_grid->StrategicObjectiveCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="outcome" data-field="x_StrategicObjectiveCode" name="o<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" id="o<?php echo $outcome_grid->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_grid->StrategicObjectiveCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($outcome_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if (!$outcome->isConfirm()) { ?>
<?php if ($outcome_grid->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_outcome_LACode" class="form-group outcome_LACode">
<span<?php echo $outcome_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $outcome_grid->RowIndex ?>_LACode" name="x<?php echo $outcome_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($outcome_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_outcome_LACode" class="form-group outcome_LACode">
<?php
$onchange = $outcome_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$outcome_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $outcome_grid->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $outcome_grid->RowIndex ?>_LACode" id="sv_x<?php echo $outcome_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($outcome_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($outcome_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($outcome_grid->LACode->getPlaceHolder()) ?>"<?php echo $outcome_grid->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $outcome_grid->RowIndex ?>_LACode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_grid->LACode->ReadOnly || $outcome_grid->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="outcome" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $outcome_grid->RowIndex ?>_LACode" id="x<?php echo $outcome_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($outcome_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutcomegrid"], function() {
	foutcomegrid.createAutoSuggest({"id":"x<?php echo $outcome_grid->RowIndex ?>_LACode","forceSelect":true});
});
</script>
<?php echo $outcome_grid->LACode->Lookup->getParamTag($outcome_grid, "p_x" . $outcome_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_outcome_LACode" class="form-group outcome_LACode">
<span<?php echo $outcome_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="outcome" data-field="x_LACode" name="x<?php echo $outcome_grid->RowIndex ?>_LACode" id="x<?php echo $outcome_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($outcome_grid->LACode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="outcome" data-field="x_LACode" name="o<?php echo $outcome_grid->RowIndex ?>_LACode" id="o<?php echo $outcome_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($outcome_grid->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($outcome_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<?php if (!$outcome->isConfirm()) { ?>
<span id="el$rowindex$_outcome_DepartmentCode" class="form-group outcome_DepartmentCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $outcome_grid->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($outcome_grid->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $outcome_grid->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_grid->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_grid->DepartmentCode->ReadOnly || $outcome_grid->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $outcome_grid->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $outcome_grid->DepartmentCode->Lookup->getParamTag($outcome_grid, "p_x" . $outcome_grid->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="outcome" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $outcome_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $outcome_grid->RowIndex ?>_DepartmentCode" value="<?php echo $outcome_grid->DepartmentCode->CurrentValue ?>"<?php echo $outcome_grid->DepartmentCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_outcome_DepartmentCode" class="form-group outcome_DepartmentCode">
<span<?php echo $outcome_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="outcome" data-field="x_DepartmentCode" name="x<?php echo $outcome_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $outcome_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($outcome_grid->DepartmentCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="outcome" data-field="x_DepartmentCode" name="o<?php echo $outcome_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $outcome_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($outcome_grid->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($outcome_grid->OutcomeKPI->Visible) { // OutcomeKPI ?>
		<td data-name="OutcomeKPI">
<?php if (!$outcome->isConfirm()) { ?>
<span id="el$rowindex$_outcome_OutcomeKPI" class="form-group outcome_OutcomeKPI">
<textarea data-table="outcome" data-field="x_OutcomeKPI" name="x<?php echo $outcome_grid->RowIndex ?>_OutcomeKPI" id="x<?php echo $outcome_grid->RowIndex ?>_OutcomeKPI" cols="50" rows="2" placeholder="<?php echo HtmlEncode($outcome_grid->OutcomeKPI->getPlaceHolder()) ?>"<?php echo $outcome_grid->OutcomeKPI->editAttributes() ?>><?php echo $outcome_grid->OutcomeKPI->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_outcome_OutcomeKPI" class="form-group outcome_OutcomeKPI">
<span<?php echo $outcome_grid->OutcomeKPI->viewAttributes() ?>><?php echo $outcome_grid->OutcomeKPI->ViewValue ?></span>
</span>
<input type="hidden" data-table="outcome" data-field="x_OutcomeKPI" name="x<?php echo $outcome_grid->RowIndex ?>_OutcomeKPI" id="x<?php echo $outcome_grid->RowIndex ?>_OutcomeKPI" value="<?php echo HtmlEncode($outcome_grid->OutcomeKPI->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="outcome" data-field="x_OutcomeKPI" name="o<?php echo $outcome_grid->RowIndex ?>_OutcomeKPI" id="o<?php echo $outcome_grid->RowIndex ?>_OutcomeKPI" value="<?php echo HtmlEncode($outcome_grid->OutcomeKPI->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($outcome_grid->Assumptions->Visible) { // Assumptions ?>
		<td data-name="Assumptions">
<?php if (!$outcome->isConfirm()) { ?>
<span id="el$rowindex$_outcome_Assumptions" class="form-group outcome_Assumptions">
<textarea data-table="outcome" data-field="x_Assumptions" name="x<?php echo $outcome_grid->RowIndex ?>_Assumptions" id="x<?php echo $outcome_grid->RowIndex ?>_Assumptions" cols="50" rows="2" placeholder="<?php echo HtmlEncode($outcome_grid->Assumptions->getPlaceHolder()) ?>"<?php echo $outcome_grid->Assumptions->editAttributes() ?>><?php echo $outcome_grid->Assumptions->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_outcome_Assumptions" class="form-group outcome_Assumptions">
<span<?php echo $outcome_grid->Assumptions->viewAttributes() ?>><?php echo $outcome_grid->Assumptions->ViewValue ?></span>
</span>
<input type="hidden" data-table="outcome" data-field="x_Assumptions" name="x<?php echo $outcome_grid->RowIndex ?>_Assumptions" id="x<?php echo $outcome_grid->RowIndex ?>_Assumptions" value="<?php echo HtmlEncode($outcome_grid->Assumptions->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="outcome" data-field="x_Assumptions" name="o<?php echo $outcome_grid->RowIndex ?>_Assumptions" id="o<?php echo $outcome_grid->RowIndex ?>_Assumptions" value="<?php echo HtmlEncode($outcome_grid->Assumptions->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($outcome_grid->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
		<td data-name="ResponsibleOfficer">
<?php if (!$outcome->isConfirm()) { ?>
<span id="el$rowindex$_outcome_ResponsibleOfficer" class="form-group outcome_ResponsibleOfficer">
<input type="text" data-table="outcome" data-field="x_ResponsibleOfficer" name="x<?php echo $outcome_grid->RowIndex ?>_ResponsibleOfficer" id="x<?php echo $outcome_grid->RowIndex ?>_ResponsibleOfficer" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($outcome_grid->ResponsibleOfficer->getPlaceHolder()) ?>" value="<?php echo $outcome_grid->ResponsibleOfficer->EditValue ?>"<?php echo $outcome_grid->ResponsibleOfficer->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_outcome_ResponsibleOfficer" class="form-group outcome_ResponsibleOfficer">
<span<?php echo $outcome_grid->ResponsibleOfficer->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_grid->ResponsibleOfficer->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="outcome" data-field="x_ResponsibleOfficer" name="x<?php echo $outcome_grid->RowIndex ?>_ResponsibleOfficer" id="x<?php echo $outcome_grid->RowIndex ?>_ResponsibleOfficer" value="<?php echo HtmlEncode($outcome_grid->ResponsibleOfficer->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="outcome" data-field="x_ResponsibleOfficer" name="o<?php echo $outcome_grid->RowIndex ?>_ResponsibleOfficer" id="o<?php echo $outcome_grid->RowIndex ?>_ResponsibleOfficer" value="<?php echo HtmlEncode($outcome_grid->ResponsibleOfficer->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($outcome_grid->OutcomeStatus->Visible) { // OutcomeStatus ?>
		<td data-name="OutcomeStatus">
<?php if (!$outcome->isConfirm()) { ?>
<span id="el$rowindex$_outcome_OutcomeStatus" class="form-group outcome_OutcomeStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="outcome" data-field="x_OutcomeStatus" data-value-separator="<?php echo $outcome_grid->OutcomeStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $outcome_grid->RowIndex ?>_OutcomeStatus" name="x<?php echo $outcome_grid->RowIndex ?>_OutcomeStatus"<?php echo $outcome_grid->OutcomeStatus->editAttributes() ?>>
			<?php echo $outcome_grid->OutcomeStatus->selectOptionListHtml("x{$outcome_grid->RowIndex}_OutcomeStatus") ?>
		</select>
</div>
<?php echo $outcome_grid->OutcomeStatus->Lookup->getParamTag($outcome_grid, "p_x" . $outcome_grid->RowIndex . "_OutcomeStatus") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_outcome_OutcomeStatus" class="form-group outcome_OutcomeStatus">
<span<?php echo $outcome_grid->OutcomeStatus->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_grid->OutcomeStatus->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="outcome" data-field="x_OutcomeStatus" name="x<?php echo $outcome_grid->RowIndex ?>_OutcomeStatus" id="x<?php echo $outcome_grid->RowIndex ?>_OutcomeStatus" value="<?php echo HtmlEncode($outcome_grid->OutcomeStatus->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="outcome" data-field="x_OutcomeStatus" name="o<?php echo $outcome_grid->RowIndex ?>_OutcomeStatus" id="o<?php echo $outcome_grid->RowIndex ?>_OutcomeStatus" value="<?php echo HtmlEncode($outcome_grid->OutcomeStatus->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$outcome_grid->ListOptions->render("body", "right", $outcome_grid->RowIndex);
?>
<script>
loadjs.ready(["foutcomegrid", "load"], function() {
	foutcomegrid.updateLists(<?php echo $outcome_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($outcome->CurrentMode == "add" || $outcome->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $outcome_grid->FormKeyCountName ?>" id="<?php echo $outcome_grid->FormKeyCountName ?>" value="<?php echo $outcome_grid->KeyCount ?>">
<?php echo $outcome_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($outcome->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $outcome_grid->FormKeyCountName ?>" id="<?php echo $outcome_grid->FormKeyCountName ?>" value="<?php echo $outcome_grid->KeyCount ?>">
<?php echo $outcome_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($outcome->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="foutcomegrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($outcome_grid->Recordset)
	$outcome_grid->Recordset->Close();
?>
<?php if ($outcome_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $outcome_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($outcome_grid->TotalRecords == 0 && !$outcome->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $outcome_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$outcome_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$outcome_grid->terminate();
?>