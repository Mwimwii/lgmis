<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($job_grid))
	$job_grid = new job_grid();

// Run the page
$job_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$job_grid->Page_Render();
?>
<?php if (!$job_grid->isExport()) { ?>
<script>
var fjobgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fjobgrid = new ew.Form("fjobgrid", "grid");
	fjobgrid.formKeyCountName = '<?php echo $job_grid->FormKeyCountName ?>';

	// Validate form
	fjobgrid.validate = function() {
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
			<?php if ($job_grid->JobCode->Required) { ?>
				elm = this.getElements("x" + infix + "_JobCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $job_grid->JobCode->caption(), $job_grid->JobCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($job_grid->JobName->Required) { ?>
				elm = this.getElements("x" + infix + "_JobName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $job_grid->JobName->caption(), $job_grid->JobName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($job_grid->JobGroupCode->Required) { ?>
				elm = this.getElements("x" + infix + "_JobGroupCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $job_grid->JobGroupCode->caption(), $job_grid->JobGroupCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($job_grid->Division->Required) { ?>
				elm = this.getElements("x" + infix + "_Division");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $job_grid->Division->caption(), $job_grid->Division->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Division");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($job_grid->Division->errorMessage()) ?>");
			<?php if ($job_grid->CouncilType->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncilType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $job_grid->CouncilType->caption(), $job_grid->CouncilType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($job_grid->SalaryScale->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryScale");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $job_grid->SalaryScale->caption(), $job_grid->SalaryScale->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fjobgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "JobName", false)) return false;
		if (ew.valueChanged(fobj, infix, "JobGroupCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "Division", false)) return false;
		if (ew.valueChanged(fobj, infix, "CouncilType", false)) return false;
		if (ew.valueChanged(fobj, infix, "SalaryScale", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fjobgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fjobgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fjobgrid.lists["x_JobGroupCode"] = <?php echo $job_grid->JobGroupCode->Lookup->toClientList($job_grid) ?>;
	fjobgrid.lists["x_JobGroupCode"].options = <?php echo JsonEncode($job_grid->JobGroupCode->lookupOptions()) ?>;
	fjobgrid.lists["x_CouncilType"] = <?php echo $job_grid->CouncilType->Lookup->toClientList($job_grid) ?>;
	fjobgrid.lists["x_CouncilType"].options = <?php echo JsonEncode($job_grid->CouncilType->lookupOptions()) ?>;
	fjobgrid.lists["x_SalaryScale"] = <?php echo $job_grid->SalaryScale->Lookup->toClientList($job_grid) ?>;
	fjobgrid.lists["x_SalaryScale"].options = <?php echo JsonEncode($job_grid->SalaryScale->lookupOptions()) ?>;
	loadjs.done("fjobgrid");
});
</script>
<?php } ?>
<?php
$job_grid->renderOtherOptions();
?>
<?php if ($job_grid->TotalRecords > 0 || $job->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($job_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> job">
<?php if ($job_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $job_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fjobgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_job" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_jobgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$job->RowType = ROWTYPE_HEADER;

// Render list options
$job_grid->renderListOptions();

// Render list options (header, left)
$job_grid->ListOptions->render("header", "left");
?>
<?php if ($job_grid->JobCode->Visible) { // JobCode ?>
	<?php if ($job_grid->SortUrl($job_grid->JobCode) == "") { ?>
		<th data-name="JobCode" class="<?php echo $job_grid->JobCode->headerCellClass() ?>"><div id="elh_job_JobCode" class="job_JobCode"><div class="ew-table-header-caption"><?php echo $job_grid->JobCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobCode" class="<?php echo $job_grid->JobCode->headerCellClass() ?>"><div><div id="elh_job_JobCode" class="job_JobCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $job_grid->JobCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($job_grid->JobCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($job_grid->JobCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($job_grid->JobName->Visible) { // JobName ?>
	<?php if ($job_grid->SortUrl($job_grid->JobName) == "") { ?>
		<th data-name="JobName" class="<?php echo $job_grid->JobName->headerCellClass() ?>"><div id="elh_job_JobName" class="job_JobName"><div class="ew-table-header-caption"><?php echo $job_grid->JobName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobName" class="<?php echo $job_grid->JobName->headerCellClass() ?>"><div><div id="elh_job_JobName" class="job_JobName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $job_grid->JobName->caption() ?></span><span class="ew-table-header-sort"><?php if ($job_grid->JobName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($job_grid->JobName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($job_grid->JobGroupCode->Visible) { // JobGroupCode ?>
	<?php if ($job_grid->SortUrl($job_grid->JobGroupCode) == "") { ?>
		<th data-name="JobGroupCode" class="<?php echo $job_grid->JobGroupCode->headerCellClass() ?>"><div id="elh_job_JobGroupCode" class="job_JobGroupCode"><div class="ew-table-header-caption"><?php echo $job_grid->JobGroupCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobGroupCode" class="<?php echo $job_grid->JobGroupCode->headerCellClass() ?>"><div><div id="elh_job_JobGroupCode" class="job_JobGroupCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $job_grid->JobGroupCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($job_grid->JobGroupCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($job_grid->JobGroupCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($job_grid->Division->Visible) { // Division ?>
	<?php if ($job_grid->SortUrl($job_grid->Division) == "") { ?>
		<th data-name="Division" class="<?php echo $job_grid->Division->headerCellClass() ?>"><div id="elh_job_Division" class="job_Division"><div class="ew-table-header-caption"><?php echo $job_grid->Division->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Division" class="<?php echo $job_grid->Division->headerCellClass() ?>"><div><div id="elh_job_Division" class="job_Division">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $job_grid->Division->caption() ?></span><span class="ew-table-header-sort"><?php if ($job_grid->Division->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($job_grid->Division->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($job_grid->CouncilType->Visible) { // CouncilType ?>
	<?php if ($job_grid->SortUrl($job_grid->CouncilType) == "") { ?>
		<th data-name="CouncilType" class="<?php echo $job_grid->CouncilType->headerCellClass() ?>"><div id="elh_job_CouncilType" class="job_CouncilType"><div class="ew-table-header-caption"><?php echo $job_grid->CouncilType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CouncilType" class="<?php echo $job_grid->CouncilType->headerCellClass() ?>"><div><div id="elh_job_CouncilType" class="job_CouncilType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $job_grid->CouncilType->caption() ?></span><span class="ew-table-header-sort"><?php if ($job_grid->CouncilType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($job_grid->CouncilType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($job_grid->SalaryScale->Visible) { // SalaryScale ?>
	<?php if ($job_grid->SortUrl($job_grid->SalaryScale) == "") { ?>
		<th data-name="SalaryScale" class="<?php echo $job_grid->SalaryScale->headerCellClass() ?>"><div id="elh_job_SalaryScale" class="job_SalaryScale"><div class="ew-table-header-caption"><?php echo $job_grid->SalaryScale->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SalaryScale" class="<?php echo $job_grid->SalaryScale->headerCellClass() ?>"><div><div id="elh_job_SalaryScale" class="job_SalaryScale">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $job_grid->SalaryScale->caption() ?></span><span class="ew-table-header-sort"><?php if ($job_grid->SalaryScale->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($job_grid->SalaryScale->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$job_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$job_grid->StartRecord = 1;
$job_grid->StopRecord = $job_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($job->isConfirm() || $job_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($job_grid->FormKeyCountName) && ($job_grid->isGridAdd() || $job_grid->isGridEdit() || $job->isConfirm())) {
		$job_grid->KeyCount = $CurrentForm->getValue($job_grid->FormKeyCountName);
		$job_grid->StopRecord = $job_grid->StartRecord + $job_grid->KeyCount - 1;
	}
}
$job_grid->RecordCount = $job_grid->StartRecord - 1;
if ($job_grid->Recordset && !$job_grid->Recordset->EOF) {
	$job_grid->Recordset->moveFirst();
	$selectLimit = $job_grid->UseSelectLimit;
	if (!$selectLimit && $job_grid->StartRecord > 1)
		$job_grid->Recordset->move($job_grid->StartRecord - 1);
} elseif (!$job->AllowAddDeleteRow && $job_grid->StopRecord == 0) {
	$job_grid->StopRecord = $job->GridAddRowCount;
}

// Initialize aggregate
$job->RowType = ROWTYPE_AGGREGATEINIT;
$job->resetAttributes();
$job_grid->renderRow();
if ($job_grid->isGridAdd())
	$job_grid->RowIndex = 0;
if ($job_grid->isGridEdit())
	$job_grid->RowIndex = 0;
while ($job_grid->RecordCount < $job_grid->StopRecord) {
	$job_grid->RecordCount++;
	if ($job_grid->RecordCount >= $job_grid->StartRecord) {
		$job_grid->RowCount++;
		if ($job_grid->isGridAdd() || $job_grid->isGridEdit() || $job->isConfirm()) {
			$job_grid->RowIndex++;
			$CurrentForm->Index = $job_grid->RowIndex;
			if ($CurrentForm->hasValue($job_grid->FormActionName) && ($job->isConfirm() || $job_grid->EventCancelled))
				$job_grid->RowAction = strval($CurrentForm->getValue($job_grid->FormActionName));
			elseif ($job_grid->isGridAdd())
				$job_grid->RowAction = "insert";
			else
				$job_grid->RowAction = "";
		}

		// Set up key count
		$job_grid->KeyCount = $job_grid->RowIndex;

		// Init row class and style
		$job->resetAttributes();
		$job->CssClass = "";
		if ($job_grid->isGridAdd()) {
			if ($job->CurrentMode == "copy") {
				$job_grid->loadRowValues($job_grid->Recordset); // Load row values
				$job_grid->setRecordKey($job_grid->RowOldKey, $job_grid->Recordset); // Set old record key
			} else {
				$job_grid->loadRowValues(); // Load default values
				$job_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$job_grid->loadRowValues($job_grid->Recordset); // Load row values
		}
		$job->RowType = ROWTYPE_VIEW; // Render view
		if ($job_grid->isGridAdd()) // Grid add
			$job->RowType = ROWTYPE_ADD; // Render add
		if ($job_grid->isGridAdd() && $job->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$job_grid->restoreCurrentRowFormValues($job_grid->RowIndex); // Restore form values
		if ($job_grid->isGridEdit()) { // Grid edit
			if ($job->EventCancelled)
				$job_grid->restoreCurrentRowFormValues($job_grid->RowIndex); // Restore form values
			if ($job_grid->RowAction == "insert")
				$job->RowType = ROWTYPE_ADD; // Render add
			else
				$job->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($job_grid->isGridEdit() && ($job->RowType == ROWTYPE_EDIT || $job->RowType == ROWTYPE_ADD) && $job->EventCancelled) // Update failed
			$job_grid->restoreCurrentRowFormValues($job_grid->RowIndex); // Restore form values
		if ($job->RowType == ROWTYPE_EDIT) // Edit row
			$job_grid->EditRowCount++;
		if ($job->isConfirm()) // Confirm row
			$job_grid->restoreCurrentRowFormValues($job_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$job->RowAttrs->merge(["data-rowindex" => $job_grid->RowCount, "id" => "r" . $job_grid->RowCount . "_job", "data-rowtype" => $job->RowType]);

		// Render row
		$job_grid->renderRow();

		// Render list options
		$job_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($job_grid->RowAction != "delete" && $job_grid->RowAction != "insertdelete" && !($job_grid->RowAction == "insert" && $job->isConfirm() && $job_grid->emptyRow())) {
?>
	<tr <?php echo $job->rowAttributes() ?>>
<?php

// Render list options (body, left)
$job_grid->ListOptions->render("body", "left", $job_grid->RowCount);
?>
	<?php if ($job_grid->JobCode->Visible) { // JobCode ?>
		<td data-name="JobCode" <?php echo $job_grid->JobCode->cellAttributes() ?>>
<?php if ($job->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $job_grid->RowCount ?>_job_JobCode" class="form-group"></span>
<input type="hidden" data-table="job" data-field="x_JobCode" name="o<?php echo $job_grid->RowIndex ?>_JobCode" id="o<?php echo $job_grid->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($job_grid->JobCode->OldValue) ?>">
<?php } ?>
<?php if ($job->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $job_grid->RowCount ?>_job_JobCode" class="form-group">
<span<?php echo $job_grid->JobCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($job_grid->JobCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="job" data-field="x_JobCode" name="x<?php echo $job_grid->RowIndex ?>_JobCode" id="x<?php echo $job_grid->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($job_grid->JobCode->CurrentValue) ?>">
<?php } ?>
<?php if ($job->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $job_grid->RowCount ?>_job_JobCode">
<span<?php echo $job_grid->JobCode->viewAttributes() ?>><?php echo $job_grid->JobCode->getViewValue() ?></span>
</span>
<?php if (!$job->isConfirm()) { ?>
<input type="hidden" data-table="job" data-field="x_JobCode" name="x<?php echo $job_grid->RowIndex ?>_JobCode" id="x<?php echo $job_grid->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($job_grid->JobCode->FormValue) ?>">
<input type="hidden" data-table="job" data-field="x_JobCode" name="o<?php echo $job_grid->RowIndex ?>_JobCode" id="o<?php echo $job_grid->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($job_grid->JobCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="job" data-field="x_JobCode" name="fjobgrid$x<?php echo $job_grid->RowIndex ?>_JobCode" id="fjobgrid$x<?php echo $job_grid->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($job_grid->JobCode->FormValue) ?>">
<input type="hidden" data-table="job" data-field="x_JobCode" name="fjobgrid$o<?php echo $job_grid->RowIndex ?>_JobCode" id="fjobgrid$o<?php echo $job_grid->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($job_grid->JobCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($job_grid->JobName->Visible) { // JobName ?>
		<td data-name="JobName" <?php echo $job_grid->JobName->cellAttributes() ?>>
<?php if ($job->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $job_grid->RowCount ?>_job_JobName" class="form-group">
<input type="text" data-table="job" data-field="x_JobName" name="x<?php echo $job_grid->RowIndex ?>_JobName" id="x<?php echo $job_grid->RowIndex ?>_JobName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($job_grid->JobName->getPlaceHolder()) ?>" value="<?php echo $job_grid->JobName->EditValue ?>"<?php echo $job_grid->JobName->editAttributes() ?>>
</span>
<input type="hidden" data-table="job" data-field="x_JobName" name="o<?php echo $job_grid->RowIndex ?>_JobName" id="o<?php echo $job_grid->RowIndex ?>_JobName" value="<?php echo HtmlEncode($job_grid->JobName->OldValue) ?>">
<?php } ?>
<?php if ($job->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $job_grid->RowCount ?>_job_JobName" class="form-group">
<input type="text" data-table="job" data-field="x_JobName" name="x<?php echo $job_grid->RowIndex ?>_JobName" id="x<?php echo $job_grid->RowIndex ?>_JobName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($job_grid->JobName->getPlaceHolder()) ?>" value="<?php echo $job_grid->JobName->EditValue ?>"<?php echo $job_grid->JobName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($job->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $job_grid->RowCount ?>_job_JobName">
<span<?php echo $job_grid->JobName->viewAttributes() ?>><?php echo $job_grid->JobName->getViewValue() ?></span>
</span>
<?php if (!$job->isConfirm()) { ?>
<input type="hidden" data-table="job" data-field="x_JobName" name="x<?php echo $job_grid->RowIndex ?>_JobName" id="x<?php echo $job_grid->RowIndex ?>_JobName" value="<?php echo HtmlEncode($job_grid->JobName->FormValue) ?>">
<input type="hidden" data-table="job" data-field="x_JobName" name="o<?php echo $job_grid->RowIndex ?>_JobName" id="o<?php echo $job_grid->RowIndex ?>_JobName" value="<?php echo HtmlEncode($job_grid->JobName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="job" data-field="x_JobName" name="fjobgrid$x<?php echo $job_grid->RowIndex ?>_JobName" id="fjobgrid$x<?php echo $job_grid->RowIndex ?>_JobName" value="<?php echo HtmlEncode($job_grid->JobName->FormValue) ?>">
<input type="hidden" data-table="job" data-field="x_JobName" name="fjobgrid$o<?php echo $job_grid->RowIndex ?>_JobName" id="fjobgrid$o<?php echo $job_grid->RowIndex ?>_JobName" value="<?php echo HtmlEncode($job_grid->JobName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($job_grid->JobGroupCode->Visible) { // JobGroupCode ?>
		<td data-name="JobGroupCode" <?php echo $job_grid->JobGroupCode->cellAttributes() ?>>
<?php if ($job->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($job_grid->JobGroupCode->getSessionValue() != "") { ?>
<span id="el<?php echo $job_grid->RowCount ?>_job_JobGroupCode" class="form-group">
<span<?php echo $job_grid->JobGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($job_grid->JobGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $job_grid->RowIndex ?>_JobGroupCode" name="x<?php echo $job_grid->RowIndex ?>_JobGroupCode" value="<?php echo HtmlEncode($job_grid->JobGroupCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $job_grid->RowCount ?>_job_JobGroupCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="job" data-field="x_JobGroupCode" data-value-separator="<?php echo $job_grid->JobGroupCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $job_grid->RowIndex ?>_JobGroupCode" name="x<?php echo $job_grid->RowIndex ?>_JobGroupCode"<?php echo $job_grid->JobGroupCode->editAttributes() ?>>
			<?php echo $job_grid->JobGroupCode->selectOptionListHtml("x{$job_grid->RowIndex}_JobGroupCode") ?>
		</select>
</div>
<?php echo $job_grid->JobGroupCode->Lookup->getParamTag($job_grid, "p_x" . $job_grid->RowIndex . "_JobGroupCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="job" data-field="x_JobGroupCode" name="o<?php echo $job_grid->RowIndex ?>_JobGroupCode" id="o<?php echo $job_grid->RowIndex ?>_JobGroupCode" value="<?php echo HtmlEncode($job_grid->JobGroupCode->OldValue) ?>">
<?php } ?>
<?php if ($job->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($job_grid->JobGroupCode->getSessionValue() != "") { ?>
<span id="el<?php echo $job_grid->RowCount ?>_job_JobGroupCode" class="form-group">
<span<?php echo $job_grid->JobGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($job_grid->JobGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $job_grid->RowIndex ?>_JobGroupCode" name="x<?php echo $job_grid->RowIndex ?>_JobGroupCode" value="<?php echo HtmlEncode($job_grid->JobGroupCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $job_grid->RowCount ?>_job_JobGroupCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="job" data-field="x_JobGroupCode" data-value-separator="<?php echo $job_grid->JobGroupCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $job_grid->RowIndex ?>_JobGroupCode" name="x<?php echo $job_grid->RowIndex ?>_JobGroupCode"<?php echo $job_grid->JobGroupCode->editAttributes() ?>>
			<?php echo $job_grid->JobGroupCode->selectOptionListHtml("x{$job_grid->RowIndex}_JobGroupCode") ?>
		</select>
</div>
<?php echo $job_grid->JobGroupCode->Lookup->getParamTag($job_grid, "p_x" . $job_grid->RowIndex . "_JobGroupCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($job->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $job_grid->RowCount ?>_job_JobGroupCode">
<span<?php echo $job_grid->JobGroupCode->viewAttributes() ?>><?php echo $job_grid->JobGroupCode->getViewValue() ?></span>
</span>
<?php if (!$job->isConfirm()) { ?>
<input type="hidden" data-table="job" data-field="x_JobGroupCode" name="x<?php echo $job_grid->RowIndex ?>_JobGroupCode" id="x<?php echo $job_grid->RowIndex ?>_JobGroupCode" value="<?php echo HtmlEncode($job_grid->JobGroupCode->FormValue) ?>">
<input type="hidden" data-table="job" data-field="x_JobGroupCode" name="o<?php echo $job_grid->RowIndex ?>_JobGroupCode" id="o<?php echo $job_grid->RowIndex ?>_JobGroupCode" value="<?php echo HtmlEncode($job_grid->JobGroupCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="job" data-field="x_JobGroupCode" name="fjobgrid$x<?php echo $job_grid->RowIndex ?>_JobGroupCode" id="fjobgrid$x<?php echo $job_grid->RowIndex ?>_JobGroupCode" value="<?php echo HtmlEncode($job_grid->JobGroupCode->FormValue) ?>">
<input type="hidden" data-table="job" data-field="x_JobGroupCode" name="fjobgrid$o<?php echo $job_grid->RowIndex ?>_JobGroupCode" id="fjobgrid$o<?php echo $job_grid->RowIndex ?>_JobGroupCode" value="<?php echo HtmlEncode($job_grid->JobGroupCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($job_grid->Division->Visible) { // Division ?>
		<td data-name="Division" <?php echo $job_grid->Division->cellAttributes() ?>>
<?php if ($job->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($job_grid->Division->getSessionValue() != "") { ?>
<span id="el<?php echo $job_grid->RowCount ?>_job_Division" class="form-group">
<span<?php echo $job_grid->Division->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($job_grid->Division->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $job_grid->RowIndex ?>_Division" name="x<?php echo $job_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($job_grid->Division->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $job_grid->RowCount ?>_job_Division" class="form-group">
<input type="text" data-table="job" data-field="x_Division" name="x<?php echo $job_grid->RowIndex ?>_Division" id="x<?php echo $job_grid->RowIndex ?>_Division" size="30" placeholder="<?php echo HtmlEncode($job_grid->Division->getPlaceHolder()) ?>" value="<?php echo $job_grid->Division->EditValue ?>"<?php echo $job_grid->Division->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="job" data-field="x_Division" name="o<?php echo $job_grid->RowIndex ?>_Division" id="o<?php echo $job_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($job_grid->Division->OldValue) ?>">
<?php } ?>
<?php if ($job->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($job_grid->Division->getSessionValue() != "") { ?>
<span id="el<?php echo $job_grid->RowCount ?>_job_Division" class="form-group">
<span<?php echo $job_grid->Division->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($job_grid->Division->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $job_grid->RowIndex ?>_Division" name="x<?php echo $job_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($job_grid->Division->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $job_grid->RowCount ?>_job_Division" class="form-group">
<input type="text" data-table="job" data-field="x_Division" name="x<?php echo $job_grid->RowIndex ?>_Division" id="x<?php echo $job_grid->RowIndex ?>_Division" size="30" placeholder="<?php echo HtmlEncode($job_grid->Division->getPlaceHolder()) ?>" value="<?php echo $job_grid->Division->EditValue ?>"<?php echo $job_grid->Division->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($job->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $job_grid->RowCount ?>_job_Division">
<span<?php echo $job_grid->Division->viewAttributes() ?>><?php echo $job_grid->Division->getViewValue() ?></span>
</span>
<?php if (!$job->isConfirm()) { ?>
<input type="hidden" data-table="job" data-field="x_Division" name="x<?php echo $job_grid->RowIndex ?>_Division" id="x<?php echo $job_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($job_grid->Division->FormValue) ?>">
<input type="hidden" data-table="job" data-field="x_Division" name="o<?php echo $job_grid->RowIndex ?>_Division" id="o<?php echo $job_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($job_grid->Division->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="job" data-field="x_Division" name="fjobgrid$x<?php echo $job_grid->RowIndex ?>_Division" id="fjobgrid$x<?php echo $job_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($job_grid->Division->FormValue) ?>">
<input type="hidden" data-table="job" data-field="x_Division" name="fjobgrid$o<?php echo $job_grid->RowIndex ?>_Division" id="fjobgrid$o<?php echo $job_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($job_grid->Division->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($job_grid->CouncilType->Visible) { // CouncilType ?>
		<td data-name="CouncilType" <?php echo $job_grid->CouncilType->cellAttributes() ?>>
<?php if ($job->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $job_grid->RowCount ?>_job_CouncilType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="job" data-field="x_CouncilType" data-value-separator="<?php echo $job_grid->CouncilType->displayValueSeparatorAttribute() ?>" id="x<?php echo $job_grid->RowIndex ?>_CouncilType" name="x<?php echo $job_grid->RowIndex ?>_CouncilType"<?php echo $job_grid->CouncilType->editAttributes() ?>>
			<?php echo $job_grid->CouncilType->selectOptionListHtml("x{$job_grid->RowIndex}_CouncilType") ?>
		</select>
</div>
<?php echo $job_grid->CouncilType->Lookup->getParamTag($job_grid, "p_x" . $job_grid->RowIndex . "_CouncilType") ?>
</span>
<input type="hidden" data-table="job" data-field="x_CouncilType" name="o<?php echo $job_grid->RowIndex ?>_CouncilType" id="o<?php echo $job_grid->RowIndex ?>_CouncilType" value="<?php echo HtmlEncode($job_grid->CouncilType->OldValue) ?>">
<?php } ?>
<?php if ($job->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $job_grid->RowCount ?>_job_CouncilType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="job" data-field="x_CouncilType" data-value-separator="<?php echo $job_grid->CouncilType->displayValueSeparatorAttribute() ?>" id="x<?php echo $job_grid->RowIndex ?>_CouncilType" name="x<?php echo $job_grid->RowIndex ?>_CouncilType"<?php echo $job_grid->CouncilType->editAttributes() ?>>
			<?php echo $job_grid->CouncilType->selectOptionListHtml("x{$job_grid->RowIndex}_CouncilType") ?>
		</select>
</div>
<?php echo $job_grid->CouncilType->Lookup->getParamTag($job_grid, "p_x" . $job_grid->RowIndex . "_CouncilType") ?>
</span>
<?php } ?>
<?php if ($job->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $job_grid->RowCount ?>_job_CouncilType">
<span<?php echo $job_grid->CouncilType->viewAttributes() ?>><?php echo $job_grid->CouncilType->getViewValue() ?></span>
</span>
<?php if (!$job->isConfirm()) { ?>
<input type="hidden" data-table="job" data-field="x_CouncilType" name="x<?php echo $job_grid->RowIndex ?>_CouncilType" id="x<?php echo $job_grid->RowIndex ?>_CouncilType" value="<?php echo HtmlEncode($job_grid->CouncilType->FormValue) ?>">
<input type="hidden" data-table="job" data-field="x_CouncilType" name="o<?php echo $job_grid->RowIndex ?>_CouncilType" id="o<?php echo $job_grid->RowIndex ?>_CouncilType" value="<?php echo HtmlEncode($job_grid->CouncilType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="job" data-field="x_CouncilType" name="fjobgrid$x<?php echo $job_grid->RowIndex ?>_CouncilType" id="fjobgrid$x<?php echo $job_grid->RowIndex ?>_CouncilType" value="<?php echo HtmlEncode($job_grid->CouncilType->FormValue) ?>">
<input type="hidden" data-table="job" data-field="x_CouncilType" name="fjobgrid$o<?php echo $job_grid->RowIndex ?>_CouncilType" id="fjobgrid$o<?php echo $job_grid->RowIndex ?>_CouncilType" value="<?php echo HtmlEncode($job_grid->CouncilType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($job_grid->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale" <?php echo $job_grid->SalaryScale->cellAttributes() ?>>
<?php if ($job->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $job_grid->RowCount ?>_job_SalaryScale" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="job" data-field="x_SalaryScale" data-value-separator="<?php echo $job_grid->SalaryScale->displayValueSeparatorAttribute() ?>" id="x<?php echo $job_grid->RowIndex ?>_SalaryScale" name="x<?php echo $job_grid->RowIndex ?>_SalaryScale"<?php echo $job_grid->SalaryScale->editAttributes() ?>>
			<?php echo $job_grid->SalaryScale->selectOptionListHtml("x{$job_grid->RowIndex}_SalaryScale") ?>
		</select>
</div>
<?php echo $job_grid->SalaryScale->Lookup->getParamTag($job_grid, "p_x" . $job_grid->RowIndex . "_SalaryScale") ?>
</span>
<input type="hidden" data-table="job" data-field="x_SalaryScale" name="o<?php echo $job_grid->RowIndex ?>_SalaryScale" id="o<?php echo $job_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($job_grid->SalaryScale->OldValue) ?>">
<?php } ?>
<?php if ($job->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $job_grid->RowCount ?>_job_SalaryScale" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="job" data-field="x_SalaryScale" data-value-separator="<?php echo $job_grid->SalaryScale->displayValueSeparatorAttribute() ?>" id="x<?php echo $job_grid->RowIndex ?>_SalaryScale" name="x<?php echo $job_grid->RowIndex ?>_SalaryScale"<?php echo $job_grid->SalaryScale->editAttributes() ?>>
			<?php echo $job_grid->SalaryScale->selectOptionListHtml("x{$job_grid->RowIndex}_SalaryScale") ?>
		</select>
</div>
<?php echo $job_grid->SalaryScale->Lookup->getParamTag($job_grid, "p_x" . $job_grid->RowIndex . "_SalaryScale") ?>
</span>
<?php } ?>
<?php if ($job->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $job_grid->RowCount ?>_job_SalaryScale">
<span<?php echo $job_grid->SalaryScale->viewAttributes() ?>><?php echo $job_grid->SalaryScale->getViewValue() ?></span>
</span>
<?php if (!$job->isConfirm()) { ?>
<input type="hidden" data-table="job" data-field="x_SalaryScale" name="x<?php echo $job_grid->RowIndex ?>_SalaryScale" id="x<?php echo $job_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($job_grid->SalaryScale->FormValue) ?>">
<input type="hidden" data-table="job" data-field="x_SalaryScale" name="o<?php echo $job_grid->RowIndex ?>_SalaryScale" id="o<?php echo $job_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($job_grid->SalaryScale->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="job" data-field="x_SalaryScale" name="fjobgrid$x<?php echo $job_grid->RowIndex ?>_SalaryScale" id="fjobgrid$x<?php echo $job_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($job_grid->SalaryScale->FormValue) ?>">
<input type="hidden" data-table="job" data-field="x_SalaryScale" name="fjobgrid$o<?php echo $job_grid->RowIndex ?>_SalaryScale" id="fjobgrid$o<?php echo $job_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($job_grid->SalaryScale->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$job_grid->ListOptions->render("body", "right", $job_grid->RowCount);
?>
	</tr>
<?php if ($job->RowType == ROWTYPE_ADD || $job->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fjobgrid", "load"], function() {
	fjobgrid.updateLists(<?php echo $job_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$job_grid->isGridAdd() || $job->CurrentMode == "copy")
		if (!$job_grid->Recordset->EOF)
			$job_grid->Recordset->moveNext();
}
?>
<?php
	if ($job->CurrentMode == "add" || $job->CurrentMode == "copy" || $job->CurrentMode == "edit") {
		$job_grid->RowIndex = '$rowindex$';
		$job_grid->loadRowValues();

		// Set row properties
		$job->resetAttributes();
		$job->RowAttrs->merge(["data-rowindex" => $job_grid->RowIndex, "id" => "r0_job", "data-rowtype" => ROWTYPE_ADD]);
		$job->RowAttrs->appendClass("ew-template");
		$job->RowType = ROWTYPE_ADD;

		// Render row
		$job_grid->renderRow();

		// Render list options
		$job_grid->renderListOptions();
		$job_grid->StartRowCount = 0;
?>
	<tr <?php echo $job->rowAttributes() ?>>
<?php

// Render list options (body, left)
$job_grid->ListOptions->render("body", "left", $job_grid->RowIndex);
?>
	<?php if ($job_grid->JobCode->Visible) { // JobCode ?>
		<td data-name="JobCode">
<?php if (!$job->isConfirm()) { ?>
<span id="el$rowindex$_job_JobCode" class="form-group job_JobCode"></span>
<?php } else { ?>
<span id="el$rowindex$_job_JobCode" class="form-group job_JobCode">
<span<?php echo $job_grid->JobCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($job_grid->JobCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="job" data-field="x_JobCode" name="x<?php echo $job_grid->RowIndex ?>_JobCode" id="x<?php echo $job_grid->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($job_grid->JobCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="job" data-field="x_JobCode" name="o<?php echo $job_grid->RowIndex ?>_JobCode" id="o<?php echo $job_grid->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($job_grid->JobCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($job_grid->JobName->Visible) { // JobName ?>
		<td data-name="JobName">
<?php if (!$job->isConfirm()) { ?>
<span id="el$rowindex$_job_JobName" class="form-group job_JobName">
<input type="text" data-table="job" data-field="x_JobName" name="x<?php echo $job_grid->RowIndex ?>_JobName" id="x<?php echo $job_grid->RowIndex ?>_JobName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($job_grid->JobName->getPlaceHolder()) ?>" value="<?php echo $job_grid->JobName->EditValue ?>"<?php echo $job_grid->JobName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_job_JobName" class="form-group job_JobName">
<span<?php echo $job_grid->JobName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($job_grid->JobName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="job" data-field="x_JobName" name="x<?php echo $job_grid->RowIndex ?>_JobName" id="x<?php echo $job_grid->RowIndex ?>_JobName" value="<?php echo HtmlEncode($job_grid->JobName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="job" data-field="x_JobName" name="o<?php echo $job_grid->RowIndex ?>_JobName" id="o<?php echo $job_grid->RowIndex ?>_JobName" value="<?php echo HtmlEncode($job_grid->JobName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($job_grid->JobGroupCode->Visible) { // JobGroupCode ?>
		<td data-name="JobGroupCode">
<?php if (!$job->isConfirm()) { ?>
<?php if ($job_grid->JobGroupCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_job_JobGroupCode" class="form-group job_JobGroupCode">
<span<?php echo $job_grid->JobGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($job_grid->JobGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $job_grid->RowIndex ?>_JobGroupCode" name="x<?php echo $job_grid->RowIndex ?>_JobGroupCode" value="<?php echo HtmlEncode($job_grid->JobGroupCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_job_JobGroupCode" class="form-group job_JobGroupCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="job" data-field="x_JobGroupCode" data-value-separator="<?php echo $job_grid->JobGroupCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $job_grid->RowIndex ?>_JobGroupCode" name="x<?php echo $job_grid->RowIndex ?>_JobGroupCode"<?php echo $job_grid->JobGroupCode->editAttributes() ?>>
			<?php echo $job_grid->JobGroupCode->selectOptionListHtml("x{$job_grid->RowIndex}_JobGroupCode") ?>
		</select>
</div>
<?php echo $job_grid->JobGroupCode->Lookup->getParamTag($job_grid, "p_x" . $job_grid->RowIndex . "_JobGroupCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_job_JobGroupCode" class="form-group job_JobGroupCode">
<span<?php echo $job_grid->JobGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($job_grid->JobGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="job" data-field="x_JobGroupCode" name="x<?php echo $job_grid->RowIndex ?>_JobGroupCode" id="x<?php echo $job_grid->RowIndex ?>_JobGroupCode" value="<?php echo HtmlEncode($job_grid->JobGroupCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="job" data-field="x_JobGroupCode" name="o<?php echo $job_grid->RowIndex ?>_JobGroupCode" id="o<?php echo $job_grid->RowIndex ?>_JobGroupCode" value="<?php echo HtmlEncode($job_grid->JobGroupCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($job_grid->Division->Visible) { // Division ?>
		<td data-name="Division">
<?php if (!$job->isConfirm()) { ?>
<?php if ($job_grid->Division->getSessionValue() != "") { ?>
<span id="el$rowindex$_job_Division" class="form-group job_Division">
<span<?php echo $job_grid->Division->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($job_grid->Division->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $job_grid->RowIndex ?>_Division" name="x<?php echo $job_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($job_grid->Division->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_job_Division" class="form-group job_Division">
<input type="text" data-table="job" data-field="x_Division" name="x<?php echo $job_grid->RowIndex ?>_Division" id="x<?php echo $job_grid->RowIndex ?>_Division" size="30" placeholder="<?php echo HtmlEncode($job_grid->Division->getPlaceHolder()) ?>" value="<?php echo $job_grid->Division->EditValue ?>"<?php echo $job_grid->Division->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_job_Division" class="form-group job_Division">
<span<?php echo $job_grid->Division->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($job_grid->Division->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="job" data-field="x_Division" name="x<?php echo $job_grid->RowIndex ?>_Division" id="x<?php echo $job_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($job_grid->Division->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="job" data-field="x_Division" name="o<?php echo $job_grid->RowIndex ?>_Division" id="o<?php echo $job_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($job_grid->Division->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($job_grid->CouncilType->Visible) { // CouncilType ?>
		<td data-name="CouncilType">
<?php if (!$job->isConfirm()) { ?>
<span id="el$rowindex$_job_CouncilType" class="form-group job_CouncilType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="job" data-field="x_CouncilType" data-value-separator="<?php echo $job_grid->CouncilType->displayValueSeparatorAttribute() ?>" id="x<?php echo $job_grid->RowIndex ?>_CouncilType" name="x<?php echo $job_grid->RowIndex ?>_CouncilType"<?php echo $job_grid->CouncilType->editAttributes() ?>>
			<?php echo $job_grid->CouncilType->selectOptionListHtml("x{$job_grid->RowIndex}_CouncilType") ?>
		</select>
</div>
<?php echo $job_grid->CouncilType->Lookup->getParamTag($job_grid, "p_x" . $job_grid->RowIndex . "_CouncilType") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_job_CouncilType" class="form-group job_CouncilType">
<span<?php echo $job_grid->CouncilType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($job_grid->CouncilType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="job" data-field="x_CouncilType" name="x<?php echo $job_grid->RowIndex ?>_CouncilType" id="x<?php echo $job_grid->RowIndex ?>_CouncilType" value="<?php echo HtmlEncode($job_grid->CouncilType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="job" data-field="x_CouncilType" name="o<?php echo $job_grid->RowIndex ?>_CouncilType" id="o<?php echo $job_grid->RowIndex ?>_CouncilType" value="<?php echo HtmlEncode($job_grid->CouncilType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($job_grid->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale">
<?php if (!$job->isConfirm()) { ?>
<span id="el$rowindex$_job_SalaryScale" class="form-group job_SalaryScale">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="job" data-field="x_SalaryScale" data-value-separator="<?php echo $job_grid->SalaryScale->displayValueSeparatorAttribute() ?>" id="x<?php echo $job_grid->RowIndex ?>_SalaryScale" name="x<?php echo $job_grid->RowIndex ?>_SalaryScale"<?php echo $job_grid->SalaryScale->editAttributes() ?>>
			<?php echo $job_grid->SalaryScale->selectOptionListHtml("x{$job_grid->RowIndex}_SalaryScale") ?>
		</select>
</div>
<?php echo $job_grid->SalaryScale->Lookup->getParamTag($job_grid, "p_x" . $job_grid->RowIndex . "_SalaryScale") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_job_SalaryScale" class="form-group job_SalaryScale">
<span<?php echo $job_grid->SalaryScale->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($job_grid->SalaryScale->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="job" data-field="x_SalaryScale" name="x<?php echo $job_grid->RowIndex ?>_SalaryScale" id="x<?php echo $job_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($job_grid->SalaryScale->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="job" data-field="x_SalaryScale" name="o<?php echo $job_grid->RowIndex ?>_SalaryScale" id="o<?php echo $job_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($job_grid->SalaryScale->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$job_grid->ListOptions->render("body", "right", $job_grid->RowIndex);
?>
<script>
loadjs.ready(["fjobgrid", "load"], function() {
	fjobgrid.updateLists(<?php echo $job_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($job->CurrentMode == "add" || $job->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $job_grid->FormKeyCountName ?>" id="<?php echo $job_grid->FormKeyCountName ?>" value="<?php echo $job_grid->KeyCount ?>">
<?php echo $job_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($job->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $job_grid->FormKeyCountName ?>" id="<?php echo $job_grid->FormKeyCountName ?>" value="<?php echo $job_grid->KeyCount ?>">
<?php echo $job_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($job->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fjobgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($job_grid->Recordset)
	$job_grid->Recordset->Close();
?>
<?php if ($job_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $job_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($job_grid->TotalRecords == 0 && !$job->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $job_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$job_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$job_grid->terminate();
?>