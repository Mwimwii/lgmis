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
$department_list = new department_list();

// Run the page
$department_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$department_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$department_list->isExport()) { ?>
<script>
var fdepartmentlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdepartmentlist = currentForm = new ew.Form("fdepartmentlist", "list");
	fdepartmentlist.formKeyCountName = '<?php echo $department_list->FormKeyCountName ?>';
	loadjs.done("fdepartmentlist");
});
var fdepartmentlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdepartmentlistsrch = currentSearchForm = new ew.Form("fdepartmentlistsrch");

	// Dynamic selection lists
	// Filters

	fdepartmentlistsrch.filterList = <?php echo $department_list->getFilterList() ?>;

	// Init search panel as collapsed
	fdepartmentlistsrch.initSearchPanel = true;
	loadjs.done("fdepartmentlistsrch");
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
<?php if (!$department_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($department_list->TotalRecords > 0 && $department_list->ExportOptions->visible()) { ?>
<?php $department_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($department_list->ImportOptions->visible()) { ?>
<?php $department_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($department_list->SearchOptions->visible()) { ?>
<?php $department_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($department_list->FilterOptions->visible()) { ?>
<?php $department_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$department_list->isExport() || Config("EXPORT_MASTER_RECORD") && $department_list->isExport("print")) { ?>
<?php
if ($department_list->DbMasterFilter != "" && $department->getCurrentMasterTable() == "local_authority") {
	if ($department_list->MasterRecordExists) {
		include_once "local_authoritymaster.php";
	}
}
?>
<?php } ?>
<?php
$department_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$department_list->isExport() && !$department->CurrentAction) { ?>
<form name="fdepartmentlistsrch" id="fdepartmentlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdepartmentlistsrch-search-panel" class="<?php echo $department_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="department">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $department_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($department_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($department_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $department_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($department_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($department_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($department_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($department_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $department_list->showPageHeader(); ?>
<?php
$department_list->showMessage();
?>
<?php if ($department_list->TotalRecords > 0 || $department->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($department_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> department">
<?php if (!$department_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$department_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $department_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $department_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdepartmentlist" id="fdepartmentlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="department">
<?php if ($department->getCurrentMasterTable() == "local_authority" && $department->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($department_list->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($department_list->ProvinceCode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_department" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($department_list->TotalRecords > 0 || $department_list->isGridEdit()) { ?>
<table id="tbl_departmentlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$department->RowType = ROWTYPE_HEADER;

// Render list options
$department_list->renderListOptions();

// Render list options (header, left)
$department_list->ListOptions->render("header", "left");
?>
<?php if ($department_list->DepartmentName->Visible) { // DepartmentName ?>
	<?php if ($department_list->SortUrl($department_list->DepartmentName) == "") { ?>
		<th data-name="DepartmentName" class="<?php echo $department_list->DepartmentName->headerCellClass() ?>"><div id="elh_department_DepartmentName" class="department_DepartmentName"><div class="ew-table-header-caption"><?php echo $department_list->DepartmentName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentName" class="<?php echo $department_list->DepartmentName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $department_list->SortUrl($department_list->DepartmentName) ?>', 1);"><div id="elh_department_DepartmentName" class="department_DepartmentName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $department_list->DepartmentName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($department_list->DepartmentName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($department_list->DepartmentName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($department_list->Telephone->Visible) { // Telephone ?>
	<?php if ($department_list->SortUrl($department_list->Telephone) == "") { ?>
		<th data-name="Telephone" class="<?php echo $department_list->Telephone->headerCellClass() ?>"><div id="elh_department_Telephone" class="department_Telephone"><div class="ew-table-header-caption"><?php echo $department_list->Telephone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Telephone" class="<?php echo $department_list->Telephone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $department_list->SortUrl($department_list->Telephone) ?>', 1);"><div id="elh_department_Telephone" class="department_Telephone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $department_list->Telephone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($department_list->Telephone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($department_list->Telephone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($department_list->_Email->Visible) { // Email ?>
	<?php if ($department_list->SortUrl($department_list->_Email) == "") { ?>
		<th data-name="_Email" class="<?php echo $department_list->_Email->headerCellClass() ?>"><div id="elh_department__Email" class="department__Email"><div class="ew-table-header-caption"><?php echo $department_list->_Email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_Email" class="<?php echo $department_list->_Email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $department_list->SortUrl($department_list->_Email) ?>', 1);"><div id="elh_department__Email" class="department__Email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $department_list->_Email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($department_list->_Email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($department_list->_Email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($department_list->LACode->Visible) { // LACode ?>
	<?php if ($department_list->SortUrl($department_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $department_list->LACode->headerCellClass() ?>"><div id="elh_department_LACode" class="department_LACode"><div class="ew-table-header-caption"><?php echo $department_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $department_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $department_list->SortUrl($department_list->LACode) ?>', 1);"><div id="elh_department_LACode" class="department_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $department_list->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($department_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($department_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($department_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($department_list->SortUrl($department_list->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $department_list->ProvinceCode->headerCellClass() ?>"><div id="elh_department_ProvinceCode" class="department_ProvinceCode"><div class="ew-table-header-caption"><?php echo $department_list->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $department_list->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $department_list->SortUrl($department_list->ProvinceCode) ?>', 1);"><div id="elh_department_ProvinceCode" class="department_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $department_list->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($department_list->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($department_list->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$department_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($department_list->ExportAll && $department_list->isExport()) {
	$department_list->StopRecord = $department_list->TotalRecords;
} else {

	// Set the last record to display
	if ($department_list->TotalRecords > $department_list->StartRecord + $department_list->DisplayRecords - 1)
		$department_list->StopRecord = $department_list->StartRecord + $department_list->DisplayRecords - 1;
	else
		$department_list->StopRecord = $department_list->TotalRecords;
}
$department_list->RecordCount = $department_list->StartRecord - 1;
if ($department_list->Recordset && !$department_list->Recordset->EOF) {
	$department_list->Recordset->moveFirst();
	$selectLimit = $department_list->UseSelectLimit;
	if (!$selectLimit && $department_list->StartRecord > 1)
		$department_list->Recordset->move($department_list->StartRecord - 1);
} elseif (!$department->AllowAddDeleteRow && $department_list->StopRecord == 0) {
	$department_list->StopRecord = $department->GridAddRowCount;
}

// Initialize aggregate
$department->RowType = ROWTYPE_AGGREGATEINIT;
$department->resetAttributes();
$department_list->renderRow();
while ($department_list->RecordCount < $department_list->StopRecord) {
	$department_list->RecordCount++;
	if ($department_list->RecordCount >= $department_list->StartRecord) {
		$department_list->RowCount++;

		// Set up key count
		$department_list->KeyCount = $department_list->RowIndex;

		// Init row class and style
		$department->resetAttributes();
		$department->CssClass = "";
		if ($department_list->isGridAdd()) {
		} else {
			$department_list->loadRowValues($department_list->Recordset); // Load row values
		}
		$department->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$department->RowAttrs->merge(["data-rowindex" => $department_list->RowCount, "id" => "r" . $department_list->RowCount . "_department", "data-rowtype" => $department->RowType]);

		// Render row
		$department_list->renderRow();

		// Render list options
		$department_list->renderListOptions();
?>
	<tr <?php echo $department->rowAttributes() ?>>
<?php

// Render list options (body, left)
$department_list->ListOptions->render("body", "left", $department_list->RowCount);
?>
	<?php if ($department_list->DepartmentName->Visible) { // DepartmentName ?>
		<td data-name="DepartmentName" <?php echo $department_list->DepartmentName->cellAttributes() ?>>
<span id="el<?php echo $department_list->RowCount ?>_department_DepartmentName">
<span<?php echo $department_list->DepartmentName->viewAttributes() ?>><?php echo $department_list->DepartmentName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($department_list->Telephone->Visible) { // Telephone ?>
		<td data-name="Telephone" <?php echo $department_list->Telephone->cellAttributes() ?>>
<span id="el<?php echo $department_list->RowCount ?>_department_Telephone">
<span<?php echo $department_list->Telephone->viewAttributes() ?>><?php echo $department_list->Telephone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($department_list->_Email->Visible) { // Email ?>
		<td data-name="_Email" <?php echo $department_list->_Email->cellAttributes() ?>>
<span id="el<?php echo $department_list->RowCount ?>_department__Email">
<span<?php echo $department_list->_Email->viewAttributes() ?>><?php echo $department_list->_Email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($department_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $department_list->LACode->cellAttributes() ?>>
<span id="el<?php echo $department_list->RowCount ?>_department_LACode">
<span<?php echo $department_list->LACode->viewAttributes() ?>><?php echo $department_list->LACode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($department_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $department_list->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $department_list->RowCount ?>_department_ProvinceCode">
<span<?php echo $department_list->ProvinceCode->viewAttributes() ?>><?php echo $department_list->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$department_list->ListOptions->render("body", "right", $department_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$department_list->isGridAdd())
		$department_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$department->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($department_list->Recordset)
	$department_list->Recordset->Close();
?>
<?php if (!$department_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$department_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $department_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $department_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($department_list->TotalRecords == 0 && !$department->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $department_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$department_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$department_list->isExport()) { ?>
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
$department_list->terminate();
?>