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
$program_budget_view_list = new program_budget_view_list();

// Run the page
$program_budget_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$program_budget_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$program_budget_view_list->isExport()) { ?>
<script>
var fprogram_budget_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fprogram_budget_viewlist = currentForm = new ew.Form("fprogram_budget_viewlist", "list");
	fprogram_budget_viewlist.formKeyCountName = '<?php echo $program_budget_view_list->FormKeyCountName ?>';
	loadjs.done("fprogram_budget_viewlist");
});
var fprogram_budget_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fprogram_budget_viewlistsrch = currentSearchForm = new ew.Form("fprogram_budget_viewlistsrch");

	// Dynamic selection lists
	// Filters

	fprogram_budget_viewlistsrch.filterList = <?php echo $program_budget_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	fprogram_budget_viewlistsrch.initSearchPanel = true;
	loadjs.done("fprogram_budget_viewlistsrch");
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
<?php if (!$program_budget_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($program_budget_view_list->TotalRecords > 0 && $program_budget_view_list->ExportOptions->visible()) { ?>
<?php $program_budget_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($program_budget_view_list->ImportOptions->visible()) { ?>
<?php $program_budget_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($program_budget_view_list->SearchOptions->visible()) { ?>
<?php $program_budget_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($program_budget_view_list->FilterOptions->visible()) { ?>
<?php $program_budget_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$program_budget_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$program_budget_view_list->isExport() && !$program_budget_view->CurrentAction) { ?>
<form name="fprogram_budget_viewlistsrch" id="fprogram_budget_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fprogram_budget_viewlistsrch-search-panel" class="<?php echo $program_budget_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="program_budget_view">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $program_budget_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($program_budget_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($program_budget_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $program_budget_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($program_budget_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($program_budget_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($program_budget_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($program_budget_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $program_budget_view_list->showPageHeader(); ?>
<?php
$program_budget_view_list->showMessage();
?>
<?php if ($program_budget_view_list->TotalRecords > 0 || $program_budget_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($program_budget_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> program_budget_view">
<?php if (!$program_budget_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$program_budget_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $program_budget_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $program_budget_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fprogram_budget_viewlist" id="fprogram_budget_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="program_budget_view">
<div id="gmp_program_budget_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($program_budget_view_list->TotalRecords > 0 || $program_budget_view_list->isGridEdit()) { ?>
<table id="tbl_program_budget_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$program_budget_view->RowType = ROWTYPE_HEADER;

// Render list options
$program_budget_view_list->renderListOptions();

// Render list options (header, left)
$program_budget_view_list->ListOptions->render("header", "left");
?>
<?php if ($program_budget_view_list->ProgramName->Visible) { // ProgramName ?>
	<?php if ($program_budget_view_list->SortUrl($program_budget_view_list->ProgramName) == "") { ?>
		<th data-name="ProgramName" class="<?php echo $program_budget_view_list->ProgramName->headerCellClass() ?>"><div id="elh_program_budget_view_ProgramName" class="program_budget_view_ProgramName"><div class="ew-table-header-caption"><?php echo $program_budget_view_list->ProgramName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgramName" class="<?php echo $program_budget_view_list->ProgramName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $program_budget_view_list->SortUrl($program_budget_view_list->ProgramName) ?>', 1);"><div id="elh_program_budget_view_ProgramName" class="program_budget_view_ProgramName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $program_budget_view_list->ProgramName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($program_budget_view_list->ProgramName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($program_budget_view_list->ProgramName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($program_budget_view_list->SubProgramName->Visible) { // SubProgramName ?>
	<?php if ($program_budget_view_list->SortUrl($program_budget_view_list->SubProgramName) == "") { ?>
		<th data-name="SubProgramName" class="<?php echo $program_budget_view_list->SubProgramName->headerCellClass() ?>"><div id="elh_program_budget_view_SubProgramName" class="program_budget_view_SubProgramName"><div class="ew-table-header-caption"><?php echo $program_budget_view_list->SubProgramName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubProgramName" class="<?php echo $program_budget_view_list->SubProgramName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $program_budget_view_list->SortUrl($program_budget_view_list->SubProgramName) ?>', 1);"><div id="elh_program_budget_view_SubProgramName" class="program_budget_view_SubProgramName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $program_budget_view_list->SubProgramName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($program_budget_view_list->SubProgramName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($program_budget_view_list->SubProgramName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($program_budget_view_list->LACode->Visible) { // LACode ?>
	<?php if ($program_budget_view_list->SortUrl($program_budget_view_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $program_budget_view_list->LACode->headerCellClass() ?>"><div id="elh_program_budget_view_LACode" class="program_budget_view_LACode"><div class="ew-table-header-caption"><?php echo $program_budget_view_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $program_budget_view_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $program_budget_view_list->SortUrl($program_budget_view_list->LACode) ?>', 1);"><div id="elh_program_budget_view_LACode" class="program_budget_view_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $program_budget_view_list->LACode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($program_budget_view_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($program_budget_view_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($program_budget_view_list->FinancialYear->Visible) { // FinancialYear ?>
	<?php if ($program_budget_view_list->SortUrl($program_budget_view_list->FinancialYear) == "") { ?>
		<th data-name="FinancialYear" class="<?php echo $program_budget_view_list->FinancialYear->headerCellClass() ?>"><div id="elh_program_budget_view_FinancialYear" class="program_budget_view_FinancialYear"><div class="ew-table-header-caption"><?php echo $program_budget_view_list->FinancialYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FinancialYear" class="<?php echo $program_budget_view_list->FinancialYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $program_budget_view_list->SortUrl($program_budget_view_list->FinancialYear) ?>', 1);"><div id="elh_program_budget_view_FinancialYear" class="program_budget_view_FinancialYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $program_budget_view_list->FinancialYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($program_budget_view_list->FinancialYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($program_budget_view_list->FinancialYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($program_budget_view_list->AccountCode->Visible) { // AccountCode ?>
	<?php if ($program_budget_view_list->SortUrl($program_budget_view_list->AccountCode) == "") { ?>
		<th data-name="AccountCode" class="<?php echo $program_budget_view_list->AccountCode->headerCellClass() ?>"><div id="elh_program_budget_view_AccountCode" class="program_budget_view_AccountCode"><div class="ew-table-header-caption"><?php echo $program_budget_view_list->AccountCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountCode" class="<?php echo $program_budget_view_list->AccountCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $program_budget_view_list->SortUrl($program_budget_view_list->AccountCode) ?>', 1);"><div id="elh_program_budget_view_AccountCode" class="program_budget_view_AccountCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $program_budget_view_list->AccountCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($program_budget_view_list->AccountCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($program_budget_view_list->AccountCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($program_budget_view_list->ActualAmount->Visible) { // ActualAmount ?>
	<?php if ($program_budget_view_list->SortUrl($program_budget_view_list->ActualAmount) == "") { ?>
		<th data-name="ActualAmount" class="<?php echo $program_budget_view_list->ActualAmount->headerCellClass() ?>"><div id="elh_program_budget_view_ActualAmount" class="program_budget_view_ActualAmount"><div class="ew-table-header-caption"><?php echo $program_budget_view_list->ActualAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActualAmount" class="<?php echo $program_budget_view_list->ActualAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $program_budget_view_list->SortUrl($program_budget_view_list->ActualAmount) ?>', 1);"><div id="elh_program_budget_view_ActualAmount" class="program_budget_view_ActualAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $program_budget_view_list->ActualAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($program_budget_view_list->ActualAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($program_budget_view_list->ActualAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($program_budget_view_list->AccountName->Visible) { // AccountName ?>
	<?php if ($program_budget_view_list->SortUrl($program_budget_view_list->AccountName) == "") { ?>
		<th data-name="AccountName" class="<?php echo $program_budget_view_list->AccountName->headerCellClass() ?>"><div id="elh_program_budget_view_AccountName" class="program_budget_view_AccountName"><div class="ew-table-header-caption"><?php echo $program_budget_view_list->AccountName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountName" class="<?php echo $program_budget_view_list->AccountName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $program_budget_view_list->SortUrl($program_budget_view_list->AccountName) ?>', 1);"><div id="elh_program_budget_view_AccountName" class="program_budget_view_AccountName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $program_budget_view_list->AccountName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($program_budget_view_list->AccountName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($program_budget_view_list->AccountName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($program_budget_view_list->AccountGroupName->Visible) { // AccountGroupName ?>
	<?php if ($program_budget_view_list->SortUrl($program_budget_view_list->AccountGroupName) == "") { ?>
		<th data-name="AccountGroupName" class="<?php echo $program_budget_view_list->AccountGroupName->headerCellClass() ?>"><div id="elh_program_budget_view_AccountGroupName" class="program_budget_view_AccountGroupName"><div class="ew-table-header-caption"><?php echo $program_budget_view_list->AccountGroupName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountGroupName" class="<?php echo $program_budget_view_list->AccountGroupName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $program_budget_view_list->SortUrl($program_budget_view_list->AccountGroupName) ?>', 1);"><div id="elh_program_budget_view_AccountGroupName" class="program_budget_view_AccountGroupName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $program_budget_view_list->AccountGroupName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($program_budget_view_list->AccountGroupName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($program_budget_view_list->AccountGroupName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($program_budget_view_list->BudgetEstimate->Visible) { // BudgetEstimate ?>
	<?php if ($program_budget_view_list->SortUrl($program_budget_view_list->BudgetEstimate) == "") { ?>
		<th data-name="BudgetEstimate" class="<?php echo $program_budget_view_list->BudgetEstimate->headerCellClass() ?>"><div id="elh_program_budget_view_BudgetEstimate" class="program_budget_view_BudgetEstimate"><div class="ew-table-header-caption"><?php echo $program_budget_view_list->BudgetEstimate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BudgetEstimate" class="<?php echo $program_budget_view_list->BudgetEstimate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $program_budget_view_list->SortUrl($program_budget_view_list->BudgetEstimate) ?>', 1);"><div id="elh_program_budget_view_BudgetEstimate" class="program_budget_view_BudgetEstimate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $program_budget_view_list->BudgetEstimate->caption() ?></span><span class="ew-table-header-sort"><?php if ($program_budget_view_list->BudgetEstimate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($program_budget_view_list->BudgetEstimate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($program_budget_view_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($program_budget_view_list->SortUrl($program_budget_view_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $program_budget_view_list->DepartmentCode->headerCellClass() ?>"><div id="elh_program_budget_view_DepartmentCode" class="program_budget_view_DepartmentCode"><div class="ew-table-header-caption"><?php echo $program_budget_view_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $program_budget_view_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $program_budget_view_list->SortUrl($program_budget_view_list->DepartmentCode) ?>', 1);"><div id="elh_program_budget_view_DepartmentCode" class="program_budget_view_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $program_budget_view_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($program_budget_view_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($program_budget_view_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($program_budget_view_list->SectionCode->Visible) { // SectionCode ?>
	<?php if ($program_budget_view_list->SortUrl($program_budget_view_list->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $program_budget_view_list->SectionCode->headerCellClass() ?>"><div id="elh_program_budget_view_SectionCode" class="program_budget_view_SectionCode"><div class="ew-table-header-caption"><?php echo $program_budget_view_list->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $program_budget_view_list->SectionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $program_budget_view_list->SortUrl($program_budget_view_list->SectionCode) ?>', 1);"><div id="elh_program_budget_view_SectionCode" class="program_budget_view_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $program_budget_view_list->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($program_budget_view_list->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($program_budget_view_list->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($program_budget_view_list->OutputCode->Visible) { // OutputCode ?>
	<?php if ($program_budget_view_list->SortUrl($program_budget_view_list->OutputCode) == "") { ?>
		<th data-name="OutputCode" class="<?php echo $program_budget_view_list->OutputCode->headerCellClass() ?>"><div id="elh_program_budget_view_OutputCode" class="program_budget_view_OutputCode"><div class="ew-table-header-caption"><?php echo $program_budget_view_list->OutputCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputCode" class="<?php echo $program_budget_view_list->OutputCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $program_budget_view_list->SortUrl($program_budget_view_list->OutputCode) ?>', 1);"><div id="elh_program_budget_view_OutputCode" class="program_budget_view_OutputCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $program_budget_view_list->OutputCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($program_budget_view_list->OutputCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($program_budget_view_list->OutputCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($program_budget_view_list->OutputName->Visible) { // OutputName ?>
	<?php if ($program_budget_view_list->SortUrl($program_budget_view_list->OutputName) == "") { ?>
		<th data-name="OutputName" class="<?php echo $program_budget_view_list->OutputName->headerCellClass() ?>"><div id="elh_program_budget_view_OutputName" class="program_budget_view_OutputName"><div class="ew-table-header-caption"><?php echo $program_budget_view_list->OutputName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputName" class="<?php echo $program_budget_view_list->OutputName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $program_budget_view_list->SortUrl($program_budget_view_list->OutputName) ?>', 1);"><div id="elh_program_budget_view_OutputName" class="program_budget_view_OutputName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $program_budget_view_list->OutputName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($program_budget_view_list->OutputName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($program_budget_view_list->OutputName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($program_budget_view_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<?php if ($program_budget_view_list->SortUrl($program_budget_view_list->UnitOfMeasure) == "") { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $program_budget_view_list->UnitOfMeasure->headerCellClass() ?>"><div id="elh_program_budget_view_UnitOfMeasure" class="program_budget_view_UnitOfMeasure"><div class="ew-table-header-caption"><?php echo $program_budget_view_list->UnitOfMeasure->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $program_budget_view_list->UnitOfMeasure->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $program_budget_view_list->SortUrl($program_budget_view_list->UnitOfMeasure) ?>', 1);"><div id="elh_program_budget_view_UnitOfMeasure" class="program_budget_view_UnitOfMeasure">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $program_budget_view_list->UnitOfMeasure->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($program_budget_view_list->UnitOfMeasure->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($program_budget_view_list->UnitOfMeasure->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($program_budget_view_list->Quantity->Visible) { // Quantity ?>
	<?php if ($program_budget_view_list->SortUrl($program_budget_view_list->Quantity) == "") { ?>
		<th data-name="Quantity" class="<?php echo $program_budget_view_list->Quantity->headerCellClass() ?>"><div id="elh_program_budget_view_Quantity" class="program_budget_view_Quantity"><div class="ew-table-header-caption"><?php echo $program_budget_view_list->Quantity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Quantity" class="<?php echo $program_budget_view_list->Quantity->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $program_budget_view_list->SortUrl($program_budget_view_list->Quantity) ?>', 1);"><div id="elh_program_budget_view_Quantity" class="program_budget_view_Quantity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $program_budget_view_list->Quantity->caption() ?></span><span class="ew-table-header-sort"><?php if ($program_budget_view_list->Quantity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($program_budget_view_list->Quantity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($program_budget_view_list->PeriodType->Visible) { // PeriodType ?>
	<?php if ($program_budget_view_list->SortUrl($program_budget_view_list->PeriodType) == "") { ?>
		<th data-name="PeriodType" class="<?php echo $program_budget_view_list->PeriodType->headerCellClass() ?>"><div id="elh_program_budget_view_PeriodType" class="program_budget_view_PeriodType"><div class="ew-table-header-caption"><?php echo $program_budget_view_list->PeriodType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodType" class="<?php echo $program_budget_view_list->PeriodType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $program_budget_view_list->SortUrl($program_budget_view_list->PeriodType) ?>', 1);"><div id="elh_program_budget_view_PeriodType" class="program_budget_view_PeriodType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $program_budget_view_list->PeriodType->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($program_budget_view_list->PeriodType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($program_budget_view_list->PeriodType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($program_budget_view_list->PeriodLength->Visible) { // PeriodLength ?>
	<?php if ($program_budget_view_list->SortUrl($program_budget_view_list->PeriodLength) == "") { ?>
		<th data-name="PeriodLength" class="<?php echo $program_budget_view_list->PeriodLength->headerCellClass() ?>"><div id="elh_program_budget_view_PeriodLength" class="program_budget_view_PeriodLength"><div class="ew-table-header-caption"><?php echo $program_budget_view_list->PeriodLength->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodLength" class="<?php echo $program_budget_view_list->PeriodLength->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $program_budget_view_list->SortUrl($program_budget_view_list->PeriodLength) ?>', 1);"><div id="elh_program_budget_view_PeriodLength" class="program_budget_view_PeriodLength">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $program_budget_view_list->PeriodLength->caption() ?></span><span class="ew-table-header-sort"><?php if ($program_budget_view_list->PeriodLength->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($program_budget_view_list->PeriodLength->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($program_budget_view_list->Frequency->Visible) { // Frequency ?>
	<?php if ($program_budget_view_list->SortUrl($program_budget_view_list->Frequency) == "") { ?>
		<th data-name="Frequency" class="<?php echo $program_budget_view_list->Frequency->headerCellClass() ?>"><div id="elh_program_budget_view_Frequency" class="program_budget_view_Frequency"><div class="ew-table-header-caption"><?php echo $program_budget_view_list->Frequency->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Frequency" class="<?php echo $program_budget_view_list->Frequency->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $program_budget_view_list->SortUrl($program_budget_view_list->Frequency) ?>', 1);"><div id="elh_program_budget_view_Frequency" class="program_budget_view_Frequency">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $program_budget_view_list->Frequency->caption() ?></span><span class="ew-table-header-sort"><?php if ($program_budget_view_list->Frequency->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($program_budget_view_list->Frequency->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($program_budget_view_list->UnitCost->Visible) { // UnitCost ?>
	<?php if ($program_budget_view_list->SortUrl($program_budget_view_list->UnitCost) == "") { ?>
		<th data-name="UnitCost" class="<?php echo $program_budget_view_list->UnitCost->headerCellClass() ?>"><div id="elh_program_budget_view_UnitCost" class="program_budget_view_UnitCost"><div class="ew-table-header-caption"><?php echo $program_budget_view_list->UnitCost->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitCost" class="<?php echo $program_budget_view_list->UnitCost->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $program_budget_view_list->SortUrl($program_budget_view_list->UnitCost) ?>', 1);"><div id="elh_program_budget_view_UnitCost" class="program_budget_view_UnitCost">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $program_budget_view_list->UnitCost->caption() ?></span><span class="ew-table-header-sort"><?php if ($program_budget_view_list->UnitCost->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($program_budget_view_list->UnitCost->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$program_budget_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($program_budget_view_list->ExportAll && $program_budget_view_list->isExport()) {
	$program_budget_view_list->StopRecord = $program_budget_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($program_budget_view_list->TotalRecords > $program_budget_view_list->StartRecord + $program_budget_view_list->DisplayRecords - 1)
		$program_budget_view_list->StopRecord = $program_budget_view_list->StartRecord + $program_budget_view_list->DisplayRecords - 1;
	else
		$program_budget_view_list->StopRecord = $program_budget_view_list->TotalRecords;
}
$program_budget_view_list->RecordCount = $program_budget_view_list->StartRecord - 1;
if ($program_budget_view_list->Recordset && !$program_budget_view_list->Recordset->EOF) {
	$program_budget_view_list->Recordset->moveFirst();
	$selectLimit = $program_budget_view_list->UseSelectLimit;
	if (!$selectLimit && $program_budget_view_list->StartRecord > 1)
		$program_budget_view_list->Recordset->move($program_budget_view_list->StartRecord - 1);
} elseif (!$program_budget_view->AllowAddDeleteRow && $program_budget_view_list->StopRecord == 0) {
	$program_budget_view_list->StopRecord = $program_budget_view->GridAddRowCount;
}

// Initialize aggregate
$program_budget_view->RowType = ROWTYPE_AGGREGATEINIT;
$program_budget_view->resetAttributes();
$program_budget_view_list->renderRow();
while ($program_budget_view_list->RecordCount < $program_budget_view_list->StopRecord) {
	$program_budget_view_list->RecordCount++;
	if ($program_budget_view_list->RecordCount >= $program_budget_view_list->StartRecord) {
		$program_budget_view_list->RowCount++;

		// Set up key count
		$program_budget_view_list->KeyCount = $program_budget_view_list->RowIndex;

		// Init row class and style
		$program_budget_view->resetAttributes();
		$program_budget_view->CssClass = "";
		if ($program_budget_view_list->isGridAdd()) {
		} else {
			$program_budget_view_list->loadRowValues($program_budget_view_list->Recordset); // Load row values
		}
		$program_budget_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$program_budget_view->RowAttrs->merge(["data-rowindex" => $program_budget_view_list->RowCount, "id" => "r" . $program_budget_view_list->RowCount . "_program_budget_view", "data-rowtype" => $program_budget_view->RowType]);

		// Render row
		$program_budget_view_list->renderRow();

		// Render list options
		$program_budget_view_list->renderListOptions();
?>
	<tr <?php echo $program_budget_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$program_budget_view_list->ListOptions->render("body", "left", $program_budget_view_list->RowCount);
?>
	<?php if ($program_budget_view_list->ProgramName->Visible) { // ProgramName ?>
		<td data-name="ProgramName" <?php echo $program_budget_view_list->ProgramName->cellAttributes() ?>>
<span id="el<?php echo $program_budget_view_list->RowCount ?>_program_budget_view_ProgramName">
<span<?php echo $program_budget_view_list->ProgramName->viewAttributes() ?>><?php echo $program_budget_view_list->ProgramName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($program_budget_view_list->SubProgramName->Visible) { // SubProgramName ?>
		<td data-name="SubProgramName" <?php echo $program_budget_view_list->SubProgramName->cellAttributes() ?>>
<span id="el<?php echo $program_budget_view_list->RowCount ?>_program_budget_view_SubProgramName">
<span<?php echo $program_budget_view_list->SubProgramName->viewAttributes() ?>><?php echo $program_budget_view_list->SubProgramName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($program_budget_view_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $program_budget_view_list->LACode->cellAttributes() ?>>
<span id="el<?php echo $program_budget_view_list->RowCount ?>_program_budget_view_LACode">
<span<?php echo $program_budget_view_list->LACode->viewAttributes() ?>><?php echo $program_budget_view_list->LACode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($program_budget_view_list->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear" <?php echo $program_budget_view_list->FinancialYear->cellAttributes() ?>>
<span id="el<?php echo $program_budget_view_list->RowCount ?>_program_budget_view_FinancialYear">
<span<?php echo $program_budget_view_list->FinancialYear->viewAttributes() ?>><?php echo $program_budget_view_list->FinancialYear->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($program_budget_view_list->AccountCode->Visible) { // AccountCode ?>
		<td data-name="AccountCode" <?php echo $program_budget_view_list->AccountCode->cellAttributes() ?>>
<span id="el<?php echo $program_budget_view_list->RowCount ?>_program_budget_view_AccountCode">
<span<?php echo $program_budget_view_list->AccountCode->viewAttributes() ?>><?php echo $program_budget_view_list->AccountCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($program_budget_view_list->ActualAmount->Visible) { // ActualAmount ?>
		<td data-name="ActualAmount" <?php echo $program_budget_view_list->ActualAmount->cellAttributes() ?>>
<span id="el<?php echo $program_budget_view_list->RowCount ?>_program_budget_view_ActualAmount">
<span<?php echo $program_budget_view_list->ActualAmount->viewAttributes() ?>><?php echo $program_budget_view_list->ActualAmount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($program_budget_view_list->AccountName->Visible) { // AccountName ?>
		<td data-name="AccountName" <?php echo $program_budget_view_list->AccountName->cellAttributes() ?>>
<span id="el<?php echo $program_budget_view_list->RowCount ?>_program_budget_view_AccountName">
<span<?php echo $program_budget_view_list->AccountName->viewAttributes() ?>><?php echo $program_budget_view_list->AccountName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($program_budget_view_list->AccountGroupName->Visible) { // AccountGroupName ?>
		<td data-name="AccountGroupName" <?php echo $program_budget_view_list->AccountGroupName->cellAttributes() ?>>
<span id="el<?php echo $program_budget_view_list->RowCount ?>_program_budget_view_AccountGroupName">
<span<?php echo $program_budget_view_list->AccountGroupName->viewAttributes() ?>><?php echo $program_budget_view_list->AccountGroupName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($program_budget_view_list->BudgetEstimate->Visible) { // BudgetEstimate ?>
		<td data-name="BudgetEstimate" <?php echo $program_budget_view_list->BudgetEstimate->cellAttributes() ?>>
<span id="el<?php echo $program_budget_view_list->RowCount ?>_program_budget_view_BudgetEstimate">
<span<?php echo $program_budget_view_list->BudgetEstimate->viewAttributes() ?>><?php echo $program_budget_view_list->BudgetEstimate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($program_budget_view_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $program_budget_view_list->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $program_budget_view_list->RowCount ?>_program_budget_view_DepartmentCode">
<span<?php echo $program_budget_view_list->DepartmentCode->viewAttributes() ?>><?php echo $program_budget_view_list->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($program_budget_view_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $program_budget_view_list->SectionCode->cellAttributes() ?>>
<span id="el<?php echo $program_budget_view_list->RowCount ?>_program_budget_view_SectionCode">
<span<?php echo $program_budget_view_list->SectionCode->viewAttributes() ?>><?php echo $program_budget_view_list->SectionCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($program_budget_view_list->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode" <?php echo $program_budget_view_list->OutputCode->cellAttributes() ?>>
<span id="el<?php echo $program_budget_view_list->RowCount ?>_program_budget_view_OutputCode">
<span<?php echo $program_budget_view_list->OutputCode->viewAttributes() ?>><?php echo $program_budget_view_list->OutputCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($program_budget_view_list->OutputName->Visible) { // OutputName ?>
		<td data-name="OutputName" <?php echo $program_budget_view_list->OutputName->cellAttributes() ?>>
<span id="el<?php echo $program_budget_view_list->RowCount ?>_program_budget_view_OutputName">
<span<?php echo $program_budget_view_list->OutputName->viewAttributes() ?>><?php echo $program_budget_view_list->OutputName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($program_budget_view_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" <?php echo $program_budget_view_list->UnitOfMeasure->cellAttributes() ?>>
<span id="el<?php echo $program_budget_view_list->RowCount ?>_program_budget_view_UnitOfMeasure">
<span<?php echo $program_budget_view_list->UnitOfMeasure->viewAttributes() ?>><?php echo $program_budget_view_list->UnitOfMeasure->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($program_budget_view_list->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity" <?php echo $program_budget_view_list->Quantity->cellAttributes() ?>>
<span id="el<?php echo $program_budget_view_list->RowCount ?>_program_budget_view_Quantity">
<span<?php echo $program_budget_view_list->Quantity->viewAttributes() ?>><?php echo $program_budget_view_list->Quantity->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($program_budget_view_list->PeriodType->Visible) { // PeriodType ?>
		<td data-name="PeriodType" <?php echo $program_budget_view_list->PeriodType->cellAttributes() ?>>
<span id="el<?php echo $program_budget_view_list->RowCount ?>_program_budget_view_PeriodType">
<span<?php echo $program_budget_view_list->PeriodType->viewAttributes() ?>><?php echo $program_budget_view_list->PeriodType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($program_budget_view_list->PeriodLength->Visible) { // PeriodLength ?>
		<td data-name="PeriodLength" <?php echo $program_budget_view_list->PeriodLength->cellAttributes() ?>>
<span id="el<?php echo $program_budget_view_list->RowCount ?>_program_budget_view_PeriodLength">
<span<?php echo $program_budget_view_list->PeriodLength->viewAttributes() ?>><?php echo $program_budget_view_list->PeriodLength->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($program_budget_view_list->Frequency->Visible) { // Frequency ?>
		<td data-name="Frequency" <?php echo $program_budget_view_list->Frequency->cellAttributes() ?>>
<span id="el<?php echo $program_budget_view_list->RowCount ?>_program_budget_view_Frequency">
<span<?php echo $program_budget_view_list->Frequency->viewAttributes() ?>><?php echo $program_budget_view_list->Frequency->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($program_budget_view_list->UnitCost->Visible) { // UnitCost ?>
		<td data-name="UnitCost" <?php echo $program_budget_view_list->UnitCost->cellAttributes() ?>>
<span id="el<?php echo $program_budget_view_list->RowCount ?>_program_budget_view_UnitCost">
<span<?php echo $program_budget_view_list->UnitCost->viewAttributes() ?>><?php echo $program_budget_view_list->UnitCost->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$program_budget_view_list->ListOptions->render("body", "right", $program_budget_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$program_budget_view_list->isGridAdd())
		$program_budget_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$program_budget_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($program_budget_view_list->Recordset)
	$program_budget_view_list->Recordset->Close();
?>
<?php if (!$program_budget_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$program_budget_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $program_budget_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $program_budget_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($program_budget_view_list->TotalRecords == 0 && !$program_budget_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $program_budget_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$program_budget_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$program_budget_view_list->isExport()) { ?>
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
$program_budget_view_list->terminate();
?>