<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($council_meeting_grid))
	$council_meeting_grid = new council_meeting_grid();

// Run the page
$council_meeting_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$council_meeting_grid->Page_Render();
?>
<?php if (!$council_meeting_grid->isExport()) { ?>
<script>
var fcouncil_meetinggrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fcouncil_meetinggrid = new ew.Form("fcouncil_meetinggrid", "grid");
	fcouncil_meetinggrid.formKeyCountName = '<?php echo $council_meeting_grid->FormKeyCountName ?>';

	// Validate form
	fcouncil_meetinggrid.validate = function() {
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
			<?php if ($council_meeting_grid->MeetingNo->Required) { ?>
				elm = this.getElements("x" + infix + "_MeetingNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_grid->MeetingNo->caption(), $council_meeting_grid->MeetingNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_meeting_grid->MeetingRef->Required) { ?>
				elm = this.getElements("x" + infix + "_MeetingRef");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_grid->MeetingRef->caption(), $council_meeting_grid->MeetingRef->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_meeting_grid->MeetingType->Required) { ?>
				elm = this.getElements("x" + infix + "_MeetingType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_grid->MeetingType->caption(), $council_meeting_grid->MeetingType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_meeting_grid->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_grid->LACode->caption(), $council_meeting_grid->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_meeting_grid->PlannedDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_grid->PlannedDate->caption(), $council_meeting_grid->PlannedDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($council_meeting_grid->PlannedDate->errorMessage()) ?>");
			<?php if ($council_meeting_grid->ActualDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_grid->ActualDate->caption(), $council_meeting_grid->ActualDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($council_meeting_grid->ActualDate->errorMessage()) ?>");
			<?php if ($council_meeting_grid->Attendance->Required) { ?>
				elm = this.getElements("x" + infix + "_Attendance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_grid->Attendance->caption(), $council_meeting_grid->Attendance->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_meeting_grid->ChairedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_ChairedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_grid->ChairedBy->caption(), $council_meeting_grid->ChairedBy->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fcouncil_meetinggrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "MeetingRef", false)) return false;
		if (ew.valueChanged(fobj, infix, "MeetingType", false)) return false;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "PlannedDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActualDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "Attendance", false)) return false;
		if (ew.valueChanged(fobj, infix, "ChairedBy", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fcouncil_meetinggrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcouncil_meetinggrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcouncil_meetinggrid.lists["x_MeetingType"] = <?php echo $council_meeting_grid->MeetingType->Lookup->toClientList($council_meeting_grid) ?>;
	fcouncil_meetinggrid.lists["x_MeetingType"].options = <?php echo JsonEncode($council_meeting_grid->MeetingType->lookupOptions()) ?>;
	fcouncil_meetinggrid.lists["x_LACode"] = <?php echo $council_meeting_grid->LACode->Lookup->toClientList($council_meeting_grid) ?>;
	fcouncil_meetinggrid.lists["x_LACode"].options = <?php echo JsonEncode($council_meeting_grid->LACode->lookupOptions()) ?>;
	fcouncil_meetinggrid.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fcouncil_meetinggrid");
});
</script>
<?php } ?>
<?php
$council_meeting_grid->renderOtherOptions();
?>
<?php if ($council_meeting_grid->TotalRecords > 0 || $council_meeting->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($council_meeting_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> council_meeting">
<?php if ($council_meeting_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $council_meeting_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fcouncil_meetinggrid" class="ew-form ew-list-form form-inline">
<div id="gmp_council_meeting" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_council_meetinggrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$council_meeting->RowType = ROWTYPE_HEADER;

// Render list options
$council_meeting_grid->renderListOptions();

// Render list options (header, left)
$council_meeting_grid->ListOptions->render("header", "left");
?>
<?php if ($council_meeting_grid->MeetingNo->Visible) { // MeetingNo ?>
	<?php if ($council_meeting_grid->SortUrl($council_meeting_grid->MeetingNo) == "") { ?>
		<th data-name="MeetingNo" class="<?php echo $council_meeting_grid->MeetingNo->headerCellClass() ?>"><div id="elh_council_meeting_MeetingNo" class="council_meeting_MeetingNo"><div class="ew-table-header-caption"><?php echo $council_meeting_grid->MeetingNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MeetingNo" class="<?php echo $council_meeting_grid->MeetingNo->headerCellClass() ?>"><div><div id="elh_council_meeting_MeetingNo" class="council_meeting_MeetingNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_grid->MeetingNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_grid->MeetingNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_grid->MeetingNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_meeting_grid->MeetingRef->Visible) { // MeetingRef ?>
	<?php if ($council_meeting_grid->SortUrl($council_meeting_grid->MeetingRef) == "") { ?>
		<th data-name="MeetingRef" class="<?php echo $council_meeting_grid->MeetingRef->headerCellClass() ?>"><div id="elh_council_meeting_MeetingRef" class="council_meeting_MeetingRef"><div class="ew-table-header-caption"><?php echo $council_meeting_grid->MeetingRef->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MeetingRef" class="<?php echo $council_meeting_grid->MeetingRef->headerCellClass() ?>"><div><div id="elh_council_meeting_MeetingRef" class="council_meeting_MeetingRef">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_grid->MeetingRef->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_grid->MeetingRef->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_grid->MeetingRef->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_meeting_grid->MeetingType->Visible) { // MeetingType ?>
	<?php if ($council_meeting_grid->SortUrl($council_meeting_grid->MeetingType) == "") { ?>
		<th data-name="MeetingType" class="<?php echo $council_meeting_grid->MeetingType->headerCellClass() ?>"><div id="elh_council_meeting_MeetingType" class="council_meeting_MeetingType"><div class="ew-table-header-caption"><?php echo $council_meeting_grid->MeetingType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MeetingType" class="<?php echo $council_meeting_grid->MeetingType->headerCellClass() ?>"><div><div id="elh_council_meeting_MeetingType" class="council_meeting_MeetingType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_grid->MeetingType->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_grid->MeetingType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_grid->MeetingType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_meeting_grid->LACode->Visible) { // LACode ?>
	<?php if ($council_meeting_grid->SortUrl($council_meeting_grid->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $council_meeting_grid->LACode->headerCellClass() ?>"><div id="elh_council_meeting_LACode" class="council_meeting_LACode"><div class="ew-table-header-caption"><?php echo $council_meeting_grid->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $council_meeting_grid->LACode->headerCellClass() ?>"><div><div id="elh_council_meeting_LACode" class="council_meeting_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_grid->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_grid->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_grid->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_meeting_grid->PlannedDate->Visible) { // PlannedDate ?>
	<?php if ($council_meeting_grid->SortUrl($council_meeting_grid->PlannedDate) == "") { ?>
		<th data-name="PlannedDate" class="<?php echo $council_meeting_grid->PlannedDate->headerCellClass() ?>"><div id="elh_council_meeting_PlannedDate" class="council_meeting_PlannedDate"><div class="ew-table-header-caption"><?php echo $council_meeting_grid->PlannedDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PlannedDate" class="<?php echo $council_meeting_grid->PlannedDate->headerCellClass() ?>"><div><div id="elh_council_meeting_PlannedDate" class="council_meeting_PlannedDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_grid->PlannedDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_grid->PlannedDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_grid->PlannedDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_meeting_grid->ActualDate->Visible) { // ActualDate ?>
	<?php if ($council_meeting_grid->SortUrl($council_meeting_grid->ActualDate) == "") { ?>
		<th data-name="ActualDate" class="<?php echo $council_meeting_grid->ActualDate->headerCellClass() ?>"><div id="elh_council_meeting_ActualDate" class="council_meeting_ActualDate"><div class="ew-table-header-caption"><?php echo $council_meeting_grid->ActualDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActualDate" class="<?php echo $council_meeting_grid->ActualDate->headerCellClass() ?>"><div><div id="elh_council_meeting_ActualDate" class="council_meeting_ActualDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_grid->ActualDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_grid->ActualDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_grid->ActualDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_meeting_grid->Attendance->Visible) { // Attendance ?>
	<?php if ($council_meeting_grid->SortUrl($council_meeting_grid->Attendance) == "") { ?>
		<th data-name="Attendance" class="<?php echo $council_meeting_grid->Attendance->headerCellClass() ?>"><div id="elh_council_meeting_Attendance" class="council_meeting_Attendance"><div class="ew-table-header-caption"><?php echo $council_meeting_grid->Attendance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Attendance" class="<?php echo $council_meeting_grid->Attendance->headerCellClass() ?>"><div><div id="elh_council_meeting_Attendance" class="council_meeting_Attendance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_grid->Attendance->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_grid->Attendance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_grid->Attendance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_meeting_grid->ChairedBy->Visible) { // ChairedBy ?>
	<?php if ($council_meeting_grid->SortUrl($council_meeting_grid->ChairedBy) == "") { ?>
		<th data-name="ChairedBy" class="<?php echo $council_meeting_grid->ChairedBy->headerCellClass() ?>"><div id="elh_council_meeting_ChairedBy" class="council_meeting_ChairedBy"><div class="ew-table-header-caption"><?php echo $council_meeting_grid->ChairedBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChairedBy" class="<?php echo $council_meeting_grid->ChairedBy->headerCellClass() ?>"><div><div id="elh_council_meeting_ChairedBy" class="council_meeting_ChairedBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_grid->ChairedBy->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_grid->ChairedBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_grid->ChairedBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$council_meeting_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$council_meeting_grid->StartRecord = 1;
$council_meeting_grid->StopRecord = $council_meeting_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($council_meeting->isConfirm() || $council_meeting_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($council_meeting_grid->FormKeyCountName) && ($council_meeting_grid->isGridAdd() || $council_meeting_grid->isGridEdit() || $council_meeting->isConfirm())) {
		$council_meeting_grid->KeyCount = $CurrentForm->getValue($council_meeting_grid->FormKeyCountName);
		$council_meeting_grid->StopRecord = $council_meeting_grid->StartRecord + $council_meeting_grid->KeyCount - 1;
	}
}
$council_meeting_grid->RecordCount = $council_meeting_grid->StartRecord - 1;
if ($council_meeting_grid->Recordset && !$council_meeting_grid->Recordset->EOF) {
	$council_meeting_grid->Recordset->moveFirst();
	$selectLimit = $council_meeting_grid->UseSelectLimit;
	if (!$selectLimit && $council_meeting_grid->StartRecord > 1)
		$council_meeting_grid->Recordset->move($council_meeting_grid->StartRecord - 1);
} elseif (!$council_meeting->AllowAddDeleteRow && $council_meeting_grid->StopRecord == 0) {
	$council_meeting_grid->StopRecord = $council_meeting->GridAddRowCount;
}

// Initialize aggregate
$council_meeting->RowType = ROWTYPE_AGGREGATEINIT;
$council_meeting->resetAttributes();
$council_meeting_grid->renderRow();
if ($council_meeting_grid->isGridAdd())
	$council_meeting_grid->RowIndex = 0;
if ($council_meeting_grid->isGridEdit())
	$council_meeting_grid->RowIndex = 0;
while ($council_meeting_grid->RecordCount < $council_meeting_grid->StopRecord) {
	$council_meeting_grid->RecordCount++;
	if ($council_meeting_grid->RecordCount >= $council_meeting_grid->StartRecord) {
		$council_meeting_grid->RowCount++;
		if ($council_meeting_grid->isGridAdd() || $council_meeting_grid->isGridEdit() || $council_meeting->isConfirm()) {
			$council_meeting_grid->RowIndex++;
			$CurrentForm->Index = $council_meeting_grid->RowIndex;
			if ($CurrentForm->hasValue($council_meeting_grid->FormActionName) && ($council_meeting->isConfirm() || $council_meeting_grid->EventCancelled))
				$council_meeting_grid->RowAction = strval($CurrentForm->getValue($council_meeting_grid->FormActionName));
			elseif ($council_meeting_grid->isGridAdd())
				$council_meeting_grid->RowAction = "insert";
			else
				$council_meeting_grid->RowAction = "";
		}

		// Set up key count
		$council_meeting_grid->KeyCount = $council_meeting_grid->RowIndex;

		// Init row class and style
		$council_meeting->resetAttributes();
		$council_meeting->CssClass = "";
		if ($council_meeting_grid->isGridAdd()) {
			if ($council_meeting->CurrentMode == "copy") {
				$council_meeting_grid->loadRowValues($council_meeting_grid->Recordset); // Load row values
				$council_meeting_grid->setRecordKey($council_meeting_grid->RowOldKey, $council_meeting_grid->Recordset); // Set old record key
			} else {
				$council_meeting_grid->loadRowValues(); // Load default values
				$council_meeting_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$council_meeting_grid->loadRowValues($council_meeting_grid->Recordset); // Load row values
		}
		$council_meeting->RowType = ROWTYPE_VIEW; // Render view
		if ($council_meeting_grid->isGridAdd()) // Grid add
			$council_meeting->RowType = ROWTYPE_ADD; // Render add
		if ($council_meeting_grid->isGridAdd() && $council_meeting->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$council_meeting_grid->restoreCurrentRowFormValues($council_meeting_grid->RowIndex); // Restore form values
		if ($council_meeting_grid->isGridEdit()) { // Grid edit
			if ($council_meeting->EventCancelled)
				$council_meeting_grid->restoreCurrentRowFormValues($council_meeting_grid->RowIndex); // Restore form values
			if ($council_meeting_grid->RowAction == "insert")
				$council_meeting->RowType = ROWTYPE_ADD; // Render add
			else
				$council_meeting->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($council_meeting_grid->isGridEdit() && ($council_meeting->RowType == ROWTYPE_EDIT || $council_meeting->RowType == ROWTYPE_ADD) && $council_meeting->EventCancelled) // Update failed
			$council_meeting_grid->restoreCurrentRowFormValues($council_meeting_grid->RowIndex); // Restore form values
		if ($council_meeting->RowType == ROWTYPE_EDIT) // Edit row
			$council_meeting_grid->EditRowCount++;
		if ($council_meeting->isConfirm()) // Confirm row
			$council_meeting_grid->restoreCurrentRowFormValues($council_meeting_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$council_meeting->RowAttrs->merge(["data-rowindex" => $council_meeting_grid->RowCount, "id" => "r" . $council_meeting_grid->RowCount . "_council_meeting", "data-rowtype" => $council_meeting->RowType]);

		// Render row
		$council_meeting_grid->renderRow();

		// Render list options
		$council_meeting_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($council_meeting_grid->RowAction != "delete" && $council_meeting_grid->RowAction != "insertdelete" && !($council_meeting_grid->RowAction == "insert" && $council_meeting->isConfirm() && $council_meeting_grid->emptyRow())) {
?>
	<tr <?php echo $council_meeting->rowAttributes() ?>>
<?php

// Render list options (body, left)
$council_meeting_grid->ListOptions->render("body", "left", $council_meeting_grid->RowCount);
?>
	<?php if ($council_meeting_grid->MeetingNo->Visible) { // MeetingNo ?>
		<td data-name="MeetingNo" <?php echo $council_meeting_grid->MeetingNo->cellAttributes() ?>>
<?php if ($council_meeting->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_MeetingNo" class="form-group"></span>
<input type="hidden" data-table="council_meeting" data-field="x_MeetingNo" name="o<?php echo $council_meeting_grid->RowIndex ?>_MeetingNo" id="o<?php echo $council_meeting_grid->RowIndex ?>_MeetingNo" value="<?php echo HtmlEncode($council_meeting_grid->MeetingNo->OldValue) ?>">
<?php } ?>
<?php if ($council_meeting->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_MeetingNo" class="form-group">
<span<?php echo $council_meeting_grid->MeetingNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_meeting_grid->MeetingNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="council_meeting" data-field="x_MeetingNo" name="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingNo" id="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingNo" value="<?php echo HtmlEncode($council_meeting_grid->MeetingNo->CurrentValue) ?>">
<?php } ?>
<?php if ($council_meeting->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_MeetingNo">
<span<?php echo $council_meeting_grid->MeetingNo->viewAttributes() ?>><?php echo $council_meeting_grid->MeetingNo->getViewValue() ?></span>
</span>
<?php if (!$council_meeting->isConfirm()) { ?>
<input type="hidden" data-table="council_meeting" data-field="x_MeetingNo" name="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingNo" id="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingNo" value="<?php echo HtmlEncode($council_meeting_grid->MeetingNo->FormValue) ?>">
<input type="hidden" data-table="council_meeting" data-field="x_MeetingNo" name="o<?php echo $council_meeting_grid->RowIndex ?>_MeetingNo" id="o<?php echo $council_meeting_grid->RowIndex ?>_MeetingNo" value="<?php echo HtmlEncode($council_meeting_grid->MeetingNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="council_meeting" data-field="x_MeetingNo" name="fcouncil_meetinggrid$x<?php echo $council_meeting_grid->RowIndex ?>_MeetingNo" id="fcouncil_meetinggrid$x<?php echo $council_meeting_grid->RowIndex ?>_MeetingNo" value="<?php echo HtmlEncode($council_meeting_grid->MeetingNo->FormValue) ?>">
<input type="hidden" data-table="council_meeting" data-field="x_MeetingNo" name="fcouncil_meetinggrid$o<?php echo $council_meeting_grid->RowIndex ?>_MeetingNo" id="fcouncil_meetinggrid$o<?php echo $council_meeting_grid->RowIndex ?>_MeetingNo" value="<?php echo HtmlEncode($council_meeting_grid->MeetingNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($council_meeting_grid->MeetingRef->Visible) { // MeetingRef ?>
		<td data-name="MeetingRef" <?php echo $council_meeting_grid->MeetingRef->cellAttributes() ?>>
<?php if ($council_meeting->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_MeetingRef" class="form-group">
<input type="text" data-table="council_meeting" data-field="x_MeetingRef" name="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingRef" id="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingRef" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($council_meeting_grid->MeetingRef->getPlaceHolder()) ?>" value="<?php echo $council_meeting_grid->MeetingRef->EditValue ?>"<?php echo $council_meeting_grid->MeetingRef->editAttributes() ?>>
</span>
<input type="hidden" data-table="council_meeting" data-field="x_MeetingRef" name="o<?php echo $council_meeting_grid->RowIndex ?>_MeetingRef" id="o<?php echo $council_meeting_grid->RowIndex ?>_MeetingRef" value="<?php echo HtmlEncode($council_meeting_grid->MeetingRef->OldValue) ?>">
<?php } ?>
<?php if ($council_meeting->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_MeetingRef" class="form-group">
<input type="text" data-table="council_meeting" data-field="x_MeetingRef" name="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingRef" id="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingRef" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($council_meeting_grid->MeetingRef->getPlaceHolder()) ?>" value="<?php echo $council_meeting_grid->MeetingRef->EditValue ?>"<?php echo $council_meeting_grid->MeetingRef->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($council_meeting->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_MeetingRef">
<span<?php echo $council_meeting_grid->MeetingRef->viewAttributes() ?>><?php echo $council_meeting_grid->MeetingRef->getViewValue() ?></span>
</span>
<?php if (!$council_meeting->isConfirm()) { ?>
<input type="hidden" data-table="council_meeting" data-field="x_MeetingRef" name="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingRef" id="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingRef" value="<?php echo HtmlEncode($council_meeting_grid->MeetingRef->FormValue) ?>">
<input type="hidden" data-table="council_meeting" data-field="x_MeetingRef" name="o<?php echo $council_meeting_grid->RowIndex ?>_MeetingRef" id="o<?php echo $council_meeting_grid->RowIndex ?>_MeetingRef" value="<?php echo HtmlEncode($council_meeting_grid->MeetingRef->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="council_meeting" data-field="x_MeetingRef" name="fcouncil_meetinggrid$x<?php echo $council_meeting_grid->RowIndex ?>_MeetingRef" id="fcouncil_meetinggrid$x<?php echo $council_meeting_grid->RowIndex ?>_MeetingRef" value="<?php echo HtmlEncode($council_meeting_grid->MeetingRef->FormValue) ?>">
<input type="hidden" data-table="council_meeting" data-field="x_MeetingRef" name="fcouncil_meetinggrid$o<?php echo $council_meeting_grid->RowIndex ?>_MeetingRef" id="fcouncil_meetinggrid$o<?php echo $council_meeting_grid->RowIndex ?>_MeetingRef" value="<?php echo HtmlEncode($council_meeting_grid->MeetingRef->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($council_meeting_grid->MeetingType->Visible) { // MeetingType ?>
		<td data-name="MeetingType" <?php echo $council_meeting_grid->MeetingType->cellAttributes() ?>>
<?php if ($council_meeting->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_MeetingType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="council_meeting" data-field="x_MeetingType" data-value-separator="<?php echo $council_meeting_grid->MeetingType->displayValueSeparatorAttribute() ?>" id="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingType" name="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingType"<?php echo $council_meeting_grid->MeetingType->editAttributes() ?>>
			<?php echo $council_meeting_grid->MeetingType->selectOptionListHtml("x{$council_meeting_grid->RowIndex}_MeetingType") ?>
		</select>
</div>
<?php echo $council_meeting_grid->MeetingType->Lookup->getParamTag($council_meeting_grid, "p_x" . $council_meeting_grid->RowIndex . "_MeetingType") ?>
</span>
<input type="hidden" data-table="council_meeting" data-field="x_MeetingType" name="o<?php echo $council_meeting_grid->RowIndex ?>_MeetingType" id="o<?php echo $council_meeting_grid->RowIndex ?>_MeetingType" value="<?php echo HtmlEncode($council_meeting_grid->MeetingType->OldValue) ?>">
<?php } ?>
<?php if ($council_meeting->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_MeetingType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="council_meeting" data-field="x_MeetingType" data-value-separator="<?php echo $council_meeting_grid->MeetingType->displayValueSeparatorAttribute() ?>" id="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingType" name="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingType"<?php echo $council_meeting_grid->MeetingType->editAttributes() ?>>
			<?php echo $council_meeting_grid->MeetingType->selectOptionListHtml("x{$council_meeting_grid->RowIndex}_MeetingType") ?>
		</select>
</div>
<?php echo $council_meeting_grid->MeetingType->Lookup->getParamTag($council_meeting_grid, "p_x" . $council_meeting_grid->RowIndex . "_MeetingType") ?>
</span>
<?php } ?>
<?php if ($council_meeting->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_MeetingType">
<span<?php echo $council_meeting_grid->MeetingType->viewAttributes() ?>><?php echo $council_meeting_grid->MeetingType->getViewValue() ?></span>
</span>
<?php if (!$council_meeting->isConfirm()) { ?>
<input type="hidden" data-table="council_meeting" data-field="x_MeetingType" name="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingType" id="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingType" value="<?php echo HtmlEncode($council_meeting_grid->MeetingType->FormValue) ?>">
<input type="hidden" data-table="council_meeting" data-field="x_MeetingType" name="o<?php echo $council_meeting_grid->RowIndex ?>_MeetingType" id="o<?php echo $council_meeting_grid->RowIndex ?>_MeetingType" value="<?php echo HtmlEncode($council_meeting_grid->MeetingType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="council_meeting" data-field="x_MeetingType" name="fcouncil_meetinggrid$x<?php echo $council_meeting_grid->RowIndex ?>_MeetingType" id="fcouncil_meetinggrid$x<?php echo $council_meeting_grid->RowIndex ?>_MeetingType" value="<?php echo HtmlEncode($council_meeting_grid->MeetingType->FormValue) ?>">
<input type="hidden" data-table="council_meeting" data-field="x_MeetingType" name="fcouncil_meetinggrid$o<?php echo $council_meeting_grid->RowIndex ?>_MeetingType" id="fcouncil_meetinggrid$o<?php echo $council_meeting_grid->RowIndex ?>_MeetingType" value="<?php echo HtmlEncode($council_meeting_grid->MeetingType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($council_meeting_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $council_meeting_grid->LACode->cellAttributes() ?>>
<?php if ($council_meeting->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($council_meeting_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_LACode" class="form-group">
<span<?php echo $council_meeting_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_meeting_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $council_meeting_grid->RowIndex ?>_LACode" name="x<?php echo $council_meeting_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_meeting_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_LACode" class="form-group">
<?php
$onchange = $council_meeting_grid->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$council_meeting_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $council_meeting_grid->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $council_meeting_grid->RowIndex ?>_LACode" id="sv_x<?php echo $council_meeting_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($council_meeting_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($council_meeting_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($council_meeting_grid->LACode->getPlaceHolder()) ?>"<?php echo $council_meeting_grid->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($council_meeting_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $council_meeting_grid->RowIndex ?>_LACode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($council_meeting_grid->LACode->ReadOnly || $council_meeting_grid->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="council_meeting" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $council_meeting_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $council_meeting_grid->RowIndex ?>_LACode" id="x<?php echo $council_meeting_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_meeting_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncil_meetinggrid"], function() {
	fcouncil_meetinggrid.createAutoSuggest({"id":"x<?php echo $council_meeting_grid->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $council_meeting_grid->LACode->Lookup->getParamTag($council_meeting_grid, "p_x" . $council_meeting_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="council_meeting" data-field="x_LACode" name="o<?php echo $council_meeting_grid->RowIndex ?>_LACode" id="o<?php echo $council_meeting_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_meeting_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($council_meeting->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($council_meeting_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_LACode" class="form-group">
<span<?php echo $council_meeting_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_meeting_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $council_meeting_grid->RowIndex ?>_LACode" name="x<?php echo $council_meeting_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_meeting_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_LACode" class="form-group">
<?php
$onchange = $council_meeting_grid->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$council_meeting_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $council_meeting_grid->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $council_meeting_grid->RowIndex ?>_LACode" id="sv_x<?php echo $council_meeting_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($council_meeting_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($council_meeting_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($council_meeting_grid->LACode->getPlaceHolder()) ?>"<?php echo $council_meeting_grid->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($council_meeting_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $council_meeting_grid->RowIndex ?>_LACode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($council_meeting_grid->LACode->ReadOnly || $council_meeting_grid->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="council_meeting" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $council_meeting_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $council_meeting_grid->RowIndex ?>_LACode" id="x<?php echo $council_meeting_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_meeting_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncil_meetinggrid"], function() {
	fcouncil_meetinggrid.createAutoSuggest({"id":"x<?php echo $council_meeting_grid->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $council_meeting_grid->LACode->Lookup->getParamTag($council_meeting_grid, "p_x" . $council_meeting_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($council_meeting->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_LACode">
<span<?php echo $council_meeting_grid->LACode->viewAttributes() ?>><?php echo $council_meeting_grid->LACode->getViewValue() ?></span>
</span>
<?php if (!$council_meeting->isConfirm()) { ?>
<input type="hidden" data-table="council_meeting" data-field="x_LACode" name="x<?php echo $council_meeting_grid->RowIndex ?>_LACode" id="x<?php echo $council_meeting_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_meeting_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="council_meeting" data-field="x_LACode" name="o<?php echo $council_meeting_grid->RowIndex ?>_LACode" id="o<?php echo $council_meeting_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_meeting_grid->LACode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="council_meeting" data-field="x_LACode" name="fcouncil_meetinggrid$x<?php echo $council_meeting_grid->RowIndex ?>_LACode" id="fcouncil_meetinggrid$x<?php echo $council_meeting_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_meeting_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="council_meeting" data-field="x_LACode" name="fcouncil_meetinggrid$o<?php echo $council_meeting_grid->RowIndex ?>_LACode" id="fcouncil_meetinggrid$o<?php echo $council_meeting_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_meeting_grid->LACode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($council_meeting_grid->PlannedDate->Visible) { // PlannedDate ?>
		<td data-name="PlannedDate" <?php echo $council_meeting_grid->PlannedDate->cellAttributes() ?>>
<?php if ($council_meeting->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_PlannedDate" class="form-group">
<input type="text" data-table="council_meeting" data-field="x_PlannedDate" name="x<?php echo $council_meeting_grid->RowIndex ?>_PlannedDate" id="x<?php echo $council_meeting_grid->RowIndex ?>_PlannedDate" placeholder="<?php echo HtmlEncode($council_meeting_grid->PlannedDate->getPlaceHolder()) ?>" value="<?php echo $council_meeting_grid->PlannedDate->EditValue ?>"<?php echo $council_meeting_grid->PlannedDate->editAttributes() ?>>
<?php if (!$council_meeting_grid->PlannedDate->ReadOnly && !$council_meeting_grid->PlannedDate->Disabled && !isset($council_meeting_grid->PlannedDate->EditAttrs["readonly"]) && !isset($council_meeting_grid->PlannedDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcouncil_meetinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fcouncil_meetinggrid", "x<?php echo $council_meeting_grid->RowIndex ?>_PlannedDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="council_meeting" data-field="x_PlannedDate" name="o<?php echo $council_meeting_grid->RowIndex ?>_PlannedDate" id="o<?php echo $council_meeting_grid->RowIndex ?>_PlannedDate" value="<?php echo HtmlEncode($council_meeting_grid->PlannedDate->OldValue) ?>">
<?php } ?>
<?php if ($council_meeting->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_PlannedDate" class="form-group">
<input type="text" data-table="council_meeting" data-field="x_PlannedDate" name="x<?php echo $council_meeting_grid->RowIndex ?>_PlannedDate" id="x<?php echo $council_meeting_grid->RowIndex ?>_PlannedDate" placeholder="<?php echo HtmlEncode($council_meeting_grid->PlannedDate->getPlaceHolder()) ?>" value="<?php echo $council_meeting_grid->PlannedDate->EditValue ?>"<?php echo $council_meeting_grid->PlannedDate->editAttributes() ?>>
<?php if (!$council_meeting_grid->PlannedDate->ReadOnly && !$council_meeting_grid->PlannedDate->Disabled && !isset($council_meeting_grid->PlannedDate->EditAttrs["readonly"]) && !isset($council_meeting_grid->PlannedDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcouncil_meetinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fcouncil_meetinggrid", "x<?php echo $council_meeting_grid->RowIndex ?>_PlannedDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($council_meeting->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_PlannedDate">
<span<?php echo $council_meeting_grid->PlannedDate->viewAttributes() ?>><?php echo $council_meeting_grid->PlannedDate->getViewValue() ?></span>
</span>
<?php if (!$council_meeting->isConfirm()) { ?>
<input type="hidden" data-table="council_meeting" data-field="x_PlannedDate" name="x<?php echo $council_meeting_grid->RowIndex ?>_PlannedDate" id="x<?php echo $council_meeting_grid->RowIndex ?>_PlannedDate" value="<?php echo HtmlEncode($council_meeting_grid->PlannedDate->FormValue) ?>">
<input type="hidden" data-table="council_meeting" data-field="x_PlannedDate" name="o<?php echo $council_meeting_grid->RowIndex ?>_PlannedDate" id="o<?php echo $council_meeting_grid->RowIndex ?>_PlannedDate" value="<?php echo HtmlEncode($council_meeting_grid->PlannedDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="council_meeting" data-field="x_PlannedDate" name="fcouncil_meetinggrid$x<?php echo $council_meeting_grid->RowIndex ?>_PlannedDate" id="fcouncil_meetinggrid$x<?php echo $council_meeting_grid->RowIndex ?>_PlannedDate" value="<?php echo HtmlEncode($council_meeting_grid->PlannedDate->FormValue) ?>">
<input type="hidden" data-table="council_meeting" data-field="x_PlannedDate" name="fcouncil_meetinggrid$o<?php echo $council_meeting_grid->RowIndex ?>_PlannedDate" id="fcouncil_meetinggrid$o<?php echo $council_meeting_grid->RowIndex ?>_PlannedDate" value="<?php echo HtmlEncode($council_meeting_grid->PlannedDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($council_meeting_grid->ActualDate->Visible) { // ActualDate ?>
		<td data-name="ActualDate" <?php echo $council_meeting_grid->ActualDate->cellAttributes() ?>>
<?php if ($council_meeting->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_ActualDate" class="form-group">
<input type="text" data-table="council_meeting" data-field="x_ActualDate" name="x<?php echo $council_meeting_grid->RowIndex ?>_ActualDate" id="x<?php echo $council_meeting_grid->RowIndex ?>_ActualDate" placeholder="<?php echo HtmlEncode($council_meeting_grid->ActualDate->getPlaceHolder()) ?>" value="<?php echo $council_meeting_grid->ActualDate->EditValue ?>"<?php echo $council_meeting_grid->ActualDate->editAttributes() ?>>
<?php if (!$council_meeting_grid->ActualDate->ReadOnly && !$council_meeting_grid->ActualDate->Disabled && !isset($council_meeting_grid->ActualDate->EditAttrs["readonly"]) && !isset($council_meeting_grid->ActualDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcouncil_meetinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fcouncil_meetinggrid", "x<?php echo $council_meeting_grid->RowIndex ?>_ActualDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="council_meeting" data-field="x_ActualDate" name="o<?php echo $council_meeting_grid->RowIndex ?>_ActualDate" id="o<?php echo $council_meeting_grid->RowIndex ?>_ActualDate" value="<?php echo HtmlEncode($council_meeting_grid->ActualDate->OldValue) ?>">
<?php } ?>
<?php if ($council_meeting->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_ActualDate" class="form-group">
<input type="text" data-table="council_meeting" data-field="x_ActualDate" name="x<?php echo $council_meeting_grid->RowIndex ?>_ActualDate" id="x<?php echo $council_meeting_grid->RowIndex ?>_ActualDate" placeholder="<?php echo HtmlEncode($council_meeting_grid->ActualDate->getPlaceHolder()) ?>" value="<?php echo $council_meeting_grid->ActualDate->EditValue ?>"<?php echo $council_meeting_grid->ActualDate->editAttributes() ?>>
<?php if (!$council_meeting_grid->ActualDate->ReadOnly && !$council_meeting_grid->ActualDate->Disabled && !isset($council_meeting_grid->ActualDate->EditAttrs["readonly"]) && !isset($council_meeting_grid->ActualDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcouncil_meetinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fcouncil_meetinggrid", "x<?php echo $council_meeting_grid->RowIndex ?>_ActualDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($council_meeting->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_ActualDate">
<span<?php echo $council_meeting_grid->ActualDate->viewAttributes() ?>><?php echo $council_meeting_grid->ActualDate->getViewValue() ?></span>
</span>
<?php if (!$council_meeting->isConfirm()) { ?>
<input type="hidden" data-table="council_meeting" data-field="x_ActualDate" name="x<?php echo $council_meeting_grid->RowIndex ?>_ActualDate" id="x<?php echo $council_meeting_grid->RowIndex ?>_ActualDate" value="<?php echo HtmlEncode($council_meeting_grid->ActualDate->FormValue) ?>">
<input type="hidden" data-table="council_meeting" data-field="x_ActualDate" name="o<?php echo $council_meeting_grid->RowIndex ?>_ActualDate" id="o<?php echo $council_meeting_grid->RowIndex ?>_ActualDate" value="<?php echo HtmlEncode($council_meeting_grid->ActualDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="council_meeting" data-field="x_ActualDate" name="fcouncil_meetinggrid$x<?php echo $council_meeting_grid->RowIndex ?>_ActualDate" id="fcouncil_meetinggrid$x<?php echo $council_meeting_grid->RowIndex ?>_ActualDate" value="<?php echo HtmlEncode($council_meeting_grid->ActualDate->FormValue) ?>">
<input type="hidden" data-table="council_meeting" data-field="x_ActualDate" name="fcouncil_meetinggrid$o<?php echo $council_meeting_grid->RowIndex ?>_ActualDate" id="fcouncil_meetinggrid$o<?php echo $council_meeting_grid->RowIndex ?>_ActualDate" value="<?php echo HtmlEncode($council_meeting_grid->ActualDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($council_meeting_grid->Attendance->Visible) { // Attendance ?>
		<td data-name="Attendance" <?php echo $council_meeting_grid->Attendance->cellAttributes() ?>>
<?php if ($council_meeting->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_Attendance" class="form-group">
<input type="text" data-table="council_meeting" data-field="x_Attendance" name="x<?php echo $council_meeting_grid->RowIndex ?>_Attendance" id="x<?php echo $council_meeting_grid->RowIndex ?>_Attendance" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($council_meeting_grid->Attendance->getPlaceHolder()) ?>" value="<?php echo $council_meeting_grid->Attendance->EditValue ?>"<?php echo $council_meeting_grid->Attendance->editAttributes() ?>>
</span>
<input type="hidden" data-table="council_meeting" data-field="x_Attendance" name="o<?php echo $council_meeting_grid->RowIndex ?>_Attendance" id="o<?php echo $council_meeting_grid->RowIndex ?>_Attendance" value="<?php echo HtmlEncode($council_meeting_grid->Attendance->OldValue) ?>">
<?php } ?>
<?php if ($council_meeting->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_Attendance" class="form-group">
<input type="text" data-table="council_meeting" data-field="x_Attendance" name="x<?php echo $council_meeting_grid->RowIndex ?>_Attendance" id="x<?php echo $council_meeting_grid->RowIndex ?>_Attendance" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($council_meeting_grid->Attendance->getPlaceHolder()) ?>" value="<?php echo $council_meeting_grid->Attendance->EditValue ?>"<?php echo $council_meeting_grid->Attendance->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($council_meeting->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_Attendance">
<span<?php echo $council_meeting_grid->Attendance->viewAttributes() ?>><?php echo $council_meeting_grid->Attendance->getViewValue() ?></span>
</span>
<?php if (!$council_meeting->isConfirm()) { ?>
<input type="hidden" data-table="council_meeting" data-field="x_Attendance" name="x<?php echo $council_meeting_grid->RowIndex ?>_Attendance" id="x<?php echo $council_meeting_grid->RowIndex ?>_Attendance" value="<?php echo HtmlEncode($council_meeting_grid->Attendance->FormValue) ?>">
<input type="hidden" data-table="council_meeting" data-field="x_Attendance" name="o<?php echo $council_meeting_grid->RowIndex ?>_Attendance" id="o<?php echo $council_meeting_grid->RowIndex ?>_Attendance" value="<?php echo HtmlEncode($council_meeting_grid->Attendance->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="council_meeting" data-field="x_Attendance" name="fcouncil_meetinggrid$x<?php echo $council_meeting_grid->RowIndex ?>_Attendance" id="fcouncil_meetinggrid$x<?php echo $council_meeting_grid->RowIndex ?>_Attendance" value="<?php echo HtmlEncode($council_meeting_grid->Attendance->FormValue) ?>">
<input type="hidden" data-table="council_meeting" data-field="x_Attendance" name="fcouncil_meetinggrid$o<?php echo $council_meeting_grid->RowIndex ?>_Attendance" id="fcouncil_meetinggrid$o<?php echo $council_meeting_grid->RowIndex ?>_Attendance" value="<?php echo HtmlEncode($council_meeting_grid->Attendance->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($council_meeting_grid->ChairedBy->Visible) { // ChairedBy ?>
		<td data-name="ChairedBy" <?php echo $council_meeting_grid->ChairedBy->cellAttributes() ?>>
<?php if ($council_meeting->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_ChairedBy" class="form-group">
<input type="text" data-table="council_meeting" data-field="x_ChairedBy" name="x<?php echo $council_meeting_grid->RowIndex ?>_ChairedBy" id="x<?php echo $council_meeting_grid->RowIndex ?>_ChairedBy" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($council_meeting_grid->ChairedBy->getPlaceHolder()) ?>" value="<?php echo $council_meeting_grid->ChairedBy->EditValue ?>"<?php echo $council_meeting_grid->ChairedBy->editAttributes() ?>>
</span>
<input type="hidden" data-table="council_meeting" data-field="x_ChairedBy" name="o<?php echo $council_meeting_grid->RowIndex ?>_ChairedBy" id="o<?php echo $council_meeting_grid->RowIndex ?>_ChairedBy" value="<?php echo HtmlEncode($council_meeting_grid->ChairedBy->OldValue) ?>">
<?php } ?>
<?php if ($council_meeting->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_ChairedBy" class="form-group">
<input type="text" data-table="council_meeting" data-field="x_ChairedBy" name="x<?php echo $council_meeting_grid->RowIndex ?>_ChairedBy" id="x<?php echo $council_meeting_grid->RowIndex ?>_ChairedBy" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($council_meeting_grid->ChairedBy->getPlaceHolder()) ?>" value="<?php echo $council_meeting_grid->ChairedBy->EditValue ?>"<?php echo $council_meeting_grid->ChairedBy->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($council_meeting->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $council_meeting_grid->RowCount ?>_council_meeting_ChairedBy">
<span<?php echo $council_meeting_grid->ChairedBy->viewAttributes() ?>><?php echo $council_meeting_grid->ChairedBy->getViewValue() ?></span>
</span>
<?php if (!$council_meeting->isConfirm()) { ?>
<input type="hidden" data-table="council_meeting" data-field="x_ChairedBy" name="x<?php echo $council_meeting_grid->RowIndex ?>_ChairedBy" id="x<?php echo $council_meeting_grid->RowIndex ?>_ChairedBy" value="<?php echo HtmlEncode($council_meeting_grid->ChairedBy->FormValue) ?>">
<input type="hidden" data-table="council_meeting" data-field="x_ChairedBy" name="o<?php echo $council_meeting_grid->RowIndex ?>_ChairedBy" id="o<?php echo $council_meeting_grid->RowIndex ?>_ChairedBy" value="<?php echo HtmlEncode($council_meeting_grid->ChairedBy->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="council_meeting" data-field="x_ChairedBy" name="fcouncil_meetinggrid$x<?php echo $council_meeting_grid->RowIndex ?>_ChairedBy" id="fcouncil_meetinggrid$x<?php echo $council_meeting_grid->RowIndex ?>_ChairedBy" value="<?php echo HtmlEncode($council_meeting_grid->ChairedBy->FormValue) ?>">
<input type="hidden" data-table="council_meeting" data-field="x_ChairedBy" name="fcouncil_meetinggrid$o<?php echo $council_meeting_grid->RowIndex ?>_ChairedBy" id="fcouncil_meetinggrid$o<?php echo $council_meeting_grid->RowIndex ?>_ChairedBy" value="<?php echo HtmlEncode($council_meeting_grid->ChairedBy->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$council_meeting_grid->ListOptions->render("body", "right", $council_meeting_grid->RowCount);
?>
	</tr>
<?php if ($council_meeting->RowType == ROWTYPE_ADD || $council_meeting->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fcouncil_meetinggrid", "load"], function() {
	fcouncil_meetinggrid.updateLists(<?php echo $council_meeting_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$council_meeting_grid->isGridAdd() || $council_meeting->CurrentMode == "copy")
		if (!$council_meeting_grid->Recordset->EOF)
			$council_meeting_grid->Recordset->moveNext();
}
?>
<?php
	if ($council_meeting->CurrentMode == "add" || $council_meeting->CurrentMode == "copy" || $council_meeting->CurrentMode == "edit") {
		$council_meeting_grid->RowIndex = '$rowindex$';
		$council_meeting_grid->loadRowValues();

		// Set row properties
		$council_meeting->resetAttributes();
		$council_meeting->RowAttrs->merge(["data-rowindex" => $council_meeting_grid->RowIndex, "id" => "r0_council_meeting", "data-rowtype" => ROWTYPE_ADD]);
		$council_meeting->RowAttrs->appendClass("ew-template");
		$council_meeting->RowType = ROWTYPE_ADD;

		// Render row
		$council_meeting_grid->renderRow();

		// Render list options
		$council_meeting_grid->renderListOptions();
		$council_meeting_grid->StartRowCount = 0;
?>
	<tr <?php echo $council_meeting->rowAttributes() ?>>
<?php

// Render list options (body, left)
$council_meeting_grid->ListOptions->render("body", "left", $council_meeting_grid->RowIndex);
?>
	<?php if ($council_meeting_grid->MeetingNo->Visible) { // MeetingNo ?>
		<td data-name="MeetingNo">
<?php if (!$council_meeting->isConfirm()) { ?>
<span id="el$rowindex$_council_meeting_MeetingNo" class="form-group council_meeting_MeetingNo"></span>
<?php } else { ?>
<span id="el$rowindex$_council_meeting_MeetingNo" class="form-group council_meeting_MeetingNo">
<span<?php echo $council_meeting_grid->MeetingNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_meeting_grid->MeetingNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="council_meeting" data-field="x_MeetingNo" name="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingNo" id="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingNo" value="<?php echo HtmlEncode($council_meeting_grid->MeetingNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="council_meeting" data-field="x_MeetingNo" name="o<?php echo $council_meeting_grid->RowIndex ?>_MeetingNo" id="o<?php echo $council_meeting_grid->RowIndex ?>_MeetingNo" value="<?php echo HtmlEncode($council_meeting_grid->MeetingNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($council_meeting_grid->MeetingRef->Visible) { // MeetingRef ?>
		<td data-name="MeetingRef">
<?php if (!$council_meeting->isConfirm()) { ?>
<span id="el$rowindex$_council_meeting_MeetingRef" class="form-group council_meeting_MeetingRef">
<input type="text" data-table="council_meeting" data-field="x_MeetingRef" name="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingRef" id="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingRef" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($council_meeting_grid->MeetingRef->getPlaceHolder()) ?>" value="<?php echo $council_meeting_grid->MeetingRef->EditValue ?>"<?php echo $council_meeting_grid->MeetingRef->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_council_meeting_MeetingRef" class="form-group council_meeting_MeetingRef">
<span<?php echo $council_meeting_grid->MeetingRef->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_meeting_grid->MeetingRef->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="council_meeting" data-field="x_MeetingRef" name="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingRef" id="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingRef" value="<?php echo HtmlEncode($council_meeting_grid->MeetingRef->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="council_meeting" data-field="x_MeetingRef" name="o<?php echo $council_meeting_grid->RowIndex ?>_MeetingRef" id="o<?php echo $council_meeting_grid->RowIndex ?>_MeetingRef" value="<?php echo HtmlEncode($council_meeting_grid->MeetingRef->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($council_meeting_grid->MeetingType->Visible) { // MeetingType ?>
		<td data-name="MeetingType">
<?php if (!$council_meeting->isConfirm()) { ?>
<span id="el$rowindex$_council_meeting_MeetingType" class="form-group council_meeting_MeetingType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="council_meeting" data-field="x_MeetingType" data-value-separator="<?php echo $council_meeting_grid->MeetingType->displayValueSeparatorAttribute() ?>" id="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingType" name="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingType"<?php echo $council_meeting_grid->MeetingType->editAttributes() ?>>
			<?php echo $council_meeting_grid->MeetingType->selectOptionListHtml("x{$council_meeting_grid->RowIndex}_MeetingType") ?>
		</select>
</div>
<?php echo $council_meeting_grid->MeetingType->Lookup->getParamTag($council_meeting_grid, "p_x" . $council_meeting_grid->RowIndex . "_MeetingType") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_council_meeting_MeetingType" class="form-group council_meeting_MeetingType">
<span<?php echo $council_meeting_grid->MeetingType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_meeting_grid->MeetingType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="council_meeting" data-field="x_MeetingType" name="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingType" id="x<?php echo $council_meeting_grid->RowIndex ?>_MeetingType" value="<?php echo HtmlEncode($council_meeting_grid->MeetingType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="council_meeting" data-field="x_MeetingType" name="o<?php echo $council_meeting_grid->RowIndex ?>_MeetingType" id="o<?php echo $council_meeting_grid->RowIndex ?>_MeetingType" value="<?php echo HtmlEncode($council_meeting_grid->MeetingType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($council_meeting_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if (!$council_meeting->isConfirm()) { ?>
<?php if ($council_meeting_grid->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_council_meeting_LACode" class="form-group council_meeting_LACode">
<span<?php echo $council_meeting_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_meeting_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $council_meeting_grid->RowIndex ?>_LACode" name="x<?php echo $council_meeting_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_meeting_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_council_meeting_LACode" class="form-group council_meeting_LACode">
<?php
$onchange = $council_meeting_grid->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$council_meeting_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $council_meeting_grid->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $council_meeting_grid->RowIndex ?>_LACode" id="sv_x<?php echo $council_meeting_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($council_meeting_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($council_meeting_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($council_meeting_grid->LACode->getPlaceHolder()) ?>"<?php echo $council_meeting_grid->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($council_meeting_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $council_meeting_grid->RowIndex ?>_LACode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($council_meeting_grid->LACode->ReadOnly || $council_meeting_grid->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="council_meeting" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $council_meeting_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $council_meeting_grid->RowIndex ?>_LACode" id="x<?php echo $council_meeting_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_meeting_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncil_meetinggrid"], function() {
	fcouncil_meetinggrid.createAutoSuggest({"id":"x<?php echo $council_meeting_grid->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $council_meeting_grid->LACode->Lookup->getParamTag($council_meeting_grid, "p_x" . $council_meeting_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_council_meeting_LACode" class="form-group council_meeting_LACode">
<span<?php echo $council_meeting_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_meeting_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="council_meeting" data-field="x_LACode" name="x<?php echo $council_meeting_grid->RowIndex ?>_LACode" id="x<?php echo $council_meeting_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_meeting_grid->LACode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="council_meeting" data-field="x_LACode" name="o<?php echo $council_meeting_grid->RowIndex ?>_LACode" id="o<?php echo $council_meeting_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_meeting_grid->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($council_meeting_grid->PlannedDate->Visible) { // PlannedDate ?>
		<td data-name="PlannedDate">
<?php if (!$council_meeting->isConfirm()) { ?>
<span id="el$rowindex$_council_meeting_PlannedDate" class="form-group council_meeting_PlannedDate">
<input type="text" data-table="council_meeting" data-field="x_PlannedDate" name="x<?php echo $council_meeting_grid->RowIndex ?>_PlannedDate" id="x<?php echo $council_meeting_grid->RowIndex ?>_PlannedDate" placeholder="<?php echo HtmlEncode($council_meeting_grid->PlannedDate->getPlaceHolder()) ?>" value="<?php echo $council_meeting_grid->PlannedDate->EditValue ?>"<?php echo $council_meeting_grid->PlannedDate->editAttributes() ?>>
<?php if (!$council_meeting_grid->PlannedDate->ReadOnly && !$council_meeting_grid->PlannedDate->Disabled && !isset($council_meeting_grid->PlannedDate->EditAttrs["readonly"]) && !isset($council_meeting_grid->PlannedDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcouncil_meetinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fcouncil_meetinggrid", "x<?php echo $council_meeting_grid->RowIndex ?>_PlannedDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_council_meeting_PlannedDate" class="form-group council_meeting_PlannedDate">
<span<?php echo $council_meeting_grid->PlannedDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_meeting_grid->PlannedDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="council_meeting" data-field="x_PlannedDate" name="x<?php echo $council_meeting_grid->RowIndex ?>_PlannedDate" id="x<?php echo $council_meeting_grid->RowIndex ?>_PlannedDate" value="<?php echo HtmlEncode($council_meeting_grid->PlannedDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="council_meeting" data-field="x_PlannedDate" name="o<?php echo $council_meeting_grid->RowIndex ?>_PlannedDate" id="o<?php echo $council_meeting_grid->RowIndex ?>_PlannedDate" value="<?php echo HtmlEncode($council_meeting_grid->PlannedDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($council_meeting_grid->ActualDate->Visible) { // ActualDate ?>
		<td data-name="ActualDate">
<?php if (!$council_meeting->isConfirm()) { ?>
<span id="el$rowindex$_council_meeting_ActualDate" class="form-group council_meeting_ActualDate">
<input type="text" data-table="council_meeting" data-field="x_ActualDate" name="x<?php echo $council_meeting_grid->RowIndex ?>_ActualDate" id="x<?php echo $council_meeting_grid->RowIndex ?>_ActualDate" placeholder="<?php echo HtmlEncode($council_meeting_grid->ActualDate->getPlaceHolder()) ?>" value="<?php echo $council_meeting_grid->ActualDate->EditValue ?>"<?php echo $council_meeting_grid->ActualDate->editAttributes() ?>>
<?php if (!$council_meeting_grid->ActualDate->ReadOnly && !$council_meeting_grid->ActualDate->Disabled && !isset($council_meeting_grid->ActualDate->EditAttrs["readonly"]) && !isset($council_meeting_grid->ActualDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcouncil_meetinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fcouncil_meetinggrid", "x<?php echo $council_meeting_grid->RowIndex ?>_ActualDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_council_meeting_ActualDate" class="form-group council_meeting_ActualDate">
<span<?php echo $council_meeting_grid->ActualDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_meeting_grid->ActualDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="council_meeting" data-field="x_ActualDate" name="x<?php echo $council_meeting_grid->RowIndex ?>_ActualDate" id="x<?php echo $council_meeting_grid->RowIndex ?>_ActualDate" value="<?php echo HtmlEncode($council_meeting_grid->ActualDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="council_meeting" data-field="x_ActualDate" name="o<?php echo $council_meeting_grid->RowIndex ?>_ActualDate" id="o<?php echo $council_meeting_grid->RowIndex ?>_ActualDate" value="<?php echo HtmlEncode($council_meeting_grid->ActualDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($council_meeting_grid->Attendance->Visible) { // Attendance ?>
		<td data-name="Attendance">
<?php if (!$council_meeting->isConfirm()) { ?>
<span id="el$rowindex$_council_meeting_Attendance" class="form-group council_meeting_Attendance">
<input type="text" data-table="council_meeting" data-field="x_Attendance" name="x<?php echo $council_meeting_grid->RowIndex ?>_Attendance" id="x<?php echo $council_meeting_grid->RowIndex ?>_Attendance" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($council_meeting_grid->Attendance->getPlaceHolder()) ?>" value="<?php echo $council_meeting_grid->Attendance->EditValue ?>"<?php echo $council_meeting_grid->Attendance->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_council_meeting_Attendance" class="form-group council_meeting_Attendance">
<span<?php echo $council_meeting_grid->Attendance->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_meeting_grid->Attendance->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="council_meeting" data-field="x_Attendance" name="x<?php echo $council_meeting_grid->RowIndex ?>_Attendance" id="x<?php echo $council_meeting_grid->RowIndex ?>_Attendance" value="<?php echo HtmlEncode($council_meeting_grid->Attendance->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="council_meeting" data-field="x_Attendance" name="o<?php echo $council_meeting_grid->RowIndex ?>_Attendance" id="o<?php echo $council_meeting_grid->RowIndex ?>_Attendance" value="<?php echo HtmlEncode($council_meeting_grid->Attendance->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($council_meeting_grid->ChairedBy->Visible) { // ChairedBy ?>
		<td data-name="ChairedBy">
<?php if (!$council_meeting->isConfirm()) { ?>
<span id="el$rowindex$_council_meeting_ChairedBy" class="form-group council_meeting_ChairedBy">
<input type="text" data-table="council_meeting" data-field="x_ChairedBy" name="x<?php echo $council_meeting_grid->RowIndex ?>_ChairedBy" id="x<?php echo $council_meeting_grid->RowIndex ?>_ChairedBy" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($council_meeting_grid->ChairedBy->getPlaceHolder()) ?>" value="<?php echo $council_meeting_grid->ChairedBy->EditValue ?>"<?php echo $council_meeting_grid->ChairedBy->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_council_meeting_ChairedBy" class="form-group council_meeting_ChairedBy">
<span<?php echo $council_meeting_grid->ChairedBy->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_meeting_grid->ChairedBy->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="council_meeting" data-field="x_ChairedBy" name="x<?php echo $council_meeting_grid->RowIndex ?>_ChairedBy" id="x<?php echo $council_meeting_grid->RowIndex ?>_ChairedBy" value="<?php echo HtmlEncode($council_meeting_grid->ChairedBy->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="council_meeting" data-field="x_ChairedBy" name="o<?php echo $council_meeting_grid->RowIndex ?>_ChairedBy" id="o<?php echo $council_meeting_grid->RowIndex ?>_ChairedBy" value="<?php echo HtmlEncode($council_meeting_grid->ChairedBy->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$council_meeting_grid->ListOptions->render("body", "right", $council_meeting_grid->RowIndex);
?>
<script>
loadjs.ready(["fcouncil_meetinggrid", "load"], function() {
	fcouncil_meetinggrid.updateLists(<?php echo $council_meeting_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($council_meeting->CurrentMode == "add" || $council_meeting->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $council_meeting_grid->FormKeyCountName ?>" id="<?php echo $council_meeting_grid->FormKeyCountName ?>" value="<?php echo $council_meeting_grid->KeyCount ?>">
<?php echo $council_meeting_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($council_meeting->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $council_meeting_grid->FormKeyCountName ?>" id="<?php echo $council_meeting_grid->FormKeyCountName ?>" value="<?php echo $council_meeting_grid->KeyCount ?>">
<?php echo $council_meeting_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($council_meeting->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcouncil_meetinggrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($council_meeting_grid->Recordset)
	$council_meeting_grid->Recordset->Close();
?>
<?php if ($council_meeting_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $council_meeting_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($council_meeting_grid->TotalRecords == 0 && !$council_meeting->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $council_meeting_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$council_meeting_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$council_meeting_grid->terminate();
?>