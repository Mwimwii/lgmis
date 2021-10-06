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
$market_list = new market_list();

// Run the page
$market_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$market_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$market_list->isExport()) { ?>
<script>
var fmarketlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmarketlist = currentForm = new ew.Form("fmarketlist", "list");
	fmarketlist.formKeyCountName = '<?php echo $market_list->FormKeyCountName ?>';
	loadjs.done("fmarketlist");
});
var fmarketlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmarketlistsrch = currentSearchForm = new ew.Form("fmarketlistsrch");

	// Dynamic selection lists
	// Filters

	fmarketlistsrch.filterList = <?php echo $market_list->getFilterList() ?>;

	// Init search panel as collapsed
	fmarketlistsrch.initSearchPanel = true;
	loadjs.done("fmarketlistsrch");
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
<?php if (!$market_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($market_list->TotalRecords > 0 && $market_list->ExportOptions->visible()) { ?>
<?php $market_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($market_list->ImportOptions->visible()) { ?>
<?php $market_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($market_list->SearchOptions->visible()) { ?>
<?php $market_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($market_list->FilterOptions->visible()) { ?>
<?php $market_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$market_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$market_list->isExport() && !$market->CurrentAction) { ?>
<form name="fmarketlistsrch" id="fmarketlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmarketlistsrch-search-panel" class="<?php echo $market_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="market">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $market_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($market_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($market_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $market_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($market_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($market_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($market_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($market_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $market_list->showPageHeader(); ?>
<?php
$market_list->showMessage();
?>
<?php if ($market_list->TotalRecords > 0 || $market->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($market_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> market">
<?php if (!$market_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$market_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $market_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $market_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmarketlist" id="fmarketlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="market">
<div id="gmp_market" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($market_list->TotalRecords > 0 || $market_list->isGridEdit()) { ?>
<table id="tbl_marketlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$market->RowType = ROWTYPE_HEADER;

// Render list options
$market_list->renderListOptions();

// Render list options (header, left)
$market_list->ListOptions->render("header", "left");
?>
<?php if ($market_list->MarketNo->Visible) { // MarketNo ?>
	<?php if ($market_list->SortUrl($market_list->MarketNo) == "") { ?>
		<th data-name="MarketNo" class="<?php echo $market_list->MarketNo->headerCellClass() ?>"><div id="elh_market_MarketNo" class="market_MarketNo"><div class="ew-table-header-caption"><?php echo $market_list->MarketNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MarketNo" class="<?php echo $market_list->MarketNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_list->SortUrl($market_list->MarketNo) ?>', 1);"><div id="elh_market_MarketNo" class="market_MarketNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_list->MarketNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_list->MarketNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_list->MarketNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_list->MarketName->Visible) { // MarketName ?>
	<?php if ($market_list->SortUrl($market_list->MarketName) == "") { ?>
		<th data-name="MarketName" class="<?php echo $market_list->MarketName->headerCellClass() ?>"><div id="elh_market_MarketName" class="market_MarketName"><div class="ew-table-header-caption"><?php echo $market_list->MarketName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MarketName" class="<?php echo $market_list->MarketName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_list->SortUrl($market_list->MarketName) ?>', 1);"><div id="elh_market_MarketName" class="market_MarketName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_list->MarketName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($market_list->MarketName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_list->MarketName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_list->MarketDesc->Visible) { // MarketDesc ?>
	<?php if ($market_list->SortUrl($market_list->MarketDesc) == "") { ?>
		<th data-name="MarketDesc" class="<?php echo $market_list->MarketDesc->headerCellClass() ?>"><div id="elh_market_MarketDesc" class="market_MarketDesc"><div class="ew-table-header-caption"><?php echo $market_list->MarketDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MarketDesc" class="<?php echo $market_list->MarketDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_list->SortUrl($market_list->MarketDesc) ?>', 1);"><div id="elh_market_MarketDesc" class="market_MarketDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_list->MarketDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($market_list->MarketDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_list->MarketDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_list->MarketMaster->Visible) { // MarketMaster ?>
	<?php if ($market_list->SortUrl($market_list->MarketMaster) == "") { ?>
		<th data-name="MarketMaster" class="<?php echo $market_list->MarketMaster->headerCellClass() ?>"><div id="elh_market_MarketMaster" class="market_MarketMaster"><div class="ew-table-header-caption"><?php echo $market_list->MarketMaster->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MarketMaster" class="<?php echo $market_list->MarketMaster->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_list->SortUrl($market_list->MarketMaster) ?>', 1);"><div id="elh_market_MarketMaster" class="market_MarketMaster">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_list->MarketMaster->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($market_list->MarketMaster->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_list->MarketMaster->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_list->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($market_list->SortUrl($market_list->LastUpdatedBy) == "") { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $market_list->LastUpdatedBy->headerCellClass() ?>"><div id="elh_market_LastUpdatedBy" class="market_LastUpdatedBy"><div class="ew-table-header-caption"><?php echo $market_list->LastUpdatedBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $market_list->LastUpdatedBy->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_list->SortUrl($market_list->LastUpdatedBy) ?>', 1);"><div id="elh_market_LastUpdatedBy" class="market_LastUpdatedBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_list->LastUpdatedBy->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($market_list->LastUpdatedBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_list->LastUpdatedBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_list->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<?php if ($market_list->SortUrl($market_list->LastUpdateDate) == "") { ?>
		<th data-name="LastUpdateDate" class="<?php echo $market_list->LastUpdateDate->headerCellClass() ?>"><div id="elh_market_LastUpdateDate" class="market_LastUpdateDate"><div class="ew-table-header-caption"><?php echo $market_list->LastUpdateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdateDate" class="<?php echo $market_list->LastUpdateDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_list->SortUrl($market_list->LastUpdateDate) ?>', 1);"><div id="elh_market_LastUpdateDate" class="market_LastUpdateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_list->LastUpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_list->LastUpdateDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_list->LastUpdateDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$market_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($market_list->ExportAll && $market_list->isExport()) {
	$market_list->StopRecord = $market_list->TotalRecords;
} else {

	// Set the last record to display
	if ($market_list->TotalRecords > $market_list->StartRecord + $market_list->DisplayRecords - 1)
		$market_list->StopRecord = $market_list->StartRecord + $market_list->DisplayRecords - 1;
	else
		$market_list->StopRecord = $market_list->TotalRecords;
}
$market_list->RecordCount = $market_list->StartRecord - 1;
if ($market_list->Recordset && !$market_list->Recordset->EOF) {
	$market_list->Recordset->moveFirst();
	$selectLimit = $market_list->UseSelectLimit;
	if (!$selectLimit && $market_list->StartRecord > 1)
		$market_list->Recordset->move($market_list->StartRecord - 1);
} elseif (!$market->AllowAddDeleteRow && $market_list->StopRecord == 0) {
	$market_list->StopRecord = $market->GridAddRowCount;
}

// Initialize aggregate
$market->RowType = ROWTYPE_AGGREGATEINIT;
$market->resetAttributes();
$market_list->renderRow();
while ($market_list->RecordCount < $market_list->StopRecord) {
	$market_list->RecordCount++;
	if ($market_list->RecordCount >= $market_list->StartRecord) {
		$market_list->RowCount++;

		// Set up key count
		$market_list->KeyCount = $market_list->RowIndex;

		// Init row class and style
		$market->resetAttributes();
		$market->CssClass = "";
		if ($market_list->isGridAdd()) {
		} else {
			$market_list->loadRowValues($market_list->Recordset); // Load row values
		}
		$market->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$market->RowAttrs->merge(["data-rowindex" => $market_list->RowCount, "id" => "r" . $market_list->RowCount . "_market", "data-rowtype" => $market->RowType]);

		// Render row
		$market_list->renderRow();

		// Render list options
		$market_list->renderListOptions();
?>
	<tr <?php echo $market->rowAttributes() ?>>
<?php

// Render list options (body, left)
$market_list->ListOptions->render("body", "left", $market_list->RowCount);
?>
	<?php if ($market_list->MarketNo->Visible) { // MarketNo ?>
		<td data-name="MarketNo" <?php echo $market_list->MarketNo->cellAttributes() ?>>
<span id="el<?php echo $market_list->RowCount ?>_market_MarketNo">
<span<?php echo $market_list->MarketNo->viewAttributes() ?>><?php echo $market_list->MarketNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($market_list->MarketName->Visible) { // MarketName ?>
		<td data-name="MarketName" <?php echo $market_list->MarketName->cellAttributes() ?>>
<span id="el<?php echo $market_list->RowCount ?>_market_MarketName">
<span<?php echo $market_list->MarketName->viewAttributes() ?>><?php echo $market_list->MarketName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($market_list->MarketDesc->Visible) { // MarketDesc ?>
		<td data-name="MarketDesc" <?php echo $market_list->MarketDesc->cellAttributes() ?>>
<span id="el<?php echo $market_list->RowCount ?>_market_MarketDesc">
<span<?php echo $market_list->MarketDesc->viewAttributes() ?>><?php echo $market_list->MarketDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($market_list->MarketMaster->Visible) { // MarketMaster ?>
		<td data-name="MarketMaster" <?php echo $market_list->MarketMaster->cellAttributes() ?>>
<span id="el<?php echo $market_list->RowCount ?>_market_MarketMaster">
<span<?php echo $market_list->MarketMaster->viewAttributes() ?>><?php echo $market_list->MarketMaster->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($market_list->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td data-name="LastUpdatedBy" <?php echo $market_list->LastUpdatedBy->cellAttributes() ?>>
<span id="el<?php echo $market_list->RowCount ?>_market_LastUpdatedBy">
<span<?php echo $market_list->LastUpdatedBy->viewAttributes() ?>><?php echo $market_list->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($market_list->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td data-name="LastUpdateDate" <?php echo $market_list->LastUpdateDate->cellAttributes() ?>>
<span id="el<?php echo $market_list->RowCount ?>_market_LastUpdateDate">
<span<?php echo $market_list->LastUpdateDate->viewAttributes() ?>><?php echo $market_list->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$market_list->ListOptions->render("body", "right", $market_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$market_list->isGridAdd())
		$market_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$market->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($market_list->Recordset)
	$market_list->Recordset->Close();
?>
<?php if (!$market_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$market_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $market_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $market_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($market_list->TotalRecords == 0 && !$market->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $market_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$market_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$market_list->isExport()) { ?>
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
$market_list->terminate();
?>