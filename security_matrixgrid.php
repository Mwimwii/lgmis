<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($security_matrix_grid))
	$security_matrix_grid = new security_matrix_grid();

// Run the page
$security_matrix_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$security_matrix_grid->Page_Render();
?>
<?php if (!$security_matrix_grid->isExport()) { ?>
<script>
var fsecurity_matrixgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fsecurity_matrixgrid = new ew.Form("fsecurity_matrixgrid", "grid");
	fsecurity_matrixgrid.formKeyCountName = '<?php echo $security_matrix_grid->FormKeyCountName ?>';

	// Validate form
	fsecurity_matrixgrid.validate = function() {
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
			<?php if ($security_matrix_grid->UserCode->Required) { ?>
				elm = this.getElements("x" + infix + "_UserCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_grid->UserCode->caption(), $security_matrix_grid->UserCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_UserCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($security_matrix_grid->UserCode->errorMessage()) ?>");
			<?php if ($security_matrix_grid->PeriodCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_grid->PeriodCode->caption(), $security_matrix_grid->PeriodCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PeriodCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($security_matrix_grid->PeriodCode->errorMessage()) ?>");
			<?php if ($security_matrix_grid->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_grid->ProvinceCode->caption(), $security_matrix_grid->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($security_matrix_grid->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_grid->LACode->caption(), $security_matrix_grid->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($security_matrix_grid->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_grid->DepartmentCode->caption(), $security_matrix_grid->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($security_matrix_grid->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_grid->SectionCode->caption(), $security_matrix_grid->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($security_matrix_grid->SecurityNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_SecurityNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_grid->SecurityNumber->caption(), $security_matrix_grid->SecurityNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($security_matrix_grid->ValidFrom->Required) { ?>
				elm = this.getElements("x" + infix + "_ValidFrom");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_grid->ValidFrom->caption(), $security_matrix_grid->ValidFrom->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ValidFrom");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($security_matrix_grid->ValidFrom->errorMessage()) ?>");
			<?php if ($security_matrix_grid->ValidTo->Required) { ?>
				elm = this.getElements("x" + infix + "_ValidTo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_grid->ValidTo->caption(), $security_matrix_grid->ValidTo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ValidTo");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($security_matrix_grid->ValidTo->errorMessage()) ?>");
			<?php if ($security_matrix_grid->ApproveLevel->Required) { ?>
				elm = this.getElements("x" + infix + "_ApproveLevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_grid->ApproveLevel->caption(), $security_matrix_grid->ApproveLevel->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ApproveLevel");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($security_matrix_grid->ApproveLevel->errorMessage()) ?>");
			<?php if ($security_matrix_grid->ActivityCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ActivityCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $security_matrix_grid->ActivityCode->caption(), $security_matrix_grid->ActivityCode->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fsecurity_matrixgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "UserCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "PeriodCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProvinceCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SectionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ValidFrom", false)) return false;
		if (ew.valueChanged(fobj, infix, "ValidTo", false)) return false;
		if (ew.valueChanged(fobj, infix, "ApproveLevel", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActivityCode", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fsecurity_matrixgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsecurity_matrixgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fsecurity_matrixgrid.lists["x_ProvinceCode"] = <?php echo $security_matrix_grid->ProvinceCode->Lookup->toClientList($security_matrix_grid) ?>;
	fsecurity_matrixgrid.lists["x_ProvinceCode"].options = <?php echo JsonEncode($security_matrix_grid->ProvinceCode->lookupOptions()) ?>;
	fsecurity_matrixgrid.lists["x_LACode"] = <?php echo $security_matrix_grid->LACode->Lookup->toClientList($security_matrix_grid) ?>;
	fsecurity_matrixgrid.lists["x_LACode"].options = <?php echo JsonEncode($security_matrix_grid->LACode->lookupOptions()) ?>;
	fsecurity_matrixgrid.lists["x_DepartmentCode"] = <?php echo $security_matrix_grid->DepartmentCode->Lookup->toClientList($security_matrix_grid) ?>;
	fsecurity_matrixgrid.lists["x_DepartmentCode"].options = <?php echo JsonEncode($security_matrix_grid->DepartmentCode->lookupOptions()) ?>;
	fsecurity_matrixgrid.lists["x_SectionCode"] = <?php echo $security_matrix_grid->SectionCode->Lookup->toClientList($security_matrix_grid) ?>;
	fsecurity_matrixgrid.lists["x_SectionCode"].options = <?php echo JsonEncode($security_matrix_grid->SectionCode->lookupOptions()) ?>;
	loadjs.done("fsecurity_matrixgrid");
});
</script>
<?php } ?>
<?php
$security_matrix_grid->renderOtherOptions();
?>
<?php if ($security_matrix_grid->TotalRecords > 0 || $security_matrix->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($security_matrix_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> security_matrix">
<?php if ($security_matrix_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $security_matrix_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fsecurity_matrixgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_security_matrix" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_security_matrixgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$security_matrix->RowType = ROWTYPE_HEADER;

// Render list options
$security_matrix_grid->renderListOptions();

// Render list options (header, left)
$security_matrix_grid->ListOptions->render("header", "left");
?>
<?php if ($security_matrix_grid->UserCode->Visible) { // UserCode ?>
	<?php if ($security_matrix_grid->SortUrl($security_matrix_grid->UserCode) == "") { ?>
		<th data-name="UserCode" class="<?php echo $security_matrix_grid->UserCode->headerCellClass() ?>"><div id="elh_security_matrix_UserCode" class="security_matrix_UserCode"><div class="ew-table-header-caption"><?php echo $security_matrix_grid->UserCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UserCode" class="<?php echo $security_matrix_grid->UserCode->headerCellClass() ?>"><div><div id="elh_security_matrix_UserCode" class="security_matrix_UserCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_grid->UserCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_grid->UserCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_grid->UserCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_grid->PeriodCode->Visible) { // PeriodCode ?>
	<?php if ($security_matrix_grid->SortUrl($security_matrix_grid->PeriodCode) == "") { ?>
		<th data-name="PeriodCode" class="<?php echo $security_matrix_grid->PeriodCode->headerCellClass() ?>"><div id="elh_security_matrix_PeriodCode" class="security_matrix_PeriodCode"><div class="ew-table-header-caption"><?php echo $security_matrix_grid->PeriodCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodCode" class="<?php echo $security_matrix_grid->PeriodCode->headerCellClass() ?>"><div><div id="elh_security_matrix_PeriodCode" class="security_matrix_PeriodCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_grid->PeriodCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_grid->PeriodCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_grid->PeriodCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_grid->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($security_matrix_grid->SortUrl($security_matrix_grid->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $security_matrix_grid->ProvinceCode->headerCellClass() ?>"><div id="elh_security_matrix_ProvinceCode" class="security_matrix_ProvinceCode"><div class="ew-table-header-caption"><?php echo $security_matrix_grid->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $security_matrix_grid->ProvinceCode->headerCellClass() ?>"><div><div id="elh_security_matrix_ProvinceCode" class="security_matrix_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_grid->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_grid->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_grid->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_grid->LACode->Visible) { // LACode ?>
	<?php if ($security_matrix_grid->SortUrl($security_matrix_grid->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $security_matrix_grid->LACode->headerCellClass() ?>"><div id="elh_security_matrix_LACode" class="security_matrix_LACode"><div class="ew-table-header-caption"><?php echo $security_matrix_grid->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $security_matrix_grid->LACode->headerCellClass() ?>"><div><div id="elh_security_matrix_LACode" class="security_matrix_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_grid->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_grid->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_grid->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_grid->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($security_matrix_grid->SortUrl($security_matrix_grid->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $security_matrix_grid->DepartmentCode->headerCellClass() ?>"><div id="elh_security_matrix_DepartmentCode" class="security_matrix_DepartmentCode"><div class="ew-table-header-caption"><?php echo $security_matrix_grid->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $security_matrix_grid->DepartmentCode->headerCellClass() ?>"><div><div id="elh_security_matrix_DepartmentCode" class="security_matrix_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_grid->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_grid->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_grid->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_grid->SectionCode->Visible) { // SectionCode ?>
	<?php if ($security_matrix_grid->SortUrl($security_matrix_grid->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $security_matrix_grid->SectionCode->headerCellClass() ?>"><div id="elh_security_matrix_SectionCode" class="security_matrix_SectionCode"><div class="ew-table-header-caption"><?php echo $security_matrix_grid->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $security_matrix_grid->SectionCode->headerCellClass() ?>"><div><div id="elh_security_matrix_SectionCode" class="security_matrix_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_grid->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_grid->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_grid->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_grid->SecurityNumber->Visible) { // SecurityNumber ?>
	<?php if ($security_matrix_grid->SortUrl($security_matrix_grid->SecurityNumber) == "") { ?>
		<th data-name="SecurityNumber" class="<?php echo $security_matrix_grid->SecurityNumber->headerCellClass() ?>"><div id="elh_security_matrix_SecurityNumber" class="security_matrix_SecurityNumber"><div class="ew-table-header-caption"><?php echo $security_matrix_grid->SecurityNumber->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SecurityNumber" class="<?php echo $security_matrix_grid->SecurityNumber->headerCellClass() ?>"><div><div id="elh_security_matrix_SecurityNumber" class="security_matrix_SecurityNumber">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_grid->SecurityNumber->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_grid->SecurityNumber->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_grid->SecurityNumber->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_grid->ValidFrom->Visible) { // ValidFrom ?>
	<?php if ($security_matrix_grid->SortUrl($security_matrix_grid->ValidFrom) == "") { ?>
		<th data-name="ValidFrom" class="<?php echo $security_matrix_grid->ValidFrom->headerCellClass() ?>"><div id="elh_security_matrix_ValidFrom" class="security_matrix_ValidFrom"><div class="ew-table-header-caption"><?php echo $security_matrix_grid->ValidFrom->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ValidFrom" class="<?php echo $security_matrix_grid->ValidFrom->headerCellClass() ?>"><div><div id="elh_security_matrix_ValidFrom" class="security_matrix_ValidFrom">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_grid->ValidFrom->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_grid->ValidFrom->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_grid->ValidFrom->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_grid->ValidTo->Visible) { // ValidTo ?>
	<?php if ($security_matrix_grid->SortUrl($security_matrix_grid->ValidTo) == "") { ?>
		<th data-name="ValidTo" class="<?php echo $security_matrix_grid->ValidTo->headerCellClass() ?>"><div id="elh_security_matrix_ValidTo" class="security_matrix_ValidTo"><div class="ew-table-header-caption"><?php echo $security_matrix_grid->ValidTo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ValidTo" class="<?php echo $security_matrix_grid->ValidTo->headerCellClass() ?>"><div><div id="elh_security_matrix_ValidTo" class="security_matrix_ValidTo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_grid->ValidTo->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_grid->ValidTo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_grid->ValidTo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_grid->ApproveLevel->Visible) { // ApproveLevel ?>
	<?php if ($security_matrix_grid->SortUrl($security_matrix_grid->ApproveLevel) == "") { ?>
		<th data-name="ApproveLevel" class="<?php echo $security_matrix_grid->ApproveLevel->headerCellClass() ?>"><div id="elh_security_matrix_ApproveLevel" class="security_matrix_ApproveLevel"><div class="ew-table-header-caption"><?php echo $security_matrix_grid->ApproveLevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ApproveLevel" class="<?php echo $security_matrix_grid->ApproveLevel->headerCellClass() ?>"><div><div id="elh_security_matrix_ApproveLevel" class="security_matrix_ApproveLevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_grid->ApproveLevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_grid->ApproveLevel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_grid->ApproveLevel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_grid->ActivityCode->Visible) { // ActivityCode ?>
	<?php if ($security_matrix_grid->SortUrl($security_matrix_grid->ActivityCode) == "") { ?>
		<th data-name="ActivityCode" class="<?php echo $security_matrix_grid->ActivityCode->headerCellClass() ?>"><div id="elh_security_matrix_ActivityCode" class="security_matrix_ActivityCode"><div class="ew-table-header-caption"><?php echo $security_matrix_grid->ActivityCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActivityCode" class="<?php echo $security_matrix_grid->ActivityCode->headerCellClass() ?>"><div><div id="elh_security_matrix_ActivityCode" class="security_matrix_ActivityCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_grid->ActivityCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_grid->ActivityCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_grid->ActivityCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$security_matrix_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$security_matrix_grid->StartRecord = 1;
$security_matrix_grid->StopRecord = $security_matrix_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($security_matrix->isConfirm() || $security_matrix_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($security_matrix_grid->FormKeyCountName) && ($security_matrix_grid->isGridAdd() || $security_matrix_grid->isGridEdit() || $security_matrix->isConfirm())) {
		$security_matrix_grid->KeyCount = $CurrentForm->getValue($security_matrix_grid->FormKeyCountName);
		$security_matrix_grid->StopRecord = $security_matrix_grid->StartRecord + $security_matrix_grid->KeyCount - 1;
	}
}
$security_matrix_grid->RecordCount = $security_matrix_grid->StartRecord - 1;
if ($security_matrix_grid->Recordset && !$security_matrix_grid->Recordset->EOF) {
	$security_matrix_grid->Recordset->moveFirst();
	$selectLimit = $security_matrix_grid->UseSelectLimit;
	if (!$selectLimit && $security_matrix_grid->StartRecord > 1)
		$security_matrix_grid->Recordset->move($security_matrix_grid->StartRecord - 1);
} elseif (!$security_matrix->AllowAddDeleteRow && $security_matrix_grid->StopRecord == 0) {
	$security_matrix_grid->StopRecord = $security_matrix->GridAddRowCount;
}

// Initialize aggregate
$security_matrix->RowType = ROWTYPE_AGGREGATEINIT;
$security_matrix->resetAttributes();
$security_matrix_grid->renderRow();
if ($security_matrix_grid->isGridAdd())
	$security_matrix_grid->RowIndex = 0;
if ($security_matrix_grid->isGridEdit())
	$security_matrix_grid->RowIndex = 0;
while ($security_matrix_grid->RecordCount < $security_matrix_grid->StopRecord) {
	$security_matrix_grid->RecordCount++;
	if ($security_matrix_grid->RecordCount >= $security_matrix_grid->StartRecord) {
		$security_matrix_grid->RowCount++;
		if ($security_matrix_grid->isGridAdd() || $security_matrix_grid->isGridEdit() || $security_matrix->isConfirm()) {
			$security_matrix_grid->RowIndex++;
			$CurrentForm->Index = $security_matrix_grid->RowIndex;
			if ($CurrentForm->hasValue($security_matrix_grid->FormActionName) && ($security_matrix->isConfirm() || $security_matrix_grid->EventCancelled))
				$security_matrix_grid->RowAction = strval($CurrentForm->getValue($security_matrix_grid->FormActionName));
			elseif ($security_matrix_grid->isGridAdd())
				$security_matrix_grid->RowAction = "insert";
			else
				$security_matrix_grid->RowAction = "";
		}

		// Set up key count
		$security_matrix_grid->KeyCount = $security_matrix_grid->RowIndex;

		// Init row class and style
		$security_matrix->resetAttributes();
		$security_matrix->CssClass = "";
		if ($security_matrix_grid->isGridAdd()) {
			if ($security_matrix->CurrentMode == "copy") {
				$security_matrix_grid->loadRowValues($security_matrix_grid->Recordset); // Load row values
				$security_matrix_grid->setRecordKey($security_matrix_grid->RowOldKey, $security_matrix_grid->Recordset); // Set old record key
			} else {
				$security_matrix_grid->loadRowValues(); // Load default values
				$security_matrix_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$security_matrix_grid->loadRowValues($security_matrix_grid->Recordset); // Load row values
		}
		$security_matrix->RowType = ROWTYPE_VIEW; // Render view
		if ($security_matrix_grid->isGridAdd()) // Grid add
			$security_matrix->RowType = ROWTYPE_ADD; // Render add
		if ($security_matrix_grid->isGridAdd() && $security_matrix->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$security_matrix_grid->restoreCurrentRowFormValues($security_matrix_grid->RowIndex); // Restore form values
		if ($security_matrix_grid->isGridEdit()) { // Grid edit
			if ($security_matrix->EventCancelled)
				$security_matrix_grid->restoreCurrentRowFormValues($security_matrix_grid->RowIndex); // Restore form values
			if ($security_matrix_grid->RowAction == "insert")
				$security_matrix->RowType = ROWTYPE_ADD; // Render add
			else
				$security_matrix->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($security_matrix_grid->isGridEdit() && ($security_matrix->RowType == ROWTYPE_EDIT || $security_matrix->RowType == ROWTYPE_ADD) && $security_matrix->EventCancelled) // Update failed
			$security_matrix_grid->restoreCurrentRowFormValues($security_matrix_grid->RowIndex); // Restore form values
		if ($security_matrix->RowType == ROWTYPE_EDIT) // Edit row
			$security_matrix_grid->EditRowCount++;
		if ($security_matrix->isConfirm()) // Confirm row
			$security_matrix_grid->restoreCurrentRowFormValues($security_matrix_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$security_matrix->RowAttrs->merge(["data-rowindex" => $security_matrix_grid->RowCount, "id" => "r" . $security_matrix_grid->RowCount . "_security_matrix", "data-rowtype" => $security_matrix->RowType]);

		// Render row
		$security_matrix_grid->renderRow();

		// Render list options
		$security_matrix_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($security_matrix_grid->RowAction != "delete" && $security_matrix_grid->RowAction != "insertdelete" && !($security_matrix_grid->RowAction == "insert" && $security_matrix->isConfirm() && $security_matrix_grid->emptyRow())) {
?>
	<tr <?php echo $security_matrix->rowAttributes() ?>>
<?php

// Render list options (body, left)
$security_matrix_grid->ListOptions->render("body", "left", $security_matrix_grid->RowCount);
?>
	<?php if ($security_matrix_grid->UserCode->Visible) { // UserCode ?>
		<td data-name="UserCode" <?php echo $security_matrix_grid->UserCode->cellAttributes() ?>>
<?php if ($security_matrix->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($security_matrix_grid->UserCode->getSessionValue() != "") { ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_UserCode" class="form-group">
<span<?php echo $security_matrix_grid->UserCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($security_matrix_grid->UserCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $security_matrix_grid->RowIndex ?>_UserCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_UserCode" value="<?php echo HtmlEncode($security_matrix_grid->UserCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_UserCode" class="form-group">
<input type="text" data-table="security_matrix" data-field="x_UserCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_UserCode" id="x<?php echo $security_matrix_grid->RowIndex ?>_UserCode" size="30" placeholder="<?php echo HtmlEncode($security_matrix_grid->UserCode->getPlaceHolder()) ?>" value="<?php echo $security_matrix_grid->UserCode->EditValue ?>"<?php echo $security_matrix_grid->UserCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="security_matrix" data-field="x_UserCode" name="o<?php echo $security_matrix_grid->RowIndex ?>_UserCode" id="o<?php echo $security_matrix_grid->RowIndex ?>_UserCode" value="<?php echo HtmlEncode($security_matrix_grid->UserCode->OldValue) ?>">
<?php } ?>
<?php if ($security_matrix->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($security_matrix_grid->UserCode->getSessionValue() != "") { ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_UserCode" class="form-group">
<span<?php echo $security_matrix_grid->UserCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($security_matrix_grid->UserCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $security_matrix_grid->RowIndex ?>_UserCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_UserCode" value="<?php echo HtmlEncode($security_matrix_grid->UserCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_UserCode" class="form-group">
<input type="text" data-table="security_matrix" data-field="x_UserCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_UserCode" id="x<?php echo $security_matrix_grid->RowIndex ?>_UserCode" size="30" placeholder="<?php echo HtmlEncode($security_matrix_grid->UserCode->getPlaceHolder()) ?>" value="<?php echo $security_matrix_grid->UserCode->EditValue ?>"<?php echo $security_matrix_grid->UserCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($security_matrix->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_UserCode">
<span<?php echo $security_matrix_grid->UserCode->viewAttributes() ?>><?php echo $security_matrix_grid->UserCode->getViewValue() ?></span>
</span>
<?php if (!$security_matrix->isConfirm()) { ?>
<input type="hidden" data-table="security_matrix" data-field="x_UserCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_UserCode" id="x<?php echo $security_matrix_grid->RowIndex ?>_UserCode" value="<?php echo HtmlEncode($security_matrix_grid->UserCode->FormValue) ?>">
<input type="hidden" data-table="security_matrix" data-field="x_UserCode" name="o<?php echo $security_matrix_grid->RowIndex ?>_UserCode" id="o<?php echo $security_matrix_grid->RowIndex ?>_UserCode" value="<?php echo HtmlEncode($security_matrix_grid->UserCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="security_matrix" data-field="x_UserCode" name="fsecurity_matrixgrid$x<?php echo $security_matrix_grid->RowIndex ?>_UserCode" id="fsecurity_matrixgrid$x<?php echo $security_matrix_grid->RowIndex ?>_UserCode" value="<?php echo HtmlEncode($security_matrix_grid->UserCode->FormValue) ?>">
<input type="hidden" data-table="security_matrix" data-field="x_UserCode" name="fsecurity_matrixgrid$o<?php echo $security_matrix_grid->RowIndex ?>_UserCode" id="fsecurity_matrixgrid$o<?php echo $security_matrix_grid->RowIndex ?>_UserCode" value="<?php echo HtmlEncode($security_matrix_grid->UserCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($security_matrix_grid->PeriodCode->Visible) { // PeriodCode ?>
		<td data-name="PeriodCode" <?php echo $security_matrix_grid->PeriodCode->cellAttributes() ?>>
<?php if ($security_matrix->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_PeriodCode" class="form-group">
<input type="text" data-table="security_matrix" data-field="x_PeriodCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_PeriodCode" id="x<?php echo $security_matrix_grid->RowIndex ?>_PeriodCode" size="30" placeholder="<?php echo HtmlEncode($security_matrix_grid->PeriodCode->getPlaceHolder()) ?>" value="<?php echo $security_matrix_grid->PeriodCode->EditValue ?>"<?php echo $security_matrix_grid->PeriodCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="security_matrix" data-field="x_PeriodCode" name="o<?php echo $security_matrix_grid->RowIndex ?>_PeriodCode" id="o<?php echo $security_matrix_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($security_matrix_grid->PeriodCode->OldValue) ?>">
<?php } ?>
<?php if ($security_matrix->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_PeriodCode" class="form-group">
<input type="text" data-table="security_matrix" data-field="x_PeriodCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_PeriodCode" id="x<?php echo $security_matrix_grid->RowIndex ?>_PeriodCode" size="30" placeholder="<?php echo HtmlEncode($security_matrix_grid->PeriodCode->getPlaceHolder()) ?>" value="<?php echo $security_matrix_grid->PeriodCode->EditValue ?>"<?php echo $security_matrix_grid->PeriodCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($security_matrix->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_PeriodCode">
<span<?php echo $security_matrix_grid->PeriodCode->viewAttributes() ?>><?php echo $security_matrix_grid->PeriodCode->getViewValue() ?></span>
</span>
<?php if (!$security_matrix->isConfirm()) { ?>
<input type="hidden" data-table="security_matrix" data-field="x_PeriodCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_PeriodCode" id="x<?php echo $security_matrix_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($security_matrix_grid->PeriodCode->FormValue) ?>">
<input type="hidden" data-table="security_matrix" data-field="x_PeriodCode" name="o<?php echo $security_matrix_grid->RowIndex ?>_PeriodCode" id="o<?php echo $security_matrix_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($security_matrix_grid->PeriodCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="security_matrix" data-field="x_PeriodCode" name="fsecurity_matrixgrid$x<?php echo $security_matrix_grid->RowIndex ?>_PeriodCode" id="fsecurity_matrixgrid$x<?php echo $security_matrix_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($security_matrix_grid->PeriodCode->FormValue) ?>">
<input type="hidden" data-table="security_matrix" data-field="x_PeriodCode" name="fsecurity_matrixgrid$o<?php echo $security_matrix_grid->RowIndex ?>_PeriodCode" id="fsecurity_matrixgrid$o<?php echo $security_matrix_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($security_matrix_grid->PeriodCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($security_matrix_grid->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $security_matrix_grid->ProvinceCode->cellAttributes() ?>>
<?php if ($security_matrix->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_ProvinceCode" class="form-group">
<?php $security_matrix_grid->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="security_matrix" data-field="x_ProvinceCode" data-value-separator="<?php echo $security_matrix_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $security_matrix_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_ProvinceCode"<?php echo $security_matrix_grid->ProvinceCode->editAttributes() ?>>
			<?php echo $security_matrix_grid->ProvinceCode->selectOptionListHtml("x{$security_matrix_grid->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $security_matrix_grid->ProvinceCode->Lookup->getParamTag($security_matrix_grid, "p_x" . $security_matrix_grid->RowIndex . "_ProvinceCode") ?>
</span>
<input type="hidden" data-table="security_matrix" data-field="x_ProvinceCode" name="o<?php echo $security_matrix_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $security_matrix_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($security_matrix_grid->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php if ($security_matrix->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_ProvinceCode" class="form-group">
<?php $security_matrix_grid->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="security_matrix" data-field="x_ProvinceCode" data-value-separator="<?php echo $security_matrix_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $security_matrix_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_ProvinceCode"<?php echo $security_matrix_grid->ProvinceCode->editAttributes() ?>>
			<?php echo $security_matrix_grid->ProvinceCode->selectOptionListHtml("x{$security_matrix_grid->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $security_matrix_grid->ProvinceCode->Lookup->getParamTag($security_matrix_grid, "p_x" . $security_matrix_grid->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<?php if ($security_matrix->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_ProvinceCode">
<span<?php echo $security_matrix_grid->ProvinceCode->viewAttributes() ?>><?php echo $security_matrix_grid->ProvinceCode->getViewValue() ?></span>
</span>
<?php if (!$security_matrix->isConfirm()) { ?>
<input type="hidden" data-table="security_matrix" data-field="x_ProvinceCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $security_matrix_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($security_matrix_grid->ProvinceCode->FormValue) ?>">
<input type="hidden" data-table="security_matrix" data-field="x_ProvinceCode" name="o<?php echo $security_matrix_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $security_matrix_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($security_matrix_grid->ProvinceCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="security_matrix" data-field="x_ProvinceCode" name="fsecurity_matrixgrid$x<?php echo $security_matrix_grid->RowIndex ?>_ProvinceCode" id="fsecurity_matrixgrid$x<?php echo $security_matrix_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($security_matrix_grid->ProvinceCode->FormValue) ?>">
<input type="hidden" data-table="security_matrix" data-field="x_ProvinceCode" name="fsecurity_matrixgrid$o<?php echo $security_matrix_grid->RowIndex ?>_ProvinceCode" id="fsecurity_matrixgrid$o<?php echo $security_matrix_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($security_matrix_grid->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($security_matrix_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $security_matrix_grid->LACode->cellAttributes() ?>>
<?php if ($security_matrix->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_LACode" class="form-group">
<?php $security_matrix_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="security_matrix" data-field="x_LACode" data-value-separator="<?php echo $security_matrix_grid->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $security_matrix_grid->RowIndex ?>_LACode" name="x<?php echo $security_matrix_grid->RowIndex ?>_LACode"<?php echo $security_matrix_grid->LACode->editAttributes() ?>>
			<?php echo $security_matrix_grid->LACode->selectOptionListHtml("x{$security_matrix_grid->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $security_matrix_grid->LACode->Lookup->getParamTag($security_matrix_grid, "p_x" . $security_matrix_grid->RowIndex . "_LACode") ?>
</span>
<input type="hidden" data-table="security_matrix" data-field="x_LACode" name="o<?php echo $security_matrix_grid->RowIndex ?>_LACode" id="o<?php echo $security_matrix_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($security_matrix_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($security_matrix->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_LACode" class="form-group">
<?php $security_matrix_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="security_matrix" data-field="x_LACode" data-value-separator="<?php echo $security_matrix_grid->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $security_matrix_grid->RowIndex ?>_LACode" name="x<?php echo $security_matrix_grid->RowIndex ?>_LACode"<?php echo $security_matrix_grid->LACode->editAttributes() ?>>
			<?php echo $security_matrix_grid->LACode->selectOptionListHtml("x{$security_matrix_grid->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $security_matrix_grid->LACode->Lookup->getParamTag($security_matrix_grid, "p_x" . $security_matrix_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php if ($security_matrix->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_LACode">
<span<?php echo $security_matrix_grid->LACode->viewAttributes() ?>><?php echo $security_matrix_grid->LACode->getViewValue() ?></span>
</span>
<?php if (!$security_matrix->isConfirm()) { ?>
<input type="hidden" data-table="security_matrix" data-field="x_LACode" name="x<?php echo $security_matrix_grid->RowIndex ?>_LACode" id="x<?php echo $security_matrix_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($security_matrix_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="security_matrix" data-field="x_LACode" name="o<?php echo $security_matrix_grid->RowIndex ?>_LACode" id="o<?php echo $security_matrix_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($security_matrix_grid->LACode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="security_matrix" data-field="x_LACode" name="fsecurity_matrixgrid$x<?php echo $security_matrix_grid->RowIndex ?>_LACode" id="fsecurity_matrixgrid$x<?php echo $security_matrix_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($security_matrix_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="security_matrix" data-field="x_LACode" name="fsecurity_matrixgrid$o<?php echo $security_matrix_grid->RowIndex ?>_LACode" id="fsecurity_matrixgrid$o<?php echo $security_matrix_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($security_matrix_grid->LACode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($security_matrix_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $security_matrix_grid->DepartmentCode->cellAttributes() ?>>
<?php if ($security_matrix->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_DepartmentCode" class="form-group">
<?php $security_matrix_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="security_matrix" data-field="x_DepartmentCode" data-value-separator="<?php echo $security_matrix_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $security_matrix_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_DepartmentCode"<?php echo $security_matrix_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $security_matrix_grid->DepartmentCode->selectOptionListHtml("x{$security_matrix_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $security_matrix_grid->DepartmentCode->Lookup->getParamTag($security_matrix_grid, "p_x" . $security_matrix_grid->RowIndex . "_DepartmentCode") ?>
</span>
<input type="hidden" data-table="security_matrix" data-field="x_DepartmentCode" name="o<?php echo $security_matrix_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $security_matrix_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($security_matrix_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($security_matrix->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_DepartmentCode" class="form-group">
<?php $security_matrix_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="security_matrix" data-field="x_DepartmentCode" data-value-separator="<?php echo $security_matrix_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $security_matrix_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_DepartmentCode"<?php echo $security_matrix_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $security_matrix_grid->DepartmentCode->selectOptionListHtml("x{$security_matrix_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $security_matrix_grid->DepartmentCode->Lookup->getParamTag($security_matrix_grid, "p_x" . $security_matrix_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php if ($security_matrix->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_DepartmentCode">
<span<?php echo $security_matrix_grid->DepartmentCode->viewAttributes() ?>><?php echo $security_matrix_grid->DepartmentCode->getViewValue() ?></span>
</span>
<?php if (!$security_matrix->isConfirm()) { ?>
<input type="hidden" data-table="security_matrix" data-field="x_DepartmentCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $security_matrix_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($security_matrix_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="security_matrix" data-field="x_DepartmentCode" name="o<?php echo $security_matrix_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $security_matrix_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($security_matrix_grid->DepartmentCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="security_matrix" data-field="x_DepartmentCode" name="fsecurity_matrixgrid$x<?php echo $security_matrix_grid->RowIndex ?>_DepartmentCode" id="fsecurity_matrixgrid$x<?php echo $security_matrix_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($security_matrix_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="security_matrix" data-field="x_DepartmentCode" name="fsecurity_matrixgrid$o<?php echo $security_matrix_grid->RowIndex ?>_DepartmentCode" id="fsecurity_matrixgrid$o<?php echo $security_matrix_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($security_matrix_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($security_matrix_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $security_matrix_grid->SectionCode->cellAttributes() ?>>
<?php if ($security_matrix->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="security_matrix" data-field="x_SectionCode" data-value-separator="<?php echo $security_matrix_grid->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $security_matrix_grid->RowIndex ?>_SectionCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_SectionCode"<?php echo $security_matrix_grid->SectionCode->editAttributes() ?>>
			<?php echo $security_matrix_grid->SectionCode->selectOptionListHtml("x{$security_matrix_grid->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $security_matrix_grid->SectionCode->Lookup->getParamTag($security_matrix_grid, "p_x" . $security_matrix_grid->RowIndex . "_SectionCode") ?>
</span>
<input type="hidden" data-table="security_matrix" data-field="x_SectionCode" name="o<?php echo $security_matrix_grid->RowIndex ?>_SectionCode" id="o<?php echo $security_matrix_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($security_matrix_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($security_matrix->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="security_matrix" data-field="x_SectionCode" data-value-separator="<?php echo $security_matrix_grid->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $security_matrix_grid->RowIndex ?>_SectionCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_SectionCode"<?php echo $security_matrix_grid->SectionCode->editAttributes() ?>>
			<?php echo $security_matrix_grid->SectionCode->selectOptionListHtml("x{$security_matrix_grid->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $security_matrix_grid->SectionCode->Lookup->getParamTag($security_matrix_grid, "p_x" . $security_matrix_grid->RowIndex . "_SectionCode") ?>
</span>
<?php } ?>
<?php if ($security_matrix->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_SectionCode">
<span<?php echo $security_matrix_grid->SectionCode->viewAttributes() ?>><?php echo $security_matrix_grid->SectionCode->getViewValue() ?></span>
</span>
<?php if (!$security_matrix->isConfirm()) { ?>
<input type="hidden" data-table="security_matrix" data-field="x_SectionCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_SectionCode" id="x<?php echo $security_matrix_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($security_matrix_grid->SectionCode->FormValue) ?>">
<input type="hidden" data-table="security_matrix" data-field="x_SectionCode" name="o<?php echo $security_matrix_grid->RowIndex ?>_SectionCode" id="o<?php echo $security_matrix_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($security_matrix_grid->SectionCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="security_matrix" data-field="x_SectionCode" name="fsecurity_matrixgrid$x<?php echo $security_matrix_grid->RowIndex ?>_SectionCode" id="fsecurity_matrixgrid$x<?php echo $security_matrix_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($security_matrix_grid->SectionCode->FormValue) ?>">
<input type="hidden" data-table="security_matrix" data-field="x_SectionCode" name="fsecurity_matrixgrid$o<?php echo $security_matrix_grid->RowIndex ?>_SectionCode" id="fsecurity_matrixgrid$o<?php echo $security_matrix_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($security_matrix_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($security_matrix_grid->SecurityNumber->Visible) { // SecurityNumber ?>
		<td data-name="SecurityNumber" <?php echo $security_matrix_grid->SecurityNumber->cellAttributes() ?>>
<?php if ($security_matrix->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_SecurityNumber" class="form-group"></span>
<input type="hidden" data-table="security_matrix" data-field="x_SecurityNumber" name="o<?php echo $security_matrix_grid->RowIndex ?>_SecurityNumber" id="o<?php echo $security_matrix_grid->RowIndex ?>_SecurityNumber" value="<?php echo HtmlEncode($security_matrix_grid->SecurityNumber->OldValue) ?>">
<?php } ?>
<?php if ($security_matrix->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_SecurityNumber" class="form-group">
<span<?php echo $security_matrix_grid->SecurityNumber->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($security_matrix_grid->SecurityNumber->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="security_matrix" data-field="x_SecurityNumber" name="x<?php echo $security_matrix_grid->RowIndex ?>_SecurityNumber" id="x<?php echo $security_matrix_grid->RowIndex ?>_SecurityNumber" value="<?php echo HtmlEncode($security_matrix_grid->SecurityNumber->CurrentValue) ?>">
<?php } ?>
<?php if ($security_matrix->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_SecurityNumber">
<span<?php echo $security_matrix_grid->SecurityNumber->viewAttributes() ?>><?php echo $security_matrix_grid->SecurityNumber->getViewValue() ?></span>
</span>
<?php if (!$security_matrix->isConfirm()) { ?>
<input type="hidden" data-table="security_matrix" data-field="x_SecurityNumber" name="x<?php echo $security_matrix_grid->RowIndex ?>_SecurityNumber" id="x<?php echo $security_matrix_grid->RowIndex ?>_SecurityNumber" value="<?php echo HtmlEncode($security_matrix_grid->SecurityNumber->FormValue) ?>">
<input type="hidden" data-table="security_matrix" data-field="x_SecurityNumber" name="o<?php echo $security_matrix_grid->RowIndex ?>_SecurityNumber" id="o<?php echo $security_matrix_grid->RowIndex ?>_SecurityNumber" value="<?php echo HtmlEncode($security_matrix_grid->SecurityNumber->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="security_matrix" data-field="x_SecurityNumber" name="fsecurity_matrixgrid$x<?php echo $security_matrix_grid->RowIndex ?>_SecurityNumber" id="fsecurity_matrixgrid$x<?php echo $security_matrix_grid->RowIndex ?>_SecurityNumber" value="<?php echo HtmlEncode($security_matrix_grid->SecurityNumber->FormValue) ?>">
<input type="hidden" data-table="security_matrix" data-field="x_SecurityNumber" name="fsecurity_matrixgrid$o<?php echo $security_matrix_grid->RowIndex ?>_SecurityNumber" id="fsecurity_matrixgrid$o<?php echo $security_matrix_grid->RowIndex ?>_SecurityNumber" value="<?php echo HtmlEncode($security_matrix_grid->SecurityNumber->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($security_matrix_grid->ValidFrom->Visible) { // ValidFrom ?>
		<td data-name="ValidFrom" <?php echo $security_matrix_grid->ValidFrom->cellAttributes() ?>>
<?php if ($security_matrix->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_ValidFrom" class="form-group">
<input type="text" data-table="security_matrix" data-field="x_ValidFrom" name="x<?php echo $security_matrix_grid->RowIndex ?>_ValidFrom" id="x<?php echo $security_matrix_grid->RowIndex ?>_ValidFrom" placeholder="<?php echo HtmlEncode($security_matrix_grid->ValidFrom->getPlaceHolder()) ?>" value="<?php echo $security_matrix_grid->ValidFrom->EditValue ?>"<?php echo $security_matrix_grid->ValidFrom->editAttributes() ?>>
<?php if (!$security_matrix_grid->ValidFrom->ReadOnly && !$security_matrix_grid->ValidFrom->Disabled && !isset($security_matrix_grid->ValidFrom->EditAttrs["readonly"]) && !isset($security_matrix_grid->ValidFrom->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsecurity_matrixgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fsecurity_matrixgrid", "x<?php echo $security_matrix_grid->RowIndex ?>_ValidFrom", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="security_matrix" data-field="x_ValidFrom" name="o<?php echo $security_matrix_grid->RowIndex ?>_ValidFrom" id="o<?php echo $security_matrix_grid->RowIndex ?>_ValidFrom" value="<?php echo HtmlEncode($security_matrix_grid->ValidFrom->OldValue) ?>">
<?php } ?>
<?php if ($security_matrix->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_ValidFrom" class="form-group">
<input type="text" data-table="security_matrix" data-field="x_ValidFrom" name="x<?php echo $security_matrix_grid->RowIndex ?>_ValidFrom" id="x<?php echo $security_matrix_grid->RowIndex ?>_ValidFrom" placeholder="<?php echo HtmlEncode($security_matrix_grid->ValidFrom->getPlaceHolder()) ?>" value="<?php echo $security_matrix_grid->ValidFrom->EditValue ?>"<?php echo $security_matrix_grid->ValidFrom->editAttributes() ?>>
<?php if (!$security_matrix_grid->ValidFrom->ReadOnly && !$security_matrix_grid->ValidFrom->Disabled && !isset($security_matrix_grid->ValidFrom->EditAttrs["readonly"]) && !isset($security_matrix_grid->ValidFrom->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsecurity_matrixgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fsecurity_matrixgrid", "x<?php echo $security_matrix_grid->RowIndex ?>_ValidFrom", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($security_matrix->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_ValidFrom">
<span<?php echo $security_matrix_grid->ValidFrom->viewAttributes() ?>><?php echo $security_matrix_grid->ValidFrom->getViewValue() ?></span>
</span>
<?php if (!$security_matrix->isConfirm()) { ?>
<input type="hidden" data-table="security_matrix" data-field="x_ValidFrom" name="x<?php echo $security_matrix_grid->RowIndex ?>_ValidFrom" id="x<?php echo $security_matrix_grid->RowIndex ?>_ValidFrom" value="<?php echo HtmlEncode($security_matrix_grid->ValidFrom->FormValue) ?>">
<input type="hidden" data-table="security_matrix" data-field="x_ValidFrom" name="o<?php echo $security_matrix_grid->RowIndex ?>_ValidFrom" id="o<?php echo $security_matrix_grid->RowIndex ?>_ValidFrom" value="<?php echo HtmlEncode($security_matrix_grid->ValidFrom->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="security_matrix" data-field="x_ValidFrom" name="fsecurity_matrixgrid$x<?php echo $security_matrix_grid->RowIndex ?>_ValidFrom" id="fsecurity_matrixgrid$x<?php echo $security_matrix_grid->RowIndex ?>_ValidFrom" value="<?php echo HtmlEncode($security_matrix_grid->ValidFrom->FormValue) ?>">
<input type="hidden" data-table="security_matrix" data-field="x_ValidFrom" name="fsecurity_matrixgrid$o<?php echo $security_matrix_grid->RowIndex ?>_ValidFrom" id="fsecurity_matrixgrid$o<?php echo $security_matrix_grid->RowIndex ?>_ValidFrom" value="<?php echo HtmlEncode($security_matrix_grid->ValidFrom->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($security_matrix_grid->ValidTo->Visible) { // ValidTo ?>
		<td data-name="ValidTo" <?php echo $security_matrix_grid->ValidTo->cellAttributes() ?>>
<?php if ($security_matrix->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_ValidTo" class="form-group">
<input type="text" data-table="security_matrix" data-field="x_ValidTo" name="x<?php echo $security_matrix_grid->RowIndex ?>_ValidTo" id="x<?php echo $security_matrix_grid->RowIndex ?>_ValidTo" placeholder="<?php echo HtmlEncode($security_matrix_grid->ValidTo->getPlaceHolder()) ?>" value="<?php echo $security_matrix_grid->ValidTo->EditValue ?>"<?php echo $security_matrix_grid->ValidTo->editAttributes() ?>>
<?php if (!$security_matrix_grid->ValidTo->ReadOnly && !$security_matrix_grid->ValidTo->Disabled && !isset($security_matrix_grid->ValidTo->EditAttrs["readonly"]) && !isset($security_matrix_grid->ValidTo->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsecurity_matrixgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fsecurity_matrixgrid", "x<?php echo $security_matrix_grid->RowIndex ?>_ValidTo", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="security_matrix" data-field="x_ValidTo" name="o<?php echo $security_matrix_grid->RowIndex ?>_ValidTo" id="o<?php echo $security_matrix_grid->RowIndex ?>_ValidTo" value="<?php echo HtmlEncode($security_matrix_grid->ValidTo->OldValue) ?>">
<?php } ?>
<?php if ($security_matrix->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_ValidTo" class="form-group">
<input type="text" data-table="security_matrix" data-field="x_ValidTo" name="x<?php echo $security_matrix_grid->RowIndex ?>_ValidTo" id="x<?php echo $security_matrix_grid->RowIndex ?>_ValidTo" placeholder="<?php echo HtmlEncode($security_matrix_grid->ValidTo->getPlaceHolder()) ?>" value="<?php echo $security_matrix_grid->ValidTo->EditValue ?>"<?php echo $security_matrix_grid->ValidTo->editAttributes() ?>>
<?php if (!$security_matrix_grid->ValidTo->ReadOnly && !$security_matrix_grid->ValidTo->Disabled && !isset($security_matrix_grid->ValidTo->EditAttrs["readonly"]) && !isset($security_matrix_grid->ValidTo->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsecurity_matrixgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fsecurity_matrixgrid", "x<?php echo $security_matrix_grid->RowIndex ?>_ValidTo", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($security_matrix->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_ValidTo">
<span<?php echo $security_matrix_grid->ValidTo->viewAttributes() ?>><?php echo $security_matrix_grid->ValidTo->getViewValue() ?></span>
</span>
<?php if (!$security_matrix->isConfirm()) { ?>
<input type="hidden" data-table="security_matrix" data-field="x_ValidTo" name="x<?php echo $security_matrix_grid->RowIndex ?>_ValidTo" id="x<?php echo $security_matrix_grid->RowIndex ?>_ValidTo" value="<?php echo HtmlEncode($security_matrix_grid->ValidTo->FormValue) ?>">
<input type="hidden" data-table="security_matrix" data-field="x_ValidTo" name="o<?php echo $security_matrix_grid->RowIndex ?>_ValidTo" id="o<?php echo $security_matrix_grid->RowIndex ?>_ValidTo" value="<?php echo HtmlEncode($security_matrix_grid->ValidTo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="security_matrix" data-field="x_ValidTo" name="fsecurity_matrixgrid$x<?php echo $security_matrix_grid->RowIndex ?>_ValidTo" id="fsecurity_matrixgrid$x<?php echo $security_matrix_grid->RowIndex ?>_ValidTo" value="<?php echo HtmlEncode($security_matrix_grid->ValidTo->FormValue) ?>">
<input type="hidden" data-table="security_matrix" data-field="x_ValidTo" name="fsecurity_matrixgrid$o<?php echo $security_matrix_grid->RowIndex ?>_ValidTo" id="fsecurity_matrixgrid$o<?php echo $security_matrix_grid->RowIndex ?>_ValidTo" value="<?php echo HtmlEncode($security_matrix_grid->ValidTo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($security_matrix_grid->ApproveLevel->Visible) { // ApproveLevel ?>
		<td data-name="ApproveLevel" <?php echo $security_matrix_grid->ApproveLevel->cellAttributes() ?>>
<?php if ($security_matrix->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_ApproveLevel" class="form-group">
<input type="text" data-table="security_matrix" data-field="x_ApproveLevel" name="x<?php echo $security_matrix_grid->RowIndex ?>_ApproveLevel" id="x<?php echo $security_matrix_grid->RowIndex ?>_ApproveLevel" size="30" placeholder="<?php echo HtmlEncode($security_matrix_grid->ApproveLevel->getPlaceHolder()) ?>" value="<?php echo $security_matrix_grid->ApproveLevel->EditValue ?>"<?php echo $security_matrix_grid->ApproveLevel->editAttributes() ?>>
</span>
<input type="hidden" data-table="security_matrix" data-field="x_ApproveLevel" name="o<?php echo $security_matrix_grid->RowIndex ?>_ApproveLevel" id="o<?php echo $security_matrix_grid->RowIndex ?>_ApproveLevel" value="<?php echo HtmlEncode($security_matrix_grid->ApproveLevel->OldValue) ?>">
<?php } ?>
<?php if ($security_matrix->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_ApproveLevel" class="form-group">
<input type="text" data-table="security_matrix" data-field="x_ApproveLevel" name="x<?php echo $security_matrix_grid->RowIndex ?>_ApproveLevel" id="x<?php echo $security_matrix_grid->RowIndex ?>_ApproveLevel" size="30" placeholder="<?php echo HtmlEncode($security_matrix_grid->ApproveLevel->getPlaceHolder()) ?>" value="<?php echo $security_matrix_grid->ApproveLevel->EditValue ?>"<?php echo $security_matrix_grid->ApproveLevel->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($security_matrix->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_ApproveLevel">
<span<?php echo $security_matrix_grid->ApproveLevel->viewAttributes() ?>><?php echo $security_matrix_grid->ApproveLevel->getViewValue() ?></span>
</span>
<?php if (!$security_matrix->isConfirm()) { ?>
<input type="hidden" data-table="security_matrix" data-field="x_ApproveLevel" name="x<?php echo $security_matrix_grid->RowIndex ?>_ApproveLevel" id="x<?php echo $security_matrix_grid->RowIndex ?>_ApproveLevel" value="<?php echo HtmlEncode($security_matrix_grid->ApproveLevel->FormValue) ?>">
<input type="hidden" data-table="security_matrix" data-field="x_ApproveLevel" name="o<?php echo $security_matrix_grid->RowIndex ?>_ApproveLevel" id="o<?php echo $security_matrix_grid->RowIndex ?>_ApproveLevel" value="<?php echo HtmlEncode($security_matrix_grid->ApproveLevel->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="security_matrix" data-field="x_ApproveLevel" name="fsecurity_matrixgrid$x<?php echo $security_matrix_grid->RowIndex ?>_ApproveLevel" id="fsecurity_matrixgrid$x<?php echo $security_matrix_grid->RowIndex ?>_ApproveLevel" value="<?php echo HtmlEncode($security_matrix_grid->ApproveLevel->FormValue) ?>">
<input type="hidden" data-table="security_matrix" data-field="x_ApproveLevel" name="fsecurity_matrixgrid$o<?php echo $security_matrix_grid->RowIndex ?>_ApproveLevel" id="fsecurity_matrixgrid$o<?php echo $security_matrix_grid->RowIndex ?>_ApproveLevel" value="<?php echo HtmlEncode($security_matrix_grid->ApproveLevel->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($security_matrix_grid->ActivityCode->Visible) { // ActivityCode ?>
		<td data-name="ActivityCode" <?php echo $security_matrix_grid->ActivityCode->cellAttributes() ?>>
<?php if ($security_matrix->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_ActivityCode" class="form-group">
<input type="text" data-table="security_matrix" data-field="x_ActivityCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_ActivityCode" id="x<?php echo $security_matrix_grid->RowIndex ?>_ActivityCode" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($security_matrix_grid->ActivityCode->getPlaceHolder()) ?>" value="<?php echo $security_matrix_grid->ActivityCode->EditValue ?>"<?php echo $security_matrix_grid->ActivityCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="security_matrix" data-field="x_ActivityCode" name="o<?php echo $security_matrix_grid->RowIndex ?>_ActivityCode" id="o<?php echo $security_matrix_grid->RowIndex ?>_ActivityCode" value="<?php echo HtmlEncode($security_matrix_grid->ActivityCode->OldValue) ?>">
<?php } ?>
<?php if ($security_matrix->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_ActivityCode" class="form-group">
<input type="text" data-table="security_matrix" data-field="x_ActivityCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_ActivityCode" id="x<?php echo $security_matrix_grid->RowIndex ?>_ActivityCode" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($security_matrix_grid->ActivityCode->getPlaceHolder()) ?>" value="<?php echo $security_matrix_grid->ActivityCode->EditValue ?>"<?php echo $security_matrix_grid->ActivityCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($security_matrix->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $security_matrix_grid->RowCount ?>_security_matrix_ActivityCode">
<span<?php echo $security_matrix_grid->ActivityCode->viewAttributes() ?>><?php echo $security_matrix_grid->ActivityCode->getViewValue() ?></span>
</span>
<?php if (!$security_matrix->isConfirm()) { ?>
<input type="hidden" data-table="security_matrix" data-field="x_ActivityCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_ActivityCode" id="x<?php echo $security_matrix_grid->RowIndex ?>_ActivityCode" value="<?php echo HtmlEncode($security_matrix_grid->ActivityCode->FormValue) ?>">
<input type="hidden" data-table="security_matrix" data-field="x_ActivityCode" name="o<?php echo $security_matrix_grid->RowIndex ?>_ActivityCode" id="o<?php echo $security_matrix_grid->RowIndex ?>_ActivityCode" value="<?php echo HtmlEncode($security_matrix_grid->ActivityCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="security_matrix" data-field="x_ActivityCode" name="fsecurity_matrixgrid$x<?php echo $security_matrix_grid->RowIndex ?>_ActivityCode" id="fsecurity_matrixgrid$x<?php echo $security_matrix_grid->RowIndex ?>_ActivityCode" value="<?php echo HtmlEncode($security_matrix_grid->ActivityCode->FormValue) ?>">
<input type="hidden" data-table="security_matrix" data-field="x_ActivityCode" name="fsecurity_matrixgrid$o<?php echo $security_matrix_grid->RowIndex ?>_ActivityCode" id="fsecurity_matrixgrid$o<?php echo $security_matrix_grid->RowIndex ?>_ActivityCode" value="<?php echo HtmlEncode($security_matrix_grid->ActivityCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$security_matrix_grid->ListOptions->render("body", "right", $security_matrix_grid->RowCount);
?>
	</tr>
<?php if ($security_matrix->RowType == ROWTYPE_ADD || $security_matrix->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fsecurity_matrixgrid", "load"], function() {
	fsecurity_matrixgrid.updateLists(<?php echo $security_matrix_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$security_matrix_grid->isGridAdd() || $security_matrix->CurrentMode == "copy")
		if (!$security_matrix_grid->Recordset->EOF)
			$security_matrix_grid->Recordset->moveNext();
}
?>
<?php
	if ($security_matrix->CurrentMode == "add" || $security_matrix->CurrentMode == "copy" || $security_matrix->CurrentMode == "edit") {
		$security_matrix_grid->RowIndex = '$rowindex$';
		$security_matrix_grid->loadRowValues();

		// Set row properties
		$security_matrix->resetAttributes();
		$security_matrix->RowAttrs->merge(["data-rowindex" => $security_matrix_grid->RowIndex, "id" => "r0_security_matrix", "data-rowtype" => ROWTYPE_ADD]);
		$security_matrix->RowAttrs->appendClass("ew-template");
		$security_matrix->RowType = ROWTYPE_ADD;

		// Render row
		$security_matrix_grid->renderRow();

		// Render list options
		$security_matrix_grid->renderListOptions();
		$security_matrix_grid->StartRowCount = 0;
?>
	<tr <?php echo $security_matrix->rowAttributes() ?>>
<?php

// Render list options (body, left)
$security_matrix_grid->ListOptions->render("body", "left", $security_matrix_grid->RowIndex);
?>
	<?php if ($security_matrix_grid->UserCode->Visible) { // UserCode ?>
		<td data-name="UserCode">
<?php if (!$security_matrix->isConfirm()) { ?>
<?php if ($security_matrix_grid->UserCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_security_matrix_UserCode" class="form-group security_matrix_UserCode">
<span<?php echo $security_matrix_grid->UserCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($security_matrix_grid->UserCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $security_matrix_grid->RowIndex ?>_UserCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_UserCode" value="<?php echo HtmlEncode($security_matrix_grid->UserCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_security_matrix_UserCode" class="form-group security_matrix_UserCode">
<input type="text" data-table="security_matrix" data-field="x_UserCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_UserCode" id="x<?php echo $security_matrix_grid->RowIndex ?>_UserCode" size="30" placeholder="<?php echo HtmlEncode($security_matrix_grid->UserCode->getPlaceHolder()) ?>" value="<?php echo $security_matrix_grid->UserCode->EditValue ?>"<?php echo $security_matrix_grid->UserCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_security_matrix_UserCode" class="form-group security_matrix_UserCode">
<span<?php echo $security_matrix_grid->UserCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($security_matrix_grid->UserCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="security_matrix" data-field="x_UserCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_UserCode" id="x<?php echo $security_matrix_grid->RowIndex ?>_UserCode" value="<?php echo HtmlEncode($security_matrix_grid->UserCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="security_matrix" data-field="x_UserCode" name="o<?php echo $security_matrix_grid->RowIndex ?>_UserCode" id="o<?php echo $security_matrix_grid->RowIndex ?>_UserCode" value="<?php echo HtmlEncode($security_matrix_grid->UserCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($security_matrix_grid->PeriodCode->Visible) { // PeriodCode ?>
		<td data-name="PeriodCode">
<?php if (!$security_matrix->isConfirm()) { ?>
<span id="el$rowindex$_security_matrix_PeriodCode" class="form-group security_matrix_PeriodCode">
<input type="text" data-table="security_matrix" data-field="x_PeriodCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_PeriodCode" id="x<?php echo $security_matrix_grid->RowIndex ?>_PeriodCode" size="30" placeholder="<?php echo HtmlEncode($security_matrix_grid->PeriodCode->getPlaceHolder()) ?>" value="<?php echo $security_matrix_grid->PeriodCode->EditValue ?>"<?php echo $security_matrix_grid->PeriodCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_security_matrix_PeriodCode" class="form-group security_matrix_PeriodCode">
<span<?php echo $security_matrix_grid->PeriodCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($security_matrix_grid->PeriodCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="security_matrix" data-field="x_PeriodCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_PeriodCode" id="x<?php echo $security_matrix_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($security_matrix_grid->PeriodCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="security_matrix" data-field="x_PeriodCode" name="o<?php echo $security_matrix_grid->RowIndex ?>_PeriodCode" id="o<?php echo $security_matrix_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($security_matrix_grid->PeriodCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($security_matrix_grid->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode">
<?php if (!$security_matrix->isConfirm()) { ?>
<span id="el$rowindex$_security_matrix_ProvinceCode" class="form-group security_matrix_ProvinceCode">
<?php $security_matrix_grid->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="security_matrix" data-field="x_ProvinceCode" data-value-separator="<?php echo $security_matrix_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $security_matrix_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_ProvinceCode"<?php echo $security_matrix_grid->ProvinceCode->editAttributes() ?>>
			<?php echo $security_matrix_grid->ProvinceCode->selectOptionListHtml("x{$security_matrix_grid->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $security_matrix_grid->ProvinceCode->Lookup->getParamTag($security_matrix_grid, "p_x" . $security_matrix_grid->RowIndex . "_ProvinceCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_security_matrix_ProvinceCode" class="form-group security_matrix_ProvinceCode">
<span<?php echo $security_matrix_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($security_matrix_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="security_matrix" data-field="x_ProvinceCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $security_matrix_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($security_matrix_grid->ProvinceCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="security_matrix" data-field="x_ProvinceCode" name="o<?php echo $security_matrix_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $security_matrix_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($security_matrix_grid->ProvinceCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($security_matrix_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if (!$security_matrix->isConfirm()) { ?>
<span id="el$rowindex$_security_matrix_LACode" class="form-group security_matrix_LACode">
<?php $security_matrix_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="security_matrix" data-field="x_LACode" data-value-separator="<?php echo $security_matrix_grid->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $security_matrix_grid->RowIndex ?>_LACode" name="x<?php echo $security_matrix_grid->RowIndex ?>_LACode"<?php echo $security_matrix_grid->LACode->editAttributes() ?>>
			<?php echo $security_matrix_grid->LACode->selectOptionListHtml("x{$security_matrix_grid->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $security_matrix_grid->LACode->Lookup->getParamTag($security_matrix_grid, "p_x" . $security_matrix_grid->RowIndex . "_LACode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_security_matrix_LACode" class="form-group security_matrix_LACode">
<span<?php echo $security_matrix_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($security_matrix_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="security_matrix" data-field="x_LACode" name="x<?php echo $security_matrix_grid->RowIndex ?>_LACode" id="x<?php echo $security_matrix_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($security_matrix_grid->LACode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="security_matrix" data-field="x_LACode" name="o<?php echo $security_matrix_grid->RowIndex ?>_LACode" id="o<?php echo $security_matrix_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($security_matrix_grid->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($security_matrix_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<?php if (!$security_matrix->isConfirm()) { ?>
<span id="el$rowindex$_security_matrix_DepartmentCode" class="form-group security_matrix_DepartmentCode">
<?php $security_matrix_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="security_matrix" data-field="x_DepartmentCode" data-value-separator="<?php echo $security_matrix_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $security_matrix_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_DepartmentCode"<?php echo $security_matrix_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $security_matrix_grid->DepartmentCode->selectOptionListHtml("x{$security_matrix_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $security_matrix_grid->DepartmentCode->Lookup->getParamTag($security_matrix_grid, "p_x" . $security_matrix_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_security_matrix_DepartmentCode" class="form-group security_matrix_DepartmentCode">
<span<?php echo $security_matrix_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($security_matrix_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="security_matrix" data-field="x_DepartmentCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $security_matrix_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($security_matrix_grid->DepartmentCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="security_matrix" data-field="x_DepartmentCode" name="o<?php echo $security_matrix_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $security_matrix_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($security_matrix_grid->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($security_matrix_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode">
<?php if (!$security_matrix->isConfirm()) { ?>
<span id="el$rowindex$_security_matrix_SectionCode" class="form-group security_matrix_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="security_matrix" data-field="x_SectionCode" data-value-separator="<?php echo $security_matrix_grid->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $security_matrix_grid->RowIndex ?>_SectionCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_SectionCode"<?php echo $security_matrix_grid->SectionCode->editAttributes() ?>>
			<?php echo $security_matrix_grid->SectionCode->selectOptionListHtml("x{$security_matrix_grid->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $security_matrix_grid->SectionCode->Lookup->getParamTag($security_matrix_grid, "p_x" . $security_matrix_grid->RowIndex . "_SectionCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_security_matrix_SectionCode" class="form-group security_matrix_SectionCode">
<span<?php echo $security_matrix_grid->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($security_matrix_grid->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="security_matrix" data-field="x_SectionCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_SectionCode" id="x<?php echo $security_matrix_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($security_matrix_grid->SectionCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="security_matrix" data-field="x_SectionCode" name="o<?php echo $security_matrix_grid->RowIndex ?>_SectionCode" id="o<?php echo $security_matrix_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($security_matrix_grid->SectionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($security_matrix_grid->SecurityNumber->Visible) { // SecurityNumber ?>
		<td data-name="SecurityNumber">
<?php if (!$security_matrix->isConfirm()) { ?>
<span id="el$rowindex$_security_matrix_SecurityNumber" class="form-group security_matrix_SecurityNumber"></span>
<?php } else { ?>
<span id="el$rowindex$_security_matrix_SecurityNumber" class="form-group security_matrix_SecurityNumber">
<span<?php echo $security_matrix_grid->SecurityNumber->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($security_matrix_grid->SecurityNumber->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="security_matrix" data-field="x_SecurityNumber" name="x<?php echo $security_matrix_grid->RowIndex ?>_SecurityNumber" id="x<?php echo $security_matrix_grid->RowIndex ?>_SecurityNumber" value="<?php echo HtmlEncode($security_matrix_grid->SecurityNumber->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="security_matrix" data-field="x_SecurityNumber" name="o<?php echo $security_matrix_grid->RowIndex ?>_SecurityNumber" id="o<?php echo $security_matrix_grid->RowIndex ?>_SecurityNumber" value="<?php echo HtmlEncode($security_matrix_grid->SecurityNumber->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($security_matrix_grid->ValidFrom->Visible) { // ValidFrom ?>
		<td data-name="ValidFrom">
<?php if (!$security_matrix->isConfirm()) { ?>
<span id="el$rowindex$_security_matrix_ValidFrom" class="form-group security_matrix_ValidFrom">
<input type="text" data-table="security_matrix" data-field="x_ValidFrom" name="x<?php echo $security_matrix_grid->RowIndex ?>_ValidFrom" id="x<?php echo $security_matrix_grid->RowIndex ?>_ValidFrom" placeholder="<?php echo HtmlEncode($security_matrix_grid->ValidFrom->getPlaceHolder()) ?>" value="<?php echo $security_matrix_grid->ValidFrom->EditValue ?>"<?php echo $security_matrix_grid->ValidFrom->editAttributes() ?>>
<?php if (!$security_matrix_grid->ValidFrom->ReadOnly && !$security_matrix_grid->ValidFrom->Disabled && !isset($security_matrix_grid->ValidFrom->EditAttrs["readonly"]) && !isset($security_matrix_grid->ValidFrom->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsecurity_matrixgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fsecurity_matrixgrid", "x<?php echo $security_matrix_grid->RowIndex ?>_ValidFrom", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_security_matrix_ValidFrom" class="form-group security_matrix_ValidFrom">
<span<?php echo $security_matrix_grid->ValidFrom->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($security_matrix_grid->ValidFrom->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="security_matrix" data-field="x_ValidFrom" name="x<?php echo $security_matrix_grid->RowIndex ?>_ValidFrom" id="x<?php echo $security_matrix_grid->RowIndex ?>_ValidFrom" value="<?php echo HtmlEncode($security_matrix_grid->ValidFrom->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="security_matrix" data-field="x_ValidFrom" name="o<?php echo $security_matrix_grid->RowIndex ?>_ValidFrom" id="o<?php echo $security_matrix_grid->RowIndex ?>_ValidFrom" value="<?php echo HtmlEncode($security_matrix_grid->ValidFrom->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($security_matrix_grid->ValidTo->Visible) { // ValidTo ?>
		<td data-name="ValidTo">
<?php if (!$security_matrix->isConfirm()) { ?>
<span id="el$rowindex$_security_matrix_ValidTo" class="form-group security_matrix_ValidTo">
<input type="text" data-table="security_matrix" data-field="x_ValidTo" name="x<?php echo $security_matrix_grid->RowIndex ?>_ValidTo" id="x<?php echo $security_matrix_grid->RowIndex ?>_ValidTo" placeholder="<?php echo HtmlEncode($security_matrix_grid->ValidTo->getPlaceHolder()) ?>" value="<?php echo $security_matrix_grid->ValidTo->EditValue ?>"<?php echo $security_matrix_grid->ValidTo->editAttributes() ?>>
<?php if (!$security_matrix_grid->ValidTo->ReadOnly && !$security_matrix_grid->ValidTo->Disabled && !isset($security_matrix_grid->ValidTo->EditAttrs["readonly"]) && !isset($security_matrix_grid->ValidTo->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsecurity_matrixgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fsecurity_matrixgrid", "x<?php echo $security_matrix_grid->RowIndex ?>_ValidTo", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_security_matrix_ValidTo" class="form-group security_matrix_ValidTo">
<span<?php echo $security_matrix_grid->ValidTo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($security_matrix_grid->ValidTo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="security_matrix" data-field="x_ValidTo" name="x<?php echo $security_matrix_grid->RowIndex ?>_ValidTo" id="x<?php echo $security_matrix_grid->RowIndex ?>_ValidTo" value="<?php echo HtmlEncode($security_matrix_grid->ValidTo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="security_matrix" data-field="x_ValidTo" name="o<?php echo $security_matrix_grid->RowIndex ?>_ValidTo" id="o<?php echo $security_matrix_grid->RowIndex ?>_ValidTo" value="<?php echo HtmlEncode($security_matrix_grid->ValidTo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($security_matrix_grid->ApproveLevel->Visible) { // ApproveLevel ?>
		<td data-name="ApproveLevel">
<?php if (!$security_matrix->isConfirm()) { ?>
<span id="el$rowindex$_security_matrix_ApproveLevel" class="form-group security_matrix_ApproveLevel">
<input type="text" data-table="security_matrix" data-field="x_ApproveLevel" name="x<?php echo $security_matrix_grid->RowIndex ?>_ApproveLevel" id="x<?php echo $security_matrix_grid->RowIndex ?>_ApproveLevel" size="30" placeholder="<?php echo HtmlEncode($security_matrix_grid->ApproveLevel->getPlaceHolder()) ?>" value="<?php echo $security_matrix_grid->ApproveLevel->EditValue ?>"<?php echo $security_matrix_grid->ApproveLevel->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_security_matrix_ApproveLevel" class="form-group security_matrix_ApproveLevel">
<span<?php echo $security_matrix_grid->ApproveLevel->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($security_matrix_grid->ApproveLevel->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="security_matrix" data-field="x_ApproveLevel" name="x<?php echo $security_matrix_grid->RowIndex ?>_ApproveLevel" id="x<?php echo $security_matrix_grid->RowIndex ?>_ApproveLevel" value="<?php echo HtmlEncode($security_matrix_grid->ApproveLevel->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="security_matrix" data-field="x_ApproveLevel" name="o<?php echo $security_matrix_grid->RowIndex ?>_ApproveLevel" id="o<?php echo $security_matrix_grid->RowIndex ?>_ApproveLevel" value="<?php echo HtmlEncode($security_matrix_grid->ApproveLevel->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($security_matrix_grid->ActivityCode->Visible) { // ActivityCode ?>
		<td data-name="ActivityCode">
<?php if (!$security_matrix->isConfirm()) { ?>
<span id="el$rowindex$_security_matrix_ActivityCode" class="form-group security_matrix_ActivityCode">
<input type="text" data-table="security_matrix" data-field="x_ActivityCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_ActivityCode" id="x<?php echo $security_matrix_grid->RowIndex ?>_ActivityCode" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($security_matrix_grid->ActivityCode->getPlaceHolder()) ?>" value="<?php echo $security_matrix_grid->ActivityCode->EditValue ?>"<?php echo $security_matrix_grid->ActivityCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_security_matrix_ActivityCode" class="form-group security_matrix_ActivityCode">
<span<?php echo $security_matrix_grid->ActivityCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($security_matrix_grid->ActivityCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="security_matrix" data-field="x_ActivityCode" name="x<?php echo $security_matrix_grid->RowIndex ?>_ActivityCode" id="x<?php echo $security_matrix_grid->RowIndex ?>_ActivityCode" value="<?php echo HtmlEncode($security_matrix_grid->ActivityCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="security_matrix" data-field="x_ActivityCode" name="o<?php echo $security_matrix_grid->RowIndex ?>_ActivityCode" id="o<?php echo $security_matrix_grid->RowIndex ?>_ActivityCode" value="<?php echo HtmlEncode($security_matrix_grid->ActivityCode->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$security_matrix_grid->ListOptions->render("body", "right", $security_matrix_grid->RowIndex);
?>
<script>
loadjs.ready(["fsecurity_matrixgrid", "load"], function() {
	fsecurity_matrixgrid.updateLists(<?php echo $security_matrix_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($security_matrix->CurrentMode == "add" || $security_matrix->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $security_matrix_grid->FormKeyCountName ?>" id="<?php echo $security_matrix_grid->FormKeyCountName ?>" value="<?php echo $security_matrix_grid->KeyCount ?>">
<?php echo $security_matrix_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($security_matrix->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $security_matrix_grid->FormKeyCountName ?>" id="<?php echo $security_matrix_grid->FormKeyCountName ?>" value="<?php echo $security_matrix_grid->KeyCount ?>">
<?php echo $security_matrix_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($security_matrix->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fsecurity_matrixgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($security_matrix_grid->Recordset)
	$security_matrix_grid->Recordset->Close();
?>
<?php if ($security_matrix_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $security_matrix_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($security_matrix_grid->TotalRecords == 0 && !$security_matrix->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $security_matrix_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$security_matrix_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$security_matrix_grid->terminate();
?>