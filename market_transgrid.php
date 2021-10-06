<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($market_trans_grid))
	$market_trans_grid = new market_trans_grid();

// Run the page
$market_trans_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$market_trans_grid->Page_Render();
?>
<?php if (!$market_trans_grid->isExport()) { ?>
<script>
var fmarket_transgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fmarket_transgrid = new ew.Form("fmarket_transgrid", "grid");
	fmarket_transgrid.formKeyCountName = '<?php echo $market_trans_grid->FormKeyCountName ?>';

	// Validate form
	fmarket_transgrid.validate = function() {
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
			<?php if ($market_trans_grid->TransNo->Required) { ?>
				elm = this.getElements("x" + infix + "_TransNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_trans_grid->TransNo->caption(), $market_trans_grid->TransNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($market_trans_grid->MarketItemNo->Required) { ?>
				elm = this.getElements("x" + infix + "_MarketItemNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_trans_grid->MarketItemNo->caption(), $market_trans_grid->MarketItemNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MarketItemNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($market_trans_grid->MarketItemNo->errorMessage()) ?>");
			<?php if ($market_trans_grid->DateHired->Required) { ?>
				elm = this.getElements("x" + infix + "_DateHired");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_trans_grid->DateHired->caption(), $market_trans_grid->DateHired->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateHired");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($market_trans_grid->DateHired->errorMessage()) ?>");
			<?php if ($market_trans_grid->MartketeerName->Required) { ?>
				elm = this.getElements("x" + infix + "_MartketeerName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_trans_grid->MartketeerName->caption(), $market_trans_grid->MartketeerName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($market_trans_grid->MartketeerID->Required) { ?>
				elm = this.getElements("x" + infix + "_MartketeerID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_trans_grid->MartketeerID->caption(), $market_trans_grid->MartketeerID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($market_trans_grid->AmountDue->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountDue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_trans_grid->AmountDue->caption(), $market_trans_grid->AmountDue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountDue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($market_trans_grid->AmountDue->errorMessage()) ?>");
			<?php if ($market_trans_grid->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_trans_grid->AmountPaid->caption(), $market_trans_grid->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($market_trans_grid->AmountPaid->errorMessage()) ?>");
			<?php if ($market_trans_grid->ReceiptNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ReceiptNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_trans_grid->ReceiptNo->caption(), $market_trans_grid->ReceiptNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($market_trans_grid->LastUpdatedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdatedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_trans_grid->LastUpdatedBy->caption(), $market_trans_grid->LastUpdatedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($market_trans_grid->LastUpdateDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_trans_grid->LastUpdateDate->caption(), $market_trans_grid->LastUpdateDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($market_trans_grid->LastUpdateDate->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fmarket_transgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "MarketItemNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateHired", false)) return false;
		if (ew.valueChanged(fobj, infix, "MartketeerName", false)) return false;
		if (ew.valueChanged(fobj, infix, "MartketeerID", false)) return false;
		if (ew.valueChanged(fobj, infix, "AmountDue", false)) return false;
		if (ew.valueChanged(fobj, infix, "AmountPaid", false)) return false;
		if (ew.valueChanged(fobj, infix, "ReceiptNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "LastUpdatedBy", false)) return false;
		if (ew.valueChanged(fobj, infix, "LastUpdateDate", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fmarket_transgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmarket_transgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fmarket_transgrid");
});
</script>
<?php } ?>
<?php
$market_trans_grid->renderOtherOptions();
?>
<?php if ($market_trans_grid->TotalRecords > 0 || $market_trans->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($market_trans_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> market_trans">
<?php if ($market_trans_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $market_trans_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fmarket_transgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_market_trans" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_market_transgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$market_trans->RowType = ROWTYPE_HEADER;

// Render list options
$market_trans_grid->renderListOptions();

// Render list options (header, left)
$market_trans_grid->ListOptions->render("header", "left");
?>
<?php if ($market_trans_grid->TransNo->Visible) { // TransNo ?>
	<?php if ($market_trans_grid->SortUrl($market_trans_grid->TransNo) == "") { ?>
		<th data-name="TransNo" class="<?php echo $market_trans_grid->TransNo->headerCellClass() ?>"><div id="elh_market_trans_TransNo" class="market_trans_TransNo"><div class="ew-table-header-caption"><?php echo $market_trans_grid->TransNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TransNo" class="<?php echo $market_trans_grid->TransNo->headerCellClass() ?>"><div><div id="elh_market_trans_TransNo" class="market_trans_TransNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_grid->TransNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_grid->TransNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_grid->TransNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_grid->MarketItemNo->Visible) { // MarketItemNo ?>
	<?php if ($market_trans_grid->SortUrl($market_trans_grid->MarketItemNo) == "") { ?>
		<th data-name="MarketItemNo" class="<?php echo $market_trans_grid->MarketItemNo->headerCellClass() ?>"><div id="elh_market_trans_MarketItemNo" class="market_trans_MarketItemNo"><div class="ew-table-header-caption"><?php echo $market_trans_grid->MarketItemNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MarketItemNo" class="<?php echo $market_trans_grid->MarketItemNo->headerCellClass() ?>"><div><div id="elh_market_trans_MarketItemNo" class="market_trans_MarketItemNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_grid->MarketItemNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_grid->MarketItemNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_grid->MarketItemNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_grid->DateHired->Visible) { // DateHired ?>
	<?php if ($market_trans_grid->SortUrl($market_trans_grid->DateHired) == "") { ?>
		<th data-name="DateHired" class="<?php echo $market_trans_grid->DateHired->headerCellClass() ?>"><div id="elh_market_trans_DateHired" class="market_trans_DateHired"><div class="ew-table-header-caption"><?php echo $market_trans_grid->DateHired->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateHired" class="<?php echo $market_trans_grid->DateHired->headerCellClass() ?>"><div><div id="elh_market_trans_DateHired" class="market_trans_DateHired">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_grid->DateHired->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_grid->DateHired->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_grid->DateHired->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_grid->MartketeerName->Visible) { // MartketeerName ?>
	<?php if ($market_trans_grid->SortUrl($market_trans_grid->MartketeerName) == "") { ?>
		<th data-name="MartketeerName" class="<?php echo $market_trans_grid->MartketeerName->headerCellClass() ?>"><div id="elh_market_trans_MartketeerName" class="market_trans_MartketeerName"><div class="ew-table-header-caption"><?php echo $market_trans_grid->MartketeerName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MartketeerName" class="<?php echo $market_trans_grid->MartketeerName->headerCellClass() ?>"><div><div id="elh_market_trans_MartketeerName" class="market_trans_MartketeerName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_grid->MartketeerName->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_grid->MartketeerName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_grid->MartketeerName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_grid->MartketeerID->Visible) { // MartketeerID ?>
	<?php if ($market_trans_grid->SortUrl($market_trans_grid->MartketeerID) == "") { ?>
		<th data-name="MartketeerID" class="<?php echo $market_trans_grid->MartketeerID->headerCellClass() ?>"><div id="elh_market_trans_MartketeerID" class="market_trans_MartketeerID"><div class="ew-table-header-caption"><?php echo $market_trans_grid->MartketeerID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MartketeerID" class="<?php echo $market_trans_grid->MartketeerID->headerCellClass() ?>"><div><div id="elh_market_trans_MartketeerID" class="market_trans_MartketeerID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_grid->MartketeerID->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_grid->MartketeerID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_grid->MartketeerID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_grid->AmountDue->Visible) { // AmountDue ?>
	<?php if ($market_trans_grid->SortUrl($market_trans_grid->AmountDue) == "") { ?>
		<th data-name="AmountDue" class="<?php echo $market_trans_grid->AmountDue->headerCellClass() ?>"><div id="elh_market_trans_AmountDue" class="market_trans_AmountDue"><div class="ew-table-header-caption"><?php echo $market_trans_grid->AmountDue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountDue" class="<?php echo $market_trans_grid->AmountDue->headerCellClass() ?>"><div><div id="elh_market_trans_AmountDue" class="market_trans_AmountDue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_grid->AmountDue->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_grid->AmountDue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_grid->AmountDue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_grid->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($market_trans_grid->SortUrl($market_trans_grid->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $market_trans_grid->AmountPaid->headerCellClass() ?>"><div id="elh_market_trans_AmountPaid" class="market_trans_AmountPaid"><div class="ew-table-header-caption"><?php echo $market_trans_grid->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $market_trans_grid->AmountPaid->headerCellClass() ?>"><div><div id="elh_market_trans_AmountPaid" class="market_trans_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_grid->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_grid->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_grid->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_grid->ReceiptNo->Visible) { // ReceiptNo ?>
	<?php if ($market_trans_grid->SortUrl($market_trans_grid->ReceiptNo) == "") { ?>
		<th data-name="ReceiptNo" class="<?php echo $market_trans_grid->ReceiptNo->headerCellClass() ?>"><div id="elh_market_trans_ReceiptNo" class="market_trans_ReceiptNo"><div class="ew-table-header-caption"><?php echo $market_trans_grid->ReceiptNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReceiptNo" class="<?php echo $market_trans_grid->ReceiptNo->headerCellClass() ?>"><div><div id="elh_market_trans_ReceiptNo" class="market_trans_ReceiptNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_grid->ReceiptNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_grid->ReceiptNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_grid->ReceiptNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_grid->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($market_trans_grid->SortUrl($market_trans_grid->LastUpdatedBy) == "") { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $market_trans_grid->LastUpdatedBy->headerCellClass() ?>"><div id="elh_market_trans_LastUpdatedBy" class="market_trans_LastUpdatedBy"><div class="ew-table-header-caption"><?php echo $market_trans_grid->LastUpdatedBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $market_trans_grid->LastUpdatedBy->headerCellClass() ?>"><div><div id="elh_market_trans_LastUpdatedBy" class="market_trans_LastUpdatedBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_grid->LastUpdatedBy->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_grid->LastUpdatedBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_grid->LastUpdatedBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_grid->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<?php if ($market_trans_grid->SortUrl($market_trans_grid->LastUpdateDate) == "") { ?>
		<th data-name="LastUpdateDate" class="<?php echo $market_trans_grid->LastUpdateDate->headerCellClass() ?>"><div id="elh_market_trans_LastUpdateDate" class="market_trans_LastUpdateDate"><div class="ew-table-header-caption"><?php echo $market_trans_grid->LastUpdateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdateDate" class="<?php echo $market_trans_grid->LastUpdateDate->headerCellClass() ?>"><div><div id="elh_market_trans_LastUpdateDate" class="market_trans_LastUpdateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_grid->LastUpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_grid->LastUpdateDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_grid->LastUpdateDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$market_trans_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$market_trans_grid->StartRecord = 1;
$market_trans_grid->StopRecord = $market_trans_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($market_trans->isConfirm() || $market_trans_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($market_trans_grid->FormKeyCountName) && ($market_trans_grid->isGridAdd() || $market_trans_grid->isGridEdit() || $market_trans->isConfirm())) {
		$market_trans_grid->KeyCount = $CurrentForm->getValue($market_trans_grid->FormKeyCountName);
		$market_trans_grid->StopRecord = $market_trans_grid->StartRecord + $market_trans_grid->KeyCount - 1;
	}
}
$market_trans_grid->RecordCount = $market_trans_grid->StartRecord - 1;
if ($market_trans_grid->Recordset && !$market_trans_grid->Recordset->EOF) {
	$market_trans_grid->Recordset->moveFirst();
	$selectLimit = $market_trans_grid->UseSelectLimit;
	if (!$selectLimit && $market_trans_grid->StartRecord > 1)
		$market_trans_grid->Recordset->move($market_trans_grid->StartRecord - 1);
} elseif (!$market_trans->AllowAddDeleteRow && $market_trans_grid->StopRecord == 0) {
	$market_trans_grid->StopRecord = $market_trans->GridAddRowCount;
}

// Initialize aggregate
$market_trans->RowType = ROWTYPE_AGGREGATEINIT;
$market_trans->resetAttributes();
$market_trans_grid->renderRow();
if ($market_trans_grid->isGridAdd())
	$market_trans_grid->RowIndex = 0;
if ($market_trans_grid->isGridEdit())
	$market_trans_grid->RowIndex = 0;
while ($market_trans_grid->RecordCount < $market_trans_grid->StopRecord) {
	$market_trans_grid->RecordCount++;
	if ($market_trans_grid->RecordCount >= $market_trans_grid->StartRecord) {
		$market_trans_grid->RowCount++;
		if ($market_trans_grid->isGridAdd() || $market_trans_grid->isGridEdit() || $market_trans->isConfirm()) {
			$market_trans_grid->RowIndex++;
			$CurrentForm->Index = $market_trans_grid->RowIndex;
			if ($CurrentForm->hasValue($market_trans_grid->FormActionName) && ($market_trans->isConfirm() || $market_trans_grid->EventCancelled))
				$market_trans_grid->RowAction = strval($CurrentForm->getValue($market_trans_grid->FormActionName));
			elseif ($market_trans_grid->isGridAdd())
				$market_trans_grid->RowAction = "insert";
			else
				$market_trans_grid->RowAction = "";
		}

		// Set up key count
		$market_trans_grid->KeyCount = $market_trans_grid->RowIndex;

		// Init row class and style
		$market_trans->resetAttributes();
		$market_trans->CssClass = "";
		if ($market_trans_grid->isGridAdd()) {
			if ($market_trans->CurrentMode == "copy") {
				$market_trans_grid->loadRowValues($market_trans_grid->Recordset); // Load row values
				$market_trans_grid->setRecordKey($market_trans_grid->RowOldKey, $market_trans_grid->Recordset); // Set old record key
			} else {
				$market_trans_grid->loadRowValues(); // Load default values
				$market_trans_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$market_trans_grid->loadRowValues($market_trans_grid->Recordset); // Load row values
		}
		$market_trans->RowType = ROWTYPE_VIEW; // Render view
		if ($market_trans_grid->isGridAdd()) // Grid add
			$market_trans->RowType = ROWTYPE_ADD; // Render add
		if ($market_trans_grid->isGridAdd() && $market_trans->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$market_trans_grid->restoreCurrentRowFormValues($market_trans_grid->RowIndex); // Restore form values
		if ($market_trans_grid->isGridEdit()) { // Grid edit
			if ($market_trans->EventCancelled)
				$market_trans_grid->restoreCurrentRowFormValues($market_trans_grid->RowIndex); // Restore form values
			if ($market_trans_grid->RowAction == "insert")
				$market_trans->RowType = ROWTYPE_ADD; // Render add
			else
				$market_trans->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($market_trans_grid->isGridEdit() && ($market_trans->RowType == ROWTYPE_EDIT || $market_trans->RowType == ROWTYPE_ADD) && $market_trans->EventCancelled) // Update failed
			$market_trans_grid->restoreCurrentRowFormValues($market_trans_grid->RowIndex); // Restore form values
		if ($market_trans->RowType == ROWTYPE_EDIT) // Edit row
			$market_trans_grid->EditRowCount++;
		if ($market_trans->isConfirm()) // Confirm row
			$market_trans_grid->restoreCurrentRowFormValues($market_trans_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$market_trans->RowAttrs->merge(["data-rowindex" => $market_trans_grid->RowCount, "id" => "r" . $market_trans_grid->RowCount . "_market_trans", "data-rowtype" => $market_trans->RowType]);

		// Render row
		$market_trans_grid->renderRow();

		// Render list options
		$market_trans_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($market_trans_grid->RowAction != "delete" && $market_trans_grid->RowAction != "insertdelete" && !($market_trans_grid->RowAction == "insert" && $market_trans->isConfirm() && $market_trans_grid->emptyRow())) {
?>
	<tr <?php echo $market_trans->rowAttributes() ?>>
<?php

// Render list options (body, left)
$market_trans_grid->ListOptions->render("body", "left", $market_trans_grid->RowCount);
?>
	<?php if ($market_trans_grid->TransNo->Visible) { // TransNo ?>
		<td data-name="TransNo" <?php echo $market_trans_grid->TransNo->cellAttributes() ?>>
<?php if ($market_trans->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_TransNo" class="form-group"></span>
<input type="hidden" data-table="market_trans" data-field="x_TransNo" name="o<?php echo $market_trans_grid->RowIndex ?>_TransNo" id="o<?php echo $market_trans_grid->RowIndex ?>_TransNo" value="<?php echo HtmlEncode($market_trans_grid->TransNo->OldValue) ?>">
<?php } ?>
<?php if ($market_trans->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_TransNo" class="form-group">
<span<?php echo $market_trans_grid->TransNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_trans_grid->TransNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="market_trans" data-field="x_TransNo" name="x<?php echo $market_trans_grid->RowIndex ?>_TransNo" id="x<?php echo $market_trans_grid->RowIndex ?>_TransNo" value="<?php echo HtmlEncode($market_trans_grid->TransNo->CurrentValue) ?>">
<?php } ?>
<?php if ($market_trans->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_TransNo">
<span<?php echo $market_trans_grid->TransNo->viewAttributes() ?>><?php echo $market_trans_grid->TransNo->getViewValue() ?></span>
</span>
<?php if (!$market_trans->isConfirm()) { ?>
<input type="hidden" data-table="market_trans" data-field="x_TransNo" name="x<?php echo $market_trans_grid->RowIndex ?>_TransNo" id="x<?php echo $market_trans_grid->RowIndex ?>_TransNo" value="<?php echo HtmlEncode($market_trans_grid->TransNo->FormValue) ?>">
<input type="hidden" data-table="market_trans" data-field="x_TransNo" name="o<?php echo $market_trans_grid->RowIndex ?>_TransNo" id="o<?php echo $market_trans_grid->RowIndex ?>_TransNo" value="<?php echo HtmlEncode($market_trans_grid->TransNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="market_trans" data-field="x_TransNo" name="fmarket_transgrid$x<?php echo $market_trans_grid->RowIndex ?>_TransNo" id="fmarket_transgrid$x<?php echo $market_trans_grid->RowIndex ?>_TransNo" value="<?php echo HtmlEncode($market_trans_grid->TransNo->FormValue) ?>">
<input type="hidden" data-table="market_trans" data-field="x_TransNo" name="fmarket_transgrid$o<?php echo $market_trans_grid->RowIndex ?>_TransNo" id="fmarket_transgrid$o<?php echo $market_trans_grid->RowIndex ?>_TransNo" value="<?php echo HtmlEncode($market_trans_grid->TransNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($market_trans_grid->MarketItemNo->Visible) { // MarketItemNo ?>
		<td data-name="MarketItemNo" <?php echo $market_trans_grid->MarketItemNo->cellAttributes() ?>>
<?php if ($market_trans->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($market_trans_grid->MarketItemNo->getSessionValue() != "") { ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_MarketItemNo" class="form-group">
<span<?php echo $market_trans_grid->MarketItemNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_trans_grid->MarketItemNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" name="x<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" value="<?php echo HtmlEncode($market_trans_grid->MarketItemNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_MarketItemNo" class="form-group">
<input type="text" data-table="market_trans" data-field="x_MarketItemNo" name="x<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" id="x<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" size="30" placeholder="<?php echo HtmlEncode($market_trans_grid->MarketItemNo->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->MarketItemNo->EditValue ?>"<?php echo $market_trans_grid->MarketItemNo->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="market_trans" data-field="x_MarketItemNo" name="o<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" id="o<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" value="<?php echo HtmlEncode($market_trans_grid->MarketItemNo->OldValue) ?>">
<?php } ?>
<?php if ($market_trans->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($market_trans_grid->MarketItemNo->getSessionValue() != "") { ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_MarketItemNo" class="form-group">
<span<?php echo $market_trans_grid->MarketItemNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_trans_grid->MarketItemNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" name="x<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" value="<?php echo HtmlEncode($market_trans_grid->MarketItemNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_MarketItemNo" class="form-group">
<input type="text" data-table="market_trans" data-field="x_MarketItemNo" name="x<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" id="x<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" size="30" placeholder="<?php echo HtmlEncode($market_trans_grid->MarketItemNo->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->MarketItemNo->EditValue ?>"<?php echo $market_trans_grid->MarketItemNo->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($market_trans->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_MarketItemNo">
<span<?php echo $market_trans_grid->MarketItemNo->viewAttributes() ?>><?php echo $market_trans_grid->MarketItemNo->getViewValue() ?></span>
</span>
<?php if (!$market_trans->isConfirm()) { ?>
<input type="hidden" data-table="market_trans" data-field="x_MarketItemNo" name="x<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" id="x<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" value="<?php echo HtmlEncode($market_trans_grid->MarketItemNo->FormValue) ?>">
<input type="hidden" data-table="market_trans" data-field="x_MarketItemNo" name="o<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" id="o<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" value="<?php echo HtmlEncode($market_trans_grid->MarketItemNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="market_trans" data-field="x_MarketItemNo" name="fmarket_transgrid$x<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" id="fmarket_transgrid$x<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" value="<?php echo HtmlEncode($market_trans_grid->MarketItemNo->FormValue) ?>">
<input type="hidden" data-table="market_trans" data-field="x_MarketItemNo" name="fmarket_transgrid$o<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" id="fmarket_transgrid$o<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" value="<?php echo HtmlEncode($market_trans_grid->MarketItemNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($market_trans_grid->DateHired->Visible) { // DateHired ?>
		<td data-name="DateHired" <?php echo $market_trans_grid->DateHired->cellAttributes() ?>>
<?php if ($market_trans->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_DateHired" class="form-group">
<input type="text" data-table="market_trans" data-field="x_DateHired" name="x<?php echo $market_trans_grid->RowIndex ?>_DateHired" id="x<?php echo $market_trans_grid->RowIndex ?>_DateHired" placeholder="<?php echo HtmlEncode($market_trans_grid->DateHired->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->DateHired->EditValue ?>"<?php echo $market_trans_grid->DateHired->editAttributes() ?>>
</span>
<input type="hidden" data-table="market_trans" data-field="x_DateHired" name="o<?php echo $market_trans_grid->RowIndex ?>_DateHired" id="o<?php echo $market_trans_grid->RowIndex ?>_DateHired" value="<?php echo HtmlEncode($market_trans_grid->DateHired->OldValue) ?>">
<?php } ?>
<?php if ($market_trans->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_DateHired" class="form-group">
<input type="text" data-table="market_trans" data-field="x_DateHired" name="x<?php echo $market_trans_grid->RowIndex ?>_DateHired" id="x<?php echo $market_trans_grid->RowIndex ?>_DateHired" placeholder="<?php echo HtmlEncode($market_trans_grid->DateHired->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->DateHired->EditValue ?>"<?php echo $market_trans_grid->DateHired->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($market_trans->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_DateHired">
<span<?php echo $market_trans_grid->DateHired->viewAttributes() ?>><?php echo $market_trans_grid->DateHired->getViewValue() ?></span>
</span>
<?php if (!$market_trans->isConfirm()) { ?>
<input type="hidden" data-table="market_trans" data-field="x_DateHired" name="x<?php echo $market_trans_grid->RowIndex ?>_DateHired" id="x<?php echo $market_trans_grid->RowIndex ?>_DateHired" value="<?php echo HtmlEncode($market_trans_grid->DateHired->FormValue) ?>">
<input type="hidden" data-table="market_trans" data-field="x_DateHired" name="o<?php echo $market_trans_grid->RowIndex ?>_DateHired" id="o<?php echo $market_trans_grid->RowIndex ?>_DateHired" value="<?php echo HtmlEncode($market_trans_grid->DateHired->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="market_trans" data-field="x_DateHired" name="fmarket_transgrid$x<?php echo $market_trans_grid->RowIndex ?>_DateHired" id="fmarket_transgrid$x<?php echo $market_trans_grid->RowIndex ?>_DateHired" value="<?php echo HtmlEncode($market_trans_grid->DateHired->FormValue) ?>">
<input type="hidden" data-table="market_trans" data-field="x_DateHired" name="fmarket_transgrid$o<?php echo $market_trans_grid->RowIndex ?>_DateHired" id="fmarket_transgrid$o<?php echo $market_trans_grid->RowIndex ?>_DateHired" value="<?php echo HtmlEncode($market_trans_grid->DateHired->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($market_trans_grid->MartketeerName->Visible) { // MartketeerName ?>
		<td data-name="MartketeerName" <?php echo $market_trans_grid->MartketeerName->cellAttributes() ?>>
<?php if ($market_trans->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_MartketeerName" class="form-group">
<input type="text" data-table="market_trans" data-field="x_MartketeerName" name="x<?php echo $market_trans_grid->RowIndex ?>_MartketeerName" id="x<?php echo $market_trans_grid->RowIndex ?>_MartketeerName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($market_trans_grid->MartketeerName->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->MartketeerName->EditValue ?>"<?php echo $market_trans_grid->MartketeerName->editAttributes() ?>>
</span>
<input type="hidden" data-table="market_trans" data-field="x_MartketeerName" name="o<?php echo $market_trans_grid->RowIndex ?>_MartketeerName" id="o<?php echo $market_trans_grid->RowIndex ?>_MartketeerName" value="<?php echo HtmlEncode($market_trans_grid->MartketeerName->OldValue) ?>">
<?php } ?>
<?php if ($market_trans->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_MartketeerName" class="form-group">
<input type="text" data-table="market_trans" data-field="x_MartketeerName" name="x<?php echo $market_trans_grid->RowIndex ?>_MartketeerName" id="x<?php echo $market_trans_grid->RowIndex ?>_MartketeerName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($market_trans_grid->MartketeerName->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->MartketeerName->EditValue ?>"<?php echo $market_trans_grid->MartketeerName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($market_trans->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_MartketeerName">
<span<?php echo $market_trans_grid->MartketeerName->viewAttributes() ?>><?php echo $market_trans_grid->MartketeerName->getViewValue() ?></span>
</span>
<?php if (!$market_trans->isConfirm()) { ?>
<input type="hidden" data-table="market_trans" data-field="x_MartketeerName" name="x<?php echo $market_trans_grid->RowIndex ?>_MartketeerName" id="x<?php echo $market_trans_grid->RowIndex ?>_MartketeerName" value="<?php echo HtmlEncode($market_trans_grid->MartketeerName->FormValue) ?>">
<input type="hidden" data-table="market_trans" data-field="x_MartketeerName" name="o<?php echo $market_trans_grid->RowIndex ?>_MartketeerName" id="o<?php echo $market_trans_grid->RowIndex ?>_MartketeerName" value="<?php echo HtmlEncode($market_trans_grid->MartketeerName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="market_trans" data-field="x_MartketeerName" name="fmarket_transgrid$x<?php echo $market_trans_grid->RowIndex ?>_MartketeerName" id="fmarket_transgrid$x<?php echo $market_trans_grid->RowIndex ?>_MartketeerName" value="<?php echo HtmlEncode($market_trans_grid->MartketeerName->FormValue) ?>">
<input type="hidden" data-table="market_trans" data-field="x_MartketeerName" name="fmarket_transgrid$o<?php echo $market_trans_grid->RowIndex ?>_MartketeerName" id="fmarket_transgrid$o<?php echo $market_trans_grid->RowIndex ?>_MartketeerName" value="<?php echo HtmlEncode($market_trans_grid->MartketeerName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($market_trans_grid->MartketeerID->Visible) { // MartketeerID ?>
		<td data-name="MartketeerID" <?php echo $market_trans_grid->MartketeerID->cellAttributes() ?>>
<?php if ($market_trans->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_MartketeerID" class="form-group">
<input type="text" data-table="market_trans" data-field="x_MartketeerID" name="x<?php echo $market_trans_grid->RowIndex ?>_MartketeerID" id="x<?php echo $market_trans_grid->RowIndex ?>_MartketeerID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($market_trans_grid->MartketeerID->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->MartketeerID->EditValue ?>"<?php echo $market_trans_grid->MartketeerID->editAttributes() ?>>
</span>
<input type="hidden" data-table="market_trans" data-field="x_MartketeerID" name="o<?php echo $market_trans_grid->RowIndex ?>_MartketeerID" id="o<?php echo $market_trans_grid->RowIndex ?>_MartketeerID" value="<?php echo HtmlEncode($market_trans_grid->MartketeerID->OldValue) ?>">
<?php } ?>
<?php if ($market_trans->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_MartketeerID" class="form-group">
<input type="text" data-table="market_trans" data-field="x_MartketeerID" name="x<?php echo $market_trans_grid->RowIndex ?>_MartketeerID" id="x<?php echo $market_trans_grid->RowIndex ?>_MartketeerID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($market_trans_grid->MartketeerID->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->MartketeerID->EditValue ?>"<?php echo $market_trans_grid->MartketeerID->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($market_trans->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_MartketeerID">
<span<?php echo $market_trans_grid->MartketeerID->viewAttributes() ?>><?php echo $market_trans_grid->MartketeerID->getViewValue() ?></span>
</span>
<?php if (!$market_trans->isConfirm()) { ?>
<input type="hidden" data-table="market_trans" data-field="x_MartketeerID" name="x<?php echo $market_trans_grid->RowIndex ?>_MartketeerID" id="x<?php echo $market_trans_grid->RowIndex ?>_MartketeerID" value="<?php echo HtmlEncode($market_trans_grid->MartketeerID->FormValue) ?>">
<input type="hidden" data-table="market_trans" data-field="x_MartketeerID" name="o<?php echo $market_trans_grid->RowIndex ?>_MartketeerID" id="o<?php echo $market_trans_grid->RowIndex ?>_MartketeerID" value="<?php echo HtmlEncode($market_trans_grid->MartketeerID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="market_trans" data-field="x_MartketeerID" name="fmarket_transgrid$x<?php echo $market_trans_grid->RowIndex ?>_MartketeerID" id="fmarket_transgrid$x<?php echo $market_trans_grid->RowIndex ?>_MartketeerID" value="<?php echo HtmlEncode($market_trans_grid->MartketeerID->FormValue) ?>">
<input type="hidden" data-table="market_trans" data-field="x_MartketeerID" name="fmarket_transgrid$o<?php echo $market_trans_grid->RowIndex ?>_MartketeerID" id="fmarket_transgrid$o<?php echo $market_trans_grid->RowIndex ?>_MartketeerID" value="<?php echo HtmlEncode($market_trans_grid->MartketeerID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($market_trans_grid->AmountDue->Visible) { // AmountDue ?>
		<td data-name="AmountDue" <?php echo $market_trans_grid->AmountDue->cellAttributes() ?>>
<?php if ($market_trans->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_AmountDue" class="form-group">
<input type="text" data-table="market_trans" data-field="x_AmountDue" name="x<?php echo $market_trans_grid->RowIndex ?>_AmountDue" id="x<?php echo $market_trans_grid->RowIndex ?>_AmountDue" size="30" placeholder="<?php echo HtmlEncode($market_trans_grid->AmountDue->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->AmountDue->EditValue ?>"<?php echo $market_trans_grid->AmountDue->editAttributes() ?>>
</span>
<input type="hidden" data-table="market_trans" data-field="x_AmountDue" name="o<?php echo $market_trans_grid->RowIndex ?>_AmountDue" id="o<?php echo $market_trans_grid->RowIndex ?>_AmountDue" value="<?php echo HtmlEncode($market_trans_grid->AmountDue->OldValue) ?>">
<?php } ?>
<?php if ($market_trans->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_AmountDue" class="form-group">
<input type="text" data-table="market_trans" data-field="x_AmountDue" name="x<?php echo $market_trans_grid->RowIndex ?>_AmountDue" id="x<?php echo $market_trans_grid->RowIndex ?>_AmountDue" size="30" placeholder="<?php echo HtmlEncode($market_trans_grid->AmountDue->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->AmountDue->EditValue ?>"<?php echo $market_trans_grid->AmountDue->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($market_trans->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_AmountDue">
<span<?php echo $market_trans_grid->AmountDue->viewAttributes() ?>><?php echo $market_trans_grid->AmountDue->getViewValue() ?></span>
</span>
<?php if (!$market_trans->isConfirm()) { ?>
<input type="hidden" data-table="market_trans" data-field="x_AmountDue" name="x<?php echo $market_trans_grid->RowIndex ?>_AmountDue" id="x<?php echo $market_trans_grid->RowIndex ?>_AmountDue" value="<?php echo HtmlEncode($market_trans_grid->AmountDue->FormValue) ?>">
<input type="hidden" data-table="market_trans" data-field="x_AmountDue" name="o<?php echo $market_trans_grid->RowIndex ?>_AmountDue" id="o<?php echo $market_trans_grid->RowIndex ?>_AmountDue" value="<?php echo HtmlEncode($market_trans_grid->AmountDue->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="market_trans" data-field="x_AmountDue" name="fmarket_transgrid$x<?php echo $market_trans_grid->RowIndex ?>_AmountDue" id="fmarket_transgrid$x<?php echo $market_trans_grid->RowIndex ?>_AmountDue" value="<?php echo HtmlEncode($market_trans_grid->AmountDue->FormValue) ?>">
<input type="hidden" data-table="market_trans" data-field="x_AmountDue" name="fmarket_transgrid$o<?php echo $market_trans_grid->RowIndex ?>_AmountDue" id="fmarket_transgrid$o<?php echo $market_trans_grid->RowIndex ?>_AmountDue" value="<?php echo HtmlEncode($market_trans_grid->AmountDue->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($market_trans_grid->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $market_trans_grid->AmountPaid->cellAttributes() ?>>
<?php if ($market_trans->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_AmountPaid" class="form-group">
<input type="text" data-table="market_trans" data-field="x_AmountPaid" name="x<?php echo $market_trans_grid->RowIndex ?>_AmountPaid" id="x<?php echo $market_trans_grid->RowIndex ?>_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($market_trans_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->AmountPaid->EditValue ?>"<?php echo $market_trans_grid->AmountPaid->editAttributes() ?>>
</span>
<input type="hidden" data-table="market_trans" data-field="x_AmountPaid" name="o<?php echo $market_trans_grid->RowIndex ?>_AmountPaid" id="o<?php echo $market_trans_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($market_trans_grid->AmountPaid->OldValue) ?>">
<?php } ?>
<?php if ($market_trans->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_AmountPaid" class="form-group">
<input type="text" data-table="market_trans" data-field="x_AmountPaid" name="x<?php echo $market_trans_grid->RowIndex ?>_AmountPaid" id="x<?php echo $market_trans_grid->RowIndex ?>_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($market_trans_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->AmountPaid->EditValue ?>"<?php echo $market_trans_grid->AmountPaid->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($market_trans->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_AmountPaid">
<span<?php echo $market_trans_grid->AmountPaid->viewAttributes() ?>><?php echo $market_trans_grid->AmountPaid->getViewValue() ?></span>
</span>
<?php if (!$market_trans->isConfirm()) { ?>
<input type="hidden" data-table="market_trans" data-field="x_AmountPaid" name="x<?php echo $market_trans_grid->RowIndex ?>_AmountPaid" id="x<?php echo $market_trans_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($market_trans_grid->AmountPaid->FormValue) ?>">
<input type="hidden" data-table="market_trans" data-field="x_AmountPaid" name="o<?php echo $market_trans_grid->RowIndex ?>_AmountPaid" id="o<?php echo $market_trans_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($market_trans_grid->AmountPaid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="market_trans" data-field="x_AmountPaid" name="fmarket_transgrid$x<?php echo $market_trans_grid->RowIndex ?>_AmountPaid" id="fmarket_transgrid$x<?php echo $market_trans_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($market_trans_grid->AmountPaid->FormValue) ?>">
<input type="hidden" data-table="market_trans" data-field="x_AmountPaid" name="fmarket_transgrid$o<?php echo $market_trans_grid->RowIndex ?>_AmountPaid" id="fmarket_transgrid$o<?php echo $market_trans_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($market_trans_grid->AmountPaid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($market_trans_grid->ReceiptNo->Visible) { // ReceiptNo ?>
		<td data-name="ReceiptNo" <?php echo $market_trans_grid->ReceiptNo->cellAttributes() ?>>
<?php if ($market_trans->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_ReceiptNo" class="form-group">
<input type="text" data-table="market_trans" data-field="x_ReceiptNo" name="x<?php echo $market_trans_grid->RowIndex ?>_ReceiptNo" id="x<?php echo $market_trans_grid->RowIndex ?>_ReceiptNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($market_trans_grid->ReceiptNo->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->ReceiptNo->EditValue ?>"<?php echo $market_trans_grid->ReceiptNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="market_trans" data-field="x_ReceiptNo" name="o<?php echo $market_trans_grid->RowIndex ?>_ReceiptNo" id="o<?php echo $market_trans_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($market_trans_grid->ReceiptNo->OldValue) ?>">
<?php } ?>
<?php if ($market_trans->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_ReceiptNo" class="form-group">
<input type="text" data-table="market_trans" data-field="x_ReceiptNo" name="x<?php echo $market_trans_grid->RowIndex ?>_ReceiptNo" id="x<?php echo $market_trans_grid->RowIndex ?>_ReceiptNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($market_trans_grid->ReceiptNo->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->ReceiptNo->EditValue ?>"<?php echo $market_trans_grid->ReceiptNo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($market_trans->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_ReceiptNo">
<span<?php echo $market_trans_grid->ReceiptNo->viewAttributes() ?>><?php echo $market_trans_grid->ReceiptNo->getViewValue() ?></span>
</span>
<?php if (!$market_trans->isConfirm()) { ?>
<input type="hidden" data-table="market_trans" data-field="x_ReceiptNo" name="x<?php echo $market_trans_grid->RowIndex ?>_ReceiptNo" id="x<?php echo $market_trans_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($market_trans_grid->ReceiptNo->FormValue) ?>">
<input type="hidden" data-table="market_trans" data-field="x_ReceiptNo" name="o<?php echo $market_trans_grid->RowIndex ?>_ReceiptNo" id="o<?php echo $market_trans_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($market_trans_grid->ReceiptNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="market_trans" data-field="x_ReceiptNo" name="fmarket_transgrid$x<?php echo $market_trans_grid->RowIndex ?>_ReceiptNo" id="fmarket_transgrid$x<?php echo $market_trans_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($market_trans_grid->ReceiptNo->FormValue) ?>">
<input type="hidden" data-table="market_trans" data-field="x_ReceiptNo" name="fmarket_transgrid$o<?php echo $market_trans_grid->RowIndex ?>_ReceiptNo" id="fmarket_transgrid$o<?php echo $market_trans_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($market_trans_grid->ReceiptNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($market_trans_grid->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td data-name="LastUpdatedBy" <?php echo $market_trans_grid->LastUpdatedBy->cellAttributes() ?>>
<?php if ($market_trans->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_LastUpdatedBy" class="form-group">
<input type="text" data-table="market_trans" data-field="x_LastUpdatedBy" name="x<?php echo $market_trans_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $market_trans_grid->RowIndex ?>_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($market_trans_grid->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->LastUpdatedBy->EditValue ?>"<?php echo $market_trans_grid->LastUpdatedBy->editAttributes() ?>>
</span>
<input type="hidden" data-table="market_trans" data-field="x_LastUpdatedBy" name="o<?php echo $market_trans_grid->RowIndex ?>_LastUpdatedBy" id="o<?php echo $market_trans_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($market_trans_grid->LastUpdatedBy->OldValue) ?>">
<?php } ?>
<?php if ($market_trans->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_LastUpdatedBy" class="form-group">
<input type="text" data-table="market_trans" data-field="x_LastUpdatedBy" name="x<?php echo $market_trans_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $market_trans_grid->RowIndex ?>_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($market_trans_grid->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->LastUpdatedBy->EditValue ?>"<?php echo $market_trans_grid->LastUpdatedBy->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($market_trans->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_LastUpdatedBy">
<span<?php echo $market_trans_grid->LastUpdatedBy->viewAttributes() ?>><?php echo $market_trans_grid->LastUpdatedBy->getViewValue() ?></span>
</span>
<?php if (!$market_trans->isConfirm()) { ?>
<input type="hidden" data-table="market_trans" data-field="x_LastUpdatedBy" name="x<?php echo $market_trans_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $market_trans_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($market_trans_grid->LastUpdatedBy->FormValue) ?>">
<input type="hidden" data-table="market_trans" data-field="x_LastUpdatedBy" name="o<?php echo $market_trans_grid->RowIndex ?>_LastUpdatedBy" id="o<?php echo $market_trans_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($market_trans_grid->LastUpdatedBy->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="market_trans" data-field="x_LastUpdatedBy" name="fmarket_transgrid$x<?php echo $market_trans_grid->RowIndex ?>_LastUpdatedBy" id="fmarket_transgrid$x<?php echo $market_trans_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($market_trans_grid->LastUpdatedBy->FormValue) ?>">
<input type="hidden" data-table="market_trans" data-field="x_LastUpdatedBy" name="fmarket_transgrid$o<?php echo $market_trans_grid->RowIndex ?>_LastUpdatedBy" id="fmarket_transgrid$o<?php echo $market_trans_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($market_trans_grid->LastUpdatedBy->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($market_trans_grid->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td data-name="LastUpdateDate" <?php echo $market_trans_grid->LastUpdateDate->cellAttributes() ?>>
<?php if ($market_trans->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_LastUpdateDate" class="form-group">
<input type="text" data-table="market_trans" data-field="x_LastUpdateDate" name="x<?php echo $market_trans_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $market_trans_grid->RowIndex ?>_LastUpdateDate" placeholder="<?php echo HtmlEncode($market_trans_grid->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->LastUpdateDate->EditValue ?>"<?php echo $market_trans_grid->LastUpdateDate->editAttributes() ?>>
</span>
<input type="hidden" data-table="market_trans" data-field="x_LastUpdateDate" name="o<?php echo $market_trans_grid->RowIndex ?>_LastUpdateDate" id="o<?php echo $market_trans_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($market_trans_grid->LastUpdateDate->OldValue) ?>">
<?php } ?>
<?php if ($market_trans->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_LastUpdateDate" class="form-group">
<input type="text" data-table="market_trans" data-field="x_LastUpdateDate" name="x<?php echo $market_trans_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $market_trans_grid->RowIndex ?>_LastUpdateDate" placeholder="<?php echo HtmlEncode($market_trans_grid->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->LastUpdateDate->EditValue ?>"<?php echo $market_trans_grid->LastUpdateDate->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($market_trans->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $market_trans_grid->RowCount ?>_market_trans_LastUpdateDate">
<span<?php echo $market_trans_grid->LastUpdateDate->viewAttributes() ?>><?php echo $market_trans_grid->LastUpdateDate->getViewValue() ?></span>
</span>
<?php if (!$market_trans->isConfirm()) { ?>
<input type="hidden" data-table="market_trans" data-field="x_LastUpdateDate" name="x<?php echo $market_trans_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $market_trans_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($market_trans_grid->LastUpdateDate->FormValue) ?>">
<input type="hidden" data-table="market_trans" data-field="x_LastUpdateDate" name="o<?php echo $market_trans_grid->RowIndex ?>_LastUpdateDate" id="o<?php echo $market_trans_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($market_trans_grid->LastUpdateDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="market_trans" data-field="x_LastUpdateDate" name="fmarket_transgrid$x<?php echo $market_trans_grid->RowIndex ?>_LastUpdateDate" id="fmarket_transgrid$x<?php echo $market_trans_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($market_trans_grid->LastUpdateDate->FormValue) ?>">
<input type="hidden" data-table="market_trans" data-field="x_LastUpdateDate" name="fmarket_transgrid$o<?php echo $market_trans_grid->RowIndex ?>_LastUpdateDate" id="fmarket_transgrid$o<?php echo $market_trans_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($market_trans_grid->LastUpdateDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$market_trans_grid->ListOptions->render("body", "right", $market_trans_grid->RowCount);
?>
	</tr>
<?php if ($market_trans->RowType == ROWTYPE_ADD || $market_trans->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fmarket_transgrid", "load"], function() {
	fmarket_transgrid.updateLists(<?php echo $market_trans_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$market_trans_grid->isGridAdd() || $market_trans->CurrentMode == "copy")
		if (!$market_trans_grid->Recordset->EOF)
			$market_trans_grid->Recordset->moveNext();
}
?>
<?php
	if ($market_trans->CurrentMode == "add" || $market_trans->CurrentMode == "copy" || $market_trans->CurrentMode == "edit") {
		$market_trans_grid->RowIndex = '$rowindex$';
		$market_trans_grid->loadRowValues();

		// Set row properties
		$market_trans->resetAttributes();
		$market_trans->RowAttrs->merge(["data-rowindex" => $market_trans_grid->RowIndex, "id" => "r0_market_trans", "data-rowtype" => ROWTYPE_ADD]);
		$market_trans->RowAttrs->appendClass("ew-template");
		$market_trans->RowType = ROWTYPE_ADD;

		// Render row
		$market_trans_grid->renderRow();

		// Render list options
		$market_trans_grid->renderListOptions();
		$market_trans_grid->StartRowCount = 0;
?>
	<tr <?php echo $market_trans->rowAttributes() ?>>
<?php

// Render list options (body, left)
$market_trans_grid->ListOptions->render("body", "left", $market_trans_grid->RowIndex);
?>
	<?php if ($market_trans_grid->TransNo->Visible) { // TransNo ?>
		<td data-name="TransNo">
<?php if (!$market_trans->isConfirm()) { ?>
<span id="el$rowindex$_market_trans_TransNo" class="form-group market_trans_TransNo"></span>
<?php } else { ?>
<span id="el$rowindex$_market_trans_TransNo" class="form-group market_trans_TransNo">
<span<?php echo $market_trans_grid->TransNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_trans_grid->TransNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="market_trans" data-field="x_TransNo" name="x<?php echo $market_trans_grid->RowIndex ?>_TransNo" id="x<?php echo $market_trans_grid->RowIndex ?>_TransNo" value="<?php echo HtmlEncode($market_trans_grid->TransNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="market_trans" data-field="x_TransNo" name="o<?php echo $market_trans_grid->RowIndex ?>_TransNo" id="o<?php echo $market_trans_grid->RowIndex ?>_TransNo" value="<?php echo HtmlEncode($market_trans_grid->TransNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($market_trans_grid->MarketItemNo->Visible) { // MarketItemNo ?>
		<td data-name="MarketItemNo">
<?php if (!$market_trans->isConfirm()) { ?>
<?php if ($market_trans_grid->MarketItemNo->getSessionValue() != "") { ?>
<span id="el$rowindex$_market_trans_MarketItemNo" class="form-group market_trans_MarketItemNo">
<span<?php echo $market_trans_grid->MarketItemNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_trans_grid->MarketItemNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" name="x<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" value="<?php echo HtmlEncode($market_trans_grid->MarketItemNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_market_trans_MarketItemNo" class="form-group market_trans_MarketItemNo">
<input type="text" data-table="market_trans" data-field="x_MarketItemNo" name="x<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" id="x<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" size="30" placeholder="<?php echo HtmlEncode($market_trans_grid->MarketItemNo->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->MarketItemNo->EditValue ?>"<?php echo $market_trans_grid->MarketItemNo->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_market_trans_MarketItemNo" class="form-group market_trans_MarketItemNo">
<span<?php echo $market_trans_grid->MarketItemNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_trans_grid->MarketItemNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="market_trans" data-field="x_MarketItemNo" name="x<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" id="x<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" value="<?php echo HtmlEncode($market_trans_grid->MarketItemNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="market_trans" data-field="x_MarketItemNo" name="o<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" id="o<?php echo $market_trans_grid->RowIndex ?>_MarketItemNo" value="<?php echo HtmlEncode($market_trans_grid->MarketItemNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($market_trans_grid->DateHired->Visible) { // DateHired ?>
		<td data-name="DateHired">
<?php if (!$market_trans->isConfirm()) { ?>
<span id="el$rowindex$_market_trans_DateHired" class="form-group market_trans_DateHired">
<input type="text" data-table="market_trans" data-field="x_DateHired" name="x<?php echo $market_trans_grid->RowIndex ?>_DateHired" id="x<?php echo $market_trans_grid->RowIndex ?>_DateHired" placeholder="<?php echo HtmlEncode($market_trans_grid->DateHired->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->DateHired->EditValue ?>"<?php echo $market_trans_grid->DateHired->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_market_trans_DateHired" class="form-group market_trans_DateHired">
<span<?php echo $market_trans_grid->DateHired->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_trans_grid->DateHired->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="market_trans" data-field="x_DateHired" name="x<?php echo $market_trans_grid->RowIndex ?>_DateHired" id="x<?php echo $market_trans_grid->RowIndex ?>_DateHired" value="<?php echo HtmlEncode($market_trans_grid->DateHired->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="market_trans" data-field="x_DateHired" name="o<?php echo $market_trans_grid->RowIndex ?>_DateHired" id="o<?php echo $market_trans_grid->RowIndex ?>_DateHired" value="<?php echo HtmlEncode($market_trans_grid->DateHired->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($market_trans_grid->MartketeerName->Visible) { // MartketeerName ?>
		<td data-name="MartketeerName">
<?php if (!$market_trans->isConfirm()) { ?>
<span id="el$rowindex$_market_trans_MartketeerName" class="form-group market_trans_MartketeerName">
<input type="text" data-table="market_trans" data-field="x_MartketeerName" name="x<?php echo $market_trans_grid->RowIndex ?>_MartketeerName" id="x<?php echo $market_trans_grid->RowIndex ?>_MartketeerName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($market_trans_grid->MartketeerName->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->MartketeerName->EditValue ?>"<?php echo $market_trans_grid->MartketeerName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_market_trans_MartketeerName" class="form-group market_trans_MartketeerName">
<span<?php echo $market_trans_grid->MartketeerName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_trans_grid->MartketeerName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="market_trans" data-field="x_MartketeerName" name="x<?php echo $market_trans_grid->RowIndex ?>_MartketeerName" id="x<?php echo $market_trans_grid->RowIndex ?>_MartketeerName" value="<?php echo HtmlEncode($market_trans_grid->MartketeerName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="market_trans" data-field="x_MartketeerName" name="o<?php echo $market_trans_grid->RowIndex ?>_MartketeerName" id="o<?php echo $market_trans_grid->RowIndex ?>_MartketeerName" value="<?php echo HtmlEncode($market_trans_grid->MartketeerName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($market_trans_grid->MartketeerID->Visible) { // MartketeerID ?>
		<td data-name="MartketeerID">
<?php if (!$market_trans->isConfirm()) { ?>
<span id="el$rowindex$_market_trans_MartketeerID" class="form-group market_trans_MartketeerID">
<input type="text" data-table="market_trans" data-field="x_MartketeerID" name="x<?php echo $market_trans_grid->RowIndex ?>_MartketeerID" id="x<?php echo $market_trans_grid->RowIndex ?>_MartketeerID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($market_trans_grid->MartketeerID->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->MartketeerID->EditValue ?>"<?php echo $market_trans_grid->MartketeerID->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_market_trans_MartketeerID" class="form-group market_trans_MartketeerID">
<span<?php echo $market_trans_grid->MartketeerID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_trans_grid->MartketeerID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="market_trans" data-field="x_MartketeerID" name="x<?php echo $market_trans_grid->RowIndex ?>_MartketeerID" id="x<?php echo $market_trans_grid->RowIndex ?>_MartketeerID" value="<?php echo HtmlEncode($market_trans_grid->MartketeerID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="market_trans" data-field="x_MartketeerID" name="o<?php echo $market_trans_grid->RowIndex ?>_MartketeerID" id="o<?php echo $market_trans_grid->RowIndex ?>_MartketeerID" value="<?php echo HtmlEncode($market_trans_grid->MartketeerID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($market_trans_grid->AmountDue->Visible) { // AmountDue ?>
		<td data-name="AmountDue">
<?php if (!$market_trans->isConfirm()) { ?>
<span id="el$rowindex$_market_trans_AmountDue" class="form-group market_trans_AmountDue">
<input type="text" data-table="market_trans" data-field="x_AmountDue" name="x<?php echo $market_trans_grid->RowIndex ?>_AmountDue" id="x<?php echo $market_trans_grid->RowIndex ?>_AmountDue" size="30" placeholder="<?php echo HtmlEncode($market_trans_grid->AmountDue->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->AmountDue->EditValue ?>"<?php echo $market_trans_grid->AmountDue->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_market_trans_AmountDue" class="form-group market_trans_AmountDue">
<span<?php echo $market_trans_grid->AmountDue->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_trans_grid->AmountDue->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="market_trans" data-field="x_AmountDue" name="x<?php echo $market_trans_grid->RowIndex ?>_AmountDue" id="x<?php echo $market_trans_grid->RowIndex ?>_AmountDue" value="<?php echo HtmlEncode($market_trans_grid->AmountDue->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="market_trans" data-field="x_AmountDue" name="o<?php echo $market_trans_grid->RowIndex ?>_AmountDue" id="o<?php echo $market_trans_grid->RowIndex ?>_AmountDue" value="<?php echo HtmlEncode($market_trans_grid->AmountDue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($market_trans_grid->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid">
<?php if (!$market_trans->isConfirm()) { ?>
<span id="el$rowindex$_market_trans_AmountPaid" class="form-group market_trans_AmountPaid">
<input type="text" data-table="market_trans" data-field="x_AmountPaid" name="x<?php echo $market_trans_grid->RowIndex ?>_AmountPaid" id="x<?php echo $market_trans_grid->RowIndex ?>_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($market_trans_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->AmountPaid->EditValue ?>"<?php echo $market_trans_grid->AmountPaid->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_market_trans_AmountPaid" class="form-group market_trans_AmountPaid">
<span<?php echo $market_trans_grid->AmountPaid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_trans_grid->AmountPaid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="market_trans" data-field="x_AmountPaid" name="x<?php echo $market_trans_grid->RowIndex ?>_AmountPaid" id="x<?php echo $market_trans_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($market_trans_grid->AmountPaid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="market_trans" data-field="x_AmountPaid" name="o<?php echo $market_trans_grid->RowIndex ?>_AmountPaid" id="o<?php echo $market_trans_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($market_trans_grid->AmountPaid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($market_trans_grid->ReceiptNo->Visible) { // ReceiptNo ?>
		<td data-name="ReceiptNo">
<?php if (!$market_trans->isConfirm()) { ?>
<span id="el$rowindex$_market_trans_ReceiptNo" class="form-group market_trans_ReceiptNo">
<input type="text" data-table="market_trans" data-field="x_ReceiptNo" name="x<?php echo $market_trans_grid->RowIndex ?>_ReceiptNo" id="x<?php echo $market_trans_grid->RowIndex ?>_ReceiptNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($market_trans_grid->ReceiptNo->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->ReceiptNo->EditValue ?>"<?php echo $market_trans_grid->ReceiptNo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_market_trans_ReceiptNo" class="form-group market_trans_ReceiptNo">
<span<?php echo $market_trans_grid->ReceiptNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_trans_grid->ReceiptNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="market_trans" data-field="x_ReceiptNo" name="x<?php echo $market_trans_grid->RowIndex ?>_ReceiptNo" id="x<?php echo $market_trans_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($market_trans_grid->ReceiptNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="market_trans" data-field="x_ReceiptNo" name="o<?php echo $market_trans_grid->RowIndex ?>_ReceiptNo" id="o<?php echo $market_trans_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($market_trans_grid->ReceiptNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($market_trans_grid->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td data-name="LastUpdatedBy">
<?php if (!$market_trans->isConfirm()) { ?>
<span id="el$rowindex$_market_trans_LastUpdatedBy" class="form-group market_trans_LastUpdatedBy">
<input type="text" data-table="market_trans" data-field="x_LastUpdatedBy" name="x<?php echo $market_trans_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $market_trans_grid->RowIndex ?>_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($market_trans_grid->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->LastUpdatedBy->EditValue ?>"<?php echo $market_trans_grid->LastUpdatedBy->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_market_trans_LastUpdatedBy" class="form-group market_trans_LastUpdatedBy">
<span<?php echo $market_trans_grid->LastUpdatedBy->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_trans_grid->LastUpdatedBy->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="market_trans" data-field="x_LastUpdatedBy" name="x<?php echo $market_trans_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $market_trans_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($market_trans_grid->LastUpdatedBy->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="market_trans" data-field="x_LastUpdatedBy" name="o<?php echo $market_trans_grid->RowIndex ?>_LastUpdatedBy" id="o<?php echo $market_trans_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($market_trans_grid->LastUpdatedBy->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($market_trans_grid->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td data-name="LastUpdateDate">
<?php if (!$market_trans->isConfirm()) { ?>
<span id="el$rowindex$_market_trans_LastUpdateDate" class="form-group market_trans_LastUpdateDate">
<input type="text" data-table="market_trans" data-field="x_LastUpdateDate" name="x<?php echo $market_trans_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $market_trans_grid->RowIndex ?>_LastUpdateDate" placeholder="<?php echo HtmlEncode($market_trans_grid->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $market_trans_grid->LastUpdateDate->EditValue ?>"<?php echo $market_trans_grid->LastUpdateDate->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_market_trans_LastUpdateDate" class="form-group market_trans_LastUpdateDate">
<span<?php echo $market_trans_grid->LastUpdateDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($market_trans_grid->LastUpdateDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="market_trans" data-field="x_LastUpdateDate" name="x<?php echo $market_trans_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $market_trans_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($market_trans_grid->LastUpdateDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="market_trans" data-field="x_LastUpdateDate" name="o<?php echo $market_trans_grid->RowIndex ?>_LastUpdateDate" id="o<?php echo $market_trans_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($market_trans_grid->LastUpdateDate->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$market_trans_grid->ListOptions->render("body", "right", $market_trans_grid->RowIndex);
?>
<script>
loadjs.ready(["fmarket_transgrid", "load"], function() {
	fmarket_transgrid.updateLists(<?php echo $market_trans_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($market_trans->CurrentMode == "add" || $market_trans->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $market_trans_grid->FormKeyCountName ?>" id="<?php echo $market_trans_grid->FormKeyCountName ?>" value="<?php echo $market_trans_grid->KeyCount ?>">
<?php echo $market_trans_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($market_trans->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $market_trans_grid->FormKeyCountName ?>" id="<?php echo $market_trans_grid->FormKeyCountName ?>" value="<?php echo $market_trans_grid->KeyCount ?>">
<?php echo $market_trans_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($market_trans->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fmarket_transgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($market_trans_grid->Recordset)
	$market_trans_grid->Recordset->Close();
?>
<?php if ($market_trans_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $market_trans_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($market_trans_grid->TotalRecords == 0 && !$market_trans->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $market_trans_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$market_trans_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$market_trans_grid->terminate();
?>