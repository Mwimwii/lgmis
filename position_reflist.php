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
$position_ref_list = new position_ref_list();

// Run the page
$position_ref_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$position_ref_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$position_ref_list->isExport()) { ?>
<script>
var fposition_reflist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fposition_reflist = currentForm = new ew.Form("fposition_reflist", "list");
	fposition_reflist.formKeyCountName = '<?php echo $position_ref_list->FormKeyCountName ?>';

	// Validate form
	fposition_reflist.validate = function() {
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
			<?php if ($position_ref_list->PositionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_list->PositionCode->caption(), $position_ref_list->PositionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_list->PositionName->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_list->PositionName->caption(), $position_ref_list->PositionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_list->RequisiteQualification->Required) { ?>
				elm = this.getElements("x" + infix + "_RequisiteQualification");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_list->RequisiteQualification->caption(), $position_ref_list->RequisiteQualification->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_list->JobCode->Required) { ?>
				elm = this.getElements("x" + infix + "_JobCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_list->JobCode->caption(), $position_ref_list->JobCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_JobCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($position_ref_list->JobCode->errorMessage()) ?>");
			<?php if ($position_ref_list->SalaryScale->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryScale");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_list->SalaryScale->caption(), $position_ref_list->SalaryScale->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_list->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_list->ProvinceCode->caption(), $position_ref_list->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_list->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_list->LACode->caption(), $position_ref_list->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_list->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_list->DepartmentCode->caption(), $position_ref_list->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_ref_list->FieldQualified->Required) { ?>
				elm = this.getElements("x" + infix + "_FieldQualified");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_ref_list->FieldQualified->caption(), $position_ref_list->FieldQualified->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FieldQualified");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($position_ref_list->FieldQualified->errorMessage()) ?>");

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
	fposition_reflist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "PositionName", false)) return false;
		if (ew.valueChanged(fobj, infix, "RequisiteQualification", false)) return false;
		if (ew.valueChanged(fobj, infix, "JobCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SalaryScale", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProvinceCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "FieldQualified", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fposition_reflist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fposition_reflist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fposition_reflist.lists["x_RequisiteQualification"] = <?php echo $position_ref_list->RequisiteQualification->Lookup->toClientList($position_ref_list) ?>;
	fposition_reflist.lists["x_RequisiteQualification"].options = <?php echo JsonEncode($position_ref_list->RequisiteQualification->lookupOptions()) ?>;
	fposition_reflist.lists["x_JobCode"] = <?php echo $position_ref_list->JobCode->Lookup->toClientList($position_ref_list) ?>;
	fposition_reflist.lists["x_JobCode"].options = <?php echo JsonEncode($position_ref_list->JobCode->lookupOptions()) ?>;
	fposition_reflist.autoSuggests["x_JobCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fposition_reflist.lists["x_SalaryScale"] = <?php echo $position_ref_list->SalaryScale->Lookup->toClientList($position_ref_list) ?>;
	fposition_reflist.lists["x_SalaryScale"].options = <?php echo JsonEncode($position_ref_list->SalaryScale->lookupOptions()) ?>;
	fposition_reflist.lists["x_ProvinceCode"] = <?php echo $position_ref_list->ProvinceCode->Lookup->toClientList($position_ref_list) ?>;
	fposition_reflist.lists["x_ProvinceCode"].options = <?php echo JsonEncode($position_ref_list->ProvinceCode->lookupOptions()) ?>;
	fposition_reflist.lists["x_LACode"] = <?php echo $position_ref_list->LACode->Lookup->toClientList($position_ref_list) ?>;
	fposition_reflist.lists["x_LACode"].options = <?php echo JsonEncode($position_ref_list->LACode->lookupOptions()) ?>;
	fposition_reflist.lists["x_DepartmentCode"] = <?php echo $position_ref_list->DepartmentCode->Lookup->toClientList($position_ref_list) ?>;
	fposition_reflist.lists["x_DepartmentCode"].options = <?php echo JsonEncode($position_ref_list->DepartmentCode->lookupOptions()) ?>;
	loadjs.done("fposition_reflist");
});
var fposition_reflistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fposition_reflistsrch = currentSearchForm = new ew.Form("fposition_reflistsrch");

	// Dynamic selection lists
	// Filters

	fposition_reflistsrch.filterList = <?php echo $position_ref_list->getFilterList() ?>;

	// Init search panel as collapsed
	fposition_reflistsrch.initSearchPanel = true;
	loadjs.done("fposition_reflistsrch");
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
<?php if (!$position_ref_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($position_ref_list->TotalRecords > 0 && $position_ref_list->ExportOptions->visible()) { ?>
<?php $position_ref_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($position_ref_list->ImportOptions->visible()) { ?>
<?php $position_ref_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($position_ref_list->SearchOptions->visible()) { ?>
<?php $position_ref_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($position_ref_list->FilterOptions->visible()) { ?>
<?php $position_ref_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$position_ref_list->isExport() || Config("EXPORT_MASTER_RECORD") && $position_ref_list->isExport("print")) { ?>
<?php
if ($position_ref_list->DbMasterFilter != "" && $position_ref->getCurrentMasterTable() == "dept_section") {
	if ($position_ref_list->MasterRecordExists) {
		include_once "dept_sectionmaster.php";
	}
}
?>
<?php } ?>
<?php
$position_ref_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$position_ref_list->isExport() && !$position_ref->CurrentAction) { ?>
<form name="fposition_reflistsrch" id="fposition_reflistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fposition_reflistsrch-search-panel" class="<?php echo $position_ref_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="position_ref">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $position_ref_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($position_ref_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($position_ref_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $position_ref_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($position_ref_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($position_ref_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($position_ref_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($position_ref_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $position_ref_list->showPageHeader(); ?>
<?php
$position_ref_list->showMessage();
?>
<?php if ($position_ref_list->TotalRecords > 0 || $position_ref->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($position_ref_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> position_ref">
<?php if (!$position_ref_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$position_ref_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $position_ref_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $position_ref_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fposition_reflist" id="fposition_reflist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="position_ref">
<?php if ($position_ref->getCurrentMasterTable() == "dept_section" && $position_ref->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="dept_section">
<input type="hidden" name="fk_SectionCode" value="<?php echo HtmlEncode($position_ref_list->SectionCode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_position_ref" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($position_ref_list->TotalRecords > 0 || $position_ref_list->isGridEdit()) { ?>
<table id="tbl_position_reflist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$position_ref->RowType = ROWTYPE_HEADER;

// Render list options
$position_ref_list->renderListOptions();

// Render list options (header, left)
$position_ref_list->ListOptions->render("header", "left");
?>
<?php if ($position_ref_list->PositionCode->Visible) { // PositionCode ?>
	<?php if ($position_ref_list->SortUrl($position_ref_list->PositionCode) == "") { ?>
		<th data-name="PositionCode" class="<?php echo $position_ref_list->PositionCode->headerCellClass() ?>"><div id="elh_position_ref_PositionCode" class="position_ref_PositionCode"><div class="ew-table-header-caption"><?php echo $position_ref_list->PositionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionCode" class="<?php echo $position_ref_list->PositionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $position_ref_list->SortUrl($position_ref_list->PositionCode) ?>', 1);"><div id="elh_position_ref_PositionCode" class="position_ref_PositionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_list->PositionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_list->PositionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_list->PositionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_ref_list->PositionName->Visible) { // PositionName ?>
	<?php if ($position_ref_list->SortUrl($position_ref_list->PositionName) == "") { ?>
		<th data-name="PositionName" class="<?php echo $position_ref_list->PositionName->headerCellClass() ?>"><div id="elh_position_ref_PositionName" class="position_ref_PositionName"><div class="ew-table-header-caption"><?php echo $position_ref_list->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionName" class="<?php echo $position_ref_list->PositionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $position_ref_list->SortUrl($position_ref_list->PositionName) ?>', 1);"><div id="elh_position_ref_PositionName" class="position_ref_PositionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_list->PositionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($position_ref_list->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_list->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_ref_list->RequisiteQualification->Visible) { // RequisiteQualification ?>
	<?php if ($position_ref_list->SortUrl($position_ref_list->RequisiteQualification) == "") { ?>
		<th data-name="RequisiteQualification" class="<?php echo $position_ref_list->RequisiteQualification->headerCellClass() ?>"><div id="elh_position_ref_RequisiteQualification" class="position_ref_RequisiteQualification"><div class="ew-table-header-caption"><?php echo $position_ref_list->RequisiteQualification->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RequisiteQualification" class="<?php echo $position_ref_list->RequisiteQualification->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $position_ref_list->SortUrl($position_ref_list->RequisiteQualification) ?>', 1);"><div id="elh_position_ref_RequisiteQualification" class="position_ref_RequisiteQualification">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_list->RequisiteQualification->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_list->RequisiteQualification->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_list->RequisiteQualification->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_ref_list->JobCode->Visible) { // JobCode ?>
	<?php if ($position_ref_list->SortUrl($position_ref_list->JobCode) == "") { ?>
		<th data-name="JobCode" class="<?php echo $position_ref_list->JobCode->headerCellClass() ?>"><div id="elh_position_ref_JobCode" class="position_ref_JobCode"><div class="ew-table-header-caption"><?php echo $position_ref_list->JobCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobCode" class="<?php echo $position_ref_list->JobCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $position_ref_list->SortUrl($position_ref_list->JobCode) ?>', 1);"><div id="elh_position_ref_JobCode" class="position_ref_JobCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_list->JobCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_list->JobCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_list->JobCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_ref_list->SalaryScale->Visible) { // SalaryScale ?>
	<?php if ($position_ref_list->SortUrl($position_ref_list->SalaryScale) == "") { ?>
		<th data-name="SalaryScale" class="<?php echo $position_ref_list->SalaryScale->headerCellClass() ?>"><div id="elh_position_ref_SalaryScale" class="position_ref_SalaryScale"><div class="ew-table-header-caption"><?php echo $position_ref_list->SalaryScale->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SalaryScale" class="<?php echo $position_ref_list->SalaryScale->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $position_ref_list->SortUrl($position_ref_list->SalaryScale) ?>', 1);"><div id="elh_position_ref_SalaryScale" class="position_ref_SalaryScale">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_list->SalaryScale->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_list->SalaryScale->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_list->SalaryScale->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_ref_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($position_ref_list->SortUrl($position_ref_list->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $position_ref_list->ProvinceCode->headerCellClass() ?>"><div id="elh_position_ref_ProvinceCode" class="position_ref_ProvinceCode"><div class="ew-table-header-caption"><?php echo $position_ref_list->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $position_ref_list->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $position_ref_list->SortUrl($position_ref_list->ProvinceCode) ?>', 1);"><div id="elh_position_ref_ProvinceCode" class="position_ref_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_list->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_list->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_list->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_ref_list->LACode->Visible) { // LACode ?>
	<?php if ($position_ref_list->SortUrl($position_ref_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $position_ref_list->LACode->headerCellClass() ?>"><div id="elh_position_ref_LACode" class="position_ref_LACode"><div class="ew-table-header-caption"><?php echo $position_ref_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $position_ref_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $position_ref_list->SortUrl($position_ref_list->LACode) ?>', 1);"><div id="elh_position_ref_LACode" class="position_ref_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_list->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_ref_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($position_ref_list->SortUrl($position_ref_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $position_ref_list->DepartmentCode->headerCellClass() ?>"><div id="elh_position_ref_DepartmentCode" class="position_ref_DepartmentCode"><div class="ew-table-header-caption"><?php echo $position_ref_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $position_ref_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $position_ref_list->SortUrl($position_ref_list->DepartmentCode) ?>', 1);"><div id="elh_position_ref_DepartmentCode" class="position_ref_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_ref_list->FieldQualified->Visible) { // FieldQualified ?>
	<?php if ($position_ref_list->SortUrl($position_ref_list->FieldQualified) == "") { ?>
		<th data-name="FieldQualified" class="<?php echo $position_ref_list->FieldQualified->headerCellClass() ?>"><div id="elh_position_ref_FieldQualified" class="position_ref_FieldQualified"><div class="ew-table-header-caption"><?php echo $position_ref_list->FieldQualified->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FieldQualified" class="<?php echo $position_ref_list->FieldQualified->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $position_ref_list->SortUrl($position_ref_list->FieldQualified) ?>', 1);"><div id="elh_position_ref_FieldQualified" class="position_ref_FieldQualified">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_list->FieldQualified->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_list->FieldQualified->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_list->FieldQualified->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$position_ref_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($position_ref_list->ExportAll && $position_ref_list->isExport()) {
	$position_ref_list->StopRecord = $position_ref_list->TotalRecords;
} else {

	// Set the last record to display
	if ($position_ref_list->TotalRecords > $position_ref_list->StartRecord + $position_ref_list->DisplayRecords - 1)
		$position_ref_list->StopRecord = $position_ref_list->StartRecord + $position_ref_list->DisplayRecords - 1;
	else
		$position_ref_list->StopRecord = $position_ref_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($position_ref->isConfirm() || $position_ref_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($position_ref_list->FormKeyCountName) && ($position_ref_list->isGridAdd() || $position_ref_list->isGridEdit() || $position_ref->isConfirm())) {
		$position_ref_list->KeyCount = $CurrentForm->getValue($position_ref_list->FormKeyCountName);
		$position_ref_list->StopRecord = $position_ref_list->StartRecord + $position_ref_list->KeyCount - 1;
	}
}
$position_ref_list->RecordCount = $position_ref_list->StartRecord - 1;
if ($position_ref_list->Recordset && !$position_ref_list->Recordset->EOF) {
	$position_ref_list->Recordset->moveFirst();
	$selectLimit = $position_ref_list->UseSelectLimit;
	if (!$selectLimit && $position_ref_list->StartRecord > 1)
		$position_ref_list->Recordset->move($position_ref_list->StartRecord - 1);
} elseif (!$position_ref->AllowAddDeleteRow && $position_ref_list->StopRecord == 0) {
	$position_ref_list->StopRecord = $position_ref->GridAddRowCount;
}

// Initialize aggregate
$position_ref->RowType = ROWTYPE_AGGREGATEINIT;
$position_ref->resetAttributes();
$position_ref_list->renderRow();
if ($position_ref_list->isGridAdd())
	$position_ref_list->RowIndex = 0;
if ($position_ref_list->isGridEdit())
	$position_ref_list->RowIndex = 0;
while ($position_ref_list->RecordCount < $position_ref_list->StopRecord) {
	$position_ref_list->RecordCount++;
	if ($position_ref_list->RecordCount >= $position_ref_list->StartRecord) {
		$position_ref_list->RowCount++;
		if ($position_ref_list->isGridAdd() || $position_ref_list->isGridEdit() || $position_ref->isConfirm()) {
			$position_ref_list->RowIndex++;
			$CurrentForm->Index = $position_ref_list->RowIndex;
			if ($CurrentForm->hasValue($position_ref_list->FormActionName) && ($position_ref->isConfirm() || $position_ref_list->EventCancelled))
				$position_ref_list->RowAction = strval($CurrentForm->getValue($position_ref_list->FormActionName));
			elseif ($position_ref_list->isGridAdd())
				$position_ref_list->RowAction = "insert";
			else
				$position_ref_list->RowAction = "";
		}

		// Set up key count
		$position_ref_list->KeyCount = $position_ref_list->RowIndex;

		// Init row class and style
		$position_ref->resetAttributes();
		$position_ref->CssClass = "";
		if ($position_ref_list->isGridAdd()) {
			$position_ref_list->loadRowValues(); // Load default values
		} else {
			$position_ref_list->loadRowValues($position_ref_list->Recordset); // Load row values
		}
		$position_ref->RowType = ROWTYPE_VIEW; // Render view
		if ($position_ref_list->isGridAdd()) // Grid add
			$position_ref->RowType = ROWTYPE_ADD; // Render add
		if ($position_ref_list->isGridAdd() && $position_ref->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$position_ref_list->restoreCurrentRowFormValues($position_ref_list->RowIndex); // Restore form values
		if ($position_ref_list->isGridEdit()) { // Grid edit
			if ($position_ref->EventCancelled)
				$position_ref_list->restoreCurrentRowFormValues($position_ref_list->RowIndex); // Restore form values
			if ($position_ref_list->RowAction == "insert")
				$position_ref->RowType = ROWTYPE_ADD; // Render add
			else
				$position_ref->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($position_ref_list->isGridEdit() && ($position_ref->RowType == ROWTYPE_EDIT || $position_ref->RowType == ROWTYPE_ADD) && $position_ref->EventCancelled) // Update failed
			$position_ref_list->restoreCurrentRowFormValues($position_ref_list->RowIndex); // Restore form values
		if ($position_ref->RowType == ROWTYPE_EDIT) // Edit row
			$position_ref_list->EditRowCount++;

		// Set up row id / data-rowindex
		$position_ref->RowAttrs->merge(["data-rowindex" => $position_ref_list->RowCount, "id" => "r" . $position_ref_list->RowCount . "_position_ref", "data-rowtype" => $position_ref->RowType]);

		// Render row
		$position_ref_list->renderRow();

		// Render list options
		$position_ref_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($position_ref_list->RowAction != "delete" && $position_ref_list->RowAction != "insertdelete" && !($position_ref_list->RowAction == "insert" && $position_ref->isConfirm() && $position_ref_list->emptyRow())) {
?>
	<tr <?php echo $position_ref->rowAttributes() ?>>
<?php

// Render list options (body, left)
$position_ref_list->ListOptions->render("body", "left", $position_ref_list->RowCount);
?>
	<?php if ($position_ref_list->PositionCode->Visible) { // PositionCode ?>
		<td data-name="PositionCode" <?php echo $position_ref_list->PositionCode->cellAttributes() ?>>
<?php if ($position_ref->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_PositionCode" class="form-group"></span>
<input type="hidden" data-table="position_ref" data-field="x_PositionCode" name="o<?php echo $position_ref_list->RowIndex ?>_PositionCode" id="o<?php echo $position_ref_list->RowIndex ?>_PositionCode" value="<?php echo HtmlEncode($position_ref_list->PositionCode->OldValue) ?>">
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_PositionCode" class="form-group">
<span<?php echo $position_ref_list->PositionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($position_ref_list->PositionCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="position_ref" data-field="x_PositionCode" name="x<?php echo $position_ref_list->RowIndex ?>_PositionCode" id="x<?php echo $position_ref_list->RowIndex ?>_PositionCode" value="<?php echo HtmlEncode($position_ref_list->PositionCode->CurrentValue) ?>">
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_PositionCode">
<span<?php echo $position_ref_list->PositionCode->viewAttributes() ?>><?php echo $position_ref_list->PositionCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($position_ref_list->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName" <?php echo $position_ref_list->PositionName->cellAttributes() ?>>
<?php if ($position_ref->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_PositionName" class="form-group">
<input type="text" data-table="position_ref" data-field="x_PositionName" name="x<?php echo $position_ref_list->RowIndex ?>_PositionName" id="x<?php echo $position_ref_list->RowIndex ?>_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($position_ref_list->PositionName->getPlaceHolder()) ?>" value="<?php echo $position_ref_list->PositionName->EditValue ?>"<?php echo $position_ref_list->PositionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="position_ref" data-field="x_PositionName" name="o<?php echo $position_ref_list->RowIndex ?>_PositionName" id="o<?php echo $position_ref_list->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($position_ref_list->PositionName->OldValue) ?>">
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_PositionName" class="form-group">
<input type="text" data-table="position_ref" data-field="x_PositionName" name="x<?php echo $position_ref_list->RowIndex ?>_PositionName" id="x<?php echo $position_ref_list->RowIndex ?>_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($position_ref_list->PositionName->getPlaceHolder()) ?>" value="<?php echo $position_ref_list->PositionName->EditValue ?>"<?php echo $position_ref_list->PositionName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_PositionName">
<span<?php echo $position_ref_list->PositionName->viewAttributes() ?>><?php echo $position_ref_list->PositionName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($position_ref_list->RequisiteQualification->Visible) { // RequisiteQualification ?>
		<td data-name="RequisiteQualification" <?php echo $position_ref_list->RequisiteQualification->cellAttributes() ?>>
<?php if ($position_ref->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_RequisiteQualification" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_RequisiteQualification" data-value-separator="<?php echo $position_ref_list->RequisiteQualification->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_list->RowIndex ?>_RequisiteQualification" name="x<?php echo $position_ref_list->RowIndex ?>_RequisiteQualification"<?php echo $position_ref_list->RequisiteQualification->editAttributes() ?>>
			<?php echo $position_ref_list->RequisiteQualification->selectOptionListHtml("x{$position_ref_list->RowIndex}_RequisiteQualification") ?>
		</select>
</div>
<?php echo $position_ref_list->RequisiteQualification->Lookup->getParamTag($position_ref_list, "p_x" . $position_ref_list->RowIndex . "_RequisiteQualification") ?>
</span>
<input type="hidden" data-table="position_ref" data-field="x_RequisiteQualification" name="o<?php echo $position_ref_list->RowIndex ?>_RequisiteQualification" id="o<?php echo $position_ref_list->RowIndex ?>_RequisiteQualification" value="<?php echo HtmlEncode($position_ref_list->RequisiteQualification->OldValue) ?>">
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_RequisiteQualification" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_RequisiteQualification" data-value-separator="<?php echo $position_ref_list->RequisiteQualification->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_list->RowIndex ?>_RequisiteQualification" name="x<?php echo $position_ref_list->RowIndex ?>_RequisiteQualification"<?php echo $position_ref_list->RequisiteQualification->editAttributes() ?>>
			<?php echo $position_ref_list->RequisiteQualification->selectOptionListHtml("x{$position_ref_list->RowIndex}_RequisiteQualification") ?>
		</select>
</div>
<?php echo $position_ref_list->RequisiteQualification->Lookup->getParamTag($position_ref_list, "p_x" . $position_ref_list->RowIndex . "_RequisiteQualification") ?>
</span>
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_RequisiteQualification">
<span<?php echo $position_ref_list->RequisiteQualification->viewAttributes() ?>><?php echo $position_ref_list->RequisiteQualification->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($position_ref_list->JobCode->Visible) { // JobCode ?>
		<td data-name="JobCode" <?php echo $position_ref_list->JobCode->cellAttributes() ?>>
<?php if ($position_ref->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_JobCode" class="form-group">
<?php
$onchange = $position_ref_list->JobCode->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$position_ref_list->JobCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $position_ref_list->RowIndex ?>_JobCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $position_ref_list->RowIndex ?>_JobCode" id="sv_x<?php echo $position_ref_list->RowIndex ?>_JobCode" value="<?php echo RemoveHtml($position_ref_list->JobCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($position_ref_list->JobCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($position_ref_list->JobCode->getPlaceHolder()) ?>"<?php echo $position_ref_list->JobCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($position_ref_list->JobCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $position_ref_list->RowIndex ?>_JobCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($position_ref_list->JobCode->ReadOnly || $position_ref_list->JobCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="position_ref" data-field="x_JobCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $position_ref_list->JobCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $position_ref_list->RowIndex ?>_JobCode" id="x<?php echo $position_ref_list->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($position_ref_list->JobCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fposition_reflist"], function() {
	fposition_reflist.createAutoSuggest({"id":"x<?php echo $position_ref_list->RowIndex ?>_JobCode","forceSelect":true});
});
</script>
<?php echo $position_ref_list->JobCode->Lookup->getParamTag($position_ref_list, "p_x" . $position_ref_list->RowIndex . "_JobCode") ?>
</span>
<input type="hidden" data-table="position_ref" data-field="x_JobCode" name="o<?php echo $position_ref_list->RowIndex ?>_JobCode" id="o<?php echo $position_ref_list->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($position_ref_list->JobCode->OldValue) ?>">
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_JobCode" class="form-group">
<?php
$onchange = $position_ref_list->JobCode->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$position_ref_list->JobCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $position_ref_list->RowIndex ?>_JobCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $position_ref_list->RowIndex ?>_JobCode" id="sv_x<?php echo $position_ref_list->RowIndex ?>_JobCode" value="<?php echo RemoveHtml($position_ref_list->JobCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($position_ref_list->JobCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($position_ref_list->JobCode->getPlaceHolder()) ?>"<?php echo $position_ref_list->JobCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($position_ref_list->JobCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $position_ref_list->RowIndex ?>_JobCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($position_ref_list->JobCode->ReadOnly || $position_ref_list->JobCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="position_ref" data-field="x_JobCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $position_ref_list->JobCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $position_ref_list->RowIndex ?>_JobCode" id="x<?php echo $position_ref_list->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($position_ref_list->JobCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fposition_reflist"], function() {
	fposition_reflist.createAutoSuggest({"id":"x<?php echo $position_ref_list->RowIndex ?>_JobCode","forceSelect":true});
});
</script>
<?php echo $position_ref_list->JobCode->Lookup->getParamTag($position_ref_list, "p_x" . $position_ref_list->RowIndex . "_JobCode") ?>
</span>
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_JobCode">
<span<?php echo $position_ref_list->JobCode->viewAttributes() ?>><?php echo $position_ref_list->JobCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($position_ref_list->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale" <?php echo $position_ref_list->SalaryScale->cellAttributes() ?>>
<?php if ($position_ref->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_SalaryScale" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_SalaryScale" data-value-separator="<?php echo $position_ref_list->SalaryScale->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_list->RowIndex ?>_SalaryScale" name="x<?php echo $position_ref_list->RowIndex ?>_SalaryScale"<?php echo $position_ref_list->SalaryScale->editAttributes() ?>>
			<?php echo $position_ref_list->SalaryScale->selectOptionListHtml("x{$position_ref_list->RowIndex}_SalaryScale") ?>
		</select>
</div>
<?php echo $position_ref_list->SalaryScale->Lookup->getParamTag($position_ref_list, "p_x" . $position_ref_list->RowIndex . "_SalaryScale") ?>
</span>
<input type="hidden" data-table="position_ref" data-field="x_SalaryScale" name="o<?php echo $position_ref_list->RowIndex ?>_SalaryScale" id="o<?php echo $position_ref_list->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($position_ref_list->SalaryScale->OldValue) ?>">
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_SalaryScale" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_SalaryScale" data-value-separator="<?php echo $position_ref_list->SalaryScale->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_list->RowIndex ?>_SalaryScale" name="x<?php echo $position_ref_list->RowIndex ?>_SalaryScale"<?php echo $position_ref_list->SalaryScale->editAttributes() ?>>
			<?php echo $position_ref_list->SalaryScale->selectOptionListHtml("x{$position_ref_list->RowIndex}_SalaryScale") ?>
		</select>
</div>
<?php echo $position_ref_list->SalaryScale->Lookup->getParamTag($position_ref_list, "p_x" . $position_ref_list->RowIndex . "_SalaryScale") ?>
</span>
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_SalaryScale">
<span<?php echo $position_ref_list->SalaryScale->viewAttributes() ?>><?php echo $position_ref_list->SalaryScale->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($position_ref_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $position_ref_list->ProvinceCode->cellAttributes() ?>>
<?php if ($position_ref->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_ProvinceCode" class="form-group">
<?php $position_ref_list->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_ProvinceCode" data-value-separator="<?php echo $position_ref_list->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_list->RowIndex ?>_ProvinceCode" name="x<?php echo $position_ref_list->RowIndex ?>_ProvinceCode"<?php echo $position_ref_list->ProvinceCode->editAttributes() ?>>
			<?php echo $position_ref_list->ProvinceCode->selectOptionListHtml("x{$position_ref_list->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $position_ref_list->ProvinceCode->Lookup->getParamTag($position_ref_list, "p_x" . $position_ref_list->RowIndex . "_ProvinceCode") ?>
</span>
<input type="hidden" data-table="position_ref" data-field="x_ProvinceCode" name="o<?php echo $position_ref_list->RowIndex ?>_ProvinceCode" id="o<?php echo $position_ref_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($position_ref_list->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_ProvinceCode" class="form-group">
<?php $position_ref_list->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_ProvinceCode" data-value-separator="<?php echo $position_ref_list->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_list->RowIndex ?>_ProvinceCode" name="x<?php echo $position_ref_list->RowIndex ?>_ProvinceCode"<?php echo $position_ref_list->ProvinceCode->editAttributes() ?>>
			<?php echo $position_ref_list->ProvinceCode->selectOptionListHtml("x{$position_ref_list->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $position_ref_list->ProvinceCode->Lookup->getParamTag($position_ref_list, "p_x" . $position_ref_list->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_ProvinceCode">
<span<?php echo $position_ref_list->ProvinceCode->viewAttributes() ?>><?php echo $position_ref_list->ProvinceCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($position_ref_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $position_ref_list->LACode->cellAttributes() ?>>
<?php if ($position_ref->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_LACode" class="form-group">
<?php $position_ref_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_LACode" data-value-separator="<?php echo $position_ref_list->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_list->RowIndex ?>_LACode" name="x<?php echo $position_ref_list->RowIndex ?>_LACode"<?php echo $position_ref_list->LACode->editAttributes() ?>>
			<?php echo $position_ref_list->LACode->selectOptionListHtml("x{$position_ref_list->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $position_ref_list->LACode->Lookup->getParamTag($position_ref_list, "p_x" . $position_ref_list->RowIndex . "_LACode") ?>
</span>
<input type="hidden" data-table="position_ref" data-field="x_LACode" name="o<?php echo $position_ref_list->RowIndex ?>_LACode" id="o<?php echo $position_ref_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($position_ref_list->LACode->OldValue) ?>">
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_LACode" class="form-group">
<?php $position_ref_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_LACode" data-value-separator="<?php echo $position_ref_list->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_list->RowIndex ?>_LACode" name="x<?php echo $position_ref_list->RowIndex ?>_LACode"<?php echo $position_ref_list->LACode->editAttributes() ?>>
			<?php echo $position_ref_list->LACode->selectOptionListHtml("x{$position_ref_list->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $position_ref_list->LACode->Lookup->getParamTag($position_ref_list, "p_x" . $position_ref_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_LACode">
<span<?php echo $position_ref_list->LACode->viewAttributes() ?>><?php echo $position_ref_list->LACode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($position_ref_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $position_ref_list->DepartmentCode->cellAttributes() ?>>
<?php if ($position_ref->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_DepartmentCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_DepartmentCode" data-value-separator="<?php echo $position_ref_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_list->RowIndex ?>_DepartmentCode" name="x<?php echo $position_ref_list->RowIndex ?>_DepartmentCode"<?php echo $position_ref_list->DepartmentCode->editAttributes() ?>>
			<?php echo $position_ref_list->DepartmentCode->selectOptionListHtml("x{$position_ref_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $position_ref_list->DepartmentCode->Lookup->getParamTag($position_ref_list, "p_x" . $position_ref_list->RowIndex . "_DepartmentCode") ?>
</span>
<input type="hidden" data-table="position_ref" data-field="x_DepartmentCode" name="o<?php echo $position_ref_list->RowIndex ?>_DepartmentCode" id="o<?php echo $position_ref_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($position_ref_list->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_DepartmentCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_DepartmentCode" data-value-separator="<?php echo $position_ref_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_list->RowIndex ?>_DepartmentCode" name="x<?php echo $position_ref_list->RowIndex ?>_DepartmentCode"<?php echo $position_ref_list->DepartmentCode->editAttributes() ?>>
			<?php echo $position_ref_list->DepartmentCode->selectOptionListHtml("x{$position_ref_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $position_ref_list->DepartmentCode->Lookup->getParamTag($position_ref_list, "p_x" . $position_ref_list->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_DepartmentCode">
<span<?php echo $position_ref_list->DepartmentCode->viewAttributes() ?>><?php echo $position_ref_list->DepartmentCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($position_ref_list->FieldQualified->Visible) { // FieldQualified ?>
		<td data-name="FieldQualified" <?php echo $position_ref_list->FieldQualified->cellAttributes() ?>>
<?php if ($position_ref->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_FieldQualified" class="form-group">
<input type="text" data-table="position_ref" data-field="x_FieldQualified" name="x<?php echo $position_ref_list->RowIndex ?>_FieldQualified" id="x<?php echo $position_ref_list->RowIndex ?>_FieldQualified" size="30" placeholder="<?php echo HtmlEncode($position_ref_list->FieldQualified->getPlaceHolder()) ?>" value="<?php echo $position_ref_list->FieldQualified->EditValue ?>"<?php echo $position_ref_list->FieldQualified->editAttributes() ?>>
</span>
<input type="hidden" data-table="position_ref" data-field="x_FieldQualified" name="o<?php echo $position_ref_list->RowIndex ?>_FieldQualified" id="o<?php echo $position_ref_list->RowIndex ?>_FieldQualified" value="<?php echo HtmlEncode($position_ref_list->FieldQualified->OldValue) ?>">
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_FieldQualified" class="form-group">
<input type="text" data-table="position_ref" data-field="x_FieldQualified" name="x<?php echo $position_ref_list->RowIndex ?>_FieldQualified" id="x<?php echo $position_ref_list->RowIndex ?>_FieldQualified" size="30" placeholder="<?php echo HtmlEncode($position_ref_list->FieldQualified->getPlaceHolder()) ?>" value="<?php echo $position_ref_list->FieldQualified->EditValue ?>"<?php echo $position_ref_list->FieldQualified->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($position_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $position_ref_list->RowCount ?>_position_ref_FieldQualified">
<span<?php echo $position_ref_list->FieldQualified->viewAttributes() ?>><?php echo $position_ref_list->FieldQualified->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$position_ref_list->ListOptions->render("body", "right", $position_ref_list->RowCount);
?>
	</tr>
<?php if ($position_ref->RowType == ROWTYPE_ADD || $position_ref->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fposition_reflist", "load"], function() {
	fposition_reflist.updateLists(<?php echo $position_ref_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$position_ref_list->isGridAdd())
		if (!$position_ref_list->Recordset->EOF)
			$position_ref_list->Recordset->moveNext();
}
?>
<?php
	if ($position_ref_list->isGridAdd() || $position_ref_list->isGridEdit()) {
		$position_ref_list->RowIndex = '$rowindex$';
		$position_ref_list->loadRowValues();

		// Set row properties
		$position_ref->resetAttributes();
		$position_ref->RowAttrs->merge(["data-rowindex" => $position_ref_list->RowIndex, "id" => "r0_position_ref", "data-rowtype" => ROWTYPE_ADD]);
		$position_ref->RowAttrs->appendClass("ew-template");
		$position_ref->RowType = ROWTYPE_ADD;

		// Render row
		$position_ref_list->renderRow();

		// Render list options
		$position_ref_list->renderListOptions();
		$position_ref_list->StartRowCount = 0;
?>
	<tr <?php echo $position_ref->rowAttributes() ?>>
<?php

// Render list options (body, left)
$position_ref_list->ListOptions->render("body", "left", $position_ref_list->RowIndex);
?>
	<?php if ($position_ref_list->PositionCode->Visible) { // PositionCode ?>
		<td data-name="PositionCode">
<span id="el$rowindex$_position_ref_PositionCode" class="form-group position_ref_PositionCode"></span>
<input type="hidden" data-table="position_ref" data-field="x_PositionCode" name="o<?php echo $position_ref_list->RowIndex ?>_PositionCode" id="o<?php echo $position_ref_list->RowIndex ?>_PositionCode" value="<?php echo HtmlEncode($position_ref_list->PositionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($position_ref_list->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName">
<span id="el$rowindex$_position_ref_PositionName" class="form-group position_ref_PositionName">
<input type="text" data-table="position_ref" data-field="x_PositionName" name="x<?php echo $position_ref_list->RowIndex ?>_PositionName" id="x<?php echo $position_ref_list->RowIndex ?>_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($position_ref_list->PositionName->getPlaceHolder()) ?>" value="<?php echo $position_ref_list->PositionName->EditValue ?>"<?php echo $position_ref_list->PositionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="position_ref" data-field="x_PositionName" name="o<?php echo $position_ref_list->RowIndex ?>_PositionName" id="o<?php echo $position_ref_list->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($position_ref_list->PositionName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($position_ref_list->RequisiteQualification->Visible) { // RequisiteQualification ?>
		<td data-name="RequisiteQualification">
<span id="el$rowindex$_position_ref_RequisiteQualification" class="form-group position_ref_RequisiteQualification">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_RequisiteQualification" data-value-separator="<?php echo $position_ref_list->RequisiteQualification->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_list->RowIndex ?>_RequisiteQualification" name="x<?php echo $position_ref_list->RowIndex ?>_RequisiteQualification"<?php echo $position_ref_list->RequisiteQualification->editAttributes() ?>>
			<?php echo $position_ref_list->RequisiteQualification->selectOptionListHtml("x{$position_ref_list->RowIndex}_RequisiteQualification") ?>
		</select>
</div>
<?php echo $position_ref_list->RequisiteQualification->Lookup->getParamTag($position_ref_list, "p_x" . $position_ref_list->RowIndex . "_RequisiteQualification") ?>
</span>
<input type="hidden" data-table="position_ref" data-field="x_RequisiteQualification" name="o<?php echo $position_ref_list->RowIndex ?>_RequisiteQualification" id="o<?php echo $position_ref_list->RowIndex ?>_RequisiteQualification" value="<?php echo HtmlEncode($position_ref_list->RequisiteQualification->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($position_ref_list->JobCode->Visible) { // JobCode ?>
		<td data-name="JobCode">
<span id="el$rowindex$_position_ref_JobCode" class="form-group position_ref_JobCode">
<?php
$onchange = $position_ref_list->JobCode->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$position_ref_list->JobCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $position_ref_list->RowIndex ?>_JobCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $position_ref_list->RowIndex ?>_JobCode" id="sv_x<?php echo $position_ref_list->RowIndex ?>_JobCode" value="<?php echo RemoveHtml($position_ref_list->JobCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($position_ref_list->JobCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($position_ref_list->JobCode->getPlaceHolder()) ?>"<?php echo $position_ref_list->JobCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($position_ref_list->JobCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $position_ref_list->RowIndex ?>_JobCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($position_ref_list->JobCode->ReadOnly || $position_ref_list->JobCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="position_ref" data-field="x_JobCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $position_ref_list->JobCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $position_ref_list->RowIndex ?>_JobCode" id="x<?php echo $position_ref_list->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($position_ref_list->JobCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fposition_reflist"], function() {
	fposition_reflist.createAutoSuggest({"id":"x<?php echo $position_ref_list->RowIndex ?>_JobCode","forceSelect":true});
});
</script>
<?php echo $position_ref_list->JobCode->Lookup->getParamTag($position_ref_list, "p_x" . $position_ref_list->RowIndex . "_JobCode") ?>
</span>
<input type="hidden" data-table="position_ref" data-field="x_JobCode" name="o<?php echo $position_ref_list->RowIndex ?>_JobCode" id="o<?php echo $position_ref_list->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($position_ref_list->JobCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($position_ref_list->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale">
<span id="el$rowindex$_position_ref_SalaryScale" class="form-group position_ref_SalaryScale">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_SalaryScale" data-value-separator="<?php echo $position_ref_list->SalaryScale->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_list->RowIndex ?>_SalaryScale" name="x<?php echo $position_ref_list->RowIndex ?>_SalaryScale"<?php echo $position_ref_list->SalaryScale->editAttributes() ?>>
			<?php echo $position_ref_list->SalaryScale->selectOptionListHtml("x{$position_ref_list->RowIndex}_SalaryScale") ?>
		</select>
</div>
<?php echo $position_ref_list->SalaryScale->Lookup->getParamTag($position_ref_list, "p_x" . $position_ref_list->RowIndex . "_SalaryScale") ?>
</span>
<input type="hidden" data-table="position_ref" data-field="x_SalaryScale" name="o<?php echo $position_ref_list->RowIndex ?>_SalaryScale" id="o<?php echo $position_ref_list->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($position_ref_list->SalaryScale->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($position_ref_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode">
<span id="el$rowindex$_position_ref_ProvinceCode" class="form-group position_ref_ProvinceCode">
<?php $position_ref_list->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_ProvinceCode" data-value-separator="<?php echo $position_ref_list->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_list->RowIndex ?>_ProvinceCode" name="x<?php echo $position_ref_list->RowIndex ?>_ProvinceCode"<?php echo $position_ref_list->ProvinceCode->editAttributes() ?>>
			<?php echo $position_ref_list->ProvinceCode->selectOptionListHtml("x{$position_ref_list->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $position_ref_list->ProvinceCode->Lookup->getParamTag($position_ref_list, "p_x" . $position_ref_list->RowIndex . "_ProvinceCode") ?>
</span>
<input type="hidden" data-table="position_ref" data-field="x_ProvinceCode" name="o<?php echo $position_ref_list->RowIndex ?>_ProvinceCode" id="o<?php echo $position_ref_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($position_ref_list->ProvinceCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($position_ref_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<span id="el$rowindex$_position_ref_LACode" class="form-group position_ref_LACode">
<?php $position_ref_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_LACode" data-value-separator="<?php echo $position_ref_list->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_list->RowIndex ?>_LACode" name="x<?php echo $position_ref_list->RowIndex ?>_LACode"<?php echo $position_ref_list->LACode->editAttributes() ?>>
			<?php echo $position_ref_list->LACode->selectOptionListHtml("x{$position_ref_list->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $position_ref_list->LACode->Lookup->getParamTag($position_ref_list, "p_x" . $position_ref_list->RowIndex . "_LACode") ?>
</span>
<input type="hidden" data-table="position_ref" data-field="x_LACode" name="o<?php echo $position_ref_list->RowIndex ?>_LACode" id="o<?php echo $position_ref_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($position_ref_list->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($position_ref_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<span id="el$rowindex$_position_ref_DepartmentCode" class="form-group position_ref_DepartmentCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="position_ref" data-field="x_DepartmentCode" data-value-separator="<?php echo $position_ref_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $position_ref_list->RowIndex ?>_DepartmentCode" name="x<?php echo $position_ref_list->RowIndex ?>_DepartmentCode"<?php echo $position_ref_list->DepartmentCode->editAttributes() ?>>
			<?php echo $position_ref_list->DepartmentCode->selectOptionListHtml("x{$position_ref_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $position_ref_list->DepartmentCode->Lookup->getParamTag($position_ref_list, "p_x" . $position_ref_list->RowIndex . "_DepartmentCode") ?>
</span>
<input type="hidden" data-table="position_ref" data-field="x_DepartmentCode" name="o<?php echo $position_ref_list->RowIndex ?>_DepartmentCode" id="o<?php echo $position_ref_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($position_ref_list->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($position_ref_list->FieldQualified->Visible) { // FieldQualified ?>
		<td data-name="FieldQualified">
<span id="el$rowindex$_position_ref_FieldQualified" class="form-group position_ref_FieldQualified">
<input type="text" data-table="position_ref" data-field="x_FieldQualified" name="x<?php echo $position_ref_list->RowIndex ?>_FieldQualified" id="x<?php echo $position_ref_list->RowIndex ?>_FieldQualified" size="30" placeholder="<?php echo HtmlEncode($position_ref_list->FieldQualified->getPlaceHolder()) ?>" value="<?php echo $position_ref_list->FieldQualified->EditValue ?>"<?php echo $position_ref_list->FieldQualified->editAttributes() ?>>
</span>
<input type="hidden" data-table="position_ref" data-field="x_FieldQualified" name="o<?php echo $position_ref_list->RowIndex ?>_FieldQualified" id="o<?php echo $position_ref_list->RowIndex ?>_FieldQualified" value="<?php echo HtmlEncode($position_ref_list->FieldQualified->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$position_ref_list->ListOptions->render("body", "right", $position_ref_list->RowIndex);
?>
<script>
loadjs.ready(["fposition_reflist", "load"], function() {
	fposition_reflist.updateLists(<?php echo $position_ref_list->RowIndex ?>);
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
<?php if ($position_ref_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $position_ref_list->FormKeyCountName ?>" id="<?php echo $position_ref_list->FormKeyCountName ?>" value="<?php echo $position_ref_list->KeyCount ?>">
<?php echo $position_ref_list->MultiSelectKey ?>
<?php } ?>
<?php if ($position_ref_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $position_ref_list->FormKeyCountName ?>" id="<?php echo $position_ref_list->FormKeyCountName ?>" value="<?php echo $position_ref_list->KeyCount ?>">
<?php echo $position_ref_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$position_ref->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($position_ref_list->Recordset)
	$position_ref_list->Recordset->Close();
?>
<?php if (!$position_ref_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$position_ref_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $position_ref_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $position_ref_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($position_ref_list->TotalRecords == 0 && !$position_ref->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $position_ref_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$position_ref_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$position_ref_list->isExport()) { ?>
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
$position_ref_list->terminate();
?>