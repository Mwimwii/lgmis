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
$market_property_list = new market_property_list();

// Run the page
$market_property_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$market_property_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$market_property_list->isExport()) { ?>
<script>
var fmarket_propertylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmarket_propertylist = currentForm = new ew.Form("fmarket_propertylist", "list");
	fmarket_propertylist.formKeyCountName = '<?php echo $market_property_list->FormKeyCountName ?>';
	loadjs.done("fmarket_propertylist");
});
var fmarket_propertylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmarket_propertylistsrch = currentSearchForm = new ew.Form("fmarket_propertylistsrch");

	// Dynamic selection lists
	// Filters

	fmarket_propertylistsrch.filterList = <?php echo $market_property_list->getFilterList() ?>;

	// Init search panel as collapsed
	fmarket_propertylistsrch.initSearchPanel = true;
	loadjs.done("fmarket_propertylistsrch");
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
<?php if (!$market_property_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($market_property_list->TotalRecords > 0 && $market_property_list->ExportOptions->visible()) { ?>
<?php $market_property_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($market_property_list->ImportOptions->visible()) { ?>
<?php $market_property_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($market_property_list->SearchOptions->visible()) { ?>
<?php $market_property_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($market_property_list->FilterOptions->visible()) { ?>
<?php $market_property_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$market_property_list->isExport() || Config("EXPORT_MASTER_RECORD") && $market_property_list->isExport("print")) { ?>
<?php
if ($market_property_list->DbMasterFilter != "" && $market_property->getCurrentMasterTable() == "market") {
	if ($market_property_list->MasterRecordExists) {
		include_once "marketmaster.php";
	}
}
?>
<?php } ?>
<?php
$market_property_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$market_property_list->isExport() && !$market_property->CurrentAction) { ?>
<form name="fmarket_propertylistsrch" id="fmarket_propertylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmarket_propertylistsrch-search-panel" class="<?php echo $market_property_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="market_property">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $market_property_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($market_property_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($market_property_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $market_property_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($market_property_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($market_property_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($market_property_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($market_property_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $market_property_list->showPageHeader(); ?>
<?php
$market_property_list->showMessage();
?>
<?php if ($market_property_list->TotalRecords > 0 || $market_property->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($market_property_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> market_property">
<?php if (!$market_property_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$market_property_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $market_property_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $market_property_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmarket_propertylist" id="fmarket_propertylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="market_property">
<?php if ($market_property->getCurrentMasterTable() == "market" && $market_property->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="market">
<input type="hidden" name="fk_MarketNo" value="<?php echo HtmlEncode($market_property_list->MarketNo->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_market_property" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($market_property_list->TotalRecords > 0 || $market_property_list->isGridEdit()) { ?>
<table id="tbl_market_propertylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$market_property->RowType = ROWTYPE_HEADER;

// Render list options
$market_property_list->renderListOptions();

// Render list options (header, left)
$market_property_list->ListOptions->render("header", "left");
?>
<?php if ($market_property_list->MarketItemNo->Visible) { // MarketItemNo ?>
	<?php if ($market_property_list->SortUrl($market_property_list->MarketItemNo) == "") { ?>
		<th data-name="MarketItemNo" class="<?php echo $market_property_list->MarketItemNo->headerCellClass() ?>"><div id="elh_market_property_MarketItemNo" class="market_property_MarketItemNo"><div class="ew-table-header-caption"><?php echo $market_property_list->MarketItemNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MarketItemNo" class="<?php echo $market_property_list->MarketItemNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_property_list->SortUrl($market_property_list->MarketItemNo) ?>', 1);"><div id="elh_market_property_MarketItemNo" class="market_property_MarketItemNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_list->MarketItemNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_property_list->MarketItemNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_list->MarketItemNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_property_list->MarketNo->Visible) { // MarketNo ?>
	<?php if ($market_property_list->SortUrl($market_property_list->MarketNo) == "") { ?>
		<th data-name="MarketNo" class="<?php echo $market_property_list->MarketNo->headerCellClass() ?>"><div id="elh_market_property_MarketNo" class="market_property_MarketNo"><div class="ew-table-header-caption"><?php echo $market_property_list->MarketNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MarketNo" class="<?php echo $market_property_list->MarketNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_property_list->SortUrl($market_property_list->MarketNo) ?>', 1);"><div id="elh_market_property_MarketNo" class="market_property_MarketNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_list->MarketNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_property_list->MarketNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_list->MarketNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_property_list->ItemName->Visible) { // ItemName ?>
	<?php if ($market_property_list->SortUrl($market_property_list->ItemName) == "") { ?>
		<th data-name="ItemName" class="<?php echo $market_property_list->ItemName->headerCellClass() ?>"><div id="elh_market_property_ItemName" class="market_property_ItemName"><div class="ew-table-header-caption"><?php echo $market_property_list->ItemName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ItemName" class="<?php echo $market_property_list->ItemName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_property_list->SortUrl($market_property_list->ItemName) ?>', 1);"><div id="elh_market_property_ItemName" class="market_property_ItemName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_list->ItemName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($market_property_list->ItemName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_list->ItemName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_property_list->ItemRef->Visible) { // ItemRef ?>
	<?php if ($market_property_list->SortUrl($market_property_list->ItemRef) == "") { ?>
		<th data-name="ItemRef" class="<?php echo $market_property_list->ItemRef->headerCellClass() ?>"><div id="elh_market_property_ItemRef" class="market_property_ItemRef"><div class="ew-table-header-caption"><?php echo $market_property_list->ItemRef->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ItemRef" class="<?php echo $market_property_list->ItemRef->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_property_list->SortUrl($market_property_list->ItemRef) ?>', 1);"><div id="elh_market_property_ItemRef" class="market_property_ItemRef">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_list->ItemRef->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($market_property_list->ItemRef->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_list->ItemRef->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_property_list->ItemLength->Visible) { // ItemLength ?>
	<?php if ($market_property_list->SortUrl($market_property_list->ItemLength) == "") { ?>
		<th data-name="ItemLength" class="<?php echo $market_property_list->ItemLength->headerCellClass() ?>"><div id="elh_market_property_ItemLength" class="market_property_ItemLength"><div class="ew-table-header-caption"><?php echo $market_property_list->ItemLength->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ItemLength" class="<?php echo $market_property_list->ItemLength->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_property_list->SortUrl($market_property_list->ItemLength) ?>', 1);"><div id="elh_market_property_ItemLength" class="market_property_ItemLength">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_list->ItemLength->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_property_list->ItemLength->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_list->ItemLength->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_property_list->ItemWidth->Visible) { // ItemWidth ?>
	<?php if ($market_property_list->SortUrl($market_property_list->ItemWidth) == "") { ?>
		<th data-name="ItemWidth" class="<?php echo $market_property_list->ItemWidth->headerCellClass() ?>"><div id="elh_market_property_ItemWidth" class="market_property_ItemWidth"><div class="ew-table-header-caption"><?php echo $market_property_list->ItemWidth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ItemWidth" class="<?php echo $market_property_list->ItemWidth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_property_list->SortUrl($market_property_list->ItemWidth) ?>', 1);"><div id="elh_market_property_ItemWidth" class="market_property_ItemWidth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_list->ItemWidth->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_property_list->ItemWidth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_list->ItemWidth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_property_list->DefaultFees->Visible) { // DefaultFees ?>
	<?php if ($market_property_list->SortUrl($market_property_list->DefaultFees) == "") { ?>
		<th data-name="DefaultFees" class="<?php echo $market_property_list->DefaultFees->headerCellClass() ?>"><div id="elh_market_property_DefaultFees" class="market_property_DefaultFees"><div class="ew-table-header-caption"><?php echo $market_property_list->DefaultFees->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DefaultFees" class="<?php echo $market_property_list->DefaultFees->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_property_list->SortUrl($market_property_list->DefaultFees) ?>', 1);"><div id="elh_market_property_DefaultFees" class="market_property_DefaultFees">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_list->DefaultFees->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_property_list->DefaultFees->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_list->DefaultFees->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_property_list->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($market_property_list->SortUrl($market_property_list->LastUpdatedBy) == "") { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $market_property_list->LastUpdatedBy->headerCellClass() ?>"><div id="elh_market_property_LastUpdatedBy" class="market_property_LastUpdatedBy"><div class="ew-table-header-caption"><?php echo $market_property_list->LastUpdatedBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $market_property_list->LastUpdatedBy->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_property_list->SortUrl($market_property_list->LastUpdatedBy) ?>', 1);"><div id="elh_market_property_LastUpdatedBy" class="market_property_LastUpdatedBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_list->LastUpdatedBy->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($market_property_list->LastUpdatedBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_list->LastUpdatedBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_property_list->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<?php if ($market_property_list->SortUrl($market_property_list->LastUpdateDate) == "") { ?>
		<th data-name="LastUpdateDate" class="<?php echo $market_property_list->LastUpdateDate->headerCellClass() ?>"><div id="elh_market_property_LastUpdateDate" class="market_property_LastUpdateDate"><div class="ew-table-header-caption"><?php echo $market_property_list->LastUpdateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdateDate" class="<?php echo $market_property_list->LastUpdateDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_property_list->SortUrl($market_property_list->LastUpdateDate) ?>', 1);"><div id="elh_market_property_LastUpdateDate" class="market_property_LastUpdateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_list->LastUpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_property_list->LastUpdateDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_list->LastUpdateDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$market_property_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($market_property_list->ExportAll && $market_property_list->isExport()) {
	$market_property_list->StopRecord = $market_property_list->TotalRecords;
} else {

	// Set the last record to display
	if ($market_property_list->TotalRecords > $market_property_list->StartRecord + $market_property_list->DisplayRecords - 1)
		$market_property_list->StopRecord = $market_property_list->StartRecord + $market_property_list->DisplayRecords - 1;
	else
		$market_property_list->StopRecord = $market_property_list->TotalRecords;
}
$market_property_list->RecordCount = $market_property_list->StartRecord - 1;
if ($market_property_list->Recordset && !$market_property_list->Recordset->EOF) {
	$market_property_list->Recordset->moveFirst();
	$selectLimit = $market_property_list->UseSelectLimit;
	if (!$selectLimit && $market_property_list->StartRecord > 1)
		$market_property_list->Recordset->move($market_property_list->StartRecord - 1);
} elseif (!$market_property->AllowAddDeleteRow && $market_property_list->StopRecord == 0) {
	$market_property_list->StopRecord = $market_property->GridAddRowCount;
}

// Initialize aggregate
$market_property->RowType = ROWTYPE_AGGREGATEINIT;
$market_property->resetAttributes();
$market_property_list->renderRow();
while ($market_property_list->RecordCount < $market_property_list->StopRecord) {
	$market_property_list->RecordCount++;
	if ($market_property_list->RecordCount >= $market_property_list->StartRecord) {
		$market_property_list->RowCount++;

		// Set up key count
		$market_property_list->KeyCount = $market_property_list->RowIndex;

		// Init row class and style
		$market_property->resetAttributes();
		$market_property->CssClass = "";
		if ($market_property_list->isGridAdd()) {
		} else {
			$market_property_list->loadRowValues($market_property_list->Recordset); // Load row values
		}
		$market_property->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$market_property->RowAttrs->merge(["data-rowindex" => $market_property_list->RowCount, "id" => "r" . $market_property_list->RowCount . "_market_property", "data-rowtype" => $market_property->RowType]);

		// Render row
		$market_property_list->renderRow();

		// Render list options
		$market_property_list->renderListOptions();
?>
	<tr <?php echo $market_property->rowAttributes() ?>>
<?php

// Render list options (body, left)
$market_property_list->ListOptions->render("body", "left", $market_property_list->RowCount);
?>
	<?php if ($market_property_list->MarketItemNo->Visible) { // MarketItemNo ?>
		<td data-name="MarketItemNo" <?php echo $market_property_list->MarketItemNo->cellAttributes() ?>>
<span id="el<?php echo $market_property_list->RowCount ?>_market_property_MarketItemNo">
<span<?php echo $market_property_list->MarketItemNo->viewAttributes() ?>><?php echo $market_property_list->MarketItemNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($market_property_list->MarketNo->Visible) { // MarketNo ?>
		<td data-name="MarketNo" <?php echo $market_property_list->MarketNo->cellAttributes() ?>>
<span id="el<?php echo $market_property_list->RowCount ?>_market_property_MarketNo">
<span<?php echo $market_property_list->MarketNo->viewAttributes() ?>><?php echo $market_property_list->MarketNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($market_property_list->ItemName->Visible) { // ItemName ?>
		<td data-name="ItemName" <?php echo $market_property_list->ItemName->cellAttributes() ?>>
<span id="el<?php echo $market_property_list->RowCount ?>_market_property_ItemName">
<span<?php echo $market_property_list->ItemName->viewAttributes() ?>><?php echo $market_property_list->ItemName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($market_property_list->ItemRef->Visible) { // ItemRef ?>
		<td data-name="ItemRef" <?php echo $market_property_list->ItemRef->cellAttributes() ?>>
<span id="el<?php echo $market_property_list->RowCount ?>_market_property_ItemRef">
<span<?php echo $market_property_list->ItemRef->viewAttributes() ?>><?php echo $market_property_list->ItemRef->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($market_property_list->ItemLength->Visible) { // ItemLength ?>
		<td data-name="ItemLength" <?php echo $market_property_list->ItemLength->cellAttributes() ?>>
<span id="el<?php echo $market_property_list->RowCount ?>_market_property_ItemLength">
<span<?php echo $market_property_list->ItemLength->viewAttributes() ?>><?php echo $market_property_list->ItemLength->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($market_property_list->ItemWidth->Visible) { // ItemWidth ?>
		<td data-name="ItemWidth" <?php echo $market_property_list->ItemWidth->cellAttributes() ?>>
<span id="el<?php echo $market_property_list->RowCount ?>_market_property_ItemWidth">
<span<?php echo $market_property_list->ItemWidth->viewAttributes() ?>><?php echo $market_property_list->ItemWidth->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($market_property_list->DefaultFees->Visible) { // DefaultFees ?>
		<td data-name="DefaultFees" <?php echo $market_property_list->DefaultFees->cellAttributes() ?>>
<span id="el<?php echo $market_property_list->RowCount ?>_market_property_DefaultFees">
<span<?php echo $market_property_list->DefaultFees->viewAttributes() ?>><?php echo $market_property_list->DefaultFees->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($market_property_list->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td data-name="LastUpdatedBy" <?php echo $market_property_list->LastUpdatedBy->cellAttributes() ?>>
<span id="el<?php echo $market_property_list->RowCount ?>_market_property_LastUpdatedBy">
<span<?php echo $market_property_list->LastUpdatedBy->viewAttributes() ?>><?php echo $market_property_list->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($market_property_list->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td data-name="LastUpdateDate" <?php echo $market_property_list->LastUpdateDate->cellAttributes() ?>>
<span id="el<?php echo $market_property_list->RowCount ?>_market_property_LastUpdateDate">
<span<?php echo $market_property_list->LastUpdateDate->viewAttributes() ?>><?php echo $market_property_list->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$market_property_list->ListOptions->render("body", "right", $market_property_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$market_property_list->isGridAdd())
		$market_property_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$market_property->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($market_property_list->Recordset)
	$market_property_list->Recordset->Close();
?>
<?php if (!$market_property_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$market_property_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $market_property_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $market_property_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($market_property_list->TotalRecords == 0 && !$market_property->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $market_property_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$market_property_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$market_property_list->isExport()) { ?>
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
$market_property_list->terminate();
?>