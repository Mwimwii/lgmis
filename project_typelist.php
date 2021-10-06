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
$project_type_list = new project_type_list();

// Run the page
$project_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$project_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$project_type_list->isExport()) { ?>
<script>
var fproject_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fproject_typelist = currentForm = new ew.Form("fproject_typelist", "list");
	fproject_typelist.formKeyCountName = '<?php echo $project_type_list->FormKeyCountName ?>';
	loadjs.done("fproject_typelist");
});
var fproject_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fproject_typelistsrch = currentSearchForm = new ew.Form("fproject_typelistsrch");

	// Dynamic selection lists
	// Filters

	fproject_typelistsrch.filterList = <?php echo $project_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	fproject_typelistsrch.initSearchPanel = true;
	loadjs.done("fproject_typelistsrch");
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
<?php if (!$project_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($project_type_list->TotalRecords > 0 && $project_type_list->ExportOptions->visible()) { ?>
<?php $project_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($project_type_list->ImportOptions->visible()) { ?>
<?php $project_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($project_type_list->SearchOptions->visible()) { ?>
<?php $project_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($project_type_list->FilterOptions->visible()) { ?>
<?php $project_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$project_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$project_type_list->isExport() && !$project_type->CurrentAction) { ?>
<form name="fproject_typelistsrch" id="fproject_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fproject_typelistsrch-search-panel" class="<?php echo $project_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="project_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $project_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($project_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($project_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $project_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($project_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($project_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($project_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($project_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $project_type_list->showPageHeader(); ?>
<?php
$project_type_list->showMessage();
?>
<?php if ($project_type_list->TotalRecords > 0 || $project_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($project_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> project_type">
<?php if (!$project_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$project_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $project_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $project_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fproject_typelist" id="fproject_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="project_type">
<div id="gmp_project_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($project_type_list->TotalRecords > 0 || $project_type_list->isGridEdit()) { ?>
<table id="tbl_project_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$project_type->RowType = ROWTYPE_HEADER;

// Render list options
$project_type_list->renderListOptions();

// Render list options (header, left)
$project_type_list->ListOptions->render("header", "left");
?>
<?php if ($project_type_list->ProjectType->Visible) { // ProjectType ?>
	<?php if ($project_type_list->SortUrl($project_type_list->ProjectType) == "") { ?>
		<th data-name="ProjectType" class="<?php echo $project_type_list->ProjectType->headerCellClass() ?>"><div id="elh_project_type_ProjectType" class="project_type_ProjectType"><div class="ew-table-header-caption"><?php echo $project_type_list->ProjectType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProjectType" class="<?php echo $project_type_list->ProjectType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $project_type_list->SortUrl($project_type_list->ProjectType) ?>', 1);"><div id="elh_project_type_ProjectType" class="project_type_ProjectType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_type_list->ProjectType->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_type_list->ProjectType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_type_list->ProjectType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_type_list->ProjectTypeDesc->Visible) { // ProjectTypeDesc ?>
	<?php if ($project_type_list->SortUrl($project_type_list->ProjectTypeDesc) == "") { ?>
		<th data-name="ProjectTypeDesc" class="<?php echo $project_type_list->ProjectTypeDesc->headerCellClass() ?>"><div id="elh_project_type_ProjectTypeDesc" class="project_type_ProjectTypeDesc"><div class="ew-table-header-caption"><?php echo $project_type_list->ProjectTypeDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProjectTypeDesc" class="<?php echo $project_type_list->ProjectTypeDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $project_type_list->SortUrl($project_type_list->ProjectTypeDesc) ?>', 1);"><div id="elh_project_type_ProjectTypeDesc" class="project_type_ProjectTypeDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_type_list->ProjectTypeDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($project_type_list->ProjectTypeDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_type_list->ProjectTypeDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$project_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($project_type_list->ExportAll && $project_type_list->isExport()) {
	$project_type_list->StopRecord = $project_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($project_type_list->TotalRecords > $project_type_list->StartRecord + $project_type_list->DisplayRecords - 1)
		$project_type_list->StopRecord = $project_type_list->StartRecord + $project_type_list->DisplayRecords - 1;
	else
		$project_type_list->StopRecord = $project_type_list->TotalRecords;
}
$project_type_list->RecordCount = $project_type_list->StartRecord - 1;
if ($project_type_list->Recordset && !$project_type_list->Recordset->EOF) {
	$project_type_list->Recordset->moveFirst();
	$selectLimit = $project_type_list->UseSelectLimit;
	if (!$selectLimit && $project_type_list->StartRecord > 1)
		$project_type_list->Recordset->move($project_type_list->StartRecord - 1);
} elseif (!$project_type->AllowAddDeleteRow && $project_type_list->StopRecord == 0) {
	$project_type_list->StopRecord = $project_type->GridAddRowCount;
}

// Initialize aggregate
$project_type->RowType = ROWTYPE_AGGREGATEINIT;
$project_type->resetAttributes();
$project_type_list->renderRow();
while ($project_type_list->RecordCount < $project_type_list->StopRecord) {
	$project_type_list->RecordCount++;
	if ($project_type_list->RecordCount >= $project_type_list->StartRecord) {
		$project_type_list->RowCount++;

		// Set up key count
		$project_type_list->KeyCount = $project_type_list->RowIndex;

		// Init row class and style
		$project_type->resetAttributes();
		$project_type->CssClass = "";
		if ($project_type_list->isGridAdd()) {
		} else {
			$project_type_list->loadRowValues($project_type_list->Recordset); // Load row values
		}
		$project_type->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$project_type->RowAttrs->merge(["data-rowindex" => $project_type_list->RowCount, "id" => "r" . $project_type_list->RowCount . "_project_type", "data-rowtype" => $project_type->RowType]);

		// Render row
		$project_type_list->renderRow();

		// Render list options
		$project_type_list->renderListOptions();
?>
	<tr <?php echo $project_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$project_type_list->ListOptions->render("body", "left", $project_type_list->RowCount);
?>
	<?php if ($project_type_list->ProjectType->Visible) { // ProjectType ?>
		<td data-name="ProjectType" <?php echo $project_type_list->ProjectType->cellAttributes() ?>>
<span id="el<?php echo $project_type_list->RowCount ?>_project_type_ProjectType">
<span<?php echo $project_type_list->ProjectType->viewAttributes() ?>><?php echo $project_type_list->ProjectType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($project_type_list->ProjectTypeDesc->Visible) { // ProjectTypeDesc ?>
		<td data-name="ProjectTypeDesc" <?php echo $project_type_list->ProjectTypeDesc->cellAttributes() ?>>
<span id="el<?php echo $project_type_list->RowCount ?>_project_type_ProjectTypeDesc">
<span<?php echo $project_type_list->ProjectTypeDesc->viewAttributes() ?>><?php echo $project_type_list->ProjectTypeDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$project_type_list->ListOptions->render("body", "right", $project_type_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$project_type_list->isGridAdd())
		$project_type_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$project_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($project_type_list->Recordset)
	$project_type_list->Recordset->Close();
?>
<?php if (!$project_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$project_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $project_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $project_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($project_type_list->TotalRecords == 0 && !$project_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $project_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$project_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$project_type_list->isExport()) { ?>
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
$project_type_list->terminate();
?>