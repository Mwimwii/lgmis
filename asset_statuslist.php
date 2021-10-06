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
$asset_status_list = new asset_status_list();

// Run the page
$asset_status_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$asset_status_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$asset_status_list->isExport()) { ?>
<script>
var fasset_statuslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fasset_statuslist = currentForm = new ew.Form("fasset_statuslist", "list");
	fasset_statuslist.formKeyCountName = '<?php echo $asset_status_list->FormKeyCountName ?>';
	loadjs.done("fasset_statuslist");
});
var fasset_statuslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fasset_statuslistsrch = currentSearchForm = new ew.Form("fasset_statuslistsrch");

	// Dynamic selection lists
	// Filters

	fasset_statuslistsrch.filterList = <?php echo $asset_status_list->getFilterList() ?>;

	// Init search panel as collapsed
	fasset_statuslistsrch.initSearchPanel = true;
	loadjs.done("fasset_statuslistsrch");
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
<?php if (!$asset_status_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($asset_status_list->TotalRecords > 0 && $asset_status_list->ExportOptions->visible()) { ?>
<?php $asset_status_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($asset_status_list->ImportOptions->visible()) { ?>
<?php $asset_status_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($asset_status_list->SearchOptions->visible()) { ?>
<?php $asset_status_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($asset_status_list->FilterOptions->visible()) { ?>
<?php $asset_status_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$asset_status_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$asset_status_list->isExport() && !$asset_status->CurrentAction) { ?>
<form name="fasset_statuslistsrch" id="fasset_statuslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fasset_statuslistsrch-search-panel" class="<?php echo $asset_status_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="asset_status">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $asset_status_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($asset_status_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($asset_status_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $asset_status_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($asset_status_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($asset_status_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($asset_status_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($asset_status_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $asset_status_list->showPageHeader(); ?>
<?php
$asset_status_list->showMessage();
?>
<?php if ($asset_status_list->TotalRecords > 0 || $asset_status->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($asset_status_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> asset_status">
<?php if (!$asset_status_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$asset_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $asset_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $asset_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fasset_statuslist" id="fasset_statuslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="asset_status">
<div id="gmp_asset_status" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($asset_status_list->TotalRecords > 0 || $asset_status_list->isGridEdit()) { ?>
<table id="tbl_asset_statuslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$asset_status->RowType = ROWTYPE_HEADER;

// Render list options
$asset_status_list->renderListOptions();

// Render list options (header, left)
$asset_status_list->ListOptions->render("header", "left");
?>
<?php if ($asset_status_list->AssetStatusCode->Visible) { // AssetStatusCode ?>
	<?php if ($asset_status_list->SortUrl($asset_status_list->AssetStatusCode) == "") { ?>
		<th data-name="AssetStatusCode" class="<?php echo $asset_status_list->AssetStatusCode->headerCellClass() ?>"><div id="elh_asset_status_AssetStatusCode" class="asset_status_AssetStatusCode"><div class="ew-table-header-caption"><?php echo $asset_status_list->AssetStatusCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssetStatusCode" class="<?php echo $asset_status_list->AssetStatusCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_status_list->SortUrl($asset_status_list->AssetStatusCode) ?>', 1);"><div id="elh_asset_status_AssetStatusCode" class="asset_status_AssetStatusCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_status_list->AssetStatusCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_status_list->AssetStatusCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_status_list->AssetStatusCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_status_list->AssetStatus->Visible) { // AssetStatus ?>
	<?php if ($asset_status_list->SortUrl($asset_status_list->AssetStatus) == "") { ?>
		<th data-name="AssetStatus" class="<?php echo $asset_status_list->AssetStatus->headerCellClass() ?>"><div id="elh_asset_status_AssetStatus" class="asset_status_AssetStatus"><div class="ew-table-header-caption"><?php echo $asset_status_list->AssetStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssetStatus" class="<?php echo $asset_status_list->AssetStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_status_list->SortUrl($asset_status_list->AssetStatus) ?>', 1);"><div id="elh_asset_status_AssetStatus" class="asset_status_AssetStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_status_list->AssetStatus->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($asset_status_list->AssetStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_status_list->AssetStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$asset_status_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($asset_status_list->ExportAll && $asset_status_list->isExport()) {
	$asset_status_list->StopRecord = $asset_status_list->TotalRecords;
} else {

	// Set the last record to display
	if ($asset_status_list->TotalRecords > $asset_status_list->StartRecord + $asset_status_list->DisplayRecords - 1)
		$asset_status_list->StopRecord = $asset_status_list->StartRecord + $asset_status_list->DisplayRecords - 1;
	else
		$asset_status_list->StopRecord = $asset_status_list->TotalRecords;
}
$asset_status_list->RecordCount = $asset_status_list->StartRecord - 1;
if ($asset_status_list->Recordset && !$asset_status_list->Recordset->EOF) {
	$asset_status_list->Recordset->moveFirst();
	$selectLimit = $asset_status_list->UseSelectLimit;
	if (!$selectLimit && $asset_status_list->StartRecord > 1)
		$asset_status_list->Recordset->move($asset_status_list->StartRecord - 1);
} elseif (!$asset_status->AllowAddDeleteRow && $asset_status_list->StopRecord == 0) {
	$asset_status_list->StopRecord = $asset_status->GridAddRowCount;
}

// Initialize aggregate
$asset_status->RowType = ROWTYPE_AGGREGATEINIT;
$asset_status->resetAttributes();
$asset_status_list->renderRow();
while ($asset_status_list->RecordCount < $asset_status_list->StopRecord) {
	$asset_status_list->RecordCount++;
	if ($asset_status_list->RecordCount >= $asset_status_list->StartRecord) {
		$asset_status_list->RowCount++;

		// Set up key count
		$asset_status_list->KeyCount = $asset_status_list->RowIndex;

		// Init row class and style
		$asset_status->resetAttributes();
		$asset_status->CssClass = "";
		if ($asset_status_list->isGridAdd()) {
		} else {
			$asset_status_list->loadRowValues($asset_status_list->Recordset); // Load row values
		}
		$asset_status->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$asset_status->RowAttrs->merge(["data-rowindex" => $asset_status_list->RowCount, "id" => "r" . $asset_status_list->RowCount . "_asset_status", "data-rowtype" => $asset_status->RowType]);

		// Render row
		$asset_status_list->renderRow();

		// Render list options
		$asset_status_list->renderListOptions();
?>
	<tr <?php echo $asset_status->rowAttributes() ?>>
<?php

// Render list options (body, left)
$asset_status_list->ListOptions->render("body", "left", $asset_status_list->RowCount);
?>
	<?php if ($asset_status_list->AssetStatusCode->Visible) { // AssetStatusCode ?>
		<td data-name="AssetStatusCode" <?php echo $asset_status_list->AssetStatusCode->cellAttributes() ?>>
<span id="el<?php echo $asset_status_list->RowCount ?>_asset_status_AssetStatusCode">
<span<?php echo $asset_status_list->AssetStatusCode->viewAttributes() ?>><?php echo $asset_status_list->AssetStatusCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($asset_status_list->AssetStatus->Visible) { // AssetStatus ?>
		<td data-name="AssetStatus" <?php echo $asset_status_list->AssetStatus->cellAttributes() ?>>
<span id="el<?php echo $asset_status_list->RowCount ?>_asset_status_AssetStatus">
<span<?php echo $asset_status_list->AssetStatus->viewAttributes() ?>><?php echo $asset_status_list->AssetStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$asset_status_list->ListOptions->render("body", "right", $asset_status_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$asset_status_list->isGridAdd())
		$asset_status_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$asset_status->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($asset_status_list->Recordset)
	$asset_status_list->Recordset->Close();
?>
<?php if (!$asset_status_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$asset_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $asset_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $asset_status_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($asset_status_list->TotalRecords == 0 && !$asset_status->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $asset_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$asset_status_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$asset_status_list->isExport()) { ?>
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
$asset_status_list->terminate();
?>