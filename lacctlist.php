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
$lacct_list = new lacct_list();

// Run the page
$lacct_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$lacct_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$lacct_list->isExport()) { ?>
<script>
var flacctlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	flacctlist = currentForm = new ew.Form("flacctlist", "list");
	flacctlist.formKeyCountName = '<?php echo $lacct_list->FormKeyCountName ?>';
	loadjs.done("flacctlist");
});
var flacctlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	flacctlistsrch = currentSearchForm = new ew.Form("flacctlistsrch");

	// Dynamic selection lists
	// Filters

	flacctlistsrch.filterList = <?php echo $lacct_list->getFilterList() ?>;

	// Init search panel as collapsed
	flacctlistsrch.initSearchPanel = true;
	loadjs.done("flacctlistsrch");
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
<?php if (!$lacct_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($lacct_list->TotalRecords > 0 && $lacct_list->ExportOptions->visible()) { ?>
<?php $lacct_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($lacct_list->ImportOptions->visible()) { ?>
<?php $lacct_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($lacct_list->SearchOptions->visible()) { ?>
<?php $lacct_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($lacct_list->FilterOptions->visible()) { ?>
<?php $lacct_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$lacct_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$lacct_list->isExport() && !$lacct->CurrentAction) { ?>
<form name="flacctlistsrch" id="flacctlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="flacctlistsrch-search-panel" class="<?php echo $lacct_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="lacct">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $lacct_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($lacct_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($lacct_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $lacct_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($lacct_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($lacct_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($lacct_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($lacct_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $lacct_list->showPageHeader(); ?>
<?php
$lacct_list->showMessage();
?>
<?php if ($lacct_list->TotalRecords > 0 || $lacct->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($lacct_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> lacct">
<?php if (!$lacct_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$lacct_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $lacct_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $lacct_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="flacctlist" id="flacctlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="lacct">
<div id="gmp_lacct" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($lacct_list->TotalRecords > 0 || $lacct_list->isGridEdit()) { ?>
<table id="tbl_lacctlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$lacct->RowType = ROWTYPE_HEADER;

// Render list options
$lacct_list->renderListOptions();

// Render list options (header, left)
$lacct_list->ListOptions->render("header", "left");
?>
<?php if ($lacct_list->LACode->Visible) { // LACode ?>
	<?php if ($lacct_list->SortUrl($lacct_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $lacct_list->LACode->headerCellClass() ?>"><div id="elh_lacct_LACode" class="lacct_LACode"><div class="ew-table-header-caption"><?php echo $lacct_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $lacct_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lacct_list->SortUrl($lacct_list->LACode) ?>', 1);"><div id="elh_lacct_LACode" class="lacct_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lacct_list->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($lacct_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lacct_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lacct_list->Code->Visible) { // Code ?>
	<?php if ($lacct_list->SortUrl($lacct_list->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $lacct_list->Code->headerCellClass() ?>"><div id="elh_lacct_Code" class="lacct_Code"><div class="ew-table-header-caption"><?php echo $lacct_list->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $lacct_list->Code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lacct_list->SortUrl($lacct_list->Code) ?>', 1);"><div id="elh_lacct_Code" class="lacct_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lacct_list->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($lacct_list->Code->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lacct_list->Code->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lacct_list->Details->Visible) { // Details ?>
	<?php if ($lacct_list->SortUrl($lacct_list->Details) == "") { ?>
		<th data-name="Details" class="<?php echo $lacct_list->Details->headerCellClass() ?>"><div id="elh_lacct_Details" class="lacct_Details"><div class="ew-table-header-caption"><?php echo $lacct_list->Details->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Details" class="<?php echo $lacct_list->Details->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lacct_list->SortUrl($lacct_list->Details) ?>', 1);"><div id="elh_lacct_Details" class="lacct_Details">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lacct_list->Details->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($lacct_list->Details->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lacct_list->Details->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lacct_list->Approved_Budget->Visible) { // Approved Budget ?>
	<?php if ($lacct_list->SortUrl($lacct_list->Approved_Budget) == "") { ?>
		<th data-name="Approved_Budget" class="<?php echo $lacct_list->Approved_Budget->headerCellClass() ?>"><div id="elh_lacct_Approved_Budget" class="lacct_Approved_Budget"><div class="ew-table-header-caption"><?php echo $lacct_list->Approved_Budget->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Approved_Budget" class="<?php echo $lacct_list->Approved_Budget->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lacct_list->SortUrl($lacct_list->Approved_Budget) ?>', 1);"><div id="elh_lacct_Approved_Budget" class="lacct_Approved_Budget">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lacct_list->Approved_Budget->caption() ?></span><span class="ew-table-header-sort"><?php if ($lacct_list->Approved_Budget->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lacct_list->Approved_Budget->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lacct_list->Budget->Visible) { // Budget ?>
	<?php if ($lacct_list->SortUrl($lacct_list->Budget) == "") { ?>
		<th data-name="Budget" class="<?php echo $lacct_list->Budget->headerCellClass() ?>"><div id="elh_lacct_Budget" class="lacct_Budget"><div class="ew-table-header-caption"><?php echo $lacct_list->Budget->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Budget" class="<?php echo $lacct_list->Budget->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lacct_list->SortUrl($lacct_list->Budget) ?>', 1);"><div id="elh_lacct_Budget" class="lacct_Budget">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lacct_list->Budget->caption() ?></span><span class="ew-table-header-sort"><?php if ($lacct_list->Budget->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lacct_list->Budget->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lacct_list->Q1->Visible) { // Q1 ?>
	<?php if ($lacct_list->SortUrl($lacct_list->Q1) == "") { ?>
		<th data-name="Q1" class="<?php echo $lacct_list->Q1->headerCellClass() ?>"><div id="elh_lacct_Q1" class="lacct_Q1"><div class="ew-table-header-caption"><?php echo $lacct_list->Q1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Q1" class="<?php echo $lacct_list->Q1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lacct_list->SortUrl($lacct_list->Q1) ?>', 1);"><div id="elh_lacct_Q1" class="lacct_Q1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lacct_list->Q1->caption() ?></span><span class="ew-table-header-sort"><?php if ($lacct_list->Q1->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lacct_list->Q1->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lacct_list->Q2->Visible) { // Q2 ?>
	<?php if ($lacct_list->SortUrl($lacct_list->Q2) == "") { ?>
		<th data-name="Q2" class="<?php echo $lacct_list->Q2->headerCellClass() ?>"><div id="elh_lacct_Q2" class="lacct_Q2"><div class="ew-table-header-caption"><?php echo $lacct_list->Q2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Q2" class="<?php echo $lacct_list->Q2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lacct_list->SortUrl($lacct_list->Q2) ?>', 1);"><div id="elh_lacct_Q2" class="lacct_Q2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lacct_list->Q2->caption() ?></span><span class="ew-table-header-sort"><?php if ($lacct_list->Q2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lacct_list->Q2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lacct_list->Q3->Visible) { // Q3 ?>
	<?php if ($lacct_list->SortUrl($lacct_list->Q3) == "") { ?>
		<th data-name="Q3" class="<?php echo $lacct_list->Q3->headerCellClass() ?>"><div id="elh_lacct_Q3" class="lacct_Q3"><div class="ew-table-header-caption"><?php echo $lacct_list->Q3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Q3" class="<?php echo $lacct_list->Q3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lacct_list->SortUrl($lacct_list->Q3) ?>', 1);"><div id="elh_lacct_Q3" class="lacct_Q3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lacct_list->Q3->caption() ?></span><span class="ew-table-header-sort"><?php if ($lacct_list->Q3->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lacct_list->Q3->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lacct_list->Q4->Visible) { // Q4 ?>
	<?php if ($lacct_list->SortUrl($lacct_list->Q4) == "") { ?>
		<th data-name="Q4" class="<?php echo $lacct_list->Q4->headerCellClass() ?>"><div id="elh_lacct_Q4" class="lacct_Q4"><div class="ew-table-header-caption"><?php echo $lacct_list->Q4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Q4" class="<?php echo $lacct_list->Q4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lacct_list->SortUrl($lacct_list->Q4) ?>', 1);"><div id="elh_lacct_Q4" class="lacct_Q4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lacct_list->Q4->caption() ?></span><span class="ew-table-header-sort"><?php if ($lacct_list->Q4->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lacct_list->Q4->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lacct_list->Q1_Q4->Visible) { // Q1-Q4 ?>
	<?php if ($lacct_list->SortUrl($lacct_list->Q1_Q4) == "") { ?>
		<th data-name="Q1_Q4" class="<?php echo $lacct_list->Q1_Q4->headerCellClass() ?>"><div id="elh_lacct_Q1_Q4" class="lacct_Q1_Q4"><div class="ew-table-header-caption"><?php echo $lacct_list->Q1_Q4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Q1_Q4" class="<?php echo $lacct_list->Q1_Q4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lacct_list->SortUrl($lacct_list->Q1_Q4) ?>', 1);"><div id="elh_lacct_Q1_Q4" class="lacct_Q1_Q4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lacct_list->Q1_Q4->caption() ?></span><span class="ew-table-header-sort"><?php if ($lacct_list->Q1_Q4->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lacct_list->Q1_Q4->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lacct_list->Percent->Visible) { // Percent ?>
	<?php if ($lacct_list->SortUrl($lacct_list->Percent) == "") { ?>
		<th data-name="Percent" class="<?php echo $lacct_list->Percent->headerCellClass() ?>"><div id="elh_lacct_Percent" class="lacct_Percent"><div class="ew-table-header-caption"><?php echo $lacct_list->Percent->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Percent" class="<?php echo $lacct_list->Percent->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lacct_list->SortUrl($lacct_list->Percent) ?>', 1);"><div id="elh_lacct_Percent" class="lacct_Percent">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lacct_list->Percent->caption() ?></span><span class="ew-table-header-sort"><?php if ($lacct_list->Percent->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lacct_list->Percent->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lacct_list->Balance->Visible) { // Balance ?>
	<?php if ($lacct_list->SortUrl($lacct_list->Balance) == "") { ?>
		<th data-name="Balance" class="<?php echo $lacct_list->Balance->headerCellClass() ?>"><div id="elh_lacct_Balance" class="lacct_Balance"><div class="ew-table-header-caption"><?php echo $lacct_list->Balance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Balance" class="<?php echo $lacct_list->Balance->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lacct_list->SortUrl($lacct_list->Balance) ?>', 1);"><div id="elh_lacct_Balance" class="lacct_Balance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lacct_list->Balance->caption() ?></span><span class="ew-table-header-sort"><?php if ($lacct_list->Balance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lacct_list->Balance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$lacct_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($lacct_list->ExportAll && $lacct_list->isExport()) {
	$lacct_list->StopRecord = $lacct_list->TotalRecords;
} else {

	// Set the last record to display
	if ($lacct_list->TotalRecords > $lacct_list->StartRecord + $lacct_list->DisplayRecords - 1)
		$lacct_list->StopRecord = $lacct_list->StartRecord + $lacct_list->DisplayRecords - 1;
	else
		$lacct_list->StopRecord = $lacct_list->TotalRecords;
}
$lacct_list->RecordCount = $lacct_list->StartRecord - 1;
if ($lacct_list->Recordset && !$lacct_list->Recordset->EOF) {
	$lacct_list->Recordset->moveFirst();
	$selectLimit = $lacct_list->UseSelectLimit;
	if (!$selectLimit && $lacct_list->StartRecord > 1)
		$lacct_list->Recordset->move($lacct_list->StartRecord - 1);
} elseif (!$lacct->AllowAddDeleteRow && $lacct_list->StopRecord == 0) {
	$lacct_list->StopRecord = $lacct->GridAddRowCount;
}

// Initialize aggregate
$lacct->RowType = ROWTYPE_AGGREGATEINIT;
$lacct->resetAttributes();
$lacct_list->renderRow();
while ($lacct_list->RecordCount < $lacct_list->StopRecord) {
	$lacct_list->RecordCount++;
	if ($lacct_list->RecordCount >= $lacct_list->StartRecord) {
		$lacct_list->RowCount++;

		// Set up key count
		$lacct_list->KeyCount = $lacct_list->RowIndex;

		// Init row class and style
		$lacct->resetAttributes();
		$lacct->CssClass = "";
		if ($lacct_list->isGridAdd()) {
		} else {
			$lacct_list->loadRowValues($lacct_list->Recordset); // Load row values
		}
		$lacct->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$lacct->RowAttrs->merge(["data-rowindex" => $lacct_list->RowCount, "id" => "r" . $lacct_list->RowCount . "_lacct", "data-rowtype" => $lacct->RowType]);

		// Render row
		$lacct_list->renderRow();

		// Render list options
		$lacct_list->renderListOptions();
?>
	<tr <?php echo $lacct->rowAttributes() ?>>
<?php

// Render list options (body, left)
$lacct_list->ListOptions->render("body", "left", $lacct_list->RowCount);
?>
	<?php if ($lacct_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $lacct_list->LACode->cellAttributes() ?>>
<span id="el<?php echo $lacct_list->RowCount ?>_lacct_LACode">
<span<?php echo $lacct_list->LACode->viewAttributes() ?>><?php echo $lacct_list->LACode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lacct_list->Code->Visible) { // Code ?>
		<td data-name="Code" <?php echo $lacct_list->Code->cellAttributes() ?>>
<span id="el<?php echo $lacct_list->RowCount ?>_lacct_Code">
<span<?php echo $lacct_list->Code->viewAttributes() ?>><?php echo $lacct_list->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lacct_list->Details->Visible) { // Details ?>
		<td data-name="Details" <?php echo $lacct_list->Details->cellAttributes() ?>>
<span id="el<?php echo $lacct_list->RowCount ?>_lacct_Details">
<span<?php echo $lacct_list->Details->viewAttributes() ?>><?php echo $lacct_list->Details->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lacct_list->Approved_Budget->Visible) { // Approved Budget ?>
		<td data-name="Approved_Budget" <?php echo $lacct_list->Approved_Budget->cellAttributes() ?>>
<span id="el<?php echo $lacct_list->RowCount ?>_lacct_Approved_Budget">
<span<?php echo $lacct_list->Approved_Budget->viewAttributes() ?>><?php echo $lacct_list->Approved_Budget->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lacct_list->Budget->Visible) { // Budget ?>
		<td data-name="Budget" <?php echo $lacct_list->Budget->cellAttributes() ?>>
<span id="el<?php echo $lacct_list->RowCount ?>_lacct_Budget">
<span<?php echo $lacct_list->Budget->viewAttributes() ?>><?php echo $lacct_list->Budget->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lacct_list->Q1->Visible) { // Q1 ?>
		<td data-name="Q1" <?php echo $lacct_list->Q1->cellAttributes() ?>>
<span id="el<?php echo $lacct_list->RowCount ?>_lacct_Q1">
<span<?php echo $lacct_list->Q1->viewAttributes() ?>><?php echo $lacct_list->Q1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lacct_list->Q2->Visible) { // Q2 ?>
		<td data-name="Q2" <?php echo $lacct_list->Q2->cellAttributes() ?>>
<span id="el<?php echo $lacct_list->RowCount ?>_lacct_Q2">
<span<?php echo $lacct_list->Q2->viewAttributes() ?>><?php echo $lacct_list->Q2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lacct_list->Q3->Visible) { // Q3 ?>
		<td data-name="Q3" <?php echo $lacct_list->Q3->cellAttributes() ?>>
<span id="el<?php echo $lacct_list->RowCount ?>_lacct_Q3">
<span<?php echo $lacct_list->Q3->viewAttributes() ?>><?php echo $lacct_list->Q3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lacct_list->Q4->Visible) { // Q4 ?>
		<td data-name="Q4" <?php echo $lacct_list->Q4->cellAttributes() ?>>
<span id="el<?php echo $lacct_list->RowCount ?>_lacct_Q4">
<span<?php echo $lacct_list->Q4->viewAttributes() ?>><?php echo $lacct_list->Q4->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lacct_list->Q1_Q4->Visible) { // Q1-Q4 ?>
		<td data-name="Q1_Q4" <?php echo $lacct_list->Q1_Q4->cellAttributes() ?>>
<span id="el<?php echo $lacct_list->RowCount ?>_lacct_Q1_Q4">
<span<?php echo $lacct_list->Q1_Q4->viewAttributes() ?>><?php echo $lacct_list->Q1_Q4->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lacct_list->Percent->Visible) { // Percent ?>
		<td data-name="Percent" <?php echo $lacct_list->Percent->cellAttributes() ?>>
<span id="el<?php echo $lacct_list->RowCount ?>_lacct_Percent">
<span<?php echo $lacct_list->Percent->viewAttributes() ?>><?php echo $lacct_list->Percent->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lacct_list->Balance->Visible) { // Balance ?>
		<td data-name="Balance" <?php echo $lacct_list->Balance->cellAttributes() ?>>
<span id="el<?php echo $lacct_list->RowCount ?>_lacct_Balance">
<span<?php echo $lacct_list->Balance->viewAttributes() ?>><?php echo $lacct_list->Balance->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$lacct_list->ListOptions->render("body", "right", $lacct_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$lacct_list->isGridAdd())
		$lacct_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$lacct->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($lacct_list->Recordset)
	$lacct_list->Recordset->Close();
?>
<?php if (!$lacct_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$lacct_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $lacct_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $lacct_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($lacct_list->TotalRecords == 0 && !$lacct->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $lacct_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$lacct_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$lacct_list->isExport()) { ?>
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
$lacct_list->terminate();
?>