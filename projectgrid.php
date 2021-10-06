<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($project_grid))
	$project_grid = new project_grid();

// Run the page
$project_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$project_grid->Page_Render();
?>
<?php if (!$project_grid->isExport()) { ?>
<script>
var fprojectgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fprojectgrid = new ew.Form("fprojectgrid", "grid");
	fprojectgrid.formKeyCountName = '<?php echo $project_grid->FormKeyCountName ?>';

	// Validate form
	fprojectgrid.validate = function() {
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
			<?php if ($project_grid->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_grid->ProvinceCode->caption(), $project_grid->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_grid->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_grid->LACode->caption(), $project_grid->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_grid->ProjectCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_grid->ProjectCode->caption(), $project_grid->ProjectCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_grid->ProjectName->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_grid->ProjectName->caption(), $project_grid->ProjectName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_grid->ProjectType->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_grid->ProjectType->caption(), $project_grid->ProjectType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_grid->ProjectSector->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectSector");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_grid->ProjectSector->caption(), $project_grid->ProjectSector->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_grid->Contractors->Required) { ?>
				elm = this.getElements("x" + infix + "_Contractors");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_grid->Contractors->caption(), $project_grid->Contractors->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_grid->PlannedStartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedStartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_grid->PlannedStartDate->caption(), $project_grid->PlannedStartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedStartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($project_grid->PlannedStartDate->errorMessage()) ?>");
			<?php if ($project_grid->PlannedEndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedEndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_grid->PlannedEndDate->caption(), $project_grid->PlannedEndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedEndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($project_grid->PlannedEndDate->errorMessage()) ?>");
			<?php if ($project_grid->ActualStartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualStartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_grid->ActualStartDate->caption(), $project_grid->ActualStartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualStartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($project_grid->ActualStartDate->errorMessage()) ?>");
			<?php if ($project_grid->ActualEndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualEndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_grid->ActualEndDate->caption(), $project_grid->ActualEndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualEndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($project_grid->ActualEndDate->errorMessage()) ?>");
			<?php if ($project_grid->Budget->Required) { ?>
				elm = this.getElements("x" + infix + "_Budget");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_grid->Budget->caption(), $project_grid->Budget->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Budget");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($project_grid->Budget->errorMessage()) ?>");
			<?php if ($project_grid->ProgressStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgressStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_grid->ProgressStatus->caption(), $project_grid->ProgressStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_grid->OutstandingTasks->Required) { ?>
				elm = this.getElements("x" + infix + "_OutstandingTasks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_grid->OutstandingTasks->caption(), $project_grid->OutstandingTasks->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fprojectgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ProvinceCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProjectCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProjectName", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProjectType", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProjectSector", false)) return false;
		if (ew.valueChanged(fobj, infix, "Contractors", false)) return false;
		if (ew.valueChanged(fobj, infix, "PlannedStartDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "PlannedEndDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActualStartDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActualEndDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "Budget", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProgressStatus", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutstandingTasks", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fprojectgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fprojectgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fprojectgrid.lists["x_ProvinceCode"] = <?php echo $project_grid->ProvinceCode->Lookup->toClientList($project_grid) ?>;
	fprojectgrid.lists["x_ProvinceCode"].options = <?php echo JsonEncode($project_grid->ProvinceCode->lookupOptions()) ?>;
	fprojectgrid.lists["x_LACode"] = <?php echo $project_grid->LACode->Lookup->toClientList($project_grid) ?>;
	fprojectgrid.lists["x_LACode"].options = <?php echo JsonEncode($project_grid->LACode->lookupOptions()) ?>;
	fprojectgrid.lists["x_ProjectType"] = <?php echo $project_grid->ProjectType->Lookup->toClientList($project_grid) ?>;
	fprojectgrid.lists["x_ProjectType"].options = <?php echo JsonEncode($project_grid->ProjectType->lookupOptions()) ?>;
	fprojectgrid.lists["x_ProjectSector"] = <?php echo $project_grid->ProjectSector->Lookup->toClientList($project_grid) ?>;
	fprojectgrid.lists["x_ProjectSector"].options = <?php echo JsonEncode($project_grid->ProjectSector->lookupOptions()) ?>;
	fprojectgrid.lists["x_ProgressStatus"] = <?php echo $project_grid->ProgressStatus->Lookup->toClientList($project_grid) ?>;
	fprojectgrid.lists["x_ProgressStatus"].options = <?php echo JsonEncode($project_grid->ProgressStatus->lookupOptions()) ?>;
	loadjs.done("fprojectgrid");
});
</script>
<?php } ?>
<?php
$project_grid->renderOtherOptions();
?>
<?php if ($project_grid->TotalRecords > 0 || $project->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($project_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> project">
<?php if ($project_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $project_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fprojectgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_project" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_projectgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$project->RowType = ROWTYPE_HEADER;

// Render list options
$project_grid->renderListOptions();

// Render list options (header, left)
$project_grid->ListOptions->render("header", "left");
?>
<?php if ($project_grid->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($project_grid->SortUrl($project_grid->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $project_grid->ProvinceCode->headerCellClass() ?>"><div id="elh_project_ProvinceCode" class="project_ProvinceCode"><div class="ew-table-header-caption"><?php echo $project_grid->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $project_grid->ProvinceCode->headerCellClass() ?>"><div><div id="elh_project_ProvinceCode" class="project_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_grid->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_grid->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_grid->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_grid->LACode->Visible) { // LACode ?>
	<?php if ($project_grid->SortUrl($project_grid->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $project_grid->LACode->headerCellClass() ?>"><div id="elh_project_LACode" class="project_LACode"><div class="ew-table-header-caption"><?php echo $project_grid->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $project_grid->LACode->headerCellClass() ?>"><div><div id="elh_project_LACode" class="project_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_grid->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_grid->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_grid->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_grid->ProjectCode->Visible) { // ProjectCode ?>
	<?php if ($project_grid->SortUrl($project_grid->ProjectCode) == "") { ?>
		<th data-name="ProjectCode" class="<?php echo $project_grid->ProjectCode->headerCellClass() ?>"><div id="elh_project_ProjectCode" class="project_ProjectCode"><div class="ew-table-header-caption"><?php echo $project_grid->ProjectCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProjectCode" class="<?php echo $project_grid->ProjectCode->headerCellClass() ?>"><div><div id="elh_project_ProjectCode" class="project_ProjectCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_grid->ProjectCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_grid->ProjectCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_grid->ProjectCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_grid->ProjectName->Visible) { // ProjectName ?>
	<?php if ($project_grid->SortUrl($project_grid->ProjectName) == "") { ?>
		<th data-name="ProjectName" class="<?php echo $project_grid->ProjectName->headerCellClass() ?>"><div id="elh_project_ProjectName" class="project_ProjectName"><div class="ew-table-header-caption"><?php echo $project_grid->ProjectName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProjectName" class="<?php echo $project_grid->ProjectName->headerCellClass() ?>"><div><div id="elh_project_ProjectName" class="project_ProjectName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_grid->ProjectName->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_grid->ProjectName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_grid->ProjectName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_grid->ProjectType->Visible) { // ProjectType ?>
	<?php if ($project_grid->SortUrl($project_grid->ProjectType) == "") { ?>
		<th data-name="ProjectType" class="<?php echo $project_grid->ProjectType->headerCellClass() ?>"><div id="elh_project_ProjectType" class="project_ProjectType"><div class="ew-table-header-caption"><?php echo $project_grid->ProjectType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProjectType" class="<?php echo $project_grid->ProjectType->headerCellClass() ?>"><div><div id="elh_project_ProjectType" class="project_ProjectType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_grid->ProjectType->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_grid->ProjectType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_grid->ProjectType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_grid->ProjectSector->Visible) { // ProjectSector ?>
	<?php if ($project_grid->SortUrl($project_grid->ProjectSector) == "") { ?>
		<th data-name="ProjectSector" class="<?php echo $project_grid->ProjectSector->headerCellClass() ?>"><div id="elh_project_ProjectSector" class="project_ProjectSector"><div class="ew-table-header-caption"><?php echo $project_grid->ProjectSector->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProjectSector" class="<?php echo $project_grid->ProjectSector->headerCellClass() ?>"><div><div id="elh_project_ProjectSector" class="project_ProjectSector">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_grid->ProjectSector->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_grid->ProjectSector->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_grid->ProjectSector->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_grid->Contractors->Visible) { // Contractors ?>
	<?php if ($project_grid->SortUrl($project_grid->Contractors) == "") { ?>
		<th data-name="Contractors" class="<?php echo $project_grid->Contractors->headerCellClass() ?>"><div id="elh_project_Contractors" class="project_Contractors"><div class="ew-table-header-caption"><?php echo $project_grid->Contractors->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Contractors" class="<?php echo $project_grid->Contractors->headerCellClass() ?>"><div><div id="elh_project_Contractors" class="project_Contractors">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_grid->Contractors->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_grid->Contractors->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_grid->Contractors->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_grid->PlannedStartDate->Visible) { // PlannedStartDate ?>
	<?php if ($project_grid->SortUrl($project_grid->PlannedStartDate) == "") { ?>
		<th data-name="PlannedStartDate" class="<?php echo $project_grid->PlannedStartDate->headerCellClass() ?>"><div id="elh_project_PlannedStartDate" class="project_PlannedStartDate"><div class="ew-table-header-caption"><?php echo $project_grid->PlannedStartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PlannedStartDate" class="<?php echo $project_grid->PlannedStartDate->headerCellClass() ?>"><div><div id="elh_project_PlannedStartDate" class="project_PlannedStartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_grid->PlannedStartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_grid->PlannedStartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_grid->PlannedStartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_grid->PlannedEndDate->Visible) { // PlannedEndDate ?>
	<?php if ($project_grid->SortUrl($project_grid->PlannedEndDate) == "") { ?>
		<th data-name="PlannedEndDate" class="<?php echo $project_grid->PlannedEndDate->headerCellClass() ?>"><div id="elh_project_PlannedEndDate" class="project_PlannedEndDate"><div class="ew-table-header-caption"><?php echo $project_grid->PlannedEndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PlannedEndDate" class="<?php echo $project_grid->PlannedEndDate->headerCellClass() ?>"><div><div id="elh_project_PlannedEndDate" class="project_PlannedEndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_grid->PlannedEndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_grid->PlannedEndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_grid->PlannedEndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_grid->ActualStartDate->Visible) { // ActualStartDate ?>
	<?php if ($project_grid->SortUrl($project_grid->ActualStartDate) == "") { ?>
		<th data-name="ActualStartDate" class="<?php echo $project_grid->ActualStartDate->headerCellClass() ?>"><div id="elh_project_ActualStartDate" class="project_ActualStartDate"><div class="ew-table-header-caption"><?php echo $project_grid->ActualStartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActualStartDate" class="<?php echo $project_grid->ActualStartDate->headerCellClass() ?>"><div><div id="elh_project_ActualStartDate" class="project_ActualStartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_grid->ActualStartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_grid->ActualStartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_grid->ActualStartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_grid->ActualEndDate->Visible) { // ActualEndDate ?>
	<?php if ($project_grid->SortUrl($project_grid->ActualEndDate) == "") { ?>
		<th data-name="ActualEndDate" class="<?php echo $project_grid->ActualEndDate->headerCellClass() ?>"><div id="elh_project_ActualEndDate" class="project_ActualEndDate"><div class="ew-table-header-caption"><?php echo $project_grid->ActualEndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActualEndDate" class="<?php echo $project_grid->ActualEndDate->headerCellClass() ?>"><div><div id="elh_project_ActualEndDate" class="project_ActualEndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_grid->ActualEndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_grid->ActualEndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_grid->ActualEndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_grid->Budget->Visible) { // Budget ?>
	<?php if ($project_grid->SortUrl($project_grid->Budget) == "") { ?>
		<th data-name="Budget" class="<?php echo $project_grid->Budget->headerCellClass() ?>"><div id="elh_project_Budget" class="project_Budget"><div class="ew-table-header-caption"><?php echo $project_grid->Budget->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Budget" class="<?php echo $project_grid->Budget->headerCellClass() ?>"><div><div id="elh_project_Budget" class="project_Budget">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_grid->Budget->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_grid->Budget->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_grid->Budget->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_grid->ProgressStatus->Visible) { // ProgressStatus ?>
	<?php if ($project_grid->SortUrl($project_grid->ProgressStatus) == "") { ?>
		<th data-name="ProgressStatus" class="<?php echo $project_grid->ProgressStatus->headerCellClass() ?>"><div id="elh_project_ProgressStatus" class="project_ProgressStatus"><div class="ew-table-header-caption"><?php echo $project_grid->ProgressStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgressStatus" class="<?php echo $project_grid->ProgressStatus->headerCellClass() ?>"><div><div id="elh_project_ProgressStatus" class="project_ProgressStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_grid->ProgressStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_grid->ProgressStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_grid->ProgressStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_grid->OutstandingTasks->Visible) { // OutstandingTasks ?>
	<?php if ($project_grid->SortUrl($project_grid->OutstandingTasks) == "") { ?>
		<th data-name="OutstandingTasks" class="<?php echo $project_grid->OutstandingTasks->headerCellClass() ?>"><div id="elh_project_OutstandingTasks" class="project_OutstandingTasks"><div class="ew-table-header-caption"><?php echo $project_grid->OutstandingTasks->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutstandingTasks" class="<?php echo $project_grid->OutstandingTasks->headerCellClass() ?>"><div><div id="elh_project_OutstandingTasks" class="project_OutstandingTasks">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_grid->OutstandingTasks->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_grid->OutstandingTasks->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_grid->OutstandingTasks->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$project_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$project_grid->StartRecord = 1;
$project_grid->StopRecord = $project_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($project->isConfirm() || $project_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($project_grid->FormKeyCountName) && ($project_grid->isGridAdd() || $project_grid->isGridEdit() || $project->isConfirm())) {
		$project_grid->KeyCount = $CurrentForm->getValue($project_grid->FormKeyCountName);
		$project_grid->StopRecord = $project_grid->StartRecord + $project_grid->KeyCount - 1;
	}
}
$project_grid->RecordCount = $project_grid->StartRecord - 1;
if ($project_grid->Recordset && !$project_grid->Recordset->EOF) {
	$project_grid->Recordset->moveFirst();
	$selectLimit = $project_grid->UseSelectLimit;
	if (!$selectLimit && $project_grid->StartRecord > 1)
		$project_grid->Recordset->move($project_grid->StartRecord - 1);
} elseif (!$project->AllowAddDeleteRow && $project_grid->StopRecord == 0) {
	$project_grid->StopRecord = $project->GridAddRowCount;
}

// Initialize aggregate
$project->RowType = ROWTYPE_AGGREGATEINIT;
$project->resetAttributes();
$project_grid->renderRow();
if ($project_grid->isGridAdd())
	$project_grid->RowIndex = 0;
if ($project_grid->isGridEdit())
	$project_grid->RowIndex = 0;
while ($project_grid->RecordCount < $project_grid->StopRecord) {
	$project_grid->RecordCount++;
	if ($project_grid->RecordCount >= $project_grid->StartRecord) {
		$project_grid->RowCount++;
		if ($project_grid->isGridAdd() || $project_grid->isGridEdit() || $project->isConfirm()) {
			$project_grid->RowIndex++;
			$CurrentForm->Index = $project_grid->RowIndex;
			if ($CurrentForm->hasValue($project_grid->FormActionName) && ($project->isConfirm() || $project_grid->EventCancelled))
				$project_grid->RowAction = strval($CurrentForm->getValue($project_grid->FormActionName));
			elseif ($project_grid->isGridAdd())
				$project_grid->RowAction = "insert";
			else
				$project_grid->RowAction = "";
		}

		// Set up key count
		$project_grid->KeyCount = $project_grid->RowIndex;

		// Init row class and style
		$project->resetAttributes();
		$project->CssClass = "";
		if ($project_grid->isGridAdd()) {
			if ($project->CurrentMode == "copy") {
				$project_grid->loadRowValues($project_grid->Recordset); // Load row values
				$project_grid->setRecordKey($project_grid->RowOldKey, $project_grid->Recordset); // Set old record key
			} else {
				$project_grid->loadRowValues(); // Load default values
				$project_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$project_grid->loadRowValues($project_grid->Recordset); // Load row values
		}
		$project->RowType = ROWTYPE_VIEW; // Render view
		if ($project_grid->isGridAdd()) // Grid add
			$project->RowType = ROWTYPE_ADD; // Render add
		if ($project_grid->isGridAdd() && $project->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$project_grid->restoreCurrentRowFormValues($project_grid->RowIndex); // Restore form values
		if ($project_grid->isGridEdit()) { // Grid edit
			if ($project->EventCancelled)
				$project_grid->restoreCurrentRowFormValues($project_grid->RowIndex); // Restore form values
			if ($project_grid->RowAction == "insert")
				$project->RowType = ROWTYPE_ADD; // Render add
			else
				$project->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($project_grid->isGridEdit() && ($project->RowType == ROWTYPE_EDIT || $project->RowType == ROWTYPE_ADD) && $project->EventCancelled) // Update failed
			$project_grid->restoreCurrentRowFormValues($project_grid->RowIndex); // Restore form values
		if ($project->RowType == ROWTYPE_EDIT) // Edit row
			$project_grid->EditRowCount++;
		if ($project->isConfirm()) // Confirm row
			$project_grid->restoreCurrentRowFormValues($project_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$project->RowAttrs->merge(["data-rowindex" => $project_grid->RowCount, "id" => "r" . $project_grid->RowCount . "_project", "data-rowtype" => $project->RowType]);

		// Render row
		$project_grid->renderRow();

		// Render list options
		$project_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($project_grid->RowAction != "delete" && $project_grid->RowAction != "insertdelete" && !($project_grid->RowAction == "insert" && $project->isConfirm() && $project_grid->emptyRow())) {
?>
	<tr <?php echo $project->rowAttributes() ?>>
<?php

// Render list options (body, left)
$project_grid->ListOptions->render("body", "left", $project_grid->RowCount);
?>
	<?php if ($project_grid->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $project_grid->ProvinceCode->cellAttributes() ?>>
<?php if ($project->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($project_grid->ProvinceCode->getSessionValue() != "") { ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ProvinceCode" class="form-group">
<span<?php echo $project_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($project_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $project_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $project_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($project_grid->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ProvinceCode" class="form-group">
<?php $project_grid->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_ProvinceCode" data-value-separator="<?php echo $project_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $project_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $project_grid->RowIndex ?>_ProvinceCode"<?php echo $project_grid->ProvinceCode->editAttributes() ?>>
			<?php echo $project_grid->ProvinceCode->selectOptionListHtml("x{$project_grid->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $project_grid->ProvinceCode->Lookup->getParamTag($project_grid, "p_x" . $project_grid->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="project" data-field="x_ProvinceCode" name="o<?php echo $project_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $project_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($project_grid->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php if ($project->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($project_grid->ProvinceCode->getSessionValue() != "") { ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ProvinceCode" class="form-group">
<span<?php echo $project_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($project_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $project_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $project_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($project_grid->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ProvinceCode" class="form-group">
<?php $project_grid->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_ProvinceCode" data-value-separator="<?php echo $project_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $project_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $project_grid->RowIndex ?>_ProvinceCode"<?php echo $project_grid->ProvinceCode->editAttributes() ?>>
			<?php echo $project_grid->ProvinceCode->selectOptionListHtml("x{$project_grid->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $project_grid->ProvinceCode->Lookup->getParamTag($project_grid, "p_x" . $project_grid->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($project->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ProvinceCode">
<span<?php echo $project_grid->ProvinceCode->viewAttributes() ?>><?php echo $project_grid->ProvinceCode->getViewValue() ?></span>
</span>
<?php if (!$project->isConfirm()) { ?>
<input type="hidden" data-table="project" data-field="x_ProvinceCode" name="x<?php echo $project_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $project_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($project_grid->ProvinceCode->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_ProvinceCode" name="o<?php echo $project_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $project_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($project_grid->ProvinceCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="project" data-field="x_ProvinceCode" name="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_ProvinceCode" id="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($project_grid->ProvinceCode->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_ProvinceCode" name="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_ProvinceCode" id="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($project_grid->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($project_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $project_grid->LACode->cellAttributes() ?>>
<?php if ($project->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($project_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_LACode" class="form-group">
<span<?php echo $project_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($project_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $project_grid->RowIndex ?>_LACode" name="x<?php echo $project_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($project_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_LACode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_LACode" data-value-separator="<?php echo $project_grid->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $project_grid->RowIndex ?>_LACode" name="x<?php echo $project_grid->RowIndex ?>_LACode"<?php echo $project_grid->LACode->editAttributes() ?>>
			<?php echo $project_grid->LACode->selectOptionListHtml("x{$project_grid->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $project_grid->LACode->Lookup->getParamTag($project_grid, "p_x" . $project_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="project" data-field="x_LACode" name="o<?php echo $project_grid->RowIndex ?>_LACode" id="o<?php echo $project_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($project_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($project->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($project_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_LACode" class="form-group">
<span<?php echo $project_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($project_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $project_grid->RowIndex ?>_LACode" name="x<?php echo $project_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($project_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_LACode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_LACode" data-value-separator="<?php echo $project_grid->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $project_grid->RowIndex ?>_LACode" name="x<?php echo $project_grid->RowIndex ?>_LACode"<?php echo $project_grid->LACode->editAttributes() ?>>
			<?php echo $project_grid->LACode->selectOptionListHtml("x{$project_grid->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $project_grid->LACode->Lookup->getParamTag($project_grid, "p_x" . $project_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($project->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_LACode">
<span<?php echo $project_grid->LACode->viewAttributes() ?>><?php echo $project_grid->LACode->getViewValue() ?></span>
</span>
<?php if (!$project->isConfirm()) { ?>
<input type="hidden" data-table="project" data-field="x_LACode" name="x<?php echo $project_grid->RowIndex ?>_LACode" id="x<?php echo $project_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($project_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_LACode" name="o<?php echo $project_grid->RowIndex ?>_LACode" id="o<?php echo $project_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($project_grid->LACode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="project" data-field="x_LACode" name="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_LACode" id="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($project_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_LACode" name="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_LACode" id="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($project_grid->LACode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($project_grid->ProjectCode->Visible) { // ProjectCode ?>
		<td data-name="ProjectCode" <?php echo $project_grid->ProjectCode->cellAttributes() ?>>
<?php if ($project->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ProjectCode" class="form-group">
<input type="text" data-table="project" data-field="x_ProjectCode" name="x<?php echo $project_grid->RowIndex ?>_ProjectCode" id="x<?php echo $project_grid->RowIndex ?>_ProjectCode" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($project_grid->ProjectCode->getPlaceHolder()) ?>" value="<?php echo $project_grid->ProjectCode->EditValue ?>"<?php echo $project_grid->ProjectCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="project" data-field="x_ProjectCode" name="o<?php echo $project_grid->RowIndex ?>_ProjectCode" id="o<?php echo $project_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($project_grid->ProjectCode->OldValue) ?>">
<?php } ?>
<?php if ($project->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="project" data-field="x_ProjectCode" name="x<?php echo $project_grid->RowIndex ?>_ProjectCode" id="x<?php echo $project_grid->RowIndex ?>_ProjectCode" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($project_grid->ProjectCode->getPlaceHolder()) ?>" value="<?php echo $project_grid->ProjectCode->EditValue ?>"<?php echo $project_grid->ProjectCode->editAttributes() ?>>
<input type="hidden" data-table="project" data-field="x_ProjectCode" name="o<?php echo $project_grid->RowIndex ?>_ProjectCode" id="o<?php echo $project_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($project_grid->ProjectCode->OldValue != null ? $project_grid->ProjectCode->OldValue : $project_grid->ProjectCode->CurrentValue) ?>">
<?php } ?>
<?php if ($project->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ProjectCode">
<span<?php echo $project_grid->ProjectCode->viewAttributes() ?>><?php echo $project_grid->ProjectCode->getViewValue() ?></span>
</span>
<?php if (!$project->isConfirm()) { ?>
<input type="hidden" data-table="project" data-field="x_ProjectCode" name="x<?php echo $project_grid->RowIndex ?>_ProjectCode" id="x<?php echo $project_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($project_grid->ProjectCode->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_ProjectCode" name="o<?php echo $project_grid->RowIndex ?>_ProjectCode" id="o<?php echo $project_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($project_grid->ProjectCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="project" data-field="x_ProjectCode" name="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_ProjectCode" id="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($project_grid->ProjectCode->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_ProjectCode" name="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_ProjectCode" id="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($project_grid->ProjectCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($project_grid->ProjectName->Visible) { // ProjectName ?>
		<td data-name="ProjectName" <?php echo $project_grid->ProjectName->cellAttributes() ?>>
<?php if ($project->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ProjectName" class="form-group">
<input type="text" data-table="project" data-field="x_ProjectName" name="x<?php echo $project_grid->RowIndex ?>_ProjectName" id="x<?php echo $project_grid->RowIndex ?>_ProjectName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($project_grid->ProjectName->getPlaceHolder()) ?>" value="<?php echo $project_grid->ProjectName->EditValue ?>"<?php echo $project_grid->ProjectName->editAttributes() ?>>
</span>
<input type="hidden" data-table="project" data-field="x_ProjectName" name="o<?php echo $project_grid->RowIndex ?>_ProjectName" id="o<?php echo $project_grid->RowIndex ?>_ProjectName" value="<?php echo HtmlEncode($project_grid->ProjectName->OldValue) ?>">
<?php } ?>
<?php if ($project->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ProjectName" class="form-group">
<input type="text" data-table="project" data-field="x_ProjectName" name="x<?php echo $project_grid->RowIndex ?>_ProjectName" id="x<?php echo $project_grid->RowIndex ?>_ProjectName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($project_grid->ProjectName->getPlaceHolder()) ?>" value="<?php echo $project_grid->ProjectName->EditValue ?>"<?php echo $project_grid->ProjectName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($project->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ProjectName">
<span<?php echo $project_grid->ProjectName->viewAttributes() ?>><?php echo $project_grid->ProjectName->getViewValue() ?></span>
</span>
<?php if (!$project->isConfirm()) { ?>
<input type="hidden" data-table="project" data-field="x_ProjectName" name="x<?php echo $project_grid->RowIndex ?>_ProjectName" id="x<?php echo $project_grid->RowIndex ?>_ProjectName" value="<?php echo HtmlEncode($project_grid->ProjectName->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_ProjectName" name="o<?php echo $project_grid->RowIndex ?>_ProjectName" id="o<?php echo $project_grid->RowIndex ?>_ProjectName" value="<?php echo HtmlEncode($project_grid->ProjectName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="project" data-field="x_ProjectName" name="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_ProjectName" id="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_ProjectName" value="<?php echo HtmlEncode($project_grid->ProjectName->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_ProjectName" name="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_ProjectName" id="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_ProjectName" value="<?php echo HtmlEncode($project_grid->ProjectName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($project_grid->ProjectType->Visible) { // ProjectType ?>
		<td data-name="ProjectType" <?php echo $project_grid->ProjectType->cellAttributes() ?>>
<?php if ($project->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ProjectType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_ProjectType" data-value-separator="<?php echo $project_grid->ProjectType->displayValueSeparatorAttribute() ?>" id="x<?php echo $project_grid->RowIndex ?>_ProjectType" name="x<?php echo $project_grid->RowIndex ?>_ProjectType"<?php echo $project_grid->ProjectType->editAttributes() ?>>
			<?php echo $project_grid->ProjectType->selectOptionListHtml("x{$project_grid->RowIndex}_ProjectType") ?>
		</select>
</div>
<?php echo $project_grid->ProjectType->Lookup->getParamTag($project_grid, "p_x" . $project_grid->RowIndex . "_ProjectType") ?>
</span>
<input type="hidden" data-table="project" data-field="x_ProjectType" name="o<?php echo $project_grid->RowIndex ?>_ProjectType" id="o<?php echo $project_grid->RowIndex ?>_ProjectType" value="<?php echo HtmlEncode($project_grid->ProjectType->OldValue) ?>">
<?php } ?>
<?php if ($project->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ProjectType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_ProjectType" data-value-separator="<?php echo $project_grid->ProjectType->displayValueSeparatorAttribute() ?>" id="x<?php echo $project_grid->RowIndex ?>_ProjectType" name="x<?php echo $project_grid->RowIndex ?>_ProjectType"<?php echo $project_grid->ProjectType->editAttributes() ?>>
			<?php echo $project_grid->ProjectType->selectOptionListHtml("x{$project_grid->RowIndex}_ProjectType") ?>
		</select>
</div>
<?php echo $project_grid->ProjectType->Lookup->getParamTag($project_grid, "p_x" . $project_grid->RowIndex . "_ProjectType") ?>
</span>
<?php } ?>
<?php if ($project->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ProjectType">
<span<?php echo $project_grid->ProjectType->viewAttributes() ?>><?php echo $project_grid->ProjectType->getViewValue() ?></span>
</span>
<?php if (!$project->isConfirm()) { ?>
<input type="hidden" data-table="project" data-field="x_ProjectType" name="x<?php echo $project_grid->RowIndex ?>_ProjectType" id="x<?php echo $project_grid->RowIndex ?>_ProjectType" value="<?php echo HtmlEncode($project_grid->ProjectType->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_ProjectType" name="o<?php echo $project_grid->RowIndex ?>_ProjectType" id="o<?php echo $project_grid->RowIndex ?>_ProjectType" value="<?php echo HtmlEncode($project_grid->ProjectType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="project" data-field="x_ProjectType" name="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_ProjectType" id="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_ProjectType" value="<?php echo HtmlEncode($project_grid->ProjectType->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_ProjectType" name="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_ProjectType" id="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_ProjectType" value="<?php echo HtmlEncode($project_grid->ProjectType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($project_grid->ProjectSector->Visible) { // ProjectSector ?>
		<td data-name="ProjectSector" <?php echo $project_grid->ProjectSector->cellAttributes() ?>>
<?php if ($project->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ProjectSector" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_ProjectSector" data-value-separator="<?php echo $project_grid->ProjectSector->displayValueSeparatorAttribute() ?>" id="x<?php echo $project_grid->RowIndex ?>_ProjectSector" name="x<?php echo $project_grid->RowIndex ?>_ProjectSector"<?php echo $project_grid->ProjectSector->editAttributes() ?>>
			<?php echo $project_grid->ProjectSector->selectOptionListHtml("x{$project_grid->RowIndex}_ProjectSector") ?>
		</select>
</div>
<?php echo $project_grid->ProjectSector->Lookup->getParamTag($project_grid, "p_x" . $project_grid->RowIndex . "_ProjectSector") ?>
</span>
<input type="hidden" data-table="project" data-field="x_ProjectSector" name="o<?php echo $project_grid->RowIndex ?>_ProjectSector" id="o<?php echo $project_grid->RowIndex ?>_ProjectSector" value="<?php echo HtmlEncode($project_grid->ProjectSector->OldValue) ?>">
<?php } ?>
<?php if ($project->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ProjectSector" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_ProjectSector" data-value-separator="<?php echo $project_grid->ProjectSector->displayValueSeparatorAttribute() ?>" id="x<?php echo $project_grid->RowIndex ?>_ProjectSector" name="x<?php echo $project_grid->RowIndex ?>_ProjectSector"<?php echo $project_grid->ProjectSector->editAttributes() ?>>
			<?php echo $project_grid->ProjectSector->selectOptionListHtml("x{$project_grid->RowIndex}_ProjectSector") ?>
		</select>
</div>
<?php echo $project_grid->ProjectSector->Lookup->getParamTag($project_grid, "p_x" . $project_grid->RowIndex . "_ProjectSector") ?>
</span>
<?php } ?>
<?php if ($project->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ProjectSector">
<span<?php echo $project_grid->ProjectSector->viewAttributes() ?>><?php echo $project_grid->ProjectSector->getViewValue() ?></span>
</span>
<?php if (!$project->isConfirm()) { ?>
<input type="hidden" data-table="project" data-field="x_ProjectSector" name="x<?php echo $project_grid->RowIndex ?>_ProjectSector" id="x<?php echo $project_grid->RowIndex ?>_ProjectSector" value="<?php echo HtmlEncode($project_grid->ProjectSector->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_ProjectSector" name="o<?php echo $project_grid->RowIndex ?>_ProjectSector" id="o<?php echo $project_grid->RowIndex ?>_ProjectSector" value="<?php echo HtmlEncode($project_grid->ProjectSector->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="project" data-field="x_ProjectSector" name="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_ProjectSector" id="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_ProjectSector" value="<?php echo HtmlEncode($project_grid->ProjectSector->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_ProjectSector" name="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_ProjectSector" id="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_ProjectSector" value="<?php echo HtmlEncode($project_grid->ProjectSector->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($project_grid->Contractors->Visible) { // Contractors ?>
		<td data-name="Contractors" <?php echo $project_grid->Contractors->cellAttributes() ?>>
<?php if ($project->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_Contractors" class="form-group">
<textarea data-table="project" data-field="x_Contractors" name="x<?php echo $project_grid->RowIndex ?>_Contractors" id="x<?php echo $project_grid->RowIndex ?>_Contractors" cols="50" rows="4" placeholder="<?php echo HtmlEncode($project_grid->Contractors->getPlaceHolder()) ?>"<?php echo $project_grid->Contractors->editAttributes() ?>><?php echo $project_grid->Contractors->EditValue ?></textarea>
</span>
<input type="hidden" data-table="project" data-field="x_Contractors" name="o<?php echo $project_grid->RowIndex ?>_Contractors" id="o<?php echo $project_grid->RowIndex ?>_Contractors" value="<?php echo HtmlEncode($project_grid->Contractors->OldValue) ?>">
<?php } ?>
<?php if ($project->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_Contractors" class="form-group">
<textarea data-table="project" data-field="x_Contractors" name="x<?php echo $project_grid->RowIndex ?>_Contractors" id="x<?php echo $project_grid->RowIndex ?>_Contractors" cols="50" rows="4" placeholder="<?php echo HtmlEncode($project_grid->Contractors->getPlaceHolder()) ?>"<?php echo $project_grid->Contractors->editAttributes() ?>><?php echo $project_grid->Contractors->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($project->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_Contractors">
<span<?php echo $project_grid->Contractors->viewAttributes() ?>><?php echo $project_grid->Contractors->getViewValue() ?></span>
</span>
<?php if (!$project->isConfirm()) { ?>
<input type="hidden" data-table="project" data-field="x_Contractors" name="x<?php echo $project_grid->RowIndex ?>_Contractors" id="x<?php echo $project_grid->RowIndex ?>_Contractors" value="<?php echo HtmlEncode($project_grid->Contractors->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_Contractors" name="o<?php echo $project_grid->RowIndex ?>_Contractors" id="o<?php echo $project_grid->RowIndex ?>_Contractors" value="<?php echo HtmlEncode($project_grid->Contractors->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="project" data-field="x_Contractors" name="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_Contractors" id="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_Contractors" value="<?php echo HtmlEncode($project_grid->Contractors->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_Contractors" name="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_Contractors" id="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_Contractors" value="<?php echo HtmlEncode($project_grid->Contractors->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($project_grid->PlannedStartDate->Visible) { // PlannedStartDate ?>
		<td data-name="PlannedStartDate" <?php echo $project_grid->PlannedStartDate->cellAttributes() ?>>
<?php if ($project->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_PlannedStartDate" class="form-group">
<input type="text" data-table="project" data-field="x_PlannedStartDate" name="x<?php echo $project_grid->RowIndex ?>_PlannedStartDate" id="x<?php echo $project_grid->RowIndex ?>_PlannedStartDate" placeholder="<?php echo HtmlEncode($project_grid->PlannedStartDate->getPlaceHolder()) ?>" value="<?php echo $project_grid->PlannedStartDate->EditValue ?>"<?php echo $project_grid->PlannedStartDate->editAttributes() ?>>
<?php if (!$project_grid->PlannedStartDate->ReadOnly && !$project_grid->PlannedStartDate->Disabled && !isset($project_grid->PlannedStartDate->EditAttrs["readonly"]) && !isset($project_grid->PlannedStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprojectgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fprojectgrid", "x<?php echo $project_grid->RowIndex ?>_PlannedStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="project" data-field="x_PlannedStartDate" name="o<?php echo $project_grid->RowIndex ?>_PlannedStartDate" id="o<?php echo $project_grid->RowIndex ?>_PlannedStartDate" value="<?php echo HtmlEncode($project_grid->PlannedStartDate->OldValue) ?>">
<?php } ?>
<?php if ($project->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_PlannedStartDate" class="form-group">
<input type="text" data-table="project" data-field="x_PlannedStartDate" name="x<?php echo $project_grid->RowIndex ?>_PlannedStartDate" id="x<?php echo $project_grid->RowIndex ?>_PlannedStartDate" placeholder="<?php echo HtmlEncode($project_grid->PlannedStartDate->getPlaceHolder()) ?>" value="<?php echo $project_grid->PlannedStartDate->EditValue ?>"<?php echo $project_grid->PlannedStartDate->editAttributes() ?>>
<?php if (!$project_grid->PlannedStartDate->ReadOnly && !$project_grid->PlannedStartDate->Disabled && !isset($project_grid->PlannedStartDate->EditAttrs["readonly"]) && !isset($project_grid->PlannedStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprojectgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fprojectgrid", "x<?php echo $project_grid->RowIndex ?>_PlannedStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($project->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_PlannedStartDate">
<span<?php echo $project_grid->PlannedStartDate->viewAttributes() ?>><?php echo $project_grid->PlannedStartDate->getViewValue() ?></span>
</span>
<?php if (!$project->isConfirm()) { ?>
<input type="hidden" data-table="project" data-field="x_PlannedStartDate" name="x<?php echo $project_grid->RowIndex ?>_PlannedStartDate" id="x<?php echo $project_grid->RowIndex ?>_PlannedStartDate" value="<?php echo HtmlEncode($project_grid->PlannedStartDate->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_PlannedStartDate" name="o<?php echo $project_grid->RowIndex ?>_PlannedStartDate" id="o<?php echo $project_grid->RowIndex ?>_PlannedStartDate" value="<?php echo HtmlEncode($project_grid->PlannedStartDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="project" data-field="x_PlannedStartDate" name="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_PlannedStartDate" id="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_PlannedStartDate" value="<?php echo HtmlEncode($project_grid->PlannedStartDate->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_PlannedStartDate" name="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_PlannedStartDate" id="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_PlannedStartDate" value="<?php echo HtmlEncode($project_grid->PlannedStartDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($project_grid->PlannedEndDate->Visible) { // PlannedEndDate ?>
		<td data-name="PlannedEndDate" <?php echo $project_grid->PlannedEndDate->cellAttributes() ?>>
<?php if ($project->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_PlannedEndDate" class="form-group">
<input type="text" data-table="project" data-field="x_PlannedEndDate" name="x<?php echo $project_grid->RowIndex ?>_PlannedEndDate" id="x<?php echo $project_grid->RowIndex ?>_PlannedEndDate" placeholder="<?php echo HtmlEncode($project_grid->PlannedEndDate->getPlaceHolder()) ?>" value="<?php echo $project_grid->PlannedEndDate->EditValue ?>"<?php echo $project_grid->PlannedEndDate->editAttributes() ?>>
<?php if (!$project_grid->PlannedEndDate->ReadOnly && !$project_grid->PlannedEndDate->Disabled && !isset($project_grid->PlannedEndDate->EditAttrs["readonly"]) && !isset($project_grid->PlannedEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprojectgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fprojectgrid", "x<?php echo $project_grid->RowIndex ?>_PlannedEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="project" data-field="x_PlannedEndDate" name="o<?php echo $project_grid->RowIndex ?>_PlannedEndDate" id="o<?php echo $project_grid->RowIndex ?>_PlannedEndDate" value="<?php echo HtmlEncode($project_grid->PlannedEndDate->OldValue) ?>">
<?php } ?>
<?php if ($project->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_PlannedEndDate" class="form-group">
<input type="text" data-table="project" data-field="x_PlannedEndDate" name="x<?php echo $project_grid->RowIndex ?>_PlannedEndDate" id="x<?php echo $project_grid->RowIndex ?>_PlannedEndDate" placeholder="<?php echo HtmlEncode($project_grid->PlannedEndDate->getPlaceHolder()) ?>" value="<?php echo $project_grid->PlannedEndDate->EditValue ?>"<?php echo $project_grid->PlannedEndDate->editAttributes() ?>>
<?php if (!$project_grid->PlannedEndDate->ReadOnly && !$project_grid->PlannedEndDate->Disabled && !isset($project_grid->PlannedEndDate->EditAttrs["readonly"]) && !isset($project_grid->PlannedEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprojectgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fprojectgrid", "x<?php echo $project_grid->RowIndex ?>_PlannedEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($project->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_PlannedEndDate">
<span<?php echo $project_grid->PlannedEndDate->viewAttributes() ?>><?php echo $project_grid->PlannedEndDate->getViewValue() ?></span>
</span>
<?php if (!$project->isConfirm()) { ?>
<input type="hidden" data-table="project" data-field="x_PlannedEndDate" name="x<?php echo $project_grid->RowIndex ?>_PlannedEndDate" id="x<?php echo $project_grid->RowIndex ?>_PlannedEndDate" value="<?php echo HtmlEncode($project_grid->PlannedEndDate->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_PlannedEndDate" name="o<?php echo $project_grid->RowIndex ?>_PlannedEndDate" id="o<?php echo $project_grid->RowIndex ?>_PlannedEndDate" value="<?php echo HtmlEncode($project_grid->PlannedEndDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="project" data-field="x_PlannedEndDate" name="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_PlannedEndDate" id="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_PlannedEndDate" value="<?php echo HtmlEncode($project_grid->PlannedEndDate->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_PlannedEndDate" name="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_PlannedEndDate" id="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_PlannedEndDate" value="<?php echo HtmlEncode($project_grid->PlannedEndDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($project_grid->ActualStartDate->Visible) { // ActualStartDate ?>
		<td data-name="ActualStartDate" <?php echo $project_grid->ActualStartDate->cellAttributes() ?>>
<?php if ($project->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ActualStartDate" class="form-group">
<input type="text" data-table="project" data-field="x_ActualStartDate" name="x<?php echo $project_grid->RowIndex ?>_ActualStartDate" id="x<?php echo $project_grid->RowIndex ?>_ActualStartDate" placeholder="<?php echo HtmlEncode($project_grid->ActualStartDate->getPlaceHolder()) ?>" value="<?php echo $project_grid->ActualStartDate->EditValue ?>"<?php echo $project_grid->ActualStartDate->editAttributes() ?>>
<?php if (!$project_grid->ActualStartDate->ReadOnly && !$project_grid->ActualStartDate->Disabled && !isset($project_grid->ActualStartDate->EditAttrs["readonly"]) && !isset($project_grid->ActualStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprojectgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fprojectgrid", "x<?php echo $project_grid->RowIndex ?>_ActualStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="project" data-field="x_ActualStartDate" name="o<?php echo $project_grid->RowIndex ?>_ActualStartDate" id="o<?php echo $project_grid->RowIndex ?>_ActualStartDate" value="<?php echo HtmlEncode($project_grid->ActualStartDate->OldValue) ?>">
<?php } ?>
<?php if ($project->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ActualStartDate" class="form-group">
<input type="text" data-table="project" data-field="x_ActualStartDate" name="x<?php echo $project_grid->RowIndex ?>_ActualStartDate" id="x<?php echo $project_grid->RowIndex ?>_ActualStartDate" placeholder="<?php echo HtmlEncode($project_grid->ActualStartDate->getPlaceHolder()) ?>" value="<?php echo $project_grid->ActualStartDate->EditValue ?>"<?php echo $project_grid->ActualStartDate->editAttributes() ?>>
<?php if (!$project_grid->ActualStartDate->ReadOnly && !$project_grid->ActualStartDate->Disabled && !isset($project_grid->ActualStartDate->EditAttrs["readonly"]) && !isset($project_grid->ActualStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprojectgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fprojectgrid", "x<?php echo $project_grid->RowIndex ?>_ActualStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($project->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ActualStartDate">
<span<?php echo $project_grid->ActualStartDate->viewAttributes() ?>><?php echo $project_grid->ActualStartDate->getViewValue() ?></span>
</span>
<?php if (!$project->isConfirm()) { ?>
<input type="hidden" data-table="project" data-field="x_ActualStartDate" name="x<?php echo $project_grid->RowIndex ?>_ActualStartDate" id="x<?php echo $project_grid->RowIndex ?>_ActualStartDate" value="<?php echo HtmlEncode($project_grid->ActualStartDate->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_ActualStartDate" name="o<?php echo $project_grid->RowIndex ?>_ActualStartDate" id="o<?php echo $project_grid->RowIndex ?>_ActualStartDate" value="<?php echo HtmlEncode($project_grid->ActualStartDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="project" data-field="x_ActualStartDate" name="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_ActualStartDate" id="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_ActualStartDate" value="<?php echo HtmlEncode($project_grid->ActualStartDate->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_ActualStartDate" name="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_ActualStartDate" id="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_ActualStartDate" value="<?php echo HtmlEncode($project_grid->ActualStartDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($project_grid->ActualEndDate->Visible) { // ActualEndDate ?>
		<td data-name="ActualEndDate" <?php echo $project_grid->ActualEndDate->cellAttributes() ?>>
<?php if ($project->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ActualEndDate" class="form-group">
<input type="text" data-table="project" data-field="x_ActualEndDate" name="x<?php echo $project_grid->RowIndex ?>_ActualEndDate" id="x<?php echo $project_grid->RowIndex ?>_ActualEndDate" placeholder="<?php echo HtmlEncode($project_grid->ActualEndDate->getPlaceHolder()) ?>" value="<?php echo $project_grid->ActualEndDate->EditValue ?>"<?php echo $project_grid->ActualEndDate->editAttributes() ?>>
<?php if (!$project_grid->ActualEndDate->ReadOnly && !$project_grid->ActualEndDate->Disabled && !isset($project_grid->ActualEndDate->EditAttrs["readonly"]) && !isset($project_grid->ActualEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprojectgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fprojectgrid", "x<?php echo $project_grid->RowIndex ?>_ActualEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="project" data-field="x_ActualEndDate" name="o<?php echo $project_grid->RowIndex ?>_ActualEndDate" id="o<?php echo $project_grid->RowIndex ?>_ActualEndDate" value="<?php echo HtmlEncode($project_grid->ActualEndDate->OldValue) ?>">
<?php } ?>
<?php if ($project->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ActualEndDate" class="form-group">
<input type="text" data-table="project" data-field="x_ActualEndDate" name="x<?php echo $project_grid->RowIndex ?>_ActualEndDate" id="x<?php echo $project_grid->RowIndex ?>_ActualEndDate" placeholder="<?php echo HtmlEncode($project_grid->ActualEndDate->getPlaceHolder()) ?>" value="<?php echo $project_grid->ActualEndDate->EditValue ?>"<?php echo $project_grid->ActualEndDate->editAttributes() ?>>
<?php if (!$project_grid->ActualEndDate->ReadOnly && !$project_grid->ActualEndDate->Disabled && !isset($project_grid->ActualEndDate->EditAttrs["readonly"]) && !isset($project_grid->ActualEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprojectgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fprojectgrid", "x<?php echo $project_grid->RowIndex ?>_ActualEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($project->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ActualEndDate">
<span<?php echo $project_grid->ActualEndDate->viewAttributes() ?>><?php echo $project_grid->ActualEndDate->getViewValue() ?></span>
</span>
<?php if (!$project->isConfirm()) { ?>
<input type="hidden" data-table="project" data-field="x_ActualEndDate" name="x<?php echo $project_grid->RowIndex ?>_ActualEndDate" id="x<?php echo $project_grid->RowIndex ?>_ActualEndDate" value="<?php echo HtmlEncode($project_grid->ActualEndDate->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_ActualEndDate" name="o<?php echo $project_grid->RowIndex ?>_ActualEndDate" id="o<?php echo $project_grid->RowIndex ?>_ActualEndDate" value="<?php echo HtmlEncode($project_grid->ActualEndDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="project" data-field="x_ActualEndDate" name="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_ActualEndDate" id="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_ActualEndDate" value="<?php echo HtmlEncode($project_grid->ActualEndDate->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_ActualEndDate" name="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_ActualEndDate" id="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_ActualEndDate" value="<?php echo HtmlEncode($project_grid->ActualEndDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($project_grid->Budget->Visible) { // Budget ?>
		<td data-name="Budget" <?php echo $project_grid->Budget->cellAttributes() ?>>
<?php if ($project->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_Budget" class="form-group">
<input type="text" data-table="project" data-field="x_Budget" name="x<?php echo $project_grid->RowIndex ?>_Budget" id="x<?php echo $project_grid->RowIndex ?>_Budget" size="30" placeholder="<?php echo HtmlEncode($project_grid->Budget->getPlaceHolder()) ?>" value="<?php echo $project_grid->Budget->EditValue ?>"<?php echo $project_grid->Budget->editAttributes() ?>>
</span>
<input type="hidden" data-table="project" data-field="x_Budget" name="o<?php echo $project_grid->RowIndex ?>_Budget" id="o<?php echo $project_grid->RowIndex ?>_Budget" value="<?php echo HtmlEncode($project_grid->Budget->OldValue) ?>">
<?php } ?>
<?php if ($project->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_Budget" class="form-group">
<input type="text" data-table="project" data-field="x_Budget" name="x<?php echo $project_grid->RowIndex ?>_Budget" id="x<?php echo $project_grid->RowIndex ?>_Budget" size="30" placeholder="<?php echo HtmlEncode($project_grid->Budget->getPlaceHolder()) ?>" value="<?php echo $project_grid->Budget->EditValue ?>"<?php echo $project_grid->Budget->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($project->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_Budget">
<span<?php echo $project_grid->Budget->viewAttributes() ?>><?php echo $project_grid->Budget->getViewValue() ?></span>
</span>
<?php if (!$project->isConfirm()) { ?>
<input type="hidden" data-table="project" data-field="x_Budget" name="x<?php echo $project_grid->RowIndex ?>_Budget" id="x<?php echo $project_grid->RowIndex ?>_Budget" value="<?php echo HtmlEncode($project_grid->Budget->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_Budget" name="o<?php echo $project_grid->RowIndex ?>_Budget" id="o<?php echo $project_grid->RowIndex ?>_Budget" value="<?php echo HtmlEncode($project_grid->Budget->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="project" data-field="x_Budget" name="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_Budget" id="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_Budget" value="<?php echo HtmlEncode($project_grid->Budget->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_Budget" name="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_Budget" id="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_Budget" value="<?php echo HtmlEncode($project_grid->Budget->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($project_grid->ProgressStatus->Visible) { // ProgressStatus ?>
		<td data-name="ProgressStatus" <?php echo $project_grid->ProgressStatus->cellAttributes() ?>>
<?php if ($project->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ProgressStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_ProgressStatus" data-value-separator="<?php echo $project_grid->ProgressStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $project_grid->RowIndex ?>_ProgressStatus" name="x<?php echo $project_grid->RowIndex ?>_ProgressStatus"<?php echo $project_grid->ProgressStatus->editAttributes() ?>>
			<?php echo $project_grid->ProgressStatus->selectOptionListHtml("x{$project_grid->RowIndex}_ProgressStatus") ?>
		</select>
</div>
<?php echo $project_grid->ProgressStatus->Lookup->getParamTag($project_grid, "p_x" . $project_grid->RowIndex . "_ProgressStatus") ?>
</span>
<input type="hidden" data-table="project" data-field="x_ProgressStatus" name="o<?php echo $project_grid->RowIndex ?>_ProgressStatus" id="o<?php echo $project_grid->RowIndex ?>_ProgressStatus" value="<?php echo HtmlEncode($project_grid->ProgressStatus->OldValue) ?>">
<?php } ?>
<?php if ($project->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ProgressStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_ProgressStatus" data-value-separator="<?php echo $project_grid->ProgressStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $project_grid->RowIndex ?>_ProgressStatus" name="x<?php echo $project_grid->RowIndex ?>_ProgressStatus"<?php echo $project_grid->ProgressStatus->editAttributes() ?>>
			<?php echo $project_grid->ProgressStatus->selectOptionListHtml("x{$project_grid->RowIndex}_ProgressStatus") ?>
		</select>
</div>
<?php echo $project_grid->ProgressStatus->Lookup->getParamTag($project_grid, "p_x" . $project_grid->RowIndex . "_ProgressStatus") ?>
</span>
<?php } ?>
<?php if ($project->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_ProgressStatus">
<span<?php echo $project_grid->ProgressStatus->viewAttributes() ?>><?php echo $project_grid->ProgressStatus->getViewValue() ?></span>
</span>
<?php if (!$project->isConfirm()) { ?>
<input type="hidden" data-table="project" data-field="x_ProgressStatus" name="x<?php echo $project_grid->RowIndex ?>_ProgressStatus" id="x<?php echo $project_grid->RowIndex ?>_ProgressStatus" value="<?php echo HtmlEncode($project_grid->ProgressStatus->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_ProgressStatus" name="o<?php echo $project_grid->RowIndex ?>_ProgressStatus" id="o<?php echo $project_grid->RowIndex ?>_ProgressStatus" value="<?php echo HtmlEncode($project_grid->ProgressStatus->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="project" data-field="x_ProgressStatus" name="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_ProgressStatus" id="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_ProgressStatus" value="<?php echo HtmlEncode($project_grid->ProgressStatus->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_ProgressStatus" name="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_ProgressStatus" id="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_ProgressStatus" value="<?php echo HtmlEncode($project_grid->ProgressStatus->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($project_grid->OutstandingTasks->Visible) { // OutstandingTasks ?>
		<td data-name="OutstandingTasks" <?php echo $project_grid->OutstandingTasks->cellAttributes() ?>>
<?php if ($project->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_OutstandingTasks" class="form-group">
<textarea data-table="project" data-field="x_OutstandingTasks" name="x<?php echo $project_grid->RowIndex ?>_OutstandingTasks" id="x<?php echo $project_grid->RowIndex ?>_OutstandingTasks" cols="50" rows="4" placeholder="<?php echo HtmlEncode($project_grid->OutstandingTasks->getPlaceHolder()) ?>"<?php echo $project_grid->OutstandingTasks->editAttributes() ?>><?php echo $project_grid->OutstandingTasks->EditValue ?></textarea>
</span>
<input type="hidden" data-table="project" data-field="x_OutstandingTasks" name="o<?php echo $project_grid->RowIndex ?>_OutstandingTasks" id="o<?php echo $project_grid->RowIndex ?>_OutstandingTasks" value="<?php echo HtmlEncode($project_grid->OutstandingTasks->OldValue) ?>">
<?php } ?>
<?php if ($project->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_OutstandingTasks" class="form-group">
<textarea data-table="project" data-field="x_OutstandingTasks" name="x<?php echo $project_grid->RowIndex ?>_OutstandingTasks" id="x<?php echo $project_grid->RowIndex ?>_OutstandingTasks" cols="50" rows="4" placeholder="<?php echo HtmlEncode($project_grid->OutstandingTasks->getPlaceHolder()) ?>"<?php echo $project_grid->OutstandingTasks->editAttributes() ?>><?php echo $project_grid->OutstandingTasks->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($project->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $project_grid->RowCount ?>_project_OutstandingTasks">
<span<?php echo $project_grid->OutstandingTasks->viewAttributes() ?>><?php echo $project_grid->OutstandingTasks->getViewValue() ?></span>
</span>
<?php if (!$project->isConfirm()) { ?>
<input type="hidden" data-table="project" data-field="x_OutstandingTasks" name="x<?php echo $project_grid->RowIndex ?>_OutstandingTasks" id="x<?php echo $project_grid->RowIndex ?>_OutstandingTasks" value="<?php echo HtmlEncode($project_grid->OutstandingTasks->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_OutstandingTasks" name="o<?php echo $project_grid->RowIndex ?>_OutstandingTasks" id="o<?php echo $project_grid->RowIndex ?>_OutstandingTasks" value="<?php echo HtmlEncode($project_grid->OutstandingTasks->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="project" data-field="x_OutstandingTasks" name="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_OutstandingTasks" id="fprojectgrid$x<?php echo $project_grid->RowIndex ?>_OutstandingTasks" value="<?php echo HtmlEncode($project_grid->OutstandingTasks->FormValue) ?>">
<input type="hidden" data-table="project" data-field="x_OutstandingTasks" name="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_OutstandingTasks" id="fprojectgrid$o<?php echo $project_grid->RowIndex ?>_OutstandingTasks" value="<?php echo HtmlEncode($project_grid->OutstandingTasks->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$project_grid->ListOptions->render("body", "right", $project_grid->RowCount);
?>
	</tr>
<?php if ($project->RowType == ROWTYPE_ADD || $project->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fprojectgrid", "load"], function() {
	fprojectgrid.updateLists(<?php echo $project_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$project_grid->isGridAdd() || $project->CurrentMode == "copy")
		if (!$project_grid->Recordset->EOF)
			$project_grid->Recordset->moveNext();
}
?>
<?php
	if ($project->CurrentMode == "add" || $project->CurrentMode == "copy" || $project->CurrentMode == "edit") {
		$project_grid->RowIndex = '$rowindex$';
		$project_grid->loadRowValues();

		// Set row properties
		$project->resetAttributes();
		$project->RowAttrs->merge(["data-rowindex" => $project_grid->RowIndex, "id" => "r0_project", "data-rowtype" => ROWTYPE_ADD]);
		$project->RowAttrs->appendClass("ew-template");
		$project->RowType = ROWTYPE_ADD;

		// Render row
		$project_grid->renderRow();

		// Render list options
		$project_grid->renderListOptions();
		$project_grid->StartRowCount = 0;
?>
	<tr <?php echo $project->rowAttributes() ?>>
<?php

// Render list options (body, left)
$project_grid->ListOptions->render("body", "left", $project_grid->RowIndex);
?>
	<?php if ($project_grid->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode">
<?php if (!$project->isConfirm()) { ?>
<?php if ($project_grid->ProvinceCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_project_ProvinceCode" class="form-group project_ProvinceCode">
<span<?php echo $project_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($project_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $project_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $project_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($project_grid->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_project_ProvinceCode" class="form-group project_ProvinceCode">
<?php $project_grid->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_ProvinceCode" data-value-separator="<?php echo $project_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $project_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $project_grid->RowIndex ?>_ProvinceCode"<?php echo $project_grid->ProvinceCode->editAttributes() ?>>
			<?php echo $project_grid->ProvinceCode->selectOptionListHtml("x{$project_grid->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $project_grid->ProvinceCode->Lookup->getParamTag($project_grid, "p_x" . $project_grid->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_project_ProvinceCode" class="form-group project_ProvinceCode">
<span<?php echo $project_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($project_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="project" data-field="x_ProvinceCode" name="x<?php echo $project_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $project_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($project_grid->ProvinceCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="project" data-field="x_ProvinceCode" name="o<?php echo $project_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $project_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($project_grid->ProvinceCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($project_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if (!$project->isConfirm()) { ?>
<?php if ($project_grid->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_project_LACode" class="form-group project_LACode">
<span<?php echo $project_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($project_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $project_grid->RowIndex ?>_LACode" name="x<?php echo $project_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($project_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_project_LACode" class="form-group project_LACode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_LACode" data-value-separator="<?php echo $project_grid->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $project_grid->RowIndex ?>_LACode" name="x<?php echo $project_grid->RowIndex ?>_LACode"<?php echo $project_grid->LACode->editAttributes() ?>>
			<?php echo $project_grid->LACode->selectOptionListHtml("x{$project_grid->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $project_grid->LACode->Lookup->getParamTag($project_grid, "p_x" . $project_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_project_LACode" class="form-group project_LACode">
<span<?php echo $project_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($project_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="project" data-field="x_LACode" name="x<?php echo $project_grid->RowIndex ?>_LACode" id="x<?php echo $project_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($project_grid->LACode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="project" data-field="x_LACode" name="o<?php echo $project_grid->RowIndex ?>_LACode" id="o<?php echo $project_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($project_grid->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($project_grid->ProjectCode->Visible) { // ProjectCode ?>
		<td data-name="ProjectCode">
<?php if (!$project->isConfirm()) { ?>
<span id="el$rowindex$_project_ProjectCode" class="form-group project_ProjectCode">
<input type="text" data-table="project" data-field="x_ProjectCode" name="x<?php echo $project_grid->RowIndex ?>_ProjectCode" id="x<?php echo $project_grid->RowIndex ?>_ProjectCode" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($project_grid->ProjectCode->getPlaceHolder()) ?>" value="<?php echo $project_grid->ProjectCode->EditValue ?>"<?php echo $project_grid->ProjectCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_project_ProjectCode" class="form-group project_ProjectCode">
<span<?php echo $project_grid->ProjectCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($project_grid->ProjectCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="project" data-field="x_ProjectCode" name="x<?php echo $project_grid->RowIndex ?>_ProjectCode" id="x<?php echo $project_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($project_grid->ProjectCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="project" data-field="x_ProjectCode" name="o<?php echo $project_grid->RowIndex ?>_ProjectCode" id="o<?php echo $project_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($project_grid->ProjectCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($project_grid->ProjectName->Visible) { // ProjectName ?>
		<td data-name="ProjectName">
<?php if (!$project->isConfirm()) { ?>
<span id="el$rowindex$_project_ProjectName" class="form-group project_ProjectName">
<input type="text" data-table="project" data-field="x_ProjectName" name="x<?php echo $project_grid->RowIndex ?>_ProjectName" id="x<?php echo $project_grid->RowIndex ?>_ProjectName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($project_grid->ProjectName->getPlaceHolder()) ?>" value="<?php echo $project_grid->ProjectName->EditValue ?>"<?php echo $project_grid->ProjectName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_project_ProjectName" class="form-group project_ProjectName">
<span<?php echo $project_grid->ProjectName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($project_grid->ProjectName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="project" data-field="x_ProjectName" name="x<?php echo $project_grid->RowIndex ?>_ProjectName" id="x<?php echo $project_grid->RowIndex ?>_ProjectName" value="<?php echo HtmlEncode($project_grid->ProjectName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="project" data-field="x_ProjectName" name="o<?php echo $project_grid->RowIndex ?>_ProjectName" id="o<?php echo $project_grid->RowIndex ?>_ProjectName" value="<?php echo HtmlEncode($project_grid->ProjectName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($project_grid->ProjectType->Visible) { // ProjectType ?>
		<td data-name="ProjectType">
<?php if (!$project->isConfirm()) { ?>
<span id="el$rowindex$_project_ProjectType" class="form-group project_ProjectType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_ProjectType" data-value-separator="<?php echo $project_grid->ProjectType->displayValueSeparatorAttribute() ?>" id="x<?php echo $project_grid->RowIndex ?>_ProjectType" name="x<?php echo $project_grid->RowIndex ?>_ProjectType"<?php echo $project_grid->ProjectType->editAttributes() ?>>
			<?php echo $project_grid->ProjectType->selectOptionListHtml("x{$project_grid->RowIndex}_ProjectType") ?>
		</select>
</div>
<?php echo $project_grid->ProjectType->Lookup->getParamTag($project_grid, "p_x" . $project_grid->RowIndex . "_ProjectType") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_project_ProjectType" class="form-group project_ProjectType">
<span<?php echo $project_grid->ProjectType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($project_grid->ProjectType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="project" data-field="x_ProjectType" name="x<?php echo $project_grid->RowIndex ?>_ProjectType" id="x<?php echo $project_grid->RowIndex ?>_ProjectType" value="<?php echo HtmlEncode($project_grid->ProjectType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="project" data-field="x_ProjectType" name="o<?php echo $project_grid->RowIndex ?>_ProjectType" id="o<?php echo $project_grid->RowIndex ?>_ProjectType" value="<?php echo HtmlEncode($project_grid->ProjectType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($project_grid->ProjectSector->Visible) { // ProjectSector ?>
		<td data-name="ProjectSector">
<?php if (!$project->isConfirm()) { ?>
<span id="el$rowindex$_project_ProjectSector" class="form-group project_ProjectSector">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_ProjectSector" data-value-separator="<?php echo $project_grid->ProjectSector->displayValueSeparatorAttribute() ?>" id="x<?php echo $project_grid->RowIndex ?>_ProjectSector" name="x<?php echo $project_grid->RowIndex ?>_ProjectSector"<?php echo $project_grid->ProjectSector->editAttributes() ?>>
			<?php echo $project_grid->ProjectSector->selectOptionListHtml("x{$project_grid->RowIndex}_ProjectSector") ?>
		</select>
</div>
<?php echo $project_grid->ProjectSector->Lookup->getParamTag($project_grid, "p_x" . $project_grid->RowIndex . "_ProjectSector") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_project_ProjectSector" class="form-group project_ProjectSector">
<span<?php echo $project_grid->ProjectSector->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($project_grid->ProjectSector->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="project" data-field="x_ProjectSector" name="x<?php echo $project_grid->RowIndex ?>_ProjectSector" id="x<?php echo $project_grid->RowIndex ?>_ProjectSector" value="<?php echo HtmlEncode($project_grid->ProjectSector->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="project" data-field="x_ProjectSector" name="o<?php echo $project_grid->RowIndex ?>_ProjectSector" id="o<?php echo $project_grid->RowIndex ?>_ProjectSector" value="<?php echo HtmlEncode($project_grid->ProjectSector->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($project_grid->Contractors->Visible) { // Contractors ?>
		<td data-name="Contractors">
<?php if (!$project->isConfirm()) { ?>
<span id="el$rowindex$_project_Contractors" class="form-group project_Contractors">
<textarea data-table="project" data-field="x_Contractors" name="x<?php echo $project_grid->RowIndex ?>_Contractors" id="x<?php echo $project_grid->RowIndex ?>_Contractors" cols="50" rows="4" placeholder="<?php echo HtmlEncode($project_grid->Contractors->getPlaceHolder()) ?>"<?php echo $project_grid->Contractors->editAttributes() ?>><?php echo $project_grid->Contractors->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_project_Contractors" class="form-group project_Contractors">
<span<?php echo $project_grid->Contractors->viewAttributes() ?>><?php echo $project_grid->Contractors->ViewValue ?></span>
</span>
<input type="hidden" data-table="project" data-field="x_Contractors" name="x<?php echo $project_grid->RowIndex ?>_Contractors" id="x<?php echo $project_grid->RowIndex ?>_Contractors" value="<?php echo HtmlEncode($project_grid->Contractors->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="project" data-field="x_Contractors" name="o<?php echo $project_grid->RowIndex ?>_Contractors" id="o<?php echo $project_grid->RowIndex ?>_Contractors" value="<?php echo HtmlEncode($project_grid->Contractors->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($project_grid->PlannedStartDate->Visible) { // PlannedStartDate ?>
		<td data-name="PlannedStartDate">
<?php if (!$project->isConfirm()) { ?>
<span id="el$rowindex$_project_PlannedStartDate" class="form-group project_PlannedStartDate">
<input type="text" data-table="project" data-field="x_PlannedStartDate" name="x<?php echo $project_grid->RowIndex ?>_PlannedStartDate" id="x<?php echo $project_grid->RowIndex ?>_PlannedStartDate" placeholder="<?php echo HtmlEncode($project_grid->PlannedStartDate->getPlaceHolder()) ?>" value="<?php echo $project_grid->PlannedStartDate->EditValue ?>"<?php echo $project_grid->PlannedStartDate->editAttributes() ?>>
<?php if (!$project_grid->PlannedStartDate->ReadOnly && !$project_grid->PlannedStartDate->Disabled && !isset($project_grid->PlannedStartDate->EditAttrs["readonly"]) && !isset($project_grid->PlannedStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprojectgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fprojectgrid", "x<?php echo $project_grid->RowIndex ?>_PlannedStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_project_PlannedStartDate" class="form-group project_PlannedStartDate">
<span<?php echo $project_grid->PlannedStartDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($project_grid->PlannedStartDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="project" data-field="x_PlannedStartDate" name="x<?php echo $project_grid->RowIndex ?>_PlannedStartDate" id="x<?php echo $project_grid->RowIndex ?>_PlannedStartDate" value="<?php echo HtmlEncode($project_grid->PlannedStartDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="project" data-field="x_PlannedStartDate" name="o<?php echo $project_grid->RowIndex ?>_PlannedStartDate" id="o<?php echo $project_grid->RowIndex ?>_PlannedStartDate" value="<?php echo HtmlEncode($project_grid->PlannedStartDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($project_grid->PlannedEndDate->Visible) { // PlannedEndDate ?>
		<td data-name="PlannedEndDate">
<?php if (!$project->isConfirm()) { ?>
<span id="el$rowindex$_project_PlannedEndDate" class="form-group project_PlannedEndDate">
<input type="text" data-table="project" data-field="x_PlannedEndDate" name="x<?php echo $project_grid->RowIndex ?>_PlannedEndDate" id="x<?php echo $project_grid->RowIndex ?>_PlannedEndDate" placeholder="<?php echo HtmlEncode($project_grid->PlannedEndDate->getPlaceHolder()) ?>" value="<?php echo $project_grid->PlannedEndDate->EditValue ?>"<?php echo $project_grid->PlannedEndDate->editAttributes() ?>>
<?php if (!$project_grid->PlannedEndDate->ReadOnly && !$project_grid->PlannedEndDate->Disabled && !isset($project_grid->PlannedEndDate->EditAttrs["readonly"]) && !isset($project_grid->PlannedEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprojectgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fprojectgrid", "x<?php echo $project_grid->RowIndex ?>_PlannedEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_project_PlannedEndDate" class="form-group project_PlannedEndDate">
<span<?php echo $project_grid->PlannedEndDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($project_grid->PlannedEndDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="project" data-field="x_PlannedEndDate" name="x<?php echo $project_grid->RowIndex ?>_PlannedEndDate" id="x<?php echo $project_grid->RowIndex ?>_PlannedEndDate" value="<?php echo HtmlEncode($project_grid->PlannedEndDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="project" data-field="x_PlannedEndDate" name="o<?php echo $project_grid->RowIndex ?>_PlannedEndDate" id="o<?php echo $project_grid->RowIndex ?>_PlannedEndDate" value="<?php echo HtmlEncode($project_grid->PlannedEndDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($project_grid->ActualStartDate->Visible) { // ActualStartDate ?>
		<td data-name="ActualStartDate">
<?php if (!$project->isConfirm()) { ?>
<span id="el$rowindex$_project_ActualStartDate" class="form-group project_ActualStartDate">
<input type="text" data-table="project" data-field="x_ActualStartDate" name="x<?php echo $project_grid->RowIndex ?>_ActualStartDate" id="x<?php echo $project_grid->RowIndex ?>_ActualStartDate" placeholder="<?php echo HtmlEncode($project_grid->ActualStartDate->getPlaceHolder()) ?>" value="<?php echo $project_grid->ActualStartDate->EditValue ?>"<?php echo $project_grid->ActualStartDate->editAttributes() ?>>
<?php if (!$project_grid->ActualStartDate->ReadOnly && !$project_grid->ActualStartDate->Disabled && !isset($project_grid->ActualStartDate->EditAttrs["readonly"]) && !isset($project_grid->ActualStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprojectgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fprojectgrid", "x<?php echo $project_grid->RowIndex ?>_ActualStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_project_ActualStartDate" class="form-group project_ActualStartDate">
<span<?php echo $project_grid->ActualStartDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($project_grid->ActualStartDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="project" data-field="x_ActualStartDate" name="x<?php echo $project_grid->RowIndex ?>_ActualStartDate" id="x<?php echo $project_grid->RowIndex ?>_ActualStartDate" value="<?php echo HtmlEncode($project_grid->ActualStartDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="project" data-field="x_ActualStartDate" name="o<?php echo $project_grid->RowIndex ?>_ActualStartDate" id="o<?php echo $project_grid->RowIndex ?>_ActualStartDate" value="<?php echo HtmlEncode($project_grid->ActualStartDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($project_grid->ActualEndDate->Visible) { // ActualEndDate ?>
		<td data-name="ActualEndDate">
<?php if (!$project->isConfirm()) { ?>
<span id="el$rowindex$_project_ActualEndDate" class="form-group project_ActualEndDate">
<input type="text" data-table="project" data-field="x_ActualEndDate" name="x<?php echo $project_grid->RowIndex ?>_ActualEndDate" id="x<?php echo $project_grid->RowIndex ?>_ActualEndDate" placeholder="<?php echo HtmlEncode($project_grid->ActualEndDate->getPlaceHolder()) ?>" value="<?php echo $project_grid->ActualEndDate->EditValue ?>"<?php echo $project_grid->ActualEndDate->editAttributes() ?>>
<?php if (!$project_grid->ActualEndDate->ReadOnly && !$project_grid->ActualEndDate->Disabled && !isset($project_grid->ActualEndDate->EditAttrs["readonly"]) && !isset($project_grid->ActualEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprojectgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fprojectgrid", "x<?php echo $project_grid->RowIndex ?>_ActualEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_project_ActualEndDate" class="form-group project_ActualEndDate">
<span<?php echo $project_grid->ActualEndDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($project_grid->ActualEndDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="project" data-field="x_ActualEndDate" name="x<?php echo $project_grid->RowIndex ?>_ActualEndDate" id="x<?php echo $project_grid->RowIndex ?>_ActualEndDate" value="<?php echo HtmlEncode($project_grid->ActualEndDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="project" data-field="x_ActualEndDate" name="o<?php echo $project_grid->RowIndex ?>_ActualEndDate" id="o<?php echo $project_grid->RowIndex ?>_ActualEndDate" value="<?php echo HtmlEncode($project_grid->ActualEndDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($project_grid->Budget->Visible) { // Budget ?>
		<td data-name="Budget">
<?php if (!$project->isConfirm()) { ?>
<span id="el$rowindex$_project_Budget" class="form-group project_Budget">
<input type="text" data-table="project" data-field="x_Budget" name="x<?php echo $project_grid->RowIndex ?>_Budget" id="x<?php echo $project_grid->RowIndex ?>_Budget" size="30" placeholder="<?php echo HtmlEncode($project_grid->Budget->getPlaceHolder()) ?>" value="<?php echo $project_grid->Budget->EditValue ?>"<?php echo $project_grid->Budget->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_project_Budget" class="form-group project_Budget">
<span<?php echo $project_grid->Budget->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($project_grid->Budget->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="project" data-field="x_Budget" name="x<?php echo $project_grid->RowIndex ?>_Budget" id="x<?php echo $project_grid->RowIndex ?>_Budget" value="<?php echo HtmlEncode($project_grid->Budget->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="project" data-field="x_Budget" name="o<?php echo $project_grid->RowIndex ?>_Budget" id="o<?php echo $project_grid->RowIndex ?>_Budget" value="<?php echo HtmlEncode($project_grid->Budget->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($project_grid->ProgressStatus->Visible) { // ProgressStatus ?>
		<td data-name="ProgressStatus">
<?php if (!$project->isConfirm()) { ?>
<span id="el$rowindex$_project_ProgressStatus" class="form-group project_ProgressStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_ProgressStatus" data-value-separator="<?php echo $project_grid->ProgressStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $project_grid->RowIndex ?>_ProgressStatus" name="x<?php echo $project_grid->RowIndex ?>_ProgressStatus"<?php echo $project_grid->ProgressStatus->editAttributes() ?>>
			<?php echo $project_grid->ProgressStatus->selectOptionListHtml("x{$project_grid->RowIndex}_ProgressStatus") ?>
		</select>
</div>
<?php echo $project_grid->ProgressStatus->Lookup->getParamTag($project_grid, "p_x" . $project_grid->RowIndex . "_ProgressStatus") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_project_ProgressStatus" class="form-group project_ProgressStatus">
<span<?php echo $project_grid->ProgressStatus->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($project_grid->ProgressStatus->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="project" data-field="x_ProgressStatus" name="x<?php echo $project_grid->RowIndex ?>_ProgressStatus" id="x<?php echo $project_grid->RowIndex ?>_ProgressStatus" value="<?php echo HtmlEncode($project_grid->ProgressStatus->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="project" data-field="x_ProgressStatus" name="o<?php echo $project_grid->RowIndex ?>_ProgressStatus" id="o<?php echo $project_grid->RowIndex ?>_ProgressStatus" value="<?php echo HtmlEncode($project_grid->ProgressStatus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($project_grid->OutstandingTasks->Visible) { // OutstandingTasks ?>
		<td data-name="OutstandingTasks">
<?php if (!$project->isConfirm()) { ?>
<span id="el$rowindex$_project_OutstandingTasks" class="form-group project_OutstandingTasks">
<textarea data-table="project" data-field="x_OutstandingTasks" name="x<?php echo $project_grid->RowIndex ?>_OutstandingTasks" id="x<?php echo $project_grid->RowIndex ?>_OutstandingTasks" cols="50" rows="4" placeholder="<?php echo HtmlEncode($project_grid->OutstandingTasks->getPlaceHolder()) ?>"<?php echo $project_grid->OutstandingTasks->editAttributes() ?>><?php echo $project_grid->OutstandingTasks->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_project_OutstandingTasks" class="form-group project_OutstandingTasks">
<span<?php echo $project_grid->OutstandingTasks->viewAttributes() ?>><?php echo $project_grid->OutstandingTasks->ViewValue ?></span>
</span>
<input type="hidden" data-table="project" data-field="x_OutstandingTasks" name="x<?php echo $project_grid->RowIndex ?>_OutstandingTasks" id="x<?php echo $project_grid->RowIndex ?>_OutstandingTasks" value="<?php echo HtmlEncode($project_grid->OutstandingTasks->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="project" data-field="x_OutstandingTasks" name="o<?php echo $project_grid->RowIndex ?>_OutstandingTasks" id="o<?php echo $project_grid->RowIndex ?>_OutstandingTasks" value="<?php echo HtmlEncode($project_grid->OutstandingTasks->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$project_grid->ListOptions->render("body", "right", $project_grid->RowIndex);
?>
<script>
loadjs.ready(["fprojectgrid", "load"], function() {
	fprojectgrid.updateLists(<?php echo $project_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($project->CurrentMode == "add" || $project->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $project_grid->FormKeyCountName ?>" id="<?php echo $project_grid->FormKeyCountName ?>" value="<?php echo $project_grid->KeyCount ?>">
<?php echo $project_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($project->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $project_grid->FormKeyCountName ?>" id="<?php echo $project_grid->FormKeyCountName ?>" value="<?php echo $project_grid->KeyCount ?>">
<?php echo $project_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($project->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fprojectgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($project_grid->Recordset)
	$project_grid->Recordset->Close();
?>
<?php if ($project_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $project_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($project_grid->TotalRecords == 0 && !$project->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $project_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$project_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$project_grid->terminate();
?>