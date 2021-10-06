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
$appraisal_status_list = new appraisal_status_list();

// Run the page
$appraisal_status_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$appraisal_status_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$appraisal_status_list->isExport()) { ?>
<script>
var fappraisal_statuslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fappraisal_statuslist = currentForm = new ew.Form("fappraisal_statuslist", "list");
	fappraisal_statuslist.formKeyCountName = '<?php echo $appraisal_status_list->FormKeyCountName ?>';
	loadjs.done("fappraisal_statuslist");
});
var fappraisal_statuslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fappraisal_statuslistsrch = currentSearchForm = new ew.Form("fappraisal_statuslistsrch");

	// Dynamic selection lists
	// Filters

	fappraisal_statuslistsrch.filterList = <?php echo $appraisal_status_list->getFilterList() ?>;

	// Init search panel as collapsed
	fappraisal_statuslistsrch.initSearchPanel = true;
	loadjs.done("fappraisal_statuslistsrch");
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
<?php if (!$appraisal_status_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($appraisal_status_list->TotalRecords > 0 && $appraisal_status_list->ExportOptions->visible()) { ?>
<?php $appraisal_status_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($appraisal_status_list->ImportOptions->visible()) { ?>
<?php $appraisal_status_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($appraisal_status_list->SearchOptions->visible()) { ?>
<?php $appraisal_status_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($appraisal_status_list->FilterOptions->visible()) { ?>
<?php $appraisal_status_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$appraisal_status_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$appraisal_status_list->isExport() && !$appraisal_status->CurrentAction) { ?>
<form name="fappraisal_statuslistsrch" id="fappraisal_statuslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fappraisal_statuslistsrch-search-panel" class="<?php echo $appraisal_status_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="appraisal_status">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $appraisal_status_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($appraisal_status_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($appraisal_status_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $appraisal_status_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($appraisal_status_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($appraisal_status_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($appraisal_status_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($appraisal_status_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $appraisal_status_list->showPageHeader(); ?>
<?php
$appraisal_status_list->showMessage();
?>
<?php if ($appraisal_status_list->TotalRecords > 0 || $appraisal_status->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($appraisal_status_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> appraisal_status">
<?php if (!$appraisal_status_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$appraisal_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $appraisal_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $appraisal_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fappraisal_statuslist" id="fappraisal_statuslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="appraisal_status">
<div id="gmp_appraisal_status" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($appraisal_status_list->TotalRecords > 0 || $appraisal_status_list->isGridEdit()) { ?>
<table id="tbl_appraisal_statuslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$appraisal_status->RowType = ROWTYPE_HEADER;

// Render list options
$appraisal_status_list->renderListOptions();

// Render list options (header, left)
$appraisal_status_list->ListOptions->render("header", "left");
?>
<?php if ($appraisal_status_list->AppraisalStatus->Visible) { // AppraisalStatus ?>
	<?php if ($appraisal_status_list->SortUrl($appraisal_status_list->AppraisalStatus) == "") { ?>
		<th data-name="AppraisalStatus" class="<?php echo $appraisal_status_list->AppraisalStatus->headerCellClass() ?>"><div id="elh_appraisal_status_AppraisalStatus" class="appraisal_status_AppraisalStatus"><div class="ew-table-header-caption"><?php echo $appraisal_status_list->AppraisalStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AppraisalStatus" class="<?php echo $appraisal_status_list->AppraisalStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $appraisal_status_list->SortUrl($appraisal_status_list->AppraisalStatus) ?>', 1);"><div id="elh_appraisal_status_AppraisalStatus" class="appraisal_status_AppraisalStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $appraisal_status_list->AppraisalStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($appraisal_status_list->AppraisalStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($appraisal_status_list->AppraisalStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($appraisal_status_list->AppraisalStatusDesc->Visible) { // AppraisalStatusDesc ?>
	<?php if ($appraisal_status_list->SortUrl($appraisal_status_list->AppraisalStatusDesc) == "") { ?>
		<th data-name="AppraisalStatusDesc" class="<?php echo $appraisal_status_list->AppraisalStatusDesc->headerCellClass() ?>"><div id="elh_appraisal_status_AppraisalStatusDesc" class="appraisal_status_AppraisalStatusDesc"><div class="ew-table-header-caption"><?php echo $appraisal_status_list->AppraisalStatusDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AppraisalStatusDesc" class="<?php echo $appraisal_status_list->AppraisalStatusDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $appraisal_status_list->SortUrl($appraisal_status_list->AppraisalStatusDesc) ?>', 1);"><div id="elh_appraisal_status_AppraisalStatusDesc" class="appraisal_status_AppraisalStatusDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $appraisal_status_list->AppraisalStatusDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($appraisal_status_list->AppraisalStatusDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($appraisal_status_list->AppraisalStatusDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$appraisal_status_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($appraisal_status_list->ExportAll && $appraisal_status_list->isExport()) {
	$appraisal_status_list->StopRecord = $appraisal_status_list->TotalRecords;
} else {

	// Set the last record to display
	if ($appraisal_status_list->TotalRecords > $appraisal_status_list->StartRecord + $appraisal_status_list->DisplayRecords - 1)
		$appraisal_status_list->StopRecord = $appraisal_status_list->StartRecord + $appraisal_status_list->DisplayRecords - 1;
	else
		$appraisal_status_list->StopRecord = $appraisal_status_list->TotalRecords;
}
$appraisal_status_list->RecordCount = $appraisal_status_list->StartRecord - 1;
if ($appraisal_status_list->Recordset && !$appraisal_status_list->Recordset->EOF) {
	$appraisal_status_list->Recordset->moveFirst();
	$selectLimit = $appraisal_status_list->UseSelectLimit;
	if (!$selectLimit && $appraisal_status_list->StartRecord > 1)
		$appraisal_status_list->Recordset->move($appraisal_status_list->StartRecord - 1);
} elseif (!$appraisal_status->AllowAddDeleteRow && $appraisal_status_list->StopRecord == 0) {
	$appraisal_status_list->StopRecord = $appraisal_status->GridAddRowCount;
}

// Initialize aggregate
$appraisal_status->RowType = ROWTYPE_AGGREGATEINIT;
$appraisal_status->resetAttributes();
$appraisal_status_list->renderRow();
while ($appraisal_status_list->RecordCount < $appraisal_status_list->StopRecord) {
	$appraisal_status_list->RecordCount++;
	if ($appraisal_status_list->RecordCount >= $appraisal_status_list->StartRecord) {
		$appraisal_status_list->RowCount++;

		// Set up key count
		$appraisal_status_list->KeyCount = $appraisal_status_list->RowIndex;

		// Init row class and style
		$appraisal_status->resetAttributes();
		$appraisal_status->CssClass = "";
		if ($appraisal_status_list->isGridAdd()) {
		} else {
			$appraisal_status_list->loadRowValues($appraisal_status_list->Recordset); // Load row values
		}
		$appraisal_status->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$appraisal_status->RowAttrs->merge(["data-rowindex" => $appraisal_status_list->RowCount, "id" => "r" . $appraisal_status_list->RowCount . "_appraisal_status", "data-rowtype" => $appraisal_status->RowType]);

		// Render row
		$appraisal_status_list->renderRow();

		// Render list options
		$appraisal_status_list->renderListOptions();
?>
	<tr <?php echo $appraisal_status->rowAttributes() ?>>
<?php

// Render list options (body, left)
$appraisal_status_list->ListOptions->render("body", "left", $appraisal_status_list->RowCount);
?>
	<?php if ($appraisal_status_list->AppraisalStatus->Visible) { // AppraisalStatus ?>
		<td data-name="AppraisalStatus" <?php echo $appraisal_status_list->AppraisalStatus->cellAttributes() ?>>
<span id="el<?php echo $appraisal_status_list->RowCount ?>_appraisal_status_AppraisalStatus">
<span<?php echo $appraisal_status_list->AppraisalStatus->viewAttributes() ?>><?php echo $appraisal_status_list->AppraisalStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($appraisal_status_list->AppraisalStatusDesc->Visible) { // AppraisalStatusDesc ?>
		<td data-name="AppraisalStatusDesc" <?php echo $appraisal_status_list->AppraisalStatusDesc->cellAttributes() ?>>
<span id="el<?php echo $appraisal_status_list->RowCount ?>_appraisal_status_AppraisalStatusDesc">
<span<?php echo $appraisal_status_list->AppraisalStatusDesc->viewAttributes() ?>><?php echo $appraisal_status_list->AppraisalStatusDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$appraisal_status_list->ListOptions->render("body", "right", $appraisal_status_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$appraisal_status_list->isGridAdd())
		$appraisal_status_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$appraisal_status->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($appraisal_status_list->Recordset)
	$appraisal_status_list->Recordset->Close();
?>
<?php if (!$appraisal_status_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$appraisal_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $appraisal_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $appraisal_status_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($appraisal_status_list->TotalRecords == 0 && !$appraisal_status->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $appraisal_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$appraisal_status_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$appraisal_status_list->isExport()) { ?>
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
$appraisal_status_list->terminate();
?>