<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($ticketmessage_grid))
	$ticketmessage_grid = new ticketmessage_grid();

// Run the page
$ticketmessage_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticketmessage_grid->Page_Render();
?>
<?php if (!$ticketmessage_grid->isExport()) { ?>
<script>
var fticketmessagegrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fticketmessagegrid = new ew.Form("fticketmessagegrid", "grid");
	fticketmessagegrid.formKeyCountName = '<?php echo $ticketmessage_grid->FormKeyCountName ?>';

	// Validate form
	fticketmessagegrid.validate = function() {
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
			<?php if ($ticketmessage_grid->TicketNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticketmessage_grid->TicketNumber->caption(), $ticketmessage_grid->TicketNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TicketNumber");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticketmessage_grid->TicketNumber->errorMessage()) ?>");
			<?php if ($ticketmessage_grid->MessageNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_MessageNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticketmessage_grid->MessageNumber->caption(), $ticketmessage_grid->MessageNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticketmessage_grid->MessageBy->Required) { ?>
				elm = this.getElements("x" + infix + "_MessageBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticketmessage_grid->MessageBy->caption(), $ticketmessage_grid->MessageBy->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MessageBy");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticketmessage_grid->MessageBy->errorMessage()) ?>");
			<?php if ($ticketmessage_grid->Subject->Required) { ?>
				elm = this.getElements("x" + infix + "_Subject");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticketmessage_grid->Subject->caption(), $ticketmessage_grid->Subject->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticketmessage_grid->Message->Required) { ?>
				elm = this.getElements("x" + infix + "_Message");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticketmessage_grid->Message->caption(), $ticketmessage_grid->Message->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticketmessage_grid->MessageDate->Required) { ?>
				elm = this.getElements("x" + infix + "_MessageDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticketmessage_grid->MessageDate->caption(), $ticketmessage_grid->MessageDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MessageDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticketmessage_grid->MessageDate->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fticketmessagegrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "TicketNumber", false)) return false;
		if (ew.valueChanged(fobj, infix, "MessageBy", false)) return false;
		if (ew.valueChanged(fobj, infix, "Subject", false)) return false;
		if (ew.valueChanged(fobj, infix, "Message", false)) return false;
		if (ew.valueChanged(fobj, infix, "MessageDate", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fticketmessagegrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fticketmessagegrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fticketmessagegrid");
});
</script>
<?php } ?>
<?php
$ticketmessage_grid->renderOtherOptions();
?>
<?php if ($ticketmessage_grid->TotalRecords > 0 || $ticketmessage->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ticketmessage_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ticketmessage">
<?php if ($ticketmessage_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $ticketmessage_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fticketmessagegrid" class="ew-form ew-list-form form-inline">
<div id="gmp_ticketmessage" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_ticketmessagegrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ticketmessage->RowType = ROWTYPE_HEADER;

// Render list options
$ticketmessage_grid->renderListOptions();

// Render list options (header, left)
$ticketmessage_grid->ListOptions->render("header", "left");
?>
<?php if ($ticketmessage_grid->TicketNumber->Visible) { // TicketNumber ?>
	<?php if ($ticketmessage_grid->SortUrl($ticketmessage_grid->TicketNumber) == "") { ?>
		<th data-name="TicketNumber" class="<?php echo $ticketmessage_grid->TicketNumber->headerCellClass() ?>"><div id="elh_ticketmessage_TicketNumber" class="ticketmessage_TicketNumber"><div class="ew-table-header-caption"><?php echo $ticketmessage_grid->TicketNumber->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TicketNumber" class="<?php echo $ticketmessage_grid->TicketNumber->headerCellClass() ?>"><div><div id="elh_ticketmessage_TicketNumber" class="ticketmessage_TicketNumber">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticketmessage_grid->TicketNumber->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticketmessage_grid->TicketNumber->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticketmessage_grid->TicketNumber->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticketmessage_grid->MessageNumber->Visible) { // MessageNumber ?>
	<?php if ($ticketmessage_grid->SortUrl($ticketmessage_grid->MessageNumber) == "") { ?>
		<th data-name="MessageNumber" class="<?php echo $ticketmessage_grid->MessageNumber->headerCellClass() ?>"><div id="elh_ticketmessage_MessageNumber" class="ticketmessage_MessageNumber"><div class="ew-table-header-caption"><?php echo $ticketmessage_grid->MessageNumber->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MessageNumber" class="<?php echo $ticketmessage_grid->MessageNumber->headerCellClass() ?>"><div><div id="elh_ticketmessage_MessageNumber" class="ticketmessage_MessageNumber">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticketmessage_grid->MessageNumber->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticketmessage_grid->MessageNumber->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticketmessage_grid->MessageNumber->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticketmessage_grid->MessageBy->Visible) { // MessageBy ?>
	<?php if ($ticketmessage_grid->SortUrl($ticketmessage_grid->MessageBy) == "") { ?>
		<th data-name="MessageBy" class="<?php echo $ticketmessage_grid->MessageBy->headerCellClass() ?>"><div id="elh_ticketmessage_MessageBy" class="ticketmessage_MessageBy"><div class="ew-table-header-caption"><?php echo $ticketmessage_grid->MessageBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MessageBy" class="<?php echo $ticketmessage_grid->MessageBy->headerCellClass() ?>"><div><div id="elh_ticketmessage_MessageBy" class="ticketmessage_MessageBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticketmessage_grid->MessageBy->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticketmessage_grid->MessageBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticketmessage_grid->MessageBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticketmessage_grid->Subject->Visible) { // Subject ?>
	<?php if ($ticketmessage_grid->SortUrl($ticketmessage_grid->Subject) == "") { ?>
		<th data-name="Subject" class="<?php echo $ticketmessage_grid->Subject->headerCellClass() ?>"><div id="elh_ticketmessage_Subject" class="ticketmessage_Subject"><div class="ew-table-header-caption"><?php echo $ticketmessage_grid->Subject->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Subject" class="<?php echo $ticketmessage_grid->Subject->headerCellClass() ?>"><div><div id="elh_ticketmessage_Subject" class="ticketmessage_Subject">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticketmessage_grid->Subject->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticketmessage_grid->Subject->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticketmessage_grid->Subject->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticketmessage_grid->Message->Visible) { // Message ?>
	<?php if ($ticketmessage_grid->SortUrl($ticketmessage_grid->Message) == "") { ?>
		<th data-name="Message" class="<?php echo $ticketmessage_grid->Message->headerCellClass() ?>"><div id="elh_ticketmessage_Message" class="ticketmessage_Message"><div class="ew-table-header-caption"><?php echo $ticketmessage_grid->Message->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Message" class="<?php echo $ticketmessage_grid->Message->headerCellClass() ?>"><div><div id="elh_ticketmessage_Message" class="ticketmessage_Message">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticketmessage_grid->Message->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticketmessage_grid->Message->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticketmessage_grid->Message->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticketmessage_grid->MessageDate->Visible) { // MessageDate ?>
	<?php if ($ticketmessage_grid->SortUrl($ticketmessage_grid->MessageDate) == "") { ?>
		<th data-name="MessageDate" class="<?php echo $ticketmessage_grid->MessageDate->headerCellClass() ?>"><div id="elh_ticketmessage_MessageDate" class="ticketmessage_MessageDate"><div class="ew-table-header-caption"><?php echo $ticketmessage_grid->MessageDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MessageDate" class="<?php echo $ticketmessage_grid->MessageDate->headerCellClass() ?>"><div><div id="elh_ticketmessage_MessageDate" class="ticketmessage_MessageDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticketmessage_grid->MessageDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticketmessage_grid->MessageDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticketmessage_grid->MessageDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ticketmessage_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$ticketmessage_grid->StartRecord = 1;
$ticketmessage_grid->StopRecord = $ticketmessage_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($ticketmessage->isConfirm() || $ticketmessage_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($ticketmessage_grid->FormKeyCountName) && ($ticketmessage_grid->isGridAdd() || $ticketmessage_grid->isGridEdit() || $ticketmessage->isConfirm())) {
		$ticketmessage_grid->KeyCount = $CurrentForm->getValue($ticketmessage_grid->FormKeyCountName);
		$ticketmessage_grid->StopRecord = $ticketmessage_grid->StartRecord + $ticketmessage_grid->KeyCount - 1;
	}
}
$ticketmessage_grid->RecordCount = $ticketmessage_grid->StartRecord - 1;
if ($ticketmessage_grid->Recordset && !$ticketmessage_grid->Recordset->EOF) {
	$ticketmessage_grid->Recordset->moveFirst();
	$selectLimit = $ticketmessage_grid->UseSelectLimit;
	if (!$selectLimit && $ticketmessage_grid->StartRecord > 1)
		$ticketmessage_grid->Recordset->move($ticketmessage_grid->StartRecord - 1);
} elseif (!$ticketmessage->AllowAddDeleteRow && $ticketmessage_grid->StopRecord == 0) {
	$ticketmessage_grid->StopRecord = $ticketmessage->GridAddRowCount;
}

// Initialize aggregate
$ticketmessage->RowType = ROWTYPE_AGGREGATEINIT;
$ticketmessage->resetAttributes();
$ticketmessage_grid->renderRow();
if ($ticketmessage_grid->isGridAdd())
	$ticketmessage_grid->RowIndex = 0;
if ($ticketmessage_grid->isGridEdit())
	$ticketmessage_grid->RowIndex = 0;
while ($ticketmessage_grid->RecordCount < $ticketmessage_grid->StopRecord) {
	$ticketmessage_grid->RecordCount++;
	if ($ticketmessage_grid->RecordCount >= $ticketmessage_grid->StartRecord) {
		$ticketmessage_grid->RowCount++;
		if ($ticketmessage_grid->isGridAdd() || $ticketmessage_grid->isGridEdit() || $ticketmessage->isConfirm()) {
			$ticketmessage_grid->RowIndex++;
			$CurrentForm->Index = $ticketmessage_grid->RowIndex;
			if ($CurrentForm->hasValue($ticketmessage_grid->FormActionName) && ($ticketmessage->isConfirm() || $ticketmessage_grid->EventCancelled))
				$ticketmessage_grid->RowAction = strval($CurrentForm->getValue($ticketmessage_grid->FormActionName));
			elseif ($ticketmessage_grid->isGridAdd())
				$ticketmessage_grid->RowAction = "insert";
			else
				$ticketmessage_grid->RowAction = "";
		}

		// Set up key count
		$ticketmessage_grid->KeyCount = $ticketmessage_grid->RowIndex;

		// Init row class and style
		$ticketmessage->resetAttributes();
		$ticketmessage->CssClass = "";
		if ($ticketmessage_grid->isGridAdd()) {
			if ($ticketmessage->CurrentMode == "copy") {
				$ticketmessage_grid->loadRowValues($ticketmessage_grid->Recordset); // Load row values
				$ticketmessage_grid->setRecordKey($ticketmessage_grid->RowOldKey, $ticketmessage_grid->Recordset); // Set old record key
			} else {
				$ticketmessage_grid->loadRowValues(); // Load default values
				$ticketmessage_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$ticketmessage_grid->loadRowValues($ticketmessage_grid->Recordset); // Load row values
		}
		$ticketmessage->RowType = ROWTYPE_VIEW; // Render view
		if ($ticketmessage_grid->isGridAdd()) // Grid add
			$ticketmessage->RowType = ROWTYPE_ADD; // Render add
		if ($ticketmessage_grid->isGridAdd() && $ticketmessage->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$ticketmessage_grid->restoreCurrentRowFormValues($ticketmessage_grid->RowIndex); // Restore form values
		if ($ticketmessage_grid->isGridEdit()) { // Grid edit
			if ($ticketmessage->EventCancelled)
				$ticketmessage_grid->restoreCurrentRowFormValues($ticketmessage_grid->RowIndex); // Restore form values
			if ($ticketmessage_grid->RowAction == "insert")
				$ticketmessage->RowType = ROWTYPE_ADD; // Render add
			else
				$ticketmessage->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($ticketmessage_grid->isGridEdit() && ($ticketmessage->RowType == ROWTYPE_EDIT || $ticketmessage->RowType == ROWTYPE_ADD) && $ticketmessage->EventCancelled) // Update failed
			$ticketmessage_grid->restoreCurrentRowFormValues($ticketmessage_grid->RowIndex); // Restore form values
		if ($ticketmessage->RowType == ROWTYPE_EDIT) // Edit row
			$ticketmessage_grid->EditRowCount++;
		if ($ticketmessage->isConfirm()) // Confirm row
			$ticketmessage_grid->restoreCurrentRowFormValues($ticketmessage_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$ticketmessage->RowAttrs->merge(["data-rowindex" => $ticketmessage_grid->RowCount, "id" => "r" . $ticketmessage_grid->RowCount . "_ticketmessage", "data-rowtype" => $ticketmessage->RowType]);

		// Render row
		$ticketmessage_grid->renderRow();

		// Render list options
		$ticketmessage_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($ticketmessage_grid->RowAction != "delete" && $ticketmessage_grid->RowAction != "insertdelete" && !($ticketmessage_grid->RowAction == "insert" && $ticketmessage->isConfirm() && $ticketmessage_grid->emptyRow())) {
?>
	<tr <?php echo $ticketmessage->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ticketmessage_grid->ListOptions->render("body", "left", $ticketmessage_grid->RowCount);
?>
	<?php if ($ticketmessage_grid->TicketNumber->Visible) { // TicketNumber ?>
		<td data-name="TicketNumber" <?php echo $ticketmessage_grid->TicketNumber->cellAttributes() ?>>
<?php if ($ticketmessage->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($ticketmessage_grid->TicketNumber->getSessionValue() != "") { ?>
<span id="el<?php echo $ticketmessage_grid->RowCount ?>_ticketmessage_TicketNumber" class="form-group">
<span<?php echo $ticketmessage_grid->TicketNumber->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ticketmessage_grid->TicketNumber->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" name="x<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" value="<?php echo HtmlEncode($ticketmessage_grid->TicketNumber->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $ticketmessage_grid->RowCount ?>_ticketmessage_TicketNumber" class="form-group">
<input type="text" data-table="ticketmessage" data-field="x_TicketNumber" name="x<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" id="x<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" size="30" placeholder="<?php echo HtmlEncode($ticketmessage_grid->TicketNumber->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_grid->TicketNumber->EditValue ?>"<?php echo $ticketmessage_grid->TicketNumber->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="ticketmessage" data-field="x_TicketNumber" name="o<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" id="o<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" value="<?php echo HtmlEncode($ticketmessage_grid->TicketNumber->OldValue) ?>">
<?php } ?>
<?php if ($ticketmessage->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($ticketmessage_grid->TicketNumber->getSessionValue() != "") { ?>
<span id="el<?php echo $ticketmessage_grid->RowCount ?>_ticketmessage_TicketNumber" class="form-group">
<span<?php echo $ticketmessage_grid->TicketNumber->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ticketmessage_grid->TicketNumber->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" name="x<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" value="<?php echo HtmlEncode($ticketmessage_grid->TicketNumber->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $ticketmessage_grid->RowCount ?>_ticketmessage_TicketNumber" class="form-group">
<input type="text" data-table="ticketmessage" data-field="x_TicketNumber" name="x<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" id="x<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" size="30" placeholder="<?php echo HtmlEncode($ticketmessage_grid->TicketNumber->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_grid->TicketNumber->EditValue ?>"<?php echo $ticketmessage_grid->TicketNumber->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($ticketmessage->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ticketmessage_grid->RowCount ?>_ticketmessage_TicketNumber">
<span<?php echo $ticketmessage_grid->TicketNumber->viewAttributes() ?>><?php echo $ticketmessage_grid->TicketNumber->getViewValue() ?></span>
</span>
<?php if (!$ticketmessage->isConfirm()) { ?>
<input type="hidden" data-table="ticketmessage" data-field="x_TicketNumber" name="x<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" id="x<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" value="<?php echo HtmlEncode($ticketmessage_grid->TicketNumber->FormValue) ?>">
<input type="hidden" data-table="ticketmessage" data-field="x_TicketNumber" name="o<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" id="o<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" value="<?php echo HtmlEncode($ticketmessage_grid->TicketNumber->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ticketmessage" data-field="x_TicketNumber" name="fticketmessagegrid$x<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" id="fticketmessagegrid$x<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" value="<?php echo HtmlEncode($ticketmessage_grid->TicketNumber->FormValue) ?>">
<input type="hidden" data-table="ticketmessage" data-field="x_TicketNumber" name="fticketmessagegrid$o<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" id="fticketmessagegrid$o<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" value="<?php echo HtmlEncode($ticketmessage_grid->TicketNumber->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ticketmessage_grid->MessageNumber->Visible) { // MessageNumber ?>
		<td data-name="MessageNumber" <?php echo $ticketmessage_grid->MessageNumber->cellAttributes() ?>>
<?php if ($ticketmessage->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ticketmessage_grid->RowCount ?>_ticketmessage_MessageNumber" class="form-group"></span>
<input type="hidden" data-table="ticketmessage" data-field="x_MessageNumber" name="o<?php echo $ticketmessage_grid->RowIndex ?>_MessageNumber" id="o<?php echo $ticketmessage_grid->RowIndex ?>_MessageNumber" value="<?php echo HtmlEncode($ticketmessage_grid->MessageNumber->OldValue) ?>">
<?php } ?>
<?php if ($ticketmessage->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ticketmessage_grid->RowCount ?>_ticketmessage_MessageNumber" class="form-group">
<span<?php echo $ticketmessage_grid->MessageNumber->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ticketmessage_grid->MessageNumber->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ticketmessage" data-field="x_MessageNumber" name="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageNumber" id="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageNumber" value="<?php echo HtmlEncode($ticketmessage_grid->MessageNumber->CurrentValue) ?>">
<?php } ?>
<?php if ($ticketmessage->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ticketmessage_grid->RowCount ?>_ticketmessage_MessageNumber">
<span<?php echo $ticketmessage_grid->MessageNumber->viewAttributes() ?>><?php echo $ticketmessage_grid->MessageNumber->getViewValue() ?></span>
</span>
<?php if (!$ticketmessage->isConfirm()) { ?>
<input type="hidden" data-table="ticketmessage" data-field="x_MessageNumber" name="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageNumber" id="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageNumber" value="<?php echo HtmlEncode($ticketmessage_grid->MessageNumber->FormValue) ?>">
<input type="hidden" data-table="ticketmessage" data-field="x_MessageNumber" name="o<?php echo $ticketmessage_grid->RowIndex ?>_MessageNumber" id="o<?php echo $ticketmessage_grid->RowIndex ?>_MessageNumber" value="<?php echo HtmlEncode($ticketmessage_grid->MessageNumber->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ticketmessage" data-field="x_MessageNumber" name="fticketmessagegrid$x<?php echo $ticketmessage_grid->RowIndex ?>_MessageNumber" id="fticketmessagegrid$x<?php echo $ticketmessage_grid->RowIndex ?>_MessageNumber" value="<?php echo HtmlEncode($ticketmessage_grid->MessageNumber->FormValue) ?>">
<input type="hidden" data-table="ticketmessage" data-field="x_MessageNumber" name="fticketmessagegrid$o<?php echo $ticketmessage_grid->RowIndex ?>_MessageNumber" id="fticketmessagegrid$o<?php echo $ticketmessage_grid->RowIndex ?>_MessageNumber" value="<?php echo HtmlEncode($ticketmessage_grid->MessageNumber->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ticketmessage_grid->MessageBy->Visible) { // MessageBy ?>
		<td data-name="MessageBy" <?php echo $ticketmessage_grid->MessageBy->cellAttributes() ?>>
<?php if ($ticketmessage->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ticketmessage_grid->RowCount ?>_ticketmessage_MessageBy" class="form-group">
<input type="text" data-table="ticketmessage" data-field="x_MessageBy" name="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageBy" id="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageBy" size="30" placeholder="<?php echo HtmlEncode($ticketmessage_grid->MessageBy->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_grid->MessageBy->EditValue ?>"<?php echo $ticketmessage_grid->MessageBy->editAttributes() ?>>
</span>
<input type="hidden" data-table="ticketmessage" data-field="x_MessageBy" name="o<?php echo $ticketmessage_grid->RowIndex ?>_MessageBy" id="o<?php echo $ticketmessage_grid->RowIndex ?>_MessageBy" value="<?php echo HtmlEncode($ticketmessage_grid->MessageBy->OldValue) ?>">
<?php } ?>
<?php if ($ticketmessage->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ticketmessage_grid->RowCount ?>_ticketmessage_MessageBy" class="form-group">
<input type="text" data-table="ticketmessage" data-field="x_MessageBy" name="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageBy" id="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageBy" size="30" placeholder="<?php echo HtmlEncode($ticketmessage_grid->MessageBy->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_grid->MessageBy->EditValue ?>"<?php echo $ticketmessage_grid->MessageBy->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ticketmessage->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ticketmessage_grid->RowCount ?>_ticketmessage_MessageBy">
<span<?php echo $ticketmessage_grid->MessageBy->viewAttributes() ?>><?php echo $ticketmessage_grid->MessageBy->getViewValue() ?></span>
</span>
<?php if (!$ticketmessage->isConfirm()) { ?>
<input type="hidden" data-table="ticketmessage" data-field="x_MessageBy" name="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageBy" id="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageBy" value="<?php echo HtmlEncode($ticketmessage_grid->MessageBy->FormValue) ?>">
<input type="hidden" data-table="ticketmessage" data-field="x_MessageBy" name="o<?php echo $ticketmessage_grid->RowIndex ?>_MessageBy" id="o<?php echo $ticketmessage_grid->RowIndex ?>_MessageBy" value="<?php echo HtmlEncode($ticketmessage_grid->MessageBy->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ticketmessage" data-field="x_MessageBy" name="fticketmessagegrid$x<?php echo $ticketmessage_grid->RowIndex ?>_MessageBy" id="fticketmessagegrid$x<?php echo $ticketmessage_grid->RowIndex ?>_MessageBy" value="<?php echo HtmlEncode($ticketmessage_grid->MessageBy->FormValue) ?>">
<input type="hidden" data-table="ticketmessage" data-field="x_MessageBy" name="fticketmessagegrid$o<?php echo $ticketmessage_grid->RowIndex ?>_MessageBy" id="fticketmessagegrid$o<?php echo $ticketmessage_grid->RowIndex ?>_MessageBy" value="<?php echo HtmlEncode($ticketmessage_grid->MessageBy->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ticketmessage_grid->Subject->Visible) { // Subject ?>
		<td data-name="Subject" <?php echo $ticketmessage_grid->Subject->cellAttributes() ?>>
<?php if ($ticketmessage->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ticketmessage_grid->RowCount ?>_ticketmessage_Subject" class="form-group">
<input type="text" data-table="ticketmessage" data-field="x_Subject" name="x<?php echo $ticketmessage_grid->RowIndex ?>_Subject" id="x<?php echo $ticketmessage_grid->RowIndex ?>_Subject" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ticketmessage_grid->Subject->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_grid->Subject->EditValue ?>"<?php echo $ticketmessage_grid->Subject->editAttributes() ?>>
</span>
<input type="hidden" data-table="ticketmessage" data-field="x_Subject" name="o<?php echo $ticketmessage_grid->RowIndex ?>_Subject" id="o<?php echo $ticketmessage_grid->RowIndex ?>_Subject" value="<?php echo HtmlEncode($ticketmessage_grid->Subject->OldValue) ?>">
<?php } ?>
<?php if ($ticketmessage->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ticketmessage_grid->RowCount ?>_ticketmessage_Subject" class="form-group">
<input type="text" data-table="ticketmessage" data-field="x_Subject" name="x<?php echo $ticketmessage_grid->RowIndex ?>_Subject" id="x<?php echo $ticketmessage_grid->RowIndex ?>_Subject" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ticketmessage_grid->Subject->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_grid->Subject->EditValue ?>"<?php echo $ticketmessage_grid->Subject->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ticketmessage->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ticketmessage_grid->RowCount ?>_ticketmessage_Subject">
<span<?php echo $ticketmessage_grid->Subject->viewAttributes() ?>><?php echo $ticketmessage_grid->Subject->getViewValue() ?></span>
</span>
<?php if (!$ticketmessage->isConfirm()) { ?>
<input type="hidden" data-table="ticketmessage" data-field="x_Subject" name="x<?php echo $ticketmessage_grid->RowIndex ?>_Subject" id="x<?php echo $ticketmessage_grid->RowIndex ?>_Subject" value="<?php echo HtmlEncode($ticketmessage_grid->Subject->FormValue) ?>">
<input type="hidden" data-table="ticketmessage" data-field="x_Subject" name="o<?php echo $ticketmessage_grid->RowIndex ?>_Subject" id="o<?php echo $ticketmessage_grid->RowIndex ?>_Subject" value="<?php echo HtmlEncode($ticketmessage_grid->Subject->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ticketmessage" data-field="x_Subject" name="fticketmessagegrid$x<?php echo $ticketmessage_grid->RowIndex ?>_Subject" id="fticketmessagegrid$x<?php echo $ticketmessage_grid->RowIndex ?>_Subject" value="<?php echo HtmlEncode($ticketmessage_grid->Subject->FormValue) ?>">
<input type="hidden" data-table="ticketmessage" data-field="x_Subject" name="fticketmessagegrid$o<?php echo $ticketmessage_grid->RowIndex ?>_Subject" id="fticketmessagegrid$o<?php echo $ticketmessage_grid->RowIndex ?>_Subject" value="<?php echo HtmlEncode($ticketmessage_grid->Subject->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ticketmessage_grid->Message->Visible) { // Message ?>
		<td data-name="Message" <?php echo $ticketmessage_grid->Message->cellAttributes() ?>>
<?php if ($ticketmessage->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ticketmessage_grid->RowCount ?>_ticketmessage_Message" class="form-group">
<input type="text" data-table="ticketmessage" data-field="x_Message" name="x<?php echo $ticketmessage_grid->RowIndex ?>_Message" id="x<?php echo $ticketmessage_grid->RowIndex ?>_Message" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ticketmessage_grid->Message->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_grid->Message->EditValue ?>"<?php echo $ticketmessage_grid->Message->editAttributes() ?>>
</span>
<input type="hidden" data-table="ticketmessage" data-field="x_Message" name="o<?php echo $ticketmessage_grid->RowIndex ?>_Message" id="o<?php echo $ticketmessage_grid->RowIndex ?>_Message" value="<?php echo HtmlEncode($ticketmessage_grid->Message->OldValue) ?>">
<?php } ?>
<?php if ($ticketmessage->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ticketmessage_grid->RowCount ?>_ticketmessage_Message" class="form-group">
<input type="text" data-table="ticketmessage" data-field="x_Message" name="x<?php echo $ticketmessage_grid->RowIndex ?>_Message" id="x<?php echo $ticketmessage_grid->RowIndex ?>_Message" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ticketmessage_grid->Message->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_grid->Message->EditValue ?>"<?php echo $ticketmessage_grid->Message->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ticketmessage->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ticketmessage_grid->RowCount ?>_ticketmessage_Message">
<span<?php echo $ticketmessage_grid->Message->viewAttributes() ?>><?php echo $ticketmessage_grid->Message->getViewValue() ?></span>
</span>
<?php if (!$ticketmessage->isConfirm()) { ?>
<input type="hidden" data-table="ticketmessage" data-field="x_Message" name="x<?php echo $ticketmessage_grid->RowIndex ?>_Message" id="x<?php echo $ticketmessage_grid->RowIndex ?>_Message" value="<?php echo HtmlEncode($ticketmessage_grid->Message->FormValue) ?>">
<input type="hidden" data-table="ticketmessage" data-field="x_Message" name="o<?php echo $ticketmessage_grid->RowIndex ?>_Message" id="o<?php echo $ticketmessage_grid->RowIndex ?>_Message" value="<?php echo HtmlEncode($ticketmessage_grid->Message->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ticketmessage" data-field="x_Message" name="fticketmessagegrid$x<?php echo $ticketmessage_grid->RowIndex ?>_Message" id="fticketmessagegrid$x<?php echo $ticketmessage_grid->RowIndex ?>_Message" value="<?php echo HtmlEncode($ticketmessage_grid->Message->FormValue) ?>">
<input type="hidden" data-table="ticketmessage" data-field="x_Message" name="fticketmessagegrid$o<?php echo $ticketmessage_grid->RowIndex ?>_Message" id="fticketmessagegrid$o<?php echo $ticketmessage_grid->RowIndex ?>_Message" value="<?php echo HtmlEncode($ticketmessage_grid->Message->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ticketmessage_grid->MessageDate->Visible) { // MessageDate ?>
		<td data-name="MessageDate" <?php echo $ticketmessage_grid->MessageDate->cellAttributes() ?>>
<?php if ($ticketmessage->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ticketmessage_grid->RowCount ?>_ticketmessage_MessageDate" class="form-group">
<input type="text" data-table="ticketmessage" data-field="x_MessageDate" name="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageDate" id="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageDate" placeholder="<?php echo HtmlEncode($ticketmessage_grid->MessageDate->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_grid->MessageDate->EditValue ?>"<?php echo $ticketmessage_grid->MessageDate->editAttributes() ?>>
<?php if (!$ticketmessage_grid->MessageDate->ReadOnly && !$ticketmessage_grid->MessageDate->Disabled && !isset($ticketmessage_grid->MessageDate->EditAttrs["readonly"]) && !isset($ticketmessage_grid->MessageDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fticketmessagegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fticketmessagegrid", "x<?php echo $ticketmessage_grid->RowIndex ?>_MessageDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="ticketmessage" data-field="x_MessageDate" name="o<?php echo $ticketmessage_grid->RowIndex ?>_MessageDate" id="o<?php echo $ticketmessage_grid->RowIndex ?>_MessageDate" value="<?php echo HtmlEncode($ticketmessage_grid->MessageDate->OldValue) ?>">
<?php } ?>
<?php if ($ticketmessage->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ticketmessage_grid->RowCount ?>_ticketmessage_MessageDate" class="form-group">
<input type="text" data-table="ticketmessage" data-field="x_MessageDate" name="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageDate" id="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageDate" placeholder="<?php echo HtmlEncode($ticketmessage_grid->MessageDate->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_grid->MessageDate->EditValue ?>"<?php echo $ticketmessage_grid->MessageDate->editAttributes() ?>>
<?php if (!$ticketmessage_grid->MessageDate->ReadOnly && !$ticketmessage_grid->MessageDate->Disabled && !isset($ticketmessage_grid->MessageDate->EditAttrs["readonly"]) && !isset($ticketmessage_grid->MessageDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fticketmessagegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fticketmessagegrid", "x<?php echo $ticketmessage_grid->RowIndex ?>_MessageDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($ticketmessage->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ticketmessage_grid->RowCount ?>_ticketmessage_MessageDate">
<span<?php echo $ticketmessage_grid->MessageDate->viewAttributes() ?>><?php echo $ticketmessage_grid->MessageDate->getViewValue() ?></span>
</span>
<?php if (!$ticketmessage->isConfirm()) { ?>
<input type="hidden" data-table="ticketmessage" data-field="x_MessageDate" name="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageDate" id="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageDate" value="<?php echo HtmlEncode($ticketmessage_grid->MessageDate->FormValue) ?>">
<input type="hidden" data-table="ticketmessage" data-field="x_MessageDate" name="o<?php echo $ticketmessage_grid->RowIndex ?>_MessageDate" id="o<?php echo $ticketmessage_grid->RowIndex ?>_MessageDate" value="<?php echo HtmlEncode($ticketmessage_grid->MessageDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ticketmessage" data-field="x_MessageDate" name="fticketmessagegrid$x<?php echo $ticketmessage_grid->RowIndex ?>_MessageDate" id="fticketmessagegrid$x<?php echo $ticketmessage_grid->RowIndex ?>_MessageDate" value="<?php echo HtmlEncode($ticketmessage_grid->MessageDate->FormValue) ?>">
<input type="hidden" data-table="ticketmessage" data-field="x_MessageDate" name="fticketmessagegrid$o<?php echo $ticketmessage_grid->RowIndex ?>_MessageDate" id="fticketmessagegrid$o<?php echo $ticketmessage_grid->RowIndex ?>_MessageDate" value="<?php echo HtmlEncode($ticketmessage_grid->MessageDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ticketmessage_grid->ListOptions->render("body", "right", $ticketmessage_grid->RowCount);
?>
	</tr>
<?php if ($ticketmessage->RowType == ROWTYPE_ADD || $ticketmessage->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fticketmessagegrid", "load"], function() {
	fticketmessagegrid.updateLists(<?php echo $ticketmessage_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$ticketmessage_grid->isGridAdd() || $ticketmessage->CurrentMode == "copy")
		if (!$ticketmessage_grid->Recordset->EOF)
			$ticketmessage_grid->Recordset->moveNext();
}
?>
<?php
	if ($ticketmessage->CurrentMode == "add" || $ticketmessage->CurrentMode == "copy" || $ticketmessage->CurrentMode == "edit") {
		$ticketmessage_grid->RowIndex = '$rowindex$';
		$ticketmessage_grid->loadRowValues();

		// Set row properties
		$ticketmessage->resetAttributes();
		$ticketmessage->RowAttrs->merge(["data-rowindex" => $ticketmessage_grid->RowIndex, "id" => "r0_ticketmessage", "data-rowtype" => ROWTYPE_ADD]);
		$ticketmessage->RowAttrs->appendClass("ew-template");
		$ticketmessage->RowType = ROWTYPE_ADD;

		// Render row
		$ticketmessage_grid->renderRow();

		// Render list options
		$ticketmessage_grid->renderListOptions();
		$ticketmessage_grid->StartRowCount = 0;
?>
	<tr <?php echo $ticketmessage->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ticketmessage_grid->ListOptions->render("body", "left", $ticketmessage_grid->RowIndex);
?>
	<?php if ($ticketmessage_grid->TicketNumber->Visible) { // TicketNumber ?>
		<td data-name="TicketNumber">
<?php if (!$ticketmessage->isConfirm()) { ?>
<?php if ($ticketmessage_grid->TicketNumber->getSessionValue() != "") { ?>
<span id="el$rowindex$_ticketmessage_TicketNumber" class="form-group ticketmessage_TicketNumber">
<span<?php echo $ticketmessage_grid->TicketNumber->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ticketmessage_grid->TicketNumber->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" name="x<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" value="<?php echo HtmlEncode($ticketmessage_grid->TicketNumber->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_ticketmessage_TicketNumber" class="form-group ticketmessage_TicketNumber">
<input type="text" data-table="ticketmessage" data-field="x_TicketNumber" name="x<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" id="x<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" size="30" placeholder="<?php echo HtmlEncode($ticketmessage_grid->TicketNumber->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_grid->TicketNumber->EditValue ?>"<?php echo $ticketmessage_grid->TicketNumber->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_ticketmessage_TicketNumber" class="form-group ticketmessage_TicketNumber">
<span<?php echo $ticketmessage_grid->TicketNumber->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ticketmessage_grid->TicketNumber->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ticketmessage" data-field="x_TicketNumber" name="x<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" id="x<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" value="<?php echo HtmlEncode($ticketmessage_grid->TicketNumber->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ticketmessage" data-field="x_TicketNumber" name="o<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" id="o<?php echo $ticketmessage_grid->RowIndex ?>_TicketNumber" value="<?php echo HtmlEncode($ticketmessage_grid->TicketNumber->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ticketmessage_grid->MessageNumber->Visible) { // MessageNumber ?>
		<td data-name="MessageNumber">
<?php if (!$ticketmessage->isConfirm()) { ?>
<span id="el$rowindex$_ticketmessage_MessageNumber" class="form-group ticketmessage_MessageNumber"></span>
<?php } else { ?>
<span id="el$rowindex$_ticketmessage_MessageNumber" class="form-group ticketmessage_MessageNumber">
<span<?php echo $ticketmessage_grid->MessageNumber->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ticketmessage_grid->MessageNumber->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ticketmessage" data-field="x_MessageNumber" name="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageNumber" id="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageNumber" value="<?php echo HtmlEncode($ticketmessage_grid->MessageNumber->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ticketmessage" data-field="x_MessageNumber" name="o<?php echo $ticketmessage_grid->RowIndex ?>_MessageNumber" id="o<?php echo $ticketmessage_grid->RowIndex ?>_MessageNumber" value="<?php echo HtmlEncode($ticketmessage_grid->MessageNumber->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ticketmessage_grid->MessageBy->Visible) { // MessageBy ?>
		<td data-name="MessageBy">
<?php if (!$ticketmessage->isConfirm()) { ?>
<span id="el$rowindex$_ticketmessage_MessageBy" class="form-group ticketmessage_MessageBy">
<input type="text" data-table="ticketmessage" data-field="x_MessageBy" name="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageBy" id="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageBy" size="30" placeholder="<?php echo HtmlEncode($ticketmessage_grid->MessageBy->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_grid->MessageBy->EditValue ?>"<?php echo $ticketmessage_grid->MessageBy->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_ticketmessage_MessageBy" class="form-group ticketmessage_MessageBy">
<span<?php echo $ticketmessage_grid->MessageBy->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ticketmessage_grid->MessageBy->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ticketmessage" data-field="x_MessageBy" name="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageBy" id="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageBy" value="<?php echo HtmlEncode($ticketmessage_grid->MessageBy->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ticketmessage" data-field="x_MessageBy" name="o<?php echo $ticketmessage_grid->RowIndex ?>_MessageBy" id="o<?php echo $ticketmessage_grid->RowIndex ?>_MessageBy" value="<?php echo HtmlEncode($ticketmessage_grid->MessageBy->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ticketmessage_grid->Subject->Visible) { // Subject ?>
		<td data-name="Subject">
<?php if (!$ticketmessage->isConfirm()) { ?>
<span id="el$rowindex$_ticketmessage_Subject" class="form-group ticketmessage_Subject">
<input type="text" data-table="ticketmessage" data-field="x_Subject" name="x<?php echo $ticketmessage_grid->RowIndex ?>_Subject" id="x<?php echo $ticketmessage_grid->RowIndex ?>_Subject" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ticketmessage_grid->Subject->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_grid->Subject->EditValue ?>"<?php echo $ticketmessage_grid->Subject->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_ticketmessage_Subject" class="form-group ticketmessage_Subject">
<span<?php echo $ticketmessage_grid->Subject->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ticketmessage_grid->Subject->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ticketmessage" data-field="x_Subject" name="x<?php echo $ticketmessage_grid->RowIndex ?>_Subject" id="x<?php echo $ticketmessage_grid->RowIndex ?>_Subject" value="<?php echo HtmlEncode($ticketmessage_grid->Subject->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ticketmessage" data-field="x_Subject" name="o<?php echo $ticketmessage_grid->RowIndex ?>_Subject" id="o<?php echo $ticketmessage_grid->RowIndex ?>_Subject" value="<?php echo HtmlEncode($ticketmessage_grid->Subject->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ticketmessage_grid->Message->Visible) { // Message ?>
		<td data-name="Message">
<?php if (!$ticketmessage->isConfirm()) { ?>
<span id="el$rowindex$_ticketmessage_Message" class="form-group ticketmessage_Message">
<input type="text" data-table="ticketmessage" data-field="x_Message" name="x<?php echo $ticketmessage_grid->RowIndex ?>_Message" id="x<?php echo $ticketmessage_grid->RowIndex ?>_Message" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ticketmessage_grid->Message->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_grid->Message->EditValue ?>"<?php echo $ticketmessage_grid->Message->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_ticketmessage_Message" class="form-group ticketmessage_Message">
<span<?php echo $ticketmessage_grid->Message->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ticketmessage_grid->Message->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ticketmessage" data-field="x_Message" name="x<?php echo $ticketmessage_grid->RowIndex ?>_Message" id="x<?php echo $ticketmessage_grid->RowIndex ?>_Message" value="<?php echo HtmlEncode($ticketmessage_grid->Message->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ticketmessage" data-field="x_Message" name="o<?php echo $ticketmessage_grid->RowIndex ?>_Message" id="o<?php echo $ticketmessage_grid->RowIndex ?>_Message" value="<?php echo HtmlEncode($ticketmessage_grid->Message->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ticketmessage_grid->MessageDate->Visible) { // MessageDate ?>
		<td data-name="MessageDate">
<?php if (!$ticketmessage->isConfirm()) { ?>
<span id="el$rowindex$_ticketmessage_MessageDate" class="form-group ticketmessage_MessageDate">
<input type="text" data-table="ticketmessage" data-field="x_MessageDate" name="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageDate" id="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageDate" placeholder="<?php echo HtmlEncode($ticketmessage_grid->MessageDate->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_grid->MessageDate->EditValue ?>"<?php echo $ticketmessage_grid->MessageDate->editAttributes() ?>>
<?php if (!$ticketmessage_grid->MessageDate->ReadOnly && !$ticketmessage_grid->MessageDate->Disabled && !isset($ticketmessage_grid->MessageDate->EditAttrs["readonly"]) && !isset($ticketmessage_grid->MessageDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fticketmessagegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fticketmessagegrid", "x<?php echo $ticketmessage_grid->RowIndex ?>_MessageDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_ticketmessage_MessageDate" class="form-group ticketmessage_MessageDate">
<span<?php echo $ticketmessage_grid->MessageDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ticketmessage_grid->MessageDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ticketmessage" data-field="x_MessageDate" name="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageDate" id="x<?php echo $ticketmessage_grid->RowIndex ?>_MessageDate" value="<?php echo HtmlEncode($ticketmessage_grid->MessageDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ticketmessage" data-field="x_MessageDate" name="o<?php echo $ticketmessage_grid->RowIndex ?>_MessageDate" id="o<?php echo $ticketmessage_grid->RowIndex ?>_MessageDate" value="<?php echo HtmlEncode($ticketmessage_grid->MessageDate->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ticketmessage_grid->ListOptions->render("body", "right", $ticketmessage_grid->RowIndex);
?>
<script>
loadjs.ready(["fticketmessagegrid", "load"], function() {
	fticketmessagegrid.updateLists(<?php echo $ticketmessage_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($ticketmessage->CurrentMode == "add" || $ticketmessage->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $ticketmessage_grid->FormKeyCountName ?>" id="<?php echo $ticketmessage_grid->FormKeyCountName ?>" value="<?php echo $ticketmessage_grid->KeyCount ?>">
<?php echo $ticketmessage_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($ticketmessage->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $ticketmessage_grid->FormKeyCountName ?>" id="<?php echo $ticketmessage_grid->FormKeyCountName ?>" value="<?php echo $ticketmessage_grid->KeyCount ?>">
<?php echo $ticketmessage_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($ticketmessage->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fticketmessagegrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ticketmessage_grid->Recordset)
	$ticketmessage_grid->Recordset->Close();
?>
<?php if ($ticketmessage_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $ticketmessage_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ticketmessage_grid->TotalRecords == 0 && !$ticketmessage->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ticketmessage_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$ticketmessage_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$ticketmessage_grid->terminate();
?>