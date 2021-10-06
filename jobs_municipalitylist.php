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
$jobs_municipality_list = new jobs_municipality_list();

// Run the page
$jobs_municipality_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jobs_municipality_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$jobs_municipality_list->isExport()) { ?>
<script>
var fjobs_municipalitylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fjobs_municipalitylist = currentForm = new ew.Form("fjobs_municipalitylist", "list");
	fjobs_municipalitylist.formKeyCountName = '<?php echo $jobs_municipality_list->FormKeyCountName ?>';
	loadjs.done("fjobs_municipalitylist");
});
var fjobs_municipalitylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fjobs_municipalitylistsrch = currentSearchForm = new ew.Form("fjobs_municipalitylistsrch");

	// Dynamic selection lists
	// Filters

	fjobs_municipalitylistsrch.filterList = <?php echo $jobs_municipality_list->getFilterList() ?>;

	// Init search panel as collapsed
	fjobs_municipalitylistsrch.initSearchPanel = true;
	loadjs.done("fjobs_municipalitylistsrch");
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
<?php if (!$jobs_municipality_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($jobs_municipality_list->TotalRecords > 0 && $jobs_municipality_list->ExportOptions->visible()) { ?>
<?php $jobs_municipality_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($jobs_municipality_list->ImportOptions->visible()) { ?>
<?php $jobs_municipality_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($jobs_municipality_list->SearchOptions->visible()) { ?>
<?php $jobs_municipality_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($jobs_municipality_list->FilterOptions->visible()) { ?>
<?php $jobs_municipality_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$jobs_municipality_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$jobs_municipality_list->isExport() && !$jobs_municipality->CurrentAction) { ?>
<form name="fjobs_municipalitylistsrch" id="fjobs_municipalitylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fjobs_municipalitylistsrch-search-panel" class="<?php echo $jobs_municipality_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="jobs_municipality">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $jobs_municipality_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($jobs_municipality_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($jobs_municipality_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $jobs_municipality_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($jobs_municipality_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($jobs_municipality_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($jobs_municipality_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($jobs_municipality_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $jobs_municipality_list->showPageHeader(); ?>
<?php
$jobs_municipality_list->showMessage();
?>
<?php if ($jobs_municipality_list->TotalRecords > 0 || $jobs_municipality->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($jobs_municipality_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> jobs_municipality">
<?php if (!$jobs_municipality_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$jobs_municipality_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $jobs_municipality_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $jobs_municipality_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fjobs_municipalitylist" id="fjobs_municipalitylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jobs_municipality">
<div id="gmp_jobs_municipality" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($jobs_municipality_list->TotalRecords > 0 || $jobs_municipality_list->isGridEdit()) { ?>
<table id="tbl_jobs_municipalitylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$jobs_municipality->RowType = ROWTYPE_HEADER;

// Render list options
$jobs_municipality_list->renderListOptions();

// Render list options (header, left)
$jobs_municipality_list->ListOptions->render("header", "left");
?>
<?php if ($jobs_municipality_list->Department->Visible) { // Department ?>
	<?php if ($jobs_municipality_list->SortUrl($jobs_municipality_list->Department) == "") { ?>
		<th data-name="Department" class="<?php echo $jobs_municipality_list->Department->headerCellClass() ?>"><div id="elh_jobs_municipality_Department" class="jobs_municipality_Department"><div class="ew-table-header-caption"><?php echo $jobs_municipality_list->Department->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Department" class="<?php echo $jobs_municipality_list->Department->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jobs_municipality_list->SortUrl($jobs_municipality_list->Department) ?>', 1);"><div id="elh_jobs_municipality_Department" class="jobs_municipality_Department">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jobs_municipality_list->Department->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($jobs_municipality_list->Department->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jobs_municipality_list->Department->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($jobs_municipality_list->DeptSection->Visible) { // DeptSection ?>
	<?php if ($jobs_municipality_list->SortUrl($jobs_municipality_list->DeptSection) == "") { ?>
		<th data-name="DeptSection" class="<?php echo $jobs_municipality_list->DeptSection->headerCellClass() ?>"><div id="elh_jobs_municipality_DeptSection" class="jobs_municipality_DeptSection"><div class="ew-table-header-caption"><?php echo $jobs_municipality_list->DeptSection->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeptSection" class="<?php echo $jobs_municipality_list->DeptSection->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jobs_municipality_list->SortUrl($jobs_municipality_list->DeptSection) ?>', 1);"><div id="elh_jobs_municipality_DeptSection" class="jobs_municipality_DeptSection">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jobs_municipality_list->DeptSection->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($jobs_municipality_list->DeptSection->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jobs_municipality_list->DeptSection->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($jobs_municipality_list->JobName->Visible) { // JobName ?>
	<?php if ($jobs_municipality_list->SortUrl($jobs_municipality_list->JobName) == "") { ?>
		<th data-name="JobName" class="<?php echo $jobs_municipality_list->JobName->headerCellClass() ?>"><div id="elh_jobs_municipality_JobName" class="jobs_municipality_JobName"><div class="ew-table-header-caption"><?php echo $jobs_municipality_list->JobName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobName" class="<?php echo $jobs_municipality_list->JobName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jobs_municipality_list->SortUrl($jobs_municipality_list->JobName) ?>', 1);"><div id="elh_jobs_municipality_JobName" class="jobs_municipality_JobName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jobs_municipality_list->JobName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($jobs_municipality_list->JobName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jobs_municipality_list->JobName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($jobs_municipality_list->SalaryScale->Visible) { // SalaryScale ?>
	<?php if ($jobs_municipality_list->SortUrl($jobs_municipality_list->SalaryScale) == "") { ?>
		<th data-name="SalaryScale" class="<?php echo $jobs_municipality_list->SalaryScale->headerCellClass() ?>"><div id="elh_jobs_municipality_SalaryScale" class="jobs_municipality_SalaryScale"><div class="ew-table-header-caption"><?php echo $jobs_municipality_list->SalaryScale->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SalaryScale" class="<?php echo $jobs_municipality_list->SalaryScale->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jobs_municipality_list->SortUrl($jobs_municipality_list->SalaryScale) ?>', 1);"><div id="elh_jobs_municipality_SalaryScale" class="jobs_municipality_SalaryScale">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jobs_municipality_list->SalaryScale->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($jobs_municipality_list->SalaryScale->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jobs_municipality_list->SalaryScale->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($jobs_municipality_list->DivisionName->Visible) { // DivisionName ?>
	<?php if ($jobs_municipality_list->SortUrl($jobs_municipality_list->DivisionName) == "") { ?>
		<th data-name="DivisionName" class="<?php echo $jobs_municipality_list->DivisionName->headerCellClass() ?>"><div id="elh_jobs_municipality_DivisionName" class="jobs_municipality_DivisionName"><div class="ew-table-header-caption"><?php echo $jobs_municipality_list->DivisionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DivisionName" class="<?php echo $jobs_municipality_list->DivisionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jobs_municipality_list->SortUrl($jobs_municipality_list->DivisionName) ?>', 1);"><div id="elh_jobs_municipality_DivisionName" class="jobs_municipality_DivisionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jobs_municipality_list->DivisionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($jobs_municipality_list->DivisionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jobs_municipality_list->DivisionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($jobs_municipality_list->Division->Visible) { // Division ?>
	<?php if ($jobs_municipality_list->SortUrl($jobs_municipality_list->Division) == "") { ?>
		<th data-name="Division" class="<?php echo $jobs_municipality_list->Division->headerCellClass() ?>"><div id="elh_jobs_municipality_Division" class="jobs_municipality_Division"><div class="ew-table-header-caption"><?php echo $jobs_municipality_list->Division->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Division" class="<?php echo $jobs_municipality_list->Division->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jobs_municipality_list->SortUrl($jobs_municipality_list->Division) ?>', 1);"><div id="elh_jobs_municipality_Division" class="jobs_municipality_Division">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jobs_municipality_list->Division->caption() ?></span><span class="ew-table-header-sort"><?php if ($jobs_municipality_list->Division->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jobs_municipality_list->Division->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($jobs_municipality_list->CouncilType->Visible) { // CouncilType ?>
	<?php if ($jobs_municipality_list->SortUrl($jobs_municipality_list->CouncilType) == "") { ?>
		<th data-name="CouncilType" class="<?php echo $jobs_municipality_list->CouncilType->headerCellClass() ?>"><div id="elh_jobs_municipality_CouncilType" class="jobs_municipality_CouncilType"><div class="ew-table-header-caption"><?php echo $jobs_municipality_list->CouncilType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CouncilType" class="<?php echo $jobs_municipality_list->CouncilType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jobs_municipality_list->SortUrl($jobs_municipality_list->CouncilType) ?>', 1);"><div id="elh_jobs_municipality_CouncilType" class="jobs_municipality_CouncilType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jobs_municipality_list->CouncilType->caption() ?></span><span class="ew-table-header-sort"><?php if ($jobs_municipality_list->CouncilType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jobs_municipality_list->CouncilType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$jobs_municipality_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($jobs_municipality_list->ExportAll && $jobs_municipality_list->isExport()) {
	$jobs_municipality_list->StopRecord = $jobs_municipality_list->TotalRecords;
} else {

	// Set the last record to display
	if ($jobs_municipality_list->TotalRecords > $jobs_municipality_list->StartRecord + $jobs_municipality_list->DisplayRecords - 1)
		$jobs_municipality_list->StopRecord = $jobs_municipality_list->StartRecord + $jobs_municipality_list->DisplayRecords - 1;
	else
		$jobs_municipality_list->StopRecord = $jobs_municipality_list->TotalRecords;
}
$jobs_municipality_list->RecordCount = $jobs_municipality_list->StartRecord - 1;
if ($jobs_municipality_list->Recordset && !$jobs_municipality_list->Recordset->EOF) {
	$jobs_municipality_list->Recordset->moveFirst();
	$selectLimit = $jobs_municipality_list->UseSelectLimit;
	if (!$selectLimit && $jobs_municipality_list->StartRecord > 1)
		$jobs_municipality_list->Recordset->move($jobs_municipality_list->StartRecord - 1);
} elseif (!$jobs_municipality->AllowAddDeleteRow && $jobs_municipality_list->StopRecord == 0) {
	$jobs_municipality_list->StopRecord = $jobs_municipality->GridAddRowCount;
}

// Initialize aggregate
$jobs_municipality->RowType = ROWTYPE_AGGREGATEINIT;
$jobs_municipality->resetAttributes();
$jobs_municipality_list->renderRow();
while ($jobs_municipality_list->RecordCount < $jobs_municipality_list->StopRecord) {
	$jobs_municipality_list->RecordCount++;
	if ($jobs_municipality_list->RecordCount >= $jobs_municipality_list->StartRecord) {
		$jobs_municipality_list->RowCount++;

		// Set up key count
		$jobs_municipality_list->KeyCount = $jobs_municipality_list->RowIndex;

		// Init row class and style
		$jobs_municipality->resetAttributes();
		$jobs_municipality->CssClass = "";
		if ($jobs_municipality_list->isGridAdd()) {
		} else {
			$jobs_municipality_list->loadRowValues($jobs_municipality_list->Recordset); // Load row values
		}
		$jobs_municipality->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$jobs_municipality->RowAttrs->merge(["data-rowindex" => $jobs_municipality_list->RowCount, "id" => "r" . $jobs_municipality_list->RowCount . "_jobs_municipality", "data-rowtype" => $jobs_municipality->RowType]);

		// Render row
		$jobs_municipality_list->renderRow();

		// Render list options
		$jobs_municipality_list->renderListOptions();
?>
	<tr <?php echo $jobs_municipality->rowAttributes() ?>>
<?php

// Render list options (body, left)
$jobs_municipality_list->ListOptions->render("body", "left", $jobs_municipality_list->RowCount);
?>
	<?php if ($jobs_municipality_list->Department->Visible) { // Department ?>
		<td data-name="Department" <?php echo $jobs_municipality_list->Department->cellAttributes() ?>>
<span id="el<?php echo $jobs_municipality_list->RowCount ?>_jobs_municipality_Department">
<span<?php echo $jobs_municipality_list->Department->viewAttributes() ?>><?php echo $jobs_municipality_list->Department->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($jobs_municipality_list->DeptSection->Visible) { // DeptSection ?>
		<td data-name="DeptSection" <?php echo $jobs_municipality_list->DeptSection->cellAttributes() ?>>
<span id="el<?php echo $jobs_municipality_list->RowCount ?>_jobs_municipality_DeptSection">
<span<?php echo $jobs_municipality_list->DeptSection->viewAttributes() ?>><?php echo $jobs_municipality_list->DeptSection->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($jobs_municipality_list->JobName->Visible) { // JobName ?>
		<td data-name="JobName" <?php echo $jobs_municipality_list->JobName->cellAttributes() ?>>
<span id="el<?php echo $jobs_municipality_list->RowCount ?>_jobs_municipality_JobName">
<span<?php echo $jobs_municipality_list->JobName->viewAttributes() ?>><?php echo $jobs_municipality_list->JobName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($jobs_municipality_list->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale" <?php echo $jobs_municipality_list->SalaryScale->cellAttributes() ?>>
<span id="el<?php echo $jobs_municipality_list->RowCount ?>_jobs_municipality_SalaryScale">
<span<?php echo $jobs_municipality_list->SalaryScale->viewAttributes() ?>><?php echo $jobs_municipality_list->SalaryScale->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($jobs_municipality_list->DivisionName->Visible) { // DivisionName ?>
		<td data-name="DivisionName" <?php echo $jobs_municipality_list->DivisionName->cellAttributes() ?>>
<span id="el<?php echo $jobs_municipality_list->RowCount ?>_jobs_municipality_DivisionName">
<span<?php echo $jobs_municipality_list->DivisionName->viewAttributes() ?>><?php echo $jobs_municipality_list->DivisionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($jobs_municipality_list->Division->Visible) { // Division ?>
		<td data-name="Division" <?php echo $jobs_municipality_list->Division->cellAttributes() ?>>
<span id="el<?php echo $jobs_municipality_list->RowCount ?>_jobs_municipality_Division">
<span<?php echo $jobs_municipality_list->Division->viewAttributes() ?>><?php echo $jobs_municipality_list->Division->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($jobs_municipality_list->CouncilType->Visible) { // CouncilType ?>
		<td data-name="CouncilType" <?php echo $jobs_municipality_list->CouncilType->cellAttributes() ?>>
<span id="el<?php echo $jobs_municipality_list->RowCount ?>_jobs_municipality_CouncilType">
<span<?php echo $jobs_municipality_list->CouncilType->viewAttributes() ?>><?php echo $jobs_municipality_list->CouncilType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$jobs_municipality_list->ListOptions->render("body", "right", $jobs_municipality_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$jobs_municipality_list->isGridAdd())
		$jobs_municipality_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$jobs_municipality->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($jobs_municipality_list->Recordset)
	$jobs_municipality_list->Recordset->Close();
?>
<?php if (!$jobs_municipality_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$jobs_municipality_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $jobs_municipality_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $jobs_municipality_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($jobs_municipality_list->TotalRecords == 0 && !$jobs_municipality->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $jobs_municipality_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$jobs_municipality_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$jobs_municipality_list->isExport()) { ?>
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
$jobs_municipality_list->terminate();
?>