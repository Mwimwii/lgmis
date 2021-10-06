<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($employment_grid))
	$employment_grid = new employment_grid();

// Run the page
$employment_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_grid->Page_Render();
?>
<?php if (!$employment_grid->isExport()) { ?>
<script>
var femploymentgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	femploymentgrid = new ew.Form("femploymentgrid", "grid");
	femploymentgrid.formKeyCountName = '<?php echo $employment_grid->FormKeyCountName ?>';

	// Validate form
	femploymentgrid.validate = function() {
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
			<?php if ($employment_grid->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_grid->ProvinceCode->caption(), $employment_grid->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_grid->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_grid->LACode->caption(), $employment_grid->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_grid->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_grid->DepartmentCode->caption(), $employment_grid->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_grid->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_grid->SectionCode->caption(), $employment_grid->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_grid->SubstantivePosition->Required) { ?>
				elm = this.getElements("x" + infix + "_SubstantivePosition");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_grid->SubstantivePosition->caption(), $employment_grid->SubstantivePosition->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_grid->DateOfCurrentAppointment->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfCurrentAppointment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_grid->DateOfCurrentAppointment->caption(), $employment_grid->DateOfCurrentAppointment->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfCurrentAppointment");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_grid->DateOfCurrentAppointment->errorMessage()) ?>");
			<?php if ($employment_grid->LastAppraisalDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastAppraisalDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_grid->LastAppraisalDate->caption(), $employment_grid->LastAppraisalDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastAppraisalDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_grid->LastAppraisalDate->errorMessage()) ?>");
			<?php if ($employment_grid->AppraisalStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_AppraisalStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_grid->AppraisalStatus->caption(), $employment_grid->AppraisalStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_grid->DateOfExit->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfExit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_grid->DateOfExit->caption(), $employment_grid->DateOfExit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfExit");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_grid->DateOfExit->errorMessage()) ?>");
			<?php if ($employment_grid->EmploymentType->Required) { ?>
				elm = this.getElements("x" + infix + "_EmploymentType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_grid->EmploymentType->caption(), $employment_grid->EmploymentType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_grid->EmploymentStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_EmploymentStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_grid->EmploymentStatus->caption(), $employment_grid->EmploymentStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_grid->EmployeeNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_grid->EmployeeNumber->caption(), $employment_grid->EmployeeNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_grid->SalaryNotch->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryNotch");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_grid->SalaryNotch->caption(), $employment_grid->SalaryNotch->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_grid->BasicMonthlySalary->Required) { ?>
				elm = this.getElements("x" + infix + "_BasicMonthlySalary");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_grid->BasicMonthlySalary->caption(), $employment_grid->BasicMonthlySalary->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BasicMonthlySalary");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_grid->BasicMonthlySalary->errorMessage()) ?>");
			<?php if ($employment_grid->ThirdParties->Required) { ?>
				elm = this.getElements("x" + infix + "_ThirdParties[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_grid->ThirdParties->caption(), $employment_grid->ThirdParties->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_grid->PayrollCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_grid->PayrollCode->caption(), $employment_grid->PayrollCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_grid->PayrollCode->errorMessage()) ?>");
			<?php if ($employment_grid->DateOfConfirmation->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfConfirmation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_grid->DateOfConfirmation->caption(), $employment_grid->DateOfConfirmation->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfConfirmation");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_grid->DateOfConfirmation->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	femploymentgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ProvinceCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SectionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SubstantivePosition", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateOfCurrentAppointment", false)) return false;
		if (ew.valueChanged(fobj, infix, "LastAppraisalDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "AppraisalStatus", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateOfExit", false)) return false;
		if (ew.valueChanged(fobj, infix, "EmploymentType", false)) return false;
		if (ew.valueChanged(fobj, infix, "EmploymentStatus", false)) return false;
		if (ew.valueChanged(fobj, infix, "EmployeeNumber", false)) return false;
		if (ew.valueChanged(fobj, infix, "SalaryNotch", false)) return false;
		if (ew.valueChanged(fobj, infix, "BasicMonthlySalary", false)) return false;
		if (ew.valueChanged(fobj, infix, "ThirdParties[]", false)) return false;
		if (ew.valueChanged(fobj, infix, "PayrollCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateOfConfirmation", false)) return false;
		return true;
	}

	// Form_CustomValidate
	femploymentgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femploymentgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femploymentgrid.lists["x_ProvinceCode"] = <?php echo $employment_grid->ProvinceCode->Lookup->toClientList($employment_grid) ?>;
	femploymentgrid.lists["x_ProvinceCode"].options = <?php echo JsonEncode($employment_grid->ProvinceCode->lookupOptions()) ?>;
	femploymentgrid.lists["x_LACode"] = <?php echo $employment_grid->LACode->Lookup->toClientList($employment_grid) ?>;
	femploymentgrid.lists["x_LACode"].options = <?php echo JsonEncode($employment_grid->LACode->lookupOptions()) ?>;
	femploymentgrid.lists["x_DepartmentCode"] = <?php echo $employment_grid->DepartmentCode->Lookup->toClientList($employment_grid) ?>;
	femploymentgrid.lists["x_DepartmentCode"].options = <?php echo JsonEncode($employment_grid->DepartmentCode->lookupOptions()) ?>;
	femploymentgrid.lists["x_SectionCode"] = <?php echo $employment_grid->SectionCode->Lookup->toClientList($employment_grid) ?>;
	femploymentgrid.lists["x_SectionCode"].options = <?php echo JsonEncode($employment_grid->SectionCode->lookupOptions()) ?>;
	femploymentgrid.lists["x_SubstantivePosition"] = <?php echo $employment_grid->SubstantivePosition->Lookup->toClientList($employment_grid) ?>;
	femploymentgrid.lists["x_SubstantivePosition"].options = <?php echo JsonEncode($employment_grid->SubstantivePosition->lookupOptions()) ?>;
	femploymentgrid.lists["x_AppraisalStatus"] = <?php echo $employment_grid->AppraisalStatus->Lookup->toClientList($employment_grid) ?>;
	femploymentgrid.lists["x_AppraisalStatus"].options = <?php echo JsonEncode($employment_grid->AppraisalStatus->lookupOptions()) ?>;
	femploymentgrid.lists["x_EmploymentType"] = <?php echo $employment_grid->EmploymentType->Lookup->toClientList($employment_grid) ?>;
	femploymentgrid.lists["x_EmploymentType"].options = <?php echo JsonEncode($employment_grid->EmploymentType->lookupOptions()) ?>;
	femploymentgrid.lists["x_EmploymentStatus"] = <?php echo $employment_grid->EmploymentStatus->Lookup->toClientList($employment_grid) ?>;
	femploymentgrid.lists["x_EmploymentStatus"].options = <?php echo JsonEncode($employment_grid->EmploymentStatus->lookupOptions()) ?>;
	femploymentgrid.lists["x_SalaryNotch"] = <?php echo $employment_grid->SalaryNotch->Lookup->toClientList($employment_grid) ?>;
	femploymentgrid.lists["x_SalaryNotch"].options = <?php echo JsonEncode($employment_grid->SalaryNotch->lookupOptions()) ?>;
	femploymentgrid.lists["x_ThirdParties[]"] = <?php echo $employment_grid->ThirdParties->Lookup->toClientList($employment_grid) ?>;
	femploymentgrid.lists["x_ThirdParties[]"].options = <?php echo JsonEncode($employment_grid->ThirdParties->lookupOptions()) ?>;
	loadjs.done("femploymentgrid");
});
</script>
<?php } ?>
<?php
$employment_grid->renderOtherOptions();
?>
<?php if ($employment_grid->TotalRecords > 0 || $employment->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($employment_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> employment">
<?php if ($employment_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $employment_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="femploymentgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_employment" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_employmentgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$employment->RowType = ROWTYPE_HEADER;

// Render list options
$employment_grid->renderListOptions();

// Render list options (header, left)
$employment_grid->ListOptions->render("header", "left");
?>
<?php if ($employment_grid->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($employment_grid->SortUrl($employment_grid->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $employment_grid->ProvinceCode->headerCellClass() ?>"><div id="elh_employment_ProvinceCode" class="employment_ProvinceCode"><div class="ew-table-header-caption"><?php echo $employment_grid->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $employment_grid->ProvinceCode->headerCellClass() ?>"><div><div id="elh_employment_ProvinceCode" class="employment_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_grid->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_grid->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_grid->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_grid->LACode->Visible) { // LACode ?>
	<?php if ($employment_grid->SortUrl($employment_grid->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $employment_grid->LACode->headerCellClass() ?>"><div id="elh_employment_LACode" class="employment_LACode"><div class="ew-table-header-caption"><?php echo $employment_grid->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $employment_grid->LACode->headerCellClass() ?>"><div><div id="elh_employment_LACode" class="employment_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_grid->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_grid->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_grid->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_grid->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($employment_grid->SortUrl($employment_grid->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $employment_grid->DepartmentCode->headerCellClass() ?>"><div id="elh_employment_DepartmentCode" class="employment_DepartmentCode"><div class="ew-table-header-caption"><?php echo $employment_grid->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $employment_grid->DepartmentCode->headerCellClass() ?>"><div><div id="elh_employment_DepartmentCode" class="employment_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_grid->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_grid->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_grid->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_grid->SectionCode->Visible) { // SectionCode ?>
	<?php if ($employment_grid->SortUrl($employment_grid->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $employment_grid->SectionCode->headerCellClass() ?>"><div id="elh_employment_SectionCode" class="employment_SectionCode"><div class="ew-table-header-caption"><?php echo $employment_grid->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $employment_grid->SectionCode->headerCellClass() ?>"><div><div id="elh_employment_SectionCode" class="employment_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_grid->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_grid->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_grid->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_grid->SubstantivePosition->Visible) { // SubstantivePosition ?>
	<?php if ($employment_grid->SortUrl($employment_grid->SubstantivePosition) == "") { ?>
		<th data-name="SubstantivePosition" class="<?php echo $employment_grid->SubstantivePosition->headerCellClass() ?>"><div id="elh_employment_SubstantivePosition" class="employment_SubstantivePosition"><div class="ew-table-header-caption"><?php echo $employment_grid->SubstantivePosition->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubstantivePosition" class="<?php echo $employment_grid->SubstantivePosition->headerCellClass() ?>"><div><div id="elh_employment_SubstantivePosition" class="employment_SubstantivePosition">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_grid->SubstantivePosition->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_grid->SubstantivePosition->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_grid->SubstantivePosition->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_grid->DateOfCurrentAppointment->Visible) { // DateOfCurrentAppointment ?>
	<?php if ($employment_grid->SortUrl($employment_grid->DateOfCurrentAppointment) == "") { ?>
		<th data-name="DateOfCurrentAppointment" class="<?php echo $employment_grid->DateOfCurrentAppointment->headerCellClass() ?>"><div id="elh_employment_DateOfCurrentAppointment" class="employment_DateOfCurrentAppointment"><div class="ew-table-header-caption"><?php echo $employment_grid->DateOfCurrentAppointment->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfCurrentAppointment" class="<?php echo $employment_grid->DateOfCurrentAppointment->headerCellClass() ?>"><div><div id="elh_employment_DateOfCurrentAppointment" class="employment_DateOfCurrentAppointment">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_grid->DateOfCurrentAppointment->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_grid->DateOfCurrentAppointment->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_grid->DateOfCurrentAppointment->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_grid->LastAppraisalDate->Visible) { // LastAppraisalDate ?>
	<?php if ($employment_grid->SortUrl($employment_grid->LastAppraisalDate) == "") { ?>
		<th data-name="LastAppraisalDate" class="<?php echo $employment_grid->LastAppraisalDate->headerCellClass() ?>"><div id="elh_employment_LastAppraisalDate" class="employment_LastAppraisalDate"><div class="ew-table-header-caption"><?php echo $employment_grid->LastAppraisalDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastAppraisalDate" class="<?php echo $employment_grid->LastAppraisalDate->headerCellClass() ?>"><div><div id="elh_employment_LastAppraisalDate" class="employment_LastAppraisalDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_grid->LastAppraisalDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_grid->LastAppraisalDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_grid->LastAppraisalDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_grid->AppraisalStatus->Visible) { // AppraisalStatus ?>
	<?php if ($employment_grid->SortUrl($employment_grid->AppraisalStatus) == "") { ?>
		<th data-name="AppraisalStatus" class="<?php echo $employment_grid->AppraisalStatus->headerCellClass() ?>"><div id="elh_employment_AppraisalStatus" class="employment_AppraisalStatus"><div class="ew-table-header-caption"><?php echo $employment_grid->AppraisalStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AppraisalStatus" class="<?php echo $employment_grid->AppraisalStatus->headerCellClass() ?>"><div><div id="elh_employment_AppraisalStatus" class="employment_AppraisalStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_grid->AppraisalStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_grid->AppraisalStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_grid->AppraisalStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_grid->DateOfExit->Visible) { // DateOfExit ?>
	<?php if ($employment_grid->SortUrl($employment_grid->DateOfExit) == "") { ?>
		<th data-name="DateOfExit" class="<?php echo $employment_grid->DateOfExit->headerCellClass() ?>"><div id="elh_employment_DateOfExit" class="employment_DateOfExit"><div class="ew-table-header-caption"><?php echo $employment_grid->DateOfExit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfExit" class="<?php echo $employment_grid->DateOfExit->headerCellClass() ?>"><div><div id="elh_employment_DateOfExit" class="employment_DateOfExit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_grid->DateOfExit->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_grid->DateOfExit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_grid->DateOfExit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_grid->EmploymentType->Visible) { // EmploymentType ?>
	<?php if ($employment_grid->SortUrl($employment_grid->EmploymentType) == "") { ?>
		<th data-name="EmploymentType" class="<?php echo $employment_grid->EmploymentType->headerCellClass() ?>"><div id="elh_employment_EmploymentType" class="employment_EmploymentType"><div class="ew-table-header-caption"><?php echo $employment_grid->EmploymentType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmploymentType" class="<?php echo $employment_grid->EmploymentType->headerCellClass() ?>"><div><div id="elh_employment_EmploymentType" class="employment_EmploymentType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_grid->EmploymentType->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_grid->EmploymentType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_grid->EmploymentType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_grid->EmploymentStatus->Visible) { // EmploymentStatus ?>
	<?php if ($employment_grid->SortUrl($employment_grid->EmploymentStatus) == "") { ?>
		<th data-name="EmploymentStatus" class="<?php echo $employment_grid->EmploymentStatus->headerCellClass() ?>"><div id="elh_employment_EmploymentStatus" class="employment_EmploymentStatus"><div class="ew-table-header-caption"><?php echo $employment_grid->EmploymentStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmploymentStatus" class="<?php echo $employment_grid->EmploymentStatus->headerCellClass() ?>"><div><div id="elh_employment_EmploymentStatus" class="employment_EmploymentStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_grid->EmploymentStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_grid->EmploymentStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_grid->EmploymentStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_grid->EmployeeNumber->Visible) { // EmployeeNumber ?>
	<?php if ($employment_grid->SortUrl($employment_grid->EmployeeNumber) == "") { ?>
		<th data-name="EmployeeNumber" class="<?php echo $employment_grid->EmployeeNumber->headerCellClass() ?>"><div id="elh_employment_EmployeeNumber" class="employment_EmployeeNumber"><div class="ew-table-header-caption"><?php echo $employment_grid->EmployeeNumber->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeNumber" class="<?php echo $employment_grid->EmployeeNumber->headerCellClass() ?>"><div><div id="elh_employment_EmployeeNumber" class="employment_EmployeeNumber">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_grid->EmployeeNumber->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_grid->EmployeeNumber->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_grid->EmployeeNumber->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_grid->SalaryNotch->Visible) { // SalaryNotch ?>
	<?php if ($employment_grid->SortUrl($employment_grid->SalaryNotch) == "") { ?>
		<th data-name="SalaryNotch" class="<?php echo $employment_grid->SalaryNotch->headerCellClass() ?>"><div id="elh_employment_SalaryNotch" class="employment_SalaryNotch"><div class="ew-table-header-caption"><?php echo $employment_grid->SalaryNotch->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SalaryNotch" class="<?php echo $employment_grid->SalaryNotch->headerCellClass() ?>"><div><div id="elh_employment_SalaryNotch" class="employment_SalaryNotch">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_grid->SalaryNotch->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_grid->SalaryNotch->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_grid->SalaryNotch->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_grid->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
	<?php if ($employment_grid->SortUrl($employment_grid->BasicMonthlySalary) == "") { ?>
		<th data-name="BasicMonthlySalary" class="<?php echo $employment_grid->BasicMonthlySalary->headerCellClass() ?>"><div id="elh_employment_BasicMonthlySalary" class="employment_BasicMonthlySalary"><div class="ew-table-header-caption"><?php echo $employment_grid->BasicMonthlySalary->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BasicMonthlySalary" class="<?php echo $employment_grid->BasicMonthlySalary->headerCellClass() ?>"><div><div id="elh_employment_BasicMonthlySalary" class="employment_BasicMonthlySalary">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_grid->BasicMonthlySalary->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_grid->BasicMonthlySalary->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_grid->BasicMonthlySalary->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_grid->ThirdParties->Visible) { // ThirdParties ?>
	<?php if ($employment_grid->SortUrl($employment_grid->ThirdParties) == "") { ?>
		<th data-name="ThirdParties" class="<?php echo $employment_grid->ThirdParties->headerCellClass() ?>"><div id="elh_employment_ThirdParties" class="employment_ThirdParties"><div class="ew-table-header-caption"><?php echo $employment_grid->ThirdParties->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ThirdParties" class="<?php echo $employment_grid->ThirdParties->headerCellClass() ?>"><div><div id="elh_employment_ThirdParties" class="employment_ThirdParties">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_grid->ThirdParties->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_grid->ThirdParties->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_grid->ThirdParties->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_grid->PayrollCode->Visible) { // PayrollCode ?>
	<?php if ($employment_grid->SortUrl($employment_grid->PayrollCode) == "") { ?>
		<th data-name="PayrollCode" class="<?php echo $employment_grid->PayrollCode->headerCellClass() ?>"><div id="elh_employment_PayrollCode" class="employment_PayrollCode"><div class="ew-table-header-caption"><?php echo $employment_grid->PayrollCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollCode" class="<?php echo $employment_grid->PayrollCode->headerCellClass() ?>"><div><div id="elh_employment_PayrollCode" class="employment_PayrollCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_grid->PayrollCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_grid->PayrollCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_grid->PayrollCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_grid->DateOfConfirmation->Visible) { // DateOfConfirmation ?>
	<?php if ($employment_grid->SortUrl($employment_grid->DateOfConfirmation) == "") { ?>
		<th data-name="DateOfConfirmation" class="<?php echo $employment_grid->DateOfConfirmation->headerCellClass() ?>"><div id="elh_employment_DateOfConfirmation" class="employment_DateOfConfirmation"><div class="ew-table-header-caption"><?php echo $employment_grid->DateOfConfirmation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfConfirmation" class="<?php echo $employment_grid->DateOfConfirmation->headerCellClass() ?>"><div><div id="elh_employment_DateOfConfirmation" class="employment_DateOfConfirmation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_grid->DateOfConfirmation->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_grid->DateOfConfirmation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_grid->DateOfConfirmation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$employment_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$employment_grid->StartRecord = 1;
$employment_grid->StopRecord = $employment_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($employment->isConfirm() || $employment_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($employment_grid->FormKeyCountName) && ($employment_grid->isGridAdd() || $employment_grid->isGridEdit() || $employment->isConfirm())) {
		$employment_grid->KeyCount = $CurrentForm->getValue($employment_grid->FormKeyCountName);
		$employment_grid->StopRecord = $employment_grid->StartRecord + $employment_grid->KeyCount - 1;
	}
}
$employment_grid->RecordCount = $employment_grid->StartRecord - 1;
if ($employment_grid->Recordset && !$employment_grid->Recordset->EOF) {
	$employment_grid->Recordset->moveFirst();
	$selectLimit = $employment_grid->UseSelectLimit;
	if (!$selectLimit && $employment_grid->StartRecord > 1)
		$employment_grid->Recordset->move($employment_grid->StartRecord - 1);
} elseif (!$employment->AllowAddDeleteRow && $employment_grid->StopRecord == 0) {
	$employment_grid->StopRecord = $employment->GridAddRowCount;
}

// Initialize aggregate
$employment->RowType = ROWTYPE_AGGREGATEINIT;
$employment->resetAttributes();
$employment_grid->renderRow();
if ($employment_grid->isGridAdd())
	$employment_grid->RowIndex = 0;
if ($employment_grid->isGridEdit())
	$employment_grid->RowIndex = 0;
while ($employment_grid->RecordCount < $employment_grid->StopRecord) {
	$employment_grid->RecordCount++;
	if ($employment_grid->RecordCount >= $employment_grid->StartRecord) {
		$employment_grid->RowCount++;
		if ($employment_grid->isGridAdd() || $employment_grid->isGridEdit() || $employment->isConfirm()) {
			$employment_grid->RowIndex++;
			$CurrentForm->Index = $employment_grid->RowIndex;
			if ($CurrentForm->hasValue($employment_grid->FormActionName) && ($employment->isConfirm() || $employment_grid->EventCancelled))
				$employment_grid->RowAction = strval($CurrentForm->getValue($employment_grid->FormActionName));
			elseif ($employment_grid->isGridAdd())
				$employment_grid->RowAction = "insert";
			else
				$employment_grid->RowAction = "";
		}

		// Set up key count
		$employment_grid->KeyCount = $employment_grid->RowIndex;

		// Init row class and style
		$employment->resetAttributes();
		$employment->CssClass = "";
		if ($employment_grid->isGridAdd()) {
			if ($employment->CurrentMode == "copy") {
				$employment_grid->loadRowValues($employment_grid->Recordset); // Load row values
				$employment_grid->setRecordKey($employment_grid->RowOldKey, $employment_grid->Recordset); // Set old record key
			} else {
				$employment_grid->loadRowValues(); // Load default values
				$employment_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$employment_grid->loadRowValues($employment_grid->Recordset); // Load row values
		}
		$employment->RowType = ROWTYPE_VIEW; // Render view
		if ($employment_grid->isGridAdd()) // Grid add
			$employment->RowType = ROWTYPE_ADD; // Render add
		if ($employment_grid->isGridAdd() && $employment->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$employment_grid->restoreCurrentRowFormValues($employment_grid->RowIndex); // Restore form values
		if ($employment_grid->isGridEdit()) { // Grid edit
			if ($employment->EventCancelled)
				$employment_grid->restoreCurrentRowFormValues($employment_grid->RowIndex); // Restore form values
			if ($employment_grid->RowAction == "insert")
				$employment->RowType = ROWTYPE_ADD; // Render add
			else
				$employment->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($employment_grid->isGridEdit() && ($employment->RowType == ROWTYPE_EDIT || $employment->RowType == ROWTYPE_ADD) && $employment->EventCancelled) // Update failed
			$employment_grid->restoreCurrentRowFormValues($employment_grid->RowIndex); // Restore form values
		if ($employment->RowType == ROWTYPE_EDIT) // Edit row
			$employment_grid->EditRowCount++;
		if ($employment->isConfirm()) // Confirm row
			$employment_grid->restoreCurrentRowFormValues($employment_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$employment->RowAttrs->merge(["data-rowindex" => $employment_grid->RowCount, "id" => "r" . $employment_grid->RowCount . "_employment", "data-rowtype" => $employment->RowType]);

		// Render row
		$employment_grid->renderRow();

		// Render list options
		$employment_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($employment_grid->RowAction != "delete" && $employment_grid->RowAction != "insertdelete" && !($employment_grid->RowAction == "insert" && $employment->isConfirm() && $employment_grid->emptyRow())) {
?>
	<tr <?php echo $employment->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employment_grid->ListOptions->render("body", "left", $employment_grid->RowCount);
?>
	<?php if ($employment_grid->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $employment_grid->ProvinceCode->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($employment_grid->ProvinceCode->getSessionValue() != "") { ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_ProvinceCode" class="form-group">
<span<?php echo $employment_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $employment_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($employment_grid->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_ProvinceCode" class="form-group">
<?php $employment_grid->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_ProvinceCode" data-value-separator="<?php echo $employment_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $employment_grid->RowIndex ?>_ProvinceCode"<?php echo $employment_grid->ProvinceCode->editAttributes() ?>>
			<?php echo $employment_grid->ProvinceCode->selectOptionListHtml("x{$employment_grid->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $employment_grid->ProvinceCode->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_ProvinceCode" name="o<?php echo $employment_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $employment_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($employment_grid->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($employment_grid->ProvinceCode->getSessionValue() != "") { ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_ProvinceCode" class="form-group">
<span<?php echo $employment_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $employment_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($employment_grid->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_ProvinceCode" class="form-group">
<?php $employment_grid->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_ProvinceCode" data-value-separator="<?php echo $employment_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $employment_grid->RowIndex ?>_ProvinceCode"<?php echo $employment_grid->ProvinceCode->editAttributes() ?>>
			<?php echo $employment_grid->ProvinceCode->selectOptionListHtml("x{$employment_grid->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $employment_grid->ProvinceCode->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_ProvinceCode">
<span<?php echo $employment_grid->ProvinceCode->viewAttributes() ?>><?php echo $employment_grid->ProvinceCode->getViewValue() ?></span>
</span>
<?php if (!$employment->isConfirm()) { ?>
<input type="hidden" data-table="employment" data-field="x_ProvinceCode" name="x<?php echo $employment_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $employment_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($employment_grid->ProvinceCode->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_ProvinceCode" name="o<?php echo $employment_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $employment_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($employment_grid->ProvinceCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employment" data-field="x_ProvinceCode" name="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_ProvinceCode" id="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($employment_grid->ProvinceCode->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_ProvinceCode" name="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_ProvinceCode" id="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($employment_grid->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="employment" data-field="x_EmployeeID" name="x<?php echo $employment_grid->RowIndex ?>_EmployeeID" id="x<?php echo $employment_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employment_grid->EmployeeID->CurrentValue) ?>">
<input type="hidden" data-table="employment" data-field="x_EmployeeID" name="o<?php echo $employment_grid->RowIndex ?>_EmployeeID" id="o<?php echo $employment_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employment_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT || $employment->CurrentMode == "edit") { ?>
<input type="hidden" data-table="employment" data-field="x_EmployeeID" name="x<?php echo $employment_grid->RowIndex ?>_EmployeeID" id="x<?php echo $employment_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employment_grid->EmployeeID->CurrentValue) ?>">
<?php } ?>
	<?php if ($employment_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $employment_grid->LACode->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($employment_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_LACode" class="form-group">
<span<?php echo $employment_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_grid->RowIndex ?>_LACode" name="x<?php echo $employment_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($employment_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_LACode" class="form-group">
<?php $employment_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_grid->RowIndex ?>_LACode"><?php echo EmptyValue(strval($employment_grid->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_grid->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_grid->LACode->ReadOnly || $employment_grid->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_grid->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_grid->LACode->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_LACode") ?>
<input type="hidden" data-table="employment" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_grid->RowIndex ?>_LACode" id="x<?php echo $employment_grid->RowIndex ?>_LACode" value="<?php echo $employment_grid->LACode->CurrentValue ?>"<?php echo $employment_grid->LACode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_LACode" name="o<?php echo $employment_grid->RowIndex ?>_LACode" id="o<?php echo $employment_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($employment_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($employment_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_LACode" class="form-group">
<span<?php echo $employment_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_grid->RowIndex ?>_LACode" name="x<?php echo $employment_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($employment_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_LACode" class="form-group">
<?php $employment_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_grid->RowIndex ?>_LACode"><?php echo EmptyValue(strval($employment_grid->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_grid->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_grid->LACode->ReadOnly || $employment_grid->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_grid->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_grid->LACode->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_LACode") ?>
<input type="hidden" data-table="employment" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_grid->RowIndex ?>_LACode" id="x<?php echo $employment_grid->RowIndex ?>_LACode" value="<?php echo $employment_grid->LACode->CurrentValue ?>"<?php echo $employment_grid->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_LACode">
<span<?php echo $employment_grid->LACode->viewAttributes() ?>><?php echo $employment_grid->LACode->getViewValue() ?></span>
</span>
<?php if (!$employment->isConfirm()) { ?>
<input type="hidden" data-table="employment" data-field="x_LACode" name="x<?php echo $employment_grid->RowIndex ?>_LACode" id="x<?php echo $employment_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($employment_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_LACode" name="o<?php echo $employment_grid->RowIndex ?>_LACode" id="o<?php echo $employment_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($employment_grid->LACode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employment" data-field="x_LACode" name="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_LACode" id="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($employment_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_LACode" name="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_LACode" id="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($employment_grid->LACode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $employment_grid->DepartmentCode->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($employment_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_DepartmentCode" class="form-group">
<span<?php echo $employment_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $employment_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($employment_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_DepartmentCode" class="form-group">
<?php $employment_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_grid->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($employment_grid->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_grid->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_grid->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_grid->DepartmentCode->ReadOnly || $employment_grid->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_grid->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_grid->DepartmentCode->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="employment" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $employment_grid->RowIndex ?>_DepartmentCode" value="<?php echo $employment_grid->DepartmentCode->CurrentValue ?>"<?php echo $employment_grid->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_DepartmentCode" name="o<?php echo $employment_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $employment_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($employment_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($employment_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_DepartmentCode" class="form-group">
<span<?php echo $employment_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $employment_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($employment_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_DepartmentCode" class="form-group">
<?php $employment_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_grid->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($employment_grid->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_grid->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_grid->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_grid->DepartmentCode->ReadOnly || $employment_grid->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_grid->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_grid->DepartmentCode->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="employment" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $employment_grid->RowIndex ?>_DepartmentCode" value="<?php echo $employment_grid->DepartmentCode->CurrentValue ?>"<?php echo $employment_grid->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_DepartmentCode">
<span<?php echo $employment_grid->DepartmentCode->viewAttributes() ?>><?php echo $employment_grid->DepartmentCode->getViewValue() ?></span>
</span>
<?php if (!$employment->isConfirm()) { ?>
<input type="hidden" data-table="employment" data-field="x_DepartmentCode" name="x<?php echo $employment_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $employment_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($employment_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_DepartmentCode" name="o<?php echo $employment_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $employment_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($employment_grid->DepartmentCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employment" data-field="x_DepartmentCode" name="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_DepartmentCode" id="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($employment_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_DepartmentCode" name="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_DepartmentCode" id="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($employment_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $employment_grid->SectionCode->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($employment_grid->SectionCode->getSessionValue() != "") { ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_SectionCode" class="form-group">
<span<?php echo $employment_grid->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_grid->RowIndex ?>_SectionCode" name="x<?php echo $employment_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($employment_grid->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_SectionCode" class="form-group">
<?php $employment_grid->SectionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_grid->RowIndex ?>_SectionCode"><?php echo EmptyValue(strval($employment_grid->SectionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_grid->SectionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_grid->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_grid->SectionCode->ReadOnly || $employment_grid->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_grid->RowIndex ?>_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_grid->SectionCode->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_SectionCode") ?>
<input type="hidden" data-table="employment" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_grid->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_grid->RowIndex ?>_SectionCode" id="x<?php echo $employment_grid->RowIndex ?>_SectionCode" value="<?php echo $employment_grid->SectionCode->CurrentValue ?>"<?php echo $employment_grid->SectionCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_SectionCode" name="o<?php echo $employment_grid->RowIndex ?>_SectionCode" id="o<?php echo $employment_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($employment_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($employment_grid->SectionCode->getSessionValue() != "") { ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_SectionCode" class="form-group">
<span<?php echo $employment_grid->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_grid->RowIndex ?>_SectionCode" name="x<?php echo $employment_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($employment_grid->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_SectionCode" class="form-group">
<?php $employment_grid->SectionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_grid->RowIndex ?>_SectionCode"><?php echo EmptyValue(strval($employment_grid->SectionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_grid->SectionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_grid->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_grid->SectionCode->ReadOnly || $employment_grid->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_grid->RowIndex ?>_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_grid->SectionCode->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_SectionCode") ?>
<input type="hidden" data-table="employment" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_grid->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_grid->RowIndex ?>_SectionCode" id="x<?php echo $employment_grid->RowIndex ?>_SectionCode" value="<?php echo $employment_grid->SectionCode->CurrentValue ?>"<?php echo $employment_grid->SectionCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_SectionCode">
<span<?php echo $employment_grid->SectionCode->viewAttributes() ?>><?php echo $employment_grid->SectionCode->getViewValue() ?></span>
</span>
<?php if (!$employment->isConfirm()) { ?>
<input type="hidden" data-table="employment" data-field="x_SectionCode" name="x<?php echo $employment_grid->RowIndex ?>_SectionCode" id="x<?php echo $employment_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($employment_grid->SectionCode->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_SectionCode" name="o<?php echo $employment_grid->RowIndex ?>_SectionCode" id="o<?php echo $employment_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($employment_grid->SectionCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employment" data-field="x_SectionCode" name="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_SectionCode" id="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($employment_grid->SectionCode->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_SectionCode" name="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_SectionCode" id="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($employment_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_grid->SubstantivePosition->Visible) { // SubstantivePosition ?>
		<td data-name="SubstantivePosition" <?php echo $employment_grid->SubstantivePosition->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($employment_grid->SubstantivePosition->getSessionValue() != "") { ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_SubstantivePosition" class="form-group">
<span<?php echo $employment_grid->SubstantivePosition->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->SubstantivePosition->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" name="x<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" value="<?php echo HtmlEncode($employment_grid->SubstantivePosition->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_SubstantivePosition" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_grid->RowIndex ?>_SubstantivePosition"><?php echo EmptyValue(strval($employment_grid->SubstantivePosition->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_grid->SubstantivePosition->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_grid->SubstantivePosition->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_grid->SubstantivePosition->ReadOnly || $employment_grid->SubstantivePosition->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_grid->RowIndex ?>_SubstantivePosition',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_grid->SubstantivePosition->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_SubstantivePosition") ?>
<input type="hidden" data-table="employment" data-field="x_SubstantivePosition" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_grid->SubstantivePosition->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" id="x<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" value="<?php echo $employment_grid->SubstantivePosition->CurrentValue ?>"<?php echo $employment_grid->SubstantivePosition->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_SubstantivePosition" name="o<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" id="o<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" value="<?php echo HtmlEncode($employment_grid->SubstantivePosition->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($employment_grid->SubstantivePosition->getSessionValue() != "") { ?>

<span id="el<?php echo $employment_grid->RowCount ?>_employment_SubstantivePosition" class="form-group">
<span<?php echo $employment_grid->SubstantivePosition->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->SubstantivePosition->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" name="x<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" value="<?php echo HtmlEncode($employment_grid->SubstantivePosition->CurrentValue) ?>">
<?php } else { ?>

<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_grid->RowIndex ?>_SubstantivePosition"><?php echo EmptyValue(strval($employment_grid->SubstantivePosition->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_grid->SubstantivePosition->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_grid->SubstantivePosition->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_grid->SubstantivePosition->ReadOnly || $employment_grid->SubstantivePosition->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_grid->RowIndex ?>_SubstantivePosition',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_grid->SubstantivePosition->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_SubstantivePosition") ?>
<input type="hidden" data-table="employment" data-field="x_SubstantivePosition" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_grid->SubstantivePosition->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" id="x<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" value="<?php echo $employment_grid->SubstantivePosition->CurrentValue ?>"<?php echo $employment_grid->SubstantivePosition->editAttributes() ?>>
<?php } ?>

<input type="hidden" data-table="employment" data-field="x_SubstantivePosition" name="o<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" id="o<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" value="<?php echo HtmlEncode($employment_grid->SubstantivePosition->OldValue != null ? $employment_grid->SubstantivePosition->OldValue : $employment_grid->SubstantivePosition->CurrentValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_SubstantivePosition">
<span<?php echo $employment_grid->SubstantivePosition->viewAttributes() ?>><?php echo $employment_grid->SubstantivePosition->getViewValue() ?></span>
</span>
<?php if (!$employment->isConfirm()) { ?>
<input type="hidden" data-table="employment" data-field="x_SubstantivePosition" name="x<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" id="x<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" value="<?php echo HtmlEncode($employment_grid->SubstantivePosition->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_SubstantivePosition" name="o<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" id="o<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" value="<?php echo HtmlEncode($employment_grid->SubstantivePosition->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employment" data-field="x_SubstantivePosition" name="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" id="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" value="<?php echo HtmlEncode($employment_grid->SubstantivePosition->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_SubstantivePosition" name="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" id="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" value="<?php echo HtmlEncode($employment_grid->SubstantivePosition->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_grid->DateOfCurrentAppointment->Visible) { // DateOfCurrentAppointment ?>
		<td data-name="DateOfCurrentAppointment" <?php echo $employment_grid->DateOfCurrentAppointment->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_DateOfCurrentAppointment" class="form-group">
<input type="text" data-table="employment" data-field="x_DateOfCurrentAppointment" name="x<?php echo $employment_grid->RowIndex ?>_DateOfCurrentAppointment" id="x<?php echo $employment_grid->RowIndex ?>_DateOfCurrentAppointment" placeholder="<?php echo HtmlEncode($employment_grid->DateOfCurrentAppointment->getPlaceHolder()) ?>" value="<?php echo $employment_grid->DateOfCurrentAppointment->EditValue ?>"<?php echo $employment_grid->DateOfCurrentAppointment->editAttributes() ?>>
<?php if (!$employment_grid->DateOfCurrentAppointment->ReadOnly && !$employment_grid->DateOfCurrentAppointment->Disabled && !isset($employment_grid->DateOfCurrentAppointment->EditAttrs["readonly"]) && !isset($employment_grid->DateOfCurrentAppointment->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentgrid", "x<?php echo $employment_grid->RowIndex ?>_DateOfCurrentAppointment", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employment" data-field="x_DateOfCurrentAppointment" name="o<?php echo $employment_grid->RowIndex ?>_DateOfCurrentAppointment" id="o<?php echo $employment_grid->RowIndex ?>_DateOfCurrentAppointment" value="<?php echo HtmlEncode($employment_grid->DateOfCurrentAppointment->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_DateOfCurrentAppointment" class="form-group">
<input type="text" data-table="employment" data-field="x_DateOfCurrentAppointment" name="x<?php echo $employment_grid->RowIndex ?>_DateOfCurrentAppointment" id="x<?php echo $employment_grid->RowIndex ?>_DateOfCurrentAppointment" placeholder="<?php echo HtmlEncode($employment_grid->DateOfCurrentAppointment->getPlaceHolder()) ?>" value="<?php echo $employment_grid->DateOfCurrentAppointment->EditValue ?>"<?php echo $employment_grid->DateOfCurrentAppointment->editAttributes() ?>>
<?php if (!$employment_grid->DateOfCurrentAppointment->ReadOnly && !$employment_grid->DateOfCurrentAppointment->Disabled && !isset($employment_grid->DateOfCurrentAppointment->EditAttrs["readonly"]) && !isset($employment_grid->DateOfCurrentAppointment->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentgrid", "x<?php echo $employment_grid->RowIndex ?>_DateOfCurrentAppointment", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_DateOfCurrentAppointment">
<span<?php echo $employment_grid->DateOfCurrentAppointment->viewAttributes() ?>><?php echo $employment_grid->DateOfCurrentAppointment->getViewValue() ?></span>
</span>
<?php if (!$employment->isConfirm()) { ?>
<input type="hidden" data-table="employment" data-field="x_DateOfCurrentAppointment" name="x<?php echo $employment_grid->RowIndex ?>_DateOfCurrentAppointment" id="x<?php echo $employment_grid->RowIndex ?>_DateOfCurrentAppointment" value="<?php echo HtmlEncode($employment_grid->DateOfCurrentAppointment->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_DateOfCurrentAppointment" name="o<?php echo $employment_grid->RowIndex ?>_DateOfCurrentAppointment" id="o<?php echo $employment_grid->RowIndex ?>_DateOfCurrentAppointment" value="<?php echo HtmlEncode($employment_grid->DateOfCurrentAppointment->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employment" data-field="x_DateOfCurrentAppointment" name="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_DateOfCurrentAppointment" id="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_DateOfCurrentAppointment" value="<?php echo HtmlEncode($employment_grid->DateOfCurrentAppointment->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_DateOfCurrentAppointment" name="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_DateOfCurrentAppointment" id="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_DateOfCurrentAppointment" value="<?php echo HtmlEncode($employment_grid->DateOfCurrentAppointment->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_grid->LastAppraisalDate->Visible) { // LastAppraisalDate ?>
		<td data-name="LastAppraisalDate" <?php echo $employment_grid->LastAppraisalDate->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_LastAppraisalDate" class="form-group">
<input type="text" data-table="employment" data-field="x_LastAppraisalDate" name="x<?php echo $employment_grid->RowIndex ?>_LastAppraisalDate" id="x<?php echo $employment_grid->RowIndex ?>_LastAppraisalDate" placeholder="<?php echo HtmlEncode($employment_grid->LastAppraisalDate->getPlaceHolder()) ?>" value="<?php echo $employment_grid->LastAppraisalDate->EditValue ?>"<?php echo $employment_grid->LastAppraisalDate->editAttributes() ?>>
<?php if (!$employment_grid->LastAppraisalDate->ReadOnly && !$employment_grid->LastAppraisalDate->Disabled && !isset($employment_grid->LastAppraisalDate->EditAttrs["readonly"]) && !isset($employment_grid->LastAppraisalDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentgrid", "x<?php echo $employment_grid->RowIndex ?>_LastAppraisalDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employment" data-field="x_LastAppraisalDate" name="o<?php echo $employment_grid->RowIndex ?>_LastAppraisalDate" id="o<?php echo $employment_grid->RowIndex ?>_LastAppraisalDate" value="<?php echo HtmlEncode($employment_grid->LastAppraisalDate->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_LastAppraisalDate" class="form-group">
<input type="text" data-table="employment" data-field="x_LastAppraisalDate" name="x<?php echo $employment_grid->RowIndex ?>_LastAppraisalDate" id="x<?php echo $employment_grid->RowIndex ?>_LastAppraisalDate" placeholder="<?php echo HtmlEncode($employment_grid->LastAppraisalDate->getPlaceHolder()) ?>" value="<?php echo $employment_grid->LastAppraisalDate->EditValue ?>"<?php echo $employment_grid->LastAppraisalDate->editAttributes() ?>>
<?php if (!$employment_grid->LastAppraisalDate->ReadOnly && !$employment_grid->LastAppraisalDate->Disabled && !isset($employment_grid->LastAppraisalDate->EditAttrs["readonly"]) && !isset($employment_grid->LastAppraisalDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentgrid", "x<?php echo $employment_grid->RowIndex ?>_LastAppraisalDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_LastAppraisalDate">
<span<?php echo $employment_grid->LastAppraisalDate->viewAttributes() ?>><?php echo $employment_grid->LastAppraisalDate->getViewValue() ?></span>
</span>
<?php if (!$employment->isConfirm()) { ?>
<input type="hidden" data-table="employment" data-field="x_LastAppraisalDate" name="x<?php echo $employment_grid->RowIndex ?>_LastAppraisalDate" id="x<?php echo $employment_grid->RowIndex ?>_LastAppraisalDate" value="<?php echo HtmlEncode($employment_grid->LastAppraisalDate->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_LastAppraisalDate" name="o<?php echo $employment_grid->RowIndex ?>_LastAppraisalDate" id="o<?php echo $employment_grid->RowIndex ?>_LastAppraisalDate" value="<?php echo HtmlEncode($employment_grid->LastAppraisalDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employment" data-field="x_LastAppraisalDate" name="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_LastAppraisalDate" id="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_LastAppraisalDate" value="<?php echo HtmlEncode($employment_grid->LastAppraisalDate->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_LastAppraisalDate" name="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_LastAppraisalDate" id="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_LastAppraisalDate" value="<?php echo HtmlEncode($employment_grid->LastAppraisalDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_grid->AppraisalStatus->Visible) { // AppraisalStatus ?>
		<td data-name="AppraisalStatus" <?php echo $employment_grid->AppraisalStatus->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_AppraisalStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_AppraisalStatus" data-value-separator="<?php echo $employment_grid->AppraisalStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_grid->RowIndex ?>_AppraisalStatus" name="x<?php echo $employment_grid->RowIndex ?>_AppraisalStatus"<?php echo $employment_grid->AppraisalStatus->editAttributes() ?>>
			<?php echo $employment_grid->AppraisalStatus->selectOptionListHtml("x{$employment_grid->RowIndex}_AppraisalStatus") ?>
		</select>
</div>
<?php echo $employment_grid->AppraisalStatus->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_AppraisalStatus") ?>
</span>
<input type="hidden" data-table="employment" data-field="x_AppraisalStatus" name="o<?php echo $employment_grid->RowIndex ?>_AppraisalStatus" id="o<?php echo $employment_grid->RowIndex ?>_AppraisalStatus" value="<?php echo HtmlEncode($employment_grid->AppraisalStatus->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_AppraisalStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_AppraisalStatus" data-value-separator="<?php echo $employment_grid->AppraisalStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_grid->RowIndex ?>_AppraisalStatus" name="x<?php echo $employment_grid->RowIndex ?>_AppraisalStatus"<?php echo $employment_grid->AppraisalStatus->editAttributes() ?>>
			<?php echo $employment_grid->AppraisalStatus->selectOptionListHtml("x{$employment_grid->RowIndex}_AppraisalStatus") ?>
		</select>
</div>
<?php echo $employment_grid->AppraisalStatus->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_AppraisalStatus") ?>
</span>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_AppraisalStatus">
<span<?php echo $employment_grid->AppraisalStatus->viewAttributes() ?>><?php echo $employment_grid->AppraisalStatus->getViewValue() ?></span>
</span>
<?php if (!$employment->isConfirm()) { ?>
<input type="hidden" data-table="employment" data-field="x_AppraisalStatus" name="x<?php echo $employment_grid->RowIndex ?>_AppraisalStatus" id="x<?php echo $employment_grid->RowIndex ?>_AppraisalStatus" value="<?php echo HtmlEncode($employment_grid->AppraisalStatus->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_AppraisalStatus" name="o<?php echo $employment_grid->RowIndex ?>_AppraisalStatus" id="o<?php echo $employment_grid->RowIndex ?>_AppraisalStatus" value="<?php echo HtmlEncode($employment_grid->AppraisalStatus->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employment" data-field="x_AppraisalStatus" name="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_AppraisalStatus" id="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_AppraisalStatus" value="<?php echo HtmlEncode($employment_grid->AppraisalStatus->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_AppraisalStatus" name="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_AppraisalStatus" id="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_AppraisalStatus" value="<?php echo HtmlEncode($employment_grid->AppraisalStatus->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_grid->DateOfExit->Visible) { // DateOfExit ?>
		<td data-name="DateOfExit" <?php echo $employment_grid->DateOfExit->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_DateOfExit" class="form-group">
<input type="text" data-table="employment" data-field="x_DateOfExit" name="x<?php echo $employment_grid->RowIndex ?>_DateOfExit" id="x<?php echo $employment_grid->RowIndex ?>_DateOfExit" placeholder="<?php echo HtmlEncode($employment_grid->DateOfExit->getPlaceHolder()) ?>" value="<?php echo $employment_grid->DateOfExit->EditValue ?>"<?php echo $employment_grid->DateOfExit->editAttributes() ?>>
<?php if (!$employment_grid->DateOfExit->ReadOnly && !$employment_grid->DateOfExit->Disabled && !isset($employment_grid->DateOfExit->EditAttrs["readonly"]) && !isset($employment_grid->DateOfExit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentgrid", "x<?php echo $employment_grid->RowIndex ?>_DateOfExit", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employment" data-field="x_DateOfExit" name="o<?php echo $employment_grid->RowIndex ?>_DateOfExit" id="o<?php echo $employment_grid->RowIndex ?>_DateOfExit" value="<?php echo HtmlEncode($employment_grid->DateOfExit->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_DateOfExit" class="form-group">
<input type="text" data-table="employment" data-field="x_DateOfExit" name="x<?php echo $employment_grid->RowIndex ?>_DateOfExit" id="x<?php echo $employment_grid->RowIndex ?>_DateOfExit" placeholder="<?php echo HtmlEncode($employment_grid->DateOfExit->getPlaceHolder()) ?>" value="<?php echo $employment_grid->DateOfExit->EditValue ?>"<?php echo $employment_grid->DateOfExit->editAttributes() ?>>
<?php if (!$employment_grid->DateOfExit->ReadOnly && !$employment_grid->DateOfExit->Disabled && !isset($employment_grid->DateOfExit->EditAttrs["readonly"]) && !isset($employment_grid->DateOfExit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentgrid", "x<?php echo $employment_grid->RowIndex ?>_DateOfExit", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_DateOfExit">
<span<?php echo $employment_grid->DateOfExit->viewAttributes() ?>><?php echo $employment_grid->DateOfExit->getViewValue() ?></span>
</span>
<?php if (!$employment->isConfirm()) { ?>
<input type="hidden" data-table="employment" data-field="x_DateOfExit" name="x<?php echo $employment_grid->RowIndex ?>_DateOfExit" id="x<?php echo $employment_grid->RowIndex ?>_DateOfExit" value="<?php echo HtmlEncode($employment_grid->DateOfExit->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_DateOfExit" name="o<?php echo $employment_grid->RowIndex ?>_DateOfExit" id="o<?php echo $employment_grid->RowIndex ?>_DateOfExit" value="<?php echo HtmlEncode($employment_grid->DateOfExit->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employment" data-field="x_DateOfExit" name="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_DateOfExit" id="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_DateOfExit" value="<?php echo HtmlEncode($employment_grid->DateOfExit->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_DateOfExit" name="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_DateOfExit" id="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_DateOfExit" value="<?php echo HtmlEncode($employment_grid->DateOfExit->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_grid->EmploymentType->Visible) { // EmploymentType ?>
		<td data-name="EmploymentType" <?php echo $employment_grid->EmploymentType->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_EmploymentType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_EmploymentType" data-value-separator="<?php echo $employment_grid->EmploymentType->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_grid->RowIndex ?>_EmploymentType" name="x<?php echo $employment_grid->RowIndex ?>_EmploymentType"<?php echo $employment_grid->EmploymentType->editAttributes() ?>>
			<?php echo $employment_grid->EmploymentType->selectOptionListHtml("x{$employment_grid->RowIndex}_EmploymentType") ?>
		</select>
</div>
<?php echo $employment_grid->EmploymentType->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_EmploymentType") ?>
</span>
<input type="hidden" data-table="employment" data-field="x_EmploymentType" name="o<?php echo $employment_grid->RowIndex ?>_EmploymentType" id="o<?php echo $employment_grid->RowIndex ?>_EmploymentType" value="<?php echo HtmlEncode($employment_grid->EmploymentType->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_EmploymentType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_EmploymentType" data-value-separator="<?php echo $employment_grid->EmploymentType->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_grid->RowIndex ?>_EmploymentType" name="x<?php echo $employment_grid->RowIndex ?>_EmploymentType"<?php echo $employment_grid->EmploymentType->editAttributes() ?>>
			<?php echo $employment_grid->EmploymentType->selectOptionListHtml("x{$employment_grid->RowIndex}_EmploymentType") ?>
		</select>
</div>
<?php echo $employment_grid->EmploymentType->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_EmploymentType") ?>
</span>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_EmploymentType">
<span<?php echo $employment_grid->EmploymentType->viewAttributes() ?>><?php echo $employment_grid->EmploymentType->getViewValue() ?></span>
</span>
<?php if (!$employment->isConfirm()) { ?>
<input type="hidden" data-table="employment" data-field="x_EmploymentType" name="x<?php echo $employment_grid->RowIndex ?>_EmploymentType" id="x<?php echo $employment_grid->RowIndex ?>_EmploymentType" value="<?php echo HtmlEncode($employment_grid->EmploymentType->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_EmploymentType" name="o<?php echo $employment_grid->RowIndex ?>_EmploymentType" id="o<?php echo $employment_grid->RowIndex ?>_EmploymentType" value="<?php echo HtmlEncode($employment_grid->EmploymentType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employment" data-field="x_EmploymentType" name="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_EmploymentType" id="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_EmploymentType" value="<?php echo HtmlEncode($employment_grid->EmploymentType->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_EmploymentType" name="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_EmploymentType" id="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_EmploymentType" value="<?php echo HtmlEncode($employment_grid->EmploymentType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_grid->EmploymentStatus->Visible) { // EmploymentStatus ?>
		<td data-name="EmploymentStatus" <?php echo $employment_grid->EmploymentStatus->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_EmploymentStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_EmploymentStatus" data-value-separator="<?php echo $employment_grid->EmploymentStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_grid->RowIndex ?>_EmploymentStatus" name="x<?php echo $employment_grid->RowIndex ?>_EmploymentStatus"<?php echo $employment_grid->EmploymentStatus->editAttributes() ?>>
			<?php echo $employment_grid->EmploymentStatus->selectOptionListHtml("x{$employment_grid->RowIndex}_EmploymentStatus") ?>
		</select>
</div>
<?php echo $employment_grid->EmploymentStatus->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_EmploymentStatus") ?>
</span>
<input type="hidden" data-table="employment" data-field="x_EmploymentStatus" name="o<?php echo $employment_grid->RowIndex ?>_EmploymentStatus" id="o<?php echo $employment_grid->RowIndex ?>_EmploymentStatus" value="<?php echo HtmlEncode($employment_grid->EmploymentStatus->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_EmploymentStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_EmploymentStatus" data-value-separator="<?php echo $employment_grid->EmploymentStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_grid->RowIndex ?>_EmploymentStatus" name="x<?php echo $employment_grid->RowIndex ?>_EmploymentStatus"<?php echo $employment_grid->EmploymentStatus->editAttributes() ?>>
			<?php echo $employment_grid->EmploymentStatus->selectOptionListHtml("x{$employment_grid->RowIndex}_EmploymentStatus") ?>
		</select>
</div>
<?php echo $employment_grid->EmploymentStatus->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_EmploymentStatus") ?>
</span>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_EmploymentStatus">
<span<?php echo $employment_grid->EmploymentStatus->viewAttributes() ?>><?php echo $employment_grid->EmploymentStatus->getViewValue() ?></span>
</span>
<?php if (!$employment->isConfirm()) { ?>
<input type="hidden" data-table="employment" data-field="x_EmploymentStatus" name="x<?php echo $employment_grid->RowIndex ?>_EmploymentStatus" id="x<?php echo $employment_grid->RowIndex ?>_EmploymentStatus" value="<?php echo HtmlEncode($employment_grid->EmploymentStatus->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_EmploymentStatus" name="o<?php echo $employment_grid->RowIndex ?>_EmploymentStatus" id="o<?php echo $employment_grid->RowIndex ?>_EmploymentStatus" value="<?php echo HtmlEncode($employment_grid->EmploymentStatus->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employment" data-field="x_EmploymentStatus" name="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_EmploymentStatus" id="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_EmploymentStatus" value="<?php echo HtmlEncode($employment_grid->EmploymentStatus->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_EmploymentStatus" name="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_EmploymentStatus" id="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_EmploymentStatus" value="<?php echo HtmlEncode($employment_grid->EmploymentStatus->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_grid->EmployeeNumber->Visible) { // EmployeeNumber ?>
		<td data-name="EmployeeNumber" <?php echo $employment_grid->EmployeeNumber->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_EmployeeNumber" class="form-group">
<input type="text" data-table="employment" data-field="x_EmployeeNumber" name="x<?php echo $employment_grid->RowIndex ?>_EmployeeNumber" id="x<?php echo $employment_grid->RowIndex ?>_EmployeeNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($employment_grid->EmployeeNumber->getPlaceHolder()) ?>" value="<?php echo $employment_grid->EmployeeNumber->EditValue ?>"<?php echo $employment_grid->EmployeeNumber->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment" data-field="x_EmployeeNumber" name="o<?php echo $employment_grid->RowIndex ?>_EmployeeNumber" id="o<?php echo $employment_grid->RowIndex ?>_EmployeeNumber" value="<?php echo HtmlEncode($employment_grid->EmployeeNumber->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_EmployeeNumber" class="form-group">
<input type="text" data-table="employment" data-field="x_EmployeeNumber" name="x<?php echo $employment_grid->RowIndex ?>_EmployeeNumber" id="x<?php echo $employment_grid->RowIndex ?>_EmployeeNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($employment_grid->EmployeeNumber->getPlaceHolder()) ?>" value="<?php echo $employment_grid->EmployeeNumber->EditValue ?>"<?php echo $employment_grid->EmployeeNumber->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_EmployeeNumber">
<span<?php echo $employment_grid->EmployeeNumber->viewAttributes() ?>><?php echo $employment_grid->EmployeeNumber->getViewValue() ?></span>
</span>
<?php if (!$employment->isConfirm()) { ?>
<input type="hidden" data-table="employment" data-field="x_EmployeeNumber" name="x<?php echo $employment_grid->RowIndex ?>_EmployeeNumber" id="x<?php echo $employment_grid->RowIndex ?>_EmployeeNumber" value="<?php echo HtmlEncode($employment_grid->EmployeeNumber->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_EmployeeNumber" name="o<?php echo $employment_grid->RowIndex ?>_EmployeeNumber" id="o<?php echo $employment_grid->RowIndex ?>_EmployeeNumber" value="<?php echo HtmlEncode($employment_grid->EmployeeNumber->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employment" data-field="x_EmployeeNumber" name="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_EmployeeNumber" id="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_EmployeeNumber" value="<?php echo HtmlEncode($employment_grid->EmployeeNumber->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_EmployeeNumber" name="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_EmployeeNumber" id="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_EmployeeNumber" value="<?php echo HtmlEncode($employment_grid->EmployeeNumber->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_grid->SalaryNotch->Visible) { // SalaryNotch ?>
		<td data-name="SalaryNotch" <?php echo $employment_grid->SalaryNotch->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_SalaryNotch" class="form-group">
<?php $employment_grid->SalaryNotch->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_grid->RowIndex ?>_SalaryNotch"><?php echo EmptyValue(strval($employment_grid->SalaryNotch->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_grid->SalaryNotch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_grid->SalaryNotch->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_grid->SalaryNotch->ReadOnly || $employment_grid->SalaryNotch->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_grid->RowIndex ?>_SalaryNotch',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_grid->SalaryNotch->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_SalaryNotch") ?>
<input type="hidden" data-table="employment" data-field="x_SalaryNotch" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_grid->SalaryNotch->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_grid->RowIndex ?>_SalaryNotch" id="x<?php echo $employment_grid->RowIndex ?>_SalaryNotch" value="<?php echo $employment_grid->SalaryNotch->CurrentValue ?>"<?php echo $employment_grid->SalaryNotch->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment" data-field="x_SalaryNotch" name="o<?php echo $employment_grid->RowIndex ?>_SalaryNotch" id="o<?php echo $employment_grid->RowIndex ?>_SalaryNotch" value="<?php echo HtmlEncode($employment_grid->SalaryNotch->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_SalaryNotch" class="form-group">
<?php $employment_grid->SalaryNotch->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_grid->RowIndex ?>_SalaryNotch"><?php echo EmptyValue(strval($employment_grid->SalaryNotch->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_grid->SalaryNotch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_grid->SalaryNotch->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_grid->SalaryNotch->ReadOnly || $employment_grid->SalaryNotch->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_grid->RowIndex ?>_SalaryNotch',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_grid->SalaryNotch->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_SalaryNotch") ?>
<input type="hidden" data-table="employment" data-field="x_SalaryNotch" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_grid->SalaryNotch->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_grid->RowIndex ?>_SalaryNotch" id="x<?php echo $employment_grid->RowIndex ?>_SalaryNotch" value="<?php echo $employment_grid->SalaryNotch->CurrentValue ?>"<?php echo $employment_grid->SalaryNotch->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_SalaryNotch">
<span<?php echo $employment_grid->SalaryNotch->viewAttributes() ?>><?php echo $employment_grid->SalaryNotch->getViewValue() ?></span>
</span>
<?php if (!$employment->isConfirm()) { ?>
<input type="hidden" data-table="employment" data-field="x_SalaryNotch" name="x<?php echo $employment_grid->RowIndex ?>_SalaryNotch" id="x<?php echo $employment_grid->RowIndex ?>_SalaryNotch" value="<?php echo HtmlEncode($employment_grid->SalaryNotch->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_SalaryNotch" name="o<?php echo $employment_grid->RowIndex ?>_SalaryNotch" id="o<?php echo $employment_grid->RowIndex ?>_SalaryNotch" value="<?php echo HtmlEncode($employment_grid->SalaryNotch->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employment" data-field="x_SalaryNotch" name="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_SalaryNotch" id="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_SalaryNotch" value="<?php echo HtmlEncode($employment_grid->SalaryNotch->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_SalaryNotch" name="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_SalaryNotch" id="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_SalaryNotch" value="<?php echo HtmlEncode($employment_grid->SalaryNotch->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_grid->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
		<td data-name="BasicMonthlySalary" <?php echo $employment_grid->BasicMonthlySalary->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_BasicMonthlySalary" class="form-group">
<input type="text" data-table="employment" data-field="x_BasicMonthlySalary" name="x<?php echo $employment_grid->RowIndex ?>_BasicMonthlySalary" id="x<?php echo $employment_grid->RowIndex ?>_BasicMonthlySalary" size="30" placeholder="<?php echo HtmlEncode($employment_grid->BasicMonthlySalary->getPlaceHolder()) ?>" value="<?php echo $employment_grid->BasicMonthlySalary->EditValue ?>"<?php echo $employment_grid->BasicMonthlySalary->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment" data-field="x_BasicMonthlySalary" name="o<?php echo $employment_grid->RowIndex ?>_BasicMonthlySalary" id="o<?php echo $employment_grid->RowIndex ?>_BasicMonthlySalary" value="<?php echo HtmlEncode($employment_grid->BasicMonthlySalary->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_BasicMonthlySalary" class="form-group">
<input type="text" data-table="employment" data-field="x_BasicMonthlySalary" name="x<?php echo $employment_grid->RowIndex ?>_BasicMonthlySalary" id="x<?php echo $employment_grid->RowIndex ?>_BasicMonthlySalary" size="30" placeholder="<?php echo HtmlEncode($employment_grid->BasicMonthlySalary->getPlaceHolder()) ?>" value="<?php echo $employment_grid->BasicMonthlySalary->EditValue ?>"<?php echo $employment_grid->BasicMonthlySalary->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_BasicMonthlySalary">
<span<?php echo $employment_grid->BasicMonthlySalary->viewAttributes() ?>><?php echo $employment_grid->BasicMonthlySalary->getViewValue() ?></span>
</span>
<?php if (!$employment->isConfirm()) { ?>
<input type="hidden" data-table="employment" data-field="x_BasicMonthlySalary" name="x<?php echo $employment_grid->RowIndex ?>_BasicMonthlySalary" id="x<?php echo $employment_grid->RowIndex ?>_BasicMonthlySalary" value="<?php echo HtmlEncode($employment_grid->BasicMonthlySalary->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_BasicMonthlySalary" name="o<?php echo $employment_grid->RowIndex ?>_BasicMonthlySalary" id="o<?php echo $employment_grid->RowIndex ?>_BasicMonthlySalary" value="<?php echo HtmlEncode($employment_grid->BasicMonthlySalary->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employment" data-field="x_BasicMonthlySalary" name="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_BasicMonthlySalary" id="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_BasicMonthlySalary" value="<?php echo HtmlEncode($employment_grid->BasicMonthlySalary->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_BasicMonthlySalary" name="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_BasicMonthlySalary" id="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_BasicMonthlySalary" value="<?php echo HtmlEncode($employment_grid->BasicMonthlySalary->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_grid->ThirdParties->Visible) { // ThirdParties ?>
		<td data-name="ThirdParties" <?php echo $employment_grid->ThirdParties->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_ThirdParties" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_grid->RowIndex ?>_ThirdParties"><?php echo EmptyValue(strval($employment_grid->ThirdParties->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_grid->ThirdParties->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_grid->ThirdParties->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_grid->ThirdParties->ReadOnly || $employment_grid->ThirdParties->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_grid->RowIndex ?>_ThirdParties[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_grid->ThirdParties->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_ThirdParties") ?>
<input type="hidden" data-table="employment" data-field="x_ThirdParties" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $employment_grid->ThirdParties->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_grid->RowIndex ?>_ThirdParties[]" id="x<?php echo $employment_grid->RowIndex ?>_ThirdParties[]" value="<?php echo $employment_grid->ThirdParties->CurrentValue ?>"<?php echo $employment_grid->ThirdParties->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment" data-field="x_ThirdParties" name="o<?php echo $employment_grid->RowIndex ?>_ThirdParties[]" id="o<?php echo $employment_grid->RowIndex ?>_ThirdParties[]" value="<?php echo HtmlEncode($employment_grid->ThirdParties->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_ThirdParties" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_grid->RowIndex ?>_ThirdParties"><?php echo EmptyValue(strval($employment_grid->ThirdParties->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_grid->ThirdParties->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_grid->ThirdParties->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_grid->ThirdParties->ReadOnly || $employment_grid->ThirdParties->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_grid->RowIndex ?>_ThirdParties[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_grid->ThirdParties->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_ThirdParties") ?>
<input type="hidden" data-table="employment" data-field="x_ThirdParties" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $employment_grid->ThirdParties->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_grid->RowIndex ?>_ThirdParties[]" id="x<?php echo $employment_grid->RowIndex ?>_ThirdParties[]" value="<?php echo $employment_grid->ThirdParties->CurrentValue ?>"<?php echo $employment_grid->ThirdParties->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_ThirdParties">
<span<?php echo $employment_grid->ThirdParties->viewAttributes() ?>><?php echo $employment_grid->ThirdParties->getViewValue() ?></span>
</span>
<?php if (!$employment->isConfirm()) { ?>
<input type="hidden" data-table="employment" data-field="x_ThirdParties" name="x<?php echo $employment_grid->RowIndex ?>_ThirdParties" id="x<?php echo $employment_grid->RowIndex ?>_ThirdParties" value="<?php echo HtmlEncode($employment_grid->ThirdParties->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_ThirdParties" name="o<?php echo $employment_grid->RowIndex ?>_ThirdParties[]" id="o<?php echo $employment_grid->RowIndex ?>_ThirdParties[]" value="<?php echo HtmlEncode($employment_grid->ThirdParties->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employment" data-field="x_ThirdParties" name="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_ThirdParties" id="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_ThirdParties" value="<?php echo HtmlEncode($employment_grid->ThirdParties->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_ThirdParties" name="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_ThirdParties[]" id="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_ThirdParties[]" value="<?php echo HtmlEncode($employment_grid->ThirdParties->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_grid->PayrollCode->Visible) { // PayrollCode ?>
		<td data-name="PayrollCode" <?php echo $employment_grid->PayrollCode->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_PayrollCode" class="form-group">
<input type="text" data-table="employment" data-field="x_PayrollCode" name="x<?php echo $employment_grid->RowIndex ?>_PayrollCode" id="x<?php echo $employment_grid->RowIndex ?>_PayrollCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($employment_grid->PayrollCode->getPlaceHolder()) ?>" value="<?php echo $employment_grid->PayrollCode->EditValue ?>"<?php echo $employment_grid->PayrollCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment" data-field="x_PayrollCode" name="o<?php echo $employment_grid->RowIndex ?>_PayrollCode" id="o<?php echo $employment_grid->RowIndex ?>_PayrollCode" value="<?php echo HtmlEncode($employment_grid->PayrollCode->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_PayrollCode" class="form-group">
<input type="text" data-table="employment" data-field="x_PayrollCode" name="x<?php echo $employment_grid->RowIndex ?>_PayrollCode" id="x<?php echo $employment_grid->RowIndex ?>_PayrollCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($employment_grid->PayrollCode->getPlaceHolder()) ?>" value="<?php echo $employment_grid->PayrollCode->EditValue ?>"<?php echo $employment_grid->PayrollCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_PayrollCode">
<span<?php echo $employment_grid->PayrollCode->viewAttributes() ?>><?php echo $employment_grid->PayrollCode->getViewValue() ?></span>
</span>
<?php if (!$employment->isConfirm()) { ?>
<input type="hidden" data-table="employment" data-field="x_PayrollCode" name="x<?php echo $employment_grid->RowIndex ?>_PayrollCode" id="x<?php echo $employment_grid->RowIndex ?>_PayrollCode" value="<?php echo HtmlEncode($employment_grid->PayrollCode->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_PayrollCode" name="o<?php echo $employment_grid->RowIndex ?>_PayrollCode" id="o<?php echo $employment_grid->RowIndex ?>_PayrollCode" value="<?php echo HtmlEncode($employment_grid->PayrollCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employment" data-field="x_PayrollCode" name="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_PayrollCode" id="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_PayrollCode" value="<?php echo HtmlEncode($employment_grid->PayrollCode->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_PayrollCode" name="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_PayrollCode" id="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_PayrollCode" value="<?php echo HtmlEncode($employment_grid->PayrollCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_grid->DateOfConfirmation->Visible) { // DateOfConfirmation ?>
		<td data-name="DateOfConfirmation" <?php echo $employment_grid->DateOfConfirmation->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_DateOfConfirmation" class="form-group">
<input type="text" data-table="employment" data-field="x_DateOfConfirmation" name="x<?php echo $employment_grid->RowIndex ?>_DateOfConfirmation" id="x<?php echo $employment_grid->RowIndex ?>_DateOfConfirmation" maxlength="10" placeholder="<?php echo HtmlEncode($employment_grid->DateOfConfirmation->getPlaceHolder()) ?>" value="<?php echo $employment_grid->DateOfConfirmation->EditValue ?>"<?php echo $employment_grid->DateOfConfirmation->editAttributes() ?>>
<?php if (!$employment_grid->DateOfConfirmation->ReadOnly && !$employment_grid->DateOfConfirmation->Disabled && !isset($employment_grid->DateOfConfirmation->EditAttrs["readonly"]) && !isset($employment_grid->DateOfConfirmation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentgrid", "x<?php echo $employment_grid->RowIndex ?>_DateOfConfirmation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employment" data-field="x_DateOfConfirmation" name="o<?php echo $employment_grid->RowIndex ?>_DateOfConfirmation" id="o<?php echo $employment_grid->RowIndex ?>_DateOfConfirmation" value="<?php echo HtmlEncode($employment_grid->DateOfConfirmation->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_DateOfConfirmation" class="form-group">
<input type="text" data-table="employment" data-field="x_DateOfConfirmation" name="x<?php echo $employment_grid->RowIndex ?>_DateOfConfirmation" id="x<?php echo $employment_grid->RowIndex ?>_DateOfConfirmation" maxlength="10" placeholder="<?php echo HtmlEncode($employment_grid->DateOfConfirmation->getPlaceHolder()) ?>" value="<?php echo $employment_grid->DateOfConfirmation->EditValue ?>"<?php echo $employment_grid->DateOfConfirmation->editAttributes() ?>>
<?php if (!$employment_grid->DateOfConfirmation->ReadOnly && !$employment_grid->DateOfConfirmation->Disabled && !isset($employment_grid->DateOfConfirmation->EditAttrs["readonly"]) && !isset($employment_grid->DateOfConfirmation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentgrid", "x<?php echo $employment_grid->RowIndex ?>_DateOfConfirmation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_grid->RowCount ?>_employment_DateOfConfirmation">
<span<?php echo $employment_grid->DateOfConfirmation->viewAttributes() ?>><?php echo $employment_grid->DateOfConfirmation->getViewValue() ?></span>
</span>
<?php if (!$employment->isConfirm()) { ?>
<input type="hidden" data-table="employment" data-field="x_DateOfConfirmation" name="x<?php echo $employment_grid->RowIndex ?>_DateOfConfirmation" id="x<?php echo $employment_grid->RowIndex ?>_DateOfConfirmation" value="<?php echo HtmlEncode($employment_grid->DateOfConfirmation->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_DateOfConfirmation" name="o<?php echo $employment_grid->RowIndex ?>_DateOfConfirmation" id="o<?php echo $employment_grid->RowIndex ?>_DateOfConfirmation" value="<?php echo HtmlEncode($employment_grid->DateOfConfirmation->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="employment" data-field="x_DateOfConfirmation" name="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_DateOfConfirmation" id="femploymentgrid$x<?php echo $employment_grid->RowIndex ?>_DateOfConfirmation" value="<?php echo HtmlEncode($employment_grid->DateOfConfirmation->FormValue) ?>">
<input type="hidden" data-table="employment" data-field="x_DateOfConfirmation" name="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_DateOfConfirmation" id="femploymentgrid$o<?php echo $employment_grid->RowIndex ?>_DateOfConfirmation" value="<?php echo HtmlEncode($employment_grid->DateOfConfirmation->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employment_grid->ListOptions->render("body", "right", $employment_grid->RowCount);
?>
	</tr>
<?php if ($employment->RowType == ROWTYPE_ADD || $employment->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["femploymentgrid", "load"], function() {
	femploymentgrid.updateLists(<?php echo $employment_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$employment_grid->isGridAdd() || $employment->CurrentMode == "copy")
		if (!$employment_grid->Recordset->EOF)
			$employment_grid->Recordset->moveNext();
}
?>
<?php
	if ($employment->CurrentMode == "add" || $employment->CurrentMode == "copy" || $employment->CurrentMode == "edit") {
		$employment_grid->RowIndex = '$rowindex$';
		$employment_grid->loadRowValues();

		// Set row properties
		$employment->resetAttributes();
		$employment->RowAttrs->merge(["data-rowindex" => $employment_grid->RowIndex, "id" => "r0_employment", "data-rowtype" => ROWTYPE_ADD]);
		$employment->RowAttrs->appendClass("ew-template");
		$employment->RowType = ROWTYPE_ADD;

		// Render row
		$employment_grid->renderRow();

		// Render list options
		$employment_grid->renderListOptions();
		$employment_grid->StartRowCount = 0;
?>
	<tr <?php echo $employment->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employment_grid->ListOptions->render("body", "left", $employment_grid->RowIndex);
?>
	<?php if ($employment_grid->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode">
<?php if (!$employment->isConfirm()) { ?>
<?php if ($employment_grid->ProvinceCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_employment_ProvinceCode" class="form-group employment_ProvinceCode">
<span<?php echo $employment_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $employment_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($employment_grid->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_employment_ProvinceCode" class="form-group employment_ProvinceCode">
<?php $employment_grid->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_ProvinceCode" data-value-separator="<?php echo $employment_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $employment_grid->RowIndex ?>_ProvinceCode"<?php echo $employment_grid->ProvinceCode->editAttributes() ?>>
			<?php echo $employment_grid->ProvinceCode->selectOptionListHtml("x{$employment_grid->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $employment_grid->ProvinceCode->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_employment_ProvinceCode" class="form-group employment_ProvinceCode">
<span<?php echo $employment_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employment" data-field="x_ProvinceCode" name="x<?php echo $employment_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $employment_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($employment_grid->ProvinceCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_ProvinceCode" name="o<?php echo $employment_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $employment_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($employment_grid->ProvinceCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if (!$employment->isConfirm()) { ?>
<?php if ($employment_grid->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_employment_LACode" class="form-group employment_LACode">
<span<?php echo $employment_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_grid->RowIndex ?>_LACode" name="x<?php echo $employment_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($employment_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_employment_LACode" class="form-group employment_LACode">
<?php $employment_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_grid->RowIndex ?>_LACode"><?php echo EmptyValue(strval($employment_grid->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_grid->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_grid->LACode->ReadOnly || $employment_grid->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_grid->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_grid->LACode->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_LACode") ?>
<input type="hidden" data-table="employment" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_grid->RowIndex ?>_LACode" id="x<?php echo $employment_grid->RowIndex ?>_LACode" value="<?php echo $employment_grid->LACode->CurrentValue ?>"<?php echo $employment_grid->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_employment_LACode" class="form-group employment_LACode">
<span<?php echo $employment_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employment" data-field="x_LACode" name="x<?php echo $employment_grid->RowIndex ?>_LACode" id="x<?php echo $employment_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($employment_grid->LACode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_LACode" name="o<?php echo $employment_grid->RowIndex ?>_LACode" id="o<?php echo $employment_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($employment_grid->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<?php if (!$employment->isConfirm()) { ?>
<?php if ($employment_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_employment_DepartmentCode" class="form-group employment_DepartmentCode">
<span<?php echo $employment_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $employment_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($employment_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_employment_DepartmentCode" class="form-group employment_DepartmentCode">
<?php $employment_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_grid->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($employment_grid->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_grid->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_grid->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_grid->DepartmentCode->ReadOnly || $employment_grid->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_grid->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_grid->DepartmentCode->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="employment" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $employment_grid->RowIndex ?>_DepartmentCode" value="<?php echo $employment_grid->DepartmentCode->CurrentValue ?>"<?php echo $employment_grid->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_employment_DepartmentCode" class="form-group employment_DepartmentCode">
<span<?php echo $employment_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employment" data-field="x_DepartmentCode" name="x<?php echo $employment_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $employment_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($employment_grid->DepartmentCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_DepartmentCode" name="o<?php echo $employment_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $employment_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($employment_grid->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode">
<?php if (!$employment->isConfirm()) { ?>
<?php if ($employment_grid->SectionCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_employment_SectionCode" class="form-group employment_SectionCode">
<span<?php echo $employment_grid->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_grid->RowIndex ?>_SectionCode" name="x<?php echo $employment_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($employment_grid->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_employment_SectionCode" class="form-group employment_SectionCode">
<?php $employment_grid->SectionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_grid->RowIndex ?>_SectionCode"><?php echo EmptyValue(strval($employment_grid->SectionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_grid->SectionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_grid->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_grid->SectionCode->ReadOnly || $employment_grid->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_grid->RowIndex ?>_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_grid->SectionCode->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_SectionCode") ?>
<input type="hidden" data-table="employment" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_grid->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_grid->RowIndex ?>_SectionCode" id="x<?php echo $employment_grid->RowIndex ?>_SectionCode" value="<?php echo $employment_grid->SectionCode->CurrentValue ?>"<?php echo $employment_grid->SectionCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_employment_SectionCode" class="form-group employment_SectionCode">
<span<?php echo $employment_grid->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employment" data-field="x_SectionCode" name="x<?php echo $employment_grid->RowIndex ?>_SectionCode" id="x<?php echo $employment_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($employment_grid->SectionCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_SectionCode" name="o<?php echo $employment_grid->RowIndex ?>_SectionCode" id="o<?php echo $employment_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($employment_grid->SectionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_grid->SubstantivePosition->Visible) { // SubstantivePosition ?>
		<td data-name="SubstantivePosition">
<?php if (!$employment->isConfirm()) { ?>
<?php if ($employment_grid->SubstantivePosition->getSessionValue() != "") { ?>
<span id="el$rowindex$_employment_SubstantivePosition" class="form-group employment_SubstantivePosition">
<span<?php echo $employment_grid->SubstantivePosition->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->SubstantivePosition->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" name="x<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" value="<?php echo HtmlEncode($employment_grid->SubstantivePosition->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_employment_SubstantivePosition" class="form-group employment_SubstantivePosition">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_grid->RowIndex ?>_SubstantivePosition"><?php echo EmptyValue(strval($employment_grid->SubstantivePosition->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_grid->SubstantivePosition->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_grid->SubstantivePosition->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_grid->SubstantivePosition->ReadOnly || $employment_grid->SubstantivePosition->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_grid->RowIndex ?>_SubstantivePosition',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_grid->SubstantivePosition->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_SubstantivePosition") ?>
<input type="hidden" data-table="employment" data-field="x_SubstantivePosition" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_grid->SubstantivePosition->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" id="x<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" value="<?php echo $employment_grid->SubstantivePosition->CurrentValue ?>"<?php echo $employment_grid->SubstantivePosition->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_employment_SubstantivePosition" class="form-group employment_SubstantivePosition">
<span<?php echo $employment_grid->SubstantivePosition->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->SubstantivePosition->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employment" data-field="x_SubstantivePosition" name="x<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" id="x<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" value="<?php echo HtmlEncode($employment_grid->SubstantivePosition->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_SubstantivePosition" name="o<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" id="o<?php echo $employment_grid->RowIndex ?>_SubstantivePosition" value="<?php echo HtmlEncode($employment_grid->SubstantivePosition->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_grid->DateOfCurrentAppointment->Visible) { // DateOfCurrentAppointment ?>
		<td data-name="DateOfCurrentAppointment">
<?php if (!$employment->isConfirm()) { ?>
<span id="el$rowindex$_employment_DateOfCurrentAppointment" class="form-group employment_DateOfCurrentAppointment">
<input type="text" data-table="employment" data-field="x_DateOfCurrentAppointment" name="x<?php echo $employment_grid->RowIndex ?>_DateOfCurrentAppointment" id="x<?php echo $employment_grid->RowIndex ?>_DateOfCurrentAppointment" placeholder="<?php echo HtmlEncode($employment_grid->DateOfCurrentAppointment->getPlaceHolder()) ?>" value="<?php echo $employment_grid->DateOfCurrentAppointment->EditValue ?>"<?php echo $employment_grid->DateOfCurrentAppointment->editAttributes() ?>>
<?php if (!$employment_grid->DateOfCurrentAppointment->ReadOnly && !$employment_grid->DateOfCurrentAppointment->Disabled && !isset($employment_grid->DateOfCurrentAppointment->EditAttrs["readonly"]) && !isset($employment_grid->DateOfCurrentAppointment->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentgrid", "x<?php echo $employment_grid->RowIndex ?>_DateOfCurrentAppointment", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_employment_DateOfCurrentAppointment" class="form-group employment_DateOfCurrentAppointment">
<span<?php echo $employment_grid->DateOfCurrentAppointment->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->DateOfCurrentAppointment->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employment" data-field="x_DateOfCurrentAppointment" name="x<?php echo $employment_grid->RowIndex ?>_DateOfCurrentAppointment" id="x<?php echo $employment_grid->RowIndex ?>_DateOfCurrentAppointment" value="<?php echo HtmlEncode($employment_grid->DateOfCurrentAppointment->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_DateOfCurrentAppointment" name="o<?php echo $employment_grid->RowIndex ?>_DateOfCurrentAppointment" id="o<?php echo $employment_grid->RowIndex ?>_DateOfCurrentAppointment" value="<?php echo HtmlEncode($employment_grid->DateOfCurrentAppointment->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_grid->LastAppraisalDate->Visible) { // LastAppraisalDate ?>
		<td data-name="LastAppraisalDate">
<?php if (!$employment->isConfirm()) { ?>
<span id="el$rowindex$_employment_LastAppraisalDate" class="form-group employment_LastAppraisalDate">
<input type="text" data-table="employment" data-field="x_LastAppraisalDate" name="x<?php echo $employment_grid->RowIndex ?>_LastAppraisalDate" id="x<?php echo $employment_grid->RowIndex ?>_LastAppraisalDate" placeholder="<?php echo HtmlEncode($employment_grid->LastAppraisalDate->getPlaceHolder()) ?>" value="<?php echo $employment_grid->LastAppraisalDate->EditValue ?>"<?php echo $employment_grid->LastAppraisalDate->editAttributes() ?>>
<?php if (!$employment_grid->LastAppraisalDate->ReadOnly && !$employment_grid->LastAppraisalDate->Disabled && !isset($employment_grid->LastAppraisalDate->EditAttrs["readonly"]) && !isset($employment_grid->LastAppraisalDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentgrid", "x<?php echo $employment_grid->RowIndex ?>_LastAppraisalDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_employment_LastAppraisalDate" class="form-group employment_LastAppraisalDate">
<span<?php echo $employment_grid->LastAppraisalDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->LastAppraisalDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employment" data-field="x_LastAppraisalDate" name="x<?php echo $employment_grid->RowIndex ?>_LastAppraisalDate" id="x<?php echo $employment_grid->RowIndex ?>_LastAppraisalDate" value="<?php echo HtmlEncode($employment_grid->LastAppraisalDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_LastAppraisalDate" name="o<?php echo $employment_grid->RowIndex ?>_LastAppraisalDate" id="o<?php echo $employment_grid->RowIndex ?>_LastAppraisalDate" value="<?php echo HtmlEncode($employment_grid->LastAppraisalDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_grid->AppraisalStatus->Visible) { // AppraisalStatus ?>
		<td data-name="AppraisalStatus">
<?php if (!$employment->isConfirm()) { ?>
<span id="el$rowindex$_employment_AppraisalStatus" class="form-group employment_AppraisalStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_AppraisalStatus" data-value-separator="<?php echo $employment_grid->AppraisalStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_grid->RowIndex ?>_AppraisalStatus" name="x<?php echo $employment_grid->RowIndex ?>_AppraisalStatus"<?php echo $employment_grid->AppraisalStatus->editAttributes() ?>>
			<?php echo $employment_grid->AppraisalStatus->selectOptionListHtml("x{$employment_grid->RowIndex}_AppraisalStatus") ?>
		</select>
</div>
<?php echo $employment_grid->AppraisalStatus->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_AppraisalStatus") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_employment_AppraisalStatus" class="form-group employment_AppraisalStatus">
<span<?php echo $employment_grid->AppraisalStatus->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->AppraisalStatus->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employment" data-field="x_AppraisalStatus" name="x<?php echo $employment_grid->RowIndex ?>_AppraisalStatus" id="x<?php echo $employment_grid->RowIndex ?>_AppraisalStatus" value="<?php echo HtmlEncode($employment_grid->AppraisalStatus->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_AppraisalStatus" name="o<?php echo $employment_grid->RowIndex ?>_AppraisalStatus" id="o<?php echo $employment_grid->RowIndex ?>_AppraisalStatus" value="<?php echo HtmlEncode($employment_grid->AppraisalStatus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_grid->DateOfExit->Visible) { // DateOfExit ?>
		<td data-name="DateOfExit">
<?php if (!$employment->isConfirm()) { ?>
<span id="el$rowindex$_employment_DateOfExit" class="form-group employment_DateOfExit">
<input type="text" data-table="employment" data-field="x_DateOfExit" name="x<?php echo $employment_grid->RowIndex ?>_DateOfExit" id="x<?php echo $employment_grid->RowIndex ?>_DateOfExit" placeholder="<?php echo HtmlEncode($employment_grid->DateOfExit->getPlaceHolder()) ?>" value="<?php echo $employment_grid->DateOfExit->EditValue ?>"<?php echo $employment_grid->DateOfExit->editAttributes() ?>>
<?php if (!$employment_grid->DateOfExit->ReadOnly && !$employment_grid->DateOfExit->Disabled && !isset($employment_grid->DateOfExit->EditAttrs["readonly"]) && !isset($employment_grid->DateOfExit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentgrid", "x<?php echo $employment_grid->RowIndex ?>_DateOfExit", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_employment_DateOfExit" class="form-group employment_DateOfExit">
<span<?php echo $employment_grid->DateOfExit->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->DateOfExit->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employment" data-field="x_DateOfExit" name="x<?php echo $employment_grid->RowIndex ?>_DateOfExit" id="x<?php echo $employment_grid->RowIndex ?>_DateOfExit" value="<?php echo HtmlEncode($employment_grid->DateOfExit->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_DateOfExit" name="o<?php echo $employment_grid->RowIndex ?>_DateOfExit" id="o<?php echo $employment_grid->RowIndex ?>_DateOfExit" value="<?php echo HtmlEncode($employment_grid->DateOfExit->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_grid->EmploymentType->Visible) { // EmploymentType ?>
		<td data-name="EmploymentType">
<?php if (!$employment->isConfirm()) { ?>
<span id="el$rowindex$_employment_EmploymentType" class="form-group employment_EmploymentType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_EmploymentType" data-value-separator="<?php echo $employment_grid->EmploymentType->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_grid->RowIndex ?>_EmploymentType" name="x<?php echo $employment_grid->RowIndex ?>_EmploymentType"<?php echo $employment_grid->EmploymentType->editAttributes() ?>>
			<?php echo $employment_grid->EmploymentType->selectOptionListHtml("x{$employment_grid->RowIndex}_EmploymentType") ?>
		</select>
</div>
<?php echo $employment_grid->EmploymentType->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_EmploymentType") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_employment_EmploymentType" class="form-group employment_EmploymentType">
<span<?php echo $employment_grid->EmploymentType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->EmploymentType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employment" data-field="x_EmploymentType" name="x<?php echo $employment_grid->RowIndex ?>_EmploymentType" id="x<?php echo $employment_grid->RowIndex ?>_EmploymentType" value="<?php echo HtmlEncode($employment_grid->EmploymentType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_EmploymentType" name="o<?php echo $employment_grid->RowIndex ?>_EmploymentType" id="o<?php echo $employment_grid->RowIndex ?>_EmploymentType" value="<?php echo HtmlEncode($employment_grid->EmploymentType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_grid->EmploymentStatus->Visible) { // EmploymentStatus ?>
		<td data-name="EmploymentStatus">
<?php if (!$employment->isConfirm()) { ?>
<span id="el$rowindex$_employment_EmploymentStatus" class="form-group employment_EmploymentStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_EmploymentStatus" data-value-separator="<?php echo $employment_grid->EmploymentStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_grid->RowIndex ?>_EmploymentStatus" name="x<?php echo $employment_grid->RowIndex ?>_EmploymentStatus"<?php echo $employment_grid->EmploymentStatus->editAttributes() ?>>
			<?php echo $employment_grid->EmploymentStatus->selectOptionListHtml("x{$employment_grid->RowIndex}_EmploymentStatus") ?>
		</select>
</div>
<?php echo $employment_grid->EmploymentStatus->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_EmploymentStatus") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_employment_EmploymentStatus" class="form-group employment_EmploymentStatus">
<span<?php echo $employment_grid->EmploymentStatus->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->EmploymentStatus->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employment" data-field="x_EmploymentStatus" name="x<?php echo $employment_grid->RowIndex ?>_EmploymentStatus" id="x<?php echo $employment_grid->RowIndex ?>_EmploymentStatus" value="<?php echo HtmlEncode($employment_grid->EmploymentStatus->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_EmploymentStatus" name="o<?php echo $employment_grid->RowIndex ?>_EmploymentStatus" id="o<?php echo $employment_grid->RowIndex ?>_EmploymentStatus" value="<?php echo HtmlEncode($employment_grid->EmploymentStatus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_grid->EmployeeNumber->Visible) { // EmployeeNumber ?>
		<td data-name="EmployeeNumber">
<?php if (!$employment->isConfirm()) { ?>
<span id="el$rowindex$_employment_EmployeeNumber" class="form-group employment_EmployeeNumber">
<input type="text" data-table="employment" data-field="x_EmployeeNumber" name="x<?php echo $employment_grid->RowIndex ?>_EmployeeNumber" id="x<?php echo $employment_grid->RowIndex ?>_EmployeeNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($employment_grid->EmployeeNumber->getPlaceHolder()) ?>" value="<?php echo $employment_grid->EmployeeNumber->EditValue ?>"<?php echo $employment_grid->EmployeeNumber->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_employment_EmployeeNumber" class="form-group employment_EmployeeNumber">
<span<?php echo $employment_grid->EmployeeNumber->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->EmployeeNumber->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employment" data-field="x_EmployeeNumber" name="x<?php echo $employment_grid->RowIndex ?>_EmployeeNumber" id="x<?php echo $employment_grid->RowIndex ?>_EmployeeNumber" value="<?php echo HtmlEncode($employment_grid->EmployeeNumber->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_EmployeeNumber" name="o<?php echo $employment_grid->RowIndex ?>_EmployeeNumber" id="o<?php echo $employment_grid->RowIndex ?>_EmployeeNumber" value="<?php echo HtmlEncode($employment_grid->EmployeeNumber->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_grid->SalaryNotch->Visible) { // SalaryNotch ?>
		<td data-name="SalaryNotch">
<?php if (!$employment->isConfirm()) { ?>
<span id="el$rowindex$_employment_SalaryNotch" class="form-group employment_SalaryNotch">
<?php $employment_grid->SalaryNotch->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_grid->RowIndex ?>_SalaryNotch"><?php echo EmptyValue(strval($employment_grid->SalaryNotch->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_grid->SalaryNotch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_grid->SalaryNotch->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_grid->SalaryNotch->ReadOnly || $employment_grid->SalaryNotch->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_grid->RowIndex ?>_SalaryNotch',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_grid->SalaryNotch->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_SalaryNotch") ?>
<input type="hidden" data-table="employment" data-field="x_SalaryNotch" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_grid->SalaryNotch->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_grid->RowIndex ?>_SalaryNotch" id="x<?php echo $employment_grid->RowIndex ?>_SalaryNotch" value="<?php echo $employment_grid->SalaryNotch->CurrentValue ?>"<?php echo $employment_grid->SalaryNotch->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_employment_SalaryNotch" class="form-group employment_SalaryNotch">
<span<?php echo $employment_grid->SalaryNotch->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->SalaryNotch->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employment" data-field="x_SalaryNotch" name="x<?php echo $employment_grid->RowIndex ?>_SalaryNotch" id="x<?php echo $employment_grid->RowIndex ?>_SalaryNotch" value="<?php echo HtmlEncode($employment_grid->SalaryNotch->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_SalaryNotch" name="o<?php echo $employment_grid->RowIndex ?>_SalaryNotch" id="o<?php echo $employment_grid->RowIndex ?>_SalaryNotch" value="<?php echo HtmlEncode($employment_grid->SalaryNotch->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_grid->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
		<td data-name="BasicMonthlySalary">
<?php if (!$employment->isConfirm()) { ?>
<span id="el$rowindex$_employment_BasicMonthlySalary" class="form-group employment_BasicMonthlySalary">
<input type="text" data-table="employment" data-field="x_BasicMonthlySalary" name="x<?php echo $employment_grid->RowIndex ?>_BasicMonthlySalary" id="x<?php echo $employment_grid->RowIndex ?>_BasicMonthlySalary" size="30" placeholder="<?php echo HtmlEncode($employment_grid->BasicMonthlySalary->getPlaceHolder()) ?>" value="<?php echo $employment_grid->BasicMonthlySalary->EditValue ?>"<?php echo $employment_grid->BasicMonthlySalary->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_employment_BasicMonthlySalary" class="form-group employment_BasicMonthlySalary">
<span<?php echo $employment_grid->BasicMonthlySalary->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->BasicMonthlySalary->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employment" data-field="x_BasicMonthlySalary" name="x<?php echo $employment_grid->RowIndex ?>_BasicMonthlySalary" id="x<?php echo $employment_grid->RowIndex ?>_BasicMonthlySalary" value="<?php echo HtmlEncode($employment_grid->BasicMonthlySalary->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_BasicMonthlySalary" name="o<?php echo $employment_grid->RowIndex ?>_BasicMonthlySalary" id="o<?php echo $employment_grid->RowIndex ?>_BasicMonthlySalary" value="<?php echo HtmlEncode($employment_grid->BasicMonthlySalary->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_grid->ThirdParties->Visible) { // ThirdParties ?>
		<td data-name="ThirdParties">
<?php if (!$employment->isConfirm()) { ?>
<span id="el$rowindex$_employment_ThirdParties" class="form-group employment_ThirdParties">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_grid->RowIndex ?>_ThirdParties"><?php echo EmptyValue(strval($employment_grid->ThirdParties->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_grid->ThirdParties->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_grid->ThirdParties->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_grid->ThirdParties->ReadOnly || $employment_grid->ThirdParties->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_grid->RowIndex ?>_ThirdParties[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_grid->ThirdParties->Lookup->getParamTag($employment_grid, "p_x" . $employment_grid->RowIndex . "_ThirdParties") ?>
<input type="hidden" data-table="employment" data-field="x_ThirdParties" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $employment_grid->ThirdParties->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_grid->RowIndex ?>_ThirdParties[]" id="x<?php echo $employment_grid->RowIndex ?>_ThirdParties[]" value="<?php echo $employment_grid->ThirdParties->CurrentValue ?>"<?php echo $employment_grid->ThirdParties->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_employment_ThirdParties" class="form-group employment_ThirdParties">
<span<?php echo $employment_grid->ThirdParties->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->ThirdParties->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employment" data-field="x_ThirdParties" name="x<?php echo $employment_grid->RowIndex ?>_ThirdParties" id="x<?php echo $employment_grid->RowIndex ?>_ThirdParties" value="<?php echo HtmlEncode($employment_grid->ThirdParties->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_ThirdParties" name="o<?php echo $employment_grid->RowIndex ?>_ThirdParties[]" id="o<?php echo $employment_grid->RowIndex ?>_ThirdParties[]" value="<?php echo HtmlEncode($employment_grid->ThirdParties->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_grid->PayrollCode->Visible) { // PayrollCode ?>
		<td data-name="PayrollCode">
<?php if (!$employment->isConfirm()) { ?>
<span id="el$rowindex$_employment_PayrollCode" class="form-group employment_PayrollCode">
<input type="text" data-table="employment" data-field="x_PayrollCode" name="x<?php echo $employment_grid->RowIndex ?>_PayrollCode" id="x<?php echo $employment_grid->RowIndex ?>_PayrollCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($employment_grid->PayrollCode->getPlaceHolder()) ?>" value="<?php echo $employment_grid->PayrollCode->EditValue ?>"<?php echo $employment_grid->PayrollCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_employment_PayrollCode" class="form-group employment_PayrollCode">
<span<?php echo $employment_grid->PayrollCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->PayrollCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employment" data-field="x_PayrollCode" name="x<?php echo $employment_grid->RowIndex ?>_PayrollCode" id="x<?php echo $employment_grid->RowIndex ?>_PayrollCode" value="<?php echo HtmlEncode($employment_grid->PayrollCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_PayrollCode" name="o<?php echo $employment_grid->RowIndex ?>_PayrollCode" id="o<?php echo $employment_grid->RowIndex ?>_PayrollCode" value="<?php echo HtmlEncode($employment_grid->PayrollCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_grid->DateOfConfirmation->Visible) { // DateOfConfirmation ?>
		<td data-name="DateOfConfirmation">
<?php if (!$employment->isConfirm()) { ?>
<span id="el$rowindex$_employment_DateOfConfirmation" class="form-group employment_DateOfConfirmation">
<input type="text" data-table="employment" data-field="x_DateOfConfirmation" name="x<?php echo $employment_grid->RowIndex ?>_DateOfConfirmation" id="x<?php echo $employment_grid->RowIndex ?>_DateOfConfirmation" maxlength="10" placeholder="<?php echo HtmlEncode($employment_grid->DateOfConfirmation->getPlaceHolder()) ?>" value="<?php echo $employment_grid->DateOfConfirmation->EditValue ?>"<?php echo $employment_grid->DateOfConfirmation->editAttributes() ?>>
<?php if (!$employment_grid->DateOfConfirmation->ReadOnly && !$employment_grid->DateOfConfirmation->Disabled && !isset($employment_grid->DateOfConfirmation->EditAttrs["readonly"]) && !isset($employment_grid->DateOfConfirmation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentgrid", "x<?php echo $employment_grid->RowIndex ?>_DateOfConfirmation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_employment_DateOfConfirmation" class="form-group employment_DateOfConfirmation">
<span<?php echo $employment_grid->DateOfConfirmation->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_grid->DateOfConfirmation->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="employment" data-field="x_DateOfConfirmation" name="x<?php echo $employment_grid->RowIndex ?>_DateOfConfirmation" id="x<?php echo $employment_grid->RowIndex ?>_DateOfConfirmation" value="<?php echo HtmlEncode($employment_grid->DateOfConfirmation->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_DateOfConfirmation" name="o<?php echo $employment_grid->RowIndex ?>_DateOfConfirmation" id="o<?php echo $employment_grid->RowIndex ?>_DateOfConfirmation" value="<?php echo HtmlEncode($employment_grid->DateOfConfirmation->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employment_grid->ListOptions->render("body", "right", $employment_grid->RowIndex);
?>
<script>
loadjs.ready(["femploymentgrid", "load"], function() {
	femploymentgrid.updateLists(<?php echo $employment_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($employment->CurrentMode == "add" || $employment->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $employment_grid->FormKeyCountName ?>" id="<?php echo $employment_grid->FormKeyCountName ?>" value="<?php echo $employment_grid->KeyCount ?>">
<?php echo $employment_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($employment->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $employment_grid->FormKeyCountName ?>" id="<?php echo $employment_grid->FormKeyCountName ?>" value="<?php echo $employment_grid->KeyCount ?>">
<?php echo $employment_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($employment->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="femploymentgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($employment_grid->Recordset)
	$employment_grid->Recordset->Close();
?>
<?php if ($employment_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $employment_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($employment_grid->TotalRecords == 0 && !$employment->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $employment_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$employment_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$employment_grid->terminate();
?>