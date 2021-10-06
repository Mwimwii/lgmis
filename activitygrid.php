<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($activity_grid))
	$activity_grid = new activity_grid();

// Run the page
$activity_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$activity_grid->Page_Render();
?>
<?php if (!$activity_grid->isExport()) { ?>
<script>
var factivitygrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	factivitygrid = new ew.Form("factivitygrid", "grid");
	factivitygrid.formKeyCountName = '<?php echo $activity_grid->FormKeyCountName ?>';

	// Validate form
	factivitygrid.validate = function() {
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
			<?php if ($activity_grid->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_grid->LACode->caption(), $activity_grid->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_grid->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_grid->DepartmentCode->caption(), $activity_grid->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_grid->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_grid->SectionCode->caption(), $activity_grid->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_grid->ProgrammeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgrammeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_grid->ProgrammeCode->caption(), $activity_grid->ProgrammeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_grid->OucomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OucomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_grid->OucomeCode->caption(), $activity_grid->OucomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_grid->OutputCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_grid->OutputCode->caption(), $activity_grid->OutputCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_grid->ProjectCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_grid->ProjectCode->caption(), $activity_grid->ProjectCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_grid->ActivityCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ActivityCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_grid->ActivityCode->caption(), $activity_grid->ActivityCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_grid->FinancialYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_grid->FinancialYear->caption(), $activity_grid->FinancialYear->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_grid->ActivityName->Required) { ?>
				elm = this.getElements("x" + infix + "_ActivityName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_grid->ActivityName->caption(), $activity_grid->ActivityName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_grid->MTEFBudget->Required) { ?>
				elm = this.getElements("x" + infix + "_MTEFBudget");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_grid->MTEFBudget->caption(), $activity_grid->MTEFBudget->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MTEFBudget");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($activity_grid->MTEFBudget->errorMessage()) ?>");
			<?php if ($activity_grid->SupplementaryBudget->Required) { ?>
				elm = this.getElements("x" + infix + "_SupplementaryBudget");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_grid->SupplementaryBudget->caption(), $activity_grid->SupplementaryBudget->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SupplementaryBudget");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($activity_grid->SupplementaryBudget->errorMessage()) ?>");
			<?php if ($activity_grid->ExpectedAnnualAchievement->Required) { ?>
				elm = this.getElements("x" + infix + "_ExpectedAnnualAchievement");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_grid->ExpectedAnnualAchievement->caption(), $activity_grid->ExpectedAnnualAchievement->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_grid->ActivityLocation->Required) { ?>
				elm = this.getElements("x" + infix + "_ActivityLocation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_grid->ActivityLocation->caption(), $activity_grid->ActivityLocation->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	factivitygrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SectionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProgrammeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "OucomeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutputCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProjectCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "FinancialYear", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActivityName", false)) return false;
		if (ew.valueChanged(fobj, infix, "MTEFBudget", false)) return false;
		if (ew.valueChanged(fobj, infix, "SupplementaryBudget", false)) return false;
		if (ew.valueChanged(fobj, infix, "ExpectedAnnualAchievement", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActivityLocation", false)) return false;
		return true;
	}

	// Form_CustomValidate
	factivitygrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	factivitygrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	factivitygrid.lists["x_LACode"] = <?php echo $activity_grid->LACode->Lookup->toClientList($activity_grid) ?>;
	factivitygrid.lists["x_LACode"].options = <?php echo JsonEncode($activity_grid->LACode->lookupOptions()) ?>;
	factivitygrid.lists["x_DepartmentCode"] = <?php echo $activity_grid->DepartmentCode->Lookup->toClientList($activity_grid) ?>;
	factivitygrid.lists["x_DepartmentCode"].options = <?php echo JsonEncode($activity_grid->DepartmentCode->lookupOptions()) ?>;
	factivitygrid.lists["x_SectionCode"] = <?php echo $activity_grid->SectionCode->Lookup->toClientList($activity_grid) ?>;
	factivitygrid.lists["x_SectionCode"].options = <?php echo JsonEncode($activity_grid->SectionCode->lookupOptions()) ?>;
	factivitygrid.lists["x_ProgrammeCode"] = <?php echo $activity_grid->ProgrammeCode->Lookup->toClientList($activity_grid) ?>;
	factivitygrid.lists["x_ProgrammeCode"].options = <?php echo JsonEncode($activity_grid->ProgrammeCode->lookupOptions()) ?>;
	factivitygrid.autoSuggests["x_ProgrammeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	factivitygrid.lists["x_OucomeCode"] = <?php echo $activity_grid->OucomeCode->Lookup->toClientList($activity_grid) ?>;
	factivitygrid.lists["x_OucomeCode"].options = <?php echo JsonEncode($activity_grid->OucomeCode->lookupOptions()) ?>;
	factivitygrid.lists["x_OutputCode"] = <?php echo $activity_grid->OutputCode->Lookup->toClientList($activity_grid) ?>;
	factivitygrid.lists["x_OutputCode"].options = <?php echo JsonEncode($activity_grid->OutputCode->lookupOptions()) ?>;
	factivitygrid.lists["x_ProjectCode"] = <?php echo $activity_grid->ProjectCode->Lookup->toClientList($activity_grid) ?>;
	factivitygrid.lists["x_ProjectCode"].options = <?php echo JsonEncode($activity_grid->ProjectCode->lookupOptions()) ?>;
	factivitygrid.autoSuggests["x_ProjectCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	factivitygrid.lists["x_FinancialYear"] = <?php echo $activity_grid->FinancialYear->Lookup->toClientList($activity_grid) ?>;
	factivitygrid.lists["x_FinancialYear"].options = <?php echo JsonEncode($activity_grid->FinancialYear->lookupOptions()) ?>;
	loadjs.done("factivitygrid");
});
</script>
<?php } ?>
<?php
$activity_grid->renderOtherOptions();
?>
<?php if ($activity_grid->TotalRecords > 0 || $activity->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($activity_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> activity">
<?php if ($activity_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $activity_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="factivitygrid" class="ew-form ew-list-form form-inline">
<div id="gmp_activity" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_activitygrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$activity->RowType = ROWTYPE_HEADER;

// Render list options
$activity_grid->renderListOptions();

// Render list options (header, left)
$activity_grid->ListOptions->render("header", "left");
?>
<?php if ($activity_grid->LACode->Visible) { // LACode ?>
	<?php if ($activity_grid->SortUrl($activity_grid->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $activity_grid->LACode->headerCellClass() ?>"><div id="elh_activity_LACode" class="activity_LACode"><div class="ew-table-header-caption"><?php echo $activity_grid->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $activity_grid->LACode->headerCellClass() ?>"><div><div id="elh_activity_LACode" class="activity_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_grid->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_grid->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_grid->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_grid->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($activity_grid->SortUrl($activity_grid->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $activity_grid->DepartmentCode->headerCellClass() ?>"><div id="elh_activity_DepartmentCode" class="activity_DepartmentCode"><div class="ew-table-header-caption"><?php echo $activity_grid->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $activity_grid->DepartmentCode->headerCellClass() ?>"><div><div id="elh_activity_DepartmentCode" class="activity_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_grid->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_grid->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_grid->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_grid->SectionCode->Visible) { // SectionCode ?>
	<?php if ($activity_grid->SortUrl($activity_grid->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $activity_grid->SectionCode->headerCellClass() ?>"><div id="elh_activity_SectionCode" class="activity_SectionCode"><div class="ew-table-header-caption"><?php echo $activity_grid->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $activity_grid->SectionCode->headerCellClass() ?>"><div><div id="elh_activity_SectionCode" class="activity_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_grid->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_grid->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_grid->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_grid->ProgrammeCode->Visible) { // ProgrammeCode ?>
	<?php if ($activity_grid->SortUrl($activity_grid->ProgrammeCode) == "") { ?>
		<th data-name="ProgrammeCode" class="<?php echo $activity_grid->ProgrammeCode->headerCellClass() ?>"><div id="elh_activity_ProgrammeCode" class="activity_ProgrammeCode"><div class="ew-table-header-caption"><?php echo $activity_grid->ProgrammeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgrammeCode" class="<?php echo $activity_grid->ProgrammeCode->headerCellClass() ?>"><div><div id="elh_activity_ProgrammeCode" class="activity_ProgrammeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_grid->ProgrammeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_grid->ProgrammeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_grid->ProgrammeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_grid->OucomeCode->Visible) { // OucomeCode ?>
	<?php if ($activity_grid->SortUrl($activity_grid->OucomeCode) == "") { ?>
		<th data-name="OucomeCode" class="<?php echo $activity_grid->OucomeCode->headerCellClass() ?>"><div id="elh_activity_OucomeCode" class="activity_OucomeCode"><div class="ew-table-header-caption"><?php echo $activity_grid->OucomeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OucomeCode" class="<?php echo $activity_grid->OucomeCode->headerCellClass() ?>"><div><div id="elh_activity_OucomeCode" class="activity_OucomeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_grid->OucomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_grid->OucomeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_grid->OucomeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_grid->OutputCode->Visible) { // OutputCode ?>
	<?php if ($activity_grid->SortUrl($activity_grid->OutputCode) == "") { ?>
		<th data-name="OutputCode" class="<?php echo $activity_grid->OutputCode->headerCellClass() ?>"><div id="elh_activity_OutputCode" class="activity_OutputCode"><div class="ew-table-header-caption"><?php echo $activity_grid->OutputCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputCode" class="<?php echo $activity_grid->OutputCode->headerCellClass() ?>"><div><div id="elh_activity_OutputCode" class="activity_OutputCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_grid->OutputCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_grid->OutputCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_grid->OutputCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_grid->ProjectCode->Visible) { // ProjectCode ?>
	<?php if ($activity_grid->SortUrl($activity_grid->ProjectCode) == "") { ?>
		<th data-name="ProjectCode" class="<?php echo $activity_grid->ProjectCode->headerCellClass() ?>"><div id="elh_activity_ProjectCode" class="activity_ProjectCode"><div class="ew-table-header-caption"><?php echo $activity_grid->ProjectCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProjectCode" class="<?php echo $activity_grid->ProjectCode->headerCellClass() ?>"><div><div id="elh_activity_ProjectCode" class="activity_ProjectCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_grid->ProjectCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_grid->ProjectCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_grid->ProjectCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_grid->ActivityCode->Visible) { // ActivityCode ?>
	<?php if ($activity_grid->SortUrl($activity_grid->ActivityCode) == "") { ?>
		<th data-name="ActivityCode" class="<?php echo $activity_grid->ActivityCode->headerCellClass() ?>"><div id="elh_activity_ActivityCode" class="activity_ActivityCode"><div class="ew-table-header-caption"><?php echo $activity_grid->ActivityCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActivityCode" class="<?php echo $activity_grid->ActivityCode->headerCellClass() ?>"><div><div id="elh_activity_ActivityCode" class="activity_ActivityCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_grid->ActivityCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_grid->ActivityCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_grid->ActivityCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_grid->FinancialYear->Visible) { // FinancialYear ?>
	<?php if ($activity_grid->SortUrl($activity_grid->FinancialYear) == "") { ?>
		<th data-name="FinancialYear" class="<?php echo $activity_grid->FinancialYear->headerCellClass() ?>"><div id="elh_activity_FinancialYear" class="activity_FinancialYear"><div class="ew-table-header-caption"><?php echo $activity_grid->FinancialYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FinancialYear" class="<?php echo $activity_grid->FinancialYear->headerCellClass() ?>"><div><div id="elh_activity_FinancialYear" class="activity_FinancialYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_grid->FinancialYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_grid->FinancialYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_grid->FinancialYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_grid->ActivityName->Visible) { // ActivityName ?>
	<?php if ($activity_grid->SortUrl($activity_grid->ActivityName) == "") { ?>
		<th data-name="ActivityName" class="<?php echo $activity_grid->ActivityName->headerCellClass() ?>"><div id="elh_activity_ActivityName" class="activity_ActivityName"><div class="ew-table-header-caption"><?php echo $activity_grid->ActivityName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActivityName" class="<?php echo $activity_grid->ActivityName->headerCellClass() ?>"><div><div id="elh_activity_ActivityName" class="activity_ActivityName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_grid->ActivityName->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_grid->ActivityName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_grid->ActivityName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_grid->MTEFBudget->Visible) { // MTEFBudget ?>
	<?php if ($activity_grid->SortUrl($activity_grid->MTEFBudget) == "") { ?>
		<th data-name="MTEFBudget" class="<?php echo $activity_grid->MTEFBudget->headerCellClass() ?>"><div id="elh_activity_MTEFBudget" class="activity_MTEFBudget"><div class="ew-table-header-caption"><?php echo $activity_grid->MTEFBudget->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MTEFBudget" class="<?php echo $activity_grid->MTEFBudget->headerCellClass() ?>"><div><div id="elh_activity_MTEFBudget" class="activity_MTEFBudget">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_grid->MTEFBudget->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_grid->MTEFBudget->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_grid->MTEFBudget->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_grid->SupplementaryBudget->Visible) { // SupplementaryBudget ?>
	<?php if ($activity_grid->SortUrl($activity_grid->SupplementaryBudget) == "") { ?>
		<th data-name="SupplementaryBudget" class="<?php echo $activity_grid->SupplementaryBudget->headerCellClass() ?>"><div id="elh_activity_SupplementaryBudget" class="activity_SupplementaryBudget"><div class="ew-table-header-caption"><?php echo $activity_grid->SupplementaryBudget->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SupplementaryBudget" class="<?php echo $activity_grid->SupplementaryBudget->headerCellClass() ?>"><div><div id="elh_activity_SupplementaryBudget" class="activity_SupplementaryBudget">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_grid->SupplementaryBudget->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_grid->SupplementaryBudget->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_grid->SupplementaryBudget->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_grid->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
	<?php if ($activity_grid->SortUrl($activity_grid->ExpectedAnnualAchievement) == "") { ?>
		<th data-name="ExpectedAnnualAchievement" class="<?php echo $activity_grid->ExpectedAnnualAchievement->headerCellClass() ?>"><div id="elh_activity_ExpectedAnnualAchievement" class="activity_ExpectedAnnualAchievement"><div class="ew-table-header-caption"><?php echo $activity_grid->ExpectedAnnualAchievement->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExpectedAnnualAchievement" class="<?php echo $activity_grid->ExpectedAnnualAchievement->headerCellClass() ?>"><div><div id="elh_activity_ExpectedAnnualAchievement" class="activity_ExpectedAnnualAchievement">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_grid->ExpectedAnnualAchievement->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_grid->ExpectedAnnualAchievement->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_grid->ExpectedAnnualAchievement->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_grid->ActivityLocation->Visible) { // ActivityLocation ?>
	<?php if ($activity_grid->SortUrl($activity_grid->ActivityLocation) == "") { ?>
		<th data-name="ActivityLocation" class="<?php echo $activity_grid->ActivityLocation->headerCellClass() ?>"><div id="elh_activity_ActivityLocation" class="activity_ActivityLocation"><div class="ew-table-header-caption"><?php echo $activity_grid->ActivityLocation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActivityLocation" class="<?php echo $activity_grid->ActivityLocation->headerCellClass() ?>"><div><div id="elh_activity_ActivityLocation" class="activity_ActivityLocation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_grid->ActivityLocation->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_grid->ActivityLocation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_grid->ActivityLocation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$activity_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$activity_grid->StartRecord = 1;
$activity_grid->StopRecord = $activity_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($activity->isConfirm() || $activity_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($activity_grid->FormKeyCountName) && ($activity_grid->isGridAdd() || $activity_grid->isGridEdit() || $activity->isConfirm())) {
		$activity_grid->KeyCount = $CurrentForm->getValue($activity_grid->FormKeyCountName);
		$activity_grid->StopRecord = $activity_grid->StartRecord + $activity_grid->KeyCount - 1;
	}
}
$activity_grid->RecordCount = $activity_grid->StartRecord - 1;
if ($activity_grid->Recordset && !$activity_grid->Recordset->EOF) {
	$activity_grid->Recordset->moveFirst();
	$selectLimit = $activity_grid->UseSelectLimit;
	if (!$selectLimit && $activity_grid->StartRecord > 1)
		$activity_grid->Recordset->move($activity_grid->StartRecord - 1);
} elseif (!$activity->AllowAddDeleteRow && $activity_grid->StopRecord == 0) {
	$activity_grid->StopRecord = $activity->GridAddRowCount;
}

// Initialize aggregate
$activity->RowType = ROWTYPE_AGGREGATEINIT;
$activity->resetAttributes();
$activity_grid->renderRow();
if ($activity_grid->isGridAdd())
	$activity_grid->RowIndex = 0;
if ($activity_grid->isGridEdit())
	$activity_grid->RowIndex = 0;
while ($activity_grid->RecordCount < $activity_grid->StopRecord) {
	$activity_grid->RecordCount++;
	if ($activity_grid->RecordCount >= $activity_grid->StartRecord) {
		$activity_grid->RowCount++;
		if ($activity_grid->isGridAdd() || $activity_grid->isGridEdit() || $activity->isConfirm()) {
			$activity_grid->RowIndex++;
			$CurrentForm->Index = $activity_grid->RowIndex;
			if ($CurrentForm->hasValue($activity_grid->FormActionName) && ($activity->isConfirm() || $activity_grid->EventCancelled))
				$activity_grid->RowAction = strval($CurrentForm->getValue($activity_grid->FormActionName));
			elseif ($activity_grid->isGridAdd())
				$activity_grid->RowAction = "insert";
			else
				$activity_grid->RowAction = "";
		}

		// Set up key count
		$activity_grid->KeyCount = $activity_grid->RowIndex;

		// Init row class and style
		$activity->resetAttributes();
		$activity->CssClass = "";
		if ($activity_grid->isGridAdd()) {
			if ($activity->CurrentMode == "copy") {
				$activity_grid->loadRowValues($activity_grid->Recordset); // Load row values
				$activity_grid->setRecordKey($activity_grid->RowOldKey, $activity_grid->Recordset); // Set old record key
			} else {
				$activity_grid->loadRowValues(); // Load default values
				$activity_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$activity_grid->loadRowValues($activity_grid->Recordset); // Load row values
		}
		$activity->RowType = ROWTYPE_VIEW; // Render view
		if ($activity_grid->isGridAdd()) // Grid add
			$activity->RowType = ROWTYPE_ADD; // Render add
		if ($activity_grid->isGridAdd() && $activity->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$activity_grid->restoreCurrentRowFormValues($activity_grid->RowIndex); // Restore form values
		if ($activity_grid->isGridEdit()) { // Grid edit
			if ($activity->EventCancelled)
				$activity_grid->restoreCurrentRowFormValues($activity_grid->RowIndex); // Restore form values
			if ($activity_grid->RowAction == "insert")
				$activity->RowType = ROWTYPE_ADD; // Render add
			else
				$activity->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($activity_grid->isGridEdit() && ($activity->RowType == ROWTYPE_EDIT || $activity->RowType == ROWTYPE_ADD) && $activity->EventCancelled) // Update failed
			$activity_grid->restoreCurrentRowFormValues($activity_grid->RowIndex); // Restore form values
		if ($activity->RowType == ROWTYPE_EDIT) // Edit row
			$activity_grid->EditRowCount++;
		if ($activity->isConfirm()) // Confirm row
			$activity_grid->restoreCurrentRowFormValues($activity_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$activity->RowAttrs->merge(["data-rowindex" => $activity_grid->RowCount, "id" => "r" . $activity_grid->RowCount . "_activity", "data-rowtype" => $activity->RowType]);

		// Render row
		$activity_grid->renderRow();

		// Render list options
		$activity_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($activity_grid->RowAction != "delete" && $activity_grid->RowAction != "insertdelete" && !($activity_grid->RowAction == "insert" && $activity->isConfirm() && $activity_grid->emptyRow())) {
?>
	<tr <?php echo $activity->rowAttributes() ?>>
<?php

// Render list options (body, left)
$activity_grid->ListOptions->render("body", "left", $activity_grid->RowCount);
?>
	<?php if ($activity_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $activity_grid->LACode->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($activity_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_LACode" class="form-group">
<span<?php echo $activity_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $activity_grid->RowIndex ?>_LACode" name="x<?php echo $activity_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($activity_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_LACode" class="form-group">
<?php $activity_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $activity_grid->RowIndex ?>_LACode"><?php echo EmptyValue(strval($activity_grid->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_grid->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_grid->LACode->ReadOnly || $activity_grid->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_grid->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_grid->LACode->Lookup->getParamTag($activity_grid, "p_x" . $activity_grid->RowIndex . "_LACode") ?>
<input type="hidden" data-table="activity" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_grid->RowIndex ?>_LACode" id="x<?php echo $activity_grid->RowIndex ?>_LACode" value="<?php echo $activity_grid->LACode->CurrentValue ?>"<?php echo $activity_grid->LACode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_LACode" name="o<?php echo $activity_grid->RowIndex ?>_LACode" id="o<?php echo $activity_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($activity_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($activity_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_LACode" class="form-group">
<span<?php echo $activity_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $activity_grid->RowIndex ?>_LACode" name="x<?php echo $activity_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($activity_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_LACode" class="form-group">
<?php $activity_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $activity_grid->RowIndex ?>_LACode"><?php echo EmptyValue(strval($activity_grid->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_grid->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_grid->LACode->ReadOnly || $activity_grid->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_grid->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_grid->LACode->Lookup->getParamTag($activity_grid, "p_x" . $activity_grid->RowIndex . "_LACode") ?>
<input type="hidden" data-table="activity" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_grid->RowIndex ?>_LACode" id="x<?php echo $activity_grid->RowIndex ?>_LACode" value="<?php echo $activity_grid->LACode->CurrentValue ?>"<?php echo $activity_grid->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_LACode">
<span<?php echo $activity_grid->LACode->viewAttributes() ?>><?php echo $activity_grid->LACode->getViewValue() ?></span>
</span>
<?php if (!$activity->isConfirm()) { ?>
<input type="hidden" data-table="activity" data-field="x_LACode" name="x<?php echo $activity_grid->RowIndex ?>_LACode" id="x<?php echo $activity_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($activity_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_LACode" name="o<?php echo $activity_grid->RowIndex ?>_LACode" id="o<?php echo $activity_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($activity_grid->LACode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="activity" data-field="x_LACode" name="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_LACode" id="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($activity_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_LACode" name="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_LACode" id="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($activity_grid->LACode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $activity_grid->DepartmentCode->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($activity_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_DepartmentCode" class="form-group">
<span<?php echo $activity_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $activity_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $activity_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($activity_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_DepartmentCode" class="form-group">
<?php $activity_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $activity_grid->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($activity_grid->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_grid->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_grid->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_grid->DepartmentCode->ReadOnly || $activity_grid->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_grid->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_grid->DepartmentCode->Lookup->getParamTag($activity_grid, "p_x" . $activity_grid->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="activity" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $activity_grid->RowIndex ?>_DepartmentCode" value="<?php echo $activity_grid->DepartmentCode->CurrentValue ?>"<?php echo $activity_grid->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_DepartmentCode" name="o<?php echo $activity_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $activity_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($activity_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($activity_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_DepartmentCode" class="form-group">
<span<?php echo $activity_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $activity_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $activity_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($activity_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_DepartmentCode" class="form-group">
<?php $activity_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $activity_grid->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($activity_grid->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_grid->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_grid->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_grid->DepartmentCode->ReadOnly || $activity_grid->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_grid->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_grid->DepartmentCode->Lookup->getParamTag($activity_grid, "p_x" . $activity_grid->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="activity" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $activity_grid->RowIndex ?>_DepartmentCode" value="<?php echo $activity_grid->DepartmentCode->CurrentValue ?>"<?php echo $activity_grid->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_DepartmentCode">
<span<?php echo $activity_grid->DepartmentCode->viewAttributes() ?>><?php echo $activity_grid->DepartmentCode->getViewValue() ?></span>
</span>
<?php if (!$activity->isConfirm()) { ?>
<input type="hidden" data-table="activity" data-field="x_DepartmentCode" name="x<?php echo $activity_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $activity_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($activity_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_DepartmentCode" name="o<?php echo $activity_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $activity_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($activity_grid->DepartmentCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="activity" data-field="x_DepartmentCode" name="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_DepartmentCode" id="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($activity_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_DepartmentCode" name="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_DepartmentCode" id="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($activity_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $activity_grid->SectionCode->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($activity_grid->SectionCode->getSessionValue() != "") { ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_SectionCode" class="form-group">
<span<?php echo $activity_grid->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $activity_grid->RowIndex ?>_SectionCode" name="x<?php echo $activity_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($activity_grid->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_SectionCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $activity_grid->RowIndex ?>_SectionCode"><?php echo EmptyValue(strval($activity_grid->SectionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_grid->SectionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_grid->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_grid->SectionCode->ReadOnly || $activity_grid->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_grid->RowIndex ?>_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_grid->SectionCode->Lookup->getParamTag($activity_grid, "p_x" . $activity_grid->RowIndex . "_SectionCode") ?>
<input type="hidden" data-table="activity" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_grid->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_grid->RowIndex ?>_SectionCode" id="x<?php echo $activity_grid->RowIndex ?>_SectionCode" value="<?php echo $activity_grid->SectionCode->CurrentValue ?>"<?php echo $activity_grid->SectionCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_SectionCode" name="o<?php echo $activity_grid->RowIndex ?>_SectionCode" id="o<?php echo $activity_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($activity_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($activity_grid->SectionCode->getSessionValue() != "") { ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_SectionCode" class="form-group">
<span<?php echo $activity_grid->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $activity_grid->RowIndex ?>_SectionCode" name="x<?php echo $activity_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($activity_grid->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_SectionCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $activity_grid->RowIndex ?>_SectionCode"><?php echo EmptyValue(strval($activity_grid->SectionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_grid->SectionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_grid->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_grid->SectionCode->ReadOnly || $activity_grid->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_grid->RowIndex ?>_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_grid->SectionCode->Lookup->getParamTag($activity_grid, "p_x" . $activity_grid->RowIndex . "_SectionCode") ?>
<input type="hidden" data-table="activity" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_grid->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_grid->RowIndex ?>_SectionCode" id="x<?php echo $activity_grid->RowIndex ?>_SectionCode" value="<?php echo $activity_grid->SectionCode->CurrentValue ?>"<?php echo $activity_grid->SectionCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_SectionCode">
<span<?php echo $activity_grid->SectionCode->viewAttributes() ?>><?php echo $activity_grid->SectionCode->getViewValue() ?></span>
</span>
<?php if (!$activity->isConfirm()) { ?>
<input type="hidden" data-table="activity" data-field="x_SectionCode" name="x<?php echo $activity_grid->RowIndex ?>_SectionCode" id="x<?php echo $activity_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($activity_grid->SectionCode->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_SectionCode" name="o<?php echo $activity_grid->RowIndex ?>_SectionCode" id="o<?php echo $activity_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($activity_grid->SectionCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="activity" data-field="x_SectionCode" name="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_SectionCode" id="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($activity_grid->SectionCode->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_SectionCode" name="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_SectionCode" id="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($activity_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_grid->ProgrammeCode->Visible) { // ProgrammeCode ?>
		<td data-name="ProgrammeCode" <?php echo $activity_grid->ProgrammeCode->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_ProgrammeCode" class="form-group">
<?php
$onchange = $activity_grid->ProgrammeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$activity_grid->ProgrammeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" id="sv_x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" value="<?php echo RemoveHtml($activity_grid->ProgrammeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($activity_grid->ProgrammeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($activity_grid->ProgrammeCode->getPlaceHolder()) ?>"<?php echo $activity_grid->ProgrammeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_grid->ProgrammeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($activity_grid->ProgrammeCode->ReadOnly || $activity_grid->ProgrammeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="activity" data-field="x_ProgrammeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_grid->ProgrammeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" id="x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" value="<?php echo HtmlEncode($activity_grid->ProgrammeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["factivitygrid"], function() {
	factivitygrid.createAutoSuggest({"id":"x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode","forceSelect":false});
});
</script>
<?php echo $activity_grid->ProgrammeCode->Lookup->getParamTag($activity_grid, "p_x" . $activity_grid->RowIndex . "_ProgrammeCode") ?>
</span>
<input type="hidden" data-table="activity" data-field="x_ProgrammeCode" name="o<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" id="o<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" value="<?php echo HtmlEncode($activity_grid->ProgrammeCode->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_ProgrammeCode" class="form-group">
<?php
$onchange = $activity_grid->ProgrammeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$activity_grid->ProgrammeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" id="sv_x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" value="<?php echo RemoveHtml($activity_grid->ProgrammeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($activity_grid->ProgrammeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($activity_grid->ProgrammeCode->getPlaceHolder()) ?>"<?php echo $activity_grid->ProgrammeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_grid->ProgrammeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($activity_grid->ProgrammeCode->ReadOnly || $activity_grid->ProgrammeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="activity" data-field="x_ProgrammeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_grid->ProgrammeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" id="x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" value="<?php echo HtmlEncode($activity_grid->ProgrammeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["factivitygrid"], function() {
	factivitygrid.createAutoSuggest({"id":"x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode","forceSelect":false});
});
</script>
<?php echo $activity_grid->ProgrammeCode->Lookup->getParamTag($activity_grid, "p_x" . $activity_grid->RowIndex . "_ProgrammeCode") ?>
</span>
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_ProgrammeCode">
<span<?php echo $activity_grid->ProgrammeCode->viewAttributes() ?>><?php echo $activity_grid->ProgrammeCode->getViewValue() ?></span>
</span>
<?php if (!$activity->isConfirm()) { ?>
<input type="hidden" data-table="activity" data-field="x_ProgrammeCode" name="x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" id="x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" value="<?php echo HtmlEncode($activity_grid->ProgrammeCode->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_ProgrammeCode" name="o<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" id="o<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" value="<?php echo HtmlEncode($activity_grid->ProgrammeCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="activity" data-field="x_ProgrammeCode" name="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" id="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" value="<?php echo HtmlEncode($activity_grid->ProgrammeCode->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_ProgrammeCode" name="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" id="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" value="<?php echo HtmlEncode($activity_grid->ProgrammeCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_grid->OucomeCode->Visible) { // OucomeCode ?>
		<td data-name="OucomeCode" <?php echo $activity_grid->OucomeCode->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_OucomeCode" class="form-group">
<?php $activity_grid->OucomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="activity" data-field="x_OucomeCode" data-value-separator="<?php echo $activity_grid->OucomeCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $activity_grid->RowIndex ?>_OucomeCode" name="x<?php echo $activity_grid->RowIndex ?>_OucomeCode"<?php echo $activity_grid->OucomeCode->editAttributes() ?>>
			<?php echo $activity_grid->OucomeCode->selectOptionListHtml("x{$activity_grid->RowIndex}_OucomeCode") ?>
		</select>
</div>
<?php echo $activity_grid->OucomeCode->Lookup->getParamTag($activity_grid, "p_x" . $activity_grid->RowIndex . "_OucomeCode") ?>
</span>
<input type="hidden" data-table="activity" data-field="x_OucomeCode" name="o<?php echo $activity_grid->RowIndex ?>_OucomeCode" id="o<?php echo $activity_grid->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($activity_grid->OucomeCode->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_OucomeCode" class="form-group">
<?php $activity_grid->OucomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="activity" data-field="x_OucomeCode" data-value-separator="<?php echo $activity_grid->OucomeCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $activity_grid->RowIndex ?>_OucomeCode" name="x<?php echo $activity_grid->RowIndex ?>_OucomeCode"<?php echo $activity_grid->OucomeCode->editAttributes() ?>>
			<?php echo $activity_grid->OucomeCode->selectOptionListHtml("x{$activity_grid->RowIndex}_OucomeCode") ?>
		</select>
</div>
<?php echo $activity_grid->OucomeCode->Lookup->getParamTag($activity_grid, "p_x" . $activity_grid->RowIndex . "_OucomeCode") ?>
</span>
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_OucomeCode">
<span<?php echo $activity_grid->OucomeCode->viewAttributes() ?>><?php echo $activity_grid->OucomeCode->getViewValue() ?></span>
</span>
<?php if (!$activity->isConfirm()) { ?>
<input type="hidden" data-table="activity" data-field="x_OucomeCode" name="x<?php echo $activity_grid->RowIndex ?>_OucomeCode" id="x<?php echo $activity_grid->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($activity_grid->OucomeCode->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_OucomeCode" name="o<?php echo $activity_grid->RowIndex ?>_OucomeCode" id="o<?php echo $activity_grid->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($activity_grid->OucomeCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="activity" data-field="x_OucomeCode" name="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_OucomeCode" id="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($activity_grid->OucomeCode->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_OucomeCode" name="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_OucomeCode" id="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($activity_grid->OucomeCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_grid->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode" <?php echo $activity_grid->OutputCode->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_OutputCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $activity_grid->RowIndex ?>_OutputCode"><?php echo EmptyValue(strval($activity_grid->OutputCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_grid->OutputCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_grid->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_grid->OutputCode->ReadOnly || $activity_grid->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_grid->RowIndex ?>_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_grid->OutputCode->Lookup->getParamTag($activity_grid, "p_x" . $activity_grid->RowIndex . "_OutputCode") ?>
<input type="hidden" data-table="activity" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_grid->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_grid->RowIndex ?>_OutputCode" id="x<?php echo $activity_grid->RowIndex ?>_OutputCode" value="<?php echo $activity_grid->OutputCode->CurrentValue ?>"<?php echo $activity_grid->OutputCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="activity" data-field="x_OutputCode" name="o<?php echo $activity_grid->RowIndex ?>_OutputCode" id="o<?php echo $activity_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($activity_grid->OutputCode->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_OutputCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $activity_grid->RowIndex ?>_OutputCode"><?php echo EmptyValue(strval($activity_grid->OutputCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_grid->OutputCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_grid->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_grid->OutputCode->ReadOnly || $activity_grid->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_grid->RowIndex ?>_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_grid->OutputCode->Lookup->getParamTag($activity_grid, "p_x" . $activity_grid->RowIndex . "_OutputCode") ?>
<input type="hidden" data-table="activity" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_grid->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_grid->RowIndex ?>_OutputCode" id="x<?php echo $activity_grid->RowIndex ?>_OutputCode" value="<?php echo $activity_grid->OutputCode->CurrentValue ?>"<?php echo $activity_grid->OutputCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_OutputCode">
<span<?php echo $activity_grid->OutputCode->viewAttributes() ?>><?php echo $activity_grid->OutputCode->getViewValue() ?></span>
</span>
<?php if (!$activity->isConfirm()) { ?>
<input type="hidden" data-table="activity" data-field="x_OutputCode" name="x<?php echo $activity_grid->RowIndex ?>_OutputCode" id="x<?php echo $activity_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($activity_grid->OutputCode->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_OutputCode" name="o<?php echo $activity_grid->RowIndex ?>_OutputCode" id="o<?php echo $activity_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($activity_grid->OutputCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="activity" data-field="x_OutputCode" name="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_OutputCode" id="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($activity_grid->OutputCode->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_OutputCode" name="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_OutputCode" id="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($activity_grid->OutputCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_grid->ProjectCode->Visible) { // ProjectCode ?>
		<td data-name="ProjectCode" <?php echo $activity_grid->ProjectCode->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($activity_grid->ProjectCode->getSessionValue() != "") { ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_ProjectCode" class="form-group">
<span<?php echo $activity_grid->ProjectCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->ProjectCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $activity_grid->RowIndex ?>_ProjectCode" name="x<?php echo $activity_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($activity_grid->ProjectCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_ProjectCode" class="form-group">
<?php
$onchange = $activity_grid->ProjectCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$activity_grid->ProjectCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $activity_grid->RowIndex ?>_ProjectCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $activity_grid->RowIndex ?>_ProjectCode" id="sv_x<?php echo $activity_grid->RowIndex ?>_ProjectCode" value="<?php echo RemoveHtml($activity_grid->ProjectCode->EditValue) ?>" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($activity_grid->ProjectCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($activity_grid->ProjectCode->getPlaceHolder()) ?>"<?php echo $activity_grid->ProjectCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_grid->ProjectCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_grid->RowIndex ?>_ProjectCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($activity_grid->ProjectCode->ReadOnly || $activity_grid->ProjectCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="activity" data-field="x_ProjectCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_grid->ProjectCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_grid->RowIndex ?>_ProjectCode" id="x<?php echo $activity_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($activity_grid->ProjectCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["factivitygrid"], function() {
	factivitygrid.createAutoSuggest({"id":"x<?php echo $activity_grid->RowIndex ?>_ProjectCode","forceSelect":false});
});
</script>
<?php echo $activity_grid->ProjectCode->Lookup->getParamTag($activity_grid, "p_x" . $activity_grid->RowIndex . "_ProjectCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_ProjectCode" name="o<?php echo $activity_grid->RowIndex ?>_ProjectCode" id="o<?php echo $activity_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($activity_grid->ProjectCode->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($activity_grid->ProjectCode->getSessionValue() != "") { ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_ProjectCode" class="form-group">
<span<?php echo $activity_grid->ProjectCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->ProjectCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $activity_grid->RowIndex ?>_ProjectCode" name="x<?php echo $activity_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($activity_grid->ProjectCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_ProjectCode" class="form-group">
<?php
$onchange = $activity_grid->ProjectCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$activity_grid->ProjectCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $activity_grid->RowIndex ?>_ProjectCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $activity_grid->RowIndex ?>_ProjectCode" id="sv_x<?php echo $activity_grid->RowIndex ?>_ProjectCode" value="<?php echo RemoveHtml($activity_grid->ProjectCode->EditValue) ?>" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($activity_grid->ProjectCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($activity_grid->ProjectCode->getPlaceHolder()) ?>"<?php echo $activity_grid->ProjectCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_grid->ProjectCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_grid->RowIndex ?>_ProjectCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($activity_grid->ProjectCode->ReadOnly || $activity_grid->ProjectCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="activity" data-field="x_ProjectCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_grid->ProjectCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_grid->RowIndex ?>_ProjectCode" id="x<?php echo $activity_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($activity_grid->ProjectCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["factivitygrid"], function() {
	factivitygrid.createAutoSuggest({"id":"x<?php echo $activity_grid->RowIndex ?>_ProjectCode","forceSelect":false});
});
</script>
<?php echo $activity_grid->ProjectCode->Lookup->getParamTag($activity_grid, "p_x" . $activity_grid->RowIndex . "_ProjectCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_ProjectCode">
<span<?php echo $activity_grid->ProjectCode->viewAttributes() ?>><?php echo $activity_grid->ProjectCode->getViewValue() ?></span>
</span>
<?php if (!$activity->isConfirm()) { ?>
<input type="hidden" data-table="activity" data-field="x_ProjectCode" name="x<?php echo $activity_grid->RowIndex ?>_ProjectCode" id="x<?php echo $activity_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($activity_grid->ProjectCode->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_ProjectCode" name="o<?php echo $activity_grid->RowIndex ?>_ProjectCode" id="o<?php echo $activity_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($activity_grid->ProjectCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="activity" data-field="x_ProjectCode" name="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_ProjectCode" id="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($activity_grid->ProjectCode->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_ProjectCode" name="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_ProjectCode" id="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($activity_grid->ProjectCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_grid->ActivityCode->Visible) { // ActivityCode ?>
		<td data-name="ActivityCode" <?php echo $activity_grid->ActivityCode->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_ActivityCode" class="form-group"></span>
<input type="hidden" data-table="activity" data-field="x_ActivityCode" name="o<?php echo $activity_grid->RowIndex ?>_ActivityCode" id="o<?php echo $activity_grid->RowIndex ?>_ActivityCode" value="<?php echo HtmlEncode($activity_grid->ActivityCode->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_ActivityCode" class="form-group">
<span<?php echo $activity_grid->ActivityCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->ActivityCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="activity" data-field="x_ActivityCode" name="x<?php echo $activity_grid->RowIndex ?>_ActivityCode" id="x<?php echo $activity_grid->RowIndex ?>_ActivityCode" value="<?php echo HtmlEncode($activity_grid->ActivityCode->CurrentValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_ActivityCode">
<span<?php echo $activity_grid->ActivityCode->viewAttributes() ?>><?php echo $activity_grid->ActivityCode->getViewValue() ?></span>
</span>
<?php if (!$activity->isConfirm()) { ?>
<input type="hidden" data-table="activity" data-field="x_ActivityCode" name="x<?php echo $activity_grid->RowIndex ?>_ActivityCode" id="x<?php echo $activity_grid->RowIndex ?>_ActivityCode" value="<?php echo HtmlEncode($activity_grid->ActivityCode->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_ActivityCode" name="o<?php echo $activity_grid->RowIndex ?>_ActivityCode" id="o<?php echo $activity_grid->RowIndex ?>_ActivityCode" value="<?php echo HtmlEncode($activity_grid->ActivityCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="activity" data-field="x_ActivityCode" name="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_ActivityCode" id="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_ActivityCode" value="<?php echo HtmlEncode($activity_grid->ActivityCode->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_ActivityCode" name="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_ActivityCode" id="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_ActivityCode" value="<?php echo HtmlEncode($activity_grid->ActivityCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_grid->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear" <?php echo $activity_grid->FinancialYear->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_FinancialYear" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="activity" data-field="x_FinancialYear" data-value-separator="<?php echo $activity_grid->FinancialYear->displayValueSeparatorAttribute() ?>" id="x<?php echo $activity_grid->RowIndex ?>_FinancialYear" name="x<?php echo $activity_grid->RowIndex ?>_FinancialYear"<?php echo $activity_grid->FinancialYear->editAttributes() ?>>
			<?php echo $activity_grid->FinancialYear->selectOptionListHtml("x{$activity_grid->RowIndex}_FinancialYear") ?>
		</select>
</div>
<?php echo $activity_grid->FinancialYear->Lookup->getParamTag($activity_grid, "p_x" . $activity_grid->RowIndex . "_FinancialYear") ?>
</span>
<input type="hidden" data-table="activity" data-field="x_FinancialYear" name="o<?php echo $activity_grid->RowIndex ?>_FinancialYear" id="o<?php echo $activity_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($activity_grid->FinancialYear->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="activity" data-field="x_FinancialYear" data-value-separator="<?php echo $activity_grid->FinancialYear->displayValueSeparatorAttribute() ?>" id="x<?php echo $activity_grid->RowIndex ?>_FinancialYear" name="x<?php echo $activity_grid->RowIndex ?>_FinancialYear"<?php echo $activity_grid->FinancialYear->editAttributes() ?>>
			<?php echo $activity_grid->FinancialYear->selectOptionListHtml("x{$activity_grid->RowIndex}_FinancialYear") ?>
		</select>
</div>
<?php echo $activity_grid->FinancialYear->Lookup->getParamTag($activity_grid, "p_x" . $activity_grid->RowIndex . "_FinancialYear") ?>
<input type="hidden" data-table="activity" data-field="x_FinancialYear" name="o<?php echo $activity_grid->RowIndex ?>_FinancialYear" id="o<?php echo $activity_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($activity_grid->FinancialYear->OldValue != null ? $activity_grid->FinancialYear->OldValue : $activity_grid->FinancialYear->CurrentValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_FinancialYear">
<span<?php echo $activity_grid->FinancialYear->viewAttributes() ?>><?php echo $activity_grid->FinancialYear->getViewValue() ?></span>
</span>
<?php if (!$activity->isConfirm()) { ?>
<input type="hidden" data-table="activity" data-field="x_FinancialYear" name="x<?php echo $activity_grid->RowIndex ?>_FinancialYear" id="x<?php echo $activity_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($activity_grid->FinancialYear->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_FinancialYear" name="o<?php echo $activity_grid->RowIndex ?>_FinancialYear" id="o<?php echo $activity_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($activity_grid->FinancialYear->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="activity" data-field="x_FinancialYear" name="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_FinancialYear" id="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($activity_grid->FinancialYear->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_FinancialYear" name="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_FinancialYear" id="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($activity_grid->FinancialYear->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_grid->ActivityName->Visible) { // ActivityName ?>
		<td data-name="ActivityName" <?php echo $activity_grid->ActivityName->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_ActivityName" class="form-group">
<textarea data-table="activity" data-field="x_ActivityName" name="x<?php echo $activity_grid->RowIndex ?>_ActivityName" id="x<?php echo $activity_grid->RowIndex ?>_ActivityName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($activity_grid->ActivityName->getPlaceHolder()) ?>"<?php echo $activity_grid->ActivityName->editAttributes() ?>><?php echo $activity_grid->ActivityName->EditValue ?></textarea>
</span>
<input type="hidden" data-table="activity" data-field="x_ActivityName" name="o<?php echo $activity_grid->RowIndex ?>_ActivityName" id="o<?php echo $activity_grid->RowIndex ?>_ActivityName" value="<?php echo HtmlEncode($activity_grid->ActivityName->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_ActivityName" class="form-group">
<textarea data-table="activity" data-field="x_ActivityName" name="x<?php echo $activity_grid->RowIndex ?>_ActivityName" id="x<?php echo $activity_grid->RowIndex ?>_ActivityName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($activity_grid->ActivityName->getPlaceHolder()) ?>"<?php echo $activity_grid->ActivityName->editAttributes() ?>><?php echo $activity_grid->ActivityName->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_ActivityName">
<span<?php echo $activity_grid->ActivityName->viewAttributes() ?>><?php echo $activity_grid->ActivityName->getViewValue() ?></span>
</span>
<?php if (!$activity->isConfirm()) { ?>
<input type="hidden" data-table="activity" data-field="x_ActivityName" name="x<?php echo $activity_grid->RowIndex ?>_ActivityName" id="x<?php echo $activity_grid->RowIndex ?>_ActivityName" value="<?php echo HtmlEncode($activity_grid->ActivityName->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_ActivityName" name="o<?php echo $activity_grid->RowIndex ?>_ActivityName" id="o<?php echo $activity_grid->RowIndex ?>_ActivityName" value="<?php echo HtmlEncode($activity_grid->ActivityName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="activity" data-field="x_ActivityName" name="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_ActivityName" id="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_ActivityName" value="<?php echo HtmlEncode($activity_grid->ActivityName->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_ActivityName" name="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_ActivityName" id="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_ActivityName" value="<?php echo HtmlEncode($activity_grid->ActivityName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_grid->MTEFBudget->Visible) { // MTEFBudget ?>
		<td data-name="MTEFBudget" <?php echo $activity_grid->MTEFBudget->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_MTEFBudget" class="form-group">
<input type="text" data-table="activity" data-field="x_MTEFBudget" name="x<?php echo $activity_grid->RowIndex ?>_MTEFBudget" id="x<?php echo $activity_grid->RowIndex ?>_MTEFBudget" size="30" placeholder="<?php echo HtmlEncode($activity_grid->MTEFBudget->getPlaceHolder()) ?>" value="<?php echo $activity_grid->MTEFBudget->EditValue ?>"<?php echo $activity_grid->MTEFBudget->editAttributes() ?>>
</span>
<input type="hidden" data-table="activity" data-field="x_MTEFBudget" name="o<?php echo $activity_grid->RowIndex ?>_MTEFBudget" id="o<?php echo $activity_grid->RowIndex ?>_MTEFBudget" value="<?php echo HtmlEncode($activity_grid->MTEFBudget->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_MTEFBudget" class="form-group">
<input type="text" data-table="activity" data-field="x_MTEFBudget" name="x<?php echo $activity_grid->RowIndex ?>_MTEFBudget" id="x<?php echo $activity_grid->RowIndex ?>_MTEFBudget" size="30" placeholder="<?php echo HtmlEncode($activity_grid->MTEFBudget->getPlaceHolder()) ?>" value="<?php echo $activity_grid->MTEFBudget->EditValue ?>"<?php echo $activity_grid->MTEFBudget->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_MTEFBudget">
<span<?php echo $activity_grid->MTEFBudget->viewAttributes() ?>><?php echo $activity_grid->MTEFBudget->getViewValue() ?></span>
</span>
<?php if (!$activity->isConfirm()) { ?>
<input type="hidden" data-table="activity" data-field="x_MTEFBudget" name="x<?php echo $activity_grid->RowIndex ?>_MTEFBudget" id="x<?php echo $activity_grid->RowIndex ?>_MTEFBudget" value="<?php echo HtmlEncode($activity_grid->MTEFBudget->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_MTEFBudget" name="o<?php echo $activity_grid->RowIndex ?>_MTEFBudget" id="o<?php echo $activity_grid->RowIndex ?>_MTEFBudget" value="<?php echo HtmlEncode($activity_grid->MTEFBudget->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="activity" data-field="x_MTEFBudget" name="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_MTEFBudget" id="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_MTEFBudget" value="<?php echo HtmlEncode($activity_grid->MTEFBudget->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_MTEFBudget" name="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_MTEFBudget" id="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_MTEFBudget" value="<?php echo HtmlEncode($activity_grid->MTEFBudget->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_grid->SupplementaryBudget->Visible) { // SupplementaryBudget ?>
		<td data-name="SupplementaryBudget" <?php echo $activity_grid->SupplementaryBudget->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_SupplementaryBudget" class="form-group">
<input type="text" data-table="activity" data-field="x_SupplementaryBudget" name="x<?php echo $activity_grid->RowIndex ?>_SupplementaryBudget" id="x<?php echo $activity_grid->RowIndex ?>_SupplementaryBudget" size="30" placeholder="<?php echo HtmlEncode($activity_grid->SupplementaryBudget->getPlaceHolder()) ?>" value="<?php echo $activity_grid->SupplementaryBudget->EditValue ?>"<?php echo $activity_grid->SupplementaryBudget->editAttributes() ?>>
</span>
<input type="hidden" data-table="activity" data-field="x_SupplementaryBudget" name="o<?php echo $activity_grid->RowIndex ?>_SupplementaryBudget" id="o<?php echo $activity_grid->RowIndex ?>_SupplementaryBudget" value="<?php echo HtmlEncode($activity_grid->SupplementaryBudget->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_SupplementaryBudget" class="form-group">
<input type="text" data-table="activity" data-field="x_SupplementaryBudget" name="x<?php echo $activity_grid->RowIndex ?>_SupplementaryBudget" id="x<?php echo $activity_grid->RowIndex ?>_SupplementaryBudget" size="30" placeholder="<?php echo HtmlEncode($activity_grid->SupplementaryBudget->getPlaceHolder()) ?>" value="<?php echo $activity_grid->SupplementaryBudget->EditValue ?>"<?php echo $activity_grid->SupplementaryBudget->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_SupplementaryBudget">
<span<?php echo $activity_grid->SupplementaryBudget->viewAttributes() ?>><?php echo $activity_grid->SupplementaryBudget->getViewValue() ?></span>
</span>
<?php if (!$activity->isConfirm()) { ?>
<input type="hidden" data-table="activity" data-field="x_SupplementaryBudget" name="x<?php echo $activity_grid->RowIndex ?>_SupplementaryBudget" id="x<?php echo $activity_grid->RowIndex ?>_SupplementaryBudget" value="<?php echo HtmlEncode($activity_grid->SupplementaryBudget->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_SupplementaryBudget" name="o<?php echo $activity_grid->RowIndex ?>_SupplementaryBudget" id="o<?php echo $activity_grid->RowIndex ?>_SupplementaryBudget" value="<?php echo HtmlEncode($activity_grid->SupplementaryBudget->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="activity" data-field="x_SupplementaryBudget" name="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_SupplementaryBudget" id="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_SupplementaryBudget" value="<?php echo HtmlEncode($activity_grid->SupplementaryBudget->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_SupplementaryBudget" name="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_SupplementaryBudget" id="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_SupplementaryBudget" value="<?php echo HtmlEncode($activity_grid->SupplementaryBudget->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_grid->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
		<td data-name="ExpectedAnnualAchievement" <?php echo $activity_grid->ExpectedAnnualAchievement->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_ExpectedAnnualAchievement" class="form-group">
<input type="text" data-table="activity" data-field="x_ExpectedAnnualAchievement" name="x<?php echo $activity_grid->RowIndex ?>_ExpectedAnnualAchievement" id="x<?php echo $activity_grid->RowIndex ?>_ExpectedAnnualAchievement" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($activity_grid->ExpectedAnnualAchievement->getPlaceHolder()) ?>" value="<?php echo $activity_grid->ExpectedAnnualAchievement->EditValue ?>"<?php echo $activity_grid->ExpectedAnnualAchievement->editAttributes() ?>>
</span>
<input type="hidden" data-table="activity" data-field="x_ExpectedAnnualAchievement" name="o<?php echo $activity_grid->RowIndex ?>_ExpectedAnnualAchievement" id="o<?php echo $activity_grid->RowIndex ?>_ExpectedAnnualAchievement" value="<?php echo HtmlEncode($activity_grid->ExpectedAnnualAchievement->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_ExpectedAnnualAchievement" class="form-group">
<input type="text" data-table="activity" data-field="x_ExpectedAnnualAchievement" name="x<?php echo $activity_grid->RowIndex ?>_ExpectedAnnualAchievement" id="x<?php echo $activity_grid->RowIndex ?>_ExpectedAnnualAchievement" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($activity_grid->ExpectedAnnualAchievement->getPlaceHolder()) ?>" value="<?php echo $activity_grid->ExpectedAnnualAchievement->EditValue ?>"<?php echo $activity_grid->ExpectedAnnualAchievement->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_ExpectedAnnualAchievement">
<span<?php echo $activity_grid->ExpectedAnnualAchievement->viewAttributes() ?>><?php echo $activity_grid->ExpectedAnnualAchievement->getViewValue() ?></span>
</span>
<?php if (!$activity->isConfirm()) { ?>
<input type="hidden" data-table="activity" data-field="x_ExpectedAnnualAchievement" name="x<?php echo $activity_grid->RowIndex ?>_ExpectedAnnualAchievement" id="x<?php echo $activity_grid->RowIndex ?>_ExpectedAnnualAchievement" value="<?php echo HtmlEncode($activity_grid->ExpectedAnnualAchievement->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_ExpectedAnnualAchievement" name="o<?php echo $activity_grid->RowIndex ?>_ExpectedAnnualAchievement" id="o<?php echo $activity_grid->RowIndex ?>_ExpectedAnnualAchievement" value="<?php echo HtmlEncode($activity_grid->ExpectedAnnualAchievement->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="activity" data-field="x_ExpectedAnnualAchievement" name="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_ExpectedAnnualAchievement" id="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_ExpectedAnnualAchievement" value="<?php echo HtmlEncode($activity_grid->ExpectedAnnualAchievement->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_ExpectedAnnualAchievement" name="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_ExpectedAnnualAchievement" id="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_ExpectedAnnualAchievement" value="<?php echo HtmlEncode($activity_grid->ExpectedAnnualAchievement->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_grid->ActivityLocation->Visible) { // ActivityLocation ?>
		<td data-name="ActivityLocation" <?php echo $activity_grid->ActivityLocation->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_ActivityLocation" class="form-group">
<input type="text" data-table="activity" data-field="x_ActivityLocation" name="x<?php echo $activity_grid->RowIndex ?>_ActivityLocation" id="x<?php echo $activity_grid->RowIndex ?>_ActivityLocation" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($activity_grid->ActivityLocation->getPlaceHolder()) ?>" value="<?php echo $activity_grid->ActivityLocation->EditValue ?>"<?php echo $activity_grid->ActivityLocation->editAttributes() ?>>
</span>
<input type="hidden" data-table="activity" data-field="x_ActivityLocation" name="o<?php echo $activity_grid->RowIndex ?>_ActivityLocation" id="o<?php echo $activity_grid->RowIndex ?>_ActivityLocation" value="<?php echo HtmlEncode($activity_grid->ActivityLocation->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_ActivityLocation" class="form-group">
<input type="text" data-table="activity" data-field="x_ActivityLocation" name="x<?php echo $activity_grid->RowIndex ?>_ActivityLocation" id="x<?php echo $activity_grid->RowIndex ?>_ActivityLocation" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($activity_grid->ActivityLocation->getPlaceHolder()) ?>" value="<?php echo $activity_grid->ActivityLocation->EditValue ?>"<?php echo $activity_grid->ActivityLocation->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_grid->RowCount ?>_activity_ActivityLocation">
<span<?php echo $activity_grid->ActivityLocation->viewAttributes() ?>><?php echo $activity_grid->ActivityLocation->getViewValue() ?></span>
</span>
<?php if (!$activity->isConfirm()) { ?>
<input type="hidden" data-table="activity" data-field="x_ActivityLocation" name="x<?php echo $activity_grid->RowIndex ?>_ActivityLocation" id="x<?php echo $activity_grid->RowIndex ?>_ActivityLocation" value="<?php echo HtmlEncode($activity_grid->ActivityLocation->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_ActivityLocation" name="o<?php echo $activity_grid->RowIndex ?>_ActivityLocation" id="o<?php echo $activity_grid->RowIndex ?>_ActivityLocation" value="<?php echo HtmlEncode($activity_grid->ActivityLocation->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="activity" data-field="x_ActivityLocation" name="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_ActivityLocation" id="factivitygrid$x<?php echo $activity_grid->RowIndex ?>_ActivityLocation" value="<?php echo HtmlEncode($activity_grid->ActivityLocation->FormValue) ?>">
<input type="hidden" data-table="activity" data-field="x_ActivityLocation" name="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_ActivityLocation" id="factivitygrid$o<?php echo $activity_grid->RowIndex ?>_ActivityLocation" value="<?php echo HtmlEncode($activity_grid->ActivityLocation->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$activity_grid->ListOptions->render("body", "right", $activity_grid->RowCount);
?>
	</tr>
<?php if ($activity->RowType == ROWTYPE_ADD || $activity->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["factivitygrid", "load"], function() {
	factivitygrid.updateLists(<?php echo $activity_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$activity_grid->isGridAdd() || $activity->CurrentMode == "copy")
		if (!$activity_grid->Recordset->EOF)
			$activity_grid->Recordset->moveNext();
}
?>
<?php
	if ($activity->CurrentMode == "add" || $activity->CurrentMode == "copy" || $activity->CurrentMode == "edit") {
		$activity_grid->RowIndex = '$rowindex$';
		$activity_grid->loadRowValues();

		// Set row properties
		$activity->resetAttributes();
		$activity->RowAttrs->merge(["data-rowindex" => $activity_grid->RowIndex, "id" => "r0_activity", "data-rowtype" => ROWTYPE_ADD]);
		$activity->RowAttrs->appendClass("ew-template");
		$activity->RowType = ROWTYPE_ADD;

		// Render row
		$activity_grid->renderRow();

		// Render list options
		$activity_grid->renderListOptions();
		$activity_grid->StartRowCount = 0;
?>
	<tr <?php echo $activity->rowAttributes() ?>>
<?php

// Render list options (body, left)
$activity_grid->ListOptions->render("body", "left", $activity_grid->RowIndex);
?>
	<?php if ($activity_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if (!$activity->isConfirm()) { ?>
<?php if ($activity_grid->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_activity_LACode" class="form-group activity_LACode">
<span<?php echo $activity_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $activity_grid->RowIndex ?>_LACode" name="x<?php echo $activity_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($activity_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_activity_LACode" class="form-group activity_LACode">
<?php $activity_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $activity_grid->RowIndex ?>_LACode"><?php echo EmptyValue(strval($activity_grid->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_grid->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_grid->LACode->ReadOnly || $activity_grid->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_grid->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_grid->LACode->Lookup->getParamTag($activity_grid, "p_x" . $activity_grid->RowIndex . "_LACode") ?>
<input type="hidden" data-table="activity" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_grid->RowIndex ?>_LACode" id="x<?php echo $activity_grid->RowIndex ?>_LACode" value="<?php echo $activity_grid->LACode->CurrentValue ?>"<?php echo $activity_grid->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_activity_LACode" class="form-group activity_LACode">
<span<?php echo $activity_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="activity" data-field="x_LACode" name="x<?php echo $activity_grid->RowIndex ?>_LACode" id="x<?php echo $activity_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($activity_grid->LACode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_LACode" name="o<?php echo $activity_grid->RowIndex ?>_LACode" id="o<?php echo $activity_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($activity_grid->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<?php if (!$activity->isConfirm()) { ?>
<?php if ($activity_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_activity_DepartmentCode" class="form-group activity_DepartmentCode">
<span<?php echo $activity_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $activity_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $activity_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($activity_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_activity_DepartmentCode" class="form-group activity_DepartmentCode">
<?php $activity_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $activity_grid->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($activity_grid->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_grid->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_grid->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_grid->DepartmentCode->ReadOnly || $activity_grid->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_grid->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_grid->DepartmentCode->Lookup->getParamTag($activity_grid, "p_x" . $activity_grid->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="activity" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $activity_grid->RowIndex ?>_DepartmentCode" value="<?php echo $activity_grid->DepartmentCode->CurrentValue ?>"<?php echo $activity_grid->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_activity_DepartmentCode" class="form-group activity_DepartmentCode">
<span<?php echo $activity_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="activity" data-field="x_DepartmentCode" name="x<?php echo $activity_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $activity_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($activity_grid->DepartmentCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_DepartmentCode" name="o<?php echo $activity_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $activity_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($activity_grid->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode">
<?php if (!$activity->isConfirm()) { ?>
<?php if ($activity_grid->SectionCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_activity_SectionCode" class="form-group activity_SectionCode">
<span<?php echo $activity_grid->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $activity_grid->RowIndex ?>_SectionCode" name="x<?php echo $activity_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($activity_grid->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_activity_SectionCode" class="form-group activity_SectionCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $activity_grid->RowIndex ?>_SectionCode"><?php echo EmptyValue(strval($activity_grid->SectionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_grid->SectionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_grid->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_grid->SectionCode->ReadOnly || $activity_grid->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_grid->RowIndex ?>_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_grid->SectionCode->Lookup->getParamTag($activity_grid, "p_x" . $activity_grid->RowIndex . "_SectionCode") ?>
<input type="hidden" data-table="activity" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_grid->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_grid->RowIndex ?>_SectionCode" id="x<?php echo $activity_grid->RowIndex ?>_SectionCode" value="<?php echo $activity_grid->SectionCode->CurrentValue ?>"<?php echo $activity_grid->SectionCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_activity_SectionCode" class="form-group activity_SectionCode">
<span<?php echo $activity_grid->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="activity" data-field="x_SectionCode" name="x<?php echo $activity_grid->RowIndex ?>_SectionCode" id="x<?php echo $activity_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($activity_grid->SectionCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_SectionCode" name="o<?php echo $activity_grid->RowIndex ?>_SectionCode" id="o<?php echo $activity_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($activity_grid->SectionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_grid->ProgrammeCode->Visible) { // ProgrammeCode ?>
		<td data-name="ProgrammeCode">
<?php if (!$activity->isConfirm()) { ?>
<span id="el$rowindex$_activity_ProgrammeCode" class="form-group activity_ProgrammeCode">
<?php
$onchange = $activity_grid->ProgrammeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$activity_grid->ProgrammeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" id="sv_x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" value="<?php echo RemoveHtml($activity_grid->ProgrammeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($activity_grid->ProgrammeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($activity_grid->ProgrammeCode->getPlaceHolder()) ?>"<?php echo $activity_grid->ProgrammeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_grid->ProgrammeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($activity_grid->ProgrammeCode->ReadOnly || $activity_grid->ProgrammeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="activity" data-field="x_ProgrammeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_grid->ProgrammeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" id="x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" value="<?php echo HtmlEncode($activity_grid->ProgrammeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["factivitygrid"], function() {
	factivitygrid.createAutoSuggest({"id":"x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode","forceSelect":false});
});
</script>
<?php echo $activity_grid->ProgrammeCode->Lookup->getParamTag($activity_grid, "p_x" . $activity_grid->RowIndex . "_ProgrammeCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_activity_ProgrammeCode" class="form-group activity_ProgrammeCode">
<span<?php echo $activity_grid->ProgrammeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->ProgrammeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="activity" data-field="x_ProgrammeCode" name="x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" id="x<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" value="<?php echo HtmlEncode($activity_grid->ProgrammeCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_ProgrammeCode" name="o<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" id="o<?php echo $activity_grid->RowIndex ?>_ProgrammeCode" value="<?php echo HtmlEncode($activity_grid->ProgrammeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_grid->OucomeCode->Visible) { // OucomeCode ?>
		<td data-name="OucomeCode">
<?php if (!$activity->isConfirm()) { ?>
<span id="el$rowindex$_activity_OucomeCode" class="form-group activity_OucomeCode">
<?php $activity_grid->OucomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="activity" data-field="x_OucomeCode" data-value-separator="<?php echo $activity_grid->OucomeCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $activity_grid->RowIndex ?>_OucomeCode" name="x<?php echo $activity_grid->RowIndex ?>_OucomeCode"<?php echo $activity_grid->OucomeCode->editAttributes() ?>>
			<?php echo $activity_grid->OucomeCode->selectOptionListHtml("x{$activity_grid->RowIndex}_OucomeCode") ?>
		</select>
</div>
<?php echo $activity_grid->OucomeCode->Lookup->getParamTag($activity_grid, "p_x" . $activity_grid->RowIndex . "_OucomeCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_activity_OucomeCode" class="form-group activity_OucomeCode">
<span<?php echo $activity_grid->OucomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->OucomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="activity" data-field="x_OucomeCode" name="x<?php echo $activity_grid->RowIndex ?>_OucomeCode" id="x<?php echo $activity_grid->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($activity_grid->OucomeCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_OucomeCode" name="o<?php echo $activity_grid->RowIndex ?>_OucomeCode" id="o<?php echo $activity_grid->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($activity_grid->OucomeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_grid->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode">
<?php if (!$activity->isConfirm()) { ?>
<span id="el$rowindex$_activity_OutputCode" class="form-group activity_OutputCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $activity_grid->RowIndex ?>_OutputCode"><?php echo EmptyValue(strval($activity_grid->OutputCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_grid->OutputCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_grid->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_grid->OutputCode->ReadOnly || $activity_grid->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_grid->RowIndex ?>_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_grid->OutputCode->Lookup->getParamTag($activity_grid, "p_x" . $activity_grid->RowIndex . "_OutputCode") ?>
<input type="hidden" data-table="activity" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_grid->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_grid->RowIndex ?>_OutputCode" id="x<?php echo $activity_grid->RowIndex ?>_OutputCode" value="<?php echo $activity_grid->OutputCode->CurrentValue ?>"<?php echo $activity_grid->OutputCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_activity_OutputCode" class="form-group activity_OutputCode">
<span<?php echo $activity_grid->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="activity" data-field="x_OutputCode" name="x<?php echo $activity_grid->RowIndex ?>_OutputCode" id="x<?php echo $activity_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($activity_grid->OutputCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_OutputCode" name="o<?php echo $activity_grid->RowIndex ?>_OutputCode" id="o<?php echo $activity_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($activity_grid->OutputCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_grid->ProjectCode->Visible) { // ProjectCode ?>
		<td data-name="ProjectCode">
<?php if (!$activity->isConfirm()) { ?>
<?php if ($activity_grid->ProjectCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_activity_ProjectCode" class="form-group activity_ProjectCode">
<span<?php echo $activity_grid->ProjectCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->ProjectCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $activity_grid->RowIndex ?>_ProjectCode" name="x<?php echo $activity_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($activity_grid->ProjectCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_activity_ProjectCode" class="form-group activity_ProjectCode">
<?php
$onchange = $activity_grid->ProjectCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$activity_grid->ProjectCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $activity_grid->RowIndex ?>_ProjectCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $activity_grid->RowIndex ?>_ProjectCode" id="sv_x<?php echo $activity_grid->RowIndex ?>_ProjectCode" value="<?php echo RemoveHtml($activity_grid->ProjectCode->EditValue) ?>" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($activity_grid->ProjectCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($activity_grid->ProjectCode->getPlaceHolder()) ?>"<?php echo $activity_grid->ProjectCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_grid->ProjectCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_grid->RowIndex ?>_ProjectCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($activity_grid->ProjectCode->ReadOnly || $activity_grid->ProjectCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="activity" data-field="x_ProjectCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_grid->ProjectCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_grid->RowIndex ?>_ProjectCode" id="x<?php echo $activity_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($activity_grid->ProjectCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["factivitygrid"], function() {
	factivitygrid.createAutoSuggest({"id":"x<?php echo $activity_grid->RowIndex ?>_ProjectCode","forceSelect":false});
});
</script>
<?php echo $activity_grid->ProjectCode->Lookup->getParamTag($activity_grid, "p_x" . $activity_grid->RowIndex . "_ProjectCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_activity_ProjectCode" class="form-group activity_ProjectCode">
<span<?php echo $activity_grid->ProjectCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->ProjectCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="activity" data-field="x_ProjectCode" name="x<?php echo $activity_grid->RowIndex ?>_ProjectCode" id="x<?php echo $activity_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($activity_grid->ProjectCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_ProjectCode" name="o<?php echo $activity_grid->RowIndex ?>_ProjectCode" id="o<?php echo $activity_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($activity_grid->ProjectCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_grid->ActivityCode->Visible) { // ActivityCode ?>
		<td data-name="ActivityCode">
<?php if (!$activity->isConfirm()) { ?>
<span id="el$rowindex$_activity_ActivityCode" class="form-group activity_ActivityCode"></span>
<?php } else { ?>
<span id="el$rowindex$_activity_ActivityCode" class="form-group activity_ActivityCode">
<span<?php echo $activity_grid->ActivityCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->ActivityCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="activity" data-field="x_ActivityCode" name="x<?php echo $activity_grid->RowIndex ?>_ActivityCode" id="x<?php echo $activity_grid->RowIndex ?>_ActivityCode" value="<?php echo HtmlEncode($activity_grid->ActivityCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_ActivityCode" name="o<?php echo $activity_grid->RowIndex ?>_ActivityCode" id="o<?php echo $activity_grid->RowIndex ?>_ActivityCode" value="<?php echo HtmlEncode($activity_grid->ActivityCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_grid->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear">
<?php if (!$activity->isConfirm()) { ?>
<span id="el$rowindex$_activity_FinancialYear" class="form-group activity_FinancialYear">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="activity" data-field="x_FinancialYear" data-value-separator="<?php echo $activity_grid->FinancialYear->displayValueSeparatorAttribute() ?>" id="x<?php echo $activity_grid->RowIndex ?>_FinancialYear" name="x<?php echo $activity_grid->RowIndex ?>_FinancialYear"<?php echo $activity_grid->FinancialYear->editAttributes() ?>>
			<?php echo $activity_grid->FinancialYear->selectOptionListHtml("x{$activity_grid->RowIndex}_FinancialYear") ?>
		</select>
</div>
<?php echo $activity_grid->FinancialYear->Lookup->getParamTag($activity_grid, "p_x" . $activity_grid->RowIndex . "_FinancialYear") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_activity_FinancialYear" class="form-group activity_FinancialYear">
<span<?php echo $activity_grid->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="activity" data-field="x_FinancialYear" name="x<?php echo $activity_grid->RowIndex ?>_FinancialYear" id="x<?php echo $activity_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($activity_grid->FinancialYear->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_FinancialYear" name="o<?php echo $activity_grid->RowIndex ?>_FinancialYear" id="o<?php echo $activity_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($activity_grid->FinancialYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_grid->ActivityName->Visible) { // ActivityName ?>
		<td data-name="ActivityName">
<?php if (!$activity->isConfirm()) { ?>
<span id="el$rowindex$_activity_ActivityName" class="form-group activity_ActivityName">
<textarea data-table="activity" data-field="x_ActivityName" name="x<?php echo $activity_grid->RowIndex ?>_ActivityName" id="x<?php echo $activity_grid->RowIndex ?>_ActivityName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($activity_grid->ActivityName->getPlaceHolder()) ?>"<?php echo $activity_grid->ActivityName->editAttributes() ?>><?php echo $activity_grid->ActivityName->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_activity_ActivityName" class="form-group activity_ActivityName">
<span<?php echo $activity_grid->ActivityName->viewAttributes() ?>><?php echo $activity_grid->ActivityName->ViewValue ?></span>
</span>
<input type="hidden" data-table="activity" data-field="x_ActivityName" name="x<?php echo $activity_grid->RowIndex ?>_ActivityName" id="x<?php echo $activity_grid->RowIndex ?>_ActivityName" value="<?php echo HtmlEncode($activity_grid->ActivityName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_ActivityName" name="o<?php echo $activity_grid->RowIndex ?>_ActivityName" id="o<?php echo $activity_grid->RowIndex ?>_ActivityName" value="<?php echo HtmlEncode($activity_grid->ActivityName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_grid->MTEFBudget->Visible) { // MTEFBudget ?>
		<td data-name="MTEFBudget">
<?php if (!$activity->isConfirm()) { ?>
<span id="el$rowindex$_activity_MTEFBudget" class="form-group activity_MTEFBudget">
<input type="text" data-table="activity" data-field="x_MTEFBudget" name="x<?php echo $activity_grid->RowIndex ?>_MTEFBudget" id="x<?php echo $activity_grid->RowIndex ?>_MTEFBudget" size="30" placeholder="<?php echo HtmlEncode($activity_grid->MTEFBudget->getPlaceHolder()) ?>" value="<?php echo $activity_grid->MTEFBudget->EditValue ?>"<?php echo $activity_grid->MTEFBudget->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_activity_MTEFBudget" class="form-group activity_MTEFBudget">
<span<?php echo $activity_grid->MTEFBudget->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->MTEFBudget->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="activity" data-field="x_MTEFBudget" name="x<?php echo $activity_grid->RowIndex ?>_MTEFBudget" id="x<?php echo $activity_grid->RowIndex ?>_MTEFBudget" value="<?php echo HtmlEncode($activity_grid->MTEFBudget->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_MTEFBudget" name="o<?php echo $activity_grid->RowIndex ?>_MTEFBudget" id="o<?php echo $activity_grid->RowIndex ?>_MTEFBudget" value="<?php echo HtmlEncode($activity_grid->MTEFBudget->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_grid->SupplementaryBudget->Visible) { // SupplementaryBudget ?>
		<td data-name="SupplementaryBudget">
<?php if (!$activity->isConfirm()) { ?>
<span id="el$rowindex$_activity_SupplementaryBudget" class="form-group activity_SupplementaryBudget">
<input type="text" data-table="activity" data-field="x_SupplementaryBudget" name="x<?php echo $activity_grid->RowIndex ?>_SupplementaryBudget" id="x<?php echo $activity_grid->RowIndex ?>_SupplementaryBudget" size="30" placeholder="<?php echo HtmlEncode($activity_grid->SupplementaryBudget->getPlaceHolder()) ?>" value="<?php echo $activity_grid->SupplementaryBudget->EditValue ?>"<?php echo $activity_grid->SupplementaryBudget->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_activity_SupplementaryBudget" class="form-group activity_SupplementaryBudget">
<span<?php echo $activity_grid->SupplementaryBudget->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->SupplementaryBudget->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="activity" data-field="x_SupplementaryBudget" name="x<?php echo $activity_grid->RowIndex ?>_SupplementaryBudget" id="x<?php echo $activity_grid->RowIndex ?>_SupplementaryBudget" value="<?php echo HtmlEncode($activity_grid->SupplementaryBudget->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_SupplementaryBudget" name="o<?php echo $activity_grid->RowIndex ?>_SupplementaryBudget" id="o<?php echo $activity_grid->RowIndex ?>_SupplementaryBudget" value="<?php echo HtmlEncode($activity_grid->SupplementaryBudget->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_grid->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
		<td data-name="ExpectedAnnualAchievement">
<?php if (!$activity->isConfirm()) { ?>
<span id="el$rowindex$_activity_ExpectedAnnualAchievement" class="form-group activity_ExpectedAnnualAchievement">
<input type="text" data-table="activity" data-field="x_ExpectedAnnualAchievement" name="x<?php echo $activity_grid->RowIndex ?>_ExpectedAnnualAchievement" id="x<?php echo $activity_grid->RowIndex ?>_ExpectedAnnualAchievement" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($activity_grid->ExpectedAnnualAchievement->getPlaceHolder()) ?>" value="<?php echo $activity_grid->ExpectedAnnualAchievement->EditValue ?>"<?php echo $activity_grid->ExpectedAnnualAchievement->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_activity_ExpectedAnnualAchievement" class="form-group activity_ExpectedAnnualAchievement">
<span<?php echo $activity_grid->ExpectedAnnualAchievement->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->ExpectedAnnualAchievement->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="activity" data-field="x_ExpectedAnnualAchievement" name="x<?php echo $activity_grid->RowIndex ?>_ExpectedAnnualAchievement" id="x<?php echo $activity_grid->RowIndex ?>_ExpectedAnnualAchievement" value="<?php echo HtmlEncode($activity_grid->ExpectedAnnualAchievement->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_ExpectedAnnualAchievement" name="o<?php echo $activity_grid->RowIndex ?>_ExpectedAnnualAchievement" id="o<?php echo $activity_grid->RowIndex ?>_ExpectedAnnualAchievement" value="<?php echo HtmlEncode($activity_grid->ExpectedAnnualAchievement->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_grid->ActivityLocation->Visible) { // ActivityLocation ?>
		<td data-name="ActivityLocation">
<?php if (!$activity->isConfirm()) { ?>
<span id="el$rowindex$_activity_ActivityLocation" class="form-group activity_ActivityLocation">
<input type="text" data-table="activity" data-field="x_ActivityLocation" name="x<?php echo $activity_grid->RowIndex ?>_ActivityLocation" id="x<?php echo $activity_grid->RowIndex ?>_ActivityLocation" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($activity_grid->ActivityLocation->getPlaceHolder()) ?>" value="<?php echo $activity_grid->ActivityLocation->EditValue ?>"<?php echo $activity_grid->ActivityLocation->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_activity_ActivityLocation" class="form-group activity_ActivityLocation">
<span<?php echo $activity_grid->ActivityLocation->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_grid->ActivityLocation->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="activity" data-field="x_ActivityLocation" name="x<?php echo $activity_grid->RowIndex ?>_ActivityLocation" id="x<?php echo $activity_grid->RowIndex ?>_ActivityLocation" value="<?php echo HtmlEncode($activity_grid->ActivityLocation->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_ActivityLocation" name="o<?php echo $activity_grid->RowIndex ?>_ActivityLocation" id="o<?php echo $activity_grid->RowIndex ?>_ActivityLocation" value="<?php echo HtmlEncode($activity_grid->ActivityLocation->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$activity_grid->ListOptions->render("body", "right", $activity_grid->RowIndex);
?>
<script>
loadjs.ready(["factivitygrid", "load"], function() {
	factivitygrid.updateLists(<?php echo $activity_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($activity->CurrentMode == "add" || $activity->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $activity_grid->FormKeyCountName ?>" id="<?php echo $activity_grid->FormKeyCountName ?>" value="<?php echo $activity_grid->KeyCount ?>">
<?php echo $activity_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($activity->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $activity_grid->FormKeyCountName ?>" id="<?php echo $activity_grid->FormKeyCountName ?>" value="<?php echo $activity_grid->KeyCount ?>">
<?php echo $activity_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($activity->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="factivitygrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($activity_grid->Recordset)
	$activity_grid->Recordset->Close();
?>
<?php if ($activity_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $activity_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($activity_grid->TotalRecords == 0 && !$activity->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $activity_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$activity_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$activity_grid->terminate();
?>