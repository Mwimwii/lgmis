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
$progress_status_list = new progress_status_list();

// Run the page
$progress_status_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$progress_status_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$progress_status_list->isExport()) { ?>
<script>
var fprogress_statuslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fprogress_statuslist = currentForm = new ew.Form("fprogress_statuslist", "list");
	fprogress_statuslist.formKeyCountName = '<?php echo $progress_status_list->FormKeyCountName ?>';
	loadjs.done("fprogress_statuslist");
});
var fprogress_statuslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fprogress_statuslistsrch = currentSearchForm = new ew.Form("fprogress_statuslistsrch");

	// Dynamic selection lists
	// Filters

	fprogress_statuslistsrch.filterList = <?php echo $progress_status_list->getFilterList() ?>;

	// Init search panel as collapsed
	fprogress_statuslistsrch.initSearchPanel = true;
	loadjs.done("fprogress_statuslistsrch");
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
<?php if (!$progress_status_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($progress_status_list->TotalRecords > 0 && $progress_status_list->ExportOptions->visible()) { ?>
<?php $progress_status_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($progress_status_list->ImportOptions->visible()) { ?>
<?php $progress_status_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($progress_status_list->SearchOptions->visible()) { ?>
<?php $progress_status_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($progress_status_list->FilterOptions->visible()) { ?>
<?php $progress_status_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$progress_status_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$progress_status_list->isExport() && !$progress_status->CurrentAction) { ?>
<form name="fprogress_statuslistsrch" id="fprogress_statuslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fprogress_statuslistsrch-search-panel" class="<?php echo $progress_status_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="progress_status">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $progress_status_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($progress_status_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($progress_status_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $progress_status_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($progress_status_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($progress_status_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($progress_status_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($progress_status_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $progress_status_list->showPageHeader(); ?>
<?php
$progress_status_list->showMessage();
?>
<?php if ($progress_status_list->TotalRecords > 0 || $progress_status->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($progress_status_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> progress_status">
<?php if (!$progress_status_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$progress_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $progress_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $progress_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fprogress_statuslist" id="fprogress_statuslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="progress_status">
<div id="gmp_progress_status" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($progress_status_list->TotalRecords > 0 || $progress_status_list->isGridEdit()) { ?>
<table id="tbl_progress_statuslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$progress_status->RowType = ROWTYPE_HEADER;

// Render list options
$progress_status_list->renderListOptions();

// Render list options (header, left)
$progress_status_list->ListOptions->render("header", "left");
?>
<?php if ($progress_status_list->ProgressCode->Visible) { // ProgressCode ?>
	<?php if ($progress_status_list->SortUrl($progress_status_list->ProgressCode) == "") { ?>
		<th data-name="ProgressCode" class="<?php echo $progress_status_list->ProgressCode->headerCellClass() ?>"><div id="elh_progress_status_ProgressCode" class="progress_status_ProgressCode"><div class="ew-table-header-caption"><?php echo $progress_status_list->ProgressCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgressCode" class="<?php echo $progress_status_list->ProgressCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $progress_status_list->SortUrl($progress_status_list->ProgressCode) ?>', 1);"><div id="elh_progress_status_ProgressCode" class="progress_status_ProgressCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $progress_status_list->ProgressCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($progress_status_list->ProgressCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($progress_status_list->ProgressCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($progress_status_list->ProgressDescription->Visible) { // ProgressDescription ?>
	<?php if ($progress_status_list->SortUrl($progress_status_list->ProgressDescription) == "") { ?>
		<th data-name="ProgressDescription" class="<?php echo $progress_status_list->ProgressDescription->headerCellClass() ?>"><div id="elh_progress_status_ProgressDescription" class="progress_status_ProgressDescription"><div class="ew-table-header-caption"><?php echo $progress_status_list->ProgressDescription->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgressDescription" class="<?php echo $progress_status_list->ProgressDescription->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $progress_status_list->SortUrl($progress_status_list->ProgressDescription) ?>', 1);"><div id="elh_progress_status_ProgressDescription" class="progress_status_ProgressDescription">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $progress_status_list->ProgressDescription->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($progress_status_list->ProgressDescription->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($progress_status_list->ProgressDescription->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$progress_status_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($progress_status_list->ExportAll && $progress_status_list->isExport()) {
	$progress_status_list->StopRecord = $progress_status_list->TotalRecords;
} else {

	// Set the last record to display
	if ($progress_status_list->TotalRecords > $progress_status_list->StartRecord + $progress_status_list->DisplayRecords - 1)
		$progress_status_list->StopRecord = $progress_status_list->StartRecord + $progress_status_list->DisplayRecords - 1;
	else
		$progress_status_list->StopRecord = $progress_status_list->TotalRecords;
}
$progress_status_list->RecordCount = $progress_status_list->StartRecord - 1;
if ($progress_status_list->Recordset && !$progress_status_list->Recordset->EOF) {
	$progress_status_list->Recordset->moveFirst();
	$selectLimit = $progress_status_list->UseSelectLimit;
	if (!$selectLimit && $progress_status_list->StartRecord > 1)
		$progress_status_list->Recordset->move($progress_status_list->StartRecord - 1);
} elseif (!$progress_status->AllowAddDeleteRow && $progress_status_list->StopRecord == 0) {
	$progress_status_list->StopRecord = $progress_status->GridAddRowCount;
}

// Initialize aggregate
$progress_status->RowType = ROWTYPE_AGGREGATEINIT;
$progress_status->resetAttributes();
$progress_status_list->renderRow();
while ($progress_status_list->RecordCount < $progress_status_list->StopRecord) {
	$progress_status_list->RecordCount++;
	if ($progress_status_list->RecordCount >= $progress_status_list->StartRecord) {
		$progress_status_list->RowCount++;

		// Set up key count
		$progress_status_list->KeyCount = $progress_status_list->RowIndex;

		// Init row class and style
		$progress_status->resetAttributes();
		$progress_status->CssClass = "";
		if ($progress_status_list->isGridAdd()) {
		} else {
			$progress_status_list->loadRowValues($progress_status_list->Recordset); // Load row values
		}
		$progress_status->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$progress_status->RowAttrs->merge(["data-rowindex" => $progress_status_list->RowCount, "id" => "r" . $progress_status_list->RowCount . "_progress_status", "data-rowtype" => $progress_status->RowType]);

		// Render row
		$progress_status_list->renderRow();

		// Render list options
		$progress_status_list->renderListOptions();
?>
	<tr <?php echo $progress_status->rowAttributes() ?>>
<?php

// Render list options (body, left)
$progress_status_list->ListOptions->render("body", "left", $progress_status_list->RowCount);
?>
	<?php if ($progress_status_list->ProgressCode->Visible) { // ProgressCode ?>
		<td data-name="ProgressCode" <?php echo $progress_status_list->ProgressCode->cellAttributes() ?>>
<span id="el<?php echo $progress_status_list->RowCount ?>_progress_status_ProgressCode">
<span<?php echo $progress_status_list->ProgressCode->viewAttributes() ?>><?php echo $progress_status_list->ProgressCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($progress_status_list->ProgressDescription->Visible) { // ProgressDescription ?>
		<td data-name="ProgressDescription" <?php echo $progress_status_list->ProgressDescription->cellAttributes() ?>>
<span id="el<?php echo $progress_status_list->RowCount ?>_progress_status_ProgressDescription">
<span<?php echo $progress_status_list->ProgressDescription->viewAttributes() ?>><?php echo $progress_status_list->ProgressDescription->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$progress_status_list->ListOptions->render("body", "right", $progress_status_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$progress_status_list->isGridAdd())
		$progress_status_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$progress_status->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($progress_status_list->Recordset)
	$progress_status_list->Recordset->Close();
?>
<?php if (!$progress_status_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$progress_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $progress_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $progress_status_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($progress_status_list->TotalRecords == 0 && !$progress_status->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $progress_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$progress_status_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$progress_status_list->isExport()) { ?>
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
$progress_status_list->terminate();
?>