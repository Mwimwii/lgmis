<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($deduction_schedule_view_grid))
	$deduction_schedule_view_grid = new deduction_schedule_view_grid();

// Run the page
$deduction_schedule_view_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$deduction_schedule_view_grid->Page_Render();
?>
<?php if (!$deduction_schedule_view_grid->isExport()) { ?>
<script>
var fdeduction_schedule_viewgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fdeduction_schedule_viewgrid = new ew.Form("fdeduction_schedule_viewgrid", "grid");
	fdeduction_schedule_viewgrid.formKeyCountName = '<?php echo $deduction_schedule_view_grid->FormKeyCountName ?>';

	// Validate form
	fdeduction_schedule_viewgrid.validate = function() {
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
			<?php if ($deduction_schedule_view_grid->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_schedule_view_grid->EmployeeID->caption(), $deduction_schedule_view_grid->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($deduction_schedule_view_grid->EmployeeID->errorMessage()) ?>");
			<?php if ($deduction_schedule_view_grid->PayrollDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_schedule_view_grid->PayrollDate->caption(), $deduction_schedule_view_grid->PayrollDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($deduction_schedule_view_grid->PayrollDate->errorMessage()) ?>");
			<?php if ($deduction_schedule_view_grid->LAName->Required) { ?>
				elm = this.getElements("x" + infix + "_LAName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_schedule_view_grid->LAName->caption(), $deduction_schedule_view_grid->LAName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_schedule_view_grid->DeductionName->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_schedule_view_grid->DeductionName->caption(), $deduction_schedule_view_grid->DeductionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_schedule_view_grid->DeductionAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_schedule_view_grid->DeductionAmount->caption(), $deduction_schedule_view_grid->DeductionAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DeductionAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($deduction_schedule_view_grid->DeductionAmount->errorMessage()) ?>");
			<?php if ($deduction_schedule_view_grid->NRC->Required) { ?>
				elm = this.getElements("x" + infix + "_NRC");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_schedule_view_grid->NRC->caption(), $deduction_schedule_view_grid->NRC->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_schedule_view_grid->Surname->Required) { ?>
				elm = this.getElements("x" + infix + "_Surname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_schedule_view_grid->Surname->caption(), $deduction_schedule_view_grid->Surname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_schedule_view_grid->MiddleName->Required) { ?>
				elm = this.getElements("x" + infix + "_MiddleName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_schedule_view_grid->MiddleName->caption(), $deduction_schedule_view_grid->MiddleName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_schedule_view_grid->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_schedule_view_grid->FirstName->caption(), $deduction_schedule_view_grid->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_schedule_view_grid->PositionName->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_schedule_view_grid->PositionName->caption(), $deduction_schedule_view_grid->PositionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_schedule_view_grid->PeriodCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_schedule_view_grid->PeriodCode->caption(), $deduction_schedule_view_grid->PeriodCode->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fdeduction_schedule_viewgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "EmployeeID", false)) return false;
		if (ew.valueChanged(fobj, infix, "PayrollDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "LAName", false)) return false;
		if (ew.valueChanged(fobj, infix, "DeductionName", false)) return false;
		if (ew.valueChanged(fobj, infix, "DeductionAmount", false)) return false;
		if (ew.valueChanged(fobj, infix, "NRC", false)) return false;
		if (ew.valueChanged(fobj, infix, "Surname", false)) return false;
		if (ew.valueChanged(fobj, infix, "MiddleName", false)) return false;
		if (ew.valueChanged(fobj, infix, "FirstName", false)) return false;
		if (ew.valueChanged(fobj, infix, "PositionName", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdeduction_schedule_viewgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdeduction_schedule_viewgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdeduction_schedule_viewgrid.lists["x_PeriodCode"] = <?php echo $deduction_schedule_view_grid->PeriodCode->Lookup->toClientList($deduction_schedule_view_grid) ?>;
	fdeduction_schedule_viewgrid.lists["x_PeriodCode"].options = <?php echo JsonEncode($deduction_schedule_view_grid->PeriodCode->lookupOptions()) ?>;
	loadjs.done("fdeduction_schedule_viewgrid");
});
</script>
<?php } ?>
<?php
$deduction_schedule_view_grid->renderOtherOptions();
?>
<?php if ($deduction_schedule_view_grid->TotalRecords > 0 || $deduction_schedule_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($deduction_schedule_view_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> deduction_schedule_view">
<?php if ($deduction_schedule_view_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $deduction_schedule_view_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdeduction_schedule_viewgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_deduction_schedule_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_deduction_schedule_viewgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$deduction_schedule_view->RowType = ROWTYPE_HEADER;

// Render list options
$deduction_schedule_view_grid->renderListOptions();

// Render list options (header, left)
$deduction_schedule_view_grid->ListOptions->render("header", "left");
?>
<?php if ($deduction_schedule_view_grid->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($deduction_schedule_view_grid->SortUrl($deduction_schedule_view_grid->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $deduction_schedule_view_grid->EmployeeID->headerCellClass() ?>"><div id="elh_deduction_schedule_view_EmployeeID" class="deduction_schedule_view_EmployeeID"><div class="ew-table-header-caption"><?php echo $deduction_schedule_view_grid->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $deduction_schedule_view_grid->EmployeeID->headerCellClass() ?>"><div><div id="elh_deduction_schedule_view_EmployeeID" class="deduction_schedule_view_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_schedule_view_grid->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_schedule_view_grid->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_schedule_view_grid->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_grid->PayrollDate->Visible) { // PayrollDate ?>
	<?php if ($deduction_schedule_view_grid->SortUrl($deduction_schedule_view_grid->PayrollDate) == "") { ?>
		<th data-name="PayrollDate" class="<?php echo $deduction_schedule_view_grid->PayrollDate->headerCellClass() ?>"><div id="elh_deduction_schedule_view_PayrollDate" class="deduction_schedule_view_PayrollDate"><div class="ew-table-header-caption"><?php echo $deduction_schedule_view_grid->PayrollDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollDate" class="<?php echo $deduction_schedule_view_grid->PayrollDate->headerCellClass() ?>"><div><div id="elh_deduction_schedule_view_PayrollDate" class="deduction_schedule_view_PayrollDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_schedule_view_grid->PayrollDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_schedule_view_grid->PayrollDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_schedule_view_grid->PayrollDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_grid->LAName->Visible) { // LAName ?>
	<?php if ($deduction_schedule_view_grid->SortUrl($deduction_schedule_view_grid->LAName) == "") { ?>
		<th data-name="LAName" class="<?php echo $deduction_schedule_view_grid->LAName->headerCellClass() ?>"><div id="elh_deduction_schedule_view_LAName" class="deduction_schedule_view_LAName"><div class="ew-table-header-caption"><?php echo $deduction_schedule_view_grid->LAName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LAName" class="<?php echo $deduction_schedule_view_grid->LAName->headerCellClass() ?>"><div><div id="elh_deduction_schedule_view_LAName" class="deduction_schedule_view_LAName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_schedule_view_grid->LAName->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_schedule_view_grid->LAName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_schedule_view_grid->LAName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_grid->DeductionName->Visible) { // DeductionName ?>
	<?php if ($deduction_schedule_view_grid->SortUrl($deduction_schedule_view_grid->DeductionName) == "") { ?>
		<th data-name="DeductionName" class="<?php echo $deduction_schedule_view_grid->DeductionName->headerCellClass() ?>"><div id="elh_deduction_schedule_view_DeductionName" class="deduction_schedule_view_DeductionName"><div class="ew-table-header-caption"><?php echo $deduction_schedule_view_grid->DeductionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionName" class="<?php echo $deduction_schedule_view_grid->DeductionName->headerCellClass() ?>"><div><div id="elh_deduction_schedule_view_DeductionName" class="deduction_schedule_view_DeductionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_schedule_view_grid->DeductionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_schedule_view_grid->DeductionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_schedule_view_grid->DeductionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_grid->DeductionAmount->Visible) { // DeductionAmount ?>
	<?php if ($deduction_schedule_view_grid->SortUrl($deduction_schedule_view_grid->DeductionAmount) == "") { ?>
		<th data-name="DeductionAmount" class="<?php echo $deduction_schedule_view_grid->DeductionAmount->headerCellClass() ?>"><div id="elh_deduction_schedule_view_DeductionAmount" class="deduction_schedule_view_DeductionAmount"><div class="ew-table-header-caption"><?php echo $deduction_schedule_view_grid->DeductionAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionAmount" class="<?php echo $deduction_schedule_view_grid->DeductionAmount->headerCellClass() ?>"><div><div id="elh_deduction_schedule_view_DeductionAmount" class="deduction_schedule_view_DeductionAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_schedule_view_grid->DeductionAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_schedule_view_grid->DeductionAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_schedule_view_grid->DeductionAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_grid->NRC->Visible) { // NRC ?>
	<?php if ($deduction_schedule_view_grid->SortUrl($deduction_schedule_view_grid->NRC) == "") { ?>
		<th data-name="NRC" class="<?php echo $deduction_schedule_view_grid->NRC->headerCellClass() ?>"><div id="elh_deduction_schedule_view_NRC" class="deduction_schedule_view_NRC"><div class="ew-table-header-caption"><?php echo $deduction_schedule_view_grid->NRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC" class="<?php echo $deduction_schedule_view_grid->NRC->headerCellClass() ?>"><div><div id="elh_deduction_schedule_view_NRC" class="deduction_schedule_view_NRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_schedule_view_grid->NRC->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_schedule_view_grid->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_schedule_view_grid->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_grid->Surname->Visible) { // Surname ?>
	<?php if ($deduction_schedule_view_grid->SortUrl($deduction_schedule_view_grid->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $deduction_schedule_view_grid->Surname->headerCellClass() ?>"><div id="elh_deduction_schedule_view_Surname" class="deduction_schedule_view_Surname"><div class="ew-table-header-caption"><?php echo $deduction_schedule_view_grid->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $deduction_schedule_view_grid->Surname->headerCellClass() ?>"><div><div id="elh_deduction_schedule_view_Surname" class="deduction_schedule_view_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_schedule_view_grid->Surname->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_schedule_view_grid->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_schedule_view_grid->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_grid->MiddleName->Visible) { // MiddleName ?>
	<?php if ($deduction_schedule_view_grid->SortUrl($deduction_schedule_view_grid->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $deduction_schedule_view_grid->MiddleName->headerCellClass() ?>"><div id="elh_deduction_schedule_view_MiddleName" class="deduction_schedule_view_MiddleName"><div class="ew-table-header-caption"><?php echo $deduction_schedule_view_grid->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $deduction_schedule_view_grid->MiddleName->headerCellClass() ?>"><div><div id="elh_deduction_schedule_view_MiddleName" class="deduction_schedule_view_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_schedule_view_grid->MiddleName->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_schedule_view_grid->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_schedule_view_grid->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_grid->FirstName->Visible) { // FirstName ?>
	<?php if ($deduction_schedule_view_grid->SortUrl($deduction_schedule_view_grid->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $deduction_schedule_view_grid->FirstName->headerCellClass() ?>"><div id="elh_deduction_schedule_view_FirstName" class="deduction_schedule_view_FirstName"><div class="ew-table-header-caption"><?php echo $deduction_schedule_view_grid->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $deduction_schedule_view_grid->FirstName->headerCellClass() ?>"><div><div id="elh_deduction_schedule_view_FirstName" class="deduction_schedule_view_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_schedule_view_grid->FirstName->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_schedule_view_grid->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_schedule_view_grid->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_grid->PositionName->Visible) { // PositionName ?>
	<?php if ($deduction_schedule_view_grid->SortUrl($deduction_schedule_view_grid->PositionName) == "") { ?>
		<th data-name="PositionName" class="<?php echo $deduction_schedule_view_grid->PositionName->headerCellClass() ?>"><div id="elh_deduction_schedule_view_PositionName" class="deduction_schedule_view_PositionName"><div class="ew-table-header-caption"><?php echo $deduction_schedule_view_grid->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionName" class="<?php echo $deduction_schedule_view_grid->PositionName->headerCellClass() ?>"><div><div id="elh_deduction_schedule_view_PositionName" class="deduction_schedule_view_PositionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_schedule_view_grid->PositionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_schedule_view_grid->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_schedule_view_grid->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_grid->PeriodCode->Visible) { // PeriodCode ?>
	<?php if ($deduction_schedule_view_grid->SortUrl($deduction_schedule_view_grid->PeriodCode) == "") { ?>
		<th data-name="PeriodCode" class="<?php echo $deduction_schedule_view_grid->PeriodCode->headerCellClass() ?>"><div id="elh_deduction_schedule_view_PeriodCode" class="deduction_schedule_view_PeriodCode"><div class="ew-table-header-caption"><?php echo $deduction_schedule_view_grid->PeriodCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodCode" class="<?php echo $deduction_schedule_view_grid->PeriodCode->headerCellClass() ?>"><div><div id="elh_deduction_schedule_view_PeriodCode" class="deduction_schedule_view_PeriodCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_schedule_view_grid->PeriodCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_schedule_view_grid->PeriodCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_schedule_view_grid->PeriodCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$deduction_schedule_view_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$deduction_schedule_view_grid->StartRecord = 1;
$deduction_schedule_view_grid->StopRecord = $deduction_schedule_view_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($deduction_schedule_view->isConfirm() || $deduction_schedule_view_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($deduction_schedule_view_grid->FormKeyCountName) && ($deduction_schedule_view_grid->isGridAdd() || $deduction_schedule_view_grid->isGridEdit() || $deduction_schedule_view->isConfirm())) {
		$deduction_schedule_view_grid->KeyCount = $CurrentForm->getValue($deduction_schedule_view_grid->FormKeyCountName);
		$deduction_schedule_view_grid->StopRecord = $deduction_schedule_view_grid->StartRecord + $deduction_schedule_view_grid->KeyCount - 1;
	}
}
$deduction_schedule_view_grid->RecordCount = $deduction_schedule_view_grid->StartRecord - 1;
if ($deduction_schedule_view_grid->Recordset && !$deduction_schedule_view_grid->Recordset->EOF) {
	$deduction_schedule_view_grid->Recordset->moveFirst();
	$selectLimit = $deduction_schedule_view_grid->UseSelectLimit;
	if (!$selectLimit && $deduction_schedule_view_grid->StartRecord > 1)
		$deduction_schedule_view_grid->Recordset->move($deduction_schedule_view_grid->StartRecord - 1);
} elseif (!$deduction_schedule_view->AllowAddDeleteRow && $deduction_schedule_view_grid->StopRecord == 0) {
	$deduction_schedule_view_grid->StopRecord = $deduction_schedule_view->GridAddRowCount;
}

// Initialize aggregate
$deduction_schedule_view->RowType = ROWTYPE_AGGREGATEINIT;
$deduction_schedule_view->resetAttributes();
$deduction_schedule_view_grid->renderRow();
if ($deduction_schedule_view_grid->isGridAdd())
	$deduction_schedule_view_grid->RowIndex = 0;
if ($deduction_schedule_view_grid->isGridEdit())
	$deduction_schedule_view_grid->RowIndex = 0;
while ($deduction_schedule_view_grid->RecordCount < $deduction_schedule_view_grid->StopRecord) {
	$deduction_schedule_view_grid->RecordCount++;
	if ($deduction_schedule_view_grid->RecordCount >= $deduction_schedule_view_grid->StartRecord) {
		$deduction_schedule_view_grid->RowCount++;
		if ($deduction_schedule_view_grid->isGridAdd() || $deduction_schedule_view_grid->isGridEdit() || $deduction_schedule_view->isConfirm()) {
			$deduction_schedule_view_grid->RowIndex++;
			$CurrentForm->Index = $deduction_schedule_view_grid->RowIndex;
			if ($CurrentForm->hasValue($deduction_schedule_view_grid->FormActionName) && ($deduction_schedule_view->isConfirm() || $deduction_schedule_view_grid->EventCancelled))
				$deduction_schedule_view_grid->RowAction = strval($CurrentForm->getValue($deduction_schedule_view_grid->FormActionName));
			elseif ($deduction_schedule_view_grid->isGridAdd())
				$deduction_schedule_view_grid->RowAction = "insert";
			else
				$deduction_schedule_view_grid->RowAction = "";
		}

		// Set up key count
		$deduction_schedule_view_grid->KeyCount = $deduction_schedule_view_grid->RowIndex;

		// Init row class and style
		$deduction_schedule_view->resetAttributes();
		$deduction_schedule_view->CssClass = "";
		if ($deduction_schedule_view_grid->isGridAdd()) {
			if ($deduction_schedule_view->CurrentMode == "copy") {
				$deduction_schedule_view_grid->loadRowValues($deduction_schedule_view_grid->Recordset); // Load row values
				$deduction_schedule_view_grid->setRecordKey($deduction_schedule_view_grid->RowOldKey, $deduction_schedule_view_grid->Recordset); // Set old record key
			} else {
				$deduction_schedule_view_grid->loadRowValues(); // Load default values
				$deduction_schedule_view_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$deduction_schedule_view_grid->loadRowValues($deduction_schedule_view_grid->Recordset); // Load row values
		}
		$deduction_schedule_view->RowType = ROWTYPE_VIEW; // Render view
		if ($deduction_schedule_view_grid->isGridAdd()) // Grid add
			$deduction_schedule_view->RowType = ROWTYPE_ADD; // Render add
		if ($deduction_schedule_view_grid->isGridAdd() && $deduction_schedule_view->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$deduction_schedule_view_grid->restoreCurrentRowFormValues($deduction_schedule_view_grid->RowIndex); // Restore form values
		if ($deduction_schedule_view_grid->isGridEdit()) { // Grid edit
			if ($deduction_schedule_view->EventCancelled)
				$deduction_schedule_view_grid->restoreCurrentRowFormValues($deduction_schedule_view_grid->RowIndex); // Restore form values
			if ($deduction_schedule_view_grid->RowAction == "insert")
				$deduction_schedule_view->RowType = ROWTYPE_ADD; // Render add
			else
				$deduction_schedule_view->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($deduction_schedule_view_grid->isGridEdit() && ($deduction_schedule_view->RowType == ROWTYPE_EDIT || $deduction_schedule_view->RowType == ROWTYPE_ADD) && $deduction_schedule_view->EventCancelled) // Update failed
			$deduction_schedule_view_grid->restoreCurrentRowFormValues($deduction_schedule_view_grid->RowIndex); // Restore form values
		if ($deduction_schedule_view->RowType == ROWTYPE_EDIT) // Edit row
			$deduction_schedule_view_grid->EditRowCount++;
		if ($deduction_schedule_view->isConfirm()) // Confirm row
			$deduction_schedule_view_grid->restoreCurrentRowFormValues($deduction_schedule_view_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$deduction_schedule_view->RowAttrs->merge(["data-rowindex" => $deduction_schedule_view_grid->RowCount, "id" => "r" . $deduction_schedule_view_grid->RowCount . "_deduction_schedule_view", "data-rowtype" => $deduction_schedule_view->RowType]);

		// Render row
		$deduction_schedule_view_grid->renderRow();

		// Render list options
		$deduction_schedule_view_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($deduction_schedule_view_grid->RowAction != "delete" && $deduction_schedule_view_grid->RowAction != "insertdelete" && !($deduction_schedule_view_grid->RowAction == "insert" && $deduction_schedule_view->isConfirm() && $deduction_schedule_view_grid->emptyRow())) {
?>
	<tr <?php echo $deduction_schedule_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$deduction_schedule_view_grid->ListOptions->render("body", "left", $deduction_schedule_view_grid->RowCount);
?>
	<?php if ($deduction_schedule_view_grid->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $deduction_schedule_view_grid->EmployeeID->cellAttributes() ?>>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_EmployeeID" class="form-group">
<input type="text" data-table="deduction_schedule_view" data-field="x_EmployeeID" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_EmployeeID" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->EmployeeID->EditValue ?>"<?php echo $deduction_schedule_view_grid->EmployeeID->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_EmployeeID" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_EmployeeID" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($deduction_schedule_view_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="deduction_schedule_view" data-field="x_EmployeeID" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_EmployeeID" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->EmployeeID->EditValue ?>"<?php echo $deduction_schedule_view_grid->EmployeeID->editAttributes() ?>>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_EmployeeID" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_EmployeeID" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($deduction_schedule_view_grid->EmployeeID->OldValue != null ? $deduction_schedule_view_grid->EmployeeID->OldValue : $deduction_schedule_view_grid->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_EmployeeID">
<span<?php echo $deduction_schedule_view_grid->EmployeeID->viewAttributes() ?>><?php echo $deduction_schedule_view_grid->EmployeeID->getViewValue() ?></span>
</span>
<?php if (!$deduction_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_EmployeeID" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_EmployeeID" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($deduction_schedule_view_grid->EmployeeID->FormValue) ?>">
<input type="hidden" data-table="deduction_schedule_view" data-field="x_EmployeeID" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_EmployeeID" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($deduction_schedule_view_grid->EmployeeID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_EmployeeID" name="fdeduction_schedule_viewgrid$x<?php echo $deduction_schedule_view_grid->RowIndex ?>_EmployeeID" id="fdeduction_schedule_viewgrid$x<?php echo $deduction_schedule_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($deduction_schedule_view_grid->EmployeeID->FormValue) ?>">
<input type="hidden" data-table="deduction_schedule_view" data-field="x_EmployeeID" name="fdeduction_schedule_viewgrid$o<?php echo $deduction_schedule_view_grid->RowIndex ?>_EmployeeID" id="fdeduction_schedule_viewgrid$o<?php echo $deduction_schedule_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($deduction_schedule_view_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_grid->PayrollDate->Visible) { // PayrollDate ?>
		<td data-name="PayrollDate" <?php echo $deduction_schedule_view_grid->PayrollDate->cellAttributes() ?>>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_PayrollDate" class="form-group">
<input type="text" data-table="deduction_schedule_view" data-field="x_PayrollDate" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PayrollDate" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PayrollDate" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->PayrollDate->EditValue ?>"<?php echo $deduction_schedule_view_grid->PayrollDate->editAttributes() ?>>
<?php if (!$deduction_schedule_view_grid->PayrollDate->ReadOnly && !$deduction_schedule_view_grid->PayrollDate->Disabled && !isset($deduction_schedule_view_grid->PayrollDate->EditAttrs["readonly"]) && !isset($deduction_schedule_view_grid->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdeduction_schedule_viewgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdeduction_schedule_viewgrid", "x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_PayrollDate" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_PayrollDate" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($deduction_schedule_view_grid->PayrollDate->OldValue) ?>">
<?php } ?>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_PayrollDate" class="form-group">
<input type="text" data-table="deduction_schedule_view" data-field="x_PayrollDate" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PayrollDate" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PayrollDate" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->PayrollDate->EditValue ?>"<?php echo $deduction_schedule_view_grid->PayrollDate->editAttributes() ?>>
<?php if (!$deduction_schedule_view_grid->PayrollDate->ReadOnly && !$deduction_schedule_view_grid->PayrollDate->Disabled && !isset($deduction_schedule_view_grid->PayrollDate->EditAttrs["readonly"]) && !isset($deduction_schedule_view_grid->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdeduction_schedule_viewgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdeduction_schedule_viewgrid", "x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_PayrollDate">
<span<?php echo $deduction_schedule_view_grid->PayrollDate->viewAttributes() ?>><?php echo $deduction_schedule_view_grid->PayrollDate->getViewValue() ?></span>
</span>
<?php if (!$deduction_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_PayrollDate" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PayrollDate" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($deduction_schedule_view_grid->PayrollDate->FormValue) ?>">
<input type="hidden" data-table="deduction_schedule_view" data-field="x_PayrollDate" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_PayrollDate" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($deduction_schedule_view_grid->PayrollDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_PayrollDate" name="fdeduction_schedule_viewgrid$x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PayrollDate" id="fdeduction_schedule_viewgrid$x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($deduction_schedule_view_grid->PayrollDate->FormValue) ?>">
<input type="hidden" data-table="deduction_schedule_view" data-field="x_PayrollDate" name="fdeduction_schedule_viewgrid$o<?php echo $deduction_schedule_view_grid->RowIndex ?>_PayrollDate" id="fdeduction_schedule_viewgrid$o<?php echo $deduction_schedule_view_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($deduction_schedule_view_grid->PayrollDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_grid->LAName->Visible) { // LAName ?>
		<td data-name="LAName" <?php echo $deduction_schedule_view_grid->LAName->cellAttributes() ?>>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_LAName" class="form-group">
<input type="text" data-table="deduction_schedule_view" data-field="x_LAName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_LAName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_LAName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->LAName->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->LAName->EditValue ?>"<?php echo $deduction_schedule_view_grid->LAName->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_LAName" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_LAName" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->LAName->OldValue) ?>">
<?php } ?>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_LAName" class="form-group">
<input type="text" data-table="deduction_schedule_view" data-field="x_LAName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_LAName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_LAName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->LAName->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->LAName->EditValue ?>"<?php echo $deduction_schedule_view_grid->LAName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_LAName">
<span<?php echo $deduction_schedule_view_grid->LAName->viewAttributes() ?>><?php echo $deduction_schedule_view_grid->LAName->getViewValue() ?></span>
</span>
<?php if (!$deduction_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_LAName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_LAName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->LAName->FormValue) ?>">
<input type="hidden" data-table="deduction_schedule_view" data-field="x_LAName" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_LAName" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->LAName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_LAName" name="fdeduction_schedule_viewgrid$x<?php echo $deduction_schedule_view_grid->RowIndex ?>_LAName" id="fdeduction_schedule_viewgrid$x<?php echo $deduction_schedule_view_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->LAName->FormValue) ?>">
<input type="hidden" data-table="deduction_schedule_view" data-field="x_LAName" name="fdeduction_schedule_viewgrid$o<?php echo $deduction_schedule_view_grid->RowIndex ?>_LAName" id="fdeduction_schedule_viewgrid$o<?php echo $deduction_schedule_view_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->LAName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_grid->DeductionName->Visible) { // DeductionName ?>
		<td data-name="DeductionName" <?php echo $deduction_schedule_view_grid->DeductionName->cellAttributes() ?>>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_DeductionName" class="form-group">
<input type="text" data-table="deduction_schedule_view" data-field="x_DeductionName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->DeductionName->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->DeductionName->EditValue ?>"<?php echo $deduction_schedule_view_grid->DeductionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_DeductionName" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionName" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->DeductionName->OldValue) ?>">
<?php } ?>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_DeductionName" class="form-group">
<input type="text" data-table="deduction_schedule_view" data-field="x_DeductionName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->DeductionName->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->DeductionName->EditValue ?>"<?php echo $deduction_schedule_view_grid->DeductionName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_DeductionName">
<span<?php echo $deduction_schedule_view_grid->DeductionName->viewAttributes() ?>><?php echo $deduction_schedule_view_grid->DeductionName->getViewValue() ?></span>
</span>
<?php if (!$deduction_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_DeductionName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->DeductionName->FormValue) ?>">
<input type="hidden" data-table="deduction_schedule_view" data-field="x_DeductionName" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionName" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->DeductionName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_DeductionName" name="fdeduction_schedule_viewgrid$x<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionName" id="fdeduction_schedule_viewgrid$x<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->DeductionName->FormValue) ?>">
<input type="hidden" data-table="deduction_schedule_view" data-field="x_DeductionName" name="fdeduction_schedule_viewgrid$o<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionName" id="fdeduction_schedule_viewgrid$o<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->DeductionName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_grid->DeductionAmount->Visible) { // DeductionAmount ?>
		<td data-name="DeductionAmount" <?php echo $deduction_schedule_view_grid->DeductionAmount->cellAttributes() ?>>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_DeductionAmount" class="form-group">
<input type="text" data-table="deduction_schedule_view" data-field="x_DeductionAmount" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionAmount" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->DeductionAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->DeductionAmount->EditValue ?>"<?php echo $deduction_schedule_view_grid->DeductionAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_DeductionAmount" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionAmount" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionAmount" value="<?php echo HtmlEncode($deduction_schedule_view_grid->DeductionAmount->OldValue) ?>">
<?php } ?>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_DeductionAmount" class="form-group">
<input type="text" data-table="deduction_schedule_view" data-field="x_DeductionAmount" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionAmount" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->DeductionAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->DeductionAmount->EditValue ?>"<?php echo $deduction_schedule_view_grid->DeductionAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_DeductionAmount">
<span<?php echo $deduction_schedule_view_grid->DeductionAmount->viewAttributes() ?>><?php echo $deduction_schedule_view_grid->DeductionAmount->getViewValue() ?></span>
</span>
<?php if (!$deduction_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_DeductionAmount" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionAmount" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionAmount" value="<?php echo HtmlEncode($deduction_schedule_view_grid->DeductionAmount->FormValue) ?>">
<input type="hidden" data-table="deduction_schedule_view" data-field="x_DeductionAmount" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionAmount" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionAmount" value="<?php echo HtmlEncode($deduction_schedule_view_grid->DeductionAmount->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_DeductionAmount" name="fdeduction_schedule_viewgrid$x<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionAmount" id="fdeduction_schedule_viewgrid$x<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionAmount" value="<?php echo HtmlEncode($deduction_schedule_view_grid->DeductionAmount->FormValue) ?>">
<input type="hidden" data-table="deduction_schedule_view" data-field="x_DeductionAmount" name="fdeduction_schedule_viewgrid$o<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionAmount" id="fdeduction_schedule_viewgrid$o<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionAmount" value="<?php echo HtmlEncode($deduction_schedule_view_grid->DeductionAmount->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_grid->NRC->Visible) { // NRC ?>
		<td data-name="NRC" <?php echo $deduction_schedule_view_grid->NRC->cellAttributes() ?>>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_NRC" class="form-group">
<input type="text" data-table="deduction_schedule_view" data-field="x_NRC" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_NRC" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->NRC->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->NRC->EditValue ?>"<?php echo $deduction_schedule_view_grid->NRC->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_NRC" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_NRC" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($deduction_schedule_view_grid->NRC->OldValue) ?>">
<?php } ?>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_NRC" class="form-group">
<input type="text" data-table="deduction_schedule_view" data-field="x_NRC" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_NRC" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->NRC->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->NRC->EditValue ?>"<?php echo $deduction_schedule_view_grid->NRC->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_NRC">
<span<?php echo $deduction_schedule_view_grid->NRC->viewAttributes() ?>><?php echo $deduction_schedule_view_grid->NRC->getViewValue() ?></span>
</span>
<?php if (!$deduction_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_NRC" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_NRC" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($deduction_schedule_view_grid->NRC->FormValue) ?>">
<input type="hidden" data-table="deduction_schedule_view" data-field="x_NRC" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_NRC" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($deduction_schedule_view_grid->NRC->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_NRC" name="fdeduction_schedule_viewgrid$x<?php echo $deduction_schedule_view_grid->RowIndex ?>_NRC" id="fdeduction_schedule_viewgrid$x<?php echo $deduction_schedule_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($deduction_schedule_view_grid->NRC->FormValue) ?>">
<input type="hidden" data-table="deduction_schedule_view" data-field="x_NRC" name="fdeduction_schedule_viewgrid$o<?php echo $deduction_schedule_view_grid->RowIndex ?>_NRC" id="fdeduction_schedule_viewgrid$o<?php echo $deduction_schedule_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($deduction_schedule_view_grid->NRC->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_grid->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $deduction_schedule_view_grid->Surname->cellAttributes() ?>>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_Surname" class="form-group">
<input type="text" data-table="deduction_schedule_view" data-field="x_Surname" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_Surname" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->Surname->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->Surname->EditValue ?>"<?php echo $deduction_schedule_view_grid->Surname->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_Surname" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_Surname" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($deduction_schedule_view_grid->Surname->OldValue) ?>">
<?php } ?>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_Surname" class="form-group">
<input type="text" data-table="deduction_schedule_view" data-field="x_Surname" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_Surname" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->Surname->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->Surname->EditValue ?>"<?php echo $deduction_schedule_view_grid->Surname->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_Surname">
<span<?php echo $deduction_schedule_view_grid->Surname->viewAttributes() ?>><?php echo $deduction_schedule_view_grid->Surname->getViewValue() ?></span>
</span>
<?php if (!$deduction_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_Surname" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_Surname" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($deduction_schedule_view_grid->Surname->FormValue) ?>">
<input type="hidden" data-table="deduction_schedule_view" data-field="x_Surname" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_Surname" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($deduction_schedule_view_grid->Surname->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_Surname" name="fdeduction_schedule_viewgrid$x<?php echo $deduction_schedule_view_grid->RowIndex ?>_Surname" id="fdeduction_schedule_viewgrid$x<?php echo $deduction_schedule_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($deduction_schedule_view_grid->Surname->FormValue) ?>">
<input type="hidden" data-table="deduction_schedule_view" data-field="x_Surname" name="fdeduction_schedule_viewgrid$o<?php echo $deduction_schedule_view_grid->RowIndex ?>_Surname" id="fdeduction_schedule_viewgrid$o<?php echo $deduction_schedule_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($deduction_schedule_view_grid->Surname->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_grid->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $deduction_schedule_view_grid->MiddleName->cellAttributes() ?>>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_MiddleName" class="form-group">
<input type="text" data-table="deduction_schedule_view" data-field="x_MiddleName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_MiddleName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->MiddleName->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->MiddleName->EditValue ?>"<?php echo $deduction_schedule_view_grid->MiddleName->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_MiddleName" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_MiddleName" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->MiddleName->OldValue) ?>">
<?php } ?>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_MiddleName" class="form-group">
<input type="text" data-table="deduction_schedule_view" data-field="x_MiddleName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_MiddleName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->MiddleName->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->MiddleName->EditValue ?>"<?php echo $deduction_schedule_view_grid->MiddleName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_MiddleName">
<span<?php echo $deduction_schedule_view_grid->MiddleName->viewAttributes() ?>><?php echo $deduction_schedule_view_grid->MiddleName->getViewValue() ?></span>
</span>
<?php if (!$deduction_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_MiddleName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_MiddleName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->MiddleName->FormValue) ?>">
<input type="hidden" data-table="deduction_schedule_view" data-field="x_MiddleName" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_MiddleName" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->MiddleName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_MiddleName" name="fdeduction_schedule_viewgrid$x<?php echo $deduction_schedule_view_grid->RowIndex ?>_MiddleName" id="fdeduction_schedule_viewgrid$x<?php echo $deduction_schedule_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->MiddleName->FormValue) ?>">
<input type="hidden" data-table="deduction_schedule_view" data-field="x_MiddleName" name="fdeduction_schedule_viewgrid$o<?php echo $deduction_schedule_view_grid->RowIndex ?>_MiddleName" id="fdeduction_schedule_viewgrid$o<?php echo $deduction_schedule_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->MiddleName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_grid->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $deduction_schedule_view_grid->FirstName->cellAttributes() ?>>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_FirstName" class="form-group">
<input type="text" data-table="deduction_schedule_view" data-field="x_FirstName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_FirstName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->FirstName->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->FirstName->EditValue ?>"<?php echo $deduction_schedule_view_grid->FirstName->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_FirstName" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_FirstName" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->FirstName->OldValue) ?>">
<?php } ?>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_FirstName" class="form-group">
<input type="text" data-table="deduction_schedule_view" data-field="x_FirstName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_FirstName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->FirstName->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->FirstName->EditValue ?>"<?php echo $deduction_schedule_view_grid->FirstName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_FirstName">
<span<?php echo $deduction_schedule_view_grid->FirstName->viewAttributes() ?>><?php echo $deduction_schedule_view_grid->FirstName->getViewValue() ?></span>
</span>
<?php if (!$deduction_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_FirstName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_FirstName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->FirstName->FormValue) ?>">
<input type="hidden" data-table="deduction_schedule_view" data-field="x_FirstName" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_FirstName" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->FirstName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_FirstName" name="fdeduction_schedule_viewgrid$x<?php echo $deduction_schedule_view_grid->RowIndex ?>_FirstName" id="fdeduction_schedule_viewgrid$x<?php echo $deduction_schedule_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->FirstName->FormValue) ?>">
<input type="hidden" data-table="deduction_schedule_view" data-field="x_FirstName" name="fdeduction_schedule_viewgrid$o<?php echo $deduction_schedule_view_grid->RowIndex ?>_FirstName" id="fdeduction_schedule_viewgrid$o<?php echo $deduction_schedule_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->FirstName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_grid->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName" <?php echo $deduction_schedule_view_grid->PositionName->cellAttributes() ?>>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_PositionName" class="form-group">
<input type="text" data-table="deduction_schedule_view" data-field="x_PositionName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PositionName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->PositionName->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->PositionName->EditValue ?>"<?php echo $deduction_schedule_view_grid->PositionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_PositionName" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_PositionName" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->PositionName->OldValue) ?>">
<?php } ?>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_PositionName" class="form-group">
<input type="text" data-table="deduction_schedule_view" data-field="x_PositionName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PositionName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->PositionName->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->PositionName->EditValue ?>"<?php echo $deduction_schedule_view_grid->PositionName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_PositionName">
<span<?php echo $deduction_schedule_view_grid->PositionName->viewAttributes() ?>><?php echo $deduction_schedule_view_grid->PositionName->getViewValue() ?></span>
</span>
<?php if (!$deduction_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_PositionName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PositionName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->PositionName->FormValue) ?>">
<input type="hidden" data-table="deduction_schedule_view" data-field="x_PositionName" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_PositionName" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->PositionName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_PositionName" name="fdeduction_schedule_viewgrid$x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PositionName" id="fdeduction_schedule_viewgrid$x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->PositionName->FormValue) ?>">
<input type="hidden" data-table="deduction_schedule_view" data-field="x_PositionName" name="fdeduction_schedule_viewgrid$o<?php echo $deduction_schedule_view_grid->RowIndex ?>_PositionName" id="fdeduction_schedule_viewgrid$o<?php echo $deduction_schedule_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->PositionName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_grid->PeriodCode->Visible) { // PeriodCode ?>
		<td data-name="PeriodCode" <?php echo $deduction_schedule_view_grid->PeriodCode->cellAttributes() ?>>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_PeriodCode" class="form-group"></span>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_PeriodCode" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_PeriodCode" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($deduction_schedule_view_grid->PeriodCode->OldValue) ?>">
<?php } ?>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($deduction_schedule_view_grid->PeriodCode->getSessionValue() != "") { ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_PeriodCode" class="form-group">
<span<?php echo $deduction_schedule_view_grid->PeriodCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($deduction_schedule_view_grid->PeriodCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PeriodCode" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($deduction_schedule_view_grid->PeriodCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_PeriodCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="deduction_schedule_view" data-field="x_PeriodCode" data-value-separator="<?php echo $deduction_schedule_view_grid->PeriodCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PeriodCode" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PeriodCode"<?php echo $deduction_schedule_view_grid->PeriodCode->editAttributes() ?>>
			<?php echo $deduction_schedule_view_grid->PeriodCode->selectOptionListHtml("x{$deduction_schedule_view_grid->RowIndex}_PeriodCode") ?>
		</select>
</div>
<?php echo $deduction_schedule_view_grid->PeriodCode->Lookup->getParamTag($deduction_schedule_view_grid, "p_x" . $deduction_schedule_view_grid->RowIndex . "_PeriodCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_schedule_view_grid->RowCount ?>_deduction_schedule_view_PeriodCode">
<span<?php echo $deduction_schedule_view_grid->PeriodCode->viewAttributes() ?>><?php echo $deduction_schedule_view_grid->PeriodCode->getViewValue() ?></span>
</span>
<?php if (!$deduction_schedule_view->isConfirm()) { ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_PeriodCode" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PeriodCode" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($deduction_schedule_view_grid->PeriodCode->FormValue) ?>">
<input type="hidden" data-table="deduction_schedule_view" data-field="x_PeriodCode" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_PeriodCode" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($deduction_schedule_view_grid->PeriodCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_PeriodCode" name="fdeduction_schedule_viewgrid$x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PeriodCode" id="fdeduction_schedule_viewgrid$x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($deduction_schedule_view_grid->PeriodCode->FormValue) ?>">
<input type="hidden" data-table="deduction_schedule_view" data-field="x_PeriodCode" name="fdeduction_schedule_viewgrid$o<?php echo $deduction_schedule_view_grid->RowIndex ?>_PeriodCode" id="fdeduction_schedule_viewgrid$o<?php echo $deduction_schedule_view_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($deduction_schedule_view_grid->PeriodCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$deduction_schedule_view_grid->ListOptions->render("body", "right", $deduction_schedule_view_grid->RowCount);
?>
	</tr>
<?php if ($deduction_schedule_view->RowType == ROWTYPE_ADD || $deduction_schedule_view->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdeduction_schedule_viewgrid", "load"], function() {
	fdeduction_schedule_viewgrid.updateLists(<?php echo $deduction_schedule_view_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$deduction_schedule_view_grid->isGridAdd() || $deduction_schedule_view->CurrentMode == "copy")
		if (!$deduction_schedule_view_grid->Recordset->EOF)
			$deduction_schedule_view_grid->Recordset->moveNext();
}
?>
<?php
	if ($deduction_schedule_view->CurrentMode == "add" || $deduction_schedule_view->CurrentMode == "copy" || $deduction_schedule_view->CurrentMode == "edit") {
		$deduction_schedule_view_grid->RowIndex = '$rowindex$';
		$deduction_schedule_view_grid->loadRowValues();

		// Set row properties
		$deduction_schedule_view->resetAttributes();
		$deduction_schedule_view->RowAttrs->merge(["data-rowindex" => $deduction_schedule_view_grid->RowIndex, "id" => "r0_deduction_schedule_view", "data-rowtype" => ROWTYPE_ADD]);
		$deduction_schedule_view->RowAttrs->appendClass("ew-template");
		$deduction_schedule_view->RowType = ROWTYPE_ADD;

		// Render row
		$deduction_schedule_view_grid->renderRow();

		// Render list options
		$deduction_schedule_view_grid->renderListOptions();
		$deduction_schedule_view_grid->StartRowCount = 0;
?>
	<tr <?php echo $deduction_schedule_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$deduction_schedule_view_grid->ListOptions->render("body", "left", $deduction_schedule_view_grid->RowIndex);
?>
	<?php if ($deduction_schedule_view_grid->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID">
<?php if (!$deduction_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_deduction_schedule_view_EmployeeID" class="form-group deduction_schedule_view_EmployeeID">
<input type="text" data-table="deduction_schedule_view" data-field="x_EmployeeID" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_EmployeeID" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->EmployeeID->EditValue ?>"<?php echo $deduction_schedule_view_grid->EmployeeID->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_deduction_schedule_view_EmployeeID" class="form-group deduction_schedule_view_EmployeeID">
<span<?php echo $deduction_schedule_view_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($deduction_schedule_view_grid->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_EmployeeID" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_EmployeeID" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($deduction_schedule_view_grid->EmployeeID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_EmployeeID" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_EmployeeID" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($deduction_schedule_view_grid->EmployeeID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_grid->PayrollDate->Visible) { // PayrollDate ?>
		<td data-name="PayrollDate">
<?php if (!$deduction_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_deduction_schedule_view_PayrollDate" class="form-group deduction_schedule_view_PayrollDate">
<input type="text" data-table="deduction_schedule_view" data-field="x_PayrollDate" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PayrollDate" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PayrollDate" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->PayrollDate->EditValue ?>"<?php echo $deduction_schedule_view_grid->PayrollDate->editAttributes() ?>>
<?php if (!$deduction_schedule_view_grid->PayrollDate->ReadOnly && !$deduction_schedule_view_grid->PayrollDate->Disabled && !isset($deduction_schedule_view_grid->PayrollDate->EditAttrs["readonly"]) && !isset($deduction_schedule_view_grid->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdeduction_schedule_viewgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdeduction_schedule_viewgrid", "x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_deduction_schedule_view_PayrollDate" class="form-group deduction_schedule_view_PayrollDate">
<span<?php echo $deduction_schedule_view_grid->PayrollDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($deduction_schedule_view_grid->PayrollDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_PayrollDate" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PayrollDate" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($deduction_schedule_view_grid->PayrollDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_PayrollDate" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_PayrollDate" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($deduction_schedule_view_grid->PayrollDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_grid->LAName->Visible) { // LAName ?>
		<td data-name="LAName">
<?php if (!$deduction_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_deduction_schedule_view_LAName" class="form-group deduction_schedule_view_LAName">
<input type="text" data-table="deduction_schedule_view" data-field="x_LAName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_LAName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_LAName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->LAName->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->LAName->EditValue ?>"<?php echo $deduction_schedule_view_grid->LAName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_deduction_schedule_view_LAName" class="form-group deduction_schedule_view_LAName">
<span<?php echo $deduction_schedule_view_grid->LAName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($deduction_schedule_view_grid->LAName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_LAName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_LAName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->LAName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_LAName" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_LAName" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->LAName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_grid->DeductionName->Visible) { // DeductionName ?>
		<td data-name="DeductionName">
<?php if (!$deduction_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_deduction_schedule_view_DeductionName" class="form-group deduction_schedule_view_DeductionName">
<input type="text" data-table="deduction_schedule_view" data-field="x_DeductionName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->DeductionName->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->DeductionName->EditValue ?>"<?php echo $deduction_schedule_view_grid->DeductionName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_deduction_schedule_view_DeductionName" class="form-group deduction_schedule_view_DeductionName">
<span<?php echo $deduction_schedule_view_grid->DeductionName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($deduction_schedule_view_grid->DeductionName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_DeductionName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->DeductionName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_DeductionName" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionName" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->DeductionName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_grid->DeductionAmount->Visible) { // DeductionAmount ?>
		<td data-name="DeductionAmount">
<?php if (!$deduction_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_deduction_schedule_view_DeductionAmount" class="form-group deduction_schedule_view_DeductionAmount">
<input type="text" data-table="deduction_schedule_view" data-field="x_DeductionAmount" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionAmount" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->DeductionAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->DeductionAmount->EditValue ?>"<?php echo $deduction_schedule_view_grid->DeductionAmount->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_deduction_schedule_view_DeductionAmount" class="form-group deduction_schedule_view_DeductionAmount">
<span<?php echo $deduction_schedule_view_grid->DeductionAmount->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($deduction_schedule_view_grid->DeductionAmount->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_DeductionAmount" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionAmount" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionAmount" value="<?php echo HtmlEncode($deduction_schedule_view_grid->DeductionAmount->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_DeductionAmount" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionAmount" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_DeductionAmount" value="<?php echo HtmlEncode($deduction_schedule_view_grid->DeductionAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_grid->NRC->Visible) { // NRC ?>
		<td data-name="NRC">
<?php if (!$deduction_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_deduction_schedule_view_NRC" class="form-group deduction_schedule_view_NRC">
<input type="text" data-table="deduction_schedule_view" data-field="x_NRC" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_NRC" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->NRC->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->NRC->EditValue ?>"<?php echo $deduction_schedule_view_grid->NRC->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_deduction_schedule_view_NRC" class="form-group deduction_schedule_view_NRC">
<span<?php echo $deduction_schedule_view_grid->NRC->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($deduction_schedule_view_grid->NRC->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_NRC" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_NRC" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($deduction_schedule_view_grid->NRC->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_NRC" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_NRC" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($deduction_schedule_view_grid->NRC->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_grid->Surname->Visible) { // Surname ?>
		<td data-name="Surname">
<?php if (!$deduction_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_deduction_schedule_view_Surname" class="form-group deduction_schedule_view_Surname">
<input type="text" data-table="deduction_schedule_view" data-field="x_Surname" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_Surname" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->Surname->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->Surname->EditValue ?>"<?php echo $deduction_schedule_view_grid->Surname->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_deduction_schedule_view_Surname" class="form-group deduction_schedule_view_Surname">
<span<?php echo $deduction_schedule_view_grid->Surname->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($deduction_schedule_view_grid->Surname->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_Surname" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_Surname" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($deduction_schedule_view_grid->Surname->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_Surname" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_Surname" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($deduction_schedule_view_grid->Surname->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_grid->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName">
<?php if (!$deduction_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_deduction_schedule_view_MiddleName" class="form-group deduction_schedule_view_MiddleName">
<input type="text" data-table="deduction_schedule_view" data-field="x_MiddleName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_MiddleName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->MiddleName->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->MiddleName->EditValue ?>"<?php echo $deduction_schedule_view_grid->MiddleName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_deduction_schedule_view_MiddleName" class="form-group deduction_schedule_view_MiddleName">
<span<?php echo $deduction_schedule_view_grid->MiddleName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($deduction_schedule_view_grid->MiddleName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_MiddleName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_MiddleName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->MiddleName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_MiddleName" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_MiddleName" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->MiddleName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_grid->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName">
<?php if (!$deduction_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_deduction_schedule_view_FirstName" class="form-group deduction_schedule_view_FirstName">
<input type="text" data-table="deduction_schedule_view" data-field="x_FirstName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_FirstName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->FirstName->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->FirstName->EditValue ?>"<?php echo $deduction_schedule_view_grid->FirstName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_deduction_schedule_view_FirstName" class="form-group deduction_schedule_view_FirstName">
<span<?php echo $deduction_schedule_view_grid->FirstName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($deduction_schedule_view_grid->FirstName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_FirstName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_FirstName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->FirstName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_FirstName" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_FirstName" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->FirstName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_grid->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName">
<?php if (!$deduction_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_deduction_schedule_view_PositionName" class="form-group deduction_schedule_view_PositionName">
<input type="text" data-table="deduction_schedule_view" data-field="x_PositionName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PositionName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($deduction_schedule_view_grid->PositionName->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_grid->PositionName->EditValue ?>"<?php echo $deduction_schedule_view_grid->PositionName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_deduction_schedule_view_PositionName" class="form-group deduction_schedule_view_PositionName">
<span<?php echo $deduction_schedule_view_grid->PositionName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($deduction_schedule_view_grid->PositionName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_PositionName" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PositionName" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->PositionName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_PositionName" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_PositionName" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($deduction_schedule_view_grid->PositionName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_grid->PeriodCode->Visible) { // PeriodCode ?>
		<td data-name="PeriodCode">
<?php if (!$deduction_schedule_view->isConfirm()) { ?>
<span id="el$rowindex$_deduction_schedule_view_PeriodCode" class="form-group deduction_schedule_view_PeriodCode"></span>
<?php } else { ?>
<span id="el$rowindex$_deduction_schedule_view_PeriodCode" class="form-group deduction_schedule_view_PeriodCode">
<span<?php echo $deduction_schedule_view_grid->PeriodCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($deduction_schedule_view_grid->PeriodCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_PeriodCode" name="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PeriodCode" id="x<?php echo $deduction_schedule_view_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($deduction_schedule_view_grid->PeriodCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="deduction_schedule_view" data-field="x_PeriodCode" name="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_PeriodCode" id="o<?php echo $deduction_schedule_view_grid->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($deduction_schedule_view_grid->PeriodCode->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$deduction_schedule_view_grid->ListOptions->render("body", "right", $deduction_schedule_view_grid->RowIndex);
?>
<script>
loadjs.ready(["fdeduction_schedule_viewgrid", "load"], function() {
	fdeduction_schedule_viewgrid.updateLists(<?php echo $deduction_schedule_view_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($deduction_schedule_view->CurrentMode == "add" || $deduction_schedule_view->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $deduction_schedule_view_grid->FormKeyCountName ?>" id="<?php echo $deduction_schedule_view_grid->FormKeyCountName ?>" value="<?php echo $deduction_schedule_view_grid->KeyCount ?>">
<?php echo $deduction_schedule_view_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($deduction_schedule_view->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $deduction_schedule_view_grid->FormKeyCountName ?>" id="<?php echo $deduction_schedule_view_grid->FormKeyCountName ?>" value="<?php echo $deduction_schedule_view_grid->KeyCount ?>">
<?php echo $deduction_schedule_view_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($deduction_schedule_view->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdeduction_schedule_viewgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($deduction_schedule_view_grid->Recordset)
	$deduction_schedule_view_grid->Recordset->Close();
?>
<?php if ($deduction_schedule_view_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $deduction_schedule_view_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($deduction_schedule_view_grid->TotalRecords == 0 && !$deduction_schedule_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $deduction_schedule_view_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$deduction_schedule_view_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$deduction_schedule_view_grid->terminate();
?>