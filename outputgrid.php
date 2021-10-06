<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($output_grid))
	$output_grid = new output_grid();

// Run the page
$output_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$output_grid->Page_Render();
?>
<?php if (!$output_grid->isExport()) { ?>
<script>
var foutputgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	foutputgrid = new ew.Form("foutputgrid", "grid");
	foutputgrid.formKeyCountName = '<?php echo $output_grid->FormKeyCountName ?>';

	// Validate form
	foutputgrid.validate = function() {
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
			<?php if ($output_grid->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_grid->LACode->caption(), $output_grid->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_grid->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_grid->DepartmentCode->caption(), $output_grid->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_grid->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_grid->SectionCode->caption(), $output_grid->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_grid->OutcomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_grid->OutcomeCode->caption(), $output_grid->OutcomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_grid->ProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_grid->ProgramCode->caption(), $output_grid->ProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_grid->ProgramCode->errorMessage()) ?>");
			<?php if ($output_grid->SubProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SubProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_grid->SubProgramCode->caption(), $output_grid->SubProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_grid->OutputCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_grid->OutputCode->caption(), $output_grid->OutputCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_grid->OutputType->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_grid->OutputType->caption(), $output_grid->OutputType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_grid->OutputName->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_grid->OutputName->caption(), $output_grid->OutputName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_grid->DeliveryDate->Required) { ?>
				elm = this.getElements("x" + infix + "_DeliveryDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_grid->DeliveryDate->caption(), $output_grid->DeliveryDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DeliveryDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_grid->DeliveryDate->errorMessage()) ?>");
			<?php if ($output_grid->FinancialYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_grid->FinancialYear->caption(), $output_grid->FinancialYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_grid->FinancialYear->errorMessage()) ?>");
			<?php if ($output_grid->OutputDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_grid->OutputDescription->caption(), $output_grid->OutputDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_grid->OutputMeansOfVerification->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputMeansOfVerification");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_grid->OutputMeansOfVerification->caption(), $output_grid->OutputMeansOfVerification->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_grid->ResponsibleOfficer->Required) { ?>
				elm = this.getElements("x" + infix + "_ResponsibleOfficer");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_grid->ResponsibleOfficer->caption(), $output_grid->ResponsibleOfficer->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_grid->Clients->Required) { ?>
				elm = this.getElements("x" + infix + "_Clients");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_grid->Clients->caption(), $output_grid->Clients->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_grid->Beneficiaries->Required) { ?>
				elm = this.getElements("x" + infix + "_Beneficiaries");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_grid->Beneficiaries->caption(), $output_grid->Beneficiaries->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_grid->OutputStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_grid->OutputStatus->caption(), $output_grid->OutputStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_grid->TargetAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_TargetAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_grid->TargetAmount->caption(), $output_grid->TargetAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TargetAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_grid->TargetAmount->errorMessage()) ?>");
			<?php if ($output_grid->ActualAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_grid->ActualAmount->caption(), $output_grid->ActualAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_grid->ActualAmount->errorMessage()) ?>");
			<?php if ($output_grid->PercentAchieved->Required) { ?>
				elm = this.getElements("x" + infix + "_PercentAchieved");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_grid->PercentAchieved->caption(), $output_grid->PercentAchieved->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PercentAchieved");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_grid->PercentAchieved->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	foutputgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SectionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutcomeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProgramCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SubProgramCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutputType", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutputName", false)) return false;
		if (ew.valueChanged(fobj, infix, "DeliveryDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "FinancialYear", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutputDescription", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutputMeansOfVerification", false)) return false;
		if (ew.valueChanged(fobj, infix, "ResponsibleOfficer", false)) return false;
		if (ew.valueChanged(fobj, infix, "Clients", false)) return false;
		if (ew.valueChanged(fobj, infix, "Beneficiaries", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutputStatus", false)) return false;
		if (ew.valueChanged(fobj, infix, "TargetAmount", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActualAmount", false)) return false;
		if (ew.valueChanged(fobj, infix, "PercentAchieved", false)) return false;
		return true;
	}

	// Form_CustomValidate
	foutputgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	foutputgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	foutputgrid.lists["x_LACode"] = <?php echo $output_grid->LACode->Lookup->toClientList($output_grid) ?>;
	foutputgrid.lists["x_LACode"].options = <?php echo JsonEncode($output_grid->LACode->lookupOptions()) ?>;
	foutputgrid.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutputgrid.lists["x_DepartmentCode"] = <?php echo $output_grid->DepartmentCode->Lookup->toClientList($output_grid) ?>;
	foutputgrid.lists["x_DepartmentCode"].options = <?php echo JsonEncode($output_grid->DepartmentCode->lookupOptions()) ?>;
	foutputgrid.lists["x_SectionCode"] = <?php echo $output_grid->SectionCode->Lookup->toClientList($output_grid) ?>;
	foutputgrid.lists["x_SectionCode"].options = <?php echo JsonEncode($output_grid->SectionCode->lookupOptions()) ?>;
	foutputgrid.lists["x_OutcomeCode"] = <?php echo $output_grid->OutcomeCode->Lookup->toClientList($output_grid) ?>;
	foutputgrid.lists["x_OutcomeCode"].options = <?php echo JsonEncode($output_grid->OutcomeCode->lookupOptions()) ?>;
	foutputgrid.lists["x_ProgramCode"] = <?php echo $output_grid->ProgramCode->Lookup->toClientList($output_grid) ?>;
	foutputgrid.lists["x_ProgramCode"].options = <?php echo JsonEncode($output_grid->ProgramCode->lookupOptions()) ?>;
	foutputgrid.autoSuggests["x_ProgramCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutputgrid.lists["x_SubProgramCode"] = <?php echo $output_grid->SubProgramCode->Lookup->toClientList($output_grid) ?>;
	foutputgrid.lists["x_SubProgramCode"].options = <?php echo JsonEncode($output_grid->SubProgramCode->lookupOptions()) ?>;
	foutputgrid.lists["x_OutputCode"] = <?php echo $output_grid->OutputCode->Lookup->toClientList($output_grid) ?>;
	foutputgrid.lists["x_OutputCode"].options = <?php echo JsonEncode($output_grid->OutputCode->lookupOptions()) ?>;
	foutputgrid.lists["x_OutputType"] = <?php echo $output_grid->OutputType->Lookup->toClientList($output_grid) ?>;
	foutputgrid.lists["x_OutputType"].options = <?php echo JsonEncode($output_grid->OutputType->lookupOptions()) ?>;
	foutputgrid.lists["x_OutputStatus"] = <?php echo $output_grid->OutputStatus->Lookup->toClientList($output_grid) ?>;
	foutputgrid.lists["x_OutputStatus"].options = <?php echo JsonEncode($output_grid->OutputStatus->lookupOptions()) ?>;
	loadjs.done("foutputgrid");
});
</script>
<?php } ?>
<?php
$output_grid->renderOtherOptions();
?>
<?php if ($output_grid->TotalRecords > 0 || $output->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($output_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> output">
<?php if ($output_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $output_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="foutputgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_output" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_outputgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$output->RowType = ROWTYPE_HEADER;

// Render list options
$output_grid->renderListOptions();

// Render list options (header, left)
$output_grid->ListOptions->render("header", "left");
?>
<?php if ($output_grid->LACode->Visible) { // LACode ?>
	<?php if ($output_grid->SortUrl($output_grid->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $output_grid->LACode->headerCellClass() ?>"><div id="elh_output_LACode" class="output_LACode"><div class="ew-table-header-caption"><?php echo $output_grid->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $output_grid->LACode->headerCellClass() ?>"><div><div id="elh_output_LACode" class="output_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_grid->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_grid->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_grid->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_grid->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($output_grid->SortUrl($output_grid->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $output_grid->DepartmentCode->headerCellClass() ?>"><div id="elh_output_DepartmentCode" class="output_DepartmentCode"><div class="ew-table-header-caption"><?php echo $output_grid->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $output_grid->DepartmentCode->headerCellClass() ?>"><div><div id="elh_output_DepartmentCode" class="output_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_grid->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_grid->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_grid->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_grid->SectionCode->Visible) { // SectionCode ?>
	<?php if ($output_grid->SortUrl($output_grid->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $output_grid->SectionCode->headerCellClass() ?>"><div id="elh_output_SectionCode" class="output_SectionCode"><div class="ew-table-header-caption"><?php echo $output_grid->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $output_grid->SectionCode->headerCellClass() ?>"><div><div id="elh_output_SectionCode" class="output_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_grid->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_grid->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_grid->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_grid->OutcomeCode->Visible) { // OutcomeCode ?>
	<?php if ($output_grid->SortUrl($output_grid->OutcomeCode) == "") { ?>
		<th data-name="OutcomeCode" class="<?php echo $output_grid->OutcomeCode->headerCellClass() ?>"><div id="elh_output_OutcomeCode" class="output_OutcomeCode"><div class="ew-table-header-caption"><?php echo $output_grid->OutcomeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutcomeCode" class="<?php echo $output_grid->OutcomeCode->headerCellClass() ?>"><div><div id="elh_output_OutcomeCode" class="output_OutcomeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_grid->OutcomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_grid->OutcomeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_grid->OutcomeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_grid->ProgramCode->Visible) { // ProgramCode ?>
	<?php if ($output_grid->SortUrl($output_grid->ProgramCode) == "") { ?>
		<th data-name="ProgramCode" class="<?php echo $output_grid->ProgramCode->headerCellClass() ?>"><div id="elh_output_ProgramCode" class="output_ProgramCode"><div class="ew-table-header-caption"><?php echo $output_grid->ProgramCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgramCode" class="<?php echo $output_grid->ProgramCode->headerCellClass() ?>"><div><div id="elh_output_ProgramCode" class="output_ProgramCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_grid->ProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_grid->ProgramCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_grid->ProgramCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_grid->SubProgramCode->Visible) { // SubProgramCode ?>
	<?php if ($output_grid->SortUrl($output_grid->SubProgramCode) == "") { ?>
		<th data-name="SubProgramCode" class="<?php echo $output_grid->SubProgramCode->headerCellClass() ?>"><div id="elh_output_SubProgramCode" class="output_SubProgramCode"><div class="ew-table-header-caption"><?php echo $output_grid->SubProgramCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubProgramCode" class="<?php echo $output_grid->SubProgramCode->headerCellClass() ?>"><div><div id="elh_output_SubProgramCode" class="output_SubProgramCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_grid->SubProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_grid->SubProgramCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_grid->SubProgramCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_grid->OutputCode->Visible) { // OutputCode ?>
	<?php if ($output_grid->SortUrl($output_grid->OutputCode) == "") { ?>
		<th data-name="OutputCode" class="<?php echo $output_grid->OutputCode->headerCellClass() ?>"><div id="elh_output_OutputCode" class="output_OutputCode"><div class="ew-table-header-caption"><?php echo $output_grid->OutputCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputCode" class="<?php echo $output_grid->OutputCode->headerCellClass() ?>"><div><div id="elh_output_OutputCode" class="output_OutputCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_grid->OutputCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_grid->OutputCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_grid->OutputCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_grid->OutputType->Visible) { // OutputType ?>
	<?php if ($output_grid->SortUrl($output_grid->OutputType) == "") { ?>
		<th data-name="OutputType" class="<?php echo $output_grid->OutputType->headerCellClass() ?>"><div id="elh_output_OutputType" class="output_OutputType"><div class="ew-table-header-caption"><?php echo $output_grid->OutputType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputType" class="<?php echo $output_grid->OutputType->headerCellClass() ?>"><div><div id="elh_output_OutputType" class="output_OutputType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_grid->OutputType->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_grid->OutputType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_grid->OutputType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_grid->OutputName->Visible) { // OutputName ?>
	<?php if ($output_grid->SortUrl($output_grid->OutputName) == "") { ?>
		<th data-name="OutputName" class="<?php echo $output_grid->OutputName->headerCellClass() ?>"><div id="elh_output_OutputName" class="output_OutputName"><div class="ew-table-header-caption"><?php echo $output_grid->OutputName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputName" class="<?php echo $output_grid->OutputName->headerCellClass() ?>"><div><div id="elh_output_OutputName" class="output_OutputName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_grid->OutputName->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_grid->OutputName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_grid->OutputName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_grid->DeliveryDate->Visible) { // DeliveryDate ?>
	<?php if ($output_grid->SortUrl($output_grid->DeliveryDate) == "") { ?>
		<th data-name="DeliveryDate" class="<?php echo $output_grid->DeliveryDate->headerCellClass() ?>"><div id="elh_output_DeliveryDate" class="output_DeliveryDate"><div class="ew-table-header-caption"><?php echo $output_grid->DeliveryDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeliveryDate" class="<?php echo $output_grid->DeliveryDate->headerCellClass() ?>"><div><div id="elh_output_DeliveryDate" class="output_DeliveryDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_grid->DeliveryDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_grid->DeliveryDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_grid->DeliveryDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_grid->FinancialYear->Visible) { // FinancialYear ?>
	<?php if ($output_grid->SortUrl($output_grid->FinancialYear) == "") { ?>
		<th data-name="FinancialYear" class="<?php echo $output_grid->FinancialYear->headerCellClass() ?>"><div id="elh_output_FinancialYear" class="output_FinancialYear"><div class="ew-table-header-caption"><?php echo $output_grid->FinancialYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FinancialYear" class="<?php echo $output_grid->FinancialYear->headerCellClass() ?>"><div><div id="elh_output_FinancialYear" class="output_FinancialYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_grid->FinancialYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_grid->FinancialYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_grid->FinancialYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_grid->OutputDescription->Visible) { // OutputDescription ?>
	<?php if ($output_grid->SortUrl($output_grid->OutputDescription) == "") { ?>
		<th data-name="OutputDescription" class="<?php echo $output_grid->OutputDescription->headerCellClass() ?>"><div id="elh_output_OutputDescription" class="output_OutputDescription"><div class="ew-table-header-caption"><?php echo $output_grid->OutputDescription->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputDescription" class="<?php echo $output_grid->OutputDescription->headerCellClass() ?>"><div><div id="elh_output_OutputDescription" class="output_OutputDescription">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_grid->OutputDescription->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_grid->OutputDescription->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_grid->OutputDescription->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_grid->OutputMeansOfVerification->Visible) { // OutputMeansOfVerification ?>
	<?php if ($output_grid->SortUrl($output_grid->OutputMeansOfVerification) == "") { ?>
		<th data-name="OutputMeansOfVerification" class="<?php echo $output_grid->OutputMeansOfVerification->headerCellClass() ?>"><div id="elh_output_OutputMeansOfVerification" class="output_OutputMeansOfVerification"><div class="ew-table-header-caption"><?php echo $output_grid->OutputMeansOfVerification->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputMeansOfVerification" class="<?php echo $output_grid->OutputMeansOfVerification->headerCellClass() ?>"><div><div id="elh_output_OutputMeansOfVerification" class="output_OutputMeansOfVerification">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_grid->OutputMeansOfVerification->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_grid->OutputMeansOfVerification->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_grid->OutputMeansOfVerification->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_grid->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
	<?php if ($output_grid->SortUrl($output_grid->ResponsibleOfficer) == "") { ?>
		<th data-name="ResponsibleOfficer" class="<?php echo $output_grid->ResponsibleOfficer->headerCellClass() ?>"><div id="elh_output_ResponsibleOfficer" class="output_ResponsibleOfficer"><div class="ew-table-header-caption"><?php echo $output_grid->ResponsibleOfficer->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ResponsibleOfficer" class="<?php echo $output_grid->ResponsibleOfficer->headerCellClass() ?>"><div><div id="elh_output_ResponsibleOfficer" class="output_ResponsibleOfficer">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_grid->ResponsibleOfficer->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_grid->ResponsibleOfficer->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_grid->ResponsibleOfficer->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_grid->Clients->Visible) { // Clients ?>
	<?php if ($output_grid->SortUrl($output_grid->Clients) == "") { ?>
		<th data-name="Clients" class="<?php echo $output_grid->Clients->headerCellClass() ?>"><div id="elh_output_Clients" class="output_Clients"><div class="ew-table-header-caption"><?php echo $output_grid->Clients->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Clients" class="<?php echo $output_grid->Clients->headerCellClass() ?>"><div><div id="elh_output_Clients" class="output_Clients">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_grid->Clients->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_grid->Clients->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_grid->Clients->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_grid->Beneficiaries->Visible) { // Beneficiaries ?>
	<?php if ($output_grid->SortUrl($output_grid->Beneficiaries) == "") { ?>
		<th data-name="Beneficiaries" class="<?php echo $output_grid->Beneficiaries->headerCellClass() ?>"><div id="elh_output_Beneficiaries" class="output_Beneficiaries"><div class="ew-table-header-caption"><?php echo $output_grid->Beneficiaries->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Beneficiaries" class="<?php echo $output_grid->Beneficiaries->headerCellClass() ?>"><div><div id="elh_output_Beneficiaries" class="output_Beneficiaries">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_grid->Beneficiaries->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_grid->Beneficiaries->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_grid->Beneficiaries->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_grid->OutputStatus->Visible) { // OutputStatus ?>
	<?php if ($output_grid->SortUrl($output_grid->OutputStatus) == "") { ?>
		<th data-name="OutputStatus" class="<?php echo $output_grid->OutputStatus->headerCellClass() ?>"><div id="elh_output_OutputStatus" class="output_OutputStatus"><div class="ew-table-header-caption"><?php echo $output_grid->OutputStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputStatus" class="<?php echo $output_grid->OutputStatus->headerCellClass() ?>"><div><div id="elh_output_OutputStatus" class="output_OutputStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_grid->OutputStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_grid->OutputStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_grid->OutputStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_grid->TargetAmount->Visible) { // TargetAmount ?>
	<?php if ($output_grid->SortUrl($output_grid->TargetAmount) == "") { ?>
		<th data-name="TargetAmount" class="<?php echo $output_grid->TargetAmount->headerCellClass() ?>"><div id="elh_output_TargetAmount" class="output_TargetAmount"><div class="ew-table-header-caption"><?php echo $output_grid->TargetAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TargetAmount" class="<?php echo $output_grid->TargetAmount->headerCellClass() ?>"><div><div id="elh_output_TargetAmount" class="output_TargetAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_grid->TargetAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_grid->TargetAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_grid->TargetAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_grid->ActualAmount->Visible) { // ActualAmount ?>
	<?php if ($output_grid->SortUrl($output_grid->ActualAmount) == "") { ?>
		<th data-name="ActualAmount" class="<?php echo $output_grid->ActualAmount->headerCellClass() ?>"><div id="elh_output_ActualAmount" class="output_ActualAmount"><div class="ew-table-header-caption"><?php echo $output_grid->ActualAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActualAmount" class="<?php echo $output_grid->ActualAmount->headerCellClass() ?>"><div><div id="elh_output_ActualAmount" class="output_ActualAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_grid->ActualAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_grid->ActualAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_grid->ActualAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_grid->PercentAchieved->Visible) { // PercentAchieved ?>
	<?php if ($output_grid->SortUrl($output_grid->PercentAchieved) == "") { ?>
		<th data-name="PercentAchieved" class="<?php echo $output_grid->PercentAchieved->headerCellClass() ?>"><div id="elh_output_PercentAchieved" class="output_PercentAchieved"><div class="ew-table-header-caption"><?php echo $output_grid->PercentAchieved->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PercentAchieved" class="<?php echo $output_grid->PercentAchieved->headerCellClass() ?>"><div><div id="elh_output_PercentAchieved" class="output_PercentAchieved">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_grid->PercentAchieved->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_grid->PercentAchieved->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_grid->PercentAchieved->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$output_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$output_grid->StartRecord = 1;
$output_grid->StopRecord = $output_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($output->isConfirm() || $output_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($output_grid->FormKeyCountName) && ($output_grid->isGridAdd() || $output_grid->isGridEdit() || $output->isConfirm())) {
		$output_grid->KeyCount = $CurrentForm->getValue($output_grid->FormKeyCountName);
		$output_grid->StopRecord = $output_grid->StartRecord + $output_grid->KeyCount - 1;
	}
}
$output_grid->RecordCount = $output_grid->StartRecord - 1;
if ($output_grid->Recordset && !$output_grid->Recordset->EOF) {
	$output_grid->Recordset->moveFirst();
	$selectLimit = $output_grid->UseSelectLimit;
	if (!$selectLimit && $output_grid->StartRecord > 1)
		$output_grid->Recordset->move($output_grid->StartRecord - 1);
} elseif (!$output->AllowAddDeleteRow && $output_grid->StopRecord == 0) {
	$output_grid->StopRecord = $output->GridAddRowCount;
}

// Initialize aggregate
$output->RowType = ROWTYPE_AGGREGATEINIT;
$output->resetAttributes();
$output_grid->renderRow();
if ($output_grid->isGridAdd())
	$output_grid->RowIndex = 0;
if ($output_grid->isGridEdit())
	$output_grid->RowIndex = 0;
while ($output_grid->RecordCount < $output_grid->StopRecord) {
	$output_grid->RecordCount++;
	if ($output_grid->RecordCount >= $output_grid->StartRecord) {
		$output_grid->RowCount++;
		if ($output_grid->isGridAdd() || $output_grid->isGridEdit() || $output->isConfirm()) {
			$output_grid->RowIndex++;
			$CurrentForm->Index = $output_grid->RowIndex;
			if ($CurrentForm->hasValue($output_grid->FormActionName) && ($output->isConfirm() || $output_grid->EventCancelled))
				$output_grid->RowAction = strval($CurrentForm->getValue($output_grid->FormActionName));
			elseif ($output_grid->isGridAdd())
				$output_grid->RowAction = "insert";
			else
				$output_grid->RowAction = "";
		}

		// Set up key count
		$output_grid->KeyCount = $output_grid->RowIndex;

		// Init row class and style
		$output->resetAttributes();
		$output->CssClass = "";
		if ($output_grid->isGridAdd()) {
			if ($output->CurrentMode == "copy") {
				$output_grid->loadRowValues($output_grid->Recordset); // Load row values
				$output_grid->setRecordKey($output_grid->RowOldKey, $output_grid->Recordset); // Set old record key
			} else {
				$output_grid->loadRowValues(); // Load default values
				$output_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$output_grid->loadRowValues($output_grid->Recordset); // Load row values
		}
		$output->RowType = ROWTYPE_VIEW; // Render view
		if ($output_grid->isGridAdd()) // Grid add
			$output->RowType = ROWTYPE_ADD; // Render add
		if ($output_grid->isGridAdd() && $output->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$output_grid->restoreCurrentRowFormValues($output_grid->RowIndex); // Restore form values
		if ($output_grid->isGridEdit()) { // Grid edit
			if ($output->EventCancelled)
				$output_grid->restoreCurrentRowFormValues($output_grid->RowIndex); // Restore form values
			if ($output_grid->RowAction == "insert")
				$output->RowType = ROWTYPE_ADD; // Render add
			else
				$output->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($output_grid->isGridEdit() && ($output->RowType == ROWTYPE_EDIT || $output->RowType == ROWTYPE_ADD) && $output->EventCancelled) // Update failed
			$output_grid->restoreCurrentRowFormValues($output_grid->RowIndex); // Restore form values
		if ($output->RowType == ROWTYPE_EDIT) // Edit row
			$output_grid->EditRowCount++;
		if ($output->isConfirm()) // Confirm row
			$output_grid->restoreCurrentRowFormValues($output_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$output->RowAttrs->merge(["data-rowindex" => $output_grid->RowCount, "id" => "r" . $output_grid->RowCount . "_output", "data-rowtype" => $output->RowType]);

		// Render row
		$output_grid->renderRow();

		// Render list options
		$output_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($output_grid->RowAction != "delete" && $output_grid->RowAction != "insertdelete" && !($output_grid->RowAction == "insert" && $output->isConfirm() && $output_grid->emptyRow())) {
?>
	<tr <?php echo $output->rowAttributes() ?>>
<?php

// Render list options (body, left)
$output_grid->ListOptions->render("body", "left", $output_grid->RowCount);
?>
	<?php if ($output_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $output_grid->LACode->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($output_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_LACode" class="form-group">
<span<?php echo $output_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_grid->RowIndex ?>_LACode" name="x<?php echo $output_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_LACode" class="form-group">
<?php
$onchange = $output_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_grid->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $output_grid->RowIndex ?>_LACode" id="sv_x<?php echo $output_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($output_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($output_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_grid->LACode->getPlaceHolder()) ?>"<?php echo $output_grid->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_grid->RowIndex ?>_LACode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($output_grid->LACode->ReadOnly || $output_grid->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="output" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_grid->RowIndex ?>_LACode" id="x<?php echo $output_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutputgrid"], function() {
	foutputgrid.createAutoSuggest({"id":"x<?php echo $output_grid->RowIndex ?>_LACode","forceSelect":true});
});
</script>
<?php echo $output_grid->LACode->Lookup->getParamTag($output_grid, "p_x" . $output_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="output" data-field="x_LACode" name="o<?php echo $output_grid->RowIndex ?>_LACode" id="o<?php echo $output_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($output_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_LACode" class="form-group">
<span<?php echo $output_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_grid->RowIndex ?>_LACode" name="x<?php echo $output_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_LACode" class="form-group">
<?php
$onchange = $output_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_grid->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $output_grid->RowIndex ?>_LACode" id="sv_x<?php echo $output_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($output_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($output_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_grid->LACode->getPlaceHolder()) ?>"<?php echo $output_grid->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_grid->RowIndex ?>_LACode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($output_grid->LACode->ReadOnly || $output_grid->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="output" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_grid->RowIndex ?>_LACode" id="x<?php echo $output_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutputgrid"], function() {
	foutputgrid.createAutoSuggest({"id":"x<?php echo $output_grid->RowIndex ?>_LACode","forceSelect":true});
});
</script>
<?php echo $output_grid->LACode->Lookup->getParamTag($output_grid, "p_x" . $output_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_LACode">
<span<?php echo $output_grid->LACode->viewAttributes() ?>><?php echo $output_grid->LACode->getViewValue() ?></span>
</span>
<?php if (!$output->isConfirm()) { ?>
<input type="hidden" data-table="output" data-field="x_LACode" name="x<?php echo $output_grid->RowIndex ?>_LACode" id="x<?php echo $output_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_LACode" name="o<?php echo $output_grid->RowIndex ?>_LACode" id="o<?php echo $output_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_grid->LACode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output" data-field="x_LACode" name="foutputgrid$x<?php echo $output_grid->RowIndex ?>_LACode" id="foutputgrid$x<?php echo $output_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_LACode" name="foutputgrid$o<?php echo $output_grid->RowIndex ?>_LACode" id="foutputgrid$o<?php echo $output_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_grid->LACode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $output_grid->DepartmentCode->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($output_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_DepartmentCode" class="form-group">
<span<?php echo $output_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $output_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_DepartmentCode" class="form-group">
<?php $output_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $output_grid->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($output_grid->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_grid->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_grid->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_grid->DepartmentCode->ReadOnly || $output_grid->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_grid->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_grid->DepartmentCode->Lookup->getParamTag($output_grid, "p_x" . $output_grid->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="output" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $output_grid->RowIndex ?>_DepartmentCode" value="<?php echo $output_grid->DepartmentCode->CurrentValue ?>"<?php echo $output_grid->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="output" data-field="x_DepartmentCode" name="o<?php echo $output_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $output_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($output_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_DepartmentCode" class="form-group">
<span<?php echo $output_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $output_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_DepartmentCode" class="form-group">
<?php $output_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $output_grid->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($output_grid->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_grid->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_grid->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_grid->DepartmentCode->ReadOnly || $output_grid->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_grid->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_grid->DepartmentCode->Lookup->getParamTag($output_grid, "p_x" . $output_grid->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="output" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $output_grid->RowIndex ?>_DepartmentCode" value="<?php echo $output_grid->DepartmentCode->CurrentValue ?>"<?php echo $output_grid->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_DepartmentCode">
<span<?php echo $output_grid->DepartmentCode->viewAttributes() ?>><?php echo $output_grid->DepartmentCode->getViewValue() ?></span>
</span>
<?php if (!$output->isConfirm()) { ?>
<input type="hidden" data-table="output" data-field="x_DepartmentCode" name="x<?php echo $output_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $output_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_DepartmentCode" name="o<?php echo $output_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $output_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_grid->DepartmentCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output" data-field="x_DepartmentCode" name="foutputgrid$x<?php echo $output_grid->RowIndex ?>_DepartmentCode" id="foutputgrid$x<?php echo $output_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_DepartmentCode" name="foutputgrid$o<?php echo $output_grid->RowIndex ?>_DepartmentCode" id="foutputgrid$o<?php echo $output_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $output_grid->SectionCode->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_SectionCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $output_grid->RowIndex ?>_SectionCode"><?php echo EmptyValue(strval($output_grid->SectionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_grid->SectionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_grid->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_grid->SectionCode->ReadOnly || $output_grid->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_grid->RowIndex ?>_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_grid->SectionCode->Lookup->getParamTag($output_grid, "p_x" . $output_grid->RowIndex . "_SectionCode") ?>
<input type="hidden" data-table="output" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_grid->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_grid->RowIndex ?>_SectionCode" id="x<?php echo $output_grid->RowIndex ?>_SectionCode" value="<?php echo $output_grid->SectionCode->CurrentValue ?>"<?php echo $output_grid->SectionCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output" data-field="x_SectionCode" name="o<?php echo $output_grid->RowIndex ?>_SectionCode" id="o<?php echo $output_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_SectionCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $output_grid->RowIndex ?>_SectionCode"><?php echo EmptyValue(strval($output_grid->SectionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_grid->SectionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_grid->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_grid->SectionCode->ReadOnly || $output_grid->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_grid->RowIndex ?>_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_grid->SectionCode->Lookup->getParamTag($output_grid, "p_x" . $output_grid->RowIndex . "_SectionCode") ?>
<input type="hidden" data-table="output" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_grid->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_grid->RowIndex ?>_SectionCode" id="x<?php echo $output_grid->RowIndex ?>_SectionCode" value="<?php echo $output_grid->SectionCode->CurrentValue ?>"<?php echo $output_grid->SectionCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_SectionCode">
<span<?php echo $output_grid->SectionCode->viewAttributes() ?>><?php echo $output_grid->SectionCode->getViewValue() ?></span>
</span>
<?php if (!$output->isConfirm()) { ?>
<input type="hidden" data-table="output" data-field="x_SectionCode" name="x<?php echo $output_grid->RowIndex ?>_SectionCode" id="x<?php echo $output_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_grid->SectionCode->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_SectionCode" name="o<?php echo $output_grid->RowIndex ?>_SectionCode" id="o<?php echo $output_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_grid->SectionCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output" data-field="x_SectionCode" name="foutputgrid$x<?php echo $output_grid->RowIndex ?>_SectionCode" id="foutputgrid$x<?php echo $output_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_grid->SectionCode->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_SectionCode" name="foutputgrid$o<?php echo $output_grid->RowIndex ?>_SectionCode" id="foutputgrid$o<?php echo $output_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_grid->OutcomeCode->Visible) { // OutcomeCode ?>
		<td data-name="OutcomeCode" <?php echo $output_grid->OutcomeCode->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($output_grid->OutcomeCode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_OutcomeCode" class="form-group">
<span<?php echo $output_grid->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_grid->RowIndex ?>_OutcomeCode" name="x<?php echo $output_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_grid->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_OutcomeCode" class="form-group">
<?php $output_grid->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $output_grid->RowIndex ?>_OutcomeCode"><?php echo EmptyValue(strval($output_grid->OutcomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_grid->OutcomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_grid->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_grid->OutcomeCode->ReadOnly || $output_grid->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_grid->RowIndex ?>_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_grid->OutcomeCode->Lookup->getParamTag($output_grid, "p_x" . $output_grid->RowIndex . "_OutcomeCode") ?>
<input type="hidden" data-table="output" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_grid->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_grid->RowIndex ?>_OutcomeCode" id="x<?php echo $output_grid->RowIndex ?>_OutcomeCode" value="<?php echo $output_grid->OutcomeCode->CurrentValue ?>"<?php echo $output_grid->OutcomeCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="output" data-field="x_OutcomeCode" name="o<?php echo $output_grid->RowIndex ?>_OutcomeCode" id="o<?php echo $output_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_grid->OutcomeCode->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($output_grid->OutcomeCode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_OutcomeCode" class="form-group">
<span<?php echo $output_grid->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_grid->RowIndex ?>_OutcomeCode" name="x<?php echo $output_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_grid->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_OutcomeCode" class="form-group">
<?php $output_grid->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $output_grid->RowIndex ?>_OutcomeCode"><?php echo EmptyValue(strval($output_grid->OutcomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_grid->OutcomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_grid->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_grid->OutcomeCode->ReadOnly || $output_grid->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_grid->RowIndex ?>_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_grid->OutcomeCode->Lookup->getParamTag($output_grid, "p_x" . $output_grid->RowIndex . "_OutcomeCode") ?>
<input type="hidden" data-table="output" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_grid->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_grid->RowIndex ?>_OutcomeCode" id="x<?php echo $output_grid->RowIndex ?>_OutcomeCode" value="<?php echo $output_grid->OutcomeCode->CurrentValue ?>"<?php echo $output_grid->OutcomeCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_OutcomeCode">
<span<?php echo $output_grid->OutcomeCode->viewAttributes() ?>><?php echo $output_grid->OutcomeCode->getViewValue() ?></span>
</span>
<?php if (!$output->isConfirm()) { ?>
<input type="hidden" data-table="output" data-field="x_OutcomeCode" name="x<?php echo $output_grid->RowIndex ?>_OutcomeCode" id="x<?php echo $output_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_grid->OutcomeCode->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_OutcomeCode" name="o<?php echo $output_grid->RowIndex ?>_OutcomeCode" id="o<?php echo $output_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_grid->OutcomeCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output" data-field="x_OutcomeCode" name="foutputgrid$x<?php echo $output_grid->RowIndex ?>_OutcomeCode" id="foutputgrid$x<?php echo $output_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_grid->OutcomeCode->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_OutcomeCode" name="foutputgrid$o<?php echo $output_grid->RowIndex ?>_OutcomeCode" id="foutputgrid$o<?php echo $output_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_grid->OutcomeCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_grid->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode" <?php echo $output_grid->ProgramCode->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_ProgramCode" class="form-group">
<?php
$onchange = $output_grid->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_grid->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_grid->RowIndex ?>_ProgramCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $output_grid->RowIndex ?>_ProgramCode" id="sv_x<?php echo $output_grid->RowIndex ?>_ProgramCode" value="<?php echo RemoveHtml($output_grid->ProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_grid->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_grid->ProgramCode->getPlaceHolder()) ?>"<?php echo $output_grid->ProgramCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_grid->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_grid->RowIndex ?>_ProgramCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($output_grid->ProgramCode->ReadOnly || $output_grid->ProgramCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="output" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_grid->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_grid->RowIndex ?>_ProgramCode" id="x<?php echo $output_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_grid->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutputgrid"], function() {
	foutputgrid.createAutoSuggest({"id":"x<?php echo $output_grid->RowIndex ?>_ProgramCode","forceSelect":true});
});
</script>
<?php echo $output_grid->ProgramCode->Lookup->getParamTag($output_grid, "p_x" . $output_grid->RowIndex . "_ProgramCode") ?>
</span>
<input type="hidden" data-table="output" data-field="x_ProgramCode" name="o<?php echo $output_grid->RowIndex ?>_ProgramCode" id="o<?php echo $output_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_grid->ProgramCode->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_ProgramCode" class="form-group">
<?php
$onchange = $output_grid->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_grid->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_grid->RowIndex ?>_ProgramCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $output_grid->RowIndex ?>_ProgramCode" id="sv_x<?php echo $output_grid->RowIndex ?>_ProgramCode" value="<?php echo RemoveHtml($output_grid->ProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_grid->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_grid->ProgramCode->getPlaceHolder()) ?>"<?php echo $output_grid->ProgramCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_grid->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_grid->RowIndex ?>_ProgramCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($output_grid->ProgramCode->ReadOnly || $output_grid->ProgramCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="output" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_grid->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_grid->RowIndex ?>_ProgramCode" id="x<?php echo $output_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_grid->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutputgrid"], function() {
	foutputgrid.createAutoSuggest({"id":"x<?php echo $output_grid->RowIndex ?>_ProgramCode","forceSelect":true});
});
</script>
<?php echo $output_grid->ProgramCode->Lookup->getParamTag($output_grid, "p_x" . $output_grid->RowIndex . "_ProgramCode") ?>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_ProgramCode">
<span<?php echo $output_grid->ProgramCode->viewAttributes() ?>><?php echo $output_grid->ProgramCode->getViewValue() ?></span>
</span>
<?php if (!$output->isConfirm()) { ?>
<input type="hidden" data-table="output" data-field="x_ProgramCode" name="x<?php echo $output_grid->RowIndex ?>_ProgramCode" id="x<?php echo $output_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_grid->ProgramCode->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_ProgramCode" name="o<?php echo $output_grid->RowIndex ?>_ProgramCode" id="o<?php echo $output_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_grid->ProgramCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output" data-field="x_ProgramCode" name="foutputgrid$x<?php echo $output_grid->RowIndex ?>_ProgramCode" id="foutputgrid$x<?php echo $output_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_grid->ProgramCode->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_ProgramCode" name="foutputgrid$o<?php echo $output_grid->RowIndex ?>_ProgramCode" id="foutputgrid$o<?php echo $output_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_grid->ProgramCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_grid->SubProgramCode->Visible) { // SubProgramCode ?>
		<td data-name="SubProgramCode" <?php echo $output_grid->SubProgramCode->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_SubProgramCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $output_grid->RowIndex ?>_SubProgramCode"><?php echo EmptyValue(strval($output_grid->SubProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_grid->SubProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_grid->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_grid->SubProgramCode->ReadOnly || $output_grid->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_grid->RowIndex ?>_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_grid->SubProgramCode->Lookup->getParamTag($output_grid, "p_x" . $output_grid->RowIndex . "_SubProgramCode") ?>
<input type="hidden" data-table="output" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_grid->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_grid->RowIndex ?>_SubProgramCode" id="x<?php echo $output_grid->RowIndex ?>_SubProgramCode" value="<?php echo $output_grid->SubProgramCode->CurrentValue ?>"<?php echo $output_grid->SubProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output" data-field="x_SubProgramCode" name="o<?php echo $output_grid->RowIndex ?>_SubProgramCode" id="o<?php echo $output_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_grid->SubProgramCode->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_SubProgramCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $output_grid->RowIndex ?>_SubProgramCode"><?php echo EmptyValue(strval($output_grid->SubProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_grid->SubProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_grid->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_grid->SubProgramCode->ReadOnly || $output_grid->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_grid->RowIndex ?>_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_grid->SubProgramCode->Lookup->getParamTag($output_grid, "p_x" . $output_grid->RowIndex . "_SubProgramCode") ?>
<input type="hidden" data-table="output" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_grid->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_grid->RowIndex ?>_SubProgramCode" id="x<?php echo $output_grid->RowIndex ?>_SubProgramCode" value="<?php echo $output_grid->SubProgramCode->CurrentValue ?>"<?php echo $output_grid->SubProgramCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_SubProgramCode">
<span<?php echo $output_grid->SubProgramCode->viewAttributes() ?>><?php echo $output_grid->SubProgramCode->getViewValue() ?></span>
</span>
<?php if (!$output->isConfirm()) { ?>
<input type="hidden" data-table="output" data-field="x_SubProgramCode" name="x<?php echo $output_grid->RowIndex ?>_SubProgramCode" id="x<?php echo $output_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_grid->SubProgramCode->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_SubProgramCode" name="o<?php echo $output_grid->RowIndex ?>_SubProgramCode" id="o<?php echo $output_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_grid->SubProgramCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output" data-field="x_SubProgramCode" name="foutputgrid$x<?php echo $output_grid->RowIndex ?>_SubProgramCode" id="foutputgrid$x<?php echo $output_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_grid->SubProgramCode->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_SubProgramCode" name="foutputgrid$o<?php echo $output_grid->RowIndex ?>_SubProgramCode" id="foutputgrid$o<?php echo $output_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_grid->SubProgramCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_grid->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode" <?php echo $output_grid->OutputCode->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_OutputCode" class="form-group"></span>
<input type="hidden" data-table="output" data-field="x_OutputCode" name="o<?php echo $output_grid->RowIndex ?>_OutputCode" id="o<?php echo $output_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_grid->OutputCode->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_OutputCode" class="form-group">
<span<?php echo $output_grid->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->OutputCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="output" data-field="x_OutputCode" name="x<?php echo $output_grid->RowIndex ?>_OutputCode" id="x<?php echo $output_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_grid->OutputCode->CurrentValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_OutputCode">
<span<?php echo $output_grid->OutputCode->viewAttributes() ?>><?php echo $output_grid->OutputCode->getViewValue() ?></span>
</span>
<?php if (!$output->isConfirm()) { ?>
<input type="hidden" data-table="output" data-field="x_OutputCode" name="x<?php echo $output_grid->RowIndex ?>_OutputCode" id="x<?php echo $output_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_grid->OutputCode->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_OutputCode" name="o<?php echo $output_grid->RowIndex ?>_OutputCode" id="o<?php echo $output_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_grid->OutputCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output" data-field="x_OutputCode" name="foutputgrid$x<?php echo $output_grid->RowIndex ?>_OutputCode" id="foutputgrid$x<?php echo $output_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_grid->OutputCode->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_OutputCode" name="foutputgrid$o<?php echo $output_grid->RowIndex ?>_OutputCode" id="foutputgrid$o<?php echo $output_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_grid->OutputCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_grid->OutputType->Visible) { // OutputType ?>
		<td data-name="OutputType" <?php echo $output_grid->OutputType->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_OutputType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="output" data-field="x_OutputType" data-value-separator="<?php echo $output_grid->OutputType->displayValueSeparatorAttribute() ?>" id="x<?php echo $output_grid->RowIndex ?>_OutputType" name="x<?php echo $output_grid->RowIndex ?>_OutputType"<?php echo $output_grid->OutputType->editAttributes() ?>>
			<?php echo $output_grid->OutputType->selectOptionListHtml("x{$output_grid->RowIndex}_OutputType") ?>
		</select>
</div>
<?php echo $output_grid->OutputType->Lookup->getParamTag($output_grid, "p_x" . $output_grid->RowIndex . "_OutputType") ?>
</span>
<input type="hidden" data-table="output" data-field="x_OutputType" name="o<?php echo $output_grid->RowIndex ?>_OutputType" id="o<?php echo $output_grid->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_grid->OutputType->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_OutputType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="output" data-field="x_OutputType" data-value-separator="<?php echo $output_grid->OutputType->displayValueSeparatorAttribute() ?>" id="x<?php echo $output_grid->RowIndex ?>_OutputType" name="x<?php echo $output_grid->RowIndex ?>_OutputType"<?php echo $output_grid->OutputType->editAttributes() ?>>
			<?php echo $output_grid->OutputType->selectOptionListHtml("x{$output_grid->RowIndex}_OutputType") ?>
		</select>
</div>
<?php echo $output_grid->OutputType->Lookup->getParamTag($output_grid, "p_x" . $output_grid->RowIndex . "_OutputType") ?>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_OutputType">
<span<?php echo $output_grid->OutputType->viewAttributes() ?>><?php echo $output_grid->OutputType->getViewValue() ?></span>
</span>
<?php if (!$output->isConfirm()) { ?>
<input type="hidden" data-table="output" data-field="x_OutputType" name="x<?php echo $output_grid->RowIndex ?>_OutputType" id="x<?php echo $output_grid->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_grid->OutputType->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_OutputType" name="o<?php echo $output_grid->RowIndex ?>_OutputType" id="o<?php echo $output_grid->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_grid->OutputType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output" data-field="x_OutputType" name="foutputgrid$x<?php echo $output_grid->RowIndex ?>_OutputType" id="foutputgrid$x<?php echo $output_grid->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_grid->OutputType->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_OutputType" name="foutputgrid$o<?php echo $output_grid->RowIndex ?>_OutputType" id="foutputgrid$o<?php echo $output_grid->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_grid->OutputType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_grid->OutputName->Visible) { // OutputName ?>
		<td data-name="OutputName" <?php echo $output_grid->OutputName->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_OutputName" class="form-group">
<textarea data-table="output" data-field="x_OutputName" name="x<?php echo $output_grid->RowIndex ?>_OutputName" id="x<?php echo $output_grid->RowIndex ?>_OutputName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_grid->OutputName->getPlaceHolder()) ?>"<?php echo $output_grid->OutputName->editAttributes() ?>><?php echo $output_grid->OutputName->EditValue ?></textarea>
</span>
<input type="hidden" data-table="output" data-field="x_OutputName" name="o<?php echo $output_grid->RowIndex ?>_OutputName" id="o<?php echo $output_grid->RowIndex ?>_OutputName" value="<?php echo HtmlEncode($output_grid->OutputName->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_OutputName" class="form-group">
<textarea data-table="output" data-field="x_OutputName" name="x<?php echo $output_grid->RowIndex ?>_OutputName" id="x<?php echo $output_grid->RowIndex ?>_OutputName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_grid->OutputName->getPlaceHolder()) ?>"<?php echo $output_grid->OutputName->editAttributes() ?>><?php echo $output_grid->OutputName->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_OutputName">
<span<?php echo $output_grid->OutputName->viewAttributes() ?>><?php echo $output_grid->OutputName->getViewValue() ?></span>
</span>
<?php if (!$output->isConfirm()) { ?>
<input type="hidden" data-table="output" data-field="x_OutputName" name="x<?php echo $output_grid->RowIndex ?>_OutputName" id="x<?php echo $output_grid->RowIndex ?>_OutputName" value="<?php echo HtmlEncode($output_grid->OutputName->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_OutputName" name="o<?php echo $output_grid->RowIndex ?>_OutputName" id="o<?php echo $output_grid->RowIndex ?>_OutputName" value="<?php echo HtmlEncode($output_grid->OutputName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output" data-field="x_OutputName" name="foutputgrid$x<?php echo $output_grid->RowIndex ?>_OutputName" id="foutputgrid$x<?php echo $output_grid->RowIndex ?>_OutputName" value="<?php echo HtmlEncode($output_grid->OutputName->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_OutputName" name="foutputgrid$o<?php echo $output_grid->RowIndex ?>_OutputName" id="foutputgrid$o<?php echo $output_grid->RowIndex ?>_OutputName" value="<?php echo HtmlEncode($output_grid->OutputName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_grid->DeliveryDate->Visible) { // DeliveryDate ?>
		<td data-name="DeliveryDate" <?php echo $output_grid->DeliveryDate->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_DeliveryDate" class="form-group">
<input type="text" data-table="output" data-field="x_DeliveryDate" name="x<?php echo $output_grid->RowIndex ?>_DeliveryDate" id="x<?php echo $output_grid->RowIndex ?>_DeliveryDate" placeholder="<?php echo HtmlEncode($output_grid->DeliveryDate->getPlaceHolder()) ?>" value="<?php echo $output_grid->DeliveryDate->EditValue ?>"<?php echo $output_grid->DeliveryDate->editAttributes() ?>>
<?php if (!$output_grid->DeliveryDate->ReadOnly && !$output_grid->DeliveryDate->Disabled && !isset($output_grid->DeliveryDate->EditAttrs["readonly"]) && !isset($output_grid->DeliveryDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["foutputgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("foutputgrid", "x<?php echo $output_grid->RowIndex ?>_DeliveryDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="output" data-field="x_DeliveryDate" name="o<?php echo $output_grid->RowIndex ?>_DeliveryDate" id="o<?php echo $output_grid->RowIndex ?>_DeliveryDate" value="<?php echo HtmlEncode($output_grid->DeliveryDate->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_DeliveryDate" class="form-group">
<input type="text" data-table="output" data-field="x_DeliveryDate" name="x<?php echo $output_grid->RowIndex ?>_DeliveryDate" id="x<?php echo $output_grid->RowIndex ?>_DeliveryDate" placeholder="<?php echo HtmlEncode($output_grid->DeliveryDate->getPlaceHolder()) ?>" value="<?php echo $output_grid->DeliveryDate->EditValue ?>"<?php echo $output_grid->DeliveryDate->editAttributes() ?>>
<?php if (!$output_grid->DeliveryDate->ReadOnly && !$output_grid->DeliveryDate->Disabled && !isset($output_grid->DeliveryDate->EditAttrs["readonly"]) && !isset($output_grid->DeliveryDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["foutputgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("foutputgrid", "x<?php echo $output_grid->RowIndex ?>_DeliveryDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_DeliveryDate">
<span<?php echo $output_grid->DeliveryDate->viewAttributes() ?>><?php echo $output_grid->DeliveryDate->getViewValue() ?></span>
</span>
<?php if (!$output->isConfirm()) { ?>
<input type="hidden" data-table="output" data-field="x_DeliveryDate" name="x<?php echo $output_grid->RowIndex ?>_DeliveryDate" id="x<?php echo $output_grid->RowIndex ?>_DeliveryDate" value="<?php echo HtmlEncode($output_grid->DeliveryDate->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_DeliveryDate" name="o<?php echo $output_grid->RowIndex ?>_DeliveryDate" id="o<?php echo $output_grid->RowIndex ?>_DeliveryDate" value="<?php echo HtmlEncode($output_grid->DeliveryDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output" data-field="x_DeliveryDate" name="foutputgrid$x<?php echo $output_grid->RowIndex ?>_DeliveryDate" id="foutputgrid$x<?php echo $output_grid->RowIndex ?>_DeliveryDate" value="<?php echo HtmlEncode($output_grid->DeliveryDate->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_DeliveryDate" name="foutputgrid$o<?php echo $output_grid->RowIndex ?>_DeliveryDate" id="foutputgrid$o<?php echo $output_grid->RowIndex ?>_DeliveryDate" value="<?php echo HtmlEncode($output_grid->DeliveryDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_grid->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear" <?php echo $output_grid->FinancialYear->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_FinancialYear" class="form-group">
<input type="text" data-table="output" data-field="x_FinancialYear" name="x<?php echo $output_grid->RowIndex ?>_FinancialYear" id="x<?php echo $output_grid->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($output_grid->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $output_grid->FinancialYear->EditValue ?>"<?php echo $output_grid->FinancialYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="output" data-field="x_FinancialYear" name="o<?php echo $output_grid->RowIndex ?>_FinancialYear" id="o<?php echo $output_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($output_grid->FinancialYear->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_FinancialYear" class="form-group">
<input type="text" data-table="output" data-field="x_FinancialYear" name="x<?php echo $output_grid->RowIndex ?>_FinancialYear" id="x<?php echo $output_grid->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($output_grid->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $output_grid->FinancialYear->EditValue ?>"<?php echo $output_grid->FinancialYear->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_FinancialYear">
<span<?php echo $output_grid->FinancialYear->viewAttributes() ?>><?php echo $output_grid->FinancialYear->getViewValue() ?></span>
</span>
<?php if (!$output->isConfirm()) { ?>
<input type="hidden" data-table="output" data-field="x_FinancialYear" name="x<?php echo $output_grid->RowIndex ?>_FinancialYear" id="x<?php echo $output_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($output_grid->FinancialYear->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_FinancialYear" name="o<?php echo $output_grid->RowIndex ?>_FinancialYear" id="o<?php echo $output_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($output_grid->FinancialYear->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output" data-field="x_FinancialYear" name="foutputgrid$x<?php echo $output_grid->RowIndex ?>_FinancialYear" id="foutputgrid$x<?php echo $output_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($output_grid->FinancialYear->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_FinancialYear" name="foutputgrid$o<?php echo $output_grid->RowIndex ?>_FinancialYear" id="foutputgrid$o<?php echo $output_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($output_grid->FinancialYear->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_grid->OutputDescription->Visible) { // OutputDescription ?>
		<td data-name="OutputDescription" <?php echo $output_grid->OutputDescription->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_OutputDescription" class="form-group">
<textarea data-table="output" data-field="x_OutputDescription" name="x<?php echo $output_grid->RowIndex ?>_OutputDescription" id="x<?php echo $output_grid->RowIndex ?>_OutputDescription" cols="50" rows="2" placeholder="<?php echo HtmlEncode($output_grid->OutputDescription->getPlaceHolder()) ?>"<?php echo $output_grid->OutputDescription->editAttributes() ?>><?php echo $output_grid->OutputDescription->EditValue ?></textarea>
</span>
<input type="hidden" data-table="output" data-field="x_OutputDescription" name="o<?php echo $output_grid->RowIndex ?>_OutputDescription" id="o<?php echo $output_grid->RowIndex ?>_OutputDescription" value="<?php echo HtmlEncode($output_grid->OutputDescription->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_OutputDescription" class="form-group">
<textarea data-table="output" data-field="x_OutputDescription" name="x<?php echo $output_grid->RowIndex ?>_OutputDescription" id="x<?php echo $output_grid->RowIndex ?>_OutputDescription" cols="50" rows="2" placeholder="<?php echo HtmlEncode($output_grid->OutputDescription->getPlaceHolder()) ?>"<?php echo $output_grid->OutputDescription->editAttributes() ?>><?php echo $output_grid->OutputDescription->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_OutputDescription">
<span<?php echo $output_grid->OutputDescription->viewAttributes() ?>><?php echo $output_grid->OutputDescription->getViewValue() ?></span>
</span>
<?php if (!$output->isConfirm()) { ?>
<input type="hidden" data-table="output" data-field="x_OutputDescription" name="x<?php echo $output_grid->RowIndex ?>_OutputDescription" id="x<?php echo $output_grid->RowIndex ?>_OutputDescription" value="<?php echo HtmlEncode($output_grid->OutputDescription->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_OutputDescription" name="o<?php echo $output_grid->RowIndex ?>_OutputDescription" id="o<?php echo $output_grid->RowIndex ?>_OutputDescription" value="<?php echo HtmlEncode($output_grid->OutputDescription->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output" data-field="x_OutputDescription" name="foutputgrid$x<?php echo $output_grid->RowIndex ?>_OutputDescription" id="foutputgrid$x<?php echo $output_grid->RowIndex ?>_OutputDescription" value="<?php echo HtmlEncode($output_grid->OutputDescription->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_OutputDescription" name="foutputgrid$o<?php echo $output_grid->RowIndex ?>_OutputDescription" id="foutputgrid$o<?php echo $output_grid->RowIndex ?>_OutputDescription" value="<?php echo HtmlEncode($output_grid->OutputDescription->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_grid->OutputMeansOfVerification->Visible) { // OutputMeansOfVerification ?>
		<td data-name="OutputMeansOfVerification" <?php echo $output_grid->OutputMeansOfVerification->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_OutputMeansOfVerification" class="form-group">
<textarea data-table="output" data-field="x_OutputMeansOfVerification" name="x<?php echo $output_grid->RowIndex ?>_OutputMeansOfVerification" id="x<?php echo $output_grid->RowIndex ?>_OutputMeansOfVerification" cols="50" rows="2" placeholder="<?php echo HtmlEncode($output_grid->OutputMeansOfVerification->getPlaceHolder()) ?>"<?php echo $output_grid->OutputMeansOfVerification->editAttributes() ?>><?php echo $output_grid->OutputMeansOfVerification->EditValue ?></textarea>
</span>
<input type="hidden" data-table="output" data-field="x_OutputMeansOfVerification" name="o<?php echo $output_grid->RowIndex ?>_OutputMeansOfVerification" id="o<?php echo $output_grid->RowIndex ?>_OutputMeansOfVerification" value="<?php echo HtmlEncode($output_grid->OutputMeansOfVerification->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_OutputMeansOfVerification" class="form-group">
<textarea data-table="output" data-field="x_OutputMeansOfVerification" name="x<?php echo $output_grid->RowIndex ?>_OutputMeansOfVerification" id="x<?php echo $output_grid->RowIndex ?>_OutputMeansOfVerification" cols="50" rows="2" placeholder="<?php echo HtmlEncode($output_grid->OutputMeansOfVerification->getPlaceHolder()) ?>"<?php echo $output_grid->OutputMeansOfVerification->editAttributes() ?>><?php echo $output_grid->OutputMeansOfVerification->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_OutputMeansOfVerification">
<span<?php echo $output_grid->OutputMeansOfVerification->viewAttributes() ?>><?php echo $output_grid->OutputMeansOfVerification->getViewValue() ?></span>
</span>
<?php if (!$output->isConfirm()) { ?>
<input type="hidden" data-table="output" data-field="x_OutputMeansOfVerification" name="x<?php echo $output_grid->RowIndex ?>_OutputMeansOfVerification" id="x<?php echo $output_grid->RowIndex ?>_OutputMeansOfVerification" value="<?php echo HtmlEncode($output_grid->OutputMeansOfVerification->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_OutputMeansOfVerification" name="o<?php echo $output_grid->RowIndex ?>_OutputMeansOfVerification" id="o<?php echo $output_grid->RowIndex ?>_OutputMeansOfVerification" value="<?php echo HtmlEncode($output_grid->OutputMeansOfVerification->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output" data-field="x_OutputMeansOfVerification" name="foutputgrid$x<?php echo $output_grid->RowIndex ?>_OutputMeansOfVerification" id="foutputgrid$x<?php echo $output_grid->RowIndex ?>_OutputMeansOfVerification" value="<?php echo HtmlEncode($output_grid->OutputMeansOfVerification->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_OutputMeansOfVerification" name="foutputgrid$o<?php echo $output_grid->RowIndex ?>_OutputMeansOfVerification" id="foutputgrid$o<?php echo $output_grid->RowIndex ?>_OutputMeansOfVerification" value="<?php echo HtmlEncode($output_grid->OutputMeansOfVerification->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_grid->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
		<td data-name="ResponsibleOfficer" <?php echo $output_grid->ResponsibleOfficer->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_ResponsibleOfficer" class="form-group">
<input type="text" data-table="output" data-field="x_ResponsibleOfficer" name="x<?php echo $output_grid->RowIndex ?>_ResponsibleOfficer" id="x<?php echo $output_grid->RowIndex ?>_ResponsibleOfficer" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($output_grid->ResponsibleOfficer->getPlaceHolder()) ?>" value="<?php echo $output_grid->ResponsibleOfficer->EditValue ?>"<?php echo $output_grid->ResponsibleOfficer->editAttributes() ?>>
</span>
<input type="hidden" data-table="output" data-field="x_ResponsibleOfficer" name="o<?php echo $output_grid->RowIndex ?>_ResponsibleOfficer" id="o<?php echo $output_grid->RowIndex ?>_ResponsibleOfficer" value="<?php echo HtmlEncode($output_grid->ResponsibleOfficer->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_ResponsibleOfficer" class="form-group">
<input type="text" data-table="output" data-field="x_ResponsibleOfficer" name="x<?php echo $output_grid->RowIndex ?>_ResponsibleOfficer" id="x<?php echo $output_grid->RowIndex ?>_ResponsibleOfficer" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($output_grid->ResponsibleOfficer->getPlaceHolder()) ?>" value="<?php echo $output_grid->ResponsibleOfficer->EditValue ?>"<?php echo $output_grid->ResponsibleOfficer->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_ResponsibleOfficer">
<span<?php echo $output_grid->ResponsibleOfficer->viewAttributes() ?>><?php echo $output_grid->ResponsibleOfficer->getViewValue() ?></span>
</span>
<?php if (!$output->isConfirm()) { ?>
<input type="hidden" data-table="output" data-field="x_ResponsibleOfficer" name="x<?php echo $output_grid->RowIndex ?>_ResponsibleOfficer" id="x<?php echo $output_grid->RowIndex ?>_ResponsibleOfficer" value="<?php echo HtmlEncode($output_grid->ResponsibleOfficer->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_ResponsibleOfficer" name="o<?php echo $output_grid->RowIndex ?>_ResponsibleOfficer" id="o<?php echo $output_grid->RowIndex ?>_ResponsibleOfficer" value="<?php echo HtmlEncode($output_grid->ResponsibleOfficer->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output" data-field="x_ResponsibleOfficer" name="foutputgrid$x<?php echo $output_grid->RowIndex ?>_ResponsibleOfficer" id="foutputgrid$x<?php echo $output_grid->RowIndex ?>_ResponsibleOfficer" value="<?php echo HtmlEncode($output_grid->ResponsibleOfficer->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_ResponsibleOfficer" name="foutputgrid$o<?php echo $output_grid->RowIndex ?>_ResponsibleOfficer" id="foutputgrid$o<?php echo $output_grid->RowIndex ?>_ResponsibleOfficer" value="<?php echo HtmlEncode($output_grid->ResponsibleOfficer->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_grid->Clients->Visible) { // Clients ?>
		<td data-name="Clients" <?php echo $output_grid->Clients->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_Clients" class="form-group">
<textarea data-table="output" data-field="x_Clients" name="x<?php echo $output_grid->RowIndex ?>_Clients" id="x<?php echo $output_grid->RowIndex ?>_Clients" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_grid->Clients->getPlaceHolder()) ?>"<?php echo $output_grid->Clients->editAttributes() ?>><?php echo $output_grid->Clients->EditValue ?></textarea>
</span>
<input type="hidden" data-table="output" data-field="x_Clients" name="o<?php echo $output_grid->RowIndex ?>_Clients" id="o<?php echo $output_grid->RowIndex ?>_Clients" value="<?php echo HtmlEncode($output_grid->Clients->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_Clients" class="form-group">
<textarea data-table="output" data-field="x_Clients" name="x<?php echo $output_grid->RowIndex ?>_Clients" id="x<?php echo $output_grid->RowIndex ?>_Clients" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_grid->Clients->getPlaceHolder()) ?>"<?php echo $output_grid->Clients->editAttributes() ?>><?php echo $output_grid->Clients->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_Clients">
<span<?php echo $output_grid->Clients->viewAttributes() ?>><?php echo $output_grid->Clients->getViewValue() ?></span>
</span>
<?php if (!$output->isConfirm()) { ?>
<input type="hidden" data-table="output" data-field="x_Clients" name="x<?php echo $output_grid->RowIndex ?>_Clients" id="x<?php echo $output_grid->RowIndex ?>_Clients" value="<?php echo HtmlEncode($output_grid->Clients->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_Clients" name="o<?php echo $output_grid->RowIndex ?>_Clients" id="o<?php echo $output_grid->RowIndex ?>_Clients" value="<?php echo HtmlEncode($output_grid->Clients->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output" data-field="x_Clients" name="foutputgrid$x<?php echo $output_grid->RowIndex ?>_Clients" id="foutputgrid$x<?php echo $output_grid->RowIndex ?>_Clients" value="<?php echo HtmlEncode($output_grid->Clients->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_Clients" name="foutputgrid$o<?php echo $output_grid->RowIndex ?>_Clients" id="foutputgrid$o<?php echo $output_grid->RowIndex ?>_Clients" value="<?php echo HtmlEncode($output_grid->Clients->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_grid->Beneficiaries->Visible) { // Beneficiaries ?>
		<td data-name="Beneficiaries" <?php echo $output_grid->Beneficiaries->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_Beneficiaries" class="form-group">
<textarea data-table="output" data-field="x_Beneficiaries" name="x<?php echo $output_grid->RowIndex ?>_Beneficiaries" id="x<?php echo $output_grid->RowIndex ?>_Beneficiaries" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_grid->Beneficiaries->getPlaceHolder()) ?>"<?php echo $output_grid->Beneficiaries->editAttributes() ?>><?php echo $output_grid->Beneficiaries->EditValue ?></textarea>
</span>
<input type="hidden" data-table="output" data-field="x_Beneficiaries" name="o<?php echo $output_grid->RowIndex ?>_Beneficiaries" id="o<?php echo $output_grid->RowIndex ?>_Beneficiaries" value="<?php echo HtmlEncode($output_grid->Beneficiaries->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_Beneficiaries" class="form-group">
<textarea data-table="output" data-field="x_Beneficiaries" name="x<?php echo $output_grid->RowIndex ?>_Beneficiaries" id="x<?php echo $output_grid->RowIndex ?>_Beneficiaries" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_grid->Beneficiaries->getPlaceHolder()) ?>"<?php echo $output_grid->Beneficiaries->editAttributes() ?>><?php echo $output_grid->Beneficiaries->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_Beneficiaries">
<span<?php echo $output_grid->Beneficiaries->viewAttributes() ?>><?php echo $output_grid->Beneficiaries->getViewValue() ?></span>
</span>
<?php if (!$output->isConfirm()) { ?>
<input type="hidden" data-table="output" data-field="x_Beneficiaries" name="x<?php echo $output_grid->RowIndex ?>_Beneficiaries" id="x<?php echo $output_grid->RowIndex ?>_Beneficiaries" value="<?php echo HtmlEncode($output_grid->Beneficiaries->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_Beneficiaries" name="o<?php echo $output_grid->RowIndex ?>_Beneficiaries" id="o<?php echo $output_grid->RowIndex ?>_Beneficiaries" value="<?php echo HtmlEncode($output_grid->Beneficiaries->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output" data-field="x_Beneficiaries" name="foutputgrid$x<?php echo $output_grid->RowIndex ?>_Beneficiaries" id="foutputgrid$x<?php echo $output_grid->RowIndex ?>_Beneficiaries" value="<?php echo HtmlEncode($output_grid->Beneficiaries->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_Beneficiaries" name="foutputgrid$o<?php echo $output_grid->RowIndex ?>_Beneficiaries" id="foutputgrid$o<?php echo $output_grid->RowIndex ?>_Beneficiaries" value="<?php echo HtmlEncode($output_grid->Beneficiaries->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_grid->OutputStatus->Visible) { // OutputStatus ?>
		<td data-name="OutputStatus" <?php echo $output_grid->OutputStatus->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_OutputStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="output" data-field="x_OutputStatus" data-value-separator="<?php echo $output_grid->OutputStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $output_grid->RowIndex ?>_OutputStatus" name="x<?php echo $output_grid->RowIndex ?>_OutputStatus"<?php echo $output_grid->OutputStatus->editAttributes() ?>>
			<?php echo $output_grid->OutputStatus->selectOptionListHtml("x{$output_grid->RowIndex}_OutputStatus") ?>
		</select>
</div>
<?php echo $output_grid->OutputStatus->Lookup->getParamTag($output_grid, "p_x" . $output_grid->RowIndex . "_OutputStatus") ?>
</span>
<input type="hidden" data-table="output" data-field="x_OutputStatus" name="o<?php echo $output_grid->RowIndex ?>_OutputStatus" id="o<?php echo $output_grid->RowIndex ?>_OutputStatus" value="<?php echo HtmlEncode($output_grid->OutputStatus->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_OutputStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="output" data-field="x_OutputStatus" data-value-separator="<?php echo $output_grid->OutputStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $output_grid->RowIndex ?>_OutputStatus" name="x<?php echo $output_grid->RowIndex ?>_OutputStatus"<?php echo $output_grid->OutputStatus->editAttributes() ?>>
			<?php echo $output_grid->OutputStatus->selectOptionListHtml("x{$output_grid->RowIndex}_OutputStatus") ?>
		</select>
</div>
<?php echo $output_grid->OutputStatus->Lookup->getParamTag($output_grid, "p_x" . $output_grid->RowIndex . "_OutputStatus") ?>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_OutputStatus">
<span<?php echo $output_grid->OutputStatus->viewAttributes() ?>><?php echo $output_grid->OutputStatus->getViewValue() ?></span>
</span>
<?php if (!$output->isConfirm()) { ?>
<input type="hidden" data-table="output" data-field="x_OutputStatus" name="x<?php echo $output_grid->RowIndex ?>_OutputStatus" id="x<?php echo $output_grid->RowIndex ?>_OutputStatus" value="<?php echo HtmlEncode($output_grid->OutputStatus->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_OutputStatus" name="o<?php echo $output_grid->RowIndex ?>_OutputStatus" id="o<?php echo $output_grid->RowIndex ?>_OutputStatus" value="<?php echo HtmlEncode($output_grid->OutputStatus->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output" data-field="x_OutputStatus" name="foutputgrid$x<?php echo $output_grid->RowIndex ?>_OutputStatus" id="foutputgrid$x<?php echo $output_grid->RowIndex ?>_OutputStatus" value="<?php echo HtmlEncode($output_grid->OutputStatus->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_OutputStatus" name="foutputgrid$o<?php echo $output_grid->RowIndex ?>_OutputStatus" id="foutputgrid$o<?php echo $output_grid->RowIndex ?>_OutputStatus" value="<?php echo HtmlEncode($output_grid->OutputStatus->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_grid->TargetAmount->Visible) { // TargetAmount ?>
		<td data-name="TargetAmount" <?php echo $output_grid->TargetAmount->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_TargetAmount" class="form-group">
<input type="text" data-table="output" data-field="x_TargetAmount" name="x<?php echo $output_grid->RowIndex ?>_TargetAmount" id="x<?php echo $output_grid->RowIndex ?>_TargetAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_grid->TargetAmount->getPlaceHolder()) ?>" value="<?php echo $output_grid->TargetAmount->EditValue ?>"<?php echo $output_grid->TargetAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="output" data-field="x_TargetAmount" name="o<?php echo $output_grid->RowIndex ?>_TargetAmount" id="o<?php echo $output_grid->RowIndex ?>_TargetAmount" value="<?php echo HtmlEncode($output_grid->TargetAmount->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_TargetAmount" class="form-group">
<input type="text" data-table="output" data-field="x_TargetAmount" name="x<?php echo $output_grid->RowIndex ?>_TargetAmount" id="x<?php echo $output_grid->RowIndex ?>_TargetAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_grid->TargetAmount->getPlaceHolder()) ?>" value="<?php echo $output_grid->TargetAmount->EditValue ?>"<?php echo $output_grid->TargetAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_TargetAmount">
<span<?php echo $output_grid->TargetAmount->viewAttributes() ?>><?php echo $output_grid->TargetAmount->getViewValue() ?></span>
</span>
<?php if (!$output->isConfirm()) { ?>
<input type="hidden" data-table="output" data-field="x_TargetAmount" name="x<?php echo $output_grid->RowIndex ?>_TargetAmount" id="x<?php echo $output_grid->RowIndex ?>_TargetAmount" value="<?php echo HtmlEncode($output_grid->TargetAmount->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_TargetAmount" name="o<?php echo $output_grid->RowIndex ?>_TargetAmount" id="o<?php echo $output_grid->RowIndex ?>_TargetAmount" value="<?php echo HtmlEncode($output_grid->TargetAmount->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output" data-field="x_TargetAmount" name="foutputgrid$x<?php echo $output_grid->RowIndex ?>_TargetAmount" id="foutputgrid$x<?php echo $output_grid->RowIndex ?>_TargetAmount" value="<?php echo HtmlEncode($output_grid->TargetAmount->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_TargetAmount" name="foutputgrid$o<?php echo $output_grid->RowIndex ?>_TargetAmount" id="foutputgrid$o<?php echo $output_grid->RowIndex ?>_TargetAmount" value="<?php echo HtmlEncode($output_grid->TargetAmount->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_grid->ActualAmount->Visible) { // ActualAmount ?>
		<td data-name="ActualAmount" <?php echo $output_grid->ActualAmount->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_ActualAmount" class="form-group">
<input type="text" data-table="output" data-field="x_ActualAmount" name="x<?php echo $output_grid->RowIndex ?>_ActualAmount" id="x<?php echo $output_grid->RowIndex ?>_ActualAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_grid->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $output_grid->ActualAmount->EditValue ?>"<?php echo $output_grid->ActualAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="output" data-field="x_ActualAmount" name="o<?php echo $output_grid->RowIndex ?>_ActualAmount" id="o<?php echo $output_grid->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($output_grid->ActualAmount->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_ActualAmount" class="form-group">
<input type="text" data-table="output" data-field="x_ActualAmount" name="x<?php echo $output_grid->RowIndex ?>_ActualAmount" id="x<?php echo $output_grid->RowIndex ?>_ActualAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_grid->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $output_grid->ActualAmount->EditValue ?>"<?php echo $output_grid->ActualAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_ActualAmount">
<span<?php echo $output_grid->ActualAmount->viewAttributes() ?>><?php echo $output_grid->ActualAmount->getViewValue() ?></span>
</span>
<?php if (!$output->isConfirm()) { ?>
<input type="hidden" data-table="output" data-field="x_ActualAmount" name="x<?php echo $output_grid->RowIndex ?>_ActualAmount" id="x<?php echo $output_grid->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($output_grid->ActualAmount->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_ActualAmount" name="o<?php echo $output_grid->RowIndex ?>_ActualAmount" id="o<?php echo $output_grid->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($output_grid->ActualAmount->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output" data-field="x_ActualAmount" name="foutputgrid$x<?php echo $output_grid->RowIndex ?>_ActualAmount" id="foutputgrid$x<?php echo $output_grid->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($output_grid->ActualAmount->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_ActualAmount" name="foutputgrid$o<?php echo $output_grid->RowIndex ?>_ActualAmount" id="foutputgrid$o<?php echo $output_grid->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($output_grid->ActualAmount->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_grid->PercentAchieved->Visible) { // PercentAchieved ?>
		<td data-name="PercentAchieved" <?php echo $output_grid->PercentAchieved->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_PercentAchieved" class="form-group">
<input type="text" data-table="output" data-field="x_PercentAchieved" name="x<?php echo $output_grid->RowIndex ?>_PercentAchieved" id="x<?php echo $output_grid->RowIndex ?>_PercentAchieved" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_grid->PercentAchieved->getPlaceHolder()) ?>" value="<?php echo $output_grid->PercentAchieved->EditValue ?>"<?php echo $output_grid->PercentAchieved->editAttributes() ?>>
</span>
<input type="hidden" data-table="output" data-field="x_PercentAchieved" name="o<?php echo $output_grid->RowIndex ?>_PercentAchieved" id="o<?php echo $output_grid->RowIndex ?>_PercentAchieved" value="<?php echo HtmlEncode($output_grid->PercentAchieved->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_PercentAchieved" class="form-group">
<input type="text" data-table="output" data-field="x_PercentAchieved" name="x<?php echo $output_grid->RowIndex ?>_PercentAchieved" id="x<?php echo $output_grid->RowIndex ?>_PercentAchieved" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_grid->PercentAchieved->getPlaceHolder()) ?>" value="<?php echo $output_grid->PercentAchieved->EditValue ?>"<?php echo $output_grid->PercentAchieved->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_grid->RowCount ?>_output_PercentAchieved">
<span<?php echo $output_grid->PercentAchieved->viewAttributes() ?>><?php echo $output_grid->PercentAchieved->getViewValue() ?></span>
</span>
<?php if (!$output->isConfirm()) { ?>
<input type="hidden" data-table="output" data-field="x_PercentAchieved" name="x<?php echo $output_grid->RowIndex ?>_PercentAchieved" id="x<?php echo $output_grid->RowIndex ?>_PercentAchieved" value="<?php echo HtmlEncode($output_grid->PercentAchieved->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_PercentAchieved" name="o<?php echo $output_grid->RowIndex ?>_PercentAchieved" id="o<?php echo $output_grid->RowIndex ?>_PercentAchieved" value="<?php echo HtmlEncode($output_grid->PercentAchieved->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="output" data-field="x_PercentAchieved" name="foutputgrid$x<?php echo $output_grid->RowIndex ?>_PercentAchieved" id="foutputgrid$x<?php echo $output_grid->RowIndex ?>_PercentAchieved" value="<?php echo HtmlEncode($output_grid->PercentAchieved->FormValue) ?>">
<input type="hidden" data-table="output" data-field="x_PercentAchieved" name="foutputgrid$o<?php echo $output_grid->RowIndex ?>_PercentAchieved" id="foutputgrid$o<?php echo $output_grid->RowIndex ?>_PercentAchieved" value="<?php echo HtmlEncode($output_grid->PercentAchieved->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$output_grid->ListOptions->render("body", "right", $output_grid->RowCount);
?>
	</tr>
<?php if ($output->RowType == ROWTYPE_ADD || $output->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["foutputgrid", "load"], function() {
	foutputgrid.updateLists(<?php echo $output_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$output_grid->isGridAdd() || $output->CurrentMode == "copy")
		if (!$output_grid->Recordset->EOF)
			$output_grid->Recordset->moveNext();
}
?>
<?php
	if ($output->CurrentMode == "add" || $output->CurrentMode == "copy" || $output->CurrentMode == "edit") {
		$output_grid->RowIndex = '$rowindex$';
		$output_grid->loadRowValues();

		// Set row properties
		$output->resetAttributes();
		$output->RowAttrs->merge(["data-rowindex" => $output_grid->RowIndex, "id" => "r0_output", "data-rowtype" => ROWTYPE_ADD]);
		$output->RowAttrs->appendClass("ew-template");
		$output->RowType = ROWTYPE_ADD;

		// Render row
		$output_grid->renderRow();

		// Render list options
		$output_grid->renderListOptions();
		$output_grid->StartRowCount = 0;
?>
	<tr <?php echo $output->rowAttributes() ?>>
<?php

// Render list options (body, left)
$output_grid->ListOptions->render("body", "left", $output_grid->RowIndex);
?>
	<?php if ($output_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if (!$output->isConfirm()) { ?>
<?php if ($output_grid->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_output_LACode" class="form-group output_LACode">
<span<?php echo $output_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_grid->RowIndex ?>_LACode" name="x<?php echo $output_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_output_LACode" class="form-group output_LACode">
<?php
$onchange = $output_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_grid->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $output_grid->RowIndex ?>_LACode" id="sv_x<?php echo $output_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($output_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($output_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_grid->LACode->getPlaceHolder()) ?>"<?php echo $output_grid->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_grid->RowIndex ?>_LACode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($output_grid->LACode->ReadOnly || $output_grid->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="output" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_grid->RowIndex ?>_LACode" id="x<?php echo $output_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutputgrid"], function() {
	foutputgrid.createAutoSuggest({"id":"x<?php echo $output_grid->RowIndex ?>_LACode","forceSelect":true});
});
</script>
<?php echo $output_grid->LACode->Lookup->getParamTag($output_grid, "p_x" . $output_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_output_LACode" class="form-group output_LACode">
<span<?php echo $output_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output" data-field="x_LACode" name="x<?php echo $output_grid->RowIndex ?>_LACode" id="x<?php echo $output_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_grid->LACode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output" data-field="x_LACode" name="o<?php echo $output_grid->RowIndex ?>_LACode" id="o<?php echo $output_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_grid->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<?php if (!$output->isConfirm()) { ?>
<?php if ($output_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_output_DepartmentCode" class="form-group output_DepartmentCode">
<span<?php echo $output_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $output_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_output_DepartmentCode" class="form-group output_DepartmentCode">
<?php $output_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $output_grid->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($output_grid->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_grid->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_grid->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_grid->DepartmentCode->ReadOnly || $output_grid->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_grid->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_grid->DepartmentCode->Lookup->getParamTag($output_grid, "p_x" . $output_grid->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="output" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $output_grid->RowIndex ?>_DepartmentCode" value="<?php echo $output_grid->DepartmentCode->CurrentValue ?>"<?php echo $output_grid->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_output_DepartmentCode" class="form-group output_DepartmentCode">
<span<?php echo $output_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output" data-field="x_DepartmentCode" name="x<?php echo $output_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $output_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_grid->DepartmentCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output" data-field="x_DepartmentCode" name="o<?php echo $output_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $output_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_grid->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode">
<?php if (!$output->isConfirm()) { ?>
<span id="el$rowindex$_output_SectionCode" class="form-group output_SectionCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $output_grid->RowIndex ?>_SectionCode"><?php echo EmptyValue(strval($output_grid->SectionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_grid->SectionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_grid->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_grid->SectionCode->ReadOnly || $output_grid->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_grid->RowIndex ?>_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_grid->SectionCode->Lookup->getParamTag($output_grid, "p_x" . $output_grid->RowIndex . "_SectionCode") ?>
<input type="hidden" data-table="output" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_grid->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_grid->RowIndex ?>_SectionCode" id="x<?php echo $output_grid->RowIndex ?>_SectionCode" value="<?php echo $output_grid->SectionCode->CurrentValue ?>"<?php echo $output_grid->SectionCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_output_SectionCode" class="form-group output_SectionCode">
<span<?php echo $output_grid->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output" data-field="x_SectionCode" name="x<?php echo $output_grid->RowIndex ?>_SectionCode" id="x<?php echo $output_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_grid->SectionCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output" data-field="x_SectionCode" name="o<?php echo $output_grid->RowIndex ?>_SectionCode" id="o<?php echo $output_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_grid->SectionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_grid->OutcomeCode->Visible) { // OutcomeCode ?>
		<td data-name="OutcomeCode">
<?php if (!$output->isConfirm()) { ?>
<?php if ($output_grid->OutcomeCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_output_OutcomeCode" class="form-group output_OutcomeCode">
<span<?php echo $output_grid->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_grid->RowIndex ?>_OutcomeCode" name="x<?php echo $output_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_grid->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_output_OutcomeCode" class="form-group output_OutcomeCode">
<?php $output_grid->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $output_grid->RowIndex ?>_OutcomeCode"><?php echo EmptyValue(strval($output_grid->OutcomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_grid->OutcomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_grid->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_grid->OutcomeCode->ReadOnly || $output_grid->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_grid->RowIndex ?>_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_grid->OutcomeCode->Lookup->getParamTag($output_grid, "p_x" . $output_grid->RowIndex . "_OutcomeCode") ?>
<input type="hidden" data-table="output" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_grid->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_grid->RowIndex ?>_OutcomeCode" id="x<?php echo $output_grid->RowIndex ?>_OutcomeCode" value="<?php echo $output_grid->OutcomeCode->CurrentValue ?>"<?php echo $output_grid->OutcomeCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_output_OutcomeCode" class="form-group output_OutcomeCode">
<span<?php echo $output_grid->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output" data-field="x_OutcomeCode" name="x<?php echo $output_grid->RowIndex ?>_OutcomeCode" id="x<?php echo $output_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_grid->OutcomeCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output" data-field="x_OutcomeCode" name="o<?php echo $output_grid->RowIndex ?>_OutcomeCode" id="o<?php echo $output_grid->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_grid->OutcomeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_grid->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode">
<?php if (!$output->isConfirm()) { ?>
<span id="el$rowindex$_output_ProgramCode" class="form-group output_ProgramCode">
<?php
$onchange = $output_grid->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_grid->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_grid->RowIndex ?>_ProgramCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $output_grid->RowIndex ?>_ProgramCode" id="sv_x<?php echo $output_grid->RowIndex ?>_ProgramCode" value="<?php echo RemoveHtml($output_grid->ProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_grid->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_grid->ProgramCode->getPlaceHolder()) ?>"<?php echo $output_grid->ProgramCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_grid->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_grid->RowIndex ?>_ProgramCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($output_grid->ProgramCode->ReadOnly || $output_grid->ProgramCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="output" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_grid->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_grid->RowIndex ?>_ProgramCode" id="x<?php echo $output_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_grid->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutputgrid"], function() {
	foutputgrid.createAutoSuggest({"id":"x<?php echo $output_grid->RowIndex ?>_ProgramCode","forceSelect":true});
});
</script>
<?php echo $output_grid->ProgramCode->Lookup->getParamTag($output_grid, "p_x" . $output_grid->RowIndex . "_ProgramCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_output_ProgramCode" class="form-group output_ProgramCode">
<span<?php echo $output_grid->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output" data-field="x_ProgramCode" name="x<?php echo $output_grid->RowIndex ?>_ProgramCode" id="x<?php echo $output_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_grid->ProgramCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output" data-field="x_ProgramCode" name="o<?php echo $output_grid->RowIndex ?>_ProgramCode" id="o<?php echo $output_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_grid->ProgramCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_grid->SubProgramCode->Visible) { // SubProgramCode ?>
		<td data-name="SubProgramCode">
<?php if (!$output->isConfirm()) { ?>
<span id="el$rowindex$_output_SubProgramCode" class="form-group output_SubProgramCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $output_grid->RowIndex ?>_SubProgramCode"><?php echo EmptyValue(strval($output_grid->SubProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_grid->SubProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_grid->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_grid->SubProgramCode->ReadOnly || $output_grid->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_grid->RowIndex ?>_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_grid->SubProgramCode->Lookup->getParamTag($output_grid, "p_x" . $output_grid->RowIndex . "_SubProgramCode") ?>
<input type="hidden" data-table="output" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_grid->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_grid->RowIndex ?>_SubProgramCode" id="x<?php echo $output_grid->RowIndex ?>_SubProgramCode" value="<?php echo $output_grid->SubProgramCode->CurrentValue ?>"<?php echo $output_grid->SubProgramCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_output_SubProgramCode" class="form-group output_SubProgramCode">
<span<?php echo $output_grid->SubProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->SubProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output" data-field="x_SubProgramCode" name="x<?php echo $output_grid->RowIndex ?>_SubProgramCode" id="x<?php echo $output_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_grid->SubProgramCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output" data-field="x_SubProgramCode" name="o<?php echo $output_grid->RowIndex ?>_SubProgramCode" id="o<?php echo $output_grid->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_grid->SubProgramCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_grid->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode">
<?php if (!$output->isConfirm()) { ?>
<span id="el$rowindex$_output_OutputCode" class="form-group output_OutputCode"></span>
<?php } else { ?>
<span id="el$rowindex$_output_OutputCode" class="form-group output_OutputCode">
<span<?php echo $output_grid->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output" data-field="x_OutputCode" name="x<?php echo $output_grid->RowIndex ?>_OutputCode" id="x<?php echo $output_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_grid->OutputCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output" data-field="x_OutputCode" name="o<?php echo $output_grid->RowIndex ?>_OutputCode" id="o<?php echo $output_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_grid->OutputCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_grid->OutputType->Visible) { // OutputType ?>
		<td data-name="OutputType">
<?php if (!$output->isConfirm()) { ?>
<span id="el$rowindex$_output_OutputType" class="form-group output_OutputType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="output" data-field="x_OutputType" data-value-separator="<?php echo $output_grid->OutputType->displayValueSeparatorAttribute() ?>" id="x<?php echo $output_grid->RowIndex ?>_OutputType" name="x<?php echo $output_grid->RowIndex ?>_OutputType"<?php echo $output_grid->OutputType->editAttributes() ?>>
			<?php echo $output_grid->OutputType->selectOptionListHtml("x{$output_grid->RowIndex}_OutputType") ?>
		</select>
</div>
<?php echo $output_grid->OutputType->Lookup->getParamTag($output_grid, "p_x" . $output_grid->RowIndex . "_OutputType") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_output_OutputType" class="form-group output_OutputType">
<span<?php echo $output_grid->OutputType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->OutputType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output" data-field="x_OutputType" name="x<?php echo $output_grid->RowIndex ?>_OutputType" id="x<?php echo $output_grid->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_grid->OutputType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output" data-field="x_OutputType" name="o<?php echo $output_grid->RowIndex ?>_OutputType" id="o<?php echo $output_grid->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_grid->OutputType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_grid->OutputName->Visible) { // OutputName ?>
		<td data-name="OutputName">
<?php if (!$output->isConfirm()) { ?>
<span id="el$rowindex$_output_OutputName" class="form-group output_OutputName">
<textarea data-table="output" data-field="x_OutputName" name="x<?php echo $output_grid->RowIndex ?>_OutputName" id="x<?php echo $output_grid->RowIndex ?>_OutputName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_grid->OutputName->getPlaceHolder()) ?>"<?php echo $output_grid->OutputName->editAttributes() ?>><?php echo $output_grid->OutputName->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_output_OutputName" class="form-group output_OutputName">
<span<?php echo $output_grid->OutputName->viewAttributes() ?>><?php echo $output_grid->OutputName->ViewValue ?></span>
</span>
<input type="hidden" data-table="output" data-field="x_OutputName" name="x<?php echo $output_grid->RowIndex ?>_OutputName" id="x<?php echo $output_grid->RowIndex ?>_OutputName" value="<?php echo HtmlEncode($output_grid->OutputName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output" data-field="x_OutputName" name="o<?php echo $output_grid->RowIndex ?>_OutputName" id="o<?php echo $output_grid->RowIndex ?>_OutputName" value="<?php echo HtmlEncode($output_grid->OutputName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_grid->DeliveryDate->Visible) { // DeliveryDate ?>
		<td data-name="DeliveryDate">
<?php if (!$output->isConfirm()) { ?>
<span id="el$rowindex$_output_DeliveryDate" class="form-group output_DeliveryDate">
<input type="text" data-table="output" data-field="x_DeliveryDate" name="x<?php echo $output_grid->RowIndex ?>_DeliveryDate" id="x<?php echo $output_grid->RowIndex ?>_DeliveryDate" placeholder="<?php echo HtmlEncode($output_grid->DeliveryDate->getPlaceHolder()) ?>" value="<?php echo $output_grid->DeliveryDate->EditValue ?>"<?php echo $output_grid->DeliveryDate->editAttributes() ?>>
<?php if (!$output_grid->DeliveryDate->ReadOnly && !$output_grid->DeliveryDate->Disabled && !isset($output_grid->DeliveryDate->EditAttrs["readonly"]) && !isset($output_grid->DeliveryDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["foutputgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("foutputgrid", "x<?php echo $output_grid->RowIndex ?>_DeliveryDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_output_DeliveryDate" class="form-group output_DeliveryDate">
<span<?php echo $output_grid->DeliveryDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->DeliveryDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output" data-field="x_DeliveryDate" name="x<?php echo $output_grid->RowIndex ?>_DeliveryDate" id="x<?php echo $output_grid->RowIndex ?>_DeliveryDate" value="<?php echo HtmlEncode($output_grid->DeliveryDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output" data-field="x_DeliveryDate" name="o<?php echo $output_grid->RowIndex ?>_DeliveryDate" id="o<?php echo $output_grid->RowIndex ?>_DeliveryDate" value="<?php echo HtmlEncode($output_grid->DeliveryDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_grid->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear">
<?php if (!$output->isConfirm()) { ?>
<span id="el$rowindex$_output_FinancialYear" class="form-group output_FinancialYear">
<input type="text" data-table="output" data-field="x_FinancialYear" name="x<?php echo $output_grid->RowIndex ?>_FinancialYear" id="x<?php echo $output_grid->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($output_grid->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $output_grid->FinancialYear->EditValue ?>"<?php echo $output_grid->FinancialYear->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_output_FinancialYear" class="form-group output_FinancialYear">
<span<?php echo $output_grid->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output" data-field="x_FinancialYear" name="x<?php echo $output_grid->RowIndex ?>_FinancialYear" id="x<?php echo $output_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($output_grid->FinancialYear->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output" data-field="x_FinancialYear" name="o<?php echo $output_grid->RowIndex ?>_FinancialYear" id="o<?php echo $output_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($output_grid->FinancialYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_grid->OutputDescription->Visible) { // OutputDescription ?>
		<td data-name="OutputDescription">
<?php if (!$output->isConfirm()) { ?>
<span id="el$rowindex$_output_OutputDescription" class="form-group output_OutputDescription">
<textarea data-table="output" data-field="x_OutputDescription" name="x<?php echo $output_grid->RowIndex ?>_OutputDescription" id="x<?php echo $output_grid->RowIndex ?>_OutputDescription" cols="50" rows="2" placeholder="<?php echo HtmlEncode($output_grid->OutputDescription->getPlaceHolder()) ?>"<?php echo $output_grid->OutputDescription->editAttributes() ?>><?php echo $output_grid->OutputDescription->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_output_OutputDescription" class="form-group output_OutputDescription">
<span<?php echo $output_grid->OutputDescription->viewAttributes() ?>><?php echo $output_grid->OutputDescription->ViewValue ?></span>
</span>
<input type="hidden" data-table="output" data-field="x_OutputDescription" name="x<?php echo $output_grid->RowIndex ?>_OutputDescription" id="x<?php echo $output_grid->RowIndex ?>_OutputDescription" value="<?php echo HtmlEncode($output_grid->OutputDescription->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output" data-field="x_OutputDescription" name="o<?php echo $output_grid->RowIndex ?>_OutputDescription" id="o<?php echo $output_grid->RowIndex ?>_OutputDescription" value="<?php echo HtmlEncode($output_grid->OutputDescription->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_grid->OutputMeansOfVerification->Visible) { // OutputMeansOfVerification ?>
		<td data-name="OutputMeansOfVerification">
<?php if (!$output->isConfirm()) { ?>
<span id="el$rowindex$_output_OutputMeansOfVerification" class="form-group output_OutputMeansOfVerification">
<textarea data-table="output" data-field="x_OutputMeansOfVerification" name="x<?php echo $output_grid->RowIndex ?>_OutputMeansOfVerification" id="x<?php echo $output_grid->RowIndex ?>_OutputMeansOfVerification" cols="50" rows="2" placeholder="<?php echo HtmlEncode($output_grid->OutputMeansOfVerification->getPlaceHolder()) ?>"<?php echo $output_grid->OutputMeansOfVerification->editAttributes() ?>><?php echo $output_grid->OutputMeansOfVerification->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_output_OutputMeansOfVerification" class="form-group output_OutputMeansOfVerification">
<span<?php echo $output_grid->OutputMeansOfVerification->viewAttributes() ?>><?php echo $output_grid->OutputMeansOfVerification->ViewValue ?></span>
</span>
<input type="hidden" data-table="output" data-field="x_OutputMeansOfVerification" name="x<?php echo $output_grid->RowIndex ?>_OutputMeansOfVerification" id="x<?php echo $output_grid->RowIndex ?>_OutputMeansOfVerification" value="<?php echo HtmlEncode($output_grid->OutputMeansOfVerification->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output" data-field="x_OutputMeansOfVerification" name="o<?php echo $output_grid->RowIndex ?>_OutputMeansOfVerification" id="o<?php echo $output_grid->RowIndex ?>_OutputMeansOfVerification" value="<?php echo HtmlEncode($output_grid->OutputMeansOfVerification->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_grid->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
		<td data-name="ResponsibleOfficer">
<?php if (!$output->isConfirm()) { ?>
<span id="el$rowindex$_output_ResponsibleOfficer" class="form-group output_ResponsibleOfficer">
<input type="text" data-table="output" data-field="x_ResponsibleOfficer" name="x<?php echo $output_grid->RowIndex ?>_ResponsibleOfficer" id="x<?php echo $output_grid->RowIndex ?>_ResponsibleOfficer" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($output_grid->ResponsibleOfficer->getPlaceHolder()) ?>" value="<?php echo $output_grid->ResponsibleOfficer->EditValue ?>"<?php echo $output_grid->ResponsibleOfficer->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_output_ResponsibleOfficer" class="form-group output_ResponsibleOfficer">
<span<?php echo $output_grid->ResponsibleOfficer->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->ResponsibleOfficer->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output" data-field="x_ResponsibleOfficer" name="x<?php echo $output_grid->RowIndex ?>_ResponsibleOfficer" id="x<?php echo $output_grid->RowIndex ?>_ResponsibleOfficer" value="<?php echo HtmlEncode($output_grid->ResponsibleOfficer->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output" data-field="x_ResponsibleOfficer" name="o<?php echo $output_grid->RowIndex ?>_ResponsibleOfficer" id="o<?php echo $output_grid->RowIndex ?>_ResponsibleOfficer" value="<?php echo HtmlEncode($output_grid->ResponsibleOfficer->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_grid->Clients->Visible) { // Clients ?>
		<td data-name="Clients">
<?php if (!$output->isConfirm()) { ?>
<span id="el$rowindex$_output_Clients" class="form-group output_Clients">
<textarea data-table="output" data-field="x_Clients" name="x<?php echo $output_grid->RowIndex ?>_Clients" id="x<?php echo $output_grid->RowIndex ?>_Clients" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_grid->Clients->getPlaceHolder()) ?>"<?php echo $output_grid->Clients->editAttributes() ?>><?php echo $output_grid->Clients->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_output_Clients" class="form-group output_Clients">
<span<?php echo $output_grid->Clients->viewAttributes() ?>><?php echo $output_grid->Clients->ViewValue ?></span>
</span>
<input type="hidden" data-table="output" data-field="x_Clients" name="x<?php echo $output_grid->RowIndex ?>_Clients" id="x<?php echo $output_grid->RowIndex ?>_Clients" value="<?php echo HtmlEncode($output_grid->Clients->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output" data-field="x_Clients" name="o<?php echo $output_grid->RowIndex ?>_Clients" id="o<?php echo $output_grid->RowIndex ?>_Clients" value="<?php echo HtmlEncode($output_grid->Clients->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_grid->Beneficiaries->Visible) { // Beneficiaries ?>
		<td data-name="Beneficiaries">
<?php if (!$output->isConfirm()) { ?>
<span id="el$rowindex$_output_Beneficiaries" class="form-group output_Beneficiaries">
<textarea data-table="output" data-field="x_Beneficiaries" name="x<?php echo $output_grid->RowIndex ?>_Beneficiaries" id="x<?php echo $output_grid->RowIndex ?>_Beneficiaries" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_grid->Beneficiaries->getPlaceHolder()) ?>"<?php echo $output_grid->Beneficiaries->editAttributes() ?>><?php echo $output_grid->Beneficiaries->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_output_Beneficiaries" class="form-group output_Beneficiaries">
<span<?php echo $output_grid->Beneficiaries->viewAttributes() ?>><?php echo $output_grid->Beneficiaries->ViewValue ?></span>
</span>
<input type="hidden" data-table="output" data-field="x_Beneficiaries" name="x<?php echo $output_grid->RowIndex ?>_Beneficiaries" id="x<?php echo $output_grid->RowIndex ?>_Beneficiaries" value="<?php echo HtmlEncode($output_grid->Beneficiaries->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output" data-field="x_Beneficiaries" name="o<?php echo $output_grid->RowIndex ?>_Beneficiaries" id="o<?php echo $output_grid->RowIndex ?>_Beneficiaries" value="<?php echo HtmlEncode($output_grid->Beneficiaries->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_grid->OutputStatus->Visible) { // OutputStatus ?>
		<td data-name="OutputStatus">
<?php if (!$output->isConfirm()) { ?>
<span id="el$rowindex$_output_OutputStatus" class="form-group output_OutputStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="output" data-field="x_OutputStatus" data-value-separator="<?php echo $output_grid->OutputStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $output_grid->RowIndex ?>_OutputStatus" name="x<?php echo $output_grid->RowIndex ?>_OutputStatus"<?php echo $output_grid->OutputStatus->editAttributes() ?>>
			<?php echo $output_grid->OutputStatus->selectOptionListHtml("x{$output_grid->RowIndex}_OutputStatus") ?>
		</select>
</div>
<?php echo $output_grid->OutputStatus->Lookup->getParamTag($output_grid, "p_x" . $output_grid->RowIndex . "_OutputStatus") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_output_OutputStatus" class="form-group output_OutputStatus">
<span<?php echo $output_grid->OutputStatus->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->OutputStatus->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output" data-field="x_OutputStatus" name="x<?php echo $output_grid->RowIndex ?>_OutputStatus" id="x<?php echo $output_grid->RowIndex ?>_OutputStatus" value="<?php echo HtmlEncode($output_grid->OutputStatus->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output" data-field="x_OutputStatus" name="o<?php echo $output_grid->RowIndex ?>_OutputStatus" id="o<?php echo $output_grid->RowIndex ?>_OutputStatus" value="<?php echo HtmlEncode($output_grid->OutputStatus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_grid->TargetAmount->Visible) { // TargetAmount ?>
		<td data-name="TargetAmount">
<?php if (!$output->isConfirm()) { ?>
<span id="el$rowindex$_output_TargetAmount" class="form-group output_TargetAmount">
<input type="text" data-table="output" data-field="x_TargetAmount" name="x<?php echo $output_grid->RowIndex ?>_TargetAmount" id="x<?php echo $output_grid->RowIndex ?>_TargetAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_grid->TargetAmount->getPlaceHolder()) ?>" value="<?php echo $output_grid->TargetAmount->EditValue ?>"<?php echo $output_grid->TargetAmount->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_output_TargetAmount" class="form-group output_TargetAmount">
<span<?php echo $output_grid->TargetAmount->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->TargetAmount->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output" data-field="x_TargetAmount" name="x<?php echo $output_grid->RowIndex ?>_TargetAmount" id="x<?php echo $output_grid->RowIndex ?>_TargetAmount" value="<?php echo HtmlEncode($output_grid->TargetAmount->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output" data-field="x_TargetAmount" name="o<?php echo $output_grid->RowIndex ?>_TargetAmount" id="o<?php echo $output_grid->RowIndex ?>_TargetAmount" value="<?php echo HtmlEncode($output_grid->TargetAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_grid->ActualAmount->Visible) { // ActualAmount ?>
		<td data-name="ActualAmount">
<?php if (!$output->isConfirm()) { ?>
<span id="el$rowindex$_output_ActualAmount" class="form-group output_ActualAmount">
<input type="text" data-table="output" data-field="x_ActualAmount" name="x<?php echo $output_grid->RowIndex ?>_ActualAmount" id="x<?php echo $output_grid->RowIndex ?>_ActualAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_grid->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $output_grid->ActualAmount->EditValue ?>"<?php echo $output_grid->ActualAmount->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_output_ActualAmount" class="form-group output_ActualAmount">
<span<?php echo $output_grid->ActualAmount->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->ActualAmount->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output" data-field="x_ActualAmount" name="x<?php echo $output_grid->RowIndex ?>_ActualAmount" id="x<?php echo $output_grid->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($output_grid->ActualAmount->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output" data-field="x_ActualAmount" name="o<?php echo $output_grid->RowIndex ?>_ActualAmount" id="o<?php echo $output_grid->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($output_grid->ActualAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_grid->PercentAchieved->Visible) { // PercentAchieved ?>
		<td data-name="PercentAchieved">
<?php if (!$output->isConfirm()) { ?>
<span id="el$rowindex$_output_PercentAchieved" class="form-group output_PercentAchieved">
<input type="text" data-table="output" data-field="x_PercentAchieved" name="x<?php echo $output_grid->RowIndex ?>_PercentAchieved" id="x<?php echo $output_grid->RowIndex ?>_PercentAchieved" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_grid->PercentAchieved->getPlaceHolder()) ?>" value="<?php echo $output_grid->PercentAchieved->EditValue ?>"<?php echo $output_grid->PercentAchieved->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_output_PercentAchieved" class="form-group output_PercentAchieved">
<span<?php echo $output_grid->PercentAchieved->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_grid->PercentAchieved->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="output" data-field="x_PercentAchieved" name="x<?php echo $output_grid->RowIndex ?>_PercentAchieved" id="x<?php echo $output_grid->RowIndex ?>_PercentAchieved" value="<?php echo HtmlEncode($output_grid->PercentAchieved->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="output" data-field="x_PercentAchieved" name="o<?php echo $output_grid->RowIndex ?>_PercentAchieved" id="o<?php echo $output_grid->RowIndex ?>_PercentAchieved" value="<?php echo HtmlEncode($output_grid->PercentAchieved->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$output_grid->ListOptions->render("body", "right", $output_grid->RowIndex);
?>
<script>
loadjs.ready(["foutputgrid", "load"], function() {
	foutputgrid.updateLists(<?php echo $output_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($output->CurrentMode == "add" || $output->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $output_grid->FormKeyCountName ?>" id="<?php echo $output_grid->FormKeyCountName ?>" value="<?php echo $output_grid->KeyCount ?>">
<?php echo $output_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($output->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $output_grid->FormKeyCountName ?>" id="<?php echo $output_grid->FormKeyCountName ?>" value="<?php echo $output_grid->KeyCount ?>">
<?php echo $output_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($output->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="foutputgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($output_grid->Recordset)
	$output_grid->Recordset->Close();
?>
<?php if ($output_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $output_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($output_grid->TotalRecords == 0 && !$output->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $output_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$output_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$output_grid->terminate();
?>