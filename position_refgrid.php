<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($position_ref_grid))
	$position_ref_grid = new position_ref_grid();

// Run the page
$position_ref_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$position_ref_grid->Page_Render();
?>
<?php if (!$position_ref_grid->isExport()) { ?>
<script>
var fposition_refgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fposition_refgrid = new ew.Form("fposition_refgrid", "grid");
	fposition_refgrid.formKeyCountName = '<?php echo $position_ref_grid->FormKeyCountName ?>';

	// Validate form
	fposition_refgrid.validate = function() {
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
			<?php if ($position_ref_grid->PositionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_grid->PositionCode->caption(), $position_ref_grid->PositionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_grid->PositionName->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_grid->PositionName->caption(), $position_ref_grid->PositionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_grid->RequisiteQualification->Required) { ?>
				elm = this.getElements("x" + infix + "_RequisiteQualification");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_grid->RequisiteQualification->caption(), $position_ref_grid->RequisiteQualification->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_grid->JobCode->Required) { ?>
				elm = this.getElements("x" + infix + "_JobCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_grid->JobCode->caption(), $position_ref_grid->JobCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_JobCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($position_ref_grid->JobCode->errorMessage()) ?>");
			<?php if ($position_ref_grid->SalaryScale->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryScale");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_grid->SalaryScale->caption(), $position_ref_grid->SalaryScale->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_grid->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_grid->ProvinceCode->caption(), $position_ref_grid->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_grid->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_grid->LACode->caption(), $position_ref_grid->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_grid->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_grid->DepartmentCode->caption(), $position_ref_grid->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_grid->FieldQualified->Required) { ?>
				elm = this.getElements("x" + infix + "_FieldQualified");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_grid->FieldQualified->caption(), $position_ref_grid->FieldQualified->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FieldQualified");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($position_ref_grid->FieldQualified->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fposition_refgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "PositionName", false)) return false;
		if (ew.valueChanged(fobj, infix, "RequisiteQualification", false)) return false;
		if (ew.valueChanged(fobj, infix, "JobCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SalaryScale", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProvinceCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "FieldQualified", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fposition_refgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fposition_refgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fposition_refgrid.lists["x_RequisiteQualification"] = <?php echo $position_ref_grid->RequisiteQualification->Lookup->toClientList($position_ref_grid) ?>;
	fposition_refgrid.lists["x_RequisiteQualification"].options = <?php echo JsonEncode($position_ref_grid->RequisiteQualification->lookupOptions()) ?>;
	fposition_refgrid.lists["x_JobCode"] = <?php echo $position_ref_grid->JobCode->Lookup->toClientList($position_ref_grid) ?>;
	fposition_refgrid.lists["x_JobCode"].options = <?php echo JsonEncode($position_ref_grid->JobCode->lookupOptions()) ?>;
	fposition_refgrid.autoSuggests["x_JobCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fposition_refgrid.lists["x_SalaryScale"] = <?php echo $position_ref_grid->SalaryScale->Lookup->toClientList($position_ref_grid) ?>;
	fposition_refgrid.lists["x_SalaryScale"].options = <?php echo JsonEncode($position_ref_grid->SalaryScale->lookupOptions()) ?>;
	fposition_refgrid.lists["x_ProvinceCode"] = <?php echo $position_ref_grid->ProvinceCode->Lookup->toClientList($position_ref_grid) ?>;
	fposition_refgrid.lists["x_ProvinceCode"].options = <?php echo JsonEncode($position_ref_grid->ProvinceCode->lookupOptions()) ?>;
	fposition_refgrid.lists["x_LACode"] = <?php echo $position_ref_grid->LACode->Lookup->toClientList($position_ref_grid) ?>;
	fposition_refgrid.lists["x_LACode"].options = <?php echo JsonEncode($position_ref_grid->LACode->lookupOptions()) ?>;
	fposition_refgrid.lists["x_DepartmentCode"] = <?php echo $position_ref_grid->DepartmentCode->Lookup->toClientList($position_ref_grid) ?>;
	fposition_refgrid.lists["x_DepartmentCode"].options = <?php echo JsonEncode($position_ref_grid->DepartmentCode->lookupOptions()) ?>;
	loadjs.done("fposition_refgrid");
});
</script>
<?php } ?>
<?php
$position_ref_grid->renderOtherOptions();
?>
<?php if ($position_ref_grid->TotalRecords > 0 || $position_ref->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($position_ref_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> position_ref">
<?php if ($position_ref_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $position_ref_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fposition_refgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_position_ref" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_position_refgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$position_ref->RowType = ROWTYPE_HEADER;

// Render list options
$position_ref_grid->renderListOptions();

// Render list options (header, left)
$position_ref_grid->ListOptions->render("header", "left");
?>
<?php if ($position_ref_grid->PositionCode->Visible) { // PositionCode ?>
	<?php if ($position_ref_grid->SortUrl($position_ref_grid->PositionCode) == "") { ?>
		<th data-name="PositionCode" class="<?php echo $position_ref_grid->PositionCode->headerCellClass() ?>"><div id="elh_position_ref_PositionCode" class="position_ref_PositionCode"><div class="ew-table-header-caption"><?php echo $position_ref_grid->PositionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionCode" class="<?php echo $position_ref_grid->PositionCode->headerCellClass() ?>"><div><div id="elh_position_ref_PositionCode" class="position_ref_PositionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_grid->PositionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_grid->PositionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_grid->PositionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_ref_grid->PositionName->Visible) { // PositionName ?>
	<?php if ($position_ref_grid->SortUrl($position_ref_grid->PositionName) == "") { ?>
		<th data-name="PositionName" class="<?php echo $position_ref_grid->PositionName->headerCellClass() ?>"><div id="elh_position_ref_PositionName" class="position_ref_PositionName"><div class="ew-table-header-caption"><?php echo $position_ref_grid->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionName" class="<?php echo $position_ref_grid->PositionName->headerCellClass() ?>"><div><div id="elh_position_ref_PositionName" class="position_ref_PositionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_grid->PositionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_grid->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_grid->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_ref_grid->RequisiteQualification->Visible) { // RequisiteQualification ?>
	<?php if ($position_ref_grid->SortUrl($position_ref_grid->RequisiteQualification) == "") { ?>
		<th data-name="RequisiteQualification" class="<?php echo $position_ref_grid->RequisiteQualification->headerCellClass() ?>"><div id="elh_position_ref_RequisiteQualification" class="position_ref_RequisiteQualification"><div class="ew-table-header-caption"><?php echo $position_ref_grid->RequisiteQualification->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RequisiteQualification" class="<?php echo $position_ref_grid->RequisiteQualification->headerCellClass() ?>"><div><div id="elh_position_ref_RequisiteQualification" class="position_ref_RequisiteQualification">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_grid->RequisiteQualification->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_grid->RequisiteQualification->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_grid->RequisiteQualification->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_ref_grid->JobCode->Visible) { // JobCode ?>
	<?php if ($position_ref_grid->SortUrl($position_ref_grid->JobCode) == "") { ?>
		<th data-name="JobCode" class="<?php echo $position_ref_grid->JobCode->headerCellClass() ?>"><div id="elh_position_ref_JobCode" class="position_ref_JobCode"><div class="ew-table-header-caption"><?php echo $position_ref_grid->JobCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobCode" class="<?php echo $position_ref_grid->JobCode->headerCellClass() ?>"><div><div id="elh_position_ref_JobCode" class="position_ref_JobCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_grid->JobCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_grid->JobCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_grid->JobCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_ref_grid->SalaryScale->Visible) { // SalaryScale ?>
	<?php if ($position_ref_grid->SortUrl($position_ref_grid->SalaryScale) == "") { ?>
		<th data-name="SalaryScale" class="<?php echo $position_ref_grid->SalaryScale->headerCellClass() ?>"><div id="elh_position_ref_SalaryScale" class="position_ref_SalaryScale"><div class="ew-table-header-caption"><?php echo $position_ref_grid->SalaryScale->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SalaryScale" class="<?php echo $position_ref_grid->SalaryScale->headerCellClass() ?>"><div><div id="elh_position_ref_SalaryScale" class="position_ref_SalaryScale">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_grid->SalaryScale->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_grid->SalaryScale->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_grid->SalaryScale->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_ref_grid->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($position_ref_grid->SortUrl($position_ref_grid->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $position_ref_grid->ProvinceCode->headerCellClass() ?>"><div id="elh_position_ref_ProvinceCode" class="position_ref_ProvinceCode"><div class="ew-table-header-caption"><?php echo $position_ref_grid->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $position_ref_grid->ProvinceCode->headerCellClass() ?>"><div><div id="elh_position_ref_ProvinceCode" class="position_ref_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_grid->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_grid->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_grid->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_ref_grid->LACode->Visible) { // LACode ?>
	<?php if ($position_ref_grid->SortUrl($position_ref_grid->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $position_ref_grid->LACode->headerCellClass() ?>"><div id="elh_position_ref_LACode" class="position_ref_LACode"><div class="ew-table-header-caption"><?php echo $position_ref_grid->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $position_ref_grid->LACode->headerCellClass() ?>"><div><div id="elh_position_ref_LACode" class="position_ref_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_grid->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_grid->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_grid->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_ref_grid->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($position_ref_grid->SortUrl($position_ref_grid->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $position_ref_grid->DepartmentCode->headerCellClass() ?>"><div id="elh_position_ref_DepartmentCode" class="position_ref_DepartmentCode"><div class="ew-table-header-caption"><?php echo $position_ref_grid->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $position_ref_grid->DepartmentCode->headerCellClass() ?>"><div><div id="elh_position_ref_DepartmentCode" class="position_ref_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_grid->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_grid->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_grid->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_ref_grid->FieldQualified->Visible) { // FieldQualified ?>
	<?php if ($position_ref_grid->SortUrl($position_ref_grid->FieldQualified) == "") { ?>
		<th data-name="FieldQualified" class="<?php echo $position_ref_grid->FieldQualified->headerCellClass() ?>"><div id="elh_position_ref_FieldQualified" class="position_ref_FieldQualified"><div class="ew-table-header-caption"><?php echo $position_ref_grid->FieldQualified->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FieldQualified" class="<?php echo $position_ref_grid->FieldQualified->headerCellClass() ?>"><div><div id="elh_position_ref_FieldQualified" class="position_ref_FieldQualified">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_grid->FieldQualified->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_grid->FieldQualified->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_grid->FieldQualified->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$position_ref_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$position_ref_grid->StartRecord = 1;
$position_ref_grid->StopRecord = $position_ref_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($position_ref->isConfirm() || $position_ref_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($position_ref_grid->FormKeyCountName) && ($position_ref_grid->isGridAdd() || $position_ref_grid->isGridEdit() || $position_ref->isConfirm())) {
		$position_ref_grid->KeyCount = $CurrentForm->getValue($position_ref_grid->FormKeyCountName);
		$position_ref_grid->StopRecord = $position_ref_grid->StartRecord + $position_ref_grid->KeyCount - 1;
	}
}
$position_ref_grid->RecordCount = $position_ref_grid->StartRecord - 1;
if ($position_ref_grid->Recordset && !$position_ref_grid->Recordset->EOF) {
	$position_ref_grid->Recordset->moveFirst();
	$selectLimit = $position_ref_grid->UseSelectLimit;
	if (!$selectLimit && $position_ref_grid->StartRecord > 1)
		$position_ref_grid->Recordset->move($position_ref_grid->StartRecord - 1);
} elseif (!$position_ref->AllowAddDeleteRow && $position_ref_grid->StopRecord == 0) {
	$position_ref_grid->StopRecord = $position_ref->GridAddRowCount;
}

// Initialize aggregate
$position_ref->RowType = ROWTYPE_AGGREGATEINIT;
$position_ref->resetAttributes();
$position_ref_grid->renderRow();
if ($position_ref_grid->isGridAdd())
	$position_ref_grid->RowIndex = 0;
if ($position_ref_grid->isGridEdit())
	$position_ref_grid->RowIndex = 0;
while ($position_ref_grid->RecordCount < $position_ref_grid->StopRecord) {
	$position_ref_grid->RecordCount++;
	if ($position_ref_grid->RecordCount >= $position_ref_grid->StartRecord) {
		$position_ref_grid->RowCount++;
		if ($position_ref_grid->isGridAdd() || $position_ref_grid->isGridEdit() || $position_ref->isConfirm()) {
			$position_ref_grid->RowIndex++;
			$CurrentForm->Index = $position_ref_grid->RowIndex;
			if ($CurrentForm->hasValue($position_ref_grid->FormActionName) && ($position_ref->isConfirm() || $position_ref_grid->EventCancelled))
				$position_ref_grid->RowAction = strval($CurrentForm->getValue($position_ref_grid->FormActionName));
			elseif ($position_ref_grid->isGridAdd())
				$position_ref_grid->RowAction = "insert";
			else
				$position_ref_grid->RowAction = "";
		}

		// Set up key count
		$position_ref_grid->KeyCount = $position_ref_grid->RowIndex;

		// Init row class and style
		$position_ref->resetAttributes();
		$position_ref->CssClass = "";
		if ($position_ref_grid->isGridAdd()) {
			if ($position_ref->CurrentMode == "copy") {
				$position_ref_grid->loadRowValues($position_ref_grid->Recordset); // Load row values
				$position_ref_grid->setRecordKey($position_ref_grid->RowOldKey, $position_ref_grid->Recordset); // Set old record key
			} else {
				$position_ref_grid->loadRowValues(); // Load default values
				$position_ref_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$position_ref_grid->loadRowValues($position_ref_grid->Recordset); // Load row values
		}
		$position_ref->RowType = ROWTYPE_VIEW; // Render view
		if ($position_ref_grid->isGridAdd()) // Grid add
			$position_ref->RowType = ROWTYPE_ADD; // Render add
		if ($position_ref_grid->isGridAdd() && $position_ref->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$position_ref_grid->restoreCurrentRowFormValues($position_ref_grid->RowIndex); // Restore form values
		if ($position_ref_grid->isGridEdit()) { // Grid edit
			if ($position_ref->EventCancelled)
				$position_ref_grid->restoreCurrentRowFormValues($position_ref_grid->RowIndex); // Restore form values
			if ($position_ref_grid->RowAction == "insert")
				$position_ref->RowType = ROWTYPE_ADD; // Render add
			else
				$position_ref->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($position_ref_grid->isGridEdit() && ($position_ref->RowType == ROWTYPE_EDIT || $position_ref->RowType == ROWTYPE_ADD) && $position_ref->EventCancelled) // Update failed
			$position_ref_grid->restoreCurrentRowFormValues($position_ref_grid->RowIndex); // Restore form values
		if ($position_ref->RowType == ROWTYPE_EDIT) // Edit row
			$position_ref_grid->EditRowCount++;
		if ($position_ref->isConfirm()) // Confirm row
			$position_ref_grid->restoreCurrentRowFormValues($position_ref_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$position_ref->RowAttrs->merge(["data-rowindex" => $position_ref_grid->RowCount, "id" => "r" . $position_ref_grid->RowCount . "_position_ref", "data-rowtype" => $position_ref->RowType]);

		// Render row
		$position_ref_grid->renderRow();

		// Render list options
		$position_ref_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($position_ref_grid->RowAction != "delete" && $position_ref_grid->RowAction != "insertdelete" && !($position_ref_grid->RowAction == "insert" && $position_ref->isConfirm() && $position_ref_grid->emptyRow())) {
?>
	<tr <?php echo $position_ref->rowAttributes() ?>>
<?php

// Render list options (body, left)
$position_ref_grid->ListOptions->render("body", "left", $position_ref_grid->RowCount);
?>
	<?php if ($position_ref_grid->PositionCode->Visible) { // PositionCode ?>
		<td data-name="PositionCode" <?php echo $position_ref_grid->PositionCode->cellAttributes() ?>>
<?php if ($position_ref->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_PositionCode" class="form-group"></span>
<input type="hidden" data-table="position_ref" data-field="x_PositionCode" name="o<?php echo $position_ref_grid->RowIndex ?>_PositionCode" id="o<?php echo $position_ref_grid->RowIndex ?>_PositionCode" value="<?php echo HtmlEncode($position_ref_grid->PositionCode->OldValue) ?>">
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_PositionCode" class="form-group">
<span<?php echo $position_ref_grid->PositionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($position_ref_grid->PositionCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="position_ref" data-field="x_PositionCode" name="x<?php echo $position_ref_grid->RowIndex ?>_PositionCode" id="x<?php echo $position_ref_grid->RowIndex ?>_PositionCode" value="<?php echo HtmlEncode($position_ref_grid->PositionCode->CurrentValue) ?>">
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_PositionCode">
<span<?php echo $position_ref_grid->PositionCode->viewAttributes() ?>><?php echo $position_ref_grid->PositionCode->getViewValue() ?></span>
</span>
<?php if (!$position_ref->isConfirm()) { ?>
<input type="hidden" data-table="position_ref" data-field="x_PositionCode" name="x<?php echo $position_ref_grid->RowIndex ?>_PositionCode" id="x<?php echo $position_ref_grid->RowIndex ?>_PositionCode" value="<?php echo HtmlEncode($position_ref_grid->PositionCode->FormValue) ?>">
<input type="hidden" data-table="position_ref" data-field="x_PositionCode" name="o<?php echo $position_ref_grid->RowIndex ?>_PositionCode" id="o<?php echo $position_ref_grid->RowIndex ?>_PositionCode" value="<?php echo HtmlEncode($position_ref_grid->PositionCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="position_ref" data-field="x_PositionCode" name="fposition_refgrid$x<?php echo $position_ref_grid->RowIndex ?>_PositionCode" id="fposition_refgrid$x<?php echo $position_ref_grid->RowIndex ?>_PositionCode" value="<?php echo HtmlEncode($position_ref_grid->PositionCode->FormValue) ?>">
<input type="hidden" data-table="position_ref" data-field="x_PositionCode" name="fposition_refgrid$o<?php echo $position_ref_grid->RowIndex ?>_PositionCode" id="fposition_refgrid$o<?php echo $position_ref_grid->RowIndex ?>_PositionCode" value="<?php echo HtmlEncode($position_ref_grid->PositionCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($position_ref_grid->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName" <?php echo $position_ref_grid->PositionName->cellAttributes() ?>>
<?php if ($position_ref->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_PositionName" class="form-group">
<input type="text" data-table="position_ref" data-field="x_PositionName" name="x<?php echo $position_ref_grid->RowIndex ?>_PositionName" id="x<?php echo $position_ref_grid->RowIndex ?>_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($position_ref_grid->PositionName->getPlaceHolder()) ?>" value="<?php echo $position_ref_grid->PositionName->EditValue ?>"<?php echo $position_ref_grid->PositionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="position_ref" data-field="x_PositionName" name="o<?php echo $position_ref_grid->RowIndex ?>_PositionName" id="o<?php echo $position_ref_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($position_ref_grid->PositionName->OldValue) ?>">
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_PositionName" class="form-group">
<input type="text" data-table="position_ref" data-field="x_PositionName" name="x<?php echo $position_ref_grid->RowIndex ?>_PositionName" id="x<?php echo $position_ref_grid->RowIndex ?>_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($position_ref_grid->PositionName->getPlaceHolder()) ?>" value="<?php echo $position_ref_grid->PositionName->EditValue ?>"<?php echo $position_ref_grid->PositionName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_PositionName">
<span<?php echo $position_ref_grid->PositionName->viewAttributes() ?>><?php echo $position_ref_grid->PositionName->getViewValue() ?></span>
</span>
<?php if (!$position_ref->isConfirm()) { ?>
<input type="hidden" data-table="position_ref" data-field="x_PositionName" name="x<?php echo $position_ref_grid->RowIndex ?>_PositionName" id="x<?php echo $position_ref_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($position_ref_grid->PositionName->FormValue) ?>">
<input type="hidden" data-table="position_ref" data-field="x_PositionName" name="o<?php echo $position_ref_grid->RowIndex ?>_PositionName" id="o<?php echo $position_ref_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($position_ref_grid->PositionName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="position_ref" data-field="x_PositionName" name="fposition_refgrid$x<?php echo $position_ref_grid->RowIndex ?>_PositionName" id="fposition_refgrid$x<?php echo $position_ref_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($position_ref_grid->PositionName->FormValue) ?>">
<input type="hidden" data-table="position_ref" data-field="x_PositionName" name="fposition_refgrid$o<?php echo $position_ref_grid->RowIndex ?>_PositionName" id="fposition_refgrid$o<?php echo $position_ref_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($position_ref_grid->PositionName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($position_ref_grid->RequisiteQualification->Visible) { // RequisiteQualification ?>
		<td data-name="RequisiteQualification" <?php echo $position_ref_grid->RequisiteQualification->cellAttributes() ?>>
<?php if ($position_ref->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_RequisiteQualification" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_RequisiteQualification" data-value-separator="<?php echo $position_ref_grid->RequisiteQualification->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_grid->RowIndex ?>_RequisiteQualification" name="x<?php echo $position_ref_grid->RowIndex ?>_RequisiteQualification"<?php echo $position_ref_grid->RequisiteQualification->editAttributes() ?>>
			<?php echo $position_ref_grid->RequisiteQualification->selectOptionListHtml("x{$position_ref_grid->RowIndex}_RequisiteQualification") ?>
		</select>
</div>
<?php echo $position_ref_grid->RequisiteQualification->Lookup->getParamTag($position_ref_grid, "p_x" . $position_ref_grid->RowIndex . "_RequisiteQualification") ?>
</span>
<input type="hidden" data-table="position_ref" data-field="x_RequisiteQualification" name="o<?php echo $position_ref_grid->RowIndex ?>_RequisiteQualification" id="o<?php echo $position_ref_grid->RowIndex ?>_RequisiteQualification" value="<?php echo HtmlEncode($position_ref_grid->RequisiteQualification->OldValue) ?>">
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_RequisiteQualification" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_RequisiteQualification" data-value-separator="<?php echo $position_ref_grid->RequisiteQualification->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_grid->RowIndex ?>_RequisiteQualification" name="x<?php echo $position_ref_grid->RowIndex ?>_RequisiteQualification"<?php echo $position_ref_grid->RequisiteQualification->editAttributes() ?>>
			<?php echo $position_ref_grid->RequisiteQualification->selectOptionListHtml("x{$position_ref_grid->RowIndex}_RequisiteQualification") ?>
		</select>
</div>
<?php echo $position_ref_grid->RequisiteQualification->Lookup->getParamTag($position_ref_grid, "p_x" . $position_ref_grid->RowIndex . "_RequisiteQualification") ?>
</span>
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_RequisiteQualification">
<span<?php echo $position_ref_grid->RequisiteQualification->viewAttributes() ?>><?php echo $position_ref_grid->RequisiteQualification->getViewValue() ?></span>
</span>
<?php if (!$position_ref->isConfirm()) { ?>
<input type="hidden" data-table="position_ref" data-field="x_RequisiteQualification" name="x<?php echo $position_ref_grid->RowIndex ?>_RequisiteQualification" id="x<?php echo $position_ref_grid->RowIndex ?>_RequisiteQualification" value="<?php echo HtmlEncode($position_ref_grid->RequisiteQualification->FormValue) ?>">
<input type="hidden" data-table="position_ref" data-field="x_RequisiteQualification" name="o<?php echo $position_ref_grid->RowIndex ?>_RequisiteQualification" id="o<?php echo $position_ref_grid->RowIndex ?>_RequisiteQualification" value="<?php echo HtmlEncode($position_ref_grid->RequisiteQualification->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="position_ref" data-field="x_RequisiteQualification" name="fposition_refgrid$x<?php echo $position_ref_grid->RowIndex ?>_RequisiteQualification" id="fposition_refgrid$x<?php echo $position_ref_grid->RowIndex ?>_RequisiteQualification" value="<?php echo HtmlEncode($position_ref_grid->RequisiteQualification->FormValue) ?>">
<input type="hidden" data-table="position_ref" data-field="x_RequisiteQualification" name="fposition_refgrid$o<?php echo $position_ref_grid->RowIndex ?>_RequisiteQualification" id="fposition_refgrid$o<?php echo $position_ref_grid->RowIndex ?>_RequisiteQualification" value="<?php echo HtmlEncode($position_ref_grid->RequisiteQualification->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($position_ref_grid->JobCode->Visible) { // JobCode ?>
		<td data-name="JobCode" <?php echo $position_ref_grid->JobCode->cellAttributes() ?>>
<?php if ($position_ref->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_JobCode" class="form-group">
<?php
$onchange = $position_ref_grid->JobCode->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$position_ref_grid->JobCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $position_ref_grid->RowIndex ?>_JobCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $position_ref_grid->RowIndex ?>_JobCode" id="sv_x<?php echo $position_ref_grid->RowIndex ?>_JobCode" value="<?php echo RemoveHtml($position_ref_grid->JobCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($position_ref_grid->JobCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($position_ref_grid->JobCode->getPlaceHolder()) ?>"<?php echo $position_ref_grid->JobCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($position_ref_grid->JobCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $position_ref_grid->RowIndex ?>_JobCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($position_ref_grid->JobCode->ReadOnly || $position_ref_grid->JobCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="position_ref" data-field="x_JobCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $position_ref_grid->JobCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $position_ref_grid->RowIndex ?>_JobCode" id="x<?php echo $position_ref_grid->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($position_ref_grid->JobCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fposition_refgrid"], function() {
	fposition_refgrid.createAutoSuggest({"id":"x<?php echo $position_ref_grid->RowIndex ?>_JobCode","forceSelect":true});
});
</script>
<?php echo $position_ref_grid->JobCode->Lookup->getParamTag($position_ref_grid, "p_x" . $position_ref_grid->RowIndex . "_JobCode") ?>
</span>
<input type="hidden" data-table="position_ref" data-field="x_JobCode" name="o<?php echo $position_ref_grid->RowIndex ?>_JobCode" id="o<?php echo $position_ref_grid->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($position_ref_grid->JobCode->OldValue) ?>">
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_JobCode" class="form-group">
<?php
$onchange = $position_ref_grid->JobCode->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$position_ref_grid->JobCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $position_ref_grid->RowIndex ?>_JobCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $position_ref_grid->RowIndex ?>_JobCode" id="sv_x<?php echo $position_ref_grid->RowIndex ?>_JobCode" value="<?php echo RemoveHtml($position_ref_grid->JobCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($position_ref_grid->JobCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($position_ref_grid->JobCode->getPlaceHolder()) ?>"<?php echo $position_ref_grid->JobCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($position_ref_grid->JobCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $position_ref_grid->RowIndex ?>_JobCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($position_ref_grid->JobCode->ReadOnly || $position_ref_grid->JobCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="position_ref" data-field="x_JobCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $position_ref_grid->JobCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $position_ref_grid->RowIndex ?>_JobCode" id="x<?php echo $position_ref_grid->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($position_ref_grid->JobCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fposition_refgrid"], function() {
	fposition_refgrid.createAutoSuggest({"id":"x<?php echo $position_ref_grid->RowIndex ?>_JobCode","forceSelect":true});
});
</script>
<?php echo $position_ref_grid->JobCode->Lookup->getParamTag($position_ref_grid, "p_x" . $position_ref_grid->RowIndex . "_JobCode") ?>
</span>
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_JobCode">
<span<?php echo $position_ref_grid->JobCode->viewAttributes() ?>><?php echo $position_ref_grid->JobCode->getViewValue() ?></span>
</span>
<?php if (!$position_ref->isConfirm()) { ?>
<input type="hidden" data-table="position_ref" data-field="x_JobCode" name="x<?php echo $position_ref_grid->RowIndex ?>_JobCode" id="x<?php echo $position_ref_grid->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($position_ref_grid->JobCode->FormValue) ?>">
<input type="hidden" data-table="position_ref" data-field="x_JobCode" name="o<?php echo $position_ref_grid->RowIndex ?>_JobCode" id="o<?php echo $position_ref_grid->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($position_ref_grid->JobCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="position_ref" data-field="x_JobCode" name="fposition_refgrid$x<?php echo $position_ref_grid->RowIndex ?>_JobCode" id="fposition_refgrid$x<?php echo $position_ref_grid->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($position_ref_grid->JobCode->FormValue) ?>">
<input type="hidden" data-table="position_ref" data-field="x_JobCode" name="fposition_refgrid$o<?php echo $position_ref_grid->RowIndex ?>_JobCode" id="fposition_refgrid$o<?php echo $position_ref_grid->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($position_ref_grid->JobCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($position_ref_grid->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale" <?php echo $position_ref_grid->SalaryScale->cellAttributes() ?>>
<?php if ($position_ref->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_SalaryScale" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_SalaryScale" data-value-separator="<?php echo $position_ref_grid->SalaryScale->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_grid->RowIndex ?>_SalaryScale" name="x<?php echo $position_ref_grid->RowIndex ?>_SalaryScale"<?php echo $position_ref_grid->SalaryScale->editAttributes() ?>>
			<?php echo $position_ref_grid->SalaryScale->selectOptionListHtml("x{$position_ref_grid->RowIndex}_SalaryScale") ?>
		</select>
</div>
<?php echo $position_ref_grid->SalaryScale->Lookup->getParamTag($position_ref_grid, "p_x" . $position_ref_grid->RowIndex . "_SalaryScale") ?>
</span>
<input type="hidden" data-table="position_ref" data-field="x_SalaryScale" name="o<?php echo $position_ref_grid->RowIndex ?>_SalaryScale" id="o<?php echo $position_ref_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($position_ref_grid->SalaryScale->OldValue) ?>">
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_SalaryScale" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_SalaryScale" data-value-separator="<?php echo $position_ref_grid->SalaryScale->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_grid->RowIndex ?>_SalaryScale" name="x<?php echo $position_ref_grid->RowIndex ?>_SalaryScale"<?php echo $position_ref_grid->SalaryScale->editAttributes() ?>>
			<?php echo $position_ref_grid->SalaryScale->selectOptionListHtml("x{$position_ref_grid->RowIndex}_SalaryScale") ?>
		</select>
</div>
<?php echo $position_ref_grid->SalaryScale->Lookup->getParamTag($position_ref_grid, "p_x" . $position_ref_grid->RowIndex . "_SalaryScale") ?>
</span>
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_SalaryScale">
<span<?php echo $position_ref_grid->SalaryScale->viewAttributes() ?>><?php echo $position_ref_grid->SalaryScale->getViewValue() ?></span>
</span>
<?php if (!$position_ref->isConfirm()) { ?>
<input type="hidden" data-table="position_ref" data-field="x_SalaryScale" name="x<?php echo $position_ref_grid->RowIndex ?>_SalaryScale" id="x<?php echo $position_ref_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($position_ref_grid->SalaryScale->FormValue) ?>">
<input type="hidden" data-table="position_ref" data-field="x_SalaryScale" name="o<?php echo $position_ref_grid->RowIndex ?>_SalaryScale" id="o<?php echo $position_ref_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($position_ref_grid->SalaryScale->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="position_ref" data-field="x_SalaryScale" name="fposition_refgrid$x<?php echo $position_ref_grid->RowIndex ?>_SalaryScale" id="fposition_refgrid$x<?php echo $position_ref_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($position_ref_grid->SalaryScale->FormValue) ?>">
<input type="hidden" data-table="position_ref" data-field="x_SalaryScale" name="fposition_refgrid$o<?php echo $position_ref_grid->RowIndex ?>_SalaryScale" id="fposition_refgrid$o<?php echo $position_ref_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($position_ref_grid->SalaryScale->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($position_ref_grid->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $position_ref_grid->ProvinceCode->cellAttributes() ?>>
<?php if ($position_ref->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_ProvinceCode" class="form-group">
<?php $position_ref_grid->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_ProvinceCode" data-value-separator="<?php echo $position_ref_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $position_ref_grid->RowIndex ?>_ProvinceCode"<?php echo $position_ref_grid->ProvinceCode->editAttributes() ?>>
			<?php echo $position_ref_grid->ProvinceCode->selectOptionListHtml("x{$position_ref_grid->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $position_ref_grid->ProvinceCode->Lookup->getParamTag($position_ref_grid, "p_x" . $position_ref_grid->RowIndex . "_ProvinceCode") ?>
</span>
<input type="hidden" data-table="position_ref" data-field="x_ProvinceCode" name="o<?php echo $position_ref_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $position_ref_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($position_ref_grid->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_ProvinceCode" class="form-group">
<?php $position_ref_grid->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_ProvinceCode" data-value-separator="<?php echo $position_ref_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $position_ref_grid->RowIndex ?>_ProvinceCode"<?php echo $position_ref_grid->ProvinceCode->editAttributes() ?>>
			<?php echo $position_ref_grid->ProvinceCode->selectOptionListHtml("x{$position_ref_grid->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $position_ref_grid->ProvinceCode->Lookup->getParamTag($position_ref_grid, "p_x" . $position_ref_grid->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_ProvinceCode">
<span<?php echo $position_ref_grid->ProvinceCode->viewAttributes() ?>><?php echo $position_ref_grid->ProvinceCode->getViewValue() ?></span>
</span>
<?php if (!$position_ref->isConfirm()) { ?>
<input type="hidden" data-table="position_ref" data-field="x_ProvinceCode" name="x<?php echo $position_ref_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $position_ref_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($position_ref_grid->ProvinceCode->FormValue) ?>">
<input type="hidden" data-table="position_ref" data-field="x_ProvinceCode" name="o<?php echo $position_ref_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $position_ref_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($position_ref_grid->ProvinceCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="position_ref" data-field="x_ProvinceCode" name="fposition_refgrid$x<?php echo $position_ref_grid->RowIndex ?>_ProvinceCode" id="fposition_refgrid$x<?php echo $position_ref_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($position_ref_grid->ProvinceCode->FormValue) ?>">
<input type="hidden" data-table="position_ref" data-field="x_ProvinceCode" name="fposition_refgrid$o<?php echo $position_ref_grid->RowIndex ?>_ProvinceCode" id="fposition_refgrid$o<?php echo $position_ref_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($position_ref_grid->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($position_ref_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $position_ref_grid->LACode->cellAttributes() ?>>
<?php if ($position_ref->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_LACode" class="form-group">
<?php $position_ref_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_LACode" data-value-separator="<?php echo $position_ref_grid->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_grid->RowIndex ?>_LACode" name="x<?php echo $position_ref_grid->RowIndex ?>_LACode"<?php echo $position_ref_grid->LACode->editAttributes() ?>>
			<?php echo $position_ref_grid->LACode->selectOptionListHtml("x{$position_ref_grid->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $position_ref_grid->LACode->Lookup->getParamTag($position_ref_grid, "p_x" . $position_ref_grid->RowIndex . "_LACode") ?>
</span>
<input type="hidden" data-table="position_ref" data-field="x_LACode" name="o<?php echo $position_ref_grid->RowIndex ?>_LACode" id="o<?php echo $position_ref_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($position_ref_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_LACode" class="form-group">
<?php $position_ref_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_LACode" data-value-separator="<?php echo $position_ref_grid->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_grid->RowIndex ?>_LACode" name="x<?php echo $position_ref_grid->RowIndex ?>_LACode"<?php echo $position_ref_grid->LACode->editAttributes() ?>>
			<?php echo $position_ref_grid->LACode->selectOptionListHtml("x{$position_ref_grid->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $position_ref_grid->LACode->Lookup->getParamTag($position_ref_grid, "p_x" . $position_ref_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_LACode">
<span<?php echo $position_ref_grid->LACode->viewAttributes() ?>><?php echo $position_ref_grid->LACode->getViewValue() ?></span>
</span>
<?php if (!$position_ref->isConfirm()) { ?>
<input type="hidden" data-table="position_ref" data-field="x_LACode" name="x<?php echo $position_ref_grid->RowIndex ?>_LACode" id="x<?php echo $position_ref_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($position_ref_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="position_ref" data-field="x_LACode" name="o<?php echo $position_ref_grid->RowIndex ?>_LACode" id="o<?php echo $position_ref_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($position_ref_grid->LACode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="position_ref" data-field="x_LACode" name="fposition_refgrid$x<?php echo $position_ref_grid->RowIndex ?>_LACode" id="fposition_refgrid$x<?php echo $position_ref_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($position_ref_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="position_ref" data-field="x_LACode" name="fposition_refgrid$o<?php echo $position_ref_grid->RowIndex ?>_LACode" id="fposition_refgrid$o<?php echo $position_ref_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($position_ref_grid->LACode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($position_ref_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $position_ref_grid->DepartmentCode->cellAttributes() ?>>
<?php if ($position_ref->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_DepartmentCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_DepartmentCode" data-value-separator="<?php echo $position_ref_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $position_ref_grid->RowIndex ?>_DepartmentCode"<?php echo $position_ref_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $position_ref_grid->DepartmentCode->selectOptionListHtml("x{$position_ref_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $position_ref_grid->DepartmentCode->Lookup->getParamTag($position_ref_grid, "p_x" . $position_ref_grid->RowIndex . "_DepartmentCode") ?>
</span>
<input type="hidden" data-table="position_ref" data-field="x_DepartmentCode" name="o<?php echo $position_ref_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $position_ref_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($position_ref_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_DepartmentCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_DepartmentCode" data-value-separator="<?php echo $position_ref_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $position_ref_grid->RowIndex ?>_DepartmentCode"<?php echo $position_ref_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $position_ref_grid->DepartmentCode->selectOptionListHtml("x{$position_ref_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $position_ref_grid->DepartmentCode->Lookup->getParamTag($position_ref_grid, "p_x" . $position_ref_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_DepartmentCode">
<span<?php echo $position_ref_grid->DepartmentCode->viewAttributes() ?>><?php echo $position_ref_grid->DepartmentCode->getViewValue() ?></span>
</span>
<?php if (!$position_ref->isConfirm()) { ?>
<input type="hidden" data-table="position_ref" data-field="x_DepartmentCode" name="x<?php echo $position_ref_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $position_ref_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($position_ref_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="position_ref" data-field="x_DepartmentCode" name="o<?php echo $position_ref_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $position_ref_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($position_ref_grid->DepartmentCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="position_ref" data-field="x_DepartmentCode" name="fposition_refgrid$x<?php echo $position_ref_grid->RowIndex ?>_DepartmentCode" id="fposition_refgrid$x<?php echo $position_ref_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($position_ref_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="position_ref" data-field="x_DepartmentCode" name="fposition_refgrid$o<?php echo $position_ref_grid->RowIndex ?>_DepartmentCode" id="fposition_refgrid$o<?php echo $position_ref_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($position_ref_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($position_ref_grid->FieldQualified->Visible) { // FieldQualified ?>
		<td data-name="FieldQualified" <?php echo $position_ref_grid->FieldQualified->cellAttributes() ?>>
<?php if ($position_ref->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_FieldQualified" class="form-group">
<input type="text" data-table="position_ref" data-field="x_FieldQualified" name="x<?php echo $position_ref_grid->RowIndex ?>_FieldQualified" id="x<?php echo $position_ref_grid->RowIndex ?>_FieldQualified" size="30" placeholder="<?php echo HtmlEncode($position_ref_grid->FieldQualified->getPlaceHolder()) ?>" value="<?php echo $position_ref_grid->FieldQualified->EditValue ?>"<?php echo $position_ref_grid->FieldQualified->editAttributes() ?>>
</span>
<input type="hidden" data-table="position_ref" data-field="x_FieldQualified" name="o<?php echo $position_ref_grid->RowIndex ?>_FieldQualified" id="o<?php echo $position_ref_grid->RowIndex ?>_FieldQualified" value="<?php echo HtmlEncode($position_ref_grid->FieldQualified->OldValue) ?>">
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_FieldQualified" class="form-group">
<input type="text" data-table="position_ref" data-field="x_FieldQualified" name="x<?php echo $position_ref_grid->RowIndex ?>_FieldQualified" id="x<?php echo $position_ref_grid->RowIndex ?>_FieldQualified" size="30" placeholder="<?php echo HtmlEncode($position_ref_grid->FieldQualified->getPlaceHolder()) ?>" value="<?php echo $position_ref_grid->FieldQualified->EditValue ?>"<?php echo $position_ref_grid->FieldQualified->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $position_ref_grid->RowCount ?>_position_ref_FieldQualified">
<span<?php echo $position_ref_grid->FieldQualified->viewAttributes() ?>><?php echo $position_ref_grid->FieldQualified->getViewValue() ?></span>
</span>
<?php if (!$position_ref->isConfirm()) { ?>
<input type="hidden" data-table="position_ref" data-field="x_FieldQualified" name="x<?php echo $position_ref_grid->RowIndex ?>_FieldQualified" id="x<?php echo $position_ref_grid->RowIndex ?>_FieldQualified" value="<?php echo HtmlEncode($position_ref_grid->FieldQualified->FormValue) ?>">
<input type="hidden" data-table="position_ref" data-field="x_FieldQualified" name="o<?php echo $position_ref_grid->RowIndex ?>_FieldQualified" id="o<?php echo $position_ref_grid->RowIndex ?>_FieldQualified" value="<?php echo HtmlEncode($position_ref_grid->FieldQualified->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="position_ref" data-field="x_FieldQualified" name="fposition_refgrid$x<?php echo $position_ref_grid->RowIndex ?>_FieldQualified" id="fposition_refgrid$x<?php echo $position_ref_grid->RowIndex ?>_FieldQualified" value="<?php echo HtmlEncode($position_ref_grid->FieldQualified->FormValue) ?>">
<input type="hidden" data-table="position_ref" data-field="x_FieldQualified" name="fposition_refgrid$o<?php echo $position_ref_grid->RowIndex ?>_FieldQualified" id="fposition_refgrid$o<?php echo $position_ref_grid->RowIndex ?>_FieldQualified" value="<?php echo HtmlEncode($position_ref_grid->FieldQualified->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$position_ref_grid->ListOptions->render("body", "right", $position_ref_grid->RowCount);
?>
	</tr>
<?php if ($position_ref->RowType == ROWTYPE_ADD || $position_ref->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fposition_refgrid", "load"], function() {
	fposition_refgrid.updateLists(<?php echo $position_ref_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$position_ref_grid->isGridAdd() || $position_ref->CurrentMode == "copy")
		if (!$position_ref_grid->Recordset->EOF)
			$position_ref_grid->Recordset->moveNext();
}
?>
<?php
	if ($position_ref->CurrentMode == "add" || $position_ref->CurrentMode == "copy" || $position_ref->CurrentMode == "edit") {
		$position_ref_grid->RowIndex = '$rowindex$';
		$position_ref_grid->loadRowValues();

		// Set row properties
		$position_ref->resetAttributes();
		$position_ref->RowAttrs->merge(["data-rowindex" => $position_ref_grid->RowIndex, "id" => "r0_position_ref", "data-rowtype" => ROWTYPE_ADD]);
		$position_ref->RowAttrs->appendClass("ew-template");
		$position_ref->RowType = ROWTYPE_ADD;

		// Render row
		$position_ref_grid->renderRow();

		// Render list options
		$position_ref_grid->renderListOptions();
		$position_ref_grid->StartRowCount = 0;
?>
	<tr <?php echo $position_ref->rowAttributes() ?>>
<?php

// Render list options (body, left)
$position_ref_grid->ListOptions->render("body", "left", $position_ref_grid->RowIndex);
?>
	<?php if ($position_ref_grid->PositionCode->Visible) { // PositionCode ?>
		<td data-name="PositionCode">
<?php if (!$position_ref->isConfirm()) { ?>
<span id="el$rowindex$_position_ref_PositionCode" class="form-group position_ref_PositionCode"></span>
<?php } else { ?>
<span id="el$rowindex$_position_ref_PositionCode" class="form-group position_ref_PositionCode">
<span<?php echo $position_ref_grid->PositionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($position_ref_grid->PositionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="position_ref" data-field="x_PositionCode" name="x<?php echo $position_ref_grid->RowIndex ?>_PositionCode" id="x<?php echo $position_ref_grid->RowIndex ?>_PositionCode" value="<?php echo HtmlEncode($position_ref_grid->PositionCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="position_ref" data-field="x_PositionCode" name="o<?php echo $position_ref_grid->RowIndex ?>_PositionCode" id="o<?php echo $position_ref_grid->RowIndex ?>_PositionCode" value="<?php echo HtmlEncode($position_ref_grid->PositionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($position_ref_grid->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName">
<?php if (!$position_ref->isConfirm()) { ?>
<span id="el$rowindex$_position_ref_PositionName" class="form-group position_ref_PositionName">
<input type="text" data-table="position_ref" data-field="x_PositionName" name="x<?php echo $position_ref_grid->RowIndex ?>_PositionName" id="x<?php echo $position_ref_grid->RowIndex ?>_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($position_ref_grid->PositionName->getPlaceHolder()) ?>" value="<?php echo $position_ref_grid->PositionName->EditValue ?>"<?php echo $position_ref_grid->PositionName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_position_ref_PositionName" class="form-group position_ref_PositionName">
<span<?php echo $position_ref_grid->PositionName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($position_ref_grid->PositionName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="position_ref" data-field="x_PositionName" name="x<?php echo $position_ref_grid->RowIndex ?>_PositionName" id="x<?php echo $position_ref_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($position_ref_grid->PositionName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="position_ref" data-field="x_PositionName" name="o<?php echo $position_ref_grid->RowIndex ?>_PositionName" id="o<?php echo $position_ref_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($position_ref_grid->PositionName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($position_ref_grid->RequisiteQualification->Visible) { // RequisiteQualification ?>
		<td data-name="RequisiteQualification">
<?php if (!$position_ref->isConfirm()) { ?>
<span id="el$rowindex$_position_ref_RequisiteQualification" class="form-group position_ref_RequisiteQualification">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_RequisiteQualification" data-value-separator="<?php echo $position_ref_grid->RequisiteQualification->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_grid->RowIndex ?>_RequisiteQualification" name="x<?php echo $position_ref_grid->RowIndex ?>_RequisiteQualification"<?php echo $position_ref_grid->RequisiteQualification->editAttributes() ?>>
			<?php echo $position_ref_grid->RequisiteQualification->selectOptionListHtml("x{$position_ref_grid->RowIndex}_RequisiteQualification") ?>
		</select>
</div>
<?php echo $position_ref_grid->RequisiteQualification->Lookup->getParamTag($position_ref_grid, "p_x" . $position_ref_grid->RowIndex . "_RequisiteQualification") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_position_ref_RequisiteQualification" class="form-group position_ref_RequisiteQualification">
<span<?php echo $position_ref_grid->RequisiteQualification->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($position_ref_grid->RequisiteQualification->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="position_ref" data-field="x_RequisiteQualification" name="x<?php echo $position_ref_grid->RowIndex ?>_RequisiteQualification" id="x<?php echo $position_ref_grid->RowIndex ?>_RequisiteQualification" value="<?php echo HtmlEncode($position_ref_grid->RequisiteQualification->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="position_ref" data-field="x_RequisiteQualification" name="o<?php echo $position_ref_grid->RowIndex ?>_RequisiteQualification" id="o<?php echo $position_ref_grid->RowIndex ?>_RequisiteQualification" value="<?php echo HtmlEncode($position_ref_grid->RequisiteQualification->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($position_ref_grid->JobCode->Visible) { // JobCode ?>
		<td data-name="JobCode">
<?php if (!$position_ref->isConfirm()) { ?>
<span id="el$rowindex$_position_ref_JobCode" class="form-group position_ref_JobCode">
<?php
$onchange = $position_ref_grid->JobCode->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$position_ref_grid->JobCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $position_ref_grid->RowIndex ?>_JobCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $position_ref_grid->RowIndex ?>_JobCode" id="sv_x<?php echo $position_ref_grid->RowIndex ?>_JobCode" value="<?php echo RemoveHtml($position_ref_grid->JobCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($position_ref_grid->JobCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($position_ref_grid->JobCode->getPlaceHolder()) ?>"<?php echo $position_ref_grid->JobCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($position_ref_grid->JobCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $position_ref_grid->RowIndex ?>_JobCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($position_ref_grid->JobCode->ReadOnly || $position_ref_grid->JobCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="position_ref" data-field="x_JobCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $position_ref_grid->JobCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $position_ref_grid->RowIndex ?>_JobCode" id="x<?php echo $position_ref_grid->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($position_ref_grid->JobCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fposition_refgrid"], function() {
	fposition_refgrid.createAutoSuggest({"id":"x<?php echo $position_ref_grid->RowIndex ?>_JobCode","forceSelect":true});
});
</script>
<?php echo $position_ref_grid->JobCode->Lookup->getParamTag($position_ref_grid, "p_x" . $position_ref_grid->RowIndex . "_JobCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_position_ref_JobCode" class="form-group position_ref_JobCode">
<span<?php echo $position_ref_grid->JobCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($position_ref_grid->JobCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="position_ref" data-field="x_JobCode" name="x<?php echo $position_ref_grid->RowIndex ?>_JobCode" id="x<?php echo $position_ref_grid->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($position_ref_grid->JobCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="position_ref" data-field="x_JobCode" name="o<?php echo $position_ref_grid->RowIndex ?>_JobCode" id="o<?php echo $position_ref_grid->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($position_ref_grid->JobCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($position_ref_grid->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale">
<?php if (!$position_ref->isConfirm()) { ?>
<span id="el$rowindex$_position_ref_SalaryScale" class="form-group position_ref_SalaryScale">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_SalaryScale" data-value-separator="<?php echo $position_ref_grid->SalaryScale->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_grid->RowIndex ?>_SalaryScale" name="x<?php echo $position_ref_grid->RowIndex ?>_SalaryScale"<?php echo $position_ref_grid->SalaryScale->editAttributes() ?>>
			<?php echo $position_ref_grid->SalaryScale->selectOptionListHtml("x{$position_ref_grid->RowIndex}_SalaryScale") ?>
		</select>
</div>
<?php echo $position_ref_grid->SalaryScale->Lookup->getParamTag($position_ref_grid, "p_x" . $position_ref_grid->RowIndex . "_SalaryScale") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_position_ref_SalaryScale" class="form-group position_ref_SalaryScale">
<span<?php echo $position_ref_grid->SalaryScale->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($position_ref_grid->SalaryScale->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="position_ref" data-field="x_SalaryScale" name="x<?php echo $position_ref_grid->RowIndex ?>_SalaryScale" id="x<?php echo $position_ref_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($position_ref_grid->SalaryScale->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="position_ref" data-field="x_SalaryScale" name="o<?php echo $position_ref_grid->RowIndex ?>_SalaryScale" id="o<?php echo $position_ref_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($position_ref_grid->SalaryScale->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($position_ref_grid->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode">
<?php if (!$position_ref->isConfirm()) { ?>
<span id="el$rowindex$_position_ref_ProvinceCode" class="form-group position_ref_ProvinceCode">
<?php $position_ref_grid->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_ProvinceCode" data-value-separator="<?php echo $position_ref_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $position_ref_grid->RowIndex ?>_ProvinceCode"<?php echo $position_ref_grid->ProvinceCode->editAttributes() ?>>
			<?php echo $position_ref_grid->ProvinceCode->selectOptionListHtml("x{$position_ref_grid->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $position_ref_grid->ProvinceCode->Lookup->getParamTag($position_ref_grid, "p_x" . $position_ref_grid->RowIndex . "_ProvinceCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_position_ref_ProvinceCode" class="form-group position_ref_ProvinceCode">
<span<?php echo $position_ref_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($position_ref_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="position_ref" data-field="x_ProvinceCode" name="x<?php echo $position_ref_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $position_ref_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($position_ref_grid->ProvinceCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="position_ref" data-field="x_ProvinceCode" name="o<?php echo $position_ref_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $position_ref_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($position_ref_grid->ProvinceCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($position_ref_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if (!$position_ref->isConfirm()) { ?>
<span id="el$rowindex$_position_ref_LACode" class="form-group position_ref_LACode">
<?php $position_ref_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_LACode" data-value-separator="<?php echo $position_ref_grid->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_grid->RowIndex ?>_LACode" name="x<?php echo $position_ref_grid->RowIndex ?>_LACode"<?php echo $position_ref_grid->LACode->editAttributes() ?>>
			<?php echo $position_ref_grid->LACode->selectOptionListHtml("x{$position_ref_grid->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $position_ref_grid->LACode->Lookup->getParamTag($position_ref_grid, "p_x" . $position_ref_grid->RowIndex . "_LACode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_position_ref_LACode" class="form-group position_ref_LACode">
<span<?php echo $position_ref_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($position_ref_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="position_ref" data-field="x_LACode" name="x<?php echo $position_ref_grid->RowIndex ?>_LACode" id="x<?php echo $position_ref_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($position_ref_grid->LACode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="position_ref" data-field="x_LACode" name="o<?php echo $position_ref_grid->RowIndex ?>_LACode" id="o<?php echo $position_ref_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($position_ref_grid->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($position_ref_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<?php if (!$position_ref->isConfirm()) { ?>
<span id="el$rowindex$_position_ref_DepartmentCode" class="form-group position_ref_DepartmentCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_DepartmentCode" data-value-separator="<?php echo $position_ref_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $position_ref_grid->RowIndex ?>_DepartmentCode"<?php echo $position_ref_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $position_ref_grid->DepartmentCode->selectOptionListHtml("x{$position_ref_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $position_ref_grid->DepartmentCode->Lookup->getParamTag($position_ref_grid, "p_x" . $position_ref_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_position_ref_DepartmentCode" class="form-group position_ref_DepartmentCode">
<span<?php echo $position_ref_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($position_ref_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="position_ref" data-field="x_DepartmentCode" name="x<?php echo $position_ref_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $position_ref_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($position_ref_grid->DepartmentCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="position_ref" data-field="x_DepartmentCode" name="o<?php echo $position_ref_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $position_ref_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($position_ref_grid->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($position_ref_grid->FieldQualified->Visible) { // FieldQualified ?>
		<td data-name="FieldQualified">
<?php if (!$position_ref->isConfirm()) { ?>
<span id="el$rowindex$_position_ref_FieldQualified" class="form-group position_ref_FieldQualified">
<input type="text" data-table="position_ref" data-field="x_FieldQualified" name="x<?php echo $position_ref_grid->RowIndex ?>_FieldQualified" id="x<?php echo $position_ref_grid->RowIndex ?>_FieldQualified" size="30" placeholder="<?php echo HtmlEncode($position_ref_grid->FieldQualified->getPlaceHolder()) ?>" value="<?php echo $position_ref_grid->FieldQualified->EditValue ?>"<?php echo $position_ref_grid->FieldQualified->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_position_ref_FieldQualified" class="form-group position_ref_FieldQualified">
<span<?php echo $position_ref_grid->FieldQualified->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($position_ref_grid->FieldQualified->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="position_ref" data-field="x_FieldQualified" name="x<?php echo $position_ref_grid->RowIndex ?>_FieldQualified" id="x<?php echo $position_ref_grid->RowIndex ?>_FieldQualified" value="<?php echo HtmlEncode($position_ref_grid->FieldQualified->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="position_ref" data-field="x_FieldQualified" name="o<?php echo $position_ref_grid->RowIndex ?>_FieldQualified" id="o<?php echo $position_ref_grid->RowIndex ?>_FieldQualified" value="<?php echo HtmlEncode($position_ref_grid->FieldQualified->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$position_ref_grid->ListOptions->render("body", "right", $position_ref_grid->RowIndex);
?>
<script>
loadjs.ready(["fposition_refgrid", "load"], function() {
	fposition_refgrid.updateLists(<?php echo $position_ref_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($position_ref->CurrentMode == "add" || $position_ref->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $position_ref_grid->FormKeyCountName ?>" id="<?php echo $position_ref_grid->FormKeyCountName ?>" value="<?php echo $position_ref_grid->KeyCount ?>">
<?php echo $position_ref_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($position_ref->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $position_ref_grid->FormKeyCountName ?>" id="<?php echo $position_ref_grid->FormKeyCountName ?>" value="<?php echo $position_ref_grid->KeyCount ?>">
<?php echo $position_ref_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($position_ref->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fposition_refgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($position_ref_grid->Recordset)
	$position_ref_grid->Recordset->Close();
?>
<?php if ($position_ref_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $position_ref_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($position_ref_grid->TotalRecords == 0 && !$position_ref->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $position_ref_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$position_ref_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$position_ref_grid->terminate();
?>