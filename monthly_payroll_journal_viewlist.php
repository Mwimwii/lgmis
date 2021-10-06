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
$monthly_payroll_journal_view_list = new monthly_payroll_journal_view_list();

// Run the page
$monthly_payroll_journal_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$monthly_payroll_journal_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$monthly_payroll_journal_view_list->isExport()) { ?>
<script>
var fmonthly_payroll_journal_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmonthly_payroll_journal_viewlist = currentForm = new ew.Form("fmonthly_payroll_journal_viewlist", "list");
	fmonthly_payroll_journal_viewlist.formKeyCountName = '<?php echo $monthly_payroll_journal_view_list->FormKeyCountName ?>';
	loadjs.done("fmonthly_payroll_journal_viewlist");
});
var fmonthly_payroll_journal_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmonthly_payroll_journal_viewlistsrch = currentSearchForm = new ew.Form("fmonthly_payroll_journal_viewlistsrch");

	// Dynamic selection lists
	// Filters

	fmonthly_payroll_journal_viewlistsrch.filterList = <?php echo $monthly_payroll_journal_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	fmonthly_payroll_journal_viewlistsrch.initSearchPanel = true;
	loadjs.done("fmonthly_payroll_journal_viewlistsrch");
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
<?php if (!$monthly_payroll_journal_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($monthly_payroll_journal_view_list->TotalRecords > 0 && $monthly_payroll_journal_view_list->ExportOptions->visible()) { ?>
<?php $monthly_payroll_journal_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($monthly_payroll_journal_view_list->ImportOptions->visible()) { ?>
<?php $monthly_payroll_journal_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($monthly_payroll_journal_view_list->SearchOptions->visible()) { ?>
<?php $monthly_payroll_journal_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($monthly_payroll_journal_view_list->FilterOptions->visible()) { ?>
<?php $monthly_payroll_journal_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$monthly_payroll_journal_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$monthly_payroll_journal_view_list->isExport() && !$monthly_payroll_journal_view->CurrentAction) { ?>
<form name="fmonthly_payroll_journal_viewlistsrch" id="fmonthly_payroll_journal_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmonthly_payroll_journal_viewlistsrch-search-panel" class="<?php echo $monthly_payroll_journal_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="monthly_payroll_journal_view">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $monthly_payroll_journal_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($monthly_payroll_journal_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($monthly_payroll_journal_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $monthly_payroll_journal_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($monthly_payroll_journal_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($monthly_payroll_journal_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($monthly_payroll_journal_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($monthly_payroll_journal_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $monthly_payroll_journal_view_list->showPageHeader(); ?>
<?php
$monthly_payroll_journal_view_list->showMessage();
?>
<?php if ($monthly_payroll_journal_view_list->TotalRecords > 0 || $monthly_payroll_journal_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($monthly_payroll_journal_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> monthly_payroll_journal_view">
<?php if (!$monthly_payroll_journal_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$monthly_payroll_journal_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $monthly_payroll_journal_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $monthly_payroll_journal_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmonthly_payroll_journal_viewlist" id="fmonthly_payroll_journal_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="monthly_payroll_journal_view">
<div id="gmp_monthly_payroll_journal_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($monthly_payroll_journal_view_list->TotalRecords > 0 || $monthly_payroll_journal_view_list->isGridEdit()) { ?>
<table id="tbl_monthly_payroll_journal_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$monthly_payroll_journal_view->RowType = ROWTYPE_HEADER;

// Render list options
$monthly_payroll_journal_view_list->renderListOptions();

// Render list options (header, left)
$monthly_payroll_journal_view_list->ListOptions->render("header", "left");
?>
<?php if ($monthly_payroll_journal_view_list->LocalAuthority->Visible) { // LocalAuthority ?>
	<?php if ($monthly_payroll_journal_view_list->SortUrl($monthly_payroll_journal_view_list->LocalAuthority) == "") { ?>
		<th data-name="LocalAuthority" class="<?php echo $monthly_payroll_journal_view_list->LocalAuthority->headerCellClass() ?>"><div id="elh_monthly_payroll_journal_view_LocalAuthority" class="monthly_payroll_journal_view_LocalAuthority"><div class="ew-table-header-caption"><?php echo $monthly_payroll_journal_view_list->LocalAuthority->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LocalAuthority" class="<?php echo $monthly_payroll_journal_view_list->LocalAuthority->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $monthly_payroll_journal_view_list->SortUrl($monthly_payroll_journal_view_list->LocalAuthority) ?>', 1);"><div id="elh_monthly_payroll_journal_view_LocalAuthority" class="monthly_payroll_journal_view_LocalAuthority">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_payroll_journal_view_list->LocalAuthority->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($monthly_payroll_journal_view_list->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_payroll_journal_view_list->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_payroll_journal_view_list->Period->Visible) { // Period ?>
	<?php if ($monthly_payroll_journal_view_list->SortUrl($monthly_payroll_journal_view_list->Period) == "") { ?>
		<th data-name="Period" class="<?php echo $monthly_payroll_journal_view_list->Period->headerCellClass() ?>"><div id="elh_monthly_payroll_journal_view_Period" class="monthly_payroll_journal_view_Period"><div class="ew-table-header-caption"><?php echo $monthly_payroll_journal_view_list->Period->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Period" class="<?php echo $monthly_payroll_journal_view_list->Period->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $monthly_payroll_journal_view_list->SortUrl($monthly_payroll_journal_view_list->Period) ?>', 1);"><div id="elh_monthly_payroll_journal_view_Period" class="monthly_payroll_journal_view_Period">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_payroll_journal_view_list->Period->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($monthly_payroll_journal_view_list->Period->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_payroll_journal_view_list->Period->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_payroll_journal_view_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($monthly_payroll_journal_view_list->SortUrl($monthly_payroll_journal_view_list->PayrollPeriod) == "") { ?>
		<th data-name="PayrollPeriod" class="<?php echo $monthly_payroll_journal_view_list->PayrollPeriod->headerCellClass() ?>"><div id="elh_monthly_payroll_journal_view_PayrollPeriod" class="monthly_payroll_journal_view_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $monthly_payroll_journal_view_list->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollPeriod" class="<?php echo $monthly_payroll_journal_view_list->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $monthly_payroll_journal_view_list->SortUrl($monthly_payroll_journal_view_list->PayrollPeriod) ?>', 1);"><div id="elh_monthly_payroll_journal_view_PayrollPeriod" class="monthly_payroll_journal_view_PayrollPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_payroll_journal_view_list->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($monthly_payroll_journal_view_list->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_payroll_journal_view_list->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_payroll_journal_view_list->AmtType->Visible) { // AmtType ?>
	<?php if ($monthly_payroll_journal_view_list->SortUrl($monthly_payroll_journal_view_list->AmtType) == "") { ?>
		<th data-name="AmtType" class="<?php echo $monthly_payroll_journal_view_list->AmtType->headerCellClass() ?>"><div id="elh_monthly_payroll_journal_view_AmtType" class="monthly_payroll_journal_view_AmtType"><div class="ew-table-header-caption"><?php echo $monthly_payroll_journal_view_list->AmtType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmtType" class="<?php echo $monthly_payroll_journal_view_list->AmtType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $monthly_payroll_journal_view_list->SortUrl($monthly_payroll_journal_view_list->AmtType) ?>', 1);"><div id="elh_monthly_payroll_journal_view_AmtType" class="monthly_payroll_journal_view_AmtType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_payroll_journal_view_list->AmtType->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($monthly_payroll_journal_view_list->AmtType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_payroll_journal_view_list->AmtType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_payroll_journal_view_list->IncomeCode->Visible) { // IncomeCode ?>
	<?php if ($monthly_payroll_journal_view_list->SortUrl($monthly_payroll_journal_view_list->IncomeCode) == "") { ?>
		<th data-name="IncomeCode" class="<?php echo $monthly_payroll_journal_view_list->IncomeCode->headerCellClass() ?>"><div id="elh_monthly_payroll_journal_view_IncomeCode" class="monthly_payroll_journal_view_IncomeCode"><div class="ew-table-header-caption"><?php echo $monthly_payroll_journal_view_list->IncomeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IncomeCode" class="<?php echo $monthly_payroll_journal_view_list->IncomeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $monthly_payroll_journal_view_list->SortUrl($monthly_payroll_journal_view_list->IncomeCode) ?>', 1);"><div id="elh_monthly_payroll_journal_view_IncomeCode" class="monthly_payroll_journal_view_IncomeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_payroll_journal_view_list->IncomeCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($monthly_payroll_journal_view_list->IncomeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_payroll_journal_view_list->IncomeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_payroll_journal_view_list->IncomeName->Visible) { // IncomeName ?>
	<?php if ($monthly_payroll_journal_view_list->SortUrl($monthly_payroll_journal_view_list->IncomeName) == "") { ?>
		<th data-name="IncomeName" class="<?php echo $monthly_payroll_journal_view_list->IncomeName->headerCellClass() ?>"><div id="elh_monthly_payroll_journal_view_IncomeName" class="monthly_payroll_journal_view_IncomeName"><div class="ew-table-header-caption"><?php echo $monthly_payroll_journal_view_list->IncomeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IncomeName" class="<?php echo $monthly_payroll_journal_view_list->IncomeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $monthly_payroll_journal_view_list->SortUrl($monthly_payroll_journal_view_list->IncomeName) ?>', 1);"><div id="elh_monthly_payroll_journal_view_IncomeName" class="monthly_payroll_journal_view_IncomeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_payroll_journal_view_list->IncomeName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($monthly_payroll_journal_view_list->IncomeName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_payroll_journal_view_list->IncomeName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_payroll_journal_view_list->IncomeAmount->Visible) { // IncomeAmount ?>
	<?php if ($monthly_payroll_journal_view_list->SortUrl($monthly_payroll_journal_view_list->IncomeAmount) == "") { ?>
		<th data-name="IncomeAmount" class="<?php echo $monthly_payroll_journal_view_list->IncomeAmount->headerCellClass() ?>"><div id="elh_monthly_payroll_journal_view_IncomeAmount" class="monthly_payroll_journal_view_IncomeAmount"><div class="ew-table-header-caption"><?php echo $monthly_payroll_journal_view_list->IncomeAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IncomeAmount" class="<?php echo $monthly_payroll_journal_view_list->IncomeAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $monthly_payroll_journal_view_list->SortUrl($monthly_payroll_journal_view_list->IncomeAmount) ?>', 1);"><div id="elh_monthly_payroll_journal_view_IncomeAmount" class="monthly_payroll_journal_view_IncomeAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_payroll_journal_view_list->IncomeAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($monthly_payroll_journal_view_list->IncomeAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_payroll_journal_view_list->IncomeAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_payroll_journal_view_list->DeductionCode->Visible) { // DeductionCode ?>
	<?php if ($monthly_payroll_journal_view_list->SortUrl($monthly_payroll_journal_view_list->DeductionCode) == "") { ?>
		<th data-name="DeductionCode" class="<?php echo $monthly_payroll_journal_view_list->DeductionCode->headerCellClass() ?>"><div id="elh_monthly_payroll_journal_view_DeductionCode" class="monthly_payroll_journal_view_DeductionCode"><div class="ew-table-header-caption"><?php echo $monthly_payroll_journal_view_list->DeductionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionCode" class="<?php echo $monthly_payroll_journal_view_list->DeductionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $monthly_payroll_journal_view_list->SortUrl($monthly_payroll_journal_view_list->DeductionCode) ?>', 1);"><div id="elh_monthly_payroll_journal_view_DeductionCode" class="monthly_payroll_journal_view_DeductionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_payroll_journal_view_list->DeductionCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($monthly_payroll_journal_view_list->DeductionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_payroll_journal_view_list->DeductionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_payroll_journal_view_list->DeductionName->Visible) { // DeductionName ?>
	<?php if ($monthly_payroll_journal_view_list->SortUrl($monthly_payroll_journal_view_list->DeductionName) == "") { ?>
		<th data-name="DeductionName" class="<?php echo $monthly_payroll_journal_view_list->DeductionName->headerCellClass() ?>"><div id="elh_monthly_payroll_journal_view_DeductionName" class="monthly_payroll_journal_view_DeductionName"><div class="ew-table-header-caption"><?php echo $monthly_payroll_journal_view_list->DeductionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionName" class="<?php echo $monthly_payroll_journal_view_list->DeductionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $monthly_payroll_journal_view_list->SortUrl($monthly_payroll_journal_view_list->DeductionName) ?>', 1);"><div id="elh_monthly_payroll_journal_view_DeductionName" class="monthly_payroll_journal_view_DeductionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_payroll_journal_view_list->DeductionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($monthly_payroll_journal_view_list->DeductionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_payroll_journal_view_list->DeductionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_payroll_journal_view_list->DeductionAmount->Visible) { // DeductionAmount ?>
	<?php if ($monthly_payroll_journal_view_list->SortUrl($monthly_payroll_journal_view_list->DeductionAmount) == "") { ?>
		<th data-name="DeductionAmount" class="<?php echo $monthly_payroll_journal_view_list->DeductionAmount->headerCellClass() ?>"><div id="elh_monthly_payroll_journal_view_DeductionAmount" class="monthly_payroll_journal_view_DeductionAmount"><div class="ew-table-header-caption"><?php echo $monthly_payroll_journal_view_list->DeductionAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionAmount" class="<?php echo $monthly_payroll_journal_view_list->DeductionAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $monthly_payroll_journal_view_list->SortUrl($monthly_payroll_journal_view_list->DeductionAmount) ?>', 1);"><div id="elh_monthly_payroll_journal_view_DeductionAmount" class="monthly_payroll_journal_view_DeductionAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_payroll_journal_view_list->DeductionAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($monthly_payroll_journal_view_list->DeductionAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_payroll_journal_view_list->DeductionAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$monthly_payroll_journal_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($monthly_payroll_journal_view_list->ExportAll && $monthly_payroll_journal_view_list->isExport()) {
	$monthly_payroll_journal_view_list->StopRecord = $monthly_payroll_journal_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($monthly_payroll_journal_view_list->TotalRecords > $monthly_payroll_journal_view_list->StartRecord + $monthly_payroll_journal_view_list->DisplayRecords - 1)
		$monthly_payroll_journal_view_list->StopRecord = $monthly_payroll_journal_view_list->StartRecord + $monthly_payroll_journal_view_list->DisplayRecords - 1;
	else
		$monthly_payroll_journal_view_list->StopRecord = $monthly_payroll_journal_view_list->TotalRecords;
}
$monthly_payroll_journal_view_list->RecordCount = $monthly_payroll_journal_view_list->StartRecord - 1;
if ($monthly_payroll_journal_view_list->Recordset && !$monthly_payroll_journal_view_list->Recordset->EOF) {
	$monthly_payroll_journal_view_list->Recordset->moveFirst();
	$selectLimit = $monthly_payroll_journal_view_list->UseSelectLimit;
	if (!$selectLimit && $monthly_payroll_journal_view_list->StartRecord > 1)
		$monthly_payroll_journal_view_list->Recordset->move($monthly_payroll_journal_view_list->StartRecord - 1);
} elseif (!$monthly_payroll_journal_view->AllowAddDeleteRow && $monthly_payroll_journal_view_list->StopRecord == 0) {
	$monthly_payroll_journal_view_list->StopRecord = $monthly_payroll_journal_view->GridAddRowCount;
}

// Initialize aggregate
$monthly_payroll_journal_view->RowType = ROWTYPE_AGGREGATEINIT;
$monthly_payroll_journal_view->resetAttributes();
$monthly_payroll_journal_view_list->renderRow();
while ($monthly_payroll_journal_view_list->RecordCount < $monthly_payroll_journal_view_list->StopRecord) {
	$monthly_payroll_journal_view_list->RecordCount++;
	if ($monthly_payroll_journal_view_list->RecordCount >= $monthly_payroll_journal_view_list->StartRecord) {
		$monthly_payroll_journal_view_list->RowCount++;

		// Set up key count
		$monthly_payroll_journal_view_list->KeyCount = $monthly_payroll_journal_view_list->RowIndex;

		// Init row class and style
		$monthly_payroll_journal_view->resetAttributes();
		$monthly_payroll_journal_view->CssClass = "";
		if ($monthly_payroll_journal_view_list->isGridAdd()) {
		} else {
			$monthly_payroll_journal_view_list->loadRowValues($monthly_payroll_journal_view_list->Recordset); // Load row values
		}
		$monthly_payroll_journal_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$monthly_payroll_journal_view->RowAttrs->merge(["data-rowindex" => $monthly_payroll_journal_view_list->RowCount, "id" => "r" . $monthly_payroll_journal_view_list->RowCount . "_monthly_payroll_journal_view", "data-rowtype" => $monthly_payroll_journal_view->RowType]);

		// Render row
		$monthly_payroll_journal_view_list->renderRow();

		// Render list options
		$monthly_payroll_journal_view_list->renderListOptions();
?>
	<tr <?php echo $monthly_payroll_journal_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$monthly_payroll_journal_view_list->ListOptions->render("body", "left", $monthly_payroll_journal_view_list->RowCount);
?>
	<?php if ($monthly_payroll_journal_view_list->LocalAuthority->Visible) { // LocalAuthority ?>
		<td data-name="LocalAuthority" <?php echo $monthly_payroll_journal_view_list->LocalAuthority->cellAttributes() ?>>
<span id="el<?php echo $monthly_payroll_journal_view_list->RowCount ?>_monthly_payroll_journal_view_LocalAuthority">
<span<?php echo $monthly_payroll_journal_view_list->LocalAuthority->viewAttributes() ?>><?php echo $monthly_payroll_journal_view_list->LocalAuthority->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($monthly_payroll_journal_view_list->Period->Visible) { // Period ?>
		<td data-name="Period" <?php echo $monthly_payroll_journal_view_list->Period->cellAttributes() ?>>
<span id="el<?php echo $monthly_payroll_journal_view_list->RowCount ?>_monthly_payroll_journal_view_Period">
<span<?php echo $monthly_payroll_journal_view_list->Period->viewAttributes() ?>><?php echo $monthly_payroll_journal_view_list->Period->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($monthly_payroll_journal_view_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod" <?php echo $monthly_payroll_journal_view_list->PayrollPeriod->cellAttributes() ?>>
<span id="el<?php echo $monthly_payroll_journal_view_list->RowCount ?>_monthly_payroll_journal_view_PayrollPeriod">
<span<?php echo $monthly_payroll_journal_view_list->PayrollPeriod->viewAttributes() ?>><?php echo $monthly_payroll_journal_view_list->PayrollPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($monthly_payroll_journal_view_list->AmtType->Visible) { // AmtType ?>
		<td data-name="AmtType" <?php echo $monthly_payroll_journal_view_list->AmtType->cellAttributes() ?>>
<span id="el<?php echo $monthly_payroll_journal_view_list->RowCount ?>_monthly_payroll_journal_view_AmtType">
<span<?php echo $monthly_payroll_journal_view_list->AmtType->viewAttributes() ?>><?php echo $monthly_payroll_journal_view_list->AmtType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($monthly_payroll_journal_view_list->IncomeCode->Visible) { // IncomeCode ?>
		<td data-name="IncomeCode" <?php echo $monthly_payroll_journal_view_list->IncomeCode->cellAttributes() ?>>
<span id="el<?php echo $monthly_payroll_journal_view_list->RowCount ?>_monthly_payroll_journal_view_IncomeCode">
<span<?php echo $monthly_payroll_journal_view_list->IncomeCode->viewAttributes() ?>><?php echo $monthly_payroll_journal_view_list->IncomeCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($monthly_payroll_journal_view_list->IncomeName->Visible) { // IncomeName ?>
		<td data-name="IncomeName" <?php echo $monthly_payroll_journal_view_list->IncomeName->cellAttributes() ?>>
<span id="el<?php echo $monthly_payroll_journal_view_list->RowCount ?>_monthly_payroll_journal_view_IncomeName">
<span<?php echo $monthly_payroll_journal_view_list->IncomeName->viewAttributes() ?>><?php echo $monthly_payroll_journal_view_list->IncomeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($monthly_payroll_journal_view_list->IncomeAmount->Visible) { // IncomeAmount ?>
		<td data-name="IncomeAmount" <?php echo $monthly_payroll_journal_view_list->IncomeAmount->cellAttributes() ?>>
<span id="el<?php echo $monthly_payroll_journal_view_list->RowCount ?>_monthly_payroll_journal_view_IncomeAmount">
<span<?php echo $monthly_payroll_journal_view_list->IncomeAmount->viewAttributes() ?>><?php echo $monthly_payroll_journal_view_list->IncomeAmount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($monthly_payroll_journal_view_list->DeductionCode->Visible) { // DeductionCode ?>
		<td data-name="DeductionCode" <?php echo $monthly_payroll_journal_view_list->DeductionCode->cellAttributes() ?>>
<span id="el<?php echo $monthly_payroll_journal_view_list->RowCount ?>_monthly_payroll_journal_view_DeductionCode">
<span<?php echo $monthly_payroll_journal_view_list->DeductionCode->viewAttributes() ?>><?php echo $monthly_payroll_journal_view_list->DeductionCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($monthly_payroll_journal_view_list->DeductionName->Visible) { // DeductionName ?>
		<td data-name="DeductionName" <?php echo $monthly_payroll_journal_view_list->DeductionName->cellAttributes() ?>>
<span id="el<?php echo $monthly_payroll_journal_view_list->RowCount ?>_monthly_payroll_journal_view_DeductionName">
<span<?php echo $monthly_payroll_journal_view_list->DeductionName->viewAttributes() ?>><?php echo $monthly_payroll_journal_view_list->DeductionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($monthly_payroll_journal_view_list->DeductionAmount->Visible) { // DeductionAmount ?>
		<td data-name="DeductionAmount" <?php echo $monthly_payroll_journal_view_list->DeductionAmount->cellAttributes() ?>>
<span id="el<?php echo $monthly_payroll_journal_view_list->RowCount ?>_monthly_payroll_journal_view_DeductionAmount">
<span<?php echo $monthly_payroll_journal_view_list->DeductionAmount->viewAttributes() ?>><?php echo $monthly_payroll_journal_view_list->DeductionAmount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$monthly_payroll_journal_view_list->ListOptions->render("body", "right", $monthly_payroll_journal_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$monthly_payroll_journal_view_list->isGridAdd())
		$monthly_payroll_journal_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$monthly_payroll_journal_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($monthly_payroll_journal_view_list->Recordset)
	$monthly_payroll_journal_view_list->Recordset->Close();
?>
<?php if (!$monthly_payroll_journal_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$monthly_payroll_journal_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $monthly_payroll_journal_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $monthly_payroll_journal_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($monthly_payroll_journal_view_list->TotalRecords == 0 && !$monthly_payroll_journal_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $monthly_payroll_journal_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$monthly_payroll_journal_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$monthly_payroll_journal_view_list->isExport()) { ?>
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
$monthly_payroll_journal_view_list->terminate();
?>