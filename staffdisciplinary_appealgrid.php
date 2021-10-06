<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($staffdisciplinary_appeal_grid))
	$staffdisciplinary_appeal_grid = new staffdisciplinary_appeal_grid();

// Run the page
$staffdisciplinary_appeal_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffdisciplinary_appeal_grid->Page_Render();
?>
<?php if (!$staffdisciplinary_appeal_grid->isExport()) { ?>
<script>
var fstaffdisciplinary_appealgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fstaffdisciplinary_appealgrid = new ew.Form("fstaffdisciplinary_appealgrid", "grid");
	fstaffdisciplinary_appealgrid.formKeyCountName = '<?php echo $staffdisciplinary_appeal_grid->FormKeyCountName ?>';

	// Validate form
	fstaffdisciplinary_appealgrid.validate = function() {
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
			<?php if ($staffdisciplinary_appeal_grid->CaseNo->Required) { ?>
				elm = this.getElements("x" + infix + "_CaseNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_grid->CaseNo->caption(), $staffdisciplinary_appeal_grid->CaseNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_appeal_grid->OffenseCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OffenseCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_grid->OffenseCode->caption(), $staffdisciplinary_appeal_grid->OffenseCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OffenseCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_appeal_grid->OffenseCode->errorMessage()) ?>");
			<?php if ($staffdisciplinary_appeal_grid->AppealNo->Required) { ?>
				elm = this.getElements("x" + infix + "_AppealNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_grid->AppealNo->caption(), $staffdisciplinary_appeal_grid->AppealNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_appeal_grid->DateOfAppealLetter->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfAppealLetter");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_grid->DateOfAppealLetter->caption(), $staffdisciplinary_appeal_grid->DateOfAppealLetter->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfAppealLetter");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_appeal_grid->DateOfAppealLetter->errorMessage()) ?>");
			<?php if ($staffdisciplinary_appeal_grid->DateAppealReceived->Required) { ?>
				elm = this.getElements("x" + infix + "_DateAppealReceived");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_grid->DateAppealReceived->caption(), $staffdisciplinary_appeal_grid->DateAppealReceived->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateAppealReceived");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_appeal_grid->DateAppealReceived->errorMessage()) ?>");
			<?php if ($staffdisciplinary_appeal_grid->DateConcluded->Required) { ?>
				elm = this.getElements("x" + infix + "_DateConcluded");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_grid->DateConcluded->caption(), $staffdisciplinary_appeal_grid->DateConcluded->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateConcluded");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_appeal_grid->DateConcluded->errorMessage()) ?>");
			<?php if ($staffdisciplinary_appeal_grid->AppealStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_AppealStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_grid->AppealStatus->caption(), $staffdisciplinary_appeal_grid->AppealStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_appeal_grid->LastUpdate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_grid->LastUpdate->caption(), $staffdisciplinary_appeal_grid->LastUpdate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_appeal_grid->LastUpdate->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fstaffdisciplinary_appealgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "CaseNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "OffenseCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateOfAppealLetter", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateAppealReceived", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateConcluded", false)) return false;
		if (ew.valueChanged(fobj, infix, "AppealStatus", false)) return false;
		if (ew.valueChanged(fobj, infix, "LastUpdate", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fstaffdisciplinary_appealgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffdisciplinary_appealgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffdisciplinary_appealgrid.lists["x_AppealStatus"] = <?php echo $staffdisciplinary_appeal_grid->AppealStatus->Lookup->toClientList($staffdisciplinary_appeal_grid) ?>;
	fstaffdisciplinary_appealgrid.lists["x_AppealStatus"].options = <?php echo JsonEncode($staffdisciplinary_appeal_grid->AppealStatus->lookupOptions()) ?>;
	loadjs.done("fstaffdisciplinary_appealgrid");
});
</script>
<?php } ?>
<?php
$staffdisciplinary_appeal_grid->renderOtherOptions();
?>
<?php if ($staffdisciplinary_appeal_grid->TotalRecords > 0 || $staffdisciplinary_appeal->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($staffdisciplinary_appeal_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> staffdisciplinary_appeal">
<?php if ($staffdisciplinary_appeal_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $staffdisciplinary_appeal_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fstaffdisciplinary_appealgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_staffdisciplinary_appeal" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_staffdisciplinary_appealgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$staffdisciplinary_appeal->RowType = ROWTYPE_HEADER;

// Render list options
$staffdisciplinary_appeal_grid->renderListOptions();

// Render list options (header, left)
$staffdisciplinary_appeal_grid->ListOptions->render("header", "left");
?>
<?php if ($staffdisciplinary_appeal_grid->CaseNo->Visible) { // CaseNo ?>
	<?php if ($staffdisciplinary_appeal_grid->SortUrl($staffdisciplinary_appeal_grid->CaseNo) == "") { ?>
		<th data-name="CaseNo" class="<?php echo $staffdisciplinary_appeal_grid->CaseNo->headerCellClass() ?>"><div id="elh_staffdisciplinary_appeal_CaseNo" class="staffdisciplinary_appeal_CaseNo"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_grid->CaseNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CaseNo" class="<?php echo $staffdisciplinary_appeal_grid->CaseNo->headerCellClass() ?>"><div><div id="elh_staffdisciplinary_appeal_CaseNo" class="staffdisciplinary_appeal_CaseNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_grid->CaseNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_appeal_grid->CaseNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_appeal_grid->CaseNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_appeal_grid->OffenseCode->Visible) { // OffenseCode ?>
	<?php if ($staffdisciplinary_appeal_grid->SortUrl($staffdisciplinary_appeal_grid->OffenseCode) == "") { ?>
		<th data-name="OffenseCode" class="<?php echo $staffdisciplinary_appeal_grid->OffenseCode->headerCellClass() ?>"><div id="elh_staffdisciplinary_appeal_OffenseCode" class="staffdisciplinary_appeal_OffenseCode"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_grid->OffenseCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OffenseCode" class="<?php echo $staffdisciplinary_appeal_grid->OffenseCode->headerCellClass() ?>"><div><div id="elh_staffdisciplinary_appeal_OffenseCode" class="staffdisciplinary_appeal_OffenseCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_grid->OffenseCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_appeal_grid->OffenseCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_appeal_grid->OffenseCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_appeal_grid->AppealNo->Visible) { // AppealNo ?>
	<?php if ($staffdisciplinary_appeal_grid->SortUrl($staffdisciplinary_appeal_grid->AppealNo) == "") { ?>
		<th data-name="AppealNo" class="<?php echo $staffdisciplinary_appeal_grid->AppealNo->headerCellClass() ?>"><div id="elh_staffdisciplinary_appeal_AppealNo" class="staffdisciplinary_appeal_AppealNo"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_grid->AppealNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AppealNo" class="<?php echo $staffdisciplinary_appeal_grid->AppealNo->headerCellClass() ?>"><div><div id="elh_staffdisciplinary_appeal_AppealNo" class="staffdisciplinary_appeal_AppealNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_grid->AppealNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_appeal_grid->AppealNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_appeal_grid->AppealNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_appeal_grid->DateOfAppealLetter->Visible) { // DateOfAppealLetter ?>
	<?php if ($staffdisciplinary_appeal_grid->SortUrl($staffdisciplinary_appeal_grid->DateOfAppealLetter) == "") { ?>
		<th data-name="DateOfAppealLetter" class="<?php echo $staffdisciplinary_appeal_grid->DateOfAppealLetter->headerCellClass() ?>"><div id="elh_staffdisciplinary_appeal_DateOfAppealLetter" class="staffdisciplinary_appeal_DateOfAppealLetter"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_grid->DateOfAppealLetter->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfAppealLetter" class="<?php echo $staffdisciplinary_appeal_grid->DateOfAppealLetter->headerCellClass() ?>"><div><div id="elh_staffdisciplinary_appeal_DateOfAppealLetter" class="staffdisciplinary_appeal_DateOfAppealLetter">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_grid->DateOfAppealLetter->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_appeal_grid->DateOfAppealLetter->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_appeal_grid->DateOfAppealLetter->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_appeal_grid->DateAppealReceived->Visible) { // DateAppealReceived ?>
	<?php if ($staffdisciplinary_appeal_grid->SortUrl($staffdisciplinary_appeal_grid->DateAppealReceived) == "") { ?>
		<th data-name="DateAppealReceived" class="<?php echo $staffdisciplinary_appeal_grid->DateAppealReceived->headerCellClass() ?>"><div id="elh_staffdisciplinary_appeal_DateAppealReceived" class="staffdisciplinary_appeal_DateAppealReceived"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_grid->DateAppealReceived->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateAppealReceived" class="<?php echo $staffdisciplinary_appeal_grid->DateAppealReceived->headerCellClass() ?>"><div><div id="elh_staffdisciplinary_appeal_DateAppealReceived" class="staffdisciplinary_appeal_DateAppealReceived">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_grid->DateAppealReceived->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_appeal_grid->DateAppealReceived->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_appeal_grid->DateAppealReceived->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_appeal_grid->DateConcluded->Visible) { // DateConcluded ?>
	<?php if ($staffdisciplinary_appeal_grid->SortUrl($staffdisciplinary_appeal_grid->DateConcluded) == "") { ?>
		<th data-name="DateConcluded" class="<?php echo $staffdisciplinary_appeal_grid->DateConcluded->headerCellClass() ?>"><div id="elh_staffdisciplinary_appeal_DateConcluded" class="staffdisciplinary_appeal_DateConcluded"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_grid->DateConcluded->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateConcluded" class="<?php echo $staffdisciplinary_appeal_grid->DateConcluded->headerCellClass() ?>"><div><div id="elh_staffdisciplinary_appeal_DateConcluded" class="staffdisciplinary_appeal_DateConcluded">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_grid->DateConcluded->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_appeal_grid->DateConcluded->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_appeal_grid->DateConcluded->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_appeal_grid->AppealStatus->Visible) { // AppealStatus ?>
	<?php if ($staffdisciplinary_appeal_grid->SortUrl($staffdisciplinary_appeal_grid->AppealStatus) == "") { ?>
		<th data-name="AppealStatus" class="<?php echo $staffdisciplinary_appeal_grid->AppealStatus->headerCellClass() ?>"><div id="elh_staffdisciplinary_appeal_AppealStatus" class="staffdisciplinary_appeal_AppealStatus"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_grid->AppealStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AppealStatus" class="<?php echo $staffdisciplinary_appeal_grid->AppealStatus->headerCellClass() ?>"><div><div id="elh_staffdisciplinary_appeal_AppealStatus" class="staffdisciplinary_appeal_AppealStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_grid->AppealStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_appeal_grid->AppealStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_appeal_grid->AppealStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_appeal_grid->LastUpdate->Visible) { // LastUpdate ?>
	<?php if ($staffdisciplinary_appeal_grid->SortUrl($staffdisciplinary_appeal_grid->LastUpdate) == "") { ?>
		<th data-name="LastUpdate" class="<?php echo $staffdisciplinary_appeal_grid->LastUpdate->headerCellClass() ?>"><div id="elh_staffdisciplinary_appeal_LastUpdate" class="staffdisciplinary_appeal_LastUpdate"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_grid->LastUpdate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdate" class="<?php echo $staffdisciplinary_appeal_grid->LastUpdate->headerCellClass() ?>"><div><div id="elh_staffdisciplinary_appeal_LastUpdate" class="staffdisciplinary_appeal_LastUpdate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_grid->LastUpdate->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_appeal_grid->LastUpdate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_appeal_grid->LastUpdate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$staffdisciplinary_appeal_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$staffdisciplinary_appeal_grid->StartRecord = 1;
$staffdisciplinary_appeal_grid->StopRecord = $staffdisciplinary_appeal_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($staffdisciplinary_appeal->isConfirm() || $staffdisciplinary_appeal_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($staffdisciplinary_appeal_grid->FormKeyCountName) && ($staffdisciplinary_appeal_grid->isGridAdd() || $staffdisciplinary_appeal_grid->isGridEdit() || $staffdisciplinary_appeal->isConfirm())) {
		$staffdisciplinary_appeal_grid->KeyCount = $CurrentForm->getValue($staffdisciplinary_appeal_grid->FormKeyCountName);
		$staffdisciplinary_appeal_grid->StopRecord = $staffdisciplinary_appeal_grid->StartRecord + $staffdisciplinary_appeal_grid->KeyCount - 1;
	}
}
$staffdisciplinary_appeal_grid->RecordCount = $staffdisciplinary_appeal_grid->StartRecord - 1;
if ($staffdisciplinary_appeal_grid->Recordset && !$staffdisciplinary_appeal_grid->Recordset->EOF) {
	$staffdisciplinary_appeal_grid->Recordset->moveFirst();
	$selectLimit = $staffdisciplinary_appeal_grid->UseSelectLimit;
	if (!$selectLimit && $staffdisciplinary_appeal_grid->StartRecord > 1)
		$staffdisciplinary_appeal_grid->Recordset->move($staffdisciplinary_appeal_grid->StartRecord - 1);
} elseif (!$staffdisciplinary_appeal->AllowAddDeleteRow && $staffdisciplinary_appeal_grid->StopRecord == 0) {
	$staffdisciplinary_appeal_grid->StopRecord = $staffdisciplinary_appeal->GridAddRowCount;
}

// Initialize aggregate
$staffdisciplinary_appeal->RowType = ROWTYPE_AGGREGATEINIT;
$staffdisciplinary_appeal->resetAttributes();
$staffdisciplinary_appeal_grid->renderRow();
if ($staffdisciplinary_appeal_grid->isGridAdd())
	$staffdisciplinary_appeal_grid->RowIndex = 0;
if ($staffdisciplinary_appeal_grid->isGridEdit())
	$staffdisciplinary_appeal_grid->RowIndex = 0;
while ($staffdisciplinary_appeal_grid->RecordCount < $staffdisciplinary_appeal_grid->StopRecord) {
	$staffdisciplinary_appeal_grid->RecordCount++;
	if ($staffdisciplinary_appeal_grid->RecordCount >= $staffdisciplinary_appeal_grid->StartRecord) {
		$staffdisciplinary_appeal_grid->RowCount++;
		if ($staffdisciplinary_appeal_grid->isGridAdd() || $staffdisciplinary_appeal_grid->isGridEdit() || $staffdisciplinary_appeal->isConfirm()) {
			$staffdisciplinary_appeal_grid->RowIndex++;
			$CurrentForm->Index = $staffdisciplinary_appeal_grid->RowIndex;
			if ($CurrentForm->hasValue($staffdisciplinary_appeal_grid->FormActionName) && ($staffdisciplinary_appeal->isConfirm() || $staffdisciplinary_appeal_grid->EventCancelled))
				$staffdisciplinary_appeal_grid->RowAction = strval($CurrentForm->getValue($staffdisciplinary_appeal_grid->FormActionName));
			elseif ($staffdisciplinary_appeal_grid->isGridAdd())
				$staffdisciplinary_appeal_grid->RowAction = "insert";
			else
				$staffdisciplinary_appeal_grid->RowAction = "";
		}

		// Set up key count
		$staffdisciplinary_appeal_grid->KeyCount = $staffdisciplinary_appeal_grid->RowIndex;

		// Init row class and style
		$staffdisciplinary_appeal->resetAttributes();
		$staffdisciplinary_appeal->CssClass = "";
		if ($staffdisciplinary_appeal_grid->isGridAdd()) {
			if ($staffdisciplinary_appeal->CurrentMode == "copy") {
				$staffdisciplinary_appeal_grid->loadRowValues($staffdisciplinary_appeal_grid->Recordset); // Load row values
				$staffdisciplinary_appeal_grid->setRecordKey($staffdisciplinary_appeal_grid->RowOldKey, $staffdisciplinary_appeal_grid->Recordset); // Set old record key
			} else {
				$staffdisciplinary_appeal_grid->loadRowValues(); // Load default values
				$staffdisciplinary_appeal_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$staffdisciplinary_appeal_grid->loadRowValues($staffdisciplinary_appeal_grid->Recordset); // Load row values
		}
		$staffdisciplinary_appeal->RowType = ROWTYPE_VIEW; // Render view
		if ($staffdisciplinary_appeal_grid->isGridAdd()) // Grid add
			$staffdisciplinary_appeal->RowType = ROWTYPE_ADD; // Render add
		if ($staffdisciplinary_appeal_grid->isGridAdd() && $staffdisciplinary_appeal->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$staffdisciplinary_appeal_grid->restoreCurrentRowFormValues($staffdisciplinary_appeal_grid->RowIndex); // Restore form values
		if ($staffdisciplinary_appeal_grid->isGridEdit()) { // Grid edit
			if ($staffdisciplinary_appeal->EventCancelled)
				$staffdisciplinary_appeal_grid->restoreCurrentRowFormValues($staffdisciplinary_appeal_grid->RowIndex); // Restore form values
			if ($staffdisciplinary_appeal_grid->RowAction == "insert")
				$staffdisciplinary_appeal->RowType = ROWTYPE_ADD; // Render add
			else
				$staffdisciplinary_appeal->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($staffdisciplinary_appeal_grid->isGridEdit() && ($staffdisciplinary_appeal->RowType == ROWTYPE_EDIT || $staffdisciplinary_appeal->RowType == ROWTYPE_ADD) && $staffdisciplinary_appeal->EventCancelled) // Update failed
			$staffdisciplinary_appeal_grid->restoreCurrentRowFormValues($staffdisciplinary_appeal_grid->RowIndex); // Restore form values
		if ($staffdisciplinary_appeal->RowType == ROWTYPE_EDIT) // Edit row
			$staffdisciplinary_appeal_grid->EditRowCount++;
		if ($staffdisciplinary_appeal->isConfirm()) // Confirm row
			$staffdisciplinary_appeal_grid->restoreCurrentRowFormValues($staffdisciplinary_appeal_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$staffdisciplinary_appeal->RowAttrs->merge(["data-rowindex" => $staffdisciplinary_appeal_grid->RowCount, "id" => "r" . $staffdisciplinary_appeal_grid->RowCount . "_staffdisciplinary_appeal", "data-rowtype" => $staffdisciplinary_appeal->RowType]);

		// Render row
		$staffdisciplinary_appeal_grid->renderRow();

		// Render list options
		$staffdisciplinary_appeal_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($staffdisciplinary_appeal_grid->RowAction != "delete" && $staffdisciplinary_appeal_grid->RowAction != "insertdelete" && !($staffdisciplinary_appeal_grid->RowAction == "insert" && $staffdisciplinary_appeal->isConfirm() && $staffdisciplinary_appeal_grid->emptyRow())) {
?>
	<tr <?php echo $staffdisciplinary_appeal->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffdisciplinary_appeal_grid->ListOptions->render("body", "left", $staffdisciplinary_appeal_grid->RowCount);
?>
	<?php if ($staffdisciplinary_appeal_grid->CaseNo->Visible) { // CaseNo ?>
		<td data-name="CaseNo" <?php echo $staffdisciplinary_appeal_grid->CaseNo->cellAttributes() ?>>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($staffdisciplinary_appeal_grid->CaseNo->getSessionValue() != "") { ?>
<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_CaseNo" class="form-group">
<span<?php echo $staffdisciplinary_appeal_grid->CaseNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_appeal_grid->CaseNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->CaseNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_CaseNo" class="form-group">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_CaseNo" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->CaseNo->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_grid->CaseNo->EditValue ?>"<?php echo $staffdisciplinary_appeal_grid->CaseNo->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_CaseNo" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->CaseNo->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($staffdisciplinary_appeal_grid->CaseNo->getSessionValue() != "") { ?>

<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_CaseNo" class="form-group">
<span<?php echo $staffdisciplinary_appeal_grid->CaseNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_appeal_grid->CaseNo->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->CaseNo->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="staffdisciplinary_appeal" data-field="x_CaseNo" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->CaseNo->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_grid->CaseNo->EditValue ?>"<?php echo $staffdisciplinary_appeal_grid->CaseNo->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_CaseNo" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->CaseNo->OldValue != null ? $staffdisciplinary_appeal_grid->CaseNo->OldValue : $staffdisciplinary_appeal_grid->CaseNo->CurrentValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_CaseNo">
<span<?php echo $staffdisciplinary_appeal_grid->CaseNo->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_grid->CaseNo->getViewValue() ?></span>
</span>
<?php if (!$staffdisciplinary_appeal->isConfirm()) { ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_CaseNo" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->CaseNo->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_CaseNo" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->CaseNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_CaseNo" name="fstaffdisciplinary_appealgrid$x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" id="fstaffdisciplinary_appealgrid$x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->CaseNo->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_CaseNo" name="fstaffdisciplinary_appealgrid$o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" id="fstaffdisciplinary_appealgrid$o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->CaseNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_EmployeeID" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_EmployeeID" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->EmployeeID->CurrentValue) ?>">
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_EmployeeID" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_EmployeeID" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_EDIT || $staffdisciplinary_appeal->CurrentMode == "edit") { ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_EmployeeID" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_EmployeeID" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->EmployeeID->CurrentValue) ?>">
<?php } ?>
	<?php if ($staffdisciplinary_appeal_grid->OffenseCode->Visible) { // OffenseCode ?>
		<td data-name="OffenseCode" <?php echo $staffdisciplinary_appeal_grid->OffenseCode->cellAttributes() ?>>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($staffdisciplinary_appeal_grid->OffenseCode->getSessionValue() != "") { ?>
<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_OffenseCode" class="form-group">
<span<?php echo $staffdisciplinary_appeal_grid->OffenseCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_appeal_grid->OffenseCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->OffenseCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_OffenseCode" class="form-group">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_OffenseCode" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" size="30" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->OffenseCode->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_grid->OffenseCode->EditValue ?>"<?php echo $staffdisciplinary_appeal_grid->OffenseCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_OffenseCode" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->OffenseCode->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($staffdisciplinary_appeal_grid->OffenseCode->getSessionValue() != "") { ?>

<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_OffenseCode" class="form-group">
<span<?php echo $staffdisciplinary_appeal_grid->OffenseCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_appeal_grid->OffenseCode->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->OffenseCode->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="staffdisciplinary_appeal" data-field="x_OffenseCode" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" size="30" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->OffenseCode->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_grid->OffenseCode->EditValue ?>"<?php echo $staffdisciplinary_appeal_grid->OffenseCode->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_OffenseCode" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->OffenseCode->OldValue != null ? $staffdisciplinary_appeal_grid->OffenseCode->OldValue : $staffdisciplinary_appeal_grid->OffenseCode->CurrentValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_OffenseCode">
<span<?php echo $staffdisciplinary_appeal_grid->OffenseCode->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_grid->OffenseCode->getViewValue() ?></span>
</span>
<?php if (!$staffdisciplinary_appeal->isConfirm()) { ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_OffenseCode" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->OffenseCode->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_OffenseCode" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->OffenseCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_OffenseCode" name="fstaffdisciplinary_appealgrid$x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" id="fstaffdisciplinary_appealgrid$x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->OffenseCode->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_OffenseCode" name="fstaffdisciplinary_appealgrid$o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" id="fstaffdisciplinary_appealgrid$o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->OffenseCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_appeal_grid->AppealNo->Visible) { // AppealNo ?>
		<td data-name="AppealNo" <?php echo $staffdisciplinary_appeal_grid->AppealNo->cellAttributes() ?>>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_AppealNo" class="form-group"></span>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_AppealNo" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealNo" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->AppealNo->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_AppealNo" class="form-group">
<span<?php echo $staffdisciplinary_appeal_grid->AppealNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_appeal_grid->AppealNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_AppealNo" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealNo" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->AppealNo->CurrentValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_AppealNo">
<span<?php echo $staffdisciplinary_appeal_grid->AppealNo->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_grid->AppealNo->getViewValue() ?></span>
</span>
<?php if (!$staffdisciplinary_appeal->isConfirm()) { ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_AppealNo" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealNo" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->AppealNo->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_AppealNo" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealNo" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->AppealNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_AppealNo" name="fstaffdisciplinary_appealgrid$x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealNo" id="fstaffdisciplinary_appealgrid$x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->AppealNo->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_AppealNo" name="fstaffdisciplinary_appealgrid$o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealNo" id="fstaffdisciplinary_appealgrid$o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->AppealNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_appeal_grid->DateOfAppealLetter->Visible) { // DateOfAppealLetter ?>
		<td data-name="DateOfAppealLetter" <?php echo $staffdisciplinary_appeal_grid->DateOfAppealLetter->cellAttributes() ?>>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_DateOfAppealLetter" class="form-group">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_DateOfAppealLetter" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateOfAppealLetter" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateOfAppealLetter" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateOfAppealLetter->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_grid->DateOfAppealLetter->EditValue ?>"<?php echo $staffdisciplinary_appeal_grid->DateOfAppealLetter->editAttributes() ?>>
<?php if (!$staffdisciplinary_appeal_grid->DateOfAppealLetter->ReadOnly && !$staffdisciplinary_appeal_grid->DateOfAppealLetter->Disabled && !isset($staffdisciplinary_appeal_grid->DateOfAppealLetter->EditAttrs["readonly"]) && !isset($staffdisciplinary_appeal_grid->DateOfAppealLetter->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_appealgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_appealgrid", "x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateOfAppealLetter", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_DateOfAppealLetter" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateOfAppealLetter" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateOfAppealLetter" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateOfAppealLetter->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_DateOfAppealLetter" class="form-group">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_DateOfAppealLetter" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateOfAppealLetter" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateOfAppealLetter" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateOfAppealLetter->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_grid->DateOfAppealLetter->EditValue ?>"<?php echo $staffdisciplinary_appeal_grid->DateOfAppealLetter->editAttributes() ?>>
<?php if (!$staffdisciplinary_appeal_grid->DateOfAppealLetter->ReadOnly && !$staffdisciplinary_appeal_grid->DateOfAppealLetter->Disabled && !isset($staffdisciplinary_appeal_grid->DateOfAppealLetter->EditAttrs["readonly"]) && !isset($staffdisciplinary_appeal_grid->DateOfAppealLetter->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_appealgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_appealgrid", "x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateOfAppealLetter", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_DateOfAppealLetter">
<span<?php echo $staffdisciplinary_appeal_grid->DateOfAppealLetter->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_grid->DateOfAppealLetter->getViewValue() ?></span>
</span>
<?php if (!$staffdisciplinary_appeal->isConfirm()) { ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_DateOfAppealLetter" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateOfAppealLetter" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateOfAppealLetter" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateOfAppealLetter->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_DateOfAppealLetter" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateOfAppealLetter" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateOfAppealLetter" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateOfAppealLetter->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_DateOfAppealLetter" name="fstaffdisciplinary_appealgrid$x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateOfAppealLetter" id="fstaffdisciplinary_appealgrid$x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateOfAppealLetter" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateOfAppealLetter->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_DateOfAppealLetter" name="fstaffdisciplinary_appealgrid$o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateOfAppealLetter" id="fstaffdisciplinary_appealgrid$o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateOfAppealLetter" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateOfAppealLetter->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_appeal_grid->DateAppealReceived->Visible) { // DateAppealReceived ?>
		<td data-name="DateAppealReceived" <?php echo $staffdisciplinary_appeal_grid->DateAppealReceived->cellAttributes() ?>>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_DateAppealReceived" class="form-group">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_DateAppealReceived" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateAppealReceived" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateAppealReceived" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateAppealReceived->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_grid->DateAppealReceived->EditValue ?>"<?php echo $staffdisciplinary_appeal_grid->DateAppealReceived->editAttributes() ?>>
<?php if (!$staffdisciplinary_appeal_grid->DateAppealReceived->ReadOnly && !$staffdisciplinary_appeal_grid->DateAppealReceived->Disabled && !isset($staffdisciplinary_appeal_grid->DateAppealReceived->EditAttrs["readonly"]) && !isset($staffdisciplinary_appeal_grid->DateAppealReceived->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_appealgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_appealgrid", "x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateAppealReceived", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_DateAppealReceived" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateAppealReceived" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateAppealReceived" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateAppealReceived->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_DateAppealReceived" class="form-group">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_DateAppealReceived" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateAppealReceived" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateAppealReceived" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateAppealReceived->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_grid->DateAppealReceived->EditValue ?>"<?php echo $staffdisciplinary_appeal_grid->DateAppealReceived->editAttributes() ?>>
<?php if (!$staffdisciplinary_appeal_grid->DateAppealReceived->ReadOnly && !$staffdisciplinary_appeal_grid->DateAppealReceived->Disabled && !isset($staffdisciplinary_appeal_grid->DateAppealReceived->EditAttrs["readonly"]) && !isset($staffdisciplinary_appeal_grid->DateAppealReceived->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_appealgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_appealgrid", "x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateAppealReceived", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_DateAppealReceived">
<span<?php echo $staffdisciplinary_appeal_grid->DateAppealReceived->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_grid->DateAppealReceived->getViewValue() ?></span>
</span>
<?php if (!$staffdisciplinary_appeal->isConfirm()) { ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_DateAppealReceived" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateAppealReceived" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateAppealReceived" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateAppealReceived->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_DateAppealReceived" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateAppealReceived" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateAppealReceived" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateAppealReceived->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_DateAppealReceived" name="fstaffdisciplinary_appealgrid$x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateAppealReceived" id="fstaffdisciplinary_appealgrid$x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateAppealReceived" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateAppealReceived->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_DateAppealReceived" name="fstaffdisciplinary_appealgrid$o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateAppealReceived" id="fstaffdisciplinary_appealgrid$o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateAppealReceived" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateAppealReceived->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_appeal_grid->DateConcluded->Visible) { // DateConcluded ?>
		<td data-name="DateConcluded" <?php echo $staffdisciplinary_appeal_grid->DateConcluded->cellAttributes() ?>>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_DateConcluded" class="form-group">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_DateConcluded" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateConcluded" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateConcluded" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateConcluded->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_grid->DateConcluded->EditValue ?>"<?php echo $staffdisciplinary_appeal_grid->DateConcluded->editAttributes() ?>>
<?php if (!$staffdisciplinary_appeal_grid->DateConcluded->ReadOnly && !$staffdisciplinary_appeal_grid->DateConcluded->Disabled && !isset($staffdisciplinary_appeal_grid->DateConcluded->EditAttrs["readonly"]) && !isset($staffdisciplinary_appeal_grid->DateConcluded->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_appealgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_appealgrid", "x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateConcluded", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_DateConcluded" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateConcluded" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateConcluded" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateConcluded->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_DateConcluded" class="form-group">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_DateConcluded" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateConcluded" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateConcluded" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateConcluded->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_grid->DateConcluded->EditValue ?>"<?php echo $staffdisciplinary_appeal_grid->DateConcluded->editAttributes() ?>>
<?php if (!$staffdisciplinary_appeal_grid->DateConcluded->ReadOnly && !$staffdisciplinary_appeal_grid->DateConcluded->Disabled && !isset($staffdisciplinary_appeal_grid->DateConcluded->EditAttrs["readonly"]) && !isset($staffdisciplinary_appeal_grid->DateConcluded->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_appealgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_appealgrid", "x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateConcluded", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_DateConcluded">
<span<?php echo $staffdisciplinary_appeal_grid->DateConcluded->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_grid->DateConcluded->getViewValue() ?></span>
</span>
<?php if (!$staffdisciplinary_appeal->isConfirm()) { ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_DateConcluded" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateConcluded" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateConcluded" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateConcluded->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_DateConcluded" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateConcluded" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateConcluded" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateConcluded->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_DateConcluded" name="fstaffdisciplinary_appealgrid$x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateConcluded" id="fstaffdisciplinary_appealgrid$x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateConcluded" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateConcluded->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_DateConcluded" name="fstaffdisciplinary_appealgrid$o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateConcluded" id="fstaffdisciplinary_appealgrid$o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateConcluded" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateConcluded->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_appeal_grid->AppealStatus->Visible) { // AppealStatus ?>
		<td data-name="AppealStatus" <?php echo $staffdisciplinary_appeal_grid->AppealStatus->cellAttributes() ?>>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_AppealStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffdisciplinary_appeal" data-field="x_AppealStatus" data-value-separator="<?php echo $staffdisciplinary_appeal_grid->AppealStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealStatus" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealStatus"<?php echo $staffdisciplinary_appeal_grid->AppealStatus->editAttributes() ?>>
			<?php echo $staffdisciplinary_appeal_grid->AppealStatus->selectOptionListHtml("x{$staffdisciplinary_appeal_grid->RowIndex}_AppealStatus") ?>
		</select>
</div>
<?php echo $staffdisciplinary_appeal_grid->AppealStatus->Lookup->getParamTag($staffdisciplinary_appeal_grid, "p_x" . $staffdisciplinary_appeal_grid->RowIndex . "_AppealStatus") ?>
</span>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_AppealStatus" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealStatus" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealStatus" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->AppealStatus->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_AppealStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffdisciplinary_appeal" data-field="x_AppealStatus" data-value-separator="<?php echo $staffdisciplinary_appeal_grid->AppealStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealStatus" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealStatus"<?php echo $staffdisciplinary_appeal_grid->AppealStatus->editAttributes() ?>>
			<?php echo $staffdisciplinary_appeal_grid->AppealStatus->selectOptionListHtml("x{$staffdisciplinary_appeal_grid->RowIndex}_AppealStatus") ?>
		</select>
</div>
<?php echo $staffdisciplinary_appeal_grid->AppealStatus->Lookup->getParamTag($staffdisciplinary_appeal_grid, "p_x" . $staffdisciplinary_appeal_grid->RowIndex . "_AppealStatus") ?>
</span>
<?php } ?>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_AppealStatus">
<span<?php echo $staffdisciplinary_appeal_grid->AppealStatus->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_grid->AppealStatus->getViewValue() ?></span>
</span>
<?php if (!$staffdisciplinary_appeal->isConfirm()) { ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_AppealStatus" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealStatus" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealStatus" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->AppealStatus->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_AppealStatus" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealStatus" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealStatus" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->AppealStatus->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_AppealStatus" name="fstaffdisciplinary_appealgrid$x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealStatus" id="fstaffdisciplinary_appealgrid$x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealStatus" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->AppealStatus->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_AppealStatus" name="fstaffdisciplinary_appealgrid$o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealStatus" id="fstaffdisciplinary_appealgrid$o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealStatus" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->AppealStatus->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_appeal_grid->LastUpdate->Visible) { // LastUpdate ?>
		<td data-name="LastUpdate" <?php echo $staffdisciplinary_appeal_grid->LastUpdate->cellAttributes() ?>>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_LastUpdate" class="form-group">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_LastUpdate" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_LastUpdate" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_LastUpdate" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->LastUpdate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_grid->LastUpdate->EditValue ?>"<?php echo $staffdisciplinary_appeal_grid->LastUpdate->editAttributes() ?>>
<?php if (!$staffdisciplinary_appeal_grid->LastUpdate->ReadOnly && !$staffdisciplinary_appeal_grid->LastUpdate->Disabled && !isset($staffdisciplinary_appeal_grid->LastUpdate->EditAttrs["readonly"]) && !isset($staffdisciplinary_appeal_grid->LastUpdate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_appealgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_appealgrid", "x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_LastUpdate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_LastUpdate" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_LastUpdate" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_LastUpdate" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->LastUpdate->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_LastUpdate" class="form-group">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_LastUpdate" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_LastUpdate" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_LastUpdate" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->LastUpdate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_grid->LastUpdate->EditValue ?>"<?php echo $staffdisciplinary_appeal_grid->LastUpdate->editAttributes() ?>>
<?php if (!$staffdisciplinary_appeal_grid->LastUpdate->ReadOnly && !$staffdisciplinary_appeal_grid->LastUpdate->Disabled && !isset($staffdisciplinary_appeal_grid->LastUpdate->EditAttrs["readonly"]) && !isset($staffdisciplinary_appeal_grid->LastUpdate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_appealgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_appealgrid", "x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_LastUpdate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_appeal_grid->RowCount ?>_staffdisciplinary_appeal_LastUpdate">
<span<?php echo $staffdisciplinary_appeal_grid->LastUpdate->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_grid->LastUpdate->getViewValue() ?></span>
</span>
<?php if (!$staffdisciplinary_appeal->isConfirm()) { ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_LastUpdate" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_LastUpdate" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_LastUpdate" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->LastUpdate->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_LastUpdate" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_LastUpdate" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_LastUpdate" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->LastUpdate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_LastUpdate" name="fstaffdisciplinary_appealgrid$x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_LastUpdate" id="fstaffdisciplinary_appealgrid$x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_LastUpdate" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->LastUpdate->FormValue) ?>">
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_LastUpdate" name="fstaffdisciplinary_appealgrid$o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_LastUpdate" id="fstaffdisciplinary_appealgrid$o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_LastUpdate" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->LastUpdate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffdisciplinary_appeal_grid->ListOptions->render("body", "right", $staffdisciplinary_appeal_grid->RowCount);
?>
	</tr>
<?php if ($staffdisciplinary_appeal->RowType == ROWTYPE_ADD || $staffdisciplinary_appeal->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_appealgrid", "load"], function() {
	fstaffdisciplinary_appealgrid.updateLists(<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$staffdisciplinary_appeal_grid->isGridAdd() || $staffdisciplinary_appeal->CurrentMode == "copy")
		if (!$staffdisciplinary_appeal_grid->Recordset->EOF)
			$staffdisciplinary_appeal_grid->Recordset->moveNext();
}
?>
<?php
	if ($staffdisciplinary_appeal->CurrentMode == "add" || $staffdisciplinary_appeal->CurrentMode == "copy" || $staffdisciplinary_appeal->CurrentMode == "edit") {
		$staffdisciplinary_appeal_grid->RowIndex = '$rowindex$';
		$staffdisciplinary_appeal_grid->loadRowValues();

		// Set row properties
		$staffdisciplinary_appeal->resetAttributes();
		$staffdisciplinary_appeal->RowAttrs->merge(["data-rowindex" => $staffdisciplinary_appeal_grid->RowIndex, "id" => "r0_staffdisciplinary_appeal", "data-rowtype" => ROWTYPE_ADD]);
		$staffdisciplinary_appeal->RowAttrs->appendClass("ew-template");
		$staffdisciplinary_appeal->RowType = ROWTYPE_ADD;

		// Render row
		$staffdisciplinary_appeal_grid->renderRow();

		// Render list options
		$staffdisciplinary_appeal_grid->renderListOptions();
		$staffdisciplinary_appeal_grid->StartRowCount = 0;
?>
	<tr <?php echo $staffdisciplinary_appeal->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffdisciplinary_appeal_grid->ListOptions->render("body", "left", $staffdisciplinary_appeal_grid->RowIndex);
?>
	<?php if ($staffdisciplinary_appeal_grid->CaseNo->Visible) { // CaseNo ?>
		<td data-name="CaseNo">
<?php if (!$staffdisciplinary_appeal->isConfirm()) { ?>
<?php if ($staffdisciplinary_appeal_grid->CaseNo->getSessionValue() != "") { ?>
<span id="el$rowindex$_staffdisciplinary_appeal_CaseNo" class="form-group staffdisciplinary_appeal_CaseNo">
<span<?php echo $staffdisciplinary_appeal_grid->CaseNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_appeal_grid->CaseNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->CaseNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_appeal_CaseNo" class="form-group staffdisciplinary_appeal_CaseNo">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_CaseNo" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->CaseNo->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_grid->CaseNo->EditValue ?>"<?php echo $staffdisciplinary_appeal_grid->CaseNo->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_appeal_CaseNo" class="form-group staffdisciplinary_appeal_CaseNo">
<span<?php echo $staffdisciplinary_appeal_grid->CaseNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_appeal_grid->CaseNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_CaseNo" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->CaseNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_CaseNo" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->CaseNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_appeal_grid->OffenseCode->Visible) { // OffenseCode ?>
		<td data-name="OffenseCode">
<?php if (!$staffdisciplinary_appeal->isConfirm()) { ?>
<?php if ($staffdisciplinary_appeal_grid->OffenseCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_staffdisciplinary_appeal_OffenseCode" class="form-group staffdisciplinary_appeal_OffenseCode">
<span<?php echo $staffdisciplinary_appeal_grid->OffenseCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_appeal_grid->OffenseCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->OffenseCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_appeal_OffenseCode" class="form-group staffdisciplinary_appeal_OffenseCode">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_OffenseCode" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" size="30" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->OffenseCode->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_grid->OffenseCode->EditValue ?>"<?php echo $staffdisciplinary_appeal_grid->OffenseCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_appeal_OffenseCode" class="form-group staffdisciplinary_appeal_OffenseCode">
<span<?php echo $staffdisciplinary_appeal_grid->OffenseCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_appeal_grid->OffenseCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_OffenseCode" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->OffenseCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_OffenseCode" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->OffenseCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_appeal_grid->AppealNo->Visible) { // AppealNo ?>
		<td data-name="AppealNo">
<?php if (!$staffdisciplinary_appeal->isConfirm()) { ?>
<span id="el$rowindex$_staffdisciplinary_appeal_AppealNo" class="form-group staffdisciplinary_appeal_AppealNo"></span>
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_appeal_AppealNo" class="form-group staffdisciplinary_appeal_AppealNo">
<span<?php echo $staffdisciplinary_appeal_grid->AppealNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_appeal_grid->AppealNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_AppealNo" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealNo" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->AppealNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_AppealNo" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealNo" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->AppealNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_appeal_grid->DateOfAppealLetter->Visible) { // DateOfAppealLetter ?>
		<td data-name="DateOfAppealLetter">
<?php if (!$staffdisciplinary_appeal->isConfirm()) { ?>
<span id="el$rowindex$_staffdisciplinary_appeal_DateOfAppealLetter" class="form-group staffdisciplinary_appeal_DateOfAppealLetter">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_DateOfAppealLetter" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateOfAppealLetter" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateOfAppealLetter" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateOfAppealLetter->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_grid->DateOfAppealLetter->EditValue ?>"<?php echo $staffdisciplinary_appeal_grid->DateOfAppealLetter->editAttributes() ?>>
<?php if (!$staffdisciplinary_appeal_grid->DateOfAppealLetter->ReadOnly && !$staffdisciplinary_appeal_grid->DateOfAppealLetter->Disabled && !isset($staffdisciplinary_appeal_grid->DateOfAppealLetter->EditAttrs["readonly"]) && !isset($staffdisciplinary_appeal_grid->DateOfAppealLetter->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_appealgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_appealgrid", "x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateOfAppealLetter", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_appeal_DateOfAppealLetter" class="form-group staffdisciplinary_appeal_DateOfAppealLetter">
<span<?php echo $staffdisciplinary_appeal_grid->DateOfAppealLetter->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_appeal_grid->DateOfAppealLetter->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_DateOfAppealLetter" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateOfAppealLetter" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateOfAppealLetter" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateOfAppealLetter->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_DateOfAppealLetter" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateOfAppealLetter" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateOfAppealLetter" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateOfAppealLetter->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_appeal_grid->DateAppealReceived->Visible) { // DateAppealReceived ?>
		<td data-name="DateAppealReceived">
<?php if (!$staffdisciplinary_appeal->isConfirm()) { ?>
<span id="el$rowindex$_staffdisciplinary_appeal_DateAppealReceived" class="form-group staffdisciplinary_appeal_DateAppealReceived">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_DateAppealReceived" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateAppealReceived" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateAppealReceived" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateAppealReceived->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_grid->DateAppealReceived->EditValue ?>"<?php echo $staffdisciplinary_appeal_grid->DateAppealReceived->editAttributes() ?>>
<?php if (!$staffdisciplinary_appeal_grid->DateAppealReceived->ReadOnly && !$staffdisciplinary_appeal_grid->DateAppealReceived->Disabled && !isset($staffdisciplinary_appeal_grid->DateAppealReceived->EditAttrs["readonly"]) && !isset($staffdisciplinary_appeal_grid->DateAppealReceived->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_appealgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_appealgrid", "x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateAppealReceived", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_appeal_DateAppealReceived" class="form-group staffdisciplinary_appeal_DateAppealReceived">
<span<?php echo $staffdisciplinary_appeal_grid->DateAppealReceived->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_appeal_grid->DateAppealReceived->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_DateAppealReceived" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateAppealReceived" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateAppealReceived" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateAppealReceived->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_DateAppealReceived" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateAppealReceived" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateAppealReceived" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateAppealReceived->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_appeal_grid->DateConcluded->Visible) { // DateConcluded ?>
		<td data-name="DateConcluded">
<?php if (!$staffdisciplinary_appeal->isConfirm()) { ?>
<span id="el$rowindex$_staffdisciplinary_appeal_DateConcluded" class="form-group staffdisciplinary_appeal_DateConcluded">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_DateConcluded" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateConcluded" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateConcluded" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateConcluded->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_grid->DateConcluded->EditValue ?>"<?php echo $staffdisciplinary_appeal_grid->DateConcluded->editAttributes() ?>>
<?php if (!$staffdisciplinary_appeal_grid->DateConcluded->ReadOnly && !$staffdisciplinary_appeal_grid->DateConcluded->Disabled && !isset($staffdisciplinary_appeal_grid->DateConcluded->EditAttrs["readonly"]) && !isset($staffdisciplinary_appeal_grid->DateConcluded->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_appealgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_appealgrid", "x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateConcluded", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_appeal_DateConcluded" class="form-group staffdisciplinary_appeal_DateConcluded">
<span<?php echo $staffdisciplinary_appeal_grid->DateConcluded->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_appeal_grid->DateConcluded->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_DateConcluded" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateConcluded" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateConcluded" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateConcluded->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_DateConcluded" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateConcluded" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_DateConcluded" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->DateConcluded->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_appeal_grid->AppealStatus->Visible) { // AppealStatus ?>
		<td data-name="AppealStatus">
<?php if (!$staffdisciplinary_appeal->isConfirm()) { ?>
<span id="el$rowindex$_staffdisciplinary_appeal_AppealStatus" class="form-group staffdisciplinary_appeal_AppealStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffdisciplinary_appeal" data-field="x_AppealStatus" data-value-separator="<?php echo $staffdisciplinary_appeal_grid->AppealStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealStatus" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealStatus"<?php echo $staffdisciplinary_appeal_grid->AppealStatus->editAttributes() ?>>
			<?php echo $staffdisciplinary_appeal_grid->AppealStatus->selectOptionListHtml("x{$staffdisciplinary_appeal_grid->RowIndex}_AppealStatus") ?>
		</select>
</div>
<?php echo $staffdisciplinary_appeal_grid->AppealStatus->Lookup->getParamTag($staffdisciplinary_appeal_grid, "p_x" . $staffdisciplinary_appeal_grid->RowIndex . "_AppealStatus") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_appeal_AppealStatus" class="form-group staffdisciplinary_appeal_AppealStatus">
<span<?php echo $staffdisciplinary_appeal_grid->AppealStatus->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_appeal_grid->AppealStatus->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_AppealStatus" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealStatus" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealStatus" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->AppealStatus->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_AppealStatus" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealStatus" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_AppealStatus" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->AppealStatus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_appeal_grid->LastUpdate->Visible) { // LastUpdate ?>
		<td data-name="LastUpdate">
<?php if (!$staffdisciplinary_appeal->isConfirm()) { ?>
<span id="el$rowindex$_staffdisciplinary_appeal_LastUpdate" class="form-group staffdisciplinary_appeal_LastUpdate">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_LastUpdate" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_LastUpdate" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_LastUpdate" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->LastUpdate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_grid->LastUpdate->EditValue ?>"<?php echo $staffdisciplinary_appeal_grid->LastUpdate->editAttributes() ?>>
<?php if (!$staffdisciplinary_appeal_grid->LastUpdate->ReadOnly && !$staffdisciplinary_appeal_grid->LastUpdate->Disabled && !isset($staffdisciplinary_appeal_grid->LastUpdate->EditAttrs["readonly"]) && !isset($staffdisciplinary_appeal_grid->LastUpdate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_appealgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_appealgrid", "x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_LastUpdate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffdisciplinary_appeal_LastUpdate" class="form-group staffdisciplinary_appeal_LastUpdate">
<span<?php echo $staffdisciplinary_appeal_grid->LastUpdate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_appeal_grid->LastUpdate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_LastUpdate" name="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_LastUpdate" id="x<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_LastUpdate" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->LastUpdate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_LastUpdate" name="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_LastUpdate" id="o<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>_LastUpdate" value="<?php echo HtmlEncode($staffdisciplinary_appeal_grid->LastUpdate->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffdisciplinary_appeal_grid->ListOptions->render("body", "right", $staffdisciplinary_appeal_grid->RowIndex);
?>
<script>
loadjs.ready(["fstaffdisciplinary_appealgrid", "load"], function() {
	fstaffdisciplinary_appealgrid.updateLists(<?php echo $staffdisciplinary_appeal_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($staffdisciplinary_appeal->CurrentMode == "add" || $staffdisciplinary_appeal->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $staffdisciplinary_appeal_grid->FormKeyCountName ?>" id="<?php echo $staffdisciplinary_appeal_grid->FormKeyCountName ?>" value="<?php echo $staffdisciplinary_appeal_grid->KeyCount ?>">
<?php echo $staffdisciplinary_appeal_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($staffdisciplinary_appeal->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $staffdisciplinary_appeal_grid->FormKeyCountName ?>" id="<?php echo $staffdisciplinary_appeal_grid->FormKeyCountName ?>" value="<?php echo $staffdisciplinary_appeal_grid->KeyCount ?>">
<?php echo $staffdisciplinary_appeal_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($staffdisciplinary_appeal->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fstaffdisciplinary_appealgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($staffdisciplinary_appeal_grid->Recordset)
	$staffdisciplinary_appeal_grid->Recordset->Close();
?>
<?php if ($staffdisciplinary_appeal_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $staffdisciplinary_appeal_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($staffdisciplinary_appeal_grid->TotalRecords == 0 && !$staffdisciplinary_appeal->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $staffdisciplinary_appeal_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$staffdisciplinary_appeal_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$staffdisciplinary_appeal_grid->terminate();
?>