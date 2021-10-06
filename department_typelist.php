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
$department_type_list = new department_type_list();

// Run the page
$department_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$department_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$department_type_list->isExport()) { ?>
<script>
var fdepartment_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdepartment_typelist = currentForm = new ew.Form("fdepartment_typelist", "list");
	fdepartment_typelist.formKeyCountName = '<?php echo $department_type_list->FormKeyCountName ?>';
	loadjs.done("fdepartment_typelist");
});
var fdepartment_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdepartment_typelistsrch = currentSearchForm = new ew.Form("fdepartment_typelistsrch");

	// Dynamic selection lists
	// Filters

	fdepartment_typelistsrch.filterList = <?php echo $department_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	fdepartment_typelistsrch.initSearchPanel = true;
	loadjs.done("fdepartment_typelistsrch");
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
<?php if (!$department_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($department_type_list->TotalRecords > 0 && $department_type_list->ExportOptions->visible()) { ?>
<?php $department_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($department_type_list->ImportOptions->visible()) { ?>
<?php $department_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($department_type_list->SearchOptions->visible()) { ?>
<?php $department_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($department_type_list->FilterOptions->visible()) { ?>
<?php $department_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$department_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$department_type_list->isExport() && !$department_type->CurrentAction) { ?>
<form name="fdepartment_typelistsrch" id="fdepartment_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdepartment_typelistsrch-search-panel" class="<?php echo $department_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="department_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $department_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($department_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($department_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $department_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($department_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($department_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($department_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($department_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $department_type_list->showPageHeader(); ?>
<?php
$department_type_list->showMessage();
?>
<?php if ($department_type_list->TotalRecords > 0 || $department_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($department_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> department_type">
<?php if (!$department_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$department_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $department_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $department_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdepartment_typelist" id="fdepartment_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="department_type">
<div id="gmp_department_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($department_type_list->TotalRecords > 0 || $department_type_list->isGridEdit()) { ?>
<table id="tbl_department_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$department_type->RowType = ROWTYPE_HEADER;

// Render list options
$department_type_list->renderListOptions();

// Render list options (header, left)
$department_type_list->ListOptions->render("header", "left");
?>
<?php if ($department_type_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($department_type_list->SortUrl($department_type_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $department_type_list->DepartmentCode->headerCellClass() ?>"><div id="elh_department_type_DepartmentCode" class="department_type_DepartmentCode"><div class="ew-table-header-caption"><?php echo $department_type_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $department_type_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $department_type_list->SortUrl($department_type_list->DepartmentCode) ?>', 1);"><div id="elh_department_type_DepartmentCode" class="department_type_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $department_type_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($department_type_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($department_type_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($department_type_list->DepartmentName->Visible) { // DepartmentName ?>
	<?php if ($department_type_list->SortUrl($department_type_list->DepartmentName) == "") { ?>
		<th data-name="DepartmentName" class="<?php echo $department_type_list->DepartmentName->headerCellClass() ?>"><div id="elh_department_type_DepartmentName" class="department_type_DepartmentName"><div class="ew-table-header-caption"><?php echo $department_type_list->DepartmentName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentName" class="<?php echo $department_type_list->DepartmentName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $department_type_list->SortUrl($department_type_list->DepartmentName) ?>', 1);"><div id="elh_department_type_DepartmentName" class="department_type_DepartmentName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $department_type_list->DepartmentName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($department_type_list->DepartmentName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($department_type_list->DepartmentName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($department_type_list->CouncilType->Visible) { // CouncilType ?>
	<?php if ($department_type_list->SortUrl($department_type_list->CouncilType) == "") { ?>
		<th data-name="CouncilType" class="<?php echo $department_type_list->CouncilType->headerCellClass() ?>"><div id="elh_department_type_CouncilType" class="department_type_CouncilType"><div class="ew-table-header-caption"><?php echo $department_type_list->CouncilType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CouncilType" class="<?php echo $department_type_list->CouncilType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $department_type_list->SortUrl($department_type_list->CouncilType) ?>', 1);"><div id="elh_department_type_CouncilType" class="department_type_CouncilType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $department_type_list->CouncilType->caption() ?></span><span class="ew-table-header-sort"><?php if ($department_type_list->CouncilType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($department_type_list->CouncilType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$department_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($department_type_list->ExportAll && $department_type_list->isExport()) {
	$department_type_list->StopRecord = $department_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($department_type_list->TotalRecords > $department_type_list->StartRecord + $department_type_list->DisplayRecords - 1)
		$department_type_list->StopRecord = $department_type_list->StartRecord + $department_type_list->DisplayRecords - 1;
	else
		$department_type_list->StopRecord = $department_type_list->TotalRecords;
}
$department_type_list->RecordCount = $department_type_list->StartRecord - 1;
if ($department_type_list->Recordset && !$department_type_list->Recordset->EOF) {
	$department_type_list->Recordset->moveFirst();
	$selectLimit = $department_type_list->UseSelectLimit;
	if (!$selectLimit && $department_type_list->StartRecord > 1)
		$department_type_list->Recordset->move($department_type_list->StartRecord - 1);
} elseif (!$department_type->AllowAddDeleteRow && $department_type_list->StopRecord == 0) {
	$department_type_list->StopRecord = $department_type->GridAddRowCount;
}

// Initialize aggregate
$department_type->RowType = ROWTYPE_AGGREGATEINIT;
$department_type->resetAttributes();
$department_type_list->renderRow();
while ($department_type_list->RecordCount < $department_type_list->StopRecord) {
	$department_type_list->RecordCount++;
	if ($department_type_list->RecordCount >= $department_type_list->StartRecord) {
		$department_type_list->RowCount++;

		// Set up key count
		$department_type_list->KeyCount = $department_type_list->RowIndex;

		// Init row class and style
		$department_type->resetAttributes();
		$department_type->CssClass = "";
		if ($department_type_list->isGridAdd()) {
		} else {
			$department_type_list->loadRowValues($department_type_list->Recordset); // Load row values
		}
		$department_type->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$department_type->RowAttrs->merge(["data-rowindex" => $department_type_list->RowCount, "id" => "r" . $department_type_list->RowCount . "_department_type", "data-rowtype" => $department_type->RowType]);

		// Render row
		$department_type_list->renderRow();

		// Render list options
		$department_type_list->renderListOptions();
?>
	<tr <?php echo $department_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$department_type_list->ListOptions->render("body", "left", $department_type_list->RowCount);
?>
	<?php if ($department_type_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $department_type_list->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $department_type_list->RowCount ?>_department_type_DepartmentCode">
<span<?php echo $department_type_list->DepartmentCode->viewAttributes() ?>><?php echo $department_type_list->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($department_type_list->DepartmentName->Visible) { // DepartmentName ?>
		<td data-name="DepartmentName" <?php echo $department_type_list->DepartmentName->cellAttributes() ?>>
<span id="el<?php echo $department_type_list->RowCount ?>_department_type_DepartmentName">
<span<?php echo $department_type_list->DepartmentName->viewAttributes() ?>><?php echo $department_type_list->DepartmentName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($department_type_list->CouncilType->Visible) { // CouncilType ?>
		<td data-name="CouncilType" <?php echo $department_type_list->CouncilType->cellAttributes() ?>>
<span id="el<?php echo $department_type_list->RowCount ?>_department_type_CouncilType">
<span<?php echo $department_type_list->CouncilType->viewAttributes() ?>><?php echo $department_type_list->CouncilType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$department_type_list->ListOptions->render("body", "right", $department_type_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$department_type_list->isGridAdd())
		$department_type_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$department_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($department_type_list->Recordset)
	$department_type_list->Recordset->Close();
?>
<?php if (!$department_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$department_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $department_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $department_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($department_type_list->TotalRecords == 0 && !$department_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $department_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$department_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$department_type_list->isExport()) { ?>
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
$department_type_list->terminate();
?>