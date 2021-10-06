<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($income_schedule_view_grid))
	$income_schedule_view_grid = new income_schedule_view_grid();

// Run the page
$income_schedule_view_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$income_schedule_view_grid->Page_Render();
?>
<?php if (!$income_schedule_view_grid->isExport()) { ?>
<script>
var fincome_schedule_viewgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fincome_schedule_viewgrid = new ew.Form("fincome_schedule_viewgrid", "grid");
	fincome_schedule_viewgrid.formKeyCountName = '<?php echo $income_schedule_view_grid->FormKeyCountName ?>';

	// Validate form
	fincome_schedule_viewgrid.validate = function() {
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
			<?php if ($income_schedule_view_grid->LAName->Required) { ?>
				elm = this.getElements("x" + infix + "_LAName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_schedule_view_grid->LAName->caption(), $income_schedule_view_grid->LAName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_schedule_view_grid->NRC->Required) { ?>
				elm = this.getElements("x" + infix + "_NRC");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_schedule_view_grid->NRC->caption(), $income_schedule_view_grid->NRC->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_schedule_view_grid->Surname->Required) { ?>
				elm = this.getElements("x" + infix + "_Surname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_schedule_view_grid->Surname->caption(), $income_schedule_view_grid->Surname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_schedule_view_grid->MiddleName->Required) { ?>
				elm = this.getElements("x" + infix + "_MiddleName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_schedule_view_grid->MiddleName->caption(), $income_schedule_view_grid->MiddleName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_schedule_view_grid->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_schedule_view_grid->FirstName->caption(), $income_schedule_view_grid->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_schedule_view_grid->PositionName->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_schedule_view_grid->PositionName->caption(), $income_schedule_view_grid->PositionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_schedule_view_grid->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_schedule_view_grid->EmployeeID->caption(), $income_schedule_view_grid->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($income_schedule_view_grid->EmployeeID->errorMessage()) ?>");
			<?php if ($income_schedule_view_grid->PayrollDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_schedule_view_grid->PayrollDate->caption(), $income_schedule_view_grid->PayrollDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($income_schedule_view_grid->PayrollDate->errorMessage()) ?>");
			<?php if ($income_schedule_view_grid->Income->Required) { ?>
				elm = this.getElements("x" + infix + "_Income");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_schedule_view_grid->Income->caption(), $income_schedule_view_grid->Income->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Income");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($income_schedule_view_grid->Income->errorMessage()) ?>");
			<?php if ($income_schedule_view_grid->IncomeName->Required) { ?>
				elm = this.getElements("x" + infix + "_IncomeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_schedule_view_grid->IncomeName->caption(), $income_schedule_view_grid->IncomeName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_schedule_view_grid->PeriodCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_schedule_view_grid->PeriodCode->caption(), $income_schedule_view_grid->PeriodCode->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fincome_schedule_viewgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "LAName", false)) return false;
		if (ew.valueChanged(fobj, infix, "NRC", false)) return false;
		if (ew.valueChanged(fobj, infix, "Surname", false)) return false;
		if (ew.valueChanged(fobj, infix, "MiddleName", false)) return false;
		if (ew.valueChanged(fobj, infix, "FirstName", false)) return false;
		if (ew.valueChanged(fobj, infix, "PositionName", false)) return false;
		if (ew.valueChanged(fobj, infix, "EmployeeID", false)) return false;
		if (ew.valueChanged(fobj, infix, "PayrollDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "Income", false)) return false;
		if (ew.valueChanged(fobj, infix, "IncomeName", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fincome_schedule_viewgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fincome_schedule_viewgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fincome_schedule_viewgrid.lists["x_PeriodCode"] = <?php echo $income_schedule_view_grid->PeriodCode->Lookup->toClientList($income_schedule_view_grid) ?>;
	fincome_schedule_viewgrid.lists["x_PeriodCode"].options = <?php echo JsonEncode($income_schedule_view_grid->PeriodCode->lookupOptions()) ?>;
	loadjs.done("fincome_schedule_viewgrid");
});
</script>
<?php } ?>
<?php
$income_schedule_view_grid->renderOtherOptions();
?>
<?php if ($income_schedule_view_grid->TotalRecords > 0 || $income_schedule_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($income_schedule_view_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> income_schedule_view">
<?php if ($income_schedule_view_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $income_schedule_view_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fincome_schedule_viewgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_income_schedule_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_income_schedule_viewgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$income_schedule_view->RowType = ROWTYPE_HEADER;

// Render list options
$income_schedule_view_grid->renderListOptions();

// Render list options (header, left)
$income_schedule_view_grid->ListOptions->render("header", "left");
?>
<?php if ($income_schedule_view_grid->LAName->Visible) { // LAName ?>
	<?php if ($income_schedule_view_grid->SortUrl($income_schedule_view_grid->LAName) == "") { ?>
		<th data-name="LAName" class="<?php echo $income_schedule_view_grid->LAName->headerCellClass() ?>"><div id="elh_income_schedule_view_LAName" class="income_schedule_view_LAName"><div class="ew-table-header-caption"><?php echo $income_schedule_view_grid->LAName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LAName" class="<?php echo $income_schedule_view_grid->LAName->headerCellClass() ?>"><div><div id="elh_income_schedule_view_LAName" class="income_schedule_view_LAName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_grid->LAName->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_grid->LAName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_grid->LAName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_grid->NRC->Visible) { // NRC ?>
	<?php if ($income_schedule_view_grid->SortUrl($income_schedule_view_grid->NRC) == "") { ?>
		<th data-name="NRC" class="<?php echo $income_schedule_view_grid->NRC->headerCellClass() ?>"><div id="elh_income_schedule_view_NRC" class="income_schedule_view_NRC"><div class="ew-table-header-caption"><?php echo $income_schedule_view_grid->NRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC" class="<?php echo $income_schedule_view_grid->NRC->headerCellClass() ?>"><div><div id="elh_income_schedule_view_NRC" class="income_schedule_view_NRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_grid->NRC->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_grid->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_grid->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_grid->Surname->Visible) { // Surname ?>
	<?php if ($income_schedule_view_grid->SortUrl($income_schedule_view_grid->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $income_schedule_view_grid->Surname->headerCellClass() ?>"><div id="elh_income_schedule_view_Surname" class="income_schedule_view_Surname"><div class="ew-table-header-caption"><?php echo $income_schedule_view_grid->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $income_schedule_view_grid->Surname->headerCellClass() ?>"><div><div id="elh_income_schedule_view_Surname" class="income_schedule_view_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_grid->Surname->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_grid->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_grid->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_grid->MiddleName->Visible) { // MiddleName ?>
	<?php if ($income_schedule_view_grid->SortUrl($income_schedule_view_grid->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $income_schedule_view_grid->MiddleName->headerCellClass() ?>"><div id="elh_income_schedule_view_MiddleName" class="income_schedule_view_MiddleName"><div class="ew-table-header-caption"><?php echo $income_schedule_view_grid->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $income_schedule_view_grid->MiddleName->headerCellClass() ?>"><div><div id="elh_income_schedule_view_MiddleName" class="income_schedule_view_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_grid->MiddleName->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_grid->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_grid->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_grid->FirstName->Visible) { // FirstName ?>
	<?php if ($income_schedule_view_grid->SortUrl($income_schedule_view_grid->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $income_schedule_view_grid->FirstName->headerCellClass() ?>"><div id="elh_income_schedule_view_FirstName" class="income_schedule_view_FirstName"><div class="ew-table-header-caption"><?php echo $income_schedule_view_grid->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $income_schedule_view_grid->FirstName->headerCellClass() ?>"><div><div id="elh_income_schedule_view_FirstName" class="income_schedule_view_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_grid->FirstName->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_grid->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_grid->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_grid->PositionName->Visible) { // PositionName ?>
	<?php if ($income_schedule_view_grid->SortUrl($income_schedule_view_grid->PositionName) == "") { ?>
		<th data-name="PositionName" class="<?php echo $income_schedule_view_grid->PositionName->headerCellClass() ?>"><div id="elh_income_schedule_view_PositionName" class="income_schedule_view_PositionName"><div class="ew-table-header-caption"><?php echo $income_schedule_view_grid->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionName" class="<?php echo $income_schedule_view_grid->PositionName->headerCellClass() ?>"><div><div id="elh_income_schedule_view_PositionName" class="income_schedule_view_PositionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_grid->PositionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_grid->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_grid->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_grid->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($income_schedule_view_grid->SortUrl($income_schedule_view_grid->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $income_schedule_view_grid->EmployeeID->headerCellClass() ?>"><div id="elh_income_schedule_view_EmployeeID" class="income_schedule_view_EmployeeID"><div class="ew-table-header-caption"><?php echo $income_schedule_view_grid->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $income_schedule_view_grid->EmployeeID->headerCellClass() ?>"><div><div id="elh_income_schedule_view_EmployeeID" class="income_schedule_view_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_grid->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_grid->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_grid->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_grid->PayrollDate->Visible) { // PayrollDate ?>
	<?php if ($income_schedule_view_grid->SortUrl($income_schedule_view_grid->PayrollDate) == "") { ?>
		<th data-name="PayrollDate" class="<?php echo $income_schedule_view_grid->PayrollDate->headerCellClass() ?>"><div id="elh_income_schedule_view_PayrollDate" class="income_schedule_view_PayrollDate"><div class="ew-table-header-caption"><?php echo $income_schedule_view_grid->PayrollDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollDate" class="<?php echo $income_schedule_view_grid->PayrollDate->headerCellClass() ?>"><div><div id="elh_income_schedule_view_PayrollDate" class="income_schedule_view_PayrollDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_grid->PayrollDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_grid->PayrollDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_grid->PayrollDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_grid->Income->Visible) { // Income ?>
	<?php if ($income_schedule_view_grid->SortUrl($income_schedule_view_grid->Income) == "") { ?>
		<th data-name="Income" class="<?php echo $income_schedule_view_grid->Income->headerCellClass() ?>"><div id="elh_income_schedule_view_Income" class="income_schedule_view_Income"><div class="ew-table-header-caption"><?php echo $income_schedule_view_grid->Income->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Income" class="<?php echo $income_schedule_view_grid->Income->headerCellClass() ?>"><div><div id="elh_income_schedule_view_Income" class="income_schedule_view_Income">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_grid->Income->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_grid->Income->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_grid->Income->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_grid->IncomeName->Visible) { // IncomeName ?>
	<?php if ($income_schedule_view_grid->SortUrl($income_schedule_view_grid->IncomeName) == "") { ?>
		<th data-name="IncomeName" class="<?php echo $income_schedule_view_grid->IncomeName->headerCellClass() ?>"><div id="elh_income_schedule_view_IncomeName" class="income_schedule_view_IncomeName"><div class="ew-table-header-caption"><?php echo $income_schedule_view_grid->IncomeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IncomeName" class="<?php echo $income_schedule_view_grid->IncomeName->headerCellClass() ?>"><div><div id="elh_income_schedule_view_IncomeName" class="income_schedule_view_IncomeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_grid->IncomeName->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_grid->IncomeName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_grid->IncomeName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_grid->PeriodCode->Visible) { // PeriodCode ?>
	<?php if ($income_schedule_view_grid->SortUrl($income_schedule_view_grid->PeriodCode) == "") { ?>
		<th data-name="PeriodCode" class="<?php echo $income_schedule_view_grid->PeriodCode->headerCellClass() ?>"><div id="elh_income_schedule_view_PeriodCode" class="income_schedule_view_PeriodCode"><div class="ew-table-header-caption"><?php echo $income_schedule_view_grid->PeriodCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodCode" class="<?php echo $income_schedule_view_grid->PeriodCode->headerCellClass() ?>"><div><div id="elh_income_schedule_view_PeriodCode" class="income_schedule_view_PeriodCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_grid->PeriodCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_grid->PeriodCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_grid->PeriodCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$income_schedule_view_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$income_schedule_view_grid->StartRecord = 1;
$income_schedule_view_grid->StopRecord = $income_schedule_view_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($income_schedule_view->isConfirm() || $income_schedule_view_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($income_schedule_view_grid->FormKeyCountName) && ($income_schedule_view_grid->isGridAdd() || $income_schedule_view_grid->isGridEdit() || $income_schedule_view->isConfirm())) {
		$income_schedule_view_grid->KeyCount = $CurrentForm->getValue($income_schedule_view_grid->FormKeyCountName);
		$income_schedule_view_grid->StopRecord = $income_schedule_view_grid->StartRecord + $income_schedule_view_grid->KeyCount - 1;
	}
}
$income_schedule_view_grid->RecordCount = $income_schedule_view_grid->StartRecord - 1;
if ($income_schedule_view_grid->Recordset && !$income_schedule_view_grid->Recordset->EOF) {
	$income_schedule_view_grid->Recordset->moveFirst();
	$selectLimit = $income_schedule_view_grid->UseSelectLimit;
	if (!$selectLimit && $income_schedule_view_grid->StartRecord > 1)
		$income_schedule_view_grid->Recordset->move($income_schedule_view_grid->StartRecord - 1);
} elseif (!$income_schedule_view->AllowAddDeleteRow && $income_schedule_view_grid->StopRecord == 0) {
	$income_schedule_view_grid->StopRecord = $income_schedule_view->GridAddRowCount;
}

// Initialize aggregate
$income_schedule_view->RowType = ROWTYPE_AGGREGATEINIT;
$income_schedule_view->resetAttributes();
$income_schedule_view_grid->renderRow();
if ($income_schedule_view_grid->isGridAdd())
	$income_schedule_view_grid->RowIndex = 0;
if ($income_schedule_view_grid->isGridEdit())
	$income_schedule_view_grid->RowIndex = 0;
while ($income_schedule_view_grid->RecordCount < $income_schedule_view_grid->StopRecord) {
	$income_schedule_view_grid->RecordCount++;
	if ($income_schedule_view_grid->RecordCount >= $income_schedule_view_grid->StartRecord) {
		$income_schedule_view_grid->RowCount++;
		if ($income_schedule_view_grid->isGridAdd() || $income_schedule_view_grid->isGridEdit() || $income_schedule_view->isConfirm()) {
			$income_schedule_view_grid->RowIndex++;
			$CurrentForm->Index = $income_schedule_view_grid->RowIndex;
			if ($CurrentForm->hasValue($income_schedule_view_grid->FormActionName) && ($income_schedule_view->isConfirm() || $income_schedule_view_grid->EventCancelled))
				$income_schedule_view_grid->RowAction = strval($CurrentForm->getValue($income_schedule_view_grid->FormActionName));
			elseif ($income_schedule_view_grid->isGridAdd())
				$income_schedule_view_grid->RowAction = "insert";
			else
				$income_schedule_view_grid->RowAction = "";
		}

		// Set up key count
		$income_schedule_view_grid->KeyCount = $income_schedule_view_grid->RowIndex;

		// Init row class and style
		$income_schedule_view->resetAttributes();
		$income_schedule_view->CssClass = "";
		if ($income_schedule_view_grid->isGridAdd()) {
			if ($income_schedule_view->CurrentMode == "copy") {
				$income_schedule_view_grid->loadRowValues($income_schedule_view_grid->Recordset); // Load row values
				$income_schedule_view_grid->setRecordKey($income_schedule_view_grid->RowOldKey, $income_schedule_view_grid->Recordset); // Set old record key
			} else {
				$income_schedule_view_grid->loadRowValues(); // Load default values
				$income_schedule_view_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$income_schedule_view_grid->loadRowValues($income_schedule_view_grid->Recordset); // Load row values
		}
		$income_schedule_view->RowType = ROWTYPE_VIEW; // Render view
		if ($income_schedule_view_grid->isGridAdd()) // Grid add
			$income_schedule_view->RowType = ROWTYPE_ADD; // Render add
		if ($income_schedule_view_grid->isGridAdd() && $income_schedule_view->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$income_schedule_view_grid->restoreCurrentRowFormValues($income_schedule_view_grid->RowIndex); // Restore form values
		if ($income_schedule_view_grid->isGridEdit()) { // Grid edit
			if ($income_schedule_view->EventCancelled)
				$income_schedule_view_grid->restoreCurrentRowFormValues($income_schedule_view_grid->RowIndex); // Restore form values
			if ($income_schedule_view_grid->RowAction == "insert")
				$income_schedule_view->RowType = ROWTYPE_ADD; // Render add
			else
				$income_schedule_view->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($income_schedule_view_grid->isGridEdit() && ($income_schedule_view->RowType == ROWTYPE_EDIT || $income_schedule_view->RowType == ROWTYPE_ADD) && $income_schedule_view->EventCancelled) // Update failed
			$income_schedule_view_grid->restoreCurrentRowFormValues($income_schedule_view_grid->RowIndex); // Restore form values
		if ($income_schedule_view->RowType == ROWTYPE_EDIT) // Edit row
			$income_schedule_view_grid->EditRowCount++;
		if ($income_schedule_view->isConfirm()) // Confirm row
			$income_schedule_view_grid->restoreCurrentRowFormValues($income_schedule_view_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$income_schedule_view->RowAttrs->merge(["data-rowindex" => $income_schedule_view_grid->RowCount, "id" => "r" . $income_schedule_view_grid->RowCount . "_income_schedule_view", "data-rowtype" => $income_schedule_view->RowType]);

		// Render row
		$income_schedule_view_grid->renderRow();

		// Render list options
		$income_schedule_view_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($income_schedule_view_grid->RowAction != "delete" && $income_schedule_view_grid->RowAction != "insertdelete" && !($income_schedule_view_grid->RowAction == "insert" && $income_schedule_view->isConfirm() && $income_schedule_view_grid->emptyRow())) {
?>
	<tr <?php echo $income_schedule_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$income_schedule_view_grid->ListOptions->render("body", "left", $income_schedule_view_grid->RowCount);
?>
	<?php if ($income_schedule_view_grid->LAName->Visible) { // LAName ?>
		<td data-name="LAName" <?php echo $income_schedule_view_grid->LAName->cellAttributes() ?>>
<?php if ($income_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_LAName" class="form-group">
<input type="text" data-table="income_schedule_view" data-field="x_LAName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_LAName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_LAName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->LAName->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->LAName->EditValue ?>"<?php echo $income_schedule_view_grid->LAName->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_schedule_view" data-field="x_LAName" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_LAName" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($income_schedule_view_grid->LAName->OldValue) ?>">
<?php } ?>
<?php if ($income_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_LAName" class="form-group">
<input type="text" data-table="income_schedule_view" data-field="x_LAName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_LAName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_LAName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->LAName->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->LAName->EditValue ?>"<?php echo $income_schedule_view_grid->LAName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($income_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_LAName">
<span<?php echo $income_schedule_view_grid->LAName->viewAttributes() ?>><?php echo $income_schedule_view_grid->LAName->getViewValue() ?></span>
</span>
<?php if (!$income_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_LAName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_LAName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($income_schedule_view_grid->LAName->FormValue) ?>">
<input type="hidden" data-table="income_schedule_view" data-field="x_LAName" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_LAName" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($income_schedule_view_grid->LAName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_LAName" name="fincome_schedule_viewgrid$x<?php echo $income_schedule_view_grid->RowIndex ?>_LAName" id="fincome_schedule_viewgrid$x<?php echo $income_schedule_view_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($income_schedule_view_grid->LAName->FormValue) ?>">
<input type="hidden" data-table="income_schedule_view" data-field="x_LAName" name="fincome_schedule_viewgrid$o<?php echo $income_schedule_view_grid->RowIndex ?>_LAName" id="fincome_schedule_viewgrid$o<?php echo $income_schedule_view_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($income_schedule_view_grid->LAName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($income_schedule_view_grid->NRC->Visible) { // NRC ?>
		<td data-name="NRC" <?php echo $income_schedule_view_grid->NRC->cellAttributes() ?>>
<?php if ($income_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_NRC" class="form-group">
<input type="text" data-table="income_schedule_view" data-field="x_NRC" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_NRC" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->NRC->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->NRC->EditValue ?>"<?php echo $income_schedule_view_grid->NRC->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_schedule_view" data-field="x_NRC" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_NRC" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($income_schedule_view_grid->NRC->OldValue) ?>">
<?php } ?>
<?php if ($income_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_NRC" class="form-group">
<input type="text" data-table="income_schedule_view" data-field="x_NRC" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_NRC" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->NRC->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->NRC->EditValue ?>"<?php echo $income_schedule_view_grid->NRC->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($income_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_NRC">
<span<?php echo $income_schedule_view_grid->NRC->viewAttributes() ?>><?php echo $income_schedule_view_grid->NRC->getViewValue() ?></span>
</span>
<?php if (!$income_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_NRC" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_NRC" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($income_schedule_view_grid->NRC->FormValue) ?>">
<input type="hidden" data-table="income_schedule_view" data-field="x_NRC" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_NRC" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($income_schedule_view_grid->NRC->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_NRC" name="fincome_schedule_viewgrid$x<?php echo $income_schedule_view_grid->RowIndex ?>_NRC" id="fincome_schedule_viewgrid$x<?php echo $income_schedule_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($income_schedule_view_grid->NRC->FormValue) ?>">
<input type="hidden" data-table="income_schedule_view" data-field="x_NRC" name="fincome_schedule_viewgrid$o<?php echo $income_schedule_view_grid->RowIndex ?>_NRC" id="fincome_schedule_viewgrid$o<?php echo $income_schedule_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($income_schedule_view_grid->NRC->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($income_schedule_view_grid->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $income_schedule_view_grid->Surname->cellAttributes() ?>>
<?php if ($income_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_Surname" class="form-group">
<input type="text" data-table="income_schedule_view" data-field="x_Surname" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_Surname" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->Surname->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->Surname->EditValue ?>"<?php echo $income_schedule_view_grid->Surname->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_schedule_view" data-field="x_Surname" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_Surname" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($income_schedule_view_grid->Surname->OldValue) ?>">
<?php } ?>
<?php if ($income_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_Surname" class="form-group">
<input type="text" data-table="income_schedule_view" data-field="x_Surname" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_Surname" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->Surname->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->Surname->EditValue ?>"<?php echo $income_schedule_view_grid->Surname->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($income_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_Surname">
<span<?php echo $income_schedule_view_grid->Surname->viewAttributes() ?>><?php echo $income_schedule_view_grid->Surname->getViewValue() ?></span>
</span>
<?php if (!$income_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_Surname" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_Surname" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($income_schedule_view_grid->Surname->FormValue) ?>">
<input type="hidden" data-table="income_schedule_view" data-field="x_Surname" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_Surname" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($income_schedule_view_grid->Surname->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_Surname" name="fincome_schedule_viewgrid$x<?php echo $income_schedule_view_grid->RowIndex ?>_Surname" id="fincome_schedule_viewgrid$x<?php echo $income_schedule_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($income_schedule_view_grid->Surname->FormValue) ?>">
<input type="hidden" data-table="income_schedule_view" data-field="x_Surname" name="fincome_schedule_viewgrid$o<?php echo $income_schedule_view_grid->RowIndex ?>_Surname" id="fincome_schedule_viewgrid$o<?php echo $income_schedule_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($income_schedule_view_grid->Surname->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($income_schedule_view_grid->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $income_schedule_view_grid->MiddleName->cellAttributes() ?>>
<?php if ($income_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_MiddleName" class="form-group">
<input type="text" data-table="income_schedule_view" data-field="x_MiddleName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_MiddleName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->MiddleName->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->MiddleName->EditValue ?>"<?php echo $income_schedule_view_grid->MiddleName->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_schedule_view" data-field="x_MiddleName" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_MiddleName" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($income_schedule_view_grid->MiddleName->OldValue) ?>">
<?php } ?>
<?php if ($income_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_MiddleName" class="form-group">
<input type="text" data-table="income_schedule_view" data-field="x_MiddleName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_MiddleName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->MiddleName->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->MiddleName->EditValue ?>"<?php echo $income_schedule_view_grid->MiddleName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($income_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_MiddleName">
<span<?php echo $income_schedule_view_grid->MiddleName->viewAttributes() ?>><?php echo $income_schedule_view_grid->MiddleName->getViewValue() ?></span>
</span>
<?php if (!$income_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_MiddleName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_MiddleName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($income_schedule_view_grid->MiddleName->FormValue) ?>">
<input type="hidden" data-table="income_schedule_view" data-field="x_MiddleName" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_MiddleName" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($income_schedule_view_grid->MiddleName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_MiddleName" name="fincome_schedule_viewgrid$x<?php echo $income_schedule_view_grid->RowIndex ?>_MiddleName" id="fincome_schedule_viewgrid$x<?php echo $income_schedule_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($income_schedule_view_grid->MiddleName->FormValue) ?>">
<input type="hidden" data-table="income_schedule_view" data-field="x_MiddleName" name="fincome_schedule_viewgrid$o<?php echo $income_schedule_view_grid->RowIndex ?>_MiddleName" id="fincome_schedule_viewgrid$o<?php echo $income_schedule_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($income_schedule_view_grid->MiddleName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($income_schedule_view_grid->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $income_schedule_view_grid->FirstName->cellAttributes() ?>>
<?php if ($income_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_FirstName" class="form-group">
<input type="text" data-table="income_schedule_view" data-field="x_FirstName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_FirstName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->FirstName->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->FirstName->EditValue ?>"<?php echo $income_schedule_view_grid->FirstName->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_schedule_view" data-field="x_FirstName" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_FirstName" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($income_schedule_view_grid->FirstName->OldValue) ?>">
<?php } ?>
<?php if ($income_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_FirstName" class="form-group">
<input type="text" data-table="income_schedule_view" data-field="x_FirstName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_FirstName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->FirstName->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->FirstName->EditValue ?>"<?php echo $income_schedule_view_grid->FirstName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($income_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_FirstName">
<span<?php echo $income_schedule_view_grid->FirstName->viewAttributes() ?>><?php echo $income_schedule_view_grid->FirstName->getViewValue() ?></span>
</span>
<?php if (!$income_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_FirstName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_FirstName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($income_schedule_view_grid->FirstName->FormValue) ?>">
<input type="hidden" data-table="income_schedule_view" data-field="x_FirstName" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_FirstName" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($income_schedule_view_grid->FirstName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_FirstName" name="fincome_schedule_viewgrid$x<?php echo $income_schedule_view_grid->RowIndex ?>_FirstName" id="fincome_schedule_viewgrid$x<?php echo $income_schedule_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($income_schedule_view_grid->FirstName->FormValue) ?>">
<input type="hidden" data-table="income_schedule_view" data-field="x_FirstName" name="fincome_schedule_viewgrid$o<?php echo $income_schedule_view_grid->RowIndex ?>_FirstName" id="fincome_schedule_viewgrid$o<?php echo $income_schedule_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($income_schedule_view_grid->FirstName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($income_schedule_view_grid->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName" <?php echo $income_schedule_view_grid->PositionName->cellAttributes() ?>>
<?php if ($income_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_PositionName" class="form-group">
<input type="text" data-table="income_schedule_view" data-field="x_PositionName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_PositionName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->PositionName->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->PositionName->EditValue ?>"<?php echo $income_schedule_view_grid->PositionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_schedule_view" data-field="x_PositionName" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_PositionName" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($income_schedule_view_grid->PositionName->OldValue) ?>">
<?php } ?>
<?php if ($income_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_PositionName" class="form-group">
<input type="text" data-table="income_schedule_view" data-field="x_PositionName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_PositionName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->PositionName->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->PositionName->EditValue ?>"<?php echo $income_schedule_view_grid->PositionName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($income_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_PositionName">
<span<?php echo $income_schedule_view_grid->PositionName->viewAttributes() ?>><?php echo $income_schedule_view_grid->PositionName->getViewValue() ?></span>
</span>
<?php if (!$income_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_PositionName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_PositionName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($income_schedule_view_grid->PositionName->FormValue) ?>">
<input type="hidden" data-table="income_schedule_view" data-field="x_PositionName" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_PositionName" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($income_schedule_view_grid->PositionName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_PositionName" name="fincome_schedule_viewgrid$x<?php echo $income_schedule_view_grid->RowIndex ?>_PositionName" id="fincome_schedule_viewgrid$x<?php echo $income_schedule_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($income_schedule_view_grid->PositionName->FormValue) ?>">
<input type="hidden" data-table="income_schedule_view" data-field="x_PositionName" name="fincome_schedule_viewgrid$o<?php echo $income_schedule_view_grid->RowIndex ?>_PositionName" id="fincome_schedule_viewgrid$o<?php echo $income_schedule_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($income_schedule_view_grid->PositionName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($income_schedule_view_grid->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $income_schedule_view_grid->EmployeeID->cellAttributes() ?>>
<?php if ($income_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_EmployeeID" class="form-group">
<input type="text" data-table="income_schedule_view" data-field="x_EmployeeID" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_EmployeeID" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->EmployeeID->EditValue ?>"<?php echo $income_schedule_view_grid->EmployeeID->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_schedule_view" data-field="x_EmployeeID" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_EmployeeID" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($income_schedule_view_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($income_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="income_schedule_view" data-field="x_EmployeeID" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_EmployeeID" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->EmployeeID->EditValue ?>"<?php echo $income_schedule_view_grid->EmployeeID->editAttributes() ?>>
<input type="hidden" data-table="income_schedule_view" data-field="x_EmployeeID" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_EmployeeID" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($income_schedule_view_grid->EmployeeID->OldValue != null ? $income_schedule_view_grid->EmployeeID->OldValue : $income_schedule_view_grid->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php if ($income_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_EmployeeID">
<span<?php echo $income_schedule_view_grid->EmployeeID->viewAttributes() ?>><?php echo $income_schedule_view_grid->EmployeeID->getViewValue() ?></span>
</span>
<?php if (!$income_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_EmployeeID" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_EmployeeID" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($income_schedule_view_grid->EmployeeID->FormValue) ?>">
<input type="hidden" data-table="income_schedule_view" data-field="x_EmployeeID" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_EmployeeID" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($income_schedule_view_grid->EmployeeID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_EmployeeID" name="fincome_schedule_viewgrid$x<?php echo $income_schedule_view_grid->RowIndex ?>_EmployeeID" id="fincome_schedule_viewgrid$x<?php echo $income_schedule_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($income_schedule_view_grid->EmployeeID->FormValue) ?>">
<input type="hidden" data-table="income_schedule_view" data-field="x_EmployeeID" name="fincome_schedule_viewgrid$o<?php echo $income_schedule_view_grid->RowIndex ?>_EmployeeID" id="fincome_schedule_viewgrid$o<?php echo $income_schedule_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($income_schedule_view_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($income_schedule_view_grid->PayrollDate->Visible) { // PayrollDate ?>
		<td data-name="PayrollDate" <?php echo $income_schedule_view_grid->PayrollDate->cellAttributes() ?>>
<?php if ($income_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_PayrollDate" class="form-group">
<input type="text" data-table="income_schedule_view" data-field="x_PayrollDate" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_PayrollDate" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_PayrollDate" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->PayrollDate->EditValue ?>"<?php echo $income_schedule_view_grid->PayrollDate->editAttributes() ?>>
<?php if (!$income_schedule_view_grid->PayrollDate->ReadOnly && !$income_schedule_view_grid->PayrollDate->Disabled && !isset($income_schedule_view_grid->PayrollDate->EditAttrs["readonly"]) && !isset($income_schedule_view_grid->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fincome_schedule_viewgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fincome_schedule_viewgrid", "x<?php echo $income_schedule_view_grid->RowIndex ?>_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="income_schedule_view" data-field="x_PayrollDate" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_PayrollDate" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($income_schedule_view_grid->PayrollDate->OldValue) ?>">
<?php } ?>
<?php if ($income_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_PayrollDate" class="form-group">
<input type="text" data-table="income_schedule_view" data-field="x_PayrollDate" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_PayrollDate" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_PayrollDate" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->PayrollDate->EditValue ?>"<?php echo $income_schedule_view_grid->PayrollDate->editAttributes() ?>>
<?php if (!$income_schedule_view_grid->PayrollDate->ReadOnly && !$income_schedule_view_grid->PayrollDate->Disabled && !isset($income_schedule_view_grid->PayrollDate->EditAttrs["readonly"]) && !isset($income_schedule_view_grid->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fincome_schedule_viewgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fincome_schedule_viewgrid", "x<?php echo $income_schedule_view_grid->RowIndex ?>_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($income_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_PayrollDate">
<span<?php echo $income_schedule_view_grid->PayrollDate->viewAttributes() ?>><?php echo $income_schedule_view_grid->PayrollDate->getViewValue() ?></span>
</span>
<?php if (!$income_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_PayrollDate" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_PayrollDate" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($income_schedule_view_grid->PayrollDate->FormValue) ?>">
<input type="hidden" data-table="income_schedule_view" data-field="x_PayrollDate" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_PayrollDate" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($income_schedule_view_grid->PayrollDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_PayrollDate" name="fincome_schedule_viewgrid$x<?php echo $income_schedule_view_grid->RowIndex ?>_PayrollDate" id="fincome_schedule_viewgrid$x<?php echo $income_schedule_view_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($income_schedule_view_grid->PayrollDate->FormValue) ?>">
<input type="hidden" data-table="income_schedule_view" data-field="x_PayrollDate" name="fincome_schedule_viewgrid$o<?php echo $income_schedule_view_grid->RowIndex ?>_PayrollDate" id="fincome_schedule_viewgrid$o<?php echo $income_schedule_view_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($income_schedule_view_grid->PayrollDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($income_schedule_view_grid->Income->Visible) { // Income ?>
		<td data-name="Income" <?php echo $income_schedule_view_grid->Income->cellAttributes() ?>>
<?php if ($income_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_Income" class="form-group">
<input type="text" data-table="income_schedule_view" data-field="x_Income" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_Income" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_Income" size="30" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->Income->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->Income->EditValue ?>"<?php echo $income_schedule_view_grid->Income->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_schedule_view" data-field="x_Income" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_Income" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_Income" value="<?php echo HtmlEncode($income_schedule_view_grid->Income->OldValue) ?>">
<?php } ?>
<?php if ($income_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_Income" class="form-group">
<input type="text" data-table="income_schedule_view" data-field="x_Income" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_Income" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_Income" size="30" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->Income->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->Income->EditValue ?>"<?php echo $income_schedule_view_grid->Income->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($income_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_Income">
<span<?php echo $income_schedule_view_grid->Income->viewAttributes() ?>><?php echo $income_schedule_view_grid->Income->getViewValue() ?></span>
</span>
<?php if (!$income_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_Income" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_Income" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_Income" value="<?php echo HtmlEncode($income_schedule_view_grid->Income->FormValue) ?>">
<input type="hidden" data-table="income_schedule_view" data-field="x_Income" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_Income" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_Income" value="<?php echo HtmlEncode($income_schedule_view_grid->Income->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_Income" name="fincome_schedule_viewgrid$x<?php echo $income_schedule_view_grid->RowIndex ?>_Income" id="fincome_schedule_viewgrid$x<?php echo $income_schedule_view_grid->RowIndex ?>_Income" value="<?php echo HtmlEncode($income_schedule_view_grid->Income->FormValue) ?>">
<input type="hidden" data-table="income_schedule_view" data-field="x_Income" name="fincome_schedule_viewgrid$o<?php echo $income_schedule_view_grid->RowIndex ?>_Income" id="fincome_schedule_viewgrid$o<?php echo $income_schedule_view_grid->RowIndex ?>_Income" value="<?php echo HtmlEncode($income_schedule_view_grid->Income->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($income_schedule_view_grid->IncomeName->Visible) { // IncomeName ?>
		<td data-name="IncomeName" <?php echo $income_schedule_view_grid->IncomeName->cellAttributes() ?>>
<?php if ($income_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_IncomeName" class="form-group">
<input type="text" data-table="income_schedule_view" data-field="x_IncomeName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_IncomeName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_IncomeName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->IncomeName->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->IncomeName->EditValue ?>"<?php echo $income_schedule_view_grid->IncomeName->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_schedule_view" data-field="x_IncomeName" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_IncomeName" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_IncomeName" value="<?php echo HtmlEncode($income_schedule_view_grid->IncomeName->OldValue) ?>">
<?php } ?>
<?php if ($income_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_IncomeName" class="form-group">
<input type="text" data-table="income_schedule_view" data-field="x_IncomeName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_IncomeName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_IncomeName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->IncomeName->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->IncomeName->EditValue ?>"<?php echo $income_schedule_view_grid->IncomeName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($income_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_IncomeName">
<span<?php echo $income_schedule_view_grid->IncomeName->viewAttributes() ?>><?php echo $income_schedule_view_grid->IncomeName->getViewValue() ?></span>
</span>
<?php if (!$income_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_IncomeName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_IncomeName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_IncomeName" value="<?php echo HtmlEncode($income_schedule_view_grid->IncomeName->FormValue) ?>">
<input type="hidden" data-table="income_schedule_view" data-field="x_IncomeName" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_IncomeName" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_IncomeName" value="<?php echo HtmlEncode($income_schedule_view_grid->IncomeName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_IncomeName" name="fincome_schedule_viewgrid$x<?php echo $income_schedule_view_grid->RowIndex ?>_IncomeName" id="fincome_schedule_viewgrid$x<?php echo $income_schedule_view_grid->RowIndex ?>_IncomeName" value="<?php echo HtmlEncode($income_schedule_view_grid->IncomeName->FormValue) ?>">
<input type="hidden" data-table="income_schedule_view" data-field="x_IncomeName" name="fincome_schedule_viewgrid$o<?php echo $income_schedule_view_grid->RowIndex ?>_IncomeName" id="fincome_schedule_viewgrid$o<?php echo $income_schedule_view_grid->RowIndex ?>_IncomeName" value="<?php echo HtmlEncode($income_schedule_view_grid->IncomeName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($income_schedule_view_grid->PeriodCode->Visible) { // PeriodCode ?>
		<td data-name="PeriodCode" <?php echo $income_schedule_view_grid->PeriodCode->cellAttributes() ?>>
<?php if ($income_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_PeriodCode" class="form-group"></span>
<input type="hidden" data-table="income_schedule_view" data-field="x_PeriodCode" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_PeriodCode" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($income_schedule_view_grid->PeriodCode->OldValue) ?>">
<?php } ?>
<?php if ($income_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($income_schedule_view_grid->PeriodCode->getSessionValue() != "") { ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_PeriodCode" class="form-group">
<span<?php echo $income_schedule_view_grid->PeriodCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($income_schedule_view_grid->PeriodCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_PeriodCode" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($income_schedule_view_grid->PeriodCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_PeriodCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="income_schedule_view" data-field="x_PeriodCode" data-value-separator="<?php echo $income_schedule_view_grid->PeriodCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_PeriodCode" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_PeriodCode"<?php echo $income_schedule_view_grid->PeriodCode->editAttributes() ?>>
			<?php echo $income_schedule_view_grid->PeriodCode->selectOptionListHtml("x{$income_schedule_view_grid->RowIndex}_PeriodCode") ?>
		</select>
</div>
<?php echo $income_schedule_view_grid->PeriodCode->Lookup->getParamTag($income_schedule_view_grid, "p_x" . $income_schedule_view_grid->RowIndex . "_PeriodCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($income_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $income_schedule_view_grid->RowCount ?>_income_schedule_view_PeriodCode">
<span<?php echo $income_schedule_view_grid->PeriodCode->viewAttributes() ?>><?php echo $income_schedule_view_grid->PeriodCode->getViewValue() ?></span>
</span>
<?php if (!$income_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_PeriodCode" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_PeriodCode" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($income_schedule_view_grid->PeriodCode->FormValue) ?>">
<input type="hidden" data-table="income_schedule_view" data-field="x_PeriodCode" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_PeriodCode" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($income_schedule_view_grid->PeriodCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_PeriodCode" name="fincome_schedule_viewgrid$x<?php echo $income_schedule_view_grid->RowIndex ?>_PeriodCode" id="fincome_schedule_viewgrid$x<?php echo $income_schedule_view_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($income_schedule_view_grid->PeriodCode->FormValue) ?>">
<input type="hidden" data-table="income_schedule_view" data-field="x_PeriodCode" name="fincome_schedule_viewgrid$o<?php echo $income_schedule_view_grid->RowIndex ?>_PeriodCode" id="fincome_schedule_viewgrid$o<?php echo $income_schedule_view_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($income_schedule_view_grid->PeriodCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$income_schedule_view_grid->ListOptions->render("body", "right", $income_schedule_view_grid->RowCount);
?>
	</tr>
<?php if ($income_schedule_view->RowType == ROWTYPE_ADD || $income_schedule_view->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fincome_schedule_viewgrid", "load"], function() {
	fincome_schedule_viewgrid.updateLists(<?php echo $income_schedule_view_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$income_schedule_view_grid->isGridAdd() || $income_schedule_view->CurrentMode == "copy")
		if (!$income_schedule_view_grid->Recordset->EOF)
			$income_schedule_view_grid->Recordset->moveNext();
}
?>
<?php
	if ($income_schedule_view->CurrentMode == "add" || $income_schedule_view->CurrentMode == "copy" || $income_schedule_view->CurrentMode == "edit") {
		$income_schedule_view_grid->RowIndex = '$rowindex$';
		$income_schedule_view_grid->loadRowValues();

		// Set row properties
		$income_schedule_view->resetAttributes();
		$income_schedule_view->RowAttrs->merge(["data-rowindex" => $income_schedule_view_grid->RowIndex, "id" => "r0_income_schedule_view", "data-rowtype" => ROWTYPE_ADD]);
		$income_schedule_view->RowAttrs->appendClass("ew-template");
		$income_schedule_view->RowType = ROWTYPE_ADD;

		// Render row
		$income_schedule_view_grid->renderRow();

		// Render list options
		$income_schedule_view_grid->renderListOptions();
		$income_schedule_view_grid->StartRowCount = 0;
?>
	<tr <?php echo $income_schedule_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$income_schedule_view_grid->ListOptions->render("body", "left", $income_schedule_view_grid->RowIndex);
?>
	<?php if ($income_schedule_view_grid->LAName->Visible) { // LAName ?>
		<td data-name="LAName">
<?php if (!$income_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_income_schedule_view_LAName" class="form-group income_schedule_view_LAName">
<input type="text" data-table="income_schedule_view" data-field="x_LAName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_LAName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_LAName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->LAName->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->LAName->EditValue ?>"<?php echo $income_schedule_view_grid->LAName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_income_schedule_view_LAName" class="form-group income_schedule_view_LAName">
<span<?php echo $income_schedule_view_grid->LAName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($income_schedule_view_grid->LAName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="income_schedule_view" data-field="x_LAName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_LAName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($income_schedule_view_grid->LAName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_LAName" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_LAName" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($income_schedule_view_grid->LAName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($income_schedule_view_grid->NRC->Visible) { // NRC ?>
		<td data-name="NRC">
<?php if (!$income_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_income_schedule_view_NRC" class="form-group income_schedule_view_NRC">
<input type="text" data-table="income_schedule_view" data-field="x_NRC" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_NRC" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->NRC->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->NRC->EditValue ?>"<?php echo $income_schedule_view_grid->NRC->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_income_schedule_view_NRC" class="form-group income_schedule_view_NRC">
<span<?php echo $income_schedule_view_grid->NRC->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($income_schedule_view_grid->NRC->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="income_schedule_view" data-field="x_NRC" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_NRC" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($income_schedule_view_grid->NRC->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_NRC" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_NRC" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($income_schedule_view_grid->NRC->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($income_schedule_view_grid->Surname->Visible) { // Surname ?>
		<td data-name="Surname">
<?php if (!$income_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_income_schedule_view_Surname" class="form-group income_schedule_view_Surname">
<input type="text" data-table="income_schedule_view" data-field="x_Surname" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_Surname" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->Surname->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->Surname->EditValue ?>"<?php echo $income_schedule_view_grid->Surname->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_income_schedule_view_Surname" class="form-group income_schedule_view_Surname">
<span<?php echo $income_schedule_view_grid->Surname->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($income_schedule_view_grid->Surname->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="income_schedule_view" data-field="x_Surname" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_Surname" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($income_schedule_view_grid->Surname->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_Surname" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_Surname" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($income_schedule_view_grid->Surname->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($income_schedule_view_grid->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName">
<?php if (!$income_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_income_schedule_view_MiddleName" class="form-group income_schedule_view_MiddleName">
<input type="text" data-table="income_schedule_view" data-field="x_MiddleName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_MiddleName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->MiddleName->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->MiddleName->EditValue ?>"<?php echo $income_schedule_view_grid->MiddleName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_income_schedule_view_MiddleName" class="form-group income_schedule_view_MiddleName">
<span<?php echo $income_schedule_view_grid->MiddleName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($income_schedule_view_grid->MiddleName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="income_schedule_view" data-field="x_MiddleName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_MiddleName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($income_schedule_view_grid->MiddleName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_MiddleName" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_MiddleName" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($income_schedule_view_grid->MiddleName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($income_schedule_view_grid->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName">
<?php if (!$income_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_income_schedule_view_FirstName" class="form-group income_schedule_view_FirstName">
<input type="text" data-table="income_schedule_view" data-field="x_FirstName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_FirstName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->FirstName->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->FirstName->EditValue ?>"<?php echo $income_schedule_view_grid->FirstName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_income_schedule_view_FirstName" class="form-group income_schedule_view_FirstName">
<span<?php echo $income_schedule_view_grid->FirstName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($income_schedule_view_grid->FirstName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="income_schedule_view" data-field="x_FirstName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_FirstName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($income_schedule_view_grid->FirstName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_FirstName" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_FirstName" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($income_schedule_view_grid->FirstName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($income_schedule_view_grid->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName">
<?php if (!$income_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_income_schedule_view_PositionName" class="form-group income_schedule_view_PositionName">
<input type="text" data-table="income_schedule_view" data-field="x_PositionName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_PositionName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->PositionName->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->PositionName->EditValue ?>"<?php echo $income_schedule_view_grid->PositionName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_income_schedule_view_PositionName" class="form-group income_schedule_view_PositionName">
<span<?php echo $income_schedule_view_grid->PositionName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($income_schedule_view_grid->PositionName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="income_schedule_view" data-field="x_PositionName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_PositionName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($income_schedule_view_grid->PositionName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_PositionName" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_PositionName" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($income_schedule_view_grid->PositionName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($income_schedule_view_grid->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID">
<?php if (!$income_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_income_schedule_view_EmployeeID" class="form-group income_schedule_view_EmployeeID">
<input type="text" data-table="income_schedule_view" data-field="x_EmployeeID" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_EmployeeID" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->EmployeeID->EditValue ?>"<?php echo $income_schedule_view_grid->EmployeeID->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_income_schedule_view_EmployeeID" class="form-group income_schedule_view_EmployeeID">
<span<?php echo $income_schedule_view_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($income_schedule_view_grid->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="income_schedule_view" data-field="x_EmployeeID" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_EmployeeID" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($income_schedule_view_grid->EmployeeID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_EmployeeID" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_EmployeeID" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($income_schedule_view_grid->EmployeeID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($income_schedule_view_grid->PayrollDate->Visible) { // PayrollDate ?>
		<td data-name="PayrollDate">
<?php if (!$income_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_income_schedule_view_PayrollDate" class="form-group income_schedule_view_PayrollDate">
<input type="text" data-table="income_schedule_view" data-field="x_PayrollDate" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_PayrollDate" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_PayrollDate" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->PayrollDate->EditValue ?>"<?php echo $income_schedule_view_grid->PayrollDate->editAttributes() ?>>
<?php if (!$income_schedule_view_grid->PayrollDate->ReadOnly && !$income_schedule_view_grid->PayrollDate->Disabled && !isset($income_schedule_view_grid->PayrollDate->EditAttrs["readonly"]) && !isset($income_schedule_view_grid->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fincome_schedule_viewgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fincome_schedule_viewgrid", "x<?php echo $income_schedule_view_grid->RowIndex ?>_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_income_schedule_view_PayrollDate" class="form-group income_schedule_view_PayrollDate">
<span<?php echo $income_schedule_view_grid->PayrollDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($income_schedule_view_grid->PayrollDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="income_schedule_view" data-field="x_PayrollDate" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_PayrollDate" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($income_schedule_view_grid->PayrollDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_PayrollDate" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_PayrollDate" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($income_schedule_view_grid->PayrollDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($income_schedule_view_grid->Income->Visible) { // Income ?>
		<td data-name="Income">
<?php if (!$income_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_income_schedule_view_Income" class="form-group income_schedule_view_Income">
<input type="text" data-table="income_schedule_view" data-field="x_Income" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_Income" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_Income" size="30" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->Income->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->Income->EditValue ?>"<?php echo $income_schedule_view_grid->Income->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_income_schedule_view_Income" class="form-group income_schedule_view_Income">
<span<?php echo $income_schedule_view_grid->Income->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($income_schedule_view_grid->Income->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="income_schedule_view" data-field="x_Income" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_Income" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_Income" value="<?php echo HtmlEncode($income_schedule_view_grid->Income->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_Income" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_Income" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_Income" value="<?php echo HtmlEncode($income_schedule_view_grid->Income->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($income_schedule_view_grid->IncomeName->Visible) { // IncomeName ?>
		<td data-name="IncomeName">
<?php if (!$income_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_income_schedule_view_IncomeName" class="form-group income_schedule_view_IncomeName">
<input type="text" data-table="income_schedule_view" data-field="x_IncomeName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_IncomeName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_IncomeName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($income_schedule_view_grid->IncomeName->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_grid->IncomeName->EditValue ?>"<?php echo $income_schedule_view_grid->IncomeName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_income_schedule_view_IncomeName" class="form-group income_schedule_view_IncomeName">
<span<?php echo $income_schedule_view_grid->IncomeName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($income_schedule_view_grid->IncomeName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="income_schedule_view" data-field="x_IncomeName" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_IncomeName" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_IncomeName" value="<?php echo HtmlEncode($income_schedule_view_grid->IncomeName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_IncomeName" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_IncomeName" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_IncomeName" value="<?php echo HtmlEncode($income_schedule_view_grid->IncomeName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($income_schedule_view_grid->PeriodCode->Visible) { // PeriodCode ?>
		<td data-name="PeriodCode">
<?php if (!$income_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_income_schedule_view_PeriodCode" class="form-group income_schedule_view_PeriodCode"></span>
<?php } else { ?>
<span id="el$rowindex$_income_schedule_view_PeriodCode" class="form-group income_schedule_view_PeriodCode">
<span<?php echo $income_schedule_view_grid->PeriodCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($income_schedule_view_grid->PeriodCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="income_schedule_view" data-field="x_PeriodCode" name="x<?php echo $income_schedule_view_grid->RowIndex ?>_PeriodCode" id="x<?php echo $income_schedule_view_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($income_schedule_view_grid->PeriodCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="income_schedule_view" data-field="x_PeriodCode" name="o<?php echo $income_schedule_view_grid->RowIndex ?>_PeriodCode" id="o<?php echo $income_schedule_view_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($income_schedule_view_grid->PeriodCode->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$income_schedule_view_grid->ListOptions->render("body", "right", $income_schedule_view_grid->RowIndex);
?>
<script>
loadjs.ready(["fincome_schedule_viewgrid", "load"], function() {
	fincome_schedule_viewgrid.updateLists(<?php echo $income_schedule_view_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($income_schedule_view->CurrentMode == "add" || $income_schedule_view->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $income_schedule_view_grid->FormKeyCountName ?>" id="<?php echo $income_schedule_view_grid->FormKeyCountName ?>" value="<?php echo $income_schedule_view_grid->KeyCount ?>">
<?php echo $income_schedule_view_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($income_schedule_view->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $income_schedule_view_grid->FormKeyCountName ?>" id="<?php echo $income_schedule_view_grid->FormKeyCountName ?>" value="<?php echo $income_schedule_view_grid->KeyCount ?>">
<?php echo $income_schedule_view_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($income_schedule_view->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fincome_schedule_viewgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($income_schedule_view_grid->Recordset)
	$income_schedule_view_grid->Recordset->Close();
?>
<?php if ($income_schedule_view_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $income_schedule_view_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($income_schedule_view_grid->TotalRecords == 0 && !$income_schedule_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $income_schedule_view_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$income_schedule_view_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$income_schedule_view_grid->terminate();
?>