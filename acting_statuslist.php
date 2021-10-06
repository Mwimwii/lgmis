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
$acting_status_list = new acting_status_list();

// Run the page
$acting_status_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acting_status_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$acting_status_list->isExport()) { ?>
<script>
var facting_statuslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	facting_statuslist = currentForm = new ew.Form("facting_statuslist", "list");
	facting_statuslist.formKeyCountName = '<?php echo $acting_status_list->FormKeyCountName ?>';
	loadjs.done("facting_statuslist");
});
var facting_statuslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	facting_statuslistsrch = currentSearchForm = new ew.Form("facting_statuslistsrch");

	// Dynamic selection lists
	// Filters

	facting_statuslistsrch.filterList = <?php echo $acting_status_list->getFilterList() ?>;

	// Init search panel as collapsed
	facting_statuslistsrch.initSearchPanel = true;
	loadjs.done("facting_statuslistsrch");
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
<?php if (!$acting_status_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($acting_status_list->TotalRecords > 0 && $acting_status_list->ExportOptions->visible()) { ?>
<?php $acting_status_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($acting_status_list->ImportOptions->visible()) { ?>
<?php $acting_status_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($acting_status_list->SearchOptions->visible()) { ?>
<?php $acting_status_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($acting_status_list->FilterOptions->visible()) { ?>
<?php $acting_status_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$acting_status_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$acting_status_list->isExport() && !$acting_status->CurrentAction) { ?>
<form name="facting_statuslistsrch" id="facting_statuslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="facting_statuslistsrch-search-panel" class="<?php echo $acting_status_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="acting_status">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $acting_status_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($acting_status_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($acting_status_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $acting_status_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($acting_status_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($acting_status_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($acting_status_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($acting_status_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $acting_status_list->showPageHeader(); ?>
<?php
$acting_status_list->showMessage();
?>
<?php if ($acting_status_list->TotalRecords > 0 || $acting_status->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($acting_status_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> acting_status">
<?php if (!$acting_status_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$acting_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $acting_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $acting_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="facting_statuslist" id="facting_statuslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acting_status">
<div id="gmp_acting_status" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($acting_status_list->TotalRecords > 0 || $acting_status_list->isGridEdit()) { ?>
<table id="tbl_acting_statuslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$acting_status->RowType = ROWTYPE_HEADER;

// Render list options
$acting_status_list->renderListOptions();

// Render list options (header, left)
$acting_status_list->ListOptions->render("header", "left");
?>
<?php if ($acting_status_list->ActingStatus->Visible) { // ActingStatus ?>
	<?php if ($acting_status_list->SortUrl($acting_status_list->ActingStatus) == "") { ?>
		<th data-name="ActingStatus" class="<?php echo $acting_status_list->ActingStatus->headerCellClass() ?>"><div id="elh_acting_status_ActingStatus" class="acting_status_ActingStatus"><div class="ew-table-header-caption"><?php echo $acting_status_list->ActingStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActingStatus" class="<?php echo $acting_status_list->ActingStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $acting_status_list->SortUrl($acting_status_list->ActingStatus) ?>', 1);"><div id="elh_acting_status_ActingStatus" class="acting_status_ActingStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $acting_status_list->ActingStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($acting_status_list->ActingStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($acting_status_list->ActingStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($acting_status_list->ActingStatusDesc->Visible) { // ActingStatusDesc ?>
	<?php if ($acting_status_list->SortUrl($acting_status_list->ActingStatusDesc) == "") { ?>
		<th data-name="ActingStatusDesc" class="<?php echo $acting_status_list->ActingStatusDesc->headerCellClass() ?>"><div id="elh_acting_status_ActingStatusDesc" class="acting_status_ActingStatusDesc"><div class="ew-table-header-caption"><?php echo $acting_status_list->ActingStatusDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActingStatusDesc" class="<?php echo $acting_status_list->ActingStatusDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $acting_status_list->SortUrl($acting_status_list->ActingStatusDesc) ?>', 1);"><div id="elh_acting_status_ActingStatusDesc" class="acting_status_ActingStatusDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $acting_status_list->ActingStatusDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($acting_status_list->ActingStatusDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($acting_status_list->ActingStatusDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$acting_status_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($acting_status_list->ExportAll && $acting_status_list->isExport()) {
	$acting_status_list->StopRecord = $acting_status_list->TotalRecords;
} else {

	// Set the last record to display
	if ($acting_status_list->TotalRecords > $acting_status_list->StartRecord + $acting_status_list->DisplayRecords - 1)
		$acting_status_list->StopRecord = $acting_status_list->StartRecord + $acting_status_list->DisplayRecords - 1;
	else
		$acting_status_list->StopRecord = $acting_status_list->TotalRecords;
}
$acting_status_list->RecordCount = $acting_status_list->StartRecord - 1;
if ($acting_status_list->Recordset && !$acting_status_list->Recordset->EOF) {
	$acting_status_list->Recordset->moveFirst();
	$selectLimit = $acting_status_list->UseSelectLimit;
	if (!$selectLimit && $acting_status_list->StartRecord > 1)
		$acting_status_list->Recordset->move($acting_status_list->StartRecord - 1);
} elseif (!$acting_status->AllowAddDeleteRow && $acting_status_list->StopRecord == 0) {
	$acting_status_list->StopRecord = $acting_status->GridAddRowCount;
}

// Initialize aggregate
$acting_status->RowType = ROWTYPE_AGGREGATEINIT;
$acting_status->resetAttributes();
$acting_status_list->renderRow();
while ($acting_status_list->RecordCount < $acting_status_list->StopRecord) {
	$acting_status_list->RecordCount++;
	if ($acting_status_list->RecordCount >= $acting_status_list->StartRecord) {
		$acting_status_list->RowCount++;

		// Set up key count
		$acting_status_list->KeyCount = $acting_status_list->RowIndex;

		// Init row class and style
		$acting_status->resetAttributes();
		$acting_status->CssClass = "";
		if ($acting_status_list->isGridAdd()) {
		} else {
			$acting_status_list->loadRowValues($acting_status_list->Recordset); // Load row values
		}
		$acting_status->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$acting_status->RowAttrs->merge(["data-rowindex" => $acting_status_list->RowCount, "id" => "r" . $acting_status_list->RowCount . "_acting_status", "data-rowtype" => $acting_status->RowType]);

		// Render row
		$acting_status_list->renderRow();

		// Render list options
		$acting_status_list->renderListOptions();
?>
	<tr <?php echo $acting_status->rowAttributes() ?>>
<?php

// Render list options (body, left)
$acting_status_list->ListOptions->render("body", "left", $acting_status_list->RowCount);
?>
	<?php if ($acting_status_list->ActingStatus->Visible) { // ActingStatus ?>
		<td data-name="ActingStatus" <?php echo $acting_status_list->ActingStatus->cellAttributes() ?>>
<span id="el<?php echo $acting_status_list->RowCount ?>_acting_status_ActingStatus">
<span<?php echo $acting_status_list->ActingStatus->viewAttributes() ?>><?php echo $acting_status_list->ActingStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($acting_status_list->ActingStatusDesc->Visible) { // ActingStatusDesc ?>
		<td data-name="ActingStatusDesc" <?php echo $acting_status_list->ActingStatusDesc->cellAttributes() ?>>
<span id="el<?php echo $acting_status_list->RowCount ?>_acting_status_ActingStatusDesc">
<span<?php echo $acting_status_list->ActingStatusDesc->viewAttributes() ?>><?php echo $acting_status_list->ActingStatusDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$acting_status_list->ListOptions->render("body", "right", $acting_status_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$acting_status_list->isGridAdd())
		$acting_status_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$acting_status->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($acting_status_list->Recordset)
	$acting_status_list->Recordset->Close();
?>
<?php if (!$acting_status_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$acting_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $acting_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $acting_status_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($acting_status_list->TotalRecords == 0 && !$acting_status->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $acting_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$acting_status_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$acting_status_list->isExport()) { ?>
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
$acting_status_list->terminate();
?>