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
$nhis_list = new nhis_list();

// Run the page
$nhis_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$nhis_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$nhis_list->isExport()) { ?>
<script>
var fnhislist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fnhislist = currentForm = new ew.Form("fnhislist", "list");
	fnhislist.formKeyCountName = '<?php echo $nhis_list->FormKeyCountName ?>';
	loadjs.done("fnhislist");
});
var fnhislistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fnhislistsrch = currentSearchForm = new ew.Form("fnhislistsrch");

	// Dynamic selection lists
	// Filters

	fnhislistsrch.filterList = <?php echo $nhis_list->getFilterList() ?>;

	// Init search panel as collapsed
	fnhislistsrch.initSearchPanel = true;
	loadjs.done("fnhislistsrch");
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
<?php if (!$nhis_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($nhis_list->TotalRecords > 0 && $nhis_list->ExportOptions->visible()) { ?>
<?php $nhis_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($nhis_list->ImportOptions->visible()) { ?>
<?php $nhis_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($nhis_list->SearchOptions->visible()) { ?>
<?php $nhis_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($nhis_list->FilterOptions->visible()) { ?>
<?php $nhis_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$nhis_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$nhis_list->isExport() && !$nhis->CurrentAction) { ?>
<form name="fnhislistsrch" id="fnhislistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fnhislistsrch-search-panel" class="<?php echo $nhis_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="nhis">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $nhis_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($nhis_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($nhis_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $nhis_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($nhis_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($nhis_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($nhis_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($nhis_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $nhis_list->showPageHeader(); ?>
<?php
$nhis_list->showMessage();
?>
<?php if ($nhis_list->TotalRecords > 0 || $nhis->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($nhis_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> nhis">
<?php if (!$nhis_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$nhis_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $nhis_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $nhis_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fnhislist" id="fnhislist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="nhis">
<div id="gmp_nhis" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($nhis_list->TotalRecords > 0 || $nhis_list->isGridEdit()) { ?>
<table id="tbl_nhislist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$nhis->RowType = ROWTYPE_HEADER;

// Render list options
$nhis_list->renderListOptions();

// Render list options (header, left)
$nhis_list->ListOptions->render("header", "left");
?>
<?php if ($nhis_list->Emp_No_->Visible) { // Emp No. ?>
	<?php if ($nhis_list->SortUrl($nhis_list->Emp_No_) == "") { ?>
		<th data-name="Emp_No_" class="<?php echo $nhis_list->Emp_No_->headerCellClass() ?>"><div id="elh_nhis_Emp_No_" class="nhis_Emp_No_"><div class="ew-table-header-caption"><?php echo $nhis_list->Emp_No_->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Emp_No_" class="<?php echo $nhis_list->Emp_No_->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $nhis_list->SortUrl($nhis_list->Emp_No_) ?>', 1);"><div id="elh_nhis_Emp_No_" class="nhis_Emp_No_">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nhis_list->Emp_No_->caption() ?></span><span class="ew-table-header-sort"><?php if ($nhis_list->Emp_No_->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($nhis_list->Emp_No_->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($nhis_list->Title->Visible) { // Title ?>
	<?php if ($nhis_list->SortUrl($nhis_list->Title) == "") { ?>
		<th data-name="Title" class="<?php echo $nhis_list->Title->headerCellClass() ?>"><div id="elh_nhis_Title" class="nhis_Title"><div class="ew-table-header-caption"><?php echo $nhis_list->Title->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Title" class="<?php echo $nhis_list->Title->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $nhis_list->SortUrl($nhis_list->Title) ?>', 1);"><div id="elh_nhis_Title" class="nhis_Title">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nhis_list->Title->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($nhis_list->Title->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($nhis_list->Title->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($nhis_list->First_Name->Visible) { // First Name ?>
	<?php if ($nhis_list->SortUrl($nhis_list->First_Name) == "") { ?>
		<th data-name="First_Name" class="<?php echo $nhis_list->First_Name->headerCellClass() ?>"><div id="elh_nhis_First_Name" class="nhis_First_Name"><div class="ew-table-header-caption"><?php echo $nhis_list->First_Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="First_Name" class="<?php echo $nhis_list->First_Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $nhis_list->SortUrl($nhis_list->First_Name) ?>', 1);"><div id="elh_nhis_First_Name" class="nhis_First_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nhis_list->First_Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($nhis_list->First_Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($nhis_list->First_Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($nhis_list->Last_Name->Visible) { // Last Name ?>
	<?php if ($nhis_list->SortUrl($nhis_list->Last_Name) == "") { ?>
		<th data-name="Last_Name" class="<?php echo $nhis_list->Last_Name->headerCellClass() ?>"><div id="elh_nhis_Last_Name" class="nhis_Last_Name"><div class="ew-table-header-caption"><?php echo $nhis_list->Last_Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Last_Name" class="<?php echo $nhis_list->Last_Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $nhis_list->SortUrl($nhis_list->Last_Name) ?>', 1);"><div id="elh_nhis_Last_Name" class="nhis_Last_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nhis_list->Last_Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($nhis_list->Last_Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($nhis_list->Last_Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($nhis_list->Sex->Visible) { // Sex ?>
	<?php if ($nhis_list->SortUrl($nhis_list->Sex) == "") { ?>
		<th data-name="Sex" class="<?php echo $nhis_list->Sex->headerCellClass() ?>"><div id="elh_nhis_Sex" class="nhis_Sex"><div class="ew-table-header-caption"><?php echo $nhis_list->Sex->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sex" class="<?php echo $nhis_list->Sex->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $nhis_list->SortUrl($nhis_list->Sex) ?>', 1);"><div id="elh_nhis_Sex" class="nhis_Sex">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nhis_list->Sex->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($nhis_list->Sex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($nhis_list->Sex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($nhis_list->NRC_No_->Visible) { // NRC No. ?>
	<?php if ($nhis_list->SortUrl($nhis_list->NRC_No_) == "") { ?>
		<th data-name="NRC_No_" class="<?php echo $nhis_list->NRC_No_->headerCellClass() ?>"><div id="elh_nhis_NRC_No_" class="nhis_NRC_No_"><div class="ew-table-header-caption"><?php echo $nhis_list->NRC_No_->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC_No_" class="<?php echo $nhis_list->NRC_No_->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $nhis_list->SortUrl($nhis_list->NRC_No_) ?>', 1);"><div id="elh_nhis_NRC_No_" class="nhis_NRC_No_">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nhis_list->NRC_No_->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($nhis_list->NRC_No_->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($nhis_list->NRC_No_->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($nhis_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($nhis_list->SortUrl($nhis_list->PayrollPeriod) == "") { ?>
		<th data-name="PayrollPeriod" class="<?php echo $nhis_list->PayrollPeriod->headerCellClass() ?>"><div id="elh_nhis_PayrollPeriod" class="nhis_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $nhis_list->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollPeriod" class="<?php echo $nhis_list->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $nhis_list->SortUrl($nhis_list->PayrollPeriod) ?>', 1);"><div id="elh_nhis_PayrollPeriod" class="nhis_PayrollPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nhis_list->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($nhis_list->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($nhis_list->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($nhis_list->DeductionName->Visible) { // DeductionName ?>
	<?php if ($nhis_list->SortUrl($nhis_list->DeductionName) == "") { ?>
		<th data-name="DeductionName" class="<?php echo $nhis_list->DeductionName->headerCellClass() ?>"><div id="elh_nhis_DeductionName" class="nhis_DeductionName"><div class="ew-table-header-caption"><?php echo $nhis_list->DeductionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionName" class="<?php echo $nhis_list->DeductionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $nhis_list->SortUrl($nhis_list->DeductionName) ?>', 1);"><div id="elh_nhis_DeductionName" class="nhis_DeductionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nhis_list->DeductionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($nhis_list->DeductionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($nhis_list->DeductionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($nhis_list->Basic_Pay_This_Month->Visible) { // Basic Pay This Month ?>
	<?php if ($nhis_list->SortUrl($nhis_list->Basic_Pay_This_Month) == "") { ?>
		<th data-name="Basic_Pay_This_Month" class="<?php echo $nhis_list->Basic_Pay_This_Month->headerCellClass() ?>"><div id="elh_nhis_Basic_Pay_This_Month" class="nhis_Basic_Pay_This_Month"><div class="ew-table-header-caption"><?php echo $nhis_list->Basic_Pay_This_Month->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Basic_Pay_This_Month" class="<?php echo $nhis_list->Basic_Pay_This_Month->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $nhis_list->SortUrl($nhis_list->Basic_Pay_This_Month) ?>', 1);"><div id="elh_nhis_Basic_Pay_This_Month" class="nhis_Basic_Pay_This_Month">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nhis_list->Basic_Pay_This_Month->caption() ?></span><span class="ew-table-header-sort"><?php if ($nhis_list->Basic_Pay_This_Month->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($nhis_list->Basic_Pay_This_Month->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($nhis_list->Employee_Contribution->Visible) { // Employee Contribution ?>
	<?php if ($nhis_list->SortUrl($nhis_list->Employee_Contribution) == "") { ?>
		<th data-name="Employee_Contribution" class="<?php echo $nhis_list->Employee_Contribution->headerCellClass() ?>"><div id="elh_nhis_Employee_Contribution" class="nhis_Employee_Contribution"><div class="ew-table-header-caption"><?php echo $nhis_list->Employee_Contribution->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Employee_Contribution" class="<?php echo $nhis_list->Employee_Contribution->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $nhis_list->SortUrl($nhis_list->Employee_Contribution) ?>', 1);"><div id="elh_nhis_Employee_Contribution" class="nhis_Employee_Contribution">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nhis_list->Employee_Contribution->caption() ?></span><span class="ew-table-header-sort"><?php if ($nhis_list->Employee_Contribution->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($nhis_list->Employee_Contribution->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($nhis_list->Employer_Contribution->Visible) { // Employer Contribution ?>
	<?php if ($nhis_list->SortUrl($nhis_list->Employer_Contribution) == "") { ?>
		<th data-name="Employer_Contribution" class="<?php echo $nhis_list->Employer_Contribution->headerCellClass() ?>"><div id="elh_nhis_Employer_Contribution" class="nhis_Employer_Contribution"><div class="ew-table-header-caption"><?php echo $nhis_list->Employer_Contribution->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Employer_Contribution" class="<?php echo $nhis_list->Employer_Contribution->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $nhis_list->SortUrl($nhis_list->Employer_Contribution) ?>', 1);"><div id="elh_nhis_Employer_Contribution" class="nhis_Employer_Contribution">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nhis_list->Employer_Contribution->caption() ?></span><span class="ew-table-header-sort"><?php if ($nhis_list->Employer_Contribution->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($nhis_list->Employer_Contribution->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$nhis_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($nhis_list->ExportAll && $nhis_list->isExport()) {
	$nhis_list->StopRecord = $nhis_list->TotalRecords;
} else {

	// Set the last record to display
	if ($nhis_list->TotalRecords > $nhis_list->StartRecord + $nhis_list->DisplayRecords - 1)
		$nhis_list->StopRecord = $nhis_list->StartRecord + $nhis_list->DisplayRecords - 1;
	else
		$nhis_list->StopRecord = $nhis_list->TotalRecords;
}
$nhis_list->RecordCount = $nhis_list->StartRecord - 1;
if ($nhis_list->Recordset && !$nhis_list->Recordset->EOF) {
	$nhis_list->Recordset->moveFirst();
	$selectLimit = $nhis_list->UseSelectLimit;
	if (!$selectLimit && $nhis_list->StartRecord > 1)
		$nhis_list->Recordset->move($nhis_list->StartRecord - 1);
} elseif (!$nhis->AllowAddDeleteRow && $nhis_list->StopRecord == 0) {
	$nhis_list->StopRecord = $nhis->GridAddRowCount;
}

// Initialize aggregate
$nhis->RowType = ROWTYPE_AGGREGATEINIT;
$nhis->resetAttributes();
$nhis_list->renderRow();
while ($nhis_list->RecordCount < $nhis_list->StopRecord) {
	$nhis_list->RecordCount++;
	if ($nhis_list->RecordCount >= $nhis_list->StartRecord) {
		$nhis_list->RowCount++;

		// Set up key count
		$nhis_list->KeyCount = $nhis_list->RowIndex;

		// Init row class and style
		$nhis->resetAttributes();
		$nhis->CssClass = "";
		if ($nhis_list->isGridAdd()) {
		} else {
			$nhis_list->loadRowValues($nhis_list->Recordset); // Load row values
		}
		$nhis->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$nhis->RowAttrs->merge(["data-rowindex" => $nhis_list->RowCount, "id" => "r" . $nhis_list->RowCount . "_nhis", "data-rowtype" => $nhis->RowType]);

		// Render row
		$nhis_list->renderRow();

		// Render list options
		$nhis_list->renderListOptions();
?>
	<tr <?php echo $nhis->rowAttributes() ?>>
<?php

// Render list options (body, left)
$nhis_list->ListOptions->render("body", "left", $nhis_list->RowCount);
?>
	<?php if ($nhis_list->Emp_No_->Visible) { // Emp No. ?>
		<td data-name="Emp_No_" <?php echo $nhis_list->Emp_No_->cellAttributes() ?>>
<span id="el<?php echo $nhis_list->RowCount ?>_nhis_Emp_No_">
<span<?php echo $nhis_list->Emp_No_->viewAttributes() ?>><?php echo $nhis_list->Emp_No_->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($nhis_list->Title->Visible) { // Title ?>
		<td data-name="Title" <?php echo $nhis_list->Title->cellAttributes() ?>>
<span id="el<?php echo $nhis_list->RowCount ?>_nhis_Title">
<span<?php echo $nhis_list->Title->viewAttributes() ?>><?php echo $nhis_list->Title->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($nhis_list->First_Name->Visible) { // First Name ?>
		<td data-name="First_Name" <?php echo $nhis_list->First_Name->cellAttributes() ?>>
<span id="el<?php echo $nhis_list->RowCount ?>_nhis_First_Name">
<span<?php echo $nhis_list->First_Name->viewAttributes() ?>><?php echo $nhis_list->First_Name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($nhis_list->Last_Name->Visible) { // Last Name ?>
		<td data-name="Last_Name" <?php echo $nhis_list->Last_Name->cellAttributes() ?>>
<span id="el<?php echo $nhis_list->RowCount ?>_nhis_Last_Name">
<span<?php echo $nhis_list->Last_Name->viewAttributes() ?>><?php echo $nhis_list->Last_Name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($nhis_list->Sex->Visible) { // Sex ?>
		<td data-name="Sex" <?php echo $nhis_list->Sex->cellAttributes() ?>>
<span id="el<?php echo $nhis_list->RowCount ?>_nhis_Sex">
<span<?php echo $nhis_list->Sex->viewAttributes() ?>><?php echo $nhis_list->Sex->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($nhis_list->NRC_No_->Visible) { // NRC No. ?>
		<td data-name="NRC_No_" <?php echo $nhis_list->NRC_No_->cellAttributes() ?>>
<span id="el<?php echo $nhis_list->RowCount ?>_nhis_NRC_No_">
<span<?php echo $nhis_list->NRC_No_->viewAttributes() ?>><?php echo $nhis_list->NRC_No_->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($nhis_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod" <?php echo $nhis_list->PayrollPeriod->cellAttributes() ?>>
<span id="el<?php echo $nhis_list->RowCount ?>_nhis_PayrollPeriod">
<span<?php echo $nhis_list->PayrollPeriod->viewAttributes() ?>><?php echo $nhis_list->PayrollPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($nhis_list->DeductionName->Visible) { // DeductionName ?>
		<td data-name="DeductionName" <?php echo $nhis_list->DeductionName->cellAttributes() ?>>
<span id="el<?php echo $nhis_list->RowCount ?>_nhis_DeductionName">
<span<?php echo $nhis_list->DeductionName->viewAttributes() ?>><?php echo $nhis_list->DeductionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($nhis_list->Basic_Pay_This_Month->Visible) { // Basic Pay This Month ?>
		<td data-name="Basic_Pay_This_Month" <?php echo $nhis_list->Basic_Pay_This_Month->cellAttributes() ?>>
<span id="el<?php echo $nhis_list->RowCount ?>_nhis_Basic_Pay_This_Month">
<span<?php echo $nhis_list->Basic_Pay_This_Month->viewAttributes() ?>><?php echo $nhis_list->Basic_Pay_This_Month->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($nhis_list->Employee_Contribution->Visible) { // Employee Contribution ?>
		<td data-name="Employee_Contribution" <?php echo $nhis_list->Employee_Contribution->cellAttributes() ?>>
<span id="el<?php echo $nhis_list->RowCount ?>_nhis_Employee_Contribution">
<span<?php echo $nhis_list->Employee_Contribution->viewAttributes() ?>><?php echo $nhis_list->Employee_Contribution->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($nhis_list->Employer_Contribution->Visible) { // Employer Contribution ?>
		<td data-name="Employer_Contribution" <?php echo $nhis_list->Employer_Contribution->cellAttributes() ?>>
<span id="el<?php echo $nhis_list->RowCount ?>_nhis_Employer_Contribution">
<span<?php echo $nhis_list->Employer_Contribution->viewAttributes() ?>><?php echo $nhis_list->Employer_Contribution->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$nhis_list->ListOptions->render("body", "right", $nhis_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$nhis_list->isGridAdd())
		$nhis_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$nhis->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($nhis_list->Recordset)
	$nhis_list->Recordset->Close();
?>
<?php if (!$nhis_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$nhis_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $nhis_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $nhis_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($nhis_list->TotalRecords == 0 && !$nhis->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $nhis_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$nhis_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$nhis_list->isExport()) { ?>
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
$nhis_list->terminate();
?>