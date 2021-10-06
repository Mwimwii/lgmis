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
$dept_section_list = new dept_section_list();

// Run the page
$dept_section_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dept_section_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$dept_section_list->isExport()) { ?>
<script>
var fdept_sectionlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdept_sectionlist = currentForm = new ew.Form("fdept_sectionlist", "list");
	fdept_sectionlist.formKeyCountName = '<?php echo $dept_section_list->FormKeyCountName ?>';

	// Validate form
	fdept_sectionlist.validate = function() {
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
			<?php if ($dept_section_list->SectionName->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_list->SectionName->caption(), $dept_section_list->SectionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dept_section_list->Telephone->Required) { ?>
				elm = this.getElements("x" + infix + "_Telephone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_list->Telephone->caption(), $dept_section_list->Telephone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dept_section_list->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_list->_Email->caption(), $dept_section_list->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dept_section_list->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_list->ProvinceCode->caption(), $dept_section_list->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dept_section_list->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_list->LACode->caption(), $dept_section_list->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dept_section_list->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_list->DepartmentCode->caption(), $dept_section_list->DepartmentCode->RequiredErrorMessage)) ?>");
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
	fdept_sectionlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "SectionName", false)) return false;
		if (ew.valueChanged(fobj, infix, "Telephone", false)) return false;
		if (ew.valueChanged(fobj, infix, "_Email", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProvinceCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdept_sectionlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdept_sectionlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdept_sectionlist.lists["x_ProvinceCode"] = <?php echo $dept_section_list->ProvinceCode->Lookup->toClientList($dept_section_list) ?>;
	fdept_sectionlist.lists["x_ProvinceCode"].options = <?php echo JsonEncode($dept_section_list->ProvinceCode->lookupOptions()) ?>;
	fdept_sectionlist.lists["x_LACode"] = <?php echo $dept_section_list->LACode->Lookup->toClientList($dept_section_list) ?>;
	fdept_sectionlist.lists["x_LACode"].options = <?php echo JsonEncode($dept_section_list->LACode->lookupOptions()) ?>;
	fdept_sectionlist.lists["x_DepartmentCode"] = <?php echo $dept_section_list->DepartmentCode->Lookup->toClientList($dept_section_list) ?>;
	fdept_sectionlist.lists["x_DepartmentCode"].options = <?php echo JsonEncode($dept_section_list->DepartmentCode->lookupOptions()) ?>;
	loadjs.done("fdept_sectionlist");
});
var fdept_sectionlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdept_sectionlistsrch = currentSearchForm = new ew.Form("fdept_sectionlistsrch");

	// Dynamic selection lists
	// Filters

	fdept_sectionlistsrch.filterList = <?php echo $dept_section_list->getFilterList() ?>;

	// Init search panel as collapsed
	fdept_sectionlistsrch.initSearchPanel = true;
	loadjs.done("fdept_sectionlistsrch");
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
<?php if (!$dept_section_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($dept_section_list->TotalRecords > 0 && $dept_section_list->ExportOptions->visible()) { ?>
<?php $dept_section_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($dept_section_list->ImportOptions->visible()) { ?>
<?php $dept_section_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($dept_section_list->SearchOptions->visible()) { ?>
<?php $dept_section_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($dept_section_list->FilterOptions->visible()) { ?>
<?php $dept_section_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$dept_section_list->isExport() || Config("EXPORT_MASTER_RECORD") && $dept_section_list->isExport("print")) { ?>
<?php
if ($dept_section_list->DbMasterFilter != "" && $dept_section->getCurrentMasterTable() == "department") {
	if ($dept_section_list->MasterRecordExists) {
		include_once "departmentmaster.php";
	}
}
?>
<?php } ?>
<?php
$dept_section_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$dept_section_list->isExport() && !$dept_section->CurrentAction) { ?>
<form name="fdept_sectionlistsrch" id="fdept_sectionlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdept_sectionlistsrch-search-panel" class="<?php echo $dept_section_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="dept_section">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $dept_section_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($dept_section_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($dept_section_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $dept_section_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($dept_section_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($dept_section_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($dept_section_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($dept_section_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $dept_section_list->showPageHeader(); ?>
<?php
$dept_section_list->showMessage();
?>
<?php if ($dept_section_list->TotalRecords > 0 || $dept_section->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($dept_section_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> dept_section">
<?php if (!$dept_section_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$dept_section_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $dept_section_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $dept_section_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdept_sectionlist" id="fdept_sectionlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dept_section">
<?php if ($dept_section->getCurrentMasterTable() == "department" && $dept_section->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="department">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($dept_section_list->DepartmentCode->getSessionValue()) ?>">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($dept_section_list->ProvinceCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($dept_section_list->LACode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_dept_section" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($dept_section_list->TotalRecords > 0 || $dept_section_list->isGridEdit()) { ?>
<table id="tbl_dept_sectionlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$dept_section->RowType = ROWTYPE_HEADER;

// Render list options
$dept_section_list->renderListOptions();

// Render list options (header, left)
$dept_section_list->ListOptions->render("header", "left");
?>
<?php if ($dept_section_list->SectionName->Visible) { // SectionName ?>
	<?php if ($dept_section_list->SortUrl($dept_section_list->SectionName) == "") { ?>
		<th data-name="SectionName" class="<?php echo $dept_section_list->SectionName->headerCellClass() ?>"><div id="elh_dept_section_SectionName" class="dept_section_SectionName"><div class="ew-table-header-caption"><?php echo $dept_section_list->SectionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionName" class="<?php echo $dept_section_list->SectionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dept_section_list->SortUrl($dept_section_list->SectionName) ?>', 1);"><div id="elh_dept_section_SectionName" class="dept_section_SectionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dept_section_list->SectionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dept_section_list->SectionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dept_section_list->SectionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dept_section_list->Telephone->Visible) { // Telephone ?>
	<?php if ($dept_section_list->SortUrl($dept_section_list->Telephone) == "") { ?>
		<th data-name="Telephone" class="<?php echo $dept_section_list->Telephone->headerCellClass() ?>"><div id="elh_dept_section_Telephone" class="dept_section_Telephone"><div class="ew-table-header-caption"><?php echo $dept_section_list->Telephone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Telephone" class="<?php echo $dept_section_list->Telephone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dept_section_list->SortUrl($dept_section_list->Telephone) ?>', 1);"><div id="elh_dept_section_Telephone" class="dept_section_Telephone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dept_section_list->Telephone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dept_section_list->Telephone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dept_section_list->Telephone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dept_section_list->_Email->Visible) { // Email ?>
	<?php if ($dept_section_list->SortUrl($dept_section_list->_Email) == "") { ?>
		<th data-name="_Email" class="<?php echo $dept_section_list->_Email->headerCellClass() ?>"><div id="elh_dept_section__Email" class="dept_section__Email"><div class="ew-table-header-caption"><?php echo $dept_section_list->_Email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_Email" class="<?php echo $dept_section_list->_Email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dept_section_list->SortUrl($dept_section_list->_Email) ?>', 1);"><div id="elh_dept_section__Email" class="dept_section__Email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dept_section_list->_Email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dept_section_list->_Email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dept_section_list->_Email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dept_section_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($dept_section_list->SortUrl($dept_section_list->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $dept_section_list->ProvinceCode->headerCellClass() ?>"><div id="elh_dept_section_ProvinceCode" class="dept_section_ProvinceCode"><div class="ew-table-header-caption"><?php echo $dept_section_list->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $dept_section_list->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dept_section_list->SortUrl($dept_section_list->ProvinceCode) ?>', 1);"><div id="elh_dept_section_ProvinceCode" class="dept_section_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dept_section_list->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($dept_section_list->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dept_section_list->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dept_section_list->LACode->Visible) { // LACode ?>
	<?php if ($dept_section_list->SortUrl($dept_section_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $dept_section_list->LACode->headerCellClass() ?>"><div id="elh_dept_section_LACode" class="dept_section_LACode"><div class="ew-table-header-caption"><?php echo $dept_section_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $dept_section_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dept_section_list->SortUrl($dept_section_list->LACode) ?>', 1);"><div id="elh_dept_section_LACode" class="dept_section_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dept_section_list->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($dept_section_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dept_section_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dept_section_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($dept_section_list->SortUrl($dept_section_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $dept_section_list->DepartmentCode->headerCellClass() ?>"><div id="elh_dept_section_DepartmentCode" class="dept_section_DepartmentCode"><div class="ew-table-header-caption"><?php echo $dept_section_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $dept_section_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dept_section_list->SortUrl($dept_section_list->DepartmentCode) ?>', 1);"><div id="elh_dept_section_DepartmentCode" class="dept_section_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dept_section_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($dept_section_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dept_section_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$dept_section_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($dept_section_list->ExportAll && $dept_section_list->isExport()) {
	$dept_section_list->StopRecord = $dept_section_list->TotalRecords;
} else {

	// Set the last record to display
	if ($dept_section_list->TotalRecords > $dept_section_list->StartRecord + $dept_section_list->DisplayRecords - 1)
		$dept_section_list->StopRecord = $dept_section_list->StartRecord + $dept_section_list->DisplayRecords - 1;
	else
		$dept_section_list->StopRecord = $dept_section_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($dept_section->isConfirm() || $dept_section_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($dept_section_list->FormKeyCountName) && ($dept_section_list->isGridAdd() || $dept_section_list->isGridEdit() || $dept_section->isConfirm())) {
		$dept_section_list->KeyCount = $CurrentForm->getValue($dept_section_list->FormKeyCountName);
		$dept_section_list->StopRecord = $dept_section_list->StartRecord + $dept_section_list->KeyCount - 1;
	}
}
$dept_section_list->RecordCount = $dept_section_list->StartRecord - 1;
if ($dept_section_list->Recordset && !$dept_section_list->Recordset->EOF) {
	$dept_section_list->Recordset->moveFirst();
	$selectLimit = $dept_section_list->UseSelectLimit;
	if (!$selectLimit && $dept_section_list->StartRecord > 1)
		$dept_section_list->Recordset->move($dept_section_list->StartRecord - 1);
} elseif (!$dept_section->AllowAddDeleteRow && $dept_section_list->StopRecord == 0) {
	$dept_section_list->StopRecord = $dept_section->GridAddRowCount;
}

// Initialize aggregate
$dept_section->RowType = ROWTYPE_AGGREGATEINIT;
$dept_section->resetAttributes();
$dept_section_list->renderRow();
if ($dept_section_list->isGridAdd())
	$dept_section_list->RowIndex = 0;
if ($dept_section_list->isGridEdit())
	$dept_section_list->RowIndex = 0;
while ($dept_section_list->RecordCount < $dept_section_list->StopRecord) {
	$dept_section_list->RecordCount++;
	if ($dept_section_list->RecordCount >= $dept_section_list->StartRecord) {
		$dept_section_list->RowCount++;
		if ($dept_section_list->isGridAdd() || $dept_section_list->isGridEdit() || $dept_section->isConfirm()) {
			$dept_section_list->RowIndex++;
			$CurrentForm->Index = $dept_section_list->RowIndex;
			if ($CurrentForm->hasValue($dept_section_list->FormActionName) && ($dept_section->isConfirm() || $dept_section_list->EventCancelled))
				$dept_section_list->RowAction = strval($CurrentForm->getValue($dept_section_list->FormActionName));
			elseif ($dept_section_list->isGridAdd())
				$dept_section_list->RowAction = "insert";
			else
				$dept_section_list->RowAction = "";
		}

		// Set up key count
		$dept_section_list->KeyCount = $dept_section_list->RowIndex;

		// Init row class and style
		$dept_section->resetAttributes();
		$dept_section->CssClass = "";
		if ($dept_section_list->isGridAdd()) {
			$dept_section_list->loadRowValues(); // Load default values
		} else {
			$dept_section_list->loadRowValues($dept_section_list->Recordset); // Load row values
		}
		$dept_section->RowType = ROWTYPE_VIEW; // Render view
		if ($dept_section_list->isGridAdd()) // Grid add
			$dept_section->RowType = ROWTYPE_ADD; // Render add
		if ($dept_section_list->isGridAdd() && $dept_section->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$dept_section_list->restoreCurrentRowFormValues($dept_section_list->RowIndex); // Restore form values
		if ($dept_section_list->isGridEdit()) { // Grid edit
			if ($dept_section->EventCancelled)
				$dept_section_list->restoreCurrentRowFormValues($dept_section_list->RowIndex); // Restore form values
			if ($dept_section_list->RowAction == "insert")
				$dept_section->RowType = ROWTYPE_ADD; // Render add
			else
				$dept_section->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($dept_section_list->isGridEdit() && ($dept_section->RowType == ROWTYPE_EDIT || $dept_section->RowType == ROWTYPE_ADD) && $dept_section->EventCancelled) // Update failed
			$dept_section_list->restoreCurrentRowFormValues($dept_section_list->RowIndex); // Restore form values
		if ($dept_section->RowType == ROWTYPE_EDIT) // Edit row
			$dept_section_list->EditRowCount++;

		// Set up row id / data-rowindex
		$dept_section->RowAttrs->merge(["data-rowindex" => $dept_section_list->RowCount, "id" => "r" . $dept_section_list->RowCount . "_dept_section", "data-rowtype" => $dept_section->RowType]);

		// Render row
		$dept_section_list->renderRow();

		// Render list options
		$dept_section_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($dept_section_list->RowAction != "delete" && $dept_section_list->RowAction != "insertdelete" && !($dept_section_list->RowAction == "insert" && $dept_section->isConfirm() && $dept_section_list->emptyRow())) {
?>
	<tr <?php echo $dept_section->rowAttributes() ?>>
<?php

// Render list options (body, left)
$dept_section_list->ListOptions->render("body", "left", $dept_section_list->RowCount);
?>
	<?php if ($dept_section_list->SectionName->Visible) { // SectionName ?>
		<td data-name="SectionName" <?php echo $dept_section_list->SectionName->cellAttributes() ?>>
<?php if ($dept_section->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dept_section_list->RowCount ?>_dept_section_SectionName" class="form-group">
<input type="text" data-table="dept_section" data-field="x_SectionName" name="x<?php echo $dept_section_list->RowIndex ?>_SectionName" id="x<?php echo $dept_section_list->RowIndex ?>_SectionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dept_section_list->SectionName->getPlaceHolder()) ?>" value="<?php echo $dept_section_list->SectionName->EditValue ?>"<?php echo $dept_section_list->SectionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="dept_section" data-field="x_SectionName" name="o<?php echo $dept_section_list->RowIndex ?>_SectionName" id="o<?php echo $dept_section_list->RowIndex ?>_SectionName" value="<?php echo HtmlEncode($dept_section_list->SectionName->OldValue) ?>">
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dept_section_list->RowCount ?>_dept_section_SectionName" class="form-group">
<input type="text" data-table="dept_section" data-field="x_SectionName" name="x<?php echo $dept_section_list->RowIndex ?>_SectionName" id="x<?php echo $dept_section_list->RowIndex ?>_SectionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dept_section_list->SectionName->getPlaceHolder()) ?>" value="<?php echo $dept_section_list->SectionName->EditValue ?>"<?php echo $dept_section_list->SectionName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dept_section_list->RowCount ?>_dept_section_SectionName">
<span<?php echo $dept_section_list->SectionName->viewAttributes() ?>><?php echo $dept_section_list->SectionName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="dept_section" data-field="x_SectionCode" name="x<?php echo $dept_section_list->RowIndex ?>_SectionCode" id="x<?php echo $dept_section_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($dept_section_list->SectionCode->CurrentValue) ?>">
<input type="hidden" data-table="dept_section" data-field="x_SectionCode" name="o<?php echo $dept_section_list->RowIndex ?>_SectionCode" id="o<?php echo $dept_section_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($dept_section_list->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_EDIT || $dept_section->CurrentMode == "edit") { ?>
<input type="hidden" data-table="dept_section" data-field="x_SectionCode" name="x<?php echo $dept_section_list->RowIndex ?>_SectionCode" id="x<?php echo $dept_section_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($dept_section_list->SectionCode->CurrentValue) ?>">
<?php } ?>
	<?php if ($dept_section_list->Telephone->Visible) { // Telephone ?>
		<td data-name="Telephone" <?php echo $dept_section_list->Telephone->cellAttributes() ?>>
<?php if ($dept_section->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dept_section_list->RowCount ?>_dept_section_Telephone" class="form-group">
<input type="text" data-table="dept_section" data-field="x_Telephone" name="x<?php echo $dept_section_list->RowIndex ?>_Telephone" id="x<?php echo $dept_section_list->RowIndex ?>_Telephone" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dept_section_list->Telephone->getPlaceHolder()) ?>" value="<?php echo $dept_section_list->Telephone->EditValue ?>"<?php echo $dept_section_list->Telephone->editAttributes() ?>>
</span>
<input type="hidden" data-table="dept_section" data-field="x_Telephone" name="o<?php echo $dept_section_list->RowIndex ?>_Telephone" id="o<?php echo $dept_section_list->RowIndex ?>_Telephone" value="<?php echo HtmlEncode($dept_section_list->Telephone->OldValue) ?>">
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dept_section_list->RowCount ?>_dept_section_Telephone" class="form-group">
<input type="text" data-table="dept_section" data-field="x_Telephone" name="x<?php echo $dept_section_list->RowIndex ?>_Telephone" id="x<?php echo $dept_section_list->RowIndex ?>_Telephone" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dept_section_list->Telephone->getPlaceHolder()) ?>" value="<?php echo $dept_section_list->Telephone->EditValue ?>"<?php echo $dept_section_list->Telephone->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dept_section_list->RowCount ?>_dept_section_Telephone">
<span<?php echo $dept_section_list->Telephone->viewAttributes() ?>><?php echo $dept_section_list->Telephone->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dept_section_list->_Email->Visible) { // Email ?>
		<td data-name="_Email" <?php echo $dept_section_list->_Email->cellAttributes() ?>>
<?php if ($dept_section->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $dept_section_list->RowCount ?>_dept_section__Email" class="form-group">
<input type="text" data-table="dept_section" data-field="x__Email" name="x<?php echo $dept_section_list->RowIndex ?>__Email" id="x<?php echo $dept_section_list->RowIndex ?>__Email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dept_section_list->_Email->getPlaceHolder()) ?>" value="<?php echo $dept_section_list->_Email->EditValue ?>"<?php echo $dept_section_list->_Email->editAttributes() ?>>
</span>
<input type="hidden" data-table="dept_section" data-field="x__Email" name="o<?php echo $dept_section_list->RowIndex ?>__Email" id="o<?php echo $dept_section_list->RowIndex ?>__Email" value="<?php echo HtmlEncode($dept_section_list->_Email->OldValue) ?>">
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $dept_section_list->RowCount ?>_dept_section__Email" class="form-group">
<input type="text" data-table="dept_section" data-field="x__Email" name="x<?php echo $dept_section_list->RowIndex ?>__Email" id="x<?php echo $dept_section_list->RowIndex ?>__Email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dept_section_list->_Email->getPlaceHolder()) ?>" value="<?php echo $dept_section_list->_Email->EditValue ?>"<?php echo $dept_section_list->_Email->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dept_section_list->RowCount ?>_dept_section__Email">
<span<?php echo $dept_section_list->_Email->viewAttributes() ?>><?php echo $dept_section_list->_Email->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dept_section_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $dept_section_list->ProvinceCode->cellAttributes() ?>>
<?php if ($dept_section->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($dept_section_list->ProvinceCode->getSessionValue() != "") { ?>
<span id="el<?php echo $dept_section_list->RowCount ?>_dept_section_ProvinceCode" class="form-group">
<span<?php echo $dept_section_list->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_list->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $dept_section_list->RowIndex ?>_ProvinceCode" name="x<?php echo $dept_section_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($dept_section_list->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $dept_section_list->RowCount ?>_dept_section_ProvinceCode" class="form-group">
<?php $dept_section_list->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dept_section" data-field="x_ProvinceCode" data-value-separator="<?php echo $dept_section_list->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $dept_section_list->RowIndex ?>_ProvinceCode" name="x<?php echo $dept_section_list->RowIndex ?>_ProvinceCode"<?php echo $dept_section_list->ProvinceCode->editAttributes() ?>>
			<?php echo $dept_section_list->ProvinceCode->selectOptionListHtml("x{$dept_section_list->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $dept_section_list->ProvinceCode->Lookup->getParamTag($dept_section_list, "p_x" . $dept_section_list->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="dept_section" data-field="x_ProvinceCode" name="o<?php echo $dept_section_list->RowIndex ?>_ProvinceCode" id="o<?php echo $dept_section_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($dept_section_list->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($dept_section_list->ProvinceCode->getSessionValue() != "") { ?>
<span id="el<?php echo $dept_section_list->RowCount ?>_dept_section_ProvinceCode" class="form-group">
<span<?php echo $dept_section_list->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_list->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $dept_section_list->RowIndex ?>_ProvinceCode" name="x<?php echo $dept_section_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($dept_section_list->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $dept_section_list->RowCount ?>_dept_section_ProvinceCode" class="form-group">
<?php $dept_section_list->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dept_section" data-field="x_ProvinceCode" data-value-separator="<?php echo $dept_section_list->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $dept_section_list->RowIndex ?>_ProvinceCode" name="x<?php echo $dept_section_list->RowIndex ?>_ProvinceCode"<?php echo $dept_section_list->ProvinceCode->editAttributes() ?>>
			<?php echo $dept_section_list->ProvinceCode->selectOptionListHtml("x{$dept_section_list->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $dept_section_list->ProvinceCode->Lookup->getParamTag($dept_section_list, "p_x" . $dept_section_list->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dept_section_list->RowCount ?>_dept_section_ProvinceCode">
<span<?php echo $dept_section_list->ProvinceCode->viewAttributes() ?>><?php echo $dept_section_list->ProvinceCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dept_section_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $dept_section_list->LACode->cellAttributes() ?>>
<?php if ($dept_section->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($dept_section_list->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $dept_section_list->RowCount ?>_dept_section_LACode" class="form-group">
<span<?php echo $dept_section_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $dept_section_list->RowIndex ?>_LACode" name="x<?php echo $dept_section_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($dept_section_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $dept_section_list->RowCount ?>_dept_section_LACode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dept_section" data-field="x_LACode" data-value-separator="<?php echo $dept_section_list->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $dept_section_list->RowIndex ?>_LACode" name="x<?php echo $dept_section_list->RowIndex ?>_LACode"<?php echo $dept_section_list->LACode->editAttributes() ?>>
			<?php echo $dept_section_list->LACode->selectOptionListHtml("x{$dept_section_list->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $dept_section_list->LACode->Lookup->getParamTag($dept_section_list, "p_x" . $dept_section_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="dept_section" data-field="x_LACode" name="o<?php echo $dept_section_list->RowIndex ?>_LACode" id="o<?php echo $dept_section_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($dept_section_list->LACode->OldValue) ?>">
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($dept_section_list->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $dept_section_list->RowCount ?>_dept_section_LACode" class="form-group">
<span<?php echo $dept_section_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $dept_section_list->RowIndex ?>_LACode" name="x<?php echo $dept_section_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($dept_section_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $dept_section_list->RowCount ?>_dept_section_LACode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dept_section" data-field="x_LACode" data-value-separator="<?php echo $dept_section_list->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $dept_section_list->RowIndex ?>_LACode" name="x<?php echo $dept_section_list->RowIndex ?>_LACode"<?php echo $dept_section_list->LACode->editAttributes() ?>>
			<?php echo $dept_section_list->LACode->selectOptionListHtml("x{$dept_section_list->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $dept_section_list->LACode->Lookup->getParamTag($dept_section_list, "p_x" . $dept_section_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dept_section_list->RowCount ?>_dept_section_LACode">
<span<?php echo $dept_section_list->LACode->viewAttributes() ?>><?php echo $dept_section_list->LACode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($dept_section_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $dept_section_list->DepartmentCode->cellAttributes() ?>>
<?php if ($dept_section->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($dept_section_list->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $dept_section_list->RowCount ?>_dept_section_DepartmentCode" class="form-group">
<span<?php echo $dept_section_list->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_list->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $dept_section_list->RowIndex ?>_DepartmentCode" name="x<?php echo $dept_section_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($dept_section_list->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $dept_section_list->RowCount ?>_dept_section_DepartmentCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dept_section" data-field="x_DepartmentCode" data-value-separator="<?php echo $dept_section_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $dept_section_list->RowIndex ?>_DepartmentCode" name="x<?php echo $dept_section_list->RowIndex ?>_DepartmentCode"<?php echo $dept_section_list->DepartmentCode->editAttributes() ?>>
			<?php echo $dept_section_list->DepartmentCode->selectOptionListHtml("x{$dept_section_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $dept_section_list->DepartmentCode->Lookup->getParamTag($dept_section_list, "p_x" . $dept_section_list->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="dept_section" data-field="x_DepartmentCode" name="o<?php echo $dept_section_list->RowIndex ?>_DepartmentCode" id="o<?php echo $dept_section_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($dept_section_list->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($dept_section_list->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $dept_section_list->RowCount ?>_dept_section_DepartmentCode" class="form-group">
<span<?php echo $dept_section_list->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_list->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $dept_section_list->RowIndex ?>_DepartmentCode" name="x<?php echo $dept_section_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($dept_section_list->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $dept_section_list->RowCount ?>_dept_section_DepartmentCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dept_section" data-field="x_DepartmentCode" data-value-separator="<?php echo $dept_section_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $dept_section_list->RowIndex ?>_DepartmentCode" name="x<?php echo $dept_section_list->RowIndex ?>_DepartmentCode"<?php echo $dept_section_list->DepartmentCode->editAttributes() ?>>
			<?php echo $dept_section_list->DepartmentCode->selectOptionListHtml("x{$dept_section_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $dept_section_list->DepartmentCode->Lookup->getParamTag($dept_section_list, "p_x" . $dept_section_list->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($dept_section->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $dept_section_list->RowCount ?>_dept_section_DepartmentCode">
<span<?php echo $dept_section_list->DepartmentCode->viewAttributes() ?>><?php echo $dept_section_list->DepartmentCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$dept_section_list->ListOptions->render("body", "right", $dept_section_list->RowCount);
?>
	</tr>
<?php if ($dept_section->RowType == ROWTYPE_ADD || $dept_section->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdept_sectionlist", "load"], function() {
	fdept_sectionlist.updateLists(<?php echo $dept_section_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$dept_section_list->isGridAdd())
		if (!$dept_section_list->Recordset->EOF)
			$dept_section_list->Recordset->moveNext();
}
?>
<?php
	if ($dept_section_list->isGridAdd() || $dept_section_list->isGridEdit()) {
		$dept_section_list->RowIndex = '$rowindex$';
		$dept_section_list->loadRowValues();

		// Set row properties
		$dept_section->resetAttributes();
		$dept_section->RowAttrs->merge(["data-rowindex" => $dept_section_list->RowIndex, "id" => "r0_dept_section", "data-rowtype" => ROWTYPE_ADD]);
		$dept_section->RowAttrs->appendClass("ew-template");
		$dept_section->RowType = ROWTYPE_ADD;

		// Render row
		$dept_section_list->renderRow();

		// Render list options
		$dept_section_list->renderListOptions();
		$dept_section_list->StartRowCount = 0;
?>
	<tr <?php echo $dept_section->rowAttributes() ?>>
<?php

// Render list options (body, left)
$dept_section_list->ListOptions->render("body", "left", $dept_section_list->RowIndex);
?>
	<?php if ($dept_section_list->SectionName->Visible) { // SectionName ?>
		<td data-name="SectionName">
<span id="el$rowindex$_dept_section_SectionName" class="form-group dept_section_SectionName">
<input type="text" data-table="dept_section" data-field="x_SectionName" name="x<?php echo $dept_section_list->RowIndex ?>_SectionName" id="x<?php echo $dept_section_list->RowIndex ?>_SectionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dept_section_list->SectionName->getPlaceHolder()) ?>" value="<?php echo $dept_section_list->SectionName->EditValue ?>"<?php echo $dept_section_list->SectionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="dept_section" data-field="x_SectionName" name="o<?php echo $dept_section_list->RowIndex ?>_SectionName" id="o<?php echo $dept_section_list->RowIndex ?>_SectionName" value="<?php echo HtmlEncode($dept_section_list->SectionName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dept_section_list->Telephone->Visible) { // Telephone ?>
		<td data-name="Telephone">
<span id="el$rowindex$_dept_section_Telephone" class="form-group dept_section_Telephone">
<input type="text" data-table="dept_section" data-field="x_Telephone" name="x<?php echo $dept_section_list->RowIndex ?>_Telephone" id="x<?php echo $dept_section_list->RowIndex ?>_Telephone" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dept_section_list->Telephone->getPlaceHolder()) ?>" value="<?php echo $dept_section_list->Telephone->EditValue ?>"<?php echo $dept_section_list->Telephone->editAttributes() ?>>
</span>
<input type="hidden" data-table="dept_section" data-field="x_Telephone" name="o<?php echo $dept_section_list->RowIndex ?>_Telephone" id="o<?php echo $dept_section_list->RowIndex ?>_Telephone" value="<?php echo HtmlEncode($dept_section_list->Telephone->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dept_section_list->_Email->Visible) { // Email ?>
		<td data-name="_Email">
<span id="el$rowindex$_dept_section__Email" class="form-group dept_section__Email">
<input type="text" data-table="dept_section" data-field="x__Email" name="x<?php echo $dept_section_list->RowIndex ?>__Email" id="x<?php echo $dept_section_list->RowIndex ?>__Email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dept_section_list->_Email->getPlaceHolder()) ?>" value="<?php echo $dept_section_list->_Email->EditValue ?>"<?php echo $dept_section_list->_Email->editAttributes() ?>>
</span>
<input type="hidden" data-table="dept_section" data-field="x__Email" name="o<?php echo $dept_section_list->RowIndex ?>__Email" id="o<?php echo $dept_section_list->RowIndex ?>__Email" value="<?php echo HtmlEncode($dept_section_list->_Email->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dept_section_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode">
<?php if ($dept_section_list->ProvinceCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_dept_section_ProvinceCode" class="form-group dept_section_ProvinceCode">
<span<?php echo $dept_section_list->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_list->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $dept_section_list->RowIndex ?>_ProvinceCode" name="x<?php echo $dept_section_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($dept_section_list->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_dept_section_ProvinceCode" class="form-group dept_section_ProvinceCode">
<?php $dept_section_list->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dept_section" data-field="x_ProvinceCode" data-value-separator="<?php echo $dept_section_list->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $dept_section_list->RowIndex ?>_ProvinceCode" name="x<?php echo $dept_section_list->RowIndex ?>_ProvinceCode"<?php echo $dept_section_list->ProvinceCode->editAttributes() ?>>
			<?php echo $dept_section_list->ProvinceCode->selectOptionListHtml("x{$dept_section_list->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $dept_section_list->ProvinceCode->Lookup->getParamTag($dept_section_list, "p_x" . $dept_section_list->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="dept_section" data-field="x_ProvinceCode" name="o<?php echo $dept_section_list->RowIndex ?>_ProvinceCode" id="o<?php echo $dept_section_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($dept_section_list->ProvinceCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dept_section_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if ($dept_section_list->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_dept_section_LACode" class="form-group dept_section_LACode">
<span<?php echo $dept_section_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $dept_section_list->RowIndex ?>_LACode" name="x<?php echo $dept_section_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($dept_section_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_dept_section_LACode" class="form-group dept_section_LACode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dept_section" data-field="x_LACode" data-value-separator="<?php echo $dept_section_list->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $dept_section_list->RowIndex ?>_LACode" name="x<?php echo $dept_section_list->RowIndex ?>_LACode"<?php echo $dept_section_list->LACode->editAttributes() ?>>
			<?php echo $dept_section_list->LACode->selectOptionListHtml("x{$dept_section_list->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $dept_section_list->LACode->Lookup->getParamTag($dept_section_list, "p_x" . $dept_section_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="dept_section" data-field="x_LACode" name="o<?php echo $dept_section_list->RowIndex ?>_LACode" id="o<?php echo $dept_section_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($dept_section_list->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($dept_section_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<?php if ($dept_section_list->DepartmentCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_dept_section_DepartmentCode" class="form-group dept_section_DepartmentCode">
<span<?php echo $dept_section_list->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_list->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $dept_section_list->RowIndex ?>_DepartmentCode" name="x<?php echo $dept_section_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($dept_section_list->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_dept_section_DepartmentCode" class="form-group dept_section_DepartmentCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dept_section" data-field="x_DepartmentCode" data-value-separator="<?php echo $dept_section_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $dept_section_list->RowIndex ?>_DepartmentCode" name="x<?php echo $dept_section_list->RowIndex ?>_DepartmentCode"<?php echo $dept_section_list->DepartmentCode->editAttributes() ?>>
			<?php echo $dept_section_list->DepartmentCode->selectOptionListHtml("x{$dept_section_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $dept_section_list->DepartmentCode->Lookup->getParamTag($dept_section_list, "p_x" . $dept_section_list->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="dept_section" data-field="x_DepartmentCode" name="o<?php echo $dept_section_list->RowIndex ?>_DepartmentCode" id="o<?php echo $dept_section_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($dept_section_list->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$dept_section_list->ListOptions->render("body", "right", $dept_section_list->RowIndex);
?>
<script>
loadjs.ready(["fdept_sectionlist", "load"], function() {
	fdept_sectionlist.updateLists(<?php echo $dept_section_list->RowIndex ?>);
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
<?php if ($dept_section_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $dept_section_list->FormKeyCountName ?>" id="<?php echo $dept_section_list->FormKeyCountName ?>" value="<?php echo $dept_section_list->KeyCount ?>">
<?php echo $dept_section_list->MultiSelectKey ?>
<?php } ?>
<?php if ($dept_section_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $dept_section_list->FormKeyCountName ?>" id="<?php echo $dept_section_list->FormKeyCountName ?>" value="<?php echo $dept_section_list->KeyCount ?>">
<?php echo $dept_section_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$dept_section->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($dept_section_list->Recordset)
	$dept_section_list->Recordset->Close();
?>
<?php if (!$dept_section_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$dept_section_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $dept_section_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $dept_section_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($dept_section_list->TotalRecords == 0 && !$dept_section->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $dept_section_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$dept_section_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$dept_section_list->isExport()) { ?>
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
$dept_section_list->terminate();
?>