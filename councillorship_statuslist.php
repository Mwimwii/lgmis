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
$councillorship_status_list = new councillorship_status_list();

// Run the page
$councillorship_status_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillorship_status_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$councillorship_status_list->isExport()) { ?>
<script>
var fcouncillorship_statuslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcouncillorship_statuslist = currentForm = new ew.Form("fcouncillorship_statuslist", "list");
	fcouncillorship_statuslist.formKeyCountName = '<?php echo $councillorship_status_list->FormKeyCountName ?>';
	loadjs.done("fcouncillorship_statuslist");
});
var fcouncillorship_statuslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcouncillorship_statuslistsrch = currentSearchForm = new ew.Form("fcouncillorship_statuslistsrch");

	// Dynamic selection lists
	// Filters

	fcouncillorship_statuslistsrch.filterList = <?php echo $councillorship_status_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcouncillorship_statuslistsrch.initSearchPanel = true;
	loadjs.done("fcouncillorship_statuslistsrch");
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
<?php if (!$councillorship_status_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($councillorship_status_list->TotalRecords > 0 && $councillorship_status_list->ExportOptions->visible()) { ?>
<?php $councillorship_status_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($councillorship_status_list->ImportOptions->visible()) { ?>
<?php $councillorship_status_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($councillorship_status_list->SearchOptions->visible()) { ?>
<?php $councillorship_status_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($councillorship_status_list->FilterOptions->visible()) { ?>
<?php $councillorship_status_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$councillorship_status_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$councillorship_status_list->isExport() && !$councillorship_status->CurrentAction) { ?>
<form name="fcouncillorship_statuslistsrch" id="fcouncillorship_statuslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcouncillorship_statuslistsrch-search-panel" class="<?php echo $councillorship_status_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="councillorship_status">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $councillorship_status_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($councillorship_status_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($councillorship_status_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $councillorship_status_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($councillorship_status_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($councillorship_status_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($councillorship_status_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($councillorship_status_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $councillorship_status_list->showPageHeader(); ?>
<?php
$councillorship_status_list->showMessage();
?>
<?php if ($councillorship_status_list->TotalRecords > 0 || $councillorship_status->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($councillorship_status_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> councillorship_status">
<?php if (!$councillorship_status_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$councillorship_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $councillorship_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $councillorship_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcouncillorship_statuslist" id="fcouncillorship_statuslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillorship_status">
<div id="gmp_councillorship_status" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($councillorship_status_list->TotalRecords > 0 || $councillorship_status_list->isGridEdit()) { ?>
<table id="tbl_councillorship_statuslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$councillorship_status->RowType = ROWTYPE_HEADER;

// Render list options
$councillorship_status_list->renderListOptions();

// Render list options (header, left)
$councillorship_status_list->ListOptions->render("header", "left");
?>
<?php if ($councillorship_status_list->CouncillorsipStatus->Visible) { // CouncillorsipStatus ?>
	<?php if ($councillorship_status_list->SortUrl($councillorship_status_list->CouncillorsipStatus) == "") { ?>
		<th data-name="CouncillorsipStatus" class="<?php echo $councillorship_status_list->CouncillorsipStatus->headerCellClass() ?>"><div id="elh_councillorship_status_CouncillorsipStatus" class="councillorship_status_CouncillorsipStatus"><div class="ew-table-header-caption"><?php echo $councillorship_status_list->CouncillorsipStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CouncillorsipStatus" class="<?php echo $councillorship_status_list->CouncillorsipStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_status_list->SortUrl($councillorship_status_list->CouncillorsipStatus) ?>', 1);"><div id="elh_councillorship_status_CouncillorsipStatus" class="councillorship_status_CouncillorsipStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_status_list->CouncillorsipStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_status_list->CouncillorsipStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_status_list->CouncillorsipStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_status_list->CouncillorshipStatusDesc->Visible) { // CouncillorshipStatusDesc ?>
	<?php if ($councillorship_status_list->SortUrl($councillorship_status_list->CouncillorshipStatusDesc) == "") { ?>
		<th data-name="CouncillorshipStatusDesc" class="<?php echo $councillorship_status_list->CouncillorshipStatusDesc->headerCellClass() ?>"><div id="elh_councillorship_status_CouncillorshipStatusDesc" class="councillorship_status_CouncillorshipStatusDesc"><div class="ew-table-header-caption"><?php echo $councillorship_status_list->CouncillorshipStatusDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CouncillorshipStatusDesc" class="<?php echo $councillorship_status_list->CouncillorshipStatusDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_status_list->SortUrl($councillorship_status_list->CouncillorshipStatusDesc) ?>', 1);"><div id="elh_councillorship_status_CouncillorshipStatusDesc" class="councillorship_status_CouncillorshipStatusDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_status_list->CouncillorshipStatusDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($councillorship_status_list->CouncillorshipStatusDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_status_list->CouncillorshipStatusDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$councillorship_status_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($councillorship_status_list->ExportAll && $councillorship_status_list->isExport()) {
	$councillorship_status_list->StopRecord = $councillorship_status_list->TotalRecords;
} else {

	// Set the last record to display
	if ($councillorship_status_list->TotalRecords > $councillorship_status_list->StartRecord + $councillorship_status_list->DisplayRecords - 1)
		$councillorship_status_list->StopRecord = $councillorship_status_list->StartRecord + $councillorship_status_list->DisplayRecords - 1;
	else
		$councillorship_status_list->StopRecord = $councillorship_status_list->TotalRecords;
}
$councillorship_status_list->RecordCount = $councillorship_status_list->StartRecord - 1;
if ($councillorship_status_list->Recordset && !$councillorship_status_list->Recordset->EOF) {
	$councillorship_status_list->Recordset->moveFirst();
	$selectLimit = $councillorship_status_list->UseSelectLimit;
	if (!$selectLimit && $councillorship_status_list->StartRecord > 1)
		$councillorship_status_list->Recordset->move($councillorship_status_list->StartRecord - 1);
} elseif (!$councillorship_status->AllowAddDeleteRow && $councillorship_status_list->StopRecord == 0) {
	$councillorship_status_list->StopRecord = $councillorship_status->GridAddRowCount;
}

// Initialize aggregate
$councillorship_status->RowType = ROWTYPE_AGGREGATEINIT;
$councillorship_status->resetAttributes();
$councillorship_status_list->renderRow();
while ($councillorship_status_list->RecordCount < $councillorship_status_list->StopRecord) {
	$councillorship_status_list->RecordCount++;
	if ($councillorship_status_list->RecordCount >= $councillorship_status_list->StartRecord) {
		$councillorship_status_list->RowCount++;

		// Set up key count
		$councillorship_status_list->KeyCount = $councillorship_status_list->RowIndex;

		// Init row class and style
		$councillorship_status->resetAttributes();
		$councillorship_status->CssClass = "";
		if ($councillorship_status_list->isGridAdd()) {
		} else {
			$councillorship_status_list->loadRowValues($councillorship_status_list->Recordset); // Load row values
		}
		$councillorship_status->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$councillorship_status->RowAttrs->merge(["data-rowindex" => $councillorship_status_list->RowCount, "id" => "r" . $councillorship_status_list->RowCount . "_councillorship_status", "data-rowtype" => $councillorship_status->RowType]);

		// Render row
		$councillorship_status_list->renderRow();

		// Render list options
		$councillorship_status_list->renderListOptions();
?>
	<tr <?php echo $councillorship_status->rowAttributes() ?>>
<?php

// Render list options (body, left)
$councillorship_status_list->ListOptions->render("body", "left", $councillorship_status_list->RowCount);
?>
	<?php if ($councillorship_status_list->CouncillorsipStatus->Visible) { // CouncillorsipStatus ?>
		<td data-name="CouncillorsipStatus" <?php echo $councillorship_status_list->CouncillorsipStatus->cellAttributes() ?>>
<span id="el<?php echo $councillorship_status_list->RowCount ?>_councillorship_status_CouncillorsipStatus">
<span<?php echo $councillorship_status_list->CouncillorsipStatus->viewAttributes() ?>><?php echo $councillorship_status_list->CouncillorsipStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($councillorship_status_list->CouncillorshipStatusDesc->Visible) { // CouncillorshipStatusDesc ?>
		<td data-name="CouncillorshipStatusDesc" <?php echo $councillorship_status_list->CouncillorshipStatusDesc->cellAttributes() ?>>
<span id="el<?php echo $councillorship_status_list->RowCount ?>_councillorship_status_CouncillorshipStatusDesc">
<span<?php echo $councillorship_status_list->CouncillorshipStatusDesc->viewAttributes() ?>><?php echo $councillorship_status_list->CouncillorshipStatusDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$councillorship_status_list->ListOptions->render("body", "right", $councillorship_status_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$councillorship_status_list->isGridAdd())
		$councillorship_status_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$councillorship_status->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($councillorship_status_list->Recordset)
	$councillorship_status_list->Recordset->Close();
?>
<?php if (!$councillorship_status_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$councillorship_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $councillorship_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $councillorship_status_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($councillorship_status_list->TotalRecords == 0 && !$councillorship_status->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $councillorship_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$councillorship_status_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$councillorship_status_list->isExport()) { ?>
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
$councillorship_status_list->terminate();
?>