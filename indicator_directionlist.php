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
$indicator_direction_list = new indicator_direction_list();

// Run the page
$indicator_direction_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$indicator_direction_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$indicator_direction_list->isExport()) { ?>
<script>
var findicator_directionlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	findicator_directionlist = currentForm = new ew.Form("findicator_directionlist", "list");
	findicator_directionlist.formKeyCountName = '<?php echo $indicator_direction_list->FormKeyCountName ?>';
	loadjs.done("findicator_directionlist");
});
var findicator_directionlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	findicator_directionlistsrch = currentSearchForm = new ew.Form("findicator_directionlistsrch");

	// Dynamic selection lists
	// Filters

	findicator_directionlistsrch.filterList = <?php echo $indicator_direction_list->getFilterList() ?>;

	// Init search panel as collapsed
	findicator_directionlistsrch.initSearchPanel = true;
	loadjs.done("findicator_directionlistsrch");
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
<?php if (!$indicator_direction_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($indicator_direction_list->TotalRecords > 0 && $indicator_direction_list->ExportOptions->visible()) { ?>
<?php $indicator_direction_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($indicator_direction_list->ImportOptions->visible()) { ?>
<?php $indicator_direction_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($indicator_direction_list->SearchOptions->visible()) { ?>
<?php $indicator_direction_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($indicator_direction_list->FilterOptions->visible()) { ?>
<?php $indicator_direction_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$indicator_direction_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$indicator_direction_list->isExport() && !$indicator_direction->CurrentAction) { ?>
<form name="findicator_directionlistsrch" id="findicator_directionlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="findicator_directionlistsrch-search-panel" class="<?php echo $indicator_direction_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="indicator_direction">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $indicator_direction_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($indicator_direction_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($indicator_direction_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $indicator_direction_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($indicator_direction_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($indicator_direction_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($indicator_direction_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($indicator_direction_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $indicator_direction_list->showPageHeader(); ?>
<?php
$indicator_direction_list->showMessage();
?>
<?php if ($indicator_direction_list->TotalRecords > 0 || $indicator_direction->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($indicator_direction_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> indicator_direction">
<?php if (!$indicator_direction_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$indicator_direction_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $indicator_direction_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $indicator_direction_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="findicator_directionlist" id="findicator_directionlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="indicator_direction">
<div id="gmp_indicator_direction" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($indicator_direction_list->TotalRecords > 0 || $indicator_direction_list->isGridEdit()) { ?>
<table id="tbl_indicator_directionlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$indicator_direction->RowType = ROWTYPE_HEADER;

// Render list options
$indicator_direction_list->renderListOptions();

// Render list options (header, left)
$indicator_direction_list->ListOptions->render("header", "left");
?>
<?php if ($indicator_direction_list->indicator_direction->Visible) { // indicator_direction ?>
	<?php if ($indicator_direction_list->SortUrl($indicator_direction_list->indicator_direction) == "") { ?>
		<th data-name="indicator_direction" class="<?php echo $indicator_direction_list->indicator_direction->headerCellClass() ?>"><div id="elh_indicator_direction_indicator_direction" class="indicator_direction_indicator_direction"><div class="ew-table-header-caption"><?php echo $indicator_direction_list->indicator_direction->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="indicator_direction" class="<?php echo $indicator_direction_list->indicator_direction->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $indicator_direction_list->SortUrl($indicator_direction_list->indicator_direction) ?>', 1);"><div id="elh_indicator_direction_indicator_direction" class="indicator_direction_indicator_direction">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $indicator_direction_list->indicator_direction->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($indicator_direction_list->indicator_direction->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($indicator_direction_list->indicator_direction->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$indicator_direction_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($indicator_direction_list->ExportAll && $indicator_direction_list->isExport()) {
	$indicator_direction_list->StopRecord = $indicator_direction_list->TotalRecords;
} else {

	// Set the last record to display
	if ($indicator_direction_list->TotalRecords > $indicator_direction_list->StartRecord + $indicator_direction_list->DisplayRecords - 1)
		$indicator_direction_list->StopRecord = $indicator_direction_list->StartRecord + $indicator_direction_list->DisplayRecords - 1;
	else
		$indicator_direction_list->StopRecord = $indicator_direction_list->TotalRecords;
}
$indicator_direction_list->RecordCount = $indicator_direction_list->StartRecord - 1;
if ($indicator_direction_list->Recordset && !$indicator_direction_list->Recordset->EOF) {
	$indicator_direction_list->Recordset->moveFirst();
	$selectLimit = $indicator_direction_list->UseSelectLimit;
	if (!$selectLimit && $indicator_direction_list->StartRecord > 1)
		$indicator_direction_list->Recordset->move($indicator_direction_list->StartRecord - 1);
} elseif (!$indicator_direction->AllowAddDeleteRow && $indicator_direction_list->StopRecord == 0) {
	$indicator_direction_list->StopRecord = $indicator_direction->GridAddRowCount;
}

// Initialize aggregate
$indicator_direction->RowType = ROWTYPE_AGGREGATEINIT;
$indicator_direction->resetAttributes();
$indicator_direction_list->renderRow();
while ($indicator_direction_list->RecordCount < $indicator_direction_list->StopRecord) {
	$indicator_direction_list->RecordCount++;
	if ($indicator_direction_list->RecordCount >= $indicator_direction_list->StartRecord) {
		$indicator_direction_list->RowCount++;

		// Set up key count
		$indicator_direction_list->KeyCount = $indicator_direction_list->RowIndex;

		// Init row class and style
		$indicator_direction->resetAttributes();
		$indicator_direction->CssClass = "";
		if ($indicator_direction_list->isGridAdd()) {
		} else {
			$indicator_direction_list->loadRowValues($indicator_direction_list->Recordset); // Load row values
		}
		$indicator_direction->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$indicator_direction->RowAttrs->merge(["data-rowindex" => $indicator_direction_list->RowCount, "id" => "r" . $indicator_direction_list->RowCount . "_indicator_direction", "data-rowtype" => $indicator_direction->RowType]);

		// Render row
		$indicator_direction_list->renderRow();

		// Render list options
		$indicator_direction_list->renderListOptions();
?>
	<tr <?php echo $indicator_direction->rowAttributes() ?>>
<?php

// Render list options (body, left)
$indicator_direction_list->ListOptions->render("body", "left", $indicator_direction_list->RowCount);
?>
	<?php if ($indicator_direction_list->indicator_direction->Visible) { // indicator_direction ?>
		<td data-name="indicator_direction" <?php echo $indicator_direction_list->indicator_direction->cellAttributes() ?>>
<span id="el<?php echo $indicator_direction_list->RowCount ?>_indicator_direction_indicator_direction">
<span<?php echo $indicator_direction_list->indicator_direction->viewAttributes() ?>><?php echo $indicator_direction_list->indicator_direction->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$indicator_direction_list->ListOptions->render("body", "right", $indicator_direction_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$indicator_direction_list->isGridAdd())
		$indicator_direction_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$indicator_direction->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($indicator_direction_list->Recordset)
	$indicator_direction_list->Recordset->Close();
?>
<?php if (!$indicator_direction_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$indicator_direction_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $indicator_direction_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $indicator_direction_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($indicator_direction_list->TotalRecords == 0 && !$indicator_direction->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $indicator_direction_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$indicator_direction_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$indicator_direction_list->isExport()) { ?>
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
$indicator_direction_list->terminate();
?>