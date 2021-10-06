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
$asset_type_list = new asset_type_list();

// Run the page
$asset_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$asset_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$asset_type_list->isExport()) { ?>
<script>
var fasset_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fasset_typelist = currentForm = new ew.Form("fasset_typelist", "list");
	fasset_typelist.formKeyCountName = '<?php echo $asset_type_list->FormKeyCountName ?>';
	loadjs.done("fasset_typelist");
});
var fasset_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fasset_typelistsrch = currentSearchForm = new ew.Form("fasset_typelistsrch");

	// Dynamic selection lists
	// Filters

	fasset_typelistsrch.filterList = <?php echo $asset_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	fasset_typelistsrch.initSearchPanel = true;
	loadjs.done("fasset_typelistsrch");
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
<?php if (!$asset_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($asset_type_list->TotalRecords > 0 && $asset_type_list->ExportOptions->visible()) { ?>
<?php $asset_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($asset_type_list->ImportOptions->visible()) { ?>
<?php $asset_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($asset_type_list->SearchOptions->visible()) { ?>
<?php $asset_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($asset_type_list->FilterOptions->visible()) { ?>
<?php $asset_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$asset_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$asset_type_list->isExport() && !$asset_type->CurrentAction) { ?>
<form name="fasset_typelistsrch" id="fasset_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fasset_typelistsrch-search-panel" class="<?php echo $asset_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="asset_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $asset_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($asset_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($asset_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $asset_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($asset_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($asset_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($asset_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($asset_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $asset_type_list->showPageHeader(); ?>
<?php
$asset_type_list->showMessage();
?>
<?php if ($asset_type_list->TotalRecords > 0 || $asset_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($asset_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> asset_type">
<?php if (!$asset_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$asset_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $asset_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $asset_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fasset_typelist" id="fasset_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="asset_type">
<div id="gmp_asset_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($asset_type_list->TotalRecords > 0 || $asset_type_list->isGridEdit()) { ?>
<table id="tbl_asset_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$asset_type->RowType = ROWTYPE_HEADER;

// Render list options
$asset_type_list->renderListOptions();

// Render list options (header, left)
$asset_type_list->ListOptions->render("header", "left");
?>
<?php if ($asset_type_list->AssetTypeCode->Visible) { // AssetTypeCode ?>
	<?php if ($asset_type_list->SortUrl($asset_type_list->AssetTypeCode) == "") { ?>
		<th data-name="AssetTypeCode" class="<?php echo $asset_type_list->AssetTypeCode->headerCellClass() ?>"><div id="elh_asset_type_AssetTypeCode" class="asset_type_AssetTypeCode"><div class="ew-table-header-caption"><?php echo $asset_type_list->AssetTypeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssetTypeCode" class="<?php echo $asset_type_list->AssetTypeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_type_list->SortUrl($asset_type_list->AssetTypeCode) ?>', 1);"><div id="elh_asset_type_AssetTypeCode" class="asset_type_AssetTypeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_type_list->AssetTypeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_type_list->AssetTypeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_type_list->AssetTypeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_type_list->AssetTypeName->Visible) { // AssetTypeName ?>
	<?php if ($asset_type_list->SortUrl($asset_type_list->AssetTypeName) == "") { ?>
		<th data-name="AssetTypeName" class="<?php echo $asset_type_list->AssetTypeName->headerCellClass() ?>"><div id="elh_asset_type_AssetTypeName" class="asset_type_AssetTypeName"><div class="ew-table-header-caption"><?php echo $asset_type_list->AssetTypeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssetTypeName" class="<?php echo $asset_type_list->AssetTypeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_type_list->SortUrl($asset_type_list->AssetTypeName) ?>', 1);"><div id="elh_asset_type_AssetTypeName" class="asset_type_AssetTypeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_type_list->AssetTypeName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($asset_type_list->AssetTypeName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_type_list->AssetTypeName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_type_list->AssetsTypeDesc->Visible) { // AssetsTypeDesc ?>
	<?php if ($asset_type_list->SortUrl($asset_type_list->AssetsTypeDesc) == "") { ?>
		<th data-name="AssetsTypeDesc" class="<?php echo $asset_type_list->AssetsTypeDesc->headerCellClass() ?>"><div id="elh_asset_type_AssetsTypeDesc" class="asset_type_AssetsTypeDesc"><div class="ew-table-header-caption"><?php echo $asset_type_list->AssetsTypeDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssetsTypeDesc" class="<?php echo $asset_type_list->AssetsTypeDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_type_list->SortUrl($asset_type_list->AssetsTypeDesc) ?>', 1);"><div id="elh_asset_type_AssetsTypeDesc" class="asset_type_AssetsTypeDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_type_list->AssetsTypeDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($asset_type_list->AssetsTypeDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_type_list->AssetsTypeDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$asset_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($asset_type_list->ExportAll && $asset_type_list->isExport()) {
	$asset_type_list->StopRecord = $asset_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($asset_type_list->TotalRecords > $asset_type_list->StartRecord + $asset_type_list->DisplayRecords - 1)
		$asset_type_list->StopRecord = $asset_type_list->StartRecord + $asset_type_list->DisplayRecords - 1;
	else
		$asset_type_list->StopRecord = $asset_type_list->TotalRecords;
}
$asset_type_list->RecordCount = $asset_type_list->StartRecord - 1;
if ($asset_type_list->Recordset && !$asset_type_list->Recordset->EOF) {
	$asset_type_list->Recordset->moveFirst();
	$selectLimit = $asset_type_list->UseSelectLimit;
	if (!$selectLimit && $asset_type_list->StartRecord > 1)
		$asset_type_list->Recordset->move($asset_type_list->StartRecord - 1);
} elseif (!$asset_type->AllowAddDeleteRow && $asset_type_list->StopRecord == 0) {
	$asset_type_list->StopRecord = $asset_type->GridAddRowCount;
}

// Initialize aggregate
$asset_type->RowType = ROWTYPE_AGGREGATEINIT;
$asset_type->resetAttributes();
$asset_type_list->renderRow();
while ($asset_type_list->RecordCount < $asset_type_list->StopRecord) {
	$asset_type_list->RecordCount++;
	if ($asset_type_list->RecordCount >= $asset_type_list->StartRecord) {
		$asset_type_list->RowCount++;

		// Set up key count
		$asset_type_list->KeyCount = $asset_type_list->RowIndex;

		// Init row class and style
		$asset_type->resetAttributes();
		$asset_type->CssClass = "";
		if ($asset_type_list->isGridAdd()) {
		} else {
			$asset_type_list->loadRowValues($asset_type_list->Recordset); // Load row values
		}
		$asset_type->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$asset_type->RowAttrs->merge(["data-rowindex" => $asset_type_list->RowCount, "id" => "r" . $asset_type_list->RowCount . "_asset_type", "data-rowtype" => $asset_type->RowType]);

		// Render row
		$asset_type_list->renderRow();

		// Render list options
		$asset_type_list->renderListOptions();
?>
	<tr <?php echo $asset_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$asset_type_list->ListOptions->render("body", "left", $asset_type_list->RowCount);
?>
	<?php if ($asset_type_list->AssetTypeCode->Visible) { // AssetTypeCode ?>
		<td data-name="AssetTypeCode" <?php echo $asset_type_list->AssetTypeCode->cellAttributes() ?>>
<span id="el<?php echo $asset_type_list->RowCount ?>_asset_type_AssetTypeCode">
<span<?php echo $asset_type_list->AssetTypeCode->viewAttributes() ?>><?php echo $asset_type_list->AssetTypeCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($asset_type_list->AssetTypeName->Visible) { // AssetTypeName ?>
		<td data-name="AssetTypeName" <?php echo $asset_type_list->AssetTypeName->cellAttributes() ?>>
<span id="el<?php echo $asset_type_list->RowCount ?>_asset_type_AssetTypeName">
<span<?php echo $asset_type_list->AssetTypeName->viewAttributes() ?>><?php echo $asset_type_list->AssetTypeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($asset_type_list->AssetsTypeDesc->Visible) { // AssetsTypeDesc ?>
		<td data-name="AssetsTypeDesc" <?php echo $asset_type_list->AssetsTypeDesc->cellAttributes() ?>>
<span id="el<?php echo $asset_type_list->RowCount ?>_asset_type_AssetsTypeDesc">
<span<?php echo $asset_type_list->AssetsTypeDesc->viewAttributes() ?>><?php echo $asset_type_list->AssetsTypeDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$asset_type_list->ListOptions->render("body", "right", $asset_type_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$asset_type_list->isGridAdd())
		$asset_type_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$asset_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($asset_type_list->Recordset)
	$asset_type_list->Recordset->Close();
?>
<?php if (!$asset_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$asset_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $asset_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $asset_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($asset_type_list->TotalRecords == 0 && !$asset_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $asset_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$asset_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$asset_type_list->isExport()) { ?>
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
$asset_type_list->terminate();
?>