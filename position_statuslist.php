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
$position_status_list = new position_status_list();

// Run the page
$position_status_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$position_status_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$position_status_list->isExport()) { ?>
<script>
var fposition_statuslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fposition_statuslist = currentForm = new ew.Form("fposition_statuslist", "list");
	fposition_statuslist.formKeyCountName = '<?php echo $position_status_list->FormKeyCountName ?>';
	loadjs.done("fposition_statuslist");
});
var fposition_statuslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fposition_statuslistsrch = currentSearchForm = new ew.Form("fposition_statuslistsrch");

	// Dynamic selection lists
	// Filters

	fposition_statuslistsrch.filterList = <?php echo $position_status_list->getFilterList() ?>;

	// Init search panel as collapsed
	fposition_statuslistsrch.initSearchPanel = true;
	loadjs.done("fposition_statuslistsrch");
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
<?php if (!$position_status_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($position_status_list->TotalRecords > 0 && $position_status_list->ExportOptions->visible()) { ?>
<?php $position_status_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($position_status_list->ImportOptions->visible()) { ?>
<?php $position_status_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($position_status_list->SearchOptions->visible()) { ?>
<?php $position_status_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($position_status_list->FilterOptions->visible()) { ?>
<?php $position_status_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$position_status_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$position_status_list->isExport() && !$position_status->CurrentAction) { ?>
<form name="fposition_statuslistsrch" id="fposition_statuslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fposition_statuslistsrch-search-panel" class="<?php echo $position_status_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="position_status">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $position_status_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($position_status_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($position_status_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $position_status_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($position_status_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($position_status_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($position_status_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($position_status_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $position_status_list->showPageHeader(); ?>
<?php
$position_status_list->showMessage();
?>
<?php if ($position_status_list->TotalRecords > 0 || $position_status->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($position_status_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> position_status">
<?php if (!$position_status_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$position_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $position_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $position_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fposition_statuslist" id="fposition_statuslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="position_status">
<div id="gmp_position_status" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($position_status_list->TotalRecords > 0 || $position_status_list->isGridEdit()) { ?>
<table id="tbl_position_statuslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$position_status->RowType = ROWTYPE_HEADER;

// Render list options
$position_status_list->renderListOptions();

// Render list options (header, left)
$position_status_list->ListOptions->render("header", "left");
?>
<?php if ($position_status_list->PositionStatus->Visible) { // PositionStatus ?>
	<?php if ($position_status_list->SortUrl($position_status_list->PositionStatus) == "") { ?>
		<th data-name="PositionStatus" class="<?php echo $position_status_list->PositionStatus->headerCellClass() ?>"><div id="elh_position_status_PositionStatus" class="position_status_PositionStatus"><div class="ew-table-header-caption"><?php echo $position_status_list->PositionStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionStatus" class="<?php echo $position_status_list->PositionStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $position_status_list->SortUrl($position_status_list->PositionStatus) ?>', 1);"><div id="elh_position_status_PositionStatus" class="position_status_PositionStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_status_list->PositionStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_status_list->PositionStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_status_list->PositionStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_status_list->PositionStatusDesc->Visible) { // PositionStatusDesc ?>
	<?php if ($position_status_list->SortUrl($position_status_list->PositionStatusDesc) == "") { ?>
		<th data-name="PositionStatusDesc" class="<?php echo $position_status_list->PositionStatusDesc->headerCellClass() ?>"><div id="elh_position_status_PositionStatusDesc" class="position_status_PositionStatusDesc"><div class="ew-table-header-caption"><?php echo $position_status_list->PositionStatusDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionStatusDesc" class="<?php echo $position_status_list->PositionStatusDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $position_status_list->SortUrl($position_status_list->PositionStatusDesc) ?>', 1);"><div id="elh_position_status_PositionStatusDesc" class="position_status_PositionStatusDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_status_list->PositionStatusDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($position_status_list->PositionStatusDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_status_list->PositionStatusDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$position_status_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($position_status_list->ExportAll && $position_status_list->isExport()) {
	$position_status_list->StopRecord = $position_status_list->TotalRecords;
} else {

	// Set the last record to display
	if ($position_status_list->TotalRecords > $position_status_list->StartRecord + $position_status_list->DisplayRecords - 1)
		$position_status_list->StopRecord = $position_status_list->StartRecord + $position_status_list->DisplayRecords - 1;
	else
		$position_status_list->StopRecord = $position_status_list->TotalRecords;
}
$position_status_list->RecordCount = $position_status_list->StartRecord - 1;
if ($position_status_list->Recordset && !$position_status_list->Recordset->EOF) {
	$position_status_list->Recordset->moveFirst();
	$selectLimit = $position_status_list->UseSelectLimit;
	if (!$selectLimit && $position_status_list->StartRecord > 1)
		$position_status_list->Recordset->move($position_status_list->StartRecord - 1);
} elseif (!$position_status->AllowAddDeleteRow && $position_status_list->StopRecord == 0) {
	$position_status_list->StopRecord = $position_status->GridAddRowCount;
}

// Initialize aggregate
$position_status->RowType = ROWTYPE_AGGREGATEINIT;
$position_status->resetAttributes();
$position_status_list->renderRow();
while ($position_status_list->RecordCount < $position_status_list->StopRecord) {
	$position_status_list->RecordCount++;
	if ($position_status_list->RecordCount >= $position_status_list->StartRecord) {
		$position_status_list->RowCount++;

		// Set up key count
		$position_status_list->KeyCount = $position_status_list->RowIndex;

		// Init row class and style
		$position_status->resetAttributes();
		$position_status->CssClass = "";
		if ($position_status_list->isGridAdd()) {
		} else {
			$position_status_list->loadRowValues($position_status_list->Recordset); // Load row values
		}
		$position_status->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$position_status->RowAttrs->merge(["data-rowindex" => $position_status_list->RowCount, "id" => "r" . $position_status_list->RowCount . "_position_status", "data-rowtype" => $position_status->RowType]);

		// Render row
		$position_status_list->renderRow();

		// Render list options
		$position_status_list->renderListOptions();
?>
	<tr <?php echo $position_status->rowAttributes() ?>>
<?php

// Render list options (body, left)
$position_status_list->ListOptions->render("body", "left", $position_status_list->RowCount);
?>
	<?php if ($position_status_list->PositionStatus->Visible) { // PositionStatus ?>
		<td data-name="PositionStatus" <?php echo $position_status_list->PositionStatus->cellAttributes() ?>>
<span id="el<?php echo $position_status_list->RowCount ?>_position_status_PositionStatus">
<span<?php echo $position_status_list->PositionStatus->viewAttributes() ?>><?php echo $position_status_list->PositionStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($position_status_list->PositionStatusDesc->Visible) { // PositionStatusDesc ?>
		<td data-name="PositionStatusDesc" <?php echo $position_status_list->PositionStatusDesc->cellAttributes() ?>>
<span id="el<?php echo $position_status_list->RowCount ?>_position_status_PositionStatusDesc">
<span<?php echo $position_status_list->PositionStatusDesc->viewAttributes() ?>><?php echo $position_status_list->PositionStatusDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$position_status_list->ListOptions->render("body", "right", $position_status_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$position_status_list->isGridAdd())
		$position_status_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$position_status->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($position_status_list->Recordset)
	$position_status_list->Recordset->Close();
?>
<?php if (!$position_status_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$position_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $position_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $position_status_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($position_status_list->TotalRecords == 0 && !$position_status->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $position_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$position_status_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$position_status_list->isExport()) { ?>
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
$position_status_list->terminate();
?>