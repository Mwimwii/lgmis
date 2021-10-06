<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($market_property_grid))
	$market_property_grid = new market_property_grid();

// Run the page
$market_property_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$market_property_grid->Page_Render();
?>
<?php if (!$market_property_grid->isExport()) { ?>
<script>
var fmarket_propertygrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fmarket_propertygrid = new ew.Form("fmarket_propertygrid", "grid");
	fmarket_propertygrid.formKeyCountName = '<?php echo $market_property_grid->FormKeyCountName ?>';

	// Validate form
	fmarket_propertygrid.validate = function() {
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
			<?php if ($market_property_grid->MarketItemNo->Required) { ?>
				elm = this.getElements("x" + infix + "_MarketItemNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_property_grid->MarketItemNo->caption(), $market_property_grid->MarketItemNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($market_property_grid->MarketNo->Required) { ?>
				elm = this.getElements("x" + infix + "_MarketNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_property_grid->MarketNo->caption(), $market_property_grid->MarketNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($market_property_grid->ItemName->Required) { ?>
				elm = this.getElements("x" + infix + "_ItemName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_property_grid->ItemName->caption(), $market_property_grid->ItemName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($market_property_grid->ItemRef->Required) { ?>
				elm = this.getElements("x" + infix + "_ItemRef");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_property_grid->ItemRef->caption(), $market_property_grid->ItemRef->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($market_property_grid->ItemLength->Required) { ?>
				elm = this.getElements("x" + infix + "_ItemLength");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_property_grid->ItemLength->caption(), $market_property_grid->ItemLength->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ItemLength");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($market_property_grid->ItemLength->errorMessage()) ?>");
			<?php if ($market_property_grid->ItemWidth->Required) { ?>
				elm = this.getElements("x" + infix + "_ItemWidth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_property_grid->ItemWidth->caption(), $market_property_grid->ItemWidth->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ItemWidth");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($market_property_grid->ItemWidth->errorMessage()) ?>");
			<?php if ($market_property_grid->DefaultFees->Required) { ?>
				elm = this.getElements("x" + infix + "_DefaultFees");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_property_grid->DefaultFees->caption(), $market_property_grid->DefaultFees->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DefaultFees");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($market_property_grid->DefaultFees->errorMessage()) ?>");
			<?php if ($market_property_grid->LastUpdatedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdatedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_property_grid->LastUpdatedBy->caption(), $market_property_grid->LastUpdatedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($market_property_grid->LastUpdateDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_property_grid->LastUpdateDate->caption(), $market_property_grid->LastUpdateDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($market_property_grid->LastUpdateDate->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fmarket_propertygrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "MarketNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "ItemName", false)) return false;
		if (ew.valueChanged(fobj, infix, "ItemRef", false)) return false;
		if (ew.valueChanged(fobj, infix, "ItemLength", false)) return false;
		if (ew.valueChanged(fobj, infix, "ItemWidth", false)) return false;
		if (ew.valueChanged(fobj, infix, "DefaultFees", false)) return false;
		if (ew.valueChanged(fobj, infix, "LastUpdatedBy", false)) return false;
		if (ew.valueChanged(fobj, infix, "LastUpdateDate", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fmarket_propertygrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmarket_propertygrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmarket_propertygrid.lists["x_MarketNo"] = <?php echo $market_property_grid->MarketNo->Lookup->toClientList($market_property_grid) ?>;
	fmarket_propertygrid.lists["x_MarketNo"].options = <?php echo JsonEncode($market_property_grid->MarketNo->lookupOptions()) ?>;
	loadjs.done("fmarket_propertygrid");
});
</script>
<?php } ?>
<?php
$market_property_grid->renderOtherOptions();
?>
<?php if ($market_property_grid->TotalRecords > 0 || $market_property->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($market_property_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> market_property">
<?php if ($market_property_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $market_property_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fmarket_propertygrid" class="ew-form ew-list-form form-inline">
<div id="gmp_market_property" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_market_propertygrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$market_property->RowType = ROWTYPE_HEADER;

// Render list options
$market_property_grid->renderListOptions();

// Render list options (header, left)
$market_property_grid->ListOptions->render("header", "left");
?>
<?php if ($market_property_grid->MarketItemNo->Visible) { // MarketItemNo ?>
	<?php if ($market_property_grid->SortUrl($market_property_grid->MarketItemNo) == "") { ?>
		<th data-name="MarketItemNo" class="<?php echo $market_property_grid->MarketItemNo->headerCellClass() ?>"><div id="elh_market_property_MarketItemNo" class="market_property_MarketItemNo"><div class="ew-table-header-caption"><?php echo $market_property_grid->MarketItemNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MarketItemNo" class="<?php echo $market_property_grid->MarketItemNo->headerCellClass() ?>"><div><div id="elh_market_property_MarketItemNo" class="market_property_MarketItemNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_grid->MarketItemNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_property_grid->MarketItemNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_grid->MarketItemNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_property_grid->MarketNo->Visible) { // MarketNo ?>
	<?php if ($market_property_grid->SortUrl($market_property_grid->MarketNo) == "") { ?>
		<th data-name="MarketNo" class="<?php echo $market_property_grid->MarketNo->headerCellClass() ?>"><div id="elh_market_property_MarketNo" class="market_property_MarketNo"><div class="ew-table-header-caption"><?php echo $market_property_grid->MarketNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MarketNo" class="<?php echo $market_property_grid->MarketNo->headerCellClass() ?>"><div><div id="elh_market_property_MarketNo" class="market_property_MarketNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_grid->MarketNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_property_grid->MarketNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_grid->MarketNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_property_grid->ItemName->Visible) { // ItemName ?>
	<?php if ($market_property_grid->SortUrl($market_property_grid->ItemName) == "") { ?>
		<th data-name="ItemName" class="<?php echo $market_property_grid->ItemName->headerCellClass() ?>"><div id="elh_market_property_ItemName" class="market_property_ItemName"><div class="ew-table-header-caption"><?php echo $market_property_grid->ItemName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ItemName" class="<?php echo $market_property_grid->ItemName->headerCellClass() ?>"><div><div id="elh_market_property_ItemName" class="market_property_ItemName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_grid->ItemName->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_property_grid->ItemName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_grid->ItemName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_property_grid->ItemRef->Visible) { // ItemRef ?>
	<?php if ($market_property_grid->SortUrl($market_property_grid->ItemRef) == "") { ?>
		<th data-name="ItemRef" class="<?php echo $market_property_grid->ItemRef->headerCellClass() ?>"><div id="elh_market_property_ItemRef" class="market_property_ItemRef"><div class="ew-table-header-caption"><?php echo $market_property_grid->ItemRef->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ItemRef" class="<?php echo $market_property_grid->ItemRef->headerCellClass() ?>"><div><div id="elh_market_property_ItemRef" class="market_property_ItemRef">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_grid->ItemRef->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_property_grid->ItemRef->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_grid->ItemRef->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_property_grid->ItemLength->Visible) { // ItemLength ?>
	<?php if ($market_property_grid->SortUrl($market_property_grid->ItemLength) == "") { ?>
		<th data-name="ItemLength" class="<?php echo $market_property_grid->ItemLength->headerCellClass() ?>"><div id="elh_market_property_ItemLength" class="market_property_ItemLength"><div class="ew-table-header-caption"><?php echo $market_property_grid->ItemLength->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ItemLength" class="<?php echo $market_property_grid->ItemLength->headerCellClass() ?>"><div><div id="elh_market_property_ItemLength" class="market_property_ItemLength">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_grid->ItemLength->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_property_grid->ItemLength->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_grid->ItemLength->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_property_grid->ItemWidth->Visible) { // ItemWidth ?>
	<?php if ($market_property_grid->SortUrl($market_property_grid->ItemWidth) == "") { ?>
		<th data-name="ItemWidth" class="<?php echo $market_property_grid->ItemWidth->headerCellClass() ?>"><div id="elh_market_property_ItemWidth" class="market_property_ItemWidth"><div class="ew-table-header-caption"><?php echo $market_property_grid->ItemWidth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ItemWidth" class="<?php echo $market_property_grid->ItemWidth->headerCellClass() ?>"><div><div id="elh_market_property_ItemWidth" class="market_property_ItemWidth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_grid->ItemWidth->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_property_grid->ItemWidth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_grid->ItemWidth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_property_grid->DefaultFees->Visible) { // DefaultFees ?>
	<?php if ($market_property_grid->SortUrl($market_property_grid->DefaultFees) == "") { ?>
		<th data-name="DefaultFees" class="<?php echo $market_property_grid->DefaultFees->headerCellClass() ?>"><div id="elh_market_property_DefaultFees" class="market_property_DefaultFees"><div class="ew-table-header-caption"><?php echo $market_property_grid->DefaultFees->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DefaultFees" class="<?php echo $market_property_grid->DefaultFees->headerCellClass() ?>"><div><div id="elh_market_property_DefaultFees" class="market_property_DefaultFees">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_grid->DefaultFees->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_property_grid->DefaultFees->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_grid->DefaultFees->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_property_grid->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($market_property_grid->SortUrl($market_property_grid->LastUpdatedBy) == "") { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $market_property_grid->LastUpdatedBy->headerCellClass() ?>"><div id="elh_market_property_LastUpdatedBy" class="market_property_LastUpdatedBy"><div class="ew-table-header-caption"><?php echo $market_property_grid->LastUpdatedBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $market_property_grid->LastUpdatedBy->headerCellClass() ?>"><div><div id="elh_market_property_LastUpdatedBy" class="market_property_LastUpdatedBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_grid->LastUpdatedBy->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_property_grid->LastUpdatedBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_grid->LastUpdatedBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_property_grid->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<?php if ($market_property_grid->SortUrl($market_property_grid->LastUpdateDate) == "") { ?>
		<th data-name="LastUpdateDate" class="<?php echo $market_property_grid->LastUpdateDate->headerCellClass() ?>"><div id="elh_market_property_LastUpdateDate" class="market_property_LastUpdateDate"><div class="ew-table-header-caption"><?php echo $market_property_grid->LastUpdateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdateDate" class="<?php echo $market_property_grid->LastUpdateDate->headerCellClass() ?>"><div><div id="elh_market_property_LastUpdateDate" class="market_property_LastUpdateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_grid->LastUpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_property_grid->LastUpdateDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_grid->LastUpdateDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$market_property_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$market_property_grid->StartRecord = 1;
$market_property_grid->StopRecord = $market_property_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($market_property->isConfirm() || $market_property_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($market_property_grid->FormKeyCountName) && ($market_property_grid->isGridAdd() || $market_property_grid->isGridEdit() || $market_property->isConfirm())) {
		$market_property_grid->KeyCount = $CurrentForm->getValue($market_property_grid->FormKeyCountName);
		$market_property_grid->StopRecord = $market_property_grid->StartRecord + $market_property_grid->KeyCount - 1;
	}
}
$market_property_grid->RecordCount = $market_property_grid->StartRecord - 1;
if ($market_property_grid->Recordset && !$market_property_grid->Recordset->EOF) {
	$market_property_grid->Recordset->moveFirst();
	$selectLimit = $market_property_grid->UseSelectLimit;
	if (!$selectLimit && $market_property_grid->StartRecord > 1)
		$market_property_grid->Recordset->move($market_property_grid->StartRecord - 1);
} elseif (!$market_property->AllowAddDeleteRow && $market_property_grid->StopRecord == 0) {
	$market_property_grid->StopRecord = $market_property->GridAddRowCount;
}

// Initialize aggregate
$market_property->RowType = ROWTYPE_AGGREGATEINIT;
$market_property->resetAttributes();
$market_property_grid->renderRow();
if ($market_property_grid->isGridAdd())
	$market_property_grid->RowIndex = 0;
if ($market_property_grid->isGridEdit())
	$market_property_grid->RowIndex = 0;
while ($market_property_grid->RecordCount < $market_property_grid->StopRecord) {
	$market_property_grid->RecordCount++;
	if ($market_property_grid->RecordCount >= $market_property_grid->StartRecord) {
		$market_property_grid->RowCount++;
		if ($market_property_grid->isGridAdd() || $market_property_grid->isGridEdit() || $market_property->isConfirm()) {
			$market_property_grid->RowIndex++;
			$CurrentForm->Index = $market_property_grid->RowIndex;
			if ($CurrentForm->hasValue($market_property_grid->FormActionName) && ($market_property->isConfirm() || $market_property_grid->EventCancelled))
				$market_property_grid->RowAction = strval($CurrentForm->getValue($market_property_grid->FormActionName));
			elseif ($market_property_grid->isGridAdd())
				$market_property_grid->RowAction = "insert";
			else
				$market_property_grid->RowAction = "";
		}

		// Set up key count
		$market_property_grid->KeyCount = $market_property_grid->RowIndex;

		// Init row class and style
		$market_property->resetAttributes();
		$market_property->CssClass = "";
		if ($market_property_grid->isGridAdd()) {
			if ($market_property->CurrentMode == "copy") {
				$market_property_grid->loadRowValues($market_property_grid->Recordset); // Load row values
				$market_property_grid->setRecordKey($market_property_grid->RowOldKey, $market_property_grid->Recordset); // Set old record key
			} else {
				$market_property_grid->loadRowValues(); // Load default values
				$market_property_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$market_property_grid->loadRowValues($market_property_grid->Recordset); // Load row values
		}
		$market_property->RowType = ROWTYPE_VIEW; // Render view
		if ($market_property_grid->isGridAdd()) // Grid add
			$market_property->RowType = ROWTYPE_ADD; // Render add
		if ($market_property_grid->isGridAdd() && $market_property->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$market_property_grid->restoreCurrentRowFormValues($market_property_grid->RowIndex); // Restore form values
		if ($market_property_grid->isGridEdit()) { // Grid edit
			if ($market_property->EventCancelled)
				$market_property_grid->restoreCurrentRowFormValues($market_property_grid->RowIndex); // Restore form values
			if ($market_property_grid->RowAction == "insert")
				$market_property->RowType = ROWTYPE_ADD; // Render add
			else
				$market_property->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($market_property_grid->isGridEdit() && ($market_property->RowType == ROWTYPE_EDIT || $market_property->RowType == ROWTYPE_ADD) && $market_property->EventCancelled) // Update failed
			$market_property_grid->restoreCurrentRowFormValues($market_property_grid->RowIndex); // Restore form values
		if ($market_property->RowType == ROWTYPE_EDIT) // Edit row
			$market_property_grid->EditRowCount++;
		if ($market_property->isConfirm()) // Confirm row
			$market_property_grid->restoreCurrentRowFormValues($market_property_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$market_property->RowAttrs->merge(["data-rowindex" => $market_property_grid->RowCount, "id" => "r" . $market_property_grid->RowCount . "_market_property", "data-rowtype" => $market_property->RowType]);

		// Render row
		$market_property_grid->renderRow();

		// Render list options
		$market_property_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($market_property_grid->RowAction != "delete" && $market_property_grid->RowAction != "insertdelete" && !($market_property_grid->RowAction == "insert" && $market_property->isConfirm() && $market_property_grid->emptyRow())) {
?>
	<tr <?php echo $market_property->rowAttributes() ?>>
<?php

// Render list options (body, left)
$market_property_grid->ListOptions->render("body", "left", $market_property_grid->RowCount);
?>
	<?php if ($market_property_grid->MarketItemNo->Visible) { // MarketItemNo ?>
		<td data-name="MarketItemNo" <?php echo $market_property_grid->MarketItemNo->cellAttributes() ?>>
<?php if ($market_property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_MarketItemNo" class="form-group"></span>
<input type="hidden" data-table="market_property" data-field="x_MarketItemNo" name="o<?php echo $market_property_grid->RowIndex ?>_MarketItemNo" id="o<?php echo $market_property_grid->RowIndex ?>_MarketItemNo" value="<?php echo HtmlEncode($market_property_grid->MarketItemNo->OldValue) ?>">
<?php } ?>
<?php if ($market_property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_MarketItemNo" class="form-group">
<span<?php echo $market_property_grid->MarketItemNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_property_grid->MarketItemNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="market_property" data-field="x_MarketItemNo" name="x<?php echo $market_property_grid->RowIndex ?>_MarketItemNo" id="x<?php echo $market_property_grid->RowIndex ?>_MarketItemNo" value="<?php echo HtmlEncode($market_property_grid->MarketItemNo->CurrentValue) ?>">
<?php } ?>
<?php if ($market_property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_MarketItemNo">
<span<?php echo $market_property_grid->MarketItemNo->viewAttributes() ?>><?php echo $market_property_grid->MarketItemNo->getViewValue() ?></span>
</span>
<?php if (!$market_property->isConfirm()) { ?>
<input type="hidden" data-table="market_property" data-field="x_MarketItemNo" name="x<?php echo $market_property_grid->RowIndex ?>_MarketItemNo" id="x<?php echo $market_property_grid->RowIndex ?>_MarketItemNo" value="<?php echo HtmlEncode($market_property_grid->MarketItemNo->FormValue) ?>">
<input type="hidden" data-table="market_property" data-field="x_MarketItemNo" name="o<?php echo $market_property_grid->RowIndex ?>_MarketItemNo" id="o<?php echo $market_property_grid->RowIndex ?>_MarketItemNo" value="<?php echo HtmlEncode($market_property_grid->MarketItemNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="market_property" data-field="x_MarketItemNo" name="fmarket_propertygrid$x<?php echo $market_property_grid->RowIndex ?>_MarketItemNo" id="fmarket_propertygrid$x<?php echo $market_property_grid->RowIndex ?>_MarketItemNo" value="<?php echo HtmlEncode($market_property_grid->MarketItemNo->FormValue) ?>">
<input type="hidden" data-table="market_property" data-field="x_MarketItemNo" name="fmarket_propertygrid$o<?php echo $market_property_grid->RowIndex ?>_MarketItemNo" id="fmarket_propertygrid$o<?php echo $market_property_grid->RowIndex ?>_MarketItemNo" value="<?php echo HtmlEncode($market_property_grid->MarketItemNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($market_property_grid->MarketNo->Visible) { // MarketNo ?>
		<td data-name="MarketNo" <?php echo $market_property_grid->MarketNo->cellAttributes() ?>>
<?php if ($market_property->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($market_property_grid->MarketNo->getSessionValue() != "") { ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_MarketNo" class="form-group">
<span<?php echo $market_property_grid->MarketNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_property_grid->MarketNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $market_property_grid->RowIndex ?>_MarketNo" name="x<?php echo $market_property_grid->RowIndex ?>_MarketNo" value="<?php echo HtmlEncode($market_property_grid->MarketNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_MarketNo" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="market_property" data-field="x_MarketNo" data-value-separator="<?php echo $market_property_grid->MarketNo->displayValueSeparatorAttribute() ?>" id="x<?php echo $market_property_grid->RowIndex ?>_MarketNo" name="x<?php echo $market_property_grid->RowIndex ?>_MarketNo"<?php echo $market_property_grid->MarketNo->editAttributes() ?>>
			<?php echo $market_property_grid->MarketNo->selectOptionListHtml("x{$market_property_grid->RowIndex}_MarketNo") ?>
		</select>
</div>
<?php echo $market_property_grid->MarketNo->Lookup->getParamTag($market_property_grid, "p_x" . $market_property_grid->RowIndex . "_MarketNo") ?>
</span>
<?php } ?>
<input type="hidden" data-table="market_property" data-field="x_MarketNo" name="o<?php echo $market_property_grid->RowIndex ?>_MarketNo" id="o<?php echo $market_property_grid->RowIndex ?>_MarketNo" value="<?php echo HtmlEncode($market_property_grid->MarketNo->OldValue) ?>">
<?php } ?>
<?php if ($market_property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($market_property_grid->MarketNo->getSessionValue() != "") { ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_MarketNo" class="form-group">
<span<?php echo $market_property_grid->MarketNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_property_grid->MarketNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $market_property_grid->RowIndex ?>_MarketNo" name="x<?php echo $market_property_grid->RowIndex ?>_MarketNo" value="<?php echo HtmlEncode($market_property_grid->MarketNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_MarketNo" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="market_property" data-field="x_MarketNo" data-value-separator="<?php echo $market_property_grid->MarketNo->displayValueSeparatorAttribute() ?>" id="x<?php echo $market_property_grid->RowIndex ?>_MarketNo" name="x<?php echo $market_property_grid->RowIndex ?>_MarketNo"<?php echo $market_property_grid->MarketNo->editAttributes() ?>>
			<?php echo $market_property_grid->MarketNo->selectOptionListHtml("x{$market_property_grid->RowIndex}_MarketNo") ?>
		</select>
</div>
<?php echo $market_property_grid->MarketNo->Lookup->getParamTag($market_property_grid, "p_x" . $market_property_grid->RowIndex . "_MarketNo") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($market_property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_MarketNo">
<span<?php echo $market_property_grid->MarketNo->viewAttributes() ?>><?php echo $market_property_grid->MarketNo->getViewValue() ?></span>
</span>
<?php if (!$market_property->isConfirm()) { ?>
<input type="hidden" data-table="market_property" data-field="x_MarketNo" name="x<?php echo $market_property_grid->RowIndex ?>_MarketNo" id="x<?php echo $market_property_grid->RowIndex ?>_MarketNo" value="<?php echo HtmlEncode($market_property_grid->MarketNo->FormValue) ?>">
<input type="hidden" data-table="market_property" data-field="x_MarketNo" name="o<?php echo $market_property_grid->RowIndex ?>_MarketNo" id="o<?php echo $market_property_grid->RowIndex ?>_MarketNo" value="<?php echo HtmlEncode($market_property_grid->MarketNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="market_property" data-field="x_MarketNo" name="fmarket_propertygrid$x<?php echo $market_property_grid->RowIndex ?>_MarketNo" id="fmarket_propertygrid$x<?php echo $market_property_grid->RowIndex ?>_MarketNo" value="<?php echo HtmlEncode($market_property_grid->MarketNo->FormValue) ?>">
<input type="hidden" data-table="market_property" data-field="x_MarketNo" name="fmarket_propertygrid$o<?php echo $market_property_grid->RowIndex ?>_MarketNo" id="fmarket_propertygrid$o<?php echo $market_property_grid->RowIndex ?>_MarketNo" value="<?php echo HtmlEncode($market_property_grid->MarketNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($market_property_grid->ItemName->Visible) { // ItemName ?>
		<td data-name="ItemName" <?php echo $market_property_grid->ItemName->cellAttributes() ?>>
<?php if ($market_property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_ItemName" class="form-group">
<input type="text" data-table="market_property" data-field="x_ItemName" name="x<?php echo $market_property_grid->RowIndex ?>_ItemName" id="x<?php echo $market_property_grid->RowIndex ?>_ItemName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($market_property_grid->ItemName->getPlaceHolder()) ?>" value="<?php echo $market_property_grid->ItemName->EditValue ?>"<?php echo $market_property_grid->ItemName->editAttributes() ?>>
</span>
<input type="hidden" data-table="market_property" data-field="x_ItemName" name="o<?php echo $market_property_grid->RowIndex ?>_ItemName" id="o<?php echo $market_property_grid->RowIndex ?>_ItemName" value="<?php echo HtmlEncode($market_property_grid->ItemName->OldValue) ?>">
<?php } ?>
<?php if ($market_property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_ItemName" class="form-group">
<input type="text" data-table="market_property" data-field="x_ItemName" name="x<?php echo $market_property_grid->RowIndex ?>_ItemName" id="x<?php echo $market_property_grid->RowIndex ?>_ItemName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($market_property_grid->ItemName->getPlaceHolder()) ?>" value="<?php echo $market_property_grid->ItemName->EditValue ?>"<?php echo $market_property_grid->ItemName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($market_property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_ItemName">
<span<?php echo $market_property_grid->ItemName->viewAttributes() ?>><?php echo $market_property_grid->ItemName->getViewValue() ?></span>
</span>
<?php if (!$market_property->isConfirm()) { ?>
<input type="hidden" data-table="market_property" data-field="x_ItemName" name="x<?php echo $market_property_grid->RowIndex ?>_ItemName" id="x<?php echo $market_property_grid->RowIndex ?>_ItemName" value="<?php echo HtmlEncode($market_property_grid->ItemName->FormValue) ?>">
<input type="hidden" data-table="market_property" data-field="x_ItemName" name="o<?php echo $market_property_grid->RowIndex ?>_ItemName" id="o<?php echo $market_property_grid->RowIndex ?>_ItemName" value="<?php echo HtmlEncode($market_property_grid->ItemName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="market_property" data-field="x_ItemName" name="fmarket_propertygrid$x<?php echo $market_property_grid->RowIndex ?>_ItemName" id="fmarket_propertygrid$x<?php echo $market_property_grid->RowIndex ?>_ItemName" value="<?php echo HtmlEncode($market_property_grid->ItemName->FormValue) ?>">
<input type="hidden" data-table="market_property" data-field="x_ItemName" name="fmarket_propertygrid$o<?php echo $market_property_grid->RowIndex ?>_ItemName" id="fmarket_propertygrid$o<?php echo $market_property_grid->RowIndex ?>_ItemName" value="<?php echo HtmlEncode($market_property_grid->ItemName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($market_property_grid->ItemRef->Visible) { // ItemRef ?>
		<td data-name="ItemRef" <?php echo $market_property_grid->ItemRef->cellAttributes() ?>>
<?php if ($market_property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_ItemRef" class="form-group">
<input type="text" data-table="market_property" data-field="x_ItemRef" name="x<?php echo $market_property_grid->RowIndex ?>_ItemRef" id="x<?php echo $market_property_grid->RowIndex ?>_ItemRef" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($market_property_grid->ItemRef->getPlaceHolder()) ?>" value="<?php echo $market_property_grid->ItemRef->EditValue ?>"<?php echo $market_property_grid->ItemRef->editAttributes() ?>>
</span>
<input type="hidden" data-table="market_property" data-field="x_ItemRef" name="o<?php echo $market_property_grid->RowIndex ?>_ItemRef" id="o<?php echo $market_property_grid->RowIndex ?>_ItemRef" value="<?php echo HtmlEncode($market_property_grid->ItemRef->OldValue) ?>">
<?php } ?>
<?php if ($market_property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_ItemRef" class="form-group">
<input type="text" data-table="market_property" data-field="x_ItemRef" name="x<?php echo $market_property_grid->RowIndex ?>_ItemRef" id="x<?php echo $market_property_grid->RowIndex ?>_ItemRef" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($market_property_grid->ItemRef->getPlaceHolder()) ?>" value="<?php echo $market_property_grid->ItemRef->EditValue ?>"<?php echo $market_property_grid->ItemRef->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($market_property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_ItemRef">
<span<?php echo $market_property_grid->ItemRef->viewAttributes() ?>><?php echo $market_property_grid->ItemRef->getViewValue() ?></span>
</span>
<?php if (!$market_property->isConfirm()) { ?>
<input type="hidden" data-table="market_property" data-field="x_ItemRef" name="x<?php echo $market_property_grid->RowIndex ?>_ItemRef" id="x<?php echo $market_property_grid->RowIndex ?>_ItemRef" value="<?php echo HtmlEncode($market_property_grid->ItemRef->FormValue) ?>">
<input type="hidden" data-table="market_property" data-field="x_ItemRef" name="o<?php echo $market_property_grid->RowIndex ?>_ItemRef" id="o<?php echo $market_property_grid->RowIndex ?>_ItemRef" value="<?php echo HtmlEncode($market_property_grid->ItemRef->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="market_property" data-field="x_ItemRef" name="fmarket_propertygrid$x<?php echo $market_property_grid->RowIndex ?>_ItemRef" id="fmarket_propertygrid$x<?php echo $market_property_grid->RowIndex ?>_ItemRef" value="<?php echo HtmlEncode($market_property_grid->ItemRef->FormValue) ?>">
<input type="hidden" data-table="market_property" data-field="x_ItemRef" name="fmarket_propertygrid$o<?php echo $market_property_grid->RowIndex ?>_ItemRef" id="fmarket_propertygrid$o<?php echo $market_property_grid->RowIndex ?>_ItemRef" value="<?php echo HtmlEncode($market_property_grid->ItemRef->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($market_property_grid->ItemLength->Visible) { // ItemLength ?>
		<td data-name="ItemLength" <?php echo $market_property_grid->ItemLength->cellAttributes() ?>>
<?php if ($market_property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_ItemLength" class="form-group">
<input type="text" data-table="market_property" data-field="x_ItemLength" name="x<?php echo $market_property_grid->RowIndex ?>_ItemLength" id="x<?php echo $market_property_grid->RowIndex ?>_ItemLength" size="30" placeholder="<?php echo HtmlEncode($market_property_grid->ItemLength->getPlaceHolder()) ?>" value="<?php echo $market_property_grid->ItemLength->EditValue ?>"<?php echo $market_property_grid->ItemLength->editAttributes() ?>>
</span>
<input type="hidden" data-table="market_property" data-field="x_ItemLength" name="o<?php echo $market_property_grid->RowIndex ?>_ItemLength" id="o<?php echo $market_property_grid->RowIndex ?>_ItemLength" value="<?php echo HtmlEncode($market_property_grid->ItemLength->OldValue) ?>">
<?php } ?>
<?php if ($market_property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_ItemLength" class="form-group">
<input type="text" data-table="market_property" data-field="x_ItemLength" name="x<?php echo $market_property_grid->RowIndex ?>_ItemLength" id="x<?php echo $market_property_grid->RowIndex ?>_ItemLength" size="30" placeholder="<?php echo HtmlEncode($market_property_grid->ItemLength->getPlaceHolder()) ?>" value="<?php echo $market_property_grid->ItemLength->EditValue ?>"<?php echo $market_property_grid->ItemLength->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($market_property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_ItemLength">
<span<?php echo $market_property_grid->ItemLength->viewAttributes() ?>><?php echo $market_property_grid->ItemLength->getViewValue() ?></span>
</span>
<?php if (!$market_property->isConfirm()) { ?>
<input type="hidden" data-table="market_property" data-field="x_ItemLength" name="x<?php echo $market_property_grid->RowIndex ?>_ItemLength" id="x<?php echo $market_property_grid->RowIndex ?>_ItemLength" value="<?php echo HtmlEncode($market_property_grid->ItemLength->FormValue) ?>">
<input type="hidden" data-table="market_property" data-field="x_ItemLength" name="o<?php echo $market_property_grid->RowIndex ?>_ItemLength" id="o<?php echo $market_property_grid->RowIndex ?>_ItemLength" value="<?php echo HtmlEncode($market_property_grid->ItemLength->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="market_property" data-field="x_ItemLength" name="fmarket_propertygrid$x<?php echo $market_property_grid->RowIndex ?>_ItemLength" id="fmarket_propertygrid$x<?php echo $market_property_grid->RowIndex ?>_ItemLength" value="<?php echo HtmlEncode($market_property_grid->ItemLength->FormValue) ?>">
<input type="hidden" data-table="market_property" data-field="x_ItemLength" name="fmarket_propertygrid$o<?php echo $market_property_grid->RowIndex ?>_ItemLength" id="fmarket_propertygrid$o<?php echo $market_property_grid->RowIndex ?>_ItemLength" value="<?php echo HtmlEncode($market_property_grid->ItemLength->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($market_property_grid->ItemWidth->Visible) { // ItemWidth ?>
		<td data-name="ItemWidth" <?php echo $market_property_grid->ItemWidth->cellAttributes() ?>>
<?php if ($market_property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_ItemWidth" class="form-group">
<input type="text" data-table="market_property" data-field="x_ItemWidth" name="x<?php echo $market_property_grid->RowIndex ?>_ItemWidth" id="x<?php echo $market_property_grid->RowIndex ?>_ItemWidth" size="30" placeholder="<?php echo HtmlEncode($market_property_grid->ItemWidth->getPlaceHolder()) ?>" value="<?php echo $market_property_grid->ItemWidth->EditValue ?>"<?php echo $market_property_grid->ItemWidth->editAttributes() ?>>
</span>
<input type="hidden" data-table="market_property" data-field="x_ItemWidth" name="o<?php echo $market_property_grid->RowIndex ?>_ItemWidth" id="o<?php echo $market_property_grid->RowIndex ?>_ItemWidth" value="<?php echo HtmlEncode($market_property_grid->ItemWidth->OldValue) ?>">
<?php } ?>
<?php if ($market_property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_ItemWidth" class="form-group">
<input type="text" data-table="market_property" data-field="x_ItemWidth" name="x<?php echo $market_property_grid->RowIndex ?>_ItemWidth" id="x<?php echo $market_property_grid->RowIndex ?>_ItemWidth" size="30" placeholder="<?php echo HtmlEncode($market_property_grid->ItemWidth->getPlaceHolder()) ?>" value="<?php echo $market_property_grid->ItemWidth->EditValue ?>"<?php echo $market_property_grid->ItemWidth->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($market_property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_ItemWidth">
<span<?php echo $market_property_grid->ItemWidth->viewAttributes() ?>><?php echo $market_property_grid->ItemWidth->getViewValue() ?></span>
</span>
<?php if (!$market_property->isConfirm()) { ?>
<input type="hidden" data-table="market_property" data-field="x_ItemWidth" name="x<?php echo $market_property_grid->RowIndex ?>_ItemWidth" id="x<?php echo $market_property_grid->RowIndex ?>_ItemWidth" value="<?php echo HtmlEncode($market_property_grid->ItemWidth->FormValue) ?>">
<input type="hidden" data-table="market_property" data-field="x_ItemWidth" name="o<?php echo $market_property_grid->RowIndex ?>_ItemWidth" id="o<?php echo $market_property_grid->RowIndex ?>_ItemWidth" value="<?php echo HtmlEncode($market_property_grid->ItemWidth->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="market_property" data-field="x_ItemWidth" name="fmarket_propertygrid$x<?php echo $market_property_grid->RowIndex ?>_ItemWidth" id="fmarket_propertygrid$x<?php echo $market_property_grid->RowIndex ?>_ItemWidth" value="<?php echo HtmlEncode($market_property_grid->ItemWidth->FormValue) ?>">
<input type="hidden" data-table="market_property" data-field="x_ItemWidth" name="fmarket_propertygrid$o<?php echo $market_property_grid->RowIndex ?>_ItemWidth" id="fmarket_propertygrid$o<?php echo $market_property_grid->RowIndex ?>_ItemWidth" value="<?php echo HtmlEncode($market_property_grid->ItemWidth->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($market_property_grid->DefaultFees->Visible) { // DefaultFees ?>
		<td data-name="DefaultFees" <?php echo $market_property_grid->DefaultFees->cellAttributes() ?>>
<?php if ($market_property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_DefaultFees" class="form-group">
<input type="text" data-table="market_property" data-field="x_DefaultFees" name="x<?php echo $market_property_grid->RowIndex ?>_DefaultFees" id="x<?php echo $market_property_grid->RowIndex ?>_DefaultFees" size="30" placeholder="<?php echo HtmlEncode($market_property_grid->DefaultFees->getPlaceHolder()) ?>" value="<?php echo $market_property_grid->DefaultFees->EditValue ?>"<?php echo $market_property_grid->DefaultFees->editAttributes() ?>>
</span>
<input type="hidden" data-table="market_property" data-field="x_DefaultFees" name="o<?php echo $market_property_grid->RowIndex ?>_DefaultFees" id="o<?php echo $market_property_grid->RowIndex ?>_DefaultFees" value="<?php echo HtmlEncode($market_property_grid->DefaultFees->OldValue) ?>">
<?php } ?>
<?php if ($market_property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_DefaultFees" class="form-group">
<input type="text" data-table="market_property" data-field="x_DefaultFees" name="x<?php echo $market_property_grid->RowIndex ?>_DefaultFees" id="x<?php echo $market_property_grid->RowIndex ?>_DefaultFees" size="30" placeholder="<?php echo HtmlEncode($market_property_grid->DefaultFees->getPlaceHolder()) ?>" value="<?php echo $market_property_grid->DefaultFees->EditValue ?>"<?php echo $market_property_grid->DefaultFees->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($market_property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_DefaultFees">
<span<?php echo $market_property_grid->DefaultFees->viewAttributes() ?>><?php echo $market_property_grid->DefaultFees->getViewValue() ?></span>
</span>
<?php if (!$market_property->isConfirm()) { ?>
<input type="hidden" data-table="market_property" data-field="x_DefaultFees" name="x<?php echo $market_property_grid->RowIndex ?>_DefaultFees" id="x<?php echo $market_property_grid->RowIndex ?>_DefaultFees" value="<?php echo HtmlEncode($market_property_grid->DefaultFees->FormValue) ?>">
<input type="hidden" data-table="market_property" data-field="x_DefaultFees" name="o<?php echo $market_property_grid->RowIndex ?>_DefaultFees" id="o<?php echo $market_property_grid->RowIndex ?>_DefaultFees" value="<?php echo HtmlEncode($market_property_grid->DefaultFees->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="market_property" data-field="x_DefaultFees" name="fmarket_propertygrid$x<?php echo $market_property_grid->RowIndex ?>_DefaultFees" id="fmarket_propertygrid$x<?php echo $market_property_grid->RowIndex ?>_DefaultFees" value="<?php echo HtmlEncode($market_property_grid->DefaultFees->FormValue) ?>">
<input type="hidden" data-table="market_property" data-field="x_DefaultFees" name="fmarket_propertygrid$o<?php echo $market_property_grid->RowIndex ?>_DefaultFees" id="fmarket_propertygrid$o<?php echo $market_property_grid->RowIndex ?>_DefaultFees" value="<?php echo HtmlEncode($market_property_grid->DefaultFees->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($market_property_grid->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td data-name="LastUpdatedBy" <?php echo $market_property_grid->LastUpdatedBy->cellAttributes() ?>>
<?php if ($market_property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_LastUpdatedBy" class="form-group">
<input type="text" data-table="market_property" data-field="x_LastUpdatedBy" name="x<?php echo $market_property_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $market_property_grid->RowIndex ?>_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($market_property_grid->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $market_property_grid->LastUpdatedBy->EditValue ?>"<?php echo $market_property_grid->LastUpdatedBy->editAttributes() ?>>
</span>
<input type="hidden" data-table="market_property" data-field="x_LastUpdatedBy" name="o<?php echo $market_property_grid->RowIndex ?>_LastUpdatedBy" id="o<?php echo $market_property_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($market_property_grid->LastUpdatedBy->OldValue) ?>">
<?php } ?>
<?php if ($market_property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_LastUpdatedBy" class="form-group">
<input type="text" data-table="market_property" data-field="x_LastUpdatedBy" name="x<?php echo $market_property_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $market_property_grid->RowIndex ?>_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($market_property_grid->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $market_property_grid->LastUpdatedBy->EditValue ?>"<?php echo $market_property_grid->LastUpdatedBy->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($market_property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_LastUpdatedBy">
<span<?php echo $market_property_grid->LastUpdatedBy->viewAttributes() ?>><?php echo $market_property_grid->LastUpdatedBy->getViewValue() ?></span>
</span>
<?php if (!$market_property->isConfirm()) { ?>
<input type="hidden" data-table="market_property" data-field="x_LastUpdatedBy" name="x<?php echo $market_property_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $market_property_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($market_property_grid->LastUpdatedBy->FormValue) ?>">
<input type="hidden" data-table="market_property" data-field="x_LastUpdatedBy" name="o<?php echo $market_property_grid->RowIndex ?>_LastUpdatedBy" id="o<?php echo $market_property_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($market_property_grid->LastUpdatedBy->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="market_property" data-field="x_LastUpdatedBy" name="fmarket_propertygrid$x<?php echo $market_property_grid->RowIndex ?>_LastUpdatedBy" id="fmarket_propertygrid$x<?php echo $market_property_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($market_property_grid->LastUpdatedBy->FormValue) ?>">
<input type="hidden" data-table="market_property" data-field="x_LastUpdatedBy" name="fmarket_propertygrid$o<?php echo $market_property_grid->RowIndex ?>_LastUpdatedBy" id="fmarket_propertygrid$o<?php echo $market_property_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($market_property_grid->LastUpdatedBy->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($market_property_grid->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td data-name="LastUpdateDate" <?php echo $market_property_grid->LastUpdateDate->cellAttributes() ?>>
<?php if ($market_property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_LastUpdateDate" class="form-group">
<input type="text" data-table="market_property" data-field="x_LastUpdateDate" name="x<?php echo $market_property_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $market_property_grid->RowIndex ?>_LastUpdateDate" placeholder="<?php echo HtmlEncode($market_property_grid->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $market_property_grid->LastUpdateDate->EditValue ?>"<?php echo $market_property_grid->LastUpdateDate->editAttributes() ?>>
</span>
<input type="hidden" data-table="market_property" data-field="x_LastUpdateDate" name="o<?php echo $market_property_grid->RowIndex ?>_LastUpdateDate" id="o<?php echo $market_property_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($market_property_grid->LastUpdateDate->OldValue) ?>">
<?php } ?>
<?php if ($market_property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_LastUpdateDate" class="form-group">
<input type="text" data-table="market_property" data-field="x_LastUpdateDate" name="x<?php echo $market_property_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $market_property_grid->RowIndex ?>_LastUpdateDate" placeholder="<?php echo HtmlEncode($market_property_grid->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $market_property_grid->LastUpdateDate->EditValue ?>"<?php echo $market_property_grid->LastUpdateDate->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($market_property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $market_property_grid->RowCount ?>_market_property_LastUpdateDate">
<span<?php echo $market_property_grid->LastUpdateDate->viewAttributes() ?>><?php echo $market_property_grid->LastUpdateDate->getViewValue() ?></span>
</span>
<?php if (!$market_property->isConfirm()) { ?>
<input type="hidden" data-table="market_property" data-field="x_LastUpdateDate" name="x<?php echo $market_property_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $market_property_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($market_property_grid->LastUpdateDate->FormValue) ?>">
<input type="hidden" data-table="market_property" data-field="x_LastUpdateDate" name="o<?php echo $market_property_grid->RowIndex ?>_LastUpdateDate" id="o<?php echo $market_property_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($market_property_grid->LastUpdateDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="market_property" data-field="x_LastUpdateDate" name="fmarket_propertygrid$x<?php echo $market_property_grid->RowIndex ?>_LastUpdateDate" id="fmarket_propertygrid$x<?php echo $market_property_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($market_property_grid->LastUpdateDate->FormValue) ?>">
<input type="hidden" data-table="market_property" data-field="x_LastUpdateDate" name="fmarket_propertygrid$o<?php echo $market_property_grid->RowIndex ?>_LastUpdateDate" id="fmarket_propertygrid$o<?php echo $market_property_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($market_property_grid->LastUpdateDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$market_property_grid->ListOptions->render("body", "right", $market_property_grid->RowCount);
?>
	</tr>
<?php if ($market_property->RowType == ROWTYPE_ADD || $market_property->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fmarket_propertygrid", "load"], function() {
	fmarket_propertygrid.updateLists(<?php echo $market_property_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$market_property_grid->isGridAdd() || $market_property->CurrentMode == "copy")
		if (!$market_property_grid->Recordset->EOF)
			$market_property_grid->Recordset->moveNext();
}
?>
<?php
	if ($market_property->CurrentMode == "add" || $market_property->CurrentMode == "copy" || $market_property->CurrentMode == "edit") {
		$market_property_grid->RowIndex = '$rowindex$';
		$market_property_grid->loadRowValues();

		// Set row properties
		$market_property->resetAttributes();
		$market_property->RowAttrs->merge(["data-rowindex" => $market_property_grid->RowIndex, "id" => "r0_market_property", "data-rowtype" => ROWTYPE_ADD]);
		$market_property->RowAttrs->appendClass("ew-template");
		$market_property->RowType = ROWTYPE_ADD;

		// Render row
		$market_property_grid->renderRow();

		// Render list options
		$market_property_grid->renderListOptions();
		$market_property_grid->StartRowCount = 0;
?>
	<tr <?php echo $market_property->rowAttributes() ?>>
<?php

// Render list options (body, left)
$market_property_grid->ListOptions->render("body", "left", $market_property_grid->RowIndex);
?>
	<?php if ($market_property_grid->MarketItemNo->Visible) { // MarketItemNo ?>
		<td data-name="MarketItemNo">
<?php if (!$market_property->isConfirm()) { ?>
<span id="el$rowindex$_market_property_MarketItemNo" class="form-group market_property_MarketItemNo"></span>
<?php } else { ?>
<span id="el$rowindex$_market_property_MarketItemNo" class="form-group market_property_MarketItemNo">
<span<?php echo $market_property_grid->MarketItemNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_property_grid->MarketItemNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="market_property" data-field="x_MarketItemNo" name="x<?php echo $market_property_grid->RowIndex ?>_MarketItemNo" id="x<?php echo $market_property_grid->RowIndex ?>_MarketItemNo" value="<?php echo HtmlEncode($market_property_grid->MarketItemNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="market_property" data-field="x_MarketItemNo" name="o<?php echo $market_property_grid->RowIndex ?>_MarketItemNo" id="o<?php echo $market_property_grid->RowIndex ?>_MarketItemNo" value="<?php echo HtmlEncode($market_property_grid->MarketItemNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($market_property_grid->MarketNo->Visible) { // MarketNo ?>
		<td data-name="MarketNo">
<?php if (!$market_property->isConfirm()) { ?>
<?php if ($market_property_grid->MarketNo->getSessionValue() != "") { ?>
<span id="el$rowindex$_market_property_MarketNo" class="form-group market_property_MarketNo">
<span<?php echo $market_property_grid->MarketNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_property_grid->MarketNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $market_property_grid->RowIndex ?>_MarketNo" name="x<?php echo $market_property_grid->RowIndex ?>_MarketNo" value="<?php echo HtmlEncode($market_property_grid->MarketNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_market_property_MarketNo" class="form-group market_property_MarketNo">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="market_property" data-field="x_MarketNo" data-value-separator="<?php echo $market_property_grid->MarketNo->displayValueSeparatorAttribute() ?>" id="x<?php echo $market_property_grid->RowIndex ?>_MarketNo" name="x<?php echo $market_property_grid->RowIndex ?>_MarketNo"<?php echo $market_property_grid->MarketNo->editAttributes() ?>>
			<?php echo $market_property_grid->MarketNo->selectOptionListHtml("x{$market_property_grid->RowIndex}_MarketNo") ?>
		</select>
</div>
<?php echo $market_property_grid->MarketNo->Lookup->getParamTag($market_property_grid, "p_x" . $market_property_grid->RowIndex . "_MarketNo") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_market_property_MarketNo" class="form-group market_property_MarketNo">
<span<?php echo $market_property_grid->MarketNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_property_grid->MarketNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="market_property" data-field="x_MarketNo" name="x<?php echo $market_property_grid->RowIndex ?>_MarketNo" id="x<?php echo $market_property_grid->RowIndex ?>_MarketNo" value="<?php echo HtmlEncode($market_property_grid->MarketNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="market_property" data-field="x_MarketNo" name="o<?php echo $market_property_grid->RowIndex ?>_MarketNo" id="o<?php echo $market_property_grid->RowIndex ?>_MarketNo" value="<?php echo HtmlEncode($market_property_grid->MarketNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($market_property_grid->ItemName->Visible) { // ItemName ?>
		<td data-name="ItemName">
<?php if (!$market_property->isConfirm()) { ?>
<span id="el$rowindex$_market_property_ItemName" class="form-group market_property_ItemName">
<input type="text" data-table="market_property" data-field="x_ItemName" name="x<?php echo $market_property_grid->RowIndex ?>_ItemName" id="x<?php echo $market_property_grid->RowIndex ?>_ItemName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($market_property_grid->ItemName->getPlaceHolder()) ?>" value="<?php echo $market_property_grid->ItemName->EditValue ?>"<?php echo $market_property_grid->ItemName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_market_property_ItemName" class="form-group market_property_ItemName">
<span<?php echo $market_property_grid->ItemName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_property_grid->ItemName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="market_property" data-field="x_ItemName" name="x<?php echo $market_property_grid->RowIndex ?>_ItemName" id="x<?php echo $market_property_grid->RowIndex ?>_ItemName" value="<?php echo HtmlEncode($market_property_grid->ItemName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="market_property" data-field="x_ItemName" name="o<?php echo $market_property_grid->RowIndex ?>_ItemName" id="o<?php echo $market_property_grid->RowIndex ?>_ItemName" value="<?php echo HtmlEncode($market_property_grid->ItemName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($market_property_grid->ItemRef->Visible) { // ItemRef ?>
		<td data-name="ItemRef">
<?php if (!$market_property->isConfirm()) { ?>
<span id="el$rowindex$_market_property_ItemRef" class="form-group market_property_ItemRef">
<input type="text" data-table="market_property" data-field="x_ItemRef" name="x<?php echo $market_property_grid->RowIndex ?>_ItemRef" id="x<?php echo $market_property_grid->RowIndex ?>_ItemRef" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($market_property_grid->ItemRef->getPlaceHolder()) ?>" value="<?php echo $market_property_grid->ItemRef->EditValue ?>"<?php echo $market_property_grid->ItemRef->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_market_property_ItemRef" class="form-group market_property_ItemRef">
<span<?php echo $market_property_grid->ItemRef->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_property_grid->ItemRef->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="market_property" data-field="x_ItemRef" name="x<?php echo $market_property_grid->RowIndex ?>_ItemRef" id="x<?php echo $market_property_grid->RowIndex ?>_ItemRef" value="<?php echo HtmlEncode($market_property_grid->ItemRef->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="market_property" data-field="x_ItemRef" name="o<?php echo $market_property_grid->RowIndex ?>_ItemRef" id="o<?php echo $market_property_grid->RowIndex ?>_ItemRef" value="<?php echo HtmlEncode($market_property_grid->ItemRef->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($market_property_grid->ItemLength->Visible) { // ItemLength ?>
		<td data-name="ItemLength">
<?php if (!$market_property->isConfirm()) { ?>
<span id="el$rowindex$_market_property_ItemLength" class="form-group market_property_ItemLength">
<input type="text" data-table="market_property" data-field="x_ItemLength" name="x<?php echo $market_property_grid->RowIndex ?>_ItemLength" id="x<?php echo $market_property_grid->RowIndex ?>_ItemLength" size="30" placeholder="<?php echo HtmlEncode($market_property_grid->ItemLength->getPlaceHolder()) ?>" value="<?php echo $market_property_grid->ItemLength->EditValue ?>"<?php echo $market_property_grid->ItemLength->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_market_property_ItemLength" class="form-group market_property_ItemLength">
<span<?php echo $market_property_grid->ItemLength->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_property_grid->ItemLength->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="market_property" data-field="x_ItemLength" name="x<?php echo $market_property_grid->RowIndex ?>_ItemLength" id="x<?php echo $market_property_grid->RowIndex ?>_ItemLength" value="<?php echo HtmlEncode($market_property_grid->ItemLength->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="market_property" data-field="x_ItemLength" name="o<?php echo $market_property_grid->RowIndex ?>_ItemLength" id="o<?php echo $market_property_grid->RowIndex ?>_ItemLength" value="<?php echo HtmlEncode($market_property_grid->ItemLength->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($market_property_grid->ItemWidth->Visible) { // ItemWidth ?>
		<td data-name="ItemWidth">
<?php if (!$market_property->isConfirm()) { ?>
<span id="el$rowindex$_market_property_ItemWidth" class="form-group market_property_ItemWidth">
<input type="text" data-table="market_property" data-field="x_ItemWidth" name="x<?php echo $market_property_grid->RowIndex ?>_ItemWidth" id="x<?php echo $market_property_grid->RowIndex ?>_ItemWidth" size="30" placeholder="<?php echo HtmlEncode($market_property_grid->ItemWidth->getPlaceHolder()) ?>" value="<?php echo $market_property_grid->ItemWidth->EditValue ?>"<?php echo $market_property_grid->ItemWidth->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_market_property_ItemWidth" class="form-group market_property_ItemWidth">
<span<?php echo $market_property_grid->ItemWidth->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_property_grid->ItemWidth->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="market_property" data-field="x_ItemWidth" name="x<?php echo $market_property_grid->RowIndex ?>_ItemWidth" id="x<?php echo $market_property_grid->RowIndex ?>_ItemWidth" value="<?php echo HtmlEncode($market_property_grid->ItemWidth->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="market_property" data-field="x_ItemWidth" name="o<?php echo $market_property_grid->RowIndex ?>_ItemWidth" id="o<?php echo $market_property_grid->RowIndex ?>_ItemWidth" value="<?php echo HtmlEncode($market_property_grid->ItemWidth->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($market_property_grid->DefaultFees->Visible) { // DefaultFees ?>
		<td data-name="DefaultFees">
<?php if (!$market_property->isConfirm()) { ?>
<span id="el$rowindex$_market_property_DefaultFees" class="form-group market_property_DefaultFees">
<input type="text" data-table="market_property" data-field="x_DefaultFees" name="x<?php echo $market_property_grid->RowIndex ?>_DefaultFees" id="x<?php echo $market_property_grid->RowIndex ?>_DefaultFees" size="30" placeholder="<?php echo HtmlEncode($market_property_grid->DefaultFees->getPlaceHolder()) ?>" value="<?php echo $market_property_grid->DefaultFees->EditValue ?>"<?php echo $market_property_grid->DefaultFees->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_market_property_DefaultFees" class="form-group market_property_DefaultFees">
<span<?php echo $market_property_grid->DefaultFees->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_property_grid->DefaultFees->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="market_property" data-field="x_DefaultFees" name="x<?php echo $market_property_grid->RowIndex ?>_DefaultFees" id="x<?php echo $market_property_grid->RowIndex ?>_DefaultFees" value="<?php echo HtmlEncode($market_property_grid->DefaultFees->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="market_property" data-field="x_DefaultFees" name="o<?php echo $market_property_grid->RowIndex ?>_DefaultFees" id="o<?php echo $market_property_grid->RowIndex ?>_DefaultFees" value="<?php echo HtmlEncode($market_property_grid->DefaultFees->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($market_property_grid->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td data-name="LastUpdatedBy">
<?php if (!$market_property->isConfirm()) { ?>
<span id="el$rowindex$_market_property_LastUpdatedBy" class="form-group market_property_LastUpdatedBy">
<input type="text" data-table="market_property" data-field="x_LastUpdatedBy" name="x<?php echo $market_property_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $market_property_grid->RowIndex ?>_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($market_property_grid->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $market_property_grid->LastUpdatedBy->EditValue ?>"<?php echo $market_property_grid->LastUpdatedBy->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_market_property_LastUpdatedBy" class="form-group market_property_LastUpdatedBy">
<span<?php echo $market_property_grid->LastUpdatedBy->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_property_grid->LastUpdatedBy->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="market_property" data-field="x_LastUpdatedBy" name="x<?php echo $market_property_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $market_property_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($market_property_grid->LastUpdatedBy->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="market_property" data-field="x_LastUpdatedBy" name="o<?php echo $market_property_grid->RowIndex ?>_LastUpdatedBy" id="o<?php echo $market_property_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($market_property_grid->LastUpdatedBy->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($market_property_grid->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td data-name="LastUpdateDate">
<?php if (!$market_property->isConfirm()) { ?>
<span id="el$rowindex$_market_property_LastUpdateDate" class="form-group market_property_LastUpdateDate">
<input type="text" data-table="market_property" data-field="x_LastUpdateDate" name="x<?php echo $market_property_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $market_property_grid->RowIndex ?>_LastUpdateDate" placeholder="<?php echo HtmlEncode($market_property_grid->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $market_property_grid->LastUpdateDate->EditValue ?>"<?php echo $market_property_grid->LastUpdateDate->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_market_property_LastUpdateDate" class="form-group market_property_LastUpdateDate">
<span<?php echo $market_property_grid->LastUpdateDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_property_grid->LastUpdateDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="market_property" data-field="x_LastUpdateDate" name="x<?php echo $market_property_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $market_property_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($market_property_grid->LastUpdateDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="market_property" data-field="x_LastUpdateDate" name="o<?php echo $market_property_grid->RowIndex ?>_LastUpdateDate" id="o<?php echo $market_property_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($market_property_grid->LastUpdateDate->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$market_property_grid->ListOptions->render("body", "right", $market_property_grid->RowIndex);
?>
<script>
loadjs.ready(["fmarket_propertygrid", "load"], function() {
	fmarket_propertygrid.updateLists(<?php echo $market_property_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($market_property->CurrentMode == "add" || $market_property->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $market_property_grid->FormKeyCountName ?>" id="<?php echo $market_property_grid->FormKeyCountName ?>" value="<?php echo $market_property_grid->KeyCount ?>">
<?php echo $market_property_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($market_property->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $market_property_grid->FormKeyCountName ?>" id="<?php echo $market_property_grid->FormKeyCountName ?>" value="<?php echo $market_property_grid->KeyCount ?>">
<?php echo $market_property_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($market_property->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fmarket_propertygrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($market_property_grid->Recordset)
	$market_property_grid->Recordset->Close();
?>
<?php if ($market_property_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $market_property_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($market_property_grid->TotalRecords == 0 && !$market_property->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $market_property_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$market_property_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$market_property_grid->terminate();
?>