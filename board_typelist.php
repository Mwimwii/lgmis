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
$board_type_list = new board_type_list();

// Run the page
$board_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$board_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$board_type_list->isExport()) { ?>
<script>
var fboard_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fboard_typelist = currentForm = new ew.Form("fboard_typelist", "list");
	fboard_typelist.formKeyCountName = '<?php echo $board_type_list->FormKeyCountName ?>';
	loadjs.done("fboard_typelist");
});
var fboard_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fboard_typelistsrch = currentSearchForm = new ew.Form("fboard_typelistsrch");

	// Dynamic selection lists
	// Filters

	fboard_typelistsrch.filterList = <?php echo $board_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	fboard_typelistsrch.initSearchPanel = true;
	loadjs.done("fboard_typelistsrch");
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
<?php if (!$board_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($board_type_list->TotalRecords > 0 && $board_type_list->ExportOptions->visible()) { ?>
<?php $board_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($board_type_list->ImportOptions->visible()) { ?>
<?php $board_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($board_type_list->SearchOptions->visible()) { ?>
<?php $board_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($board_type_list->FilterOptions->visible()) { ?>
<?php $board_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$board_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$board_type_list->isExport() && !$board_type->CurrentAction) { ?>
<form name="fboard_typelistsrch" id="fboard_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fboard_typelistsrch-search-panel" class="<?php echo $board_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="board_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $board_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($board_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($board_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $board_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($board_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($board_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($board_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($board_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $board_type_list->showPageHeader(); ?>
<?php
$board_type_list->showMessage();
?>
<?php if ($board_type_list->TotalRecords > 0 || $board_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($board_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> board_type">
<?php if (!$board_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$board_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $board_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $board_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fboard_typelist" id="fboard_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="board_type">
<div id="gmp_board_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($board_type_list->TotalRecords > 0 || $board_type_list->isGridEdit()) { ?>
<table id="tbl_board_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$board_type->RowType = ROWTYPE_HEADER;

// Render list options
$board_type_list->renderListOptions();

// Render list options (header, left)
$board_type_list->ListOptions->render("header", "left");
?>
<?php if ($board_type_list->BoardType->Visible) { // BoardType ?>
	<?php if ($board_type_list->SortUrl($board_type_list->BoardType) == "") { ?>
		<th data-name="BoardType" class="<?php echo $board_type_list->BoardType->headerCellClass() ?>"><div id="elh_board_type_BoardType" class="board_type_BoardType"><div class="ew-table-header-caption"><?php echo $board_type_list->BoardType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BoardType" class="<?php echo $board_type_list->BoardType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $board_type_list->SortUrl($board_type_list->BoardType) ?>', 1);"><div id="elh_board_type_BoardType" class="board_type_BoardType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $board_type_list->BoardType->caption() ?></span><span class="ew-table-header-sort"><?php if ($board_type_list->BoardType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($board_type_list->BoardType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($board_type_list->BoardTypeDesc->Visible) { // BoardTypeDesc ?>
	<?php if ($board_type_list->SortUrl($board_type_list->BoardTypeDesc) == "") { ?>
		<th data-name="BoardTypeDesc" class="<?php echo $board_type_list->BoardTypeDesc->headerCellClass() ?>"><div id="elh_board_type_BoardTypeDesc" class="board_type_BoardTypeDesc"><div class="ew-table-header-caption"><?php echo $board_type_list->BoardTypeDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BoardTypeDesc" class="<?php echo $board_type_list->BoardTypeDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $board_type_list->SortUrl($board_type_list->BoardTypeDesc) ?>', 1);"><div id="elh_board_type_BoardTypeDesc" class="board_type_BoardTypeDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $board_type_list->BoardTypeDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($board_type_list->BoardTypeDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($board_type_list->BoardTypeDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$board_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($board_type_list->ExportAll && $board_type_list->isExport()) {
	$board_type_list->StopRecord = $board_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($board_type_list->TotalRecords > $board_type_list->StartRecord + $board_type_list->DisplayRecords - 1)
		$board_type_list->StopRecord = $board_type_list->StartRecord + $board_type_list->DisplayRecords - 1;
	else
		$board_type_list->StopRecord = $board_type_list->TotalRecords;
}
$board_type_list->RecordCount = $board_type_list->StartRecord - 1;
if ($board_type_list->Recordset && !$board_type_list->Recordset->EOF) {
	$board_type_list->Recordset->moveFirst();
	$selectLimit = $board_type_list->UseSelectLimit;
	if (!$selectLimit && $board_type_list->StartRecord > 1)
		$board_type_list->Recordset->move($board_type_list->StartRecord - 1);
} elseif (!$board_type->AllowAddDeleteRow && $board_type_list->StopRecord == 0) {
	$board_type_list->StopRecord = $board_type->GridAddRowCount;
}

// Initialize aggregate
$board_type->RowType = ROWTYPE_AGGREGATEINIT;
$board_type->resetAttributes();
$board_type_list->renderRow();
while ($board_type_list->RecordCount < $board_type_list->StopRecord) {
	$board_type_list->RecordCount++;
	if ($board_type_list->RecordCount >= $board_type_list->StartRecord) {
		$board_type_list->RowCount++;

		// Set up key count
		$board_type_list->KeyCount = $board_type_list->RowIndex;

		// Init row class and style
		$board_type->resetAttributes();
		$board_type->CssClass = "";
		if ($board_type_list->isGridAdd()) {
		} else {
			$board_type_list->loadRowValues($board_type_list->Recordset); // Load row values
		}
		$board_type->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$board_type->RowAttrs->merge(["data-rowindex" => $board_type_list->RowCount, "id" => "r" . $board_type_list->RowCount . "_board_type", "data-rowtype" => $board_type->RowType]);

		// Render row
		$board_type_list->renderRow();

		// Render list options
		$board_type_list->renderListOptions();
?>
	<tr <?php echo $board_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$board_type_list->ListOptions->render("body", "left", $board_type_list->RowCount);
?>
	<?php if ($board_type_list->BoardType->Visible) { // BoardType ?>
		<td data-name="BoardType" <?php echo $board_type_list->BoardType->cellAttributes() ?>>
<span id="el<?php echo $board_type_list->RowCount ?>_board_type_BoardType">
<span<?php echo $board_type_list->BoardType->viewAttributes() ?>><?php echo $board_type_list->BoardType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($board_type_list->BoardTypeDesc->Visible) { // BoardTypeDesc ?>
		<td data-name="BoardTypeDesc" <?php echo $board_type_list->BoardTypeDesc->cellAttributes() ?>>
<span id="el<?php echo $board_type_list->RowCount ?>_board_type_BoardTypeDesc">
<span<?php echo $board_type_list->BoardTypeDesc->viewAttributes() ?>><?php echo $board_type_list->BoardTypeDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$board_type_list->ListOptions->render("body", "right", $board_type_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$board_type_list->isGridAdd())
		$board_type_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$board_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($board_type_list->Recordset)
	$board_type_list->Recordset->Close();
?>
<?php if (!$board_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$board_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $board_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $board_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($board_type_list->TotalRecords == 0 && !$board_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $board_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$board_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$board_type_list->isExport()) { ?>
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
$board_type_list->terminate();
?>