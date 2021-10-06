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
$outcome_list = new outcome_list();

// Run the page
$outcome_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$outcome_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$outcome_list->isExport()) { ?>
<script>
var foutcomelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	foutcomelist = currentForm = new ew.Form("foutcomelist", "list");
	foutcomelist.formKeyCountName = '<?php echo $outcome_list->FormKeyCountName ?>';

	// Validate form
	foutcomelist.validate = function() {
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
			<?php if ($outcome_list->OutcomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_list->OutcomeCode->caption(), $outcome_list->OutcomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_list->OutcomeName->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_list->OutcomeName->caption(), $outcome_list->OutcomeName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_list->StrategicObjectiveCode->Required) { ?>
				elm = this.getElements("x" + infix + "_StrategicObjectiveCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_list->StrategicObjectiveCode->caption(), $outcome_list->StrategicObjectiveCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StrategicObjectiveCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($outcome_list->StrategicObjectiveCode->errorMessage()) ?>");
			<?php if ($outcome_list->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_list->LACode->caption(), $outcome_list->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_list->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_list->DepartmentCode->caption(), $outcome_list->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_list->OutcomeKPI->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeKPI");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_list->OutcomeKPI->caption(), $outcome_list->OutcomeKPI->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_list->Assumptions->Required) { ?>
				elm = this.getElements("x" + infix + "_Assumptions");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_list->Assumptions->caption(), $outcome_list->Assumptions->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_list->ResponsibleOfficer->Required) { ?>
				elm = this.getElements("x" + infix + "_ResponsibleOfficer");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_list->ResponsibleOfficer->caption(), $outcome_list->ResponsibleOfficer->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_list->OutcomeStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_list->OutcomeStatus->caption(), $outcome_list->OutcomeStatus->RequiredErrorMessage)) ?>");
			<?php } ?>

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
	foutcomelist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "OutcomeName", false)) return false;
		if (ew.valueChanged(fobj, infix, "StrategicObjectiveCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutcomeKPI", false)) return false;
		if (ew.valueChanged(fobj, infix, "Assumptions", false)) return false;
		if (ew.valueChanged(fobj, infix, "ResponsibleOfficer", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutcomeStatus", false)) return false;
		return true;
	}

	// Form_CustomValidate
	foutcomelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	foutcomelist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	foutcomelist.lists["x_StrategicObjectiveCode"] = <?php echo $outcome_list->StrategicObjectiveCode->Lookup->toClientList($outcome_list) ?>;
	foutcomelist.lists["x_StrategicObjectiveCode"].options = <?php echo JsonEncode($outcome_list->StrategicObjectiveCode->lookupOptions()) ?>;
	foutcomelist.autoSuggests["x_StrategicObjectiveCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutcomelist.lists["x_LACode"] = <?php echo $outcome_list->LACode->Lookup->toClientList($outcome_list) ?>;
	foutcomelist.lists["x_LACode"].options = <?php echo JsonEncode($outcome_list->LACode->lookupOptions()) ?>;
	foutcomelist.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutcomelist.lists["x_DepartmentCode"] = <?php echo $outcome_list->DepartmentCode->Lookup->toClientList($outcome_list) ?>;
	foutcomelist.lists["x_DepartmentCode"].options = <?php echo JsonEncode($outcome_list->DepartmentCode->lookupOptions()) ?>;
	foutcomelist.lists["x_OutcomeStatus"] = <?php echo $outcome_list->OutcomeStatus->Lookup->toClientList($outcome_list) ?>;
	foutcomelist.lists["x_OutcomeStatus"].options = <?php echo JsonEncode($outcome_list->OutcomeStatus->lookupOptions()) ?>;
	loadjs.done("foutcomelist");
});
var foutcomelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	foutcomelistsrch = currentSearchForm = new ew.Form("foutcomelistsrch");

	// Dynamic selection lists
	// Filters

	foutcomelistsrch.filterList = <?php echo $outcome_list->getFilterList() ?>;

	// Init search panel as collapsed
	foutcomelistsrch.initSearchPanel = true;
	loadjs.done("foutcomelistsrch");
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
<?php if (!$outcome_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($outcome_list->TotalRecords > 0 && $outcome_list->ExportOptions->visible()) { ?>
<?php $outcome_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($outcome_list->ImportOptions->visible()) { ?>
<?php $outcome_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($outcome_list->SearchOptions->visible()) { ?>
<?php $outcome_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($outcome_list->FilterOptions->visible()) { ?>
<?php $outcome_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$outcome_list->isExport() || Config("EXPORT_MASTER_RECORD") && $outcome_list->isExport("print")) { ?>
<?php
if ($outcome_list->DbMasterFilter != "" && $outcome->getCurrentMasterTable() == "strategic_objective") {
	if ($outcome_list->MasterRecordExists) {
		include_once "strategic_objectivemaster.php";
	}
}
?>
<?php } ?>
<?php
$outcome_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$outcome_list->isExport() && !$outcome->CurrentAction) { ?>
<form name="foutcomelistsrch" id="foutcomelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="foutcomelistsrch-search-panel" class="<?php echo $outcome_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="outcome">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $outcome_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($outcome_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($outcome_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $outcome_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($outcome_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($outcome_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($outcome_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($outcome_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $outcome_list->showPageHeader(); ?>
<?php
$outcome_list->showMessage();
?>
<?php if ($outcome_list->TotalRecords > 0 || $outcome->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($outcome_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> outcome">
<?php if (!$outcome_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$outcome_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $outcome_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $outcome_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="foutcomelist" id="foutcomelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="outcome">
<?php if ($outcome->getCurrentMasterTable() == "strategic_objective" && $outcome->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="strategic_objective">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($outcome_list->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_list->StrategicObjectiveCode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_outcome" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($outcome_list->TotalRecords > 0 || $outcome_list->isGridEdit()) { ?>
<table id="tbl_outcomelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$outcome->RowType = ROWTYPE_HEADER;

// Render list options
$outcome_list->renderListOptions();

// Render list options (header, left)
$outcome_list->ListOptions->render("header", "left");
?>
<?php if ($outcome_list->OutcomeCode->Visible) { // OutcomeCode ?>
	<?php if ($outcome_list->SortUrl($outcome_list->OutcomeCode) == "") { ?>
		<th data-name="OutcomeCode" class="<?php echo $outcome_list->OutcomeCode->headerCellClass() ?>"><div id="elh_outcome_OutcomeCode" class="outcome_OutcomeCode"><div class="ew-table-header-caption"><?php echo $outcome_list->OutcomeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutcomeCode" class="<?php echo $outcome_list->OutcomeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $outcome_list->SortUrl($outcome_list->OutcomeCode) ?>', 1);"><div id="elh_outcome_OutcomeCode" class="outcome_OutcomeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_list->OutcomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($outcome_list->OutcomeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_list->OutcomeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($outcome_list->OutcomeName->Visible) { // OutcomeName ?>
	<?php if ($outcome_list->SortUrl($outcome_list->OutcomeName) == "") { ?>
		<th data-name="OutcomeName" class="<?php echo $outcome_list->OutcomeName->headerCellClass() ?>"><div id="elh_outcome_OutcomeName" class="outcome_OutcomeName"><div class="ew-table-header-caption"><?php echo $outcome_list->OutcomeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutcomeName" class="<?php echo $outcome_list->OutcomeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $outcome_list->SortUrl($outcome_list->OutcomeName) ?>', 1);"><div id="elh_outcome_OutcomeName" class="outcome_OutcomeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_list->OutcomeName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($outcome_list->OutcomeName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_list->OutcomeName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($outcome_list->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
	<?php if ($outcome_list->SortUrl($outcome_list->StrategicObjectiveCode) == "") { ?>
		<th data-name="StrategicObjectiveCode" class="<?php echo $outcome_list->StrategicObjectiveCode->headerCellClass() ?>"><div id="elh_outcome_StrategicObjectiveCode" class="outcome_StrategicObjectiveCode"><div class="ew-table-header-caption"><?php echo $outcome_list->StrategicObjectiveCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StrategicObjectiveCode" class="<?php echo $outcome_list->StrategicObjectiveCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $outcome_list->SortUrl($outcome_list->StrategicObjectiveCode) ?>', 1);"><div id="elh_outcome_StrategicObjectiveCode" class="outcome_StrategicObjectiveCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_list->StrategicObjectiveCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($outcome_list->StrategicObjectiveCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_list->StrategicObjectiveCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($outcome_list->LACode->Visible) { // LACode ?>
	<?php if ($outcome_list->SortUrl($outcome_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $outcome_list->LACode->headerCellClass() ?>"><div id="elh_outcome_LACode" class="outcome_LACode"><div class="ew-table-header-caption"><?php echo $outcome_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $outcome_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $outcome_list->SortUrl($outcome_list->LACode) ?>', 1);"><div id="elh_outcome_LACode" class="outcome_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_list->LACode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($outcome_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($outcome_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($outcome_list->SortUrl($outcome_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $outcome_list->DepartmentCode->headerCellClass() ?>"><div id="elh_outcome_DepartmentCode" class="outcome_DepartmentCode"><div class="ew-table-header-caption"><?php echo $outcome_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $outcome_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $outcome_list->SortUrl($outcome_list->DepartmentCode) ?>', 1);"><div id="elh_outcome_DepartmentCode" class="outcome_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($outcome_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($outcome_list->OutcomeKPI->Visible) { // OutcomeKPI ?>
	<?php if ($outcome_list->SortUrl($outcome_list->OutcomeKPI) == "") { ?>
		<th data-name="OutcomeKPI" class="<?php echo $outcome_list->OutcomeKPI->headerCellClass() ?>"><div id="elh_outcome_OutcomeKPI" class="outcome_OutcomeKPI"><div class="ew-table-header-caption"><?php echo $outcome_list->OutcomeKPI->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutcomeKPI" class="<?php echo $outcome_list->OutcomeKPI->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $outcome_list->SortUrl($outcome_list->OutcomeKPI) ?>', 1);"><div id="elh_outcome_OutcomeKPI" class="outcome_OutcomeKPI">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_list->OutcomeKPI->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($outcome_list->OutcomeKPI->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_list->OutcomeKPI->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($outcome_list->Assumptions->Visible) { // Assumptions ?>
	<?php if ($outcome_list->SortUrl($outcome_list->Assumptions) == "") { ?>
		<th data-name="Assumptions" class="<?php echo $outcome_list->Assumptions->headerCellClass() ?>"><div id="elh_outcome_Assumptions" class="outcome_Assumptions"><div class="ew-table-header-caption"><?php echo $outcome_list->Assumptions->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Assumptions" class="<?php echo $outcome_list->Assumptions->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $outcome_list->SortUrl($outcome_list->Assumptions) ?>', 1);"><div id="elh_outcome_Assumptions" class="outcome_Assumptions">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_list->Assumptions->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($outcome_list->Assumptions->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_list->Assumptions->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($outcome_list->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
	<?php if ($outcome_list->SortUrl($outcome_list->ResponsibleOfficer) == "") { ?>
		<th data-name="ResponsibleOfficer" class="<?php echo $outcome_list->ResponsibleOfficer->headerCellClass() ?>"><div id="elh_outcome_ResponsibleOfficer" class="outcome_ResponsibleOfficer"><div class="ew-table-header-caption"><?php echo $outcome_list->ResponsibleOfficer->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ResponsibleOfficer" class="<?php echo $outcome_list->ResponsibleOfficer->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $outcome_list->SortUrl($outcome_list->ResponsibleOfficer) ?>', 1);"><div id="elh_outcome_ResponsibleOfficer" class="outcome_ResponsibleOfficer">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_list->ResponsibleOfficer->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($outcome_list->ResponsibleOfficer->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_list->ResponsibleOfficer->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($outcome_list->OutcomeStatus->Visible) { // OutcomeStatus ?>
	<?php if ($outcome_list->SortUrl($outcome_list->OutcomeStatus) == "") { ?>
		<th data-name="OutcomeStatus" class="<?php echo $outcome_list->OutcomeStatus->headerCellClass() ?>"><div id="elh_outcome_OutcomeStatus" class="outcome_OutcomeStatus"><div class="ew-table-header-caption"><?php echo $outcome_list->OutcomeStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutcomeStatus" class="<?php echo $outcome_list->OutcomeStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $outcome_list->SortUrl($outcome_list->OutcomeStatus) ?>', 1);"><div id="elh_outcome_OutcomeStatus" class="outcome_OutcomeStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_list->OutcomeStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($outcome_list->OutcomeStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_list->OutcomeStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$outcome_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($outcome_list->ExportAll && $outcome_list->isExport()) {
	$outcome_list->StopRecord = $outcome_list->TotalRecords;
} else {

	// Set the last record to display
	if ($outcome_list->TotalRecords > $outcome_list->StartRecord + $outcome_list->DisplayRecords - 1)
		$outcome_list->StopRecord = $outcome_list->StartRecord + $outcome_list->DisplayRecords - 1;
	else
		$outcome_list->StopRecord = $outcome_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($outcome->isConfirm() || $outcome_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($outcome_list->FormKeyCountName) && ($outcome_list->isGridAdd() || $outcome_list->isGridEdit() || $outcome->isConfirm())) {
		$outcome_list->KeyCount = $CurrentForm->getValue($outcome_list->FormKeyCountName);
		$outcome_list->StopRecord = $outcome_list->StartRecord + $outcome_list->KeyCount - 1;
	}
}
$outcome_list->RecordCount = $outcome_list->StartRecord - 1;
if ($outcome_list->Recordset && !$outcome_list->Recordset->EOF) {
	$outcome_list->Recordset->moveFirst();
	$selectLimit = $outcome_list->UseSelectLimit;
	if (!$selectLimit && $outcome_list->StartRecord > 1)
		$outcome_list->Recordset->move($outcome_list->StartRecord - 1);
} elseif (!$outcome->AllowAddDeleteRow && $outcome_list->StopRecord == 0) {
	$outcome_list->StopRecord = $outcome->GridAddRowCount;
}

// Initialize aggregate
$outcome->RowType = ROWTYPE_AGGREGATEINIT;
$outcome->resetAttributes();
$outcome_list->renderRow();
if ($outcome_list->isGridAdd())
	$outcome_list->RowIndex = 0;
if ($outcome_list->isGridEdit())
	$outcome_list->RowIndex = 0;
while ($outcome_list->RecordCount < $outcome_list->StopRecord) {
	$outcome_list->RecordCount++;
	if ($outcome_list->RecordCount >= $outcome_list->StartRecord) {
		$outcome_list->RowCount++;
		if ($outcome_list->isGridAdd() || $outcome_list->isGridEdit() || $outcome->isConfirm()) {
			$outcome_list->RowIndex++;
			$CurrentForm->Index = $outcome_list->RowIndex;
			if ($CurrentForm->hasValue($outcome_list->FormActionName) && ($outcome->isConfirm() || $outcome_list->EventCancelled))
				$outcome_list->RowAction = strval($CurrentForm->getValue($outcome_list->FormActionName));
			elseif ($outcome_list->isGridAdd())
				$outcome_list->RowAction = "insert";
			else
				$outcome_list->RowAction = "";
		}

		// Set up key count
		$outcome_list->KeyCount = $outcome_list->RowIndex;

		// Init row class and style
		$outcome->resetAttributes();
		$outcome->CssClass = "";
		if ($outcome_list->isGridAdd()) {
			$outcome_list->loadRowValues(); // Load default values
		} else {
			$outcome_list->loadRowValues($outcome_list->Recordset); // Load row values
		}
		$outcome->RowType = ROWTYPE_VIEW; // Render view
		if ($outcome_list->isGridAdd()) // Grid add
			$outcome->RowType = ROWTYPE_ADD; // Render add
		if ($outcome_list->isGridAdd() && $outcome->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$outcome_list->restoreCurrentRowFormValues($outcome_list->RowIndex); // Restore form values
		if ($outcome_list->isGridEdit()) { // Grid edit
			if ($outcome->EventCancelled)
				$outcome_list->restoreCurrentRowFormValues($outcome_list->RowIndex); // Restore form values
			if ($outcome_list->RowAction == "insert")
				$outcome->RowType = ROWTYPE_ADD; // Render add
			else
				$outcome->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($outcome_list->isGridEdit() && ($outcome->RowType == ROWTYPE_EDIT || $outcome->RowType == ROWTYPE_ADD) && $outcome->EventCancelled) // Update failed
			$outcome_list->restoreCurrentRowFormValues($outcome_list->RowIndex); // Restore form values
		if ($outcome->RowType == ROWTYPE_EDIT) // Edit row
			$outcome_list->EditRowCount++;

		// Set up row id / data-rowindex
		$outcome->RowAttrs->merge(["data-rowindex" => $outcome_list->RowCount, "id" => "r" . $outcome_list->RowCount . "_outcome", "data-rowtype" => $outcome->RowType]);

		// Render row
		$outcome_list->renderRow();

		// Render list options
		$outcome_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($outcome_list->RowAction != "delete" && $outcome_list->RowAction != "insertdelete" && !($outcome_list->RowAction == "insert" && $outcome->isConfirm() && $outcome_list->emptyRow())) {
?>
	<tr <?php echo $outcome->rowAttributes() ?>>
<?php

// Render list options (body, left)
$outcome_list->ListOptions->render("body", "left", $outcome_list->RowCount);
?>
	<?php if ($outcome_list->OutcomeCode->Visible) { // OutcomeCode ?>
		<td data-name="OutcomeCode" <?php echo $outcome_list->OutcomeCode->cellAttributes() ?>>
<?php if ($outcome->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_OutcomeCode" class="form-group"></span>
<input type="hidden" data-table="outcome" data-field="x_OutcomeCode" name="o<?php echo $outcome_list->RowIndex ?>_OutcomeCode" id="o<?php echo $outcome_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($outcome_list->OutcomeCode->OldValue) ?>">
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_OutcomeCode" class="form-group">
<span<?php echo $outcome_list->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_list->OutcomeCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="outcome" data-field="x_OutcomeCode" name="x<?php echo $outcome_list->RowIndex ?>_OutcomeCode" id="x<?php echo $outcome_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($outcome_list->OutcomeCode->CurrentValue) ?>">
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_OutcomeCode">
<span<?php echo $outcome_list->OutcomeCode->viewAttributes() ?>><?php echo $outcome_list->OutcomeCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($outcome_list->OutcomeName->Visible) { // OutcomeName ?>
		<td data-name="OutcomeName" <?php echo $outcome_list->OutcomeName->cellAttributes() ?>>
<?php if ($outcome->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_OutcomeName" class="form-group">
<textarea data-table="outcome" data-field="x_OutcomeName" name="x<?php echo $outcome_list->RowIndex ?>_OutcomeName" id="x<?php echo $outcome_list->RowIndex ?>_OutcomeName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($outcome_list->OutcomeName->getPlaceHolder()) ?>"<?php echo $outcome_list->OutcomeName->editAttributes() ?>><?php echo $outcome_list->OutcomeName->EditValue ?></textarea>
</span>
<input type="hidden" data-table="outcome" data-field="x_OutcomeName" name="o<?php echo $outcome_list->RowIndex ?>_OutcomeName" id="o<?php echo $outcome_list->RowIndex ?>_OutcomeName" value="<?php echo HtmlEncode($outcome_list->OutcomeName->OldValue) ?>">
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_OutcomeName" class="form-group">
<textarea data-table="outcome" data-field="x_OutcomeName" name="x<?php echo $outcome_list->RowIndex ?>_OutcomeName" id="x<?php echo $outcome_list->RowIndex ?>_OutcomeName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($outcome_list->OutcomeName->getPlaceHolder()) ?>"<?php echo $outcome_list->OutcomeName->editAttributes() ?>><?php echo $outcome_list->OutcomeName->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_OutcomeName">
<span<?php echo $outcome_list->OutcomeName->viewAttributes() ?>><?php echo $outcome_list->OutcomeName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($outcome_list->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
		<td data-name="StrategicObjectiveCode" <?php echo $outcome_list->StrategicObjectiveCode->cellAttributes() ?>>
<?php if ($outcome->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($outcome_list->StrategicObjectiveCode->getSessionValue() != "") { ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_StrategicObjectiveCode" class="form-group">
<span<?php echo $outcome_list->StrategicObjectiveCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_list->StrategicObjectiveCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode" name="x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_list->StrategicObjectiveCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_StrategicObjectiveCode" class="form-group">
<?php
$onchange = $outcome_list->StrategicObjectiveCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$outcome_list->StrategicObjectiveCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode" id="sv_x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode" value="<?php echo RemoveHtml($outcome_list->StrategicObjectiveCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($outcome_list->StrategicObjectiveCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($outcome_list->StrategicObjectiveCode->getPlaceHolder()) ?>"<?php echo $outcome_list->StrategicObjectiveCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_list->StrategicObjectiveCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_list->StrategicObjectiveCode->ReadOnly || $outcome_list->StrategicObjectiveCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="outcome" data-field="x_StrategicObjectiveCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_list->StrategicObjectiveCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode" id="x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_list->StrategicObjectiveCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutcomelist"], function() {
	foutcomelist.createAutoSuggest({"id":"x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode","forceSelect":true});
});
</script>
<?php echo $outcome_list->StrategicObjectiveCode->Lookup->getParamTag($outcome_list, "p_x" . $outcome_list->RowIndex . "_StrategicObjectiveCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="outcome" data-field="x_StrategicObjectiveCode" name="o<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode" id="o<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_list->StrategicObjectiveCode->OldValue) ?>">
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($outcome_list->StrategicObjectiveCode->getSessionValue() != "") { ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_StrategicObjectiveCode" class="form-group">
<span<?php echo $outcome_list->StrategicObjectiveCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_list->StrategicObjectiveCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode" name="x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_list->StrategicObjectiveCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_StrategicObjectiveCode" class="form-group">
<?php
$onchange = $outcome_list->StrategicObjectiveCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$outcome_list->StrategicObjectiveCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode" id="sv_x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode" value="<?php echo RemoveHtml($outcome_list->StrategicObjectiveCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($outcome_list->StrategicObjectiveCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($outcome_list->StrategicObjectiveCode->getPlaceHolder()) ?>"<?php echo $outcome_list->StrategicObjectiveCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_list->StrategicObjectiveCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_list->StrategicObjectiveCode->ReadOnly || $outcome_list->StrategicObjectiveCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="outcome" data-field="x_StrategicObjectiveCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_list->StrategicObjectiveCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode" id="x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_list->StrategicObjectiveCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutcomelist"], function() {
	foutcomelist.createAutoSuggest({"id":"x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode","forceSelect":true});
});
</script>
<?php echo $outcome_list->StrategicObjectiveCode->Lookup->getParamTag($outcome_list, "p_x" . $outcome_list->RowIndex . "_StrategicObjectiveCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_StrategicObjectiveCode">
<span<?php echo $outcome_list->StrategicObjectiveCode->viewAttributes() ?>><?php echo $outcome_list->StrategicObjectiveCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($outcome_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $outcome_list->LACode->cellAttributes() ?>>
<?php if ($outcome->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($outcome_list->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_LACode" class="form-group">
<span<?php echo $outcome_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $outcome_list->RowIndex ?>_LACode" name="x<?php echo $outcome_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($outcome_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_LACode" class="form-group">
<?php
$onchange = $outcome_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$outcome_list->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $outcome_list->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $outcome_list->RowIndex ?>_LACode" id="sv_x<?php echo $outcome_list->RowIndex ?>_LACode" value="<?php echo RemoveHtml($outcome_list->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($outcome_list->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($outcome_list->LACode->getPlaceHolder()) ?>"<?php echo $outcome_list->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $outcome_list->RowIndex ?>_LACode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_list->LACode->ReadOnly || $outcome_list->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="outcome" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $outcome_list->RowIndex ?>_LACode" id="x<?php echo $outcome_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($outcome_list->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutcomelist"], function() {
	foutcomelist.createAutoSuggest({"id":"x<?php echo $outcome_list->RowIndex ?>_LACode","forceSelect":true});
});
</script>
<?php echo $outcome_list->LACode->Lookup->getParamTag($outcome_list, "p_x" . $outcome_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="outcome" data-field="x_LACode" name="o<?php echo $outcome_list->RowIndex ?>_LACode" id="o<?php echo $outcome_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($outcome_list->LACode->OldValue) ?>">
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($outcome_list->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_LACode" class="form-group">
<span<?php echo $outcome_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $outcome_list->RowIndex ?>_LACode" name="x<?php echo $outcome_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($outcome_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_LACode" class="form-group">
<?php
$onchange = $outcome_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$outcome_list->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $outcome_list->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $outcome_list->RowIndex ?>_LACode" id="sv_x<?php echo $outcome_list->RowIndex ?>_LACode" value="<?php echo RemoveHtml($outcome_list->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($outcome_list->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($outcome_list->LACode->getPlaceHolder()) ?>"<?php echo $outcome_list->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $outcome_list->RowIndex ?>_LACode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_list->LACode->ReadOnly || $outcome_list->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="outcome" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $outcome_list->RowIndex ?>_LACode" id="x<?php echo $outcome_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($outcome_list->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutcomelist"], function() {
	foutcomelist.createAutoSuggest({"id":"x<?php echo $outcome_list->RowIndex ?>_LACode","forceSelect":true});
});
</script>
<?php echo $outcome_list->LACode->Lookup->getParamTag($outcome_list, "p_x" . $outcome_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_LACode">
<span<?php echo $outcome_list->LACode->viewAttributes() ?>><?php echo $outcome_list->LACode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($outcome_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $outcome_list->DepartmentCode->cellAttributes() ?>>
<?php if ($outcome->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_DepartmentCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $outcome_list->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($outcome_list->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $outcome_list->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_list->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_list->DepartmentCode->ReadOnly || $outcome_list->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $outcome_list->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $outcome_list->DepartmentCode->Lookup->getParamTag($outcome_list, "p_x" . $outcome_list->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="outcome" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_list->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $outcome_list->RowIndex ?>_DepartmentCode" id="x<?php echo $outcome_list->RowIndex ?>_DepartmentCode" value="<?php echo $outcome_list->DepartmentCode->CurrentValue ?>"<?php echo $outcome_list->DepartmentCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="outcome" data-field="x_DepartmentCode" name="o<?php echo $outcome_list->RowIndex ?>_DepartmentCode" id="o<?php echo $outcome_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($outcome_list->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_DepartmentCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $outcome_list->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($outcome_list->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $outcome_list->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_list->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_list->DepartmentCode->ReadOnly || $outcome_list->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $outcome_list->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $outcome_list->DepartmentCode->Lookup->getParamTag($outcome_list, "p_x" . $outcome_list->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="outcome" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_list->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $outcome_list->RowIndex ?>_DepartmentCode" id="x<?php echo $outcome_list->RowIndex ?>_DepartmentCode" value="<?php echo $outcome_list->DepartmentCode->CurrentValue ?>"<?php echo $outcome_list->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_DepartmentCode">
<span<?php echo $outcome_list->DepartmentCode->viewAttributes() ?>><?php echo $outcome_list->DepartmentCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($outcome_list->OutcomeKPI->Visible) { // OutcomeKPI ?>
		<td data-name="OutcomeKPI" <?php echo $outcome_list->OutcomeKPI->cellAttributes() ?>>
<?php if ($outcome->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_OutcomeKPI" class="form-group">
<textarea data-table="outcome" data-field="x_OutcomeKPI" name="x<?php echo $outcome_list->RowIndex ?>_OutcomeKPI" id="x<?php echo $outcome_list->RowIndex ?>_OutcomeKPI" cols="50" rows="2" placeholder="<?php echo HtmlEncode($outcome_list->OutcomeKPI->getPlaceHolder()) ?>"<?php echo $outcome_list->OutcomeKPI->editAttributes() ?>><?php echo $outcome_list->OutcomeKPI->EditValue ?></textarea>
</span>
<input type="hidden" data-table="outcome" data-field="x_OutcomeKPI" name="o<?php echo $outcome_list->RowIndex ?>_OutcomeKPI" id="o<?php echo $outcome_list->RowIndex ?>_OutcomeKPI" value="<?php echo HtmlEncode($outcome_list->OutcomeKPI->OldValue) ?>">
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_OutcomeKPI" class="form-group">
<textarea data-table="outcome" data-field="x_OutcomeKPI" name="x<?php echo $outcome_list->RowIndex ?>_OutcomeKPI" id="x<?php echo $outcome_list->RowIndex ?>_OutcomeKPI" cols="50" rows="2" placeholder="<?php echo HtmlEncode($outcome_list->OutcomeKPI->getPlaceHolder()) ?>"<?php echo $outcome_list->OutcomeKPI->editAttributes() ?>><?php echo $outcome_list->OutcomeKPI->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_OutcomeKPI">
<span<?php echo $outcome_list->OutcomeKPI->viewAttributes() ?>><?php echo $outcome_list->OutcomeKPI->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($outcome_list->Assumptions->Visible) { // Assumptions ?>
		<td data-name="Assumptions" <?php echo $outcome_list->Assumptions->cellAttributes() ?>>
<?php if ($outcome->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_Assumptions" class="form-group">
<textarea data-table="outcome" data-field="x_Assumptions" name="x<?php echo $outcome_list->RowIndex ?>_Assumptions" id="x<?php echo $outcome_list->RowIndex ?>_Assumptions" cols="50" rows="2" placeholder="<?php echo HtmlEncode($outcome_list->Assumptions->getPlaceHolder()) ?>"<?php echo $outcome_list->Assumptions->editAttributes() ?>><?php echo $outcome_list->Assumptions->EditValue ?></textarea>
</span>
<input type="hidden" data-table="outcome" data-field="x_Assumptions" name="o<?php echo $outcome_list->RowIndex ?>_Assumptions" id="o<?php echo $outcome_list->RowIndex ?>_Assumptions" value="<?php echo HtmlEncode($outcome_list->Assumptions->OldValue) ?>">
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_Assumptions" class="form-group">
<textarea data-table="outcome" data-field="x_Assumptions" name="x<?php echo $outcome_list->RowIndex ?>_Assumptions" id="x<?php echo $outcome_list->RowIndex ?>_Assumptions" cols="50" rows="2" placeholder="<?php echo HtmlEncode($outcome_list->Assumptions->getPlaceHolder()) ?>"<?php echo $outcome_list->Assumptions->editAttributes() ?>><?php echo $outcome_list->Assumptions->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_Assumptions">
<span<?php echo $outcome_list->Assumptions->viewAttributes() ?>><?php echo $outcome_list->Assumptions->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($outcome_list->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
		<td data-name="ResponsibleOfficer" <?php echo $outcome_list->ResponsibleOfficer->cellAttributes() ?>>
<?php if ($outcome->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_ResponsibleOfficer" class="form-group">
<input type="text" data-table="outcome" data-field="x_ResponsibleOfficer" name="x<?php echo $outcome_list->RowIndex ?>_ResponsibleOfficer" id="x<?php echo $outcome_list->RowIndex ?>_ResponsibleOfficer" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($outcome_list->ResponsibleOfficer->getPlaceHolder()) ?>" value="<?php echo $outcome_list->ResponsibleOfficer->EditValue ?>"<?php echo $outcome_list->ResponsibleOfficer->editAttributes() ?>>
</span>
<input type="hidden" data-table="outcome" data-field="x_ResponsibleOfficer" name="o<?php echo $outcome_list->RowIndex ?>_ResponsibleOfficer" id="o<?php echo $outcome_list->RowIndex ?>_ResponsibleOfficer" value="<?php echo HtmlEncode($outcome_list->ResponsibleOfficer->OldValue) ?>">
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_ResponsibleOfficer" class="form-group">
<input type="text" data-table="outcome" data-field="x_ResponsibleOfficer" name="x<?php echo $outcome_list->RowIndex ?>_ResponsibleOfficer" id="x<?php echo $outcome_list->RowIndex ?>_ResponsibleOfficer" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($outcome_list->ResponsibleOfficer->getPlaceHolder()) ?>" value="<?php echo $outcome_list->ResponsibleOfficer->EditValue ?>"<?php echo $outcome_list->ResponsibleOfficer->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_ResponsibleOfficer">
<span<?php echo $outcome_list->ResponsibleOfficer->viewAttributes() ?>><?php echo $outcome_list->ResponsibleOfficer->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($outcome_list->OutcomeStatus->Visible) { // OutcomeStatus ?>
		<td data-name="OutcomeStatus" <?php echo $outcome_list->OutcomeStatus->cellAttributes() ?>>
<?php if ($outcome->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_OutcomeStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="outcome" data-field="x_OutcomeStatus" data-value-separator="<?php echo $outcome_list->OutcomeStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $outcome_list->RowIndex ?>_OutcomeStatus" name="x<?php echo $outcome_list->RowIndex ?>_OutcomeStatus"<?php echo $outcome_list->OutcomeStatus->editAttributes() ?>>
			<?php echo $outcome_list->OutcomeStatus->selectOptionListHtml("x{$outcome_list->RowIndex}_OutcomeStatus") ?>
		</select>
</div>
<?php echo $outcome_list->OutcomeStatus->Lookup->getParamTag($outcome_list, "p_x" . $outcome_list->RowIndex . "_OutcomeStatus") ?>
</span>
<input type="hidden" data-table="outcome" data-field="x_OutcomeStatus" name="o<?php echo $outcome_list->RowIndex ?>_OutcomeStatus" id="o<?php echo $outcome_list->RowIndex ?>_OutcomeStatus" value="<?php echo HtmlEncode($outcome_list->OutcomeStatus->OldValue) ?>">
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_OutcomeStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="outcome" data-field="x_OutcomeStatus" data-value-separator="<?php echo $outcome_list->OutcomeStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $outcome_list->RowIndex ?>_OutcomeStatus" name="x<?php echo $outcome_list->RowIndex ?>_OutcomeStatus"<?php echo $outcome_list->OutcomeStatus->editAttributes() ?>>
			<?php echo $outcome_list->OutcomeStatus->selectOptionListHtml("x{$outcome_list->RowIndex}_OutcomeStatus") ?>
		</select>
</div>
<?php echo $outcome_list->OutcomeStatus->Lookup->getParamTag($outcome_list, "p_x" . $outcome_list->RowIndex . "_OutcomeStatus") ?>
</span>
<?php } ?>
<?php if ($outcome->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $outcome_list->RowCount ?>_outcome_OutcomeStatus">
<span<?php echo $outcome_list->OutcomeStatus->viewAttributes() ?>><?php echo $outcome_list->OutcomeStatus->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$outcome_list->ListOptions->render("body", "right", $outcome_list->RowCount);
?>
	</tr>
<?php if ($outcome->RowType == ROWTYPE_ADD || $outcome->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["foutcomelist", "load"], function() {
	foutcomelist.updateLists(<?php echo $outcome_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$outcome_list->isGridAdd())
		if (!$outcome_list->Recordset->EOF)
			$outcome_list->Recordset->moveNext();
}
?>
<?php
	if ($outcome_list->isGridAdd() || $outcome_list->isGridEdit()) {
		$outcome_list->RowIndex = '$rowindex$';
		$outcome_list->loadRowValues();

		// Set row properties
		$outcome->resetAttributes();
		$outcome->RowAttrs->merge(["data-rowindex" => $outcome_list->RowIndex, "id" => "r0_outcome", "data-rowtype" => ROWTYPE_ADD]);
		$outcome->RowAttrs->appendClass("ew-template");
		$outcome->RowType = ROWTYPE_ADD;

		// Render row
		$outcome_list->renderRow();

		// Render list options
		$outcome_list->renderListOptions();
		$outcome_list->StartRowCount = 0;
?>
	<tr <?php echo $outcome->rowAttributes() ?>>
<?php

// Render list options (body, left)
$outcome_list->ListOptions->render("body", "left", $outcome_list->RowIndex);
?>
	<?php if ($outcome_list->OutcomeCode->Visible) { // OutcomeCode ?>
		<td data-name="OutcomeCode">
<span id="el$rowindex$_outcome_OutcomeCode" class="form-group outcome_OutcomeCode"></span>
<input type="hidden" data-table="outcome" data-field="x_OutcomeCode" name="o<?php echo $outcome_list->RowIndex ?>_OutcomeCode" id="o<?php echo $outcome_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($outcome_list->OutcomeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($outcome_list->OutcomeName->Visible) { // OutcomeName ?>
		<td data-name="OutcomeName">
<span id="el$rowindex$_outcome_OutcomeName" class="form-group outcome_OutcomeName">
<textarea data-table="outcome" data-field="x_OutcomeName" name="x<?php echo $outcome_list->RowIndex ?>_OutcomeName" id="x<?php echo $outcome_list->RowIndex ?>_OutcomeName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($outcome_list->OutcomeName->getPlaceHolder()) ?>"<?php echo $outcome_list->OutcomeName->editAttributes() ?>><?php echo $outcome_list->OutcomeName->EditValue ?></textarea>
</span>
<input type="hidden" data-table="outcome" data-field="x_OutcomeName" name="o<?php echo $outcome_list->RowIndex ?>_OutcomeName" id="o<?php echo $outcome_list->RowIndex ?>_OutcomeName" value="<?php echo HtmlEncode($outcome_list->OutcomeName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($outcome_list->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
		<td data-name="StrategicObjectiveCode">
<?php if ($outcome_list->StrategicObjectiveCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_outcome_StrategicObjectiveCode" class="form-group outcome_StrategicObjectiveCode">
<span<?php echo $outcome_list->StrategicObjectiveCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_list->StrategicObjectiveCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode" name="x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_list->StrategicObjectiveCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_outcome_StrategicObjectiveCode" class="form-group outcome_StrategicObjectiveCode">
<?php
$onchange = $outcome_list->StrategicObjectiveCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$outcome_list->StrategicObjectiveCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode" id="sv_x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode" value="<?php echo RemoveHtml($outcome_list->StrategicObjectiveCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($outcome_list->StrategicObjectiveCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($outcome_list->StrategicObjectiveCode->getPlaceHolder()) ?>"<?php echo $outcome_list->StrategicObjectiveCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_list->StrategicObjectiveCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_list->StrategicObjectiveCode->ReadOnly || $outcome_list->StrategicObjectiveCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="outcome" data-field="x_StrategicObjectiveCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_list->StrategicObjectiveCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode" id="x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_list->StrategicObjectiveCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutcomelist"], function() {
	foutcomelist.createAutoSuggest({"id":"x<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode","forceSelect":true});
});
</script>
<?php echo $outcome_list->StrategicObjectiveCode->Lookup->getParamTag($outcome_list, "p_x" . $outcome_list->RowIndex . "_StrategicObjectiveCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="outcome" data-field="x_StrategicObjectiveCode" name="o<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode" id="o<?php echo $outcome_list->RowIndex ?>_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_list->StrategicObjectiveCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($outcome_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if ($outcome_list->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_outcome_LACode" class="form-group outcome_LACode">
<span<?php echo $outcome_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $outcome_list->RowIndex ?>_LACode" name="x<?php echo $outcome_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($outcome_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_outcome_LACode" class="form-group outcome_LACode">
<?php
$onchange = $outcome_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$outcome_list->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $outcome_list->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $outcome_list->RowIndex ?>_LACode" id="sv_x<?php echo $outcome_list->RowIndex ?>_LACode" value="<?php echo RemoveHtml($outcome_list->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($outcome_list->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($outcome_list->LACode->getPlaceHolder()) ?>"<?php echo $outcome_list->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $outcome_list->RowIndex ?>_LACode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_list->LACode->ReadOnly || $outcome_list->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="outcome" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $outcome_list->RowIndex ?>_LACode" id="x<?php echo $outcome_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($outcome_list->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutcomelist"], function() {
	foutcomelist.createAutoSuggest({"id":"x<?php echo $outcome_list->RowIndex ?>_LACode","forceSelect":true});
});
</script>
<?php echo $outcome_list->LACode->Lookup->getParamTag($outcome_list, "p_x" . $outcome_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="outcome" data-field="x_LACode" name="o<?php echo $outcome_list->RowIndex ?>_LACode" id="o<?php echo $outcome_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($outcome_list->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($outcome_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<span id="el$rowindex$_outcome_DepartmentCode" class="form-group outcome_DepartmentCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $outcome_list->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($outcome_list->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $outcome_list->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_list->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_list->DepartmentCode->ReadOnly || $outcome_list->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $outcome_list->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $outcome_list->DepartmentCode->Lookup->getParamTag($outcome_list, "p_x" . $outcome_list->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="outcome" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_list->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $outcome_list->RowIndex ?>_DepartmentCode" id="x<?php echo $outcome_list->RowIndex ?>_DepartmentCode" value="<?php echo $outcome_list->DepartmentCode->CurrentValue ?>"<?php echo $outcome_list->DepartmentCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="outcome" data-field="x_DepartmentCode" name="o<?php echo $outcome_list->RowIndex ?>_DepartmentCode" id="o<?php echo $outcome_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($outcome_list->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($outcome_list->OutcomeKPI->Visible) { // OutcomeKPI ?>
		<td data-name="OutcomeKPI">
<span id="el$rowindex$_outcome_OutcomeKPI" class="form-group outcome_OutcomeKPI">
<textarea data-table="outcome" data-field="x_OutcomeKPI" name="x<?php echo $outcome_list->RowIndex ?>_OutcomeKPI" id="x<?php echo $outcome_list->RowIndex ?>_OutcomeKPI" cols="50" rows="2" placeholder="<?php echo HtmlEncode($outcome_list->OutcomeKPI->getPlaceHolder()) ?>"<?php echo $outcome_list->OutcomeKPI->editAttributes() ?>><?php echo $outcome_list->OutcomeKPI->EditValue ?></textarea>
</span>
<input type="hidden" data-table="outcome" data-field="x_OutcomeKPI" name="o<?php echo $outcome_list->RowIndex ?>_OutcomeKPI" id="o<?php echo $outcome_list->RowIndex ?>_OutcomeKPI" value="<?php echo HtmlEncode($outcome_list->OutcomeKPI->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($outcome_list->Assumptions->Visible) { // Assumptions ?>
		<td data-name="Assumptions">
<span id="el$rowindex$_outcome_Assumptions" class="form-group outcome_Assumptions">
<textarea data-table="outcome" data-field="x_Assumptions" name="x<?php echo $outcome_list->RowIndex ?>_Assumptions" id="x<?php echo $outcome_list->RowIndex ?>_Assumptions" cols="50" rows="2" placeholder="<?php echo HtmlEncode($outcome_list->Assumptions->getPlaceHolder()) ?>"<?php echo $outcome_list->Assumptions->editAttributes() ?>><?php echo $outcome_list->Assumptions->EditValue ?></textarea>
</span>
<input type="hidden" data-table="outcome" data-field="x_Assumptions" name="o<?php echo $outcome_list->RowIndex ?>_Assumptions" id="o<?php echo $outcome_list->RowIndex ?>_Assumptions" value="<?php echo HtmlEncode($outcome_list->Assumptions->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($outcome_list->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
		<td data-name="ResponsibleOfficer">
<span id="el$rowindex$_outcome_ResponsibleOfficer" class="form-group outcome_ResponsibleOfficer">
<input type="text" data-table="outcome" data-field="x_ResponsibleOfficer" name="x<?php echo $outcome_list->RowIndex ?>_ResponsibleOfficer" id="x<?php echo $outcome_list->RowIndex ?>_ResponsibleOfficer" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($outcome_list->ResponsibleOfficer->getPlaceHolder()) ?>" value="<?php echo $outcome_list->ResponsibleOfficer->EditValue ?>"<?php echo $outcome_list->ResponsibleOfficer->editAttributes() ?>>
</span>
<input type="hidden" data-table="outcome" data-field="x_ResponsibleOfficer" name="o<?php echo $outcome_list->RowIndex ?>_ResponsibleOfficer" id="o<?php echo $outcome_list->RowIndex ?>_ResponsibleOfficer" value="<?php echo HtmlEncode($outcome_list->ResponsibleOfficer->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($outcome_list->OutcomeStatus->Visible) { // OutcomeStatus ?>
		<td data-name="OutcomeStatus">
<span id="el$rowindex$_outcome_OutcomeStatus" class="form-group outcome_OutcomeStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="outcome" data-field="x_OutcomeStatus" data-value-separator="<?php echo $outcome_list->OutcomeStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $outcome_list->RowIndex ?>_OutcomeStatus" name="x<?php echo $outcome_list->RowIndex ?>_OutcomeStatus"<?php echo $outcome_list->OutcomeStatus->editAttributes() ?>>
			<?php echo $outcome_list->OutcomeStatus->selectOptionListHtml("x{$outcome_list->RowIndex}_OutcomeStatus") ?>
		</select>
</div>
<?php echo $outcome_list->OutcomeStatus->Lookup->getParamTag($outcome_list, "p_x" . $outcome_list->RowIndex . "_OutcomeStatus") ?>
</span>
<input type="hidden" data-table="outcome" data-field="x_OutcomeStatus" name="o<?php echo $outcome_list->RowIndex ?>_OutcomeStatus" id="o<?php echo $outcome_list->RowIndex ?>_OutcomeStatus" value="<?php echo HtmlEncode($outcome_list->OutcomeStatus->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$outcome_list->ListOptions->render("body", "right", $outcome_list->RowIndex);
?>
<script>
loadjs.ready(["foutcomelist", "load"], function() {
	foutcomelist.updateLists(<?php echo $outcome_list->RowIndex ?>);
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
<?php if ($outcome_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $outcome_list->FormKeyCountName ?>" id="<?php echo $outcome_list->FormKeyCountName ?>" value="<?php echo $outcome_list->KeyCount ?>">
<?php echo $outcome_list->MultiSelectKey ?>
<?php } ?>
<?php if ($outcome_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $outcome_list->FormKeyCountName ?>" id="<?php echo $outcome_list->FormKeyCountName ?>" value="<?php echo $outcome_list->KeyCount ?>">
<?php echo $outcome_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$outcome->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($outcome_list->Recordset)
	$outcome_list->Recordset->Close();
?>
<?php if (!$outcome_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$outcome_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $outcome_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $outcome_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($outcome_list->TotalRecords == 0 && !$outcome->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $outcome_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$outcome_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$outcome_list->isExport()) { ?>
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
$outcome_list->terminate();
?>