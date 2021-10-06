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
$month_ref_list = new month_ref_list();

// Run the page
$month_ref_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$month_ref_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$month_ref_list->isExport()) { ?>
<script>
var fmonth_reflist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmonth_reflist = currentForm = new ew.Form("fmonth_reflist", "list");
	fmonth_reflist.formKeyCountName = '<?php echo $month_ref_list->FormKeyCountName ?>';
	loadjs.done("fmonth_reflist");
});
var fmonth_reflistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmonth_reflistsrch = currentSearchForm = new ew.Form("fmonth_reflistsrch");

	// Dynamic selection lists
	// Filters

	fmonth_reflistsrch.filterList = <?php echo $month_ref_list->getFilterList() ?>;

	// Init search panel as collapsed
	fmonth_reflistsrch.initSearchPanel = true;
	loadjs.done("fmonth_reflistsrch");
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
<?php if (!$month_ref_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($month_ref_list->TotalRecords > 0 && $month_ref_list->ExportOptions->visible()) { ?>
<?php $month_ref_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($month_ref_list->ImportOptions->visible()) { ?>
<?php $month_ref_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($month_ref_list->SearchOptions->visible()) { ?>
<?php $month_ref_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($month_ref_list->FilterOptions->visible()) { ?>
<?php $month_ref_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$month_ref_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$month_ref_list->isExport() && !$month_ref->CurrentAction) { ?>
<form name="fmonth_reflistsrch" id="fmonth_reflistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmonth_reflistsrch-search-panel" class="<?php echo $month_ref_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="month_ref">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $month_ref_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($month_ref_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($month_ref_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $month_ref_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($month_ref_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($month_ref_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($month_ref_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($month_ref_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $month_ref_list->showPageHeader(); ?>
<?php
$month_ref_list->showMessage();
?>
<?php if ($month_ref_list->TotalRecords > 0 || $month_ref->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($month_ref_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> month_ref">
<?php if (!$month_ref_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$month_ref_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $month_ref_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $month_ref_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmonth_reflist" id="fmonth_reflist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="month_ref">
<div id="gmp_month_ref" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($month_ref_list->TotalRecords > 0 || $month_ref_list->isGridEdit()) { ?>
<table id="tbl_month_reflist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$month_ref->RowType = ROWTYPE_HEADER;

// Render list options
$month_ref_list->renderListOptions();

// Render list options (header, left)
$month_ref_list->ListOptions->render("header", "left");
?>
<?php if ($month_ref_list->MonthCode->Visible) { // MonthCode ?>
	<?php if ($month_ref_list->SortUrl($month_ref_list->MonthCode) == "") { ?>
		<th data-name="MonthCode" class="<?php echo $month_ref_list->MonthCode->headerCellClass() ?>"><div id="elh_month_ref_MonthCode" class="month_ref_MonthCode"><div class="ew-table-header-caption"><?php echo $month_ref_list->MonthCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MonthCode" class="<?php echo $month_ref_list->MonthCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $month_ref_list->SortUrl($month_ref_list->MonthCode) ?>', 1);"><div id="elh_month_ref_MonthCode" class="month_ref_MonthCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $month_ref_list->MonthCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($month_ref_list->MonthCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($month_ref_list->MonthCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($month_ref_list->MonthName->Visible) { // MonthName ?>
	<?php if ($month_ref_list->SortUrl($month_ref_list->MonthName) == "") { ?>
		<th data-name="MonthName" class="<?php echo $month_ref_list->MonthName->headerCellClass() ?>"><div id="elh_month_ref_MonthName" class="month_ref_MonthName"><div class="ew-table-header-caption"><?php echo $month_ref_list->MonthName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MonthName" class="<?php echo $month_ref_list->MonthName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $month_ref_list->SortUrl($month_ref_list->MonthName) ?>', 1);"><div id="elh_month_ref_MonthName" class="month_ref_MonthName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $month_ref_list->MonthName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($month_ref_list->MonthName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($month_ref_list->MonthName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($month_ref_list->MonthShort->Visible) { // MonthShort ?>
	<?php if ($month_ref_list->SortUrl($month_ref_list->MonthShort) == "") { ?>
		<th data-name="MonthShort" class="<?php echo $month_ref_list->MonthShort->headerCellClass() ?>"><div id="elh_month_ref_MonthShort" class="month_ref_MonthShort"><div class="ew-table-header-caption"><?php echo $month_ref_list->MonthShort->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MonthShort" class="<?php echo $month_ref_list->MonthShort->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $month_ref_list->SortUrl($month_ref_list->MonthShort) ?>', 1);"><div id="elh_month_ref_MonthShort" class="month_ref_MonthShort">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $month_ref_list->MonthShort->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($month_ref_list->MonthShort->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($month_ref_list->MonthShort->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$month_ref_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($month_ref_list->ExportAll && $month_ref_list->isExport()) {
	$month_ref_list->StopRecord = $month_ref_list->TotalRecords;
} else {

	// Set the last record to display
	if ($month_ref_list->TotalRecords > $month_ref_list->StartRecord + $month_ref_list->DisplayRecords - 1)
		$month_ref_list->StopRecord = $month_ref_list->StartRecord + $month_ref_list->DisplayRecords - 1;
	else
		$month_ref_list->StopRecord = $month_ref_list->TotalRecords;
}
$month_ref_list->RecordCount = $month_ref_list->StartRecord - 1;
if ($month_ref_list->Recordset && !$month_ref_list->Recordset->EOF) {
	$month_ref_list->Recordset->moveFirst();
	$selectLimit = $month_ref_list->UseSelectLimit;
	if (!$selectLimit && $month_ref_list->StartRecord > 1)
		$month_ref_list->Recordset->move($month_ref_list->StartRecord - 1);
} elseif (!$month_ref->AllowAddDeleteRow && $month_ref_list->StopRecord == 0) {
	$month_ref_list->StopRecord = $month_ref->GridAddRowCount;
}

// Initialize aggregate
$month_ref->RowType = ROWTYPE_AGGREGATEINIT;
$month_ref->resetAttributes();
$month_ref_list->renderRow();
while ($month_ref_list->RecordCount < $month_ref_list->StopRecord) {
	$month_ref_list->RecordCount++;
	if ($month_ref_list->RecordCount >= $month_ref_list->StartRecord) {
		$month_ref_list->RowCount++;

		// Set up key count
		$month_ref_list->KeyCount = $month_ref_list->RowIndex;

		// Init row class and style
		$month_ref->resetAttributes();
		$month_ref->CssClass = "";
		if ($month_ref_list->isGridAdd()) {
		} else {
			$month_ref_list->loadRowValues($month_ref_list->Recordset); // Load row values
		}
		$month_ref->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$month_ref->RowAttrs->merge(["data-rowindex" => $month_ref_list->RowCount, "id" => "r" . $month_ref_list->RowCount . "_month_ref", "data-rowtype" => $month_ref->RowType]);

		// Render row
		$month_ref_list->renderRow();

		// Render list options
		$month_ref_list->renderListOptions();
?>
	<tr <?php echo $month_ref->rowAttributes() ?>>
<?php

// Render list options (body, left)
$month_ref_list->ListOptions->render("body", "left", $month_ref_list->RowCount);
?>
	<?php if ($month_ref_list->MonthCode->Visible) { // MonthCode ?>
		<td data-name="MonthCode" <?php echo $month_ref_list->MonthCode->cellAttributes() ?>>
<span id="el<?php echo $month_ref_list->RowCount ?>_month_ref_MonthCode">
<span<?php echo $month_ref_list->MonthCode->viewAttributes() ?>><?php echo $month_ref_list->MonthCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($month_ref_list->MonthName->Visible) { // MonthName ?>
		<td data-name="MonthName" <?php echo $month_ref_list->MonthName->cellAttributes() ?>>
<span id="el<?php echo $month_ref_list->RowCount ?>_month_ref_MonthName">
<span<?php echo $month_ref_list->MonthName->viewAttributes() ?>><?php echo $month_ref_list->MonthName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($month_ref_list->MonthShort->Visible) { // MonthShort ?>
		<td data-name="MonthShort" <?php echo $month_ref_list->MonthShort->cellAttributes() ?>>
<span id="el<?php echo $month_ref_list->RowCount ?>_month_ref_MonthShort">
<span<?php echo $month_ref_list->MonthShort->viewAttributes() ?>><?php echo $month_ref_list->MonthShort->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$month_ref_list->ListOptions->render("body", "right", $month_ref_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$month_ref_list->isGridAdd())
		$month_ref_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$month_ref->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($month_ref_list->Recordset)
	$month_ref_list->Recordset->Close();
?>
<?php if (!$month_ref_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$month_ref_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $month_ref_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $month_ref_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($month_ref_list->TotalRecords == 0 && !$month_ref->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $month_ref_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$month_ref_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$month_ref_list->isExport()) { ?>
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
$month_ref_list->terminate();
?>