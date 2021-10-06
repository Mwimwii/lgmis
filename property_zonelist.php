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
$property_zone_list = new property_zone_list();

// Run the page
$property_zone_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_zone_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$property_zone_list->isExport()) { ?>
<script>
var fproperty_zonelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fproperty_zonelist = currentForm = new ew.Form("fproperty_zonelist", "list");
	fproperty_zonelist.formKeyCountName = '<?php echo $property_zone_list->FormKeyCountName ?>';
	loadjs.done("fproperty_zonelist");
});
var fproperty_zonelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fproperty_zonelistsrch = currentSearchForm = new ew.Form("fproperty_zonelistsrch");

	// Dynamic selection lists
	// Filters

	fproperty_zonelistsrch.filterList = <?php echo $property_zone_list->getFilterList() ?>;

	// Init search panel as collapsed
	fproperty_zonelistsrch.initSearchPanel = true;
	loadjs.done("fproperty_zonelistsrch");
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
<?php if (!$property_zone_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($property_zone_list->TotalRecords > 0 && $property_zone_list->ExportOptions->visible()) { ?>
<?php $property_zone_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($property_zone_list->ImportOptions->visible()) { ?>
<?php $property_zone_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($property_zone_list->SearchOptions->visible()) { ?>
<?php $property_zone_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($property_zone_list->FilterOptions->visible()) { ?>
<?php $property_zone_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$property_zone_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$property_zone_list->isExport() && !$property_zone->CurrentAction) { ?>
<form name="fproperty_zonelistsrch" id="fproperty_zonelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fproperty_zonelistsrch-search-panel" class="<?php echo $property_zone_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="property_zone">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $property_zone_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($property_zone_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($property_zone_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $property_zone_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($property_zone_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($property_zone_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($property_zone_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($property_zone_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $property_zone_list->showPageHeader(); ?>
<?php
$property_zone_list->showMessage();
?>
<?php if ($property_zone_list->TotalRecords > 0 || $property_zone->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($property_zone_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> property_zone">
<?php if (!$property_zone_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$property_zone_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_zone_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_zone_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fproperty_zonelist" id="fproperty_zonelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_zone">
<div id="gmp_property_zone" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($property_zone_list->TotalRecords > 0 || $property_zone_list->isGridEdit()) { ?>
<table id="tbl_property_zonelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$property_zone->RowType = ROWTYPE_HEADER;

// Render list options
$property_zone_list->renderListOptions();

// Render list options (header, left)
$property_zone_list->ListOptions->render("header", "left");
?>
<?php if ($property_zone_list->AreaCode->Visible) { // AreaCode ?>
	<?php if ($property_zone_list->SortUrl($property_zone_list->AreaCode) == "") { ?>
		<th data-name="AreaCode" class="<?php echo $property_zone_list->AreaCode->headerCellClass() ?>"><div id="elh_property_zone_AreaCode" class="property_zone_AreaCode"><div class="ew-table-header-caption"><?php echo $property_zone_list->AreaCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AreaCode" class="<?php echo $property_zone_list->AreaCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_zone_list->SortUrl($property_zone_list->AreaCode) ?>', 1);"><div id="elh_property_zone_AreaCode" class="property_zone_AreaCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_zone_list->AreaCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_zone_list->AreaCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_zone_list->AreaCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_zone_list->AreaName->Visible) { // AreaName ?>
	<?php if ($property_zone_list->SortUrl($property_zone_list->AreaName) == "") { ?>
		<th data-name="AreaName" class="<?php echo $property_zone_list->AreaName->headerCellClass() ?>"><div id="elh_property_zone_AreaName" class="property_zone_AreaName"><div class="ew-table-header-caption"><?php echo $property_zone_list->AreaName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AreaName" class="<?php echo $property_zone_list->AreaName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_zone_list->SortUrl($property_zone_list->AreaName) ?>', 1);"><div id="elh_property_zone_AreaName" class="property_zone_AreaName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_zone_list->AreaName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_zone_list->AreaName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_zone_list->AreaName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_zone_list->AreaType->Visible) { // AreaType ?>
	<?php if ($property_zone_list->SortUrl($property_zone_list->AreaType) == "") { ?>
		<th data-name="AreaType" class="<?php echo $property_zone_list->AreaType->headerCellClass() ?>"><div id="elh_property_zone_AreaType" class="property_zone_AreaType"><div class="ew-table-header-caption"><?php echo $property_zone_list->AreaType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AreaType" class="<?php echo $property_zone_list->AreaType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_zone_list->SortUrl($property_zone_list->AreaType) ?>', 1);"><div id="elh_property_zone_AreaType" class="property_zone_AreaType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_zone_list->AreaType->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_zone_list->AreaType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_zone_list->AreaType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_zone_list->LACode->Visible) { // LACode ?>
	<?php if ($property_zone_list->SortUrl($property_zone_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $property_zone_list->LACode->headerCellClass() ?>"><div id="elh_property_zone_LACode" class="property_zone_LACode"><div class="ew-table-header-caption"><?php echo $property_zone_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $property_zone_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_zone_list->SortUrl($property_zone_list->LACode) ?>', 1);"><div id="elh_property_zone_LACode" class="property_zone_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_zone_list->LACode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_zone_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_zone_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$property_zone_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($property_zone_list->ExportAll && $property_zone_list->isExport()) {
	$property_zone_list->StopRecord = $property_zone_list->TotalRecords;
} else {

	// Set the last record to display
	if ($property_zone_list->TotalRecords > $property_zone_list->StartRecord + $property_zone_list->DisplayRecords - 1)
		$property_zone_list->StopRecord = $property_zone_list->StartRecord + $property_zone_list->DisplayRecords - 1;
	else
		$property_zone_list->StopRecord = $property_zone_list->TotalRecords;
}
$property_zone_list->RecordCount = $property_zone_list->StartRecord - 1;
if ($property_zone_list->Recordset && !$property_zone_list->Recordset->EOF) {
	$property_zone_list->Recordset->moveFirst();
	$selectLimit = $property_zone_list->UseSelectLimit;
	if (!$selectLimit && $property_zone_list->StartRecord > 1)
		$property_zone_list->Recordset->move($property_zone_list->StartRecord - 1);
} elseif (!$property_zone->AllowAddDeleteRow && $property_zone_list->StopRecord == 0) {
	$property_zone_list->StopRecord = $property_zone->GridAddRowCount;
}

// Initialize aggregate
$property_zone->RowType = ROWTYPE_AGGREGATEINIT;
$property_zone->resetAttributes();
$property_zone_list->renderRow();
while ($property_zone_list->RecordCount < $property_zone_list->StopRecord) {
	$property_zone_list->RecordCount++;
	if ($property_zone_list->RecordCount >= $property_zone_list->StartRecord) {
		$property_zone_list->RowCount++;

		// Set up key count
		$property_zone_list->KeyCount = $property_zone_list->RowIndex;

		// Init row class and style
		$property_zone->resetAttributes();
		$property_zone->CssClass = "";
		if ($property_zone_list->isGridAdd()) {
		} else {
			$property_zone_list->loadRowValues($property_zone_list->Recordset); // Load row values
		}
		$property_zone->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$property_zone->RowAttrs->merge(["data-rowindex" => $property_zone_list->RowCount, "id" => "r" . $property_zone_list->RowCount . "_property_zone", "data-rowtype" => $property_zone->RowType]);

		// Render row
		$property_zone_list->renderRow();

		// Render list options
		$property_zone_list->renderListOptions();
?>
	<tr <?php echo $property_zone->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_zone_list->ListOptions->render("body", "left", $property_zone_list->RowCount);
?>
	<?php if ($property_zone_list->AreaCode->Visible) { // AreaCode ?>
		<td data-name="AreaCode" <?php echo $property_zone_list->AreaCode->cellAttributes() ?>>
<span id="el<?php echo $property_zone_list->RowCount ?>_property_zone_AreaCode">
<span<?php echo $property_zone_list->AreaCode->viewAttributes() ?>><?php echo $property_zone_list->AreaCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_zone_list->AreaName->Visible) { // AreaName ?>
		<td data-name="AreaName" <?php echo $property_zone_list->AreaName->cellAttributes() ?>>
<span id="el<?php echo $property_zone_list->RowCount ?>_property_zone_AreaName">
<span<?php echo $property_zone_list->AreaName->viewAttributes() ?>><?php echo $property_zone_list->AreaName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_zone_list->AreaType->Visible) { // AreaType ?>
		<td data-name="AreaType" <?php echo $property_zone_list->AreaType->cellAttributes() ?>>
<span id="el<?php echo $property_zone_list->RowCount ?>_property_zone_AreaType">
<span<?php echo $property_zone_list->AreaType->viewAttributes() ?>><?php echo $property_zone_list->AreaType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_zone_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $property_zone_list->LACode->cellAttributes() ?>>
<span id="el<?php echo $property_zone_list->RowCount ?>_property_zone_LACode">
<span<?php echo $property_zone_list->LACode->viewAttributes() ?>><?php echo $property_zone_list->LACode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$property_zone_list->ListOptions->render("body", "right", $property_zone_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$property_zone_list->isGridAdd())
		$property_zone_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$property_zone->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($property_zone_list->Recordset)
	$property_zone_list->Recordset->Close();
?>
<?php if (!$property_zone_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$property_zone_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_zone_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_zone_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($property_zone_list->TotalRecords == 0 && !$property_zone->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $property_zone_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$property_zone_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$property_zone_list->isExport()) { ?>
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
$property_zone_list->terminate();
?>