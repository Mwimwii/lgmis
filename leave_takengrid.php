<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($leave_taken_grid))
	$leave_taken_grid = new leave_taken_grid();

// Run the page
$leave_taken_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_taken_grid->Page_Render();
?>
<?php if (!$leave_taken_grid->isExport()) { ?>
<script>
var fleave_takengrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fleave_takengrid = new ew.Form("fleave_takengrid", "grid");
	fleave_takengrid.formKeyCountName = '<?php echo $leave_taken_grid->FormKeyCountName ?>';

	// Validate form
	fleave_takengrid.validate = function() {
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
			<?php if ($leave_taken_grid->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_grid->EmployeeID->caption(), $leave_taken_grid->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_taken_grid->EmployeeID->errorMessage()) ?>");
			<?php if ($leave_taken_grid->LeaveTypeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveTypeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_grid->LeaveTypeCode->caption(), $leave_taken_grid->LeaveTypeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_taken_grid->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_grid->StartDate->caption(), $leave_taken_grid->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_taken_grid->StartDate->errorMessage()) ?>");
			<?php if ($leave_taken_grid->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_grid->EndDate->caption(), $leave_taken_grid->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_taken_grid->EndDate->errorMessage()) ?>");
			<?php if ($leave_taken_grid->Commuted->Required) { ?>
				elm = this.getElements("x" + infix + "_Commuted");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_grid->Commuted->caption(), $leave_taken_grid->Commuted->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Commuted");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_taken_grid->Commuted->errorMessage()) ?>");
			<?php if ($leave_taken_grid->LeaveDays->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveDays");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_grid->LeaveDays->caption(), $leave_taken_grid->LeaveDays->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LeaveDays");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_taken_grid->LeaveDays->errorMessage()) ?>");
			<?php if ($leave_taken_grid->Location->Required) { ?>
				elm = this.getElements("x" + infix + "_Location");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_grid->Location->caption(), $leave_taken_grid->Location->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_taken_grid->Remarks->Required) { ?>
				elm = this.getElements("x" + infix + "_Remarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_grid->Remarks->caption(), $leave_taken_grid->Remarks->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fleave_takengrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "EmployeeID", false)) return false;
		if (ew.valueChanged(fobj, infix, "LeaveTypeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "StartDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "EndDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "Commuted", false)) return false;
		if (ew.valueChanged(fobj, infix, "LeaveDays", false)) return false;
		if (ew.valueChanged(fobj, infix, "Location", false)) return false;
		if (ew.valueChanged(fobj, infix, "Remarks", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fleave_takengrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fleave_takengrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fleave_takengrid.lists["x_LeaveTypeCode"] = <?php echo $leave_taken_grid->LeaveTypeCode->Lookup->toClientList($leave_taken_grid) ?>;
	fleave_takengrid.lists["x_LeaveTypeCode"].options = <?php echo JsonEncode($leave_taken_grid->LeaveTypeCode->lookupOptions()) ?>;
	loadjs.done("fleave_takengrid");
});
</script>
<?php } ?>
<?php
$leave_taken_grid->renderOtherOptions();
?>
<?php if ($leave_taken_grid->TotalRecords > 0 || $leave_taken->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($leave_taken_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> leave_taken">
<?php if ($leave_taken_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $leave_taken_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fleave_takengrid" class="ew-form ew-list-form form-inline">
<div id="gmp_leave_taken" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_leave_takengrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$leave_taken->RowType = ROWTYPE_HEADER;

// Render list options
$leave_taken_grid->renderListOptions();

// Render list options (header, left)
$leave_taken_grid->ListOptions->render("header", "left");
?>
<?php if ($leave_taken_grid->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($leave_taken_grid->SortUrl($leave_taken_grid->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $leave_taken_grid->EmployeeID->headerCellClass() ?>"><div id="elh_leave_taken_EmployeeID" class="leave_taken_EmployeeID"><div class="ew-table-header-caption"><?php echo $leave_taken_grid->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $leave_taken_grid->EmployeeID->headerCellClass() ?>"><div><div id="elh_leave_taken_EmployeeID" class="leave_taken_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_taken_grid->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_taken_grid->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_taken_grid->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_taken_grid->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<?php if ($leave_taken_grid->SortUrl($leave_taken_grid->LeaveTypeCode) == "") { ?>
		<th data-name="LeaveTypeCode" class="<?php echo $leave_taken_grid->LeaveTypeCode->headerCellClass() ?>"><div id="elh_leave_taken_LeaveTypeCode" class="leave_taken_LeaveTypeCode"><div class="ew-table-header-caption"><?php echo $leave_taken_grid->LeaveTypeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeaveTypeCode" class="<?php echo $leave_taken_grid->LeaveTypeCode->headerCellClass() ?>"><div><div id="elh_leave_taken_LeaveTypeCode" class="leave_taken_LeaveTypeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_taken_grid->LeaveTypeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_taken_grid->LeaveTypeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_taken_grid->LeaveTypeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_taken_grid->StartDate->Visible) { // StartDate ?>
	<?php if ($leave_taken_grid->SortUrl($leave_taken_grid->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $leave_taken_grid->StartDate->headerCellClass() ?>"><div id="elh_leave_taken_StartDate" class="leave_taken_StartDate"><div class="ew-table-header-caption"><?php echo $leave_taken_grid->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $leave_taken_grid->StartDate->headerCellClass() ?>"><div><div id="elh_leave_taken_StartDate" class="leave_taken_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_taken_grid->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_taken_grid->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_taken_grid->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_taken_grid->EndDate->Visible) { // EndDate ?>
	<?php if ($leave_taken_grid->SortUrl($leave_taken_grid->EndDate) == "") { ?>
		<th data-name="EndDate" class="<?php echo $leave_taken_grid->EndDate->headerCellClass() ?>"><div id="elh_leave_taken_EndDate" class="leave_taken_EndDate"><div class="ew-table-header-caption"><?php echo $leave_taken_grid->EndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EndDate" class="<?php echo $leave_taken_grid->EndDate->headerCellClass() ?>"><div><div id="elh_leave_taken_EndDate" class="leave_taken_EndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_taken_grid->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_taken_grid->EndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_taken_grid->EndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_taken_grid->Commuted->Visible) { // Commuted ?>
	<?php if ($leave_taken_grid->SortUrl($leave_taken_grid->Commuted) == "") { ?>
		<th data-name="Commuted" class="<?php echo $leave_taken_grid->Commuted->headerCellClass() ?>"><div id="elh_leave_taken_Commuted" class="leave_taken_Commuted"><div class="ew-table-header-caption"><?php echo $leave_taken_grid->Commuted->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Commuted" class="<?php echo $leave_taken_grid->Commuted->headerCellClass() ?>"><div><div id="elh_leave_taken_Commuted" class="leave_taken_Commuted">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_taken_grid->Commuted->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_taken_grid->Commuted->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_taken_grid->Commuted->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_taken_grid->LeaveDays->Visible) { // LeaveDays ?>
	<?php if ($leave_taken_grid->SortUrl($leave_taken_grid->LeaveDays) == "") { ?>
		<th data-name="LeaveDays" class="<?php echo $leave_taken_grid->LeaveDays->headerCellClass() ?>"><div id="elh_leave_taken_LeaveDays" class="leave_taken_LeaveDays"><div class="ew-table-header-caption"><?php echo $leave_taken_grid->LeaveDays->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeaveDays" class="<?php echo $leave_taken_grid->LeaveDays->headerCellClass() ?>"><div><div id="elh_leave_taken_LeaveDays" class="leave_taken_LeaveDays">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_taken_grid->LeaveDays->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_taken_grid->LeaveDays->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_taken_grid->LeaveDays->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_taken_grid->Location->Visible) { // Location ?>
	<?php if ($leave_taken_grid->SortUrl($leave_taken_grid->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $leave_taken_grid->Location->headerCellClass() ?>"><div id="elh_leave_taken_Location" class="leave_taken_Location"><div class="ew-table-header-caption"><?php echo $leave_taken_grid->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $leave_taken_grid->Location->headerCellClass() ?>"><div><div id="elh_leave_taken_Location" class="leave_taken_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_taken_grid->Location->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_taken_grid->Location->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_taken_grid->Location->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_taken_grid->Remarks->Visible) { // Remarks ?>
	<?php if ($leave_taken_grid->SortUrl($leave_taken_grid->Remarks) == "") { ?>
		<th data-name="Remarks" class="<?php echo $leave_taken_grid->Remarks->headerCellClass() ?>"><div id="elh_leave_taken_Remarks" class="leave_taken_Remarks"><div class="ew-table-header-caption"><?php echo $leave_taken_grid->Remarks->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Remarks" class="<?php echo $leave_taken_grid->Remarks->headerCellClass() ?>"><div><div id="elh_leave_taken_Remarks" class="leave_taken_Remarks">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_taken_grid->Remarks->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_taken_grid->Remarks->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_taken_grid->Remarks->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$leave_taken_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$leave_taken_grid->StartRecord = 1;
$leave_taken_grid->StopRecord = $leave_taken_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($leave_taken->isConfirm() || $leave_taken_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($leave_taken_grid->FormKeyCountName) && ($leave_taken_grid->isGridAdd() || $leave_taken_grid->isGridEdit() || $leave_taken->isConfirm())) {
		$leave_taken_grid->KeyCount = $CurrentForm->getValue($leave_taken_grid->FormKeyCountName);
		$leave_taken_grid->StopRecord = $leave_taken_grid->StartRecord + $leave_taken_grid->KeyCount - 1;
	}
}
$leave_taken_grid->RecordCount = $leave_taken_grid->StartRecord - 1;
if ($leave_taken_grid->Recordset && !$leave_taken_grid->Recordset->EOF) {
	$leave_taken_grid->Recordset->moveFirst();
	$selectLimit = $leave_taken_grid->UseSelectLimit;
	if (!$selectLimit && $leave_taken_grid->StartRecord > 1)
		$leave_taken_grid->Recordset->move($leave_taken_grid->StartRecord - 1);
} elseif (!$leave_taken->AllowAddDeleteRow && $leave_taken_grid->StopRecord == 0) {
	$leave_taken_grid->StopRecord = $leave_taken->GridAddRowCount;
}

// Initialize aggregate
$leave_taken->RowType = ROWTYPE_AGGREGATEINIT;
$leave_taken->resetAttributes();
$leave_taken_grid->renderRow();
if ($leave_taken_grid->isGridAdd())
	$leave_taken_grid->RowIndex = 0;
if ($leave_taken_grid->isGridEdit())
	$leave_taken_grid->RowIndex = 0;
while ($leave_taken_grid->RecordCount < $leave_taken_grid->StopRecord) {
	$leave_taken_grid->RecordCount++;
	if ($leave_taken_grid->RecordCount >= $leave_taken_grid->StartRecord) {
		$leave_taken_grid->RowCount++;
		if ($leave_taken_grid->isGridAdd() || $leave_taken_grid->isGridEdit() || $leave_taken->isConfirm()) {
			$leave_taken_grid->RowIndex++;
			$CurrentForm->Index = $leave_taken_grid->RowIndex;
			if ($CurrentForm->hasValue($leave_taken_grid->FormActionName) && ($leave_taken->isConfirm() || $leave_taken_grid->EventCancelled))
				$leave_taken_grid->RowAction = strval($CurrentForm->getValue($leave_taken_grid->FormActionName));
			elseif ($leave_taken_grid->isGridAdd())
				$leave_taken_grid->RowAction = "insert";
			else
				$leave_taken_grid->RowAction = "";
		}

		// Set up key count
		$leave_taken_grid->KeyCount = $leave_taken_grid->RowIndex;

		// Init row class and style
		$leave_taken->resetAttributes();
		$leave_taken->CssClass = "";
		if ($leave_taken_grid->isGridAdd()) {
			if ($leave_taken->CurrentMode == "copy") {
				$leave_taken_grid->loadRowValues($leave_taken_grid->Recordset); // Load row values
				$leave_taken_grid->setRecordKey($leave_taken_grid->RowOldKey, $leave_taken_grid->Recordset); // Set old record key
			} else {
				$leave_taken_grid->loadRowValues(); // Load default values
				$leave_taken_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$leave_taken_grid->loadRowValues($leave_taken_grid->Recordset); // Load row values
		}
		$leave_taken->RowType = ROWTYPE_VIEW; // Render view
		if ($leave_taken_grid->isGridAdd()) // Grid add
			$leave_taken->RowType = ROWTYPE_ADD; // Render add
		if ($leave_taken_grid->isGridAdd() && $leave_taken->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$leave_taken_grid->restoreCurrentRowFormValues($leave_taken_grid->RowIndex); // Restore form values
		if ($leave_taken_grid->isGridEdit()) { // Grid edit
			if ($leave_taken->EventCancelled)
				$leave_taken_grid->restoreCurrentRowFormValues($leave_taken_grid->RowIndex); // Restore form values
			if ($leave_taken_grid->RowAction == "insert")
				$leave_taken->RowType = ROWTYPE_ADD; // Render add
			else
				$leave_taken->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($leave_taken_grid->isGridEdit() && ($leave_taken->RowType == ROWTYPE_EDIT || $leave_taken->RowType == ROWTYPE_ADD) && $leave_taken->EventCancelled) // Update failed
			$leave_taken_grid->restoreCurrentRowFormValues($leave_taken_grid->RowIndex); // Restore form values
		if ($leave_taken->RowType == ROWTYPE_EDIT) // Edit row
			$leave_taken_grid->EditRowCount++;
		if ($leave_taken->isConfirm()) // Confirm row
			$leave_taken_grid->restoreCurrentRowFormValues($leave_taken_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$leave_taken->RowAttrs->merge(["data-rowindex" => $leave_taken_grid->RowCount, "id" => "r" . $leave_taken_grid->RowCount . "_leave_taken", "data-rowtype" => $leave_taken->RowType]);

		// Render row
		$leave_taken_grid->renderRow();

		// Render list options
		$leave_taken_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($leave_taken_grid->RowAction != "delete" && $leave_taken_grid->RowAction != "insertdelete" && !($leave_taken_grid->RowAction == "insert" && $leave_taken->isConfirm() && $leave_taken_grid->emptyRow())) {
?>
	<tr <?php echo $leave_taken->rowAttributes() ?>>
<?php

// Render list options (body, left)
$leave_taken_grid->ListOptions->render("body", "left", $leave_taken_grid->RowCount);
?>
	<?php if ($leave_taken_grid->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $leave_taken_grid->EmployeeID->cellAttributes() ?>>
<?php if ($leave_taken->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($leave_taken_grid->EmployeeID->getSessionValue() != "") { ?>
<span id="el<?php echo $leave_taken_grid->RowCount ?>_leave_taken_EmployeeID" class="form-group">
<span<?php echo $leave_taken_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_taken_grid->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" name="x<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_taken_grid->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $leave_taken_grid->RowCount ?>_leave_taken_EmployeeID" class="form-group">
<input type="text" data-table="leave_taken" data-field="x_EmployeeID" name="x<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" id="x<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($leave_taken_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $leave_taken_grid->EmployeeID->EditValue ?>"<?php echo $leave_taken_grid->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="leave_taken" data-field="x_EmployeeID" name="o<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" id="o<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_taken_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($leave_taken_grid->EmployeeID->getSessionValue() != "") { ?>

<span id="el<?php echo $leave_taken_grid->RowCount ?>_leave_taken_EmployeeID" class="form-group">
<span<?php echo $leave_taken_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_taken_grid->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" name="x<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_taken_grid->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="leave_taken" data-field="x_EmployeeID" name="x<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" id="x<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($leave_taken_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $leave_taken_grid->EmployeeID->EditValue ?>"<?php echo $leave_taken_grid->EmployeeID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="leave_taken" data-field="x_EmployeeID" name="o<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" id="o<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_taken_grid->EmployeeID->OldValue != null ? $leave_taken_grid->EmployeeID->OldValue : $leave_taken_grid->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_taken_grid->RowCount ?>_leave_taken_EmployeeID">
<span<?php echo $leave_taken_grid->EmployeeID->viewAttributes() ?>><?php echo $leave_taken_grid->EmployeeID->getViewValue() ?></span>
</span>
<?php if (!$leave_taken->isConfirm()) { ?>
<input type="hidden" data-table="leave_taken" data-field="x_EmployeeID" name="x<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" id="x<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_taken_grid->EmployeeID->FormValue) ?>">
<input type="hidden" data-table="leave_taken" data-field="x_EmployeeID" name="o<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" id="o<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_taken_grid->EmployeeID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="leave_taken" data-field="x_EmployeeID" name="fleave_takengrid$x<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" id="fleave_takengrid$x<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_taken_grid->EmployeeID->FormValue) ?>">
<input type="hidden" data-table="leave_taken" data-field="x_EmployeeID" name="fleave_takengrid$o<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" id="fleave_takengrid$o<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_taken_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_taken_grid->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<td data-name="LeaveTypeCode" <?php echo $leave_taken_grid->LeaveTypeCode->cellAttributes() ?>>
<?php if ($leave_taken->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_taken_grid->RowCount ?>_leave_taken_LeaveTypeCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="leave_taken" data-field="x_LeaveTypeCode" data-value-separator="<?php echo $leave_taken_grid->LeaveTypeCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $leave_taken_grid->RowIndex ?>_LeaveTypeCode" name="x<?php echo $leave_taken_grid->RowIndex ?>_LeaveTypeCode"<?php echo $leave_taken_grid->LeaveTypeCode->editAttributes() ?>>
			<?php echo $leave_taken_grid->LeaveTypeCode->selectOptionListHtml("x{$leave_taken_grid->RowIndex}_LeaveTypeCode") ?>
		</select>
</div>
<?php echo $leave_taken_grid->LeaveTypeCode->Lookup->getParamTag($leave_taken_grid, "p_x" . $leave_taken_grid->RowIndex . "_LeaveTypeCode") ?>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_LeaveTypeCode" name="o<?php echo $leave_taken_grid->RowIndex ?>_LeaveTypeCode" id="o<?php echo $leave_taken_grid->RowIndex ?>_LeaveTypeCode" value="<?php echo HtmlEncode($leave_taken_grid->LeaveTypeCode->OldValue) ?>">
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="leave_taken" data-field="x_LeaveTypeCode" data-value-separator="<?php echo $leave_taken_grid->LeaveTypeCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $leave_taken_grid->RowIndex ?>_LeaveTypeCode" name="x<?php echo $leave_taken_grid->RowIndex ?>_LeaveTypeCode"<?php echo $leave_taken_grid->LeaveTypeCode->editAttributes() ?>>
			<?php echo $leave_taken_grid->LeaveTypeCode->selectOptionListHtml("x{$leave_taken_grid->RowIndex}_LeaveTypeCode") ?>
		</select>
</div>
<?php echo $leave_taken_grid->LeaveTypeCode->Lookup->getParamTag($leave_taken_grid, "p_x" . $leave_taken_grid->RowIndex . "_LeaveTypeCode") ?>
<input type="hidden" data-table="leave_taken" data-field="x_LeaveTypeCode" name="o<?php echo $leave_taken_grid->RowIndex ?>_LeaveTypeCode" id="o<?php echo $leave_taken_grid->RowIndex ?>_LeaveTypeCode" value="<?php echo HtmlEncode($leave_taken_grid->LeaveTypeCode->OldValue != null ? $leave_taken_grid->LeaveTypeCode->OldValue : $leave_taken_grid->LeaveTypeCode->CurrentValue) ?>">
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_taken_grid->RowCount ?>_leave_taken_LeaveTypeCode">
<span<?php echo $leave_taken_grid->LeaveTypeCode->viewAttributes() ?>><?php echo $leave_taken_grid->LeaveTypeCode->getViewValue() ?></span>
</span>
<?php if (!$leave_taken->isConfirm()) { ?>
<input type="hidden" data-table="leave_taken" data-field="x_LeaveTypeCode" name="x<?php echo $leave_taken_grid->RowIndex ?>_LeaveTypeCode" id="x<?php echo $leave_taken_grid->RowIndex ?>_LeaveTypeCode" value="<?php echo HtmlEncode($leave_taken_grid->LeaveTypeCode->FormValue) ?>">
<input type="hidden" data-table="leave_taken" data-field="x_LeaveTypeCode" name="o<?php echo $leave_taken_grid->RowIndex ?>_LeaveTypeCode" id="o<?php echo $leave_taken_grid->RowIndex ?>_LeaveTypeCode" value="<?php echo HtmlEncode($leave_taken_grid->LeaveTypeCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="leave_taken" data-field="x_LeaveTypeCode" name="fleave_takengrid$x<?php echo $leave_taken_grid->RowIndex ?>_LeaveTypeCode" id="fleave_takengrid$x<?php echo $leave_taken_grid->RowIndex ?>_LeaveTypeCode" value="<?php echo HtmlEncode($leave_taken_grid->LeaveTypeCode->FormValue) ?>">
<input type="hidden" data-table="leave_taken" data-field="x_LeaveTypeCode" name="fleave_takengrid$o<?php echo $leave_taken_grid->RowIndex ?>_LeaveTypeCode" id="fleave_takengrid$o<?php echo $leave_taken_grid->RowIndex ?>_LeaveTypeCode" value="<?php echo HtmlEncode($leave_taken_grid->LeaveTypeCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_taken_grid->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $leave_taken_grid->StartDate->cellAttributes() ?>>
<?php if ($leave_taken->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_taken_grid->RowCount ?>_leave_taken_StartDate" class="form-group">
<input type="text" data-table="leave_taken" data-field="x_StartDate" name="x<?php echo $leave_taken_grid->RowIndex ?>_StartDate" id="x<?php echo $leave_taken_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($leave_taken_grid->StartDate->getPlaceHolder()) ?>" value="<?php echo $leave_taken_grid->StartDate->EditValue ?>"<?php echo $leave_taken_grid->StartDate->editAttributes() ?>>
<?php if (!$leave_taken_grid->StartDate->ReadOnly && !$leave_taken_grid->StartDate->Disabled && !isset($leave_taken_grid->StartDate->EditAttrs["readonly"]) && !isset($leave_taken_grid->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_takengrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_takengrid", "x<?php echo $leave_taken_grid->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_StartDate" name="o<?php echo $leave_taken_grid->RowIndex ?>_StartDate" id="o<?php echo $leave_taken_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($leave_taken_grid->StartDate->OldValue) ?>">
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="leave_taken" data-field="x_StartDate" name="x<?php echo $leave_taken_grid->RowIndex ?>_StartDate" id="x<?php echo $leave_taken_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($leave_taken_grid->StartDate->getPlaceHolder()) ?>" value="<?php echo $leave_taken_grid->StartDate->EditValue ?>"<?php echo $leave_taken_grid->StartDate->editAttributes() ?>>
<?php if (!$leave_taken_grid->StartDate->ReadOnly && !$leave_taken_grid->StartDate->Disabled && !isset($leave_taken_grid->StartDate->EditAttrs["readonly"]) && !isset($leave_taken_grid->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_takengrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_takengrid", "x<?php echo $leave_taken_grid->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
<input type="hidden" data-table="leave_taken" data-field="x_StartDate" name="o<?php echo $leave_taken_grid->RowIndex ?>_StartDate" id="o<?php echo $leave_taken_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($leave_taken_grid->StartDate->OldValue != null ? $leave_taken_grid->StartDate->OldValue : $leave_taken_grid->StartDate->CurrentValue) ?>">
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_taken_grid->RowCount ?>_leave_taken_StartDate">
<span<?php echo $leave_taken_grid->StartDate->viewAttributes() ?>><?php echo $leave_taken_grid->StartDate->getViewValue() ?></span>
</span>
<?php if (!$leave_taken->isConfirm()) { ?>
<input type="hidden" data-table="leave_taken" data-field="x_StartDate" name="x<?php echo $leave_taken_grid->RowIndex ?>_StartDate" id="x<?php echo $leave_taken_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($leave_taken_grid->StartDate->FormValue) ?>">
<input type="hidden" data-table="leave_taken" data-field="x_StartDate" name="o<?php echo $leave_taken_grid->RowIndex ?>_StartDate" id="o<?php echo $leave_taken_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($leave_taken_grid->StartDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="leave_taken" data-field="x_StartDate" name="fleave_takengrid$x<?php echo $leave_taken_grid->RowIndex ?>_StartDate" id="fleave_takengrid$x<?php echo $leave_taken_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($leave_taken_grid->StartDate->FormValue) ?>">
<input type="hidden" data-table="leave_taken" data-field="x_StartDate" name="fleave_takengrid$o<?php echo $leave_taken_grid->RowIndex ?>_StartDate" id="fleave_takengrid$o<?php echo $leave_taken_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($leave_taken_grid->StartDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_taken_grid->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate" <?php echo $leave_taken_grid->EndDate->cellAttributes() ?>>
<?php if ($leave_taken->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_taken_grid->RowCount ?>_leave_taken_EndDate" class="form-group">
<input type="text" data-table="leave_taken" data-field="x_EndDate" name="x<?php echo $leave_taken_grid->RowIndex ?>_EndDate" id="x<?php echo $leave_taken_grid->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($leave_taken_grid->EndDate->getPlaceHolder()) ?>" value="<?php echo $leave_taken_grid->EndDate->EditValue ?>"<?php echo $leave_taken_grid->EndDate->editAttributes() ?>>
<?php if (!$leave_taken_grid->EndDate->ReadOnly && !$leave_taken_grid->EndDate->Disabled && !isset($leave_taken_grid->EndDate->EditAttrs["readonly"]) && !isset($leave_taken_grid->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_takengrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_takengrid", "x<?php echo $leave_taken_grid->RowIndex ?>_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_EndDate" name="o<?php echo $leave_taken_grid->RowIndex ?>_EndDate" id="o<?php echo $leave_taken_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($leave_taken_grid->EndDate->OldValue) ?>">
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $leave_taken_grid->RowCount ?>_leave_taken_EndDate" class="form-group">
<input type="text" data-table="leave_taken" data-field="x_EndDate" name="x<?php echo $leave_taken_grid->RowIndex ?>_EndDate" id="x<?php echo $leave_taken_grid->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($leave_taken_grid->EndDate->getPlaceHolder()) ?>" value="<?php echo $leave_taken_grid->EndDate->EditValue ?>"<?php echo $leave_taken_grid->EndDate->editAttributes() ?>>
<?php if (!$leave_taken_grid->EndDate->ReadOnly && !$leave_taken_grid->EndDate->Disabled && !isset($leave_taken_grid->EndDate->EditAttrs["readonly"]) && !isset($leave_taken_grid->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_takengrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_takengrid", "x<?php echo $leave_taken_grid->RowIndex ?>_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_taken_grid->RowCount ?>_leave_taken_EndDate">
<span<?php echo $leave_taken_grid->EndDate->viewAttributes() ?>><?php echo $leave_taken_grid->EndDate->getViewValue() ?></span>
</span>
<?php if (!$leave_taken->isConfirm()) { ?>
<input type="hidden" data-table="leave_taken" data-field="x_EndDate" name="x<?php echo $leave_taken_grid->RowIndex ?>_EndDate" id="x<?php echo $leave_taken_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($leave_taken_grid->EndDate->FormValue) ?>">
<input type="hidden" data-table="leave_taken" data-field="x_EndDate" name="o<?php echo $leave_taken_grid->RowIndex ?>_EndDate" id="o<?php echo $leave_taken_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($leave_taken_grid->EndDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="leave_taken" data-field="x_EndDate" name="fleave_takengrid$x<?php echo $leave_taken_grid->RowIndex ?>_EndDate" id="fleave_takengrid$x<?php echo $leave_taken_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($leave_taken_grid->EndDate->FormValue) ?>">
<input type="hidden" data-table="leave_taken" data-field="x_EndDate" name="fleave_takengrid$o<?php echo $leave_taken_grid->RowIndex ?>_EndDate" id="fleave_takengrid$o<?php echo $leave_taken_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($leave_taken_grid->EndDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_taken_grid->Commuted->Visible) { // Commuted ?>
		<td data-name="Commuted" <?php echo $leave_taken_grid->Commuted->cellAttributes() ?>>
<?php if ($leave_taken->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_taken_grid->RowCount ?>_leave_taken_Commuted" class="form-group">
<input type="text" data-table="leave_taken" data-field="x_Commuted" name="x<?php echo $leave_taken_grid->RowIndex ?>_Commuted" id="x<?php echo $leave_taken_grid->RowIndex ?>_Commuted" size="30" placeholder="<?php echo HtmlEncode($leave_taken_grid->Commuted->getPlaceHolder()) ?>" value="<?php echo $leave_taken_grid->Commuted->EditValue ?>"<?php echo $leave_taken_grid->Commuted->editAttributes() ?>>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_Commuted" name="o<?php echo $leave_taken_grid->RowIndex ?>_Commuted" id="o<?php echo $leave_taken_grid->RowIndex ?>_Commuted" value="<?php echo HtmlEncode($leave_taken_grid->Commuted->OldValue) ?>">
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $leave_taken_grid->RowCount ?>_leave_taken_Commuted" class="form-group">
<input type="text" data-table="leave_taken" data-field="x_Commuted" name="x<?php echo $leave_taken_grid->RowIndex ?>_Commuted" id="x<?php echo $leave_taken_grid->RowIndex ?>_Commuted" size="30" placeholder="<?php echo HtmlEncode($leave_taken_grid->Commuted->getPlaceHolder()) ?>" value="<?php echo $leave_taken_grid->Commuted->EditValue ?>"<?php echo $leave_taken_grid->Commuted->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_taken_grid->RowCount ?>_leave_taken_Commuted">
<span<?php echo $leave_taken_grid->Commuted->viewAttributes() ?>><?php echo $leave_taken_grid->Commuted->getViewValue() ?></span>
</span>
<?php if (!$leave_taken->isConfirm()) { ?>
<input type="hidden" data-table="leave_taken" data-field="x_Commuted" name="x<?php echo $leave_taken_grid->RowIndex ?>_Commuted" id="x<?php echo $leave_taken_grid->RowIndex ?>_Commuted" value="<?php echo HtmlEncode($leave_taken_grid->Commuted->FormValue) ?>">
<input type="hidden" data-table="leave_taken" data-field="x_Commuted" name="o<?php echo $leave_taken_grid->RowIndex ?>_Commuted" id="o<?php echo $leave_taken_grid->RowIndex ?>_Commuted" value="<?php echo HtmlEncode($leave_taken_grid->Commuted->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="leave_taken" data-field="x_Commuted" name="fleave_takengrid$x<?php echo $leave_taken_grid->RowIndex ?>_Commuted" id="fleave_takengrid$x<?php echo $leave_taken_grid->RowIndex ?>_Commuted" value="<?php echo HtmlEncode($leave_taken_grid->Commuted->FormValue) ?>">
<input type="hidden" data-table="leave_taken" data-field="x_Commuted" name="fleave_takengrid$o<?php echo $leave_taken_grid->RowIndex ?>_Commuted" id="fleave_takengrid$o<?php echo $leave_taken_grid->RowIndex ?>_Commuted" value="<?php echo HtmlEncode($leave_taken_grid->Commuted->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_taken_grid->LeaveDays->Visible) { // LeaveDays ?>
		<td data-name="LeaveDays" <?php echo $leave_taken_grid->LeaveDays->cellAttributes() ?>>
<?php if ($leave_taken->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_taken_grid->RowCount ?>_leave_taken_LeaveDays" class="form-group">
<input type="text" data-table="leave_taken" data-field="x_LeaveDays" name="x<?php echo $leave_taken_grid->RowIndex ?>_LeaveDays" id="x<?php echo $leave_taken_grid->RowIndex ?>_LeaveDays" size="30" placeholder="<?php echo HtmlEncode($leave_taken_grid->LeaveDays->getPlaceHolder()) ?>" value="<?php echo $leave_taken_grid->LeaveDays->EditValue ?>"<?php echo $leave_taken_grid->LeaveDays->editAttributes() ?>>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_LeaveDays" name="o<?php echo $leave_taken_grid->RowIndex ?>_LeaveDays" id="o<?php echo $leave_taken_grid->RowIndex ?>_LeaveDays" value="<?php echo HtmlEncode($leave_taken_grid->LeaveDays->OldValue) ?>">
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $leave_taken_grid->RowCount ?>_leave_taken_LeaveDays" class="form-group">
<input type="text" data-table="leave_taken" data-field="x_LeaveDays" name="x<?php echo $leave_taken_grid->RowIndex ?>_LeaveDays" id="x<?php echo $leave_taken_grid->RowIndex ?>_LeaveDays" size="30" placeholder="<?php echo HtmlEncode($leave_taken_grid->LeaveDays->getPlaceHolder()) ?>" value="<?php echo $leave_taken_grid->LeaveDays->EditValue ?>"<?php echo $leave_taken_grid->LeaveDays->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_taken_grid->RowCount ?>_leave_taken_LeaveDays">
<span<?php echo $leave_taken_grid->LeaveDays->viewAttributes() ?>><?php echo $leave_taken_grid->LeaveDays->getViewValue() ?></span>
</span>
<?php if (!$leave_taken->isConfirm()) { ?>
<input type="hidden" data-table="leave_taken" data-field="x_LeaveDays" name="x<?php echo $leave_taken_grid->RowIndex ?>_LeaveDays" id="x<?php echo $leave_taken_grid->RowIndex ?>_LeaveDays" value="<?php echo HtmlEncode($leave_taken_grid->LeaveDays->FormValue) ?>">
<input type="hidden" data-table="leave_taken" data-field="x_LeaveDays" name="o<?php echo $leave_taken_grid->RowIndex ?>_LeaveDays" id="o<?php echo $leave_taken_grid->RowIndex ?>_LeaveDays" value="<?php echo HtmlEncode($leave_taken_grid->LeaveDays->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="leave_taken" data-field="x_LeaveDays" name="fleave_takengrid$x<?php echo $leave_taken_grid->RowIndex ?>_LeaveDays" id="fleave_takengrid$x<?php echo $leave_taken_grid->RowIndex ?>_LeaveDays" value="<?php echo HtmlEncode($leave_taken_grid->LeaveDays->FormValue) ?>">
<input type="hidden" data-table="leave_taken" data-field="x_LeaveDays" name="fleave_takengrid$o<?php echo $leave_taken_grid->RowIndex ?>_LeaveDays" id="fleave_takengrid$o<?php echo $leave_taken_grid->RowIndex ?>_LeaveDays" value="<?php echo HtmlEncode($leave_taken_grid->LeaveDays->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_taken_grid->Location->Visible) { // Location ?>
		<td data-name="Location" <?php echo $leave_taken_grid->Location->cellAttributes() ?>>
<?php if ($leave_taken->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_taken_grid->RowCount ?>_leave_taken_Location" class="form-group">
<input type="text" data-table="leave_taken" data-field="x_Location" name="x<?php echo $leave_taken_grid->RowIndex ?>_Location" id="x<?php echo $leave_taken_grid->RowIndex ?>_Location" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($leave_taken_grid->Location->getPlaceHolder()) ?>" value="<?php echo $leave_taken_grid->Location->EditValue ?>"<?php echo $leave_taken_grid->Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_Location" name="o<?php echo $leave_taken_grid->RowIndex ?>_Location" id="o<?php echo $leave_taken_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($leave_taken_grid->Location->OldValue) ?>">
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $leave_taken_grid->RowCount ?>_leave_taken_Location" class="form-group">
<input type="text" data-table="leave_taken" data-field="x_Location" name="x<?php echo $leave_taken_grid->RowIndex ?>_Location" id="x<?php echo $leave_taken_grid->RowIndex ?>_Location" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($leave_taken_grid->Location->getPlaceHolder()) ?>" value="<?php echo $leave_taken_grid->Location->EditValue ?>"<?php echo $leave_taken_grid->Location->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_taken_grid->RowCount ?>_leave_taken_Location">
<span<?php echo $leave_taken_grid->Location->viewAttributes() ?>><?php echo $leave_taken_grid->Location->getViewValue() ?></span>
</span>
<?php if (!$leave_taken->isConfirm()) { ?>
<input type="hidden" data-table="leave_taken" data-field="x_Location" name="x<?php echo $leave_taken_grid->RowIndex ?>_Location" id="x<?php echo $leave_taken_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($leave_taken_grid->Location->FormValue) ?>">
<input type="hidden" data-table="leave_taken" data-field="x_Location" name="o<?php echo $leave_taken_grid->RowIndex ?>_Location" id="o<?php echo $leave_taken_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($leave_taken_grid->Location->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="leave_taken" data-field="x_Location" name="fleave_takengrid$x<?php echo $leave_taken_grid->RowIndex ?>_Location" id="fleave_takengrid$x<?php echo $leave_taken_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($leave_taken_grid->Location->FormValue) ?>">
<input type="hidden" data-table="leave_taken" data-field="x_Location" name="fleave_takengrid$o<?php echo $leave_taken_grid->RowIndex ?>_Location" id="fleave_takengrid$o<?php echo $leave_taken_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($leave_taken_grid->Location->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_taken_grid->Remarks->Visible) { // Remarks ?>
		<td data-name="Remarks" <?php echo $leave_taken_grid->Remarks->cellAttributes() ?>>
<?php if ($leave_taken->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_taken_grid->RowCount ?>_leave_taken_Remarks" class="form-group">
<input type="text" data-table="leave_taken" data-field="x_Remarks" name="x<?php echo $leave_taken_grid->RowIndex ?>_Remarks" id="x<?php echo $leave_taken_grid->RowIndex ?>_Remarks" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($leave_taken_grid->Remarks->getPlaceHolder()) ?>" value="<?php echo $leave_taken_grid->Remarks->EditValue ?>"<?php echo $leave_taken_grid->Remarks->editAttributes() ?>>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_Remarks" name="o<?php echo $leave_taken_grid->RowIndex ?>_Remarks" id="o<?php echo $leave_taken_grid->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($leave_taken_grid->Remarks->OldValue) ?>">
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $leave_taken_grid->RowCount ?>_leave_taken_Remarks" class="form-group">
<input type="text" data-table="leave_taken" data-field="x_Remarks" name="x<?php echo $leave_taken_grid->RowIndex ?>_Remarks" id="x<?php echo $leave_taken_grid->RowIndex ?>_Remarks" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($leave_taken_grid->Remarks->getPlaceHolder()) ?>" value="<?php echo $leave_taken_grid->Remarks->EditValue ?>"<?php echo $leave_taken_grid->Remarks->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_taken_grid->RowCount ?>_leave_taken_Remarks">
<span<?php echo $leave_taken_grid->Remarks->viewAttributes() ?>><?php echo $leave_taken_grid->Remarks->getViewValue() ?></span>
</span>
<?php if (!$leave_taken->isConfirm()) { ?>
<input type="hidden" data-table="leave_taken" data-field="x_Remarks" name="x<?php echo $leave_taken_grid->RowIndex ?>_Remarks" id="x<?php echo $leave_taken_grid->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($leave_taken_grid->Remarks->FormValue) ?>">
<input type="hidden" data-table="leave_taken" data-field="x_Remarks" name="o<?php echo $leave_taken_grid->RowIndex ?>_Remarks" id="o<?php echo $leave_taken_grid->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($leave_taken_grid->Remarks->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="leave_taken" data-field="x_Remarks" name="fleave_takengrid$x<?php echo $leave_taken_grid->RowIndex ?>_Remarks" id="fleave_takengrid$x<?php echo $leave_taken_grid->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($leave_taken_grid->Remarks->FormValue) ?>">
<input type="hidden" data-table="leave_taken" data-field="x_Remarks" name="fleave_takengrid$o<?php echo $leave_taken_grid->RowIndex ?>_Remarks" id="fleave_takengrid$o<?php echo $leave_taken_grid->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($leave_taken_grid->Remarks->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$leave_taken_grid->ListOptions->render("body", "right", $leave_taken_grid->RowCount);
?>
	</tr>
<?php if ($leave_taken->RowType == ROWTYPE_ADD || $leave_taken->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fleave_takengrid", "load"], function() {
	fleave_takengrid.updateLists(<?php echo $leave_taken_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$leave_taken_grid->isGridAdd() || $leave_taken->CurrentMode == "copy")
		if (!$leave_taken_grid->Recordset->EOF)
			$leave_taken_grid->Recordset->moveNext();
}
?>
<?php
	if ($leave_taken->CurrentMode == "add" || $leave_taken->CurrentMode == "copy" || $leave_taken->CurrentMode == "edit") {
		$leave_taken_grid->RowIndex = '$rowindex$';
		$leave_taken_grid->loadRowValues();

		// Set row properties
		$leave_taken->resetAttributes();
		$leave_taken->RowAttrs->merge(["data-rowindex" => $leave_taken_grid->RowIndex, "id" => "r0_leave_taken", "data-rowtype" => ROWTYPE_ADD]);
		$leave_taken->RowAttrs->appendClass("ew-template");
		$leave_taken->RowType = ROWTYPE_ADD;

		// Render row
		$leave_taken_grid->renderRow();

		// Render list options
		$leave_taken_grid->renderListOptions();
		$leave_taken_grid->StartRowCount = 0;
?>
	<tr <?php echo $leave_taken->rowAttributes() ?>>
<?php

// Render list options (body, left)
$leave_taken_grid->ListOptions->render("body", "left", $leave_taken_grid->RowIndex);
?>
	<?php if ($leave_taken_grid->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID">
<?php if (!$leave_taken->isConfirm()) { ?>
<?php if ($leave_taken_grid->EmployeeID->getSessionValue() != "") { ?>
<span id="el$rowindex$_leave_taken_EmployeeID" class="form-group leave_taken_EmployeeID">
<span<?php echo $leave_taken_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_taken_grid->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" name="x<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_taken_grid->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_leave_taken_EmployeeID" class="form-group leave_taken_EmployeeID">
<input type="text" data-table="leave_taken" data-field="x_EmployeeID" name="x<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" id="x<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($leave_taken_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $leave_taken_grid->EmployeeID->EditValue ?>"<?php echo $leave_taken_grid->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_leave_taken_EmployeeID" class="form-group leave_taken_EmployeeID">
<span<?php echo $leave_taken_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_taken_grid->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_EmployeeID" name="x<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" id="x<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_taken_grid->EmployeeID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="leave_taken" data-field="x_EmployeeID" name="o<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" id="o<?php echo $leave_taken_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_taken_grid->EmployeeID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_taken_grid->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<td data-name="LeaveTypeCode">
<?php if (!$leave_taken->isConfirm()) { ?>
<span id="el$rowindex$_leave_taken_LeaveTypeCode" class="form-group leave_taken_LeaveTypeCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="leave_taken" data-field="x_LeaveTypeCode" data-value-separator="<?php echo $leave_taken_grid->LeaveTypeCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $leave_taken_grid->RowIndex ?>_LeaveTypeCode" name="x<?php echo $leave_taken_grid->RowIndex ?>_LeaveTypeCode"<?php echo $leave_taken_grid->LeaveTypeCode->editAttributes() ?>>
			<?php echo $leave_taken_grid->LeaveTypeCode->selectOptionListHtml("x{$leave_taken_grid->RowIndex}_LeaveTypeCode") ?>
		</select>
</div>
<?php echo $leave_taken_grid->LeaveTypeCode->Lookup->getParamTag($leave_taken_grid, "p_x" . $leave_taken_grid->RowIndex . "_LeaveTypeCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_leave_taken_LeaveTypeCode" class="form-group leave_taken_LeaveTypeCode">
<span<?php echo $leave_taken_grid->LeaveTypeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_taken_grid->LeaveTypeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_LeaveTypeCode" name="x<?php echo $leave_taken_grid->RowIndex ?>_LeaveTypeCode" id="x<?php echo $leave_taken_grid->RowIndex ?>_LeaveTypeCode" value="<?php echo HtmlEncode($leave_taken_grid->LeaveTypeCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="leave_taken" data-field="x_LeaveTypeCode" name="o<?php echo $leave_taken_grid->RowIndex ?>_LeaveTypeCode" id="o<?php echo $leave_taken_grid->RowIndex ?>_LeaveTypeCode" value="<?php echo HtmlEncode($leave_taken_grid->LeaveTypeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_taken_grid->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate">
<?php if (!$leave_taken->isConfirm()) { ?>
<span id="el$rowindex$_leave_taken_StartDate" class="form-group leave_taken_StartDate">
<input type="text" data-table="leave_taken" data-field="x_StartDate" name="x<?php echo $leave_taken_grid->RowIndex ?>_StartDate" id="x<?php echo $leave_taken_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($leave_taken_grid->StartDate->getPlaceHolder()) ?>" value="<?php echo $leave_taken_grid->StartDate->EditValue ?>"<?php echo $leave_taken_grid->StartDate->editAttributes() ?>>
<?php if (!$leave_taken_grid->StartDate->ReadOnly && !$leave_taken_grid->StartDate->Disabled && !isset($leave_taken_grid->StartDate->EditAttrs["readonly"]) && !isset($leave_taken_grid->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_takengrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_takengrid", "x<?php echo $leave_taken_grid->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_leave_taken_StartDate" class="form-group leave_taken_StartDate">
<span<?php echo $leave_taken_grid->StartDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_taken_grid->StartDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_StartDate" name="x<?php echo $leave_taken_grid->RowIndex ?>_StartDate" id="x<?php echo $leave_taken_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($leave_taken_grid->StartDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="leave_taken" data-field="x_StartDate" name="o<?php echo $leave_taken_grid->RowIndex ?>_StartDate" id="o<?php echo $leave_taken_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($leave_taken_grid->StartDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_taken_grid->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate">
<?php if (!$leave_taken->isConfirm()) { ?>
<span id="el$rowindex$_leave_taken_EndDate" class="form-group leave_taken_EndDate">
<input type="text" data-table="leave_taken" data-field="x_EndDate" name="x<?php echo $leave_taken_grid->RowIndex ?>_EndDate" id="x<?php echo $leave_taken_grid->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($leave_taken_grid->EndDate->getPlaceHolder()) ?>" value="<?php echo $leave_taken_grid->EndDate->EditValue ?>"<?php echo $leave_taken_grid->EndDate->editAttributes() ?>>
<?php if (!$leave_taken_grid->EndDate->ReadOnly && !$leave_taken_grid->EndDate->Disabled && !isset($leave_taken_grid->EndDate->EditAttrs["readonly"]) && !isset($leave_taken_grid->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_takengrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_takengrid", "x<?php echo $leave_taken_grid->RowIndex ?>_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_leave_taken_EndDate" class="form-group leave_taken_EndDate">
<span<?php echo $leave_taken_grid->EndDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_taken_grid->EndDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_EndDate" name="x<?php echo $leave_taken_grid->RowIndex ?>_EndDate" id="x<?php echo $leave_taken_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($leave_taken_grid->EndDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="leave_taken" data-field="x_EndDate" name="o<?php echo $leave_taken_grid->RowIndex ?>_EndDate" id="o<?php echo $leave_taken_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($leave_taken_grid->EndDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_taken_grid->Commuted->Visible) { // Commuted ?>
		<td data-name="Commuted">
<?php if (!$leave_taken->isConfirm()) { ?>
<span id="el$rowindex$_leave_taken_Commuted" class="form-group leave_taken_Commuted">
<input type="text" data-table="leave_taken" data-field="x_Commuted" name="x<?php echo $leave_taken_grid->RowIndex ?>_Commuted" id="x<?php echo $leave_taken_grid->RowIndex ?>_Commuted" size="30" placeholder="<?php echo HtmlEncode($leave_taken_grid->Commuted->getPlaceHolder()) ?>" value="<?php echo $leave_taken_grid->Commuted->EditValue ?>"<?php echo $leave_taken_grid->Commuted->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_leave_taken_Commuted" class="form-group leave_taken_Commuted">
<span<?php echo $leave_taken_grid->Commuted->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_taken_grid->Commuted->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_Commuted" name="x<?php echo $leave_taken_grid->RowIndex ?>_Commuted" id="x<?php echo $leave_taken_grid->RowIndex ?>_Commuted" value="<?php echo HtmlEncode($leave_taken_grid->Commuted->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="leave_taken" data-field="x_Commuted" name="o<?php echo $leave_taken_grid->RowIndex ?>_Commuted" id="o<?php echo $leave_taken_grid->RowIndex ?>_Commuted" value="<?php echo HtmlEncode($leave_taken_grid->Commuted->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_taken_grid->LeaveDays->Visible) { // LeaveDays ?>
		<td data-name="LeaveDays">
<?php if (!$leave_taken->isConfirm()) { ?>
<span id="el$rowindex$_leave_taken_LeaveDays" class="form-group leave_taken_LeaveDays">
<input type="text" data-table="leave_taken" data-field="x_LeaveDays" name="x<?php echo $leave_taken_grid->RowIndex ?>_LeaveDays" id="x<?php echo $leave_taken_grid->RowIndex ?>_LeaveDays" size="30" placeholder="<?php echo HtmlEncode($leave_taken_grid->LeaveDays->getPlaceHolder()) ?>" value="<?php echo $leave_taken_grid->LeaveDays->EditValue ?>"<?php echo $leave_taken_grid->LeaveDays->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_leave_taken_LeaveDays" class="form-group leave_taken_LeaveDays">
<span<?php echo $leave_taken_grid->LeaveDays->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_taken_grid->LeaveDays->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_LeaveDays" name="x<?php echo $leave_taken_grid->RowIndex ?>_LeaveDays" id="x<?php echo $leave_taken_grid->RowIndex ?>_LeaveDays" value="<?php echo HtmlEncode($leave_taken_grid->LeaveDays->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="leave_taken" data-field="x_LeaveDays" name="o<?php echo $leave_taken_grid->RowIndex ?>_LeaveDays" id="o<?php echo $leave_taken_grid->RowIndex ?>_LeaveDays" value="<?php echo HtmlEncode($leave_taken_grid->LeaveDays->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_taken_grid->Location->Visible) { // Location ?>
		<td data-name="Location">
<?php if (!$leave_taken->isConfirm()) { ?>
<span id="el$rowindex$_leave_taken_Location" class="form-group leave_taken_Location">
<input type="text" data-table="leave_taken" data-field="x_Location" name="x<?php echo $leave_taken_grid->RowIndex ?>_Location" id="x<?php echo $leave_taken_grid->RowIndex ?>_Location" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($leave_taken_grid->Location->getPlaceHolder()) ?>" value="<?php echo $leave_taken_grid->Location->EditValue ?>"<?php echo $leave_taken_grid->Location->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_leave_taken_Location" class="form-group leave_taken_Location">
<span<?php echo $leave_taken_grid->Location->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_taken_grid->Location->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_Location" name="x<?php echo $leave_taken_grid->RowIndex ?>_Location" id="x<?php echo $leave_taken_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($leave_taken_grid->Location->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="leave_taken" data-field="x_Location" name="o<?php echo $leave_taken_grid->RowIndex ?>_Location" id="o<?php echo $leave_taken_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($leave_taken_grid->Location->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_taken_grid->Remarks->Visible) { // Remarks ?>
		<td data-name="Remarks">
<?php if (!$leave_taken->isConfirm()) { ?>
<span id="el$rowindex$_leave_taken_Remarks" class="form-group leave_taken_Remarks">
<input type="text" data-table="leave_taken" data-field="x_Remarks" name="x<?php echo $leave_taken_grid->RowIndex ?>_Remarks" id="x<?php echo $leave_taken_grid->RowIndex ?>_Remarks" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($leave_taken_grid->Remarks->getPlaceHolder()) ?>" value="<?php echo $leave_taken_grid->Remarks->EditValue ?>"<?php echo $leave_taken_grid->Remarks->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_leave_taken_Remarks" class="form-group leave_taken_Remarks">
<span<?php echo $leave_taken_grid->Remarks->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_taken_grid->Remarks->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_Remarks" name="x<?php echo $leave_taken_grid->RowIndex ?>_Remarks" id="x<?php echo $leave_taken_grid->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($leave_taken_grid->Remarks->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="leave_taken" data-field="x_Remarks" name="o<?php echo $leave_taken_grid->RowIndex ?>_Remarks" id="o<?php echo $leave_taken_grid->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($leave_taken_grid->Remarks->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$leave_taken_grid->ListOptions->render("body", "right", $leave_taken_grid->RowIndex);
?>
<script>
loadjs.ready(["fleave_takengrid", "load"], function() {
	fleave_takengrid.updateLists(<?php echo $leave_taken_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($leave_taken->CurrentMode == "add" || $leave_taken->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $leave_taken_grid->FormKeyCountName ?>" id="<?php echo $leave_taken_grid->FormKeyCountName ?>" value="<?php echo $leave_taken_grid->KeyCount ?>">
<?php echo $leave_taken_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($leave_taken->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $leave_taken_grid->FormKeyCountName ?>" id="<?php echo $leave_taken_grid->FormKeyCountName ?>" value="<?php echo $leave_taken_grid->KeyCount ?>">
<?php echo $leave_taken_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($leave_taken->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fleave_takengrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($leave_taken_grid->Recordset)
	$leave_taken_grid->Recordset->Close();
?>
<?php if ($leave_taken_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $leave_taken_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($leave_taken_grid->TotalRecords == 0 && !$leave_taken->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $leave_taken_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$leave_taken_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$leave_taken_grid->terminate();
?>