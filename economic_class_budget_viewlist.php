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
$economic_class_budget_view_list = new economic_class_budget_view_list();

// Run the page
$economic_class_budget_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$economic_class_budget_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$economic_class_budget_view_list->isExport()) { ?>
<script>
var feconomic_class_budget_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	feconomic_class_budget_viewlist = currentForm = new ew.Form("feconomic_class_budget_viewlist", "list");
	feconomic_class_budget_viewlist.formKeyCountName = '<?php echo $economic_class_budget_view_list->FormKeyCountName ?>';
	loadjs.done("feconomic_class_budget_viewlist");
});
var feconomic_class_budget_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	feconomic_class_budget_viewlistsrch = currentSearchForm = new ew.Form("feconomic_class_budget_viewlistsrch");

	// Dynamic selection lists
	// Filters

	feconomic_class_budget_viewlistsrch.filterList = <?php echo $economic_class_budget_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	feconomic_class_budget_viewlistsrch.initSearchPanel = true;
	loadjs.done("feconomic_class_budget_viewlistsrch");
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
<?php if (!$economic_class_budget_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($economic_class_budget_view_list->TotalRecords > 0 && $economic_class_budget_view_list->ExportOptions->visible()) { ?>
<?php $economic_class_budget_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($economic_class_budget_view_list->ImportOptions->visible()) { ?>
<?php $economic_class_budget_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($economic_class_budget_view_list->SearchOptions->visible()) { ?>
<?php $economic_class_budget_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($economic_class_budget_view_list->FilterOptions->visible()) { ?>
<?php $economic_class_budget_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$economic_class_budget_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$economic_class_budget_view_list->isExport() && !$economic_class_budget_view->CurrentAction) { ?>
<form name="feconomic_class_budget_viewlistsrch" id="feconomic_class_budget_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="feconomic_class_budget_viewlistsrch-search-panel" class="<?php echo $economic_class_budget_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="economic_class_budget_view">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $economic_class_budget_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($economic_class_budget_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($economic_class_budget_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $economic_class_budget_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($economic_class_budget_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($economic_class_budget_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($economic_class_budget_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($economic_class_budget_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $economic_class_budget_view_list->showPageHeader(); ?>
<?php
$economic_class_budget_view_list->showMessage();
?>
<?php if ($economic_class_budget_view_list->TotalRecords > 0 || $economic_class_budget_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($economic_class_budget_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> economic_class_budget_view">
<?php if (!$economic_class_budget_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$economic_class_budget_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $economic_class_budget_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $economic_class_budget_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="feconomic_class_budget_viewlist" id="feconomic_class_budget_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="economic_class_budget_view">
<div id="gmp_economic_class_budget_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($economic_class_budget_view_list->TotalRecords > 0 || $economic_class_budget_view_list->isGridEdit()) { ?>
<table id="tbl_economic_class_budget_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$economic_class_budget_view->RowType = ROWTYPE_HEADER;

// Render list options
$economic_class_budget_view_list->renderListOptions();

// Render list options (header, left)
$economic_class_budget_view_list->ListOptions->render("header", "left");
?>
<?php if ($economic_class_budget_view_list->LACode->Visible) { // LACode ?>
	<?php if ($economic_class_budget_view_list->SortUrl($economic_class_budget_view_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $economic_class_budget_view_list->LACode->headerCellClass() ?>"><div id="elh_economic_class_budget_view_LACode" class="economic_class_budget_view_LACode"><div class="ew-table-header-caption"><?php echo $economic_class_budget_view_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $economic_class_budget_view_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $economic_class_budget_view_list->SortUrl($economic_class_budget_view_list->LACode) ?>', 1);"><div id="elh_economic_class_budget_view_LACode" class="economic_class_budget_view_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $economic_class_budget_view_list->LACode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($economic_class_budget_view_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($economic_class_budget_view_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($economic_class_budget_view_list->LAName->Visible) { // LAName ?>
	<?php if ($economic_class_budget_view_list->SortUrl($economic_class_budget_view_list->LAName) == "") { ?>
		<th data-name="LAName" class="<?php echo $economic_class_budget_view_list->LAName->headerCellClass() ?>"><div id="elh_economic_class_budget_view_LAName" class="economic_class_budget_view_LAName"><div class="ew-table-header-caption"><?php echo $economic_class_budget_view_list->LAName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LAName" class="<?php echo $economic_class_budget_view_list->LAName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $economic_class_budget_view_list->SortUrl($economic_class_budget_view_list->LAName) ?>', 1);"><div id="elh_economic_class_budget_view_LAName" class="economic_class_budget_view_LAName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $economic_class_budget_view_list->LAName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($economic_class_budget_view_list->LAName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($economic_class_budget_view_list->LAName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($economic_class_budget_view_list->AccountGroupCode->Visible) { // AccountGroupCode ?>
	<?php if ($economic_class_budget_view_list->SortUrl($economic_class_budget_view_list->AccountGroupCode) == "") { ?>
		<th data-name="AccountGroupCode" class="<?php echo $economic_class_budget_view_list->AccountGroupCode->headerCellClass() ?>"><div id="elh_economic_class_budget_view_AccountGroupCode" class="economic_class_budget_view_AccountGroupCode"><div class="ew-table-header-caption"><?php echo $economic_class_budget_view_list->AccountGroupCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountGroupCode" class="<?php echo $economic_class_budget_view_list->AccountGroupCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $economic_class_budget_view_list->SortUrl($economic_class_budget_view_list->AccountGroupCode) ?>', 1);"><div id="elh_economic_class_budget_view_AccountGroupCode" class="economic_class_budget_view_AccountGroupCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $economic_class_budget_view_list->AccountGroupCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($economic_class_budget_view_list->AccountGroupCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($economic_class_budget_view_list->AccountGroupCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($economic_class_budget_view_list->AccountGroupName->Visible) { // AccountGroupName ?>
	<?php if ($economic_class_budget_view_list->SortUrl($economic_class_budget_view_list->AccountGroupName) == "") { ?>
		<th data-name="AccountGroupName" class="<?php echo $economic_class_budget_view_list->AccountGroupName->headerCellClass() ?>"><div id="elh_economic_class_budget_view_AccountGroupName" class="economic_class_budget_view_AccountGroupName"><div class="ew-table-header-caption"><?php echo $economic_class_budget_view_list->AccountGroupName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountGroupName" class="<?php echo $economic_class_budget_view_list->AccountGroupName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $economic_class_budget_view_list->SortUrl($economic_class_budget_view_list->AccountGroupName) ?>', 1);"><div id="elh_economic_class_budget_view_AccountGroupName" class="economic_class_budget_view_AccountGroupName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $economic_class_budget_view_list->AccountGroupName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($economic_class_budget_view_list->AccountGroupName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($economic_class_budget_view_list->AccountGroupName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($economic_class_budget_view_list->AccountCode->Visible) { // AccountCode ?>
	<?php if ($economic_class_budget_view_list->SortUrl($economic_class_budget_view_list->AccountCode) == "") { ?>
		<th data-name="AccountCode" class="<?php echo $economic_class_budget_view_list->AccountCode->headerCellClass() ?>"><div id="elh_economic_class_budget_view_AccountCode" class="economic_class_budget_view_AccountCode"><div class="ew-table-header-caption"><?php echo $economic_class_budget_view_list->AccountCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountCode" class="<?php echo $economic_class_budget_view_list->AccountCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $economic_class_budget_view_list->SortUrl($economic_class_budget_view_list->AccountCode) ?>', 1);"><div id="elh_economic_class_budget_view_AccountCode" class="economic_class_budget_view_AccountCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $economic_class_budget_view_list->AccountCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($economic_class_budget_view_list->AccountCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($economic_class_budget_view_list->AccountCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($economic_class_budget_view_list->AccountName->Visible) { // AccountName ?>
	<?php if ($economic_class_budget_view_list->SortUrl($economic_class_budget_view_list->AccountName) == "") { ?>
		<th data-name="AccountName" class="<?php echo $economic_class_budget_view_list->AccountName->headerCellClass() ?>"><div id="elh_economic_class_budget_view_AccountName" class="economic_class_budget_view_AccountName"><div class="ew-table-header-caption"><?php echo $economic_class_budget_view_list->AccountName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountName" class="<?php echo $economic_class_budget_view_list->AccountName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $economic_class_budget_view_list->SortUrl($economic_class_budget_view_list->AccountName) ?>', 1);"><div id="elh_economic_class_budget_view_AccountName" class="economic_class_budget_view_AccountName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $economic_class_budget_view_list->AccountName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($economic_class_budget_view_list->AccountName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($economic_class_budget_view_list->AccountName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($economic_class_budget_view_list->FinancialYear->Visible) { // FinancialYear ?>
	<?php if ($economic_class_budget_view_list->SortUrl($economic_class_budget_view_list->FinancialYear) == "") { ?>
		<th data-name="FinancialYear" class="<?php echo $economic_class_budget_view_list->FinancialYear->headerCellClass() ?>"><div id="elh_economic_class_budget_view_FinancialYear" class="economic_class_budget_view_FinancialYear"><div class="ew-table-header-caption"><?php echo $economic_class_budget_view_list->FinancialYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FinancialYear" class="<?php echo $economic_class_budget_view_list->FinancialYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $economic_class_budget_view_list->SortUrl($economic_class_budget_view_list->FinancialYear) ?>', 1);"><div id="elh_economic_class_budget_view_FinancialYear" class="economic_class_budget_view_FinancialYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $economic_class_budget_view_list->FinancialYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($economic_class_budget_view_list->FinancialYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($economic_class_budget_view_list->FinancialYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($economic_class_budget_view_list->BudgetEstimate->Visible) { // BudgetEstimate ?>
	<?php if ($economic_class_budget_view_list->SortUrl($economic_class_budget_view_list->BudgetEstimate) == "") { ?>
		<th data-name="BudgetEstimate" class="<?php echo $economic_class_budget_view_list->BudgetEstimate->headerCellClass() ?>"><div id="elh_economic_class_budget_view_BudgetEstimate" class="economic_class_budget_view_BudgetEstimate"><div class="ew-table-header-caption"><?php echo $economic_class_budget_view_list->BudgetEstimate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BudgetEstimate" class="<?php echo $economic_class_budget_view_list->BudgetEstimate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $economic_class_budget_view_list->SortUrl($economic_class_budget_view_list->BudgetEstimate) ?>', 1);"><div id="elh_economic_class_budget_view_BudgetEstimate" class="economic_class_budget_view_BudgetEstimate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $economic_class_budget_view_list->BudgetEstimate->caption() ?></span><span class="ew-table-header-sort"><?php if ($economic_class_budget_view_list->BudgetEstimate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($economic_class_budget_view_list->BudgetEstimate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($economic_class_budget_view_list->ApprovedBudget->Visible) { // ApprovedBudget ?>
	<?php if ($economic_class_budget_view_list->SortUrl($economic_class_budget_view_list->ApprovedBudget) == "") { ?>
		<th data-name="ApprovedBudget" class="<?php echo $economic_class_budget_view_list->ApprovedBudget->headerCellClass() ?>"><div id="elh_economic_class_budget_view_ApprovedBudget" class="economic_class_budget_view_ApprovedBudget"><div class="ew-table-header-caption"><?php echo $economic_class_budget_view_list->ApprovedBudget->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ApprovedBudget" class="<?php echo $economic_class_budget_view_list->ApprovedBudget->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $economic_class_budget_view_list->SortUrl($economic_class_budget_view_list->ApprovedBudget) ?>', 1);"><div id="elh_economic_class_budget_view_ApprovedBudget" class="economic_class_budget_view_ApprovedBudget">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $economic_class_budget_view_list->ApprovedBudget->caption() ?></span><span class="ew-table-header-sort"><?php if ($economic_class_budget_view_list->ApprovedBudget->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($economic_class_budget_view_list->ApprovedBudget->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($economic_class_budget_view_list->ActualAmount->Visible) { // ActualAmount ?>
	<?php if ($economic_class_budget_view_list->SortUrl($economic_class_budget_view_list->ActualAmount) == "") { ?>
		<th data-name="ActualAmount" class="<?php echo $economic_class_budget_view_list->ActualAmount->headerCellClass() ?>"><div id="elh_economic_class_budget_view_ActualAmount" class="economic_class_budget_view_ActualAmount"><div class="ew-table-header-caption"><?php echo $economic_class_budget_view_list->ActualAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActualAmount" class="<?php echo $economic_class_budget_view_list->ActualAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $economic_class_budget_view_list->SortUrl($economic_class_budget_view_list->ActualAmount) ?>', 1);"><div id="elh_economic_class_budget_view_ActualAmount" class="economic_class_budget_view_ActualAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $economic_class_budget_view_list->ActualAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($economic_class_budget_view_list->ActualAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($economic_class_budget_view_list->ActualAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$economic_class_budget_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($economic_class_budget_view_list->ExportAll && $economic_class_budget_view_list->isExport()) {
	$economic_class_budget_view_list->StopRecord = $economic_class_budget_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($economic_class_budget_view_list->TotalRecords > $economic_class_budget_view_list->StartRecord + $economic_class_budget_view_list->DisplayRecords - 1)
		$economic_class_budget_view_list->StopRecord = $economic_class_budget_view_list->StartRecord + $economic_class_budget_view_list->DisplayRecords - 1;
	else
		$economic_class_budget_view_list->StopRecord = $economic_class_budget_view_list->TotalRecords;
}
$economic_class_budget_view_list->RecordCount = $economic_class_budget_view_list->StartRecord - 1;
if ($economic_class_budget_view_list->Recordset && !$economic_class_budget_view_list->Recordset->EOF) {
	$economic_class_budget_view_list->Recordset->moveFirst();
	$selectLimit = $economic_class_budget_view_list->UseSelectLimit;
	if (!$selectLimit && $economic_class_budget_view_list->StartRecord > 1)
		$economic_class_budget_view_list->Recordset->move($economic_class_budget_view_list->StartRecord - 1);
} elseif (!$economic_class_budget_view->AllowAddDeleteRow && $economic_class_budget_view_list->StopRecord == 0) {
	$economic_class_budget_view_list->StopRecord = $economic_class_budget_view->GridAddRowCount;
}

// Initialize aggregate
$economic_class_budget_view->RowType = ROWTYPE_AGGREGATEINIT;
$economic_class_budget_view->resetAttributes();
$economic_class_budget_view_list->renderRow();
while ($economic_class_budget_view_list->RecordCount < $economic_class_budget_view_list->StopRecord) {
	$economic_class_budget_view_list->RecordCount++;
	if ($economic_class_budget_view_list->RecordCount >= $economic_class_budget_view_list->StartRecord) {
		$economic_class_budget_view_list->RowCount++;

		// Set up key count
		$economic_class_budget_view_list->KeyCount = $economic_class_budget_view_list->RowIndex;

		// Init row class and style
		$economic_class_budget_view->resetAttributes();
		$economic_class_budget_view->CssClass = "";
		if ($economic_class_budget_view_list->isGridAdd()) {
		} else {
			$economic_class_budget_view_list->loadRowValues($economic_class_budget_view_list->Recordset); // Load row values
		}
		$economic_class_budget_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$economic_class_budget_view->RowAttrs->merge(["data-rowindex" => $economic_class_budget_view_list->RowCount, "id" => "r" . $economic_class_budget_view_list->RowCount . "_economic_class_budget_view", "data-rowtype" => $economic_class_budget_view->RowType]);

		// Render row
		$economic_class_budget_view_list->renderRow();

		// Render list options
		$economic_class_budget_view_list->renderListOptions();
?>
	<tr <?php echo $economic_class_budget_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$economic_class_budget_view_list->ListOptions->render("body", "left", $economic_class_budget_view_list->RowCount);
?>
	<?php if ($economic_class_budget_view_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $economic_class_budget_view_list->LACode->cellAttributes() ?>>
<span id="el<?php echo $economic_class_budget_view_list->RowCount ?>_economic_class_budget_view_LACode">
<span<?php echo $economic_class_budget_view_list->LACode->viewAttributes() ?>><?php echo $economic_class_budget_view_list->LACode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($economic_class_budget_view_list->LAName->Visible) { // LAName ?>
		<td data-name="LAName" <?php echo $economic_class_budget_view_list->LAName->cellAttributes() ?>>
<span id="el<?php echo $economic_class_budget_view_list->RowCount ?>_economic_class_budget_view_LAName">
<span<?php echo $economic_class_budget_view_list->LAName->viewAttributes() ?>><?php echo $economic_class_budget_view_list->LAName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($economic_class_budget_view_list->AccountGroupCode->Visible) { // AccountGroupCode ?>
		<td data-name="AccountGroupCode" <?php echo $economic_class_budget_view_list->AccountGroupCode->cellAttributes() ?>>
<span id="el<?php echo $economic_class_budget_view_list->RowCount ?>_economic_class_budget_view_AccountGroupCode">
<span<?php echo $economic_class_budget_view_list->AccountGroupCode->viewAttributes() ?>><?php echo $economic_class_budget_view_list->AccountGroupCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($economic_class_budget_view_list->AccountGroupName->Visible) { // AccountGroupName ?>
		<td data-name="AccountGroupName" <?php echo $economic_class_budget_view_list->AccountGroupName->cellAttributes() ?>>
<span id="el<?php echo $economic_class_budget_view_list->RowCount ?>_economic_class_budget_view_AccountGroupName">
<span<?php echo $economic_class_budget_view_list->AccountGroupName->viewAttributes() ?>><?php echo $economic_class_budget_view_list->AccountGroupName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($economic_class_budget_view_list->AccountCode->Visible) { // AccountCode ?>
		<td data-name="AccountCode" <?php echo $economic_class_budget_view_list->AccountCode->cellAttributes() ?>>
<span id="el<?php echo $economic_class_budget_view_list->RowCount ?>_economic_class_budget_view_AccountCode">
<span<?php echo $economic_class_budget_view_list->AccountCode->viewAttributes() ?>><?php echo $economic_class_budget_view_list->AccountCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($economic_class_budget_view_list->AccountName->Visible) { // AccountName ?>
		<td data-name="AccountName" <?php echo $economic_class_budget_view_list->AccountName->cellAttributes() ?>>
<span id="el<?php echo $economic_class_budget_view_list->RowCount ?>_economic_class_budget_view_AccountName">
<span<?php echo $economic_class_budget_view_list->AccountName->viewAttributes() ?>><?php echo $economic_class_budget_view_list->AccountName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($economic_class_budget_view_list->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear" <?php echo $economic_class_budget_view_list->FinancialYear->cellAttributes() ?>>
<span id="el<?php echo $economic_class_budget_view_list->RowCount ?>_economic_class_budget_view_FinancialYear">
<span<?php echo $economic_class_budget_view_list->FinancialYear->viewAttributes() ?>><?php echo $economic_class_budget_view_list->FinancialYear->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($economic_class_budget_view_list->BudgetEstimate->Visible) { // BudgetEstimate ?>
		<td data-name="BudgetEstimate" <?php echo $economic_class_budget_view_list->BudgetEstimate->cellAttributes() ?>>
<span id="el<?php echo $economic_class_budget_view_list->RowCount ?>_economic_class_budget_view_BudgetEstimate">
<span<?php echo $economic_class_budget_view_list->BudgetEstimate->viewAttributes() ?>><?php echo $economic_class_budget_view_list->BudgetEstimate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($economic_class_budget_view_list->ApprovedBudget->Visible) { // ApprovedBudget ?>
		<td data-name="ApprovedBudget" <?php echo $economic_class_budget_view_list->ApprovedBudget->cellAttributes() ?>>
<span id="el<?php echo $economic_class_budget_view_list->RowCount ?>_economic_class_budget_view_ApprovedBudget">
<span<?php echo $economic_class_budget_view_list->ApprovedBudget->viewAttributes() ?>><?php echo $economic_class_budget_view_list->ApprovedBudget->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($economic_class_budget_view_list->ActualAmount->Visible) { // ActualAmount ?>
		<td data-name="ActualAmount" <?php echo $economic_class_budget_view_list->ActualAmount->cellAttributes() ?>>
<span id="el<?php echo $economic_class_budget_view_list->RowCount ?>_economic_class_budget_view_ActualAmount">
<span<?php echo $economic_class_budget_view_list->ActualAmount->viewAttributes() ?>><?php echo $economic_class_budget_view_list->ActualAmount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$economic_class_budget_view_list->ListOptions->render("body", "right", $economic_class_budget_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$economic_class_budget_view_list->isGridAdd())
		$economic_class_budget_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$economic_class_budget_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($economic_class_budget_view_list->Recordset)
	$economic_class_budget_view_list->Recordset->Close();
?>
<?php if (!$economic_class_budget_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$economic_class_budget_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $economic_class_budget_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $economic_class_budget_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($economic_class_budget_view_list->TotalRecords == 0 && !$economic_class_budget_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $economic_class_budget_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$economic_class_budget_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$economic_class_budget_view_list->isExport()) { ?>
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
$economic_class_budget_view_list->terminate();
?>