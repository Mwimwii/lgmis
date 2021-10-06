<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($leave_record_grid))
	$leave_record_grid = new leave_record_grid();

// Run the page
$leave_record_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_record_grid->Page_Render();
?>
<?php if (!$leave_record_grid->isExport()) { ?>
<script>
var fleave_recordgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fleave_recordgrid = new ew.Form("fleave_recordgrid", "grid");
	fleave_recordgrid.formKeyCountName = '<?php echo $leave_record_grid->FormKeyCountName ?>';

	// Validate form
	fleave_recordgrid.validate = function() {
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
			<?php if ($leave_record_grid->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_grid->EmployeeID->caption(), $leave_record_grid->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_record_grid->EmployeeID->errorMessage()) ?>");
			<?php if ($leave_record_grid->LeaveTypeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveTypeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_grid->LeaveTypeCode->caption(), $leave_record_grid->LeaveTypeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_record_grid->EffectiveDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EffectiveDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_grid->EffectiveDate->caption(), $leave_record_grid->EffectiveDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EffectiveDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_record_grid->EffectiveDate->errorMessage()) ?>");
			<?php if ($leave_record_grid->OpeningBalance->Required) { ?>
				elm = this.getElements("x" + infix + "_OpeningBalance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_grid->OpeningBalance->caption(), $leave_record_grid->OpeningBalance->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OpeningBalance");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_record_grid->OpeningBalance->errorMessage()) ?>");
			<?php if ($leave_record_grid->LeaveAccrued->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveAccrued");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_grid->LeaveAccrued->caption(), $leave_record_grid->LeaveAccrued->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LeaveAccrued");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_record_grid->LeaveAccrued->errorMessage()) ?>");
			<?php if ($leave_record_grid->LastAccrualDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastAccrualDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_grid->LastAccrualDate->caption(), $leave_record_grid->LastAccrualDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastAccrualDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_record_grid->LastAccrualDate->errorMessage()) ?>");
			<?php if ($leave_record_grid->LeaveTaken->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveTaken");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_grid->LeaveTaken->caption(), $leave_record_grid->LeaveTaken->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LeaveTaken");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_record_grid->LeaveTaken->errorMessage()) ?>");
			<?php if ($leave_record_grid->LeaveCommuted->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveCommuted");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_grid->LeaveCommuted->caption(), $leave_record_grid->LeaveCommuted->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LeaveCommuted");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_record_grid->LeaveCommuted->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fleave_recordgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "EmployeeID", false)) return false;
		if (ew.valueChanged(fobj, infix, "LeaveTypeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "EffectiveDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "OpeningBalance", false)) return false;
		if (ew.valueChanged(fobj, infix, "LeaveAccrued", false)) return false;
		if (ew.valueChanged(fobj, infix, "LastAccrualDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "LeaveTaken", false)) return false;
		if (ew.valueChanged(fobj, infix, "LeaveCommuted", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fleave_recordgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fleave_recordgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fleave_recordgrid.lists["x_LeaveTypeCode"] = <?php echo $leave_record_grid->LeaveTypeCode->Lookup->toClientList($leave_record_grid) ?>;
	fleave_recordgrid.lists["x_LeaveTypeCode"].options = <?php echo JsonEncode($leave_record_grid->LeaveTypeCode->lookupOptions()) ?>;
	loadjs.done("fleave_recordgrid");
});
</script>
<?php } ?>
<?php
$leave_record_grid->renderOtherOptions();
?>
<?php if ($leave_record_grid->TotalRecords > 0 || $leave_record->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($leave_record_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> leave_record">
<?php if ($leave_record_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $leave_record_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fleave_recordgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_leave_record" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_leave_recordgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$leave_record->RowType = ROWTYPE_HEADER;

// Render list options
$leave_record_grid->renderListOptions();

// Render list options (header, left)
$leave_record_grid->ListOptions->render("header", "left");
?>
<?php if ($leave_record_grid->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($leave_record_grid->SortUrl($leave_record_grid->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $leave_record_grid->EmployeeID->headerCellClass() ?>"><div id="elh_leave_record_EmployeeID" class="leave_record_EmployeeID"><div class="ew-table-header-caption"><?php echo $leave_record_grid->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $leave_record_grid->EmployeeID->headerCellClass() ?>"><div><div id="elh_leave_record_EmployeeID" class="leave_record_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_record_grid->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_record_grid->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_record_grid->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_record_grid->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<?php if ($leave_record_grid->SortUrl($leave_record_grid->LeaveTypeCode) == "") { ?>
		<th data-name="LeaveTypeCode" class="<?php echo $leave_record_grid->LeaveTypeCode->headerCellClass() ?>"><div id="elh_leave_record_LeaveTypeCode" class="leave_record_LeaveTypeCode"><div class="ew-table-header-caption"><?php echo $leave_record_grid->LeaveTypeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeaveTypeCode" class="<?php echo $leave_record_grid->LeaveTypeCode->headerCellClass() ?>"><div><div id="elh_leave_record_LeaveTypeCode" class="leave_record_LeaveTypeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_record_grid->LeaveTypeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_record_grid->LeaveTypeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_record_grid->LeaveTypeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_record_grid->EffectiveDate->Visible) { // EffectiveDate ?>
	<?php if ($leave_record_grid->SortUrl($leave_record_grid->EffectiveDate) == "") { ?>
		<th data-name="EffectiveDate" class="<?php echo $leave_record_grid->EffectiveDate->headerCellClass() ?>"><div id="elh_leave_record_EffectiveDate" class="leave_record_EffectiveDate"><div class="ew-table-header-caption"><?php echo $leave_record_grid->EffectiveDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EffectiveDate" class="<?php echo $leave_record_grid->EffectiveDate->headerCellClass() ?>"><div><div id="elh_leave_record_EffectiveDate" class="leave_record_EffectiveDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_record_grid->EffectiveDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_record_grid->EffectiveDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_record_grid->EffectiveDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_record_grid->OpeningBalance->Visible) { // OpeningBalance ?>
	<?php if ($leave_record_grid->SortUrl($leave_record_grid->OpeningBalance) == "") { ?>
		<th data-name="OpeningBalance" class="<?php echo $leave_record_grid->OpeningBalance->headerCellClass() ?>"><div id="elh_leave_record_OpeningBalance" class="leave_record_OpeningBalance"><div class="ew-table-header-caption"><?php echo $leave_record_grid->OpeningBalance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OpeningBalance" class="<?php echo $leave_record_grid->OpeningBalance->headerCellClass() ?>"><div><div id="elh_leave_record_OpeningBalance" class="leave_record_OpeningBalance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_record_grid->OpeningBalance->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_record_grid->OpeningBalance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_record_grid->OpeningBalance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_record_grid->LeaveAccrued->Visible) { // LeaveAccrued ?>
	<?php if ($leave_record_grid->SortUrl($leave_record_grid->LeaveAccrued) == "") { ?>
		<th data-name="LeaveAccrued" class="<?php echo $leave_record_grid->LeaveAccrued->headerCellClass() ?>"><div id="elh_leave_record_LeaveAccrued" class="leave_record_LeaveAccrued"><div class="ew-table-header-caption"><?php echo $leave_record_grid->LeaveAccrued->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeaveAccrued" class="<?php echo $leave_record_grid->LeaveAccrued->headerCellClass() ?>"><div><div id="elh_leave_record_LeaveAccrued" class="leave_record_LeaveAccrued">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_record_grid->LeaveAccrued->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_record_grid->LeaveAccrued->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_record_grid->LeaveAccrued->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_record_grid->LastAccrualDate->Visible) { // LastAccrualDate ?>
	<?php if ($leave_record_grid->SortUrl($leave_record_grid->LastAccrualDate) == "") { ?>
		<th data-name="LastAccrualDate" class="<?php echo $leave_record_grid->LastAccrualDate->headerCellClass() ?>"><div id="elh_leave_record_LastAccrualDate" class="leave_record_LastAccrualDate"><div class="ew-table-header-caption"><?php echo $leave_record_grid->LastAccrualDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastAccrualDate" class="<?php echo $leave_record_grid->LastAccrualDate->headerCellClass() ?>"><div><div id="elh_leave_record_LastAccrualDate" class="leave_record_LastAccrualDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_record_grid->LastAccrualDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_record_grid->LastAccrualDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_record_grid->LastAccrualDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_record_grid->LeaveTaken->Visible) { // LeaveTaken ?>
	<?php if ($leave_record_grid->SortUrl($leave_record_grid->LeaveTaken) == "") { ?>
		<th data-name="LeaveTaken" class="<?php echo $leave_record_grid->LeaveTaken->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_leave_record_LeaveTaken" class="leave_record_LeaveTaken"><div class="ew-table-header-caption"><?php echo $leave_record_grid->LeaveTaken->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeaveTaken" class="<?php echo $leave_record_grid->LeaveTaken->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_leave_record_LeaveTaken" class="leave_record_LeaveTaken">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_record_grid->LeaveTaken->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_record_grid->LeaveTaken->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_record_grid->LeaveTaken->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_record_grid->LeaveCommuted->Visible) { // LeaveCommuted ?>
	<?php if ($leave_record_grid->SortUrl($leave_record_grid->LeaveCommuted) == "") { ?>
		<th data-name="LeaveCommuted" class="<?php echo $leave_record_grid->LeaveCommuted->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_leave_record_LeaveCommuted" class="leave_record_LeaveCommuted"><div class="ew-table-header-caption"><?php echo $leave_record_grid->LeaveCommuted->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeaveCommuted" class="<?php echo $leave_record_grid->LeaveCommuted->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_leave_record_LeaveCommuted" class="leave_record_LeaveCommuted">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_record_grid->LeaveCommuted->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_record_grid->LeaveCommuted->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_record_grid->LeaveCommuted->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$leave_record_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$leave_record_grid->StartRecord = 1;
$leave_record_grid->StopRecord = $leave_record_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($leave_record->isConfirm() || $leave_record_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($leave_record_grid->FormKeyCountName) && ($leave_record_grid->isGridAdd() || $leave_record_grid->isGridEdit() || $leave_record->isConfirm())) {
		$leave_record_grid->KeyCount = $CurrentForm->getValue($leave_record_grid->FormKeyCountName);
		$leave_record_grid->StopRecord = $leave_record_grid->StartRecord + $leave_record_grid->KeyCount - 1;
	}
}
$leave_record_grid->RecordCount = $leave_record_grid->StartRecord - 1;
if ($leave_record_grid->Recordset && !$leave_record_grid->Recordset->EOF) {
	$leave_record_grid->Recordset->moveFirst();
	$selectLimit = $leave_record_grid->UseSelectLimit;
	if (!$selectLimit && $leave_record_grid->StartRecord > 1)
		$leave_record_grid->Recordset->move($leave_record_grid->StartRecord - 1);
} elseif (!$leave_record->AllowAddDeleteRow && $leave_record_grid->StopRecord == 0) {
	$leave_record_grid->StopRecord = $leave_record->GridAddRowCount;
}

// Initialize aggregate
$leave_record->RowType = ROWTYPE_AGGREGATEINIT;
$leave_record->resetAttributes();
$leave_record_grid->renderRow();
if ($leave_record_grid->isGridAdd())
	$leave_record_grid->RowIndex = 0;
if ($leave_record_grid->isGridEdit())
	$leave_record_grid->RowIndex = 0;
while ($leave_record_grid->RecordCount < $leave_record_grid->StopRecord) {
	$leave_record_grid->RecordCount++;
	if ($leave_record_grid->RecordCount >= $leave_record_grid->StartRecord) {
		$leave_record_grid->RowCount++;
		if ($leave_record_grid->isGridAdd() || $leave_record_grid->isGridEdit() || $leave_record->isConfirm()) {
			$leave_record_grid->RowIndex++;
			$CurrentForm->Index = $leave_record_grid->RowIndex;
			if ($CurrentForm->hasValue($leave_record_grid->FormActionName) && ($leave_record->isConfirm() || $leave_record_grid->EventCancelled))
				$leave_record_grid->RowAction = strval($CurrentForm->getValue($leave_record_grid->FormActionName));
			elseif ($leave_record_grid->isGridAdd())
				$leave_record_grid->RowAction = "insert";
			else
				$leave_record_grid->RowAction = "";
		}

		// Set up key count
		$leave_record_grid->KeyCount = $leave_record_grid->RowIndex;

		// Init row class and style
		$leave_record->resetAttributes();
		$leave_record->CssClass = "";
		if ($leave_record_grid->isGridAdd()) {
			if ($leave_record->CurrentMode == "copy") {
				$leave_record_grid->loadRowValues($leave_record_grid->Recordset); // Load row values
				$leave_record_grid->setRecordKey($leave_record_grid->RowOldKey, $leave_record_grid->Recordset); // Set old record key
			} else {
				$leave_record_grid->loadRowValues(); // Load default values
				$leave_record_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$leave_record_grid->loadRowValues($leave_record_grid->Recordset); // Load row values
		}
		$leave_record->RowType = ROWTYPE_VIEW; // Render view
		if ($leave_record_grid->isGridAdd()) // Grid add
			$leave_record->RowType = ROWTYPE_ADD; // Render add
		if ($leave_record_grid->isGridAdd() && $leave_record->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$leave_record_grid->restoreCurrentRowFormValues($leave_record_grid->RowIndex); // Restore form values
		if ($leave_record_grid->isGridEdit()) { // Grid edit
			if ($leave_record->EventCancelled)
				$leave_record_grid->restoreCurrentRowFormValues($leave_record_grid->RowIndex); // Restore form values
			if ($leave_record_grid->RowAction == "insert")
				$leave_record->RowType = ROWTYPE_ADD; // Render add
			else
				$leave_record->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($leave_record_grid->isGridEdit() && ($leave_record->RowType == ROWTYPE_EDIT || $leave_record->RowType == ROWTYPE_ADD) && $leave_record->EventCancelled) // Update failed
			$leave_record_grid->restoreCurrentRowFormValues($leave_record_grid->RowIndex); // Restore form values
		if ($leave_record->RowType == ROWTYPE_EDIT) // Edit row
			$leave_record_grid->EditRowCount++;
		if ($leave_record->isConfirm()) // Confirm row
			$leave_record_grid->restoreCurrentRowFormValues($leave_record_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$leave_record->RowAttrs->merge(["data-rowindex" => $leave_record_grid->RowCount, "id" => "r" . $leave_record_grid->RowCount . "_leave_record", "data-rowtype" => $leave_record->RowType]);

		// Render row
		$leave_record_grid->renderRow();

		// Render list options
		$leave_record_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($leave_record_grid->RowAction != "delete" && $leave_record_grid->RowAction != "insertdelete" && !($leave_record_grid->RowAction == "insert" && $leave_record->isConfirm() && $leave_record_grid->emptyRow())) {
?>
	<tr <?php echo $leave_record->rowAttributes() ?>>
<?php

// Render list options (body, left)
$leave_record_grid->ListOptions->render("body", "left", $leave_record_grid->RowCount);
?>
	<?php if ($leave_record_grid->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $leave_record_grid->EmployeeID->cellAttributes() ?>>
<?php if ($leave_record->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($leave_record_grid->EmployeeID->getSessionValue() != "") { ?>
<span id="el<?php echo $leave_record_grid->RowCount ?>_leave_record_EmployeeID" class="form-group">
<span<?php echo $leave_record_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_record_grid->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" name="x<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_record_grid->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $leave_record_grid->RowCount ?>_leave_record_EmployeeID" class="form-group">
<input type="text" data-table="leave_record" data-field="x_EmployeeID" name="x<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" id="x<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($leave_record_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $leave_record_grid->EmployeeID->EditValue ?>"<?php echo $leave_record_grid->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="leave_record" data-field="x_EmployeeID" name="o<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" id="o<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_record_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($leave_record_grid->EmployeeID->getSessionValue() != "") { ?>

<span id="el<?php echo $leave_record_grid->RowCount ?>_leave_record_EmployeeID" class="form-group">
<span<?php echo $leave_record_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_record_grid->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" name="x<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_record_grid->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="leave_record" data-field="x_EmployeeID" name="x<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" id="x<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($leave_record_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $leave_record_grid->EmployeeID->EditValue ?>"<?php echo $leave_record_grid->EmployeeID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="leave_record" data-field="x_EmployeeID" name="o<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" id="o<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_record_grid->EmployeeID->OldValue != null ? $leave_record_grid->EmployeeID->OldValue : $leave_record_grid->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_record_grid->RowCount ?>_leave_record_EmployeeID">
<span<?php echo $leave_record_grid->EmployeeID->viewAttributes() ?>><?php echo $leave_record_grid->EmployeeID->getViewValue() ?></span>
</span>
<?php if (!$leave_record->isConfirm()) { ?>
<input type="hidden" data-table="leave_record" data-field="x_EmployeeID" name="x<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" id="x<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_record_grid->EmployeeID->FormValue) ?>">
<input type="hidden" data-table="leave_record" data-field="x_EmployeeID" name="o<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" id="o<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_record_grid->EmployeeID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="leave_record" data-field="x_EmployeeID" name="fleave_recordgrid$x<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" id="fleave_recordgrid$x<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_record_grid->EmployeeID->FormValue) ?>">
<input type="hidden" data-table="leave_record" data-field="x_EmployeeID" name="fleave_recordgrid$o<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" id="fleave_recordgrid$o<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_record_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_record_grid->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<td data-name="LeaveTypeCode" <?php echo $leave_record_grid->LeaveTypeCode->cellAttributes() ?>>
<?php if ($leave_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_record_grid->RowCount ?>_leave_record_LeaveTypeCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="leave_record" data-field="x_LeaveTypeCode" data-value-separator="<?php echo $leave_record_grid->LeaveTypeCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $leave_record_grid->RowIndex ?>_LeaveTypeCode" name="x<?php echo $leave_record_grid->RowIndex ?>_LeaveTypeCode"<?php echo $leave_record_grid->LeaveTypeCode->editAttributes() ?>>
			<?php echo $leave_record_grid->LeaveTypeCode->selectOptionListHtml("x{$leave_record_grid->RowIndex}_LeaveTypeCode") ?>
		</select>
</div>
<?php echo $leave_record_grid->LeaveTypeCode->Lookup->getParamTag($leave_record_grid, "p_x" . $leave_record_grid->RowIndex . "_LeaveTypeCode") ?>
</span>
<input type="hidden" data-table="leave_record" data-field="x_LeaveTypeCode" name="o<?php echo $leave_record_grid->RowIndex ?>_LeaveTypeCode" id="o<?php echo $leave_record_grid->RowIndex ?>_LeaveTypeCode" value="<?php echo HtmlEncode($leave_record_grid->LeaveTypeCode->OldValue) ?>">
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="leave_record" data-field="x_LeaveTypeCode" data-value-separator="<?php echo $leave_record_grid->LeaveTypeCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $leave_record_grid->RowIndex ?>_LeaveTypeCode" name="x<?php echo $leave_record_grid->RowIndex ?>_LeaveTypeCode"<?php echo $leave_record_grid->LeaveTypeCode->editAttributes() ?>>
			<?php echo $leave_record_grid->LeaveTypeCode->selectOptionListHtml("x{$leave_record_grid->RowIndex}_LeaveTypeCode") ?>
		</select>
</div>
<?php echo $leave_record_grid->LeaveTypeCode->Lookup->getParamTag($leave_record_grid, "p_x" . $leave_record_grid->RowIndex . "_LeaveTypeCode") ?>
<input type="hidden" data-table="leave_record" data-field="x_LeaveTypeCode" name="o<?php echo $leave_record_grid->RowIndex ?>_LeaveTypeCode" id="o<?php echo $leave_record_grid->RowIndex ?>_LeaveTypeCode" value="<?php echo HtmlEncode($leave_record_grid->LeaveTypeCode->OldValue != null ? $leave_record_grid->LeaveTypeCode->OldValue : $leave_record_grid->LeaveTypeCode->CurrentValue) ?>">
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_record_grid->RowCount ?>_leave_record_LeaveTypeCode">
<span<?php echo $leave_record_grid->LeaveTypeCode->viewAttributes() ?>><?php echo $leave_record_grid->LeaveTypeCode->getViewValue() ?></span>
</span>
<?php if (!$leave_record->isConfirm()) { ?>
<input type="hidden" data-table="leave_record" data-field="x_LeaveTypeCode" name="x<?php echo $leave_record_grid->RowIndex ?>_LeaveTypeCode" id="x<?php echo $leave_record_grid->RowIndex ?>_LeaveTypeCode" value="<?php echo HtmlEncode($leave_record_grid->LeaveTypeCode->FormValue) ?>">
<input type="hidden" data-table="leave_record" data-field="x_LeaveTypeCode" name="o<?php echo $leave_record_grid->RowIndex ?>_LeaveTypeCode" id="o<?php echo $leave_record_grid->RowIndex ?>_LeaveTypeCode" value="<?php echo HtmlEncode($leave_record_grid->LeaveTypeCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="leave_record" data-field="x_LeaveTypeCode" name="fleave_recordgrid$x<?php echo $leave_record_grid->RowIndex ?>_LeaveTypeCode" id="fleave_recordgrid$x<?php echo $leave_record_grid->RowIndex ?>_LeaveTypeCode" value="<?php echo HtmlEncode($leave_record_grid->LeaveTypeCode->FormValue) ?>">
<input type="hidden" data-table="leave_record" data-field="x_LeaveTypeCode" name="fleave_recordgrid$o<?php echo $leave_record_grid->RowIndex ?>_LeaveTypeCode" id="fleave_recordgrid$o<?php echo $leave_record_grid->RowIndex ?>_LeaveTypeCode" value="<?php echo HtmlEncode($leave_record_grid->LeaveTypeCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_record_grid->EffectiveDate->Visible) { // EffectiveDate ?>
		<td data-name="EffectiveDate" <?php echo $leave_record_grid->EffectiveDate->cellAttributes() ?>>
<?php if ($leave_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_record_grid->RowCount ?>_leave_record_EffectiveDate" class="form-group">
<input type="text" data-table="leave_record" data-field="x_EffectiveDate" name="x<?php echo $leave_record_grid->RowIndex ?>_EffectiveDate" id="x<?php echo $leave_record_grid->RowIndex ?>_EffectiveDate" placeholder="<?php echo HtmlEncode($leave_record_grid->EffectiveDate->getPlaceHolder()) ?>" value="<?php echo $leave_record_grid->EffectiveDate->EditValue ?>"<?php echo $leave_record_grid->EffectiveDate->editAttributes() ?>>
<?php if (!$leave_record_grid->EffectiveDate->ReadOnly && !$leave_record_grid->EffectiveDate->Disabled && !isset($leave_record_grid->EffectiveDate->EditAttrs["readonly"]) && !isset($leave_record_grid->EffectiveDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_recordgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_recordgrid", "x<?php echo $leave_record_grid->RowIndex ?>_EffectiveDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="leave_record" data-field="x_EffectiveDate" name="o<?php echo $leave_record_grid->RowIndex ?>_EffectiveDate" id="o<?php echo $leave_record_grid->RowIndex ?>_EffectiveDate" value="<?php echo HtmlEncode($leave_record_grid->EffectiveDate->OldValue) ?>">
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $leave_record_grid->RowCount ?>_leave_record_EffectiveDate" class="form-group">
<input type="text" data-table="leave_record" data-field="x_EffectiveDate" name="x<?php echo $leave_record_grid->RowIndex ?>_EffectiveDate" id="x<?php echo $leave_record_grid->RowIndex ?>_EffectiveDate" placeholder="<?php echo HtmlEncode($leave_record_grid->EffectiveDate->getPlaceHolder()) ?>" value="<?php echo $leave_record_grid->EffectiveDate->EditValue ?>"<?php echo $leave_record_grid->EffectiveDate->editAttributes() ?>>
<?php if (!$leave_record_grid->EffectiveDate->ReadOnly && !$leave_record_grid->EffectiveDate->Disabled && !isset($leave_record_grid->EffectiveDate->EditAttrs["readonly"]) && !isset($leave_record_grid->EffectiveDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_recordgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_recordgrid", "x<?php echo $leave_record_grid->RowIndex ?>_EffectiveDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_record_grid->RowCount ?>_leave_record_EffectiveDate">
<span<?php echo $leave_record_grid->EffectiveDate->viewAttributes() ?>><?php echo $leave_record_grid->EffectiveDate->getViewValue() ?></span>
</span>
<?php if (!$leave_record->isConfirm()) { ?>
<input type="hidden" data-table="leave_record" data-field="x_EffectiveDate" name="x<?php echo $leave_record_grid->RowIndex ?>_EffectiveDate" id="x<?php echo $leave_record_grid->RowIndex ?>_EffectiveDate" value="<?php echo HtmlEncode($leave_record_grid->EffectiveDate->FormValue) ?>">
<input type="hidden" data-table="leave_record" data-field="x_EffectiveDate" name="o<?php echo $leave_record_grid->RowIndex ?>_EffectiveDate" id="o<?php echo $leave_record_grid->RowIndex ?>_EffectiveDate" value="<?php echo HtmlEncode($leave_record_grid->EffectiveDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="leave_record" data-field="x_EffectiveDate" name="fleave_recordgrid$x<?php echo $leave_record_grid->RowIndex ?>_EffectiveDate" id="fleave_recordgrid$x<?php echo $leave_record_grid->RowIndex ?>_EffectiveDate" value="<?php echo HtmlEncode($leave_record_grid->EffectiveDate->FormValue) ?>">
<input type="hidden" data-table="leave_record" data-field="x_EffectiveDate" name="fleave_recordgrid$o<?php echo $leave_record_grid->RowIndex ?>_EffectiveDate" id="fleave_recordgrid$o<?php echo $leave_record_grid->RowIndex ?>_EffectiveDate" value="<?php echo HtmlEncode($leave_record_grid->EffectiveDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_record_grid->OpeningBalance->Visible) { // OpeningBalance ?>
		<td data-name="OpeningBalance" <?php echo $leave_record_grid->OpeningBalance->cellAttributes() ?>>
<?php if ($leave_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_record_grid->RowCount ?>_leave_record_OpeningBalance" class="form-group">
<input type="text" data-table="leave_record" data-field="x_OpeningBalance" name="x<?php echo $leave_record_grid->RowIndex ?>_OpeningBalance" id="x<?php echo $leave_record_grid->RowIndex ?>_OpeningBalance" size="30" placeholder="<?php echo HtmlEncode($leave_record_grid->OpeningBalance->getPlaceHolder()) ?>" value="<?php echo $leave_record_grid->OpeningBalance->EditValue ?>"<?php echo $leave_record_grid->OpeningBalance->editAttributes() ?>>
</span>
<input type="hidden" data-table="leave_record" data-field="x_OpeningBalance" name="o<?php echo $leave_record_grid->RowIndex ?>_OpeningBalance" id="o<?php echo $leave_record_grid->RowIndex ?>_OpeningBalance" value="<?php echo HtmlEncode($leave_record_grid->OpeningBalance->OldValue) ?>">
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $leave_record_grid->RowCount ?>_leave_record_OpeningBalance" class="form-group">
<input type="text" data-table="leave_record" data-field="x_OpeningBalance" name="x<?php echo $leave_record_grid->RowIndex ?>_OpeningBalance" id="x<?php echo $leave_record_grid->RowIndex ?>_OpeningBalance" size="30" placeholder="<?php echo HtmlEncode($leave_record_grid->OpeningBalance->getPlaceHolder()) ?>" value="<?php echo $leave_record_grid->OpeningBalance->EditValue ?>"<?php echo $leave_record_grid->OpeningBalance->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_record_grid->RowCount ?>_leave_record_OpeningBalance">
<span<?php echo $leave_record_grid->OpeningBalance->viewAttributes() ?>><?php echo $leave_record_grid->OpeningBalance->getViewValue() ?></span>
</span>
<?php if (!$leave_record->isConfirm()) { ?>
<input type="hidden" data-table="leave_record" data-field="x_OpeningBalance" name="x<?php echo $leave_record_grid->RowIndex ?>_OpeningBalance" id="x<?php echo $leave_record_grid->RowIndex ?>_OpeningBalance" value="<?php echo HtmlEncode($leave_record_grid->OpeningBalance->FormValue) ?>">
<input type="hidden" data-table="leave_record" data-field="x_OpeningBalance" name="o<?php echo $leave_record_grid->RowIndex ?>_OpeningBalance" id="o<?php echo $leave_record_grid->RowIndex ?>_OpeningBalance" value="<?php echo HtmlEncode($leave_record_grid->OpeningBalance->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="leave_record" data-field="x_OpeningBalance" name="fleave_recordgrid$x<?php echo $leave_record_grid->RowIndex ?>_OpeningBalance" id="fleave_recordgrid$x<?php echo $leave_record_grid->RowIndex ?>_OpeningBalance" value="<?php echo HtmlEncode($leave_record_grid->OpeningBalance->FormValue) ?>">
<input type="hidden" data-table="leave_record" data-field="x_OpeningBalance" name="fleave_recordgrid$o<?php echo $leave_record_grid->RowIndex ?>_OpeningBalance" id="fleave_recordgrid$o<?php echo $leave_record_grid->RowIndex ?>_OpeningBalance" value="<?php echo HtmlEncode($leave_record_grid->OpeningBalance->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_record_grid->LeaveAccrued->Visible) { // LeaveAccrued ?>
		<td data-name="LeaveAccrued" <?php echo $leave_record_grid->LeaveAccrued->cellAttributes() ?>>
<?php if ($leave_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_record_grid->RowCount ?>_leave_record_LeaveAccrued" class="form-group">
<input type="text" data-table="leave_record" data-field="x_LeaveAccrued" name="x<?php echo $leave_record_grid->RowIndex ?>_LeaveAccrued" id="x<?php echo $leave_record_grid->RowIndex ?>_LeaveAccrued" size="30" placeholder="<?php echo HtmlEncode($leave_record_grid->LeaveAccrued->getPlaceHolder()) ?>" value="<?php echo $leave_record_grid->LeaveAccrued->EditValue ?>"<?php echo $leave_record_grid->LeaveAccrued->editAttributes() ?>>
</span>
<input type="hidden" data-table="leave_record" data-field="x_LeaveAccrued" name="o<?php echo $leave_record_grid->RowIndex ?>_LeaveAccrued" id="o<?php echo $leave_record_grid->RowIndex ?>_LeaveAccrued" value="<?php echo HtmlEncode($leave_record_grid->LeaveAccrued->OldValue) ?>">
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $leave_record_grid->RowCount ?>_leave_record_LeaveAccrued" class="form-group">
<input type="text" data-table="leave_record" data-field="x_LeaveAccrued" name="x<?php echo $leave_record_grid->RowIndex ?>_LeaveAccrued" id="x<?php echo $leave_record_grid->RowIndex ?>_LeaveAccrued" size="30" placeholder="<?php echo HtmlEncode($leave_record_grid->LeaveAccrued->getPlaceHolder()) ?>" value="<?php echo $leave_record_grid->LeaveAccrued->EditValue ?>"<?php echo $leave_record_grid->LeaveAccrued->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_record_grid->RowCount ?>_leave_record_LeaveAccrued">
<span<?php echo $leave_record_grid->LeaveAccrued->viewAttributes() ?>><?php echo $leave_record_grid->LeaveAccrued->getViewValue() ?></span>
</span>
<?php if (!$leave_record->isConfirm()) { ?>
<input type="hidden" data-table="leave_record" data-field="x_LeaveAccrued" name="x<?php echo $leave_record_grid->RowIndex ?>_LeaveAccrued" id="x<?php echo $leave_record_grid->RowIndex ?>_LeaveAccrued" value="<?php echo HtmlEncode($leave_record_grid->LeaveAccrued->FormValue) ?>">
<input type="hidden" data-table="leave_record" data-field="x_LeaveAccrued" name="o<?php echo $leave_record_grid->RowIndex ?>_LeaveAccrued" id="o<?php echo $leave_record_grid->RowIndex ?>_LeaveAccrued" value="<?php echo HtmlEncode($leave_record_grid->LeaveAccrued->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="leave_record" data-field="x_LeaveAccrued" name="fleave_recordgrid$x<?php echo $leave_record_grid->RowIndex ?>_LeaveAccrued" id="fleave_recordgrid$x<?php echo $leave_record_grid->RowIndex ?>_LeaveAccrued" value="<?php echo HtmlEncode($leave_record_grid->LeaveAccrued->FormValue) ?>">
<input type="hidden" data-table="leave_record" data-field="x_LeaveAccrued" name="fleave_recordgrid$o<?php echo $leave_record_grid->RowIndex ?>_LeaveAccrued" id="fleave_recordgrid$o<?php echo $leave_record_grid->RowIndex ?>_LeaveAccrued" value="<?php echo HtmlEncode($leave_record_grid->LeaveAccrued->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_record_grid->LastAccrualDate->Visible) { // LastAccrualDate ?>
		<td data-name="LastAccrualDate" <?php echo $leave_record_grid->LastAccrualDate->cellAttributes() ?>>
<?php if ($leave_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_record_grid->RowCount ?>_leave_record_LastAccrualDate" class="form-group">
<input type="text" data-table="leave_record" data-field="x_LastAccrualDate" name="x<?php echo $leave_record_grid->RowIndex ?>_LastAccrualDate" id="x<?php echo $leave_record_grid->RowIndex ?>_LastAccrualDate" placeholder="<?php echo HtmlEncode($leave_record_grid->LastAccrualDate->getPlaceHolder()) ?>" value="<?php echo $leave_record_grid->LastAccrualDate->EditValue ?>"<?php echo $leave_record_grid->LastAccrualDate->editAttributes() ?>>
<?php if (!$leave_record_grid->LastAccrualDate->ReadOnly && !$leave_record_grid->LastAccrualDate->Disabled && !isset($leave_record_grid->LastAccrualDate->EditAttrs["readonly"]) && !isset($leave_record_grid->LastAccrualDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_recordgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_recordgrid", "x<?php echo $leave_record_grid->RowIndex ?>_LastAccrualDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="leave_record" data-field="x_LastAccrualDate" name="o<?php echo $leave_record_grid->RowIndex ?>_LastAccrualDate" id="o<?php echo $leave_record_grid->RowIndex ?>_LastAccrualDate" value="<?php echo HtmlEncode($leave_record_grid->LastAccrualDate->OldValue) ?>">
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $leave_record_grid->RowCount ?>_leave_record_LastAccrualDate" class="form-group">
<input type="text" data-table="leave_record" data-field="x_LastAccrualDate" name="x<?php echo $leave_record_grid->RowIndex ?>_LastAccrualDate" id="x<?php echo $leave_record_grid->RowIndex ?>_LastAccrualDate" placeholder="<?php echo HtmlEncode($leave_record_grid->LastAccrualDate->getPlaceHolder()) ?>" value="<?php echo $leave_record_grid->LastAccrualDate->EditValue ?>"<?php echo $leave_record_grid->LastAccrualDate->editAttributes() ?>>
<?php if (!$leave_record_grid->LastAccrualDate->ReadOnly && !$leave_record_grid->LastAccrualDate->Disabled && !isset($leave_record_grid->LastAccrualDate->EditAttrs["readonly"]) && !isset($leave_record_grid->LastAccrualDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_recordgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_recordgrid", "x<?php echo $leave_record_grid->RowIndex ?>_LastAccrualDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_record_grid->RowCount ?>_leave_record_LastAccrualDate">
<span<?php echo $leave_record_grid->LastAccrualDate->viewAttributes() ?>><?php echo $leave_record_grid->LastAccrualDate->getViewValue() ?></span>
</span>
<?php if (!$leave_record->isConfirm()) { ?>
<input type="hidden" data-table="leave_record" data-field="x_LastAccrualDate" name="x<?php echo $leave_record_grid->RowIndex ?>_LastAccrualDate" id="x<?php echo $leave_record_grid->RowIndex ?>_LastAccrualDate" value="<?php echo HtmlEncode($leave_record_grid->LastAccrualDate->FormValue) ?>">
<input type="hidden" data-table="leave_record" data-field="x_LastAccrualDate" name="o<?php echo $leave_record_grid->RowIndex ?>_LastAccrualDate" id="o<?php echo $leave_record_grid->RowIndex ?>_LastAccrualDate" value="<?php echo HtmlEncode($leave_record_grid->LastAccrualDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="leave_record" data-field="x_LastAccrualDate" name="fleave_recordgrid$x<?php echo $leave_record_grid->RowIndex ?>_LastAccrualDate" id="fleave_recordgrid$x<?php echo $leave_record_grid->RowIndex ?>_LastAccrualDate" value="<?php echo HtmlEncode($leave_record_grid->LastAccrualDate->FormValue) ?>">
<input type="hidden" data-table="leave_record" data-field="x_LastAccrualDate" name="fleave_recordgrid$o<?php echo $leave_record_grid->RowIndex ?>_LastAccrualDate" id="fleave_recordgrid$o<?php echo $leave_record_grid->RowIndex ?>_LastAccrualDate" value="<?php echo HtmlEncode($leave_record_grid->LastAccrualDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_record_grid->LeaveTaken->Visible) { // LeaveTaken ?>
		<td data-name="LeaveTaken" <?php echo $leave_record_grid->LeaveTaken->cellAttributes() ?>>
<?php if ($leave_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_record_grid->RowCount ?>_leave_record_LeaveTaken" class="form-group">
<input type="text" data-table="leave_record" data-field="x_LeaveTaken" name="x<?php echo $leave_record_grid->RowIndex ?>_LeaveTaken" id="x<?php echo $leave_record_grid->RowIndex ?>_LeaveTaken" size="30" placeholder="<?php echo HtmlEncode($leave_record_grid->LeaveTaken->getPlaceHolder()) ?>" value="<?php echo $leave_record_grid->LeaveTaken->EditValue ?>"<?php echo $leave_record_grid->LeaveTaken->editAttributes() ?>>
</span>
<input type="hidden" data-table="leave_record" data-field="x_LeaveTaken" name="o<?php echo $leave_record_grid->RowIndex ?>_LeaveTaken" id="o<?php echo $leave_record_grid->RowIndex ?>_LeaveTaken" value="<?php echo HtmlEncode($leave_record_grid->LeaveTaken->OldValue) ?>">
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $leave_record_grid->RowCount ?>_leave_record_LeaveTaken" class="form-group">
<input type="text" data-table="leave_record" data-field="x_LeaveTaken" name="x<?php echo $leave_record_grid->RowIndex ?>_LeaveTaken" id="x<?php echo $leave_record_grid->RowIndex ?>_LeaveTaken" size="30" placeholder="<?php echo HtmlEncode($leave_record_grid->LeaveTaken->getPlaceHolder()) ?>" value="<?php echo $leave_record_grid->LeaveTaken->EditValue ?>"<?php echo $leave_record_grid->LeaveTaken->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_record_grid->RowCount ?>_leave_record_LeaveTaken">
<span<?php echo $leave_record_grid->LeaveTaken->viewAttributes() ?>><?php echo $leave_record_grid->LeaveTaken->getViewValue() ?></span>
</span>
<?php if (!$leave_record->isConfirm()) { ?>
<input type="hidden" data-table="leave_record" data-field="x_LeaveTaken" name="x<?php echo $leave_record_grid->RowIndex ?>_LeaveTaken" id="x<?php echo $leave_record_grid->RowIndex ?>_LeaveTaken" value="<?php echo HtmlEncode($leave_record_grid->LeaveTaken->FormValue) ?>">
<input type="hidden" data-table="leave_record" data-field="x_LeaveTaken" name="o<?php echo $leave_record_grid->RowIndex ?>_LeaveTaken" id="o<?php echo $leave_record_grid->RowIndex ?>_LeaveTaken" value="<?php echo HtmlEncode($leave_record_grid->LeaveTaken->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="leave_record" data-field="x_LeaveTaken" name="fleave_recordgrid$x<?php echo $leave_record_grid->RowIndex ?>_LeaveTaken" id="fleave_recordgrid$x<?php echo $leave_record_grid->RowIndex ?>_LeaveTaken" value="<?php echo HtmlEncode($leave_record_grid->LeaveTaken->FormValue) ?>">
<input type="hidden" data-table="leave_record" data-field="x_LeaveTaken" name="fleave_recordgrid$o<?php echo $leave_record_grid->RowIndex ?>_LeaveTaken" id="fleave_recordgrid$o<?php echo $leave_record_grid->RowIndex ?>_LeaveTaken" value="<?php echo HtmlEncode($leave_record_grid->LeaveTaken->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_record_grid->LeaveCommuted->Visible) { // LeaveCommuted ?>
		<td data-name="LeaveCommuted" <?php echo $leave_record_grid->LeaveCommuted->cellAttributes() ?>>
<?php if ($leave_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_record_grid->RowCount ?>_leave_record_LeaveCommuted" class="form-group">
<input type="text" data-table="leave_record" data-field="x_LeaveCommuted" name="x<?php echo $leave_record_grid->RowIndex ?>_LeaveCommuted" id="x<?php echo $leave_record_grid->RowIndex ?>_LeaveCommuted" size="30" placeholder="<?php echo HtmlEncode($leave_record_grid->LeaveCommuted->getPlaceHolder()) ?>" value="<?php echo $leave_record_grid->LeaveCommuted->EditValue ?>"<?php echo $leave_record_grid->LeaveCommuted->editAttributes() ?>>
</span>
<input type="hidden" data-table="leave_record" data-field="x_LeaveCommuted" name="o<?php echo $leave_record_grid->RowIndex ?>_LeaveCommuted" id="o<?php echo $leave_record_grid->RowIndex ?>_LeaveCommuted" value="<?php echo HtmlEncode($leave_record_grid->LeaveCommuted->OldValue) ?>">
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $leave_record_grid->RowCount ?>_leave_record_LeaveCommuted" class="form-group">
<input type="text" data-table="leave_record" data-field="x_LeaveCommuted" name="x<?php echo $leave_record_grid->RowIndex ?>_LeaveCommuted" id="x<?php echo $leave_record_grid->RowIndex ?>_LeaveCommuted" size="30" placeholder="<?php echo HtmlEncode($leave_record_grid->LeaveCommuted->getPlaceHolder()) ?>" value="<?php echo $leave_record_grid->LeaveCommuted->EditValue ?>"<?php echo $leave_record_grid->LeaveCommuted->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_record_grid->RowCount ?>_leave_record_LeaveCommuted">
<span<?php echo $leave_record_grid->LeaveCommuted->viewAttributes() ?>><?php echo $leave_record_grid->LeaveCommuted->getViewValue() ?></span>
</span>
<?php if (!$leave_record->isConfirm()) { ?>
<input type="hidden" data-table="leave_record" data-field="x_LeaveCommuted" name="x<?php echo $leave_record_grid->RowIndex ?>_LeaveCommuted" id="x<?php echo $leave_record_grid->RowIndex ?>_LeaveCommuted" value="<?php echo HtmlEncode($leave_record_grid->LeaveCommuted->FormValue) ?>">
<input type="hidden" data-table="leave_record" data-field="x_LeaveCommuted" name="o<?php echo $leave_record_grid->RowIndex ?>_LeaveCommuted" id="o<?php echo $leave_record_grid->RowIndex ?>_LeaveCommuted" value="<?php echo HtmlEncode($leave_record_grid->LeaveCommuted->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="leave_record" data-field="x_LeaveCommuted" name="fleave_recordgrid$x<?php echo $leave_record_grid->RowIndex ?>_LeaveCommuted" id="fleave_recordgrid$x<?php echo $leave_record_grid->RowIndex ?>_LeaveCommuted" value="<?php echo HtmlEncode($leave_record_grid->LeaveCommuted->FormValue) ?>">
<input type="hidden" data-table="leave_record" data-field="x_LeaveCommuted" name="fleave_recordgrid$o<?php echo $leave_record_grid->RowIndex ?>_LeaveCommuted" id="fleave_recordgrid$o<?php echo $leave_record_grid->RowIndex ?>_LeaveCommuted" value="<?php echo HtmlEncode($leave_record_grid->LeaveCommuted->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$leave_record_grid->ListOptions->render("body", "right", $leave_record_grid->RowCount);
?>
	</tr>
<?php if ($leave_record->RowType == ROWTYPE_ADD || $leave_record->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fleave_recordgrid", "load"], function() {
	fleave_recordgrid.updateLists(<?php echo $leave_record_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$leave_record_grid->isGridAdd() || $leave_record->CurrentMode == "copy")
		if (!$leave_record_grid->Recordset->EOF)
			$leave_record_grid->Recordset->moveNext();
}
?>
<?php
	if ($leave_record->CurrentMode == "add" || $leave_record->CurrentMode == "copy" || $leave_record->CurrentMode == "edit") {
		$leave_record_grid->RowIndex = '$rowindex$';
		$leave_record_grid->loadRowValues();

		// Set row properties
		$leave_record->resetAttributes();
		$leave_record->RowAttrs->merge(["data-rowindex" => $leave_record_grid->RowIndex, "id" => "r0_leave_record", "data-rowtype" => ROWTYPE_ADD]);
		$leave_record->RowAttrs->appendClass("ew-template");
		$leave_record->RowType = ROWTYPE_ADD;

		// Render row
		$leave_record_grid->renderRow();

		// Render list options
		$leave_record_grid->renderListOptions();
		$leave_record_grid->StartRowCount = 0;
?>
	<tr <?php echo $leave_record->rowAttributes() ?>>
<?php

// Render list options (body, left)
$leave_record_grid->ListOptions->render("body", "left", $leave_record_grid->RowIndex);
?>
	<?php if ($leave_record_grid->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID">
<?php if (!$leave_record->isConfirm()) { ?>
<?php if ($leave_record_grid->EmployeeID->getSessionValue() != "") { ?>
<span id="el$rowindex$_leave_record_EmployeeID" class="form-group leave_record_EmployeeID">
<span<?php echo $leave_record_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_record_grid->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" name="x<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_record_grid->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_leave_record_EmployeeID" class="form-group leave_record_EmployeeID">
<input type="text" data-table="leave_record" data-field="x_EmployeeID" name="x<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" id="x<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($leave_record_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $leave_record_grid->EmployeeID->EditValue ?>"<?php echo $leave_record_grid->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_leave_record_EmployeeID" class="form-group leave_record_EmployeeID">
<span<?php echo $leave_record_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_record_grid->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="leave_record" data-field="x_EmployeeID" name="x<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" id="x<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_record_grid->EmployeeID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="leave_record" data-field="x_EmployeeID" name="o<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" id="o<?php echo $leave_record_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_record_grid->EmployeeID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_record_grid->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<td data-name="LeaveTypeCode">
<?php if (!$leave_record->isConfirm()) { ?>
<span id="el$rowindex$_leave_record_LeaveTypeCode" class="form-group leave_record_LeaveTypeCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="leave_record" data-field="x_LeaveTypeCode" data-value-separator="<?php echo $leave_record_grid->LeaveTypeCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $leave_record_grid->RowIndex ?>_LeaveTypeCode" name="x<?php echo $leave_record_grid->RowIndex ?>_LeaveTypeCode"<?php echo $leave_record_grid->LeaveTypeCode->editAttributes() ?>>
			<?php echo $leave_record_grid->LeaveTypeCode->selectOptionListHtml("x{$leave_record_grid->RowIndex}_LeaveTypeCode") ?>
		</select>
</div>
<?php echo $leave_record_grid->LeaveTypeCode->Lookup->getParamTag($leave_record_grid, "p_x" . $leave_record_grid->RowIndex . "_LeaveTypeCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_leave_record_LeaveTypeCode" class="form-group leave_record_LeaveTypeCode">
<span<?php echo $leave_record_grid->LeaveTypeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_record_grid->LeaveTypeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="leave_record" data-field="x_LeaveTypeCode" name="x<?php echo $leave_record_grid->RowIndex ?>_LeaveTypeCode" id="x<?php echo $leave_record_grid->RowIndex ?>_LeaveTypeCode" value="<?php echo HtmlEncode($leave_record_grid->LeaveTypeCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="leave_record" data-field="x_LeaveTypeCode" name="o<?php echo $leave_record_grid->RowIndex ?>_LeaveTypeCode" id="o<?php echo $leave_record_grid->RowIndex ?>_LeaveTypeCode" value="<?php echo HtmlEncode($leave_record_grid->LeaveTypeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_record_grid->EffectiveDate->Visible) { // EffectiveDate ?>
		<td data-name="EffectiveDate">
<?php if (!$leave_record->isConfirm()) { ?>
<span id="el$rowindex$_leave_record_EffectiveDate" class="form-group leave_record_EffectiveDate">
<input type="text" data-table="leave_record" data-field="x_EffectiveDate" name="x<?php echo $leave_record_grid->RowIndex ?>_EffectiveDate" id="x<?php echo $leave_record_grid->RowIndex ?>_EffectiveDate" placeholder="<?php echo HtmlEncode($leave_record_grid->EffectiveDate->getPlaceHolder()) ?>" value="<?php echo $leave_record_grid->EffectiveDate->EditValue ?>"<?php echo $leave_record_grid->EffectiveDate->editAttributes() ?>>
<?php if (!$leave_record_grid->EffectiveDate->ReadOnly && !$leave_record_grid->EffectiveDate->Disabled && !isset($leave_record_grid->EffectiveDate->EditAttrs["readonly"]) && !isset($leave_record_grid->EffectiveDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_recordgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_recordgrid", "x<?php echo $leave_record_grid->RowIndex ?>_EffectiveDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_leave_record_EffectiveDate" class="form-group leave_record_EffectiveDate">
<span<?php echo $leave_record_grid->EffectiveDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_record_grid->EffectiveDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="leave_record" data-field="x_EffectiveDate" name="x<?php echo $leave_record_grid->RowIndex ?>_EffectiveDate" id="x<?php echo $leave_record_grid->RowIndex ?>_EffectiveDate" value="<?php echo HtmlEncode($leave_record_grid->EffectiveDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="leave_record" data-field="x_EffectiveDate" name="o<?php echo $leave_record_grid->RowIndex ?>_EffectiveDate" id="o<?php echo $leave_record_grid->RowIndex ?>_EffectiveDate" value="<?php echo HtmlEncode($leave_record_grid->EffectiveDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_record_grid->OpeningBalance->Visible) { // OpeningBalance ?>
		<td data-name="OpeningBalance">
<?php if (!$leave_record->isConfirm()) { ?>
<span id="el$rowindex$_leave_record_OpeningBalance" class="form-group leave_record_OpeningBalance">
<input type="text" data-table="leave_record" data-field="x_OpeningBalance" name="x<?php echo $leave_record_grid->RowIndex ?>_OpeningBalance" id="x<?php echo $leave_record_grid->RowIndex ?>_OpeningBalance" size="30" placeholder="<?php echo HtmlEncode($leave_record_grid->OpeningBalance->getPlaceHolder()) ?>" value="<?php echo $leave_record_grid->OpeningBalance->EditValue ?>"<?php echo $leave_record_grid->OpeningBalance->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_leave_record_OpeningBalance" class="form-group leave_record_OpeningBalance">
<span<?php echo $leave_record_grid->OpeningBalance->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_record_grid->OpeningBalance->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="leave_record" data-field="x_OpeningBalance" name="x<?php echo $leave_record_grid->RowIndex ?>_OpeningBalance" id="x<?php echo $leave_record_grid->RowIndex ?>_OpeningBalance" value="<?php echo HtmlEncode($leave_record_grid->OpeningBalance->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="leave_record" data-field="x_OpeningBalance" name="o<?php echo $leave_record_grid->RowIndex ?>_OpeningBalance" id="o<?php echo $leave_record_grid->RowIndex ?>_OpeningBalance" value="<?php echo HtmlEncode($leave_record_grid->OpeningBalance->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_record_grid->LeaveAccrued->Visible) { // LeaveAccrued ?>
		<td data-name="LeaveAccrued">
<?php if (!$leave_record->isConfirm()) { ?>
<span id="el$rowindex$_leave_record_LeaveAccrued" class="form-group leave_record_LeaveAccrued">
<input type="text" data-table="leave_record" data-field="x_LeaveAccrued" name="x<?php echo $leave_record_grid->RowIndex ?>_LeaveAccrued" id="x<?php echo $leave_record_grid->RowIndex ?>_LeaveAccrued" size="30" placeholder="<?php echo HtmlEncode($leave_record_grid->LeaveAccrued->getPlaceHolder()) ?>" value="<?php echo $leave_record_grid->LeaveAccrued->EditValue ?>"<?php echo $leave_record_grid->LeaveAccrued->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_leave_record_LeaveAccrued" class="form-group leave_record_LeaveAccrued">
<span<?php echo $leave_record_grid->LeaveAccrued->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_record_grid->LeaveAccrued->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="leave_record" data-field="x_LeaveAccrued" name="x<?php echo $leave_record_grid->RowIndex ?>_LeaveAccrued" id="x<?php echo $leave_record_grid->RowIndex ?>_LeaveAccrued" value="<?php echo HtmlEncode($leave_record_grid->LeaveAccrued->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="leave_record" data-field="x_LeaveAccrued" name="o<?php echo $leave_record_grid->RowIndex ?>_LeaveAccrued" id="o<?php echo $leave_record_grid->RowIndex ?>_LeaveAccrued" value="<?php echo HtmlEncode($leave_record_grid->LeaveAccrued->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_record_grid->LastAccrualDate->Visible) { // LastAccrualDate ?>
		<td data-name="LastAccrualDate">
<?php if (!$leave_record->isConfirm()) { ?>
<span id="el$rowindex$_leave_record_LastAccrualDate" class="form-group leave_record_LastAccrualDate">
<input type="text" data-table="leave_record" data-field="x_LastAccrualDate" name="x<?php echo $leave_record_grid->RowIndex ?>_LastAccrualDate" id="x<?php echo $leave_record_grid->RowIndex ?>_LastAccrualDate" placeholder="<?php echo HtmlEncode($leave_record_grid->LastAccrualDate->getPlaceHolder()) ?>" value="<?php echo $leave_record_grid->LastAccrualDate->EditValue ?>"<?php echo $leave_record_grid->LastAccrualDate->editAttributes() ?>>
<?php if (!$leave_record_grid->LastAccrualDate->ReadOnly && !$leave_record_grid->LastAccrualDate->Disabled && !isset($leave_record_grid->LastAccrualDate->EditAttrs["readonly"]) && !isset($leave_record_grid->LastAccrualDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_recordgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_recordgrid", "x<?php echo $leave_record_grid->RowIndex ?>_LastAccrualDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_leave_record_LastAccrualDate" class="form-group leave_record_LastAccrualDate">
<span<?php echo $leave_record_grid->LastAccrualDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_record_grid->LastAccrualDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="leave_record" data-field="x_LastAccrualDate" name="x<?php echo $leave_record_grid->RowIndex ?>_LastAccrualDate" id="x<?php echo $leave_record_grid->RowIndex ?>_LastAccrualDate" value="<?php echo HtmlEncode($leave_record_grid->LastAccrualDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="leave_record" data-field="x_LastAccrualDate" name="o<?php echo $leave_record_grid->RowIndex ?>_LastAccrualDate" id="o<?php echo $leave_record_grid->RowIndex ?>_LastAccrualDate" value="<?php echo HtmlEncode($leave_record_grid->LastAccrualDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_record_grid->LeaveTaken->Visible) { // LeaveTaken ?>
		<td data-name="LeaveTaken">
<?php if (!$leave_record->isConfirm()) { ?>
<span id="el$rowindex$_leave_record_LeaveTaken" class="form-group leave_record_LeaveTaken">
<input type="text" data-table="leave_record" data-field="x_LeaveTaken" name="x<?php echo $leave_record_grid->RowIndex ?>_LeaveTaken" id="x<?php echo $leave_record_grid->RowIndex ?>_LeaveTaken" size="30" placeholder="<?php echo HtmlEncode($leave_record_grid->LeaveTaken->getPlaceHolder()) ?>" value="<?php echo $leave_record_grid->LeaveTaken->EditValue ?>"<?php echo $leave_record_grid->LeaveTaken->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_leave_record_LeaveTaken" class="form-group leave_record_LeaveTaken">
<span<?php echo $leave_record_grid->LeaveTaken->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_record_grid->LeaveTaken->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="leave_record" data-field="x_LeaveTaken" name="x<?php echo $leave_record_grid->RowIndex ?>_LeaveTaken" id="x<?php echo $leave_record_grid->RowIndex ?>_LeaveTaken" value="<?php echo HtmlEncode($leave_record_grid->LeaveTaken->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="leave_record" data-field="x_LeaveTaken" name="o<?php echo $leave_record_grid->RowIndex ?>_LeaveTaken" id="o<?php echo $leave_record_grid->RowIndex ?>_LeaveTaken" value="<?php echo HtmlEncode($leave_record_grid->LeaveTaken->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_record_grid->LeaveCommuted->Visible) { // LeaveCommuted ?>
		<td data-name="LeaveCommuted">
<?php if (!$leave_record->isConfirm()) { ?>
<span id="el$rowindex$_leave_record_LeaveCommuted" class="form-group leave_record_LeaveCommuted">
<input type="text" data-table="leave_record" data-field="x_LeaveCommuted" name="x<?php echo $leave_record_grid->RowIndex ?>_LeaveCommuted" id="x<?php echo $leave_record_grid->RowIndex ?>_LeaveCommuted" size="30" placeholder="<?php echo HtmlEncode($leave_record_grid->LeaveCommuted->getPlaceHolder()) ?>" value="<?php echo $leave_record_grid->LeaveCommuted->EditValue ?>"<?php echo $leave_record_grid->LeaveCommuted->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_leave_record_LeaveCommuted" class="form-group leave_record_LeaveCommuted">
<span<?php echo $leave_record_grid->LeaveCommuted->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_record_grid->LeaveCommuted->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="leave_record" data-field="x_LeaveCommuted" name="x<?php echo $leave_record_grid->RowIndex ?>_LeaveCommuted" id="x<?php echo $leave_record_grid->RowIndex ?>_LeaveCommuted" value="<?php echo HtmlEncode($leave_record_grid->LeaveCommuted->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="leave_record" data-field="x_LeaveCommuted" name="o<?php echo $leave_record_grid->RowIndex ?>_LeaveCommuted" id="o<?php echo $leave_record_grid->RowIndex ?>_LeaveCommuted" value="<?php echo HtmlEncode($leave_record_grid->LeaveCommuted->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$leave_record_grid->ListOptions->render("body", "right", $leave_record_grid->RowIndex);
?>
<script>
loadjs.ready(["fleave_recordgrid", "load"], function() {
	fleave_recordgrid.updateLists(<?php echo $leave_record_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($leave_record->CurrentMode == "add" || $leave_record->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $leave_record_grid->FormKeyCountName ?>" id="<?php echo $leave_record_grid->FormKeyCountName ?>" value="<?php echo $leave_record_grid->KeyCount ?>">
<?php echo $leave_record_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($leave_record->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $leave_record_grid->FormKeyCountName ?>" id="<?php echo $leave_record_grid->FormKeyCountName ?>" value="<?php echo $leave_record_grid->KeyCount ?>">
<?php echo $leave_record_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($leave_record->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fleave_recordgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($leave_record_grid->Recordset)
	$leave_record_grid->Recordset->Close();
?>
<?php if ($leave_record_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $leave_record_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($leave_record_grid->TotalRecords == 0 && !$leave_record->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $leave_record_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$leave_record_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$leave_record_grid->terminate();
?>