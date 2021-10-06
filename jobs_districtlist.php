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
$jobs_district_list = new jobs_district_list();

// Run the page
$jobs_district_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jobs_district_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$jobs_district_list->isExport()) { ?>
<script>
var fjobs_districtlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fjobs_districtlist = currentForm = new ew.Form("fjobs_districtlist", "list");
	fjobs_districtlist.formKeyCountName = '<?php echo $jobs_district_list->FormKeyCountName ?>';
	loadjs.done("fjobs_districtlist");
});
var fjobs_districtlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fjobs_districtlistsrch = currentSearchForm = new ew.Form("fjobs_districtlistsrch");

	// Dynamic selection lists
	// Filters

	fjobs_districtlistsrch.filterList = <?php echo $jobs_district_list->getFilterList() ?>;

	// Init search panel as collapsed
	fjobs_districtlistsrch.initSearchPanel = true;
	loadjs.done("fjobs_districtlistsrch");
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
<?php if (!$jobs_district_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($jobs_district_list->TotalRecords > 0 && $jobs_district_list->ExportOptions->visible()) { ?>
<?php $jobs_district_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($jobs_district_list->ImportOptions->visible()) { ?>
<?php $jobs_district_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($jobs_district_list->SearchOptions->visible()) { ?>
<?php $jobs_district_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($jobs_district_list->FilterOptions->visible()) { ?>
<?php $jobs_district_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$jobs_district_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$jobs_district_list->isExport() && !$jobs_district->CurrentAction) { ?>
<form name="fjobs_districtlistsrch" id="fjobs_districtlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fjobs_districtlistsrch-search-panel" class="<?php echo $jobs_district_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="jobs_district">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $jobs_district_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($jobs_district_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($jobs_district_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $jobs_district_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($jobs_district_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($jobs_district_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($jobs_district_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($jobs_district_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $jobs_district_list->showPageHeader(); ?>
<?php
$jobs_district_list->showMessage();
?>
<?php if ($jobs_district_list->TotalRecords > 0 || $jobs_district->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($jobs_district_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> jobs_district">
<?php if (!$jobs_district_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$jobs_district_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $jobs_district_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $jobs_district_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fjobs_districtlist" id="fjobs_districtlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jobs_district">
<div id="gmp_jobs_district" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($jobs_district_list->TotalRecords > 0 || $jobs_district_list->isGridEdit()) { ?>
<table id="tbl_jobs_districtlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$jobs_district->RowType = ROWTYPE_HEADER;

// Render list options
$jobs_district_list->renderListOptions();

// Render list options (header, left)
$jobs_district_list->ListOptions->render("header", "left");
?>
<?php if ($jobs_district_list->Department->Visible) { // Department ?>
	<?php if ($jobs_district_list->SortUrl($jobs_district_list->Department) == "") { ?>
		<th data-name="Department" class="<?php echo $jobs_district_list->Department->headerCellClass() ?>"><div id="elh_jobs_district_Department" class="jobs_district_Department"><div class="ew-table-header-caption"><?php echo $jobs_district_list->Department->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Department" class="<?php echo $jobs_district_list->Department->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jobs_district_list->SortUrl($jobs_district_list->Department) ?>', 1);"><div id="elh_jobs_district_Department" class="jobs_district_Department">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jobs_district_list->Department->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($jobs_district_list->Department->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jobs_district_list->Department->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($jobs_district_list->DeptSection->Visible) { // DeptSection ?>
	<?php if ($jobs_district_list->SortUrl($jobs_district_list->DeptSection) == "") { ?>
		<th data-name="DeptSection" class="<?php echo $jobs_district_list->DeptSection->headerCellClass() ?>"><div id="elh_jobs_district_DeptSection" class="jobs_district_DeptSection"><div class="ew-table-header-caption"><?php echo $jobs_district_list->DeptSection->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeptSection" class="<?php echo $jobs_district_list->DeptSection->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jobs_district_list->SortUrl($jobs_district_list->DeptSection) ?>', 1);"><div id="elh_jobs_district_DeptSection" class="jobs_district_DeptSection">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jobs_district_list->DeptSection->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($jobs_district_list->DeptSection->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jobs_district_list->DeptSection->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($jobs_district_list->JobName->Visible) { // JobName ?>
	<?php if ($jobs_district_list->SortUrl($jobs_district_list->JobName) == "") { ?>
		<th data-name="JobName" class="<?php echo $jobs_district_list->JobName->headerCellClass() ?>"><div id="elh_jobs_district_JobName" class="jobs_district_JobName"><div class="ew-table-header-caption"><?php echo $jobs_district_list->JobName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobName" class="<?php echo $jobs_district_list->JobName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jobs_district_list->SortUrl($jobs_district_list->JobName) ?>', 1);"><div id="elh_jobs_district_JobName" class="jobs_district_JobName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jobs_district_list->JobName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($jobs_district_list->JobName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jobs_district_list->JobName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($jobs_district_list->SalaryScale->Visible) { // SalaryScale ?>
	<?php if ($jobs_district_list->SortUrl($jobs_district_list->SalaryScale) == "") { ?>
		<th data-name="SalaryScale" class="<?php echo $jobs_district_list->SalaryScale->headerCellClass() ?>"><div id="elh_jobs_district_SalaryScale" class="jobs_district_SalaryScale"><div class="ew-table-header-caption"><?php echo $jobs_district_list->SalaryScale->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SalaryScale" class="<?php echo $jobs_district_list->SalaryScale->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jobs_district_list->SortUrl($jobs_district_list->SalaryScale) ?>', 1);"><div id="elh_jobs_district_SalaryScale" class="jobs_district_SalaryScale">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jobs_district_list->SalaryScale->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($jobs_district_list->SalaryScale->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jobs_district_list->SalaryScale->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($jobs_district_list->DivisionName->Visible) { // DivisionName ?>
	<?php if ($jobs_district_list->SortUrl($jobs_district_list->DivisionName) == "") { ?>
		<th data-name="DivisionName" class="<?php echo $jobs_district_list->DivisionName->headerCellClass() ?>"><div id="elh_jobs_district_DivisionName" class="jobs_district_DivisionName"><div class="ew-table-header-caption"><?php echo $jobs_district_list->DivisionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DivisionName" class="<?php echo $jobs_district_list->DivisionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jobs_district_list->SortUrl($jobs_district_list->DivisionName) ?>', 1);"><div id="elh_jobs_district_DivisionName" class="jobs_district_DivisionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jobs_district_list->DivisionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($jobs_district_list->DivisionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jobs_district_list->DivisionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($jobs_district_list->Division->Visible) { // Division ?>
	<?php if ($jobs_district_list->SortUrl($jobs_district_list->Division) == "") { ?>
		<th data-name="Division" class="<?php echo $jobs_district_list->Division->headerCellClass() ?>"><div id="elh_jobs_district_Division" class="jobs_district_Division"><div class="ew-table-header-caption"><?php echo $jobs_district_list->Division->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Division" class="<?php echo $jobs_district_list->Division->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jobs_district_list->SortUrl($jobs_district_list->Division) ?>', 1);"><div id="elh_jobs_district_Division" class="jobs_district_Division">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jobs_district_list->Division->caption() ?></span><span class="ew-table-header-sort"><?php if ($jobs_district_list->Division->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jobs_district_list->Division->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($jobs_district_list->CouncilType->Visible) { // CouncilType ?>
	<?php if ($jobs_district_list->SortUrl($jobs_district_list->CouncilType) == "") { ?>
		<th data-name="CouncilType" class="<?php echo $jobs_district_list->CouncilType->headerCellClass() ?>"><div id="elh_jobs_district_CouncilType" class="jobs_district_CouncilType"><div class="ew-table-header-caption"><?php echo $jobs_district_list->CouncilType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CouncilType" class="<?php echo $jobs_district_list->CouncilType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jobs_district_list->SortUrl($jobs_district_list->CouncilType) ?>', 1);"><div id="elh_jobs_district_CouncilType" class="jobs_district_CouncilType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jobs_district_list->CouncilType->caption() ?></span><span class="ew-table-header-sort"><?php if ($jobs_district_list->CouncilType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jobs_district_list->CouncilType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$jobs_district_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($jobs_district_list->ExportAll && $jobs_district_list->isExport()) {
	$jobs_district_list->StopRecord = $jobs_district_list->TotalRecords;
} else {

	// Set the last record to display
	if ($jobs_district_list->TotalRecords > $jobs_district_list->StartRecord + $jobs_district_list->DisplayRecords - 1)
		$jobs_district_list->StopRecord = $jobs_district_list->StartRecord + $jobs_district_list->DisplayRecords - 1;
	else
		$jobs_district_list->StopRecord = $jobs_district_list->TotalRecords;
}
$jobs_district_list->RecordCount = $jobs_district_list->StartRecord - 1;
if ($jobs_district_list->Recordset && !$jobs_district_list->Recordset->EOF) {
	$jobs_district_list->Recordset->moveFirst();
	$selectLimit = $jobs_district_list->UseSelectLimit;
	if (!$selectLimit && $jobs_district_list->StartRecord > 1)
		$jobs_district_list->Recordset->move($jobs_district_list->StartRecord - 1);
} elseif (!$jobs_district->AllowAddDeleteRow && $jobs_district_list->StopRecord == 0) {
	$jobs_district_list->StopRecord = $jobs_district->GridAddRowCount;
}

// Initialize aggregate
$jobs_district->RowType = ROWTYPE_AGGREGATEINIT;
$jobs_district->resetAttributes();
$jobs_district_list->renderRow();
while ($jobs_district_list->RecordCount < $jobs_district_list->StopRecord) {
	$jobs_district_list->RecordCount++;
	if ($jobs_district_list->RecordCount >= $jobs_district_list->StartRecord) {
		$jobs_district_list->RowCount++;

		// Set up key count
		$jobs_district_list->KeyCount = $jobs_district_list->RowIndex;

		// Init row class and style
		$jobs_district->resetAttributes();
		$jobs_district->CssClass = "";
		if ($jobs_district_list->isGridAdd()) {
		} else {
			$jobs_district_list->loadRowValues($jobs_district_list->Recordset); // Load row values
		}
		$jobs_district->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$jobs_district->RowAttrs->merge(["data-rowindex" => $jobs_district_list->RowCount, "id" => "r" . $jobs_district_list->RowCount . "_jobs_district", "data-rowtype" => $jobs_district->RowType]);

		// Render row
		$jobs_district_list->renderRow();

		// Render list options
		$jobs_district_list->renderListOptions();
?>
	<tr <?php echo $jobs_district->rowAttributes() ?>>
<?php

// Render list options (body, left)
$jobs_district_list->ListOptions->render("body", "left", $jobs_district_list->RowCount);
?>
	<?php if ($jobs_district_list->Department->Visible) { // Department ?>
		<td data-name="Department" <?php echo $jobs_district_list->Department->cellAttributes() ?>>
<span id="el<?php echo $jobs_district_list->RowCount ?>_jobs_district_Department">
<span<?php echo $jobs_district_list->Department->viewAttributes() ?>><?php echo $jobs_district_list->Department->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($jobs_district_list->DeptSection->Visible) { // DeptSection ?>
		<td data-name="DeptSection" <?php echo $jobs_district_list->DeptSection->cellAttributes() ?>>
<span id="el<?php echo $jobs_district_list->RowCount ?>_jobs_district_DeptSection">
<span<?php echo $jobs_district_list->DeptSection->viewAttributes() ?>><?php echo $jobs_district_list->DeptSection->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($jobs_district_list->JobName->Visible) { // JobName ?>
		<td data-name="JobName" <?php echo $jobs_district_list->JobName->cellAttributes() ?>>
<span id="el<?php echo $jobs_district_list->RowCount ?>_jobs_district_JobName">
<span<?php echo $jobs_district_list->JobName->viewAttributes() ?>><?php echo $jobs_district_list->JobName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($jobs_district_list->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale" <?php echo $jobs_district_list->SalaryScale->cellAttributes() ?>>
<span id="el<?php echo $jobs_district_list->RowCount ?>_jobs_district_SalaryScale">
<span<?php echo $jobs_district_list->SalaryScale->viewAttributes() ?>><?php echo $jobs_district_list->SalaryScale->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($jobs_district_list->DivisionName->Visible) { // DivisionName ?>
		<td data-name="DivisionName" <?php echo $jobs_district_list->DivisionName->cellAttributes() ?>>
<span id="el<?php echo $jobs_district_list->RowCount ?>_jobs_district_DivisionName">
<span<?php echo $jobs_district_list->DivisionName->viewAttributes() ?>><?php echo $jobs_district_list->DivisionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($jobs_district_list->Division->Visible) { // Division ?>
		<td data-name="Division" <?php echo $jobs_district_list->Division->cellAttributes() ?>>
<span id="el<?php echo $jobs_district_list->RowCount ?>_jobs_district_Division">
<span<?php echo $jobs_district_list->Division->viewAttributes() ?>><?php echo $jobs_district_list->Division->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($jobs_district_list->CouncilType->Visible) { // CouncilType ?>
		<td data-name="CouncilType" <?php echo $jobs_district_list->CouncilType->cellAttributes() ?>>
<span id="el<?php echo $jobs_district_list->RowCount ?>_jobs_district_CouncilType">
<span<?php echo $jobs_district_list->CouncilType->viewAttributes() ?>><?php echo $jobs_district_list->CouncilType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$jobs_district_list->ListOptions->render("body", "right", $jobs_district_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$jobs_district_list->isGridAdd())
		$jobs_district_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$jobs_district->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($jobs_district_list->Recordset)
	$jobs_district_list->Recordset->Close();
?>
<?php if (!$jobs_district_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$jobs_district_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $jobs_district_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $jobs_district_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($jobs_district_list->TotalRecords == 0 && !$jobs_district->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $jobs_district_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$jobs_district_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$jobs_district_list->isExport()) { ?>
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
$jobs_district_list->terminate();
?>