<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($council_resolution_grid))
	$council_resolution_grid = new council_resolution_grid();

// Run the page
$council_resolution_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$council_resolution_grid->Page_Render();
?>
<?php if (!$council_resolution_grid->isExport()) { ?>
<script>
var fcouncil_resolutiongrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fcouncil_resolutiongrid = new ew.Form("fcouncil_resolutiongrid", "grid");
	fcouncil_resolutiongrid.formKeyCountName = '<?php echo $council_resolution_grid->FormKeyCountName ?>';

	// Validate form
	fcouncil_resolutiongrid.validate = function() {
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
			<?php if ($council_resolution_grid->MeetingNo->Required) { ?>
				elm = this.getElements("x" + infix + "_MeetingNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_resolution_grid->MeetingNo->caption(), $council_resolution_grid->MeetingNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MeetingNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($council_resolution_grid->MeetingNo->errorMessage()) ?>");
			<?php if ($council_resolution_grid->MinuteNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_MinuteNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_resolution_grid->MinuteNumber->caption(), $council_resolution_grid->MinuteNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_resolution_grid->Resolutionccategory->Required) { ?>
				elm = this.getElements("x" + infix + "_Resolutionccategory");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_resolution_grid->Resolutionccategory->caption(), $council_resolution_grid->Resolutionccategory->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_resolution_grid->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_resolution_grid->LACode->caption(), $council_resolution_grid->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_resolution_grid->ResolutionNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ResolutionNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_resolution_grid->ResolutionNo->caption(), $council_resolution_grid->ResolutionNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_resolution_grid->Responsibility->Required) { ?>
				elm = this.getElements("x" + infix + "_Responsibility");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_resolution_grid->Responsibility->caption(), $council_resolution_grid->Responsibility->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_resolution_grid->ActionDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_resolution_grid->ActionDate->caption(), $council_resolution_grid->ActionDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActionDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($council_resolution_grid->ActionDate->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fcouncil_resolutiongrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "MeetingNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "MinuteNumber", false)) return false;
		if (ew.valueChanged(fobj, infix, "Resolutionccategory", false)) return false;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "Responsibility", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActionDate", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fcouncil_resolutiongrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcouncil_resolutiongrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcouncil_resolutiongrid.lists["x_MeetingNo"] = <?php echo $council_resolution_grid->MeetingNo->Lookup->toClientList($council_resolution_grid) ?>;
	fcouncil_resolutiongrid.lists["x_MeetingNo"].options = <?php echo JsonEncode($council_resolution_grid->MeetingNo->lookupOptions()) ?>;
	fcouncil_resolutiongrid.autoSuggests["x_MeetingNo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcouncil_resolutiongrid.lists["x_Resolutionccategory"] = <?php echo $council_resolution_grid->Resolutionccategory->Lookup->toClientList($council_resolution_grid) ?>;
	fcouncil_resolutiongrid.lists["x_Resolutionccategory"].options = <?php echo JsonEncode($council_resolution_grid->Resolutionccategory->lookupOptions()) ?>;
	fcouncil_resolutiongrid.lists["x_LACode"] = <?php echo $council_resolution_grid->LACode->Lookup->toClientList($council_resolution_grid) ?>;
	fcouncil_resolutiongrid.lists["x_LACode"].options = <?php echo JsonEncode($council_resolution_grid->LACode->lookupOptions()) ?>;
	fcouncil_resolutiongrid.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fcouncil_resolutiongrid");
});
</script>
<?php } ?>
<?php
$council_resolution_grid->renderOtherOptions();
?>
<?php if ($council_resolution_grid->TotalRecords > 0 || $council_resolution->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($council_resolution_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> council_resolution">
<?php if ($council_resolution_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $council_resolution_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fcouncil_resolutiongrid" class="ew-form ew-list-form form-inline">
<div id="gmp_council_resolution" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_council_resolutiongrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$council_resolution->RowType = ROWTYPE_HEADER;

// Render list options
$council_resolution_grid->renderListOptions();

// Render list options (header, left)
$council_resolution_grid->ListOptions->render("header", "left");
?>
<?php if ($council_resolution_grid->MeetingNo->Visible) { // MeetingNo ?>
	<?php if ($council_resolution_grid->SortUrl($council_resolution_grid->MeetingNo) == "") { ?>
		<th data-name="MeetingNo" class="<?php echo $council_resolution_grid->MeetingNo->headerCellClass() ?>"><div id="elh_council_resolution_MeetingNo" class="council_resolution_MeetingNo"><div class="ew-table-header-caption"><?php echo $council_resolution_grid->MeetingNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MeetingNo" class="<?php echo $council_resolution_grid->MeetingNo->headerCellClass() ?>"><div><div id="elh_council_resolution_MeetingNo" class="council_resolution_MeetingNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_resolution_grid->MeetingNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_resolution_grid->MeetingNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_resolution_grid->MeetingNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_resolution_grid->MinuteNumber->Visible) { // MinuteNumber ?>
	<?php if ($council_resolution_grid->SortUrl($council_resolution_grid->MinuteNumber) == "") { ?>
		<th data-name="MinuteNumber" class="<?php echo $council_resolution_grid->MinuteNumber->headerCellClass() ?>"><div id="elh_council_resolution_MinuteNumber" class="council_resolution_MinuteNumber"><div class="ew-table-header-caption"><?php echo $council_resolution_grid->MinuteNumber->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MinuteNumber" class="<?php echo $council_resolution_grid->MinuteNumber->headerCellClass() ?>"><div><div id="elh_council_resolution_MinuteNumber" class="council_resolution_MinuteNumber">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_resolution_grid->MinuteNumber->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_resolution_grid->MinuteNumber->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_resolution_grid->MinuteNumber->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_resolution_grid->Resolutionccategory->Visible) { // Resolutionccategory ?>
	<?php if ($council_resolution_grid->SortUrl($council_resolution_grid->Resolutionccategory) == "") { ?>
		<th data-name="Resolutionccategory" class="<?php echo $council_resolution_grid->Resolutionccategory->headerCellClass() ?>"><div id="elh_council_resolution_Resolutionccategory" class="council_resolution_Resolutionccategory"><div class="ew-table-header-caption"><?php echo $council_resolution_grid->Resolutionccategory->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Resolutionccategory" class="<?php echo $council_resolution_grid->Resolutionccategory->headerCellClass() ?>"><div><div id="elh_council_resolution_Resolutionccategory" class="council_resolution_Resolutionccategory">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_resolution_grid->Resolutionccategory->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_resolution_grid->Resolutionccategory->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_resolution_grid->Resolutionccategory->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_resolution_grid->LACode->Visible) { // LACode ?>
	<?php if ($council_resolution_grid->SortUrl($council_resolution_grid->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $council_resolution_grid->LACode->headerCellClass() ?>"><div id="elh_council_resolution_LACode" class="council_resolution_LACode"><div class="ew-table-header-caption"><?php echo $council_resolution_grid->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $council_resolution_grid->LACode->headerCellClass() ?>"><div><div id="elh_council_resolution_LACode" class="council_resolution_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_resolution_grid->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_resolution_grid->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_resolution_grid->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_resolution_grid->ResolutionNo->Visible) { // ResolutionNo ?>
	<?php if ($council_resolution_grid->SortUrl($council_resolution_grid->ResolutionNo) == "") { ?>
		<th data-name="ResolutionNo" class="<?php echo $council_resolution_grid->ResolutionNo->headerCellClass() ?>"><div id="elh_council_resolution_ResolutionNo" class="council_resolution_ResolutionNo"><div class="ew-table-header-caption"><?php echo $council_resolution_grid->ResolutionNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ResolutionNo" class="<?php echo $council_resolution_grid->ResolutionNo->headerCellClass() ?>"><div><div id="elh_council_resolution_ResolutionNo" class="council_resolution_ResolutionNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_resolution_grid->ResolutionNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_resolution_grid->ResolutionNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_resolution_grid->ResolutionNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_resolution_grid->Responsibility->Visible) { // Responsibility ?>
	<?php if ($council_resolution_grid->SortUrl($council_resolution_grid->Responsibility) == "") { ?>
		<th data-name="Responsibility" class="<?php echo $council_resolution_grid->Responsibility->headerCellClass() ?>"><div id="elh_council_resolution_Responsibility" class="council_resolution_Responsibility"><div class="ew-table-header-caption"><?php echo $council_resolution_grid->Responsibility->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Responsibility" class="<?php echo $council_resolution_grid->Responsibility->headerCellClass() ?>"><div><div id="elh_council_resolution_Responsibility" class="council_resolution_Responsibility">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_resolution_grid->Responsibility->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_resolution_grid->Responsibility->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_resolution_grid->Responsibility->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_resolution_grid->ActionDate->Visible) { // ActionDate ?>
	<?php if ($council_resolution_grid->SortUrl($council_resolution_grid->ActionDate) == "") { ?>
		<th data-name="ActionDate" class="<?php echo $council_resolution_grid->ActionDate->headerCellClass() ?>"><div id="elh_council_resolution_ActionDate" class="council_resolution_ActionDate"><div class="ew-table-header-caption"><?php echo $council_resolution_grid->ActionDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionDate" class="<?php echo $council_resolution_grid->ActionDate->headerCellClass() ?>"><div><div id="elh_council_resolution_ActionDate" class="council_resolution_ActionDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_resolution_grid->ActionDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_resolution_grid->ActionDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_resolution_grid->ActionDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$council_resolution_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$council_resolution_grid->StartRecord = 1;
$council_resolution_grid->StopRecord = $council_resolution_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($council_resolution->isConfirm() || $council_resolution_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($council_resolution_grid->FormKeyCountName) && ($council_resolution_grid->isGridAdd() || $council_resolution_grid->isGridEdit() || $council_resolution->isConfirm())) {
		$council_resolution_grid->KeyCount = $CurrentForm->getValue($council_resolution_grid->FormKeyCountName);
		$council_resolution_grid->StopRecord = $council_resolution_grid->StartRecord + $council_resolution_grid->KeyCount - 1;
	}
}
$council_resolution_grid->RecordCount = $council_resolution_grid->StartRecord - 1;
if ($council_resolution_grid->Recordset && !$council_resolution_grid->Recordset->EOF) {
	$council_resolution_grid->Recordset->moveFirst();
	$selectLimit = $council_resolution_grid->UseSelectLimit;
	if (!$selectLimit && $council_resolution_grid->StartRecord > 1)
		$council_resolution_grid->Recordset->move($council_resolution_grid->StartRecord - 1);
} elseif (!$council_resolution->AllowAddDeleteRow && $council_resolution_grid->StopRecord == 0) {
	$council_resolution_grid->StopRecord = $council_resolution->GridAddRowCount;
}

// Initialize aggregate
$council_resolution->RowType = ROWTYPE_AGGREGATEINIT;
$council_resolution->resetAttributes();
$council_resolution_grid->renderRow();
if ($council_resolution_grid->isGridAdd())
	$council_resolution_grid->RowIndex = 0;
if ($council_resolution_grid->isGridEdit())
	$council_resolution_grid->RowIndex = 0;
while ($council_resolution_grid->RecordCount < $council_resolution_grid->StopRecord) {
	$council_resolution_grid->RecordCount++;
	if ($council_resolution_grid->RecordCount >= $council_resolution_grid->StartRecord) {
		$council_resolution_grid->RowCount++;
		if ($council_resolution_grid->isGridAdd() || $council_resolution_grid->isGridEdit() || $council_resolution->isConfirm()) {
			$council_resolution_grid->RowIndex++;
			$CurrentForm->Index = $council_resolution_grid->RowIndex;
			if ($CurrentForm->hasValue($council_resolution_grid->FormActionName) && ($council_resolution->isConfirm() || $council_resolution_grid->EventCancelled))
				$council_resolution_grid->RowAction = strval($CurrentForm->getValue($council_resolution_grid->FormActionName));
			elseif ($council_resolution_grid->isGridAdd())
				$council_resolution_grid->RowAction = "insert";
			else
				$council_resolution_grid->RowAction = "";
		}

		// Set up key count
		$council_resolution_grid->KeyCount = $council_resolution_grid->RowIndex;

		// Init row class and style
		$council_resolution->resetAttributes();
		$council_resolution->CssClass = "";
		if ($council_resolution_grid->isGridAdd()) {
			if ($council_resolution->CurrentMode == "copy") {
				$council_resolution_grid->loadRowValues($council_resolution_grid->Recordset); // Load row values
				$council_resolution_grid->setRecordKey($council_resolution_grid->RowOldKey, $council_resolution_grid->Recordset); // Set old record key
			} else {
				$council_resolution_grid->loadRowValues(); // Load default values
				$council_resolution_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$council_resolution_grid->loadRowValues($council_resolution_grid->Recordset); // Load row values
		}
		$council_resolution->RowType = ROWTYPE_VIEW; // Render view
		if ($council_resolution_grid->isGridAdd()) // Grid add
			$council_resolution->RowType = ROWTYPE_ADD; // Render add
		if ($council_resolution_grid->isGridAdd() && $council_resolution->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$council_resolution_grid->restoreCurrentRowFormValues($council_resolution_grid->RowIndex); // Restore form values
		if ($council_resolution_grid->isGridEdit()) { // Grid edit
			if ($council_resolution->EventCancelled)
				$council_resolution_grid->restoreCurrentRowFormValues($council_resolution_grid->RowIndex); // Restore form values
			if ($council_resolution_grid->RowAction == "insert")
				$council_resolution->RowType = ROWTYPE_ADD; // Render add
			else
				$council_resolution->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($council_resolution_grid->isGridEdit() && ($council_resolution->RowType == ROWTYPE_EDIT || $council_resolution->RowType == ROWTYPE_ADD) && $council_resolution->EventCancelled) // Update failed
			$council_resolution_grid->restoreCurrentRowFormValues($council_resolution_grid->RowIndex); // Restore form values
		if ($council_resolution->RowType == ROWTYPE_EDIT) // Edit row
			$council_resolution_grid->EditRowCount++;
		if ($council_resolution->isConfirm()) // Confirm row
			$council_resolution_grid->restoreCurrentRowFormValues($council_resolution_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$council_resolution->RowAttrs->merge(["data-rowindex" => $council_resolution_grid->RowCount, "id" => "r" . $council_resolution_grid->RowCount . "_council_resolution", "data-rowtype" => $council_resolution->RowType]);

		// Render row
		$council_resolution_grid->renderRow();

		// Render list options
		$council_resolution_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($council_resolution_grid->RowAction != "delete" && $council_resolution_grid->RowAction != "insertdelete" && !($council_resolution_grid->RowAction == "insert" && $council_resolution->isConfirm() && $council_resolution_grid->emptyRow())) {
?>
	<tr <?php echo $council_resolution->rowAttributes() ?>>
<?php

// Render list options (body, left)
$council_resolution_grid->ListOptions->render("body", "left", $council_resolution_grid->RowCount);
?>
	<?php if ($council_resolution_grid->MeetingNo->Visible) { // MeetingNo ?>
		<td data-name="MeetingNo" <?php echo $council_resolution_grid->MeetingNo->cellAttributes() ?>>
<?php if ($council_resolution->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($council_resolution_grid->MeetingNo->getSessionValue() != "") { ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_MeetingNo" class="form-group">
<span<?php echo $council_resolution_grid->MeetingNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_resolution_grid->MeetingNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" name="x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" value="<?php echo HtmlEncode($council_resolution_grid->MeetingNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_MeetingNo" class="form-group">
<?php
$onchange = $council_resolution_grid->MeetingNo->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$council_resolution_grid->MeetingNo->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo">
	<input type="text" class="form-control" name="sv_x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" id="sv_x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" value="<?php echo RemoveHtml($council_resolution_grid->MeetingNo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($council_resolution_grid->MeetingNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($council_resolution_grid->MeetingNo->getPlaceHolder()) ?>"<?php echo $council_resolution_grid->MeetingNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="council_resolution" data-field="x_MeetingNo" data-value-separator="<?php echo $council_resolution_grid->MeetingNo->displayValueSeparatorAttribute() ?>" name="x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" id="x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" value="<?php echo HtmlEncode($council_resolution_grid->MeetingNo->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncil_resolutiongrid"], function() {
	fcouncil_resolutiongrid.createAutoSuggest({"id":"x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo","forceSelect":false});
});
</script>
<?php echo $council_resolution_grid->MeetingNo->Lookup->getParamTag($council_resolution_grid, "p_x" . $council_resolution_grid->RowIndex . "_MeetingNo") ?>
</span>
<?php } ?>
<input type="hidden" data-table="council_resolution" data-field="x_MeetingNo" name="o<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" id="o<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" value="<?php echo HtmlEncode($council_resolution_grid->MeetingNo->OldValue) ?>">
<?php } ?>
<?php if ($council_resolution->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($council_resolution_grid->MeetingNo->getSessionValue() != "") { ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_MeetingNo" class="form-group">
<span<?php echo $council_resolution_grid->MeetingNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_resolution_grid->MeetingNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" name="x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" value="<?php echo HtmlEncode($council_resolution_grid->MeetingNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_MeetingNo" class="form-group">
<?php
$onchange = $council_resolution_grid->MeetingNo->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$council_resolution_grid->MeetingNo->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo">
	<input type="text" class="form-control" name="sv_x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" id="sv_x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" value="<?php echo RemoveHtml($council_resolution_grid->MeetingNo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($council_resolution_grid->MeetingNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($council_resolution_grid->MeetingNo->getPlaceHolder()) ?>"<?php echo $council_resolution_grid->MeetingNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="council_resolution" data-field="x_MeetingNo" data-value-separator="<?php echo $council_resolution_grid->MeetingNo->displayValueSeparatorAttribute() ?>" name="x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" id="x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" value="<?php echo HtmlEncode($council_resolution_grid->MeetingNo->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncil_resolutiongrid"], function() {
	fcouncil_resolutiongrid.createAutoSuggest({"id":"x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo","forceSelect":false});
});
</script>
<?php echo $council_resolution_grid->MeetingNo->Lookup->getParamTag($council_resolution_grid, "p_x" . $council_resolution_grid->RowIndex . "_MeetingNo") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($council_resolution->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_MeetingNo">
<span<?php echo $council_resolution_grid->MeetingNo->viewAttributes() ?>><?php echo $council_resolution_grid->MeetingNo->getViewValue() ?></span>
</span>
<?php if (!$council_resolution->isConfirm()) { ?>
<input type="hidden" data-table="council_resolution" data-field="x_MeetingNo" name="x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" id="x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" value="<?php echo HtmlEncode($council_resolution_grid->MeetingNo->FormValue) ?>">
<input type="hidden" data-table="council_resolution" data-field="x_MeetingNo" name="o<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" id="o<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" value="<?php echo HtmlEncode($council_resolution_grid->MeetingNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="council_resolution" data-field="x_MeetingNo" name="fcouncil_resolutiongrid$x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" id="fcouncil_resolutiongrid$x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" value="<?php echo HtmlEncode($council_resolution_grid->MeetingNo->FormValue) ?>">
<input type="hidden" data-table="council_resolution" data-field="x_MeetingNo" name="fcouncil_resolutiongrid$o<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" id="fcouncil_resolutiongrid$o<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" value="<?php echo HtmlEncode($council_resolution_grid->MeetingNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($council_resolution_grid->MinuteNumber->Visible) { // MinuteNumber ?>
		<td data-name="MinuteNumber" <?php echo $council_resolution_grid->MinuteNumber->cellAttributes() ?>>
<?php if ($council_resolution->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_MinuteNumber" class="form-group">
<input type="text" data-table="council_resolution" data-field="x_MinuteNumber" name="x<?php echo $council_resolution_grid->RowIndex ?>_MinuteNumber" id="x<?php echo $council_resolution_grid->RowIndex ?>_MinuteNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($council_resolution_grid->MinuteNumber->getPlaceHolder()) ?>" value="<?php echo $council_resolution_grid->MinuteNumber->EditValue ?>"<?php echo $council_resolution_grid->MinuteNumber->editAttributes() ?>>
</span>
<input type="hidden" data-table="council_resolution" data-field="x_MinuteNumber" name="o<?php echo $council_resolution_grid->RowIndex ?>_MinuteNumber" id="o<?php echo $council_resolution_grid->RowIndex ?>_MinuteNumber" value="<?php echo HtmlEncode($council_resolution_grid->MinuteNumber->OldValue) ?>">
<?php } ?>
<?php if ($council_resolution->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_MinuteNumber" class="form-group">
<input type="text" data-table="council_resolution" data-field="x_MinuteNumber" name="x<?php echo $council_resolution_grid->RowIndex ?>_MinuteNumber" id="x<?php echo $council_resolution_grid->RowIndex ?>_MinuteNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($council_resolution_grid->MinuteNumber->getPlaceHolder()) ?>" value="<?php echo $council_resolution_grid->MinuteNumber->EditValue ?>"<?php echo $council_resolution_grid->MinuteNumber->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($council_resolution->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_MinuteNumber">
<span<?php echo $council_resolution_grid->MinuteNumber->viewAttributes() ?>><?php echo $council_resolution_grid->MinuteNumber->getViewValue() ?></span>
</span>
<?php if (!$council_resolution->isConfirm()) { ?>
<input type="hidden" data-table="council_resolution" data-field="x_MinuteNumber" name="x<?php echo $council_resolution_grid->RowIndex ?>_MinuteNumber" id="x<?php echo $council_resolution_grid->RowIndex ?>_MinuteNumber" value="<?php echo HtmlEncode($council_resolution_grid->MinuteNumber->FormValue) ?>">
<input type="hidden" data-table="council_resolution" data-field="x_MinuteNumber" name="o<?php echo $council_resolution_grid->RowIndex ?>_MinuteNumber" id="o<?php echo $council_resolution_grid->RowIndex ?>_MinuteNumber" value="<?php echo HtmlEncode($council_resolution_grid->MinuteNumber->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="council_resolution" data-field="x_MinuteNumber" name="fcouncil_resolutiongrid$x<?php echo $council_resolution_grid->RowIndex ?>_MinuteNumber" id="fcouncil_resolutiongrid$x<?php echo $council_resolution_grid->RowIndex ?>_MinuteNumber" value="<?php echo HtmlEncode($council_resolution_grid->MinuteNumber->FormValue) ?>">
<input type="hidden" data-table="council_resolution" data-field="x_MinuteNumber" name="fcouncil_resolutiongrid$o<?php echo $council_resolution_grid->RowIndex ?>_MinuteNumber" id="fcouncil_resolutiongrid$o<?php echo $council_resolution_grid->RowIndex ?>_MinuteNumber" value="<?php echo HtmlEncode($council_resolution_grid->MinuteNumber->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($council_resolution_grid->Resolutionccategory->Visible) { // Resolutionccategory ?>
		<td data-name="Resolutionccategory" <?php echo $council_resolution_grid->Resolutionccategory->cellAttributes() ?>>
<?php if ($council_resolution->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_Resolutionccategory" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="council_resolution" data-field="x_Resolutionccategory" data-value-separator="<?php echo $council_resolution_grid->Resolutionccategory->displayValueSeparatorAttribute() ?>" id="x<?php echo $council_resolution_grid->RowIndex ?>_Resolutionccategory" name="x<?php echo $council_resolution_grid->RowIndex ?>_Resolutionccategory"<?php echo $council_resolution_grid->Resolutionccategory->editAttributes() ?>>
			<?php echo $council_resolution_grid->Resolutionccategory->selectOptionListHtml("x{$council_resolution_grid->RowIndex}_Resolutionccategory") ?>
		</select>
</div>
<?php echo $council_resolution_grid->Resolutionccategory->Lookup->getParamTag($council_resolution_grid, "p_x" . $council_resolution_grid->RowIndex . "_Resolutionccategory") ?>
</span>
<input type="hidden" data-table="council_resolution" data-field="x_Resolutionccategory" name="o<?php echo $council_resolution_grid->RowIndex ?>_Resolutionccategory" id="o<?php echo $council_resolution_grid->RowIndex ?>_Resolutionccategory" value="<?php echo HtmlEncode($council_resolution_grid->Resolutionccategory->OldValue) ?>">
<?php } ?>
<?php if ($council_resolution->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_Resolutionccategory" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="council_resolution" data-field="x_Resolutionccategory" data-value-separator="<?php echo $council_resolution_grid->Resolutionccategory->displayValueSeparatorAttribute() ?>" id="x<?php echo $council_resolution_grid->RowIndex ?>_Resolutionccategory" name="x<?php echo $council_resolution_grid->RowIndex ?>_Resolutionccategory"<?php echo $council_resolution_grid->Resolutionccategory->editAttributes() ?>>
			<?php echo $council_resolution_grid->Resolutionccategory->selectOptionListHtml("x{$council_resolution_grid->RowIndex}_Resolutionccategory") ?>
		</select>
</div>
<?php echo $council_resolution_grid->Resolutionccategory->Lookup->getParamTag($council_resolution_grid, "p_x" . $council_resolution_grid->RowIndex . "_Resolutionccategory") ?>
</span>
<?php } ?>
<?php if ($council_resolution->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_Resolutionccategory">
<span<?php echo $council_resolution_grid->Resolutionccategory->viewAttributes() ?>><?php echo $council_resolution_grid->Resolutionccategory->getViewValue() ?></span>
</span>
<?php if (!$council_resolution->isConfirm()) { ?>
<input type="hidden" data-table="council_resolution" data-field="x_Resolutionccategory" name="x<?php echo $council_resolution_grid->RowIndex ?>_Resolutionccategory" id="x<?php echo $council_resolution_grid->RowIndex ?>_Resolutionccategory" value="<?php echo HtmlEncode($council_resolution_grid->Resolutionccategory->FormValue) ?>">
<input type="hidden" data-table="council_resolution" data-field="x_Resolutionccategory" name="o<?php echo $council_resolution_grid->RowIndex ?>_Resolutionccategory" id="o<?php echo $council_resolution_grid->RowIndex ?>_Resolutionccategory" value="<?php echo HtmlEncode($council_resolution_grid->Resolutionccategory->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="council_resolution" data-field="x_Resolutionccategory" name="fcouncil_resolutiongrid$x<?php echo $council_resolution_grid->RowIndex ?>_Resolutionccategory" id="fcouncil_resolutiongrid$x<?php echo $council_resolution_grid->RowIndex ?>_Resolutionccategory" value="<?php echo HtmlEncode($council_resolution_grid->Resolutionccategory->FormValue) ?>">
<input type="hidden" data-table="council_resolution" data-field="x_Resolutionccategory" name="fcouncil_resolutiongrid$o<?php echo $council_resolution_grid->RowIndex ?>_Resolutionccategory" id="fcouncil_resolutiongrid$o<?php echo $council_resolution_grid->RowIndex ?>_Resolutionccategory" value="<?php echo HtmlEncode($council_resolution_grid->Resolutionccategory->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($council_resolution_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $council_resolution_grid->LACode->cellAttributes() ?>>
<?php if ($council_resolution->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($council_resolution_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_LACode" class="form-group">
<span<?php echo $council_resolution_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_resolution_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $council_resolution_grid->RowIndex ?>_LACode" name="x<?php echo $council_resolution_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_resolution_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_LACode" class="form-group">
<?php
$onchange = $council_resolution_grid->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$council_resolution_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $council_resolution_grid->RowIndex ?>_LACode">
	<input type="text" class="form-control" name="sv_x<?php echo $council_resolution_grid->RowIndex ?>_LACode" id="sv_x<?php echo $council_resolution_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($council_resolution_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($council_resolution_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($council_resolution_grid->LACode->getPlaceHolder()) ?>"<?php echo $council_resolution_grid->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="council_resolution" data-field="x_LACode" data-value-separator="<?php echo $council_resolution_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $council_resolution_grid->RowIndex ?>_LACode" id="x<?php echo $council_resolution_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_resolution_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncil_resolutiongrid"], function() {
	fcouncil_resolutiongrid.createAutoSuggest({"id":"x<?php echo $council_resolution_grid->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $council_resolution_grid->LACode->Lookup->getParamTag($council_resolution_grid, "p_x" . $council_resolution_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="council_resolution" data-field="x_LACode" name="o<?php echo $council_resolution_grid->RowIndex ?>_LACode" id="o<?php echo $council_resolution_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_resolution_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($council_resolution->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($council_resolution_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_LACode" class="form-group">
<span<?php echo $council_resolution_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_resolution_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $council_resolution_grid->RowIndex ?>_LACode" name="x<?php echo $council_resolution_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_resolution_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_LACode" class="form-group">
<?php
$onchange = $council_resolution_grid->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$council_resolution_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $council_resolution_grid->RowIndex ?>_LACode">
	<input type="text" class="form-control" name="sv_x<?php echo $council_resolution_grid->RowIndex ?>_LACode" id="sv_x<?php echo $council_resolution_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($council_resolution_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($council_resolution_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($council_resolution_grid->LACode->getPlaceHolder()) ?>"<?php echo $council_resolution_grid->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="council_resolution" data-field="x_LACode" data-value-separator="<?php echo $council_resolution_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $council_resolution_grid->RowIndex ?>_LACode" id="x<?php echo $council_resolution_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_resolution_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncil_resolutiongrid"], function() {
	fcouncil_resolutiongrid.createAutoSuggest({"id":"x<?php echo $council_resolution_grid->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $council_resolution_grid->LACode->Lookup->getParamTag($council_resolution_grid, "p_x" . $council_resolution_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($council_resolution->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_LACode">
<span<?php echo $council_resolution_grid->LACode->viewAttributes() ?>><?php echo $council_resolution_grid->LACode->getViewValue() ?></span>
</span>
<?php if (!$council_resolution->isConfirm()) { ?>
<input type="hidden" data-table="council_resolution" data-field="x_LACode" name="x<?php echo $council_resolution_grid->RowIndex ?>_LACode" id="x<?php echo $council_resolution_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_resolution_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="council_resolution" data-field="x_LACode" name="o<?php echo $council_resolution_grid->RowIndex ?>_LACode" id="o<?php echo $council_resolution_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_resolution_grid->LACode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="council_resolution" data-field="x_LACode" name="fcouncil_resolutiongrid$x<?php echo $council_resolution_grid->RowIndex ?>_LACode" id="fcouncil_resolutiongrid$x<?php echo $council_resolution_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_resolution_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="council_resolution" data-field="x_LACode" name="fcouncil_resolutiongrid$o<?php echo $council_resolution_grid->RowIndex ?>_LACode" id="fcouncil_resolutiongrid$o<?php echo $council_resolution_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_resolution_grid->LACode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($council_resolution_grid->ResolutionNo->Visible) { // ResolutionNo ?>
		<td data-name="ResolutionNo" <?php echo $council_resolution_grid->ResolutionNo->cellAttributes() ?>>
<?php if ($council_resolution->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_ResolutionNo" class="form-group"></span>
<input type="hidden" data-table="council_resolution" data-field="x_ResolutionNo" name="o<?php echo $council_resolution_grid->RowIndex ?>_ResolutionNo" id="o<?php echo $council_resolution_grid->RowIndex ?>_ResolutionNo" value="<?php echo HtmlEncode($council_resolution_grid->ResolutionNo->OldValue) ?>">
<?php } ?>
<?php if ($council_resolution->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_ResolutionNo" class="form-group">
<span<?php echo $council_resolution_grid->ResolutionNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_resolution_grid->ResolutionNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="council_resolution" data-field="x_ResolutionNo" name="x<?php echo $council_resolution_grid->RowIndex ?>_ResolutionNo" id="x<?php echo $council_resolution_grid->RowIndex ?>_ResolutionNo" value="<?php echo HtmlEncode($council_resolution_grid->ResolutionNo->CurrentValue) ?>">
<?php } ?>
<?php if ($council_resolution->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_ResolutionNo">
<span<?php echo $council_resolution_grid->ResolutionNo->viewAttributes() ?>><?php echo $council_resolution_grid->ResolutionNo->getViewValue() ?></span>
</span>
<?php if (!$council_resolution->isConfirm()) { ?>
<input type="hidden" data-table="council_resolution" data-field="x_ResolutionNo" name="x<?php echo $council_resolution_grid->RowIndex ?>_ResolutionNo" id="x<?php echo $council_resolution_grid->RowIndex ?>_ResolutionNo" value="<?php echo HtmlEncode($council_resolution_grid->ResolutionNo->FormValue) ?>">
<input type="hidden" data-table="council_resolution" data-field="x_ResolutionNo" name="o<?php echo $council_resolution_grid->RowIndex ?>_ResolutionNo" id="o<?php echo $council_resolution_grid->RowIndex ?>_ResolutionNo" value="<?php echo HtmlEncode($council_resolution_grid->ResolutionNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="council_resolution" data-field="x_ResolutionNo" name="fcouncil_resolutiongrid$x<?php echo $council_resolution_grid->RowIndex ?>_ResolutionNo" id="fcouncil_resolutiongrid$x<?php echo $council_resolution_grid->RowIndex ?>_ResolutionNo" value="<?php echo HtmlEncode($council_resolution_grid->ResolutionNo->FormValue) ?>">
<input type="hidden" data-table="council_resolution" data-field="x_ResolutionNo" name="fcouncil_resolutiongrid$o<?php echo $council_resolution_grid->RowIndex ?>_ResolutionNo" id="fcouncil_resolutiongrid$o<?php echo $council_resolution_grid->RowIndex ?>_ResolutionNo" value="<?php echo HtmlEncode($council_resolution_grid->ResolutionNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($council_resolution_grid->Responsibility->Visible) { // Responsibility ?>
		<td data-name="Responsibility" <?php echo $council_resolution_grid->Responsibility->cellAttributes() ?>>
<?php if ($council_resolution->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_Responsibility" class="form-group">
<input type="text" data-table="council_resolution" data-field="x_Responsibility" name="x<?php echo $council_resolution_grid->RowIndex ?>_Responsibility" id="x<?php echo $council_resolution_grid->RowIndex ?>_Responsibility" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($council_resolution_grid->Responsibility->getPlaceHolder()) ?>" value="<?php echo $council_resolution_grid->Responsibility->EditValue ?>"<?php echo $council_resolution_grid->Responsibility->editAttributes() ?>>
</span>
<input type="hidden" data-table="council_resolution" data-field="x_Responsibility" name="o<?php echo $council_resolution_grid->RowIndex ?>_Responsibility" id="o<?php echo $council_resolution_grid->RowIndex ?>_Responsibility" value="<?php echo HtmlEncode($council_resolution_grid->Responsibility->OldValue) ?>">
<?php } ?>
<?php if ($council_resolution->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_Responsibility" class="form-group">
<input type="text" data-table="council_resolution" data-field="x_Responsibility" name="x<?php echo $council_resolution_grid->RowIndex ?>_Responsibility" id="x<?php echo $council_resolution_grid->RowIndex ?>_Responsibility" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($council_resolution_grid->Responsibility->getPlaceHolder()) ?>" value="<?php echo $council_resolution_grid->Responsibility->EditValue ?>"<?php echo $council_resolution_grid->Responsibility->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($council_resolution->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_Responsibility">
<span<?php echo $council_resolution_grid->Responsibility->viewAttributes() ?>><?php echo $council_resolution_grid->Responsibility->getViewValue() ?></span>
</span>
<?php if (!$council_resolution->isConfirm()) { ?>
<input type="hidden" data-table="council_resolution" data-field="x_Responsibility" name="x<?php echo $council_resolution_grid->RowIndex ?>_Responsibility" id="x<?php echo $council_resolution_grid->RowIndex ?>_Responsibility" value="<?php echo HtmlEncode($council_resolution_grid->Responsibility->FormValue) ?>">
<input type="hidden" data-table="council_resolution" data-field="x_Responsibility" name="o<?php echo $council_resolution_grid->RowIndex ?>_Responsibility" id="o<?php echo $council_resolution_grid->RowIndex ?>_Responsibility" value="<?php echo HtmlEncode($council_resolution_grid->Responsibility->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="council_resolution" data-field="x_Responsibility" name="fcouncil_resolutiongrid$x<?php echo $council_resolution_grid->RowIndex ?>_Responsibility" id="fcouncil_resolutiongrid$x<?php echo $council_resolution_grid->RowIndex ?>_Responsibility" value="<?php echo HtmlEncode($council_resolution_grid->Responsibility->FormValue) ?>">
<input type="hidden" data-table="council_resolution" data-field="x_Responsibility" name="fcouncil_resolutiongrid$o<?php echo $council_resolution_grid->RowIndex ?>_Responsibility" id="fcouncil_resolutiongrid$o<?php echo $council_resolution_grid->RowIndex ?>_Responsibility" value="<?php echo HtmlEncode($council_resolution_grid->Responsibility->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($council_resolution_grid->ActionDate->Visible) { // ActionDate ?>
		<td data-name="ActionDate" <?php echo $council_resolution_grid->ActionDate->cellAttributes() ?>>
<?php if ($council_resolution->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_ActionDate" class="form-group">
<input type="text" data-table="council_resolution" data-field="x_ActionDate" name="x<?php echo $council_resolution_grid->RowIndex ?>_ActionDate" id="x<?php echo $council_resolution_grid->RowIndex ?>_ActionDate" placeholder="<?php echo HtmlEncode($council_resolution_grid->ActionDate->getPlaceHolder()) ?>" value="<?php echo $council_resolution_grid->ActionDate->EditValue ?>"<?php echo $council_resolution_grid->ActionDate->editAttributes() ?>>
<?php if (!$council_resolution_grid->ActionDate->ReadOnly && !$council_resolution_grid->ActionDate->Disabled && !isset($council_resolution_grid->ActionDate->EditAttrs["readonly"]) && !isset($council_resolution_grid->ActionDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcouncil_resolutiongrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fcouncil_resolutiongrid", "x<?php echo $council_resolution_grid->RowIndex ?>_ActionDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="council_resolution" data-field="x_ActionDate" name="o<?php echo $council_resolution_grid->RowIndex ?>_ActionDate" id="o<?php echo $council_resolution_grid->RowIndex ?>_ActionDate" value="<?php echo HtmlEncode($council_resolution_grid->ActionDate->OldValue) ?>">
<?php } ?>
<?php if ($council_resolution->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_ActionDate" class="form-group">
<input type="text" data-table="council_resolution" data-field="x_ActionDate" name="x<?php echo $council_resolution_grid->RowIndex ?>_ActionDate" id="x<?php echo $council_resolution_grid->RowIndex ?>_ActionDate" placeholder="<?php echo HtmlEncode($council_resolution_grid->ActionDate->getPlaceHolder()) ?>" value="<?php echo $council_resolution_grid->ActionDate->EditValue ?>"<?php echo $council_resolution_grid->ActionDate->editAttributes() ?>>
<?php if (!$council_resolution_grid->ActionDate->ReadOnly && !$council_resolution_grid->ActionDate->Disabled && !isset($council_resolution_grid->ActionDate->EditAttrs["readonly"]) && !isset($council_resolution_grid->ActionDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcouncil_resolutiongrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fcouncil_resolutiongrid", "x<?php echo $council_resolution_grid->RowIndex ?>_ActionDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($council_resolution->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $council_resolution_grid->RowCount ?>_council_resolution_ActionDate">
<span<?php echo $council_resolution_grid->ActionDate->viewAttributes() ?>><?php echo $council_resolution_grid->ActionDate->getViewValue() ?></span>
</span>
<?php if (!$council_resolution->isConfirm()) { ?>
<input type="hidden" data-table="council_resolution" data-field="x_ActionDate" name="x<?php echo $council_resolution_grid->RowIndex ?>_ActionDate" id="x<?php echo $council_resolution_grid->RowIndex ?>_ActionDate" value="<?php echo HtmlEncode($council_resolution_grid->ActionDate->FormValue) ?>">
<input type="hidden" data-table="council_resolution" data-field="x_ActionDate" name="o<?php echo $council_resolution_grid->RowIndex ?>_ActionDate" id="o<?php echo $council_resolution_grid->RowIndex ?>_ActionDate" value="<?php echo HtmlEncode($council_resolution_grid->ActionDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="council_resolution" data-field="x_ActionDate" name="fcouncil_resolutiongrid$x<?php echo $council_resolution_grid->RowIndex ?>_ActionDate" id="fcouncil_resolutiongrid$x<?php echo $council_resolution_grid->RowIndex ?>_ActionDate" value="<?php echo HtmlEncode($council_resolution_grid->ActionDate->FormValue) ?>">
<input type="hidden" data-table="council_resolution" data-field="x_ActionDate" name="fcouncil_resolutiongrid$o<?php echo $council_resolution_grid->RowIndex ?>_ActionDate" id="fcouncil_resolutiongrid$o<?php echo $council_resolution_grid->RowIndex ?>_ActionDate" value="<?php echo HtmlEncode($council_resolution_grid->ActionDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$council_resolution_grid->ListOptions->render("body", "right", $council_resolution_grid->RowCount);
?>
	</tr>
<?php if ($council_resolution->RowType == ROWTYPE_ADD || $council_resolution->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fcouncil_resolutiongrid", "load"], function() {
	fcouncil_resolutiongrid.updateLists(<?php echo $council_resolution_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$council_resolution_grid->isGridAdd() || $council_resolution->CurrentMode == "copy")
		if (!$council_resolution_grid->Recordset->EOF)
			$council_resolution_grid->Recordset->moveNext();
}
?>
<?php
	if ($council_resolution->CurrentMode == "add" || $council_resolution->CurrentMode == "copy" || $council_resolution->CurrentMode == "edit") {
		$council_resolution_grid->RowIndex = '$rowindex$';
		$council_resolution_grid->loadRowValues();

		// Set row properties
		$council_resolution->resetAttributes();
		$council_resolution->RowAttrs->merge(["data-rowindex" => $council_resolution_grid->RowIndex, "id" => "r0_council_resolution", "data-rowtype" => ROWTYPE_ADD]);
		$council_resolution->RowAttrs->appendClass("ew-template");
		$council_resolution->RowType = ROWTYPE_ADD;

		// Render row
		$council_resolution_grid->renderRow();

		// Render list options
		$council_resolution_grid->renderListOptions();
		$council_resolution_grid->StartRowCount = 0;
?>
	<tr <?php echo $council_resolution->rowAttributes() ?>>
<?php

// Render list options (body, left)
$council_resolution_grid->ListOptions->render("body", "left", $council_resolution_grid->RowIndex);
?>
	<?php if ($council_resolution_grid->MeetingNo->Visible) { // MeetingNo ?>
		<td data-name="MeetingNo">
<?php if (!$council_resolution->isConfirm()) { ?>
<?php if ($council_resolution_grid->MeetingNo->getSessionValue() != "") { ?>
<span id="el$rowindex$_council_resolution_MeetingNo" class="form-group council_resolution_MeetingNo">
<span<?php echo $council_resolution_grid->MeetingNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_resolution_grid->MeetingNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" name="x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" value="<?php echo HtmlEncode($council_resolution_grid->MeetingNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_council_resolution_MeetingNo" class="form-group council_resolution_MeetingNo">
<?php
$onchange = $council_resolution_grid->MeetingNo->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$council_resolution_grid->MeetingNo->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo">
	<input type="text" class="form-control" name="sv_x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" id="sv_x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" value="<?php echo RemoveHtml($council_resolution_grid->MeetingNo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($council_resolution_grid->MeetingNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($council_resolution_grid->MeetingNo->getPlaceHolder()) ?>"<?php echo $council_resolution_grid->MeetingNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="council_resolution" data-field="x_MeetingNo" data-value-separator="<?php echo $council_resolution_grid->MeetingNo->displayValueSeparatorAttribute() ?>" name="x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" id="x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" value="<?php echo HtmlEncode($council_resolution_grid->MeetingNo->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncil_resolutiongrid"], function() {
	fcouncil_resolutiongrid.createAutoSuggest({"id":"x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo","forceSelect":false});
});
</script>
<?php echo $council_resolution_grid->MeetingNo->Lookup->getParamTag($council_resolution_grid, "p_x" . $council_resolution_grid->RowIndex . "_MeetingNo") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_council_resolution_MeetingNo" class="form-group council_resolution_MeetingNo">
<span<?php echo $council_resolution_grid->MeetingNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_resolution_grid->MeetingNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="council_resolution" data-field="x_MeetingNo" name="x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" id="x<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" value="<?php echo HtmlEncode($council_resolution_grid->MeetingNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="council_resolution" data-field="x_MeetingNo" name="o<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" id="o<?php echo $council_resolution_grid->RowIndex ?>_MeetingNo" value="<?php echo HtmlEncode($council_resolution_grid->MeetingNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($council_resolution_grid->MinuteNumber->Visible) { // MinuteNumber ?>
		<td data-name="MinuteNumber">
<?php if (!$council_resolution->isConfirm()) { ?>
<span id="el$rowindex$_council_resolution_MinuteNumber" class="form-group council_resolution_MinuteNumber">
<input type="text" data-table="council_resolution" data-field="x_MinuteNumber" name="x<?php echo $council_resolution_grid->RowIndex ?>_MinuteNumber" id="x<?php echo $council_resolution_grid->RowIndex ?>_MinuteNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($council_resolution_grid->MinuteNumber->getPlaceHolder()) ?>" value="<?php echo $council_resolution_grid->MinuteNumber->EditValue ?>"<?php echo $council_resolution_grid->MinuteNumber->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_council_resolution_MinuteNumber" class="form-group council_resolution_MinuteNumber">
<span<?php echo $council_resolution_grid->MinuteNumber->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_resolution_grid->MinuteNumber->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="council_resolution" data-field="x_MinuteNumber" name="x<?php echo $council_resolution_grid->RowIndex ?>_MinuteNumber" id="x<?php echo $council_resolution_grid->RowIndex ?>_MinuteNumber" value="<?php echo HtmlEncode($council_resolution_grid->MinuteNumber->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="council_resolution" data-field="x_MinuteNumber" name="o<?php echo $council_resolution_grid->RowIndex ?>_MinuteNumber" id="o<?php echo $council_resolution_grid->RowIndex ?>_MinuteNumber" value="<?php echo HtmlEncode($council_resolution_grid->MinuteNumber->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($council_resolution_grid->Resolutionccategory->Visible) { // Resolutionccategory ?>
		<td data-name="Resolutionccategory">
<?php if (!$council_resolution->isConfirm()) { ?>
<span id="el$rowindex$_council_resolution_Resolutionccategory" class="form-group council_resolution_Resolutionccategory">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="council_resolution" data-field="x_Resolutionccategory" data-value-separator="<?php echo $council_resolution_grid->Resolutionccategory->displayValueSeparatorAttribute() ?>" id="x<?php echo $council_resolution_grid->RowIndex ?>_Resolutionccategory" name="x<?php echo $council_resolution_grid->RowIndex ?>_Resolutionccategory"<?php echo $council_resolution_grid->Resolutionccategory->editAttributes() ?>>
			<?php echo $council_resolution_grid->Resolutionccategory->selectOptionListHtml("x{$council_resolution_grid->RowIndex}_Resolutionccategory") ?>
		</select>
</div>
<?php echo $council_resolution_grid->Resolutionccategory->Lookup->getParamTag($council_resolution_grid, "p_x" . $council_resolution_grid->RowIndex . "_Resolutionccategory") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_council_resolution_Resolutionccategory" class="form-group council_resolution_Resolutionccategory">
<span<?php echo $council_resolution_grid->Resolutionccategory->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_resolution_grid->Resolutionccategory->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="council_resolution" data-field="x_Resolutionccategory" name="x<?php echo $council_resolution_grid->RowIndex ?>_Resolutionccategory" id="x<?php echo $council_resolution_grid->RowIndex ?>_Resolutionccategory" value="<?php echo HtmlEncode($council_resolution_grid->Resolutionccategory->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="council_resolution" data-field="x_Resolutionccategory" name="o<?php echo $council_resolution_grid->RowIndex ?>_Resolutionccategory" id="o<?php echo $council_resolution_grid->RowIndex ?>_Resolutionccategory" value="<?php echo HtmlEncode($council_resolution_grid->Resolutionccategory->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($council_resolution_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if (!$council_resolution->isConfirm()) { ?>
<?php if ($council_resolution_grid->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_council_resolution_LACode" class="form-group council_resolution_LACode">
<span<?php echo $council_resolution_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_resolution_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $council_resolution_grid->RowIndex ?>_LACode" name="x<?php echo $council_resolution_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_resolution_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_council_resolution_LACode" class="form-group council_resolution_LACode">
<?php
$onchange = $council_resolution_grid->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$council_resolution_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $council_resolution_grid->RowIndex ?>_LACode">
	<input type="text" class="form-control" name="sv_x<?php echo $council_resolution_grid->RowIndex ?>_LACode" id="sv_x<?php echo $council_resolution_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($council_resolution_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($council_resolution_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($council_resolution_grid->LACode->getPlaceHolder()) ?>"<?php echo $council_resolution_grid->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="council_resolution" data-field="x_LACode" data-value-separator="<?php echo $council_resolution_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $council_resolution_grid->RowIndex ?>_LACode" id="x<?php echo $council_resolution_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_resolution_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncil_resolutiongrid"], function() {
	fcouncil_resolutiongrid.createAutoSuggest({"id":"x<?php echo $council_resolution_grid->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $council_resolution_grid->LACode->Lookup->getParamTag($council_resolution_grid, "p_x" . $council_resolution_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_council_resolution_LACode" class="form-group council_resolution_LACode">
<span<?php echo $council_resolution_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_resolution_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="council_resolution" data-field="x_LACode" name="x<?php echo $council_resolution_grid->RowIndex ?>_LACode" id="x<?php echo $council_resolution_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_resolution_grid->LACode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="council_resolution" data-field="x_LACode" name="o<?php echo $council_resolution_grid->RowIndex ?>_LACode" id="o<?php echo $council_resolution_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($council_resolution_grid->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($council_resolution_grid->ResolutionNo->Visible) { // ResolutionNo ?>
		<td data-name="ResolutionNo">
<?php if (!$council_resolution->isConfirm()) { ?>
<span id="el$rowindex$_council_resolution_ResolutionNo" class="form-group council_resolution_ResolutionNo"></span>
<?php } else { ?>
<span id="el$rowindex$_council_resolution_ResolutionNo" class="form-group council_resolution_ResolutionNo">
<span<?php echo $council_resolution_grid->ResolutionNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_resolution_grid->ResolutionNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="council_resolution" data-field="x_ResolutionNo" name="x<?php echo $council_resolution_grid->RowIndex ?>_ResolutionNo" id="x<?php echo $council_resolution_grid->RowIndex ?>_ResolutionNo" value="<?php echo HtmlEncode($council_resolution_grid->ResolutionNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="council_resolution" data-field="x_ResolutionNo" name="o<?php echo $council_resolution_grid->RowIndex ?>_ResolutionNo" id="o<?php echo $council_resolution_grid->RowIndex ?>_ResolutionNo" value="<?php echo HtmlEncode($council_resolution_grid->ResolutionNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($council_resolution_grid->Responsibility->Visible) { // Responsibility ?>
		<td data-name="Responsibility">
<?php if (!$council_resolution->isConfirm()) { ?>
<span id="el$rowindex$_council_resolution_Responsibility" class="form-group council_resolution_Responsibility">
<input type="text" data-table="council_resolution" data-field="x_Responsibility" name="x<?php echo $council_resolution_grid->RowIndex ?>_Responsibility" id="x<?php echo $council_resolution_grid->RowIndex ?>_Responsibility" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($council_resolution_grid->Responsibility->getPlaceHolder()) ?>" value="<?php echo $council_resolution_grid->Responsibility->EditValue ?>"<?php echo $council_resolution_grid->Responsibility->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_council_resolution_Responsibility" class="form-group council_resolution_Responsibility">
<span<?php echo $council_resolution_grid->Responsibility->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_resolution_grid->Responsibility->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="council_resolution" data-field="x_Responsibility" name="x<?php echo $council_resolution_grid->RowIndex ?>_Responsibility" id="x<?php echo $council_resolution_grid->RowIndex ?>_Responsibility" value="<?php echo HtmlEncode($council_resolution_grid->Responsibility->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="council_resolution" data-field="x_Responsibility" name="o<?php echo $council_resolution_grid->RowIndex ?>_Responsibility" id="o<?php echo $council_resolution_grid->RowIndex ?>_Responsibility" value="<?php echo HtmlEncode($council_resolution_grid->Responsibility->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($council_resolution_grid->ActionDate->Visible) { // ActionDate ?>
		<td data-name="ActionDate">
<?php if (!$council_resolution->isConfirm()) { ?>
<span id="el$rowindex$_council_resolution_ActionDate" class="form-group council_resolution_ActionDate">
<input type="text" data-table="council_resolution" data-field="x_ActionDate" name="x<?php echo $council_resolution_grid->RowIndex ?>_ActionDate" id="x<?php echo $council_resolution_grid->RowIndex ?>_ActionDate" placeholder="<?php echo HtmlEncode($council_resolution_grid->ActionDate->getPlaceHolder()) ?>" value="<?php echo $council_resolution_grid->ActionDate->EditValue ?>"<?php echo $council_resolution_grid->ActionDate->editAttributes() ?>>
<?php if (!$council_resolution_grid->ActionDate->ReadOnly && !$council_resolution_grid->ActionDate->Disabled && !isset($council_resolution_grid->ActionDate->EditAttrs["readonly"]) && !isset($council_resolution_grid->ActionDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcouncil_resolutiongrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fcouncil_resolutiongrid", "x<?php echo $council_resolution_grid->RowIndex ?>_ActionDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_council_resolution_ActionDate" class="form-group council_resolution_ActionDate">
<span<?php echo $council_resolution_grid->ActionDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_resolution_grid->ActionDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="council_resolution" data-field="x_ActionDate" name="x<?php echo $council_resolution_grid->RowIndex ?>_ActionDate" id="x<?php echo $council_resolution_grid->RowIndex ?>_ActionDate" value="<?php echo HtmlEncode($council_resolution_grid->ActionDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="council_resolution" data-field="x_ActionDate" name="o<?php echo $council_resolution_grid->RowIndex ?>_ActionDate" id="o<?php echo $council_resolution_grid->RowIndex ?>_ActionDate" value="<?php echo HtmlEncode($council_resolution_grid->ActionDate->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$council_resolution_grid->ListOptions->render("body", "right", $council_resolution_grid->RowIndex);
?>
<script>
loadjs.ready(["fcouncil_resolutiongrid", "load"], function() {
	fcouncil_resolutiongrid.updateLists(<?php echo $council_resolution_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($council_resolution->CurrentMode == "add" || $council_resolution->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $council_resolution_grid->FormKeyCountName ?>" id="<?php echo $council_resolution_grid->FormKeyCountName ?>" value="<?php echo $council_resolution_grid->KeyCount ?>">
<?php echo $council_resolution_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($council_resolution->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $council_resolution_grid->FormKeyCountName ?>" id="<?php echo $council_resolution_grid->FormKeyCountName ?>" value="<?php echo $council_resolution_grid->KeyCount ?>">
<?php echo $council_resolution_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($council_resolution->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcouncil_resolutiongrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($council_resolution_grid->Recordset)
	$council_resolution_grid->Recordset->Close();
?>
<?php if ($council_resolution_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $council_resolution_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($council_resolution_grid->TotalRecords == 0 && !$council_resolution->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $council_resolution_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$council_resolution_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$council_resolution_grid->terminate();
?>