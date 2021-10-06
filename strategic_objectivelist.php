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
$strategic_objective_list = new strategic_objective_list();

// Run the page
$strategic_objective_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$strategic_objective_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$strategic_objective_list->isExport()) { ?>
<script>
var fstrategic_objectivelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fstrategic_objectivelist = currentForm = new ew.Form("fstrategic_objectivelist", "list");
	fstrategic_objectivelist.formKeyCountName = '<?php echo $strategic_objective_list->FormKeyCountName ?>';

	// Validate form
	fstrategic_objectivelist.validate = function() {
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
			<?php if ($strategic_objective_list->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $strategic_objective_list->LACode->caption(), $strategic_objective_list->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($strategic_objective_list->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $strategic_objective_list->DepartmentCode->caption(), $strategic_objective_list->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($strategic_objective_list->StrategicObjectiveCode->Required) { ?>
				elm = this.getElements("x" + infix + "_StrategicObjectiveCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $strategic_objective_list->StrategicObjectiveCode->caption(), $strategic_objective_list->StrategicObjectiveCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($strategic_objective_list->StrategicObjectiveName->Required) { ?>
				elm = this.getElements("x" + infix + "_StrategicObjectiveName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $strategic_objective_list->StrategicObjectiveName->caption(), $strategic_objective_list->StrategicObjectiveName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($strategic_objective_list->ReferencedDocs->Required) { ?>
				elm = this.getElements("x" + infix + "_ReferencedDocs");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $strategic_objective_list->ReferencedDocs->caption(), $strategic_objective_list->ReferencedDocs->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($strategic_objective_list->ResultAreaCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ResultAreaCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $strategic_objective_list->ResultAreaCode->caption(), $strategic_objective_list->ResultAreaCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ResultAreaCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($strategic_objective_list->ResultAreaCode->errorMessage()) ?>");

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
	fstrategic_objectivelist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "StrategicObjectiveName", false)) return false;
		if (ew.valueChanged(fobj, infix, "ReferencedDocs", false)) return false;
		if (ew.valueChanged(fobj, infix, "ResultAreaCode", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fstrategic_objectivelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstrategic_objectivelist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstrategic_objectivelist.lists["x_LACode"] = <?php echo $strategic_objective_list->LACode->Lookup->toClientList($strategic_objective_list) ?>;
	fstrategic_objectivelist.lists["x_LACode"].options = <?php echo JsonEncode($strategic_objective_list->LACode->lookupOptions()) ?>;
	fstrategic_objectivelist.lists["x_DepartmentCode"] = <?php echo $strategic_objective_list->DepartmentCode->Lookup->toClientList($strategic_objective_list) ?>;
	fstrategic_objectivelist.lists["x_DepartmentCode"].options = <?php echo JsonEncode($strategic_objective_list->DepartmentCode->lookupOptions()) ?>;
	loadjs.done("fstrategic_objectivelist");
});
var fstrategic_objectivelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fstrategic_objectivelistsrch = currentSearchForm = new ew.Form("fstrategic_objectivelistsrch");

	// Dynamic selection lists
	// Filters

	fstrategic_objectivelistsrch.filterList = <?php echo $strategic_objective_list->getFilterList() ?>;

	// Init search panel as collapsed
	fstrategic_objectivelistsrch.initSearchPanel = true;
	loadjs.done("fstrategic_objectivelistsrch");
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
<?php if (!$strategic_objective_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($strategic_objective_list->TotalRecords > 0 && $strategic_objective_list->ExportOptions->visible()) { ?>
<?php $strategic_objective_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($strategic_objective_list->ImportOptions->visible()) { ?>
<?php $strategic_objective_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($strategic_objective_list->SearchOptions->visible()) { ?>
<?php $strategic_objective_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($strategic_objective_list->FilterOptions->visible()) { ?>
<?php $strategic_objective_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$strategic_objective_list->isExport() || Config("EXPORT_MASTER_RECORD") && $strategic_objective_list->isExport("print")) { ?>
<?php
if ($strategic_objective_list->DbMasterFilter != "" && $strategic_objective->getCurrentMasterTable() == "local_authority") {
	if ($strategic_objective_list->MasterRecordExists) {
		include_once "local_authoritymaster.php";
	}
}
?>
<?php } ?>
<?php
$strategic_objective_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$strategic_objective_list->isExport() && !$strategic_objective->CurrentAction) { ?>
<form name="fstrategic_objectivelistsrch" id="fstrategic_objectivelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fstrategic_objectivelistsrch-search-panel" class="<?php echo $strategic_objective_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="strategic_objective">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $strategic_objective_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($strategic_objective_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($strategic_objective_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $strategic_objective_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($strategic_objective_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($strategic_objective_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($strategic_objective_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($strategic_objective_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $strategic_objective_list->showPageHeader(); ?>
<?php
$strategic_objective_list->showMessage();
?>
<?php if ($strategic_objective_list->TotalRecords > 0 || $strategic_objective->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($strategic_objective_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> strategic_objective">
<?php if (!$strategic_objective_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$strategic_objective_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $strategic_objective_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $strategic_objective_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fstrategic_objectivelist" id="fstrategic_objectivelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="strategic_objective">
<?php if ($strategic_objective->getCurrentMasterTable() == "local_authority" && $strategic_objective->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($strategic_objective_list->LACode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_strategic_objective" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($strategic_objective_list->TotalRecords > 0 || $strategic_objective_list->isGridEdit()) { ?>
<table id="tbl_strategic_objectivelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$strategic_objective->RowType = ROWTYPE_HEADER;

// Render list options
$strategic_objective_list->renderListOptions();

// Render list options (header, left)
$strategic_objective_list->ListOptions->render("header", "left");
?>
<?php if ($strategic_objective_list->LACode->Visible) { // LACode ?>
	<?php if ($strategic_objective_list->SortUrl($strategic_objective_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $strategic_objective_list->LACode->headerCellClass() ?>"><div id="elh_strategic_objective_LACode" class="strategic_objective_LACode"><div class="ew-table-header-caption"><?php echo $strategic_objective_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $strategic_objective_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $strategic_objective_list->SortUrl($strategic_objective_list->LACode) ?>', 1);"><div id="elh_strategic_objective_LACode" class="strategic_objective_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $strategic_objective_list->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($strategic_objective_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($strategic_objective_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($strategic_objective_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($strategic_objective_list->SortUrl($strategic_objective_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $strategic_objective_list->DepartmentCode->headerCellClass() ?>"><div id="elh_strategic_objective_DepartmentCode" class="strategic_objective_DepartmentCode"><div class="ew-table-header-caption"><?php echo $strategic_objective_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $strategic_objective_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $strategic_objective_list->SortUrl($strategic_objective_list->DepartmentCode) ?>', 1);"><div id="elh_strategic_objective_DepartmentCode" class="strategic_objective_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $strategic_objective_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($strategic_objective_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($strategic_objective_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($strategic_objective_list->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
	<?php if ($strategic_objective_list->SortUrl($strategic_objective_list->StrategicObjectiveCode) == "") { ?>
		<th data-name="StrategicObjectiveCode" class="<?php echo $strategic_objective_list->StrategicObjectiveCode->headerCellClass() ?>"><div id="elh_strategic_objective_StrategicObjectiveCode" class="strategic_objective_StrategicObjectiveCode"><div class="ew-table-header-caption"><?php echo $strategic_objective_list->StrategicObjectiveCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StrategicObjectiveCode" class="<?php echo $strategic_objective_list->StrategicObjectiveCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $strategic_objective_list->SortUrl($strategic_objective_list->StrategicObjectiveCode) ?>', 1);"><div id="elh_strategic_objective_StrategicObjectiveCode" class="strategic_objective_StrategicObjectiveCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $strategic_objective_list->StrategicObjectiveCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($strategic_objective_list->StrategicObjectiveCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($strategic_objective_list->StrategicObjectiveCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($strategic_objective_list->StrategicObjectiveName->Visible) { // StrategicObjectiveName ?>
	<?php if ($strategic_objective_list->SortUrl($strategic_objective_list->StrategicObjectiveName) == "") { ?>
		<th data-name="StrategicObjectiveName" class="<?php echo $strategic_objective_list->StrategicObjectiveName->headerCellClass() ?>"><div id="elh_strategic_objective_StrategicObjectiveName" class="strategic_objective_StrategicObjectiveName"><div class="ew-table-header-caption"><?php echo $strategic_objective_list->StrategicObjectiveName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StrategicObjectiveName" class="<?php echo $strategic_objective_list->StrategicObjectiveName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $strategic_objective_list->SortUrl($strategic_objective_list->StrategicObjectiveName) ?>', 1);"><div id="elh_strategic_objective_StrategicObjectiveName" class="strategic_objective_StrategicObjectiveName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $strategic_objective_list->StrategicObjectiveName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($strategic_objective_list->StrategicObjectiveName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($strategic_objective_list->StrategicObjectiveName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($strategic_objective_list->ReferencedDocs->Visible) { // ReferencedDocs ?>
	<?php if ($strategic_objective_list->SortUrl($strategic_objective_list->ReferencedDocs) == "") { ?>
		<th data-name="ReferencedDocs" class="<?php echo $strategic_objective_list->ReferencedDocs->headerCellClass() ?>"><div id="elh_strategic_objective_ReferencedDocs" class="strategic_objective_ReferencedDocs"><div class="ew-table-header-caption"><?php echo $strategic_objective_list->ReferencedDocs->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReferencedDocs" class="<?php echo $strategic_objective_list->ReferencedDocs->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $strategic_objective_list->SortUrl($strategic_objective_list->ReferencedDocs) ?>', 1);"><div id="elh_strategic_objective_ReferencedDocs" class="strategic_objective_ReferencedDocs">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $strategic_objective_list->ReferencedDocs->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($strategic_objective_list->ReferencedDocs->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($strategic_objective_list->ReferencedDocs->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($strategic_objective_list->ResultAreaCode->Visible) { // ResultAreaCode ?>
	<?php if ($strategic_objective_list->SortUrl($strategic_objective_list->ResultAreaCode) == "") { ?>
		<th data-name="ResultAreaCode" class="<?php echo $strategic_objective_list->ResultAreaCode->headerCellClass() ?>"><div id="elh_strategic_objective_ResultAreaCode" class="strategic_objective_ResultAreaCode"><div class="ew-table-header-caption"><?php echo $strategic_objective_list->ResultAreaCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ResultAreaCode" class="<?php echo $strategic_objective_list->ResultAreaCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $strategic_objective_list->SortUrl($strategic_objective_list->ResultAreaCode) ?>', 1);"><div id="elh_strategic_objective_ResultAreaCode" class="strategic_objective_ResultAreaCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $strategic_objective_list->ResultAreaCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($strategic_objective_list->ResultAreaCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($strategic_objective_list->ResultAreaCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$strategic_objective_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($strategic_objective_list->ExportAll && $strategic_objective_list->isExport()) {
	$strategic_objective_list->StopRecord = $strategic_objective_list->TotalRecords;
} else {

	// Set the last record to display
	if ($strategic_objective_list->TotalRecords > $strategic_objective_list->StartRecord + $strategic_objective_list->DisplayRecords - 1)
		$strategic_objective_list->StopRecord = $strategic_objective_list->StartRecord + $strategic_objective_list->DisplayRecords - 1;
	else
		$strategic_objective_list->StopRecord = $strategic_objective_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($strategic_objective->isConfirm() || $strategic_objective_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($strategic_objective_list->FormKeyCountName) && ($strategic_objective_list->isGridAdd() || $strategic_objective_list->isGridEdit() || $strategic_objective->isConfirm())) {
		$strategic_objective_list->KeyCount = $CurrentForm->getValue($strategic_objective_list->FormKeyCountName);
		$strategic_objective_list->StopRecord = $strategic_objective_list->StartRecord + $strategic_objective_list->KeyCount - 1;
	}
}
$strategic_objective_list->RecordCount = $strategic_objective_list->StartRecord - 1;
if ($strategic_objective_list->Recordset && !$strategic_objective_list->Recordset->EOF) {
	$strategic_objective_list->Recordset->moveFirst();
	$selectLimit = $strategic_objective_list->UseSelectLimit;
	if (!$selectLimit && $strategic_objective_list->StartRecord > 1)
		$strategic_objective_list->Recordset->move($strategic_objective_list->StartRecord - 1);
} elseif (!$strategic_objective->AllowAddDeleteRow && $strategic_objective_list->StopRecord == 0) {
	$strategic_objective_list->StopRecord = $strategic_objective->GridAddRowCount;
}

// Initialize aggregate
$strategic_objective->RowType = ROWTYPE_AGGREGATEINIT;
$strategic_objective->resetAttributes();
$strategic_objective_list->renderRow();
if ($strategic_objective_list->isGridAdd())
	$strategic_objective_list->RowIndex = 0;
if ($strategic_objective_list->isGridEdit())
	$strategic_objective_list->RowIndex = 0;
while ($strategic_objective_list->RecordCount < $strategic_objective_list->StopRecord) {
	$strategic_objective_list->RecordCount++;
	if ($strategic_objective_list->RecordCount >= $strategic_objective_list->StartRecord) {
		$strategic_objective_list->RowCount++;
		if ($strategic_objective_list->isGridAdd() || $strategic_objective_list->isGridEdit() || $strategic_objective->isConfirm()) {
			$strategic_objective_list->RowIndex++;
			$CurrentForm->Index = $strategic_objective_list->RowIndex;
			if ($CurrentForm->hasValue($strategic_objective_list->FormActionName) && ($strategic_objective->isConfirm() || $strategic_objective_list->EventCancelled))
				$strategic_objective_list->RowAction = strval($CurrentForm->getValue($strategic_objective_list->FormActionName));
			elseif ($strategic_objective_list->isGridAdd())
				$strategic_objective_list->RowAction = "insert";
			else
				$strategic_objective_list->RowAction = "";
		}

		// Set up key count
		$strategic_objective_list->KeyCount = $strategic_objective_list->RowIndex;

		// Init row class and style
		$strategic_objective->resetAttributes();
		$strategic_objective->CssClass = "";
		if ($strategic_objective_list->isGridAdd()) {
			$strategic_objective_list->loadRowValues(); // Load default values
		} else {
			$strategic_objective_list->loadRowValues($strategic_objective_list->Recordset); // Load row values
		}
		$strategic_objective->RowType = ROWTYPE_VIEW; // Render view
		if ($strategic_objective_list->isGridAdd()) // Grid add
			$strategic_objective->RowType = ROWTYPE_ADD; // Render add
		if ($strategic_objective_list->isGridAdd() && $strategic_objective->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$strategic_objective_list->restoreCurrentRowFormValues($strategic_objective_list->RowIndex); // Restore form values
		if ($strategic_objective_list->isGridEdit()) { // Grid edit
			if ($strategic_objective->EventCancelled)
				$strategic_objective_list->restoreCurrentRowFormValues($strategic_objective_list->RowIndex); // Restore form values
			if ($strategic_objective_list->RowAction == "insert")
				$strategic_objective->RowType = ROWTYPE_ADD; // Render add
			else
				$strategic_objective->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($strategic_objective_list->isGridEdit() && ($strategic_objective->RowType == ROWTYPE_EDIT || $strategic_objective->RowType == ROWTYPE_ADD) && $strategic_objective->EventCancelled) // Update failed
			$strategic_objective_list->restoreCurrentRowFormValues($strategic_objective_list->RowIndex); // Restore form values
		if ($strategic_objective->RowType == ROWTYPE_EDIT) // Edit row
			$strategic_objective_list->EditRowCount++;

		// Set up row id / data-rowindex
		$strategic_objective->RowAttrs->merge(["data-rowindex" => $strategic_objective_list->RowCount, "id" => "r" . $strategic_objective_list->RowCount . "_strategic_objective", "data-rowtype" => $strategic_objective->RowType]);

		// Render row
		$strategic_objective_list->renderRow();

		// Render list options
		$strategic_objective_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($strategic_objective_list->RowAction != "delete" && $strategic_objective_list->RowAction != "insertdelete" && !($strategic_objective_list->RowAction == "insert" && $strategic_objective->isConfirm() && $strategic_objective_list->emptyRow())) {
?>
	<tr <?php echo $strategic_objective->rowAttributes() ?>>
<?php

// Render list options (body, left)
$strategic_objective_list->ListOptions->render("body", "left", $strategic_objective_list->RowCount);
?>
	<?php if ($strategic_objective_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $strategic_objective_list->LACode->cellAttributes() ?>>
<?php if ($strategic_objective->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($strategic_objective_list->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $strategic_objective_list->RowCount ?>_strategic_objective_LACode" class="form-group">
<span<?php echo $strategic_objective_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($strategic_objective_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $strategic_objective_list->RowIndex ?>_LACode" name="x<?php echo $strategic_objective_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($strategic_objective_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $strategic_objective_list->RowCount ?>_strategic_objective_LACode" class="form-group">
<?php $strategic_objective_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $strategic_objective_list->RowIndex ?>_LACode"><?php echo EmptyValue(strval($strategic_objective_list->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $strategic_objective_list->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($strategic_objective_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($strategic_objective_list->LACode->ReadOnly || $strategic_objective_list->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $strategic_objective_list->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $strategic_objective_list->LACode->Lookup->getParamTag($strategic_objective_list, "p_x" . $strategic_objective_list->RowIndex . "_LACode") ?>
<input type="hidden" data-table="strategic_objective" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $strategic_objective_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $strategic_objective_list->RowIndex ?>_LACode" id="x<?php echo $strategic_objective_list->RowIndex ?>_LACode" value="<?php echo $strategic_objective_list->LACode->CurrentValue ?>"<?php echo $strategic_objective_list->LACode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="strategic_objective" data-field="x_LACode" name="o<?php echo $strategic_objective_list->RowIndex ?>_LACode" id="o<?php echo $strategic_objective_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($strategic_objective_list->LACode->OldValue) ?>">
<?php } ?>
<?php if ($strategic_objective->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($strategic_objective_list->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $strategic_objective_list->RowCount ?>_strategic_objective_LACode" class="form-group">
<span<?php echo $strategic_objective_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($strategic_objective_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $strategic_objective_list->RowIndex ?>_LACode" name="x<?php echo $strategic_objective_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($strategic_objective_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $strategic_objective_list->RowCount ?>_strategic_objective_LACode" class="form-group">
<?php $strategic_objective_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $strategic_objective_list->RowIndex ?>_LACode"><?php echo EmptyValue(strval($strategic_objective_list->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $strategic_objective_list->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($strategic_objective_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($strategic_objective_list->LACode->ReadOnly || $strategic_objective_list->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $strategic_objective_list->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $strategic_objective_list->LACode->Lookup->getParamTag($strategic_objective_list, "p_x" . $strategic_objective_list->RowIndex . "_LACode") ?>
<input type="hidden" data-table="strategic_objective" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $strategic_objective_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $strategic_objective_list->RowIndex ?>_LACode" id="x<?php echo $strategic_objective_list->RowIndex ?>_LACode" value="<?php echo $strategic_objective_list->LACode->CurrentValue ?>"<?php echo $strategic_objective_list->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($strategic_objective->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $strategic_objective_list->RowCount ?>_strategic_objective_LACode">
<span<?php echo $strategic_objective_list->LACode->viewAttributes() ?>><?php echo $strategic_objective_list->LACode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($strategic_objective_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $strategic_objective_list->DepartmentCode->cellAttributes() ?>>
<?php if ($strategic_objective->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $strategic_objective_list->RowCount ?>_strategic_objective_DepartmentCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="strategic_objective" data-field="x_DepartmentCode" data-value-separator="<?php echo $strategic_objective_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $strategic_objective_list->RowIndex ?>_DepartmentCode" name="x<?php echo $strategic_objective_list->RowIndex ?>_DepartmentCode"<?php echo $strategic_objective_list->DepartmentCode->editAttributes() ?>>
			<?php echo $strategic_objective_list->DepartmentCode->selectOptionListHtml("x{$strategic_objective_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $strategic_objective_list->DepartmentCode->Lookup->getParamTag($strategic_objective_list, "p_x" . $strategic_objective_list->RowIndex . "_DepartmentCode") ?>
</span>
<input type="hidden" data-table="strategic_objective" data-field="x_DepartmentCode" name="o<?php echo $strategic_objective_list->RowIndex ?>_DepartmentCode" id="o<?php echo $strategic_objective_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($strategic_objective_list->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($strategic_objective->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $strategic_objective_list->RowCount ?>_strategic_objective_DepartmentCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="strategic_objective" data-field="x_DepartmentCode" data-value-separator="<?php echo $strategic_objective_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $strategic_objective_list->RowIndex ?>_DepartmentCode" name="x<?php echo $strategic_objective_list->RowIndex ?>_DepartmentCode"<?php echo $strategic_objective_list->DepartmentCode->editAttributes() ?>>
			<?php echo $strategic_objective_list->DepartmentCode->selectOptionListHtml("x{$strategic_objective_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $strategic_objective_list->DepartmentCode->Lookup->getParamTag($strategic_objective_list, "p_x" . $strategic_objective_list->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php if ($strategic_objective->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $strategic_objective_list->RowCount ?>_strategic_objective_DepartmentCode">
<span<?php echo $strategic_objective_list->DepartmentCode->viewAttributes() ?>><?php echo $strategic_objective_list->DepartmentCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($strategic_objective_list->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
		<td data-name="StrategicObjectiveCode" <?php echo $strategic_objective_list->StrategicObjectiveCode->cellAttributes() ?>>
<?php if ($strategic_objective->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $strategic_objective_list->RowCount ?>_strategic_objective_StrategicObjectiveCode" class="form-group"></span>
<input type="hidden" data-table="strategic_objective" data-field="x_StrategicObjectiveCode" name="o<?php echo $strategic_objective_list->RowIndex ?>_StrategicObjectiveCode" id="o<?php echo $strategic_objective_list->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($strategic_objective_list->StrategicObjectiveCode->OldValue) ?>">
<?php } ?>
<?php if ($strategic_objective->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $strategic_objective_list->RowCount ?>_strategic_objective_StrategicObjectiveCode" class="form-group">
<span<?php echo $strategic_objective_list->StrategicObjectiveCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($strategic_objective_list->StrategicObjectiveCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="strategic_objective" data-field="x_StrategicObjectiveCode" name="x<?php echo $strategic_objective_list->RowIndex ?>_StrategicObjectiveCode" id="x<?php echo $strategic_objective_list->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($strategic_objective_list->StrategicObjectiveCode->CurrentValue) ?>">
<?php } ?>
<?php if ($strategic_objective->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $strategic_objective_list->RowCount ?>_strategic_objective_StrategicObjectiveCode">
<span<?php echo $strategic_objective_list->StrategicObjectiveCode->viewAttributes() ?>><?php echo $strategic_objective_list->StrategicObjectiveCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($strategic_objective_list->StrategicObjectiveName->Visible) { // StrategicObjectiveName ?>
		<td data-name="StrategicObjectiveName" <?php echo $strategic_objective_list->StrategicObjectiveName->cellAttributes() ?>>
<?php if ($strategic_objective->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $strategic_objective_list->RowCount ?>_strategic_objective_StrategicObjectiveName" class="form-group">
<textarea data-table="strategic_objective" data-field="x_StrategicObjectiveName" name="x<?php echo $strategic_objective_list->RowIndex ?>_StrategicObjectiveName" id="x<?php echo $strategic_objective_list->RowIndex ?>_StrategicObjectiveName" cols="50" rows="2" placeholder="<?php echo HtmlEncode($strategic_objective_list->StrategicObjectiveName->getPlaceHolder()) ?>"<?php echo $strategic_objective_list->StrategicObjectiveName->editAttributes() ?>><?php echo $strategic_objective_list->StrategicObjectiveName->EditValue ?></textarea>
</span>
<input type="hidden" data-table="strategic_objective" data-field="x_StrategicObjectiveName" name="o<?php echo $strategic_objective_list->RowIndex ?>_StrategicObjectiveName" id="o<?php echo $strategic_objective_list->RowIndex ?>_StrategicObjectiveName" value="<?php echo HtmlEncode($strategic_objective_list->StrategicObjectiveName->OldValue) ?>">
<?php } ?>
<?php if ($strategic_objective->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $strategic_objective_list->RowCount ?>_strategic_objective_StrategicObjectiveName" class="form-group">
<textarea data-table="strategic_objective" data-field="x_StrategicObjectiveName" name="x<?php echo $strategic_objective_list->RowIndex ?>_StrategicObjectiveName" id="x<?php echo $strategic_objective_list->RowIndex ?>_StrategicObjectiveName" cols="50" rows="2" placeholder="<?php echo HtmlEncode($strategic_objective_list->StrategicObjectiveName->getPlaceHolder()) ?>"<?php echo $strategic_objective_list->StrategicObjectiveName->editAttributes() ?>><?php echo $strategic_objective_list->StrategicObjectiveName->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($strategic_objective->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $strategic_objective_list->RowCount ?>_strategic_objective_StrategicObjectiveName">
<span<?php echo $strategic_objective_list->StrategicObjectiveName->viewAttributes() ?>><?php echo $strategic_objective_list->StrategicObjectiveName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($strategic_objective_list->ReferencedDocs->Visible) { // ReferencedDocs ?>
		<td data-name="ReferencedDocs" <?php echo $strategic_objective_list->ReferencedDocs->cellAttributes() ?>>
<?php if ($strategic_objective->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $strategic_objective_list->RowCount ?>_strategic_objective_ReferencedDocs" class="form-group">
<textarea data-table="strategic_objective" data-field="x_ReferencedDocs" name="x<?php echo $strategic_objective_list->RowIndex ?>_ReferencedDocs" id="x<?php echo $strategic_objective_list->RowIndex ?>_ReferencedDocs" cols="50" rows="2" placeholder="<?php echo HtmlEncode($strategic_objective_list->ReferencedDocs->getPlaceHolder()) ?>"<?php echo $strategic_objective_list->ReferencedDocs->editAttributes() ?>><?php echo $strategic_objective_list->ReferencedDocs->EditValue ?></textarea>
</span>
<input type="hidden" data-table="strategic_objective" data-field="x_ReferencedDocs" name="o<?php echo $strategic_objective_list->RowIndex ?>_ReferencedDocs" id="o<?php echo $strategic_objective_list->RowIndex ?>_ReferencedDocs" value="<?php echo HtmlEncode($strategic_objective_list->ReferencedDocs->OldValue) ?>">
<?php } ?>
<?php if ($strategic_objective->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $strategic_objective_list->RowCount ?>_strategic_objective_ReferencedDocs" class="form-group">
<textarea data-table="strategic_objective" data-field="x_ReferencedDocs" name="x<?php echo $strategic_objective_list->RowIndex ?>_ReferencedDocs" id="x<?php echo $strategic_objective_list->RowIndex ?>_ReferencedDocs" cols="50" rows="2" placeholder="<?php echo HtmlEncode($strategic_objective_list->ReferencedDocs->getPlaceHolder()) ?>"<?php echo $strategic_objective_list->ReferencedDocs->editAttributes() ?>><?php echo $strategic_objective_list->ReferencedDocs->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($strategic_objective->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $strategic_objective_list->RowCount ?>_strategic_objective_ReferencedDocs">
<span<?php echo $strategic_objective_list->ReferencedDocs->viewAttributes() ?>><?php echo $strategic_objective_list->ReferencedDocs->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($strategic_objective_list->ResultAreaCode->Visible) { // ResultAreaCode ?>
		<td data-name="ResultAreaCode" <?php echo $strategic_objective_list->ResultAreaCode->cellAttributes() ?>>
<?php if ($strategic_objective->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $strategic_objective_list->RowCount ?>_strategic_objective_ResultAreaCode" class="form-group">
<input type="text" data-table="strategic_objective" data-field="x_ResultAreaCode" name="x<?php echo $strategic_objective_list->RowIndex ?>_ResultAreaCode" id="x<?php echo $strategic_objective_list->RowIndex ?>_ResultAreaCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($strategic_objective_list->ResultAreaCode->getPlaceHolder()) ?>" value="<?php echo $strategic_objective_list->ResultAreaCode->EditValue ?>"<?php echo $strategic_objective_list->ResultAreaCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="strategic_objective" data-field="x_ResultAreaCode" name="o<?php echo $strategic_objective_list->RowIndex ?>_ResultAreaCode" id="o<?php echo $strategic_objective_list->RowIndex ?>_ResultAreaCode" value="<?php echo HtmlEncode($strategic_objective_list->ResultAreaCode->OldValue) ?>">
<?php } ?>
<?php if ($strategic_objective->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $strategic_objective_list->RowCount ?>_strategic_objective_ResultAreaCode" class="form-group">
<input type="text" data-table="strategic_objective" data-field="x_ResultAreaCode" name="x<?php echo $strategic_objective_list->RowIndex ?>_ResultAreaCode" id="x<?php echo $strategic_objective_list->RowIndex ?>_ResultAreaCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($strategic_objective_list->ResultAreaCode->getPlaceHolder()) ?>" value="<?php echo $strategic_objective_list->ResultAreaCode->EditValue ?>"<?php echo $strategic_objective_list->ResultAreaCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($strategic_objective->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $strategic_objective_list->RowCount ?>_strategic_objective_ResultAreaCode">
<span<?php echo $strategic_objective_list->ResultAreaCode->viewAttributes() ?>><?php echo $strategic_objective_list->ResultAreaCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$strategic_objective_list->ListOptions->render("body", "right", $strategic_objective_list->RowCount);
?>
	</tr>
<?php if ($strategic_objective->RowType == ROWTYPE_ADD || $strategic_objective->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fstrategic_objectivelist", "load"], function() {
	fstrategic_objectivelist.updateLists(<?php echo $strategic_objective_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$strategic_objective_list->isGridAdd())
		if (!$strategic_objective_list->Recordset->EOF)
			$strategic_objective_list->Recordset->moveNext();
}
?>
<?php
	if ($strategic_objective_list->isGridAdd() || $strategic_objective_list->isGridEdit()) {
		$strategic_objective_list->RowIndex = '$rowindex$';
		$strategic_objective_list->loadRowValues();

		// Set row properties
		$strategic_objective->resetAttributes();
		$strategic_objective->RowAttrs->merge(["data-rowindex" => $strategic_objective_list->RowIndex, "id" => "r0_strategic_objective", "data-rowtype" => ROWTYPE_ADD]);
		$strategic_objective->RowAttrs->appendClass("ew-template");
		$strategic_objective->RowType = ROWTYPE_ADD;

		// Render row
		$strategic_objective_list->renderRow();

		// Render list options
		$strategic_objective_list->renderListOptions();
		$strategic_objective_list->StartRowCount = 0;
?>
	<tr <?php echo $strategic_objective->rowAttributes() ?>>
<?php

// Render list options (body, left)
$strategic_objective_list->ListOptions->render("body", "left", $strategic_objective_list->RowIndex);
?>
	<?php if ($strategic_objective_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if ($strategic_objective_list->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_strategic_objective_LACode" class="form-group strategic_objective_LACode">
<span<?php echo $strategic_objective_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($strategic_objective_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $strategic_objective_list->RowIndex ?>_LACode" name="x<?php echo $strategic_objective_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($strategic_objective_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_strategic_objective_LACode" class="form-group strategic_objective_LACode">
<?php $strategic_objective_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $strategic_objective_list->RowIndex ?>_LACode"><?php echo EmptyValue(strval($strategic_objective_list->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $strategic_objective_list->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($strategic_objective_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($strategic_objective_list->LACode->ReadOnly || $strategic_objective_list->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $strategic_objective_list->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $strategic_objective_list->LACode->Lookup->getParamTag($strategic_objective_list, "p_x" . $strategic_objective_list->RowIndex . "_LACode") ?>
<input type="hidden" data-table="strategic_objective" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $strategic_objective_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $strategic_objective_list->RowIndex ?>_LACode" id="x<?php echo $strategic_objective_list->RowIndex ?>_LACode" value="<?php echo $strategic_objective_list->LACode->CurrentValue ?>"<?php echo $strategic_objective_list->LACode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="strategic_objective" data-field="x_LACode" name="o<?php echo $strategic_objective_list->RowIndex ?>_LACode" id="o<?php echo $strategic_objective_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($strategic_objective_list->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($strategic_objective_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<span id="el$rowindex$_strategic_objective_DepartmentCode" class="form-group strategic_objective_DepartmentCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="strategic_objective" data-field="x_DepartmentCode" data-value-separator="<?php echo $strategic_objective_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $strategic_objective_list->RowIndex ?>_DepartmentCode" name="x<?php echo $strategic_objective_list->RowIndex ?>_DepartmentCode"<?php echo $strategic_objective_list->DepartmentCode->editAttributes() ?>>
			<?php echo $strategic_objective_list->DepartmentCode->selectOptionListHtml("x{$strategic_objective_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $strategic_objective_list->DepartmentCode->Lookup->getParamTag($strategic_objective_list, "p_x" . $strategic_objective_list->RowIndex . "_DepartmentCode") ?>
</span>
<input type="hidden" data-table="strategic_objective" data-field="x_DepartmentCode" name="o<?php echo $strategic_objective_list->RowIndex ?>_DepartmentCode" id="o<?php echo $strategic_objective_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($strategic_objective_list->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($strategic_objective_list->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
		<td data-name="StrategicObjectiveCode">
<span id="el$rowindex$_strategic_objective_StrategicObjectiveCode" class="form-group strategic_objective_StrategicObjectiveCode"></span>
<input type="hidden" data-table="strategic_objective" data-field="x_StrategicObjectiveCode" name="o<?php echo $strategic_objective_list->RowIndex ?>_StrategicObjectiveCode" id="o<?php echo $strategic_objective_list->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($strategic_objective_list->StrategicObjectiveCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($strategic_objective_list->StrategicObjectiveName->Visible) { // StrategicObjectiveName ?>
		<td data-name="StrategicObjectiveName">
<span id="el$rowindex$_strategic_objective_StrategicObjectiveName" class="form-group strategic_objective_StrategicObjectiveName">
<textarea data-table="strategic_objective" data-field="x_StrategicObjectiveName" name="x<?php echo $strategic_objective_list->RowIndex ?>_StrategicObjectiveName" id="x<?php echo $strategic_objective_list->RowIndex ?>_StrategicObjectiveName" cols="50" rows="2" placeholder="<?php echo HtmlEncode($strategic_objective_list->StrategicObjectiveName->getPlaceHolder()) ?>"<?php echo $strategic_objective_list->StrategicObjectiveName->editAttributes() ?>><?php echo $strategic_objective_list->StrategicObjectiveName->EditValue ?></textarea>
</span>
<input type="hidden" data-table="strategic_objective" data-field="x_StrategicObjectiveName" name="o<?php echo $strategic_objective_list->RowIndex ?>_StrategicObjectiveName" id="o<?php echo $strategic_objective_list->RowIndex ?>_StrategicObjectiveName" value="<?php echo HtmlEncode($strategic_objective_list->StrategicObjectiveName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($strategic_objective_list->ReferencedDocs->Visible) { // ReferencedDocs ?>
		<td data-name="ReferencedDocs">
<span id="el$rowindex$_strategic_objective_ReferencedDocs" class="form-group strategic_objective_ReferencedDocs">
<textarea data-table="strategic_objective" data-field="x_ReferencedDocs" name="x<?php echo $strategic_objective_list->RowIndex ?>_ReferencedDocs" id="x<?php echo $strategic_objective_list->RowIndex ?>_ReferencedDocs" cols="50" rows="2" placeholder="<?php echo HtmlEncode($strategic_objective_list->ReferencedDocs->getPlaceHolder()) ?>"<?php echo $strategic_objective_list->ReferencedDocs->editAttributes() ?>><?php echo $strategic_objective_list->ReferencedDocs->EditValue ?></textarea>
</span>
<input type="hidden" data-table="strategic_objective" data-field="x_ReferencedDocs" name="o<?php echo $strategic_objective_list->RowIndex ?>_ReferencedDocs" id="o<?php echo $strategic_objective_list->RowIndex ?>_ReferencedDocs" value="<?php echo HtmlEncode($strategic_objective_list->ReferencedDocs->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($strategic_objective_list->ResultAreaCode->Visible) { // ResultAreaCode ?>
		<td data-name="ResultAreaCode">
<span id="el$rowindex$_strategic_objective_ResultAreaCode" class="form-group strategic_objective_ResultAreaCode">
<input type="text" data-table="strategic_objective" data-field="x_ResultAreaCode" name="x<?php echo $strategic_objective_list->RowIndex ?>_ResultAreaCode" id="x<?php echo $strategic_objective_list->RowIndex ?>_ResultAreaCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($strategic_objective_list->ResultAreaCode->getPlaceHolder()) ?>" value="<?php echo $strategic_objective_list->ResultAreaCode->EditValue ?>"<?php echo $strategic_objective_list->ResultAreaCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="strategic_objective" data-field="x_ResultAreaCode" name="o<?php echo $strategic_objective_list->RowIndex ?>_ResultAreaCode" id="o<?php echo $strategic_objective_list->RowIndex ?>_ResultAreaCode" value="<?php echo HtmlEncode($strategic_objective_list->ResultAreaCode->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$strategic_objective_list->ListOptions->render("body", "right", $strategic_objective_list->RowIndex);
?>
<script>
loadjs.ready(["fstrategic_objectivelist", "load"], function() {
	fstrategic_objectivelist.updateLists(<?php echo $strategic_objective_list->RowIndex ?>);
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
<?php if ($strategic_objective_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $strategic_objective_list->FormKeyCountName ?>" id="<?php echo $strategic_objective_list->FormKeyCountName ?>" value="<?php echo $strategic_objective_list->KeyCount ?>">
<?php echo $strategic_objective_list->MultiSelectKey ?>
<?php } ?>
<?php if ($strategic_objective_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $strategic_objective_list->FormKeyCountName ?>" id="<?php echo $strategic_objective_list->FormKeyCountName ?>" value="<?php echo $strategic_objective_list->KeyCount ?>">
<?php echo $strategic_objective_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$strategic_objective->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($strategic_objective_list->Recordset)
	$strategic_objective_list->Recordset->Close();
?>
<?php if (!$strategic_objective_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$strategic_objective_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $strategic_objective_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $strategic_objective_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($strategic_objective_list->TotalRecords == 0 && !$strategic_objective->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $strategic_objective_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$strategic_objective_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$strategic_objective_list->isExport()) { ?>
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
$strategic_objective_list->terminate();
?>