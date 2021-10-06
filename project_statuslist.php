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
$project_status_list = new project_status_list();

// Run the page
$project_status_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$project_status_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$project_status_list->isExport()) { ?>
<script>
var fproject_statuslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fproject_statuslist = currentForm = new ew.Form("fproject_statuslist", "list");
	fproject_statuslist.formKeyCountName = '<?php echo $project_status_list->FormKeyCountName ?>';
	loadjs.done("fproject_statuslist");
});
var fproject_statuslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fproject_statuslistsrch = currentSearchForm = new ew.Form("fproject_statuslistsrch");

	// Dynamic selection lists
	// Filters

	fproject_statuslistsrch.filterList = <?php echo $project_status_list->getFilterList() ?>;

	// Init search panel as collapsed
	fproject_statuslistsrch.initSearchPanel = true;
	loadjs.done("fproject_statuslistsrch");
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
<?php if (!$project_status_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($project_status_list->TotalRecords > 0 && $project_status_list->ExportOptions->visible()) { ?>
<?php $project_status_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($project_status_list->ImportOptions->visible()) { ?>
<?php $project_status_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($project_status_list->SearchOptions->visible()) { ?>
<?php $project_status_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($project_status_list->FilterOptions->visible()) { ?>
<?php $project_status_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$project_status_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$project_status_list->isExport() && !$project_status->CurrentAction) { ?>
<form name="fproject_statuslistsrch" id="fproject_statuslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fproject_statuslistsrch-search-panel" class="<?php echo $project_status_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="project_status">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $project_status_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($project_status_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($project_status_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $project_status_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($project_status_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($project_status_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($project_status_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($project_status_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $project_status_list->showPageHeader(); ?>
<?php
$project_status_list->showMessage();
?>
<?php if ($project_status_list->TotalRecords > 0 || $project_status->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($project_status_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> project_status">
<?php if (!$project_status_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$project_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $project_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $project_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fproject_statuslist" id="fproject_statuslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="project_status">
<div id="gmp_project_status" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($project_status_list->TotalRecords > 0 || $project_status_list->isGridEdit()) { ?>
<table id="tbl_project_statuslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$project_status->RowType = ROWTYPE_HEADER;

// Render list options
$project_status_list->renderListOptions();

// Render list options (header, left)
$project_status_list->ListOptions->render("header", "left");
?>
<?php if ($project_status_list->ProjectStatusCode->Visible) { // ProjectStatusCode ?>
	<?php if ($project_status_list->SortUrl($project_status_list->ProjectStatusCode) == "") { ?>
		<th data-name="ProjectStatusCode" class="<?php echo $project_status_list->ProjectStatusCode->headerCellClass() ?>"><div id="elh_project_status_ProjectStatusCode" class="project_status_ProjectStatusCode"><div class="ew-table-header-caption"><?php echo $project_status_list->ProjectStatusCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProjectStatusCode" class="<?php echo $project_status_list->ProjectStatusCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $project_status_list->SortUrl($project_status_list->ProjectStatusCode) ?>', 1);"><div id="elh_project_status_ProjectStatusCode" class="project_status_ProjectStatusCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_status_list->ProjectStatusCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_status_list->ProjectStatusCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_status_list->ProjectStatusCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_status_list->ProjectStatusDesc->Visible) { // ProjectStatusDesc ?>
	<?php if ($project_status_list->SortUrl($project_status_list->ProjectStatusDesc) == "") { ?>
		<th data-name="ProjectStatusDesc" class="<?php echo $project_status_list->ProjectStatusDesc->headerCellClass() ?>"><div id="elh_project_status_ProjectStatusDesc" class="project_status_ProjectStatusDesc"><div class="ew-table-header-caption"><?php echo $project_status_list->ProjectStatusDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProjectStatusDesc" class="<?php echo $project_status_list->ProjectStatusDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $project_status_list->SortUrl($project_status_list->ProjectStatusDesc) ?>', 1);"><div id="elh_project_status_ProjectStatusDesc" class="project_status_ProjectStatusDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_status_list->ProjectStatusDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($project_status_list->ProjectStatusDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_status_list->ProjectStatusDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_status_list->LastUserID->Visible) { // LastUserID ?>
	<?php if ($project_status_list->SortUrl($project_status_list->LastUserID) == "") { ?>
		<th data-name="LastUserID" class="<?php echo $project_status_list->LastUserID->headerCellClass() ?>"><div id="elh_project_status_LastUserID" class="project_status_LastUserID"><div class="ew-table-header-caption"><?php echo $project_status_list->LastUserID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUserID" class="<?php echo $project_status_list->LastUserID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $project_status_list->SortUrl($project_status_list->LastUserID) ?>', 1);"><div id="elh_project_status_LastUserID" class="project_status_LastUserID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_status_list->LastUserID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($project_status_list->LastUserID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_status_list->LastUserID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_status_list->LastUpdated->Visible) { // LastUpdated ?>
	<?php if ($project_status_list->SortUrl($project_status_list->LastUpdated) == "") { ?>
		<th data-name="LastUpdated" class="<?php echo $project_status_list->LastUpdated->headerCellClass() ?>"><div id="elh_project_status_LastUpdated" class="project_status_LastUpdated"><div class="ew-table-header-caption"><?php echo $project_status_list->LastUpdated->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdated" class="<?php echo $project_status_list->LastUpdated->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $project_status_list->SortUrl($project_status_list->LastUpdated) ?>', 1);"><div id="elh_project_status_LastUpdated" class="project_status_LastUpdated">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_status_list->LastUpdated->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_status_list->LastUpdated->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_status_list->LastUpdated->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$project_status_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($project_status_list->ExportAll && $project_status_list->isExport()) {
	$project_status_list->StopRecord = $project_status_list->TotalRecords;
} else {

	// Set the last record to display
	if ($project_status_list->TotalRecords > $project_status_list->StartRecord + $project_status_list->DisplayRecords - 1)
		$project_status_list->StopRecord = $project_status_list->StartRecord + $project_status_list->DisplayRecords - 1;
	else
		$project_status_list->StopRecord = $project_status_list->TotalRecords;
}
$project_status_list->RecordCount = $project_status_list->StartRecord - 1;
if ($project_status_list->Recordset && !$project_status_list->Recordset->EOF) {
	$project_status_list->Recordset->moveFirst();
	$selectLimit = $project_status_list->UseSelectLimit;
	if (!$selectLimit && $project_status_list->StartRecord > 1)
		$project_status_list->Recordset->move($project_status_list->StartRecord - 1);
} elseif (!$project_status->AllowAddDeleteRow && $project_status_list->StopRecord == 0) {
	$project_status_list->StopRecord = $project_status->GridAddRowCount;
}

// Initialize aggregate
$project_status->RowType = ROWTYPE_AGGREGATEINIT;
$project_status->resetAttributes();
$project_status_list->renderRow();
while ($project_status_list->RecordCount < $project_status_list->StopRecord) {
	$project_status_list->RecordCount++;
	if ($project_status_list->RecordCount >= $project_status_list->StartRecord) {
		$project_status_list->RowCount++;

		// Set up key count
		$project_status_list->KeyCount = $project_status_list->RowIndex;

		// Init row class and style
		$project_status->resetAttributes();
		$project_status->CssClass = "";
		if ($project_status_list->isGridAdd()) {
		} else {
			$project_status_list->loadRowValues($project_status_list->Recordset); // Load row values
		}
		$project_status->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$project_status->RowAttrs->merge(["data-rowindex" => $project_status_list->RowCount, "id" => "r" . $project_status_list->RowCount . "_project_status", "data-rowtype" => $project_status->RowType]);

		// Render row
		$project_status_list->renderRow();

		// Render list options
		$project_status_list->renderListOptions();
?>
	<tr <?php echo $project_status->rowAttributes() ?>>
<?php

// Render list options (body, left)
$project_status_list->ListOptions->render("body", "left", $project_status_list->RowCount);
?>
	<?php if ($project_status_list->ProjectStatusCode->Visible) { // ProjectStatusCode ?>
		<td data-name="ProjectStatusCode" <?php echo $project_status_list->ProjectStatusCode->cellAttributes() ?>>
<span id="el<?php echo $project_status_list->RowCount ?>_project_status_ProjectStatusCode">
<span<?php echo $project_status_list->ProjectStatusCode->viewAttributes() ?>><?php echo $project_status_list->ProjectStatusCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($project_status_list->ProjectStatusDesc->Visible) { // ProjectStatusDesc ?>
		<td data-name="ProjectStatusDesc" <?php echo $project_status_list->ProjectStatusDesc->cellAttributes() ?>>
<span id="el<?php echo $project_status_list->RowCount ?>_project_status_ProjectStatusDesc">
<span<?php echo $project_status_list->ProjectStatusDesc->viewAttributes() ?>><?php echo $project_status_list->ProjectStatusDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($project_status_list->LastUserID->Visible) { // LastUserID ?>
		<td data-name="LastUserID" <?php echo $project_status_list->LastUserID->cellAttributes() ?>>
<span id="el<?php echo $project_status_list->RowCount ?>_project_status_LastUserID">
<span<?php echo $project_status_list->LastUserID->viewAttributes() ?>><?php echo $project_status_list->LastUserID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($project_status_list->LastUpdated->Visible) { // LastUpdated ?>
		<td data-name="LastUpdated" <?php echo $project_status_list->LastUpdated->cellAttributes() ?>>
<span id="el<?php echo $project_status_list->RowCount ?>_project_status_LastUpdated">
<span<?php echo $project_status_list->LastUpdated->viewAttributes() ?>><?php echo $project_status_list->LastUpdated->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$project_status_list->ListOptions->render("body", "right", $project_status_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$project_status_list->isGridAdd())
		$project_status_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$project_status->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($project_status_list->Recordset)
	$project_status_list->Recordset->Close();
?>
<?php if (!$project_status_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$project_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $project_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $project_status_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($project_status_list->TotalRecords == 0 && !$project_status->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $project_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$project_status_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$project_status_list->isExport()) { ?>
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
$project_status_list->terminate();
?>