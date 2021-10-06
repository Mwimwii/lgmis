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
$appeal_status_list = new appeal_status_list();

// Run the page
$appeal_status_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$appeal_status_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$appeal_status_list->isExport()) { ?>
<script>
var fappeal_statuslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fappeal_statuslist = currentForm = new ew.Form("fappeal_statuslist", "list");
	fappeal_statuslist.formKeyCountName = '<?php echo $appeal_status_list->FormKeyCountName ?>';
	loadjs.done("fappeal_statuslist");
});
var fappeal_statuslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fappeal_statuslistsrch = currentSearchForm = new ew.Form("fappeal_statuslistsrch");

	// Dynamic selection lists
	// Filters

	fappeal_statuslistsrch.filterList = <?php echo $appeal_status_list->getFilterList() ?>;

	// Init search panel as collapsed
	fappeal_statuslistsrch.initSearchPanel = true;
	loadjs.done("fappeal_statuslistsrch");
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
<?php if (!$appeal_status_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($appeal_status_list->TotalRecords > 0 && $appeal_status_list->ExportOptions->visible()) { ?>
<?php $appeal_status_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($appeal_status_list->ImportOptions->visible()) { ?>
<?php $appeal_status_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($appeal_status_list->SearchOptions->visible()) { ?>
<?php $appeal_status_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($appeal_status_list->FilterOptions->visible()) { ?>
<?php $appeal_status_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$appeal_status_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$appeal_status_list->isExport() && !$appeal_status->CurrentAction) { ?>
<form name="fappeal_statuslistsrch" id="fappeal_statuslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fappeal_statuslistsrch-search-panel" class="<?php echo $appeal_status_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="appeal_status">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $appeal_status_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($appeal_status_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($appeal_status_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $appeal_status_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($appeal_status_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($appeal_status_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($appeal_status_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($appeal_status_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $appeal_status_list->showPageHeader(); ?>
<?php
$appeal_status_list->showMessage();
?>
<?php if ($appeal_status_list->TotalRecords > 0 || $appeal_status->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($appeal_status_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> appeal_status">
<?php if (!$appeal_status_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$appeal_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $appeal_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $appeal_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fappeal_statuslist" id="fappeal_statuslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="appeal_status">
<div id="gmp_appeal_status" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($appeal_status_list->TotalRecords > 0 || $appeal_status_list->isGridEdit()) { ?>
<table id="tbl_appeal_statuslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$appeal_status->RowType = ROWTYPE_HEADER;

// Render list options
$appeal_status_list->renderListOptions();

// Render list options (header, left)
$appeal_status_list->ListOptions->render("header", "left");
?>
<?php if ($appeal_status_list->AppealStatusCode->Visible) { // AppealStatusCode ?>
	<?php if ($appeal_status_list->SortUrl($appeal_status_list->AppealStatusCode) == "") { ?>
		<th data-name="AppealStatusCode" class="<?php echo $appeal_status_list->AppealStatusCode->headerCellClass() ?>"><div id="elh_appeal_status_AppealStatusCode" class="appeal_status_AppealStatusCode"><div class="ew-table-header-caption"><?php echo $appeal_status_list->AppealStatusCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AppealStatusCode" class="<?php echo $appeal_status_list->AppealStatusCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $appeal_status_list->SortUrl($appeal_status_list->AppealStatusCode) ?>', 1);"><div id="elh_appeal_status_AppealStatusCode" class="appeal_status_AppealStatusCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $appeal_status_list->AppealStatusCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($appeal_status_list->AppealStatusCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($appeal_status_list->AppealStatusCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($appeal_status_list->AppealStatus->Visible) { // AppealStatus ?>
	<?php if ($appeal_status_list->SortUrl($appeal_status_list->AppealStatus) == "") { ?>
		<th data-name="AppealStatus" class="<?php echo $appeal_status_list->AppealStatus->headerCellClass() ?>"><div id="elh_appeal_status_AppealStatus" class="appeal_status_AppealStatus"><div class="ew-table-header-caption"><?php echo $appeal_status_list->AppealStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AppealStatus" class="<?php echo $appeal_status_list->AppealStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $appeal_status_list->SortUrl($appeal_status_list->AppealStatus) ?>', 1);"><div id="elh_appeal_status_AppealStatus" class="appeal_status_AppealStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $appeal_status_list->AppealStatus->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($appeal_status_list->AppealStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($appeal_status_list->AppealStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$appeal_status_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($appeal_status_list->ExportAll && $appeal_status_list->isExport()) {
	$appeal_status_list->StopRecord = $appeal_status_list->TotalRecords;
} else {

	// Set the last record to display
	if ($appeal_status_list->TotalRecords > $appeal_status_list->StartRecord + $appeal_status_list->DisplayRecords - 1)
		$appeal_status_list->StopRecord = $appeal_status_list->StartRecord + $appeal_status_list->DisplayRecords - 1;
	else
		$appeal_status_list->StopRecord = $appeal_status_list->TotalRecords;
}
$appeal_status_list->RecordCount = $appeal_status_list->StartRecord - 1;
if ($appeal_status_list->Recordset && !$appeal_status_list->Recordset->EOF) {
	$appeal_status_list->Recordset->moveFirst();
	$selectLimit = $appeal_status_list->UseSelectLimit;
	if (!$selectLimit && $appeal_status_list->StartRecord > 1)
		$appeal_status_list->Recordset->move($appeal_status_list->StartRecord - 1);
} elseif (!$appeal_status->AllowAddDeleteRow && $appeal_status_list->StopRecord == 0) {
	$appeal_status_list->StopRecord = $appeal_status->GridAddRowCount;
}

// Initialize aggregate
$appeal_status->RowType = ROWTYPE_AGGREGATEINIT;
$appeal_status->resetAttributes();
$appeal_status_list->renderRow();
while ($appeal_status_list->RecordCount < $appeal_status_list->StopRecord) {
	$appeal_status_list->RecordCount++;
	if ($appeal_status_list->RecordCount >= $appeal_status_list->StartRecord) {
		$appeal_status_list->RowCount++;

		// Set up key count
		$appeal_status_list->KeyCount = $appeal_status_list->RowIndex;

		// Init row class and style
		$appeal_status->resetAttributes();
		$appeal_status->CssClass = "";
		if ($appeal_status_list->isGridAdd()) {
		} else {
			$appeal_status_list->loadRowValues($appeal_status_list->Recordset); // Load row values
		}
		$appeal_status->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$appeal_status->RowAttrs->merge(["data-rowindex" => $appeal_status_list->RowCount, "id" => "r" . $appeal_status_list->RowCount . "_appeal_status", "data-rowtype" => $appeal_status->RowType]);

		// Render row
		$appeal_status_list->renderRow();

		// Render list options
		$appeal_status_list->renderListOptions();
?>
	<tr <?php echo $appeal_status->rowAttributes() ?>>
<?php

// Render list options (body, left)
$appeal_status_list->ListOptions->render("body", "left", $appeal_status_list->RowCount);
?>
	<?php if ($appeal_status_list->AppealStatusCode->Visible) { // AppealStatusCode ?>
		<td data-name="AppealStatusCode" <?php echo $appeal_status_list->AppealStatusCode->cellAttributes() ?>>
<span id="el<?php echo $appeal_status_list->RowCount ?>_appeal_status_AppealStatusCode">
<span<?php echo $appeal_status_list->AppealStatusCode->viewAttributes() ?>><?php echo $appeal_status_list->AppealStatusCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($appeal_status_list->AppealStatus->Visible) { // AppealStatus ?>
		<td data-name="AppealStatus" <?php echo $appeal_status_list->AppealStatus->cellAttributes() ?>>
<span id="el<?php echo $appeal_status_list->RowCount ?>_appeal_status_AppealStatus">
<span<?php echo $appeal_status_list->AppealStatus->viewAttributes() ?>><?php echo $appeal_status_list->AppealStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$appeal_status_list->ListOptions->render("body", "right", $appeal_status_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$appeal_status_list->isGridAdd())
		$appeal_status_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$appeal_status->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($appeal_status_list->Recordset)
	$appeal_status_list->Recordset->Close();
?>
<?php if (!$appeal_status_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$appeal_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $appeal_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $appeal_status_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($appeal_status_list->TotalRecords == 0 && !$appeal_status->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $appeal_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$appeal_status_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$appeal_status_list->isExport()) { ?>
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
$appeal_status_list->terminate();
?>