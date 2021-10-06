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
$budget_period_list = new budget_period_list();

// Run the page
$budget_period_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$budget_period_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$budget_period_list->isExport()) { ?>
<script>
var fbudget_periodlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fbudget_periodlist = currentForm = new ew.Form("fbudget_periodlist", "list");
	fbudget_periodlist.formKeyCountName = '<?php echo $budget_period_list->FormKeyCountName ?>';
	loadjs.done("fbudget_periodlist");
});
var fbudget_periodlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fbudget_periodlistsrch = currentSearchForm = new ew.Form("fbudget_periodlistsrch");

	// Dynamic selection lists
	// Filters

	fbudget_periodlistsrch.filterList = <?php echo $budget_period_list->getFilterList() ?>;

	// Init search panel as collapsed
	fbudget_periodlistsrch.initSearchPanel = true;
	loadjs.done("fbudget_periodlistsrch");
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
<?php if (!$budget_period_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($budget_period_list->TotalRecords > 0 && $budget_period_list->ExportOptions->visible()) { ?>
<?php $budget_period_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($budget_period_list->ImportOptions->visible()) { ?>
<?php $budget_period_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($budget_period_list->SearchOptions->visible()) { ?>
<?php $budget_period_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($budget_period_list->FilterOptions->visible()) { ?>
<?php $budget_period_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$budget_period_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$budget_period_list->isExport() && !$budget_period->CurrentAction) { ?>
<form name="fbudget_periodlistsrch" id="fbudget_periodlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fbudget_periodlistsrch-search-panel" class="<?php echo $budget_period_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="budget_period">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $budget_period_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($budget_period_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($budget_period_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $budget_period_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($budget_period_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($budget_period_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($budget_period_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($budget_period_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $budget_period_list->showPageHeader(); ?>
<?php
$budget_period_list->showMessage();
?>
<?php if ($budget_period_list->TotalRecords > 0 || $budget_period->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($budget_period_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> budget_period">
<?php if (!$budget_period_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$budget_period_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $budget_period_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $budget_period_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fbudget_periodlist" id="fbudget_periodlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="budget_period">
<div id="gmp_budget_period" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($budget_period_list->TotalRecords > 0 || $budget_period_list->isGridEdit()) { ?>
<table id="tbl_budget_periodlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$budget_period->RowType = ROWTYPE_HEADER;

// Render list options
$budget_period_list->renderListOptions();

// Render list options (header, left)
$budget_period_list->ListOptions->render("header", "left");
?>
<?php if ($budget_period_list->FiscalYear->Visible) { // FiscalYear ?>
	<?php if ($budget_period_list->SortUrl($budget_period_list->FiscalYear) == "") { ?>
		<th data-name="FiscalYear" class="<?php echo $budget_period_list->FiscalYear->headerCellClass() ?>"><div id="elh_budget_period_FiscalYear" class="budget_period_FiscalYear"><div class="ew-table-header-caption"><?php echo $budget_period_list->FiscalYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FiscalYear" class="<?php echo $budget_period_list->FiscalYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_period_list->SortUrl($budget_period_list->FiscalYear) ?>', 1);"><div id="elh_budget_period_FiscalYear" class="budget_period_FiscalYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_period_list->FiscalYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_period_list->FiscalYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_period_list->FiscalYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_period_list->StartDate->Visible) { // StartDate ?>
	<?php if ($budget_period_list->SortUrl($budget_period_list->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $budget_period_list->StartDate->headerCellClass() ?>"><div id="elh_budget_period_StartDate" class="budget_period_StartDate"><div class="ew-table-header-caption"><?php echo $budget_period_list->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $budget_period_list->StartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_period_list->SortUrl($budget_period_list->StartDate) ?>', 1);"><div id="elh_budget_period_StartDate" class="budget_period_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_period_list->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_period_list->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_period_list->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_period_list->EndDate->Visible) { // EndDate ?>
	<?php if ($budget_period_list->SortUrl($budget_period_list->EndDate) == "") { ?>
		<th data-name="EndDate" class="<?php echo $budget_period_list->EndDate->headerCellClass() ?>"><div id="elh_budget_period_EndDate" class="budget_period_EndDate"><div class="ew-table-header-caption"><?php echo $budget_period_list->EndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EndDate" class="<?php echo $budget_period_list->EndDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_period_list->SortUrl($budget_period_list->EndDate) ?>', 1);"><div id="elh_budget_period_EndDate" class="budget_period_EndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_period_list->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_period_list->EndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_period_list->EndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_period_list->CurrentPeriod->Visible) { // CurrentPeriod ?>
	<?php if ($budget_period_list->SortUrl($budget_period_list->CurrentPeriod) == "") { ?>
		<th data-name="CurrentPeriod" class="<?php echo $budget_period_list->CurrentPeriod->headerCellClass() ?>"><div id="elh_budget_period_CurrentPeriod" class="budget_period_CurrentPeriod"><div class="ew-table-header-caption"><?php echo $budget_period_list->CurrentPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrentPeriod" class="<?php echo $budget_period_list->CurrentPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_period_list->SortUrl($budget_period_list->CurrentPeriod) ?>', 1);"><div id="elh_budget_period_CurrentPeriod" class="budget_period_CurrentPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_period_list->CurrentPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_period_list->CurrentPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_period_list->CurrentPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_period_list->PeriodDescription->Visible) { // PeriodDescription ?>
	<?php if ($budget_period_list->SortUrl($budget_period_list->PeriodDescription) == "") { ?>
		<th data-name="PeriodDescription" class="<?php echo $budget_period_list->PeriodDescription->headerCellClass() ?>"><div id="elh_budget_period_PeriodDescription" class="budget_period_PeriodDescription"><div class="ew-table-header-caption"><?php echo $budget_period_list->PeriodDescription->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodDescription" class="<?php echo $budget_period_list->PeriodDescription->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_period_list->SortUrl($budget_period_list->PeriodDescription) ?>', 1);"><div id="elh_budget_period_PeriodDescription" class="budget_period_PeriodDescription">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_period_list->PeriodDescription->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($budget_period_list->PeriodDescription->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_period_list->PeriodDescription->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$budget_period_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($budget_period_list->ExportAll && $budget_period_list->isExport()) {
	$budget_period_list->StopRecord = $budget_period_list->TotalRecords;
} else {

	// Set the last record to display
	if ($budget_period_list->TotalRecords > $budget_period_list->StartRecord + $budget_period_list->DisplayRecords - 1)
		$budget_period_list->StopRecord = $budget_period_list->StartRecord + $budget_period_list->DisplayRecords - 1;
	else
		$budget_period_list->StopRecord = $budget_period_list->TotalRecords;
}
$budget_period_list->RecordCount = $budget_period_list->StartRecord - 1;
if ($budget_period_list->Recordset && !$budget_period_list->Recordset->EOF) {
	$budget_period_list->Recordset->moveFirst();
	$selectLimit = $budget_period_list->UseSelectLimit;
	if (!$selectLimit && $budget_period_list->StartRecord > 1)
		$budget_period_list->Recordset->move($budget_period_list->StartRecord - 1);
} elseif (!$budget_period->AllowAddDeleteRow && $budget_period_list->StopRecord == 0) {
	$budget_period_list->StopRecord = $budget_period->GridAddRowCount;
}

// Initialize aggregate
$budget_period->RowType = ROWTYPE_AGGREGATEINIT;
$budget_period->resetAttributes();
$budget_period_list->renderRow();
while ($budget_period_list->RecordCount < $budget_period_list->StopRecord) {
	$budget_period_list->RecordCount++;
	if ($budget_period_list->RecordCount >= $budget_period_list->StartRecord) {
		$budget_period_list->RowCount++;

		// Set up key count
		$budget_period_list->KeyCount = $budget_period_list->RowIndex;

		// Init row class and style
		$budget_period->resetAttributes();
		$budget_period->CssClass = "";
		if ($budget_period_list->isGridAdd()) {
		} else {
			$budget_period_list->loadRowValues($budget_period_list->Recordset); // Load row values
		}
		$budget_period->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$budget_period->RowAttrs->merge(["data-rowindex" => $budget_period_list->RowCount, "id" => "r" . $budget_period_list->RowCount . "_budget_period", "data-rowtype" => $budget_period->RowType]);

		// Render row
		$budget_period_list->renderRow();

		// Render list options
		$budget_period_list->renderListOptions();
?>
	<tr <?php echo $budget_period->rowAttributes() ?>>
<?php

// Render list options (body, left)
$budget_period_list->ListOptions->render("body", "left", $budget_period_list->RowCount);
?>
	<?php if ($budget_period_list->FiscalYear->Visible) { // FiscalYear ?>
		<td data-name="FiscalYear" <?php echo $budget_period_list->FiscalYear->cellAttributes() ?>>
<span id="el<?php echo $budget_period_list->RowCount ?>_budget_period_FiscalYear">
<span<?php echo $budget_period_list->FiscalYear->viewAttributes() ?>><?php echo $budget_period_list->FiscalYear->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($budget_period_list->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $budget_period_list->StartDate->cellAttributes() ?>>
<span id="el<?php echo $budget_period_list->RowCount ?>_budget_period_StartDate">
<span<?php echo $budget_period_list->StartDate->viewAttributes() ?>><?php echo $budget_period_list->StartDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($budget_period_list->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate" <?php echo $budget_period_list->EndDate->cellAttributes() ?>>
<span id="el<?php echo $budget_period_list->RowCount ?>_budget_period_EndDate">
<span<?php echo $budget_period_list->EndDate->viewAttributes() ?>><?php echo $budget_period_list->EndDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($budget_period_list->CurrentPeriod->Visible) { // CurrentPeriod ?>
		<td data-name="CurrentPeriod" <?php echo $budget_period_list->CurrentPeriod->cellAttributes() ?>>
<span id="el<?php echo $budget_period_list->RowCount ?>_budget_period_CurrentPeriod">
<span<?php echo $budget_period_list->CurrentPeriod->viewAttributes() ?>><?php echo $budget_period_list->CurrentPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($budget_period_list->PeriodDescription->Visible) { // PeriodDescription ?>
		<td data-name="PeriodDescription" <?php echo $budget_period_list->PeriodDescription->cellAttributes() ?>>
<span id="el<?php echo $budget_period_list->RowCount ?>_budget_period_PeriodDescription">
<span<?php echo $budget_period_list->PeriodDescription->viewAttributes() ?>><?php echo $budget_period_list->PeriodDescription->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$budget_period_list->ListOptions->render("body", "right", $budget_period_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$budget_period_list->isGridAdd())
		$budget_period_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$budget_period->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($budget_period_list->Recordset)
	$budget_period_list->Recordset->Close();
?>
<?php if (!$budget_period_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$budget_period_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $budget_period_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $budget_period_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($budget_period_list->TotalRecords == 0 && !$budget_period->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $budget_period_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$budget_period_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$budget_period_list->isExport()) { ?>
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
$budget_period_list->terminate();
?>