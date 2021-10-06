<?php
namespace PHPMaker2020\lgmis20;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$training_record_list = new training_record_list();

// Run the page
$training_record_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$training_record_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$training_record_list->isExport()) { ?>
<script>
var ftraining_recordlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftraining_recordlist = currentForm = new ew.Form("ftraining_recordlist", "list");
	ftraining_recordlist.formKeyCountName = '<?php echo $training_record_list->FormKeyCountName ?>';

	// Validate form
	ftraining_recordlist.validate = function() {
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
			<?php if ($training_record_list->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_list->EmployeeID->caption(), $training_record_list->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($training_record_list->EmployeeID->errorMessage()) ?>");
			<?php if ($training_record_list->FieldOfTraining->Required) { ?>
				elm = this.getElements("x" + infix + "_FieldOfTraining");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_list->FieldOfTraining->caption(), $training_record_list->FieldOfTraining->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($training_record_list->TrainingType->Required) { ?>
				elm = this.getElements("x" + infix + "_TrainingType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_list->TrainingType->caption(), $training_record_list->TrainingType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TrainingType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($training_record_list->TrainingType->errorMessage()) ?>");
			<?php if ($training_record_list->PlannedStartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedStartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_list->PlannedStartDate->caption(), $training_record_list->PlannedStartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedStartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($training_record_list->PlannedStartDate->errorMessage()) ?>");
			<?php if ($training_record_list->PlannedEndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedEndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_list->PlannedEndDate->caption(), $training_record_list->PlannedEndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedEndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($training_record_list->PlannedEndDate->errorMessage()) ?>");
			<?php if ($training_record_list->ActualStartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualStartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_list->ActualStartDate->caption(), $training_record_list->ActualStartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualStartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($training_record_list->ActualStartDate->errorMessage()) ?>");
			<?php if ($training_record_list->ActualEnddate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualEnddate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_list->ActualEnddate->caption(), $training_record_list->ActualEnddate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualEnddate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($training_record_list->ActualEnddate->errorMessage()) ?>");
			<?php if ($training_record_list->QualificationLevelObtained->Required) { ?>
				elm = this.getElements("x" + infix + "_QualificationLevelObtained");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_list->QualificationLevelObtained->caption(), $training_record_list->QualificationLevelObtained->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($training_record_list->AwardingInstitution->Required) { ?>
				elm = this.getElements("x" + infix + "_AwardingInstitution");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_list->AwardingInstitution->caption(), $training_record_list->AwardingInstitution->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($training_record_list->FundingSource->Required) { ?>
				elm = this.getElements("x" + infix + "_FundingSource");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_list->FundingSource->caption(), $training_record_list->FundingSource->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($training_record_list->TrainingCost->Required) { ?>
				elm = this.getElements("x" + infix + "_TrainingCost");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_list->TrainingCost->caption(), $training_record_list->TrainingCost->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TrainingCost");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($training_record_list->TrainingCost->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		if (gridinsert && addcnt == 0) { // No row added
			ew.alert(ew.language.phrase("NoAddRecord"));
			return false;
		}
		return true;
	}

	// Check empty row
	ftraining_recordlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "EmployeeID", false)) return false;
		if (ew.valueChanged(fobj, infix, "FieldOfTraining", false)) return false;
		if (ew.valueChanged(fobj, infix, "TrainingType", false)) return false;
		if (ew.valueChanged(fobj, infix, "PlannedStartDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "PlannedEndDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActualStartDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActualEnddate", false)) return false;
		if (ew.valueChanged(fobj, infix, "QualificationLevelObtained", false)) return false;
		if (ew.valueChanged(fobj, infix, "AwardingInstitution", false)) return false;
		if (ew.valueChanged(fobj, infix, "FundingSource", false)) return false;
		if (ew.valueChanged(fobj, infix, "TrainingCost", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ftraining_recordlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftraining_recordlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftraining_recordlist.lists["x_FieldOfTraining"] = <?php echo $training_record_list->FieldOfTraining->Lookup->toClientList($training_record_list) ?>;
	ftraining_recordlist.lists["x_FieldOfTraining"].options = <?php echo JsonEncode($training_record_list->FieldOfTraining->lookupOptions()) ?>;
	ftraining_recordlist.lists["x_QualificationLevelObtained"] = <?php echo $training_record_list->QualificationLevelObtained->Lookup->toClientList($training_record_list) ?>;
	ftraining_recordlist.lists["x_QualificationLevelObtained"].options = <?php echo JsonEncode($training_record_list->QualificationLevelObtained->lookupOptions()) ?>;
	ftraining_recordlist.lists["x_FundingSource"] = <?php echo $training_record_list->FundingSource->Lookup->toClientList($training_record_list) ?>;
	ftraining_recordlist.lists["x_FundingSource"].options = <?php echo JsonEncode($training_record_list->FundingSource->lookupOptions()) ?>;
	loadjs.done("ftraining_recordlist");
});
var ftraining_recordlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftraining_recordlistsrch = currentSearchForm = new ew.Form("ftraining_recordlistsrch");

	// Dynamic selection lists
	// Filters

	ftraining_recordlistsrch.filterList = <?php echo $training_record_list->getFilterList() ?>;

	// Init search panel as collapsed
	ftraining_recordlistsrch.initSearchPanel = true;
	loadjs.done("ftraining_recordlistsrch");
});
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
	display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
	<div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade active show"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script>
loadjs.ready("head", function() {
	ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "left" : "right";
	ew.PREVIEW_SINGLE_ROW = false;
	ew.PREVIEW_OVERLAY = false;
	loadjs("js/ewpreview.js", "preview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$training_record_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($training_record_list->TotalRecords > 0 && $training_record_list->ExportOptions->visible()) { ?>
<?php $training_record_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($training_record_list->ImportOptions->visible()) { ?>
<?php $training_record_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($training_record_list->SearchOptions->visible()) { ?>
<?php $training_record_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($training_record_list->FilterOptions->visible()) { ?>
<?php $training_record_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$training_record_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$training_record_list->isExport() && !$training_record->CurrentAction) { ?>
<form name="ftraining_recordlistsrch" id="ftraining_recordlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftraining_recordlistsrch-search-panel" class="<?php echo $training_record_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="training_record">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $training_record_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($training_record_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($training_record_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $training_record_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($training_record_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($training_record_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($training_record_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($training_record_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $training_record_list->showPageHeader(); ?>
<?php
$training_record_list->showMessage();
?>
<?php if ($training_record_list->TotalRecords > 0 || $training_record->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($training_record_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> training_record">
<?php if (!$training_record_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$training_record_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $training_record_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $training_record_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftraining_recordlist" id="ftraining_recordlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="training_record">
<div id="gmp_training_record" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($training_record_list->TotalRecords > 0 || $training_record_list->isGridEdit()) { ?>
<table id="tbl_training_recordlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$training_record->RowType = ROWTYPE_HEADER;

// Render list options
$training_record_list->renderListOptions();

// Render list options (header, left)
$training_record_list->ListOptions->render("header", "left");
?>
<?php if ($training_record_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($training_record_list->SortUrl($training_record_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $training_record_list->EmployeeID->headerCellClass() ?>"><div id="elh_training_record_EmployeeID" class="training_record_EmployeeID"><div class="ew-table-header-caption"><?php echo $training_record_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $training_record_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $training_record_list->SortUrl($training_record_list->EmployeeID) ?>', 1);"><div id="elh_training_record_EmployeeID" class="training_record_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $training_record_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($training_record_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($training_record_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($training_record_list->FieldOfTraining->Visible) { // FieldOfTraining ?>
	<?php if ($training_record_list->SortUrl($training_record_list->FieldOfTraining) == "") { ?>
		<th data-name="FieldOfTraining" class="<?php echo $training_record_list->FieldOfTraining->headerCellClass() ?>"><div id="elh_training_record_FieldOfTraining" class="training_record_FieldOfTraining"><div class="ew-table-header-caption"><?php echo $training_record_list->FieldOfTraining->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FieldOfTraining" class="<?php echo $training_record_list->FieldOfTraining->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $training_record_list->SortUrl($training_record_list->FieldOfTraining) ?>', 1);"><div id="elh_training_record_FieldOfTraining" class="training_record_FieldOfTraining">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $training_record_list->FieldOfTraining->caption() ?></span><span class="ew-table-header-sort"><?php if ($training_record_list->FieldOfTraining->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($training_record_list->FieldOfTraining->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($training_record_list->TrainingType->Visible) { // TrainingType ?>
	<?php if ($training_record_list->SortUrl($training_record_list->TrainingType) == "") { ?>
		<th data-name="TrainingType" class="<?php echo $training_record_list->TrainingType->headerCellClass() ?>"><div id="elh_training_record_TrainingType" class="training_record_TrainingType"><div class="ew-table-header-caption"><?php echo $training_record_list->TrainingType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TrainingType" class="<?php echo $training_record_list->TrainingType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $training_record_list->SortUrl($training_record_list->TrainingType) ?>', 1);"><div id="elh_training_record_TrainingType" class="training_record_TrainingType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $training_record_list->TrainingType->caption() ?></span><span class="ew-table-header-sort"><?php if ($training_record_list->TrainingType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($training_record_list->TrainingType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($training_record_list->PlannedStartDate->Visible) { // PlannedStartDate ?>
	<?php if ($training_record_list->SortUrl($training_record_list->PlannedStartDate) == "") { ?>
		<th data-name="PlannedStartDate" class="<?php echo $training_record_list->PlannedStartDate->headerCellClass() ?>"><div id="elh_training_record_PlannedStartDate" class="training_record_PlannedStartDate"><div class="ew-table-header-caption"><?php echo $training_record_list->PlannedStartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PlannedStartDate" class="<?php echo $training_record_list->PlannedStartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $training_record_list->SortUrl($training_record_list->PlannedStartDate) ?>', 1);"><div id="elh_training_record_PlannedStartDate" class="training_record_PlannedStartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $training_record_list->PlannedStartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($training_record_list->PlannedStartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($training_record_list->PlannedStartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($training_record_list->PlannedEndDate->Visible) { // PlannedEndDate ?>
	<?php if ($training_record_list->SortUrl($training_record_list->PlannedEndDate) == "") { ?>
		<th data-name="PlannedEndDate" class="<?php echo $training_record_list->PlannedEndDate->headerCellClass() ?>"><div id="elh_training_record_PlannedEndDate" class="training_record_PlannedEndDate"><div class="ew-table-header-caption"><?php echo $training_record_list->PlannedEndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PlannedEndDate" class="<?php echo $training_record_list->PlannedEndDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $training_record_list->SortUrl($training_record_list->PlannedEndDate) ?>', 1);"><div id="elh_training_record_PlannedEndDate" class="training_record_PlannedEndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $training_record_list->PlannedEndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($training_record_list->PlannedEndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($training_record_list->PlannedEndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($training_record_list->ActualStartDate->Visible) { // ActualStartDate ?>
	<?php if ($training_record_list->SortUrl($training_record_list->ActualStartDate) == "") { ?>
		<th data-name="ActualStartDate" class="<?php echo $training_record_list->ActualStartDate->headerCellClass() ?>"><div id="elh_training_record_ActualStartDate" class="training_record_ActualStartDate"><div class="ew-table-header-caption"><?php echo $training_record_list->ActualStartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActualStartDate" class="<?php echo $training_record_list->ActualStartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $training_record_list->SortUrl($training_record_list->ActualStartDate) ?>', 1);"><div id="elh_training_record_ActualStartDate" class="training_record_ActualStartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $training_record_list->ActualStartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($training_record_list->ActualStartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($training_record_list->ActualStartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($training_record_list->ActualEnddate->Visible) { // ActualEnddate ?>
	<?php if ($training_record_list->SortUrl($training_record_list->ActualEnddate) == "") { ?>
		<th data-name="ActualEnddate" class="<?php echo $training_record_list->ActualEnddate->headerCellClass() ?>"><div id="elh_training_record_ActualEnddate" class="training_record_ActualEnddate"><div class="ew-table-header-caption"><?php echo $training_record_list->ActualEnddate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActualEnddate" class="<?php echo $training_record_list->ActualEnddate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $training_record_list->SortUrl($training_record_list->ActualEnddate) ?>', 1);"><div id="elh_training_record_ActualEnddate" class="training_record_ActualEnddate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $training_record_list->ActualEnddate->caption() ?></span><span class="ew-table-header-sort"><?php if ($training_record_list->ActualEnddate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($training_record_list->ActualEnddate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($training_record_list->QualificationLevelObtained->Visible) { // QualificationLevelObtained ?>
	<?php if ($training_record_list->SortUrl($training_record_list->QualificationLevelObtained) == "") { ?>
		<th data-name="QualificationLevelObtained" class="<?php echo $training_record_list->QualificationLevelObtained->headerCellClass() ?>"><div id="elh_training_record_QualificationLevelObtained" class="training_record_QualificationLevelObtained"><div class="ew-table-header-caption"><?php echo $training_record_list->QualificationLevelObtained->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="QualificationLevelObtained" class="<?php echo $training_record_list->QualificationLevelObtained->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $training_record_list->SortUrl($training_record_list->QualificationLevelObtained) ?>', 1);"><div id="elh_training_record_QualificationLevelObtained" class="training_record_QualificationLevelObtained">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $training_record_list->QualificationLevelObtained->caption() ?></span><span class="ew-table-header-sort"><?php if ($training_record_list->QualificationLevelObtained->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($training_record_list->QualificationLevelObtained->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($training_record_list->AwardingInstitution->Visible) { // AwardingInstitution ?>
	<?php if ($training_record_list->SortUrl($training_record_list->AwardingInstitution) == "") { ?>
		<th data-name="AwardingInstitution" class="<?php echo $training_record_list->AwardingInstitution->headerCellClass() ?>"><div id="elh_training_record_AwardingInstitution" class="training_record_AwardingInstitution"><div class="ew-table-header-caption"><?php echo $training_record_list->AwardingInstitution->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AwardingInstitution" class="<?php echo $training_record_list->AwardingInstitution->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $training_record_list->SortUrl($training_record_list->AwardingInstitution) ?>', 1);"><div id="elh_training_record_AwardingInstitution" class="training_record_AwardingInstitution">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $training_record_list->AwardingInstitution->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($training_record_list->AwardingInstitution->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($training_record_list->AwardingInstitution->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($training_record_list->FundingSource->Visible) { // FundingSource ?>
	<?php if ($training_record_list->SortUrl($training_record_list->FundingSource) == "") { ?>
		<th data-name="FundingSource" class="<?php echo $training_record_list->FundingSource->headerCellClass() ?>"><div id="elh_training_record_FundingSource" class="training_record_FundingSource"><div class="ew-table-header-caption"><?php echo $training_record_list->FundingSource->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FundingSource" class="<?php echo $training_record_list->FundingSource->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $training_record_list->SortUrl($training_record_list->FundingSource) ?>', 1);"><div id="elh_training_record_FundingSource" class="training_record_FundingSource">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $training_record_list->FundingSource->caption() ?></span><span class="ew-table-header-sort"><?php if ($training_record_list->FundingSource->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($training_record_list->FundingSource->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($training_record_list->TrainingCost->Visible) { // TrainingCost ?>
	<?php if ($training_record_list->SortUrl($training_record_list->TrainingCost) == "") { ?>
		<th data-name="TrainingCost" class="<?php echo $training_record_list->TrainingCost->headerCellClass() ?>"><div id="elh_training_record_TrainingCost" class="training_record_TrainingCost"><div class="ew-table-header-caption"><?php echo $training_record_list->TrainingCost->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TrainingCost" class="<?php echo $training_record_list->TrainingCost->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $training_record_list->SortUrl($training_record_list->TrainingCost) ?>', 1);"><div id="elh_training_record_TrainingCost" class="training_record_TrainingCost">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $training_record_list->TrainingCost->caption() ?></span><span class="ew-table-header-sort"><?php if ($training_record_list->TrainingCost->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($training_record_list->TrainingCost->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$training_record_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($training_record_list->ExportAll && $training_record_list->isExport()) {
	$training_record_list->StopRecord = $training_record_list->TotalRecords;
} else {

	// Set the last record to display
	if ($training_record_list->TotalRecords > $training_record_list->StartRecord + $training_record_list->DisplayRecords - 1)
		$training_record_list->StopRecord = $training_record_list->StartRecord + $training_record_list->DisplayRecords - 1;
	else
		$training_record_list->StopRecord = $training_record_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($training_record->isConfirm() || $training_record_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($training_record_list->FormKeyCountName) && ($training_record_list->isGridAdd() || $training_record_list->isGridEdit() || $training_record->isConfirm())) {
		$training_record_list->KeyCount = $CurrentForm->getValue($training_record_list->FormKeyCountName);
		$training_record_list->StopRecord = $training_record_list->StartRecord + $training_record_list->KeyCount - 1;
	}
}
$training_record_list->RecordCount = $training_record_list->StartRecord - 1;
if ($training_record_list->Recordset && !$training_record_list->Recordset->EOF) {
	$training_record_list->Recordset->moveFirst();
	$selectLimit = $training_record_list->UseSelectLimit;
	if (!$selectLimit && $training_record_list->StartRecord > 1)
		$training_record_list->Recordset->move($training_record_list->StartRecord - 1);
} elseif (!$training_record->AllowAddDeleteRow && $training_record_list->StopRecord == 0) {
	$training_record_list->StopRecord = $training_record->GridAddRowCount;
}

// Initialize aggregate
$training_record->RowType = ROWTYPE_AGGREGATEINIT;
$training_record->resetAttributes();
$training_record_list->renderRow();
if ($training_record_list->isGridAdd())
	$training_record_list->RowIndex = 0;
if ($training_record_list->isGridEdit())
	$training_record_list->RowIndex = 0;
while ($training_record_list->RecordCount < $training_record_list->StopRecord) {
	$training_record_list->RecordCount++;
	if ($training_record_list->RecordCount >= $training_record_list->StartRecord) {
		$training_record_list->RowCount++;
		if ($training_record_list->isGridAdd() || $training_record_list->isGridEdit() || $training_record->isConfirm()) {
			$training_record_list->RowIndex++;
			$CurrentForm->Index = $training_record_list->RowIndex;
			if ($CurrentForm->hasValue($training_record_list->FormActionName) && ($training_record->isConfirm() || $training_record_list->EventCancelled))
				$training_record_list->RowAction = strval($CurrentForm->getValue($training_record_list->FormActionName));
			elseif ($training_record_list->isGridAdd())
				$training_record_list->RowAction = "insert";
			else
				$training_record_list->RowAction = "";
		}

		// Set up key count
		$training_record_list->KeyCount = $training_record_list->RowIndex;

		// Init row class and style
		$training_record->resetAttributes();
		$training_record->CssClass = "";
		if ($training_record_list->isGridAdd()) {
			$training_record_list->loadRowValues(); // Load default values
		} else {
			$training_record_list->loadRowValues($training_record_list->Recordset); // Load row values
		}
		$training_record->RowType = ROWTYPE_VIEW; // Render view
		if ($training_record_list->isGridAdd()) // Grid add
			$training_record->RowType = ROWTYPE_ADD; // Render add
		if ($training_record_list->isGridAdd() && $training_record->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$training_record_list->restoreCurrentRowFormValues($training_record_list->RowIndex); // Restore form values
		if ($training_record_list->isGridEdit()) { // Grid edit
			if ($training_record->EventCancelled)
				$training_record_list->restoreCurrentRowFormValues($training_record_list->RowIndex); // Restore form values
			if ($training_record_list->RowAction == "insert")
				$training_record->RowType = ROWTYPE_ADD; // Render add
			else
				$training_record->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($training_record_list->isGridEdit() && ($training_record->RowType == ROWTYPE_EDIT || $training_record->RowType == ROWTYPE_ADD) && $training_record->EventCancelled) // Update failed
			$training_record_list->restoreCurrentRowFormValues($training_record_list->RowIndex); // Restore form values
		if ($training_record->RowType == ROWTYPE_EDIT) // Edit row
			$training_record_list->EditRowCount++;

		// Set up row id / data-rowindex
		$training_record->RowAttrs->merge(["data-rowindex" => $training_record_list->RowCount, "id" => "r" . $training_record_list->RowCount . "_training_record", "data-rowtype" => $training_record->RowType]);

		// Render row
		$training_record_list->renderRow();

		// Render list options
		$training_record_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($training_record_list->RowAction != "delete" && $training_record_list->RowAction != "insertdelete" && !($training_record_list->RowAction == "insert" && $training_record->isConfirm() && $training_record_list->emptyRow())) {
?>
	<tr <?php echo $training_record->rowAttributes() ?>>
<?php

// Render list options (body, left)
$training_record_list->ListOptions->render("body", "left", $training_record_list->RowCount);
?>
	<?php if ($training_record_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $training_record_list->EmployeeID->cellAttributes() ?>>
<?php if ($training_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_EmployeeID" class="form-group">
<input type="text" data-table="training_record" data-field="x_EmployeeID" name="x<?php echo $training_record_list->RowIndex ?>_EmployeeID" id="x<?php echo $training_record_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($training_record_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $training_record_list->EmployeeID->EditValue ?>"<?php echo $training_record_list->EmployeeID->editAttributes() ?>>
</span>
<input type="hidden" data-table="training_record" data-field="x_EmployeeID" name="o<?php echo $training_record_list->RowIndex ?>_EmployeeID" id="o<?php echo $training_record_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($training_record_list->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($training_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="training_record" data-field="x_EmployeeID" name="x<?php echo $training_record_list->RowIndex ?>_EmployeeID" id="x<?php echo $training_record_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($training_record_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $training_record_list->EmployeeID->EditValue ?>"<?php echo $training_record_list->EmployeeID->editAttributes() ?>>
<input type="hidden" data-table="training_record" data-field="x_EmployeeID" name="o<?php echo $training_record_list->RowIndex ?>_EmployeeID" id="o<?php echo $training_record_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($training_record_list->EmployeeID->OldValue != null ? $training_record_list->EmployeeID->OldValue : $training_record_list->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php if ($training_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_EmployeeID">
<span<?php echo $training_record_list->EmployeeID->viewAttributes() ?>><?php echo $training_record_list->EmployeeID->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($training_record->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="training_record" data-field="x_TrainingIndex" name="x<?php echo $training_record_list->RowIndex ?>_TrainingIndex" id="x<?php echo $training_record_list->RowIndex ?>_TrainingIndex" value="<?php echo HtmlEncode($training_record_list->TrainingIndex->CurrentValue) ?>">
<input type="hidden" data-table="training_record" data-field="x_TrainingIndex" name="o<?php echo $training_record_list->RowIndex ?>_TrainingIndex" id="o<?php echo $training_record_list->RowIndex ?>_TrainingIndex" value="<?php echo HtmlEncode($training_record_list->TrainingIndex->OldValue) ?>">
<?php } ?>
<?php if ($training_record->RowType == ROWTYPE_EDIT || $training_record->CurrentMode == "edit") { ?>
<input type="hidden" data-table="training_record" data-field="x_TrainingIndex" name="x<?php echo $training_record_list->RowIndex ?>_TrainingIndex" id="x<?php echo $training_record_list->RowIndex ?>_TrainingIndex" value="<?php echo HtmlEncode($training_record_list->TrainingIndex->CurrentValue) ?>">
<?php } ?>
	<?php if ($training_record_list->FieldOfTraining->Visible) { // FieldOfTraining ?>
		<td data-name="FieldOfTraining" <?php echo $training_record_list->FieldOfTraining->cellAttributes() ?>>
<?php if ($training_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_FieldOfTraining" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $training_record_list->RowIndex ?>_FieldOfTraining"><?php echo EmptyValue(strval($training_record_list->FieldOfTraining->ViewValue)) ? $Language->phrase("PleaseSelect") : $training_record_list->FieldOfTraining->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($training_record_list->FieldOfTraining->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($training_record_list->FieldOfTraining->ReadOnly || $training_record_list->FieldOfTraining->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $training_record_list->RowIndex ?>_FieldOfTraining',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $training_record_list->FieldOfTraining->Lookup->getParamTag($training_record_list, "p_x" . $training_record_list->RowIndex . "_FieldOfTraining") ?>
<input type="hidden" data-table="training_record" data-field="x_FieldOfTraining" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $training_record_list->FieldOfTraining->displayValueSeparatorAttribute() ?>" name="x<?php echo $training_record_list->RowIndex ?>_FieldOfTraining" id="x<?php echo $training_record_list->RowIndex ?>_FieldOfTraining" value="<?php echo $training_record_list->FieldOfTraining->CurrentValue ?>"<?php echo $training_record_list->FieldOfTraining->editAttributes() ?>>
</span>
<input type="hidden" data-table="training_record" data-field="x_FieldOfTraining" name="o<?php echo $training_record_list->RowIndex ?>_FieldOfTraining" id="o<?php echo $training_record_list->RowIndex ?>_FieldOfTraining" value="<?php echo HtmlEncode($training_record_list->FieldOfTraining->OldValue) ?>">
<?php } ?>
<?php if ($training_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_FieldOfTraining" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $training_record_list->RowIndex ?>_FieldOfTraining"><?php echo EmptyValue(strval($training_record_list->FieldOfTraining->ViewValue)) ? $Language->phrase("PleaseSelect") : $training_record_list->FieldOfTraining->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($training_record_list->FieldOfTraining->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($training_record_list->FieldOfTraining->ReadOnly || $training_record_list->FieldOfTraining->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $training_record_list->RowIndex ?>_FieldOfTraining',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $training_record_list->FieldOfTraining->Lookup->getParamTag($training_record_list, "p_x" . $training_record_list->RowIndex . "_FieldOfTraining") ?>
<input type="hidden" data-table="training_record" data-field="x_FieldOfTraining" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $training_record_list->FieldOfTraining->displayValueSeparatorAttribute() ?>" name="x<?php echo $training_record_list->RowIndex ?>_FieldOfTraining" id="x<?php echo $training_record_list->RowIndex ?>_FieldOfTraining" value="<?php echo $training_record_list->FieldOfTraining->CurrentValue ?>"<?php echo $training_record_list->FieldOfTraining->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($training_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_FieldOfTraining">
<span<?php echo $training_record_list->FieldOfTraining->viewAttributes() ?>><?php echo $training_record_list->FieldOfTraining->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($training_record_list->TrainingType->Visible) { // TrainingType ?>
		<td data-name="TrainingType" <?php echo $training_record_list->TrainingType->cellAttributes() ?>>
<?php if ($training_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_TrainingType" class="form-group">
<input type="text" data-table="training_record" data-field="x_TrainingType" name="x<?php echo $training_record_list->RowIndex ?>_TrainingType" id="x<?php echo $training_record_list->RowIndex ?>_TrainingType" size="30" placeholder="<?php echo HtmlEncode($training_record_list->TrainingType->getPlaceHolder()) ?>" value="<?php echo $training_record_list->TrainingType->EditValue ?>"<?php echo $training_record_list->TrainingType->editAttributes() ?>>
</span>
<input type="hidden" data-table="training_record" data-field="x_TrainingType" name="o<?php echo $training_record_list->RowIndex ?>_TrainingType" id="o<?php echo $training_record_list->RowIndex ?>_TrainingType" value="<?php echo HtmlEncode($training_record_list->TrainingType->OldValue) ?>">
<?php } ?>
<?php if ($training_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_TrainingType" class="form-group">
<input type="text" data-table="training_record" data-field="x_TrainingType" name="x<?php echo $training_record_list->RowIndex ?>_TrainingType" id="x<?php echo $training_record_list->RowIndex ?>_TrainingType" size="30" placeholder="<?php echo HtmlEncode($training_record_list->TrainingType->getPlaceHolder()) ?>" value="<?php echo $training_record_list->TrainingType->EditValue ?>"<?php echo $training_record_list->TrainingType->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($training_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_TrainingType">
<span<?php echo $training_record_list->TrainingType->viewAttributes() ?>><?php echo $training_record_list->TrainingType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($training_record_list->PlannedStartDate->Visible) { // PlannedStartDate ?>
		<td data-name="PlannedStartDate" <?php echo $training_record_list->PlannedStartDate->cellAttributes() ?>>
<?php if ($training_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_PlannedStartDate" class="form-group">
<input type="text" data-table="training_record" data-field="x_PlannedStartDate" name="x<?php echo $training_record_list->RowIndex ?>_PlannedStartDate" id="x<?php echo $training_record_list->RowIndex ?>_PlannedStartDate" placeholder="<?php echo HtmlEncode($training_record_list->PlannedStartDate->getPlaceHolder()) ?>" value="<?php echo $training_record_list->PlannedStartDate->EditValue ?>"<?php echo $training_record_list->PlannedStartDate->editAttributes() ?>>
<?php if (!$training_record_list->PlannedStartDate->ReadOnly && !$training_record_list->PlannedStartDate->Disabled && !isset($training_record_list->PlannedStartDate->EditAttrs["readonly"]) && !isset($training_record_list->PlannedStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftraining_recordlist", "datetimepicker"], function() {
	ew.createDateTimePicker("ftraining_recordlist", "x<?php echo $training_record_list->RowIndex ?>_PlannedStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="training_record" data-field="x_PlannedStartDate" name="o<?php echo $training_record_list->RowIndex ?>_PlannedStartDate" id="o<?php echo $training_record_list->RowIndex ?>_PlannedStartDate" value="<?php echo HtmlEncode($training_record_list->PlannedStartDate->OldValue) ?>">
<?php } ?>
<?php if ($training_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_PlannedStartDate" class="form-group">
<input type="text" data-table="training_record" data-field="x_PlannedStartDate" name="x<?php echo $training_record_list->RowIndex ?>_PlannedStartDate" id="x<?php echo $training_record_list->RowIndex ?>_PlannedStartDate" placeholder="<?php echo HtmlEncode($training_record_list->PlannedStartDate->getPlaceHolder()) ?>" value="<?php echo $training_record_list->PlannedStartDate->EditValue ?>"<?php echo $training_record_list->PlannedStartDate->editAttributes() ?>>
<?php if (!$training_record_list->PlannedStartDate->ReadOnly && !$training_record_list->PlannedStartDate->Disabled && !isset($training_record_list->PlannedStartDate->EditAttrs["readonly"]) && !isset($training_record_list->PlannedStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftraining_recordlist", "datetimepicker"], function() {
	ew.createDateTimePicker("ftraining_recordlist", "x<?php echo $training_record_list->RowIndex ?>_PlannedStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($training_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_PlannedStartDate">
<span<?php echo $training_record_list->PlannedStartDate->viewAttributes() ?>><?php echo $training_record_list->PlannedStartDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($training_record_list->PlannedEndDate->Visible) { // PlannedEndDate ?>
		<td data-name="PlannedEndDate" <?php echo $training_record_list->PlannedEndDate->cellAttributes() ?>>
<?php if ($training_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_PlannedEndDate" class="form-group">
<input type="text" data-table="training_record" data-field="x_PlannedEndDate" data-format="2" name="x<?php echo $training_record_list->RowIndex ?>_PlannedEndDate" id="x<?php echo $training_record_list->RowIndex ?>_PlannedEndDate" size="30" placeholder="<?php echo HtmlEncode($training_record_list->PlannedEndDate->getPlaceHolder()) ?>" value="<?php echo $training_record_list->PlannedEndDate->EditValue ?>"<?php echo $training_record_list->PlannedEndDate->editAttributes() ?>>
<?php if (!$training_record_list->PlannedEndDate->ReadOnly && !$training_record_list->PlannedEndDate->Disabled && !isset($training_record_list->PlannedEndDate->EditAttrs["readonly"]) && !isset($training_record_list->PlannedEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftraining_recordlist", "datetimepicker"], function() {
	ew.createDateTimePicker("ftraining_recordlist", "x<?php echo $training_record_list->RowIndex ?>_PlannedEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":2});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="training_record" data-field="x_PlannedEndDate" name="o<?php echo $training_record_list->RowIndex ?>_PlannedEndDate" id="o<?php echo $training_record_list->RowIndex ?>_PlannedEndDate" value="<?php echo HtmlEncode($training_record_list->PlannedEndDate->OldValue) ?>">
<?php } ?>
<?php if ($training_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_PlannedEndDate" class="form-group">
<input type="text" data-table="training_record" data-field="x_PlannedEndDate" data-format="2" name="x<?php echo $training_record_list->RowIndex ?>_PlannedEndDate" id="x<?php echo $training_record_list->RowIndex ?>_PlannedEndDate" size="30" placeholder="<?php echo HtmlEncode($training_record_list->PlannedEndDate->getPlaceHolder()) ?>" value="<?php echo $training_record_list->PlannedEndDate->EditValue ?>"<?php echo $training_record_list->PlannedEndDate->editAttributes() ?>>
<?php if (!$training_record_list->PlannedEndDate->ReadOnly && !$training_record_list->PlannedEndDate->Disabled && !isset($training_record_list->PlannedEndDate->EditAttrs["readonly"]) && !isset($training_record_list->PlannedEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftraining_recordlist", "datetimepicker"], function() {
	ew.createDateTimePicker("ftraining_recordlist", "x<?php echo $training_record_list->RowIndex ?>_PlannedEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":2});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($training_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_PlannedEndDate">
<span<?php echo $training_record_list->PlannedEndDate->viewAttributes() ?>><?php echo $training_record_list->PlannedEndDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($training_record_list->ActualStartDate->Visible) { // ActualStartDate ?>
		<td data-name="ActualStartDate" <?php echo $training_record_list->ActualStartDate->cellAttributes() ?>>
<?php if ($training_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_ActualStartDate" class="form-group">
<input type="text" data-table="training_record" data-field="x_ActualStartDate" name="x<?php echo $training_record_list->RowIndex ?>_ActualStartDate" id="x<?php echo $training_record_list->RowIndex ?>_ActualStartDate" size="30" placeholder="<?php echo HtmlEncode($training_record_list->ActualStartDate->getPlaceHolder()) ?>" value="<?php echo $training_record_list->ActualStartDate->EditValue ?>"<?php echo $training_record_list->ActualStartDate->editAttributes() ?>>
<?php if (!$training_record_list->ActualStartDate->ReadOnly && !$training_record_list->ActualStartDate->Disabled && !isset($training_record_list->ActualStartDate->EditAttrs["readonly"]) && !isset($training_record_list->ActualStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftraining_recordlist", "datetimepicker"], function() {
	ew.createDateTimePicker("ftraining_recordlist", "x<?php echo $training_record_list->RowIndex ?>_ActualStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="training_record" data-field="x_ActualStartDate" name="o<?php echo $training_record_list->RowIndex ?>_ActualStartDate" id="o<?php echo $training_record_list->RowIndex ?>_ActualStartDate" value="<?php echo HtmlEncode($training_record_list->ActualStartDate->OldValue) ?>">
<?php } ?>
<?php if ($training_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_ActualStartDate" class="form-group">
<input type="text" data-table="training_record" data-field="x_ActualStartDate" name="x<?php echo $training_record_list->RowIndex ?>_ActualStartDate" id="x<?php echo $training_record_list->RowIndex ?>_ActualStartDate" size="30" placeholder="<?php echo HtmlEncode($training_record_list->ActualStartDate->getPlaceHolder()) ?>" value="<?php echo $training_record_list->ActualStartDate->EditValue ?>"<?php echo $training_record_list->ActualStartDate->editAttributes() ?>>
<?php if (!$training_record_list->ActualStartDate->ReadOnly && !$training_record_list->ActualStartDate->Disabled && !isset($training_record_list->ActualStartDate->EditAttrs["readonly"]) && !isset($training_record_list->ActualStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftraining_recordlist", "datetimepicker"], function() {
	ew.createDateTimePicker("ftraining_recordlist", "x<?php echo $training_record_list->RowIndex ?>_ActualStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($training_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_ActualStartDate">
<span<?php echo $training_record_list->ActualStartDate->viewAttributes() ?>><?php echo $training_record_list->ActualStartDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($training_record_list->ActualEnddate->Visible) { // ActualEnddate ?>
		<td data-name="ActualEnddate" <?php echo $training_record_list->ActualEnddate->cellAttributes() ?>>
<?php if ($training_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_ActualEnddate" class="form-group">
<input type="text" data-table="training_record" data-field="x_ActualEnddate" name="x<?php echo $training_record_list->RowIndex ?>_ActualEnddate" id="x<?php echo $training_record_list->RowIndex ?>_ActualEnddate" size="30" placeholder="<?php echo HtmlEncode($training_record_list->ActualEnddate->getPlaceHolder()) ?>" value="<?php echo $training_record_list->ActualEnddate->EditValue ?>"<?php echo $training_record_list->ActualEnddate->editAttributes() ?>>
<?php if (!$training_record_list->ActualEnddate->ReadOnly && !$training_record_list->ActualEnddate->Disabled && !isset($training_record_list->ActualEnddate->EditAttrs["readonly"]) && !isset($training_record_list->ActualEnddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftraining_recordlist", "datetimepicker"], function() {
	ew.createDateTimePicker("ftraining_recordlist", "x<?php echo $training_record_list->RowIndex ?>_ActualEnddate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="training_record" data-field="x_ActualEnddate" name="o<?php echo $training_record_list->RowIndex ?>_ActualEnddate" id="o<?php echo $training_record_list->RowIndex ?>_ActualEnddate" value="<?php echo HtmlEncode($training_record_list->ActualEnddate->OldValue) ?>">
<?php } ?>
<?php if ($training_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_ActualEnddate" class="form-group">
<input type="text" data-table="training_record" data-field="x_ActualEnddate" name="x<?php echo $training_record_list->RowIndex ?>_ActualEnddate" id="x<?php echo $training_record_list->RowIndex ?>_ActualEnddate" size="30" placeholder="<?php echo HtmlEncode($training_record_list->ActualEnddate->getPlaceHolder()) ?>" value="<?php echo $training_record_list->ActualEnddate->EditValue ?>"<?php echo $training_record_list->ActualEnddate->editAttributes() ?>>
<?php if (!$training_record_list->ActualEnddate->ReadOnly && !$training_record_list->ActualEnddate->Disabled && !isset($training_record_list->ActualEnddate->EditAttrs["readonly"]) && !isset($training_record_list->ActualEnddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftraining_recordlist", "datetimepicker"], function() {
	ew.createDateTimePicker("ftraining_recordlist", "x<?php echo $training_record_list->RowIndex ?>_ActualEnddate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($training_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_ActualEnddate">
<span<?php echo $training_record_list->ActualEnddate->viewAttributes() ?>><?php echo $training_record_list->ActualEnddate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($training_record_list->QualificationLevelObtained->Visible) { // QualificationLevelObtained ?>
		<td data-name="QualificationLevelObtained" <?php echo $training_record_list->QualificationLevelObtained->cellAttributes() ?>>
<?php if ($training_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_QualificationLevelObtained" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $training_record_list->RowIndex ?>_QualificationLevelObtained"><?php echo EmptyValue(strval($training_record_list->QualificationLevelObtained->ViewValue)) ? $Language->phrase("PleaseSelect") : $training_record_list->QualificationLevelObtained->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($training_record_list->QualificationLevelObtained->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($training_record_list->QualificationLevelObtained->ReadOnly || $training_record_list->QualificationLevelObtained->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $training_record_list->RowIndex ?>_QualificationLevelObtained',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $training_record_list->QualificationLevelObtained->Lookup->getParamTag($training_record_list, "p_x" . $training_record_list->RowIndex . "_QualificationLevelObtained") ?>
<input type="hidden" data-table="training_record" data-field="x_QualificationLevelObtained" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $training_record_list->QualificationLevelObtained->displayValueSeparatorAttribute() ?>" name="x<?php echo $training_record_list->RowIndex ?>_QualificationLevelObtained" id="x<?php echo $training_record_list->RowIndex ?>_QualificationLevelObtained" value="<?php echo $training_record_list->QualificationLevelObtained->CurrentValue ?>"<?php echo $training_record_list->QualificationLevelObtained->editAttributes() ?>>
</span>
<input type="hidden" data-table="training_record" data-field="x_QualificationLevelObtained" name="o<?php echo $training_record_list->RowIndex ?>_QualificationLevelObtained" id="o<?php echo $training_record_list->RowIndex ?>_QualificationLevelObtained" value="<?php echo HtmlEncode($training_record_list->QualificationLevelObtained->OldValue) ?>">
<?php } ?>
<?php if ($training_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_QualificationLevelObtained" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $training_record_list->RowIndex ?>_QualificationLevelObtained"><?php echo EmptyValue(strval($training_record_list->QualificationLevelObtained->ViewValue)) ? $Language->phrase("PleaseSelect") : $training_record_list->QualificationLevelObtained->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($training_record_list->QualificationLevelObtained->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($training_record_list->QualificationLevelObtained->ReadOnly || $training_record_list->QualificationLevelObtained->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $training_record_list->RowIndex ?>_QualificationLevelObtained',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $training_record_list->QualificationLevelObtained->Lookup->getParamTag($training_record_list, "p_x" . $training_record_list->RowIndex . "_QualificationLevelObtained") ?>
<input type="hidden" data-table="training_record" data-field="x_QualificationLevelObtained" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $training_record_list->QualificationLevelObtained->displayValueSeparatorAttribute() ?>" name="x<?php echo $training_record_list->RowIndex ?>_QualificationLevelObtained" id="x<?php echo $training_record_list->RowIndex ?>_QualificationLevelObtained" value="<?php echo $training_record_list->QualificationLevelObtained->CurrentValue ?>"<?php echo $training_record_list->QualificationLevelObtained->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($training_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_QualificationLevelObtained">
<span<?php echo $training_record_list->QualificationLevelObtained->viewAttributes() ?>><?php echo $training_record_list->QualificationLevelObtained->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($training_record_list->AwardingInstitution->Visible) { // AwardingInstitution ?>
		<td data-name="AwardingInstitution" <?php echo $training_record_list->AwardingInstitution->cellAttributes() ?>>
<?php if ($training_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_AwardingInstitution" class="form-group">
<input type="text" data-table="training_record" data-field="x_AwardingInstitution" name="x<?php echo $training_record_list->RowIndex ?>_AwardingInstitution" id="x<?php echo $training_record_list->RowIndex ?>_AwardingInstitution" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($training_record_list->AwardingInstitution->getPlaceHolder()) ?>" value="<?php echo $training_record_list->AwardingInstitution->EditValue ?>"<?php echo $training_record_list->AwardingInstitution->editAttributes() ?>>
</span>
<input type="hidden" data-table="training_record" data-field="x_AwardingInstitution" name="o<?php echo $training_record_list->RowIndex ?>_AwardingInstitution" id="o<?php echo $training_record_list->RowIndex ?>_AwardingInstitution" value="<?php echo HtmlEncode($training_record_list->AwardingInstitution->OldValue) ?>">
<?php } ?>
<?php if ($training_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_AwardingInstitution" class="form-group">
<input type="text" data-table="training_record" data-field="x_AwardingInstitution" name="x<?php echo $training_record_list->RowIndex ?>_AwardingInstitution" id="x<?php echo $training_record_list->RowIndex ?>_AwardingInstitution" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($training_record_list->AwardingInstitution->getPlaceHolder()) ?>" value="<?php echo $training_record_list->AwardingInstitution->EditValue ?>"<?php echo $training_record_list->AwardingInstitution->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($training_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_AwardingInstitution">
<span<?php echo $training_record_list->AwardingInstitution->viewAttributes() ?>><?php echo $training_record_list->AwardingInstitution->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($training_record_list->FundingSource->Visible) { // FundingSource ?>
		<td data-name="FundingSource" <?php echo $training_record_list->FundingSource->cellAttributes() ?>>
<?php if ($training_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_FundingSource" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="training_record" data-field="x_FundingSource" data-value-separator="<?php echo $training_record_list->FundingSource->displayValueSeparatorAttribute() ?>" id="x<?php echo $training_record_list->RowIndex ?>_FundingSource" name="x<?php echo $training_record_list->RowIndex ?>_FundingSource"<?php echo $training_record_list->FundingSource->editAttributes() ?>>
			<?php echo $training_record_list->FundingSource->selectOptionListHtml("x{$training_record_list->RowIndex}_FundingSource") ?>
		</select>
</div>
<?php echo $training_record_list->FundingSource->Lookup->getParamTag($training_record_list, "p_x" . $training_record_list->RowIndex . "_FundingSource") ?>
</span>
<input type="hidden" data-table="training_record" data-field="x_FundingSource" name="o<?php echo $training_record_list->RowIndex ?>_FundingSource" id="o<?php echo $training_record_list->RowIndex ?>_FundingSource" value="<?php echo HtmlEncode($training_record_list->FundingSource->OldValue) ?>">
<?php } ?>
<?php if ($training_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_FundingSource" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="training_record" data-field="x_FundingSource" data-value-separator="<?php echo $training_record_list->FundingSource->displayValueSeparatorAttribute() ?>" id="x<?php echo $training_record_list->RowIndex ?>_FundingSource" name="x<?php echo $training_record_list->RowIndex ?>_FundingSource"<?php echo $training_record_list->FundingSource->editAttributes() ?>>
			<?php echo $training_record_list->FundingSource->selectOptionListHtml("x{$training_record_list->RowIndex}_FundingSource") ?>
		</select>
</div>
<?php echo $training_record_list->FundingSource->Lookup->getParamTag($training_record_list, "p_x" . $training_record_list->RowIndex . "_FundingSource") ?>
</span>
<?php } ?>
<?php if ($training_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_FundingSource">
<span<?php echo $training_record_list->FundingSource->viewAttributes() ?>><?php echo $training_record_list->FundingSource->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($training_record_list->TrainingCost->Visible) { // TrainingCost ?>
		<td data-name="TrainingCost" <?php echo $training_record_list->TrainingCost->cellAttributes() ?>>
<?php if ($training_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_TrainingCost" class="form-group">
<input type="text" data-table="training_record" data-field="x_TrainingCost" name="x<?php echo $training_record_list->RowIndex ?>_TrainingCost" id="x<?php echo $training_record_list->RowIndex ?>_TrainingCost" size="30" placeholder="<?php echo HtmlEncode($training_record_list->TrainingCost->getPlaceHolder()) ?>" value="<?php echo $training_record_list->TrainingCost->EditValue ?>"<?php echo $training_record_list->TrainingCost->editAttributes() ?>>
</span>
<input type="hidden" data-table="training_record" data-field="x_TrainingCost" name="o<?php echo $training_record_list->RowIndex ?>_TrainingCost" id="o<?php echo $training_record_list->RowIndex ?>_TrainingCost" value="<?php echo HtmlEncode($training_record_list->TrainingCost->OldValue) ?>">
<?php } ?>
<?php if ($training_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_TrainingCost" class="form-group">
<input type="text" data-table="training_record" data-field="x_TrainingCost" name="x<?php echo $training_record_list->RowIndex ?>_TrainingCost" id="x<?php echo $training_record_list->RowIndex ?>_TrainingCost" size="30" placeholder="<?php echo HtmlEncode($training_record_list->TrainingCost->getPlaceHolder()) ?>" value="<?php echo $training_record_list->TrainingCost->EditValue ?>"<?php echo $training_record_list->TrainingCost->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($training_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $training_record_list->RowCount ?>_training_record_TrainingCost">
<span<?php echo $training_record_list->TrainingCost->viewAttributes() ?>><?php echo $training_record_list->TrainingCost->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$training_record_list->ListOptions->render("body", "right", $training_record_list->RowCount);
?>
	</tr>
<?php if ($training_record->RowType == ROWTYPE_ADD || $training_record->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ftraining_recordlist", "load"], function() {
	ftraining_recordlist.updateLists(<?php echo $training_record_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$training_record_list->isGridAdd())
		if (!$training_record_list->Recordset->EOF)
			$training_record_list->Recordset->moveNext();
}
?>
<?php
	if ($training_record_list->isGridAdd() || $training_record_list->isGridEdit()) {
		$training_record_list->RowIndex = '$rowindex$';
		$training_record_list->loadRowValues();

		// Set row properties
		$training_record->resetAttributes();
		$training_record->RowAttrs->merge(["data-rowindex" => $training_record_list->RowIndex, "id" => "r0_training_record", "data-rowtype" => ROWTYPE_ADD]);
		$training_record->RowAttrs->appendClass("ew-template");
		$training_record->RowType = ROWTYPE_ADD;

		// Render row
		$training_record_list->renderRow();

		// Render list options
		$training_record_list->renderListOptions();
		$training_record_list->StartRowCount = 0;
?>
	<tr <?php echo $training_record->rowAttributes() ?>>
<?php

// Render list options (body, left)
$training_record_list->ListOptions->render("body", "left", $training_record_list->RowIndex);
?>
	<?php if ($training_record_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID">
<span id="el$rowindex$_training_record_EmployeeID" class="form-group training_record_EmployeeID">
<input type="text" data-table="training_record" data-field="x_EmployeeID" name="x<?php echo $training_record_list->RowIndex ?>_EmployeeID" id="x<?php echo $training_record_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($training_record_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $training_record_list->EmployeeID->EditValue ?>"<?php echo $training_record_list->EmployeeID->editAttributes() ?>>
</span>
<input type="hidden" data-table="training_record" data-field="x_EmployeeID" name="o<?php echo $training_record_list->RowIndex ?>_EmployeeID" id="o<?php echo $training_record_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($training_record_list->EmployeeID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($training_record_list->FieldOfTraining->Visible) { // FieldOfTraining ?>
		<td data-name="FieldOfTraining">
<span id="el$rowindex$_training_record_FieldOfTraining" class="form-group training_record_FieldOfTraining">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $training_record_list->RowIndex ?>_FieldOfTraining"><?php echo EmptyValue(strval($training_record_list->FieldOfTraining->ViewValue)) ? $Language->phrase("PleaseSelect") : $training_record_list->FieldOfTraining->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($training_record_list->FieldOfTraining->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($training_record_list->FieldOfTraining->ReadOnly || $training_record_list->FieldOfTraining->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $training_record_list->RowIndex ?>_FieldOfTraining',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $training_record_list->FieldOfTraining->Lookup->getParamTag($training_record_list, "p_x" . $training_record_list->RowIndex . "_FieldOfTraining") ?>
<input type="hidden" data-table="training_record" data-field="x_FieldOfTraining" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $training_record_list->FieldOfTraining->displayValueSeparatorAttribute() ?>" name="x<?php echo $training_record_list->RowIndex ?>_FieldOfTraining" id="x<?php echo $training_record_list->RowIndex ?>_FieldOfTraining" value="<?php echo $training_record_list->FieldOfTraining->CurrentValue ?>"<?php echo $training_record_list->FieldOfTraining->editAttributes() ?>>
</span>
<input type="hidden" data-table="training_record" data-field="x_FieldOfTraining" name="o<?php echo $training_record_list->RowIndex ?>_FieldOfTraining" id="o<?php echo $training_record_list->RowIndex ?>_FieldOfTraining" value="<?php echo HtmlEncode($training_record_list->FieldOfTraining->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($training_record_list->TrainingType->Visible) { // TrainingType ?>
		<td data-name="TrainingType">
<span id="el$rowindex$_training_record_TrainingType" class="form-group training_record_TrainingType">
<input type="text" data-table="training_record" data-field="x_TrainingType" name="x<?php echo $training_record_list->RowIndex ?>_TrainingType" id="x<?php echo $training_record_list->RowIndex ?>_TrainingType" size="30" placeholder="<?php echo HtmlEncode($training_record_list->TrainingType->getPlaceHolder()) ?>" value="<?php echo $training_record_list->TrainingType->EditValue ?>"<?php echo $training_record_list->TrainingType->editAttributes() ?>>
</span>
<input type="hidden" data-table="training_record" data-field="x_TrainingType" name="o<?php echo $training_record_list->RowIndex ?>_TrainingType" id="o<?php echo $training_record_list->RowIndex ?>_TrainingType" value="<?php echo HtmlEncode($training_record_list->TrainingType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($training_record_list->PlannedStartDate->Visible) { // PlannedStartDate ?>
		<td data-name="PlannedStartDate">
<span id="el$rowindex$_training_record_PlannedStartDate" class="form-group training_record_PlannedStartDate">
<input type="text" data-table="training_record" data-field="x_PlannedStartDate" name="x<?php echo $training_record_list->RowIndex ?>_PlannedStartDate" id="x<?php echo $training_record_list->RowIndex ?>_PlannedStartDate" placeholder="<?php echo HtmlEncode($training_record_list->PlannedStartDate->getPlaceHolder()) ?>" value="<?php echo $training_record_list->PlannedStartDate->EditValue ?>"<?php echo $training_record_list->PlannedStartDate->editAttributes() ?>>
<?php if (!$training_record_list->PlannedStartDate->ReadOnly && !$training_record_list->PlannedStartDate->Disabled && !isset($training_record_list->PlannedStartDate->EditAttrs["readonly"]) && !isset($training_record_list->PlannedStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftraining_recordlist", "datetimepicker"], function() {
	ew.createDateTimePicker("ftraining_recordlist", "x<?php echo $training_record_list->RowIndex ?>_PlannedStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="training_record" data-field="x_PlannedStartDate" name="o<?php echo $training_record_list->RowIndex ?>_PlannedStartDate" id="o<?php echo $training_record_list->RowIndex ?>_PlannedStartDate" value="<?php echo HtmlEncode($training_record_list->PlannedStartDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($training_record_list->PlannedEndDate->Visible) { // PlannedEndDate ?>
		<td data-name="PlannedEndDate">
<span id="el$rowindex$_training_record_PlannedEndDate" class="form-group training_record_PlannedEndDate">
<input type="text" data-table="training_record" data-field="x_PlannedEndDate" data-format="2" name="x<?php echo $training_record_list->RowIndex ?>_PlannedEndDate" id="x<?php echo $training_record_list->RowIndex ?>_PlannedEndDate" size="30" placeholder="<?php echo HtmlEncode($training_record_list->PlannedEndDate->getPlaceHolder()) ?>" value="<?php echo $training_record_list->PlannedEndDate->EditValue ?>"<?php echo $training_record_list->PlannedEndDate->editAttributes() ?>>
<?php if (!$training_record_list->PlannedEndDate->ReadOnly && !$training_record_list->PlannedEndDate->Disabled && !isset($training_record_list->PlannedEndDate->EditAttrs["readonly"]) && !isset($training_record_list->PlannedEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftraining_recordlist", "datetimepicker"], function() {
	ew.createDateTimePicker("ftraining_recordlist", "x<?php echo $training_record_list->RowIndex ?>_PlannedEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":2});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="training_record" data-field="x_PlannedEndDate" name="o<?php echo $training_record_list->RowIndex ?>_PlannedEndDate" id="o<?php echo $training_record_list->RowIndex ?>_PlannedEndDate" value="<?php echo HtmlEncode($training_record_list->PlannedEndDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($training_record_list->ActualStartDate->Visible) { // ActualStartDate ?>
		<td data-name="ActualStartDate">
<span id="el$rowindex$_training_record_ActualStartDate" class="form-group training_record_ActualStartDate">
<input type="text" data-table="training_record" data-field="x_ActualStartDate" name="x<?php echo $training_record_list->RowIndex ?>_ActualStartDate" id="x<?php echo $training_record_list->RowIndex ?>_ActualStartDate" size="30" placeholder="<?php echo HtmlEncode($training_record_list->ActualStartDate->getPlaceHolder()) ?>" value="<?php echo $training_record_list->ActualStartDate->EditValue ?>"<?php echo $training_record_list->ActualStartDate->editAttributes() ?>>
<?php if (!$training_record_list->ActualStartDate->ReadOnly && !$training_record_list->ActualStartDate->Disabled && !isset($training_record_list->ActualStartDate->EditAttrs["readonly"]) && !isset($training_record_list->ActualStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftraining_recordlist", "datetimepicker"], function() {
	ew.createDateTimePicker("ftraining_recordlist", "x<?php echo $training_record_list->RowIndex ?>_ActualStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="training_record" data-field="x_ActualStartDate" name="o<?php echo $training_record_list->RowIndex ?>_ActualStartDate" id="o<?php echo $training_record_list->RowIndex ?>_ActualStartDate" value="<?php echo HtmlEncode($training_record_list->ActualStartDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($training_record_list->ActualEnddate->Visible) { // ActualEnddate ?>
		<td data-name="ActualEnddate">
<span id="el$rowindex$_training_record_ActualEnddate" class="form-group training_record_ActualEnddate">
<input type="text" data-table="training_record" data-field="x_ActualEnddate" name="x<?php echo $training_record_list->RowIndex ?>_ActualEnddate" id="x<?php echo $training_record_list->RowIndex ?>_ActualEnddate" size="30" placeholder="<?php echo HtmlEncode($training_record_list->ActualEnddate->getPlaceHolder()) ?>" value="<?php echo $training_record_list->ActualEnddate->EditValue ?>"<?php echo $training_record_list->ActualEnddate->editAttributes() ?>>
<?php if (!$training_record_list->ActualEnddate->ReadOnly && !$training_record_list->ActualEnddate->Disabled && !isset($training_record_list->ActualEnddate->EditAttrs["readonly"]) && !isset($training_record_list->ActualEnddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftraining_recordlist", "datetimepicker"], function() {
	ew.createDateTimePicker("ftraining_recordlist", "x<?php echo $training_record_list->RowIndex ?>_ActualEnddate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="training_record" data-field="x_ActualEnddate" name="o<?php echo $training_record_list->RowIndex ?>_ActualEnddate" id="o<?php echo $training_record_list->RowIndex ?>_ActualEnddate" value="<?php echo HtmlEncode($training_record_list->ActualEnddate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($training_record_list->QualificationLevelObtained->Visible) { // QualificationLevelObtained ?>
		<td data-name="QualificationLevelObtained">
<span id="el$rowindex$_training_record_QualificationLevelObtained" class="form-group training_record_QualificationLevelObtained">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $training_record_list->RowIndex ?>_QualificationLevelObtained"><?php echo EmptyValue(strval($training_record_list->QualificationLevelObtained->ViewValue)) ? $Language->phrase("PleaseSelect") : $training_record_list->QualificationLevelObtained->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($training_record_list->QualificationLevelObtained->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($training_record_list->QualificationLevelObtained->ReadOnly || $training_record_list->QualificationLevelObtained->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $training_record_list->RowIndex ?>_QualificationLevelObtained',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $training_record_list->QualificationLevelObtained->Lookup->getParamTag($training_record_list, "p_x" . $training_record_list->RowIndex . "_QualificationLevelObtained") ?>
<input type="hidden" data-table="training_record" data-field="x_QualificationLevelObtained" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $training_record_list->QualificationLevelObtained->displayValueSeparatorAttribute() ?>" name="x<?php echo $training_record_list->RowIndex ?>_QualificationLevelObtained" id="x<?php echo $training_record_list->RowIndex ?>_QualificationLevelObtained" value="<?php echo $training_record_list->QualificationLevelObtained->CurrentValue ?>"<?php echo $training_record_list->QualificationLevelObtained->editAttributes() ?>>
</span>
<input type="hidden" data-table="training_record" data-field="x_QualificationLevelObtained" name="o<?php echo $training_record_list->RowIndex ?>_QualificationLevelObtained" id="o<?php echo $training_record_list->RowIndex ?>_QualificationLevelObtained" value="<?php echo HtmlEncode($training_record_list->QualificationLevelObtained->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($training_record_list->AwardingInstitution->Visible) { // AwardingInstitution ?>
		<td data-name="AwardingInstitution">
<span id="el$rowindex$_training_record_AwardingInstitution" class="form-group training_record_AwardingInstitution">
<input type="text" data-table="training_record" data-field="x_AwardingInstitution" name="x<?php echo $training_record_list->RowIndex ?>_AwardingInstitution" id="x<?php echo $training_record_list->RowIndex ?>_AwardingInstitution" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($training_record_list->AwardingInstitution->getPlaceHolder()) ?>" value="<?php echo $training_record_list->AwardingInstitution->EditValue ?>"<?php echo $training_record_list->AwardingInstitution->editAttributes() ?>>
</span>
<input type="hidden" data-table="training_record" data-field="x_AwardingInstitution" name="o<?php echo $training_record_list->RowIndex ?>_AwardingInstitution" id="o<?php echo $training_record_list->RowIndex ?>_AwardingInstitution" value="<?php echo HtmlEncode($training_record_list->AwardingInstitution->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($training_record_list->FundingSource->Visible) { // FundingSource ?>
		<td data-name="FundingSource">
<span id="el$rowindex$_training_record_FundingSource" class="form-group training_record_FundingSource">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="training_record" data-field="x_FundingSource" data-value-separator="<?php echo $training_record_list->FundingSource->displayValueSeparatorAttribute() ?>" id="x<?php echo $training_record_list->RowIndex ?>_FundingSource" name="x<?php echo $training_record_list->RowIndex ?>_FundingSource"<?php echo $training_record_list->FundingSource->editAttributes() ?>>
			<?php echo $training_record_list->FundingSource->selectOptionListHtml("x{$training_record_list->RowIndex}_FundingSource") ?>
		</select>
</div>
<?php echo $training_record_list->FundingSource->Lookup->getParamTag($training_record_list, "p_x" . $training_record_list->RowIndex . "_FundingSource") ?>
</span>
<input type="hidden" data-table="training_record" data-field="x_FundingSource" name="o<?php echo $training_record_list->RowIndex ?>_FundingSource" id="o<?php echo $training_record_list->RowIndex ?>_FundingSource" value="<?php echo HtmlEncode($training_record_list->FundingSource->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($training_record_list->TrainingCost->Visible) { // TrainingCost ?>
		<td data-name="TrainingCost">
<span id="el$rowindex$_training_record_TrainingCost" class="form-group training_record_TrainingCost">
<input type="text" data-table="training_record" data-field="x_TrainingCost" name="x<?php echo $training_record_list->RowIndex ?>_TrainingCost" id="x<?php echo $training_record_list->RowIndex ?>_TrainingCost" size="30" placeholder="<?php echo HtmlEncode($training_record_list->TrainingCost->getPlaceHolder()) ?>" value="<?php echo $training_record_list->TrainingCost->EditValue ?>"<?php echo $training_record_list->TrainingCost->editAttributes() ?>>
</span>
<input type="hidden" data-table="training_record" data-field="x_TrainingCost" name="o<?php echo $training_record_list->RowIndex ?>_TrainingCost" id="o<?php echo $training_record_list->RowIndex ?>_TrainingCost" value="<?php echo HtmlEncode($training_record_list->TrainingCost->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$training_record_list->ListOptions->render("body", "right", $training_record_list->RowIndex);
?>
<script>
loadjs.ready(["ftraining_recordlist", "load"], function() {
	ftraining_recordlist.updateLists(<?php echo $training_record_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($training_record_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $training_record_list->FormKeyCountName ?>" id="<?php echo $training_record_list->FormKeyCountName ?>" value="<?php echo $training_record_list->KeyCount ?>">
<?php echo $training_record_list->MultiSelectKey ?>
<?php } ?>
<?php if ($training_record_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $training_record_list->FormKeyCountName ?>" id="<?php echo $training_record_list->FormKeyCountName ?>" value="<?php echo $training_record_list->KeyCount ?>">
<?php echo $training_record_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$training_record->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($training_record_list->Recordset)
	$training_record_list->Recordset->Close();
?>
<?php if (!$training_record_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$training_record_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $training_record_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $training_record_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($training_record_list->TotalRecords == 0 && !$training_record->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $training_record_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$training_record_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$training_record_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$training_record_list->terminate();
?>