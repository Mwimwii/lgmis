<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($councillor_allowance_grid))
	$councillor_allowance_grid = new councillor_allowance_grid();

// Run the page
$councillor_allowance_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillor_allowance_grid->Page_Render();
?>
<?php if (!$councillor_allowance_grid->isExport()) { ?>
<script>
var fcouncillor_allowancegrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fcouncillor_allowancegrid = new ew.Form("fcouncillor_allowancegrid", "grid");
	fcouncillor_allowancegrid.formKeyCountName = '<?php echo $councillor_allowance_grid->FormKeyCountName ?>';

	// Validate form
	fcouncillor_allowancegrid.validate = function() {
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
			<?php if ($councillor_allowance_grid->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_allowance_grid->EmployeeID->caption(), $councillor_allowance_grid->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillor_allowance_grid->EmployeeID->errorMessage()) ?>");
			<?php if ($councillor_allowance_grid->AllowanceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AllowanceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_allowance_grid->AllowanceCode->caption(), $councillor_allowance_grid->AllowanceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_allowance_grid->AllowanceAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_AllowanceAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_allowance_grid->AllowanceAmount->caption(), $councillor_allowance_grid->AllowanceAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AllowanceAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillor_allowance_grid->AllowanceAmount->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fcouncillor_allowancegrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "EmployeeID", false)) return false;
		if (ew.valueChanged(fobj, infix, "AllowanceCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "AllowanceAmount", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fcouncillor_allowancegrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcouncillor_allowancegrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcouncillor_allowancegrid.lists["x_AllowanceCode"] = <?php echo $councillor_allowance_grid->AllowanceCode->Lookup->toClientList($councillor_allowance_grid) ?>;
	fcouncillor_allowancegrid.lists["x_AllowanceCode"].options = <?php echo JsonEncode($councillor_allowance_grid->AllowanceCode->lookupOptions()) ?>;
	loadjs.done("fcouncillor_allowancegrid");
});
</script>
<?php } ?>
<?php
$councillor_allowance_grid->renderOtherOptions();
?>
<?php if ($councillor_allowance_grid->TotalRecords > 0 || $councillor_allowance->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($councillor_allowance_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> councillor_allowance">
<?php if ($councillor_allowance_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $councillor_allowance_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fcouncillor_allowancegrid" class="ew-form ew-list-form form-inline">
<div id="gmp_councillor_allowance" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_councillor_allowancegrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$councillor_allowance->RowType = ROWTYPE_HEADER;

// Render list options
$councillor_allowance_grid->renderListOptions();

// Render list options (header, left)
$councillor_allowance_grid->ListOptions->render("header", "left");
?>
<?php if ($councillor_allowance_grid->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($councillor_allowance_grid->SortUrl($councillor_allowance_grid->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $councillor_allowance_grid->EmployeeID->headerCellClass() ?>"><div id="elh_councillor_allowance_EmployeeID" class="councillor_allowance_EmployeeID"><div class="ew-table-header-caption"><?php echo $councillor_allowance_grid->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $councillor_allowance_grid->EmployeeID->headerCellClass() ?>"><div><div id="elh_councillor_allowance_EmployeeID" class="councillor_allowance_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillor_allowance_grid->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillor_allowance_grid->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillor_allowance_grid->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillor_allowance_grid->AllowanceCode->Visible) { // AllowanceCode ?>
	<?php if ($councillor_allowance_grid->SortUrl($councillor_allowance_grid->AllowanceCode) == "") { ?>
		<th data-name="AllowanceCode" class="<?php echo $councillor_allowance_grid->AllowanceCode->headerCellClass() ?>"><div id="elh_councillor_allowance_AllowanceCode" class="councillor_allowance_AllowanceCode"><div class="ew-table-header-caption"><?php echo $councillor_allowance_grid->AllowanceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AllowanceCode" class="<?php echo $councillor_allowance_grid->AllowanceCode->headerCellClass() ?>"><div><div id="elh_councillor_allowance_AllowanceCode" class="councillor_allowance_AllowanceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillor_allowance_grid->AllowanceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillor_allowance_grid->AllowanceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillor_allowance_grid->AllowanceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillor_allowance_grid->AllowanceAmount->Visible) { // AllowanceAmount ?>
	<?php if ($councillor_allowance_grid->SortUrl($councillor_allowance_grid->AllowanceAmount) == "") { ?>
		<th data-name="AllowanceAmount" class="<?php echo $councillor_allowance_grid->AllowanceAmount->headerCellClass() ?>"><div id="elh_councillor_allowance_AllowanceAmount" class="councillor_allowance_AllowanceAmount"><div class="ew-table-header-caption"><?php echo $councillor_allowance_grid->AllowanceAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AllowanceAmount" class="<?php echo $councillor_allowance_grid->AllowanceAmount->headerCellClass() ?>"><div><div id="elh_councillor_allowance_AllowanceAmount" class="councillor_allowance_AllowanceAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillor_allowance_grid->AllowanceAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillor_allowance_grid->AllowanceAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillor_allowance_grid->AllowanceAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$councillor_allowance_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$councillor_allowance_grid->StartRecord = 1;
$councillor_allowance_grid->StopRecord = $councillor_allowance_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($councillor_allowance->isConfirm() || $councillor_allowance_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($councillor_allowance_grid->FormKeyCountName) && ($councillor_allowance_grid->isGridAdd() || $councillor_allowance_grid->isGridEdit() || $councillor_allowance->isConfirm())) {
		$councillor_allowance_grid->KeyCount = $CurrentForm->getValue($councillor_allowance_grid->FormKeyCountName);
		$councillor_allowance_grid->StopRecord = $councillor_allowance_grid->StartRecord + $councillor_allowance_grid->KeyCount - 1;
	}
}
$councillor_allowance_grid->RecordCount = $councillor_allowance_grid->StartRecord - 1;
if ($councillor_allowance_grid->Recordset && !$councillor_allowance_grid->Recordset->EOF) {
	$councillor_allowance_grid->Recordset->moveFirst();
	$selectLimit = $councillor_allowance_grid->UseSelectLimit;
	if (!$selectLimit && $councillor_allowance_grid->StartRecord > 1)
		$councillor_allowance_grid->Recordset->move($councillor_allowance_grid->StartRecord - 1);
} elseif (!$councillor_allowance->AllowAddDeleteRow && $councillor_allowance_grid->StopRecord == 0) {
	$councillor_allowance_grid->StopRecord = $councillor_allowance->GridAddRowCount;
}

// Initialize aggregate
$councillor_allowance->RowType = ROWTYPE_AGGREGATEINIT;
$councillor_allowance->resetAttributes();
$councillor_allowance_grid->renderRow();
if ($councillor_allowance_grid->isGridAdd())
	$councillor_allowance_grid->RowIndex = 0;
if ($councillor_allowance_grid->isGridEdit())
	$councillor_allowance_grid->RowIndex = 0;
while ($councillor_allowance_grid->RecordCount < $councillor_allowance_grid->StopRecord) {
	$councillor_allowance_grid->RecordCount++;
	if ($councillor_allowance_grid->RecordCount >= $councillor_allowance_grid->StartRecord) {
		$councillor_allowance_grid->RowCount++;
		if ($councillor_allowance_grid->isGridAdd() || $councillor_allowance_grid->isGridEdit() || $councillor_allowance->isConfirm()) {
			$councillor_allowance_grid->RowIndex++;
			$CurrentForm->Index = $councillor_allowance_grid->RowIndex;
			if ($CurrentForm->hasValue($councillor_allowance_grid->FormActionName) && ($councillor_allowance->isConfirm() || $councillor_allowance_grid->EventCancelled))
				$councillor_allowance_grid->RowAction = strval($CurrentForm->getValue($councillor_allowance_grid->FormActionName));
			elseif ($councillor_allowance_grid->isGridAdd())
				$councillor_allowance_grid->RowAction = "insert";
			else
				$councillor_allowance_grid->RowAction = "";
		}

		// Set up key count
		$councillor_allowance_grid->KeyCount = $councillor_allowance_grid->RowIndex;

		// Init row class and style
		$councillor_allowance->resetAttributes();
		$councillor_allowance->CssClass = "";
		if ($councillor_allowance_grid->isGridAdd()) {
			if ($councillor_allowance->CurrentMode == "copy") {
				$councillor_allowance_grid->loadRowValues($councillor_allowance_grid->Recordset); // Load row values
				$councillor_allowance_grid->setRecordKey($councillor_allowance_grid->RowOldKey, $councillor_allowance_grid->Recordset); // Set old record key
			} else {
				$councillor_allowance_grid->loadRowValues(); // Load default values
				$councillor_allowance_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$councillor_allowance_grid->loadRowValues($councillor_allowance_grid->Recordset); // Load row values
		}
		$councillor_allowance->RowType = ROWTYPE_VIEW; // Render view
		if ($councillor_allowance_grid->isGridAdd()) // Grid add
			$councillor_allowance->RowType = ROWTYPE_ADD; // Render add
		if ($councillor_allowance_grid->isGridAdd() && $councillor_allowance->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$councillor_allowance_grid->restoreCurrentRowFormValues($councillor_allowance_grid->RowIndex); // Restore form values
		if ($councillor_allowance_grid->isGridEdit()) { // Grid edit
			if ($councillor_allowance->EventCancelled)
				$councillor_allowance_grid->restoreCurrentRowFormValues($councillor_allowance_grid->RowIndex); // Restore form values
			if ($councillor_allowance_grid->RowAction == "insert")
				$councillor_allowance->RowType = ROWTYPE_ADD; // Render add
			else
				$councillor_allowance->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($councillor_allowance_grid->isGridEdit() && ($councillor_allowance->RowType == ROWTYPE_EDIT || $councillor_allowance->RowType == ROWTYPE_ADD) && $councillor_allowance->EventCancelled) // Update failed
			$councillor_allowance_grid->restoreCurrentRowFormValues($councillor_allowance_grid->RowIndex); // Restore form values
		if ($councillor_allowance->RowType == ROWTYPE_EDIT) // Edit row
			$councillor_allowance_grid->EditRowCount++;
		if ($councillor_allowance->isConfirm()) // Confirm row
			$councillor_allowance_grid->restoreCurrentRowFormValues($councillor_allowance_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$councillor_allowance->RowAttrs->merge(["data-rowindex" => $councillor_allowance_grid->RowCount, "id" => "r" . $councillor_allowance_grid->RowCount . "_councillor_allowance", "data-rowtype" => $councillor_allowance->RowType]);

		// Render row
		$councillor_allowance_grid->renderRow();

		// Render list options
		$councillor_allowance_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($councillor_allowance_grid->RowAction != "delete" && $councillor_allowance_grid->RowAction != "insertdelete" && !($councillor_allowance_grid->RowAction == "insert" && $councillor_allowance->isConfirm() && $councillor_allowance_grid->emptyRow())) {
?>
	<tr <?php echo $councillor_allowance->rowAttributes() ?>>
<?php

// Render list options (body, left)
$councillor_allowance_grid->ListOptions->render("body", "left", $councillor_allowance_grid->RowCount);
?>
	<?php if ($councillor_allowance_grid->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $councillor_allowance_grid->EmployeeID->cellAttributes() ?>>
<?php if ($councillor_allowance->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($councillor_allowance_grid->EmployeeID->getSessionValue() != "") { ?>
<span id="el<?php echo $councillor_allowance_grid->RowCount ?>_councillor_allowance_EmployeeID" class="form-group">
<span<?php echo $councillor_allowance_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillor_allowance_grid->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" name="x<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillor_allowance_grid->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $councillor_allowance_grid->RowCount ?>_councillor_allowance_EmployeeID" class="form-group">
<input type="text" data-table="councillor_allowance" data-field="x_EmployeeID" name="x<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" id="x<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($councillor_allowance_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $councillor_allowance_grid->EmployeeID->EditValue ?>"<?php echo $councillor_allowance_grid->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="councillor_allowance" data-field="x_EmployeeID" name="o<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" id="o<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillor_allowance_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($councillor_allowance->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($councillor_allowance_grid->EmployeeID->getSessionValue() != "") { ?>

<span id="el<?php echo $councillor_allowance_grid->RowCount ?>_councillor_allowance_EmployeeID" class="form-group">
<span<?php echo $councillor_allowance_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillor_allowance_grid->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" name="x<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillor_allowance_grid->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="councillor_allowance" data-field="x_EmployeeID" name="x<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" id="x<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($councillor_allowance_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $councillor_allowance_grid->EmployeeID->EditValue ?>"<?php echo $councillor_allowance_grid->EmployeeID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="councillor_allowance" data-field="x_EmployeeID" name="o<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" id="o<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillor_allowance_grid->EmployeeID->OldValue != null ? $councillor_allowance_grid->EmployeeID->OldValue : $councillor_allowance_grid->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php if ($councillor_allowance->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillor_allowance_grid->RowCount ?>_councillor_allowance_EmployeeID">
<span<?php echo $councillor_allowance_grid->EmployeeID->viewAttributes() ?>><?php echo $councillor_allowance_grid->EmployeeID->getViewValue() ?></span>
</span>
<?php if (!$councillor_allowance->isConfirm()) { ?>
<input type="hidden" data-table="councillor_allowance" data-field="x_EmployeeID" name="x<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" id="x<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillor_allowance_grid->EmployeeID->FormValue) ?>">
<input type="hidden" data-table="councillor_allowance" data-field="x_EmployeeID" name="o<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" id="o<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillor_allowance_grid->EmployeeID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="councillor_allowance" data-field="x_EmployeeID" name="fcouncillor_allowancegrid$x<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" id="fcouncillor_allowancegrid$x<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillor_allowance_grid->EmployeeID->FormValue) ?>">
<input type="hidden" data-table="councillor_allowance" data-field="x_EmployeeID" name="fcouncillor_allowancegrid$o<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" id="fcouncillor_allowancegrid$o<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillor_allowance_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillor_allowance_grid->AllowanceCode->Visible) { // AllowanceCode ?>
		<td data-name="AllowanceCode" <?php echo $councillor_allowance_grid->AllowanceCode->cellAttributes() ?>>
<?php if ($councillor_allowance->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillor_allowance_grid->RowCount ?>_councillor_allowance_AllowanceCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor_allowance" data-field="x_AllowanceCode" data-value-separator="<?php echo $councillor_allowance_grid->AllowanceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceCode" name="x<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceCode"<?php echo $councillor_allowance_grid->AllowanceCode->editAttributes() ?>>
			<?php echo $councillor_allowance_grid->AllowanceCode->selectOptionListHtml("x{$councillor_allowance_grid->RowIndex}_AllowanceCode") ?>
		</select>
</div>
<?php echo $councillor_allowance_grid->AllowanceCode->Lookup->getParamTag($councillor_allowance_grid, "p_x" . $councillor_allowance_grid->RowIndex . "_AllowanceCode") ?>
</span>
<input type="hidden" data-table="councillor_allowance" data-field="x_AllowanceCode" name="o<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceCode" id="o<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceCode" value="<?php echo HtmlEncode($councillor_allowance_grid->AllowanceCode->OldValue) ?>">
<?php } ?>
<?php if ($councillor_allowance->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor_allowance" data-field="x_AllowanceCode" data-value-separator="<?php echo $councillor_allowance_grid->AllowanceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceCode" name="x<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceCode"<?php echo $councillor_allowance_grid->AllowanceCode->editAttributes() ?>>
			<?php echo $councillor_allowance_grid->AllowanceCode->selectOptionListHtml("x{$councillor_allowance_grid->RowIndex}_AllowanceCode") ?>
		</select>
</div>
<?php echo $councillor_allowance_grid->AllowanceCode->Lookup->getParamTag($councillor_allowance_grid, "p_x" . $councillor_allowance_grid->RowIndex . "_AllowanceCode") ?>
<input type="hidden" data-table="councillor_allowance" data-field="x_AllowanceCode" name="o<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceCode" id="o<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceCode" value="<?php echo HtmlEncode($councillor_allowance_grid->AllowanceCode->OldValue != null ? $councillor_allowance_grid->AllowanceCode->OldValue : $councillor_allowance_grid->AllowanceCode->CurrentValue) ?>">
<?php } ?>
<?php if ($councillor_allowance->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillor_allowance_grid->RowCount ?>_councillor_allowance_AllowanceCode">
<span<?php echo $councillor_allowance_grid->AllowanceCode->viewAttributes() ?>><?php echo $councillor_allowance_grid->AllowanceCode->getViewValue() ?></span>
</span>
<?php if (!$councillor_allowance->isConfirm()) { ?>
<input type="hidden" data-table="councillor_allowance" data-field="x_AllowanceCode" name="x<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceCode" id="x<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceCode" value="<?php echo HtmlEncode($councillor_allowance_grid->AllowanceCode->FormValue) ?>">
<input type="hidden" data-table="councillor_allowance" data-field="x_AllowanceCode" name="o<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceCode" id="o<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceCode" value="<?php echo HtmlEncode($councillor_allowance_grid->AllowanceCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="councillor_allowance" data-field="x_AllowanceCode" name="fcouncillor_allowancegrid$x<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceCode" id="fcouncillor_allowancegrid$x<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceCode" value="<?php echo HtmlEncode($councillor_allowance_grid->AllowanceCode->FormValue) ?>">
<input type="hidden" data-table="councillor_allowance" data-field="x_AllowanceCode" name="fcouncillor_allowancegrid$o<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceCode" id="fcouncillor_allowancegrid$o<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceCode" value="<?php echo HtmlEncode($councillor_allowance_grid->AllowanceCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillor_allowance_grid->AllowanceAmount->Visible) { // AllowanceAmount ?>
		<td data-name="AllowanceAmount" <?php echo $councillor_allowance_grid->AllowanceAmount->cellAttributes() ?>>
<?php if ($councillor_allowance->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillor_allowance_grid->RowCount ?>_councillor_allowance_AllowanceAmount" class="form-group">
<input type="text" data-table="councillor_allowance" data-field="x_AllowanceAmount" name="x<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceAmount" id="x<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceAmount" size="30" placeholder="<?php echo HtmlEncode($councillor_allowance_grid->AllowanceAmount->getPlaceHolder()) ?>" value="<?php echo $councillor_allowance_grid->AllowanceAmount->EditValue ?>"<?php echo $councillor_allowance_grid->AllowanceAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillor_allowance" data-field="x_AllowanceAmount" name="o<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceAmount" id="o<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceAmount" value="<?php echo HtmlEncode($councillor_allowance_grid->AllowanceAmount->OldValue) ?>">
<?php } ?>
<?php if ($councillor_allowance->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="councillor_allowance" data-field="x_AllowanceAmount" name="x<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceAmount" id="x<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceAmount" size="30" placeholder="<?php echo HtmlEncode($councillor_allowance_grid->AllowanceAmount->getPlaceHolder()) ?>" value="<?php echo $councillor_allowance_grid->AllowanceAmount->EditValue ?>"<?php echo $councillor_allowance_grid->AllowanceAmount->editAttributes() ?>>
<input type="hidden" data-table="councillor_allowance" data-field="x_AllowanceAmount" name="o<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceAmount" id="o<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceAmount" value="<?php echo HtmlEncode($councillor_allowance_grid->AllowanceAmount->OldValue != null ? $councillor_allowance_grid->AllowanceAmount->OldValue : $councillor_allowance_grid->AllowanceAmount->CurrentValue) ?>">
<?php } ?>
<?php if ($councillor_allowance->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillor_allowance_grid->RowCount ?>_councillor_allowance_AllowanceAmount">
<span<?php echo $councillor_allowance_grid->AllowanceAmount->viewAttributes() ?>><?php echo $councillor_allowance_grid->AllowanceAmount->getViewValue() ?></span>
</span>
<?php if (!$councillor_allowance->isConfirm()) { ?>
<input type="hidden" data-table="councillor_allowance" data-field="x_AllowanceAmount" name="x<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceAmount" id="x<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceAmount" value="<?php echo HtmlEncode($councillor_allowance_grid->AllowanceAmount->FormValue) ?>">
<input type="hidden" data-table="councillor_allowance" data-field="x_AllowanceAmount" name="o<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceAmount" id="o<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceAmount" value="<?php echo HtmlEncode($councillor_allowance_grid->AllowanceAmount->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="councillor_allowance" data-field="x_AllowanceAmount" name="fcouncillor_allowancegrid$x<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceAmount" id="fcouncillor_allowancegrid$x<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceAmount" value="<?php echo HtmlEncode($councillor_allowance_grid->AllowanceAmount->FormValue) ?>">
<input type="hidden" data-table="councillor_allowance" data-field="x_AllowanceAmount" name="fcouncillor_allowancegrid$o<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceAmount" id="fcouncillor_allowancegrid$o<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceAmount" value="<?php echo HtmlEncode($councillor_allowance_grid->AllowanceAmount->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$councillor_allowance_grid->ListOptions->render("body", "right", $councillor_allowance_grid->RowCount);
?>
	</tr>
<?php if ($councillor_allowance->RowType == ROWTYPE_ADD || $councillor_allowance->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fcouncillor_allowancegrid", "load"], function() {
	fcouncillor_allowancegrid.updateLists(<?php echo $councillor_allowance_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$councillor_allowance_grid->isGridAdd() || $councillor_allowance->CurrentMode == "copy")
		if (!$councillor_allowance_grid->Recordset->EOF)
			$councillor_allowance_grid->Recordset->moveNext();
}
?>
<?php
	if ($councillor_allowance->CurrentMode == "add" || $councillor_allowance->CurrentMode == "copy" || $councillor_allowance->CurrentMode == "edit") {
		$councillor_allowance_grid->RowIndex = '$rowindex$';
		$councillor_allowance_grid->loadRowValues();

		// Set row properties
		$councillor_allowance->resetAttributes();
		$councillor_allowance->RowAttrs->merge(["data-rowindex" => $councillor_allowance_grid->RowIndex, "id" => "r0_councillor_allowance", "data-rowtype" => ROWTYPE_ADD]);
		$councillor_allowance->RowAttrs->appendClass("ew-template");
		$councillor_allowance->RowType = ROWTYPE_ADD;

		// Render row
		$councillor_allowance_grid->renderRow();

		// Render list options
		$councillor_allowance_grid->renderListOptions();
		$councillor_allowance_grid->StartRowCount = 0;
?>
	<tr <?php echo $councillor_allowance->rowAttributes() ?>>
<?php

// Render list options (body, left)
$councillor_allowance_grid->ListOptions->render("body", "left", $councillor_allowance_grid->RowIndex);
?>
	<?php if ($councillor_allowance_grid->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID">
<?php if (!$councillor_allowance->isConfirm()) { ?>
<?php if ($councillor_allowance_grid->EmployeeID->getSessionValue() != "") { ?>
<span id="el$rowindex$_councillor_allowance_EmployeeID" class="form-group councillor_allowance_EmployeeID">
<span<?php echo $councillor_allowance_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillor_allowance_grid->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" name="x<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillor_allowance_grid->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_councillor_allowance_EmployeeID" class="form-group councillor_allowance_EmployeeID">
<input type="text" data-table="councillor_allowance" data-field="x_EmployeeID" name="x<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" id="x<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($councillor_allowance_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $councillor_allowance_grid->EmployeeID->EditValue ?>"<?php echo $councillor_allowance_grid->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_councillor_allowance_EmployeeID" class="form-group councillor_allowance_EmployeeID">
<span<?php echo $councillor_allowance_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillor_allowance_grid->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="councillor_allowance" data-field="x_EmployeeID" name="x<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" id="x<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillor_allowance_grid->EmployeeID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="councillor_allowance" data-field="x_EmployeeID" name="o<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" id="o<?php echo $councillor_allowance_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillor_allowance_grid->EmployeeID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillor_allowance_grid->AllowanceCode->Visible) { // AllowanceCode ?>
		<td data-name="AllowanceCode">
<?php if (!$councillor_allowance->isConfirm()) { ?>
<span id="el$rowindex$_councillor_allowance_AllowanceCode" class="form-group councillor_allowance_AllowanceCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor_allowance" data-field="x_AllowanceCode" data-value-separator="<?php echo $councillor_allowance_grid->AllowanceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceCode" name="x<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceCode"<?php echo $councillor_allowance_grid->AllowanceCode->editAttributes() ?>>
			<?php echo $councillor_allowance_grid->AllowanceCode->selectOptionListHtml("x{$councillor_allowance_grid->RowIndex}_AllowanceCode") ?>
		</select>
</div>
<?php echo $councillor_allowance_grid->AllowanceCode->Lookup->getParamTag($councillor_allowance_grid, "p_x" . $councillor_allowance_grid->RowIndex . "_AllowanceCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_councillor_allowance_AllowanceCode" class="form-group councillor_allowance_AllowanceCode">
<span<?php echo $councillor_allowance_grid->AllowanceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillor_allowance_grid->AllowanceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="councillor_allowance" data-field="x_AllowanceCode" name="x<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceCode" id="x<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceCode" value="<?php echo HtmlEncode($councillor_allowance_grid->AllowanceCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="councillor_allowance" data-field="x_AllowanceCode" name="o<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceCode" id="o<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceCode" value="<?php echo HtmlEncode($councillor_allowance_grid->AllowanceCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillor_allowance_grid->AllowanceAmount->Visible) { // AllowanceAmount ?>
		<td data-name="AllowanceAmount">
<?php if (!$councillor_allowance->isConfirm()) { ?>
<span id="el$rowindex$_councillor_allowance_AllowanceAmount" class="form-group councillor_allowance_AllowanceAmount">
<input type="text" data-table="councillor_allowance" data-field="x_AllowanceAmount" name="x<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceAmount" id="x<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceAmount" size="30" placeholder="<?php echo HtmlEncode($councillor_allowance_grid->AllowanceAmount->getPlaceHolder()) ?>" value="<?php echo $councillor_allowance_grid->AllowanceAmount->EditValue ?>"<?php echo $councillor_allowance_grid->AllowanceAmount->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_councillor_allowance_AllowanceAmount" class="form-group councillor_allowance_AllowanceAmount">
<span<?php echo $councillor_allowance_grid->AllowanceAmount->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillor_allowance_grid->AllowanceAmount->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="councillor_allowance" data-field="x_AllowanceAmount" name="x<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceAmount" id="x<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceAmount" value="<?php echo HtmlEncode($councillor_allowance_grid->AllowanceAmount->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="councillor_allowance" data-field="x_AllowanceAmount" name="o<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceAmount" id="o<?php echo $councillor_allowance_grid->RowIndex ?>_AllowanceAmount" value="<?php echo HtmlEncode($councillor_allowance_grid->AllowanceAmount->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$councillor_allowance_grid->ListOptions->render("body", "right", $councillor_allowance_grid->RowIndex);
?>
<script>
loadjs.ready(["fcouncillor_allowancegrid", "load"], function() {
	fcouncillor_allowancegrid.updateLists(<?php echo $councillor_allowance_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($councillor_allowance->CurrentMode == "add" || $councillor_allowance->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $councillor_allowance_grid->FormKeyCountName ?>" id="<?php echo $councillor_allowance_grid->FormKeyCountName ?>" value="<?php echo $councillor_allowance_grid->KeyCount ?>">
<?php echo $councillor_allowance_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($councillor_allowance->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $councillor_allowance_grid->FormKeyCountName ?>" id="<?php echo $councillor_allowance_grid->FormKeyCountName ?>" value="<?php echo $councillor_allowance_grid->KeyCount ?>">
<?php echo $councillor_allowance_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($councillor_allowance->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcouncillor_allowancegrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($councillor_allowance_grid->Recordset)
	$councillor_allowance_grid->Recordset->Close();
?>
<?php if ($councillor_allowance_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $councillor_allowance_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($councillor_allowance_grid->TotalRecords == 0 && !$councillor_allowance->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $councillor_allowance_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$councillor_allowance_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$councillor_allowance_grid->terminate();
?>