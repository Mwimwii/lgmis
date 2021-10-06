<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($monthly_run_grid))
	$monthly_run_grid = new monthly_run_grid();

// Run the page
$monthly_run_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$monthly_run_grid->Page_Render();
?>
<?php if (!$monthly_run_grid->isExport()) { ?>
<script>
var fmonthly_rungrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fmonthly_rungrid = new ew.Form("fmonthly_rungrid", "grid");
	fmonthly_rungrid.formKeyCountName = '<?php echo $monthly_run_grid->FormKeyCountName ?>';

	// Validate form
	fmonthly_rungrid.validate = function() {
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
			<?php if ($monthly_run_grid->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $monthly_run_grid->LACode->caption(), $monthly_run_grid->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($monthly_run_grid->PeriodCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $monthly_run_grid->PeriodCode->caption(), $monthly_run_grid->PeriodCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($monthly_run_grid->RunDate->Required) { ?>
				elm = this.getElements("x" + infix + "_RunDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $monthly_run_grid->RunDate->caption(), $monthly_run_grid->RunDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RunDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($monthly_run_grid->RunDate->errorMessage()) ?>");
			<?php if ($monthly_run_grid->Description->Required) { ?>
				elm = this.getElements("x" + infix + "_Description");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $monthly_run_grid->Description->caption(), $monthly_run_grid->Description->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($monthly_run_grid->Year->Required) { ?>
				elm = this.getElements("x" + infix + "_Year");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $monthly_run_grid->Year->caption(), $monthly_run_grid->Year->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($monthly_run_grid->RunMonth->Required) { ?>
				elm = this.getElements("x" + infix + "_RunMonth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $monthly_run_grid->RunMonth->caption(), $monthly_run_grid->RunMonth->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($monthly_run_grid->PayrollCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $monthly_run_grid->PayrollCode->caption(), $monthly_run_grid->PayrollCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($monthly_run_grid->PayrollCode->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fmonthly_rungrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "PeriodCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "RunDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "Description", false)) return false;
		if (ew.valueChanged(fobj, infix, "Year", false)) return false;
		if (ew.valueChanged(fobj, infix, "RunMonth", false)) return false;
		if (ew.valueChanged(fobj, infix, "PayrollCode", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fmonthly_rungrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmonthly_rungrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmonthly_rungrid.lists["x_LACode"] = <?php echo $monthly_run_grid->LACode->Lookup->toClientList($monthly_run_grid) ?>;
	fmonthly_rungrid.lists["x_LACode"].options = <?php echo JsonEncode($monthly_run_grid->LACode->lookupOptions()) ?>;
	fmonthly_rungrid.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmonthly_rungrid.lists["x_PeriodCode"] = <?php echo $monthly_run_grid->PeriodCode->Lookup->toClientList($monthly_run_grid) ?>;
	fmonthly_rungrid.lists["x_PeriodCode"].options = <?php echo JsonEncode($monthly_run_grid->PeriodCode->lookupOptions()) ?>;
	fmonthly_rungrid.lists["x_Year"] = <?php echo $monthly_run_grid->Year->Lookup->toClientList($monthly_run_grid) ?>;
	fmonthly_rungrid.lists["x_Year"].options = <?php echo JsonEncode($monthly_run_grid->Year->lookupOptions()) ?>;
	fmonthly_rungrid.lists["x_RunMonth"] = <?php echo $monthly_run_grid->RunMonth->Lookup->toClientList($monthly_run_grid) ?>;
	fmonthly_rungrid.lists["x_RunMonth"].options = <?php echo JsonEncode($monthly_run_grid->RunMonth->lookupOptions()) ?>;
	loadjs.done("fmonthly_rungrid");
});
</script>
<?php } ?>
<?php
$monthly_run_grid->renderOtherOptions();
?>
<?php if ($monthly_run_grid->TotalRecords > 0 || $monthly_run->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($monthly_run_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> monthly_run">
<?php if ($monthly_run_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $monthly_run_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fmonthly_rungrid" class="ew-form ew-list-form form-inline">
<div id="gmp_monthly_run" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_monthly_rungrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$monthly_run->RowType = ROWTYPE_HEADER;

// Render list options
$monthly_run_grid->renderListOptions();

// Render list options (header, left)
$monthly_run_grid->ListOptions->render("header", "left");
?>
<?php if ($monthly_run_grid->LACode->Visible) { // LACode ?>
	<?php if ($monthly_run_grid->SortUrl($monthly_run_grid->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $monthly_run_grid->LACode->headerCellClass() ?>"><div id="elh_monthly_run_LACode" class="monthly_run_LACode"><div class="ew-table-header-caption"><?php echo $monthly_run_grid->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $monthly_run_grid->LACode->headerCellClass() ?>"><div><div id="elh_monthly_run_LACode" class="monthly_run_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_run_grid->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($monthly_run_grid->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_run_grid->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_run_grid->PeriodCode->Visible) { // PeriodCode ?>
	<?php if ($monthly_run_grid->SortUrl($monthly_run_grid->PeriodCode) == "") { ?>
		<th data-name="PeriodCode" class="<?php echo $monthly_run_grid->PeriodCode->headerCellClass() ?>"><div id="elh_monthly_run_PeriodCode" class="monthly_run_PeriodCode"><div class="ew-table-header-caption"><?php echo $monthly_run_grid->PeriodCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodCode" class="<?php echo $monthly_run_grid->PeriodCode->headerCellClass() ?>"><div><div id="elh_monthly_run_PeriodCode" class="monthly_run_PeriodCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_run_grid->PeriodCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($monthly_run_grid->PeriodCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_run_grid->PeriodCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_run_grid->RunDate->Visible) { // RunDate ?>
	<?php if ($monthly_run_grid->SortUrl($monthly_run_grid->RunDate) == "") { ?>
		<th data-name="RunDate" class="<?php echo $monthly_run_grid->RunDate->headerCellClass() ?>"><div id="elh_monthly_run_RunDate" class="monthly_run_RunDate"><div class="ew-table-header-caption"><?php echo $monthly_run_grid->RunDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RunDate" class="<?php echo $monthly_run_grid->RunDate->headerCellClass() ?>"><div><div id="elh_monthly_run_RunDate" class="monthly_run_RunDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_run_grid->RunDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($monthly_run_grid->RunDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_run_grid->RunDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_run_grid->Description->Visible) { // Description ?>
	<?php if ($monthly_run_grid->SortUrl($monthly_run_grid->Description) == "") { ?>
		<th data-name="Description" class="<?php echo $monthly_run_grid->Description->headerCellClass() ?>"><div id="elh_monthly_run_Description" class="monthly_run_Description"><div class="ew-table-header-caption"><?php echo $monthly_run_grid->Description->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Description" class="<?php echo $monthly_run_grid->Description->headerCellClass() ?>"><div><div id="elh_monthly_run_Description" class="monthly_run_Description">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_run_grid->Description->caption() ?></span><span class="ew-table-header-sort"><?php if ($monthly_run_grid->Description->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_run_grid->Description->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_run_grid->Year->Visible) { // Year ?>
	<?php if ($monthly_run_grid->SortUrl($monthly_run_grid->Year) == "") { ?>
		<th data-name="Year" class="<?php echo $monthly_run_grid->Year->headerCellClass() ?>"><div id="elh_monthly_run_Year" class="monthly_run_Year"><div class="ew-table-header-caption"><?php echo $monthly_run_grid->Year->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Year" class="<?php echo $monthly_run_grid->Year->headerCellClass() ?>"><div><div id="elh_monthly_run_Year" class="monthly_run_Year">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_run_grid->Year->caption() ?></span><span class="ew-table-header-sort"><?php if ($monthly_run_grid->Year->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_run_grid->Year->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_run_grid->RunMonth->Visible) { // RunMonth ?>
	<?php if ($monthly_run_grid->SortUrl($monthly_run_grid->RunMonth) == "") { ?>
		<th data-name="RunMonth" class="<?php echo $monthly_run_grid->RunMonth->headerCellClass() ?>"><div id="elh_monthly_run_RunMonth" class="monthly_run_RunMonth"><div class="ew-table-header-caption"><?php echo $monthly_run_grid->RunMonth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RunMonth" class="<?php echo $monthly_run_grid->RunMonth->headerCellClass() ?>"><div><div id="elh_monthly_run_RunMonth" class="monthly_run_RunMonth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_run_grid->RunMonth->caption() ?></span><span class="ew-table-header-sort"><?php if ($monthly_run_grid->RunMonth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_run_grid->RunMonth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_run_grid->PayrollCode->Visible) { // PayrollCode ?>
	<?php if ($monthly_run_grid->SortUrl($monthly_run_grid->PayrollCode) == "") { ?>
		<th data-name="PayrollCode" class="<?php echo $monthly_run_grid->PayrollCode->headerCellClass() ?>"><div id="elh_monthly_run_PayrollCode" class="monthly_run_PayrollCode"><div class="ew-table-header-caption"><?php echo $monthly_run_grid->PayrollCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollCode" class="<?php echo $monthly_run_grid->PayrollCode->headerCellClass() ?>"><div><div id="elh_monthly_run_PayrollCode" class="monthly_run_PayrollCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_run_grid->PayrollCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($monthly_run_grid->PayrollCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_run_grid->PayrollCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$monthly_run_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$monthly_run_grid->StartRecord = 1;
$monthly_run_grid->StopRecord = $monthly_run_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($monthly_run->isConfirm() || $monthly_run_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($monthly_run_grid->FormKeyCountName) && ($monthly_run_grid->isGridAdd() || $monthly_run_grid->isGridEdit() || $monthly_run->isConfirm())) {
		$monthly_run_grid->KeyCount = $CurrentForm->getValue($monthly_run_grid->FormKeyCountName);
		$monthly_run_grid->StopRecord = $monthly_run_grid->StartRecord + $monthly_run_grid->KeyCount - 1;
	}
}
$monthly_run_grid->RecordCount = $monthly_run_grid->StartRecord - 1;
if ($monthly_run_grid->Recordset && !$monthly_run_grid->Recordset->EOF) {
	$monthly_run_grid->Recordset->moveFirst();
	$selectLimit = $monthly_run_grid->UseSelectLimit;
	if (!$selectLimit && $monthly_run_grid->StartRecord > 1)
		$monthly_run_grid->Recordset->move($monthly_run_grid->StartRecord - 1);
} elseif (!$monthly_run->AllowAddDeleteRow && $monthly_run_grid->StopRecord == 0) {
	$monthly_run_grid->StopRecord = $monthly_run->GridAddRowCount;
}

// Initialize aggregate
$monthly_run->RowType = ROWTYPE_AGGREGATEINIT;
$monthly_run->resetAttributes();
$monthly_run_grid->renderRow();
if ($monthly_run_grid->isGridAdd())
	$monthly_run_grid->RowIndex = 0;
if ($monthly_run_grid->isGridEdit())
	$monthly_run_grid->RowIndex = 0;
while ($monthly_run_grid->RecordCount < $monthly_run_grid->StopRecord) {
	$monthly_run_grid->RecordCount++;
	if ($monthly_run_grid->RecordCount >= $monthly_run_grid->StartRecord) {
		$monthly_run_grid->RowCount++;
		if ($monthly_run_grid->isGridAdd() || $monthly_run_grid->isGridEdit() || $monthly_run->isConfirm()) {
			$monthly_run_grid->RowIndex++;
			$CurrentForm->Index = $monthly_run_grid->RowIndex;
			if ($CurrentForm->hasValue($monthly_run_grid->FormActionName) && ($monthly_run->isConfirm() || $monthly_run_grid->EventCancelled))
				$monthly_run_grid->RowAction = strval($CurrentForm->getValue($monthly_run_grid->FormActionName));
			elseif ($monthly_run_grid->isGridAdd())
				$monthly_run_grid->RowAction = "insert";
			else
				$monthly_run_grid->RowAction = "";
		}

		// Set up key count
		$monthly_run_grid->KeyCount = $monthly_run_grid->RowIndex;

		// Init row class and style
		$monthly_run->resetAttributes();
		$monthly_run->CssClass = "";
		if ($monthly_run_grid->isGridAdd()) {
			if ($monthly_run->CurrentMode == "copy") {
				$monthly_run_grid->loadRowValues($monthly_run_grid->Recordset); // Load row values
				$monthly_run_grid->setRecordKey($monthly_run_grid->RowOldKey, $monthly_run_grid->Recordset); // Set old record key
			} else {
				$monthly_run_grid->loadRowValues(); // Load default values
				$monthly_run_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$monthly_run_grid->loadRowValues($monthly_run_grid->Recordset); // Load row values
		}
		$monthly_run->RowType = ROWTYPE_VIEW; // Render view
		if ($monthly_run_grid->isGridAdd()) // Grid add
			$monthly_run->RowType = ROWTYPE_ADD; // Render add
		if ($monthly_run_grid->isGridAdd() && $monthly_run->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$monthly_run_grid->restoreCurrentRowFormValues($monthly_run_grid->RowIndex); // Restore form values
		if ($monthly_run_grid->isGridEdit()) { // Grid edit
			if ($monthly_run->EventCancelled)
				$monthly_run_grid->restoreCurrentRowFormValues($monthly_run_grid->RowIndex); // Restore form values
			if ($monthly_run_grid->RowAction == "insert")
				$monthly_run->RowType = ROWTYPE_ADD; // Render add
			else
				$monthly_run->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($monthly_run_grid->isGridEdit() && ($monthly_run->RowType == ROWTYPE_EDIT || $monthly_run->RowType == ROWTYPE_ADD) && $monthly_run->EventCancelled) // Update failed
			$monthly_run_grid->restoreCurrentRowFormValues($monthly_run_grid->RowIndex); // Restore form values
		if ($monthly_run->RowType == ROWTYPE_EDIT) // Edit row
			$monthly_run_grid->EditRowCount++;
		if ($monthly_run->isConfirm()) // Confirm row
			$monthly_run_grid->restoreCurrentRowFormValues($monthly_run_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$monthly_run->RowAttrs->merge(["data-rowindex" => $monthly_run_grid->RowCount, "id" => "r" . $monthly_run_grid->RowCount . "_monthly_run", "data-rowtype" => $monthly_run->RowType]);

		// Render row
		$monthly_run_grid->renderRow();

		// Render list options
		$monthly_run_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($monthly_run_grid->RowAction != "delete" && $monthly_run_grid->RowAction != "insertdelete" && !($monthly_run_grid->RowAction == "insert" && $monthly_run->isConfirm() && $monthly_run_grid->emptyRow())) {
?>
	<tr <?php echo $monthly_run->rowAttributes() ?>>
<?php

// Render list options (body, left)
$monthly_run_grid->ListOptions->render("body", "left", $monthly_run_grid->RowCount);
?>
	<?php if ($monthly_run_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $monthly_run_grid->LACode->cellAttributes() ?>>
<?php if ($monthly_run->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($monthly_run_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_LACode" class="form-group">
<span<?php echo $monthly_run_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($monthly_run_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $monthly_run_grid->RowIndex ?>_LACode" name="x<?php echo $monthly_run_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($monthly_run_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_LACode" class="form-group">
<?php
$onchange = $monthly_run_grid->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$monthly_run_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $monthly_run_grid->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $monthly_run_grid->RowIndex ?>_LACode" id="sv_x<?php echo $monthly_run_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($monthly_run_grid->LACode->EditValue) ?>" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($monthly_run_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($monthly_run_grid->LACode->getPlaceHolder()) ?>"<?php echo $monthly_run_grid->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($monthly_run_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $monthly_run_grid->RowIndex ?>_LACode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($monthly_run_grid->LACode->ReadOnly || $monthly_run_grid->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="monthly_run" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $monthly_run_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $monthly_run_grid->RowIndex ?>_LACode" id="x<?php echo $monthly_run_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($monthly_run_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmonthly_rungrid"], function() {
	fmonthly_rungrid.createAutoSuggest({"id":"x<?php echo $monthly_run_grid->RowIndex ?>_LACode","forceSelect":true});
});
</script>
<?php echo $monthly_run_grid->LACode->Lookup->getParamTag($monthly_run_grid, "p_x" . $monthly_run_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="monthly_run" data-field="x_LACode" name="o<?php echo $monthly_run_grid->RowIndex ?>_LACode" id="o<?php echo $monthly_run_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($monthly_run_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($monthly_run->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($monthly_run_grid->LACode->getSessionValue() != "") { ?>

<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_LACode" class="form-group">
<span<?php echo $monthly_run_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($monthly_run_grid->LACode->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $monthly_run_grid->RowIndex ?>_LACode" name="x<?php echo $monthly_run_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($monthly_run_grid->LACode->CurrentValue) ?>">
<?php } else { ?>

<?php
$onchange = $monthly_run_grid->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$monthly_run_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $monthly_run_grid->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $monthly_run_grid->RowIndex ?>_LACode" id="sv_x<?php echo $monthly_run_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($monthly_run_grid->LACode->EditValue) ?>" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($monthly_run_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($monthly_run_grid->LACode->getPlaceHolder()) ?>"<?php echo $monthly_run_grid->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($monthly_run_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $monthly_run_grid->RowIndex ?>_LACode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($monthly_run_grid->LACode->ReadOnly || $monthly_run_grid->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="monthly_run" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $monthly_run_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $monthly_run_grid->RowIndex ?>_LACode" id="x<?php echo $monthly_run_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($monthly_run_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmonthly_rungrid"], function() {
	fmonthly_rungrid.createAutoSuggest({"id":"x<?php echo $monthly_run_grid->RowIndex ?>_LACode","forceSelect":true});
});
</script>
<?php echo $monthly_run_grid->LACode->Lookup->getParamTag($monthly_run_grid, "p_x" . $monthly_run_grid->RowIndex . "_LACode") ?>

<?php } ?>

<input type="hidden" data-table="monthly_run" data-field="x_LACode" name="o<?php echo $monthly_run_grid->RowIndex ?>_LACode" id="o<?php echo $monthly_run_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($monthly_run_grid->LACode->OldValue != null ? $monthly_run_grid->LACode->OldValue : $monthly_run_grid->LACode->CurrentValue) ?>">
<?php } ?>
<?php if ($monthly_run->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_LACode">
<span<?php echo $monthly_run_grid->LACode->viewAttributes() ?>><?php echo $monthly_run_grid->LACode->getViewValue() ?></span>
</span>
<?php if (!$monthly_run->isConfirm()) { ?>
<input type="hidden" data-table="monthly_run" data-field="x_LACode" name="x<?php echo $monthly_run_grid->RowIndex ?>_LACode" id="x<?php echo $monthly_run_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($monthly_run_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="monthly_run" data-field="x_LACode" name="o<?php echo $monthly_run_grid->RowIndex ?>_LACode" id="o<?php echo $monthly_run_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($monthly_run_grid->LACode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="monthly_run" data-field="x_LACode" name="fmonthly_rungrid$x<?php echo $monthly_run_grid->RowIndex ?>_LACode" id="fmonthly_rungrid$x<?php echo $monthly_run_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($monthly_run_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="monthly_run" data-field="x_LACode" name="fmonthly_rungrid$o<?php echo $monthly_run_grid->RowIndex ?>_LACode" id="fmonthly_rungrid$o<?php echo $monthly_run_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($monthly_run_grid->LACode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($monthly_run_grid->PeriodCode->Visible) { // PeriodCode ?>
		<td data-name="PeriodCode" <?php echo $monthly_run_grid->PeriodCode->cellAttributes() ?>>
<?php if ($monthly_run->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($monthly_run_grid->PeriodCode->getSessionValue() != "") { ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_PeriodCode" class="form-group">
<span<?php echo $monthly_run_grid->PeriodCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($monthly_run_grid->PeriodCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" name="x<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($monthly_run_grid->PeriodCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_PeriodCode" class="form-group">
<?php $monthly_run_grid->PeriodCode->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="monthly_run" data-field="x_PeriodCode" data-value-separator="<?php echo $monthly_run_grid->PeriodCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" name="x<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode"<?php echo $monthly_run_grid->PeriodCode->editAttributes() ?>>
			<?php echo $monthly_run_grid->PeriodCode->selectOptionListHtml("x{$monthly_run_grid->RowIndex}_PeriodCode") ?>
		</select>
</div>
<?php echo $monthly_run_grid->PeriodCode->Lookup->getParamTag($monthly_run_grid, "p_x" . $monthly_run_grid->RowIndex . "_PeriodCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="monthly_run" data-field="x_PeriodCode" name="o<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" id="o<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($monthly_run_grid->PeriodCode->OldValue) ?>">
<?php } ?>
<?php if ($monthly_run->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($monthly_run_grid->PeriodCode->getSessionValue() != "") { ?>

<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_PeriodCode" class="form-group">
<span<?php echo $monthly_run_grid->PeriodCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($monthly_run_grid->PeriodCode->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" name="x<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($monthly_run_grid->PeriodCode->CurrentValue) ?>">
<?php } else { ?>

<?php $monthly_run_grid->PeriodCode->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="monthly_run" data-field="x_PeriodCode" data-value-separator="<?php echo $monthly_run_grid->PeriodCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" name="x<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode"<?php echo $monthly_run_grid->PeriodCode->editAttributes() ?>>
			<?php echo $monthly_run_grid->PeriodCode->selectOptionListHtml("x{$monthly_run_grid->RowIndex}_PeriodCode") ?>
		</select>
</div>
<?php echo $monthly_run_grid->PeriodCode->Lookup->getParamTag($monthly_run_grid, "p_x" . $monthly_run_grid->RowIndex . "_PeriodCode") ?>

<?php } ?>

<input type="hidden" data-table="monthly_run" data-field="x_PeriodCode" name="o<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" id="o<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($monthly_run_grid->PeriodCode->OldValue != null ? $monthly_run_grid->PeriodCode->OldValue : $monthly_run_grid->PeriodCode->CurrentValue) ?>">
<?php } ?>
<?php if ($monthly_run->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_PeriodCode">
<span<?php echo $monthly_run_grid->PeriodCode->viewAttributes() ?>><?php echo $monthly_run_grid->PeriodCode->getViewValue() ?></span>
</span>
<?php if (!$monthly_run->isConfirm()) { ?>
<input type="hidden" data-table="monthly_run" data-field="x_PeriodCode" name="x<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" id="x<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($monthly_run_grid->PeriodCode->FormValue) ?>">
<input type="hidden" data-table="monthly_run" data-field="x_PeriodCode" name="o<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" id="o<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($monthly_run_grid->PeriodCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="monthly_run" data-field="x_PeriodCode" name="fmonthly_rungrid$x<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" id="fmonthly_rungrid$x<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($monthly_run_grid->PeriodCode->FormValue) ?>">
<input type="hidden" data-table="monthly_run" data-field="x_PeriodCode" name="fmonthly_rungrid$o<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" id="fmonthly_rungrid$o<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($monthly_run_grid->PeriodCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($monthly_run_grid->RunDate->Visible) { // RunDate ?>
		<td data-name="RunDate" <?php echo $monthly_run_grid->RunDate->cellAttributes() ?>>
<?php if ($monthly_run->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_RunDate" class="form-group">
<input type="text" data-table="monthly_run" data-field="x_RunDate" name="x<?php echo $monthly_run_grid->RowIndex ?>_RunDate" id="x<?php echo $monthly_run_grid->RowIndex ?>_RunDate" placeholder="<?php echo HtmlEncode($monthly_run_grid->RunDate->getPlaceHolder()) ?>" value="<?php echo $monthly_run_grid->RunDate->EditValue ?>"<?php echo $monthly_run_grid->RunDate->editAttributes() ?>>
<?php if (!$monthly_run_grid->RunDate->ReadOnly && !$monthly_run_grid->RunDate->Disabled && !isset($monthly_run_grid->RunDate->EditAttrs["readonly"]) && !isset($monthly_run_grid->RunDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmonthly_rungrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fmonthly_rungrid", "x<?php echo $monthly_run_grid->RowIndex ?>_RunDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="monthly_run" data-field="x_RunDate" name="o<?php echo $monthly_run_grid->RowIndex ?>_RunDate" id="o<?php echo $monthly_run_grid->RowIndex ?>_RunDate" value="<?php echo HtmlEncode($monthly_run_grid->RunDate->OldValue) ?>">
<?php } ?>
<?php if ($monthly_run->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_RunDate" class="form-group">
<input type="text" data-table="monthly_run" data-field="x_RunDate" name="x<?php echo $monthly_run_grid->RowIndex ?>_RunDate" id="x<?php echo $monthly_run_grid->RowIndex ?>_RunDate" placeholder="<?php echo HtmlEncode($monthly_run_grid->RunDate->getPlaceHolder()) ?>" value="<?php echo $monthly_run_grid->RunDate->EditValue ?>"<?php echo $monthly_run_grid->RunDate->editAttributes() ?>>
<?php if (!$monthly_run_grid->RunDate->ReadOnly && !$monthly_run_grid->RunDate->Disabled && !isset($monthly_run_grid->RunDate->EditAttrs["readonly"]) && !isset($monthly_run_grid->RunDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmonthly_rungrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fmonthly_rungrid", "x<?php echo $monthly_run_grid->RowIndex ?>_RunDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($monthly_run->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_RunDate">
<span<?php echo $monthly_run_grid->RunDate->viewAttributes() ?>><?php echo $monthly_run_grid->RunDate->getViewValue() ?></span>
</span>
<?php if (!$monthly_run->isConfirm()) { ?>
<input type="hidden" data-table="monthly_run" data-field="x_RunDate" name="x<?php echo $monthly_run_grid->RowIndex ?>_RunDate" id="x<?php echo $monthly_run_grid->RowIndex ?>_RunDate" value="<?php echo HtmlEncode($monthly_run_grid->RunDate->FormValue) ?>">
<input type="hidden" data-table="monthly_run" data-field="x_RunDate" name="o<?php echo $monthly_run_grid->RowIndex ?>_RunDate" id="o<?php echo $monthly_run_grid->RowIndex ?>_RunDate" value="<?php echo HtmlEncode($monthly_run_grid->RunDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="monthly_run" data-field="x_RunDate" name="fmonthly_rungrid$x<?php echo $monthly_run_grid->RowIndex ?>_RunDate" id="fmonthly_rungrid$x<?php echo $monthly_run_grid->RowIndex ?>_RunDate" value="<?php echo HtmlEncode($monthly_run_grid->RunDate->FormValue) ?>">
<input type="hidden" data-table="monthly_run" data-field="x_RunDate" name="fmonthly_rungrid$o<?php echo $monthly_run_grid->RowIndex ?>_RunDate" id="fmonthly_rungrid$o<?php echo $monthly_run_grid->RowIndex ?>_RunDate" value="<?php echo HtmlEncode($monthly_run_grid->RunDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($monthly_run_grid->Description->Visible) { // Description ?>
		<td data-name="Description" <?php echo $monthly_run_grid->Description->cellAttributes() ?>>
<?php if ($monthly_run->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_Description" class="form-group">
<input type="text" data-table="monthly_run" data-field="x_Description" name="x<?php echo $monthly_run_grid->RowIndex ?>_Description" id="x<?php echo $monthly_run_grid->RowIndex ?>_Description" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($monthly_run_grid->Description->getPlaceHolder()) ?>" value="<?php echo $monthly_run_grid->Description->EditValue ?>"<?php echo $monthly_run_grid->Description->editAttributes() ?>>
</span>
<input type="hidden" data-table="monthly_run" data-field="x_Description" name="o<?php echo $monthly_run_grid->RowIndex ?>_Description" id="o<?php echo $monthly_run_grid->RowIndex ?>_Description" value="<?php echo HtmlEncode($monthly_run_grid->Description->OldValue) ?>">
<?php } ?>
<?php if ($monthly_run->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_Description" class="form-group">
<input type="text" data-table="monthly_run" data-field="x_Description" name="x<?php echo $monthly_run_grid->RowIndex ?>_Description" id="x<?php echo $monthly_run_grid->RowIndex ?>_Description" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($monthly_run_grid->Description->getPlaceHolder()) ?>" value="<?php echo $monthly_run_grid->Description->EditValue ?>"<?php echo $monthly_run_grid->Description->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($monthly_run->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_Description">
<span<?php echo $monthly_run_grid->Description->viewAttributes() ?>><?php echo $monthly_run_grid->Description->getViewValue() ?></span>
</span>
<?php if (!$monthly_run->isConfirm()) { ?>
<input type="hidden" data-table="monthly_run" data-field="x_Description" name="x<?php echo $monthly_run_grid->RowIndex ?>_Description" id="x<?php echo $monthly_run_grid->RowIndex ?>_Description" value="<?php echo HtmlEncode($monthly_run_grid->Description->FormValue) ?>">
<input type="hidden" data-table="monthly_run" data-field="x_Description" name="o<?php echo $monthly_run_grid->RowIndex ?>_Description" id="o<?php echo $monthly_run_grid->RowIndex ?>_Description" value="<?php echo HtmlEncode($monthly_run_grid->Description->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="monthly_run" data-field="x_Description" name="fmonthly_rungrid$x<?php echo $monthly_run_grid->RowIndex ?>_Description" id="fmonthly_rungrid$x<?php echo $monthly_run_grid->RowIndex ?>_Description" value="<?php echo HtmlEncode($monthly_run_grid->Description->FormValue) ?>">
<input type="hidden" data-table="monthly_run" data-field="x_Description" name="fmonthly_rungrid$o<?php echo $monthly_run_grid->RowIndex ?>_Description" id="fmonthly_rungrid$o<?php echo $monthly_run_grid->RowIndex ?>_Description" value="<?php echo HtmlEncode($monthly_run_grid->Description->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($monthly_run_grid->Year->Visible) { // Year ?>
		<td data-name="Year" <?php echo $monthly_run_grid->Year->cellAttributes() ?>>
<?php if ($monthly_run->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($monthly_run_grid->Year->getSessionValue() != "") { ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_Year" class="form-group">
<span<?php echo $monthly_run_grid->Year->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($monthly_run_grid->Year->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $monthly_run_grid->RowIndex ?>_Year" name="x<?php echo $monthly_run_grid->RowIndex ?>_Year" value="<?php echo HtmlEncode($monthly_run_grid->Year->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_Year" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="monthly_run" data-field="x_Year" data-value-separator="<?php echo $monthly_run_grid->Year->displayValueSeparatorAttribute() ?>" id="x<?php echo $monthly_run_grid->RowIndex ?>_Year" name="x<?php echo $monthly_run_grid->RowIndex ?>_Year"<?php echo $monthly_run_grid->Year->editAttributes() ?>>
			<?php echo $monthly_run_grid->Year->selectOptionListHtml("x{$monthly_run_grid->RowIndex}_Year") ?>
		</select>
</div>
<?php echo $monthly_run_grid->Year->Lookup->getParamTag($monthly_run_grid, "p_x" . $monthly_run_grid->RowIndex . "_Year") ?>
</span>
<?php } ?>
<input type="hidden" data-table="monthly_run" data-field="x_Year" name="o<?php echo $monthly_run_grid->RowIndex ?>_Year" id="o<?php echo $monthly_run_grid->RowIndex ?>_Year" value="<?php echo HtmlEncode($monthly_run_grid->Year->OldValue) ?>">
<?php } ?>
<?php if ($monthly_run->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($monthly_run_grid->Year->getSessionValue() != "") { ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_Year" class="form-group">
<span<?php echo $monthly_run_grid->Year->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($monthly_run_grid->Year->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $monthly_run_grid->RowIndex ?>_Year" name="x<?php echo $monthly_run_grid->RowIndex ?>_Year" value="<?php echo HtmlEncode($monthly_run_grid->Year->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_Year" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="monthly_run" data-field="x_Year" data-value-separator="<?php echo $monthly_run_grid->Year->displayValueSeparatorAttribute() ?>" id="x<?php echo $monthly_run_grid->RowIndex ?>_Year" name="x<?php echo $monthly_run_grid->RowIndex ?>_Year"<?php echo $monthly_run_grid->Year->editAttributes() ?>>
			<?php echo $monthly_run_grid->Year->selectOptionListHtml("x{$monthly_run_grid->RowIndex}_Year") ?>
		</select>
</div>
<?php echo $monthly_run_grid->Year->Lookup->getParamTag($monthly_run_grid, "p_x" . $monthly_run_grid->RowIndex . "_Year") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($monthly_run->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_Year">
<span<?php echo $monthly_run_grid->Year->viewAttributes() ?>><?php echo $monthly_run_grid->Year->getViewValue() ?></span>
</span>
<?php if (!$monthly_run->isConfirm()) { ?>
<input type="hidden" data-table="monthly_run" data-field="x_Year" name="x<?php echo $monthly_run_grid->RowIndex ?>_Year" id="x<?php echo $monthly_run_grid->RowIndex ?>_Year" value="<?php echo HtmlEncode($monthly_run_grid->Year->FormValue) ?>">
<input type="hidden" data-table="monthly_run" data-field="x_Year" name="o<?php echo $monthly_run_grid->RowIndex ?>_Year" id="o<?php echo $monthly_run_grid->RowIndex ?>_Year" value="<?php echo HtmlEncode($monthly_run_grid->Year->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="monthly_run" data-field="x_Year" name="fmonthly_rungrid$x<?php echo $monthly_run_grid->RowIndex ?>_Year" id="fmonthly_rungrid$x<?php echo $monthly_run_grid->RowIndex ?>_Year" value="<?php echo HtmlEncode($monthly_run_grid->Year->FormValue) ?>">
<input type="hidden" data-table="monthly_run" data-field="x_Year" name="fmonthly_rungrid$o<?php echo $monthly_run_grid->RowIndex ?>_Year" id="fmonthly_rungrid$o<?php echo $monthly_run_grid->RowIndex ?>_Year" value="<?php echo HtmlEncode($monthly_run_grid->Year->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($monthly_run_grid->RunMonth->Visible) { // RunMonth ?>
		<td data-name="RunMonth" <?php echo $monthly_run_grid->RunMonth->cellAttributes() ?>>
<?php if ($monthly_run->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($monthly_run_grid->RunMonth->getSessionValue() != "") { ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_RunMonth" class="form-group">
<span<?php echo $monthly_run_grid->RunMonth->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($monthly_run_grid->RunMonth->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $monthly_run_grid->RowIndex ?>_RunMonth" name="x<?php echo $monthly_run_grid->RowIndex ?>_RunMonth" value="<?php echo HtmlEncode($monthly_run_grid->RunMonth->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_RunMonth" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="monthly_run" data-field="x_RunMonth" data-value-separator="<?php echo $monthly_run_grid->RunMonth->displayValueSeparatorAttribute() ?>" id="x<?php echo $monthly_run_grid->RowIndex ?>_RunMonth" name="x<?php echo $monthly_run_grid->RowIndex ?>_RunMonth"<?php echo $monthly_run_grid->RunMonth->editAttributes() ?>>
			<?php echo $monthly_run_grid->RunMonth->selectOptionListHtml("x{$monthly_run_grid->RowIndex}_RunMonth") ?>
		</select>
</div>
<?php echo $monthly_run_grid->RunMonth->Lookup->getParamTag($monthly_run_grid, "p_x" . $monthly_run_grid->RowIndex . "_RunMonth") ?>
</span>
<?php } ?>
<input type="hidden" data-table="monthly_run" data-field="x_RunMonth" name="o<?php echo $monthly_run_grid->RowIndex ?>_RunMonth" id="o<?php echo $monthly_run_grid->RowIndex ?>_RunMonth" value="<?php echo HtmlEncode($monthly_run_grid->RunMonth->OldValue) ?>">
<?php } ?>
<?php if ($monthly_run->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($monthly_run_grid->RunMonth->getSessionValue() != "") { ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_RunMonth" class="form-group">
<span<?php echo $monthly_run_grid->RunMonth->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($monthly_run_grid->RunMonth->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $monthly_run_grid->RowIndex ?>_RunMonth" name="x<?php echo $monthly_run_grid->RowIndex ?>_RunMonth" value="<?php echo HtmlEncode($monthly_run_grid->RunMonth->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_RunMonth" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="monthly_run" data-field="x_RunMonth" data-value-separator="<?php echo $monthly_run_grid->RunMonth->displayValueSeparatorAttribute() ?>" id="x<?php echo $monthly_run_grid->RowIndex ?>_RunMonth" name="x<?php echo $monthly_run_grid->RowIndex ?>_RunMonth"<?php echo $monthly_run_grid->RunMonth->editAttributes() ?>>
			<?php echo $monthly_run_grid->RunMonth->selectOptionListHtml("x{$monthly_run_grid->RowIndex}_RunMonth") ?>
		</select>
</div>
<?php echo $monthly_run_grid->RunMonth->Lookup->getParamTag($monthly_run_grid, "p_x" . $monthly_run_grid->RowIndex . "_RunMonth") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($monthly_run->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_RunMonth">
<span<?php echo $monthly_run_grid->RunMonth->viewAttributes() ?>><?php echo $monthly_run_grid->RunMonth->getViewValue() ?></span>
</span>
<?php if (!$monthly_run->isConfirm()) { ?>
<input type="hidden" data-table="monthly_run" data-field="x_RunMonth" name="x<?php echo $monthly_run_grid->RowIndex ?>_RunMonth" id="x<?php echo $monthly_run_grid->RowIndex ?>_RunMonth" value="<?php echo HtmlEncode($monthly_run_grid->RunMonth->FormValue) ?>">
<input type="hidden" data-table="monthly_run" data-field="x_RunMonth" name="o<?php echo $monthly_run_grid->RowIndex ?>_RunMonth" id="o<?php echo $monthly_run_grid->RowIndex ?>_RunMonth" value="<?php echo HtmlEncode($monthly_run_grid->RunMonth->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="monthly_run" data-field="x_RunMonth" name="fmonthly_rungrid$x<?php echo $monthly_run_grid->RowIndex ?>_RunMonth" id="fmonthly_rungrid$x<?php echo $monthly_run_grid->RowIndex ?>_RunMonth" value="<?php echo HtmlEncode($monthly_run_grid->RunMonth->FormValue) ?>">
<input type="hidden" data-table="monthly_run" data-field="x_RunMonth" name="fmonthly_rungrid$o<?php echo $monthly_run_grid->RowIndex ?>_RunMonth" id="fmonthly_rungrid$o<?php echo $monthly_run_grid->RowIndex ?>_RunMonth" value="<?php echo HtmlEncode($monthly_run_grid->RunMonth->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($monthly_run_grid->PayrollCode->Visible) { // PayrollCode ?>
		<td data-name="PayrollCode" <?php echo $monthly_run_grid->PayrollCode->cellAttributes() ?>>
<?php if ($monthly_run->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_PayrollCode" class="form-group">
<input type="text" data-table="monthly_run" data-field="x_PayrollCode" name="x<?php echo $monthly_run_grid->RowIndex ?>_PayrollCode" id="x<?php echo $monthly_run_grid->RowIndex ?>_PayrollCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($monthly_run_grid->PayrollCode->getPlaceHolder()) ?>" value="<?php echo $monthly_run_grid->PayrollCode->EditValue ?>"<?php echo $monthly_run_grid->PayrollCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="monthly_run" data-field="x_PayrollCode" name="o<?php echo $monthly_run_grid->RowIndex ?>_PayrollCode" id="o<?php echo $monthly_run_grid->RowIndex ?>_PayrollCode" value="<?php echo HtmlEncode($monthly_run_grid->PayrollCode->OldValue) ?>">
<?php } ?>
<?php if ($monthly_run->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_PayrollCode" class="form-group">
<input type="text" data-table="monthly_run" data-field="x_PayrollCode" name="x<?php echo $monthly_run_grid->RowIndex ?>_PayrollCode" id="x<?php echo $monthly_run_grid->RowIndex ?>_PayrollCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($monthly_run_grid->PayrollCode->getPlaceHolder()) ?>" value="<?php echo $monthly_run_grid->PayrollCode->EditValue ?>"<?php echo $monthly_run_grid->PayrollCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($monthly_run->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $monthly_run_grid->RowCount ?>_monthly_run_PayrollCode">
<span<?php echo $monthly_run_grid->PayrollCode->viewAttributes() ?>><?php echo $monthly_run_grid->PayrollCode->getViewValue() ?></span>
</span>
<?php if (!$monthly_run->isConfirm()) { ?>
<input type="hidden" data-table="monthly_run" data-field="x_PayrollCode" name="x<?php echo $monthly_run_grid->RowIndex ?>_PayrollCode" id="x<?php echo $monthly_run_grid->RowIndex ?>_PayrollCode" value="<?php echo HtmlEncode($monthly_run_grid->PayrollCode->FormValue) ?>">
<input type="hidden" data-table="monthly_run" data-field="x_PayrollCode" name="o<?php echo $monthly_run_grid->RowIndex ?>_PayrollCode" id="o<?php echo $monthly_run_grid->RowIndex ?>_PayrollCode" value="<?php echo HtmlEncode($monthly_run_grid->PayrollCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="monthly_run" data-field="x_PayrollCode" name="fmonthly_rungrid$x<?php echo $monthly_run_grid->RowIndex ?>_PayrollCode" id="fmonthly_rungrid$x<?php echo $monthly_run_grid->RowIndex ?>_PayrollCode" value="<?php echo HtmlEncode($monthly_run_grid->PayrollCode->FormValue) ?>">
<input type="hidden" data-table="monthly_run" data-field="x_PayrollCode" name="fmonthly_rungrid$o<?php echo $monthly_run_grid->RowIndex ?>_PayrollCode" id="fmonthly_rungrid$o<?php echo $monthly_run_grid->RowIndex ?>_PayrollCode" value="<?php echo HtmlEncode($monthly_run_grid->PayrollCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$monthly_run_grid->ListOptions->render("body", "right", $monthly_run_grid->RowCount);
?>
	</tr>
<?php if ($monthly_run->RowType == ROWTYPE_ADD || $monthly_run->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fmonthly_rungrid", "load"], function() {
	fmonthly_rungrid.updateLists(<?php echo $monthly_run_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$monthly_run_grid->isGridAdd() || $monthly_run->CurrentMode == "copy")
		if (!$monthly_run_grid->Recordset->EOF)
			$monthly_run_grid->Recordset->moveNext();
}
?>
<?php
	if ($monthly_run->CurrentMode == "add" || $monthly_run->CurrentMode == "copy" || $monthly_run->CurrentMode == "edit") {
		$monthly_run_grid->RowIndex = '$rowindex$';
		$monthly_run_grid->loadRowValues();

		// Set row properties
		$monthly_run->resetAttributes();
		$monthly_run->RowAttrs->merge(["data-rowindex" => $monthly_run_grid->RowIndex, "id" => "r0_monthly_run", "data-rowtype" => ROWTYPE_ADD]);
		$monthly_run->RowAttrs->appendClass("ew-template");
		$monthly_run->RowType = ROWTYPE_ADD;

		// Render row
		$monthly_run_grid->renderRow();

		// Render list options
		$monthly_run_grid->renderListOptions();
		$monthly_run_grid->StartRowCount = 0;
?>
	<tr <?php echo $monthly_run->rowAttributes() ?>>
<?php

// Render list options (body, left)
$monthly_run_grid->ListOptions->render("body", "left", $monthly_run_grid->RowIndex);
?>
	<?php if ($monthly_run_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if (!$monthly_run->isConfirm()) { ?>
<?php if ($monthly_run_grid->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_monthly_run_LACode" class="form-group monthly_run_LACode">
<span<?php echo $monthly_run_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($monthly_run_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $monthly_run_grid->RowIndex ?>_LACode" name="x<?php echo $monthly_run_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($monthly_run_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_monthly_run_LACode" class="form-group monthly_run_LACode">
<?php
$onchange = $monthly_run_grid->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$monthly_run_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $monthly_run_grid->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $monthly_run_grid->RowIndex ?>_LACode" id="sv_x<?php echo $monthly_run_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($monthly_run_grid->LACode->EditValue) ?>" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($monthly_run_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($monthly_run_grid->LACode->getPlaceHolder()) ?>"<?php echo $monthly_run_grid->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($monthly_run_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $monthly_run_grid->RowIndex ?>_LACode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($monthly_run_grid->LACode->ReadOnly || $monthly_run_grid->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="monthly_run" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $monthly_run_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $monthly_run_grid->RowIndex ?>_LACode" id="x<?php echo $monthly_run_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($monthly_run_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmonthly_rungrid"], function() {
	fmonthly_rungrid.createAutoSuggest({"id":"x<?php echo $monthly_run_grid->RowIndex ?>_LACode","forceSelect":true});
});
</script>
<?php echo $monthly_run_grid->LACode->Lookup->getParamTag($monthly_run_grid, "p_x" . $monthly_run_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_monthly_run_LACode" class="form-group monthly_run_LACode">
<span<?php echo $monthly_run_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($monthly_run_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="monthly_run" data-field="x_LACode" name="x<?php echo $monthly_run_grid->RowIndex ?>_LACode" id="x<?php echo $monthly_run_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($monthly_run_grid->LACode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="monthly_run" data-field="x_LACode" name="o<?php echo $monthly_run_grid->RowIndex ?>_LACode" id="o<?php echo $monthly_run_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($monthly_run_grid->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($monthly_run_grid->PeriodCode->Visible) { // PeriodCode ?>
		<td data-name="PeriodCode">
<?php if (!$monthly_run->isConfirm()) { ?>
<?php if ($monthly_run_grid->PeriodCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_monthly_run_PeriodCode" class="form-group monthly_run_PeriodCode">
<span<?php echo $monthly_run_grid->PeriodCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($monthly_run_grid->PeriodCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" name="x<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($monthly_run_grid->PeriodCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_monthly_run_PeriodCode" class="form-group monthly_run_PeriodCode">
<?php $monthly_run_grid->PeriodCode->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="monthly_run" data-field="x_PeriodCode" data-value-separator="<?php echo $monthly_run_grid->PeriodCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" name="x<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode"<?php echo $monthly_run_grid->PeriodCode->editAttributes() ?>>
			<?php echo $monthly_run_grid->PeriodCode->selectOptionListHtml("x{$monthly_run_grid->RowIndex}_PeriodCode") ?>
		</select>
</div>
<?php echo $monthly_run_grid->PeriodCode->Lookup->getParamTag($monthly_run_grid, "p_x" . $monthly_run_grid->RowIndex . "_PeriodCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_monthly_run_PeriodCode" class="form-group monthly_run_PeriodCode">
<span<?php echo $monthly_run_grid->PeriodCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($monthly_run_grid->PeriodCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="monthly_run" data-field="x_PeriodCode" name="x<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" id="x<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($monthly_run_grid->PeriodCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="monthly_run" data-field="x_PeriodCode" name="o<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" id="o<?php echo $monthly_run_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($monthly_run_grid->PeriodCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($monthly_run_grid->RunDate->Visible) { // RunDate ?>
		<td data-name="RunDate">
<?php if (!$monthly_run->isConfirm()) { ?>
<span id="el$rowindex$_monthly_run_RunDate" class="form-group monthly_run_RunDate">
<input type="text" data-table="monthly_run" data-field="x_RunDate" name="x<?php echo $monthly_run_grid->RowIndex ?>_RunDate" id="x<?php echo $monthly_run_grid->RowIndex ?>_RunDate" placeholder="<?php echo HtmlEncode($monthly_run_grid->RunDate->getPlaceHolder()) ?>" value="<?php echo $monthly_run_grid->RunDate->EditValue ?>"<?php echo $monthly_run_grid->RunDate->editAttributes() ?>>
<?php if (!$monthly_run_grid->RunDate->ReadOnly && !$monthly_run_grid->RunDate->Disabled && !isset($monthly_run_grid->RunDate->EditAttrs["readonly"]) && !isset($monthly_run_grid->RunDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmonthly_rungrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fmonthly_rungrid", "x<?php echo $monthly_run_grid->RowIndex ?>_RunDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_monthly_run_RunDate" class="form-group monthly_run_RunDate">
<span<?php echo $monthly_run_grid->RunDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($monthly_run_grid->RunDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="monthly_run" data-field="x_RunDate" name="x<?php echo $monthly_run_grid->RowIndex ?>_RunDate" id="x<?php echo $monthly_run_grid->RowIndex ?>_RunDate" value="<?php echo HtmlEncode($monthly_run_grid->RunDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="monthly_run" data-field="x_RunDate" name="o<?php echo $monthly_run_grid->RowIndex ?>_RunDate" id="o<?php echo $monthly_run_grid->RowIndex ?>_RunDate" value="<?php echo HtmlEncode($monthly_run_grid->RunDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($monthly_run_grid->Description->Visible) { // Description ?>
		<td data-name="Description">
<?php if (!$monthly_run->isConfirm()) { ?>
<span id="el$rowindex$_monthly_run_Description" class="form-group monthly_run_Description">
<input type="text" data-table="monthly_run" data-field="x_Description" name="x<?php echo $monthly_run_grid->RowIndex ?>_Description" id="x<?php echo $monthly_run_grid->RowIndex ?>_Description" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($monthly_run_grid->Description->getPlaceHolder()) ?>" value="<?php echo $monthly_run_grid->Description->EditValue ?>"<?php echo $monthly_run_grid->Description->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_monthly_run_Description" class="form-group monthly_run_Description">
<span<?php echo $monthly_run_grid->Description->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($monthly_run_grid->Description->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="monthly_run" data-field="x_Description" name="x<?php echo $monthly_run_grid->RowIndex ?>_Description" id="x<?php echo $monthly_run_grid->RowIndex ?>_Description" value="<?php echo HtmlEncode($monthly_run_grid->Description->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="monthly_run" data-field="x_Description" name="o<?php echo $monthly_run_grid->RowIndex ?>_Description" id="o<?php echo $monthly_run_grid->RowIndex ?>_Description" value="<?php echo HtmlEncode($monthly_run_grid->Description->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($monthly_run_grid->Year->Visible) { // Year ?>
		<td data-name="Year">
<?php if (!$monthly_run->isConfirm()) { ?>
<?php if ($monthly_run_grid->Year->getSessionValue() != "") { ?>
<span id="el$rowindex$_monthly_run_Year" class="form-group monthly_run_Year">
<span<?php echo $monthly_run_grid->Year->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($monthly_run_grid->Year->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $monthly_run_grid->RowIndex ?>_Year" name="x<?php echo $monthly_run_grid->RowIndex ?>_Year" value="<?php echo HtmlEncode($monthly_run_grid->Year->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_monthly_run_Year" class="form-group monthly_run_Year">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="monthly_run" data-field="x_Year" data-value-separator="<?php echo $monthly_run_grid->Year->displayValueSeparatorAttribute() ?>" id="x<?php echo $monthly_run_grid->RowIndex ?>_Year" name="x<?php echo $monthly_run_grid->RowIndex ?>_Year"<?php echo $monthly_run_grid->Year->editAttributes() ?>>
			<?php echo $monthly_run_grid->Year->selectOptionListHtml("x{$monthly_run_grid->RowIndex}_Year") ?>
		</select>
</div>
<?php echo $monthly_run_grid->Year->Lookup->getParamTag($monthly_run_grid, "p_x" . $monthly_run_grid->RowIndex . "_Year") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_monthly_run_Year" class="form-group monthly_run_Year">
<span<?php echo $monthly_run_grid->Year->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($monthly_run_grid->Year->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="monthly_run" data-field="x_Year" name="x<?php echo $monthly_run_grid->RowIndex ?>_Year" id="x<?php echo $monthly_run_grid->RowIndex ?>_Year" value="<?php echo HtmlEncode($monthly_run_grid->Year->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="monthly_run" data-field="x_Year" name="o<?php echo $monthly_run_grid->RowIndex ?>_Year" id="o<?php echo $monthly_run_grid->RowIndex ?>_Year" value="<?php echo HtmlEncode($monthly_run_grid->Year->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($monthly_run_grid->RunMonth->Visible) { // RunMonth ?>
		<td data-name="RunMonth">
<?php if (!$monthly_run->isConfirm()) { ?>
<?php if ($monthly_run_grid->RunMonth->getSessionValue() != "") { ?>
<span id="el$rowindex$_monthly_run_RunMonth" class="form-group monthly_run_RunMonth">
<span<?php echo $monthly_run_grid->RunMonth->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($monthly_run_grid->RunMonth->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $monthly_run_grid->RowIndex ?>_RunMonth" name="x<?php echo $monthly_run_grid->RowIndex ?>_RunMonth" value="<?php echo HtmlEncode($monthly_run_grid->RunMonth->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_monthly_run_RunMonth" class="form-group monthly_run_RunMonth">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="monthly_run" data-field="x_RunMonth" data-value-separator="<?php echo $monthly_run_grid->RunMonth->displayValueSeparatorAttribute() ?>" id="x<?php echo $monthly_run_grid->RowIndex ?>_RunMonth" name="x<?php echo $monthly_run_grid->RowIndex ?>_RunMonth"<?php echo $monthly_run_grid->RunMonth->editAttributes() ?>>
			<?php echo $monthly_run_grid->RunMonth->selectOptionListHtml("x{$monthly_run_grid->RowIndex}_RunMonth") ?>
		</select>
</div>
<?php echo $monthly_run_grid->RunMonth->Lookup->getParamTag($monthly_run_grid, "p_x" . $monthly_run_grid->RowIndex . "_RunMonth") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_monthly_run_RunMonth" class="form-group monthly_run_RunMonth">
<span<?php echo $monthly_run_grid->RunMonth->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($monthly_run_grid->RunMonth->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="monthly_run" data-field="x_RunMonth" name="x<?php echo $monthly_run_grid->RowIndex ?>_RunMonth" id="x<?php echo $monthly_run_grid->RowIndex ?>_RunMonth" value="<?php echo HtmlEncode($monthly_run_grid->RunMonth->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="monthly_run" data-field="x_RunMonth" name="o<?php echo $monthly_run_grid->RowIndex ?>_RunMonth" id="o<?php echo $monthly_run_grid->RowIndex ?>_RunMonth" value="<?php echo HtmlEncode($monthly_run_grid->RunMonth->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($monthly_run_grid->PayrollCode->Visible) { // PayrollCode ?>
		<td data-name="PayrollCode">
<?php if (!$monthly_run->isConfirm()) { ?>
<span id="el$rowindex$_monthly_run_PayrollCode" class="form-group monthly_run_PayrollCode">
<input type="text" data-table="monthly_run" data-field="x_PayrollCode" name="x<?php echo $monthly_run_grid->RowIndex ?>_PayrollCode" id="x<?php echo $monthly_run_grid->RowIndex ?>_PayrollCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($monthly_run_grid->PayrollCode->getPlaceHolder()) ?>" value="<?php echo $monthly_run_grid->PayrollCode->EditValue ?>"<?php echo $monthly_run_grid->PayrollCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_monthly_run_PayrollCode" class="form-group monthly_run_PayrollCode">
<span<?php echo $monthly_run_grid->PayrollCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($monthly_run_grid->PayrollCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="monthly_run" data-field="x_PayrollCode" name="x<?php echo $monthly_run_grid->RowIndex ?>_PayrollCode" id="x<?php echo $monthly_run_grid->RowIndex ?>_PayrollCode" value="<?php echo HtmlEncode($monthly_run_grid->PayrollCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="monthly_run" data-field="x_PayrollCode" name="o<?php echo $monthly_run_grid->RowIndex ?>_PayrollCode" id="o<?php echo $monthly_run_grid->RowIndex ?>_PayrollCode" value="<?php echo HtmlEncode($monthly_run_grid->PayrollCode->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$monthly_run_grid->ListOptions->render("body", "right", $monthly_run_grid->RowIndex);
?>
<script>
loadjs.ready(["fmonthly_rungrid", "load"], function() {
	fmonthly_rungrid.updateLists(<?php echo $monthly_run_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($monthly_run->CurrentMode == "add" || $monthly_run->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $monthly_run_grid->FormKeyCountName ?>" id="<?php echo $monthly_run_grid->FormKeyCountName ?>" value="<?php echo $monthly_run_grid->KeyCount ?>">
<?php echo $monthly_run_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($monthly_run->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $monthly_run_grid->FormKeyCountName ?>" id="<?php echo $monthly_run_grid->FormKeyCountName ?>" value="<?php echo $monthly_run_grid->KeyCount ?>">
<?php echo $monthly_run_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($monthly_run->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fmonthly_rungrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($monthly_run_grid->Recordset)
	$monthly_run_grid->Recordset->Close();
?>
<?php if ($monthly_run_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $monthly_run_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($monthly_run_grid->TotalRecords == 0 && !$monthly_run->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $monthly_run_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$monthly_run_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$monthly_run_grid->terminate();
?>