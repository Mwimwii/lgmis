<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($bank_branch_grid))
	$bank_branch_grid = new bank_branch_grid();

// Run the page
$bank_branch_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bank_branch_grid->Page_Render();
?>
<?php if (!$bank_branch_grid->isExport()) { ?>
<script>
var fbank_branchgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fbank_branchgrid = new ew.Form("fbank_branchgrid", "grid");
	fbank_branchgrid.formKeyCountName = '<?php echo $bank_branch_grid->FormKeyCountName ?>';

	// Validate form
	fbank_branchgrid.validate = function() {
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
			<?php if ($bank_branch_grid->BranchCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_grid->BranchCode->caption(), $bank_branch_grid->BranchCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_grid->BranchName->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_grid->BranchName->caption(), $bank_branch_grid->BranchName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_grid->BankCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BankCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_grid->BankCode->caption(), $bank_branch_grid->BankCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_grid->AreaCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AreaCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_grid->AreaCode->caption(), $bank_branch_grid->AreaCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_grid->BranchNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_grid->BranchNo->caption(), $bank_branch_grid->BranchNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_grid->BranchAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_grid->BranchAddress->caption(), $bank_branch_grid->BranchAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_grid->BranchTel->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchTel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_grid->BranchTel->caption(), $bank_branch_grid->BranchTel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_grid->BranchEmail->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchEmail");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_grid->BranchEmail->caption(), $bank_branch_grid->BranchEmail->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_grid->BranchFax->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchFax");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_grid->BranchFax->caption(), $bank_branch_grid->BranchFax->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_grid->SWIFT->Required) { ?>
				elm = this.getElements("x" + infix + "_SWIFT");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_grid->SWIFT->caption(), $bank_branch_grid->SWIFT->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_grid->IBAN->Required) { ?>
				elm = this.getElements("x" + infix + "_IBAN");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_grid->IBAN->caption(), $bank_branch_grid->IBAN->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fbank_branchgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "BranchCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "BranchName", false)) return false;
		if (ew.valueChanged(fobj, infix, "BankCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "AreaCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "BranchNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "BranchAddress", false)) return false;
		if (ew.valueChanged(fobj, infix, "BranchTel", false)) return false;
		if (ew.valueChanged(fobj, infix, "BranchEmail", false)) return false;
		if (ew.valueChanged(fobj, infix, "BranchFax", false)) return false;
		if (ew.valueChanged(fobj, infix, "SWIFT", false)) return false;
		if (ew.valueChanged(fobj, infix, "IBAN", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fbank_branchgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbank_branchgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fbank_branchgrid");
});
</script>
<?php } ?>
<?php
$bank_branch_grid->renderOtherOptions();
?>
<?php if ($bank_branch_grid->TotalRecords > 0 || $bank_branch->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($bank_branch_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> bank_branch">
<?php if ($bank_branch_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $bank_branch_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fbank_branchgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_bank_branch" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_bank_branchgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$bank_branch->RowType = ROWTYPE_HEADER;

// Render list options
$bank_branch_grid->renderListOptions();

// Render list options (header, left)
$bank_branch_grid->ListOptions->render("header", "left");
?>
<?php if ($bank_branch_grid->BranchCode->Visible) { // BranchCode ?>
	<?php if ($bank_branch_grid->SortUrl($bank_branch_grid->BranchCode) == "") { ?>
		<th data-name="BranchCode" class="<?php echo $bank_branch_grid->BranchCode->headerCellClass() ?>"><div id="elh_bank_branch_BranchCode" class="bank_branch_BranchCode"><div class="ew-table-header-caption"><?php echo $bank_branch_grid->BranchCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BranchCode" class="<?php echo $bank_branch_grid->BranchCode->headerCellClass() ?>"><div><div id="elh_bank_branch_BranchCode" class="bank_branch_BranchCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_grid->BranchCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_grid->BranchCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_grid->BranchCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_grid->BranchName->Visible) { // BranchName ?>
	<?php if ($bank_branch_grid->SortUrl($bank_branch_grid->BranchName) == "") { ?>
		<th data-name="BranchName" class="<?php echo $bank_branch_grid->BranchName->headerCellClass() ?>"><div id="elh_bank_branch_BranchName" class="bank_branch_BranchName"><div class="ew-table-header-caption"><?php echo $bank_branch_grid->BranchName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BranchName" class="<?php echo $bank_branch_grid->BranchName->headerCellClass() ?>"><div><div id="elh_bank_branch_BranchName" class="bank_branch_BranchName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_grid->BranchName->caption() ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_grid->BranchName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_grid->BranchName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_grid->BankCode->Visible) { // BankCode ?>
	<?php if ($bank_branch_grid->SortUrl($bank_branch_grid->BankCode) == "") { ?>
		<th data-name="BankCode" class="<?php echo $bank_branch_grid->BankCode->headerCellClass() ?>"><div id="elh_bank_branch_BankCode" class="bank_branch_BankCode"><div class="ew-table-header-caption"><?php echo $bank_branch_grid->BankCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankCode" class="<?php echo $bank_branch_grid->BankCode->headerCellClass() ?>"><div><div id="elh_bank_branch_BankCode" class="bank_branch_BankCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_grid->BankCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_grid->BankCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_grid->BankCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_grid->AreaCode->Visible) { // AreaCode ?>
	<?php if ($bank_branch_grid->SortUrl($bank_branch_grid->AreaCode) == "") { ?>
		<th data-name="AreaCode" class="<?php echo $bank_branch_grid->AreaCode->headerCellClass() ?>"><div id="elh_bank_branch_AreaCode" class="bank_branch_AreaCode"><div class="ew-table-header-caption"><?php echo $bank_branch_grid->AreaCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AreaCode" class="<?php echo $bank_branch_grid->AreaCode->headerCellClass() ?>"><div><div id="elh_bank_branch_AreaCode" class="bank_branch_AreaCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_grid->AreaCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_grid->AreaCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_grid->AreaCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_grid->BranchNo->Visible) { // BranchNo ?>
	<?php if ($bank_branch_grid->SortUrl($bank_branch_grid->BranchNo) == "") { ?>
		<th data-name="BranchNo" class="<?php echo $bank_branch_grid->BranchNo->headerCellClass() ?>"><div id="elh_bank_branch_BranchNo" class="bank_branch_BranchNo"><div class="ew-table-header-caption"><?php echo $bank_branch_grid->BranchNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BranchNo" class="<?php echo $bank_branch_grid->BranchNo->headerCellClass() ?>"><div><div id="elh_bank_branch_BranchNo" class="bank_branch_BranchNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_grid->BranchNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_grid->BranchNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_grid->BranchNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_grid->BranchAddress->Visible) { // BranchAddress ?>
	<?php if ($bank_branch_grid->SortUrl($bank_branch_grid->BranchAddress) == "") { ?>
		<th data-name="BranchAddress" class="<?php echo $bank_branch_grid->BranchAddress->headerCellClass() ?>"><div id="elh_bank_branch_BranchAddress" class="bank_branch_BranchAddress"><div class="ew-table-header-caption"><?php echo $bank_branch_grid->BranchAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BranchAddress" class="<?php echo $bank_branch_grid->BranchAddress->headerCellClass() ?>"><div><div id="elh_bank_branch_BranchAddress" class="bank_branch_BranchAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_grid->BranchAddress->caption() ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_grid->BranchAddress->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_grid->BranchAddress->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_grid->BranchTel->Visible) { // BranchTel ?>
	<?php if ($bank_branch_grid->SortUrl($bank_branch_grid->BranchTel) == "") { ?>
		<th data-name="BranchTel" class="<?php echo $bank_branch_grid->BranchTel->headerCellClass() ?>"><div id="elh_bank_branch_BranchTel" class="bank_branch_BranchTel"><div class="ew-table-header-caption"><?php echo $bank_branch_grid->BranchTel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BranchTel" class="<?php echo $bank_branch_grid->BranchTel->headerCellClass() ?>"><div><div id="elh_bank_branch_BranchTel" class="bank_branch_BranchTel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_grid->BranchTel->caption() ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_grid->BranchTel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_grid->BranchTel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_grid->BranchEmail->Visible) { // BranchEmail ?>
	<?php if ($bank_branch_grid->SortUrl($bank_branch_grid->BranchEmail) == "") { ?>
		<th data-name="BranchEmail" class="<?php echo $bank_branch_grid->BranchEmail->headerCellClass() ?>"><div id="elh_bank_branch_BranchEmail" class="bank_branch_BranchEmail"><div class="ew-table-header-caption"><?php echo $bank_branch_grid->BranchEmail->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BranchEmail" class="<?php echo $bank_branch_grid->BranchEmail->headerCellClass() ?>"><div><div id="elh_bank_branch_BranchEmail" class="bank_branch_BranchEmail">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_grid->BranchEmail->caption() ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_grid->BranchEmail->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_grid->BranchEmail->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_grid->BranchFax->Visible) { // BranchFax ?>
	<?php if ($bank_branch_grid->SortUrl($bank_branch_grid->BranchFax) == "") { ?>
		<th data-name="BranchFax" class="<?php echo $bank_branch_grid->BranchFax->headerCellClass() ?>"><div id="elh_bank_branch_BranchFax" class="bank_branch_BranchFax"><div class="ew-table-header-caption"><?php echo $bank_branch_grid->BranchFax->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BranchFax" class="<?php echo $bank_branch_grid->BranchFax->headerCellClass() ?>"><div><div id="elh_bank_branch_BranchFax" class="bank_branch_BranchFax">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_grid->BranchFax->caption() ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_grid->BranchFax->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_grid->BranchFax->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_grid->SWIFT->Visible) { // SWIFT ?>
	<?php if ($bank_branch_grid->SortUrl($bank_branch_grid->SWIFT) == "") { ?>
		<th data-name="SWIFT" class="<?php echo $bank_branch_grid->SWIFT->headerCellClass() ?>"><div id="elh_bank_branch_SWIFT" class="bank_branch_SWIFT"><div class="ew-table-header-caption"><?php echo $bank_branch_grid->SWIFT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SWIFT" class="<?php echo $bank_branch_grid->SWIFT->headerCellClass() ?>"><div><div id="elh_bank_branch_SWIFT" class="bank_branch_SWIFT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_grid->SWIFT->caption() ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_grid->SWIFT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_grid->SWIFT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_grid->IBAN->Visible) { // IBAN ?>
	<?php if ($bank_branch_grid->SortUrl($bank_branch_grid->IBAN) == "") { ?>
		<th data-name="IBAN" class="<?php echo $bank_branch_grid->IBAN->headerCellClass() ?>"><div id="elh_bank_branch_IBAN" class="bank_branch_IBAN"><div class="ew-table-header-caption"><?php echo $bank_branch_grid->IBAN->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IBAN" class="<?php echo $bank_branch_grid->IBAN->headerCellClass() ?>"><div><div id="elh_bank_branch_IBAN" class="bank_branch_IBAN">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_grid->IBAN->caption() ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_grid->IBAN->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_grid->IBAN->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$bank_branch_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$bank_branch_grid->StartRecord = 1;
$bank_branch_grid->StopRecord = $bank_branch_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($bank_branch->isConfirm() || $bank_branch_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($bank_branch_grid->FormKeyCountName) && ($bank_branch_grid->isGridAdd() || $bank_branch_grid->isGridEdit() || $bank_branch->isConfirm())) {
		$bank_branch_grid->KeyCount = $CurrentForm->getValue($bank_branch_grid->FormKeyCountName);
		$bank_branch_grid->StopRecord = $bank_branch_grid->StartRecord + $bank_branch_grid->KeyCount - 1;
	}
}
$bank_branch_grid->RecordCount = $bank_branch_grid->StartRecord - 1;
if ($bank_branch_grid->Recordset && !$bank_branch_grid->Recordset->EOF) {
	$bank_branch_grid->Recordset->moveFirst();
	$selectLimit = $bank_branch_grid->UseSelectLimit;
	if (!$selectLimit && $bank_branch_grid->StartRecord > 1)
		$bank_branch_grid->Recordset->move($bank_branch_grid->StartRecord - 1);
} elseif (!$bank_branch->AllowAddDeleteRow && $bank_branch_grid->StopRecord == 0) {
	$bank_branch_grid->StopRecord = $bank_branch->GridAddRowCount;
}

// Initialize aggregate
$bank_branch->RowType = ROWTYPE_AGGREGATEINIT;
$bank_branch->resetAttributes();
$bank_branch_grid->renderRow();
if ($bank_branch_grid->isGridAdd())
	$bank_branch_grid->RowIndex = 0;
if ($bank_branch_grid->isGridEdit())
	$bank_branch_grid->RowIndex = 0;
while ($bank_branch_grid->RecordCount < $bank_branch_grid->StopRecord) {
	$bank_branch_grid->RecordCount++;
	if ($bank_branch_grid->RecordCount >= $bank_branch_grid->StartRecord) {
		$bank_branch_grid->RowCount++;
		if ($bank_branch_grid->isGridAdd() || $bank_branch_grid->isGridEdit() || $bank_branch->isConfirm()) {
			$bank_branch_grid->RowIndex++;
			$CurrentForm->Index = $bank_branch_grid->RowIndex;
			if ($CurrentForm->hasValue($bank_branch_grid->FormActionName) && ($bank_branch->isConfirm() || $bank_branch_grid->EventCancelled))
				$bank_branch_grid->RowAction = strval($CurrentForm->getValue($bank_branch_grid->FormActionName));
			elseif ($bank_branch_grid->isGridAdd())
				$bank_branch_grid->RowAction = "insert";
			else
				$bank_branch_grid->RowAction = "";
		}

		// Set up key count
		$bank_branch_grid->KeyCount = $bank_branch_grid->RowIndex;

		// Init row class and style
		$bank_branch->resetAttributes();
		$bank_branch->CssClass = "";
		if ($bank_branch_grid->isGridAdd()) {
			if ($bank_branch->CurrentMode == "copy") {
				$bank_branch_grid->loadRowValues($bank_branch_grid->Recordset); // Load row values
				$bank_branch_grid->setRecordKey($bank_branch_grid->RowOldKey, $bank_branch_grid->Recordset); // Set old record key
			} else {
				$bank_branch_grid->loadRowValues(); // Load default values
				$bank_branch_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$bank_branch_grid->loadRowValues($bank_branch_grid->Recordset); // Load row values
		}
		$bank_branch->RowType = ROWTYPE_VIEW; // Render view
		if ($bank_branch_grid->isGridAdd()) // Grid add
			$bank_branch->RowType = ROWTYPE_ADD; // Render add
		if ($bank_branch_grid->isGridAdd() && $bank_branch->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$bank_branch_grid->restoreCurrentRowFormValues($bank_branch_grid->RowIndex); // Restore form values
		if ($bank_branch_grid->isGridEdit()) { // Grid edit
			if ($bank_branch->EventCancelled)
				$bank_branch_grid->restoreCurrentRowFormValues($bank_branch_grid->RowIndex); // Restore form values
			if ($bank_branch_grid->RowAction == "insert")
				$bank_branch->RowType = ROWTYPE_ADD; // Render add
			else
				$bank_branch->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($bank_branch_grid->isGridEdit() && ($bank_branch->RowType == ROWTYPE_EDIT || $bank_branch->RowType == ROWTYPE_ADD) && $bank_branch->EventCancelled) // Update failed
			$bank_branch_grid->restoreCurrentRowFormValues($bank_branch_grid->RowIndex); // Restore form values
		if ($bank_branch->RowType == ROWTYPE_EDIT) // Edit row
			$bank_branch_grid->EditRowCount++;
		if ($bank_branch->isConfirm()) // Confirm row
			$bank_branch_grid->restoreCurrentRowFormValues($bank_branch_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$bank_branch->RowAttrs->merge(["data-rowindex" => $bank_branch_grid->RowCount, "id" => "r" . $bank_branch_grid->RowCount . "_bank_branch", "data-rowtype" => $bank_branch->RowType]);

		// Render row
		$bank_branch_grid->renderRow();

		// Render list options
		$bank_branch_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($bank_branch_grid->RowAction != "delete" && $bank_branch_grid->RowAction != "insertdelete" && !($bank_branch_grid->RowAction == "insert" && $bank_branch->isConfirm() && $bank_branch_grid->emptyRow())) {
?>
	<tr <?php echo $bank_branch->rowAttributes() ?>>
<?php

// Render list options (body, left)
$bank_branch_grid->ListOptions->render("body", "left", $bank_branch_grid->RowCount);
?>
	<?php if ($bank_branch_grid->BranchCode->Visible) { // BranchCode ?>
		<td data-name="BranchCode" <?php echo $bank_branch_grid->BranchCode->cellAttributes() ?>>
<?php if ($bank_branch->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BranchCode" class="form-group">
<input type="text" data-table="bank_branch" data-field="x_BranchCode" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchCode" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchCode" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($bank_branch_grid->BranchCode->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->BranchCode->EditValue ?>"<?php echo $bank_branch_grid->BranchCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="bank_branch" data-field="x_BranchCode" name="o<?php echo $bank_branch_grid->RowIndex ?>_BranchCode" id="o<?php echo $bank_branch_grid->RowIndex ?>_BranchCode" value="<?php echo HtmlEncode($bank_branch_grid->BranchCode->OldValue) ?>">
<?php } ?>
<?php if ($bank_branch->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="bank_branch" data-field="x_BranchCode" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchCode" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchCode" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($bank_branch_grid->BranchCode->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->BranchCode->EditValue ?>"<?php echo $bank_branch_grid->BranchCode->editAttributes() ?>>
<input type="hidden" data-table="bank_branch" data-field="x_BranchCode" name="o<?php echo $bank_branch_grid->RowIndex ?>_BranchCode" id="o<?php echo $bank_branch_grid->RowIndex ?>_BranchCode" value="<?php echo HtmlEncode($bank_branch_grid->BranchCode->OldValue != null ? $bank_branch_grid->BranchCode->OldValue : $bank_branch_grid->BranchCode->CurrentValue) ?>">
<?php } ?>
<?php if ($bank_branch->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BranchCode">
<span<?php echo $bank_branch_grid->BranchCode->viewAttributes() ?>><?php echo $bank_branch_grid->BranchCode->getViewValue() ?></span>
</span>
<?php if (!$bank_branch->isConfirm()) { ?>
<input type="hidden" data-table="bank_branch" data-field="x_BranchCode" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchCode" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchCode" value="<?php echo HtmlEncode($bank_branch_grid->BranchCode->FormValue) ?>">
<input type="hidden" data-table="bank_branch" data-field="x_BranchCode" name="o<?php echo $bank_branch_grid->RowIndex ?>_BranchCode" id="o<?php echo $bank_branch_grid->RowIndex ?>_BranchCode" value="<?php echo HtmlEncode($bank_branch_grid->BranchCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bank_branch" data-field="x_BranchCode" name="fbank_branchgrid$x<?php echo $bank_branch_grid->RowIndex ?>_BranchCode" id="fbank_branchgrid$x<?php echo $bank_branch_grid->RowIndex ?>_BranchCode" value="<?php echo HtmlEncode($bank_branch_grid->BranchCode->FormValue) ?>">
<input type="hidden" data-table="bank_branch" data-field="x_BranchCode" name="fbank_branchgrid$o<?php echo $bank_branch_grid->RowIndex ?>_BranchCode" id="fbank_branchgrid$o<?php echo $bank_branch_grid->RowIndex ?>_BranchCode" value="<?php echo HtmlEncode($bank_branch_grid->BranchCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bank_branch_grid->BranchName->Visible) { // BranchName ?>
		<td data-name="BranchName" <?php echo $bank_branch_grid->BranchName->cellAttributes() ?>>
<?php if ($bank_branch->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BranchName" class="form-group">
<input type="text" data-table="bank_branch" data-field="x_BranchName" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchName" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchName" size="30" maxlength="70" placeholder="<?php echo HtmlEncode($bank_branch_grid->BranchName->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->BranchName->EditValue ?>"<?php echo $bank_branch_grid->BranchName->editAttributes() ?>>
</span>
<input type="hidden" data-table="bank_branch" data-field="x_BranchName" name="o<?php echo $bank_branch_grid->RowIndex ?>_BranchName" id="o<?php echo $bank_branch_grid->RowIndex ?>_BranchName" value="<?php echo HtmlEncode($bank_branch_grid->BranchName->OldValue) ?>">
<?php } ?>
<?php if ($bank_branch->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BranchName" class="form-group">
<input type="text" data-table="bank_branch" data-field="x_BranchName" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchName" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchName" size="30" maxlength="70" placeholder="<?php echo HtmlEncode($bank_branch_grid->BranchName->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->BranchName->EditValue ?>"<?php echo $bank_branch_grid->BranchName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bank_branch->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BranchName">
<span<?php echo $bank_branch_grid->BranchName->viewAttributes() ?>><?php echo $bank_branch_grid->BranchName->getViewValue() ?></span>
</span>
<?php if (!$bank_branch->isConfirm()) { ?>
<input type="hidden" data-table="bank_branch" data-field="x_BranchName" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchName" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchName" value="<?php echo HtmlEncode($bank_branch_grid->BranchName->FormValue) ?>">
<input type="hidden" data-table="bank_branch" data-field="x_BranchName" name="o<?php echo $bank_branch_grid->RowIndex ?>_BranchName" id="o<?php echo $bank_branch_grid->RowIndex ?>_BranchName" value="<?php echo HtmlEncode($bank_branch_grid->BranchName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bank_branch" data-field="x_BranchName" name="fbank_branchgrid$x<?php echo $bank_branch_grid->RowIndex ?>_BranchName" id="fbank_branchgrid$x<?php echo $bank_branch_grid->RowIndex ?>_BranchName" value="<?php echo HtmlEncode($bank_branch_grid->BranchName->FormValue) ?>">
<input type="hidden" data-table="bank_branch" data-field="x_BranchName" name="fbank_branchgrid$o<?php echo $bank_branch_grid->RowIndex ?>_BranchName" id="fbank_branchgrid$o<?php echo $bank_branch_grid->RowIndex ?>_BranchName" value="<?php echo HtmlEncode($bank_branch_grid->BranchName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bank_branch_grid->BankCode->Visible) { // BankCode ?>
		<td data-name="BankCode" <?php echo $bank_branch_grid->BankCode->cellAttributes() ?>>
<?php if ($bank_branch->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($bank_branch_grid->BankCode->getSessionValue() != "") { ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BankCode" class="form-group">
<span<?php echo $bank_branch_grid->BankCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bank_branch_grid->BankCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $bank_branch_grid->RowIndex ?>_BankCode" name="x<?php echo $bank_branch_grid->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($bank_branch_grid->BankCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BankCode" class="form-group">
<input type="text" data-table="bank_branch" data-field="x_BankCode" name="x<?php echo $bank_branch_grid->RowIndex ?>_BankCode" id="x<?php echo $bank_branch_grid->RowIndex ?>_BankCode" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($bank_branch_grid->BankCode->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->BankCode->EditValue ?>"<?php echo $bank_branch_grid->BankCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="bank_branch" data-field="x_BankCode" name="o<?php echo $bank_branch_grid->RowIndex ?>_BankCode" id="o<?php echo $bank_branch_grid->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($bank_branch_grid->BankCode->OldValue) ?>">
<?php } ?>
<?php if ($bank_branch->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($bank_branch_grid->BankCode->getSessionValue() != "") { ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BankCode" class="form-group">
<span<?php echo $bank_branch_grid->BankCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bank_branch_grid->BankCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $bank_branch_grid->RowIndex ?>_BankCode" name="x<?php echo $bank_branch_grid->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($bank_branch_grid->BankCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BankCode" class="form-group">
<input type="text" data-table="bank_branch" data-field="x_BankCode" name="x<?php echo $bank_branch_grid->RowIndex ?>_BankCode" id="x<?php echo $bank_branch_grid->RowIndex ?>_BankCode" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($bank_branch_grid->BankCode->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->BankCode->EditValue ?>"<?php echo $bank_branch_grid->BankCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($bank_branch->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BankCode">
<span<?php echo $bank_branch_grid->BankCode->viewAttributes() ?>><?php echo $bank_branch_grid->BankCode->getViewValue() ?></span>
</span>
<?php if (!$bank_branch->isConfirm()) { ?>
<input type="hidden" data-table="bank_branch" data-field="x_BankCode" name="x<?php echo $bank_branch_grid->RowIndex ?>_BankCode" id="x<?php echo $bank_branch_grid->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($bank_branch_grid->BankCode->FormValue) ?>">
<input type="hidden" data-table="bank_branch" data-field="x_BankCode" name="o<?php echo $bank_branch_grid->RowIndex ?>_BankCode" id="o<?php echo $bank_branch_grid->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($bank_branch_grid->BankCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bank_branch" data-field="x_BankCode" name="fbank_branchgrid$x<?php echo $bank_branch_grid->RowIndex ?>_BankCode" id="fbank_branchgrid$x<?php echo $bank_branch_grid->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($bank_branch_grid->BankCode->FormValue) ?>">
<input type="hidden" data-table="bank_branch" data-field="x_BankCode" name="fbank_branchgrid$o<?php echo $bank_branch_grid->RowIndex ?>_BankCode" id="fbank_branchgrid$o<?php echo $bank_branch_grid->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($bank_branch_grid->BankCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bank_branch_grid->AreaCode->Visible) { // AreaCode ?>
		<td data-name="AreaCode" <?php echo $bank_branch_grid->AreaCode->cellAttributes() ?>>
<?php if ($bank_branch->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_AreaCode" class="form-group">
<input type="text" data-table="bank_branch" data-field="x_AreaCode" name="x<?php echo $bank_branch_grid->RowIndex ?>_AreaCode" id="x<?php echo $bank_branch_grid->RowIndex ?>_AreaCode" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($bank_branch_grid->AreaCode->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->AreaCode->EditValue ?>"<?php echo $bank_branch_grid->AreaCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="bank_branch" data-field="x_AreaCode" name="o<?php echo $bank_branch_grid->RowIndex ?>_AreaCode" id="o<?php echo $bank_branch_grid->RowIndex ?>_AreaCode" value="<?php echo HtmlEncode($bank_branch_grid->AreaCode->OldValue) ?>">
<?php } ?>
<?php if ($bank_branch->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_AreaCode" class="form-group">
<input type="text" data-table="bank_branch" data-field="x_AreaCode" name="x<?php echo $bank_branch_grid->RowIndex ?>_AreaCode" id="x<?php echo $bank_branch_grid->RowIndex ?>_AreaCode" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($bank_branch_grid->AreaCode->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->AreaCode->EditValue ?>"<?php echo $bank_branch_grid->AreaCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bank_branch->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_AreaCode">
<span<?php echo $bank_branch_grid->AreaCode->viewAttributes() ?>><?php echo $bank_branch_grid->AreaCode->getViewValue() ?></span>
</span>
<?php if (!$bank_branch->isConfirm()) { ?>
<input type="hidden" data-table="bank_branch" data-field="x_AreaCode" name="x<?php echo $bank_branch_grid->RowIndex ?>_AreaCode" id="x<?php echo $bank_branch_grid->RowIndex ?>_AreaCode" value="<?php echo HtmlEncode($bank_branch_grid->AreaCode->FormValue) ?>">
<input type="hidden" data-table="bank_branch" data-field="x_AreaCode" name="o<?php echo $bank_branch_grid->RowIndex ?>_AreaCode" id="o<?php echo $bank_branch_grid->RowIndex ?>_AreaCode" value="<?php echo HtmlEncode($bank_branch_grid->AreaCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bank_branch" data-field="x_AreaCode" name="fbank_branchgrid$x<?php echo $bank_branch_grid->RowIndex ?>_AreaCode" id="fbank_branchgrid$x<?php echo $bank_branch_grid->RowIndex ?>_AreaCode" value="<?php echo HtmlEncode($bank_branch_grid->AreaCode->FormValue) ?>">
<input type="hidden" data-table="bank_branch" data-field="x_AreaCode" name="fbank_branchgrid$o<?php echo $bank_branch_grid->RowIndex ?>_AreaCode" id="fbank_branchgrid$o<?php echo $bank_branch_grid->RowIndex ?>_AreaCode" value="<?php echo HtmlEncode($bank_branch_grid->AreaCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bank_branch_grid->BranchNo->Visible) { // BranchNo ?>
		<td data-name="BranchNo" <?php echo $bank_branch_grid->BranchNo->cellAttributes() ?>>
<?php if ($bank_branch->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BranchNo" class="form-group">
<input type="text" data-table="bank_branch" data-field="x_BranchNo" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchNo" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchNo" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($bank_branch_grid->BranchNo->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->BranchNo->EditValue ?>"<?php echo $bank_branch_grid->BranchNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="bank_branch" data-field="x_BranchNo" name="o<?php echo $bank_branch_grid->RowIndex ?>_BranchNo" id="o<?php echo $bank_branch_grid->RowIndex ?>_BranchNo" value="<?php echo HtmlEncode($bank_branch_grid->BranchNo->OldValue) ?>">
<?php } ?>
<?php if ($bank_branch->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BranchNo" class="form-group">
<input type="text" data-table="bank_branch" data-field="x_BranchNo" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchNo" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchNo" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($bank_branch_grid->BranchNo->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->BranchNo->EditValue ?>"<?php echo $bank_branch_grid->BranchNo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bank_branch->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BranchNo">
<span<?php echo $bank_branch_grid->BranchNo->viewAttributes() ?>><?php echo $bank_branch_grid->BranchNo->getViewValue() ?></span>
</span>
<?php if (!$bank_branch->isConfirm()) { ?>
<input type="hidden" data-table="bank_branch" data-field="x_BranchNo" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchNo" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchNo" value="<?php echo HtmlEncode($bank_branch_grid->BranchNo->FormValue) ?>">
<input type="hidden" data-table="bank_branch" data-field="x_BranchNo" name="o<?php echo $bank_branch_grid->RowIndex ?>_BranchNo" id="o<?php echo $bank_branch_grid->RowIndex ?>_BranchNo" value="<?php echo HtmlEncode($bank_branch_grid->BranchNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bank_branch" data-field="x_BranchNo" name="fbank_branchgrid$x<?php echo $bank_branch_grid->RowIndex ?>_BranchNo" id="fbank_branchgrid$x<?php echo $bank_branch_grid->RowIndex ?>_BranchNo" value="<?php echo HtmlEncode($bank_branch_grid->BranchNo->FormValue) ?>">
<input type="hidden" data-table="bank_branch" data-field="x_BranchNo" name="fbank_branchgrid$o<?php echo $bank_branch_grid->RowIndex ?>_BranchNo" id="fbank_branchgrid$o<?php echo $bank_branch_grid->RowIndex ?>_BranchNo" value="<?php echo HtmlEncode($bank_branch_grid->BranchNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bank_branch_grid->BranchAddress->Visible) { // BranchAddress ?>
		<td data-name="BranchAddress" <?php echo $bank_branch_grid->BranchAddress->cellAttributes() ?>>
<?php if ($bank_branch->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BranchAddress" class="form-group">
<input type="text" data-table="bank_branch" data-field="x_BranchAddress" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchAddress" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($bank_branch_grid->BranchAddress->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->BranchAddress->EditValue ?>"<?php echo $bank_branch_grid->BranchAddress->editAttributes() ?>>
</span>
<input type="hidden" data-table="bank_branch" data-field="x_BranchAddress" name="o<?php echo $bank_branch_grid->RowIndex ?>_BranchAddress" id="o<?php echo $bank_branch_grid->RowIndex ?>_BranchAddress" value="<?php echo HtmlEncode($bank_branch_grid->BranchAddress->OldValue) ?>">
<?php } ?>
<?php if ($bank_branch->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BranchAddress" class="form-group">
<input type="text" data-table="bank_branch" data-field="x_BranchAddress" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchAddress" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($bank_branch_grid->BranchAddress->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->BranchAddress->EditValue ?>"<?php echo $bank_branch_grid->BranchAddress->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bank_branch->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BranchAddress">
<span<?php echo $bank_branch_grid->BranchAddress->viewAttributes() ?>><?php echo $bank_branch_grid->BranchAddress->getViewValue() ?></span>
</span>
<?php if (!$bank_branch->isConfirm()) { ?>
<input type="hidden" data-table="bank_branch" data-field="x_BranchAddress" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchAddress" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchAddress" value="<?php echo HtmlEncode($bank_branch_grid->BranchAddress->FormValue) ?>">
<input type="hidden" data-table="bank_branch" data-field="x_BranchAddress" name="o<?php echo $bank_branch_grid->RowIndex ?>_BranchAddress" id="o<?php echo $bank_branch_grid->RowIndex ?>_BranchAddress" value="<?php echo HtmlEncode($bank_branch_grid->BranchAddress->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bank_branch" data-field="x_BranchAddress" name="fbank_branchgrid$x<?php echo $bank_branch_grid->RowIndex ?>_BranchAddress" id="fbank_branchgrid$x<?php echo $bank_branch_grid->RowIndex ?>_BranchAddress" value="<?php echo HtmlEncode($bank_branch_grid->BranchAddress->FormValue) ?>">
<input type="hidden" data-table="bank_branch" data-field="x_BranchAddress" name="fbank_branchgrid$o<?php echo $bank_branch_grid->RowIndex ?>_BranchAddress" id="fbank_branchgrid$o<?php echo $bank_branch_grid->RowIndex ?>_BranchAddress" value="<?php echo HtmlEncode($bank_branch_grid->BranchAddress->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bank_branch_grid->BranchTel->Visible) { // BranchTel ?>
		<td data-name="BranchTel" <?php echo $bank_branch_grid->BranchTel->cellAttributes() ?>>
<?php if ($bank_branch->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BranchTel" class="form-group">
<input type="text" data-table="bank_branch" data-field="x_BranchTel" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchTel" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchTel" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_grid->BranchTel->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->BranchTel->EditValue ?>"<?php echo $bank_branch_grid->BranchTel->editAttributes() ?>>
</span>
<input type="hidden" data-table="bank_branch" data-field="x_BranchTel" name="o<?php echo $bank_branch_grid->RowIndex ?>_BranchTel" id="o<?php echo $bank_branch_grid->RowIndex ?>_BranchTel" value="<?php echo HtmlEncode($bank_branch_grid->BranchTel->OldValue) ?>">
<?php } ?>
<?php if ($bank_branch->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BranchTel" class="form-group">
<input type="text" data-table="bank_branch" data-field="x_BranchTel" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchTel" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchTel" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_grid->BranchTel->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->BranchTel->EditValue ?>"<?php echo $bank_branch_grid->BranchTel->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bank_branch->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BranchTel">
<span<?php echo $bank_branch_grid->BranchTel->viewAttributes() ?>><?php echo $bank_branch_grid->BranchTel->getViewValue() ?></span>
</span>
<?php if (!$bank_branch->isConfirm()) { ?>
<input type="hidden" data-table="bank_branch" data-field="x_BranchTel" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchTel" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchTel" value="<?php echo HtmlEncode($bank_branch_grid->BranchTel->FormValue) ?>">
<input type="hidden" data-table="bank_branch" data-field="x_BranchTel" name="o<?php echo $bank_branch_grid->RowIndex ?>_BranchTel" id="o<?php echo $bank_branch_grid->RowIndex ?>_BranchTel" value="<?php echo HtmlEncode($bank_branch_grid->BranchTel->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bank_branch" data-field="x_BranchTel" name="fbank_branchgrid$x<?php echo $bank_branch_grid->RowIndex ?>_BranchTel" id="fbank_branchgrid$x<?php echo $bank_branch_grid->RowIndex ?>_BranchTel" value="<?php echo HtmlEncode($bank_branch_grid->BranchTel->FormValue) ?>">
<input type="hidden" data-table="bank_branch" data-field="x_BranchTel" name="fbank_branchgrid$o<?php echo $bank_branch_grid->RowIndex ?>_BranchTel" id="fbank_branchgrid$o<?php echo $bank_branch_grid->RowIndex ?>_BranchTel" value="<?php echo HtmlEncode($bank_branch_grid->BranchTel->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bank_branch_grid->BranchEmail->Visible) { // BranchEmail ?>
		<td data-name="BranchEmail" <?php echo $bank_branch_grid->BranchEmail->cellAttributes() ?>>
<?php if ($bank_branch->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BranchEmail" class="form-group">
<input type="text" data-table="bank_branch" data-field="x_BranchEmail" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchEmail" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchEmail" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_grid->BranchEmail->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->BranchEmail->EditValue ?>"<?php echo $bank_branch_grid->BranchEmail->editAttributes() ?>>
</span>
<input type="hidden" data-table="bank_branch" data-field="x_BranchEmail" name="o<?php echo $bank_branch_grid->RowIndex ?>_BranchEmail" id="o<?php echo $bank_branch_grid->RowIndex ?>_BranchEmail" value="<?php echo HtmlEncode($bank_branch_grid->BranchEmail->OldValue) ?>">
<?php } ?>
<?php if ($bank_branch->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BranchEmail" class="form-group">
<input type="text" data-table="bank_branch" data-field="x_BranchEmail" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchEmail" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchEmail" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_grid->BranchEmail->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->BranchEmail->EditValue ?>"<?php echo $bank_branch_grid->BranchEmail->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bank_branch->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BranchEmail">
<span<?php echo $bank_branch_grid->BranchEmail->viewAttributes() ?>><?php echo $bank_branch_grid->BranchEmail->getViewValue() ?></span>
</span>
<?php if (!$bank_branch->isConfirm()) { ?>
<input type="hidden" data-table="bank_branch" data-field="x_BranchEmail" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchEmail" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchEmail" value="<?php echo HtmlEncode($bank_branch_grid->BranchEmail->FormValue) ?>">
<input type="hidden" data-table="bank_branch" data-field="x_BranchEmail" name="o<?php echo $bank_branch_grid->RowIndex ?>_BranchEmail" id="o<?php echo $bank_branch_grid->RowIndex ?>_BranchEmail" value="<?php echo HtmlEncode($bank_branch_grid->BranchEmail->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bank_branch" data-field="x_BranchEmail" name="fbank_branchgrid$x<?php echo $bank_branch_grid->RowIndex ?>_BranchEmail" id="fbank_branchgrid$x<?php echo $bank_branch_grid->RowIndex ?>_BranchEmail" value="<?php echo HtmlEncode($bank_branch_grid->BranchEmail->FormValue) ?>">
<input type="hidden" data-table="bank_branch" data-field="x_BranchEmail" name="fbank_branchgrid$o<?php echo $bank_branch_grid->RowIndex ?>_BranchEmail" id="fbank_branchgrid$o<?php echo $bank_branch_grid->RowIndex ?>_BranchEmail" value="<?php echo HtmlEncode($bank_branch_grid->BranchEmail->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bank_branch_grid->BranchFax->Visible) { // BranchFax ?>
		<td data-name="BranchFax" <?php echo $bank_branch_grid->BranchFax->cellAttributes() ?>>
<?php if ($bank_branch->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BranchFax" class="form-group">
<input type="text" data-table="bank_branch" data-field="x_BranchFax" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchFax" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchFax" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_grid->BranchFax->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->BranchFax->EditValue ?>"<?php echo $bank_branch_grid->BranchFax->editAttributes() ?>>
</span>
<input type="hidden" data-table="bank_branch" data-field="x_BranchFax" name="o<?php echo $bank_branch_grid->RowIndex ?>_BranchFax" id="o<?php echo $bank_branch_grid->RowIndex ?>_BranchFax" value="<?php echo HtmlEncode($bank_branch_grid->BranchFax->OldValue) ?>">
<?php } ?>
<?php if ($bank_branch->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BranchFax" class="form-group">
<input type="text" data-table="bank_branch" data-field="x_BranchFax" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchFax" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchFax" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_grid->BranchFax->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->BranchFax->EditValue ?>"<?php echo $bank_branch_grid->BranchFax->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bank_branch->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_BranchFax">
<span<?php echo $bank_branch_grid->BranchFax->viewAttributes() ?>><?php echo $bank_branch_grid->BranchFax->getViewValue() ?></span>
</span>
<?php if (!$bank_branch->isConfirm()) { ?>
<input type="hidden" data-table="bank_branch" data-field="x_BranchFax" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchFax" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchFax" value="<?php echo HtmlEncode($bank_branch_grid->BranchFax->FormValue) ?>">
<input type="hidden" data-table="bank_branch" data-field="x_BranchFax" name="o<?php echo $bank_branch_grid->RowIndex ?>_BranchFax" id="o<?php echo $bank_branch_grid->RowIndex ?>_BranchFax" value="<?php echo HtmlEncode($bank_branch_grid->BranchFax->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bank_branch" data-field="x_BranchFax" name="fbank_branchgrid$x<?php echo $bank_branch_grid->RowIndex ?>_BranchFax" id="fbank_branchgrid$x<?php echo $bank_branch_grid->RowIndex ?>_BranchFax" value="<?php echo HtmlEncode($bank_branch_grid->BranchFax->FormValue) ?>">
<input type="hidden" data-table="bank_branch" data-field="x_BranchFax" name="fbank_branchgrid$o<?php echo $bank_branch_grid->RowIndex ?>_BranchFax" id="fbank_branchgrid$o<?php echo $bank_branch_grid->RowIndex ?>_BranchFax" value="<?php echo HtmlEncode($bank_branch_grid->BranchFax->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bank_branch_grid->SWIFT->Visible) { // SWIFT ?>
		<td data-name="SWIFT" <?php echo $bank_branch_grid->SWIFT->cellAttributes() ?>>
<?php if ($bank_branch->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_SWIFT" class="form-group">
<input type="text" data-table="bank_branch" data-field="x_SWIFT" name="x<?php echo $bank_branch_grid->RowIndex ?>_SWIFT" id="x<?php echo $bank_branch_grid->RowIndex ?>_SWIFT" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_grid->SWIFT->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->SWIFT->EditValue ?>"<?php echo $bank_branch_grid->SWIFT->editAttributes() ?>>
</span>
<input type="hidden" data-table="bank_branch" data-field="x_SWIFT" name="o<?php echo $bank_branch_grid->RowIndex ?>_SWIFT" id="o<?php echo $bank_branch_grid->RowIndex ?>_SWIFT" value="<?php echo HtmlEncode($bank_branch_grid->SWIFT->OldValue) ?>">
<?php } ?>
<?php if ($bank_branch->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_SWIFT" class="form-group">
<input type="text" data-table="bank_branch" data-field="x_SWIFT" name="x<?php echo $bank_branch_grid->RowIndex ?>_SWIFT" id="x<?php echo $bank_branch_grid->RowIndex ?>_SWIFT" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_grid->SWIFT->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->SWIFT->EditValue ?>"<?php echo $bank_branch_grid->SWIFT->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bank_branch->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_SWIFT">
<span<?php echo $bank_branch_grid->SWIFT->viewAttributes() ?>><?php echo $bank_branch_grid->SWIFT->getViewValue() ?></span>
</span>
<?php if (!$bank_branch->isConfirm()) { ?>
<input type="hidden" data-table="bank_branch" data-field="x_SWIFT" name="x<?php echo $bank_branch_grid->RowIndex ?>_SWIFT" id="x<?php echo $bank_branch_grid->RowIndex ?>_SWIFT" value="<?php echo HtmlEncode($bank_branch_grid->SWIFT->FormValue) ?>">
<input type="hidden" data-table="bank_branch" data-field="x_SWIFT" name="o<?php echo $bank_branch_grid->RowIndex ?>_SWIFT" id="o<?php echo $bank_branch_grid->RowIndex ?>_SWIFT" value="<?php echo HtmlEncode($bank_branch_grid->SWIFT->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bank_branch" data-field="x_SWIFT" name="fbank_branchgrid$x<?php echo $bank_branch_grid->RowIndex ?>_SWIFT" id="fbank_branchgrid$x<?php echo $bank_branch_grid->RowIndex ?>_SWIFT" value="<?php echo HtmlEncode($bank_branch_grid->SWIFT->FormValue) ?>">
<input type="hidden" data-table="bank_branch" data-field="x_SWIFT" name="fbank_branchgrid$o<?php echo $bank_branch_grid->RowIndex ?>_SWIFT" id="fbank_branchgrid$o<?php echo $bank_branch_grid->RowIndex ?>_SWIFT" value="<?php echo HtmlEncode($bank_branch_grid->SWIFT->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bank_branch_grid->IBAN->Visible) { // IBAN ?>
		<td data-name="IBAN" <?php echo $bank_branch_grid->IBAN->cellAttributes() ?>>
<?php if ($bank_branch->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_IBAN" class="form-group">
<input type="text" data-table="bank_branch" data-field="x_IBAN" name="x<?php echo $bank_branch_grid->RowIndex ?>_IBAN" id="x<?php echo $bank_branch_grid->RowIndex ?>_IBAN" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_grid->IBAN->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->IBAN->EditValue ?>"<?php echo $bank_branch_grid->IBAN->editAttributes() ?>>
</span>
<input type="hidden" data-table="bank_branch" data-field="x_IBAN" name="o<?php echo $bank_branch_grid->RowIndex ?>_IBAN" id="o<?php echo $bank_branch_grid->RowIndex ?>_IBAN" value="<?php echo HtmlEncode($bank_branch_grid->IBAN->OldValue) ?>">
<?php } ?>
<?php if ($bank_branch->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_IBAN" class="form-group">
<input type="text" data-table="bank_branch" data-field="x_IBAN" name="x<?php echo $bank_branch_grid->RowIndex ?>_IBAN" id="x<?php echo $bank_branch_grid->RowIndex ?>_IBAN" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_grid->IBAN->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->IBAN->EditValue ?>"<?php echo $bank_branch_grid->IBAN->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bank_branch->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bank_branch_grid->RowCount ?>_bank_branch_IBAN">
<span<?php echo $bank_branch_grid->IBAN->viewAttributes() ?>><?php echo $bank_branch_grid->IBAN->getViewValue() ?></span>
</span>
<?php if (!$bank_branch->isConfirm()) { ?>
<input type="hidden" data-table="bank_branch" data-field="x_IBAN" name="x<?php echo $bank_branch_grid->RowIndex ?>_IBAN" id="x<?php echo $bank_branch_grid->RowIndex ?>_IBAN" value="<?php echo HtmlEncode($bank_branch_grid->IBAN->FormValue) ?>">
<input type="hidden" data-table="bank_branch" data-field="x_IBAN" name="o<?php echo $bank_branch_grid->RowIndex ?>_IBAN" id="o<?php echo $bank_branch_grid->RowIndex ?>_IBAN" value="<?php echo HtmlEncode($bank_branch_grid->IBAN->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bank_branch" data-field="x_IBAN" name="fbank_branchgrid$x<?php echo $bank_branch_grid->RowIndex ?>_IBAN" id="fbank_branchgrid$x<?php echo $bank_branch_grid->RowIndex ?>_IBAN" value="<?php echo HtmlEncode($bank_branch_grid->IBAN->FormValue) ?>">
<input type="hidden" data-table="bank_branch" data-field="x_IBAN" name="fbank_branchgrid$o<?php echo $bank_branch_grid->RowIndex ?>_IBAN" id="fbank_branchgrid$o<?php echo $bank_branch_grid->RowIndex ?>_IBAN" value="<?php echo HtmlEncode($bank_branch_grid->IBAN->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$bank_branch_grid->ListOptions->render("body", "right", $bank_branch_grid->RowCount);
?>
	</tr>
<?php if ($bank_branch->RowType == ROWTYPE_ADD || $bank_branch->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fbank_branchgrid", "load"], function() {
	fbank_branchgrid.updateLists(<?php echo $bank_branch_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$bank_branch_grid->isGridAdd() || $bank_branch->CurrentMode == "copy")
		if (!$bank_branch_grid->Recordset->EOF)
			$bank_branch_grid->Recordset->moveNext();
}
?>
<?php
	if ($bank_branch->CurrentMode == "add" || $bank_branch->CurrentMode == "copy" || $bank_branch->CurrentMode == "edit") {
		$bank_branch_grid->RowIndex = '$rowindex$';
		$bank_branch_grid->loadRowValues();

		// Set row properties
		$bank_branch->resetAttributes();
		$bank_branch->RowAttrs->merge(["data-rowindex" => $bank_branch_grid->RowIndex, "id" => "r0_bank_branch", "data-rowtype" => ROWTYPE_ADD]);
		$bank_branch->RowAttrs->appendClass("ew-template");
		$bank_branch->RowType = ROWTYPE_ADD;

		// Render row
		$bank_branch_grid->renderRow();

		// Render list options
		$bank_branch_grid->renderListOptions();
		$bank_branch_grid->StartRowCount = 0;
?>
	<tr <?php echo $bank_branch->rowAttributes() ?>>
<?php

// Render list options (body, left)
$bank_branch_grid->ListOptions->render("body", "left", $bank_branch_grid->RowIndex);
?>
	<?php if ($bank_branch_grid->BranchCode->Visible) { // BranchCode ?>
		<td data-name="BranchCode">
<?php if (!$bank_branch->isConfirm()) { ?>
<span id="el$rowindex$_bank_branch_BranchCode" class="form-group bank_branch_BranchCode">
<input type="text" data-table="bank_branch" data-field="x_BranchCode" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchCode" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchCode" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($bank_branch_grid->BranchCode->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->BranchCode->EditValue ?>"<?php echo $bank_branch_grid->BranchCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bank_branch_BranchCode" class="form-group bank_branch_BranchCode">
<span<?php echo $bank_branch_grid->BranchCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bank_branch_grid->BranchCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bank_branch" data-field="x_BranchCode" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchCode" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchCode" value="<?php echo HtmlEncode($bank_branch_grid->BranchCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bank_branch" data-field="x_BranchCode" name="o<?php echo $bank_branch_grid->RowIndex ?>_BranchCode" id="o<?php echo $bank_branch_grid->RowIndex ?>_BranchCode" value="<?php echo HtmlEncode($bank_branch_grid->BranchCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bank_branch_grid->BranchName->Visible) { // BranchName ?>
		<td data-name="BranchName">
<?php if (!$bank_branch->isConfirm()) { ?>
<span id="el$rowindex$_bank_branch_BranchName" class="form-group bank_branch_BranchName">
<input type="text" data-table="bank_branch" data-field="x_BranchName" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchName" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchName" size="30" maxlength="70" placeholder="<?php echo HtmlEncode($bank_branch_grid->BranchName->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->BranchName->EditValue ?>"<?php echo $bank_branch_grid->BranchName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bank_branch_BranchName" class="form-group bank_branch_BranchName">
<span<?php echo $bank_branch_grid->BranchName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bank_branch_grid->BranchName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bank_branch" data-field="x_BranchName" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchName" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchName" value="<?php echo HtmlEncode($bank_branch_grid->BranchName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bank_branch" data-field="x_BranchName" name="o<?php echo $bank_branch_grid->RowIndex ?>_BranchName" id="o<?php echo $bank_branch_grid->RowIndex ?>_BranchName" value="<?php echo HtmlEncode($bank_branch_grid->BranchName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bank_branch_grid->BankCode->Visible) { // BankCode ?>
		<td data-name="BankCode">
<?php if (!$bank_branch->isConfirm()) { ?>
<?php if ($bank_branch_grid->BankCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_bank_branch_BankCode" class="form-group bank_branch_BankCode">
<span<?php echo $bank_branch_grid->BankCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bank_branch_grid->BankCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $bank_branch_grid->RowIndex ?>_BankCode" name="x<?php echo $bank_branch_grid->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($bank_branch_grid->BankCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_bank_branch_BankCode" class="form-group bank_branch_BankCode">
<input type="text" data-table="bank_branch" data-field="x_BankCode" name="x<?php echo $bank_branch_grid->RowIndex ?>_BankCode" id="x<?php echo $bank_branch_grid->RowIndex ?>_BankCode" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($bank_branch_grid->BankCode->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->BankCode->EditValue ?>"<?php echo $bank_branch_grid->BankCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_bank_branch_BankCode" class="form-group bank_branch_BankCode">
<span<?php echo $bank_branch_grid->BankCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bank_branch_grid->BankCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bank_branch" data-field="x_BankCode" name="x<?php echo $bank_branch_grid->RowIndex ?>_BankCode" id="x<?php echo $bank_branch_grid->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($bank_branch_grid->BankCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bank_branch" data-field="x_BankCode" name="o<?php echo $bank_branch_grid->RowIndex ?>_BankCode" id="o<?php echo $bank_branch_grid->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($bank_branch_grid->BankCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bank_branch_grid->AreaCode->Visible) { // AreaCode ?>
		<td data-name="AreaCode">
<?php if (!$bank_branch->isConfirm()) { ?>
<span id="el$rowindex$_bank_branch_AreaCode" class="form-group bank_branch_AreaCode">
<input type="text" data-table="bank_branch" data-field="x_AreaCode" name="x<?php echo $bank_branch_grid->RowIndex ?>_AreaCode" id="x<?php echo $bank_branch_grid->RowIndex ?>_AreaCode" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($bank_branch_grid->AreaCode->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->AreaCode->EditValue ?>"<?php echo $bank_branch_grid->AreaCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bank_branch_AreaCode" class="form-group bank_branch_AreaCode">
<span<?php echo $bank_branch_grid->AreaCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bank_branch_grid->AreaCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bank_branch" data-field="x_AreaCode" name="x<?php echo $bank_branch_grid->RowIndex ?>_AreaCode" id="x<?php echo $bank_branch_grid->RowIndex ?>_AreaCode" value="<?php echo HtmlEncode($bank_branch_grid->AreaCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bank_branch" data-field="x_AreaCode" name="o<?php echo $bank_branch_grid->RowIndex ?>_AreaCode" id="o<?php echo $bank_branch_grid->RowIndex ?>_AreaCode" value="<?php echo HtmlEncode($bank_branch_grid->AreaCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bank_branch_grid->BranchNo->Visible) { // BranchNo ?>
		<td data-name="BranchNo">
<?php if (!$bank_branch->isConfirm()) { ?>
<span id="el$rowindex$_bank_branch_BranchNo" class="form-group bank_branch_BranchNo">
<input type="text" data-table="bank_branch" data-field="x_BranchNo" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchNo" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchNo" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($bank_branch_grid->BranchNo->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->BranchNo->EditValue ?>"<?php echo $bank_branch_grid->BranchNo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bank_branch_BranchNo" class="form-group bank_branch_BranchNo">
<span<?php echo $bank_branch_grid->BranchNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bank_branch_grid->BranchNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bank_branch" data-field="x_BranchNo" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchNo" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchNo" value="<?php echo HtmlEncode($bank_branch_grid->BranchNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bank_branch" data-field="x_BranchNo" name="o<?php echo $bank_branch_grid->RowIndex ?>_BranchNo" id="o<?php echo $bank_branch_grid->RowIndex ?>_BranchNo" value="<?php echo HtmlEncode($bank_branch_grid->BranchNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bank_branch_grid->BranchAddress->Visible) { // BranchAddress ?>
		<td data-name="BranchAddress">
<?php if (!$bank_branch->isConfirm()) { ?>
<span id="el$rowindex$_bank_branch_BranchAddress" class="form-group bank_branch_BranchAddress">
<input type="text" data-table="bank_branch" data-field="x_BranchAddress" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchAddress" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($bank_branch_grid->BranchAddress->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->BranchAddress->EditValue ?>"<?php echo $bank_branch_grid->BranchAddress->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bank_branch_BranchAddress" class="form-group bank_branch_BranchAddress">
<span<?php echo $bank_branch_grid->BranchAddress->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bank_branch_grid->BranchAddress->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bank_branch" data-field="x_BranchAddress" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchAddress" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchAddress" value="<?php echo HtmlEncode($bank_branch_grid->BranchAddress->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bank_branch" data-field="x_BranchAddress" name="o<?php echo $bank_branch_grid->RowIndex ?>_BranchAddress" id="o<?php echo $bank_branch_grid->RowIndex ?>_BranchAddress" value="<?php echo HtmlEncode($bank_branch_grid->BranchAddress->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bank_branch_grid->BranchTel->Visible) { // BranchTel ?>
		<td data-name="BranchTel">
<?php if (!$bank_branch->isConfirm()) { ?>
<span id="el$rowindex$_bank_branch_BranchTel" class="form-group bank_branch_BranchTel">
<input type="text" data-table="bank_branch" data-field="x_BranchTel" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchTel" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchTel" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_grid->BranchTel->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->BranchTel->EditValue ?>"<?php echo $bank_branch_grid->BranchTel->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bank_branch_BranchTel" class="form-group bank_branch_BranchTel">
<span<?php echo $bank_branch_grid->BranchTel->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bank_branch_grid->BranchTel->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bank_branch" data-field="x_BranchTel" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchTel" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchTel" value="<?php echo HtmlEncode($bank_branch_grid->BranchTel->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bank_branch" data-field="x_BranchTel" name="o<?php echo $bank_branch_grid->RowIndex ?>_BranchTel" id="o<?php echo $bank_branch_grid->RowIndex ?>_BranchTel" value="<?php echo HtmlEncode($bank_branch_grid->BranchTel->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bank_branch_grid->BranchEmail->Visible) { // BranchEmail ?>
		<td data-name="BranchEmail">
<?php if (!$bank_branch->isConfirm()) { ?>
<span id="el$rowindex$_bank_branch_BranchEmail" class="form-group bank_branch_BranchEmail">
<input type="text" data-table="bank_branch" data-field="x_BranchEmail" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchEmail" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchEmail" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_grid->BranchEmail->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->BranchEmail->EditValue ?>"<?php echo $bank_branch_grid->BranchEmail->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bank_branch_BranchEmail" class="form-group bank_branch_BranchEmail">
<span<?php echo $bank_branch_grid->BranchEmail->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bank_branch_grid->BranchEmail->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bank_branch" data-field="x_BranchEmail" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchEmail" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchEmail" value="<?php echo HtmlEncode($bank_branch_grid->BranchEmail->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bank_branch" data-field="x_BranchEmail" name="o<?php echo $bank_branch_grid->RowIndex ?>_BranchEmail" id="o<?php echo $bank_branch_grid->RowIndex ?>_BranchEmail" value="<?php echo HtmlEncode($bank_branch_grid->BranchEmail->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bank_branch_grid->BranchFax->Visible) { // BranchFax ?>
		<td data-name="BranchFax">
<?php if (!$bank_branch->isConfirm()) { ?>
<span id="el$rowindex$_bank_branch_BranchFax" class="form-group bank_branch_BranchFax">
<input type="text" data-table="bank_branch" data-field="x_BranchFax" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchFax" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchFax" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_grid->BranchFax->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->BranchFax->EditValue ?>"<?php echo $bank_branch_grid->BranchFax->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bank_branch_BranchFax" class="form-group bank_branch_BranchFax">
<span<?php echo $bank_branch_grid->BranchFax->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bank_branch_grid->BranchFax->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bank_branch" data-field="x_BranchFax" name="x<?php echo $bank_branch_grid->RowIndex ?>_BranchFax" id="x<?php echo $bank_branch_grid->RowIndex ?>_BranchFax" value="<?php echo HtmlEncode($bank_branch_grid->BranchFax->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bank_branch" data-field="x_BranchFax" name="o<?php echo $bank_branch_grid->RowIndex ?>_BranchFax" id="o<?php echo $bank_branch_grid->RowIndex ?>_BranchFax" value="<?php echo HtmlEncode($bank_branch_grid->BranchFax->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bank_branch_grid->SWIFT->Visible) { // SWIFT ?>
		<td data-name="SWIFT">
<?php if (!$bank_branch->isConfirm()) { ?>
<span id="el$rowindex$_bank_branch_SWIFT" class="form-group bank_branch_SWIFT">
<input type="text" data-table="bank_branch" data-field="x_SWIFT" name="x<?php echo $bank_branch_grid->RowIndex ?>_SWIFT" id="x<?php echo $bank_branch_grid->RowIndex ?>_SWIFT" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_grid->SWIFT->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->SWIFT->EditValue ?>"<?php echo $bank_branch_grid->SWIFT->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bank_branch_SWIFT" class="form-group bank_branch_SWIFT">
<span<?php echo $bank_branch_grid->SWIFT->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bank_branch_grid->SWIFT->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bank_branch" data-field="x_SWIFT" name="x<?php echo $bank_branch_grid->RowIndex ?>_SWIFT" id="x<?php echo $bank_branch_grid->RowIndex ?>_SWIFT" value="<?php echo HtmlEncode($bank_branch_grid->SWIFT->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bank_branch" data-field="x_SWIFT" name="o<?php echo $bank_branch_grid->RowIndex ?>_SWIFT" id="o<?php echo $bank_branch_grid->RowIndex ?>_SWIFT" value="<?php echo HtmlEncode($bank_branch_grid->SWIFT->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bank_branch_grid->IBAN->Visible) { // IBAN ?>
		<td data-name="IBAN">
<?php if (!$bank_branch->isConfirm()) { ?>
<span id="el$rowindex$_bank_branch_IBAN" class="form-group bank_branch_IBAN">
<input type="text" data-table="bank_branch" data-field="x_IBAN" name="x<?php echo $bank_branch_grid->RowIndex ?>_IBAN" id="x<?php echo $bank_branch_grid->RowIndex ?>_IBAN" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_grid->IBAN->getPlaceHolder()) ?>" value="<?php echo $bank_branch_grid->IBAN->EditValue ?>"<?php echo $bank_branch_grid->IBAN->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bank_branch_IBAN" class="form-group bank_branch_IBAN">
<span<?php echo $bank_branch_grid->IBAN->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bank_branch_grid->IBAN->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bank_branch" data-field="x_IBAN" name="x<?php echo $bank_branch_grid->RowIndex ?>_IBAN" id="x<?php echo $bank_branch_grid->RowIndex ?>_IBAN" value="<?php echo HtmlEncode($bank_branch_grid->IBAN->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bank_branch" data-field="x_IBAN" name="o<?php echo $bank_branch_grid->RowIndex ?>_IBAN" id="o<?php echo $bank_branch_grid->RowIndex ?>_IBAN" value="<?php echo HtmlEncode($bank_branch_grid->IBAN->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$bank_branch_grid->ListOptions->render("body", "right", $bank_branch_grid->RowIndex);
?>
<script>
loadjs.ready(["fbank_branchgrid", "load"], function() {
	fbank_branchgrid.updateLists(<?php echo $bank_branch_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($bank_branch->CurrentMode == "add" || $bank_branch->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $bank_branch_grid->FormKeyCountName ?>" id="<?php echo $bank_branch_grid->FormKeyCountName ?>" value="<?php echo $bank_branch_grid->KeyCount ?>">
<?php echo $bank_branch_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($bank_branch->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $bank_branch_grid->FormKeyCountName ?>" id="<?php echo $bank_branch_grid->FormKeyCountName ?>" value="<?php echo $bank_branch_grid->KeyCount ?>">
<?php echo $bank_branch_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($bank_branch->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fbank_branchgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($bank_branch_grid->Recordset)
	$bank_branch_grid->Recordset->Close();
?>
<?php if ($bank_branch_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $bank_branch_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($bank_branch_grid->TotalRecords == 0 && !$bank_branch->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $bank_branch_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$bank_branch_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$bank_branch_grid->terminate();
?>