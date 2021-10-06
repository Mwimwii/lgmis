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
$budget_allocate_prog_view_list = new budget_allocate_prog_view_list();

// Run the page
$budget_allocate_prog_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$budget_allocate_prog_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$budget_allocate_prog_view_list->isExport()) { ?>
<script>
var fbudget_allocate_prog_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fbudget_allocate_prog_viewlist = currentForm = new ew.Form("fbudget_allocate_prog_viewlist", "list");
	fbudget_allocate_prog_viewlist.formKeyCountName = '<?php echo $budget_allocate_prog_view_list->FormKeyCountName ?>';
	loadjs.done("fbudget_allocate_prog_viewlist");
});
var fbudget_allocate_prog_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fbudget_allocate_prog_viewlistsrch = currentSearchForm = new ew.Form("fbudget_allocate_prog_viewlistsrch");

	// Dynamic selection lists
	// Filters

	fbudget_allocate_prog_viewlistsrch.filterList = <?php echo $budget_allocate_prog_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	fbudget_allocate_prog_viewlistsrch.initSearchPanel = true;
	loadjs.done("fbudget_allocate_prog_viewlistsrch");
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
<?php if (!$budget_allocate_prog_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($budget_allocate_prog_view_list->TotalRecords > 0 && $budget_allocate_prog_view_list->ExportOptions->visible()) { ?>
<?php $budget_allocate_prog_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($budget_allocate_prog_view_list->ImportOptions->visible()) { ?>
<?php $budget_allocate_prog_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($budget_allocate_prog_view_list->SearchOptions->visible()) { ?>
<?php $budget_allocate_prog_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($budget_allocate_prog_view_list->FilterOptions->visible()) { ?>
<?php $budget_allocate_prog_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$budget_allocate_prog_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$budget_allocate_prog_view_list->isExport() && !$budget_allocate_prog_view->CurrentAction) { ?>
<form name="fbudget_allocate_prog_viewlistsrch" id="fbudget_allocate_prog_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fbudget_allocate_prog_viewlistsrch-search-panel" class="<?php echo $budget_allocate_prog_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="budget_allocate_prog_view">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $budget_allocate_prog_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($budget_allocate_prog_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($budget_allocate_prog_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $budget_allocate_prog_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($budget_allocate_prog_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($budget_allocate_prog_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($budget_allocate_prog_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($budget_allocate_prog_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $budget_allocate_prog_view_list->showPageHeader(); ?>
<?php
$budget_allocate_prog_view_list->showMessage();
?>
<?php if ($budget_allocate_prog_view_list->TotalRecords > 0 || $budget_allocate_prog_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($budget_allocate_prog_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> budget_allocate_prog_view">
<?php if (!$budget_allocate_prog_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$budget_allocate_prog_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $budget_allocate_prog_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $budget_allocate_prog_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fbudget_allocate_prog_viewlist" id="fbudget_allocate_prog_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="budget_allocate_prog_view">
<div id="gmp_budget_allocate_prog_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($budget_allocate_prog_view_list->TotalRecords > 0 || $budget_allocate_prog_view_list->isGridEdit()) { ?>
<table id="tbl_budget_allocate_prog_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$budget_allocate_prog_view->RowType = ROWTYPE_HEADER;

// Render list options
$budget_allocate_prog_view_list->renderListOptions();

// Render list options (header, left)
$budget_allocate_prog_view_list->ListOptions->render("header", "left");
?>
<?php if ($budget_allocate_prog_view_list->LACode->Visible) { // LACode ?>
	<?php if ($budget_allocate_prog_view_list->SortUrl($budget_allocate_prog_view_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $budget_allocate_prog_view_list->LACode->headerCellClass() ?>"><div id="elh_budget_allocate_prog_view_LACode" class="budget_allocate_prog_view_LACode"><div class="ew-table-header-caption"><?php echo $budget_allocate_prog_view_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $budget_allocate_prog_view_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_allocate_prog_view_list->SortUrl($budget_allocate_prog_view_list->LACode) ?>', 1);"><div id="elh_budget_allocate_prog_view_LACode" class="budget_allocate_prog_view_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_allocate_prog_view_list->LACode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($budget_allocate_prog_view_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_allocate_prog_view_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_allocate_prog_view_list->LAName->Visible) { // LAName ?>
	<?php if ($budget_allocate_prog_view_list->SortUrl($budget_allocate_prog_view_list->LAName) == "") { ?>
		<th data-name="LAName" class="<?php echo $budget_allocate_prog_view_list->LAName->headerCellClass() ?>"><div id="elh_budget_allocate_prog_view_LAName" class="budget_allocate_prog_view_LAName"><div class="ew-table-header-caption"><?php echo $budget_allocate_prog_view_list->LAName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LAName" class="<?php echo $budget_allocate_prog_view_list->LAName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_allocate_prog_view_list->SortUrl($budget_allocate_prog_view_list->LAName) ?>', 1);"><div id="elh_budget_allocate_prog_view_LAName" class="budget_allocate_prog_view_LAName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_allocate_prog_view_list->LAName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($budget_allocate_prog_view_list->LAName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_allocate_prog_view_list->LAName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_allocate_prog_view_list->ProgramCode->Visible) { // ProgramCode ?>
	<?php if ($budget_allocate_prog_view_list->SortUrl($budget_allocate_prog_view_list->ProgramCode) == "") { ?>
		<th data-name="ProgramCode" class="<?php echo $budget_allocate_prog_view_list->ProgramCode->headerCellClass() ?>"><div id="elh_budget_allocate_prog_view_ProgramCode" class="budget_allocate_prog_view_ProgramCode"><div class="ew-table-header-caption"><?php echo $budget_allocate_prog_view_list->ProgramCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgramCode" class="<?php echo $budget_allocate_prog_view_list->ProgramCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_allocate_prog_view_list->SortUrl($budget_allocate_prog_view_list->ProgramCode) ?>', 1);"><div id="elh_budget_allocate_prog_view_ProgramCode" class="budget_allocate_prog_view_ProgramCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_allocate_prog_view_list->ProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_allocate_prog_view_list->ProgramCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_allocate_prog_view_list->ProgramCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_allocate_prog_view_list->ProgramName->Visible) { // ProgramName ?>
	<?php if ($budget_allocate_prog_view_list->SortUrl($budget_allocate_prog_view_list->ProgramName) == "") { ?>
		<th data-name="ProgramName" class="<?php echo $budget_allocate_prog_view_list->ProgramName->headerCellClass() ?>"><div id="elh_budget_allocate_prog_view_ProgramName" class="budget_allocate_prog_view_ProgramName"><div class="ew-table-header-caption"><?php echo $budget_allocate_prog_view_list->ProgramName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgramName" class="<?php echo $budget_allocate_prog_view_list->ProgramName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_allocate_prog_view_list->SortUrl($budget_allocate_prog_view_list->ProgramName) ?>', 1);"><div id="elh_budget_allocate_prog_view_ProgramName" class="budget_allocate_prog_view_ProgramName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_allocate_prog_view_list->ProgramName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($budget_allocate_prog_view_list->ProgramName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_allocate_prog_view_list->ProgramName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_allocate_prog_view_list->ProgramPurpose->Visible) { // ProgramPurpose ?>
	<?php if ($budget_allocate_prog_view_list->SortUrl($budget_allocate_prog_view_list->ProgramPurpose) == "") { ?>
		<th data-name="ProgramPurpose" class="<?php echo $budget_allocate_prog_view_list->ProgramPurpose->headerCellClass() ?>"><div id="elh_budget_allocate_prog_view_ProgramPurpose" class="budget_allocate_prog_view_ProgramPurpose"><div class="ew-table-header-caption"><?php echo $budget_allocate_prog_view_list->ProgramPurpose->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgramPurpose" class="<?php echo $budget_allocate_prog_view_list->ProgramPurpose->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_allocate_prog_view_list->SortUrl($budget_allocate_prog_view_list->ProgramPurpose) ?>', 1);"><div id="elh_budget_allocate_prog_view_ProgramPurpose" class="budget_allocate_prog_view_ProgramPurpose">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_allocate_prog_view_list->ProgramPurpose->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($budget_allocate_prog_view_list->ProgramPurpose->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_allocate_prog_view_list->ProgramPurpose->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_allocate_prog_view_list->SubProgramCode->Visible) { // SubProgramCode ?>
	<?php if ($budget_allocate_prog_view_list->SortUrl($budget_allocate_prog_view_list->SubProgramCode) == "") { ?>
		<th data-name="SubProgramCode" class="<?php echo $budget_allocate_prog_view_list->SubProgramCode->headerCellClass() ?>"><div id="elh_budget_allocate_prog_view_SubProgramCode" class="budget_allocate_prog_view_SubProgramCode"><div class="ew-table-header-caption"><?php echo $budget_allocate_prog_view_list->SubProgramCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubProgramCode" class="<?php echo $budget_allocate_prog_view_list->SubProgramCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_allocate_prog_view_list->SortUrl($budget_allocate_prog_view_list->SubProgramCode) ?>', 1);"><div id="elh_budget_allocate_prog_view_SubProgramCode" class="budget_allocate_prog_view_SubProgramCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_allocate_prog_view_list->SubProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_allocate_prog_view_list->SubProgramCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_allocate_prog_view_list->SubProgramCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_allocate_prog_view_list->SubProgramName->Visible) { // SubProgramName ?>
	<?php if ($budget_allocate_prog_view_list->SortUrl($budget_allocate_prog_view_list->SubProgramName) == "") { ?>
		<th data-name="SubProgramName" class="<?php echo $budget_allocate_prog_view_list->SubProgramName->headerCellClass() ?>"><div id="elh_budget_allocate_prog_view_SubProgramName" class="budget_allocate_prog_view_SubProgramName"><div class="ew-table-header-caption"><?php echo $budget_allocate_prog_view_list->SubProgramName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubProgramName" class="<?php echo $budget_allocate_prog_view_list->SubProgramName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_allocate_prog_view_list->SortUrl($budget_allocate_prog_view_list->SubProgramName) ?>', 1);"><div id="elh_budget_allocate_prog_view_SubProgramName" class="budget_allocate_prog_view_SubProgramName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_allocate_prog_view_list->SubProgramName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($budget_allocate_prog_view_list->SubProgramName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_allocate_prog_view_list->SubProgramName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_allocate_prog_view_list->FinancialYear->Visible) { // FinancialYear ?>
	<?php if ($budget_allocate_prog_view_list->SortUrl($budget_allocate_prog_view_list->FinancialYear) == "") { ?>
		<th data-name="FinancialYear" class="<?php echo $budget_allocate_prog_view_list->FinancialYear->headerCellClass() ?>"><div id="elh_budget_allocate_prog_view_FinancialYear" class="budget_allocate_prog_view_FinancialYear"><div class="ew-table-header-caption"><?php echo $budget_allocate_prog_view_list->FinancialYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FinancialYear" class="<?php echo $budget_allocate_prog_view_list->FinancialYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_allocate_prog_view_list->SortUrl($budget_allocate_prog_view_list->FinancialYear) ?>', 1);"><div id="elh_budget_allocate_prog_view_FinancialYear" class="budget_allocate_prog_view_FinancialYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_allocate_prog_view_list->FinancialYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_allocate_prog_view_list->FinancialYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_allocate_prog_view_list->FinancialYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_allocate_prog_view_list->BudgetEstimate->Visible) { // BudgetEstimate ?>
	<?php if ($budget_allocate_prog_view_list->SortUrl($budget_allocate_prog_view_list->BudgetEstimate) == "") { ?>
		<th data-name="BudgetEstimate" class="<?php echo $budget_allocate_prog_view_list->BudgetEstimate->headerCellClass() ?>"><div id="elh_budget_allocate_prog_view_BudgetEstimate" class="budget_allocate_prog_view_BudgetEstimate"><div class="ew-table-header-caption"><?php echo $budget_allocate_prog_view_list->BudgetEstimate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BudgetEstimate" class="<?php echo $budget_allocate_prog_view_list->BudgetEstimate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_allocate_prog_view_list->SortUrl($budget_allocate_prog_view_list->BudgetEstimate) ?>', 1);"><div id="elh_budget_allocate_prog_view_BudgetEstimate" class="budget_allocate_prog_view_BudgetEstimate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_allocate_prog_view_list->BudgetEstimate->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_allocate_prog_view_list->BudgetEstimate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_allocate_prog_view_list->BudgetEstimate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_allocate_prog_view_list->ApprovedBudget->Visible) { // ApprovedBudget ?>
	<?php if ($budget_allocate_prog_view_list->SortUrl($budget_allocate_prog_view_list->ApprovedBudget) == "") { ?>
		<th data-name="ApprovedBudget" class="<?php echo $budget_allocate_prog_view_list->ApprovedBudget->headerCellClass() ?>"><div id="elh_budget_allocate_prog_view_ApprovedBudget" class="budget_allocate_prog_view_ApprovedBudget"><div class="ew-table-header-caption"><?php echo $budget_allocate_prog_view_list->ApprovedBudget->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ApprovedBudget" class="<?php echo $budget_allocate_prog_view_list->ApprovedBudget->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_allocate_prog_view_list->SortUrl($budget_allocate_prog_view_list->ApprovedBudget) ?>', 1);"><div id="elh_budget_allocate_prog_view_ApprovedBudget" class="budget_allocate_prog_view_ApprovedBudget">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_allocate_prog_view_list->ApprovedBudget->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_allocate_prog_view_list->ApprovedBudget->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_allocate_prog_view_list->ApprovedBudget->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_allocate_prog_view_list->ActualAmount->Visible) { // ActualAmount ?>
	<?php if ($budget_allocate_prog_view_list->SortUrl($budget_allocate_prog_view_list->ActualAmount) == "") { ?>
		<th data-name="ActualAmount" class="<?php echo $budget_allocate_prog_view_list->ActualAmount->headerCellClass() ?>"><div id="elh_budget_allocate_prog_view_ActualAmount" class="budget_allocate_prog_view_ActualAmount"><div class="ew-table-header-caption"><?php echo $budget_allocate_prog_view_list->ActualAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActualAmount" class="<?php echo $budget_allocate_prog_view_list->ActualAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_allocate_prog_view_list->SortUrl($budget_allocate_prog_view_list->ActualAmount) ?>', 1);"><div id="elh_budget_allocate_prog_view_ActualAmount" class="budget_allocate_prog_view_ActualAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_allocate_prog_view_list->ActualAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_allocate_prog_view_list->ActualAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_allocate_prog_view_list->ActualAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$budget_allocate_prog_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($budget_allocate_prog_view_list->ExportAll && $budget_allocate_prog_view_list->isExport()) {
	$budget_allocate_prog_view_list->StopRecord = $budget_allocate_prog_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($budget_allocate_prog_view_list->TotalRecords > $budget_allocate_prog_view_list->StartRecord + $budget_allocate_prog_view_list->DisplayRecords - 1)
		$budget_allocate_prog_view_list->StopRecord = $budget_allocate_prog_view_list->StartRecord + $budget_allocate_prog_view_list->DisplayRecords - 1;
	else
		$budget_allocate_prog_view_list->StopRecord = $budget_allocate_prog_view_list->TotalRecords;
}
$budget_allocate_prog_view_list->RecordCount = $budget_allocate_prog_view_list->StartRecord - 1;
if ($budget_allocate_prog_view_list->Recordset && !$budget_allocate_prog_view_list->Recordset->EOF) {
	$budget_allocate_prog_view_list->Recordset->moveFirst();
	$selectLimit = $budget_allocate_prog_view_list->UseSelectLimit;
	if (!$selectLimit && $budget_allocate_prog_view_list->StartRecord > 1)
		$budget_allocate_prog_view_list->Recordset->move($budget_allocate_prog_view_list->StartRecord - 1);
} elseif (!$budget_allocate_prog_view->AllowAddDeleteRow && $budget_allocate_prog_view_list->StopRecord == 0) {
	$budget_allocate_prog_view_list->StopRecord = $budget_allocate_prog_view->GridAddRowCount;
}

// Initialize aggregate
$budget_allocate_prog_view->RowType = ROWTYPE_AGGREGATEINIT;
$budget_allocate_prog_view->resetAttributes();
$budget_allocate_prog_view_list->renderRow();
while ($budget_allocate_prog_view_list->RecordCount < $budget_allocate_prog_view_list->StopRecord) {
	$budget_allocate_prog_view_list->RecordCount++;
	if ($budget_allocate_prog_view_list->RecordCount >= $budget_allocate_prog_view_list->StartRecord) {
		$budget_allocate_prog_view_list->RowCount++;

		// Set up key count
		$budget_allocate_prog_view_list->KeyCount = $budget_allocate_prog_view_list->RowIndex;

		// Init row class and style
		$budget_allocate_prog_view->resetAttributes();
		$budget_allocate_prog_view->CssClass = "";
		if ($budget_allocate_prog_view_list->isGridAdd()) {
		} else {
			$budget_allocate_prog_view_list->loadRowValues($budget_allocate_prog_view_list->Recordset); // Load row values
		}
		$budget_allocate_prog_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$budget_allocate_prog_view->RowAttrs->merge(["data-rowindex" => $budget_allocate_prog_view_list->RowCount, "id" => "r" . $budget_allocate_prog_view_list->RowCount . "_budget_allocate_prog_view", "data-rowtype" => $budget_allocate_prog_view->RowType]);

		// Render row
		$budget_allocate_prog_view_list->renderRow();

		// Render list options
		$budget_allocate_prog_view_list->renderListOptions();
?>
	<tr <?php echo $budget_allocate_prog_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$budget_allocate_prog_view_list->ListOptions->render("body", "left", $budget_allocate_prog_view_list->RowCount);
?>
	<?php if ($budget_allocate_prog_view_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $budget_allocate_prog_view_list->LACode->cellAttributes() ?>>
<span id="el<?php echo $budget_allocate_prog_view_list->RowCount ?>_budget_allocate_prog_view_LACode">
<span<?php echo $budget_allocate_prog_view_list->LACode->viewAttributes() ?>><?php echo $budget_allocate_prog_view_list->LACode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($budget_allocate_prog_view_list->LAName->Visible) { // LAName ?>
		<td data-name="LAName" <?php echo $budget_allocate_prog_view_list->LAName->cellAttributes() ?>>
<span id="el<?php echo $budget_allocate_prog_view_list->RowCount ?>_budget_allocate_prog_view_LAName">
<span<?php echo $budget_allocate_prog_view_list->LAName->viewAttributes() ?>><?php echo $budget_allocate_prog_view_list->LAName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($budget_allocate_prog_view_list->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode" <?php echo $budget_allocate_prog_view_list->ProgramCode->cellAttributes() ?>>
<span id="el<?php echo $budget_allocate_prog_view_list->RowCount ?>_budget_allocate_prog_view_ProgramCode">
<span<?php echo $budget_allocate_prog_view_list->ProgramCode->viewAttributes() ?>><?php echo $budget_allocate_prog_view_list->ProgramCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($budget_allocate_prog_view_list->ProgramName->Visible) { // ProgramName ?>
		<td data-name="ProgramName" <?php echo $budget_allocate_prog_view_list->ProgramName->cellAttributes() ?>>
<span id="el<?php echo $budget_allocate_prog_view_list->RowCount ?>_budget_allocate_prog_view_ProgramName">
<span<?php echo $budget_allocate_prog_view_list->ProgramName->viewAttributes() ?>><?php echo $budget_allocate_prog_view_list->ProgramName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($budget_allocate_prog_view_list->ProgramPurpose->Visible) { // ProgramPurpose ?>
		<td data-name="ProgramPurpose" <?php echo $budget_allocate_prog_view_list->ProgramPurpose->cellAttributes() ?>>
<span id="el<?php echo $budget_allocate_prog_view_list->RowCount ?>_budget_allocate_prog_view_ProgramPurpose">
<span<?php echo $budget_allocate_prog_view_list->ProgramPurpose->viewAttributes() ?>><?php echo $budget_allocate_prog_view_list->ProgramPurpose->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($budget_allocate_prog_view_list->SubProgramCode->Visible) { // SubProgramCode ?>
		<td data-name="SubProgramCode" <?php echo $budget_allocate_prog_view_list->SubProgramCode->cellAttributes() ?>>
<span id="el<?php echo $budget_allocate_prog_view_list->RowCount ?>_budget_allocate_prog_view_SubProgramCode">
<span<?php echo $budget_allocate_prog_view_list->SubProgramCode->viewAttributes() ?>><?php echo $budget_allocate_prog_view_list->SubProgramCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($budget_allocate_prog_view_list->SubProgramName->Visible) { // SubProgramName ?>
		<td data-name="SubProgramName" <?php echo $budget_allocate_prog_view_list->SubProgramName->cellAttributes() ?>>
<span id="el<?php echo $budget_allocate_prog_view_list->RowCount ?>_budget_allocate_prog_view_SubProgramName">
<span<?php echo $budget_allocate_prog_view_list->SubProgramName->viewAttributes() ?>><?php echo $budget_allocate_prog_view_list->SubProgramName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($budget_allocate_prog_view_list->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear" <?php echo $budget_allocate_prog_view_list->FinancialYear->cellAttributes() ?>>
<span id="el<?php echo $budget_allocate_prog_view_list->RowCount ?>_budget_allocate_prog_view_FinancialYear">
<span<?php echo $budget_allocate_prog_view_list->FinancialYear->viewAttributes() ?>><?php echo $budget_allocate_prog_view_list->FinancialYear->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($budget_allocate_prog_view_list->BudgetEstimate->Visible) { // BudgetEstimate ?>
		<td data-name="BudgetEstimate" <?php echo $budget_allocate_prog_view_list->BudgetEstimate->cellAttributes() ?>>
<span id="el<?php echo $budget_allocate_prog_view_list->RowCount ?>_budget_allocate_prog_view_BudgetEstimate">
<span<?php echo $budget_allocate_prog_view_list->BudgetEstimate->viewAttributes() ?>><?php echo $budget_allocate_prog_view_list->BudgetEstimate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($budget_allocate_prog_view_list->ApprovedBudget->Visible) { // ApprovedBudget ?>
		<td data-name="ApprovedBudget" <?php echo $budget_allocate_prog_view_list->ApprovedBudget->cellAttributes() ?>>
<span id="el<?php echo $budget_allocate_prog_view_list->RowCount ?>_budget_allocate_prog_view_ApprovedBudget">
<span<?php echo $budget_allocate_prog_view_list->ApprovedBudget->viewAttributes() ?>><?php echo $budget_allocate_prog_view_list->ApprovedBudget->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($budget_allocate_prog_view_list->ActualAmount->Visible) { // ActualAmount ?>
		<td data-name="ActualAmount" <?php echo $budget_allocate_prog_view_list->ActualAmount->cellAttributes() ?>>
<span id="el<?php echo $budget_allocate_prog_view_list->RowCount ?>_budget_allocate_prog_view_ActualAmount">
<span<?php echo $budget_allocate_prog_view_list->ActualAmount->viewAttributes() ?>><?php echo $budget_allocate_prog_view_list->ActualAmount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$budget_allocate_prog_view_list->ListOptions->render("body", "right", $budget_allocate_prog_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$budget_allocate_prog_view_list->isGridAdd())
		$budget_allocate_prog_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$budget_allocate_prog_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($budget_allocate_prog_view_list->Recordset)
	$budget_allocate_prog_view_list->Recordset->Close();
?>
<?php if (!$budget_allocate_prog_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$budget_allocate_prog_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $budget_allocate_prog_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $budget_allocate_prog_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($budget_allocate_prog_view_list->TotalRecords == 0 && !$budget_allocate_prog_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $budget_allocate_prog_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$budget_allocate_prog_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$budget_allocate_prog_view_list->isExport()) { ?>
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
$budget_allocate_prog_view_list->terminate();
?>