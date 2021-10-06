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
$activity_list = new activity_list();

// Run the page
$activity_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$activity_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$activity_list->isExport()) { ?>
<script>
var factivitylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	factivitylist = currentForm = new ew.Form("factivitylist", "list");
	factivitylist.formKeyCountName = '<?php echo $activity_list->FormKeyCountName ?>';

	// Validate form
	factivitylist.validate = function() {
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
			<?php if ($activity_list->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_list->LACode->caption(), $activity_list->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_list->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_list->DepartmentCode->caption(), $activity_list->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_list->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_list->SectionCode->caption(), $activity_list->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_list->ProgrammeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgrammeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_list->ProgrammeCode->caption(), $activity_list->ProgrammeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_list->OucomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OucomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_list->OucomeCode->caption(), $activity_list->OucomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_list->OutputCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_list->OutputCode->caption(), $activity_list->OutputCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_list->ProjectCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_list->ProjectCode->caption(), $activity_list->ProjectCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_list->ActivityCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ActivityCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_list->ActivityCode->caption(), $activity_list->ActivityCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_list->FinancialYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_list->FinancialYear->caption(), $activity_list->FinancialYear->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_list->ActivityName->Required) { ?>
				elm = this.getElements("x" + infix + "_ActivityName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_list->ActivityName->caption(), $activity_list->ActivityName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_list->MTEFBudget->Required) { ?>
				elm = this.getElements("x" + infix + "_MTEFBudget");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_list->MTEFBudget->caption(), $activity_list->MTEFBudget->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MTEFBudget");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($activity_list->MTEFBudget->errorMessage()) ?>");
			<?php if ($activity_list->SupplementaryBudget->Required) { ?>
				elm = this.getElements("x" + infix + "_SupplementaryBudget");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_list->SupplementaryBudget->caption(), $activity_list->SupplementaryBudget->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SupplementaryBudget");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($activity_list->SupplementaryBudget->errorMessage()) ?>");
			<?php if ($activity_list->ExpectedAnnualAchievement->Required) { ?>
				elm = this.getElements("x" + infix + "_ExpectedAnnualAchievement");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_list->ExpectedAnnualAchievement->caption(), $activity_list->ExpectedAnnualAchievement->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_list->ActivityLocation->Required) { ?>
				elm = this.getElements("x" + infix + "_ActivityLocation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_list->ActivityLocation->caption(), $activity_list->ActivityLocation->RequiredErrorMessage)) ?>");
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
	factivitylist.emptyRow = function(infix) {
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
	factivitylist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	factivitylist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	factivitylist.lists["x_LACode"] = <?php echo $activity_list->LACode->Lookup->toClientList($activity_list) ?>;
	factivitylist.lists["x_LACode"].options = <?php echo JsonEncode($activity_list->LACode->lookupOptions()) ?>;
	factivitylist.lists["x_DepartmentCode"] = <?php echo $activity_list->DepartmentCode->Lookup->toClientList($activity_list) ?>;
	factivitylist.lists["x_DepartmentCode"].options = <?php echo JsonEncode($activity_list->DepartmentCode->lookupOptions()) ?>;
	factivitylist.lists["x_SectionCode"] = <?php echo $activity_list->SectionCode->Lookup->toClientList($activity_list) ?>;
	factivitylist.lists["x_SectionCode"].options = <?php echo JsonEncode($activity_list->SectionCode->lookupOptions()) ?>;
	factivitylist.lists["x_ProgrammeCode"] = <?php echo $activity_list->ProgrammeCode->Lookup->toClientList($activity_list) ?>;
	factivitylist.lists["x_ProgrammeCode"].options = <?php echo JsonEncode($activity_list->ProgrammeCode->lookupOptions()) ?>;
	factivitylist.autoSuggests["x_ProgrammeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	factivitylist.lists["x_OucomeCode"] = <?php echo $activity_list->OucomeCode->Lookup->toClientList($activity_list) ?>;
	factivitylist.lists["x_OucomeCode"].options = <?php echo JsonEncode($activity_list->OucomeCode->lookupOptions()) ?>;
	factivitylist.lists["x_OutputCode"] = <?php echo $activity_list->OutputCode->Lookup->toClientList($activity_list) ?>;
	factivitylist.lists["x_OutputCode"].options = <?php echo JsonEncode($activity_list->OutputCode->lookupOptions()) ?>;
	factivitylist.lists["x_ProjectCode"] = <?php echo $activity_list->ProjectCode->Lookup->toClientList($activity_list) ?>;
	factivitylist.lists["x_ProjectCode"].options = <?php echo JsonEncode($activity_list->ProjectCode->lookupOptions()) ?>;
	factivitylist.autoSuggests["x_ProjectCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	factivitylist.lists["x_FinancialYear"] = <?php echo $activity_list->FinancialYear->Lookup->toClientList($activity_list) ?>;
	factivitylist.lists["x_FinancialYear"].options = <?php echo JsonEncode($activity_list->FinancialYear->lookupOptions()) ?>;
	loadjs.done("factivitylist");
});
var factivitylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	factivitylistsrch = currentSearchForm = new ew.Form("factivitylistsrch");

	// Dynamic selection lists
	// Filters

	factivitylistsrch.filterList = <?php echo $activity_list->getFilterList() ?>;

	// Init search panel as collapsed
	factivitylistsrch.initSearchPanel = true;
	loadjs.done("factivitylistsrch");
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
<?php if (!$activity_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($activity_list->TotalRecords > 0 && $activity_list->ExportOptions->visible()) { ?>
<?php $activity_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($activity_list->ImportOptions->visible()) { ?>
<?php $activity_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($activity_list->SearchOptions->visible()) { ?>
<?php $activity_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($activity_list->FilterOptions->visible()) { ?>
<?php $activity_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$activity_list->isExport() || Config("EXPORT_MASTER_RECORD") && $activity_list->isExport("print")) { ?>
<?php
if ($activity_list->DbMasterFilter != "" && $activity->getCurrentMasterTable() == "project") {
	if ($activity_list->MasterRecordExists) {
		include_once "projectmaster.php";
	}
}
?>
<?php } ?>
<?php
$activity_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$activity_list->isExport() && !$activity->CurrentAction) { ?>
<form name="factivitylistsrch" id="factivitylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="factivitylistsrch-search-panel" class="<?php echo $activity_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="activity">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $activity_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($activity_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($activity_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $activity_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($activity_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($activity_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($activity_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($activity_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $activity_list->showPageHeader(); ?>
<?php
$activity_list->showMessage();
?>
<?php if ($activity_list->TotalRecords > 0 || $activity->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($activity_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> activity">
<?php if (!$activity_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$activity_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $activity_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $activity_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="factivitylist" id="factivitylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="activity">
<?php if ($activity->getCurrentMasterTable() == "project" && $activity->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="project">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($activity_list->ProvinceCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($activity_list->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($activity_list->DepartmentCode->getSessionValue()) ?>">
<input type="hidden" name="fk_SectionCode" value="<?php echo HtmlEncode($activity_list->SectionCode->getSessionValue()) ?>">
<input type="hidden" name="fk_ProjectCode" value="<?php echo HtmlEncode($activity_list->ProjectCode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_activity" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($activity_list->TotalRecords > 0 || $activity_list->isGridEdit()) { ?>
<table id="tbl_activitylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$activity->RowType = ROWTYPE_HEADER;

// Render list options
$activity_list->renderListOptions();

// Render list options (header, left)
$activity_list->ListOptions->render("header", "left");
?>
<?php if ($activity_list->LACode->Visible) { // LACode ?>
	<?php if ($activity_list->SortUrl($activity_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $activity_list->LACode->headerCellClass() ?>"><div id="elh_activity_LACode" class="activity_LACode"><div class="ew-table-header-caption"><?php echo $activity_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $activity_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $activity_list->SortUrl($activity_list->LACode) ?>', 1);"><div id="elh_activity_LACode" class="activity_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_list->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($activity_list->SortUrl($activity_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $activity_list->DepartmentCode->headerCellClass() ?>"><div id="elh_activity_DepartmentCode" class="activity_DepartmentCode"><div class="ew-table-header-caption"><?php echo $activity_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $activity_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $activity_list->SortUrl($activity_list->DepartmentCode) ?>', 1);"><div id="elh_activity_DepartmentCode" class="activity_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_list->SectionCode->Visible) { // SectionCode ?>
	<?php if ($activity_list->SortUrl($activity_list->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $activity_list->SectionCode->headerCellClass() ?>"><div id="elh_activity_SectionCode" class="activity_SectionCode"><div class="ew-table-header-caption"><?php echo $activity_list->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $activity_list->SectionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $activity_list->SortUrl($activity_list->SectionCode) ?>', 1);"><div id="elh_activity_SectionCode" class="activity_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_list->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_list->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_list->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_list->ProgrammeCode->Visible) { // ProgrammeCode ?>
	<?php if ($activity_list->SortUrl($activity_list->ProgrammeCode) == "") { ?>
		<th data-name="ProgrammeCode" class="<?php echo $activity_list->ProgrammeCode->headerCellClass() ?>"><div id="elh_activity_ProgrammeCode" class="activity_ProgrammeCode"><div class="ew-table-header-caption"><?php echo $activity_list->ProgrammeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgrammeCode" class="<?php echo $activity_list->ProgrammeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $activity_list->SortUrl($activity_list->ProgrammeCode) ?>', 1);"><div id="elh_activity_ProgrammeCode" class="activity_ProgrammeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_list->ProgrammeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_list->ProgrammeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_list->ProgrammeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_list->OucomeCode->Visible) { // OucomeCode ?>
	<?php if ($activity_list->SortUrl($activity_list->OucomeCode) == "") { ?>
		<th data-name="OucomeCode" class="<?php echo $activity_list->OucomeCode->headerCellClass() ?>"><div id="elh_activity_OucomeCode" class="activity_OucomeCode"><div class="ew-table-header-caption"><?php echo $activity_list->OucomeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OucomeCode" class="<?php echo $activity_list->OucomeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $activity_list->SortUrl($activity_list->OucomeCode) ?>', 1);"><div id="elh_activity_OucomeCode" class="activity_OucomeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_list->OucomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_list->OucomeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_list->OucomeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_list->OutputCode->Visible) { // OutputCode ?>
	<?php if ($activity_list->SortUrl($activity_list->OutputCode) == "") { ?>
		<th data-name="OutputCode" class="<?php echo $activity_list->OutputCode->headerCellClass() ?>"><div id="elh_activity_OutputCode" class="activity_OutputCode"><div class="ew-table-header-caption"><?php echo $activity_list->OutputCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputCode" class="<?php echo $activity_list->OutputCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $activity_list->SortUrl($activity_list->OutputCode) ?>', 1);"><div id="elh_activity_OutputCode" class="activity_OutputCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_list->OutputCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_list->OutputCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_list->OutputCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_list->ProjectCode->Visible) { // ProjectCode ?>
	<?php if ($activity_list->SortUrl($activity_list->ProjectCode) == "") { ?>
		<th data-name="ProjectCode" class="<?php echo $activity_list->ProjectCode->headerCellClass() ?>"><div id="elh_activity_ProjectCode" class="activity_ProjectCode"><div class="ew-table-header-caption"><?php echo $activity_list->ProjectCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProjectCode" class="<?php echo $activity_list->ProjectCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $activity_list->SortUrl($activity_list->ProjectCode) ?>', 1);"><div id="elh_activity_ProjectCode" class="activity_ProjectCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_list->ProjectCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($activity_list->ProjectCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_list->ProjectCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_list->ActivityCode->Visible) { // ActivityCode ?>
	<?php if ($activity_list->SortUrl($activity_list->ActivityCode) == "") { ?>
		<th data-name="ActivityCode" class="<?php echo $activity_list->ActivityCode->headerCellClass() ?>"><div id="elh_activity_ActivityCode" class="activity_ActivityCode"><div class="ew-table-header-caption"><?php echo $activity_list->ActivityCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActivityCode" class="<?php echo $activity_list->ActivityCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $activity_list->SortUrl($activity_list->ActivityCode) ?>', 1);"><div id="elh_activity_ActivityCode" class="activity_ActivityCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_list->ActivityCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($activity_list->ActivityCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_list->ActivityCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_list->FinancialYear->Visible) { // FinancialYear ?>
	<?php if ($activity_list->SortUrl($activity_list->FinancialYear) == "") { ?>
		<th data-name="FinancialYear" class="<?php echo $activity_list->FinancialYear->headerCellClass() ?>"><div id="elh_activity_FinancialYear" class="activity_FinancialYear"><div class="ew-table-header-caption"><?php echo $activity_list->FinancialYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FinancialYear" class="<?php echo $activity_list->FinancialYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $activity_list->SortUrl($activity_list->FinancialYear) ?>', 1);"><div id="elh_activity_FinancialYear" class="activity_FinancialYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_list->FinancialYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_list->FinancialYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_list->FinancialYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_list->ActivityName->Visible) { // ActivityName ?>
	<?php if ($activity_list->SortUrl($activity_list->ActivityName) == "") { ?>
		<th data-name="ActivityName" class="<?php echo $activity_list->ActivityName->headerCellClass() ?>"><div id="elh_activity_ActivityName" class="activity_ActivityName"><div class="ew-table-header-caption"><?php echo $activity_list->ActivityName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActivityName" class="<?php echo $activity_list->ActivityName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $activity_list->SortUrl($activity_list->ActivityName) ?>', 1);"><div id="elh_activity_ActivityName" class="activity_ActivityName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_list->ActivityName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($activity_list->ActivityName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_list->ActivityName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_list->MTEFBudget->Visible) { // MTEFBudget ?>
	<?php if ($activity_list->SortUrl($activity_list->MTEFBudget) == "") { ?>
		<th data-name="MTEFBudget" class="<?php echo $activity_list->MTEFBudget->headerCellClass() ?>"><div id="elh_activity_MTEFBudget" class="activity_MTEFBudget"><div class="ew-table-header-caption"><?php echo $activity_list->MTEFBudget->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MTEFBudget" class="<?php echo $activity_list->MTEFBudget->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $activity_list->SortUrl($activity_list->MTEFBudget) ?>', 1);"><div id="elh_activity_MTEFBudget" class="activity_MTEFBudget">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_list->MTEFBudget->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_list->MTEFBudget->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_list->MTEFBudget->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_list->SupplementaryBudget->Visible) { // SupplementaryBudget ?>
	<?php if ($activity_list->SortUrl($activity_list->SupplementaryBudget) == "") { ?>
		<th data-name="SupplementaryBudget" class="<?php echo $activity_list->SupplementaryBudget->headerCellClass() ?>"><div id="elh_activity_SupplementaryBudget" class="activity_SupplementaryBudget"><div class="ew-table-header-caption"><?php echo $activity_list->SupplementaryBudget->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SupplementaryBudget" class="<?php echo $activity_list->SupplementaryBudget->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $activity_list->SortUrl($activity_list->SupplementaryBudget) ?>', 1);"><div id="elh_activity_SupplementaryBudget" class="activity_SupplementaryBudget">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_list->SupplementaryBudget->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_list->SupplementaryBudget->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_list->SupplementaryBudget->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_list->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
	<?php if ($activity_list->SortUrl($activity_list->ExpectedAnnualAchievement) == "") { ?>
		<th data-name="ExpectedAnnualAchievement" class="<?php echo $activity_list->ExpectedAnnualAchievement->headerCellClass() ?>"><div id="elh_activity_ExpectedAnnualAchievement" class="activity_ExpectedAnnualAchievement"><div class="ew-table-header-caption"><?php echo $activity_list->ExpectedAnnualAchievement->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExpectedAnnualAchievement" class="<?php echo $activity_list->ExpectedAnnualAchievement->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $activity_list->SortUrl($activity_list->ExpectedAnnualAchievement) ?>', 1);"><div id="elh_activity_ExpectedAnnualAchievement" class="activity_ExpectedAnnualAchievement">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_list->ExpectedAnnualAchievement->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($activity_list->ExpectedAnnualAchievement->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_list->ExpectedAnnualAchievement->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_list->ActivityLocation->Visible) { // ActivityLocation ?>
	<?php if ($activity_list->SortUrl($activity_list->ActivityLocation) == "") { ?>
		<th data-name="ActivityLocation" class="<?php echo $activity_list->ActivityLocation->headerCellClass() ?>"><div id="elh_activity_ActivityLocation" class="activity_ActivityLocation"><div class="ew-table-header-caption"><?php echo $activity_list->ActivityLocation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActivityLocation" class="<?php echo $activity_list->ActivityLocation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $activity_list->SortUrl($activity_list->ActivityLocation) ?>', 1);"><div id="elh_activity_ActivityLocation" class="activity_ActivityLocation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_list->ActivityLocation->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($activity_list->ActivityLocation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_list->ActivityLocation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$activity_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($activity_list->ExportAll && $activity_list->isExport()) {
	$activity_list->StopRecord = $activity_list->TotalRecords;
} else {

	// Set the last record to display
	if ($activity_list->TotalRecords > $activity_list->StartRecord + $activity_list->DisplayRecords - 1)
		$activity_list->StopRecord = $activity_list->StartRecord + $activity_list->DisplayRecords - 1;
	else
		$activity_list->StopRecord = $activity_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($activity->isConfirm() || $activity_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($activity_list->FormKeyCountName) && ($activity_list->isGridAdd() || $activity_list->isGridEdit() || $activity->isConfirm())) {
		$activity_list->KeyCount = $CurrentForm->getValue($activity_list->FormKeyCountName);
		$activity_list->StopRecord = $activity_list->StartRecord + $activity_list->KeyCount - 1;
	}
}
$activity_list->RecordCount = $activity_list->StartRecord - 1;
if ($activity_list->Recordset && !$activity_list->Recordset->EOF) {
	$activity_list->Recordset->moveFirst();
	$selectLimit = $activity_list->UseSelectLimit;
	if (!$selectLimit && $activity_list->StartRecord > 1)
		$activity_list->Recordset->move($activity_list->StartRecord - 1);
} elseif (!$activity->AllowAddDeleteRow && $activity_list->StopRecord == 0) {
	$activity_list->StopRecord = $activity->GridAddRowCount;
}

// Initialize aggregate
$activity->RowType = ROWTYPE_AGGREGATEINIT;
$activity->resetAttributes();
$activity_list->renderRow();
if ($activity_list->isGridAdd())
	$activity_list->RowIndex = 0;
if ($activity_list->isGridEdit())
	$activity_list->RowIndex = 0;
while ($activity_list->RecordCount < $activity_list->StopRecord) {
	$activity_list->RecordCount++;
	if ($activity_list->RecordCount >= $activity_list->StartRecord) {
		$activity_list->RowCount++;
		if ($activity_list->isGridAdd() || $activity_list->isGridEdit() || $activity->isConfirm()) {
			$activity_list->RowIndex++;
			$CurrentForm->Index = $activity_list->RowIndex;
			if ($CurrentForm->hasValue($activity_list->FormActionName) && ($activity->isConfirm() || $activity_list->EventCancelled))
				$activity_list->RowAction = strval($CurrentForm->getValue($activity_list->FormActionName));
			elseif ($activity_list->isGridAdd())
				$activity_list->RowAction = "insert";
			else
				$activity_list->RowAction = "";
		}

		// Set up key count
		$activity_list->KeyCount = $activity_list->RowIndex;

		// Init row class and style
		$activity->resetAttributes();
		$activity->CssClass = "";
		if ($activity_list->isGridAdd()) {
			$activity_list->loadRowValues(); // Load default values
		} else {
			$activity_list->loadRowValues($activity_list->Recordset); // Load row values
		}
		$activity->RowType = ROWTYPE_VIEW; // Render view
		if ($activity_list->isGridAdd()) // Grid add
			$activity->RowType = ROWTYPE_ADD; // Render add
		if ($activity_list->isGridAdd() && $activity->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$activity_list->restoreCurrentRowFormValues($activity_list->RowIndex); // Restore form values
		if ($activity_list->isGridEdit()) { // Grid edit
			if ($activity->EventCancelled)
				$activity_list->restoreCurrentRowFormValues($activity_list->RowIndex); // Restore form values
			if ($activity_list->RowAction == "insert")
				$activity->RowType = ROWTYPE_ADD; // Render add
			else
				$activity->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($activity_list->isGridEdit() && ($activity->RowType == ROWTYPE_EDIT || $activity->RowType == ROWTYPE_ADD) && $activity->EventCancelled) // Update failed
			$activity_list->restoreCurrentRowFormValues($activity_list->RowIndex); // Restore form values
		if ($activity->RowType == ROWTYPE_EDIT) // Edit row
			$activity_list->EditRowCount++;

		// Set up row id / data-rowindex
		$activity->RowAttrs->merge(["data-rowindex" => $activity_list->RowCount, "id" => "r" . $activity_list->RowCount . "_activity", "data-rowtype" => $activity->RowType]);

		// Render row
		$activity_list->renderRow();

		// Render list options
		$activity_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($activity_list->RowAction != "delete" && $activity_list->RowAction != "insertdelete" && !($activity_list->RowAction == "insert" && $activity->isConfirm() && $activity_list->emptyRow())) {
?>
	<tr <?php echo $activity->rowAttributes() ?>>
<?php

// Render list options (body, left)
$activity_list->ListOptions->render("body", "left", $activity_list->RowCount);
?>
	<?php if ($activity_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $activity_list->LACode->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($activity_list->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_LACode" class="form-group">
<span<?php echo $activity_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $activity_list->RowIndex ?>_LACode" name="x<?php echo $activity_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($activity_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_LACode" class="form-group">
<?php $activity_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $activity_list->RowIndex ?>_LACode"><?php echo EmptyValue(strval($activity_list->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_list->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_list->LACode->ReadOnly || $activity_list->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_list->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_list->LACode->Lookup->getParamTag($activity_list, "p_x" . $activity_list->RowIndex . "_LACode") ?>
<input type="hidden" data-table="activity" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_list->RowIndex ?>_LACode" id="x<?php echo $activity_list->RowIndex ?>_LACode" value="<?php echo $activity_list->LACode->CurrentValue ?>"<?php echo $activity_list->LACode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_LACode" name="o<?php echo $activity_list->RowIndex ?>_LACode" id="o<?php echo $activity_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($activity_list->LACode->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($activity_list->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_LACode" class="form-group">
<span<?php echo $activity_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $activity_list->RowIndex ?>_LACode" name="x<?php echo $activity_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($activity_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_LACode" class="form-group">
<?php $activity_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $activity_list->RowIndex ?>_LACode"><?php echo EmptyValue(strval($activity_list->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_list->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_list->LACode->ReadOnly || $activity_list->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_list->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_list->LACode->Lookup->getParamTag($activity_list, "p_x" . $activity_list->RowIndex . "_LACode") ?>
<input type="hidden" data-table="activity" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_list->RowIndex ?>_LACode" id="x<?php echo $activity_list->RowIndex ?>_LACode" value="<?php echo $activity_list->LACode->CurrentValue ?>"<?php echo $activity_list->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_LACode">
<span<?php echo $activity_list->LACode->viewAttributes() ?>><?php echo $activity_list->LACode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $activity_list->DepartmentCode->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($activity_list->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_DepartmentCode" class="form-group">
<span<?php echo $activity_list->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_list->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $activity_list->RowIndex ?>_DepartmentCode" name="x<?php echo $activity_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($activity_list->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_DepartmentCode" class="form-group">
<?php $activity_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $activity_list->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($activity_list->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_list->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_list->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_list->DepartmentCode->ReadOnly || $activity_list->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_list->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_list->DepartmentCode->Lookup->getParamTag($activity_list, "p_x" . $activity_list->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="activity" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_list->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_list->RowIndex ?>_DepartmentCode" id="x<?php echo $activity_list->RowIndex ?>_DepartmentCode" value="<?php echo $activity_list->DepartmentCode->CurrentValue ?>"<?php echo $activity_list->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_DepartmentCode" name="o<?php echo $activity_list->RowIndex ?>_DepartmentCode" id="o<?php echo $activity_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($activity_list->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($activity_list->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_DepartmentCode" class="form-group">
<span<?php echo $activity_list->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_list->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $activity_list->RowIndex ?>_DepartmentCode" name="x<?php echo $activity_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($activity_list->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_DepartmentCode" class="form-group">
<?php $activity_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $activity_list->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($activity_list->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_list->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_list->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_list->DepartmentCode->ReadOnly || $activity_list->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_list->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_list->DepartmentCode->Lookup->getParamTag($activity_list, "p_x" . $activity_list->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="activity" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_list->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_list->RowIndex ?>_DepartmentCode" id="x<?php echo $activity_list->RowIndex ?>_DepartmentCode" value="<?php echo $activity_list->DepartmentCode->CurrentValue ?>"<?php echo $activity_list->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_DepartmentCode">
<span<?php echo $activity_list->DepartmentCode->viewAttributes() ?>><?php echo $activity_list->DepartmentCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $activity_list->SectionCode->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($activity_list->SectionCode->getSessionValue() != "") { ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_SectionCode" class="form-group">
<span<?php echo $activity_list->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_list->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $activity_list->RowIndex ?>_SectionCode" name="x<?php echo $activity_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($activity_list->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_SectionCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $activity_list->RowIndex ?>_SectionCode"><?php echo EmptyValue(strval($activity_list->SectionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_list->SectionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_list->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_list->SectionCode->ReadOnly || $activity_list->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_list->RowIndex ?>_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_list->SectionCode->Lookup->getParamTag($activity_list, "p_x" . $activity_list->RowIndex . "_SectionCode") ?>
<input type="hidden" data-table="activity" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_list->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_list->RowIndex ?>_SectionCode" id="x<?php echo $activity_list->RowIndex ?>_SectionCode" value="<?php echo $activity_list->SectionCode->CurrentValue ?>"<?php echo $activity_list->SectionCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_SectionCode" name="o<?php echo $activity_list->RowIndex ?>_SectionCode" id="o<?php echo $activity_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($activity_list->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($activity_list->SectionCode->getSessionValue() != "") { ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_SectionCode" class="form-group">
<span<?php echo $activity_list->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_list->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $activity_list->RowIndex ?>_SectionCode" name="x<?php echo $activity_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($activity_list->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_SectionCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $activity_list->RowIndex ?>_SectionCode"><?php echo EmptyValue(strval($activity_list->SectionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_list->SectionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_list->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_list->SectionCode->ReadOnly || $activity_list->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_list->RowIndex ?>_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_list->SectionCode->Lookup->getParamTag($activity_list, "p_x" . $activity_list->RowIndex . "_SectionCode") ?>
<input type="hidden" data-table="activity" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_list->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_list->RowIndex ?>_SectionCode" id="x<?php echo $activity_list->RowIndex ?>_SectionCode" value="<?php echo $activity_list->SectionCode->CurrentValue ?>"<?php echo $activity_list->SectionCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_SectionCode">
<span<?php echo $activity_list->SectionCode->viewAttributes() ?>><?php echo $activity_list->SectionCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_list->ProgrammeCode->Visible) { // ProgrammeCode ?>
		<td data-name="ProgrammeCode" <?php echo $activity_list->ProgrammeCode->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_ProgrammeCode" class="form-group">
<?php
$onchange = $activity_list->ProgrammeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$activity_list->ProgrammeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $activity_list->RowIndex ?>_ProgrammeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $activity_list->RowIndex ?>_ProgrammeCode" id="sv_x<?php echo $activity_list->RowIndex ?>_ProgrammeCode" value="<?php echo RemoveHtml($activity_list->ProgrammeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($activity_list->ProgrammeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($activity_list->ProgrammeCode->getPlaceHolder()) ?>"<?php echo $activity_list->ProgrammeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_list->ProgrammeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_list->RowIndex ?>_ProgrammeCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($activity_list->ProgrammeCode->ReadOnly || $activity_list->ProgrammeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="activity" data-field="x_ProgrammeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_list->ProgrammeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_list->RowIndex ?>_ProgrammeCode" id="x<?php echo $activity_list->RowIndex ?>_ProgrammeCode" value="<?php echo HtmlEncode($activity_list->ProgrammeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["factivitylist"], function() {
	factivitylist.createAutoSuggest({"id":"x<?php echo $activity_list->RowIndex ?>_ProgrammeCode","forceSelect":false});
});
</script>
<?php echo $activity_list->ProgrammeCode->Lookup->getParamTag($activity_list, "p_x" . $activity_list->RowIndex . "_ProgrammeCode") ?>
</span>
<input type="hidden" data-table="activity" data-field="x_ProgrammeCode" name="o<?php echo $activity_list->RowIndex ?>_ProgrammeCode" id="o<?php echo $activity_list->RowIndex ?>_ProgrammeCode" value="<?php echo HtmlEncode($activity_list->ProgrammeCode->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_ProgrammeCode" class="form-group">
<?php
$onchange = $activity_list->ProgrammeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$activity_list->ProgrammeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $activity_list->RowIndex ?>_ProgrammeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $activity_list->RowIndex ?>_ProgrammeCode" id="sv_x<?php echo $activity_list->RowIndex ?>_ProgrammeCode" value="<?php echo RemoveHtml($activity_list->ProgrammeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($activity_list->ProgrammeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($activity_list->ProgrammeCode->getPlaceHolder()) ?>"<?php echo $activity_list->ProgrammeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_list->ProgrammeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_list->RowIndex ?>_ProgrammeCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($activity_list->ProgrammeCode->ReadOnly || $activity_list->ProgrammeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="activity" data-field="x_ProgrammeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_list->ProgrammeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_list->RowIndex ?>_ProgrammeCode" id="x<?php echo $activity_list->RowIndex ?>_ProgrammeCode" value="<?php echo HtmlEncode($activity_list->ProgrammeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["factivitylist"], function() {
	factivitylist.createAutoSuggest({"id":"x<?php echo $activity_list->RowIndex ?>_ProgrammeCode","forceSelect":false});
});
</script>
<?php echo $activity_list->ProgrammeCode->Lookup->getParamTag($activity_list, "p_x" . $activity_list->RowIndex . "_ProgrammeCode") ?>
</span>
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_ProgrammeCode">
<span<?php echo $activity_list->ProgrammeCode->viewAttributes() ?>><?php echo $activity_list->ProgrammeCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_list->OucomeCode->Visible) { // OucomeCode ?>
		<td data-name="OucomeCode" <?php echo $activity_list->OucomeCode->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_OucomeCode" class="form-group">
<?php $activity_list->OucomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="activity" data-field="x_OucomeCode" data-value-separator="<?php echo $activity_list->OucomeCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $activity_list->RowIndex ?>_OucomeCode" name="x<?php echo $activity_list->RowIndex ?>_OucomeCode"<?php echo $activity_list->OucomeCode->editAttributes() ?>>
			<?php echo $activity_list->OucomeCode->selectOptionListHtml("x{$activity_list->RowIndex}_OucomeCode") ?>
		</select>
</div>
<?php echo $activity_list->OucomeCode->Lookup->getParamTag($activity_list, "p_x" . $activity_list->RowIndex . "_OucomeCode") ?>
</span>
<input type="hidden" data-table="activity" data-field="x_OucomeCode" name="o<?php echo $activity_list->RowIndex ?>_OucomeCode" id="o<?php echo $activity_list->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($activity_list->OucomeCode->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_OucomeCode" class="form-group">
<?php $activity_list->OucomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="activity" data-field="x_OucomeCode" data-value-separator="<?php echo $activity_list->OucomeCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $activity_list->RowIndex ?>_OucomeCode" name="x<?php echo $activity_list->RowIndex ?>_OucomeCode"<?php echo $activity_list->OucomeCode->editAttributes() ?>>
			<?php echo $activity_list->OucomeCode->selectOptionListHtml("x{$activity_list->RowIndex}_OucomeCode") ?>
		</select>
</div>
<?php echo $activity_list->OucomeCode->Lookup->getParamTag($activity_list, "p_x" . $activity_list->RowIndex . "_OucomeCode") ?>
</span>
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_OucomeCode">
<span<?php echo $activity_list->OucomeCode->viewAttributes() ?>><?php echo $activity_list->OucomeCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_list->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode" <?php echo $activity_list->OutputCode->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_OutputCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $activity_list->RowIndex ?>_OutputCode"><?php echo EmptyValue(strval($activity_list->OutputCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_list->OutputCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_list->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_list->OutputCode->ReadOnly || $activity_list->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_list->RowIndex ?>_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_list->OutputCode->Lookup->getParamTag($activity_list, "p_x" . $activity_list->RowIndex . "_OutputCode") ?>
<input type="hidden" data-table="activity" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_list->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_list->RowIndex ?>_OutputCode" id="x<?php echo $activity_list->RowIndex ?>_OutputCode" value="<?php echo $activity_list->OutputCode->CurrentValue ?>"<?php echo $activity_list->OutputCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="activity" data-field="x_OutputCode" name="o<?php echo $activity_list->RowIndex ?>_OutputCode" id="o<?php echo $activity_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($activity_list->OutputCode->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_OutputCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $activity_list->RowIndex ?>_OutputCode"><?php echo EmptyValue(strval($activity_list->OutputCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_list->OutputCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_list->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_list->OutputCode->ReadOnly || $activity_list->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_list->RowIndex ?>_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_list->OutputCode->Lookup->getParamTag($activity_list, "p_x" . $activity_list->RowIndex . "_OutputCode") ?>
<input type="hidden" data-table="activity" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_list->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_list->RowIndex ?>_OutputCode" id="x<?php echo $activity_list->RowIndex ?>_OutputCode" value="<?php echo $activity_list->OutputCode->CurrentValue ?>"<?php echo $activity_list->OutputCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_OutputCode">
<span<?php echo $activity_list->OutputCode->viewAttributes() ?>><?php echo $activity_list->OutputCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_list->ProjectCode->Visible) { // ProjectCode ?>
		<td data-name="ProjectCode" <?php echo $activity_list->ProjectCode->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($activity_list->ProjectCode->getSessionValue() != "") { ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_ProjectCode" class="form-group">
<span<?php echo $activity_list->ProjectCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_list->ProjectCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $activity_list->RowIndex ?>_ProjectCode" name="x<?php echo $activity_list->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($activity_list->ProjectCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_ProjectCode" class="form-group">
<?php
$onchange = $activity_list->ProjectCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$activity_list->ProjectCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $activity_list->RowIndex ?>_ProjectCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $activity_list->RowIndex ?>_ProjectCode" id="sv_x<?php echo $activity_list->RowIndex ?>_ProjectCode" value="<?php echo RemoveHtml($activity_list->ProjectCode->EditValue) ?>" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($activity_list->ProjectCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($activity_list->ProjectCode->getPlaceHolder()) ?>"<?php echo $activity_list->ProjectCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_list->ProjectCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_list->RowIndex ?>_ProjectCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($activity_list->ProjectCode->ReadOnly || $activity_list->ProjectCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="activity" data-field="x_ProjectCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_list->ProjectCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_list->RowIndex ?>_ProjectCode" id="x<?php echo $activity_list->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($activity_list->ProjectCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["factivitylist"], function() {
	factivitylist.createAutoSuggest({"id":"x<?php echo $activity_list->RowIndex ?>_ProjectCode","forceSelect":false});
});
</script>
<?php echo $activity_list->ProjectCode->Lookup->getParamTag($activity_list, "p_x" . $activity_list->RowIndex . "_ProjectCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_ProjectCode" name="o<?php echo $activity_list->RowIndex ?>_ProjectCode" id="o<?php echo $activity_list->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($activity_list->ProjectCode->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($activity_list->ProjectCode->getSessionValue() != "") { ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_ProjectCode" class="form-group">
<span<?php echo $activity_list->ProjectCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_list->ProjectCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $activity_list->RowIndex ?>_ProjectCode" name="x<?php echo $activity_list->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($activity_list->ProjectCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_ProjectCode" class="form-group">
<?php
$onchange = $activity_list->ProjectCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$activity_list->ProjectCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $activity_list->RowIndex ?>_ProjectCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $activity_list->RowIndex ?>_ProjectCode" id="sv_x<?php echo $activity_list->RowIndex ?>_ProjectCode" value="<?php echo RemoveHtml($activity_list->ProjectCode->EditValue) ?>" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($activity_list->ProjectCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($activity_list->ProjectCode->getPlaceHolder()) ?>"<?php echo $activity_list->ProjectCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_list->ProjectCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_list->RowIndex ?>_ProjectCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($activity_list->ProjectCode->ReadOnly || $activity_list->ProjectCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="activity" data-field="x_ProjectCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_list->ProjectCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_list->RowIndex ?>_ProjectCode" id="x<?php echo $activity_list->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($activity_list->ProjectCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["factivitylist"], function() {
	factivitylist.createAutoSuggest({"id":"x<?php echo $activity_list->RowIndex ?>_ProjectCode","forceSelect":false});
});
</script>
<?php echo $activity_list->ProjectCode->Lookup->getParamTag($activity_list, "p_x" . $activity_list->RowIndex . "_ProjectCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_ProjectCode">
<span<?php echo $activity_list->ProjectCode->viewAttributes() ?>><?php echo $activity_list->ProjectCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_list->ActivityCode->Visible) { // ActivityCode ?>
		<td data-name="ActivityCode" <?php echo $activity_list->ActivityCode->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_ActivityCode" class="form-group"></span>
<input type="hidden" data-table="activity" data-field="x_ActivityCode" name="o<?php echo $activity_list->RowIndex ?>_ActivityCode" id="o<?php echo $activity_list->RowIndex ?>_ActivityCode" value="<?php echo HtmlEncode($activity_list->ActivityCode->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_ActivityCode" class="form-group">
<span<?php echo $activity_list->ActivityCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_list->ActivityCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="activity" data-field="x_ActivityCode" name="x<?php echo $activity_list->RowIndex ?>_ActivityCode" id="x<?php echo $activity_list->RowIndex ?>_ActivityCode" value="<?php echo HtmlEncode($activity_list->ActivityCode->CurrentValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_ActivityCode">
<span<?php echo $activity_list->ActivityCode->viewAttributes() ?>><?php echo $activity_list->ActivityCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_list->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear" <?php echo $activity_list->FinancialYear->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_FinancialYear" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="activity" data-field="x_FinancialYear" data-value-separator="<?php echo $activity_list->FinancialYear->displayValueSeparatorAttribute() ?>" id="x<?php echo $activity_list->RowIndex ?>_FinancialYear" name="x<?php echo $activity_list->RowIndex ?>_FinancialYear"<?php echo $activity_list->FinancialYear->editAttributes() ?>>
			<?php echo $activity_list->FinancialYear->selectOptionListHtml("x{$activity_list->RowIndex}_FinancialYear") ?>
		</select>
</div>
<?php echo $activity_list->FinancialYear->Lookup->getParamTag($activity_list, "p_x" . $activity_list->RowIndex . "_FinancialYear") ?>
</span>
<input type="hidden" data-table="activity" data-field="x_FinancialYear" name="o<?php echo $activity_list->RowIndex ?>_FinancialYear" id="o<?php echo $activity_list->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($activity_list->FinancialYear->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="activity" data-field="x_FinancialYear" data-value-separator="<?php echo $activity_list->FinancialYear->displayValueSeparatorAttribute() ?>" id="x<?php echo $activity_list->RowIndex ?>_FinancialYear" name="x<?php echo $activity_list->RowIndex ?>_FinancialYear"<?php echo $activity_list->FinancialYear->editAttributes() ?>>
			<?php echo $activity_list->FinancialYear->selectOptionListHtml("x{$activity_list->RowIndex}_FinancialYear") ?>
		</select>
</div>
<?php echo $activity_list->FinancialYear->Lookup->getParamTag($activity_list, "p_x" . $activity_list->RowIndex . "_FinancialYear") ?>
<input type="hidden" data-table="activity" data-field="x_FinancialYear" name="o<?php echo $activity_list->RowIndex ?>_FinancialYear" id="o<?php echo $activity_list->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($activity_list->FinancialYear->OldValue != null ? $activity_list->FinancialYear->OldValue : $activity_list->FinancialYear->CurrentValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_FinancialYear">
<span<?php echo $activity_list->FinancialYear->viewAttributes() ?>><?php echo $activity_list->FinancialYear->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_list->ActivityName->Visible) { // ActivityName ?>
		<td data-name="ActivityName" <?php echo $activity_list->ActivityName->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_ActivityName" class="form-group">
<textarea data-table="activity" data-field="x_ActivityName" name="x<?php echo $activity_list->RowIndex ?>_ActivityName" id="x<?php echo $activity_list->RowIndex ?>_ActivityName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($activity_list->ActivityName->getPlaceHolder()) ?>"<?php echo $activity_list->ActivityName->editAttributes() ?>><?php echo $activity_list->ActivityName->EditValue ?></textarea>
</span>
<input type="hidden" data-table="activity" data-field="x_ActivityName" name="o<?php echo $activity_list->RowIndex ?>_ActivityName" id="o<?php echo $activity_list->RowIndex ?>_ActivityName" value="<?php echo HtmlEncode($activity_list->ActivityName->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_ActivityName" class="form-group">
<textarea data-table="activity" data-field="x_ActivityName" name="x<?php echo $activity_list->RowIndex ?>_ActivityName" id="x<?php echo $activity_list->RowIndex ?>_ActivityName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($activity_list->ActivityName->getPlaceHolder()) ?>"<?php echo $activity_list->ActivityName->editAttributes() ?>><?php echo $activity_list->ActivityName->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_ActivityName">
<span<?php echo $activity_list->ActivityName->viewAttributes() ?>><?php echo $activity_list->ActivityName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_list->MTEFBudget->Visible) { // MTEFBudget ?>
		<td data-name="MTEFBudget" <?php echo $activity_list->MTEFBudget->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_MTEFBudget" class="form-group">
<input type="text" data-table="activity" data-field="x_MTEFBudget" name="x<?php echo $activity_list->RowIndex ?>_MTEFBudget" id="x<?php echo $activity_list->RowIndex ?>_MTEFBudget" size="30" placeholder="<?php echo HtmlEncode($activity_list->MTEFBudget->getPlaceHolder()) ?>" value="<?php echo $activity_list->MTEFBudget->EditValue ?>"<?php echo $activity_list->MTEFBudget->editAttributes() ?>>
</span>
<input type="hidden" data-table="activity" data-field="x_MTEFBudget" name="o<?php echo $activity_list->RowIndex ?>_MTEFBudget" id="o<?php echo $activity_list->RowIndex ?>_MTEFBudget" value="<?php echo HtmlEncode($activity_list->MTEFBudget->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_MTEFBudget" class="form-group">
<input type="text" data-table="activity" data-field="x_MTEFBudget" name="x<?php echo $activity_list->RowIndex ?>_MTEFBudget" id="x<?php echo $activity_list->RowIndex ?>_MTEFBudget" size="30" placeholder="<?php echo HtmlEncode($activity_list->MTEFBudget->getPlaceHolder()) ?>" value="<?php echo $activity_list->MTEFBudget->EditValue ?>"<?php echo $activity_list->MTEFBudget->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_MTEFBudget">
<span<?php echo $activity_list->MTEFBudget->viewAttributes() ?>><?php echo $activity_list->MTEFBudget->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_list->SupplementaryBudget->Visible) { // SupplementaryBudget ?>
		<td data-name="SupplementaryBudget" <?php echo $activity_list->SupplementaryBudget->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_SupplementaryBudget" class="form-group">
<input type="text" data-table="activity" data-field="x_SupplementaryBudget" name="x<?php echo $activity_list->RowIndex ?>_SupplementaryBudget" id="x<?php echo $activity_list->RowIndex ?>_SupplementaryBudget" size="30" placeholder="<?php echo HtmlEncode($activity_list->SupplementaryBudget->getPlaceHolder()) ?>" value="<?php echo $activity_list->SupplementaryBudget->EditValue ?>"<?php echo $activity_list->SupplementaryBudget->editAttributes() ?>>
</span>
<input type="hidden" data-table="activity" data-field="x_SupplementaryBudget" name="o<?php echo $activity_list->RowIndex ?>_SupplementaryBudget" id="o<?php echo $activity_list->RowIndex ?>_SupplementaryBudget" value="<?php echo HtmlEncode($activity_list->SupplementaryBudget->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_SupplementaryBudget" class="form-group">
<input type="text" data-table="activity" data-field="x_SupplementaryBudget" name="x<?php echo $activity_list->RowIndex ?>_SupplementaryBudget" id="x<?php echo $activity_list->RowIndex ?>_SupplementaryBudget" size="30" placeholder="<?php echo HtmlEncode($activity_list->SupplementaryBudget->getPlaceHolder()) ?>" value="<?php echo $activity_list->SupplementaryBudget->EditValue ?>"<?php echo $activity_list->SupplementaryBudget->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_SupplementaryBudget">
<span<?php echo $activity_list->SupplementaryBudget->viewAttributes() ?>><?php echo $activity_list->SupplementaryBudget->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_list->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
		<td data-name="ExpectedAnnualAchievement" <?php echo $activity_list->ExpectedAnnualAchievement->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_ExpectedAnnualAchievement" class="form-group">
<input type="text" data-table="activity" data-field="x_ExpectedAnnualAchievement" name="x<?php echo $activity_list->RowIndex ?>_ExpectedAnnualAchievement" id="x<?php echo $activity_list->RowIndex ?>_ExpectedAnnualAchievement" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($activity_list->ExpectedAnnualAchievement->getPlaceHolder()) ?>" value="<?php echo $activity_list->ExpectedAnnualAchievement->EditValue ?>"<?php echo $activity_list->ExpectedAnnualAchievement->editAttributes() ?>>
</span>
<input type="hidden" data-table="activity" data-field="x_ExpectedAnnualAchievement" name="o<?php echo $activity_list->RowIndex ?>_ExpectedAnnualAchievement" id="o<?php echo $activity_list->RowIndex ?>_ExpectedAnnualAchievement" value="<?php echo HtmlEncode($activity_list->ExpectedAnnualAchievement->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_ExpectedAnnualAchievement" class="form-group">
<input type="text" data-table="activity" data-field="x_ExpectedAnnualAchievement" name="x<?php echo $activity_list->RowIndex ?>_ExpectedAnnualAchievement" id="x<?php echo $activity_list->RowIndex ?>_ExpectedAnnualAchievement" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($activity_list->ExpectedAnnualAchievement->getPlaceHolder()) ?>" value="<?php echo $activity_list->ExpectedAnnualAchievement->EditValue ?>"<?php echo $activity_list->ExpectedAnnualAchievement->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_ExpectedAnnualAchievement">
<span<?php echo $activity_list->ExpectedAnnualAchievement->viewAttributes() ?>><?php echo $activity_list->ExpectedAnnualAchievement->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($activity_list->ActivityLocation->Visible) { // ActivityLocation ?>
		<td data-name="ActivityLocation" <?php echo $activity_list->ActivityLocation->cellAttributes() ?>>
<?php if ($activity->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_ActivityLocation" class="form-group">
<input type="text" data-table="activity" data-field="x_ActivityLocation" name="x<?php echo $activity_list->RowIndex ?>_ActivityLocation" id="x<?php echo $activity_list->RowIndex ?>_ActivityLocation" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($activity_list->ActivityLocation->getPlaceHolder()) ?>" value="<?php echo $activity_list->ActivityLocation->EditValue ?>"<?php echo $activity_list->ActivityLocation->editAttributes() ?>>
</span>
<input type="hidden" data-table="activity" data-field="x_ActivityLocation" name="o<?php echo $activity_list->RowIndex ?>_ActivityLocation" id="o<?php echo $activity_list->RowIndex ?>_ActivityLocation" value="<?php echo HtmlEncode($activity_list->ActivityLocation->OldValue) ?>">
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_ActivityLocation" class="form-group">
<input type="text" data-table="activity" data-field="x_ActivityLocation" name="x<?php echo $activity_list->RowIndex ?>_ActivityLocation" id="x<?php echo $activity_list->RowIndex ?>_ActivityLocation" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($activity_list->ActivityLocation->getPlaceHolder()) ?>" value="<?php echo $activity_list->ActivityLocation->EditValue ?>"<?php echo $activity_list->ActivityLocation->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($activity->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $activity_list->RowCount ?>_activity_ActivityLocation">
<span<?php echo $activity_list->ActivityLocation->viewAttributes() ?>><?php echo $activity_list->ActivityLocation->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$activity_list->ListOptions->render("body", "right", $activity_list->RowCount);
?>
	</tr>
<?php if ($activity->RowType == ROWTYPE_ADD || $activity->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["factivitylist", "load"], function() {
	factivitylist.updateLists(<?php echo $activity_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$activity_list->isGridAdd())
		if (!$activity_list->Recordset->EOF)
			$activity_list->Recordset->moveNext();
}
?>
<?php
	if ($activity_list->isGridAdd() || $activity_list->isGridEdit()) {
		$activity_list->RowIndex = '$rowindex$';
		$activity_list->loadRowValues();

		// Set row properties
		$activity->resetAttributes();
		$activity->RowAttrs->merge(["data-rowindex" => $activity_list->RowIndex, "id" => "r0_activity", "data-rowtype" => ROWTYPE_ADD]);
		$activity->RowAttrs->appendClass("ew-template");
		$activity->RowType = ROWTYPE_ADD;

		// Render row
		$activity_list->renderRow();

		// Render list options
		$activity_list->renderListOptions();
		$activity_list->StartRowCount = 0;
?>
	<tr <?php echo $activity->rowAttributes() ?>>
<?php

// Render list options (body, left)
$activity_list->ListOptions->render("body", "left", $activity_list->RowIndex);
?>
	<?php if ($activity_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if ($activity_list->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_activity_LACode" class="form-group activity_LACode">
<span<?php echo $activity_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $activity_list->RowIndex ?>_LACode" name="x<?php echo $activity_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($activity_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_activity_LACode" class="form-group activity_LACode">
<?php $activity_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $activity_list->RowIndex ?>_LACode"><?php echo EmptyValue(strval($activity_list->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_list->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_list->LACode->ReadOnly || $activity_list->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_list->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_list->LACode->Lookup->getParamTag($activity_list, "p_x" . $activity_list->RowIndex . "_LACode") ?>
<input type="hidden" data-table="activity" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_list->RowIndex ?>_LACode" id="x<?php echo $activity_list->RowIndex ?>_LACode" value="<?php echo $activity_list->LACode->CurrentValue ?>"<?php echo $activity_list->LACode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_LACode" name="o<?php echo $activity_list->RowIndex ?>_LACode" id="o<?php echo $activity_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($activity_list->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<?php if ($activity_list->DepartmentCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_activity_DepartmentCode" class="form-group activity_DepartmentCode">
<span<?php echo $activity_list->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_list->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $activity_list->RowIndex ?>_DepartmentCode" name="x<?php echo $activity_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($activity_list->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_activity_DepartmentCode" class="form-group activity_DepartmentCode">
<?php $activity_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $activity_list->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($activity_list->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_list->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_list->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_list->DepartmentCode->ReadOnly || $activity_list->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_list->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_list->DepartmentCode->Lookup->getParamTag($activity_list, "p_x" . $activity_list->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="activity" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_list->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_list->RowIndex ?>_DepartmentCode" id="x<?php echo $activity_list->RowIndex ?>_DepartmentCode" value="<?php echo $activity_list->DepartmentCode->CurrentValue ?>"<?php echo $activity_list->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_DepartmentCode" name="o<?php echo $activity_list->RowIndex ?>_DepartmentCode" id="o<?php echo $activity_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($activity_list->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode">
<?php if ($activity_list->SectionCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_activity_SectionCode" class="form-group activity_SectionCode">
<span<?php echo $activity_list->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_list->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $activity_list->RowIndex ?>_SectionCode" name="x<?php echo $activity_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($activity_list->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_activity_SectionCode" class="form-group activity_SectionCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $activity_list->RowIndex ?>_SectionCode"><?php echo EmptyValue(strval($activity_list->SectionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_list->SectionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_list->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_list->SectionCode->ReadOnly || $activity_list->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_list->RowIndex ?>_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_list->SectionCode->Lookup->getParamTag($activity_list, "p_x" . $activity_list->RowIndex . "_SectionCode") ?>
<input type="hidden" data-table="activity" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_list->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_list->RowIndex ?>_SectionCode" id="x<?php echo $activity_list->RowIndex ?>_SectionCode" value="<?php echo $activity_list->SectionCode->CurrentValue ?>"<?php echo $activity_list->SectionCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_SectionCode" name="o<?php echo $activity_list->RowIndex ?>_SectionCode" id="o<?php echo $activity_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($activity_list->SectionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_list->ProgrammeCode->Visible) { // ProgrammeCode ?>
		<td data-name="ProgrammeCode">
<span id="el$rowindex$_activity_ProgrammeCode" class="form-group activity_ProgrammeCode">
<?php
$onchange = $activity_list->ProgrammeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$activity_list->ProgrammeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $activity_list->RowIndex ?>_ProgrammeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $activity_list->RowIndex ?>_ProgrammeCode" id="sv_x<?php echo $activity_list->RowIndex ?>_ProgrammeCode" value="<?php echo RemoveHtml($activity_list->ProgrammeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($activity_list->ProgrammeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($activity_list->ProgrammeCode->getPlaceHolder()) ?>"<?php echo $activity_list->ProgrammeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_list->ProgrammeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_list->RowIndex ?>_ProgrammeCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($activity_list->ProgrammeCode->ReadOnly || $activity_list->ProgrammeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="activity" data-field="x_ProgrammeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_list->ProgrammeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_list->RowIndex ?>_ProgrammeCode" id="x<?php echo $activity_list->RowIndex ?>_ProgrammeCode" value="<?php echo HtmlEncode($activity_list->ProgrammeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["factivitylist"], function() {
	factivitylist.createAutoSuggest({"id":"x<?php echo $activity_list->RowIndex ?>_ProgrammeCode","forceSelect":false});
});
</script>
<?php echo $activity_list->ProgrammeCode->Lookup->getParamTag($activity_list, "p_x" . $activity_list->RowIndex . "_ProgrammeCode") ?>
</span>
<input type="hidden" data-table="activity" data-field="x_ProgrammeCode" name="o<?php echo $activity_list->RowIndex ?>_ProgrammeCode" id="o<?php echo $activity_list->RowIndex ?>_ProgrammeCode" value="<?php echo HtmlEncode($activity_list->ProgrammeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_list->OucomeCode->Visible) { // OucomeCode ?>
		<td data-name="OucomeCode">
<span id="el$rowindex$_activity_OucomeCode" class="form-group activity_OucomeCode">
<?php $activity_list->OucomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="activity" data-field="x_OucomeCode" data-value-separator="<?php echo $activity_list->OucomeCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $activity_list->RowIndex ?>_OucomeCode" name="x<?php echo $activity_list->RowIndex ?>_OucomeCode"<?php echo $activity_list->OucomeCode->editAttributes() ?>>
			<?php echo $activity_list->OucomeCode->selectOptionListHtml("x{$activity_list->RowIndex}_OucomeCode") ?>
		</select>
</div>
<?php echo $activity_list->OucomeCode->Lookup->getParamTag($activity_list, "p_x" . $activity_list->RowIndex . "_OucomeCode") ?>
</span>
<input type="hidden" data-table="activity" data-field="x_OucomeCode" name="o<?php echo $activity_list->RowIndex ?>_OucomeCode" id="o<?php echo $activity_list->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($activity_list->OucomeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_list->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode">
<span id="el$rowindex$_activity_OutputCode" class="form-group activity_OutputCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $activity_list->RowIndex ?>_OutputCode"><?php echo EmptyValue(strval($activity_list->OutputCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_list->OutputCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_list->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_list->OutputCode->ReadOnly || $activity_list->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_list->RowIndex ?>_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_list->OutputCode->Lookup->getParamTag($activity_list, "p_x" . $activity_list->RowIndex . "_OutputCode") ?>
<input type="hidden" data-table="activity" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_list->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_list->RowIndex ?>_OutputCode" id="x<?php echo $activity_list->RowIndex ?>_OutputCode" value="<?php echo $activity_list->OutputCode->CurrentValue ?>"<?php echo $activity_list->OutputCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="activity" data-field="x_OutputCode" name="o<?php echo $activity_list->RowIndex ?>_OutputCode" id="o<?php echo $activity_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($activity_list->OutputCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_list->ProjectCode->Visible) { // ProjectCode ?>
		<td data-name="ProjectCode">
<?php if ($activity_list->ProjectCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_activity_ProjectCode" class="form-group activity_ProjectCode">
<span<?php echo $activity_list->ProjectCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_list->ProjectCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $activity_list->RowIndex ?>_ProjectCode" name="x<?php echo $activity_list->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($activity_list->ProjectCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_activity_ProjectCode" class="form-group activity_ProjectCode">
<?php
$onchange = $activity_list->ProjectCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$activity_list->ProjectCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $activity_list->RowIndex ?>_ProjectCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $activity_list->RowIndex ?>_ProjectCode" id="sv_x<?php echo $activity_list->RowIndex ?>_ProjectCode" value="<?php echo RemoveHtml($activity_list->ProjectCode->EditValue) ?>" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($activity_list->ProjectCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($activity_list->ProjectCode->getPlaceHolder()) ?>"<?php echo $activity_list->ProjectCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_list->ProjectCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $activity_list->RowIndex ?>_ProjectCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($activity_list->ProjectCode->ReadOnly || $activity_list->ProjectCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="activity" data-field="x_ProjectCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_list->ProjectCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $activity_list->RowIndex ?>_ProjectCode" id="x<?php echo $activity_list->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($activity_list->ProjectCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["factivitylist"], function() {
	factivitylist.createAutoSuggest({"id":"x<?php echo $activity_list->RowIndex ?>_ProjectCode","forceSelect":false});
});
</script>
<?php echo $activity_list->ProjectCode->Lookup->getParamTag($activity_list, "p_x" . $activity_list->RowIndex . "_ProjectCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="activity" data-field="x_ProjectCode" name="o<?php echo $activity_list->RowIndex ?>_ProjectCode" id="o<?php echo $activity_list->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($activity_list->ProjectCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_list->ActivityCode->Visible) { // ActivityCode ?>
		<td data-name="ActivityCode">
<span id="el$rowindex$_activity_ActivityCode" class="form-group activity_ActivityCode"></span>
<input type="hidden" data-table="activity" data-field="x_ActivityCode" name="o<?php echo $activity_list->RowIndex ?>_ActivityCode" id="o<?php echo $activity_list->RowIndex ?>_ActivityCode" value="<?php echo HtmlEncode($activity_list->ActivityCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_list->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear">
<span id="el$rowindex$_activity_FinancialYear" class="form-group activity_FinancialYear">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="activity" data-field="x_FinancialYear" data-value-separator="<?php echo $activity_list->FinancialYear->displayValueSeparatorAttribute() ?>" id="x<?php echo $activity_list->RowIndex ?>_FinancialYear" name="x<?php echo $activity_list->RowIndex ?>_FinancialYear"<?php echo $activity_list->FinancialYear->editAttributes() ?>>
			<?php echo $activity_list->FinancialYear->selectOptionListHtml("x{$activity_list->RowIndex}_FinancialYear") ?>
		</select>
</div>
<?php echo $activity_list->FinancialYear->Lookup->getParamTag($activity_list, "p_x" . $activity_list->RowIndex . "_FinancialYear") ?>
</span>
<input type="hidden" data-table="activity" data-field="x_FinancialYear" name="o<?php echo $activity_list->RowIndex ?>_FinancialYear" id="o<?php echo $activity_list->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($activity_list->FinancialYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_list->ActivityName->Visible) { // ActivityName ?>
		<td data-name="ActivityName">
<span id="el$rowindex$_activity_ActivityName" class="form-group activity_ActivityName">
<textarea data-table="activity" data-field="x_ActivityName" name="x<?php echo $activity_list->RowIndex ?>_ActivityName" id="x<?php echo $activity_list->RowIndex ?>_ActivityName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($activity_list->ActivityName->getPlaceHolder()) ?>"<?php echo $activity_list->ActivityName->editAttributes() ?>><?php echo $activity_list->ActivityName->EditValue ?></textarea>
</span>
<input type="hidden" data-table="activity" data-field="x_ActivityName" name="o<?php echo $activity_list->RowIndex ?>_ActivityName" id="o<?php echo $activity_list->RowIndex ?>_ActivityName" value="<?php echo HtmlEncode($activity_list->ActivityName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_list->MTEFBudget->Visible) { // MTEFBudget ?>
		<td data-name="MTEFBudget">
<span id="el$rowindex$_activity_MTEFBudget" class="form-group activity_MTEFBudget">
<input type="text" data-table="activity" data-field="x_MTEFBudget" name="x<?php echo $activity_list->RowIndex ?>_MTEFBudget" id="x<?php echo $activity_list->RowIndex ?>_MTEFBudget" size="30" placeholder="<?php echo HtmlEncode($activity_list->MTEFBudget->getPlaceHolder()) ?>" value="<?php echo $activity_list->MTEFBudget->EditValue ?>"<?php echo $activity_list->MTEFBudget->editAttributes() ?>>
</span>
<input type="hidden" data-table="activity" data-field="x_MTEFBudget" name="o<?php echo $activity_list->RowIndex ?>_MTEFBudget" id="o<?php echo $activity_list->RowIndex ?>_MTEFBudget" value="<?php echo HtmlEncode($activity_list->MTEFBudget->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_list->SupplementaryBudget->Visible) { // SupplementaryBudget ?>
		<td data-name="SupplementaryBudget">
<span id="el$rowindex$_activity_SupplementaryBudget" class="form-group activity_SupplementaryBudget">
<input type="text" data-table="activity" data-field="x_SupplementaryBudget" name="x<?php echo $activity_list->RowIndex ?>_SupplementaryBudget" id="x<?php echo $activity_list->RowIndex ?>_SupplementaryBudget" size="30" placeholder="<?php echo HtmlEncode($activity_list->SupplementaryBudget->getPlaceHolder()) ?>" value="<?php echo $activity_list->SupplementaryBudget->EditValue ?>"<?php echo $activity_list->SupplementaryBudget->editAttributes() ?>>
</span>
<input type="hidden" data-table="activity" data-field="x_SupplementaryBudget" name="o<?php echo $activity_list->RowIndex ?>_SupplementaryBudget" id="o<?php echo $activity_list->RowIndex ?>_SupplementaryBudget" value="<?php echo HtmlEncode($activity_list->SupplementaryBudget->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_list->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
		<td data-name="ExpectedAnnualAchievement">
<span id="el$rowindex$_activity_ExpectedAnnualAchievement" class="form-group activity_ExpectedAnnualAchievement">
<input type="text" data-table="activity" data-field="x_ExpectedAnnualAchievement" name="x<?php echo $activity_list->RowIndex ?>_ExpectedAnnualAchievement" id="x<?php echo $activity_list->RowIndex ?>_ExpectedAnnualAchievement" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($activity_list->ExpectedAnnualAchievement->getPlaceHolder()) ?>" value="<?php echo $activity_list->ExpectedAnnualAchievement->EditValue ?>"<?php echo $activity_list->ExpectedAnnualAchievement->editAttributes() ?>>
</span>
<input type="hidden" data-table="activity" data-field="x_ExpectedAnnualAchievement" name="o<?php echo $activity_list->RowIndex ?>_ExpectedAnnualAchievement" id="o<?php echo $activity_list->RowIndex ?>_ExpectedAnnualAchievement" value="<?php echo HtmlEncode($activity_list->ExpectedAnnualAchievement->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($activity_list->ActivityLocation->Visible) { // ActivityLocation ?>
		<td data-name="ActivityLocation">
<span id="el$rowindex$_activity_ActivityLocation" class="form-group activity_ActivityLocation">
<input type="text" data-table="activity" data-field="x_ActivityLocation" name="x<?php echo $activity_list->RowIndex ?>_ActivityLocation" id="x<?php echo $activity_list->RowIndex ?>_ActivityLocation" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($activity_list->ActivityLocation->getPlaceHolder()) ?>" value="<?php echo $activity_list->ActivityLocation->EditValue ?>"<?php echo $activity_list->ActivityLocation->editAttributes() ?>>
</span>
<input type="hidden" data-table="activity" data-field="x_ActivityLocation" name="o<?php echo $activity_list->RowIndex ?>_ActivityLocation" id="o<?php echo $activity_list->RowIndex ?>_ActivityLocation" value="<?php echo HtmlEncode($activity_list->ActivityLocation->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$activity_list->ListOptions->render("body", "right", $activity_list->RowIndex);
?>
<script>
loadjs.ready(["factivitylist", "load"], function() {
	factivitylist.updateLists(<?php echo $activity_list->RowIndex ?>);
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
<?php if ($activity_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $activity_list->FormKeyCountName ?>" id="<?php echo $activity_list->FormKeyCountName ?>" value="<?php echo $activity_list->KeyCount ?>">
<?php echo $activity_list->MultiSelectKey ?>
<?php } ?>
<?php if ($activity_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $activity_list->FormKeyCountName ?>" id="<?php echo $activity_list->FormKeyCountName ?>" value="<?php echo $activity_list->KeyCount ?>">
<?php echo $activity_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$activity->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($activity_list->Recordset)
	$activity_list->Recordset->Close();
?>
<?php if (!$activity_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$activity_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $activity_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $activity_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($activity_list->TotalRecords == 0 && !$activity->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $activity_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$activity_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$activity_list->isExport()) { ?>
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
$activity_list->terminate();
?>