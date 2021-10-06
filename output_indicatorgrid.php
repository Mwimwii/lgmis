<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($output_indicator_grid))
	$output_indicator_grid = new output_indicator_grid();

// Run the page
$output_indicator_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$output_indicator_grid->Page_Render();
?>
<?php if (!$output_indicator_grid->isExport()) { ?>
<script>
var foutput_indicatorgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	foutput_indicatorgrid = new ew.Form("foutput_indicatorgrid", "grid");
	foutput_indicatorgrid.formKeyCountName = '<?php echo $output_indicator_grid->FormKeyCountName ?>';

	// Validate form
	foutput_indicatorgrid.validate = function() {
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
			<?php if ($output_indicator_grid->IndicatorNo->Required) { ?>
				elm = this.getElements("x" + infix + "_IndicatorNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_grid->IndicatorNo->caption(), $output_indicator_grid->IndicatorNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_indicator_grid->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_grid->LACode->caption(), $output_indicator_grid->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_indicator_grid->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_grid->DepartmentCode->caption(), $output_indicator_grid->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_grid->DepartmentCode->errorMessage()) ?>");
			<?php if ($output_indicator_grid->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_grid->SectionCode->caption(), $output_indicator_grid->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_grid->SectionCode->errorMessage()) ?>");
			<?php if ($output_indicator_grid->OutputCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_grid->OutputCode->caption(), $output_indicator_grid->OutputCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_grid->OutputCode->errorMessage()) ?>");
			<?php if ($output_indicator_grid->OutcomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_grid->OutcomeCode->caption(), $output_indicator_grid->OutcomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OutcomeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_grid->OutcomeCode->errorMessage()) ?>");
			<?php if ($output_indicator_grid->OutputType->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_grid->OutputType->caption(), $output_indicator_grid->OutputType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_indicator_grid->ProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_grid->ProgramCode->caption(), $output_indicator_grid->ProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_grid->ProgramCode->errorMessage()) ?>");
			<?php if ($output_indicator_grid->SubProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SubProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_grid->SubProgramCode->caption(), $output_indicator_grid->SubProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SubProgramCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_grid->SubProgramCode->errorMessage()) ?>");
			<?php if ($output_indicator_grid->FinancialYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_grid->FinancialYear->caption(), $output_indicator_grid->FinancialYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_grid->FinancialYear->errorMessage()) ?>");
			<?php if ($output_indicator_grid->OutputIndicatorName->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputIndicatorName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_grid->OutputIndicatorName->caption(), $output_indicator_grid->OutputIndicatorName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_indicator_grid->TargetAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_TargetAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_grid->TargetAmount->caption(), $output_indicator_grid->TargetAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TargetAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_grid->TargetAmount->errorMessage()) ?>");
			<?php if ($output_indicator_grid->ActualAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_grid->ActualAmount->caption(), $output_indicator_grid->ActualAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_grid->ActualAmount->errorMessage()) ?>");
			<?php if ($output_indicator_grid->PercentAchieved->Required) { ?>
				elm = this.getElements("x" + infix + "_PercentAchieved");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_grid->PercentAchieved->caption(), $output_indicator_grid->PercentAchieved->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PercentAchieved");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_grid->PercentAchieved->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	foutput_indicatorgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SectionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutputCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutcomeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutputType", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProgramCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SubProgramCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "FinancialYear", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutputIndicatorName", false)) return false;
		if (ew.valueChanged(fobj, infix, "TargetAmount", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActualAmount", false)) return false;
		if (ew.valueChanged(fobj, infix, "PercentAchieved", false)) return false;
		return true;
	}

	// Form_CustomValidate
	foutput_indicatorgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	foutput_indicatorgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	foutput_indicatorgrid.lists["x_LACode"] = <?php echo $output_indicator_grid->LACode->Lookup->toClientList($output_indicator_grid) ?>;
	foutput_indicatorgrid.lists["x_LACode"].options = <?php echo JsonEncode($output_indicator_grid->LACode->lookupOptions()) ?>;
	foutput_indicatorgrid.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatorgrid.lists["x_DepartmentCode"] = <?php echo $output_indicator_grid->DepartmentCode->Lookup->toClientList($output_indicator_grid) ?>;
	foutput_indicatorgrid.lists["x_DepartmentCode"].options = <?php echo JsonEncode($output_indicator_grid->DepartmentCode->lookupOptions()) ?>;
	foutput_indicatorgrid.autoSuggests["x_DepartmentCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatorgrid.lists["x_SectionCode"] = <?php echo $output_indicator_grid->SectionCode->Lookup->toClientList($output_indicator_grid) ?>;
	foutput_indicatorgrid.lists["x_SectionCode"].options = <?php echo JsonEncode($output_indicator_grid->SectionCode->lookupOptions()) ?>;
	foutput_indicatorgrid.autoSuggests["x_SectionCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatorgrid.lists["x_OutputCode"] = <?php echo $output_indicator_grid->OutputCode->Lookup->toClientList($output_indicator_grid) ?>;
	foutput_indicatorgrid.lists["x_OutputCode"].options = <?php echo JsonEncode($output_indicator_grid->OutputCode->lookupOptions()) ?>;
	foutput_indicatorgrid.autoSuggests["x_OutputCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatorgrid.lists["x_OutcomeCode"] = <?php echo $output_indicator_grid->OutcomeCode->Lookup->toClientList($output_indicator_grid) ?>;
	foutput_indicatorgrid.lists["x_OutcomeCode"].options = <?php echo JsonEncode($output_indicator_grid->OutcomeCode->lookupOptions()) ?>;
	foutput_indicatorgrid.autoSuggests["x_OutcomeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatorgrid.lists["x_OutputType"] = <?php echo $output_indicator_grid->OutputType->Lookup->toClientList($output_indicator_grid) ?>;
	foutput_indicatorgrid.lists["x_OutputType"].options = <?php echo JsonEncode($output_indicator_grid->OutputType->lookupOptions()) ?>;
	foutput_indicatorgrid.autoSuggests["x_OutputType"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatorgrid.lists["x_ProgramCode"] = <?php echo $output_indicator_grid->ProgramCode->Lookup->toClientList($output_indicator_grid) ?>;
	foutput_indicatorgrid.lists["x_ProgramCode"].options = <?php echo JsonEncode($output_indicator_grid->ProgramCode->lookupOptions()) ?>;
	foutput_indicatorgrid.autoSuggests["x_ProgramCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatorgrid.lists["x_SubProgramCode"] = <?php echo $output_indicator_grid->SubProgramCode->Lookup->toClientList($output_indicator_grid) ?>;
	foutput_indicatorgrid.lists["x_SubProgramCode"].options = <?php echo JsonEncode($output_indicator_grid->SubProgramCode->lookupOptions()) ?>;
	foutput_indicatorgrid.autoSuggests["x_SubProgramCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("foutput_indicatorgrid");
});
</script>
<?php } ?>
<?php
$output_indicator_grid->renderOtherOptions();
?>
<?php if ($output_indicator_grid->TotalRecords > 0 || $output_indicator->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($output_indicator_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> output_indicator">
<?php if ($output_indicator_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $output_indicator_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="foutput_indicatorgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_output_indicator" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_output_indicatorgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$output_indicator->RowType = ROWTYPE_HEADER;

// Render list options
$output_indicator_grid->renderListOptions();

// Render list options (header, left)
$output_indicator_grid->ListOptions->render("header", "left");
?>
<?php if ($output_indicator_grid->IndicatorNo->Visible) { // IndicatorNo ?>
	<?php if ($output_indicator_grid->SortUrl($output_indicator_grid->IndicatorNo) == "") { ?>
		<th data-name="IndicatorNo" class="<?php echo $output_indicator_grid->IndicatorNo->headerCellClass() ?>"><div id="elh_output_indicator_IndicatorNo" class="output_indicator_IndicatorNo"><div class="ew-table-header-caption"><?php echo $output_indicator_grid->IndicatorNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IndicatorNo" class="<?php echo $output_indicator_grid->IndicatorNo->headerCellClass() ?>"><div><div id="elh_output_indicator_IndicatorNo" class="output_indicator_IndicatorNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_grid->IndicatorNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_grid->IndicatorNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_grid->IndicatorNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_grid->LACode->Visible) { // LACode ?>
	<?php if ($output_indicator_grid->SortUrl($output_indicator_grid->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $output_indicator_grid->LACode->headerCellClass() ?>"><div id="elh_output_indicator_LACode" class="output_indicator_LACode"><div class="ew-table-header-caption"><?php echo $output_indicator_grid->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $output_indicator_grid->LACode->headerCellClass() ?>"><div><div id="elh_output_indicator_LACode" class="output_indicator_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_grid->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_grid->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_grid->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_grid->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($output_indicator_grid->SortUrl($output_indicator_grid->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $output_indicator_grid->DepartmentCode->headerCellClass() ?>"><div id="elh_output_indicator_DepartmentCode" class="output_indicator_DepartmentCode"><div class="ew-table-header-caption"><?php echo $output_indicator_grid->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $output_indicator_grid->DepartmentCode->headerCellClass() ?>"><div><div id="elh_output_indicator_DepartmentCode" class="output_indicator_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_grid->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_grid->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_grid->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_grid->SectionCode->Visible) { // SectionCode ?>
	<?php if ($output_indicator_grid->SortUrl($output_indicator_grid->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $output_indicator_grid->SectionCode->headerCellClass() ?>"><div id="elh_output_indicator_SectionCode" class="output_indicator_SectionCode"><div class="ew-table-header-caption"><?php echo $output_indicator_grid->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $output_indicator_grid->SectionCode->headerCellClass() ?>"><div><div id="elh_output_indicator_SectionCode" class="output_indicator_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_grid->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_grid->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_grid->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_grid->OutputCode->Visible) { // OutputCode ?>
	<?php if ($output_indicator_grid->SortUrl($output_indicator_grid->OutputCode) == "") { ?>
		<th data-name="OutputCode" class="<?php echo $output_indicator_grid->OutputCode->headerCellClass() ?>"><div id="elh_output_indicator_OutputCode" class="output_indicator_OutputCode"><div class="ew-table-header-caption"><?php echo $output_indicator_grid->OutputCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputCode" class="<?php echo $output_indicator_grid->OutputCode->headerCellClass() ?>"><div><div id="elh_output_indicator_OutputCode" class="output_indicator_OutputCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_grid->OutputCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_grid->OutputCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_grid->OutputCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_grid->OutcomeCode->Visible) { // OutcomeCode ?>
	<?php if ($output_indicator_grid->SortUrl($output_indicator_grid->OutcomeCode) == "") { ?>
		<th data-name="OutcomeCode" class="<?php echo $output_indicator_grid->OutcomeCode->headerCellClass() ?>"><div id="elh_output_indicator_OutcomeCode" class="output_indicator_OutcomeCode"><div class="ew-table-header-caption"><?php echo $output_indicator_grid->OutcomeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutcomeCode" class="<?php echo $output_indicator_grid->OutcomeCode->headerCellClass() ?>"><div><div id="elh_output_indicator_OutcomeCode" class="output_indicator_OutcomeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_grid->OutcomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_grid->OutcomeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_grid->OutcomeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_grid->OutputType->Visible) { // OutputType ?>
	<?php if ($output_indicator_grid->SortUrl($output_indicator_grid->OutputType) == "") { ?>
		<th data-name="OutputType" class="<?php echo $output_indicator_grid->OutputType->headerCellClass() ?>"><div id="elh_output_indicator_OutputType" class="output_indicator_OutputType"><div class="ew-table-header-caption"><?php echo $output_indicator_grid->OutputType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputType" class="<?php echo $output_indicator_grid->OutputType->headerCellClass() ?>"><div><div id="elh_output_indicator_OutputType" class="output_indicator_OutputType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_grid->OutputType->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_grid->OutputType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_grid->OutputType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_grid->ProgramCode->Visible) { // ProgramCode ?>
	<?php if ($output_indicator_grid->SortUrl($output_indicator_grid->ProgramCode) == "") { ?>
		<th data-name="ProgramCode" class="<?php echo $output_indicator_grid->ProgramCode->headerCellClass() ?>"><div id="elh_output_indicator_ProgramCode" class="output_indicator_ProgramCode"><div class="ew-table-header-caption"><?php echo $output_indicator_grid->ProgramCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgramCode" class="<?php echo $output_indicator_grid->ProgramCode->headerCellClass() ?>"><div><div id="elh_output_indicator_ProgramCode" class="output_indicator_ProgramCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_grid->ProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_grid->ProgramCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_grid->ProgramCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_grid->SubProgramCode->Visible) { // SubProgramCode ?>
	<?php if ($output_indicator_grid->SortUrl($output_indicator_grid->SubProgramCode) == "") { ?>
		<th data-name="SubProgramCode" class="<?php echo $output_indicator_grid->SubProgramCode->headerCellClass() ?>"><div id="elh_output_indicator_SubProgramCode" class="output_indicator_SubProgramCode"><div class="ew-table-header-caption"><?php echo $output_indicator_grid->SubProgramCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubProgramCode" class="<?php echo $output_indicator_grid->SubProgramCode->headerCellClass() ?>"><div><div id="elh_output_indicator_SubProgramCode" class="output_indicator_SubProgramCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_grid->SubProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_grid->SubProgramCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_grid->SubProgramCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_grid->FinancialYear->Visible) { // FinancialYear ?>
	<?php if ($output_indicator_grid->SortUrl($output_indicator_grid->FinancialYear) == "") { ?>
		<th data-name="FinancialYear" class="<?php echo $output_indicator_grid->FinancialYear->headerCellClass() ?>"><div id="elh_output_indicator_FinancialYear" class="output_indicator_FinancialYear"><div class="ew-table-header-caption"><?php echo $output_indicator_grid->FinancialYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FinancialYear" class="<?php echo $output_indicator_grid->FinancialYear->headerCellClass() ?>"><div><div id="elh_output_indicator_FinancialYear" class="output_indicator_FinancialYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_grid->FinancialYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_grid->FinancialYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_grid->FinancialYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_grid->OutputIndicatorName->Visible) { // OutputIndicatorName ?>
	<?php if ($output_indicator_grid->SortUrl($output_indicator_grid->OutputIndicatorName) == "") { ?>
		<th data-name="OutputIndicatorName" class="<?php echo $output_indicator_grid->OutputIndicatorName->headerCellClass() ?>"><div id="elh_output_indicator_OutputIndicatorName" class="output_indicator_OutputIndicatorName"><div class="ew-table-header-caption"><?php echo $output_indicator_grid->OutputIndicatorName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputIndicatorName" class="<?php echo $output_indicator_grid->OutputIndicatorName->headerCellClass() ?>"><div><div id="elh_output_indicator_OutputIndicatorName" class="output_indicator_OutputIndicatorName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_grid->OutputIndicatorName->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_grid->OutputIndicatorName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_grid->OutputIndicatorName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_grid->TargetAmount->Visible) { // TargetAmount ?>
	<?php if ($output_indicator_grid->SortUrl($output_indicator_grid->TargetAmount) == "") { ?>
		<th data-name="TargetAmount" class="<?php echo $output_indicator_grid->TargetAmount->headerCellClass() ?>"><div id="elh_output_indicator_TargetAmount" class="output_indicator_TargetAmount"><div class="ew-table-header-caption"><?php echo $output_indicator_grid->TargetAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TargetAmount" class="<?php echo $output_indicator_grid->TargetAmount->headerCellClass() ?>"><div><div id="elh_output_indicator_TargetAmount" class="output_indicator_TargetAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_grid->TargetAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_grid->TargetAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_grid->TargetAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_grid->ActualAmount->Visible) { // ActualAmount ?>
	<?php if ($output_indicator_grid->SortUrl($output_indicator_grid->ActualAmount) == "") { ?>
		<th data-name="ActualAmount" class="<?php echo $output_indicator_grid->ActualAmount->headerCellClass() ?>"><div id="elh_output_indicator_ActualAmount" class="output_indicator_ActualAmount"><div class="ew-table-header-caption"><?php echo $output_indicator_grid->ActualAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActualAmount" class="<?php echo $output_indicator_grid->ActualAmount->headerCellClass() ?>"><div><div id="elh_output_indicator_ActualAmount" class="output_indicator_ActualAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_grid->ActualAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_grid->ActualAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_grid->ActualAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_grid->PercentAchieved->Visible) { // PercentAchieved ?>
	<?php if ($output_indicator_grid->SortUrl($output_indicator_grid->PercentAchieved) == "") { ?>
		<th data-name="PercentAchieved" class="<?php echo $output_indicator_grid->PercentAchieved->headerCellClass() ?>"><div id="elh_output_indicator_PercentAchieved" class="output_indicator_PercentAchieved"><div class="ew-table-header-caption"><?php echo $output_indicator_grid->PercentAchieved->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PercentAchieved" class="<?php echo $output_indicator_grid->PercentAchieved->headerCellClass() ?>"><div><div id="elh_output_indicator_PercentAchieved" class="output_indicator_PercentAchieved">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_grid->PercentAchieved->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_grid->PercentAchieved->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_grid->PercentAchieved->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$output_indicator_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$output_indicator_grid->StartRecord = 1;
$output_indicator_grid->StopRecord = $output_indicator_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($output_indicator->isConfirm() || $output_indicator_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($output_indicator_grid->FormKeyCountName) && ($output_indicator_grid->isGridAdd() || $output_indicator_grid->isGridEdit() || $output_indicator->isConfirm())) {
		$output_indicator_grid->KeyCount = $CurrentForm->getValue($output_indicator_grid->FormKeyCountName);
		$output_indicator_grid->StopRecord = $output_indicator_grid->StartRecord + $output_indicator_grid->KeyCount - 1;
	}
}
$output_indicator_grid->RecordCount = $output_indicator_grid->StartRecord - 1;
if ($output_indicator_grid->Recordset && !$output_indicator_grid->Recordset->EOF) {
	$output_indicator_grid->Recordset->moveFirst();
	$selectLimit = $output_indicator_grid->UseSelectLimit;
	if (!$selectLimit && $output_indicator_grid->StartRecord > 1)
		$output_indicator_grid->Recordset->move($output_indicator_grid->StartRecord - 1);
} elseif (!$output_indicator->AllowAddDeleteRow && $output_indicator_grid->StopRecord == 0) {
	$output_indicator_grid->StopRecord = $output_indicator->GridAddRowCount;
}

// Initialize aggregate
$output_indicator->RowType = ROWTYPE_AGGREGATEINIT;
$output_indicator->resetAttributes();
$output_indicator_grid->renderRow();
if ($output_indicator_grid->isGridAdd())
	$output_indicator_grid->RowIndex = 0;
if ($output_indicator_grid->isGridEdit())
	$output_indicator_grid->RowIndex = 0;
while ($output_indicator_grid->RecordCount < $output_indicator_grid->StopRecord) {
	$output_indicator_grid->RecordCount++;
	if ($output_indicator_grid->RecordCount >= $output_indicator_grid->StartRecord) {
		$output_indicator_grid->RowCount++;
		if ($output_indicator_grid->isGridAdd() || $output_indicator_grid->isGridEdit() || $output_indicator->isConfirm()) {
			$output_indicator_grid->RowIndex++;
			$CurrentForm->Index = $output_indicator_grid->RowIndex;
			if ($CurrentForm->hasValue($output_indicator_grid->FormActionName) && ($output_indicator->isConfirm() || $output_indicator_grid->EventCancelled))
				$output_indicator_grid->RowAction = strval($CurrentForm->getValue($output_indicator_grid->FormActionName));
			elseif ($output_indicator_grid->isGridAdd())
				$output_indicator_grid->RowAction = "insert";
			else
				$output_indicator_grid->RowAction = "";
		}

		// Set up key count
		$output_indicator_grid->KeyCount = $output_indicator_grid->RowIndex;

		// Init row class and style
		$output_indicator->resetAttributes();
		$output_indicator->CssClass = "";
		if ($output_indicator_grid->isGridAdd()) {
			if ($output_indicator->CurrentMode == "copy") {
				$output_indicator_grid->loadRowValues($output_indicator_grid->Recordset); // Load row values
				$output_indicator_grid->setRecordKey($output_indicator_grid->RowOldKey, $output_indicator_grid->Recordset); // Set old record key
			} else {
				$output_indicator_grid->loadRowValues(); // Load default values
				$output_indicator_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$output_indicator_grid->loadRowValues($output_indicator_grid->Recordset); // Load row values
		}
		$output_indicator->RowType = ROWTYPE_VIEW; // Render view
		if ($output_indicator_grid->isGridAdd()) // Grid add
			$output_indicator->RowType = ROWTYPE_ADD; // Render add
		if ($output_indicator_grid->isGridAdd() && $output_indicator->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$output_indicator_grid->restoreCurrentRowFormValues($output_indicator_grid->RowIndex); // Restore form values
		if ($output_indicator_grid->isGridEdit()) { // Grid edit
			if ($output_indicator->EventCancelled)
				$output_indicator_grid->restoreCurrentRowFormValues($output_indicator_grid->RowIndex); // Restore form values
			if ($output_indicator_grid->RowAction == "insert")
				$output_indicator->RowType = ROWTYPE_ADD; // Render add
			else
				$output_indicator->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($output_indicator_grid->isGridEdit() && ($output_indicator->RowType == ROWTYPE_EDIT || $output_indicator->RowType == ROWTYPE_ADD) && $output_indicator->EventCancelled) // Update failed
			$output_indicator_grid->restoreCurrentRowFormValues($output_indicator_grid->RowIndex); // Restore form values
		if ($output_indicator->RowType == ROWTYPE_EDIT) // Edit row
			$output_indicator_grid->EditRowCount++;
		if ($output_indicator->isConfirm()) // Confirm row
			$output_indicator_grid->restoreCurrentRowFormValues($output_indicator_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$output_indicator->RowAttrs->merge(["data-rowindex" => $output_indicator_grid->RowCount, "id" => "r" . $output_indicator_grid->RowCount . "_output_indicator", "data-rowtype" => $output_indicator->RowType]);

		// Render row
		$output_indicator_grid->renderRow();

		// Render list options
		$output_indicator_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($output_indicator_grid->RowAction != "delete" && $output_indicator_grid->RowAction != "insertdelete" && !($output_indicator_grid->RowAction == "insert" && $output_indicator->isConfirm() && $output_indicator_grid->emptyRow())) {
?>
	<tr <?php echo $output_indicator->rowAttributes() ?>>
<?php

// Render list options (body, left)
$output_indicator_grid->ListOptions->render("body", "left", $output_indicator_grid->RowCount);
?>
	<?php if ($output_indicator_grid->IndicatorNo->Visible) { // IndicatorNo ?>
		<td data-name="IndicatorNo" <?php echo $output_indicator_grid->IndicatorNo->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_IndicatorNo" class="form-group"></span>
<input type="hidden" data-table="output_indicator" data-field="x_IndicatorNo" name="o<?php echo $output_indicator_grid->RowIndex ?>_IndicatorNo" id="o<?php echo $output_indicator_grid->RowIndex ?>_IndicatorNo" value="<?php echo HtmlEncode($output_indicator_grid->IndicatorNo->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_IndicatorNo" class="form-group">
<span<?php echo $output_indicator_grid->IndicatorNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->IndicatorNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_IndicatorNo" name="x<?php echo $output_indicator_grid->RowIndex ?>_IndicatorNo" id="x<?php echo $output_indicator_grid->RowIndex ?>_IndicatorNo" value="<?php echo HtmlEncode($output_indicator_grid->IndicatorNo->CurrentValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_IndicatorNo">
<span<?php echo $output_indicator_grid->IndicatorNo->viewAttributes() ?>><?php echo $output_indicator_grid->IndicatorNo->getViewValue() ?></span>
</span>
<?php if (!$output_indicator->isConfirm()) { ?>
<input type="hidden" data-table="output_indicator" data-field="x_IndicatorNo" name="x<?php echo $output_indicator_grid->RowIndex ?>_IndicatorNo" id="x<?php echo $output_indicator_grid->RowIndex ?>_IndicatorNo" value="<?php echo HtmlEncode($output_indicator_grid->IndicatorNo->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_IndicatorNo" name="o<?php echo $output_indicator_grid->RowIndex ?>_IndicatorNo" id="o<?php echo $output_indicator_grid->RowIndex ?>_IndicatorNo" value="<?php echo HtmlEncode($output_indicator_grid->IndicatorNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output_indicator" data-field="x_IndicatorNo" name="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_IndicatorNo" id="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_IndicatorNo" value="<?php echo HtmlEncode($output_indicator_grid->IndicatorNo->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_IndicatorNo" name="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_IndicatorNo" id="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_IndicatorNo" value="<?php echo HtmlEncode($output_indicator_grid->IndicatorNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $output_indicator_grid->LACode->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($output_indicator_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_LACode" class="form-group">
<span<?php echo $output_indicator_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_LACode" name="x<?php echo $output_indicator_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_indicator_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_LACode" class="form-group">
<?php
$onchange = $output_indicator_grid->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_grid->RowIndex ?>_LACode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_grid->RowIndex ?>_LACode" id="sv_x<?php echo $output_indicator_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($output_indicator_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($output_indicator_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_grid->LACode->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_LACode" data-value-separator="<?php echo $output_indicator_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_grid->RowIndex ?>_LACode" id="x<?php echo $output_indicator_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_indicator_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorgrid"], function() {
	foutput_indicatorgrid.createAutoSuggest({"id":"x<?php echo $output_indicator_grid->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $output_indicator_grid->LACode->Lookup->getParamTag($output_indicator_grid, "p_x" . $output_indicator_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="output_indicator" data-field="x_LACode" name="o<?php echo $output_indicator_grid->RowIndex ?>_LACode" id="o<?php echo $output_indicator_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_indicator_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($output_indicator_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_LACode" class="form-group">
<span<?php echo $output_indicator_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_LACode" name="x<?php echo $output_indicator_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_indicator_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_LACode" class="form-group">
<?php
$onchange = $output_indicator_grid->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_grid->RowIndex ?>_LACode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_grid->RowIndex ?>_LACode" id="sv_x<?php echo $output_indicator_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($output_indicator_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($output_indicator_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_grid->LACode->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_LACode" data-value-separator="<?php echo $output_indicator_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_grid->RowIndex ?>_LACode" id="x<?php echo $output_indicator_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_indicator_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorgrid"], function() {
	foutput_indicatorgrid.createAutoSuggest({"id":"x<?php echo $output_indicator_grid->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $output_indicator_grid->LACode->Lookup->getParamTag($output_indicator_grid, "p_x" . $output_indicator_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_LACode">
<span<?php echo $output_indicator_grid->LACode->viewAttributes() ?>><?php echo $output_indicator_grid->LACode->getViewValue() ?></span>
</span>
<?php if (!$output_indicator->isConfirm()) { ?>
<input type="hidden" data-table="output_indicator" data-field="x_LACode" name="x<?php echo $output_indicator_grid->RowIndex ?>_LACode" id="x<?php echo $output_indicator_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_indicator_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_LACode" name="o<?php echo $output_indicator_grid->RowIndex ?>_LACode" id="o<?php echo $output_indicator_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_indicator_grid->LACode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output_indicator" data-field="x_LACode" name="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_LACode" id="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_indicator_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_LACode" name="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_LACode" id="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_indicator_grid->LACode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $output_indicator_grid->DepartmentCode->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($output_indicator_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_DepartmentCode" class="form-group">
<span<?php echo $output_indicator_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_indicator_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_DepartmentCode" class="form-group">
<?php
$onchange = $output_indicator_grid->DepartmentCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_grid->DepartmentCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" id="sv_x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" value="<?php echo RemoveHtml($output_indicator_grid->DepartmentCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->DepartmentCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_grid->DepartmentCode->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->DepartmentCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_DepartmentCode" data-value-separator="<?php echo $output_indicator_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_indicator_grid->DepartmentCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorgrid"], function() {
	foutput_indicatorgrid.createAutoSuggest({"id":"x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_grid->DepartmentCode->Lookup->getParamTag($output_indicator_grid, "p_x" . $output_indicator_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="output_indicator" data-field="x_DepartmentCode" name="o<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_indicator_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($output_indicator_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_DepartmentCode" class="form-group">
<span<?php echo $output_indicator_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_indicator_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_DepartmentCode" class="form-group">
<?php
$onchange = $output_indicator_grid->DepartmentCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_grid->DepartmentCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" id="sv_x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" value="<?php echo RemoveHtml($output_indicator_grid->DepartmentCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->DepartmentCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_grid->DepartmentCode->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->DepartmentCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_DepartmentCode" data-value-separator="<?php echo $output_indicator_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_indicator_grid->DepartmentCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorgrid"], function() {
	foutput_indicatorgrid.createAutoSuggest({"id":"x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_grid->DepartmentCode->Lookup->getParamTag($output_indicator_grid, "p_x" . $output_indicator_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_DepartmentCode">
<span<?php echo $output_indicator_grid->DepartmentCode->viewAttributes() ?>><?php echo $output_indicator_grid->DepartmentCode->getViewValue() ?></span>
</span>
<?php if (!$output_indicator->isConfirm()) { ?>
<input type="hidden" data-table="output_indicator" data-field="x_DepartmentCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_indicator_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_DepartmentCode" name="o<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_indicator_grid->DepartmentCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output_indicator" data-field="x_DepartmentCode" name="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" id="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_indicator_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_DepartmentCode" name="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" id="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_indicator_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $output_indicator_grid->SectionCode->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($output_indicator_grid->SectionCode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_SectionCode" class="form-group">
<span<?php echo $output_indicator_grid->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_indicator_grid->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_SectionCode" class="form-group">
<?php
$onchange = $output_indicator_grid->SectionCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_grid->SectionCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" id="sv_x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" value="<?php echo RemoveHtml($output_indicator_grid->SectionCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->SectionCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_grid->SectionCode->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->SectionCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SectionCode" data-value-separator="<?php echo $output_indicator_grid->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_indicator_grid->SectionCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorgrid"], function() {
	foutput_indicatorgrid.createAutoSuggest({"id":"x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_grid->SectionCode->Lookup->getParamTag($output_indicator_grid, "p_x" . $output_indicator_grid->RowIndex . "_SectionCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="output_indicator" data-field="x_SectionCode" name="o<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" id="o<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_indicator_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($output_indicator_grid->SectionCode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_SectionCode" class="form-group">
<span<?php echo $output_indicator_grid->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_indicator_grid->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_SectionCode" class="form-group">
<?php
$onchange = $output_indicator_grid->SectionCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_grid->SectionCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" id="sv_x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" value="<?php echo RemoveHtml($output_indicator_grid->SectionCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->SectionCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_grid->SectionCode->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->SectionCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SectionCode" data-value-separator="<?php echo $output_indicator_grid->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_indicator_grid->SectionCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorgrid"], function() {
	foutput_indicatorgrid.createAutoSuggest({"id":"x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_grid->SectionCode->Lookup->getParamTag($output_indicator_grid, "p_x" . $output_indicator_grid->RowIndex . "_SectionCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_SectionCode">
<span<?php echo $output_indicator_grid->SectionCode->viewAttributes() ?>><?php echo $output_indicator_grid->SectionCode->getViewValue() ?></span>
</span>
<?php if (!$output_indicator->isConfirm()) { ?>
<input type="hidden" data-table="output_indicator" data-field="x_SectionCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_indicator_grid->SectionCode->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_SectionCode" name="o<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" id="o<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_indicator_grid->SectionCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output_indicator" data-field="x_SectionCode" name="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" id="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_indicator_grid->SectionCode->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_SectionCode" name="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" id="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_indicator_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode" <?php echo $output_indicator_grid->OutputCode->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($output_indicator_grid->OutputCode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_OutputCode" class="form-group">
<span<?php echo $output_indicator_grid->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_indicator_grid->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_OutputCode" class="form-group">
<?php
$onchange = $output_indicator_grid->OutputCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_grid->OutputCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" id="sv_x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" value="<?php echo RemoveHtml($output_indicator_grid->OutputCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->OutputCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_grid->OutputCode->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->OutputCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputCode" data-value-separator="<?php echo $output_indicator_grid->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_indicator_grid->OutputCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorgrid"], function() {
	foutput_indicatorgrid.createAutoSuggest({"id":"x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_grid->OutputCode->Lookup->getParamTag($output_indicator_grid, "p_x" . $output_indicator_grid->RowIndex . "_OutputCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="output_indicator" data-field="x_OutputCode" name="o<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" id="o<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_indicator_grid->OutputCode->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($output_indicator_grid->OutputCode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_OutputCode" class="form-group">
<span<?php echo $output_indicator_grid->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_indicator_grid->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_OutputCode" class="form-group">
<?php
$onchange = $output_indicator_grid->OutputCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_grid->OutputCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" id="sv_x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" value="<?php echo RemoveHtml($output_indicator_grid->OutputCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->OutputCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_grid->OutputCode->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->OutputCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputCode" data-value-separator="<?php echo $output_indicator_grid->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_indicator_grid->OutputCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorgrid"], function() {
	foutput_indicatorgrid.createAutoSuggest({"id":"x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_grid->OutputCode->Lookup->getParamTag($output_indicator_grid, "p_x" . $output_indicator_grid->RowIndex . "_OutputCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_OutputCode">
<span<?php echo $output_indicator_grid->OutputCode->viewAttributes() ?>><?php echo $output_indicator_grid->OutputCode->getViewValue() ?></span>
</span>
<?php if (!$output_indicator->isConfirm()) { ?>
<input type="hidden" data-table="output_indicator" data-field="x_OutputCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_indicator_grid->OutputCode->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_OutputCode" name="o<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" id="o<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_indicator_grid->OutputCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output_indicator" data-field="x_OutputCode" name="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" id="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_indicator_grid->OutputCode->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_OutputCode" name="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" id="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_indicator_grid->OutputCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->OutcomeCode->Visible) { // OutcomeCode ?>
		<td data-name="OutcomeCode" <?php echo $output_indicator_grid->OutcomeCode->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($output_indicator_grid->OutcomeCode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_OutcomeCode" class="form-group">
<span<?php echo $output_indicator_grid->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_indicator_grid->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_OutcomeCode" class="form-group">
<?php
$onchange = $output_indicator_grid->OutcomeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_grid->OutcomeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" id="sv_x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" value="<?php echo RemoveHtml($output_indicator_grid->OutcomeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->OutcomeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_grid->OutcomeCode->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->OutcomeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutcomeCode" data-value-separator="<?php echo $output_indicator_grid->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_indicator_grid->OutcomeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorgrid"], function() {
	foutput_indicatorgrid.createAutoSuggest({"id":"x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_grid->OutcomeCode->Lookup->getParamTag($output_indicator_grid, "p_x" . $output_indicator_grid->RowIndex . "_OutcomeCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="output_indicator" data-field="x_OutcomeCode" name="o<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" id="o<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_indicator_grid->OutcomeCode->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($output_indicator_grid->OutcomeCode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_OutcomeCode" class="form-group">
<span<?php echo $output_indicator_grid->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_indicator_grid->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_OutcomeCode" class="form-group">
<?php
$onchange = $output_indicator_grid->OutcomeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_grid->OutcomeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" id="sv_x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" value="<?php echo RemoveHtml($output_indicator_grid->OutcomeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->OutcomeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_grid->OutcomeCode->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->OutcomeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutcomeCode" data-value-separator="<?php echo $output_indicator_grid->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_indicator_grid->OutcomeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorgrid"], function() {
	foutput_indicatorgrid.createAutoSuggest({"id":"x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_grid->OutcomeCode->Lookup->getParamTag($output_indicator_grid, "p_x" . $output_indicator_grid->RowIndex . "_OutcomeCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_OutcomeCode">
<span<?php echo $output_indicator_grid->OutcomeCode->viewAttributes() ?>><?php echo $output_indicator_grid->OutcomeCode->getViewValue() ?></span>
</span>
<?php if (!$output_indicator->isConfirm()) { ?>
<input type="hidden" data-table="output_indicator" data-field="x_OutcomeCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_indicator_grid->OutcomeCode->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_OutcomeCode" name="o<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" id="o<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_indicator_grid->OutcomeCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output_indicator" data-field="x_OutcomeCode" name="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" id="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_indicator_grid->OutcomeCode->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_OutcomeCode" name="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" id="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_indicator_grid->OutcomeCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->OutputType->Visible) { // OutputType ?>
		<td data-name="OutputType" <?php echo $output_indicator_grid->OutputType->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($output_indicator_grid->OutputType->getSessionValue() != "") { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_OutputType" class="form-group">
<span<?php echo $output_indicator_grid->OutputType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->OutputType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutputType" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_indicator_grid->OutputType->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_OutputType" class="form-group">
<?php
$onchange = $output_indicator_grid->OutputType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_grid->OutputType->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_grid->RowIndex ?>_OutputType">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_grid->RowIndex ?>_OutputType" id="sv_x<?php echo $output_indicator_grid->RowIndex ?>_OutputType" value="<?php echo RemoveHtml($output_indicator_grid->OutputType->EditValue) ?>" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($output_indicator_grid->OutputType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_grid->OutputType->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->OutputType->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputType" data-value-separator="<?php echo $output_indicator_grid->OutputType->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutputType" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_indicator_grid->OutputType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorgrid"], function() {
	foutput_indicatorgrid.createAutoSuggest({"id":"x<?php echo $output_indicator_grid->RowIndex ?>_OutputType","forceSelect":false});
});
</script>
<?php echo $output_indicator_grid->OutputType->Lookup->getParamTag($output_indicator_grid, "p_x" . $output_indicator_grid->RowIndex . "_OutputType") ?>
</span>
<?php } ?>
<input type="hidden" data-table="output_indicator" data-field="x_OutputType" name="o<?php echo $output_indicator_grid->RowIndex ?>_OutputType" id="o<?php echo $output_indicator_grid->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_indicator_grid->OutputType->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($output_indicator_grid->OutputType->getSessionValue() != "") { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_OutputType" class="form-group">
<span<?php echo $output_indicator_grid->OutputType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->OutputType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutputType" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_indicator_grid->OutputType->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_OutputType" class="form-group">
<?php
$onchange = $output_indicator_grid->OutputType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_grid->OutputType->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_grid->RowIndex ?>_OutputType">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_grid->RowIndex ?>_OutputType" id="sv_x<?php echo $output_indicator_grid->RowIndex ?>_OutputType" value="<?php echo RemoveHtml($output_indicator_grid->OutputType->EditValue) ?>" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($output_indicator_grid->OutputType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_grid->OutputType->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->OutputType->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputType" data-value-separator="<?php echo $output_indicator_grid->OutputType->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutputType" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_indicator_grid->OutputType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorgrid"], function() {
	foutput_indicatorgrid.createAutoSuggest({"id":"x<?php echo $output_indicator_grid->RowIndex ?>_OutputType","forceSelect":false});
});
</script>
<?php echo $output_indicator_grid->OutputType->Lookup->getParamTag($output_indicator_grid, "p_x" . $output_indicator_grid->RowIndex . "_OutputType") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_OutputType">
<span<?php echo $output_indicator_grid->OutputType->viewAttributes() ?>><?php echo $output_indicator_grid->OutputType->getViewValue() ?></span>
</span>
<?php if (!$output_indicator->isConfirm()) { ?>
<input type="hidden" data-table="output_indicator" data-field="x_OutputType" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutputType" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_indicator_grid->OutputType->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_OutputType" name="o<?php echo $output_indicator_grid->RowIndex ?>_OutputType" id="o<?php echo $output_indicator_grid->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_indicator_grid->OutputType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output_indicator" data-field="x_OutputType" name="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_OutputType" id="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_indicator_grid->OutputType->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_OutputType" name="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_OutputType" id="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_indicator_grid->OutputType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode" <?php echo $output_indicator_grid->ProgramCode->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($output_indicator_grid->ProgramCode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_ProgramCode" class="form-group">
<span<?php echo $output_indicator_grid->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_ProgramCode" class="form-group">
<?php
$onchange = $output_indicator_grid->ProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_grid->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" id="sv_x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" value="<?php echo RemoveHtml($output_indicator_grid->ProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_grid->ProgramCode->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->ProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_ProgramCode" data-value-separator="<?php echo $output_indicator_grid->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorgrid"], function() {
	foutput_indicatorgrid.createAutoSuggest({"id":"x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_grid->ProgramCode->Lookup->getParamTag($output_indicator_grid, "p_x" . $output_indicator_grid->RowIndex . "_ProgramCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="output_indicator" data-field="x_ProgramCode" name="o<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" id="o<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->ProgramCode->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($output_indicator_grid->ProgramCode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_ProgramCode" class="form-group">
<span<?php echo $output_indicator_grid->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_ProgramCode" class="form-group">
<?php
$onchange = $output_indicator_grid->ProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_grid->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" id="sv_x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" value="<?php echo RemoveHtml($output_indicator_grid->ProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_grid->ProgramCode->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->ProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_ProgramCode" data-value-separator="<?php echo $output_indicator_grid->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorgrid"], function() {
	foutput_indicatorgrid.createAutoSuggest({"id":"x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_grid->ProgramCode->Lookup->getParamTag($output_indicator_grid, "p_x" . $output_indicator_grid->RowIndex . "_ProgramCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_ProgramCode">
<span<?php echo $output_indicator_grid->ProgramCode->viewAttributes() ?>><?php echo $output_indicator_grid->ProgramCode->getViewValue() ?></span>
</span>
<?php if (!$output_indicator->isConfirm()) { ?>
<input type="hidden" data-table="output_indicator" data-field="x_ProgramCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->ProgramCode->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_ProgramCode" name="o<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" id="o<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->ProgramCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output_indicator" data-field="x_ProgramCode" name="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" id="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->ProgramCode->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_ProgramCode" name="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" id="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->ProgramCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->SubProgramCode->Visible) { // SubProgramCode ?>
		<td data-name="SubProgramCode" <?php echo $output_indicator_grid->SubProgramCode->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($output_indicator_grid->SubProgramCode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_SubProgramCode" class="form-group">
<span<?php echo $output_indicator_grid->SubProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->SubProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->SubProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_SubProgramCode" class="form-group">
<?php
$onchange = $output_indicator_grid->SubProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_grid->SubProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" id="sv_x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" value="<?php echo RemoveHtml($output_indicator_grid->SubProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->SubProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_grid->SubProgramCode->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->SubProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SubProgramCode" data-value-separator="<?php echo $output_indicator_grid->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->SubProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorgrid"], function() {
	foutput_indicatorgrid.createAutoSuggest({"id":"x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_grid->SubProgramCode->Lookup->getParamTag($output_indicator_grid, "p_x" . $output_indicator_grid->RowIndex . "_SubProgramCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="output_indicator" data-field="x_SubProgramCode" name="o<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" id="o<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->SubProgramCode->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($output_indicator_grid->SubProgramCode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_SubProgramCode" class="form-group">
<span<?php echo $output_indicator_grid->SubProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->SubProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->SubProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_SubProgramCode" class="form-group">
<?php
$onchange = $output_indicator_grid->SubProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_grid->SubProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" id="sv_x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" value="<?php echo RemoveHtml($output_indicator_grid->SubProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->SubProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_grid->SubProgramCode->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->SubProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SubProgramCode" data-value-separator="<?php echo $output_indicator_grid->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->SubProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorgrid"], function() {
	foutput_indicatorgrid.createAutoSuggest({"id":"x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_grid->SubProgramCode->Lookup->getParamTag($output_indicator_grid, "p_x" . $output_indicator_grid->RowIndex . "_SubProgramCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_SubProgramCode">
<span<?php echo $output_indicator_grid->SubProgramCode->viewAttributes() ?>><?php echo $output_indicator_grid->SubProgramCode->getViewValue() ?></span>
</span>
<?php if (!$output_indicator->isConfirm()) { ?>
<input type="hidden" data-table="output_indicator" data-field="x_SubProgramCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->SubProgramCode->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_SubProgramCode" name="o<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" id="o<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->SubProgramCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output_indicator" data-field="x_SubProgramCode" name="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" id="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->SubProgramCode->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_SubProgramCode" name="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" id="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->SubProgramCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear" <?php echo $output_indicator_grid->FinancialYear->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($output_indicator_grid->FinancialYear->getSessionValue() != "") { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_FinancialYear" class="form-group">
<span<?php echo $output_indicator_grid->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" name="x<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($output_indicator_grid->FinancialYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_FinancialYear" class="form-group">
<input type="text" data-table="output_indicator" data-field="x_FinancialYear" name="x<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" id="x<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $output_indicator_grid->FinancialYear->EditValue ?>"<?php echo $output_indicator_grid->FinancialYear->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="output_indicator" data-field="x_FinancialYear" name="o<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" id="o<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($output_indicator_grid->FinancialYear->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($output_indicator_grid->FinancialYear->getSessionValue() != "") { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_FinancialYear" class="form-group">
<span<?php echo $output_indicator_grid->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" name="x<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($output_indicator_grid->FinancialYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_FinancialYear" class="form-group">
<input type="text" data-table="output_indicator" data-field="x_FinancialYear" name="x<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" id="x<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $output_indicator_grid->FinancialYear->EditValue ?>"<?php echo $output_indicator_grid->FinancialYear->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_FinancialYear">
<span<?php echo $output_indicator_grid->FinancialYear->viewAttributes() ?>><?php echo $output_indicator_grid->FinancialYear->getViewValue() ?></span>
</span>
<?php if (!$output_indicator->isConfirm()) { ?>
<input type="hidden" data-table="output_indicator" data-field="x_FinancialYear" name="x<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" id="x<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($output_indicator_grid->FinancialYear->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_FinancialYear" name="o<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" id="o<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($output_indicator_grid->FinancialYear->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output_indicator" data-field="x_FinancialYear" name="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" id="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($output_indicator_grid->FinancialYear->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_FinancialYear" name="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" id="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($output_indicator_grid->FinancialYear->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->OutputIndicatorName->Visible) { // OutputIndicatorName ?>
		<td data-name="OutputIndicatorName" <?php echo $output_indicator_grid->OutputIndicatorName->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_OutputIndicatorName" class="form-group">
<textarea data-table="output_indicator" data-field="x_OutputIndicatorName" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutputIndicatorName" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutputIndicatorName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_indicator_grid->OutputIndicatorName->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->OutputIndicatorName->editAttributes() ?>><?php echo $output_indicator_grid->OutputIndicatorName->EditValue ?></textarea>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputIndicatorName" name="o<?php echo $output_indicator_grid->RowIndex ?>_OutputIndicatorName" id="o<?php echo $output_indicator_grid->RowIndex ?>_OutputIndicatorName" value="<?php echo HtmlEncode($output_indicator_grid->OutputIndicatorName->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_OutputIndicatorName" class="form-group">
<textarea data-table="output_indicator" data-field="x_OutputIndicatorName" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutputIndicatorName" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutputIndicatorName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_indicator_grid->OutputIndicatorName->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->OutputIndicatorName->editAttributes() ?>><?php echo $output_indicator_grid->OutputIndicatorName->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_OutputIndicatorName">
<span<?php echo $output_indicator_grid->OutputIndicatorName->viewAttributes() ?>><?php echo $output_indicator_grid->OutputIndicatorName->getViewValue() ?></span>
</span>
<?php if (!$output_indicator->isConfirm()) { ?>
<input type="hidden" data-table="output_indicator" data-field="x_OutputIndicatorName" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutputIndicatorName" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutputIndicatorName" value="<?php echo HtmlEncode($output_indicator_grid->OutputIndicatorName->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_OutputIndicatorName" name="o<?php echo $output_indicator_grid->RowIndex ?>_OutputIndicatorName" id="o<?php echo $output_indicator_grid->RowIndex ?>_OutputIndicatorName" value="<?php echo HtmlEncode($output_indicator_grid->OutputIndicatorName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output_indicator" data-field="x_OutputIndicatorName" name="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_OutputIndicatorName" id="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_OutputIndicatorName" value="<?php echo HtmlEncode($output_indicator_grid->OutputIndicatorName->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_OutputIndicatorName" name="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_OutputIndicatorName" id="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_OutputIndicatorName" value="<?php echo HtmlEncode($output_indicator_grid->OutputIndicatorName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->TargetAmount->Visible) { // TargetAmount ?>
		<td data-name="TargetAmount" <?php echo $output_indicator_grid->TargetAmount->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_TargetAmount" class="form-group">
<input type="text" data-table="output_indicator" data-field="x_TargetAmount" name="x<?php echo $output_indicator_grid->RowIndex ?>_TargetAmount" id="x<?php echo $output_indicator_grid->RowIndex ?>_TargetAmount" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->TargetAmount->getPlaceHolder()) ?>" value="<?php echo $output_indicator_grid->TargetAmount->EditValue ?>"<?php echo $output_indicator_grid->TargetAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_TargetAmount" name="o<?php echo $output_indicator_grid->RowIndex ?>_TargetAmount" id="o<?php echo $output_indicator_grid->RowIndex ?>_TargetAmount" value="<?php echo HtmlEncode($output_indicator_grid->TargetAmount->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_TargetAmount" class="form-group">
<input type="text" data-table="output_indicator" data-field="x_TargetAmount" name="x<?php echo $output_indicator_grid->RowIndex ?>_TargetAmount" id="x<?php echo $output_indicator_grid->RowIndex ?>_TargetAmount" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->TargetAmount->getPlaceHolder()) ?>" value="<?php echo $output_indicator_grid->TargetAmount->EditValue ?>"<?php echo $output_indicator_grid->TargetAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_TargetAmount">
<span<?php echo $output_indicator_grid->TargetAmount->viewAttributes() ?>><?php echo $output_indicator_grid->TargetAmount->getViewValue() ?></span>
</span>
<?php if (!$output_indicator->isConfirm()) { ?>
<input type="hidden" data-table="output_indicator" data-field="x_TargetAmount" name="x<?php echo $output_indicator_grid->RowIndex ?>_TargetAmount" id="x<?php echo $output_indicator_grid->RowIndex ?>_TargetAmount" value="<?php echo HtmlEncode($output_indicator_grid->TargetAmount->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_TargetAmount" name="o<?php echo $output_indicator_grid->RowIndex ?>_TargetAmount" id="o<?php echo $output_indicator_grid->RowIndex ?>_TargetAmount" value="<?php echo HtmlEncode($output_indicator_grid->TargetAmount->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output_indicator" data-field="x_TargetAmount" name="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_TargetAmount" id="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_TargetAmount" value="<?php echo HtmlEncode($output_indicator_grid->TargetAmount->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_TargetAmount" name="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_TargetAmount" id="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_TargetAmount" value="<?php echo HtmlEncode($output_indicator_grid->TargetAmount->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->ActualAmount->Visible) { // ActualAmount ?>
		<td data-name="ActualAmount" <?php echo $output_indicator_grid->ActualAmount->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_ActualAmount" class="form-group">
<input type="text" data-table="output_indicator" data-field="x_ActualAmount" name="x<?php echo $output_indicator_grid->RowIndex ?>_ActualAmount" id="x<?php echo $output_indicator_grid->RowIndex ?>_ActualAmount" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $output_indicator_grid->ActualAmount->EditValue ?>"<?php echo $output_indicator_grid->ActualAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_ActualAmount" name="o<?php echo $output_indicator_grid->RowIndex ?>_ActualAmount" id="o<?php echo $output_indicator_grid->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($output_indicator_grid->ActualAmount->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_ActualAmount" class="form-group">
<input type="text" data-table="output_indicator" data-field="x_ActualAmount" name="x<?php echo $output_indicator_grid->RowIndex ?>_ActualAmount" id="x<?php echo $output_indicator_grid->RowIndex ?>_ActualAmount" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $output_indicator_grid->ActualAmount->EditValue ?>"<?php echo $output_indicator_grid->ActualAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_ActualAmount">
<span<?php echo $output_indicator_grid->ActualAmount->viewAttributes() ?>><?php echo $output_indicator_grid->ActualAmount->getViewValue() ?></span>
</span>
<?php if (!$output_indicator->isConfirm()) { ?>
<input type="hidden" data-table="output_indicator" data-field="x_ActualAmount" name="x<?php echo $output_indicator_grid->RowIndex ?>_ActualAmount" id="x<?php echo $output_indicator_grid->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($output_indicator_grid->ActualAmount->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_ActualAmount" name="o<?php echo $output_indicator_grid->RowIndex ?>_ActualAmount" id="o<?php echo $output_indicator_grid->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($output_indicator_grid->ActualAmount->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output_indicator" data-field="x_ActualAmount" name="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_ActualAmount" id="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($output_indicator_grid->ActualAmount->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_ActualAmount" name="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_ActualAmount" id="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($output_indicator_grid->ActualAmount->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->PercentAchieved->Visible) { // PercentAchieved ?>
		<td data-name="PercentAchieved" <?php echo $output_indicator_grid->PercentAchieved->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_PercentAchieved" class="form-group">
<input type="text" data-table="output_indicator" data-field="x_PercentAchieved" name="x<?php echo $output_indicator_grid->RowIndex ?>_PercentAchieved" id="x<?php echo $output_indicator_grid->RowIndex ?>_PercentAchieved" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->PercentAchieved->getPlaceHolder()) ?>" value="<?php echo $output_indicator_grid->PercentAchieved->EditValue ?>"<?php echo $output_indicator_grid->PercentAchieved->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_PercentAchieved" name="o<?php echo $output_indicator_grid->RowIndex ?>_PercentAchieved" id="o<?php echo $output_indicator_grid->RowIndex ?>_PercentAchieved" value="<?php echo HtmlEncode($output_indicator_grid->PercentAchieved->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_PercentAchieved" class="form-group">
<input type="text" data-table="output_indicator" data-field="x_PercentAchieved" name="x<?php echo $output_indicator_grid->RowIndex ?>_PercentAchieved" id="x<?php echo $output_indicator_grid->RowIndex ?>_PercentAchieved" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->PercentAchieved->getPlaceHolder()) ?>" value="<?php echo $output_indicator_grid->PercentAchieved->EditValue ?>"<?php echo $output_indicator_grid->PercentAchieved->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_grid->RowCount ?>_output_indicator_PercentAchieved">
<span<?php echo $output_indicator_grid->PercentAchieved->viewAttributes() ?>><?php echo $output_indicator_grid->PercentAchieved->getViewValue() ?></span>
</span>
<?php if (!$output_indicator->isConfirm()) { ?>
<input type="hidden" data-table="output_indicator" data-field="x_PercentAchieved" name="x<?php echo $output_indicator_grid->RowIndex ?>_PercentAchieved" id="x<?php echo $output_indicator_grid->RowIndex ?>_PercentAchieved" value="<?php echo HtmlEncode($output_indicator_grid->PercentAchieved->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_PercentAchieved" name="o<?php echo $output_indicator_grid->RowIndex ?>_PercentAchieved" id="o<?php echo $output_indicator_grid->RowIndex ?>_PercentAchieved" value="<?php echo HtmlEncode($output_indicator_grid->PercentAchieved->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output_indicator" data-field="x_PercentAchieved" name="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_PercentAchieved" id="foutput_indicatorgrid$x<?php echo $output_indicator_grid->RowIndex ?>_PercentAchieved" value="<?php echo HtmlEncode($output_indicator_grid->PercentAchieved->FormValue) ?>">
<input type="hidden" data-table="output_indicator" data-field="x_PercentAchieved" name="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_PercentAchieved" id="foutput_indicatorgrid$o<?php echo $output_indicator_grid->RowIndex ?>_PercentAchieved" value="<?php echo HtmlEncode($output_indicator_grid->PercentAchieved->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$output_indicator_grid->ListOptions->render("body", "right", $output_indicator_grid->RowCount);
?>
	</tr>
<?php if ($output_indicator->RowType == ROWTYPE_ADD || $output_indicator->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["foutput_indicatorgrid", "load"], function() {
	foutput_indicatorgrid.updateLists(<?php echo $output_indicator_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$output_indicator_grid->isGridAdd() || $output_indicator->CurrentMode == "copy")
		if (!$output_indicator_grid->Recordset->EOF)
			$output_indicator_grid->Recordset->moveNext();
}
?>
<?php
	if ($output_indicator->CurrentMode == "add" || $output_indicator->CurrentMode == "copy" || $output_indicator->CurrentMode == "edit") {
		$output_indicator_grid->RowIndex = '$rowindex$';
		$output_indicator_grid->loadRowValues();

		// Set row properties
		$output_indicator->resetAttributes();
		$output_indicator->RowAttrs->merge(["data-rowindex" => $output_indicator_grid->RowIndex, "id" => "r0_output_indicator", "data-rowtype" => ROWTYPE_ADD]);
		$output_indicator->RowAttrs->appendClass("ew-template");
		$output_indicator->RowType = ROWTYPE_ADD;

		// Render row
		$output_indicator_grid->renderRow();

		// Render list options
		$output_indicator_grid->renderListOptions();
		$output_indicator_grid->StartRowCount = 0;
?>
	<tr <?php echo $output_indicator->rowAttributes() ?>>
<?php

// Render list options (body, left)
$output_indicator_grid->ListOptions->render("body", "left", $output_indicator_grid->RowIndex);
?>
	<?php if ($output_indicator_grid->IndicatorNo->Visible) { // IndicatorNo ?>
		<td data-name="IndicatorNo">
<?php if (!$output_indicator->isConfirm()) { ?>
<span id="el$rowindex$_output_indicator_IndicatorNo" class="form-group output_indicator_IndicatorNo"></span>
<?php } else { ?>
<span id="el$rowindex$_output_indicator_IndicatorNo" class="form-group output_indicator_IndicatorNo">
<span<?php echo $output_indicator_grid->IndicatorNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->IndicatorNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_IndicatorNo" name="x<?php echo $output_indicator_grid->RowIndex ?>_IndicatorNo" id="x<?php echo $output_indicator_grid->RowIndex ?>_IndicatorNo" value="<?php echo HtmlEncode($output_indicator_grid->IndicatorNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output_indicator" data-field="x_IndicatorNo" name="o<?php echo $output_indicator_grid->RowIndex ?>_IndicatorNo" id="o<?php echo $output_indicator_grid->RowIndex ?>_IndicatorNo" value="<?php echo HtmlEncode($output_indicator_grid->IndicatorNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if (!$output_indicator->isConfirm()) { ?>
<?php if ($output_indicator_grid->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_output_indicator_LACode" class="form-group output_indicator_LACode">
<span<?php echo $output_indicator_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_LACode" name="x<?php echo $output_indicator_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_indicator_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_output_indicator_LACode" class="form-group output_indicator_LACode">
<?php
$onchange = $output_indicator_grid->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_grid->RowIndex ?>_LACode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_grid->RowIndex ?>_LACode" id="sv_x<?php echo $output_indicator_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($output_indicator_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($output_indicator_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_grid->LACode->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_LACode" data-value-separator="<?php echo $output_indicator_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_grid->RowIndex ?>_LACode" id="x<?php echo $output_indicator_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_indicator_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorgrid"], function() {
	foutput_indicatorgrid.createAutoSuggest({"id":"x<?php echo $output_indicator_grid->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $output_indicator_grid->LACode->Lookup->getParamTag($output_indicator_grid, "p_x" . $output_indicator_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_output_indicator_LACode" class="form-group output_indicator_LACode">
<span<?php echo $output_indicator_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_LACode" name="x<?php echo $output_indicator_grid->RowIndex ?>_LACode" id="x<?php echo $output_indicator_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_indicator_grid->LACode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output_indicator" data-field="x_LACode" name="o<?php echo $output_indicator_grid->RowIndex ?>_LACode" id="o<?php echo $output_indicator_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_indicator_grid->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<?php if (!$output_indicator->isConfirm()) { ?>
<?php if ($output_indicator_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_output_indicator_DepartmentCode" class="form-group output_indicator_DepartmentCode">
<span<?php echo $output_indicator_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_indicator_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_output_indicator_DepartmentCode" class="form-group output_indicator_DepartmentCode">
<?php
$onchange = $output_indicator_grid->DepartmentCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_grid->DepartmentCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" id="sv_x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" value="<?php echo RemoveHtml($output_indicator_grid->DepartmentCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->DepartmentCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_grid->DepartmentCode->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->DepartmentCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_DepartmentCode" data-value-separator="<?php echo $output_indicator_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_indicator_grid->DepartmentCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorgrid"], function() {
	foutput_indicatorgrid.createAutoSuggest({"id":"x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_grid->DepartmentCode->Lookup->getParamTag($output_indicator_grid, "p_x" . $output_indicator_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_output_indicator_DepartmentCode" class="form-group output_indicator_DepartmentCode">
<span<?php echo $output_indicator_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_DepartmentCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_indicator_grid->DepartmentCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output_indicator" data-field="x_DepartmentCode" name="o<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $output_indicator_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_indicator_grid->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode">
<?php if (!$output_indicator->isConfirm()) { ?>
<?php if ($output_indicator_grid->SectionCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_output_indicator_SectionCode" class="form-group output_indicator_SectionCode">
<span<?php echo $output_indicator_grid->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_indicator_grid->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_output_indicator_SectionCode" class="form-group output_indicator_SectionCode">
<?php
$onchange = $output_indicator_grid->SectionCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_grid->SectionCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" id="sv_x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" value="<?php echo RemoveHtml($output_indicator_grid->SectionCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->SectionCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_grid->SectionCode->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->SectionCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SectionCode" data-value-separator="<?php echo $output_indicator_grid->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_indicator_grid->SectionCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorgrid"], function() {
	foutput_indicatorgrid.createAutoSuggest({"id":"x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_grid->SectionCode->Lookup->getParamTag($output_indicator_grid, "p_x" . $output_indicator_grid->RowIndex . "_SectionCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_output_indicator_SectionCode" class="form-group output_indicator_SectionCode">
<span<?php echo $output_indicator_grid->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SectionCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_indicator_grid->SectionCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output_indicator" data-field="x_SectionCode" name="o<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" id="o<?php echo $output_indicator_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_indicator_grid->SectionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode">
<?php if (!$output_indicator->isConfirm()) { ?>
<?php if ($output_indicator_grid->OutputCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_output_indicator_OutputCode" class="form-group output_indicator_OutputCode">
<span<?php echo $output_indicator_grid->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_indicator_grid->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_output_indicator_OutputCode" class="form-group output_indicator_OutputCode">
<?php
$onchange = $output_indicator_grid->OutputCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_grid->OutputCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" id="sv_x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" value="<?php echo RemoveHtml($output_indicator_grid->OutputCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->OutputCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_grid->OutputCode->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->OutputCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputCode" data-value-separator="<?php echo $output_indicator_grid->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_indicator_grid->OutputCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorgrid"], function() {
	foutput_indicatorgrid.createAutoSuggest({"id":"x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_grid->OutputCode->Lookup->getParamTag($output_indicator_grid, "p_x" . $output_indicator_grid->RowIndex . "_OutputCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_output_indicator_OutputCode" class="form-group output_indicator_OutputCode">
<span<?php echo $output_indicator_grid->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_indicator_grid->OutputCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output_indicator" data-field="x_OutputCode" name="o<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" id="o<?php echo $output_indicator_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_indicator_grid->OutputCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->OutcomeCode->Visible) { // OutcomeCode ?>
		<td data-name="OutcomeCode">
<?php if (!$output_indicator->isConfirm()) { ?>
<?php if ($output_indicator_grid->OutcomeCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_output_indicator_OutcomeCode" class="form-group output_indicator_OutcomeCode">
<span<?php echo $output_indicator_grid->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_indicator_grid->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_output_indicator_OutcomeCode" class="form-group output_indicator_OutcomeCode">
<?php
$onchange = $output_indicator_grid->OutcomeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_grid->OutcomeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" id="sv_x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" value="<?php echo RemoveHtml($output_indicator_grid->OutcomeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->OutcomeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_grid->OutcomeCode->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->OutcomeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutcomeCode" data-value-separator="<?php echo $output_indicator_grid->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_indicator_grid->OutcomeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorgrid"], function() {
	foutput_indicatorgrid.createAutoSuggest({"id":"x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_grid->OutcomeCode->Lookup->getParamTag($output_indicator_grid, "p_x" . $output_indicator_grid->RowIndex . "_OutcomeCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_output_indicator_OutcomeCode" class="form-group output_indicator_OutcomeCode">
<span<?php echo $output_indicator_grid->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutcomeCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_indicator_grid->OutcomeCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output_indicator" data-field="x_OutcomeCode" name="o<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" id="o<?php echo $output_indicator_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_indicator_grid->OutcomeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->OutputType->Visible) { // OutputType ?>
		<td data-name="OutputType">
<?php if (!$output_indicator->isConfirm()) { ?>
<?php if ($output_indicator_grid->OutputType->getSessionValue() != "") { ?>
<span id="el$rowindex$_output_indicator_OutputType" class="form-group output_indicator_OutputType">
<span<?php echo $output_indicator_grid->OutputType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->OutputType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutputType" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_indicator_grid->OutputType->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_output_indicator_OutputType" class="form-group output_indicator_OutputType">
<?php
$onchange = $output_indicator_grid->OutputType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_grid->OutputType->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_grid->RowIndex ?>_OutputType">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_grid->RowIndex ?>_OutputType" id="sv_x<?php echo $output_indicator_grid->RowIndex ?>_OutputType" value="<?php echo RemoveHtml($output_indicator_grid->OutputType->EditValue) ?>" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($output_indicator_grid->OutputType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_grid->OutputType->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->OutputType->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputType" data-value-separator="<?php echo $output_indicator_grid->OutputType->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutputType" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_indicator_grid->OutputType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorgrid"], function() {
	foutput_indicatorgrid.createAutoSuggest({"id":"x<?php echo $output_indicator_grid->RowIndex ?>_OutputType","forceSelect":false});
});
</script>
<?php echo $output_indicator_grid->OutputType->Lookup->getParamTag($output_indicator_grid, "p_x" . $output_indicator_grid->RowIndex . "_OutputType") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_output_indicator_OutputType" class="form-group output_indicator_OutputType">
<span<?php echo $output_indicator_grid->OutputType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->OutputType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputType" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutputType" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_indicator_grid->OutputType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output_indicator" data-field="x_OutputType" name="o<?php echo $output_indicator_grid->RowIndex ?>_OutputType" id="o<?php echo $output_indicator_grid->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_indicator_grid->OutputType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode">
<?php if (!$output_indicator->isConfirm()) { ?>
<?php if ($output_indicator_grid->ProgramCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_output_indicator_ProgramCode" class="form-group output_indicator_ProgramCode">
<span<?php echo $output_indicator_grid->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_output_indicator_ProgramCode" class="form-group output_indicator_ProgramCode">
<?php
$onchange = $output_indicator_grid->ProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_grid->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" id="sv_x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" value="<?php echo RemoveHtml($output_indicator_grid->ProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_grid->ProgramCode->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->ProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_ProgramCode" data-value-separator="<?php echo $output_indicator_grid->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorgrid"], function() {
	foutput_indicatorgrid.createAutoSuggest({"id":"x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_grid->ProgramCode->Lookup->getParamTag($output_indicator_grid, "p_x" . $output_indicator_grid->RowIndex . "_ProgramCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_output_indicator_ProgramCode" class="form-group output_indicator_ProgramCode">
<span<?php echo $output_indicator_grid->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_ProgramCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->ProgramCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output_indicator" data-field="x_ProgramCode" name="o<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" id="o<?php echo $output_indicator_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->ProgramCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->SubProgramCode->Visible) { // SubProgramCode ?>
		<td data-name="SubProgramCode">
<?php if (!$output_indicator->isConfirm()) { ?>
<?php if ($output_indicator_grid->SubProgramCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_output_indicator_SubProgramCode" class="form-group output_indicator_SubProgramCode">
<span<?php echo $output_indicator_grid->SubProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->SubProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->SubProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_output_indicator_SubProgramCode" class="form-group output_indicator_SubProgramCode">
<?php
$onchange = $output_indicator_grid->SubProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_grid->SubProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" id="sv_x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" value="<?php echo RemoveHtml($output_indicator_grid->SubProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->SubProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_grid->SubProgramCode->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->SubProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SubProgramCode" data-value-separator="<?php echo $output_indicator_grid->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->SubProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorgrid"], function() {
	foutput_indicatorgrid.createAutoSuggest({"id":"x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_grid->SubProgramCode->Lookup->getParamTag($output_indicator_grid, "p_x" . $output_indicator_grid->RowIndex . "_SubProgramCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_output_indicator_SubProgramCode" class="form-group output_indicator_SubProgramCode">
<span<?php echo $output_indicator_grid->SubProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->SubProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SubProgramCode" name="x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" id="x<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->SubProgramCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output_indicator" data-field="x_SubProgramCode" name="o<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" id="o<?php echo $output_indicator_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_indicator_grid->SubProgramCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear">
<?php if (!$output_indicator->isConfirm()) { ?>
<?php if ($output_indicator_grid->FinancialYear->getSessionValue() != "") { ?>
<span id="el$rowindex$_output_indicator_FinancialYear" class="form-group output_indicator_FinancialYear">
<span<?php echo $output_indicator_grid->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" name="x<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($output_indicator_grid->FinancialYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_output_indicator_FinancialYear" class="form-group output_indicator_FinancialYear">
<input type="text" data-table="output_indicator" data-field="x_FinancialYear" name="x<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" id="x<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $output_indicator_grid->FinancialYear->EditValue ?>"<?php echo $output_indicator_grid->FinancialYear->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_output_indicator_FinancialYear" class="form-group output_indicator_FinancialYear">
<span<?php echo $output_indicator_grid->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_FinancialYear" name="x<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" id="x<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($output_indicator_grid->FinancialYear->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output_indicator" data-field="x_FinancialYear" name="o<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" id="o<?php echo $output_indicator_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($output_indicator_grid->FinancialYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->OutputIndicatorName->Visible) { // OutputIndicatorName ?>
		<td data-name="OutputIndicatorName">
<?php if (!$output_indicator->isConfirm()) { ?>
<span id="el$rowindex$_output_indicator_OutputIndicatorName" class="form-group output_indicator_OutputIndicatorName">
<textarea data-table="output_indicator" data-field="x_OutputIndicatorName" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutputIndicatorName" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutputIndicatorName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_indicator_grid->OutputIndicatorName->getPlaceHolder()) ?>"<?php echo $output_indicator_grid->OutputIndicatorName->editAttributes() ?>><?php echo $output_indicator_grid->OutputIndicatorName->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_output_indicator_OutputIndicatorName" class="form-group output_indicator_OutputIndicatorName">
<span<?php echo $output_indicator_grid->OutputIndicatorName->viewAttributes() ?>><?php echo $output_indicator_grid->OutputIndicatorName->ViewValue ?></span>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputIndicatorName" name="x<?php echo $output_indicator_grid->RowIndex ?>_OutputIndicatorName" id="x<?php echo $output_indicator_grid->RowIndex ?>_OutputIndicatorName" value="<?php echo HtmlEncode($output_indicator_grid->OutputIndicatorName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output_indicator" data-field="x_OutputIndicatorName" name="o<?php echo $output_indicator_grid->RowIndex ?>_OutputIndicatorName" id="o<?php echo $output_indicator_grid->RowIndex ?>_OutputIndicatorName" value="<?php echo HtmlEncode($output_indicator_grid->OutputIndicatorName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->TargetAmount->Visible) { // TargetAmount ?>
		<td data-name="TargetAmount">
<?php if (!$output_indicator->isConfirm()) { ?>
<span id="el$rowindex$_output_indicator_TargetAmount" class="form-group output_indicator_TargetAmount">
<input type="text" data-table="output_indicator" data-field="x_TargetAmount" name="x<?php echo $output_indicator_grid->RowIndex ?>_TargetAmount" id="x<?php echo $output_indicator_grid->RowIndex ?>_TargetAmount" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->TargetAmount->getPlaceHolder()) ?>" value="<?php echo $output_indicator_grid->TargetAmount->EditValue ?>"<?php echo $output_indicator_grid->TargetAmount->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_output_indicator_TargetAmount" class="form-group output_indicator_TargetAmount">
<span<?php echo $output_indicator_grid->TargetAmount->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->TargetAmount->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_TargetAmount" name="x<?php echo $output_indicator_grid->RowIndex ?>_TargetAmount" id="x<?php echo $output_indicator_grid->RowIndex ?>_TargetAmount" value="<?php echo HtmlEncode($output_indicator_grid->TargetAmount->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output_indicator" data-field="x_TargetAmount" name="o<?php echo $output_indicator_grid->RowIndex ?>_TargetAmount" id="o<?php echo $output_indicator_grid->RowIndex ?>_TargetAmount" value="<?php echo HtmlEncode($output_indicator_grid->TargetAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->ActualAmount->Visible) { // ActualAmount ?>
		<td data-name="ActualAmount">
<?php if (!$output_indicator->isConfirm()) { ?>
<span id="el$rowindex$_output_indicator_ActualAmount" class="form-group output_indicator_ActualAmount">
<input type="text" data-table="output_indicator" data-field="x_ActualAmount" name="x<?php echo $output_indicator_grid->RowIndex ?>_ActualAmount" id="x<?php echo $output_indicator_grid->RowIndex ?>_ActualAmount" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $output_indicator_grid->ActualAmount->EditValue ?>"<?php echo $output_indicator_grid->ActualAmount->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_output_indicator_ActualAmount" class="form-group output_indicator_ActualAmount">
<span<?php echo $output_indicator_grid->ActualAmount->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->ActualAmount->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_ActualAmount" name="x<?php echo $output_indicator_grid->RowIndex ?>_ActualAmount" id="x<?php echo $output_indicator_grid->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($output_indicator_grid->ActualAmount->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output_indicator" data-field="x_ActualAmount" name="o<?php echo $output_indicator_grid->RowIndex ?>_ActualAmount" id="o<?php echo $output_indicator_grid->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($output_indicator_grid->ActualAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_grid->PercentAchieved->Visible) { // PercentAchieved ?>
		<td data-name="PercentAchieved">
<?php if (!$output_indicator->isConfirm()) { ?>
<span id="el$rowindex$_output_indicator_PercentAchieved" class="form-group output_indicator_PercentAchieved">
<input type="text" data-table="output_indicator" data-field="x_PercentAchieved" name="x<?php echo $output_indicator_grid->RowIndex ?>_PercentAchieved" id="x<?php echo $output_indicator_grid->RowIndex ?>_PercentAchieved" size="30" placeholder="<?php echo HtmlEncode($output_indicator_grid->PercentAchieved->getPlaceHolder()) ?>" value="<?php echo $output_indicator_grid->PercentAchieved->EditValue ?>"<?php echo $output_indicator_grid->PercentAchieved->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_output_indicator_PercentAchieved" class="form-group output_indicator_PercentAchieved">
<span<?php echo $output_indicator_grid->PercentAchieved->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_grid->PercentAchieved->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_PercentAchieved" name="x<?php echo $output_indicator_grid->RowIndex ?>_PercentAchieved" id="x<?php echo $output_indicator_grid->RowIndex ?>_PercentAchieved" value="<?php echo HtmlEncode($output_indicator_grid->PercentAchieved->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output_indicator" data-field="x_PercentAchieved" name="o<?php echo $output_indicator_grid->RowIndex ?>_PercentAchieved" id="o<?php echo $output_indicator_grid->RowIndex ?>_PercentAchieved" value="<?php echo HtmlEncode($output_indicator_grid->PercentAchieved->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$output_indicator_grid->ListOptions->render("body", "right", $output_indicator_grid->RowIndex);
?>
<script>
loadjs.ready(["foutput_indicatorgrid", "load"], function() {
	foutput_indicatorgrid.updateLists(<?php echo $output_indicator_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($output_indicator->CurrentMode == "add" || $output_indicator->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $output_indicator_grid->FormKeyCountName ?>" id="<?php echo $output_indicator_grid->FormKeyCountName ?>" value="<?php echo $output_indicator_grid->KeyCount ?>">
<?php echo $output_indicator_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($output_indicator->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $output_indicator_grid->FormKeyCountName ?>" id="<?php echo $output_indicator_grid->FormKeyCountName ?>" value="<?php echo $output_indicator_grid->KeyCount ?>">
<?php echo $output_indicator_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($output_indicator->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="foutput_indicatorgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($output_indicator_grid->Recordset)
	$output_indicator_grid->Recordset->Close();
?>
<?php if ($output_indicator_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $output_indicator_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($output_indicator_grid->TotalRecords == 0 && !$output_indicator->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $output_indicator_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$output_indicator_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$output_indicator_grid->terminate();
?>