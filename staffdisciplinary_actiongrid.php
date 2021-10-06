<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($staffdisciplinary_action_grid))
	$staffdisciplinary_action_grid = new staffdisciplinary_action_grid();

// Run the page
$staffdisciplinary_action_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffdisciplinary_action_grid->Page_Render();
?>
<?php if (!$staffdisciplinary_action_grid->isExport()) { ?>
<script>
var fstaffdisciplinary_actiongrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fstaffdisciplinary_actiongrid = new ew.Form("fstaffdisciplinary_actiongrid", "grid");
	fstaffdisciplinary_actiongrid.formKeyCountName = '<?php echo $staffdisciplinary_action_grid->FormKeyCountName ?>';

	// Validate form
	fstaffdisciplinary_actiongrid.validate = function() {
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
			<?php if ($staffdisciplinary_action_grid->CaseNo->Required) { ?>
				elm = this.getElements("x" + infix + "_CaseNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_grid->CaseNo->caption(), $staffdisciplinary_action_grid->CaseNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_action_grid->OffenseCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OffenseCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_grid->OffenseCode->caption(), $staffdisciplinary_action_grid->OffenseCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OffenseCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_action_grid->OffenseCode->errorMessage()) ?>");
			<?php if ($staffdisciplinary_action_grid->ActionTaken->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionTaken");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_grid->ActionTaken->caption(), $staffdisciplinary_action_grid->ActionTaken->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_action_grid->ActionDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_grid->ActionDate->caption(), $staffdisciplinary_action_grid->ActionDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActionDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_action_grid->ActionDate->errorMessage()) ?>");
			<?php if ($staffdisciplinary_action_grid->FromDate->Required) { ?>
				elm = this.getElements("x" + infix + "_FromDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_grid->FromDate->caption(), $staffdisciplinary_action_grid->FromDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FromDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_action_grid->FromDate->errorMessage()) ?>");
			<?php if ($staffdisciplinary_action_grid->ToDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ToDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_grid->ToDate->caption(), $staffdisciplinary_action_grid->ToDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ToDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_action_grid->ToDate->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fstaffdisciplinary_actiongrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "OffenseCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActionTaken", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActionDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "FromDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ToDate", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fstaffdisciplinary_actiongrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffdisciplinary_actiongrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffdisciplinary_actiongrid.lists["x_ActionTaken"] = <?php echo $staffdisciplinary_action_grid->ActionTaken->Lookup->toClientList($staffdisciplinary_action_grid) ?>;
	fstaffdisciplinary_actiongrid.lists["x_ActionTaken"].options = <?php echo JsonEncode($staffdisciplinary_action_grid->ActionTaken->lookupOptions()) ?>;
	loadjs.done("fstaffdisciplinary_actiongrid");
});
</script>
<?php } ?>
<?php
$staffdisciplinary_action_grid->renderOtherOptions();
?>
<?php if ($staffdisciplinary_action_grid->TotalRecords > 0 || $staffdisciplinary_action->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($staffdisciplinary_action_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> staffdisciplinary_action">
<?php if ($staffdisciplinary_action_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $staffdisciplinary_action_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fstaffdisciplinary_actiongrid" class="ew-form ew-list-form form-inline">
<div id="gmp_staffdisciplinary_action" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_staffdisciplinary_actiongrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$staffdisciplinary_action->RowType = ROWTYPE_HEADER;

// Render list options
$staffdisciplinary_action_grid->renderListOptions();

// Render list options (header, left)
$staffdisciplinary_action_grid->ListOptions->render("header", "left");
?>
<?php if ($staffdisciplinary_action_grid->CaseNo->Visible) { // CaseNo ?>
	<?php if ($staffdisciplinary_action_grid->SortUrl($staffdisciplinary_action_grid->CaseNo) == "") { ?>
		<th data-name="CaseNo" class="<?php echo $staffdisciplinary_action_grid->CaseNo->headerCellClass() ?>"><div id="elh_staffdisciplinary_action_CaseNo" class="staffdisciplinary_action_CaseNo"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_action_grid->CaseNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CaseNo" class="<?php echo $staffdisciplinary_action_grid->CaseNo->headerCellClass() ?>"><div><div id="elh_staffdisciplinary_action_CaseNo" class="staffdisciplinary_action_CaseNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_action_grid->CaseNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_action_grid->CaseNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_action_grid->CaseNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_action_grid->OffenseCode->Visible) { // OffenseCode ?>
	<?php if ($staffdisciplinary_action_grid->SortUrl($staffdisciplinary_action_grid->OffenseCode) == "") { ?>
		<th data-name="OffenseCode" class="<?php echo $staffdisciplinary_action_grid->OffenseCode->headerCellClass() ?>"><div id="elh_staffdisciplinary_action_OffenseCode" class="staffdisciplinary_action_OffenseCode"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_action_grid->OffenseCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OffenseCode" class="<?php echo $staffdisciplinary_action_grid->OffenseCode->headerCellClass() ?>"><div><div id="elh_staffdisciplinary_action_OffenseCode" class="staffdisciplinary_action_OffenseCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_action_grid->OffenseCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_action_grid->OffenseCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_action_grid->OffenseCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_action_grid->ActionTaken->Visible) { // ActionTaken ?>
	<?php if ($staffdisciplinary_action_grid->SortUrl($staffdisciplinary_action_grid->ActionTaken) == "") { ?>
		<th data-name="ActionTaken" class="<?php echo $staffdisciplinary_action_grid->ActionTaken->headerCellClass() ?>"><div id="elh_staffdisciplinary_action_ActionTaken" class="staffdisciplinary_action_ActionTaken"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_action_grid->ActionTaken->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionTaken" class="<?php echo $staffdisciplinary_action_grid->ActionTaken->headerCellClass() ?>"><div><div id="elh_staffdisciplinary_action_ActionTaken" class="staffdisciplinary_action_ActionTaken">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_action_grid->ActionTaken->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_action_grid->ActionTaken->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_action_grid->ActionTaken->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_action_grid->ActionDate->Visible) { // ActionDate ?>
	<?php if ($staffdisciplinary_action_grid->SortUrl($staffdisciplinary_action_grid->ActionDate) == "") { ?>
		<th data-name="ActionDate" class="<?php echo $staffdisciplinary_action_grid->ActionDate->headerCellClass() ?>"><div id="elh_staffdisciplinary_action_ActionDate" class="staffdisciplinary_action_ActionDate"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_action_grid->ActionDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionDate" class="<?php echo $staffdisciplinary_action_grid->ActionDate->headerCellClass() ?>"><div><div id="elh_staffdisciplinary_action_ActionDate" class="staffdisciplinary_action_ActionDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_action_grid->ActionDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_action_grid->ActionDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_action_grid->ActionDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_action_grid->FromDate->Visible) { // FromDate ?>
	<?php if ($staffdisciplinary_action_grid->SortUrl($staffdisciplinary_action_grid->FromDate) == "") { ?>
		<th data-name="FromDate" class="<?php echo $staffdisciplinary_action_grid->FromDate->headerCellClass() ?>"><div id="elh_staffdisciplinary_action_FromDate" class="staffdisciplinary_action_FromDate"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_action_grid->FromDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FromDate" class="<?php echo $staffdisciplinary_action_grid->FromDate->headerCellClass() ?>"><div><div id="elh_staffdisciplinary_action_FromDate" class="staffdisciplinary_action_FromDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_action_grid->FromDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_action_grid->FromDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_action_grid->FromDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_action_grid->ToDate->Visible) { // ToDate ?>
	<?php if ($staffdisciplinary_action_grid->SortUrl($staffdisciplinary_action_grid->ToDate) == "") { ?>
		<th data-name="ToDate" class="<?php echo $staffdisciplinary_action_grid->ToDate->headerCellClass() ?>"><div id="elh_staffdisciplinary_action_ToDate" class="staffdisciplinary_action_ToDate"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_action_grid->ToDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ToDate" class="<?php echo $staffdisciplinary_action_grid->ToDate->headerCellClass() ?>"><div><div id="elh_staffdisciplinary_action_ToDate" class="staffdisciplinary_action_ToDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_action_grid->ToDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_action_grid->ToDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_action_grid->ToDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$staffdisciplinary_action_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$staffdisciplinary_action_grid->StartRecord = 1;
$staffdisciplinary_action_grid->StopRecord = $staffdisciplinary_action_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($staffdisciplinary_action->isConfirm() || $staffdisciplinary_action_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($staffdisciplinary_action_grid->FormKeyCountName) && ($staffdisciplinary_action_grid->isGridAdd() || $staffdisciplinary_action_grid->isGridEdit() || $staffdisciplinary_action->isConfirm())) {
		$staffdisciplinary_action_grid->KeyCount = $CurrentForm->getValue($staffdisciplinary_action_grid->FormKeyCountName);
		$staffdisciplinary_action_grid->StopRecord = $staffdisciplinary_action_grid->StartRecord + $staffdisciplinary_action_grid->KeyCount - 1;
	}
}
$staffdisciplinary_action_grid->RecordCount = $staffdisciplinary_action_grid->StartRecord - 1;
if ($staffdisciplinary_action_grid->Recordset && !$staffdisciplinary_action_grid->Recordset->EOF) {
	$staffdisciplinary_action_grid->Recordset->moveFirst();
	$selectLimit = $staffdisciplinary_action_grid->UseSelectLimit;
	if (!$selectLimit && $staffdisciplinary_action_grid->StartRecord > 1)
		$staffdisciplinary_action_grid->Recordset->move($staffdisciplinary_action_grid->StartRecord - 1);
} elseif (!$staffdisciplinary_action->AllowAddDeleteRow && $staffdisciplinary_action_grid->StopRecord == 0) {
	$staffdisciplinary_action_grid->StopRecord = $staffdisciplinary_action->GridAddRowCount;
}

// Initialize aggregate
$staffdisciplinary_action->RowType = ROWTYPE_AGGREGATEINIT;
$staffdisciplinary_action->resetAttributes();
$staffdisciplinary_action_grid->renderRow();
if ($staffdisciplinary_action_grid->isGridAdd())
	$staffdisciplinary_action_grid->RowIndex = 0;
if ($staffdisciplinary_action_grid->isGridEdit())
	$staffdisciplinary_action_grid->RowIndex = 0;
while ($staffdisciplinary_action_grid->RecordCount < $staffdisciplinary_action_grid->StopRecord) {
	$staffdisciplinary_action_grid->RecordCount++;
	if ($staffdisciplinary_action_grid->RecordCount >= $staffdisciplinary_action_grid->StartRecord) {
		$staffdisciplinary_action_grid->RowCount++;
		if ($staffdisciplinary_action_grid->isGridAdd() || $staffdisciplinary_action_grid->isGridEdit() || $staffdisciplinary_action->isConfirm()) {
			$staffdisciplinary_action_grid->RowIndex++;
			$CurrentForm->Index = $staffdisciplinary_action_grid->RowIndex;
			if ($CurrentForm->hasValue($staffdisciplinary_action_grid->FormActionName) && ($staffdisciplinary_action->isConfirm() || $staffdisciplinary_action_grid->EventCancelled))
				$staffdisciplinary_action_grid->RowAction = strval($CurrentForm->getValue($staffdisciplinary_action_grid->FormActionName));
			elseif ($staffdisciplinary_action_grid->isGridAdd())
				$staffdisciplinary_action_grid->RowAction = "insert";
			else
				$staffdisciplinary_action_grid->RowAction = "";
		}

		// Set up key count
		$staffdisciplinary_action_grid->KeyCount = $staffdisciplinary_action_grid->RowIndex;

		// Init row class and style
		$staffdisciplinary_action->resetAttributes();
		$staffdisciplinary_action->CssClass = "";
		if ($staffdisciplinary_action_grid->isGridAdd()) {
			if ($staffdisciplinary_action->CurrentMode == "copy") {
				$staffdisciplinary_action_grid->loadRowValues($staffdisciplinary_action_grid->Recordset); // Load row values
				$staffdisciplinary_action_grid->setRecordKey($staffdisciplinary_action_grid->RowOldKey, $staffdisciplinary_action_grid->Recordset); // Set old record key
			} else {
				$staffdisciplinary_action_grid->loadRowValues(); // Load default values
				$staffdisciplinary_action_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$staffdisciplinary_action_grid->loadRowValues($staffdisciplinary_action_grid->Recordset); // Load row values
		}
		$staffdisciplinary_action->RowType = ROWTYPE_VIEW; // Render view
		if ($staffdisciplinary_action_grid->isGridAdd()) // Grid add
			$staffdisciplinary_action->RowType = ROWTYPE_ADD; // Render add
		if ($staffdisciplinary_action_grid->isGridAdd() && $staffdisciplinary_action->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$staffdisciplinary_action_grid->restoreCurrentRowFormValues($staffdisciplinary_action_grid->RowIndex); // Restore form values
		if ($staffdisciplinary_action_grid->isGridEdit()) { // Grid edit
			if ($staffdisciplinary_action->EventCancelled)
				$staffdisciplinary_action_grid->restoreCurrentRowFormValues($staffdisciplinary_action_grid->RowIndex); // Restore form values
			if ($staffdisciplinary_action_grid->RowAction == "insert")
				$staffdisciplinary_action->RowType = ROWTYPE_ADD; // Render add
			else
				$staffdisciplinary_action->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($staffdisciplinary_action_grid->isGridEdit() && ($staffdisciplinary_action->RowType == ROWTYPE_EDIT || $staffdisciplinary_action->RowType == ROWTYPE_ADD) && $staffdisciplinary_action->EventCancelled) // Update failed
			$staffdisciplinary_action_grid->restoreCurrentRowFormValues($staffdisciplinary_action_grid->RowIndex); // Restore form values
		if ($staffdisciplinary_action->RowType == ROWTYPE_EDIT) // Edit row
			$staffdisciplinary_action_grid->EditRowCount++;
		if ($staffdisciplinary_action->isConfirm()) // Confirm row
			$staffdisciplinary_action_grid->restoreCurrentRowFormValues($staffdisciplinary_action_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$staffdisciplinary_action->RowAttrs->merge(["data-rowindex" => $staffdisciplinary_action_grid->RowCount, "id" => "r" . $staffdisciplinary_action_grid->RowCount . "_staffdisciplinary_action", "data-rowtype" => $staffdisciplinary_action->RowType]);

		// Render row
		$staffdisciplinary_action_grid->renderRow();

		// Render list options
		$staffdisciplinary_action_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($staffdisciplinary_action_grid->RowAction != "delete" && $staffdisciplinary_action_grid->RowAction != "insertdelete" && !($staffdisciplinary_action_grid->RowAction == "insert" && $staffdisciplinary_action->isConfirm() && $staffdisciplinary_action_grid->emptyRow())) {
?>
	<tr <?php echo $staffdisciplinary_action->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffdisciplinary_action_grid->ListOptions->render("body", "left", $staffdisciplinary_action_grid->RowCount);
?>
	<?php if ($staffdisciplinary_action_grid->CaseNo->Visible) { // CaseNo ?>
		<td data-name="CaseNo" <?php echo $staffdisciplinary_action_grid->CaseNo->cellAttributes() ?>>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_action_grid->RowCount ?>_staffdisciplinary_action_CaseNo" class="form-group"></span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_CaseNo" name="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_CaseNo" id="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->CaseNo->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_action_grid->RowCount ?>_staffdisciplinary_action_CaseNo" class="form-group">
<span<?php echo $staffdisciplinary_action_grid->CaseNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_action_grid->CaseNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_CaseNo" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_CaseNo" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->CaseNo->CurrentValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_action_grid->RowCount ?>_staffdisciplinary_action_CaseNo">
<span<?php echo $staffdisciplinary_action_grid->CaseNo->viewAttributes() ?>><?php echo $staffdisciplinary_action_grid->CaseNo->getViewValue() ?></span>
</span>
<?php if (!$staffdisciplinary_action->isConfirm()) { ?>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_CaseNo" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_CaseNo" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->CaseNo->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_CaseNo" name="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_CaseNo" id="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->CaseNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_CaseNo" name="fstaffdisciplinary_actiongrid$x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_CaseNo" id="fstaffdisciplinary_actiongrid$x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->CaseNo->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_CaseNo" name="fstaffdisciplinary_actiongrid$o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_CaseNo" id="fstaffdisciplinary_actiongrid$o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->CaseNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_EmployeeID" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_EmployeeID" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->EmployeeID->CurrentValue) ?>">
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_EmployeeID" name="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_EmployeeID" id="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_EDIT || $staffdisciplinary_action->CurrentMode == "edit") { ?>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_EmployeeID" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_EmployeeID" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->EmployeeID->CurrentValue) ?>">
<?php } ?>
	<?php if ($staffdisciplinary_action_grid->OffenseCode->Visible) { // OffenseCode ?>
		<td data-name="OffenseCode" <?php echo $staffdisciplinary_action_grid->OffenseCode->cellAttributes() ?>>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_action_grid->RowCount ?>_staffdisciplinary_action_OffenseCode" class="form-group">
<input type="text" data-table="staffdisciplinary_action" data-field="x_OffenseCode" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_OffenseCode" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_OffenseCode" size="30" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_grid->OffenseCode->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_grid->OffenseCode->EditValue ?>"<?php echo $staffdisciplinary_action_grid->OffenseCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_OffenseCode" name="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_OffenseCode" id="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->OffenseCode->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_action_grid->RowCount ?>_staffdisciplinary_action_OffenseCode" class="form-group">
<input type="text" data-table="staffdisciplinary_action" data-field="x_OffenseCode" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_OffenseCode" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_OffenseCode" size="30" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_grid->OffenseCode->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_grid->OffenseCode->EditValue ?>"<?php echo $staffdisciplinary_action_grid->OffenseCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_action_grid->RowCount ?>_staffdisciplinary_action_OffenseCode">
<span<?php echo $staffdisciplinary_action_grid->OffenseCode->viewAttributes() ?>><?php echo $staffdisciplinary_action_grid->OffenseCode->getViewValue() ?></span>
</span>
<?php if (!$staffdisciplinary_action->isConfirm()) { ?>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_OffenseCode" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_OffenseCode" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->OffenseCode->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_OffenseCode" name="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_OffenseCode" id="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->OffenseCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_OffenseCode" name="fstaffdisciplinary_actiongrid$x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_OffenseCode" id="fstaffdisciplinary_actiongrid$x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->OffenseCode->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_OffenseCode" name="fstaffdisciplinary_actiongrid$o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_OffenseCode" id="fstaffdisciplinary_actiongrid$o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->OffenseCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_action_grid->ActionTaken->Visible) { // ActionTaken ?>
		<td data-name="ActionTaken" <?php echo $staffdisciplinary_action_grid->ActionTaken->cellAttributes() ?>>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_action_grid->RowCount ?>_staffdisciplinary_action_ActionTaken" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffdisciplinary_action" data-field="x_ActionTaken" data-value-separator="<?php echo $staffdisciplinary_action_grid->ActionTaken->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionTaken" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionTaken"<?php echo $staffdisciplinary_action_grid->ActionTaken->editAttributes() ?>>
			<?php echo $staffdisciplinary_action_grid->ActionTaken->selectOptionListHtml("x{$staffdisciplinary_action_grid->RowIndex}_ActionTaken") ?>
		</select>
</div>
<?php echo $staffdisciplinary_action_grid->ActionTaken->Lookup->getParamTag($staffdisciplinary_action_grid, "p_x" . $staffdisciplinary_action_grid->RowIndex . "_ActionTaken") ?>
</span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ActionTaken" name="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionTaken" id="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionTaken" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->ActionTaken->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_action_grid->RowCount ?>_staffdisciplinary_action_ActionTaken" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffdisciplinary_action" data-field="x_ActionTaken" data-value-separator="<?php echo $staffdisciplinary_action_grid->ActionTaken->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionTaken" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionTaken"<?php echo $staffdisciplinary_action_grid->ActionTaken->editAttributes() ?>>
			<?php echo $staffdisciplinary_action_grid->ActionTaken->selectOptionListHtml("x{$staffdisciplinary_action_grid->RowIndex}_ActionTaken") ?>
		</select>
</div>
<?php echo $staffdisciplinary_action_grid->ActionTaken->Lookup->getParamTag($staffdisciplinary_action_grid, "p_x" . $staffdisciplinary_action_grid->RowIndex . "_ActionTaken") ?>
</span>
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_action_grid->RowCount ?>_staffdisciplinary_action_ActionTaken">
<span<?php echo $staffdisciplinary_action_grid->ActionTaken->viewAttributes() ?>><?php echo $staffdisciplinary_action_grid->ActionTaken->getViewValue() ?></span>
</span>
<?php if (!$staffdisciplinary_action->isConfirm()) { ?>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ActionTaken" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionTaken" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionTaken" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->ActionTaken->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ActionTaken" name="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionTaken" id="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionTaken" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->ActionTaken->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ActionTaken" name="fstaffdisciplinary_actiongrid$x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionTaken" id="fstaffdisciplinary_actiongrid$x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionTaken" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->ActionTaken->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ActionTaken" name="fstaffdisciplinary_actiongrid$o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionTaken" id="fstaffdisciplinary_actiongrid$o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionTaken" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->ActionTaken->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_action_grid->ActionDate->Visible) { // ActionDate ?>
		<td data-name="ActionDate" <?php echo $staffdisciplinary_action_grid->ActionDate->cellAttributes() ?>>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_action_grid->RowCount ?>_staffdisciplinary_action_ActionDate" class="form-group">
<input type="text" data-table="staffdisciplinary_action" data-field="x_ActionDate" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionDate" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_grid->ActionDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_grid->ActionDate->EditValue ?>"<?php echo $staffdisciplinary_action_grid->ActionDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_grid->ActionDate->ReadOnly && !$staffdisciplinary_action_grid->ActionDate->Disabled && !isset($staffdisciplinary_action_grid->ActionDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_grid->ActionDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actiongrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actiongrid", "x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ActionDate" name="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionDate" id="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionDate" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->ActionDate->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_action_grid->RowCount ?>_staffdisciplinary_action_ActionDate" class="form-group">
<input type="text" data-table="staffdisciplinary_action" data-field="x_ActionDate" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionDate" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_grid->ActionDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_grid->ActionDate->EditValue ?>"<?php echo $staffdisciplinary_action_grid->ActionDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_grid->ActionDate->ReadOnly && !$staffdisciplinary_action_grid->ActionDate->Disabled && !isset($staffdisciplinary_action_grid->ActionDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_grid->ActionDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actiongrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actiongrid", "x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_action_grid->RowCount ?>_staffdisciplinary_action_ActionDate">
<span<?php echo $staffdisciplinary_action_grid->ActionDate->viewAttributes() ?>><?php echo $staffdisciplinary_action_grid->ActionDate->getViewValue() ?></span>
</span>
<?php if (!$staffdisciplinary_action->isConfirm()) { ?>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ActionDate" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionDate" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionDate" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->ActionDate->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ActionDate" name="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionDate" id="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionDate" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->ActionDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ActionDate" name="fstaffdisciplinary_actiongrid$x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionDate" id="fstaffdisciplinary_actiongrid$x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionDate" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->ActionDate->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ActionDate" name="fstaffdisciplinary_actiongrid$o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionDate" id="fstaffdisciplinary_actiongrid$o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionDate" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->ActionDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_action_grid->FromDate->Visible) { // FromDate ?>
		<td data-name="FromDate" <?php echo $staffdisciplinary_action_grid->FromDate->cellAttributes() ?>>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_action_grid->RowCount ?>_staffdisciplinary_action_FromDate" class="form-group">
<input type="text" data-table="staffdisciplinary_action" data-field="x_FromDate" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_FromDate" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_FromDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_grid->FromDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_grid->FromDate->EditValue ?>"<?php echo $staffdisciplinary_action_grid->FromDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_grid->FromDate->ReadOnly && !$staffdisciplinary_action_grid->FromDate->Disabled && !isset($staffdisciplinary_action_grid->FromDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_grid->FromDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actiongrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actiongrid", "x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_FromDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_FromDate" name="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_FromDate" id="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_FromDate" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->FromDate->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_action_grid->RowCount ?>_staffdisciplinary_action_FromDate" class="form-group">
<input type="text" data-table="staffdisciplinary_action" data-field="x_FromDate" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_FromDate" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_FromDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_grid->FromDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_grid->FromDate->EditValue ?>"<?php echo $staffdisciplinary_action_grid->FromDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_grid->FromDate->ReadOnly && !$staffdisciplinary_action_grid->FromDate->Disabled && !isset($staffdisciplinary_action_grid->FromDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_grid->FromDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actiongrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actiongrid", "x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_FromDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_action_grid->RowCount ?>_staffdisciplinary_action_FromDate">
<span<?php echo $staffdisciplinary_action_grid->FromDate->viewAttributes() ?>><?php echo $staffdisciplinary_action_grid->FromDate->getViewValue() ?></span>
</span>
<?php if (!$staffdisciplinary_action->isConfirm()) { ?>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_FromDate" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_FromDate" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_FromDate" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->FromDate->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_FromDate" name="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_FromDate" id="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_FromDate" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->FromDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_FromDate" name="fstaffdisciplinary_actiongrid$x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_FromDate" id="fstaffdisciplinary_actiongrid$x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_FromDate" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->FromDate->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_FromDate" name="fstaffdisciplinary_actiongrid$o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_FromDate" id="fstaffdisciplinary_actiongrid$o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_FromDate" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->FromDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_action_grid->ToDate->Visible) { // ToDate ?>
		<td data-name="ToDate" <?php echo $staffdisciplinary_action_grid->ToDate->cellAttributes() ?>>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_action_grid->RowCount ?>_staffdisciplinary_action_ToDate" class="form-group">
<input type="text" data-table="staffdisciplinary_action" data-field="x_ToDate" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ToDate" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ToDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_grid->ToDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_grid->ToDate->EditValue ?>"<?php echo $staffdisciplinary_action_grid->ToDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_grid->ToDate->ReadOnly && !$staffdisciplinary_action_grid->ToDate->Disabled && !isset($staffdisciplinary_action_grid->ToDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_grid->ToDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actiongrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actiongrid", "x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ToDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ToDate" name="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ToDate" id="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ToDate" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->ToDate->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_action_grid->RowCount ?>_staffdisciplinary_action_ToDate" class="form-group">
<input type="text" data-table="staffdisciplinary_action" data-field="x_ToDate" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ToDate" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ToDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_grid->ToDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_grid->ToDate->EditValue ?>"<?php echo $staffdisciplinary_action_grid->ToDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_grid->ToDate->ReadOnly && !$staffdisciplinary_action_grid->ToDate->Disabled && !isset($staffdisciplinary_action_grid->ToDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_grid->ToDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actiongrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actiongrid", "x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ToDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_action_grid->RowCount ?>_staffdisciplinary_action_ToDate">
<span<?php echo $staffdisciplinary_action_grid->ToDate->viewAttributes() ?>><?php echo $staffdisciplinary_action_grid->ToDate->getViewValue() ?></span>
</span>
<?php if (!$staffdisciplinary_action->isConfirm()) { ?>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ToDate" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ToDate" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ToDate" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->ToDate->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ToDate" name="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ToDate" id="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ToDate" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->ToDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ToDate" name="fstaffdisciplinary_actiongrid$x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ToDate" id="fstaffdisciplinary_actiongrid$x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ToDate" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->ToDate->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ToDate" name="fstaffdisciplinary_actiongrid$o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ToDate" id="fstaffdisciplinary_actiongrid$o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ToDate" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->ToDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffdisciplinary_action_grid->ListOptions->render("body", "right", $staffdisciplinary_action_grid->RowCount);
?>
	</tr>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_ADD || $staffdisciplinary_action->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actiongrid", "load"], function() {
	fstaffdisciplinary_actiongrid.updateLists(<?php echo $staffdisciplinary_action_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$staffdisciplinary_action_grid->isGridAdd() || $staffdisciplinary_action->CurrentMode == "copy")
		if (!$staffdisciplinary_action_grid->Recordset->EOF)
			$staffdisciplinary_action_grid->Recordset->moveNext();
}
?>
<?php
	if ($staffdisciplinary_action->CurrentMode == "add" || $staffdisciplinary_action->CurrentMode == "copy" || $staffdisciplinary_action->CurrentMode == "edit") {
		$staffdisciplinary_action_grid->RowIndex = '$rowindex$';
		$staffdisciplinary_action_grid->loadRowValues();

		// Set row properties
		$staffdisciplinary_action->resetAttributes();
		$staffdisciplinary_action->RowAttrs->merge(["data-rowindex" => $staffdisciplinary_action_grid->RowIndex, "id" => "r0_staffdisciplinary_action", "data-rowtype" => ROWTYPE_ADD]);
		$staffdisciplinary_action->RowAttrs->appendClass("ew-template");
		$staffdisciplinary_action->RowType = ROWTYPE_ADD;

		// Render row
		$staffdisciplinary_action_grid->renderRow();

		// Render list options
		$staffdisciplinary_action_grid->renderListOptions();
		$staffdisciplinary_action_grid->StartRowCount = 0;
?>
	<tr <?php echo $staffdisciplinary_action->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffdisciplinary_action_grid->ListOptions->render("body", "left", $staffdisciplinary_action_grid->RowIndex);
?>
	<?php if ($staffdisciplinary_action_grid->CaseNo->Visible) { // CaseNo ?>
		<td data-name="CaseNo">
<?php if (!$staffdisciplinary_action->isConfirm()) { ?>
<span id="el$rowindex$_staffdisciplinary_action_CaseNo" class="form-group staffdisciplinary_action_CaseNo"></span>
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_action_CaseNo" class="form-group staffdisciplinary_action_CaseNo">
<span<?php echo $staffdisciplinary_action_grid->CaseNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_action_grid->CaseNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_CaseNo" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_CaseNo" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->CaseNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_CaseNo" name="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_CaseNo" id="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->CaseNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_action_grid->OffenseCode->Visible) { // OffenseCode ?>
		<td data-name="OffenseCode">
<?php if (!$staffdisciplinary_action->isConfirm()) { ?>
<span id="el$rowindex$_staffdisciplinary_action_OffenseCode" class="form-group staffdisciplinary_action_OffenseCode">
<input type="text" data-table="staffdisciplinary_action" data-field="x_OffenseCode" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_OffenseCode" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_OffenseCode" size="30" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_grid->OffenseCode->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_grid->OffenseCode->EditValue ?>"<?php echo $staffdisciplinary_action_grid->OffenseCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_action_OffenseCode" class="form-group staffdisciplinary_action_OffenseCode">
<span<?php echo $staffdisciplinary_action_grid->OffenseCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_action_grid->OffenseCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_OffenseCode" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_OffenseCode" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->OffenseCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_OffenseCode" name="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_OffenseCode" id="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->OffenseCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_action_grid->ActionTaken->Visible) { // ActionTaken ?>
		<td data-name="ActionTaken">
<?php if (!$staffdisciplinary_action->isConfirm()) { ?>
<span id="el$rowindex$_staffdisciplinary_action_ActionTaken" class="form-group staffdisciplinary_action_ActionTaken">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffdisciplinary_action" data-field="x_ActionTaken" data-value-separator="<?php echo $staffdisciplinary_action_grid->ActionTaken->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionTaken" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionTaken"<?php echo $staffdisciplinary_action_grid->ActionTaken->editAttributes() ?>>
			<?php echo $staffdisciplinary_action_grid->ActionTaken->selectOptionListHtml("x{$staffdisciplinary_action_grid->RowIndex}_ActionTaken") ?>
		</select>
</div>
<?php echo $staffdisciplinary_action_grid->ActionTaken->Lookup->getParamTag($staffdisciplinary_action_grid, "p_x" . $staffdisciplinary_action_grid->RowIndex . "_ActionTaken") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_action_ActionTaken" class="form-group staffdisciplinary_action_ActionTaken">
<span<?php echo $staffdisciplinary_action_grid->ActionTaken->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_action_grid->ActionTaken->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ActionTaken" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionTaken" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionTaken" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->ActionTaken->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ActionTaken" name="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionTaken" id="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionTaken" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->ActionTaken->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_action_grid->ActionDate->Visible) { // ActionDate ?>
		<td data-name="ActionDate">
<?php if (!$staffdisciplinary_action->isConfirm()) { ?>
<span id="el$rowindex$_staffdisciplinary_action_ActionDate" class="form-group staffdisciplinary_action_ActionDate">
<input type="text" data-table="staffdisciplinary_action" data-field="x_ActionDate" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionDate" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_grid->ActionDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_grid->ActionDate->EditValue ?>"<?php echo $staffdisciplinary_action_grid->ActionDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_grid->ActionDate->ReadOnly && !$staffdisciplinary_action_grid->ActionDate->Disabled && !isset($staffdisciplinary_action_grid->ActionDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_grid->ActionDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actiongrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actiongrid", "x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_action_ActionDate" class="form-group staffdisciplinary_action_ActionDate">
<span<?php echo $staffdisciplinary_action_grid->ActionDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_action_grid->ActionDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ActionDate" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionDate" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionDate" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->ActionDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ActionDate" name="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionDate" id="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ActionDate" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->ActionDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_action_grid->FromDate->Visible) { // FromDate ?>
		<td data-name="FromDate">
<?php if (!$staffdisciplinary_action->isConfirm()) { ?>
<span id="el$rowindex$_staffdisciplinary_action_FromDate" class="form-group staffdisciplinary_action_FromDate">
<input type="text" data-table="staffdisciplinary_action" data-field="x_FromDate" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_FromDate" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_FromDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_grid->FromDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_grid->FromDate->EditValue ?>"<?php echo $staffdisciplinary_action_grid->FromDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_grid->FromDate->ReadOnly && !$staffdisciplinary_action_grid->FromDate->Disabled && !isset($staffdisciplinary_action_grid->FromDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_grid->FromDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actiongrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actiongrid", "x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_FromDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_action_FromDate" class="form-group staffdisciplinary_action_FromDate">
<span<?php echo $staffdisciplinary_action_grid->FromDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_action_grid->FromDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_FromDate" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_FromDate" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_FromDate" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->FromDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_FromDate" name="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_FromDate" id="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_FromDate" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->FromDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_action_grid->ToDate->Visible) { // ToDate ?>
		<td data-name="ToDate">
<?php if (!$staffdisciplinary_action->isConfirm()) { ?>
<span id="el$rowindex$_staffdisciplinary_action_ToDate" class="form-group staffdisciplinary_action_ToDate">
<input type="text" data-table="staffdisciplinary_action" data-field="x_ToDate" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ToDate" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ToDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_grid->ToDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_grid->ToDate->EditValue ?>"<?php echo $staffdisciplinary_action_grid->ToDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_grid->ToDate->ReadOnly && !$staffdisciplinary_action_grid->ToDate->Disabled && !isset($staffdisciplinary_action_grid->ToDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_grid->ToDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actiongrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actiongrid", "x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ToDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_action_ToDate" class="form-group staffdisciplinary_action_ToDate">
<span<?php echo $staffdisciplinary_action_grid->ToDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_action_grid->ToDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ToDate" name="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ToDate" id="x<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ToDate" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->ToDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ToDate" name="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ToDate" id="o<?php echo $staffdisciplinary_action_grid->RowIndex ?>_ToDate" value="<?php echo HtmlEncode($staffdisciplinary_action_grid->ToDate->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffdisciplinary_action_grid->ListOptions->render("body", "right", $staffdisciplinary_action_grid->RowIndex);
?>
<script>
loadjs.ready(["fstaffdisciplinary_actiongrid", "load"], function() {
	fstaffdisciplinary_actiongrid.updateLists(<?php echo $staffdisciplinary_action_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($staffdisciplinary_action->CurrentMode == "add" || $staffdisciplinary_action->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $staffdisciplinary_action_grid->FormKeyCountName ?>" id="<?php echo $staffdisciplinary_action_grid->FormKeyCountName ?>" value="<?php echo $staffdisciplinary_action_grid->KeyCount ?>">
<?php echo $staffdisciplinary_action_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($staffdisciplinary_action->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $staffdisciplinary_action_grid->FormKeyCountName ?>" id="<?php echo $staffdisciplinary_action_grid->FormKeyCountName ?>" value="<?php echo $staffdisciplinary_action_grid->KeyCount ?>">
<?php echo $staffdisciplinary_action_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($staffdisciplinary_action->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fstaffdisciplinary_actiongrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($staffdisciplinary_action_grid->Recordset)
	$staffdisciplinary_action_grid->Recordset->Close();
?>
<?php if ($staffdisciplinary_action_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $staffdisciplinary_action_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($staffdisciplinary_action_grid->TotalRecords == 0 && !$staffdisciplinary_action->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $staffdisciplinary_action_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$staffdisciplinary_action_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$staffdisciplinary_action_grid->terminate();
?>