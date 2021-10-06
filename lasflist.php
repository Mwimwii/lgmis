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
$lasf_list = new lasf_list();

// Run the page
$lasf_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$lasf_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$lasf_list->isExport()) { ?>
<script>
var flasflist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	flasflist = currentForm = new ew.Form("flasflist", "list");
	flasflist.formKeyCountName = '<?php echo $lasf_list->FormKeyCountName ?>';
	loadjs.done("flasflist");
});
var flasflistsrch;
loadjs.ready("head", function() {

	// Form object for search
	flasflistsrch = currentSearchForm = new ew.Form("flasflistsrch");

	// Dynamic selection lists
	// Filters

	flasflistsrch.filterList = <?php echo $lasf_list->getFilterList() ?>;

	// Init search panel as collapsed
	flasflistsrch.initSearchPanel = true;
	loadjs.done("flasflistsrch");
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
<?php if (!$lasf_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($lasf_list->TotalRecords > 0 && $lasf_list->ExportOptions->visible()) { ?>
<?php $lasf_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($lasf_list->ImportOptions->visible()) { ?>
<?php $lasf_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($lasf_list->SearchOptions->visible()) { ?>
<?php $lasf_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($lasf_list->FilterOptions->visible()) { ?>
<?php $lasf_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$lasf_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$lasf_list->isExport() && !$lasf->CurrentAction) { ?>
<form name="flasflistsrch" id="flasflistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="flasflistsrch-search-panel" class="<?php echo $lasf_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="lasf">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $lasf_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($lasf_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($lasf_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $lasf_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($lasf_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($lasf_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($lasf_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($lasf_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $lasf_list->showPageHeader(); ?>
<?php
$lasf_list->showMessage();
?>
<?php if ($lasf_list->TotalRecords > 0 || $lasf->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($lasf_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> lasf">
<?php if (!$lasf_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$lasf_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $lasf_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $lasf_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="flasflist" id="flasflist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="lasf">
<div id="gmp_lasf" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($lasf_list->TotalRecords > 0 || $lasf_list->isGridEdit()) { ?>
<table id="tbl_lasflist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$lasf->RowType = ROWTYPE_HEADER;

// Render list options
$lasf_list->renderListOptions();

// Render list options (header, left)
$lasf_list->ListOptions->render("header", "left");
?>
<?php if ($lasf_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($lasf_list->SortUrl($lasf_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $lasf_list->EmployeeID->headerCellClass() ?>"><div id="elh_lasf_EmployeeID" class="lasf_EmployeeID"><div class="ew-table-header-caption"><?php echo $lasf_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $lasf_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lasf_list->SortUrl($lasf_list->EmployeeID) ?>', 1);"><div id="elh_lasf_EmployeeID" class="lasf_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lasf_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($lasf_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lasf_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lasf_list->FirstName->Visible) { // FirstName ?>
	<?php if ($lasf_list->SortUrl($lasf_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $lasf_list->FirstName->headerCellClass() ?>"><div id="elh_lasf_FirstName" class="lasf_FirstName"><div class="ew-table-header-caption"><?php echo $lasf_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $lasf_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lasf_list->SortUrl($lasf_list->FirstName) ?>', 1);"><div id="elh_lasf_FirstName" class="lasf_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lasf_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($lasf_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lasf_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lasf_list->Surname->Visible) { // Surname ?>
	<?php if ($lasf_list->SortUrl($lasf_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $lasf_list->Surname->headerCellClass() ?>"><div id="elh_lasf_Surname" class="lasf_Surname"><div class="ew-table-header-caption"><?php echo $lasf_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $lasf_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lasf_list->SortUrl($lasf_list->Surname) ?>', 1);"><div id="elh_lasf_Surname" class="lasf_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lasf_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($lasf_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lasf_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lasf_list->NRC->Visible) { // NRC ?>
	<?php if ($lasf_list->SortUrl($lasf_list->NRC) == "") { ?>
		<th data-name="NRC" class="<?php echo $lasf_list->NRC->headerCellClass() ?>"><div id="elh_lasf_NRC" class="lasf_NRC"><div class="ew-table-header-caption"><?php echo $lasf_list->NRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC" class="<?php echo $lasf_list->NRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lasf_list->SortUrl($lasf_list->NRC) ?>', 1);"><div id="elh_lasf_NRC" class="lasf_NRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lasf_list->NRC->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($lasf_list->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lasf_list->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lasf_list->DateOfBirth->Visible) { // DateOfBirth ?>
	<?php if ($lasf_list->SortUrl($lasf_list->DateOfBirth) == "") { ?>
		<th data-name="DateOfBirth" class="<?php echo $lasf_list->DateOfBirth->headerCellClass() ?>"><div id="elh_lasf_DateOfBirth" class="lasf_DateOfBirth"><div class="ew-table-header-caption"><?php echo $lasf_list->DateOfBirth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfBirth" class="<?php echo $lasf_list->DateOfBirth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lasf_list->SortUrl($lasf_list->DateOfBirth) ?>', 1);"><div id="elh_lasf_DateOfBirth" class="lasf_DateOfBirth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lasf_list->DateOfBirth->caption() ?></span><span class="ew-table-header-sort"><?php if ($lasf_list->DateOfBirth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lasf_list->DateOfBirth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lasf_list->Sex->Visible) { // Sex ?>
	<?php if ($lasf_list->SortUrl($lasf_list->Sex) == "") { ?>
		<th data-name="Sex" class="<?php echo $lasf_list->Sex->headerCellClass() ?>"><div id="elh_lasf_Sex" class="lasf_Sex"><div class="ew-table-header-caption"><?php echo $lasf_list->Sex->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sex" class="<?php echo $lasf_list->Sex->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lasf_list->SortUrl($lasf_list->Sex) ?>', 1);"><div id="elh_lasf_Sex" class="lasf_Sex">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lasf_list->Sex->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($lasf_list->Sex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lasf_list->Sex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lasf_list->BasicSalary->Visible) { // BasicSalary ?>
	<?php if ($lasf_list->SortUrl($lasf_list->BasicSalary) == "") { ?>
		<th data-name="BasicSalary" class="<?php echo $lasf_list->BasicSalary->headerCellClass() ?>"><div id="elh_lasf_BasicSalary" class="lasf_BasicSalary"><div class="ew-table-header-caption"><?php echo $lasf_list->BasicSalary->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BasicSalary" class="<?php echo $lasf_list->BasicSalary->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lasf_list->SortUrl($lasf_list->BasicSalary) ?>', 1);"><div id="elh_lasf_BasicSalary" class="lasf_BasicSalary">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lasf_list->BasicSalary->caption() ?></span><span class="ew-table-header-sort"><?php if ($lasf_list->BasicSalary->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lasf_list->BasicSalary->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lasf_list->DeductionName->Visible) { // DeductionName ?>
	<?php if ($lasf_list->SortUrl($lasf_list->DeductionName) == "") { ?>
		<th data-name="DeductionName" class="<?php echo $lasf_list->DeductionName->headerCellClass() ?>"><div id="elh_lasf_DeductionName" class="lasf_DeductionName"><div class="ew-table-header-caption"><?php echo $lasf_list->DeductionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionName" class="<?php echo $lasf_list->DeductionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lasf_list->SortUrl($lasf_list->DeductionName) ?>', 1);"><div id="elh_lasf_DeductionName" class="lasf_DeductionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lasf_list->DeductionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($lasf_list->DeductionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lasf_list->DeductionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lasf_list->Employee_Contribution->Visible) { // Employee Contribution ?>
	<?php if ($lasf_list->SortUrl($lasf_list->Employee_Contribution) == "") { ?>
		<th data-name="Employee_Contribution" class="<?php echo $lasf_list->Employee_Contribution->headerCellClass() ?>"><div id="elh_lasf_Employee_Contribution" class="lasf_Employee_Contribution"><div class="ew-table-header-caption"><?php echo $lasf_list->Employee_Contribution->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Employee_Contribution" class="<?php echo $lasf_list->Employee_Contribution->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lasf_list->SortUrl($lasf_list->Employee_Contribution) ?>', 1);"><div id="elh_lasf_Employee_Contribution" class="lasf_Employee_Contribution">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lasf_list->Employee_Contribution->caption() ?></span><span class="ew-table-header-sort"><?php if ($lasf_list->Employee_Contribution->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lasf_list->Employee_Contribution->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lasf_list->Employer_Contribution->Visible) { // Employer Contribution ?>
	<?php if ($lasf_list->SortUrl($lasf_list->Employer_Contribution) == "") { ?>
		<th data-name="Employer_Contribution" class="<?php echo $lasf_list->Employer_Contribution->headerCellClass() ?>"><div id="elh_lasf_Employer_Contribution" class="lasf_Employer_Contribution"><div class="ew-table-header-caption"><?php echo $lasf_list->Employer_Contribution->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Employer_Contribution" class="<?php echo $lasf_list->Employer_Contribution->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lasf_list->SortUrl($lasf_list->Employer_Contribution) ?>', 1);"><div id="elh_lasf_Employer_Contribution" class="lasf_Employer_Contribution">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lasf_list->Employer_Contribution->caption() ?></span><span class="ew-table-header-sort"><?php if ($lasf_list->Employer_Contribution->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lasf_list->Employer_Contribution->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lasf_list->Total_Contribution->Visible) { // Total Contribution ?>
	<?php if ($lasf_list->SortUrl($lasf_list->Total_Contribution) == "") { ?>
		<th data-name="Total_Contribution" class="<?php echo $lasf_list->Total_Contribution->headerCellClass() ?>"><div id="elh_lasf_Total_Contribution" class="lasf_Total_Contribution"><div class="ew-table-header-caption"><?php echo $lasf_list->Total_Contribution->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Total_Contribution" class="<?php echo $lasf_list->Total_Contribution->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lasf_list->SortUrl($lasf_list->Total_Contribution) ?>', 1);"><div id="elh_lasf_Total_Contribution" class="lasf_Total_Contribution">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lasf_list->Total_Contribution->caption() ?></span><span class="ew-table-header-sort"><?php if ($lasf_list->Total_Contribution->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lasf_list->Total_Contribution->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$lasf_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($lasf_list->ExportAll && $lasf_list->isExport()) {
	$lasf_list->StopRecord = $lasf_list->TotalRecords;
} else {

	// Set the last record to display
	if ($lasf_list->TotalRecords > $lasf_list->StartRecord + $lasf_list->DisplayRecords - 1)
		$lasf_list->StopRecord = $lasf_list->StartRecord + $lasf_list->DisplayRecords - 1;
	else
		$lasf_list->StopRecord = $lasf_list->TotalRecords;
}
$lasf_list->RecordCount = $lasf_list->StartRecord - 1;
if ($lasf_list->Recordset && !$lasf_list->Recordset->EOF) {
	$lasf_list->Recordset->moveFirst();
	$selectLimit = $lasf_list->UseSelectLimit;
	if (!$selectLimit && $lasf_list->StartRecord > 1)
		$lasf_list->Recordset->move($lasf_list->StartRecord - 1);
} elseif (!$lasf->AllowAddDeleteRow && $lasf_list->StopRecord == 0) {
	$lasf_list->StopRecord = $lasf->GridAddRowCount;
}

// Initialize aggregate
$lasf->RowType = ROWTYPE_AGGREGATEINIT;
$lasf->resetAttributes();
$lasf_list->renderRow();
while ($lasf_list->RecordCount < $lasf_list->StopRecord) {
	$lasf_list->RecordCount++;
	if ($lasf_list->RecordCount >= $lasf_list->StartRecord) {
		$lasf_list->RowCount++;

		// Set up key count
		$lasf_list->KeyCount = $lasf_list->RowIndex;

		// Init row class and style
		$lasf->resetAttributes();
		$lasf->CssClass = "";
		if ($lasf_list->isGridAdd()) {
		} else {
			$lasf_list->loadRowValues($lasf_list->Recordset); // Load row values
		}
		$lasf->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$lasf->RowAttrs->merge(["data-rowindex" => $lasf_list->RowCount, "id" => "r" . $lasf_list->RowCount . "_lasf", "data-rowtype" => $lasf->RowType]);

		// Render row
		$lasf_list->renderRow();

		// Render list options
		$lasf_list->renderListOptions();
?>
	<tr <?php echo $lasf->rowAttributes() ?>>
<?php

// Render list options (body, left)
$lasf_list->ListOptions->render("body", "left", $lasf_list->RowCount);
?>
	<?php if ($lasf_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $lasf_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $lasf_list->RowCount ?>_lasf_EmployeeID">
<span<?php echo $lasf_list->EmployeeID->viewAttributes() ?>><?php echo $lasf_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lasf_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $lasf_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $lasf_list->RowCount ?>_lasf_FirstName">
<span<?php echo $lasf_list->FirstName->viewAttributes() ?>><?php echo $lasf_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lasf_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $lasf_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $lasf_list->RowCount ?>_lasf_Surname">
<span<?php echo $lasf_list->Surname->viewAttributes() ?>><?php echo $lasf_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lasf_list->NRC->Visible) { // NRC ?>
		<td data-name="NRC" <?php echo $lasf_list->NRC->cellAttributes() ?>>
<span id="el<?php echo $lasf_list->RowCount ?>_lasf_NRC">
<span<?php echo $lasf_list->NRC->viewAttributes() ?>><?php echo $lasf_list->NRC->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lasf_list->DateOfBirth->Visible) { // DateOfBirth ?>
		<td data-name="DateOfBirth" <?php echo $lasf_list->DateOfBirth->cellAttributes() ?>>
<span id="el<?php echo $lasf_list->RowCount ?>_lasf_DateOfBirth">
<span<?php echo $lasf_list->DateOfBirth->viewAttributes() ?>><?php echo $lasf_list->DateOfBirth->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lasf_list->Sex->Visible) { // Sex ?>
		<td data-name="Sex" <?php echo $lasf_list->Sex->cellAttributes() ?>>
<span id="el<?php echo $lasf_list->RowCount ?>_lasf_Sex">
<span<?php echo $lasf_list->Sex->viewAttributes() ?>><?php echo $lasf_list->Sex->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lasf_list->BasicSalary->Visible) { // BasicSalary ?>
		<td data-name="BasicSalary" <?php echo $lasf_list->BasicSalary->cellAttributes() ?>>
<span id="el<?php echo $lasf_list->RowCount ?>_lasf_BasicSalary">
<span<?php echo $lasf_list->BasicSalary->viewAttributes() ?>><?php echo $lasf_list->BasicSalary->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lasf_list->DeductionName->Visible) { // DeductionName ?>
		<td data-name="DeductionName" <?php echo $lasf_list->DeductionName->cellAttributes() ?>>
<span id="el<?php echo $lasf_list->RowCount ?>_lasf_DeductionName">
<span<?php echo $lasf_list->DeductionName->viewAttributes() ?>><?php echo $lasf_list->DeductionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lasf_list->Employee_Contribution->Visible) { // Employee Contribution ?>
		<td data-name="Employee_Contribution" <?php echo $lasf_list->Employee_Contribution->cellAttributes() ?>>
<span id="el<?php echo $lasf_list->RowCount ?>_lasf_Employee_Contribution">
<span<?php echo $lasf_list->Employee_Contribution->viewAttributes() ?>><?php echo $lasf_list->Employee_Contribution->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lasf_list->Employer_Contribution->Visible) { // Employer Contribution ?>
		<td data-name="Employer_Contribution" <?php echo $lasf_list->Employer_Contribution->cellAttributes() ?>>
<span id="el<?php echo $lasf_list->RowCount ?>_lasf_Employer_Contribution">
<span<?php echo $lasf_list->Employer_Contribution->viewAttributes() ?>><?php echo $lasf_list->Employer_Contribution->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lasf_list->Total_Contribution->Visible) { // Total Contribution ?>
		<td data-name="Total_Contribution" <?php echo $lasf_list->Total_Contribution->cellAttributes() ?>>
<span id="el<?php echo $lasf_list->RowCount ?>_lasf_Total_Contribution">
<span<?php echo $lasf_list->Total_Contribution->viewAttributes() ?>><?php echo $lasf_list->Total_Contribution->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$lasf_list->ListOptions->render("body", "right", $lasf_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$lasf_list->isGridAdd())
		$lasf_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$lasf->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($lasf_list->Recordset)
	$lasf_list->Recordset->Close();
?>
<?php if (!$lasf_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$lasf_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $lasf_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $lasf_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($lasf_list->TotalRecords == 0 && !$lasf->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $lasf_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$lasf_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$lasf_list->isExport()) { ?>
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
$lasf_list->terminate();
?>