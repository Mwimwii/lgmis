<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($staffdisciplinary_case_grid))
	$staffdisciplinary_case_grid = new staffdisciplinary_case_grid();

// Run the page
$staffdisciplinary_case_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffdisciplinary_case_grid->Page_Render();
?>
<?php if (!$staffdisciplinary_case_grid->isExport()) { ?>
<script>
var fstaffdisciplinary_casegrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fstaffdisciplinary_casegrid = new ew.Form("fstaffdisciplinary_casegrid", "grid");
	fstaffdisciplinary_casegrid.formKeyCountName = '<?php echo $staffdisciplinary_case_grid->FormKeyCountName ?>';

	// Validate form
	fstaffdisciplinary_casegrid.validate = function() {
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
			<?php if ($staffdisciplinary_case_grid->CaseNo->Required) { ?>
				elm = this.getElements("x" + infix + "_CaseNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_grid->CaseNo->caption(), $staffdisciplinary_case_grid->CaseNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_case_grid->OffenseCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OffenseCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_grid->OffenseCode->caption(), $staffdisciplinary_case_grid->OffenseCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_case_grid->ActionTaken->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionTaken");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_grid->ActionTaken->caption(), $staffdisciplinary_case_grid->ActionTaken->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_case_grid->OffenseDate->Required) { ?>
				elm = this.getElements("x" + infix + "_OffenseDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_grid->OffenseDate->caption(), $staffdisciplinary_case_grid->OffenseDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OffenseDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_case_grid->OffenseDate->errorMessage()) ?>");
			<?php if ($staffdisciplinary_case_grid->ActionDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_grid->ActionDate->caption(), $staffdisciplinary_case_grid->ActionDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActionDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_case_grid->ActionDate->errorMessage()) ?>");
			<?php if ($staffdisciplinary_case_grid->DateOfAppealLetter->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfAppealLetter");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_grid->DateOfAppealLetter->caption(), $staffdisciplinary_case_grid->DateOfAppealLetter->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfAppealLetter");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_case_grid->DateOfAppealLetter->errorMessage()) ?>");
			<?php if ($staffdisciplinary_case_grid->DateAppealReceived->Required) { ?>
				elm = this.getElements("x" + infix + "_DateAppealReceived");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_grid->DateAppealReceived->caption(), $staffdisciplinary_case_grid->DateAppealReceived->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateAppealReceived");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_case_grid->DateAppealReceived->errorMessage()) ?>");
			<?php if ($staffdisciplinary_case_grid->DateConcluded->Required) { ?>
				elm = this.getElements("x" + infix + "_DateConcluded");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_grid->DateConcluded->caption(), $staffdisciplinary_case_grid->DateConcluded->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateConcluded");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_case_grid->DateConcluded->errorMessage()) ?>");
			<?php if ($staffdisciplinary_case_grid->AppealStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_AppealStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_grid->AppealStatus->caption(), $staffdisciplinary_case_grid->AppealStatus->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fstaffdisciplinary_casegrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "OffenseCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActionTaken", false)) return false;
		if (ew.valueChanged(fobj, infix, "OffenseDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActionDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateOfAppealLetter", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateAppealReceived", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateConcluded", false)) return false;
		if (ew.valueChanged(fobj, infix, "AppealStatus", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fstaffdisciplinary_casegrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffdisciplinary_casegrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffdisciplinary_casegrid.lists["x_OffenseCode"] = <?php echo $staffdisciplinary_case_grid->OffenseCode->Lookup->toClientList($staffdisciplinary_case_grid) ?>;
	fstaffdisciplinary_casegrid.lists["x_OffenseCode"].options = <?php echo JsonEncode($staffdisciplinary_case_grid->OffenseCode->lookupOptions()) ?>;
	fstaffdisciplinary_casegrid.lists["x_ActionTaken"] = <?php echo $staffdisciplinary_case_grid->ActionTaken->Lookup->toClientList($staffdisciplinary_case_grid) ?>;
	fstaffdisciplinary_casegrid.lists["x_ActionTaken"].options = <?php echo JsonEncode($staffdisciplinary_case_grid->ActionTaken->lookupOptions()) ?>;
	fstaffdisciplinary_casegrid.lists["x_AppealStatus"] = <?php echo $staffdisciplinary_case_grid->AppealStatus->Lookup->toClientList($staffdisciplinary_case_grid) ?>;
	fstaffdisciplinary_casegrid.lists["x_AppealStatus"].options = <?php echo JsonEncode($staffdisciplinary_case_grid->AppealStatus->lookupOptions()) ?>;
	loadjs.done("fstaffdisciplinary_casegrid");
});
</script>
<?php } ?>
<?php
$staffdisciplinary_case_grid->renderOtherOptions();
?>
<?php if ($staffdisciplinary_case_grid->TotalRecords > 0 || $staffdisciplinary_case->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($staffdisciplinary_case_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> staffdisciplinary_case">
<?php if ($staffdisciplinary_case_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $staffdisciplinary_case_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fstaffdisciplinary_casegrid" class="ew-form ew-list-form form-inline">
<div id="gmp_staffdisciplinary_case" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_staffdisciplinary_casegrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$staffdisciplinary_case->RowType = ROWTYPE_HEADER;

// Render list options
$staffdisciplinary_case_grid->renderListOptions();

// Render list options (header, left)
$staffdisciplinary_case_grid->ListOptions->render("header", "left");
?>
<?php if ($staffdisciplinary_case_grid->CaseNo->Visible) { // CaseNo ?>
	<?php if ($staffdisciplinary_case_grid->SortUrl($staffdisciplinary_case_grid->CaseNo) == "") { ?>
		<th data-name="CaseNo" class="<?php echo $staffdisciplinary_case_grid->CaseNo->headerCellClass() ?>"><div id="elh_staffdisciplinary_case_CaseNo" class="staffdisciplinary_case_CaseNo"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_case_grid->CaseNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CaseNo" class="<?php echo $staffdisciplinary_case_grid->CaseNo->headerCellClass() ?>"><div><div id="elh_staffdisciplinary_case_CaseNo" class="staffdisciplinary_case_CaseNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_grid->CaseNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_grid->CaseNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_grid->CaseNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_case_grid->OffenseCode->Visible) { // OffenseCode ?>
	<?php if ($staffdisciplinary_case_grid->SortUrl($staffdisciplinary_case_grid->OffenseCode) == "") { ?>
		<th data-name="OffenseCode" class="<?php echo $staffdisciplinary_case_grid->OffenseCode->headerCellClass() ?>"><div id="elh_staffdisciplinary_case_OffenseCode" class="staffdisciplinary_case_OffenseCode"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_case_grid->OffenseCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OffenseCode" class="<?php echo $staffdisciplinary_case_grid->OffenseCode->headerCellClass() ?>"><div><div id="elh_staffdisciplinary_case_OffenseCode" class="staffdisciplinary_case_OffenseCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_grid->OffenseCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_grid->OffenseCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_grid->OffenseCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_case_grid->ActionTaken->Visible) { // ActionTaken ?>
	<?php if ($staffdisciplinary_case_grid->SortUrl($staffdisciplinary_case_grid->ActionTaken) == "") { ?>
		<th data-name="ActionTaken" class="<?php echo $staffdisciplinary_case_grid->ActionTaken->headerCellClass() ?>"><div id="elh_staffdisciplinary_case_ActionTaken" class="staffdisciplinary_case_ActionTaken"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_case_grid->ActionTaken->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionTaken" class="<?php echo $staffdisciplinary_case_grid->ActionTaken->headerCellClass() ?>"><div><div id="elh_staffdisciplinary_case_ActionTaken" class="staffdisciplinary_case_ActionTaken">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_grid->ActionTaken->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_grid->ActionTaken->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_grid->ActionTaken->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_case_grid->OffenseDate->Visible) { // OffenseDate ?>
	<?php if ($staffdisciplinary_case_grid->SortUrl($staffdisciplinary_case_grid->OffenseDate) == "") { ?>
		<th data-name="OffenseDate" class="<?php echo $staffdisciplinary_case_grid->OffenseDate->headerCellClass() ?>"><div id="elh_staffdisciplinary_case_OffenseDate" class="staffdisciplinary_case_OffenseDate"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_case_grid->OffenseDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OffenseDate" class="<?php echo $staffdisciplinary_case_grid->OffenseDate->headerCellClass() ?>"><div><div id="elh_staffdisciplinary_case_OffenseDate" class="staffdisciplinary_case_OffenseDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_grid->OffenseDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_grid->OffenseDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_grid->OffenseDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_case_grid->ActionDate->Visible) { // ActionDate ?>
	<?php if ($staffdisciplinary_case_grid->SortUrl($staffdisciplinary_case_grid->ActionDate) == "") { ?>
		<th data-name="ActionDate" class="<?php echo $staffdisciplinary_case_grid->ActionDate->headerCellClass() ?>"><div id="elh_staffdisciplinary_case_ActionDate" class="staffdisciplinary_case_ActionDate"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_case_grid->ActionDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionDate" class="<?php echo $staffdisciplinary_case_grid->ActionDate->headerCellClass() ?>"><div><div id="elh_staffdisciplinary_case_ActionDate" class="staffdisciplinary_case_ActionDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_grid->ActionDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_grid->ActionDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_grid->ActionDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_case_grid->DateOfAppealLetter->Visible) { // DateOfAppealLetter ?>
	<?php if ($staffdisciplinary_case_grid->SortUrl($staffdisciplinary_case_grid->DateOfAppealLetter) == "") { ?>
		<th data-name="DateOfAppealLetter" class="<?php echo $staffdisciplinary_case_grid->DateOfAppealLetter->headerCellClass() ?>"><div id="elh_staffdisciplinary_case_DateOfAppealLetter" class="staffdisciplinary_case_DateOfAppealLetter"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_case_grid->DateOfAppealLetter->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfAppealLetter" class="<?php echo $staffdisciplinary_case_grid->DateOfAppealLetter->headerCellClass() ?>"><div><div id="elh_staffdisciplinary_case_DateOfAppealLetter" class="staffdisciplinary_case_DateOfAppealLetter">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_grid->DateOfAppealLetter->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_grid->DateOfAppealLetter->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_grid->DateOfAppealLetter->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_case_grid->DateAppealReceived->Visible) { // DateAppealReceived ?>
	<?php if ($staffdisciplinary_case_grid->SortUrl($staffdisciplinary_case_grid->DateAppealReceived) == "") { ?>
		<th data-name="DateAppealReceived" class="<?php echo $staffdisciplinary_case_grid->DateAppealReceived->headerCellClass() ?>"><div id="elh_staffdisciplinary_case_DateAppealReceived" class="staffdisciplinary_case_DateAppealReceived"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_case_grid->DateAppealReceived->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateAppealReceived" class="<?php echo $staffdisciplinary_case_grid->DateAppealReceived->headerCellClass() ?>"><div><div id="elh_staffdisciplinary_case_DateAppealReceived" class="staffdisciplinary_case_DateAppealReceived">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_grid->DateAppealReceived->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_grid->DateAppealReceived->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_grid->DateAppealReceived->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_case_grid->DateConcluded->Visible) { // DateConcluded ?>
	<?php if ($staffdisciplinary_case_grid->SortUrl($staffdisciplinary_case_grid->DateConcluded) == "") { ?>
		<th data-name="DateConcluded" class="<?php echo $staffdisciplinary_case_grid->DateConcluded->headerCellClass() ?>"><div id="elh_staffdisciplinary_case_DateConcluded" class="staffdisciplinary_case_DateConcluded"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_case_grid->DateConcluded->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateConcluded" class="<?php echo $staffdisciplinary_case_grid->DateConcluded->headerCellClass() ?>"><div><div id="elh_staffdisciplinary_case_DateConcluded" class="staffdisciplinary_case_DateConcluded">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_grid->DateConcluded->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_grid->DateConcluded->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_grid->DateConcluded->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_case_grid->AppealStatus->Visible) { // AppealStatus ?>
	<?php if ($staffdisciplinary_case_grid->SortUrl($staffdisciplinary_case_grid->AppealStatus) == "") { ?>
		<th data-name="AppealStatus" class="<?php echo $staffdisciplinary_case_grid->AppealStatus->headerCellClass() ?>"><div id="elh_staffdisciplinary_case_AppealStatus" class="staffdisciplinary_case_AppealStatus"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_case_grid->AppealStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AppealStatus" class="<?php echo $staffdisciplinary_case_grid->AppealStatus->headerCellClass() ?>"><div><div id="elh_staffdisciplinary_case_AppealStatus" class="staffdisciplinary_case_AppealStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_grid->AppealStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_grid->AppealStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_grid->AppealStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$staffdisciplinary_case_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$staffdisciplinary_case_grid->StartRecord = 1;
$staffdisciplinary_case_grid->StopRecord = $staffdisciplinary_case_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($staffdisciplinary_case->isConfirm() || $staffdisciplinary_case_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($staffdisciplinary_case_grid->FormKeyCountName) && ($staffdisciplinary_case_grid->isGridAdd() || $staffdisciplinary_case_grid->isGridEdit() || $staffdisciplinary_case->isConfirm())) {
		$staffdisciplinary_case_grid->KeyCount = $CurrentForm->getValue($staffdisciplinary_case_grid->FormKeyCountName);
		$staffdisciplinary_case_grid->StopRecord = $staffdisciplinary_case_grid->StartRecord + $staffdisciplinary_case_grid->KeyCount - 1;
	}
}
$staffdisciplinary_case_grid->RecordCount = $staffdisciplinary_case_grid->StartRecord - 1;
if ($staffdisciplinary_case_grid->Recordset && !$staffdisciplinary_case_grid->Recordset->EOF) {
	$staffdisciplinary_case_grid->Recordset->moveFirst();
	$selectLimit = $staffdisciplinary_case_grid->UseSelectLimit;
	if (!$selectLimit && $staffdisciplinary_case_grid->StartRecord > 1)
		$staffdisciplinary_case_grid->Recordset->move($staffdisciplinary_case_grid->StartRecord - 1);
} elseif (!$staffdisciplinary_case->AllowAddDeleteRow && $staffdisciplinary_case_grid->StopRecord == 0) {
	$staffdisciplinary_case_grid->StopRecord = $staffdisciplinary_case->GridAddRowCount;
}

// Initialize aggregate
$staffdisciplinary_case->RowType = ROWTYPE_AGGREGATEINIT;
$staffdisciplinary_case->resetAttributes();
$staffdisciplinary_case_grid->renderRow();
if ($staffdisciplinary_case_grid->isGridAdd())
	$staffdisciplinary_case_grid->RowIndex = 0;
if ($staffdisciplinary_case_grid->isGridEdit())
	$staffdisciplinary_case_grid->RowIndex = 0;
while ($staffdisciplinary_case_grid->RecordCount < $staffdisciplinary_case_grid->StopRecord) {
	$staffdisciplinary_case_grid->RecordCount++;
	if ($staffdisciplinary_case_grid->RecordCount >= $staffdisciplinary_case_grid->StartRecord) {
		$staffdisciplinary_case_grid->RowCount++;
		if ($staffdisciplinary_case_grid->isGridAdd() || $staffdisciplinary_case_grid->isGridEdit() || $staffdisciplinary_case->isConfirm()) {
			$staffdisciplinary_case_grid->RowIndex++;
			$CurrentForm->Index = $staffdisciplinary_case_grid->RowIndex;
			if ($CurrentForm->hasValue($staffdisciplinary_case_grid->FormActionName) && ($staffdisciplinary_case->isConfirm() || $staffdisciplinary_case_grid->EventCancelled))
				$staffdisciplinary_case_grid->RowAction = strval($CurrentForm->getValue($staffdisciplinary_case_grid->FormActionName));
			elseif ($staffdisciplinary_case_grid->isGridAdd())
				$staffdisciplinary_case_grid->RowAction = "insert";
			else
				$staffdisciplinary_case_grid->RowAction = "";
		}

		// Set up key count
		$staffdisciplinary_case_grid->KeyCount = $staffdisciplinary_case_grid->RowIndex;

		// Init row class and style
		$staffdisciplinary_case->resetAttributes();
		$staffdisciplinary_case->CssClass = "";
		if ($staffdisciplinary_case_grid->isGridAdd()) {
			if ($staffdisciplinary_case->CurrentMode == "copy") {
				$staffdisciplinary_case_grid->loadRowValues($staffdisciplinary_case_grid->Recordset); // Load row values
				$staffdisciplinary_case_grid->setRecordKey($staffdisciplinary_case_grid->RowOldKey, $staffdisciplinary_case_grid->Recordset); // Set old record key
			} else {
				$staffdisciplinary_case_grid->loadRowValues(); // Load default values
				$staffdisciplinary_case_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$staffdisciplinary_case_grid->loadRowValues($staffdisciplinary_case_grid->Recordset); // Load row values
		}
		$staffdisciplinary_case->RowType = ROWTYPE_VIEW; // Render view
		if ($staffdisciplinary_case_grid->isGridAdd()) // Grid add
			$staffdisciplinary_case->RowType = ROWTYPE_ADD; // Render add
		if ($staffdisciplinary_case_grid->isGridAdd() && $staffdisciplinary_case->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$staffdisciplinary_case_grid->restoreCurrentRowFormValues($staffdisciplinary_case_grid->RowIndex); // Restore form values
		if ($staffdisciplinary_case_grid->isGridEdit()) { // Grid edit
			if ($staffdisciplinary_case->EventCancelled)
				$staffdisciplinary_case_grid->restoreCurrentRowFormValues($staffdisciplinary_case_grid->RowIndex); // Restore form values
			if ($staffdisciplinary_case_grid->RowAction == "insert")
				$staffdisciplinary_case->RowType = ROWTYPE_ADD; // Render add
			else
				$staffdisciplinary_case->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($staffdisciplinary_case_grid->isGridEdit() && ($staffdisciplinary_case->RowType == ROWTYPE_EDIT || $staffdisciplinary_case->RowType == ROWTYPE_ADD) && $staffdisciplinary_case->EventCancelled) // Update failed
			$staffdisciplinary_case_grid->restoreCurrentRowFormValues($staffdisciplinary_case_grid->RowIndex); // Restore form values
		if ($staffdisciplinary_case->RowType == ROWTYPE_EDIT) // Edit row
			$staffdisciplinary_case_grid->EditRowCount++;
		if ($staffdisciplinary_case->isConfirm()) // Confirm row
			$staffdisciplinary_case_grid->restoreCurrentRowFormValues($staffdisciplinary_case_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$staffdisciplinary_case->RowAttrs->merge(["data-rowindex" => $staffdisciplinary_case_grid->RowCount, "id" => "r" . $staffdisciplinary_case_grid->RowCount . "_staffdisciplinary_case", "data-rowtype" => $staffdisciplinary_case->RowType]);

		// Render row
		$staffdisciplinary_case_grid->renderRow();

		// Render list options
		$staffdisciplinary_case_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($staffdisciplinary_case_grid->RowAction != "delete" && $staffdisciplinary_case_grid->RowAction != "insertdelete" && !($staffdisciplinary_case_grid->RowAction == "insert" && $staffdisciplinary_case->isConfirm() && $staffdisciplinary_case_grid->emptyRow())) {
?>
	<tr <?php echo $staffdisciplinary_case->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffdisciplinary_case_grid->ListOptions->render("body", "left", $staffdisciplinary_case_grid->RowCount);
?>
	<?php if ($staffdisciplinary_case_grid->CaseNo->Visible) { // CaseNo ?>
		<td data-name="CaseNo" <?php echo $staffdisciplinary_case_grid->CaseNo->cellAttributes() ?>>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_CaseNo" class="form-group"></span>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_CaseNo" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_CaseNo" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->CaseNo->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_CaseNo" class="form-group">
<span<?php echo $staffdisciplinary_case_grid->CaseNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_case_grid->CaseNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_CaseNo" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_CaseNo" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->CaseNo->CurrentValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_CaseNo">
<span<?php echo $staffdisciplinary_case_grid->CaseNo->viewAttributes() ?>><?php echo $staffdisciplinary_case_grid->CaseNo->getViewValue() ?></span>
</span>
<?php if (!$staffdisciplinary_case->isConfirm()) { ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_CaseNo" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_CaseNo" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->CaseNo->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_CaseNo" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_CaseNo" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->CaseNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_CaseNo" name="fstaffdisciplinary_casegrid$x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_CaseNo" id="fstaffdisciplinary_casegrid$x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->CaseNo->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_CaseNo" name="fstaffdisciplinary_casegrid$o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_CaseNo" id="fstaffdisciplinary_casegrid$o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->CaseNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_EmployeeID" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_EmployeeID" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->EmployeeID->CurrentValue) ?>">
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_EmployeeID" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_EmployeeID" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_EDIT || $staffdisciplinary_case->CurrentMode == "edit") { ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_EmployeeID" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_EmployeeID" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->EmployeeID->CurrentValue) ?>">
<?php } ?>
	<?php if ($staffdisciplinary_case_grid->OffenseCode->Visible) { // OffenseCode ?>
		<td data-name="OffenseCode" <?php echo $staffdisciplinary_case_grid->OffenseCode->cellAttributes() ?>>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_OffenseCode" class="form-group">
<?php $staffdisciplinary_case_grid->OffenseCode->EditAttrs->prepend("onclick", "ew.autoFill(this);"); ?>
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($staffdisciplinary_case_grid->OffenseCode->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $staffdisciplinary_case_grid->OffenseCode->ViewValue ?></button>
		<div id="dsl_x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" data-repeatcolumn="5" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $staffdisciplinary_case_grid->OffenseCode->radioButtonListHtml(TRUE, "x{$staffdisciplinary_case_grid->RowIndex}_OffenseCode") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" class="ew-template"><input type="radio" class="custom-control-input" data-table="staffdisciplinary_case" data-field="x_OffenseCode" data-value-separator="<?php echo $staffdisciplinary_case_grid->OffenseCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" value="{value}"<?php echo $staffdisciplinary_case_grid->OffenseCode->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$staffdisciplinary_case_grid->OffenseCode->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $staffdisciplinary_case_grid->OffenseCode->Lookup->getParamTag($staffdisciplinary_case_grid, "p_x" . $staffdisciplinary_case_grid->RowIndex . "_OffenseCode") ?>
</span>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_OffenseCode" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->OffenseCode->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php $staffdisciplinary_case_grid->OffenseCode->EditAttrs->prepend("onclick", "ew.autoFill(this);"); ?>
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($staffdisciplinary_case_grid->OffenseCode->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $staffdisciplinary_case_grid->OffenseCode->ViewValue ?></button>
		<div id="dsl_x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" data-repeatcolumn="5" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $staffdisciplinary_case_grid->OffenseCode->radioButtonListHtml(TRUE, "x{$staffdisciplinary_case_grid->RowIndex}_OffenseCode") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" class="ew-template"><input type="radio" class="custom-control-input" data-table="staffdisciplinary_case" data-field="x_OffenseCode" data-value-separator="<?php echo $staffdisciplinary_case_grid->OffenseCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" value="{value}"<?php echo $staffdisciplinary_case_grid->OffenseCode->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$staffdisciplinary_case_grid->OffenseCode->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $staffdisciplinary_case_grid->OffenseCode->Lookup->getParamTag($staffdisciplinary_case_grid, "p_x" . $staffdisciplinary_case_grid->RowIndex . "_OffenseCode") ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_OffenseCode" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->OffenseCode->OldValue != null ? $staffdisciplinary_case_grid->OffenseCode->OldValue : $staffdisciplinary_case_grid->OffenseCode->CurrentValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_OffenseCode">
<span<?php echo $staffdisciplinary_case_grid->OffenseCode->viewAttributes() ?>><?php echo $staffdisciplinary_case_grid->OffenseCode->getViewValue() ?></span>
</span>
<?php if (!$staffdisciplinary_case->isConfirm()) { ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_OffenseCode" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->OffenseCode->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_OffenseCode" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->OffenseCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_OffenseCode" name="fstaffdisciplinary_casegrid$x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" id="fstaffdisciplinary_casegrid$x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->OffenseCode->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_OffenseCode" name="fstaffdisciplinary_casegrid$o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" id="fstaffdisciplinary_casegrid$o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->OffenseCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_case_grid->ActionTaken->Visible) { // ActionTaken ?>
		<td data-name="ActionTaken" <?php echo $staffdisciplinary_case_grid->ActionTaken->cellAttributes() ?>>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_ActionTaken" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffdisciplinary_case" data-field="x_ActionTaken" data-value-separator="<?php echo $staffdisciplinary_case_grid->ActionTaken->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionTaken" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionTaken"<?php echo $staffdisciplinary_case_grid->ActionTaken->editAttributes() ?>>
			<?php echo $staffdisciplinary_case_grid->ActionTaken->selectOptionListHtml("x{$staffdisciplinary_case_grid->RowIndex}_ActionTaken") ?>
		</select>
</div>
<?php echo $staffdisciplinary_case_grid->ActionTaken->Lookup->getParamTag($staffdisciplinary_case_grid, "p_x" . $staffdisciplinary_case_grid->RowIndex . "_ActionTaken") ?>
</span>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_ActionTaken" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionTaken" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionTaken" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->ActionTaken->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_ActionTaken" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffdisciplinary_case" data-field="x_ActionTaken" data-value-separator="<?php echo $staffdisciplinary_case_grid->ActionTaken->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionTaken" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionTaken"<?php echo $staffdisciplinary_case_grid->ActionTaken->editAttributes() ?>>
			<?php echo $staffdisciplinary_case_grid->ActionTaken->selectOptionListHtml("x{$staffdisciplinary_case_grid->RowIndex}_ActionTaken") ?>
		</select>
</div>
<?php echo $staffdisciplinary_case_grid->ActionTaken->Lookup->getParamTag($staffdisciplinary_case_grid, "p_x" . $staffdisciplinary_case_grid->RowIndex . "_ActionTaken") ?>
</span>
<?php } ?>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_ActionTaken">
<span<?php echo $staffdisciplinary_case_grid->ActionTaken->viewAttributes() ?>><?php echo $staffdisciplinary_case_grid->ActionTaken->getViewValue() ?></span>
</span>
<?php if (!$staffdisciplinary_case->isConfirm()) { ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_ActionTaken" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionTaken" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionTaken" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->ActionTaken->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_ActionTaken" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionTaken" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionTaken" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->ActionTaken->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_ActionTaken" name="fstaffdisciplinary_casegrid$x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionTaken" id="fstaffdisciplinary_casegrid$x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionTaken" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->ActionTaken->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_ActionTaken" name="fstaffdisciplinary_casegrid$o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionTaken" id="fstaffdisciplinary_casegrid$o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionTaken" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->ActionTaken->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_case_grid->OffenseDate->Visible) { // OffenseDate ?>
		<td data-name="OffenseDate" <?php echo $staffdisciplinary_case_grid->OffenseDate->cellAttributes() ?>>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_OffenseDate" class="form-group">
<input type="text" data-table="staffdisciplinary_case" data-field="x_OffenseDate" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseDate" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_grid->OffenseDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_grid->OffenseDate->EditValue ?>"<?php echo $staffdisciplinary_case_grid->OffenseDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_grid->OffenseDate->ReadOnly && !$staffdisciplinary_case_grid->OffenseDate->Disabled && !isset($staffdisciplinary_case_grid->OffenseDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_grid->OffenseDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_casegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_casegrid", "x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_OffenseDate" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseDate" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseDate" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->OffenseDate->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_OffenseDate" class="form-group">
<input type="text" data-table="staffdisciplinary_case" data-field="x_OffenseDate" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseDate" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_grid->OffenseDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_grid->OffenseDate->EditValue ?>"<?php echo $staffdisciplinary_case_grid->OffenseDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_grid->OffenseDate->ReadOnly && !$staffdisciplinary_case_grid->OffenseDate->Disabled && !isset($staffdisciplinary_case_grid->OffenseDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_grid->OffenseDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_casegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_casegrid", "x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_OffenseDate">
<span<?php echo $staffdisciplinary_case_grid->OffenseDate->viewAttributes() ?>><?php echo $staffdisciplinary_case_grid->OffenseDate->getViewValue() ?></span>
</span>
<?php if (!$staffdisciplinary_case->isConfirm()) { ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_OffenseDate" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseDate" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseDate" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->OffenseDate->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_OffenseDate" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseDate" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseDate" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->OffenseDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_OffenseDate" name="fstaffdisciplinary_casegrid$x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseDate" id="fstaffdisciplinary_casegrid$x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseDate" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->OffenseDate->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_OffenseDate" name="fstaffdisciplinary_casegrid$o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseDate" id="fstaffdisciplinary_casegrid$o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseDate" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->OffenseDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_case_grid->ActionDate->Visible) { // ActionDate ?>
		<td data-name="ActionDate" <?php echo $staffdisciplinary_case_grid->ActionDate->cellAttributes() ?>>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_ActionDate" class="form-group">
<input type="text" data-table="staffdisciplinary_case" data-field="x_ActionDate" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionDate" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_grid->ActionDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_grid->ActionDate->EditValue ?>"<?php echo $staffdisciplinary_case_grid->ActionDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_grid->ActionDate->ReadOnly && !$staffdisciplinary_case_grid->ActionDate->Disabled && !isset($staffdisciplinary_case_grid->ActionDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_grid->ActionDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_casegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_casegrid", "x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_ActionDate" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionDate" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionDate" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->ActionDate->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_ActionDate" class="form-group">
<input type="text" data-table="staffdisciplinary_case" data-field="x_ActionDate" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionDate" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_grid->ActionDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_grid->ActionDate->EditValue ?>"<?php echo $staffdisciplinary_case_grid->ActionDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_grid->ActionDate->ReadOnly && !$staffdisciplinary_case_grid->ActionDate->Disabled && !isset($staffdisciplinary_case_grid->ActionDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_grid->ActionDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_casegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_casegrid", "x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_ActionDate">
<span<?php echo $staffdisciplinary_case_grid->ActionDate->viewAttributes() ?>><?php echo $staffdisciplinary_case_grid->ActionDate->getViewValue() ?></span>
</span>
<?php if (!$staffdisciplinary_case->isConfirm()) { ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_ActionDate" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionDate" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionDate" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->ActionDate->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_ActionDate" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionDate" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionDate" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->ActionDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_ActionDate" name="fstaffdisciplinary_casegrid$x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionDate" id="fstaffdisciplinary_casegrid$x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionDate" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->ActionDate->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_ActionDate" name="fstaffdisciplinary_casegrid$o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionDate" id="fstaffdisciplinary_casegrid$o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionDate" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->ActionDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_case_grid->DateOfAppealLetter->Visible) { // DateOfAppealLetter ?>
		<td data-name="DateOfAppealLetter" <?php echo $staffdisciplinary_case_grid->DateOfAppealLetter->cellAttributes() ?>>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_DateOfAppealLetter" class="form-group">
<input type="text" data-table="staffdisciplinary_case" data-field="x_DateOfAppealLetter" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateOfAppealLetter" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateOfAppealLetter" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateOfAppealLetter->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_grid->DateOfAppealLetter->EditValue ?>"<?php echo $staffdisciplinary_case_grid->DateOfAppealLetter->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_grid->DateOfAppealLetter->ReadOnly && !$staffdisciplinary_case_grid->DateOfAppealLetter->Disabled && !isset($staffdisciplinary_case_grid->DateOfAppealLetter->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_grid->DateOfAppealLetter->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_casegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_casegrid", "x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateOfAppealLetter", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_DateOfAppealLetter" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateOfAppealLetter" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateOfAppealLetter" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateOfAppealLetter->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_DateOfAppealLetter" class="form-group">
<input type="text" data-table="staffdisciplinary_case" data-field="x_DateOfAppealLetter" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateOfAppealLetter" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateOfAppealLetter" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateOfAppealLetter->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_grid->DateOfAppealLetter->EditValue ?>"<?php echo $staffdisciplinary_case_grid->DateOfAppealLetter->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_grid->DateOfAppealLetter->ReadOnly && !$staffdisciplinary_case_grid->DateOfAppealLetter->Disabled && !isset($staffdisciplinary_case_grid->DateOfAppealLetter->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_grid->DateOfAppealLetter->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_casegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_casegrid", "x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateOfAppealLetter", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_DateOfAppealLetter">
<span<?php echo $staffdisciplinary_case_grid->DateOfAppealLetter->viewAttributes() ?>><?php echo $staffdisciplinary_case_grid->DateOfAppealLetter->getViewValue() ?></span>
</span>
<?php if (!$staffdisciplinary_case->isConfirm()) { ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_DateOfAppealLetter" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateOfAppealLetter" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateOfAppealLetter" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateOfAppealLetter->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_DateOfAppealLetter" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateOfAppealLetter" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateOfAppealLetter" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateOfAppealLetter->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_DateOfAppealLetter" name="fstaffdisciplinary_casegrid$x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateOfAppealLetter" id="fstaffdisciplinary_casegrid$x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateOfAppealLetter" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateOfAppealLetter->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_DateOfAppealLetter" name="fstaffdisciplinary_casegrid$o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateOfAppealLetter" id="fstaffdisciplinary_casegrid$o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateOfAppealLetter" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateOfAppealLetter->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_case_grid->DateAppealReceived->Visible) { // DateAppealReceived ?>
		<td data-name="DateAppealReceived" <?php echo $staffdisciplinary_case_grid->DateAppealReceived->cellAttributes() ?>>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_DateAppealReceived" class="form-group">
<input type="text" data-table="staffdisciplinary_case" data-field="x_DateAppealReceived" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateAppealReceived" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateAppealReceived" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateAppealReceived->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_grid->DateAppealReceived->EditValue ?>"<?php echo $staffdisciplinary_case_grid->DateAppealReceived->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_grid->DateAppealReceived->ReadOnly && !$staffdisciplinary_case_grid->DateAppealReceived->Disabled && !isset($staffdisciplinary_case_grid->DateAppealReceived->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_grid->DateAppealReceived->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_casegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_casegrid", "x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateAppealReceived", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_DateAppealReceived" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateAppealReceived" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateAppealReceived" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateAppealReceived->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_DateAppealReceived" class="form-group">
<input type="text" data-table="staffdisciplinary_case" data-field="x_DateAppealReceived" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateAppealReceived" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateAppealReceived" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateAppealReceived->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_grid->DateAppealReceived->EditValue ?>"<?php echo $staffdisciplinary_case_grid->DateAppealReceived->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_grid->DateAppealReceived->ReadOnly && !$staffdisciplinary_case_grid->DateAppealReceived->Disabled && !isset($staffdisciplinary_case_grid->DateAppealReceived->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_grid->DateAppealReceived->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_casegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_casegrid", "x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateAppealReceived", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_DateAppealReceived">
<span<?php echo $staffdisciplinary_case_grid->DateAppealReceived->viewAttributes() ?>><?php echo $staffdisciplinary_case_grid->DateAppealReceived->getViewValue() ?></span>
</span>
<?php if (!$staffdisciplinary_case->isConfirm()) { ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_DateAppealReceived" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateAppealReceived" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateAppealReceived" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateAppealReceived->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_DateAppealReceived" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateAppealReceived" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateAppealReceived" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateAppealReceived->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_DateAppealReceived" name="fstaffdisciplinary_casegrid$x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateAppealReceived" id="fstaffdisciplinary_casegrid$x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateAppealReceived" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateAppealReceived->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_DateAppealReceived" name="fstaffdisciplinary_casegrid$o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateAppealReceived" id="fstaffdisciplinary_casegrid$o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateAppealReceived" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateAppealReceived->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_case_grid->DateConcluded->Visible) { // DateConcluded ?>
		<td data-name="DateConcluded" <?php echo $staffdisciplinary_case_grid->DateConcluded->cellAttributes() ?>>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_DateConcluded" class="form-group">
<input type="text" data-table="staffdisciplinary_case" data-field="x_DateConcluded" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateConcluded" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateConcluded" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateConcluded->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_grid->DateConcluded->EditValue ?>"<?php echo $staffdisciplinary_case_grid->DateConcluded->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_grid->DateConcluded->ReadOnly && !$staffdisciplinary_case_grid->DateConcluded->Disabled && !isset($staffdisciplinary_case_grid->DateConcluded->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_grid->DateConcluded->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_casegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_casegrid", "x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateConcluded", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_DateConcluded" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateConcluded" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateConcluded" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateConcluded->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_DateConcluded" class="form-group">
<input type="text" data-table="staffdisciplinary_case" data-field="x_DateConcluded" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateConcluded" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateConcluded" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateConcluded->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_grid->DateConcluded->EditValue ?>"<?php echo $staffdisciplinary_case_grid->DateConcluded->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_grid->DateConcluded->ReadOnly && !$staffdisciplinary_case_grid->DateConcluded->Disabled && !isset($staffdisciplinary_case_grid->DateConcluded->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_grid->DateConcluded->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_casegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_casegrid", "x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateConcluded", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_DateConcluded">
<span<?php echo $staffdisciplinary_case_grid->DateConcluded->viewAttributes() ?>><?php echo $staffdisciplinary_case_grid->DateConcluded->getViewValue() ?></span>
</span>
<?php if (!$staffdisciplinary_case->isConfirm()) { ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_DateConcluded" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateConcluded" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateConcluded" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateConcluded->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_DateConcluded" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateConcluded" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateConcluded" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateConcluded->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_DateConcluded" name="fstaffdisciplinary_casegrid$x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateConcluded" id="fstaffdisciplinary_casegrid$x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateConcluded" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateConcluded->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_DateConcluded" name="fstaffdisciplinary_casegrid$o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateConcluded" id="fstaffdisciplinary_casegrid$o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateConcluded" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateConcluded->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_case_grid->AppealStatus->Visible) { // AppealStatus ?>
		<td data-name="AppealStatus" <?php echo $staffdisciplinary_case_grid->AppealStatus->cellAttributes() ?>>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_AppealStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffdisciplinary_case" data-field="x_AppealStatus" data-value-separator="<?php echo $staffdisciplinary_case_grid->AppealStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_AppealStatus" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_AppealStatus"<?php echo $staffdisciplinary_case_grid->AppealStatus->editAttributes() ?>>
			<?php echo $staffdisciplinary_case_grid->AppealStatus->selectOptionListHtml("x{$staffdisciplinary_case_grid->RowIndex}_AppealStatus") ?>
		</select>
</div>
<?php echo $staffdisciplinary_case_grid->AppealStatus->Lookup->getParamTag($staffdisciplinary_case_grid, "p_x" . $staffdisciplinary_case_grid->RowIndex . "_AppealStatus") ?>
</span>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_AppealStatus" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_AppealStatus" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_AppealStatus" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->AppealStatus->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_AppealStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffdisciplinary_case" data-field="x_AppealStatus" data-value-separator="<?php echo $staffdisciplinary_case_grid->AppealStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_AppealStatus" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_AppealStatus"<?php echo $staffdisciplinary_case_grid->AppealStatus->editAttributes() ?>>
			<?php echo $staffdisciplinary_case_grid->AppealStatus->selectOptionListHtml("x{$staffdisciplinary_case_grid->RowIndex}_AppealStatus") ?>
		</select>
</div>
<?php echo $staffdisciplinary_case_grid->AppealStatus->Lookup->getParamTag($staffdisciplinary_case_grid, "p_x" . $staffdisciplinary_case_grid->RowIndex . "_AppealStatus") ?>
</span>
<?php } ?>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_case_grid->RowCount ?>_staffdisciplinary_case_AppealStatus">
<span<?php echo $staffdisciplinary_case_grid->AppealStatus->viewAttributes() ?>><?php echo $staffdisciplinary_case_grid->AppealStatus->getViewValue() ?></span>
</span>
<?php if (!$staffdisciplinary_case->isConfirm()) { ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_AppealStatus" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_AppealStatus" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_AppealStatus" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->AppealStatus->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_AppealStatus" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_AppealStatus" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_AppealStatus" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->AppealStatus->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_AppealStatus" name="fstaffdisciplinary_casegrid$x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_AppealStatus" id="fstaffdisciplinary_casegrid$x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_AppealStatus" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->AppealStatus->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_AppealStatus" name="fstaffdisciplinary_casegrid$o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_AppealStatus" id="fstaffdisciplinary_casegrid$o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_AppealStatus" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->AppealStatus->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffdisciplinary_case_grid->ListOptions->render("body", "right", $staffdisciplinary_case_grid->RowCount);
?>
	</tr>
<?php if ($staffdisciplinary_case->RowType == ROWTYPE_ADD || $staffdisciplinary_case->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_casegrid", "load"], function() {
	fstaffdisciplinary_casegrid.updateLists(<?php echo $staffdisciplinary_case_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$staffdisciplinary_case_grid->isGridAdd() || $staffdisciplinary_case->CurrentMode == "copy")
		if (!$staffdisciplinary_case_grid->Recordset->EOF)
			$staffdisciplinary_case_grid->Recordset->moveNext();
}
?>
<?php
	if ($staffdisciplinary_case->CurrentMode == "add" || $staffdisciplinary_case->CurrentMode == "copy" || $staffdisciplinary_case->CurrentMode == "edit") {
		$staffdisciplinary_case_grid->RowIndex = '$rowindex$';
		$staffdisciplinary_case_grid->loadRowValues();

		// Set row properties
		$staffdisciplinary_case->resetAttributes();
		$staffdisciplinary_case->RowAttrs->merge(["data-rowindex" => $staffdisciplinary_case_grid->RowIndex, "id" => "r0_staffdisciplinary_case", "data-rowtype" => ROWTYPE_ADD]);
		$staffdisciplinary_case->RowAttrs->appendClass("ew-template");
		$staffdisciplinary_case->RowType = ROWTYPE_ADD;

		// Render row
		$staffdisciplinary_case_grid->renderRow();

		// Render list options
		$staffdisciplinary_case_grid->renderListOptions();
		$staffdisciplinary_case_grid->StartRowCount = 0;
?>
	<tr <?php echo $staffdisciplinary_case->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffdisciplinary_case_grid->ListOptions->render("body", "left", $staffdisciplinary_case_grid->RowIndex);
?>
	<?php if ($staffdisciplinary_case_grid->CaseNo->Visible) { // CaseNo ?>
		<td data-name="CaseNo">
<?php if (!$staffdisciplinary_case->isConfirm()) { ?>
<span id="el$rowindex$_staffdisciplinary_case_CaseNo" class="form-group staffdisciplinary_case_CaseNo"></span>
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_case_CaseNo" class="form-group staffdisciplinary_case_CaseNo">
<span<?php echo $staffdisciplinary_case_grid->CaseNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_case_grid->CaseNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_CaseNo" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_CaseNo" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->CaseNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_CaseNo" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_CaseNo" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->CaseNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_case_grid->OffenseCode->Visible) { // OffenseCode ?>
		<td data-name="OffenseCode">
<?php if (!$staffdisciplinary_case->isConfirm()) { ?>
<span id="el$rowindex$_staffdisciplinary_case_OffenseCode" class="form-group staffdisciplinary_case_OffenseCode">
<?php $staffdisciplinary_case_grid->OffenseCode->EditAttrs->prepend("onclick", "ew.autoFill(this);"); ?>
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($staffdisciplinary_case_grid->OffenseCode->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $staffdisciplinary_case_grid->OffenseCode->ViewValue ?></button>
		<div id="dsl_x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" data-repeatcolumn="5" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $staffdisciplinary_case_grid->OffenseCode->radioButtonListHtml(TRUE, "x{$staffdisciplinary_case_grid->RowIndex}_OffenseCode") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" class="ew-template"><input type="radio" class="custom-control-input" data-table="staffdisciplinary_case" data-field="x_OffenseCode" data-value-separator="<?php echo $staffdisciplinary_case_grid->OffenseCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" value="{value}"<?php echo $staffdisciplinary_case_grid->OffenseCode->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$staffdisciplinary_case_grid->OffenseCode->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $staffdisciplinary_case_grid->OffenseCode->Lookup->getParamTag($staffdisciplinary_case_grid, "p_x" . $staffdisciplinary_case_grid->RowIndex . "_OffenseCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_case_OffenseCode" class="form-group staffdisciplinary_case_OffenseCode">
<span<?php echo $staffdisciplinary_case_grid->OffenseCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_case_grid->OffenseCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_OffenseCode" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->OffenseCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_OffenseCode" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->OffenseCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_case_grid->ActionTaken->Visible) { // ActionTaken ?>
		<td data-name="ActionTaken">
<?php if (!$staffdisciplinary_case->isConfirm()) { ?>
<span id="el$rowindex$_staffdisciplinary_case_ActionTaken" class="form-group staffdisciplinary_case_ActionTaken">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffdisciplinary_case" data-field="x_ActionTaken" data-value-separator="<?php echo $staffdisciplinary_case_grid->ActionTaken->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionTaken" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionTaken"<?php echo $staffdisciplinary_case_grid->ActionTaken->editAttributes() ?>>
			<?php echo $staffdisciplinary_case_grid->ActionTaken->selectOptionListHtml("x{$staffdisciplinary_case_grid->RowIndex}_ActionTaken") ?>
		</select>
</div>
<?php echo $staffdisciplinary_case_grid->ActionTaken->Lookup->getParamTag($staffdisciplinary_case_grid, "p_x" . $staffdisciplinary_case_grid->RowIndex . "_ActionTaken") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_case_ActionTaken" class="form-group staffdisciplinary_case_ActionTaken">
<span<?php echo $staffdisciplinary_case_grid->ActionTaken->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_case_grid->ActionTaken->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_ActionTaken" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionTaken" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionTaken" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->ActionTaken->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_ActionTaken" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionTaken" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionTaken" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->ActionTaken->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_case_grid->OffenseDate->Visible) { // OffenseDate ?>
		<td data-name="OffenseDate">
<?php if (!$staffdisciplinary_case->isConfirm()) { ?>
<span id="el$rowindex$_staffdisciplinary_case_OffenseDate" class="form-group staffdisciplinary_case_OffenseDate">
<input type="text" data-table="staffdisciplinary_case" data-field="x_OffenseDate" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseDate" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_grid->OffenseDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_grid->OffenseDate->EditValue ?>"<?php echo $staffdisciplinary_case_grid->OffenseDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_grid->OffenseDate->ReadOnly && !$staffdisciplinary_case_grid->OffenseDate->Disabled && !isset($staffdisciplinary_case_grid->OffenseDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_grid->OffenseDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_casegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_casegrid", "x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_case_OffenseDate" class="form-group staffdisciplinary_case_OffenseDate">
<span<?php echo $staffdisciplinary_case_grid->OffenseDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_case_grid->OffenseDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_OffenseDate" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseDate" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseDate" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->OffenseDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_OffenseDate" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseDate" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_OffenseDate" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->OffenseDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_case_grid->ActionDate->Visible) { // ActionDate ?>
		<td data-name="ActionDate">
<?php if (!$staffdisciplinary_case->isConfirm()) { ?>
<span id="el$rowindex$_staffdisciplinary_case_ActionDate" class="form-group staffdisciplinary_case_ActionDate">
<input type="text" data-table="staffdisciplinary_case" data-field="x_ActionDate" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionDate" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_grid->ActionDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_grid->ActionDate->EditValue ?>"<?php echo $staffdisciplinary_case_grid->ActionDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_grid->ActionDate->ReadOnly && !$staffdisciplinary_case_grid->ActionDate->Disabled && !isset($staffdisciplinary_case_grid->ActionDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_grid->ActionDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_casegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_casegrid", "x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_case_ActionDate" class="form-group staffdisciplinary_case_ActionDate">
<span<?php echo $staffdisciplinary_case_grid->ActionDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_case_grid->ActionDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_ActionDate" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionDate" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionDate" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->ActionDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_ActionDate" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionDate" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_ActionDate" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->ActionDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_case_grid->DateOfAppealLetter->Visible) { // DateOfAppealLetter ?>
		<td data-name="DateOfAppealLetter">
<?php if (!$staffdisciplinary_case->isConfirm()) { ?>
<span id="el$rowindex$_staffdisciplinary_case_DateOfAppealLetter" class="form-group staffdisciplinary_case_DateOfAppealLetter">
<input type="text" data-table="staffdisciplinary_case" data-field="x_DateOfAppealLetter" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateOfAppealLetter" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateOfAppealLetter" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateOfAppealLetter->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_grid->DateOfAppealLetter->EditValue ?>"<?php echo $staffdisciplinary_case_grid->DateOfAppealLetter->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_grid->DateOfAppealLetter->ReadOnly && !$staffdisciplinary_case_grid->DateOfAppealLetter->Disabled && !isset($staffdisciplinary_case_grid->DateOfAppealLetter->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_grid->DateOfAppealLetter->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_casegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_casegrid", "x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateOfAppealLetter", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_case_DateOfAppealLetter" class="form-group staffdisciplinary_case_DateOfAppealLetter">
<span<?php echo $staffdisciplinary_case_grid->DateOfAppealLetter->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_case_grid->DateOfAppealLetter->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_DateOfAppealLetter" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateOfAppealLetter" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateOfAppealLetter" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateOfAppealLetter->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_DateOfAppealLetter" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateOfAppealLetter" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateOfAppealLetter" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateOfAppealLetter->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_case_grid->DateAppealReceived->Visible) { // DateAppealReceived ?>
		<td data-name="DateAppealReceived">
<?php if (!$staffdisciplinary_case->isConfirm()) { ?>
<span id="el$rowindex$_staffdisciplinary_case_DateAppealReceived" class="form-group staffdisciplinary_case_DateAppealReceived">
<input type="text" data-table="staffdisciplinary_case" data-field="x_DateAppealReceived" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateAppealReceived" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateAppealReceived" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateAppealReceived->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_grid->DateAppealReceived->EditValue ?>"<?php echo $staffdisciplinary_case_grid->DateAppealReceived->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_grid->DateAppealReceived->ReadOnly && !$staffdisciplinary_case_grid->DateAppealReceived->Disabled && !isset($staffdisciplinary_case_grid->DateAppealReceived->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_grid->DateAppealReceived->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_casegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_casegrid", "x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateAppealReceived", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_case_DateAppealReceived" class="form-group staffdisciplinary_case_DateAppealReceived">
<span<?php echo $staffdisciplinary_case_grid->DateAppealReceived->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_case_grid->DateAppealReceived->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_DateAppealReceived" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateAppealReceived" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateAppealReceived" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateAppealReceived->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_DateAppealReceived" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateAppealReceived" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateAppealReceived" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateAppealReceived->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_case_grid->DateConcluded->Visible) { // DateConcluded ?>
		<td data-name="DateConcluded">
<?php if (!$staffdisciplinary_case->isConfirm()) { ?>
<span id="el$rowindex$_staffdisciplinary_case_DateConcluded" class="form-group staffdisciplinary_case_DateConcluded">
<input type="text" data-table="staffdisciplinary_case" data-field="x_DateConcluded" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateConcluded" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateConcluded" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateConcluded->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_grid->DateConcluded->EditValue ?>"<?php echo $staffdisciplinary_case_grid->DateConcluded->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_grid->DateConcluded->ReadOnly && !$staffdisciplinary_case_grid->DateConcluded->Disabled && !isset($staffdisciplinary_case_grid->DateConcluded->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_grid->DateConcluded->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_casegrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_casegrid", "x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateConcluded", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_case_DateConcluded" class="form-group staffdisciplinary_case_DateConcluded">
<span<?php echo $staffdisciplinary_case_grid->DateConcluded->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_case_grid->DateConcluded->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_DateConcluded" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateConcluded" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateConcluded" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateConcluded->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_DateConcluded" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateConcluded" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_DateConcluded" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->DateConcluded->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_case_grid->AppealStatus->Visible) { // AppealStatus ?>
		<td data-name="AppealStatus">
<?php if (!$staffdisciplinary_case->isConfirm()) { ?>
<span id="el$rowindex$_staffdisciplinary_case_AppealStatus" class="form-group staffdisciplinary_case_AppealStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffdisciplinary_case" data-field="x_AppealStatus" data-value-separator="<?php echo $staffdisciplinary_case_grid->AppealStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_AppealStatus" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_AppealStatus"<?php echo $staffdisciplinary_case_grid->AppealStatus->editAttributes() ?>>
			<?php echo $staffdisciplinary_case_grid->AppealStatus->selectOptionListHtml("x{$staffdisciplinary_case_grid->RowIndex}_AppealStatus") ?>
		</select>
</div>
<?php echo $staffdisciplinary_case_grid->AppealStatus->Lookup->getParamTag($staffdisciplinary_case_grid, "p_x" . $staffdisciplinary_case_grid->RowIndex . "_AppealStatus") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_case_AppealStatus" class="form-group staffdisciplinary_case_AppealStatus">
<span<?php echo $staffdisciplinary_case_grid->AppealStatus->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_case_grid->AppealStatus->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_AppealStatus" name="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_AppealStatus" id="x<?php echo $staffdisciplinary_case_grid->RowIndex ?>_AppealStatus" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->AppealStatus->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_AppealStatus" name="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_AppealStatus" id="o<?php echo $staffdisciplinary_case_grid->RowIndex ?>_AppealStatus" value="<?php echo HtmlEncode($staffdisciplinary_case_grid->AppealStatus->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffdisciplinary_case_grid->ListOptions->render("body", "right", $staffdisciplinary_case_grid->RowIndex);
?>
<script>
loadjs.ready(["fstaffdisciplinary_casegrid", "load"], function() {
	fstaffdisciplinary_casegrid.updateLists(<?php echo $staffdisciplinary_case_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($staffdisciplinary_case->CurrentMode == "add" || $staffdisciplinary_case->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $staffdisciplinary_case_grid->FormKeyCountName ?>" id="<?php echo $staffdisciplinary_case_grid->FormKeyCountName ?>" value="<?php echo $staffdisciplinary_case_grid->KeyCount ?>">
<?php echo $staffdisciplinary_case_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($staffdisciplinary_case->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $staffdisciplinary_case_grid->FormKeyCountName ?>" id="<?php echo $staffdisciplinary_case_grid->FormKeyCountName ?>" value="<?php echo $staffdisciplinary_case_grid->KeyCount ?>">
<?php echo $staffdisciplinary_case_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($staffdisciplinary_case->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fstaffdisciplinary_casegrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($staffdisciplinary_case_grid->Recordset)
	$staffdisciplinary_case_grid->Recordset->Close();
?>
<?php if ($staffdisciplinary_case_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $staffdisciplinary_case_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($staffdisciplinary_case_grid->TotalRecords == 0 && !$staffdisciplinary_case->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $staffdisciplinary_case_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$staffdisciplinary_case_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$staffdisciplinary_case_grid->terminate();
?>