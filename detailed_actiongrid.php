<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($detailed_action_grid))
	$detailed_action_grid = new detailed_action_grid();

// Run the page
$detailed_action_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailed_action_grid->Page_Render();
?>
<?php if (!$detailed_action_grid->isExport()) { ?>
<script>
var fdetailed_actiongrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fdetailed_actiongrid = new ew.Form("fdetailed_actiongrid", "grid");
	fdetailed_actiongrid.formKeyCountName = '<?php echo $detailed_action_grid->FormKeyCountName ?>';

	// Validate form
	fdetailed_actiongrid.validate = function() {
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
			<?php if ($detailed_action_grid->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_grid->LACode->caption(), $detailed_action_grid->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_grid->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_grid->DepartmentCode->caption(), $detailed_action_grid->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_grid->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_grid->SectionCode->caption(), $detailed_action_grid->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_grid->ProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_grid->ProgramCode->caption(), $detailed_action_grid->ProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_grid->SubProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SubProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_grid->SubProgramCode->caption(), $detailed_action_grid->SubProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_grid->OutcomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_grid->OutcomeCode->caption(), $detailed_action_grid->OutcomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_grid->OutputCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_grid->OutputCode->caption(), $detailed_action_grid->OutputCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_grid->ActionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_grid->ActionCode->caption(), $detailed_action_grid->ActionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_grid->FinancialYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_grid->FinancialYear->caption(), $detailed_action_grid->FinancialYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailed_action_grid->FinancialYear->errorMessage()) ?>");
			<?php if ($detailed_action_grid->DetailedActionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DetailedActionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_grid->DetailedActionCode->caption(), $detailed_action_grid->DetailedActionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_grid->DetailedActionName->Required) { ?>
				elm = this.getElements("x" + infix + "_DetailedActionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_grid->DetailedActionName->caption(), $detailed_action_grid->DetailedActionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_grid->DetailedActionLocation->Required) { ?>
				elm = this.getElements("x" + infix + "_DetailedActionLocation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_grid->DetailedActionLocation->caption(), $detailed_action_grid->DetailedActionLocation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_grid->PlannedStartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedStartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_grid->PlannedStartDate->caption(), $detailed_action_grid->PlannedStartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedStartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailed_action_grid->PlannedStartDate->errorMessage()) ?>");
			<?php if ($detailed_action_grid->PlannedEndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedEndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_grid->PlannedEndDate->caption(), $detailed_action_grid->PlannedEndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedEndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailed_action_grid->PlannedEndDate->errorMessage()) ?>");
			<?php if ($detailed_action_grid->ActualStartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualStartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_grid->ActualStartDate->caption(), $detailed_action_grid->ActualStartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualStartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailed_action_grid->ActualStartDate->errorMessage()) ?>");
			<?php if ($detailed_action_grid->ActualEndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualEndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_grid->ActualEndDate->caption(), $detailed_action_grid->ActualEndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualEndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailed_action_grid->ActualEndDate->errorMessage()) ?>");
			<?php if ($detailed_action_grid->Ward->Required) { ?>
				elm = this.getElements("x" + infix + "_Ward");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_grid->Ward->caption(), $detailed_action_grid->Ward->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_grid->ExpectedResult->Required) { ?>
				elm = this.getElements("x" + infix + "_ExpectedResult");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_grid->ExpectedResult->caption(), $detailed_action_grid->ExpectedResult->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_grid->Comments->Required) { ?>
				elm = this.getElements("x" + infix + "_Comments");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_grid->Comments->caption(), $detailed_action_grid->Comments->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_grid->ProgressStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgressStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_grid->ProgressStatus->caption(), $detailed_action_grid->ProgressStatus->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fdetailed_actiongrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SectionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProgramCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SubProgramCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutcomeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutputCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "FinancialYear", false)) return false;
		if (ew.valueChanged(fobj, infix, "DetailedActionName", false)) return false;
		if (ew.valueChanged(fobj, infix, "DetailedActionLocation", false)) return false;
		if (ew.valueChanged(fobj, infix, "PlannedStartDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "PlannedEndDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActualStartDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActualEndDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "Ward", false)) return false;
		if (ew.valueChanged(fobj, infix, "ExpectedResult", false)) return false;
		if (ew.valueChanged(fobj, infix, "Comments", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProgressStatus", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdetailed_actiongrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailed_actiongrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailed_actiongrid.lists["x_LACode"] = <?php echo $detailed_action_grid->LACode->Lookup->toClientList($detailed_action_grid) ?>;
	fdetailed_actiongrid.lists["x_LACode"].options = <?php echo JsonEncode($detailed_action_grid->LACode->lookupOptions()) ?>;
	fdetailed_actiongrid.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailed_actiongrid.lists["x_DepartmentCode"] = <?php echo $detailed_action_grid->DepartmentCode->Lookup->toClientList($detailed_action_grid) ?>;
	fdetailed_actiongrid.lists["x_DepartmentCode"].options = <?php echo JsonEncode($detailed_action_grid->DepartmentCode->lookupOptions()) ?>;
	fdetailed_actiongrid.lists["x_SectionCode"] = <?php echo $detailed_action_grid->SectionCode->Lookup->toClientList($detailed_action_grid) ?>;
	fdetailed_actiongrid.lists["x_SectionCode"].options = <?php echo JsonEncode($detailed_action_grid->SectionCode->lookupOptions()) ?>;
	fdetailed_actiongrid.lists["x_ProgramCode"] = <?php echo $detailed_action_grid->ProgramCode->Lookup->toClientList($detailed_action_grid) ?>;
	fdetailed_actiongrid.lists["x_ProgramCode"].options = <?php echo JsonEncode($detailed_action_grid->ProgramCode->lookupOptions()) ?>;
	fdetailed_actiongrid.lists["x_SubProgramCode"] = <?php echo $detailed_action_grid->SubProgramCode->Lookup->toClientList($detailed_action_grid) ?>;
	fdetailed_actiongrid.lists["x_SubProgramCode"].options = <?php echo JsonEncode($detailed_action_grid->SubProgramCode->lookupOptions()) ?>;
	fdetailed_actiongrid.lists["x_OutcomeCode"] = <?php echo $detailed_action_grid->OutcomeCode->Lookup->toClientList($detailed_action_grid) ?>;
	fdetailed_actiongrid.lists["x_OutcomeCode"].options = <?php echo JsonEncode($detailed_action_grid->OutcomeCode->lookupOptions()) ?>;
	fdetailed_actiongrid.lists["x_OutputCode"] = <?php echo $detailed_action_grid->OutputCode->Lookup->toClientList($detailed_action_grid) ?>;
	fdetailed_actiongrid.lists["x_OutputCode"].options = <?php echo JsonEncode($detailed_action_grid->OutputCode->lookupOptions()) ?>;
	fdetailed_actiongrid.lists["x_ActionCode"] = <?php echo $detailed_action_grid->ActionCode->Lookup->toClientList($detailed_action_grid) ?>;
	fdetailed_actiongrid.lists["x_ActionCode"].options = <?php echo JsonEncode($detailed_action_grid->ActionCode->lookupOptions()) ?>;
	fdetailed_actiongrid.lists["x_ProgressStatus"] = <?php echo $detailed_action_grid->ProgressStatus->Lookup->toClientList($detailed_action_grid) ?>;
	fdetailed_actiongrid.lists["x_ProgressStatus"].options = <?php echo JsonEncode($detailed_action_grid->ProgressStatus->lookupOptions()) ?>;
	loadjs.done("fdetailed_actiongrid");
});
</script>
<?php } ?>
<?php
$detailed_action_grid->renderOtherOptions();
?>
<?php if ($detailed_action_grid->TotalRecords > 0 || $detailed_action->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailed_action_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailed_action">
<?php if ($detailed_action_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $detailed_action_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdetailed_actiongrid" class="ew-form ew-list-form form-inline">
<div id="gmp_detailed_action" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_detailed_actiongrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailed_action->RowType = ROWTYPE_HEADER;

// Render list options
$detailed_action_grid->renderListOptions();

// Render list options (header, left)
$detailed_action_grid->ListOptions->render("header", "left");
?>
<?php if ($detailed_action_grid->LACode->Visible) { // LACode ?>
	<?php if ($detailed_action_grid->SortUrl($detailed_action_grid->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $detailed_action_grid->LACode->headerCellClass() ?>"><div id="elh_detailed_action_LACode" class="detailed_action_LACode"><div class="ew-table-header-caption"><?php echo $detailed_action_grid->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $detailed_action_grid->LACode->headerCellClass() ?>"><div><div id="elh_detailed_action_LACode" class="detailed_action_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_grid->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_grid->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_grid->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_grid->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($detailed_action_grid->SortUrl($detailed_action_grid->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $detailed_action_grid->DepartmentCode->headerCellClass() ?>"><div id="elh_detailed_action_DepartmentCode" class="detailed_action_DepartmentCode"><div class="ew-table-header-caption"><?php echo $detailed_action_grid->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $detailed_action_grid->DepartmentCode->headerCellClass() ?>"><div><div id="elh_detailed_action_DepartmentCode" class="detailed_action_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_grid->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_grid->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_grid->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_grid->SectionCode->Visible) { // SectionCode ?>
	<?php if ($detailed_action_grid->SortUrl($detailed_action_grid->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $detailed_action_grid->SectionCode->headerCellClass() ?>"><div id="elh_detailed_action_SectionCode" class="detailed_action_SectionCode"><div class="ew-table-header-caption"><?php echo $detailed_action_grid->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $detailed_action_grid->SectionCode->headerCellClass() ?>"><div><div id="elh_detailed_action_SectionCode" class="detailed_action_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_grid->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_grid->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_grid->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_grid->ProgramCode->Visible) { // ProgramCode ?>
	<?php if ($detailed_action_grid->SortUrl($detailed_action_grid->ProgramCode) == "") { ?>
		<th data-name="ProgramCode" class="<?php echo $detailed_action_grid->ProgramCode->headerCellClass() ?>"><div id="elh_detailed_action_ProgramCode" class="detailed_action_ProgramCode"><div class="ew-table-header-caption"><?php echo $detailed_action_grid->ProgramCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgramCode" class="<?php echo $detailed_action_grid->ProgramCode->headerCellClass() ?>"><div><div id="elh_detailed_action_ProgramCode" class="detailed_action_ProgramCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_grid->ProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_grid->ProgramCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_grid->ProgramCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_grid->SubProgramCode->Visible) { // SubProgramCode ?>
	<?php if ($detailed_action_grid->SortUrl($detailed_action_grid->SubProgramCode) == "") { ?>
		<th data-name="SubProgramCode" class="<?php echo $detailed_action_grid->SubProgramCode->headerCellClass() ?>"><div id="elh_detailed_action_SubProgramCode" class="detailed_action_SubProgramCode"><div class="ew-table-header-caption"><?php echo $detailed_action_grid->SubProgramCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubProgramCode" class="<?php echo $detailed_action_grid->SubProgramCode->headerCellClass() ?>"><div><div id="elh_detailed_action_SubProgramCode" class="detailed_action_SubProgramCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_grid->SubProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_grid->SubProgramCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_grid->SubProgramCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_grid->OutcomeCode->Visible) { // OutcomeCode ?>
	<?php if ($detailed_action_grid->SortUrl($detailed_action_grid->OutcomeCode) == "") { ?>
		<th data-name="OutcomeCode" class="<?php echo $detailed_action_grid->OutcomeCode->headerCellClass() ?>"><div id="elh_detailed_action_OutcomeCode" class="detailed_action_OutcomeCode"><div class="ew-table-header-caption"><?php echo $detailed_action_grid->OutcomeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutcomeCode" class="<?php echo $detailed_action_grid->OutcomeCode->headerCellClass() ?>"><div><div id="elh_detailed_action_OutcomeCode" class="detailed_action_OutcomeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_grid->OutcomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_grid->OutcomeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_grid->OutcomeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_grid->OutputCode->Visible) { // OutputCode ?>
	<?php if ($detailed_action_grid->SortUrl($detailed_action_grid->OutputCode) == "") { ?>
		<th data-name="OutputCode" class="<?php echo $detailed_action_grid->OutputCode->headerCellClass() ?>"><div id="elh_detailed_action_OutputCode" class="detailed_action_OutputCode"><div class="ew-table-header-caption"><?php echo $detailed_action_grid->OutputCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputCode" class="<?php echo $detailed_action_grid->OutputCode->headerCellClass() ?>"><div><div id="elh_detailed_action_OutputCode" class="detailed_action_OutputCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_grid->OutputCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_grid->OutputCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_grid->OutputCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_grid->ActionCode->Visible) { // ActionCode ?>
	<?php if ($detailed_action_grid->SortUrl($detailed_action_grid->ActionCode) == "") { ?>
		<th data-name="ActionCode" class="<?php echo $detailed_action_grid->ActionCode->headerCellClass() ?>"><div id="elh_detailed_action_ActionCode" class="detailed_action_ActionCode"><div class="ew-table-header-caption"><?php echo $detailed_action_grid->ActionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionCode" class="<?php echo $detailed_action_grid->ActionCode->headerCellClass() ?>"><div><div id="elh_detailed_action_ActionCode" class="detailed_action_ActionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_grid->ActionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_grid->ActionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_grid->ActionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_grid->FinancialYear->Visible) { // FinancialYear ?>
	<?php if ($detailed_action_grid->SortUrl($detailed_action_grid->FinancialYear) == "") { ?>
		<th data-name="FinancialYear" class="<?php echo $detailed_action_grid->FinancialYear->headerCellClass() ?>"><div id="elh_detailed_action_FinancialYear" class="detailed_action_FinancialYear"><div class="ew-table-header-caption"><?php echo $detailed_action_grid->FinancialYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FinancialYear" class="<?php echo $detailed_action_grid->FinancialYear->headerCellClass() ?>"><div><div id="elh_detailed_action_FinancialYear" class="detailed_action_FinancialYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_grid->FinancialYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_grid->FinancialYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_grid->FinancialYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_grid->DetailedActionCode->Visible) { // DetailedActionCode ?>
	<?php if ($detailed_action_grid->SortUrl($detailed_action_grid->DetailedActionCode) == "") { ?>
		<th data-name="DetailedActionCode" class="<?php echo $detailed_action_grid->DetailedActionCode->headerCellClass() ?>"><div id="elh_detailed_action_DetailedActionCode" class="detailed_action_DetailedActionCode"><div class="ew-table-header-caption"><?php echo $detailed_action_grid->DetailedActionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DetailedActionCode" class="<?php echo $detailed_action_grid->DetailedActionCode->headerCellClass() ?>"><div><div id="elh_detailed_action_DetailedActionCode" class="detailed_action_DetailedActionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_grid->DetailedActionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_grid->DetailedActionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_grid->DetailedActionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_grid->DetailedActionName->Visible) { // DetailedActionName ?>
	<?php if ($detailed_action_grid->SortUrl($detailed_action_grid->DetailedActionName) == "") { ?>
		<th data-name="DetailedActionName" class="<?php echo $detailed_action_grid->DetailedActionName->headerCellClass() ?>"><div id="elh_detailed_action_DetailedActionName" class="detailed_action_DetailedActionName"><div class="ew-table-header-caption"><?php echo $detailed_action_grid->DetailedActionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DetailedActionName" class="<?php echo $detailed_action_grid->DetailedActionName->headerCellClass() ?>"><div><div id="elh_detailed_action_DetailedActionName" class="detailed_action_DetailedActionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_grid->DetailedActionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_grid->DetailedActionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_grid->DetailedActionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_grid->DetailedActionLocation->Visible) { // DetailedActionLocation ?>
	<?php if ($detailed_action_grid->SortUrl($detailed_action_grid->DetailedActionLocation) == "") { ?>
		<th data-name="DetailedActionLocation" class="<?php echo $detailed_action_grid->DetailedActionLocation->headerCellClass() ?>"><div id="elh_detailed_action_DetailedActionLocation" class="detailed_action_DetailedActionLocation"><div class="ew-table-header-caption"><?php echo $detailed_action_grid->DetailedActionLocation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DetailedActionLocation" class="<?php echo $detailed_action_grid->DetailedActionLocation->headerCellClass() ?>"><div><div id="elh_detailed_action_DetailedActionLocation" class="detailed_action_DetailedActionLocation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_grid->DetailedActionLocation->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_grid->DetailedActionLocation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_grid->DetailedActionLocation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_grid->PlannedStartDate->Visible) { // PlannedStartDate ?>
	<?php if ($detailed_action_grid->SortUrl($detailed_action_grid->PlannedStartDate) == "") { ?>
		<th data-name="PlannedStartDate" class="<?php echo $detailed_action_grid->PlannedStartDate->headerCellClass() ?>"><div id="elh_detailed_action_PlannedStartDate" class="detailed_action_PlannedStartDate"><div class="ew-table-header-caption"><?php echo $detailed_action_grid->PlannedStartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PlannedStartDate" class="<?php echo $detailed_action_grid->PlannedStartDate->headerCellClass() ?>"><div><div id="elh_detailed_action_PlannedStartDate" class="detailed_action_PlannedStartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_grid->PlannedStartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_grid->PlannedStartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_grid->PlannedStartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_grid->PlannedEndDate->Visible) { // PlannedEndDate ?>
	<?php if ($detailed_action_grid->SortUrl($detailed_action_grid->PlannedEndDate) == "") { ?>
		<th data-name="PlannedEndDate" class="<?php echo $detailed_action_grid->PlannedEndDate->headerCellClass() ?>"><div id="elh_detailed_action_PlannedEndDate" class="detailed_action_PlannedEndDate"><div class="ew-table-header-caption"><?php echo $detailed_action_grid->PlannedEndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PlannedEndDate" class="<?php echo $detailed_action_grid->PlannedEndDate->headerCellClass() ?>"><div><div id="elh_detailed_action_PlannedEndDate" class="detailed_action_PlannedEndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_grid->PlannedEndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_grid->PlannedEndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_grid->PlannedEndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_grid->ActualStartDate->Visible) { // ActualStartDate ?>
	<?php if ($detailed_action_grid->SortUrl($detailed_action_grid->ActualStartDate) == "") { ?>
		<th data-name="ActualStartDate" class="<?php echo $detailed_action_grid->ActualStartDate->headerCellClass() ?>"><div id="elh_detailed_action_ActualStartDate" class="detailed_action_ActualStartDate"><div class="ew-table-header-caption"><?php echo $detailed_action_grid->ActualStartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActualStartDate" class="<?php echo $detailed_action_grid->ActualStartDate->headerCellClass() ?>"><div><div id="elh_detailed_action_ActualStartDate" class="detailed_action_ActualStartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_grid->ActualStartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_grid->ActualStartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_grid->ActualStartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_grid->ActualEndDate->Visible) { // ActualEndDate ?>
	<?php if ($detailed_action_grid->SortUrl($detailed_action_grid->ActualEndDate) == "") { ?>
		<th data-name="ActualEndDate" class="<?php echo $detailed_action_grid->ActualEndDate->headerCellClass() ?>"><div id="elh_detailed_action_ActualEndDate" class="detailed_action_ActualEndDate"><div class="ew-table-header-caption"><?php echo $detailed_action_grid->ActualEndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActualEndDate" class="<?php echo $detailed_action_grid->ActualEndDate->headerCellClass() ?>"><div><div id="elh_detailed_action_ActualEndDate" class="detailed_action_ActualEndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_grid->ActualEndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_grid->ActualEndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_grid->ActualEndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_grid->Ward->Visible) { // Ward ?>
	<?php if ($detailed_action_grid->SortUrl($detailed_action_grid->Ward) == "") { ?>
		<th data-name="Ward" class="<?php echo $detailed_action_grid->Ward->headerCellClass() ?>"><div id="elh_detailed_action_Ward" class="detailed_action_Ward"><div class="ew-table-header-caption"><?php echo $detailed_action_grid->Ward->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Ward" class="<?php echo $detailed_action_grid->Ward->headerCellClass() ?>"><div><div id="elh_detailed_action_Ward" class="detailed_action_Ward">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_grid->Ward->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_grid->Ward->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_grid->Ward->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_grid->ExpectedResult->Visible) { // ExpectedResult ?>
	<?php if ($detailed_action_grid->SortUrl($detailed_action_grid->ExpectedResult) == "") { ?>
		<th data-name="ExpectedResult" class="<?php echo $detailed_action_grid->ExpectedResult->headerCellClass() ?>"><div id="elh_detailed_action_ExpectedResult" class="detailed_action_ExpectedResult"><div class="ew-table-header-caption"><?php echo $detailed_action_grid->ExpectedResult->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExpectedResult" class="<?php echo $detailed_action_grid->ExpectedResult->headerCellClass() ?>"><div><div id="elh_detailed_action_ExpectedResult" class="detailed_action_ExpectedResult">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_grid->ExpectedResult->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_grid->ExpectedResult->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_grid->ExpectedResult->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_grid->Comments->Visible) { // Comments ?>
	<?php if ($detailed_action_grid->SortUrl($detailed_action_grid->Comments) == "") { ?>
		<th data-name="Comments" class="<?php echo $detailed_action_grid->Comments->headerCellClass() ?>"><div id="elh_detailed_action_Comments" class="detailed_action_Comments"><div class="ew-table-header-caption"><?php echo $detailed_action_grid->Comments->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Comments" class="<?php echo $detailed_action_grid->Comments->headerCellClass() ?>"><div><div id="elh_detailed_action_Comments" class="detailed_action_Comments">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_grid->Comments->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_grid->Comments->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_grid->Comments->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_grid->ProgressStatus->Visible) { // ProgressStatus ?>
	<?php if ($detailed_action_grid->SortUrl($detailed_action_grid->ProgressStatus) == "") { ?>
		<th data-name="ProgressStatus" class="<?php echo $detailed_action_grid->ProgressStatus->headerCellClass() ?>"><div id="elh_detailed_action_ProgressStatus" class="detailed_action_ProgressStatus"><div class="ew-table-header-caption"><?php echo $detailed_action_grid->ProgressStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgressStatus" class="<?php echo $detailed_action_grid->ProgressStatus->headerCellClass() ?>"><div><div id="elh_detailed_action_ProgressStatus" class="detailed_action_ProgressStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_grid->ProgressStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_grid->ProgressStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_grid->ProgressStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailed_action_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$detailed_action_grid->StartRecord = 1;
$detailed_action_grid->StopRecord = $detailed_action_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($detailed_action->isConfirm() || $detailed_action_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($detailed_action_grid->FormKeyCountName) && ($detailed_action_grid->isGridAdd() || $detailed_action_grid->isGridEdit() || $detailed_action->isConfirm())) {
		$detailed_action_grid->KeyCount = $CurrentForm->getValue($detailed_action_grid->FormKeyCountName);
		$detailed_action_grid->StopRecord = $detailed_action_grid->StartRecord + $detailed_action_grid->KeyCount - 1;
	}
}
$detailed_action_grid->RecordCount = $detailed_action_grid->StartRecord - 1;
if ($detailed_action_grid->Recordset && !$detailed_action_grid->Recordset->EOF) {
	$detailed_action_grid->Recordset->moveFirst();
	$selectLimit = $detailed_action_grid->UseSelectLimit;
	if (!$selectLimit && $detailed_action_grid->StartRecord > 1)
		$detailed_action_grid->Recordset->move($detailed_action_grid->StartRecord - 1);
} elseif (!$detailed_action->AllowAddDeleteRow && $detailed_action_grid->StopRecord == 0) {
	$detailed_action_grid->StopRecord = $detailed_action->GridAddRowCount;
}

// Initialize aggregate
$detailed_action->RowType = ROWTYPE_AGGREGATEINIT;
$detailed_action->resetAttributes();
$detailed_action_grid->renderRow();
if ($detailed_action_grid->isGridAdd())
	$detailed_action_grid->RowIndex = 0;
if ($detailed_action_grid->isGridEdit())
	$detailed_action_grid->RowIndex = 0;
while ($detailed_action_grid->RecordCount < $detailed_action_grid->StopRecord) {
	$detailed_action_grid->RecordCount++;
	if ($detailed_action_grid->RecordCount >= $detailed_action_grid->StartRecord) {
		$detailed_action_grid->RowCount++;
		if ($detailed_action_grid->isGridAdd() || $detailed_action_grid->isGridEdit() || $detailed_action->isConfirm()) {
			$detailed_action_grid->RowIndex++;
			$CurrentForm->Index = $detailed_action_grid->RowIndex;
			if ($CurrentForm->hasValue($detailed_action_grid->FormActionName) && ($detailed_action->isConfirm() || $detailed_action_grid->EventCancelled))
				$detailed_action_grid->RowAction = strval($CurrentForm->getValue($detailed_action_grid->FormActionName));
			elseif ($detailed_action_grid->isGridAdd())
				$detailed_action_grid->RowAction = "insert";
			else
				$detailed_action_grid->RowAction = "";
		}

		// Set up key count
		$detailed_action_grid->KeyCount = $detailed_action_grid->RowIndex;

		// Init row class and style
		$detailed_action->resetAttributes();
		$detailed_action->CssClass = "";
		if ($detailed_action_grid->isGridAdd()) {
			if ($detailed_action->CurrentMode == "copy") {
				$detailed_action_grid->loadRowValues($detailed_action_grid->Recordset); // Load row values
				$detailed_action_grid->setRecordKey($detailed_action_grid->RowOldKey, $detailed_action_grid->Recordset); // Set old record key
			} else {
				$detailed_action_grid->loadRowValues(); // Load default values
				$detailed_action_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$detailed_action_grid->loadRowValues($detailed_action_grid->Recordset); // Load row values
		}
		$detailed_action->RowType = ROWTYPE_VIEW; // Render view
		if ($detailed_action_grid->isGridAdd()) // Grid add
			$detailed_action->RowType = ROWTYPE_ADD; // Render add
		if ($detailed_action_grid->isGridAdd() && $detailed_action->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$detailed_action_grid->restoreCurrentRowFormValues($detailed_action_grid->RowIndex); // Restore form values
		if ($detailed_action_grid->isGridEdit()) { // Grid edit
			if ($detailed_action->EventCancelled)
				$detailed_action_grid->restoreCurrentRowFormValues($detailed_action_grid->RowIndex); // Restore form values
			if ($detailed_action_grid->RowAction == "insert")
				$detailed_action->RowType = ROWTYPE_ADD; // Render add
			else
				$detailed_action->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($detailed_action_grid->isGridEdit() && ($detailed_action->RowType == ROWTYPE_EDIT || $detailed_action->RowType == ROWTYPE_ADD) && $detailed_action->EventCancelled) // Update failed
			$detailed_action_grid->restoreCurrentRowFormValues($detailed_action_grid->RowIndex); // Restore form values
		if ($detailed_action->RowType == ROWTYPE_EDIT) // Edit row
			$detailed_action_grid->EditRowCount++;
		if ($detailed_action->isConfirm()) // Confirm row
			$detailed_action_grid->restoreCurrentRowFormValues($detailed_action_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$detailed_action->RowAttrs->merge(["data-rowindex" => $detailed_action_grid->RowCount, "id" => "r" . $detailed_action_grid->RowCount . "_detailed_action", "data-rowtype" => $detailed_action->RowType]);

		// Render row
		$detailed_action_grid->renderRow();

		// Render list options
		$detailed_action_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($detailed_action_grid->RowAction != "delete" && $detailed_action_grid->RowAction != "insertdelete" && !($detailed_action_grid->RowAction == "insert" && $detailed_action->isConfirm() && $detailed_action_grid->emptyRow())) {
?>
	<tr <?php echo $detailed_action->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailed_action_grid->ListOptions->render("body", "left", $detailed_action_grid->RowCount);
?>
	<?php if ($detailed_action_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $detailed_action_grid->LACode->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($detailed_action_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_LACode" class="form-group">
<span<?php echo $detailed_action_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_grid->RowIndex ?>_LACode" name="x<?php echo $detailed_action_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($detailed_action_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_LACode" class="form-group">
<?php
$onchange = $detailed_action_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailed_action_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailed_action_grid->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailed_action_grid->RowIndex ?>_LACode" id="sv_x<?php echo $detailed_action_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($detailed_action_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($detailed_action_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailed_action_grid->LACode->getPlaceHolder()) ?>"<?php echo $detailed_action_grid->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_grid->RowIndex ?>_LACode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_grid->LACode->ReadOnly || $detailed_action_grid->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_grid->RowIndex ?>_LACode" id="x<?php echo $detailed_action_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($detailed_action_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailed_actiongrid"], function() {
	fdetailed_actiongrid.createAutoSuggest({"id":"x<?php echo $detailed_action_grid->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $detailed_action_grid->LACode->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_LACode" name="o<?php echo $detailed_action_grid->RowIndex ?>_LACode" id="o<?php echo $detailed_action_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($detailed_action_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($detailed_action_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_LACode" class="form-group">
<span<?php echo $detailed_action_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_grid->RowIndex ?>_LACode" name="x<?php echo $detailed_action_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($detailed_action_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_LACode" class="form-group">
<?php
$onchange = $detailed_action_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailed_action_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailed_action_grid->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailed_action_grid->RowIndex ?>_LACode" id="sv_x<?php echo $detailed_action_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($detailed_action_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($detailed_action_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailed_action_grid->LACode->getPlaceHolder()) ?>"<?php echo $detailed_action_grid->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_grid->RowIndex ?>_LACode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_grid->LACode->ReadOnly || $detailed_action_grid->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_grid->RowIndex ?>_LACode" id="x<?php echo $detailed_action_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($detailed_action_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailed_actiongrid"], function() {
	fdetailed_actiongrid.createAutoSuggest({"id":"x<?php echo $detailed_action_grid->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $detailed_action_grid->LACode->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_LACode">
<span<?php echo $detailed_action_grid->LACode->viewAttributes() ?>><?php echo $detailed_action_grid->LACode->getViewValue() ?></span>
</span>
<?php if (!$detailed_action->isConfirm()) { ?>
<input type="hidden" data-table="detailed_action" data-field="x_LACode" name="x<?php echo $detailed_action_grid->RowIndex ?>_LACode" id="x<?php echo $detailed_action_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($detailed_action_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_LACode" name="o<?php echo $detailed_action_grid->RowIndex ?>_LACode" id="o<?php echo $detailed_action_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($detailed_action_grid->LACode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailed_action" data-field="x_LACode" name="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_LACode" id="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($detailed_action_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_LACode" name="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_LACode" id="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($detailed_action_grid->LACode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $detailed_action_grid->DepartmentCode->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($detailed_action_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_DepartmentCode" class="form-group">
<span<?php echo $detailed_action_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($detailed_action_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_DepartmentCode" class="form-group">
<?php $detailed_action_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_DepartmentCode" data-value-separator="<?php echo $detailed_action_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode"<?php echo $detailed_action_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $detailed_action_grid->DepartmentCode->selectOptionListHtml("x{$detailed_action_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $detailed_action_grid->DepartmentCode->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_DepartmentCode" name="o<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($detailed_action_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($detailed_action_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_DepartmentCode" class="form-group">
<span<?php echo $detailed_action_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($detailed_action_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_DepartmentCode" class="form-group">
<?php $detailed_action_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_DepartmentCode" data-value-separator="<?php echo $detailed_action_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode"<?php echo $detailed_action_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $detailed_action_grid->DepartmentCode->selectOptionListHtml("x{$detailed_action_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $detailed_action_grid->DepartmentCode->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_DepartmentCode">
<span<?php echo $detailed_action_grid->DepartmentCode->viewAttributes() ?>><?php echo $detailed_action_grid->DepartmentCode->getViewValue() ?></span>
</span>
<?php if (!$detailed_action->isConfirm()) { ?>
<input type="hidden" data-table="detailed_action" data-field="x_DepartmentCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($detailed_action_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_DepartmentCode" name="o<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($detailed_action_grid->DepartmentCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailed_action" data-field="x_DepartmentCode" name="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode" id="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($detailed_action_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_DepartmentCode" name="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode" id="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($detailed_action_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $detailed_action_grid->SectionCode->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_SectionCode" data-value-separator="<?php echo $detailed_action_grid->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailed_action_grid->RowIndex ?>_SectionCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_SectionCode"<?php echo $detailed_action_grid->SectionCode->editAttributes() ?>>
			<?php echo $detailed_action_grid->SectionCode->selectOptionListHtml("x{$detailed_action_grid->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $detailed_action_grid->SectionCode->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_SectionCode") ?>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_SectionCode" name="o<?php echo $detailed_action_grid->RowIndex ?>_SectionCode" id="o<?php echo $detailed_action_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($detailed_action_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_SectionCode" data-value-separator="<?php echo $detailed_action_grid->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailed_action_grid->RowIndex ?>_SectionCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_SectionCode"<?php echo $detailed_action_grid->SectionCode->editAttributes() ?>>
			<?php echo $detailed_action_grid->SectionCode->selectOptionListHtml("x{$detailed_action_grid->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $detailed_action_grid->SectionCode->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_SectionCode") ?>
</span>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_SectionCode">
<span<?php echo $detailed_action_grid->SectionCode->viewAttributes() ?>><?php echo $detailed_action_grid->SectionCode->getViewValue() ?></span>
</span>
<?php if (!$detailed_action->isConfirm()) { ?>
<input type="hidden" data-table="detailed_action" data-field="x_SectionCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_SectionCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($detailed_action_grid->SectionCode->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_SectionCode" name="o<?php echo $detailed_action_grid->RowIndex ?>_SectionCode" id="o<?php echo $detailed_action_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($detailed_action_grid->SectionCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailed_action" data-field="x_SectionCode" name="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_SectionCode" id="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($detailed_action_grid->SectionCode->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_SectionCode" name="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_SectionCode" id="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($detailed_action_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode" <?php echo $detailed_action_grid->ProgramCode->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($detailed_action_grid->ProgramCode->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_ProgramCode" class="form-group">
<span<?php echo $detailed_action_grid->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($detailed_action_grid->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_ProgramCode" class="form-group">
<?php $detailed_action_grid->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_ProgramCode" data-value-separator="<?php echo $detailed_action_grid->ProgramCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode"<?php echo $detailed_action_grid->ProgramCode->editAttributes() ?>>
			<?php echo $detailed_action_grid->ProgramCode->selectOptionListHtml("x{$detailed_action_grid->RowIndex}_ProgramCode") ?>
		</select>
</div>
<?php echo $detailed_action_grid->ProgramCode->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_ProgramCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_ProgramCode" name="o<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode" id="o<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($detailed_action_grid->ProgramCode->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($detailed_action_grid->ProgramCode->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_ProgramCode" class="form-group">
<span<?php echo $detailed_action_grid->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($detailed_action_grid->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_ProgramCode" class="form-group">
<?php $detailed_action_grid->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_ProgramCode" data-value-separator="<?php echo $detailed_action_grid->ProgramCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode"<?php echo $detailed_action_grid->ProgramCode->editAttributes() ?>>
			<?php echo $detailed_action_grid->ProgramCode->selectOptionListHtml("x{$detailed_action_grid->RowIndex}_ProgramCode") ?>
		</select>
</div>
<?php echo $detailed_action_grid->ProgramCode->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_ProgramCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_ProgramCode">
<span<?php echo $detailed_action_grid->ProgramCode->viewAttributes() ?>><?php echo $detailed_action_grid->ProgramCode->getViewValue() ?></span>
</span>
<?php if (!$detailed_action->isConfirm()) { ?>
<input type="hidden" data-table="detailed_action" data-field="x_ProgramCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($detailed_action_grid->ProgramCode->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_ProgramCode" name="o<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode" id="o<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($detailed_action_grid->ProgramCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailed_action" data-field="x_ProgramCode" name="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode" id="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($detailed_action_grid->ProgramCode->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_ProgramCode" name="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode" id="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($detailed_action_grid->ProgramCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->SubProgramCode->Visible) { // SubProgramCode ?>
		<td data-name="SubProgramCode" <?php echo $detailed_action_grid->SubProgramCode->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_SubProgramCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode"><?php echo EmptyValue(strval($detailed_action_grid->SubProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_grid->SubProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_grid->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_grid->SubProgramCode->ReadOnly || $detailed_action_grid->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_grid->SubProgramCode->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_SubProgramCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_grid->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode" value="<?php echo $detailed_action_grid->SubProgramCode->CurrentValue ?>"<?php echo $detailed_action_grid->SubProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_SubProgramCode" name="o<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode" id="o<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($detailed_action_grid->SubProgramCode->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_SubProgramCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode"><?php echo EmptyValue(strval($detailed_action_grid->SubProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_grid->SubProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_grid->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_grid->SubProgramCode->ReadOnly || $detailed_action_grid->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_grid->SubProgramCode->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_SubProgramCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_grid->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode" value="<?php echo $detailed_action_grid->SubProgramCode->CurrentValue ?>"<?php echo $detailed_action_grid->SubProgramCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_SubProgramCode">
<span<?php echo $detailed_action_grid->SubProgramCode->viewAttributes() ?>><?php echo $detailed_action_grid->SubProgramCode->getViewValue() ?></span>
</span>
<?php if (!$detailed_action->isConfirm()) { ?>
<input type="hidden" data-table="detailed_action" data-field="x_SubProgramCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($detailed_action_grid->SubProgramCode->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_SubProgramCode" name="o<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode" id="o<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($detailed_action_grid->SubProgramCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailed_action" data-field="x_SubProgramCode" name="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode" id="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($detailed_action_grid->SubProgramCode->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_SubProgramCode" name="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode" id="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($detailed_action_grid->SubProgramCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->OutcomeCode->Visible) { // OutcomeCode ?>
		<td data-name="OutcomeCode" <?php echo $detailed_action_grid->OutcomeCode->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($detailed_action_grid->OutcomeCode->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_OutcomeCode" class="form-group">
<span<?php echo $detailed_action_grid->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($detailed_action_grid->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_OutcomeCode" class="form-group">
<?php $detailed_action_grid->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode"><?php echo EmptyValue(strval($detailed_action_grid->OutcomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_grid->OutcomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_grid->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_grid->OutcomeCode->ReadOnly || $detailed_action_grid->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_grid->OutcomeCode->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_OutcomeCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_grid->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" value="<?php echo $detailed_action_grid->OutcomeCode->CurrentValue ?>"<?php echo $detailed_action_grid->OutcomeCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutcomeCode" name="o<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" id="o<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($detailed_action_grid->OutcomeCode->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($detailed_action_grid->OutcomeCode->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_OutcomeCode" class="form-group">
<span<?php echo $detailed_action_grid->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($detailed_action_grid->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_OutcomeCode" class="form-group">
<?php $detailed_action_grid->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode"><?php echo EmptyValue(strval($detailed_action_grid->OutcomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_grid->OutcomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_grid->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_grid->OutcomeCode->ReadOnly || $detailed_action_grid->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_grid->OutcomeCode->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_OutcomeCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_grid->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" value="<?php echo $detailed_action_grid->OutcomeCode->CurrentValue ?>"<?php echo $detailed_action_grid->OutcomeCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_OutcomeCode">
<span<?php echo $detailed_action_grid->OutcomeCode->viewAttributes() ?>><?php echo $detailed_action_grid->OutcomeCode->getViewValue() ?></span>
</span>
<?php if (!$detailed_action->isConfirm()) { ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutcomeCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($detailed_action_grid->OutcomeCode->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_OutcomeCode" name="o<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" id="o<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($detailed_action_grid->OutcomeCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutcomeCode" name="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" id="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($detailed_action_grid->OutcomeCode->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_OutcomeCode" name="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" id="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($detailed_action_grid->OutcomeCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode" <?php echo $detailed_action_grid->OutputCode->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($detailed_action_grid->OutputCode->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_OutputCode" class="form-group">
<span<?php echo $detailed_action_grid->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($detailed_action_grid->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_OutputCode" class="form-group">
<?php $detailed_action_grid->OutputCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailed_action_grid->RowIndex ?>_OutputCode"><?php echo EmptyValue(strval($detailed_action_grid->OutputCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_grid->OutputCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_grid->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_grid->OutputCode->ReadOnly || $detailed_action_grid->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_grid->RowIndex ?>_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_grid->OutputCode->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_OutputCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_grid->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" value="<?php echo $detailed_action_grid->OutputCode->CurrentValue ?>"<?php echo $detailed_action_grid->OutputCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutputCode" name="o<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" id="o<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($detailed_action_grid->OutputCode->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($detailed_action_grid->OutputCode->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_OutputCode" class="form-group">
<span<?php echo $detailed_action_grid->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($detailed_action_grid->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_OutputCode" class="form-group">
<?php $detailed_action_grid->OutputCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailed_action_grid->RowIndex ?>_OutputCode"><?php echo EmptyValue(strval($detailed_action_grid->OutputCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_grid->OutputCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_grid->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_grid->OutputCode->ReadOnly || $detailed_action_grid->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_grid->RowIndex ?>_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_grid->OutputCode->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_OutputCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_grid->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" value="<?php echo $detailed_action_grid->OutputCode->CurrentValue ?>"<?php echo $detailed_action_grid->OutputCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_OutputCode">
<span<?php echo $detailed_action_grid->OutputCode->viewAttributes() ?>><?php echo $detailed_action_grid->OutputCode->getViewValue() ?></span>
</span>
<?php if (!$detailed_action->isConfirm()) { ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutputCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($detailed_action_grid->OutputCode->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_OutputCode" name="o<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" id="o<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($detailed_action_grid->OutputCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutputCode" name="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" id="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($detailed_action_grid->OutputCode->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_OutputCode" name="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" id="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($detailed_action_grid->OutputCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->ActionCode->Visible) { // ActionCode ?>
		<td data-name="ActionCode" <?php echo $detailed_action_grid->ActionCode->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($detailed_action_grid->ActionCode->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_ActionCode" class="form-group">
<span<?php echo $detailed_action_grid->ActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->ActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($detailed_action_grid->ActionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_ActionCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailed_action_grid->RowIndex ?>_ActionCode"><?php echo EmptyValue(strval($detailed_action_grid->ActionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_grid->ActionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_grid->ActionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_grid->ActionCode->ReadOnly || $detailed_action_grid->ActionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_grid->RowIndex ?>_ActionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_grid->ActionCode->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_ActionCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_ActionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_grid->ActionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" value="<?php echo $detailed_action_grid->ActionCode->CurrentValue ?>"<?php echo $detailed_action_grid->ActionCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_ActionCode" name="o<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" id="o<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($detailed_action_grid->ActionCode->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($detailed_action_grid->ActionCode->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_ActionCode" class="form-group">
<span<?php echo $detailed_action_grid->ActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->ActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($detailed_action_grid->ActionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_ActionCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailed_action_grid->RowIndex ?>_ActionCode"><?php echo EmptyValue(strval($detailed_action_grid->ActionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_grid->ActionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_grid->ActionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_grid->ActionCode->ReadOnly || $detailed_action_grid->ActionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_grid->RowIndex ?>_ActionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_grid->ActionCode->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_ActionCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_ActionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_grid->ActionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" value="<?php echo $detailed_action_grid->ActionCode->CurrentValue ?>"<?php echo $detailed_action_grid->ActionCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_ActionCode">
<span<?php echo $detailed_action_grid->ActionCode->viewAttributes() ?>><?php echo $detailed_action_grid->ActionCode->getViewValue() ?></span>
</span>
<?php if (!$detailed_action->isConfirm()) { ?>
<input type="hidden" data-table="detailed_action" data-field="x_ActionCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($detailed_action_grid->ActionCode->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_ActionCode" name="o<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" id="o<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($detailed_action_grid->ActionCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailed_action" data-field="x_ActionCode" name="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" id="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($detailed_action_grid->ActionCode->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_ActionCode" name="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" id="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($detailed_action_grid->ActionCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear" <?php echo $detailed_action_grid->FinancialYear->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($detailed_action_grid->FinancialYear->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_FinancialYear" class="form-group">
<span<?php echo $detailed_action_grid->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" name="x<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($detailed_action_grid->FinancialYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_FinancialYear" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_FinancialYear" name="x<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" id="x<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($detailed_action_grid->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $detailed_action_grid->FinancialYear->EditValue ?>"<?php echo $detailed_action_grid->FinancialYear->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_FinancialYear" name="o<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" id="o<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($detailed_action_grid->FinancialYear->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($detailed_action_grid->FinancialYear->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_FinancialYear" class="form-group">
<span<?php echo $detailed_action_grid->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" name="x<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($detailed_action_grid->FinancialYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_FinancialYear" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_FinancialYear" name="x<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" id="x<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($detailed_action_grid->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $detailed_action_grid->FinancialYear->EditValue ?>"<?php echo $detailed_action_grid->FinancialYear->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_FinancialYear">
<span<?php echo $detailed_action_grid->FinancialYear->viewAttributes() ?>><?php echo $detailed_action_grid->FinancialYear->getViewValue() ?></span>
</span>
<?php if (!$detailed_action->isConfirm()) { ?>
<input type="hidden" data-table="detailed_action" data-field="x_FinancialYear" name="x<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" id="x<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($detailed_action_grid->FinancialYear->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_FinancialYear" name="o<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" id="o<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($detailed_action_grid->FinancialYear->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailed_action" data-field="x_FinancialYear" name="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" id="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($detailed_action_grid->FinancialYear->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_FinancialYear" name="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" id="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($detailed_action_grid->FinancialYear->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->DetailedActionCode->Visible) { // DetailedActionCode ?>
		<td data-name="DetailedActionCode" <?php echo $detailed_action_grid->DetailedActionCode->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_DetailedActionCode" class="form-group"></span>
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionCode" name="o<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionCode" id="o<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($detailed_action_grid->DetailedActionCode->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_DetailedActionCode" class="form-group">
<span<?php echo $detailed_action_grid->DetailedActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->DetailedActionCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($detailed_action_grid->DetailedActionCode->CurrentValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_DetailedActionCode">
<span<?php echo $detailed_action_grid->DetailedActionCode->viewAttributes() ?>><?php echo $detailed_action_grid->DetailedActionCode->getViewValue() ?></span>
</span>
<?php if (!$detailed_action->isConfirm()) { ?>
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($detailed_action_grid->DetailedActionCode->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionCode" name="o<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionCode" id="o<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($detailed_action_grid->DetailedActionCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionCode" name="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionCode" id="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($detailed_action_grid->DetailedActionCode->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionCode" name="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionCode" id="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($detailed_action_grid->DetailedActionCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->DetailedActionName->Visible) { // DetailedActionName ?>
		<td data-name="DetailedActionName" <?php echo $detailed_action_grid->DetailedActionName->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_DetailedActionName" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_DetailedActionName" name="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionName" id="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($detailed_action_grid->DetailedActionName->getPlaceHolder()) ?>" value="<?php echo $detailed_action_grid->DetailedActionName->EditValue ?>"<?php echo $detailed_action_grid->DetailedActionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionName" name="o<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionName" id="o<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionName" value="<?php echo HtmlEncode($detailed_action_grid->DetailedActionName->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_DetailedActionName" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_DetailedActionName" name="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionName" id="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($detailed_action_grid->DetailedActionName->getPlaceHolder()) ?>" value="<?php echo $detailed_action_grid->DetailedActionName->EditValue ?>"<?php echo $detailed_action_grid->DetailedActionName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_DetailedActionName">
<span<?php echo $detailed_action_grid->DetailedActionName->viewAttributes() ?>><?php echo $detailed_action_grid->DetailedActionName->getViewValue() ?></span>
</span>
<?php if (!$detailed_action->isConfirm()) { ?>
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionName" name="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionName" id="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionName" value="<?php echo HtmlEncode($detailed_action_grid->DetailedActionName->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionName" name="o<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionName" id="o<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionName" value="<?php echo HtmlEncode($detailed_action_grid->DetailedActionName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionName" name="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionName" id="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionName" value="<?php echo HtmlEncode($detailed_action_grid->DetailedActionName->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionName" name="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionName" id="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionName" value="<?php echo HtmlEncode($detailed_action_grid->DetailedActionName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->DetailedActionLocation->Visible) { // DetailedActionLocation ?>
		<td data-name="DetailedActionLocation" <?php echo $detailed_action_grid->DetailedActionLocation->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_DetailedActionLocation" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_DetailedActionLocation" name="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionLocation" id="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionLocation" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($detailed_action_grid->DetailedActionLocation->getPlaceHolder()) ?>" value="<?php echo $detailed_action_grid->DetailedActionLocation->EditValue ?>"<?php echo $detailed_action_grid->DetailedActionLocation->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionLocation" name="o<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionLocation" id="o<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionLocation" value="<?php echo HtmlEncode($detailed_action_grid->DetailedActionLocation->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_DetailedActionLocation" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_DetailedActionLocation" name="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionLocation" id="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionLocation" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($detailed_action_grid->DetailedActionLocation->getPlaceHolder()) ?>" value="<?php echo $detailed_action_grid->DetailedActionLocation->EditValue ?>"<?php echo $detailed_action_grid->DetailedActionLocation->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_DetailedActionLocation">
<span<?php echo $detailed_action_grid->DetailedActionLocation->viewAttributes() ?>><?php echo $detailed_action_grid->DetailedActionLocation->getViewValue() ?></span>
</span>
<?php if (!$detailed_action->isConfirm()) { ?>
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionLocation" name="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionLocation" id="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionLocation" value="<?php echo HtmlEncode($detailed_action_grid->DetailedActionLocation->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionLocation" name="o<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionLocation" id="o<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionLocation" value="<?php echo HtmlEncode($detailed_action_grid->DetailedActionLocation->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionLocation" name="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionLocation" id="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionLocation" value="<?php echo HtmlEncode($detailed_action_grid->DetailedActionLocation->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionLocation" name="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionLocation" id="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionLocation" value="<?php echo HtmlEncode($detailed_action_grid->DetailedActionLocation->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->PlannedStartDate->Visible) { // PlannedStartDate ?>
		<td data-name="PlannedStartDate" <?php echo $detailed_action_grid->PlannedStartDate->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_PlannedStartDate" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_PlannedStartDate" name="x<?php echo $detailed_action_grid->RowIndex ?>_PlannedStartDate" id="x<?php echo $detailed_action_grid->RowIndex ?>_PlannedStartDate" placeholder="<?php echo HtmlEncode($detailed_action_grid->PlannedStartDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_grid->PlannedStartDate->EditValue ?>"<?php echo $detailed_action_grid->PlannedStartDate->editAttributes() ?>>
<?php if (!$detailed_action_grid->PlannedStartDate->ReadOnly && !$detailed_action_grid->PlannedStartDate->Disabled && !isset($detailed_action_grid->PlannedStartDate->EditAttrs["readonly"]) && !isset($detailed_action_grid->PlannedStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actiongrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actiongrid", "x<?php echo $detailed_action_grid->RowIndex ?>_PlannedStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_PlannedStartDate" name="o<?php echo $detailed_action_grid->RowIndex ?>_PlannedStartDate" id="o<?php echo $detailed_action_grid->RowIndex ?>_PlannedStartDate" value="<?php echo HtmlEncode($detailed_action_grid->PlannedStartDate->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_PlannedStartDate" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_PlannedStartDate" name="x<?php echo $detailed_action_grid->RowIndex ?>_PlannedStartDate" id="x<?php echo $detailed_action_grid->RowIndex ?>_PlannedStartDate" placeholder="<?php echo HtmlEncode($detailed_action_grid->PlannedStartDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_grid->PlannedStartDate->EditValue ?>"<?php echo $detailed_action_grid->PlannedStartDate->editAttributes() ?>>
<?php if (!$detailed_action_grid->PlannedStartDate->ReadOnly && !$detailed_action_grid->PlannedStartDate->Disabled && !isset($detailed_action_grid->PlannedStartDate->EditAttrs["readonly"]) && !isset($detailed_action_grid->PlannedStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actiongrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actiongrid", "x<?php echo $detailed_action_grid->RowIndex ?>_PlannedStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_PlannedStartDate">
<span<?php echo $detailed_action_grid->PlannedStartDate->viewAttributes() ?>><?php echo $detailed_action_grid->PlannedStartDate->getViewValue() ?></span>
</span>
<?php if (!$detailed_action->isConfirm()) { ?>
<input type="hidden" data-table="detailed_action" data-field="x_PlannedStartDate" name="x<?php echo $detailed_action_grid->RowIndex ?>_PlannedStartDate" id="x<?php echo $detailed_action_grid->RowIndex ?>_PlannedStartDate" value="<?php echo HtmlEncode($detailed_action_grid->PlannedStartDate->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_PlannedStartDate" name="o<?php echo $detailed_action_grid->RowIndex ?>_PlannedStartDate" id="o<?php echo $detailed_action_grid->RowIndex ?>_PlannedStartDate" value="<?php echo HtmlEncode($detailed_action_grid->PlannedStartDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailed_action" data-field="x_PlannedStartDate" name="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_PlannedStartDate" id="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_PlannedStartDate" value="<?php echo HtmlEncode($detailed_action_grid->PlannedStartDate->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_PlannedStartDate" name="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_PlannedStartDate" id="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_PlannedStartDate" value="<?php echo HtmlEncode($detailed_action_grid->PlannedStartDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->PlannedEndDate->Visible) { // PlannedEndDate ?>
		<td data-name="PlannedEndDate" <?php echo $detailed_action_grid->PlannedEndDate->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_PlannedEndDate" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_PlannedEndDate" name="x<?php echo $detailed_action_grid->RowIndex ?>_PlannedEndDate" id="x<?php echo $detailed_action_grid->RowIndex ?>_PlannedEndDate" placeholder="<?php echo HtmlEncode($detailed_action_grid->PlannedEndDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_grid->PlannedEndDate->EditValue ?>"<?php echo $detailed_action_grid->PlannedEndDate->editAttributes() ?>>
<?php if (!$detailed_action_grid->PlannedEndDate->ReadOnly && !$detailed_action_grid->PlannedEndDate->Disabled && !isset($detailed_action_grid->PlannedEndDate->EditAttrs["readonly"]) && !isset($detailed_action_grid->PlannedEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actiongrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actiongrid", "x<?php echo $detailed_action_grid->RowIndex ?>_PlannedEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_PlannedEndDate" name="o<?php echo $detailed_action_grid->RowIndex ?>_PlannedEndDate" id="o<?php echo $detailed_action_grid->RowIndex ?>_PlannedEndDate" value="<?php echo HtmlEncode($detailed_action_grid->PlannedEndDate->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_PlannedEndDate" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_PlannedEndDate" name="x<?php echo $detailed_action_grid->RowIndex ?>_PlannedEndDate" id="x<?php echo $detailed_action_grid->RowIndex ?>_PlannedEndDate" placeholder="<?php echo HtmlEncode($detailed_action_grid->PlannedEndDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_grid->PlannedEndDate->EditValue ?>"<?php echo $detailed_action_grid->PlannedEndDate->editAttributes() ?>>
<?php if (!$detailed_action_grid->PlannedEndDate->ReadOnly && !$detailed_action_grid->PlannedEndDate->Disabled && !isset($detailed_action_grid->PlannedEndDate->EditAttrs["readonly"]) && !isset($detailed_action_grid->PlannedEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actiongrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actiongrid", "x<?php echo $detailed_action_grid->RowIndex ?>_PlannedEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_PlannedEndDate">
<span<?php echo $detailed_action_grid->PlannedEndDate->viewAttributes() ?>><?php echo $detailed_action_grid->PlannedEndDate->getViewValue() ?></span>
</span>
<?php if (!$detailed_action->isConfirm()) { ?>
<input type="hidden" data-table="detailed_action" data-field="x_PlannedEndDate" name="x<?php echo $detailed_action_grid->RowIndex ?>_PlannedEndDate" id="x<?php echo $detailed_action_grid->RowIndex ?>_PlannedEndDate" value="<?php echo HtmlEncode($detailed_action_grid->PlannedEndDate->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_PlannedEndDate" name="o<?php echo $detailed_action_grid->RowIndex ?>_PlannedEndDate" id="o<?php echo $detailed_action_grid->RowIndex ?>_PlannedEndDate" value="<?php echo HtmlEncode($detailed_action_grid->PlannedEndDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailed_action" data-field="x_PlannedEndDate" name="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_PlannedEndDate" id="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_PlannedEndDate" value="<?php echo HtmlEncode($detailed_action_grid->PlannedEndDate->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_PlannedEndDate" name="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_PlannedEndDate" id="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_PlannedEndDate" value="<?php echo HtmlEncode($detailed_action_grid->PlannedEndDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->ActualStartDate->Visible) { // ActualStartDate ?>
		<td data-name="ActualStartDate" <?php echo $detailed_action_grid->ActualStartDate->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_ActualStartDate" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_ActualStartDate" name="x<?php echo $detailed_action_grid->RowIndex ?>_ActualStartDate" id="x<?php echo $detailed_action_grid->RowIndex ?>_ActualStartDate" placeholder="<?php echo HtmlEncode($detailed_action_grid->ActualStartDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_grid->ActualStartDate->EditValue ?>"<?php echo $detailed_action_grid->ActualStartDate->editAttributes() ?>>
<?php if (!$detailed_action_grid->ActualStartDate->ReadOnly && !$detailed_action_grid->ActualStartDate->Disabled && !isset($detailed_action_grid->ActualStartDate->EditAttrs["readonly"]) && !isset($detailed_action_grid->ActualStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actiongrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actiongrid", "x<?php echo $detailed_action_grid->RowIndex ?>_ActualStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_ActualStartDate" name="o<?php echo $detailed_action_grid->RowIndex ?>_ActualStartDate" id="o<?php echo $detailed_action_grid->RowIndex ?>_ActualStartDate" value="<?php echo HtmlEncode($detailed_action_grid->ActualStartDate->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_ActualStartDate" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_ActualStartDate" name="x<?php echo $detailed_action_grid->RowIndex ?>_ActualStartDate" id="x<?php echo $detailed_action_grid->RowIndex ?>_ActualStartDate" placeholder="<?php echo HtmlEncode($detailed_action_grid->ActualStartDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_grid->ActualStartDate->EditValue ?>"<?php echo $detailed_action_grid->ActualStartDate->editAttributes() ?>>
<?php if (!$detailed_action_grid->ActualStartDate->ReadOnly && !$detailed_action_grid->ActualStartDate->Disabled && !isset($detailed_action_grid->ActualStartDate->EditAttrs["readonly"]) && !isset($detailed_action_grid->ActualStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actiongrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actiongrid", "x<?php echo $detailed_action_grid->RowIndex ?>_ActualStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_ActualStartDate">
<span<?php echo $detailed_action_grid->ActualStartDate->viewAttributes() ?>><?php echo $detailed_action_grid->ActualStartDate->getViewValue() ?></span>
</span>
<?php if (!$detailed_action->isConfirm()) { ?>
<input type="hidden" data-table="detailed_action" data-field="x_ActualStartDate" name="x<?php echo $detailed_action_grid->RowIndex ?>_ActualStartDate" id="x<?php echo $detailed_action_grid->RowIndex ?>_ActualStartDate" value="<?php echo HtmlEncode($detailed_action_grid->ActualStartDate->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_ActualStartDate" name="o<?php echo $detailed_action_grid->RowIndex ?>_ActualStartDate" id="o<?php echo $detailed_action_grid->RowIndex ?>_ActualStartDate" value="<?php echo HtmlEncode($detailed_action_grid->ActualStartDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailed_action" data-field="x_ActualStartDate" name="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_ActualStartDate" id="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_ActualStartDate" value="<?php echo HtmlEncode($detailed_action_grid->ActualStartDate->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_ActualStartDate" name="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_ActualStartDate" id="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_ActualStartDate" value="<?php echo HtmlEncode($detailed_action_grid->ActualStartDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->ActualEndDate->Visible) { // ActualEndDate ?>
		<td data-name="ActualEndDate" <?php echo $detailed_action_grid->ActualEndDate->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_ActualEndDate" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_ActualEndDate" name="x<?php echo $detailed_action_grid->RowIndex ?>_ActualEndDate" id="x<?php echo $detailed_action_grid->RowIndex ?>_ActualEndDate" placeholder="<?php echo HtmlEncode($detailed_action_grid->ActualEndDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_grid->ActualEndDate->EditValue ?>"<?php echo $detailed_action_grid->ActualEndDate->editAttributes() ?>>
<?php if (!$detailed_action_grid->ActualEndDate->ReadOnly && !$detailed_action_grid->ActualEndDate->Disabled && !isset($detailed_action_grid->ActualEndDate->EditAttrs["readonly"]) && !isset($detailed_action_grid->ActualEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actiongrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actiongrid", "x<?php echo $detailed_action_grid->RowIndex ?>_ActualEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_ActualEndDate" name="o<?php echo $detailed_action_grid->RowIndex ?>_ActualEndDate" id="o<?php echo $detailed_action_grid->RowIndex ?>_ActualEndDate" value="<?php echo HtmlEncode($detailed_action_grid->ActualEndDate->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_ActualEndDate" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_ActualEndDate" name="x<?php echo $detailed_action_grid->RowIndex ?>_ActualEndDate" id="x<?php echo $detailed_action_grid->RowIndex ?>_ActualEndDate" placeholder="<?php echo HtmlEncode($detailed_action_grid->ActualEndDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_grid->ActualEndDate->EditValue ?>"<?php echo $detailed_action_grid->ActualEndDate->editAttributes() ?>>
<?php if (!$detailed_action_grid->ActualEndDate->ReadOnly && !$detailed_action_grid->ActualEndDate->Disabled && !isset($detailed_action_grid->ActualEndDate->EditAttrs["readonly"]) && !isset($detailed_action_grid->ActualEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actiongrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actiongrid", "x<?php echo $detailed_action_grid->RowIndex ?>_ActualEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_ActualEndDate">
<span<?php echo $detailed_action_grid->ActualEndDate->viewAttributes() ?>><?php echo $detailed_action_grid->ActualEndDate->getViewValue() ?></span>
</span>
<?php if (!$detailed_action->isConfirm()) { ?>
<input type="hidden" data-table="detailed_action" data-field="x_ActualEndDate" name="x<?php echo $detailed_action_grid->RowIndex ?>_ActualEndDate" id="x<?php echo $detailed_action_grid->RowIndex ?>_ActualEndDate" value="<?php echo HtmlEncode($detailed_action_grid->ActualEndDate->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_ActualEndDate" name="o<?php echo $detailed_action_grid->RowIndex ?>_ActualEndDate" id="o<?php echo $detailed_action_grid->RowIndex ?>_ActualEndDate" value="<?php echo HtmlEncode($detailed_action_grid->ActualEndDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailed_action" data-field="x_ActualEndDate" name="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_ActualEndDate" id="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_ActualEndDate" value="<?php echo HtmlEncode($detailed_action_grid->ActualEndDate->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_ActualEndDate" name="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_ActualEndDate" id="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_ActualEndDate" value="<?php echo HtmlEncode($detailed_action_grid->ActualEndDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->Ward->Visible) { // Ward ?>
		<td data-name="Ward" <?php echo $detailed_action_grid->Ward->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_Ward" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_Ward" name="x<?php echo $detailed_action_grid->RowIndex ?>_Ward" id="x<?php echo $detailed_action_grid->RowIndex ?>_Ward" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($detailed_action_grid->Ward->getPlaceHolder()) ?>" value="<?php echo $detailed_action_grid->Ward->EditValue ?>"<?php echo $detailed_action_grid->Ward->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_Ward" name="o<?php echo $detailed_action_grid->RowIndex ?>_Ward" id="o<?php echo $detailed_action_grid->RowIndex ?>_Ward" value="<?php echo HtmlEncode($detailed_action_grid->Ward->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_Ward" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_Ward" name="x<?php echo $detailed_action_grid->RowIndex ?>_Ward" id="x<?php echo $detailed_action_grid->RowIndex ?>_Ward" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($detailed_action_grid->Ward->getPlaceHolder()) ?>" value="<?php echo $detailed_action_grid->Ward->EditValue ?>"<?php echo $detailed_action_grid->Ward->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_Ward">
<span<?php echo $detailed_action_grid->Ward->viewAttributes() ?>><?php echo $detailed_action_grid->Ward->getViewValue() ?></span>
</span>
<?php if (!$detailed_action->isConfirm()) { ?>
<input type="hidden" data-table="detailed_action" data-field="x_Ward" name="x<?php echo $detailed_action_grid->RowIndex ?>_Ward" id="x<?php echo $detailed_action_grid->RowIndex ?>_Ward" value="<?php echo HtmlEncode($detailed_action_grid->Ward->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_Ward" name="o<?php echo $detailed_action_grid->RowIndex ?>_Ward" id="o<?php echo $detailed_action_grid->RowIndex ?>_Ward" value="<?php echo HtmlEncode($detailed_action_grid->Ward->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailed_action" data-field="x_Ward" name="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_Ward" id="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_Ward" value="<?php echo HtmlEncode($detailed_action_grid->Ward->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_Ward" name="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_Ward" id="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_Ward" value="<?php echo HtmlEncode($detailed_action_grid->Ward->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->ExpectedResult->Visible) { // ExpectedResult ?>
		<td data-name="ExpectedResult" <?php echo $detailed_action_grid->ExpectedResult->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_ExpectedResult" class="form-group">
<textarea data-table="detailed_action" data-field="x_ExpectedResult" name="x<?php echo $detailed_action_grid->RowIndex ?>_ExpectedResult" id="x<?php echo $detailed_action_grid->RowIndex ?>_ExpectedResult" cols="35" rows="4" placeholder="<?php echo HtmlEncode($detailed_action_grid->ExpectedResult->getPlaceHolder()) ?>"<?php echo $detailed_action_grid->ExpectedResult->editAttributes() ?>><?php echo $detailed_action_grid->ExpectedResult->EditValue ?></textarea>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_ExpectedResult" name="o<?php echo $detailed_action_grid->RowIndex ?>_ExpectedResult" id="o<?php echo $detailed_action_grid->RowIndex ?>_ExpectedResult" value="<?php echo HtmlEncode($detailed_action_grid->ExpectedResult->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_ExpectedResult" class="form-group">
<textarea data-table="detailed_action" data-field="x_ExpectedResult" name="x<?php echo $detailed_action_grid->RowIndex ?>_ExpectedResult" id="x<?php echo $detailed_action_grid->RowIndex ?>_ExpectedResult" cols="35" rows="4" placeholder="<?php echo HtmlEncode($detailed_action_grid->ExpectedResult->getPlaceHolder()) ?>"<?php echo $detailed_action_grid->ExpectedResult->editAttributes() ?>><?php echo $detailed_action_grid->ExpectedResult->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_ExpectedResult">
<span<?php echo $detailed_action_grid->ExpectedResult->viewAttributes() ?>><?php echo $detailed_action_grid->ExpectedResult->getViewValue() ?></span>
</span>
<?php if (!$detailed_action->isConfirm()) { ?>
<input type="hidden" data-table="detailed_action" data-field="x_ExpectedResult" name="x<?php echo $detailed_action_grid->RowIndex ?>_ExpectedResult" id="x<?php echo $detailed_action_grid->RowIndex ?>_ExpectedResult" value="<?php echo HtmlEncode($detailed_action_grid->ExpectedResult->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_ExpectedResult" name="o<?php echo $detailed_action_grid->RowIndex ?>_ExpectedResult" id="o<?php echo $detailed_action_grid->RowIndex ?>_ExpectedResult" value="<?php echo HtmlEncode($detailed_action_grid->ExpectedResult->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailed_action" data-field="x_ExpectedResult" name="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_ExpectedResult" id="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_ExpectedResult" value="<?php echo HtmlEncode($detailed_action_grid->ExpectedResult->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_ExpectedResult" name="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_ExpectedResult" id="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_ExpectedResult" value="<?php echo HtmlEncode($detailed_action_grid->ExpectedResult->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->Comments->Visible) { // Comments ?>
		<td data-name="Comments" <?php echo $detailed_action_grid->Comments->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_Comments" class="form-group">
<textarea data-table="detailed_action" data-field="x_Comments" name="x<?php echo $detailed_action_grid->RowIndex ?>_Comments" id="x<?php echo $detailed_action_grid->RowIndex ?>_Comments" cols="35" rows="4" placeholder="<?php echo HtmlEncode($detailed_action_grid->Comments->getPlaceHolder()) ?>"<?php echo $detailed_action_grid->Comments->editAttributes() ?>><?php echo $detailed_action_grid->Comments->EditValue ?></textarea>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_Comments" name="o<?php echo $detailed_action_grid->RowIndex ?>_Comments" id="o<?php echo $detailed_action_grid->RowIndex ?>_Comments" value="<?php echo HtmlEncode($detailed_action_grid->Comments->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_Comments" class="form-group">
<textarea data-table="detailed_action" data-field="x_Comments" name="x<?php echo $detailed_action_grid->RowIndex ?>_Comments" id="x<?php echo $detailed_action_grid->RowIndex ?>_Comments" cols="35" rows="4" placeholder="<?php echo HtmlEncode($detailed_action_grid->Comments->getPlaceHolder()) ?>"<?php echo $detailed_action_grid->Comments->editAttributes() ?>><?php echo $detailed_action_grid->Comments->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_Comments">
<span<?php echo $detailed_action_grid->Comments->viewAttributes() ?>><?php echo $detailed_action_grid->Comments->getViewValue() ?></span>
</span>
<?php if (!$detailed_action->isConfirm()) { ?>
<input type="hidden" data-table="detailed_action" data-field="x_Comments" name="x<?php echo $detailed_action_grid->RowIndex ?>_Comments" id="x<?php echo $detailed_action_grid->RowIndex ?>_Comments" value="<?php echo HtmlEncode($detailed_action_grid->Comments->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_Comments" name="o<?php echo $detailed_action_grid->RowIndex ?>_Comments" id="o<?php echo $detailed_action_grid->RowIndex ?>_Comments" value="<?php echo HtmlEncode($detailed_action_grid->Comments->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailed_action" data-field="x_Comments" name="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_Comments" id="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_Comments" value="<?php echo HtmlEncode($detailed_action_grid->Comments->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_Comments" name="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_Comments" id="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_Comments" value="<?php echo HtmlEncode($detailed_action_grid->Comments->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->ProgressStatus->Visible) { // ProgressStatus ?>
		<td data-name="ProgressStatus" <?php echo $detailed_action_grid->ProgressStatus->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_ProgressStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_ProgressStatus" data-value-separator="<?php echo $detailed_action_grid->ProgressStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailed_action_grid->RowIndex ?>_ProgressStatus" name="x<?php echo $detailed_action_grid->RowIndex ?>_ProgressStatus"<?php echo $detailed_action_grid->ProgressStatus->editAttributes() ?>>
			<?php echo $detailed_action_grid->ProgressStatus->selectOptionListHtml("x{$detailed_action_grid->RowIndex}_ProgressStatus") ?>
		</select>
</div>
<?php echo $detailed_action_grid->ProgressStatus->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_ProgressStatus") ?>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_ProgressStatus" name="o<?php echo $detailed_action_grid->RowIndex ?>_ProgressStatus" id="o<?php echo $detailed_action_grid->RowIndex ?>_ProgressStatus" value="<?php echo HtmlEncode($detailed_action_grid->ProgressStatus->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_ProgressStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_ProgressStatus" data-value-separator="<?php echo $detailed_action_grid->ProgressStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailed_action_grid->RowIndex ?>_ProgressStatus" name="x<?php echo $detailed_action_grid->RowIndex ?>_ProgressStatus"<?php echo $detailed_action_grid->ProgressStatus->editAttributes() ?>>
			<?php echo $detailed_action_grid->ProgressStatus->selectOptionListHtml("x{$detailed_action_grid->RowIndex}_ProgressStatus") ?>
		</select>
</div>
<?php echo $detailed_action_grid->ProgressStatus->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_ProgressStatus") ?>
</span>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_grid->RowCount ?>_detailed_action_ProgressStatus">
<span<?php echo $detailed_action_grid->ProgressStatus->viewAttributes() ?>><?php echo $detailed_action_grid->ProgressStatus->getViewValue() ?></span>
</span>
<?php if (!$detailed_action->isConfirm()) { ?>
<input type="hidden" data-table="detailed_action" data-field="x_ProgressStatus" name="x<?php echo $detailed_action_grid->RowIndex ?>_ProgressStatus" id="x<?php echo $detailed_action_grid->RowIndex ?>_ProgressStatus" value="<?php echo HtmlEncode($detailed_action_grid->ProgressStatus->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_ProgressStatus" name="o<?php echo $detailed_action_grid->RowIndex ?>_ProgressStatus" id="o<?php echo $detailed_action_grid->RowIndex ?>_ProgressStatus" value="<?php echo HtmlEncode($detailed_action_grid->ProgressStatus->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailed_action" data-field="x_ProgressStatus" name="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_ProgressStatus" id="fdetailed_actiongrid$x<?php echo $detailed_action_grid->RowIndex ?>_ProgressStatus" value="<?php echo HtmlEncode($detailed_action_grid->ProgressStatus->FormValue) ?>">
<input type="hidden" data-table="detailed_action" data-field="x_ProgressStatus" name="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_ProgressStatus" id="fdetailed_actiongrid$o<?php echo $detailed_action_grid->RowIndex ?>_ProgressStatus" value="<?php echo HtmlEncode($detailed_action_grid->ProgressStatus->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailed_action_grid->ListOptions->render("body", "right", $detailed_action_grid->RowCount);
?>
	</tr>
<?php if ($detailed_action->RowType == ROWTYPE_ADD || $detailed_action->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdetailed_actiongrid", "load"], function() {
	fdetailed_actiongrid.updateLists(<?php echo $detailed_action_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$detailed_action_grid->isGridAdd() || $detailed_action->CurrentMode == "copy")
		if (!$detailed_action_grid->Recordset->EOF)
			$detailed_action_grid->Recordset->moveNext();
}
?>
<?php
	if ($detailed_action->CurrentMode == "add" || $detailed_action->CurrentMode == "copy" || $detailed_action->CurrentMode == "edit") {
		$detailed_action_grid->RowIndex = '$rowindex$';
		$detailed_action_grid->loadRowValues();

		// Set row properties
		$detailed_action->resetAttributes();
		$detailed_action->RowAttrs->merge(["data-rowindex" => $detailed_action_grid->RowIndex, "id" => "r0_detailed_action", "data-rowtype" => ROWTYPE_ADD]);
		$detailed_action->RowAttrs->appendClass("ew-template");
		$detailed_action->RowType = ROWTYPE_ADD;

		// Render row
		$detailed_action_grid->renderRow();

		// Render list options
		$detailed_action_grid->renderListOptions();
		$detailed_action_grid->StartRowCount = 0;
?>
	<tr <?php echo $detailed_action->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailed_action_grid->ListOptions->render("body", "left", $detailed_action_grid->RowIndex);
?>
	<?php if ($detailed_action_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if (!$detailed_action->isConfirm()) { ?>
<?php if ($detailed_action_grid->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_detailed_action_LACode" class="form-group detailed_action_LACode">
<span<?php echo $detailed_action_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_grid->RowIndex ?>_LACode" name="x<?php echo $detailed_action_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($detailed_action_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_detailed_action_LACode" class="form-group detailed_action_LACode">
<?php
$onchange = $detailed_action_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailed_action_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailed_action_grid->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailed_action_grid->RowIndex ?>_LACode" id="sv_x<?php echo $detailed_action_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($detailed_action_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($detailed_action_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailed_action_grid->LACode->getPlaceHolder()) ?>"<?php echo $detailed_action_grid->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_grid->RowIndex ?>_LACode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_grid->LACode->ReadOnly || $detailed_action_grid->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_grid->RowIndex ?>_LACode" id="x<?php echo $detailed_action_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($detailed_action_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailed_actiongrid"], function() {
	fdetailed_actiongrid.createAutoSuggest({"id":"x<?php echo $detailed_action_grid->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $detailed_action_grid->LACode->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_detailed_action_LACode" class="form-group detailed_action_LACode">
<span<?php echo $detailed_action_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_LACode" name="x<?php echo $detailed_action_grid->RowIndex ?>_LACode" id="x<?php echo $detailed_action_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($detailed_action_grid->LACode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_LACode" name="o<?php echo $detailed_action_grid->RowIndex ?>_LACode" id="o<?php echo $detailed_action_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($detailed_action_grid->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<?php if (!$detailed_action->isConfirm()) { ?>
<?php if ($detailed_action_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_detailed_action_DepartmentCode" class="form-group detailed_action_DepartmentCode">
<span<?php echo $detailed_action_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($detailed_action_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_detailed_action_DepartmentCode" class="form-group detailed_action_DepartmentCode">
<?php $detailed_action_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_DepartmentCode" data-value-separator="<?php echo $detailed_action_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode"<?php echo $detailed_action_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $detailed_action_grid->DepartmentCode->selectOptionListHtml("x{$detailed_action_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $detailed_action_grid->DepartmentCode->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_detailed_action_DepartmentCode" class="form-group detailed_action_DepartmentCode">
<span<?php echo $detailed_action_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_DepartmentCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($detailed_action_grid->DepartmentCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_DepartmentCode" name="o<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $detailed_action_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($detailed_action_grid->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode">
<?php if (!$detailed_action->isConfirm()) { ?>
<span id="el$rowindex$_detailed_action_SectionCode" class="form-group detailed_action_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_SectionCode" data-value-separator="<?php echo $detailed_action_grid->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailed_action_grid->RowIndex ?>_SectionCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_SectionCode"<?php echo $detailed_action_grid->SectionCode->editAttributes() ?>>
			<?php echo $detailed_action_grid->SectionCode->selectOptionListHtml("x{$detailed_action_grid->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $detailed_action_grid->SectionCode->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_SectionCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailed_action_SectionCode" class="form-group detailed_action_SectionCode">
<span<?php echo $detailed_action_grid->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_SectionCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_SectionCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($detailed_action_grid->SectionCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_SectionCode" name="o<?php echo $detailed_action_grid->RowIndex ?>_SectionCode" id="o<?php echo $detailed_action_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($detailed_action_grid->SectionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode">
<?php if (!$detailed_action->isConfirm()) { ?>
<?php if ($detailed_action_grid->ProgramCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_detailed_action_ProgramCode" class="form-group detailed_action_ProgramCode">
<span<?php echo $detailed_action_grid->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($detailed_action_grid->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_detailed_action_ProgramCode" class="form-group detailed_action_ProgramCode">
<?php $detailed_action_grid->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_ProgramCode" data-value-separator="<?php echo $detailed_action_grid->ProgramCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode"<?php echo $detailed_action_grid->ProgramCode->editAttributes() ?>>
			<?php echo $detailed_action_grid->ProgramCode->selectOptionListHtml("x{$detailed_action_grid->RowIndex}_ProgramCode") ?>
		</select>
</div>
<?php echo $detailed_action_grid->ProgramCode->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_ProgramCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_detailed_action_ProgramCode" class="form-group detailed_action_ProgramCode">
<span<?php echo $detailed_action_grid->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_ProgramCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($detailed_action_grid->ProgramCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_ProgramCode" name="o<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode" id="o<?php echo $detailed_action_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($detailed_action_grid->ProgramCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->SubProgramCode->Visible) { // SubProgramCode ?>
		<td data-name="SubProgramCode">
<?php if (!$detailed_action->isConfirm()) { ?>
<span id="el$rowindex$_detailed_action_SubProgramCode" class="form-group detailed_action_SubProgramCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode"><?php echo EmptyValue(strval($detailed_action_grid->SubProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_grid->SubProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_grid->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_grid->SubProgramCode->ReadOnly || $detailed_action_grid->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_grid->SubProgramCode->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_SubProgramCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_grid->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode" value="<?php echo $detailed_action_grid->SubProgramCode->CurrentValue ?>"<?php echo $detailed_action_grid->SubProgramCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailed_action_SubProgramCode" class="form-group detailed_action_SubProgramCode">
<span<?php echo $detailed_action_grid->SubProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->SubProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_SubProgramCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($detailed_action_grid->SubProgramCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_SubProgramCode" name="o<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode" id="o<?php echo $detailed_action_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($detailed_action_grid->SubProgramCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->OutcomeCode->Visible) { // OutcomeCode ?>
		<td data-name="OutcomeCode">
<?php if (!$detailed_action->isConfirm()) { ?>
<?php if ($detailed_action_grid->OutcomeCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_detailed_action_OutcomeCode" class="form-group detailed_action_OutcomeCode">
<span<?php echo $detailed_action_grid->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($detailed_action_grid->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_detailed_action_OutcomeCode" class="form-group detailed_action_OutcomeCode">
<?php $detailed_action_grid->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode"><?php echo EmptyValue(strval($detailed_action_grid->OutcomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_grid->OutcomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_grid->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_grid->OutcomeCode->ReadOnly || $detailed_action_grid->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_grid->OutcomeCode->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_OutcomeCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_grid->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" value="<?php echo $detailed_action_grid->OutcomeCode->CurrentValue ?>"<?php echo $detailed_action_grid->OutcomeCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_detailed_action_OutcomeCode" class="form-group detailed_action_OutcomeCode">
<span<?php echo $detailed_action_grid->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_OutcomeCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($detailed_action_grid->OutcomeCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutcomeCode" name="o<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" id="o<?php echo $detailed_action_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($detailed_action_grid->OutcomeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode">
<?php if (!$detailed_action->isConfirm()) { ?>
<?php if ($detailed_action_grid->OutputCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_detailed_action_OutputCode" class="form-group detailed_action_OutputCode">
<span<?php echo $detailed_action_grid->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($detailed_action_grid->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_detailed_action_OutputCode" class="form-group detailed_action_OutputCode">
<?php $detailed_action_grid->OutputCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailed_action_grid->RowIndex ?>_OutputCode"><?php echo EmptyValue(strval($detailed_action_grid->OutputCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_grid->OutputCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_grid->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_grid->OutputCode->ReadOnly || $detailed_action_grid->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_grid->RowIndex ?>_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_grid->OutputCode->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_OutputCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_grid->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" value="<?php echo $detailed_action_grid->OutputCode->CurrentValue ?>"<?php echo $detailed_action_grid->OutputCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_detailed_action_OutputCode" class="form-group detailed_action_OutputCode">
<span<?php echo $detailed_action_grid->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_OutputCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($detailed_action_grid->OutputCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutputCode" name="o<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" id="o<?php echo $detailed_action_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($detailed_action_grid->OutputCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->ActionCode->Visible) { // ActionCode ?>
		<td data-name="ActionCode">
<?php if (!$detailed_action->isConfirm()) { ?>
<?php if ($detailed_action_grid->ActionCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_detailed_action_ActionCode" class="form-group detailed_action_ActionCode">
<span<?php echo $detailed_action_grid->ActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->ActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($detailed_action_grid->ActionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_detailed_action_ActionCode" class="form-group detailed_action_ActionCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailed_action_grid->RowIndex ?>_ActionCode"><?php echo EmptyValue(strval($detailed_action_grid->ActionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_grid->ActionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_grid->ActionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_grid->ActionCode->ReadOnly || $detailed_action_grid->ActionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_grid->RowIndex ?>_ActionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_grid->ActionCode->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_ActionCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_ActionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_grid->ActionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" value="<?php echo $detailed_action_grid->ActionCode->CurrentValue ?>"<?php echo $detailed_action_grid->ActionCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_detailed_action_ActionCode" class="form-group detailed_action_ActionCode">
<span<?php echo $detailed_action_grid->ActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->ActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_ActionCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($detailed_action_grid->ActionCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_ActionCode" name="o<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" id="o<?php echo $detailed_action_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($detailed_action_grid->ActionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear">
<?php if (!$detailed_action->isConfirm()) { ?>
<?php if ($detailed_action_grid->FinancialYear->getSessionValue() != "") { ?>
<span id="el$rowindex$_detailed_action_FinancialYear" class="form-group detailed_action_FinancialYear">
<span<?php echo $detailed_action_grid->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" name="x<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($detailed_action_grid->FinancialYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_detailed_action_FinancialYear" class="form-group detailed_action_FinancialYear">
<input type="text" data-table="detailed_action" data-field="x_FinancialYear" name="x<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" id="x<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($detailed_action_grid->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $detailed_action_grid->FinancialYear->EditValue ?>"<?php echo $detailed_action_grid->FinancialYear->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_detailed_action_FinancialYear" class="form-group detailed_action_FinancialYear">
<span<?php echo $detailed_action_grid->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_FinancialYear" name="x<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" id="x<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($detailed_action_grid->FinancialYear->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_FinancialYear" name="o<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" id="o<?php echo $detailed_action_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($detailed_action_grid->FinancialYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->DetailedActionCode->Visible) { // DetailedActionCode ?>
		<td data-name="DetailedActionCode">
<?php if (!$detailed_action->isConfirm()) { ?>
<span id="el$rowindex$_detailed_action_DetailedActionCode" class="form-group detailed_action_DetailedActionCode"></span>
<?php } else { ?>
<span id="el$rowindex$_detailed_action_DetailedActionCode" class="form-group detailed_action_DetailedActionCode">
<span<?php echo $detailed_action_grid->DetailedActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->DetailedActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionCode" name="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionCode" id="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($detailed_action_grid->DetailedActionCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionCode" name="o<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionCode" id="o<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($detailed_action_grid->DetailedActionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->DetailedActionName->Visible) { // DetailedActionName ?>
		<td data-name="DetailedActionName">
<?php if (!$detailed_action->isConfirm()) { ?>
<span id="el$rowindex$_detailed_action_DetailedActionName" class="form-group detailed_action_DetailedActionName">
<input type="text" data-table="detailed_action" data-field="x_DetailedActionName" name="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionName" id="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($detailed_action_grid->DetailedActionName->getPlaceHolder()) ?>" value="<?php echo $detailed_action_grid->DetailedActionName->EditValue ?>"<?php echo $detailed_action_grid->DetailedActionName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailed_action_DetailedActionName" class="form-group detailed_action_DetailedActionName">
<span<?php echo $detailed_action_grid->DetailedActionName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->DetailedActionName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionName" name="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionName" id="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionName" value="<?php echo HtmlEncode($detailed_action_grid->DetailedActionName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionName" name="o<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionName" id="o<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionName" value="<?php echo HtmlEncode($detailed_action_grid->DetailedActionName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->DetailedActionLocation->Visible) { // DetailedActionLocation ?>
		<td data-name="DetailedActionLocation">
<?php if (!$detailed_action->isConfirm()) { ?>
<span id="el$rowindex$_detailed_action_DetailedActionLocation" class="form-group detailed_action_DetailedActionLocation">
<input type="text" data-table="detailed_action" data-field="x_DetailedActionLocation" name="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionLocation" id="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionLocation" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($detailed_action_grid->DetailedActionLocation->getPlaceHolder()) ?>" value="<?php echo $detailed_action_grid->DetailedActionLocation->EditValue ?>"<?php echo $detailed_action_grid->DetailedActionLocation->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailed_action_DetailedActionLocation" class="form-group detailed_action_DetailedActionLocation">
<span<?php echo $detailed_action_grid->DetailedActionLocation->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->DetailedActionLocation->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionLocation" name="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionLocation" id="x<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionLocation" value="<?php echo HtmlEncode($detailed_action_grid->DetailedActionLocation->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionLocation" name="o<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionLocation" id="o<?php echo $detailed_action_grid->RowIndex ?>_DetailedActionLocation" value="<?php echo HtmlEncode($detailed_action_grid->DetailedActionLocation->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->PlannedStartDate->Visible) { // PlannedStartDate ?>
		<td data-name="PlannedStartDate">
<?php if (!$detailed_action->isConfirm()) { ?>
<span id="el$rowindex$_detailed_action_PlannedStartDate" class="form-group detailed_action_PlannedStartDate">
<input type="text" data-table="detailed_action" data-field="x_PlannedStartDate" name="x<?php echo $detailed_action_grid->RowIndex ?>_PlannedStartDate" id="x<?php echo $detailed_action_grid->RowIndex ?>_PlannedStartDate" placeholder="<?php echo HtmlEncode($detailed_action_grid->PlannedStartDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_grid->PlannedStartDate->EditValue ?>"<?php echo $detailed_action_grid->PlannedStartDate->editAttributes() ?>>
<?php if (!$detailed_action_grid->PlannedStartDate->ReadOnly && !$detailed_action_grid->PlannedStartDate->Disabled && !isset($detailed_action_grid->PlannedStartDate->EditAttrs["readonly"]) && !isset($detailed_action_grid->PlannedStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actiongrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actiongrid", "x<?php echo $detailed_action_grid->RowIndex ?>_PlannedStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailed_action_PlannedStartDate" class="form-group detailed_action_PlannedStartDate">
<span<?php echo $detailed_action_grid->PlannedStartDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->PlannedStartDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_PlannedStartDate" name="x<?php echo $detailed_action_grid->RowIndex ?>_PlannedStartDate" id="x<?php echo $detailed_action_grid->RowIndex ?>_PlannedStartDate" value="<?php echo HtmlEncode($detailed_action_grid->PlannedStartDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_PlannedStartDate" name="o<?php echo $detailed_action_grid->RowIndex ?>_PlannedStartDate" id="o<?php echo $detailed_action_grid->RowIndex ?>_PlannedStartDate" value="<?php echo HtmlEncode($detailed_action_grid->PlannedStartDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->PlannedEndDate->Visible) { // PlannedEndDate ?>
		<td data-name="PlannedEndDate">
<?php if (!$detailed_action->isConfirm()) { ?>
<span id="el$rowindex$_detailed_action_PlannedEndDate" class="form-group detailed_action_PlannedEndDate">
<input type="text" data-table="detailed_action" data-field="x_PlannedEndDate" name="x<?php echo $detailed_action_grid->RowIndex ?>_PlannedEndDate" id="x<?php echo $detailed_action_grid->RowIndex ?>_PlannedEndDate" placeholder="<?php echo HtmlEncode($detailed_action_grid->PlannedEndDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_grid->PlannedEndDate->EditValue ?>"<?php echo $detailed_action_grid->PlannedEndDate->editAttributes() ?>>
<?php if (!$detailed_action_grid->PlannedEndDate->ReadOnly && !$detailed_action_grid->PlannedEndDate->Disabled && !isset($detailed_action_grid->PlannedEndDate->EditAttrs["readonly"]) && !isset($detailed_action_grid->PlannedEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actiongrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actiongrid", "x<?php echo $detailed_action_grid->RowIndex ?>_PlannedEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailed_action_PlannedEndDate" class="form-group detailed_action_PlannedEndDate">
<span<?php echo $detailed_action_grid->PlannedEndDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->PlannedEndDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_PlannedEndDate" name="x<?php echo $detailed_action_grid->RowIndex ?>_PlannedEndDate" id="x<?php echo $detailed_action_grid->RowIndex ?>_PlannedEndDate" value="<?php echo HtmlEncode($detailed_action_grid->PlannedEndDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_PlannedEndDate" name="o<?php echo $detailed_action_grid->RowIndex ?>_PlannedEndDate" id="o<?php echo $detailed_action_grid->RowIndex ?>_PlannedEndDate" value="<?php echo HtmlEncode($detailed_action_grid->PlannedEndDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->ActualStartDate->Visible) { // ActualStartDate ?>
		<td data-name="ActualStartDate">
<?php if (!$detailed_action->isConfirm()) { ?>
<span id="el$rowindex$_detailed_action_ActualStartDate" class="form-group detailed_action_ActualStartDate">
<input type="text" data-table="detailed_action" data-field="x_ActualStartDate" name="x<?php echo $detailed_action_grid->RowIndex ?>_ActualStartDate" id="x<?php echo $detailed_action_grid->RowIndex ?>_ActualStartDate" placeholder="<?php echo HtmlEncode($detailed_action_grid->ActualStartDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_grid->ActualStartDate->EditValue ?>"<?php echo $detailed_action_grid->ActualStartDate->editAttributes() ?>>
<?php if (!$detailed_action_grid->ActualStartDate->ReadOnly && !$detailed_action_grid->ActualStartDate->Disabled && !isset($detailed_action_grid->ActualStartDate->EditAttrs["readonly"]) && !isset($detailed_action_grid->ActualStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actiongrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actiongrid", "x<?php echo $detailed_action_grid->RowIndex ?>_ActualStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailed_action_ActualStartDate" class="form-group detailed_action_ActualStartDate">
<span<?php echo $detailed_action_grid->ActualStartDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->ActualStartDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_ActualStartDate" name="x<?php echo $detailed_action_grid->RowIndex ?>_ActualStartDate" id="x<?php echo $detailed_action_grid->RowIndex ?>_ActualStartDate" value="<?php echo HtmlEncode($detailed_action_grid->ActualStartDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_ActualStartDate" name="o<?php echo $detailed_action_grid->RowIndex ?>_ActualStartDate" id="o<?php echo $detailed_action_grid->RowIndex ?>_ActualStartDate" value="<?php echo HtmlEncode($detailed_action_grid->ActualStartDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->ActualEndDate->Visible) { // ActualEndDate ?>
		<td data-name="ActualEndDate">
<?php if (!$detailed_action->isConfirm()) { ?>
<span id="el$rowindex$_detailed_action_ActualEndDate" class="form-group detailed_action_ActualEndDate">
<input type="text" data-table="detailed_action" data-field="x_ActualEndDate" name="x<?php echo $detailed_action_grid->RowIndex ?>_ActualEndDate" id="x<?php echo $detailed_action_grid->RowIndex ?>_ActualEndDate" placeholder="<?php echo HtmlEncode($detailed_action_grid->ActualEndDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_grid->ActualEndDate->EditValue ?>"<?php echo $detailed_action_grid->ActualEndDate->editAttributes() ?>>
<?php if (!$detailed_action_grid->ActualEndDate->ReadOnly && !$detailed_action_grid->ActualEndDate->Disabled && !isset($detailed_action_grid->ActualEndDate->EditAttrs["readonly"]) && !isset($detailed_action_grid->ActualEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actiongrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actiongrid", "x<?php echo $detailed_action_grid->RowIndex ?>_ActualEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailed_action_ActualEndDate" class="form-group detailed_action_ActualEndDate">
<span<?php echo $detailed_action_grid->ActualEndDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->ActualEndDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_ActualEndDate" name="x<?php echo $detailed_action_grid->RowIndex ?>_ActualEndDate" id="x<?php echo $detailed_action_grid->RowIndex ?>_ActualEndDate" value="<?php echo HtmlEncode($detailed_action_grid->ActualEndDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_ActualEndDate" name="o<?php echo $detailed_action_grid->RowIndex ?>_ActualEndDate" id="o<?php echo $detailed_action_grid->RowIndex ?>_ActualEndDate" value="<?php echo HtmlEncode($detailed_action_grid->ActualEndDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->Ward->Visible) { // Ward ?>
		<td data-name="Ward">
<?php if (!$detailed_action->isConfirm()) { ?>
<span id="el$rowindex$_detailed_action_Ward" class="form-group detailed_action_Ward">
<input type="text" data-table="detailed_action" data-field="x_Ward" name="x<?php echo $detailed_action_grid->RowIndex ?>_Ward" id="x<?php echo $detailed_action_grid->RowIndex ?>_Ward" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($detailed_action_grid->Ward->getPlaceHolder()) ?>" value="<?php echo $detailed_action_grid->Ward->EditValue ?>"<?php echo $detailed_action_grid->Ward->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailed_action_Ward" class="form-group detailed_action_Ward">
<span<?php echo $detailed_action_grid->Ward->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->Ward->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_Ward" name="x<?php echo $detailed_action_grid->RowIndex ?>_Ward" id="x<?php echo $detailed_action_grid->RowIndex ?>_Ward" value="<?php echo HtmlEncode($detailed_action_grid->Ward->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_Ward" name="o<?php echo $detailed_action_grid->RowIndex ?>_Ward" id="o<?php echo $detailed_action_grid->RowIndex ?>_Ward" value="<?php echo HtmlEncode($detailed_action_grid->Ward->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->ExpectedResult->Visible) { // ExpectedResult ?>
		<td data-name="ExpectedResult">
<?php if (!$detailed_action->isConfirm()) { ?>
<span id="el$rowindex$_detailed_action_ExpectedResult" class="form-group detailed_action_ExpectedResult">
<textarea data-table="detailed_action" data-field="x_ExpectedResult" name="x<?php echo $detailed_action_grid->RowIndex ?>_ExpectedResult" id="x<?php echo $detailed_action_grid->RowIndex ?>_ExpectedResult" cols="35" rows="4" placeholder="<?php echo HtmlEncode($detailed_action_grid->ExpectedResult->getPlaceHolder()) ?>"<?php echo $detailed_action_grid->ExpectedResult->editAttributes() ?>><?php echo $detailed_action_grid->ExpectedResult->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailed_action_ExpectedResult" class="form-group detailed_action_ExpectedResult">
<span<?php echo $detailed_action_grid->ExpectedResult->viewAttributes() ?>><?php echo $detailed_action_grid->ExpectedResult->ViewValue ?></span>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_ExpectedResult" name="x<?php echo $detailed_action_grid->RowIndex ?>_ExpectedResult" id="x<?php echo $detailed_action_grid->RowIndex ?>_ExpectedResult" value="<?php echo HtmlEncode($detailed_action_grid->ExpectedResult->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_ExpectedResult" name="o<?php echo $detailed_action_grid->RowIndex ?>_ExpectedResult" id="o<?php echo $detailed_action_grid->RowIndex ?>_ExpectedResult" value="<?php echo HtmlEncode($detailed_action_grid->ExpectedResult->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->Comments->Visible) { // Comments ?>
		<td data-name="Comments">
<?php if (!$detailed_action->isConfirm()) { ?>
<span id="el$rowindex$_detailed_action_Comments" class="form-group detailed_action_Comments">
<textarea data-table="detailed_action" data-field="x_Comments" name="x<?php echo $detailed_action_grid->RowIndex ?>_Comments" id="x<?php echo $detailed_action_grid->RowIndex ?>_Comments" cols="35" rows="4" placeholder="<?php echo HtmlEncode($detailed_action_grid->Comments->getPlaceHolder()) ?>"<?php echo $detailed_action_grid->Comments->editAttributes() ?>><?php echo $detailed_action_grid->Comments->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailed_action_Comments" class="form-group detailed_action_Comments">
<span<?php echo $detailed_action_grid->Comments->viewAttributes() ?>><?php echo $detailed_action_grid->Comments->ViewValue ?></span>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_Comments" name="x<?php echo $detailed_action_grid->RowIndex ?>_Comments" id="x<?php echo $detailed_action_grid->RowIndex ?>_Comments" value="<?php echo HtmlEncode($detailed_action_grid->Comments->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_Comments" name="o<?php echo $detailed_action_grid->RowIndex ?>_Comments" id="o<?php echo $detailed_action_grid->RowIndex ?>_Comments" value="<?php echo HtmlEncode($detailed_action_grid->Comments->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_grid->ProgressStatus->Visible) { // ProgressStatus ?>
		<td data-name="ProgressStatus">
<?php if (!$detailed_action->isConfirm()) { ?>
<span id="el$rowindex$_detailed_action_ProgressStatus" class="form-group detailed_action_ProgressStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_ProgressStatus" data-value-separator="<?php echo $detailed_action_grid->ProgressStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailed_action_grid->RowIndex ?>_ProgressStatus" name="x<?php echo $detailed_action_grid->RowIndex ?>_ProgressStatus"<?php echo $detailed_action_grid->ProgressStatus->editAttributes() ?>>
			<?php echo $detailed_action_grid->ProgressStatus->selectOptionListHtml("x{$detailed_action_grid->RowIndex}_ProgressStatus") ?>
		</select>
</div>
<?php echo $detailed_action_grid->ProgressStatus->Lookup->getParamTag($detailed_action_grid, "p_x" . $detailed_action_grid->RowIndex . "_ProgressStatus") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailed_action_ProgressStatus" class="form-group detailed_action_ProgressStatus">
<span<?php echo $detailed_action_grid->ProgressStatus->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_grid->ProgressStatus->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_ProgressStatus" name="x<?php echo $detailed_action_grid->RowIndex ?>_ProgressStatus" id="x<?php echo $detailed_action_grid->RowIndex ?>_ProgressStatus" value="<?php echo HtmlEncode($detailed_action_grid->ProgressStatus->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_ProgressStatus" name="o<?php echo $detailed_action_grid->RowIndex ?>_ProgressStatus" id="o<?php echo $detailed_action_grid->RowIndex ?>_ProgressStatus" value="<?php echo HtmlEncode($detailed_action_grid->ProgressStatus->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailed_action_grid->ListOptions->render("body", "right", $detailed_action_grid->RowIndex);
?>
<script>
loadjs.ready(["fdetailed_actiongrid", "load"], function() {
	fdetailed_actiongrid.updateLists(<?php echo $detailed_action_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($detailed_action->CurrentMode == "add" || $detailed_action->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $detailed_action_grid->FormKeyCountName ?>" id="<?php echo $detailed_action_grid->FormKeyCountName ?>" value="<?php echo $detailed_action_grid->KeyCount ?>">
<?php echo $detailed_action_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailed_action->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $detailed_action_grid->FormKeyCountName ?>" id="<?php echo $detailed_action_grid->FormKeyCountName ?>" value="<?php echo $detailed_action_grid->KeyCount ?>">
<?php echo $detailed_action_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailed_action->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdetailed_actiongrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailed_action_grid->Recordset)
	$detailed_action_grid->Recordset->Close();
?>
<?php if ($detailed_action_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $detailed_action_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailed_action_grid->TotalRecords == 0 && !$detailed_action->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailed_action_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$detailed_action_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$detailed_action_grid->terminate();
?>