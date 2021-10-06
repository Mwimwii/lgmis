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
$result_area_list = new result_area_list();

// Run the page
$result_area_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$result_area_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$result_area_list->isExport()) { ?>
<script>
var fresult_arealist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fresult_arealist = currentForm = new ew.Form("fresult_arealist", "list");
	fresult_arealist.formKeyCountName = '<?php echo $result_area_list->FormKeyCountName ?>';
	loadjs.done("fresult_arealist");
});
var fresult_arealistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fresult_arealistsrch = currentSearchForm = new ew.Form("fresult_arealistsrch");

	// Dynamic selection lists
	// Filters

	fresult_arealistsrch.filterList = <?php echo $result_area_list->getFilterList() ?>;

	// Init search panel as collapsed
	fresult_arealistsrch.initSearchPanel = true;
	loadjs.done("fresult_arealistsrch");
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
<?php if (!$result_area_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($result_area_list->TotalRecords > 0 && $result_area_list->ExportOptions->visible()) { ?>
<?php $result_area_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($result_area_list->ImportOptions->visible()) { ?>
<?php $result_area_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($result_area_list->SearchOptions->visible()) { ?>
<?php $result_area_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($result_area_list->FilterOptions->visible()) { ?>
<?php $result_area_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$result_area_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$result_area_list->isExport() && !$result_area->CurrentAction) { ?>
<form name="fresult_arealistsrch" id="fresult_arealistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fresult_arealistsrch-search-panel" class="<?php echo $result_area_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="result_area">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $result_area_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($result_area_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($result_area_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $result_area_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($result_area_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($result_area_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($result_area_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($result_area_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $result_area_list->showPageHeader(); ?>
<?php
$result_area_list->showMessage();
?>
<?php if ($result_area_list->TotalRecords > 0 || $result_area->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($result_area_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> result_area">
<?php if (!$result_area_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$result_area_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $result_area_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $result_area_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fresult_arealist" id="fresult_arealist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="result_area">
<div id="gmp_result_area" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($result_area_list->TotalRecords > 0 || $result_area_list->isGridEdit()) { ?>
<table id="tbl_result_arealist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$result_area->RowType = ROWTYPE_HEADER;

// Render list options
$result_area_list->renderListOptions();

// Render list options (header, left)
$result_area_list->ListOptions->render("header", "left");
?>
<?php if ($result_area_list->ResultAreaCode->Visible) { // ResultAreaCode ?>
	<?php if ($result_area_list->SortUrl($result_area_list->ResultAreaCode) == "") { ?>
		<th data-name="ResultAreaCode" class="<?php echo $result_area_list->ResultAreaCode->headerCellClass() ?>"><div id="elh_result_area_ResultAreaCode" class="result_area_ResultAreaCode"><div class="ew-table-header-caption"><?php echo $result_area_list->ResultAreaCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ResultAreaCode" class="<?php echo $result_area_list->ResultAreaCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $result_area_list->SortUrl($result_area_list->ResultAreaCode) ?>', 1);"><div id="elh_result_area_ResultAreaCode" class="result_area_ResultAreaCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $result_area_list->ResultAreaCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($result_area_list->ResultAreaCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($result_area_list->ResultAreaCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($result_area_list->ResultAreaName->Visible) { // ResultAreaName ?>
	<?php if ($result_area_list->SortUrl($result_area_list->ResultAreaName) == "") { ?>
		<th data-name="ResultAreaName" class="<?php echo $result_area_list->ResultAreaName->headerCellClass() ?>"><div id="elh_result_area_ResultAreaName" class="result_area_ResultAreaName"><div class="ew-table-header-caption"><?php echo $result_area_list->ResultAreaName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ResultAreaName" class="<?php echo $result_area_list->ResultAreaName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $result_area_list->SortUrl($result_area_list->ResultAreaName) ?>', 1);"><div id="elh_result_area_ResultAreaName" class="result_area_ResultAreaName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $result_area_list->ResultAreaName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($result_area_list->ResultAreaName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($result_area_list->ResultAreaName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($result_area_list->ResultAreaStatus->Visible) { // ResultAreaStatus ?>
	<?php if ($result_area_list->SortUrl($result_area_list->ResultAreaStatus) == "") { ?>
		<th data-name="ResultAreaStatus" class="<?php echo $result_area_list->ResultAreaStatus->headerCellClass() ?>"><div id="elh_result_area_ResultAreaStatus" class="result_area_ResultAreaStatus"><div class="ew-table-header-caption"><?php echo $result_area_list->ResultAreaStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ResultAreaStatus" class="<?php echo $result_area_list->ResultAreaStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $result_area_list->SortUrl($result_area_list->ResultAreaStatus) ?>', 1);"><div id="elh_result_area_ResultAreaStatus" class="result_area_ResultAreaStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $result_area_list->ResultAreaStatus->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($result_area_list->ResultAreaStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($result_area_list->ResultAreaStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($result_area_list->ProgressStatus->Visible) { // ProgressStatus ?>
	<?php if ($result_area_list->SortUrl($result_area_list->ProgressStatus) == "") { ?>
		<th data-name="ProgressStatus" class="<?php echo $result_area_list->ProgressStatus->headerCellClass() ?>"><div id="elh_result_area_ProgressStatus" class="result_area_ProgressStatus"><div class="ew-table-header-caption"><?php echo $result_area_list->ProgressStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgressStatus" class="<?php echo $result_area_list->ProgressStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $result_area_list->SortUrl($result_area_list->ProgressStatus) ?>', 1);"><div id="elh_result_area_ProgressStatus" class="result_area_ProgressStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $result_area_list->ProgressStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($result_area_list->ProgressStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($result_area_list->ProgressStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$result_area_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($result_area_list->ExportAll && $result_area_list->isExport()) {
	$result_area_list->StopRecord = $result_area_list->TotalRecords;
} else {

	// Set the last record to display
	if ($result_area_list->TotalRecords > $result_area_list->StartRecord + $result_area_list->DisplayRecords - 1)
		$result_area_list->StopRecord = $result_area_list->StartRecord + $result_area_list->DisplayRecords - 1;
	else
		$result_area_list->StopRecord = $result_area_list->TotalRecords;
}
$result_area_list->RecordCount = $result_area_list->StartRecord - 1;
if ($result_area_list->Recordset && !$result_area_list->Recordset->EOF) {
	$result_area_list->Recordset->moveFirst();
	$selectLimit = $result_area_list->UseSelectLimit;
	if (!$selectLimit && $result_area_list->StartRecord > 1)
		$result_area_list->Recordset->move($result_area_list->StartRecord - 1);
} elseif (!$result_area->AllowAddDeleteRow && $result_area_list->StopRecord == 0) {
	$result_area_list->StopRecord = $result_area->GridAddRowCount;
}

// Initialize aggregate
$result_area->RowType = ROWTYPE_AGGREGATEINIT;
$result_area->resetAttributes();
$result_area_list->renderRow();
while ($result_area_list->RecordCount < $result_area_list->StopRecord) {
	$result_area_list->RecordCount++;
	if ($result_area_list->RecordCount >= $result_area_list->StartRecord) {
		$result_area_list->RowCount++;

		// Set up key count
		$result_area_list->KeyCount = $result_area_list->RowIndex;

		// Init row class and style
		$result_area->resetAttributes();
		$result_area->CssClass = "";
		if ($result_area_list->isGridAdd()) {
		} else {
			$result_area_list->loadRowValues($result_area_list->Recordset); // Load row values
		}
		$result_area->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$result_area->RowAttrs->merge(["data-rowindex" => $result_area_list->RowCount, "id" => "r" . $result_area_list->RowCount . "_result_area", "data-rowtype" => $result_area->RowType]);

		// Render row
		$result_area_list->renderRow();

		// Render list options
		$result_area_list->renderListOptions();
?>
	<tr <?php echo $result_area->rowAttributes() ?>>
<?php

// Render list options (body, left)
$result_area_list->ListOptions->render("body", "left", $result_area_list->RowCount);
?>
	<?php if ($result_area_list->ResultAreaCode->Visible) { // ResultAreaCode ?>
		<td data-name="ResultAreaCode" <?php echo $result_area_list->ResultAreaCode->cellAttributes() ?>>
<span id="el<?php echo $result_area_list->RowCount ?>_result_area_ResultAreaCode">
<span<?php echo $result_area_list->ResultAreaCode->viewAttributes() ?>><?php echo $result_area_list->ResultAreaCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($result_area_list->ResultAreaName->Visible) { // ResultAreaName ?>
		<td data-name="ResultAreaName" <?php echo $result_area_list->ResultAreaName->cellAttributes() ?>>
<span id="el<?php echo $result_area_list->RowCount ?>_result_area_ResultAreaName">
<span<?php echo $result_area_list->ResultAreaName->viewAttributes() ?>><?php echo $result_area_list->ResultAreaName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($result_area_list->ResultAreaStatus->Visible) { // ResultAreaStatus ?>
		<td data-name="ResultAreaStatus" <?php echo $result_area_list->ResultAreaStatus->cellAttributes() ?>>
<span id="el<?php echo $result_area_list->RowCount ?>_result_area_ResultAreaStatus">
<span<?php echo $result_area_list->ResultAreaStatus->viewAttributes() ?>><?php echo $result_area_list->ResultAreaStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($result_area_list->ProgressStatus->Visible) { // ProgressStatus ?>
		<td data-name="ProgressStatus" <?php echo $result_area_list->ProgressStatus->cellAttributes() ?>>
<span id="el<?php echo $result_area_list->RowCount ?>_result_area_ProgressStatus">
<span<?php echo $result_area_list->ProgressStatus->viewAttributes() ?>><?php echo $result_area_list->ProgressStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$result_area_list->ListOptions->render("body", "right", $result_area_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$result_area_list->isGridAdd())
		$result_area_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$result_area->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($result_area_list->Recordset)
	$result_area_list->Recordset->Close();
?>
<?php if (!$result_area_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$result_area_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $result_area_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $result_area_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($result_area_list->TotalRecords == 0 && !$result_area->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $result_area_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$result_area_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$result_area_list->isExport()) { ?>
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
$result_area_list->terminate();
?>