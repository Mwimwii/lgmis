<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($obligation_schedule_view_grid))
	$obligation_schedule_view_grid = new obligation_schedule_view_grid();

// Run the page
$obligation_schedule_view_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$obligation_schedule_view_grid->Page_Render();
?>
<?php if (!$obligation_schedule_view_grid->isExport()) { ?>
<script>
var fobligation_schedule_viewgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fobligation_schedule_viewgrid = new ew.Form("fobligation_schedule_viewgrid", "grid");
	fobligation_schedule_viewgrid.formKeyCountName = '<?php echo $obligation_schedule_view_grid->FormKeyCountName ?>';

	// Validate form
	fobligation_schedule_viewgrid.validate = function() {
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
			<?php if ($obligation_schedule_view_grid->LAName->Required) { ?>
				elm = this.getElements("x" + infix + "_LAName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $obligation_schedule_view_grid->LAName->caption(), $obligation_schedule_view_grid->LAName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($obligation_schedule_view_grid->NRC->Required) { ?>
				elm = this.getElements("x" + infix + "_NRC");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $obligation_schedule_view_grid->NRC->caption(), $obligation_schedule_view_grid->NRC->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($obligation_schedule_view_grid->Surname->Required) { ?>
				elm = this.getElements("x" + infix + "_Surname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $obligation_schedule_view_grid->Surname->caption(), $obligation_schedule_view_grid->Surname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($obligation_schedule_view_grid->MiddleName->Required) { ?>
				elm = this.getElements("x" + infix + "_MiddleName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $obligation_schedule_view_grid->MiddleName->caption(), $obligation_schedule_view_grid->MiddleName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($obligation_schedule_view_grid->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $obligation_schedule_view_grid->FirstName->caption(), $obligation_schedule_view_grid->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($obligation_schedule_view_grid->PositionName->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $obligation_schedule_view_grid->PositionName->caption(), $obligation_schedule_view_grid->PositionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($obligation_schedule_view_grid->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $obligation_schedule_view_grid->EmployeeID->caption(), $obligation_schedule_view_grid->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($obligation_schedule_view_grid->EmployeeID->errorMessage()) ?>");
			<?php if ($obligation_schedule_view_grid->PayrollDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $obligation_schedule_view_grid->PayrollDate->caption(), $obligation_schedule_view_grid->PayrollDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($obligation_schedule_view_grid->PayrollDate->errorMessage()) ?>");
			<?php if ($obligation_schedule_view_grid->ObligationAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_ObligationAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $obligation_schedule_view_grid->ObligationAmount->caption(), $obligation_schedule_view_grid->ObligationAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ObligationAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($obligation_schedule_view_grid->ObligationAmount->errorMessage()) ?>");
			<?php if ($obligation_schedule_view_grid->DeductionName->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $obligation_schedule_view_grid->DeductionName->caption(), $obligation_schedule_view_grid->DeductionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($obligation_schedule_view_grid->PeriodCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $obligation_schedule_view_grid->PeriodCode->caption(), $obligation_schedule_view_grid->PeriodCode->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fobligation_schedule_viewgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "LAName", false)) return false;
		if (ew.valueChanged(fobj, infix, "NRC", false)) return false;
		if (ew.valueChanged(fobj, infix, "Surname", false)) return false;
		if (ew.valueChanged(fobj, infix, "MiddleName", false)) return false;
		if (ew.valueChanged(fobj, infix, "FirstName", false)) return false;
		if (ew.valueChanged(fobj, infix, "PositionName", false)) return false;
		if (ew.valueChanged(fobj, infix, "EmployeeID", false)) return false;
		if (ew.valueChanged(fobj, infix, "PayrollDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ObligationAmount", false)) return false;
		if (ew.valueChanged(fobj, infix, "DeductionName", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fobligation_schedule_viewgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fobligation_schedule_viewgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fobligation_schedule_viewgrid");
});
</script>
<?php } ?>
<?php
$obligation_schedule_view_grid->renderOtherOptions();
?>
<?php if ($obligation_schedule_view_grid->TotalRecords > 0 || $obligation_schedule_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($obligation_schedule_view_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> obligation_schedule_view">
<?php if ($obligation_schedule_view_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $obligation_schedule_view_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fobligation_schedule_viewgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_obligation_schedule_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_obligation_schedule_viewgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$obligation_schedule_view->RowType = ROWTYPE_HEADER;

// Render list options
$obligation_schedule_view_grid->renderListOptions();

// Render list options (header, left)
$obligation_schedule_view_grid->ListOptions->render("header", "left");
?>
<?php if ($obligation_schedule_view_grid->LAName->Visible) { // LAName ?>
	<?php if ($obligation_schedule_view_grid->SortUrl($obligation_schedule_view_grid->LAName) == "") { ?>
		<th data-name="LAName" class="<?php echo $obligation_schedule_view_grid->LAName->headerCellClass() ?>"><div id="elh_obligation_schedule_view_LAName" class="obligation_schedule_view_LAName"><div class="ew-table-header-caption"><?php echo $obligation_schedule_view_grid->LAName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LAName" class="<?php echo $obligation_schedule_view_grid->LAName->headerCellClass() ?>"><div><div id="elh_obligation_schedule_view_LAName" class="obligation_schedule_view_LAName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_grid->LAName->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_grid->LAName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_grid->LAName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_grid->NRC->Visible) { // NRC ?>
	<?php if ($obligation_schedule_view_grid->SortUrl($obligation_schedule_view_grid->NRC) == "") { ?>
		<th data-name="NRC" class="<?php echo $obligation_schedule_view_grid->NRC->headerCellClass() ?>"><div id="elh_obligation_schedule_view_NRC" class="obligation_schedule_view_NRC"><div class="ew-table-header-caption"><?php echo $obligation_schedule_view_grid->NRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC" class="<?php echo $obligation_schedule_view_grid->NRC->headerCellClass() ?>"><div><div id="elh_obligation_schedule_view_NRC" class="obligation_schedule_view_NRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_grid->NRC->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_grid->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_grid->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_grid->Surname->Visible) { // Surname ?>
	<?php if ($obligation_schedule_view_grid->SortUrl($obligation_schedule_view_grid->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $obligation_schedule_view_grid->Surname->headerCellClass() ?>"><div id="elh_obligation_schedule_view_Surname" class="obligation_schedule_view_Surname"><div class="ew-table-header-caption"><?php echo $obligation_schedule_view_grid->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $obligation_schedule_view_grid->Surname->headerCellClass() ?>"><div><div id="elh_obligation_schedule_view_Surname" class="obligation_schedule_view_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_grid->Surname->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_grid->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_grid->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_grid->MiddleName->Visible) { // MiddleName ?>
	<?php if ($obligation_schedule_view_grid->SortUrl($obligation_schedule_view_grid->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $obligation_schedule_view_grid->MiddleName->headerCellClass() ?>"><div id="elh_obligation_schedule_view_MiddleName" class="obligation_schedule_view_MiddleName"><div class="ew-table-header-caption"><?php echo $obligation_schedule_view_grid->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $obligation_schedule_view_grid->MiddleName->headerCellClass() ?>"><div><div id="elh_obligation_schedule_view_MiddleName" class="obligation_schedule_view_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_grid->MiddleName->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_grid->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_grid->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_grid->FirstName->Visible) { // FirstName ?>
	<?php if ($obligation_schedule_view_grid->SortUrl($obligation_schedule_view_grid->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $obligation_schedule_view_grid->FirstName->headerCellClass() ?>"><div id="elh_obligation_schedule_view_FirstName" class="obligation_schedule_view_FirstName"><div class="ew-table-header-caption"><?php echo $obligation_schedule_view_grid->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $obligation_schedule_view_grid->FirstName->headerCellClass() ?>"><div><div id="elh_obligation_schedule_view_FirstName" class="obligation_schedule_view_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_grid->FirstName->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_grid->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_grid->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_grid->PositionName->Visible) { // PositionName ?>
	<?php if ($obligation_schedule_view_grid->SortUrl($obligation_schedule_view_grid->PositionName) == "") { ?>
		<th data-name="PositionName" class="<?php echo $obligation_schedule_view_grid->PositionName->headerCellClass() ?>"><div id="elh_obligation_schedule_view_PositionName" class="obligation_schedule_view_PositionName"><div class="ew-table-header-caption"><?php echo $obligation_schedule_view_grid->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionName" class="<?php echo $obligation_schedule_view_grid->PositionName->headerCellClass() ?>"><div><div id="elh_obligation_schedule_view_PositionName" class="obligation_schedule_view_PositionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_grid->PositionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_grid->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_grid->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_grid->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($obligation_schedule_view_grid->SortUrl($obligation_schedule_view_grid->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $obligation_schedule_view_grid->EmployeeID->headerCellClass() ?>"><div id="elh_obligation_schedule_view_EmployeeID" class="obligation_schedule_view_EmployeeID"><div class="ew-table-header-caption"><?php echo $obligation_schedule_view_grid->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $obligation_schedule_view_grid->EmployeeID->headerCellClass() ?>"><div><div id="elh_obligation_schedule_view_EmployeeID" class="obligation_schedule_view_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_grid->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_grid->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_grid->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_grid->PayrollDate->Visible) { // PayrollDate ?>
	<?php if ($obligation_schedule_view_grid->SortUrl($obligation_schedule_view_grid->PayrollDate) == "") { ?>
		<th data-name="PayrollDate" class="<?php echo $obligation_schedule_view_grid->PayrollDate->headerCellClass() ?>"><div id="elh_obligation_schedule_view_PayrollDate" class="obligation_schedule_view_PayrollDate"><div class="ew-table-header-caption"><?php echo $obligation_schedule_view_grid->PayrollDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollDate" class="<?php echo $obligation_schedule_view_grid->PayrollDate->headerCellClass() ?>"><div><div id="elh_obligation_schedule_view_PayrollDate" class="obligation_schedule_view_PayrollDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_grid->PayrollDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_grid->PayrollDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_grid->PayrollDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_grid->ObligationAmount->Visible) { // ObligationAmount ?>
	<?php if ($obligation_schedule_view_grid->SortUrl($obligation_schedule_view_grid->ObligationAmount) == "") { ?>
		<th data-name="ObligationAmount" class="<?php echo $obligation_schedule_view_grid->ObligationAmount->headerCellClass() ?>"><div id="elh_obligation_schedule_view_ObligationAmount" class="obligation_schedule_view_ObligationAmount"><div class="ew-table-header-caption"><?php echo $obligation_schedule_view_grid->ObligationAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ObligationAmount" class="<?php echo $obligation_schedule_view_grid->ObligationAmount->headerCellClass() ?>"><div><div id="elh_obligation_schedule_view_ObligationAmount" class="obligation_schedule_view_ObligationAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_grid->ObligationAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_grid->ObligationAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_grid->ObligationAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_grid->DeductionName->Visible) { // DeductionName ?>
	<?php if ($obligation_schedule_view_grid->SortUrl($obligation_schedule_view_grid->DeductionName) == "") { ?>
		<th data-name="DeductionName" class="<?php echo $obligation_schedule_view_grid->DeductionName->headerCellClass() ?>"><div id="elh_obligation_schedule_view_DeductionName" class="obligation_schedule_view_DeductionName"><div class="ew-table-header-caption"><?php echo $obligation_schedule_view_grid->DeductionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionName" class="<?php echo $obligation_schedule_view_grid->DeductionName->headerCellClass() ?>"><div><div id="elh_obligation_schedule_view_DeductionName" class="obligation_schedule_view_DeductionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_grid->DeductionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_grid->DeductionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_grid->DeductionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_grid->PeriodCode->Visible) { // PeriodCode ?>
	<?php if ($obligation_schedule_view_grid->SortUrl($obligation_schedule_view_grid->PeriodCode) == "") { ?>
		<th data-name="PeriodCode" class="<?php echo $obligation_schedule_view_grid->PeriodCode->headerCellClass() ?>"><div id="elh_obligation_schedule_view_PeriodCode" class="obligation_schedule_view_PeriodCode"><div class="ew-table-header-caption"><?php echo $obligation_schedule_view_grid->PeriodCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodCode" class="<?php echo $obligation_schedule_view_grid->PeriodCode->headerCellClass() ?>"><div><div id="elh_obligation_schedule_view_PeriodCode" class="obligation_schedule_view_PeriodCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_grid->PeriodCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_grid->PeriodCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_grid->PeriodCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$obligation_schedule_view_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$obligation_schedule_view_grid->StartRecord = 1;
$obligation_schedule_view_grid->StopRecord = $obligation_schedule_view_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($obligation_schedule_view->isConfirm() || $obligation_schedule_view_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($obligation_schedule_view_grid->FormKeyCountName) && ($obligation_schedule_view_grid->isGridAdd() || $obligation_schedule_view_grid->isGridEdit() || $obligation_schedule_view->isConfirm())) {
		$obligation_schedule_view_grid->KeyCount = $CurrentForm->getValue($obligation_schedule_view_grid->FormKeyCountName);
		$obligation_schedule_view_grid->StopRecord = $obligation_schedule_view_grid->StartRecord + $obligation_schedule_view_grid->KeyCount - 1;
	}
}
$obligation_schedule_view_grid->RecordCount = $obligation_schedule_view_grid->StartRecord - 1;
if ($obligation_schedule_view_grid->Recordset && !$obligation_schedule_view_grid->Recordset->EOF) {
	$obligation_schedule_view_grid->Recordset->moveFirst();
	$selectLimit = $obligation_schedule_view_grid->UseSelectLimit;
	if (!$selectLimit && $obligation_schedule_view_grid->StartRecord > 1)
		$obligation_schedule_view_grid->Recordset->move($obligation_schedule_view_grid->StartRecord - 1);
} elseif (!$obligation_schedule_view->AllowAddDeleteRow && $obligation_schedule_view_grid->StopRecord == 0) {
	$obligation_schedule_view_grid->StopRecord = $obligation_schedule_view->GridAddRowCount;
}

// Initialize aggregate
$obligation_schedule_view->RowType = ROWTYPE_AGGREGATEINIT;
$obligation_schedule_view->resetAttributes();
$obligation_schedule_view_grid->renderRow();
if ($obligation_schedule_view_grid->isGridAdd())
	$obligation_schedule_view_grid->RowIndex = 0;
if ($obligation_schedule_view_grid->isGridEdit())
	$obligation_schedule_view_grid->RowIndex = 0;
while ($obligation_schedule_view_grid->RecordCount < $obligation_schedule_view_grid->StopRecord) {
	$obligation_schedule_view_grid->RecordCount++;
	if ($obligation_schedule_view_grid->RecordCount >= $obligation_schedule_view_grid->StartRecord) {
		$obligation_schedule_view_grid->RowCount++;
		if ($obligation_schedule_view_grid->isGridAdd() || $obligation_schedule_view_grid->isGridEdit() || $obligation_schedule_view->isConfirm()) {
			$obligation_schedule_view_grid->RowIndex++;
			$CurrentForm->Index = $obligation_schedule_view_grid->RowIndex;
			if ($CurrentForm->hasValue($obligation_schedule_view_grid->FormActionName) && ($obligation_schedule_view->isConfirm() || $obligation_schedule_view_grid->EventCancelled))
				$obligation_schedule_view_grid->RowAction = strval($CurrentForm->getValue($obligation_schedule_view_grid->FormActionName));
			elseif ($obligation_schedule_view_grid->isGridAdd())
				$obligation_schedule_view_grid->RowAction = "insert";
			else
				$obligation_schedule_view_grid->RowAction = "";
		}

		// Set up key count
		$obligation_schedule_view_grid->KeyCount = $obligation_schedule_view_grid->RowIndex;

		// Init row class and style
		$obligation_schedule_view->resetAttributes();
		$obligation_schedule_view->CssClass = "";
		if ($obligation_schedule_view_grid->isGridAdd()) {
			if ($obligation_schedule_view->CurrentMode == "copy") {
				$obligation_schedule_view_grid->loadRowValues($obligation_schedule_view_grid->Recordset); // Load row values
				$obligation_schedule_view_grid->setRecordKey($obligation_schedule_view_grid->RowOldKey, $obligation_schedule_view_grid->Recordset); // Set old record key
			} else {
				$obligation_schedule_view_grid->loadRowValues(); // Load default values
				$obligation_schedule_view_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$obligation_schedule_view_grid->loadRowValues($obligation_schedule_view_grid->Recordset); // Load row values
		}
		$obligation_schedule_view->RowType = ROWTYPE_VIEW; // Render view
		if ($obligation_schedule_view_grid->isGridAdd()) // Grid add
			$obligation_schedule_view->RowType = ROWTYPE_ADD; // Render add
		if ($obligation_schedule_view_grid->isGridAdd() && $obligation_schedule_view->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$obligation_schedule_view_grid->restoreCurrentRowFormValues($obligation_schedule_view_grid->RowIndex); // Restore form values
		if ($obligation_schedule_view_grid->isGridEdit()) { // Grid edit
			if ($obligation_schedule_view->EventCancelled)
				$obligation_schedule_view_grid->restoreCurrentRowFormValues($obligation_schedule_view_grid->RowIndex); // Restore form values
			if ($obligation_schedule_view_grid->RowAction == "insert")
				$obligation_schedule_view->RowType = ROWTYPE_ADD; // Render add
			else
				$obligation_schedule_view->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($obligation_schedule_view_grid->isGridEdit() && ($obligation_schedule_view->RowType == ROWTYPE_EDIT || $obligation_schedule_view->RowType == ROWTYPE_ADD) && $obligation_schedule_view->EventCancelled) // Update failed
			$obligation_schedule_view_grid->restoreCurrentRowFormValues($obligation_schedule_view_grid->RowIndex); // Restore form values
		if ($obligation_schedule_view->RowType == ROWTYPE_EDIT) // Edit row
			$obligation_schedule_view_grid->EditRowCount++;
		if ($obligation_schedule_view->isConfirm()) // Confirm row
			$obligation_schedule_view_grid->restoreCurrentRowFormValues($obligation_schedule_view_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$obligation_schedule_view->RowAttrs->merge(["data-rowindex" => $obligation_schedule_view_grid->RowCount, "id" => "r" . $obligation_schedule_view_grid->RowCount . "_obligation_schedule_view", "data-rowtype" => $obligation_schedule_view->RowType]);

		// Render row
		$obligation_schedule_view_grid->renderRow();

		// Render list options
		$obligation_schedule_view_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($obligation_schedule_view_grid->RowAction != "delete" && $obligation_schedule_view_grid->RowAction != "insertdelete" && !($obligation_schedule_view_grid->RowAction == "insert" && $obligation_schedule_view->isConfirm() && $obligation_schedule_view_grid->emptyRow())) {
?>
	<tr <?php echo $obligation_schedule_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$obligation_schedule_view_grid->ListOptions->render("body", "left", $obligation_schedule_view_grid->RowCount);
?>
	<?php if ($obligation_schedule_view_grid->LAName->Visible) { // LAName ?>
		<td data-name="LAName" <?php echo $obligation_schedule_view_grid->LAName->cellAttributes() ?>>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_LAName" class="form-group">
<input type="text" data-table="obligation_schedule_view" data-field="x_LAName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_LAName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_LAName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->LAName->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->LAName->EditValue ?>"<?php echo $obligation_schedule_view_grid->LAName->editAttributes() ?>>
</span>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_LAName" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_LAName" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->LAName->OldValue) ?>">
<?php } ?>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_LAName" class="form-group">
<input type="text" data-table="obligation_schedule_view" data-field="x_LAName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_LAName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_LAName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->LAName->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->LAName->EditValue ?>"<?php echo $obligation_schedule_view_grid->LAName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_LAName">
<span<?php echo $obligation_schedule_view_grid->LAName->viewAttributes() ?>><?php echo $obligation_schedule_view_grid->LAName->getViewValue() ?></span>
</span>
<?php if (!$obligation_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_LAName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_LAName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->LAName->FormValue) ?>">
<input type="hidden" data-table="obligation_schedule_view" data-field="x_LAName" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_LAName" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->LAName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_LAName" name="fobligation_schedule_viewgrid$x<?php echo $obligation_schedule_view_grid->RowIndex ?>_LAName" id="fobligation_schedule_viewgrid$x<?php echo $obligation_schedule_view_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->LAName->FormValue) ?>">
<input type="hidden" data-table="obligation_schedule_view" data-field="x_LAName" name="fobligation_schedule_viewgrid$o<?php echo $obligation_schedule_view_grid->RowIndex ?>_LAName" id="fobligation_schedule_viewgrid$o<?php echo $obligation_schedule_view_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->LAName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_grid->NRC->Visible) { // NRC ?>
		<td data-name="NRC" <?php echo $obligation_schedule_view_grid->NRC->cellAttributes() ?>>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_NRC" class="form-group">
<input type="text" data-table="obligation_schedule_view" data-field="x_NRC" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_NRC" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->NRC->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->NRC->EditValue ?>"<?php echo $obligation_schedule_view_grid->NRC->editAttributes() ?>>
</span>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_NRC" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_NRC" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($obligation_schedule_view_grid->NRC->OldValue) ?>">
<?php } ?>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_NRC" class="form-group">
<input type="text" data-table="obligation_schedule_view" data-field="x_NRC" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_NRC" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->NRC->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->NRC->EditValue ?>"<?php echo $obligation_schedule_view_grid->NRC->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_NRC">
<span<?php echo $obligation_schedule_view_grid->NRC->viewAttributes() ?>><?php echo $obligation_schedule_view_grid->NRC->getViewValue() ?></span>
</span>
<?php if (!$obligation_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_NRC" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_NRC" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($obligation_schedule_view_grid->NRC->FormValue) ?>">
<input type="hidden" data-table="obligation_schedule_view" data-field="x_NRC" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_NRC" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($obligation_schedule_view_grid->NRC->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_NRC" name="fobligation_schedule_viewgrid$x<?php echo $obligation_schedule_view_grid->RowIndex ?>_NRC" id="fobligation_schedule_viewgrid$x<?php echo $obligation_schedule_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($obligation_schedule_view_grid->NRC->FormValue) ?>">
<input type="hidden" data-table="obligation_schedule_view" data-field="x_NRC" name="fobligation_schedule_viewgrid$o<?php echo $obligation_schedule_view_grid->RowIndex ?>_NRC" id="fobligation_schedule_viewgrid$o<?php echo $obligation_schedule_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($obligation_schedule_view_grid->NRC->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_grid->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $obligation_schedule_view_grid->Surname->cellAttributes() ?>>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_Surname" class="form-group">
<input type="text" data-table="obligation_schedule_view" data-field="x_Surname" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_Surname" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->Surname->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->Surname->EditValue ?>"<?php echo $obligation_schedule_view_grid->Surname->editAttributes() ?>>
</span>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_Surname" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_Surname" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($obligation_schedule_view_grid->Surname->OldValue) ?>">
<?php } ?>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_Surname" class="form-group">
<input type="text" data-table="obligation_schedule_view" data-field="x_Surname" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_Surname" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->Surname->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->Surname->EditValue ?>"<?php echo $obligation_schedule_view_grid->Surname->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_Surname">
<span<?php echo $obligation_schedule_view_grid->Surname->viewAttributes() ?>><?php echo $obligation_schedule_view_grid->Surname->getViewValue() ?></span>
</span>
<?php if (!$obligation_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_Surname" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_Surname" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($obligation_schedule_view_grid->Surname->FormValue) ?>">
<input type="hidden" data-table="obligation_schedule_view" data-field="x_Surname" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_Surname" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($obligation_schedule_view_grid->Surname->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_Surname" name="fobligation_schedule_viewgrid$x<?php echo $obligation_schedule_view_grid->RowIndex ?>_Surname" id="fobligation_schedule_viewgrid$x<?php echo $obligation_schedule_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($obligation_schedule_view_grid->Surname->FormValue) ?>">
<input type="hidden" data-table="obligation_schedule_view" data-field="x_Surname" name="fobligation_schedule_viewgrid$o<?php echo $obligation_schedule_view_grid->RowIndex ?>_Surname" id="fobligation_schedule_viewgrid$o<?php echo $obligation_schedule_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($obligation_schedule_view_grid->Surname->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_grid->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $obligation_schedule_view_grid->MiddleName->cellAttributes() ?>>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_MiddleName" class="form-group">
<input type="text" data-table="obligation_schedule_view" data-field="x_MiddleName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_MiddleName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->MiddleName->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->MiddleName->EditValue ?>"<?php echo $obligation_schedule_view_grid->MiddleName->editAttributes() ?>>
</span>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_MiddleName" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_MiddleName" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->MiddleName->OldValue) ?>">
<?php } ?>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_MiddleName" class="form-group">
<input type="text" data-table="obligation_schedule_view" data-field="x_MiddleName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_MiddleName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->MiddleName->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->MiddleName->EditValue ?>"<?php echo $obligation_schedule_view_grid->MiddleName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_MiddleName">
<span<?php echo $obligation_schedule_view_grid->MiddleName->viewAttributes() ?>><?php echo $obligation_schedule_view_grid->MiddleName->getViewValue() ?></span>
</span>
<?php if (!$obligation_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_MiddleName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_MiddleName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->MiddleName->FormValue) ?>">
<input type="hidden" data-table="obligation_schedule_view" data-field="x_MiddleName" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_MiddleName" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->MiddleName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_MiddleName" name="fobligation_schedule_viewgrid$x<?php echo $obligation_schedule_view_grid->RowIndex ?>_MiddleName" id="fobligation_schedule_viewgrid$x<?php echo $obligation_schedule_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->MiddleName->FormValue) ?>">
<input type="hidden" data-table="obligation_schedule_view" data-field="x_MiddleName" name="fobligation_schedule_viewgrid$o<?php echo $obligation_schedule_view_grid->RowIndex ?>_MiddleName" id="fobligation_schedule_viewgrid$o<?php echo $obligation_schedule_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->MiddleName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_grid->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $obligation_schedule_view_grid->FirstName->cellAttributes() ?>>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_FirstName" class="form-group">
<input type="text" data-table="obligation_schedule_view" data-field="x_FirstName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_FirstName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->FirstName->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->FirstName->EditValue ?>"<?php echo $obligation_schedule_view_grid->FirstName->editAttributes() ?>>
</span>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_FirstName" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_FirstName" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->FirstName->OldValue) ?>">
<?php } ?>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_FirstName" class="form-group">
<input type="text" data-table="obligation_schedule_view" data-field="x_FirstName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_FirstName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->FirstName->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->FirstName->EditValue ?>"<?php echo $obligation_schedule_view_grid->FirstName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_FirstName">
<span<?php echo $obligation_schedule_view_grid->FirstName->viewAttributes() ?>><?php echo $obligation_schedule_view_grid->FirstName->getViewValue() ?></span>
</span>
<?php if (!$obligation_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_FirstName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_FirstName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->FirstName->FormValue) ?>">
<input type="hidden" data-table="obligation_schedule_view" data-field="x_FirstName" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_FirstName" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->FirstName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_FirstName" name="fobligation_schedule_viewgrid$x<?php echo $obligation_schedule_view_grid->RowIndex ?>_FirstName" id="fobligation_schedule_viewgrid$x<?php echo $obligation_schedule_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->FirstName->FormValue) ?>">
<input type="hidden" data-table="obligation_schedule_view" data-field="x_FirstName" name="fobligation_schedule_viewgrid$o<?php echo $obligation_schedule_view_grid->RowIndex ?>_FirstName" id="fobligation_schedule_viewgrid$o<?php echo $obligation_schedule_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->FirstName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_grid->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName" <?php echo $obligation_schedule_view_grid->PositionName->cellAttributes() ?>>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_PositionName" class="form-group">
<input type="text" data-table="obligation_schedule_view" data-field="x_PositionName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PositionName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->PositionName->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->PositionName->EditValue ?>"<?php echo $obligation_schedule_view_grid->PositionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_PositionName" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_PositionName" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->PositionName->OldValue) ?>">
<?php } ?>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_PositionName" class="form-group">
<input type="text" data-table="obligation_schedule_view" data-field="x_PositionName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PositionName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->PositionName->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->PositionName->EditValue ?>"<?php echo $obligation_schedule_view_grid->PositionName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_PositionName">
<span<?php echo $obligation_schedule_view_grid->PositionName->viewAttributes() ?>><?php echo $obligation_schedule_view_grid->PositionName->getViewValue() ?></span>
</span>
<?php if (!$obligation_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_PositionName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PositionName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->PositionName->FormValue) ?>">
<input type="hidden" data-table="obligation_schedule_view" data-field="x_PositionName" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_PositionName" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->PositionName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_PositionName" name="fobligation_schedule_viewgrid$x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PositionName" id="fobligation_schedule_viewgrid$x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->PositionName->FormValue) ?>">
<input type="hidden" data-table="obligation_schedule_view" data-field="x_PositionName" name="fobligation_schedule_viewgrid$o<?php echo $obligation_schedule_view_grid->RowIndex ?>_PositionName" id="fobligation_schedule_viewgrid$o<?php echo $obligation_schedule_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->PositionName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_grid->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $obligation_schedule_view_grid->EmployeeID->cellAttributes() ?>>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_EmployeeID" class="form-group">
<input type="text" data-table="obligation_schedule_view" data-field="x_EmployeeID" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_EmployeeID" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->EmployeeID->EditValue ?>"<?php echo $obligation_schedule_view_grid->EmployeeID->editAttributes() ?>>
</span>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_EmployeeID" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_EmployeeID" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($obligation_schedule_view_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="obligation_schedule_view" data-field="x_EmployeeID" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_EmployeeID" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->EmployeeID->EditValue ?>"<?php echo $obligation_schedule_view_grid->EmployeeID->editAttributes() ?>>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_EmployeeID" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_EmployeeID" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($obligation_schedule_view_grid->EmployeeID->OldValue != null ? $obligation_schedule_view_grid->EmployeeID->OldValue : $obligation_schedule_view_grid->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_EmployeeID">
<span<?php echo $obligation_schedule_view_grid->EmployeeID->viewAttributes() ?>><?php echo $obligation_schedule_view_grid->EmployeeID->getViewValue() ?></span>
</span>
<?php if (!$obligation_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_EmployeeID" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_EmployeeID" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($obligation_schedule_view_grid->EmployeeID->FormValue) ?>">
<input type="hidden" data-table="obligation_schedule_view" data-field="x_EmployeeID" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_EmployeeID" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($obligation_schedule_view_grid->EmployeeID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_EmployeeID" name="fobligation_schedule_viewgrid$x<?php echo $obligation_schedule_view_grid->RowIndex ?>_EmployeeID" id="fobligation_schedule_viewgrid$x<?php echo $obligation_schedule_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($obligation_schedule_view_grid->EmployeeID->FormValue) ?>">
<input type="hidden" data-table="obligation_schedule_view" data-field="x_EmployeeID" name="fobligation_schedule_viewgrid$o<?php echo $obligation_schedule_view_grid->RowIndex ?>_EmployeeID" id="fobligation_schedule_viewgrid$o<?php echo $obligation_schedule_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($obligation_schedule_view_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_grid->PayrollDate->Visible) { // PayrollDate ?>
		<td data-name="PayrollDate" <?php echo $obligation_schedule_view_grid->PayrollDate->cellAttributes() ?>>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_PayrollDate" class="form-group">
<input type="text" data-table="obligation_schedule_view" data-field="x_PayrollDate" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PayrollDate" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PayrollDate" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->PayrollDate->EditValue ?>"<?php echo $obligation_schedule_view_grid->PayrollDate->editAttributes() ?>>
<?php if (!$obligation_schedule_view_grid->PayrollDate->ReadOnly && !$obligation_schedule_view_grid->PayrollDate->Disabled && !isset($obligation_schedule_view_grid->PayrollDate->EditAttrs["readonly"]) && !isset($obligation_schedule_view_grid->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fobligation_schedule_viewgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fobligation_schedule_viewgrid", "x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_PayrollDate" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_PayrollDate" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($obligation_schedule_view_grid->PayrollDate->OldValue) ?>">
<?php } ?>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_PayrollDate" class="form-group">
<input type="text" data-table="obligation_schedule_view" data-field="x_PayrollDate" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PayrollDate" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PayrollDate" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->PayrollDate->EditValue ?>"<?php echo $obligation_schedule_view_grid->PayrollDate->editAttributes() ?>>
<?php if (!$obligation_schedule_view_grid->PayrollDate->ReadOnly && !$obligation_schedule_view_grid->PayrollDate->Disabled && !isset($obligation_schedule_view_grid->PayrollDate->EditAttrs["readonly"]) && !isset($obligation_schedule_view_grid->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fobligation_schedule_viewgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fobligation_schedule_viewgrid", "x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_PayrollDate">
<span<?php echo $obligation_schedule_view_grid->PayrollDate->viewAttributes() ?>><?php echo $obligation_schedule_view_grid->PayrollDate->getViewValue() ?></span>
</span>
<?php if (!$obligation_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_PayrollDate" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PayrollDate" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($obligation_schedule_view_grid->PayrollDate->FormValue) ?>">
<input type="hidden" data-table="obligation_schedule_view" data-field="x_PayrollDate" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_PayrollDate" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($obligation_schedule_view_grid->PayrollDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_PayrollDate" name="fobligation_schedule_viewgrid$x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PayrollDate" id="fobligation_schedule_viewgrid$x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($obligation_schedule_view_grid->PayrollDate->FormValue) ?>">
<input type="hidden" data-table="obligation_schedule_view" data-field="x_PayrollDate" name="fobligation_schedule_viewgrid$o<?php echo $obligation_schedule_view_grid->RowIndex ?>_PayrollDate" id="fobligation_schedule_viewgrid$o<?php echo $obligation_schedule_view_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($obligation_schedule_view_grid->PayrollDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_grid->ObligationAmount->Visible) { // ObligationAmount ?>
		<td data-name="ObligationAmount" <?php echo $obligation_schedule_view_grid->ObligationAmount->cellAttributes() ?>>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_ObligationAmount" class="form-group">
<input type="text" data-table="obligation_schedule_view" data-field="x_ObligationAmount" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_ObligationAmount" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_ObligationAmount" size="30" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->ObligationAmount->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->ObligationAmount->EditValue ?>"<?php echo $obligation_schedule_view_grid->ObligationAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_ObligationAmount" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_ObligationAmount" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_ObligationAmount" value="<?php echo HtmlEncode($obligation_schedule_view_grid->ObligationAmount->OldValue) ?>">
<?php } ?>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_ObligationAmount" class="form-group">
<input type="text" data-table="obligation_schedule_view" data-field="x_ObligationAmount" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_ObligationAmount" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_ObligationAmount" size="30" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->ObligationAmount->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->ObligationAmount->EditValue ?>"<?php echo $obligation_schedule_view_grid->ObligationAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_ObligationAmount">
<span<?php echo $obligation_schedule_view_grid->ObligationAmount->viewAttributes() ?>><?php echo $obligation_schedule_view_grid->ObligationAmount->getViewValue() ?></span>
</span>
<?php if (!$obligation_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_ObligationAmount" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_ObligationAmount" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_ObligationAmount" value="<?php echo HtmlEncode($obligation_schedule_view_grid->ObligationAmount->FormValue) ?>">
<input type="hidden" data-table="obligation_schedule_view" data-field="x_ObligationAmount" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_ObligationAmount" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_ObligationAmount" value="<?php echo HtmlEncode($obligation_schedule_view_grid->ObligationAmount->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_ObligationAmount" name="fobligation_schedule_viewgrid$x<?php echo $obligation_schedule_view_grid->RowIndex ?>_ObligationAmount" id="fobligation_schedule_viewgrid$x<?php echo $obligation_schedule_view_grid->RowIndex ?>_ObligationAmount" value="<?php echo HtmlEncode($obligation_schedule_view_grid->ObligationAmount->FormValue) ?>">
<input type="hidden" data-table="obligation_schedule_view" data-field="x_ObligationAmount" name="fobligation_schedule_viewgrid$o<?php echo $obligation_schedule_view_grid->RowIndex ?>_ObligationAmount" id="fobligation_schedule_viewgrid$o<?php echo $obligation_schedule_view_grid->RowIndex ?>_ObligationAmount" value="<?php echo HtmlEncode($obligation_schedule_view_grid->ObligationAmount->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_grid->DeductionName->Visible) { // DeductionName ?>
		<td data-name="DeductionName" <?php echo $obligation_schedule_view_grid->DeductionName->cellAttributes() ?>>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_DeductionName" class="form-group">
<input type="text" data-table="obligation_schedule_view" data-field="x_DeductionName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_DeductionName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_DeductionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->DeductionName->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->DeductionName->EditValue ?>"<?php echo $obligation_schedule_view_grid->DeductionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_DeductionName" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_DeductionName" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_DeductionName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->DeductionName->OldValue) ?>">
<?php } ?>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_DeductionName" class="form-group">
<input type="text" data-table="obligation_schedule_view" data-field="x_DeductionName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_DeductionName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_DeductionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->DeductionName->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->DeductionName->EditValue ?>"<?php echo $obligation_schedule_view_grid->DeductionName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_DeductionName">
<span<?php echo $obligation_schedule_view_grid->DeductionName->viewAttributes() ?>><?php echo $obligation_schedule_view_grid->DeductionName->getViewValue() ?></span>
</span>
<?php if (!$obligation_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_DeductionName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_DeductionName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_DeductionName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->DeductionName->FormValue) ?>">
<input type="hidden" data-table="obligation_schedule_view" data-field="x_DeductionName" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_DeductionName" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_DeductionName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->DeductionName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_DeductionName" name="fobligation_schedule_viewgrid$x<?php echo $obligation_schedule_view_grid->RowIndex ?>_DeductionName" id="fobligation_schedule_viewgrid$x<?php echo $obligation_schedule_view_grid->RowIndex ?>_DeductionName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->DeductionName->FormValue) ?>">
<input type="hidden" data-table="obligation_schedule_view" data-field="x_DeductionName" name="fobligation_schedule_viewgrid$o<?php echo $obligation_schedule_view_grid->RowIndex ?>_DeductionName" id="fobligation_schedule_viewgrid$o<?php echo $obligation_schedule_view_grid->RowIndex ?>_DeductionName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->DeductionName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_grid->PeriodCode->Visible) { // PeriodCode ?>
		<td data-name="PeriodCode" <?php echo $obligation_schedule_view_grid->PeriodCode->cellAttributes() ?>>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_PeriodCode" class="form-group"></span>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_PeriodCode" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_PeriodCode" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($obligation_schedule_view_grid->PeriodCode->OldValue) ?>">
<?php } ?>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($obligation_schedule_view_grid->PeriodCode->getSessionValue() != "") { ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_PeriodCode" class="form-group">
<span<?php echo $obligation_schedule_view_grid->PeriodCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($obligation_schedule_view_grid->PeriodCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PeriodCode" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($obligation_schedule_view_grid->PeriodCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_PeriodCode" class="form-group">
<input type="text" data-table="obligation_schedule_view" data-field="x_PeriodCode" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PeriodCode" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PeriodCode" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->PeriodCode->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->PeriodCode->EditValue ?>"<?php echo $obligation_schedule_view_grid->PeriodCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $obligation_schedule_view_grid->RowCount ?>_obligation_schedule_view_PeriodCode">
<span<?php echo $obligation_schedule_view_grid->PeriodCode->viewAttributes() ?>><?php echo $obligation_schedule_view_grid->PeriodCode->getViewValue() ?></span>
</span>
<?php if (!$obligation_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_PeriodCode" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PeriodCode" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($obligation_schedule_view_grid->PeriodCode->FormValue) ?>">
<input type="hidden" data-table="obligation_schedule_view" data-field="x_PeriodCode" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_PeriodCode" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($obligation_schedule_view_grid->PeriodCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_PeriodCode" name="fobligation_schedule_viewgrid$x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PeriodCode" id="fobligation_schedule_viewgrid$x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($obligation_schedule_view_grid->PeriodCode->FormValue) ?>">
<input type="hidden" data-table="obligation_schedule_view" data-field="x_PeriodCode" name="fobligation_schedule_viewgrid$o<?php echo $obligation_schedule_view_grid->RowIndex ?>_PeriodCode" id="fobligation_schedule_viewgrid$o<?php echo $obligation_schedule_view_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($obligation_schedule_view_grid->PeriodCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$obligation_schedule_view_grid->ListOptions->render("body", "right", $obligation_schedule_view_grid->RowCount);
?>
	</tr>
<?php if ($obligation_schedule_view->RowType == ROWTYPE_ADD || $obligation_schedule_view->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fobligation_schedule_viewgrid", "load"], function() {
	fobligation_schedule_viewgrid.updateLists(<?php echo $obligation_schedule_view_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$obligation_schedule_view_grid->isGridAdd() || $obligation_schedule_view->CurrentMode == "copy")
		if (!$obligation_schedule_view_grid->Recordset->EOF)
			$obligation_schedule_view_grid->Recordset->moveNext();
}
?>
<?php
	if ($obligation_schedule_view->CurrentMode == "add" || $obligation_schedule_view->CurrentMode == "copy" || $obligation_schedule_view->CurrentMode == "edit") {
		$obligation_schedule_view_grid->RowIndex = '$rowindex$';
		$obligation_schedule_view_grid->loadRowValues();

		// Set row properties
		$obligation_schedule_view->resetAttributes();
		$obligation_schedule_view->RowAttrs->merge(["data-rowindex" => $obligation_schedule_view_grid->RowIndex, "id" => "r0_obligation_schedule_view", "data-rowtype" => ROWTYPE_ADD]);
		$obligation_schedule_view->RowAttrs->appendClass("ew-template");
		$obligation_schedule_view->RowType = ROWTYPE_ADD;

		// Render row
		$obligation_schedule_view_grid->renderRow();

		// Render list options
		$obligation_schedule_view_grid->renderListOptions();
		$obligation_schedule_view_grid->StartRowCount = 0;
?>
	<tr <?php echo $obligation_schedule_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$obligation_schedule_view_grid->ListOptions->render("body", "left", $obligation_schedule_view_grid->RowIndex);
?>
	<?php if ($obligation_schedule_view_grid->LAName->Visible) { // LAName ?>
		<td data-name="LAName">
<?php if (!$obligation_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_obligation_schedule_view_LAName" class="form-group obligation_schedule_view_LAName">
<input type="text" data-table="obligation_schedule_view" data-field="x_LAName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_LAName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_LAName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->LAName->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->LAName->EditValue ?>"<?php echo $obligation_schedule_view_grid->LAName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_obligation_schedule_view_LAName" class="form-group obligation_schedule_view_LAName">
<span<?php echo $obligation_schedule_view_grid->LAName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($obligation_schedule_view_grid->LAName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_LAName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_LAName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->LAName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_LAName" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_LAName" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->LAName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_grid->NRC->Visible) { // NRC ?>
		<td data-name="NRC">
<?php if (!$obligation_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_obligation_schedule_view_NRC" class="form-group obligation_schedule_view_NRC">
<input type="text" data-table="obligation_schedule_view" data-field="x_NRC" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_NRC" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->NRC->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->NRC->EditValue ?>"<?php echo $obligation_schedule_view_grid->NRC->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_obligation_schedule_view_NRC" class="form-group obligation_schedule_view_NRC">
<span<?php echo $obligation_schedule_view_grid->NRC->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($obligation_schedule_view_grid->NRC->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_NRC" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_NRC" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($obligation_schedule_view_grid->NRC->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_NRC" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_NRC" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($obligation_schedule_view_grid->NRC->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_grid->Surname->Visible) { // Surname ?>
		<td data-name="Surname">
<?php if (!$obligation_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_obligation_schedule_view_Surname" class="form-group obligation_schedule_view_Surname">
<input type="text" data-table="obligation_schedule_view" data-field="x_Surname" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_Surname" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->Surname->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->Surname->EditValue ?>"<?php echo $obligation_schedule_view_grid->Surname->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_obligation_schedule_view_Surname" class="form-group obligation_schedule_view_Surname">
<span<?php echo $obligation_schedule_view_grid->Surname->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($obligation_schedule_view_grid->Surname->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_Surname" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_Surname" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($obligation_schedule_view_grid->Surname->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_Surname" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_Surname" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($obligation_schedule_view_grid->Surname->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_grid->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName">
<?php if (!$obligation_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_obligation_schedule_view_MiddleName" class="form-group obligation_schedule_view_MiddleName">
<input type="text" data-table="obligation_schedule_view" data-field="x_MiddleName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_MiddleName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->MiddleName->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->MiddleName->EditValue ?>"<?php echo $obligation_schedule_view_grid->MiddleName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_obligation_schedule_view_MiddleName" class="form-group obligation_schedule_view_MiddleName">
<span<?php echo $obligation_schedule_view_grid->MiddleName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($obligation_schedule_view_grid->MiddleName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_MiddleName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_MiddleName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->MiddleName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_MiddleName" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_MiddleName" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->MiddleName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_grid->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName">
<?php if (!$obligation_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_obligation_schedule_view_FirstName" class="form-group obligation_schedule_view_FirstName">
<input type="text" data-table="obligation_schedule_view" data-field="x_FirstName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_FirstName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->FirstName->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->FirstName->EditValue ?>"<?php echo $obligation_schedule_view_grid->FirstName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_obligation_schedule_view_FirstName" class="form-group obligation_schedule_view_FirstName">
<span<?php echo $obligation_schedule_view_grid->FirstName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($obligation_schedule_view_grid->FirstName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_FirstName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_FirstName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->FirstName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_FirstName" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_FirstName" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->FirstName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_grid->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName">
<?php if (!$obligation_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_obligation_schedule_view_PositionName" class="form-group obligation_schedule_view_PositionName">
<input type="text" data-table="obligation_schedule_view" data-field="x_PositionName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PositionName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->PositionName->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->PositionName->EditValue ?>"<?php echo $obligation_schedule_view_grid->PositionName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_obligation_schedule_view_PositionName" class="form-group obligation_schedule_view_PositionName">
<span<?php echo $obligation_schedule_view_grid->PositionName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($obligation_schedule_view_grid->PositionName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_PositionName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PositionName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->PositionName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_PositionName" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_PositionName" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->PositionName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_grid->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID">
<?php if (!$obligation_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_obligation_schedule_view_EmployeeID" class="form-group obligation_schedule_view_EmployeeID">
<input type="text" data-table="obligation_schedule_view" data-field="x_EmployeeID" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_EmployeeID" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->EmployeeID->EditValue ?>"<?php echo $obligation_schedule_view_grid->EmployeeID->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_obligation_schedule_view_EmployeeID" class="form-group obligation_schedule_view_EmployeeID">
<span<?php echo $obligation_schedule_view_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($obligation_schedule_view_grid->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_EmployeeID" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_EmployeeID" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($obligation_schedule_view_grid->EmployeeID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_EmployeeID" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_EmployeeID" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($obligation_schedule_view_grid->EmployeeID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_grid->PayrollDate->Visible) { // PayrollDate ?>
		<td data-name="PayrollDate">
<?php if (!$obligation_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_obligation_schedule_view_PayrollDate" class="form-group obligation_schedule_view_PayrollDate">
<input type="text" data-table="obligation_schedule_view" data-field="x_PayrollDate" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PayrollDate" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PayrollDate" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->PayrollDate->EditValue ?>"<?php echo $obligation_schedule_view_grid->PayrollDate->editAttributes() ?>>
<?php if (!$obligation_schedule_view_grid->PayrollDate->ReadOnly && !$obligation_schedule_view_grid->PayrollDate->Disabled && !isset($obligation_schedule_view_grid->PayrollDate->EditAttrs["readonly"]) && !isset($obligation_schedule_view_grid->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fobligation_schedule_viewgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fobligation_schedule_viewgrid", "x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_obligation_schedule_view_PayrollDate" class="form-group obligation_schedule_view_PayrollDate">
<span<?php echo $obligation_schedule_view_grid->PayrollDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($obligation_schedule_view_grid->PayrollDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_PayrollDate" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PayrollDate" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($obligation_schedule_view_grid->PayrollDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_PayrollDate" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_PayrollDate" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($obligation_schedule_view_grid->PayrollDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_grid->ObligationAmount->Visible) { // ObligationAmount ?>
		<td data-name="ObligationAmount">
<?php if (!$obligation_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_obligation_schedule_view_ObligationAmount" class="form-group obligation_schedule_view_ObligationAmount">
<input type="text" data-table="obligation_schedule_view" data-field="x_ObligationAmount" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_ObligationAmount" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_ObligationAmount" size="30" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->ObligationAmount->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->ObligationAmount->EditValue ?>"<?php echo $obligation_schedule_view_grid->ObligationAmount->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_obligation_schedule_view_ObligationAmount" class="form-group obligation_schedule_view_ObligationAmount">
<span<?php echo $obligation_schedule_view_grid->ObligationAmount->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($obligation_schedule_view_grid->ObligationAmount->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_ObligationAmount" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_ObligationAmount" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_ObligationAmount" value="<?php echo HtmlEncode($obligation_schedule_view_grid->ObligationAmount->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_ObligationAmount" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_ObligationAmount" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_ObligationAmount" value="<?php echo HtmlEncode($obligation_schedule_view_grid->ObligationAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_grid->DeductionName->Visible) { // DeductionName ?>
		<td data-name="DeductionName">
<?php if (!$obligation_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_obligation_schedule_view_DeductionName" class="form-group obligation_schedule_view_DeductionName">
<input type="text" data-table="obligation_schedule_view" data-field="x_DeductionName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_DeductionName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_DeductionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($obligation_schedule_view_grid->DeductionName->getPlaceHolder()) ?>" value="<?php echo $obligation_schedule_view_grid->DeductionName->EditValue ?>"<?php echo $obligation_schedule_view_grid->DeductionName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_obligation_schedule_view_DeductionName" class="form-group obligation_schedule_view_DeductionName">
<span<?php echo $obligation_schedule_view_grid->DeductionName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($obligation_schedule_view_grid->DeductionName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_DeductionName" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_DeductionName" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_DeductionName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->DeductionName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_DeductionName" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_DeductionName" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_DeductionName" value="<?php echo HtmlEncode($obligation_schedule_view_grid->DeductionName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($obligation_schedule_view_grid->PeriodCode->Visible) { // PeriodCode ?>
		<td data-name="PeriodCode">
<?php if (!$obligation_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_obligation_schedule_view_PeriodCode" class="form-group obligation_schedule_view_PeriodCode"></span>
<?php } else { ?>
<span id="el$rowindex$_obligation_schedule_view_PeriodCode" class="form-group obligation_schedule_view_PeriodCode">
<span<?php echo $obligation_schedule_view_grid->PeriodCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($obligation_schedule_view_grid->PeriodCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_PeriodCode" name="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PeriodCode" id="x<?php echo $obligation_schedule_view_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($obligation_schedule_view_grid->PeriodCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="obligation_schedule_view" data-field="x_PeriodCode" name="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_PeriodCode" id="o<?php echo $obligation_schedule_view_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($obligation_schedule_view_grid->PeriodCode->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$obligation_schedule_view_grid->ListOptions->render("body", "right", $obligation_schedule_view_grid->RowIndex);
?>
<script>
loadjs.ready(["fobligation_schedule_viewgrid", "load"], function() {
	fobligation_schedule_viewgrid.updateLists(<?php echo $obligation_schedule_view_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($obligation_schedule_view->CurrentMode == "add" || $obligation_schedule_view->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $obligation_schedule_view_grid->FormKeyCountName ?>" id="<?php echo $obligation_schedule_view_grid->FormKeyCountName ?>" value="<?php echo $obligation_schedule_view_grid->KeyCount ?>">
<?php echo $obligation_schedule_view_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($obligation_schedule_view->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $obligation_schedule_view_grid->FormKeyCountName ?>" id="<?php echo $obligation_schedule_view_grid->FormKeyCountName ?>" value="<?php echo $obligation_schedule_view_grid->KeyCount ?>">
<?php echo $obligation_schedule_view_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($obligation_schedule_view->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fobligation_schedule_viewgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($obligation_schedule_view_grid->Recordset)
	$obligation_schedule_view_grid->Recordset->Close();
?>
<?php if ($obligation_schedule_view_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $obligation_schedule_view_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($obligation_schedule_view_grid->TotalRecords == 0 && !$obligation_schedule_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $obligation_schedule_view_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$obligation_schedule_view_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$obligation_schedule_view_grid->terminate();
?>