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
$security_matrix_list = new security_matrix_list();

// Run the page
$security_matrix_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$security_matrix_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$security_matrix_list->isExport()) { ?>
<script>
var fsecurity_matrixlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fsecurity_matrixlist = currentForm = new ew.Form("fsecurity_matrixlist", "list");
	fsecurity_matrixlist.formKeyCountName = '<?php echo $security_matrix_list->FormKeyCountName ?>';
	loadjs.done("fsecurity_matrixlist");
});
var fsecurity_matrixlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fsecurity_matrixlistsrch = currentSearchForm = new ew.Form("fsecurity_matrixlistsrch");

	// Dynamic selection lists
	// Filters

	fsecurity_matrixlistsrch.filterList = <?php echo $security_matrix_list->getFilterList() ?>;

	// Init search panel as collapsed
	fsecurity_matrixlistsrch.initSearchPanel = true;
	loadjs.done("fsecurity_matrixlistsrch");
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
<?php if (!$security_matrix_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($security_matrix_list->TotalRecords > 0 && $security_matrix_list->ExportOptions->visible()) { ?>
<?php $security_matrix_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($security_matrix_list->ImportOptions->visible()) { ?>
<?php $security_matrix_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($security_matrix_list->SearchOptions->visible()) { ?>
<?php $security_matrix_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($security_matrix_list->FilterOptions->visible()) { ?>
<?php $security_matrix_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$security_matrix_list->isExport() || Config("EXPORT_MASTER_RECORD") && $security_matrix_list->isExport("print")) { ?>
<?php
if ($security_matrix_list->DbMasterFilter != "" && $security_matrix->getCurrentMasterTable() == "musers") {
	if ($security_matrix_list->MasterRecordExists) {
		include_once "musersmaster.php";
	}
}
?>
<?php } ?>
<?php
$security_matrix_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$security_matrix_list->isExport() && !$security_matrix->CurrentAction) { ?>
<form name="fsecurity_matrixlistsrch" id="fsecurity_matrixlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsecurity_matrixlistsrch-search-panel" class="<?php echo $security_matrix_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="security_matrix">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $security_matrix_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($security_matrix_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($security_matrix_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $security_matrix_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($security_matrix_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($security_matrix_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($security_matrix_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($security_matrix_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $security_matrix_list->showPageHeader(); ?>
<?php
$security_matrix_list->showMessage();
?>
<?php if ($security_matrix_list->TotalRecords > 0 || $security_matrix->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($security_matrix_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> security_matrix">
<?php if (!$security_matrix_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$security_matrix_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $security_matrix_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $security_matrix_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fsecurity_matrixlist" id="fsecurity_matrixlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="security_matrix">
<?php if ($security_matrix->getCurrentMasterTable() == "musers" && $security_matrix->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="musers">
<input type="hidden" name="fk_UserCode" value="<?php echo HtmlEncode($security_matrix_list->UserCode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_security_matrix" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($security_matrix_list->TotalRecords > 0 || $security_matrix_list->isGridEdit()) { ?>
<table id="tbl_security_matrixlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$security_matrix->RowType = ROWTYPE_HEADER;

// Render list options
$security_matrix_list->renderListOptions();

// Render list options (header, left)
$security_matrix_list->ListOptions->render("header", "left");
?>
<?php if ($security_matrix_list->UserCode->Visible) { // UserCode ?>
	<?php if ($security_matrix_list->SortUrl($security_matrix_list->UserCode) == "") { ?>
		<th data-name="UserCode" class="<?php echo $security_matrix_list->UserCode->headerCellClass() ?>"><div id="elh_security_matrix_UserCode" class="security_matrix_UserCode"><div class="ew-table-header-caption"><?php echo $security_matrix_list->UserCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UserCode" class="<?php echo $security_matrix_list->UserCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $security_matrix_list->SortUrl($security_matrix_list->UserCode) ?>', 1);"><div id="elh_security_matrix_UserCode" class="security_matrix_UserCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_list->UserCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_list->UserCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_list->UserCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_list->PeriodCode->Visible) { // PeriodCode ?>
	<?php if ($security_matrix_list->SortUrl($security_matrix_list->PeriodCode) == "") { ?>
		<th data-name="PeriodCode" class="<?php echo $security_matrix_list->PeriodCode->headerCellClass() ?>"><div id="elh_security_matrix_PeriodCode" class="security_matrix_PeriodCode"><div class="ew-table-header-caption"><?php echo $security_matrix_list->PeriodCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodCode" class="<?php echo $security_matrix_list->PeriodCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $security_matrix_list->SortUrl($security_matrix_list->PeriodCode) ?>', 1);"><div id="elh_security_matrix_PeriodCode" class="security_matrix_PeriodCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_list->PeriodCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_list->PeriodCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_list->PeriodCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($security_matrix_list->SortUrl($security_matrix_list->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $security_matrix_list->ProvinceCode->headerCellClass() ?>"><div id="elh_security_matrix_ProvinceCode" class="security_matrix_ProvinceCode"><div class="ew-table-header-caption"><?php echo $security_matrix_list->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $security_matrix_list->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $security_matrix_list->SortUrl($security_matrix_list->ProvinceCode) ?>', 1);"><div id="elh_security_matrix_ProvinceCode" class="security_matrix_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_list->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_list->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_list->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_list->LACode->Visible) { // LACode ?>
	<?php if ($security_matrix_list->SortUrl($security_matrix_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $security_matrix_list->LACode->headerCellClass() ?>"><div id="elh_security_matrix_LACode" class="security_matrix_LACode"><div class="ew-table-header-caption"><?php echo $security_matrix_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $security_matrix_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $security_matrix_list->SortUrl($security_matrix_list->LACode) ?>', 1);"><div id="elh_security_matrix_LACode" class="security_matrix_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_list->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($security_matrix_list->SortUrl($security_matrix_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $security_matrix_list->DepartmentCode->headerCellClass() ?>"><div id="elh_security_matrix_DepartmentCode" class="security_matrix_DepartmentCode"><div class="ew-table-header-caption"><?php echo $security_matrix_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $security_matrix_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $security_matrix_list->SortUrl($security_matrix_list->DepartmentCode) ?>', 1);"><div id="elh_security_matrix_DepartmentCode" class="security_matrix_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_list->SectionCode->Visible) { // SectionCode ?>
	<?php if ($security_matrix_list->SortUrl($security_matrix_list->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $security_matrix_list->SectionCode->headerCellClass() ?>"><div id="elh_security_matrix_SectionCode" class="security_matrix_SectionCode"><div class="ew-table-header-caption"><?php echo $security_matrix_list->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $security_matrix_list->SectionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $security_matrix_list->SortUrl($security_matrix_list->SectionCode) ?>', 1);"><div id="elh_security_matrix_SectionCode" class="security_matrix_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_list->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_list->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_list->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_list->SecurityNumber->Visible) { // SecurityNumber ?>
	<?php if ($security_matrix_list->SortUrl($security_matrix_list->SecurityNumber) == "") { ?>
		<th data-name="SecurityNumber" class="<?php echo $security_matrix_list->SecurityNumber->headerCellClass() ?>"><div id="elh_security_matrix_SecurityNumber" class="security_matrix_SecurityNumber"><div class="ew-table-header-caption"><?php echo $security_matrix_list->SecurityNumber->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SecurityNumber" class="<?php echo $security_matrix_list->SecurityNumber->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $security_matrix_list->SortUrl($security_matrix_list->SecurityNumber) ?>', 1);"><div id="elh_security_matrix_SecurityNumber" class="security_matrix_SecurityNumber">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_list->SecurityNumber->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_list->SecurityNumber->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_list->SecurityNumber->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_list->ValidFrom->Visible) { // ValidFrom ?>
	<?php if ($security_matrix_list->SortUrl($security_matrix_list->ValidFrom) == "") { ?>
		<th data-name="ValidFrom" class="<?php echo $security_matrix_list->ValidFrom->headerCellClass() ?>"><div id="elh_security_matrix_ValidFrom" class="security_matrix_ValidFrom"><div class="ew-table-header-caption"><?php echo $security_matrix_list->ValidFrom->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ValidFrom" class="<?php echo $security_matrix_list->ValidFrom->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $security_matrix_list->SortUrl($security_matrix_list->ValidFrom) ?>', 1);"><div id="elh_security_matrix_ValidFrom" class="security_matrix_ValidFrom">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_list->ValidFrom->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_list->ValidFrom->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_list->ValidFrom->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_list->ValidTo->Visible) { // ValidTo ?>
	<?php if ($security_matrix_list->SortUrl($security_matrix_list->ValidTo) == "") { ?>
		<th data-name="ValidTo" class="<?php echo $security_matrix_list->ValidTo->headerCellClass() ?>"><div id="elh_security_matrix_ValidTo" class="security_matrix_ValidTo"><div class="ew-table-header-caption"><?php echo $security_matrix_list->ValidTo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ValidTo" class="<?php echo $security_matrix_list->ValidTo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $security_matrix_list->SortUrl($security_matrix_list->ValidTo) ?>', 1);"><div id="elh_security_matrix_ValidTo" class="security_matrix_ValidTo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_list->ValidTo->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_list->ValidTo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_list->ValidTo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_list->ApproveLevel->Visible) { // ApproveLevel ?>
	<?php if ($security_matrix_list->SortUrl($security_matrix_list->ApproveLevel) == "") { ?>
		<th data-name="ApproveLevel" class="<?php echo $security_matrix_list->ApproveLevel->headerCellClass() ?>"><div id="elh_security_matrix_ApproveLevel" class="security_matrix_ApproveLevel"><div class="ew-table-header-caption"><?php echo $security_matrix_list->ApproveLevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ApproveLevel" class="<?php echo $security_matrix_list->ApproveLevel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $security_matrix_list->SortUrl($security_matrix_list->ApproveLevel) ?>', 1);"><div id="elh_security_matrix_ApproveLevel" class="security_matrix_ApproveLevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_list->ApproveLevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_list->ApproveLevel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_list->ApproveLevel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_list->ActivityCode->Visible) { // ActivityCode ?>
	<?php if ($security_matrix_list->SortUrl($security_matrix_list->ActivityCode) == "") { ?>
		<th data-name="ActivityCode" class="<?php echo $security_matrix_list->ActivityCode->headerCellClass() ?>"><div id="elh_security_matrix_ActivityCode" class="security_matrix_ActivityCode"><div class="ew-table-header-caption"><?php echo $security_matrix_list->ActivityCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActivityCode" class="<?php echo $security_matrix_list->ActivityCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $security_matrix_list->SortUrl($security_matrix_list->ActivityCode) ?>', 1);"><div id="elh_security_matrix_ActivityCode" class="security_matrix_ActivityCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_list->ActivityCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_list->ActivityCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_list->ActivityCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$security_matrix_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($security_matrix_list->ExportAll && $security_matrix_list->isExport()) {
	$security_matrix_list->StopRecord = $security_matrix_list->TotalRecords;
} else {

	// Set the last record to display
	if ($security_matrix_list->TotalRecords > $security_matrix_list->StartRecord + $security_matrix_list->DisplayRecords - 1)
		$security_matrix_list->StopRecord = $security_matrix_list->StartRecord + $security_matrix_list->DisplayRecords - 1;
	else
		$security_matrix_list->StopRecord = $security_matrix_list->TotalRecords;
}
$security_matrix_list->RecordCount = $security_matrix_list->StartRecord - 1;
if ($security_matrix_list->Recordset && !$security_matrix_list->Recordset->EOF) {
	$security_matrix_list->Recordset->moveFirst();
	$selectLimit = $security_matrix_list->UseSelectLimit;
	if (!$selectLimit && $security_matrix_list->StartRecord > 1)
		$security_matrix_list->Recordset->move($security_matrix_list->StartRecord - 1);
} elseif (!$security_matrix->AllowAddDeleteRow && $security_matrix_list->StopRecord == 0) {
	$security_matrix_list->StopRecord = $security_matrix->GridAddRowCount;
}

// Initialize aggregate
$security_matrix->RowType = ROWTYPE_AGGREGATEINIT;
$security_matrix->resetAttributes();
$security_matrix_list->renderRow();
while ($security_matrix_list->RecordCount < $security_matrix_list->StopRecord) {
	$security_matrix_list->RecordCount++;
	if ($security_matrix_list->RecordCount >= $security_matrix_list->StartRecord) {
		$security_matrix_list->RowCount++;

		// Set up key count
		$security_matrix_list->KeyCount = $security_matrix_list->RowIndex;

		// Init row class and style
		$security_matrix->resetAttributes();
		$security_matrix->CssClass = "";
		if ($security_matrix_list->isGridAdd()) {
		} else {
			$security_matrix_list->loadRowValues($security_matrix_list->Recordset); // Load row values
		}
		$security_matrix->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$security_matrix->RowAttrs->merge(["data-rowindex" => $security_matrix_list->RowCount, "id" => "r" . $security_matrix_list->RowCount . "_security_matrix", "data-rowtype" => $security_matrix->RowType]);

		// Render row
		$security_matrix_list->renderRow();

		// Render list options
		$security_matrix_list->renderListOptions();
?>
	<tr <?php echo $security_matrix->rowAttributes() ?>>
<?php

// Render list options (body, left)
$security_matrix_list->ListOptions->render("body", "left", $security_matrix_list->RowCount);
?>
	<?php if ($security_matrix_list->UserCode->Visible) { // UserCode ?>
		<td data-name="UserCode" <?php echo $security_matrix_list->UserCode->cellAttributes() ?>>
<span id="el<?php echo $security_matrix_list->RowCount ?>_security_matrix_UserCode">
<span<?php echo $security_matrix_list->UserCode->viewAttributes() ?>><?php echo $security_matrix_list->UserCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($security_matrix_list->PeriodCode->Visible) { // PeriodCode ?>
		<td data-name="PeriodCode" <?php echo $security_matrix_list->PeriodCode->cellAttributes() ?>>
<span id="el<?php echo $security_matrix_list->RowCount ?>_security_matrix_PeriodCode">
<span<?php echo $security_matrix_list->PeriodCode->viewAttributes() ?>><?php echo $security_matrix_list->PeriodCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($security_matrix_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $security_matrix_list->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $security_matrix_list->RowCount ?>_security_matrix_ProvinceCode">
<span<?php echo $security_matrix_list->ProvinceCode->viewAttributes() ?>><?php echo $security_matrix_list->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($security_matrix_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $security_matrix_list->LACode->cellAttributes() ?>>
<span id="el<?php echo $security_matrix_list->RowCount ?>_security_matrix_LACode">
<span<?php echo $security_matrix_list->LACode->viewAttributes() ?>><?php echo $security_matrix_list->LACode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($security_matrix_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $security_matrix_list->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $security_matrix_list->RowCount ?>_security_matrix_DepartmentCode">
<span<?php echo $security_matrix_list->DepartmentCode->viewAttributes() ?>><?php echo $security_matrix_list->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($security_matrix_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $security_matrix_list->SectionCode->cellAttributes() ?>>
<span id="el<?php echo $security_matrix_list->RowCount ?>_security_matrix_SectionCode">
<span<?php echo $security_matrix_list->SectionCode->viewAttributes() ?>><?php echo $security_matrix_list->SectionCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($security_matrix_list->SecurityNumber->Visible) { // SecurityNumber ?>
		<td data-name="SecurityNumber" <?php echo $security_matrix_list->SecurityNumber->cellAttributes() ?>>
<span id="el<?php echo $security_matrix_list->RowCount ?>_security_matrix_SecurityNumber">
<span<?php echo $security_matrix_list->SecurityNumber->viewAttributes() ?>><?php echo $security_matrix_list->SecurityNumber->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($security_matrix_list->ValidFrom->Visible) { // ValidFrom ?>
		<td data-name="ValidFrom" <?php echo $security_matrix_list->ValidFrom->cellAttributes() ?>>
<span id="el<?php echo $security_matrix_list->RowCount ?>_security_matrix_ValidFrom">
<span<?php echo $security_matrix_list->ValidFrom->viewAttributes() ?>><?php echo $security_matrix_list->ValidFrom->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($security_matrix_list->ValidTo->Visible) { // ValidTo ?>
		<td data-name="ValidTo" <?php echo $security_matrix_list->ValidTo->cellAttributes() ?>>
<span id="el<?php echo $security_matrix_list->RowCount ?>_security_matrix_ValidTo">
<span<?php echo $security_matrix_list->ValidTo->viewAttributes() ?>><?php echo $security_matrix_list->ValidTo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($security_matrix_list->ApproveLevel->Visible) { // ApproveLevel ?>
		<td data-name="ApproveLevel" <?php echo $security_matrix_list->ApproveLevel->cellAttributes() ?>>
<span id="el<?php echo $security_matrix_list->RowCount ?>_security_matrix_ApproveLevel">
<span<?php echo $security_matrix_list->ApproveLevel->viewAttributes() ?>><?php echo $security_matrix_list->ApproveLevel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($security_matrix_list->ActivityCode->Visible) { // ActivityCode ?>
		<td data-name="ActivityCode" <?php echo $security_matrix_list->ActivityCode->cellAttributes() ?>>
<span id="el<?php echo $security_matrix_list->RowCount ?>_security_matrix_ActivityCode">
<span<?php echo $security_matrix_list->ActivityCode->viewAttributes() ?>><?php echo $security_matrix_list->ActivityCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$security_matrix_list->ListOptions->render("body", "right", $security_matrix_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$security_matrix_list->isGridAdd())
		$security_matrix_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$security_matrix->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($security_matrix_list->Recordset)
	$security_matrix_list->Recordset->Close();
?>
<?php if (!$security_matrix_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$security_matrix_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $security_matrix_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $security_matrix_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($security_matrix_list->TotalRecords == 0 && !$security_matrix->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $security_matrix_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$security_matrix_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$security_matrix_list->isExport()) { ?>
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
$security_matrix_list->terminate();
?>