<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($contract_variation_grid))
	$contract_variation_grid = new contract_variation_grid();

// Run the page
$contract_variation_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contract_variation_grid->Page_Render();
?>
<?php if (!$contract_variation_grid->isExport()) { ?>
<script>
var fcontract_variationgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fcontract_variationgrid = new ew.Form("fcontract_variationgrid", "grid");
	fcontract_variationgrid.formKeyCountName = '<?php echo $contract_variation_grid->FormKeyCountName ?>';

	// Validate form
	fcontract_variationgrid.validate = function() {
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
			<?php if ($contract_variation_grid->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_variation_grid->LACode->caption(), $contract_variation_grid->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_variation_grid->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_variation_grid->DepartmentCode->caption(), $contract_variation_grid->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_variation_grid->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_variation_grid->SectionCode->caption(), $contract_variation_grid->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_variation_grid->ContractNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_variation_grid->ContractNo->caption(), $contract_variation_grid->ContractNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_variation_grid->VariationAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_VariationAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_variation_grid->VariationAmount->caption(), $contract_variation_grid->VariationAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VariationAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_variation_grid->VariationAmount->errorMessage()) ?>");
			<?php if ($contract_variation_grid->VariationNo->Required) { ?>
				elm = this.getElements("x" + infix + "_VariationNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_variation_grid->VariationNo->caption(), $contract_variation_grid->VariationNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_variation_grid->VariationDate->Required) { ?>
				elm = this.getElements("x" + infix + "_VariationDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_variation_grid->VariationDate->caption(), $contract_variation_grid->VariationDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VariationDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_variation_grid->VariationDate->errorMessage()) ?>");
			<?php if ($contract_variation_grid->VariationJustification->Required) { ?>
				elm = this.getElements("x" + infix + "_VariationJustification");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_variation_grid->VariationJustification->caption(), $contract_variation_grid->VariationJustification->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fcontract_variationgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SectionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ContractNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "VariationAmount", false)) return false;
		if (ew.valueChanged(fobj, infix, "VariationDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "VariationJustification", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fcontract_variationgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcontract_variationgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcontract_variationgrid.lists["x_LACode"] = <?php echo $contract_variation_grid->LACode->Lookup->toClientList($contract_variation_grid) ?>;
	fcontract_variationgrid.lists["x_LACode"].options = <?php echo JsonEncode($contract_variation_grid->LACode->lookupOptions()) ?>;
	fcontract_variationgrid.lists["x_DepartmentCode"] = <?php echo $contract_variation_grid->DepartmentCode->Lookup->toClientList($contract_variation_grid) ?>;
	fcontract_variationgrid.lists["x_DepartmentCode"].options = <?php echo JsonEncode($contract_variation_grid->DepartmentCode->lookupOptions()) ?>;
	fcontract_variationgrid.lists["x_SectionCode"] = <?php echo $contract_variation_grid->SectionCode->Lookup->toClientList($contract_variation_grid) ?>;
	fcontract_variationgrid.lists["x_SectionCode"].options = <?php echo JsonEncode($contract_variation_grid->SectionCode->lookupOptions()) ?>;
	loadjs.done("fcontract_variationgrid");
});
</script>
<?php } ?>
<?php
$contract_variation_grid->renderOtherOptions();
?>
<?php if ($contract_variation_grid->TotalRecords > 0 || $contract_variation->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($contract_variation_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> contract_variation">
<?php if ($contract_variation_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $contract_variation_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fcontract_variationgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_contract_variation" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_contract_variationgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$contract_variation->RowType = ROWTYPE_HEADER;

// Render list options
$contract_variation_grid->renderListOptions();

// Render list options (header, left)
$contract_variation_grid->ListOptions->render("header", "left");
?>
<?php if ($contract_variation_grid->LACode->Visible) { // LACode ?>
	<?php if ($contract_variation_grid->SortUrl($contract_variation_grid->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $contract_variation_grid->LACode->headerCellClass() ?>"><div id="elh_contract_variation_LACode" class="contract_variation_LACode"><div class="ew-table-header-caption"><?php echo $contract_variation_grid->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $contract_variation_grid->LACode->headerCellClass() ?>"><div><div id="elh_contract_variation_LACode" class="contract_variation_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_variation_grid->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_variation_grid->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_variation_grid->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_variation_grid->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($contract_variation_grid->SortUrl($contract_variation_grid->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $contract_variation_grid->DepartmentCode->headerCellClass() ?>"><div id="elh_contract_variation_DepartmentCode" class="contract_variation_DepartmentCode"><div class="ew-table-header-caption"><?php echo $contract_variation_grid->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $contract_variation_grid->DepartmentCode->headerCellClass() ?>"><div><div id="elh_contract_variation_DepartmentCode" class="contract_variation_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_variation_grid->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_variation_grid->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_variation_grid->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_variation_grid->SectionCode->Visible) { // SectionCode ?>
	<?php if ($contract_variation_grid->SortUrl($contract_variation_grid->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $contract_variation_grid->SectionCode->headerCellClass() ?>"><div id="elh_contract_variation_SectionCode" class="contract_variation_SectionCode"><div class="ew-table-header-caption"><?php echo $contract_variation_grid->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $contract_variation_grid->SectionCode->headerCellClass() ?>"><div><div id="elh_contract_variation_SectionCode" class="contract_variation_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_variation_grid->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_variation_grid->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_variation_grid->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_variation_grid->ContractNo->Visible) { // ContractNo ?>
	<?php if ($contract_variation_grid->SortUrl($contract_variation_grid->ContractNo) == "") { ?>
		<th data-name="ContractNo" class="<?php echo $contract_variation_grid->ContractNo->headerCellClass() ?>"><div id="elh_contract_variation_ContractNo" class="contract_variation_ContractNo"><div class="ew-table-header-caption"><?php echo $contract_variation_grid->ContractNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractNo" class="<?php echo $contract_variation_grid->ContractNo->headerCellClass() ?>"><div><div id="elh_contract_variation_ContractNo" class="contract_variation_ContractNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_variation_grid->ContractNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_variation_grid->ContractNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_variation_grid->ContractNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_variation_grid->VariationAmount->Visible) { // VariationAmount ?>
	<?php if ($contract_variation_grid->SortUrl($contract_variation_grid->VariationAmount) == "") { ?>
		<th data-name="VariationAmount" class="<?php echo $contract_variation_grid->VariationAmount->headerCellClass() ?>"><div id="elh_contract_variation_VariationAmount" class="contract_variation_VariationAmount"><div class="ew-table-header-caption"><?php echo $contract_variation_grid->VariationAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VariationAmount" class="<?php echo $contract_variation_grid->VariationAmount->headerCellClass() ?>"><div><div id="elh_contract_variation_VariationAmount" class="contract_variation_VariationAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_variation_grid->VariationAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_variation_grid->VariationAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_variation_grid->VariationAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_variation_grid->VariationNo->Visible) { // VariationNo ?>
	<?php if ($contract_variation_grid->SortUrl($contract_variation_grid->VariationNo) == "") { ?>
		<th data-name="VariationNo" class="<?php echo $contract_variation_grid->VariationNo->headerCellClass() ?>"><div id="elh_contract_variation_VariationNo" class="contract_variation_VariationNo"><div class="ew-table-header-caption"><?php echo $contract_variation_grid->VariationNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VariationNo" class="<?php echo $contract_variation_grid->VariationNo->headerCellClass() ?>"><div><div id="elh_contract_variation_VariationNo" class="contract_variation_VariationNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_variation_grid->VariationNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_variation_grid->VariationNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_variation_grid->VariationNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_variation_grid->VariationDate->Visible) { // VariationDate ?>
	<?php if ($contract_variation_grid->SortUrl($contract_variation_grid->VariationDate) == "") { ?>
		<th data-name="VariationDate" class="<?php echo $contract_variation_grid->VariationDate->headerCellClass() ?>"><div id="elh_contract_variation_VariationDate" class="contract_variation_VariationDate"><div class="ew-table-header-caption"><?php echo $contract_variation_grid->VariationDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VariationDate" class="<?php echo $contract_variation_grid->VariationDate->headerCellClass() ?>"><div><div id="elh_contract_variation_VariationDate" class="contract_variation_VariationDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_variation_grid->VariationDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_variation_grid->VariationDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_variation_grid->VariationDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_variation_grid->VariationJustification->Visible) { // VariationJustification ?>
	<?php if ($contract_variation_grid->SortUrl($contract_variation_grid->VariationJustification) == "") { ?>
		<th data-name="VariationJustification" class="<?php echo $contract_variation_grid->VariationJustification->headerCellClass() ?>"><div id="elh_contract_variation_VariationJustification" class="contract_variation_VariationJustification"><div class="ew-table-header-caption"><?php echo $contract_variation_grid->VariationJustification->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VariationJustification" class="<?php echo $contract_variation_grid->VariationJustification->headerCellClass() ?>"><div><div id="elh_contract_variation_VariationJustification" class="contract_variation_VariationJustification">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_variation_grid->VariationJustification->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_variation_grid->VariationJustification->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_variation_grid->VariationJustification->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$contract_variation_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$contract_variation_grid->StartRecord = 1;
$contract_variation_grid->StopRecord = $contract_variation_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($contract_variation->isConfirm() || $contract_variation_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($contract_variation_grid->FormKeyCountName) && ($contract_variation_grid->isGridAdd() || $contract_variation_grid->isGridEdit() || $contract_variation->isConfirm())) {
		$contract_variation_grid->KeyCount = $CurrentForm->getValue($contract_variation_grid->FormKeyCountName);
		$contract_variation_grid->StopRecord = $contract_variation_grid->StartRecord + $contract_variation_grid->KeyCount - 1;
	}
}
$contract_variation_grid->RecordCount = $contract_variation_grid->StartRecord - 1;
if ($contract_variation_grid->Recordset && !$contract_variation_grid->Recordset->EOF) {
	$contract_variation_grid->Recordset->moveFirst();
	$selectLimit = $contract_variation_grid->UseSelectLimit;
	if (!$selectLimit && $contract_variation_grid->StartRecord > 1)
		$contract_variation_grid->Recordset->move($contract_variation_grid->StartRecord - 1);
} elseif (!$contract_variation->AllowAddDeleteRow && $contract_variation_grid->StopRecord == 0) {
	$contract_variation_grid->StopRecord = $contract_variation->GridAddRowCount;
}

// Initialize aggregate
$contract_variation->RowType = ROWTYPE_AGGREGATEINIT;
$contract_variation->resetAttributes();
$contract_variation_grid->renderRow();
if ($contract_variation_grid->isGridAdd())
	$contract_variation_grid->RowIndex = 0;
if ($contract_variation_grid->isGridEdit())
	$contract_variation_grid->RowIndex = 0;
while ($contract_variation_grid->RecordCount < $contract_variation_grid->StopRecord) {
	$contract_variation_grid->RecordCount++;
	if ($contract_variation_grid->RecordCount >= $contract_variation_grid->StartRecord) {
		$contract_variation_grid->RowCount++;
		if ($contract_variation_grid->isGridAdd() || $contract_variation_grid->isGridEdit() || $contract_variation->isConfirm()) {
			$contract_variation_grid->RowIndex++;
			$CurrentForm->Index = $contract_variation_grid->RowIndex;
			if ($CurrentForm->hasValue($contract_variation_grid->FormActionName) && ($contract_variation->isConfirm() || $contract_variation_grid->EventCancelled))
				$contract_variation_grid->RowAction = strval($CurrentForm->getValue($contract_variation_grid->FormActionName));
			elseif ($contract_variation_grid->isGridAdd())
				$contract_variation_grid->RowAction = "insert";
			else
				$contract_variation_grid->RowAction = "";
		}

		// Set up key count
		$contract_variation_grid->KeyCount = $contract_variation_grid->RowIndex;

		// Init row class and style
		$contract_variation->resetAttributes();
		$contract_variation->CssClass = "";
		if ($contract_variation_grid->isGridAdd()) {
			if ($contract_variation->CurrentMode == "copy") {
				$contract_variation_grid->loadRowValues($contract_variation_grid->Recordset); // Load row values
				$contract_variation_grid->setRecordKey($contract_variation_grid->RowOldKey, $contract_variation_grid->Recordset); // Set old record key
			} else {
				$contract_variation_grid->loadRowValues(); // Load default values
				$contract_variation_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$contract_variation_grid->loadRowValues($contract_variation_grid->Recordset); // Load row values
		}
		$contract_variation->RowType = ROWTYPE_VIEW; // Render view
		if ($contract_variation_grid->isGridAdd()) // Grid add
			$contract_variation->RowType = ROWTYPE_ADD; // Render add
		if ($contract_variation_grid->isGridAdd() && $contract_variation->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$contract_variation_grid->restoreCurrentRowFormValues($contract_variation_grid->RowIndex); // Restore form values
		if ($contract_variation_grid->isGridEdit()) { // Grid edit
			if ($contract_variation->EventCancelled)
				$contract_variation_grid->restoreCurrentRowFormValues($contract_variation_grid->RowIndex); // Restore form values
			if ($contract_variation_grid->RowAction == "insert")
				$contract_variation->RowType = ROWTYPE_ADD; // Render add
			else
				$contract_variation->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($contract_variation_grid->isGridEdit() && ($contract_variation->RowType == ROWTYPE_EDIT || $contract_variation->RowType == ROWTYPE_ADD) && $contract_variation->EventCancelled) // Update failed
			$contract_variation_grid->restoreCurrentRowFormValues($contract_variation_grid->RowIndex); // Restore form values
		if ($contract_variation->RowType == ROWTYPE_EDIT) // Edit row
			$contract_variation_grid->EditRowCount++;
		if ($contract_variation->isConfirm()) // Confirm row
			$contract_variation_grid->restoreCurrentRowFormValues($contract_variation_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$contract_variation->RowAttrs->merge(["data-rowindex" => $contract_variation_grid->RowCount, "id" => "r" . $contract_variation_grid->RowCount . "_contract_variation", "data-rowtype" => $contract_variation->RowType]);

		// Render row
		$contract_variation_grid->renderRow();

		// Render list options
		$contract_variation_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($contract_variation_grid->RowAction != "delete" && $contract_variation_grid->RowAction != "insertdelete" && !($contract_variation_grid->RowAction == "insert" && $contract_variation->isConfirm() && $contract_variation_grid->emptyRow())) {
?>
	<tr <?php echo $contract_variation->rowAttributes() ?>>
<?php

// Render list options (body, left)
$contract_variation_grid->ListOptions->render("body", "left", $contract_variation_grid->RowCount);
?>
	<?php if ($contract_variation_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $contract_variation_grid->LACode->cellAttributes() ?>>
<?php if ($contract_variation->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($contract_variation_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_LACode" class="form-group">
<span<?php echo $contract_variation_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contract_variation_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $contract_variation_grid->RowIndex ?>_LACode" name="x<?php echo $contract_variation_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($contract_variation_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_LACode" class="form-group">
<?php $contract_variation_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $contract_variation_grid->RowIndex ?>_LACode"><?php echo EmptyValue(strval($contract_variation_grid->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $contract_variation_grid->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contract_variation_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($contract_variation_grid->LACode->ReadOnly || $contract_variation_grid->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $contract_variation_grid->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $contract_variation_grid->LACode->Lookup->getParamTag($contract_variation_grid, "p_x" . $contract_variation_grid->RowIndex . "_LACode") ?>
<input type="hidden" data-table="contract_variation" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contract_variation_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $contract_variation_grid->RowIndex ?>_LACode" id="x<?php echo $contract_variation_grid->RowIndex ?>_LACode" value="<?php echo $contract_variation_grid->LACode->CurrentValue ?>"<?php echo $contract_variation_grid->LACode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="contract_variation" data-field="x_LACode" name="o<?php echo $contract_variation_grid->RowIndex ?>_LACode" id="o<?php echo $contract_variation_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($contract_variation_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($contract_variation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($contract_variation_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_LACode" class="form-group">
<span<?php echo $contract_variation_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contract_variation_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $contract_variation_grid->RowIndex ?>_LACode" name="x<?php echo $contract_variation_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($contract_variation_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_LACode" class="form-group">
<?php $contract_variation_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $contract_variation_grid->RowIndex ?>_LACode"><?php echo EmptyValue(strval($contract_variation_grid->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $contract_variation_grid->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contract_variation_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($contract_variation_grid->LACode->ReadOnly || $contract_variation_grid->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $contract_variation_grid->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $contract_variation_grid->LACode->Lookup->getParamTag($contract_variation_grid, "p_x" . $contract_variation_grid->RowIndex . "_LACode") ?>
<input type="hidden" data-table="contract_variation" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contract_variation_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $contract_variation_grid->RowIndex ?>_LACode" id="x<?php echo $contract_variation_grid->RowIndex ?>_LACode" value="<?php echo $contract_variation_grid->LACode->CurrentValue ?>"<?php echo $contract_variation_grid->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($contract_variation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_LACode">
<span<?php echo $contract_variation_grid->LACode->viewAttributes() ?>><?php echo $contract_variation_grid->LACode->getViewValue() ?></span>
</span>
<?php if (!$contract_variation->isConfirm()) { ?>
<input type="hidden" data-table="contract_variation" data-field="x_LACode" name="x<?php echo $contract_variation_grid->RowIndex ?>_LACode" id="x<?php echo $contract_variation_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($contract_variation_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="contract_variation" data-field="x_LACode" name="o<?php echo $contract_variation_grid->RowIndex ?>_LACode" id="o<?php echo $contract_variation_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($contract_variation_grid->LACode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="contract_variation" data-field="x_LACode" name="fcontract_variationgrid$x<?php echo $contract_variation_grid->RowIndex ?>_LACode" id="fcontract_variationgrid$x<?php echo $contract_variation_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($contract_variation_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="contract_variation" data-field="x_LACode" name="fcontract_variationgrid$o<?php echo $contract_variation_grid->RowIndex ?>_LACode" id="fcontract_variationgrid$o<?php echo $contract_variation_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($contract_variation_grid->LACode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($contract_variation_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $contract_variation_grid->DepartmentCode->cellAttributes() ?>>
<?php if ($contract_variation->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($contract_variation_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_DepartmentCode" class="form-group">
<span<?php echo $contract_variation_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contract_variation_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($contract_variation_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_DepartmentCode" class="form-group">
<?php $contract_variation_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contract_variation" data-field="x_DepartmentCode" data-value-separator="<?php echo $contract_variation_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode"<?php echo $contract_variation_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $contract_variation_grid->DepartmentCode->selectOptionListHtml("x{$contract_variation_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $contract_variation_grid->DepartmentCode->Lookup->getParamTag($contract_variation_grid, "p_x" . $contract_variation_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="contract_variation" data-field="x_DepartmentCode" name="o<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($contract_variation_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($contract_variation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($contract_variation_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_DepartmentCode" class="form-group">
<span<?php echo $contract_variation_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contract_variation_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($contract_variation_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_DepartmentCode" class="form-group">
<?php $contract_variation_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contract_variation" data-field="x_DepartmentCode" data-value-separator="<?php echo $contract_variation_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode"<?php echo $contract_variation_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $contract_variation_grid->DepartmentCode->selectOptionListHtml("x{$contract_variation_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $contract_variation_grid->DepartmentCode->Lookup->getParamTag($contract_variation_grid, "p_x" . $contract_variation_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($contract_variation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_DepartmentCode">
<span<?php echo $contract_variation_grid->DepartmentCode->viewAttributes() ?>><?php echo $contract_variation_grid->DepartmentCode->getViewValue() ?></span>
</span>
<?php if (!$contract_variation->isConfirm()) { ?>
<input type="hidden" data-table="contract_variation" data-field="x_DepartmentCode" name="x<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($contract_variation_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="contract_variation" data-field="x_DepartmentCode" name="o<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($contract_variation_grid->DepartmentCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="contract_variation" data-field="x_DepartmentCode" name="fcontract_variationgrid$x<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode" id="fcontract_variationgrid$x<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($contract_variation_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="contract_variation" data-field="x_DepartmentCode" name="fcontract_variationgrid$o<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode" id="fcontract_variationgrid$o<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($contract_variation_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($contract_variation_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $contract_variation_grid->SectionCode->cellAttributes() ?>>
<?php if ($contract_variation->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contract_variation" data-field="x_SectionCode" data-value-separator="<?php echo $contract_variation_grid->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $contract_variation_grid->RowIndex ?>_SectionCode" name="x<?php echo $contract_variation_grid->RowIndex ?>_SectionCode"<?php echo $contract_variation_grid->SectionCode->editAttributes() ?>>
			<?php echo $contract_variation_grid->SectionCode->selectOptionListHtml("x{$contract_variation_grid->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $contract_variation_grid->SectionCode->Lookup->getParamTag($contract_variation_grid, "p_x" . $contract_variation_grid->RowIndex . "_SectionCode") ?>
</span>
<input type="hidden" data-table="contract_variation" data-field="x_SectionCode" name="o<?php echo $contract_variation_grid->RowIndex ?>_SectionCode" id="o<?php echo $contract_variation_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($contract_variation_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($contract_variation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contract_variation" data-field="x_SectionCode" data-value-separator="<?php echo $contract_variation_grid->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $contract_variation_grid->RowIndex ?>_SectionCode" name="x<?php echo $contract_variation_grid->RowIndex ?>_SectionCode"<?php echo $contract_variation_grid->SectionCode->editAttributes() ?>>
			<?php echo $contract_variation_grid->SectionCode->selectOptionListHtml("x{$contract_variation_grid->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $contract_variation_grid->SectionCode->Lookup->getParamTag($contract_variation_grid, "p_x" . $contract_variation_grid->RowIndex . "_SectionCode") ?>
</span>
<?php } ?>
<?php if ($contract_variation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_SectionCode">
<span<?php echo $contract_variation_grid->SectionCode->viewAttributes() ?>><?php echo $contract_variation_grid->SectionCode->getViewValue() ?></span>
</span>
<?php if (!$contract_variation->isConfirm()) { ?>
<input type="hidden" data-table="contract_variation" data-field="x_SectionCode" name="x<?php echo $contract_variation_grid->RowIndex ?>_SectionCode" id="x<?php echo $contract_variation_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($contract_variation_grid->SectionCode->FormValue) ?>">
<input type="hidden" data-table="contract_variation" data-field="x_SectionCode" name="o<?php echo $contract_variation_grid->RowIndex ?>_SectionCode" id="o<?php echo $contract_variation_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($contract_variation_grid->SectionCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="contract_variation" data-field="x_SectionCode" name="fcontract_variationgrid$x<?php echo $contract_variation_grid->RowIndex ?>_SectionCode" id="fcontract_variationgrid$x<?php echo $contract_variation_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($contract_variation_grid->SectionCode->FormValue) ?>">
<input type="hidden" data-table="contract_variation" data-field="x_SectionCode" name="fcontract_variationgrid$o<?php echo $contract_variation_grid->RowIndex ?>_SectionCode" id="fcontract_variationgrid$o<?php echo $contract_variation_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($contract_variation_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($contract_variation_grid->ContractNo->Visible) { // ContractNo ?>
		<td data-name="ContractNo" <?php echo $contract_variation_grid->ContractNo->cellAttributes() ?>>
<?php if ($contract_variation->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($contract_variation_grid->ContractNo->getSessionValue() != "") { ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_ContractNo" class="form-group">
<span<?php echo $contract_variation_grid->ContractNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contract_variation_grid->ContractNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" name="x<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" value="<?php echo HtmlEncode($contract_variation_grid->ContractNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_ContractNo" class="form-group">
<input type="text" data-table="contract_variation" data-field="x_ContractNo" name="x<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" id="x<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($contract_variation_grid->ContractNo->getPlaceHolder()) ?>" value="<?php echo $contract_variation_grid->ContractNo->EditValue ?>"<?php echo $contract_variation_grid->ContractNo->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="contract_variation" data-field="x_ContractNo" name="o<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" id="o<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" value="<?php echo HtmlEncode($contract_variation_grid->ContractNo->OldValue) ?>">
<?php } ?>
<?php if ($contract_variation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($contract_variation_grid->ContractNo->getSessionValue() != "") { ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_ContractNo" class="form-group">
<span<?php echo $contract_variation_grid->ContractNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contract_variation_grid->ContractNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" name="x<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" value="<?php echo HtmlEncode($contract_variation_grid->ContractNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_ContractNo" class="form-group">
<input type="text" data-table="contract_variation" data-field="x_ContractNo" name="x<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" id="x<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($contract_variation_grid->ContractNo->getPlaceHolder()) ?>" value="<?php echo $contract_variation_grid->ContractNo->EditValue ?>"<?php echo $contract_variation_grid->ContractNo->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($contract_variation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_ContractNo">
<span<?php echo $contract_variation_grid->ContractNo->viewAttributes() ?>><?php echo $contract_variation_grid->ContractNo->getViewValue() ?></span>
</span>
<?php if (!$contract_variation->isConfirm()) { ?>
<input type="hidden" data-table="contract_variation" data-field="x_ContractNo" name="x<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" id="x<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" value="<?php echo HtmlEncode($contract_variation_grid->ContractNo->FormValue) ?>">
<input type="hidden" data-table="contract_variation" data-field="x_ContractNo" name="o<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" id="o<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" value="<?php echo HtmlEncode($contract_variation_grid->ContractNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="contract_variation" data-field="x_ContractNo" name="fcontract_variationgrid$x<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" id="fcontract_variationgrid$x<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" value="<?php echo HtmlEncode($contract_variation_grid->ContractNo->FormValue) ?>">
<input type="hidden" data-table="contract_variation" data-field="x_ContractNo" name="fcontract_variationgrid$o<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" id="fcontract_variationgrid$o<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" value="<?php echo HtmlEncode($contract_variation_grid->ContractNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($contract_variation_grid->VariationAmount->Visible) { // VariationAmount ?>
		<td data-name="VariationAmount" <?php echo $contract_variation_grid->VariationAmount->cellAttributes() ?>>
<?php if ($contract_variation->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_VariationAmount" class="form-group">
<input type="text" data-table="contract_variation" data-field="x_VariationAmount" name="x<?php echo $contract_variation_grid->RowIndex ?>_VariationAmount" id="x<?php echo $contract_variation_grid->RowIndex ?>_VariationAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($contract_variation_grid->VariationAmount->getPlaceHolder()) ?>" value="<?php echo $contract_variation_grid->VariationAmount->EditValue ?>"<?php echo $contract_variation_grid->VariationAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="contract_variation" data-field="x_VariationAmount" name="o<?php echo $contract_variation_grid->RowIndex ?>_VariationAmount" id="o<?php echo $contract_variation_grid->RowIndex ?>_VariationAmount" value="<?php echo HtmlEncode($contract_variation_grid->VariationAmount->OldValue) ?>">
<?php } ?>
<?php if ($contract_variation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_VariationAmount" class="form-group">
<input type="text" data-table="contract_variation" data-field="x_VariationAmount" name="x<?php echo $contract_variation_grid->RowIndex ?>_VariationAmount" id="x<?php echo $contract_variation_grid->RowIndex ?>_VariationAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($contract_variation_grid->VariationAmount->getPlaceHolder()) ?>" value="<?php echo $contract_variation_grid->VariationAmount->EditValue ?>"<?php echo $contract_variation_grid->VariationAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($contract_variation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_VariationAmount">
<span<?php echo $contract_variation_grid->VariationAmount->viewAttributes() ?>><?php echo $contract_variation_grid->VariationAmount->getViewValue() ?></span>
</span>
<?php if (!$contract_variation->isConfirm()) { ?>
<input type="hidden" data-table="contract_variation" data-field="x_VariationAmount" name="x<?php echo $contract_variation_grid->RowIndex ?>_VariationAmount" id="x<?php echo $contract_variation_grid->RowIndex ?>_VariationAmount" value="<?php echo HtmlEncode($contract_variation_grid->VariationAmount->FormValue) ?>">
<input type="hidden" data-table="contract_variation" data-field="x_VariationAmount" name="o<?php echo $contract_variation_grid->RowIndex ?>_VariationAmount" id="o<?php echo $contract_variation_grid->RowIndex ?>_VariationAmount" value="<?php echo HtmlEncode($contract_variation_grid->VariationAmount->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="contract_variation" data-field="x_VariationAmount" name="fcontract_variationgrid$x<?php echo $contract_variation_grid->RowIndex ?>_VariationAmount" id="fcontract_variationgrid$x<?php echo $contract_variation_grid->RowIndex ?>_VariationAmount" value="<?php echo HtmlEncode($contract_variation_grid->VariationAmount->FormValue) ?>">
<input type="hidden" data-table="contract_variation" data-field="x_VariationAmount" name="fcontract_variationgrid$o<?php echo $contract_variation_grid->RowIndex ?>_VariationAmount" id="fcontract_variationgrid$o<?php echo $contract_variation_grid->RowIndex ?>_VariationAmount" value="<?php echo HtmlEncode($contract_variation_grid->VariationAmount->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($contract_variation_grid->VariationNo->Visible) { // VariationNo ?>
		<td data-name="VariationNo" <?php echo $contract_variation_grid->VariationNo->cellAttributes() ?>>
<?php if ($contract_variation->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_VariationNo" class="form-group"></span>
<input type="hidden" data-table="contract_variation" data-field="x_VariationNo" name="o<?php echo $contract_variation_grid->RowIndex ?>_VariationNo" id="o<?php echo $contract_variation_grid->RowIndex ?>_VariationNo" value="<?php echo HtmlEncode($contract_variation_grid->VariationNo->OldValue) ?>">
<?php } ?>
<?php if ($contract_variation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_VariationNo" class="form-group">
<span<?php echo $contract_variation_grid->VariationNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contract_variation_grid->VariationNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="contract_variation" data-field="x_VariationNo" name="x<?php echo $contract_variation_grid->RowIndex ?>_VariationNo" id="x<?php echo $contract_variation_grid->RowIndex ?>_VariationNo" value="<?php echo HtmlEncode($contract_variation_grid->VariationNo->CurrentValue) ?>">
<?php } ?>
<?php if ($contract_variation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_VariationNo">
<span<?php echo $contract_variation_grid->VariationNo->viewAttributes() ?>><?php echo $contract_variation_grid->VariationNo->getViewValue() ?></span>
</span>
<?php if (!$contract_variation->isConfirm()) { ?>
<input type="hidden" data-table="contract_variation" data-field="x_VariationNo" name="x<?php echo $contract_variation_grid->RowIndex ?>_VariationNo" id="x<?php echo $contract_variation_grid->RowIndex ?>_VariationNo" value="<?php echo HtmlEncode($contract_variation_grid->VariationNo->FormValue) ?>">
<input type="hidden" data-table="contract_variation" data-field="x_VariationNo" name="o<?php echo $contract_variation_grid->RowIndex ?>_VariationNo" id="o<?php echo $contract_variation_grid->RowIndex ?>_VariationNo" value="<?php echo HtmlEncode($contract_variation_grid->VariationNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="contract_variation" data-field="x_VariationNo" name="fcontract_variationgrid$x<?php echo $contract_variation_grid->RowIndex ?>_VariationNo" id="fcontract_variationgrid$x<?php echo $contract_variation_grid->RowIndex ?>_VariationNo" value="<?php echo HtmlEncode($contract_variation_grid->VariationNo->FormValue) ?>">
<input type="hidden" data-table="contract_variation" data-field="x_VariationNo" name="fcontract_variationgrid$o<?php echo $contract_variation_grid->RowIndex ?>_VariationNo" id="fcontract_variationgrid$o<?php echo $contract_variation_grid->RowIndex ?>_VariationNo" value="<?php echo HtmlEncode($contract_variation_grid->VariationNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($contract_variation_grid->VariationDate->Visible) { // VariationDate ?>
		<td data-name="VariationDate" <?php echo $contract_variation_grid->VariationDate->cellAttributes() ?>>
<?php if ($contract_variation->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_VariationDate" class="form-group">
<input type="text" data-table="contract_variation" data-field="x_VariationDate" name="x<?php echo $contract_variation_grid->RowIndex ?>_VariationDate" id="x<?php echo $contract_variation_grid->RowIndex ?>_VariationDate" maxlength="10" placeholder="<?php echo HtmlEncode($contract_variation_grid->VariationDate->getPlaceHolder()) ?>" value="<?php echo $contract_variation_grid->VariationDate->EditValue ?>"<?php echo $contract_variation_grid->VariationDate->editAttributes() ?>>
<?php if (!$contract_variation_grid->VariationDate->ReadOnly && !$contract_variation_grid->VariationDate->Disabled && !isset($contract_variation_grid->VariationDate->EditAttrs["readonly"]) && !isset($contract_variation_grid->VariationDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontract_variationgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontract_variationgrid", "x<?php echo $contract_variation_grid->RowIndex ?>_VariationDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="contract_variation" data-field="x_VariationDate" name="o<?php echo $contract_variation_grid->RowIndex ?>_VariationDate" id="o<?php echo $contract_variation_grid->RowIndex ?>_VariationDate" value="<?php echo HtmlEncode($contract_variation_grid->VariationDate->OldValue) ?>">
<?php } ?>
<?php if ($contract_variation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_VariationDate" class="form-group">
<input type="text" data-table="contract_variation" data-field="x_VariationDate" name="x<?php echo $contract_variation_grid->RowIndex ?>_VariationDate" id="x<?php echo $contract_variation_grid->RowIndex ?>_VariationDate" maxlength="10" placeholder="<?php echo HtmlEncode($contract_variation_grid->VariationDate->getPlaceHolder()) ?>" value="<?php echo $contract_variation_grid->VariationDate->EditValue ?>"<?php echo $contract_variation_grid->VariationDate->editAttributes() ?>>
<?php if (!$contract_variation_grid->VariationDate->ReadOnly && !$contract_variation_grid->VariationDate->Disabled && !isset($contract_variation_grid->VariationDate->EditAttrs["readonly"]) && !isset($contract_variation_grid->VariationDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontract_variationgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontract_variationgrid", "x<?php echo $contract_variation_grid->RowIndex ?>_VariationDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($contract_variation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_VariationDate">
<span<?php echo $contract_variation_grid->VariationDate->viewAttributes() ?>><?php echo $contract_variation_grid->VariationDate->getViewValue() ?></span>
</span>
<?php if (!$contract_variation->isConfirm()) { ?>
<input type="hidden" data-table="contract_variation" data-field="x_VariationDate" name="x<?php echo $contract_variation_grid->RowIndex ?>_VariationDate" id="x<?php echo $contract_variation_grid->RowIndex ?>_VariationDate" value="<?php echo HtmlEncode($contract_variation_grid->VariationDate->FormValue) ?>">
<input type="hidden" data-table="contract_variation" data-field="x_VariationDate" name="o<?php echo $contract_variation_grid->RowIndex ?>_VariationDate" id="o<?php echo $contract_variation_grid->RowIndex ?>_VariationDate" value="<?php echo HtmlEncode($contract_variation_grid->VariationDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="contract_variation" data-field="x_VariationDate" name="fcontract_variationgrid$x<?php echo $contract_variation_grid->RowIndex ?>_VariationDate" id="fcontract_variationgrid$x<?php echo $contract_variation_grid->RowIndex ?>_VariationDate" value="<?php echo HtmlEncode($contract_variation_grid->VariationDate->FormValue) ?>">
<input type="hidden" data-table="contract_variation" data-field="x_VariationDate" name="fcontract_variationgrid$o<?php echo $contract_variation_grid->RowIndex ?>_VariationDate" id="fcontract_variationgrid$o<?php echo $contract_variation_grid->RowIndex ?>_VariationDate" value="<?php echo HtmlEncode($contract_variation_grid->VariationDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($contract_variation_grid->VariationJustification->Visible) { // VariationJustification ?>
		<td data-name="VariationJustification" <?php echo $contract_variation_grid->VariationJustification->cellAttributes() ?>>
<?php if ($contract_variation->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_VariationJustification" class="form-group">
<textarea data-table="contract_variation" data-field="x_VariationJustification" name="x<?php echo $contract_variation_grid->RowIndex ?>_VariationJustification" id="x<?php echo $contract_variation_grid->RowIndex ?>_VariationJustification" cols="35" rows="2" placeholder="<?php echo HtmlEncode($contract_variation_grid->VariationJustification->getPlaceHolder()) ?>"<?php echo $contract_variation_grid->VariationJustification->editAttributes() ?>><?php echo $contract_variation_grid->VariationJustification->EditValue ?></textarea>
</span>
<input type="hidden" data-table="contract_variation" data-field="x_VariationJustification" name="o<?php echo $contract_variation_grid->RowIndex ?>_VariationJustification" id="o<?php echo $contract_variation_grid->RowIndex ?>_VariationJustification" value="<?php echo HtmlEncode($contract_variation_grid->VariationJustification->OldValue) ?>">
<?php } ?>
<?php if ($contract_variation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_VariationJustification" class="form-group">
<textarea data-table="contract_variation" data-field="x_VariationJustification" name="x<?php echo $contract_variation_grid->RowIndex ?>_VariationJustification" id="x<?php echo $contract_variation_grid->RowIndex ?>_VariationJustification" cols="35" rows="2" placeholder="<?php echo HtmlEncode($contract_variation_grid->VariationJustification->getPlaceHolder()) ?>"<?php echo $contract_variation_grid->VariationJustification->editAttributes() ?>><?php echo $contract_variation_grid->VariationJustification->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($contract_variation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $contract_variation_grid->RowCount ?>_contract_variation_VariationJustification">
<span<?php echo $contract_variation_grid->VariationJustification->viewAttributes() ?>><?php echo $contract_variation_grid->VariationJustification->getViewValue() ?></span>
</span>
<?php if (!$contract_variation->isConfirm()) { ?>
<input type="hidden" data-table="contract_variation" data-field="x_VariationJustification" name="x<?php echo $contract_variation_grid->RowIndex ?>_VariationJustification" id="x<?php echo $contract_variation_grid->RowIndex ?>_VariationJustification" value="<?php echo HtmlEncode($contract_variation_grid->VariationJustification->FormValue) ?>">
<input type="hidden" data-table="contract_variation" data-field="x_VariationJustification" name="o<?php echo $contract_variation_grid->RowIndex ?>_VariationJustification" id="o<?php echo $contract_variation_grid->RowIndex ?>_VariationJustification" value="<?php echo HtmlEncode($contract_variation_grid->VariationJustification->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="contract_variation" data-field="x_VariationJustification" name="fcontract_variationgrid$x<?php echo $contract_variation_grid->RowIndex ?>_VariationJustification" id="fcontract_variationgrid$x<?php echo $contract_variation_grid->RowIndex ?>_VariationJustification" value="<?php echo HtmlEncode($contract_variation_grid->VariationJustification->FormValue) ?>">
<input type="hidden" data-table="contract_variation" data-field="x_VariationJustification" name="fcontract_variationgrid$o<?php echo $contract_variation_grid->RowIndex ?>_VariationJustification" id="fcontract_variationgrid$o<?php echo $contract_variation_grid->RowIndex ?>_VariationJustification" value="<?php echo HtmlEncode($contract_variation_grid->VariationJustification->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$contract_variation_grid->ListOptions->render("body", "right", $contract_variation_grid->RowCount);
?>
	</tr>
<?php if ($contract_variation->RowType == ROWTYPE_ADD || $contract_variation->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fcontract_variationgrid", "load"], function() {
	fcontract_variationgrid.updateLists(<?php echo $contract_variation_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$contract_variation_grid->isGridAdd() || $contract_variation->CurrentMode == "copy")
		if (!$contract_variation_grid->Recordset->EOF)
			$contract_variation_grid->Recordset->moveNext();
}
?>
<?php
	if ($contract_variation->CurrentMode == "add" || $contract_variation->CurrentMode == "copy" || $contract_variation->CurrentMode == "edit") {
		$contract_variation_grid->RowIndex = '$rowindex$';
		$contract_variation_grid->loadRowValues();

		// Set row properties
		$contract_variation->resetAttributes();
		$contract_variation->RowAttrs->merge(["data-rowindex" => $contract_variation_grid->RowIndex, "id" => "r0_contract_variation", "data-rowtype" => ROWTYPE_ADD]);
		$contract_variation->RowAttrs->appendClass("ew-template");
		$contract_variation->RowType = ROWTYPE_ADD;

		// Render row
		$contract_variation_grid->renderRow();

		// Render list options
		$contract_variation_grid->renderListOptions();
		$contract_variation_grid->StartRowCount = 0;
?>
	<tr <?php echo $contract_variation->rowAttributes() ?>>
<?php

// Render list options (body, left)
$contract_variation_grid->ListOptions->render("body", "left", $contract_variation_grid->RowIndex);
?>
	<?php if ($contract_variation_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if (!$contract_variation->isConfirm()) { ?>
<?php if ($contract_variation_grid->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_contract_variation_LACode" class="form-group contract_variation_LACode">
<span<?php echo $contract_variation_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contract_variation_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $contract_variation_grid->RowIndex ?>_LACode" name="x<?php echo $contract_variation_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($contract_variation_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_contract_variation_LACode" class="form-group contract_variation_LACode">
<?php $contract_variation_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $contract_variation_grid->RowIndex ?>_LACode"><?php echo EmptyValue(strval($contract_variation_grid->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $contract_variation_grid->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contract_variation_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($contract_variation_grid->LACode->ReadOnly || $contract_variation_grid->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $contract_variation_grid->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $contract_variation_grid->LACode->Lookup->getParamTag($contract_variation_grid, "p_x" . $contract_variation_grid->RowIndex . "_LACode") ?>
<input type="hidden" data-table="contract_variation" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contract_variation_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $contract_variation_grid->RowIndex ?>_LACode" id="x<?php echo $contract_variation_grid->RowIndex ?>_LACode" value="<?php echo $contract_variation_grid->LACode->CurrentValue ?>"<?php echo $contract_variation_grid->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_contract_variation_LACode" class="form-group contract_variation_LACode">
<span<?php echo $contract_variation_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contract_variation_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="contract_variation" data-field="x_LACode" name="x<?php echo $contract_variation_grid->RowIndex ?>_LACode" id="x<?php echo $contract_variation_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($contract_variation_grid->LACode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="contract_variation" data-field="x_LACode" name="o<?php echo $contract_variation_grid->RowIndex ?>_LACode" id="o<?php echo $contract_variation_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($contract_variation_grid->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($contract_variation_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<?php if (!$contract_variation->isConfirm()) { ?>
<?php if ($contract_variation_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_contract_variation_DepartmentCode" class="form-group contract_variation_DepartmentCode">
<span<?php echo $contract_variation_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contract_variation_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($contract_variation_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_contract_variation_DepartmentCode" class="form-group contract_variation_DepartmentCode">
<?php $contract_variation_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contract_variation" data-field="x_DepartmentCode" data-value-separator="<?php echo $contract_variation_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode"<?php echo $contract_variation_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $contract_variation_grid->DepartmentCode->selectOptionListHtml("x{$contract_variation_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $contract_variation_grid->DepartmentCode->Lookup->getParamTag($contract_variation_grid, "p_x" . $contract_variation_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_contract_variation_DepartmentCode" class="form-group contract_variation_DepartmentCode">
<span<?php echo $contract_variation_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contract_variation_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="contract_variation" data-field="x_DepartmentCode" name="x<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($contract_variation_grid->DepartmentCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="contract_variation" data-field="x_DepartmentCode" name="o<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $contract_variation_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($contract_variation_grid->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($contract_variation_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode">
<?php if (!$contract_variation->isConfirm()) { ?>
<span id="el$rowindex$_contract_variation_SectionCode" class="form-group contract_variation_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contract_variation" data-field="x_SectionCode" data-value-separator="<?php echo $contract_variation_grid->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $contract_variation_grid->RowIndex ?>_SectionCode" name="x<?php echo $contract_variation_grid->RowIndex ?>_SectionCode"<?php echo $contract_variation_grid->SectionCode->editAttributes() ?>>
			<?php echo $contract_variation_grid->SectionCode->selectOptionListHtml("x{$contract_variation_grid->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $contract_variation_grid->SectionCode->Lookup->getParamTag($contract_variation_grid, "p_x" . $contract_variation_grid->RowIndex . "_SectionCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_contract_variation_SectionCode" class="form-group contract_variation_SectionCode">
<span<?php echo $contract_variation_grid->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contract_variation_grid->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="contract_variation" data-field="x_SectionCode" name="x<?php echo $contract_variation_grid->RowIndex ?>_SectionCode" id="x<?php echo $contract_variation_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($contract_variation_grid->SectionCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="contract_variation" data-field="x_SectionCode" name="o<?php echo $contract_variation_grid->RowIndex ?>_SectionCode" id="o<?php echo $contract_variation_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($contract_variation_grid->SectionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($contract_variation_grid->ContractNo->Visible) { // ContractNo ?>
		<td data-name="ContractNo">
<?php if (!$contract_variation->isConfirm()) { ?>
<?php if ($contract_variation_grid->ContractNo->getSessionValue() != "") { ?>
<span id="el$rowindex$_contract_variation_ContractNo" class="form-group contract_variation_ContractNo">
<span<?php echo $contract_variation_grid->ContractNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contract_variation_grid->ContractNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" name="x<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" value="<?php echo HtmlEncode($contract_variation_grid->ContractNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_contract_variation_ContractNo" class="form-group contract_variation_ContractNo">
<input type="text" data-table="contract_variation" data-field="x_ContractNo" name="x<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" id="x<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($contract_variation_grid->ContractNo->getPlaceHolder()) ?>" value="<?php echo $contract_variation_grid->ContractNo->EditValue ?>"<?php echo $contract_variation_grid->ContractNo->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_contract_variation_ContractNo" class="form-group contract_variation_ContractNo">
<span<?php echo $contract_variation_grid->ContractNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contract_variation_grid->ContractNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="contract_variation" data-field="x_ContractNo" name="x<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" id="x<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" value="<?php echo HtmlEncode($contract_variation_grid->ContractNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="contract_variation" data-field="x_ContractNo" name="o<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" id="o<?php echo $contract_variation_grid->RowIndex ?>_ContractNo" value="<?php echo HtmlEncode($contract_variation_grid->ContractNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($contract_variation_grid->VariationAmount->Visible) { // VariationAmount ?>
		<td data-name="VariationAmount">
<?php if (!$contract_variation->isConfirm()) { ?>
<span id="el$rowindex$_contract_variation_VariationAmount" class="form-group contract_variation_VariationAmount">
<input type="text" data-table="contract_variation" data-field="x_VariationAmount" name="x<?php echo $contract_variation_grid->RowIndex ?>_VariationAmount" id="x<?php echo $contract_variation_grid->RowIndex ?>_VariationAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($contract_variation_grid->VariationAmount->getPlaceHolder()) ?>" value="<?php echo $contract_variation_grid->VariationAmount->EditValue ?>"<?php echo $contract_variation_grid->VariationAmount->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_contract_variation_VariationAmount" class="form-group contract_variation_VariationAmount">
<span<?php echo $contract_variation_grid->VariationAmount->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contract_variation_grid->VariationAmount->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="contract_variation" data-field="x_VariationAmount" name="x<?php echo $contract_variation_grid->RowIndex ?>_VariationAmount" id="x<?php echo $contract_variation_grid->RowIndex ?>_VariationAmount" value="<?php echo HtmlEncode($contract_variation_grid->VariationAmount->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="contract_variation" data-field="x_VariationAmount" name="o<?php echo $contract_variation_grid->RowIndex ?>_VariationAmount" id="o<?php echo $contract_variation_grid->RowIndex ?>_VariationAmount" value="<?php echo HtmlEncode($contract_variation_grid->VariationAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($contract_variation_grid->VariationNo->Visible) { // VariationNo ?>
		<td data-name="VariationNo">
<?php if (!$contract_variation->isConfirm()) { ?>
<span id="el$rowindex$_contract_variation_VariationNo" class="form-group contract_variation_VariationNo"></span>
<?php } else { ?>
<span id="el$rowindex$_contract_variation_VariationNo" class="form-group contract_variation_VariationNo">
<span<?php echo $contract_variation_grid->VariationNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contract_variation_grid->VariationNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="contract_variation" data-field="x_VariationNo" name="x<?php echo $contract_variation_grid->RowIndex ?>_VariationNo" id="x<?php echo $contract_variation_grid->RowIndex ?>_VariationNo" value="<?php echo HtmlEncode($contract_variation_grid->VariationNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="contract_variation" data-field="x_VariationNo" name="o<?php echo $contract_variation_grid->RowIndex ?>_VariationNo" id="o<?php echo $contract_variation_grid->RowIndex ?>_VariationNo" value="<?php echo HtmlEncode($contract_variation_grid->VariationNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($contract_variation_grid->VariationDate->Visible) { // VariationDate ?>
		<td data-name="VariationDate">
<?php if (!$contract_variation->isConfirm()) { ?>
<span id="el$rowindex$_contract_variation_VariationDate" class="form-group contract_variation_VariationDate">
<input type="text" data-table="contract_variation" data-field="x_VariationDate" name="x<?php echo $contract_variation_grid->RowIndex ?>_VariationDate" id="x<?php echo $contract_variation_grid->RowIndex ?>_VariationDate" maxlength="10" placeholder="<?php echo HtmlEncode($contract_variation_grid->VariationDate->getPlaceHolder()) ?>" value="<?php echo $contract_variation_grid->VariationDate->EditValue ?>"<?php echo $contract_variation_grid->VariationDate->editAttributes() ?>>
<?php if (!$contract_variation_grid->VariationDate->ReadOnly && !$contract_variation_grid->VariationDate->Disabled && !isset($contract_variation_grid->VariationDate->EditAttrs["readonly"]) && !isset($contract_variation_grid->VariationDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontract_variationgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontract_variationgrid", "x<?php echo $contract_variation_grid->RowIndex ?>_VariationDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_contract_variation_VariationDate" class="form-group contract_variation_VariationDate">
<span<?php echo $contract_variation_grid->VariationDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contract_variation_grid->VariationDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="contract_variation" data-field="x_VariationDate" name="x<?php echo $contract_variation_grid->RowIndex ?>_VariationDate" id="x<?php echo $contract_variation_grid->RowIndex ?>_VariationDate" value="<?php echo HtmlEncode($contract_variation_grid->VariationDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="contract_variation" data-field="x_VariationDate" name="o<?php echo $contract_variation_grid->RowIndex ?>_VariationDate" id="o<?php echo $contract_variation_grid->RowIndex ?>_VariationDate" value="<?php echo HtmlEncode($contract_variation_grid->VariationDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($contract_variation_grid->VariationJustification->Visible) { // VariationJustification ?>
		<td data-name="VariationJustification">
<?php if (!$contract_variation->isConfirm()) { ?>
<span id="el$rowindex$_contract_variation_VariationJustification" class="form-group contract_variation_VariationJustification">
<textarea data-table="contract_variation" data-field="x_VariationJustification" name="x<?php echo $contract_variation_grid->RowIndex ?>_VariationJustification" id="x<?php echo $contract_variation_grid->RowIndex ?>_VariationJustification" cols="35" rows="2" placeholder="<?php echo HtmlEncode($contract_variation_grid->VariationJustification->getPlaceHolder()) ?>"<?php echo $contract_variation_grid->VariationJustification->editAttributes() ?>><?php echo $contract_variation_grid->VariationJustification->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_contract_variation_VariationJustification" class="form-group contract_variation_VariationJustification">
<span<?php echo $contract_variation_grid->VariationJustification->viewAttributes() ?>><?php echo $contract_variation_grid->VariationJustification->ViewValue ?></span>
</span>
<input type="hidden" data-table="contract_variation" data-field="x_VariationJustification" name="x<?php echo $contract_variation_grid->RowIndex ?>_VariationJustification" id="x<?php echo $contract_variation_grid->RowIndex ?>_VariationJustification" value="<?php echo HtmlEncode($contract_variation_grid->VariationJustification->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="contract_variation" data-field="x_VariationJustification" name="o<?php echo $contract_variation_grid->RowIndex ?>_VariationJustification" id="o<?php echo $contract_variation_grid->RowIndex ?>_VariationJustification" value="<?php echo HtmlEncode($contract_variation_grid->VariationJustification->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$contract_variation_grid->ListOptions->render("body", "right", $contract_variation_grid->RowIndex);
?>
<script>
loadjs.ready(["fcontract_variationgrid", "load"], function() {
	fcontract_variationgrid.updateLists(<?php echo $contract_variation_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($contract_variation->CurrentMode == "add" || $contract_variation->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $contract_variation_grid->FormKeyCountName ?>" id="<?php echo $contract_variation_grid->FormKeyCountName ?>" value="<?php echo $contract_variation_grid->KeyCount ?>">
<?php echo $contract_variation_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($contract_variation->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $contract_variation_grid->FormKeyCountName ?>" id="<?php echo $contract_variation_grid->FormKeyCountName ?>" value="<?php echo $contract_variation_grid->KeyCount ?>">
<?php echo $contract_variation_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($contract_variation->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcontract_variationgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($contract_variation_grid->Recordset)
	$contract_variation_grid->Recordset->Close();
?>
<?php if ($contract_variation_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $contract_variation_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($contract_variation_grid->TotalRecords == 0 && !$contract_variation->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $contract_variation_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$contract_variation_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$contract_variation_grid->terminate();
?>