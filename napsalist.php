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
$napsa_list = new napsa_list();

// Run the page
$napsa_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$napsa_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$napsa_list->isExport()) { ?>
<script>
var fnapsalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fnapsalist = currentForm = new ew.Form("fnapsalist", "list");
	fnapsalist.formKeyCountName = '<?php echo $napsa_list->FormKeyCountName ?>';
	loadjs.done("fnapsalist");
});
var fnapsalistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fnapsalistsrch = currentSearchForm = new ew.Form("fnapsalistsrch");

	// Dynamic selection lists
	// Filters

	fnapsalistsrch.filterList = <?php echo $napsa_list->getFilterList() ?>;

	// Init search panel as collapsed
	fnapsalistsrch.initSearchPanel = true;
	loadjs.done("fnapsalistsrch");
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
<?php if (!$napsa_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($napsa_list->TotalRecords > 0 && $napsa_list->ExportOptions->visible()) { ?>
<?php $napsa_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($napsa_list->ImportOptions->visible()) { ?>
<?php $napsa_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($napsa_list->SearchOptions->visible()) { ?>
<?php $napsa_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($napsa_list->FilterOptions->visible()) { ?>
<?php $napsa_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$napsa_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$napsa_list->isExport() && !$napsa->CurrentAction) { ?>
<form name="fnapsalistsrch" id="fnapsalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fnapsalistsrch-search-panel" class="<?php echo $napsa_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="napsa">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $napsa_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($napsa_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($napsa_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $napsa_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($napsa_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($napsa_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($napsa_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($napsa_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $napsa_list->showPageHeader(); ?>
<?php
$napsa_list->showMessage();
?>
<?php if ($napsa_list->TotalRecords > 0 || $napsa->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($napsa_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> napsa">
<?php if (!$napsa_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$napsa_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $napsa_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $napsa_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fnapsalist" id="fnapsalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="napsa">
<div id="gmp_napsa" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($napsa_list->TotalRecords > 0 || $napsa_list->isGridEdit()) { ?>
<table id="tbl_napsalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$napsa->RowType = ROWTYPE_HEADER;

// Render list options
$napsa_list->renderListOptions();

// Render list options (header, left)
$napsa_list->ListOptions->render("header", "left");
?>
<?php if ($napsa_list->Account_Number->Visible) { // Account Number ?>
	<?php if ($napsa_list->SortUrl($napsa_list->Account_Number) == "") { ?>
		<th data-name="Account_Number" class="<?php echo $napsa_list->Account_Number->headerCellClass() ?>"><div id="elh_napsa_Account_Number" class="napsa_Account_Number"><div class="ew-table-header-caption"><?php echo $napsa_list->Account_Number->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Account_Number" class="<?php echo $napsa_list->Account_Number->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $napsa_list->SortUrl($napsa_list->Account_Number) ?>', 1);"><div id="elh_napsa_Account_Number" class="napsa_Account_Number">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $napsa_list->Account_Number->caption() ?></span><span class="ew-table-header-sort"><?php if ($napsa_list->Account_Number->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($napsa_list->Account_Number->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($napsa_list->FirstName->Visible) { // FirstName ?>
	<?php if ($napsa_list->SortUrl($napsa_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $napsa_list->FirstName->headerCellClass() ?>"><div id="elh_napsa_FirstName" class="napsa_FirstName"><div class="ew-table-header-caption"><?php echo $napsa_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $napsa_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $napsa_list->SortUrl($napsa_list->FirstName) ?>', 1);"><div id="elh_napsa_FirstName" class="napsa_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $napsa_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($napsa_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($napsa_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($napsa_list->Surname->Visible) { // Surname ?>
	<?php if ($napsa_list->SortUrl($napsa_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $napsa_list->Surname->headerCellClass() ?>"><div id="elh_napsa_Surname" class="napsa_Surname"><div class="ew-table-header-caption"><?php echo $napsa_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $napsa_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $napsa_list->SortUrl($napsa_list->Surname) ?>', 1);"><div id="elh_napsa_Surname" class="napsa_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $napsa_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($napsa_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($napsa_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($napsa_list->Other_Name->Visible) { // Other Name ?>
	<?php if ($napsa_list->SortUrl($napsa_list->Other_Name) == "") { ?>
		<th data-name="Other_Name" class="<?php echo $napsa_list->Other_Name->headerCellClass() ?>"><div id="elh_napsa_Other_Name" class="napsa_Other_Name"><div class="ew-table-header-caption"><?php echo $napsa_list->Other_Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Other_Name" class="<?php echo $napsa_list->Other_Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $napsa_list->SortUrl($napsa_list->Other_Name) ?>', 1);"><div id="elh_napsa_Other_Name" class="napsa_Other_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $napsa_list->Other_Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($napsa_list->Other_Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($napsa_list->Other_Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($napsa_list->Year->Visible) { // Year ?>
	<?php if ($napsa_list->SortUrl($napsa_list->Year) == "") { ?>
		<th data-name="Year" class="<?php echo $napsa_list->Year->headerCellClass() ?>"><div id="elh_napsa_Year" class="napsa_Year"><div class="ew-table-header-caption"><?php echo $napsa_list->Year->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Year" class="<?php echo $napsa_list->Year->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $napsa_list->SortUrl($napsa_list->Year) ?>', 1);"><div id="elh_napsa_Year" class="napsa_Year">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $napsa_list->Year->caption() ?></span><span class="ew-table-header-sort"><?php if ($napsa_list->Year->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($napsa_list->Year->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($napsa_list->Month->Visible) { // Month ?>
	<?php if ($napsa_list->SortUrl($napsa_list->Month) == "") { ?>
		<th data-name="Month" class="<?php echo $napsa_list->Month->headerCellClass() ?>"><div id="elh_napsa_Month" class="napsa_Month"><div class="ew-table-header-caption"><?php echo $napsa_list->Month->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Month" class="<?php echo $napsa_list->Month->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $napsa_list->SortUrl($napsa_list->Month) ?>', 1);"><div id="elh_napsa_Month" class="napsa_Month">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $napsa_list->Month->caption() ?></span><span class="ew-table-header-sort"><?php if ($napsa_list->Month->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($napsa_list->Month->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($napsa_list->Sex->Visible) { // Sex ?>
	<?php if ($napsa_list->SortUrl($napsa_list->Sex) == "") { ?>
		<th data-name="Sex" class="<?php echo $napsa_list->Sex->headerCellClass() ?>"><div id="elh_napsa_Sex" class="napsa_Sex"><div class="ew-table-header-caption"><?php echo $napsa_list->Sex->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sex" class="<?php echo $napsa_list->Sex->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $napsa_list->SortUrl($napsa_list->Sex) ?>', 1);"><div id="elh_napsa_Sex" class="napsa_Sex">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $napsa_list->Sex->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($napsa_list->Sex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($napsa_list->Sex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($napsa_list->SSNO->Visible) { // SSNO ?>
	<?php if ($napsa_list->SortUrl($napsa_list->SSNO) == "") { ?>
		<th data-name="SSNO" class="<?php echo $napsa_list->SSNO->headerCellClass() ?>"><div id="elh_napsa_SSNO" class="napsa_SSNO"><div class="ew-table-header-caption"><?php echo $napsa_list->SSNO->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SSNO" class="<?php echo $napsa_list->SSNO->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $napsa_list->SortUrl($napsa_list->SSNO) ?>', 1);"><div id="elh_napsa_SSNO" class="napsa_SSNO">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $napsa_list->SSNO->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($napsa_list->SSNO->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($napsa_list->SSNO->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($napsa_list->NRC->Visible) { // NRC ?>
	<?php if ($napsa_list->SortUrl($napsa_list->NRC) == "") { ?>
		<th data-name="NRC" class="<?php echo $napsa_list->NRC->headerCellClass() ?>"><div id="elh_napsa_NRC" class="napsa_NRC"><div class="ew-table-header-caption"><?php echo $napsa_list->NRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC" class="<?php echo $napsa_list->NRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $napsa_list->SortUrl($napsa_list->NRC) ?>', 1);"><div id="elh_napsa_NRC" class="napsa_NRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $napsa_list->NRC->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($napsa_list->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($napsa_list->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($napsa_list->PositionName->Visible) { // PositionName ?>
	<?php if ($napsa_list->SortUrl($napsa_list->PositionName) == "") { ?>
		<th data-name="PositionName" class="<?php echo $napsa_list->PositionName->headerCellClass() ?>"><div id="elh_napsa_PositionName" class="napsa_PositionName"><div class="ew-table-header-caption"><?php echo $napsa_list->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionName" class="<?php echo $napsa_list->PositionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $napsa_list->SortUrl($napsa_list->PositionName) ?>', 1);"><div id="elh_napsa_PositionName" class="napsa_PositionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $napsa_list->PositionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($napsa_list->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($napsa_list->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($napsa_list->Date_Of_Birth->Visible) { // Date Of Birth ?>
	<?php if ($napsa_list->SortUrl($napsa_list->Date_Of_Birth) == "") { ?>
		<th data-name="Date_Of_Birth" class="<?php echo $napsa_list->Date_Of_Birth->headerCellClass() ?>"><div id="elh_napsa_Date_Of_Birth" class="napsa_Date_Of_Birth"><div class="ew-table-header-caption"><?php echo $napsa_list->Date_Of_Birth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Date_Of_Birth" class="<?php echo $napsa_list->Date_Of_Birth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $napsa_list->SortUrl($napsa_list->Date_Of_Birth) ?>', 1);"><div id="elh_napsa_Date_Of_Birth" class="napsa_Date_Of_Birth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $napsa_list->Date_Of_Birth->caption() ?></span><span class="ew-table-header-sort"><?php if ($napsa_list->Date_Of_Birth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($napsa_list->Date_Of_Birth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($napsa_list->SalaryScale->Visible) { // SalaryScale ?>
	<?php if ($napsa_list->SortUrl($napsa_list->SalaryScale) == "") { ?>
		<th data-name="SalaryScale" class="<?php echo $napsa_list->SalaryScale->headerCellClass() ?>"><div id="elh_napsa_SalaryScale" class="napsa_SalaryScale"><div class="ew-table-header-caption"><?php echo $napsa_list->SalaryScale->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SalaryScale" class="<?php echo $napsa_list->SalaryScale->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $napsa_list->SortUrl($napsa_list->SalaryScale) ?>', 1);"><div id="elh_napsa_SalaryScale" class="napsa_SalaryScale">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $napsa_list->SalaryScale->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($napsa_list->SalaryScale->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($napsa_list->SalaryScale->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($napsa_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($napsa_list->SortUrl($napsa_list->PayrollPeriod) == "") { ?>
		<th data-name="PayrollPeriod" class="<?php echo $napsa_list->PayrollPeriod->headerCellClass() ?>"><div id="elh_napsa_PayrollPeriod" class="napsa_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $napsa_list->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollPeriod" class="<?php echo $napsa_list->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $napsa_list->SortUrl($napsa_list->PayrollPeriod) ?>', 1);"><div id="elh_napsa_PayrollPeriod" class="napsa_PayrollPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $napsa_list->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($napsa_list->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($napsa_list->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($napsa_list->PayMonth->Visible) { // PayMonth ?>
	<?php if ($napsa_list->SortUrl($napsa_list->PayMonth) == "") { ?>
		<th data-name="PayMonth" class="<?php echo $napsa_list->PayMonth->headerCellClass() ?>"><div id="elh_napsa_PayMonth" class="napsa_PayMonth"><div class="ew-table-header-caption"><?php echo $napsa_list->PayMonth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayMonth" class="<?php echo $napsa_list->PayMonth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $napsa_list->SortUrl($napsa_list->PayMonth) ?>', 1);"><div id="elh_napsa_PayMonth" class="napsa_PayMonth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $napsa_list->PayMonth->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($napsa_list->PayMonth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($napsa_list->PayMonth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($napsa_list->Rebased_Gross_Wage->Visible) { // Rebased Gross Wage ?>
	<?php if ($napsa_list->SortUrl($napsa_list->Rebased_Gross_Wage) == "") { ?>
		<th data-name="Rebased_Gross_Wage" class="<?php echo $napsa_list->Rebased_Gross_Wage->headerCellClass() ?>"><div id="elh_napsa_Rebased_Gross_Wage" class="napsa_Rebased_Gross_Wage"><div class="ew-table-header-caption"><?php echo $napsa_list->Rebased_Gross_Wage->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rebased_Gross_Wage" class="<?php echo $napsa_list->Rebased_Gross_Wage->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $napsa_list->SortUrl($napsa_list->Rebased_Gross_Wage) ?>', 1);"><div id="elh_napsa_Rebased_Gross_Wage" class="napsa_Rebased_Gross_Wage">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $napsa_list->Rebased_Gross_Wage->caption() ?></span><span class="ew-table-header-sort"><?php if ($napsa_list->Rebased_Gross_Wage->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($napsa_list->Rebased_Gross_Wage->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($napsa_list->Employer_Share->Visible) { // Employer Share ?>
	<?php if ($napsa_list->SortUrl($napsa_list->Employer_Share) == "") { ?>
		<th data-name="Employer_Share" class="<?php echo $napsa_list->Employer_Share->headerCellClass() ?>"><div id="elh_napsa_Employer_Share" class="napsa_Employer_Share"><div class="ew-table-header-caption"><?php echo $napsa_list->Employer_Share->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Employer_Share" class="<?php echo $napsa_list->Employer_Share->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $napsa_list->SortUrl($napsa_list->Employer_Share) ?>', 1);"><div id="elh_napsa_Employer_Share" class="napsa_Employer_Share">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $napsa_list->Employer_Share->caption() ?></span><span class="ew-table-header-sort"><?php if ($napsa_list->Employer_Share->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($napsa_list->Employer_Share->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($napsa_list->Employee_Share->Visible) { // Employee Share ?>
	<?php if ($napsa_list->SortUrl($napsa_list->Employee_Share) == "") { ?>
		<th data-name="Employee_Share" class="<?php echo $napsa_list->Employee_Share->headerCellClass() ?>"><div id="elh_napsa_Employee_Share" class="napsa_Employee_Share"><div class="ew-table-header-caption"><?php echo $napsa_list->Employee_Share->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Employee_Share" class="<?php echo $napsa_list->Employee_Share->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $napsa_list->SortUrl($napsa_list->Employee_Share) ?>', 1);"><div id="elh_napsa_Employee_Share" class="napsa_Employee_Share">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $napsa_list->Employee_Share->caption() ?></span><span class="ew-table-header-sort"><?php if ($napsa_list->Employee_Share->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($napsa_list->Employee_Share->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$napsa_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($napsa_list->ExportAll && $napsa_list->isExport()) {
	$napsa_list->StopRecord = $napsa_list->TotalRecords;
} else {

	// Set the last record to display
	if ($napsa_list->TotalRecords > $napsa_list->StartRecord + $napsa_list->DisplayRecords - 1)
		$napsa_list->StopRecord = $napsa_list->StartRecord + $napsa_list->DisplayRecords - 1;
	else
		$napsa_list->StopRecord = $napsa_list->TotalRecords;
}
$napsa_list->RecordCount = $napsa_list->StartRecord - 1;
if ($napsa_list->Recordset && !$napsa_list->Recordset->EOF) {
	$napsa_list->Recordset->moveFirst();
	$selectLimit = $napsa_list->UseSelectLimit;
	if (!$selectLimit && $napsa_list->StartRecord > 1)
		$napsa_list->Recordset->move($napsa_list->StartRecord - 1);
} elseif (!$napsa->AllowAddDeleteRow && $napsa_list->StopRecord == 0) {
	$napsa_list->StopRecord = $napsa->GridAddRowCount;
}

// Initialize aggregate
$napsa->RowType = ROWTYPE_AGGREGATEINIT;
$napsa->resetAttributes();
$napsa_list->renderRow();
while ($napsa_list->RecordCount < $napsa_list->StopRecord) {
	$napsa_list->RecordCount++;
	if ($napsa_list->RecordCount >= $napsa_list->StartRecord) {
		$napsa_list->RowCount++;

		// Set up key count
		$napsa_list->KeyCount = $napsa_list->RowIndex;

		// Init row class and style
		$napsa->resetAttributes();
		$napsa->CssClass = "";
		if ($napsa_list->isGridAdd()) {
		} else {
			$napsa_list->loadRowValues($napsa_list->Recordset); // Load row values
		}
		$napsa->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$napsa->RowAttrs->merge(["data-rowindex" => $napsa_list->RowCount, "id" => "r" . $napsa_list->RowCount . "_napsa", "data-rowtype" => $napsa->RowType]);

		// Render row
		$napsa_list->renderRow();

		// Render list options
		$napsa_list->renderListOptions();
?>
	<tr <?php echo $napsa->rowAttributes() ?>>
<?php

// Render list options (body, left)
$napsa_list->ListOptions->render("body", "left", $napsa_list->RowCount);
?>
	<?php if ($napsa_list->Account_Number->Visible) { // Account Number ?>
		<td data-name="Account_Number" <?php echo $napsa_list->Account_Number->cellAttributes() ?>>
<span id="el<?php echo $napsa_list->RowCount ?>_napsa_Account_Number">
<span<?php echo $napsa_list->Account_Number->viewAttributes() ?>><?php echo $napsa_list->Account_Number->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($napsa_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $napsa_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $napsa_list->RowCount ?>_napsa_FirstName">
<span<?php echo $napsa_list->FirstName->viewAttributes() ?>><?php echo $napsa_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($napsa_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $napsa_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $napsa_list->RowCount ?>_napsa_Surname">
<span<?php echo $napsa_list->Surname->viewAttributes() ?>><?php echo $napsa_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($napsa_list->Other_Name->Visible) { // Other Name ?>
		<td data-name="Other_Name" <?php echo $napsa_list->Other_Name->cellAttributes() ?>>
<span id="el<?php echo $napsa_list->RowCount ?>_napsa_Other_Name">
<span<?php echo $napsa_list->Other_Name->viewAttributes() ?>><?php echo $napsa_list->Other_Name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($napsa_list->Year->Visible) { // Year ?>
		<td data-name="Year" <?php echo $napsa_list->Year->cellAttributes() ?>>
<span id="el<?php echo $napsa_list->RowCount ?>_napsa_Year">
<span<?php echo $napsa_list->Year->viewAttributes() ?>><?php echo $napsa_list->Year->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($napsa_list->Month->Visible) { // Month ?>
		<td data-name="Month" <?php echo $napsa_list->Month->cellAttributes() ?>>
<span id="el<?php echo $napsa_list->RowCount ?>_napsa_Month">
<span<?php echo $napsa_list->Month->viewAttributes() ?>><?php echo $napsa_list->Month->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($napsa_list->Sex->Visible) { // Sex ?>
		<td data-name="Sex" <?php echo $napsa_list->Sex->cellAttributes() ?>>
<span id="el<?php echo $napsa_list->RowCount ?>_napsa_Sex">
<span<?php echo $napsa_list->Sex->viewAttributes() ?>><?php echo $napsa_list->Sex->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($napsa_list->SSNO->Visible) { // SSNO ?>
		<td data-name="SSNO" <?php echo $napsa_list->SSNO->cellAttributes() ?>>
<span id="el<?php echo $napsa_list->RowCount ?>_napsa_SSNO">
<span<?php echo $napsa_list->SSNO->viewAttributes() ?>><?php echo $napsa_list->SSNO->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($napsa_list->NRC->Visible) { // NRC ?>
		<td data-name="NRC" <?php echo $napsa_list->NRC->cellAttributes() ?>>
<span id="el<?php echo $napsa_list->RowCount ?>_napsa_NRC">
<span<?php echo $napsa_list->NRC->viewAttributes() ?>><?php echo $napsa_list->NRC->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($napsa_list->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName" <?php echo $napsa_list->PositionName->cellAttributes() ?>>
<span id="el<?php echo $napsa_list->RowCount ?>_napsa_PositionName">
<span<?php echo $napsa_list->PositionName->viewAttributes() ?>><?php echo $napsa_list->PositionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($napsa_list->Date_Of_Birth->Visible) { // Date Of Birth ?>
		<td data-name="Date_Of_Birth" <?php echo $napsa_list->Date_Of_Birth->cellAttributes() ?>>
<span id="el<?php echo $napsa_list->RowCount ?>_napsa_Date_Of_Birth">
<span<?php echo $napsa_list->Date_Of_Birth->viewAttributes() ?>><?php echo $napsa_list->Date_Of_Birth->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($napsa_list->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale" <?php echo $napsa_list->SalaryScale->cellAttributes() ?>>
<span id="el<?php echo $napsa_list->RowCount ?>_napsa_SalaryScale">
<span<?php echo $napsa_list->SalaryScale->viewAttributes() ?>><?php echo $napsa_list->SalaryScale->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($napsa_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod" <?php echo $napsa_list->PayrollPeriod->cellAttributes() ?>>
<span id="el<?php echo $napsa_list->RowCount ?>_napsa_PayrollPeriod">
<span<?php echo $napsa_list->PayrollPeriod->viewAttributes() ?>><?php echo $napsa_list->PayrollPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($napsa_list->PayMonth->Visible) { // PayMonth ?>
		<td data-name="PayMonth" <?php echo $napsa_list->PayMonth->cellAttributes() ?>>
<span id="el<?php echo $napsa_list->RowCount ?>_napsa_PayMonth">
<span<?php echo $napsa_list->PayMonth->viewAttributes() ?>><?php echo $napsa_list->PayMonth->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($napsa_list->Rebased_Gross_Wage->Visible) { // Rebased Gross Wage ?>
		<td data-name="Rebased_Gross_Wage" <?php echo $napsa_list->Rebased_Gross_Wage->cellAttributes() ?>>
<span id="el<?php echo $napsa_list->RowCount ?>_napsa_Rebased_Gross_Wage">
<span<?php echo $napsa_list->Rebased_Gross_Wage->viewAttributes() ?>><?php echo $napsa_list->Rebased_Gross_Wage->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($napsa_list->Employer_Share->Visible) { // Employer Share ?>
		<td data-name="Employer_Share" <?php echo $napsa_list->Employer_Share->cellAttributes() ?>>
<span id="el<?php echo $napsa_list->RowCount ?>_napsa_Employer_Share">
<span<?php echo $napsa_list->Employer_Share->viewAttributes() ?>><?php echo $napsa_list->Employer_Share->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($napsa_list->Employee_Share->Visible) { // Employee Share ?>
		<td data-name="Employee_Share" <?php echo $napsa_list->Employee_Share->cellAttributes() ?>>
<span id="el<?php echo $napsa_list->RowCount ?>_napsa_Employee_Share">
<span<?php echo $napsa_list->Employee_Share->viewAttributes() ?>><?php echo $napsa_list->Employee_Share->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$napsa_list->ListOptions->render("body", "right", $napsa_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$napsa_list->isGridAdd())
		$napsa_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$napsa->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($napsa_list->Recordset)
	$napsa_list->Recordset->Close();
?>
<?php if (!$napsa_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$napsa_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $napsa_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $napsa_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($napsa_list->TotalRecords == 0 && !$napsa->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $napsa_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$napsa_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$napsa_list->isExport()) { ?>
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
$napsa_list->terminate();
?>