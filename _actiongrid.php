<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($_action_grid))
	$_action_grid = new _action_grid();

// Run the page
$_action_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_action_grid->Page_Render();
?>
<?php if (!$_action_grid->isExport()) { ?>
<script>
var f_actiongrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	f_actiongrid = new ew.Form("f_actiongrid", "grid");
	f_actiongrid.formKeyCountName = '<?php echo $_action_grid->FormKeyCountName ?>';

	// Validate form
	f_actiongrid.validate = function() {
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
			<?php if ($_action_grid->ProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_grid->ProgramCode->caption(), $_action_grid->ProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_grid->OucomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OucomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_grid->OucomeCode->caption(), $_action_grid->OucomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OucomeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_action_grid->OucomeCode->errorMessage()) ?>");
			<?php if ($_action_grid->OutputCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_grid->OutputCode->caption(), $_action_grid->OutputCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_action_grid->OutputCode->errorMessage()) ?>");
			<?php if ($_action_grid->ProjectCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_grid->ProjectCode->caption(), $_action_grid->ProjectCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_grid->ActionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_grid->ActionCode->caption(), $_action_grid->ActionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_grid->ActionName->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_grid->ActionName->caption(), $_action_grid->ActionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_grid->ActionType->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_grid->ActionType->caption(), $_action_grid->ActionType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_grid->FinancialYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_grid->FinancialYear->caption(), $_action_grid->FinancialYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_action_grid->FinancialYear->errorMessage()) ?>");
			<?php if ($_action_grid->ExpectedAnnualAchievement->Required) { ?>
				elm = this.getElements("x" + infix + "_ExpectedAnnualAchievement");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_grid->ExpectedAnnualAchievement->caption(), $_action_grid->ExpectedAnnualAchievement->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_grid->ActionLocation->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionLocation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_grid->ActionLocation->caption(), $_action_grid->ActionLocation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_grid->Latitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_grid->Latitude->caption(), $_action_grid->Latitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_action_grid->Latitude->errorMessage()) ?>");
			<?php if ($_action_grid->Longitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_grid->Longitude->caption(), $_action_grid->Longitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_action_grid->Longitude->errorMessage()) ?>");
			<?php if ($_action_grid->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_grid->LACode->caption(), $_action_grid->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_grid->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_grid->DepartmentCode->caption(), $_action_grid->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_grid->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_grid->SectionCode->caption(), $_action_grid->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	f_actiongrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ProgramCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "OucomeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutputCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProjectCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActionName", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActionType", false)) return false;
		if (ew.valueChanged(fobj, infix, "FinancialYear", false)) return false;
		if (ew.valueChanged(fobj, infix, "ExpectedAnnualAchievement", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActionLocation", false)) return false;
		if (ew.valueChanged(fobj, infix, "Latitude", false)) return false;
		if (ew.valueChanged(fobj, infix, "Longitude", false)) return false;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SectionCode", false)) return false;
		return true;
	}

	// Form_CustomValidate
	f_actiongrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	f_actiongrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	f_actiongrid.lists["x_ProgramCode"] = <?php echo $_action_grid->ProgramCode->Lookup->toClientList($_action_grid) ?>;
	f_actiongrid.lists["x_ProgramCode"].options = <?php echo JsonEncode($_action_grid->ProgramCode->lookupOptions()) ?>;
	f_actiongrid.autoSuggests["x_ProgramCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	f_actiongrid.lists["x_OucomeCode"] = <?php echo $_action_grid->OucomeCode->Lookup->toClientList($_action_grid) ?>;
	f_actiongrid.lists["x_OucomeCode"].options = <?php echo JsonEncode($_action_grid->OucomeCode->lookupOptions()) ?>;
	f_actiongrid.autoSuggests["x_OucomeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	f_actiongrid.lists["x_OutputCode"] = <?php echo $_action_grid->OutputCode->Lookup->toClientList($_action_grid) ?>;
	f_actiongrid.lists["x_OutputCode"].options = <?php echo JsonEncode($_action_grid->OutputCode->lookupOptions()) ?>;
	f_actiongrid.autoSuggests["x_OutputCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	f_actiongrid.lists["x_ProjectCode"] = <?php echo $_action_grid->ProjectCode->Lookup->toClientList($_action_grid) ?>;
	f_actiongrid.lists["x_ProjectCode"].options = <?php echo JsonEncode($_action_grid->ProjectCode->lookupOptions()) ?>;
	f_actiongrid.lists["x_ActionType"] = <?php echo $_action_grid->ActionType->Lookup->toClientList($_action_grid) ?>;
	f_actiongrid.lists["x_ActionType"].options = <?php echo JsonEncode($_action_grid->ActionType->lookupOptions()) ?>;
	f_actiongrid.lists["x_LACode"] = <?php echo $_action_grid->LACode->Lookup->toClientList($_action_grid) ?>;
	f_actiongrid.lists["x_LACode"].options = <?php echo JsonEncode($_action_grid->LACode->lookupOptions()) ?>;
	f_actiongrid.lists["x_DepartmentCode"] = <?php echo $_action_grid->DepartmentCode->Lookup->toClientList($_action_grid) ?>;
	f_actiongrid.lists["x_DepartmentCode"].options = <?php echo JsonEncode($_action_grid->DepartmentCode->lookupOptions()) ?>;
	f_actiongrid.lists["x_SectionCode"] = <?php echo $_action_grid->SectionCode->Lookup->toClientList($_action_grid) ?>;
	f_actiongrid.lists["x_SectionCode"].options = <?php echo JsonEncode($_action_grid->SectionCode->lookupOptions()) ?>;
	loadjs.done("f_actiongrid");
});
</script>
<?php } ?>
<?php
$_action_grid->renderOtherOptions();
?>
<?php if ($_action_grid->TotalRecords > 0 || $_action->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($_action_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> _action">
<?php if ($_action_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $_action_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="f_actiongrid" class="ew-form ew-list-form form-inline">
<div id="gmp__action" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl__actiongrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$_action->RowType = ROWTYPE_HEADER;

// Render list options
$_action_grid->renderListOptions();

// Render list options (header, left)
$_action_grid->ListOptions->render("header", "left");
?>
<?php if ($_action_grid->ProgramCode->Visible) { // ProgramCode ?>
	<?php if ($_action_grid->SortUrl($_action_grid->ProgramCode) == "") { ?>
		<th data-name="ProgramCode" class="<?php echo $_action_grid->ProgramCode->headerCellClass() ?>"><div id="elh__action_ProgramCode" class="_action_ProgramCode"><div class="ew-table-header-caption"><?php echo $_action_grid->ProgramCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgramCode" class="<?php echo $_action_grid->ProgramCode->headerCellClass() ?>"><div><div id="elh__action_ProgramCode" class="_action_ProgramCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_grid->ProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_grid->ProgramCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_grid->ProgramCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_grid->OucomeCode->Visible) { // OucomeCode ?>
	<?php if ($_action_grid->SortUrl($_action_grid->OucomeCode) == "") { ?>
		<th data-name="OucomeCode" class="<?php echo $_action_grid->OucomeCode->headerCellClass() ?>"><div id="elh__action_OucomeCode" class="_action_OucomeCode"><div class="ew-table-header-caption"><?php echo $_action_grid->OucomeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OucomeCode" class="<?php echo $_action_grid->OucomeCode->headerCellClass() ?>"><div><div id="elh__action_OucomeCode" class="_action_OucomeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_grid->OucomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_grid->OucomeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_grid->OucomeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_grid->OutputCode->Visible) { // OutputCode ?>
	<?php if ($_action_grid->SortUrl($_action_grid->OutputCode) == "") { ?>
		<th data-name="OutputCode" class="<?php echo $_action_grid->OutputCode->headerCellClass() ?>"><div id="elh__action_OutputCode" class="_action_OutputCode"><div class="ew-table-header-caption"><?php echo $_action_grid->OutputCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputCode" class="<?php echo $_action_grid->OutputCode->headerCellClass() ?>"><div><div id="elh__action_OutputCode" class="_action_OutputCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_grid->OutputCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_grid->OutputCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_grid->OutputCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_grid->ProjectCode->Visible) { // ProjectCode ?>
	<?php if ($_action_grid->SortUrl($_action_grid->ProjectCode) == "") { ?>
		<th data-name="ProjectCode" class="<?php echo $_action_grid->ProjectCode->headerCellClass() ?>"><div id="elh__action_ProjectCode" class="_action_ProjectCode"><div class="ew-table-header-caption"><?php echo $_action_grid->ProjectCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProjectCode" class="<?php echo $_action_grid->ProjectCode->headerCellClass() ?>"><div><div id="elh__action_ProjectCode" class="_action_ProjectCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_grid->ProjectCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_grid->ProjectCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_grid->ProjectCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_grid->ActionCode->Visible) { // ActionCode ?>
	<?php if ($_action_grid->SortUrl($_action_grid->ActionCode) == "") { ?>
		<th data-name="ActionCode" class="<?php echo $_action_grid->ActionCode->headerCellClass() ?>"><div id="elh__action_ActionCode" class="_action_ActionCode"><div class="ew-table-header-caption"><?php echo $_action_grid->ActionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionCode" class="<?php echo $_action_grid->ActionCode->headerCellClass() ?>"><div><div id="elh__action_ActionCode" class="_action_ActionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_grid->ActionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_grid->ActionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_grid->ActionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_grid->ActionName->Visible) { // ActionName ?>
	<?php if ($_action_grid->SortUrl($_action_grid->ActionName) == "") { ?>
		<th data-name="ActionName" class="<?php echo $_action_grid->ActionName->headerCellClass() ?>"><div id="elh__action_ActionName" class="_action_ActionName"><div class="ew-table-header-caption"><?php echo $_action_grid->ActionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionName" class="<?php echo $_action_grid->ActionName->headerCellClass() ?>"><div><div id="elh__action_ActionName" class="_action_ActionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_grid->ActionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_grid->ActionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_grid->ActionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_grid->ActionType->Visible) { // ActionType ?>
	<?php if ($_action_grid->SortUrl($_action_grid->ActionType) == "") { ?>
		<th data-name="ActionType" class="<?php echo $_action_grid->ActionType->headerCellClass() ?>"><div id="elh__action_ActionType" class="_action_ActionType"><div class="ew-table-header-caption"><?php echo $_action_grid->ActionType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionType" class="<?php echo $_action_grid->ActionType->headerCellClass() ?>"><div><div id="elh__action_ActionType" class="_action_ActionType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_grid->ActionType->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_grid->ActionType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_grid->ActionType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_grid->FinancialYear->Visible) { // FinancialYear ?>
	<?php if ($_action_grid->SortUrl($_action_grid->FinancialYear) == "") { ?>
		<th data-name="FinancialYear" class="<?php echo $_action_grid->FinancialYear->headerCellClass() ?>"><div id="elh__action_FinancialYear" class="_action_FinancialYear"><div class="ew-table-header-caption"><?php echo $_action_grid->FinancialYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FinancialYear" class="<?php echo $_action_grid->FinancialYear->headerCellClass() ?>"><div><div id="elh__action_FinancialYear" class="_action_FinancialYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_grid->FinancialYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_grid->FinancialYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_grid->FinancialYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_grid->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
	<?php if ($_action_grid->SortUrl($_action_grid->ExpectedAnnualAchievement) == "") { ?>
		<th data-name="ExpectedAnnualAchievement" class="<?php echo $_action_grid->ExpectedAnnualAchievement->headerCellClass() ?>"><div id="elh__action_ExpectedAnnualAchievement" class="_action_ExpectedAnnualAchievement"><div class="ew-table-header-caption"><?php echo $_action_grid->ExpectedAnnualAchievement->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExpectedAnnualAchievement" class="<?php echo $_action_grid->ExpectedAnnualAchievement->headerCellClass() ?>"><div><div id="elh__action_ExpectedAnnualAchievement" class="_action_ExpectedAnnualAchievement">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_grid->ExpectedAnnualAchievement->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_grid->ExpectedAnnualAchievement->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_grid->ExpectedAnnualAchievement->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_grid->ActionLocation->Visible) { // ActionLocation ?>
	<?php if ($_action_grid->SortUrl($_action_grid->ActionLocation) == "") { ?>
		<th data-name="ActionLocation" class="<?php echo $_action_grid->ActionLocation->headerCellClass() ?>"><div id="elh__action_ActionLocation" class="_action_ActionLocation"><div class="ew-table-header-caption"><?php echo $_action_grid->ActionLocation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionLocation" class="<?php echo $_action_grid->ActionLocation->headerCellClass() ?>"><div><div id="elh__action_ActionLocation" class="_action_ActionLocation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_grid->ActionLocation->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_grid->ActionLocation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_grid->ActionLocation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_grid->Latitude->Visible) { // Latitude ?>
	<?php if ($_action_grid->SortUrl($_action_grid->Latitude) == "") { ?>
		<th data-name="Latitude" class="<?php echo $_action_grid->Latitude->headerCellClass() ?>"><div id="elh__action_Latitude" class="_action_Latitude"><div class="ew-table-header-caption"><?php echo $_action_grid->Latitude->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Latitude" class="<?php echo $_action_grid->Latitude->headerCellClass() ?>"><div><div id="elh__action_Latitude" class="_action_Latitude">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_grid->Latitude->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_grid->Latitude->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_grid->Latitude->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_grid->Longitude->Visible) { // Longitude ?>
	<?php if ($_action_grid->SortUrl($_action_grid->Longitude) == "") { ?>
		<th data-name="Longitude" class="<?php echo $_action_grid->Longitude->headerCellClass() ?>"><div id="elh__action_Longitude" class="_action_Longitude"><div class="ew-table-header-caption"><?php echo $_action_grid->Longitude->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Longitude" class="<?php echo $_action_grid->Longitude->headerCellClass() ?>"><div><div id="elh__action_Longitude" class="_action_Longitude">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_grid->Longitude->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_grid->Longitude->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_grid->Longitude->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_grid->LACode->Visible) { // LACode ?>
	<?php if ($_action_grid->SortUrl($_action_grid->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $_action_grid->LACode->headerCellClass() ?>"><div id="elh__action_LACode" class="_action_LACode"><div class="ew-table-header-caption"><?php echo $_action_grid->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $_action_grid->LACode->headerCellClass() ?>"><div><div id="elh__action_LACode" class="_action_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_grid->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_grid->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_grid->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_grid->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($_action_grid->SortUrl($_action_grid->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $_action_grid->DepartmentCode->headerCellClass() ?>"><div id="elh__action_DepartmentCode" class="_action_DepartmentCode"><div class="ew-table-header-caption"><?php echo $_action_grid->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $_action_grid->DepartmentCode->headerCellClass() ?>"><div><div id="elh__action_DepartmentCode" class="_action_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_grid->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_grid->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_grid->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_grid->SectionCode->Visible) { // SectionCode ?>
	<?php if ($_action_grid->SortUrl($_action_grid->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $_action_grid->SectionCode->headerCellClass() ?>"><div id="elh__action_SectionCode" class="_action_SectionCode"><div class="ew-table-header-caption"><?php echo $_action_grid->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $_action_grid->SectionCode->headerCellClass() ?>"><div><div id="elh__action_SectionCode" class="_action_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_grid->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_grid->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_grid->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$_action_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$_action_grid->StartRecord = 1;
$_action_grid->StopRecord = $_action_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($_action->isConfirm() || $_action_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($_action_grid->FormKeyCountName) && ($_action_grid->isGridAdd() || $_action_grid->isGridEdit() || $_action->isConfirm())) {
		$_action_grid->KeyCount = $CurrentForm->getValue($_action_grid->FormKeyCountName);
		$_action_grid->StopRecord = $_action_grid->StartRecord + $_action_grid->KeyCount - 1;
	}
}
$_action_grid->RecordCount = $_action_grid->StartRecord - 1;
if ($_action_grid->Recordset && !$_action_grid->Recordset->EOF) {
	$_action_grid->Recordset->moveFirst();
	$selectLimit = $_action_grid->UseSelectLimit;
	if (!$selectLimit && $_action_grid->StartRecord > 1)
		$_action_grid->Recordset->move($_action_grid->StartRecord - 1);
} elseif (!$_action->AllowAddDeleteRow && $_action_grid->StopRecord == 0) {
	$_action_grid->StopRecord = $_action->GridAddRowCount;
}

// Initialize aggregate
$_action->RowType = ROWTYPE_AGGREGATEINIT;
$_action->resetAttributes();
$_action_grid->renderRow();
if ($_action_grid->isGridAdd())
	$_action_grid->RowIndex = 0;
if ($_action_grid->isGridEdit())
	$_action_grid->RowIndex = 0;
while ($_action_grid->RecordCount < $_action_grid->StopRecord) {
	$_action_grid->RecordCount++;
	if ($_action_grid->RecordCount >= $_action_grid->StartRecord) {
		$_action_grid->RowCount++;
		if ($_action_grid->isGridAdd() || $_action_grid->isGridEdit() || $_action->isConfirm()) {
			$_action_grid->RowIndex++;
			$CurrentForm->Index = $_action_grid->RowIndex;
			if ($CurrentForm->hasValue($_action_grid->FormActionName) && ($_action->isConfirm() || $_action_grid->EventCancelled))
				$_action_grid->RowAction = strval($CurrentForm->getValue($_action_grid->FormActionName));
			elseif ($_action_grid->isGridAdd())
				$_action_grid->RowAction = "insert";
			else
				$_action_grid->RowAction = "";
		}

		// Set up key count
		$_action_grid->KeyCount = $_action_grid->RowIndex;

		// Init row class and style
		$_action->resetAttributes();
		$_action->CssClass = "";
		if ($_action_grid->isGridAdd()) {
			if ($_action->CurrentMode == "copy") {
				$_action_grid->loadRowValues($_action_grid->Recordset); // Load row values
				$_action_grid->setRecordKey($_action_grid->RowOldKey, $_action_grid->Recordset); // Set old record key
			} else {
				$_action_grid->loadRowValues(); // Load default values
				$_action_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$_action_grid->loadRowValues($_action_grid->Recordset); // Load row values
		}
		$_action->RowType = ROWTYPE_VIEW; // Render view
		if ($_action_grid->isGridAdd()) // Grid add
			$_action->RowType = ROWTYPE_ADD; // Render add
		if ($_action_grid->isGridAdd() && $_action->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$_action_grid->restoreCurrentRowFormValues($_action_grid->RowIndex); // Restore form values
		if ($_action_grid->isGridEdit()) { // Grid edit
			if ($_action->EventCancelled)
				$_action_grid->restoreCurrentRowFormValues($_action_grid->RowIndex); // Restore form values
			if ($_action_grid->RowAction == "insert")
				$_action->RowType = ROWTYPE_ADD; // Render add
			else
				$_action->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($_action_grid->isGridEdit() && ($_action->RowType == ROWTYPE_EDIT || $_action->RowType == ROWTYPE_ADD) && $_action->EventCancelled) // Update failed
			$_action_grid->restoreCurrentRowFormValues($_action_grid->RowIndex); // Restore form values
		if ($_action->RowType == ROWTYPE_EDIT) // Edit row
			$_action_grid->EditRowCount++;
		if ($_action->isConfirm()) // Confirm row
			$_action_grid->restoreCurrentRowFormValues($_action_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$_action->RowAttrs->merge(["data-rowindex" => $_action_grid->RowCount, "id" => "r" . $_action_grid->RowCount . "__action", "data-rowtype" => $_action->RowType]);

		// Render row
		$_action_grid->renderRow();

		// Render list options
		$_action_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($_action_grid->RowAction != "delete" && $_action_grid->RowAction != "insertdelete" && !($_action_grid->RowAction == "insert" && $_action->isConfirm() && $_action_grid->emptyRow())) {
?>
	<tr <?php echo $_action->rowAttributes() ?>>
<?php

// Render list options (body, left)
$_action_grid->ListOptions->render("body", "left", $_action_grid->RowCount);
?>
	<?php if ($_action_grid->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode" <?php echo $_action_grid->ProgramCode->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($_action_grid->ProgramCode->getSessionValue() != "") { ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_ProgramCode" class="form-group">
<span<?php echo $_action_grid->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_grid->RowIndex ?>_ProgramCode" name="x<?php echo $_action_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($_action_grid->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_ProgramCode" class="form-group">
<?php
$onchange = $_action_grid->ProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_grid->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_action_grid->RowIndex ?>_ProgramCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_action_grid->RowIndex ?>_ProgramCode" id="sv_x<?php echo $_action_grid->RowIndex ?>_ProgramCode" value="<?php echo RemoveHtml($_action_grid->ProgramCode->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($_action_grid->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_grid->ProgramCode->getPlaceHolder()) ?>"<?php echo $_action_grid->ProgramCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_grid->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_grid->RowIndex ?>_ProgramCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_grid->ProgramCode->ReadOnly || $_action_grid->ProgramCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_grid->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_grid->RowIndex ?>_ProgramCode" id="x<?php echo $_action_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($_action_grid->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actiongrid"], function() {
	f_actiongrid.createAutoSuggest({"id":"x<?php echo $_action_grid->RowIndex ?>_ProgramCode","forceSelect":false});
});
</script>
<?php echo $_action_grid->ProgramCode->Lookup->getParamTag($_action_grid, "p_x" . $_action_grid->RowIndex . "_ProgramCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_ProgramCode" name="o<?php echo $_action_grid->RowIndex ?>_ProgramCode" id="o<?php echo $_action_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($_action_grid->ProgramCode->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($_action_grid->ProgramCode->getSessionValue() != "") { ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_ProgramCode" class="form-group">
<span<?php echo $_action_grid->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_grid->RowIndex ?>_ProgramCode" name="x<?php echo $_action_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($_action_grid->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_ProgramCode" class="form-group">
<?php
$onchange = $_action_grid->ProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_grid->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_action_grid->RowIndex ?>_ProgramCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_action_grid->RowIndex ?>_ProgramCode" id="sv_x<?php echo $_action_grid->RowIndex ?>_ProgramCode" value="<?php echo RemoveHtml($_action_grid->ProgramCode->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($_action_grid->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_grid->ProgramCode->getPlaceHolder()) ?>"<?php echo $_action_grid->ProgramCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_grid->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_grid->RowIndex ?>_ProgramCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_grid->ProgramCode->ReadOnly || $_action_grid->ProgramCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_grid->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_grid->RowIndex ?>_ProgramCode" id="x<?php echo $_action_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($_action_grid->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actiongrid"], function() {
	f_actiongrid.createAutoSuggest({"id":"x<?php echo $_action_grid->RowIndex ?>_ProgramCode","forceSelect":false});
});
</script>
<?php echo $_action_grid->ProgramCode->Lookup->getParamTag($_action_grid, "p_x" . $_action_grid->RowIndex . "_ProgramCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_ProgramCode">
<span<?php echo $_action_grid->ProgramCode->viewAttributes() ?>><?php echo $_action_grid->ProgramCode->getViewValue() ?></span>
</span>
<?php if (!$_action->isConfirm()) { ?>
<input type="hidden" data-table="_action" data-field="x_ProgramCode" name="x<?php echo $_action_grid->RowIndex ?>_ProgramCode" id="x<?php echo $_action_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($_action_grid->ProgramCode->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_ProgramCode" name="o<?php echo $_action_grid->RowIndex ?>_ProgramCode" id="o<?php echo $_action_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($_action_grid->ProgramCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_action" data-field="x_ProgramCode" name="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_ProgramCode" id="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($_action_grid->ProgramCode->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_ProgramCode" name="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_ProgramCode" id="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($_action_grid->ProgramCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_grid->OucomeCode->Visible) { // OucomeCode ?>
		<td data-name="OucomeCode" <?php echo $_action_grid->OucomeCode->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($_action_grid->OucomeCode->getSessionValue() != "") { ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_OucomeCode" class="form-group">
<span<?php echo $_action_grid->OucomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->OucomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_grid->RowIndex ?>_OucomeCode" name="x<?php echo $_action_grid->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($_action_grid->OucomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_OucomeCode" class="form-group">
<?php
$onchange = $_action_grid->OucomeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_grid->OucomeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_action_grid->RowIndex ?>_OucomeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_action_grid->RowIndex ?>_OucomeCode" id="sv_x<?php echo $_action_grid->RowIndex ?>_OucomeCode" value="<?php echo RemoveHtml($_action_grid->OucomeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_action_grid->OucomeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_grid->OucomeCode->getPlaceHolder()) ?>"<?php echo $_action_grid->OucomeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_grid->OucomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_grid->RowIndex ?>_OucomeCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_grid->OucomeCode->ReadOnly || $_action_grid->OucomeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_OucomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_grid->OucomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_grid->RowIndex ?>_OucomeCode" id="x<?php echo $_action_grid->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($_action_grid->OucomeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actiongrid"], function() {
	f_actiongrid.createAutoSuggest({"id":"x<?php echo $_action_grid->RowIndex ?>_OucomeCode","forceSelect":false});
});
</script>
<?php echo $_action_grid->OucomeCode->Lookup->getParamTag($_action_grid, "p_x" . $_action_grid->RowIndex . "_OucomeCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_OucomeCode" name="o<?php echo $_action_grid->RowIndex ?>_OucomeCode" id="o<?php echo $_action_grid->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($_action_grid->OucomeCode->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($_action_grid->OucomeCode->getSessionValue() != "") { ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_OucomeCode" class="form-group">
<span<?php echo $_action_grid->OucomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->OucomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_grid->RowIndex ?>_OucomeCode" name="x<?php echo $_action_grid->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($_action_grid->OucomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_OucomeCode" class="form-group">
<?php
$onchange = $_action_grid->OucomeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_grid->OucomeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_action_grid->RowIndex ?>_OucomeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_action_grid->RowIndex ?>_OucomeCode" id="sv_x<?php echo $_action_grid->RowIndex ?>_OucomeCode" value="<?php echo RemoveHtml($_action_grid->OucomeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_action_grid->OucomeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_grid->OucomeCode->getPlaceHolder()) ?>"<?php echo $_action_grid->OucomeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_grid->OucomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_grid->RowIndex ?>_OucomeCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_grid->OucomeCode->ReadOnly || $_action_grid->OucomeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_OucomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_grid->OucomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_grid->RowIndex ?>_OucomeCode" id="x<?php echo $_action_grid->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($_action_grid->OucomeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actiongrid"], function() {
	f_actiongrid.createAutoSuggest({"id":"x<?php echo $_action_grid->RowIndex ?>_OucomeCode","forceSelect":false});
});
</script>
<?php echo $_action_grid->OucomeCode->Lookup->getParamTag($_action_grid, "p_x" . $_action_grid->RowIndex . "_OucomeCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_OucomeCode">
<span<?php echo $_action_grid->OucomeCode->viewAttributes() ?>><?php echo $_action_grid->OucomeCode->getViewValue() ?></span>
</span>
<?php if (!$_action->isConfirm()) { ?>
<input type="hidden" data-table="_action" data-field="x_OucomeCode" name="x<?php echo $_action_grid->RowIndex ?>_OucomeCode" id="x<?php echo $_action_grid->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($_action_grid->OucomeCode->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_OucomeCode" name="o<?php echo $_action_grid->RowIndex ?>_OucomeCode" id="o<?php echo $_action_grid->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($_action_grid->OucomeCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_action" data-field="x_OucomeCode" name="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_OucomeCode" id="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($_action_grid->OucomeCode->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_OucomeCode" name="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_OucomeCode" id="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($_action_grid->OucomeCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_grid->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode" <?php echo $_action_grid->OutputCode->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($_action_grid->OutputCode->getSessionValue() != "") { ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_OutputCode" class="form-group">
<span<?php echo $_action_grid->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_grid->RowIndex ?>_OutputCode" name="x<?php echo $_action_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($_action_grid->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_OutputCode" class="form-group">
<?php
$onchange = $_action_grid->OutputCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_grid->OutputCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_action_grid->RowIndex ?>_OutputCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_action_grid->RowIndex ?>_OutputCode" id="sv_x<?php echo $_action_grid->RowIndex ?>_OutputCode" value="<?php echo RemoveHtml($_action_grid->OutputCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_action_grid->OutputCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_grid->OutputCode->getPlaceHolder()) ?>"<?php echo $_action_grid->OutputCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_grid->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_grid->RowIndex ?>_OutputCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_grid->OutputCode->ReadOnly || $_action_grid->OutputCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_grid->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_grid->RowIndex ?>_OutputCode" id="x<?php echo $_action_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($_action_grid->OutputCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actiongrid"], function() {
	f_actiongrid.createAutoSuggest({"id":"x<?php echo $_action_grid->RowIndex ?>_OutputCode","forceSelect":false});
});
</script>
<?php echo $_action_grid->OutputCode->Lookup->getParamTag($_action_grid, "p_x" . $_action_grid->RowIndex . "_OutputCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_OutputCode" name="o<?php echo $_action_grid->RowIndex ?>_OutputCode" id="o<?php echo $_action_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($_action_grid->OutputCode->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($_action_grid->OutputCode->getSessionValue() != "") { ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_OutputCode" class="form-group">
<span<?php echo $_action_grid->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_grid->RowIndex ?>_OutputCode" name="x<?php echo $_action_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($_action_grid->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_OutputCode" class="form-group">
<?php
$onchange = $_action_grid->OutputCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_grid->OutputCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_action_grid->RowIndex ?>_OutputCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_action_grid->RowIndex ?>_OutputCode" id="sv_x<?php echo $_action_grid->RowIndex ?>_OutputCode" value="<?php echo RemoveHtml($_action_grid->OutputCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_action_grid->OutputCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_grid->OutputCode->getPlaceHolder()) ?>"<?php echo $_action_grid->OutputCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_grid->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_grid->RowIndex ?>_OutputCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_grid->OutputCode->ReadOnly || $_action_grid->OutputCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_grid->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_grid->RowIndex ?>_OutputCode" id="x<?php echo $_action_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($_action_grid->OutputCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actiongrid"], function() {
	f_actiongrid.createAutoSuggest({"id":"x<?php echo $_action_grid->RowIndex ?>_OutputCode","forceSelect":false});
});
</script>
<?php echo $_action_grid->OutputCode->Lookup->getParamTag($_action_grid, "p_x" . $_action_grid->RowIndex . "_OutputCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_OutputCode">
<span<?php echo $_action_grid->OutputCode->viewAttributes() ?>><?php echo $_action_grid->OutputCode->getViewValue() ?></span>
</span>
<?php if (!$_action->isConfirm()) { ?>
<input type="hidden" data-table="_action" data-field="x_OutputCode" name="x<?php echo $_action_grid->RowIndex ?>_OutputCode" id="x<?php echo $_action_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($_action_grid->OutputCode->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_OutputCode" name="o<?php echo $_action_grid->RowIndex ?>_OutputCode" id="o<?php echo $_action_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($_action_grid->OutputCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_action" data-field="x_OutputCode" name="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_OutputCode" id="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($_action_grid->OutputCode->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_OutputCode" name="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_OutputCode" id="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($_action_grid->OutputCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_grid->ProjectCode->Visible) { // ProjectCode ?>
		<td data-name="ProjectCode" <?php echo $_action_grid->ProjectCode->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_ProjectCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $_action_grid->RowIndex ?>_ProjectCode"><?php echo EmptyValue(strval($_action_grid->ProjectCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $_action_grid->ProjectCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_grid->ProjectCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($_action_grid->ProjectCode->ReadOnly || $_action_grid->ProjectCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_grid->RowIndex ?>_ProjectCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $_action_grid->ProjectCode->Lookup->getParamTag($_action_grid, "p_x" . $_action_grid->RowIndex . "_ProjectCode") ?>
<input type="hidden" data-table="_action" data-field="x_ProjectCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_grid->ProjectCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_grid->RowIndex ?>_ProjectCode" id="x<?php echo $_action_grid->RowIndex ?>_ProjectCode" value="<?php echo $_action_grid->ProjectCode->CurrentValue ?>"<?php echo $_action_grid->ProjectCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="_action" data-field="x_ProjectCode" name="o<?php echo $_action_grid->RowIndex ?>_ProjectCode" id="o<?php echo $_action_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($_action_grid->ProjectCode->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_ProjectCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $_action_grid->RowIndex ?>_ProjectCode"><?php echo EmptyValue(strval($_action_grid->ProjectCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $_action_grid->ProjectCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_grid->ProjectCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($_action_grid->ProjectCode->ReadOnly || $_action_grid->ProjectCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_grid->RowIndex ?>_ProjectCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $_action_grid->ProjectCode->Lookup->getParamTag($_action_grid, "p_x" . $_action_grid->RowIndex . "_ProjectCode") ?>
<input type="hidden" data-table="_action" data-field="x_ProjectCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_grid->ProjectCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_grid->RowIndex ?>_ProjectCode" id="x<?php echo $_action_grid->RowIndex ?>_ProjectCode" value="<?php echo $_action_grid->ProjectCode->CurrentValue ?>"<?php echo $_action_grid->ProjectCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_ProjectCode">
<span<?php echo $_action_grid->ProjectCode->viewAttributes() ?>><?php echo $_action_grid->ProjectCode->getViewValue() ?></span>
</span>
<?php if (!$_action->isConfirm()) { ?>
<input type="hidden" data-table="_action" data-field="x_ProjectCode" name="x<?php echo $_action_grid->RowIndex ?>_ProjectCode" id="x<?php echo $_action_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($_action_grid->ProjectCode->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_ProjectCode" name="o<?php echo $_action_grid->RowIndex ?>_ProjectCode" id="o<?php echo $_action_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($_action_grid->ProjectCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_action" data-field="x_ProjectCode" name="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_ProjectCode" id="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($_action_grid->ProjectCode->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_ProjectCode" name="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_ProjectCode" id="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($_action_grid->ProjectCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_grid->ActionCode->Visible) { // ActionCode ?>
		<td data-name="ActionCode" <?php echo $_action_grid->ActionCode->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_ActionCode" class="form-group"></span>
<input type="hidden" data-table="_action" data-field="x_ActionCode" name="o<?php echo $_action_grid->RowIndex ?>_ActionCode" id="o<?php echo $_action_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($_action_grid->ActionCode->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_ActionCode" class="form-group">
<span<?php echo $_action_grid->ActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->ActionCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="_action" data-field="x_ActionCode" name="x<?php echo $_action_grid->RowIndex ?>_ActionCode" id="x<?php echo $_action_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($_action_grid->ActionCode->CurrentValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_ActionCode">
<span<?php echo $_action_grid->ActionCode->viewAttributes() ?>><?php echo $_action_grid->ActionCode->getViewValue() ?></span>
</span>
<?php if (!$_action->isConfirm()) { ?>
<input type="hidden" data-table="_action" data-field="x_ActionCode" name="x<?php echo $_action_grid->RowIndex ?>_ActionCode" id="x<?php echo $_action_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($_action_grid->ActionCode->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_ActionCode" name="o<?php echo $_action_grid->RowIndex ?>_ActionCode" id="o<?php echo $_action_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($_action_grid->ActionCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_action" data-field="x_ActionCode" name="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_ActionCode" id="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($_action_grid->ActionCode->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_ActionCode" name="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_ActionCode" id="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($_action_grid->ActionCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_grid->ActionName->Visible) { // ActionName ?>
		<td data-name="ActionName" <?php echo $_action_grid->ActionName->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_ActionName" class="form-group">
<input type="text" data-table="_action" data-field="x_ActionName" name="x<?php echo $_action_grid->RowIndex ?>_ActionName" id="x<?php echo $_action_grid->RowIndex ?>_ActionName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($_action_grid->ActionName->getPlaceHolder()) ?>" value="<?php echo $_action_grid->ActionName->EditValue ?>"<?php echo $_action_grid->ActionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="_action" data-field="x_ActionName" name="o<?php echo $_action_grid->RowIndex ?>_ActionName" id="o<?php echo $_action_grid->RowIndex ?>_ActionName" value="<?php echo HtmlEncode($_action_grid->ActionName->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_ActionName" class="form-group">
<input type="text" data-table="_action" data-field="x_ActionName" name="x<?php echo $_action_grid->RowIndex ?>_ActionName" id="x<?php echo $_action_grid->RowIndex ?>_ActionName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($_action_grid->ActionName->getPlaceHolder()) ?>" value="<?php echo $_action_grid->ActionName->EditValue ?>"<?php echo $_action_grid->ActionName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_ActionName">
<span<?php echo $_action_grid->ActionName->viewAttributes() ?>><?php echo $_action_grid->ActionName->getViewValue() ?></span>
</span>
<?php if (!$_action->isConfirm()) { ?>
<input type="hidden" data-table="_action" data-field="x_ActionName" name="x<?php echo $_action_grid->RowIndex ?>_ActionName" id="x<?php echo $_action_grid->RowIndex ?>_ActionName" value="<?php echo HtmlEncode($_action_grid->ActionName->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_ActionName" name="o<?php echo $_action_grid->RowIndex ?>_ActionName" id="o<?php echo $_action_grid->RowIndex ?>_ActionName" value="<?php echo HtmlEncode($_action_grid->ActionName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_action" data-field="x_ActionName" name="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_ActionName" id="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_ActionName" value="<?php echo HtmlEncode($_action_grid->ActionName->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_ActionName" name="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_ActionName" id="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_ActionName" value="<?php echo HtmlEncode($_action_grid->ActionName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_grid->ActionType->Visible) { // ActionType ?>
		<td data-name="ActionType" <?php echo $_action_grid->ActionType->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_ActionType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_ActionType" data-value-separator="<?php echo $_action_grid->ActionType->displayValueSeparatorAttribute() ?>" id="x<?php echo $_action_grid->RowIndex ?>_ActionType" name="x<?php echo $_action_grid->RowIndex ?>_ActionType"<?php echo $_action_grid->ActionType->editAttributes() ?>>
			<?php echo $_action_grid->ActionType->selectOptionListHtml("x{$_action_grid->RowIndex}_ActionType") ?>
		</select>
</div>
<?php echo $_action_grid->ActionType->Lookup->getParamTag($_action_grid, "p_x" . $_action_grid->RowIndex . "_ActionType") ?>
</span>
<input type="hidden" data-table="_action" data-field="x_ActionType" name="o<?php echo $_action_grid->RowIndex ?>_ActionType" id="o<?php echo $_action_grid->RowIndex ?>_ActionType" value="<?php echo HtmlEncode($_action_grid->ActionType->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_ActionType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_ActionType" data-value-separator="<?php echo $_action_grid->ActionType->displayValueSeparatorAttribute() ?>" id="x<?php echo $_action_grid->RowIndex ?>_ActionType" name="x<?php echo $_action_grid->RowIndex ?>_ActionType"<?php echo $_action_grid->ActionType->editAttributes() ?>>
			<?php echo $_action_grid->ActionType->selectOptionListHtml("x{$_action_grid->RowIndex}_ActionType") ?>
		</select>
</div>
<?php echo $_action_grid->ActionType->Lookup->getParamTag($_action_grid, "p_x" . $_action_grid->RowIndex . "_ActionType") ?>
</span>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_ActionType">
<span<?php echo $_action_grid->ActionType->viewAttributes() ?>><?php echo $_action_grid->ActionType->getViewValue() ?></span>
</span>
<?php if (!$_action->isConfirm()) { ?>
<input type="hidden" data-table="_action" data-field="x_ActionType" name="x<?php echo $_action_grid->RowIndex ?>_ActionType" id="x<?php echo $_action_grid->RowIndex ?>_ActionType" value="<?php echo HtmlEncode($_action_grid->ActionType->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_ActionType" name="o<?php echo $_action_grid->RowIndex ?>_ActionType" id="o<?php echo $_action_grid->RowIndex ?>_ActionType" value="<?php echo HtmlEncode($_action_grid->ActionType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_action" data-field="x_ActionType" name="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_ActionType" id="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_ActionType" value="<?php echo HtmlEncode($_action_grid->ActionType->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_ActionType" name="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_ActionType" id="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_ActionType" value="<?php echo HtmlEncode($_action_grid->ActionType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_grid->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear" <?php echo $_action_grid->FinancialYear->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($_action_grid->FinancialYear->getSessionValue() != "") { ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_FinancialYear" class="form-group">
<span<?php echo $_action_grid->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_grid->RowIndex ?>_FinancialYear" name="x<?php echo $_action_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($_action_grid->FinancialYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_FinancialYear" class="form-group">
<input type="text" data-table="_action" data-field="x_FinancialYear" name="x<?php echo $_action_grid->RowIndex ?>_FinancialYear" id="x<?php echo $_action_grid->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($_action_grid->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $_action_grid->FinancialYear->EditValue ?>"<?php echo $_action_grid->FinancialYear->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_FinancialYear" name="o<?php echo $_action_grid->RowIndex ?>_FinancialYear" id="o<?php echo $_action_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($_action_grid->FinancialYear->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($_action_grid->FinancialYear->getSessionValue() != "") { ?>

<span id="el<?php echo $_action_grid->RowCount ?>__action_FinancialYear" class="form-group">
<span<?php echo $_action_grid->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->FinancialYear->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $_action_grid->RowIndex ?>_FinancialYear" name="x<?php echo $_action_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($_action_grid->FinancialYear->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="_action" data-field="x_FinancialYear" name="x<?php echo $_action_grid->RowIndex ?>_FinancialYear" id="x<?php echo $_action_grid->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($_action_grid->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $_action_grid->FinancialYear->EditValue ?>"<?php echo $_action_grid->FinancialYear->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="_action" data-field="x_FinancialYear" name="o<?php echo $_action_grid->RowIndex ?>_FinancialYear" id="o<?php echo $_action_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($_action_grid->FinancialYear->OldValue != null ? $_action_grid->FinancialYear->OldValue : $_action_grid->FinancialYear->CurrentValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_FinancialYear">
<span<?php echo $_action_grid->FinancialYear->viewAttributes() ?>><?php echo $_action_grid->FinancialYear->getViewValue() ?></span>
</span>
<?php if (!$_action->isConfirm()) { ?>
<input type="hidden" data-table="_action" data-field="x_FinancialYear" name="x<?php echo $_action_grid->RowIndex ?>_FinancialYear" id="x<?php echo $_action_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($_action_grid->FinancialYear->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_FinancialYear" name="o<?php echo $_action_grid->RowIndex ?>_FinancialYear" id="o<?php echo $_action_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($_action_grid->FinancialYear->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_action" data-field="x_FinancialYear" name="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_FinancialYear" id="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($_action_grid->FinancialYear->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_FinancialYear" name="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_FinancialYear" id="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($_action_grid->FinancialYear->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_grid->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
		<td data-name="ExpectedAnnualAchievement" <?php echo $_action_grid->ExpectedAnnualAchievement->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_ExpectedAnnualAchievement" class="form-group">
<input type="text" data-table="_action" data-field="x_ExpectedAnnualAchievement" name="x<?php echo $_action_grid->RowIndex ?>_ExpectedAnnualAchievement" id="x<?php echo $_action_grid->RowIndex ?>_ExpectedAnnualAchievement" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($_action_grid->ExpectedAnnualAchievement->getPlaceHolder()) ?>" value="<?php echo $_action_grid->ExpectedAnnualAchievement->EditValue ?>"<?php echo $_action_grid->ExpectedAnnualAchievement->editAttributes() ?>>
</span>
<input type="hidden" data-table="_action" data-field="x_ExpectedAnnualAchievement" name="o<?php echo $_action_grid->RowIndex ?>_ExpectedAnnualAchievement" id="o<?php echo $_action_grid->RowIndex ?>_ExpectedAnnualAchievement" value="<?php echo HtmlEncode($_action_grid->ExpectedAnnualAchievement->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_ExpectedAnnualAchievement" class="form-group">
<input type="text" data-table="_action" data-field="x_ExpectedAnnualAchievement" name="x<?php echo $_action_grid->RowIndex ?>_ExpectedAnnualAchievement" id="x<?php echo $_action_grid->RowIndex ?>_ExpectedAnnualAchievement" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($_action_grid->ExpectedAnnualAchievement->getPlaceHolder()) ?>" value="<?php echo $_action_grid->ExpectedAnnualAchievement->EditValue ?>"<?php echo $_action_grid->ExpectedAnnualAchievement->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_ExpectedAnnualAchievement">
<span<?php echo $_action_grid->ExpectedAnnualAchievement->viewAttributes() ?>><?php echo $_action_grid->ExpectedAnnualAchievement->getViewValue() ?></span>
</span>
<?php if (!$_action->isConfirm()) { ?>
<input type="hidden" data-table="_action" data-field="x_ExpectedAnnualAchievement" name="x<?php echo $_action_grid->RowIndex ?>_ExpectedAnnualAchievement" id="x<?php echo $_action_grid->RowIndex ?>_ExpectedAnnualAchievement" value="<?php echo HtmlEncode($_action_grid->ExpectedAnnualAchievement->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_ExpectedAnnualAchievement" name="o<?php echo $_action_grid->RowIndex ?>_ExpectedAnnualAchievement" id="o<?php echo $_action_grid->RowIndex ?>_ExpectedAnnualAchievement" value="<?php echo HtmlEncode($_action_grid->ExpectedAnnualAchievement->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_action" data-field="x_ExpectedAnnualAchievement" name="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_ExpectedAnnualAchievement" id="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_ExpectedAnnualAchievement" value="<?php echo HtmlEncode($_action_grid->ExpectedAnnualAchievement->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_ExpectedAnnualAchievement" name="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_ExpectedAnnualAchievement" id="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_ExpectedAnnualAchievement" value="<?php echo HtmlEncode($_action_grid->ExpectedAnnualAchievement->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_grid->ActionLocation->Visible) { // ActionLocation ?>
		<td data-name="ActionLocation" <?php echo $_action_grid->ActionLocation->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_ActionLocation" class="form-group">
<input type="text" data-table="_action" data-field="x_ActionLocation" name="x<?php echo $_action_grid->RowIndex ?>_ActionLocation" id="x<?php echo $_action_grid->RowIndex ?>_ActionLocation" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_action_grid->ActionLocation->getPlaceHolder()) ?>" value="<?php echo $_action_grid->ActionLocation->EditValue ?>"<?php echo $_action_grid->ActionLocation->editAttributes() ?>>
</span>
<input type="hidden" data-table="_action" data-field="x_ActionLocation" name="o<?php echo $_action_grid->RowIndex ?>_ActionLocation" id="o<?php echo $_action_grid->RowIndex ?>_ActionLocation" value="<?php echo HtmlEncode($_action_grid->ActionLocation->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_ActionLocation" class="form-group">
<input type="text" data-table="_action" data-field="x_ActionLocation" name="x<?php echo $_action_grid->RowIndex ?>_ActionLocation" id="x<?php echo $_action_grid->RowIndex ?>_ActionLocation" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_action_grid->ActionLocation->getPlaceHolder()) ?>" value="<?php echo $_action_grid->ActionLocation->EditValue ?>"<?php echo $_action_grid->ActionLocation->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_ActionLocation">
<span<?php echo $_action_grid->ActionLocation->viewAttributes() ?>><?php echo $_action_grid->ActionLocation->getViewValue() ?></span>
</span>
<?php if (!$_action->isConfirm()) { ?>
<input type="hidden" data-table="_action" data-field="x_ActionLocation" name="x<?php echo $_action_grid->RowIndex ?>_ActionLocation" id="x<?php echo $_action_grid->RowIndex ?>_ActionLocation" value="<?php echo HtmlEncode($_action_grid->ActionLocation->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_ActionLocation" name="o<?php echo $_action_grid->RowIndex ?>_ActionLocation" id="o<?php echo $_action_grid->RowIndex ?>_ActionLocation" value="<?php echo HtmlEncode($_action_grid->ActionLocation->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_action" data-field="x_ActionLocation" name="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_ActionLocation" id="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_ActionLocation" value="<?php echo HtmlEncode($_action_grid->ActionLocation->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_ActionLocation" name="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_ActionLocation" id="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_ActionLocation" value="<?php echo HtmlEncode($_action_grid->ActionLocation->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_grid->Latitude->Visible) { // Latitude ?>
		<td data-name="Latitude" <?php echo $_action_grid->Latitude->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_Latitude" class="form-group">
<input type="text" data-table="_action" data-field="x_Latitude" name="x<?php echo $_action_grid->RowIndex ?>_Latitude" id="x<?php echo $_action_grid->RowIndex ?>_Latitude" size="30" placeholder="<?php echo HtmlEncode($_action_grid->Latitude->getPlaceHolder()) ?>" value="<?php echo $_action_grid->Latitude->EditValue ?>"<?php echo $_action_grid->Latitude->editAttributes() ?>>
</span>
<input type="hidden" data-table="_action" data-field="x_Latitude" name="o<?php echo $_action_grid->RowIndex ?>_Latitude" id="o<?php echo $_action_grid->RowIndex ?>_Latitude" value="<?php echo HtmlEncode($_action_grid->Latitude->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_Latitude" class="form-group">
<input type="text" data-table="_action" data-field="x_Latitude" name="x<?php echo $_action_grid->RowIndex ?>_Latitude" id="x<?php echo $_action_grid->RowIndex ?>_Latitude" size="30" placeholder="<?php echo HtmlEncode($_action_grid->Latitude->getPlaceHolder()) ?>" value="<?php echo $_action_grid->Latitude->EditValue ?>"<?php echo $_action_grid->Latitude->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_Latitude">
<span<?php echo $_action_grid->Latitude->viewAttributes() ?>><?php echo $_action_grid->Latitude->getViewValue() ?></span>
</span>
<?php if (!$_action->isConfirm()) { ?>
<input type="hidden" data-table="_action" data-field="x_Latitude" name="x<?php echo $_action_grid->RowIndex ?>_Latitude" id="x<?php echo $_action_grid->RowIndex ?>_Latitude" value="<?php echo HtmlEncode($_action_grid->Latitude->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_Latitude" name="o<?php echo $_action_grid->RowIndex ?>_Latitude" id="o<?php echo $_action_grid->RowIndex ?>_Latitude" value="<?php echo HtmlEncode($_action_grid->Latitude->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_action" data-field="x_Latitude" name="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_Latitude" id="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_Latitude" value="<?php echo HtmlEncode($_action_grid->Latitude->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_Latitude" name="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_Latitude" id="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_Latitude" value="<?php echo HtmlEncode($_action_grid->Latitude->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_grid->Longitude->Visible) { // Longitude ?>
		<td data-name="Longitude" <?php echo $_action_grid->Longitude->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_Longitude" class="form-group">
<input type="text" data-table="_action" data-field="x_Longitude" name="x<?php echo $_action_grid->RowIndex ?>_Longitude" id="x<?php echo $_action_grid->RowIndex ?>_Longitude" size="30" placeholder="<?php echo HtmlEncode($_action_grid->Longitude->getPlaceHolder()) ?>" value="<?php echo $_action_grid->Longitude->EditValue ?>"<?php echo $_action_grid->Longitude->editAttributes() ?>>
</span>
<input type="hidden" data-table="_action" data-field="x_Longitude" name="o<?php echo $_action_grid->RowIndex ?>_Longitude" id="o<?php echo $_action_grid->RowIndex ?>_Longitude" value="<?php echo HtmlEncode($_action_grid->Longitude->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_Longitude" class="form-group">
<input type="text" data-table="_action" data-field="x_Longitude" name="x<?php echo $_action_grid->RowIndex ?>_Longitude" id="x<?php echo $_action_grid->RowIndex ?>_Longitude" size="30" placeholder="<?php echo HtmlEncode($_action_grid->Longitude->getPlaceHolder()) ?>" value="<?php echo $_action_grid->Longitude->EditValue ?>"<?php echo $_action_grid->Longitude->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_Longitude">
<span<?php echo $_action_grid->Longitude->viewAttributes() ?>><?php echo $_action_grid->Longitude->getViewValue() ?></span>
</span>
<?php if (!$_action->isConfirm()) { ?>
<input type="hidden" data-table="_action" data-field="x_Longitude" name="x<?php echo $_action_grid->RowIndex ?>_Longitude" id="x<?php echo $_action_grid->RowIndex ?>_Longitude" value="<?php echo HtmlEncode($_action_grid->Longitude->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_Longitude" name="o<?php echo $_action_grid->RowIndex ?>_Longitude" id="o<?php echo $_action_grid->RowIndex ?>_Longitude" value="<?php echo HtmlEncode($_action_grid->Longitude->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_action" data-field="x_Longitude" name="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_Longitude" id="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_Longitude" value="<?php echo HtmlEncode($_action_grid->Longitude->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_Longitude" name="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_Longitude" id="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_Longitude" value="<?php echo HtmlEncode($_action_grid->Longitude->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $_action_grid->LACode->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($_action_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_LACode" class="form-group">
<span<?php echo $_action_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_grid->RowIndex ?>_LACode" name="x<?php echo $_action_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($_action_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_LACode" class="form-group">
<?php $_action_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $_action_grid->RowIndex ?>_LACode"><?php echo EmptyValue(strval($_action_grid->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $_action_grid->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($_action_grid->LACode->ReadOnly || $_action_grid->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_grid->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $_action_grid->LACode->Lookup->getParamTag($_action_grid, "p_x" . $_action_grid->RowIndex . "_LACode") ?>
<input type="hidden" data-table="_action" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_grid->RowIndex ?>_LACode" id="x<?php echo $_action_grid->RowIndex ?>_LACode" value="<?php echo $_action_grid->LACode->CurrentValue ?>"<?php echo $_action_grid->LACode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_LACode" name="o<?php echo $_action_grid->RowIndex ?>_LACode" id="o<?php echo $_action_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($_action_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($_action_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_LACode" class="form-group">
<span<?php echo $_action_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_grid->RowIndex ?>_LACode" name="x<?php echo $_action_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($_action_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_LACode" class="form-group">
<?php $_action_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $_action_grid->RowIndex ?>_LACode"><?php echo EmptyValue(strval($_action_grid->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $_action_grid->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($_action_grid->LACode->ReadOnly || $_action_grid->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_grid->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $_action_grid->LACode->Lookup->getParamTag($_action_grid, "p_x" . $_action_grid->RowIndex . "_LACode") ?>
<input type="hidden" data-table="_action" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_grid->RowIndex ?>_LACode" id="x<?php echo $_action_grid->RowIndex ?>_LACode" value="<?php echo $_action_grid->LACode->CurrentValue ?>"<?php echo $_action_grid->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_LACode">
<span<?php echo $_action_grid->LACode->viewAttributes() ?>><?php echo $_action_grid->LACode->getViewValue() ?></span>
</span>
<?php if (!$_action->isConfirm()) { ?>
<input type="hidden" data-table="_action" data-field="x_LACode" name="x<?php echo $_action_grid->RowIndex ?>_LACode" id="x<?php echo $_action_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($_action_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_LACode" name="o<?php echo $_action_grid->RowIndex ?>_LACode" id="o<?php echo $_action_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($_action_grid->LACode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_action" data-field="x_LACode" name="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_LACode" id="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($_action_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_LACode" name="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_LACode" id="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($_action_grid->LACode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $_action_grid->DepartmentCode->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($_action_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_DepartmentCode" class="form-group">
<span<?php echo $_action_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $_action_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($_action_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_DepartmentCode" class="form-group">
<?php $_action_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_DepartmentCode" data-value-separator="<?php echo $_action_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $_action_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $_action_grid->RowIndex ?>_DepartmentCode"<?php echo $_action_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $_action_grid->DepartmentCode->selectOptionListHtml("x{$_action_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $_action_grid->DepartmentCode->Lookup->getParamTag($_action_grid, "p_x" . $_action_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_DepartmentCode" name="o<?php echo $_action_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $_action_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($_action_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($_action_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_DepartmentCode" class="form-group">
<span<?php echo $_action_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $_action_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($_action_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_DepartmentCode" class="form-group">
<?php $_action_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_DepartmentCode" data-value-separator="<?php echo $_action_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $_action_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $_action_grid->RowIndex ?>_DepartmentCode"<?php echo $_action_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $_action_grid->DepartmentCode->selectOptionListHtml("x{$_action_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $_action_grid->DepartmentCode->Lookup->getParamTag($_action_grid, "p_x" . $_action_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_DepartmentCode">
<span<?php echo $_action_grid->DepartmentCode->viewAttributes() ?>><?php echo $_action_grid->DepartmentCode->getViewValue() ?></span>
</span>
<?php if (!$_action->isConfirm()) { ?>
<input type="hidden" data-table="_action" data-field="x_DepartmentCode" name="x<?php echo $_action_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $_action_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($_action_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_DepartmentCode" name="o<?php echo $_action_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $_action_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($_action_grid->DepartmentCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_action" data-field="x_DepartmentCode" name="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_DepartmentCode" id="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($_action_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_DepartmentCode" name="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_DepartmentCode" id="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($_action_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $_action_grid->SectionCode->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_SectionCode" data-value-separator="<?php echo $_action_grid->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $_action_grid->RowIndex ?>_SectionCode" name="x<?php echo $_action_grid->RowIndex ?>_SectionCode"<?php echo $_action_grid->SectionCode->editAttributes() ?>>
			<?php echo $_action_grid->SectionCode->selectOptionListHtml("x{$_action_grid->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $_action_grid->SectionCode->Lookup->getParamTag($_action_grid, "p_x" . $_action_grid->RowIndex . "_SectionCode") ?>
</span>
<input type="hidden" data-table="_action" data-field="x_SectionCode" name="o<?php echo $_action_grid->RowIndex ?>_SectionCode" id="o<?php echo $_action_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($_action_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_SectionCode" data-value-separator="<?php echo $_action_grid->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $_action_grid->RowIndex ?>_SectionCode" name="x<?php echo $_action_grid->RowIndex ?>_SectionCode"<?php echo $_action_grid->SectionCode->editAttributes() ?>>
			<?php echo $_action_grid->SectionCode->selectOptionListHtml("x{$_action_grid->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $_action_grid->SectionCode->Lookup->getParamTag($_action_grid, "p_x" . $_action_grid->RowIndex . "_SectionCode") ?>
</span>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_grid->RowCount ?>__action_SectionCode">
<span<?php echo $_action_grid->SectionCode->viewAttributes() ?>><?php echo $_action_grid->SectionCode->getViewValue() ?></span>
</span>
<?php if (!$_action->isConfirm()) { ?>
<input type="hidden" data-table="_action" data-field="x_SectionCode" name="x<?php echo $_action_grid->RowIndex ?>_SectionCode" id="x<?php echo $_action_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($_action_grid->SectionCode->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_SectionCode" name="o<?php echo $_action_grid->RowIndex ?>_SectionCode" id="o<?php echo $_action_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($_action_grid->SectionCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_action" data-field="x_SectionCode" name="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_SectionCode" id="f_actiongrid$x<?php echo $_action_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($_action_grid->SectionCode->FormValue) ?>">
<input type="hidden" data-table="_action" data-field="x_SectionCode" name="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_SectionCode" id="f_actiongrid$o<?php echo $_action_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($_action_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$_action_grid->ListOptions->render("body", "right", $_action_grid->RowCount);
?>
	</tr>
<?php if ($_action->RowType == ROWTYPE_ADD || $_action->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["f_actiongrid", "load"], function() {
	f_actiongrid.updateLists(<?php echo $_action_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$_action_grid->isGridAdd() || $_action->CurrentMode == "copy")
		if (!$_action_grid->Recordset->EOF)
			$_action_grid->Recordset->moveNext();
}
?>
<?php
	if ($_action->CurrentMode == "add" || $_action->CurrentMode == "copy" || $_action->CurrentMode == "edit") {
		$_action_grid->RowIndex = '$rowindex$';
		$_action_grid->loadRowValues();

		// Set row properties
		$_action->resetAttributes();
		$_action->RowAttrs->merge(["data-rowindex" => $_action_grid->RowIndex, "id" => "r0__action", "data-rowtype" => ROWTYPE_ADD]);
		$_action->RowAttrs->appendClass("ew-template");
		$_action->RowType = ROWTYPE_ADD;

		// Render row
		$_action_grid->renderRow();

		// Render list options
		$_action_grid->renderListOptions();
		$_action_grid->StartRowCount = 0;
?>
	<tr <?php echo $_action->rowAttributes() ?>>
<?php

// Render list options (body, left)
$_action_grid->ListOptions->render("body", "left", $_action_grid->RowIndex);
?>
	<?php if ($_action_grid->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode">
<?php if (!$_action->isConfirm()) { ?>
<?php if ($_action_grid->ProgramCode->getSessionValue() != "") { ?>
<span id="el$rowindex$__action_ProgramCode" class="form-group _action_ProgramCode">
<span<?php echo $_action_grid->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_grid->RowIndex ?>_ProgramCode" name="x<?php echo $_action_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($_action_grid->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$__action_ProgramCode" class="form-group _action_ProgramCode">
<?php
$onchange = $_action_grid->ProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_grid->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_action_grid->RowIndex ?>_ProgramCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_action_grid->RowIndex ?>_ProgramCode" id="sv_x<?php echo $_action_grid->RowIndex ?>_ProgramCode" value="<?php echo RemoveHtml($_action_grid->ProgramCode->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($_action_grid->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_grid->ProgramCode->getPlaceHolder()) ?>"<?php echo $_action_grid->ProgramCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_grid->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_grid->RowIndex ?>_ProgramCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_grid->ProgramCode->ReadOnly || $_action_grid->ProgramCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_grid->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_grid->RowIndex ?>_ProgramCode" id="x<?php echo $_action_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($_action_grid->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actiongrid"], function() {
	f_actiongrid.createAutoSuggest({"id":"x<?php echo $_action_grid->RowIndex ?>_ProgramCode","forceSelect":false});
});
</script>
<?php echo $_action_grid->ProgramCode->Lookup->getParamTag($_action_grid, "p_x" . $_action_grid->RowIndex . "_ProgramCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$__action_ProgramCode" class="form-group _action_ProgramCode">
<span<?php echo $_action_grid->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_action" data-field="x_ProgramCode" name="x<?php echo $_action_grid->RowIndex ?>_ProgramCode" id="x<?php echo $_action_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($_action_grid->ProgramCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_ProgramCode" name="o<?php echo $_action_grid->RowIndex ?>_ProgramCode" id="o<?php echo $_action_grid->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($_action_grid->ProgramCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_grid->OucomeCode->Visible) { // OucomeCode ?>
		<td data-name="OucomeCode">
<?php if (!$_action->isConfirm()) { ?>
<?php if ($_action_grid->OucomeCode->getSessionValue() != "") { ?>
<span id="el$rowindex$__action_OucomeCode" class="form-group _action_OucomeCode">
<span<?php echo $_action_grid->OucomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->OucomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_grid->RowIndex ?>_OucomeCode" name="x<?php echo $_action_grid->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($_action_grid->OucomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$__action_OucomeCode" class="form-group _action_OucomeCode">
<?php
$onchange = $_action_grid->OucomeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_grid->OucomeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_action_grid->RowIndex ?>_OucomeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_action_grid->RowIndex ?>_OucomeCode" id="sv_x<?php echo $_action_grid->RowIndex ?>_OucomeCode" value="<?php echo RemoveHtml($_action_grid->OucomeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_action_grid->OucomeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_grid->OucomeCode->getPlaceHolder()) ?>"<?php echo $_action_grid->OucomeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_grid->OucomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_grid->RowIndex ?>_OucomeCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_grid->OucomeCode->ReadOnly || $_action_grid->OucomeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_OucomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_grid->OucomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_grid->RowIndex ?>_OucomeCode" id="x<?php echo $_action_grid->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($_action_grid->OucomeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actiongrid"], function() {
	f_actiongrid.createAutoSuggest({"id":"x<?php echo $_action_grid->RowIndex ?>_OucomeCode","forceSelect":false});
});
</script>
<?php echo $_action_grid->OucomeCode->Lookup->getParamTag($_action_grid, "p_x" . $_action_grid->RowIndex . "_OucomeCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$__action_OucomeCode" class="form-group _action_OucomeCode">
<span<?php echo $_action_grid->OucomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->OucomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_action" data-field="x_OucomeCode" name="x<?php echo $_action_grid->RowIndex ?>_OucomeCode" id="x<?php echo $_action_grid->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($_action_grid->OucomeCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_OucomeCode" name="o<?php echo $_action_grid->RowIndex ?>_OucomeCode" id="o<?php echo $_action_grid->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($_action_grid->OucomeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_grid->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode">
<?php if (!$_action->isConfirm()) { ?>
<?php if ($_action_grid->OutputCode->getSessionValue() != "") { ?>
<span id="el$rowindex$__action_OutputCode" class="form-group _action_OutputCode">
<span<?php echo $_action_grid->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_grid->RowIndex ?>_OutputCode" name="x<?php echo $_action_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($_action_grid->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$__action_OutputCode" class="form-group _action_OutputCode">
<?php
$onchange = $_action_grid->OutputCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_grid->OutputCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_action_grid->RowIndex ?>_OutputCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_action_grid->RowIndex ?>_OutputCode" id="sv_x<?php echo $_action_grid->RowIndex ?>_OutputCode" value="<?php echo RemoveHtml($_action_grid->OutputCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_action_grid->OutputCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_grid->OutputCode->getPlaceHolder()) ?>"<?php echo $_action_grid->OutputCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_grid->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_grid->RowIndex ?>_OutputCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_grid->OutputCode->ReadOnly || $_action_grid->OutputCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_grid->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_grid->RowIndex ?>_OutputCode" id="x<?php echo $_action_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($_action_grid->OutputCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actiongrid"], function() {
	f_actiongrid.createAutoSuggest({"id":"x<?php echo $_action_grid->RowIndex ?>_OutputCode","forceSelect":false});
});
</script>
<?php echo $_action_grid->OutputCode->Lookup->getParamTag($_action_grid, "p_x" . $_action_grid->RowIndex . "_OutputCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$__action_OutputCode" class="form-group _action_OutputCode">
<span<?php echo $_action_grid->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_action" data-field="x_OutputCode" name="x<?php echo $_action_grid->RowIndex ?>_OutputCode" id="x<?php echo $_action_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($_action_grid->OutputCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_OutputCode" name="o<?php echo $_action_grid->RowIndex ?>_OutputCode" id="o<?php echo $_action_grid->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($_action_grid->OutputCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_grid->ProjectCode->Visible) { // ProjectCode ?>
		<td data-name="ProjectCode">
<?php if (!$_action->isConfirm()) { ?>
<span id="el$rowindex$__action_ProjectCode" class="form-group _action_ProjectCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $_action_grid->RowIndex ?>_ProjectCode"><?php echo EmptyValue(strval($_action_grid->ProjectCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $_action_grid->ProjectCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_grid->ProjectCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($_action_grid->ProjectCode->ReadOnly || $_action_grid->ProjectCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_grid->RowIndex ?>_ProjectCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $_action_grid->ProjectCode->Lookup->getParamTag($_action_grid, "p_x" . $_action_grid->RowIndex . "_ProjectCode") ?>
<input type="hidden" data-table="_action" data-field="x_ProjectCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_grid->ProjectCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_grid->RowIndex ?>_ProjectCode" id="x<?php echo $_action_grid->RowIndex ?>_ProjectCode" value="<?php echo $_action_grid->ProjectCode->CurrentValue ?>"<?php echo $_action_grid->ProjectCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$__action_ProjectCode" class="form-group _action_ProjectCode">
<span<?php echo $_action_grid->ProjectCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->ProjectCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_action" data-field="x_ProjectCode" name="x<?php echo $_action_grid->RowIndex ?>_ProjectCode" id="x<?php echo $_action_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($_action_grid->ProjectCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_ProjectCode" name="o<?php echo $_action_grid->RowIndex ?>_ProjectCode" id="o<?php echo $_action_grid->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($_action_grid->ProjectCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_grid->ActionCode->Visible) { // ActionCode ?>
		<td data-name="ActionCode">
<?php if (!$_action->isConfirm()) { ?>
<span id="el$rowindex$__action_ActionCode" class="form-group _action_ActionCode"></span>
<?php } else { ?>
<span id="el$rowindex$__action_ActionCode" class="form-group _action_ActionCode">
<span<?php echo $_action_grid->ActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->ActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_action" data-field="x_ActionCode" name="x<?php echo $_action_grid->RowIndex ?>_ActionCode" id="x<?php echo $_action_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($_action_grid->ActionCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_ActionCode" name="o<?php echo $_action_grid->RowIndex ?>_ActionCode" id="o<?php echo $_action_grid->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($_action_grid->ActionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_grid->ActionName->Visible) { // ActionName ?>
		<td data-name="ActionName">
<?php if (!$_action->isConfirm()) { ?>
<span id="el$rowindex$__action_ActionName" class="form-group _action_ActionName">
<input type="text" data-table="_action" data-field="x_ActionName" name="x<?php echo $_action_grid->RowIndex ?>_ActionName" id="x<?php echo $_action_grid->RowIndex ?>_ActionName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($_action_grid->ActionName->getPlaceHolder()) ?>" value="<?php echo $_action_grid->ActionName->EditValue ?>"<?php echo $_action_grid->ActionName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$__action_ActionName" class="form-group _action_ActionName">
<span<?php echo $_action_grid->ActionName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->ActionName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_action" data-field="x_ActionName" name="x<?php echo $_action_grid->RowIndex ?>_ActionName" id="x<?php echo $_action_grid->RowIndex ?>_ActionName" value="<?php echo HtmlEncode($_action_grid->ActionName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_ActionName" name="o<?php echo $_action_grid->RowIndex ?>_ActionName" id="o<?php echo $_action_grid->RowIndex ?>_ActionName" value="<?php echo HtmlEncode($_action_grid->ActionName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_grid->ActionType->Visible) { // ActionType ?>
		<td data-name="ActionType">
<?php if (!$_action->isConfirm()) { ?>
<span id="el$rowindex$__action_ActionType" class="form-group _action_ActionType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_ActionType" data-value-separator="<?php echo $_action_grid->ActionType->displayValueSeparatorAttribute() ?>" id="x<?php echo $_action_grid->RowIndex ?>_ActionType" name="x<?php echo $_action_grid->RowIndex ?>_ActionType"<?php echo $_action_grid->ActionType->editAttributes() ?>>
			<?php echo $_action_grid->ActionType->selectOptionListHtml("x{$_action_grid->RowIndex}_ActionType") ?>
		</select>
</div>
<?php echo $_action_grid->ActionType->Lookup->getParamTag($_action_grid, "p_x" . $_action_grid->RowIndex . "_ActionType") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$__action_ActionType" class="form-group _action_ActionType">
<span<?php echo $_action_grid->ActionType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->ActionType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_action" data-field="x_ActionType" name="x<?php echo $_action_grid->RowIndex ?>_ActionType" id="x<?php echo $_action_grid->RowIndex ?>_ActionType" value="<?php echo HtmlEncode($_action_grid->ActionType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_ActionType" name="o<?php echo $_action_grid->RowIndex ?>_ActionType" id="o<?php echo $_action_grid->RowIndex ?>_ActionType" value="<?php echo HtmlEncode($_action_grid->ActionType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_grid->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear">
<?php if (!$_action->isConfirm()) { ?>
<?php if ($_action_grid->FinancialYear->getSessionValue() != "") { ?>
<span id="el$rowindex$__action_FinancialYear" class="form-group _action_FinancialYear">
<span<?php echo $_action_grid->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_grid->RowIndex ?>_FinancialYear" name="x<?php echo $_action_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($_action_grid->FinancialYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$__action_FinancialYear" class="form-group _action_FinancialYear">
<input type="text" data-table="_action" data-field="x_FinancialYear" name="x<?php echo $_action_grid->RowIndex ?>_FinancialYear" id="x<?php echo $_action_grid->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($_action_grid->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $_action_grid->FinancialYear->EditValue ?>"<?php echo $_action_grid->FinancialYear->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$__action_FinancialYear" class="form-group _action_FinancialYear">
<span<?php echo $_action_grid->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_action" data-field="x_FinancialYear" name="x<?php echo $_action_grid->RowIndex ?>_FinancialYear" id="x<?php echo $_action_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($_action_grid->FinancialYear->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_FinancialYear" name="o<?php echo $_action_grid->RowIndex ?>_FinancialYear" id="o<?php echo $_action_grid->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($_action_grid->FinancialYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_grid->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
		<td data-name="ExpectedAnnualAchievement">
<?php if (!$_action->isConfirm()) { ?>
<span id="el$rowindex$__action_ExpectedAnnualAchievement" class="form-group _action_ExpectedAnnualAchievement">
<input type="text" data-table="_action" data-field="x_ExpectedAnnualAchievement" name="x<?php echo $_action_grid->RowIndex ?>_ExpectedAnnualAchievement" id="x<?php echo $_action_grid->RowIndex ?>_ExpectedAnnualAchievement" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($_action_grid->ExpectedAnnualAchievement->getPlaceHolder()) ?>" value="<?php echo $_action_grid->ExpectedAnnualAchievement->EditValue ?>"<?php echo $_action_grid->ExpectedAnnualAchievement->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$__action_ExpectedAnnualAchievement" class="form-group _action_ExpectedAnnualAchievement">
<span<?php echo $_action_grid->ExpectedAnnualAchievement->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->ExpectedAnnualAchievement->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_action" data-field="x_ExpectedAnnualAchievement" name="x<?php echo $_action_grid->RowIndex ?>_ExpectedAnnualAchievement" id="x<?php echo $_action_grid->RowIndex ?>_ExpectedAnnualAchievement" value="<?php echo HtmlEncode($_action_grid->ExpectedAnnualAchievement->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_ExpectedAnnualAchievement" name="o<?php echo $_action_grid->RowIndex ?>_ExpectedAnnualAchievement" id="o<?php echo $_action_grid->RowIndex ?>_ExpectedAnnualAchievement" value="<?php echo HtmlEncode($_action_grid->ExpectedAnnualAchievement->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_grid->ActionLocation->Visible) { // ActionLocation ?>
		<td data-name="ActionLocation">
<?php if (!$_action->isConfirm()) { ?>
<span id="el$rowindex$__action_ActionLocation" class="form-group _action_ActionLocation">
<input type="text" data-table="_action" data-field="x_ActionLocation" name="x<?php echo $_action_grid->RowIndex ?>_ActionLocation" id="x<?php echo $_action_grid->RowIndex ?>_ActionLocation" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_action_grid->ActionLocation->getPlaceHolder()) ?>" value="<?php echo $_action_grid->ActionLocation->EditValue ?>"<?php echo $_action_grid->ActionLocation->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$__action_ActionLocation" class="form-group _action_ActionLocation">
<span<?php echo $_action_grid->ActionLocation->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->ActionLocation->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_action" data-field="x_ActionLocation" name="x<?php echo $_action_grid->RowIndex ?>_ActionLocation" id="x<?php echo $_action_grid->RowIndex ?>_ActionLocation" value="<?php echo HtmlEncode($_action_grid->ActionLocation->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_ActionLocation" name="o<?php echo $_action_grid->RowIndex ?>_ActionLocation" id="o<?php echo $_action_grid->RowIndex ?>_ActionLocation" value="<?php echo HtmlEncode($_action_grid->ActionLocation->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_grid->Latitude->Visible) { // Latitude ?>
		<td data-name="Latitude">
<?php if (!$_action->isConfirm()) { ?>
<span id="el$rowindex$__action_Latitude" class="form-group _action_Latitude">
<input type="text" data-table="_action" data-field="x_Latitude" name="x<?php echo $_action_grid->RowIndex ?>_Latitude" id="x<?php echo $_action_grid->RowIndex ?>_Latitude" size="30" placeholder="<?php echo HtmlEncode($_action_grid->Latitude->getPlaceHolder()) ?>" value="<?php echo $_action_grid->Latitude->EditValue ?>"<?php echo $_action_grid->Latitude->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$__action_Latitude" class="form-group _action_Latitude">
<span<?php echo $_action_grid->Latitude->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->Latitude->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_action" data-field="x_Latitude" name="x<?php echo $_action_grid->RowIndex ?>_Latitude" id="x<?php echo $_action_grid->RowIndex ?>_Latitude" value="<?php echo HtmlEncode($_action_grid->Latitude->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_Latitude" name="o<?php echo $_action_grid->RowIndex ?>_Latitude" id="o<?php echo $_action_grid->RowIndex ?>_Latitude" value="<?php echo HtmlEncode($_action_grid->Latitude->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_grid->Longitude->Visible) { // Longitude ?>
		<td data-name="Longitude">
<?php if (!$_action->isConfirm()) { ?>
<span id="el$rowindex$__action_Longitude" class="form-group _action_Longitude">
<input type="text" data-table="_action" data-field="x_Longitude" name="x<?php echo $_action_grid->RowIndex ?>_Longitude" id="x<?php echo $_action_grid->RowIndex ?>_Longitude" size="30" placeholder="<?php echo HtmlEncode($_action_grid->Longitude->getPlaceHolder()) ?>" value="<?php echo $_action_grid->Longitude->EditValue ?>"<?php echo $_action_grid->Longitude->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$__action_Longitude" class="form-group _action_Longitude">
<span<?php echo $_action_grid->Longitude->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->Longitude->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_action" data-field="x_Longitude" name="x<?php echo $_action_grid->RowIndex ?>_Longitude" id="x<?php echo $_action_grid->RowIndex ?>_Longitude" value="<?php echo HtmlEncode($_action_grid->Longitude->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_Longitude" name="o<?php echo $_action_grid->RowIndex ?>_Longitude" id="o<?php echo $_action_grid->RowIndex ?>_Longitude" value="<?php echo HtmlEncode($_action_grid->Longitude->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if (!$_action->isConfirm()) { ?>
<?php if ($_action_grid->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$__action_LACode" class="form-group _action_LACode">
<span<?php echo $_action_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_grid->RowIndex ?>_LACode" name="x<?php echo $_action_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($_action_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$__action_LACode" class="form-group _action_LACode">
<?php $_action_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $_action_grid->RowIndex ?>_LACode"><?php echo EmptyValue(strval($_action_grid->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $_action_grid->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_grid->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($_action_grid->LACode->ReadOnly || $_action_grid->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_grid->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $_action_grid->LACode->Lookup->getParamTag($_action_grid, "p_x" . $_action_grid->RowIndex . "_LACode") ?>
<input type="hidden" data-table="_action" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_grid->RowIndex ?>_LACode" id="x<?php echo $_action_grid->RowIndex ?>_LACode" value="<?php echo $_action_grid->LACode->CurrentValue ?>"<?php echo $_action_grid->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$__action_LACode" class="form-group _action_LACode">
<span<?php echo $_action_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_action" data-field="x_LACode" name="x<?php echo $_action_grid->RowIndex ?>_LACode" id="x<?php echo $_action_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($_action_grid->LACode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_LACode" name="o<?php echo $_action_grid->RowIndex ?>_LACode" id="o<?php echo $_action_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($_action_grid->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<?php if (!$_action->isConfirm()) { ?>
<?php if ($_action_grid->DepartmentCode->getSessionValue() != "") { ?>
<span id="el$rowindex$__action_DepartmentCode" class="form-group _action_DepartmentCode">
<span<?php echo $_action_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $_action_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($_action_grid->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$__action_DepartmentCode" class="form-group _action_DepartmentCode">
<?php $_action_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_DepartmentCode" data-value-separator="<?php echo $_action_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $_action_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $_action_grid->RowIndex ?>_DepartmentCode"<?php echo $_action_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $_action_grid->DepartmentCode->selectOptionListHtml("x{$_action_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $_action_grid->DepartmentCode->Lookup->getParamTag($_action_grid, "p_x" . $_action_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$__action_DepartmentCode" class="form-group _action_DepartmentCode">
<span<?php echo $_action_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_action" data-field="x_DepartmentCode" name="x<?php echo $_action_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $_action_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($_action_grid->DepartmentCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_DepartmentCode" name="o<?php echo $_action_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $_action_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($_action_grid->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode">
<?php if (!$_action->isConfirm()) { ?>
<span id="el$rowindex$__action_SectionCode" class="form-group _action_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_SectionCode" data-value-separator="<?php echo $_action_grid->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $_action_grid->RowIndex ?>_SectionCode" name="x<?php echo $_action_grid->RowIndex ?>_SectionCode"<?php echo $_action_grid->SectionCode->editAttributes() ?>>
			<?php echo $_action_grid->SectionCode->selectOptionListHtml("x{$_action_grid->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $_action_grid->SectionCode->Lookup->getParamTag($_action_grid, "p_x" . $_action_grid->RowIndex . "_SectionCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$__action_SectionCode" class="form-group _action_SectionCode">
<span<?php echo $_action_grid->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_grid->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_action" data-field="x_SectionCode" name="x<?php echo $_action_grid->RowIndex ?>_SectionCode" id="x<?php echo $_action_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($_action_grid->SectionCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_SectionCode" name="o<?php echo $_action_grid->RowIndex ?>_SectionCode" id="o<?php echo $_action_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($_action_grid->SectionCode->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$_action_grid->ListOptions->render("body", "right", $_action_grid->RowIndex);
?>
<script>
loadjs.ready(["f_actiongrid", "load"], function() {
	f_actiongrid.updateLists(<?php echo $_action_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($_action->CurrentMode == "add" || $_action->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $_action_grid->FormKeyCountName ?>" id="<?php echo $_action_grid->FormKeyCountName ?>" value="<?php echo $_action_grid->KeyCount ?>">
<?php echo $_action_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($_action->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $_action_grid->FormKeyCountName ?>" id="<?php echo $_action_grid->FormKeyCountName ?>" value="<?php echo $_action_grid->KeyCount ?>">
<?php echo $_action_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($_action->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="f_actiongrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($_action_grid->Recordset)
	$_action_grid->Recordset->Close();
?>
<?php if ($_action_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $_action_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($_action_grid->TotalRecords == 0 && !$_action->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $_action_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$_action_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$_action_grid->terminate();
?>