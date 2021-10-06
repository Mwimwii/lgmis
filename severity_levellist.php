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
$severity_level_list = new severity_level_list();

// Run the page
$severity_level_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$severity_level_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$severity_level_list->isExport()) { ?>
<script>
var fseverity_levellist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fseverity_levellist = currentForm = new ew.Form("fseverity_levellist", "list");
	fseverity_levellist.formKeyCountName = '<?php echo $severity_level_list->FormKeyCountName ?>';
	loadjs.done("fseverity_levellist");
});
var fseverity_levellistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fseverity_levellistsrch = currentSearchForm = new ew.Form("fseverity_levellistsrch");

	// Dynamic selection lists
	// Filters

	fseverity_levellistsrch.filterList = <?php echo $severity_level_list->getFilterList() ?>;

	// Init search panel as collapsed
	fseverity_levellistsrch.initSearchPanel = true;
	loadjs.done("fseverity_levellistsrch");
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
<?php if (!$severity_level_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($severity_level_list->TotalRecords > 0 && $severity_level_list->ExportOptions->visible()) { ?>
<?php $severity_level_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($severity_level_list->ImportOptions->visible()) { ?>
<?php $severity_level_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($severity_level_list->SearchOptions->visible()) { ?>
<?php $severity_level_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($severity_level_list->FilterOptions->visible()) { ?>
<?php $severity_level_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$severity_level_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$severity_level_list->isExport() && !$severity_level->CurrentAction) { ?>
<form name="fseverity_levellistsrch" id="fseverity_levellistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fseverity_levellistsrch-search-panel" class="<?php echo $severity_level_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="severity_level">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $severity_level_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($severity_level_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($severity_level_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $severity_level_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($severity_level_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($severity_level_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($severity_level_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($severity_level_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $severity_level_list->showPageHeader(); ?>
<?php
$severity_level_list->showMessage();
?>
<?php if ($severity_level_list->TotalRecords > 0 || $severity_level->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($severity_level_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> severity_level">
<?php if (!$severity_level_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$severity_level_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $severity_level_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $severity_level_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fseverity_levellist" id="fseverity_levellist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="severity_level">
<div id="gmp_severity_level" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($severity_level_list->TotalRecords > 0 || $severity_level_list->isGridEdit()) { ?>
<table id="tbl_severity_levellist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$severity_level->RowType = ROWTYPE_HEADER;

// Render list options
$severity_level_list->renderListOptions();

// Render list options (header, left)
$severity_level_list->ListOptions->render("header", "left");
?>
<?php if ($severity_level_list->SeverityLevelCode->Visible) { // SeverityLevelCode ?>
	<?php if ($severity_level_list->SortUrl($severity_level_list->SeverityLevelCode) == "") { ?>
		<th data-name="SeverityLevelCode" class="<?php echo $severity_level_list->SeverityLevelCode->headerCellClass() ?>"><div id="elh_severity_level_SeverityLevelCode" class="severity_level_SeverityLevelCode"><div class="ew-table-header-caption"><?php echo $severity_level_list->SeverityLevelCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SeverityLevelCode" class="<?php echo $severity_level_list->SeverityLevelCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $severity_level_list->SortUrl($severity_level_list->SeverityLevelCode) ?>', 1);"><div id="elh_severity_level_SeverityLevelCode" class="severity_level_SeverityLevelCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $severity_level_list->SeverityLevelCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($severity_level_list->SeverityLevelCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($severity_level_list->SeverityLevelCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($severity_level_list->SeverityLevel->Visible) { // SeverityLevel ?>
	<?php if ($severity_level_list->SortUrl($severity_level_list->SeverityLevel) == "") { ?>
		<th data-name="SeverityLevel" class="<?php echo $severity_level_list->SeverityLevel->headerCellClass() ?>"><div id="elh_severity_level_SeverityLevel" class="severity_level_SeverityLevel"><div class="ew-table-header-caption"><?php echo $severity_level_list->SeverityLevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SeverityLevel" class="<?php echo $severity_level_list->SeverityLevel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $severity_level_list->SortUrl($severity_level_list->SeverityLevel) ?>', 1);"><div id="elh_severity_level_SeverityLevel" class="severity_level_SeverityLevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $severity_level_list->SeverityLevel->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($severity_level_list->SeverityLevel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($severity_level_list->SeverityLevel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($severity_level_list->SeverityDescription->Visible) { // SeverityDescription ?>
	<?php if ($severity_level_list->SortUrl($severity_level_list->SeverityDescription) == "") { ?>
		<th data-name="SeverityDescription" class="<?php echo $severity_level_list->SeverityDescription->headerCellClass() ?>"><div id="elh_severity_level_SeverityDescription" class="severity_level_SeverityDescription"><div class="ew-table-header-caption"><?php echo $severity_level_list->SeverityDescription->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SeverityDescription" class="<?php echo $severity_level_list->SeverityDescription->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $severity_level_list->SortUrl($severity_level_list->SeverityDescription) ?>', 1);"><div id="elh_severity_level_SeverityDescription" class="severity_level_SeverityDescription">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $severity_level_list->SeverityDescription->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($severity_level_list->SeverityDescription->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($severity_level_list->SeverityDescription->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($severity_level_list->ResponseTime->Visible) { // ResponseTime ?>
	<?php if ($severity_level_list->SortUrl($severity_level_list->ResponseTime) == "") { ?>
		<th data-name="ResponseTime" class="<?php echo $severity_level_list->ResponseTime->headerCellClass() ?>"><div id="elh_severity_level_ResponseTime" class="severity_level_ResponseTime"><div class="ew-table-header-caption"><?php echo $severity_level_list->ResponseTime->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ResponseTime" class="<?php echo $severity_level_list->ResponseTime->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $severity_level_list->SortUrl($severity_level_list->ResponseTime) ?>', 1);"><div id="elh_severity_level_ResponseTime" class="severity_level_ResponseTime">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $severity_level_list->ResponseTime->caption() ?></span><span class="ew-table-header-sort"><?php if ($severity_level_list->ResponseTime->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($severity_level_list->ResponseTime->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$severity_level_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($severity_level_list->ExportAll && $severity_level_list->isExport()) {
	$severity_level_list->StopRecord = $severity_level_list->TotalRecords;
} else {

	// Set the last record to display
	if ($severity_level_list->TotalRecords > $severity_level_list->StartRecord + $severity_level_list->DisplayRecords - 1)
		$severity_level_list->StopRecord = $severity_level_list->StartRecord + $severity_level_list->DisplayRecords - 1;
	else
		$severity_level_list->StopRecord = $severity_level_list->TotalRecords;
}
$severity_level_list->RecordCount = $severity_level_list->StartRecord - 1;
if ($severity_level_list->Recordset && !$severity_level_list->Recordset->EOF) {
	$severity_level_list->Recordset->moveFirst();
	$selectLimit = $severity_level_list->UseSelectLimit;
	if (!$selectLimit && $severity_level_list->StartRecord > 1)
		$severity_level_list->Recordset->move($severity_level_list->StartRecord - 1);
} elseif (!$severity_level->AllowAddDeleteRow && $severity_level_list->StopRecord == 0) {
	$severity_level_list->StopRecord = $severity_level->GridAddRowCount;
}

// Initialize aggregate
$severity_level->RowType = ROWTYPE_AGGREGATEINIT;
$severity_level->resetAttributes();
$severity_level_list->renderRow();
while ($severity_level_list->RecordCount < $severity_level_list->StopRecord) {
	$severity_level_list->RecordCount++;
	if ($severity_level_list->RecordCount >= $severity_level_list->StartRecord) {
		$severity_level_list->RowCount++;

		// Set up key count
		$severity_level_list->KeyCount = $severity_level_list->RowIndex;

		// Init row class and style
		$severity_level->resetAttributes();
		$severity_level->CssClass = "";
		if ($severity_level_list->isGridAdd()) {
		} else {
			$severity_level_list->loadRowValues($severity_level_list->Recordset); // Load row values
		}
		$severity_level->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$severity_level->RowAttrs->merge(["data-rowindex" => $severity_level_list->RowCount, "id" => "r" . $severity_level_list->RowCount . "_severity_level", "data-rowtype" => $severity_level->RowType]);

		// Render row
		$severity_level_list->renderRow();

		// Render list options
		$severity_level_list->renderListOptions();
?>
	<tr <?php echo $severity_level->rowAttributes() ?>>
<?php

// Render list options (body, left)
$severity_level_list->ListOptions->render("body", "left", $severity_level_list->RowCount);
?>
	<?php if ($severity_level_list->SeverityLevelCode->Visible) { // SeverityLevelCode ?>
		<td data-name="SeverityLevelCode" <?php echo $severity_level_list->SeverityLevelCode->cellAttributes() ?>>
<span id="el<?php echo $severity_level_list->RowCount ?>_severity_level_SeverityLevelCode">
<span<?php echo $severity_level_list->SeverityLevelCode->viewAttributes() ?>><?php echo $severity_level_list->SeverityLevelCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($severity_level_list->SeverityLevel->Visible) { // SeverityLevel ?>
		<td data-name="SeverityLevel" <?php echo $severity_level_list->SeverityLevel->cellAttributes() ?>>
<span id="el<?php echo $severity_level_list->RowCount ?>_severity_level_SeverityLevel">
<span<?php echo $severity_level_list->SeverityLevel->viewAttributes() ?>><?php echo $severity_level_list->SeverityLevel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($severity_level_list->SeverityDescription->Visible) { // SeverityDescription ?>
		<td data-name="SeverityDescription" <?php echo $severity_level_list->SeverityDescription->cellAttributes() ?>>
<span id="el<?php echo $severity_level_list->RowCount ?>_severity_level_SeverityDescription">
<span<?php echo $severity_level_list->SeverityDescription->viewAttributes() ?>><?php echo $severity_level_list->SeverityDescription->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($severity_level_list->ResponseTime->Visible) { // ResponseTime ?>
		<td data-name="ResponseTime" <?php echo $severity_level_list->ResponseTime->cellAttributes() ?>>
<span id="el<?php echo $severity_level_list->RowCount ?>_severity_level_ResponseTime">
<span<?php echo $severity_level_list->ResponseTime->viewAttributes() ?>><?php echo $severity_level_list->ResponseTime->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$severity_level_list->ListOptions->render("body", "right", $severity_level_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$severity_level_list->isGridAdd())
		$severity_level_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$severity_level->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($severity_level_list->Recordset)
	$severity_level_list->Recordset->Close();
?>
<?php if (!$severity_level_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$severity_level_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $severity_level_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $severity_level_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($severity_level_list->TotalRecords == 0 && !$severity_level->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $severity_level_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$severity_level_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$severity_level_list->isExport()) { ?>
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
$severity_level_list->terminate();
?>