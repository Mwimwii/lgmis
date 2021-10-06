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
$board_zone_list = new board_zone_list();

// Run the page
$board_zone_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$board_zone_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$board_zone_list->isExport()) { ?>
<script>
var fboard_zonelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fboard_zonelist = currentForm = new ew.Form("fboard_zonelist", "list");
	fboard_zonelist.formKeyCountName = '<?php echo $board_zone_list->FormKeyCountName ?>';
	loadjs.done("fboard_zonelist");
});
var fboard_zonelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fboard_zonelistsrch = currentSearchForm = new ew.Form("fboard_zonelistsrch");

	// Dynamic selection lists
	// Filters

	fboard_zonelistsrch.filterList = <?php echo $board_zone_list->getFilterList() ?>;

	// Init search panel as collapsed
	fboard_zonelistsrch.initSearchPanel = true;
	loadjs.done("fboard_zonelistsrch");
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
<?php if (!$board_zone_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($board_zone_list->TotalRecords > 0 && $board_zone_list->ExportOptions->visible()) { ?>
<?php $board_zone_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($board_zone_list->ImportOptions->visible()) { ?>
<?php $board_zone_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($board_zone_list->SearchOptions->visible()) { ?>
<?php $board_zone_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($board_zone_list->FilterOptions->visible()) { ?>
<?php $board_zone_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$board_zone_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$board_zone_list->isExport() && !$board_zone->CurrentAction) { ?>
<form name="fboard_zonelistsrch" id="fboard_zonelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fboard_zonelistsrch-search-panel" class="<?php echo $board_zone_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="board_zone">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $board_zone_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($board_zone_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($board_zone_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $board_zone_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($board_zone_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($board_zone_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($board_zone_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($board_zone_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $board_zone_list->showPageHeader(); ?>
<?php
$board_zone_list->showMessage();
?>
<?php if ($board_zone_list->TotalRecords > 0 || $board_zone->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($board_zone_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> board_zone">
<?php if (!$board_zone_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$board_zone_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $board_zone_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $board_zone_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fboard_zonelist" id="fboard_zonelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="board_zone">
<div id="gmp_board_zone" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($board_zone_list->TotalRecords > 0 || $board_zone_list->isGridEdit()) { ?>
<table id="tbl_board_zonelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$board_zone->RowType = ROWTYPE_HEADER;

// Render list options
$board_zone_list->renderListOptions();

// Render list options (header, left)
$board_zone_list->ListOptions->render("header", "left");
?>
<?php if ($board_zone_list->BoardZone->Visible) { // BoardZone ?>
	<?php if ($board_zone_list->SortUrl($board_zone_list->BoardZone) == "") { ?>
		<th data-name="BoardZone" class="<?php echo $board_zone_list->BoardZone->headerCellClass() ?>"><div id="elh_board_zone_BoardZone" class="board_zone_BoardZone"><div class="ew-table-header-caption"><?php echo $board_zone_list->BoardZone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BoardZone" class="<?php echo $board_zone_list->BoardZone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $board_zone_list->SortUrl($board_zone_list->BoardZone) ?>', 1);"><div id="elh_board_zone_BoardZone" class="board_zone_BoardZone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $board_zone_list->BoardZone->caption() ?></span><span class="ew-table-header-sort"><?php if ($board_zone_list->BoardZone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($board_zone_list->BoardZone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($board_zone_list->BoardZoneDesc->Visible) { // BoardZoneDesc ?>
	<?php if ($board_zone_list->SortUrl($board_zone_list->BoardZoneDesc) == "") { ?>
		<th data-name="BoardZoneDesc" class="<?php echo $board_zone_list->BoardZoneDesc->headerCellClass() ?>"><div id="elh_board_zone_BoardZoneDesc" class="board_zone_BoardZoneDesc"><div class="ew-table-header-caption"><?php echo $board_zone_list->BoardZoneDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BoardZoneDesc" class="<?php echo $board_zone_list->BoardZoneDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $board_zone_list->SortUrl($board_zone_list->BoardZoneDesc) ?>', 1);"><div id="elh_board_zone_BoardZoneDesc" class="board_zone_BoardZoneDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $board_zone_list->BoardZoneDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($board_zone_list->BoardZoneDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($board_zone_list->BoardZoneDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($board_zone_list->IndividualCharge->Visible) { // IndividualCharge ?>
	<?php if ($board_zone_list->SortUrl($board_zone_list->IndividualCharge) == "") { ?>
		<th data-name="IndividualCharge" class="<?php echo $board_zone_list->IndividualCharge->headerCellClass() ?>"><div id="elh_board_zone_IndividualCharge" class="board_zone_IndividualCharge"><div class="ew-table-header-caption"><?php echo $board_zone_list->IndividualCharge->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IndividualCharge" class="<?php echo $board_zone_list->IndividualCharge->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $board_zone_list->SortUrl($board_zone_list->IndividualCharge) ?>', 1);"><div id="elh_board_zone_IndividualCharge" class="board_zone_IndividualCharge">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $board_zone_list->IndividualCharge->caption() ?></span><span class="ew-table-header-sort"><?php if ($board_zone_list->IndividualCharge->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($board_zone_list->IndividualCharge->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($board_zone_list->AgentCharge->Visible) { // AgentCharge ?>
	<?php if ($board_zone_list->SortUrl($board_zone_list->AgentCharge) == "") { ?>
		<th data-name="AgentCharge" class="<?php echo $board_zone_list->AgentCharge->headerCellClass() ?>"><div id="elh_board_zone_AgentCharge" class="board_zone_AgentCharge"><div class="ew-table-header-caption"><?php echo $board_zone_list->AgentCharge->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AgentCharge" class="<?php echo $board_zone_list->AgentCharge->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $board_zone_list->SortUrl($board_zone_list->AgentCharge) ?>', 1);"><div id="elh_board_zone_AgentCharge" class="board_zone_AgentCharge">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $board_zone_list->AgentCharge->caption() ?></span><span class="ew-table-header-sort"><?php if ($board_zone_list->AgentCharge->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($board_zone_list->AgentCharge->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($board_zone_list->PeriodType->Visible) { // PeriodType ?>
	<?php if ($board_zone_list->SortUrl($board_zone_list->PeriodType) == "") { ?>
		<th data-name="PeriodType" class="<?php echo $board_zone_list->PeriodType->headerCellClass() ?>"><div id="elh_board_zone_PeriodType" class="board_zone_PeriodType"><div class="ew-table-header-caption"><?php echo $board_zone_list->PeriodType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodType" class="<?php echo $board_zone_list->PeriodType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $board_zone_list->SortUrl($board_zone_list->PeriodType) ?>', 1);"><div id="elh_board_zone_PeriodType" class="board_zone_PeriodType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $board_zone_list->PeriodType->caption() ?></span><span class="ew-table-header-sort"><?php if ($board_zone_list->PeriodType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($board_zone_list->PeriodType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($board_zone_list->BoardType->Visible) { // BoardType ?>
	<?php if ($board_zone_list->SortUrl($board_zone_list->BoardType) == "") { ?>
		<th data-name="BoardType" class="<?php echo $board_zone_list->BoardType->headerCellClass() ?>"><div id="elh_board_zone_BoardType" class="board_zone_BoardType"><div class="ew-table-header-caption"><?php echo $board_zone_list->BoardType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BoardType" class="<?php echo $board_zone_list->BoardType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $board_zone_list->SortUrl($board_zone_list->BoardType) ?>', 1);"><div id="elh_board_zone_BoardType" class="board_zone_BoardType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $board_zone_list->BoardType->caption() ?></span><span class="ew-table-header-sort"><?php if ($board_zone_list->BoardType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($board_zone_list->BoardType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$board_zone_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($board_zone_list->ExportAll && $board_zone_list->isExport()) {
	$board_zone_list->StopRecord = $board_zone_list->TotalRecords;
} else {

	// Set the last record to display
	if ($board_zone_list->TotalRecords > $board_zone_list->StartRecord + $board_zone_list->DisplayRecords - 1)
		$board_zone_list->StopRecord = $board_zone_list->StartRecord + $board_zone_list->DisplayRecords - 1;
	else
		$board_zone_list->StopRecord = $board_zone_list->TotalRecords;
}
$board_zone_list->RecordCount = $board_zone_list->StartRecord - 1;
if ($board_zone_list->Recordset && !$board_zone_list->Recordset->EOF) {
	$board_zone_list->Recordset->moveFirst();
	$selectLimit = $board_zone_list->UseSelectLimit;
	if (!$selectLimit && $board_zone_list->StartRecord > 1)
		$board_zone_list->Recordset->move($board_zone_list->StartRecord - 1);
} elseif (!$board_zone->AllowAddDeleteRow && $board_zone_list->StopRecord == 0) {
	$board_zone_list->StopRecord = $board_zone->GridAddRowCount;
}

// Initialize aggregate
$board_zone->RowType = ROWTYPE_AGGREGATEINIT;
$board_zone->resetAttributes();
$board_zone_list->renderRow();
while ($board_zone_list->RecordCount < $board_zone_list->StopRecord) {
	$board_zone_list->RecordCount++;
	if ($board_zone_list->RecordCount >= $board_zone_list->StartRecord) {
		$board_zone_list->RowCount++;

		// Set up key count
		$board_zone_list->KeyCount = $board_zone_list->RowIndex;

		// Init row class and style
		$board_zone->resetAttributes();
		$board_zone->CssClass = "";
		if ($board_zone_list->isGridAdd()) {
		} else {
			$board_zone_list->loadRowValues($board_zone_list->Recordset); // Load row values
		}
		$board_zone->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$board_zone->RowAttrs->merge(["data-rowindex" => $board_zone_list->RowCount, "id" => "r" . $board_zone_list->RowCount . "_board_zone", "data-rowtype" => $board_zone->RowType]);

		// Render row
		$board_zone_list->renderRow();

		// Render list options
		$board_zone_list->renderListOptions();
?>
	<tr <?php echo $board_zone->rowAttributes() ?>>
<?php

// Render list options (body, left)
$board_zone_list->ListOptions->render("body", "left", $board_zone_list->RowCount);
?>
	<?php if ($board_zone_list->BoardZone->Visible) { // BoardZone ?>
		<td data-name="BoardZone" <?php echo $board_zone_list->BoardZone->cellAttributes() ?>>
<span id="el<?php echo $board_zone_list->RowCount ?>_board_zone_BoardZone">
<span<?php echo $board_zone_list->BoardZone->viewAttributes() ?>><?php echo $board_zone_list->BoardZone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($board_zone_list->BoardZoneDesc->Visible) { // BoardZoneDesc ?>
		<td data-name="BoardZoneDesc" <?php echo $board_zone_list->BoardZoneDesc->cellAttributes() ?>>
<span id="el<?php echo $board_zone_list->RowCount ?>_board_zone_BoardZoneDesc">
<span<?php echo $board_zone_list->BoardZoneDesc->viewAttributes() ?>><?php echo $board_zone_list->BoardZoneDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($board_zone_list->IndividualCharge->Visible) { // IndividualCharge ?>
		<td data-name="IndividualCharge" <?php echo $board_zone_list->IndividualCharge->cellAttributes() ?>>
<span id="el<?php echo $board_zone_list->RowCount ?>_board_zone_IndividualCharge">
<span<?php echo $board_zone_list->IndividualCharge->viewAttributes() ?>><?php echo $board_zone_list->IndividualCharge->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($board_zone_list->AgentCharge->Visible) { // AgentCharge ?>
		<td data-name="AgentCharge" <?php echo $board_zone_list->AgentCharge->cellAttributes() ?>>
<span id="el<?php echo $board_zone_list->RowCount ?>_board_zone_AgentCharge">
<span<?php echo $board_zone_list->AgentCharge->viewAttributes() ?>><?php echo $board_zone_list->AgentCharge->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($board_zone_list->PeriodType->Visible) { // PeriodType ?>
		<td data-name="PeriodType" <?php echo $board_zone_list->PeriodType->cellAttributes() ?>>
<span id="el<?php echo $board_zone_list->RowCount ?>_board_zone_PeriodType">
<span<?php echo $board_zone_list->PeriodType->viewAttributes() ?>><?php echo $board_zone_list->PeriodType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($board_zone_list->BoardType->Visible) { // BoardType ?>
		<td data-name="BoardType" <?php echo $board_zone_list->BoardType->cellAttributes() ?>>
<span id="el<?php echo $board_zone_list->RowCount ?>_board_zone_BoardType">
<span<?php echo $board_zone_list->BoardType->viewAttributes() ?>><?php echo $board_zone_list->BoardType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$board_zone_list->ListOptions->render("body", "right", $board_zone_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$board_zone_list->isGridAdd())
		$board_zone_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$board_zone->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($board_zone_list->Recordset)
	$board_zone_list->Recordset->Close();
?>
<?php if (!$board_zone_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$board_zone_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $board_zone_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $board_zone_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($board_zone_list->TotalRecords == 0 && !$board_zone->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $board_zone_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$board_zone_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$board_zone_list->isExport()) { ?>
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
$board_zone_list->terminate();
?>