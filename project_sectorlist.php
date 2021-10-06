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
$project_sector_list = new project_sector_list();

// Run the page
$project_sector_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$project_sector_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$project_sector_list->isExport()) { ?>
<script>
var fproject_sectorlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fproject_sectorlist = currentForm = new ew.Form("fproject_sectorlist", "list");
	fproject_sectorlist.formKeyCountName = '<?php echo $project_sector_list->FormKeyCountName ?>';
	loadjs.done("fproject_sectorlist");
});
var fproject_sectorlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fproject_sectorlistsrch = currentSearchForm = new ew.Form("fproject_sectorlistsrch");

	// Dynamic selection lists
	// Filters

	fproject_sectorlistsrch.filterList = <?php echo $project_sector_list->getFilterList() ?>;

	// Init search panel as collapsed
	fproject_sectorlistsrch.initSearchPanel = true;
	loadjs.done("fproject_sectorlistsrch");
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
<?php if (!$project_sector_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($project_sector_list->TotalRecords > 0 && $project_sector_list->ExportOptions->visible()) { ?>
<?php $project_sector_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($project_sector_list->ImportOptions->visible()) { ?>
<?php $project_sector_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($project_sector_list->SearchOptions->visible()) { ?>
<?php $project_sector_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($project_sector_list->FilterOptions->visible()) { ?>
<?php $project_sector_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$project_sector_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$project_sector_list->isExport() && !$project_sector->CurrentAction) { ?>
<form name="fproject_sectorlistsrch" id="fproject_sectorlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fproject_sectorlistsrch-search-panel" class="<?php echo $project_sector_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="project_sector">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $project_sector_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($project_sector_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($project_sector_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $project_sector_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($project_sector_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($project_sector_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($project_sector_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($project_sector_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $project_sector_list->showPageHeader(); ?>
<?php
$project_sector_list->showMessage();
?>
<?php if ($project_sector_list->TotalRecords > 0 || $project_sector->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($project_sector_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> project_sector">
<?php if (!$project_sector_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$project_sector_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $project_sector_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $project_sector_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fproject_sectorlist" id="fproject_sectorlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="project_sector">
<div id="gmp_project_sector" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($project_sector_list->TotalRecords > 0 || $project_sector_list->isGridEdit()) { ?>
<table id="tbl_project_sectorlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$project_sector->RowType = ROWTYPE_HEADER;

// Render list options
$project_sector_list->renderListOptions();

// Render list options (header, left)
$project_sector_list->ListOptions->render("header", "left");
?>
<?php if ($project_sector_list->ProjectSector->Visible) { // ProjectSector ?>
	<?php if ($project_sector_list->SortUrl($project_sector_list->ProjectSector) == "") { ?>
		<th data-name="ProjectSector" class="<?php echo $project_sector_list->ProjectSector->headerCellClass() ?>"><div id="elh_project_sector_ProjectSector" class="project_sector_ProjectSector"><div class="ew-table-header-caption"><?php echo $project_sector_list->ProjectSector->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProjectSector" class="<?php echo $project_sector_list->ProjectSector->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $project_sector_list->SortUrl($project_sector_list->ProjectSector) ?>', 1);"><div id="elh_project_sector_ProjectSector" class="project_sector_ProjectSector">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_sector_list->ProjectSector->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_sector_list->ProjectSector->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_sector_list->ProjectSector->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_sector_list->ProjectSectorDesc->Visible) { // ProjectSectorDesc ?>
	<?php if ($project_sector_list->SortUrl($project_sector_list->ProjectSectorDesc) == "") { ?>
		<th data-name="ProjectSectorDesc" class="<?php echo $project_sector_list->ProjectSectorDesc->headerCellClass() ?>"><div id="elh_project_sector_ProjectSectorDesc" class="project_sector_ProjectSectorDesc"><div class="ew-table-header-caption"><?php echo $project_sector_list->ProjectSectorDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProjectSectorDesc" class="<?php echo $project_sector_list->ProjectSectorDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $project_sector_list->SortUrl($project_sector_list->ProjectSectorDesc) ?>', 1);"><div id="elh_project_sector_ProjectSectorDesc" class="project_sector_ProjectSectorDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_sector_list->ProjectSectorDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($project_sector_list->ProjectSectorDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_sector_list->ProjectSectorDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$project_sector_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($project_sector_list->ExportAll && $project_sector_list->isExport()) {
	$project_sector_list->StopRecord = $project_sector_list->TotalRecords;
} else {

	// Set the last record to display
	if ($project_sector_list->TotalRecords > $project_sector_list->StartRecord + $project_sector_list->DisplayRecords - 1)
		$project_sector_list->StopRecord = $project_sector_list->StartRecord + $project_sector_list->DisplayRecords - 1;
	else
		$project_sector_list->StopRecord = $project_sector_list->TotalRecords;
}
$project_sector_list->RecordCount = $project_sector_list->StartRecord - 1;
if ($project_sector_list->Recordset && !$project_sector_list->Recordset->EOF) {
	$project_sector_list->Recordset->moveFirst();
	$selectLimit = $project_sector_list->UseSelectLimit;
	if (!$selectLimit && $project_sector_list->StartRecord > 1)
		$project_sector_list->Recordset->move($project_sector_list->StartRecord - 1);
} elseif (!$project_sector->AllowAddDeleteRow && $project_sector_list->StopRecord == 0) {
	$project_sector_list->StopRecord = $project_sector->GridAddRowCount;
}

// Initialize aggregate
$project_sector->RowType = ROWTYPE_AGGREGATEINIT;
$project_sector->resetAttributes();
$project_sector_list->renderRow();
while ($project_sector_list->RecordCount < $project_sector_list->StopRecord) {
	$project_sector_list->RecordCount++;
	if ($project_sector_list->RecordCount >= $project_sector_list->StartRecord) {
		$project_sector_list->RowCount++;

		// Set up key count
		$project_sector_list->KeyCount = $project_sector_list->RowIndex;

		// Init row class and style
		$project_sector->resetAttributes();
		$project_sector->CssClass = "";
		if ($project_sector_list->isGridAdd()) {
		} else {
			$project_sector_list->loadRowValues($project_sector_list->Recordset); // Load row values
		}
		$project_sector->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$project_sector->RowAttrs->merge(["data-rowindex" => $project_sector_list->RowCount, "id" => "r" . $project_sector_list->RowCount . "_project_sector", "data-rowtype" => $project_sector->RowType]);

		// Render row
		$project_sector_list->renderRow();

		// Render list options
		$project_sector_list->renderListOptions();
?>
	<tr <?php echo $project_sector->rowAttributes() ?>>
<?php

// Render list options (body, left)
$project_sector_list->ListOptions->render("body", "left", $project_sector_list->RowCount);
?>
	<?php if ($project_sector_list->ProjectSector->Visible) { // ProjectSector ?>
		<td data-name="ProjectSector" <?php echo $project_sector_list->ProjectSector->cellAttributes() ?>>
<span id="el<?php echo $project_sector_list->RowCount ?>_project_sector_ProjectSector">
<span<?php echo $project_sector_list->ProjectSector->viewAttributes() ?>><?php echo $project_sector_list->ProjectSector->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($project_sector_list->ProjectSectorDesc->Visible) { // ProjectSectorDesc ?>
		<td data-name="ProjectSectorDesc" <?php echo $project_sector_list->ProjectSectorDesc->cellAttributes() ?>>
<span id="el<?php echo $project_sector_list->RowCount ?>_project_sector_ProjectSectorDesc">
<span<?php echo $project_sector_list->ProjectSectorDesc->viewAttributes() ?>><?php echo $project_sector_list->ProjectSectorDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$project_sector_list->ListOptions->render("body", "right", $project_sector_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$project_sector_list->isGridAdd())
		$project_sector_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$project_sector->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($project_sector_list->Recordset)
	$project_sector_list->Recordset->Close();
?>
<?php if (!$project_sector_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$project_sector_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $project_sector_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $project_sector_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($project_sector_list->TotalRecords == 0 && !$project_sector->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $project_sector_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$project_sector_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$project_sector_list->isExport()) { ?>
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
$project_sector_list->terminate();
?>