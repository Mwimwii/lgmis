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
$union_contribution_list = new union_contribution_list();

// Run the page
$union_contribution_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$union_contribution_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$union_contribution_list->isExport()) { ?>
<script>
var funion_contributionlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	funion_contributionlist = currentForm = new ew.Form("funion_contributionlist", "list");
	funion_contributionlist.formKeyCountName = '<?php echo $union_contribution_list->FormKeyCountName ?>';
	loadjs.done("funion_contributionlist");
});
var funion_contributionlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	funion_contributionlistsrch = currentSearchForm = new ew.Form("funion_contributionlistsrch");

	// Dynamic selection lists
	// Filters

	funion_contributionlistsrch.filterList = <?php echo $union_contribution_list->getFilterList() ?>;

	// Init search panel as collapsed
	funion_contributionlistsrch.initSearchPanel = true;
	loadjs.done("funion_contributionlistsrch");
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
<?php if (!$union_contribution_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($union_contribution_list->TotalRecords > 0 && $union_contribution_list->ExportOptions->visible()) { ?>
<?php $union_contribution_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($union_contribution_list->ImportOptions->visible()) { ?>
<?php $union_contribution_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($union_contribution_list->SearchOptions->visible()) { ?>
<?php $union_contribution_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($union_contribution_list->FilterOptions->visible()) { ?>
<?php $union_contribution_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$union_contribution_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$union_contribution_list->isExport() && !$union_contribution->CurrentAction) { ?>
<form name="funion_contributionlistsrch" id="funion_contributionlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="funion_contributionlistsrch-search-panel" class="<?php echo $union_contribution_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="union_contribution">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $union_contribution_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($union_contribution_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($union_contribution_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $union_contribution_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($union_contribution_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($union_contribution_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($union_contribution_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($union_contribution_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $union_contribution_list->showPageHeader(); ?>
<?php
$union_contribution_list->showMessage();
?>
<?php if ($union_contribution_list->TotalRecords > 0 || $union_contribution->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($union_contribution_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> union_contribution">
<?php if (!$union_contribution_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$union_contribution_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $union_contribution_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $union_contribution_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="funion_contributionlist" id="funion_contributionlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="union_contribution">
<div id="gmp_union_contribution" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($union_contribution_list->TotalRecords > 0 || $union_contribution_list->isGridEdit()) { ?>
<table id="tbl_union_contributionlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$union_contribution->RowType = ROWTYPE_HEADER;

// Render list options
$union_contribution_list->renderListOptions();

// Render list options (header, left)
$union_contribution_list->ListOptions->render("header", "left");
?>
<?php if ($union_contribution_list->Emp_No_->Visible) { // Emp No. ?>
	<?php if ($union_contribution_list->SortUrl($union_contribution_list->Emp_No_) == "") { ?>
		<th data-name="Emp_No_" class="<?php echo $union_contribution_list->Emp_No_->headerCellClass() ?>"><div id="elh_union_contribution_Emp_No_" class="union_contribution_Emp_No_"><div class="ew-table-header-caption"><?php echo $union_contribution_list->Emp_No_->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Emp_No_" class="<?php echo $union_contribution_list->Emp_No_->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $union_contribution_list->SortUrl($union_contribution_list->Emp_No_) ?>', 1);"><div id="elh_union_contribution_Emp_No_" class="union_contribution_Emp_No_">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $union_contribution_list->Emp_No_->caption() ?></span><span class="ew-table-header-sort"><?php if ($union_contribution_list->Emp_No_->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($union_contribution_list->Emp_No_->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($union_contribution_list->First_Name->Visible) { // First Name ?>
	<?php if ($union_contribution_list->SortUrl($union_contribution_list->First_Name) == "") { ?>
		<th data-name="First_Name" class="<?php echo $union_contribution_list->First_Name->headerCellClass() ?>"><div id="elh_union_contribution_First_Name" class="union_contribution_First_Name"><div class="ew-table-header-caption"><?php echo $union_contribution_list->First_Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="First_Name" class="<?php echo $union_contribution_list->First_Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $union_contribution_list->SortUrl($union_contribution_list->First_Name) ?>', 1);"><div id="elh_union_contribution_First_Name" class="union_contribution_First_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $union_contribution_list->First_Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($union_contribution_list->First_Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($union_contribution_list->First_Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($union_contribution_list->Last_Name->Visible) { // Last Name ?>
	<?php if ($union_contribution_list->SortUrl($union_contribution_list->Last_Name) == "") { ?>
		<th data-name="Last_Name" class="<?php echo $union_contribution_list->Last_Name->headerCellClass() ?>"><div id="elh_union_contribution_Last_Name" class="union_contribution_Last_Name"><div class="ew-table-header-caption"><?php echo $union_contribution_list->Last_Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Last_Name" class="<?php echo $union_contribution_list->Last_Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $union_contribution_list->SortUrl($union_contribution_list->Last_Name) ?>', 1);"><div id="elh_union_contribution_Last_Name" class="union_contribution_Last_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $union_contribution_list->Last_Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($union_contribution_list->Last_Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($union_contribution_list->Last_Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($union_contribution_list->NRC_No_->Visible) { // NRC No. ?>
	<?php if ($union_contribution_list->SortUrl($union_contribution_list->NRC_No_) == "") { ?>
		<th data-name="NRC_No_" class="<?php echo $union_contribution_list->NRC_No_->headerCellClass() ?>"><div id="elh_union_contribution_NRC_No_" class="union_contribution_NRC_No_"><div class="ew-table-header-caption"><?php echo $union_contribution_list->NRC_No_->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC_No_" class="<?php echo $union_contribution_list->NRC_No_->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $union_contribution_list->SortUrl($union_contribution_list->NRC_No_) ?>', 1);"><div id="elh_union_contribution_NRC_No_" class="union_contribution_NRC_No_">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $union_contribution_list->NRC_No_->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($union_contribution_list->NRC_No_->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($union_contribution_list->NRC_No_->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($union_contribution_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($union_contribution_list->SortUrl($union_contribution_list->PayrollPeriod) == "") { ?>
		<th data-name="PayrollPeriod" class="<?php echo $union_contribution_list->PayrollPeriod->headerCellClass() ?>"><div id="elh_union_contribution_PayrollPeriod" class="union_contribution_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $union_contribution_list->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollPeriod" class="<?php echo $union_contribution_list->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $union_contribution_list->SortUrl($union_contribution_list->PayrollPeriod) ?>', 1);"><div id="elh_union_contribution_PayrollPeriod" class="union_contribution_PayrollPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $union_contribution_list->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($union_contribution_list->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($union_contribution_list->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($union_contribution_list->DeductionName->Visible) { // DeductionName ?>
	<?php if ($union_contribution_list->SortUrl($union_contribution_list->DeductionName) == "") { ?>
		<th data-name="DeductionName" class="<?php echo $union_contribution_list->DeductionName->headerCellClass() ?>"><div id="elh_union_contribution_DeductionName" class="union_contribution_DeductionName"><div class="ew-table-header-caption"><?php echo $union_contribution_list->DeductionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionName" class="<?php echo $union_contribution_list->DeductionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $union_contribution_list->SortUrl($union_contribution_list->DeductionName) ?>', 1);"><div id="elh_union_contribution_DeductionName" class="union_contribution_DeductionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $union_contribution_list->DeductionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($union_contribution_list->DeductionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($union_contribution_list->DeductionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($union_contribution_list->Basic_This_Month->Visible) { // Basic This Month ?>
	<?php if ($union_contribution_list->SortUrl($union_contribution_list->Basic_This_Month) == "") { ?>
		<th data-name="Basic_This_Month" class="<?php echo $union_contribution_list->Basic_This_Month->headerCellClass() ?>"><div id="elh_union_contribution_Basic_This_Month" class="union_contribution_Basic_This_Month"><div class="ew-table-header-caption"><?php echo $union_contribution_list->Basic_This_Month->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Basic_This_Month" class="<?php echo $union_contribution_list->Basic_This_Month->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $union_contribution_list->SortUrl($union_contribution_list->Basic_This_Month) ?>', 1);"><div id="elh_union_contribution_Basic_This_Month" class="union_contribution_Basic_This_Month">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $union_contribution_list->Basic_This_Month->caption() ?></span><span class="ew-table-header-sort"><?php if ($union_contribution_list->Basic_This_Month->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($union_contribution_list->Basic_This_Month->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($union_contribution_list->Monthly_Contribution->Visible) { // Monthly Contribution ?>
	<?php if ($union_contribution_list->SortUrl($union_contribution_list->Monthly_Contribution) == "") { ?>
		<th data-name="Monthly_Contribution" class="<?php echo $union_contribution_list->Monthly_Contribution->headerCellClass() ?>"><div id="elh_union_contribution_Monthly_Contribution" class="union_contribution_Monthly_Contribution"><div class="ew-table-header-caption"><?php echo $union_contribution_list->Monthly_Contribution->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Monthly_Contribution" class="<?php echo $union_contribution_list->Monthly_Contribution->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $union_contribution_list->SortUrl($union_contribution_list->Monthly_Contribution) ?>', 1);"><div id="elh_union_contribution_Monthly_Contribution" class="union_contribution_Monthly_Contribution">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $union_contribution_list->Monthly_Contribution->caption() ?></span><span class="ew-table-header-sort"><?php if ($union_contribution_list->Monthly_Contribution->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($union_contribution_list->Monthly_Contribution->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($union_contribution_list->Contribution_YTD->Visible) { // Contribution YTD ?>
	<?php if ($union_contribution_list->SortUrl($union_contribution_list->Contribution_YTD) == "") { ?>
		<th data-name="Contribution_YTD" class="<?php echo $union_contribution_list->Contribution_YTD->headerCellClass() ?>"><div id="elh_union_contribution_Contribution_YTD" class="union_contribution_Contribution_YTD"><div class="ew-table-header-caption"><?php echo $union_contribution_list->Contribution_YTD->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Contribution_YTD" class="<?php echo $union_contribution_list->Contribution_YTD->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $union_contribution_list->SortUrl($union_contribution_list->Contribution_YTD) ?>', 1);"><div id="elh_union_contribution_Contribution_YTD" class="union_contribution_Contribution_YTD">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $union_contribution_list->Contribution_YTD->caption() ?></span><span class="ew-table-header-sort"><?php if ($union_contribution_list->Contribution_YTD->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($union_contribution_list->Contribution_YTD->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$union_contribution_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($union_contribution_list->ExportAll && $union_contribution_list->isExport()) {
	$union_contribution_list->StopRecord = $union_contribution_list->TotalRecords;
} else {

	// Set the last record to display
	if ($union_contribution_list->TotalRecords > $union_contribution_list->StartRecord + $union_contribution_list->DisplayRecords - 1)
		$union_contribution_list->StopRecord = $union_contribution_list->StartRecord + $union_contribution_list->DisplayRecords - 1;
	else
		$union_contribution_list->StopRecord = $union_contribution_list->TotalRecords;
}
$union_contribution_list->RecordCount = $union_contribution_list->StartRecord - 1;
if ($union_contribution_list->Recordset && !$union_contribution_list->Recordset->EOF) {
	$union_contribution_list->Recordset->moveFirst();
	$selectLimit = $union_contribution_list->UseSelectLimit;
	if (!$selectLimit && $union_contribution_list->StartRecord > 1)
		$union_contribution_list->Recordset->move($union_contribution_list->StartRecord - 1);
} elseif (!$union_contribution->AllowAddDeleteRow && $union_contribution_list->StopRecord == 0) {
	$union_contribution_list->StopRecord = $union_contribution->GridAddRowCount;
}

// Initialize aggregate
$union_contribution->RowType = ROWTYPE_AGGREGATEINIT;
$union_contribution->resetAttributes();
$union_contribution_list->renderRow();
while ($union_contribution_list->RecordCount < $union_contribution_list->StopRecord) {
	$union_contribution_list->RecordCount++;
	if ($union_contribution_list->RecordCount >= $union_contribution_list->StartRecord) {
		$union_contribution_list->RowCount++;

		// Set up key count
		$union_contribution_list->KeyCount = $union_contribution_list->RowIndex;

		// Init row class and style
		$union_contribution->resetAttributes();
		$union_contribution->CssClass = "";
		if ($union_contribution_list->isGridAdd()) {
		} else {
			$union_contribution_list->loadRowValues($union_contribution_list->Recordset); // Load row values
		}
		$union_contribution->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$union_contribution->RowAttrs->merge(["data-rowindex" => $union_contribution_list->RowCount, "id" => "r" . $union_contribution_list->RowCount . "_union_contribution", "data-rowtype" => $union_contribution->RowType]);

		// Render row
		$union_contribution_list->renderRow();

		// Render list options
		$union_contribution_list->renderListOptions();
?>
	<tr <?php echo $union_contribution->rowAttributes() ?>>
<?php

// Render list options (body, left)
$union_contribution_list->ListOptions->render("body", "left", $union_contribution_list->RowCount);
?>
	<?php if ($union_contribution_list->Emp_No_->Visible) { // Emp No. ?>
		<td data-name="Emp_No_" <?php echo $union_contribution_list->Emp_No_->cellAttributes() ?>>
<span id="el<?php echo $union_contribution_list->RowCount ?>_union_contribution_Emp_No_">
<span<?php echo $union_contribution_list->Emp_No_->viewAttributes() ?>><?php echo $union_contribution_list->Emp_No_->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($union_contribution_list->First_Name->Visible) { // First Name ?>
		<td data-name="First_Name" <?php echo $union_contribution_list->First_Name->cellAttributes() ?>>
<span id="el<?php echo $union_contribution_list->RowCount ?>_union_contribution_First_Name">
<span<?php echo $union_contribution_list->First_Name->viewAttributes() ?>><?php echo $union_contribution_list->First_Name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($union_contribution_list->Last_Name->Visible) { // Last Name ?>
		<td data-name="Last_Name" <?php echo $union_contribution_list->Last_Name->cellAttributes() ?>>
<span id="el<?php echo $union_contribution_list->RowCount ?>_union_contribution_Last_Name">
<span<?php echo $union_contribution_list->Last_Name->viewAttributes() ?>><?php echo $union_contribution_list->Last_Name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($union_contribution_list->NRC_No_->Visible) { // NRC No. ?>
		<td data-name="NRC_No_" <?php echo $union_contribution_list->NRC_No_->cellAttributes() ?>>
<span id="el<?php echo $union_contribution_list->RowCount ?>_union_contribution_NRC_No_">
<span<?php echo $union_contribution_list->NRC_No_->viewAttributes() ?>><?php echo $union_contribution_list->NRC_No_->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($union_contribution_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod" <?php echo $union_contribution_list->PayrollPeriod->cellAttributes() ?>>
<span id="el<?php echo $union_contribution_list->RowCount ?>_union_contribution_PayrollPeriod">
<span<?php echo $union_contribution_list->PayrollPeriod->viewAttributes() ?>><?php echo $union_contribution_list->PayrollPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($union_contribution_list->DeductionName->Visible) { // DeductionName ?>
		<td data-name="DeductionName" <?php echo $union_contribution_list->DeductionName->cellAttributes() ?>>
<span id="el<?php echo $union_contribution_list->RowCount ?>_union_contribution_DeductionName">
<span<?php echo $union_contribution_list->DeductionName->viewAttributes() ?>><?php echo $union_contribution_list->DeductionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($union_contribution_list->Basic_This_Month->Visible) { // Basic This Month ?>
		<td data-name="Basic_This_Month" <?php echo $union_contribution_list->Basic_This_Month->cellAttributes() ?>>
<span id="el<?php echo $union_contribution_list->RowCount ?>_union_contribution_Basic_This_Month">
<span<?php echo $union_contribution_list->Basic_This_Month->viewAttributes() ?>><?php echo $union_contribution_list->Basic_This_Month->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($union_contribution_list->Monthly_Contribution->Visible) { // Monthly Contribution ?>
		<td data-name="Monthly_Contribution" <?php echo $union_contribution_list->Monthly_Contribution->cellAttributes() ?>>
<span id="el<?php echo $union_contribution_list->RowCount ?>_union_contribution_Monthly_Contribution">
<span<?php echo $union_contribution_list->Monthly_Contribution->viewAttributes() ?>><?php echo $union_contribution_list->Monthly_Contribution->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($union_contribution_list->Contribution_YTD->Visible) { // Contribution YTD ?>
		<td data-name="Contribution_YTD" <?php echo $union_contribution_list->Contribution_YTD->cellAttributes() ?>>
<span id="el<?php echo $union_contribution_list->RowCount ?>_union_contribution_Contribution_YTD">
<span<?php echo $union_contribution_list->Contribution_YTD->viewAttributes() ?>><?php echo $union_contribution_list->Contribution_YTD->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$union_contribution_list->ListOptions->render("body", "right", $union_contribution_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$union_contribution_list->isGridAdd())
		$union_contribution_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$union_contribution->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($union_contribution_list->Recordset)
	$union_contribution_list->Recordset->Close();
?>
<?php if (!$union_contribution_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$union_contribution_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $union_contribution_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $union_contribution_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($union_contribution_list->TotalRecords == 0 && !$union_contribution->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $union_contribution_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$union_contribution_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$union_contribution_list->isExport()) { ?>
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
$union_contribution_list->terminate();
?>